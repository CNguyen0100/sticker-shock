<?php

class Account extends Controller { 

    public function index() {
        $this->title = 'Account';
    
        $user = null;
        # If user is logged in, fetch their page.
        # If they aren't redirect to login page.
        if ($user) {
            require 'application/views/account/index.php';
        } else {
            $this->login();
        }
    } 

    public function login() {
        $this->title = 'Log In';

        require 'application/views/account/login.php';
    }

    public function signup() {
        $this->title = 'Sign Up';

        require 'application/views/account/signup.php';
    }

    public function loadModel() {
        # load model here
        return;
    }

}
