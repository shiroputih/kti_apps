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
                <li class="breadcrumb-item active">Track Record Mahasiswa</li>
            </ol>
        </div>

        <div class="container-fluid">

        </div>

         <!-- Tab links -->
        <div class="tab">
        <button class="tablinks" onclick="openTable(event, 'Table1')">Per Semester</button>
        <button class="tablinks" onclick="openTable(event, 'Table2')">Per Mahasiswa</button>
        <button class="tablinks" onclick="openTable(event, 'Table3')">Per Dosen</button>
        </div>

        <!-- Tab content -->
        <div id="Table1" class="tabcontent">
        <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Semester</label>
                </div>
                <select class="custom-select" name="semester" id="semester" selected="selected">
                    <option> -- Pilih Semester -- </option>
                    <?php
                    $sql = "SELECT * FROM semester ORDER BY semester ASC";
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
                <div id="tabelrecordmhs_persemester" class="table-responsive"></div>
        </div>

        <div id="Table2" class="tabcontent">
        <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Mahasiswa</label>
                </div>
                <select class="custom-select" name="mahasiswa" id="mahasiswa" selected="selected">
                    <option> -- Pilih Mahasiswa -- </option>
                    <?php
                    $sql = "SELECT * FROM mahasiswa ORDER BY nama ASC";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                    ?>

                        <option value ="<?php echo $row['nim']; ?>"> <?php echo $row['nama']; ?></option>
                    <?php
                        }
                    } else {
                        echo "0 results";
                    }
                    ?>
                </select>
            </div>
                <div id="tabelrecordmhs_pernama" class="table-responsive"></div>
        </div>
        <div id="Table3" class="tabcontent">
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
                <div id="tabelrecordmhs_perdosen" class="table-responsive"></div>
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
        $('#semester').change(function(){
            var id = $(this).find(":selected").val();
            $.ajax({
                        url : 'gettrackrecordmahasiswa.php',
                        type:'post',
                        data : 'idsemester='+ id,
                        cache : false,
                        success : function(data)
                        {
                            $('#tabelrecordmhs_persemester').html(data);
                        }
                    });
            });

            $('#mahasiswa').change(function(){
            var nim = $(this).find(":selected").val();
            $.ajax({
                        url : 'gettrackrecordmahasiswa.php',
                        type:'post',
                        data : 'nim='+ nim,
                        cache : false,
                        success : function(data)
                        {
                            $('#tabelrecordmhs_pernama').html(data);
                            $('#tabelrecordmhs_persemester').html("Silahkan memilih semester");
                            $('#semester').val(0);
                        }
                    });
            });

            $('#dosen').change(function(){
            var iddosen = $(this).find(":selected").val();
            $.ajax({
                        url : 'gettrackrecordmahasiswa.php',
                        type:'post',
                        data : 'iddosen='+ iddosen,
                        cache : false,
                        success : function(data)
                        {
                            $('#tabelrecordmhs_perdosen').html(data);
                            $('#tabelrecordmhs_persemester').html("Silahkan memilih semester");
                            $('#semester').val(0);
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