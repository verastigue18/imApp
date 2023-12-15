<?php
$config = require base_path('configs/db.configs.php');

$db = new Database($config['database']);
$product = new Product($db, $user_id);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['createProduct'])) {
    $product_name = $_POST["product_name"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
    $description = $_POST["description"];

    if (isset($_FILES["image"]) && $_FILES["image"]["error"] === UPLOAD_ERR_OK) {
        $image = file_get_contents($_FILES["image"]["tmp_name"]);

    } else {
        
        echo "Error uploading image.";
        exit;
    }

    $result = $product->createNewProduct($product_name, $price, $quantity, $description, $image);


    if ($result) {

        header('Location: /inventory');
        exit;

    } else {
        echo "Error creating product.";
    }
}

$heading = 'Inventory | Product | Create';
require view('products/create.view.php');
?>
