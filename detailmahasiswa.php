<?php
@include ("dbconnect.php");
if($_POST['nim']){
	$query = "SELECT * FROM mahasiswa,gender,angkatan,outline WHERE gender.id_gender = mahasiswa.id_gender AND angkatan.id_angkatan = mahasiswa.id_angkatan AND mahasiswa.nim = outline.nim AND mahasiswa.nim = '".$_POST['nim']."'";
	$result = mysqli_query($conn,$query);
	foreach ($result as $row) { 
?>
            <table class="table">
                <tr>
                    <td width="25%">Nim</td>
                    <td><?php echo $row['nim']; ?></td>
                </tr>
                <tr>
                    <td>Nama Mahasiswa</td>
                    <td><?php echo $row['nama']; ?></td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td><?php echo $row['gender']; ?></td>
                </tr>
                <tr>
                    <td>Angkatan</td>
                    <td><?php echo $row['angkatan']; ?></td>
                </tr>
                <tr>
                    <td>Judul Outline</td>
                    <td><?php echo $row['judul_outline']; ?></td>
                </tr>
                <tr>
                    <td>Tanggal Pengajuan Outline</td>
                    <td><?php echo $row['tgl_pengajuan']; ?></td>
                </tr>
                <tr>
                    <td>Tanggal Verifikasi Outline</td>
                    <td><?php echo $row['tgl_disetujui']; ?></td>
                </tr>
            </table>
<?php 
        }
    }
    $conn->close();
?>