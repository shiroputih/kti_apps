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
                    <li class="breadcrumb-item active"> Data Nilai KTI</li>
                </ol>
            </div>
                <div class="tabelnilaikti" class="table-responsive"></div>
        </div>
    </div>
</body>

    <?php
    @include("footer.php");
    ?>

<script type="text/javascript">
       $(document).ready(function()
       {
        $.ajax({
                    url : 'getnilaiktiall.php',
                    type:'post',
                    cache : false,
                    success : function(data)
                    {
                        $('.tabelnilaikti').html(data);
                    }
                });
    });
    </script>

<!-- Detail Nilai Mahasiswa-->
<div class="modal fade" id="DetailNilaiModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Nilai KTI</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                   <div class="datanilai"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
        $(document).ready(function(){
                $(document).on("click","#detail1",function(){
                        var nim = $(this).data('nim');
                        var iddosen = $(this).data('iddosen');
                        //menggunakan fungsi ajax untuk pengambilan data
                        $.ajax({
                            type : 'post',
                            url : 'getnilaipermahasiswa.php',
                            data :  'nim='+nim,
                            success : function(data){
                                $('.datanilai').html(data);//menampilkan data ke dalam modal
                            }
                        });
                    });
                });
</script>
<!-- -------------------------------------Input Nilai Dosen Penguji 1 Modal --------------------------------------- -->

