<?php
@include("dbconnect.php");
?>


            <div id="tablekti" class="table-responsive">
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Dosen Penguji 1</th>
                            <th>Dosen Penguji 2</th>
                            <th>Dosen Penguji 3</th>

                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Dosen Penguji 1</th>
                            <th>Dosen Penguji 2</th>
                            <th>Dosen Penguji 3</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    <form method="POST">
                        <?php
                        $sql = "SELECT kti.nim, mahasiswa.nama, kti.judul_penelitian,kti.file_kti,d1.id_dosen as dosen1, d2.id_dosen as dosen2,d3.id_dosen as dosen3,n1.status_nilai as n1,n2.status_nilai as n2,n3.status_nilai as n3
                        FROM kti
                        JOIN mahasiswa ON kti.nim = mahasiswa.nim
                        JOIN assign_sk as sk1 ON sk1.assign_dosen ='pembimbing 1'
                        JOIN dosen as d1 ON d1.id_dosen = sk1.id_dosen
                        JOIN assign_sk as sk2 ON sk2.assign_dosen ='pembimbing 2'
                        JOIN dosen as d2 ON d2.id_dosen = sk2.id_dosen
                        JOIN assign_sk as sk3 ON sk3.assign_dosen ='penguji'
                        JOIN dosen as d3 ON d3.id_dosen = sk3.id_dosen
                        JOIN nilai_perdosen as n1 ON n1.id_dosen = sk1.id_dosen
                        JOIN nilai_perdosen as n2 ON n2.id_dosen = sk2.id_dosen
                        JOIN nilai_perdosen as n3 ON n3.id_dosen = sk3.id_dosen
                        WHERE kti.status_kti = 'Lolos'
                        AND kti.nim = sk1.nim
                        AND kti.nim = sk2.nim
                        AND kti.nim = sk3.nim
                        AND n1.nim = sk1.nim
                        AND n2.nim = sk2.nim
                        AND n3.nim = sk3.nim";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>$row[nim]</td>
                                        <td>$row[nama]</td>
                                        <td>";
                                        if($row['n1']=='1'){
                                            echo "
                                            <a id ='detail1' data-nim=$row[nim] data-nama='$row[nama]' data-judulkti='$row[judul_penelitian]' data-iddosen1 ='$row[dosen1]'
                                            data-toggle='modal' data-target='#DetailNilaiModal'>
                                            <button type='submit' class='btn btn-primary btn-sm' ><img src='icons/detail.png' width='20px' height='20px'></button></a>
                                            <a id ='editnilai1' data-nim=$row[nim] data-nama='$row[nama]' data-judulkti='$row[judul_penelitian]' data-iddosen1 ='$row[dosen1]'
                                            data-toggle='modal' data-target='#EditNilaiModal1'>
                                            <button type='submit' class='btn btn-warning btn-sm' ><img src='icons/edit.png' width='20px' height='20px'></button></a>
                                        ";
                                        }else{
                                            echo"
                                            <a id ='addnilai1' data-nim=$row[nim] data-nama='$row[nama]' data-judulkti='$row[judul_penelitian]' data-iddosen1 ='$row[dosen1]'  data-toggle='modal' data-target='#AddNilai1Modal1'>
                                            <button type='submit' class='btn btn-success btn-sm' data-toggle='tooltip' data-placement='top' title='Tambah Nilai'><img id='img1' src='icons/add.png' width='20px' height='20px'></button></a>
                                            ";
                                        }
                                        echo"
                                        </td>
                                        <td>";
                                        if( $row['n2']=='1'){
                                            echo "
                                            <a id ='detail1' data-nim=$row[nim] data-nama='$row[nama]' data-judulkti='$row[judul_penelitian]' data-iddosen2 ='$row[dosen2]'
                                            data-toggle='modal' data-target='#DetailNilaiModal'>
                                            <button type='submit' class='btn btn-primary btn-sm' ><img src='icons/detail.png' width='20px' height='20px'></button></a>
                                            <a id ='editnilai2' data-nim=$row[nim] data-nama='$row[nama]' data-judulkti='$row[judul_penelitian]' data-iddosen2 ='$row[dosen2]'
                                            data-toggle='modal' data-target='#EditNilaiModal2'>
                                            <button type='submit' class='btn btn-warning btn-sm' ><img src='icons/edit.png' width='20px' height='20px'></button></a>
                                            ";
                                        }else{
                                            echo"
                                            <a id ='addnilai2' data-nim=$row[nim] data-nama='$row[nama]' data-judulkti='$row[judul_penelitian]' data-iddosen2 ='$row[dosen2]'  data-toggle='modal' data-target='#AddNilaiModal2'>
                                            <button type='submit' class='btn btn-success btn-sm' data-toggle='tooltip' data-placement='top' title='Tambah Nilai'><img id='img1' src='icons/add.png' width='20px' height='20px'></button></a></td>
                                            ";
                                        }
                                        echo"
                                        </td>
                                        <td>";
                                        if($row['n3']=='1'){
                                            echo "
                                            <a id ='detail1' data-nim=$row[nim] data-nama='$row[nama]' data-judulkti='$row[judul_penelitian]' data-iddosen3 ='$row[dosen3]'
                                            data-toggle='modal' data-target='#DetailNilaiModal'>
                                            <button type='submit' class='btn btn-primary btn-sm' ><img src='icons/detail.png' width='20px' height='20px'></button></a>
                                            <a id ='editnilai3' data-nim=$row[nim] data-nama='$row[nama]' data-judulkti='$row[judul_penelitian]' data-iddosen3 ='$row[dosen3]'
                                            data-toggle='modal' data-target='#EditNilaiModal3'>
                                            <button type='submit' class='btn btn-warning btn-sm' ><img src='icons/edit.png' width='20px' height='20px'></button></a>
                                            ";
                                        }else{
                                            echo"
                                            <a id ='addnilai3' data-nim=$row[nim] data-nama='$row[nama]' data-judulkti='$row[judul_penelitian]' data-iddosen3 ='$row[dosen3]' data-toggle='modal' data-target='#AddNilaiModal3'>
                                            <button type='button' class='btn btn-success btn-sm' data-toggle='tooltip' data-placement='top' title='Tambah Nilai'><img src='icons/add.png' width='20px' height='20px'></button></a>
                                            ";
                                        }
                                        echo"
                                        </td>

                                        </tr>";
                            }
                        }
                        ?>
                    </tbody>

                </table>
            </div>


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


