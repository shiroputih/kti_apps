<?php
@include("dbconnect.php");
?>

<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
	<thead>
		<tr align="center">
			<th>No</th>
			<th>Nim</th>
			<th>Nama</th>
			<th>Angkatan</th>
			<th>Semester</th>
			<th>Tahun Ajaran</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$no=1;
		$sql = "SELECT * FROM mahasiswa
		JOIN semester ON mahasiswa.id_semester = semester.id_semester
		JOIN angkatan ON mahasiswa.id_angkatan = angkatan.id_angkatan
		JOIN tahunajaran ON mahasiswa.id_tahunajaran = tahunajaran.id_tahunajaran ORDER BY nim ASC";
		$result = $conn->query($sql);
		if ($result->num_rows > 0)
		{
			while ($row = $result->fetch_assoc())
			{
				echo "<tr>
				<td align='center'>$no</td>
				<td>$row[nim]</td>
				<td>$row[nama]</td>
				<td>$row[angkatan]</td>
				<td>$row[semester]</td>
				<td>$row[tahunajaran]</td>
				<td align='center'>
				<a id ='Viewmahasiswa' data-nimmahasiswa='$row[nim]' data-namamahasiswa='$row[nama]' data-toggle='modal' data-target='#ViewmahasiswaModal'>
				<button type='button' class='btn btn-primary btn-sm'><img src='icons/detail.png' width='10px' height='10px'></button></a>
				<a id ='Editmahasiswa' data-nimmahasiswa='$row[nim]' data-namamahasiswa='$row[nama]' data-idangkatan='$row[id_angkatan]' data-idsemester='$row[id_semester]' data-idtahunajaran='$row[id_tahunajaran]'data-toggle='modal' data-target='#EditmahasiswaModal'>
				<button type='button' class='btn btn-warning btn-sm'><img src='icons/edit.png' width='10px' height='10px'></button></a>
				<a id ='Deletemahasiswa' data-nimmahasiswa='$row[nim]' data-namamahasiswa='$row[nama]' data-toggle='modal' data-target='#DeletemahasiswaModal'>
				<button type='button' class='btn btn-danger btn-sm'><img src='icons/delete.png' width='10px' height='10px'></button></a>
				</td>
				</tr>";
				$no+=1;
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