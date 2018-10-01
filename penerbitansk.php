<!DOCTYPE html>
<html lang="en">
<?php
@include("header.php");
@include("dbconnect.php");
?>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
    <?php
    @include("navigation.php");
    ?>

    <div class="content-wrapper">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.php">Home</a>
                </li>
                <li class="breadcrumb-item active">Penerbitan SK</li>
            </ol>
        </div>

        <div class="container-fluid">
            <div class="input-group mb-3">
            
                </div>
            </div>

            <form id="cetak" action="cetaksk.php" method="POST" target="_blank">
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputsemester">Semester</label>
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
                            <a href="cetaksk.php?semester=<?php echo $semester; ?>" target="_blank">
                        <button type="submit" class="btn btn-info btn-medium" ><img src="icons/add.png" width="30px" height="30px">Cetak SK</button></a>
                    </div>
                </form>



            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-table"></i> Data Surat Keputusan FK UKDW</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="tabelsk"></div>
                        </div>
                    </div>
                    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                </div>

            </div>
        </body>
        </html>

        <!-- show detail dosen semester -->
        <script type="text/javascript">
            $(document).ready(function(){
                $('#semester').change(function(){
                    var id = $(this).find(":selected").val();
                    $.ajax({
                        url : 'getpenerbitansk.php',
                        type:'post',
                        data : 'idsemester='+ id,
                        cache : false,
                        success : function(data)
                        {
                            $('#tabelsk').html(data);
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
        <script src="vendor/chart.js/Chart.min.js"></script>
        <script src="vendor/datatables/jquery.dataTables.js"></script>
        <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin.min.js"></script>
        <!-- Custom scripts for this page-->
        <script src="js/sb-admin-datatables.min.js"></script>
        <script src="js/sb-admin-charts.min.js"></script>
