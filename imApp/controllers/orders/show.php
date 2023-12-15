<?php

$config = require base_path('configs/db.configs.php');

$db = new Database($config['database']);
$order = new Order($db, $user_id);

$result = $order->getOrdersWithDetails();