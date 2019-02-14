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
                <li class="breadcrumb-item active">Mahasiswa Lulus</li>
            </ol>
        </div>

        <div class="container-fluid">
        <div id="tabel_mahasiswalulus" class="table-responsive"></div>
        </div>
   </div>
</body>
<?php
@include("footer.php");
?>

<script type="text/javascript">
        $(document).ready(function(){
            $.ajax({
            url : 'getmahasiswalulus.php',
            type:'post',
            cache : false,
            success : function(data)
            {
                $('#tabel_mahasiswalulus').html(data);
            }
            });
        });
        </script>