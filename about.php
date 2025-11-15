<?php
require_once __DIR__ . '/app/bootstrap.php';
$pageTitle = 'About Us';
$siteTitle = 'About Us';
$siteSubtitle = 'Small-batch bakery making fresh bread & cookies daily.';
include __DIR__ . '/views/header.php';
?>

  <main class="admin-card" style="margin-top:18px">
    <p>We bake fresh daily using high-quality ingredients. Stock and available items change by the day — check the site or ask us via WhatsApp for today's selection.</p>
    <h3>Contact</h3>
    <p class="muted">Orders via WhatsApp or email. For wholesale or larger orders, contact us directly.</p>
  </main>

<?php include __DIR__ . '/views/footer.php'; ?>

