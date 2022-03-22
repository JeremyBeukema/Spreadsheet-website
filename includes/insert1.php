<?php
	require_once("../includes/dbConn.php");
	$sql = $conn->prepare("INSERT INTO servicecontract (name,company,startdate,enddate,price,sr,firstdate,notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");  

	session_start();

	$name = $_SESSION['name'];
	$company =  $_SESSION['company'];
	$startdate =  $_SESSION['startdate'];
	$enddate =  $_SESSION['enddate'];
	$price =  $_SESSION['price'];
	$sr =  $_SESSION['sr'];
	$firstdate =  $_SESSION['firstdate'];
	$notes =  $_SESSION['notes'];

	$sql->bind_param("ssssdsss", $name, $company, $startdate, $enddate, $price, $sr, $firstdate, $notes); 
	if($sql->execute()) {
		header("location:../servicecontract.php");
	} else {
		echo "<h1>Failed to add contract! You will be redirected...</h1>";
		header('Refresh: 5; URL=http://213.125.207.156/newcontract.php');
	}
	$sql->close();   
	$conn->close();
?>