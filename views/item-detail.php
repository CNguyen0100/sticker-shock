<?php
include "../models/Item.php";
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
    <link rel="icon" type="image/png" href="../images/logo.png">
    <style>
        .navbar-toggler {
            z-index: 1;
        }

        @media (max-width: 576px) {
            nav > .container {
                width: 100%;
            }
        }
    </style>
</head>

<body>

<?php include "../views/navigation.php";?>
<div class="container">
    <div class="row">
        <?php include 'category-menu.php';?>
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
                <?php include "reviews.php" ?>
            </div>

        </div>
    </div>

</div>



<?php include '../views/footer.php';?>

<script src="../js/jquery.js"></script>
<script src="../js/tether.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

</body>

</html>
