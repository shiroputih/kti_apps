<!DOCTYPE html>
<html lang="en">
<?php
@include ("header.php");
@include ("dbconnect.php");
?>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<?php
@include("navigation.php");
?>
<!-------------------------------------------------------------------- -->
<div class="content-wrapper">
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.php">Home</a>
            </li>
            <li class="breadcrumb-item active">Input Data Dosen</li>
        </ol>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-table"></i> Input Data Dosen</div>
        <div class="card-body">
            <form id="formdosen" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="form-group">
                    <div class="col-md-6">
                        <label for="exampleInputName">Nama Dosen</label>
                        <input class="form-control" name="namadosen" id="exampleInputName" type="text" aria-describedby="nameHelp" placeholder="Masukkan Nama Dosen" onkeyup="this.value=this.value.toUpperCase()">
                    </div>
                    <br>
                    <div class="col-md-6">
                        <label for="exampleInputLastName">Gelar Depan</label>
                        <input class="form-control" name = "gelardepan" id="exampleInputLastName" type="text" aria-describedby="nameHelp" placeholder="Masukkan Gelar Depan" >
                    </div>
                    <br>
                    <div class="col-md-6">
                        <label for="exampleInputLastName">Gelar Belakang</label>
                        <input class="form-control" name="gelarbelakang" id="exampleInputLastName" type="text" aria-describedby="nameHelp" placeholder="Masukkan Gelar Belakang">
                    </div>
                    <br>
                </div>
                <button type="submit" class="btn btn-info btn-lg" >SUBMIT</button>
           </form>
        </div>
    </div>
</div>
</body>
</html>

<?php
$sql = "INSERT INTO dosen (nama_dosen,gelar_depan,gelar_belakang) VALUES ('".$_POST['namadosen']."','".$_POST['gelardepan']."','".$_POST['gelarbelakang']."')";
if(mysqli_query($conn, $sql)) {
   }
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


<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Simpan Data dosen</h4>
            </div>
            <div class="modal-body">Data dosen telah disimpan <br/>
                <input type="button" class="btn btn-success btn-sm" data-dismiss="modal" value="Confirm"/>
            </div>
        </div>
    </div>
</div>