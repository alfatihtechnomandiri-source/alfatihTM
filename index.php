<?php
require_once __DIR__ . '/inc/init.php';

$page_title = 'Home';
$page_desc = 'PT. Alfatih Techno Mandiri — pelaksana konstruksi instalasi jaringan fiber optik dan konstruksi gedung/bangunan, melayani desain & drafter perencanaan serta manajemen data konstruksi di Sumatera Utara.';
require __DIR__ . '/inc/header.php';
?>

<section class="hero">
  <picture>
    <source media="(max-width: 767px)" srcset="<?= e(img_url('hero-lambang.jpg')) ?>">
    <img class="hero-bg" src="<?= e(img_url('hero-luas.jpg')) ?>" alt="Pekerjaan instalasi jaringan fiber optik" fetchpriority="high">
  </picture>
  <div class="hero-overlay"></div>
  <div class="container hero-inner">
    <span class="hero-badge"><?= icon('hardhat', 16) ?> Perseroan Terbatas &middot; berdiri <?= e(cfg('tanggal_berdiri')) ?></span>
    <h1 class="hero-title-wide">Pelaksana <span class="hl">konstruksi sentral telekomunikasi jaringan fiber optik</span>, konstruksi bangunan gedung, dan konstruksi sipil (jalan, irigasi), serta instalasi CCTV maupun teknologi IoT.</h1>
    <p class="hero-lead">Kami juga melayani pengadaan barang dan jasa, meliputi penjualan peralatan fiber optik, komputer, CCTV, dan PLTS (Pembangkit Listrik Tenaga Surya). <a href="katalog.php">Silakan kunjungi produk dan layanan kami&nbsp;<?= icon('arrow', 14) ?></a></p>
    <div class="hero-actions">
      <a class="btn btn-primary" href="katalog.php"><?= icon('clipboard', 18) ?> Katalog Produk &amp; Jasa</a>
      <a class="btn btn-glass" href="portofolio.php"><?= icon('layers', 18) ?> Portofolio &amp; Pengalaman Kerjasama</a>
    </div>
    <ul class="hero-points">
      <li><?= icon('check', 16) ?> Bersertifikat badan hukum PT</li>
      <li><?= icon('check', 16) ?> Basis operasional Simalungun, Sumatera Utara</li>
      <li><?= icon('check', 16) ?> Perencanaan sampai manajemen data konstruksi</li>
    </ul>
  </div>
</section>

<div class="container hero-stats">
  <?php foreach (facts() as $s): ?>
    <div class="stat-card">
      <span class="stat-value" data-count="<?= e($s['angka']) ?>" data-suffix="<?= e($s['suffix']) ?>">0</span>
      <span class="stat-label"><?= e($s['label']) ?></span>
    </div>
  <?php endforeach; ?>
</div>

<section class="logo-strip">
  <div class="container">
    <p class="logo-strip-label">Pekerjaan yang kami tangani</p>
    <div class="logo-row">
      <?php foreach (keahlian() as $item): ?>
        <span class="logo-item"><?= e($item) ?></span>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section">
  <div class="container about-grid">
    <div class="about-media about-media-wide">
      <img src="<?= e(img_url('tentang.jpg')) ?>" alt="Dokumentasi PT. Alfatih Techno Mandiri" loading="lazy">
      <div class="about-badge">
        <strong>PT</strong>
        <span>Berbadan hukum sejak <?= e(cfg('tanggal_berdiri')) ?></span>
      </div>
    </div>
    <div class="about-copy">
      <span class="eyebrow">Tentang perusahaan</span>
      <h2 class="section-title">Perusahaan konstruksi yang menangani pekerjaan secara menyeluruh.</h2>
      <p class="section-lead"><?= e(cfg('nama_legal')) ?> didirikan sebagai perusahaan yang dikhususkan untuk pengembangan usaha di bidang pelaksana konstruksi instalasi jaringan fiber optik dan konstruksi gedung/bangunan — mulai dari desain dan drafter perencanaan, pelaksana konstruksi, hingga manajemen data konstruksi.</p>
      <ul class="check-list">
        <li><?= icon('check', 16) ?><span><strong>Dikerjakan sesuai gambar kerja.</strong> Setiap tahap pekerjaan mengacu pada gambar dan rencana kerja yang disepakati.</span></li>
        <li><?= icon('check', 16) ?><span><strong>Mengutamakan mutu.</strong> Pekerjaan dilakukan dengan standar tertinggi agar hasil akhir tahan lama, aman, dan estetis.</span></li>
        <li><?= icon('check', 16) ?><span><strong>Data pekerjaan tertata.</strong> Volume, dokumentasi lapangan, dan laporan progres dikelola rapi agar mudah diperiksa.</span></li>
      </ul>
      <div class="about-actions">
        <a class="btn btn-primary" href="tentang.php">Profil Perusahaan <?= icon('arrow', 18) ?></a>
        <a class="link-arrow" href="kontak.php">Ajukan penawaran <?= icon('arrow', 16) ?></a>
      </div>
    </div>
  </div>
</section>

