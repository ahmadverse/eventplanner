<?php
	if(!isset($_SESSION)) session_start();

	$conn = new mysqli("sql123.db4free.net", "ahmad_user", "your_real_password", "event_planner");

	if($conn->connect_errno){
		die('Error in DB Connection: ' . $conn->connect_error);
	}
?>
