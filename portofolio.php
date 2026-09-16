<?php
require_once __DIR__ . '/inc/init.php';

$kategori_aktif = isset($_GET['kategori']) ? trim((string) $_GET['kategori']) : '';
$kategori_tersedia = project_categories();

$daftar = projects();
if ($kategori_aktif !== '' && isset($kategori_tersedia[$kategori_aktif])) {
    $daftar = array_values(array_filter($daftar, fn($p) => $p['kategori'] === $kategori_aktif));
} else {
    $kategori_aktif = '';
}

$page_title = 'Portofolio';
$page_desc = 'Lingkup pekerjaan PT. Alfatih Techno Mandiri: pelaksana konstruksi sentral telekomunikasi dan fiber optik, konstruksi gedung, pekerjaan sipil (jalan aspal/beton dan irigasi), CCTV & IoT berbasis AI, perencanaan DED/RAB, serta pengadaan material dan perangkat.';
require __DIR__ . '/inc/header.php';
?>

<section class="page-hero">
  <div class="container">
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <a href="index.php">Home</a><span>/</span><span>Portofolio</span>
    </nav>
    <h1>Portofolio, lingkup pekerjaan, dan pengalaman kerjasama</h1>
    <p class="page-hero-lead-wide">PT. Alfatih Techno Mandiri adalah perusahaan yang beroperasi di bidang pelaksana konstruksi sentral telekomunikasi, konstruksi gedung/bangunan, dan konstruksi pekerjaan sipil seperti jalan aspal/beton serta irigasi jalan/pertanian, serta jasa pemasaran dan pengadaan barang material bangunan, perangkat hardware, perangkat software, dan lain-lain — beserta kemampuan dan keahlian kami di bidang teknologi.</p>
    <div class="page-hero-stats">
      <span><?= icon('layers', 16) ?> <?= count(projects()) ?> lingkup pekerjaan</span>
      <span><?= icon('target', 16) ?> <?= count($kategori_tersedia) ?> kategori bidang</span>
      <span><?= icon('pin', 16) ?> Basis operasional Sumatera Utara</span>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="notice-box">
      <?= icon('clipboard', 20) ?>
      <p><strong>Catatan:</strong> foto dan uraian pada halaman ini menggambarkan jenis serta ruang lingkup pekerjaan kami. Dokumentasi pelaksanaan setiap proyek dapat kami sampaikan langsung saat konsultasi atau penawaran.</p>
    </div>

    <div class="filter-bar">
      <div class="chip-row">
        <a class="chip <?= $kategori_aktif === '' ? 'is-active' : '' ?>" href="portofolio.php">Semua <span><?= count(projects()) ?></span></a>
        <?php foreach ($kategori_tersedia as $nama => $jumlah): ?>
          <a class="chip <?= $kategori_aktif === $nama ? 'is-active' : '' ?>" href="portofolio.php?kategori=<?= e(urlencode($nama)) ?>"><?= e($nama) ?> <span><?= $jumlah ?></span></a>
        <?php endforeach; ?>
      </div>
      <p class="filter-count">Menampilkan <strong><?= count($daftar) ?></strong> lingkup pekerjaan<?= $kategori_aktif !== '' ? ' kategori ' . e($kategori_aktif) : '' ?>.</p>
    </div>

    <?php if (!$daftar): ?>
      <div class="empty-state">
        <?= icon('search', 28) ?>
        <h3>Belum ada pekerjaan pada kategori ini</h3>
        <p>Silakan pilih kategori lain atau lihat seluruh lingkup pekerjaan kami.</p>
        <a class="btn btn-primary" href="portofolio.php">Lihat semua lingkup pekerjaan</a>
      </div>
    <?php else: ?>
      <div class="grid grid-3">
        <?php foreach ($daftar as $p): ?>
          <article class="card project-card">
            <a class="project-media" href="proyek.php?id=<?= (int) $p['id'] ?>">
              <img src="<?= e(img_url($p['gambar'])) ?>" alt="<?= e($p['nama']) ?>" loading="lazy">
              <span class="project-chip"><?= e($p['kategori']) ?></span>
            </a>
            <div class="project-body">
              <div class="project-meta"><span><?= e($p['sektor']) ?></span><span>&middot;</span><span><?= e($p['lokasi']) ?></span></div>
              <h3><a href="proyek.php?id=<?= (int) $p['id'] ?>"><?= e($p['nama']) ?></a></h3>
              <p><?= e(excerpt($p['excerpt'], 110)) ?></p>
              <div class="tag-row">
                <?php foreach (array_slice($p['layanan'], 0, 2) as $tag): ?>
                  <span class="tag"><?= e($tag) ?></span>
                <?php endforeach; ?>
              </div>
              <a class="link-arrow" href="proyek.php?id=<?= (int) $p['id'] ?>">Lihat ruang lingkup <?= icon('arrow', 16) ?></a>
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
      <span class="eyebrow">Profil &amp; kemampuan</span>
      <h2 class="section-title">Bidang usaha dan kemampuan kami</h2>
      <p class="section-lead">Gambaran singkat lingkup usaha serta kemampuan dan pengalaman yang kami miliki.</p>
    </div>

    <div class="profile-lead">
      <p><?= e(profile_intro()) ?></p>
    </div>

    <div class="grid grid-2 capability-grid">
      <?php foreach (capabilities() as $kelompok): ?>
        <article class="card capability-card">
          <span class="icon-box"><?= icon($kelompok['icon'], 24) ?></span>
          <h3><?= $kelompok['judul'] ?></h3>
          <p class="capability-ket"><?= e($kelompok['ket']) ?></p>
          <ol class="capability-list">
            <?php foreach ($kelompok['poin'] as $no => $butir): ?>
              <li><span class="cap-no"><?= (int) $no + 1 ?></span><span class="cap-text"><?= e($butir) ?></span></li>
            <?php endforeach; ?>
          </ol>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="section-head">
      <span class="eyebrow">Bidang pekerjaan</span>
      <h2 class="section-title">Bidang usaha perusahaan</h2>
      <p class="section-lead">Sesuai bidang usaha yang tercantum pada akta perusahaan dan pengesahan Kementerian Hukum dan HAM RI.</p>
    </div>
    <div class="grid grid-3">
      <?php foreach (business_fields() as $bidang): ?>
        <article class="card service-card compact">
          <span class="icon-box"><?= icon($bidang['icon'], 22) ?></span>
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