<div class="modal fade" id="AddNilai1Modal1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Input Nilai KTI (Dosen Penguji 1)</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input class="form-control" name="hiddennim" id="hiddennim" type="hidden"
                                    aria-describedby="nameHelp" >
                                <input class="form-control" name="hiddenDosen1" id="hiddenDosen1" type="hidden"
                                    aria-describedby="nameHelp" >

                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">NIM</label>
                                </div>
                                <input class="form-control" name="ktiNim" id="ktiNim" type="text"
                                    aria-describedby="nameHelp" disabled="">
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Nama</label>
                                </div>
                                <input class="form-control" name="EditNim" id="ktiNama" type="text"
                                    aria-describedby="nameHelp" disabled="">
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Dosen Penguji 1</label>
                                </div>

                                <select class="custom-select" id = 'ktiDosen1' name="ktiDosen1"  disabled>
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
                            <hr width="10px">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Penulisan Isi</label>
                                </div>
                                <input class="form-control input-sm"name="nilaiisi1" id="nilaiisi1" type="text"
                                       aria-describedby="nameHelp" >
                                       <label class="input-group-text" for="inputGroupSelect01">(20)</label>

                                <div class="input-group-prepend" style='margin-left: 20px;'>
                                    <label class="input-group-text" for="inputGroupSelect01">Metodologi</label>
                                </div>
                                <input class="form-control input-sm" name="nilaimetodologi1" id="nilaimetodologi" type="text"
                                       aria-describedby="nameHelp" >
                                       <label class="input-group-text" for="inputGroupSelect01">(10)</label>

                                <div class="input-group-prepend" style='margin-left: 20px;'>
                                    <label class="input-group-text" for="inputGroupSelect01">Penguasaan Materi</label>
                                </div>
                                <input class="form-control input-sm" name="nilaimateri1" id="nilaimateri" type="text"
                                aria-describedby="nameHelp" >
                                <label class="input-group-text" for="inputGroupSelect01">(40)</label>

                                <div class="input-group-prepend" style='margin-left: 20px;'>
                                    <label class="input-group-text" for="inputGroupSelect01">Materi dan Presentasi</label>
                                </div>
                                <input class="form-control input-sm" name="nilaipresentasi1" id="nilaipresentasi" type="text"
                                aria-describedby="nameHelp" >
                                <label class="input-group-text" for="inputGroupSelect01">(30)</label>
                            </div>
                        </div>
                        <button type="submit" name="addnilai1" class="btn btn-primary btn-sm" >Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="EditNilaiModal1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Nilai KTI (Dosen Penguji 1)</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input class="form-control" name="Edithiddennim" id="Edithiddennim" type="hidden"
                                    aria-describedby="nameHelp" >
                                <input class="form-control" name="EdithiddenDosen1" id="EdithiddenDosen1" type="hidden"
                                    aria-describedby="nameHelp" >

                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">NIM</label>
                                </div>
                                <input class="form-control" name="EditktiNim" id="EditktiNim" type="text"
                                    aria-describedby="nameHelp" disabled="">
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Nama</label>
                                </div>
                                <input class="form-control" name="EditNim" id="EditktiNama" type="text"
                                    aria-describedby="nameHelp" disabled="">
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Dosen Penguji 1</label>
                                </div>

                                <select class="custom-select" id = 'EditktiDosen1' name="EditktiDosen1"  disabled>
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
                            <hr width="10px">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Penulisan Isi</label>
                                </div>
                                <input class="form-control input-sm"name="nilaiisi1" id="nilaiisi1" type="text"
                                       aria-describedby="nameHelp" >
                                       <label class="input-group-text" for="inputGroupSelect01">(20)</label>

                                <div class="input-group-prepend" style='margin-left: 20px;'>
                                    <label class="input-group-text" for="inputGroupSelect01">Metodologi</label>
                                </div>
                                <input class="form-control input-sm" name="nilaimetodologi1" id="nilaimetodologi" type="text"
                                       aria-describedby="nameHelp" >
                                       <label class="input-group-text" for="inputGroupSelect01">(10)</label>

                                <div class="input-group-prepend" style='margin-left: 20px;'>
                                    <label class="input-group-text" for="inputGroupSelect01">Penguasaan Materi</label>
                                </div>
                                <input class="form-control input-sm" name="nilaimateri1" id="nilaimateri" type="text"
                                aria-describedby="nameHelp" >
                                <label class="input-group-text" for="inputGroupSelect01">(40)</label>

                                <div class="input-group-prepend" style='margin-left: 20px;'>
                                    <label class="input-group-text" for="inputGroupSelect01">Materi dan Presentasi</label>
                                </div>
                                <input class="form-control input-sm" name="nilaipresentasi1" id="nilaipresentasi" type="text"
                                aria-describedby="nameHelp" >
                                <label class="input-group-text" for="inputGroupSelect01">(30)</label>
                            </div>
                        </div>
                        <button type="submit" name="editnilai1" class="btn btn-primary btn-sm" >Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
		$(document).on("click", "#addnilai1", function () {
            //add nilai
            var NIM = $(this).data('nim');
            var nama_mahasiswa = $(this).data('nama');
            var iddosen = $(this).data('iddosen1');

            $('#ktiNim').val(NIM);
            $('#ktiNama').val(nama_mahasiswa);
            $('#ktiDosen1').val(iddosen);

            $('#hiddennim').val(NIM);
            $('#hiddenDosen1').val(iddosen);

            var number = document.getElementById('ktiDosen1');
            selectItemByValue(number, iddosen);

        });

        $(document).on("click", "#editnilai1", function () {
            var NIM = $(this).data('nim');
            var nama_mahasiswa = $(this).data('nama');
            var iddosen = $(this).data('iddosen1');
            $('#EditktiNim').val(NIM);
            $('#EditktiNama').val(nama_mahasiswa);
            $('#EditktiDosen1').val(iddosen);

            $('#Edithiddennim').val(NIM);
            $('#EdithiddenDosen1').val(iddosen);
        });
    </script>

