<?php
@include("dbconnect.php");
?>
<div class="table-responsive">
    <table class="table table-hover" id="dataTable" cellspacing="0">
        <thead>
            <tr>
                <th>NIM</th>
                <th>Nama Mahasiswa</th>
                <th>Judul Outline</th>
                <th>Dosen Pembimbing 1</th>
                <th>Dosen Pembimbing 2</th>
                <th>Tgl Pengajuan</th>
                <th>Status Outline</th>
                <th>Action</th>
            </tr>
        </thead>
        <tfoot>
        <tr>
                <th>NIM</th>
                <th>Nama Mahasiswa</th>
                <th>Judul Outline</th>
                <th>Dosen Pembimbing 1</th>
                <th>Dosen Pembimbing 2</th>
                <th>Tgl Pengajuan</th>
                <th>Status Outline</th>
                <th>Action</th>
            </tr>
        </tfoot>
        <tbody>
            <?php
            /*$sql = "SELECT *,m.nama,d.nama_dosen AS dosen1_nama,d.gelar_depan AS dosen1_gelardepan, d.gelar_belakang AS dosen1_gelarbelakang,
            d2.nama_dosen AS dosen2_nama, d2.gelar_depan AS dosen2_gelardepan, d2.gelar_belakang AS dosen2_gelarbelakang
            FROM outline AS o, dosen AS d, dosen AS d2,mahasiswa as m
            where o.usulan_dosen1 = d.id_dosen
            AND o.usulan_dosen2 = d2.id_dosen
            AND o.nim = m.nim
            OR tgl_disetujui IS NULL ";*/
            $sql = "SELECT *,m.nama,d.nama_dosen AS dosen1_nama,d.gelar_depan AS dosen1_gelardepan, d.gelar_belakang AS dosen1_gelarbelakang,
            d2.nama_dosen AS dosen2_nama, d2.gelar_depan AS dosen2_gelardepan, d2.gelar_belakang AS dosen2_gelarbelakang
            FROM outline AS o, dosen AS d, dosen AS d2,mahasiswa as m
            where o.usulan_dosen1 = d.id_dosen
            AND o.usulan_dosen2 = d2.id_dosen
            AND o.nim = m.nim
            ";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($path = $result->fetch_assoc()){

                        echo "<tr>
                        <td>$path[nim]</td>
                        <td>$path[nama]</td>
                        <td width='30%'>$path[judul_outline]</td>
                        <td>$path[dosen1_gelardepan] $path[dosen1_nama] $path[dosen1_gelarbelakang]</td>
                        <td>$path[dosen2_gelardepan] $path[dosen2_nama] $path[dosen2_gelarbelakang]</td>
                        <td>$path[tgl_pengajuan]</td>
                        <td>$path[status]</td>
                        <td class='center' width='10%'>
                        <a id ='Viewoutline'
                        data-nimmahasiswa='$path[nim]'
                        data-namamahasiswa='$path[nama]'
                        data-semester='$path[semester]'
                        data-toggle='modal'
                        data-target='#ViewOutlineModal'>
                        <button type='button' class='btn btn-primary btn-sm'><img src='icons/detail.png' width='10px' height='10px'></button></a>

                        <a id ='Editoutline'
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
                        data-toggle='modal'
                        data-target='#EditOutlineModal'>
                        <button type='button' class='btn btn-warning btn-sm'><img src='icons/edit.png' width='10px' height='10px'></button></a>
                        ";
                        if($path['status'] != 'Lolos Outline'){
                            echo "<a id ='Deleteoutline'
                            data-idoutline='$path[id_outline]'
                            data-nimmahasiswa='$path[nim]'
                            data-namamahasiswa='$path[nama]'
                            data-juduloutline='$path[judul_outline]'
                            data-idtahunajaran='$path[id_tahunajaran]'
                            data-toggle='modal'
                            data-target='#DeleteOutlineModal'>
                            <button type='button' class='btn btn-danger btn-sm'><img src='icons/delete.png' width='10px' height='10px'></button></a>
                            </td>
                            </tr>";
                        }else{
                            echo "
                            </td>
                            </tr>";
                        }
                    }

                }else {

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