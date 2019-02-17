<?php
@include("dbconnect.php");
@include("header.php");

if (isset($_POST['nim'])) {
    $nim = $_POST['nim'];
    $sql_databerkas = "SELECT * FROM kti
    JOIN mahasiswa ON mahasiswa.nim = '$nim '
    WHERE kti.nim = '$nim'";
    $result = $conn->query($sql_databerkas);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
            <form method="POST">
                <div class="form-group">
                    <input class="form-control" name="hiddennimberkas" id="hiddennimberkas" value="<?php echo $_POST['nim']; ?>" type="hidden"
                    aria-describedby="nameHelp">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text">Semester</label>
                        </div>
                            <select id="semester" name="semester" class="custom-select">
                                        <option>-- Pilih Semester --</option>
                                        <?php
                                        $sql = "SELECT * FROM semester";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            while ($data = $result->fetch_assoc()) {
                                                echo "<option value=$data[id_semester]>$data[semester]</option> ";
                                            }
                                        } else {
                                            echo "0 results";
                                        }
                                        ?>
                                    </select>
                    </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">NIM</label>
                                </div>
                                <input class="form-control" name="nim" id="nim" value="<?php echo $_POST['nim']; ?>" type="text"
                                aria-describedby="nameHelp" disabled="">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Nama Mahasiswa</label>
                                </div>
                                <input class="form-control" name="nama" id="nama" type="text" value = "<?php echo $row['nama']; ?>"
                                aria-describedby="nameHelp" disabled="">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text">Judul Penelitian</label>
                                </div>
                                <textarea rows="3" cols="50" name="judul" class="form-control" id="judul"
                                aria-describedby="nameHelp"  style="text-transform: uppercase;"
                                ><?php echo $row['judul_penelitian']; ?></textarea>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend" id='datetimepicker1'>
                                    <label class="input-group-text">Tanggal Kumpul Berkas</label>
                                </div>
                                <input class="form-control" id="date" name="tanggal" placeholder="dd/mm/yyyy" type="text" />

                            </div>
                            <hr width="10px">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text">Dosen Pembimbing 1</label>
                                </div>
                                <select class="custom-select" name="Dosen1" id="Dosen1" disabled>
                                    <?php
                                    $sql = "SELECT * FROM assign_sk,dosen WHERE assign_sk.assign_dosen = 'pembimbing 1' AND assign_sk.id_dosen = dosen.id_dosen AND assign_sk.nim = '" . $_POST['nim'] . "' ";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value=$row[id_dosen]>$row[gelar_depan] $row[nama_dosen] $row[gelar_belakang]</option>";
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text">Dosen Pembimbing 2</label>
                                </div>
                                <select name="Dosen2" id="Dosen2" class="custom-select" disabled>
                                    <?php
                                    $sql = "SELECT * FROM assign_sk,dosen WHERE assign_sk.assign_dosen = 'pembimbing 2' AND assign_sk.id_dosen = dosen.id_dosen AND assign_sk.nim = '" . $_POST['nim'] . "' ";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value=$row[id_dosen]>$row[gelar_depan] $row[nama_dosen] $row[gelar_belakang]</option> ";
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <button type="submit" name="createberitaacarapenerimaanberkas" class="btn btn-primary btn-md">Simpan</button>
            </form>
<?php

}
}
}

?>

<!-- datepicker -->
<script>
 $(document).ready(function(){
        var date_input=$('input[name="tanggal"]');
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        var options={
            format: 'dd/mm/yyyy',
            container: container,
            todayHighlight: true,
            autoclose: true,
        };
        date_input.datepicker(options);
    });
</script>

