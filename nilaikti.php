<?php
@include("header.php");
@include("navigation.php");
@include("dbconnect.php");
$globalnim = '';
?>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
    <div class="content-wrapper">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.php">Home</a>
                </li>
                <li class="breadcrumb-item active"> Nilai Karya Tulis Ilmiah</li>
            </ol>
        </div>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-table"></i> Nilai Karya Tulis Ilmiah
        </div>
        <div id="Table" class="card-body">
            <div id="tablekti" class="table-responsive">
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Dosen Penguji 1</th>
                            <th>Dosen Penguji 2</th>
                            <th>Dosen Penguji 3</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Dosen Penguji 1</th>
                            <th>Dosen Penguji 2</th>
                            <th>Dosen Penguji 3</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM kti WHERE kti.nilaiakhir IS NULL OR kti.nilaiakhir = '0'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                        // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                <td>$row[nim]</td>
                                <td>$row[nama]</td>
                                <td>
                                    <a id ='addnilai1' data-nim=$row[nim] data-nama='$row[nama]' data-judulkti='$row[judulkti]' data-iddosen=$row[dosen1] data-toggle='modal' data-target='#AddNilai1Modal1'>
                                    <button type='button' class='btn btn-primary btn-sm'>Add</button></a>
                                   
                                </td>
                                <td>
                                    <a id ='addnilai2' data-nim=$row[nim] data-nama='$row[nama]' data-judulkti='$row[judulkti]' data-iddosen=$row[dosen2] data-toggle='modal' data-target='#AddNilai1Modal2'>
                                    <button type='button' class='btn btn-primary btn-sm'>Add</button></a>
                                   
                                </td>
                                <td>
                                   <a id ='addnilai3' data-nim=$row[nim] data-nama='$row[nama]' data-judulkti='$row[judulkti]' data-iddosen=$row[penguji] data-toggle='modal' data-target='#AddNilai1Modal3'>
                                    <button type='button' class='btn btn-primary btn-sm'>Add</button></a>
                                  
                                </td>
                                <td> <a id='FinalisasiKTIModal' 
                                    data-toggle='modal'
                                    data-nim=$row[nim] 
                                    data-nama='$row[nama]' 
                                    data-isi1 = '$row[penulisanisi1]'
                                    data-isi2 = '$row[penulisanisi2]'
                                    data-isi3 = '$row[penulisanisi3]'
                                    data-metod1 = '$row[metodologi1]'
                                    data-metod2= '$row[metodologi2]'
                                    data-metod3 = '$row[metodologi3]'
                                    data-materi1 = '$row[penguasaanmateri1]'
                                    data-materi2 = '$row[penguasaanmateri2]'
                                    data-materi3 = '$row[penguasaanmateri3]'
                                    data-presentasi1 = '$row[presentasi1]'
                                    data-presentasi2 = '$row[presentasi2]'
                                    data-presentasi3 = '$row[presentasi3]'
                                    data-target='#FinalisasiNilaiAkhirModal'>
                                    <button type='button' class='btn btn-danger btn-sm'>Finalisasi Nilai Akhir</button></a>
                                    <a id='NilaiKTIModal' data-toggle='modal' data-nim=$row[nim] data-nama='$row[nama]' data-target='#NilaiAkhir' >
                                    <button type='button' class='btn btn-info btn-sm'>Detail Nilai Akhir</button></a>
                                   
                                </td>
                                </tr>";
                            }
                        } else {
                            echo "0 results";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<?php
@include("footer.php");
?>

<!-- -------------------------------------Input Nilai Dosen Penguji 1 Modal --------------------------------------- -->
<div class="modal fade" id="AddNilai1Modal1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Input Nilai Mahasiswa</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="background-color: #bec673">
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
                                <select class="custom-select" name="ktiDosen1" id="ktiDosen1" disabled>
                                    <?php
                                    $sql = "SELECT * FROM dosen,kti,mahasiswa WHERE mahasiswa.nim = kti.nim AND kti.dosen1 = dosen.id_dosen";
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
                                <input class="form-control" width="50px" name="nilaiisi" id="nilaiisi" type="text"
                                       aria-describedby="nameHelp" >
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Metodologi</label>
                                </div>
                                <input class="form-control" name="nilaimetodologi" id="nilaimetodologi" type="text"
                                       aria-describedby="nameHelp" >
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Penguasaan Materi</label>
                                </div>
                                <input class="form-control" name="nilaimateri" id="nilaimateri" type="text"
                                       aria-describedby="nameHelp" >
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Materi dan Presentasi</label>
                                </div>
                                <input class="form-control" name="nilaipresentasi" id="nilaipresentasi" type="text"
                                       aria-describedby="nameHelp" >
                            </div>
                        </div>
                        <button type="submit" name="addnilai1" class="btn btn-info btn-lg" >SUBMIT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).on("click", "#addnilai1", function () {
        
        var NIM = $(this).data('nim');
        var nama_mahasiswa = $(this).data('nama');
        var dosen1 = $(this).data('iddosen');

        $('#ktiNim').val(NIM);
        $('#ktiNama').val(nama_mahasiswa);
        $('#ktiDosen1').val(dosen1);
        
        $('#hiddennim').val(NIM);
        $('#hiddenDosen1').val(dosen1);
    });
