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
                <li class="breadcrumb-item active"> Validasi Nilai Karya Tulis Ilmiah</li>
            </ol>
        </div>

                <div class = "tabelnilaikti" class="table-responsive"></div>


    </div>
</body>

    <?php
    @include("footer.php");
    ?>

<script type="text/javascript">
       $(document).ready(function()
       {
        $.ajax({
                    url : 'getnilaiakhirkti.php',
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
                        <form method="post">
                            <div class="datanilaifinal" style="width: 50%; float: left;">

                            </div>

                            <div style=" margin-left: 55%;">
                                <iframe id="objpdf" src="" type="application/pdf" width="450px" height="650px"></iframe>
                                <button type="submit" name="finalnilai" class="btn btn-danger btn-md-1" >Verifikasi Nilai Akhir</button>
                            </div>

                        </form>
                        </div>
                    </div>
                </div>

        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).on("click", "#finalisasinilai", function(){
        var file=$(this).data('filekti');
        document.getElementById('objpdf').src = file;

        var nim = $(this).data('nim');
        var iddosen = $(this).data('iddosen');
        $.ajax({
            type : 'post',
            url : 'getfinalisasinilaipermahasiswa.php',
            data :  'nim='+nim,
            success : function(data){
                $('.datanilaifinal').html(data);//menampilkan data ke dalam modal
            }
        });
    });
</script>

<?php
    if (isset($_POST['finalnilai'])) {
        $sql = "UPDATE nilai_akhir SET
        nilai_isi  = '$_POST[final_isi]',
        nilai_metode  = '$_POST[final_metode]',
        nilai_materi  = '$_POST[final_materi]',
        nilai_presentasi  = '$_POST[final_presentasi]',
        nilai_huruf_blmkumpul = '$_POST[huruf_sblm]',
        nilai_angka_final  = '$_POST[angka]',
        nilai_huruf  = '$_POST[huruf_kumpul]'
        WHERE nim = '$_POST[nim]'";
        if (mysqli_query($conn, $sql)) {

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


