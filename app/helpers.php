<?php
// Small helper utilities for views and controllers
if (!function_exists('e')) {
    function e($str) { return htmlspecialchars($str, ENT_QUOTES, 'UTF-8'); }
}

if (!function_exists('url')) {
    function url($path = '') {
        $base = defined('BASE_URL') ? BASE_URL : '/';
        return rtrim($base, '/') . '/' . ltrim($path, '/');
    }
}

if (!function_exists('unsplash_url')) {
    /**
     * Return an Unsplash source URL for a given set of keywords.
     * Example: unsplash_url('scone, bakery')
     */
    function unsplash_url($terms, $w = 1200, $h = 800) {
        $q = urlencode($terms);
        return "https://source.unsplash.com/{$w}x{$h}/?{$q}";
    }
}

if (!function_exists('best_image_for')) {
    // Choose the best image URL for a product: local path if exists, Pexels if available, otherwise Unsplash
    function best_image_for($productName, $localPath = null, $w = 1200, $h = 900) {
        // 1) local file
        if ($localPath && file_exists(__DIR__ . '/../' . ltrim($localPath, '/'))) {
            return $localPath;
        }
        // 2) pexels if configured and returns a result
        if (defined('PEXELS_API_KEY') && PEXELS_API_KEY) {
            require_once __DIR__ . '/pexels.php';
            $pexels = pexels_search_first($productName . ' bakery', $w, $h);
            if ($pexels) return $pexels;
        }
        // 3) local placeholder image
        $placeholder = 'assets/placeholder.svg';
        if (file_exists(__DIR__ . '/../' . $placeholder)) return $placeholder;
        // last resort: return a very small data-uri SVG placeholder
        return 'data:image/svg+xml;utf8,' . rawurlencode('<svg xmlns="http://www.w3.org/2000/svg" width="1200" height="900"><rect width="100%" height="100%" fill="#f4f4f5"/><text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" fill="#bdbdbd" font-family="sans-serif" font-size="36">No image</text></svg>');
    }
}
