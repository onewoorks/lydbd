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

    <!-- Event Section -->
    <section class="event-banner">
      <div class="event-carousel">
        <div class="carousel-container">
          <div class="carousel-track" id="event-carousel-track">
            <div class="carousel-slide active">
              <img src="<?= url('assets/placeholder.svg') ?>" alt="Event Photo 1" class="event-photo">
            </div>
            <div class="carousel-slide">
              <img src="<?= url('assets/placeholder.svg') ?>" alt="Event Photo 2" class="event-photo">
            </div>
            <div class="carousel-slide">
              <img src="<?= url('assets/placeholder.svg') ?>" alt="Event Photo 3" class="event-photo">
            </div>
          </div>
        </div>
        <div class="carousel-dots" id="event-carousel-dots"></div>
      </div>
      <div class="event-details">
        <h3>Join Us at Our Next Event!</h3>
        <div class="event-info-grid">
          <div class="event-info">
            <strong>📅 Date:</strong> Saturday, 23 Nov 2025
          </div>
          <div class="event-info">
            <strong>📍 Location:</strong> Central Park Weekend Market
          </div>
          <div class="event-info">
            <strong>⏰ Time:</strong> 8:00 AM - 2:00 PM
          </div>
        </div>
      </div>
    </section>
    <script>
    (function(){
      const track = document.getElementById('event-carousel-track');
      const dotsContainer = document.getElementById('event-carousel-dots');
      if(!track || !dotsContainer) return;
      const slides = track.querySelectorAll('.carousel-slide');
      let currentIndex = 0;
      // Create dots
      slides.forEach((_, i) => {
        const dot = document.createElement('span');
        dot.className = 'carousel-dot' + (i === 0 ? ' active' : '');
        dot.onclick = () => goToSlide(i);
        dotsContainer.appendChild(dot);
      });
      const dots = dotsContainer.querySelectorAll('.carousel-dot');
      function goToSlide(index){
        slides[currentIndex].classList.remove('active');
        dots[currentIndex].classList.remove('active');
        currentIndex = index;
        slides[currentIndex].classList.add('active');
        dots[currentIndex].classList.add('active');
      }
      function nextSlide(){
        goToSlide((currentIndex + 1) % slides.length);
      }
      // Auto-advance every 4 seconds
      setInterval(nextSlide, 4000);
    })();
    </script>

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
