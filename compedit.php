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
    $id = $_GET['GetID'];
    $query = " SELECT * FROM companies WHERE id='".$id."'";
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
?>
<title><?php echo $name ?></title>
<body>
<div class="forms">
<fieldset>
<p style="text-align:center;"><b>Pas op! Sommige dingen werken niet meer correct bij het veranderen van de naam.</b></p>
    <br>
    <form action="includes/compupdate.php?id=<?php echo $id;?>" method="POST">
        <div class="row">
            <div><label for="name">Naam -</label>
            <input autocomplete="off" type="text" name="name" value="<?php echo $name ?>"></div>
            <div><label for="phone">Telefoon -</label>
            <input autocomplete="off" type="text" name="phone" value="<?php echo $phone ?>"></div>
            <div><label for="location">Locatie -</label>
            <input autocomplete="off" type="text" name="location" value="<?php echo $location ?>"></div>
        </div>
        <br><div><label style="hidden">&nbsp;</label></div>
        <div class="row">
            <div><label for="contact">Contact -</label>
            <input autocomplete="off" type="text" name="contact" value="<?php echo $contact ?>"></div>
            <div><label for="discount">Korting -</label>
            <input autocomplete="off" type="text" name="discount" value="<?php echo $discount ?>"></div> 
            <div><label for="notes">Note -</label>
            <input autocomplete="off" type="text" name="notes" value="<?php echo $notes ?>"></div>      
        </div><br><br><br>
        <input type="submit" value="Change" name="compupdate">
    </form>
</div>
</fieldset>
</body>
<?php
}
?>