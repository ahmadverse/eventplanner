<?php
include_once 'includes/conn.php';
$errorMessage = "";
if (isset($_POST['subscribe'])) {
    $email = $_POST['email'];

    // Validate email (you can add more validation)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = "Invalid email address. Please try again.";
    } else {
        // Save the email address to a database or send it to a mailing list service.
        // Example: Save to a database
       $sql="SELECT * FROM subscribers WHERE email='$email' ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
        
        $_SESSION['MSG']= "<div class='alert alert-warning'> <strong>Wait ! </strong> Already subscribed.</div><script>setTimeout(function(){ window.location.href='email.php'; }, 1000);</script>";
            header('location:'.$_SERVER['HTTP_REFERER']);exit();   
        exit();
    }
        $sql = "INSERT INTO subscribers (email) VALUES ('$email')";
        if (mysqli_query($conn, $sql)) {
        
            $_SESSION['MSG']= "<div class='alert alert-success'> <strong>Success ! </strong> Thanks for subscribing ...Redirecting...!</div><script>setTimeout(function(){ window.location.href='email.php'; }, 5000);</script>";
            header('location:'.$_SERVER['HTTP_REFERER']);exit();   
        exit();
        } else {
            echo("Error description: " .mysqli_error($conn));
            exit(); 
        }
        mysqli_close($conn);
    }
}
?>
