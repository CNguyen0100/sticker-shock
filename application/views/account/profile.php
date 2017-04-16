<!--This page show all listing of a seller and their review-->

<?php require 'application/views/layouts/header.php'; ?>
    <div class="container">
        <div class="h1"> <?php echo ucfirst($user->username); ?>'s Profile </div> <br><br>
        <div class="h1">Listings</div>
        <hr>
        <?php if(count($listings) > 0) {foreach($listings as $item) {?>
            <div class="media">
                <div class="media-left">
                    <img src="
	                    <?php
	                    if(file_exists('uploads/item_'.$item->item_id)) 
	                    	{echo '/uploads/item_'.$item->item_id;}
	                    else
	                    	echo 'https://placehold.it/700x400';
	                    ?>"
	            	class="media-object" style="width:60px">
                </div>
                <div class="media-body">
                    <h4 class="media-heading"><?php echo $item->item_name?></h4>
                    <p>&emsp;<?php echo $item->description?></p>
                </div>
            </div>
            <hr>
        <?php }} else {echo '<hr><p>They have no listings!';}?>
        <br>
        <div class="h1">Reviews</div><hr>
        <?php if(count($reviews) > 0) {foreach($reviews as $review) {?>
            <div class="media">
                <div class="media-left">
                    <!--img src="<?php if(file_exists('uploads/item_'.$item->item_id)) {echo '/uploads/item_'.$item->item_id;} else echo 'https://placehold.it/700x400';?>" class="media-object" style="width:60px"-->
                </div>
                <div class="media-body">
                        <?php
                        for ($j=0; $j<5; $j++) {
                            if ($review->rating - $j >= 0.5)
                                echo '&#9733; ';
                            else
                                echo '&#9734; ';
                        }
                        echo $review->title;
                        ?>
                        <br>
                        <small>
                            <?php
                            $date = strtotime($review->review_date);
                            $formatted_date = date("F d, Y", $date);
                            echo 'By '. $users->readUser($review->reviewer_id)->username.' on ' . $formatted_date?>
                        </small>
                        <p><?php echo $review->comment; ?></p>
                        <?php
                        if(end($reviews) !== $review){
                            echo '<hr>';
                        }

                        ?>
                </div>
            </div>
        <?php }} else {echo '<p>They have no reviews yet!';}?>
        </div>
        </div>
    </div>
<?php require 'application/views/layouts/footer.php'; ?>

