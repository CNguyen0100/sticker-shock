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

    public function readItem($id){
        $sql = "SELECT Items.*, Accounts.rating FROM Items LEFT JOIN Accounts ON Items.account_id = Accounts.user_id WHERE status='available' AND Items.item_id='$id'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetch();
    }
  
    public function readAllItems($category = null, $subcategory = null, $search = null) {
        $sql = "SELECT Items.item_id, Items.account_id, Items.item_name, Items.price, Items.description, Items.shipping, Items.category, Items.subcategory, Accounts.rating FROM Items LEFT JOIN Accounts ON Items.account_id = Accounts.user_id WHERE status='available'";
        if (isset($category)) {
            $sql .= " AND category='" . $category . "'";
            $category = strtolower($category);

            if (isset($subcategory)) {
                $sql .= " AND subcategory='" . $subcategory . "'";
                $subcategory = strtolower($subcategory);
            }
        }
        if (isset($search)) {
            $search = strtolower($search);
            $sql .= " AND (LOWER(item_name) LIKE '%$search%' OR LOWER(category) LIKE '%$search%' OR LOWER(subcategory) LIKE '%$search%' OR LOWER(description) LIKE '%$search%')";
        }
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    # Graham L.:
    # This funciton is an outdated version of the previous function. Keeping it
    # here for now but will remove in a future version.
    public function readAllItemsOld() {
        $sql = "SELECT Items.item_id, Items.account_id, Items.item_name, Items.price, Items.description, Items.shipping, Items.category, Items.subcategory, Accounts.rating FROM Items LEFT JOIN Accounts ON Items.account_id = Accounts.user_id";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
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
        $stmt->bindParam(':item_id', $item_id);
        $stmt->execute();
    }

    public function deleteItem($item_id){
        $stmt = $this->db->prepare("DELETE FROM Items WHERE item_id='$item_id'");
        $stmt->execute();
    }
    
    # Graham L.:
    # This function is redundant and can likely be removed once all calls to it
    # are replaced with calls to readItem();
    public function getItemById($id) {
        $sql = "SELECT * FROM Items WHERE item_id='$id'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetch();
    }

    # Graham L.:
    # This function is no longer used now that readAllItems() handles 
    # categories. It will be removed in a future version.
    public function getItemsByCategory($category) {
        $sql = "SELECT Items.*, Accounts.rating FROM Items LEFT JOIN Accounts ON Items.account_id = Accounts.user_id WHERE category='$category' AND status='available'";
        $query = $this->db->prepare($sql); 
        $query->execute();

        return $query->fetchAll();
    }

    # Graham L.:
    # This function is no longer used now that readAllItems() handles
    # subcategories. It will be removed in a future version.
    public function getItemsBySubcategory($category, $subcategory) {
        $sql = "SELECT Items.*, Accounts.rating FROM Items LEFT JOIN Accounts ON Items.account_id = Accounts.user_id WHERE category='$category' AND subcategory='$subcategory' AND status='available'";
        $query = $this->db->prepare($sql); 
        $query->execute();

        return $query->fetchAll();
    }

    # Graham L.:
    # This function is redundant and can likely be removed once all calls to it
    # are replaced with calls to readAllItems();
    public function getAllItems() {
        $sql = "SELECT * FROM Items WHERE status='available'";
        $query = $this->db->prepare($sql); 
        $query->execute();
        
        return $query->fetchAll();
    }

}
