<?php

class Pages extends Controller {

    public function index() {
        $this->title="Home";
        $items = $this->model->getAllItems();
        require 'application/views/pages/index.php';
    }

    public function sell(){
        include 'application/controllers/helpers/categories.php';
        echo constant('Category::Shirts');
        $arr = Category::getConstants();
        if(isset($_SESSION['username']) && $_SESSION['username'] != '') {
            $this->title = "Sell";
            require 'application/views/pages/sell.php';
        } else{
            $_SESSION['login_error'] = 'You must be logged in to complete this action';
            header('location: /account/login');
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
