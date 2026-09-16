<?php
require_once __DIR__ . '/inc/init.php';

$item = product_by_id($_GET['id'] ?? '');

$errors = [];
$old = [
    'nama'         => '',
    'telepon'      => '',
    'email'        => '',
    'instansi'     => '',
    'volume'       => '',
    'lokasi'       => '',
    'target_waktu' => '',
    'catatan'      => '',
];

if ($item && $_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['aksi'] ?? '') === 'ajukan') {
    foreach (array_keys($old) as $kunci) {
        $old[$kunci] = post_str($kunci);
    }

    if (mb_strlen($old['nama']) < 2) {
        $errors['nama'] = 'Mohon isi nama lengkap Anda.';
    }
    if (strlen(preg_replace('/\D/', '', $old['telepon'])) < 9) {
        $errors['telepon'] = 'Nomor WhatsApp minimal 9 digit angka.';
    }
    if ($old['email'] !== '' && !filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Format email belum benar.';
    }
    if (mb_strlen($old['lokasi']) < 3) {
        $errors['lokasi'] = 'Mohon sebutkan lokasi pekerjaan, minimal nama kota atau kecamatan.';
    }
    if (mb_strlen($old['volume']) < 2) {
        $errors['volume'] = 'Sebutkan perkiraan volume, misalnya jumlah titik, panjang kabel, atau luas bangunan.';
    }

    if (!$errors) {
        $kode = store_create_order([
            'produk_id'    => $item['id'],
            'produk_kode'  => $item['kode'],
            'produk_nama'  => $item['nama'],
            'kategori'     => $item['kategori'],
            'volume'       => $old['volume'],
            'lokasi'       => $old['lokasi'],
            'target_waktu' => $old['target_waktu'],
            'nama'         => $old['nama'],
            'email'        => $old['email'],
            'telepon'      => $old['telepon'],
            'perusahaan'   => $old['instansi'],
            'catatan'      => $old['catatan'],
        ]);
        header('Location: permintaan-sukses.php?kode=' . urlencode($kode));
        exit;
    }
}

if (!$item) {
    http_response_code(404);
    $page_title = 'Item tidak ditemukan';
    $page_desc = 'Item katalog yang Anda cari tidak tersedia.';
    require __DIR__ . '/inc/header.php';
    ?>
    <section class="page-hero">
      <div class="container">
        <nav class="breadcrumb"><a href="index.php">Home</a><span>/</span><a href="katalog.php">Katalog</a><span>/</span><span>Tidak ditemukan</span></nav>
        <h1>Item tidak ditemukan</h1>
        <p>Item yang Anda cari mungkin sudah diubah atau diganti dengan pekerjaan lain.</p>
      </div>
    </section>
    <section class="section">
      <div class="container">
        <div class="empty-state">
          <?= icon('clipboard', 28) ?>
          <h3>Item ini tidak ada di katalog</h3>
          <p>Silakan jelajahi item jasa dan material lain yang tersedia.</p>
          <a class="btn btn-primary" href="katalog.php"><?= icon('arrow-left', 18) ?> Kembali ke katalog</a>
        </div>
      </div>
    </section>
    <?php
    require __DIR__ . '/inc/footer.php';
    exit;
}

$terkait = array_values(array_filter(products(), fn($p) => $p['id'] !== $item['id'] && $p['kategori'] === $item['kategori']));
foreach (products() as $p) {
    if (count($terkait) >= 3) {
        break;
    }
    if ($p['id'] !== $item['id'] && !in_array($p, $terkait, true)) {
        $terkait[] = $p;
    }
}
$terkait = array_slice($terkait, 0, 3);

$page_title = $item['nama'];
$page_desc = $item['excerpt'];
require __DIR__ . '/inc/header.php';
?>

<section class="product-hero">
  <div class="container">
    <nav class="breadcrumb" aria-label="Breadcrumb">
      <a href="index.php">Home</a><span>/</span><a href="katalog.php">Katalog</a><span>/</span><a href="katalog.php?kategori=<?= e(urlencode($item['kategori'])) ?>"><?= e($item['kategori']) ?></a><span>/</span><span><?= e($item['nama']) ?></span>
    </nav>
  </div>
</section>

