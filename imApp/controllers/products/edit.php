<?php
$config = require base_path('configs/db.configs.php');
$db = new Database($config['database']);
$products = new Product($db, $user_id);

$product_id = $_GET["id"];

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"])) {
    $product = $products->getProductById($product_id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateProduct'])) {
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $description = $_POST['description'];

    $image = null; 

    // CHECK IF NEW IMAGE
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] === UPLOAD_ERR_OK) {
        $image = file_get_contents($_FILES["image"]["tmp_name"]);
    } else {
        echo "Image is already Exist";
    }

    $editProductData = $products->updateProductByData($product_name, $price, $quantity, $description, $product_id);

    if ($image !== null) {
        $editProductImage = $products->updateProductByImage($product_id, $image);
    
    }

    if ($editProductData) {
        header("Location: /inventory");
        exit;
    }
}

$heading = 'Inventory | Product | Edit';
require view('products/edit.view.php');
?>
