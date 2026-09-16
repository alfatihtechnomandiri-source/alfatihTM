<?php
require_once __DIR__ . '/inc/init.php';

$proyek = project_by_id($_GET['id'] ?? '');
if (!$proyek) {
    http_response_code(404);
    $page_title = 'Pekerjaan tidak ditemukan';
    $page_desc = 'Lingkup pekerjaan yang Anda cari tidak tersedia.';
    require __DIR__ . '/inc/header.php';
    ?>
    <section class="page-hero">
      <div class="container">
        <nav class="breadcrumb"><a href="index.php">Home</a><span>/</span><a href="portofolio.php">Portofolio</a><span>/</span><span>Tidak ditemukan</span></nav>
        <h1>Lingkup pekerjaan tidak ditemukan</h1>
        <p>Halaman yang Anda cari mungkin sudah dipindahkan. Silakan lihat daftar lingkup pekerjaan kami.</p>
      </div>
    </section>
    <section class="section">
      <div class="container">
        <div class="empty-state">
          <?= icon('search', 28) ?>
          <h3>Halaman yang diminta tidak tersedia</h3>
          <p>Kembali ke halaman portofolio untuk melihat seluruh lingkup pekerjaan.</p>
          <a class="btn btn-primary" href="portofolio.php"><?= icon('arrow-left', 18) ?> Kembali ke portofolio</a>
        </div>
      </div>
    </section>
    <?php
    require __DIR__ . '/inc/footer.php';
    exit;
}

$semua = projects();
$index = 0;
foreach ($semua as $i => $p) {
    if ($p['id'] === $proyek['id']) {
        $index = $i;
    }
}
$sebelumnya = $semua[($index - 1 + count($semua)) % count($semua)];
$berikutnya = $semua[($index + 1) % count($semua)];

$page_title = $proyek['nama'];
$page_desc = $proyek['excerpt'];
require __DIR__ . '/inc/header.php';
?>

<section class="page-hero project-hero">
  <div class="container">
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <a href="index.php">Home</a><span>/</span><a href="portofolio.php">Portofolio</a><span>/</span><span><?= e($proyek['kategori']) ?></span>
    </nav>
    <span class="hero-badge"><?= icon('layers', 15) ?> <?= e($proyek['kategori']) ?></span>
    <h1><?= e($proyek['nama']) ?></h1>
    <p><?= e($proyek['excerpt']) ?></p>
    <div class="page-hero-stats">
      <span><?= icon('building', 16) ?> <?= e($proyek['sektor']) ?></span>
      <span><?= icon('pin', 16) ?> <?= e($proyek['lokasi']) ?></span>
      <span><?= icon('clipboard', 16) ?> <?= count($proyek['lingkup']) ?> butir lingkup kerja</span>
    </div>
  </div>
</section>

<section class="section-tight">
  <div class="container">
    <figure class="detail-cover">
      <img src="<?= e(img_url($proyek['gambar'])) ?>" alt="<?= e($proyek['nama']) ?>" fetchpriority="high">
    </figure>
  </div>
</section>

