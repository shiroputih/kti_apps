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
                <li class="breadcrumb-item active">Data Outline</li>
            </ol>
        </div>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-table"></i> Verifikasi Data Outline
            </div>
            <hr>
            <div class="container-fluid">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Semester</label>
                    </div>
                    <select class="custom-select" name="semester" id="semester"  selected="selected">
                        <option>-- Pilih Semester --</option>
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
            <div class="card-body">
                <div id="tabeloutline"></div>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>
    </div>

</body>
<?php
@include("footer.php");
?>

<!-- Modal content Detail-->
<div class="modal fade" id="VerifikasiOutlineModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Verifikasi Outline Mahasiswa</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form id="formdosen" method="POST">
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="hiddennim" id="hiddennim" type="text"
                            aria-describedby="nameHelp">
                            <input type="hidden" class="form-control" name="hiddenNama" id="hiddenNama" type="text"
                            aria-describedby="nameHelp">
                            <input type="hidden" class="form-control" name="hiddenJudul" id="hiddenJudul" type="text"
                            aria-describedby="nameHelp">
                            <input type="hidden" class="form-control" name="hiddensemester" id="hiddensemester" type="text"
                            aria-describedby="nameHelp">
                             <input type="hidden" class="form-control" name="hiddendosen1" id="hiddendosen1" type="text"
                            aria-describedby="nameHelp">
                             <input type="hidden" class="form-control" name="hiddendosen2" id="hiddendosen2" type="text"
                            aria-describedby="nameHelp">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Semester</label>
                                </div>
                                 <select class="custom-select" name="semester" id="semester" disabled>
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
                                aria-describedby="nameHelp" onkeyup="this.value=this.value.toUpperCase()"
                                disabled></textarea>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text">Pertanyaan Penelitian</label>
                                </div>
                                <textarea rows="3" cols="50" class="form-control" name="EditPertanyaan"
                                id="EditPertanyaan" aria-describedby="nameHelp"
                                placeholder="Pertanyaan Penelitian"
                                onkeyup="this.value=this.value.toUpperCase()" disabled></textarea>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text">Manfaat Penelitian</label>
                                </div>
                                <textarea rows="3" cols="50" class="form-control" name="EditManfaat" id="EditManfaat"
                                aria-describedby="nameHelp" placeholder="Manfaat Penelitian"
                                onkeyup="this.value=this.value.toUpperCase()" disabled></textarea>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text">Desain Penelitian</label>
                                </div>
                                <textarea rows="3" cols="50" class="form-control" name="EditDesain" id="EditDesain"
                                aria-describedby="nameHelp" placeholder="Desain Penelitian"
                                onkeyup="this.value=this.value.toUpperCase()" disabled=""></textarea>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text">Sample Penelitian</label>
                                </div>
                                <textarea rows="3" cols="50" class="form-control" name="EditSample" id="EditSample"
                                aria-describedby="nameHelp" placeholder="Sample Penelitian"
                                onkeyup="this.value=this.value.toUpperCase()" disabled=""></textarea>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text">Variabel Bebas</label>
                                </div>
                                <textarea rows="3" cols="50" class="form-control" id="EditBebas" name="EditBebas"
                                aria-describedby="nameHelp" placeholder="Variabel Bebas"
                                onkeyup="this.value=this.value.toUpperCase()" disabled></textarea>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text">Variabel Tergantung</label>
                                </div>
                                <textarea rows="3" cols="50" class="form-control" id="EditTergantung"
                                name="EditTergantung" aria-describedby="nameHelp"
                                placeholder="Variabel Tergantung"
                                onkeyup="this.value=this.value.toUpperCase()" disabled></textarea>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text">Hipotesis</label>
                                </div>
                                <textarea rows="3" cols="50" class="form-control" id="EditHipotesis"
                                name="EditHipotesis" aria-describedby="nameHelp" placeholder="Hipotesis"
                                onkeyup="this.value=this.value.toUpperCase()" disabled></textarea>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text">Usulan Pembimbing 1</label>
                                </div>
                                <select class="custom-select" name="EditDosen1" id="EditDosen1" disabled>
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
                                <select name="EditDosen2" id="EditDosen2" class="custom-select" disabled>
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
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Status Verifikasi</label>
                                </div>
                                <input class="form-control" name="statusverifikasi" id="statusverifikasi" type="text"
                                aria-describedby="nameHelp" disabled="">
                            </div>
                            
                            <div class="input-group mb-3">
                                <div class="input-group-prepend" data-provide='datetimepicker1'>
                                    <label class="input-group-text">Tanggal Verifikasi</label>
                                </div>
                                <input type='text' class="form-control" id="date" name="tanggal"
                                placeholder="DD/MM/YYY"/>
                            </div>
                        </div>
                        <button type="submit" name="LolosVerifikasiOutline" class="btn btn-info btn-sm" >Lolos</button>
                        <button type="submit" name="TidakLolosVerifikasiOutline" class="btn btn-danger btn-sm" >Tidak Lolos</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

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

