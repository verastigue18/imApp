<?php 
require view('partials/head.php');
?>

<?php
require view('components/topbar.php');
require view('components/sidebar.php'); 
?>

<div id="content">
    <form action="" method="post" class="create-form form" id="addCustomerForm" enctype="multipart/form-data">
        <h4>Delete Customer</h4>
        <div class="form-group">
            <div class="group">
                <div class="input-group">
                    <label for="customer-name">Customer Name</label>
                    <input type="text" id="customer-name" name="customer_name" disabled value="<?= $customer['customer_name']; ?>" required>
                </div>
                
                <div class="input-group">
                    <label for="customer_email">Email</label>
                    <input type="email" id="email" name="email" disabled value="<?= $customer['email']; ?>" required>
                </div>

                <div class="input-group">
                    <label for="phone">Phone</label>
                    <input type="number" id="phone" name="phone" disabled value="<?= $customer['phone']; ?>" required>
                </div>

                <div class="input-group">
                    <label for="address">Address</label>
                    <textarea id="address" style="height: 70px;" disabled name="address" ><?php echo $customer['address']; ?></textarea>
                </div>
                
                <div class="input-group">
                    <label for="status">Status</label>
                    <select disabled name="status" required>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="buttons">
            <a href="/customers" class="button btn-nbg">Cancel</a>
            <button class="button btn-bg" id="btn-submit btn-update" name="deleteCustomer"  type="submit">Delete</button>
        </div>
    </form>
</div>

<script>
    function displayImage() {
        const input = document.getElementById('file');
        const imagePreview = document.getElementById('image-preview');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                imagePreview.src = e.target.result;
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<?php
require view('partials/scripts.php');
require view('partials/foot.php'); 
?>
