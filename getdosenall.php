<?php
@include("dbconnect.php");
?>

<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Dosen</th>
			<th>Gelar Depan</th>
			<th>Gelar Belakang</th>
			<th>Keterangan</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th>No</th>
			<th>Nama Dosen</th>
			<th>Gelar Depan</th>
			<th>Gelar Belakang</th>
			<th>Keterangan</th>
		</tr>
	</tfoot>
	<tbody>
		<?php
		$no = 1;
		$sql = "SELECT * FROM dosen";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
                        // output data of each row
			while ($row = $result->fetch_assoc()) {
				echo "<tr>
				<td>$no</td>
				<td>$row[nama_dosen]</td>
				<td>$row[gelar_depan]</td>
				<td>$row[gelar_belakang]</td>
				<td class=center>
				<a id ='editdosen' data-iddosen=$row[id_dosen] data-namadosen='$row[nama_dosen]' data-gelardepan='$row[gelar_depan]' data-gelarbelakang='$row[gelar_belakang]' data-toggle='modal' data-target='#editModal'>
				<button type='button' class='btn btn-warning btn-sm' data-toggle='tooltip' data-placement='top' title='Edit Data Dosen'><img src='icons/edit.png' width='20px' height='20px'></button></a>
				<a id ='deletedosen' data-iddosen=$row[id_dosen] data-namadosen='$row[nama_dosen]' data-gelardepan='$row[gelar_depan]' data-gelarbelakang='$row[gelar_belakang]' data-toggle='modal' data-target='#deleteModal'>
				<button type='button' class='btn btn-danger btn-sm' data-toggle='tooltip' data-placement='top' title='Delete Data Dosen'><img src='icons/delete.png' width='20px' height='20px'></button></a>
				</td>
				</tr>";
				$no+= 1;
			}
		} else {
			echo "0 results";
		}
		?>
	</tbody>
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