<?php

    require_once("dbConn.php");

    if(isset($_GET['Del']))
    {
        $id = $_GET['Del'];
        $query = " DELETE FROM servicecontract WHERE id = '".$id."'";
        $result = mysqli_query($conn,$query);

        if($result) {
            header("location:../servicecontract.php");
        }
        else {
            echo 'Check your query';
        }
    }
    else {
        header("location:../servicecontract.php");
    }

?>