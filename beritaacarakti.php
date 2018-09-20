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
                <li class="breadcrumb-item active"> Data Karya Tulis Ilmiah</li>
            </ol>
        </div>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-table"></i> Data Karya Tulis Ilmiah
        </div>
        <div id="Table" class="card-body">
            <div id="tablekti" class="table-responsive">
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Angkatan</th>
                            <th>Tanggal Ujian KTI</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Angkatan</th>
                            <th>Tanggal Ujian KTI</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM kti,mahasiswa,angkatan WHERE kti.nim = mahasiswa.nim AND kti.id_angkatan = angkatan.id_angkatan AND kti.status IS NULL";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                        // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                <td>$row[nim]</td>
                                <td>$row[nama]</td>
                                <td>$row[angkatan]</td>
                                <td>$row[tgl_sidangkti]</td>
                                <td class=center>
                                
                                <a id ='beritaacarakti' data-nim='$row[nim]' data-nama='$row[nama]' data-gelardepan='$row[angkatan]' data-tglsidang='$row[tgl_sidangkti]' data-judulkti = '$row[judulkti]' data-dosen1 = '$row[dosen1]' data-dosen2 = '$row[dosen2]' data-dosenpenguji = '$row[penguji]' data-toggle='modal' data-target='#BeritaAcaraktiModal'>
                                <button type='button' class='btn btn-info btn-sm'>Berita Acara KTI</button></a>
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

<!-- Detail Modal -->
<!-- Modal content Detail-->
<div class="modal fade" id="BeritaAcaraktiModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Setup Berita Acara Ujian KTI</h4>
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
                            <input type="hidden" class="form-control" name="hiddenAngkatan" id="hiddenAngkatan" type="text"
                                   aria-describedby="nameHelp">
                            <input type="hidden" class="form-control" name="hiddenDosen1" id="hiddenDosen1" type="text"
                                   aria-describedby="nameHelp">
                            <input type="hidden" class="form-control" name="hiddenDosen2" id="hiddenDosen2" type="text"
                                   aria-describedby="nameHelp">
                             <input type="hidden" class="form-control" name="hiddenDosenpenguji" id="hiddenDosenpenguji" type="text" aria-describedby="nameHelp">
                            
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
                                <div class="input-group-prepend" data-provide='datetimepicker1'>
                                    <label class="input-group-text">Tanggal Seminar Hasil</label>
                                </div>
                                <input type='text' class="form-control" id="date" name="tanggal"
                                       placeholder="DD/MM/YYY" onchange="bataskumpulkti(this.value)"/>
                                <input type='hidden' class="form-control" id="hiddenbatas" name="hiddenbatas"
                                       />        
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend" data-provide='datetimepicker1'>
                                    <label class="input-group-text">Waktu Seminar Hasil</label>
                                </div>
                                <input type='text' class="form-control" id="time" name="waktu"
                                       placeholder="HH:mm"/>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text">Ruang Sidang</label>
                                </div>
                                <select id="ruangsidang" name="ruangsidang" class="custom-select">
                                    <?php
                                    $sql = "SELECT * FROM ruangsidang";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value=$row[id_ruang]>$row[ruangsidang]</option> ";
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
                                    <label class="input-group-text">Dosen Pembimbing 1</label>
                                </div>
                                <select class="custom-select" name="KtiDosen1" id="KtiDosen1" disabled>
                                    <?php
                                    $sql = "SELECT * FROM dosen,kti where kti.dosen1 = dosen.id_dosen";
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
                                    <label class="input-group-text">Dosen Pembimbing 2</label>
                                </div>
                                <select name="KtiDosen2" id="KtiDosen2" class="custom-select" disabled>
                                    <?php
                                    $sql = "SELECT * FROM dosen ,kti where kti.dosen2 = dosen.id_dosen";
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
                                    <label class="input-group-text">Dosen Penguji</label>
                                </div>
                                <select id="KtiDosenpenguji" name='KtiDosenpenguji' class="custom-select" disabled="">
                                    <?php
                                    $sql = "SELECT * FROM dosen ,kti where kti.penguji = dosen.id_dosen";
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
                        </div>
                            <button type="submit" name="UpdateBeritaAcarakti" class="btn btn-info btn-lg" >Simpan dan Cetak</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- berita acara kti -->
    <script type="text/javascript">
        $(document).on("click", "#beritaacarakti", function () {
            var NIM = $(this).data('nim');
            var nama_mahasiswa = $(this).data('nama');
            var judulKTI = $(this).data('judulkti');
            var pdosen1 = $(this).data('dosen1');
            var pdosen2 = $(this).data('dosen2');
            var pdosenpenguji = $(this).data('dosenpenguji');
            var angkatan = $(this).data('idangkatan');

            $('#EditNim').val(NIM);
            $('#EditNama').val(nama_mahasiswa);
            $('#EditJudul').val(judulKTI);
            $('#KtiDosen1').val(pdosen1);
            $('#KtiDosen2').val(pdosen2);
            $('#KtiDosenpenguji').val(pdosenpenguji);
            
            $('#hiddennim').val(NIM);
            $('#hiddenNama').val(nama_mahasiswa);
            $('#hiddenJudul').val(judulKTI);
            $('#hiddenAngkatan').val(angkatan);
            $('#hiddenDosen1').val(pdosen1);
            $('#hiddenDosen2').val(pdosen2);
            $('#hiddenDosenpenguji').val(pdosenpenguji);
        });
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
        });
    </script>
    <script type="text/javascript">
        function bataskumpulkti(val){
            var initial = val.split(/\//).reverse().join('/');
            var oldinitial = val.split(/\//);
            var day = oldinitial[0];
            var x = parseInt(oldinitial[1]); //month
            var month = x + 1;
            if(month > 12)
            {
                var year = parseInt(oldinitial[2]) + 1;
                month -= 12;
            }
            else
            {
                year = oldinitial[2];
            }
            
            var newdate = day+"/"+month+"/"+year;
            
            $('#hiddenbatas').val(newdate);
        }
    </script>
<!-- update berita acara kti-->
<?php
    if(isset($_POST['UpdateBeritaAcarakti']))
    {
        $sql = "UPDATE kti SET 
                waktupelaksanaan = '$_POST[waktu]',
                ruangsidang = '$_POST[ruangsidang]',
                tgl_sidangkti = '$_POST[tanggal]',
                batas_pengumpulan = '$_POST[hiddenbatas]',
                status = 'kti'
                WHERE kti.nim = '$_POST[hiddennim]'";
                
                if (mysqli_query($conn, $sql)) 
                {
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

