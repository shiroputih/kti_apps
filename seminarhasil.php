<?php
    @include("header.php");
    @include("navigation.php");
    @include("dbconnect.php");
?>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
    <div class="fixed-nav sticky-footer bg-dark" id="page-top">
        <div class="content-wrapper">

            <div class="container-fluid">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.php">Home</a>
                    </li>
                    <li class="breadcrumb-item active"> Data Seminar Hasil</li>
                </ol>
            </div>

            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-table"></i> Data Seminar Hasil
                </div>
            </div>
            
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>NIM</th>
                                <th>Nama Mahasiswa</th>
                                <th>Judul KTI</th>
                                <th>Angkatan</th>
                                <th>Tgl Seminar Hasil</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>NIM</th>
                                <th>Nama Mahasiswa</th>
                                <th>Judul KTI</th>
                                <th>Angkatan</th>
                                <th>Tgl Seminar Hasil</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM mahasiswa,semhas,angkatan where mahasiswa.nim = semhas.nim AND semhas.id_angkatan = angkatan.id_angkatan ";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                // output data of each row
                                while ($path = $result->fetch_assoc()) {
                                    echo "<tr>
                                            <td>$path[nim]</td>
                                            <td>$path[nama]</td>
                                            <td>$path[judulKTI]</td>
                                            <td>$path[angkatan]</td>
                                            <td>$path[tgl_seminarhasil]</td>
                                            </tr>";
                                }
                            } else {

                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>
    </div>
</body>

<?php
    @include("footer.php");
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