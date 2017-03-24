<div class="container" style="margin-top: 25px;">
    <div class="row">
        <?php include './views/includes/category-menu.php';?>
        <div class="col-md-9">
            <div class="card">
                <img class="img-responsive" src="http://placehold.it/800x300" alt="">
                <div class="card-block">
                    <h4 style="display:inline-block;"><?php echo $item->item_name?></h4>
                    <h5 class="float-right" style="display:inline-block;">$<?php echo $item->price?></h5>
                    <p><?php echo $item->description?></p>
                    <div class="text-left">
                        <a class="btn btn-success">Purchase</a>
                    </div>
                </div>
                <div class="ratings">
                    <p class="float-right">3 reviews for this seller</p>
                    <p>
                        &#9733; &#9733; &#9733; &#9733; &#9734;
                        4.0 stars
                    </p>
                </div>
            </div>
            <br>
            <div class="well">
                <?php include "./views/items/reviews.php" ?>
            </div>

        </div>
    </div>

</div>
