<script>
$("#loading").hide();
$("#myForm").submit(function()
{
    $("#info").html("");
    $("#loading").show();
    $("#saveBtn").prop('disabled', true);
    $.ajax({
               url: 'manage-bookings.php',
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

  $product_id=$bookingAddId=$booking_start=$booking_end=0;
  $coupon="";


    if(isset($_GET['bookingAddId']))
    {
      $event_id=$_GET['bookingAddId'];
      $sql = "SELECT * FROM events
    LEFT JOIN categories ON categories.cat_id = events.cat_id
    WHERE events.event_id = '$event_id'";
     $result = mysqli_query($conn, $sql);
      if($result->num_rows >=1)
      {
        $row = mysqli_fetch_array( $result);

        $event_name = $row['event_name'];
    $event_dt = $row['event_dt'];
    $event_time = $row['event_time'];
    $event_duration = $row['event_duration'];
    $event_fee = $row['event_fee'];
    $event_address = $row['event_address'];
    $cat_name = $row['cat_name'];
      }
    }
    elseif(isset($_GET['bookingEditId']))
    {
      $booking_id=$_GET['bookingEditId'];
       $sql="SELECT * FROM bookings
      WHERE booking_id='$booking_id' ";
      $result = mysqli_query($conn, $sql);
      if($result->num_rows >=1)
      {
        $row = mysqli_fetch_array( $result);

        $booking_start=$row['booking_start'];
        $booking_end=$row['booking_end'];
      }
    }
?>

  <div>
    <div class="col-lg-12" style="padding:0px;">
      <div class="card">
        <div class="card-header bg-primary text-white">
           Add Booking
        </div>
        <div class="card-body" style="min-width:650px;">
          <div id="info"> </div>
          <div id="loading" style="display:none;" class="card">
            <div class="card-body">
              <span> <i class="fas fa-spinner"></i> </span> <strong> Loading </strong>.....Please Wait....
              <span class="glyphicon glyphicon-time"></span>
            </div>
          </div>
          <p><strong>Category:</strong> <?= $cat_name ?></p>
                  <p><strong>Date:</strong> <?= $event_dt ?></p>
                  <p><strong>Time:</strong> <?= $event_time ?></p>
                  <p><strong>Duration:</strong> <?= $event_duration ?></p>
                  <p><strong>Address:</strong> <?= $event_address ?></p>
                  <p><strong>Price:</strong> <?= $event_fee ?> Rs.</p>
          <form id="myForm" class="mt-2" method="" action>
            <div class="card-body ">
              <div class="row">
                <div class="col-md-12">
                  <input type="hidden" name="event_fee" value="<?=$event_fee?>" class="form-control border-dark" placeholder="" required>
                <div class="col-md-12 mb-6">
                  <label class="text-dark"  for="coupon">Redeem Coupon</label>
                  <input type="text" name="coupon" value="<?=$coupon?>" class="form-control border-dark" placeholder="Enter Coupon" >
                </div>
               
                <div class="form-row justify-content-lg-left text-center mt-3">
                  <div class="form-row col-lg-12 mb-2">
                    <input type="hidden" name="bookingAddId" value="<?=$event_id?>" />
                    <input type="submit" id="saveBtn" class="btn btn-primary" value="Confirm Booking" >
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
