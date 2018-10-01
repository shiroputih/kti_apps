<?php
@include("header.php");
@include("dbconnect.php");

if($_POST['idsemester']){
    $sql = "SELECT * FROM sk WHERE sk.id_semestersk = '".$_POST['idsemester']."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            ?>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Semester</th>
                        <th>Surat Keputusan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM semester,arsipsk WHERE arsipsk.idsemester = semester.id_semester  AND arsipsk.idsemester = $_POST[idsemester]";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $row['semester'];?></td>
                                <td><a href="<?php echo $row['sk_filepdf']; ?>"><img src="icons/pdficon.png" width="30px" height="30px"></a></td>
                            </tr>
                            
                            <?php
                        }
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
            <!-- Bootstrap core JavaScript-->
            <script src="vendor/jquery/jquery.min.js"></script>
            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
            <!-- Core plugin JavaScript-->
            <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
            <!-- Page level plugin JavaScript-->
            <script src="vendor/chart.js/Chart.min.js"></script>
            <script src="vendor/datatables/jquery.dataTables.js"></script>
            <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
            <!-- Custom scripts for all pages-->
            <script src="js/sb-admin.min.js"></script>
            <!-- Custom scripts for this page-->
            <script src="js/sb-admin-datatables.min.js"></script>
            <script src="js/sb-admin-charts.min.js"></script>