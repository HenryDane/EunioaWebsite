<?php
	// connect to database (  host       user    password      db 
	$conn = mysqli_connect("localhost", "blog", "d4b411d4y", "eunioa");
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
		exit();
	}
?>