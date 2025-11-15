<?php
$pageTitle = 'Lyd Batter & Dough';
$siteTitle = 'Lyd Batter & Dough';
$siteSubtitle = 'Fresh items updated daily. Use the Order button to build your cart and send via WhatsApp.';
include __DIR__ . '/header.php';
?>

    <section class="hero">
      <div class="left">
        <strong>Available now</strong>
        <div class="muted">Tap an item to order or check back tomorrow for new items.</div>
      </div>
      <div class="right muted">Items change daily — keep your stock updated via admin links.</div>
    </section>

    <main class="product-grid">
      <?php if (empty($products)): ?>
        <div class="card"><div class="card-body"><p>No items available today. Check again tomorrow.</p></div></div>
      <?php else: ?>
        <?php foreach ($products as $p): ?>
          <article class="card">
            <?php $local = !empty($p['images'][0]) ? $p['images'][0] : ($p['image'] ?? null); ?>
            <?php $imgUrl = best_image_for($p['name'], $local ?? null, 1200, 900); ?>
            <a href="<?= url('product/' . rawurlencode($p['id'])) ?>"><img src="<?= e($imgUrl) ?>" alt="<?= e($p['name']) ?>"></a>
            <div class="card-body">
              <h2><a href="<?= url('product/' . rawurlencode($p['id'])) ?>" style="color:inherit;text-decoration:none"><?= e($p['name']) ?></a></h2>
              <p class="desc"><?= e($p['description'] ?? '') ?></p>
              <div class="price">$<?= number_format($p['price'] ?? 0, 2) ?></div>
              <div class="actions">
                <a class="btn" href="<?= url('product/' . rawurlencode($p['id'])) ?>">View / Order</a>
              </div>
            </div>
          </article>
        <?php endforeach; ?>
      <?php endif; ?>
    </main>

<?php include __DIR__ . '/footer.php'; ?>
