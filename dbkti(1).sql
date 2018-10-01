-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2018 at 06:42 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbkti`
--

-- --------------------------------------------------------

--
-- Table structure for table `angkatan`
--

CREATE TABLE `angkatan` (
  `id_angkatan` int(4) NOT NULL,
  `angkatan` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `angkatan`
--

INSERT INTO `angkatan` (`id_angkatan`, `angkatan`) VALUES
(1, 2009),
(2, 2010),
(3, 2011),
(4, 2012),
(5, 2013),
(6, 2014),
(7, 2015),
(8, 2016),
(9, 2017),
(10, 2018),
(11, 2019),
(12, 2020);

-- --------------------------------------------------------

--
-- Table structure for table `arsipkti`
--

CREATE TABLE `arsipkti` (
  `id_arsipkti` int(11) NOT NULL,
  `idsemester` int(10) NOT NULL,
  `nim` int(10) NOT NULL,
  `kti_filepdf` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `arsipkti`
--

INSERT INTO `arsipkti` (`id_arsipkti`, `idsemester`, `nim`, `kti_filepdf`) VALUES
(3, 1, 41140001, './uploadKTI/kti.pdf'),
(4, 1, 41140002, './uploadKTI/SINKOP PADA PASIEN STROKE VERTEBROBASILER.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `arsipproposal`
--

CREATE TABLE `arsipproposal` (
  `id_arsipproposal` int(11) NOT NULL,
  `idsemester` int(10) NOT NULL,
  `nim` int(10) NOT NULL,
  `proposal_filepdf` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `arsipproposal`
--

INSERT INTO `arsipproposal` (`id_arsipproposal`, `idsemester`, `nim`, `proposal_filepdf`) VALUES
(1, 1, 41140001, './uploadProposal/proposal.pdf'),
(2, 1, 41140002, './uploadProposal/proposal.pdf'),
(3, 2, 41140002, './uploadProposal/proposal.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `arsipsemhas`
--

CREATE TABLE `arsipsemhas` (
  `id_arsipsemhas` int(11) NOT NULL,
  `idsemester` int(10) NOT NULL,
  `nim` int(10) NOT NULL,
  `semhas_filepdf` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `arsipsemhas`
--

INSERT INTO `arsipsemhas` (`id_arsipsemhas`, `idsemester`, `nim`, `semhas_filepdf`) VALUES
(1, 1, 41140001, './uploadProposal/semhas.pdf'),
(2, 1, 41140001, './uploadSemhas/semhas.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `arsipsk`
--

CREATE TABLE `arsipsk` (
  `id_arsipsk` int(11) NOT NULL,
  `idsemester` int(10) NOT NULL,
  `sk_filepdf` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `arsipsk`
--

INSERT INTO `arsipsk` (`id_arsipsk`, `idsemester`, `sk_filepdf`) VALUES
(1, 1, '1'),
(2, 1, './uploadSK/Sk1.pdf'),
(3, 2, './uploadSK/sk2.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id_dosen` int(5) NOT NULL,
  `nama_dosen` varchar(200) NOT NULL,
  `gelar_depan` varchar(30) NOT NULL,
  `gelar_belakang` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id_dosen`, `nama_dosen`, `gelar_depan`, `gelar_belakang`) VALUES
(1, 'JONATHAN WILLY SIAGIAN', 'Prof.dr.', 'Sp.PA'),
(2, 'YANTI IVANA SURYANTO', 'dr.', 'M.Sc.'),
(3, 'ARUM KRISMI', 'dr.', 'M.Sc.,Sp.KK'),
(4, 'THE MARIA MEIWATI WIDAGDO', 'dr.', 'Ph.D'),
(5, 'SUGIANTO ADISAPUTRO', 'dr.', 'M.Kes.,Sp.S.,Ph.D'),
(6, 'THERESIA AVILLA RIRIEL KUSUMOSIH', 'dr.', 'Sp.OG'),
(7, 'DANIEL CHRISWINANTO ADITYO NUGROHO', 'dr.', 'MPH'),
(8, 'FX.WIKAN INDRARTO', 'DR. dr.', 'Sp.A'),
(9, 'MARGARETA YULIANI', 'dr.', 'Sp.A'),
(10, 'SLAMET SUNARNO HARJOSUWARNO', 'dr.', 'MPH'),
(11, 'RIZALDY TASLIM PINZON', 'DR. dr.', 'M.Kes.,Sp.S'),
(12, 'NINING SRI WURYANINGSIH', 'DR. dr.', 'SP.PK'),
(13, 'YOSEPH LEONARDO SAMODRA', 'dr.', 'MPH'),
(14, 'TEGUH KRISTIAN PERDAMAIN', 'dr.', 'MPH'),
(15, 'ISTIANTO KUNTJORO', 'dr.', 'MSc');

-- --------------------------------------------------------

--
-- Table structure for table `kti`
--

CREATE TABLE `kti` (
  `id_kti` int(5) NOT NULL,
  `nim` int(8) NOT NULL,
  `waktupelaksanaan` varchar(10) DEFAULT NULL,
  `ruangsidang` varchar(100) DEFAULT NULL,
  `judulkti` varchar(255) NOT NULL,
  `dosen1` varchar(100) NOT NULL,
  `penulisanisi1` float DEFAULT NULL,
  `metodologi1` float DEFAULT NULL,
  `penguasaanmateri1` float DEFAULT NULL,
  `presentasi1` float DEFAULT NULL,
  `dosen2` varchar(100) NOT NULL,
  `penulisanisi2` float DEFAULT NULL,
  `metodologi2` float DEFAULT NULL,
  `penguasaanmateri2` float DEFAULT NULL,
  `presentasi2` float DEFAULT NULL,
  `penguji` varchar(100) NOT NULL,
  `penulisanisi3` float DEFAULT NULL,
  `metodologi3` float DEFAULT NULL,
  `penguasaanmateri3` float DEFAULT NULL,
  `presentasi3` float DEFAULT NULL,
  `tgl_sidangkti` varchar(20) DEFAULT NULL,
  `batas_pengumpulan` varchar(10) DEFAULT NULL,
  `tgl_kumpul` varchar(10) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `penulisanisi` float DEFAULT NULL,
  `metodologi` float DEFAULT NULL,
  `penguasaanmateri` float DEFAULT NULL,
  `materidanpresentasi` float DEFAULT NULL,
  `nilaiakhir` float DEFAULT NULL,
  `nilaiakhirhuruf` varchar(20) DEFAULT NULL,
  `nilaiakhirhuruf_temp` varchar(5) DEFAULT NULL,
  `idsemester` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kti`
