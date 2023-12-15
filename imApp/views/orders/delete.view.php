<?php
require view('partials/head.php');
?>

<?php
require view('components/topbar.php');
require view('components/sidebar.php');
?>

<div id="content">
    <form action="" method="post" class="create-form form" id="editOrderForm" enctype="multipart/form-data">
        <h4>Delete Order</h4>
        <div class="form-group">
            <div class="group">
                <div class="input-group">
                    <label for="order-name">Customer Name</label>
                    <select style="cursor: not-allowed;" name="customer_id" disabled required>
                        <?php foreach ($customersActive as $customer) : ?>
                            <option value="<?= $customer['id']; ?>" <?= ($customer['id'] == $customers['id']) ? 'selected' : ''; ?>>
                                <?= $customer['customer_name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="input-group">
                    <label for="order-name">Product</label>
                    <select style="cursor: not-allowed;" name="product_id" id="order_product" disabled required>
                        <?php foreach ($productsList as $product) : ?>
                            <option value="<?= $product['id']; ?>" data-price="<?= $product['price']; ?>" <?= ($product['id'] == $products['id']) ? 'selected' : ''; ?>>
                                <?= $product['product_name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="input-group"  style="display: flex; flex-direction: row;">
                    <div class="qty" style="display: flex; flex-direction: column; width: 100%;">
                        <label for="product">Price</label>
                        <input style="cursor: not-allowed;" type="text" id="product_price" value="<?= $products['price']; ?>" disabled readonly>
                    </div>

                    <div class="qty" style="display: flex; flex-direction: column; width: 100%;">
                        <label for="order_quantity">Quantity</label>
                        <input style="cursor: not-allowed;" type="number" id="order_quantity" name="quantity" value="<?= $orders['quantity'] ?>" disabled required>
                </div>
                </div>

                

                <div class="input-group">
                    <label for="order_total">Total Order</label>
                    <input style="cursor: not-allowed;" readonly type="number" id="order_total" name="total_order" value="<?= $orders['total_order'] ?>" disabled required>
                </div>


                <div class="input-group">
                    <label for="order_status">Status</label>
                    <select style="cursor: not-allowed;" name="status" disabled required>
                        <option value="in_progress" <?= ($orders['status'] == 'in_progress') ? 'selected' : ''; ?>>In progress</option>
                        <option value="pending" <?= ($orders['status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
                        <option value="complete" <?= ($orders['status'] == 'complete') ? 'selected' : ''; ?>>Complete</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="buttons">
            <a href="/orders" class="button btn-nbg">Cancel</a>
            <button class="button btn-bg btn-update" id="btn-submit" name="deleteOrder" type="submit">Delete</button>
        </div>
    </form>
</div>

<script>
    document.getElementById('order_product').addEventListener('change', function () {
        updateProductPrice();
        updateTotalOrder();
    });

    document.getElementById('order_quantity').addEventListener('input', function () {
        updateTotalOrder();
    });

    // Trigger the initial calculations
    updateProductPrice();
    updateTotalOrder();

    function updateProductPrice() {
        const selectedProduct = document.getElementById('order_product').options[document.getElementById('order_product').selectedIndex];
        const price = selectedProduct.getAttribute('data-price');
        document.getElementById('product_price').value = price;
    }

    function updateTotalOrder() {
        const price = document.getElementById('product_price').value;
        const quantity = document.getElementById('order_quantity').value;
        const totalOrder = price * quantity;
        document.getElementById('order_total').value = totalOrder;
    }
</script>

<?php
require view('partials/scripts.php');
require view('partials/foot.php');
?>
