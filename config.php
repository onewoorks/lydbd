<?php
// Basic config for the lightweight product site
// Change SECRET_TOKEN to a strong random value before deployment
define('PRODUCTS_FILE', __DIR__ . '/data/products.json');
define('SECRET_TOKEN', 'change-this-secret-token');
// Admin HTTP basic auth for protecting admin pages (change before deployment)
define('ADMIN_USER', 'admin');
define('ADMIN_PASS', 'password');
// Optional: Pexels API key. If you have one, set it here to fetch themed images from Pexels.
// You can get a free key from https://www.pexels.com/api/
define('PEXELS_API_KEY', '');

// Optional: base URL of your site, used for generating share links in admin
// If you run locally for testing, set to http://localhost:8000 or your host
if (!defined('BASE_URL')) {
    $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    define('BASE_URL', $protocol . '://' . $host . '/');
}

?>
