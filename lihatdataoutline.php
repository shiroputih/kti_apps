<?php
@include("header.php");
@include("navigation.php");
@include("dbconnect.php");
/*
    $katakunci1 = "";
    $katakunci2 ="";
    $katakunci3= "";*/
    ?>

    <body class="fixed-nav sticky-footer bg-dark" id="page-top">
        <div class="fixed-nav sticky-footer bg-dark" id="page-top">
            <div class="content-wrapper">
                <div class="container-fluid">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.php">Home</a>
                        </li>
                        <li class="breadcrumb-item active"> Data Outline</li>
                    </ol>
                </div>
                <button type="button" style="margin-top: 0; margin-left: 1%; width:12%" class="btn btn-primary btn-sm" data-toggle="modal"
                data-target="#inputdataoutlineModal"><img src="icons/contactadd.png" width="30px" height="30px"> Tambah Outline </button>
                <button type="button" style="margin-top: 0; margin-left: 1%; width:12%" class="btn btn-primary btn-sm" data-toggle="modal"
                data-target="#uploadoutlinemodal"><img src="icons/upload.jpg" width="30px" height="30px"> Tambah Outline </button>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>NIM</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Judul Outline</th>
                                    <th>Dosen Pembimbing 1</th>
                                    <th>Tgl Pengajuan</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>NIM</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Judul Outline</th>
                                    <th>Dosen Pembimbing 1</th>
                                    <th>Tgl Pengajuan</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                $no=1;
                                $sql = "SELECT * FROM outline JOIN mahasiswa ON mahasiswa.nim = outline.nim LEFT JOIN dosen ON outline.usulan_dosen1 = dosen.id_dosen ORDER BY outline.nim ASC";
                                //$sql = "SELECT mahasiswa.nim, mahasiswa.nama, outline.*, d1.nama_dosen as d1_nama,d1.gelar_depan AS d1_gelardepan,d1.gelar_belakang AS d1_gelarbelakang,d2.nama_dosen,d2.gelar_depan,d2.gelar_belakang, outline.tgl_pengajuan, outline.status FROM outline JOIN dosen AS d1 ON outline.usulan_dosen1 = d1.id_dosen JOIN mahasiswa ON outline.nim = mahasiswa.nim JOIN dosen AS d2 ON outline.usulan_dosen2 = d2.id_dosen";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                // output data of each row
                                    while ($path = $result->fetch_assoc()) {
                                        echo "<tr>
                                        <td>$path[nim]</td>
                                        <td>$path[nama]</td>
                                        <td>$path[judul_outline]</td>
                                        <td>$path[gelar_depan] $path[nama_dosen] $path[gelar_belakang]</td>
                                        <td>$path[tgl_pengajuan]</td>
                                        <td>$path[status]</td>
                                        <td class='center'>
                                        <a id ='Viewoutline' 
                                        data-nimmahasiswa='$path[nim]'
                                        data-namamahasiswa='$path[nama]'  
                                        data-semester='$path[semester]' 
                                        data-toggle='modal' 
                                        data-target='#ViewOutlineModal'>
                                        <button type='button' class='btn btn-info btn-sm'>Detail</button></a>

                                        <a id ='Editoutline' 
                                        data-nimmahasiswa='$path[nim]' 
                                        data-namamahasiswa='$path[nama]'  
                                        data-juduloutline='$path[judul_outline]' 
                                        data-pertanyaan='$path[pertanyaan_penelitian]' 
                                        data-manfaat ='$path[manfaat_penelitian]' 
                                        data-desain ='$path[desain_penelitian]' 
                                        data-sample ='$path[sample_penelitian]' 
                                        data-bebas ='$path[variabel_bebas]' 
                                        data-tergantung ='$path[variabel_tergantung]' 
                                        data-hipotesis ='$path[hipotesis]' 
                                        data-usulandosen1 ='$path[usulan_dosen1]' 
                                        data-usulandosen2 ='$path[usulan_dosen2]'
                                        data-tanggal = '$path[tgl_pengajuan]'
                                        data-toggle='modal' 
                                        data-target='#EditOutlineModal'>
                                        <button type='button' class='btn btn-warning btn-sm'>Edit</button></a>

                                        <a id ='Deleteoutline'
                                        data-idoutline='$path[id_outline]' 
                                        data-nimmahasiswa='$path[nim]' 
                                        data-namamahasiswa='$path[nama]'  
                                        data-juduloutline='$path[judul_outline]' 
                                        data-toggle='modal' 
                                        data-target='#DeleteOutlineModal'>
                                        <button type='button' class='btn btn-danger btn-sm'>Delete</button></a>
                                        </td>
                                        </tr>";
                                        $no+=1;
                                    }
                                } else {

                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
            </div>
        </div>
    </body>

    <?php
    @include("footer.php");
    ?>

    <!-- upload modal -->
    <div class="modal fade" id="uploadoutlinemodal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Upload Outline Mahasisswa</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <form action="uploadoutline.php" method="post" enctype="multipart/form-data" id="uploadfileoutline" >
                            <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputsemester">Semester</label>
                            </div>
                            <select name="semester" class="custom-select" id="inputsemester">
                                <option>--Pilih Semester--</option>
                                <?php
                                $sql = "SELECT * FROM semester";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value=$row[id_semester]>$row[semester]</option>";
                                    }
                                } else {
                                    echo "0 results";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    
                        <input type="file" name="file" />
                        <input type="submit" class="btn btn-primary btn-sm" name="importOutline" value="IMPORT">
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal ADD Data Outline-->
    <div class="modal fade" id="inputdataoutlineModal" tabindex="1" style="overflow-y: auto;" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Input Data Outline</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <form id="formdosen" method="POST">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputsemester">Semester</label>
                                    </div>
                                    <select name="semester" class="custom-select" id="inputsemester">
                                        <option>--Pilih Semester--</option>
                                        <?php
                                        $sql = "SELECT * FROM semester";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<option value=$row[id_semester]>$row[semester]</option>";
                                            }
                                        } else {
                                            echo "0 results";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">NIM</label>
                                </div>

                                <?php
                                $sql = "SELECT nim,nama FROM mahasiswa WHERE NOT EXISTS (SELECT nim FROM outline WHERE mahasiswa.nim = outline.nim)";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    echo "<select name ='nimmahasiswa' class='custom-select' id='inputGroupSelect01'>";
                                    echo "<option>--Pilih Mahasiswa--</option>";
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value=$row[nim]>$row[nama] | $row[nim]</option>";
                                    }
                                } else {
                                    echo "<input type='text' style='background-color:red;'class='form-control' value='Maaf Semua Mahasiswa Sudah Diinputkan'/></input>";
                                }
                                echo "</select>";
                                ?>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text">Judul Penelitian</label>
                                </div>
                                <textarea rows="3" cols="50" name="JudulPenelitian" class="form-control" id="inputGroupNama"
                                aria-describedby="nameHelp" placeholder="Judul Penelitian"
                                onkeyup="this.value=this.value.toUpperCase()"></textarea>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text">Kata Kunci</label>
                                </div>
                                <input type='text' class="form-control" placeholder="Kata Kunci 1" id="katakunci1" name="katakunci1" onkeyup="this.value=this.value.toUpperCase()"/>
                                <input type='text' class="form-control" placeholder="Kata Kunci 2" id="katakunci2" name="katakunci2" onkeyup="this.value=this.value.toUpperCase()"/>
                                <input type='text' class="form-control" placeholder="Kata Kunci 3" id="katakunci3" name="katakunci3" onkeyup="this.value=this.value.toUpperCase()"/>

                                <a href="ViewCheckJudul" id ='checkjudul' data-toggle='modal' data-target='#ViewCheckJudul'>
                                    <button type='button' id = "btncheck" class='btn btn-info btn-sm'>Check Judul</button></a>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text">Pertanyaan Penelitian</label>
                                    </div>
                                    <textarea rows="3" cols="50" class="form-control" name="pertanyaanpenelitian"
                                    id="inputGroupNama" aria-describedby="nameHelp"
                                    placeholder="Pertanyaan Penelitian"
                                    onkeyup="this.value=this.value.toUpperCase()"></textarea>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text">Manfaat Penelitian</label>
                                    </div>
                                    <textarea rows="3" cols="50" class="form-control" name="manfaatpenelitian"
                                    id="inputGroupNama" aria-describedby="nameHelp" placeholder="Manfaat Penelitian"
                                    onkeyup="this.value=this.value.toUpperCase()"></textarea>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text">Desain Penelitian</label>
                                    </div>
                                    <textarea rows="3" cols="50" class="form-control" name="desainpenelitian"
                                    id="inputGroupNama" aria-describedby="nameHelp" placeholder="Desain Penelitian"
                                    onkeyup="this.value=this.value.toUpperCase()"></textarea>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text">Sample Penelitian</label>
                                    </div>
                                    <textarea rows="3" cols="50" class="form-control" name="samplepenelitian"
                                    id="inputGroupNama" aria-describedby="nameHelp" placeholder="Sample Penelitian"
                                    onkeyup="this.value=this.value.toUpperCase()"></textarea>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text">Variabel Bebas</label>
                                    </div>
                                    <textarea rows="3" cols="50" class="form-control" id="inputGroupNama" name="variabelbebas"
                                    aria-describedby="nameHelp" placeholder="Variabel Bebas"
                                    onkeyup="this.value=this.value.toUpperCase()"></textarea>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text">Variabel Tergantung</label>
                                    </div>
                                    <textarea rows="3" cols="50" class="form-control" id="inputGroupNama"
                                    name="variabeltergantung" aria-describedby="nameHelp"
                                    placeholder="Variabel Tergantung"
                                    onkeyup="this.value=this.value.toUpperCase()"></textarea>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text">Hipotesis</label>
                                    </div>
                                    <textarea rows="3" cols="50" class="form-control" id="inputGroupNama" name="hipotesis"
                                    aria-describedby="nameHelp" placeholder="Hipotesis"
                                    onkeyup="this.value=this.value.toUpperCase()"></textarea>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text">Usulan Pembimbing 1</label>
                                    </div>
                                    <select class="custom-select" name="usulandosen1" id="inputsemester">
                                        <option>--Pilih Dosen Pembimbing 1--</option>
                                        <?php
                                        $sql = "SELECT * FROM dosen";
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
                                        <label class="input-group-text">Usulan Pembimbing 2</label>
                                    </div>
                                    <select name="usulandosen2" class="custom-select">
                                        <option>--Pilih Dosen Pembimbing 2--</option>
                                        <?php
                                        $sql = "SELECT * FROM dosen";
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
                                    <div class="input-group-prepend" data-provide='datetimepicker1'>
                                        <label class="input-group-text">Tanggal Pengajuan</label>
                                    </div>
                                    <input type='text' class="form-control" id="date" name="tanggal" placeholder="MM/DD/YYY"/>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend" data-provide='datetimepicker1'>
                                        <label class="input-group-text">Status</label>
                                    </div>
                                    <input type='text' class="form-control" id="verified" name="status"
                                    value="NULL" disabled/>
                                </div>
                                <button type="submit" name="AddDataOutline" class="btn btn-info btn-sm" >Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- view modal outline -->
        <div class="modal fade" id="ViewOutlineModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Detail Data Outline</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body" id="detailoutline">
                        <div class="outline-data"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- End of -->

        <!-- view check judul outline -->
        <div class="modal fade" id="ViewCheckJudul" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Judul yang Terdeteksi</h4>
                        <button type="button" class="close" id="closeModal"  data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body" id="detailoutline">
                        <div class="data-checkjudul">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- End of -->
        <!-- Modal Edit outline -->
        <div class="modal fade" id="EditOutlineModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Data Outline</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body" style="background-color: #f7ca77">
                        <div class="card-body"> 
                            <form id="formdosen" method="POST">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="hiddennim" id="hiddennim" type="text"
                                    aria-describedby="nameHelp">
                                    <input type="hidden" class="form-control" name="hiddenJudul" id="hiddenJudul" type="text"
                                    aria-describedby="nameHelp">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="inputGroupSelect01">NIM</label>
                                        </div>
                                        <input class="form-control" name="EditNim" id="EditNim" type="text"
                                        aria-describedby="nameHelp" disabled="">
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="inputGroupSelect01">Nama Mahasiswa</label>
                                        </div>
                                        <input class="form-control" name="EditNama" id="EditNama" type="text"
                                        aria-describedby="nameHelp" disabled="">
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text">Judul Penelitian</label>
                                        </div>
                                        <textarea rows="3" cols="50" name="EditJudul" class="form-control" id="EditJudul"
                                        aria-describedby="nameHelp"
                                        onkeyup="this.value=this.value.toUpperCase()"></textarea>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text">Pertanyaan Penelitian</label>
                                        </div>
                                        <textarea rows="3" cols="50" class="form-control" name="EditPertanyaan"
                                        id="EditPertanyaan" aria-describedby="nameHelp"
                                        placeholder="Pertanyaan Penelitian"
                                        onkeyup="this.value=this.value.toUpperCase()"></textarea>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text">Manfaat Penelitian</label>
                                        </div>
                                        <textarea rows="3" cols="50" class="form-control" name="EditManfaat"
                                        id="EditManfaat" aria-describedby="nameHelp"
                                        placeholder="Manfaat Penelitian"
                                        onkeyup="this.value=this.value.toUpperCase()"></textarea>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text">Desain Penelitian</label>
                                        </div>
                                        <textarea rows="3" cols="50" class="form-control" name="EditDesain" id="EditDesain"
                                        aria-describedby="nameHelp" placeholder="Desain Penelitian"
                                        onkeyup="this.value=this.value.toUpperCase()"></textarea>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text">Sample Penelitian</label>
                                        </div>
                                        <textarea rows="3" cols="50" class="form-control" name="EditSample" id="EditSample"
                                        aria-describedby="nameHelp" placeholder="Sample Penelitian"
                                        onkeyup="this.value=this.value.toUpperCase()"></textarea>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text">Variabel Bebas</label>
                                        </div>
                                        <textarea rows="3" cols="50" class="form-control" id="EditBebas" name="EditBebas"
                                        aria-describedby="nameHelp" placeholder="Variabel Bebas"
                                        onkeyup="this.value=this.value.toUpperCase()"></textarea>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text">Variabel Tergantung</label>
                                        </div>
                                        <textarea rows="3" cols="50" class="form-control" id="EditTergantung"
                                        name="EditTergantung" aria-describedby="nameHelp"
                                        placeholder="Variabel Tergantung"
                                        onkeyup="this.value=this.value.toUpperCase()"></textarea>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text">Hipotesis</label>
                                        </div>
                                        <textarea rows="3" cols="50" class="form-control" id="EditHipotesis"
                                        name="EditHipotesis" aria-describedby="nameHelp" placeholder="Hipotesis"
                                        onkeyup="this.value=this.value.toUpperCase()"></textarea>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text">Usulan Pembimbing 1</label>
                                        </div>
                                        <select class="custom-select" name="EditDosen1" id="EditDosen1">
                                            <?php
                                            $sql = "SELECT * FROM dosen";
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
                                            <label class="input-group-text">Usulan Pembimbing 2</label>
                                        </div>
                                        <select name="EditDosen2" id="EditDosen2" class="custom-select">
                                            <?php
                                            $sql = "SELECT * FROM dosen";
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
                                        <div class="input-group-prepend" data-provide='datetimepicker1'>
                                            <label class="input-group-text">Tanggal Pengajuan</label>
                                        </div>
                                        <input type='text' class="form-control" id="EditTanggal" name="EditTanggal"
                                        placeholder="MM/DD/YYY" disabled/>
                                    </div>
                                    <button type="submit" name="EditDataOutline" class="btn btn-info btn-lg" >SUBMIT</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal  Delete outline-->
        <div class="modal fade" id="DeleteOutlineModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Data Outline</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body" style="background-color: #c82333">
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data">
                                <label>Apakah anda ingin menghapus data outline</label> <br>
                                <input type="hidden" id="hpsid" name="hpsid" class="form-control"></input><br>
                                <input type="hidden" id="hpsnim" name="hpsnim" class="form-control"></input><br>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text">NIM</label>
                                    </div>
                                    <input id="deletenim" name="deletenim" class="form-control" disabled></input>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text">NIM</label>
                                    </div>
                                    <input id="deletenama" class="form-control" disabled></input>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text">Judul Outline</label>
                                    </div>
                                    <input id="deletejudul" class="form-control" disabled></input>
                                </div>
                                <button type="submit" class="btn btn-info btn-lg" data-dismiss="modal">NO</button>
                                <button type="submit" name="DeleteDataOutline" class="btn btn-danger btn-lg">YES</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Javascript , ajax, jquery run here -->
        <script type="text/javascript">
            $(document).ready(function(){
                $('#closeModal').click(function(){
                    $('#inputdataoutlineModal').modal('show');
                });

                $('#btncheck').click(function(){
                    $('#inputdataoutlineModal').modal('hide');
                });
            });
        </script>
        <!-- datepicker -->
        <script>
            $(document).ready(function () {
                var date_input = $('input[name="tanggal"]');
                var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
                var options = {
                    format: 'dd/mm/yyyy',
                    orientation: 'bottom',
                    todayHighlight: true,
                    autoclose: true,
                };
                date_input.datepicker(options);
            })
        </script>

        <!-- Show Check Judul -->
        <script type="text/javascript">
            $(document).ready(function(){
                $(document).on("click", "#checkjudul", function () {
                    var kk1 = document.getElementById('katakunci1').value;
                    var kk2 = document.getElementById('katakunci2').value;
                    var kk3 = document.getElementById('katakunci3').value;
                    $('#inputdataoutlineModal').modal('hide');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : 'checkjudul.php',
                data :  "kk1="+kk1+"&kk2="+kk2+"&kk3="+kk3,
                success : function(data){
                $('.data-checkjudul').html(data);//menampilkan data ke dalam modal
            }

        });
        });
            });
        </script> 

        <!-- Show Detail Mahasiswa -->
        <script type="text/javascript">
            $(document).ready(function(){
                $('#ViewOutlineModal').on('show.bs.modal', function (e) {
                    var nim = $(e.relatedTarget).data('nimmahasiswa');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : 'detailoutline.php',
                data :  'nim='+ nim,
                success : function(data){
                $('.outline-data').html(data);//menampilkan data ke dalam modal
            }
        });
        });
            });
        </script> 
        <!-- edit outline -->
        <script type="text/javascript">
            $(document).on("click", "#Editoutline", function () {
                var NIM = $(this).data('nimmahasiswa');
                var nama_mahasiswa = $(this).data('namamahasiswa');
                var juduloutline = $(this).data('juduloutline');
                var pertanyaan = $(this).data('pertanyaan');
                var manfaat = $(this).data('manfaat');
                var desain = $(this).data('desain');
                var sample = $(this).data('sample');
                var bebas = $(this).data('bebas');
                var tergantung = $(this).data('tergantung');
                var hipotesis = $(this).data('hipotesis');
                var udosen1 = $(this).data('usulandosen1');
                var udosen2 = $(this).data('usulandosen2');
                var tanggal = $(this).data('tanggal');

                $('#EditNim').val(NIM);
                $('#hiddennim').val(NIM);
                $('#EditNama').val(nama_mahasiswa);
                $('#EditJudul').val(juduloutline);
                $('#hiddenJudul').val(juduloutline);
                $('#EditPertanyaan').val(pertanyaan);
                $('#EditManfaat').val(manfaat);
                $('#EditDesain').val(desain);
                $('#EditSample').val(sample);
                $('#EditBebas').val(bebas);
                $('#EditTergantung').val(tergantung);
                $('#EditHipotesis').val(hipotesis);
                $('#EditDosen1').val(udosen1);
                $('#EditDosen2').val(udosen2);
                $('#EditTanggal').val(tanggal);
            })
        </script>

        <!-- delete outline -->
        <script type="text/javascript">
            $(document).on("click", "#Deleteoutline", function () {
                var idoutline =  $(this).data('idoutline');
                var NIM = $(this).data('nimmahasiswa');
                var nama = $(this).data('namamahasiswa');
                var judul = $(this).data('juduloutline');

                $('#deletenim').val(NIM);
                $('#hpsid').val(idoutline);
                $('#hpsnim').val(NIM);
                $('#deletenama').val(nama);
                $('#deletejudul').val(judul);
            })
        </script>

        <?php
        if (isset($_POST['AddDataOutline'])) {
            $sql = "INSERT INTO outline (nim,judul_outline,pertanyaan_penelitian,manfaat_penelitian,desain_penelitian,sample_penelitian,variabel_bebas,variabel_tergantung,hipotesis ,usulan_dosen1,usulan_dosen2 ,tgl_pengajuan,status,semester,kk1,kk2,kk3) VALUES ('" . $_POST['nimmahasiswa'] . "','" . $_POST['JudulPenelitian'] . "','" . $_POST['pertanyaanpenelitian'] . "','" . $_POST['manfaatpenelitian'] . "','" . $_POST['desainpenelitian'] . "','" . $_POST['samplepenelitian'] . "','" . $_POST['variabelbebas'] . "','" . $_POST['variabeltergantung'] . "','" . $_POST['hipotesis'] . "','" . $_POST['usulandosen1'] . "','" . $_POST['usulandosen2'] . "','" . $_POST['tanggal'] . "','','".$_POST['semester']."','".$_POST['katakunci1']."','".$_POST['katakunci2']."','".$_POST['katakunci3']."')";  
            if (mysqli_query($conn, $sql)) {
                echo "<meta http-equiv='refresh' content='0'>";
            }
        }

        if (isset($_POST['EditDataOutline'])) {
            $sql = "UPDATE outline SET
            judul_outline = '$_POST[EditJudul]',
            pertanyaan_penelitian = '$_POST[EditPertanyaan]',
            manfaat_penelitian = '$_POST[EditManfaat]',
            desain_penelitian = '$_POST[EditDesain]',
            sample_penelitian = '$_POST[EditSample]',
            variabel_bebas = '$_POST[EditBebas]',
            variabel_tergantung = '$_POST[EditTergantung]',
            hipotesis = '$_POST[EditHipotesis]',
            usulan_dosen1 = '$_POST[EditDosen1]',
            usulan_dosen2 = '$_POST[EditDosen2]'
            WHERE nim = '$_POST[hiddennim]'";
            if (mysqli_query($conn, $sql)) {
             echo "<meta http-equiv='refresh' content='0'>";
         }

         $sqlupdateproposal = "UPDATE proposal SET judulproposal = '$_POST[EditJudul]' WHERE proposal.nim = '$_POST[hiddennim]'";
         if (mysqli_query($conn, $sqlupdateproposal)) {
            echo "<meta http-equiv='refresh' content='0'>";
        }

        $sqlupdatesemhas = "UPDATE semhas SET judulKTI = '$_POST[EditJudul]' WHERE semhas.nim = '$_POST[hiddennim]'";
        if (mysqli_query($conn, $sqlupdatesemhas)) {
            echo "<meta http-equiv='refresh' content='0'>";
        }

        $sqlupdatekti = "UPDATE kti SET judulkti = '$_POST[EditJudul]' WHERE kti.nim = '$_POST[hiddennim]'";
        if (mysqli_query($conn, $sqlupdatekti)) {
            echo "<meta http-equiv='refresh' content='0'>";
        }

    }

    if (isset($_POST['DeleteDataOutline'])) {
        $sql = "DELETE FROM outline WHERE id_outline='$_POST[hpsid]'";
        if (mysqli_query($conn, $sql)) {
            echo "<meta http-equiv='refresh' content='0'>";
        }
    }

    ?>

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