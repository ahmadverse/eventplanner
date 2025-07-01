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
              <div class="card  border-primary mb-5">
                <div class="col-lg-12 text-center mt-2" id="heading2 ">
                  <h1><p class="animate__animated animate__fadeInUp" >Categories</p></h1>
                  <p class="animate__animated animate__fadeInUp" class="lead">(Manage Categories) </p>
                  <div class="col-lg-12 text-center mt-2">
                    <a data-fancybox data-type="ajax" data-src="add-category.php" class="btn btn btn-success align-items-center" href="javascript:;"><i class="fas fa-feather-alt"></i> Add New Category</a>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="card  border-dark">
                        <div class="card-body">
                          <?php
                          $sql="SELECT * FROM categories ";
                          $result = mysqli_query($conn, $sql);
                          ?>
                          <?php if(isset($_SESSION['MSG'])){echo $_SESSION['MSG']; unset($_SESSION['MSG']);} ?>
                          <table class="table table-sm text-dark table-hover align-middle table-responsive"  id="myTable">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Category Name</th>
                                <th scope="col"> Action </th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $i=0; while ($row = mysqli_fetch_array( $result)): ?>
                              <tr>
                                <td scope="row"><?=(++$i)?></td>
                                <td><?=$row['cat_name']?></td>
                                <td>
                                  <a data-fancybox data-type="ajax" data-src="add-category.php?catEditId=<?=$row['cat_id']?>" href="javascript:void();" class="btn btn-sm btn-primary fancybox.ajax"><i class="fa fa-edit fa-fw"></i></a>
                                  <a href="manage-categories.php?catDelId=<?=$row['cat_id']?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this Category ?');"><i class="fa fa-trash fa-fw"></i></a>
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
