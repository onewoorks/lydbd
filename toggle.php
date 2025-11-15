<?php
require_once __DIR__ . '/app/bootstrap.php';
$controller = new AdminController(new ProductModel());
$id = $_GET['id'] ?? null;
$token = $_GET['token'] ?? null;
$action = $_GET['action'] ?? 'toggle';
$controller->toggle($id, $token, $action);

