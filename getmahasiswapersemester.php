<?php
@include ("dbconnect.php");
if($_POST['idsemester']){
    $sql = "SELECT * FROM sk WHERE sk.id_semestersk = '".$_POST['idsemester']."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            ?>
            <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                       <th>#</th>
                       <th>Nim</th>
                       <th>Nama Mahasiswa</th>
                       <th>Dosen Pembimbing 1</th>
                       <th>Dosen Pembimbing 2</th>
                       <th>Action</th>
                   </tr>
               </thead>
               
               <tbody>
                <?php
                $no =1;
                $sql = "SELECT sk.nim_sk AS nim ,mahasiswa.nama AS nama,d1.gelar_depan AS d1depan,d1.gelar_belakang AS d1belakang,d2.gelar_depan AS d2depan,d2.gelar_belakang AS d2belakang,d1.nama_dosen as nmdosen1, d2.nama_dosen as nmdosen2 from dosen d1, dosen d2, sk,mahasiswa where d1.id_dosen <> d2.id_dosen and d1.id_dosen = sk.id_dosen1sk AND d2.id_dosen = sk.id_dosen2sk AND mahasiswa.nim = sk.nim_sk AND sk.id_semestersk ='".$_POST['idsemester']."'" ;
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                        // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                        <td>$no</td>
                        <td>$row[nim]</td>
                        <td>$row[nama]</td>
                        <td>$row[d1depan] $row[nmdosen1],$row[d1belakang]</td>
                        <td>$row[d2depan] $row[nmdosen2],$row[d2belakang]</td>
                        <td class=center>
                        <a id ='editdosen' data-nim= $row[nim] data-toggle='modal' data-target='#listmodal'>
                        <button type='button' class='btn btn-primary btn-circle btn-sm'><i class='fa fa-list'></i>
                        </button></a>
                        <a id ='deletedosen' data-toggle='modal' data-target='#deleteModal'>
                        <button type='button' class='btn btn-danger btn-circle btn-sm'><i class='fa fa-times'></i>
                        </button></a>
                        </td>
                        </tr>";
                        $no+=1;
                    }
                } else {
                    echo "<tr align='center'>Data Dosen Pembimbing Masih Kosong</tr>";
                }
                ?>
            </tbody>
        </table>
        <?php 
    }
}
}
$conn->close();
?>

<div class="modal fade" id="listmodal" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <h5>Detail Data Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="listmodal"></div>
            </div>
        </div>
    </div>
</div>

<!-- Show Detail Mahasiswa -->
<script type="text/javascript">
    $(document).ready(function()
    {
        $('#listmodal').on('show.bs.modal', function (e) 
        {
            var nim = $(e.relatedTarget).data('nim');
                //menggunakan fungsi ajax untuk pengambilan data
                $.ajax(
                {
                    type : 'post',
                    url : 'detailmahasiswa.php',
                    data :  'nim='+ nim,
                    success : function(data)
                    {
                        $('.listmodal').html(data);//menampilkan data ke dalam modal
                    }
                });
            });
    });
</script> 


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
