<?php
@include ("dbconnect.php");
if($_POST['iddosen']){
    $sql = "SELECT * FROM dosen,assign_sk
    WHERE assign_sk.id_tahunajaran = '".$_POST['idtahunajaran']."'
    AND dosen.id_dosen = '".$_POST['iddosen']."'
    ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
?>
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
                        $sql = "SELECT * from mahasiswa,assign_sk where mahasiswa.nim = assign_sk.nim AND assign_sk.assign_dosen = 'pembimbing 1' AND assign_sk.id_dosen = $_POST[iddosen] AND assign_sk.id_tahunajaran = $_POST[idtahunajaran]";
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
                        $sql = "SELECT * from mahasiswa,assign_sk where mahasiswa.nim = assign_sk.nim AND assign_sk.assign_dosen = 'pembimbing 2' AND assign_sk.id_dosen= $_POST[iddosen] AND assign_sk.id_tahunajaran = $_POST[idtahunajaran]";
                        $result = mysqli_query($conn,$sql);
                        foreach ($result as $path) {
                            echo "
                            <tr>
                                <td>$no</td>
                                <td>$path[nim] </td>
                                <td>$path[nama] </td>
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
