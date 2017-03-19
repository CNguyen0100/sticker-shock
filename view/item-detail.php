<?php
include "../model/Item.php";
if(isset($_GET['id'])) {
    $item_id = $_GET['id'];
    $item = Item::getItemById($item_id);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Sticker Shock</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/shop-item.css" rel="stylesheet">
</head>

<body>

<?php include "../view/navigation.php";?>

<div class="container" style="margin-top: 1rem;">

    <div class="row">

        <?php include 'category-menu.php'; ?>

        <div class="col-md-9">

            <div class="thumbnail">
                <img class="img-responsive" src="http://placehold.it/800x300" alt="">
                <div class="caption-full">
                    <h4><?php echo $item->title?></h4>
                    <h5 class="pull-right">$<?php echo $item->price?></h5>
                    <p><?php echo $item->description?></p>
                </div>

                <div class="ratings">
                    <p class="pull-right">3 reviews</p>
                    <p>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star-empty"></span>
                        4.0 stars
                    </p>
                </div>
            </div>

            <div class="well">

                <div class="text-right">
                    <a class="btn btn-success">Leave a Review</a>
                </div>

                <hr>

                <?php include "review.php"?>
            </div>

        </div>

    </div>

</div>


<?php include '../view/footer.php';?>

<script src="../js/jquery.js"></script>
<script src="../js/tether.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

</body>

</html>
