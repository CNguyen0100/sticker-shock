<?php require 'application/views/layouts/header.php'; ?>


    <div class="container">
        <div class="h1">Submit a Review<hr></div>
        <form action="/reviews/submit_review" method="POST">
            <input type="hidden" name="orderID" value='<?php
            $oID = $_SESSION['orderID'];
            echo $oID;
            unset($_SESSION['orderID']); ?>' />
            <div class="form-group row">
                <div class="col-md-6">
                    <input required type="text" class="form-control" name="title" placeholder="Title">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <select class="form-control" name="rating">
                        <option value="" disabled selected>Rating</option>
                        <option value="1">1 (Worst)</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5 (Best)</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <textarea placeholder="Description" class="form-control" name="comment" rows="6"></textarea>
                </div>
            </div>

            <input type="hidden" name="sellerID" value='<?php echo $sellerID; ?>' />
            <input type="hidden" name="orderID" value='<?php echo $oID; ?>' />


            <div class="form-group row">
                <div class="col-md-6">
                    <button type="submit" class="btn-ss btn-bw"" name="submit">Submit</button>
                </div>
            </div>


        </form>
    </div>
    </div>
<?php require 'application/views/layouts/footer.php'; ?>