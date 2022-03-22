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
<?php
    include 'includes/header.php'; 
    require_once("includes/dbConn.php");

    $sql = "SELECT * FROM companies";
    $sresult = mysqli_query($conn,$sql); 

    $id = $_GET['GetID'];
    $query = " SELECT * FROM servicecontract WHERE id='".$id."'";
    $result = mysqli_query($conn,$query);

    while($row=mysqli_fetch_assoc($result))
    {
        $name = $row['name'];
        $company = $row['company'];
        $startdate = $row['startdate'];
        $enddate = $row['enddate'];
        $price = $row['price'];
        $sr = $row['sr'];
        $firstdate = $row['firstdate'];
        $notes = $row['notes'];
        $id = $row['id'];
    }
?>
<title><?php echo $company ?></title>
<body>
<div class="forms">
<fieldset>
    <br>
    <form action="includes/update.php?id=<?php echo $id;?>" method="POST">
        <div class="row">
            <div><label for="name">Naam -</label>
            <input autocomplete="off" type="text" name="name" value="<?php echo $name ?>"></div>           
            <div><label for="company">Bedrijf -</label>
            <select type="text" name="company" required>
                <option selected="true"><?php echo $company ?></option>
                <?php
                    while($row=mysqli_fetch_assoc($sresult))
                    {
                        $name = $row['name'];
                    echo '<option value="'.$name.'">'.$name.'</option>'; 
                    }
                ?>
            </select></div>
            <div><label for="sr">SR -</label>
            <input autocomplete="off" type="text" name="sr" value="<?php echo $sr ?>"></div>
        </div>
        <br><div><label style="hidden">&nbsp;</label></div>
        <div class="row">
            <div><label for="price">Prijs -</label>
            <input autocomplete="off" type="text" name="price" value="<?php echo $price ?>"></div>
            <div><label style="hidden">&nbsp;</label></div>
            <div><label for="notes">Note -</label>
            <input autocomplete="off" type="text" name="notes" value="<?php echo $notes ?>"></div>
        </div>
        <br><div><label style="hidden">&nbsp;</label></div>
        <div class="row">
        <div><label for="startdate">Start datum -</label>
            <input autocomplete="off" type="date" name="startdate" value="<?php echo $startdate ?>"></div>
            <div><label for="enddate">Eind datum -</label>
            <input autocomplete="off" type="date" name="enddate" value="<?php echo $enddate ?>"></div>
            <div><label for="firstdate">Eerste datum -</label>
            <input autocomplete="off" type="date" name="firstdate" value="<?php echo $firstdate ?>"></div>
        </div><br><br>
        <input type="submit" value="Change" name="update">
    </form>
</div>
</fieldset>
</body>
<?php
}
?>