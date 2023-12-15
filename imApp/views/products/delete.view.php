<?php 
require view('partials/head.php');
?>

<?php
require view('components/topbar.php');
require view('components/sidebar.php'); 
?>

<div id="content">
    <form action="" method="post" class="create-form form" id="addProductForm" enctype="multipart/form-data">
        <h4>Delete Product</h4>
        <div class="form-group">
            <div class="group">
                <div class="input-group">
                    <label for="poduct-name">Product Name</label>
                    <input style="cursor: not-allowed;" type="text" id="product-name" name="product_name" disabled value="<?= $product['product_name']; ?>" required>
                </div>
                
                <div class="input-group">
                    <label for="product-price">Price</label>
                    <input style="cursor: not-allowed;" type="number" id="product-price" name="price" disabled value="<?= $product['price']; ?>" required>
                </div>

                <div class="input-group">
                    <label for="product-quantity">Quantity</label>
                    <input style="cursor: not-allowed;" type="number" id="product-quantity" name="quantity" disabled value="<?= $product['quantity']; ?>"  required>
                </div>

                <div class="input-group">
                    <label for="product-description">Description</label>
                    <textarea style="cursor: not-allowed;" id="" placeholder="Product Description" style="height: 150px;" name="description" disabled><?= $product['description']; ?></textarea>
                </div>                
            </div>

            <div class="group left">
                <div class="group-preview">
                    <label for="file">Image preview</label>
                    <div class="preview-container">
                        <img id="image-preview" src="data:image/png;base64,<?= base64_encode($product['image']) ?>" style="height: 100%; width: 100%; padding: 10px;"/>
                    </div>
                    <input style="display: none;" id="file" type="file" class="upload-image" name="image" accept="image/" disabled onchange="displayImage()">
                    <label style="cursor: not-allowed;" for="file" class="btn-file">
                        <i class="fa-solid fa-file-arrow-up" style="color: #F77f00; font-size: 32px;"></i>
                        <span>Upload image</span>
                    </label>
                </div>
              
            </div>
            
        </div>
        <div class="buttons">
            <a href="/inventory" class="button btn-nbg">Cancel</a>
            <button class="button btn-bg" id="btn-submit btn-update"  type="submit">Delete</button>
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
