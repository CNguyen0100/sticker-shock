<?php require 'application/views/layouts/header.php'; ?>
    <div class="container">
        <div class="h1">Log In<hr></div>
        <form>
            <div class="form-group row">
                <div class="col-md-6">
                    <input type="text" class="form-control" id="username" placeholder="Username">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <input type="password" class="form-control" id="password" placeholder="Password">
                </div>
            </div>

            <p id="passwordHelpBlock" class="form-text text-muted">
                <a href="account/signup">Don't have an account? Sign up now!</a>
            </p>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Log In</button>
            </div>
        </form>
    </div>
<?php require 'application/views/layouts/footer.php'; ?>