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
   <div class="container-fluid p-0 h-100">
    <div class="owl-carousel-item position-relative ">
        <div class="container mt-3">
            <div class="container ">
                <div class="row ">
                    <div class="col-lg-12">
                        <div class="form-group col-lg-12 mt-3 ">
                        <div id="info"> </div>
                        <div id="loading" style="display:none;" class="card">
                          <div class="card-body">
                            <span> <i class="fas fa-spinner"></i> </span> <strong> Loading </strong>.....Please Wait....
                            <span class="glyphicon glyphicon-time"></span>
                          </div>
                        </div>
                      </div>
                      <?php if(isset($_SESSION['MSG'])){echo $_SESSION['MSG']; unset($_SESSION['MSG']);} ?>
                        <div class="card  border-primary p-5 mb-5">
                            <div class="col-lg-12 text-center mt-2" id="heading2 ">
                                <h1><p class="animate__animated animate__fadeInUp">Subscribe to Our Newsletter</p></h1>
                                <p class="animate__animated animate__fadeInUp lead">(Manage Subscription)</p>
                                <!-- Subscription Form -->
                                <center>
                                    <div class="col-8">
                                    <form id="#myForm" action="subscribe_process.php" method="POST" class="mt-4">
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                                    </div>
                                    <button type="submit" name="subscribe" class="btn btn-primary mt-4">Subscribe</button>
                                </form>
                                </div>
                                    
                                </center>
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
$("#loading").hide();
$("#myForm").submit(function()
{
    $("#info").html("");
    $("#loading").show();
    $("#saveBtn").prop('disabled', true);
    $.ajax({
               url: 'subscribe_process.php',
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


 


    <!-- Page Content -->


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
