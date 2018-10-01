<?php
@include ("dbconnect.php");
if($_POST['nim']){
	$query = "SELECT * FROM mahasiswa,proposal WHERE  proposal.nim = '".$_POST['nim']."' AND mahasiswa.nim = '".$_POST['nim']."'";
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
                    <td>Judul Outline</td>
                    <td><?php 
                            $sql = "SELECT judulproposal from proposal WHERE $row[nim] = proposal.nim";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                echo $path['judulproposal'];
                            } 
                        ?></td>
                <tr>
                    <td>Judul Proposal</td>
                    <td><?php 
                            $sql = "SELECT judul_outline from outline WHERE $row[nim] = outline.nim";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                echo $path['judul_outline'];
                            } 
                        ?></td>
                </tr>
                <tr>
                    <td>Judul Seminar Hasil</td>
                    <td><?php 
                            $sql = "SELECT judulKTI from semhas WHERE $row[nim] = semhas.nim";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                echo $path['judulKTI'];
                            } 
                        ?></td>
                </tr>
                 <tr>
                    <td>Judul KTI</td>
                    <td><?php 
                            $sql = "SELECT judulkti from kti WHERE $row[nim] = kti.nim";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                echo $path['judulkti'];
                            } 
                        ?></td>
                </tr>
                <tr>
                    <td>Tanggal Pengajuan Outline</td>
                    <td><?php 
                            $sql = "SELECT tgl_pengajuan from outline WHERE $row[nim] = outline.nim";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                echo $path['tgl_pengajuan'];
                            } 
                        ?></td>
                </tr>
                <tr>
                    <td>Tanggal Verifikasi Outline</td>
                    <td><?php 
                            $sql = "SELECT tgl_disetujui from outline WHERE $row[nim] = outline.nim";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                echo $path['tgl_disetujui'];
                            } 
                        ?>
                </tr>
                <tr>
                    <td>Dosen Pembimbing 1</td>
                    <td><?php 
                            $sql = "SELECT gelar_depan,nama_dosen,gelar_belakang from dosen,sk1 WHERE sk1.id_dosen1 = dosen.id_dosen AND $row[nim] = sk1.nim";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                echo $path['gelar_depan']." ". $path['nama_dosen']." ".$path['gelar_belakang'];
                            } 
                        ?></td>
                </tr>
                <tr>
                    <td>Dosen Pembimbing 2</td>
                    <td><?php 
                            $sql = "SELECT gelar_depan,nama_dosen,gelar_belakang from dosen,sk2 WHERE sk2.id_dosen2 = dosen.id_dosen AND $row[nim] = sk2.nim LIMIT 1";
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
                <tr>
                    <td>Tanggal Seminar Proposal</td>
                    <td><?php 
                            $sql = "SELECT tgl_sidangproposal from proposal WHERE $row[nim] = proposal.nim";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                echo $path['tgl_sidangproposal'];
                            } 
                        ?></td>
                </tr>
                <tr>
                    <td>Tanggal Seminar Hasil</td>
                    <td><?php 
                            $sql = "SELECT tgl_seminarhasil from semhas WHERE $row[nim] = semhas.nim";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                echo $path['tgl_seminarhasil'];
                            } 
                        ?></td>
                </tr>
                <tr>
                    <td>Tanggal Ujian KTI</td>
                    <td><?php 
                            $sql = "SELECT tgl_sidangkti from kti WHERE $row[nim] = kti.nim";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                echo $path['tgl_sidangkti'];
                            } 
                        ?></td>
                </tr>
                <tr>
                    <td>Batas Kumpul Berkas</td>
                    <td><?php 
                            $sql = "SELECT batas_pengumpulan from kti WHERE $row[nim] = kti.nim";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                echo $path['batas_pengumpulan'];
                            } 
                        ?></td>
                </tr>
                <tr>
                    <td>Tanggal Kumpul Berkas</td>
                    <td><?php 
                            $sql = "SELECT tgl_kumpul from kti WHERE $row[nim] = kti.nim";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                echo $path['tgl_kumpul'];
                            } 
                        ?></td>
                </tr>
                <tr>
                    <td>Nilai KTI (Angka)</td>
                    <td><?php 
                            $sql = "SELECT nilaiakhir from kti WHERE $row[nim] = kti.nim";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                echo $path['nilaiakhir'];
                            } 
                        ?></td>
                </tr>
                <tr>
                    <td>Nilai KTI (Huruf)</td>
                    <td><?php 
                            $sql = "SELECT nilaiakhirhuruf from kti WHERE $row[nim] = kti.nim";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                echo $path['nilaiakhirhuruf'];
                            } 
                        ?></td>
                </tr>
            </table>
<?php 
        }
    }
    $conn->close();
?>
