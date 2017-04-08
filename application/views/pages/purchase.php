<?php require 'application/views/layouts/header.php'; 
	require 'vendor/autoload.php';

	define('SITE_URL', 'sdickerson.ddns.net');
	$paypal = new \PayPal\Rest\ApiContext(
		new \PayPal\Auth\OAuthTokenCredential('Aae-AbapuLqWfGCA8afEu7Vv86l2TliJqP6JsjiHvCqQ_qS9SzdSG2FJklx23ay9yWLklZI6zXPwHD39'
, 'EKiP66I3TOuO0suaiNUC6bz3Xy0IkztPvKaEgRxdJY8QIS-ZPRJDEWW608L6tJcteEKTcDTGDNK39Bt6')); ?>
	<body>
		<div class="payment-container">
			<h2 class ="header"> Pay for {item}</h2>

			<form action="checkout.php" method="post" autocomplete="off">
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
	</body>
    <div class="container">
        <div class="h1">Thank You!<hr></div>
    </div>
<?php require 'application/views/layouts/footer.php'; ?>
