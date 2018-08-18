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
            <li class="breadcrumb-item active">Data Proposal</li>
        </ol>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-table"></i> Data Proposal</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Judul Proposal</th>
                        <th>Angkatan</th>
                        <th>Semester</th>
                        <th>Tahun Ajaran</th>
                        <th>Detail Proposal</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Judul Outline</th>
                        <th>Angkatan</th>
                        <th>Semester</th>
                        <th>Tahun Ajaran</th>
                        <th>Detail Proposal</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <tr>
                        <td>41140001</td>
                        <td>yyy</td>
                        <td>judul</td>
                        <td>2004</td>
                        <td>Gasal</td>
                        <td>2010/2011</td>
                        <td class="center"><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#VerifikasiOutline">Detail Outline</button></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>
</div>
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

<!-- Modal content Detail-->
<div class="modal fade" id="VerifikasiOutline" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Outline Mahasiswa</h4><button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <tr>
                                <td width="200px">NIM</td>
                                <td>41140001</td>
                            </tr>
                            <tr>
                                <td width="200px">Nama Mahasiswa</td>
                                <td>41140001</td>
                            </tr>
                            <tr>
                                <td width="200px">Angkatan</td>
                                <td>41140001</td>
                            </tr>
                            <tr>
                                <td width="200px">Semester</td>
                                <td>41140001</td>
                            </tr>
                            <tr>
                                <td width="200px">Tahun Ajaran</td>
                                <td>41140001</td>
                            </tr>
                            <tr>
                                <td width="200px">Judul Outline</td>
                                <td>41140001</td>
                            </tr>
                            <tr>
                                <td width="200px">Dosen Pembimbing 1</td>
                                <td>41140001</td>
                            </tr>
                            <tr>
                                <td width="200px">Dosen Pembimbing 2</td>
                                <td>41140001</td>
                            </tr>
                            <tr>
                                <td width="200px">Dosen Penguji</td>
                                <td>41140001</td>
                            </tr>
                            <tr>
                                <td width="200px">Tanggal Seminar Proposal</td>
                                <td>41140001</td>
                            </tr>
                            <tr>
                                <td width="200px">Ruangan Sidang Proposal</td>
                                <td>41140001</td>
                            </tr>
                        </table>
                        <a class="btn btn-primary btn-block" data-toggle="modal" data-target="#confirm">Submit dan Buat Berita Acara</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>