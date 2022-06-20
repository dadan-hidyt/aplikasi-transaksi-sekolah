-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2022 at 06:41 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aplikasi_ttransaksi`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_produk`
--

CREATE TABLE `tbl_produk` (
  `kode_produk` varchar(15) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga_produk` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_produk`
--

INSERT INTO `tbl_produk` (`kode_produk`, `nama_produk`, `harga_produk`) VALUES
('PRD-1307', 'PKL', 500000),
('PRD-1392', 'BAJU', 821000),
('PRD-1549', 'SPP', 75000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_setting`
--

CREATE TABLE `tbl_setting` (
  `alamat` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `nama_intansi` varchar(100) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `logo` varchar(223) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_setting`
--

INSERT INTO `tbl_setting` (`alamat`, `email`, `nama_intansi`, `no_hp`, `logo`) VALUES
('komplek perum dano permai 2, Kabupaten Sumedang, Jawa Barat 45322', 'suport@smkinginapa.sch.id', 'SMK INGINAPA', '088223837165', 'logo-62982eaa2fdc1.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_siswa`
--

CREATE TABLE `tbl_siswa` (
  `id_siswa` int(11) NOT NULL,
  `nisn` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tahun_masuk` year(4) NOT NULL,
  `kode_produk` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_siswa`
--

INSERT INTO `tbl_siswa` (`id_siswa`, `nisn`, `nama`, `tahun_masuk`, `kode_produk`) VALUES
(74, '20211001', 'Ahmad Hidayat', 2020, ''),
(75, '20211002', 'Ahmad Romdoni', 2020, ''),
(76, '20211003', 'Akke Octavia Putri', 2020, ''),
(77, '20211004', 'Asep Cahyana', 2020, ''),
(78, '20211005', 'Benny Irawan', 2020, ''),
(79, '20211006', 'Bobon Santoso', 2020, ''),
(80, '20211007', 'Candra Nugraha', 2020, ''),
(81, '20211008', 'Dadan Hidayat', 2020, ''),
(82, '20211009', 'Dian Suminar', 2020, ''),
(83, '20211010', 'Dina Cahyani', 2020, ''),
(84, '20211011', 'Doni Firmansyah', 2020, ''),
(85, '20211012', 'Firman Ramdhani', 2020, ''),
(86, '20211013', 'Fitri Nur', 2020, ''),
(87, '20211014', 'Faridah Aulia', 2020, ''),
(88, '20211015', 'Fadli Romadon', 2020, ''),
(89, '20211016', 'Putri Maulani', 2020, ''),
(90, '20211017', 'Pepen ruspendi', 2020, ''),
(91, '20211018', 'Hidayatulah', 2020, ''),
(92, '20211019', 'hannaah', 2020, ''),
(93, '20211020', 'Huntu garing', 2020, ''),
(94, '20211021', 'Wendi sopiandi', 2020, ''),
(95, '20211022', 'wawan sopian', 2020, ''),
(96, '20211023', 'Garok', 2020, ''),
(97, '20211024', 'Gwen rossyvanigara', 2020, ''),
(98, '20211025', 'Ohen hermawan', 2020, ''),
(99, '20211026', 'Efan Setevan', 2020, ''),
(100, '20211027', 'Engki Surengki', 2020, ''),
(101, '20211028', 'Es doger', 2020, ''),
(102, '20211029', 'Popo', 2020, ''),
(103, '20211030', 'Popon', 2020, ''),
(104, '20211031', 'Pupa', 2020, ''),
(105, '20211032', 'Cokowi', 2020, ''),
(106, '20211033', 'Vrabowo', 2020, ''),
(107, '20211034', 'Asep Sopiandi', 2020, ''),
(108, '20211035', 'Firman Herlambang', 2020, ''),
(109, '20211036', 'Pindad', 2020, ''),
(110, '20211037', 'Dicky', 2020, ''),
(111, '20211038', 'Budianto ', 2020, ''),
(112, '20211039', 'Bawal', 2020, ''),
(113, '20211040', 'Indosiar', 2020, ''),
(114, '20211041', 'Mega Megawangi', 2020, ''),
(115, '20211042', 'Irianto', 2020, ''),
(116, '20211043', 'Iriandi', 2020, ''),
(117, '20211044', 'Ismayanti', 2020, ''),
(118, '20211045', 'Isdayanti', 2020, ''),
(119, '20211046', 'Rohimat', 2020, ''),
(120, '20211047', 'ujang garok', 2020, ''),
(121, '20211048', 'Puan Mahawari', 2020, ''),
(122, '20211049', 'Pendi', 2020, ''),
(123, '20211050', 'deden', 2020, ''),
(124, '8934848', 'Asep suwarman', 2018, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_trans`
--

CREATE TABLE `tbl_trans` (
  `id_transaksi` varchar(122) NOT NULL,
  `tanggal_transaksi` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL,
  `bulan_bayar` varchar(120) NOT NULL,
  `nisn` int(11) NOT NULL,
  `jumlah_bayar` bigint(20) NOT NULL,
  `kode_produk` varchar(15) NOT NULL,
  `total_bayar` varchar(225) NOT NULL,
  `kurang_bayar` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_trans`
--

INSERT INTO `tbl_trans` (`id_transaksi`, `tanggal_transaksi`, `qty`, `bulan_bayar`, `nisn`, `jumlah_bayar`, `kode_produk`, `total_bayar`, `kurang_bayar`) VALUES
('TRX-9953408ECBED5A08730C', '04-06-2022', 1, '-', 20211002, 821000, 'PRD-1392', '821000', '0'),
('TRX-211D632F6C28FCF128DD', '04-06-2022', 1, '-', 20211001, 500000, 'PRD-1307', '200000', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `username` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `akses` enum('1','2','3') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `password`, `akses`) VALUES
(14, 'admin', '$2y$10$xkTR.YP2W9CJiGTbzOEy0uUWkOb1ovRodn3cQg8kK5U0JFfzuiw9K', '1'),
(15, 'kepsek', '$2y$10$miOIc43T0hPSYVT8lU4YAuic2eyP0awKDkAZvZvuYXhTzp5sAOO7S', '3'),
(16, 'petugas', '$2y$10$FPITA9Q/dp5rIkvv/C.6ZeDc3HKORXiADeKqd5prwhspCXwpOdtom', '2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD PRIMARY KEY (`kode_produk`);

--
-- Indexes for table `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD UNIQUE KEY `nisn` (`nisn`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
