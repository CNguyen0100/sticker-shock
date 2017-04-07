<?php

class Order extends Controller {
    
    public $id = null;

    public function order($id) {
        $order = $this->model->getOrderById($id);

        if (!$order) {
            header('location: /pages/error');
            return;
        }
    }

    public function submitOrder()
    {
        $account_id = $_SESSION['id'];
        //basic values
        $tax = 10;
        $subtotal = 10;
        //get item
        $shipping = $_POST['shipping'];
        //get account
        $address_1 = 

        $id = $this->model->createOrder($account_id, $tax, $subtotal, $shipping, $address_1, $city, $state, $zip, $item_id);
        $this->order($id);
    }

    public function loadModel()
    {
        require 'application/models/Order.php';
        $this->model = new Order($this->db);
    }

}
