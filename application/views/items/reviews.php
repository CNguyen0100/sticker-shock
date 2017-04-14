<?php
if (count($reviews) == 0) echo '<p>This user has no reviews.</p>';
foreach($reviews as $review): ?>
		<div class="row">
		    <div class="col-md-12">
	    	<?php
		    	##Print the stars
		        for ($j=0; $j<5; $j++) {
        			if ($review->rating - $j >= 0.5)
        				echo '&#9733; ';
        			else
        				echo '&#9734; ';
        		}
        		$user = $users->readUser($review->reviewer_id);
    			echo $user->first_name;
    		?>
		    <span class="float-right"><?php echo $review->review_date?></span>
		    <p><?php echo $review->comment; ?></p>
		    <?php
                if ($i<count($reviews)-1) echo '<hr>';
		    ?>
		</div>
	</div>
<?php endforeach; ?>