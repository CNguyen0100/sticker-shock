<?php
class Item {
    public $title;
    public $size;
    public $price;
    public $description;
    public $category;
    public $subcategory;

   public function __construct($title, $size, $price, $description, $category, $subcategory) {
        $this->title = $title;
        $this->size  = $size;
        $this->price  = $price;
        $this->description = $description;
        $this->category = $category;
        $this->$subcategory = $subcategory;
    }

    public static function allItems() {
        $list = [];
        $db = db::getInstance();
        $req = $db->query('SELECT * FROM Items');

        foreach($req->fetchAll() as $item) {
            $list[] = new Item($item['title'], $item['size'], $item['price'], $item['description'], $item['category'], $item['subcategory']);
        }

        return $list;
    }
}
?>