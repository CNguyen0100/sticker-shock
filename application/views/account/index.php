<?php require 'application/views/layouts/header.php'; ?>
    <div class="container">
        <p>Account view stub.</p>
        <p> Session Info:
        <?php
        if(isset($_SESSION['username'])){
            echo $_SESSION['username'];
        }
        ?>
        </p>
    </div>
<?php require 'application/views/layouts/footer.php'; ?>

