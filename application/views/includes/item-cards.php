<?php
#echo "$category" . ' ' . "$subcategory";
foreach($items as $item)  :?>
<div class="col-lg-4 col-md-6 mb-4">
    <div class="card h-100">
        <a href="#"><img class="card-img-top img-fluid" src="http://placehold.it/700x400" alt=""></a>
        <div class="card-block">
            <small><?php echo $item->category; if (isset($item->subcategory)) { echo ' / ' . $item->subcategory; } ?></small>
            <h4 class="card-title"><a href="./items/item/<?php echo $item->item_id?>"><?php echo $item->item_name?></a></h4>
            <h5>$<?php echo $item->price?></h5>
            <p class="card-text"><?php echo $item->description?></p>
        </div>
        <div class="card-footer">
            <big>&#9733; &#9733; &#9733; &#9733; &#9734;</big>
        </div>
    </div>
</div>
<?php endforeach;?>


