
<?php
@include("dbconnect.php");
@include("header.php");
$no =1;
if($_POST['idsemester']){
    $semester = $_POST['idsemester'];
    $sql = "SELECT * FROM assign_sk
    JOIN mahasiswa ON mahasiswa.nim = assign_sk.nim
    JOIN dosen ON dosen.id_dosen = assign_sk.id_dosen
    JOIN semester ON assign_sk.id_semester = semester.id_semester
    WHERE assign_sk.id_semester = '".$_POST['idsemester']."' AND assign_sk.assign_dosen = 'penguji'
    ORDER BY assign_sk.id_dosen ASC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
?>
<div class="table-responsive">
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr align="center">
                                    <th>#</th>
                                    <th>Nama Dosen</th>
                                    <th>NIM Mahasiswa</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Semester</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
        while ($row = $result->fetch_assoc())
        {
           echo "<tr>
                <td>$no</td>
                <td>$row[gelar_depan] $row[nama_dosen] $row[gelar_belakang]</td>
                <td align=center>$row[nim]</td>
                <td align=center>$row[nama]</td>
                <td align=center>$row[semester]</td>
                </tr>";
            $no+= 1;
        }
    }else {
        ?>
            <div class = "notification">Tidak ada dosen pembimbing pada semester ini<div>
         <?php
    }
?>
    </tbody>
    </table>
<?php
    }


$conn->close();
?>

<div class="modal fade" id="viewdosenmodal" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <h5>Detail Data Dosen Per Semester</h5>
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
        var idsemester = $(this).data('idsemester');
        $.ajax({
            url : 'detaildosen.php',
            type:'post',
            data : "iddosen="+iddosen+"&idsemester="+idsemester,
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

