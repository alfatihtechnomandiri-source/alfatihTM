<?php
/**
 * Sumber data konten situs: layanan, portofolio lingkup pekerjaan, katalog
 * jasa & material, visi & misi, serta fakta perusahaan.
 *
 * Catatan: katalog (fungsi products()) berisi jasa dan material yang
 * ditawarkan perusahaan. Harga tidak dicantumkan karena setiap pekerjaan
 * dihitung berdasarkan lingkup — pengunjung mengajukan permintaan penawaran.
 */

function cfg(string $key = null, $default = null)
{
    static $config = null;
    if ($config === null) {
        $config = require __DIR__ . '/config.php';
    }
    if ($key === null) {
        return $config;
    }
    return array_key_exists($key, $config) ? $config[$key] : $default;
}

function wa_link(string $text = ''): string
{
    $url = 'https://wa.me/' . preg_replace('/\D/', '', (string) cfg('whatsapp'));
    if ($text !== '') {
        $url .= '?text=' . rawurlencode($text);
    }
    return $url;
}

function wa_default_text(): string
{
    return 'Halo ' . cfg('nama') . ', saya ingin berkonsultasi mengenai pekerjaan fiber optik / konstruksi.';
}

function services(): array
{
    return [
        [
            'icon'  => 'cable',
            'nama'  => 'Instalasi Jaringan Fiber Optik',
            'desc'  => 'Pelaksanaan penarikan kabel, pemasangan perangkat, penyambungan, dan pengujian jaringan fiber optik.',
            'poin'  => ['Penarikan kabel feeder & distribusi', 'Instalasi ODP/OTB dan closure', 'Splicing dan pengujian OTDR'],
        ],
        [
            'icon'  => 'building',
            'nama'  => 'Konstruksi Gedung & Bangunan',
            'desc'  => 'Pembangunan baru, penambahan, maupun renovasi bangunan sesuai gambar kerja dan standar teknis.',
            'poin'  => ['Pekerjaan struktur & arsitektur', 'Renovasi dan perubahan fungsi ruang', 'Pekerjaan finishing'],
        ],
        [
            'icon'  => 'hardhat',
            'nama'  => 'Pelaksana Konstruksi',
            'desc'  => 'Pelaksanaan pekerjaan di lapangan dengan pengendalian mutu, waktu, biaya, dan keselamatan kerja.',
            'poin'  => ['Manajemen pelaksanaan lapangan', 'Pengendalian mutu & K3', 'Pelaporan progres pekerjaan'],
        ],
        [
            'icon'  => 'ruler',
            'nama'  => 'Desain & Drafter Perencanaan',
            'desc'  => 'Penyusunan gambar perencanaan dan drafter teknis, dari konsep sampai gambar siap pelaksanaan.',
            'poin'  => ['Gambar kerja (DED & shop drawing)', 'Perhitungan volume & RAB', 'As-built drawing'],
        ],
        [
            'icon'  => 'clipboard',
            'nama'  => 'Manajemen Data Konstruksi',
            'desc'  => 'Penataan dan pengelolaan data proyek: dokumentasi, volume pekerjaan, dan laporan pelaksanaan.',
            'poin'  => ['Pendataan volume & dokumentasi', 'Laporan progres & administrasi', 'Arsip data konstruksi (as-built)'],
        ],
        [
            'icon'  => 'compass',
            'nama'  => 'Survey & Pengukuran Lapangan',
            'desc'  => 'Pengukuran dan pemetaan awal sebagai dasar perencanaan jaringan maupun pekerjaan konstruksi.',
            'poin'  => ['Pengukuran jalur & titik instalasi', 'Pengumpulan data lapangan', 'Rekomendasi teknis awal'],
        ],
    ];
}

function vision(): string
{
    return 'Menjadi pionir dalam industri konstruksi dengan menghadirkan karya-karya berkualitas tinggi yang menginspirasi, membangun lingkungan yang berkelanjutan, dan memberikan kontribusi positif bagi masyarakat.';
}

function missions(): array
{
    return [
        [
            'icon'  => 'target',
            'judul' => 'Memberikan Solusi Unggul',
            'desc'  => 'Kami berkomitmen untuk menghasilkan solusi konstruksi yang unggul dan inovatif, memenuhi dan melampaui harapan klien kami dalam setiap proyek yang kami kerjakan.',
        ],
        [
            'icon'  => 'shield',
            'judul' => 'Mengutamakan Kualitas',
            'desc'  => 'Kualitas adalah inti dari setiap pekerjaan kami. Kami memastikan bahwa setiap aspek proyek kami dilakukan dengan standar tertinggi untuk menghasilkan hasil akhir yang tahan lama, aman, dan estetis.',
        ],
        [
            'icon'  => 'sparkle',
            'judul' => 'Mendukung Keberlanjutan',
            'desc'  => 'Kami mendorong praktik konstruksi berkelanjutan dengan mengintegrasikan solusi yang ramah lingkungan dan efisiensi energi dalam setiap proyek, berkontribusi pada perlindungan lingkungan dan keberlanjutan jangka panjang.',
        ],
        [
            'icon'  => 'users',
            'judul' => 'Menciptakan Hubungan Jangka Panjang',
            'desc'  => 'Kami menghargai kemitraan jangka panjang dengan klien kami. Kami berkomitmen untuk mendengarkan, berkolaborasi, dan memberikan solusi yang relevan yang memenuhi tujuan dan kebutuhan klien kami.',
        ],
    ];
}

/** Bidang usaha & lingkup pekerjaan sesuai akta perusahaan. */
/**
 * Profil singkat & bidang usaha perusahaan (halaman Portofolio).
 * Disusun dari keterangan yang diberikan pemilik perusahaan.
 */
