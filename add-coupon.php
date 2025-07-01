<script>
$("#loading").hide();
$("#myForm").submit(function()
{
    $("#info").html("");
    $("#loading").show();
    $("#saveBtn").prop('disabled', true);
    $.ajax({
               url: 'manage-coupons.php',
               type: 'post',
               data: $('#myForm').serialize(),
               success: function(response)
               {
                  $("#loading").hide();
                  $("#info").html(response);
                  $("#saveBtn").prop('disabled', false);
               }
            });
return false;
});
</script>

<?php
include_once 'includes/conn.php';

$coupon_id = 0;
$coupon_code = $discount_type = $discount_amount = $expiration_date = $usage_limit = "";
if(isset($_GET['couponAddId']))
    { 
      $event_id=$_GET['couponAddId'];
    }
if (isset($_GET['couponEditId'])) {
    $coupon_id = $_GET['couponEditId'];
    $sql = "SELECT * FROM coupons WHERE coupon_id='$coupon_id'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows >= 1) {
        $row = mysqli_fetch_array($result);
        $coupon_code = $row['coupon_code'];
        $discount_amount = $row['discount_amount'];
        $expiration_date = $row['expiration_date'];
        $usage_limit = $row['usage_limit'];
    }
}
?>

<div>
    <div class="col-lg-12" style="padding:0px;">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <?= ($coupon_id > 0 ? "Update" : "Add") ?> Coupon Details
            </div>
            <div class="card-body" style="max-width:950px;">
                <div id="info"> </div>
                <div id="loading" style="display:none;" class="card">
                    <div class="card-body">
                        <span> <i class="fas fa-spinner"></i> </span> <strong> Loading </strong>.....Please Wait....
                        <span class="glyphicon glyphicon-time"></span>
                    </div>
                </div>
                <form id="myForm" class="mt-2" method="post" action="">
                    <div class="row">
                        <div class="col-md-6 mb-6 mt-2">
                            <label class="text-dark" for="coupon_code">Coupon Code</label>
                            <input name="coupon_code" type="text" value="<?= $coupon_code ?>" class="form-control border-dark" placeholder="Enter Coupon Code" required>
                        </div>
                        <div class="col-md-6 mb-6 mt-2">
                            <label class="text-dark" for="discount_amount">Discount Amount</label>
                            <input name="discount_amount" type="text" value="<?= $discount_amount ?>" class="form-control border-dark" placeholder="Enter Discount Amount" required>
                        </div>
                        <div class="col-md-6 mb-6 mt-2">
                            <label class="text-dark" for="expiration_date">Expiration Date</label>
                            <input name="expiration_date" type="date" value="<?= $expiration_date ?>" class="form-control border-dark" placeholder="Enter Expiration Date" required>
                        </div>
                        <div class="col-md-6 mb-6 mt-2">
                            <label class="text-dark" for="usage_limit">Usage Limit</label>
                            <input name="usage_limit" type="text" value="<?= $usage_limit ?>" class="form-control border-dark" placeholder="Enter Usage Limit" required>
                        </div>

                        <?php if (isset($_GET['couponEditId'])) : ?>
                            <div class="form-row justify-content-lg-left text-center mt-3">
                                <div class="form-row col-lg-12 mb-2">
                                    <input type="hidden" name="couponEditId" value="<?= $coupon_id ?>" />
                                    <input type="submit" id="saveBtn" class="btn btn-primary" value="Update">
                                </div>
                            </div>
                        <?php else : ?>
                            <div class="form-row justify-content-lg-left text-center mt-3">
                                <div class="form-row col-lg-12 mb-2">
                                    <input type="hidden" name="couponAddId" value="<?= $event_id ?>" />
                                    <input type="submit" id="saveBtn" class="btn btn-primary" value="Save">
                                </div>
                            </div>
                        <?php endif ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
