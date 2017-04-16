<?php require 'application/views/layouts/header.php'; ?>
    <div class="container">
        <div class="h1">Log In<hr></div>
        <form action="/account/submit_login" method="POST">
            <?php if (isset($url)) {
                echo '<input type="hidden" name="url" value="';
                foreach ($url as $value) {
                    echo '/' . $value;
                }            
                echo '" />';
            } ?>
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
                <button type="submit" class="btn-ss btn-bw" name="submit">Log In</button>
            </div>
        </form>
    </div>
<?php require 'application/views/layouts/footer.php'; ?>
