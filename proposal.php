<?php
@include("header.php");
@include("navigation.php");
@include("dbconnect.php");
?>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<div class="content-wrapper">
    <div class="container-fluid">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.php">Home</a>
            </li>
            <li class="breadcrumb-item active">Berita Acara Proposal</li>
        </ol>
    </div>
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-table"></i> Berita Acara Proposal
        </div>

        <div class="card-body">
            <form>
                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupNama">NIM Mahasiswa</label>
                        </div>
                        <input type="text" class="form-control" name="searchnim" id="searchnim"
                               aria-describedby="nameHelp" placeholder="Nim Mahasiswa">
                        <button type="submit" name="searchmahasiswa" id="searchmahasiswa" class="btn btn-primary">
                            Search
                        </button>
                    </div>
                    <hr>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupNama">Nama Mahasiswa</label>
                        </div>
                        <input class="form-control" disabled type="text" name="namamahasiswa" id="namamahasiswa"
                               aria-describedby="nameHelp" placeholder="Nama Mahasiswa">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupNama">Tanggal Seminar Proposal</label>
                        </div>
                        <input class="form-control" id="date" name="date" placeholder="MM/DD/YYY" type="text"/>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupNama">Ruang Seminar Proposal</label>
                        </div>
                        <select class="custom-select" name="ruangsidang" id="inputGroupSelect01">
                            <?php
                            $sql = "select * from ruangsidang ORDER BY id_ruang ASC";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                // output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value=$row[id_ruang]> $row[ruangsidang]</option>";
                                }
                            } else {
                                echo "0 results";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupNama">Judul Proposal</label>
                        </div>
                        <input class="form-control" disabled type="text" id="inputGroupNama"
                               aria-describedby="nameHelp">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupNama">Dosen Pembimbing 1</label>
                        </div>
                        <input class="form-control" disabled type="text" id="inputGroupNama"
                               aria-describedby="nameHelp">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupNama">Dosen Pembimbing 2</label>
                        </div>
                        <input class="form-control" disabled type="text" id="inputGroupNama"
                               aria-describedby="nameHelp">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupNama">Dosen Penguji</label>
                        </div>
                        <select class="custom-select" name="dosenpenguji" id="inputGroupSelect01">
                            <?php
                            $sql = "select * from dosen ORDER BY nama_dosen ASC";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                // output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value=$row[id_dosen]> $row[nama_dosen] $row[gelar_depan] $row[gelar_belakang]</option>";
                                }
                            } else {
                                echo "0 results";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <a class="btn btn-primary btn-block" data-toggle="modal" data-target="#confirm">Save and Create</a>
            </form>
        </div>
    </div>
</div>
</body>

<?php
@include("footer.php");
?>

<script>
    $(document).ready(function () {
        var date_input = $('input[name="date"]'); //our date input has the name "date"
        var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
        var options = {
            format: 'dd-M-yyyy',
            container: container,
            todayHighlight: true,
            autoclose: true,
        };
        date_input.datepicker(options);
    })
</script>

<!-- search feature -->
<script>
    $(document).ready(function () {
        $("#searchmahasiswa").click(function () {
            var nilai = $("#searchnim").val();
        })
    });
</script>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<!-- Page level plugin JavaScript-->
<script src="vendor/chart.js/Chart.min.js"></script>
<script src="vendor/datatables/jquery.dataTables.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.js"></script>
<!-- Custom scripts for all pages-->
<script src="js/sb-admin.min.js"></script>
<!-- Custom scripts for this page-->
<script src="js/sb-admin-datatables.min.js"></script>
<script src="js/sb-admin-charts.min.js"></script>
<!--Datetimepicker-->
<script type="text/javascript" src="vendor/jquery/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="vendor/jquery/bootstrap-datepicker.min.js"></script>
