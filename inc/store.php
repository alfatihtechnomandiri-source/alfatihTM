<?php
/**
 * Penyimpanan data pesanan & pesan kontak.
 *
 * Backend utama: SQLite (PDO). Jika ekstensi pdo_sqlite tidak tersedia,
 * data otomatis disimpan sebagai file JSON-lines di folder data milik app
 * supaya formulir tetap berfungsi.
 */

/**
 * Nama folder data sengaja memakai akhiran acak supaya file pesanan
 * tidak bisa diunduh orang lain hanya dengan menebak alamat URL-nya.
 * Variabel lingkungan NK_STORE_DIR hanya dipakai untuk pengujian lokal
 * (diarahkan ke folder sementara) dan tidak diset pada server.
 */
const STORE_DIR_NAME = 'data-7f31c9a2';

function store_dir(): string
{
    $env = getenv('NK_STORE_DIR');
    $dir = ($env !== false && $env !== '') ? rtrim($env, '/') : dirname(__DIR__) . '/' . STORE_DIR_NAME;
    if (!is_dir($dir)) {
        @mkdir($dir, 0777, true);
        @file_put_contents($dir . '/.htaccess', "Require all denied\nDeny from all\n");
    }
    return $dir;
}

function store_pdo(): ?PDO
{
    static $pdo = null;
    static $done = false;

    if ($done) {
        return $pdo;
    }
    $done = true;

    if (!extension_loaded('pdo_sqlite') || !class_exists('PDO')) {
        return $pdo = null;
    }
    if (!in_array('sqlite', PDO::getAvailableDrivers(), true)) {
        return $pdo = null;
    }

    try {
        $pdo = new PDO('sqlite:' . store_dir() . '/app.sqlite', null, null, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
        $pdo->exec('PRAGMA busy_timeout = 5000');
        $pdo->exec('PRAGMA journal_mode = WAL');
        $pdo->exec('PRAGMA synchronous = NORMAL');
        store_migrate($pdo);
    } catch (Throwable $e) {
        $pdo = null;
    }

    return $pdo;
}

function store_backend(): string
{
    return store_pdo() instanceof PDO ? 'sqlite' : 'json';
}

/**
 * Membuat tabel yang dibutuhkan. Dijalankan sekali per request dan
 * seluruhnya dibungkus satu transaksi agar tidak membayar biaya fsync
 * untuk setiap pernyataan.
 */
function store_migrate(PDO $pdo): void
{
    try {
        $pdo->exec('BEGIN IMMEDIATE');

        $pdo->exec('CREATE TABLE IF NOT EXISTS orders (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            kode TEXT NOT NULL UNIQUE,
            produk_id INTEGER NOT NULL DEFAULT 0,
            produk_kode TEXT NOT NULL DEFAULT "",
            produk_nama TEXT NOT NULL,
            kategori TEXT NOT NULL DEFAULT "",
            harga_satuan REAL NOT NULL DEFAULT 0,
            jumlah INTEGER NOT NULL DEFAULT 1,
            total REAL NOT NULL DEFAULT 0,
            volume TEXT NOT NULL DEFAULT "",
            lokasi TEXT NOT NULL DEFAULT "",
            target_waktu TEXT NOT NULL DEFAULT "",
            nama TEXT NOT NULL,
            email TEXT NOT NULL DEFAULT "",
            telepon TEXT NOT NULL,
            perusahaan TEXT NOT NULL DEFAULT "",
            catatan TEXT NOT NULL DEFAULT "",
            status TEXT NOT NULL DEFAULT "baru",
            created_at TEXT NOT NULL
        )');

        // Kolom tambahan untuk basis data yang dibuat versi sebelumnya.
        $kolom = [];
        foreach ($pdo->query('PRAGMA table_info(orders)') as $info) {
            $kolom[$info['name']] = true;
        }
        $tambahan = [
            'volume'       => 'TEXT NOT NULL DEFAULT ""',
            'lokasi'       => 'TEXT NOT NULL DEFAULT ""',
            'target_waktu' => 'TEXT NOT NULL DEFAULT ""',
        ];
        foreach ($tambahan as $nama => $tipe) {
            if (!isset($kolom[$nama])) {
                $pdo->exec('ALTER TABLE orders ADD COLUMN ' . $nama . ' ' . $tipe);
            }
        }

        $pdo->exec('CREATE INDEX IF NOT EXISTS idx_orders_kode ON orders (kode)');

        $pdo->exec('CREATE TABLE IF NOT EXISTS messages (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nama TEXT NOT NULL,
            email TEXT NOT NULL DEFAULT "",
            telepon TEXT NOT NULL DEFAULT "",
            subjek TEXT NOT NULL DEFAULT "",
            pesan TEXT NOT NULL,
            created_at TEXT NOT NULL
        )');

        $pdo->exec('COMMIT');
    } catch (Throwable $e) {
        try {
            $pdo->exec('ROLLBACK');
        } catch (Throwable $e2) {
            // diabaikan
        }
    }
}

function store_new_code(): string
{
    return 'NK-' . date('ymd') . '-' . strtoupper(bin2hex(random_bytes(2)));
}

/**
 * Simpan permintaan penawaran baru, mengembalikan kode permintaan.
 * Nama kolom produk_* dan harga_* adalah nama lama yang dipertahankan
 * agar basis data versi sebelumnya tetap dapat dipakai tanpa migrasi
 * ulang; isinya sekarang berisi item katalog (jasa/material).
 */
function store_create_order(array $data): string
{
    $kode = store_new_code();
    $row = [
        'kode'         => $kode,
        'produk_id'    => (int) $data['produk_id'],
        'produk_kode'  => (string) ($data['produk_kode'] ?? ''),
        'produk_nama'  => (string) $data['produk_nama'],
        'kategori'     => (string) ($data['kategori'] ?? ''),
        'harga_satuan' => 0,
        'jumlah'       => 1,
        'total'        => 0,
        'volume'       => (string) ($data['volume'] ?? ''),
        'lokasi'       => (string) ($data['lokasi'] ?? ''),
        'target_waktu' => (string) ($data['target_waktu'] ?? ''),
        'nama'         => (string) $data['nama'],
        'email'        => (string) ($data['email'] ?? ''),
        'telepon'      => (string) $data['telepon'],
        'perusahaan'   => (string) ($data['perusahaan'] ?? ''),
        'catatan'      => (string) ($data['catatan'] ?? ''),
        'status'       => 'baru',
        'created_at'   => date('c'),
    ];

    $pdo = store_pdo();
    if ($pdo instanceof PDO) {
        try {
            $stmt = $pdo->prepare('INSERT INTO orders
                (kode, produk_id, produk_kode, produk_nama, kategori, harga_satuan, jumlah, total,
                 volume, lokasi, target_waktu, nama, email, telepon, perusahaan, catatan, status, created_at)
                VALUES (:kode, :produk_id, :produk_kode, :produk_nama, :kategori, :harga_satuan, :jumlah, :total,
                 :volume, :lokasi, :target_waktu, :nama, :email, :telepon, :perusahaan, :catatan, :status, :created_at)');
            $stmt->execute($row);
            return $kode;
        } catch (Throwable $e) {
            // jatuh ke penyimpanan cadangan
        }
    }

    store_json_append('orders.jsonl', $row);
    return $kode;
}

function store_find_order(string $kode): ?array
{
    $kode = strtoupper(trim($kode));
    if ($kode === '') {
        return null;
    }

    $pdo = store_pdo();
    if ($pdo instanceof PDO) {
        try {
            $stmt = $pdo->prepare('SELECT * FROM orders WHERE UPPER(kode) = :kode LIMIT 1');
            $stmt->execute(['kode' => $kode]);
            $found = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($found) {
                return $found;
            }
        } catch (Throwable $e) {
            // lanjut ke penyimpanan cadangan
        }
    }

    foreach (array_reverse(store_json_all('orders.jsonl')) as $row) {
        if (strtoupper((string) ($row['kode'] ?? '')) === $kode) {
            return $row;
        }
    }
    return null;
}

function store_create_message(array $data): bool
{
    $row = [
        'nama'       => (string) $data['nama'],
        'email'      => (string) ($data['email'] ?? ''),
        'telepon'    => (string) ($data['telepon'] ?? ''),
        'subjek'     => (string) ($data['subjek'] ?? ''),
        'pesan'      => (string) $data['pesan'],
        'created_at' => date('c'),
    ];

    $pdo = store_pdo();
    if ($pdo instanceof PDO) {
        try {
            $stmt = $pdo->prepare('INSERT INTO messages (nama, email, telepon, subjek, pesan, created_at)
                VALUES (:nama, :email, :telepon, :subjek, :pesan, :created_at)');
            $stmt->execute($row);
            return true;
        } catch (Throwable $e) {
            // jatuh ke penyimpanan cadangan
        }
    }

    store_json_append('messages.jsonl', $row);
    return true;
}

function store_json_append(string $file, array $row): void
{
    $path = store_dir() . '/' . $file;
    $line = json_encode($row, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . "\n";
    $handle = @fopen($path, 'a');
    if ($handle === false) {
        return;
    }
    if (flock($handle, LOCK_EX)) {
        fwrite($handle, $line);
        fflush($handle);
        flock($handle, LOCK_UN);
    }
    fclose($handle);
}

function store_json_all(string $file): array
{
    $path = store_dir() . '/' . $file;
    if (!is_file($path)) {
        return [];
    }
    $rows = [];
    foreach (file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) ?: [] as $line) {
        $decoded = json_decode($line, true);
        if (is_array($decoded)) {
            $rows[] = $decoded;
        }
    }
    return $rows;
}
