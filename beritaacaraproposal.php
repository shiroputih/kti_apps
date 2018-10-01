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
                <li class="breadcrumb-item active">Data Proposal</li>
            </ol>
        </div>
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-table"></i> Data Proposal
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>NIM</th>
                                <th>Nama Mahasiswa</th>
                                <th>Judul Proposal</th>
                                <th>Tgl Seminar Proposal</th>
                                <th>Batas Sidang KTI</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>NIM</th>
                                <th>Nama Mahasiswa</th>
                                <th>Judul Proposal</th>
                                <th>Tgl Seminar Proposal</th>
                                <th>Batas Sidang KTI</th>
                                <th></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM mahasiswa,proposal where mahasiswa.nim = proposal.nim AND proposal.status IS NULL";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                // output data of each row
                                while ($path = $result->fetch_assoc()) {
                                    echo "<tr>
                                    <td>$path[nim]</td>
                                    <td>$path[nama]</td>
                                    <td>$path[judulproposal]</td>
                                    <td>$path[tgl_sidangproposal]</td>
                                    <td>$path[batas_sidangkti]</td>
                                    <td class='center'>
                                    <a id ='BeritaAcaraProposal' 
                                    data-nimmahasiswa='$path[nim]' 
                                    data-namamahasiswa='$path[nama]'  
                                    data-judulproposal = '$path[judulproposal]'
                                    data-dosen1 = '$path[dosen1]'
                                    data-dosen2 = '$path[dosen2]'
                                    data-toggle='modal' 
                                    data-target='#SetupBeritaAcaraModal'>
                                    <button type='button' class='btn btn-info btn-sm'>Setup Berita Acara</button></a>

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
<div class="modal fade" id="SetupBeritaAcaraModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Setup Berita Acara Proposal</h4>
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
                            <input type="hidden" class="form-control" name="hiddenDosen1" id="hiddenDosen1" type="text"
                            aria-describedby="nameHelp">
                            <input type="hidden" class="form-control" name="hiddenDosen2" id="hiddenDosen2" type="text"
                            aria-describedby="nameHelp">
                            <textarea style="display:none;" rows="3" cols="50" name="judullamahidden" class="form-control" id="judullamahidden"
                                aria-describedby="nameHelp" onkeyup="this.value=this.value.toUpperCase()"
                                ></textarea>
                            
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
                                ></textarea>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend" data-provide='datetimepicker1'>
                                    <label class="input-group-text">Tanggal Sidang Proposal</label>
                                </div>
                                <input type='text' class="form-control" id="date" name="tanggal"
                                placeholder="DD/MM/YYY" onchange="bataskti(this.value)"/>
                                <input type='hidden' class="form-control" id="hiddenbatas" name="hiddenbatas"
                                />
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend" data-provide='datetimepicker1'>
                                    <label class="input-group-text">Waktu Sidang Proposal</label>
                                </div>
                                <input type='text' class="form-control" id="time" name="waktu"
                                placeholder="HH:mm" />
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
                                <select class="custom-select" name="ProposalDosen1" id="ProposalDosen1" disabled>
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
                                    <label class="input-group-text">Dosen Pembimbing 2</label>
                                </div>
                                <select name="ProposalDosen2" id="ProposalDosen2" class="custom-select" disabled>
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
                                    <label class="input-group-text">Dosen Penguji</label>
                                </div>
                                <select id="ProposalDosenPenguji" name='ProposalDosenPenguji' class="custom-select">
                                    <?php
                                    $sql = "SELECT * FROM dosen ORDER BY nama_dosen ASC";
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
                        <button type="submit" name="UpdateBeritaAcaraProposal" class="btn btn-info btn-lg">Simpan dan Cetak</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- berita acara proposal -->
<script type="text/javascript">
    $(document).on("click", "#BeritaAcaraProposal", function () {
        var NIM = $(this).data('nimmahasiswa');
        var nama_mahasiswa = $(this).data('namamahasiswa');
        var judulproposal = $(this).data('judulproposal');
        var pdosen1 = $(this).data('dosen1');
        var pdosen2 = $(this).data('dosen2');
        var tanggalsidang = $(this).data('tanggal');
        
        $('#EditNim').val(NIM);
        $('#EditNama').val(nama_mahasiswa);
        $('#EditJudul').val(judulproposal);
        $('#ProposalDosen1').val(pdosen1);
        $('#ProposalDosen2').val(pdosen2);
        $('#EditTanggal').val(tanggalsidang);
        
        $('#hiddennim').val(NIM);
        $('#hiddenNama').val(nama_mahasiswa);
        $('#hiddenJudul').val(judulproposal);
        $('#hiddenDosen1').val(pdosen1);
        $('#hiddenDosen2').val(pdosen2);
        $('#judullamahidden').val(judulproposal);
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

<script type="text/javascript">
    function bataskti(val){
        var initial = val.split(/\//).reverse().join('/');
        var oldinitial = val.split(/\//);
        var day = oldinitial[0];
            var x = parseInt(oldinitial[1]); //month
            var month = x + 6;
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
    <?php
    if(isset($_POST['UpdateBeritaAcaraProposal']))
    {

        $sql = "UPDATE proposal SET 
        waktupelaksanaan = '$_POST[waktu]',
        ruangsidang = '$_POST[ruangsidang]',
        judulproposal ='$_POST[EditJudul]',
        penguji = '$_POST[ProposalDosenPenguji]',
        tgl_sidangproposal = '$_POST[tanggal]',
        batas_sidangkti = '$_POST[hiddenbatas]',
        status = 'proposal'
        WHERE proposal.nim = '$_POST[hiddennim]'";
        if (mysqli_query($conn, $sql)) 
        {
            //save to semhas
           $sql = "INSERT INTO semhas (nim,nama,judulKTI,dosen1,dosen2,penguji) VALUES ('" . $_POST[hiddennim] . "','" . $_POST[hiddenNama] . "','" . $_POST[EditJudul] . "','" . $_POST[hiddenDosen1] . "','" . $_POST[hiddenDosen2]."','".$_POST[ProposalDosenPenguji]."')";
           if (mysqli_query($conn, $sql)) 
           {
             echo "<meta http-equiv='refresh' content='0'>";
          }
     

        //save log history judul
        $sql = "INSERT INTO loghistoryjudul (judullama,judulbaru,nim,status) VALUES ('" . $_POST[judullamahidden] . "','".$_POST[EditJudul]."','".$_POST[hiddennim]."','Proposal')";
        if (mysqli_query($conn, $sql)) 
          {
              echo "<meta http-equiv='refresh' content='0'>";
         }
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

    