<?php
    if (isset($_POST['addnilai1'])) {
        //change function into update table nilai_perdosen
        $sql_updatenilai = "UPDATE nilai_perdosen SET nilai_perdosen_isi = '$_POST[nilaiisi1]',nilai_perdosen_metode ='$_POST[nilaimetodologi1]',
        nilai_perdosen_materi ='$_POST[nilaimateri1]',nilai_perdosen_presentasi='$_POST[nilaipresentasi1]', status_nilai='1' WHERE id_dosen = '$_POST[hiddenDosen1]' AND nim = '$_POST[hiddennim]'";
        if (mysqli_query($conn, $sql_updatenilai))
        {
        }
    }
    if (isset($_POST['editnilai1'])) {
        //change function into update table nilai_perdosen
        $sql_editnilai = "UPDATE nilai_perdosen SET nilai_perdosen_isi = '$_POST[nilaiisi1]',nilai_perdosen_metode ='$_POST[nilaimetodologi1]',
        nilai_perdosen_materi ='$_POST[nilaimateri1]',nilai_perdosen_presentasi='$_POST[nilaipresentasi1]', status_nilai='1' WHERE id_dosen = '$_POST[EdithiddenDosen1]' AND nim = '$_POST[Edithiddennim]'";
        if (mysqli_query($conn, $sql_editnilai))
        {
        }
        echo $sql_editnilai;
    }
?>
<!--------------------------------------------------End Of Nilai 1---------------------------------------------- -->

