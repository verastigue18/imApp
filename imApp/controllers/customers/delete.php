<?php
$config = require base_path('configs/db.configs.php');

$db = new Database($config['database']);
$customers = new Customer($db, $user_id);

$customer_id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    
    $customer = $customers->getCustomerByID($customer_id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteCustomer'])) {
    
    $customers->deleteCustomerById($customer_id);

    header('Location: /customers');
    exit;
}


$heading = 'Customer | Delete';
require view('customers/delete.view.php');