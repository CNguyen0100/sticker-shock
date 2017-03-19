<?php
include "./models/Item.php";
$items = Item::allItems();
foreach($items as $item)  :?>
<div class="col-lg-4 col-md-6 mb-4">
    <div class="card h-100">
        <a href="#"><img class="card-img-top img-fluid" src="http://placehold.it/700x400" alt=""></a>
        <div class="card-block">
            <h4 class="card-title"><a href="views/item-detail.php?id=<?php echo $item->item_id?>"><?php echo $item->title?></a></h4>
            <h5>$<?php echo $item->price?></h5>
            <p class="card-text"><?php echo $item->description?></p>
        </div>
        <div class="card-footer">
            <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
        </div>
    </div>
</div>
<?php endforeach;?>


