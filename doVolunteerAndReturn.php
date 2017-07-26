<?php
	// VOLUNTEER MESSAGE SCRIPT
	
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
	$sql = "INSERT INTO recent (name, subject, email, message, type) VALUES ('$name', '$subject', '$email', '$message', 'VOLUNTEER')";
	if (!mysqli_query($conn,$sql)) {
		die('Error: ' . mysqli_error($conn));
	}
		
	// close connection
	mysqli_close($conn);
	
	// redirect to main page
	header('Location: index.html');
?>