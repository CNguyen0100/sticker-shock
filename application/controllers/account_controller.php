<?php

class Account extends Controller {
    public function index() {
        $this->title = 'Account';

        $user = null;
        # Graham L.:
        # If user is logged in, fetch their page.
        # If they aren't redirect to login page.
        if (isset($_SESSION['username'])) {

            //get account infomation
            $info = $this->model->readUser($_SESSION['id']);
            $_SESSION['accInfo'] = $info;

            //get list of order
            $orders = $this->model->getOrderFromOrder($_SESSION['id']);
            $_SESSION['orderHis'] = $orders;

            //get list of item that user is selling and sold
            $listings = $this->model->getSaleList($_SESSION['id']);
            $_SESSION['listing'] = $listings;

            require 'application/views/account/index.php';
            unset($_SESSION['orderHis']);
            unset($_SESSION['accInfo']);
            unset($_SESSION['listing']);

        } else {
            #            $this->login();
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
        echo constant('Category::Shirts');
        $arr = Category::getConstants();
        if(isset($_SESSION['username']) && $_SESSION['username'] != '') {
            $this->title = "Sell";
            require 'application/views/account/sell.php';
        } else{
            $_SESSION['login_error'] = 'You must be logged in to complete this action';
            header('location: /account/login?page=account,sell');
        }
    }

    public function loadModel() {
        require 'application/models/User.php';
        $this->model = new User($this->db);
        return;
    }

    public function viewOrder($account_id){
        $this->title = 'View Previous Orders';
//        diplay all order in one page
        $orders = $this->model->getOrderFromOrder($account_id);
        $_SESSION['orderHis'] = $orders;

        require 'application/views/account/vieworder.php';
        unset($_SESSION['orderHis']);
    }
    public function viewListing($user_id){
        $this->title = 'View All Sale';
//        display in one page
        $listing = $this->model->getSaleList($user_id);
        $_SESSION['listing'] = $listing;

        require 'application/views/account/viewListing.php';
    }

    public function writeReview($orderId){


    }
    public function deleteReview($orderId){

    }
    public function printInvoice($orderId){
        if(!$orderId)
            require 'application/views/pages/error.php';
        else {
            $_SESSION['invoice'] = $this->model->getPurchase($orderId);
            require 'application/views/account/printInvoice.php';
            unset($_SESSION['invoice']);
        }
    }
}
