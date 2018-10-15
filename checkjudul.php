<?php
@include ("dbconnect.php");
if($_POST['kk1'] && $_POST['kk2'] && $_POST['kk3'] ){
	echo "Kata Kunci 1 : ".$_POST['kk1']."<br>";
	echo "Kata Kunci 2 : ".$_POST['kk2']."<br>";
	echo "Kata Kunci 3 : ".$_POST['kk3']."<br> <hr>";
	$query = "SELECT * FROM outline JOIN mahasiswa ON mahasiswa.nim = outline.nim WHERE outline.nim = mahasiswa.nim AND outline.kk1 = '".$_POST['kk1']."' OR outline.kk2 = '".$_POST['kk2']."' OR outline.kk3 = '".$_POST['kk3']."'";
	$result = mysqli_query($conn,$query);
	foreach ($result as $row) { 
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
	}
	else{
		echo "Tidak ditemukan data yang sama";
	}
	?>
	