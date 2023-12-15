<?php
$config = require base_path('configs/db.configs.php');

$db = new Database($config['database']);
$order = new Order($db, $user_id);
$customer = new Customer($db, $user_id);
$product = new Product($db, $user_id);

$order_id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $orders = $order->getOrderById($order_id);
    $customers = $customer->getCustomerById($orders['customer_id']);
    $products = $product->getProductById($orders['product_id']);
    $customersActive = $customer->getActiveCustomers();
    $productsList = $product->getAllProducts();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteOrder'])) {
    
    $order->deleteOrderById($order_id);

    header('Location: /orders');
    exit;
}

$heading = 'Order | Delete';
require view('orders/delete.view.php');
?>
