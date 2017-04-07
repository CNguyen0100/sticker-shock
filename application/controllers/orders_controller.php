<?php

class Order extends Controller {
    
    public $id = null;

    public function loadModel()
    {
        require 'application/models/Order.php';
        $this->model = new Order($this->db);
    }

}
