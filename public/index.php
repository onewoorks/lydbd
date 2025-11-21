<?php
// Front controller (public entry) — routes managed here

// Debug: Uncomment to see request info
// error_log("REQUEST_URI: " . $_SERVER['REQUEST_URI']);
// error_log("SCRIPT_NAME: " . $_SERVER['SCRIPT_NAME']);

require_once __DIR__ . '/../app/bootstrap.php';
require_once __DIR__ . '/../app/Router.php';

$router = new Router();

$router->get('/', 'ProductController@index');
$router->get('/product/{id}', 'ProductController@detail');
$router->get('/admin', 'AdminController@index');
$router->get('/toggle/{id}', function($params){
    $id = $params['id'] ?? null;
    $token = $_GET['token'] ?? null;
    $action = $_GET['action'] ?? 'toggle';
    $ctrl = new AdminController(new ProductModel());
    return $ctrl->toggle($id, $token, $action);
});
$router->get('/about', function(){ include __DIR__ . '/../about.php'; });
$router->get('/menu', function(){ include __DIR__ . '/../views/menu.view.php'; });
$router->get('/gallery', function(){ include __DIR__ . '/../views/gallery.view.php'; });
$router->get('/faq', function(){ include __DIR__ . '/../faq.php'; });

$router->get('/order', function(){
    $pageTitle = 'Troli Anda';
    $siteTitle = 'Troli Anda';
    $siteSubtitle = 'Semak pesanan anda dan sahkan sebelum menghantar melalui WhatsApp.';
    include __DIR__ . '/../views/header.php';
    include __DIR__ . '/../views/order.view.php';
    include __DIR__ . '/../views/footer.php';
});

$router->dispatch();
