<?php
class User extends Model {

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

    public function readUser(){

    }

    public function updateUser(){

    }

    public function deleteUser(){

    }
}