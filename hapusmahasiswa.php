<?php
@include ("dbconnect.php");
if($_POST['nim']){
	$query = "SELECT * FROM mahasiswa WHERE mahasiswa.nim = '".$_POST['nim']."'";
	$result = mysqli_query($conn,$query);
	foreach ($result as $row) { 
?>
	Apakah anda ingin menghapus data mahasiswa nim : <b><?php echo $_POST['nim']; ?></b> dengan nama <b><?php echo $row['nama']; ?></b>
	<br>
<?php
	}
}
	$conn->close();
?>