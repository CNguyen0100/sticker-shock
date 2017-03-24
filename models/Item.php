<?php
class Item extends Model {
    
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

    public function getAllItems() {
        $sql = "SELECT item_id, item_name, size, price, description, category, subcategory FROM Items WHERE status='available'";
        $query = $this->db->prepare($sql); 
        $query->execute();
        
        return $query->fetchAll();
    }

}
