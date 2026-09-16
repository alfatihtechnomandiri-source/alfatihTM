<?php
$active = current_page();
$page_title = $page_title ?? 'Home';
$page_desc = $page_desc ?? cfg('deskripsi');
$nama_situs = cfg('nama');
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($page_title) ?> &middot; <?= e(cfg('nama_legal')) ?></title>
<meta name="description" content="<?= e($page_desc) ?>">
<meta name="theme-color" content="#0B2545">
<meta property="og:type" content="website">
<meta property="og:site_name" content="<?= e(cfg('nama_legal')) ?>">
<meta property="og:title" content="<?= e($page_title) ?> &middot; <?= e(cfg('nama_legal')) ?>">
<meta property="og:description" content="<?= e($page_desc) ?>">
<meta property="og:image" content="assets/img/og-image.jpg">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="<?= e(cfg('nama_legal')) ?> — <?= e(cfg('tagline')) ?>">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:image" content="assets/img/og-image.jpg">
<link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32.png">
<link rel="icon" type="image/png" sizes="192x192" href="assets/img/favicon-192.png">
<link rel="apple-touch-icon" href="assets/img/apple-touch-icon.png">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="<?= $active === 'index.php' ? 'is-home' : 'is-inner' ?>">

<div class="topbar">
  <div class="container topbar-inner">
    <div class="topbar-left">
      <a href="mailto:<?= e(cfg('email')) ?>" aria-label="Kirim email ke <?= e(cfg('email')) ?>"><?= icon('mail', 16) ?><span><?= e(cfg('email')) ?></span></a>
      <span class="topbar-item"><?= icon('pin', 16) ?><span>Simalungun, Sumatera Utara</span></span>
    </div>
    <div class="topbar-right">
      <a class="topbar-item" href="http://<?= e(cfg('website')) ?>" target="_blank" rel="noopener"><?= icon('building', 16) ?><span><?= e(cfg('website')) ?></span></a>
      <a href="tel:<?= e(preg_replace('/[^0-9+]/', '', (string) cfg('telepon'))) ?>"><?= icon('phone', 16) ?><span><?= e(cfg('telepon')) ?></span></a>
    </div>
  </div>
</div>

<header class="site-header" id="siteHeader">
  <div class="container header-inner">
    <a class="brand" href="index.php" aria-label="<?= e(cfg('nama_legal')) ?>">
      <img class="brand-logo" src="assets/img/logo.png" alt="Logo <?= e(cfg('nama_legal')) ?>" width="46" height="46">
      <span class="brand-text">
        <strong><?= e(cfg('nama')) ?></strong>
        <small><?= e(cfg('tagline')) ?></small>
      </span>
    </a>

    <nav class="site-nav" id="siteNav" aria-label="Menu utama">
      <?php foreach (nav_items() as $file => $label): ?>
        <a href="<?= e($file) ?>" class="<?= $active === $file ? 'is-active' : '' ?>"><?= e($label) ?></a>
      <?php endforeach; ?>
      <a class="btn btn-primary btn-sm nav-cta" href="kontak.php">Minta Penawaran</a>
    </nav>

    <button class="nav-toggle" id="navToggle" aria-label="Buka menu" aria-expanded="false">
      <span class="nav-toggle-open"><?= icon('menu', 22) ?></span>
      <span class="nav-toggle-close"><?= icon('close', 22) ?></span>
    </button>
  </div>
</header>
