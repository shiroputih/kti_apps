<?php
@include ("dbconnect.php");
if($_POST['id'] )
{
	$query = "SELECT * FROM `arsipkti`,mahasiswa WHERE mahasiswa.nim = arsipkti.nim AND arsipkti.id_arsipkti ='".$_POST['id']."'";
	$result = mysqli_query($conn,$query);
	foreach ($result as $row) { 	
?>
	Apakah anda ingin menghapus data arsip berita acara proposal mahasiswa dengan <br>
	nim: <b><?php echo $row ['nim']; ?></b><br>
	nama : <b><?php echo $row['nama']; ?></b><br>
	dengan file <b><?php echo $row['kti_filepdf']; ?></b>
	<br>
<?php
	}
}
	$conn->close();
?>