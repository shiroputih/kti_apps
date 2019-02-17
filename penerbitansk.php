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

                    </div>
            </form>

                <div id="tabelsk" class="table-responsive"></div>
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


