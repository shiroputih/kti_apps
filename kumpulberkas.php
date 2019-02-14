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
				<li class="breadcrumb-item active"> Kumpul Berkas Karya Tulis Ilmiah</li>
			</ol>
		</div>
			<div class = "tabelkti" class="table-responsive"></div>
	</div>
</body>

<?php
@include("footer.php");
?>

<script type="text/javascript">

$(document).ready(function()
{
    $.ajax({
        url : 'getkumpulberkas.php',
        type:'post',
        cache : false,
        success : function(data)
        {
            $('.tabelkti').html(data);
        }
    });
});
</script>

<?php
//upload publikasi
if (isset($_POST['uploadpublikasi'])) {
	$nim = $_POST['hiddenpublikasinim'];

	$nama_file = $_FILES['pdf_publikasi']['name'];
	$ukuran = $_FILES['pdf_publikasi']['size'];

	$uploaddir = './uploadPublikasi/';
	$alamatfile = $uploaddir . $nama_file;
	if (move_uploaded_file($_FILES['pdf_publikasi']['tmp_name'], $alamatfile));
	{
		$sql_uploadpublikasi = "UPDATE kumpul_berkas SET file_publikasi = '$alamatfile' WHERE kumpul_berkas.nim = '$nim'";
		if (mysqli_query($conn, $sql_uploadpublikasi)) {

		}
	}
}

//upload naskahkti
if (isset($_POST['uploadnaskahkti'])) {
	$nim = $_POST['hiddennaskahktinim'];

	$nama_file = $_FILES['pdf_naskahkti']['name'];
	$ukuran = $_FILES['pdf_naskahkti']['size'];

	$uploaddir = './uploadNaskahKTI/';
	$alamatfile = $uploaddir . $nama_file;
	if (move_uploaded_file($_FILES['pdf_naskahkti']['tmp_name'], $alamatfile));
	{
		$sql_uploadpublikasi = "UPDATE kumpul_berkas SET file_naskahkti = '$alamatfile' WHERE kumpul_berkas.nim = '$nim'";
		if (mysqli_query($conn, $sql_uploadpublikasi)) {

		}
	}
}

//upload penerimaan berkas
if (isset($_POST['uploadberkas'])) {
	$nim = $_POST['hiddenberkasnim'];

	$nama_file = $_FILES['pdf_berkas']['name'];
	$ukuran = $_FILES['pdf_berkas']['size'];

	$uploaddir = './uploadPenerimaanBerkas/';
	$alamatfile = $uploaddir . $nama_file;
	if (move_uploaded_file($_FILES['pdf_berkas']['tmp_name'], $alamatfile));
	{
		$sql_uploadpublikasi = "UPDATE kumpul_berkas SET file_scanpenerimaanberkas = '$alamatfile' WHERE kumpul_berkas.nim = '$nim'";
		if (mysqli_query($conn, $sql_uploadpublikasi)) {

		}
	}
}

//update tanggal kumpul dan semester
if (isset($_POST['createberitaacarapenerimaanberkas'])) {
	$sql_updateberkas = "UPDATE kumpul_berkas SET
    tgl_kumpulberkas = '$_POST[tanggal]',
    id_semester = '$_POST[semester]'
    WHERE kumpul_berkas.nim = '$_POST[hiddennimberkas]'";
	if (mysqli_query($conn, $sql_updateberkas)) {

	}

}
?>