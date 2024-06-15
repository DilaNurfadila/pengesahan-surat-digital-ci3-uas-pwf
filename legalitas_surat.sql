-- phpMyAdmin SQL Dump
-- version 5.2.1deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 14, 2024 at 06:11 PM
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
  `keterangan` varchar(100) DEFAULT NULL,
  `kunci` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengesahan`
--

INSERT INTO `pengesahan` (`id_legalisir`, `id_surat`, `nama_pembuat`, `nama_pemeriksa`, `nama_penandatangan`, `tanggal_dibuat`, `tanggal_diperiksa`, `tanggal_ditandatangan`, `keterangan`, `kunci`) VALUES
(23, 35, 'Raden Sukmana', 'Indiyani Lestari', 'Alzena Cikal Bhagaskara', '2024-06-14 11:02:03', '2024-06-14 12:16:39', '2024-06-14 12:17:54', NULL, 'P6FGEOGTZ5'),
(24, 36, 'Muhammad Fauzan Fadilah', 'Nurfadila', 'Indiyani Lestari', '2024-06-14 11:07:10', '2024-06-14 11:16:51', '2024-06-14 11:19:33', NULL, '2G0J2QITFP'),
(25, 37, 'Beni Ramdani', 'Indiyani Lestari', 'Indiyani Lestari', '2024-06-14 11:11:27', '2024-06-14 12:13:07', NULL, 'Perbaiki perihal suratnya', NULL),
(26, 38, 'Beni Ramdani', 'Nurfadila', 'Nurfadila', '2024-06-14 16:45:22', NULL, NULL, NULL, NULL),
(27, 39, 'Beni Ramdani', 'Nurfadila', 'Nurfadila', '2024-06-14 16:53:46', '2024-06-14 16:55:00', '2024-06-14 16:55:37', NULL, 'GVXK6WBKIU'),
(29, 41, 'Beni Ramdani', 'Indiyani Lestari', 'Nurfadila', '2024-06-14 17:43:37', NULL, NULL, NULL, NULL);

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
  `nomor_agenda` varchar(50) DEFAULT NULL,
  `tanggal_agenda` datetime NOT NULL,
  `tujuan_surat` varchar(100) NOT NULL,
  `perihal_surat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surat`
--

INSERT INTO `surat` (`id_surat`, `id_user`, `jenis_surat`, `judul_surat`, `file_surat`, `tanggal_surat`, `status_surat`, `nomor_agenda`, `tanggal_agenda`, `tujuan_surat`, `perihal_surat`) VALUES
(35, 20, 'Undangan', 'Surat Undangan Pembagian PDH', '034_Surat_Undangan_Pembagian_PDH_Teknik_(Ketua_Angkatan_22)-13.pdf', '2024-06-14 06:00:00', 'Disetujui', '13579acegi', '2024-06-21 13:30:00', 'Mahasiswa Fakultas Teknik Universitas Langlangbuana', 'Pembagian PDH Teknik'),
(36, 21, 'Undangan', 'Kegiatan Workshop Kewirausahaan', '1735_Kegiatan_Workshop_Kewirausahaan.pdf', '2024-06-13 06:00:00', 'Disetujui', '123abc', '2024-06-13 09:30:00', 'Mahasiswa Universitas Langlangbuana', 'Undangan'),
(37, 19, 'Surat Izin', 'Surat Izin Orang Tua - Wali LC 2024', '1735_Kegiatan_Workshop_Kewirausahaan1.pdf', '2024-06-14 06:00:00', 'Ditolak', NULL, '2024-06-16 08:00:00', 'Orang Tua - Wali Mahasiswa', 'Surat Izin'),
(39, 19, 'sdf', 'asdf', '034_Surat_Undangan_Pembagian_PDH_Teknik_(Ketua_Angkatan_22)-1_71TWVFX01Z.pdf', '2024-06-14 23:53:00', 'Disetujui', 'abc123', '2024-06-20 23:50:00', 'asdf', 'asdf'),
(41, 19, 'vbn', 'zxc', '1735_Kegiatan_Workshop_Kewirausahaan2_ALKPUS80YN.pdf', '2024-06-15 00:42:00', 'Menunggu', NULL, '2024-06-20 12:00:00', 'asd', 'fgh');

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
(14, 'Superadmin', 'superadmin@gmail.com', '$2y$10$1sRZNIgZIC5BfN4ItChcO.6zwRGIq5uZTz/5pXdK1z0ymOh.5ytR.', 'Jakarta', '0123789456', 'default.png', 'Dekan', 'Superadmin', 1),
(15, 'John Doe', 'johndoe@gmail.com', '$2y$10$vN4rtpXNWl.QU118wwuW7um./B.8kQ04ywAxQdNvxMZWqc/q/owdq', 'Bandung', '081231473698', 'default.png', 'Kepala TU', 'Admin', 1),
(16, 'Nurfadila', 'nurfadila@gmail.com', '$2y$10$vxXPHkAyx1LYiuPsrbqvqua416Mnkt0JywqpZK5ByNrVQb17YsvSa', 'Bandung', '08789123459', 'cat-4_GUHM7KYN3V.png', 'Wakil Dekan I', 'Penandatangan', 1),
(17, 'Indiyani Lestari', 'indiyani@gmail.com', '$2y$10$VLQ9pk802TnCjv688DBiAe4Sc2jEy5ImWVxyeIOyVmt5Xngyu7f5S', 'Garut', '08799966155', 'cat-2_MLAL4KCB89.png', 'Wakil Dekan II', 'Penandatangan', 1),
(18, 'Alzena Cikal Bhagaskara', 'alzena@gmail.com', '$2y$10$LvkvMy4baDgMEi2tx6hizufEG449IwnmOWib9p2Lkzs/rRZM/M0.S', 'Bandung', '0123789456', 'default.png', 'Wakil Dekan III', 'Penandatangan', 1),
(19, 'Beni Ramdani', 'beni@gmail.com', '$2y$10$l0reRWasF3D24Zh9ojYW4eucM8sqQJcHH0Gjz9T.dMctG7voSJKPO', 'Bandung', '08258147361', 'cat-4_PY3HFIZEIN.png', 'Pegawai TU', 'Pembuat', 1),
(20, 'Raden Sukmana', 'raden@gmail.com', '$2y$10$ESxVuOEVIeccIltfK9slZuxtyVg.g2gRux1IxL/HgmEZNgosH.ktS', 'Bandung', '08456123789', 'default.png', 'Dosen', 'Pembuat', 1),
(21, 'Muhammad Fauzan Fadilah', 'fadil@gmail.com', '$2y$10$OVUp6ecEQXmf6WXdKNyGBeV.hhHg4yK5YIcj/fVFNj6xLeCLJFTWi', 'Bandung', '08147369258', 'default.png', 'Dosen', 'Pembuat', 1),
(22, 'Kane Doe', 'kanedoe@gmail.com', '$2y$10$haUVjxNz8ma4Iydcam/h7ehRpuK3A7g2CfwEZzQB9SvsHTx55KdUu', 'Yogyakarta', '08258369147', 'default.png', 'Dosen', 'Pembuat', 0);

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
  MODIFY `id_legalisir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `surat`
--
ALTER TABLE `surat`
  MODIFY `id_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
