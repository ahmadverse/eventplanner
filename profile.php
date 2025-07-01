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
    <div class="container mt-5">
      <div class="container ">
        <div class="row ">
          <div class="col-lg-12">
            <div class="card  border-primary mb-5">
              <div class="col-lg-12 text-center mt-2" id="heading2 ">
                <h1><p class="animate__animated animate__fadeInUp" >My Profile</p></h1>
                <p class="animate__animated animate__fadeInUp" class="lead">(Manage Profile Info) </p>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="card  border-dark">
                      <div class="card-body">
                        <?php
                        $user_id=$_SESSION['SESS_UID'];
                        $sql="SELECT * FROM users WHERE user_id='$user_id' ";
                        $result = mysqli_query($conn, $sql);
                        ?>
                        <?php if(isset($_SESSION['MSG'])){echo $_SESSION['MSG']; unset($_SESSION['MSG']);} ?>
                        <table class="table table-sm text-center text-dark table-hover align-middle table-responsive"  id="myTable">
                          <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Name</th>
                              <th scope="col">Login ID</th>
                              <th scope="col">Email</th>
                              <th scope="col">contact</th>
                              <th scope="col">Address</th>
                              <th scope="col"> Action </th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $i=0; while ($row = mysqli_fetch_array( $result)): ?>
                            <tr>
                              <td scope="row"><?=(++$i)?></td>
                              <td><?=$row['name']?></td>
                              <td><?=$row['login_id']?></td>
                              <td><?=$row['email']?></td>
                              <td><?=$row['contact']?></td>
                              <td><?=$row['address']?></td>
                              <td>
                                <a data-fancybox data-type="ajax" data-src="edit-profile.php?userEditId=<?=$row['user_id']?>" href="javascript:void();" class="btn btn-sm btn-primary fancybox.ajax"><i class="fa fa-edit fa-fw"></i></a>
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
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

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
