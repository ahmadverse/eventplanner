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
    <!-- Navigation -->
   
  <!-- Page Content -->
  <div class="container-fluid p-0 bg-white h-auto ">
    <div class="owl-carousel-item position-relative">
      <img  src="assets/img/2.jpg"  style="width:100%; height:650px;"  alt="">
      <div class="position-absolute top-0 start-0 w-100 h-100 d-flex " style="background: rgba(0, 0, 0, .2);">
        <div class="container mt-3">
          <div class="col-lg-12 d-flex justify-content-around py-2 px-5">
            <div class="section-heading">
              <center>
              <h2 class="text-primary mt-2">Register</h2>
              <div>
                <h4 class="text-white mb-2">( Sign Up )</h4>
              </div></center>
              <div class="row ">
                <div class="form-row justify-content-lg-center justify-content-md-center">
                  <div class="form-group col-lg-12 mt-3 ">
                    <div id="info"> </div>
                    <div id="loading" style="display:none;" class="card">
                      <div class="card-body">
                        <span> <i class="fas fa-spinner"></i> </span> <strong> Loading </strong>.....Please Wait....
                        <span class="glyphicon glyphicon-time"></span>
                      </div>
                    </div>
                  </div>
                  <form id="myForm" class="php-email-form mt-2" method="" action="">
                    <div class="row">

                      <div class="col-md-6 mb-3">
                        <div class="form-group">
                          <label class="text-white"  for="name">Name</label>
                          <input type="text" name="name" class="form-control border-dark" placeholder="Your Name" required>
                        </div>
                      </div>
                      <div class="col-md-6 mb-3">
                        <div class="form-group">
                          <label class="text-white"  for="login_id">Login ID</label>
                          <input name="login_id" type="text" class="form-control border-dark" placeholder="Your Login Id" required/>
                        </div>
                      </div>
                      <div class="col-md-6 mb-3">
                        <div class="form-group">
                          <label class="text-white"  for="Email">Password</label>
                          <input type="Password" name="pw" class="form-control border-dark" placeholder="Your Password" required>
                        </div>
                      </div>
                      <div class="col-md-6 mb-3">
                        <div class="form-group">
                          <label class="text-white"  for="Email">Email</label>
                          <input type="email" name="email" class="form-control border-dark" placeholder="Your Email" required>
                        </div>
                      </div>
                      <div class="col-md-6 mb-3">
                        <div class="form-group">
                          <label class="text-white"  for="contact">Phone No</label>
                          <input name="contact" type="number" class="form-control border-dark" placeholder="Your Contact" required>
                        </div>
                      </div>
                      <div class="col-md-6 mb-3">
                        <div class="form-group">
                          <label class="text-white"  for="address">Address</label>
                          <input type="text" name="address" class="form-control border-dark" placeholder=" Your Address" required>
                        </div>
                      </div>
                      <div class="col-md-12 text-center">
                        <input type="hidden" name="register" value="1" />
                        <input class="btn btn-success m-2  mb-5" type="submit" id="saveBtn" name="register" value="Register">
                        <input type="reset" class="btn btn-danger m-2 mb-5" value="Reset">
                      </div>
                    </div>
                  </form>
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
  <script>
  $(function(){
  $("#myForm").submit(function()
  {
  $('html, body').animate({ scrollTop: 0 }, 'slow');
  $("#info").html("");
  $("#loading").show();
  $("#saveBtn").prop('disabled', true);
  $.ajax({
  url: 'account-controller.php',
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
  });
  </script>
</body>
</html>