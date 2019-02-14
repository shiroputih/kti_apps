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
                <li class="breadcrumb-item active">Mahasiswa Per Semester</li>
            </ol>
        </div>

        <div class="container-fluid">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Semester</label>
                </div>
                <select class="custom-select" name="semester" id="semester" selected="selected">
                    <option> -- Pilih Semester -- </option>
                    <?php
                    $sql = "SELECT * FROM semester";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                    ?>

                        <option value ="<?php echo $row['id_semester']; ?>"> <?php echo $row['semester']; ?></option>
                    <?php
                        }
                    } else {
                        echo "0 results";
                    }
                    ?>
                </select>
            </div>
        </div>

            <div id="tabledosen" class="table-responsive">
                <div class = "tabeldata"></div>
            </div>

    </div>
</body>
<?php
@include("footer.php");
?>



 <!-- show detail dosen semester -->
 <script type="text/javascript">
    $(document).ready(function(){
        $('#semester').change(function(){
            var id = $(this).find(":selected").val();
            $.ajax({
                url : 'getmahasiswapersemester.php',
                type:'post',
                data : 'idsemester='+ id,
                cache : false,
                success : function(data)
                {
                    $('.tabeldata').html(data);
                }
            });
        });
    });
 </script>
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

