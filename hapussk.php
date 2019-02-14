<?php
@include ("dbconnect.php");
if($_POST['idsk'])
{
	$query = "SELECT * FROM sk WHERE sk.id_sk = '".$_POST['idsk']."'";
	$result = mysqli_query($conn,$query);
	foreach ($result as $row) {
?>

	Apakah anda ingin menghapus data mahasiswa arsip sk : <b><?php echo $_POST['idsk']; ?></b> dengan file <b><?php echo $row['file_sk']; ?></b>
	<br>
<?php
	}
}
	$conn->close();
?>