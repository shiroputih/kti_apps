<?php
@include("header.php");
@include("navigation.php");
@include("dbconnect.php");
?>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
	<div class="content-wrapper">
		<div class="container-fluid">
			<ol class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="index.php">Home</a>
				</li>
				<li class="breadcrumb-item active">Arsip Seminar Hasil</li>
			</ol>
		</div>

		<form method="post" enctype="multipart/form-data">
			<select class="custom-select" name="datasemester" id="semester">
                    <option> -- Pilih Semester --</option>
                    <?php
                    $sql = "SELECT * FROM semester";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                    ?>
                        <option value ="<?php echo $row['id_semester']; ?>"> <?php echo $row['semester']; ?></option>
                    <?php
                        }
                    } else {
                        echo "0 results";
                    }
                    ?>
                </select>
                
                <select class="custom-select" name="datanim" id="semester">
                    <option> -- Pilih Nim --</option>
                    <?php
                    $sql = "SELECT * FROM mahasiswa";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                    ?>
                        <option value ="<?php echo $row['nim']; ?>"><?php echo $row['nim']." | ". $row['nama']; ?></option>
                    <?php
                        }
                    } else {
                        echo "0 results";
                    }
                    ?>
                </select>
			<input class="form-control" name="pdf" id="pdf" accept="application/pdf" type="file">
			<br>
			<button style="margin-left: 2%;" type="submit" name="uploadsemhas" id ="uploadsemhas" class="btn btn-info btn-sm" value="Upload File">SUBMIT</button>
		</form>

		<div id="Table" class="card-body">
			<div id="tabledosen" class="table-responsive">
				<div class = "tabeldata">
					<?php
					$sql = "SELECT * FROM arsipsemhas, mahasiswa, semester WHERE mahasiswa.nim = arsipsemhas.nim AND arsipsemhas.idsemester = semester.id_semester";
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {
        // output data of each row
						while ($row = $result->fetch_assoc()) {
							?>
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>NIM</th>
										<th>Semester</th>
										<th>File Pdf</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$sql = "SELECT * FROM arsipsemhas, mahasiswa, semester WHERE mahasiswa.nim = arsipsemhas.nim AND arsipsemhas.idsemester = semester.id_semester";
									$result = $conn->query($sql);
									if ($result->num_rows > 0) {
        // output data of each row
										while ($row = $result->fetch_assoc()) {
											?>
											<tr>
												<td><?php echo $row['nim'];?></td>
												<td><?php echo $row['nama'];?></td>
												<td><a href="<?php echo $row['semhas_filepdf'];?>" target="_blank"><img src="icons/pdficon.png" width="30px" height="30px"></a></td>
											</tr>

											<?php
										}
									}
									?>
								</tbody>
							</table>
							<?php 
						}
					}
				
				
				?>
			</div>
		</div>
	</div>
</div>
</body>
<?php
@include("footer.php");
?>

<?php
if(isset($_POST['uploadsemhas']))
{
	$semester = $_POST['datasemester'];
	$nim = $_POST['datanim'];

	$nama_file=$_FILES['pdf']['name'];
	$ukuran=$_FILES['pdf']['size'];

	$uploaddir='./uploadSemhas/';
	$alamatfile=$uploaddir.$nama_file;
	if(move_uploaded_file($_FILES['pdf']['tmp_name'],$alamatfile));
	{
		$sql = "INSERT INTO arsipsemhas (idsemester,nim,semhas_filepdf) VALUES ('".$semester."','".$nim."','".$alamatfile."')";
		if (mysqli_query($conn, $sql)) 
   		 {
     		 echo "<meta http-equiv='refresh' content='0'>";
  	 	}
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