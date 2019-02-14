<?php
@include ("dbconnect.php");
if($_POST['id'] )
{
	$query = "SELECT * FROM dosen WHERE id_dosen='$_POST[id]'";
	$result = mysqli_query($conn,$query);
	foreach ($result as $row) { 	
?>
	Apakah anda ingin menghapus data dosen dengan <br>
	nama : <b><?php echo $row['nama_dosen']; ?></b>
	<br><br>
	
<?php
	}
}
	$conn->close();
?>