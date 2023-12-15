<?php 
require view('partials/head.php');
require view('components/topbar.php');
require view('components/sidebar.php'); 
?>

<div id="content">
    <form class="edit-form form" action="" method="post" enctype="multipart/form-data">
        <h4>Edit Product</h4>
        <div class="form-group">
            <div class="group">
                <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                
                <div class="input-group">
                    <label for="product-name">Product Name</label>
                    <input id="product-name" type="text" name="product_name" value="<?= $product['product_name']; ?>" required>
                </div>

                <div class="input-group">
                    <label for="product-price">Price</label>
                    <input id="product-price" type="number" name="price" step="0.01" value="<?= $product['price']; ?>" required>
                </div>

                <div class="input-group">
                    <label for="product-quantity">Quantity</label>
                    <input id="product-quantity" type="number" name="quantity" value="<?= $product['quantity']; ?>" required>
                </div>

                <div class="input-group">
                    <label for="product-description">Description</label>
                    <textarea id="product-description" name="description" style="height: 150px;" required><?= $product['description']; ?></textarea>
                </div>
            </div>

            <div class="group left">
                <div class="group-preview">
                    <label for="file">Image Preview</label>
                    <div class="preview-container">
                        <img id="image-preview-edit" src="data:image/png;base64,<?= base64_encode($product['image']) ?>" style="max-width: 100%; max-height: 300px;">
                    </div>
                    <input style="display: none;" type="file" id="file" name="image" accept="image/*" onchange="displayImageEdit(this)">    
                    <label class="btn-file" for="file">
                        <i class="fa-solid fa-file-arrow-up" style="color: #F77f00; font-size: 32px;"></i>
                        <span>Change Image</span>
                    </label>
                    <span id="selected-image" style="margin-left: 10px;"></span>
                </div>
            </div>
        </div>
       
        <div class="buttons">
            <a href="/inventory" class="button btn-nbg">Cancel</a>
            <input type="submit" class="button btn-update" name="updateProduct" value="Update Chnages">
        </div>
    </form>
</div>

<script>
    function displayImageEdit(input) {
        const imagePreview = document.getElementById('image-preview-edit');
        const selectedImageSpan = document.getElementById('selected-image');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
                selectedImageSpan.textContent = input.files[0].name; // Display the selected file name
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<?php
require view('partials/scripts.php');
require view('partials/foot.php');
?>
