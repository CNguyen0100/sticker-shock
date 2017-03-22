<?php
error_reporting(E_ALL);
// I don't know if you need to wrap the 1 inside of double quotes.
ini_set("display_startup_errors",1);
ini_set("display_errors",1);
include "./models/Item.php";
$items = Item::allItems();
foreach($items as $item)  :?>
<div class="col-lg-4 col-md-6 mb-4">
    <div class="card h-100">
        <a href="#"><img class="card-img-top img-fluid" src="http://placehold.it/700x400" alt=""></a>
        <div class="card-block">
            <h4 class="card-title"><a href="views/item-detail.php?id=<?php echo $item->item_id?>"><?php echo $item->item_name?></a></h4>
            <h5>$<?php echo $item->price?></h5>
            <p class="card-text"><?php echo $item->description?></p>
        </div>
        <div class="card-footer">
            <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
        </div>
    </div>
</div>
<?php endforeach;?>


