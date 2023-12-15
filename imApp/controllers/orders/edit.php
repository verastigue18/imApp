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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editOrder'])) {
    $customer_id = $_POST['customer_id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $total_order = $_POST['total_order'];
    $status = $_POST['status'];

    $result = $order->updateOrder($customer_id, $product_id, $quantity, $total_order, $status, $order_id);

    if ($result) {
        header('Location: /orders');
        exit;
    }
}

$heading = 'Order | Edit';
require view('orders/edit.view.php');
?>