<section class="section section-top-none">
  <div class="container detail-grid">
    <div class="detail-main">
      <div class="prose">
        <h2><span class="num">01</span> Kebutuhan pekerjaan</h2>
        <p><?= e($proyek['kebutuhan']) ?></p>

        <h2><span class="num">02</span> Pendekatan kami</h2>
        <p><?= e($proyek['pendekatan']) ?></p>
      </div>

      <div class="result-section">
        <h2><span class="num">03</span> Ruang lingkup pekerjaan</h2>
        <ul class="scope-list">
          <?php foreach ($proyek['lingkup'] as $butir): ?>
            <li><?= icon('check', 16) ?><span><?= e($butir) ?></span></li>
          <?php endforeach; ?>
        </ul>
      </div>

      <div class="gallery-section">
        <h2>Galeri</h2>
        <div class="gallery-grid">
          <?php foreach ($proyek['galeri'] as $n => $file): ?>
            <button type="button" class="gallery-item" data-lightbox="<?= e(img_url($file)) ?>" data-caption="<?= e($proyek['nama']) ?> — gambar <?= (int) ($n + 1) ?>">
              <img src="<?= e(img_url($file)) ?>" alt="<?= e($proyek['nama']) ?> gambar <?= (int) ($n + 1) ?>" loading="lazy">
            </button>
          <?php endforeach; ?>
        </div>
        <p class="gallery-hint"><?= icon('search', 15) ?> Klik gambar untuk melihat ukuran penuh.</p>
      </div>

      <div class="detail-nav">
        <a class="detail-nav-item prev" href="proyek.php?id=<?= (int) $sebelumnya['id'] ?>">
          <span class="detail-nav-label"><?= icon('arrow-left', 16) ?> Sebelumnya</span>
          <strong><?= e($sebelumnya['nama']) ?></strong>
        </a>
        <a class="detail-nav-item next" href="proyek.php?id=<?= (int) $berikutnya['id'] ?>">
          <span class="detail-nav-label">Berikutnya <?= icon('arrow', 16) ?></span>
          <strong><?= e($berikutnya['nama']) ?></strong>
        </a>
      </div>
    </div>

    <aside class="detail-side">
      <div class="card side-card">
        <h3>Ringkasan pekerjaan</h3>
        <dl class="side-list">
          <div><dt>Kategori</dt><dd><?= e($proyek['kategori']) ?></dd></div>
          <div><dt>Sektor</dt><dd><?= e($proyek['sektor']) ?></dd></div>
          <div><dt>Wilayah</dt><dd><?= e($proyek['lokasi']) ?></dd></div>
          <div><dt>Pelaksana</dt><dd><?= e(cfg('nama_legal')) ?></dd></div>
        </dl>
        <h4 class="side-sub">Pekerjaan yang termasuk</h4>
        <ul class="tag-list">
          <?php foreach ($proyek['layanan'] as $layanan): ?>
            <li class="tag"><?= e($layanan) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>

      <div class="card side-card side-cta">
        <h3>Butuh pekerjaan serupa?</h3>
        <p>Kirimkan lokasi dan kebutuhan Anda, kami lakukan survey lalu menyusun penawaran beserta volume pekerjaan.</p>
        <a class="btn btn-primary btn-block" href="kontak.php?topik=<?= e(urlencode($proyek['nama'])) ?>"><?= icon('mail', 18) ?> Minta Penawaran</a>
        <a class="btn btn-outline btn-block" href="<?= e(wa_link('Halo ' . cfg('nama') . ', saya ingin menanyakan pekerjaan "' . $proyek['nama'] . '".')) ?>" target="_blank" rel="noopener"><?= icon('whatsapp', 18) ?> Tanya via WhatsApp</a>
      </div>

      <div class="card side-card side-list-card">
        <h3>Lingkup pekerjaan lain</h3>
        <ul class="side-projects">
          <?php foreach ($semua as $lain): ?>
            <?php if ($lain['id'] === $proyek['id']) { continue; } ?>
            <li>
              <a href="proyek.php?id=<?= (int) $lain['id'] ?>">
                <img src="<?= e(img_url($lain['gambar'])) ?>" alt="" loading="lazy">
                <span><strong><?= e($lain['nama']) ?></strong><small><?= e($lain['kategori']) ?></small></span>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </aside>
  </div>
</section>

<div class="lightbox" id="lightbox" hidden>
  <button type="button" class="lightbox-close" data-lightbox-close aria-label="Tutup"><?= icon('close', 22) ?></button>
  <figure>
    <img alt="" id="lightboxImg">
    <figcaption id="lightboxCaption"></figcaption>
  </figure>
</div>

<?php
$cta_judul = 'Siap mengerjakan pekerjaan fiber optik atau konstruksi Anda.';
$cta_teks = 'Hubungi kami untuk survey lokasi dan penyusunan penawaran sesuai volume pekerjaan yang dibutuhkan.';
require __DIR__ . '/inc/cta.php';
?>
<?php require __DIR__ . '/inc/footer.php'; ?>
