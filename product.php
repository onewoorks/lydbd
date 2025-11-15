<?php
require_once __DIR__ . '/app/bootstrap.php';
$controller = new ProductController(new ProductModel());
$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: index.php');
    exit;
}
$controller->detail($id);
?>
