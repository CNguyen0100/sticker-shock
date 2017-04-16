<?php require 'application/views/layouts/header.php'; ?>
   <div class="container">
        <div class="row">
            <?php include 'application/views/includes/category-menu.php';?>
            <div class="col-md-9">
                <div class="card" style="word-wrap: break-word;">
                    <img src="<?php if(file_exists('uploads/item_'. $item->item_id)) {echo '/uploads/item_'.$item->item_id;} else {echo 'https://placehold.it/800x300';}?>" alt="">
                    <div class="card-block">
                        <h4 style="display:inline-block;"><?php echo $item->item_name?></h4>
                        <h5 class="float-right" style="display:inline-block;">$<?php echo number_format((float)$item->price, 2, '.', ''); ?></h5>
                        <br>
                        <small class="float-right" style="display:inline-block;">+ $<?php echo number_format((float)$item->shipping, 2, '.', '') . ' S&H' ?></small>
                        </small>
                        <p><?php echo $item->description?></p>
                        <div class="text-left">
                            <!-- this is only a form because paypal is picky -->
                            <form action="/items/purchaseitem" method="POST">
                                <input type="hidden" name="item_name" value="<?php echo $item->item_name?>">
                                <input type="hidden" name="price" value="<?php echo $item->price?>">
                                <input type="hidden" name="shipping" value="<?php echo $item->shipping?>">
                                <input type="hidden" name="seller_id" value="<?php echo$item->account_id?>">
                                <input type="hidden" name="item_id" value="<?php echo $item->item_id?>">
                                <button type="submit" class="btn-ss btn-bw" name="submit"> Purchase
                                </button>
                            </form>
                        </div>
                        <br>
                    </div>
                    <div class="card-footer">
                        <big>
                            <small>
                                <a href="/account/profile/<?php echo $user->readUser($item->account_id)->user_id;?>">
                                    <?php echo $user->readUser($item->account_id)->username;?>
                                </a>
                            </small>
                            <div class="float-right">
                                <?php
                                if(isset($user->readUser($item->account_id)->rating)){
                                    $avgReview= $user->readUser($item->account_id)->rating;
                                }
                                else{
                                    $avgReview = 0;
                                }
                                for ($i=0; $i<5; $i++) {
                                    if ($avgReview - $i >= 0.5)
                                        echo '&#9733; ';
                                    else
                                        echo '&#9734; ';
                                }
                                ?>
                            </div>
                        </big>
                    </div>
                </div>
<?php 
    if (sizeof($reviews) > 0) {
        echo'<br>';
        echo '<div class="well">';
        include "application/views/items/reviews.php";
        echo '</div>';
    }

    else{
        echo'<br>';
        echo '<div class="well">';
        echo '<p>This user has no reviews.</p>';
        echo '</div>';
    }
?>
            </div>
        </div>
    </div>
<?php require 'application/views/layouts/footer.php'; ?>
