<?php
if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW']))
{
 $name = $_SERVER['PHP_AUTH_USER'];
 $pass = $_SERVER['PHP_AUTH_PW'];
 if ($name == 'admin' && $pass == 'admin')
 {
  $authenticate = true;
 }
}
 
if ($authenticate==false)
{
 header('WWW-Authenticate: Basic realm="Restricted Page Enter Details To Continue"');
 header('HTTP/1.0 401 Unauthorized');
 echo "Authentication Failed Refresh To Do It Again";
} 

else
{
 ?>
<?php include 'includes/header.php';?>
<?php include 'includes/dbConn.php';?>

<?php
    $id = $_GET['ID'];
    $query = " SELECT * FROM companies WHERE id='$id'";
    $result = mysqli_query($conn,$query);

    while($row=mysqli_fetch_assoc($result))
    {
        $name = $row['name'];
        $phone = $row['phone'];
        $location = $row['location'];
        $contact = $row['contact'];
        $discount = $row['discount'];
        $notes = $row['notes'];
        $id = $row['id'];
    }

    $rsql = "SELECT *, DATEDIFF(enddate,now()) as datediff FROM rtkservicecontract WHERE company='$name' ORDER BY enddate DESC";
    $rresult = mysqli_query($conn,$rsql);
   
    $sql = "SELECT *, DATEDIFF(enddate,now()) as datediff FROM servicecontract WHERE company='$name' ORDER BY enddate DESC";
    $sresult = mysqli_query($conn,$sql);
?>
<title><?php echo $name ?></title>
<body>
    <div class="forms">
        <div class="row">
            <p style="font-weight:100; font-size:130%;">Info</p>
        </div><br>
                <div style="max-width:400px; display:inline-block;"><label style="min-width:150px; display: inline-block;">Naam - </label><?php echo $name ?></div>
                <div style="float:right;"><label><fieldset style="min-width:400px; max-width:400px; min-height:110px; display:inline-block;"><legend>Note</legend><?php echo $notes ?></fieldset></div><br>
                <div style="max-width:400px; display:inline-block;"><label style="min-width:150px; display: inline-block;">Telefoon - </label><?php echo $phone ?></div><br>
                <div style="max-width:400px; display:inline-block;"><label style="min-width:150px; display: inline-block;">Locatie - </label><?php echo $location ?></div><br>
                <div style="max-width:400px; display:inline-block;"><label style="min-width:150px; display: inline-block;">Contact - </label><?php echo $contact ?></div><br>
                <div style="max-width:400px; display:inline-block;"><label style="min-width:150px; display: inline-block;">Korting - </label><?php echo $discount ?>%</div><br>
                <div style="max-width:400px; display:inline-block;"><label style="min-width:150px; display: inline-block;">Contracten - </label><?php echo (mysqli_num_rows($sresult)+mysqli_num_rows($rresult)); ?></div><br>
    <div id="table-wrapper">
    <div id="table-scroll">
        <p style="background-color:rgb(92, 92, 92); color:white; text-align:center;"><b>RTK Servicecontracten</b></p>
        <table>
            <tr>
                <th><a href="#.php?sort=name">Naam</th>
                <th><a href="#.php?sort=passwords">Password</th>
                <th><a href="#.php?sort=company">Bedrijf</th>
                <th><a href="#.php?sort=startdate">Start datum</th>
                <th><a href="#.php?sort=enddate">Eind datum</th>
                <th><a href="#.php?sort=price">Bedrag</th>
                <th><a href="#.php?sort=sr">SR</th>
                <th><a href="#.php?sort=firstdate">Eerste datum</th>
                <th><a href="#.php?sort=notes">Note</th>
                <th><a href="#.php?sort=#">Bijwerken</th>
                <th><a href="#.php?sort=#">Verwijderen</th>
            </tr>
            <?php while($row = mysqli_fetch_array($rresult)):
                $id = $row['id'];  
                $sr = $row['sr'];  

                $color = "white";
                $v = $row["datediff"];
           
                if($v<(7)){
                    $color='red';
                }elseif ($v<(30)){
                    $color='orange';
                }elseif ($v<(60)){
                    $color='yellow';
                }
            ?>
            <tr>
                <td><?php echo $row['name'];?></td>
                <td><?php echo $row['passwords'];?></td>
                <td><?php echo $row['company'];?></td>
                <td><?php echo date('d-m-Y', strtotime($row['startdate']));?></td>
                <td style="background-color:<?=$color?>;"><?php echo date('d-m-Y', strtotime($row['enddate']));?></td>
                <td>€ <?php echo $row['price'];?></td>
                <td><?php echo $row['sr'];?>.odt</td>
                <td><?php echo date('d-m-Y', strtotime($row['firstdate']));?></td>
                <td><?php echo $row['notes'];?></td>
                <td><a href="rtkedit.php?GetID=<?php echo $id ?>">Change</a></td>
                <td>
                    <a href="#popup1?Del=<?php echo $id ?>">Delete</a>
                    <div id="popup1?Del=<?php echo $id ?>" class="overlay">
                        <div class="popup">
                        <h4>Contract <u><?php echo $sr ?></u> verwijderen?</h4>
                        <div class="text">
                        <a href="includes/rtkdelete.php?Del=<?php echo $id ?>">Ja</a>
                        <a href="#">Nee</a>
                        </div>
                    </div>
                    </div>
                </td>
            </tr>
            <?php endwhile;?>
        </table>
    </div></div>
    <div id="table-wrapper">
    <div id="table-scroll">
        <p style="background-color:rgb(92, 92, 92); color:white; text-align:center;"><b>Servicecontracten</b></p>
        <table>
            <tr>
                <th><a href="#.php?sort=name">Naam</th>
                <th><a href="#.php?sort=company">Bedrijf</th>
                <th><a href="#.php?sort=startdate">Start datum</th>
                <th><a href="#.php?sort=enddate">Eind datum</th>
                <th><a href="#.php?sort=price">Bedrag</th>
                <th><a href="#.php?sort=sr">SR</th>
                <th><a href="#.php?sort=firstdate">Eerste datum</th>
                <th><a href="#.php?sort=notes">Note</th>
                <th><a href="#.php?sort=#">Bijwerken</th>
                <th><a href="#.php?sort=#">Verwijderen</th>
            </tr>
            <?php
                mysqli_data_seek($sresult, 0); 
                while($row = mysqli_fetch_array($sresult)):
                $id = $row['id'];  
                $sr = $row['sr'];  

                $color = "white";
                $v = $row["datediff"];
           
                if($v<(7)){
                    $color='red';
                }elseif ($v<(30)){
                    $color='orange';
                }elseif ($v<(60)){
                    $color='yellow';
                }
            ?>
            <tr>
                <td><?php echo $row['name'];?></td>
                <td><?php echo $row['company'];?></td>
                <td><?php echo date('d-m-Y', strtotime($row['startdate']));?></td>
                <td style="background-color:<?=$color?>;"><?php echo date('d-m-Y', strtotime($row['enddate']));?></td>
                <td>€ <?php echo $row['price'];?></td>
                <td><?php echo $row['sr'];?>.odt</td>
                <td><?php echo date('d-m-Y', strtotime($row['firstdate']));?></td>
                <td><?php echo $row['notes'];?></td>
                <td><a href="edit.php?GetID=<?php echo $id ?>">Change</a></td>
                <td>
                    <a href="#popup1?Del=<?php echo $id ?>">Delete</a>
                    <div id="popup1?Del=<?php echo $id ?>" class="overlay">
                        <div class="popup">
                        <h4>Contract <u><?php echo $sr ?></u> verwijderen?</h4>
                        <div class="text">
                        <a href="includes/delete.php?Del=<?php echo $id ?>">Ja</a>
                        <a href="#">Nee</a>
                        </div>
                    </div>
                    </div>
                </td>
            </tr>
            <?php endwhile;?>
        </table>
    </div></div>
</div>
</body>
<?php include 'includes/footer.php';?>
<?php
}
?>