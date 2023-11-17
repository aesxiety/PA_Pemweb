-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 17, 2023 at 11:24 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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
-- Table structure for table `detail_pesanan`
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
-- Dumping data for table `detail_pesanan`
--

INSERT INTO `detail_pesanan` (`id_detail_pesanan`, `id_pelanggan`, `id_pesanan`, `id_sepatu`, `ukuran_sepatu`, `harga_satuan`, `jumlah_sepatu`, `total_harga`) VALUES
(46, 7, 45, 18, 33, 275000, 1, 275000),
(47, 12, 48, 17, 33, 500000, 1, 500000),
(48, 12, 48, 20, 34, 175000, 3, 525000),
(49, 10, 47, 18, 45, 275000, 2, 550000),
(50, 13, 49, 18, 45, 275000, 3, 825000),
(51, 7, 46, 20, 44, 175000, 5, 875000),
(52, 10, 51, 17, 44, 500000, 1, 500000),
(53, 7, 46, 18, 44, 275000, 1, 275000),
(54, 9, 52, 16, 45, 350000, 1, 350000),
(55, 10, 54, 18, 44, 275000, 1, 275000),
(56, 14, 55, 20, 41, 175000, 1, 175000);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id_msg` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pesan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `total_pembayaran` int(11) NOT NULL,
  `tanggal_pesanan` datetime DEFAULT NULL,
  `status_pesanan` enum('keranjang','belum dibayar','sudah dibayar','diproses','dikirim','selesai','dibatalkan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_pelanggan`, `total_pembayaran`, `tanggal_pesanan`, `status_pesanan`) VALUES
(45, 7, 275000, '2023-11-13 16:30:00', 'diproses'),
(46, 7, 0, NULL, 'keranjang'),
(47, 10, 550000, '2023-11-16 15:06:00', 'belum dibayar'),
(48, 12, 700000, '2023-11-16 14:03:00', 'belum dibayar'),
(49, 13, 1100000, '2023-11-16 15:19:00', 'belum dibayar'),
(50, 13, 0, NULL, 'keranjang'),
(51, 10, 0, '2023-11-16 15:36:00', 'dibatalkan'),
(52, 9, 350000, '2023-11-16 23:53:00', 'selesai'),
(53, 9, 0, NULL, 'keranjang'),
(54, 10, 275000, '2023-11-17 17:16:00', 'belum dibayar'),
(55, 14, 175000, '2023-11-17 22:13:00', 'belum dibayar');

-- --------------------------------------------------------

--
-- Table structure for table `rekening_user`
--

