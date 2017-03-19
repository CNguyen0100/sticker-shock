<?php
 include_once "connection.php";
class Item {
    public $title;
    public $size;
    public $price;
    public $description;
    public $category;
    public $subcategory;
    private $table = 'Items';

   public function __construct($item_id, $title, $size, $price, $description, $category, $subcategory) {
        $this->item_id = $item_id;
        $this->title = $title;
        $this->size  = $size;
        $this->price  = $price;
        $this->description = $description;
        $this->category = $category;
        $this->$subcategory = $subcategory;
    }

    public static function getItemById($id){
        $db = db::getInstance();
        $result = $db->prepare("SELECT * FROM Items WHERE item_id='$id'");
        $result->execute();
        $row  = $result -> fetch();
        $item = new Item($row['item_id'], $row['title'], $row['size'], $row['price'], $row['description'], $row['category'], $row['subcategory']);
        $db = null;
        return $item;
    }

    public static function allItems() {
        $list = [];
        $db = db::getInstance();
        $result = $db->prepare("SELECT * FROM Items");
        $result->execute();
        while ($item = $result->fetch(PDO::FETCH_ASSOC))
        {
            $list[] = new Item($item['item_id'], $item['title'], $item['size'], $item['price'], $item['description'], $item['category'], $item['subcategory']);
        }
        $db = null;
        return $list;
    }
}
?>