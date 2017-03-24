<?php

class Pages extends Controller {

    public function index() {
        $this->title="Home";
        $items = $this->model->getAllItems();

        require 'application/views/layouts/header.php';
        require 'application/views/pages/index.php';
        require 'application/views/layouts/footer.php';
    }

    public function contact() {
        $this->title="Contact Us";

        require 'application/views/layouts/header.php';
        require 'application/views/pages/contact-us.php';
        require 'application/views/layouts/footer.php';
    }

    public function error() {
        $this->title = "Page Not Found.";

        require 'application/views/layouts/header.php';
        require 'application/views/pages/error.php';
        require 'application/views/layouts/footer.php';
    }

    public function loadModel()
    {
        require 'application/models/Item.php';
        $this->model = new Item($this->db);
    }
}
