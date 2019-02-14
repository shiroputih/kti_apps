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
                    <li class="breadcrumb-item active"> Data Proposal</li>
                </ol>
            </div>


                <div id="tabelproposal" class="table-responsive"></div>


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
                url : 'getproposalall.php',
                type:'post',
                cache : false,
                success : function(data)
                {
                    $('#tabelproposal').html(data);
                }
                });
            });

            $(document).ready(function(){
                $('#detailproposalmodal').on('show.bs.modal', function (e)
                {
                    var nim = $(e.relatedTarget).data('nimmahasiswa');
                    //menggunakan fungsi ajax untuk pengambilan data
                    $.ajax({
                        type : 'post',
                        url : 'getproposalpermahasiswa.php',
                        data :  'nim='+ nim,
                        success : function(data){
                            $('.fetched-data').html(data);//menampilkan data ke dalam modal
                        }
                        });
                });
            });

            $(document).ready(function(){
                $('#beritaacaraproposalmodal').on('show.bs.modal', function (e) {
                    var nim = $(e.relatedTarget).data('nimmahasiswa');
                    var flag = $(e.relatedTarget).data('flag');
                        //menggunakan fungsi ajax untuk pengambilan data
                        $.ajax({
                            type : 'post',
                            url : 'beritaacaraproposal.php',
                            data :  "nim="+nim+"&flag="+flag,
                            success : function(data){
                                $('.formberitaacara').html(data);//menampilkan data ke dalam modal
                            }
                            });
                });
            });
    </script>

    <!-- Modal View Detail-->
    <div class="modal fade" id="detailproposalmodal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detail Data Proposal</h4><button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="fetched-data"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal content Detail-->
    <div class="modal fade" id="beritaacaraproposalmodal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Setup Berita Acara Proposal</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="formberitaacara"></div>
                </div>
            </div>
        </div>
    </div>

     <?php
    if(isset($_POST['CreateBeritaAcaraProposal']))
    {
       $sql = "UPDATE proposal SET
        waktupelaksanaan ='$_POST[waktusidang]',
        id_ruangsidang = '$_POST[ruangsidang]',
        tgl_sidangproposal = '$_POST[tanggal]',
        id_semester = '$_POST[semester]'
        WHERE proposal.nim = '$_POST[hiddennim]'";
        if (mysqli_query($conn, $sql))
        {
            //save log history judul
            $sql_loghistory = "INSERT INTO loghistoryjudul (nim,judul_penelitian,stage) VALUES ('". $_POST[hiddennim] . "','".$_POST[judul]."','PROPOSAL')";
            if (mysqli_query($conn, $sql_loghistory))
            {}

            //save dosen penguji
            $sql_assignpenguji = "INSERT INTO assign_sk (id_dosen,nim,id_semester,id_tahunajaran,assign_dosen,status_sk)
            VALUES ('". $_POST[ProposalDosenPenguji] . "','".$_POST[hiddennim]."','".$_POST[hiddensemester]."','".$_POST[hiddentahunajaran]."','penguji', 'aktif')";
            if (mysqli_query($conn, $sql_assignpenguji))
            {}

            //save batas waktu
            $sql_bataswaktu = "INSERT INTO batas_waktu (nim,tgl_proposal,batas_ujiankti)
            VALUES ('". $_POST[hiddennim] . "','".$_POST[tanggal]."','".$_POST[hiddenbatas]."')";
            if (mysqli_query($conn, $sql_bataswaktu))
            {}
        }
        $conn->close();
    }

    if(isset($_POST['UlangBeritaAcaraProposal']))
    {
        //insert new data to table proposal
        $sql = "INSERT INTO proposal (nim,waktupelaksanaan,id_ruangsidang,judulproposal,tgl_sidangproposal,id_semester)
        VALUES ('".$_POST[hiddennim]."','".$_POST[waktusidang]."','".$_POST[ruangsidang]."','".$_POST[judul]."','".$_POST[tanggal]."','".$_POST[semester]."')";
        if (mysqli_query($conn, $sql))
        {
            //update batas waktu
            $sql_bataswaktu = "UPDATE batas_waktu SET
            tgl_proposal = '$_POST[tanggal]',
            batas_ujiankti = '$_POST[hiddenbatas]'
            WHERE bataswaktu.nim = '$_POST[hiddennim]'";
            if (mysqli_query($conn, $sql_bataswaktu))
            {}
        }
        $conn->close();
    }

    if(isset($_POST['UpdateBeritaAcaraProposal']))
    {
       $sql = "UPDATE proposal SET
        waktupelaksanaan ='$_POST[waktusidang]',
        id_ruangsidang = '$_POST[ruangsidang]',
        tgl_sidangproposal = '$_POST[tanggal]'
        WHERE proposal.nim = '$_POST[hiddennim]' AND proposal.id_proposal = '$_POST[hiddenid]'";
        if (mysqli_query($conn, $sql))
        {
        }
    }
?>


