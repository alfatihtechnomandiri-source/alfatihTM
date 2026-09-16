<?php
require_once __DIR__ . '/inc/init.php';

$page_title = 'Tentang Kami';
$page_desc = 'Profil PT. Alfatih Techno Mandiri: perusahaan berbadan hukum Perseroan Terbatas yang bergerak di bidang pelaksana konstruksi instalasi jaringan fiber optik dan konstruksi gedung/bangunan.';
require __DIR__ . '/inc/header.php';
?>

<section class="page-hero">
  <div class="container">
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <a href="index.php">Home</a><span>/</span><span>Tentang Kami</span>
    </nav>
    <h1>Profil <?= e(cfg('nama_legal')) ?></h1>
    <p>Perusahaan berbadan hukum Perseroan Terbatas yang didirikan pada <?= e(cfg('tanggal_berdiri')) ?> dan dikhususkan untuk pekerjaan instalasi jaringan fiber optik serta konstruksi gedung/bangunan.</p>
    <div class="page-hero-stats">
      <span><?= icon('shield', 16) ?> <?= e(cfg('legal')['badan_hukum']) ?></span>
      <span><?= icon('clock', 16) ?> Berdiri <?= e(cfg('tanggal_berdiri')) ?></span>
      <span><?= icon('pin', 16) ?> Simalungun, Sumatera Utara</span>
    </div>
  </div>
</section>

<section class="section">
  <div class="container about-grid">
    <div class="about-media about-media-wide">
      <img src="<?= e(img_url('tentang.jpg')) ?>" alt="Dokumentasi PT. Alfatih Techno Mandiri" loading="lazy">
      <div class="about-badge">
        <strong><?= date('Y') - (int) cfg('tahun_berdiri') ?> tahun</strong>
        <span>melayani pekerjaan konstruksi &amp; jaringan</span>
      </div>
    </div>
    <div class="about-copy">
      <span class="eyebrow">Tentang kami</span>
      <h2 class="section-title">Dikhususkan untuk pekerjaan fiber optik dan konstruksi bangunan.</h2>
      <p class="section-lead"><?= e(cfg('nama_legal')) ?> merupakan perusahaan berbadan hukum Perseroan Terbatas yang didirikan pada tanggal <?= e(cfg('tanggal_berdiri')) ?>. Perusahaan didirikan sebagai perusahaan yang dikhususkan untuk pengembangan usaha di bidang pelaksana konstruksi instalasi jaringan fiber optik dan konstruksi gedung/bangunan — mulai dari desain dan drafter perencanaan, pelaksana konstruksi, sampai manajemen data konstruksi.</p>
      <p>Bidang usaha tersebut tercantum pada akta pendirian perusahaan dan telah mendapat pengesahan dari Kementerian Hukum dan Hak Asasi Manusia Republik Indonesia, sehingga pekerjaan yang kami laksanakan berada dalam lingkup usaha yang sah dan dapat dipertanggungjawabkan.</p>
      <ul class="check-list">
        <li><?= icon('check', 16) ?><span><strong>Bidang fiber optik.</strong> Instalasi, penyambungan, pengujian, hingga pemeliharaan jaringan.</span></li>
        <li><?= icon('check', 16) ?><span><strong>Bidang konstruksi gedung.</strong> Pembangunan baru maupun renovasi sesuai gambar kerja.</span></li>
        <li><?= icon('check', 16) ?><span><strong>Perencanaan &amp; data.</strong> Drafter perencanaan serta penataan data pekerjaan konstruksi.</span></li>
      </ul>
      <div class="about-actions">
        <a class="btn btn-primary" href="katalog.php">Lihat Katalog Jasa &amp; Material <?= icon('arrow', 18) ?></a>
        <a class="link-arrow" href="kontak.php">Hubungi kami <?= icon('arrow', 16) ?></a>
      </div>
    </div>
  </div>
</section>

