<!DOCTYPE html>
<html lang="en">
<?php
@include ("header.php");
?>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<?php
@include("navigation.php");
?>
<div class="content-wrapper">
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.php">Home</a>
            </li>
            <li class="breadcrumb-item active">Input Data Outline</li>
        </ol>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-table"></i> Input Data Outline</div>
        <div class="card-body">
            <form>
                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputsemester">Tahun Ajaran</label>
                        </div>
                        <select class="custom-select" id="inputsemester">
                            <option selected>Choose...</option>
                            <option value="1">Gasal</option>
                            <option value="2">Genap</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputsemester">Semester</label>
                        </div>
                        <select class="custom-select" id="inputsemester">
                            <option selected>Choose...</option>
                            <option value="1">Gasal</option>
                            <option value="2">Genap</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">NIM</label>
                        </div>
                        <select class="custom-select" id="inputGroupSelect01">
                            
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupNama">Nama Mahasiswa</label>
                        </div>
                        <input class="form-control" id="inputGroupNama" disabled type="text" aria-describedby="nameHelp" placeholder="Nama Mahasiswa" >
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" >Tanggal Pengajuan</label>
                        </div>
                        <input class="form-control" id="inputGroupNama" type="text" aria-describedby="nameHelp" placeholder="Nama Mahasiswa" >
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text">Judul Penelitian</label>
                        </div>
                        <textarea rows="3" cols="50" class="form-control" id="inputGroupNama" aria-describedby="nameHelp" placeholder="Judul Penelitian"  onkeyup="this.value=this.value.toUpperCase()" ></textarea>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text">Pertanyaan Penelitian</label>
                        </div>
                        <textarea rows="3" cols="50" class="form-control" id="inputGroupNama" aria-describedby="nameHelp" placeholder="Pertanyaan Penelitian"  onkeyup="this.value=this.value.toUpperCase()"></textarea>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text">Manfaat Penelitian</label>
                        </div>
                        <textarea rows="3" cols="50" class="form-control" id="inputGroupNama" aria-describedby="nameHelp" placeholder="Manfaat Penelitian"  onkeyup="this.value=this.value.toUpperCase()"></textarea>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text">Desain Penelitian</label>
                        </div>
                        <textarea rows="3" cols="50" class="form-control" id="inputGroupNama" aria-describedby="nameHelp" placeholder="Desain Penelitian"  onkeyup="this.value=this.value.toUpperCase()"></textarea>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text">Sample Penelitian</label>
                        </div>
                        <textarea rows="3" cols="50" class="form-control" id="inputGroupNama" aria-describedby="nameHelp" placeholder="Sample Penelitian" onkeyup="this.value=this.value.toUpperCase()" ></textarea>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text">Variabel Bebas</label>
                        </div>
                        <textarea rows="3" cols="50" class="form-control" id="inputGroupNama" aria-describedby="nameHelp" placeholder="Variabel Bebas" onkeyup="this.value=this.value.toUpperCase()" ></textarea>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text">Variabel Tergantung</label>
                        </div>
                        <textarea rows="3" cols="50" class="form-control" id="inputGroupNama" aria-describedby="nameHelp" placeholder="Variabel Tergantung" onkeyup="this.value=this.value.toUpperCase()" ></textarea>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text">Hipotesis</label>
                        </div>
                        <textarea rows="3" cols="50" class="form-control" id="inputGroupNama" aria-describedby="nameHelp" placeholder="Hipotesis"  onkeyup="this.value=this.value.toUpperCase()"></textarea>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text">Usulan Pembimbing 1</label>
                        </div>
                        <select class="custom-select" id="inputsemester">
                            <option selected>Choose...</option>
                            <option value="1">Gasal</option>
                            <option value="2">Genap</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text">Usulan Pembimbing 2</label>
                        </div>
                        <select class="custom-select">
                            <option selected>Choose...</option>
                            <option value="1">Gasal</option>
                            <option value="2">Genap</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Upload</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile01">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>
                </div>
                <a class="btn btn-primary btn-block" data-toggle="modal" data-target="#confirm">Submit</a>
            </form>
        </div>
    </div>
    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>

</body>
<?php
@include("footer.php");
?>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<!-- Page level plugin JavaScript-->
<script src="vendor/chart.js/Chart.min.js"></script>
<script src="vendor/datatables/jquery.dataTables.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.js"></script>
<!-- Custom scripts for all pages-->
<script src="js/sb-admin.min.js"></script>
<!-- Custom scripts for this page-->
<script src="js/sb-admin-datatables.min.js"></script>
<script src="js/sb-admin-charts.min.js"></script>

<!-- Modal content Delete-->
<div class="modal fade" id="confirm" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Simpan Data Mahasiswa</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                Data mahasiswa telah disimpan <br />
                <input type="button" class="btn btn-success btn-sm" data-dismiss="modal" value="Confirm"/>
            </div>
        </div>
    </div>
</div>