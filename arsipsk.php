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
				<li class="breadcrumb-item active">Arsip Surat Keputusan</li>
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
			<input class="form-control" name="pdf" id="pdf" accept="application/pdf" type="file">
			<br>
			<button style="margin-left: 2%;" type="submit" name="uploadsk" id ="uploadsk" class="btn btn-info btn-sm" value="Upload File">SUBMIT</button>
		</form>

		<div id="Table" class="card-body">
			<div id="tabledosen" class="table-responsive">
				<div class = "tabeldata">
					<?php
					$sql = "SELECT * FROM sk";
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {
        // output data of each row
						while ($row = $result->fetch_assoc()) {
							?>
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>Semester</th>
										<th>Download</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$sql = "SELECT * FROM semester,arsipsk WHERE arsipsk.idsemester = semester.id_semester ";
									$result = $conn->query($sql);
									if ($result->num_rows > 0) {
        // output data of each row
										while ($row = $result->fetch_assoc()) {
											?>
											<tr>
												<td><?php echo $row['semester'];?></td>
												<td><a href="<?php echo $row['sk_filepdf']; ?>"><img src="icons/pdficon.png" width="30px" height="30px"></a></td>
											</tr>

											<?php
										}
									}
									?>
								</tbody>
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
if(isset($_POST['uploadsk']))
{
	$semester = $_POST['datasemester'];
	$nama_file=$_FILES['pdf']['name'];
	$ukuran=$_FILES['pdf']['size'];

	$uploaddir='./uploadSK/';
	$alamatfile=$uploaddir.$nama_file;
	if(move_uploaded_file($_FILES['pdf']['tmp_name'],$alamatfile));
	{
		$sql = "INSERT INTO arsipsk (idsemester,sk_filepdf) VALUES ('".$semester."','".$alamatfile."')";
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