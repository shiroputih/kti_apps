<?php
@include("dbconnect.php");

if($_POST['idtahunajaran']){
    $sql = "SELECT * FROM assign_sk WHERE assign_sk.id_tahunajaran = '".$_POST['idtahunajaran']."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
            <div class="table-responsive">
                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr align="center">
                                    <th>#</th>
                                    <th>Nama Dosen</th>
                                    <th>Jumlah Mahasiswa</th>
                                    <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no =1;
                            $sql = "SELECT *,COUNT(assign_sk.id_dosen) as num FROM assign_sk
                            JOIN dosen ON dosen.id_dosen = assign_sk.id_dosen
                            WHERE id_tahunajaran ='".$_POST['idtahunajaran']."' AND assign_dosen != 'penguji' GROUP BY assign_sk.id_dosen ";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                    <td>$no</td>
                                    <td>$row[gelar_depan] $row[nama_dosen] $row[gelar_belakang]</td>
                                    <td align=center>$row[num]</td>
                                    <td class=center>
                                    <a id ='viewdosen' data-iddosen=$row[id_dosen] data-idtahunajaran ='$row[id_tahunajaran]' data-namadosen='$row[nama_dosen]' data-gelardepan='$row[gelar_depan]' data-gelarbelakang='$row[gelar_belakang]' data-toggle='modal' data-target='#viewdosenmodal'>
                                    <button type='button' class='btn btn-primary btn-sm' data-toggle='tooltip' data-placement='top' title='Detail Data Dosen'><img src='icons/detail.png' width='20px' height='20px'></button></a>
                                    </td>
                                    </tr>";
                                    $no+= 1;
                                }
                            } else {

                            }
                            ?>
                        </tbody>
                    </table>
                    </div>
                    <?php
        }
    } else {
        ?>
            <div class = "notification">Tidak ada dosen pembimbing pada tahun ajaran ini<div>
        <?php
    }
}
$conn->close();
?>

<div class="modal fade" id="viewdosenmodal" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <h5>Detail Data Dosen Per Tahun Ajaran</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="listmodal"></div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).on("click", "#viewdosen", function () {
        var iddosen = $(this).data('iddosen');
        var idtahunajaran = $(this).data('idtahunajaran');
        $.ajax({
            url : 'detaildosenpertahun.php',
            type:'post',
            data : "iddosen="+iddosen+"&idtahunajaran="+idtahunajaran,
            cache : false,
            success : function(data)
            {
                $('.listmodal').html(data);
            }
        });
    })
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

