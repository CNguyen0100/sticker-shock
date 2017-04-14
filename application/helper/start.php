<?php
	require 'vendor/autoload.php'; 

	define('SITE_URL', (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]");
	$paypal = new \PayPal\Rest\ApiContext(
		new \PayPal\Auth\OAuthTokenCredential('ARo9_5Dv007NGQzmfWgBSzsqekv_ufc5VcjDFiz0AXQJsOZbJs6d0UpPKTBtGhODI6pAi8r2mWsbZESm'
, 'EMn0Tt4kdVd6OWzoiHCeJbytmaWOt4rne0ATljhNZdsPIuBq6MDkKISepv5kf4T03ucLqNFWsz5hVn3H')); ?>
