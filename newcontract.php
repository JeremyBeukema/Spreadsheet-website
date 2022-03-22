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
<title>Contract toevoegen</title>
<?php
    $query = " SELECT * FROM companies ORDER BY name ASC";
    $result = mysqli_query($conn,$query);

    $rownum = (mysqli_num_rows($result)-1);

?>
<body>
<div class="forms">
<script type="text/javascript">
function setForm(value) {
    if(value == 'ncompany'){
                document.getElementById('ncompany').style='display:block;';
                document.getElementById('nrtkservicecontract').style='display:none;';
                document.getElementById('nservicecontract').style = 'display:none;';
            }
            else if(value == 'nservicecontract') {
                document.getElementById('nservicecontract').style = 'display:block;';
                document.getElementById('nrtkservicecontract').style = 'display:none;';
                document.getElementById('ncompany').style = 'display:none;';
            }
            else if(value == 'nrtkservicecontract') {
                document.getElementById('nrtkservicecontract').style = 'display:block;';
                document.getElementById('nservicecontract').style = 'display:none;';
                document.getElementById('ncompany').style = 'display:none;';
            }
}
</script>
<fieldset>
<label style="font-size:120%;">Voeg toe aan:</label>
<select id="select1" onchange="setForm(this.value)">
<option value="ncompany">Bedrijven</option>
<option value="nservicecontract">Servicecontracten</option>
<option value="nrtkservicecontract">RTK Servicecontracten</option>
</select><br>
<div id="ncompany"><br>
    <label style="float:left;"><b>Bedrijf</b></label>
        <form action="includes/insert3.php" method="POST">
        <div class="row">
            <div><label for="name">Naam -</label>
            <input autocomplete="off" type="text" name="name" required></div>
            <div><label for="phone">Telefoon -</label>
            <input autocomplete="off" type="text" name="phone"></div>
            <div><label for="location">Locatie -</label>
            <input autocomplete="off" type="text" name="location"></div>
        </div>
        <br><div><label style="hidden">&nbsp;</label></div>
        <div class="row">
            <div><label for="contact">Contact -</label>
            <input autocomplete="off" type="text" name="contact"></div>
            <div><label for="discount">Korting -</label>
            <input autocomplete="off" type="text" name="discount"></div>
            <div><label for="notes">Note -</label>
            <input autocomplete="off" type="text" name="notes"></div>
        </div><br><br><br>
        <input type="submit" value="Submit" name="submit" style="float:left;">
        </form>
</div>
<div  id="nservicecontract" style="display: none"><br>
    <label style="float:left;"><b>Servicecontract</b></label>
        <form action="includes/pricecalc.php" method="POST">
        <div class="row">
            <div><label for="name">Naam -</label>
            <input autocomplete="off" type="text" name="name" required></div>
            <div><label for="company">Bedrijf -</label>
                <select type="text" name="company" required>
                    <option selected="true" disabled="disabled">Selecteer</option>
                    <?php
                        while($row=mysqli_fetch_assoc($result))
                        {
                            $name = $row['name']; 
                        echo '<option value="'.$name.'">'.$name.'</option>'; 
                        }
                    ?>
                </select></div>
            <div><label for="sr">SR -</label>
            <input autocomplete="off" type="text" name="sr" required></div>
        </div>
        <br><div><label style="hidden">&nbsp;</label></div>
        <div class="row">
            <div><label style="hidden">&nbsp;</label></div>
            <div><label for="notes">Note -</label>
            <input autocomplete="off" type="text" name="notes" ></div>
            <div><label style="hidden">&nbsp;</label></div>
        </div>
        <br><div><label style="hidden">&nbsp;</label></div>
        <div class="row">
        <div><label for="startdate">Start datum -</label>
            <input autocomplete="off" type="date" name="startdate" required></div>
            <div><label for="enddate">Eind datum -</label>
            <input autocomplete="off" type="date" name="enddate" required></div>
            <div><label for="firstdate">Eerste datum -</label>
            <input autocomplete="off" type="date" name="firstdate" required></div>
        </div><br><br>
        <input type="submit" value="Submit" name="submit" style="float:left;">
        </form>
</div>
<div  id="nrtkservicecontract" style="display: none"><br>
    <label style="float:left;"><b>RTK Servicecontract</b></label>
        <form action="includes/rtkpricecalc.php" method="POST">
        <div class="row">
            <div><label for="name">Naam -</label>
            <input autocomplete="off" type="text" name="name" required></div>
            <div><label for="company">Bedrijf -</label>
            <select type="text" name="company" required>
                <option selected="true" disabled="disabled">Selecteer</option>
                <?php
                    mysqli_data_seek($result, 0);
                    while($row=mysqli_fetch_assoc($result))
                    {
                        $name = $row['name'];
                    echo '<option value="'.$name.'">'.$name.'</option>'; 
                    }
                ?>
            </select></div>
            <div><label for="sr">SR -</label>
            <input autocomplete="off" type="text" name="sr" required></div>
        </div>
        <br><div><label style="hidden">&nbsp;</label></div>
        <div class="row">
            <div><label for="passwords">Password -</label>
            <input autocomplete="off" type="text" name="passwords" required></div>
            <div><label style="hidden">&nbsp;</label></div>
            <div><label for="notes">Note -</label>
            <input autocomplete="off" type="text" name="notes"></div>
        </div>
        <br><div><label style="hidden">&nbsp;</label></div>
        <div class="row">
            <div><label for="startdate">Start datum -</label>
            <input autocomplete="off" type="date" name="startdate" required></div>
            <div><label for="enddate">Eind datum -</label>
            <input autocomplete="off" type="date" name="enddate" required></div>
            <div><label for="firstdate">Eerste datum -</label>
            <input autocomplete="off" type="date" name="firstdate" required></div>
        </div><br><br>
        <input type="submit" value="Submit" name="submit" style="float:left;">
        </form>
</div>
</fieldset>
</div>
</body>
<?php include 'includes/footer.php';?>
<?php
}
?>