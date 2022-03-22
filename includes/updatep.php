<?php
	require_once("dbConn.php");
	
        session_start();

		$sql = $conn->prepare("UPDATE servicecontract SET price=? WHERE id=?");
		
        $id = $_SESSION['id'];
        $price = $_SESSION['price'];
                
		$sql->bind_param("di",$price,$id);	
		if($sql->execute()) {
			header("location:../servicecontract.php");
		} else {
			echo "<h1>Failed to update price! You will be redirected...</h1>";
			header('Refresh: 5; URL=http://213.125.207.156/servicecontract.php');
		}


	$sql = $conn->prepare("SELECT * FROM servicecontract WHERE id=?");
	$sql->bind_param("i",$id);			
	$sql->execute();
	$result = $sql->get_result();
	if ($result->num_rows > 0) {		
		$row = $result->fetch_assoc();
	}
	$conn->close();
?>