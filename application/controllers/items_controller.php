<?php

class Items extends Controller {
    
    public $id = null;

    public function index() {
        $this->title="Browse";
        $items = $this->model->getAllItems();

        require 'application/views/layouts/header.php';
        require 'application/views/items/index.php';
        require 'application/views/layouts/footer.php';
    }

    public function item($id) {
        $item = $this->model->getItemById($id);

        if (!$item) {
            $error_page();
            return;
        }

        $this->title = $item->item_name;

        require 'application/views/layouts/header.php';
        require 'application/views/items/item.php';
        require 'application/views/layouts/footer.php';
    }

    public function loadModel()
    {
        require 'application/models/Item.php';
        $this->model = new Item($this->db);
    }

}
