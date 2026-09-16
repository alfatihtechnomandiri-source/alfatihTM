<?php
require_once __DIR__ . '/inc/init.php';

$kode = isset($_GET['kode']) ? strtoupper(trim((string) $_GET['kode'])) : '';
$permintaan = $kode !== '' ? store_find_order($kode) : null;

$page_title = $permintaan ? 'Permintaan ' . $kode . ' diterima' : 'Cek status permintaan';
$page_desc = 'Rincian permintaan penawaran Anda kepada ' . cfg('nama_legal') . '.';
require __DIR__ . '/inc/header.php';
?>

<?php if (!$permintaan): ?>
  <section class="page-hero">
    <div class="container">
      <nav class="breadcrumb"><a href="index.php">Home</a><span>/</span><a href="katalog.php">Katalog</a><span>/</span><span>Status permintaan</span></nav>
      <h1>Cek status permintaan</h1>
      <p>Masukkan nomor permintaan yang Anda terima setelah mengirim formulir, misalnya ATM-250915-A1B2.</p>
    </div>
  </section>
  <section class="section">
    <div class="container narrow">
      <div class="card lookup-card">
        <?php if ($kode !== ''): ?>
          <div class="alert alert-error"><?= icon('search', 18) ?> Nomor permintaan <strong><?= e($kode) ?></strong> tidak ditemukan. Mohon periksa kembali penulisannya.</div>
        <?php endif; ?>
        <h2>Cari nomor permintaan</h2>
        <form method="get" action="permintaan-sukses.php" class="lookup-form">
          <div class="search-field">
            <?= icon('search', 18) ?>
            <input type="text" name="kode" value="<?= e($kode) ?>" placeholder="ATM-000000-XXXX" aria-label="Nomor permintaan" required>
          </div>
          <button class="btn btn-primary" type="submit">Cek permintaan</button>
        </form>
        <p class="muted-small">Belum mengajukan? <a href="katalog.php">Lihat katalog jasa &amp; material</a> atau <a href="kontak.php">hubungi tim kami</a>.</p>
      </div>
    </div>
  </section>
