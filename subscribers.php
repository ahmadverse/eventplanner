<?php include_once 'includes/conn.php'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <!-- Links -->
   <?php include_once 'includes/links.php'; ?>
    <!-- Links -->
  </head>
</head>
<body>
  <!-- Navigation -->
 <?php include_once 'includes/nav.php'; ?>
    <!-- Navigation -->

  <!-- Page Content -->
   <div class="container-fluid p-0 h-100">
    <div class="owl-carousel-item position-relative ">
      <div class="container mt-3">
        <div class="container ">
          <div class="row ">
            <div class="col-lg-12">
              <div class="card  border-primary mb-5">
                <div class="col-lg-12 text-center mt-2" id="heading2 ">
                  <h1><p class="animate__animated animate__fadeInUp" >Subscribers</p></h1>
                  <p class="animate__animated animate__fadeInUp" class="lead">(Manage Subscriptions) </p>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="card  border-dark">
                        <div class="card-body">
                          <?php
                          $sql="SELECT * FROM subscribers ";
                          $result = mysqli_query($conn, $sql);
                          ?>
                          <?php if(isset($_SESSION['MSG'])){echo $_SESSION['MSG']; unset($_SESSION['MSG']);} ?>
                          
                          <?php $i=0; while ($row = mysqli_fetch_array( $result)): ?>
                          
                              <?php $to=$row['email']; ?>
                          <?=(++$i)?> &nbsp;
                          <b><?=$row['email']?></b> <br><br>

                          <a class="btn btn-primary" href="mailto:<?php echo $to; ?>?"><i class="fa fa-envelope"></i> Send Email</a>
                             <hr>
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
  </div>
        
         <!-- Bootstrap core JavaScript -->
      
      <!-- Main jQuery -->
      <script src="assets/jquery/jquery.min.js"></script>
      <script src="assets/jquery.easing/jquery.easing.min.js"></script>
      <script src="assets/jquery-sticky/jquery.sticky.js"></script>
      <script type="text/javascript" src="assets/fancybox/jquery.fancybox.min.js"></script>
      <link href="assets/fontawesome/js/all.min.js" rel="stylesheet">
      <!-- Template Javascript -->
      <script src="assets/bootstrap/js/bootstrap.min.js"></script>
      <script src="assets/js/main.js"></script>
      
      </body>
    </html>