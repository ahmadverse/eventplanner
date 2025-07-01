<?php
	if(!isset($_SESSION)) session_start();
	$conn = new mysqli("db4free.net", "ahmad_user", "yourpassword", "event_planner");

	if($conn->connect_errno){
		die('Error in DB Connection: ' . $conn->connect_error);
	}
?>
