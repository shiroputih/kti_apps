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
                    $sql = "SELECT * FROM mahasiswa,outline,angkatan,dosen,semester where mahasiswa.nim = outline.nim AND angkatan.id_angkatan = mahasiswa.id_angkatan AND dosen.id_dosen = outline.usulan_dosen1 AND semester.id_semester = mahasiswa.id_semester AND outline.verified ='belum terverifikasi'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($path = $result->fetch_assoc()) {
                            echo "<tr>
                                        <td>$path[nim]</td>
                                        <td>$path[nama]</td>
                                        <td>$path[judul_outline]</td>
                                        <td>$path[gelar_depan] $path[nama_dosen] $path[gelar_belakang]</td>
                                        <td>$path[tgl_pengajuan]</td>
                                        <td class='center'>

                                        <a id ='VerifikasiOutline' 
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
                                        data-verifikasi = '$path[verified]'
                                        data-toggle='modal' 
                                        data-target='#VerifikasiOutlineModal'>
                                        <button type='button' class='btn btn-warning btn-sm'>Verifikasi</button></a>
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
                                <div class="input-group-prepend">
                                    <label class="input-group-text">Pembimbing 1</label>
                                </div>
                                <select name="Dosen1" id="Dosen1" class="custom-select">
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
                                <div class="input-group-prepend">
                                    <label class="input-group-text">Pembimbing 2</label>
                                </div>
                                <select name="Dosen2" id="Dosen2" class="custom-select">
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
                                    <label class="input-group-text">Tanggal Verifikasi</label>
                                </div>
                                <input type='text' class="form-control" id="date" name="tanggal"
                                       placeholder="DD/MM/YYY"/>
                            </div>
                        </div>
                        <button type="submit" name="UpdateVerifikasiOutline" class="btn btn-info btn-lg">SUBMIT</button>
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
        var verifikasi = $(this).data('verifikasi');

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
        $('#statusverifikasi').val(verifikasi);

        $('#hiddenNama').val(nama_mahasiswa);
        $('#hiddenJudul').val(juduloutline);

    })
</script>

<?php
if (isset($_POST['UpdateVerifikasiOutline'])) {
    $sql = "UPDATE outline SET
    tgl_disetujui = '$_POST[tanggal]',
    dosen1 = '$_POST[Dosen1]',
    dosen2 = '$_POST[Dosen2]',
    verified = 'Terverifikasi'
    WHERE nim = '$_POST[hiddennim]'";
    if (mysqli_query($conn, $sql)) {
        //SAVE INTO TABLE PROPOSAL
        // field : nim, nama judul, dosen1, dosen 2
        $sql = "INSERT INTO proposal (nim,nama,judulproposal,dosen1,dosen2) VALUES ('" . $_POST[hiddennim] . "','" . $_POST[hiddenNama] . "','" . $_POST[hiddenJudul] . "','" . $_POST[Dosen1] . "','" . $_POST[Dosen2] . "')";
        if (mysqli_query($conn, $sql)) {
            echo "<meta http-equiv='refresh' content='0'>";
        }
    }

}
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
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>