<?php $pengalaman = work_experience(); ?>
<?php if ($pengalaman): ?>
<section class="section section-alt">
  <div class="container">
    <div class="section-head">
      <span class="eyebrow">Pengalaman kerjasama</span>
      <h2 class="section-title">Pengalaman kerjasama perusahaan</h2>
      <p class="section-lead">Pekerjaan yang telah dan sedang kami kerjakan bersama instansi maupun perusahaan pemberi kerja.</p>
    </div>
    <div class="table-wrap">
      <table class="xp-table">
        <caption>Daftar pengalaman kerjasama PT. Alfatih Techno Mandiri</caption>
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Pemberi kerja</th>
            <th scope="col">Jenis pekerjaan</th>
            <th scope="col">Tahun</th>
            <th scope="col">Lokasi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($pengalaman as $i => $xp): ?>
            <tr>
              <td data-label="No"><?= (int) $i + 1 ?></td>
              <td data-label="Pemberi kerja">
                <span class="xp-emp">
                  <?php if (!empty($xp['logo'])): ?>
                    <img class="xp-logo" src="<?= e(img_url('klien/' . $xp['logo'])) ?>" alt="Logo <?= e($xp['pemberi']) ?>" loading="lazy">
                  <?php else: ?>
                    <span class="xp-mono" aria-hidden="true"><?= e(short_name($xp['pemberi'])) ?></span>
                  <?php endif; ?>
                  <span><?= e($xp['pemberi']) ?></span>
                </span>
              </td>
              <td data-label="Jenis pekerjaan"><?= e($xp['pekerjaan']) ?></td>
              <td data-label="Tahun"><?= e($xp['tahun']) ?></td>
              <td data-label="Lokasi"><?= e($xp['lokasi']) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</section>
<?php endif; ?>

<?php
$cta_judul = 'Ada pekerjaan fiber optik atau konstruksi yang ingin dikerjakan?';
$cta_teks = 'Kirimkan data awal lokasi dan kebutuhan Anda, kami lakukan survey serta menyusun penawaran beserta volume pekerjaan.';
require __DIR__ . '/inc/cta.php';
?>
<?php require __DIR__ . '/inc/footer.php'; ?>
