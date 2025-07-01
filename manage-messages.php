<?php 
include_once 'includes/conn.php';
if(isset($_POST['sendmessage']))
{

	$name=$_POST['name'];
	$email=$_POST['email'];
	$message=$_POST['message'];


		// inserting

		$sql="INSERT INTO messages (name,email,message) VALUES ('$name','$email','$message') ";
			if($conn->query($sql)===TRUE)
			{
				
			$_SESSION['MSG']= "<div class='alert alert-success'> <strong>Success ! </strong> Message Sent Successfully... Redirecting..</div><script>setTimeout(function(){ window.location.reload(); }, 3000);</script>";
		header('location:'.$_SERVER['HTTP_REFERER']);exit();	
		
			}
			else
			{
			echo "<div class='alert alert-danger'> <strong>Error ! </strong> Error in inserting record.</div>";
		 	echo("Error description: " .mysqli_error($conn));
			}

}


?>