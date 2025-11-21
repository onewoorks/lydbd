<?php
require_once __DIR__ . '/../app/bootstrap.php';

$pageTitle = 'Troli Anda';
$siteTitle = 'Troli Anda';
$siteSubtitle = 'Semak pesanan anda dan sahkan sebelum menghantar melalui WhatsApp.';
include __DIR__ . '/../views/header.php';
include __DIR__ . '/../views/order.view.php';
include __DIR__ . '/../views/footer.php';
