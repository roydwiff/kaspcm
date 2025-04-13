-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Apr 2025 pada 16.38
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kaspcm`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_kas`
--

CREATE TABLE `data_kas` (
  `idKas` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` varchar(50) NOT NULL,
  `jenis` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_kas`
--

INSERT INTO `data_kas` (`idKas`, `keterangan`, `tanggal`, `jumlah`, `jenis`) VALUES
(30000002, 'Iuran warga mingguan', '2021-07-01', '5900001', 'masuk'),
(30000003, 'iuran warga bulanan', '2021-07-03', '7800000', 'masuk'),
(30000004, 'pembelian dispenser', '2021-07-04', '560000', 'keluar'),
(30000005, 'pembelian atk', '2021-07-04', '100000', 'keluar'),
(30000006, 'Lomba agustus', '2021-07-14', '3000000', 'keluar'),
(30000007, 'baju', '2025-04-11', '1002', 'masuk'),
(30000008, 'ss', '2025-04-10', '2000', 'masuk'),
(30000009, '200', '2025-04-10', '1000', 'masuk');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_kas1`
--

CREATE TABLE `data_kas1` (
  `idKas1` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` varchar(50) NOT NULL,
  `jenis` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_kas1`
--

INSERT INTO `data_kas1` (`idKas1`, `keterangan`, `tanggal`, `jumlah`, `jenis`) VALUES
(40000001, 'dd', '2025-04-11', '12344', 'masuk'),
(40000002, 'asdau', '2025-04-11', '1003', 'keluar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_kredit`
--

CREATE TABLE `tabel_kredit` (
  `id` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `jumlah` decimal(10,2) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(150) NOT NULL,
  `img` varchar(50) NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `role_id` tinyint(4) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `user`, `username`, `password`, `img`, `is_active`, `role_id`, `email`) VALUES
(3, 'Administrator', 'admin', '$2y$10$6v.9Z.2QHCs9yZxgCM5.cu3L0ltG.8/5ma5Fs5vr6KS9yQnNjg/M2', 'admin.png', 1, 1, 'admin@admin.com'),
(5, 'Audia', 'unit1', '$2y$10$ycE4xuYDRoaFHD4mPwkf7.KHV2wbbkHq14NInU4FS4ADQgPZz1MjK', 'user2.png', 1, 3, 'audia@gmail.com'),
(13, 'urdi', 'unit2', '$2y$10$UKYn3XZ6WRq5EWwrh1UPi.K8zqPZ80VYCTJDsAxDxMHqQS74.75EG', 'avatar.png', 1, 5, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Admin'),
(3, 'Unit1'),
(5, 'Unit2');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `data_kas`
--
ALTER TABLE `data_kas`
  ADD PRIMARY KEY (`idKas`);

--
-- Indeks untuk tabel `data_kas1`
--
ALTER TABLE `data_kas1`
  ADD PRIMARY KEY (`idKas1`);

--
-- Indeks untuk tabel `tabel_kredit`
--
ALTER TABLE `tabel_kredit`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data_kas`
--
ALTER TABLE `data_kas`
  MODIFY `idKas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30000010;

--
-- AUTO_INCREMENT untuk tabel `data_kas1`
--
ALTER TABLE `data_kas1`
  MODIFY `idKas1` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40000003;

--
-- AUTO_INCREMENT untuk tabel `tabel_kredit`
--
ALTER TABLE `tabel_kredit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
