<?php

    require_once("dbConn.php");

    if(isset($_GET['Del']))
    {
        $id = $_GET['Del'];
        $query = " DELETE FROM rtkservicecontract WHERE id = '".$id."'";
        $result = mysqli_query($conn,$query);

        if($result) {
            header("location:../rtkservicecontract.php");
        }
        else {
            echo 'Check your query';
        }
    }
    else {
        header("location:../rtkservicecontract.php");
    }

?>