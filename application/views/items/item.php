<?php require 'application/views/layouts/header.php';
require 'application/models/User.php';
require 'application/models/Review.php';
$review_model = new Review($this->db);
$reviews = $review_model->getReviewsByUser($item->account_id);
$users = new User($this->db);?>
    <div class="container">
        <div class="row">
            <?php include 'application/views/includes/category-menu.php';?>
            <div class="col-md-9">
                <div class="card">
                    <img src="<?php if(file_exists('uploads/item_'. $item->item_id)) {echo '/uploads/item_'.$item->item_id;} else {echo 'https://placehold.it/800x300';}?>" alt="">
                    <div class="card-block">
                        <h4 style="display:inline-block;"><?php echo $item->item_name?></h4>
                        <h5 class="float-right" style="display:inline-block;">$<?php echo number_format((float)$item->price, 2, '.', ''); ?></h5>
                        <p><?php echo $item->description?></p>
                        <div class="text-left">
                            <form action="/items/purchaseitem" method="POST">
                                <input type="hidden" name="$id" type="Number" value=<?php $item->item_id ?> >
                                <button type="submit" class="btn-ss btn-bw"" name="submit"> Purchase
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="ratings">
                        <p class="float-right"> <?php echo count($reviews)?> review(s) for this seller</p>
                        <p>
                            <?php
                            $user = $users->readUser($item->account_id);
                            if(isset($user->rating)){
                                $avgReview=$user->rating;
                            }
                            else{
                                $avgReview = 0;
                            }
                            for ($i=0; $i<5; $i++) {
                                if ($avgReview - $i >= 0.5)
                                    echo '&#9733; ';
                                else
                                    echo '&#9734; ';
                            }?>
                        </p>
                    </div>
                </div>
                <br>
                <div class="well">
                    <?php include "application/views/items/reviews.php" ?>
                </div>
            </div>
        </div>
    </div>
<?php require 'application/views/layouts/footer.php'; ?>
