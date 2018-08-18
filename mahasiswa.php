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
                <li class="breadcrumb-item active">Data Mahasiswa</li>
            </ol>
        </div>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-table"></i>Data Mahasiswa
                <button type="button" style="margin-left: 80%; width: 8%" class="btn btn-primary btn-sm" data-toggle="modal"
                data-target="#inputdatamahasiswa"> Add
            </button>
        </div>
        
        <div  class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nim</th>
                            <th>Nama</th>
                            <th>Angkatan</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nim</th>
                            <th>Nama</th>
                            <th>Angkatan</th>
                            <th>Keterangan</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM mahasiswa,gender,angkatan,semester where gender.id_gender = mahasiswa.id_gender AND angkatan.id_angkatan = mahasiswa.id_angkatan AND semester.id_semester = mahasiswa.id_semester";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                        // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                <td>$row[nim]</td>
                                <td>$row[nama]</td>
                                <td>$row[angkatan]</td>
                                <td class='center'>
                                <a id ='Viewmahasiswa' data-nimmahasiswa=$row[nim] data-namamahasiswa='$row[nama]'  data-gender='$row[gender]' data-angkatan='$row[angkatan]' data-semester='$row[semester]' data-toggle='modal' data-target='#ViewmahasiswaModal'>
                                <button type='button' class='btn btn-info btn-sm'>Detail</button></a>
                                <a id ='Editmahasiswa' data-nimmahasiswa=$row[nim] data-namamahasiswa='$row[nama]'  data-idgender='$row[id_gender]' data-angkatan='$row[angkatan]' data-semester='$row[semester]' data-toggle='modal' data-target='#EditmahasiswaModal'>
                                <button type='button' class='btn btn-warning btn-sm'>Edit</button></a>
                                <a id ='deletemahasiswa' data-nimmahasiswa=$row[nim] data-namamahasiswa='$row[nama]'  data-gender='$row[gender]' data-angkatan='$row[angkatan]' data-semester='$row[semester]' data-toggle='modal' data-target='#DeletemahasiswaModal'>
                                <button type='button' class='btn btn-danger btn-sm'>Delete</button></a>
                                </td>
                                </tr>";
                            }
                        } else {

                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>
</div>
</body>
<?php
@include("footer.php");
?>



<!-- Modals function -->
<!-- Modal Add Data Mahasiswa -->
<div class="modal fade" id="inputdatamahasiswa" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Input Data Mahasiswa</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form id="formmahasiswa" method="POST">
                        <div class="form-group">
                            <div class="col-md-6">
                                <label for="exampleInputName">NIM Mahasiswa</label>
                                <input class="form-control" name="nimmahasiswa" id="exampleInputName" type="text"
                                aria-describedby="nameHelp" placeholder="Masukkan NIM Mahasiswa">
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputLastName">Nama Mahasiswa</label>
                                <input class="form-control" name="namamahasiswa" id="exampleInputLastName" type="text"
                                aria-describedby="nameHelp" placeholder="Masukkan Nama Mahasiswa" onkeyup="this.value=this.value.toUpperCase()">
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputLastName">Gender</label>
                                <div class="form-group" placeholder="Pilih Angkatan">
                                    <select name="gender" class="form-control">
                                        <?php
                                        $sql = "SELECT * FROM gender";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                                // output data of each row
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value=$row[id_gender]>$row[gender]</option>";
                                            }
                                        } else {
                                            echo "0 results";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputLastName">Angkatan</label>
                                <div class="form-group" placeholder="Pilih Angkatan">
                                    <select name="angkatan" class="form-control">
                                        <?php
                                        $sql = "SELECT * FROM angkatan";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                                // output data of each row
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value=$row[id_angkatan]>$row[angkatan]</option>";
                                            }
                                        } else {
                                            echo "0 results";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputLastName">Semester</label>
                                <div class="form-group">
                                    <select name="semester" class="form-control">
                                        <?php
                                        $sql = "SELECT * FROM semester";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                                // output data of each row
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value=$row[id_semester]>$row[semester]</option>";
                                            }
                                        } else {
                                            echo "0 results";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <br>
                        </div>
                        <button type="submit" name="AddDataMahasiswa" class="btn btn-info btn-lg">SUBMIT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal View Detail-->
<div class="modal fade" id="ViewmahasiswaModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Data Mahasiswa</h4><button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="detailmahasiswa">
                <div class="fetched-data"></div>
            </div>
        </div>
    </div>
</div>

<!-- Modal  Edit mahasiswa-->
<div class="modal fade" id="EditmahasiswaModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Data Mahasiswa</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="background-color: #f7ca77">
                <div class="card-body">
                    <form id="formdosen" method="POST">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input type="hidden" class="form-control" name="nimmahasiswa" id="nimmahasiswa" type="text"
                            aria-describedby="nameHelp">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">NIM Mahasiswa</label>
                                </div>    
                                <input class="form-control" name="shownim" id="shownim" type="text"
                                aria-describedby="nameHelp" placeholder="Masukkan NIM Mahasiswa" disabled="">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="exampleInputLastName">Nama Mahasiswa</label>
                                </div> 
                                <input class="form-control" name="namamahasiswa" id="namamahasiswa" type="text"
                                aria-describedby="nameHelp" placeholder="Masukkan Nama Mahasiswa" onkeyup="this.value=this.value.toUpperCase()">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="exampleInputLastName">Gender</label>
                                </div> 
                                <select name="EditGender" id="EditGender" class="form-control">
                                    <?php
                                    $sql = "SELECT * FROM gender";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                                // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value=$row[id_gender]>$row[gender]</option>";
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="exampleInputLastName">Angkatan</label>
                                </div>
                                <input class="form-control" name="angkatan" id="angkatan" type="hidden"
                                aria-describedby="nameHelp" placeholder="Masukkan NIM Mahasiswa" disabled="">
                                <select name="angkatan" id="angkatan" class="form-control">
                                    <?php
                                    $sql = "SELECT * FROM angkatan";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                                // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value=$row[id_angkatan]>$row[angkatan]</option>";
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                                    ?>
                                </select>  
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="exampleInputLastName">Semester</label>
                                </div>
                                <input class="form-control" name="semester" id="semester" type="hidden"
                                aria-describedby="nameHelp" placeholder="Masukkan NIM Mahasiswa" disabled="">
                                <select name="semester" id="semester" class="form-control">
                                    <?php
                                    $sql = "SELECT * FROM semester";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value=$row[id_semester]>$row[semester]</option>";
                                        }                                            
                                    }else {
                                        echo "0 results";
                                    }
                                    ?>
                                </select>
                        </div>
                        <button type="submit" name="UpdateDataMahasiswa" class="btn btn-info btn-lg">UPDATE</button>
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal  Delete Mahasiswa-->
    <div class="modal fade" id="DeletemahasiswaModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Data Mahasiswa</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" style="background-color: #c82333">
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data">
                            <label for="exampleInputLastName">Apakah anda ingin menghapus data mahasiswa</label> <br>
                            <input type="hidden" id="lblnim" name="lblnim" class="form-control">
                            nim :<input id="deletenim" name="deletenim" class="form-control" disabled></input><br>
                            nama :<input id="deletenama" class="form-control" disabled></input><br>
                            <button type="submit" class="btn btn-info btn-lg" data-dismiss="modal">NO</button>
                            <button type="submit" name="DeleteDataMahasiswa" class="btn btn-danger btn-lg">YES</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Of Modal Function -->

    <!--  All function mahasiswa -->
    <?php
    if (isset($_POST['AddDataMahasiswa'])) {
        $sql = "INSERT INTO mahasiswa (nim,nama,id_angkatan,id_gender,id_semester) VALUES ('".$_POST['nimmahasiswa']."','".$_POST['namamahasiswa']."','".$_POST['angkatan']."','".$_POST['gender']."','".$_POST['semester']."')";
        if (mysqli_query($conn, $sql)) {
            echo "<meta http-equiv='refresh' content='0'>";
        }
    }

    if (isset($_POST['UpdateDataMahasiswa'])) {
        $sql = "UPDATE mahasiswa SET nama='$_POST[namamahasiswa]',id_angkatan='$_POST[angkatan]',id_gender='$_POST[EditGender]',id_semester='$_POST[semester]' where nim='$_POST[nimmahasiswa]'";
        if (mysqli_query($conn, $sql)) {
            echo "<meta http-equiv='refresh' content='0'>";
        }
    }

    if (isset($_POST['DeleteDataMahasiswa'])) {
        $sql = "DELETE FROM mahasiswa WHERE nim='$_POST[lblnim]'";
        if (mysqli_query($conn, $sql)) {
            echo "<meta http-equiv='refresh' content='0'>";
        }
    }
    ?>
    <!-- END OF FUNCTIONS -->


    <!-- javascript edit data mahasiswa -->
    <script type="text/javascript">
        $(document).on("click", "#Editmahasiswa", function () {
            var NIM = $(this).data('nimmahasiswa');
            var nama_mahasiswa = $(this).data('namamahasiswa');
            var idgender = $(this).data('idgender');
            var angkatan = $(this).data('angkatan');
            var semester = $(this).data('semester');

            $('#nimmahasiswa').val(NIM);
            $('#shownim').val(NIM);
            $('#namamahasiswa').val(nama_mahasiswa);
            $('#EditGender').val(idgender);
            $('#angkatan').val(angkatan);
            $('#semester').val(semester);

        })
    </script> 

    <!-- delete mahasiswa -->
    <script type="text/javascript">
        $(document).on("click", "#deletemahasiswa", function () {
            var NIM = $(this).data('nimmahasiswa');
            var nama_mahasiswa = $(this).data('namamahasiswa');

            $('#deletenim').val(NIM);
            $('#deletenama').val(nama_mahasiswa);
            $('#lblnim').val(NIM);
        })
    </script> 

    <!-- Show Detail Mahasiswa -->
    <script type="text/javascript">
        $(document).ready(function(){
            $('#ViewmahasiswaModal').on('show.bs.modal', function (e) {
                var nim = $(e.relatedTarget).data('nimmahasiswa');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : 'detailmahasiswa.php',
                data :  'nim='+ nim,
                success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
            }
        });
        });
        });
    </script> 

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

