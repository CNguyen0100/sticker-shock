<?php require 'application/views/layouts/header.php';  ?>
	<br>
		<div class="container">

            <?php echo var_dump($_POST)?>
			<form action="/pages/checkout" method="post" autocomplete="off">
				<label for="item">
					Product
					<input type="text" name="product">
				</label>
				<label for="account">
					Price
					<input type="text" name="price">
				</label>

				<input type="submit" value="Pay">
			</form>
		</div>
<?php require 'application/views/layouts/footer.php'; ?>
