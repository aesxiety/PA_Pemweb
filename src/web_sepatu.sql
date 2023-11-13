-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Nov 2023 pada 10.18
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
  `id_detail_pesanan` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `id_sepatu` int(11) NOT NULL,
  `ukuran_sepatu` int(11) NOT NULL,
  `harga_satuan` int(11) NOT NULL,
  `jumlah_sepatu` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_pesanan`
--

INSERT INTO `detail_pesanan` (`id_detail_pesanan`, `id_pelanggan`, `id_pesanan`, `id_sepatu`, `ukuran_sepatu`, `harga_satuan`, `jumlah_sepatu`, `total_harga`) VALUES
(30, 7, 31, 18, 33, 275000, 2, 275000),
(31, 7, 31, 19, 33, 250000, 1, 250000),
(32, 7, 32, 17, 33, 500000, 1, 500000);

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
  `total_pembayaran` int(11) NOT NULL,
  `tanggal_pesanan` datetime DEFAULT NULL,
  `status_pesanan` enum('keranjang','belum dibayar','diproses','dikirim','selesai','dibatalkan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_pelanggan`, `total_pembayaran`, `tanggal_pesanan`, `status_pesanan`) VALUES
(31, 7, 500000, '2023-11-13 07:49:00', 'belum dibayar'),
(32, 7, 500000, '2023-11-13 07:49:00', 'belum dibayar'),
(33, 7, 0, NULL, 'keranjang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sepatu`
--

CREATE TABLE `sepatu` (
  `id_sepatu` int(11) NOT NULL,
  `nama_sepatu` varchar(255) NOT NULL,
  `jenis_sepatu` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `sepatu_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sepatu`
--

INSERT INTO `sepatu` (`id_sepatu`, `nama_sepatu`, `jenis_sepatu`, `harga`, `deskripsi`, `sepatu_img`) VALUES
(16, 'Vans Old Skull UNISEX', 'UNISEX', 350000, 'Vans Old Skool adalah sepatu klasik yang keren, nyaman, dan ikonik dengan desain stripe samping, sol karet, dan siluet low-top. Cocok untuk gaya kasual dan penuh gaya.', 'Vans Old Skull UNISEX-2023-11-12.png'),
(17, 'Nike Jordan', 'MAN', 500000, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eius officiis dignissimos saepe dolores, nisi sed iure odit repudiandae ratione quaerat harum voluptate quae ipsam commodi?\r\n', 'Nike Jordan-2023-11-12.png'),
(18, 'ngawi running man', 'MAN', 275000, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eius officiis dignissimos saepe dolores, nisi sed iure odit repudiandae ratione quaerat harum voluptate quae ipsam commodi?\r\n', 'ngawi running man-2023-11-12.png'),
(19, 'badminton shoes women', 'WOMEN', 250000, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eius officiis dignissimos saepe dolores, nisi sed iure odit repudiandae ratione quaerat harum voluptate quae ipsam commodi?\r\n', 'badminton shoes women-2023-11-12.png'),
(20, 'Women runing shoes', 'WOMEN', 175000, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eius officiis dignissimos saepe dolores, nisi sed iure odit repudiandae ratione quaerat harum voluptate quae ipsam commodi?\r\n', 'Women runing shoes-2023-11-12.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok`
--

CREATE TABLE `stok` (
  `id_stok` int(11) NOT NULL,
  `id_sepatu` int(11) NOT NULL,
  `ukuran` int(11) NOT NULL,
  `jumlah_stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `stok`
--

INSERT INTO `stok` (`id_stok`, `id_sepatu`, `ukuran`, `jumlah_stok`) VALUES
(2, 16, 33, 10),
(3, 17, 33, 10);

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
(6, 'admin', '$2y$10$pcOzoK/U.fgySg.9uju1teJdcOuJIlBqRPlhL3/voyFJoH9yIWcbq', 'admin', 'samarinda', 'yahahahayuk@gmail.com', '123456789', 'admin'),
(7, 'reza', '$2y$10$RNXpSDsh.BHzV6ceoabEGuAOfcUbMEEfqLYbVWomJlMXOgA367na2', 'reza', 'perjuangan', 'reza@gmail.com', '085705297230', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD PRIMARY KEY (`id_detail_pesanan`),
  ADD KEY `id_pesanan` (`id_pesanan`),
  ADD KEY `id_sepatu` (`id_sepatu`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indeks untuk tabel `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id_msg`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`);

--
-- Indeks untuk tabel `sepatu`
--
ALTER TABLE `sepatu`
  ADD PRIMARY KEY (`id_sepatu`);

--
-- Indeks untuk tabel `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`id_stok`),
  ADD KEY `id_sepatu` (`id_sepatu`);

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
  MODIFY `id_detail_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `messages`
--
ALTER TABLE `messages`
  MODIFY `id_msg` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `sepatu`
--
ALTER TABLE `sepatu`
  MODIFY `id_sepatu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `stok`
--
ALTER TABLE `stok`
  MODIFY `id_stok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  ADD CONSTRAINT `detail_pesanan_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`),
  ADD CONSTRAINT `detail_pesanan_ibfk_2` FOREIGN KEY (`id_sepatu`) REFERENCES `sepatu` (`id_sepatu`),
  ADD CONSTRAINT `detail_pesanan_ibfk_3` FOREIGN KEY (`id_pelanggan`) REFERENCES `user` (`id_akun`);

--
-- Ketidakleluasaan untuk tabel `stok`
--
ALTER TABLE `stok`
  ADD CONSTRAINT `stok_ibfk_1` FOREIGN KEY (`id_sepatu`) REFERENCES `sepatu` (`id_sepatu`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
