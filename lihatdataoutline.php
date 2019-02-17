<?php
@include("header.php");
@include("navigation.php");
@include("dbconnect.php");
?>

    <body class="fixed-nav sticky-footer bg-dark" id="page-top">
        <div class="fixed-nav sticky-footer bg-dark" id="page-top">
            <div class="content-wrapper">
                <div class="container-fluid">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.php">Home</a>
                        </li>
                        <li class="breadcrumb-item active"> Data Outline</li>
                    </ol>
                </div>
                <button type="button" style="margin-left: 1%; width: 4%" class="btn btn-default btn-sm" data-toggle="modal" data-target="#inputdataoutlineModal"><img src="icons/contactadd.png" width="30px" height="30px"></button>
                <button type="button" style="margin-left: 1%; width: 4%" class="btn btn-default btn-sm" data-toggle="modal"
                data-target="#uploadoutlinemodal"><img src="icons/upload.jpg" width="30px" height="30px"></button>

                <div id="tableoutline" class="table-responsive">
                </div>
            </div>
        </div>
    </body>

<?php
@include("footer.php");
?>

<!-- upload modal -->
    <div class="modal fade" id="uploadoutlinemodal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Upload Outline Mahasisswa</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <form action="uploadoutline.php" method="post" enctype="multipart/form-data" id="uploadfileoutline" >
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputsemester">Semester</label>
                                </div>
                                <select name="semester" class="custom-select" id="inputsemester">
                                    <option>--Pilih Semester--</option>
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

                        <input type="file" name="file" />
                        <input type="submit" class="btn btn-primary btn-md" name="importOutline" value="IMPORT">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal ADD Data Outline-->
    <div class="modal fade" id="inputdataoutlineModal" tabindex="1" style="overflow-y: auto;" role="dialog">
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
                                        <label class="input-group-text" for="inputGroupSelect01">NIM</label>
                                    </div>
                                    <?php
                                        $sql = "SELECT nim,nama FROM mahasiswa WHERE NOT EXISTS (SELECT nim FROM outline WHERE mahasiswa.nim = outline.nim) ORDER BY nim ASC";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            echo "<select name ='nimmahasiswa' class='custom-select' id='inputGroupSelect01'>";
                                            echo "<option>--Pilih Mahasiswa--</option>";
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value=$row[nim]>$row[nim] | $row[nama]</option>";
                                            }
                                        } else {
                                            echo "<input type='text' style='background-color:red;'class='form-control' value='Maaf Semua Mahasiswa Sudah Diinputkan'/></input>";
                                        }
                                        echo "</select>";
                                    ?>
                                </div>
                                <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="inputsemester">Semester</label>
                                        </div>
                                        <select name="semester" class="custom-select" id="inputsemester">
                                            <option>--Pilih Semester--</option>
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
                                <input type='text' class="form-control" placeholder="Kata Kunci 1" id="katakunci1" name="katakunci1" onkeyup="this.value=this.value.toUpperCase()"/>
                                <input type='text' class="form-control" placeholder="Kata Kunci 2" id="katakunci2" name="katakunci2" onkeyup="this.value=this.value.toUpperCase()"/>
                                <input type='text' class="form-control" placeholder="Kata Kunci 3" id="katakunci3" name="katakunci3" onkeyup="this.value=this.value.toUpperCase()"/>

                                <a href="ViewCheckJudul" id ='checkjudul' data-toggle='modal' data-target='#ViewCheckJudul'>
                                    <button type='button' id = "btncheck" class='btn btn-info btn-md'>Check Judul</button></a>
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
                                        <option>--Pilih Dosen Pembimbing 1--</option>
                                        <?php
                                        $sql = "SELECT * FROM dosen ORDER BY nama_dosen ASC";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        // output data of each row
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value=$row[id_dosen]>$row[nama_dosen] $row[gelar_depan] $row[gelar_belakang]</option>";
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
                                        <option>--Pilih Dosen Pembimbing 2--</option>
                                        <?php
                                        $sql = "SELECT * FROM dosen ORDER BY nama_dosen ASC";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value=$row[id_dosen]>$row[nama_dosen] $row[gelar_depan] $row[gelar_belakang]</option> ";
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
                                        <label class="input-group-text">Status</label>
                                    </div>
                                    <input type='text' class="form-control" id="verified" name="status"
                                    value="NULL" disabled/>
                                </div>
                                <button type="submit" name="AddDataOutline" class="btn btn-info btn-md" >Simpan</button>
                            </form>
                            </div>
                        </div>
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
                    <div class="modal-body" id="detailoutline">
                        <div class="outline-data"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- End of -->

        <!-- view check judul outline -->
        <div class="modal fade" id="ViewCheckJudul" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Judul yang Terdeteksi</h4>
                        <button type="button" class="close" id="closeModal"  data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body" id="detailoutline">
                        <div class="data-checkjudul">
                        </div>
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
                                    <input type="hidden" class="form-control" name="hiddenJudul" id="hiddenJudul" type="text"
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
                                        style="text-transform:uppercase"></textarea>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text">Pertanyaan Penelitian</label>
                                        </div>
                                        <textarea rows="3" cols="50" class="form-control" name="EditPertanyaan"
                                        id="EditPertanyaan" aria-describedby="nameHelp"
                                        placeholder="Pertanyaan Penelitian"
                                        style="text-transform:uppercase"></textarea>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text">Manfaat Penelitian</label>
                                        </div>
                                        <textarea rows="3" cols="50" class="form-control" name="EditManfaat"
                                        id="EditManfaat" aria-describedby="nameHelp"
                                        placeholder="Manfaat Penelitian"
                                        style="text-transform:uppercase"></textarea>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text">Desain Penelitian</label>
                                        </div>
                                        <textarea rows="3" cols="50" class="form-control" name="EditDesain" id="EditDesain"
                                        aria-describedby="nameHelp" placeholder="Desain Penelitian"
                                        style="text-transform:uppercase"></textarea>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text">Sample Penelitian</label>
                                        </div>
                                        <textarea rows="3" cols="50" class="form-control" name="EditSample" id="EditSample"
                                        aria-describedby="nameHelp" placeholder="Sample Penelitian"
                                        style="text-transform:uppercase"></textarea>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text">Variabel Bebas</label>
                                        </div>
                                        <textarea rows="3" cols="50" class="form-control" id="EditBebas" name="EditBebas"
                                        aria-describedby="nameHelp" placeholder="Variabel Bebas"
                                        style="text-transform:uppercase"></textarea>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text">Variabel Tergantung</label>
                                        </div>
                                        <textarea rows="3" cols="50" class="form-control" id="EditTergantung"
                                        name="EditTergantung" aria-describedby="nameHelp"
                                        placeholder="Variabel Tergantung"
                                        style="text-transform:uppercase"></textarea>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text">Hipotesis</label>
                                        </div>
                                        <textarea rows="3" cols="50" class="form-control" id="EditHipotesis"
                                        name="EditHipotesis" aria-describedby="nameHelp" placeholder="Hipotesis"
                                        style="text-transform:uppercase"></textarea>
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
                                    <button type="submit" name="EditDataOutline" class="btn btn-info btn-lg" >SUBMIT</button>
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
                                <input type="hidden" id="hpsid" name="hpsid" class="form-control">
                                <input type="hidden" id="hpsnim" name="hpsnim" class="form-control">
                                <div id="hapusoutline"></div>
                                <br>
                            <button type="submit" class="btn btn-info btn-sm" data-dismiss="modal" data-dismiss="modal">NO</button>
                            <button type="submit" name="Deleteoutline" class="btn btn-danger btn-sm" >YES</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Javascript , ajax, jquery run here -->
        <script type="text/javascript">
            $(document).ready(function(){
                $('#closeModal').click(function(){
                    $('#inputdataoutlineModal').modal('show');
                });

                $('#btncheck').click(function(){
                    $('#inputdataoutlineModal').modal('hide');
                });
            });
        </script>

        <!-- datepicker -->
        <script type="text/javascript">
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

                $.ajax({
                    url : 'getoutlineall.php',
                    type:'post',
                    cache : false,
                    success : function(data)
                    {
                        $('#tableoutline').html(data);
                    }
                    });
                })
        </script>

        <!-- Show Check Judul -->
        <script type="text/javascript">
            $(document).ready(function(){
                $(document).on("click", "#checkjudul", function () {
                    var kk1 = document.getElementById('katakunci1').value;
                    var kk2 = document.getElementById('katakunci2').value;
                    var kk3 = document.getElementById('katakunci3').value;
                    $('#inputdataoutlineModal').modal('hide');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : 'checkjudul.php',
                data :  "kk1="+kk1+"&kk2="+kk2+"&kk3="+kk3,
                success : function(data){
                $('.data-checkjudul').html(data);//menampilkan data ke dalam modal
            }

        });
        });
            });
        </script>

        <!-- Show Detail outline -->
        <script type="text/javascript">
            $(document).ready(function(){
                $('#ViewOutlineModal').on('show.bs.modal', function (e) {
                    var nim = $(e.relatedTarget).data('nimmahasiswa');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : 'detailoutline.php',
                data :  'nim='+ nim,
                success : function(data){
                $('.outline-data').html(data);//menampilkan data ke dalam modal
            }
        });
        });
            });
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
                $('#hiddenJudul').val(juduloutline);
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
                var idoutline =  $(this).data('idoutline');
                var NIM = $(this).data('nimmahasiswa');
                var nama = $(this).data('namamahasiswa');
                var judul = $(this).data('juduloutline');

                $('#deletenim').val(NIM);
                $('#hpsid').val(idoutline);
                $('#hpsnim').val(NIM);
                $('#deletenama').val(nama);
                $('#deletejudul').val(judul);

                $.ajax({
                type : 'post',
                url : 'hapusoutline.php',
                data :  'id='+ idoutline,
                success : function(data){
                    $('#hapusoutline').html(data);//menampilkan data ke dalam modal
                }
            });
            })
        </script>

        <?php
        if (isset($_POST['AddDataOutline'])) {
            $sql = "INSERT INTO outline (nim,judul_outline,pertanyaan_penelitian,manfaat_penelitian,desain_penelitian,sample_penelitian,variabel_bebas,variabel_tergantung,hipotesis ,usulan_dosen1,usulan_dosen2 ,tgl_pengajuan,status,semester,kk1,kk2,kk3) VALUES ('" . $_POST['nimmahasiswa'] . "','" . $_POST['JudulPenelitian'] . "','" . $_POST['pertanyaanpenelitian'] . "','" . $_POST['manfaatpenelitian'] . "','" . $_POST['desainpenelitian'] . "','" . $_POST['samplepenelitian'] . "','" . $_POST['variabelbebas'] . "','" . $_POST['variabeltergantung'] . "','" . $_POST['hipotesis'] . "','" . $_POST['usulandosen1'] . "','" . $_POST['usulandosen2'] . "','" . $_POST['tanggal'] . "','','".$_POST['semester']."','".$_POST['katakunci1']."','".$_POST['katakunci2']."','".$_POST['katakunci3']."')";
            if (mysqli_query($conn, $sql)) {

            }
        }

        if (isset($_POST['EditDataOutline'])) {
            $sql = "UPDATE outline SET
            judul_outline = UPPER('$_POST[EditJudul]'),
            pertanyaan_penelitian = UPPER('$_POST[EditPertanyaan]'),
            manfaat_penelitian = UPPER('$_POST[EditManfaat]'),
            desain_penelitian = UPPER('$_POST[EditDesain]'),
            sample_penelitian = UPPER('$_POST[EditSample]'),
            variabel_bebas = UPPER('$_POST[EditBebas]'),
            variabel_tergantung = UPPER('$_POST[EditTergantung]'),
            hipotesis = UPPER('$_POST[EditHipotesis]'),
            usulan_dosen1 = '$_POST[EditDosen1]',
            usulan_dosen2 = '$_POST[EditDosen2]'
            WHERE nim = '$_POST[hiddennim]'";
            if (mysqli_query($conn, $sql)) {

         }
/*
         $sqlupdateproposal = "UPDATE proposal SET judulproposal = '$_POST[EditJudul]' WHERE proposal.nim = '$_POST[hiddennim]'";
         if (mysqli_query($conn, $sqlupdateproposal)) {
            echo "<meta http-equiv='refresh' content='0'>";
        }

        $sqlupdatesemhas = "UPDATE semhas SET judulKTI = '$_POST[EditJudul]' WHERE semhas.nim = '$_POST[hiddennim]'";
        if (mysqli_query($conn, $sqlupdatesemhas)) {
            echo "<meta http-equiv='refresh' content='0'>";
        }

        $sqlupdatekti = "UPDATE kti SET judulkti = '$_POST[EditJudul]' WHERE kti.nim = '$_POST[hiddennim]'";
        if (mysqli_query($conn, $sqlupdatekti)) {
            echo "<meta http-equiv='refresh' content='0'>";
        }
*/
    }

    if (isset($_POST['Deleteoutline'])) {
        $sql = "DELETE FROM outline WHERE id_outline='".$_POST['hpsid']."'";
        if (mysqli_query($conn, $sql)) {

        }
    }

    ?>
