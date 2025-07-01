<script>
$("#loading").hide();
$("#myForm").submit(function()
{
    $("#info").html("");
    $("#loading").show();
    $("#saveBtn").prop('disabled', true);
    $.ajax({
               url: 'manage-events.php',
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

  $event_id=0;
  $event_name=$event_dt=$event_time=$event_duration=$event_fee=$event_address="";
    if(isset($_GET['eventEditId']))
    { 
      $event_id=$_GET['eventEditId'];
      $sql="SELECT * FROM events
        LEFT  JOIN categories ON categories.cat_id=events.cat_id
      WHERE events.event_id='$event_id' ";
      $result = mysqli_query($conn, $sql);
      if($result->num_rows >=1)
      {
        $row = mysqli_fetch_array( $result);
        $event_name=$row['event_name'];
        $event_dt=$row['event_dt'];
        $event_time=$row['event_time'];
        $event_duration=$row['event_duration'];
        $event_fee=$row['event_fee'];
        $event_address=$row['event_address'];
      }
    }
?>
   
  <div>
    <div class="col-lg-12" style="padding:0px;">
      <div class="card">
        <div class="card-header bg-primary text-white">
          <?=($event_id>0?"Update":"Add")?> Event Details
        </div>
        <div class="card-body" style="max-width:950px;">
          <div id="info"> </div>
          <div id="loading" style="display:none;" class="card">
            <div class="card-body">
              <span> <i class="fas fa-spinner"></i> </span> <strong> Loading </strong>.....Please Wait....
              <span class="glyphicon glyphicon-time"></span>
            </div>
          </div>
          <form id="myForm" class="mt-2" method="" action="">
            <div class="row">
             
              <div class="col-md-6 mb-6 mt-2">
                <label class="text-dark"  for="cat_id">Event Category</label>
                <select class="form-control border-dark" name="cat_id" id="cat_id" value="<?=$department_id?>" required>
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
              </div>
              
              <div class="col-md-6 mb-6 mt-2">
                <label class="text-dark"  for="event_name">Event Name</label>
                <input name="event_name" type="text" value="<?=$event_name?>" class="form-control border-dark" placeholder="Enter Event Name" required>
              </div>
             <div class="col-md-6 mb-6 mt-2">
                <label class="text-dark"  for="event_dt">Event Date</label>
                <input name="event_dt" type="date" value="<?=$event_dt?>" class="form-control border-dark" placeholder="Enter Event Date" required>
              </div>
              <div class="col-md-6 mb-6 mt-2">
                <label class="text-dark"  for="event_time">Event Time</label>
                <input name="event_time" type="time" value="<?=$event_time?>" class="form-control border-dark" placeholder="Enter Event Time" required>
              </div>
              <div class="col-md-6 mb-6 mt-2">
                <label class="text-dark"  for="event_duration">Event Duration</label>
                <input name="event_duration" type="text" value="<?=$event_duration?>" class="form-control border-dark" placeholder="Enter Event Duration" required>
              </div>
              <div class="col-md-6 mb-6 mt-2">
                <label class="text-dark"  for="event_fee">Event Fee</label>
                <input name="event_fee" type="text" value="<?=$event_fee?>" class="form-control border-dark" placeholder="Enter Event Fee" required>
              </div>
              
              <div class="col-md-12 mb-6 mt-2">
                <label class="text-dark"  for="event_address">Event Address</label>
                <input name="event_address" type="text" value="<?=$event_address?>" class="form-control border-dark" placeholder="Enter Event Address/Location" required>
              </div>

              <?php if (isset($_GET['eventEditId'])): ?>
              <div class="form-row justify-content-lg-left  text-center mt-3">
                <div class="form-row col-lg-12 mb-2">
                  <input type="hidden" name="eventEditId" value="<?=$event_id?>"/>
                  <input type="submit" id="saveBtn" class="btn btn-primary" value="Update" >
                </div>
              </div> 
              <?php else: ?>
              <div class="form-row justify-content-lg-left text-center mt-3">
                <div class="form-row col-lg-12 mb-2">
                  <input type="hidden" name="eventAddId"/>
                  <input type="submit" id="saveBtn" class="btn btn-primary" value="Save" >
                </div>
              </div> 
              <?php endif ?>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  