</script>

<?php
    if (isset($_POST['addnilai1'])) {
         $globalnim = $_POST[hiddennim];  
        $sql = "UPDATE kti SET 
        penulisanisi1 = '$_POST[nilaiisi]',
        metodologi1 = '$_POST[nilaimetodologi]',
        penguasaanmateri1 = '$_POST[nilaimateri]',
        presentasi1 = '$_POST[nilaipresentasi]'
        WHERE nim = '$_POST[hiddennim]'";
        if (mysqli_query($conn, $sql)) {
            echo "<meta http-equiv='refresh' content='0'>";
        }
    }
?>
<!--------------------------------------------------End Of Nilai 1---------------------------------------------- -->

<!------------------------------------- Input Nilai Dosen Penguji 2 Modal ------------------------------------------->
<div class="modal fade" id="AddNilai1Modal2" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Input Nilai Mahasiswa</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="background-color: #bec673">
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
                                    $sql = "SELECT * FROM dosen,kti,mahasiswa WHERE mahasiswa.nim = kti.nim AND kti.dosen2 = dosen.id_dosen";
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
                                <input class="form-control" name="nilaiisi2" id="EditNim" type="text"
                                       aria-describedby="nameHelp" >
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Metodologi</label>
                                </div>
                                <input class="form-control" name="nilaimetodologi2" id="EditNim" type="text"
                                       aria-describedby="nameHelp" >
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Penguasaan Materi</label>
                                </div>
                                <input class="form-control" name="nilaimateri2" id="EditNim" type="text"
                                       aria-describedby="nameHelp" >
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Materi dan Presentasi</label>
                                </div>
                                <input class="form-control" name="nilaipresentasi2" id="EditNim" type="text"
                                       aria-describedby="nameHelp" >
                            </div>
                        </div>
                        <button type="submit" name="addnilai2" class="btn btn-info btn-lg" >SUBMIT</button>
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
        var dosen2 = $(this).data('iddosen');

        $('#ktiNim2').val(NIM);
        $('#ktiNama2').val(nama_mahasiswa);
        $('#ktiDosen2').val(dosen2);

        $('#hiddennim2').val(NIM);
        $('#hiddenDosen2').val(dosen2);
    })
</script>

<?php
    if (isset($_POST['addnilai2'])) {
        $sql = "UPDATE kti SET 
        penulisanisi2 = '$_POST[nilaiisi2]',
        metodologi2 = '$_POST[nilaimetodologi2]',
        penguasaanmateri2 = '$_POST[nilaimateri2]',
        presentasi2 = '$_POST[nilaipresentasi2]'
        WHERE nim = '$_POST[hiddennim2]'";
        if (mysqli_query($conn, $sql)) {
            echo "<meta http-equiv='refresh' content='0'>";
        }
    }
?>

