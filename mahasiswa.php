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
            
            <button type="button" style="margin-left: 1%; width: 4%" class="btn btn-default btn-sm" data-toggle="modal" data-target="#inputdatamahasiswa"><img src="icons/contactadd.png" width="30px" height="30px"></button>
            
            <a href="javascript:void(0);" onclick="$('#uploadfilemhs').slideToggle();">
                <button type="button" style="margin-left: 1%; width: 4%" class="btn btn-default btn-sm" > <img src="icons/upload.jpg" width="30px" height="30px"></button>
            </a>
             <form action="uploadmhs.php" method="post" class = "uploadbar" enctype="multipart/form-data" id="uploadfilemhs" >
                    <input type="file" name="file" />
                    <input type="submit" class="btn btn-primary btn-sm" name="importSubmit" value="IMPORT">
                </form>
            
            <div id="tablemahasiswa" class="table-responsive">
            </div>

        </div>
    </body>

    <?php
    @include("footer.php");
    ?>

<!-- Modal Data Mahasiswa -->

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
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="exampleInputLastName">Angkatan</label>
                                    </div>
                                    <select name="angkatan" class="custom-select" id="angkatan">
                                        <option>-- Pilih Angkatan --</option>
                                    <?php
                                    $sql = "SELECT * FROM angkatan";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value=$row[id_angkatan]>$row[angkatan]</option>";
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                                    ?>
                                </select>
                                </div>
                                Terdaftar KTI pada
                                <hr>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="exampleInputLastName">Semester</label>
                                    </div>
                                    <select name="semester" class="custom-select" id="semester">
                                        <option>-- Pilih Semester --</option>
                                        <?php
                                            $sql = "SELECT * FROM semester";
                                            $result = $conn->query($sql);
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<option value=$row[id_semester]>$row[semester]</option>";
                                                }
                                            } else {
                                                echo "0 results";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="exampleInputLastName">Tahun Ajaran</label>
                                    </div>
                                    <select name="tahunajaran" class="custom-select" id="tahunajaran">
                                        <option>-- Pilih Tahun Ajaran --</option>
                                    <?php
                                    $sql = "SELECT * FROM tahunajaran";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value=$row[id_tahunajaran]>$row[tahunajaran]</option>";
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                                    ?>
                                </select>
                                </div>
                            </div>
                            <button type="submit" name="AddDataMahasiswa" class="btn btn-info btn-md" >SUBMIT</button>
                        </form>
                    </div>
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
                                    aria-describedby="nameHelp" placeholder="Masukkan Nama Mahasiswa" style="text-transform: uppercase;">
                                </div>
                                 <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="exampleInputLastName">Angkatan</label>
                                    </div>
                                    <select name="editangkatan" id="editangkatan" class="custom-select">
                                    <?php
                                    $sql = "SELECT * FROM angkatan";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value=$row[id_angkatan]>$row[angkatan]</option>";
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                                    ?>
                                </select>
                                </div>
                                Terdaftar KTI pada
                                <hr>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="exampleInputLastName">Semester</label>
                                    </div>
                                    <select name="editsemester" id="editsemester" class="custom-select">
                                        <?php
                                        $sql = "SELECT * FROM semester";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value=$row[id_semester]>$row[semester]</option>";
                                            }
                                        } else {
                                            echo "0 results";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="exampleInputLastName">Tahun Ajaran</label>
                                    </div>
                                    <select name="edittahunajaran" class="custom-select" id="edittahunajaran">
                                    <?php
                                    $sql = "SELECT * FROM tahunajaran";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value=$row[id_tahunajaran]>$row[tahunajaran]</option>";
                                        }
                                    } else {
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

<!-- End Of Modal Function -->

    <script type="text/javascript">
        $(document).ready(function(){
            //hide upload
            $('#uploadfilemhs').hide();
            $.ajax({
            url : 'getmahasiswaall.php',
            type:'post',
            cache : false,
            success : function(data)
            {
                $('#tablemahasiswa').html(data);
            }
            });

            $('#ViewmahasiswaModal').on('show.bs.modal', function (e) 
            {
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

        $(document).on("click", "#Editmahasiswa", function () {
            var NIM = $(this).data('nimmahasiswa');
            var nama_mahasiswa = $(this).data('namamahasiswa');
            var tahunajaran = $(this).data('idtahunajaran');
            var angkatan = $(this).data('idangkatan');
            var semester = $(this).data('idsemester');
            
            $('#nimmahasiswa').val(NIM);
            $('#shownim').val(NIM);
            $('#editangkatan').val(angkatan);
            $('#editsemester').val(semester);
            $('#edittahunajaran').val(tahunajaran);
            $('#namamahasiswa').val(nama_mahasiswa);
        });

        $(document).on("click", "#Deletemahasiswa", function () {
            var nim = $(this).data('nimmahasiswa');
            var nama_mahasiswa = $(this).data('namamahasiswa');

            $('#deletenim').val(nim);
            $('#deletenama').val(nama_mahasiswa);
            
            $.ajax({
                type : 'post',
                url : 'hapusmahasiswa.php',
                data :  'nim='+ nim,
                success : function(data){
                    $('#hapusmahasiswa').html(data);//menampilkan data ke dalam modal
                }
            });
        });
    </script>

    
<?php
    if (isset($_POST['AddDataMahasiswa'])) {
        $sql = "INSERT INTO mahasiswa (nim,nama,id_tahunajaran,id_semester,id_angkatan) VALUES ('".$_POST['nimmahasiswa']."','".$_POST['namamahasiswa']."','".$_POST['tahunajaran']."','".$_POST['semester']."','".$_POST['angkatan']."')";
        if (mysqli_query($conn, $sql)) {
            
        }
    }

    if (isset($_POST['UpdateDataMahasiswa'])) {
        //update tabel mahasiswa
        $sql = "UPDATE mahasiswa SET nama=UPPER('$_POST[namamahasiswa]'),id_tahunajaran = '$_POST[edittahunajaran]',id_semester = '$_POST[editsemester]', id_angkatan = $_POST[editangkatan] WHERE nim = '$_POST[nimmahasiswa]'";
        if (mysqli_query($conn, $sql)) {
            
        }
    }

    if (isset($_POST['DeleteDataMahasiswa'])) {
        //update tabel mahasiswa
        $sql = "DELETE FROM mahasiswa WHERE nim = '$_POST[deletenim]'";
        if (mysqli_query($conn, $sql)) {
            
        }
    }
?>