-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Okt 2023 pada 17.05
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pulsa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `agen`
--

CREATE TABLE `agen` (
  `id_agen` int(11) NOT NULL,
  `nama_agen` varchar(255) NOT NULL,
  `alamat_agen` text NOT NULL,
  `tlp` varchar(255) NOT NULL,
  `nama_pemilik` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `agen`
--

INSERT INTO `agen` (`id_agen`, `nama_agen`, `alamat_agen`, `tlp`, `nama_pemilik`) VALUES
(1, 'PulsaNYA', 'Tellang Bangkalan Jawa Timur', '08312323123', 'Dina');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `id_login` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `pass` char(32) NOT NULL,
  `id_member` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`id_login`, `user`, `pass`, `id_member`) VALUES
(1, 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `member`
--

CREATE TABLE `member` (
  `id_member` int(11) NOT NULL,
  `nm_member` varchar(255) NOT NULL,
  `alamat_member` text NOT NULL,
  `telepon` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gambar` text NOT NULL,
  `NIK` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `member`
--

INSERT INTO `member` (`id_member`, `nm_member`, `alamat_member`, `telepon`, `email`, `gambar`, `NIK`) VALUES
(1, 'Dina', 'Bangkalan', '08231231232', 'dina@gmail.com', '1697273129wal.jpg', '39821932321381');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nota`
--

CREATE TABLE `nota` (
  `id_nota` int(11) NOT NULL,
  `id_pulsa` varchar(10) NOT NULL,
  `id_member` int(11) NOT NULL,
  `harga_awal` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `tanggal_input` date NOT NULL,
  `periode` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nota`
--

INSERT INTO `nota` (`id_nota`, `id_pulsa`, `id_member`, `harga_awal`, `total`, `tanggal_input`, `periode`) VALUES
(9, 'PA-100000', 1, 100000, 102000, '2023-10-01', '2023-10-15'),
(10, 'PA-100000', 1, 100000, 102000, '2023-10-15', '2023-10-15'),
(11, 'PX-10000', 1, 10000, 12000, '2023-10-15', '2023-10-15'),
(12, 'PT-25000', 1, 25000, 27000, '2023-10-15', '2023-10-15'),
(13, 'PI-10000', 1, 10000, 12000, '2023-10-15', '2023-10-15'),
(14, 'PT-100000', 1, 100000, 102000, '2023-10-15', '2023-10-15'),
(15, 'PX-5000', 1, 5000, 7000, '2023-10-15', '2023-10-15'),
(16, 'PT-5000', 1, 5000, 7000, '2023-10-15', '2023-10-15'),
(17, 'PT-100000', 1, 100000, 102000, '2023-10-15', '2023-10-15'),
(18, 'PX-5000', 1, 5000, 7000, '2023-10-15', '2023-10-15'),
(19, 'PT-5000', 1, 5000, 7000, '2023-10-15', '2023-10-15'),
(20, 'PT-10000', 1, 10000, 12000, '2023-10-15', '2023-10-15'),
(21, 'PT-10000', 1, 10000, 12000, '2023-10-15', '2023-10-15'),
(22, 'PT-10000', 1, 10000, 12000, '2023-10-15', '2023-10-15'),
(23, 'PT-10000', 1, 10000, 12000, '2023-10-15', '2023-10-15'),
(24, 'PT-10000', 1, 10000, 12000, '2023-10-15', '2023-10-15'),
(25, 'PT-10000', 1, 10000, 12000, '2023-10-15', '2023-10-15'),
(26, 'PT-10000', 1, 10000, 12000, '2023-10-15', '2023-10-15'),
(27, 'PT-10000', 1, 10000, 12000, '2023-10-15', '2023-10-15'),
(28, 'PT-100000', 1, 100000, 102000, '2023-10-15', '2023-10-15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `operator_seluler`
--

CREATE TABLE `operator_seluler` (
  `id_operator` int(11) NOT NULL,
  `nama_operator` varchar(255) NOT NULL,
  `tgl_input` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `operator_seluler`
--

INSERT INTO `operator_seluler` (`id_operator`, `nama_operator`, `tgl_input`) VALUES
(1, 'Telkomsel', '2023-10-14'),
(2, 'Axis', '2023-10-14'),
(3, 'Indosat', '2023-10-14'),
(4, 'XL', '2023-10-14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `id_pulsa` varchar(10) NOT NULL,
  `id_member` int(11) NOT NULL,
  `harga_awal` int(11) NOT NULL,
  `total` varchar(255) NOT NULL,
  `tanggal_input` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pulsa`
--

CREATE TABLE `pulsa` (
  `id` int(11) NOT NULL,
  `id_pulsa` varchar(10) NOT NULL,
  `id_operator` int(11) NOT NULL,
  `pulsa_berapa` int(11) NOT NULL,
  `profit` int(11) NOT NULL,
  `tgl_input` date NOT NULL,
  `tgl_update` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pulsa`
--

INSERT INTO `pulsa` (`id`, `id_pulsa`, `id_operator`, `pulsa_berapa`, `profit`, `tgl_input`, `tgl_update`) VALUES
(4, 'PT-5000', 1, 5000, 2000, '2023-10-01', NULL),
(5, 'PT-10000', 1, 10000, 2000, '2023-10-14', NULL),
(6, 'PT-15000', 1, 15000, 2000, '2023-10-14', NULL),
(7, 'PT-25000', 1, 25000, 2000, '2023-10-14', NULL),
(8, 'PT-50000', 1, 50000, 2000, '2023-10-14', NULL),
(9, 'PT-100000', 1, 100000, 2000, '2023-10-14', NULL),
(10, 'PA-5000', 2, 5000, 2000, '2023-10-14', NULL),
(11, 'PA-10000', 2, 10000, 2000, '2023-10-14', NULL),
(12, 'PA-15000', 2, 15000, 2000, '2023-10-14', NULL),
(13, 'PA-25000', 2, 25000, 2000, '2023-10-14', NULL),
(14, 'PA-50000', 2, 50000, 2000, '2023-10-14', NULL),
(15, 'PA-100000', 2, 100000, 2000, '2023-10-14', NULL),
(16, 'PI-5000', 3, 5000, 2000, '2023-10-14', NULL),
(17, 'PI-10000', 3, 10000, 2000, '2023-10-14', NULL),
(18, 'PI-15000', 3, 15000, 2000, '2023-10-14', NULL),
(19, 'PI-25000', 3, 25000, 2000, '2023-10-14', NULL),
(20, 'PI-50000', 3, 50000, 2000, '2023-10-14', NULL),
(21, 'PI-100000', 3, 100000, 2000, '2023-10-14', NULL),
(22, 'PX-5000', 4, 5000, 2000, '2023-10-14', NULL),
(23, 'PX-10000', 4, 10000, 2000, '2023-10-14', NULL),
(24, 'PX-15000', 4, 15000, 2000, '2023-10-14', NULL),
(25, 'PX-25000', 4, 25000, 2000, '2023-10-14', NULL),
(26, 'PX-50000', 4, 50000, 2000, '2023-10-14', NULL),
(27, 'PX-100000', 4, 100000, 2000, '2023-10-14', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `saldo`
--

CREATE TABLE `saldo` (
  `id_saldo` int(11) NOT NULL,
  `saldo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `saldo`
--

INSERT INTO `saldo` (`id_saldo`, `saldo`) VALUES
(1, 1002000);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `agen`
--
ALTER TABLE `agen`
  ADD PRIMARY KEY (`id_agen`);

--
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`);

--
-- Indeks untuk tabel `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indeks untuk tabel `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`id_nota`);

--
-- Indeks untuk tabel `operator_seluler`
--
ALTER TABLE `operator_seluler`
  ADD PRIMARY KEY (`id_operator`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indeks untuk tabel `pulsa`
--
ALTER TABLE `pulsa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `saldo`
--
ALTER TABLE `saldo`
  ADD PRIMARY KEY (`id_saldo`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `agen`
--
ALTER TABLE `agen`
  MODIFY `id_agen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `member`
--
ALTER TABLE `member`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `nota`
--
ALTER TABLE `nota`
  MODIFY `id_nota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `operator_seluler`
--
ALTER TABLE `operator_seluler`
  MODIFY `id_operator` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `pulsa`
--
ALTER TABLE `pulsa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `saldo`
--
ALTER TABLE `saldo`
  MODIFY `id_saldo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
