<?php
class Review extends Model {

    public function createReview($buyID, $sellID, $reviewDate, $comment, $ratingNum ,$title){
        $stmt = $this->db->prepare("INSERT INTO Reviews (reviewer_id, seller_id, review_date, comment, rating, title) 
        VALUES (:buyID, :sellID, :reviewDate, :commentText, :ratingNum, :titleText)");
        $stmt->bindParam(':buyID', $buyID);
        $stmt->bindParam(':sellID', $sellID);
        $stmt->bindParam(':reviewDate', $reviewDate);
        $stmt->bindParam(':commentText', $comment);
        $stmt->bindParam(':ratingNum', $ratingNum);
        $stmt->bindParam(':titleText', $title);
        $stmt->execute();

    }

    public function readReview(){

    }

    public function updateReview($reviewID, $buyID, $sellID, $reviewDate, $comment, $ratingNum ,$title){
        $stmt = $this->db->prepare("UPDATE Reviews SET reviewer_id=:buyID, seller_id=:sellID, review_date=:reviewDate, 
        comment=:commentText, rating=:ratingNum, title=:titleText WHERE review_id=:reviewID");
        $stmt->bindParam(':buyID', $buyID);
        $stmt->bindParam(':sellID', $sellID);
        $stmt->bindParam(':reviewDate', $reviewDate);
        $stmt->bindParam(':commentText', $comment);
        $stmt->bindParam(':ratingNum', $ratingNum);
        $stmt->bindParam(':titleText', $title);
        $stmt->bindParam(':review_id', $reviewID);
        $stmt->execute();

    }

    public function deleteReview($item_id){
        $stmt = $this->db->prepare("DELETE FROM Items WHERE item_id='$item_id'");
        $stmt->execute();
    }


    public function getReviewsByUser($user_id) {
        $sql = "SELECT * FROM Reviews WHERE seller_id='$user_id'";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

}