function profile_intro(): string
{
    return 'PT. Alfatih Techno Mandiri adalah perusahaan yang beroperasi di bidang pelaksana '
        . 'konstruksi sentral telekomunikasi, konstruksi gedung/bangunan, dan konstruksi pekerjaan '
        . 'sipil seperti jalan aspal/beton serta irigasi jalan/pertanian. Kami juga melayani jasa '
        . 'pemasaran dan pengadaan barang material bangunan, perangkat hardware, perangkat software, '
        . 'dan lain-lain.';
}

/** Kemampuan & keahlian perusahaan, dikelompokkan per bidang. */
function capabilities(): array
{
    return [
        [
            'icon'  => 'cable',
            'judul' => 'Kemampuan &amp; keahlian di bidang teknologi',
            'ket'   => 'Perencanaan sampai pelaksanaan pekerjaan berbasis teknologi.',
            'poin'  => [
                'Mampu mengerjakan perencanaan dan pelaksanaan digitalisasi fiber optik secara terintegrasi',
                'Mampu mengerjakan perencanaan dan pelaksanaan pekerjaan inovasi teknologi CCTV',
                'Mampu mengerjakan perencanaan dan pelaksanaan pekerjaan inovasi teknologi IoT berbasis AI',
                'Mampu mengerjakan perencanaan tool software aplikasi sesuai kebutuhan',
            ],
        ],
        [
            'icon'  => 'hardhat',
            'judul' => 'Kemampuan &amp; pengalaman dalam proyek konstruksi',
            'ket'   => 'Pengalaman pelaksanaan pekerjaan bangunan, jalan, dan irigasi.',
            'poin'  => [
                'Mampu mengerjakan pekerjaan bangunan gedung',
                'Mampu mendesain perencanaan bangunan',
                'Mampu membuat perencanaan masterplan proyek bangunan, jalan, dan irigasi',
                'Mampu membuat DED, RAB, dan ABD (as-built drawing) suatu pekerjaan bangunan gedung dan irigasi',
                'Mampu mendesain dan mengerjakan pembangunan kolam renang serta perawatannya',
            ],
        ],
    ];
}

function business_fields(): array
{
    return [
        [
            'icon'  => 'tower',
            'judul' => 'Pelaksana Konstruksi Sentral Telekomunikasi',
            'desc'  => 'Pelaksanaan pekerjaan sentral dan jaringan telekomunikasi, termasuk instalasi jaringan fiber optik beserta perangkatnya.',
            'poin'  => ['Jaringan akses & FTTH', 'Feeder dan backbone', 'Perangkat sentral & pemeliharaan'],
        ],
        [
            'icon'  => 'building',
            'judul' => 'Konstruksi Gedung / Bangunan',
            'desc'  => 'Pelaksanaan konstruksi gedung dan bangunan, baik pembangunan baru maupun pekerjaan lanjutan sesuai gambar kerja dan kebutuhan pemilik pekerjaan.',
            'poin'  => ['Bangunan komersial & operasional', 'Gudang dan bangunan industri', 'Kolam renang & perawatannya'],
        ],
        [
            'icon'  => 'wrench',
            'judul' => 'Konstruksi Pekerjaan Sipil',
            'desc'  => 'Pekerjaan sipil seperti jalan aspal/beton dan irigasi jalan maupun irigasi pertanian, dari persiapan lahan sampai penyelesaian.',
            'poin'  => ['Jalan aspal & beton', 'Irigasi jalan & pertanian', 'Pekerjaan drainase & lahan'],
        ],
        [
            'icon'  => 'clipboard',
            'judul' => 'Desain, Pelaksana & Manajemen Data Konstruksi',
            'desc'  => 'Dukungan perencanaan dan administrasi teknis: gambar drafter, pelaksanaan di lapangan, serta penataan data dan dokumentasi pekerjaan konstruksi.',
            'poin'  => ['Desain & drafter perencanaan', 'DED, RAB & masterplan', 'Manajemen data konstruksi'],
        ],
        [
            'icon'  => 'truck',
            'judul' => 'Jasa Pemasaran & Pengadaan Barang',
            'desc'  => 'Pemasaran dan pengadaan material bangunan serta perangkat pendukung pekerjaan, baik perangkat hardware maupun software.',
            'poin'  => ['Material bangunan', 'Perangkat hardware', 'Perangkat software'],
        ],
    ];
}

