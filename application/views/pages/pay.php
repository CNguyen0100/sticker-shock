<?php

use PayPay\Api\Payment;
use PayPal\Api\PaymentExecution;
require 'app/start.php';

if(!isset($_GET['success'], $_GET['paymentId'], $_GET['payerID'])) {
	die();
}

if((bool)$_GET['success'] == false){
	die();
}

$paymentId = $_GET['paymentId'];
$payerId = $_GET['PayerID'];

$payment = Payment::get($paymentId, $paypal);

$execute = new PaymentExecution();
$execute->setPayerId($payerId);

try {
	$result = $payment->execute($execute, $paypal);
} catch(Execution $e) {
	$data = json_decode($e->getData());
	echo $data->message;
	die();
}

echo 'Payment made. Thank You!';