<section class="section section-alt">
  <div class="container">
    <div class="section-head">
      <span class="eyebrow">Layanan</span>
      <h2 class="section-title">Bidang pekerjaan yang kami layani</h2>
      <p class="section-lead">Dapat dikerjakan sebagian sesuai kebutuhan, atau sebagai satu paket pekerjaan dari perencanaan sampai serah terima.</p>
    </div>
    <div class="grid grid-3">
      <?php foreach (services() as $s): ?>
        <article class="card service-card">
          <span class="icon-box"><?= icon($s['icon'], 24) ?></span>
          <h3><?= e($s['nama']) ?></h3>
          <p><?= e($s['desc']) ?></p>
          <ul class="mini-list">
            <?php foreach ($s['poin'] as $poin): ?>
              <li><?= icon('check', 14) ?><?= e($poin) ?></li>
            <?php endforeach; ?>
          </ul>
          <a class="link-arrow" href="kontak.php?layanan=<?= e(urlencode($s['nama'])) ?>">Minta penawaran <?= icon('arrow', 16) ?></a>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="section-head section-head-row">
      <div>
        <span class="eyebrow">Portofolio</span>
        <h2 class="section-title">Lingkup pekerjaan kami</h2>
        <p class="section-lead">Gambaran jenis pekerjaan yang kami tangani pada bidang fiber optik, konstruksi gedung, pekerjaan sipil, perencanaan, dan manajemen data konstruksi.</p>
      </div>
      <a class="btn btn-outline" href="portofolio.php">Semua Lingkup Pekerjaan <?= icon('arrow', 18) ?></a>
    </div>
    <div class="grid grid-3">
      <?php foreach (array_slice(projects(), 0, 3) as $p): ?>
        <article class="card project-card">
          <a class="project-media" href="proyek.php?id=<?= (int) $p['id'] ?>">
            <img src="<?= e(img_url($p['gambar'])) ?>" alt="<?= e($p['nama']) ?>" loading="lazy">
            <span class="project-chip"><?= e($p['kategori']) ?></span>
          </a>
          <div class="project-body">
            <div class="project-meta"><span><?= e($p['sektor']) ?></span><span>&middot;</span><span><?= e($p['lokasi']) ?></span></div>
            <h3><a href="proyek.php?id=<?= (int) $p['id'] ?>"><?= e($p['nama']) ?></a></h3>
            <p><?= e(excerpt($p['excerpt'], 110)) ?></p>
            <a class="link-arrow" href="proyek.php?id=<?= (int) $p['id'] ?>">Lihat lingkup pekerjaan <?= icon('arrow', 16) ?></a>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section navy-band">
  <div class="container">
    <div class="section-head">
      <span class="eyebrow eyebrow-light">Visi kami</span>
      <h2 class="section-title"><?= e(vision()) ?></h2>
    </div>
    <div class="grid grid-4 stat-band">
      <?php foreach (missions() as $m): ?>
        <div class="stat-block mission-block">
          <span class="mission-icon"><?= icon($m['icon'], 24) ?></span>
          <span class="stat-caption mission-title"><?= e($m['judul']) ?></span>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="section-foot-link">
      <a class="link-arrow link-light" href="tentang.php">Baca visi &amp; misi lengkap <?= icon('arrow', 16) ?></a>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="section-head">
      <span class="eyebrow">Cara kerja</span>
      <h2 class="section-title">Empat tahap, hasil jelas di setiap akhir tahap</h2>
      <p class="section-lead">Alur kerja yang kami pakai pada pekerjaan fiber optik maupun konstruksi.</p>
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

<section class="section section-alt">
  <div class="container">
    <div class="section-head section-head-row">
      <div>
        <span class="eyebrow">Katalog</span>
        <h2 class="section-title">Jasa &amp; material yang bisa Anda ajukan</h2>
        <p class="section-lead">Pilih pekerjaan atau material yang Anda butuhkan, lalu ajukan permintaan penawaran. Harga dihitung sesuai lingkup dan volume pekerjaan setelah survey.</p>
      </div>
      <a class="btn btn-outline" href="katalog.php">Buka Katalog <?= icon('arrow', 18) ?></a>
    </div>
    <div class="grid grid-4">
      <?php foreach (array_slice(products(), 0, 4) as $p): ?>
        <article class="card product-card">
          <a class="product-media" href="produk.php?id=<?= (int) $p['id'] ?>">
            <img src="<?= e(img_url($p['gambar'])) ?>" alt="<?= e($p['nama']) ?>" loading="lazy">
            <?php if ($p['badge'] !== ''): ?><span class="badge"><?= e($p['badge']) ?></span><?php endif; ?>
          </a>
          <div class="product-body">
            <span class="product-cat"><?= e($p['kategori']) ?></span>
            <h3><a href="produk.php?id=<?= (int) $p['id'] ?>"><?= e($p['nama']) ?></a></h3>
            <p><?= e(excerpt($p['excerpt'], 88)) ?></p>
            <div class="product-foot">
              <span class="quote-note"><?= icon('clipboard', 15) ?> Harga sesuai lingkup</span>
              <a class="btn btn-primary btn-sm" href="produk.php?id=<?= (int) $p['id'] ?>">Ajukan</a>
            </div>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php require __DIR__ . '/inc/cta.php'; ?>
<?php require __DIR__ . '/inc/footer.php'; ?>