function projects(): array
{
    return [
        [
            'id' => 1, 'slug' => 'instalasi-jaringan-ftth',
            'nama' => 'Instalasi Jaringan Fiber Optik (FTTH)',
            'kategori' => 'Fiber Optik', 'sektor' => 'Kawasan perumahan & perkantoran', 'lokasi' => 'Sumatera Utara',
            'layanan' => ['Survey jalur', 'Penarikan kabel', 'Splicing', 'Pengujian OTDR'],
            'excerpt' => 'Pelaksanaan jaringan fiber optik sampai ke pelanggan, dari pengukuran jalur hingga pengujian sambungan.',
            'kebutuhan' => 'Kawasan perumahan dan perkantoran membutuhkan jaringan fiber optik yang siap dipakai, dengan jalur kabel yang rapi serta sambungan yang terukur kualitasnya.',
            'pendekatan' => 'Kami melakukan pengukuran jalur terlebih dahulu, menetapkan titik distribusi, lalu melaksanakan penarikan kabel, penyambungan, dan pengujian tiap ruas sebelum diserahkan.',
            'lingkup' => [
                'Pengukuran dan penandaan jalur kabel',
                'Penarikan kabel distribusi dan drop',
                'Pemasangan titik distribusi (ODP)',
                'Splicing dan pengujian OTDR',
                'Perapian jalur dan penandaan titik',
                'Berita acara hasil pengujian',
            ],
            'gambar' => 'proyek/1-instalasi-jaringan-ftth.jpg',
            'galeri' => ['proyek/1-instalasi-jaringan-ftth.jpg', 'prod-3.jpg', 'prod-2.jpg'],
        ],
        [
            'id' => 2, 'slug' => 'jaringan-backbone-feeder',
            'nama' => 'Penarikan Kabel Feeder & Backbone',
            'kategori' => 'Fiber Optik', 'sektor' => 'Jaringan akses telekomunikasi', 'lokasi' => 'Sumatera Utara',
            'layanan' => ['Penarikan kabel feeder', 'Instalasi closure', 'Pengujian'],
            'excerpt' => 'Pekerjaan penarikan kabel feeder sebagai penghubung jaringan utama ke titik distribusi.',
            'kebutuhan' => 'Diperlukan ruas kabel utama yang menghubungkan jaringan ke titik-titik distribusi dengan kapasitas serat yang cukup untuk pertumbuhan pelanggan.',
            'pendekatan' => 'Pelaksanaan dilakukan bertahap per ruas agar jaringan tetap terkelola, dengan penyambungan pada closure di titik-titik yang sudah ditetapkan dan pengujian di setiap akhir ruas.',
            'lingkup' => [
                'Pemasangan kabel feeder udara atau tanah',
                'Instalasi closure dan aksesoris',
                'Penyambungan serat (splicing)',
                'Pengukuran redaman tiap ruas',
                'Dokumentasi hasil pekerjaan',
            ],
            'gambar' => 'proyek/2-jaringan-backbone-feeder.jpg',
            'galeri' => ['proyek/2-jaringan-backbone-feeder.jpg', 'prod-1.jpg', 'proj-2.jpg'],
        ],
        [
            'id' => 3, 'slug' => 'jaringan-distribusi-udara',
            'nama' => 'Jaringan Distribusi Udara',
            'kategori' => 'Fiber Optik', 'sektor' => 'Jaringan distribusi', 'lokasi' => 'Kabupaten Simalungun',
            'layanan' => ['Pemasangan tiang & aksesoris', 'Penarikan kabel udara', 'Pemeriksaan jaringan'],
            'excerpt' => 'Pemasangan jaringan distribusi udara beserta tiang dan aksesoris penggantung kabel.',
            'kebutuhan' => 'Jaringan distribusi membutuhkan jalur udara yang aman, dengan tiang dan aksesoris yang mampu menahan beban kabel serta mudah diperiksa.',
            'pendekatan' => 'Kami menetapkan titik tiang berdasarkan jarak dan kondisi lapangan, memasang aksesoris penggantung, lalu menarik kabel dengan tegangan tarik sesuai anjuran agar serat tidak mengalami penekanan berlebih.',
            'lingkup' => [
                'Penetapan titik dan jarak antar tiang',
                'Pemasangan tiang dan aksesoris',
                'Penarikan kabel udara',
                'Perapian dan penandaan aset jaringan',
                'Pemeriksaan kestabilan jaringan',
            ],
            'gambar' => 'proyek/3-jaringan-distribusi-udara.jpg',
            'galeri' => ['proyek/3-jaringan-distribusi-udara.jpg', 'proj-2.jpg', 'prod-4.jpg'],
        ],
        [
            'id' => 4, 'slug' => 'konstruksi-gedung-operasional',
            'nama' => 'Konstruksi Gedung Operasional',
            'kategori' => 'Konstruksi Gedung', 'sektor' => 'Bangunan komersial', 'lokasi' => 'Sumatera Utara',
            'layanan' => ['Pekerjaan struktur', 'Arsitektur', 'Finishing'],
            'excerpt' => 'Pelaksanaan pembangunan gedung operasional mulai dari pekerjaan struktur hingga penyelesaian akhir.',
            'kebutuhan' => 'Pemilik pekerjaan memerlukan bangunan operasional yang selesai sesuai jadwal, dengan mutu struktur yang dapat dipertanggungjawabkan.',
            'pendekatan' => 'Pekerjaan dijalankan berdasarkan gambar kerja dan urutan tahap yang jelas, dengan pemeriksaan mutu pada setiap tahap serta laporan progres kepada pemilik pekerjaan.',
            'lingkup' => [
                'Pekerjaan persiapan dan pengukuran',
                'Pekerjaan pondasi dan struktur',
                'Pekerjaan dinding, atap, dan lantai',
                'Instalasi utilitas dasar',
                'Penyelesaian akhir (finishing)',
                'Pemeriksaan bersama sebelum serah terima',
            ],
            'gambar' => 'proyek/4-konstruksi-gedung-operasional.jpg',
            'galeri' => ['proyek/4-konstruksi-gedung-operasional.jpg', 'prod-6.jpg', 'proj-4.jpg'],
        ],
        [
            'id' => 5, 'slug' => 'konstruksi-gudang-industri',
            'nama' => 'Konstruksi Gudang & Bangunan Industri',
            'kategori' => 'Konstruksi Gedung', 'sektor' => 'Industri & pergudangan', 'lokasi' => 'Sumatera Utara',
            'layanan' => ['Struktur baja', 'Pekerjaan lantai kerja', 'Penyelesaian bangunan'],
            'excerpt' => 'Pembangunan bangunan gudang dengan struktur baja dan area kerja yang luas serta aman.',
            'kebutuhan' => 'Kegiatan penyimpanan memerlukan bangunan luas tanpa banyak sekat, dengan struktur yang kuat menahan beban dan sirkulasi kendaraan yang lancar.',
            'pendekatan' => 'Struktur baja dipilih sesuai pentingnya bentang, sementara urutan pemasangan disusun agar pekerjaan sipil dan pemasangan rangka dapat berjalan tanpa saling menghambat.',
            'lingkup' => [
                'Penyiapan lahan dan pekerjaan lantai kerja',
                'Pemasangan struktur baja',
                'Pekerjaan atap dan dinding',
                'Area bongkar muat dan jalan kerja',
                'Pekerjaan penunjang dan perapian',
            ],
            'gambar' => 'proyek/5-konstruksi-gudang-industri.jpg',
            'galeri' => ['proyek/5-konstruksi-gudang-industri.jpg', 'prod-6.jpg', 'prod-11.jpg'],
        ],
        [
            'id' => 6, 'slug' => 'pekerjaan-lahan-pondasi-sipil',
            'nama' => 'Pekerjaan Lahan, Pondasi & Sipil',
            'kategori' => 'Pekerjaan Sipil', 'sektor' => 'Pekerjaan persiapan & sipil', 'lokasi' => 'Sumatera Utara',
            'layanan' => ['Pembersihan lahan', 'Galian & pondasi', 'Pekerjaan drainase'],
            'excerpt' => 'Pekerjaan persiapan lahan, galian, pondasi, dan drainase sebagai dasar pekerjaan bangunan.',
            'kebutuhan' => 'Sebelum pekerjaan bangunan dimulai, lahan perlu disiapkan dengan pengukuran yang tepat dan drainase yang mencegah genangan pada area kerja.',
            'pendekatan' => 'Pekerjaan dimulai dari pengukuran dan pembersihan lahan, dilanjutkan galian serta pondasi sesuai gambar, dan dilengkapi saluran air agar area kerja tetap kering.',
            'lingkup' => [
                'Pengukuran dan pembersihan lahan',
                'Pekerjaan galian dan urugan',
                'Pekerjaan pondasi',
                'Saluran drainase sementara dan permanen',
                'Perapian dan pembersihan akhir',
            ],
            'gambar' => 'proyek/6-pekerjaan-lahan-pondasi-sipil.jpg',
            'galeri' => ['proyek/6-pekerjaan-lahan-pondasi-sipil.jpg', 'prod-7.jpg', 'prod-12.jpg'],
        ],
        [
            'id' => 7, 'slug' => 'renovasi-bangunan',
            'nama' => 'Renovasi & Penataan Bangunan',
            'kategori' => 'Konstruksi Gedung', 'sektor' => 'Perkantoran & komersial', 'lokasi' => 'Sumatera Utara',
            'layanan' => ['Perbaikan struktur', 'Perubahan tata ruang', 'Finishing'],
            'excerpt' => 'Pekerjaan renovasi bangunan yang sudah beroperasi dengan gangguan kegiatan seminimal mungkin.',
            'kebutuhan' => 'Bangunan lama memerlukan perbaikan dan penyesuaian tata ruang tanpa menghentikan seluruh kegiatan penghuninya.',
            'pendekatan' => 'Pekerjaan dibagi per zona dan dijadwalkan bersama pemilik pekerjaan, sehingga kegiatan pada area lain tetap dapat berjalan selama renovasi.',
            'lingkup' => [
                'Pemeriksaan kondisi awal bangunan',
                'Perbaikan bagian yang rusak',
                'Perubahan tata ruang & sekat',
                'Perbaikan atap, dinding, dan lantai',
                'Pengecatan dan penyelesaian akhir',
            ],
            'gambar' => 'proyek/7-renovasi-bangunan.jpg',
            'galeri' => ['proyek/7-renovasi-bangunan.jpg', 'prod-7.jpg', 'proj-3.jpg'],
        ],
        [
            'id' => 8, 'slug' => 'desain-drafter-perencanaan',
            'nama' => 'Desain & Drafter Perencanaan',
            'kategori' => 'Desain & Drafter', 'sektor' => 'Perencanaan teknis', 'lokasi' => 'Sumatera Utara',
            'layanan' => ['Gambar kerja', 'Perhitungan volume', 'Shop drawing'],
            'excerpt' => 'Penyusunan gambar perencanaan dan gambar kerja yang siap dipakai untuk pelaksanaan di lapangan.',
            'kebutuhan' => 'Pelaksanaan pekerjaan memerlukan gambar yang jelas, terukur, dan mudah dibaca tukang di lapangan agar tidak menimbulkan pekerjaan ulang.',
            'pendekatan' => 'Kami mengumpulkan data lapangan lebih dulu, menyusun gambar mengikuti standar penggambaran teknik, lalu menyertakan perhitungan volume agar kebutuhan material dapat direncanakan.',
            'lingkup' => [
                'Pengumpulan data dan pengukuran lapangan',
                'Gambar perencanaan (DED)',
                'Shop drawing untuk pelaksanaan',
                'Perhitungan volume dan kebutuhan material',
                'Penyusunan gambar akhir (as-built)',
            ],
            'gambar' => 'proyek/8-desain-drafter-perencanaan.jpg',
            'galeri' => ['proyek/8-desain-drafter-perencanaan.jpg', 'prod-10.jpg', 'prod-8.jpg'],
        ],
        [
            'id' => 9, 'slug' => 'manajemen-data-konstruksi',
            'nama' => 'Manajemen Data Konstruksi',
            'kategori' => 'Manajemen Data', 'sektor' => 'Administrasi teknis proyek', 'lokasi' => 'Sumatera Utara',
            'layanan' => ['Pendataan volume', 'Dokumentasi progres', 'Pelaporan'],
            'excerpt' => 'Penataan data pekerjaan: volume, dokumentasi lapangan, dan laporan progres yang rapi dan mudah diperiksa.',
            'kebutuhan' => 'Pelaksanaan pekerjaan sering terkendala data yang terpisah-pisah, sehingga progres sulit diperiksa dan laporan terlambat disusun.',
            'pendekatan' => 'Data lapangan dikumpulkan dengan format yang seragam sejak awal pekerjaan, kemudian diolah menjadi laporan progres berkala beserta arsip dokumennya.',
            'lingkup' => [
                'Penyusunan format data & pelaporan',
                'Pendataan volume pekerjaan',
                'Dokumentasi foto progres lapangan',
                'Laporan berkala kepada pemilik pekerjaan',
                'Pengarsipan dokumen pelaksanaan',
            ],
            'gambar' => 'proyek/9-manajemen-data-konstruksi.jpg',
            'galeri' => ['proyek/9-manajemen-data-konstruksi.jpg', 'proj-6.jpg', 'prod-8.jpg'],
        ],
    ];
}

