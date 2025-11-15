<?php
// Redirect to pretty /product/{id} route
$id = $_GET['id'] ?? null;
if ($id) {
    header('Location: /product/' . rawurlencode($id));
    exit;
}
header('Location: /');
exit;
