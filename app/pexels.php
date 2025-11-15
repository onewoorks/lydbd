<?php
/**
 * Simple Pexels fetcher with file cache.
 * Returns a direct image URL or null on failure.
 */
function pexels_search_first($query, $w = 1200, $h = 800) {
    if (!defined('PEXELS_API_KEY') || !PEXELS_API_KEY) return null;
    $cacheDir = __DIR__ . '/../storage/pexels_cache';
    if (!is_dir($cacheDir)) @mkdir($cacheDir, 0755, true);
    $key = md5($query . "-{$w}x{$h}");
    $cacheFile = $cacheDir . '/' . $key . '.txt';
    // return cached
    if (file_exists($cacheFile) && (time() - filemtime($cacheFile) < 60*60*24*7)) {
        return trim(file_get_contents($cacheFile));
    }

    $url = 'https://api.pexels.com/v1/search?per_page=1&query=' . urlencode($query);
    $opts = [
        'http' => [
            'method' => 'GET',
            'header' => "Authorization: " . PEXELS_API_KEY . "\r\nUser-Agent: LydiaSite/1.0\r\n",
            'timeout' => 5
        ]
    ];
    $context = stream_context_create($opts);
    $resp = @file_get_contents($url, false, $context);
    if (!$resp) return null;
    $data = json_decode($resp, true);
    if (!is_array($data) || empty($data['photos'][0])) return null;
    $photo = $data['photos'][0];
    // pick src with approximate size
    $src = $photo['src']['large2x'] ?? $photo['src']['large'] ?? $photo['src']['original'] ?? null;
    if ($src) {
        file_put_contents($cacheFile, $src);
        return $src;
    }
    return null;
}
