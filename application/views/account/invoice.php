<!--print invoice for only order id-->
<?php
require 'application/views/layouts/header.php'; ?>

<div class="container">
        <h3>Invoice:</h3>
             <p class="media-heading">Item Name: &emsp;<?php echo $invoice->item_name ?></p>

             <p class="media-heading">Size: &emsp;<?php echo $invoice->size ?></p>

             <p class="media-heading">Shipping address: &emsp;<?php echo $invoice->address_1 ?>,&emsp;<?php echo $invoice->city ?>,&emsp;
                    <?php echo $invoice->state ?>,&emsp;<?php echo $invoice->zip ?></p>

             <p class="media-heading">Completion Date: &emsp;<?php echo $invoice->completion_date ?></p>

             <p class="media-heading">Price: &emsp;$<?php echo $invoice->price ?></p>

             <p class="media-heading">Shipping: &emsp;$<?php echo $invoice->shipping ?></p>

             <p class="media-heading">Total: &emsp;$<?php echo $invoice->total ?></p>
		</div>
</div>


<?php require 'application/views/layouts/footer.php'; ?>

