<?php
$pageTitle = 'Lyd Batter & Dough';
$siteTitle = 'Lyd Batter & Dough';
$siteSubtitle = 'Pastri Artisan dikemas kini setiap hari. Gunakan butang Pesan untuk membina troli anda dan hantar melalui WhatsApp.';
$isIndexPage = true;
include __DIR__ . '/header.php';

// compute product grid column class based on available products
$productCount = is_array($products) ? count($products) : 0;
if ($productCount <= 1) {
  $cols = 1;
} elseif ($productCount === 2) {
  $cols = 2;
} else {
  $cols = 3;
}
$colsClass = 'cols-' . $cols;
?>

    <section class="hero-fullscreen">
      <div class="hero-overlay"></div>
      <div class="hero-content">
        <h2>Dibuat segar setiap hari</h2>
        <p>Pastri artisan berkualiti tinggi dengan bahan terbaik</p>
        <div class="muted">Klik item untuk membuat pesanan atau semak semula esok untuk menu baru.</div>
      </div>
    </section>

    <?php
    // Load event configuration from events.json (optional). The event section
    // will only render when the JSON contains { "active": true }.
    $eventsPath = __DIR__ . '/../data/events.json';
    $eventData = null;
    if (file_exists($eventsPath)) {
      $json = @file_get_contents($eventsPath);
      $eventData = $json ? @json_decode($json, true) : null;
    }

    if (!empty($eventData['active'])):
      $slides = !empty($eventData['slides']) && is_array($eventData['slides']) ? $eventData['slides'] : [ 'assets/placeholder.svg' ];
      $title = $eventData['title'] ?? 'Sertai Kami di Acara Mendatang!';
      $date = $eventData['date'] ?? '';
      $location = $eventData['location'] ?? '';
      $time = $eventData['time'] ?? '';
    ?>

    <section class="event-banner">
      <div class="event-carousel">
        <div class="carousel-container">
          <div class="carousel-track" id="event-carousel-track">
            <?php foreach ($slides as $i => $slide): ?>
            <div class="carousel-slide<?= $i === 0 ? ' active' : '' ?>">
              <img src="<?= url($slide) ?>" alt="Event Photo <?= $i + 1 ?>" class="event-photo">
            </div>
            <?php endforeach; ?>
          </div>
        </div>
        <div class="carousel-dots" id="event-carousel-dots"></div>
      </div>
      <div class="event-details">
        <h3><?= e($title) ?></h3>
        <div class="event-info-grid">
          <?php if ($date): ?>
            <div class="event-info"><strong>📅 Tarikh:</strong> <?= e($date) ?></div>
          <?php endif; ?>
          <?php if ($location): ?>
            <div class="event-info"><strong>📍 Lokasi:</strong> <?= e($location) ?></div>
          <?php endif; ?>
          <?php if ($time): ?>
            <div class="event-info"><strong>⏰ Masa:</strong> <?= e($time) ?></div>
          <?php endif; ?>
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

    <?php endif; ?>

    <main class="product-grid <?= isset($colsClass) ? $colsClass : '' ?>">
      <?php if (empty($products)): ?>
        <div class="card"><div class="card-body"><p>Tiada item hari ini. Sila semak semula esok.</p></div></div>
      <?php else: ?>
        <?php foreach ($products as $p): ?>
          <article class="card">
            <?php $local = !empty($p['images'][0]) ? $p['images'][0] : ($p['image'] ?? null); ?>
            <?php $imgUrl = best_image_for($p['name'], $local ?? null, 900, 900); ?>
            <a href="<?= url('product/' . rawurlencode($p['id'])) ?>"><img src="<?= e($imgUrl) ?>" alt="<?= e($p['name']) ?>"></a>
            <div class="card-body">
              <h2><a href="<?= url('product/' . rawurlencode($p['id'])) ?>" style="color:inherit;text-decoration:none"><?= e($p['name']) ?></a></h2>
              <p class="desc"><?= e($p['description'] ?? '') ?></p>
              <div class="price">RM<?= number_format($p['price'] ?? 0, 2) ?></div>
              <div class="actions">
                <a class="btn" href="<?= url('product/' . rawurlencode($p['id'])) ?>">Lihat / Pesan</a>
              </div>
            </div>
          </article>
        <?php endforeach; ?>
      <?php endif; ?>
    </main>

<?php include __DIR__ . '/footer.php'; ?>
