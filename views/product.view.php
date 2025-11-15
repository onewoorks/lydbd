<?php
$pageTitle = ($product['name'] ?? 'Product') . ' — Details';
$siteTitle = $product['name'] ?? 'Product';
$siteSubtitle = $product['description'] ?? '';
include __DIR__ . '/header.php';
?>

    <div class="detail-wrap">
      <section class="detail-grid">
        <div>
          <div class="gallery-main">
            <?php $mainImage = (!empty($product['images'][0]) ? $product['images'][0] : ($product['image'] ?? null)); ?>
            <?php $mainUrl = best_image_for($product['name'], $mainImage ?? null, 1400, 900); ?>
            <img id="mainImage" class="gallery-main-img" src="<?= e($mainUrl) ?>" alt="<?= e($product['name']) ?>">
          </div>
          <?php if (!empty($product['images']) && is_array($product['images'])): ?>
            <div class="thumbs">
                <?php foreach ($product['images'] as $img): ?>
                <?php $thumbUrl = best_image_for($product['name'], $img, 300, 240); ?>
                <img src="<?= e($thumbUrl) ?>" data-src="<?= e($thumbUrl) ?>" alt="thumb">
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
        </div>

        <aside class="admin-card">
              <div style="font-size:1.1rem;font-weight:600">Price: <span id="priceView">$<?= number_format($product['price'] ?? 0,2) ?></span></div>

      <form id="orderForm" onsubmit="return false;">
                <?php if (!empty($product['options']['flavours'])): ?>
              <div class="option-row">
                <label class="muted">Flavour</label>
                    <?php foreach ($product['options']['flavours'] as $i => $f): ?>
                      <div><label style="font-weight:500"><input type="radio" name="flavour" value="<?= e($f) ?>" <?= $i===0 ? 'checked' : '' ?>> <?= e($f) ?></label></div>
                    <?php endforeach; ?>
              </div>
            <?php endif; ?>

                <?php if (!empty($product['options']['packages'])): ?>
              <div class="option-row">
                <label class="muted">Package</label>
                <select name="package" id="packageSelect" class="form-control">
                    <?php foreach ($product['options']['packages'] as $pkg): ?>
                      <option value='<?= e(json_encode($pkg)) ?>'><?= e($pkg['label']) ?> — $<?= number_format($pkg['price'],2) ?></option>
                    <?php endforeach; ?>
                </select>
              </div>
            <?php endif; ?>

            <div class="option-row">
              <label class="muted">Note (optional)</label>
              <textarea name="note" id="note" rows="3" class="form-control"></textarea>
            </div>

            <div class="option-row">
              <label class="muted">Quantity</label>
              <input type="number" id="qtyInput" name="qty" value="1" min="1" class="form-control qty">
            </div>

            <div class="order-actions">
              <button id="addToCartBtn" class="btn full">Add to cart</button>
              <a class="btn secondary" href="<?= url('order') ?>">View cart</a>
            </div>
          </form>
        </aside>
      </section>
    </div>

    <script>
    (function(){
      var main = document.getElementById('mainImage');
      document.querySelectorAll('.thumbs img').forEach(function(t){ t.addEventListener('click', function(){ main.src = t.getAttribute('data-src'); }); });
      var addToCartBtn = document.getElementById('addToCartBtn');
      if (addToCartBtn) {
        addToCartBtn.addEventListener('click', function(){
          var name = <?= json_encode($product['name']) ?>;
          var packageVal = document.getElementById('packageSelect') ? document.getElementById('packageSelect').value : null;
          var packageLabel = '';
          var packageObj = null;
          if (packageVal) { try{ packageObj = JSON.parse(packageVal); packageLabel = packageObj.label || ''; }catch(e){} }
          var flavour = document.querySelector('input[name="flavour"]:checked') ? document.querySelector('input[name="flavour"]:checked').value : null;
          var note = document.getElementById('note') ? document.getElementById('note').value : '';
          var qty = document.getElementById('qtyInput') ? Math.max(1, parseInt(document.getElementById('qtyInput').value||1)) : 1;
          var price = packageObj ? Number(packageObj.price) : Number(<?= json_encode($product['price'] ?? 0) ?>);
          var item = { id: <?= json_encode($product['id']) ?>, name: name, package: packageObj ? packageObj.count : null, packageLabel: packageLabel, flavour: flavour, note: note, qty: qty, price: price };
          LydiaCart.addToCart(item);
          window.location.href = '<?= url('order') ?>';
        });
      }
    })();
    </script>

<?php include __DIR__ . '/footer.php'; ?>
