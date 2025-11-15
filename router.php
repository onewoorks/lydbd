<?php
// Router for PHP built-in server to serve static assets and route other requests to public/index.php
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$file = __DIR__ . $uri;
if ($uri !== '/' && file_exists($file) && !is_dir($file)) {
    return false; // serve the requested resource as-is
}
require_once __DIR__ . '/public/index.php';
