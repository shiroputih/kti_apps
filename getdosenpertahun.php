<?php
@include("header.php");
@include("dbconnect.php");

if($_POST['semester1'] && $_POST['semester2']){
    $sql = "SELECT * FROM sk WHERE sk.id_semestersk = '".$_POST['semester1']."' OR sk.id_semestersk = '".$_POST['semester2']."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nim</th>
                                    <th>Dosen Pembimbing 1</th>
                                    <th>Dosen Pembimbing 2</th>
                                    <th>Semester</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $no =1;
                                $sql = "SELECT sk.nim_sk AS nim ,mahasiswa.nama AS nama,semester,d1.gelar_depan AS d1depan,d1.gelar_belakang AS d1belakang,d2.gelar_depan AS d2depan,d2.gelar_belakang AS d2belakang,d1.nama_dosen as nmdosen1, d2.nama_dosen as nmdosen2 from dosen d1,semester, dosen d2, sk,mahasiswa where d1.id_dosen <> d2.id_dosen and d1.id_dosen = sk.id_dosen1sk AND d2.id_dosen = sk.id_dosen2sk AND mahasiswa.nim = sk.nim_sk AND sk.id_semestersk = '".$_POST['semester1']."' OR sk.id_semestersk='".$_POST['semester2']."' AND sk.id_semestersk=semester.id_semester AND sk.id_semestersk=semester.id_semester GROUP BY sk.nim_sk ";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                        // output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>
                                        <td>$no</td>
                                        <td>$row[nim]</td>
                                        <td>$row[d1depan] $row[nmdosen1],$row[d1belakang]</td>
                                        <td>$row[d2depan] $row[nmdosen2],$row[d2belakang]</td>
                                        <td>$row[semester]</td>
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
                    </div>
                </div>
            </div>
            <?php 
        }
    }
}
$conn->close();
?>

<div class="modal fade" id="viewdosenmodal" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <h5>Detail Data Dosen</h5>
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