<!------------------------------------- Input Nilai Dosen Penguji 2 Modal ------------------------------------------->
<div class="modal fade" id="AddNilaiModal2" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Input Nilai KTI (Dosen Penguji 2)</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" >
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input class="form-control" name="hiddennim2" id="hiddennim2" type="hidden"
                                       aria-describedby="nameHelp" >
                                <input class="form-control" name="hiddenDosen2" id="hiddenDosen2" type="hidden"
                                       aria-describedby="nameHelp" >
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">NIM</label>
                                </div>
                                <input class="form-control" name="ktiNim2" id="ktiNim2" type="text"
                                       aria-describedby="nameHelp" disabled="">
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Nama</label>
                                </div>
                                <input class="form-control" name="ktiNama2" id="ktiNama2" type="text"
                                       aria-describedby="nameHelp" disabled="">
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Dosen Penguji 2</label>
                                </div>
                                <select class="custom-select" name="ktiDosen2" id="ktiDosen2" disabled>
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
                            <hr width="10px">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Penulisan Isi</label>
                                </div>
                                <input class="form-control input-sm"name="nilaiisi2" id="nilaiisi2" type="text"
                                       aria-describedby="nameHelp" >
                                       <label class="input-group-text" for="inputGroupSelect01">(20)</label>

                                <div class="input-group-prepend" style='margin-left: 20px;'>
                                    <label class="input-group-text" for="inputGroupSelect01">Metodologi</label>
                                </div>
                                <input class="form-control input-sm" name="nilaimetodologi2" id="nilaimetodologi2" type="text"
                                       aria-describedby="nameHelp" >
                                       <label class="input-group-text" for="inputGroupSelect01">(10)</label>

                                <div class="input-group-prepend" style='margin-left: 20px;'>
                                    <label class="input-group-text" for="inputGroupSelect01">Penguasaan Materi</label>
                                </div>
                                <input class="form-control input-sm" name="nilaimateri2" id="nilaimateri2" type="text"
                                aria-describedby="nameHelp" >
                                <label class="input-group-text" for="inputGroupSelect01">(40)</label>

                                <div class="input-group-prepend" style='margin-left: 20px;'>
                                    <label class="input-group-text" for="inputGroupSelect01">Materi dan Presentasi</label>
                                </div>
                                <input class="form-control input-sm" name="nilaipresentasi2" id="nilaipresentasi2" type="text"
                                aria-describedby="nameHelp" >
                                <label class="input-group-text" for="inputGroupSelect01">(30)</label>
                            </div>
                        </div>
                        <button type="submit" name="addnilai2" class="btn btn-primary btn-sm" >Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="EditNilaiModal2" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Nilai KTI (Dosen Penguji 2)</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input class="form-control" name="Edithiddennim2" id="Edithiddennim2" type="hidden"
                                    aria-describedby="nameHelp" >
                                <input class="form-control" name="EdithiddenDosen2" id="EdithiddenDosen2" type="hidden"
                                    aria-describedby="nameHelp" >

                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">NIM</label>
                                </div>
                                <input class="form-control" name="EditktiNim2" id="EditktiNim2" type="text"
                                    aria-describedby="nameHelp" disabled="">
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Nama</label>
                                </div>
                                <input class="form-control" name="EditNim" id="EditktiNama2" type="text"
                                    aria-describedby="nameHelp" disabled="">
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Dosen Penguji 1</label>
                                </div>

                                <select class="custom-select" id = 'EditktiDosen2' name="EditktiDosen2"  disabled>
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
                                    <label class="input-group-text" for="inputGroupSelect01">Penulisan Isi</label>
                                </div>
                                <input class="form-control input-sm"name="nilaiisi2" id="nilaiisi2" type="text"
                                       aria-describedby="nameHelp" >
                                       <label class="input-group-text" for="inputGroupSelect01">(20)</label>

                                <div class="input-group-prepend" style='margin-left: 20px;'>
                                    <label class="input-group-text" for="inputGroupSelect01">Metodologi</label>
                                </div>
                                <input class="form-control input-sm" name="nilaimetodologi2" id="nilaimetodologi2" type="text"
                                       aria-describedby="nameHelp" >
                                       <label class="input-group-text" for="inputGroupSelect01">(10)</label>

                                <div class="input-group-prepend" style='margin-left: 20px;'>
                                    <label class="input-group-text" for="inputGroupSelect01">Penguasaan Materi</label>
                                </div>
                                <input class="form-control input-sm" name="nilaimateri2" id="nilaimateri2" type="text"
                                aria-describedby="nameHelp" >
                                <label class="input-group-text" for="inputGroupSelect01">(40)</label>

                                <div class="input-group-prepend" style='margin-left: 20px;'>
                                    <label class="input-group-text" for="inputGroupSelect01">Materi dan Presentasi</label>
                                </div>
                                <input class="form-control input-sm" name="nilaipresentasi2" id="nilaipresentasi2" type="text"
                                aria-describedby="nameHelp" >
                                <label class="input-group-text" for="inputGroupSelect01">(30)</label>
                            </div>
                        </div>
                        <button type="submit" name="editnilai2" class="btn btn-primary btn-sm" >Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).on("click", "#addnilai2", function () {
        var NIM = $(this).data('nim');
        var nama_mahasiswa = $(this).data('nama');
        var iddosen2 = $(this).data('iddosen2');

        $('#ktiNim2').val(NIM);
        $('#ktiNama2').val(nama_mahasiswa);
        $('#ktiDosen2').val(iddosen2);

        $('#hiddennim2').val(NIM);
        $('#hiddenDosen2').val(iddosen2);

        var number = document.getElementById('ktiDosen2');
        selectItemByValue(number, iddosen2);
    });

        $(document).on("click", "#editnilai2", function () {
            var NIM = $(this).data('nim');
            var nama_mahasiswa = $(this).data('nama');
            var iddosen2 = $(this).data('iddosen2');
            $('#EditktiNim2').val(NIM);
            $('#EditktiNama2').val(nama_mahasiswa);
            $('#EditktiDosen2').val(iddosen2);

            $('#Edithiddennim2').val(NIM);
            $('#EdithiddenDosen2').val(iddosen2);
        });
</script>

