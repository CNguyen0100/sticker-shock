<?php require 'application/views/layouts/header.php'; ?>
    <div class="container">
        <div class="h1">Contact Us<hr></div>
        <form>
            <div class="form-group row">
                <div class="col-md-6">
                    <input required placeholder="Name" class="form-control" type="text" id="name">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <input required placeholder="Email" type="email" class="form-control" id="email">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <select required class="form-control" id="subject">
                        <option value="" disabled selected>Subject</option>
                        <option>General Feedback</option>
                        <option>File A Complaint</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <input placeholder="Order Number" type="number" class="form-control" id="ordernumber">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <textarea required placeholder="Enter your message here." class="form-control" id="message" rows="6"></textarea>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
<?php require 'application/views/layouts/footer.php'; ?>
