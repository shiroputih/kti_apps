<?php
@include("dbconnect.php");
    $sql = "SELECT * FROM kti";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>

    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>NIM</th>
            <th>Nama</th>
            <th>Kumpul Berkas KTI</th>
            <th>Nilai Akhir KTI</th>
            <th>Nilai Akhir KTI(Huruf)</th>
        </tr>
    </thead>
    <tfoot>
    <tr>
        <th>NIM</th>
        <th>Nama</th>
        <th>Kumpul Berkas KTI</th>
        <th>Nilai Akhir KTI</th>
        <th>Nilai Akhir KTI(Huruf)</th>
        </tr>
    </tfoot>
    <tbody>
        <?php
        $sql = "SELECT * FROM kumpul_berkas
            JOIN mahasiswa ON kumpul_berkas.nim = mahasiswa.nim
            JOIN nilai_akhir ON nilai_akhir.nim = kumpul_berkas.nim";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>$row[nim]</td>
                    <td>$row[nama]</td>
                    <td>$row[tgl_kumpulberkas]</td>
                    <td>$row[nilai_angka_final]</td>
                    <td>$row[nilai_huruf]</td>
                    </tr>";
            }
        }else{
            echo "Belum Ada Mahasiswa yang sidang KTI";
        }
        ?>
    </tbody>
    </table>

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
