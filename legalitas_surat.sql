-- phpMyAdmin SQL Dump
-- version 5.2.1deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 31, 2024 at 01:41 PM
-- Server version: 10.11.6-MariaDB-0+deb12u1
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `legalitas_surat`
--

-- --------------------------------------------------------

--
-- Table structure for table `pengesahan`
--

CREATE TABLE `pengesahan` (
  `id_legalisir` int(11) NOT NULL,
  `id_surat` int(11) NOT NULL,
  `nama_pembuat` varchar(50) NOT NULL,
  `nama_pemeriksa` varchar(50) NOT NULL,
  `nama_penandatangan` varchar(50) NOT NULL,
  `tanggal_dibuat` timestamp NOT NULL DEFAULT current_timestamp(),
  `tanggal_diperiksa` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `tanggal_ditandatangan` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `kunci` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengesahan`
--

INSERT INTO `pengesahan` (`id_legalisir`, `id_surat`, `nama_pembuat`, `nama_pemeriksa`, `nama_penandatangan`, `tanggal_dibuat`, `tanggal_diperiksa`, `tanggal_ditandatangan`, `kunci`) VALUES
(13, 23, 'Admin', 'John', 'Doe', '2024-05-30 13:47:57', '2024-05-31 05:30:00', '2024-05-31 05:30:34', 'BDYPH3DEEN'),
(15, 25, 'Admin', 'Nurfadila', 'John', '2024-05-30 13:50:34', '2024-05-30 15:18:31', '2024-05-30 15:18:31', 'RW17OTMSLN'),
(16, 26, 'Admin', 'Nurfadila', 'Doe', '2024-05-30 13:51:13', '2024-05-30 15:43:44', '2024-05-30 15:43:44', 'W3GCG6B7AW'),
(17, 27, 'Admin', 'Nurfadila', 'John', '2024-05-30 16:31:51', NULL, NULL, NULL),
(18, 28, 'Doe', 'Nurfadila', 'Nurfadila', '2024-05-31 05:32:43', '2024-05-31 05:58:49', '2024-05-31 06:00:08', 'LZ9EQEY0VE');

-- --------------------------------------------------------

--
-- Table structure for table `surat`
--

CREATE TABLE `surat` (
  `id_surat` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `jenis_surat` varchar(50) NOT NULL,
  `judul_surat` varchar(50) NOT NULL,
  `file_surat` text NOT NULL,
  `tanggal_surat` datetime NOT NULL,
  `status_surat` varchar(20) NOT NULL DEFAULT 'Menunggu',
  `nomor_agenda` varchar(50) NOT NULL,
  `tanggal_agenda` datetime NOT NULL,
  `tujuan_surat` varchar(100) NOT NULL,
  `perihal_surat` varchar(50) NOT NULL,
  `permintaan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surat`
--

INSERT INTO `surat` (`id_surat`, `id_user`, `jenis_surat`, `judul_surat`, `file_surat`, `tanggal_surat`, `status_surat`, `nomor_agenda`, `tanggal_agenda`, `tujuan_surat`, `perihal_surat`, `permintaan`) VALUES
(23, 9, 'undangan', 'tes123', '034_Surat_Undangan_Pembagian_PDH_Teknik_(Ketua_Angkatan_22)-14.pdf', '2024-05-30 20:47:00', 'Disetujui', 'sekian', '2024-05-30 20:47:00', 'Langlangbuana', 'Undangan', ''),
(25, 9, 'undangan', 'tes135', '034_Surat_Undangan_Pembagian_PDH_Teknik_(Ketua_Angkatan_22)-15.pdf', '2024-05-30 20:49:00', 'Disetujui', 'sekian', '2024-05-30 20:49:00', 'Langlangbuana', 'Undangan', ''),
(26, 9, 'undangan', 'tes789', '034_Surat_Undangan_Pembagian_PDH_Teknik_(Ketua_Angkatan_22)-16.pdf', '2024-05-30 20:50:00', 'Disetujui', 'sekian', '2024-05-30 20:51:00', 'Langlangbuana', 'Undangan', ''),
(27, 9, 'undangan', 'tes12', 'TUGAS_KWH_23_24.pdf', '2024-05-08 11:10:25', 'Menunggu', 'sekian', '2024-06-02 08:00:00', 'Langlangbuana', 'Undangan', ''),
(28, 13, 'undangan', 'surat 1', '034_Surat_Undangan_Pembagian_PDH_Teknik_(Ketua_Angkatan_22)-19.pdf', '2024-05-31 12:31:00', 'Disetujui', 'sekian', '2024-06-15 13:00:00', 'Langlangbuana', 'Undangan', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `foto_profil` varchar(100) NOT NULL DEFAULT 'default.png',
  `posisi` varchar(50) NOT NULL,
  `user_role` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_lengkap`, `email`, `password`, `alamat`, `no_hp`, `foto_profil`, `posisi`, `user_role`, `status`) VALUES
(8, 'Raden Sukmana', 'esarekan@gmail.com', '$2y$10$7zrhsFawwuHSQ2Yc4ft1Iu9v4UNTXfg50vVspbMV94lFl6BHb2VbO', 'Bandung', '012312412412', 'default.png', 'Pekerja Kantor', 'Admin', 1),
(9, 'Admin', 'admin@gmail.com', '$2y$10$PxKG6/ZPVepYTVMMJkEcRubdAP8BuMqssm.NuXDEfJCpCoOPilSRq', 'Bandung', '0123456789', 'default.png', 'Dosen', 'Admin', 1),
(10, 'Nurfadila', 'nur@gmail.com', '$2y$10$m2K9XiW04khnLjCVNPkE0e0hIECn1Mltri/y76NKy.vG8XA8GFWYK', 'Bandung', '08146337555', 'default.png', 'Pegawai TU', 'Penandatangan', 1),
(12, 'John', 'john@gmail.com', '$2y$10$T4V0ryKVN4CtklU5g8ssqumtQ5imhbAj1UyhLCkV5jXEidouVkSNC', 'Bandung', '082666791334', 'default.png', 'Dosen', 'Pembuat', 1),
(13, 'Doe', 'doe@gmail.com', '$2y$10$UYlrs/THnnDcYI12yYaqqeVVJ.cGTX0mOt8YHELzLnnmxDlxdUSLa', 'Bandung', '087333111666', 'default.png', 'Dosen', 'Penandatangan', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pengesahan`
--
ALTER TABLE `pengesahan`
  ADD PRIMARY KEY (`id_legalisir`);

--
-- Indexes for table `surat`
--
ALTER TABLE `surat`
  ADD PRIMARY KEY (`id_surat`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pengesahan`
--
ALTER TABLE `pengesahan`
  MODIFY `id_legalisir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `surat`
--
ALTER TABLE `surat`
  MODIFY `id_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
