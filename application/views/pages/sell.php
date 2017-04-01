<?php require 'application/views/layouts/header.php'; ?>
<div class="container">
    <div class="h1">Sell<hr></div>
    <form action="" method="POST">
        <div class="form-group row">
            <div class="col-md-6">
                <input required placeholder="Title" class="form-control" type="text" name="title">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <input required placeholder="Size" class="form-control" type="text" name="size">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <input required placeholder="Price" class="form-control" type="Number" step="any" name="price">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <input required placeholder="Shipping" class="form-control" type="Number" step="any" name="shipping">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <select required class="form-control" name="category">
                    <option disabled>Category</option>
                    <option>Category Placeholder 1</option>
                    <option>Category Placeholder 2</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <select class="form-control" name="subcategory">
                    <option>Subcategory Placeholder 1</option>
                    <option>Subcategory Placeholder 2</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
            <textarea class="form-control" name="description" rows="6">Enter your item description here. Some things to include: item quality, brand, etc.</textarea>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-6">
                <input type="file" id="file" accept="image/*">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </div>
            </div>
        </div>
    </form>
</div>
<?php require 'application/views/layouts/footer.php'; ?>
