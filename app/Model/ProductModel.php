<?php
class ProductModel {
    protected $file;

    public function __construct($file = null) {
        $this->file = $file ?: (defined('PRODUCTS_FILE') ? PRODUCTS_FILE : __DIR__ . '/../../products.json');
    }

    public function loadAll() {
        if (!file_exists($this->file)) return [];
        $json = file_get_contents($this->file);
        $data = json_decode($json, true);
        return is_array($data) ? $data : [];
    }

    public function saveAll(array $products) {
        return file_put_contents($this->file, json_encode($products, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }

    public function getAvailable() {
        return array_filter($this->loadAll(), function($p){ return !empty($p['available']); });
    }

    public function findById($id) {
        foreach ($this->loadAll() as $p) {
            if (!empty($p['id']) && $p['id'] === $id) return $p;
        }
        return null;
    }

    public function toggle($id, $action = 'toggle') {
        $products = $this->loadAll();
        $found = false;
        foreach ($products as &$p) {
            if (!empty($p['id']) && $p['id'] === $id) {
                $found = true;
                if ($action === 'on') $p['available'] = true;
                elseif ($action === 'off') $p['available'] = false;
                else $p['available'] = !($p['available'] ?? false);
                break;
            }
        }
        unset($p);
        if ($found) {
            $this->saveAll($products);
        }
        return $found;
    }
}
