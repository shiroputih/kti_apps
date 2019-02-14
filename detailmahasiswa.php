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
                            $sql = "SELECT judul_penelitian from semhas WHERE $row[nim] = semhas.nim";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($path = $result->fetch_assoc()) {
                                    echo $path['judul_penelitian'];
                                }
                            } else{
                                echo "belum seminar hasil";
                            }
                        ?></td>
                </tr>
                 <tr>
                    <td>Judul KTI</td>
                    <td><?php
                            $sql = "SELECT judul_penelitian from kti WHERE $row[nim] = kti.nim ";
                            $result = mysqli_query($conn,$sql);
                            if ($result->num_rows > 0) {
                                while ($path = $result->fetch_assoc()) {
                                    echo $path['judul_penelitian'];
                                }
                            } else{
                                echo "-";
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
                            $sql = "SELECT gelar_depan,nama_dosen,gelar_belakang from dosen,assign_sk WHERE assign_sk.id_dosen = dosen.id_dosen
                            AND assign_sk.assign_dosen = 'pembimbing 1'
                            AND $row[nim] = assign_sk.nim";
                            $result = mysqli_query($conn,$sql);
                            if ($result->num_rows > 0) {
                                while ($path = $result->fetch_assoc()) {
                                    echo $path['gelar_depan']." ". $path['nama_dosen']." ".$path['gelar_belakang'];
                                }
                            } else{
                                echo "-";
                            }

                        ?></td>
                </tr>
                <tr>
                    <td>Dosen Pembimbing 2</td>
                    <td><?php
                            $sql = "SELECT gelar_depan,nama_dosen,gelar_belakang from dosen,assign_sk WHERE assign_sk.id_dosen = dosen.id_dosen
                            AND assign_sk.assign_dosen = 'pembimbing 2'
                            AND $row[nim] = assign_sk.nim";
                            $result = mysqli_query($conn,$sql);
                            if ($result->num_rows > 0) {
                                while ($path = $result->fetch_assoc()) {
                                    echo $path['gelar_depan']." ". $path['nama_dosen']." ".$path['gelar_belakang'];
                                }
                            } else{
                                echo "-";
                            }

                        ?></td>
                </tr>
                <tr>
                    <td>Dosen Penguji</td>
                    <td><?php
                            $sql = "SELECT gelar_depan,nama_dosen,gelar_belakang from dosen,assign_sk WHERE assign_sk.id_dosen = dosen.id_dosen
                            AND assign_sk.assign_dosen = 'penguji'
                            AND $row[nim] = assign_sk.nim";
                            $result = mysqli_query($conn,$sql);
                            if ($result->num_rows > 0) {
                                while ($path = $result->fetch_assoc()) {
                                    echo $path['gelar_depan']." ". $path['nama_dosen']." ".$path['gelar_belakang'];
                                }
                            } else{
                                echo "-";
                            }

                        ?></td>
                </tr>
                <tr>
                    <td>Tanggal Seminar Proposal</td>
                    <td><?php
                            $sql = "SELECT tgl_sidangproposal from proposal WHERE $row[nim] = proposal.nim";
                            $result = mysqli_query($conn,$sql);
                            $result = mysqli_query($conn,$sql);
                            if ($result->num_rows > 0) {
                                while ($path = $result->fetch_assoc()) {
                                    echo $path['tgl_sidangproposal'];
                                }
                            } else{
                                echo "-";
                            }
                        ?></td>
                </tr>
                <tr>
                    <td>Tanggal Seminar Hasil</td>
                    <td><?php
                            $sql = "SELECT tgl_seminarhasil from semhas WHERE $row[nim] = semhas.nim";
                            $result = mysqli_query($conn,$sql);
                            if ($result->num_rows > 0) {
                                while ($path = $result->fetch_assoc()) {
                                    echo $path['tgl_seminarhasil'];
                                }
                            } else{
                                echo "-";
                            }
                        ?></td>
                </tr>
                <tr>
                    <td>Tanggal Ujian KTI</td>
                    <td><?php
                            $sql = "SELECT tgl_ujiankti from kti WHERE $row[nim] = kti.nim GROUP BY kti.nim";
                            $result = mysqli_query($conn,$sql);
                            if ($result->num_rows > 0) {
                                while ($path = $result->fetch_assoc()) {
                                    echo $path['tgl_ujiankti'];
                                }
                            } else{
                                echo "-";
                            }
                        ?></td>
                </tr>
                <tr>
                    <td>Batas Kumpul Berkas</td>
                    <td><?php
                            $sql = "SELECT batas_kumpulberkas from batas_waktu WHERE $row[nim] = batas_waktu.nim";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                echo $path['batas_kumpulberkas'];
                            }
                        ?></td>
                </tr>
                <tr>
                    <td>Tanggal Kumpul Berkas</td>
                    <td><?php
                            $sql = "SELECT tgl_kumpulberkas from kumpul_berkas WHERE $row[nim] = kumpul_berkas.nim";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                echo $path['tgl_kumpulberkas'];
                            }
                        ?></td>
                </tr>
                <tr>
                    <td>Nilai KTI (Angka)</td>
                    <td><?php
                            $sql = "SELECT nilai_angka_final from nilai_akhir WHERE $row[nim] = nilai_akhir.nim";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                echo $path['nilai_angka_final'];
                            }
                        ?></td>
                </tr>
                <tr>
                    <td>Nilai KTI (Huruf)</td>
                    <td><?php
                            $sql = "SELECT nilai_huruf from nilai_akhir WHERE $row[nim] = nilai_akhir.nim";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                echo $path['nilai_huruf'];
                            }
                        ?></td>
                </tr>
            </table>
<?php
        }
    }
    $conn->close();
?>
