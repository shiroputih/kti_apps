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
                <li class="breadcrumb-item active">Data Verifikasi Outline</li>
            </ol>
        </div>
        <div class="card-body">
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
            <div id="tabeloutline" class="table-responsive-sm"></div>
    </div>
</body>

<?php
@include("footer.php");
?>

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
        $('#hiddennim').val(NIM);

        $.ajax({
                url : 'getverifikasi.php',
                type:'post',
                data : 'nim='+ NIM,
                cache : false,
                success : function(data)
                {
                    $('#form-verifikasioutline').html(data);
                }
            });
    });
</script>


<!-- show outline persemester -->
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
    foreach($_POST['verifikasi'] as $verify)
    {
        $tgl_verifikasi = date('d/m/Y');
        $sql = "UPDATE outline SET tgl_disetujui = '$tgl_verifikasi', status = 'Lolos Outline' WHERE nim = '$verify'";
        if (mysqli_query($conn, $sql)) {
            //$sql_select = "SELECT * FROM outline,mahasiswa WHERE outline.nim = '$verify' AND mahasiswa.nim = '$verify'";
            $sql_select = "SELECT semester.id_semester as semester, semester.id_tahunajaran as idtahunajaran, outline.nim,outline.usulan_dosen1 as dosen1, outline.nim,outline.usulan_dosen2 as dosen2 FROM outline
            JOIN semester ON semester.id_semester = outline.semester
            JOIN mahasiswa ON mahasiswa.nim = '$verify'
            WHERE outline.nim = '$verify'
            ";
            $result = $conn->query($sql_select);
            if ($result->num_rows > 0){
                while ($row = $result->fetch_assoc()) {
                    $sql_insertSKdosen1 = "INSERT INTO assign_sk (id_dosen,nim,id_semester,id_tahunajaran,assign_dosen,status_sk)
                    VALUES ('$row[dosen1]','$row[nim]','$row[semester]','$row[idtahunajaran]','pembimbing 1','aktif')";
                    if (mysqli_query($conn, $sql_insertSKdosen1)) {

                    }
                    $sql_insertSKdosen2 = "INSERT INTO assign_sk (id_dosen,nim,id_semester,id_tahunajaran,assign_dosen,status_sk)
                    VALUES ('$row[dosen2]','$row[nim]','$row[semester]','$row[idtahunajaran]','pembimbing 2','aktif')";
                    if (mysqli_query($conn, $sql_insertSKdosen2)) {

                    }
                    $sql_insertToProposal = "INSERT INTO proposal (nim,judulproposal,tgl_sidangproposal,id_semester,status_proposal)
                    VALUES ('$row[nim]','$row[judul_outline]','00/00/0000','0','0')";
                    if (mysqli_query($conn, $sql_insertToProposal)) {

                    }
                    $sql_insertToLogHistory = "INSERT INTO loghistoryjudul (nim,judul_penelitian,stage)
                    VALUES ('$row[nim]','$row[judul_outline]','OUTLINE')";
                    if (mysqli_query($conn, $sql_insertToLogHistory)) {

                    }
                }
            }
        }
    }
}

if (isset($_POST['TidakLolosVerifikasiOutline'])) {
    foreach($_POST['verifikasi'] as $verify)
    {
        $tgl_verifikasi = date('d/m/Y');
        $sql = "UPDATE outline SET tgl_disetujui = '$tgl_verifikasi', status = 'Tidak Lolos Outline' WHERE nim = '$verify'";
        if (mysqli_query($conn, $sql)) {

        }
    }
}

?>
