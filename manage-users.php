<?php 
	include_once 'includes/conn.php';


//add user by admin 


	if(isset($_POST['userAddId']))
	{
		
		$name=$_POST['name']; 
  	$login_id=$_POST['login_id'];
  	$pw=$_POST['pw']; 
  	$email=$_POST['email'];
  	$contact=$_POST['contact'];
  	$address=$_POST['address'];
  	$pw=md5($pw);

  	$sql="SELECT * FROM users WHERE login_id='$login_id' ";
	$result = $conn->query($sql);
	if ($result->num_rows > 0)
	{
		echo "<div class='alert alert-warning'><strong>Error ... </strong> User with given ID already exists.</div>";
		exit();
	}
	
	// updating
	$q="INSERT INTO users (name,login_id,pw,email,contact,address,user_type) VALUES ('$name','$login_id','$pw','$email' ,'$contact','$address','1') ";
	 if($conn->query($q)===TRUE)
        {
          echo "<div class='alert alert-success border-success'> <strong>Success ! </strong> Your profile UPDATED successfully ...Redirecting...!</div>".
          "<script>setTimeout(function(){ window.location.reload(); }, 3000);</script>";    
          exit();
        }
        else
        {
          echo "<div class='alert alert-danger'> <strong>Error ! </strong> Error in UPDATING record.</div>";
          echo("Error description: " .mysqli_error($conn));
        }
  
  }

	

  // edit user Profile by admin and user


	if(isset($_POST['userEditId']))
	{
		$user_id=$_POST['userEditId'];
		$name=$_POST['name']; 
  	$login_id=$_POST['login_id'];
  	$pw=$_POST['pw']; 
  	$email=$_POST['email'];
  	$contact=$_POST['contact'];
  	$address=$_POST['address'];
  	$pw=md5($pw);

  	$sql="SELECT * FROM users WHERE login_id='$login_id' AND user_id!='$user_id' ";
	$result = $conn->query($sql);
	if ($result->num_rows > 0)
	{
		echo "<div class='alert alert-warning'><strong>Error ... </strong> User with given ID already exists.</div>";
		exit();
	}
	
	// updating
	$q="UPDATE users SET name='$name',login_id='$login_id',pw='$pw',email='$email',contact='$contact',address='$address' WHERE user_id='$user_id' ";
	 if($conn->query($q)===TRUE)
        {
          echo "<div class='alert alert-success border-success'> <strong>Success ! </strong> Your profile UPDATED successfully ...Redirecting...!</div>".
          "<script>setTimeout(function(){ window.location.reload(); }, 3000);</script>";    
          exit();
        }
        else
        {
          echo "<div class='alert alert-danger'> <strong>Error ! </strong> Error in UPDATING record.</div>";
          echo("Error description: " .mysqli_error($conn));
        }
  
  }

	

	//admin deleting account of user 
if(isset($_GET['userDelId']))
{
	$user_id=$_GET['userDelId'];

	$sql="DELETE FROM users WHERE user_id='$user_id'";
	if($conn->query($sql)===TRUE)
	{

		echo  "<div class='alert alert-success'> <strong>Success ! </strong> User account DELETED successfuly... Redirecting..</div><script>setTimeout(function(){ window.location.reload(); }, 3000);</script>";
		header('location:users.php');
			exit();
	}
	else
	{
		$_SESSION['MSG']= "<div class='alert alert-danger'> <strong>Error ! </strong> Error in DELETING User account</div>";
		header('location:'.$_SERVER['HTTP_REFERER']);exit();
	} 
} 


	//admin MAKE admin account
if(isset($_GET['makeAdminId']))
{
	$user_id=$_GET['makeAdminId'];

	$sql="UPDATE users SET user_type='0' WHERE user_id='$user_id'";
	if($conn->query($sql)===TRUE)
	{
		$_SESSION['MSG']= "<div class='alert alert-success'> <strong>Success ! </strong> Profile APPROVED as ADMIN successfully... Redirecting..</div><script>setTimeout(function(){ window.location.reload(); }, 3000);</script>";
		header('location:'.$_SERVER['HTTP_REFERER']);exit();
	}
	else
	{
		$_SESSION['MSG']= "<div class='alert alert-danger'> <strong>Error ! </strong> Error in  updating record</div>";
		header('location:'.$_SERVER['HTTP_REFERER']);exit();
	} 
} 



	//admin remove admin account
if(isset($_GET['removeAdminId']))
{
	$user_id=$_GET['removeAdminId'];

	$sql="UPDATE users SET user_type='1' WHERE user_id='$user_id'";
	if($conn->query($sql)===TRUE)
	{
		$_SESSION['MSG']= "<div class='alert alert-success'> <strong>Success ! </strong> Profile REMOVED as ADMIN successfully... Redirecting..</div><script>setTimeout(function(){ window.location.reload(); }, 3000);</script>";
		header('location:'.$_SERVER['HTTP_REFERER']);exit();
	}
	else
	{
		$_SESSION['MSG']= "<div class='alert alert-danger'> <strong>Error ! </strong> Error in  updating record</div>";
		header('location:'.$_SERVER['HTTP_REFERER']);exit();
	} 
} 

?>