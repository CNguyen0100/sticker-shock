<?php require 'application/views/layouts/header.php'; ?>
    <div class="container">
        <p>Account view stub.</p>
        <p> Session Info:
        <?php
        if(isset($_SESSION['username'])){
            echo $_SESSION['username'];
            echo '<br>';
            echo $_SESSION['id'];
        }
        ?>
        </p>
        <form action="/account/logout" method="POST">
        <div class="form-group">
            <button type="submit" class="btn btn-primary" name="logout">Log Out</button>
        </div>
        </form>
    </div>
<?php require 'application/views/layouts/footer.php'; ?>

