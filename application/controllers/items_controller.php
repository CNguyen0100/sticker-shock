<?php

class Items extends Controller {
    
    public $id = null;
    public $category = null;
    public $subcategory = null;
    public $search = null;

    public function index($category = null, $args = null) {

        # Graham L.:
        # The following if/else clusterfuck is the simplest way I could come up
        # with to implement categories/subcategories.
        # If the category/subcategory doesn't exist, it redirects to the 
        # generic error page. This behavior could be improved by going to a
        # page with all the categories or something along those lines.

        if (isset($_GET['search'])) {
           $this->search = $_GET['search'];
        }

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

                #$items = $this->model->getItemsBySubcategory($this->category, $this->subcategory);
            } else {
                $this->title = ucfirst("$this->category");
                #$items = $this->model->getItemsByCategory($this->category);
            }
        } else {
            $this->title="Browse";
        }

        $items = $this->model->readAllItems($this->category, $this->subcategory, $this->search);
        require 'application/views/items/index.php';
    }

    public function item($id) {
        $item = $this->model->readItem($id);

        if (!$item) {
            header('location: /pages/error');
            return;
        }

        $this->title = $item->item_name;
        require 'application/views/items/item.php';
    }

    public function order($id) {
        $this->loadOrderModel();
        $order = $this->model->getOrderById($id);

        if (!$order) {
            header('location: /pages/error');
            return;
        }
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
        $target_dir = "/var/www/html/uploads/";
        $target_file = $target_dir . basename('item_' . $id);
        move_uploaded_file($_FILES['item_img']['tmp_name'], $target_file);
        $this->item($id);
    }

    public function edititem($id){
        $arr = Category::getConstants();
        $arr2 = Subcategory::getConstants();
        $item = $this->model->getItemById($id);
        if (!$item) {
            header('location: /pages/error');
            return;
        }
        $this->title = 'Edit Item: '.$item->item_name;
        require 'application/views/items/edit.php';
    }

    public function updateitem($id, $status){
        $account_id = $_SESSION['id'];
        $item_id = $id;
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
        $size = filter_input(INPUT_POST, 'size', FILTER_SANITIZE_STRING);
        $price = $_POST['price'];
        $shipping = $_POST['shipping'];
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
        $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING);
        $subcategory = filter_input(INPUT_POST, 'subcategory', FILTER_SANITIZE_STRING);
        $tracking = filter_input(INPUT_POST, 'tracking', FILTER_SANITIZE_STRING);
        $this->model->updateItem($account_id, $item_id, $title, $size, $price, $shipping, $description, $category, $subcategory, $status, $tracking);
        $this->item($item_id);

    }

    public function purchaseitem(){
        include 'application/models/User.php';
        $users = new User($this->db);
        $user = $users->readUser($_SESSION['id']);

        $item_id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
        $this->model->purchaseItem($item_id);

        # send to Order;

        $account_id = $user->user_id;
        //basic values
        $tax = 10;
        $subtotal = 10;
        //get item
        $shipping = $this->model->getItembyId($item_id)->shipping;

        //get account
        $address_1 = $user->address_1;
        $city = $user->city;
        $state = $user->state;
        $zip = $user->zip;



        $this->loadOrderModel();
        $id = $this->model->createOrder($account_id, $tax, $subtotal, $shipping, $address_1, $city, $state, $zip, $item_id);

        //$this->order($id);

        
        # reroute
        header('location: /pages/purchase');

    }

    public function loadOrderModel()
    {
        include 'application/models/Order.php';
        $this->model = new Order($this->db);
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
