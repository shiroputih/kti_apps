<?php
@include ("dbconnect.php");
if($_POST['nim']){
	$query = "SELECT * FROM mahasiswa,gender,dosen,outline,angkatan,proposal WHERE gender.id_gender = mahasiswa.id_gender AND angkatan.id_angkatan = mahasiswa.id_angkatan AND mahasiswa.nim = outline.nim AND mahasiswa.nim = proposal.nim AND dosen.id_dosen = proposal.dosen1 AND mahasiswa.nim = '".$_POST['nim']."'";
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
                    <td>Judul Karya Tulis</td>
                    <td><?php echo $row['judulproposal']; ?></td>
                </tr>
                <tr>
                    <td>Tanggal Pengajuan Outline</td>
                    <td><?php echo $row['tgl_pengajuan']; ?></td>
                </tr>
                <tr>
                    <td>Tanggal Verifikasi Outline</td>
                    <td><?php echo $row['tgl_disetujui']; ?></td>
                </tr>
                <tr>
                    <td>Dosen Pembimbing 1</td>
                    <td><?php 
                            $sql = "SELECT gelar_depan,nama_dosen,gelar_belakang from dosen,proposal WHERE $row[dosen1] = dosen.id_dosen LIMIT 1";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                echo $path['gelar_depan']." ". $path['nama_dosen']." ".$path['gelar_belakang'];
                            } 
                        ?></td>
                </tr>
                <tr>
                    <td>Dosen Pembimbing 2</td>
                    <td><?php 
                            $sql = "SELECT gelar_depan,nama_dosen,gelar_belakang from dosen,proposal WHERE $row[dosen2] = dosen.id_dosen LIMIT 1";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                echo $path['gelar_depan']." ". $path['nama_dosen']." ".$path['gelar_belakang'];
                            } 
                        ?></td>
                </tr>
                <tr>
                    <td>Dosen Penguji</td>
                    <td><?php 
                            $sql = "SELECT gelar_depan,nama_dosen,gelar_belakang from dosen,proposal WHERE $row[penguji] = dosen.id_dosen LIMIT 1";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                if($path['nama_dosen'] === NULL){
                                    echo "Data belum terverifikasi atau belum mengajukan sidang proposal";   
                                }else{
                                    echo $path['gelar_depan']." ". $path['nama_dosen']." ".$path['gelar_belakang'];
                                }   
                            }
                        ?></td>
                </tr>
            </table>
<?php 
        }
    }
    $conn->close();
?>
