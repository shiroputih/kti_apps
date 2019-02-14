<?php
@include ("dbconnect.php");
require("fpdf/fpdf.php");

if($_POST['nim']){
	$query = "SELECT * FROM proposal,ruangsidang,mahasiswa
                WHERE proposal.nim = mahasiswa.nim AND proposal.id_ruangsidang = ruangsidang.id_ruang AND proposal.status_proposal IS NULL AND proposal.nim = '".$_POST['nim']."'";
	$result = mysqli_query($conn,$query);
	foreach ($result as $row) { 

		$title1 = "Berita Acara";
		$title2 = "SEMINAR PROPOSAL KARYA TULIS ILMIAH SARJANA / SKRIPSI";
		$title3 = "Fakultas Kedokteran Universitas Kristen Duta Wacana";
		$nim = $row['nim'];
		$nama = $row['nama'];
		$tgl = $row['tgl_sidangproposal'];
		$jam = $row['waktupelaksanaan'];
		$tempat = $row['ruangsidang'];
		$judul = $row['judulproposal'];
		
		$pdf = new FPDF('P','mm','A4');
		$pdf->AddPage();
		$pdf->AddFont('cambria','','cambria.php');
		$pdf->AddFont('cambriab','','cambriab.php');
		$pdf->SetXY(90,10);
		$pdf->SetFont('cambriab','',14);
		$pdf->Cell(30,10,$title1,0,0,'C');
		$pdf->SetXY(90,15);
		$pdf->Cell(30,10,$title2,0,0,'C');
		$pdf->SetXY(90,20);
		$pdf->Cell(30,10,$title3,0,0,'C');

		$pdf->SetXY(20,35);
		$pdf->SetFont('cambria','',10);
		$pdf->Cell(45,10,'Tanggal',0,0);
		$pdf->Cell(5,10,':',0,0,'R');
		$pdf->Cell(120,8,$tgl,1,0);

		$pdf->SetXY(20,45);
		$pdf->SetFont('cambria','',10);
		$pdf->Cell(45,10,'Jam',0,0);
		$pdf->Cell(5,10,':',0,0,'R');
		$pdf->Cell(120,8,$jam.'WIB',1,0);

		$pdf->SetXY(20,55);
		$pdf->SetFont('cambria','',10);
		$pdf->Cell(45,10,'Tempat',0,0);
		$pdf->Cell(5,10,':',0,0,'R');
		$pdf->Cell(120,8,$tempat,1,0);

		$pdf->SetXY(20,70);
		$pdf->SetFont('cambria','',10);
		$pdf->Cell(45,10,'NIM',0,0);
		$pdf->Cell(5,10,':',0,0,'R');
		$pdf->Cell(120,8,$nim,1,0);

		$pdf->SetXY(20,80);
		$pdf->SetFont('cambria','',10);
		$pdf->Cell(45,10,'Nama',0,0);
		$pdf->Cell(5,10,':',0,0,'R');
		$pdf->Cell(120,8,$nama,1,0);

		$pdf->SetXY(20,90);
		$pdf->SetFont('cambria','',10);
		$pdf->MultiCell(45,5,'Judul Karya Tulis Ilmiah (Bahasa Indonesia)',0);
		$pdf->SetXY(65,90);
		$pdf->SetFont('cambria','',10);
		$pdf->Cell(5,10,':',0,0,'R');
		$pdf->MultiCell(120,5,$judul,0);
		$pdf->SetXY(70,90);
		$pdf->Cell(120,28,'',1,0);

		$pdf->SetXY(20,120);
		$pdf->SetFont('cambria','',10);
		$pdf->MultiCell(45,5,'Judul Karya Tulis Ilmiah (Bahasa Inggris)',0);
		$pdf->SetXY(65,120);
		$pdf->SetFont('cambria','',10);
		$pdf->Cell(5,10,':',0,0,'R');
		$pdf->Cell(120,28,' ',1,0);

		$pdf->ln(10);
		$pdf->SetXY(20, 150);
		$pdf->Cell(30,5,"Dosen Penguji",1,0,'C');
		$pdf->Cell(110,5,"Nama Dosen Penguji",1,0,'C');
		$pdf->Cell(30,5,"Tanda Tangan",1,0,'C');
		
		$dosensql = "SELECT * FROM  assign_sk,dosen WHERE assign_sk.nim = '".$_POST['nim']."' AND assign_sk.id_dosen = dosen.id_dosen
		AND assign_sk.assign_dosen = 'pembimbing 1'";
		$resdosen1 = mysqli_query($conn,$dosensql);
		foreach ($resdosen1 as $row1) { 
			$gelar_depan = $row1['gelar_depan'];
			$nama_dosen = $row1['nama_dosen'];
			$gelar_belakang = $row1['gelar_belakang'];

			$pdf->SetXY(20, 155);
			$pdf->Cell(30,10,"Penguji 1",1,0,'C');
			$pdf->Cell(110,10,$gelar_depan.''.$nama_dosen.'.'.$gelar_belakang,1,0,'L');
			$pdf->Cell(30,10,"",1,0,'C');
		}

		$dosensql2 = "SELECT * FROM  assign_sk,dosen WHERE assign_sk.nim = '".$_POST['nim']."' AND assign_sk.id_dosen = dosen.id_dosen AND assign_sk.assign_dosen = 'pembimbing 2'";
		$resdosen2 = mysqli_query($conn,$dosensql2);
		foreach ($resdosen2 as $row2) { 
			$gelar_depan = $row2['gelar_depan'];
			$nama_dosen = $row2['nama_dosen'];
			$gelar_belakang = $row2['gelar_belakang'];
		
			$pdf->SetXY(20, 165);
			$pdf->Cell(30,10,"Penguji 2",1,0,'C');
			$pdf->Cell(110,10,$gelar_depan.''.$nama_dosen.'.'.$gelar_belakang,1,0,'L');
			$pdf->Cell(30,10,"",1,0,'C');
		}

		$dosensql3 = "SELECT * FROM  assign_sk,dosen WHERE assign_sk.nim = '".$_POST['nim']."' AND assign_sk.id_dosen = dosen.id_dosen AND assign_sk.assign_dosen = 'penguji'";
		$resdosen3 = mysqli_query($conn,$dosensql3);
		foreach ($resdosen3 as $row3) { 
			$gelar_depan = $row3['gelar_depan'];
			$nama_dosen = $row3['nama_dosen'];
			$gelar_belakang = $row3['gelar_belakang'];
			$pdf->SetXY(20, 175);
			$pdf->SetFont('cambria','',10);
			$pdf->Cell(30,10,"Penguji 3",1,0,'C');
			$pdf->Cell(110,10,$gelar_depan.''.$nama_dosen.'.'.$gelar_belakang,1,0,'L');
			$pdf->Cell(30,10,"",1,0,'C');
		}
		$pdf->ln(10);
		$pdf->SetXY(20, 190);
		$pdf->Cell(5,5,"",1,0,'C');
		$pdf->SetXY(25, 190);
		$pdf->Cell(25,5,"Dapat Melanjutkan",0,0,'L');
		$pdf->SetXY(65, 190);
		$pdf->Cell(5,5,"",1,0,'C');
		$pdf->SetXY(70, 190);
		$pdf->Cell(35,5,"Dapat Melanjutkan dengan Revisi",0,0,'L');
		$pdf->SetXY(135, 190);
		$pdf->Cell(5,5,"",1,0,'C');
		$pdf->SetXY(140, 190);
		$pdf->Cell(35,5,"Tidak Dapat Melanjutkan",0,0,'L');

		$pdf->SetXY(20, 205);
		$pdf->Cell(35,5,"Catatan :",1,0,'C');
		$pdf->SetXY(20, 210);
		$pdf->Cell(170,60,"",1,0,'C');

		$pdf->AddPage();
		$pdf->SetXY(90,10);
		$pdf->AddFont('cambria','','cambria.php');
		$pdf->AddFont('cambriab','','cambriab.php');
		$pdf->SetFont('cambriab','',14);
		$pdf->Cell(30,10,"Daftar Hadir",0,0,'C');
		$pdf->SetXY(90,15);
		$pdf->Cell(30,10,$title2,0,0,'C');
		$pdf->SetXY(90,20);
		$pdf->Cell(30,10,$title3,0,0,'C');

		$pdf->SetXY(20, 35);
		$pdf->SetFont('cambria','',10);
		$pdf->Cell(15,10,"No",1,0,'C');
		$pdf->Cell(115,10,"Nama",1,0,'C');
		$pdf->Cell(40,10,"Tanda Tangan",1,0,'C');
		
		$dosensql = "SELECT * FROM  assign_sk,dosen WHERE assign_sk.nim = '".$_POST['nim']."' AND assign_sk.id_dosen = dosen.id_dosen
		AND assign_sk.assign_dosen = 'pembimbing 1'";
		$resdosen1 = mysqli_query($conn,$dosensql);
		foreach ($resdosen1 as $row1) { 
			$gelar_depan = $row1['gelar_depan'];
			$nama_dosen = $row1['nama_dosen'];
			$gelar_belakang = $row1['gelar_belakang'];
			$pdf->SetXY(20, 45);
			$pdf->SetFont('cambria','',10);
			$pdf->Cell(15,10,"1",1,0,'C');
			$pdf->Cell(115,10,$gelar_depan.''.$nama_dosen.'.'.$gelar_belakang,1,0,'L');
			$pdf->Cell(40,10,"",1,0,'C');
		}
		$dosensql2 = "SELECT * FROM  assign_sk,dosen WHERE assign_sk.nim = '".$_POST['nim']."' AND assign_sk.id_dosen = dosen.id_dosen AND assign_sk.assign_dosen = 'pembimbing 2'";
		$resdosen2 = mysqli_query($conn,$dosensql2);
		foreach ($resdosen2 as $row2) { 
			$gelar_depan = $row2['gelar_depan'];
			$nama_dosen = $row2['nama_dosen'];
			$gelar_belakang = $row2['gelar_belakang'];
		
			$pdf->SetXY(20, 55);
			$pdf->SetFont('cambria','',10);
			$pdf->Cell(15,10,"2",1,0,'C');
			$pdf->Cell(115,10,$gelar_depan.''.$nama_dosen.'.'.$gelar_belakang,1,0,'L');
			$pdf->Cell(40,10,"",1,0,'C');
		}
		$dosensql3 = "SELECT * FROM  assign_sk,dosen WHERE assign_sk.nim = '".$_POST['nim']."' AND assign_sk.id_dosen = dosen.id_dosen AND assign_sk.assign_dosen = 'penguji'";
		$resdosen3 = mysqli_query($conn,$dosensql3);
		foreach ($resdosen3 as $row3) { 
			$gelar_depan = $row3['gelar_depan'];
			$nama_dosen = $row3['nama_dosen'];
			$gelar_belakang = $row3['gelar_belakang'];
			$pdf->SetXY(20, 65);
			$pdf->SetFont('cambria','',10);
			$pdf->Cell(15,10,"3",1,0,'C');
			$pdf->Cell(115,10,$gelar_depan.''.$nama_dosen.'.'.$gelar_belakang,1,0,'L');
			$pdf->Cell(40,10,"",1,0,'C');
		}
		$pdf->SetXY(20, 75);
		$pdf->Cell(15,10,"4",1,0,'C');
		$pdf->Cell(115,10,$nama,1,0,'L');
		$pdf->Cell(40,10,"",1,0,'C');
		$pdf->SetXY(20, 85);
		$pdf->Cell(15,10,"5",1,0,'C');
		$pdf->Cell(115,10,"",1,0,'C');
		$pdf->Cell(40,10,"",1,0,'C');
		$pdf->SetXY(20, 95);
		$pdf->Cell(15,10,"6",1,0,'C');
		$pdf->Cell(115,10,"",1,0,'C');
		$pdf->Cell(40,10,"",1,0,'C');
		$pdf->SetXY(20, 105);
		$pdf->Cell(15,10,"7",1,0,'C');
		$pdf->Cell(115,10,"",1,0,'C');
		$pdf->Cell(40,10,"",1,0,'C');
		$pdf->SetXY(20, 115);
		$pdf->Cell(15,10,"8",1,0,'C');
		$pdf->Cell(115,10,"",1,0,'C');
		$pdf->Cell(40,10,"",1,0,'C');
		$pdf->SetXY(20, 125);
		$pdf->Cell(15,10,"9",1,0,'C');
		$pdf->Cell(115,10,"",1,0,'C');
		$pdf->Cell(40,10,"",1,0,'C');
		$pdf->SetXY(20, 135);
		$pdf->Cell(15,10,"10",1,0,'C');
		$pdf->Cell(115,10,"",1,0,'C');
		$pdf->Cell(40,10,"",1,0,'C');

		$pdf->output();
	}
}

?>