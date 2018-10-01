<?php
@include("header.php");
@include("dbconnect.php");

if($_POST['idsemester']){
    $semester = $_POST['idsemester'];
    $sql = "SELECT * FROM sk WHERE sk.id_semestersk = '".$_POST['idsemester']."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr align="center">
                                 <th>#</th>
                                 <th>Nama Dosen</th>
                                 <th>Gelar Depan</th>
                                 <th>Gelar Belakang</th>
                                 <th>Jumlah Mahasiswa</th>
                                 <th>Action</th>
                             </tr>
                         </thead>
                         <tbody>
                            <?php
                            $no =1;
                            $sql = "SELECT COUNT(num) AS num1,id_dosen1 AS iddosen1 FROM (
                            SELECT COUNT(sk1.nim)  as num, sk1.id_dosen1
                            FROM sk1
                            WHERE sk1.id_semester = '".$_POST['idsemester']."' 
                            GROUP BY sk1.id_dosen1
                            HAVING COUNT(sk1.nim) < 10

                            UNION ALL

                            SELECT COUNT(sk2.nim) as num, sk2.id_dosen2
                            FROM sk2
                            WHERE sk2.id_semester = '".$_POST['idsemester']."'
                            GROUP BY sk2.id_dosen2
                            HAVING COUNT(sk2.nim) < 10) as query2

                            GROUP BY id_dosen1";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                            // output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    echo "
                                    <tr>
                                    <td> $no</td>
                                    <td> ";
                                    ?>
                                    <?php
                                        $dosensql = "SELECT * FROM dosen where dosen.id_dosen = $row[iddosen1]";
                                        $resdosen1 = mysqli_query($conn,$dosensql);
                                        foreach ($resdosen1 as $row1) { 
                                            echo $row1['nama_dosen'];
                                        }
                                    ?> 

                                    </td>
                                    <td align='center'>
                                        <?php
                                            $dosensql = "SELECT * FROM dosen where dosen.id_dosen = $row[iddosen1]";
                                            $resdosen1 = mysqli_query($conn,$dosensql);
                                            foreach ($resdosen1 as $row1) { 
                                                echo $row1['gelar_depan'];
                                            }
                                        ?>
                                    </td>
                                    <td align="center">
                                    <?php
                                            $dosensql = "SELECT * FROM dosen where dosen.id_dosen = $row[iddosen1]";
                                            $resdosen1 = mysqli_query($conn,$dosensql);
                                            foreach ($resdosen1 as $row1) { 
                                                echo $row1['gelar_belakang'];
                                            }
                                        ?>
                                    </td>
                                    <?php echo"
                                    <td align='center'> $row[num1]</td>
                                    <td class=center>
                                    <a id ='viewdosen' data-iddosen= $row[iddosen1] data-idsemester = '$semester' data-toggle='modal' data-target='#viewdosenmodal'>
                                    <button type='button' class='btn btn-primary btn-circle btn-sm'><i class='fa fa-list'></i>
                                    </button></a>
                                    <a id ='deletedosen' data-iddosen=$row[iddosen1]  data-toggle='modal' data-target='#deleteModal'>
                                    <button type='button' class='btn btn-danger btn-circle btn-sm'><i class='fa fa-times'></i>
                                    </button></a>
                                    </td>
                                    </tr>";
                                    $no+=1;
                                }
                            } else {

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

