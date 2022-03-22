<?php
	require_once("dbConn.php");
	
        session_start();

		$sql = $conn->prepare("UPDATE rtkservicecontract SET price=? WHERE id=?");
		
        $id = $_SESSION['id'];
        $price = $_SESSION['price'];
                
		$sql->bind_param("di",$price,$id);	
		if($sql->execute()) {
			header("location:../rtkservicecontract.php");
		} else {
			echo "<h1>Failed to update price! You will be redirected...</h1>";
			header('Refresh: 5; URL=http://213.125.207.156/rtkservicecontract.php');
		}


	$sql = $conn->prepare("SELECT * FROM rtkservicecontract WHERE id=?");
	$sql->bind_param("i",$id);			
	$sql->execute();
	$result = $sql->get_result();
	if ($result->num_rows > 0) {		
		$row = $result->fetch_assoc();
	}
	$conn->close();
?>