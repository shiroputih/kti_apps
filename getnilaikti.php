<?php
@include("dbconnect.php");

if($_POST['semester']){
	$sql = "SELECT * FROM kti WHERE kti.idsemester = '".$_POST['semester']."'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) 
		{
			?>
			<div class="card mb-3">
				<div class="card-header">
					<i class="fa fa-table"></i> Data Karya Tulis Ilmiah
				</div>
				<div id="Table" class="card-body">
					<div id="tablekti" class="table-responsive">
						<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>NIM</th>
									<th>Nama</th>
									<th>Batas Kumpul KTI</th>
									<th>Kumpul Berkas KTI</th>
									<th>Nilai KTI</th>
									<th>Nilai KTI (Huruf)</th>
									<th></th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>NIM</th>
									<th>Nama</th>
									<th>Batas Kumpul KTI</th>
									<th>Kumpul Berkas KTI</th>
									<th>Nilai KTI</th>
									<th>Nilai KTI (Huruf)</th>
									<th></th>
								</tr>
							</tfoot>
							<tbody>
								<?php
								$sql = "SELECT * FROM kti,mahasiswa WHERE kti.nim = mahasiswa.nim AND kti.idsemester = '".$_POST['semester']."'";
								$result = $conn->query($sql);
								if ($result->num_rows > 0) {
		                        // output data of each row
									while ($row = $result->fetch_assoc()) {
										echo "<tr>
										<td>$row[nim]</td>
										<td>$row[nama]</td>
										<td>$row[batas_pengumpulan]</td>
										<td>$row[tgl_kumpul]</td>
										<td>$row[nilaiakhir]</td>
										<td>$row[nilaiakhirhuruf]</td>
										<td class=center>"; 
										if($row['tgl_kumpul'] == NULL){ 
											echo"
											<a id ='Ubahdatakti' 
											data-nimmahasiswa='$row[nim]'  
											data-namamahasiswa='$row[nama]' 
											data-dosen='$row[dosen1]' 
											data-dosen2='$row[dosen2]' 
											data-dosen3='$row[penguji]' 
											data-penulisan1 = '$row[penulisanisi1]'
											data-penulisan2 = '$row[penulisanisi2]'
											data-penulisan3 = '$row[penulisanisi3]'
											data-metodologi1 = '$row[metodologi1]'    
											data-metodologi2 = '$row[metodologi2]'
											data-metodologi3 = '$row[metodologi3]'
											data-penguasaanmateri1 = '$row[penguasaanmateri1]'    
											data-penguasaanmateri2 = '$row[penguasaanmateri2]'
											data-penguasaanmateri3 = '$row[penguasaanmateri3]'
											data-presentasi1 = '$row[presentasi1]'    
											data-presentasi2 = '$row[presentasi2]'
											data-presentasi3 = '$row[presentasi3]'
											data-nilaiakhirangka = '$row[nilaiakhir]',
											data-nilaiakhirhuruf = '$row[nilaiakhirhuruf_temp]'
											data-toggle='modal' data-target='#UbahDataktiModal'>
											<button type='button' class='btn btn-warning btn-sm'>Edit</button></a>
											<a id ='Viewdatakti' data-nimmahasiswa=$row[nim]  data-namamahasiswa='$row[nama]' data-tglsidang='$row[tgl_sidangkti]' data-toggle='modal' data-target='#ViewDataktiModal'>
											<button type='button' class='btn btn-info btn-sm'>Detail</button></a>

											<a id ='kumpulberkas' data-nimmahasiswa='$row[nim]' data-namamahasiswa='$row[nama]' data-tglsidang='$row[tgl_sidangkti]' data-bataskumpul = '$row[batas_pengumpulan]' data-nilaitemp='$row[nilaiakhirhuruf_temp]' data-toggle='modal' data-target='#KumpulBerkasModal'>
											<button type='button' class='btn btn-primary btn-sm'>Kumpul Berkas</button></a>

											</td>
											</tr>
											";
										}else{
											echo"
											<a id ='Viewdatakti' data-nimmahasiswa=$row[nim]  data-namamahasiswa='$row[nama]' data-gelarbelakang='$row[tgl_sidangkti]'  data-toggle='modal' data-target='#ViewDataktiModal'>
											<button type='button' class='btn btn-info btn-sm'>Detail</button></a>
											</td>
											</tr>";
										}
									}
								} else {
									echo "Belum Ada Mahasiswa yang sidang KTI";
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<?php 
		}
	}
}
?>


<!-- Detail Modal -->
<div class="modal fade" id="ViewDataktiModal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Detail KTI</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="card-body">
					<div class="viewdetailkti"></div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Show Detail Mahasiswa -->
<script type="text/javascript">
	$(document).ready(function()
	{
		$('#ViewDataktiModal').on('show.bs.modal', function (e) 
		{
			var nim = $(e.relatedTarget).data('nimmahasiswa');
		                //menggunakan fungsi ajax untuk pengambilan data
		                $.ajax(
		                {
		                	type : 'post',
		                	url : 'detailkti.php',
		                	data :  'nim='+ nim,
		                	success : function(data)
		                	{
		                        $('.viewdetailkti').html(data);//menampilkan data ke dalam modal
		                    }
		                });
		            });
	});
</script> 


