<?php
@include("dbconnect.php");
if ($_POST['nim']) {
    $query = "SELECT * FROM mahasiswa,outline,dosen WHERE dosen.id_dosen = outline.usulan_dosen1 AND mahasiswa.nim = outline.nim AND outline.nim = '" . $_POST['nim'] . "'";
    $result = mysqli_query($conn, $query);
    foreach ($result as $row) {
        ?>
        <body>
        <form id="formverifikasi" method="POST">
            <table class="table">
                <input type="text" class="form-control" name="hiddennim" id="hiddennim" type="text"
                       aria-describedby="nameHelp" value="<?php echo $_POST['nim']; ?>">
                <input type="text" class="form-control" name="hiddenname" id="hiddennim" type="text"
                       aria-describedby="nameHelp" value="<?php echo $_POST['nama']; ?>">
                <input type="text" class="form-control" name="hiddenjudul" id="hiddennim" type="text"
                       aria-describedby="nameHelp" value="<?php echo $_POST['judul_outline']; ?>">
                <tr>
                    <td width="20%">Nim</td>
                    <td><?php echo $row['nim']; ?></td>
                </tr>
                <tr>
                    <td>Nama Mahasiswa</td>
                    <td><?php echo $row['nama']; ?></td>
                </tr>
                <tr>
                    <td>Judul Outline</td>
                    <td><?php echo $row['judul_outline']; ?></td>
                </tr>
                <tr>
                    <td>Pertanyaan Penelitian</td>
                    <td><?php echo $row['pertanyaan_penelitian']; ?></td>
                </tr>
                <tr>
                    <td>Manfaat Penelitian</td>
                    <td><?php echo $row['manfaat_penelitian']; ?></td>
                </tr>
                <tr>
                    <td>Desain Penelitian</td>
                    <td><?php echo $row['desain_penelitian']; ?></td>
                </tr>
                <tr>
                    <td>Sample Penelitian</td>
                    <td><?php echo $row['sample_penelitian']; ?></td>
                </tr>
                <tr>
                    <td>Variabel Bebas</td>
                    <td><?php echo $row['variabel_bebas']; ?></td>
                </tr>
                <tr>
                    <td>Variabel Tergantung</td>
                    <td><?php echo $row['variabel_tergantung']; ?></td>
                </tr>
                <tr>
                    <td>Hipotesis</td>
                    <td><?php echo $row['hipotesis']; ?></td>
                </tr>

                <tr>
                    <td>Usulan Dosen 1</td>
                    <td><?php echo $row['gelar_depan']." ".$row['nama_dosen']."".$row['gelar_belakang'];?></td>
                </tr>

                <tr>
                    <td>Usulan Dosen 2</td>
                    <td>
                        <?php
                        $sql = "SELECT * from dosen,outline WHERE $row[usulan_dosen2] = dosen.id_dosen LIMIT 1";
                        $result = mysqli_query($conn, $sql);
                        foreach ($result as $path) {
                            echo $path['gelar_depan'] . " " . $path['nama_dosen'] . " " . $path['gelar_belakang'];
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Tanggal Pengajuan</td>
                    <td><?php echo $row['tgl_pengajuan']; ?></td>
                </tr>
                <tr>
                    <td>Status Verifikasi</td>
                    <td><?php echo $row['verified']; ?></td>
                </tr>
                <tr>
                    <td>Dosen Pembimbing 1</td>
                    <td>
                        <select class="custom-select" name="dosen1" id="inputsemester">
                            <?php
                            $sql = "SELECT * FROM dosen";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value=$row[id_dosen]>$row[gelar_depan] $row[nama_dosen] $row[gelar_belakang]</option>";
                                }
                            } else {
                                echo "0 results";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Dosen Pembimbing 2</td>
                    <td>
                        <select class="custom-select" name="dosen2" id="inputsemester">
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
                    </td>
                </tr>
                <div class="input-group mb-3">
                    <div class="input-group-prepend" data-provide='datetimepicker1'>
                        <label class="input-group-text">Tanggal Verifikasi</label>
                    </div>
                    <input type='text' class="form-control" id="date" name="tanggal" placeholder="DD/MM/YYY"/>
                </div>
            </table>
            <button type="submit" name="VerifikasiDataOutline" class="btn btn-info btn-lg" data-dismiss="modal">Validasi</button>
        </form>
        </body>
        <?php
    }
}
?>
<!-- edit outline -->
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
    })
</script>

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


<?php
if (isset($_POST['UpdateVerifikasiOutline'])) {
    $sql = "UPDATE outline SET
            tgl_disetujui = '$_POST[tanggal]',
            dosen1 = '$_POST[Dosen1]',
            dosen2 = '$_POST[Dosen2]',
            verified = 'Terverifikasi'
            WHERE nim = '$_POST[hiddennim]'";
    if (mysqli_query($conn, $sql)) {
        $sql = "INSERT INTO proposal (nim,nama,judulproposal,dosen1,dosen2) VALUES ('" . $_POST[hiddennim] . "','" . $_POST[hiddenname] . "','" . $_POST[hiddenjudul] . "','" . $_POST[EditDosen1] . "','" . $_POST[EditDosen2] . "')";
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