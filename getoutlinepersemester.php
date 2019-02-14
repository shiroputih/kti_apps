<?php
@include ("dbconnect.php");
if($_POST['idsemester']){
    $sql = "SELECT * FROM outline WHERE outline.semester = '".$_POST['idsemester']."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
?>
                            <?php
                             $sql = "SELECT * FROM outline,dosen,mahasiswa
                            WHERE outline.status = ''
                            AND outline.usulan_dosen1 = dosen.id_dosen
                            AND outline.usulan_dosen1 != '0'
                            AND outline.nim = mahasiswa.nim
                            AND outline.semester = '".$_POST['idsemester']."' ";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0)
                            {
                            ?>
                            <form method="POST">
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
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            while ($path = $result->fetch_assoc())
                                            {
                                                echo "<tr>
                                                <td>$path[nim]</td>
                                                <td>$path[nama]</td>
                                                <td>$path[judul_outline]</td>
                                                <td>$path[gelar_depan] $path[nama_dosen] $path[gelar_belakang]</td>
                                                <td>$path[tgl_pengajuan]</td>
                                                <td>$path[status]</td>
                                                <td align='center'>
                                                <input type='checkbox' name='verifikasi[]' value='$path[nim]'>
                                                </td>
                                                </tr>";
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                    <button type="submit" name="LolosVerifikasiOutline" style="margin: 0px 0px 10px 20px;" class="btn btn-info btn-sm" >Lolos</button>
                                    <button type="submit" name="TidakLolosVerifikasiOutline" style="margin: 0px 0px 10px 20px;" class="btn btn-danger btn-sm" >Tidak Lolos</button>
                                </div>
                            </form>
                                <?php
                            }else{
                                ?>
                                    <div class = "notification">Semua mahasiswa sudah terverifikasi pada semester ini, Silahkan Periksa di <a href='lihatdataoutline.php'> Sini </a><div>
                                <?php
                            }
                        }
    }else{
    ?>
        <div class = "notification">Data Dosen Pembimbing 1 dan 2 belum lengkap, Silahkan Periksa di <a href='lihatdataoutline.php'> Sini </a><div>
    <?php
    }
}
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

