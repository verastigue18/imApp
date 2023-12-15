<?php



$config = require base_path('configs/db.configs.php');

$db = new Database($config['database']);
$product = new Product($db, $user_id);

$products = $product->getAllProducts();