CREATE TABLE `rekening_user` (
  `id_rekening` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `nama_rekening` varchar(255) NOT NULL,
  `nama_bank` varchar(255) NOT NULL,
  `no_rekening` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rekening_user`
--

INSERT INTO `rekening_user` (`id_rekening`, `id_pelanggan`, `nama_rekening`, `nama_bank`, `no_rekening`) VALUES
(1, 7, 'abdul kodir', 'bca', 124141515),
(2, 8, 'surya', 'mandiri', 234354657),
(3, 9, 'Ujang M', 'Bank Publik', 846161946);

-- --------------------------------------------------------

--
-- Table structure for table `sepatu`
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
-- Dumping data for table `sepatu`
--

INSERT INTO `sepatu` (`id_sepatu`, `nama_sepatu`, `jenis_sepatu`, `harga`, `deskripsi`, `sepatu_img`) VALUES
(16, 'Vans Old Skull', 'UNISEX', 350000, 'Vans Old Skool adalah sepatu klasik yang keren, nyaman, dan ikonik dengan desain stripe samping, sol karet, dan siluet low-top. Cocok untuk gaya kasual dan penuh gaya.', 'Vans Old Skull UNISEX-2023-11-12.png'),
(17, 'Nike Jordan', 'MAN', 250000, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eius officiis dignissimos saepe dolores, nisi sed iure odit repudiandae ratione quaerat harum voluptate quae ipsam commodi?\r\n', '../img/2023-11-06 Jordan.png'),
(18, 'ngawi running man', 'MAN', 275000, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eius officiis dignissimos saepe dolores, nisi sed iure odit repudiandae ratione quaerat harum voluptate quae ipsam commodi?\r\n', 'ngawi running man-2023-11-12.png'),
(19, 'badminton shoes women', 'WOMEN', 250000, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eius officiis dignissimos saepe dolores, nisi sed iure odit repudiandae ratione quaerat harum voluptate quae ipsam commodi?\r\n', 'badminton shoes women-2023-11-12.png'),
(20, 'Women runing shoes', 'WOMEN', 175000, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eius officiis dignissimos saepe dolores, nisi sed iure odit repudiandae ratione quaerat harum voluptate quae ipsam commodi?\r\n', 'Women runing shoes-2023-11-12.png'),
(21, 'OrangeXSole', 'MAN', 355000, 'Sepatu ini dirancang khusus untuk para pelari dengan teknologi tinggi yang memberikan dukungan maksimal, penyerapan shock yang baik, dan material ringan untuk meningkatkan performa lari Anda.', '../img/2023-11-17-OrangeXSole.png'),
(22, 'Xsoole', 'UNISEX', 120000, 'Dengan desain yang simpel namun elegan, sepatu ini cocok untuk gaya kasual sehari-hari. Material berkualitas tinggi dan warna netral membuatnya pas untuk berbagai kesempatan.', '../img/2023-11-17-Xsoole.png'),
(23, 'JandSoole', 'WOMEN', 430000, 'Sepatu yang cocok untuk berbagai aktivitas olahraga, dari latihan ke gym hingga bermain basket. Dengan teknologi yang mendukung gerakan, sepatu ini memberikan kenyamanan dan performa maksimal.', '../img/2023-11-17-JandSoole.png'),
(24, 'RedSneak', 'WOMEN', 260000, 'Cocok untuk petualangan di alam bebas, sepatu ini memiliki desain tahan air dan sol khusus yang memberikan traksi optimal. Dilengkapi dengan bahan yang tahan lama, sepatu ini siap menemani Anda menjelajahi berbagai medan.', '../img/2023-11-17-RedSneak.png'),
(26, 'Blacks', 'UNISEX', 500000, 'Dengan desain klasik dan bahan kulit berkualitas tinggi, sepatu ini menjadi pilihan sempurna untuk acara formal atau kantor. Elegan namun nyaman, sepatu ini menunjukkan gaya dan profesionalisme.', '../img/2023-11-17-Blacks.png'),
(27, 'YellSoole', 'UNISEX', 390000, 'Dengan desain klasik dan bahan kulit berkualitas tinggi, sepatu ini menjadi pilihan sempurna untuk acara formal atau kantor. Elegan namun nyaman, sepatu ini menunjukkan gaya dan profesionalisme.', '../img/2023-11-17-YellSoole.png'),
(28, 'ColorfullX', 'UNISEX', 766000, 'Dengan desain klasik dan bahan kulit berkualitas tinggi, sepatu ini menjadi pilihan sempurna untuk acara formal atau kantor. Elegan namun nyaman, sepatu ini menunjukkan gaya dan profesionalisme.', '../img/2023-11-17-ColorfullX.png'),
(29, 'BasketVNZ', 'UNISEX', 344000, 'Kombinasi desain retro yang timeless dengan teknologi modern, sneakers ini memberikan nuansa klasik namun tetap memenuhi kebutuhan kenyamanan dan performa terkini.', '../img/2023-11-17-BasketVNZ.png'),
(30, 'Whaity', 'MAN', 400000, 'Dibuat dari bahan kanvas yang ringan, sneakers ini ideal untuk kegiatan sehari-hari. Desainnya yang simpel namun modis membuatnya sempurna untuk gaya santai atau hangout bersama teman-teman.', '../img/2023-11-17-Whaity.png'),
(31, 'Silever', 'UNISEX', 123000, 'Cocok untuk para pencinta fashion yang mencari tampilan futuristik, sneakers ini tidak hanya memanjakan mata tetapi juga memberikan dukungan yang baik untuk kegiatan lari ringan.', '../img/2023-11-17-Silever.png'),
(32, 'Di Oranges', 'MAN', 320000, 'Cocok untuk para pencinta fashion yang mencari tampilan futuristik, sneakers ini tidak hanya memanjakan mata tetapi juga memberikan dukungan yang baik untuk kegiatan lari ringan.', '../img/2023-11-17-Di Oranges.png'),
(33, 'Red Black', 'MAN', 422000, 'Cocok untuk para pencinta fashion yang mencari tampilan futuristik, sneakers ini tidak hanya memanjakan mata tetapi juga memberikan dukungan yang baik untuk kegiatan lari ringan.', '../img/2023-11-17-Red Black.png'),
(34, 'Mechass', 'MAN', 733000, 'Cocok untuk para pencinta fashion yang mencari tampilan futuristik, sneakers ini tidak hanya memanjakan mata tetapi juga memberikan dukungan yang baik untuk kegiatan lari ringan.', '../img/2023-11-17-Mechass.png'),
(35, 'Grey C', 'MAN', 110000, 'Cocok untuk para pencinta fashion yang mencari tampilan futuristik, sneakers ini tidak hanya memanjakan mata tetapi juga memberikan dukungan yang baik untuk kegiatan lari ringan.', '../img/2023-11-17-Grey C.png'),
(36, 'BluRange S', 'UNISEX', 432000, 'Cocok untuk para pencinta fashion yang mencari tampilan futuristik, sneakers ini tidak hanya memanjakan mata tetapi juga memberikan dukungan yang baik untuk kegiatan lari ringan.', '../img/2023-11-17-BluRange S.png');

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE `stok` (
  `id_stok` int(11) NOT NULL,
  `id_sepatu` int(11) NOT NULL,
  `ukuran` int(11) NOT NULL,
  `jumlah_stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stok`
--

INSERT INTO `stok` (`id_stok`, `id_sepatu`, `ukuran`, `jumlah_stok`) VALUES
(2, 16, 33, 10),
(3, 17, 33, 10);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `id_rekening` int(11) NOT NULL,
  `rekening_tujuan` varchar(50) NOT NULL,
  `total_pembayaran` int(11) NOT NULL,
  `tanggal_transaksi` datetime NOT NULL,
  `bukti_pembayaran` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_pesanan`, `id_rekening`, `rekening_tujuan`, `total_pembayaran`, `tanggal_transaksi`, `bukti_pembayaran`) VALUES
