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
                <li class="breadcrumb-item active">Data Dosen</li>
            </ol>
        </div>
        <button type="button" style="margin-top: 0; margin-left: 1%; width:7% border-radius:10px;" class="btn btn-default btn-sm" data-toggle="modal"
        data-target="#inputdatadosen"><img src="icons/contactadd.png" width="30px" height="30px"></button>

        <div id="tabledosen" class="table-responsive">
        </div>

    </div>
</body>
<?php
@include("footer.php");
?>

<!-- insert form -->
<div class="modal fade" id="inputdatadosen" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Input Data Dosen</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form id="formdosen" method="POST">
                       <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputsemester">Nama Dosen</label>
                            </div>
                            <input class="form-control" name="namadosen" id="exampleInputName" type="text"
                            aria-describedby="nameHelp" placeholder="Masukkan Nama Dosen"
                            onkeyup="this.value=this.value.toUpperCase()">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputsemester">Gelar Depan</label>
                            </div>
                            <input class="form-control" name="gelardepan" id="exampleInputLastName" type="text"
                            aria-describedby="nameHelp" placeholder="Masukkan Gelar Depan">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputsemester">Gelar Belakang</label>
                            </div>
                            <input class="form-control" name="gelarbelakang" id="exampleInputLastName" type="text"
                            aria-describedby="nameHelp" placeholder="Masukkan Gelar Belakang">
                        </div>
                    </div>

                    <button type="submit" name="adddata" class="btn btn-info btn-md">SUBMIT</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Edit and Update Modal content Detail-->
<div class="modal fade" id="editModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Data Dosen</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="background-color: #f7ca77">
                <div class="card-body">
                    <form method="POST">
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="iddosen" id="iddosen" type="text"
                            aria-describedby="nameHelp">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="namadosen">Nama Dosen</label>
                                </div>
                                <input class="form-control" name="namadosen" id="namadosen" type="text"
                                aria-describedby="nameHelp" placeholder="Masukkan Nama Dosen" style="text-transform:uppercase"
                                >
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                 <label class="input-group-text" for="exampleInputLastName">Gelar Depan</label>
                             </div>
                             <input class="form-control" name="gelardepan" id="gelardepan" type="text"
                             aria-describedby="nameHelp" placeholder="Masukkan Gelar Depan">
                         </div>
                         <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="exampleInputLastName">Gelar Belakang</label>
                            </div>
                            <input class="form-control" name="gelarbelakang" id="gelarbelakang" type="text"
                            aria-describedby="nameHelp" placeholder="Masukkan Gelar Belakang">
                        </div>
                    </div>
                    <button type="submit" name="updatedata" id="updatedata" class="btn btn-info btn-md" >SUBMIT</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Data Dosen</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="background-color: #c82333">
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data">
                        <input type="hidden" class="form-control" name="hididdosen" id="hididdosen"
                            aria-describedby="nameHelp">
                        <div id="deldosen"></div>
                        <button type="submit" class="btn btn-info btn-sm" data-dismiss="modal" >NO</button>
                        <button type="submit" name="deletedata" class="btn btn-danger btn-sm" >YES</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).on("click", "#editdosen", function () {
        var id_dosen = $(this).data('iddosen');
        var nama_dosen = $(this).data('namadosen');
        var gelar_depan = $(this).data('gelardepan');
        var gelar_belakang = $(this).data('gelarbelakang');

        $('#iddosen').val(id_dosen);
        $('#namadosen').val(nama_dosen);
        $('#gelardepan').val(gelar_depan);
        $('#gelarbelakang').val(gelar_belakang);
    })

    $(document).on("click", "#deletedosen", function () {
        var id_dosen = $(this).data('iddosen');
        var nama_dosen = $(this).data('namadosen');

        $('#hididdosen').val(id_dosen);
    $.ajax({
        url : 'hapusdosen.php',
        type:'post',
        data: "id="+id_dosen,
        cache : false,
        success : function(data)
        {
         $('#deldosen').html(data);
        }
    });
    })

    $(document).ready(function(){
    $.ajax({
        url : 'getdosenall.php',
        type:'post',
        cache : false,
        success : function(data)
        {
         $('#tabledosen').html(data);
        }
    });
 });
</script>



<?php
if (isset($_POST['adddata'])) {
    $sql = "INSERT INTO dosen (nama_dosen,gelar_depan,gelar_belakang) VALUES ('" . $_POST['namadosen'] . "','" . $_POST['gelardepan'] . "','" . $_POST['gelarbelakang'] . "')";
    if (mysqli_query($conn, $sql)) {

    }
}

if (isset($_POST['updatedata'])) {
    $sql = "UPDATE dosen SET nama_dosen =UPPER('$_POST[namadosen]'),gelar_depan='$_POST[gelardepan]',gelar_belakang='$_POST[gelarbelakang]' WHERE id_dosen='$_POST[iddosen]'";
    echo $sql;
    if (mysqli_query($conn, $sql)) {

    }
}

if (isset($_POST['deletedata'])) {
    $sql = "DELETE FROM dosen WHERE id_dosen='$_POST[hididdosen]'";
    if (mysqli_query($conn, $sql)) {

    }
}
?>


