<script>
  $("#loading").hide();
  $("#myForm").submit(function()
  {
      $("#info").html("");
      $("#loading").show();
      $("#saveBtn").prop('disabled', true);
      $.ajax({
                 url: 'manage-categories.php',
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
  $catEditId=$cat_id=0;
  $cat_name="";
  if(isset($_GET['catEditId']))
  { 
   
    $cat_id=$_GET['catEditId'];
    $sql="SELECT * FROM categories WHERE cat_id='$cat_id'";
    $result = mysqli_query($conn, $sql);
    if($result->num_rows ==1)
    {
      $row = mysqli_fetch_array( $result);
      $cat_name=$row['cat_name'];
    }
  }
?>
   
  <div class="row">
    <div class="col-lg-12" style="padding:0px;">
      <div class="card">
        <div class="card-header bg-primary text-white">
          <?=($catEditId>0?"Update":"Add")?> Category
        </div>
        <div class="card-body" style="min-width:450px;">
          <div class="form-row justify-content-lg-center justify-content-md-center">
            <div class="form-group col-lg-12 col-md-12 col-sm-12" >
              <div id="info"></div>
              <div id="loading" style="display:none;" class="card" >
                <div class="card-body">
                  <span> <i class="fas fa-spinner"></i> </span> <strong> Loading </strong>.....Please Wait.... <span class="glyphicon glyphicon-time"></span>
                </div>
              </div>
            </div>
          </div>
          <form id="myForm" action="" method="">
            <div class="form-row justify-content-lg-left justify-content-md-center">
              <div class="form-group col-lg-12 col-md-12 col-sm-12" >
                <label for="cat_name">Category Name</label>
                <input type="text" class="form-control border-secondary mt-3" name="cat_name" id="cat_name" value="<?=$cat_name?>" placeholder="Enter Category Name">
              </div>
            </div>    
              
            <?php if (isset($_GET['catEditId'])): ?>
              <div class="form-row justify-content-lg-left  text-center mt-3">
                <div class="form-row col-lg-12 mb-2">
                  <input type="hidden" name="catEditId" value="<?=$cat_id?>"/>
                  <input type="submit" id="saveBtn" class="btn btn-primary" value="Update" >
                </div>
              </div> 
              <?php else: ?>
              <div class="form-row justify-content-lg-left text-center mt-3">
                <div class="form-row col-lg-12 mb-2">
                  <input type="hidden" name="catAddId" />
                  <input type="submit" id="saveBtn" class="btn btn-primary" value="Save" >
                </div>
              </div> 
              <?php endif ?> 
          </form>
        </div>
      </div>
    </div>
  </div>

