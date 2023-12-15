<?php require view('partials/head.php'); ?>

<?php
require view('components/topbar.php');
require view('components/sidebar.php');
?>

<div id="content">
    <form action="" method="post" class="create-form form" id="addOrderForm" enctype="multipart/form-data">
        <h4>Add new Order</h4>
        <div class="form-group">
            <div class="group">
                <div class="input-group">
                    <label for="order-name">Customer Name</label>
                    <select name="customer_id" required>
                        <option value="" disabled selected>Select Customer</option>
                        <?php foreach ($activeCustomers as $customer) : ?>
                            <option value="<?= $customer['id']; ?>"><?= $customer['customer_name']; ?></option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="input-group">
                    <label for="product">Product Name</label>
                    <select name="product_id" id="order_product" required>
                        <option value="" disabled selected>Select Product</option>
                        <?php foreach ($availableProducts as $product) : ?>
                            <option value="<?= $product['id']; ?>" data-price="<?= $product['price']; ?>">
                                <?= $product['product_name']; ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
                
                <div class="input-group" style="display: flex; flex-direction: row;">
                    <div class="qty" style="display: flex; flex-direction: column; width: 100%;">
                        <label for="product">Price</label>
                        <input type="text" id="product_price" value="" readonly>
                    </div>

                    <div class="qty" style="display: flex; flex-direction: column; width: 100%;">
                        <label for="order_quantity">Quantity</label>
                        <input type="number" id="order_quantity" name="quantity" required>
                    </div>
                </div>
                

                <div class="input-group">
                    <label for="order_total">Total Order</label>
                    <input disabled type="number" id="order_total" name="total_order" required>
                </div>

                <div class="input-group">
                    <label for="order_status">Status</label>
                    <select name="status" required>
                        <option value="in_progress">In progress</option>
                        <option value="pending">Pending</option>
                        <option value="complete">Complete</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="buttons">
            <a href="/orders" class="button btn-nbg">Cancel</a>
            <button class="button btn-bg btn-update" id="btn-submit" name="addOrder" type="submit">Add Order</button>
        </div>
    </form>
</div>

<script>
    document.getElementById('order_product').addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];

        const price = selectedOption.getAttribute('data-price');

        document.getElementById('product_price').value = price;
    });

    document.getElementById('order_quantity').addEventListener('input', updateTotalOrder);
    document.getElementById('order_product').addEventListener('change', updateTotalOrder);

    function updateTotalOrder() {
    const selectedProduct = document.getElementById('order_product').options[document.getElementById('order_product').selectedIndex];
    const price = parseFloat(selectedProduct.getAttribute('data-price')) || 0;
    const quantity = parseFloat(document.getElementById('order_quantity').value) || 0;

    const totalOrder = price * quantity;

    document.getElementById('order_total').value = isNaN(totalOrder) ? '' : totalOrder.toFixed(2);
}

</script>

<?php
require view('partials/scripts.php');
require view('partials/foot.php');
?>