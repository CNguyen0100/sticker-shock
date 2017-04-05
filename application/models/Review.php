<?php
class Review extends Model {

    public function createReview(){

    }

    public function readReview(){

    }

    public function updateReview(){
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
