<?php
@include ("dbconnect.php");
@include ("header.php");

//edit berita acacra
if($_POST['nim'] && $_POST['flag'] == 'edit')
{
    $sql = "SELECT assign_sk.nim,mahasiswa.nama,semhas.judul_penelitian,assign_sk.id_semester,assign_sk.id_tahunajaran
    FROM assign_sk,mahasiswa,semhas
    WHERE semhas.nim = assign_sk.nim AND mahasiswa.nim = assign_sk.nim AND assign_sk.nim = '".$_POST['nim']."' GROUP BY assign_sk.nim";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
        // output data of each row
        while ($row = $result->fetch_assoc())
        {
?>
            <form method="POST">
                        <div class="form-group">
                                <input class="form-control" name="hiddennim" id="hiddennim" value="<?php echo $_POST['nim'];?>" type="hidden"
                                aria-describedby="nameHelp">
                                <input class="form-control" name="hiddensemester" id="hiddensemester" value="<?php echo $row['id_semester'];?>" type="hidden"
                                aria-describedby="nameHelp">
                                <input class="form-control" name="hiddentahunajaran" id="hiddentahunajaran" value="<?php echo $row['id_tahunajaran'];?>" type="hidden"
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
                                <input class="form-control" name="nim" id="nim" value="<?php echo $_POST['nim'];?>" type="text"
                                aria-describedby="nameHelp" disabled="">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Nama Mahasiswa</label>
                                </div>
                                <input class="form-control" name="nama" id="nama" type="text" value = "<?php echo $row['nama'];?>"
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
                                    <label class="input-group-text">Tanggal Seminar Hasil</label>
                                </div>
                                <input class="form-control" id="date" name="tanggal" placeholder="mm/dd/yyyy" type="text" onchange="bataskti(this.value)"/>
                                <input type="hidden" class="form-control" id="hiddenbatas" name="hiddenbatas"/>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend" data-provide='datetimepicker1'>
                                    <label class="input-group-text">Waktu Seminar Hasil</label>
                                </div>
                                <select id="waktusidang" name="waktusidang" class="custom-select">
                                    <option>-- Pilih Waktu Sidang --</option>
                                    <option>07.00</option>
                                    <option>07.30</option>
                                    <option>08.00</option>
                                    <option>08.30</option>
                                    <option>09.00</option>
                                    <option>09.30</option>
                                    <option>10.00</option>
                                    <option>10.30</option>
                                    <option>11.00</option>
                                    <option>11.30</option>
                                    <option>12.00</option>
                                    <option>12.30</option>
                                    <option>13.00</option>
                                    <option>13.30</option>
                                    <option>14.00</option>
                                    <option>14.30</option>
                                    <option>15.00</option>
                                    <option>15.30</option>
                                    <option>16.00</option>
                                    <option>16.30</option>
                                    <option>17.00</option>
                                    <option>17.30</option>
                                </select>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text">Ruang Sidang</label>
                                </div>
                                <select id="ruangsidang" name="ruangsidang" class="custom-select">
                                    <option>-- Pilih Ruang Sidang --</option>
                                    <?php
                                    $sql = "SELECT * FROM ruangsidang";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value=$row[id_ruang]>$row[ruangsidang]</option> ";
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                                    ?>
                                </select>
                            </div>
                            <hr width="10px">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text">Dosen Pembimbing 1</label>
                                </div>
                                <select class="custom-select" name="ProposalDosen1" id="ProposalDosen1" disabled>
                                    <?php
                                    $sql = "SELECT * FROM assign_sk,dosen WHERE assign_sk.assign_dosen = 'pembimbing 1' AND assign_sk.id_dosen = dosen.id_dosen AND assign_sk.nim = '".$_POST['nim']."' ";
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
                                <select name="ProposalDosen2" id="ProposalDosen2" class="custom-select" disabled>
                                    <?php
                                    $sql = "SELECT * FROM assign_sk,dosen WHERE assign_sk.assign_dosen = 'pembimbing 2' AND assign_sk.id_dosen = dosen.id_dosen AND assign_sk.nim = '".$_POST['nim']."' ";
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
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text">Dosen Penguji</label>
                                </div>
                                <select id="ProposalDosenPenguji" name='ProposalDosenPenguji' class="custom-select">
                                <option>-- Pilih Dosen Penguji --</option>
                                    <?php
                                    $sql = "SELECT * FROM assign_sk,dosen WHERE assign_sk.assign_dosen = 'penguji' AND assign_sk.id_dosen = dosen.id_dosen AND assign_sk.nim = '".$_POST['nim']."' ";
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
                        <button type="submit" name="UpdateBeritaAcaraSemhas" class="btn btn-info btn-sm">Update</button>
            </form>
<?php
        }
    }
}

