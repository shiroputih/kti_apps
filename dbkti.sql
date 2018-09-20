-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2018 at 05:47 AM
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
(13, 'YOSEPH LEONARDO SAMODRA', 'dr.', 'MPH');

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `id_gender` int(1) NOT NULL,
  `gender` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`id_gender`, `gender`) VALUES
(1, 'Laki-Laki'),
(2, 'Perempuan');

-- --------------------------------------------------------

--
-- Table structure for table `kti`
--

CREATE TABLE `kti` (
  `id_kti` int(5) NOT NULL,
  `nim` int(8) NOT NULL,
  `nama` varchar(255) NOT NULL,
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
  `id_angkatan` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kti`
--

INSERT INTO `kti` (`id_kti`, `nim`, `nama`, `waktupelaksanaan`, `ruangsidang`, `judulkti`, `dosen1`, `penulisanisi1`, `metodologi1`, `penguasaanmateri1`, `presentasi1`, `dosen2`, `penulisanisi2`, `metodologi2`, `penguasaanmateri2`, `presentasi2`, `penguji`, `penulisanisi3`, `metodologi3`, `penguasaanmateri3`, `presentasi3`, `tgl_sidangkti`, `batas_pengumpulan`, `tgl_kumpul`, `status`, `penulisanisi`, `metodologi`, `penguasaanmateri`, `materidanpresentasi`, `nilaiakhir`, `nilaiakhirhuruf`, `id_angkatan`) VALUES
(6, 41120001, 'SHIRO', '15:00', '3', 'OUTLINE SAYA BUNDAR', '9', 20, 5, 10, 20, '8', 20, 10, 20, 30, '13', 20, 10, 20, 10, '20/09/2018', '20/10/2018', '06/10/2018', 'kti', 20, 8.33333, 16.6667, 20, 65, 'B-', 4),
(7, 41140002, 'NAMA MAHASISWA', '15:00', '1', 'SATU DUA TIGA', '1', 10, 20, 30, 40, '2', 10, 20, 30, 40, '8', 10, 20, 30, 40, '15/11/2018', '15/12/2018', NULL, 'kti', 10, 20, 30, 40, NULL, NULL, 6),
(9, 41140023, 'TESTS', '15:00', '3', 'EDIT JUDUL OUTLINE', '3', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, '7', NULL, NULL, NULL, NULL, '17/10/2018', '17/11/2018', NULL, 'kti', NULL, NULL, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kurikulum`
--

CREATE TABLE `kurikulum` (
  `id_kurikulum` int(5) NOT NULL,
  `kurikulum` int(10) NOT NULL,
  `tahun_berlaku` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` int(8) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `id_angkatan` int(3) NOT NULL,
  `id_gender` int(3) NOT NULL,
  `id_semester` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama`, `id_angkatan`, `id_gender`, `id_semester`) VALUES
(41120001, 'SHIRO', 4, 1, 1),
(41140002, 'NAMA MAHASISWA', 6, 1, 2),
(41140023, 'TESTS', 1, 2, 1),
(41140051, 'RUBEN ONSU', 6, 2, 1);

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
  `dosen1` varchar(100) DEFAULT NULL,
  `dosen2` varchar(100) DEFAULT NULL,
  `verified` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `outline`
--

INSERT INTO `outline` (`id_outline`, `nim`, `judul_outline`, `pertanyaan_penelitian`, `manfaat_penelitian`, `desain_penelitian`, `sample_penelitian`, `variabel_bebas`, `variabel_tergantung`, `hipotesis`, `usulan_dosen1`, `usulan_dosen2`, `tgl_pengajuan`, `tgl_disetujui`, `dosen1`, `dosen2`, `verified`) VALUES
(17, 41140023, 'EDIT JUDUL OUTLINE', 'PERTANYAAN OUTLINE YANG HARUS DIPAHAMI', 'MANFAAT DARI PENELITIAN', 'DESAIN PENELITIAN', 'SAMPLE PENELITIAN', 'VARIABEL BEBAS', 'VARIABEL TERGANTUNG', 'HIPOTESIS 1', '3', '2', '15/08/2018', '06/09/2018', '3', '1', 'Terverifikasi'),
(18, 41120001, 'OUTLINE SAYA BUNDAR', '2', '2', '2', '2', '2', '2', '2', '2', '1', '17/08/2018', '06/09/2018', '9', '8', 'Terverifikasi'),
(20, 41140051, 'JUDUL PENELITIAN', 'PERTANYAAN', 'MANFAAT', 'DESAIN', 'SAMPLE', 'BEBAS\r\n', 'TERGANTUNG', 'HIPOTESIS', '1', '2', '20/08/2018', '21/08/2018', '11', '5', 'belum terverifikasi'),
(23, 41140002, 'SATU DUA TIGA', '1', '1', '1', '1', '1', '1', '1', '1', '2', '17/08/2018', '13/09/2018', '1', '2', 'Terverifikasi');

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
  `id_angkatan` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `proposal`
--

INSERT INTO `proposal` (`id_proposal`, `nim`, `nama`, `waktupelaksanaan`, `ruangsidang`, `judulproposal`, `dosen1`, `dosen2`, `penguji`, `tgl_sidangproposal`, `batas_sidangkti`, `status`, `id_angkatan`) VALUES
(24, 41120001, 'SHIRO', '13:00', '2', 'OUTLINE SAYA BUNDAR OUTLINE SAYA BUNDAR OUTLINE SAYA BUNDAR OUTLINE SAYA BUNDAR OUTLINE SAYA BUNDAR OUTLINE SAYA BUNDAR OUTLINE SAYA BUNDAR OUTLINE SAYA BUNDAR OUTLINE SAYA BUNDAR OUTLINE SAYA BUNDAR OUTLINE SAYA BUNDAR OUTLINE SAYA BUNDAR OUTLINE SAYA BU', '9', '8', '13', '06/09/2018', '06/3/2019', 'proposal', 4),
(25, 41140002, 'NAMA MAHASISWA', '15:00', '1', 'SATU DUA TIGA', '1', '2', '8', '21/09/2018', '21/3/2019', 'proposal', 6),
(26, 41140023, 'TESTS', '13:00', '2', 'EDIT JUDUL OUTLINE', '3', '1', '7', '28/09/2018', '28/3/2019', 'proposal', 1);

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
(2, 'Genap 2017/2018');

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
  `id_angkatan` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `semhas`
--

INSERT INTO `semhas` (`id_semhas`, `nim`, `nama`, `waktupelaksanaan`, `ruangsidang`, `judulKTI`, `dosen1`, `dosen2`, `penguji`, `tgl_seminarhasil`, `status`, `id_angkatan`) VALUES
(25, 41120001, 'SHIRO', '13:00', '3', 'OUTLINE SAYA BUNDAR OUTLINE SAYA BUNDAR OUTLINE SAYA BUNDAR OUTLINE SAYA BUNDAR OUTLINE SAYA BUNDAR OUTLINE SAYA BUNDAR OUTLINE SAYA BUNDAR OUTLINE SAYA BUNDAR OUTLINE SAYA BUNDAR OUTLINE SAYA BUNDAR OUTLINE SAYA BUNDAR OUTLINE SAYA BUNDAR OUTLINE SAYA BU', '9', '8', '13', '20/09/2018', 'semhas', 4),
(26, 41140002, 'NAMA MAHASISWA', '13:00', '1', 'SATU DUA TIGA', '1', '2', '8', '06/10/2018', 'semhas', 6),
(27, 41140023, 'TESTS', '13:00', '3', 'EDIT JUDUL OUTLINE', '3', '1', '7', '05/10/2018', 'semhas', 1);

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

-- --------------------------------------------------------

--
-- Table structure for table `yudisium`
--

CREATE TABLE `yudisium` (
  `id_yudisium` int(10) NOT NULL,
  `nim` int(8) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tgl_kumpulberkas` date NOT NULL,
  `tgl_yudisium` date NOT NULL,
  `gender` varchar(20) NOT NULL,
  `beritaacara` varchar(255) NOT NULL,
  `ICE` varchar(255) NOT NULL,
  `bebaspustaka` varchar(255) NOT NULL,
  `bebaslab` varchar(255) NOT NULL,
  `transkripnilai` varchar(255) NOT NULL,
  `tahunajaran` varchar(10) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `ipk` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `angkatan`
--
ALTER TABLE `angkatan`
  ADD PRIMARY KEY (`id_angkatan`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id_dosen`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`id_gender`);

--
-- Indexes for table `kti`
--
ALTER TABLE `kti`
  ADD PRIMARY KEY (`id_kti`);

--
-- Indexes for table `kurikulum`
--
ALTER TABLE `kurikulum`
  ADD PRIMARY KEY (`id_kurikulum`);

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
-- Indexes for table `yudisium`
--
ALTER TABLE `yudisium`
  ADD PRIMARY KEY (`id_yudisium`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `angkatan`
--
ALTER TABLE `angkatan`
  MODIFY `id_angkatan` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id_dosen` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `kti`
--
ALTER TABLE `kti`
  MODIFY `id_kti` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `kurikulum`
--
ALTER TABLE `kurikulum`
  MODIFY `id_kurikulum` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `outline`
--
ALTER TABLE `outline`
  MODIFY `id_outline` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `proposal`
--
ALTER TABLE `proposal`
  MODIFY `id_proposal` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `ruangsidang`
--
ALTER TABLE `ruangsidang`
  MODIFY `id_ruang` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `semhas`
--
ALTER TABLE `semhas`
  MODIFY `id_semhas` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `yudisium`
--
ALTER TABLE `yudisium`
  MODIFY `id_yudisium` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
