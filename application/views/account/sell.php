<?php require 'application/views/layouts/header.php'; ?>
<div class="container">
    <div class="h1">Sell<hr></div>
    <form enctype="multipart/form-data" action="/items/submititem" method="POST">
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
                <input required placeholder="Price" class="form-control" type="Number" min=0.01 step="any" name="price">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <input required placeholder="Shipping" class="form-control" type="Number" min=0.01 step="any" name="shipping">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <select required class="form-control" name="category">
                    <option selected disabled>Category</option>
                    <?php foreach($arr as $str): ?>
                    <option value=<?php echo ucwords($str); ?>><?php echo ucwords($str);?></option>
                    <?php endforeach;?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
            <textarea placeholder="Enter your item description here. Some things to include: item quality, brand, etc." class="form-control" name="description" rows="6"></textarea>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-6">
                <input required type="file" name="item_img" accept="image/*">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <button type="submit" class="btn-ss btn-bw"" name="submit">Submit</button>
            </div>
            </div>
        </div>
    </form>
</div>
<?php require 'application/views/layouts/footer.php'; ?>
