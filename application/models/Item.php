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
        $stmt = $this->db->prepare("INSERT INTO UserItems (account_id, item_id) VALUES (:account_id, :item_id)");
        $stmt->bindParam(':account_id', $_SESSION['id']);
        $stmt->bindParam(':item_id', $id);
        $stmt->execute();
        return $id;
    }

    public function readItem(){

    }

    public function updateItem(){

    }

    public function deleteItem($item_id){
        $stmt = $this->db->prepare("DELETE FROM Items WHERE item_id='$item_id'");
        $stmt->execute();
    }

    public function getItemById($id) {
        $sql = "SELECT item_id, item_name, size, price, description, category, subcategory FROM Items WHERE item_id='$id'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetch();
    }

    public function getItemsByUser($user_id) {
        $sql = "SELECT item_id, item_name, size, price, description, category, subcategory FROM Items WHERE account_id='$user_id'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
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