<!--------------------------------------------------End Of Nilai 2---------------------------------------------- -->
<!-- ---------------------------------------Input Nilai Dosen Penguji 3 Modal ------------------------------------->
<div class="modal fade" id="AddNilai1Modal3" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Input Nilai Mahasiswa</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="background-color: #bec673">
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
                                    $sql = "SELECT * FROM dosen,kti,mahasiswa WHERE mahasiswa.nim = kti.nim AND kti.penguji = dosen.id_dosen";
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
                                <input class="form-control" name="nilaiisi3" id="EditNim" type="text"
                                       aria-describedby="nameHelp" >
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Metodologi</label>
                                </div>
                                <input class="form-control" name="nilaimetodologi3" id="EditNim" type="text"
                                       aria-describedby="nameHelp" >
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Penguasaan Materi</label>
                                </div>
                                <input class="form-control" name="nilaimateri3" id="EditNim" type="text"
                                       aria-describedby="nameHelp" >
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Materi dan Presentasi</label>
                                </div>
                                <input class="form-control" name="nilaipresentasi3" id="EditNim" type="text"
                                       aria-describedby="nameHelp" >
                            </div>
                        </div>
                        <button type="submit" name="addnilai3" class="btn btn-info btn-lg" >SUBMIT</button>
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
        var dosen3 = $(this).data('iddosen');

        $('#ktiNim3').val(NIM);
        $('#ktiNama3').val(nama_mahasiswa);
        $('#ktiDosen3').val(dosen3);
        $('#hiddennim3').val(NIM);
        $('#hiddenDosen3').val(dosen3);
    })
</script>

<?php
    if (isset($_POST['addnilai3'])) {
        $sql = "UPDATE kti SET 
        penulisanisi3 = '$_POST[nilaiisi3]',
        metodologi3 = '$_POST[nilaimetodologi3]',
        penguasaanmateri3 = '$_POST[nilaimateri3]',
        presentasi3 = '$_POST[nilaipresentasi3]'
        WHERE nim = '$_POST[hiddennim3]'";
        if (mysqli_query($conn, $sql)) {
            echo "<meta http-equiv='refresh' content='0'>";
        }
    }
