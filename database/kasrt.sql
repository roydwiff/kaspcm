-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Jul 2024 pada 09.34
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasrt`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_kas`
--

INSERT INTO `data_kas` (`idKas`, `keterangan`, `tanggal`, `jumlah`, `jenis`) VALUES
(30000001, 'Beli Printer L5190', '2021-07-01', '3750000', 'keluar'),
(30000002, 'Iuran warga mingguan', '2021-07-01', '5900000', 'masuk'),
(30000003, 'iuran warga bulanan', '2021-07-03', '7800000', 'masuk'),
(30000004, 'pembelian dispenser', '2021-07-04', '560000', 'keluar'),
(30000005, 'pembelian atk', '2021-07-04', '100000', 'keluar'),
(30000006, 'Lomba agustus', '2021-07-14', '3000000', 'keluar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_warga`
--

CREATE TABLE `data_warga` (
  `idWarga` int(11) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jekel` varchar(20) NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_warga`
--

INSERT INTO `data_warga` (`idWarga`, `nik`, `nama`, `jekel`, `tempat_lahir`, `tanggal_lahir`, `alamat`) VALUES
(1, '111222333444555', 'Yohan Riki', 'laki-laki', 'Pati', '1996-10-16', 'Cilincing, Jakarta Utara'),
(3, '222333111444555', 'Ahmad Sidiq', 'laki-laki', 'Semarang', '1995-02-10', 'bekasi utara'),
(4, '1112221113334444', 'Echa Jesica', 'perempuan', 'Yogyakarta', '2000-02-16', 'bekasi utara'),
(5, '111222111222444', 'Rudi Hidayat', 'laki-laki', 'Pati', '1999-06-09', 'Jakarta Utara'),
(6, '333222111444555', 'Elisabet', 'perempuan', 'Semarang', '2001-06-07', 'Jakarta Utara');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_kredit`
--

CREATE TABLE `tabel_kredit` (
  `id` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `jumlah` decimal(10,2) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `user`, `username`, `password`, `img`, `is_active`, `role_id`, `email`) VALUES
(3, 'Administrator', 'admin', '$2y$10$6v.9Z.2QHCs9yZxgCM5.cu3L0ltG.8/5ma5Fs5vr6KS9yQnNjg/M2', 'admin.png', 1, 1, 'admin@admin.com'),
(4, 'Avika', 'avika', '$2y$10$WTyCYym4wxsRhSbEr093G.UFxyfEBwkH9D/A0j5Zn3JqLpthPc5XW', 'user3.png', 1, 2, 'avika@gmail.com'),
(5, 'Audia', 'audia', '$2y$10$Eehpk2YyoS7agkOHMMtw0eF/WUmudl8gGRjpVNRXH/qH/MQxN.A72', 'user2.png', 1, 3, 'audia@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'RT'),
(3, 'Bendahara');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `data_kas`
--
ALTER TABLE `data_kas`
  ADD PRIMARY KEY (`idKas`);

--
-- Indeks untuk tabel `data_warga`
--
ALTER TABLE `data_warga`
  ADD PRIMARY KEY (`idWarga`);

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
  MODIFY `idKas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30000007;

--
-- AUTO_INCREMENT untuk tabel `data_warga`
--
ALTER TABLE `data_warga`
  MODIFY `idWarga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tabel_kredit`
--
ALTER TABLE `tabel_kredit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