<?php
    if (isset($_POST['addnilai2'])) {
        //change function into update table nilai_perdosen
        $sql_updatenilai = "UPDATE nilai_perdosen SET nilai_perdosen_isi = '$_POST[nilaiisi2]',nilai_perdosen_metode ='$_POST[nilaimetodologi2]',
        nilai_perdosen_materi ='$_POST[nilaimateri2]',nilai_perdosen_presentasi='$_POST[nilaipresentasi2]', status_nilai='1' WHERE id_dosen = '$_POST[hiddenDosen2]' AND nim = '$_POST[hiddennim2]'";
        if (mysqli_query($conn, $sql_updatenilai))
        {
        }
    }
    if (isset($_POST['editnilai2'])) {
        //change function into update table nilai_perdosen
        $sql_editnilai = "UPDATE nilai_perdosen SET nilai_perdosen_isi = '$_POST[nilaiisi2]',nilai_perdosen_metode ='$_POST[nilaimetodologi2]',
        nilai_perdosen_materi ='$_POST[nilaimateri2]',nilai_perdosen_presentasi='$_POST[nilaipresentasi2]', status_nilai='1' WHERE id_dosen = '$_POST[EdithiddenDosen2]' AND nim = '$_POST[Edithiddennim2]'";
        if (mysqli_query($conn, $sql_editnilai))
        {
        }
        echo $sql_editnilai;
    }
?>

