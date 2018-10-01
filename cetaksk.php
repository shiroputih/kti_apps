
<?php
@include ("dbconnect.php");
require("fpdf/fpdf.php");

if($_POST['semester']){
	$query = "SELECT * FROM sk1,sk2,semester
                WHERE sk1.id_semester = '".$_POST['semester']."' AND sk2.id_semester = '".$_POST['semester']."' AND semester.id_semester= '".$_POST['semester']."'";
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

		$cellx1 = 20;
		$celly1 = 40;
		$pdf->SetXY($cellx1,$celly1);
		$pdf->SetFont('cambria','',10);
		$pdf->Cell(10,10,'No',1,0);
		$pdf->Cell(120,10,'Nama Dosen',1,0,'C');
		$pdf->Cell(65,10,'Nim Mahasiswa Bimbingan 1',1,0,'C');
		$pdf->Cell(65,10,'Nama Mahasiswa Bimbingan 1',1,0,'C');

		$cellY = 50;
		$no=1;
		$dosensql = "SELECT * FROM sk1,dosen,mahasiswa where sk1.id_dosen1 = dosen.id_dosen AND mahasiswa.nim = sk1.nim AND sk1.id_semester = '".$_POST['semester']."' GROUP BY sk1.id_dosen1";
		$resdosen1 = mysqli_query($conn,$dosensql);
		foreach ($resdosen1 as $row1) { 
			$gelar_depan = $row1['gelar_depan'];
			$nama_dosen = $row1['nama_dosen'];
			$gelar_belakang = $row1['gelar_belakang'];

			$pdf->SetXY(20,$cellY);
			$pdf->SetFont('cambria','',10);
			$pdf->SetXY(20,$cellY);
			$pdf->Cell(10,10,$no,1,0);
			$pdf->Cell(120,10,$gelar_depan.''.$nama_dosen.'.'.$gelar_belakang,1,0,'C');
			$pdf->Cell(65,10,$row1['nim'],1,0,'L');
			$pdf->Cell(65,10,$row1['nama'],1,0,'L');
			$cellY +=10;
			$no++;
		}
		$cellY = $cellY;

		$celly2 = $cellY+10;
		$pdf->SetXY($cellx1,$celly2);
		$pdf->SetFont('cambria','',10);
		$pdf->Cell(10,10,'No',1,0);
		$pdf->Cell(120,10,'Nama Dosen',1,0,'C');
		$pdf->Cell(65,10,'Nim Mahasiswa Bimbingan 2',1,0,'C');
		$pdf->Cell(65,10,'Nama Mahasiswa Bimbingan 2',1,0,'C');

		$cellY = $celly2+10;
		$no=1;
		$dosensql = "SELECT * FROM sk2,dosen,mahasiswa where sk2.id_dosen2 = dosen.id_dosen AND mahasiswa.nim = sk2.nim AND sk2.id_semester = '".$_POST['semester']."' GROUP BY sk2.id_dosen2";
		$resdosen1 = mysqli_query($conn,$dosensql);
		foreach ($resdosen1 as $row1) { 
			$gelar_depan = $row1['gelar_depan'];
			$nama_dosen = $row1['nama_dosen'];
			$gelar_belakang = $row1['gelar_belakang'];

			$pdf->SetXY(20,$cellY);
			$pdf->SetFont('cambria','',10);
			$pdf->SetXY(20,$cellY);
			$pdf->Cell(10,10,$no,1,0);
			$pdf->Cell(120,10,$gelar_depan.''.$nama_dosen.'.'.$gelar_belakang,1,0,'C');
			$pdf->Cell(65,10,$row1['nim'],1,0,'L');
			$pdf->Cell(65,10,$row1['nama'],1,0,'L');
			$cellY +=10;
			$no++;
		}
		
		$pdf->output();
	}
}

?>