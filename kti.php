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
                <li class="breadcrumb-item active"> Data Karya Tulis Ilmiah</li>
            </ol>
        </div>
        <div id="Table" class="card-body">
            <div id="tabledosen" class="table-responsive">
                <form method="post" action="excelkumpulpersemester.php">
                    <div class="container-fluid">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Semester</label>
                            </div>
                            <select class="custom-select" name="semester" id="semester" selected="selected">
                                <option> -- Pilih Semester --</option>
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

                    <button type="submit" name="export" style="margin-top: 0; margin-left: 1%; width:12%" class="btn btn-success btn-sm"><img src="icons/excel.png" width="30px" height="30px"> Kumpul Berkas </button>
                </form>
                <div id="Table" class="card-body">
                    <div id="tabledosen" class="table-responsive">
                    <div class = "tabelkti"></div>
                </div>
            </div>
        </div>
       
    </body>
    <?php
    @include("footer.php");
    ?>

    <script type="text/javascript">
        $('#semester').change(function(){
            var sem1 = $(this).find(":selected").val();
            $.ajax({
                    url : 'getnilaikti.php',
                    type:'post',
                    data : "semester="+sem1,
                    cache : false,
                    success : function(data)
                    {
                        $('.tabelkti').html(data);
                    }
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

