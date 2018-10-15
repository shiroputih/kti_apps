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
            <li class="breadcrumb-item active"> Data Outline</li>
        </ol>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-table"></i>Data Outline
            <button type="button" style="margin-left: 80%; width: 8%" class="btn btn-primary btn-sm" data-toggle="modal"
                    data-target="#inputdataoutline">Add
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Judul Outline</th>
                    <th>Usulan Dosen 1</th>
                    <th>Tgl Pengajuan</th>
                    <th></th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Judul Outline</th>
                    <th>Usulan Dosen 1</th>
                    <th>Tgl Pengajuan</th>
                    <th></th>
                </tr>
                </tfoot>
                <tbody>
                <?php
                $sql = "SELECT * FROM mahasiswa,outline,angkatan,dosen,semester where mahasiswa.nim = outline.nim AND angkatan.id_angkatan = mahasiswa.id_angkatan AND dosen.id_dosen = outline.usulan_dosen1 AND semester.id_semester = mahasiswa.id_semester ";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($path = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>$path[nim]</td>
                                <td>$path[nama]</td>
                                <td>$path[judul_outline]</td>
                                <td>$path[gelar_depan]$path[nama_dosen]$path[gelar_belakang]</td>
                                <td>$path[tgl_pengajuan]</td>
                                <td class='center'>
                                <a id ='Viewoutline' 
                                    data-nimmahasiswa='$path[nim]'
                                    data-namamahasiswa='$path[nama]'  
                                    data-angkatan='$path[angkatan]' 
                                    data-semester='$path[semester]' 
                                    data-toggle='modal' 
                                    data-target='#ViewOutlineModal'>
                                <button type='button' class='btn btn-info btn-sm'>Detail</button></a>
                                
                                <a id ='Editoutline' 
                                    data-nimmahasiswa='$path[nim]' 
                                    data-namamahasiswa='$path[nama]'  
                                    data-juduloutline='$path[judul_outline]' 
                                    data-pertanyaan='$path[pertanyaan_penelitian]' 
                                    data-manfaat ='$path[manfaat_penelitian]' 
                                    data-desain ='$path[desain_penelitian]' 
                                    data-sample ='$path[sample_penelitian]' 
                                    data-bebas ='$path[variabel_bebas]' 
                                    data-tergantung ='$path[variabel_tergantung]' 
                                    data-hipotesis ='$path[hipotesis]' 
                                    data-usulandosen1 ='$path[usulan_dosen1]' 
                                    data-usulandosen2 ='$path[usulan_dosen2]'
                                    data-tanggal = '$path[tgl_pengajuan]'
                                    data-toggle='modal' 
                                    data-target='#EditOutlineModal'>
                                <button type='button' class='btn btn-warning btn-sm'>Edit</button></a>
                                
                                <a id ='Deleteoutline'
                                     data-nimmahasiswa='$path[nim]' 
                                     data-namamahasiswa='$path[nama]'  
                                     data-juduloutline='$path[judul_outline]' 
                                     data-toggle='modal' 
                                     data-target='#DeleteOutlineModal'>
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
</body>

<?php
@include("footer.php");
?>

<!-- Modal ADD Data Outline-->
<div class="modal fade" id="inputdataoutline" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Input Data Outline</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form id="formdosen" method="POST">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputsemester">Semester</label>
                                </div>
                                <select name="semester" class="custom-select" id="inputsemester">
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
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">NIM</label>
                            </div>
                            <?php
                            $sql = "SELECT nim,nama FROM mahasiswa WHERE NOT EXISTS (SELECT nim FROM outline WHERE mahasiswa.nim = outline.nim)";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                echo "<select name ='nimmahasiswa' class='custom-select' id='inputGroupSelect01'>";
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value=$row[nim]>$row[nim]  |   $row[nama]</option>";
                                }
                            } else {

                            }
                            echo "</select>";
                            ?>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text">Judul Penelitian</label>
                            </div>
                            <textarea rows="3" cols="50" name="JudulPenelitian" class="form-control" id="inputGroupNama"
                                      aria-describedby="nameHelp" placeholder="Judul Penelitian"
                                      onkeyup="this.value=this.value.toUpperCase()"></textarea>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text">Kata Kunci</label>
                            </div>
                            <input type='text' class="form-control" id="katakunci1" name="katakunci1"/>
                            <input type='text' class="form-control" id="katakunci1" name="katakunci1"/>
                            <input type='text' class="form-control" id="katakunci1" name="katakunci1"/>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text">Pertanyaan Penelitian</label>
                            </div>
                            <textarea rows="3" cols="50" class="form-control" name="pertanyaanpenelitian"
                                      id="inputGroupNama" aria-describedby="nameHelp"
                                      placeholder="Pertanyaan Penelitian"
                                      onkeyup="this.value=this.value.toUpperCase()"></textarea>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text">Manfaat Penelitian</label>
                            </div>
                            <textarea rows="3" cols="50" class="form-control" name="manfaatpenelitian"
                                      id="inputGroupNama" aria-describedby="nameHelp" placeholder="Manfaat Penelitian"
                                      onkeyup="this.value=this.value.toUpperCase()"></textarea>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text">Desain Penelitian</label>
                            </div>
                            <textarea rows="3" cols="50" class="form-control" name="desainpenelitian"
                                      id="inputGroupNama" aria-describedby="nameHelp" placeholder="Desain Penelitian"
                                      onkeyup="this.value=this.value.toUpperCase()"></textarea>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text">Sample Penelitian</label>
                            </div>
                            <textarea rows="3" cols="50" class="form-control" name="samplepenelitian"
                                      id="inputGroupNama" aria-describedby="nameHelp" placeholder="Sample Penelitian"
                                      onkeyup="this.value=this.value.toUpperCase()"></textarea>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text">Variabel Bebas</label>
                            </div>
                            <textarea rows="3" cols="50" class="form-control" id="inputGroupNama" name="variabelbebas"
                                      aria-describedby="nameHelp" placeholder="Variabel Bebas"
                                      onkeyup="this.value=this.value.toUpperCase()"></textarea>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text">Variabel Tergantung</label>
                            </div>
                            <textarea rows="3" cols="50" class="form-control" id="inputGroupNama"
                                      name="variabeltergantung" aria-describedby="nameHelp"
                                      placeholder="Variabel Tergantung"
                                      onkeyup="this.value=this.value.toUpperCase()"></textarea>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text">Hipotesis</label>
                            </div>
                            <textarea rows="3" cols="50" class="form-control" id="inputGroupNama" name="hipotesis"
                                      aria-describedby="nameHelp" placeholder="Hipotesis"
                                      onkeyup="this.value=this.value.toUpperCase()"></textarea>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text">Usulan Pembimbing 1</label>
                            </div>
                            <select class="custom-select" name="usulandosen1" id="inputsemester">
                                <?php
                                $sql = "SELECT * FROM dosen";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value=$row[id_dosen]>$row[gelar_depan] $row[nama_dosen] $row[gelar_belakang]</option>";
                                    }
                                } else {
                                    echo "0 results";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text">Usulan Pembimbing 2</label>
                            </div>
                            <select name="usulandosen2" class="custom-select">
                                <?php
                                $sql = "SELECT * FROM dosen";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value=$row[id_dosen]>$row[gelar_depan] $row[nama_dosen] $row[gelar_belakang]</option> ";
                                    }
                                } else {
                                    echo "0 results";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend" data-provide='datetimepicker1'>
                                <label class="input-group-text">Tanggal Pengajuan</label>
                            </div>
                            <input type='text' class="form-control" id="date" name="tanggal" placeholder="MM/DD/YYY"/>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend" data-provide='datetimepicker1'>
                                <label class="input-group-text">Verified</label>
                            </div>
                            <input type='text' class="form-control" id="verified" name="verified"
                                   value="Belum Terverifikasi" disabled/>
                        </div>
                        <button type="submit" name="AddDataOutline" class="btn btn-info btn-lg">SUBMIT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- view modal outline -->
    <div class="modal fade" id="ViewOutlineModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detail Data Outline</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" id="detailmahasiswa">
                    <div class="outline-data"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- End of -->
    <!-- Modal Edit outline -->
    <div class="modal fade" id="EditOutlineModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Data Outline</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" style="background-color: #f7ca77">
                    <div class="card-body">
                        <form id="formdosen" method="POST">
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="hiddennim" id="hiddennim" type="text"
                                       aria-describedby="nameHelp">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">NIM</label>
                                    </div>
                                    <input class="form-control" name="EditNim" id="EditNim" type="text"
                                           aria-describedby="nameHelp" disabled="">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Nama Mahasiswa</label>
                                    </div>
                                    <input class="form-control" name="EditNama" id="EditNama" type="text"
                                           aria-describedby="nameHelp" disabled="">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text">Judul Penelitian</label>
                                    </div>
                                    <textarea rows="3" cols="50" name="EditJudul" class="form-control" id="EditJudul"
                                              aria-describedby="nameHelp"
                                              onkeyup="this.value=this.value.toUpperCase()"></textarea>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text">Pertanyaan Penelitian</label>
                                    </div>
                                    <textarea rows="3" cols="50" class="form-control" name="EditPertanyaan"
                                              id="EditPertanyaan" aria-describedby="nameHelp"
                                              placeholder="Pertanyaan Penelitian"
                                              onkeyup="this.value=this.value.toUpperCase()"></textarea>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text">Manfaat Penelitian</label>
                                    </div>
                                    <textarea rows="3" cols="50" class="form-control" name="EditManfaat"
                                              id="EditManfaat" aria-describedby="nameHelp"
                                              placeholder="Manfaat Penelitian"
                                              onkeyup="this.value=this.value.toUpperCase()"></textarea>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text">Desain Penelitian</label>
                                    </div>
                                    <textarea rows="3" cols="50" class="form-control" name="EditDesain" id="EditDesain"
                                              aria-describedby="nameHelp" placeholder="Desain Penelitian"
                                              onkeyup="this.value=this.value.toUpperCase()"></textarea>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text">Sample Penelitian</label>
                                    </div>
                                    <textarea rows="3" cols="50" class="form-control" name="EditSample" id="EditSample"
                                              aria-describedby="nameHelp" placeholder="Sample Penelitian"
                                              onkeyup="this.value=this.value.toUpperCase()"></textarea>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text">Variabel Bebas</label>
                                    </div>
                                    <textarea rows="3" cols="50" class="form-control" id="EditBebas" name="EditBebas"
                                              aria-describedby="nameHelp" placeholder="Variabel Bebas"
                                              onkeyup="this.value=this.value.toUpperCase()"></textarea>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text">Variabel Tergantung</label>
                                    </div>
                                    <textarea rows="3" cols="50" class="form-control" id="EditTergantung"
                                              name="EditTergantung" aria-describedby="nameHelp"
                                              placeholder="Variabel Tergantung"
                                              onkeyup="this.value=this.value.toUpperCase()"></textarea>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text">Hipotesis</label>
                                    </div>
                                    <textarea rows="3" cols="50" class="form-control" id="EditHipotesis"
                                              name="EditHipotesis" aria-describedby="nameHelp" placeholder="Hipotesis"
                                              onkeyup="this.value=this.value.toUpperCase()"></textarea>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text">Usulan Pembimbing 1</label>
                                    </div>
                                    <select class="custom-select" name="EditDosen1" id="EditDosen1">
                                        <?php
                                        $sql = "SELECT * FROM dosen";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            // output data of each row
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value=$row[id_dosen]>$row[gelar_depan] $row[nama_dosen] $row[gelar_belakang]</option>";
                                            }
                                        } else {
                                            echo "0 results";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text">Usulan Pembimbing 2</label>
                                    </div>
                                    <select name="EditDosen2" id="EditDosen2" class="custom-select">
                                        <?php
                                        $sql = "SELECT * FROM dosen";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value=$row[id_dosen]>$row[gelar_depan] $row[nama_dosen] $row[gelar_belakang]</option> ";
                                            }
                                        } else {
                                            echo "0 results";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend" data-provide='datetimepicker1'>
                                        <label class="input-group-text">Tanggal Pengajuan</label>
                                    </div>
                                    <input type='text' class="form-control" id="EditTanggal" name="EditTanggal"
                                           placeholder="MM/DD/YYY" disabled/>
                                </div>
                                <button type="submit" name="EditDataOutline" class="btn btn-info btn-lg">SUBMIT</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal  Delete outline-->
    <div class="modal fade" id="DeleteOutlineModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Data Outline</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" style="background-color: #c82333">
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data">
                            <label>Apakah anda ingin menghapus data outline</label> <br>
                            <input type="hidden" id="hpsnim" name="hpsnim" class="form-control"></input><br>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text">NIM</label>
                                </div>
                                <input id="deletenim" name="deletenim" class="form-control" disabled></input>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text">NIM</label>
                                </div>
                                <input id="deletenama" class="form-control" disabled></input>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text">Judul Outline</label>
                                </div>
                                <input id="deletejudul" class="form-control" disabled></input>
                            </div>
                            <button type="submit" class="btn btn-info btn-lg" data-dismiss="modal">NO</button>
                            <button type="submit" name="DeleteDataOutline" class="btn btn-danger btn-lg">YES</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Javascript , ajax, jquery run here -->
    <!-- datepicker -->
    <script>
        $(document).ready(function () {
            var date_input = $('input[name="tanggal"]');
            var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
            var options = {
                format: 'dd/mm/yyyy',
                orientation: 'bottom',
                todayHighlight: true,
                autoclose: true,
            };
            date_input.datepicker(options);
        })
    </script>

    <!-- Show Detail outline -->
    <script type="text/javascript">
        $(document).ready(function () {
            $('#ViewOutlineModal').on('show.bs.modal', function (e) {
                var nim = $(e.relatedTarget).data('nimmahasiswa');
                //menggunakan fungsi ajax untuk pengambilan data
                $.ajax({
                    type: 'post',
                    url: 'detailoutline.php',
                    data: 'nim=' + nim,
                    success: function (data) {
                        $('.outline-data').html(data);//menampilkan data ke dalam modal
                    }
                });
            });
        })
    </script>

    <!-- edit outline -->
    <script type="text/javascript">
        $(document).on("click", "#Editoutline", function () {
            var NIM = $(this).data('nimmahasiswa');
            var nama_mahasiswa = $(this).data('namamahasiswa');
            var juduloutline = $(this).data('juduloutline');
            var pertanyaan = $(this).data('pertanyaan');
            var manfaat = $(this).data('manfaat');
            var desain = $(this).data('desain');
            var sample = $(this).data('sample');
            var bebas = $(this).data('bebas');
            var tergantung = $(this).data('tergantung');
            var hipotesis = $(this).data('hipotesis');
            var udosen1 = $(this).data('usulandosen1');
            var udosen2 = $(this).data('usulandosen2');
            var tanggal = $(this).data('tanggal');

            $('#EditNim').val(NIM);
            $('#hiddennim').val(NIM);
            $('#EditNama').val(nama_mahasiswa);
            $('#EditJudul').val(juduloutline);
            $('#EditPertanyaan').val(pertanyaan);
            $('#EditManfaat').val(manfaat);
            $('#EditDesain').val(desain);
            $('#EditSample').val(sample);
            $('#EditBebas').val(bebas);
            $('#EditTergantung').val(tergantung);
            $('#EditHipotesis').val(hipotesis);
            $('#EditDosen1').val(udosen1);
            $('#EditDosen2').val(udosen2);
            $('#EditTanggal').val(tanggal);
        })
    </script>

    <!-- delete outline -->
    <script type="text/javascript">
        $(document).on("click", "#Deleteoutline", function () {
            var NIM = $(this).data('nimmahasiswa');
            var nama = $(this).data('namamahasiswa');
            var judul = $(this).data('juduloutline');

            $('#deletenim').val(NIM);
            $('#hpsnim').val(NIM);
            $('#deletenama').val(nama);
            $('#deletejudul').val(judul);
        })
    </script>

    <?php
    if (isset($_POST['AddDataOutline'])) {
        $sql = "INSERT INTO outline (nim,judul_outline,pertanyaan_penelitian,manfaat_penelitian,desain_penelitian,sample_penelitian,variabel_bebas,variabel_tergantung,hipotesis ,usulan_dosen1,usulan_dosen2 ,tgl_pengajuan,verified) VALUES ('" . $_POST['nimmahasiswa'] . "','" . $_POST['JudulPenelitian'] . "','" . $_POST['pertanyaanpenelitian'] . "','" . $_POST['manfaatpenelitian'] . "','" . $_POST['desainpenelitian'] . "','" . $_POST['samplepenelitian'] . "','" . $_POST['variabelbebas'] . "','" . $_POST['variabeltergantung'] . "','" . $_POST['hipotesis'] . "','" . $_POST['usulandosen1'] . "','" . $_POST['usulandosen2'] . "','" . $_POST['tanggal'] . "','Belum Terverifikasi')";
        if (mysqli_query($conn, $sql)) {
            echo "<meta http-equiv='refresh' content='0'>";
        }
    }

    if (isset($_POST['EditDataOutline'])) {
        $sql = "UPDATE outline SET
            judul_outline = '$_POST[EditJudul]',
            pertanyaan_penelitian = '$_POST[EditPertanyaan]',
            manfaat_penelitian = '$_POST[EditManfaat]',
            desain_penelitian = '$_POST[EditDesain]',
            sample_penelitian = '$_POST[EditSample]',
            variabel_bebas = '$_POST[EditBebas]',
            variabel_tergantung = '$_POST[EditTergantung]',
            hipotesis = '$_POST[EditHipotesis]',
            usulan_dosen1 = '$_POST[EditDosen1]',
            usulan_dosen2 = '$_POST[EditDosen2]'
            WHERE nim = '$_POST[hiddennim]'";
        if (mysqli_query($conn, $sql)) {
            echo "<meta http-equiv='refresh' content='0'>";
        }

    }

    if (isset($_POST['DeleteDataOutline'])) {
        $sql = "DELETE FROM outline WHERE nim='$_POST[hpsnim]'";
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
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
