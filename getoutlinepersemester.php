<?php
@include ("dbconnect.php");
if($_POST['idsemester']){
    $sql = "SELECT * FROM outline WHERE outline.semester = '".$_POST['idsemester']."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
?>
<div class="table-responsive">
                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>NIM</th>
                                <th>Nama Mahasiswa</th>
                                <th>Judul Outline</th>
                                <th>Usulan Dosen 1</th>
                                <th>Tgl Pengajuan</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>NIM</th>
                                <th>Nama Mahasiswa</th>
                                <th>Judul Outline</th>
                                <th>Usulan Dosen 1</th>
                                <th>Tgl Pengajuan</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM outline,dosen,mahasiswa WHERE outline.status = '' AND outline.usulan_dosen1 = dosen.id_dosen AND outline.nim = mahasiswa.nim AND outline.semester = '".$_POST['idsemester']."' ";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) 
                            {
                            // output data of each row
                                while ($path = $result->fetch_assoc()) 
                                {
                                    echo "<tr>
                                    <td>$path[nim]</td>
                                    <td>$path[nama]</td>
                                    <td>$path[judul_outline]</td>
                                    <td>$path[gelar_depan] $path[nama_dosen] $path[gelar_belakang]</td>
                                    <td>$path[tgl_pengajuan]</td>
                                    <td>$path[status]</td>
                                    <td class='center'>

                                    <a id ='VerifikasiOutline' 
                                    data-nimmahasiswa='$path[nim]' 
                                    data-namamahasiswa='$path[nama]'  
                                    data-juduloutline='$path[judul_outline]' 
                                    data-pertanyaan='$path[pertanyaan_penelitian]' 
                                    data-manfaat ='$path[manfaat_penelitian]' 
                                    data-desain ='$path[desain_penelitian]' 
                                    data-sample ='$path[sample_penelitian]' 
                                    data-bebas ='$path[variabel_bebas]' 
                                    data-tergantung ='$path[variabel_tergantung]' 
                                    data-hipotesis ='$path[hipotesis]' 
                                    data-usulandosen1 ='$path[usulan_dosen1]' 
                                    data-usulandosen2 ='$path[usulan_dosen2]'
                                    data-tanggal = '$path[tgl_pengajuan]'
                                    data-status = '$path[status]'
                                    data-semester = '$path[semester]'
                                    data-toggle='modal' 
                                    data-target='#VerifikasiOutlineModal'>
                                    <button type='button' class='btn btn-warning btn-sm'>Verifikasi</button></a>
                                    </td>
                                    </tr>";
                                }
                            } else {

                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                 <?php 
            }
        }
    }
        $conn->close();
        ?>
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