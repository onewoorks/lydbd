<?php
// Redirect /toggle?id=...&token=... to pretty /toggle/{id}?token=...
$id = $_GET['id'] ?? null;
$token = isset($_GET['token']) ? 'token=' . rawurlencode($_GET['token']) : '';
$action = isset($_GET['action']) ? 'action=' . rawurlencode($_GET['action']) : '';
if ($id) {
    $q = implode('&', array_filter([$token,$action]));
    $loc = '/toggle/' . rawurlencode($id) . ($q ? '?' . $q : '');
    header('Location: ' . $loc);
    exit;
}
header('Location: /admin');
exit;
