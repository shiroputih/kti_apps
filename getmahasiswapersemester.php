<?php
@include ("dbconnect.php");
if($_POST['idsemester']){
    $sql = "SELECT * FROM assign_sk WHERE assign_sk.id_semester = '".$_POST['idsemester']."'";
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
                    $sql = "SELECT dosen.gelar_depan,dosen.nama_dosen, dosen.gelar_belakang,s1.nim,mahasiswa.nama,s1.id_dosen AS dosen1, s2.id_dosen AS dosen2 FROM assign_sk AS s1, assign_sk AS s2, dosen,mahasiswa WHERE s1.nim = mahasiswa.nim AND s2.nim = mahasiswa.nim AND s1.id_dosen = dosen.id_dosen AND s1.id_semester = '".$_POST['idsemester']."' AND s1.assign_dosen = 'pembimbing 1' AND s2.assign_dosen = 'pembimbing 2' ORDER BY s1.nim ASC " ;
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                            // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                            <td>$no</td>
                            <td>$row[nim]</td>
                            <td>$row[nama]</td>
                            <td>$row[gelar_depan] $row[nama_dosen] $row[gelar_belakang]</td>
                            <td>";
                            $sql_dosen2 = "SELECT * FROM dosen where id_dosen = '$row[dosen2]'";
                            $res = $conn->query($sql_dosen2);
                            if($res->num_rows>0){
                                while($row2 = $res->fetch_assoc()){
                                    echo "$row2[gelar_depan] $row2[nama_dosen] $row2[gelar_belakang]";
                                }
                            }
                            echo"</td>
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
    }else{
        ?>
        <div class = "notification"> Belum ada Mahasiswa yang terverifikasi pada semester ini </div>
    <?php
    }
    $conn->close();
}
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
