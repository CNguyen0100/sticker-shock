<?php
if (count($reviews) == 0) echo '<p>This user has no reviews.</p>';
foreach($reviews as $review): ?>
		<div class="row">
		    <div class="col-md-12">
	    	<?php
		        for ($j=0; $j<5; $j++) {
        			if ($review->rating - $j >= 0.5)
        				echo '&#9733; ';
        			else
        				echo '&#9734; ';
        		}
    			echo $review->review_title;
    		?>
                <br>
		    <small>
                <?php
                $date = strtotime($review->review_date);
                $formatted_date = date("F d, Y", $date);
                echo 'By '. $review->reviewer . ' on ' . $formatted_date?>
            </small>
		    <p><?php echo $review->comment; ?></p>
		    <?php
                if(end($reviews) !== $review){
                    echo '<hr>';
                }

            ?>
		</div>
	</div>
<?php endforeach; ?>
