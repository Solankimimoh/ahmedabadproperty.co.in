
<?php
//include database configuration file
$con = mysqli_connect("localhost", "ahmpropryusr", "Ahm@886611", "ahmedabadproperty") or die("Connection Error");
 

//get records from database
$query = mysqli_query($con,"SELECT * FROM inquiry");

if($query->num_rows > 0){
    $delimiter = ",";
    $filename = "members_" . date('Y-m-d') . ".csv";
    
    //create a file pointer
    $f = fopen('php://memory', 'w');
    
    //set column headers
    $fields = array('ID', 'Name', 'Email', 'Mobile', 'Message');
    fputcsv($f, $fields, $delimiter);
    
    //output each row of the data, format line as csv and write to file pointer
    while($row = $query->fetch_assoc()){
   
        $lineData = array($row['id'], $row['name'], $row['email'], $row['mobile'], $row['message']);
        fputcsv($f, $lineData, $delimiter);
    }
    
    //move back to beginning of file
    fseek($f, 0);
    
    //set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    
    //output all remaining data on a file pointer
    fpassthru($f);
}
exit;

?>