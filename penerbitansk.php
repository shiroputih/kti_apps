<!DOCTYPE html>
<html lang="en">
<?php
@include("header.php");
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
            <li class="breadcrumb-item active">Penerbitan SK</li>
        </ol>
    </div>

    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-table"></i> Data Outline</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Nomor SK</th>
                        <th>Semester</th>
                        <th>Tahun Ajaran</th>
                        <th>Download</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Nomor SK</th>
                        <th>Semester</th>
                        <th>Tahun Ajaran</th>
                        <th>Download</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <tr>
                        <td>41140001</td>
                        <td>yyy</td>
                        <td>judul</td>
                        <td>pdf</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>

</div>
</body>
</html>


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
