<?php 
require view('partials/head.php'); ?>

<?php
require view('components/topbar.php');
require view('components/sidebar.php'); 
?>

    <div id="content">
        <div class="header-block">
            <h4>Customers List</h4>
            <a href="/customer/create"><button class="btn-open">Add new Customer</button></a>
        </div>

        <div class="table-block" id="customerList">
            <?php require('../controllers/customers/show.php'); ?>
            <table class="product-table">
                <thead class="product-heading">
                    <tr>
                        <th>Customer Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Adress</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($result as $customer) : ?>
                        <tr>
                            <td style="padding: 12px 0;"><?= $customer['customer_name'];?> </td>
                            <td><?= $customer['email']; ?></td>
                            <td><?= $customer['phone']; ?></td>
                            <td><?= $customer['address'];?></td>
                            <td><?= $customer['status'];?></td>
                            <td>
                                <a href="/customer/edit?id=<?= $customer['id']; ?>"><i class='fa-solid fa-pen-to-square' style='color: #049624; margin-right: 20px;'></i></a>
                                <a href="/customer/delete?id=<?= $customer['id']; ?>"><i class='fa-solid fa-trash' style='color: #D62828; margin-left: 20px;'></i></a>
                            </td> 
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
    <a href="/product/delete?id=<?= $product['id']; ?>"></a>
<?php
require view('partials/scripts.php');
require view('partials/foot.php'); 
?>
