<?php
@include("dbconnect.php");
$sql = "SELECT * FROM kti";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    ?>
<div id="tablekti" class="table-responsive">
<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
  <thead>
    <tr>
      <th>NIM</th>
      <th>Nama</th>
      <th>Batas Kumpul KTI</th>
      <th>Kumpul Berkas KTI</th>
      <th>File Publikasi</th>
      <th>File Naskah KTI</th>
      <th>File Scan Penerimaan KTI</th>
      <th></th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th>NIM</th>
      <th>Nama</th>
      <th>Batas Kumpul KTI</th>
      <th>Kumpul Berkas KTI</th>
      <th>File Publikasi</th>
      <th>File Naskah KTI</th>
      <th>File Scan Penerimaan KTI</th>
      <th></th>
    </tr>
  </tfoot>
  <tbody>
    <?php
    $sql = "SELECT * FROM kumpul_berkas
								JOIN mahasiswa ON kumpul_berkas.nim = mahasiswa.nim
								JOIN batas_waktu ON batas_waktu.nim = kumpul_berkas.nim";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
		                        // output data of each row
      while ($row = $result->fetch_assoc()) {
        echo "<tr>
										<td>$row[nim]</td>
										<td>$row[nama]</td>
										<td>$row[batas_kumpulberkas]</td>
										<td>$row[tgl_kumpulberkas]</td>
										<td>";
        if ($row['file_publikasi'] === null) {
          echo "
											<a id ='filepublikasi' data-nim='$row[nim]' data-nama='$row[nama]' data-toggle='modal' data-target='#publikasimodal'>
                                        	<button type='button' class='btn btn-primary btn-sm' data-toggle='tooltip' data-placement='top' title='Kumpul Publikasi'><img src='icons/uploadfile.png' width='20px' height='20px'></button></a>
										";
        } else {
          echo "<a href=$row[file_publikasi] target='_blank'><img src='icons/pdficon.png' width='30px' height='30px'></a>";
        }
        echo "
										</td>
										<td>";

        if ($row['file_naskahkti'] === null) {
          echo "
											<a id ='filekti' data-nim='$row[nim]' data-nama='$row[nama]' data-toggle='modal' data-target='#naskahktimodal'>
                                        	<button type='button' class='btn btn-primary btn-sm' data-toggle='tooltip' data-placement='top' title='Kumpul Naskah KTI'><img src='icons/uploadfile.png' width='20px' height='20px'></button></a>
										";
        } else {
          echo "<a href=$row[file_naskahkti] target='_blank'><img src='icons/pdficon.png' width='30px' height='30px'></a>";
        }
        echo "
										</td>
										<td>";
        if ($row['file_scanpenerimaanberkas'] === null) {
          echo "
											<a id ='filescanpenerimaan' data-nim='$row[nim]' data-nama='$row[nama]' data-toggle='modal' data-target='#scanpenerimaanmodal'>
                                        	<button type='button' class='btn btn-primary btn-sm' data-toggle='tooltip' data-placement='top' title='Kumpul Penerimaan Berkas'><img src='icons/uploadfile.png' width='20px' height='20px'></button></a>
										";
        } else {
          echo "<a href=$row[file_scanpenerimaanberkas] target='_blank'><img src='icons/pdficon.png' width='30px' height='30px'></a>";
        }
        echo "
										</td>
										<td>
										<a id ='beritaacarapenerimaanberkas' data-nim='$row[nim]' data-nama='$row[nama]' data-toggle='modal' data-target='#beritaacarapenerimaanberkasmodal'>
                                        	<button type='button' class='btn btn-primary btn-sm' data-toggle='tooltip' data-placement='top' title='berita acara penerimaan berkas'><img src='icons/file.png' width='20px' height='20px'></button></a>
										</td>
										</tr>";
      }
    } else {
      echo "Belum Ada Mahasiswa yang sidang KTI";
    }
    ?>
  </tbody>
</table>
  </div>
<?php

}
}

?>

