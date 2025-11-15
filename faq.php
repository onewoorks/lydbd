<?php
require_once __DIR__ . '/app/bootstrap.php';
$pageTitle = 'FAQ — How to order';
$siteTitle = 'FAQ';
$siteSubtitle = 'How to order and common questions.';
include __DIR__ . '/views/header.php';
?>

  <main class="admin-card" style="margin-top:18px">
    <h3>How do I order?</h3>
    <p>Open a product detail and choose package and flavour (if available). Click "Order via WhatsApp" to send us your order with details. You can also email us using the Email button.</p>

    <h3>Can I change availability?</h3>
    <p>Yes — the seller can toggle items using the admin share links. These links can be sent via WhatsApp/Telegram to quickly enable/disable products for the day.</p>

    <h3>Payment & pickup</h3>
    <p>Payment options depend on the seller: cash on pickup, bank transfer, or payment gateway (coming soon). Ask via WhatsApp for available payment methods.</p>
  </main>

<?php include __DIR__ . '/views/footer.php'; ?>

