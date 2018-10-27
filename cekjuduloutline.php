<?php
@include("header.php");
@include("navigation.php");
@include("dbconnect.php");
?>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
	<div class="fixed-nav sticky-footer bg-dark" id="page-top">
		<div class="content-wrapper">
			<div class="container-fluid">
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
						<a href="index.php">Home</a>
					</li>
					<li class="breadcrumb-item active"> Periksa Judul Outline</li>
				</ol>
			</div>
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<label class="input-group-text">Kata Kunci 1</label>
				</div>
				<input type='text' class="form-control" placeholder="Kata Kunci 1" id="katakunci1" name="katakunci1" onkeyup="this.value=this.value.toUpperCase()"/>
			</div>
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<label class="input-group-text">Kata Kunci 2</label>
				</div>
				<input type='text' class="form-control" placeholder="Kata Kunci 2" id="katakunci2" name="katakunci2" onkeyup="this.value=this.value.toUpperCase()"/>
			</div>
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<label class="input-group-text">Kata Kunci 3</label>
				</div>			
				<input type='text' class="form-control" placeholder="Kata Kunci 3" id="katakunci3" name="katakunci3" onkeyup="this.value=this.value.toUpperCase()"/>
			</div>

				<a href="ViewCheckJudul" id ='checkjudul' data-toggle='modal' data-target='#ViewCheckJudul'>
					<button type='button' id = "btncheck" class='btn btn-info btn-sm'>Check Judul</button></a>
				

				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>No</th>
									<th>NIM</th>
									<th>Nama Mahasiswa</th>
									<th>Judul Outline</th>
									<th>Kata Kunci 1</th>
									<th>Kata Kunci 2</th>
									<th>Kata Kunci 3</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no=1;
								$sql = "SELECT * FROM outline,mahasiswa WHERE outline.nim = mahasiswa.nim";
								$result = $conn->query($sql);
								if ($result->num_rows > 0) {
                                // output data of each row
									while ($path = $result->fetch_assoc()) {
										echo "<tr>
										<td>$no</td>
										<td>$path[nim]</td>
										<td>$path[nama]</td>
										<td>$path[judul_outline]</td>
										<td>$path[kk1]</td>
										<td>$path[kk2]</td>
										<td>$path[kk3]</td>
										<td class='center'>
										<a id ='Viewoutline' 
										data-nimmahasiswa='$path[nim]'
										data-namamahasiswa='$path[nama]'  
										data-semester='$path[semester]' 
										data-toggle='modal' 
										data-target='#ViewOutlineModal'>
										<button type='button' class='btn btn-info btn-sm'>Detail</button></a>

										<a id ='Editoutline' 
										data-nimmahasiswa='$path[nim]' 
										data-namamahasiswa='$path[nama]'  
										data-juduloutline='$path[judul_outline]' 
										data-pertanyaan='$path[pertanyaan_penelitian]' 
										data-manfaat ='$path[manfaat_penelitian]' 
										data-desain ='$path[desain_penelitian]' 
										data-sample ='$path[sample_penelitian]' 
										data-bebas ='$path[variabel_bebas]' 
										data-tergantung ='$path[variabel_tergantung]' 
										data-hipotesis ='$path[hipotesis]' 
										data-usulandosen1 ='$path[usulan_dosen1]' 
										data-usulandosen2 ='$path[usulan_dosen2]'
										data-tanggal = '$path[tgl_pengajuan]'
										data-toggle='modal' 
										data-target='#EditOutlineModal'>
										<button type='button' class='btn btn-warning btn-sm'>Edit</button></a>

										<a id ='Deleteoutline'
										data-nimmahasiswa='$path[nim]' 
										data-namamahasiswa='$path[nama]'  
										data-juduloutline='$path[judul_outline]' 
										data-toggle='modal' 
										data-target='#DeleteOutlineModal'>
										<button type='button' class='btn btn-danger btn-sm'>Delete</button></a>
										</td>
										</tr>";
										$no+=1;
									}
								} else {

								}
								?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
			</div>
		</div>
	</body>

	<?php
	@include("footer.php");
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