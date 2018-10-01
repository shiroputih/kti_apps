<?php
@include ("dbconnect.php");
if($_POST['iddosen']){
    $sql = "SELECT * FROM dosen,sk WHERE sk.id_semestersk = '".$_POST['idsemester']."' AND dosen.id_dosen = '".$_POST['iddosen']."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
?>
            <!-- display : nim, nama, judul kti, dosen 1,dosen 2, dosen 3, tgl sidang kti,waktu ujian, ruangan ujian, tanggal kumpul berkas, nilai akhir KTi-->
            <table  class="table table-hover">
                <tr>
                    <td colspan ="2">Nama Dosen</td>
                    <td colspan="5"><?php echo $row['gelar_depan']." ".$row['nama_dosen']." ".$row['gelar_belakang']; ?></td>
                </tr>
                <tr>
                    <td colspan="6"><b>Mahasiswa Bimbingan 1</b></td>
                </tr>
                <tr>
                    <td>#</td>
                    <td width="15%">Nim Mahasiswa</td>
                    <td width="35%">Nama Mahasiswa</td>
                    <td width="18%">Tanggal Proposal</td>
                    <td width="18%">Tanggal Seminar Hasil</td>
                    <td width="20%">Tanggal Ujian KTI</td>
                </tr>    
                        <?php
                        $no = 1;
                        $sql = "SELECT * from mahasiswa,sk1 where mahasiswa.nim = sk1.nim AND sk1.id_dosen1 = $_POST[iddosen] AND sk1.id_semester = $_POST[idsemester]";
                        $result = mysqli_query($conn,$sql);
                        foreach ($result as $path) {
                            echo "
                            <tr>
                                <td>$no</td>
                                <td> $path[nim] </td>    
                                <td> $path[nama] </td>              
                            </tr>";
                            $no ++;
                        } 
                        ?>
                </table>
                <hr>
                <table  class="table table-hover">
                <tr>
                    <td colspan="6"><b>Mahasiswa Bimbingan 2</b></td>
                </tr>
                <tr>
                    <td>#</td>
                    <td width="15%">Nim Mahasiswa</td>
                    <td width="35%">Nama Mahasiswa</td>
                    <td width="18%">Tanggal Proposal</td>
                    <td width="18%">Tanggal Seminar Hasil</td>
                    <td width="20%">Tanggal Ujian KTI</td>
                </tr>    
                        <?php
                        $no = 1;
                        $sql = "SELECT * from mahasiswa,sk2 where mahasiswa.nim = sk2.nim AND sk2.id_dosen2= $_POST[iddosen] AND sk2.id_semester = $_POST[idsemester]";
                        $result = mysqli_query($conn,$sql);
                        foreach ($result as $path) {
                            echo "
                            <tr>
                                <td>$no</td>
                                <td> $path[nim] </td>    
                                <td> $path[nama] </td>              
                            </tr>";
                            $no ++;
                        } 
                        ?>
                </table>
                <?php 
            }
        }
    }
        $conn->close();
        ?>
