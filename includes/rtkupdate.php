<?php
	require_once("dbConn.php");
	if (isset($_POST['rtkupdate'])) {		
		$sql = $conn->prepare("UPDATE rtkservicecontract SET name=? , passwords=? , company=? , startdate=? , enddate=? , price=? , sr=? , firstdate=? , notes=?  WHERE id=?");
		
        $name = $_POST['name'];
        $passwords = $_POST['passwords'];
        $company = $_POST['company'];
        $startdate = $_POST['startdate'];
        $enddate = $_POST['enddate'];
        $price = $_POST['price'];
        $sr = $_POST['sr'];
        $firstdate = $_POST['firstdate'];
        $notes = $_POST['notes'];
        
		$sql->bind_param("sssssdsssi",$name, $passwords, $company, $startdate, $enddate, $price, $sr, $firstdate, $notes,$_GET["id"]);	
		if($sql->execute()) {
			header("location:../rtkservicecontract.php");
		} else {
			echo "<h1>Failed to update contract! You will be redirected...</h1>";
			header('Refresh: 5; URL=http://213.125.207.156/rtkservicecontract.php');
		}

	}
	$sql = $conn->prepare("SELECT * FROM rtkservicecontract WHERE id=?");
	$sql->bind_param("i",$_GET["id"]);			
	$sql->execute();
	$result = $sql->get_result();
	if ($result->num_rows > 0) {		
		$row = $result->fetch_assoc();
	}
	$conn->close();
?>