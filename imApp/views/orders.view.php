<?php 
require view('partials/head.php'); ?>

<?php
require view('components/topbar.php');
require view('components/sidebar.php'); 
?>

    <div id="content">
    <div class="header-block">
            <h4>Order List</h4>
            <a href="/order/create"><button class="btn-open">Add New Order</button></a>
        </div>

        <div class="table-block" id="orderList">
            <?php require('../controllers/orders/show.php'); ?>
            <table class="product-table">
                <thead class="product-heading"> 
                    <tr>
                        <th>Customer Name</th>
                        <th>Product Name</th>
                        <th>Prce</th>
                        <th>Quantity</th>
                        <th>Total Order</th>
                        <th>Status</th> 
                        <th>Action</th>      
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($result as $order) : ?>
                        <tr>
                            <td style="padding: 12px 0;"><?= $order['customer_name']; ?></td>
                            <td><?= $order['product_name']; ?></td>
                            <td>₱<?= $order['price']; ?></td>
                            <td><?= $order['quantity']; ?>pcs</td>
                            <td>₱<?= $order['total_order']; ?></td>
                            <td><?= $order['status']; ?></td>
                            <td>
                                <?php if ($order['status'] !== 'complete') : ?>
                                    <a href="/order/edit?id=<?= $order['id']; ?>">
                                        <i class='fa-solid fa-pen-to-square' style='color: #049624; margin-right: 20px;'></i>
                                    </a>
                                <?php else : ?>
                                    <i class='fa-solid fa-pen-to-square' style='color: #ccc; margin-right: 20px;' disabled></i>
                                <?php endif; ?>
                                <a href="/order/delete?id=<?= $order['id']; ?>">
                                    <i class='fa-solid fa-trash' style='color: #D62828; margin-left: 20px;'></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

  

<?php
require view('partials/scripts.php');
require view('partials/foot.php'); 
?>
