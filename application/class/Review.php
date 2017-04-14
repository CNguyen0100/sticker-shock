<?php

class Review {
    public $reviewer;
    public $rating;
    public $comment;
    public $review_date;

    public function __construct($reviewer, $rating, $comment, $review_date) {
        $this->reviewer = $reviewer;
        $this->rating = $rating;
        $this->comment = $comment;
        $this->review_date = $review_date;
    }
}
