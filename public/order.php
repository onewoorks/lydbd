<?php
require_once __DIR__ . '/../app/bootstrap.php';

$pageTitle = 'Your order';
$siteTitle = 'Your order';
$siteSubtitle = 'Review your order and confirm before sending via WhatsApp.';
include __DIR__ . '/../views/header.php';
include __DIR__ . '/../views/order.view.php';
include __DIR__ . '/../views/footer.php';
