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

    public function readUser(){

    }

    public function updateUser(){

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
}