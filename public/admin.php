<?php
// Delegate to front controller
require_once __DIR__ . '/../app/bootstrap.php';
require_once __DIR__ . '/../app/Router.php';
$router = new Router();
$router->dispatch('/admin', 'GET');
