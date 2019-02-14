<?php
@include("dbconnect.php");
?>
       <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th width='40%'>Judul Proposal</th>
                    <th>Tgl Seminar Proposal</th>
                    <th>Status</th>
                    <th>Semester</th>
                    <th>Berita Acara Proposal</th>
                    <th>Action</th>
                </tr>
            </thead>

                <tbody>
                    <?php
                    $sql = "SELECT * FROM proposal p1
                    INNER JOIN ( select nim,MAX(tgl_sidangproposal) as tgl FROM proposal group by nim ) p2
                    ON p1.nim = p2.nim AND p1.tgl_sidangproposal = p2.tgl
                    JOIN mahasiswa ON mahasiswa.nim = p1.nim
                    JOIN semester ON p1.id_semester = semester.id_semester";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($path = $result->fetch_assoc()) {
                            if($path['tgl_sidangproposal'] == '00/00/0000')
                                {
                                echo "<tr>
                                <td>$path[nim]</td>
                                <td>$path[nama]</td>
                                <td width='30%'>$path[judulproposal]</td>
                                <td>$path[tgl_sidangproposal]</td>
                                <td>$path[status_proposal]</td>
                                <td>$path[semester]</td>
                                <td></td>
                                <td align='center' width='10%'>
                                    <a id ='detailproposal' data-nimmahasiswa='$path[nim]' data-namamahasiswa='$path[nama]' data-toggle='modal' data-target='#detailproposalmodal'>
                                    <button type='button' class='btn btn-primary btn-sm' data-toggle='tooltip' data-placement='top' title='Detail Proposal'><img src='icons/detail.png'width=15px' height='15px'></button></a>
                                    <a id ='beritaacaraproposal' data-flag='baru' data-nimmahasiswa='$path[nim]' data-judulproposal='$path[judulproposal]' data-toggle='modal' data-target='#beritaacaraproposalmodal'>
                                    <button type='button' class='btn btn-primary btn-sm' data-toggle='tooltip' data-placement='top' title='Berita Acara'><img src='icons/file.png'width=15px' height='15px'></button></a>
                                    <a id ='deleteproposal' data-nimmahasiswa='$path[nim]' data-namamahasiswa='$path[nama]' data-toggle='modal' data-target='#deleteproposal'>
                                    <button type='button' class='btn btn-danger btn-sm' data-toggle='tooltip' data-placement='top' title='Hapus Proposal'><img src='icons/delete.png'width=15px' height='15px'></button></a>
                                    </td>
                                    </tr>";
                                }elseif($path['status_proposal'] == 'Lolos'){
                                    echo "<tr>
                                    <td>$path[nim]</td>
                                    <td>$path[nama]</td>
                                    <td width='30%'>$path[judulproposal]</td>
                                    <td>$path[tgl_sidangproposal]</td>
                                    <td>$path[status_proposal]</td>
                                    <td>$path[semester]</td>
                                    <td align='center'><a href=$path[file_proposal] target='_blank'><img src='icons/pdficon.png' width='30px' height='30px'></a></td>
                                    <td align='center'>
                                        <a id ='detailproposal' data-nimmahasiswa='$path[nim]' data-namamahasiswa='$path[nama]' data-toggle='modal' data-target='#detailproposalmodal'>
                                        <button type='button' class='btn btn-primary btn-sm' data-toggle='tooltip' data-placement='top' title='Detail Proposal'><img src='icons/detail.png'width=15px' height='15px'></button></a>
                                        </td>
                                        </tr>";
                                }
                                else{
                                    echo "<tr>
                                    <td>$path[nim]</td>
                                    <td>$path[nama]</td>
                                    <td>$path[judulproposal]</td>
                                    <td>$path[tgl_sidangproposal] </td>
                                    <td>$path[status_proposal]</td>
                                    <td>$path[semester]</td>
                                    <td></td>
                                    <td align='center'>
                                    <a id ='detailproposal' data-nimmahasiswa='$path[nim]' data-namamahasiswa='$path[nama]' data-toggle='modal' data-target='#detailproposalmodal'>
                                    <button type='button' class='btn btn-primary btn-sm' data-toggle='tooltip' data-placement='top' title='Detail Proposal'><img src='icons/detail.png'width=15px' height='15px'></button></a>

                                    <a id ='ulangproposal' data-flag='ulang' data-nimmahasiswa='$path[nim]' data-namamahasiswa='$path[nama]' data-toggle='modal' data-target='#beritaacaraproposalmodal'>
                                    <button type='button' class='btn btn-success btn-sm' data-toggle='tooltip' data-placement='top' title='Ulang Proposal'><img src='icons/replay.png'width=15px' height='15px'></button></a>

                                    <a id ='editproposal' data-flag='edit' data-nimmahasiswa='$path[nim]' data-namamahasiswa='$path[nama]' data-idangkatan='$path[id_angkatan]' data-idsemester='$path[id_semester]' data-idtahunajaran='$path[id_tahunajaran]'data-toggle='modal' data-target='#beritaacaraproposalmodal'>
                                    <button type='button' class='btn btn-warning btn-sm' data-toggle='tooltip' data-placement='top' title='Edit Berita Acara'><img src='icons/edit.png'width=15px' height='15px'></button></a>
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
