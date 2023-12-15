<?php
$config = require base_path('configs/db.configs.php');
$db = new Database($config['database']);

$customer = new Customer($db, $user_id); 
$order = new Order($db, $user_id);
$product = new Product($db, $user_id); 

// Total Orders and Total Sales
$totalOrders = $order->getTotalOrders();
$totalSales = $order->getTotalSales();

// Active and Inactive Customers
$totalActiveCustomer = $customer->getCustomerCounts()['total_active'];
$inActiveCustomers = $customer->getCustomerCounts()['total_inactive'];

// Order Status
$totalAllOrders = $order->getAllOrdersCount();
$completeOrders = $order->getCompleteOrdersCount();
$inProgressOrders = $order->getInProgressOrdersCount();
$pendingOrders = $order->getPendingOrdersCount();


$lowQuantityProduct = $product->getLowQuantityProducts();
$newCustomers = $customer->getNewlyRegisteredCustomers();

$topCustomers = $order->getTopCustomers();
$lowProducts = $product->getLowQuantityProducts();

$heading = 'Dashboard';
require view('dashboard.view.php');