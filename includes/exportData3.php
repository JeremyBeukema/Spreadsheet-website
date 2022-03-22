<?php 
include_once 'dbConn.php'; 
 
$query = $conn->query("SELECT * FROM rtkservicecontract ORDER BY id ASC");
 
if($query->num_rows > 0){ 
    $delimiter = ","; 
    $filename = "rtkservicecontract-backup_" . date('Y-M-d') . ".csv"; 
     
    $f = fopen('php://memory', 'w'); 
     
    $fields = array('NAME', 'PASSWORDS', 'COMPANY', 'STARTDATE', 'ENDDATE', 'PRICE', 'SR', 'FIRSTDATE', 'NOTES'); 
    fputcsv($f, $fields, $delimiter); 
     
    while($row = $query->fetch_assoc()){ 
        $lineData = array($row['name'], $row['passwords'], $row['company'], $row['startdate'], $row['enddate'], $row['price'], $row['sr'], $row['firstdate'], $row['notes']); 
        fputcsv($f, $lineData, $delimiter); 
    } 
     
    fseek($f, 0);
    
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
     
    fpassthru($f); 
} 
exit; 
 
?>