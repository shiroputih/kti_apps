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
				<li class="breadcrumb-item active">Upload Arsip Surat Keputusan</li>
			</ol>
		</div>

		<form method="post" enctype="multipart/form-data">
		<div class="input-group mb-3">
				<div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Semester</label>
                </div>
				<select class="custom-select" name="semester" id="semester" selected="selected">
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
			</div>
			<div class="input-group mb-3">
				<div class="input-group-prepend">
						<label class="input-group-text" for="inputGroupSelect01">Upload File</label>
				</div>
				<input class="form-control" name="pdf" id="pdf" accept="application/pdf" type="file">
				</div>
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
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$sql = "SELECT * FROM semester,sk WHERE sk.id_semester = semester.id_semester ";
									$result = $conn->query($sql);
									if ($result->num_rows > 0) {
        // output data of each row
										while ($row = $result->fetch_assoc()) {
											echo "
											<tr>
											<td>$row[semester]</td>
											<td><a href=$row[file_sk] target='_blank'><img src='icons/pdficon.png' width='30px' height='30px'></a>
											</td>
											<td>
											<a id ='deletesk' data-idsk=$row[id_sk] data-nm_file = $row[file_sk] data-toggle='modal' data-target='#deleteskmodal'>
												<button type='button' class='btn btn-danger btn-circle btn-sm'>
												<i class='fa fa-times'></i>
												</button>
											</a>
											</td>
											</tr>
											";
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

<div class="modal fade" id="deleteskmodal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Delete Arsip SK</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body" style="background-color: #c82333;">
				<div class="card-body">
					<form method="post" enctype="multipart/form-data">
						<input type="hidden" class="form-control" name="delnmsk" id="delnmsk" type="text"
						aria-describedby="nameHelp">
						<div id="datahapussk"></div>
						<br>
						<button type="submit" class="btn btn-info btn-sm" data-dismiss="modal" data-dismiss="modal">NO</button>
						<button type="submit" name="DeleteDataSK" class="btn btn-danger btn-sm" >YES</button>
					</form>
				</div>
			</div>

		</div>
	</div>
</div>
<!-- hapus SK -->
<script type="text/javascript">
	$(document).on("click", "#deletesk", function () {
		var id_sk = $(this).data('idsk');
		var nama_file = $(this).data('nm_file');

		$('#delnmsk').val(id_sk);
	});
</script>

<script type="text/javascript">
	$(document).ready(function()
	{
		$('#deleteskmodal').on('show.bs.modal', function (e)
		{
			var idsk = $(e.relatedTarget).data('idsk');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax(
            {
            	type : 'post',
            	url : 'hapussk.php',
            	data :  'idsk='+ idsk,
            	success : function(data)
            	{
                    $('#datahapussk').html(data);//menampilkan data ke dalam modal
                }
            });
        });
	});
</script>
<?php
if (isset($_POST['DeleteDataSK'])) {
        //update tabel mahasiswa
	$sql = "DELETE FROM sk WHERE id_sk = '$_POST[delnmsk]'";
	if (mysqli_query($conn, $sql)) {
		echo "<meta http-equiv='refresh' content='0'>";
	}
}
?>

<?php
if(isset($_POST['uploadsk']))
{
	$semester = $_POST['semester'];
	$nama_file=$_FILES['pdf']['name'];
	$ukuran=$_FILES['pdf']['size'];

	$uploaddir='./uploadSK/';
	$alamatfile=$uploaddir.$nama_file;
	if(move_uploaded_file($_FILES['pdf']['tmp_name'],$alamatfile));
	{
		$sql = "INSERT INTO sk (id_semester,file_sk) VALUES ('".$semester."','".$alamatfile."')";
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



