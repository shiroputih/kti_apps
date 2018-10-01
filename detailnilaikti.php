<?php
@include ("dbconnect.php");
if($_POST['nim']){
	$query = "SELECT * FROM kti 
                WHERE kti.nim = '".$_POST['nim']."'";
	$result = mysqli_query($conn,$query);
	foreach ($result as $row) { 
?>
<body>
    <form method="POST">
            <table class="table" width="100%">
                <tr>
                    <td width="25%">Nim</td>
                    <td colspan="3"><?php echo $row['nim']; ?></td>
                </tr>
                <tr>
                    <td>Nama Mahasiswa</td>
                    <td colspan="3"><?php 
                            $sql = "SELECT nama from mahasiswa WHERE $row[nim] = mahasiswa.nim";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                echo $path['nama'];
                            } 
                        ?></td>
                </tr>
                <tr style="background-color: #818b70;">
                    <td>Dosen Penguji 1</td>
                    <td colspan="3"><?php 
                            $sql = "SELECT gelar_depan,nama_dosen,gelar_belakang from dosen,proposal WHERE $row[dosen1] = dosen.id_dosen LIMIT 1";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                echo $path['gelar_depan']." ". $path['nama_dosen']." ".$path['gelar_belakang'];
                            } 
                        ?></td>
                </tr>
                <tr>
                    <td>Penulisan Isi</td>
                    <td>Metodologi</td>
                    <td>Penguasaan Materi</td>
                    <td>Materi dan Presentasi</td>
                </tr>
                <tr>
                    <td><?php 
                            $sql = "SELECT penulisanisi1 FROM kti WHERE $row[nim] = kti.nim";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                $penulisanisidosen1 = $path['penulisanisi1'];
                                echo $path['penulisanisi1'];
                            } 
                        ?></td>
                    <td><?php 
                            $sql = "SELECT metodologi1 FROM kti WHERE $row[nim] = kti.nim";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                $metodologidosen1 = $path['metodologi1'];
                                echo $path['metodologi1'];
                            } 
                        ?></td>
                        <td><?php 
                            $sql = "SELECT penguasaanmateri1 FROM kti WHERE $row[nim] = kti.nim";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                $penguasaanmateridosen1 = $path['penguasaanmateri1'];
                                echo $path['penguasaanmateri1'];
                            } 
                        ?></td>
                        <td><?php 
                            $sql = "SELECT presentasi1 FROM kti WHERE $row[nim] = kti.nim";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                $materidanpresentasidosen1 = $path['presentasi1'];
                                echo $path['presentasi1'];
                            } 
                        ?></td>
                </tr>
                <tr style="background-color: #818b70;">
                    <td>Dosen Penguji 2</td>
                    <td colspan="3"><?php 
                            $sql = "SELECT gelar_depan,nama_dosen,gelar_belakang from dosen,proposal WHERE $row[dosen2] = dosen.id_dosen LIMIT 1";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                echo $path['gelar_depan']." ". $path['nama_dosen']." ".$path['gelar_belakang'];
                            } 
                        ?></td>
                </tr>
                <tr>
                    <td>Penulisan Isi</td>
                    <td>Metodologi</td>
                    <td>Penguasaan Materi</td>
                    <td>Materi dan Presentasi</td>
                </tr>
                <tr>
                    <td><?php 
                            $sql = "SELECT penulisanisi2 FROM kti WHERE $row[nim] = kti.nim";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                $penulisanisidosen2 = $path['penulisanisi2'];
                                echo $path['penulisanisi2'];
                            } 
                        ?></td>
                    <td><?php 
                            $sql = "SELECT metodologi2 FROM kti WHERE $row[nim] = kti.nim";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                $metodologidosen2 = $path['metodologi2'];
                                echo $path['metodologi2'];
                            } 
                        ?></td>
                        <td><?php 
                            $sql = "SELECT penguasaanmateri2 FROM kti WHERE $row[nim] = kti.nim";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                $penguasaanmateridosen2 = $path['penguasaanmateri2'];
                                echo $path['penguasaanmateri2'];
                            } 
                        ?></td>
                        <td><?php 
                            $sql = "SELECT presentasi2 FROM kti WHERE $row[nim] = kti.nim";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                $materidanpresentasidosen2 = $path['presentasi2'];
                                echo $path['presentasi2'];
                            } 
                        ?></td>
                </tr>
                <tr style="background-color: #818b70;">
                    <td>Dosen Penguji 3</td>
                    <td colspan="3"><?php 
                            $sql = "SELECT gelar_depan,nama_dosen,gelar_belakang from dosen,proposal WHERE $row[penguji] = dosen.id_dosen LIMIT 1";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                echo $path['gelar_depan']." ". $path['nama_dosen']." ".$path['gelar_belakang'];
                            } 
                        ?></td>
                </tr>
                <tr>
                    <td>Penulisan Isi</td>
                    <td>Metodologi</td>
                    <td>Penguasaan Materi</td>
                    <td>Materi dan Presentasi</td>
                </tr>
                <tr>
                    <td><?php 
                            $sql = "SELECT penulisanisi3 FROM kti WHERE $row[nim] = kti.nim";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                $penulisanisidosen3 = $path['penulisanisi3'];
                                echo $path['penulisanisi3'];
                            } 
                        ?></td>
                    <td><?php 
                            $sql = "SELECT metodologi3 FROM kti WHERE $row[nim] = kti.nim";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                $metodologidosen3 = $path['metodologi3'];
                                echo $path['metodologi3'];
                            } 
                        ?></td>
                        <td><?php 
                            $sql = "SELECT penguasaanmateri3 FROM kti WHERE $row[nim] = kti.nim";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                $penguasaanmateridosen3 = $path['penguasaanmateri3'];
                                echo $path['penguasaanmateri3'];
                            } 
                        ?></td>
                        <td><?php 
                            $sql = "SELECT presentasi3 FROM kti WHERE $row[nim] = kti.nim";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                $materidanpresentasidosen3 = $path['presentasi3'];
                                echo $path['presentasi3'];
                            } 
                        ?></td>
                </tr>

                <tr style="background-color:#ff0000;">
                    <td colspan="4">Nilai Akhir</td>
                </tr>
                <tr>
                    <td>Penulisan Isi</td>
                    <td>Metodologi</td>
                    <td>Penguasaan Materi</td>
                    <td>Materi dan Presentasi</td>
                </tr>
                <tr>
                    <td>
                        <?php 
                            $sql = "SELECT penulisanisi FROM kti WHERE $row[nim] = kti.nim";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                echo $path['penulisanisi'];
                            } 
                        ?>  
                    </td>
                    <td><?php 
                            $sql = "SELECT metodologi FROM kti WHERE $row[nim] = kti.nim";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                echo $path['metodologi'];
                            } 
                        ?>  
                    </td>
                    <td><?php 
                            $sql = "SELECT penguasaanmateri FROM kti WHERE $row[nim] = kti.nim";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                echo $path['penguasaanmateri'];
                            } 
                        ?>  
                    </td>
                    <td><?php 
                            $sql = "SELECT materidanpresentasi FROM kti WHERE $row[nim] = kti.nim";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                echo $path['materidanpresentasi'];
                            } 
                        ?>     
                    </td>
                </tr>
                <tr>
                    <td> Nilai Akhir Angka <td>
                    <td> <?php 
                            $sql = "SELECT nilaiakhir FROM kti WHERE $row[nim] = kti.nim";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                echo $path['nilaiakhir'];
                            } 
                        ?> 
                     <td>
                </tr>
                <tr>
                    <td> Nilai Akhir Huruf <td>
                    <td> <?php 
                            $sql = "SELECT nilaiakhirhuruf FROM kti WHERE $row[nim] = kti.nim";
                            $result = mysqli_query($conn,$sql);
                            foreach ($result as $path) {
                                echo $path['nilaiakhirhuruf'];
                            } 
                        ?>  <td>
                </tr>
            </table>
           
    </form>
</body>

<?php
    }
}
$conn->close();
?>