//create new berita acara
if($_POST['nim'] && $_POST['flag'] == 'baru'){
    $sql = "SELECT assign_sk.nim,mahasiswa.nama,semhas.judul_penelitian,assign_sk.id_semester,assign_sk.id_tahunajaran
    FROM assign_sk,mahasiswa,semhas
    WHERE semhas.nim = assign_sk.nim AND mahasiswa.nim = assign_sk.nim AND assign_sk.nim = '".$_POST['nim']."' GROUP BY assign_sk.nim";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
        // output data of each row
        while ($row = $result->fetch_assoc())
        {
?>
            <form method="POST">
                        <div class="form-group">
                                <input class="form-control" name="hiddennim" id="hiddennim" value="<?php echo $_POST['nim'];?>" type="hidden"
                                aria-describedby="nameHelp">
                                <input class="form-control" name="hiddensemester" id="hiddensemester" value="<?php echo $row['id_semester'];?>" type="hidden"
                                aria-describedby="nameHelp">
                                <input class="form-control" name="hiddentahunajaran" id="hiddentahunajaran" value="<?php echo $row['id_tahunajaran'];?>" type="hidden"
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
                                <input class="form-control" name="nim" id="nim" value="<?php echo $_POST['nim'];?>" type="text"
                                aria-describedby="nameHelp" disabled="">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Nama Mahasiswa</label>
                                </div>
                                <input class="form-control" name="nama" id="nama" type="text" value = "<?php echo $row['nama'];?>"
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
                                    <label class="input-group-text">Tanggal Seminar Hasil</label>
                                </div>
                                <input class="form-control" id="date" name="tanggal" placeholder="mm/dd/yyyy" type="text" onchange="bataskti(this.value)"/>
                                <input type="hidden" class="form-control" id="hiddenbatas" name="hiddenbatas"/>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend" data-provide='datetimepicker1'>
                                    <label class="input-group-text">Waktu Seminar Hasil</label>
                                </div>
                                <select id="waktusidang" name="waktusidang" class="custom-select">
                                    <option>-- Pilih Waktu Sidang --</option>
                                    <option>07.00</option>
                                    <option>07.30</option>
                                    <option>08.00</option>
                                    <option>08.30</option>
                                    <option>09.00</option>
                                    <option>09.30</option>
                                    <option>10.00</option>
                                    <option>10.30</option>
                                    <option>11.00</option>
                                    <option>11.30</option>
                                    <option>12.00</option>
                                    <option>12.30</option>
                                    <option>13.00</option>
                                    <option>13.30</option>
                                    <option>14.00</option>
                                    <option>14.30</option>
                                    <option>15.00</option>
                                    <option>15.30</option>
                                    <option>16.00</option>
                                    <option>16.30</option>
                                    <option>17.00</option>
                                    <option>17.30</option>
                                </select>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text">Ruang Sidang</label>
                                </div>
                                <select id="ruangsidang" name="ruangsidang" class="custom-select">
                                    <option>-- Pilih Ruang Sidang --</option>
                                    <?php
                                    $sql = "SELECT * FROM ruangsidang";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value=$row[id_ruang]>$row[ruangsidang]</option> ";
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                                    ?>
                                </select>
                            </div>
                            <hr width="10px">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text">Dosen Pembimbing 1</label>
                                </div>
                                <select class="custom-select" name="ProposalDosen1" id="ProposalDosen1" disabled>
                                    <?php
                                    $sql = "SELECT * FROM assign_sk,dosen WHERE assign_sk.assign_dosen = 'pembimbing 1' AND assign_sk.id_dosen = dosen.id_dosen AND assign_sk.nim = '".$_POST['nim']."' ";
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
                                <select name="ProposalDosen2" id="ProposalDosen2" class="custom-select" disabled>
                                    <?php
                                    $sql = "SELECT * FROM assign_sk,dosen WHERE assign_sk.assign_dosen = 'pembimbing 2' AND assign_sk.id_dosen = dosen.id_dosen AND assign_sk.nim = '".$_POST['nim']."' ";
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
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text">Dosen Penguji</label>
                                </div>
                                <select id="ProposalDosenPenguji" name='ProposalDosenPenguji' class="custom-select">
                                <option>-- Pilih Dosen Penguji --</option>
                                    <?php
                                    $sql = "SELECT * FROM assign_sk,dosen WHERE assign_sk.assign_dosen = 'penguji' AND assign_sk.id_dosen = dosen.id_dosen AND assign_sk.nim = '".$_POST['nim']."' ";
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
                        <button type="submit" name="CreateBeritaAcaraSemhas" class="btn btn-info btn-md ">Simpan</button>
            </form>
<?php
        }
    }
}


