<?php
@include ("dbconnect.php");
require("fpdf/fpdf.php");

$semester = intval($_GET['semester']);
if($semester != NULL){

	$query = "SELECT * FROM assign_sk
	JOIN dosen ON dosen.id_dosen = assign_sk.id_dosen
	JOIN mahasiswa ON mahasiswa.nim = assign_sk.nim
	JOIN semester ON semester.id_semester = $semester
	WHERE assign_sk.id_semester = $semester
	AND assign_sk.assign_dosen != 'penguji'
	";
	$result = mysqli_query($conn,$query);
	foreach ($result as $row) {

		$title1 = "Surat Keputusan";
		$title2 = "Dosen Pembimbing Karya Tulis Ilmiah";
		$title3 = "Fakultas Kedokteran Universitas Kristen Duta Wacana";
		$title4 = "Semester ".$row['semester'];

		$pdf = new FPDF('L','mm','A4');
		$pdf->AddPage();
		$pdf->AddFont('cambria','','cambria.php');
		$pdf->AddFont('cambriab','','cambriab.php');
		$pdf->SetXY(140,10);
		$pdf->SetFont('cambriab','',14);
		$pdf->Cell(30,10,$title1,0,0,'C');
		$pdf->SetXY(140,15);
		$pdf->Cell(30,10,$title2,0,0,'C');
		$pdf->SetXY(140,20);
		$pdf->Cell(30,10,$title3,0,0,'C');
		$pdf->SetXY(140,25);
		$pdf->Cell(30,10,$title4,0,0,'C');

		$cellx1 = 5;
		$celly1 = 40;
		$pdf->SetXY($cellx1,$celly1);
		$pdf->SetFont('cambria','',10);
		$pdf->Cell(7,10,'No',1,0);
		$pdf->Cell(90,10,'Nama Dosen',1,0,'C');
		$pdf->Cell(35,10,'Nim',1,0,'C');
		$pdf->Cell(60,10,'Nama Mahasiswa Bimbingan 1',1,0,'C');
		$pdf->Cell(35,10,'Nim',1,0,'C');
		$pdf->Cell(60,10,'Nama Mahasiswa Bimbingan 2',1,0,'C');

		$cellY = 50;
		$no=1;
		$dosensql = "SELECT * FROM assign_sk
		JOIN mahasiswa ON assign_sk.nim = mahasiswa.nim
		JOIN dosen ON dosen.id_dosen = assign_sk.id_dosen
		WHERE assign_sk.id_semester = '$semester'
		AND assign_sk.assign_dosen != 'penguji'
		ORDER BY assign_sk.id_dosen ASC  ";
		$resdosen1 = mysqli_query($conn,$dosensql);
		foreach ($resdosen1 as $row1) {
			$gelar_depan = $row1['gelar_depan'];
			$nama_dosen = $row1['nama_dosen'];
			$gelar_belakang = $row1['gelar_belakang'];

			$pdf->SetXY(20,$cellY);
			$pdf->SetFont('cambria','',10);
			$pdf->SetXY(5,$cellY);
			$pdf->Cell(7,10,$no,1,0);
			$pdf->Cell(90,10,$gelar_depan.''.$nama_dosen.'.'.$gelar_belakang,1,0,'L');
			if($row1['assign_dosen'] == 'pembimbing 1'){
				$pdf->Cell(35,10,$row1['nim'],1,0,'L');
				$pdf->Cell(60,10,$row1['nama'],1,0,'L');
			}else{
				$pdf->Cell(35,10,"-",1,0,'L');
				$pdf->Cell(60,10,"-",1,0,'L');
			}
			if($row1['assign_dosen'] == 'pembimbing 2'){
				$pdf->Cell(35,10,$row1['nim'],1,0,'L');
				$pdf->Cell(60,10,$row1['nama'],1,0,'L');
			}else{
				$pdf->Cell(35,10,"-",1,0,'L');
				$pdf->Cell(60,10,"-",1,0,'L');
			}
			$cellY +=10;
			$no++;
		}
		$pdf->output();
	}
}

?>