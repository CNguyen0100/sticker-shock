<?php
class Item extends Model {

    public function getAllItems() {
        $sql = "SELECT item_id, item_name, size, price, description, category, subcategory FROM Items WHERE status='available'";
        $query = $this->db->prepare($sql); 
        $query->execute();
        
        return $query->fetchAll();
    }

}
