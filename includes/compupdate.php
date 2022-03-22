<?php
	require_once("dbConn.php");
	if (isset($_POST['compupdate'])) {		
		$sql = $conn->prepare("UPDATE companies SET name=? , phone=? , location=? , contact=? , discount=? , notes=? WHERE id=?");
		
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $location = $_POST['location'];
        $contact = $_POST['contact'];
		$discount = $_POST['discount'];
		$notes = $_POST['notes'];
        
		$sql->bind_param("ssssisi",$name, $phone, $location, $contact, $discount, $notes,$_GET["id"]);	
		if($sql->execute()) {
			header("location:../companies.php");
		} else {
			echo "<h1>Failed to update contract! You will be redirected...</h1>";
			header('Refresh: 5; URL=http://213.125.207.156/companies.php');
		}

	}
	$sql = $conn->prepare("SELECT * FROM companies WHERE id=?");
	$sql->bind_param("i",$_GET["id"]);			
	$sql->execute();
	$result = $sql->get_result();
	if ($result->num_rows > 0) {		
		$row = $result->fetch_assoc();
	}
	$conn->close();
?>