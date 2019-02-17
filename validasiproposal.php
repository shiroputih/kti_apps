<?php
    @include("header.php");
    @include("navigation.php");
    @include("dbconnect.php");

    //show proposal which status is null
    //set null status to Lolos or Tidak Lolos
    //upload scan berita acara if status is Lolos
    //Save nim,judul to semhas
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
                    <li class="breadcrumb-item active"> Validasi Proposal</li>
                </ol>
            </div>

            <div class="card-body">
                <div id="tabelvalidasiproposal" class="table-responsive"></div>
            </div>

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
                url : 'getvalidasiproposal.php',
                type:'post',
                cache : false,
                success : function(data)
                {
                    $('#tabelvalidasiproposal').html(data);
                }
                });
            });

//set Tidak Lolos Prosal
            $(document).on("click", "#tidaklolosproposal", function () {
		        var tglproposal = $(this).data('tglproposal');
                var nim = $(this).data('nimmahasiswa');
                var judul = $(this).data('judulproposal');
		        $('#lblnim').val(nim);
                $('#lbljudul').val(judul);
                $('#tglproposal').val(tglproposal);
	        });

//set Lolos Prosal
            $(document).on("click", "#lolosproposal", function () {
		        var tglproposal = $(this).data('tglproposal');
                var nim = $(this).data('nimmahasiswa');
                var judul = $(this).data('judulproposal');
                var semester = $(this).data('idsemester');
                $('#nim').val(nim);
                $('#judul_proposal').val(judul);
                $('#tgl_proposal').val(tglproposal);
                $('#idsemester').val(semester);
	        });
</script>

<!-- Tidak Lolos Proposal -->
<div class="modal fade" id="tidaklolosproposalmodal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" >
                <div class="modal-header">
                    <h4 class="modal-title">Tidak Lolos Proposal</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" style="background-color: #e60000">
                <form method="POST">
                    <input class="form-control" name="tglproposal" id="tglproposal" type="hidden"
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
        $sql = "UPDATE proposal SET status_proposal ='Tidak Lolos' WHERE nim = '$_POST[nim]' AND tgl_sidangproposal = '$_POST[tglproposal]'";
        if (mysqli_query($conn, $sql)) {
            echo "<meta http-equiv='refresh' content='0'>";
        }
    }
    ?>
<!-- End Tidak Lolos Proposal -->

<!-- Lolos Proposal -->
<div class="modal fade" id="lolosproposalmodal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" >
                <div class="modal-header">
                    <h4 class="modal-title">Lolos Proposal</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" style="background-color: #b3b3ff">
                <form method="post" enctype="multipart/form-data">
                    <input class="form-control" name="tgl_proposal" id="tgl_proposal" type="hidden"
                    style="border: 0px solid red; background-color: #b3b3ff; color:white; " >
                    <input class="form-control" name="idsemester" id="idsemester" type="hidden"
                    style="border: 0px solid red; background-color: #e60000; color:white; " >
                    <input class="form-control" name="nim" id="nim" type="text"
                    style="border: 0px solid red; background-color: #b3b3ff; color:white; " >
                    <input class="form-control" name="judul_proposal" id="judul_proposal" type="text"
                    style="border: 0px solid red; background-color: #b3b3ff; color:white;" >
                    <br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Upload Berita Acara Proposal</span>
                        </div>
                        <div class="custom-file">
                            <input class="form-control" name="pdf" id="pdf" accept="application/pdf" type="file">
                        </div>
                    </div>
                    <button type="submit" name="Lolos" class='btn btn-primary btn-md' >  Lolos  </button>
                    <button type="submit" name="cancel" data-dismiss="modal" class='btn btn-success btn-md' > Batal </button>
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

        $uploaddir='./uploadProposal/';
        $alamatfile=$uploaddir.$nama_file;
        if(move_uploaded_file($_FILES['pdf']['tmp_name'],$alamatfile));
        {
            $sql = "UPDATE proposal SET status_proposal ='Lolos', file_proposal = '$alamatfile' WHERE nim = '$_POST[nim]' AND tgl_sidangproposal = '$_POST[tgl_proposal]'";
            if (mysqli_query($conn, $sql))
            {
                $sql = "INSERT INTO semhas (nim,judul_penelitian,tgl_seminarhasil,idsemester) VALUES ('$_POST[nim]','$_POST[judul_proposal]','00/00/0000','0')";
                if (mysqli_query($conn, $sql))
                {

                }
            }
        }
    }
    ?>
<!-- End Tidak Lolos Proposal -->
