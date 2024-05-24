-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Bulan Mei 2024 pada 20.14
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.1.12

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
-- Struktur dari tabel `pengesahan`
--

CREATE TABLE `pengesahan` (
  `id_legalisir` int(11) NOT NULL,
  `pengaju` int(11) NOT NULL,
  `penandatangan` int(11) NOT NULL,
  `file_surat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat`
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

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `posisi` varchar(50) NOT NULL,
  `user_role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama_lengkap`, `email`, `password`, `alamat`, `no_hp`, `posisi`, `user_role`) VALUES
(8, 'Raden Sukmana', 'esarekan@gmail.com', '$2y$10$7zrhsFawwuHSQ2Yc4ft1Iu9v4UNTXfg50vVspbMV94lFl6BHb2VbO', 'Bandung', '012312412412', 'Pekerja Kantor', 'Admin'),
(9, 'Admin', 'admin@gmail.com', '$2y$10$MSHTj/Q3oCqb7Gu9RqyzwetsYuXAZxTP4TThVW7d1WOpoISfmno/S', 'Bandung', '0123456789', 'Dosen', 'Pekerja');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pengesahan`
--
ALTER TABLE `pengesahan`
  ADD PRIMARY KEY (`id_legalisir`);

--
-- Indeks untuk tabel `surat`
--
ALTER TABLE `surat`
  ADD PRIMARY KEY (`id_surat`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pengesahan`
--
ALTER TABLE `pengesahan`
  MODIFY `id_legalisir` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `surat`
--
ALTER TABLE `surat`
  MODIFY `id_surat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
