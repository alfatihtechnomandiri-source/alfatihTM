<?php
declare(strict_types=1);

require_once __DIR__ . '/compat.php';
require_once __DIR__ . '/content.php';
require_once __DIR__ . '/icons.php';
require_once __DIR__ . '/store.php';

/** Escape output HTML. */
function e($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function img_url(string $file): string
{
    return 'assets/img/' . $file;
}

/**
 * Inisial singkat nama instansi, dipakai sebagai pengganti logo pada tabel
 * pengalaman kerjasama bila berkas logonya belum tersedia.
 * Contoh: 'PT. Telkom Indonesia (Persero) Tbk' -> 'TI';
 *         'Logistik Polisi Daerah Sumatera Utara' -> 'LP'.
 */
function short_name(string $nama): string
{
    $bersih = preg_replace('/\((?:persero|tbk)[^)]*\)/i', ' ', $nama) ?? $nama;
    $kata = preg_split('/[\s.\-,\/]+/', trim($bersih), -1, PREG_SPLIT_NO_EMPTY) ?: [];
    $kata = array_values(array_filter($kata, static function ($k) {
        return !in_array(mb_strtolower($k, 'UTF-8'), ['pt', 'cv', 'ud', 'pd', 'tbk', 'persero', 'dan', 'and'], true);
    }));

    $inisial = '';
    foreach (array_slice($kata, 0, 2) as $k) {
        $inisial .= mb_strtoupper(mb_substr($k, 0, 1, 'UTF-8'), 'UTF-8');
    }

    return $inisial !== '' ? $inisial : mb_strtoupper(mb_substr($nama, 0, 1, 'UTF-8'), 'UTF-8');
}

function nav_items(): array
{
    return [
        'index.php'      => 'Home',
        'portofolio.php' => 'Portofolio',
        'katalog.php'    => 'Katalog',
        'tentang.php'    => 'Tentang Kami',
        'kontak.php'     => 'Kontak',
    ];
}

function current_page(): string
{
    $script = basename($_SERVER['SCRIPT_NAME'] ?? 'index.php');
    // halaman detail mengikuti menu induknya
    $map = [
        'proyek.php'             => 'portofolio.php',
        'produk.php'             => 'katalog.php',
        'permintaan-sukses.php'  => 'katalog.php',
    ];
    return $map[$script] ?? $script;
}

function post_str(string $key, string $default = ''): string
{
    $value = $_POST[$key] ?? $default;
    return is_string($value) ? trim($value) : $default;
}

function excerpt(string $text, int $limit = 150): string
{
    $text = trim(preg_replace('/\s+/', ' ', $text));
    if (mb_strlen($text) <= $limit) {
        return $text;
    }
    return rtrim(mb_substr($text, 0, $limit), " ,.;:") . '…';
}

/** Label ringkas untuk meta halaman. */
function page_meta(array $meta): string
{
    $out = [];
    foreach ($meta as $label => $value) {
        if ($value !== '' && $value !== null) {
            $out[] = '<div class="meta-item"><span class="meta-label">' . e($label) . '</span><span class="meta-value">' . e($value) . '</span></div>';
        }
    }
    return implode('', $out);
}