<section class="section section-top-tight">
  <div class="container product-layout">
    <div class="product-gallery">
      <figure class="product-media-big">
        <img src="<?= e(img_url($item['gambar'])) ?>" alt="<?= e($item['nama']) ?>" fetchpriority="high">
        <?php if ($item['badge'] !== ''): ?><span class="badge badge-lg"><?= e($item['badge']) ?></span><?php endif; ?>
      </figure>
      <ul class="trust-row">
        <li><?= icon('compass', 20) ?><span><strong>Survey lokasi</strong>Sebelum volume &amp; harga disusun</span></li>
        <li><?= icon('file', 20) ?><span><strong>Penawaran resmi</strong>Berisi rincian volume pekerjaan</span></li>
        <li><?= icon('shield', 20) ?><span><strong>Badan hukum PT</strong>Pekerjaan sesuai bidang usaha</span></li>
      </ul>
    </div>

    <div class="product-info">
      <span class="product-cat"><?= e($item['kategori']) ?> &middot; <?= e($item['kode']) ?></span>
      <h1><?= e($item['nama']) ?></h1>
      <p class="product-lead"><?= e($item['excerpt']) ?></p>

      <div class="price-box price-box-quote">
        <div>
          <strong>Harga sesuai lingkup</strong>
          <small>Dihitung berdasarkan volume, kondisi lapangan, dan metode pelaksanaan</small>
        </div>
        <span class="discount-chip discount-chip-soft"><?= icon('clipboard', 15) ?> Ajukan penawaran</span>
      </div>

      <ul class="feature-list">
        <?php foreach ($item['cakupan'] as $butir): ?>
          <li><?= icon('check', 16) ?><?= e($butir) ?></li>
        <?php endforeach; ?>
      </ul>

      <div class="quick-actions">
        <a class="btn btn-primary" href="#formPenawaran"><?= icon('clipboard', 18) ?> Ajukan Penawaran</a>
        <a class="btn btn-ghost" href="<?= e(wa_link('Halo ' . cfg('nama') . ', saya ingin menanyakan "' . $item['nama'] . '".')) ?>" target="_blank" rel="noopener"><?= icon('whatsapp', 18) ?> Tanya dulu</a>
      </div>
    </div>
  </div>
</section>