function project_categories(): array
{
    $kategori = [];
    foreach (projects() as $p) {
        $kategori[$p['kategori']] = ($kategori[$p['kategori']] ?? 0) + 1;
    }
    return $kategori;
}

function project_by_id($id): ?array
{
    foreach (projects() as $p) {
        if ((string) $p['id'] === (string) $id || $p['slug'] === (string) $id) {
            return $p;
        }
    }
    return null;
}

/** Katalog jasa & material (fungsi products() dipakai oleh katalog.php / produk.php). */
function products(): array
{
    return [
        [
            'id' => 1, 'kode' => 'FO-01', 'kategori' => 'Jasa Fiber Optik', 'badge' => 'Layanan utama',
            'nama' => 'Instalasi Jaringan Fiber Optik (FTTH)',
            'excerpt' => 'Pelaksanaan jaringan fiber optik sampai ke titik pelanggan, termasuk pengukuran jalur dan pengujian.',
            'deskripsi' => 'Pekerjaan instalasi jaringan fiber optik dari titik distribusi hingga ke titik pengguna. Lingkup dan biaya ditentukan setelah pengukuran jalur dan penetapan jumlah titik, sehingga hasilnya sesuai kondisi lapangan.',
            'cakupan' => ['Pengukuran dan penandaan jalur', 'Penarikan kabel distribusi & drop', 'Pemasangan titik distribusi', 'Splicing dan pengujian OTDR', 'Berita acara hasil pekerjaan'],
            'spesifikasi' => ['Sifat pekerjaan' => 'Berdasarkan lingkup di lapangan', 'Dasar perhitungan' => 'Jumlah titik & panjang jalur', 'Penawaran' => 'BOQ dan RAB resmi'],
            'gambar' => 'prod-3.jpg',
        ],
        [
            'id' => 2, 'kode' => 'FO-02', 'kategori' => 'Jasa Fiber Optik', 'badge' => '',
            'nama' => 'Penarikan Kabel Feeder & Backbone',
            'excerpt' => 'Penarikan kabel utama penghubung jaringan ke titik distribusi, beserta pemasangan closure.',
            'deskripsi' => 'Pekerjaan penarikan kabel feeder maupun backbone sebagai jalur utama jaringan, dilengkapi penyambungan di titik closure dan pengujian redaman setiap ruas.',
            'cakupan' => ['Penarikan kabel udara atau tanah', 'Pemasangan closure & aksesoris', 'Penyambungan serat', 'Pengukuran redaman per ruas'],
            'spesifikasi' => ['Sifat pekerjaan' => 'Per ruas / per proyek', 'Metode' => 'Udara atau bawah tanah', 'Penawaran' => 'BOQ dan RAB resmi'],
            'gambar' => 'prod-1.jpg',
        ],
        [
            'id' => 3, 'kode' => 'FO-03', 'kategori' => 'Jasa Fiber Optik', 'badge' => '',
            'nama' => 'Splicing & Pengujian OTDR',
            'excerpt' => 'Penyambungan serat optik dan pengujian kualitas jaringan menggunakan OTDR beserta laporannya.',
            'deskripsi' => 'Jasa penyambungan serat optik dengan alat fusion splicer serta pengujian kualitas sambungan dan redaman jalur. Hasil pengujian diserahkan dalam bentuk laporan agar mudah diperiksa.',
            'cakupan' => ['Penyambungan serat (fusion splicer)', 'Pengukuran redaman', 'Pengujian OTDR', 'Perbaikan sambungan bermasalah', 'Laporan hasil pengujian'],
            'spesifikasi' => ['Satuan' => 'Per titik sambung / per ruas', 'Hasil' => 'Laporan pengujian', 'Penawaran' => 'Sesuai jumlah titik'],
            'gambar' => 'prod-4.jpg',
        ],
        [
            'id' => 4, 'kode' => 'FO-04', 'kategori' => 'Jasa Fiber Optik', 'badge' => '',
            'nama' => 'Instalasi ODP / OTB',
            'excerpt' => 'Pemasangan dan penataan perangkat distribusi optik beserta pemasangan splitter dan perapi kabel.',
            'deskripsi' => 'Pemasangan titik distribusi optik (ODP) maupun terminal (OTB), termasuk penataan kabel dan pemasangan splitter agar jaringan mudah diperiksa dan dirawat.',
            'cakupan' => ['Pemasangan boks distribusi', 'Pemasangan splitter & pigtail', 'Penataan dan penandaan kabel', 'Uji fungsi tiap port'],
            'spesifikasi' => ['Satuan' => 'Per unit terpasang', 'Posisi' => 'Udara atau di dalam gedung', 'Penawaran' => 'Sesuai jumlah unit'],
            'gambar' => 'prod-2.jpg',
        ],
        [
            'id' => 5, 'kode' => 'FO-05', 'kategori' => 'Jasa Fiber Optik', 'badge' => '',
            'nama' => 'Pemeliharaan & Perbaikan Jaringan',
            'excerpt' => 'Pemeriksaan berkala dan perbaikan gangguan jaringan fiber optik yang sudah terpasang.',
            'deskripsi' => 'Layanan pemeliharaan jaringan fiber optik, baik pemeriksaan berkala maupun penanganan gangguan. Penelusuran masalah dilakukan dengan pengujian agar perbaikan tepat sasaran.',
            'cakupan' => ['Pemeriksaan jaringan berkala', 'Penelusuran gangguan (troubleshooting)', 'Perbaikan kabel dan sambungan', 'Penggantian aksesoris', 'Laporan kondisi jaringan'],
            'spesifikasi' => ['Sifat pekerjaan' => 'Berkala atau sesuai gangguan', 'Cakupan' => 'Sesuai area jaringan', 'Penawaran' => 'Per kunjungan / per kontrak'],
            'gambar' => 'prod-9.jpg',
        ],
        [
            'id' => 6, 'kode' => 'MT-01', 'kategori' => 'Material & Perangkat', 'badge' => '',
            'nama' => 'Kabel Fiber Optik',
            'excerpt' => 'Pengadaan kabel fiber optik untuk kebutuhan jaringan udara maupun bawah tanah.',
            'deskripsi' => 'Penyediaan kabel fiber optik sesuai kebutuhan jaringan, dengan jumlah core dan jenis pelindung yang disesuaikan kondisi pemasangan.',
            'cakupan' => ['Kabel udara (self supporting)', 'Kabel bawah tanah', 'Berbagai jumlah core', 'Pengiriman ke lokasi pekerjaan'],
            'spesifikasi' => ['Satuan' => 'Meter / roll', 'Jenis' => 'Sesuai kebutuhan pemasangan', 'Penawaran' => 'Sesuai volume kebutuhan'],
            'gambar' => 'proj-8.jpg',
        ],
        [
            'id' => 7, 'kode' => 'MT-02', 'kategori' => 'Material & Perangkat', 'badge' => '',
            'nama' => 'Closure & Aksesoris Jaringan',
            'excerpt' => 'Pengadaan closure, aksesoris penggantung, dan kelengkapan penyambungan kabel.',
            'deskripsi' => 'Penyediaan perlengkapan jaringan optik berupa closure penyambungan dan aksesoris pendukung, dipilih menyesuaikan jenis serta kapasitas kabel yang dipakai.',
            'cakupan' => ['Closure penyambungan', 'Aksesoris penggantung kabel', 'Perapi dan pelindung serat', 'Kelengkapan penandaan'],
            'spesifikasi' => ['Satuan' => 'Unit / set', 'Pemilihan' => 'Sesuai jenis kabel', 'Penawaran' => 'Sesuai jumlah kebutuhan'],
            'gambar' => 'prod-13.jpg',
        ],
        [
            'id' => 8, 'kode' => 'MT-03', 'kategori' => 'Material & Perangkat', 'badge' => '',
            'nama' => 'Perangkat Pasif & Patch Cord',
            'excerpt' => 'Pengadaan pigtail, patch cord, splitter, dan perangkat pasif jaringan optik lainnya.',
            'deskripsi' => 'Penyediaan perangkat pasif jaringan optik beserta kabel penghubung (patch cord) untuk kebutuhan instalasi baru maupun penggantian di pekerjaan pemeliharaan.',
            'cakupan' => ['Pigtail & patch cord', 'Splitter optik', 'Panel dan boks rak', 'Perlengkapan pengujian'],
            'spesifikasi' => ['Satuan' => 'Unit / set', 'Tipe konektor' => 'Sesuai jaringan terpasang', 'Penawaran' => 'Sesuai jumlah kebutuhan'],
            'gambar' => 'prod-14.jpg',
        ],
        [
            'id' => 9, 'kode' => 'KG-01', 'kategori' => 'Jasa Konstruksi', 'badge' => 'Layanan utama',
            'nama' => 'Pelaksanaan Konstruksi Gedung',
            'excerpt' => 'Pembangunan gedung dan bangunan baru, dari pekerjaan struktur sampai penyelesaian akhir.',
            'deskripsi' => 'Pelaksanaan pembangunan gedung sesuai gambar kerja: pekerjaan struktur, arsitektur, dan penyelesaian akhir. Urutan dan mutu pekerjaan diawasi pada setiap tahap dengan laporan progres berkala.',
            'cakupan' => ['Pekerjaan persiapan & pengukuran', 'Struktur dan pondasi', 'Dinding, atap, dan lantai', 'Instalasi utilitas dasar', 'Penyelesaian akhir & serah terima'],
            'spesifikasi' => ['Sifat pekerjaan' => 'Per proyek', 'Dasar pelaksanaan' => 'Gambar kerja & RAB', 'Penawaran' => 'BOQ dan RAB resmi'],
            'gambar' => 'prod-6.jpg',
        ],
        [
            'id' => 10, 'kode' => 'KG-02', 'kategori' => 'Jasa Konstruksi', 'badge' => '',
            'nama' => 'Renovasi & Perbaikan Bangunan',
            'excerpt' => 'Perbaikan bangunan yang sudah beroperasi, termasuk perubahan tata ruang dan penyelesaian akhir.',
            'deskripsi' => 'Pekerjaan renovasi dan perbaikan bangunan dengan penjadwalan per zona, sehingga kegiatan pada bagian bangunan yang lain tetap dapat berjalan selama pekerjaan berlangsung.',
            'cakupan' => ['Pemeriksaan kondisi bangunan', 'Perbaikan struktur & bagian rusak', 'Perubahan tata ruang', 'Pengecatan dan finishing'],
            'spesifikasi' => ['Sifat pekerjaan' => 'Per zona / per proyek', 'Waktu kerja' => 'Dapat dijadwalkan di luar jam operasional', 'Penawaran' => 'BOQ dan RAB resmi'],
            'gambar' => 'prod-7.jpg',
        ],
        [
            'id' => 11, 'kode' => 'KG-03', 'kategori' => 'Jasa Konstruksi', 'badge' => '',
            'nama' => 'Pekerjaan Sipil, Lahan & Drainase',
            'excerpt' => 'Penyiapan lahan, pekerjaan galian dan pondasi, serta pembuatan saluran air dan jalan kerja.',
            'deskripsi' => 'Pekerjaan sipil penunjang bangunan maupun kawasan: pembersihan lahan, galian, pondasi, saluran drainase, hingga jalan kerja di dalam area proyek.',
            'cakupan' => ['Pengukuran & pembersihan lahan', 'Galian, urugan, dan pondasi', 'Saluran drainase', 'Jalan kerja & area pengerasan', 'Perapian akhir'],
            'spesifikasi' => ['Sifat pekerjaan' => 'Per proyek', 'Alat' => 'Disesuaikan volume pekerjaan', 'Penawaran' => 'Sesuai volume pekerjaan'],
            'gambar' => 'prod-12.jpg',
        ],
        [
            'id' => 12, 'kode' => 'DS-01', 'kategori' => 'Desain & Drafter', 'badge' => '',
            'nama' => 'Desain & Drafter Perencanaan (DED)',
            'excerpt' => 'Penyusunan gambar perencanaan dan gambar kerja siap pelaksanaan beserta perhitungan volume.',
            'deskripsi' => 'Jasa penyusunan gambar perencanaan maupun gambar kerja untuk kebutuhan pelaksanaan di lapangan, dilengkapi perhitungan volume agar kebutuhan material dan biaya dapat direncanakan lebih awal.',
            'cakupan' => ['Pengumpulan data lapangan', 'Gambar perencanaan (DED)', 'Shop drawing pelaksanaan', 'Perhitungan volume & RAB'],
            'spesifikasi' => ['Keluaran' => 'Gambar PDF & file sumber', 'Skala' => 'Sesuai standar penggambaran teknik', 'Penawaran' => 'Sesuai luas & kerumitan pekerjaan'],
            'gambar' => 'proj-6.jpg',
        ],
        [
            'id' => 13, 'kode' => 'DS-02', 'kategori' => 'Desain & Drafter', 'badge' => '',
            'nama' => 'Shop Drawing & As-Built Drawing',
            'excerpt' => 'Gambar pelaksanaan untuk tukang di lapangan dan gambar akhir kondisi terpasang.',
            'deskripsi' => 'Penyusunan gambar pelaksanaan yang mudah dibaca di lapangan, serta gambar akhir (as-built) yang menggambarkan kondisi terpasang untuk keperluan arsip dan pemeliharaan.',
            'cakupan' => ['Gambar pelaksanaan per pekerjaan', 'Detail sambungan & potongan', 'Penyesuaian saat pelaksanaan', 'As-built drawing akhir proyek'],
            'spesifikasi' => ['Keluaran' => 'Gambar cetak & file sumber', 'Dasar' => 'Gambar perencanaan & kondisi lapangan', 'Penawaran' => 'Per paket pekerjaan'],
            'gambar' => 'prod-10.jpg',
        ],
        [
            'id' => 14, 'kode' => 'SV-01', 'kategori' => 'Manajemen & Survey', 'badge' => '',
            'nama' => 'Survey & Pengukuran Lapangan',
            'excerpt' => 'Pengukuran jalur jaringan maupun lahan bangunan sebagai dasar perencanaan dan pelaksanaan.',
            'deskripsi' => 'Pengukuran dan pendataan kondisi lapangan sebelum pekerjaan dimulai, mencakup jalur jaringan, batas lahan, dan titik-titik penting yang mempengaruhi pelaksanaan.',
            'cakupan' => ['Pengukuran jalur & titik instalasi', 'Pengukuran lahan bangunan', 'Pendataan kondisi eksisting', 'Rekomendasi teknis awal'],
            'spesifikasi' => ['Keluaran' => 'Data ukur & catatan lapangan', 'Alat' => 'Sesuai kebutuhan pengukuran', 'Penawaran' => 'Sesuai luas & lokasi'],
            'gambar' => 'prod-8.jpg',
        ],
        [
            'id' => 15, 'kode' => 'MD-01', 'kategori' => 'Manajemen & Survey', 'badge' => '',
            'nama' => 'Manajemen Pelaksanaan & Pengawasan',
            'excerpt' => 'Pengendalian pelaksanaan pekerjaan di lapangan: mutu, waktu, biaya, dan keselamatan kerja.',
            'deskripsi' => 'Pendampingan pelaksanaan pekerjaan agar berjalan sesuai rencana, mencakup pengendalian mutu, pemantauan jadwal, pencatatan volume, serta penerapan keselamatan kerja di lapangan.',
            'cakupan' => ['Penyusunan jadwal pelaksanaan', 'Pengendalian mutu pekerjaan', 'Pencatatan volume terpasang', 'Penerapan keselamatan kerja (K3)', 'Laporan progres berkala'],
            'spesifikasi' => ['Sifat layanan' => 'Per proyek / berkala', 'Laporan' => 'Berkala kepada pemilik pekerjaan', 'Penawaran' => 'Sesuai durasi & lingkup'],
            'gambar' => 'prod-5.jpg',
        ],
        [
            'id' => 16, 'kode' => 'MD-02', 'kategori' => 'Manajemen & Survey', 'badge' => '',
            'nama' => 'Manajemen Data Konstruksi',
            'excerpt' => 'Penataan data pekerjaan: volume, dokumentasi lapangan, dan pelaporan progres yang rapi.',
            'deskripsi' => 'Pengelolaan data pekerjaan konstruksi dengan format yang seragam sejak awal, sehingga progres mudah diperiksa dan laporan dapat disusun tepat waktu beserta arsip dokumennya.',
            'cakupan' => ['Penyusunan format data & pelaporan', 'Pendataan volume pekerjaan', 'Dokumentasi foto progres', 'Laporan berkala', 'Pengarsipan dokumen pelaksanaan'],
            'spesifikasi' => ['Sifat layanan' => 'Per proyek / berkala', 'Keluaran' => 'Basis data & laporan', 'Penawaran' => 'Sesuai lingkup pekerjaan'],
            'gambar' => 'prod-11.jpg',
        ],
    ];
}

