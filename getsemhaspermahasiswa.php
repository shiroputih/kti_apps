<?php
@include ("dbconnect.php");

if($_POST['nim']){
	$query = "SELECT * FROM mahasiswa,semhas,proposal WHERE  proposal.nim = semhas.nim AND semhas.nim = '".$_POST['nim']."' AND mahasiswa.nim = '".$_POST['nim']."' LIMIT 1";
	$result = mysqli_query($conn,$query);
	foreach ($result as $row) { 
?>
            <table class="table" >
                <tr>
                    <td width="15%">Nim</td>
                    <td colspan="7"><?php echo $row['nim']; ?></td>
                </tr>
                <tr>
                    <td>Nama Mahasiswa</td>
                    <td colspan="7"><?php echo $row['nama']; ?></td>
                </tr>
                <tr>
                    <td>Judul Penelitian</td>
                    <td colspan="7"><?php 
                            $sql = "SELECT judul_penelitian from semhas WHERE $row[nim] = semhas.nim";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                echo $path['judul_penelitian'];
                            } 
                        ?></td>
                </tr>
                <tr>
                    <td>Dosen Pembimbing 1</td>
                    <td colspan="7"><?php 
                            $sql = "SELECT gelar_depan,nama_dosen,gelar_belakang from dosen,assign_sk WHERE assign_sk.id_dosen = dosen.id_dosen AND assign_sk.assign_dosen = 'pembimbing 1'AND $row[nim] = assign_sk.nim";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                echo $path['gelar_depan']." ". $path['nama_dosen']." ".$path['gelar_belakang'];
                            } 
                        ?></td>
                </tr>
                <tr>
                    <td>Dosen Pembimbing 2</td>
                    <td colspan="7">  <?php 
                            $sql = "SELECT gelar_depan,nama_dosen,gelar_belakang from dosen,assign_sk WHERE assign_sk.id_dosen = dosen.id_dosen AND assign_sk.assign_dosen = 'pembimbing 2'AND $row[nim] = assign_sk.nim";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                echo $path['gelar_depan']." ". $path['nama_dosen']." ".$path['gelar_belakang'];
                            } 
                        ?></td>
                </tr>
                <tr>
                    <td>Dosen Penguji</td>
                    <td colspan="7"><?php 
                            $sql = "SELECT gelar_depan,nama_dosen,gelar_belakang from dosen,assign_sk WHERE assign_sk.id_dosen = dosen.id_dosen AND assign_sk.assign_dosen = 'penguji'AND $row[nim] = assign_sk.nim";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                if($path['nama_dosen'] === NULL){
                                    echo "-";   
                                }else{
                                    echo $path['gelar_depan']." ". $path['nama_dosen']." ".$path['gelar_belakang'];
                                }   
                            }
                        ?></td>
                </tr>
                <tr>
                    <td>Tanggal Seminar Proposal</td>
                    <td colspan="7"><?php 
                            $sql = "SELECT tgl_sidangproposal from proposal WHERE $row[nim] = proposal.nim";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                echo $path['tgl_sidangproposal'];
                            } 
                        ?></td>
                </tr>
                <tr>
                    <td width="15%">No. Seminar Hasil</td>
                    <td>Tanggal Seminar Hasil</td>
                    <td>Waktu Pelaksanaan Seminar Hasil</td>
                    <td width="30%">Ruang Seminar Hasil</td>
                    <td>Status Seminar Hasil</td>
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
	$query = " SELECT * FROM semhas,ruangsidang WHERE semhas.id_ruangsidang = ruangsidang.id_ruang AND semhas.nim = '".$_POST['nim']."'";
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
                    echo $path['tgl_seminarhasil'];
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
                    echo $path['status_semhas'];
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

