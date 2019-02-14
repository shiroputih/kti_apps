<table class="table table-hover" id="dataTable3" width="100%" cellspacing="0">
            <thead>
				<tr>
				    <th width="5%">No</th>
					<th width="15%">Nim</th>
					<th width="30%">Nama Mahasiswa</th>
					<th>Berkas Proposal</th>
				</tr>
			</thead>
<?php
@include ("dbconnect.php");
$no=1;
if(isset($_POST['idsemester'])){
    $sql = "SELECT * FROM semhas
    JOIN mahasiswa ON mahasiswa.nim = semhas.nim
    WHERE semhas.idsemester = '".$_POST['idsemester']."'
    AND semhas.status_semhas = 'Lolos'
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
                    <td><a href=<?=$row['file_semhas'];?> target='_blank'><img src='icons/pdficon.png' width='30px' height='30px'></a>
                </tr>
<?php
    $no++;
        }
    }
}
?>

<?php
if(isset($_POST['nim'])){
    $sql = "SELECT * FROM semhas
    JOIN mahasiswa ON mahasiswa.nim = semhas.nim
    WHERE semhas.nim = '".$_POST['nim']."'
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
                    <td><a href=<?=$row['file_semhas'];?> target='_blank'><img src='icons/pdficon.png' width='30px' height='30px'></a></td>
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