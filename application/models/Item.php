<?php
class Item extends Model {

    public function createItem($account_id, $name, $size, $price, $shipping, $description, $category, $subcategory){
        $stmt = $this->db->prepare("INSERT INTO Items (account_id, item_name, size, price, shipping, description, category, subcategory) 
          VALUES (:accountid, :name, :size, :price, :shipping, :description, :category, :subcategory)");
        $stmt->bindParam(':accountid', $account_id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':size', $size);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':shipping', $shipping);
        $stmt->bindparam(':description', $description);
        $stmt->bindparam(':category', $category);
        $stmt->bindparam(':subcategory', $subcategory);
        $stmt->execute();
        $id = $this->db->lastInsertId();
        $stmt = $this->db->prepare("INSERT INTO UserItems (account_id, item_id) VALUES (:account_id, :item_id)");
        $stmt->bindParam(':account_id', $_SESSION['id']);
        $stmt->bindParam(':item_id', $id);
        $stmt->execute();
        return $id;
    }

    public function readBoughtItem($id){
        $sql = "SELECT Items.*, Accounts.rating FROM Items LEFT JOIN Accounts ON Items.account_id = Accounts.user_id WHERE Items.item_id='$id'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetch();
    }

    public function readItem($id){
        $sql = "SELECT Items.*, Sellers.username as seller, GROUP_CONCAT(IFNULL(Reviewers.username,NULL)) as reviewers, GROUP_CONCAT(IFNULL(Reviews.rating,NULL)) as ratings, GROUP_CONCAT(IFNULL(Reviews.comment,NULL) SEPARATOR '----') as comments, GROUP_CONCAT(Reviews.review_date) as review_dates, GROUP_CONCAT(Reviews.title) as review_titles FROM Items JOIN Reviews ON Reviews.seller_id = Items.account_id JOIN Accounts as Reviewers ON Reviewers.user_id = Reviews.reviewer_id JOIN Accounts as Sellers ON Sellers.user_id = Items.account_id WHERE Items.item_id = ".$id." AND Items.available=true;";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetch();
    }

    public function getItemById($id){
        $sql = "SELECT * FROM Items WHERE item_id=" .$id.";";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetch();
    }
  
    public function readAllItems($category = null, $subcategory = null, $search = null) {
        $sql = "SELECT Items.item_id, Items.account_id, Items.item_name, Items.price, Items.description, Items.shipping, Items.category, Items.subcategory, Accounts.rating FROM Items LEFT JOIN Accounts ON Items.account_id = Accounts.user_id WHERE available=true";
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

    public function updateItem($account_id, $item_id, $name, $size, $price, $shipping, $description, $category, $subcategory, $available, $tracking){
        $stmt = $this->db->prepare("UPDATE Items SET account_id=:accountid, item_name=:name, size=:size, price=:price, shipping=:shipping, 
            description=:description, category=:category, subcategory=:subcategory, available=:status, tracking_number=:tracking WHERE item_id=:item_id");
        $stmt->bindParam(':accountid', $account_id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':size', $size);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':shipping', $shipping);
        $stmt->bindparam(':description', $description);
        $stmt->bindparam(':category', $category);
        $stmt->bindparam(':subcategory', $subcategory);
        $stmt->bindparam(':status', $available);
        $stmt->bindparam(':tracking', $tracking);
        $stmt->bindparam(':item_id', $item_id);
        $stmt->execute();
        $id = $this->db->lastInsertId();
        //return $id;
    }

    public function deleteItem($item_id){
        $stmt = $this->db->prepare("DELETE FROM Items WHERE item_id='$item_id'");
        $stmt->execute();
    }

    public function purchaseItem($item_id){
        $stmt = $this->db->prepare("UPDATE Items SET available=:status WHERE item_id=:item_id");
        $stmt->bindvalue(':status', 0);
        $stmt->bindParam(':item_id', $item_id);
        $stmt->execute();
    }
}
