<?php

$config = require base_path('configs/db.configs.php');

$db = new Database($config['database']);
$products = new Product($db, $user_id);

$product_id = $_GET["id"];

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $product = $products->getProductById($product_id);
} 

if ($_SERVER["REQUEST_METHOD"] === 'POST' && isset(($_GET['id']))) {
    $product = $products->deleteProductById($product_id);

    header('Location: /inventory');

}

$heading = 'Iventory | Products | Delete';
require view('products/delete.view.php');



?>