<?php
require_once __DIR__ . '/../Model/ProductModel.php';
require_once __DIR__ . '/../helpers.php';

class AdminController {
    protected $model;

    public function __construct(ProductModel $model = null) {
        $this->model = $model ?: new ProductModel();
    }

    public function index() {
        $this->requireAuth();
        $products = $this->model->loadAll();
        include __DIR__ . '/../../views/admin.view.php';
    }

    public function toggle($id, $token, $action = 'toggle') {
        if (empty($token) || $token !== SECRET_TOKEN) {
            http_response_code(403);
            echo "Forbidden: invalid token.";
            return;
        }
        if (!$id) {
            echo "Missing product id.";
            return;
        }
        $ok = $this->model->toggle($id, $action);
        if (!$ok) {
            echo "Product not found.";
            return;
        }
        header('Location: ' . url('admin'));
    }

    protected function requireAuth() {
        if (PHP_SAPI === 'cli') return; // skip in CLI (tests)
        if (!empty($_SERVER['PHP_AUTH_USER']) && !empty($_SERVER['PHP_AUTH_PW'])) {
            if ($_SERVER['PHP_AUTH_USER'] === ADMIN_USER && $_SERVER['PHP_AUTH_PW'] === ADMIN_PASS) return;
        }
        header('WWW-Authenticate: Basic realm="Admin"');
        header('HTTP/1.0 401 Unauthorized');
        echo 'Authentication required.';
        exit;
    }
}
