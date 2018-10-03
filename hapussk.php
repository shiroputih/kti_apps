<?php
@include ("dbconnect.php");
if($_POST['idsk'])
{
	$query = "SELECT * FROM arsipsk WHERE arsipsk.id_arsipsk = '".$_POST['idsk']."'";
	$result = mysqli_query($conn,$query);
	foreach ($result as $row) { 	
?>

	Apakah anda ingin menghapus data mahasiswa arsip sk : <b><?php echo $_POST['idsk']; ?></b> dengan file <b><?php echo $row['sk_filepdf']; ?></b>
	<br>
<?php
	}
}
	$conn->close();
?>