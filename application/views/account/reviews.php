<?php
	##These variables need to be set from reviews in the database
	$numReviews=3;
	for ($i=0; $i<$numReviews; $i++)
	{
		$review=4;
		$text='I\'ve seen some better than this, but not at this price. I definitely recommend this item.';
		$name='Anonymous';
		$daysAgo=15;
		?>

		<div class="row">
		    <div class="col-md-12">
	    	<?php
		    	##Print the stars
		        for ($j=0; $j<5; $j++) {
        			if ($review - $j >= 0.5)
        				echo '&#9733; ';
        			else
        				echo '&#9734; ';
        		} 
    			echo $name;
    		?>
		    <span class="float-right"><?php echo $daysAgo; ?> days ago</span>
		    <p><?php echo $text; ?></p>
		    <?php if ($i<$numReviews-1) echo '<hr>'; ?>
		</div>
	</div>
<?php } ?>