?>
<!--------------------------------------------------End Of Nilai 3---------------------------------------------- -->
<!-- ---------------------------------------------- Final nilai akhir -------------------------------------------->
<div class="modal fade" id="FinalisasiNilaiAkhirModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Finalisasi Nilai KTI Mahasiswa</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="background-color: #bec673">
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input class="form-control" name="hiddennimfinal" id="hiddennimfinal" type="hidden"
                                       aria-describedby="nameHelp" >
                                <input class="form-control" name="hiddenDosenfinal" id="hiddenDosenfinal" type="hidden"
                                       aria-describedby="nameHelp" >
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">NIM</label>
                                </div>
                                <input class="form-control" name="ktiNimfinal" id="ktiNimfinal" type="text"
                                       aria-describedby="nameHelp" disabled="">
                            </div>
                            
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Nama</label>
                                </div>
                                <input class="form-control" name="ktiNamafinal" id="ktiNamafinal" type="text"
                                       aria-describedby="nameHelp" disabled="">
                            </div>
                            
                            <hr width="10px">
                            
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Penulisan Isi</label>
                                </div>
                                <input class="form-control" name="hidnilaiisifinal" id="hidnilaiisifinal" type="hidden">
                                <input class="form-control" name="nilaiisifinal" id="nilaiisifinal" type="text"
                                       disabled="">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Metodologi</label>
                                </div>
                                <input class="form-control" name="hidnilaimetodologifinal" id="hidnilaimetodologifinal" type="hidden"
                                       aria-describedby="nameHelp" >
                                <input class="form-control" name="nilaimetodologifinal" id="nilaimetodologifinal" type="text"
                                       aria-describedby="nameHelp" disabled="">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Penguasaan Materi</label>
                                </div>
                                <input class="form-control" name="hidnilaimaterifinal" id="hidnilaimaterifinal" type="hidden"
                                       aria-describedby="nameHelp">
                                <input class="form-control" name="nilaimaterifinal" id="nilaimaterifinal" type="text"
                                       aria-describedby="nameHelp" disabled="">
                                       
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Materi dan Presentasi</label>
                                </div>
                                <input class="form-control" name="hidnilaipresentasifinal" id="hidnilaipresentasifinal" type="hidden"
                                       aria-describedby="nameHelp">
                                <input class="form-control" name="nilaipresentasifinal" id="nilaipresentasifinal" type="text"
                                       aria-describedby="nameHelp" disabled="">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Nilai Akhir Dalam Angka</label>
                                </div>
                                <input class="form-control" name="hidnilaiakhirangka" id="hidnilaiakhirangka" type="hidden"
                                       aria-describedby="nameHelp">
                                <input class="form-control" name="nilaiakhirangka" id="nilaiakhirangka" type="text"
                                       aria-describedby="nameHelp" disabled="">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Nilai Akhir Dalam Huruf</label>
                                </div>
                                <input class="form-control" name="hidnilaiakhirhuruf" id="hidnilaiakhirhuruf" type="hidden"
                                       aria-describedby="nameHelp">
                                <input class="form-control" name="nilaiakhirhuruf" id="nilaiakhirhuruf" type="text"
                                       aria-describedby="nameHelp" disabled="">
                            </div>
                        </div>
                        <button type="submit" name="finalnilai" class="btn btn-info btn-lg" >SUBMIT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).on("click", "#FinalisasiKTIModal", function () {
        var NIM = $(this).data('nim');
        var nama_mahasiswa = $(this).data('nama');
        var dosen3 = $(this).data('iddosen');
        var isi1 = $(this).data('isi1');
        var isi2 = $(this).data('isi2');
        var isi3  = $(this).data('isi3');
        var method1 = $(this).data('metod1');
        var method2 = $(this).data('metod2');
        var method3  = $(this).data('metod3');
        var materi1 = $(this).data('materi1');
        var materi2 = $(this).data('materi2');
        var materi3  = $(this).data('materi3');
        var presentasi1 = $(this).data('presentasi1');
        var presentasi2 = $(this).data('presentasi2');
        var presentasi3  = $(this).data('presentasi3');
        var nilaiakhirangka = ((isi1+isi2+isi3)/3) + ((method1+method2+method3)/3) + ((materi1+materi2+materi3)/3) + ((presentasi1+presentasi2+presentasi3)/3);

        $('#ktiNimfinal').val(NIM);
        $('#ktiNamafinal').val(nama_mahasiswa);
        $('#hiddennimfinal').val(NIM);
        $('#nilaiisifinal').val((isi1+isi2+isi3)/3);
        $('#nilaimetodologifinal').val((method1+method2+method3)/3);
        $('#nilaimaterifinal').val((materi1+materi2+materi3)/3);
        $('#nilaipresentasifinal').val((presentasi1+presentasi2+presentasi3)/3);
        $('#nilaiakhirangka').val(nilaiakhirangka);

        $('#hidnilaiisifinal').val((isi1+isi2+isi3)/3);
        $('#hidnilaimetodologifinal').val((method1+method2+method3)/3);
        $('#hidnilaimaterifinal').val((materi1+materi2+materi3)/3);
        $('#hidnilaipresentasifinal').val((presentasi1+presentasi2+presentasi3)/3);
        $('#hidnilaiakhirangka').val(nilaiakhirangka);

        if(nilaiakhirangka>=85 && nilaiakhirangka<=100){
            $('#nilaiakhirhuruf').val('A');
            $('#hidnilaiakhirhuruf').val('A');     
        }else if(nilaiakhirangka<=84.99 && nilaiakhirangka >=80){
            $('#nilaiakhirhuruf').val('A-');
            $('#hidnilaiakhirhuruf').val('A-');
        }else if(nilaiakhirangka<=79.99 && nilaiakhirangka >=75){
            $('#nilaiakhirhuruf').val('B+');
            $('#hidnilaiakhirhuruf').val('B+');
        }else if(nilaiakhirangka<=74.99 && nilaiakhirangka >=70){
            $('#nilaiakhirhuruf').val('B');
            $('#hidnilaiakhirhuruf').val('B');
        }else if(nilaiakhirangka<=69.99 && nilaiakhirangka >=65){
           $('#nilaiakhirhuruf').val('B-');
           $('#hidnilaiakhirhuruf').val('B-');
        }else if(nilaiakhirangka<=64.99 && nilaiakhirangka >=60){
            $('#nilaiakhirhuruf').val('C+');
            $('#hidnilaiakhirhuruf').val('C+');
        }else if(nilaiakhirangka<=59.99 && nilaiakhirangka >=55){
            $('#nilaiakhirhuruf').val('C');
            $('#hidnilaiakhirhuruf').val('C');
        }else{
            $('#nilaiakhirhuruf').val('TIDAK LULUS');
            $('#hidnilaiakhirhuruf').val('TIDAK LULUS');
        }
    })
</script>

<?php
 if (isset($_POST['finalnilai'])) {
        $sql = "UPDATE kti SET 
        penulisanisi = '$_POST[hidnilaiisifinal]',
        metodologi = '$_POST[hidnilaimetodologifinal]',
        penguasaanmateri = '$_POST[hidnilaimaterifinal]',
        materidanpresentasi = '$_POST[hidnilaipresentasifinal]',
        nilaiakhir = '$_POST[hidnilaiakhirangka]',
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