<section class="section section-alt">
  <div class="container">
    <div class="section-head">
      <span class="eyebrow">Visi &amp; Misi</span>
      <h2 class="section-title">Arah dan komitmen kami</h2>
      <p class="section-lead">Dasar pengambilan keputusan kami dalam mengerjakan setiap pekerjaan.</p>
    </div>

    <div class="vision-card">
      <span class="vision-label"><?= icon('target', 18) ?> Visi</span>
      <p><?= e(vision()) ?></p>
    </div>

    <h3 class="sub-heading">Misi</h3>
    <div class="grid grid-2 mission-grid">
      <?php foreach (missions() as $m): ?>
        <article class="card mission-card">
          <span class="icon-box"><?= icon($m['icon'], 22) ?></span>
          <h3><?= e($m['judul']) ?></h3>
          <p><?= e($m['desc']) ?></p>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="section-head">
      <span class="eyebrow">Bidang usaha</span>
      <h2 class="section-title">Lingkup usaha perusahaan</h2>
      <p class="section-lead">Tiga kelompok pekerjaan yang menjadi bidang usaha kami sesuai akta pendirian perusahaan.</p>
    </div>
    <div class="grid grid-3">
      <?php foreach (business_fields() as $bidang): ?>
        <article class="card service-card">
          <span class="icon-box"><?= icon($bidang['icon'], 24) ?></span>
          <h3><?= e($bidang['judul']) ?></h3>
          <p><?= e($bidang['desc']) ?></p>
          <ul class="mini-list">
            <?php foreach ($bidang['poin'] as $poin): ?>
              <li><?= icon('check', 14) ?><?= e($poin) ?></li>
            <?php endforeach; ?>
          </ul>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section section-alt">
  <div class="container">
    <div class="section-head">
      <span class="eyebrow">Legalitas</span>
      <h2 class="section-title">Dokumen pendirian perusahaan</h2>
      <p class="section-lead">Perusahaan berdiri secara resmi dengan akta notaris dan pengesahan badan hukum dari pemerintah.</p>
    </div>
    <div class="grid grid-2 legal-grid">
      <div class="card legal-card">
        <span class="icon-box"><?= icon('file', 22) ?></span>
        <h3>Bentuk badan hukum</h3>
        <p class="legal-value"><?= e(cfg('legal')['badan_hukum']) ?></p>
        <p class="legal-note">Perseroan Terbatas yang didirikan sesuai ketentuan hukum yang berlaku di Indonesia.</p>
      </div>
      <div class="card legal-card">
        <span class="icon-box"><?= icon('clipboard', 22) ?></span>
        <h3>Akta pendirian</h3>
        <p class="legal-value"><?= e(cfg('legal')['akta']) ?></p>
        <p class="legal-note">Akta pendirian perusahaan yang memuat maksud, tujuan, dan bidang usaha perusahaan.</p>
      </div>
      <div class="card legal-card">
        <span class="icon-box"><?= icon('shield', 22) ?></span>
        <h3>Pengesahan Kementerian Hukum &amp; HAM RI</h3>
        <p class="legal-value"><?= e(cfg('legal')['sk']) ?></p>
        <p class="legal-note">Keputusan Menteri Hukum dan Hak Asasi Manusia Republik Indonesia atas pengesahan badan hukum perusahaan.</p>
      </div>
      <div class="card legal-card">
        <span class="icon-box"><?= icon('pin', 22) ?></span>
        <h3>Alamat kedudukan perusahaan</h3>
        <p class="legal-value"><?= e(cfg('alamat')) ?></p>
        <p class="legal-note">Alamat kedudukan perusahaan sekaligus basis operasional pekerjaan di Sumatera Utara.</p>
      </div>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="section-head">
      <span class="eyebrow">Cara kerja</span>
      <h2 class="section-title">Alur kerja kami</h2>
      <p class="section-lead">Empat tahap yang kami jalani pada setiap pekerjaan, dari konsultasi sampai serah terima.</p>
    </div>
    <div class="grid grid-4 steps">
      <?php foreach (process_steps() as $step): ?>
        <div class="step">
          <span class="step-no"><?= e($step['no']) ?></span>
          <h3><?= e($step['judul']) ?></h3>
          <p><?= e($step['desc']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="logo-strip">
  <div class="container">
    <p class="logo-strip-label">Kapabilitas yang kami tangani</p>
    <div class="logo-row">
      <?php foreach (keahlian() as $item): ?>
        <span class="logo-item"><?= e($item) ?></span>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php
$cta_judul = 'Mari bekerja sama untuk pekerjaan Anda berikutnya.';
$cta_teks = 'Sampaikan kebutuhan pekerjaan fiber optik atau konstruksi Anda, kami bantu susun lingkup kerja, volume, dan penawaran resmi.';
require __DIR__ . '/inc/cta.php';
?>
<?php require __DIR__ . '/inc/footer.php'; ?>
