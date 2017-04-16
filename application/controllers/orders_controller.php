<?php

class Orders extends Controller {
    
    public $id = null;

    public function createorder(){
        $post = $_SESSION['POST'];
        unset($_SESSION['POST']);
        $account_id = $_SESSION['id'];
        $item_id = $post['item_id'];
        $name = $post['recipient_name'];
        $shipping = $post['shipping'];
        $total = $post['total'];
        $address_1 = $post['address1'];
        $address_2 = $post['address2'];
        $city = $post['city'];
        $state = $post['state'];
        $zip = $post['zip'];
        $country = $post['country'];
        $this->model->createOrder($account_id, $total, $shipping, $name, $address_1, $address_2, $city, $state, $zip, $country, $item_id);
        header('location: /account');
    }

    public function loadModel()
    {
        require 'application/models/Order.php';
        $this->model = new Order($this->db);
    }

}
