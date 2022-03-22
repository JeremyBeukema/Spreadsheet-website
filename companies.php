<?php include 'includes/header.php';?>
<?php include 'includes/dbConn.php';?>
<title>Bedrijven</title>
<?php
if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    $query = "SELECT * FROM `companies` WHERE CONCAT(`name`, `phone`, `location`, `contact`, notes) LIKE '%".$valueToSearch."%' ORDER BY name ASC";
    $search_result = mysqli_query($conn,$query);
}
 else {
    $query = "SELECT * FROM `companies` ORDER BY name ASC";
    $search_result = mysqli_query($conn,$query);
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
<body> 
<button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
	<script src="js/script.js"></script>       
    <form action="companies.php" method="post">
        </div>
        <table>
            <tr>
                <th><a href="companies.php?sort=name">Naam</th>
                <th><a href="companies.php?sort=phone">Telefoon nummer</th>
                <th><a href="companies.php?sort=location">Locatie</th>
                <th><a href="companies.php?sort=contact">Contact persoon</th>
                <th><a href="companies.php?sort=notes">Note</th>
                <th><div class="search">
                <input autocomplete="off" type="text" name="valueToSearch" placeholder="<?php echo mysqli_num_rows ($search_result); ?> Resultaten">
                <input type="submit" name="search" value="Filter"><br></th>
            </tr>
            <?php while($row = mysqli_fetch_array($search_result)):
                $id = $row['id'];   
                $name = $row['name']; 
            ?>
                <tr>
                    <td><a href="compinfo.php?ID=<?php echo $id ?>"><?php echo $row['name'] ?></td>
                    <td><?php echo $row['phone'];?></td>
                    <td><?php echo $row['location'];?></td>
                    <td><?php echo $row['contact'];?></td>
                    <td style="max-width:500px;"><?php echo $row['notes'];?></td>
                    <td style="min-width:250px;"><a href="compedit.php?GetID=<?php echo $id ?>" style="margin-left:22%;">Change</a>
                        <a href="#popup1?Del=<?php echo $id ?>" style="float:right; margin-right:22%;">Delete</a>
                        <div id="popup1?Del=<?php echo $id ?>" class="overlay">
                            <div class="popup">
                            <h4>Bedrijf <u><?php echo $name ?></u> verwijderen?</h4>
                            <div class="text">
                            <a href="includes/compdelete.php?Del=<?php echo $id ?>">Ja</a>
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