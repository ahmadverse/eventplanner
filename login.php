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
        <img  src="assets/img/2.jpg"  style="width:100%; height:640px;"  alt="">
        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex " style="background: rgba(0, 0, 0, .2);">
          <div class="container mt-3">
            <div class="col-lg-12 d-flex justify-content-around py-5 px-5">
              <div class="section-heading">
                <h2 class="text-primary mt-5">Login</h2>
                <div>
                  <h4 class="text-white">Enter your login Id and password to login </h4>
                </div>
                <div class="row ">
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
                      <form id="myForm" action="account-controller.php" method="post">
                        <div class="row">
                          <div class="col-lg-10">
                            <fieldset>
                              <label class="text-white"  for="login_id">Login ID</label>
                              <input type="text" class="form-control border-dark" name="login_id" id="login_id" placeholder="Enter Your User Name" required="">
                            </fieldset>
                          </div>
                          <div class="col-lg-10 mt-3">
                            <fieldset>
                              <label class="text-white" for="pw">Password</label>
                              <input type="password" name="pw" id="pw" placeholder="Enter Your Password" class="form-control border-dark" required="">
                            </fieldset>
                          </div>
                          <div class="col-lg-10 mt-3 text-center">
                            <fieldset>
                              <input type="hidden" name="login" value="1" />
                              <button class="btn btn-success mt-4" type="submit" id="saveBtn" name="login" value="Login">Login
                              </button>
                              <input type="reset" class="btn btn-danger mt-4 pl-5 " />
                            </fieldset>
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