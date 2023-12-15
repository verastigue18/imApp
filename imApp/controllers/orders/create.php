<?php
$config = require base_path('configs/db.configs.php');

$db = new Database($config['database']);
$customer = new Customer($db, $user_id);
$product = new Product($db, $user_id);
$order = new Order($db, $user_id);

$activeCustomers = $customer->getActiveCustomers();
$availableProducts = $product->getProductsAvailable();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addOrder'])) {
    $customer_id = $_POST['customer_id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $status = $_POST['status'];

    $selectedProduct = $product->getProductById($product_id); 
    $totalOrder = $selectedProduct['price'] * $quantity;

    $result = $order->createNewOrder($customer_id, $product_id, $quantity, $status, $totalOrder);
   

    
    if ($result) {
        header('Location: /orders');
        exit;
    }
}

$heading = 'Order | Create';
require view('orders/create.view.php');
?>
