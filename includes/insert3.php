<?php
if (isset($_POST['submit'])) {
		require_once("../includes/dbConn.php");
		$sql = $conn->prepare("INSERT INTO companies (name,phone,location,contact,discount,notes) VALUES (?, ?, ?, ?, ?, ?)");  
		
        $name= $_POST['name'];
        $phone= $_POST['phone'];
        $location= $_POST['location'];
        $contact= $_POST['contact'];
		$discount= $_POST['discount'];
		$notes= $_POST['notes'];

		$sql->bind_param("ssssis", $name, $phone, $location, $contact, $discount, $notes);
		if($sql->execute()) {
			header("location:../companies.php");
		} else {
			echo "<h2>Failed to add contract! Check if name already exists.<br>
			You will be redirected...</h2>";
			header('Refresh: 5; URL=http://213.125.207.156/newcontract.php');
		}
		$sql->close();   
		$conn->close();
	} 
?>