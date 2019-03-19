<?php 
	// Variable for server
	$db_host = "localhost";
	$db_user = "root";
	$db_pass = "";
	$db_name = "live_search";

	// Variable for connect database
	$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

	// Check connected
	if (!$conn) {
		die("Error DB Not Connect" . mysqli_connect_error());
	}

 ?>