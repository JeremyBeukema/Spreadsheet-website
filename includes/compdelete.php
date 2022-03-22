<?php

    require_once("dbConn.php");

    if(isset($_GET['Del']))
    {
        $id = $_GET['Del'];
        $query = " DELETE FROM companies WHERE id = '".$id."'";
        $result = mysqli_query($conn,$query);

        if($result) {
            header("location:../companies.php");
        }
        else {
            echo 'Check your query';
        }
    }
    else {
        header("location:../companies.php");
    }

?>