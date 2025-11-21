<?php
$pageTitle = ($product['name'] ?? 'Product') . ' — Butiran';
$siteTitle = $product['name'] ?? 'Product';
$siteSubtitle = $product['description'] ?? '';
include __DIR__ . '/header.php';
?>

    <div class="detail-wrap">
      <section class="detail-grid">
        <div class="product-detail-hero">
          <div class="product-visual">
            <div class="gallery-main">
              <?php $mainImage = (!empty($product['images'][0]) ? $product['images'][0] : ($product['image'] ?? null)); ?>
              <?php $mainUrl = best_image_for($product['name'], $mainImage ?? null, 1400, 900); ?>
              <img id="mainImage" class="gallery-main-img" src="/<?= e($mainUrl) ?>" alt="<?= e($product['name']) ?>">
            </div>
            <?php if (!empty($product['images']) && is_array($product['images'])): ?>
              <div class="thumbs">
                  <?php foreach ($product['images'] as $img): ?>
                  <?php $thumbUrl = best_image_for($product['name'], $img, 300, 240); ?>
                  <img src="/<?= e($thumbUrl) ?>" data-src="/<?= e($thumbUrl) ?>" alt="thumb">
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
          </div>

          <aside class="product-info-card sticky-float">
            <div class="product-head">
              <h1 class="product-title"><?= e($product['name']) ?></h1>
              <?php if (!empty($product['description'])): ?><div class="product-sub"><?= e($product['description']) ?></div><?php endif; ?>
            </div>

            <?php 
              $initialPrice = $product['price'] ?? 0;
              if ($product['id'] === 'scone' && !empty($product['options']['sizes'])) {
                if (!empty($product['options']['sizes'][0]['flavours'][0]['label'])) {
                  $firstFlavour = $product['options']['sizes'][0]['flavours'][0]['label'];
                  if (!empty($product['options']['sizes'][0]['packages'][0]['flavours'][$firstFlavour])) {
                    $initialPrice = $product['options']['sizes'][0]['packages'][0]['flavours'][$firstFlavour];
                  }
                }
              }
            ?>
            <div class="product-price">RM<span id="priceView"><?= number_format($initialPrice,2) ?></span></div>

            <form id="orderForm" onsubmit="return false;">
              <?php if ($product['id'] === 'scone' && !empty($product['options']['sizes'])): ?>
                <!-- Scone with size selection -->
                <div class="option-row">
                  <label class="muted">Saiz</label>
                  <div class="size-options" id="sizeOptions">
                    <?php foreach ($product['options']['sizes'] as $i => $size): ?>
                      <button type="button" class="size-btn <?= $i===0 ? 'active' : '' ?>" data-size-idx="<?= $i ?>" data-size='<?= e(json_encode($size)) ?>'><?= e($size['label']) ?></button>
                    <?php endforeach; ?>
                  </div>
                </div>
                
                <div class="option-row">
                  <label class="muted">Perisa</label>
                  <div class="size-options" id="flavourOptions">
                    <!-- Populated by JS based on size -->
                  </div>
                </div>

                <div class="option-row">
                  <label class="muted">Pakej</label>
                  <div class="size-options" id="packageOptions">
                    <!-- Populated by JS based on flavour -->
                  </div>
                </div>

              <?php elseif ($product['id'] === 'bagels' && !empty($product['options']['flavours'])): ?>
                <div class="option-row">
                  <label class="muted">Pilih Perisa & Kuantiti (Min 3 unit total)</label>
                  <div id="bagelFlavourList" style="display:flex;flex-direction:column;gap:12px">
                    <?php foreach ($product['options']['flavours'] as $i => $f): ?>
                      <?php 
                        $flavourLabel = is_array($f) ? $f['label'] : $f;
                        $flavourPrice = is_array($f) ? ($f['price'] ?? 0) : 0;
                        $unitPrice = ($product['price'] ?? 0) + $flavourPrice;
                      ?>
                      <div class="bagel-flavour-row" style="display:flex;align-items:center;gap:12px;padding:10px;border:1px solid var(--border);border-radius:8px">
                        <div style="flex:1">
                          <strong><?= e($flavourLabel) ?></strong>
                          <div class="muted" style="font-size:0.9rem">RM<?= number_format($unitPrice, 2) ?> per unit</div>
                        </div>
                        <div style="display:flex;align-items:center;gap:8px">
                          <button type="button" class="qty-btn qty-minus" data-target="bagel-<?= $i ?>" style="width:36px;height:36px;border-radius:6px;border:1px solid var(--border);background:#fff;cursor:pointer;font-size:1.2rem;font-weight:700;display:flex;align-items:center;justify-content:center">−</button>
                          <input type="number" id="bagel-<?= $i ?>" class="bagel-qty-input form-control qty" data-flavour="<?= e($flavourLabel) ?>" data-price="<?= $unitPrice ?>" value="0" min="0" style="width:60px;text-align:center" readonly>
                          <button type="button" class="qty-btn qty-plus" data-target="bagel-<?= $i ?>" style="width:36px;height:36px;border-radius:6px;border:1px solid var(--border);background:#fff;cursor:pointer;font-size:1.2rem;font-weight:700;display:flex;align-items:center;justify-content:center">+</button>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  </div>
                  <div id="bagelTotalInfo" style="margin-top:8px;padding:8px;background:rgba(107,68,35,0.1);border-radius:6px">
                    <strong>Total: <span id="bagelTotalQty">0</span> unit</strong>
                    <span class="muted" style="margin-left:8px;font-size:0.9rem">(Min 3 unit diperlukan)</span>
                  </div>
                </div>
              <?php elseif (!empty($product['options']['flavours'])): ?>
                <div class="option-row">
                  <label class="muted">Perisa</label>
                  <div class="size-options" id="flavourOptions">
                    <?php foreach ($product['options']['flavours'] as $i => $f): ?>
                      <?php 
                        $flavourLabel = is_array($f) ? $f['label'] : $f;
                        $flavourPrice = is_array($f) ? ($f['price'] ?? 0) : 0;
                        $availablePackages = is_array($f) ? ($f['availablePackages'] ?? []) : [];
                        $priceText = $flavourPrice > 0 ? ' (+RM' . number_format($flavourPrice, 2) . ')' : '';
                      ?>
                      <button type="button" class="size-btn <?= $i===0 ? 'active' : '' ?>" data-flavour="<?= e($flavourLabel) ?>" data-flavour-price="<?= $flavourPrice ?>" data-available-packages='<?= e(json_encode($availablePackages)) ?>'><?= e($flavourLabel . $priceText) ?></button>
                    <?php endforeach; ?>
                  </div>
                </div>
              <?php endif; ?>

              <?php if (!empty($product['options']['packages'])): ?>
                <div class="option-row">
                  <label class="muted">Pakej</label>
                  <div class="size-options" id="packageOptions">
                    <?php foreach ($product['options']['packages'] as $i => $pkg): ?>
                      <button type="button" class="size-btn <?= $i===0 ? 'active' : '' ?>" data-pkg='<?= e(json_encode($pkg)) ?>' data-pkg-label="<?= e($pkg['label']) ?>"><?= e($pkg['label']) ?> — RM<?= number_format($pkg['price'],2) ?></button>
                    <?php endforeach; ?>
                  </div>
                </div>
              <?php endif; ?>

              <?php if (!empty($product['options']['extras'])): ?>
                <div class="option-row">
                  <label class="muted">Tambahan (pilihan)</label>
                  <div id="extrasOptions" style="display:flex;flex-direction:column;gap:12px">
                    <?php foreach ($product['options']['extras'] as $i => $ex): ?>
                      <?php 
                        $extraLabel = is_array($ex) ? $ex['label'] : $ex;
                        $extraPrice = is_array($ex) ? ($ex['price'] ?? 0) : 0;
                      ?>
                      <div class="extra-row" style="display:flex;align-items:center;gap:12px;padding:10px;border:1px solid var(--border);border-radius:8px">
                        <div style="flex:1">
                          <strong><?= e($extraLabel) ?></strong>
                          <div class="muted" style="font-size:0.9rem">RM<?= number_format($extraPrice, 2) ?> per unit</div>
                        </div>
                        <div style="display:flex;align-items:center;gap:8px">
                          <button type="button" class="qty-btn extra-minus" data-target="extra-<?= $i ?>" style="width:36px;height:36px;border-radius:6px;border:1px solid var(--border);background:#fff;cursor:pointer;font-size:1.2rem;font-weight:700;display:flex;align-items:center;justify-content:center">−</button>
                          <input type="number" id="extra-<?= $i ?>" class="extra-qty-input form-control qty" data-extra="<?= e($extraLabel) ?>" data-extra-price="<?= $extraPrice ?>" value="0" min="0" style="width:60px;text-align:center" readonly>
                          <button type="button" class="qty-btn extra-plus" data-target="extra-<?= $i ?>" style="width:36px;height:36px;border-radius:6px;border:1px solid var(--border);background:#fff;cursor:pointer;font-size:1.2rem;font-weight:700;display:flex;align-items:center;justify-content:center">+</button>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  </div>
                </div>
              <?php endif; ?>

              <div class="option-row">
                <label class="muted">Catatan (pilihan)</label>
                <textarea name="note" id="note" rows="3" class="form-control"></textarea>
              </div>

              <?php if ($product['id'] !== 'bagels'): ?>
              <div class="option-row">
                <label class="muted">Kuantiti</label>
                <input type="number" id="qtyInput" name="qty" value="1" min="1" class="form-control qty">
              </div>
              <?php endif; ?>

              <div class="buy-row">
                <button id="addToCartBtn" class="buy-btn">Beli</button>
                <a class="buy-ghost" href="<?= url('order') ?>">Lihat troli</a>
              </div>
            </form>
          </aside>
        </div>
      </section>
    </div>

    <script>
    (function(){
      var main = document.getElementById('mainImage');
      document.querySelectorAll('.thumbs img').forEach(function(t){ t.addEventListener('click', function(){ main.src = t.getAttribute('data-src'); }); });

      var isScone = <?= json_encode($product['id'] === 'scone') ?>;
      var productData = <?= json_encode($product['options'] ?? []) ?>;
      
      // Scone size-based selection
      if (isScone && productData.sizes) {
        var currentSize = null;
        var currentFlavour = null;
        var currentPackage = null;
        
        function initSize(sizeIdx) {
          currentSize = productData.sizes[sizeIdx];
          var flavourContainer = document.getElementById('flavourOptions');
          flavourContainer.innerHTML = '';
          
          currentSize.flavours.forEach(function(f, i){
            var btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'size-btn' + (i === 0 ? ' active' : '');
            btn.dataset.flavour = f.label;
            btn.dataset.availablePackages = JSON.stringify(f.availablePackages);
            btn.textContent = f.label;
            btn.addEventListener('click', function(){
              document.querySelectorAll('#flavourOptions .size-btn').forEach(function(x){ x.classList.remove('active'); });
              btn.classList.add('active');
              currentFlavour = btn.dataset.flavour;
              updatePackages();
            });
            flavourContainer.appendChild(btn);
          });
          
          currentFlavour = currentSize.flavours[0].label;
          updatePackages();
        }
        
        function updatePackages() {
          var packageContainer = document.getElementById('packageOptions');
          packageContainer.innerHTML = '';
          
          var activeFlavourBtn = document.querySelector('#flavourOptions .size-btn.active');
          if (!activeFlavourBtn) return;
          
          var availablePackages = JSON.parse(activeFlavourBtn.dataset.availablePackages);
          var matchingPackages = currentSize.packages.filter(function(pkg){
            return availablePackages.indexOf(pkg.label) !== -1;
          });
          
          matchingPackages.forEach(function(pkg, i){
            var price = pkg.flavours[activeFlavourBtn.dataset.flavour];
            if (price === undefined) return;
            
            var btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'size-btn' + (i === 0 ? ' active' : '');
            btn.dataset.pkgLabel = pkg.label;
            btn.dataset.price = price;
            btn.textContent = pkg.label + ' — RM' + price.toFixed(2);
            btn.addEventListener('click', function(){
              document.querySelectorAll('#packageOptions .size-btn').forEach(function(x){ x.classList.remove('active'); });
              btn.classList.add('active');
              updatePrice();
            });
            packageContainer.appendChild(btn);
          });
          
          updatePrice();
        }
        
        function updatePrice() {
          var activePkg = document.querySelector('#packageOptions .size-btn.active');
          var extraInputs = document.querySelectorAll('.extra-qty-input');
          
          var price = activePkg ? Number(activePkg.dataset.price) : 0;
          var extrasTotal = 0;
          
          extraInputs.forEach(function(inp){
            var qty = parseInt(inp.value) || 0;
            var unitPrice = parseFloat(inp.dataset.extraPrice) || 0;
            extrasTotal += qty * unitPrice;
          });
          
          document.getElementById('priceView').textContent = (price + extrasTotal).toFixed(2);
        }
        
        // Size button handlers
        document.querySelectorAll('#sizeOptions .size-btn').forEach(function(b){
          b.addEventListener('click', function(){
            document.querySelectorAll('#sizeOptions .size-btn').forEach(function(x){ x.classList.remove('active'); });
            b.classList.add('active');
            initSize(Number(b.dataset.sizeIdx));
          });
        });
        
        // Extras +/- button handlers
        document.querySelectorAll('.extra-plus').forEach(function(btn){
          btn.addEventListener('click', function(){
            var targetId = btn.dataset.target;
            var input = document.getElementById(targetId);
            if (input) {
              var currentVal = parseInt(input.value) || 0;
              input.value = currentVal + 1;
              updatePrice();
            }
          });
        });
        
        document.querySelectorAll('.extra-minus').forEach(function(btn){
          btn.addEventListener('click', function(){
            var targetId = btn.dataset.target;
            var input = document.getElementById(targetId);
            if (input) {
              var currentVal = parseInt(input.value) || 0;
              if (currentVal > 0) {
                input.value = currentVal - 1;
                updatePrice();
              }
            }
          });
        });
        
        // Initialize with first size
        initSize(0);
      }

      // helper to update price view from selected package button
      function updatePriceFromPackage(){
        var activePkg = document.querySelector('#packageOptions .size-btn.active');
        var activeFlavour = document.querySelector('#flavourOptions .size-btn.active');
        var activeExtras = document.querySelectorAll('#extrasOptions .size-btn.active');
        var basePrice = Number(<?= json_encode($product['price'] ?? 0) ?>) || 0;
        var flavourPrice = 0;
        var extrasTotal = 0;
        
        // get flavour additional price
        if (activeFlavour && activeFlavour.dataset.flavourPrice) {
          flavourPrice = Number(activeFlavour.dataset.flavourPrice) || 0;
        }
        
        // get extras total price
        activeExtras.forEach(function(ex){
          if (ex.dataset.extraPrice) {
            extrasTotal += Number(ex.dataset.extraPrice) || 0;
          }
        });
        
        if (activePkg && activePkg.dataset.pkg){
          try{ 
            var pkg = JSON.parse(activePkg.dataset.pkg); 
            var totalPrice = Number(pkg.price) + flavourPrice + extrasTotal;
            document.getElementById('priceView').textContent = totalPrice.toFixed(2); 
            return; 
          }catch(e){}
        }
        var totalPrice = basePrice + flavourPrice + extrasTotal;
        document.getElementById('priceView').textContent = totalPrice.toFixed(2);
      }

      // helper to filter packages based on selected flavour
      function filterPackagesByFlavour(){
        var activeFlavour = document.querySelector('#flavourOptions .size-btn.active');
        if (!activeFlavour || !activeFlavour.dataset.availablePackages) return;
        
        try{
          var availablePackages = JSON.parse(activeFlavour.dataset.availablePackages);
          
          // if no restriction, show all
          if (availablePackages.length === 0) {
            document.querySelectorAll('#packageOptions .size-btn').forEach(function(pb){
              pb.style.display = '';
              pb.disabled = false;
            });
            return;
          }
          
          // filter packages
          var anyActive = false;
          document.querySelectorAll('#packageOptions .size-btn').forEach(function(pb){
            var pkgLabel = pb.dataset.pkgLabel;
            if (availablePackages.indexOf(pkgLabel) !== -1) {
              pb.style.display = '';
              pb.disabled = false;
              if (pb.classList.contains('active')) anyActive = true;
            } else {
              pb.style.display = 'none';
              pb.disabled = true;
              pb.classList.remove('active');
            }
          });
          
          // activate first available if none active
          if (!anyActive) {
            var firstAvailable = document.querySelector('#packageOptions .size-btn:not([style*="display: none"])');
            if (firstAvailable) firstAvailable.classList.add('active');
          }
        }catch(e){}
      }

      // flavour buttons behavior
      document.querySelectorAll('#flavourOptions .size-btn').forEach(function(b){
        b.addEventListener('click', function(){
          document.querySelectorAll('#flavourOptions .size-btn').forEach(function(x){ x.classList.remove('active'); });
          b.classList.add('active');
          filterPackagesByFlavour();
          updatePriceFromPackage();
        });
      });
      
      // init filter on load
      filterPackagesByFlavour();

      // flavour buttons behavior
      document.querySelectorAll('#flavourOptions .size-btn').forEach(function(b){
        b.addEventListener('click', function(){
          document.querySelectorAll('#flavourOptions .size-btn').forEach(function(x){ x.classList.remove('active'); });
          b.classList.add('active');
          updatePriceFromPackage();
        });
      });

      // extras buttons behavior (can select multiple)
      document.querySelectorAll('#extrasOptions .size-btn').forEach(function(b){
        b.addEventListener('click', function(){
          b.classList.toggle('active');
          updatePriceFromPackage();
        });
      });

      // init price
      updatePriceFromPackage();

      // Bagels multi-flavour handler
      var isBagels = <?= json_encode($product['id'] === 'bagels') ?>;
      if (isBagels) {
        var bagelQtyInputs = document.querySelectorAll('.bagel-qty-input');
        
        function updateBagelTotal() {
          var totalQty = 0;
          var totalPrice = 0;
          bagelQtyInputs.forEach(function(inp){
            var qty = parseInt(inp.value) || 0;
            var price = parseFloat(inp.dataset.price) || 0;
            totalQty += qty;
            totalPrice += qty * price;
          });
          document.getElementById('bagelTotalQty').textContent = totalQty;
          document.getElementById('priceView').textContent = totalPrice.toFixed(2);
        }
        
        bagelQtyInputs.forEach(function(inp){
          inp.addEventListener('input', updateBagelTotal);
        });
        
        // Handle + and - buttons
        document.querySelectorAll('.qty-plus').forEach(function(btn){
          btn.addEventListener('click', function(){
            var targetId = btn.dataset.target;
            var input = document.getElementById(targetId);
            if (input) {
              var currentVal = parseInt(input.value) || 0;
              input.value = currentVal + 1;
              updateBagelTotal();
            }
          });
        });
        
        document.querySelectorAll('.qty-minus').forEach(function(btn){
          btn.addEventListener('click', function(){
            var targetId = btn.dataset.target;
            var input = document.getElementById(targetId);
            if (input) {
              var currentVal = parseInt(input.value) || 0;
              if (currentVal > 0) {
                input.value = currentVal - 1;
                updateBagelTotal();
              }
            }
          });
        });
        
        updateBagelTotal();
      }

      var addToCartBtn = document.getElementById('addToCartBtn');
      if (addToCartBtn) {
        addToCartBtn.addEventListener('click', function(){
          var name = <?= json_encode($product['name']) ?>;
          
          // Special handling for scone with sizes
          if (isScone) {
            var activeSizeBtn = document.querySelector('#sizeOptions .size-btn.active');
            var sizeLabel = activeSizeBtn ? activeSizeBtn.textContent : '';
            var activeFlavourBtn = document.querySelector('#flavourOptions .size-btn.active');
            var flavour = activeFlavourBtn ? activeFlavourBtn.dataset.flavour : null;
            var activePkgBtn = document.querySelector('#packageOptions .size-btn.active');
            var packageLabel = activePkgBtn ? activePkgBtn.dataset.pkgLabel : '';
            var price = activePkgBtn ? Number(activePkgBtn.dataset.price) : 0;
            var extraInputs = document.querySelectorAll('.extra-qty-input');
            var extras = [];
            var extrasTotal = 0;
            extraInputs.forEach(function(inp){
              var qty = parseInt(inp.value) || 0;
              if (qty > 0) {
                var extraName = inp.dataset.extra;
                var extraPrice = parseFloat(inp.dataset.extraPrice) || 0;
                extras.push(extraName + ' x' + qty);
                extrasTotal += qty * extraPrice;
              }
            });
            var note = document.getElementById('note') ? document.getElementById('note').value : '';
            var qty = document.getElementById('qtyInput') ? Math.max(1, parseInt(document.getElementById('qtyInput').value||1)) : 1;
            
            var finalPrice = price + extrasTotal;
            var item = { 
              id: <?= json_encode($product['id']) ?>, 
              name: name + ' (' + sizeLabel + ')', 
              package: null, 
              packageLabel: packageLabel, 
              flavour: flavour, 
              extras: extras.length > 0 ? extras.join(', ') : null, 
              note: note, 
              qty: qty, 
              price: finalPrice 
            };
            LydiaCart.addToCart(item);
            window.location.href = '<?= url('order') ?>';
            return;
          }
          
          // Special handling for bagels
          if (isBagels) {
            var bagelQtyInputs = document.querySelectorAll('.bagel-qty-input');
            var totalQty = 0;
            var bagelItems = [];
            
            bagelQtyInputs.forEach(function(inp){
              var qty = parseInt(inp.value) || 0;
              if (qty > 0) {
                totalQty += qty;
                bagelItems.push({
                  flavour: inp.dataset.flavour,
                  qty: qty,
                  price: parseFloat(inp.dataset.price) || 0
                });
              }
            });
            
            if (totalQty < 3) {
              Swal.fire({
                icon: 'warning',
                title: 'Min Order 3 Unit',
                text: 'Min order 3 unit. Total semasa: ' + totalQty + ' unit',
                confirmButtonColor: '#6B4423'
              });
              return;
            }
            
            var note = document.getElementById('note') ? document.getElementById('note').value : '';
            
            // Add each flavour as separate cart item
            bagelItems.forEach(function(item){
              var cartItem = {
                id: <?= json_encode($product['id']) ?>,
                name: name,
                flavour: item.flavour,
                qty: item.qty,
                price: item.price,
                note: note
              };
              LydiaCart.addToCart(cartItem);
            });
            
            window.location.href = '<?= url('order') ?>';
            return;
          }
          
          // Regular product handling
          var activePkgBtn = document.querySelector('#packageOptions .size-btn.active');
          var packageObj = null; var packageLabel = '';
          if (activePkgBtn && activePkgBtn.dataset.pkg){ try{ packageObj = JSON.parse(activePkgBtn.dataset.pkg); packageLabel = packageObj.label || ''; }catch(e){} }
          var activeFlavourBtn = document.querySelector('#flavourOptions .size-btn.active');
          var flavour = activeFlavourBtn ? activeFlavourBtn.dataset.flavour : null;
          var flavourPrice = activeFlavourBtn && activeFlavourBtn.dataset.flavourPrice ? Number(activeFlavourBtn.dataset.flavourPrice) : 0;
          var activeExtrasBtns = document.querySelectorAll('#extrasOptions .size-btn.active');
          var extras = [];
          var extrasTotal = 0;
          activeExtrasBtns.forEach(function(ex){
            extras.push(ex.dataset.extra);
            extrasTotal += Number(ex.dataset.extraPrice) || 0;
          });
          var note = document.getElementById('note') ? document.getElementById('note').value : '';
          var qty = document.getElementById('qtyInput') ? Math.max(1, parseInt(document.getElementById('qtyInput').value||1)) : 1;
          var price = packageObj ? (Number(packageObj.price) + flavourPrice + extrasTotal) : (Number(<?= json_encode($product['price'] ?? 0) ?>) + flavourPrice + extrasTotal);
          var item = { id: <?= json_encode($product['id']) ?>, name: name, package: packageObj ? packageObj.count : null, packageLabel: packageLabel, flavour: flavour, extras: extras.length > 0 ? extras.join(', ') : null, note: note, qty: qty, price: price };
          LydiaCart.addToCart(item);
          window.location.href = '<?= url('order') ?>';
        });
      }
    })();
    </script>

<?php include __DIR__ . '/footer.php'; ?>