//ulang berita acara
if($_POST['nim'] && $_POST['flag'] == 'ulang'){
    $sql = "SELECT assign_sk.nim,mahasiswa.nama,semhas.judul_penelitian,assign_sk.id_semester,assign_sk.id_tahunajaran
    FROM assign_sk,mahasiswa,semhas
    WHERE semhas.nim = assign_sk.nim AND mahasiswa.nim = assign_sk.nim AND assign_sk.nim = '".$_POST['nim']."' GROUP BY assign_sk.nim";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
        // output data of each row
        while ($row = $result->fetch_assoc())
        {
?>
           <form method="POST">
                        <div class="form-group">
                                <input class="form-control" name="hiddennim" id="hiddennim" value="<?php echo $_POST['nim'];?>" type="hidden"
                                aria-describedby="nameHelp">
                                <input class="form-control" name="hiddensemester" id="hiddensemester" value="<?php echo $row['id_semester'];?>" type="hidden"
                                aria-describedby="nameHelp">
                                <input class="form-control" name="hiddentahunajaran" id="hiddentahunajaran" value="<?php echo $row['id_tahunajaran'];?>" type="hidden"
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
                                <input class="form-control" name="nim" id="nim" value="<?php echo $_POST['nim'];?>" type="text"
                                aria-describedby="nameHelp" disabled="">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Nama Mahasiswa</label>
                                </div>
                                <input class="form-control" name="nama" id="nama" type="text" value = "<?php echo $row['nama'];?>"
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
                                    <label class="input-group-text">Tanggal Seminar Hasil</label>
                                </div>
                                <input class="form-control" id="date" name="tanggal" placeholder="mm/dd/yyyy" type="text" onchange="bataskti(this.value)"/>
                                <input type="hidden" class="form-control" id="hiddenbatas" name="hiddenbatas"/>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend" data-provide='datetimepicker1'>
                                    <label class="input-group-text">Waktu Seminar Hasil</label>
                                </div>
                                <select id="waktusidang" name="waktusidang" class="custom-select">
                                    <option>-- Pilih Waktu Sidang --</option>
                                    <option>07.00</option>
                                    <option>07.30</option>
                                    <option>08.00</option>
                                    <option>08.30</option>
                                    <option>09.00</option>
                                    <option>09.30</option>
                                    <option>10.00</option>
                                    <option>10.30</option>
                                    <option>11.00</option>
                                    <option>11.30</option>
                                    <option>12.00</option>
                                    <option>12.30</option>
                                    <option>13.00</option>
                                    <option>13.30</option>
                                    <option>14.00</option>
                                    <option>14.30</option>
                                    <option>15.00</option>
                                    <option>15.30</option>
                                    <option>16.00</option>
                                    <option>16.30</option>
                                    <option>17.00</option>
                                    <option>17.30</option>
                                </select>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text">Ruang Sidang</label>
                                </div>
                                <select id="ruangsidang" name="ruangsidang" class="custom-select">
                                    <option>-- Pilih Ruang Sidang --</option>
                                    <?php
                                    $sql = "SELECT * FROM ruangsidang";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value=$row[id_ruang]>$row[ruangsidang]</option> ";
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                                    ?>
                                </select>
                            </div>
                            <hr width="10px">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text">Dosen Pembimbing 1</label>
                                </div>
                                <select class="custom-select" name="ProposalDosen1" id="ProposalDosen1" disabled>
                                    <?php
                                    $sql = "SELECT * FROM assign_sk,dosen WHERE assign_sk.assign_dosen = 'pembimbing 1' AND assign_sk.id_dosen = dosen.id_dosen AND assign_sk.nim = '".$_POST['nim']."' ";
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
                                <select name="ProposalDosen2" id="ProposalDosen2" class="custom-select" disabled>
                                    <?php
                                    $sql = "SELECT * FROM assign_sk,dosen WHERE assign_sk.assign_dosen = 'pembimbing 2' AND assign_sk.id_dosen = dosen.id_dosen AND assign_sk.nim = '".$_POST['nim']."' ";
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
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text">Dosen Penguji</label>
                                </div>
                                <select id="ProposalDosenPenguji" name='ProposalDosenPenguji' class="custom-select">
                                <option>-- Pilih Dosen Penguji --</option>
                                    <?php
                                    $sql = "SELECT * FROM assign_sk,dosen WHERE assign_sk.assign_dosen = 'penguji' AND assign_sk.id_dosen = dosen.id_dosen AND assign_sk.nim = '".$_POST['nim']."' ";
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
                        <button type="submit" name="UlangBeritaAcaraSemhas" class="btn btn-info btn-md">Simpan</button>
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

<script type="text/javascript">
    function bataskti(val){
        var initial = val.split(/\//).reverse().join('/');
        var oldinitial = val.split(/\//);
        var day = oldinitial[0];
            var x = parseInt(oldinitial[1]); //month
            var month = x + 6;
            if(month > 12)
            {
                var year = parseInt(oldinitial[2]) + 1;
                month -= 12;
            }
            else
            {
                year = oldinitial[2];
            }
            var newdate = day+"/"+month+"/"+year;
            $('#hiddenbatas').val(newdate);
        }
</script>


