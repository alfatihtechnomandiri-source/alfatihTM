<?php
require_once __DIR__ . '/inc/init.php';

$errors = [];
$terkirim = false;
$prefill_topik = trim((string) ($_GET['layanan'] ?? $_GET['topik'] ?? ''));
$default_subjek = 'Permintaan penawaran';

$old = [
    'nama'     => '',
    'email'    => '',
    'telepon'  => '',
    'lokasi'   => '',
    'subjek'   => $prefill_topik !== '' ? $prefill_topik : $default_subjek,
    'anggaran' => '',
    'pesan'    => $prefill_topik !== '' ? 'Halo, saya ingin menanyakan pekerjaan ' . $prefill_topik . '. ' : '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['aksi'] ?? '') === 'kirim') {
    foreach (array_keys($old) as $kunci) {
        $old[$kunci] = post_str($kunci);
    }
    if ($old['subjek'] === '') {
        $old['subjek'] = $default_subjek;
    }

    if (mb_strlen($old['nama']) < 2) {
        $errors['nama'] = 'Mohon isi nama lengkap Anda.';
    }
    if (!filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Mohon isi email yang valid agar kami bisa membalas.';
    }
    if ($old['telepon'] !== '' && strlen(preg_replace('/\D/', '', $old['telepon'])) < 9) {
        $errors['telepon'] = 'Nomor WhatsApp minimal 9 digit angka.';
    }
    if (mb_strlen($old['pesan']) < 10) {
        $errors['pesan'] = 'Ceritakan sedikit lebih detail, minimal 10 karakter.';
    }

    if (!$errors) {
        store_create_message([
            'nama'    => $old['nama'],
            'email'   => $old['email'],
            'telepon' => $old['telepon'],
            'subjek'  => $old['subjek']
                . ($old['lokasi'] !== '' ? ' (lokasi: ' . $old['lokasi'] . ')' : '')
                . ($old['anggaran'] !== '' ? ' (anggaran: ' . $old['anggaran'] . ')' : ''),
            'pesan'   => $old['pesan'],
        ]);
        $terkirim = true;
        $old = [
            'nama' => '', 'email' => '', 'telepon' => '', 'lokasi' => '',
            'subjek' => $default_subjek, 'anggaran' => '', 'pesan' => '',
        ];
    }
}

$wa_kontak = 'Halo ' . cfg('nama') . ", saya ingin berkonsultasi mengenai pekerjaan fiber optik / konstruksi.\n\n"
    . 'Nama: ' . ($old['nama'] !== '' ? $old['nama'] : '-') . "\n"
    . 'Kebutuhan: ' . ($old['pesan'] !== '' ? $old['pesan'] : '-');

$page_title = 'Kontak';
$page_desc = 'Hubungi PT. Alfatih Techno Mandiri untuk konsultasi pekerjaan fiber optik, konstruksi gedung, survey lokasi, dan permintaan penawaran di Sumatera Utara.';
require __DIR__ . '/inc/header.php';
?>

<section class="page-hero">
  <div class="container">
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <a href="index.php">Home</a><span>/</span><span>Kontak</span>
    </nav>
    <h1>Hubungi <?= e(cfg('nama_legal')) ?></h1>
    <p>Kirimkan kebutuhan pekerjaan Anda melalui formulir di bawah, atau hubungi kami langsung melalui telepon dan WhatsApp. Konsultasi awal dan pengajuan penawaran tidak dikenakan biaya.</p>
    <div class="page-hero-stats">
      <span><?= icon('clock', 16) ?> <?= e(cfg('jam_kerja')) ?></span>
      <span><?= icon('compass', 16) ?> Survey lokasi sesuai kebutuhan</span>
      <span><?= icon('shield', 16) ?> Berbadan hukum Perseroan Terbatas</span>
    </div>
  </div>
</section>

