<?php
	if(!isset($_SESSION)) session_start();
		// $conn = new mysqli("localhost", "root","", "event_planner"); 
		$conn = new mysqli("your-db-host.com", "your-username", "your-password", "event_planner");

		if($conn->connect_errno){
			die('Error in DB Connection. Please create a database with name <b>event_planner</b> by using <b>phpMyAdmin</b> with user as <b>root</b> and without password.');
		}
	
?>
