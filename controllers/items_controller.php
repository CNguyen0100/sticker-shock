<?php

class Items extends Controller {
    
    public $id = null;

    public function index() {
        $this->title="Browse";
        $items = $this->model->getAllItems();

        require './views/layouts/header.php';
        require './views/items/index.php';
        require './views/layouts/footer.php';
    }

    public function item($id) {
        $item = $this->model->getItemById($id);

        $this->title = $item->item_name;

        require './views/layouts/header.php';
        require './views/items/item.php';
        require './views/layouts/footer.php';
    }

    public function loadModel()
    {
        require './models/Item.php';
        $this->model = new Item($this->db);
    }

}
