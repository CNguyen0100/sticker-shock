<?php
require 'application/controllers/helpers/categories.php';
require 'application/controllers/helpers/subcategories.php';

class Items extends Controller {
    
    public $id = null;
    public $category = "";
    public $subcategory = "";

    public function index($category, $args) {

        if (isset($category)) {
            if (! $this->category = Category::isValid($category)) {
                header('location: ' . URL . 'pages/error');
                return;
            }

            if (isset($args[0])) {
                if (! $this->subcategory = Subcategory::isValid($args[0])) {
                    header('location: ' . URL . 'pages/error');
                    return;
                }

                $this->title = ucwords("$this->category - $this->subcategory");
                
                if ($this->subcategory == 'tanktops') {
                    $this->subcategory = "tank tops";
                }

                $items = $this->model->getItemsBySubcategory($this->category, $this->subcategory);
            } else {
                $this->title = ucfirst("$this->category");
                $items = $this->model->getItemsByCategory($this->category);
            }
        } else {
            $this->title="Browse";
            $items = $this->model->getAllItems();
        }

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
