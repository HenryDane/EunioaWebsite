<?php
	// connect to database (  host       user    password      db 
	$conn = mysqli_connect("localhost", "blog", "d4b411d4y", "eunioa");
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
		exit();
	}
	
	// catch data 
	$name = mysqli_real_escape_string($conn, $_GET['name']);
	$email = mysqli_real_escape_string($conn, $_GET['email']);
	$subject = mysqli_real_escape_string($conn, $_GET['subject']);
	$message = mysqli_real_escape_string($conn, $_GET['message']);
	
	// insert row
	$sql = "INSERT INTO volunteerMsgs (name, subject, email, message) VALUES ($name, $subject, $email, $message)";
	if (!mysqli_query($con,$sql)) {
		die('Error: ' . mysqli_error($con));
	}
	echo "1 record added";
	
	mysqli_close($conn);
?>