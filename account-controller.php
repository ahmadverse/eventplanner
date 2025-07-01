<?php 
include_once 'includes/conn.php';
if(isset($_POST['register']))
{

	$name=$_POST['name'];
	$login_id=$_POST['login_id'];
	$pw=$_POST['pw'];
	$email=$_POST['email'];
	$contact=$_POST['contact'];
	$address=$_POST['address'];

	
	$sql="SELECT * FROM users WHERE login_id='$login_id' ";
	$result = $conn->query($sql);
	if ($result->num_rows > 0)
	{
		echo "<div class='alert alert-warning'><strong>Error !!</strong> User with given ID already exists.</div>";
		exit();
	}
		// inserting
		$pw=md5($pw);
		$sql="INSERT INTO users (name,login_id,pw,email,contact,address,user_type) VALUES ('$name','$login_id','$pw','$email' ,'$contact','$address','1') ";
			if($conn->query($sql)===TRUE)
			{
			echo "<div class='alert alert-success'> <strong>Success ! </strong> Registration Successfull. Please Login...Redirecting...!</div>".
			"<script>setTimeout(function(){ window.location.href='login.php'; }, 2000);</script>";		
			exit();
			}
			else
			{
			echo "<div class='alert alert-danger'> <strong>Error ! </strong> Error in inserting record.</div>";
		 	echo("Error description: " .mysqli_error($conn));
			}

}

// login
  if(isset($_POST['login']))
  {
    $login_id=$_POST['login_id'];
    $pw=$_POST['pw'];
    $pw=md5($pw);

    $sql="SELECT * FROM users WHERE login_id='$login_id' AND pw='$pw' ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
      $row = $result->fetch_assoc();
      
      $_SESSION['SESS_UID']=$row['user_id'];
      $_SESSION['SESS_NAME']=$row['name'];
      $_SESSION['USER_TYPE']=$row['user_type'];

      $uType="Admin";  
      if($row['user_type']==1) $uType="User";
      $_SESSION['SESS_UTYPE']=$uType;

      echo "<div class='alert alert-success border-success'> <strong>Success ! </strong>You've Logged in Successfully. ...Redirecting...!</div>".
        "<script>setTimeout(function(){ window.location.href='index.php'; }, 2000);</script>";    
        exit();
    
    }
    else
    {
      echo "<div class='alert alert-danger'> <strong>Error ! </strong> Invalid User ID / Password.</div>";
    }
  }

?>