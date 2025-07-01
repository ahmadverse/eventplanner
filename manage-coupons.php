<?php 
include_once 'includes/conn.php';

// Admin adding coupon

if(isset($_POST['couponAddId']))
{
    $event_id = $_POST['couponAddId'];
    $coupon_code = $_POST['coupon_code'];
    $discount_amount = $_POST['discount_amount'];
    $expiration_date = $_POST['expiration_date'];
    $usage_limit = $_POST['usage_limit'];

    // Add the coupon
    $q = "INSERT INTO coupons (event_id,coupon_code, discount_amount, expiration_date, usage_limit)
          VALUES ('$event_id' ,'$coupon_code', '$discount_amount', '$expiration_date', '$usage_limit')";
    
    if($conn->query($q) === TRUE)
    {
        echo "<div class='alert alert-success'> <strong>Success ! </strong>Coupon Record ADDED Successfully...Redirecting...!</div>".
        "<script>setTimeout(function(){ window.location.reload(); }, 3000);</script>";    
        exit();
    }
    else
    {
        echo "<div class='alert alert-danger'> <strong>Error ! </strong> Error in adding coupon.</div>";
        echo("Error description: " . mysqli_error($conn));
    }
}

// Admin updating coupon

if(isset($_POST['couponEditId']))
{
    $coupon_id = $_POST['couponEditId'];
    $coupon_code = $_POST['coupon_code'];
    $discount_amount = $_POST['discount_amount'];
    $expiration_date = $_POST['expiration_date'];
    $usage_limit = $_POST['usage_limit'];

    // Update the coupon
    $sql = "UPDATE coupons SET
            coupon_code='$coupon_code',
            discount_amount='$discount_amount',
            expiration_date='$expiration_date',
            usage_limit='$usage_limit'
            WHERE coupon_id='$coupon_id'";
    
    if($conn->query($sql) === TRUE)
    {
        echo "<div class='alert alert-success'> <strong>Success ! </strong>Coupon Record UPDATED Successfully...Redirecting...!</div>".
        "<script>setTimeout(function(){ window.location.reload(); }, 3000);</script>";    
        exit();
    }
    else
    {
        echo "<div class='alert alert-danger'> <strong>Error ! </strong> Error in updating coupon.</div>";
        echo("Error description: " . mysqli_error($conn));
    }
}

// Admin deleting coupon

if(isset($_GET['couponDelId']))
{
    $coupon_id = $_GET['couponDelId'];
    
    $sql = "DELETE FROM coupons WHERE coupon_id='$coupon_id'";
    if($conn->query($sql) === TRUE)
    {
        $_SESSION['MSG'] = "<div class='alert alert-success'> <strong>Success ! </strong>Coupon DELETED successfully... Redirecting..</div>";
        header('location:'.$_SERVER['HTTP_REFERER']);
        exit();
    }
    else
    {
        $_SESSION['MSG'] = "<div class='alert alert-danger'> <strong>Error ! </strong> Error in DELETING coupon</div>";
        header('location:'.$_SERVER['HTTP_REFERER']);
        exit();
    }
}

?>
