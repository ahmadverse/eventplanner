<?php 
include_once 'includes/conn.php';


//  add new category  

if(isset($_POST['catAddId']))
{
	$cat_name=$_POST['cat_name'];
	

	// updating
	$sql="INSERT INTO categories (cat_name) VALUES ('$cat_name') ";
	if($conn->query($sql)===TRUE)
	{
		echo "<div class='alert alert-success'> <strong>Success ! </strong> Category ADDED Successfully...Redirecting...!</div>".
    	"<script>setTimeout(function(){ window.location.reload(); }, 3000);</script>";    
    	exit();
    	
	}
	else
	{
	echo "<div class='alert alert-danger'> <strong>Error ! </strong> Error in ADDING record.</div>";
    echo("Error description: " .mysqli_error($conn));
	}
}

//  category edit 

if(isset($_POST['catEditId']))
{
	$cat_id=$_POST['catEditId'];
	$cat_name=$_POST['cat_name'];
	
	// updating
	$sql="UPDATE categories SET cat_name='$cat_name' WHERE cat_id='$cat_id' ";
	if($conn->query($sql)===TRUE)
	{
		echo "<div class='alert alert-success'> <strong>Success ! </strong> Category  UPDATED Successfully...Redirecting...!</div>".
    		"<script>setTimeout(function(){ window.location.reload(); }, 3000);</script>";    
    	exit();
	}
	else
	{
	echo "<div class='alert alert-danger'> <strong>Error ! </strong> Error in Updating record.</div>";
    echo("Error description: " .mysqli_error($conn));
	}
}


// delete category info

if(isset($_GET['catDelId']))
{
  $cat_id=$_GET['catDelId'];

  $sql="DELETE FROM categories WHERE cat_id='$cat_id'";
  if($conn->query($sql)===TRUE)
  {
    $_SESSION['MSG']= "<div class='alert alert-success'> <strong>Success ! </strong> Category Record DELETED successfuly... Redirecting..</div><script>setTimeout(function(){ window.location.reload(); }, 1000);</script>";
    header('location:'.$_SERVER['HTTP_REFERER']);exit();
  }
  else
  {
    $_SESSION['MSG']= "<div class='alert alert-danger'> <strong>Error ! </strong> Error in DELETING record</div>";
    header('location:'.$_SERVER['HTTP_REFERER']);exit();
  }
}



?>