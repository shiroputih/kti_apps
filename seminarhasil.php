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
                    <li class="breadcrumb-item active"> Data Seminar Hasil</li>
                </ol>
            </div>

            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-table"></i> Data Seminar Hasil
                </div>
            </div>


            <div id="tabelsemhas" class="table-responsive"></div>


        </div>
    </div>
</body>

<?php
    @include("footer.php");
?>

 <!-- Modal View Detail-->
 <div class="modal fade" id="detailsemhasmodal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detail Data Seminar Hasil</h4><button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="fetched-data"></div>
                </div>
            </div>
        </div>
    </div>

<!-- Modal content Detail-->
<div class="modal fade" id="beritaacarasemhasmodal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Setup Berita Acara Seminar Hasil</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="formberitaacara"></div>
                </div>
            </div>
        </div>
    </div>

<!-- show proposal data -->
<script type="text/javascript">
            $(document).ready(function(){
            $.ajax({
                url : 'getsemhasall.php',
                type:'post',
                cache : false,
                success : function(data)
                {
                    $('#tabelsemhas').html(data);
                }
                });
            });

             $(document).ready(function(){
                $('#detailsemhasmodal').on('show.bs.modal', function (e)
                {
                    var nim = $(e.relatedTarget).data('nimmahasiswa');
                    //menggunakan fungsi ajax untuk pengambilan data
                    $.ajax({
                        type : 'post',
                        url : 'getsemhaspermahasiswa.php',
                        data :  'nim='+ nim,
                        success : function(data){
                            $('.fetched-data').html(data);//menampilkan data ke dalam modal
                        }
                        });
                });
            });

            $(document).ready(function(){
                $('#beritaacarasemhasmodal').on('show.bs.modal', function (e) {
                    var nim = $(e.relatedTarget).data('nimmahasiswa');
                    var flag = $(e.relatedTarget).data('flag');
                        //menggunakan fungsi ajax untuk pengambilan data
                        $.ajax({
                            type : 'post',
                            url : 'beritaacarasemhas.php',
                            data :  "nim="+nim+"&flag="+flag,
                            success : function(data){
                                $('.formberitaacara').html(data);//menampilkan data ke dalam modal
                            }
                            });
                });
            });
</script>

<?php
    if(isset($_POST['CreateBeritaAcaraSemhas']))
    {
       $sql = "UPDATE semhas SET
        waktupelaksanaan ='$_POST[waktusidang]',
        id_ruangsidang = '$_POST[ruangsidang]',
        tgl_seminarhasil = '$_POST[tanggal]',
        idsemester = '$_POST[semester]'
        WHERE semhas.nim = '$_POST[hiddennim]'";
        if (mysqli_query($conn, $sql))
        {
            //save log history judul
            $sql_loghistory = "INSERT INTO loghistoryjudul (nim,judul_penelitian,stage) VALUES ('". $_POST[hiddennim] . "','".$_POST[judul]."','SEMHAS')";
            if (mysqli_query($conn, $sql_loghistory))
            {}
        }

    }
    if(isset($_POST['UlangBeritaAcaraSemhas']))
    {
        //insert new data to table proposal
        $sql = "INSERT INTO semhas (nim,waktupelaksanaan,id_ruangsidang,judul_penelitian,tgl_seminarhasil,idsemester)
        VALUES ('".$_POST[hiddennim]."','".$_POST[waktusidang]."','".$_POST[ruangsidang]."','".$_POST[judul]."','".$_POST[tanggal]."','".$_POST[semester]."')";
        if (mysqli_query($conn, $sql))
        {
        }

    }

    if(isset($_POST['UpdateBeritaAcaraSemhas']))
    {
       $sql = "UPDATE semhas SET
        waktupelaksanaan ='$_POST[waktusidang]',
        id_ruangsidang = '$_POST[ruangsidang]',
        tgl_seminarhasil = '$_POST[tanggal]'
        WHERE semhas.nim = '$_POST[hiddennim]' AND semhas.id_semhas = '$_POST[hiddenid]'";
        if (mysqli_query($conn, $sql))
        {
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