<?php
class User extends Model {
    public $error;

    public function createUser($username, $fname, $lname, $email, $password, $gender, $address1, $address2, $city, $state, $zip){
        $stmt = $this->db->prepare("INSERT INTO Accounts (username, first_name, last_name, email, password, gender, address_1, address_2, city, state, zip) 
          VALUES (:username, :firstname, :lastname, :email, :password, :gender, :address1, :address2, :city, :state, :zip)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':firstname', $fname);
        $stmt->bindParam(':lastname', $lname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindparam(':gender', $gender);
        $stmt->bindparam(':address1', $address1);
        $stmt->bindparam(':address2', $address2);
        $stmt->bindparam(':city', $city);
        $stmt->bindparam(':state', $state);
        $stmt->bindparam(':zip', $zip);
        $stmt->execute();
    }

    public function readUser($id){
        $statement = $this->db->prepare("SELECT * from Accounts where user_id = :userId");
        $statement->bindParam(':userId',$id);
        $statement->execute();
        $result = $statement->fetch();
        return $result;
    }
    public function getPurchase($order_id){
        $statement = $this->db->prepare("SELECT * FROM ItemOrders INNER JOIN Items ON ItemOrders.item_id=Items.item_id INNER JOIN Orders ON Orders.order_id = ItemOrders.order_id where Orders.order_id = :orderid");
        $statement->bindParam(':orderid',$order_id);
        $statement->execute();
        $result = $statement->fetch();
        return $result;
    }

    public function updateUser($id,$fname,$lname,$email,$gender,$address1,$address2,$city,$state,$zip){
        $stmt= $this->db->prepare("UPDATE Accounts SET first_name = :firstname,last_name = :lastname,email = :email,
              gender= :gender,address_1=:address1,address_2=:address2,city=:city,state=:state,zip=:zip WHERE user_id = :userId");
        $stmt->bindParam(':userId',$id);
        $stmt->bindParam(':firstname', $fname);
        $stmt->bindParam(':lastname', $lname);
        $stmt->bindParam(':email', $email);
        $stmt->bindparam(':gender', $gender);
        $stmt->bindparam(':address1', $address1);
        $stmt->bindparam(':address2', $address2);
        $stmt->bindparam(':city', $city);
        $stmt->bindparam(':state', $state);
        $stmt->bindparam(':zip', $zip);
        $stmt->execute();
    }

    public function deleteUser(){

    }

    public function authenticate($username, $password){
        $error = '';
        $statement = $this->db->prepare("SELECT * from Accounts WHERE username = :username");
        $statement->bindParam(':username', $username);
        $statement->execute();
        $result = $statement->fetch();
        if(count($result) > 0 && password_verify($password, $result->password)){
            $_SESSION['username'] = $result->username;
            $_SESSION['id'] = $result->user_id;
            $_SESSION['fname'] = $result->first_name;
        }
        else{
            $error = 'Username and password combination are invalid<br>';
        }
        return $error;
    }

    public function validateRegistration($username, $email) {
        $_SESSION['username_taken_err'] = '';
        $_SESSION['email_taken_err'] = '';
        $username_stmt = $this->db->prepare("SELECT * from Accounts WHERE username = :username");
        $username_stmt->bindParam(':username', $username);
        $username_stmt->execute();
        $username_result = $username_stmt->fetchAll();
        if(count($username_result) > 0){
            $_SESSION['username_taken_err'] = 'Username is taken.';
        }
        $statement = $this->db->prepare("SELECT * from Accounts WHERE email = :email");
        $statement->bindParam(':email', $email);
        $statement->execute();
        $result = $statement->fetchAll();
        if(count($result) > 0){
            $_SESSION['email_taken_err'] = 'An account already exists with this email address.';
        }
    }

    //get all order and item infomation from userid
    public function getOrderFromOrder($id){
        $statement = $this->db->prepare("SELECT * FROM ItemOrders INNER JOIN Items ON ItemOrders.item_id=Items.item_id INNER JOIN Orders ON Orders.order_id = ItemOrders.order_id where Orders.account_id = :id");
        $statement->bindParam(':id',$id);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }

    public function getSaleList($userid){
        $statement = $this->db->prepare("SELECT * FROM Items WHERE account_id = :id");
        $statement->bindParam(':id',$userid);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }

}