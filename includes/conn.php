<?php
	if(!isset($_SESSION)) session_start();

	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

	try {
		$conn = new mysqli("db4free.net", "ahmad2025", "Mateen@123", "event_planner");
	} catch (mysqli_sql_exception $e) {
		die('❌ MySQL Connection Error: ' . $e->getMessage());
	}
?>