<?php else: ?>
  <?php
  $wa_text = 'Halo ' . cfg('nama') . ", saya sudah mengirim permintaan penawaran melalui website.\n\n"
      . 'Nomor permintaan: ' . $permintaan['kode'] . "\n"
      . 'Item: ' . $permintaan['produk_nama'] . ' (' . $permintaan['produk_kode'] . ")\n"
      . 'Kategori: ' . $permintaan['kategori'] . "\n"
      . 'Volume: ' . $permintaan['volume'] . "\n"
      . 'Lokasi pekerjaan: ' . $permintaan['lokasi'] . "\n"
      . 'Target waktu: ' . ($permintaan['target_waktu'] !== '' ? $permintaan['target_waktu'] : '-') . "\n"
      . 'Nama: ' . $permintaan['nama'] . "\n"
      . 'WhatsApp: ' . $permintaan['telepon'] . "\n\n"
      . 'Mohon informasi langkah selanjutnya. Terima kasih.';
  ?>
  <section class="page-hero page-hero-success">
    <div class="container">
      <nav class="breadcrumb"><a href="index.php">Home</a><span>/</span><a href="katalog.php">Katalog</a><span>/</span><span>Permintaan diterima</span></nav>
      <span class="success-mark"><?= icon('check', 26) ?></span>
      <h1>Permintaan Anda sudah kami terima</h1>
      <p>Terima kasih, <?= e($permintaan['nama']) ?>. Simpan nomor permintaan berikut untuk memudahkan komunikasi dengan tim kami.</p>
      <div class="order-code-box">
        <span>Nomor permintaan</span>
        <strong><?= e($permintaan['kode']) ?></strong>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container recap-layout">
      <div class="recap-main">
        <div class="card info-card">
          <h2>Rincian permintaan</h2>
          <table class="recap-table">
            <tbody>
              <tr><th>Item</th><td><?= e($permintaan['produk_nama']) ?> <span class="tag"><?= e($permintaan['produk_kode']) ?></span></td></tr>
              <tr><th>Kategori</th><td><?= e($permintaan['kategori']) ?></td></tr>
              <tr><th>Perkiraan volume</th><td><?= e($permintaan['volume']) ?></td></tr>
              <tr><th>Lokasi pekerjaan</th><td><?= e($permintaan['lokasi']) ?></td></tr>
              <tr><th>Target waktu</th><td><?= $permintaan['target_waktu'] !== '' ? e($permintaan['target_waktu']) : 'Belum ditentukan' ?></td></tr>
              <tr><th>Status</th><td><span class="status-pill">Menunggu konfirmasi</span></td></tr>
            </tbody>
          </table>

          <h3>Data pemohon</h3>
          <table class="recap-table">
            <tbody>
              <tr><th>Nama</th><td><?= e($permintaan['nama']) ?></td></tr>
              <tr><th>WhatsApp</th><td><?= e($permintaan['telepon']) ?></td></tr>
              <?php if (!empty($permintaan['email'])): ?><tr><th>Email</th><td><?= e($permintaan['email']) ?></td></tr><?php endif; ?>
              <?php if (!empty($permintaan['perusahaan'])): ?><tr><th>Perusahaan</th><td><?= e($permintaan['perusahaan']) ?></td></tr><?php endif; ?>
              <?php if (!empty($permintaan['catatan'])): ?><tr><th>Catatan</th><td><?= nl2br(e($permintaan['catatan'])) ?></td></tr><?php endif; ?>
            </tbody>
          </table>

          <div class="note-box">
            <?= icon('clock', 20) ?>
            <p><strong>Langkah selanjutnya:</strong> tim kami menghubungi Anda melalui WhatsApp atau email pada jam kerja untuk memastikan kebutuhan, menjadwalkan survey lokasi bila diperlukan, lalu mengirim penawaran resmi beserta rincian volume pekerjaan.</p>
          </div>
        </div>

        <div class="grid grid-3 steps">
          <div class="step">
            <span class="step-no">01</span>
            <h3>Konfirmasi kebutuhan</h3>
            <p>Tim kami memastikan lingkup, volume, dan kondisi lokasi pekerjaan.</p>
          </div>
          <div class="step">
            <span class="step-no">02</span>
            <h3>Survey &amp; penawaran</h3>
            <p>Survey lokasi dilakukan bila diperlukan, lalu penawaran resmi kami kirimkan.</p>
          </div>
          <div class="step">
            <span class="step-no">03</span>
            <h3>Pelaksanaan</h3>
            <p>Setelah penawaran disetujui, pekerjaan dijadwalkan dan dilaksanakan sesuai rencana.</p>
          </div>
        </div>
      </div>

      <aside class="recap-side">
        <div class="card side-card side-cta">
          <h3>Percepat tindak lanjut</h3>
          <p>Kirimkan rincian permintaan ini ke WhatsApp tim kami agar segera diproses.</p>
          <a class="btn btn-primary btn-block" href="<?= e(wa_link($wa_text)) ?>" target="_blank" rel="noopener"><?= icon('whatsapp', 18) ?> Kirim ke WhatsApp</a>
          <a class="btn btn-outline btn-block" href="mailto:<?= e(cfg('email')) ?>?subject=<?= e(urlencode('Permintaan ' . $permintaan['kode'])) ?>&body=<?= e(urlencode($wa_text)) ?>"><?= icon('mail', 18) ?> Kirim via Email</a>
        </div>
        <div class="card side-card">
          <h3>Butuh bantuan?</h3>
          <ul class="side-contact">
            <li><?= icon('phone', 16) ?><a href="tel:<?= e(preg_replace('/[^0-9+]/', '', (string) cfg('telepon'))) ?>"><?= e(cfg('telepon')) ?></a></li>
            <li><?= icon('whatsapp', 16) ?><a href="<?= e(wa_link(wa_default_text())) ?>" target="_blank" rel="noopener"><?= e(cfg('whatsapp_tampil')) ?></a></li>
            <li><?= icon('mail', 16) ?><a href="mailto:<?= e(cfg('email')) ?>"><?= e(cfg('email')) ?></a></li>
            <li><?= icon('clock', 16) ?><span><?= e(cfg('jam_kerja')) ?></span></li>
          </ul>
        </div>
        <div class="card side-card">
          <h3>Item lain</h3>
          <p class="muted-small">Jelajahi jasa dan material lain di katalog kami.</p>
          <a class="btn btn-outline btn-block" href="katalog.php">Kembali ke katalog</a>
        </div>
      </aside>
    </div>
  </section>
<?php endif; ?>

<?php require __DIR__ . '/inc/footer.php'; ?>
