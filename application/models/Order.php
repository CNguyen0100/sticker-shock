<?php

class Order extends Model {
    public function createOrder($account_id, $total, $shipping, $name, $address_1, $address_2, $city, $state, $zip, $country, $item_id){
        $stmt = $this->db->prepare("INSERT INTO Orders (account_id, status, total, shipping, recipient_name, address_1, address_2, city, state, zip, country,  completion_date)
          VALUES (:accountid, :status, :total, :shipping, :recipient_name, :address1, :address2, :city, :state, :zip, :country, :completion_date)");
        $stmt->bindParam(':accountid', $account_id);
        $stmt->bindvalue(':status', 'purchased');
        $stmt->bindParam(':shipping', $shipping);
        $stmt->bindparam(':total', $total);
        $stmt->bindparam(':address1', $address_1);
        $stmt->bindparam(':address2', $address_2);
        $stmt->bindparam(':country', $country);
        $stmt->bindparam(':city', $city);
        $stmt->bindparam(':state', $state);
        $stmt->bindparam(':zip', $zip);
        $stmt->bindparam(':recipient_name', $name);
        $stmt->bindvalue(':completion_date',  date("Y-m-d H:i:s"));

        $stmt->execute();
        $id = $this->db->lastInsertId();
        #ItemOrders
        $stmt = $this->db->prepare("INSERT INTO ItemOrders (item_id, order_id) VALUES (:itemid, :orderid)");
        $stmt->bindParam(':itemid', $item_id);
        $stmt->bindParam(':orderid', $id);

        $stmt->execute();
        #AccountOrders
        $stmt = $this->db->prepare("INSERT INTO AccountOrders (account_id, order_id) VALUES (:accountid, :orderid)");
        $stmt->bindParam(':accountid', $account_id);
        $stmt->bindParam(':orderid', $id);
        $stmt->execute();
        return $id;
    }

    
    public function getOrderById($id) {
        $sql = "SELECT * FROM Orders WHERE order_id='$id'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetch();
    }

    public function getOrdersByAccountId($id) {
        $sql = "SELECT * FROM Orders WHERE account_id='$id'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function getItemIdFromOrderId($order_id) {
        $sql = "SELECT * FROM ItemOrders WHERE order_id='$order_id'";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetch();
    }
}