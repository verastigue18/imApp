<?php 
require view('partials/head.php'); ?>

<?php
require view('components/topbar.php');
require view('components/sidebar.php'); 
?>

    <div id="content" class="dashboard">
        <div class="overview-block">
            <div class="overview-box box1 box">
                <h3>Order Status</h3>   
                <div class="status">
                    <div class="view-status">
                        <span class="status-head">In Progress</span>
                        <span><?php echo $inProgressOrders; ?></span>
                    </div>
                    <div class="view-status">
                        <span class="status-head">Pending</span>
                        <span><?php echo $pendingOrders; ?></span>
                    </div>
                    <div class="view-status">
                        <span class="status-head">Complete</span>
                        <span><?php echo $completeOrders; ?></span>
                    </div>
                </div>
            </div>

            <div class="overview-box box2 box">
                <h3>Total</h3>
                <div class="status">
                    <div class="view-status">
                        <span class="status-head">Total Orders</span>
                        <span><?php echo $totalOrders; ?></span>
                    </div>

                    <div class="view-status">
                        <span class="status-head">Total Sales</span>
                        <span>₱<?php echo $totalSales; ?></span>
                    </div>
                </div>
            </div>

            <div class="overview-box box3 box">
                <h3>Customers</h3>
                <div class="status">
                    <div class="view-status">
                        <span class="status-head">Active Customers</span>
                        <span><?php echo $totalActiveCustomer; ?></span>
                    </div>

                    <div class="view-status">
                        <span class="status-head">In-active Customers</span>
                        <span><?php echo $inActiveCustomers; ?></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="graph-block">
            <div class="graph-box box1 box graph-sales">
                <h4>Low Quantity Products</h4>
                <table class="product-table">
                    <thead class="product-heading">
                        <tr>
                            <th>Prodcut Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($lowProducts as $product) : ?>
                            <tr>
                                <td style="padding: 12px 0;"><?= $product['product_name'];?> </td>
                                <td><?= $product['price'] ?></td>
                                <td><?= $product['quantity']; ?></td> 
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>


            <div class="graph-box box2 box graph-orders">
                <div class="graph-heading">
                    <h4>Top 5 Customer</h4>
                    <table class="product-table">
                        <thead class="product-heading">
                            <tr>
                                <th>Customers Name</th>
                                <th>No. of Orders</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($topCustomers as $customer) : ?>
                                <tr>
                                    <td style="padding: 12px 0;"><?= $customer['customer_name'];?> </td>
                                    <td><?= $customer['order_count']; ?></td> 
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php
require view('partials/scripts.php');
require view('partials/foot.php'); 
?>
