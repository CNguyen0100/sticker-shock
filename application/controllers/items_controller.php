<?php
# Graham L.:
# This are strictly enums for categories/subcategories.
require 'application/controllers/helpers/categories.php';
require 'application/controllers/helpers/subcategories.php';

class Items extends Controller {
    
    public $id = null;
    public $category = "";
    public $subcategory = "";

    public function index($category, $args) {

        # Graham L.:
        # The following if/else clusterfuck is the simplest way I could come up
        # with to implement categories/subcategories.
        # If the category/subcategory doesn't exist, it redirects to the 
        # generic error page. This behavior could be improved by going to a
        # page with all the categories or something along those lines.

        if (isset($category)) {
            if (! $this->category = Category::isValid($category)) {
                header('location: /pages/error');
                return;
            }

            if (isset($args[0])) {
                if (! $this->subcategory = Subcategory::isValid($args[0])) {
                    header('location: /pages/error');
                    return;
                }

                $this->title = ucwords("$this->category - $this->subcategory");

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
            header('location: /pages/error');
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
