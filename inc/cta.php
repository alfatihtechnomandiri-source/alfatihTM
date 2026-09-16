<?php
/** Ajakan kerja sama — dipasang di akhir setiap halaman. */
$cta_judul = $cta_judul ?? 'Siap mengerjakan pekerjaan Anda berikutnya?';
$cta_teks = $cta_teks ?? 'Sampaikan kebutuhan pekerjaan fiber optik atau konstruksi Anda, kami bantu susun lingkup kerja, volume pekerjaan, dan penawaran resmi.';
?>
<section class="cta-band">
  <img class="cta-bg" src="<?= e(img_url('cta.jpg')) ?>" alt="" loading="lazy">
  <div class="container cta-inner">
    <div class="cta-copy">
      <span class="eyebrow eyebrow-light">Mulai dari sini</span>
      <h2><?= e($cta_judul) ?></h2>
      <p><?= e($cta_teks) ?></p>
    </div>
    <div class="cta-actions">
      <a class="btn btn-light" href="kontak.php"><?= icon('clipboard', 18) ?> Minta Penawaran</a>
      <a class="btn btn-outline-light" href="<?= e(wa_link(wa_default_text())) ?>" target="_blank" rel="noopener"><?= icon('whatsapp', 18) ?> Chat WhatsApp</a>
    </div>
  </div>
</section>