<section class="section">
  <div class="container contact-layout">
    <div class="contact-main">
      <div class="grid grid-2 contact-cards">
        <div class="card contact-card">
          <span class="icon-box"><?= icon('pin', 22) ?></span>
          <h3>Alamat perusahaan</h3>
          <p><?= e(cfg('alamat')) ?></p>
          <a class="link-arrow" href="https://www.google.com/maps/search/?api=1&query=<?= e(urlencode((string) cfg('maps_query'))) ?>" target="_blank" rel="noopener">Buka di Google Maps <?= icon('arrow', 16) ?></a>
        </div>
        <div class="card contact-card">
          <span class="icon-box"><?= icon('phone', 22) ?></span>
          <h3>Telepon &amp; WhatsApp</h3>
          <p><a href="tel:<?= e(preg_replace('/[^0-9+]/', '', (string) cfg('telepon'))) ?>"><?= e(cfg('telepon')) ?></a><br><?= e(cfg('whatsapp_tampil')) ?> (WhatsApp)</p>
          <a class="link-arrow" href="<?= e(wa_link($wa_kontak)) ?>" target="_blank" rel="noopener">Chat sekarang <?= icon('arrow', 16) ?></a>
        </div>
        <div class="card contact-card">
          <span class="icon-box"><?= icon('mail', 22) ?></span>
          <h3>Email</h3>
          <p>Untuk permintaan penawaran, kerja sama, dan pertanyaan umum.<br><a href="mailto:<?= e(cfg('email')) ?>"><?= e(cfg('email')) ?></a></p>
        </div>
        <div class="card contact-card">
          <span class="icon-box"><?= icon('building', 22) ?></span>
          <h3>Website &amp; jam kerja</h3>
          <p><a href="http://<?= e(cfg('website')) ?>" target="_blank" rel="noopener"><?= e(cfg('website')) ?></a><br><?= e(cfg('jam_kerja')) ?></p>
        </div>
      </div>

      <div class="card form-card">
        <?php if ($terkirim): ?>
          <div class="alert alert-success">
            <?= icon('check', 20) ?>
            <div>
              <strong>Pesan Anda sudah terkirim.</strong>
              <p>Terima kasih sudah menghubungi kami. Tim <?= e(cfg('nama')) ?> akan membalas melalui email atau WhatsApp pada jam kerja.</p>
            </div>
          </div>
        <?php elseif ($errors): ?>
          <div class="alert alert-error"><?= icon('shield', 18) ?> Beberapa bagian belum lengkap. Mohon periksa kembali.</div>
        <?php endif; ?>

        <h2>Formulir konsultasi &amp; permintaan penawaran</h2>
        <p class="form-sub">Isi data berikut agar kami dapat menyiapkan tanggapan yang sesuai dengan kebutuhan pekerjaan Anda.</p>

        <form method="post" action="kontak.php">
          <input type="hidden" name="aksi" value="kirim">
          <div class="form-row">
            <div class="form-group <?= isset($errors['nama']) ? 'has-error' : '' ?>">
              <label for="nama">Nama lengkap <span class="req">*</span></label>
              <input type="text" id="nama" name="nama" value="<?= e($old['nama']) ?>" placeholder="Nama Anda" required>
              <?php if (isset($errors['nama'])): ?><p class="field-error"><?= e($errors['nama']) ?></p><?php endif; ?>
            </div>
            <div class="form-group <?= isset($errors['email']) ? 'has-error' : '' ?>">
              <label for="email">Email <span class="req">*</span></label>
              <input type="email" id="email" name="email" value="<?= e($old['email']) ?>" placeholder="nama@perusahaan.com" required>
              <?php if (isset($errors['email'])): ?><p class="field-error"><?= e($errors['email']) ?></p><?php endif; ?>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group <?= isset($errors['telepon']) ? 'has-error' : '' ?>">
              <label for="telepon">WhatsApp</label>
              <input type="tel" id="telepon" name="telepon" value="<?= e($old['telepon']) ?>" placeholder="0812xxxxxxx">
              <?php if (isset($errors['telepon'])): ?><p class="field-error"><?= e($errors['telepon']) ?></p><?php endif; ?>
            </div>
            <div class="form-group">
              <label for="lokasi">Lokasi pekerjaan</label>
              <input type="text" id="lokasi" name="lokasi" value="<?= e($old['lokasi']) ?>" placeholder="Contoh: Kab. Simalungun, Sumatera Utara">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="subjek">Kebutuhan Anda</label>
              <select id="subjek" name="subjek">
                <?php
                $opsi_subjek = ['Permintaan penawaran', 'Konsultasi pekerjaan', 'Survey lokasi', 'Kerja sama / kemitraan', 'Informasi material & perangkat', 'Lainnya'];
                foreach (services() as $s) {
                    $opsi_subjek[] = $s['nama'];
                }
                foreach (array_unique($opsi_subjek) as $opsi):
                    ?>
                  <option value="<?= e($opsi) ?>" <?= $old['subjek'] === $opsi ? 'selected' : '' ?>><?= e($opsi) ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="anggaran">Perkiraan anggaran</label>
              <select id="anggaran" name="anggaran">
                <?php foreach (['', '< Rp 25 juta', 'Rp 25–100 juta', 'Rp 100–500 juta', '> Rp 500 juta', 'Belum ditentukan'] as $opsi): ?>
                  <option value="<?= e($opsi) ?>" <?= $old['anggaran'] === $opsi ? 'selected' : '' ?>><?= $opsi === '' ? 'Pilih rentang (opsional)' : e($opsi) ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="form-group <?= isset($errors['pesan']) ? 'has-error' : '' ?>">
            <label for="pesan">Ceritakan kebutuhan Anda <span class="req">*</span></label>
            <textarea id="pesan" name="pesan" rows="5" placeholder="Contoh: kami membutuhkan pemasangan jaringan fiber optik untuk 120 titik di kawasan perumahan, mohon informasi lingkup pekerjaan dan estimasi biaya." required><?= e($old['pesan']) ?></textarea>
            <?php if (isset($errors['pesan'])): ?><p class="field-error"><?= e($errors['pesan']) ?></p><?php endif; ?>
          </div>

          <div class="form-actions">
            <button class="btn btn-primary btn-lg" type="submit"><?= icon('mail', 18) ?> Kirim Pesan</button>
            <a class="btn btn-outline btn-lg" href="<?= e(wa_link($wa_kontak)) ?>" target="_blank" rel="noopener"><?= icon('whatsapp', 18) ?> Chat WhatsApp</a>
          </div>
          <p class="order-fineprint">Kami hanya menggunakan data Anda untuk menanggapi permintaan ini dan tidak membagikannya kepada pihak lain.</p>
        </form>
      </div>
    </div>

    <aside class="contact-side">
      <div class="card map-card">
        <div class="map-visual">
          <span class="map-pin"><?= icon('pin', 26) ?></span>
          <span class="map-road"></span>
          <span class="map-road map-road-2"></span>
        </div>
        <div class="map-info">
          <h3><?= e(cfg('nama_legal')) ?></h3>
          <p><?= e(cfg('alamat')) ?></p>
          <a class="btn btn-outline btn-block" href="https://www.google.com/maps/search/?api=1&query=<?= e(urlencode((string) cfg('maps_query'))) ?>" target="_blank" rel="noopener"><?= icon('pin', 18) ?> Lihat di peta</a>
        </div>
      </div>

      <div class="card side-card">
        <h3>Legalitas perusahaan</h3>
        <dl class="legal-mini">
          <div><dt>Badan hukum</dt><dd><?= e(cfg('legal')['badan_hukum']) ?></dd></div>
          <div><dt>Akta pendirian</dt><dd>Nomor 103, 27 Desember 2022</dd></div>
          <div><dt>SK Kemenkumham RI</dt><dd>AHU-0138961.AH.01.01.TAHUN 2022</dd></div>
        </dl>
        <a class="btn btn-outline btn-block" href="tentang.php">Profil perusahaan</a>
      </div>

      <div class="card side-card">
        <h3>Pertanyaan yang sering muncul</h3>
        <div class="faq-list">
          <details>
            <summary>Bagaimana cara mendapatkan harga?</summary>
            <p>Setiap pekerjaan dihitung berdasarkan lingkup dan volume. Setelah pengajuan, kami hubungi Anda untuk memastikan kebutuhan, melakukan survey bila perlu, lalu mengirim penawaran resmi.</p>
          </details>
          <details>
            <summary>Apakah melayani survey lokasi?</summary>
            <p>Ya. Survey dilakukan pada lokasi pekerjaan untuk mengukur jalur jaringan atau kondisi lahan sebelum volume dan metode pelaksanaan ditetapkan.</p>
          </details>
          <details>
            <summary>Wilayah kerja di mana saja?</summary>
            <p>Basis operasional kami berada di Kabupaten Simalungun, Sumatera Utara. Untuk pekerjaan di luar wilayah tersebut, silakan hubungi kami untuk pemeriksaan ketersediaan.</p>
          </details>
          <details>
            <summary>Apakah pekerjaan bergaransi?</summary>
            <p>Ketentuan garansi dan masa pemeliharaan disepakati bersama dan dicantumkan pada penawaran resmi sesuai jenis pekerjaan.</p>
          </details>
          <details>
            <summary>Apakah menyediakan materialnya juga?</summary>
            <p>Ya. Kami dapat menyediakan material dan perangkat jaringan maupun konstruksi, atau menggunakan material yang disiapkan pemilik pekerjaan.</p>
          </details>
        </div>
      </div>
    </aside>
  </div>
</section>

<?php require __DIR__ . '/inc/footer.php'; ?>
