<?php require 'application/views/layouts/header.php';

$review = new Review($this->db);
$reviews = $review->getReviewsByUser($user->user_id);
?>
    <div class="container">
        <div class="h1"> <?php echo ucfirst($user->username); ?>'s Account </div> <br><br>
        <div class="h1">Their Listings</div>
        <?php if(count($listings) > 0) {foreach($listings as $item) {?>
            <hr>
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
                    <h4 class="media-heading">&emsp;<?php echo $item->item_name?></h4>
                    <p>&emsp;<?php echo $item->description?></p>
                </div>
            </div>
        <?php }} else {echo '<hr><p>They have no listings!';}?>
        <br>
        <div class="h1">Their Reviews</div>
        <?php if(count($reviews) > 0) {foreach($reviews as $i) {?>
            <hr>
            <div class="media">
                <div class="media-left">
                    <!--img src="<?php if(file_exists('uploads/item_'.$item->item_id)) {echo '/uploads/item_'.$item->item_id;} else echo 'https://placehold.it/700x400';?>" class="media-object" style="width:60px"-->
                </div>
                <div class="media-body">
                    <h4 class="media-heading">
                    	<?php
				        for ($j=0; $j<5; $j++) {
		        			if ($i->rating - $j >= 0.5)
		        				echo '&#9733; ';
		        			else
		        				echo '&#9734; ';
		        		}
		        		echo '&emsp;';
		        		$user = new User($this->db);
		    			$thisUser = $user->readUser($i->reviewer_id);
		    			echo $thisUser->first_name;
		    			?>
		    		</h4>
                    <p><?php echo $i->comment;?></p>
                </div>
            </div>
            <hr>
        <?php }} else {echo '<hr><p>They have no reviews yet!';}?>
        </div>
        </div>
    </div>
<?php require 'application/views/layouts/footer.php'; ?>

