<?php
class Review extends Model {

    public function createReview($order_id,$buyID, $sellID, $reviewDate, $comment, $ratingNum ,$title){
        $stmt = $this->db->prepare("INSERT INTO Reviews (reviewer_id, seller_id, review_date, comment, rating, title) 
        VALUES (:buyID, :sellID, :reviewDate, :commentText, :ratingNum, :titleText)");
        $stmt->bindParam(':buyID', $buyID);
        $stmt->bindParam(':sellID', $sellID);
        $stmt->bindParam(':reviewDate', $reviewDate);
        $stmt->bindParam(':commentText', $comment);
        $stmt->bindParam(':ratingNum', $ratingNum);
        $stmt->bindParam(':titleText', $title);
        $stmt->execute();
//    update AccountOrderReview
        $getReviewID = "SELECT review_id FROM Reviews WHERE reviewer_id = '$buyID' AND seller_id ='$sellID' AND title = '$title'";
        $stmt=$this->db->prepare($getReviewID);
        $stmt->execute();

        //Assume that alway has 1 result
        $result = $stmt->fetch();
        $reviewID = $result->review_id;
        //assume account_id is userid;
        $stmt2 ="INSERT INTO AccountOrderReview(review_id, order_id, account_id) VALUES ('$reviewID', '$order_id', '$buyID')";
        $stmt=$this->db->prepare($stmt2);
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

    public function deleteReview($reviewId){
        $stmt = $this->db->prepare("DELETE FROM Reviews WHERE review_id='$reviewId'");
        $stmt->bindParam(':reviewid', $reviewId);
        $stmt->execute();
        echo '<p>'.$this->db->errorInfo() .'</p>';
    }

    //get all review for one seller,
    public function getReviewsByUser($user_id) {
        $sql = "SELECT * FROM Reviews WHERE seller_id='$user_id'";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    //connect 2 tables ,accountorderreview table and review table , get all information of that specific order review
    public function getReviewForAnOrder($user_id,$order_id){
        $stmt = $this->db->prepare("SELECT review_id FROM  AccountOrderReview WHERE order_id = :orderId AND account_id =:userId");
        $stmt->bindParam(':userId',$user_id);
        $stmt->bindParam(':orderId',$order_id);
        $stmt->execute();
        return $stmt->fetch();
    }
}
