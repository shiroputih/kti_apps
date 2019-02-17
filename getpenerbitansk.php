<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Dosen</th>
                        <th>Nim</th>
                        <th>Mahasiswa Bimbingan 1</th>
                        <th>Nim</th>
                        <th>Mahasiswa Bimbingan 2</th>
                    </tr>
                </thead>
                <tbody>
<?php

@include("dbconnect.php");

if(isset($_POST['idsemester'])){
    $semester = $_POST['idsemester'];
    $sql = "SELECT * FROM assign_sk
            JOIN dosen ON dosen.id_dosen = assign_sk.id_dosen
            JOIN mahasiswa ON mahasiswa.nim = assign_sk.nim
            WHERE assign_sk.id_semester = '".$_POST['idsemester']."'
            AND assign_sk.assign_dosen != 'penguji'
            ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
// output data of each row
    $no = 1;
    while ($row = $result->fetch_assoc()) {
?>
    <tr>
        <td><?php echo $no;?></td>
        <td><?php echo $row['gelar_depan']." ".$row['nama_dosen']." ".$row['gelar_belakang']; ?></td>
        <td>
<?php
        if($row['assign_dosen'] == 'pembimbing 1' ){
            echo $row['nim'];
        }
                                    else{
                                        echo "-";
                                    }
                                    ?>
                                </td>
                                <td>
                                <?php
                                    if($row['assign_dosen'] == 'pembimbing 1' ){
                                        echo $row['nama'];
                                    }
                                    else{
                                        echo "-";
                                    }
                                    ?>
                                </td>
                                <td>
                                <?php
                                    if($row['assign_dosen'] == 'pembimbing 2' ){
                                        echo $row['nim'];
                                    }
                                    else{
                                        echo "-";
                                    }
                                    ?>
                                </td>
                                <td>
                                <?php
                                    if($row['assign_dosen'] == 'pembimbing 2' ){
                                        echo $row['nama'];
                                    }
                                    else{
                                        echo "-";
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                            $no++;
                        }
                    }
                    ?>
                </tbody>
                <a href="cetaksk.php?semester=<?php echo $semester; ?>" target="_blank">
                <button type="submit" class="btn btn-link btn-sm"><img src="icons/print.png" width="50px" height="50px"></button></a>
                <br><br><br><br>


            </table>
<?php
    }

    else{
        ?>
        <div class = "notification">Maaf, Data SK pada semester ini belum ditemukan <div>
    <?php
}

$conn->close();
?>
            <!-- Bootstrap core JavaScrip
            <script src="vendor/jquery/jquery.min.js"></script>t-->
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

