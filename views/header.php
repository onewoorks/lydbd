<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?= htmlspecialchars($pageTitle ?? 'Bakery') ?></title>
  <link rel="stylesheet" href="<?= url('assets/style.css') ?>">
</head>
<body>
  <div class="container">
    <header class="site-header">
      <div class="brand">
        <a href="<?= url('/') ?>" style="display:flex;align-items:center;gap:12px;color:inherit;text-decoration:none">
          <div class="logo">B</div>
          <div>
            <h1><?= e($siteTitle ?? 'Bakery') ?></h1>
            <?php if (!empty($siteSubtitle)): ?><div class="muted"><?= e($siteSubtitle) ?></div><?php endif; ?>
          </div>
        </a>
      </div>
        <button class="hamburger" id="site-hamburger" aria-label="Open menu" aria-expanded="false" aria-controls="site-nav">
          <span class="hamburger-box"><span class="hamburger-inner"></span></span>
        </button>
        <div class="nav nav-links" id="site-nav">
          <a class="muted" href="<?= url('/') ?>" style="margin-right:12px">Fresh Bakes</a>
          <a class="muted" href="<?= url('about') ?>" style="margin-right:12px">About</a>
          <a class="muted" href="<?= url('faq') ?>" style="margin-right:12px">FAQ</a>
          <span class="cart-badge">
            <a class="btn" href="<?=url('/order')?>">Order</a>
            <span class="count" id="lydia-cart-count" style="display:none">0</span>
          </span>
        </div>
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
