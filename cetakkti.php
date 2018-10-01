<?php
@include ("dbconnect.php");
require("fpdf/fpdf.php");

if($_POST['nim'])
{
	$query = "SELECT * FROM kti,ruangsidang,mahasiswa
                WHERE kti.nim = mahasiswa.nim AND kti.ruangsidang = ruangsidang.id_ruang AND kti.nim = '".$_POST['nim']."'";
	$result = mysqli_query($conn,$query);
	foreach ($result as $row) 
	{ 

		$title1 = "Berita Acara";
		$title2 = "UJIAN KARYA TULIS ILMIAH SARJANA / SKRIPSI";
		$title3 = "Fakultas Kedokteran Universitas Kristen Duta Wacana";
		$nim = $row['nim'];
		$nama = $row['nama'];
		$tgl = $row['tgl_sidangkti'];
		$jam = $row['waktupelaksanaan'];
		$tempat = $row['ruangsidang'];
		$judul = $row['judulkti'];
		
		$pdf = new FPDF('P','mm','A4');
		$pdf->AddPage();
		$pdf->SetXY(90,10);
		$pdf->SetFont('times','B',14);
		$pdf->Cell(30,10,$title1,0,0,'C');
		$pdf->SetXY(90,15);
		$pdf->Cell(30,10,$title2,0,0,'C');
		$pdf->SetXY(90,20);
		$pdf->Cell(30,10,$title3,0,0,'C');

		$pdf->SetXY(20,35);
		$pdf->SetFont('times','',12);
		$pdf->Cell(45,10,'Tanggal',0,0);
		$pdf->Cell(5,10,':',0,0,'R');
		$pdf->Cell(120,8,$tgl,1,0);

		$pdf->SetXY(20,45);
		$pdf->SetFont('times','',12);
		$pdf->Cell(45,10,'Jam',0,0);
		$pdf->Cell(5,10,':',0,0,'R');
		$pdf->Cell(120,8,$jam.'WIB',1,0);

		$pdf->SetXY(20,55);
		$pdf->SetFont('times','',12);
		$pdf->Cell(45,10,'Tempat',0,0);
		$pdf->Cell(5,10,':',0,0,'R');
		$pdf->Cell(120,8,$tempat,1,0);

		$pdf->SetXY(20,70);
		$pdf->SetFont('times','',12);
		$pdf->Cell(45,10,'NIM',0,0);
		$pdf->Cell(5,10,':',0,0,'R');
		$pdf->Cell(120,8,$nim,1,0);

		$pdf->SetXY(20,80);
		$pdf->SetFont('times','',12);
		$pdf->Cell(45,10,'Nama',0,0);
		$pdf->Cell(5,10,':',0,0,'R');
		$pdf->Cell(120,8,$nama,1,0);

		$pdf->SetXY(20,90);
		$pdf->SetFont('times','',12);
		$pdf->MultiCell(45,5,'Judul Karya Tulis Ilmiah (Bahasa Indonesia)',0);
		$pdf->SetXY(65,90);
		$pdf->SetFont('times','',11);
		$pdf->Cell(5,10,':',0,0,'R');
		$pdf->MultiCell(120,5,$judul,0);
		$pdf->SetXY(70,90);
		$pdf->Cell(120,28,'',1,0);

		$pdf->SetXY(20,120);
		$pdf->SetFont('times','',12);
		$pdf->MultiCell(45,5,'Judul Karya Tulis Ilmiah (Bahasa Inggris)',0);
		$pdf->SetXY(65,120);
		$pdf->SetFont('times','',12);
		$pdf->Cell(5,10,':',0,0,'R');
		$pdf->Cell(120,28,' ',1,0);

		$pdf->ln(10);
		$pdf->SetXY(20, 150);
		$pdf->Cell(30,5,"Dosen Penguji",1,0,'C');
		$pdf->Cell(110,5,"Nama Dosen Penguji",1,0,'C');
		$pdf->Cell(30,5,"Tanda Tangan",1,0,'C');
		
		$dosensql = "SELECT * FROM kti,dosen WHERE dosen.id_dosen = $row[dosen1]";
		$resdosen1 = mysqli_query($conn,$dosensql);
		foreach ($resdosen1 as $row1) { 
			$gelar_depan = $row1['gelar_depan'];
			$nama_dosen = $row1['nama_dosen'];
			$gelar_belakang = $row1['gelar_belakang'];

			$pdf->SetXY(20, 155);
			$pdf->SetFont('times','',12);
			$pdf->Cell(30,10,"Penguji 1",1,0,'C');
			$pdf->Cell(110,10,$gelar_depan.''.$nama_dosen.'.'.$gelar_belakang,1,0,'L');
			$pdf->Cell(30,10,"",1,0,'C');
		}

		$dosensql2 = "SELECT * FROM kti,dosen WHERE dosen.id_dosen = $row[dosen2]";
		$resdosen2 = mysqli_query($conn,$dosensql2);
		foreach ($resdosen2 as $row2) { 
			$gelar_depan = $row2['gelar_depan'];
			$nama_dosen = $row2['nama_dosen'];
			$gelar_belakang = $row2['gelar_belakang'];
		
			$pdf->SetXY(20, 165);
			$pdf->SetFont('times','',12);
			$pdf->Cell(30,10,"Penguji 2",1,0,'C');
			$pdf->Cell(110,10,$gelar_depan.''.$nama_dosen.'.'.$gelar_belakang,1,0,'L');
			$pdf->Cell(30,10,"",1,0,'C');
		}

		$dosensql3 = "SELECT * FROM kti,dosen WHERE dosen.id_dosen = $row[penguji]";
		$resdosen3 = mysqli_query($conn,$dosensql3);
		foreach ($resdosen3 as $row3) { 
			$gelar_depan = $row3['gelar_depan'];
			$nama_dosen = $row3['nama_dosen'];
			$gelar_belakang = $row3['gelar_belakang'];
			$pdf->SetXY(20, 175);
			$pdf->SetFont('times','',12);
			$pdf->Cell(30,10,"Penguji 3",1,0,'C');
			$pdf->Cell(110,10,$gelar_depan.''.$nama_dosen.'.'.$gelar_belakang,1,0,'L');
			$pdf->Cell(30,10,"",1,0,'C');
		}
		$pdf->SetXY(20, 190);
		$pdf->Cell(35,5,"Catatan :",1,0,'C');
		$pdf->SetXY(20, 195);
		$pdf->Cell(170,70,"",1,0,'C');
//page 2
		$pdf->AddPage();
		$pdf->SetXY(20,20);
		$pdf->Image('fpdf/logo.png',20,10,20,20);
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
		$pdf->SetFont('times','B',14);
		$pdf->Cell(30,10,"Daftar Hadir",0,0,'C');
		$pdf->SetXY(90,35);
		$pdf->Cell(30,10,$title2,0,0,'C');
		$pdf->SetXY(90,40);
		$pdf->Cell(30,10,$title3,0,0,'C');

		$pdf->SetXY(20, 50);
		$pdf->SetFont('times','B',12);
		$pdf->Cell(15,10,"No",1,0,'C');
		$pdf->Cell(115,10,"Nama",1,0,'C');
		$pdf->Cell(40,10,"Tanda Tangan",1,0,'C');
		
		$dosensql = "SELECT * FROM kti,dosen WHERE dosen.id_dosen = $row[dosen1]";
		$resdosen1 = mysqli_query($conn,$dosensql);
		foreach ($resdosen1 as $row1) { 
			$gelar_depan = $row1['gelar_depan'];
			$nama_dosen = $row1['nama_dosen'];
			$gelar_belakang = $row1['gelar_belakang'];
			$pdf->SetXY(20, 60);
			$pdf->SetFont('times','',12);
			$pdf->Cell(15,10,"1",1,0,'C');
			$pdf->Cell(115,10,$gelar_depan.''.$nama_dosen.'.'.$gelar_belakang,1,0,'L');
			$pdf->Cell(40,10,"",1,0,'C');
		}
		$dosensql2 = "SELECT * FROM kti,dosen WHERE dosen.id_dosen = $row[dosen2]";
		$resdosen2 = mysqli_query($conn,$dosensql2);
		foreach ($resdosen2 as $row2) { 
			$gelar_depan = $row2['gelar_depan'];
			$nama_dosen = $row2['nama_dosen'];
			$gelar_belakang = $row2['gelar_belakang'];
		
			$pdf->SetXY(20, 70);
			$pdf->SetFont('times','',12);
			$pdf->Cell(15,10,"2",1,0,'C');
			$pdf->Cell(115,10,$gelar_depan.''.$nama_dosen.'.'.$gelar_belakang,1,0,'L');
			$pdf->Cell(40,10,"",1,0,'C');
		}
		$dosensql3 = "SELECT * FROM kti,dosen WHERE dosen.id_dosen = $row[penguji]";
		$resdosen3 = mysqli_query($conn,$dosensql3);
		foreach ($resdosen3 as $row3) { 
			$gelar_depan = $row3['gelar_depan'];
			$nama_dosen = $row3['nama_dosen'];
			$gelar_belakang = $row3['gelar_belakang'];
			$pdf->SetXY(20, 80);
			$pdf->SetFont('times','',12);
			$pdf->Cell(15,10,"3",1,0,'C');
			$pdf->Cell(115,10,$gelar_depan.''.$nama_dosen.'.'.$gelar_belakang,1,0,'L');
			$pdf->Cell(40,10,"",1,0,'C');
		}
		$pdf->SetXY(20, 90);
		$pdf->SetFont('times','',12);
		$pdf->Cell(15,10,"4",1,0,'C');
		$pdf->Cell(115,10,$nama,1,0,'L');
		$pdf->Cell(40,10,"",1,0,'C');
//page 3
		$pdf->AddPage();
		$pdf->SetXY(20,20);
		$pdf->Image('fpdf/logo.png',20,10,20,20);
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
		$pdf->SetFont('times','B',14);
		$pdf->Cell(30,10,"PENILAIAN UJIAN",0,0,'C');
		$pdf->SetXY(90,35);
		$pdf->Cell(30,10,"KARYA TULIS ILMIAH",0,0,'C');
		$pdf->SetXY(90,40);

		$pdf->SetXY(20,50);
		$pdf->SetFont('times','',12);
		$pdf->Cell(30,5,"Nama Mahasiswa",0,0);
		$pdf->SetXY(75,50);
		$pdf->SetFont('times','',12);
		$pdf->Cell(5,5,":",0,0);
		$pdf->SetXY(78,50);
		$pdf->SetFont('times','',12);
		$pdf->Cell(5,5,$nama,0,0);

		$pdf->SetXY(20,60);
		$pdf->SetFont('times','',12);
		$pdf->Cell(30,5,"Nomor Mahasiswa",0,0);
		$pdf->SetXY(75,60);
		$pdf->SetFont('times','',12);
		$pdf->Cell(5,5,":",0,0);
		$pdf->SetXY(78,60);
		$pdf->SetFont('times','',12);
		$pdf->Cell(5,5,$nim,0,0);

		$pdf->SetXY(20,70);
		$pdf->SetFont('times','',12);
		$pdf->Cell(30,5,"Judul Skripsi",0,0);
		$pdf->SetXY(75,70);
		$pdf->SetFont('times','',12);
		$pdf->Cell(5,5,":",0,0);
		$pdf->SetXY(78,70);
		$pdf->SetFont('times','',10);
		$pdf->MultiCell(120,5,$judul,0);

		$pdf->SetXY(20,90);
		$pdf->SetFont('times','B',12);
		$pdf->Cell(60,5,"Aspek yang dinilai",0,0);
		$pdf->Cell(40,5,"Nilai Angka",0,0);

		$pdf->SetXY(20,100);
		$pdf->SetFont('times','',12);
		$pdf->Cell(55,5,"Penulisan Isi",0,0);
		$pdf->Cell(5,5,": ___________",0,0);
		$pdf->Cell(30,5,"(40)",0,0,'R');
		$pdf->SetXY(20,110);
		$pdf->SetFont('times','',12);
		$pdf->Cell(55,5,"Materi & Presentasi",0,0);
		$pdf->Cell(5,5,": ___________",0,0);
		$pdf->Cell(30,5,"(10)",0,0,'R');
		$pdf->SetXY(20,120);
		$pdf->SetFont('times','',12);
		$pdf->Cell(55,5,"Penguasaan Materi",0,0);
		$pdf->Cell(5,5,": ___________",0,0);
		$pdf->Cell(30,5,"(20)",0,0,'R');
		$pdf->SetXY(20,130);
		$pdf->SetFont('times','',12);
		$pdf->Cell(55,5,"Penguasaan Materi",0,0);
		$pdf->Cell(5,5,": ___________",0,0);
		$pdf->Cell(30,5,"(30)",0,0,'R');
		$pdf->SetXY(20,150);
		$pdf->SetFont('times','B',12);
		$pdf->Cell(55,5,"Dinyatakan Lulus dengan Nilai",0,0);
		$pdf->Cell(5,5," ___________",0,0);
		
		$pdf->SetXY(20,160);
		$pdf->SetFont('times','B',12);
		$pdf->Cell(55,5,"85.00-100.00",0,0);
		$pdf->Cell(5,5,": ",0,0);
		$pdf->Cell(50,5,"A",0,0);
		$pdf->SetFont('times','',12);
		$pdf->Cell(22,5,"Yogyakarta, ",0,0);
		$pdf->Cell(20,5,$tgl,0,0);
		
		$pdf->SetXY(20,165);
		$pdf->SetFont('times','B',12);
		$pdf->Cell(55,5,"80.00-84.99",0,0);
		$pdf->Cell(5,5,": ",0,0);
		$pdf->Cell(50,5,"A-",0,0);
		$pdf->SetFont('times','',12);
		$pdf->Cell(45,5,"Pemimpin Ujian",0,0,'C');
		
		$pdf->SetXY(20,170);
		$pdf->SetFont('times','B',12);
		$pdf->Cell(55,5,"75.00-79.99",0,0);
		$pdf->Cell(5,5,": ",0,0);
		$pdf->Cell(50,5,"B+",0,0);

		$pdf->SetXY(20,175);
		$pdf->SetFont('times','B',12);
		$pdf->Cell(55,5,"70.00-74.99",0,0);
		$pdf->Cell(5,5,": ",0,0);
		$pdf->Cell(50,5,"B",0,0);

		$pdf->SetXY(20,180);
		$pdf->SetFont('times','B',12);
		$pdf->Cell(55,5,"65.00-69.99",0,0);
		$pdf->Cell(5,5,": ",0,0);
		$pdf->Cell(50,5,"B-",0,0);
		
		$pdf->SetXY(20,185);
		$pdf->SetFont('times','B',12);
		$pdf->Cell(55,5,"60.00-64.99",0,0);
		$pdf->Cell(5,5,": ",0,0);
		$pdf->Cell(50,5,"C+",0,0);
		$pdf->SetFont('times','',12);
		$dosensql = "SELECT * FROM kti,dosen WHERE dosen.id_dosen = $row[dosen1]";
		$resdosen1 = mysqli_query($conn,$dosensql);
		foreach ($resdosen1 as $row1) { 
			$gelar_depan = $row1['gelar_depan'];
			$nama_dosen = $row1['nama_dosen'];
			$gelar_belakang = $row1['gelar_belakang'];
			$pdf->SetXY(100,185);
			$pdf->Cell(100,5,$gelar_depan.''.$nama_dosen.'.'.$gelar_belakang,0,0,'C');
		}
		
		$pdf->SetXY(20,190);
		$pdf->SetFont('times','B',12);
		$pdf->Cell(55,5,"55.00-59.99",0,0);
		$pdf->Cell(5,5,": ",0,0);
		$pdf->Cell(50,5,"C",0,0);

		$pdf->SetXY(20,195);
		$pdf->SetFont('times','B',12);
		$pdf->Cell(55,5,"<54.99",0,0);
		$pdf->Cell(5,5,": ",0,0);
		$pdf->Cell(50,5,"Tidak Lulus",0,0);

//page 4
		$pdf->AddPage();
		$pdf->SetXY(20,20);
		$pdf->Image('fpdf/logo.png',20,10,20,20);
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
		$pdf->SetFont('times','B',14);
		$pdf->Cell(30,10,"PENILAIAN UJIAN",0,0,'C');
		$pdf->SetXY(90,35);
		$pdf->Cell(30,10,"KARYA TULIS ILMIAH",0,0,'C');
		$pdf->SetXY(90,40);

		$pdf->SetXY(20,50);
		$pdf->SetFont('times','',12);
		$pdf->Cell(30,5,"Nama Mahasiswa",0,0);
		$pdf->SetXY(75,50);
		$pdf->SetFont('times','',12);
		$pdf->Cell(5,5,":",0,0);
		$pdf->SetXY(78,50);
		$pdf->SetFont('times','',12);
		$pdf->Cell(5,5,$nama,0,0);

		$pdf->SetXY(20,60);
		$pdf->SetFont('times','',12);
		$pdf->Cell(30,5,"Nomor Mahasiswa",0,0);
		$pdf->SetXY(75,60);
		$pdf->SetFont('times','',12);
		$pdf->Cell(5,5,":",0,0);
		$pdf->SetXY(78,60);
		$pdf->SetFont('times','',12);
		$pdf->Cell(5,5,$nim,0,0);

		$pdf->SetXY(20,70);
		$pdf->SetFont('times','',12);
		$pdf->Cell(30,5,"Judul Skripsi",0,0);
		$pdf->SetXY(75,70);
		$pdf->SetFont('times','',12);
		$pdf->Cell(5,5,":",0,0);
		$pdf->SetXY(78,70);
		$pdf->SetFont('times','',10);
		$pdf->MultiCell(120,5,$judul,0);

		$pdf->SetXY(20,90);
		$pdf->SetFont('times','B',12);
		$pdf->Cell(60,5,"Aspek yang dinilai",0,0);
		$pdf->Cell(40,5,"Nilai Angka",0,0);

		$pdf->SetXY(20,100);
		$pdf->SetFont('times','',12);
		$pdf->Cell(55,5,"Penulisan Isi",0,0);
		$pdf->Cell(5,5,": ___________",0,0);
		$pdf->Cell(30,5,"(40)",0,0,'R');
		$pdf->SetXY(20,110);
		$pdf->SetFont('times','',12);
		$pdf->Cell(55,5,"Materi & Presentasi",0,0);
		$pdf->Cell(5,5,": ___________",0,0);
		$pdf->Cell(30,5,"(10)",0,0,'R');
		$pdf->SetXY(20,120);
		$pdf->SetFont('times','',12);
		$pdf->Cell(55,5,"Penguasaan Materi",0,0);
		$pdf->Cell(5,5,": ___________",0,0);
		$pdf->Cell(30,5,"(20)",0,0,'R');
		$pdf->SetXY(20,130);
		$pdf->SetFont('times','',12);
		$pdf->Cell(55,5,"Penguasaan Materi",0,0);
		$pdf->Cell(5,5,": ___________",0,0);
		$pdf->Cell(30,5,"(30)",0,0,'R');
		
		$pdf->SetXY(20,160);
		$pdf->SetFont('times','B',12);
		$pdf->Cell(55,5,"85.00-100.00",0,0);
		$pdf->Cell(5,5,": ",0,0);
		$pdf->Cell(50,5,"A",0,0);
		$pdf->SetFont('times','',12);
		$pdf->Cell(22,5,"Yogyakarta, ",0,0);
		$pdf->Cell(20,5,$tgl,0,0);
		
		$pdf->SetXY(20,165);
		$pdf->SetFont('times','B',12);
		$pdf->Cell(55,5,"80.00-84.99",0,0);
		$pdf->Cell(5,5,": ",0,0);
		$pdf->Cell(50,5,"A-",0,0);
		$pdf->SetFont('times','',12);
		$pdf->Cell(45,5,"Penguji 1",0,0,'C');
		
		$pdf->SetXY(20,170);
		$pdf->SetFont('times','B',12);
		$pdf->Cell(55,5,"75.00-79.99",0,0);
		$pdf->Cell(5,5,": ",0,0);
		$pdf->Cell(50,5,"B+",0,0);

		$pdf->SetXY(20,175);
		$pdf->SetFont('times','B',12);
		$pdf->Cell(55,5,"70.00-74.99",0,0);
		$pdf->Cell(5,5,": ",0,0);
		$pdf->Cell(50,5,"B",0,0);

		$pdf->SetXY(20,180);
		$pdf->SetFont('times','B',12);
		$pdf->Cell(55,5,"65.00-69.99",0,0);
		$pdf->Cell(5,5,": ",0,0);
		$pdf->Cell(50,5,"B-",0,0);
		
		$pdf->SetXY(20,185);
		$pdf->SetFont('times','B',12);
		$pdf->Cell(55,5,"60.00-64.99",0,0);
		$pdf->Cell(5,5,": ",0,0);
		$pdf->Cell(50,5,"C+",0,0);
		$pdf->SetFont('times','',12);
		$dosensql = "SELECT * FROM kti,dosen WHERE dosen.id_dosen = $row[dosen1]";
		$resdosen1 = mysqli_query($conn,$dosensql);
		foreach ($resdosen1 as $row1) { 
			$gelar_depan = $row1['gelar_depan'];
			$nama_dosen = $row1['nama_dosen'];
			$gelar_belakang = $row1['gelar_belakang'];
			$pdf->SetXY(100,185);
			$pdf->Cell(100,5,$gelar_depan.''.$nama_dosen.'.'.$gelar_belakang,0,0,'C');
		}
		
		$pdf->SetXY(20,190);
		$pdf->SetFont('times','B',12);
		$pdf->Cell(55,5,"55.00-59.99",0,0);
		$pdf->Cell(5,5,": ",0,0);
		$pdf->Cell(50,5,"C",0,0);

		$pdf->SetXY(20,195);
		$pdf->SetFont('times','B',12);
		$pdf->Cell(55,5,"<54.99",0,0);
		$pdf->Cell(5,5,": ",0,0);
		$pdf->Cell(50,5,"Tidak Lulus",0,0);
		
//page 5
		$pdf->AddPage();
		$pdf->SetXY(20,20);
		$pdf->Image('fpdf/logo.png',20,10,20,20);
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
		$pdf->SetFont('times','B',14);
		$pdf->Cell(30,10,"PENILAIAN UJIAN",0,0,'C');
		$pdf->SetXY(90,35);
		$pdf->Cell(30,10,"KARYA TULIS ILMIAH",0,0,'C');
		$pdf->SetXY(90,40);

		$pdf->SetXY(20,50);
		$pdf->SetFont('times','',12);
		$pdf->Cell(30,5,"Nama Mahasiswa",0,0);
		$pdf->SetXY(75,50);
		$pdf->SetFont('times','',12);
		$pdf->Cell(5,5,":",0,0);
		$pdf->SetXY(78,50);
		$pdf->SetFont('times','',12);
		$pdf->Cell(5,5,$nama,0,0);

		$pdf->SetXY(20,60);
		$pdf->SetFont('times','',12);
		$pdf->Cell(30,5,"Nomor Mahasiswa",0,0);
		$pdf->SetXY(75,60);
		$pdf->SetFont('times','',12);
		$pdf->Cell(5,5,":",0,0);
		$pdf->SetXY(78,60);
		$pdf->SetFont('times','',12);
		$pdf->Cell(5,5,$nim,0,0);

		$pdf->SetXY(20,70);
		$pdf->SetFont('times','',12);
		$pdf->Cell(30,5,"Judul Skripsi",0,0);
		$pdf->SetXY(75,70);
		$pdf->SetFont('times','',12);
		$pdf->Cell(5,5,":",0,0);
		$pdf->SetXY(78,70);
		$pdf->SetFont('times','',10);
		$pdf->MultiCell(120,5,$judul,0);

		$pdf->SetXY(20,90);
		$pdf->SetFont('times','B',12);
		$pdf->Cell(60,5,"Aspek yang dinilai",0,0);
		$pdf->Cell(40,5,"Nilai Angka",0,0);

		$pdf->SetXY(20,100);
		$pdf->SetFont('times','',12);
		$pdf->Cell(55,5,"Penulisan Isi",0,0);
		$pdf->Cell(5,5,": ___________",0,0);
		$pdf->Cell(30,5,"(40)",0,0,'R');
		$pdf->SetXY(20,110);
		$pdf->SetFont('times','',12);
		$pdf->Cell(55,5,"Materi & Presentasi",0,0);
		$pdf->Cell(5,5,": ___________",0,0);
		$pdf->Cell(30,5,"(10)",0,0,'R');
		$pdf->SetXY(20,120);
		$pdf->SetFont('times','',12);
		$pdf->Cell(55,5,"Penguasaan Materi",0,0);
		$pdf->Cell(5,5,": ___________",0,0);
		$pdf->Cell(30,5,"(20)",0,0,'R');
		$pdf->SetXY(20,130);
		$pdf->SetFont('times','',12);
		$pdf->Cell(55,5,"Penguasaan Materi",0,0);
		$pdf->Cell(5,5,": ___________",0,0);
		$pdf->Cell(30,5,"(30)",0,0,'R');
		
		$pdf->SetXY(20,160);
		$pdf->SetFont('times','B',12);
		$pdf->Cell(55,5,"85.00-100.00",0,0);
		$pdf->Cell(5,5,": ",0,0);
		$pdf->Cell(50,5,"A",0,0);
		$pdf->SetFont('times','',12);
		$pdf->Cell(22,5,"Yogyakarta, ",0,0);
		$pdf->Cell(20,5,$tgl,0,0);
		
		$pdf->SetXY(20,165);
		$pdf->SetFont('times','B',12);
		$pdf->Cell(55,5,"80.00-84.99",0,0);
		$pdf->Cell(5,5,": ",0,0);
		$pdf->Cell(50,5,"A-",0,0);
		$pdf->SetFont('times','',12);
		$pdf->Cell(45,5,"Penguji 2",0,0,'C');
		
		$pdf->SetXY(20,170);
		$pdf->SetFont('times','B',12);
		$pdf->Cell(55,5,"75.00-79.99",0,0);
		$pdf->Cell(5,5,": ",0,0);
		$pdf->Cell(50,5,"B+",0,0);

		$pdf->SetXY(20,175);
		$pdf->SetFont('times','B',12);
		$pdf->Cell(55,5,"70.00-74.99",0,0);
		$pdf->Cell(5,5,": ",0,0);
		$pdf->Cell(50,5,"B",0,0);

		$pdf->SetXY(20,180);
		$pdf->SetFont('times','B',12);
		$pdf->Cell(55,5,"65.00-69.99",0,0);
		$pdf->Cell(5,5,": ",0,0);
		$pdf->Cell(50,5,"B-",0,0);
		
		$pdf->SetXY(20,185);
		$pdf->SetFont('times','B',12);
		$pdf->Cell(55,5,"60.00-64.99",0,0);
		$pdf->Cell(5,5,": ",0,0);
		$pdf->Cell(50,5,"C+",0,0);
		$pdf->SetFont('times','',12);
		$dosensql2 = "SELECT * FROM kti,dosen WHERE dosen.id_dosen = $row[dosen2]";
		$resdosen2 = mysqli_query($conn,$dosensql2);
		foreach ($resdosen2 as $row2) { 
			$gelar_depan = $row2['gelar_depan'];
			$nama_dosen = $row2['nama_dosen'];
			$gelar_belakang = $row2['gelar_belakang'];
			$pdf->SetXY(100,185);
			$pdf->Cell(100,5,$gelar_depan.''.$nama_dosen.'.'.$gelar_belakang,0,0,'C');
		}
		
		$pdf->SetXY(20,190);
		$pdf->SetFont('times','B',12);
		$pdf->Cell(55,5,"55.00-59.99",0,0);
		$pdf->Cell(5,5,": ",0,0);
		$pdf->Cell(50,5,"C",0,0);

		$pdf->SetXY(20,195);
		$pdf->SetFont('times','B',12);
		$pdf->Cell(55,5,"<54.99",0,0);
		$pdf->Cell(5,5,": ",0,0);
		$pdf->Cell(50,5,"Tidak Lulus",0,0);
		
//page 5
		$pdf->AddPage();
		$pdf->SetXY(20,20);
		$pdf->Image('fpdf/logo.png',20,10,20,20);
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
		$pdf->SetFont('times','B',14);
		$pdf->Cell(30,10,"PENILAIAN UJIAN",0,0,'C');
		$pdf->SetXY(90,35);
		$pdf->Cell(30,10,"KARYA TULIS ILMIAH",0,0,'C');
		$pdf->SetXY(90,40);

		$pdf->SetXY(20,50);
		$pdf->SetFont('times','',12);
		$pdf->Cell(30,5,"Nama Mahasiswa",0,0);
		$pdf->SetXY(75,50);
		$pdf->SetFont('times','',12);
		$pdf->Cell(5,5,":",0,0);
		$pdf->SetXY(78,50);
		$pdf->SetFont('times','',12);
		$pdf->Cell(5,5,$nama,0,0);

		$pdf->SetXY(20,60);
		$pdf->SetFont('times','',12);
		$pdf->Cell(30,5,"Nomor Mahasiswa",0,0);
		$pdf->SetXY(75,60);
		$pdf->SetFont('times','',12);
		$pdf->Cell(5,5,":",0,0);
		$pdf->SetXY(78,60);
		$pdf->SetFont('times','',12);
		$pdf->Cell(5,5,$nim,0,0);

		$pdf->SetXY(20,70);
		$pdf->SetFont('times','',12);
		$pdf->Cell(30,5,"Judul Skripsi",0,0);
		$pdf->SetXY(75,70);
		$pdf->SetFont('times','',12);
		$pdf->Cell(5,5,":",0,0);
		$pdf->SetXY(78,70);
		$pdf->SetFont('times','',10);
		$pdf->MultiCell(120,5,$judul,0);

		$pdf->SetXY(20,90);
		$pdf->SetFont('times','B',12);
		$pdf->Cell(60,5,"Aspek yang dinilai",0,0);
		$pdf->Cell(40,5,"Nilai Angka",0,0);

		$pdf->SetXY(20,100);
		$pdf->SetFont('times','',12);
		$pdf->Cell(55,5,"Penulisan Isi",0,0);
		$pdf->Cell(5,5,": ___________",0,0);
		$pdf->Cell(30,5,"(40)",0,0,'R');
		$pdf->SetXY(20,110);
		$pdf->SetFont('times','',12);
		$pdf->Cell(55,5,"Materi & Presentasi",0,0);
		$pdf->Cell(5,5,": ___________",0,0);
		$pdf->Cell(30,5,"(10)",0,0,'R');
		$pdf->SetXY(20,120);
		$pdf->SetFont('times','',12);
		$pdf->Cell(55,5,"Penguasaan Materi",0,0);
		$pdf->Cell(5,5,": ___________",0,0);
		$pdf->Cell(30,5,"(20)",0,0,'R');
		$pdf->SetXY(20,130);
		$pdf->SetFont('times','',12);
		$pdf->Cell(55,5,"Penguasaan Materi",0,0);
		$pdf->Cell(5,5,": ___________",0,0);
		$pdf->Cell(30,5,"(30)",0,0,'R');
		
		$pdf->SetXY(20,160);
		$pdf->SetFont('times','B',12);
		$pdf->Cell(55,5,"85.00-100.00",0,0);
		$pdf->Cell(5,5,": ",0,0);
		$pdf->Cell(50,5,"A",0,0);
		$pdf->SetFont('times','',12);
		$pdf->Cell(22,5,"Yogyakarta, ",0,0);
		$pdf->Cell(20,5,$tgl,0,0);
		
		$pdf->SetXY(20,165);
		$pdf->SetFont('times','B',12);
		$pdf->Cell(55,5,"80.00-84.99",0,0);
		$pdf->Cell(5,5,": ",0,0);
		$pdf->Cell(50,5,"A-",0,0);
		$pdf->SetFont('times','',12);
		$pdf->Cell(45,5,"Penguji 3",0,0,'C');
		
		$pdf->SetXY(20,170);
		$pdf->SetFont('times','B',12);
		$pdf->Cell(55,5,"75.00-79.99",0,0);
		$pdf->Cell(5,5,": ",0,0);
		$pdf->Cell(50,5,"B+",0,0);

		$pdf->SetXY(20,175);
		$pdf->SetFont('times','B',12);
		$pdf->Cell(55,5,"70.00-74.99",0,0);
		$pdf->Cell(5,5,": ",0,0);
		$pdf->Cell(50,5,"B",0,0);

		$pdf->SetXY(20,180);
		$pdf->SetFont('times','B',12);
		$pdf->Cell(55,5,"65.00-69.99",0,0);
		$pdf->Cell(5,5,": ",0,0);
		$pdf->Cell(50,5,"B-",0,0);
		
		$pdf->SetXY(20,185);
		$pdf->SetFont('times','B',12);
		$pdf->Cell(55,5,"60.00-64.99",0,0);
		$pdf->Cell(5,5,": ",0,0);
		$pdf->Cell(50,5,"C+",0,0);
		$pdf->SetFont('times','',12);
		$dosensql3 = "SELECT * FROM kti,dosen WHERE dosen.id_dosen = $row[penguji]";
		$resdosen3 = mysqli_query($conn,$dosensql3);
		foreach ($resdosen3 as $row3) { 
			$gelar_depan = $row3['gelar_depan'];
			$nama_dosen = $row3['nama_dosen'];
			$gelar_belakang = $row3['gelar_belakang'];
			$pdf->SetXY(100,185);
			$pdf->Cell(100,5,$gelar_depan.''.$nama_dosen.'.'.$gelar_belakang,0,0,'C');
		}
		
		$pdf->SetXY(20,190);
		$pdf->SetFont('times','B',12);
		$pdf->Cell(55,5,"55.00-59.99",0,0);
		$pdf->Cell(5,5,": ",0,0);
		$pdf->Cell(50,5,"C",0,0);

		$pdf->SetXY(20,195);
		$pdf->SetFont('times','B',12);
		$pdf->Cell(55,5,"<54.99",0,0);
		$pdf->Cell(5,5,": ",0,0);
		$pdf->Cell(50,5,"Tidak Lulus",0,0);

		$pdf->output();
	}
}

?>