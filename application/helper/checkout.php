<?php

use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use PayPal\Api\Payout;
use PayPal\Api\PayoutSenderBatchHeader;
use PayPal\Api\PayoutItem;
use PayPal\Api\Currency;
use PayPal\Api\Sale;


require 'application/helper/start.php';

if(!isset($_POST['item_name'], $_POST['price'])) {
    header('location: /pages/error');
}

$product = $_POST['item_name'];
$price = $_POST['price'];
$shipping = $_POST['shipping'];
$item_id = $_POST['item_id'];
$total = $price + $shipping;

$payer = new Payer();
$payer->setPaymentMethod('paypal');

$item = new Item();
$item->setName($product)
    ->setSku($item_id)
	->setCurrency('USD')
	->setQuantity(1)
	->setPrice($price);

$itemList = new ItemList();
$itemList->setItems([$item]);

$details = new Details();
$details->setShipping($shipping)
	->setSubtotal($price);

$amount = new Amount();
$amount->setCurrency('USD')
	->setTotal($total)
	->setDetails($details);

$transaction = new Transaction();
$transaction->setAmount($amount)
	->setItemList($itemList)
	->setDescription('Sticker-Shock Payment')
	->setInvoiceNumber(uniqid());

$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl(SITE_URL . '/items/purchasesuccess')
	->setCancelUrl(SITE_URL . '/pages/error');

$payment = new Payment();
$payment->setIntent('sale')
	->setPayer($payer)
	->setRedirectUrls($redirectUrls)
	->setTransactions([$transaction]);

try{
	$payment->create($paypal);

} catch(Exception $e) {
	die($e);
}

$_SESSION['payment'] = serialize($payment);
$approvalUrl = $payment->getApprovalLink();
header("Location: {$approvalUrl}");















