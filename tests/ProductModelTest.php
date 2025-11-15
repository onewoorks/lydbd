<?php
require_once __DIR__ . '/../app/Model/ProductModel.php';

function assertTrue($cond, $msg='') { if (!$cond) { throw new Exception('Assertion failed: '.$msg); } }

// Use a temp file for tests
$tmp = sys_get_temp_dir() . '/products_test_' . uniqid() . '.json';
$sample = [
  ["id"=>"a","name"=>"A","available"=>true],
  ["id"=>"b","name"=>"B","available"=>false]
];
file_put_contents($tmp, json_encode($sample));

$model = new ProductModel($tmp);
$all = $model->loadAll();
assertTrue(count($all)===2, 'loadAll should return two items');
$avail = $model->getAvailable();
assertTrue(count($avail)===1, 'getAvailable should return one');
$found = $model->findById('b');
assertTrue($found !== null && $found['id']==='b', 'findById should find id b');
$ok = $model->toggle('b','on');
assertTrue($ok === true, 'toggle on should return true');
$after = $model->findById('b');
assertTrue(!empty($after['available']), 'b should be available after toggle on');

// cleanup
unlink($tmp);
echo "ProductModel tests passed\n";
