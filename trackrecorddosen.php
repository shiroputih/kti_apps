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
                <li class="breadcrumb-item active">Track Record Dosen</li>
            </ol>
        </div>
        <div class="container-fluid">
        <form method="post" action="exceltrackrecorddosen.php">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Nama Dosen</label>
                </div>
                <select class="custom-select" name="dosen" id="dosen" selected="selected">
                    <option> -- Pilih Dosen -- </option>
                    <?php
                    $sql = "SELECT * FROM dosen ORDER BY nama_dosen ASC";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                    ?>

                        <option value ="<?php echo $row['id_dosen']; ?>"> <?php echo $row['nama_dosen']." ".$row['gelar_depan']." ".$row['gelar_belakang']; ?></option>
                    <?php
                        }
                    } else {
                        echo "0 results";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" name="export" style="margin-top: 0; margin-left: 1%; width:8% height:5%" class="btn btn-default btn-sm"><img src="icons/excel.png" width="30px" height="30px">Export</button>
            </form>
        </div>

         <!-- Tab links -->
         <br><br>
        <div class="tab">
        <button class="tablinks" onclick="openTable(event, 'Table1')">Pembimbing 1</button>
        <button class="tablinks" onclick="openTable(event, 'Table2')">Pembimbing 2</button>
        <button class="tablinks" onclick="openTable(event, 'Table3')">Penguji</button>
        </div>

        <!-- Tab content -->
        <div id="Table1" class="tabcontent">
                <div id="tabelrecorddosen1" class="table-responsive"></div>
        </div>

        <div id="Table2" class="tabcontent">
                <div id="tabelrecorddosen2" class="table-responsive"></div>
        </div>
        <div id="Table3" class="tabcontent">
                <div id="tabelrecordpenguji" class="table-responsive"></div>
        </div>

    </div>
</body>
<?php
@include("footer.php");
?>

<!-- show detail dosen semester -->
<script>

</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#dosen').change(function(){
            var id = $(this).find(":selected").val();
            $.ajax({
                        url : 'getrecorddosenpembimbing1.php',
                        type:'post',
                        data : 'iddosen='+ id,
                        cache : false,
                        success : function(data)
                        {
                            $('#tabelrecorddosen1').html(data);
                        }
                    });

            $.ajax({
                        url : 'getrecorddosenpembimbing2.php',
                        type:'post',
                        data : 'iddosen='+ id,
                        cache : false,
                        success : function(data)
                        {
                            $('#tabelrecorddosen2').html(data);
                            $('table#dataTable2').DataTable();
                        }
                    });


            $.ajax({
                        url : 'getrecorddosenpembimbing3.php',
                        type:'post',
                        data : 'iddosen='+ id,
                        cache : false,
                        success : function(data)
                        {
                            $('#tabelrecordpenguji').html(data);
                            $('table#dataTable3').DataTable();
                        }
                    });
            });

        });

</script>
<script>
function openTable(evt, tablename) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(tablename).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>