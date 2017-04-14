<!--print invoice for only order id-->
<?php
require 'application/views/layouts/header.php'; ?>

<div class="container">
        <h3>Invoice:</h3>
             <p class="media-heading">Item Name: &emsp;<?php echo $_SESSION['invoice']->item_name ?></p>

             <p class="media-heading">Size: &emsp;<?php echo $_SESSION['invoice']->size ?></p>

             <p class="media-heading">Shipping address: &emsp;<?php echo $_SESSION['invoice']->address_1 ?>,&emsp;<?php echo $_SESSION['invoice']->city ?>,&emsp;
                    <?php echo $_SESSION['invoice']->state ?>,&emsp;<?php echo $_SESSION['invoice']->zip ?></p>

             <p class="media-heading">Completion Date: &emsp;<?php echo $_SESSION['invoice']->completion_date ?></p>

             <p class="media-heading">Price: &emsp;$<?php echo $_SESSION['invoice']->price ?></p>

             <p class="media-heading">Shipping: &emsp;$<?php echo $_SESSION['invoice']->shipping ?></p>

             <p class="media-heading">Total: &emsp;$<?php echo $_SESSION['invoice']->total ?></p>
		</div>
</div>


<?php require 'application/views/layouts/footer.php'; ?>

