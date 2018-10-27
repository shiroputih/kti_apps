<?php
@include "dbconnect.php";
if(isset($_POST['importOutline'])){
	//validasi csv file
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    if(is_uploaded_file($_FILES['file']['tmp_name'])){
    	//open uploaded csv file with read only mode
        $csvFile = fopen($_FILES['file']['tmp_name'], 'r');

        //skip first line
        fgetcsv($csvFile);

        //parse data from csv file line by line
        while(($line = fgetcsv($csvFile)) !== FALSE)
        {
        	//check whether member already exists in database with same email
            $sql = "SELECT * FROM mahasiswa";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) 
            {
            	$sqlupdate= "UPDATE mahasiswa SET nama='".$line[1]."'";
            	if (mysqli_query($conn, $sql)) {
            
       			}
       		}
       		else
       		{
            	$sql = "INSERT INTO mahasiswa (nim,nama) VALUES ('".$line[0]."','".$line[1]."')";
            	if (mysqli_query($conn, $sql)) {

            	}
            }
        }
        //close opened csv file
        fclose($csvFile);
    }
}
header("location:mahasiswa.php");
?>