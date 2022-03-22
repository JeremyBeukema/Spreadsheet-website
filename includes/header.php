<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1024">
    <link rel="stylesheet" href="css/styles.css">
</head>	
<ul>
    <li><a href="index.php">Home</a></li>
	<li class="dropdown">
		<a href="javascript:void(0)" class="dropbtn">Spreadsheets</a>
		<div class="dropdown-content">
			<a href="servicecontract.php" style="text-align:left;">Servicecontract</a>
			<a href="rtkservicecontract.php" style="text-align:left;">RTK Servicecontract</a>
		</div>
	</li>
	<li><a href="companies.php">Bedrijven</a></li>
    <li><a href="newcontract.php">Toevoegen</a></li>
	<li class="dropdown" style="float:right;">
	<a href="javascript:void(0)" class="dropbtn">Export</a>
		<div class="dropdown-content" style="right:0;">
			<a href="includes/exportData1.php" style="text-align:right;">Bedrijven</a>
			<a href="includes/exportData2.php" style="text-align:right;">Servicecontract</a>
			<a href="includes/exportData3.php" style="text-align:right;">RTK Servicecontract</a>
		</div>
	</li>
</ul>