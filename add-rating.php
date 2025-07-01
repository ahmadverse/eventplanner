
<script>
$("#loading").hide();
$("#myForm").submit(function()
{
    $("#info").html("");
    $("#loading").show();
    $("#saveBtn").prop('disabled', true);
    $.ajax({
               url: 'manage-rating.php',
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

var rating_data = 0;
    $(document).on('mouseenter', '.submit_star', function(){
        var rating = $(this).data('rating');
        $("#rating_data").val(rating); 
        reset_background();
        for(var count = 1; count <= rating; count++)
        {
            $('#submit_star_'+count).addClass('text-warning');
        }
    });

    function reset_background()
    {
        for(var count = 1; count <= 5; count++)
        {
            $('#submit_star_'+count).addClass('star-light');
            $('#submit_star_'+count).removeClass('text-warning');
        }
    }
</script>




  <?php
    include_once 'includes/conn.php';
    $user_id=$_SESSION['SESS_UID'];
    
    $feedback='';
      if(isset($_GET['ratingId']))
      {
        $event_id=$_GET['ratingId']; 
         $sql="SELECT * FROM bookings
      WHERE event_id='$event_id' AND user_id = '$user_id'  ";
      $result = mysqli_query($conn, $sql);
      if($result->num_rows >=1)
      {
        $row = mysqli_fetch_array( $result);

        
      }
    }
  ?>
  <div class="col-lg-6" style="padding:0px; max-width:550px;">
    <div class="card">
      <div class="card-header bg-primary text-center text-white">
          Rate Service
      </div>
      <div class="card-body" style="">
        <div id="info"> </div>
          <div id="loading" style="display:none;" class="card">
            <div class="card-body">
              <span> <i class="fas fa-spinner"></i> </span> <strong> Loading </strong>.....Please Wait....
              <span class="glyphicon glyphicon-time"></span>
            </div>
          </div>
          <form id="myForm" action="" method="">
            <div class="form-row justify-content-lg-left justify-content-md-center"> 
              <div class="form-group col-lg-12 " >
                <h4 class="text-center mt-4 mb-4">
                  <?php if (isset($_GET['ratingId'])): ?>
                    <i class="fa fa-star star-light submit_star mr-1" id="submit_star_1" data-rating="1"></i>
                    <i class="fa fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                    <i class="fa fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                    <i class="fa fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                    <i class="fa fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
                  <?php endif; ?>
                </h4>
                <input type="hidden" name="event_id" value="<?=$event_id?>" class="form-control border-dark" placeholder="" >
                <div class="col-md-12 mb-6">
                  <label class="text-dark"  for="feedback">Feedback</label>
                  <textarea class="form-control"  name="feedback" id="feedback" rows="5" required='required'></textarea>
                </div>
              </div>
            </div>
            <?php if (isset($_GET['ratingId'])): ?>
              <div class="form-row justify-content-lg-left justify-content-md-center">
                <div class="form-row col-lg-12 d-flex justify-content-center">
                  <input type="hidden" id="rating_data" name="rating_data">
                  <input type="submit" id="saveBtn" class="btn btn-primary m-3" value="Save" >
                </div>
              </div> 
            <?php endif; ?> 
          </form>
        </div>
      </div>
    </div>
  </div>

                
        

