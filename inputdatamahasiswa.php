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
            <li class="breadcrumb-item active">Input Data Mahasiswa</li>
        </ol>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-table"></i> Input Data Mahasiswa</div>
        <div class="card-body">
            <form>
                <div class="form-group">
                    <div class="col-md-6">
                            <label for="exampleInputName">NIM</label>
                            <input class="form-control" id="exampleInputName" type="text" aria-describedby="nameHelp" placeholder="Masukkan NIM">
                        </div>
                    <br>
                        <div class="col-md-6">
                            <label for="exampleInputLastName">Nama Mahasiswa</label>
                            <input class="form-control" id="exampleInputLastName" type="text" aria-describedby="nameHelp" placeholder="Masukkan Nama Mahasiswa" onkeyup="this.value=this.value.toUpperCase()">
                        </div>
                    <br>
                        <div class="col-md-6">
                            <label for="exampleInputName">Angkatan</label>
                            <select class="form-control">
                                <option value="volvo">Volvo</option>
                                <option value="saab">Saab</option>
                                <option value="mercedes">Mercedes</option>
                                <option value="audi">Audi</option>
                            </select>
                        </div>
                    <br>
                         <div class="col-md-6">
                            <label for="exampleInputName">Jenis Kelamin</label>
                            <select class="form-control">
                                     <option value="volvo">Volvo</option>
                                     <option value="saab">Saab</option>
                                     <option value="mercedes">Mercedes</option>
                                     <option value="audi">Audi</option>
                            </select>
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
                Data Mahasiswa NIM  NAMA telah disimpan <br />
                <input type="button" class="btn btn-success btn-sm" data-dismiss="modal" value="Confirm"/>
            </div>
        </div>
    </div>
</div>