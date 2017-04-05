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

    public function updateItem($account_id, $item_id, $name, $size, $price, $shipping, $description, $category, $subcategory, $status, $tracking){
        $stmt = $this->db->prepare("UPDATE Items SET account_id=:accountid, item_name=:name, size=:size, price=:price, shipping=:shipping, 
            description=:description, category=:category, subcategory=:subcategory, status=:status, tracking_number=:tracking WHERE item_id=:item_id");
        $stmt->bindParam(':accountid', $account_id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':size', $size);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':shipping', $shipping);
        $stmt->bindparam(':description', $description);
        $stmt->bindparam(':category', $category);
        $stmt->bindparam(':subcategory', $subcategory);
        $stmt->bindparam(':status', $status);
        $stmt->bindparam(':tracking', $tracking);
        $stmt->bindparam(':item_id', $item_id);
        $stmt->execute();
        $id = $this->db->lastInsertId();
        //return $id;
    }

    public function purchaseItem($item_id){
        $stmt = $this->db->prepare("UPDATE Items SET status=:status WHERE item_id=:item_id");
        $stmt->bindvalue(':status', 'purchased');
        $stmt->bindparam(':item_id', $item_id);
        $stmt->execute();
    }

    public function deleteItem($item_id){
        $stmt = $this->db->prepare("DELETE FROM Items WHERE item_id='$item_id'");
        $stmt->execute();
    }

    public function getItemById($id) {
        $sql = "SELECT * FROM Items WHERE item_id='$id'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetch();
    }

    public function getItemsByUser($user_id) {
        $sql = "SELECT * FROM Items WHERE account_id='$user_id'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function getItemsByCategory($category) {
        $sql = "SELECT * FROM Items WHERE category='$category' AND status='available'";
        $query = $this->db->prepare($sql); 
        $query->execute();

        return $query->fetchAll();
    }

    public function getItemsBySubcategory($category, $subcategory) {
        $sql = "SELECT * FROM Items WHERE category='$category' AND subcategory='$subcategory' AND status='available'";
        $query = $this->db->prepare($sql); 
        $query->execute();

        return $query->fetchAll();
    }

    public function getAllItems() {
        $sql = "SELECT * FROM Items WHERE status='available'";
        $query = $this->db->prepare($sql); 
        $query->execute();
        
        return $query->fetchAll();
    }

}