--

INSERT INTO `kti` (`id_kti`, `nim`, `waktupelaksanaan`, `ruangsidang`, `judulkti`, `dosen1`, `penulisanisi1`, `metodologi1`, `penguasaanmateri1`, `presentasi1`, `dosen2`, `penulisanisi2`, `metodologi2`, `penguasaanmateri2`, `presentasi2`, `penguji`, `penulisanisi3`, `metodologi3`, `penguasaanmateri3`, `presentasi3`, `tgl_sidangkti`, `batas_pengumpulan`, `tgl_kumpul`, `status`, `penulisanisi`, `metodologi`, `penguasaanmateri`, `materidanpresentasi`, `nilaiakhir`, `nilaiakhirhuruf`, `nilaiakhirhuruf_temp`, `idsemester`) VALUES
(1, 41140001, '13:00', '3', 'BCDEFGHIJKLAZZZZZZZZZZZZ', '1', 15, 15, 15, 15, '2', 20, 20, 20, 20, '5', 25, 25, 25, 25, '04/10/2018', '04/11/2018', '29/09/2018', 'kti', 20, 20, 20, 20, 80, 'A-', 'A-', 2),
(3, 41140003, NULL, NULL, 'BSAAD', '2', NULL, NULL, NULL, NULL, '4', NULL, NULL, NULL, NULL, '5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `loghistoryjudul`
--

CREATE TABLE `loghistoryjudul` (
  `idlog` int(10) NOT NULL,
  `judullama` varchar(200) NOT NULL,
  `judulbaru` varchar(200) NOT NULL,
  `nim` int(10) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loghistoryjudul`
--

INSERT INTO `loghistoryjudul` (`idlog`, `judullama`, `judulbaru`, `nim`, `status`) VALUES
(2, 'A', 'BCD', 41140001, 'Proposal'),
(3, 'B', 'BDWF', 41140002, 'Proposal'),
(4, 'BDWF', 'BDWFADKAJDADNALHLDKJGAHSKJDHKASHKDA', 41140002, 'semhas'),
(5, 'BCD', 'BCDEF', 41140001, 'Proposal'),
(6, 'BCDEF', 'BCDEFGHIJ', 41140001, 'semhas'),
(7, 'BCDEFGHIJ', 'BCDEFGHIJ', 41140001, 'semhas'),
(8, 'BCDEFGHIJ', 'BCDEFGHIJKL', 41140001, 'semhas'),
(9, 'BCDEFGHIJKL', 'BCDEFGHIJKLAZZZZZZZZZZZZ', 41140001, 'kti'),
(10, 'B', 'BSA', 41140003, 'Proposal'),
(11, 'BCDEFGHIJKL', 'BCDEFGHIJKL', 41140001, 'semhas'),
(12, 'BSA', 'BSAA', 41140003, 'Proposal'),
(13, 'BSAA', 'BSAAD', 41140003, 'semhas'),
(14, 'BCDEFGHIJKL', 'BCDEFGHIJKLASD', 41140001, 'kti');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` int(8) NOT NULL,
  `nama` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama`) VALUES
(41140001, 'NAMA '),
(41140002, 'MAHASISWA LENGKAP'),
(41140003, 'AYU DIANITA'),
(41140004, 'TATI HERAWATI'),
(41140005, 'ADHE SAMBU ATMODJO'),
(41140006, 'ANDHYKA PUTRA');

-- --------------------------------------------------------

--
-- Table structure for table `outline`
--

CREATE TABLE `outline` (
  `id_outline` int(10) NOT NULL,
  `nim` int(8) NOT NULL,
  `judul_outline` varchar(255) NOT NULL,
  `pertanyaan_penelitian` varchar(255) NOT NULL,
  `manfaat_penelitian` varchar(255) NOT NULL,
  `desain_penelitian` varchar(255) NOT NULL,
  `sample_penelitian` varchar(255) NOT NULL,
  `variabel_bebas` varchar(255) NOT NULL,
  `variabel_tergantung` varchar(255) NOT NULL,
  `hipotesis` varchar(255) NOT NULL,
  `usulan_dosen1` varchar(100) NOT NULL,
  `usulan_dosen2` varchar(100) NOT NULL,
  `tgl_pengajuan` varchar(10) NOT NULL,
  `tgl_disetujui` varchar(10) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `semester` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `outline`
--

INSERT INTO `outline` (`id_outline`, `nim`, `judul_outline`, `pertanyaan_penelitian`, `manfaat_penelitian`, `desain_penelitian`, `sample_penelitian`, `variabel_bebas`, `variabel_tergantung`, `hipotesis`, `usulan_dosen1`, `usulan_dosen2`, `tgl_pengajuan`, `tgl_disetujui`, `status`, `semester`) VALUES
(1, 41140001, 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', '1', '2', '27/09/2018', '28/09/2018', 'Lolos Outline', 2),
(2, 41140002, 'B', 'B', 'B', 'B', 'B', 'B', 'B', 'B', '2', '3', '27/09/2018', '28/09/2018', 'Lolos Outline', 1),
(3, 41140003, 'B', 'B', 'B', 'B', 'B', 'B', 'B', 'B', '2', '4', '28/09/2018', '27/09/2018', 'Lolos Outline', 1);

-- --------------------------------------------------------

--
-- Table structure for table `proposal`
--

CREATE TABLE `proposal` (
  `id_proposal` int(5) NOT NULL,
  `nim` int(8) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `waktupelaksanaan` varchar(10) DEFAULT NULL,
  `ruangsidang` varchar(100) DEFAULT NULL,
  `judulproposal` varchar(255) NOT NULL,
  `dosen1` varchar(100) NOT NULL,
  `dosen2` varchar(100) NOT NULL,
  `penguji` varchar(100) DEFAULT NULL,
  `tgl_sidangproposal` varchar(20) DEFAULT NULL,
  `batas_sidangkti` varchar(20) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `id_semester` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `proposal`
--

INSERT INTO `proposal` (`id_proposal`, `nim`, `nama`, `waktupelaksanaan`, `ruangsidang`, `judulproposal`, `dosen1`, `dosen2`, `penguji`, `tgl_sidangproposal`, `batas_sidangkti`, `status`, `id_semester`) VALUES
(42, 41140002, 'MAHASISWA LENGKAP', '13:00', '4', 'BDWF', '2', '3', '10', '30/09/2018', '30/3/2019', 'proposal', 1),
(43, 41140003, 'AYU DIANITA', '13:00', '5', 'BSAA', '2', '4', '5', '27/09/2018', '27/3/2019', 'proposal', 1),
(44, 41140001, 'NAMA ', '13:00', '3', 'BCDEF', '1', '2', '5', '30/09/2018', '30/3/2019', 'proposal', 2);

-- --------------------------------------------------------

--
-- Table structure for table `ruangsidang`
--

CREATE TABLE `ruangsidang` (
  `id_ruang` int(5) NOT NULL,
  `ruangsidang` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ruangsidang`
--

INSERT INTO `ruangsidang` (`id_ruang`, `ruangsidang`) VALUES
(1, 'Ruang Rapat Dekanat, Gedung Logos Lantai 1'),
(2, 'Ruang Rapat Basement, Gedung Logos Lantai Basement'),
(3, 'Ruang Tutorial M.3-1, Gedung Makarios Lantai 3'),
(4, 'Ruang Tutorial M.3-2, Gedung Makarios Lantai 3'),
(5, 'Ruang Tutorial M.3-3, Gedung Makarios Lantai 3'),
(6, 'Ruang Tutorial M.3-4, Gedung Makarios Lantai 3'),
(7, 'Ruang Tutorial M.3-5, Gedung Makarios Lantai 3'),
(8, 'Ruang Tutorial M.2-1, Gedung Makarios Lantai 2'),
(9, 'Ruang Tutorial M.2-2, Gedung Makarios Lantai 2'),
(10, 'Ruang Tutorial M.2-3, Gedung Makarios Lantai 2'),
(11, 'Ruang Tutorial M.2-4, Gedung Makarios Lantai 2'),
(12, 'Ruang Tutorial M.2-5, Gedung Makarios Lantai 2'),
(13, 'Ruang Tutorial H, Gedung Logos Lantai 3'),
(14, 'Ruang Tutorial I, Gedung Logos Lantai 3'),
(15, 'Ruang Pertemuan H, Rumah Sakit Bethesda'),
(16, 'Ruang Rapat GBST Rumah Sakit Bethesda');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `id_semester` int(1) NOT NULL,
  `semester` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`id_semester`, `semester`) VALUES
(1, 'Gasal 2017/2018'),
(2, 'Genap 2017/2018'),
(3, 'Gasal 2018/2019'),
(4, 'Genap 2018/2019'),
(5, 'Gasal 2019/2020'),
(6, 'Genap 2019/2020');

-- --------------------------------------------------------

--
-- Table structure for table `semhas`
--

CREATE TABLE `semhas` (
  `id_semhas` int(5) NOT NULL,
  `nim` int(8) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `waktupelaksanaan` varchar(10) DEFAULT NULL,
  `ruangsidang` varchar(100) DEFAULT NULL,
  `judulKTI` varchar(255) NOT NULL,
  `dosen1` varchar(100) NOT NULL,
  `dosen2` varchar(100) NOT NULL,
  `penguji` varchar(100) NOT NULL,
  `tgl_seminarhasil` varchar(10) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `idsemester` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `semhas`
--

INSERT INTO `semhas` (`id_semhas`, `nim`, `nama`, `waktupelaksanaan`, `ruangsidang`, `judulKTI`, `dosen1`, `dosen2`, `penguji`, `tgl_seminarhasil`, `status`, `idsemester`) VALUES
(1, 41140001, 'NAMA ', '13:00', '3', 'BCDEFGHIJKL', '1', '2', '5', '05/10/2018', 'semhas', 2),
(2, 41140003, 'AYU DIANITA', '13:00', '3', 'BSAAD', '2', '4', '5', '04/10/2018', 'semhas', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sk`
--

CREATE TABLE `sk` (
  `id_sk` int(10) NOT NULL,
  `id_dosen1sk` int(11) NOT NULL,
  `id_dosen2sk` int(10) NOT NULL,
  `id_semestersk` int(11) NOT NULL,
  `nim_sk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sk`
--

INSERT INTO `sk` (`id_sk`, `id_dosen1sk`, `id_dosen2sk`, `id_semestersk`, `nim_sk`) VALUES
(1, 1, 2, 1, 41140002),
(2, 2, 4, 1, 41140003),
(3, 1, 2, 2, 41140001);

-- --------------------------------------------------------

--
-- Table structure for table `sk1`
--

CREATE TABLE `sk1` (
  `id_sk1` int(1) NOT NULL,
  `id_semester` int(10) NOT NULL,
  `id_dosen1` int(10) NOT NULL,
  `nim` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sk1`
--

INSERT INTO `sk1` (`id_sk1`, `id_semester`, `id_dosen1`, `nim`) VALUES
(6, 1, 1, 41140002),
(7, 1, 2, 41140003),
(8, 2, 1, 41140001);

-- --------------------------------------------------------

--
-- Table structure for table `sk2`
--

CREATE TABLE `sk2` (
  `id_sk2` int(10) NOT NULL,
  `id_semester` int(10) NOT NULL,
  `id_dosen2` int(10) NOT NULL,
  `nim` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sk2`
--

INSERT INTO `sk2` (`id_sk2`, `id_semester`, `id_dosen2`, `nim`) VALUES
(7, 1, 2, 41140002),
(8, 1, 4, 41140003),
(9, 2, 2, 41140001);

-- --------------------------------------------------------

--
-- Table structure for table `tahunajaran`
--

CREATE TABLE `tahunajaran` (
  `id_TA` int(4) NOT NULL,
  `tahunajaran` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tahunajaran`
--

INSERT INTO `tahunajaran` (`id_TA`, `tahunajaran`) VALUES
(1, '2017/2018'),
(2, '2018/2019');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(3) NOT NULL,
  `nama_user` varchar(200) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `login_as` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama_user`, `username`, `password`, `login_as`) VALUES
(1, 'administrator', 'admin', 'admin', '1'),
(2, 'dr. Yanti Ivana Suryanto,M.Sc', 'yanti_ivana', 'dosen', '2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `angkatan`
--
ALTER TABLE `angkatan`
  ADD PRIMARY KEY (`id_angkatan`);

--
-- Indexes for table `arsipkti`
--
ALTER TABLE `arsipkti`
  ADD PRIMARY KEY (`id_arsipkti`);

--
-- Indexes for table `arsipproposal`
--
ALTER TABLE `arsipproposal`
  ADD PRIMARY KEY (`id_arsipproposal`);

--
-- Indexes for table `arsipsemhas`
--
ALTER TABLE `arsipsemhas`
  ADD PRIMARY KEY (`id_arsipsemhas`);

--
-- Indexes for table `arsipsk`
--
ALTER TABLE `arsipsk`
  ADD PRIMARY KEY (`id_arsipsk`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id_dosen`);

--
-- Indexes for table `kti`
--
ALTER TABLE `kti`
  ADD PRIMARY KEY (`id_kti`);

--
-- Indexes for table `loghistoryjudul`
--
ALTER TABLE `loghistoryjudul`
  ADD PRIMARY KEY (`idlog`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `outline`
--
ALTER TABLE `outline`
  ADD PRIMARY KEY (`id_outline`);

--
-- Indexes for table `proposal`
--
ALTER TABLE `proposal`
  ADD PRIMARY KEY (`id_proposal`);

--
-- Indexes for table `ruangsidang`
--
ALTER TABLE `ruangsidang`
  ADD PRIMARY KEY (`id_ruang`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`id_semester`);

--
-- Indexes for table `semhas`
--
ALTER TABLE `semhas`
  ADD PRIMARY KEY (`id_semhas`);

--
-- Indexes for table `sk`
--
ALTER TABLE `sk`
  ADD PRIMARY KEY (`id_sk`);

--
-- Indexes for table `sk1`
--
ALTER TABLE `sk1`
  ADD PRIMARY KEY (`id_sk1`);

--
-- Indexes for table `sk2`
--
ALTER TABLE `sk2`
  ADD PRIMARY KEY (`id_sk2`);

--
-- Indexes for table `tahunajaran`
--
ALTER TABLE `tahunajaran`
  ADD PRIMARY KEY (`id_TA`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `angkatan`
--
ALTER TABLE `angkatan`
  MODIFY `id_angkatan` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `arsipkti`
--
ALTER TABLE `arsipkti`
  MODIFY `id_arsipkti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `arsipproposal`
--
ALTER TABLE `arsipproposal`
  MODIFY `id_arsipproposal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `arsipsemhas`
--
ALTER TABLE `arsipsemhas`
  MODIFY `id_arsipsemhas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `arsipsk`
--
ALTER TABLE `arsipsk`
  MODIFY `id_arsipsk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id_dosen` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `kti`
--
ALTER TABLE `kti`
  MODIFY `id_kti` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `loghistoryjudul`
--
ALTER TABLE `loghistoryjudul`
  MODIFY `idlog` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `outline`
--
ALTER TABLE `outline`
  MODIFY `id_outline` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `proposal`
--
ALTER TABLE `proposal`
  MODIFY `id_proposal` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `ruangsidang`
--
ALTER TABLE `ruangsidang`
  MODIFY `id_ruang` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `id_semester` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `semhas`
--
ALTER TABLE `semhas`
  MODIFY `id_semhas` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sk`
--
ALTER TABLE `sk`
  MODIFY `id_sk` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sk1`
--
ALTER TABLE `sk1`
  MODIFY `id_sk1` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sk2`
--
ALTER TABLE `sk2`
  MODIFY `id_sk2` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