(7, 45, 1, 'mandiri', 275000, '2023-11-16 23:23:24', '45-bca-2023-11-16.jpg'),
(8, 52, 3, 'bca', 350000, '2023-11-17 07:54:45', '52-Bank Publik-2023-11-17.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
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
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_akun`, `username`, `password`, `nama`, `alamat`, `email`, `no_hp`, `type`) VALUES
(6, 'admin', '$2y$10$pcOzoK/U.fgySg.9uju1teJdcOuJIlBqRPlhL3/voyFJoH9yIWcbq', 'admin', 'samarinda', 'yahahahayuk@gmail.com', '123456789', 'admin'),
(7, 'reza', '$2y$10$RNXpSDsh.BHzV6ceoabEGuAOfcUbMEEfqLYbVWomJlMXOgA367na2', 'reza', 'perjuangan', 'reza@gmail.com', '085705297230', 'user'),
(8, 'surya', '$2y$10$vEeoiBTauGOz5xKY8IvANO62amJp9sP8aUbrjDCl77b1I1kvXgGYm', 'surya', 'Jl. Kuaro, Gn. Kelua, Kec. Samarinda Ulu, Kota Samarinda,', 'Rizkyrahmatullah72@gmail.com', '085705297230', 'user'),
(9, 'Ujang', '$2y$10$gdlAsjG2cWLGKSM/8oMlHebXI3QxruGWYmK5lS9qsFzZJlUT0xT3O', 'Ujang Mahendra', 'Jln. Kuning', 'udin333@email.com', '086446242368', 'user'),
(10, 's', '$2y$10$3TGqfxcwHjQKyWbwEW7evemwAOEJ9aZGxJs5KMScIdyKju3Yw2kx6', 's', 's', 's', '081283584663', 'user'),
(11, 's', '$2y$10$nCtPfHwLwXmWmEWRw7Q1PenmA1HdCd4p2SPhVAJYJZhhJrrevOWUe', 's', 's', 's', '083345657789', 'user'),
(12, 'a', '$2y$10$h4OlKtSidUpcxhMorhmp3eFQx5dK7.2Uhm80W6ySdk7S0V/a5x7i6', 'a', 'a', 'a', '085657577588', 'user'),
(13, 'dipa', '$2y$10$kGRLFCaAzACtwGPVyva0DO81Hp0Uyt0ONh0j3SPPN1IUo7ubzBnQy', 'dipa', 'dipa', 'dipa@gmail.com', '085959595959', 'user'),
(14, 'Maman', '$2y$10$bK/TmbpCoiqvPGosk2MhFudVkHxPj3jmphEyOL4gsQ9gz34kVkqs.', 'Maman Suhendra', 'Jalan Jaland', 'Email@Mail.com', '081234567890', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD PRIMARY KEY (`id_detail_pesanan`),
  ADD KEY `id_pesanan` (`id_pesanan`),
  ADD KEY `id_sepatu` (`id_sepatu`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id_msg`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`);

--
-- Indexes for table `rekening_user`
--
ALTER TABLE `rekening_user`
  ADD PRIMARY KEY (`id_rekening`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `sepatu`
--
ALTER TABLE `sepatu`
  ADD PRIMARY KEY (`id_sepatu`);

--
-- Indexes for table `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`id_stok`),
  ADD KEY `id_sepatu` (`id_sepatu`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_pesanan` (`id_pesanan`),
  ADD KEY `id_rekening` (`id_rekening`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_akun`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  MODIFY `id_detail_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id_msg` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `rekening_user`
--
ALTER TABLE `rekening_user`
  MODIFY `id_rekening` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sepatu`
--
ALTER TABLE `sepatu`
  MODIFY `id_sepatu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `stok`
--
ALTER TABLE `stok`
  MODIFY `id_stok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD CONSTRAINT `detail_pesanan_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`),
  ADD CONSTRAINT `detail_pesanan_ibfk_2` FOREIGN KEY (`id_sepatu`) REFERENCES `sepatu` (`id_sepatu`),
  ADD CONSTRAINT `detail_pesanan_ibfk_3` FOREIGN KEY (`id_pelanggan`) REFERENCES `user` (`id_akun`);

--
-- Constraints for table `rekening_user`
--
ALTER TABLE `rekening_user`
  ADD CONSTRAINT `rekening_user_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `user` (`id_akun`);

--
-- Constraints for table `stok`
--
ALTER TABLE `stok`
  ADD CONSTRAINT `stok_ibfk_1` FOREIGN KEY (`id_sepatu`) REFERENCES `sepatu` (`id_sepatu`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_rekening`) REFERENCES `rekening_user` (`id_rekening`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
