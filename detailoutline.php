<?php
@include ("dbconnect.php");
if($_POST['nim']){
	$query = "SELECT * FROM mahasiswa,outline,dosen WHERE dosen.id_dosen = outline.usulan_dosen1 AND mahasiswa.nim = outline.nim AND outline.nim = '".$_POST['nim']."'";
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
                <tr>
                    <td>Pertanyaan Penelitian </td>
                    <td><?php echo $row['pertanyaan_penelitian']; ?></td>
                </tr>
                <tr>
                    <td>Manfaat Penelitian </td>
                    <td><?php echo $row['manfaat_penelitian']; ?></td>
                </tr>
                <tr>
                    <td>Desain Penelitian </td>
                    <td><?php echo $row['desain_penelitian']; ?></td>
                </tr>
                <tr>
                    <td>Sample Penelitian </td>
                    <td><?php echo $row['sample_penelitian']; ?></td>
                </tr>
                <tr>
                    <td>Variabel Bebas </td>
                    <td><?php echo $row['variabel_bebas']; ?></td>
                </tr>
                <tr>
                    <td>Variabel Tergantung</td>
                    <td><?php echo $row['variabel_tergantung']; ?></td>
                </tr>
                <tr>
                    <td>Hipotesis</td>
                    <td><?php echo $row['hipotesis']; ?></td>
                </tr>
                <tr>
                    <td>Usulan Dosen 1</td>
                    <td><?php echo $row['gelar_depan']." ". $row['nama_dosen']." ".$row['gelar_belakang'];?></td>
                </tr>
                <tr>
                    <td>Usulan Dosen 2</td>
                    <td>
                        <?php 
                            $sql = "SELECT gelar_depan,nama_dosen,gelar_belakang from dosen,outline WHERE $row[usulan_dosen2] = dosen.id_dosen LIMIT 1";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                echo $path['gelar_depan']." ". $path['nama_dosen']." ".$path['gelar_belakang'];
                            } 
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Tanggal Pengajuan</td>
                    <td><?php echo $row['tgl_pengajuan']; ?></td>
                </tr>
                <tr>
                    <td>Status Verifikasi</td>
                    <td><?php echo $row['verified']; ?></td>
                </tr>
            </table>
<?php 
        }
    }
    $conn->close();
?>