<!--------------------------------------------------End Of Nilai 2---------------------------------------------- -->
<!-- ---------------------------------------Input Nilai Dosen Penguji 3 Modal ------------------------------------->
<div class="modal fade" id="AddNilaiModal3" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Input Nilai Mahasiswa (Dosen Penguji 3)</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" >
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input class="form-control" name="hiddennim3" id="hiddennim3" type="hidden"
                                       aria-describedby="nameHelp" >
                                <input class="form-control" name="hiddenDosen3" id="hiddenDosen3" type="hidden"
                                       aria-describedby="nameHelp" >
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">NIM</label>
                                </div>
                                <input class="form-control" name="ktiNim3" id="ktiNim3" type="text"
                                       aria-describedby="nameHelp" disabled="">
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Nama</label>
                                </div>
                                <input class="form-control" name="ktiNama3" id="ktiNama3" type="text"
                                       aria-describedby="nameHelp" disabled="">
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Dosen Penguji 3</label>
                                </div>
                                <select class="custom-select" name="ktiDosen3" id="ktiDosen3" disabled>
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
                            <hr width="10px">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Penulisan Isi</label>
                                </div>
                                <input class="form-control input-sm"name="nilaiisi3" id="nilaiisi3" type="text"
                                       aria-describedby="nameHelp" >
                                       <label class="input-group-text" for="inputGroupSelect01">(20)</label>

                                <div class="input-group-prepend" style='margin-left: 20px;'>
                                    <label class="input-group-text" for="inputGroupSelect01">Metodologi</label>
                                </div>
                                <input class="form-control input-sm" name="nilaimetodologi3" id="nilaimetodologi3" type="text"
                                       aria-describedby="nameHelp" >
                                       <label class="input-group-text" for="inputGroupSelect01">(10)</label>

                                <div class="input-group-prepend" style='margin-left: 20px;'>
                                    <label class="input-group-text" for="inputGroupSelect01">Penguasaan Materi</label>
                                </div>
                                <input class="form-control input-sm" name="nilaimateri3" id="nilaimateri3" type="text"
                                aria-describedby="nameHelp" >
                                <label class="input-group-text" for="inputGroupSelect01">(40)</label>

                                <div class="input-group-prepend" style='margin-left: 20px;'>
                                    <label class="input-group-text" for="inputGroupSelect01">Materi dan Presentasi</label>
                                </div>
                                <input class="form-control input-sm" name="nilaipresentasi3" id="nilaipresentasi3" type="text"
                                aria-describedby="nameHelp" >
                                <label class="input-group-text" for="inputGroupSelect01">(30)</label>
                            </div>
                        </div>
                        <button type="submit" name="addnilai3" class="btn btn-primary btn-sm" >Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="EditNilaiModal3" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Nilai Mahasiswa (Dosen Penguji 3)</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" >
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input class="form-control" name="Edithiddennim3" id="Edithiddennim3" type="hidden"
                                       aria-describedby="nameHelp" >
                                <input class="form-control" name="EdithiddenDosen3" id="EdithiddenDosen3" type="hidden"
                                       aria-describedby="nameHelp" >
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">NIM</label>
                                </div>
                                <input class="form-control" name="EditktiNim3" id="EditktiNim3" type="text"
                                       aria-describedby="nameHelp" disabled="">
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Nama</label>
                                </div>
                                <input class="form-control" name="EditktiNama3" id="EditktiNama3" type="text"
                                       aria-describedby="nameHelp" disabled="">
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Dosen Penguji 3</label>
                                </div>
                                <select class="custom-select" name="EditktiDosen3" id="EditktiDosen3" disabled>
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
                            <hr width="10px">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Penulisan Isi</label>
                                </div>
                                <input class="form-control input-sm"name="nilaiisi3" id="nilaiisi3" type="text"
                                       aria-describedby="nameHelp" >
                                       <label class="input-group-text" for="inputGroupSelect01">(20)</label>

                                <div class="input-group-prepend" style='margin-left: 20px;'>
                                    <label class="input-group-text" for="inputGroupSelect01">Metodologi</label>
                                </div>
                                <input class="form-control input-sm" name="nilaimetodologi3" id="nilaimetodologi3" type="text"
                                       aria-describedby="nameHelp" >
                                       <label class="input-group-text" for="inputGroupSelect01">(10)</label>

                                <div class="input-group-prepend" style='margin-left: 20px;'>
                                    <label class="input-group-text" for="inputGroupSelect01">Penguasaan Materi</label>
                                </div>
                                <input class="form-control input-sm" name="nilaimateri3" id="nilaimateri3" type="text"
                                aria-describedby="nameHelp" >
                                <label class="input-group-text" for="inputGroupSelect01">(40)</label>

                                <div class="input-group-prepend" style='margin-left: 20px;'>
                                    <label class="input-group-text" for="inputGroupSelect01">Materi dan Presentasi</label>
                                </div>
                                <input class="form-control input-sm" name="nilaipresentasi3" id="nilaipresentasi3" type="text"
                                aria-describedby="nameHelp" >
                                <label class="input-group-text" for="inputGroupSelect01">(30)</label>
                            </div>
                        </div>
                        <button type="submit" name="editnilai3" class="btn btn-primary btn-sm" >Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).on("click", "#addnilai3", function () {
        var NIM = $(this).data('nim');
        var nama_mahasiswa = $(this).data('nama');
        var iddosen3 = $(this).data('iddosen3');

        $('#ktiNim3').val(NIM);
        $('#ktiNama3').val(nama_mahasiswa);
        $('#ktiDosen3').val(iddosen3);

        $('#hiddennim3').val(NIM);
        $('#hiddenDosen3').val(iddosen3);

        var number = document.getElementById('ktiDosen3');
        selectItemByValue(number, iddosen3);
    });

    $(document).on("click", "#editnilai3", function () {
        var NIM = $(this).data('nim');
        var nama_mahasiswa = $(this).data('nama');
        var iddosen3 = $(this).data('iddosen3');

        $('#EditktiNim3').val(NIM);
        $('#EditktiNama3').val(nama_mahasiswa);
        $('#EditktiDosen3').val(iddosen3);

        $('#Edithiddennim3').val(NIM);
        $('#EdithiddenDosen3').val(iddosen3);
    });
</script>

