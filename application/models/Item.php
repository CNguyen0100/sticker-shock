<?php
class Item extends Model {

    public function createItem($account_id, $name, $size, $price, $shipping, $description, $category, $subcategory){
        $stmt = $this->db->prepare("INSERT INTO Items (account_id, item_name, size, price, shipping, description, category, subcategory, status) 
          VALUES (:accountid, :name, :size, :price, :shipping, :description, :category, :subcategory, :status)");
        $stmt->bindParam(':accountid', $account_id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':size', $size);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':shipping', $shipping);
        $stmt->bindparam(':description', $description);
        $stmt->bindparam(':category', $category);
        $stmt->bindparam(':subcategory', $subcategory);
        $stmt->bindvalue(':status', 'available');
        $stmt->execute();
        $id = $this->db->lastInsertId();
        return $id;
    }

    public function readItem(){

    }

    public function updateItem(){

    }

    public function deleteItem(){

    }

    public function getItemById($id) {
        $sql = "SELECT item_id, item_name, size, price, description, category, subcategory FROM Items WHERE item_id='$id'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetch();
    }

    public function getItemsByCategory($category) {
        $sql = "SELECT item_id, item_name, size, price, description, category, subcategory FROM Items WHERE category='$category' AND status='available'";
        $query = $this->db->prepare($sql); 
        $query->execute();

        return $query->fetchAll();
    }

    public function getItemsBySubcategory($category, $subcategory) {
        $sql = "SELECT item_id, item_name, size, price, description, category, subcategory FROM Items WHERE category='$category' AND subcategory='$subcategory' AND status='available'";
        $query = $this->db->prepare($sql); 
        $query->execute();

        return $query->fetchAll();
    }

    public function getAllItems() {
        $sql = "SELECT item_id, item_name, size, price, description, category, subcategory FROM Items WHERE status='available'";
        $query = $this->db->prepare($sql); 
        $query->execute();
        
        return $query->fetchAll();
    }

}
