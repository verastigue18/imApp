<?php

session_start();

$publicPages = [
    '/login',
    '/signup',
];

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

if (!in_array($uri, $publicPages) && !isset($_SESSION['user_id'])) {
    header('Location: /login');
    exit;
}

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

$routes = [
    '/dashboard' => '../controllers/dashboard.php',

    '/orders' => '../controllers/orders.php',
    '/order/create' => '../controllers/orders/create.php',
    '/order/edit' => '../controllers/orders/edit.php',
    '/order/delete' => '../controllers/orders/delete.php',

    '/customers' => '../controllers/customers.php',
    '/customer/create' => '../controllers/customers/create.php',
    '/customer/edit' => '../controllers/customers/edit.php',
    '/customer/delete' => '../controllers/customers/delete.php',

    '/inventory' => '../controllers/inventory.php',
    '/product/create' => '../controllers/products/create.php',
    '/product/edit' => '../controllers/products/edit.php',
    '/product/delete' => '../controllers/products/delete.php',

    '/settings' => '../controllers/settings.php',
    '/logout' => '../controllers/logout.php',
    '/login' => '../controllers/login.php',
    '/signup' => '../controllers/signup.php',
];

$defaultRoute = '/login';

if (array_key_exists($uri, $routes)) {
    require("{$routes[$uri]}");
} else {
    header("Location: $defaultRoute");
    exit;
}
