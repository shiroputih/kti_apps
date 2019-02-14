<?php
@include ("dbconnect.php");
if($_POST['nim']){
	$query = "SELECT * FROM kti
    JOIN mahasiswa ON mahasiswa.nim = kti.nim
    WHERE  kti.nim = '".$_POST['nim']."'";
	$result = mysqli_query($conn,$query);
	foreach ($result as $row) { 
?>
<!-- display : nim, nama, judul kti, dosen 1,dosen 2, dosen 3, tgl sidang kti,waktu ujian, ruangan ujian, tanggal kumpul berkas, nilai akhir KTi-->
            <table class="table">
                <tr>
                    <td width="10%">Nim</td>
                    <td  colspan="7"><?php echo $row['nim']; ?></td>
                </tr>
                <tr>
                    <td>Nama Mahasiswa</td>
                    <td  colspan="7"><?php 
                            $sql = "SELECT nama from mahasiswa WHERE $row[nim] = mahasiswa.nim";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                echo $path['nama'];
                            } 
                        ?></td>
                </tr>
                <tr>
                    <td>Judul KTI</td>
                    <td  colspan="7"    ><?php echo $row['judul_penelitian']; ?></td>
                </tr>
                <tr>
                    <td width="15%">No. Ujian KTI</td>
                    <td>Tanggal Ujian KTI</td>
                    <td>Waktu Pelaksanaan Ujian KTI</td>
                    <td width="30%">Ruang Ujian KTI</td>
                    <td>Status Ujian KTI</td>
                </tr>
                </table>
                <?php 
        }
    }
?>

    <table class="table"> 
<?php
if($_POST['nim']){
    $no = 1;
	$query = " SELECT * FROM kti,ruangsidang WHERE kti.id_ruangsidang = ruangsidang.id_ruang AND kti.nim = '".$_POST['nim']."'";
	$result = $conn->query($query);
    if ($result->num_rows > 0) {
        while ($path = $result->fetch_assoc()) {
?>
             
            <tr>
                <td  width="15%">
                    <?php echo $no; ?>
                </td>
                <td width="15%">
                <?php 
                    echo $path['tgl_ujiankti'];
                ?>
                </td>
                <td width="25%">
                <?php 
                    echo $path['waktupelaksanaan'];
                ?>
                </td>
                <td width="30%">
                <?php 
                    echo $path['ruangsidang'];
                ?>
                </td>
                <td>
                <?php 
                    echo $path['status_kti'];
                ?>
                </td>
            </tr>
            <?php 
            $no++;
        }
    }
}
?>
</table>

<?php
$conn->close();
?>