<!-- Upload Publikasi Modal -->
<div class="modal fade" id="publikasimodal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Kumpul Naskah Publikasi</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="card-body">
          <form method="post" enctype="multipart/form-data">
            <input class="form-control" name="hiddenpublikasinim" id="hiddenpublikasinim" type="hidden" aria-describedby="nameHelp">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">NIM</label>
              </div>
              <input class="form-control" name="publikasinim" id="publikasinim" type="text" aria-describedby="nameHelp" disabled="">
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Nama Mahasiswa</label>
              </div>
              <input class="form-control" name="publikasinama" id="publikasinama" type="text" aria-describedby="nameHelp" disabled="">
            </div>
            <input class="form-control" name="pdf_publikasi" id="pdf_publikasi" accept="application/pdf" type="file">
            <br>
            <button type="submit" name="uploadpublikasi" id="uploadpublikasi" class="btn btn-primary btn-sm" value="Upload File">Upload Publikasi</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Upload Naskah KTI Modal -->
<div class="modal fade" id="naskahktimodal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Kumpul Naskah KTI</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="card-body">
          <form method="post" enctype="multipart/form-data">
            <input class="form-control" name="hiddennaskahktinim" id="hiddennaskahktinim" type="hidden" aria-describedby="nameHelp">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">NIM</label>
              </div>
              <input class="form-control" name="naskahktinim" id="naskahktinim" type="text" aria-describedby="nameHelp" disabled="">
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Nama Mahasiswa</label>
              </div>
              <input class="form-control" name="naskahktinama" id="naskahktinama" type="text" aria-describedby="nameHelp" disabled="">
            </div>
            <input class="form-control" name="pdf_naskahkti" id="pdf_naskahkti" accept="application/pdf" type="file">
            <br>
            <button type="submit" name="uploadnaskahkti" id="uploadnaskahkti" class="btn btn-primary btn-sm" value="Upload File">Upload Naskah KTI</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Upload penerimaan KTI Modal -->
<div class="modal fade" id="scanpenerimaanmodal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Kumpul Berita Acara Penerimaan Berkas </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="card-body">
          <form method="post" enctype="multipart/form-data">
            <input class="form-control" name="hiddenberkasnim" id="hiddenberkasnim" type="hidden">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">NIM</label>
              </div>
              <input class="form-control" name="berkasnim" id="berkasnim" type="text" aria-describedby="nameHelp" disabled="">
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Nama Mahasiswa</label>
              </div>
              <input class="form-control" name="berkasnama" id="berkasnama" type="text" aria-describedby="nameHelp" disabled="">
            </div>
            <input class="form-control" name="pdf_berkas" id="pdf_berkas" accept="application/pdf" type="file">
            <br>
            <button type="submit" name="uploadberkas" id="uploadberkas" class="btn btn-primary btn-sm" value="Upload File">Upload Penerimaan Berkas</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Upload penerimaan KTI Modal -->
<div class="modal fade" id="beritaacarapenerimaanberkasmodal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Berita Acara Penerimaan Berkas </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="card-body">
          <div class="penerimaanberkas"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
$(document).on("click", "#filepublikasi", function() {
  var nim = $(this).data('nim');
  var nama = $(this).data('nama');
  $('#publikasinim').val(nim);
  $('#hiddenpublikasinim').val(nim);
  $('#publikasinama').val(nama);
});
$(document).on("click", "#filekti", function() {
  var nim = $(this).data('nim');
  var nama = $(this).data('nama');
  $('#naskahktinim').val(nim);
  $('#hiddennaskahktinim').val(nim);
  $('#naskahktinama').val(nama);
});
$(document).on("click", "#filescanpenerimaan", function() {
  var nim = $(this).data('nim');
  var nama = $(this).data('nama');
  $('#berkasnim').val(nim);
  $('#hiddenberkasnim').val(nim);
  $('#berkasnama').val(nama);
});
$(document).ready(function() {
  $('#beritaacarapenerimaanberkasmodal').on('show.bs.modal', function(e) {
    var nim = $(e.relatedTarget).data('nim');
    //menggunakan fungsi ajax untuk pengambilan data
    $.ajax({
      type: 'post',
      url: 'beritaacarapenerimaanberkas.php',
      data: "nim=" + nim,
      success: function(data) {
        $('.penerimaanberkas').html(data); //menampilkan data ke dalam modal
      }
    });
  });
});

</script>

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