function product_categories(): array
{
    $kategori = [];
    foreach (products() as $p) {
        $kategori[$p['kategori']] = ($kategori[$p['kategori']] ?? 0) + 1;
    }
    return $kategori;
}

function product_by_id($id): ?array
{
    foreach (products() as $p) {
        if ((string) $p['id'] === (string) $id || $p['kode'] === (string) $id) {
            return $p;
        }
    }
    return null;
}

/**
 * Pengalaman kerjasama (tabel di halaman Portofolio).
 *
 * PENTING: isi array ini HARUS berasal dari data resmi perusahaan (company profile /
 * dokumen tender). Jangan menambah nama pemberi kerja, proyek, atau tahun karangan —
 * situs ini sengaja tidak menampilkan klien/pengalaman fiktif.
 *
 * Format tiap baris:
 *   'pemberi'   => nama instansi/perusahaan pemberi kerja
 *   'pekerjaan' => jenis pekerjaan yang dikerjakan
 *   'tahun'     => tahun pelaksanaan (tulisan bebas, mis. '2024' atau '2023–2024')
 *   'lokasi'    => kabupaten/kota pelaksanaan
 *   'logo'      => OPSIONAL, nama berkas di assets/img/klien/ (mis. 'telkom.png').
 *                  Bila kosong/tidak ada, tabel menampilkan inisial nama instansi.
 *                  Hanya pakai logo resmi yang benar-benar dikirim perusahaan —
 *                  jangan mengambil/mengarang logo sendiri.
 *
 * Bila array kosong, seksi "Pengalaman kerjasama" tidak ditampilkan sama sekali di
 * portofolio.php (tidak ada tabel kosong di situs publik).
 */
