<?php
    include 'dbConn.php';

    session_start();

    $_SESSION['id'] = $_GET['UpdateP'];
    $id = $_GET['UpdateP'];

    $query1 = "SELECT * FROM rtkservicecontract WHERE id='$id'";
    $iresult = mysqli_query($conn,$query1);

    while($row = mysqli_fetch_array($iresult)){
    $company = $row['company'];
    }

    $sql = "SELECT * FROM rtkservicecontract WHERE company='$company' AND enddate > NOW()";
    $sresult = mysqli_query($conn,$sql);

    $query = "SELECT * FROM companies WHERE name='$company'";
    $qresult = mysqli_query($conn,$query);

    $amount = 850;

    while($row = mysqli_fetch_array($qresult)){
        $discount = $row['discount'];
    }

    $a = mysqli_num_rows($sresult);

    if($a>=(8)){
        $discount1 = 29.41176470;
    }elseif($a>=(4)){
        $discount1 = 23.52941176;
    }elseif($a>=(2)){
        $discount1 = 11.76470589;
    }elseif($a>=(0)){
        $discount1 = 0;
    }

    $discount2 = $amount / 100 * $discount1;
    $discount3 = $amount / 100 * $discount;
    $prices = $amount - ($discount2 + $discount3);

    if($prices<=(0)){
        $price = 0;
    } else {
        $price = $prices;
    }
    $_SESSION['price'] = $price;
    header('location:rtkupdatep.php');
?>