<?php
$config = require base_path('configs/db.configs.php');

$db = new Database($config['database']);
$customers = new Customer($db, $user_id);

$customer_id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    
    $customer = $customers->getCustomerByID($customer_id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addCustomer'])) {
    $customer_name = $_POST['customer_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $status = $_POST['status'];

    $result = $customers->updateCustomer($customer_name, $email, $phone, $address, $status, $customer_id);

    if ($result) {
        header('Location: /customers');
        exit;
    }
}

$heading = 'Customer | Edit';
require view('customers/edit.view.php');