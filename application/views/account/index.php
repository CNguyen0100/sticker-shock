<?php require 'application/views/layouts/header.php';
require 'application/models/Item.php';
$items = new Item($this->db);
$listings = $items->getItemsByUser($_SESSION['id']);
//$user = new User($this->db);
$orders = null;
?>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <p>
                    <div class="h3">
                    <?php
                    if(isset($_SESSION['fname']) && strpos($_SERVER['HTTP_REFERER'], 'account')){
                        echo 'Welcome back, '. $_SESSION['fname'] .'!';
                        echo '<br>';
                    }
                    ?>
                </div>
                </p>
                <form action="/account/logout" method="POST">
                    <div class="form-group">
                        <button type="submit" class="btn-ss btn-bw" name="logout">
                        	Log Out
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-md-9">
        <div class="h1">Account Information</div>
            <div class="well">
            <div class="row">
                <div class="col-4">
                    <h7> Name: </h7><br>
                    <h7> Email:</h7><br>
                    <h7> Gender:</h7><br>
                    <h7> Address 1:</h7><br>
                    <h7> Address 2:</h7><br>
                    <h7> City:</h7><br>
                    <h7> State:</h7><br>
                    <h7> Zip:</h7><br>
                </div>
                <div class="col-4">
                    <h7><?= $_SESSION['info']->first_name;?> <?= $_SESSION['info']->last_name;?></h7><br>
                    <h7><?= $_SESSION['info']->email;?></h7><br>
                    <h7><?php
                        if($_SESSION['info']->gender == 'M')
                            echo "Male";
                        else
                            echo "Female";
                        ?></h7><br>
                    <h7><?= $_SESSION['info']->address_1;?></h7><br>
                    <h7> <?= $_SESSION['info']->address_2; ?></h7><br>
                    <h7><?= $_SESSION['info']->city;?></h7><br>
                    <h7><?= $_SESSION['info']->state;?></h7><br>
                    <h7><?= $_SESSION['info']->zip;?></h7><br>
                </div>
            </div>
                <div class="text-right">
                <a href="/account/edit">Edit</a>
                </div>
            </div>
        <div class="h1">Your Listings</div>
        <?php if(count($listings) > 0) {foreach($listings as $item) {?>
            <hr>
            <div class="media">
                <div class="media-left">
                    <img src="<?php if(file_exists('uploads/item_'.$item->item_id)) {echo '/uploads/item_'.$item->item_id;} else echo 'https://placehold.it/700x400';?>" class="media-object" style="width:60px">
                </div>
                <div class="media-body">
                    <h4 class="media-heading"><?php echo $item->item_name?></h4>
                    <p><?php echo $item->description?></p>
                </div>
                <div class="media-right">
                    <form action="/items/edititem/<?php echo $item->item_id?>" method="POST">
                        <div class="form-group">
                            <button type="submit" class="btn btn-secondary btn-block" name="edititem">Edit</button>
                        </div>
                    </form>
                    <form action="/items/deleteitem/<?php echo $item->item_id?>" method="POST">
                        <div class="form-group">
                            <button <?php if($item->status != 'available'){echo 'style="visibility:hidden;"';};?> type="submit" class="btn btn-danger btn-block" name="deleteitem">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php }} else {echo '<hr><p>You have no listings! <a href="/pages/sell">Create a listing here.</a>';}?>
        <br>
        <div class="h1">Your Orders</div>
        <?php if(count($orders) > 0) {foreach($orders as $item) {?>
            <hr>
            <div class="media">
                <div class="media-left">
                    <img src="<?php if(file_exists('uploads/item_'.$item->item_id)) {echo '/uploads/item_'.$item->item_id;} else echo 'https://placehold.it/700x400';?>" class="media-object" style="width:60px">
                </div>
                <div class="media-body">
                    <h4 class="media-heading"><?php echo $item->item_name?></h4>
                    <p><?php echo $item->description?></p>
                </div>
            </div>
            <hr>
        <?php }} else {echo '<hr><p>You have no orders! <a href="/pages/index">Browse items here.</a>';}?>
        </div>
        </div>
    </div>
<?php require 'application/views/layouts/footer.php'; ?>