<?php
    if (isset($_POST['addnilai3'])) {
        //change function into update table nilai_perdosen
        $sql_updatenilai = "UPDATE nilai_perdosen SET nilai_perdosen_isi = '$_POST[nilaiisi3]',nilai_perdosen_metode ='$_POST[nilaimetodologi3]',
        nilai_perdosen_materi ='$_POST[nilaimateri3]',nilai_perdosen_presentasi='$_POST[nilaipresentasi3]', status_nilai='1' WHERE id_dosen = '$_POST[hiddenDosen3]' AND nim = '$_POST[hiddennim3]'";
        if (mysqli_query($conn, $sql_updatenilai))
        {
        }
    }

    if (isset($_POST['editnilai3'])) {
        //change function into update table nilai_perdosen
        $sql_updatenilai = "UPDATE nilai_perdosen SET nilai_perdosen_isi = '$_POST[nilaiisi3]',nilai_perdosen_metode ='$_POST[nilaimetodologi3]',
        nilai_perdosen_materi ='$_POST[nilaimateri3]',nilai_perdosen_presentasi='$_POST[nilaipresentasi3]', status_nilai='1' WHERE id_dosen = '$_POST[EdithiddenDosen3]' AND nim = '$_POST[Edithiddennim3]'";
        if (mysqli_query($conn, $sql_updatenilai))
        {
        }
    }
?>
<!--------------------------------------------------End Of Nilai 3---------------------------------------------- -->
<!-- ---------------------------------------------- Final nilai akhir -------------------------------------------->
<div class="modal fade" id="FinalisasiNilaiModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Finalisasi Nilai KTI Mahasiswa</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                <div id="content" style="height: auto;">
                    <div class="datanilaifinal" style="width: 50%; float: left;">
                    </div>
                    <div style=" margin-left: 50%;">
                        <iframe id="objpdf" src="" type="application/pdf" width="650px" height="650px"></iframe>
                    </div>
                </div>
                </div>
                <button type="submit" name="editnilai3" class="btn btn-primary btn-sm" style="margin-left:30px;">Verifikasi</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).on("click", "#finalisasinilai", function () {
        var file=$(this).data('filekti');
        document.getElementById('objpdf').src = file;

        var nim = $(this).data('nim');
        var iddosen = $(this).data('iddosen');
        $.ajax({
            type : 'post',
            url : 'getnilaipermahasiswa.php',
            data :  'nim='+nim,
            success : function(data){
                $('.datanilaifinal').html(data);//menampilkan data ke dalam modal
            }
        });
    });
</script>

<?php
 if (isset($_POST['finalnilai'])) {
        $sql = "UPDATE kti SET
        penulisanisi = '$_POST[hidnilaiisifinal]',
        metodologi = '$_POST[hidnilaimetodologifinal]',
        penguasaanmateri = '$_POST[hidnilaimaterifinal]',
        materidanpresentasi = '$_POST[hidnilaipresentasifinal]',
        nilaiakhir = '$_POST[hidnilaiakhirangka]',
        nilaiakhirhuruf_temp = '$_POST[hidnilaiakhirhuruf]',
        nilaiakhirhuruf = '$_POST[hidnilaiakhirhuruf]'
        WHERE nim = '$_POST[hiddennimfinal]'";
        if (mysqli_query($conn, $sql)) {
            echo "<meta http-equiv='refresh' content='0'>";
        }
    }
?>
<!-- ---------------------------------------------- End Of final nilai akhir -------------------------------------------->
<!-- ---------------------------------------------- Detail nilai akhir -------------------------------------------->
<div class="modal fade" id="NilaiAkhir" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Verifikasi Nilai Akhir KTI</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="background-color: #bec673">
                <div class="card-body">
                    <div class="fetchdatanilai"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Nilai Akhir -->
 <script type="text/javascript">
        $(document).ready(function()
        {
            $('#NilaiAkhir').on('show.bs.modal', function (e)
            {
                var nim = $(e.relatedTarget).data('nim');
                //menggunakan fungsi ajax untuk pengambilan data
                $.ajax(
                {
                    type : 'post',
                    url : 'detailnilaikti.php',
                    data :  'nim='+ nim,
                    success : function(data)
                    {
                        $('.fetchdatanilai').html(data);//menampilkan data ke dalam modal
                    }
                });
            });
        });
    </script>

    <!--------------------------------------------------End Of Detail Nilai ---------------------------------------------- -->


