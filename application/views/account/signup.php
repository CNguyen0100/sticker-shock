<?php require 'application/views/layouts/header.php'; ?>
    <div class="container">
        <div class="h1">Sign Up<hr></div>
            <form>
                <div class="form-group row">
                    <div class="col-md-6">
                        <input required type="text" class="form-control" id="firstname" placeholder="First Name">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <input required type="text" class="form-control" id="lastname" placeholder="Last Name">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <input required type="email" class="form-control" id="email" placeholder="Email">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <input required type="text" class="form-control" id="username" placeholder="Username">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <input required type="password" class="form-control" id="password" placeholder="Password">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <select class="form-control" id="gender">
                            <option value="" disabled selected>Gender</option>
                            <option>Female</option>
                            <option>Male</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="address1" placeholder="Address 1">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="address2" placeholder="Address 2">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="city" placeholder="City">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="state" placeholder="State">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="zip" placeholder="Zip">
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
<?php require 'application/views/layouts/footer.php'; ?>