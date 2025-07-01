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
  <div class=" col-lg-12  mt-1">
    <div class="row">
      <div class="col-lg-12">
        <div class="card mb-5  border border-secondary">
          <div class="col-lg-12 text-center mt-2" id="heading2 ">
            <h1><p class="animate__animated animate__fadeInUp" >Events</p></h1>
            <p class="animate__animated animate__fadeInUp" class="lead">( Manage Events ) </p>
          </div>
          <div class="bg-light py-3">
            
          <div class="bg-light py-3">
            <div class="container">
              <div class="row">
                <div class="col-4">
                  <div class="container">
                    <form action="events.php" method="get">
                      <input type="text" class="form-control text-danger" name="keyword" placeholder=" Enter event name and hit enter...">
                    </form>
                  </div>
                </div>
                <div class="col-4">
                  <div class="container">
                    <form action="" method="get">
                      <div class="input-group">
                        <input type="date" name="event_dt" id="event_dt"  class="form-control border-dark"  placeholder="Search By Date" >
                        
                        <div class="input-group-append">
                          <button type="submit" id="searchBtn" class="btn btn-success btn-block" >Go</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="col-4">
                  <div class="container">
                    <form action="" method='get'>
                      <div class="input-group">
                        <select class="form-control border-dark" name="cat_id" id="cat_id" value="<?=$cat_id?>">
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
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-body">
                    <?php $keyword=0; if(isset($_GET['keyword'])) $keyword=$_GET['keyword']; ?><?php $cat_id=0; if(isset($_GET['cat_id'])) $cat_id=$_GET['cat_id']; ?>
                    
                    <?php $event_dt=0; if(isset($_GET['event_dt'])) $event_dt=$_GET['event_dt']; ?>
                    <?php if(isset($_SESSION['MSG'])){echo $_SESSION['MSG']; unset($_SESSION['MSG']);} ?>
                    <div class="col-lg-12 ">
                      <div class="row">
                        <?php
                        if(!isset($_GET['keyword'])){
                        $sql="SELECT * FROM events
                          LEFT  JOIN categories ON categories.cat_id=events.cat_id";
                          if($cat_id>0) $sql.=" WHERE events.cat_id='$cat_id' ";
                          elseif($event_dt>0) $sql.=" WHERE events.event_dt='$event_dt' ";
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
                                <a href="event-details.php?eventDetailId=<?=$row['event_id']?>"><img class="img-fluid " src="assets/images/events/<?=($row['event_image']==""?"event.jpg":$row['event_image'] )?>" style="width:100%; height:200px;" alt="" ></a>
             
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
                              <?php 
                              $event_datetime = strtotime($row['event_dt']);
                              $current_datetime = strtotime(date('Y-m-d H:i:s'));
                              if ($event_datetime > $current_datetime) {
                              // Event date is in the future, show the confirm button
                              $eventDone = false;
                              } else {
                              // Event date has passed, do not show the confirm button
                              $eventDone = true;
                              }
                               ?>
                               <?php if ($eventDone): ?>
                                  <?php
                                   $event_id=$row['event_id'] ;
                                    // Define your table name and column name
                                    $tableName = 'ratings';
                                    $columnName = 'event_rating';
                                    // Build the SQL query to calculate the average
                                    $q = "SELECT AVG($columnName) AS average FROM $tableName WHERE event_id='$event_id'";
                                    $res = mysqli_query($conn, $q);
                                    $r = mysqli_fetch_assoc($res);
                                    $average = round($r['average']);
                                    ?>
                                    <b>Average Rating </b>
                                    <?php if ($average==1): ?>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <?php elseif ($average==2): ?>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <?php elseif ($average==3): ?>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <?php elseif ($average==4): ?>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <?php elseif ($average==5): ?>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <?php endif; ?>

                                  <?php elseif (!$eventDone): ?>
                                 <div class="card-footer text-center border-top border-success">
                                <a data-fancybox data-type="ajax" data-src="add-event.php?eventEditId=<?=$row['event_id']?>" class="btn btn-sm btn-secondary"><i class="fa fa-edit fa-fw"></i></a>
                                <a href="manage-events.php?eventDelId=<?=$row['event_id']?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this Event?');"><i class="fa fa-trash fa-fw"></i></a>
                                <a data-fancybox data-type="ajax" data-src="event-photo-upload.php?eventPhotoId=<?=$row['event_id']?>" href="javascript:void();" class="btn btn-sm btn-success"><i class="fa fa-upload fa-fw"></i></a>
                                <a href="event-details.php?eventDetailId=<?=$row['event_id']?>" class="btn btn-sm btn-secondary"><i class="fa fa-eye fa-fw"></i> View Details</a>
                              </div>
                                 <?php endif; ?>
                              
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
           
<?php elseif($_SESSION['USER_TYPE']==1): ?>
   <?php $allEventId=0; if(isset($_GET['allEventId'])) $allEventId=$_GET['allEventId']; ?>
<?php $intrestedeEentId=0; if(isset($_GET['intrestedeEentId'])) $intrestedeEentId=$_GET['intrestedeEentId']; ?>
<?php $bookedEentId=0; if(isset($_GET['bookedEentId'])) $bookedEentId=$_GET['bookedEentId']; ?>
  <div class=" col-lg-12  mt-1">
    <div class=" col-lg-12 d-block ">
  <ul class="nav nav-tabs flex-row justify-content-center">
  <?php if (isset($_SESSION['USER_TYPE'])): ?> 
      <?php if ($_SESSION['USER_TYPE']==1): ?>
        <?php
        if($allEventId==0 && $intrestedeEentId==0 && $bookedEentId==0){
          $active = 'active text-success fw-bold fs-5';
        }
        elseif($intrestedeEentId==1){
          $sctive = 'active text-success fw-bold fs-5';
        }
        elseif($bookedEentId==1){
          $ractive = 'active text-success fw-bold fs-5';
        }
        ?>
        <li class="nav-item">
          <a class="nav-link <?php echo $active; ?>  px-5 mx-5"  href="events.php">All Events</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo $sctive; ?>  px-5 mx-5"  href="events.php?intrestedeEentId=1">Intrested Events</a>
        </li>
        <li class="nav-item">
          <a class="nav-link  <?php echo $ractive; ?> mx-5  px-5" href="events.php?bookedEentId=1"> Booked Events</a>
        </li>
      <?php endif ?>
    <?php endif ?>
</ul>
</div>
    <div class="row">
      <div class="col-lg-12">
        <div class="card mb-5  border border-secondary">
          <div class="col-lg-12 text-center mt-2" id="heading2 ">
            <h1><p class="animate__animated animate__fadeInUp" >Events</p></h1>
          </div>
          <div class="bg-light py-3">
            <div class="container">
              <div class="row">
                <div class="col-4">
                  <div class="container">
                    <form action="events.php" method="get">
                      <input type="text" class="form-control text-danger" name="keyword" placeholder=" Enter event name and hit enter...">
                    </form>
                  </div>
                </div>
                <div class="col-4">
                  <div class="container">
                    <form action="" method="get">
                      <div class="input-group">
                        <input type="date" name="event_dt" id="event_dt"  class="form-control border-dark"  placeholder="Search By Date" >
                        
                        <div class="input-group-append">
                          <button type="submit" id="searchBtn" class="btn btn-success btn-block" >Go</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="col-4">
                  <div class="container">
                    <form action="" method='get'>
                      <div class="input-group">
                        <select class="form-control border-dark" name="cat_id" id="cat_id" value="<?=$cat_id?>">
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
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-body">
                    <?php $keyword=0; if(isset($_GET['keyword'])) $keyword=$_GET['keyword']; ?>
                    <?php $event_dt=0; if(isset($_GET['event_dt'])) $event_dt=$_GET['event_dt']; ?>
                    <?php $cat_id=0; if(isset($_GET['cat_id'])) $cat_id=$_GET['cat_id']; ?>
                    <?php if(isset($_SESSION['MSG'])){echo $_SESSION['MSG']; unset($_SESSION['MSG']);} ?>
                    <div class="col-lg-12 ">
                      <div class="row">
                        <?php
                        $user_id=$_SESSION['SESS_UID'];
                        if(!isset($_GET['keyword'])){
                        $sql="SELECT * FROM events
                        LEFT  JOIN categories ON categories.cat_id=events.cat_id";
                          if($cat_id>0) $sql.=" WHERE events.cat_id='$cat_id' ";
                          elseif($event_dt>0) $sql.=" WHERE events.event_dt='$event_dt' ";
                           if($intrestedeEentId>0) { 
                              $sql.=" 
                          LEFT JOIN intrested_events ON intrested_events.event_id=events.event_id 
                               WHERE intrested_events.user_id='$user_id' ORDER BY event_dt desc
                               ";
                           }
                            elseif($bookedEentId>0){
                                $sql.="  
                              LEFT JOIN bookings ON bookings.event_id=events.event_id
                               WHERE bookings.user_id='$user_id' ORDER BY event_dt desc
                               ";
                            }

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
                          <?php
                          $event_id=$row['event_id'];
                          $q = "SELECT * FROM intrested_events WHERE user_id = $user_id AND event_id = $event_id";
                          $res = mysqli_query($conn, $q);
                          $isProductInWishlist = false;
                          if ($res && mysqli_num_rows($res) > 0) {
                          $isProductInWishlist = true;
                          }
                          ?>
                          <?php if ($bookedEentId>0): ?>
                            <div class="col-lg-3 mb-1">
                          <div class="card border border-success  mx-1" >
                            <div class="card-body">
                              <?php=$i++?>
                                <div style="position: relative;">
                                  <img class="img-fluid" src="assets/images/events/<?= ($row['event_image'] == "" ? "event.jpg" : $row['event_image']) ?>" style="width:100%; height:200px;" alt="">
                                </div>
                              </a>
                              <p class="card-text text-dark pt-2">

                                <b><center><?=$row['cat_name']?></b></center> &nbsp;<br>
                                <b> Name : </b> <?=$row['event_name']?>  &nbsp;<br>
                                <b> Date : </b> <?=$row['event_dt']?>  &nbsp;<br>
                                <b> Time : </b> <?=$row['event_time']?>  &nbsp;<br>
                                <b>Duration : </b><?=$row['event_duration']?> &nbsp;<br>
                                <b>Address : </b><?=$row['event_address']?> &nbsp;<br>
                                <b>Total Bill : </b><?=$row['event_fee']?> Rs. &nbsp;<br>
                              </p>
                              <?php 
                              $event_datetime = strtotime($row['event_dt']);
                              $current_datetime = strtotime(date('Y-m-d H:i:s'));
                              if ($event_datetime > $current_datetime) {
                              // Event date is in the future, show the confirm button
                              $eventDone = false;
                              } else {
                              // Event date has passed, do not show the confirm button
                              $eventDone = true;
                              }
                               ?>
                              <?php
                                  $event_id=$row['event_id'] ;
                                  $user_id=$_SESSION['SESS_UID']; 
                                  $q = "SELECT * FROM ratings WHERE user_id = $user_id AND event_id = $event_id";
                                $res = mysqli_query($conn, $q);
                                $ratingDone = false;
                                if ($res && mysqli_num_rows($res) > 0) {
                                $ratingDone = true;
                                }
                              ?>
                              <div class="card-footer text-center border-top border-success">
                              <?php if ($eventDone): ?>
                                <?php if ($ratingDone): ?>
                                  <?php
                                    $query="SELECT * FROM users
                                    LEFT JOIN ratings ON ratings.user_id=users.user_id 
                                    LEFT JOIN events ON events.event_id=ratings.event_id 
                                    WHERE ratings.event_id='$event_id' ";
                                    $output = mysqli_query($conn, $query);
                                    $data = mysqli_fetch_array( $output);
                                  ?>
                                  <?php if ($data["event_rating"]==1): ?>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                  <?php elseif ($data["event_rating"]==2): ?>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                  <?php elseif ($data["event_rating"]==3): ?>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                  <?php elseif ($data["event_rating"]==4): ?>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                  <?php elseif ($data["event_rating"]==5): ?>
                                    <i class="fa fa-star text-warning star-light mr-1"></i>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    
                                <?php endif; ?>
                                  <?php elseif (!$ratingDone): ?>
                                 <a data-fancybox data-type="ajax" data-src="add-rating.php?ratingId=<?=$row['event_id']?>" href="javascript:void();" class="btn btn-sm btn-warning fancybox.ajax"> Give Rating </a>
                                 <?php endif; ?>
                                <?php elseif (!$eventDone): ?>
                                  Event Yet to Happen
                                <?php endif; ?>
                               
                              </div>
                            </div>
                          </div>
                        </div>
                          <?php elseif (!$bookedEentId>0): ?>
                            <div class="col-lg-3 mb-1">
                          <div class="card border border-success  mx-1" >
                            <div class="card-body">
                              <?php=$i++?>
                                <div style="position: relative;">
                                  <img class="img-fluid" src="assets/images/events/<?= ($row['event_image'] == "" ? "event.jpg" : $row['event_image']) ?>" style="width:100%; height:100px;" alt="">
                                  <?php if ($isProductInWishlist) { ?>
                                  <a href="add-to-intrested.php?intrestedRemoveId=<?=$row['event_id']?>" style="position: absolute; top: 10px; right: 10px; z-index: 1;" class="wishlist-btn filled"><i class="fa-solid fa-heart text-danger" style="font-size: 24px;"></i><span></span>
                                  <?php } else { ?>
                                  <a href="add-to-intrested.php?intrestedAddId=<?=$row['event_id']?>" style="position: absolute; top: 10px; right: 10px; z-index: 1;" class="wishlist-btn"><i class="fa-regular fa-heart" style="font-size: 24px;"></i><span></span></a>
                                  <?php } ?>
                                </div>
                              </a>
                              <p class="card-text text-dark pt-2">

                                <b><center><?=$row['cat_name']?></b></center> &nbsp;<br>
                                <b> Name : </b> <?=$row['event_name']?>  &nbsp;<br>
                                <b> Date : </b> <?=$row['event_dt']?>  &nbsp;<br>
                                <b> Time : </b> <?=$row['event_time']?>  &nbsp;<br>
                                <b>Duration : </b><?=$row['event_duration']?> &nbsp;<br>
                                <b>Address : </b><?=$row['event_address']?> &nbsp;<br>
                                <b> Price : </b><?=$row['event_fee']?> Rs. &nbsp;<br>
                              </p>
                              <?php 
                              $event_datetime = strtotime($row['event_dt']);
                              $current_datetime = strtotime(date('Y-m-d H:i:s'));
                              if ($event_datetime > $current_datetime) {
                              // Event date is in the future, show the confirm button
                              $show_confirm_button = true;
                              } else {
                              // Event date has passed, do not show the confirm button
                              $show_confirm_button = false;
                              }
                               ?>
                              
                              <?php if($_SESSION['USER_TYPE']==1): ?>
                              <div class="card-footer text-center border-top border-success">
                                <?php if ($show_confirm_button): ?>
                                  <a data-fancybox data-type="ajax" data-src="add-booking.php?bookingAddId=<?=$row['event_id']?>" class="btn btn-lg btn-success align-items-center" href="javascript:;"><i class="fas fa-feather-alt"></i> Book Now</a>
                                <?php else: ?>
                                  <p class="text-danger">Booking closed/Expired.</p>
                                   <?php
                                   $event_id=$row['event_id'] ;
                                    // Define your table name and column name
                                    $tableName = 'ratings';
                                    $columnName = 'event_rating';
                                    // Build the SQL query to calculate the average
                                    $q = "SELECT AVG($columnName) AS average FROM $tableName WHERE event_id='$event_id'";
                                    $res = mysqli_query($conn, $q);
                                    $r = mysqli_fetch_assoc($res);
                                    $average = round($r['average']);
                                    ?>
                                    <?php if ($average==1): ?>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <?php elseif ($average==2): ?>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <?php elseif ($average==3): ?>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <?php elseif ($average==4): ?>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <?php elseif ($average==5): ?>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <i class="fa fa-star text-warning mr-1"></i>
                                    <?php endif; ?>

                                <?php endif; ?>
                
                              </div>
                              <?php endif ?>
                            </div>
                          </div>
                        </div>
                          <?php endif ?>
                        
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
                <div class="col-4">
                  <div class="container">
                    <form action="events.php" method="get">
                      <input type="text" class="form-control text-danger" name="keyword" placeholder=" Enter event name and hit enter...">
                    </form>
                  </div>
                </div>
                <div class="col-4">
                  <div class="container">
                    <form action="" method="get">
                      <div class="input-group">
                        <input type="date" name="event_dt" id="event_dt"  class="form-control border-dark"  placeholder="Search By Date" >
                        
                        <div class="input-group-append">
                          <button type="submit" id="searchBtn" class="btn btn-success btn-block" >Go</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="col-4">
                  <div class="container">
                    <form action="" method='get'>
                      <div class="input-group">
                        <select class="form-control border-dark" name="cat_id" id="cat_id" value="<?=$cat_id?>">
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
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-body">
                    <?php $keyword=0; if(isset($_GET['keyword'])) $keyword=$_GET['keyword']; ?><?php $event_dt=0; if(isset($_GET['event_dt'])) $event_dt=$_GET['event_dt']; ?>
                    <?php $cat_id=0; if(isset($_GET['cat_id'])) $cat_id=$_GET['cat_id']; ?>
                    <?php if(isset($_SESSION['MSG'])){echo $_SESSION['MSG']; unset($_SESSION['MSG']);} ?>
                    <div class="col-lg-12 ">
                      <div class="row">
                        <?php
                        if(!isset($_GET['keyword'])){
                        $sql="SELECT * FROM events
                          LEFT  JOIN categories ON categories.cat_id=events.cat_id";
                          if($cat_id>0) $sql.=" WHERE events.cat_id='$cat_id' ";
                          elseif($event_dt>0) $sql.=" WHERE events.event_dt='$event_dt' ";
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
                              <?php 
                              $event_datetime = strtotime($row['event_dt']);
                              $current_datetime = strtotime(date('Y-m-d H:i:s'));
                              if ($event_datetime > $current_datetime) {
                              // Event date is in the future, show the confirm button
                              $show_confirm_button = true;
                              } else {
                              // Event date has passed, do not show the confirm button
                              $show_confirm_button = false;
                              }
                               ?>
                              
                              
                              <div class="card-footer text-center border-top border-success">
                                <?php if ($show_confirm_button): ?>
                                 
                                  <a href="login.php" class="btn btn-sm btn-danger" onclick="return confirm('You need to login for booking process ?');"><i class="fas fa-feather-alt"></i> Book Now </a>
                                <?php else: ?>
                                  <h5 class="text-danger">Booking closed/Expired.</h5>
                                <?php endif; ?>
                
                              </div>
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
