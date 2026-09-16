<?php
require_once __DIR__ . '/inc/init.php';

$q = isset($_GET['q']) ? trim((string) $_GET['q']) : '';
$kategori_aktif = isset($_GET['kategori']) ? trim((string) $_GET['kategori']) : '';
$urut = isset($_GET['urut']) ? (string) $_GET['urut'] : 'unggulan';
$kategori_tersedia = product_categories();

$daftar = products();

if ($kategori_aktif !== '' && isset($kategori_tersedia[$kategori_aktif])) {
    $daftar = array_values(array_filter($daftar, fn($p) => $p['kategori'] === $kategori_aktif));
} else {
    $kategori_aktif = '';
}

if ($q !== '') {
    $needle = mb_strtolower($q);
    $daftar = array_values(array_filter($daftar, function ($p) use ($needle) {
        $teks = mb_strtolower($p['nama'] . ' ' . $p['excerpt'] . ' ' . $p['kategori'] . ' ' . $p['kode']);
        return mb_strpos($teks, $needle) !== false;
    }));
}

if ($urut === 'nama') {
    usort($daftar, fn($a, $b) => strcmp($a['nama'], $b['nama']));
} elseif ($urut === 'kategori') {
    usort($daftar, fn($a, $b) => strcmp($a['kategori'], $b['kategori']));
} elseif ($urut === 'kode') {
    usort($daftar, fn($a, $b) => strcmp($a['kode'], $b['kode']));
}

function katalog_url(array $ubah = []): string
{
    $params = array_merge([
        'q'        => $_GET['q'] ?? '',
        'kategori' => $_GET['kategori'] ?? '',
        'urut'     => $_GET['urut'] ?? '',
    ], $ubah);
    $params = array_filter($params, fn($v) => $v !== '' && $v !== null);
    return 'katalog.php' . ($params ? '?' . http_build_query($params) : '');
}

$page_title = 'Katalog Jasa & Material';
$page_desc = 'Katalog jasa dan material PT. Alfatih Techno Mandiri: instalasi jaringan fiber optik, konstruksi gedung, pekerjaan sipil, desain & drafter, serta survey dan manajemen data konstruksi.';
require __DIR__ . '/inc/header.php';
?>

