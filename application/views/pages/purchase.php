<?php require 'application/views/layouts/header.php';  ?>
	<br>
		<div class="payment-container">
			<h2 class ="header"> Pay for {item}</h2>

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
