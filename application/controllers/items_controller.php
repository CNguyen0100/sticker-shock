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

    public function submititem()
    {
        $account_id = $_SESSION['id'];
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
        $size = filter_input(INPUT_POST, 'size', FILTER_SANITIZE_STRING);
        $price = $_POST['price'];
        $shipping = $_POST['shipping'];
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
        $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING);
        $subcategory = filter_input(INPUT_POST, 'subcategory', FILTER_SANITIZE_STRING);
        $id = $this->model->createItem($account_id, $title, $size, $price, $shipping, $description, $category, $subcategory);
        $target_dir = "/srv/http/uploads/";
        $target_file = $target_dir . basename('item_' . $id);
        move_uploaded_file($_FILES['item_img']['tmp_name'], $target_file);
        $this->item($id);
    }

    public function deleteitem($id){
        $this->model->deleteItem($id);
        header('location: /account');
        return;
    }

    public function loadModel()
    {
        require 'application/models/Item.php';
        $this->model = new Item($this->db);
    }

}
