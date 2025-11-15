<?php
require_once __DIR__ . '/../Model/ProductModel.php';

class ProductController {
    protected $model;

    public function __construct(ProductModel $model = null) {
        $this->model = $model ?: new ProductModel();
    }

    public function index() {
        $products = $this->model->getAvailable();
        include __DIR__ . '/../../views/index.view.php';
    }

    public function detail($id) {
        $product = $this->model->findById($id);
        if (!$product) {
            http_response_code(404);
            echo "Product not found.";
            return;
        }
        include __DIR__ . '/../../views/product.view.php';
    }
}
