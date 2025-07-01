<script>
	$("#loading").hide();
	$("#myForm").submit(function()
	{
		$("#info").html("");
		if($("#fileToUpload").val()=="")
		{
			alert('Select an image');
			return false;
		}
		$("#loading").show();
		$("#saveBtn").prop('disabled', true);

		return true;
	});

</script> 
<?php
include_once 'includes/conn.php';
$productPhotoId=0;
if(isset($_GET['eventPhotoId']))
{
	$event_id=$_GET['eventPhotoId'];
}
?>

<div>
	<div class="col-lg-12" style="padding:0px;">
		<div class="card">
			<div class="card-header bg-primary text-white">
				Upload Event Photo
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
				<form name='myForm' id='myForm' action="manage-events.php" method="post" enctype="multipart/form-data">
					<div class="form-row justify-content-lg-center justify-content-md-center">
						<div class="form-group col-lg-12 col-md-12 col-sm-12" >
							<strong><label for="c_name">Select Event Photo</label></strong></br></br>
							<input type="file" name="file" class="form-control-file" id="fileToUpload" />
						</div>
					</div>
					<div class="form-row justify-content-lg-left justify-content-md-left">
						<div class="form-row col-lg-12 col-md-12 col-sm-12 mt-5">
							<input type="hidden" name="eventPhotoId" value="<?=$event_id?>"/>
							<input type="submit" id="saveBtn" class="btn btn-primary" value="Upload" >
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>