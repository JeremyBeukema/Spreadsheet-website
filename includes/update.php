<?php
	require_once("dbConn.php");
	if (isset($_POST['update'])) {		
		$sql = $conn->prepare("UPDATE servicecontract SET name=? , company=? , startdate=? , enddate=? , price=? , sr=? , firstdate=? , notes=?  WHERE id=?");
		
        $name = $_POST['name'];
        $company = $_POST['company'];
        $startdate = $_POST['startdate'];
        $enddate = $_POST['enddate'];
        $price = $_POST['price'];
        $sr = $_POST['sr'];
        $firstdate = $_POST['firstdate'];
        $notes = $_POST['notes'];
        
		$sql->bind_param("ssssdsssi",$name, $company, $startdate, $enddate, $price, $sr, $firstdate, $notes,$_GET["id"]);	
		if($sql->execute()) {
			header("location:../servicecontract.php");
		} else {
			echo "<h1>Failed to update contract! You will be redirected...</h1>";
			header('Refresh: 5; URL=http://213.125.207.156/servicecontract.php');
		}

	}
	$sql = $conn->prepare("SELECT * FROM servicecontract WHERE id=?");
	$sql->bind_param("i",$_GET["id"]);			
	$sql->execute();
	$result = $sql->get_result();
	if ($result->num_rows > 0) {		
		$row = $result->fetch_assoc();
	}
	$conn->close();
?>