function work_experience(): array
{
    return [
        [
            'pemberi'   => 'PT. Suma Dwi Techno',
            'logo'      => 'suma-dwi-techno.png',
            'pekerjaan' => 'Digitalisasi fiber optik lingkungan Universitas Negeri Medan',
            'tahun'     => '2022',
            'lokasi'    => 'Universitas Negeri Medan',
        ],
        [
            'pemberi'   => 'PT. Garindo Techno Mandiri',
            'logo'      => 'garindo-techno-mandiri.png',
            'pekerjaan' => 'Manage service pekerjaan provisioning, assurance, dan konstruksi — mitra kerjasama PT. Telkom Akses',
            'tahun'     => '2017–saat ini',
            'lokasi'    => 'Telkom Witel Sumut',
        ],
        [
            'pemberi'   => 'PT. Telkom Indonesia (Persero) Tbk',
            'logo'      => 'telkom-indonesia.png',
            'pekerjaan' => 'Mitra partnership penjualan IndiBiz dan IndiHome',
            'tahun'     => '2024',
            'lokasi'    => 'Telkom Witel Sumut',
        ],
        [
            'pemberi'   => 'Ucloudlink',
            'logo'      => 'ucloudlink.png',
            'pekerjaan' => 'Kerjasama pengembangan perangkat internet 4G & 5G SIM cloud',
            'tahun'     => '2024',
            'lokasi'    => 'Jakarta',
        ],
        [
            'pemberi'   => 'Logistik Polisi Daerah Sumatera Utara',
            'logo'      => 'polda-sumut.png',
            'pekerjaan' => 'Pembangunan Gedung K9',
            'tahun'     => '2024',
            'lokasi'    => 'Medan',
        ],
        [
            'pemberi'   => 'Logistik Polisi Daerah Sumatera Utara',
            'logo'      => 'polda-sumut.png',
            'pekerjaan' => 'Pembangunan fasilitas kolam renang',
            'tahun'     => '2024',
            'lokasi'    => 'Medan',
        ],
        [
            'pemberi'   => 'Logistik Polisi Daerah Sumatera Utara',
            'logo'      => 'polda-sumut.png',
            'pekerjaan' => 'Pembangunan Gedung Pos Polisi Satwa',
            'tahun'     => '2024',
            'lokasi'    => 'Medan',
        ],
        [
            'pemberi'   => 'Logistik Polisi Daerah Sumatera Utara',
            'logo'      => 'polda-sumut.png',
            'pekerjaan' => 'Perencanaan desain master plan pagar komplek Polda Sumut',
            'tahun'     => '2024',
            'lokasi'    => 'Medan',
        ],
        [
            'pemberi'   => 'Logistik Polisi Daerah Sumatera Utara',
            'logo'      => 'polda-sumut.png',
            'pekerjaan' => 'Pembangunan jalan aspal sekitar Gedung K9',
            'tahun'     => '2024',
            'lokasi'    => 'Medan',
        ],
        [
            'pemberi'   => 'Logistik Polisi Daerah Sumatera Utara',
            'logo'      => 'polda-sumut.png',
            'pekerjaan' => 'Pemasangan CCTV Gedung K9',
            'tahun'     => '2024',
            'lokasi'    => 'Medan',
        ],
    ];
}

