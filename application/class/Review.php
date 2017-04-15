<?php

class Review {
    public $reviewer;
    public $rating;
    public $comment;
    public $review_date;
    public $title;

    public function __construct($reviewer, $rating, $comment, $review_date, $title) {
        $this->reviewer = $reviewer;
        $this->rating = $rating;
        $this->comment = $comment;
        $this->review_date = $review_date;
        $this->review_title = $title;

    }
}
