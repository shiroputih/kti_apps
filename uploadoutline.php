<?php
@include "dbconnect.php";
if(isset($_POST['importOutline'])){
    $semester = $_POST['semester'];
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
        	$sql = "SELECT * FROM outline";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) 
            {
            	$sqlupdate= "UPDATE outline SET nim='".$line[0]."'";
            	if (mysqli_query($conn, $sql)) {
            
       			}
       		}
       		else
       		{
            	$sql = "INSERT INTO INSERT INTO outline (nim,judul_outline,pertanyaan_penelitian,manfaat_penelitian,desain_penelitian,sample_penelitian,variabel_bebas,variabel_tergantung,hipotesis ,tgl_pengajuan,status,semester,kk1,kk2,kk3) VALUES ('".$line[1]."','".$line[2]."','".$line[3]."','".$line[4]."','".$line[5]."','".$line[6]."','".$line[7]."','".$line[7]."','".$line[9]."','".$line[10]."','".$line[11]."','".$semester."','".$line[12]."','".$line[13]."','".$line[14]."')";
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