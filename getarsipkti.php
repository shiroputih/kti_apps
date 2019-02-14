<table class="table table-hover" id="dataTable1" width="100%" cellspacing="0">
            <thead>
				<tr>
				    <th width="5%">No</th>
					<th width="15%">Nim</th>
					<th width="30%">Nama Mahasiswa</th>
					<th>Berkas Karya Tulis Ilmiah</th>
				</tr>
			</thead>
<?php
@include ("dbconnect.php");
$no=1;
if(isset($_POST['idsemester'])){
    $sql = "SELECT * FROM kti
    JOIN mahasiswa ON mahasiswa.nim = kti.nim
    WHERE kti.idsemester = '".$_POST['idsemester']."'
    AND kti.status_kti = 'Lolos'
    GROUP BY mahasiswa.nim
    ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            ?>
                <tr>
                    <td width="5%"><?= $no;?></td>
                    <td><?=$row['nim'];?></td>
                    <td><?=$row['nama'];?></td>
                    <td><a href=<?=$row['file_kti'];?> target='_blank'><img src='icons/pdficon.png' width='30px' height='30px'></a>
                </tr>
<?php
    $no++;
        }
    }
}
?>

<?php
if(isset($_POST['nim'])){
    $sql = "SELECT * FROM kti
    JOIN mahasiswa ON mahasiswa.nim = kti.nim
    WHERE kti.nim = '".$_POST['nim']."'
    GROUP BY mahasiswa.nim
    ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            ?>
                <tr>
                    <td width="5%"><?= $no;?></td>
                    <td><?=$row['nim'];?></td>
                    <td><?=$row['nama'];?></td>
                    <td><a href=<?=$row['file_kti'];?> target='_blank'><img src='icons/pdficon.png' width='30px' height='30px'></a></td>
                </tr>

<?php
    $no++;
        }
    }
}
?>

</table>

    <!-- Bootstrap core JavaScript
    <script src="vendor/jquery/jquery.min.js"></script>-->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>