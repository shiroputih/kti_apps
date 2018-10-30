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
				<li class="breadcrumb-item active">Upload Arsip Seminar Hasil</li>
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
                    $sql = "SELECT * FROM semhas WHERE status IS NOT NULL";
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
		                                <th>Nama</th>
		                                <th>Semester</th>
		                                <th>File Pdf</th>
		                                <th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$sql = "SELECT * FROM arsipsemhas, mahasiswa, semester WHERE mahasiswa.nim = arsipsemhas.nim AND arsipsemhas.idsemester = semester.id_semester";
									$result = $conn->query($sql);
									if ($result->num_rows > 0) {
        // output data of each row
										while ($row = $result->fetch_assoc()) {
											echo"
											<tr>
												<td>$row[nim]</td>
												<td>$row[nama]</td>
												<td>$row[semester]</td>
												<td><a href=$row[semhas_filepdf] target='_blank'><img src='icons/pdficon.png' width='30px' height='30px'></a></td>
												<td>
												<a id ='deletearsipsemhas' data-idarsipsemhas=$row[id_arsipsemhas] data-toggle='modal' data-target='#deletearsipsemhasmodal'>
												<button type='button' class='btn btn-danger btn-circle btn-sm'>
												<i class='fa fa-times'></i>
												</button>
											</a>
											</td>
											</tr>";
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
<div class="modal fade" id="deletearsipsemhasmodal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Delete Arsip Berita Acara Seminar Hasil</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body" style="background-color: #c82333;">
				<div class="card-body">
					<form method="post" enctype="multipart/form-data">
						<input type="hidden" class="form-control" name="delnmsemhas" id="delnmsemhas" type="text"
						aria-describedby="nameHelp">
						<div id="datahapusarsipsemhas"></div>
						<br>
						<button type="submit" class="btn btn-info btn-sm" data-dismiss="modal" data-dismiss="modal">NO</button>
						<button type="submit" name="DeleteDataBAsemhas" class="btn btn-danger btn-sm" >YES</button>
					</form>
				</div>
			</div>

		</div>
	</div>
</div>
<!-- hapus arsip berita acara proposal -->
<script type="text/javascript">
	$(document).on("click", "#deletearsipsemhas", function () {
		var id_arsippsemhas = $(this).data('idarsipsemhas');
		
		$('#delnmsemhas').val(id_arsippsemhas);
	});
</script> 

<script type="text/javascript">
	$(document).ready(function()
	{
		$('#deletearsipsemhasmodal').on('show.bs.modal', function (e) 
		{
			var idarsipsemhas = $(e.relatedTarget).data('idarsipsemhas');
			//menggunakan fungsi ajax untuk pengambilan data
            $.ajax(
            {
            	type : 'post',
            	url : 'hapusBAsemhas.php',
            	data :  'id='+ idarsipsemhas,
            	success : function(data)
            	{
                    $('#datahapusarsipsemhas').html(data);//menampilkan data ke dalam modal
                }
            });
        });
	});
</script> 

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
<?php
if (isset($_POST['DeleteDataBAsemhas'])) {
        //update tabel mahasiswa
	$sql = "DELETE FROM arsipsemhas WHERE id_arsipsemhas = '$_POST[delnmsemhas]'";
	if (mysqli_query($conn, $sql)) {
		echo "<meta http-equiv='refresh' content='0'>";
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