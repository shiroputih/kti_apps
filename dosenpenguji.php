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
                <li class="breadcrumb-item active">Dosen Penguji  Per Semester</li>
            </ol>
        </div>
        <form method="post" action="exceldosenpenguji.php">
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
            <button type="submit" name="export" style="margin-top: 0; margin-left: 1%; width:5%" class="btn btn-default btn-sm"><img src="icons/excel.png" width="30px" height="30px">Export</button>
        </form>

         <div class = "tabeldosenpenguji"></div>

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
                url : 'getdosenpenguji.php',
                type:'post',
                data : 'idsemester='+ id,
                cache : false,
                success : function(data)
                {
                    $('.tabeldosenpenguji').html(data);
                }
            });
        });
    });
 </script>

