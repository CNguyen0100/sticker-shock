<?php
	require 'vendor/autoload.php'; 

	define('SITE_URL', (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
	$paypal = new \PayPal\Rest\ApiContext(
		new \PayPal\Auth\OAuthTokenCredential('Aae-AbapuLqWfGCA8afEu7Vv86l2TliJqP6JsjiHvCqQ_qS9SzdSG2FJklx23ay9yWLklZI6zXPwHD39'
, 'EKiP66I3TOuO0suaiNUC6bz3Xy0IkztPvKaEgRxdJY8QIS-ZPRJDEWW608L6tJcteEKTcDTGDNK39Bt6')); ?>