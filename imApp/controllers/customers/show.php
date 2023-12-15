<?php

$config = require base_path('configs/db.configs.php');

$db = new Database($config['database']);
$customer = new Customer($db, $user_id);

$result = $customer->getAllCustomers();


