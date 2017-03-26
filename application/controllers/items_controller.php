<?php

class Items extends Controller {
    
    public $id = null;

    public function index() {
        $this->title="Browse";
        $items = $this->model->getAllItems();

        require 'application/views/items/index.php';
    }

    public function item($id) {
        $item = $this->model->getItemById($id);

        if (!$item) {
            header('location: ' . URL . 'pages/error');
            return;
        }

        $this->title = $item->item_name;

        require 'application/views/items/item.php';
    }

    public function loadModel()
    {
        require 'application/models/Item.php';
        $this->model = new Item($this->db);
    }

}
