<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
            <thead>
				<tr>
				    <th width="5%">No</th>
					<th width="15%">Nim</th>
					<th width="30%">Nama Mahasiswa</th>
					<th>Semester</th>
                    <th>Proposal</th>
                    <th>Seminar Hasil</th>
                    <th>KTI</th>
				</tr>
				</thead>
<?php
@include ("dbconnect.php");
$no=1;
if($_POST['iddosen']){
    $sql = "SELECT *,mahasiswa.nim FROM assign_sk
    JOIN mahasiswa ON mahasiswa.nim = assign_sk.nim
    JOIN dosen ON dosen.id_dosen = assign_sk.id_dosen
    JOIN semester ON semester.id_semester = assign_sk.id_semester
    LEFT JOIN proposal ON assign_sk.nim = proposal.nim
    LEFT JOIN semhas ON assign_sk.nim = semhas.nim
    LEFT JOIN kti ON assign_sk.nim = kti.nim
    WHERE assign_sk.id_dosen = dosen.id_dosen
    AND assign_sk.id_semester = semester.id_semester
    AND assign_sk.assign_dosen='pembimbing 1'
    AND assign_sk.id_dosen = '".$_POST['iddosen']."' GROUP BY mahasiswa.nim";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            ?>
                <tr>
                    <td width="5%"><?= $no;?></td>
                    <td><?=$row['nim'];?></td>
                    <td><?=$row['nama'];?></td>
                    <td><?=$row['semester'];?></td>
                    <td><?=$row['tgl_sidangproposal'];?></td>
                    <td><?=$row['tgl_seminarhasil'];?></td>
                    <td><?=$row['tgl_ujiankti'];?></td>
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