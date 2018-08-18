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
                <li class="breadcrumb-item active">Data Dosen</li>
            </ol>
        </div>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-table"></i>Data Dosen
                <button type="button" style="margin-left: 80%; width: 8%" class="btn btn-primary btn-sm" data-toggle="modal"
                data-target="#inputdatadosen"> Add
            </button>
        </div>
        <div id="Table" class="card-body">
            <div id="tabledosen" class="table-responsive">
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Dosen</th>
                            <th>Nama Dosen</th>
                            <th>Gelar Depan</th>
                            <th>Gelar Belakang</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID Dosen</th>
                            <th>Nama Dosen</th>
                            <th>Gelar Depan</th>
                            <th>Gelar Belakang</th>
                            <th>Keterangan</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM dosen";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                        // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                <td>$row[id_dosen]</td>
                                <td>$row[nama_dosen]</td>
                                <td>$row[gelar_depan]</td>
                                <td>$row[gelar_belakang]</td>
                                <td class=center>
                                <a id ='editdosen' data-iddosen=$row[id_dosen] data-namadosen='$row[nama_dosen]' data-gelardepan='$row[gelar_depan]' data-gelarbelakang='$row[gelar_belakang]' data-toggle='modal' data-target='#editModal'>
                                <button type='button' class='btn btn-warning btn-sm'>Edit</button></a>
                                <a id ='deletedosen' data-iddosen=$row[id_dosen] data-namadosen='$row[nama_dosen]' data-gelardepan='$row[gelar_depan]' data-gelarbelakang='$row[gelar_belakang]' data-toggle='modal' data-target='#deleteModal'>
                                <button type='button' class='btn btn-danger btn-sm'>Delete</button></a>
                                </td>
                                </tr>";
                            }
                        } else {
                            echo "0 results";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<?php
@include("footer.php");
?>

<!-- insert form -->
<div class="modal fade" id="inputdatadosen" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Input Data Dosen</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form id="formdosen" method="POST">
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="exampleInputName">Nama Dosen</label>
                                <input class="form-control" name="namadosen" id="exampleInputName" type="text"
                                aria-describedby="nameHelp" placeholder="Masukkan Nama Dosen"
                                onkeyup="this.value=this.value.toUpperCase()">
                            </div>
                            <br>
                            <div class="col-md-6">
                                <label for="exampleInputLastName">Gelar Depan</label>
                                <input class="form-control" name="gelardepan" id="exampleInputLastName" type="text"
                                aria-describedby="nameHelp" placeholder="Masukkan Gelar Depan">
                            </div>
                            <br>
                            <div class="col-md-6">
                                <label for="exampleInputLastName">Gelar Belakang</label>
                                <input class="form-control" name="gelarbelakang" id="exampleInputLastName" type="text"
                                aria-describedby="nameHelp" placeholder="Masukkan Gelar Belakang">
                            </div>
                            <br>
                        </div>
                        <button type="submit" name="adddata" class="btn btn-info btn-lg">SUBMIT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit and Update Modal content Detail-->
<div class="modal fade" id="editModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Data Dosen</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="background-color: #f7ca77">
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="iddosen" id="iddosen" type="text"
                            aria-describedby="nameHelp">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="namadosen">Nama Dosen</label>
                                </div>
                                <input class="form-control" name="namadosen" id="namadosen" type="text"
                                aria-describedby="nameHelp" placeholder="Masukkan Nama Dosen"
                                onkeyup="this.value=this.value.toUpperCase()">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                     <label class="input-group-text" for="exampleInputLastName">Gelar Depan</label>
                                 </div>
                                <input class="form-control" name="gelardepan" id="gelardepan" type="text"
                                aria-describedby="nameHelp" placeholder="Masukkan Gelar Depan">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="exampleInputLastName">Gelar Belakang</label>
                                </div>
                                <input class="form-control" name="gelarbelakang" id="gelarbelakang" type="text"
                                aria-describedby="nameHelp" placeholder="Masukkan Gelar Belakang">
                            </div>
                        </div>
                        <button type="submit" name="updatedata" class="btn btn-info btn-lg">SUBMIT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Data Dosen</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="background-color: #c82333">
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data">
                        <label for="exampleInputLastName">Apakah anda ingin menghapus data dosen</label> <br>
                        <input type="hidden" id="labeliddosen" name="labeliddosen" class="form-control"></input><br>
                        nama dosen :<input id="labelnmdosen" class="form-control" disabled></input><br>
                        <button type="submit" class="btn btn-info btn-lg" data-dismiss="modal">NO</button>
                        <button type="submit" name="deletedata" class="btn btn-danger btn-lg">YES</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).on("click", "#editdosen", function () {
        var id_dosen = $(this).data('iddosen');
        var nama_dosen = $(this).data('namadosen');
        var gelar_depan = $(this).data('gelardepan');
        var gelar_belakang = $(this).data('gelarbelakang');

        $('#iddosen').val(id_dosen);
        $('#namadosen').val(nama_dosen);
        $('#gelardepan').val(gelar_depan);
        $('#gelarbelakang').val(gelar_belakang);

    })
</script>

<script type="text/javascript">
    $(document).on("click", "#deletedosen", function () {
        var id_dosen = $(this).data('iddosen');
        var nama_dosen = $(this).data('namadosen');

        $('#labeliddosen').val(id_dosen);
        $('#labelnmdosen').val(nama_dosen);
    })
</script>

<?php
if (isset($_POST['adddata'])) {
    $sql = "INSERT INTO dosen (nama_dosen,gelar_depan,gelar_belakang) VALUES ('" . $_POST['namadosen'] . "','" . $_POST['gelardepan'] . "','" . $_POST['gelarbelakang'] . "')";
    if (mysqli_query($conn, $sql)) {
        echo "<meta http-equiv='refresh' content='0'>";
    }
}

if (isset($_POST['updatedata'])) {
    $sql = "UPDATE dosen SET nama_dosen ='$_POST[namadosen]',gelar_depan='$_POST[gelardepan]',gelar_belakang='$_POST[gelarbelakang]' WHERE id_dosen='$_POST[iddosen]'";
    if (mysqli_query($conn, $sql)) {
        echo "<meta http-equiv='refresh' content='0'>";
    }
}

if (isset($_POST['deletedata'])) {
    $sql = "DELETE FROM dosen WHERE id_dosen='$_POST[labeliddosen]'";
    if (mysqli_query($conn, $sql)) {
        echo "<meta http-equiv='refresh' content='0'>";
    }
}
?>

<!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
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