<section class="section section-top-tight" id="formPenawaran">
  <div class="container order-layout">
    <div class="order-main">
      <div class="card info-card">
        <h2>Keterangan</h2>
        <p><?= e($item['deskripsi']) ?></p>

        <h3>Cakupan pekerjaan</h3>
        <ul class="feature-list">
          <?php foreach ($item['cakupan'] as $butir): ?>
            <li><?= icon('check', 16) ?><?= e($butir) ?></li>
          <?php endforeach; ?>
        </ul>

        <h3>Ketentuan</h3>
        <table class="spec-table">
          <tbody>
            <?php foreach ($item['spesifikasi'] as $label => $nilai): ?>
              <tr><th><?= e($label) ?></th><td><?= e($nilai) ?></td></tr>
            <?php endforeach; ?>
            <tr><th>Kode item</th><td><?= e($item['kode']) ?></td></tr>
            <tr><th>Kategori</th><td><?= e($item['kategori']) ?></td></tr>
          </tbody>
        </table>

        <div class="note-box">
          <?= icon('refresh', 20) ?>
          <p><strong>Alur setelah mengajukan:</strong> permintaan Anda tercatat dengan nomor unik, tim kami menghubungi Anda untuk memastikan kebutuhan, melakukan survey bila diperlukan, lalu mengirim penawaran resmi beserta rincian volume pekerjaan.</p>
        </div>
      </div>
    </div>

    <aside class="order-side">
      <form class="card order-card" method="post" action="produk.php?id=<?= (int) $item['id'] ?>#formPenawaran" id="quoteForm">
        <h2><?= icon('clipboard', 20) ?> Formulir permintaan penawaran</h2>
        <p class="order-sub">Isi data berikut, tim kami akan menghubungi Anda untuk konfirmasi kebutuhan dan survey.</p>

        <?php if ($errors): ?>
          <div class="alert alert-error"><?= icon('shield', 18) ?> Mohon periksa kembali bagian yang ditandai.</div>
        <?php endif; ?>

        <input type="hidden" name="aksi" value="ajukan">

        <div class="order-summary">
          <div class="order-summary-top">
            <img src="<?= e(img_url($item['gambar'])) ?>" alt="">
            <span><strong><?= e($item['nama']) ?></strong><small><?= e($item['kode']) ?> &middot; <?= e($item['kategori']) ?></small></span>
          </div>
          <p class="order-summary-note"><?= icon('clipboard', 15) ?> Harga ditentukan setelah volume dan kondisi lapangan diketahui.</p>
        </div>

        <div class="form-group <?= isset($errors['nama']) ? 'has-error' : '' ?>">
          <label for="nama">Nama lengkap <span class="req">*</span></label>
          <input type="text" id="nama" name="nama" value="<?= e($old['nama']) ?>" placeholder="Nama Anda" required>
          <?php if (isset($errors['nama'])): ?><p class="field-error"><?= e($errors['nama']) ?></p><?php endif; ?>
        </div>

        <div class="form-group <?= isset($errors['telepon']) ? 'has-error' : '' ?>">
          <label for="telepon">Nomor WhatsApp <span class="req">*</span></label>
          <input type="tel" id="telepon" name="telepon" value="<?= e($old['telepon']) ?>" placeholder="0812xxxxxxx" required>
          <?php if (isset($errors['telepon'])): ?><p class="field-error"><?= e($errors['telepon']) ?></p><?php endif; ?>
        </div>

        <div class="form-group <?= isset($errors['lokasi']) ? 'has-error' : '' ?>">
          <label for="lokasi">Lokasi pekerjaan <span class="req">*</span></label>
          <input type="text" id="lokasi" name="lokasi" value="<?= e($old['lokasi']) ?>" placeholder="Contoh: Kec. Siantar, Kab. Simalungun" required>
          <?php if (isset($errors['lokasi'])): ?><p class="field-error"><?= e($errors['lokasi']) ?></p><?php endif; ?>
        </div>

        <div class="form-group <?= isset($errors['volume']) ? 'has-error' : '' ?>">
          <label for="volume">Perkiraan volume <span class="req">*</span></label>
          <input type="text" id="volume" name="volume" value="<?= e($old['volume']) ?>" placeholder="Contoh: 120 titik / 2.500 m kabel / 300 m²" required>
          <?php if (isset($errors['volume'])): ?><p class="field-error"><?= e($errors['volume']) ?></p><?php endif; ?>
        </div>

        <div class="form-group <?= isset($errors['email']) ? 'has-error' : '' ?>">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" value="<?= e($old['email']) ?>" placeholder="nama@perusahaan.com">
          <?php if (isset($errors['email'])): ?><p class="field-error"><?= e($errors['email']) ?></p><?php endif; ?>
        </div>

        <div class="form-group">
          <label for="instansi">Perusahaan / instansi</label>
          <input type="text" id="instansi" name="instansi" value="<?= e($old['instansi']) ?>" placeholder="Opsional">
        </div>

        <div class="form-group">
          <label for="target_waktu">Target waktu pelaksanaan</label>
          <select id="target_waktu" name="target_waktu">
            <?php foreach (['', 'Secepatnya', 'Dalam 1 bulan', 'Dalam 3 bulan', 'Lebih dari 3 bulan', 'Belum ditentukan'] as $opsi): ?>
              <option value="<?= e($opsi) ?>" <?= $old['target_waktu'] === $opsi ? 'selected' : '' ?>><?= $opsi === '' ? 'Pilih (opsional)' : e($opsi) ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="form-group">
          <label for="catatan">Catatan kebutuhan</label>
          <textarea id="catatan" name="catatan" rows="3" placeholder="Contoh: pekerjaan akan dikerjakan bertahap, perlu survey minggu depan"><?= e($old['catatan']) ?></textarea>
        </div>

        <button class="btn btn-primary btn-block btn-lg" type="submit"><?= icon('clipboard', 18) ?> Kirim Permintaan</button>
        <p class="order-fineprint">Dengan mengirim permintaan, Anda setuju dihubungi tim kami melalui WhatsApp atau email. Tidak ada biaya sebelum penawaran disetujui.</p>
      </form>
    </aside>
  </div>
</section>

<?php if ($terkait): ?>
<section class="section section-alt">
  <div class="container">
    <div class="section-head section-head-row">
      <div>
        <span class="eyebrow">Item terkait</span>
        <h2 class="section-title">Pekerjaan lain yang mungkin dibutuhkan</h2>
      </div>
      <a class="btn btn-outline" href="katalog.php">Lihat semua item <?= icon('arrow', 18) ?></a>
    </div>
    <div class="grid grid-3">
      <?php foreach ($terkait as $p): ?>
        <article class="card product-card">
          <a class="product-media" href="produk.php?id=<?= (int) $p['id'] ?>">
            <img src="<?= e(img_url($p['gambar'])) ?>" alt="<?= e($p['nama']) ?>" loading="lazy">
            <?php if ($p['badge'] !== ''): ?><span class="badge"><?= e($p['badge']) ?></span><?php endif; ?>
          </a>
          <div class="product-body">
            <span class="product-cat"><?= e($p['kategori']) ?> &middot; <?= e($p['kode']) ?></span>
            <h3><a href="produk.php?id=<?= (int) $p['id'] ?>"><?= e($p['nama']) ?></a></h3>
            <p><?= e(excerpt($p['excerpt'], 90)) ?></p>
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
<?php endif; ?>

<?php require __DIR__ . '/inc/footer.php'; ?>
