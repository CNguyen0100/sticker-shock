<?php require 'application/views/layouts/header.php'; ?>
    <div class="container">
        <div class="h1">Log In<hr></div>
        <form action="/account/submit_login" method="POST">
            <div class="form-group row">
                <div class="col-md-6">
                    <input required type="text" class="form-control" name="username" placeholder="Username">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <input required type="password" class="form-control" name="password" placeholder="Password">
                </div>
            </div>

            <p id="passwordHelpBlock" class="form-text text-muted">
                <a href="/account/signup">Don't have an account? Sign up now!</a>
            </p>

            <?php if(isset($_SESSION['login_error']) &&  $_SESSION['login_error'] != ''){
                echo '<p id="error">';
                echo $_SESSION['login_error'];
                echo '</p>';
                $_SESSION['login_error'] = '';
            }?>

            <div class="form-group">
                <button type="submit" class="btn btn-primary" name="submit">Log In</button>
            </div>
        </form>
    </div>
<?php require 'application/views/layouts/footer.php'; ?>