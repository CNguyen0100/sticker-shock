<?php

class Account extends Controller { 

    public function index() {
        $this->title = 'Account';
    
        $user = null;
        # If user is logged in, fetch their page.
        # If they aren't redirect to login page.
        if ($user) {
            require 'application/views/layouts/header.php';
            require 'application/views/account/index.php';
            require 'application/views/layouts/footer.php';
        } else {
            $this->login(); 
        }
    } 

    public function login() {
        $this->title = 'Log In';

        require 'application/views/layouts/header.php';
        require 'application/views/account/login.php';
        require 'application/views/layouts/footer.php';
    }

    public function signup() {
        $this->title = 'Sign Up';

        require 'application/views/layouts/header.php';
        require 'application/views/account/signup.php';
        require 'application/views/layouts/footer.php';
    }

    public function loadModel() {
        # load model here
        return;
    }

}
