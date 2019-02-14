<?php
@include("header.php");
@include("dbconnect.php");
?>
       <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th width='40%'>Judul Penelitian</th>
                    <th>Tgl Seminar Hasil</th>
                    <th>Status</th>
                    <th>Semester</th>
                    <th>Berita Acara Seminar Hasil</th>
                    <th>Action</th>
                </tr>
            </thead>

                <tbody>
                    <?php
                    $sql = "SELECT * FROM semhas h1
                    INNER JOIN ( select nim,MAX(tgl_seminarhasil) as tgl FROM semhas group by nim ) h2
                    ON h1.nim = h2.nim AND h1.tgl_seminarhasil = h2.tgl
                    JOIN mahasiswa ON mahasiswa.nim = h1.nim
                    JOIN semester ON h1.idsemester = semester.id_semester";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($path = $result->fetch_assoc()) {
                            if($path['tgl_seminarhasil']== '00/00/0000')
                                {
                                echo "<tr>
                                <td>$path[nim]</td>
                                <td>$path[nama]</td>
                                <td width='30%'>$path[judul_penelitian]</td>
                                <td>$path[tgl_seminarhasil]</td>
                                <td>$path[status_semhas]</td>
                                <td>$path[semester]</td>
                                <td></td>
                                <td align='center'>
                                    <a id ='detailsemhas' data-nimmahasiswa='$path[nim]' data-namamahasiswa='$path[nama]' data-toggle='modal' data-target='#detailsemhasmodal'>
                                    <button type='button' class='btn btn-primary btn-sm' data-toggle='tooltip' data-placement='top' title='Detail Seminar Hasil'><img src='icons/detail.png' width='20px' height='20px'></button></a>
                                    <a id ='beritaacarasemhas' data-flag='baru' data-nimmahasiswa='$path[nim]' data-judulsemhas='$path[judul_penelitian]' data-toggle='modal' data-target='#beritaacarasemhasmodal'>
                                    <button type='button' class='btn btn-primary btn-sm' data-toggle='tooltip' data-placement='top' title='Berita Acara Seminar Hasil'><img src='icons/file.png' width='20px' height='20px'></button></a>
                                    <a id ='deletesemhas' data-nimmahasiswa='$path[nim]' data-namamahasiswa='$path[nama]' data-toggle='modal' data-target='#deletesemhas'>
                                    <button type='button' class='btn btn-danger btn-sm' data-toggle='tooltip' data-placement='top' title='Hapus Seminar Hasil'><img src='icons/delete.png' width='20px' height='20px'></button></a>
                                    </td>
                                    </tr>";
                                }elseif($path['status_semhas']=='Lolos'){
                                    echo "<tr>
                                    <td>$path[nim]</td>
                                    <td>$path[nama]</td>
                                    <td width='30%'>$path[judul_penelitian]</td>
                                    <td>$path[tgl_seminarhasil]</td>
                                    <td>$path[status_semhas]</td>
                                    <td>$path[semester]</td>
                                    <td align='center'><a href=$path[file_semhas] target='_blank'><img src='icons/pdficon.png' width='30px' height='30px'></a></td>
                                    <td align='center'>
                                        <a id ='detailsemhas' data-nimmahasiswa='$path[nim]' data-namamahasiswa='$path[nama]' data-toggle='modal' data-target='#detailsemhasmodal'>
                                        <button type='button' class='btn btn-primary btn-sm' data-toggle='tooltip' data-placement='top' title='Detail Seminar Hasil'><img src='icons/detail.png' width='20px' height='20px'></button></a>
                                        </td>
                                        </tr>";
                                }
                                else{
                                    echo "<tr>
                                    <td>$path[nim]</td>
                                    <td>$path[nama]</td>
                                    <td width='30%'>$path[judul_penelitian]</td>
                                    <td>$path[tgl_seminarhasil]</td>
                                    <td>$path[status_semhas]</td>
                                    <td>$path[semester]</td>
                                    <td></td>
                                    <td align='center'>
                                    <a id ='detailsemhas' data-nimmahasiswa='$path[nim]' data-namamahasiswa='$path[nama]' data-toggle='modal' data-target='#detailsemhasmodal'>
                                    <button type='button' class='btn btn-primary btn-sm' data-toggle='tooltip' data-placement='top' title='Detail Seminar Hasil'><img src='icons/detail.png' width='20px' height='20px'></button></a>

                                    <a id ='ulangsemhas' data-flag='ulang' data-nimmahasiswa='$path[nim]' data-namamahasiswa='$path[nama]' data-toggle='modal' data-target='#beritaacarasemhasmodal'>
                                    <button type='button' class='btn btn-success btn-sm' data-toggle='tooltip' data-placement='top' title='Ulang Seminar Hasil'><img src='icons/replay.png' width='20px' height='20px'></button></a>

                                    <a id ='editsemhas' data-flag='edit' data-nimmahasiswa='$path[nim]' data-namamahasiswa='$path[nama]' data-idangkatan='$path[id_angkatan]' data-idsemester='$path[id_semester]' data-idtahunajaran='$path[id_tahunajaran]'data-toggle='modal' data-target='#beritaacarasemhasmodal'>
                                    <button type='button' class='btn btn-warning btn-sm' data-toggle='tooltip' data-placement='top' title='Edit Berita Acara'><img src='icons/edit.png' width='20px' height='20px'></button></a>
                                    </td>
                                    </tr>";
                                }
                            }
                        }
                        $conn->close();
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
