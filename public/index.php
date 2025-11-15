<?php
// Front controller (public entry) — routes managed here
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
$router->get('/about', function(){ $pageTitle='About'; $siteTitle='About Us'; $siteSubtitle=''; include __DIR__ . '/../views/header.php'; echo '<main class="admin-card" style="margin-top:18px"> <p>We bake fresh daily using high-quality ingredients.</p></main>'; include __DIR__ . '/../views/footer.php'; });
$router->get('/faq', function(){ $pageTitle='FAQ'; $siteTitle='FAQ'; $siteSubtitle='How to order'; include __DIR__ . '/../views/header.php'; echo '<main class="admin-card" style="margin-top:18px"> <h3>How do I order?</h3><p>Open a product detail and choose package and flavour (if available). Click "Order via WhatsApp" to send us your order with details.</p></main>'; include __DIR__ . '/../views/footer.php'; });

$router->get('/order', function(){
    $pageTitle = 'Your cart';
    $siteTitle = 'Your order';
    $siteSubtitle = 'Review your order and confirm before sending via WhatsApp.';
    include __DIR__ . '/../views/header.php';
    include __DIR__ . '/../views/order.view.php';
    include __DIR__ . '/../views/footer.php';
});

$router->dispatch();
