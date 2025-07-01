<?php include_once 'includes/conn.php'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Navigation -->
    <?php include_once 'includes/links.php'; ?>
    <!-- Navigation -->
  </head>
  <body>
    <!-- Navigation -->
    <?php include_once 'includes/nav.php'; ?>
    <!-- Navigation -->
    <!-- Page Content -->
    <?php if (isset($_SESSION['USER_TYPE'])): ?>
    <?php if($_SESSION['USER_TYPE']==0): ?>
    <?php
    // Check if the event ID is provided in the URL
    if (isset($_GET['eventDetailId'])) {
    $event_id = $_GET['eventDetailId'];
    // Define variables to hold event details
    $event_name = $event_dt = $event_time = $event_duration = $event_fee = $event_address = $cat_name = $event_image = '';
    // Retrieve event details from the database
    $sql = "SELECT * FROM events
    LEFT JOIN categories ON categories.cat_id = events.cat_id
    WHERE events.event_id = '$event_id'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows == 1) {
    $row = mysqli_fetch_array($result);
    // Extract event details
    $event_name = $row['event_name'];
    $event_dt = $row['event_dt'];
    $event_time = $row['event_time'];
    $event_duration = $row['event_duration'];
    $event_fee = $row['event_fee'];
    $event_address = $row['event_address'];
    $cat_name = $row['cat_name'];
    $event_image = ($row['event_image'] == "" ? "event.jpg" : $row['event_image']);
    // ... Add more event details here
    } else {
    echo "Event not found.";
    }
    } else {
    echo "Event ID not provided.";
    }
    // Handle Coupon Form Submission
    if (isset($_POST['coupon_code']) && isset($_POST['discount'])) {
    // Validate and process coupon submission here
    $coupon_code = $_POST['coupon_code'];
    $discount = $_POST['discount'];
    
    // Example: Insert coupon into the database
    $sql = "INSERT INTO coupons (event_id, coupon_code, discount_amount) VALUES ('$event_id', '$coupon_code', '$discount')";
    if (mysqli_query($conn, $sql)) {
    echo "<div class='alert alert-success'>Coupon added successfully!</div>";
    } else {
    echo "<div class='alert alert-danger'>Error adding coupon: " . mysqli_error($conn) . "</div>";
    }
    }
    ?>
    <div class="col-lg-12 mt-1">
      <div class="row">
        <div class="col-lg-5">
          <!-- Event Details Section -->
          <div class="card mb-5 border border-secondary">
            <div class="col-lg-12 text-center mt-2" id="heading2">
              <h1><p class="animate__animated animate__fadeInUp">Event Details</p></h1>
              <p class="animate__animated animate__fadeInUp lead"><?= $event_name ?></p>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-6">
                  <!-- Event Photo -->
                  <img src="assets/images/events/<?= $event_image ?>" class="img-fluid" alt="<?= $event_name ?>">
                </div>
                <div class="col-lg-6">
                  <!-- Event Details -->
                  <p><strong>Category:</strong> <?= $cat_name ?></p>
                  <p><strong>Date:</strong> <?= $event_dt ?></p>
                  <p><strong>Time:</strong> <?= $event_time ?></p>
                  <p><strong>Duration:</strong> <?= $event_duration ?></p>
                  <p><strong>Address:</strong> <?= $event_address ?></p>
                  <p><strong>Price:</strong> <?= $event_fee ?> Rs.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-7">
          <!-- Coupon Section -->
          <div class="card mb-5 border border-secondary">
            <div class="card-body">
              <div class="col-lg-12 text-center mt-2">
                <h1><p class="animate__animated animate__fadeInUp" >Coupon Management</p></h1>
                <a data-fancybox data-type="ajax" data-src="add-coupon.php?couponAddId=<?=$row['event_id']?>" class="btn btn-sm btn-secondary mb-2"><i class="fa fa-plus fa-fw"></i>Add Coupon</a>
              </div>
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Coupon Code</th>
                      <th>Discount (%)</th>
                      <th>Expiration Date</th>
                      <th>Remaining Limit</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    // Query and display coupons for this event
                    $coupon_query = "SELECT * FROM coupons WHERE event_id = '$event_id'";
                    $coupon_result = mysqli_query($conn, $coupon_query);
                    
                    ?>
                    <?php $i=0; while ($coupon_row = mysqli_fetch_array( $coupon_result)): ?>
                    <tr>
                      <td><?=$coupon_row['coupon_code']?></td>
                      <td><?=$coupon_row['discount_amount']?></td>
                      <td><?=$coupon_row['expiration_date']?></td>
                      <td><?=$coupon_row['usage_limit']?></td>
                      <td>
                        <a data-fancybox data-type="ajax" data-src="add-coupon.php?couponEditId=<?=$coupon_row['coupon_id']?>" href="javascript:void();" class="btn btn-sm btn-primary fancybox.ajax"><i class="fa fa-edit fa-fw"></i></a>
                        <a href="manage-coupons.php?couponDelId=<?=$coupon_row['coupon_id']?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this Coupon ?');"><i class="fa fa-trash fa-fw"></i></a>
                      </td>
                    </tr>
                    <?php  endwhile; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <?php elseif($_SESSION['USER_TYPE']==1): ?>
   <?php
