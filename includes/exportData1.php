<?php 
include_once 'dbConn.php'; 
 
$query = $conn->query("SELECT * FROM companies ORDER BY id ASC");
 
if($query->num_rows > 0){ 
    $delimiter = ","; 
    $filename = "bedrijven-backup_" . date('Y-M-d') . ".csv"; 
     
    $f = fopen('php://memory', 'w'); 
     
    $fields = array('NAME', 'PHONE', 'LOCATION', 'CONTACT', 'DISCOUNT', 'NOTES'); 
    fputcsv($f, $fields, $delimiter); 
     
    while($row = $query->fetch_assoc()){ 
        $lineData = array($row['name'], $row['phone'], $row['location'], $row['contact'], $row['discount'], $row['notes']); 
        fputcsv($f, $lineData, $delimiter); 
    } 
     
    fseek($f, 0);
    
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
     
    fpassthru($f); 
} 
exit; 
 
?>