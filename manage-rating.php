<?php

include_once 'includes/conn.php';


if(isset($_POST["rating_data"]))
{
	$user_id=$_SESSION['SESS_UID']; 
	$event_id=$_POST['event_id'];
	$rating_data=$_POST['rating_data'];
	$feedback=$_POST['feedback'];

	$sql = "INSERT INTO ratings (event_id, user_id, event_rating,feedback) VALUES ('$event_id','$user_id','$rating_data','$feedback') ";

	if($conn->query($sql)===TRUE)
	{
		
		echo "<div class='alert alert-success'> <strong>Success ! </strong>Thanks for rating ...Redirecting...!</div>".
				"<script>setTimeout(function(){ window.location.reload(); }, 2000);</script>";   
    	exit();
		
	}
	else
	{
	echo "<div class='alert alert-danger'> <strong>Error ! </strong> Error in Rating submition.</div>";
			echo("Error description: " .mysqli_error($conn));
			exit();		
	}
	

}
?>
