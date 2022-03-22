<?php
if (isset($_POST['submit'])) {
    include 'dbConn.php';

    session_start();

    $_SESSION['name'] = $_POST['name'];
    $_SESSION['company'] = $_POST['company'];
    $_SESSION['startdate'] = $_POST['startdate'];
    $_SESSION['enddate'] = $_POST['enddate'];
    $_SESSION['sr'] = $_POST['sr'];
    $_SESSION['firstdate'] = $_POST['firstdate'];
    $_SESSION['notes'] = $_POST['notes'];

    $company = $_SESSION['company'];

    $sql = "SELECT * FROM servicecontract WHERE company='$company' AND enddate > NOW()";
    $sresult = mysqli_query($conn,$sql);

    $query = "SELECT * FROM companies WHERE name='$company'";
    $qresult = mysqli_query($conn,$query);

    $amount = 850;

    while($row = mysqli_fetch_array($qresult)){
        $discount = $row['discount'];
    }

    $a = mysqli_num_rows($sresult);

    if($a>=(7)){
        $discount1 = 29.41176470;
    }elseif($a>=(3)){
        $discount1 = 23.52941176;
    }elseif($a>=(1)){
        $discount1 = 11.76470589;
    }elseif($a=(0)){
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
    header('location:insert1.php');
} else {
    echo "<h1>Failed to calculate price! You will be redirected...</h1>";
    header('Refresh: 5; URL=http://213.125.207.156/newcontract.php');
}
?>