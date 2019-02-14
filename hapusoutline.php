<?php
@include ("dbconnect.php");
if($_POST['id']){
	$query = "SELECT * FROM outline
	JOIN mahasiswa ON mahasiswa.nim = outline.nim
	 WHERE outline.id_outline = '".$_POST['id']."'";
	$result = mysqli_query($conn,$query);
	foreach ($result as $row) {
?>
	Apakah anda ingin menghapus data outline
    <br>Nim : <b><?php echo $row['nim']; ?></b>
    <br>Nama : <b><?php echo $row['nama']; ?> </b>
    <br>Judul Outline <b><?php echo $row['judul_outline']; ?> </b>
	<br>
<?php
	}
}
	$conn->close();
?>