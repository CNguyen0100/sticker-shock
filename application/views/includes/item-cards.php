<?php
foreach($items as $item)  :?>
<div class="col-lg-4 col-md-6 mb-4">
    <div class="card h-100">
        <a href="/items/item/<?php echo $item->item_id?>" class="img-container-card"><img class="card-img-top img-fluid" src="<?php if(file_exists('uploads/item_'.$item->item_id)) {echo '/uploads/item_'.$item->item_id;} else echo 'https://placehold.it/700x400';?>" alt=""></a>
        <div class="card-block">
            <small>
                    <?php
                        # Graham L.:
                        # $a_cat and $a_subcat are the category, and subcategory 
                        # names stripped of spaces. The identifiers are 
                        # prefxied with 'a' for 'anchor'.
                        $a_cat = preg_replace('/\s+/', '', $item->category);
                        $a_subcat = preg_replace('/\s+/', '', $item->subcategory);
                        echo '<a href="/items/' . $a_cat . '">' .  $item->category . '</a>';
                        if (isset($item->subcategory) && $item->subcategory != "") {
                            echo ' / <a href="/items/' . $a_cat . '/' . $a_subcat . '">' . $item->subcategory . '</a>';
                        } 
                    ?>
            </small>
            <h4 class="card-title"><a href="/items/item/<?php echo $item->item_id?>"><?php echo $item->item_name?></a></h4>
            <h5>$<?php echo number_format((float)$item->price, 2, '.', '');?></h5>
            <p class="card-text"><?php echo $item->description?></p>
        </div>
    </div>
</div>
<?php endforeach;?>


