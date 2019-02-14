<?php
@include ("dbconnect.php");
if($_POST['kk1'] ||  $_POST['kk2'] || $_POST['kk3'] ){
	$query = "SELECT * FROM outline JOIN mahasiswa ON mahasiswa.nim = outline.nim WHERE outline.nim = mahasiswa.nim AND outline.kk1 = '".$_POST['kk1']."' OR outline.kk2 = '".$_POST['kk2']."' OR outline.kk3 = '".$_POST['kk3']."'";
	$result = $conn->query($query);
    if ($result->num_rows > 0) {
?>
		<div class = "notification"> Ditemukan <?php echo $result->num_rows; ?> judul yang sama </div>
<?php
	 while ($row = $result->fetch_assoc()) {
		?>
		
		<table class="table">
			<tr>
				<td width="20%">Nim</td>
				<td><?php echo $row['nim']; ?></td>
			</tr>
			<tr>
				<td>Nama Mahasiswa</td>
				<td><?php echo $row['nama']; ?></td>
			</tr>
			<tr>
				<td>Judul Outline</td>
				<td><?php echo $row['judul_outline']; ?></td>
			</tr>
		</table>
		<?php 
        }
    }else{
        ?>
        <div class = "notification"> Tidak ada judul yang sama </div>
    <?php
    }
    $conn->close();
}
?>