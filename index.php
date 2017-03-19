<?php
require_once('models/Connection.php');
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
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/shop-homepage.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="images/logo.png">
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

    <?php include "views/navigation.php"?>

    <div class="container" style="margin-top:25px;">
        <div class="row">
            <?php include 'views/category-menu.php';?>
            <div class="col-md-9">
                <div class="row">
                    <?php include 'views/item-cards.php';?>
                </div>
            </div>
        </div>
    </div>

    <?php include 'views/footer.php';?>

    <script src="js/jquery.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
