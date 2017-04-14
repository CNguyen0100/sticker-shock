<?php

class Pages extends Controller {

    public function index() {
        $this->title="Home";
        $items = $this->model->readAllItems();
        require 'application/views/pages/index.php';
    }

    public function contact() {
        $this->title="Contact Us";
        require 'application/views/pages/contact-us.php';
    }

    public function contactsubmission() {
        $this->title="Contact Us - Received";
        require 'application/helper/email.php';
    }

    public function error() {
        $this->title = "Page Not Found.";

        require 'application/views/pages/error.php';
    }


    public function checkout() {
        $this->title = "checkout";

        require 'application/views/pages/checkout.php';
    }

    public function loadModel()
    {
        require 'application/models/Item.php';
        $this->model = new Item($this->db);
    }
}
