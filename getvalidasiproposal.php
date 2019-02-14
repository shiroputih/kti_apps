<?php
@include("header.php");
@include("dbconnect.php");
?>
       <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th width="40%">Judul Proposal</th>
                    <th>Tgl Seminar Proposal</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

                <tbody>
                    <?php
                    $sql = "SELECT * FROM proposal p1
                    INNER JOIN ( select nim,MAX(tgl_sidangproposal) as tgl FROM proposal group by nim ) p2
                    ON p1.nim = p2.nim AND p1.tgl_sidangproposal = p2.tgl AND p1.tgl_sidangproposal != '00/00/0000'
                    JOIN mahasiswa ON mahasiswa.nim = p1.nim
                    JOIN semester ON p1.id_semester = semester.id_semester

                    ";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($path = $result->fetch_assoc()) {

                                echo "<tr>
                                <td>$path[nim]</td>
                                <td>$path[nama]</td>
                                <td width='40%'>$path[judulproposal]</td>
                                <td>$path[tgl_sidangproposal]</td>
                                <td>$path[status_proposal]</td>
                                <td align='center'>
                                    <a id ='lolosproposal' data-tglproposal='$path[tgl_sidangproposal]' data-idsemester = '$path[id_semester]' data-nimmahasiswa='$path[nim]' data-judulproposal='$path[judulproposal]' data-toggle='modal' data-target='#lolosproposalmodal'>
                                    <button type='button' class='btn btn-primary btn-sm' data-toggle='tooltip' data-placement='top' title='Lolos Proposal'><img src='icons/check.png' width='20px' height='20px'></button></a>
                                    <a id ='tidaklolosproposal' data-tglproposal='$path[tgl_sidangproposal]' data-nimmahasiswa='$path[nim]' data-judulproposal='$path[judulproposal]' data-toggle='modal' data-target='#tidaklolosproposalmodal'>
                                    <button type='button' class='btn btn-primary btn-sm' data-toggle='tooltip' data-placement='top' title='Tidak Lolos Proposal'><img src='icons/uncheck.png' width='20px' height='20px'></button></a>
                                    </td>
                                    </tr>";

                            }
                        }
                    ?>
                </tbody>
            </table>

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