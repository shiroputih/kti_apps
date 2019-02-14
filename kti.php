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

            <div id="tabledosen" class="table-responsive">
                <div class = "tabelkti"></div>
            </div>

    </div>
</body>

    <?php
    @include("footer.php");
    ?>

<!-- Detail Modal -->
<div class="modal fade" id="ViewDataktiModal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Detail KTI</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="card-body">
					<div class="viewdetailkti"></div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal content Detail-->
<div class="modal fade" id="beritaacaraktimodal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Setup Berita Acara Ujian KTI</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="formberitaacara"></div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
       $(document).ready(function()
       {
        $.ajax({
                    url : 'getdataktiall.php',
                    type:'post',
                    cache : false,
                    success : function(data)
                    {
                        $('.tabelkti').html(data);
                    }
                });
    });

	$(document).ready(function()
	{
		$('#ViewDataktiModal').on('show.bs.modal', function (e)
		{
			var nim = $(e.relatedTarget).data('nimmahasiswa');
		                //menggunakan fungsi ajax untuk pengambilan data
		                $.ajax(
		                {
		                	type : 'post',
		                	url : 'detailktipermahasiswa.php',
		                	data :  'nim='+ nim,
		                	success : function(data)
		                	{
		                        $('.viewdetailkti').html(data);//menampilkan data ke dalam modal
		                    }
		                });
		            });
	});

    $(document).ready(function(){
                $('#beritaacaraktimodal').on('show.bs.modal', function (e) {
                    var nim = $(e.relatedTarget).data('nimmahasiswa');
                    var flag = $(e.relatedTarget).data('flag');
                        //menggunakan fungsi ajax untuk pengambilan data
                        $.ajax({
                            type : 'post',
                            url : 'beritaacarakti.php',
                            data :  "nim="+nim+"&flag="+flag,
                            success : function(data){
                                $('.formberitaacara').html(data);//menampilkan data ke dalam modal
                            }
                            });
                });
            });

    </script>

<?php
    if(isset($_POST['CreateBeritaAcarakti']))
    {
       $sql = "UPDATE kti SET
        waktupelaksanaan ='$_POST[waktusidang]',
        id_ruangsidang = '$_POST[ruangsidang]',
        tgl_ujiankti = '$_POST[tanggal]',
        idsemester = '$_POST[semester]'
        WHERE kti.nim = '$_POST[hiddennim]'";
        if (mysqli_query($conn, $sql))
        {
            //save log history judul
            $sql_loghistory = "INSERT INTO loghistoryjudul (nim,judul_penelitian,stage) VALUES ('". $_POST[hiddennim] . "','".$_POST[judul]."','KTI')";
            if (mysqli_query($conn, $sql_loghistory))
            {}
        }

    }
    if(isset($_POST['UlangBeritaAcaraSemhas']))
    {
        //insert new data to table proposal
        $sql = "INSERT INTO kti (nim,waktupelaksanaan,id_ruangsidang,judul_penelitian,tgl_ujiankti,idsemester)
        VALUES ('".$_POST[hiddennim]."','".$_POST[waktusidang]."','".$_POST[ruangsidang]."','".$_POST[judul]."','".$_POST[tanggal]."','".$_POST[semester]."')";
        if (mysqli_query($conn, $sql))
        {
        }

    }

    if(isset($_POST['UpdateBeritaAcarakti']))
    {
        $sql = "UPDATE kti SET
        waktupelaksanaan ='$_POST[waktusidang]',
        id_ruangsidang = '$_POST[ruangsidang]',
        tgl_ujiankti = '$_POST[tanggal]',
        idsemester = '$_POST[semester]'
        WHERE kti.nim = '$_POST[hiddennim]'";
        if (mysqli_query($conn, $sql))
        {}
    }
?>

