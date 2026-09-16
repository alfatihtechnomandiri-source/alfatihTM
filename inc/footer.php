<footer class="site-footer">
  <div class="container footer-grid">
    <div class="footer-brand">
      <a class="brand brand-light" href="index.php">
        <img class="brand-logo" src="assets/img/logo.png" alt="Logo <?= e(cfg('nama_legal')) ?>" width="52" height="52">
        <span class="brand-text"><strong><?= e(cfg('nama')) ?></strong><small><?= e(cfg('tagline')) ?></small></span>
      </a>
      <p class="footer-about"><?= e(cfg('deskripsi')) ?> Kami melayani pekerjaan fiber optik, konstruksi gedung, perencanaan, hingga manajemen data konstruksi.</p>
      <dl class="footer-legal">
        <div><dt>Badan hukum</dt><dd><?= e(cfg('legal')['badan_hukum']) ?></dd></div>
        <div><dt>Berdiri</dt><dd><?= e(cfg('tanggal_berdiri')) ?></dd></div>
        <div><dt>SK Kemenkumham</dt><dd>AHU-0138961.AH.01.01.TAHUN 2022</dd></div>
      </dl>
    </div>

    <div class="footer-col">
      <h4>Navigasi</h4>
      <ul>
        <?php foreach (nav_items() as $file => $label): ?>
          <li><a href="<?= e($file) ?>"><?= e($label) ?></a></li>
        <?php endforeach; ?>
      </ul>
    </div>

    <div class="footer-col">
      <h4>Layanan</h4>
      <ul>
        <?php foreach (array_slice(services(), 0, 5) as $s): ?>
          <li><a href="kontak.php?layanan=<?= e(urlencode($s['nama'])) ?>"><?= e($s['nama']) ?></a></li>
        <?php endforeach; ?>
      </ul>
    </div>

    <div class="footer-col footer-contact">
      <h4>Hubungi Kami</h4>
      <ul>
        <li><?= icon('pin', 16) ?><span><?= e(cfg('alamat')) ?></span></li>
        <li><?= icon('phone', 16) ?><a href="tel:<?= e(preg_replace('/[^0-9+]/', '', (string) cfg('telepon'))) ?>"><?= e(cfg('telepon')) ?></a></li>
        <li><?= icon('whatsapp', 16) ?><a href="<?= e(wa_link(wa_default_text())) ?>" target="_blank" rel="noopener"><?= e(cfg('whatsapp_tampil')) ?></a></li>
        <li><?= icon('mail', 16) ?><a href="mailto:<?= e(cfg('email')) ?>"><?= e(cfg('email')) ?></a></li>
      </ul>
      <a class="btn btn-ghost-light btn-sm" href="<?= e(wa_link(wa_default_text())) ?>" target="_blank" rel="noopener"><?= icon('whatsapp', 16) ?> WhatsApp</a>
    </div>
  </div>

  <div class="container footer-bottom">
    <p>&copy; <?= date('Y') ?> <?= e(cfg('nama_legal')) ?>. Seluruh hak cipta dilindungi.</p>
    <p class="footer-bottom-links">
      <a href="katalog.php">Katalog Produk &amp; Jasa</a>
      <span>&middot;</span>
      <a href="portofolio.php">Portofolio</a>
      <span>&middot;</span>
      <a href="kontak.php">Kontak</a>
    </p>
  </div>
</footer>

<a class="wa-float" href="<?= e(wa_link(wa_default_text())) ?>" target="_blank" rel="noopener" aria-label="Chat WhatsApp">
  <?= icon('whatsapp', 26) ?>
</a>
<button class="to-top" id="toTop" aria-label="Kembali ke atas"><?= icon('arrow', 20) ?></button>

<script src="assets/js/app.js"></script>
</body>
</html>
