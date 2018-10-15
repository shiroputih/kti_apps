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
            <button type="button" style="margin-left: 1%; width: 4%" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#inputdatamahasiswa"><img src="icons/contactadd.png" width="30px" height="30px"></button>
            <button type="button" style="margin-left: 1%; width: 4%" class="btn btn-default btn-sm" data-toggle="modal" data-target="#inputdatamahasiswa"> <img src="icons/upload.jpg" width="30px" height="30px"></button>
            <div  class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover " id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr align="center">
                                <th>No</th>
                                <th>Nim</th>
                                <th>Nama</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no=1;
                            $sql = "SELECT * FROM mahasiswa";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) 
                            {
                                while ($row = $result->fetch_assoc()) 
                                {
                                    echo "<tr>
                                    <td align='center'>$no</td>
                                    <td>$row[nim]</td>
                                    <td>$row[nama]</td>
                                    <td align='center'>
                                    <a id ='Viewmahasiswa' data-nimmahasiswa='$row[nim]' data-namamahasiswa='$row[nama]' data-toggle='modal' data-target='#ViewmahasiswaModal'>
                                    <button type='button' class='btn btn-info btn-sm'>Detail</button></a>
                                    <a id ='Editmahasiswa' data-nimmahasiswa='$row[nim]' data-namamahasiswa='$row[nama]' data-toggle='modal' data-target='#EditmahasiswaModal'>
                                    <button type='button' class='btn btn-warning btn-sm'>Edit</button></a>
                                    <a id ='Deletemahasiswa' data-nimmahasiswa='$row[nim]' data-namamahasiswa='$row[nama]' data-toggle='modal' data-target='#DeletemahasiswaModal'>
                                    <button type='button' class='btn btn-danger btn-sm'>Delete</button></a>
                                    </td>
                                    </tr>";
                                    $no+=1;
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
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="exampleInputName">NIM Mahasiswa</label>
                                            </div>
                                            <input class="form-control" name="nimmahasiswa" id="exampleInputName" type="text"
                                        aria-describedby="nameHelp" placeholder="Masukkan NIM Mahasiswa"> 
                                        </div>
                                        
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="exampleInputLastName">Nama Mahasiswa</label>
                                            </div>
                                            <input class="form-control" name="namamahasiswa" id="exampleInputLastName" type="text"
                                        aria-describedby="nameHelp" placeholder="Masukkan Nama Mahasiswa" onkeyup="this.value=this.value.toUpperCase()">
                                        </div>
                                    </div>
                                <button type="submit" name="AddDataMahasiswa" class="btn btn-info btn-md" >SUBMIT</button>
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
                                    <button type="submit" name="UpdateDataMahasiswa" class="btn btn-info btn-lg">UPDATE</button>
                                </form>
                            </div>
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
                    <div class="modal-body" style="background-color: #c82333;">
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data">
                                <input type="hidden" class="form-control" name="deletenim" id="deletenim" type="text"
                                aria-describedby="nameHelp">
                                <div id="hapusmahasiswa"></div>
                                <br>
                                <button type="submit" class="btn btn-info btn-sm" data-dismiss="modal" data-dismiss="modal">NO</button>
                                <button type="submit" name="DeleteDataMahasiswa" class="btn btn-danger btn-sm" >YES</button>
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
            $sql = "INSERT INTO mahasiswa (nim,nama) VALUES ('".$_POST['nimmahasiswa']."','".$_POST['namamahasiswa']."')";
            if (mysqli_query($conn, $sql)) {
                echo "<meta http-equiv='refresh' content='0'>";
            }
        }

        if (isset($_POST['UpdateDataMahasiswa'])) {
        //update tabel mahasiswa
            $sql = "UPDATE mahasiswa SET nama='$_POST[namamahasiswa]' WHERE nim = '$_POST[nimmahasiswa]'";
            if (mysqli_query($conn, $sql)) {
                echo "<meta http-equiv='refresh' content='0'>";
            }
        }

        if (isset($_POST['DeleteDataMahasiswa'])) {
        //update tabel mahasiswa
            $sql = "DELETE FROM mahasiswa WHERE nim = '$_POST[deletenim]'";
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
            });
        </script> 

        <!-- delete mahasiswa -->
        <script type="text/javascript">
            $(document).on("click", "#Deletemahasiswa", function () {
                var NIM = $(this).data('nimmahasiswa');
                var nama_mahasiswa = $(this).data('namamahasiswa');

                $('#deletenim').val(NIM);
                $('#deletenama').val(nama_mahasiswa);
            });
        </script> 

        <!-- Show Detail Mahasiswa -->
        <script type="text/javascript">
            $(document).ready(function()
            {
                $('#ViewmahasiswaModal').on('show.bs.modal', function (e) 
                {
                    var nim = $(e.relatedTarget).data('nimmahasiswa');
                            //menggunakan fungsi ajax untuk pengambilan data
                            $.ajax(
                            {
                                type : 'post',
                                url : 'detailmahasiswa.php',
                                data :  'nim='+ nim,
                                success : function(data)
                                {
                                    $('.fetched-data').html(data);//menampilkan data ke dalam modal
                                }
                            });
                        });
            });
        </script> 
        <!-- hapus Mahasiswa -->
        <script type="text/javascript">
            $(document).ready(function()
            {
                $('#DeletemahasiswaModal').on('show.bs.modal', function (e) 
                {
                    var nim = $(e.relatedTarget).data('nimmahasiswa');
                            //menggunakan fungsi ajax untuk pengambilan data
                            $.ajax(
                            {
                                type : 'post',
                                url : 'hapusmahasiswa.php',
                                data :  'nim='+ nim,
                                success : function(data)
                                {
                                    $('#hapusmahasiswa').html(data);//menampilkan data ke dalam modal
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
            <script src="vendor/chart.js/Chart.min.js"></script>
            <script src="vendor/datatables/jquery.dataTables.js"></script>
            <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
            <!-- Custom scripts for all pages-->
            <script src="js/sb-admin.min.js"></script>
            <!-- Custom scripts for this page-->
            <script src="js/sb-admin-datatables.min.js"></script>
            <script src="js/sb-admin-charts.min.js"></script>
