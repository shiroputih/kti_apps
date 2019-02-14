<?php
@include("dbconnect.php");
?>
       <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th width="40%">Judul Penelitian</th>
                    <th>Tgl Ujian KTI</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            
                <tbody>
                    <?php
                    $sql = "SELECT * FROM kti k1 
                    INNER JOIN ( select nim,MAX(tgl_ujiankti) as tgl FROM kti group by nim ) k2 
                    ON k1.nim = k2.nim AND k1.tgl_ujiankti = k2.tgl 
                    JOIN mahasiswa ON mahasiswa.nim = k1.nim
                    JOIN semester ON k1.idsemester = semester.id_semester";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($path = $result->fetch_assoc()) 
                        {
                            if($path['tgl_ujiankti'] != '00/00/0000')
                            {
                                echo "<tr>
                                <td>$path[nim]</td>
                                <td>$path[nama]</td>
                                <td width='40%'>$path[judul_penelitian]</td>
                                <td>$path[tgl_ujiankti]</td>
                                <td>$path[status_kti]</td>
                                <td align='center'>
                                ";
                                if($path['status_kti'] == 'Lolos'){

                                }else{
                                    echo"
                                        <a id ='loloskti' data-tglujiankti='$path[tgl_ujiankti]' data-nimmahasiswa='$path[nim]' data-judulkti='$path[judul_penelitian]' data-idsemester = '$path[idsemester]'   data-toggle='modal' data-target='#lolosktimodal'>
                                        <button type='button' class='btn btn-primary btn-sm' data-toggle='tooltip' data-placement='top' title='Lolos Semhas'><img src='icons/check.png' width='20px' height='20px'></button></a>
                                        
                                        <a id ='tidakloloskti' data-tglujiankti='$path[tgl_ujiankti]' data-nimmahasiswa='$path[nim]' data-judulkti='$path[judul_penelitian]' data-idsemester = '$path[idsemester]'   data-toggle='modal' data-target='#tidaklolosktimodal'>
                                        <button type='button' class='btn btn-primary btn-sm' data-toggle='tooltip' data-placement='top' title='Tidak Lolos Semhas'><img src='icons/uncheck.png' width='20px' height='20px'></button></a>
                                        ";
                                }
                                echo "</td>
                                </tr>";
                            }
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