// Initialize the coupon_msg variable
$coupon_msg = "";
$discount = 0; 

// Check if the event ID is provided in the URL
if (isset($_GET['eventDetailId'])) {
    $event_id = $_GET['eventDetailId'];

    // Define variables to hold event details
    $event_name = $event_dt = $event_time = $event_duration = $event_fee = $event_address = $cat_name = $event_image = '';

    // Retrieve event details from the database
    $sql = "SELECT * FROM events
            LEFT JOIN categories ON categories.cat_id = events.cat_id
            WHERE events.event_id = '$event_id'";

    $result = mysqli_query($conn, $sql);

    if ($result->num_rows == 1) {
        $row = mysqli_fetch_array($result);

        // Extract event details
        $event_name = $row['event_name'];
        $event_dt = $row['event_dt'];
        $event_time = $row['event_time'];
        $event_duration = $row['event_duration'];
        $event_fee = $row['event_fee'];
        $event_address = $row['event_address'];
        $cat_name = $row['cat_name'];
        $event_image = ($row['event_image'] == "" ? "event.jpg" : $row['event_image']);
        $total_price = $event_fee;

        // ... Add more event details here

        // Check if the event date is in the future
        $event_datetime = strtotime($event_dt);
        $current_datetime = strtotime(date('Y-m-d H:i:s'));

        if ($event_datetime > $current_datetime) {
            // Event date is in the future, show the confirm button
            $show_confirm_button = true;
        } else {
            // Event date has passed, do not show the confirm button
            $show_confirm_button = false;
        }
    } else {
        echo "Event not found.";
    }
} else {
    echo "Event ID not provided.";
}

// Handle Coupon Form Submission
if (isset($_POST['coupon_code'])) {
    $coupon_code = $_POST['coupon_code'];
    $check_coupon_query = "SELECT * FROM coupons WHERE event_id = '$event_id' AND coupon_code = '$coupon_code'";
    $check_coupon_result = mysqli_query($conn, $check_coupon_query);

    if ($check_coupon_row = mysqli_fetch_assoc($check_coupon_result)) {
        // Coupon is valid, apply the discount
        $discount = $check_coupon_row['discount_amount'];
        $total_price = $event_fee * (1 - ($discount / 100));

        // Set the coupon redeemed message
        $coupon_msg = "<div class='alert alert-success'>Coupon successfully redeemed!</div>";
    } else {
        // Coupon is invalid or unavailable, keep the default total price
        $coupon_msg = "<div class='alert alert-danger'>Invalid or unavailable coupon code.</div>";
    }
}
if (isset($_POST['confirm_booking'])) {
    $user_id = $_SESSION['SESS_UID'];
    $coupon_code = isset($_POST['coupon_code']) ? $_POST['coupon_code'] : '';

    // Check if the user has already booked this event
    $check_booking_query = "SELECT * FROM bookings WHERE event_id = '$event_id' AND user_id = '$user_id'";
    $check_booking_result = mysqli_query($conn, $check_booking_query);

    if (mysqli_num_rows($check_booking_result) > 0) {
        echo "<div class='alert alert-warning'>You have already booked this event.</div>";
    } else {
        // User has not booked this event, proceed with booking

        // Check if a valid coupon code was provided
        if (!empty($coupon_code)) {
            $check_coupon_query = "SELECT * FROM coupons WHERE event_id = '$event_id' AND coupon_code = '$coupon_code'";
            $check_coupon_result = mysqli_query($conn, $check_coupon_query);

            if ($check_coupon_row = mysqli_fetch_assoc($check_coupon_result)) {
                // Coupon is valid, apply the discount
                $discount = $check_coupon_row['discount_amount'];
            } else {
                // Coupon is invalid or unavailable
                echo "<div class='alert alert-danger'>Invalid or unavailable coupon code.</div>";
            }
        }

        // Calculate the total price after applying the discount
        $total_price = $event_fee - ($event_fee * ($discount / 100));

        // Insert the booking into the bookings table
        $insert_booking_query = "INSERT INTO bookings (event_id, user_id, total_price, discount_amount) VALUES ('$event_id', '$user_id', '$total_price', '$discount')";

        if (mysqli_query($conn, $insert_booking_query)) {
            echo "<div class='alert alert-success'>Booking confirmed! Total Price: $total_price Rs.</div>";
        } else {
            echo "<div class='alert alert-danger'>Error confirming booking: " . mysqli_error($conn) . "</div>";
        }

        if ($discount > 0) {
            // Update the coupon usage limit
            $update_coupon_query = "UPDATE coupons SET usage_limit = usage_limit - 1 WHERE event_id = '$event_id' AND coupon_code = '$coupon_code'";
            mysqli_query($conn, $update_coupon_query);
        }
    }
}
?>

