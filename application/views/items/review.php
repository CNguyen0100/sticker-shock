<?php require 'application/views/layouts/header.php'; ?>


    <div class="container">
        <div class="h1">Submit a Review<hr></div>
        <form action="/reviews/submit_review" method="POST">
            <div class="form-group row">
                <div class="col-md-6">
                    <select class="form-control" name="rating">
                        <option value="" disabled selected>Select Stars to give</option>
                        <option value="1">1 Terrible</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5 Great</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <input required type="text" class="form-control" name="title" placeholder="Title">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <textarea rows="3" cols="50" name="comment" placeholder="Description"></textarea>
                </div>
            </div>

            <input type="hidden" name="sellerID" value='<?php echo $sellerID; ?>' />


            <div class="form-group">
                <button type="submit" class="btn-ss btn-bw"" name="submit">Submit</button>
            </div>


        </form>
    </div>
    </div>
<?php require 'application/views/layouts/footer.php'; ?>