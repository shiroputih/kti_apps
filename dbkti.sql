-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2018 at 08:38 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbkti`
--

-- --------------------------------------------------------

--
-- Table structure for table `angkatan`
--

CREATE TABLE IF NOT EXISTS `angkatan` (
  `id_angkatan` int(4) NOT NULL,
  `angkatan` int(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

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

CREATE TABLE IF NOT EXISTS `dosen` (
  `id_dosen` int(5) NOT NULL,
  `nama_dosen` varchar(200) NOT NULL,
  `gelar_depan` varchar(30) NOT NULL,
  `gelar_belakang` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE IF NOT EXISTS `gender` (
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

CREATE TABLE IF NOT EXISTS `kti` (
  `id_kti` int(5) NOT NULL,
  `nim` int(8) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `waktupelaksanaan` varchar(10) NOT NULL,
  `ruangsidang` varchar(100) NOT NULL,
  `judulkti` varchar(255) NOT NULL,
  `dosen1` varchar(100) NOT NULL,
  `dosen2` varchar(100) NOT NULL,
  `penguji` varchar(100) NOT NULL,
  `tgl_sidangkti` date NOT NULL,
  `batas_pengumpulan` date NOT NULL,
  `status` varchar(10) NOT NULL,
  `penulisanisi` int(2) NOT NULL,
  `metodologi` int(2) NOT NULL,
  `penguasaanmateri` int(2) NOT NULL,
  `materidanpresentasi` int(2) NOT NULL,
  `berita_acara` varchar(255) NOT NULL,
  `id_kurikulum` int(5) NOT NULL,
  `id_angkatan` int(5) NOT NULL,
  `id_semester` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kurikulum`
--

CREATE TABLE IF NOT EXISTS `kurikulum` (
  `id_kurikulum` int(5) NOT NULL,
  `kurikulum` int(10) NOT NULL,
  `tahun_berlaku` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE IF NOT EXISTS `mahasiswa` (
  `nim` int(8) NOT NULL,
  `nama` int(200) NOT NULL,
  `id_angkatan` int(3) NOT NULL,
  `id_gender` int(3) NOT NULL,
  `id_semester` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `outline`
--

CREATE TABLE IF NOT EXISTS `outline` (
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
  `scan_formoutline` varchar(255) NOT NULL,
  `tgl_pengajuan` datetime(6) NOT NULL,
  `tgl_disetujui` datetime(6) NOT NULL,
  `pemeriksa` varchar(255) NOT NULL,
  `dosen1` varchar(100) NOT NULL,
  `dosen2` varchar(100) NOT NULL,
  `id_kurikulum` int(5) NOT NULL,
  `id_semester` int(5) NOT NULL,
  `id_angkatan` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `proposal`
--

CREATE TABLE IF NOT EXISTS `proposal` (
  `id_proposal` int(5) NOT NULL,
  `nim` int(8) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `waktupelaksanaan` varchar(10) NOT NULL,
  `ruangsidang` varchar(100) NOT NULL,
  `judulproposal` varchar(255) NOT NULL,
  `dosen1` varchar(100) NOT NULL,
  `dosen2` varchar(100) NOT NULL,
  `penguji` varchar(100) NOT NULL,
  `tgl_sidangproposal` date NOT NULL,
  `batas_sidangkti` date NOT NULL,
  `status` varchar(10) NOT NULL,
  `scanberita_acaraproposal` varchar(255) NOT NULL,
  `id_kurikulum` int(5) NOT NULL,
  `id_angkatan` int(5) NOT NULL,
  `id_semester` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ruangsidang`
--

CREATE TABLE IF NOT EXISTS `ruangsidang` (
  `id_ruang` int(5) NOT NULL,
  `ruangsidang` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE IF NOT EXISTS `semester` (
  `id_semester` int(1) NOT NULL,
  `semester` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`id_semester`, `semester`) VALUES
(1, 'Gasal'),
(2, 'Genap');

-- --------------------------------------------------------

--
-- Table structure for table `semhas`
--

CREATE TABLE IF NOT EXISTS `semhas` (
  `id_semhas` int(5) NOT NULL,
  `nim` int(8) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `waktupelaksanaan` varchar(10) NOT NULL,
  `ruangsidang` varchar(100) NOT NULL,
  `judulKTI` varchar(255) NOT NULL,
  `dosen1` varchar(100) NOT NULL,
  `dosen2` varchar(100) NOT NULL,
  `penguji` varchar(100) NOT NULL,
  `tgl_seminarhasil` date NOT NULL,
  `status` varchar(10) NOT NULL,
  `scanberita_acarasemhas` varchar(255) NOT NULL,
  `id_kurikulum` int(5) NOT NULL,
  `id_angkatan` int(5) NOT NULL,
  `id_semester` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tahunajaran`
--

CREATE TABLE IF NOT EXISTS `tahunajaran` (
  `id_TA` int(4) NOT NULL,
  `tahunajaran` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(3) NOT NULL,
  `nama_user` varchar(200) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `last_login` datetime(6) NOT NULL,
  `login_as` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `yudisium`
--

CREATE TABLE IF NOT EXISTS `yudisium` (
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
  MODIFY `id_angkatan` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id_dosen` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kti`
--
ALTER TABLE `kti`
  MODIFY `id_kti` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kurikulum`
--
ALTER TABLE `kurikulum`
  MODIFY `id_kurikulum` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `outline`
--
ALTER TABLE `outline`
  MODIFY `id_outline` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `proposal`
--
ALTER TABLE `proposal`
  MODIFY `id_proposal` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ruangsidang`
--
ALTER TABLE `ruangsidang`
  MODIFY `id_ruang` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `semhas`
--
ALTER TABLE `semhas`
  MODIFY `id_semhas` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `yudisium`
--
ALTER TABLE `yudisium`
  MODIFY `id_yudisium` int(10) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
