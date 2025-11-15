<?php
// Simple bootstrap for MVC
define('APP_ROOT', __DIR__ . '/../');
require_once APP_ROOT . 'config.php';

// Load model and controllers
require_once APP_ROOT . 'app/Model/ProductModel.php';
require_once APP_ROOT . 'app/Controllers/ProductController.php';
require_once APP_ROOT . 'app/Controllers/AdminController.php';
// helpers
require_once APP_ROOT . 'app/helpers.php';

?>
