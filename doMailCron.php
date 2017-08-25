<?php 
	// EMAIL CRON JOB PHP SCRIPT

	// connect to database
	$conn = mysqli_connect("localhost", "DATABASE", "PASSWORD", "eunioa");
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
		exit();
	}
	
	// get most recent date from 'old'
	$sql = "SELECT time FROM recent ORDER BY time Asc;";
	$result = mysqli_query($conn, $sql);
	if(!$result) {
		die("Error getting recent date" . mysqli_error($conn));
		exit();
	}
	$row = mysqli_fetch_row($result);
	$date = $row[0];
	
	// get everything from recent where date > date from 'old'
	$sql = "SELECT id, name, subject, email, message, type, time FROM recent WHERE time >= '$date' ORDER BY time Asc;";
	$result = mysqli_query($conn, $sql);
	if(!$result) {
		die("Error fetching rows: " . mysqli_error($conn));
		exit();
	}
	
	// compile list into email
	$data = "MAIL FROM eunioa.org REGARDING MESSAGES: \r\n ";
	while( $row = mysqli_fetch_row($result)){
		$data = $data . $row[5]. " Message from: " . $row[1] . " (" . $row[3];
		$data = $data . ") at " . $row[6] . " SUBJECT: " . $row[2] . "\r\n MESSAGE: " . $row[4] . "\r\n \r\n"; 
	}
	
	// send email
	// echo mail("mailer@eunoianonprofit.org", "Eunioa Message Update", $data,"From: Mailer Daemon <mailer@eunoianonprofit.com>\r\n");
	echo mail("gracechoi@eunoianonprofit.org", "Eunioa Message Update", $data,"From: Mailer Daemon <mailer@eunoianonprofit.com>\r\n");
	
	// move all from recent where date > date from 'old' to old
	$sql = "INSERT INTO old SELECT * FROM recent WHERE time >= '$date' AND name REGEXP BINARY '[A-Z]';";
	$result = mysqli_query($conn, $sql);
	if(!$result) {
		die("Error copying data: " . mysqli_error($conn));
		exit();
	}
	
	$sql = "DELETE FROM recent WHERE time >= '$date';";
	$result = mysqli_query($conn, $sql);
	if(!$result) {
		die("Error copying data: " . mysqli_error($conn));
		exit();
	}
	
	// exit
	mysqli_close($conn);
	exit();
?>