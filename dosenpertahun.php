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
                <li class="breadcrumb-item active">Dosen Per Tahun</li>
            </ol>
        </div>
        <form method="post" action="exceldosenpertahun.php">
        <div class="container-fluid">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Tahun Ajaran</label>
                </div>
                <select class="custom-select" name="tahunajaran" id="tahunajaran" selected="selected">
                    <option> -- Pilih Tahun Ajaran --</option>
                    <?php
                    $sql = "SELECT * FROM tahunajaran ORDER BY tahunajaran DESC";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    ?>
                        <option value ="<?php echo $row['id_tahunajaran']; ?>"><?php echo $row['tahunajaran']; ?></option>
                    <?php
                        }
                    } else {
                        echo "0 results";
                    }
                    ?>
                </select>
            </div>
        </div>
            <button type="submit" name="export" style="margin-top: 0; margin-left: 1%; width:5%" class="btn btn-default btn-sm"><img src="icons/excel.png" width="30px" height="30px">Export</button>
        </form>
            <div class = "tabeldata"></div>

        </div>
    </div>
</body>
<?php
@include("footer.php");
?>

<script type="text/javascript">
    $(document).ready(function(){
        $('#tahunajaran').change(function(){
            var idtahunajaran = $(this).find(":selected").val();
                $.ajax({
                    url : 'getdosenpertahun.php',
                    type:'post',
                    data : "idtahunajaran="+idtahunajaran,
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