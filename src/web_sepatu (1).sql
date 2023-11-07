-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Nov 2023 pada 20.05
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_sepatu`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
  `ID_Detail_Pesanan` int(11) NOT NULL,
  `ID_Pesanan` int(11) NOT NULL,
  `ID_Sepatu` int(11) NOT NULL,
  `Jumlah_Sepatu` int(11) NOT NULL,
  `Harga_Satuan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `katalog`
--

CREATE TABLE `katalog` (
  `id_sepatu` int(11) NOT NULL,
  `nama_sepatu` varchar(255) NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `messages`
--

CREATE TABLE `messages` (
  `id_msg` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pesan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_sepatu` int(11) NOT NULL,
  `ukuran_sepatu` int(11) NOT NULL,
  `jumlah_sepatu` int(11) NOT NULL,
  `status_pesanan` enum('dipesan','diproses','dikirim','dibatalkan','selesai') NOT NULL,
  `tanggal_pesanan` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_pelanggan`, `id_sepatu`, `ukuran_sepatu`, `jumlah_sepatu`, `status_pesanan`, `tanggal_pesanan`) VALUES
(7, 7, 9, 11, 3, 'dipesan', '2023-11-07 12:29:00'),
(8, 7, 10, 10, 4, 'dipesan', '2023-11-07 12:30:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sepatu`
--

CREATE TABLE `sepatu` (
  `id_sepatu` int(11) NOT NULL,
  `nama_sepatu` varchar(255) NOT NULL,
  `jenis_sepatu` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `sepatu_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sepatu`
--

INSERT INTO `sepatu` (`id_sepatu`, `nama_sepatu`, `jenis_sepatu`, `deskripsi`, `sepatu_img`) VALUES
(8, 'Jordan', 'UNISEX', '', '2023-11-06 Jordan.png'),
(9, 'Running Ngawi', 'UNISEX', '', '2023-11-06 Running Ngawi.png'),
(10, 'Vans Old Skull UNISEX', 'UNISEX', '', '2023-11-06 Vans Old Skull UNISEX.png'),
(11, 'Ngawi 3', 'WOMEN', '', '2023-11-06 Ngawi 3.png'),
(12, 'Sport Women Shoes 001', 'WOMEN', 'Sepatu sport wanita berwarna pink adalah pilihan gaya yang sempurna untuk aktivitas fisik. Desain trendy dengan kenyamanan tinggi, cocok untuk olahraga dan gaya sehari-hari.', 'Sport Women Shoes 001-2023-11-07.png'),
(13, 'Old Skull Broo', 'MAN', 'Sepatu Vans Old Skool adalah ikon gaya kasual. Dikenal dengan desain bergaya klasik, sepatu ini memiliki siluet rendah, tompel samping berpita, dan sol waffle khas Vans. Dibuat untuk kenyamanan sepanjang hari, cocok untuk gaya santai atau bermain skateboa', 'Old Skull Broo-2023-11-07.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_akun` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `type` enum('user','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_akun`, `username`, `password`, `nama`, `alamat`, `email`, `no_hp`, `type`) VALUES
(1, 'a', '$2y$10$irN6e8R0aNqtJqJPF1xkUezeIY/7I8pk4J3pJ24V0t.cXbRNSCduq', 'a', 'a', 'a', 'a', 'admin'),
(2, 'b', '$2y$10$dXumdHFhnVYblDHFI6jzeuxLVVsn9qJgkim.BBAV7EVHUjYYB9QKi', 'b', 'b', 'b', 'b', 'admin'),
(3, 'c', '$2y$10$26z7J3USdAR2DzBQuPkLt.hHulw8r19CvbwR35b/3iYeJzSL1NYb6', 'c', 'c', 'c', 'c', 'admin'),
(4, 'f', '$2y$10$GEXmhWCmnwPQBBkZQUWI5e2Bx8tSKzi3Tvsb0MhkiMwsvJuRoExTy', 'f', 'f', 'f', 'f', 'user'),
(6, 'admin', '$2y$10$pcOzoK/U.fgySg.9uju1teJdcOuJIlBqRPlhL3/voyFJoH9yIWcbq', 'admin', 'samarinda', 'yahahahayuk@gmail.com', '123456789', 'admin'),
(7, 'reza', '$2y$10$RNXpSDsh.BHzV6ceoabEGuAOfcUbMEEfqLYbVWomJlMXOgA367na2', 'reza', 'perjuangan', 'reza@gmail.com', '085705297230', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD PRIMARY KEY (`ID_Detail_Pesanan`),
  ADD KEY `ID_Pesanan` (`ID_Pesanan`);

--
-- Indeks untuk tabel `katalog`
--
ALTER TABLE `katalog`
  ADD PRIMARY KEY (`id_sepatu`);

--
-- Indeks untuk tabel `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id_msg`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_sepatu` (`id_sepatu`);

--
-- Indeks untuk tabel `sepatu`
--
ALTER TABLE `sepatu`
  ADD PRIMARY KEY (`id_sepatu`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_akun`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  MODIFY `ID_Detail_Pesanan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `katalog`
--
ALTER TABLE `katalog`
  MODIFY `id_sepatu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `messages`
--
ALTER TABLE `messages`
  MODIFY `id_msg` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `sepatu`
--
ALTER TABLE `sepatu`
  MODIFY `id_sepatu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD CONSTRAINT `detail_pesanan_ibfk_1` FOREIGN KEY (`ID_Pesanan`) REFERENCES `pesanan` (`id_pesanan`);

--
-- Ketidakleluasaan untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `user` (`id_akun`),
  ADD CONSTRAINT `pesanan_ibfk_2` FOREIGN KEY (`id_sepatu`) REFERENCES `sepatu` (`id_sepatu`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
