<div class="col-md-3">
    <div class="form">

    </div>
    <div class="list-group category">
    	<a href="/items" class="list-group-item category-item">
    		<?php if ($_SERVER['REQUEST_URI'] == "/items" || $_SERVER['REQUEST_URI'] == "/")
    		{
    			echo '<font color="blue">';
    			echo 'ALL';
    			echo '</font>';
    		}
    		else
    			echo 'ALL';?>
    	</a>
        <?php
            $categories = Category::getConstants();
            foreach ($categories as $key => $value) {
            	if (strpos ($_SERVER['REQUEST_URI'], $value))
            	{
            		echo '<a href="/items/';
	                echo strtolower($key);
	                echo '" class="list-group-item category-item">';
	                echo '<font color="blue">';
	                echo ucwords($value);
	                echo '</font>';
	                echo '</a>';
                }
                else
                {
	                echo '<a href="/items/';
	                echo strtolower($key);
	                echo '" class="list-group-item category-item">';
	                echo ucwords($value);
	                echo '</a>';
            	}
            }
        ?>
    </div>
</div>