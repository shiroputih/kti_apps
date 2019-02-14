<?php
    @include("header.php");
    @include("navigation.php");
    @include("dbconnect.php");

    //show kti which status is null
    //set null status to Lolos or Tidak Lolos
    //upload scan berita acara if status is Lolos
    //save judul to log history
    ?>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
    <div class="fixed-nav sticky-footer bg-dark" id="page-top">
        <div class="content-wrapper">
            <div class="container-fluid">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.php">Home</a>
                    </li>
                    <li class="breadcrumb-item active"> Validasi Ujian KTI</li>
                </ol>
            </div>


                <div id="tabelvalidasiujiankti" class="table-responsive"></div>


        </div>
    </div>
</body>

<?php
    @include("footer.php");
?>

<!-- show proposal data -->
<script type="text/javascript">
            $(document).ready(function(){
            $.ajax({
                url : 'getvalidasikti.php',
                type:'post',
                cache : false,
                success : function(data)
                {
                    $('#tabelvalidasiujiankti').html(data);
                }
                });
            });

//set Tidak Lolos kti
            $(document).on("click", "#tidakloloskti", function () {
		        var tglujiankti = $(this).data('tglujiankti');
                var nim = $(this).data('nimmahasiswa');
                var judul = $(this).data('judulkti');
		        $('#lblnim').val(nim);
                $('#lbljudul').val(judul);
                $('#tglujiankti').val(tglujiankti);
	        });

//set Lolos kti
            $(document).on("click", "#loloskti", function () {
		        var tgl_ujiankti = $(this).data('tglujiankti');
                var nim = $(this).data('nimmahasiswa');
                var judul = $(this).data('judulkti');
                var semester = $(this).data('idsemester');
                $('#nim').val(nim);
                $('#judul_kti').val(judul);
                $('#tgl_ujiankti').val(tgl_ujiankti);
                $('#idsemester').val(semester);

                    var initial = tgl_ujiankti.split(/\//).reverse().join('/');
                    var oldinitial = tgl_ujiankti.split(/\//);
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

	        });
</script>

<!-- Tidak Lolos Proposal -->
<div class="modal fade" id="tidaklolosktimodal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" >
                <div class="modal-header">
                    <h4 class="modal-title">Tidak Lolos Ujian KTI</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" style="background-color: #e60000">
                <form method="POST">
                    <input class="form-control" name="tglujiankti" id="tglujiankti" type="hidden"
                    style="border: 0px solid red; background-color: #e60000; color:white; " >
                    <input class="form-control" name="nim" id="lblnim" type="text"
                    style="border: 0px solid red; background-color: #e60000; color:white; " >
                    <input class="form-control" name="judul" id="lbljudul" type="text"
                    style="border: 0px solid red; background-color: #e60000; color:white;" >
                    <br>
                    <button type="submit" name="TidakLolos" class='btn btn-primary btn-sm' >  Tidak Lolos  </button>
                    <button type="submit" name="cancel" data-dismiss="modal" class='btn btn-success btn-sm' > Batal </button>
                </form>
                </div>
            </div>
        </div>
</div>

    <?php
    if(isset($_POST['TidakLolos']))
    {
        //update tabel kti
        $sql = "UPDATE kti SET status_kti ='Tidak Lolos' WHERE nim = '$_POST[nim]' AND tgl_ujiankti = '$_POST[tglujiankti]'";
        if (mysqli_query($conn, $sql)) {

        }
    }
    ?>
<!-- End Tidak Lolos KTI -->

<!-- Lolos KTI -->
<div class="modal fade" id="lolosktimodal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" >
                <div class="modal-header">
                    <h4 class="modal-title">Lolos KTI</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" style="background-color: #b3b3ff">
                <form method="post" enctype="multipart/form-data">
                    <input class="form-control" name="tgl_ujiankti" id="tgl_ujiankti" type="hidden"
                    style="border: 0px solid red; background-color: #b3b3ff; color:white; " >
                    <input class="form-control" name="hiddenbatas" id="hiddenbatas" type="hidden"
                    style="border: 0px solid red; background-color: #e60000; color:white; " >
                    <input class="form-control" name="idsemester" id="idsemester" type="hidden"
                    style="border: 0px solid red; background-color: #b3b3ff; color:white; " >
                    <input class="form-control" name="nim" id="nim" type="text"
                    style="border: 0px solid red; background-color: #b3b3ff; color:white; " >
                    <input class="form-control" name="judul_kti" id="judul_kti" type="text"
                    style="border: 0px solid red; background-color: #b3b3ff; color:white;" >
                    <br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Upload Berita Acara Ujian KTI</span>
                        </div>
                        <div class="custom-file">
                            <input class="form-control" name="pdf" id="pdf" accept="application/pdf" type="file">
                        </div>
                    </div>
                    <button type="submit" name="Lolos" class='btn btn-primary btn-sm' >  Lolos  </button>
                    <button type="submit" name="cancel" data-dismiss="modal" class='btn btn-success btn-sm' > Batal </button>
                </form>
                </div>
            </div>
        </div>
</div>

<?php
    if(isset($_POST['Lolos']))
    {

        $nama_file=$_FILES['pdf']['name'];
	    $ukuran=$_FILES['pdf']['size'];

        $uploaddir='./uploadKTI/';
        $alamatfile=$uploaddir.$nama_file;
        if(move_uploaded_file($_FILES['pdf']['tmp_name'],$alamatfile));
        {
            $sql = "UPDATE kti SET status_kti ='Lolos', file_kti = '$alamatfile' WHERE nim = '$_POST[nim]' AND tgl_ujiankti = '$_POST[tgl_ujiankti]'";
            if (mysqli_query($conn, $sql))
            {
                $sql_bataswaktu = "UPDATE batas_waktu SET tgl_ujiankti ='$_POST[tgl_ujiankti]', batas_kumpulberkas = '$_POST[hiddenbatas]' WHERE nim = '$_POST[nim]'";
                echo $sql_bataswaktu;
                if (mysqli_query($conn, $sql_bataswaktu))
                {

                }
                //get all id dosen
                $sql_nilaidosen = "SELECT * FROM assign_sk WHERE assign_sk.nim = '$_POST[nim]'";
                $result = $conn->query($sql_nilaidosen);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $sql = "INSERT INTO nilai_perdosen (id_dosen,nim,nilai_perdosen_isi,nilai_perdosen_metode,nilai_perdosen_materi,nilai_perdosen_presentasi,status_nilai)
                        VALUES ('$row[id_dosen]','".$_POST['nim']."','0','0','0','0','0')";
                        if (mysqli_query($conn, $sql)) {}
                    }
                }
            }
        }
    }
    ?>
<!-- End Lolos KTI -->

