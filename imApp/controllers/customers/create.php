<?php 

$config = require base_path('configs/db.configs.php');

$db = new Database($config['database']);
$customer = new Customer($db, $user_id);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addCustomer'])) {
    $customer_name = $_POST['customer_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $status = $_POST['status'];

    $result = $customer->createNewCustomer($customer_name, $email, $phone, $address, $status);

    if($result) {
        header('Location: /customers');
        exit;
    }
}




$heading = 'Customer | Create';
require view('customers/create.view.php');