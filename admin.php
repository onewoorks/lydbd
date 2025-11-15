<?php
require_once __DIR__ . '/app/bootstrap.php';
$controller = new AdminController(new ProductModel());
// If called as toggle endpoint
if (!empty($_GET['action']) || (isset($_GET['id']) && isset($_GET['token']) && ($_GET['action'] ?? 'toggle'))) {
    $id = $_GET['id'] ?? null;
    $token = $_GET['token'] ?? null;
    $action = $_GET['action'] ?? 'toggle';
    $controller->toggle($id, $token, $action);
    exit;
}

$controller->index();
?>
