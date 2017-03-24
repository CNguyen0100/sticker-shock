<?php

class Pages extends Controller {

    public function index() {
        $this->title="Home";
        $items = $this->model->getAllItems();

        require './views/layouts/header.php';
        require './views/pages/index.php';
        require './views/layouts/footer.php';
    }

    public function error() {
        require './views/layouts/header.php';
        require './views/pages/error.php';
        require './view/pages/error.php';
    }

    public function loadModel()
    {
        require './models/Item.php';
        $this->model = new Item($this->db);
    }
}
