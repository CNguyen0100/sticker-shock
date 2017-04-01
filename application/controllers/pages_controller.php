<?php

class Pages extends Controller {

    public function index() {
        $this->title="Home";
        $items = $this->model->getAllItems();
        require 'application/views/pages/index.php';
    }

    public function sell(){
        if(isset($_SESSION['username']) && $_SESSION['username'] != '') {
            $this->title = "Sell";
            require 'application/views/pages/sell.php';
        } else{
            $_SESSION['login_error'] = 'You must be logged in to complete this action';
            require 'application/views/account/login.php';
        }
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

    public function loadModel()
    {
        require 'application/models/Item.php';
        $this->model = new Item($this->db);
    }
}
