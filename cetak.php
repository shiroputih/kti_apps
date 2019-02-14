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
          <a href="dashboard.php">Home</a>
        </li>
        <li class="breadcrumb-item active">Cetak</li>
      </ol>
    </div>
    <div class="modal-body">
      <div class="card-body">
        <form id="cetak" action="cetakproposal.php" method="POST" target="_blank">
          <div class="form-group">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="inputsemester">Seminar Proposal</label>
              </div>
              <input type='text' class="form-control" id="nim" name="nim" placeholder="Masukkan NIM" />
              <a href="cetakproposal.php?nim=<?php echo $nim; ?>" target="_blank">
                <button type="submit" class="btn btn-primary btn-medium">Cetak Berita Acara Proposal</button>
              </a>
            </div>
          </div>
        </form>

        <form id="cetak" action="cetaksemhas.php" method="POST" target="_blank">
          <div class="form-group">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="inputsemester">Seminar Hasil</label>
              </div>
              <input type='text' class="form-control" id="nim" name="nim" placeholder="Masukkan NIM" />
              <a href="cetaksemhas.php?nim=<?php echo $nim; ?>" target="_blank">
                <button type="submit" name="cetakberitaacarasemhas" class="btn btn-primary btn-medium">Cetak Berita Acara Seminar Hasil</button>
              </a>
            </div>
          </div>
        </form>

        <form id="cetak" action="cetakkti.php" method="POST" target="_blank">
          <div class="form-group">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="inputsemester">Ujian KTI</label>
              </div>
              <input type='text' class="form-control" id="nim" name="nim" placeholder="Masukkan NIM" />
              <a href="cetakkti.php?nim=<?php echo $nim; ?>" target="_blank">
                <button type="submit" name="cetakberitaacarakti" class="btn btn-primary btn-medium">Cetak Berita Acara Ujian KTI</button>
              </a>
            </div>
          </div>
        </form>

        <form id="cetak" action="cetakpenerimaanberkas.php" method="POST" target="_blank">
          <div class="form-group">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="inputsemester">Penerimaan Berkas</label>
              </div>
              <input type='text' class="form-control" id="nim" name="nim" placeholder="Masukkan NIM" />
              <a href="cetakkti.php?nim=<?php echo $nim; ?>" target="_blank">
                <button type="submit" name="cetakpenerimaanberkas" class="btn btn-primary btn-medium">Cetak Penerimaan Berkas</button>
              </a>
            </div>
          </div>
        </form>

        <p style="color: red; size: 10px;">(*) Silahkan untuk menyimpan file dalam bentuk .pdf sebelum mencetak hard print </p>
      </div>
    </div>
  </div>
