<?php

@include("dbconnect.php");
?>
       <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th width="40%">Judul Penelitian</th>
                    <th>Tgl Seminar Hasil</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

                <tbody>
                    <?php
                    $sql = "SELECT * FROM semhas h1
                    INNER JOIN ( select nim,MAX(tgl_seminarhasil) as tgl FROM semhas group by nim ) h2
                    ON h1.nim = h2.nim AND h1.tgl_seminarhasil = h2.tgl  AND h1.tgl_seminarhasil != '00/00/0000'
                    JOIN mahasiswa ON mahasiswa.nim = h1.nim
                    JOIN semester ON h1.idsemester = semester.id_semester";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($path = $result->fetch_assoc()) {

                                echo "<tr>
                                <td>$path[nim]</td>
                                <td>$path[nama]</td>
                                <td width='40%'>$path[judul_penelitian]</td>
                                <td>$path[tgl_seminarhasil]</td>
                                <td>$path[status_semhas]</td>
                                <td align='center'>
                                    <a id ='lolossemhas' data-tglseminarhasil='$path[tgl_seminarhasil]' data-nimmahasiswa='$path[nim]' data-judulsemhas='$path[judul_penelitian]' data-idsemester = '$path[idsemester]'   data-toggle='modal' data-target='#lolossemhasmodal'>
                                    <button type='button' class='btn btn-primary btn-sm' data-toggle='tooltip' data-placement='top' title='Lolos Semhas'><img src='icons/check.png' width='20px' height='20px'></button></a>

                                    <a id ='tidaklolossemhas' data-tglseminarhasil='$path[tgl_seminarhasil]' data-nimmahasiswa='$path[nim]' data-judulsemhas='$path[judul_penelitian]' data-toggle='modal' data-target='#tidaklolossemhasmodal'>
                                    <button type='button' class='btn btn-primary btn-sm' data-toggle='tooltip' data-placement='top' title='Tidak Lolos Semhas'><img src='icons/uncheck.png' width='20px' height='20px'></button></a>
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