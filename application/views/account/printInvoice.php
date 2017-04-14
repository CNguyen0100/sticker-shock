<!--print invoice for only order id-->
<?php
require 'application/views/layouts/header.php'; ?>

<div class="container">
	<div class="row">
		<div class="col-md-3">
             <h3 class="media-heading">Item Name:</h3>
                    <p>&emsp;<?php echo $_SESSION['invoice']->item_name ?></p>
             </div>
		</div>
		<div class="col-md-3">
             <h3 class="media-heading">Size:</h3>
                    <p>&emsp;<?php echo $_SESSION['invoice']->size ?></p>
             </div>
		</div>
		<div class="col-md-3">
             <h3 class="media-heading">Shipping address:</h3>
                    <p>&emsp;<?php echo $_SESSION['invoice']->address_1 ?>,&emsp;<?php echo $_SESSION['invoice']->city ?>,&emsp;
                    <?php echo $_SESSION['invoice']->state ?>,&emsp;<?php echo $_SESSION['invoice']->zip ?></p>
             </div>
		</div>
		<div class="col-md-3">
             <h3 class="media-heading">Completion Date:</h3>
                    <p>&emsp;<?php echo $_SESSION['invoice']->completion_date ?></p>
             </div>
		</div>
		<div class="col-md-3">
             <h3 class="media-heading">Price:</h3>
                    <p>&emsp;$<?php echo $_SESSION['invoice']->price ?></p>
             </div>
		</div>
		<div class="col-md-3">
             <h3 class="media-heading">Shipping:</h3>
                    <p>&emsp;$<?php echo $_SESSION['invoice']->shipping ?></p>
             </div>
		</div>
		</div>
		<div class="col-md-3">
             <h3 class="media-heading">Total:</h3>
                    <p>&emsp;$<?php echo $_SESSION['invoice']->total ?></p>
             </div>
		</div>
	</div>
</div>

<?php require 'application/views/layouts/footer.php'; ?>

