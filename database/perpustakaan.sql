-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Jul 2020 pada 14.19
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `ID_ANGGOTA` varchar(10) NOT NULL,
  `NAMA_ANGGOTA` varchar(50) DEFAULT NULL,
  `ALAMAT` varchar(255) DEFAULT NULL,
  `NO_TELP` decimal(12,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `ID_BUKU` varchar(10) NOT NULL,
  `ID_PETUGAS` varchar(10) NOT NULL,
  `JUDUL_BUKU` varchar(100) DEFAULT NULL,
  `PENGARANG` varchar(100) DEFAULT NULL,
  `PENERBIT` varchar(100) DEFAULT NULL,
  `GAMBAR_BUKU` varchar(100) NOT NULL,
  `TGL_MASUK` date DEFAULT NULL,
  `KET` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`ID_BUKU`, `ID_PETUGAS`, `JUDUL_BUKU`, `PENGARANG`, `PENERBIT`, `GAMBAR_BUKU`, `TGL_MASUK`, `KET`) VALUES
('BP001', 'PK001', 'Laskar Pelangi', 'Andrea Hirata', 'Erlangga', 'laskar-pelangi.jpg', '2020-07-12', 'Tersedia'),
('BP003', 'PK001', 'Edensor', 'Andrea Hirata', 'Gramedia', 'Edensor_sampul.jpg', '2020-07-12', 'Tersedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `id` int(5) NOT NULL,
  `USERNAME` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `id_role` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`id`, `USERNAME`, `password`, `id_role`) VALUES
(1, 'aminurachmaa', 'ami123', 1),
(2, 'yulviap', 'yulvi123', 2),
(3, 'anyes', 'anyes123', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `ID_PEMINJAMAN` varchar(10) NOT NULL,
  `ID_BUKU` varchar(10) NOT NULL,
  `ID_ANGGOTA` varchar(10) NOT NULL,
  `USERNAME` varchar(10) NOT NULL,
  `TGL_PEMINJAMAN` date DEFAULT NULL,
  `TGL_PENGEMBALIAN` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

CREATE TABLE `petugas` (
  `ID_PETUGAS` varchar(10) NOT NULL,
  `NAMA_PETUGAS` varchar(50) DEFAULT NULL,
  `ALAMAT` varchar(255) DEFAULT NULL,
  `USERNAME` varchar(20) DEFAULT NULL,
  `NO_TELP` decimal(12,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `petugas`
--

INSERT INTO `petugas` (`ID_PETUGAS`, `NAMA_PETUGAS`, `ALAMAT`, `USERNAME`, `NO_TELP`) VALUES
('PK001', 'Aminurachma Aisyah Nilatika', 'Lawang', 'aminurachmaa', '82299774714');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id_role` int(5) NOT NULL,
  `role` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id_role`, `role`) VALUES
(1, 'Kepala Perpustakaan'),
(2, 'Petugas Perpustakaan'),
(3, 'Anggota Perpustakaan');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`ID_ANGGOTA`),
  ADD UNIQUE KEY `ANGGOTA_PK` (`ID_ANGGOTA`);

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`ID_BUKU`),
  ADD UNIQUE KEY `BUKU_PK` (`ID_BUKU`),
  ADD KEY `MENDATA_FK` (`ID_PETUGAS`);

--
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_role_2` (`id_role`),
  ADD UNIQUE KEY `USERNAME` (`USERNAME`),
  ADD KEY `id_role` (`id_role`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`ID_PEMINJAMAN`),
  ADD UNIQUE KEY `PEMINJAMAN_PK` (`ID_PEMINJAMAN`),
  ADD KEY `DETAIL_PEMINJAMAN_FK` (`ID_BUKU`),
  ADD KEY `MEMINJAM_FK` (`ID_ANGGOTA`);

--
-- Indeks untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`ID_PETUGAS`),
  ADD UNIQUE KEY `USERNAME` (`USERNAME`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `login`
--
ALTER TABLE `login`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`ID_PETUGAS`) REFERENCES `petugas` (`ID_PETUGAS`);

--
-- Ketidakleluasaan untuk tabel `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`);

--
-- Ketidakleluasaan untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD CONSTRAINT `petugas_ibfk_1` FOREIGN KEY (`USERNAME`) REFERENCES `login` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