<!-- Rest of your HTML code goes here -->

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Your head content goes here -->
</head>
<body>
    <!-- Your body content goes here -->

    <div class="col-lg-12 mt-1">
        <div class="row">
            <!-- Coupon Section -->
            <div class="col-lg-7">
                <div class="card mb-5 border border-secondary">
                    <div class="card-body">
                        <!-- Top Div for Coupon Check -->
                        <h4>Enter Coupon Code</h4>
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="coupon_code">Coupon Code:</label>
                                <input type="text" class="form-control" name="coupon_code" id="coupon_code" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Check Coupon</button>
                        </form>
                        <!-- Display Coupon Validation Message -->
                        <?php echo $coupon_msg; ?>
                        <!-- Lower Div for Booking Confirmation -->
                        <div id="bookingConfirmation">
                            <h4>Booking Confirmation</h4>
                            <p>Event Fee: <?= $event_fee ?> Rs.</p>
                            <p>Your Bill: <?= $total_price ?> Rs.</p>
                            <?php
                            // Check if the event date has not passed
                            if ($show_confirm_button):
                            ?>
                            <!-- Add more booking details here if needed -->
                            <form action="" method="POST">
                                <!-- Add hidden input field to indicate Confirm Booking -->
                                <input type="hidden" name="confirm_booking" value="1">
                                <button class="btn btn-success" type="submit">Confirm Booking</button>
                            </form>
                            <?php
                            else:
                            ?>
                            <h3>Event has already happened. Booking is closed.</h3>
                            <?php
                            endif;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Event Details Section -->
            <div class="col-lg-5">
                <div class="card mb-5 border border-secondary">
                    <div class="col-lg-12 text-center mt-2" id="heading2">
                        <h1><p class="animate__animated animate__fadeInUp">Event Details</p></h1>
                        <p class="animate__animated animate__fadeInUp lead"><?= $event_name ?></p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <!-- Event Photo -->
                                <img src="assets/images/events/<?= $event_image ?>" class="img-fluid" alt="<?= $event_name ?>">
                            </div>
                            <div class="col-lg-6">
                                <!-- Event Details -->
                                <p><strong>Category:</strong> <?= $cat_name ?></p>
                                <p><strong>Date:</strong> <?= $event_dt ?></p>
                                <p><strong>Time:</strong> <?= $event_time ?></p>
                                <p><strong>Duration:</strong> <?= $event_duration ?></p>
                                <p><strong>Address:</strong> <?= $event_address ?></p>
                                <p><strong>Price:</strong> <?= $event_fee ?> Rs.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Your JavaScript code goes here -->
    <script>
    // Show the lower div when the "Proceed to Booking" button is clicked
    document.getElementById('proceedBtn').addEventListener('click', function () {
        document.getElementById('bookingConfirmation').style.display = 'block';
    });
    </script>
    <?php endif ?>
    <?php elseif (!isset($_SESSION['USER_TYPE'])): ?>
    <div class=" col-lg-12  mt-1">
      <div class="row">
        <div class="col-lg-12">
          <div class="card mb-5  border border-secondary">
            <div class="col-lg-12 text-center mt-2" id="heading2 ">
              <h1><p class="animate__animated animate__fadeInUp" >Events</p></h1>
            </div>
            <div class="bg-light py-3">
              <div class="container">
                <div class="row">
                  <div class="col-6 align-content-between">
                    <div class="container">
                      <form action="events.php" method="get">
                        <input type="text" class="form-control text-danger" name="keyword" placeholder=" Enter event name and hit enter...">
                      </form>
                    </div>
                  </div>
                  <div class="col-5">
                    <div class="container">
                      <form action="" method='get'>
                        <div class="input-group">
                          <select class="form-control border-dark" name="cat_id" id="cat_id" value="<?=$department_id?>">
                            <option value="" >Select Event Category</option>
                            <?php
                            $cat_id=0;
                            $sql="SELECT * FROM categories ";
                            $result = mysqli_query($conn, $sql);
                            ?>
                            <?php while ($r = mysqli_fetch_array( $result)): ?>
                            <option value="<?=$r['cat_id']?>" <?=($r['cat_id']==$cat_id?"selected='selected'":"")?> ><?=$r['cat_name']?>
                            </option>
                            <?php  endwhile; ?>
                          </select>
                          <div class="input-group-append">
                            <button type="submit" id="searchBtn" class="btn btn-success btn-block" >Go</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="card">
                      <div class="card-body">
                        <?php $keyword=0; if(isset($_GET['keyword'])) $keyword=$_GET['keyword']; ?>
                        <?php $cat_id=0; if(isset($_GET['cat_id'])) $cat_id=$_GET['cat_id']; ?>
                        <?php if(isset($_SESSION['MSG'])){echo $_SESSION['MSG']; unset($_SESSION['MSG']);} ?>
                        <div class="col-lg-12 ">
                          <div class="row">
                            <?php
                            if(!isset($_GET['keyword'])){
                            $sql="SELECT * FROM events
                            LEFT  JOIN categories ON categories.cat_id=events.cat_id";
                            if($cat_id>0) $sql.=" WHERE events.cat_id='$cat_id' ";
                            $result = mysqli_query($conn, $sql);
                            }
                            elseif(isset($_GET['keyword'])){
                            $keyword = trim($keyword); // Remove leading/trailing whitespace
                            $keyword = htmlspecialchars($keyword); // Sanitize the keyword
                            $sql="SELECT * FROM events
                            LEFT  JOIN categories ON categories.cat_id=events.cat_id
                            WHERE event_name LIKE '%{$keyword}%' ";
                            $result = mysqli_query($conn, $sql);
                            }
                            ?>
                            <?php $i=0; while ($row = mysqli_fetch_array( $result)): ?>
                            <div class="col-lg-3 mb-1">
                              <div class="card border border-success  mx-1" >
                                <div class="card-body">
                                  <?php=$1++?>
                                  <div class="bg-ligh border border-warning">
                                    <a href="shop-single.php?productDetailsId=<?=$row['event_id']?>"><img class="img-fluid " src="assets/images/events/<?=($row['event_image']==""?"event.jpg":$row['event_image'] )?>" style="width:100%; height:200px;" alt="" ></a>
                                    
                                  </div>
                                  <p class="card-text text-dark pt-2">
                                    <b><center><?=$row['cat_name']?></b></center> &nbsp;<br>
                                    <b> Name : </b> <?=$row['event_name']?>  &nbsp;<br>
                                    <b> Date : </b> <?=$row['event_dt']?>  &nbsp;<br>
                                    <b> Time : </b> <?=$row['event_time']?>  &nbsp;<br>
                                    <b>Duration : </b><?=$row['event_duration']?> &nbsp;<br>
                                    <b>Address : </b><?=$row['event_address']?> &nbsp;<br>
                                    <b> Price : </b><?=$row['event_fee']?> Rs. &nbsp;<br>
                                  </p>
                                </div>
                              </div>
                            </div>
                            <?php  endwhile; ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php endif ?>
      
      <!-- Bootstrap core JavaScript -->
      <script src="assets/jquery/jquery.min.js"></script>
      <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script type="text/javascript" src="assets/fancybox/jquery.fancybox.min.js"></script>
      <script>
      $(document).ready(function() {
      //$('a[class*=fancybox]').fancybox();
      });
      </script>
    </body>
  </html>