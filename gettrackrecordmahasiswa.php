<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
            <thead>
				<tr>
				    <th width="5%">No</th>
					<th width="15%">Nim</th>
					<th width="30%">Nama Mahasiswa</th>
					<th>Proposal</th>
                    <th>Seminar Hasil</th>
                    <th>KTI</th>
				</tr>
				</thead>
<?php
@include ("dbconnect.php");
$no=1;
if(isset($_POST['idsemester'])){
    $sql = "SELECT * FROM proposal
    JOIN mahasiswa ON mahasiswa.nim = proposal.nim
    JOIN semhas ON mahasiswa.nim = semhas.nim
    JOIN kti ON mahasiswa.nim = kti.nim
    WHERE proposal.id_semester = '".$_POST['idsemester']."'
    OR semhas.idsemester = '".$_POST['idsemester']."'
    OR kti.idsemester = '".$_POST['idsemester']."'

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

<?php
if(isset($_POST['nim'])){
    $sql = "SELECT * FROM proposal
    JOIN mahasiswa ON mahasiswa.nim = proposal.nim
    JOIN semhas ON mahasiswa.nim = semhas.nim
    JOIN kti ON mahasiswa.nim = kti.nim
    WHERE proposal.nim = '".$_POST['nim']."'
    OR semhas.nim = '".$_POST['nim']."'
    OR kti.nim = '".$_POST['nim']."'

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

<?php
if(isset($_POST['iddosen'])){
    $sql = "SELECT * FROM assign_sk
    JOIN mahasiswa ON mahasiswa.nim = assign_sk.nim
    JOIN proposal ON proposal.nim = assign_sk.nim
    JOIN semhas ON semhas.nim = assign_sk.nim
    JOIN kti ON kti.nim = assign_sk.nim
    WHERE assign_sk.id_dosen = '".$_POST['iddosen']."' AND assign_sk.assign_dosen = 'pembimbing 1'
    OR assign_sk.id_dosen = '".$_POST['iddosen']."' AND assign_sk.assign_dosen = 'pembimbing 2'

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