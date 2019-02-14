<?php
@include("dbconnect.php");
	$sql = "SELECT * FROM kti";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc())
		{
			?>
			<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>NIM</th>
									<th>Nama</th>
									<th width="40%">Judul Penelitian</th>
									<th>Tgl Ujian KTI</th>
									<th>Status</th>
									<th>Semester</th>
									<th>Berita Acara KTI</th>
									<th></th>
								</tr>
							</thead>
							<tfoot>
								<tr>
                                <th>NIM</th>
									<th>Nama</th>
									<th>Judul Penelitian</th>
									<th>Tgl Ujian KTI</th>
									<th>Status</th>
									<th>Semester</th>
									<th>Berita Acara KTI</th>
									<th></th>
								</tr>
							</tfoot>
							<tbody>
								<?php
								$sql = "SELECT * FROM kti
                                JOIN mahasiswa ON kti.nim = mahasiswa.nim
                                JOIN semester ON semester.id_semester = kti.idsemester";
								$result = $conn->query($sql);
								if ($result->num_rows > 0) {
		                        // output data of each row
									while ($row = $result->fetch_assoc()) {
										echo "<tr>
										<td>$row[nim]</td>
										<td>$row[nama]</td>
										<td>$row[judul_penelitian]</td>
										<td>$row[tgl_ujiankti]</td>
										<td>$row[status_kti]</td>
										<td>$row[semester]</td>
										<td align='center'><a href=$row[file_kti] target='_blank'><img src='icons/pdficon.png' width='30px' height='30px'></a></td>
										<td class=center>";
										if($row['status_kti'] == NULL){
											echo"
											<a id ='Viewdatakti'
											data-nimmahasiswa='$row[nim]'
											data-namamahasiswa='$row[nama]'
											data-toggle='modal' data-target='#ViewDataktiModal'>
											<button type='button' class='btn btn-primary btn-sm' data-toggle='tooltip' data-placement='top' title='Detail Ujian KTI'><img src='icons/detail.png' width='20px' height='20px'></button></a>

                                            <a id ='beritaacarakti' data-flag='baru' data-nimmahasiswa='$row[nim]' data-namamahasiswa='$row[nama]' data-toggle='modal' data-target='#beritaacaraktimodal'>
                                            <button type='button' class='btn btn-primary btn-sm' data-toggle='tooltip' data-placement='top' title='Berita Acara KTI'><img src='icons/file.png' width='20px' height='20px'></button></a>

                                            <a id ='editkti' data-flag='edit' data-nimmahasiswa='$row[nim]' data-namamahasiswa='$row[nama]' data-idangkatan='$row[id_angkatan]' data-idsemester='$row[id_semester]' data-idtahunajaran='$row[id_tahunajaran]'data-toggle='modal' data-target='#beritaacaraktimodal'>
                                            <button type='button' class='btn btn-warning btn-sm' data-toggle='tooltip' data-placement='top' title='Edit Berita Acara'><img src='icons/edit.png' width='20px' height='20px'></button></a>

											</td>
											</tr>
											";
										}elseif($row['status_kti'] == 'Tidak Lolos'){
											echo"
											<a id ='Viewdatakti'
											data-nimmahasiswa='$row[nim]'
											data-namamahasiswa='$row[nama]'
											data-toggle='modal' data-target='#ViewDataktiModal'>
											<button type='button' class='btn btn-primary btn-sm' data-toggle='tooltip' data-placement='top' title='Detail Ujian KTI'><img src='icons/detail.png' width='20px' height='20px'></button></a>

                                            <a id ='ulangkti' data-flag='ulang' data-nimmahasiswa='$row[nim]' data-namamahasiswa='$row[nama]' data-toggle='modal' data-target='#beritaacaraktimodal'>
                                            <button type='button' class='btn btn-success btn-sm' data-toggle='tooltip' data-placement='top' title='Ulang KTI'><img src='icons/replay.png' width='20px' height='20px'></button></a>

                                            <a id ='editkti' data-flag='edit' data-nimmahasiswa='$row[nim]' data-namamahasiswa='$row[nama]' data-idangkatan='$row[id_angkatan]' data-idsemester='$row[id_semester]' data-idtahunajaran='$row[id_tahunajaran]'data-toggle='modal' data-target='#beritaacaraktimodal'>
                                            <button type='button' class='btn btn-warning btn-sm' data-toggle='tooltip' data-placement='top' title='Edit Berita Acara'><img src='icons/edit.png' width='20px' height='20px'></button></a>

											</td>
											</tr>
											";
										}else{
                                            echo"
											<a id ='Viewdatakti'
											data-nimmahasiswa='$row[nim]'
											data-namamahasiswa='$row[nama]'
											data-toggle='modal' data-target='#ViewDataktiModal'>
											<button type='button' class='btn btn-primary btn-sm' data-toggle='tooltip' data-placement='top' title='Detail Ujian KTI'><img src='icons/detail.png' width='20px' height='20px'></button></a>";
                                        }
									}
								} else {
									echo "<div class = 'notification'>Belum ada mahasiswa yang terdaftar KTI<div>";
								}
								?>
							</tbody>
						</table>

			<?php
		}
	}

?>




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

