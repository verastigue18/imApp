<?php 
require view('partials/head.php');
?>

<?php
require view('components/topbar.php');
require view('components/sidebar.php'); 
?>

<div id="content">
    <form action="" method="post" class="create-form form" id="addCustomerForm" enctype="multipart/form-data">
        <h4>Add new Customer</h4>
        <div class="form-group">
            <div class="group">
                <div class="input-group">
                    <label for="customer-name">Customer Name</label>
                    <input type="text" id="customer-name" name="customer_name" required>
                </div>
                
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="input-group">
                    <label for="phone">Phone</label>
                    <input type="number" id="phone" name="phone" required>
                </div>

                <div class="input-group">
                    <label for="address">Address</label>
                    <textarea id="address" style="height: 70px;" name="address"></textarea>
                </div>
                
                <div class="input-group">
                    <label for="status">Status</label>
                    <select name="status" required>
                        <option value="" disabled selected>Select Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="buttons">
            <a href="/customers" class="button btn-nbg">Cancel</a>
            <button class="button btn-bg" id="btn-submit btn-update" name="addCustomer"  type="submit">Submit</button>
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
