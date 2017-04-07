<?php

class Order extends Model {

    public function createOrder($account_id, $tax, $subtotal, $shipping, $address_1, $city, $state, $zip, $item_id){
        $stmt = $this->db->prepare("INSERT INTO Orders (account_id, status, tax, subtotal, shipping, address_1, city, state, zip) 
          VALUES (:accountid, :status, :tax, :subtotal, :shipping, :address1, :city, :state, :zip)");
        $stmt->bindParam(':accountid', $account_id);
        $stmt->bindvalue(':status', 'purchased');
        $stmt->bindParam(':tax', $tax);
        $stmt->bindParam(':shipping', $shipping);
        $stmt->bindparam(':subtotal', $subtotal);
        $stmt->bindparam(':address1', $address_1);
        $stmt->bindparam(':city', $city);
        $stmt->bindparam(':state', $state);
        $stmt->bindparam(':zip', $zip);
        $id = $this->db->lastInsertId();
        #get today's date
        //$stmt->bindvalue(':completiondate', );


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
}