<?php

class Reviews extends Controller
{
    public function index() {
        $this->title = 'Review';

        $user = null;
        # Graham L.:
        # If user is logged in, fetch their page.
        # If they aren't redirect to login page.
        if (isset($_SESSION['username'])) {
            $user = $this->model->readUser($_SESSION['id']);
            $listings = $this->model->getItemsByUser($_SESSION['id']);
            # Not implemented yet.
            $orders = null;
            require 'application/views/account/index.php';
        } else {
            header('location: /account/login');
        }
    }

    public function review(){
        $this->title = 'Submit a Review';
        $sellerID = filter_input(INPUT_POST, 'sellerID', FILTER_SANITIZE_STRING);
        $order_id = filter_input(INPUT_POST, 'orderID', FILTER_SANITIZE_STRING);
        $_SESSION['orderID'] = $order_id;
        require 'application/views/items/review.php';

    }
    public function submit_review() {

        $order_id = filter_input(INPUT_POST, 'orderID', FILTER_SANITIZE_STRING);
        $sellerID = filter_input(INPUT_POST, 'sellerID', FILTER_SANITIZE_STRING);
        $title=filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
        $stars=filter_input(INPUT_POST, 'rating', FILTER_SANITIZE_STRING);
        $comment=filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);
        $date=date("Y-m-d H:i:s");
        $reviewerID = $_SESSION['id'];

        //$sellerID = 99; #TODO how to get this
        $this->model->createReview($order_id,$reviewerID,$sellerID,$date,$comment,$stars,$title);
        header('location: /account');
    }
    public function loadModel()
    {
        require 'application/models/Review.php';
        $this->model = new Review($this->db);
        return;
    }
    public function deleteReview($review_id)
    {
        $this->model->deleteReview($review_id);
        header('location: /account');
        return;
    }
}