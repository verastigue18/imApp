<?php
require view('partials/head.php');
?>

<link rel="stylesheet" href="../assets/styles/inventory.css">

<?php
require view('components/topbar.php');
require view('components/sidebar.php');
?>


<div id="content">
    <div class="header-block">
        <h4>Product List</h4>
        <a href="/product/create"><button class="btn-open">Add new Product</button></a>
    </div>

    <div class="table-block" id="productList">
        <?php require('../controllers/products/show.php'); ?>
        <table class="product-table">
            <thead class="product-heading">
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($products as $product) : ?>
                    <tr>
                        <td><?= $product['product_name']; ?></td>
                        <td>₱<?= $product['price']; ?></td>
                        <td><?= $product['quantity']; ?>pcs</td>
                        <td><?= $product['description'];?></td>
                        <td><img src="data:image/png;base64,<?= base64_encode($product['image']) ?>" height="52px" width="52px" alt=""></td>
                        <td>
                            <a href="/product/edit?id=<?= $product['id']; ?>"><i class='fa-solid fa-pen-to-square' style='color: #049624; margin-right: 20px;'></i></a>
                            <a href="/product/delete?id=<?= $product['id']; ?>"><i class='fa-solid fa-trash' style='color: #D62828; margin-left: 20px;'></i></a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<?php
require view('partials/scripts.php');
require view('partials/foot.php');
?>
