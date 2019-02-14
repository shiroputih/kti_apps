<?php
    @include("header.php");
    @include("navigation.php");
    @include("dbconnect.php");

    //show semhas which status is null
    //set null status to Lolos or Tidak Lolos
    //upload scan berita acara if status is Lolos
    //Save nim,judul to kti
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
                    <li class="breadcrumb-item active"> Validasi Seminar Hasil</li>
                </ol>
            </div>

                <div id="tabelvalidasiseminarhasill" class="table-responsive"></div>


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
                url : 'getvalidasisemhas.php',
                type:'post',
                cache : false,
                success : function(data)
                {
                    $('#tabelvalidasiseminarhasill').html(data);
                }
                });
            });

//set Tidak Lolos Semhas
            $(document).on("click", "#tidaklolossemhas", function () {
		        var tglsemhas = $(this).data('tglseminarhasil');
                var nim = $(this).data('nimmahasiswa');
                var judul = $(this).data('judulsemhas');
		        $('#lblnim').val(nim);
                $('#lbljudul').val(judul);
                $('#tglseminarhasil').val(tglsemhas);
	        });

//set Lolos Prosal
            $(document).on("click", "#lolossemhas", function () {
		        var tglsemhas = $(this).data('tglseminarhasil');
                var nim = $(this).data('nimmahasiswa');
                var judul = $(this).data('judulsemhas');
                var semester = $(this).data('idsemester');
                $('#nim').val(nim);
                $('#judul_semhas').val(judul);
                $('#tgl_seminarhasil').val(tglsemhas);
                $('#idsemester').val(semester);
	        });
</script>

<!-- Tidak Lolos Proposal -->
<div class="modal fade" id="tidaklolossemhasmodal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" >
                <div class="modal-header">
                    <h4 class="modal-title">Tidak Lolos Seminar Hasil</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" style="background-color: #e60000">
                <form method="POST">
                    <input class="form-control" name="tglseminarhasil" id="tglseminarhasil" type="hidden"
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
        //update tabel proposal
        $sql = "UPDATE semhas SET status_semhas ='Tidak Lolos' WHERE nim = '$_POST[nim]' AND tgl_seminarhasil = '$_POST[tglseminarhasil]'";
        if (mysqli_query($conn, $sql)) {

        }
    }
    ?>
<!-- End Tidak Lolos Proposal -->

<!-- Lolos Proposal -->
<div class="modal fade" id="lolossemhasmodal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" >
                <div class="modal-header">
                    <h4 class="modal-title">Lolos Seminar Hasil</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" style="background-color: #b3b3ff">
                <form method="post" enctype="multipart/form-data">
                    <input class="form-control" name="tgl_seminarhasil" id="tgl_seminarhasil" type="hidden"
                    style="border: 0px solid red; background-color: #b3b3ff; color:white; " >
                    <input class="form-control" name="idsemester" id="idsemester" type="hidden"
                    style="border: 0px solid red; background-color: #b3b3ff; color:white; " >
                    <input class="form-control" name="nim" id="nim" type="text"
                    style="border: 0px solid red; background-color: #b3b3ff; color:white; " >
                    <input class="form-control" name="judul_semhas" id="judul_semhas" type="text"
                    style="border: 0px solid red; background-color: #b3b3ff; color:white;" >
                    <br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Upload Berita Acara Seminar Hasil</span>
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

        $uploaddir='./uploadSemhas/';
        $alamatfile=$uploaddir.$nama_file;
        if(move_uploaded_file($_FILES['pdf']['tmp_name'],$alamatfile));
        {
            $sql = "UPDATE semhas SET status_semhas ='Lolos', file_semhas = '$alamatfile' WHERE nim = '$_POST[nim]' AND tgl_seminarhasil = '$_POST[tgl_seminarhasil]'";
            echo $sql;
            if (mysqli_query($conn, $sql))
            {
                $sql = "INSERT INTO kti (nim,judul_penelitian,tgl_ujiankti,idsemester) VALUES ('$_POST[nim]','$_POST[judul_semhas]','00/00/0000','0')";
                if (mysqli_query($conn, $sql))
                {

                }
                $sql_kumpulberkas = "INSERT INTO kumpul_berkas (nim) VALUES ('$_POST[nim]')";
                if (mysqli_query($conn, $sql_kumpulberkas))
                {

                }
                $sql_nilai = "INSERT INTO nilai_akhir (`id_nilaiakhir`, `nim`, `nilai_isi`, `nilai_metode`, `nilai_materi`, `nilai_presentasi`, `nilai_huruf_blmkumpul`, `nilai_angka_final`, `nilai_huruf`)
                VALUES ('$_POST[nim]', '0', '0', '0', '0', '0', '0', '-')";
                 if (mysqli_query($conn, $sql_nilai))
                {

                }
            }
        }
    }
?>
<!-- End Lolos Proposal -->