<section class="page-hero">
  <div class="container">
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <a href="index.php">Home</a><span>/</span><span>Katalog Jasa &amp; Material</span>
    </nav>
    <h1>Katalog jasa &amp; material</h1>
    <p>Pilih pekerjaan atau material yang Anda butuhkan, lalu ajukan permintaan penawaran. Karena setiap pekerjaan berbeda, harga dihitung berdasarkan lingkup, volume, dan kondisi lapangan setelah survey.</p>
    <div class="page-hero-stats">
      <span><?= icon('clipboard', 16) ?> <?= count(products()) ?> item jasa &amp; material</span>
      <span><?= icon('compass', 16) ?> Survey lokasi sebelum penawaran</span>
      <span><?= icon('file', 16) ?> Penawaran resmi berisi volume pekerjaan</span>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <form class="catalog-toolbar" method="get" action="katalog.php">
      <?php if ($kategori_aktif !== ''): ?>
        <input type="hidden" name="kategori" value="<?= e($kategori_aktif) ?>">
      <?php endif; ?>
      <div class="search-field">
        <?= icon('search', 18) ?>
        <input type="search" name="q" value="<?= e($q) ?>" placeholder="Cari pekerjaan atau material, misalnya: fiber optik, pondasi" aria-label="Cari item katalog">
      </div>
      <div class="toolbar-right">
        <label class="select-field">
          <span>Urutkan</span>
          <select name="urut" onchange="this.form.submit()">
            <option value="unggulan" <?= $urut === 'unggulan' ? 'selected' : '' ?>>Paling sering diminta</option>
            <option value="nama" <?= $urut === 'nama' ? 'selected' : '' ?>>Nama A–Z</option>
            <option value="kategori" <?= $urut === 'kategori' ? 'selected' : '' ?>>Kategori</option>
            <option value="kode" <?= $urut === 'kode' ? 'selected' : '' ?>>Kode item</option>
          </select>
        </label>
        <button class="btn btn-primary" type="submit"><?= icon('search', 18) ?> Cari</button>
      </div>
    </form>

    <div class="filter-bar">
      <div class="chip-row">
        <a class="chip <?= $kategori_aktif === '' ? 'is-active' : '' ?>" href="<?= e(katalog_url(['kategori' => ''])) ?>">Semua <span><?= count(products()) ?></span></a>
        <?php foreach ($kategori_tersedia as $nama => $jumlah): ?>
          <a class="chip <?= $kategori_aktif === $nama ? 'is-active' : '' ?>" href="<?= e(katalog_url(['kategori' => $nama])) ?>"><?= e($nama) ?> <span><?= $jumlah ?></span></a>
        <?php endforeach; ?>
      </div>
      <p class="filter-count">
        Menampilkan <strong><?= count($daftar) ?></strong> item<?= $q !== '' ? ' untuk pencarian “' . e($q) . '”' : '' ?><?= $kategori_aktif !== '' ? ' kategori ' . e($kategori_aktif) : '' ?>.
      </p>
    </div>

    <?php if (!$daftar): ?>
      <div class="empty-state">
        <?= icon('search', 28) ?>
        <h3>Item tidak ditemukan</h3>
        <p>Coba gunakan kata kunci lain, atau jelajahi seluruh kategori yang tersedia.</p>
        <a class="btn btn-primary" href="katalog.php">Lihat semua item</a>
      </div>
    <?php else: ?>
      <div class="grid grid-3">
        <?php foreach ($daftar as $p): ?>
          <article class="card product-card">
            <a class="product-media" href="produk.php?id=<?= (int) $p['id'] ?>">
              <img src="<?= e(img_url($p['gambar'])) ?>" alt="<?= e($p['nama']) ?>" loading="lazy">
              <?php if ($p['badge'] !== ''): ?><span class="badge"><?= e($p['badge']) ?></span><?php endif; ?>
            </a>
            <div class="product-body">
              <span class="product-cat"><?= e($p['kategori']) ?> &middot; <?= e($p['kode']) ?></span>
              <h3><a href="produk.php?id=<?= (int) $p['id'] ?>"><?= e($p['nama']) ?></a></h3>
              <p><?= e(excerpt($p['excerpt'], 100)) ?></p>
              <ul class="mini-list">
                <?php foreach (array_slice($p['cakupan'], 0, 2) as $butir): ?>
                  <li><?= icon('check', 14) ?><?= e($butir) ?></li>
                <?php endforeach; ?>
              </ul>
              <div class="product-foot">
                <span class="quote-note"><?= icon('clipboard', 15) ?> Harga sesuai lingkup</span>
                <a class="btn btn-primary btn-sm" href="produk.php?id=<?= (int) $p['id'] ?>"><?= icon('mail', 15) ?> Ajukan</a>
              </div>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>

<section class="section section-alt">
  <div class="container">
    <div class="section-head">
      <span class="eyebrow">Cara mengajukan</span>
      <h2 class="section-title">Tiga langkah sampai penawaran diterima</h2>
      <p class="section-lead">Permintaan Anda tercatat pada sistem kami dan diteruskan ke tim untuk ditindaklanjuti.</p>
    </div>
    <div class="grid grid-3 steps">
      <div class="step">
        <span class="step-no">01</span>
        <h3>Pilih item</h3>
        <p>Telusuri katalog, buka detail untuk melihat cakupan pekerjaan, lalu tekan tombol “Ajukan Penawaran”.</p>
      </div>
      <div class="step">
        <span class="step-no">02</span>
        <h3>Isi formulir permintaan</h3>
        <p>Lengkapi nama, kontak, lokasi pekerjaan, dan perkiraan volume. Tidak perlu membuat akun.</p>
      </div>
      <div class="step">
        <span class="step-no">03</span>
        <h3>Survey &amp; penawaran</h3>
        <p>Tim kami menghubungi Anda, melakukan survey bila diperlukan, lalu mengirim penawaran resmi.</p>
      </div>
    </div>
  </div>
</section>

<?php
$cta_judul = 'Butuh pekerjaan yang belum ada di katalog?';
$cta_teks = 'Kirimkan kebutuhan spesifik Anda. Kami sesuaikan lingkup kerja, metode pelaksanaan, dan penawaran dengan kondisi lapangan.';
require __DIR__ . '/inc/cta.php';
?>
<?php require __DIR__ . '/inc/footer.php'; ?>
