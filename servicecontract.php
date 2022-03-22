<?php
include 'includes/header.php';
include 'includes/dbConn.php';

if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    $sql = "SELECT *, DATEDIFF(enddate,now()) as datediff FROM `servicecontract` WHERE CONCAT(`name`, `company`, `startdate`, `enddate`, `price`, `sr`, `firstdate`, `notes`) LIKE '%".$valueToSearch."%' ORDER BY enddate ASC";
    $search_result = mysqli_query($conn,$sql);
}
 else {
    $sql = "SELECT *, DATEDIFF(enddate,now()) as datediff FROM `servicecontract` ORDER BY enddate ASC";
    $search_result = mysqli_query($conn,$sql);
}

?>
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
<title>Servicecontract</title>
<body>  
<button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
	<script src="js/script.js"></script>      
    <form action="servicecontract.php" method="post">
        </div>
        <table>
            <tr>
                <th><a href="servicecontract.php?sort=name">Naam</th>
                <th><a href="servicecontract.php?sort=company">Bedrijf</th>
                <th><a href="servicecontract.php?sort=startdate">Start datum</th>
                <th><a href="servicecontract.php?sort=enddate">Eind datum</th>
                <th><a href="servicecontract.php?sort=price">Bedrag</th>
                <th><a href="servicecontract.php?sort=sr">SR</th>
                <th><a href="servicecontract.php?sort=firstdate">Eerste datum</th>
                <th><a href="servicecontract.php?sort=notes">Note</th>
                <th><div class="search">
                <input autocomplete="off" type="text" name="valueToSearch" placeholder="<?php echo mysqli_num_rows ($search_result); ?> Resultaten">
                <input type="submit" name="search" value="Filter"><br></th>
            </tr>
            <?php while($row = mysqli_fetch_array($search_result)):
                $id = $row['id'];  
                $sr = $row['sr']; 

                $color = "white";
                $v = $row["datediff"];

                if($v<(-14)){
                    $sql = "DELETE FROM servicecontract WHERE id=$id";
                    if ($conn->query($sql) === TRUE) {
                        header('location:servicecontract.php');
                      } else {
                        echo "Error deleting record: " . $conn->error;
                      }
                }elseif($v<(7)){
                    $color='red';
                }elseif ($v<(30)){
                    $color='orange';
                }elseif ($v<(60)){
                    $color='yellow';
                }
            ?>
            <tr>
                <td><?php echo $row['name'];?></a></td>
                <td><?php echo $row['company'];?></td>
                <td><?php echo date('d-m-Y', strtotime($row['startdate']));?></td>
                <td style="background-color:<?=$color?>"><?php echo date('d-m-Y', strtotime($row['enddate']));?></td>
                <td><a href="#popup1?UpdateP=<?php echo $id ?>">€ <?php echo $row['price'];?></a>
                    <div id="popup1?UpdateP=<?php echo $id ?>" class="overlay">
                    <div class="popup">
                        <h4>Prijs <u><?php echo $sr ?></u> updaten?</h4>
                        <div class="text">
                            <a href="includes/pricecalcu.php?UpdateP=<?php echo $id ?>">Ja</a>
                            <a href="#">Nee</a>
                        </div>
                    </div>
                    </div>
                </td>
                <td><?php echo $row['sr'];?>.odt</td>
                <td><?php echo date('d-m-Y', strtotime($row['firstdate']));?></td>
                <td><?php echo $row['notes'];?></td>
                <td><a href="edit.php?GetID=<?php echo $id ?>" style="margin-left:22%;">Change</a>
                    <a href="#popup1?Del=<?php echo $id ?>" style="float:right; margin-right:22%;">Delete</a>
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
    </form>
</body>
<?php include 'includes/footer.php'; ?>
<?php
}
?>
