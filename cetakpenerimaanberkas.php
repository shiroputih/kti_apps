<?php
@include ("dbconnect.php");
require("fpdf/fpdf.php");

if($_POST['nim']){
	$query = "SELECT * FROM kti
    JOIN mahasiswa ON mahasiswa.nim = kti.nim
    JOIN kumpul_berkas ON kumpul_berkas.nim = kti.nim
    JOIN assign_sk ON assign_sk.nim = kti.nim
    JOIN dosen ON dosen.id_dosen = assign_sk.id_dosen
    WHERE kti.nim = '".$_POST['nim']."'";
	$result = mysqli_query($conn,$query);
	foreach ($result as $row) {

		$title1 = "BUKTI PENERIMAAN";
		$title2 = "BERKAS KARYA TULIS ILMIAH";
		$title3 = "Fakultas Kedokteran Universitas Kristen Duta Wacana";
		$nim = $row['nim'];
		$nama = $row['nama'];
		$date = $row['tgl_kumpulberkas'];

		$BulanIndo = array("0","Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$tahun = substr($date, 6);
		$bulan = substr($date, 3,2);
		$tgl   = substr($date, 0, 2);
		$tgl_textformat =$tgl . " ".$BulanIndo[$bulan]." ".$tahun;
		$judul = $row['judul_penelitian'];

        $pdf = new FPDF('P','mm','A4');
        $pdf->AddPage();
		$pdf->SetXY(20,20);
		$pdf->Image('fpdf/logo.png',20,10,18,20);
		$pdf->SetXY(40,7);
		$pdf->SetFont('times','',10);
		$pdf->Cell(30,10,"UNIVERSITAS KRISTEN DUTA WACANA",0,0,'L');
		$pdf->SetXY(40,12);
		$pdf->SetFont('times','B',12);
		$pdf->Cell(30,10,"FAKULTAS KEDOKTERAN",0,0,'L');
		$pdf->SetXY(40,17);
		$pdf->SetFont('times','',10);
		$pdf->Cell(50,10,'Jl. Dr. Wahidin Sudirohusodo 5 - 20 Yogyakarta 52008',0,0,'L');
		$pdf->SetXY(40,22);
		$pdf->SetFont('times','',10);
        $pdf->Cell(50,10,'Telp: 0274-563929 Ext. 610 email: baa.fk@staff.ukdw.ac.id; website: www.ukdw.ac.id/kedokteran',0,0,'L');

        $pdf->SetXY(90,30);
		$pdf->SetFont('times','B',11);
		$pdf->Cell(30,10,$title1,0,0,'C');
		$pdf->SetXY(90,35);
		$pdf->Cell(30,10,$title2,0,0,'C');
		$pdf->SetXY(90,20);
        $pdf->Cell(30,50,$title3,0,0,'C');

        $pdf->SetXY(20,55);
		$pdf->SetFont('times','',11);
		$pdf->Cell(45,5,'NIM',1,0);
        $pdf->Cell(120,5,$nim,1,0);

		$pdf->SetXY(20,63);
        $pdf->Cell(45,5,'Nama Mahasiswa',1,0);
        $pdf->Cell(120,5,$nama,1,0);

        $pdf->SetXY(20,71);
		$pdf->Cell(45,30,'Judul Karya Tulis Ilmiah',1);
		$pdf->SetXY(65,71);
		$pdf->Cell(120,30,'',1);
		$pdf->SetXY(65,71);
		$pdf->MultiCell(120,5,$judul,0,'J');

        $dosensql = "SELECT * FROM assign_sk, dosen
        WHERE assign_sk.assign_dosen = 'pembimbing 1'
        AND assign_sk.nim = '$nim'
        AND assign_sk.status_sk = 'aktif'
        AND assign_sk.id_dosen = dosen.id_dosen ";
		$resdosen1 = mysqli_query($conn,$dosensql);
		foreach ($resdosen1 as $row1) {
			$gelar_depan = $row1['gelar_depan'];
			$nama_dosen = $row1['nama_dosen'];
			$gelar_belakang = $row1['gelar_belakang'];

			$pdf->SetXY(20, 105);
			$pdf->SetFont('times','',11);
			$pdf->Cell(45,5,"Pembimbing 1",1,0);
			$pdf->Cell(120,5,$gelar_depan.''.$nama_dosen.'.'.$gelar_belakang,1,0,'L');
		}

		$dosensql2 = "SELECT * FROM assign_sk, dosen
        WHERE assign_sk.assign_dosen = 'pembimbing 2'
        AND assign_sk.nim = '$nim'
        AND assign_sk.status_sk = 'aktif'
        AND assign_sk.id_dosen = dosen.id_dosen";
		$resdosen2 = mysqli_query($conn,$dosensql2);
		foreach ($resdosen2 as $row2) {
			$gelar_depan = $row2['gelar_depan'];
			$nama_dosen = $row2['nama_dosen'];
			$gelar_belakang = $row2['gelar_belakang'];

			$pdf->SetXY(20, 110);
			$pdf->SetFont('times','',11);
			$pdf->Cell(45,5,"Pembimbing 2",1,0);
			$pdf->Cell(120,5,$gelar_depan.''.$nama_dosen.'.'.$gelar_belakang,1,0,'L');
		}

		$pdf->SetXY(20, 120);
		$pdf->SetFont('times','B',11);
		$pdf->Cell(10,5,"No",1,0,'C');
		$pdf->Cell(130,5,"Nama Berkas",1,0,'C');
		$pdf->Cell(25,5,"Jumlah",1,0,'C');

		$pdf->SetXY(20, 125);
		$pdf->SetFont('times','',11);
		$pdf->Cell(10,5,"1",1,0,'C');
		$pdf->Cell(130,5,"Naskah Publikasi",1,0,'L');
		$pdf->Cell(25,5,"1",1,0,'C');

		$pdf->SetXY(20, 130);
		$pdf->SetFont('times','',11);
		$pdf->Cell(10,5,"2",1,0,'C');
		$pdf->Cell(130,5,"Naskah Karya Tulis Ilmiah",1,0,'L');
		$pdf->Cell(25,5,"1",1,0,'C');

		$pdf->SetXY(20, 135);
		$pdf->SetFont('times','',11);
		$pdf->Cell(10,5,"3",1,0,'C');
		$pdf->Cell(130,5,"CD Berisi File Naskah Publikasi (doc) dan Naskah KTI (pdf) ",1,0,'L');
		$pdf->Cell(25,5,"1",1,0,'C');

		$pdf->SetXY(150, 150);
		$pdf->SetFont('times','',11);
		$pdf->Cell(10,5,"Yogyakarta, ".$tgl_textformat,0,0,'C');
		$pdf->SetXY(20, 155);
		$pdf->SetFont('times','',11);
		$pdf->Cell(40,5,"Yang Menyerahkan",0,0,'C');
		$pdf->SetXY(150, 155);
		$pdf->SetFont('times','',11);
		$pdf->Cell(10,5,"Yang Menerima",0,0,'C');

		$pdf->SetXY(20, 180);
		$pdf->SetFont('times','',11);
		$pdf->Cell(40,5,$nama,0,0,'C');
		$pdf->SetXY(150, 180);
		$pdf->SetFont('times','',11);
		$pdf->Cell(10,5,"Kristianto Purwoko Adi,S.Kom",0,0,'C');
		$pdf->SetXY(20, 185);
		$pdf->SetFont('times','',11);
		$pdf->Cell(40,5,$nim,0,0,'C');
		$pdf->output();
	}
}

?>
