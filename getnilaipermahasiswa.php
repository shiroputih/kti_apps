<?php
@include ("dbconnect.php");
if($_POST['nim']){
    $sql = "SELECT * FROM dosen,mahasiswa, nilai_perdosen,assign_sk WHERE assign_sk.id_dosen = nilai_perdosen.id_dosen AND dosen.id_dosen = nilai_perdosen.id_dosen AND mahasiswa.nim = nilai_perdosen.nim AND assign_sk.nim = '".$_POST['nim']."' AND nilai_perdosen.nim = '".$_POST['nim']."' LIMIt 0,1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            ?>
            <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                <tr>
                    <td width="25%">Nim</td>
                    <td><?= $row['nim'];?></td>
                </tr>
                <tr>
                    <td>Nama Mahasiswa</td>
                    <td><?= $row['nama'];?></td>
                </tr>
            </table>
<?php
        }
    }
}

if($_POST['nim']){
        $sql = "SELECT * FROM dosen,mahasiswa, nilai_perdosen,assign_sk WHERE assign_sk.id_dosen = nilai_perdosen.id_dosen AND dosen.id_dosen = nilai_perdosen.id_dosen AND mahasiswa.nim = nilai_perdosen.nim AND assign_sk.nim = '".$_POST['nim']."' AND nilai_perdosen.nim = '".$_POST['nim']."'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
?>
            <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                <tr>
                    <td width="20%">Dosen </td>
                    <th><?=$row['assign_dosen']?></th>
                </tr>
                <tr>
                    <td width="20%">Dosen Penguji</td></td>
                    <td  colspan="4"><?= $row['gelar_depan']." ".$row['nama_dosen']." ".$row['gelar_belakang'];?></td>
                </tr>
                <tr>
                    <th width="20%">Nilai Penulisan Isi</th>
                    <th width="20%">Nilai Metodologi</th>
                    <th width="20%">Nilai Penguasaan Materi</th>
                    <th width="20%">Nilai Presentasi</th>
                </tr>
                <tr>
                    <td><?=$row['nilai_perdosen_isi']; ?></td>
                    <td><?=$row['nilai_perdosen_metode']; ?></td>
                    <td><?=$row['nilai_perdosen_materi']; ?></td>
                    <td><?=$row['nilai_perdosen_presentasi']; ?></td>
                </tr>
            </table>
            <?php
            }
        }
    }
?>

