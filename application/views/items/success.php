<?php
require 'application/views/layouts/header.php';
require 'application/helper/start.php';
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Payout;
use PayPal\Api\PayoutSenderBatchHeader;
use PayPal\Api\PayoutItem;
use PayPal\Api\Currency;

        $paymentId = $_GET['paymentId'];
        $payerId = $_GET['PayerID'];
        $payment = Payment::get($paymentId, $paypal);
        $execute = new PaymentExecution();
        $execute->setPayerId($payerId);
        $payment = $payment->execute($execute, $paypal);
        $response = $payment->toJSON();
        $response = json_decode($response);
        $_POST['item_id'] = $response->transactions[0]->item_list->items[0]->sku;
        $_POST['total'] = $response->transactions[0]->amount->total;
        $_POST['shipping'] = $response->transactions[0]->amount->details->shipping;
        $shipping_address = $response->payer->payer_info->shipping_address;
        $_POST['address1'] = $shipping_address->line1;
        if(isset($shipping_address->line2))
            $_POST['address2'] = $shipping_address->line2;
        else
            $_POST['address2'] = null;
        $_POST['city'] = $shipping_address->city;
        $_POST['state'] = $shipping_address->state;
        $_POST['zip'] = $shipping_address->postal_code;
        $_POST['country'] = $shipping_address->country_code;
        $_POST['recipient_name'] = $shipping_address->recipient_name;
        $_SESSION['POST'] = $_POST;
        $payouts = new Payout();
        $senderBatchHeader = new PayoutSenderBatchHeader();
        $senderBatchHeader->setSenderBatchId(uniqid())
            ->setEmailSubject("You have a Payout!");
        $senderItem = new PayoutItem();
        $senderItem->setRecipientType('Email')
            ->setNote('Thanks for your patronage!')
            ->setReceiver('moriahmaney@gmail.com')
            ->setAmount(new Currency('{
                "value": "'.$_POST['total'].'",
                "currency":"USD"
            }'));
        $payouts->setSenderBatchHeader($senderBatchHeader)
            ->addItem($senderItem);
        $payout= $payouts->createSynchronous($paypal);

        header('location:/items/updatestatus/'.$_POST['item_id']);
