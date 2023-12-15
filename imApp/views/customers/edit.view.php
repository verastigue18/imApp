<?php 
require view('partials/head.php');
?>

<?php
require view('components/topbar.php');
require view('components/sidebar.php'); 
?>

<div id="content">
    <form action="" method="post" class="create-form form" id="addCustomerForm" enctype="multipart/form-data">
        <h4>Edit Customer Info</h4>
        <div class="form-group">
            <div class="group">
                <div class="input-group">
                    <label for="customer-name">Customer Name</label>
                    <input type="text" id="customer-name" name="customer_name" value="<?= $customer['customer_name']; ?>" required>
                </div>
                
                <div class="input-group">
                    <label for="customer_email">Email</label>
                    <input type="email" id="customer_email" name="email" value="<?= $customer['email']; ?>" required>
                </div>

                <div class="input-group">
                    <label for="phone">Phone</label>
                    <input type="number" id="phone" name="phone" value="<?= $customer['phone']; ?>" required>
                </div>

                <div class="input-group">
                    <label for="address">Address</label>
                    <textarea id="address" style="height: 70px;" name="address" ><?php echo $customer['address']; ?></textarea>
                </div>
                
                <div class="input-group">
                    <label for="status">Status</label>
                    <select name="status" required>
                        <option value="active" <?= ($customer['status'] == 'active') ? 'selected' : ''; ?>>Active</option>
                        <option value="inactive" <?= ($customer['status'] == 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="buttons">
            <a href="/customers" class="button btn-nbg">Cancel</a>
            <button class="button btn-bg" id="btn-submit btn-update" name="addCustomer"  type="submit">Update Changes</button>
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
