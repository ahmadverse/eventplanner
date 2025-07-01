<?php
include_once 'includes/conn.php';


//  add new product

if(isset($_POST['bookingAddId']))
{
	$event_id=$_POST['bookingAddId'];
	$user_id=$_SESSION['SESS_UID'];
	$coupon_code=$_POST['coupon'];
	$event_fee=$_POST['event_fee'];
	
	$check_coupon_query = "SELECT * FROM coupons 
	LEFT JOIN events ON events.event_id=coupons.event_id 
	WHERE coupons.event_id = '$event_id' AND coupons.coupon_code = '$coupon_code'";
	$check_coupon_result = mysqli_query($conn, $check_coupon_query);

	if (mysqli_num_rows($check_coupon_result) === 0) {

    $check_booking_query = "SELECT * FROM bookings WHERE event_id = '$event_id' AND user_id='$user_id'";
    $check_booking_result = mysqli_query($conn, $check_booking_query);
        
    if (mysqli_num_rows($check_booking_result) > 0) {
      echo "<div class='alert alert-warning'>You have already booked this event.</div>";
    } 
    else
    {
		$sql = "INSERT INTO bookings (event_id, user_id, total_price, discount_amount, total_bill) VALUES ('$event_id', '$user_id', '$event_fee', '0', '$event_fee')";
      if (mysqli_query($conn, $sql)) {
       
        echo "<div class='alert alert-danger'>Coupon Invalid / Not Entered " . mysqli_error($conn) . "</div>";
        echo "<div class='alert alert-success'> <strong>Success ! </strong> Booking confirmed! Your bill without discount is: $event_fee Rs....Redirecting...!</div>"."<script>setTimeout(function(){ window.location.reload(); }, 3000);</script>";    
    		exit();
      } 
      else {
        echo "<div class='alert alert-danger'>Error confirming booking: " . mysqli_error($conn) . "</div>";
      }
    }




	} 
	else {
    $check_coupon_row = mysqli_fetch_assoc($check_coupon_result);
		if ($check_coupon_row['usage_limit']<=0)
		{
			echo "<div class='alert alert-warning'><strong>Error ... Limit Exceed .. </strong> Coupon not valid anymore.</div>";
			exit();
		}
		// Coupon is valid, apply the discount
		$discount = $check_coupon_row['discount_amount'];
		$event_fee = $check_coupon_row['event_fee'];
		$discount_amount = $event_fee * ($discount / 100);

		// Calculate the total bill after applying the discount
		$total_bill = $event_fee - $discount_amount;
    // Check if the user has already booked this event
    $check_booking_query = "SELECT * FROM bookings WHERE event_id = '$event_id' AND user_id='$user_id'";
    $check_booking_result = mysqli_query($conn, $check_booking_query);
        
    if (mysqli_num_rows($check_booking_result) > 0) {
      echo "<div class='alert alert-warning'>You have already booked this event.</div>";
    } 
    else
    {
		$sql = "INSERT INTO bookings (event_id, user_id, total_price, discount_amount, total_bill) VALUES ('$event_id', '$user_id', '$event_fee', '$discount_amount', '$total_bill')";
      if (mysqli_query($conn, $sql)) {
        // Update the coupon usage limit
        $update_coupon_query = "UPDATE coupons SET usage_limit = usage_limit - 1 WHERE event_id= '$event_id' ";
        mysqli_query($conn, $update_coupon_query);
        echo "<div class='alert alert-success'> <strong>Success ! </strong> Booking confirmed! Your bill after discount is: $total_bill Rs....Redirecting...!</div>"."<script>setTimeout(function(){ window.location.reload(); }, 3000);</script>";    
    		exit();
      } 
      else {
        echo "<div class='alert alert-danger'>Error confirming booking: " . mysqli_error($conn) . "</div>";
      }
    }
	}
}
		
	

	


// delete booking by user

if(isset($_GET['bookingDelId']))
{
  $booking_id=$_GET['bookingDelId'];

  $sql="DELETE FROM bookings WHERE booking_id='$booking_id'";
  if($conn->query($sql)===TRUE)
  {
    $_SESSION['MSG']= "<div class='alert alert-success'> <strong>Success ! </strong> Booking Record DELETED successfuly... Redirecting..</div><script>setTimeout(function(){ window.location.reload(); }, 1000);</script>";
    header('location:'.$_SERVER['HTTP_REFERER']);exit();
  }
  else
  {
    $_SESSION['MSG']= "<div class='alert alert-danger'> <strong>Error ! </strong> Error in DELETING record</div>";
    header('location:'.$_SERVER['HTTP_REFERER']);exit();
  }
}


	//maid approve booking

if(isset($_GET['bookingAcceptId']))
{
	$booking_id=$_GET['bookingAcceptId'];
	$sql="UPDATE bookings SET  booking_status='1' WHERE booking_id='$booking_id'";
	if($conn->query($sql)===TRUE)
	{
    $_SESSION['MSG']= "<div class='alert alert-success'> <strong>Success ! </strong> Booking APPROVED successfully...Redirecting...!</div><script>setTimeout(function(){ window.location.reload(); }, 1000);</script>";
    header('location:'.$_SERVER['HTTP_REFERER']);exit();
	}
	else
	{
		$_SESSION['MSG']= "<div class='alert alert-danger'> <strong>Error ! </strong> Error in DELETING record</div>";
    header('location:'.$_SERVER['HTTP_REFERER']);exit();
	}
}



?>