/** Fakta singkat perusahaan (angka yang ditampilkan di halaman depan). */
function facts(): array
{
    return [
        ['angka' => (int) cfg('tahun_berdiri'), 'suffix' => '', 'label' => 'Tahun pendirian perusahaan'],
        ['angka' => 2, 'suffix' => '', 'label' => 'Bidang usaha utama'],
        ['angka' => count(services()), 'suffix' => '', 'label' => 'Lini layanan'],
        ['angka' => count(products()), 'suffix' => '', 'label' => 'Item jasa & material'],
    ];
}

/** Kapabilitas / kata kunci pekerjaan yang kami tangani. */
function keahlian(): array
{
    return [
        'Instalasi FTTH',
        'Jaringan Feeder & Backbone',
        'Splicing & OTDR',
        'Instalasi ODP / OTB',
        'Konstruksi Gedung',
        'Pekerjaan Sipil',
        'Drafter Perencanaan',
        'Manajemen Data Konstruksi',
    ];
}

function process_steps(): array
{
    return [
        ['no' => '01', 'judul' => 'Konsultasi & survey', 'desc' => 'Kami mendengarkan kebutuhan Anda, kemudian melakukan pengukuran serta pendataan kondisi lapangan.'],
        ['no' => '02', 'judul' => 'Perencanaan & penawaran', 'desc' => 'Hasil survey diolah menjadi gambar kerja, volume pekerjaan, dan penawaran resmi berisi rincian biaya.'],
        ['no' => '03', 'judul' => 'Pelaksanaan pekerjaan', 'desc' => 'Pekerjaan dijalankan sesuai jadwal dengan pengendalian mutu, keselamatan kerja, dan laporan progres.'],
        ['no' => '04', 'judul' => 'Pengujian & serah terima', 'desc' => 'Hasil pekerjaan diuji dan diperiksa bersama, dilengkapi berita acara serta dokumen pekerjaan.'],
    ];
}
