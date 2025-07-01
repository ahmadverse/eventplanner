<?php 
include_once 'includes/conn.php';

// admin adding tile

if(isset($_POST['eventAddId']))
{
	$cat_id=$_POST['cat_id'];
	$event_name=$_POST['event_name'];
	$event_dt=$_POST['event_dt'];
	$event_time=$_POST['event_time'];
	$event_duration=$_POST['event_duration'];
	$event_fee=$_POST['event_fee'];
	$event_address=$_POST['event_address'];

	
	// adding

		$q="INSERT INTO events (cat_id,event_name,event_dt,event_time,event_duration,event_fee,event_address) VALUES ('$cat_id','$event_name','$event_dt','$event_time','$event_duration','$event_fee','$event_address')  ";
		if($conn->query($q)===TRUE)
		{
		echo "<div class='alert alert-success'> <strong>Success ! </strong>Event Record ADDED Successfully...Redirecting...!</div>".
    	"<script>setTimeout(function(){ window.location.reload(); }, 3000);</script>";    
    	exit();
	}
	else
	{
	echo "<div class='alert alert-danger'> <strong>Error ! </strong> Error in updating record.</div>";
    echo("Error description: " .mysqli_error($conn));
	}
}


// profile info edit 

if(isset($_POST['eventEditId']))
{
	$event_id=$_POST['eventEditId'];
	$cat_id=$_POST['cat_id'];
	$event_name=$_POST['event_name'];
	$event_dt=$_POST['event_dt'];
	$event_time=$_POST['event_time'];
	$event_duration=$_POST['event_duration'];
	$event_fee=$_POST['event_fee'];
	$event_address=$_POST['event_address'];


	  if ($cat_id==0)
    {
      echo "<div class='alert alert-warning'><strong>Error ! </strong> Select Event Category.</div>";
      exit();
    } 
	// updating
		$sql="UPDATE events SET cat_id='$cat_id',event_name='$event_name', event_dt='$event_dt', event_time='$event_time', event_duration='$event_duration',  event_fee='$event_fee' ,  event_address='$event_address' WHERE event_id='$event_id' ";
		if($conn->query($sql)===TRUE)
		{
		echo "<div class='alert alert-success'> <strong>Success ! </strong> Event Record UPDATED Successfully...Redirecting...!</div>".
    	"<script>setTimeout(function(){ window.location.reload(); }, 3000);</script>";    
    	exit();
		}

	else
	{
	echo "<div class='alert alert-danger'> <strong>Error ! </strong> Error in updating record.</div>";
    echo("Error description: " .mysqli_error($conn));
	}
}



// admin delete tile

if(isset($_GET['eventDelId']))
{
	$event_id=$_GET['eventDelId'];
	
	$sql="DELETE FROM events WHERE event_id='$event_id'";
	if($conn->query($sql)===TRUE)
	{
			$_SESSION['MSG']= "<div class='alert alert-success'> <strong>Success ! </strong>Event DELETED successfuly... Redirecting..</div><script>setTimeout(function(){ window.location.reload(); }, 4000);</script>";
			header('location:'.$_SERVER['HTTP_REFERER']);exit();
	}
	else
	{
		$_SESSION['MSG']= "<div class='alert alert-danger'> <strong>Error ! </strong> Error in DELETING record</div>";
		header('location:'.$_SERVER['HTTP_REFERER']);exit();
	}
}

 // upload event photo

  if (isset($_POST['eventPhotoId'])) 
  {
    $event_id=$_POST['eventPhotoId'];
    $files = $_FILES['file'];

    $filename = $files['name'];
    $filetmp = $files['tmp_name'];
    $fileerror = $files['error'];

    $fileext = explode('.', $filename);
    $filecheck = strtolower(end($fileext));
    $fileextstored = array('png'  , 'jpg' , 'jpeg', 'webp');

    if(in_array($filecheck , $fileextstored))
    {
      $newName=time().".".$fileext;
      $destinationfile = 'assets/images/events/'.$newName  ;
      move_uploaded_file($filetmp, $destinationfile);
      $conn->query("UPDATE events SET event_image='$newName' WHERE event_id='$event_id' ");
      $_SESSION['MSG']= "<div class='alert alert-success'> <strong>Success ! </strong> Event Photo Uploaded successfuly... Redirecting..</div><script>setTimeout(function(){ window.location.reload(); }, 3000);</script>";
      header('Location: '.$_SERVER['HTTP_REFERER']);
    }
    else
    {
      $_SESSION['MSG']= "<div class='alert alert-danger'> <strong>Error ! </strong> Error in UPLOADING product photo</div>";
      header('Location: '.$_SERVER['HTTP_REFERER']);
    }
  }

?>