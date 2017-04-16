<?php

class Account extends Controller {
    public function index() {
        $this->title = 'Account';

        $user = null;
        # Graham L.:
        # If user is logged in, fetch their page.
        # If they aren't redirect to login page.
        if (isset($_SESSION['username'])) {
            require 'application/models/Item.php';

            $user = $this->model->readUser($_SESSION['id']);
            $orders = $this->model->getOrderFromUser($_SESSION['id']);
            $listings = $this->model->getSaleList($_SESSION['id']);
            $items = new Item($this->db);
            require 'application/models/Review.php';
            require 'application/views/account/index.php';
        } else {
            header('location: /account/login');
        }
    } 

    public function login() {
        if (isset($_GET['page'])) {
            $url = trim($_GET['page'], ',');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode(',',$url); 
        }
        $this->title = 'Log In';
        require 'application/views/account/login.php';
    }

    public function submit_login(){
        $_SESSION['login_error'] = '';
        $username=filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password=filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $error = $this->model->authenticate($username, $password);
        if(isset($_SESSION['username'])){
            if (isset($_POST['url'])) {
                header('location: ' . $_POST['url']);
            } else {
                header('location: /account');
            }
        }
        else{
            $_SESSION['login_error'] = $error;
            $this->login();
        }

    }

    public function signup() {
        $this->title = 'Sign Up';
        require 'application/views/account/signup.php';
    }

    public function edit(){
        $this->title = 'Edit Account Information';
        $user = $this->model->readUser($_SESSION['id']);
        require 'application/views/account/edit.php';

    }
    public function submit_edit(){

        $fname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
        $lname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING);
        $address1 = filter_input(INPUT_POST, 'address1', FILTER_SANITIZE_STRING);
        $address2 = filter_input(INPUT_POST, 'address2', FILTER_SANITIZE_STRING);
        $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
        $state = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_STRING);
        $zip = filter_input(INPUT_POST, 'zip', FILTER_SANITIZE_STRING);
        $this->model->updateUser($_SESSION['id'],$fname,$lname,$email,$gender,$address1,$address2,$city,$state,$zip);
        $this->index();
    }

    public function submit_signup() {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $fname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
        $lname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $hashpass = password_hash($password, PASSWORD_DEFAULT);
        $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING);
        $address1 = filter_input(INPUT_POST, 'address1', FILTER_SANITIZE_STRING);
        $address2 = filter_input(INPUT_POST, 'address2', FILTER_SANITIZE_STRING);
        $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
        $state = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_STRING);
        $zip = filter_input(INPUT_POST, 'zip', FILTER_SANITIZE_STRING);
        $this->model->validateRegistration($username, $email);
        if((isset($_SESSION['username_taken_err']) && $_SESSION['username_taken_err'] != '') || (isset($_SESSION['email_taken_err']) && $_SESSION['email_taken_err'] != '') ) {
            $this->signup();
        }
        else {
            $this->model->createUser($username, $fname, $lname, $email, $hashpass, $gender, $address1, $address2, $city, $state, $zip);
            $this->login();
        }
    }

    public function logout(){
        session_destroy();
        header('location: /');
    }

    public function sell(){
        $arr = Category::getConstants();
        $arr2 = Subcategory::getConstants();
        if(isset($_SESSION['username']) && $_SESSION['username'] != '') {
            $this->title = "Sell";
            require 'application/views/account/sell.php';
        } else{
            $_SESSION['login_error'] = 'You must be logged in to complete this action';
            header('location: /account/login?page=account,sell');
        }
    }

    public function profile($user_id) {
        require 'application/models/Review.php';
        require 'application/models/Order.php';
        $users = $this->model;
        $user = $this->model->readUser($user_id);
        $listings = $this->model->getItemsByUser($user_id);
        $review = new Review($this->db);
        $reviews = $review->getReviewsByUser($user->user_id);
        $this->title = $user->username . '\'s Profile';
        require 'application/views/account/profile.php';

    }


    public function writeReview($orderId){


    }
    public function deleteReview($reviewId){
        require 'application/models/Review.php';
        $review = new Review($this->db);
        $review->deleteReview($reviewId);
        header('location: /account/');

    }

    public function invoice($orderId){
        if(!$orderId)
            require 'application/views/pages/error.php';
        else {
            $invoice = $this->model->getPurchase($orderId);
            require 'application/views/account/invoice.php';
        }
    }

    public function loadModel() {
        require 'application/models/User.php';
        $this->model = new User($this->db);
        return;
    }
}