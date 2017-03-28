<?php
foreach($items as $item)  :?>
<div class="col-lg-4 col-md-6 mb-4">
    <div class="card h-100">
        <a href="#"><img class="card-img-top img-fluid" src="http://placehold.it/700x400" alt=""></a>
        <div class="card-block">
            <small>
                    <?php
                        $a_cat = preg_replace('/\s+/', '', $item->category);
                        $a_subcat = preg_replace('/\s+/', '', $item->subcategory);
                        echo '<a href="/items/' . $a_cat . '">' .  $item->category . '</a>';
                        if (isset($item->subcategory)) { 
                            echo ' / <a href="/items/' . $a_cat . '/' . $a_subcat . '">' . $item->subcategory . '</a>';
                        } 
                    ?>
            </small>
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


