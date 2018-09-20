<?php
@include ("dbconnect.php");
if($_POST['nim']){
	$query = "SELECT * FROM mahasiswa,kti,angkatan,ruangsidang WHERE ruangsidang.id_ruang = kti.ruangsidang AND angkatan.id_angkatan = mahasiswa.id_angkatan AND kti.nim = mahasiswa.nim AND kti.nim = '".$_POST['nim']."'";
	$result = mysqli_query($conn,$query);
	foreach ($result as $row) { 
?>
<!-- display : nim, nama, judul kti, dosen 1,dosen 2, dosen 3, tgl sidang kti,waktu ujian, ruangan ujian, tanggal kumpul berkas, nilai akhir KTi-->
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
                    <td>Judul KTI</td>
                    <td><?php echo $row['judulkti']; ?></td>
                </tr>
                <tr>
                    <td>Tanggal Ujian KTI</td>
                    <td><?php echo $row['tgl_sidangkti']; ?></td>
                </tr>
                <tr>
                    <td>Waktu Pelaksanaan Ujian KTI</td>
                    <td><?php echo $row['waktupelaksanaan']; ?></td>
                </tr>
                <tr>
                    <td>Ruangan Pelaksanaan Ujian KTI</td>
                    <td><?php echo $row['ruangsidang']; ?></td>
                </tr>
                <tr>
                    <td>Dosen Penguji 1</td>
                    <td><?php 
                            $sql = "SELECT gelar_depan,nama_dosen,gelar_belakang from dosen,kti WHERE $row[dosen1] = dosen.id_dosen LIMIT 1";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                echo $path['gelar_depan']." ". $path['nama_dosen']." ".$path['gelar_belakang'];
                            } 
                        ?></td>
                </tr>

                <tr>
                    <td>Nilai Penulisan Isi Penguji 1</td>
                    <td><?php echo $row['penulisanisi1']; ?></td>
                </tr>
                <tr>
                    <td>Nilai Metodologi Penguji 1</td>
                    <td><?php echo $row['metodologi1']; ?></td>
                </tr>
                <tr>
                    <td>Nilai Penguasaan Materi Penguji 1</td>
                    <td><?php echo $row['penguasaanmateri1']; ?></td>
                </tr>
                <tr>
                    <td>Nilai Materi dan Presentasi Penguji 1</td>
                    <td><?php echo $row['presentasi1']; ?></td>
                </tr>
                <tr>
                    <td>Dosen Penguji 2</td>
                    <td><?php 
                            $sql = "SELECT gelar_depan,nama_dosen,gelar_belakang from dosen,kti WHERE $row[dosen2] = dosen.id_dosen LIMIT 1";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                echo $path['gelar_depan']." ". $path['nama_dosen']." ".$path['gelar_belakang'];
                            } 
                        ?></td>
                </tr>

                <tr>
                    <td>Nilai Penulisan Isi Penguji 2</td>
                    <td><?php echo $row['penulisanisi2']; ?></td>
                </tr>
                <tr>
                    <td>Nilai Metodologi Penguji 2</td>
                    <td><?php echo $row['metodologi2']; ?></td>
                </tr>
                <tr>
                    <td>Nilai Penguasaan Materi Penguji 2</td>
                    <td><?php echo $row['penguasaanmateri2']; ?></td>
                </tr>
                <tr>
                    <td>Nilai Materi dan Presentasi Penguji 2</td>
                    <td><?php echo $row['presentasi2']; ?></td>
                </tr>

                <tr>
                    <td>Dosen Penguji 3</td>
                    <td><?php 
                            $sql = "SELECT gelar_depan,nama_dosen,gelar_belakang from dosen,kti WHERE $row[penguji] = dosen.id_dosen LIMIT 1";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                echo $path['gelar_depan']." ". $path['nama_dosen']." ".$path['gelar_belakang'];
                            } 
                        ?></td>
                </tr>

                <tr>
                    <td>Nilai Penulisan Isi Penguji 3</td>
                    <td><?php echo $row['penulisanisi3']; ?></td>
                </tr>
                <tr>
                    <td>Nilai Metodologi Penguji 3</td>
                    <td><?php echo $row['metodologi3']; ?></td>
                </tr>
                <tr>
                    <td>Nilai Penguasaan Materi Penguji 3</td>
                    <td><?php echo $row['penguasaanmateri3']; ?></td>
                </tr>
                <tr>
                    <td>Nilai Materi dan Presentasi Penguji 3</td>
                    <td><?php echo $row['presentasi3']; ?></td>
                </tr>

                <tr>
                    <td>Batas Pengumpulan KTI</td>
                    <td><?php echo $row['batas_pengumpulan']; ?></td>
                </tr>
                <tr>
                    <td>Tanggal Pengumpulan KTI</td>
                    <td><?php echo $row['tgl_kumpul']; ?></td>
                </tr>
                <tr>
                    <td>Nilai Akhir Penulisan Isi</td>
                    <td><?php echo $row['penulisanisi']; ?></td>
                </tr>
                <tr>
                    <td>Nilai Akhir Metodologi</td>
                    <td><?php echo $row['metodologi']; ?></td>
                </tr>
                <tr>
                    <td>Nilai Akhir Penguasaan Materi</td>
                    <td><?php echo $row['penguasaanmateri']; ?></td>
                </tr>
                <tr>
                    <td>Nilai Akhir Materi dan Presentasi</td>
                    <td><?php echo $row['materidanpresentasi']; ?></td>
                </tr>
                <tr>
                    <td>Nilai Akhir KTI</td>
                    <td><?php echo $row['nilaiakhir']; ?></td>
                </tr>
                <tr>
                    <td>Nilai Akhir KTI (HURUF)</td>
                    <td><?php echo $row['nilaiakhirhuruf']; ?></td>
                </tr>
            </table>
<?php 
        }
    }
    $conn->close();
?>
