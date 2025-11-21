<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?= htmlspecialchars($pageTitle ?? 'Bakery') ?></title>
  <link rel="icon" type="image/x-icon" href="<?= url('assets/logo.ico') ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= url('assets/style.css') ?>">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body<?= (isset($isIndexPage) && $isIndexPage) ? ' class="index-page"' : '' ?>>
  <div class="container">
    <header class="site-header">
      <div class="header-top">
        <a href="<?= url('/') ?>" class="header-brand">
          <img src="<?= url('assets/logo.svg') ?>" alt="Batter & Dough Bakery" class="logo">
          <h1><?= e($siteTitle ?? 'Bakery') ?></h1>
          <?php if (!empty($siteSubtitle)): ?><div class="tagline"><?= e($siteSubtitle) ?></div><?php endif; ?>
        </a>
      </div>
      <button class="hamburger" id="site-hamburger" aria-label="Open menu" aria-expanded="false" aria-controls="site-nav">
        <span class="hamburger-box"><span class="hamburger-inner"></span></span>
      </button>
      <nav class="header-nav" id="site-nav">
        <a href="<?= url('/') ?>">Pastri Hari Ini</a>
        <!-- <a href="<?= url('menu') ?>">Menu</a> -->
        <a href="<?= url('gallery') ?>">Galeri</a>
        <a href="<?= url('about') ?>">Tentang</a>
        <a href="<?= url('faq') ?>">Soalan Lazim</a>
        <span class="cart-badge">
          <a class="btn" href="<?= url('order') ?>">Pesan</a>
          <span class="count" id="lydia-cart-count" style="display:none">0</span>
        </span>
      </nav>
      <script>
        // update cart count badge
        function updateCartCount(n){
          var el = document.getElementById('lydia-cart-count'); if(!el) return;
          if(n>0){ el.style.display='inline-block'; el.textContent = n; } else { el.style.display='none'; }
        }
        window.addEventListener('lydia:cart:changed', function(e){ updateCartCount(e.detail.total); });
        document.addEventListener('DOMContentLoaded', function(){ if(window.LydiaCart) updateCartCount(window.LydiaCart.getTotalItems()); });
      </script>
    </header>
