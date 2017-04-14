<?php require 'application/views/layouts/header.php';
$order = new Order($this->db);
$orders = $order->getOrdersByAccountId($user->user_id);
?>
    <div class="container">
        <div class="h1"> <?php echo $user->username; ?>'s Account </div> <br><br>
        <div class="h1">Their Listings</div>
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
            </div>
        <?php }} else {echo '<hr><p>They have no listings!';}?>
        <br>
        <div class="h1">Their Orders</div>
        <?php if(count($orders) > 0) {foreach($orders as $i) {?>
            <hr>
            <div class="media">
                <div class="media-left">
                    <!--img src="<?php if(file_exists('uploads/item_'.$item->item_id)) {echo '/uploads/item_'.$item->item_id;} else echo 'https://placehold.it/700x400';?>" class="media-object" style="width:60px"-->
                </div>
                <div class="media-body">
                    <h4 class="media-heading"><?php echo $i->order_id;?></h4>
                    <p><?php echo $i->account_id;?></p>
                </div>
            </div>
            <hr>
        <?php }} else {echo '<hr><p>They have no orders!';}?>
        </div>
        </div>
    </div>
<?php require 'application/views/layouts/footer.php'; ?>

