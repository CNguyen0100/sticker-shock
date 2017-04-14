<?php require 'application/views/layouts/header.php';
require 'application/models/Item.php';
$orders = $_SESSION['orderHis'];
$listings =$_SESSION['listing'];
/*require 'application/models/Order.php';
$order = new Order($this->db);
$orders = $order->getOrdersByAccountId($user->user_id);*/

?>

    <div class="container">
        <div class="row">
            <!-- This contain wellcome on the left and infomation on right-->
            <!-- 1st col .. welcome-->
            <div class="col-md-3">
                <div class = "text-left">
                <p>
                <div class="h2"  >
                    <?php
                        echo 'Welcome back, '. $_SESSION['fname'] .'!';
                        echo '<br>';
                    }
                    else{
                        echo "Your Account";
                    }
                    ?>
                </div>

                </p>
                <form action="/account/logout" method="POST">
                    <div class="form-group">
                        <button type="submit" class="btn-ss btn-bw" name="logout">
                        	Log Out
                        </button>
                    </div>
                </form>
                </div>
            </div>
            <br>
            <!-- 2nd column. all information-->
            <div class="col-md-9">
                <!-- 1st section information-->
                <div class="h2">Account Information</div>
                <hr>
                <div class="well">
                    <!--each row has 2 cols-->
                    <div class="row">
                        <div class="col-4"> <h7> Name: </h7><br> </div>
                        <div class="col-8"> <h7><?= $_SESSION['accInfo']->first_name;?> <?= $_SESSION['accInfo']->last_name;?></h7><br></div>
                    </div>
                    <div class="row">
                        <div class="col-4"> <h7> Email:</h7><br> </div>
                        <div class="col-8"> <h7><?= $_SESSION['accInfo']->email;?></h7><br></div>
                    </div>
                    <div class="row">
                        <div class="col-4"> <h7> Gender:</h7><br></div>
                        <div class="col-8">
                                <h7><?php
                                    if($_SESSION['accInfo']->gender == 'M')
                                        echo "Male";
                                    else
                                        echo "Female";
                                    ?></h7><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4"> <h7> Address 1:</h7><br> </div>
                        <div class="col-8">  <h7><?= $_SESSION['accInfo']->address_1;?></h7><br> </div>
                    </div>
                    <div class="row">
                        <div class="col-4"> <h7> Address 2:</h7><br> </div>
                        <div class="col-8">  <h7> <?= $_SESSION['accInfo']->address_2; ?></h7><br> </div>
                    </div>
                    <div class="row">
                        <div class="col-4"> <h7> City:</h7><br> </div>
                        <div class="col-8">  <h7><?= $_SESSION['accInfo']->city;?></h7><br> </div>
                    </div>
                    <div class="row">
                        <div class="col-4"> <h7> State:</h7><br> </div>
                        <div class="col-8"> <h7><?= $_SESSION['accInfo']->state;?></h7><br>  </div>
                    </div>
                    <div class="row">
                        <div class="col-4"> <h7> Zip:</h7><br> </div>
                        <div class="col-8">  <h7><?= $_SESSION['accInfo']->zip;?></h7><br> </div>
                    </div>


                    <!--in the same col need row of button-->
                    <div class="row">
                        <div class="col-md-9"> </div>
                        <div class="col-md-3">
                            <div class="text-right">
                                <a href="/account/edit">Edit</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 2nd order history -->
                <div class="row">
                    <div class="col-lg-10"><div class="h2">Your Listing</div></div>
                    <div class="col-lg-2">
                        <div class="text-right">
                            <h6><a href="/account/viewListing/<?=$_SESSION['id']?>">All List</a></h6>
                        </div>
                    </div>
                </div>
                <hr>
                <?php if(count($listings) > 0) {
                    $count = 0;
                    foreach($listings as $item) {if($count >=3) break;$count++;?>

                <div class="well">

                    <div class="media row">
                        <div class="media-left col-lg-5">
                            <img src="<?php if(file_exists('uploads/item_'.$item->item_id)) {echo '/uploads/item_'.$item->item_id;} else echo 'https://placehold.it/700x400';?>" class="media-object" style="width:300px">
                        </div>
                        <div class="media-body col-lg-5">
                            <h4 class="media-heading"><?php echo $item->item_name?></h4>
                            <p><?php echo $item->description?></p>
                        </div>
                        <div class="media-right col-lg-2">
                            <form action="/items/edititem/<?php echo $item->item_id?>" method="POST">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-secondary btn-block" name="edititem">Edit</button>
                                </div>
                            </form>
                            <form action="/items/deleteitem/<?php echo $item->item_id?>" method="POST">
                                <div class="form-group">
                                    <button <?php if($item->available != true){echo 'style="visibility:hidden;"';};?> type="submit" class="btn btn-danger btn-block" name="deleteitem">Delete</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            <?php }} else {echo '<hr><p>You have no listings! <a href="/pages/sell">Create a listing here.</a>';}?>

            <br>
            <div class="row">
                <div class="col-lg-10"><div class="h2">Your Orders</div></div>
                <div class="col-lg-2">
                    <div class="text-right">
                        <h6><a href="/account/vieworder/<?=$_SESSION['id']?>">All Order</a></h6>
                    </div>
                </div>
              

            </div>
                <hr>
            <?php if(count($orders) > 0) {
                    $max = 3;
                    if(count($orders)<3)
                        $max = count($orders);

                    for($i =0; $i<$max;$i++){?>
                <div class="well">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="text-center">
                                <h7>
                                    <b>Order Id<br></b>
                                    <?=$orders[$i]->order_id ?>
                                </h7>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center">
                                <h7>
                                    <b>Total<br></b>
    <!--                             I don't tax is percentage or actual tax, so fix it if it is percentage-->
                                <?php $total = $orders[$i]->subtotal+$orders[$i]->tax+ $orders[$i]->shipping;
                                    echo $total;?>
                                </h7>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center">
                                <h7>
                                    <b>Ship to<br></b>
                                    <?=$orders[$i]->address_1 ?>
                                </h7>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center">
                                <h7>
                                    <b>Date<br></b>
                                    <?=$orders[$i]->completion_date ?>
                                </h7>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="media">
                                <img class="d-flex mr-5"
                                     src="https://placehold.it/700x400" alt="Generic placeholder image" style="width:300px">
                                <div class="media-body">
                                    <h4 class="media-heading"><?php echo $orders[$i]->item_name?></h4>
                                    <p><?php echo $orders[$i]->description;?></p>
                                </div>
                            </div>
                        </div>
    <!--                    collumn of button-->
                        <div class="col-lg-3">
                            <div class="btn-group-vertical" >
                                <form action="/account/printInvoice/<?php echo $orders[$i]->order_id?>" method="POST">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-secondary btn-block"  name="printInvoice" style="width: 150px" >View Invoice</button>
                                    </div>
                                </form>
                                <form action="/account/writeReview/<?php echo $orders[$i]->order_id ?>" method="POST">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-secondary btn-block"  name="writeReview" style="width: 150px" >Review</button>
                                    </div>
                                </form>
                                <form action="/account/deleteReview/<?php echo $orders[$i]->order_id ?>" method="POST">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-secondary btn-block"  name="deleteReview" style="width: 150px" >Delete Review</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }} else {echo '<hr><p>You have no orders! <a href="/pages/index">Browse items here.</a>';}?>

            </div>
        </div>
    </div>
<?php require 'application/views/layouts/footer.php'; ?>

