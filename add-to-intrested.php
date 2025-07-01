<?php
include_once 'includes/conn.php';

// add  item to cart registered user

if(isset($_GET['intrestedAddId']))
{ 
  $event_id=$_GET['intrestedAddId'];
  $user_id=$_SESSION['SESS_UID'];



    $sql="SELECT  FROM wishlist WHERE user_id = '$user_id' AND product_id = '$product_id' ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
    $_SESSION['MSG']= "<div class='alert alert-warning'> <strong>Stop ! </strong> Product already added in wishlist ...Redirecting...!</div><script>setTimeout(function(){ window.location.reload(); }, 3000);</script>";
    header('Location: '.$_SERVER['HTTP_REFERER']);
    exit();
    }


// inserting 
    $q="INSERT INTO intrested_events (user_id, event_id) VALUES ('$user_id', '$event_id')";
    if($conn->query($q)===TRUE)
    {
    header('Location: '.$_SERVER['HTTP_REFERER']);
  }
    else
    {
      echo "<div class='alert alert-warning'><strong>Stop...</strong> error in adding.</div>".
        "<script>setTimeout(function(){ window.location.reload(); }, 2000);</script>";    
      echo("Error description: " .mysqli_error($conn));
    }
}

if(isset($_GET['intrestedRemoveId']))
{ 
  $event_id=$_GET['intrestedRemoveId'];
  $user_id=$_SESSION['SESS_UID'];



// inserting 
     $q="DELETE FROM intrested_events WHERE event_id='$event_id' AND user_id = '$user_id' ";
    if($conn->query($q)===TRUE)
    {
    header('Location: '.$_SERVER['HTTP_REFERER']);
  }
    else
    {
      echo "<div class='alert alert-warning'><strong>Stop...</strong> error in adding.</div>".
        "<script>setTimeout(function(){ window.location.reload(); }, 2000);</script>";    
      echo("Error description: " .mysqli_error($conn));
    }
}

?>