<!-- verifikasi -->
<script type="text/javascript">
    $(document).on("click", "#VerifikasiOutline", function () {
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
        var status = $(this).data('status');
        var semester = $(this).data('semester');

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
        $('#status').val(status);
        $('#hiddenNama').val(nama_mahasiswa);
        $('#hiddenJudul').val(juduloutline);
        $('#hiddensemester').val(semester);
        $('#hiddendosen1').val(udosen1);
        $('#hiddendosen2').val(udosen2);

    })
</script>

<!-- show detail outline semester -->
 <script type="text/javascript">
    $(document).ready(function(){
        $('#semester').change(function(){
            var id = $(this).find(":selected").val();
            $.ajax({
                url : 'getoutlinepersemester.php',
                type:'post',
                data : 'idsemester='+ id,
                cache : false,
                success : function(data)
                {
                    $('#tabeloutline').html(data);
                }
            });
        });
    });
 </script> 
<?php
if (isset($_POST['LolosVerifikasiOutline'])) {
    $sql = "UPDATE outline SET
    tgl_disetujui = '$_POST[tanggal]',
    status = 'Lolos Outline'
    WHERE nim = '$_POST[hiddennim]'";
    
    if (mysqli_query($conn, $sql)) {
        echo "<meta http-equiv='refresh' content='0'>";
    } 

        //SAVE INTO TABLE PROPOSAL AND Table assign_dosen
        // field : nim, nama judul, dosen1, dosen 2

    $sql = "INSERT INTO proposal (nim,nama,judulproposal,dosen1,dosen2,id_semester) 
       VALUES ('". $_POST[hiddennim] . "','". $_POST[hiddenNama] . "','". $_POST[hiddenJudul] . "','" . $_POST[hiddendosen1] . "','". $_POST[hiddendosen2] . "','".$_POST[hiddensemester]."')";
    if (mysqli_query($conn, $sql)) {
                echo "<meta http-equiv='refresh' content='0'>";
     }

    //insert into sk1
    $sql = "INSERT INTO sk1 (id_semester,id_dosen1,nim) VALUES ('". $_POST[hiddensemester] . "','". $_POST[hiddendosen1] . "','". $_POST[hiddennim] . "')";
    if (mysqli_query($conn, $sql)) {
                echo "<meta http-equiv='refresh' content='0'>";
     } 

      //insert into sk2
    $sql = "INSERT INTO sk2 (id_semester,id_dosen2,nim) VALUES ('". $_POST[hiddensemester] . "','". $_POST[hiddendosen2] . "','". $_POST[hiddennim] . "')";
    if (mysqli_query($conn, $sql)) {
                echo "<meta http-equiv='refresh' content='0'>";
     } 

    //insert into sk
    $sql = "INSERT INTO sk (id_dosen1sk,id_dosen2sk,id_semestersk,nim_sk) VALUES ('". $_POST[hiddendosen1] . "','". $_POST[hiddendosen2] . "','". $_POST[hiddensemester] . "','". $_POST[hiddennim] . "')";
    if (mysqli_query($conn, $sql)) {
                echo "<meta http-equiv='refresh' content='0'>";
     } 
}
?>

<?php
if (isset($_POST['TidakLolosVerifikasiOutline'])) {
    $sql = "UPDATE outline SET
    tgl_disetujui = '$_POST[tanggal]',
    status = 'Tidak Lolos Outline'
    WHERE nim = '$_POST[hiddennim]'";
    if (mysqli_query($conn, $sql)) {
       echo "<meta http-equiv='refresh' content='0'>";    
     }
 }

?>
<!-- Bootstrap core JavaScript
    <script src="vendor/jquery/jquery.min.js"></script>-->
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