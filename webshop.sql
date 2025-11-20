-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2024 at 06:24 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `akses`
--

CREATE TABLE `akses` (
  `id_akun` int(11) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` enum('Admin','Customer') NOT NULL DEFAULT 'Customer',
  `modified_Date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `akses`
--

INSERT INTO `akses` (`id_akun`, `password`, `level`, `modified_Date`) VALUES
(11, '1111', 'Admin', '2024-11-08 00:58:25'),
(12, '2222', 'Customer', '2024-11-08 10:10:42');

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id_akun` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `number` varchar(20) NOT NULL,
  `id_paypal` varchar(100) NOT NULL,
  `birth` date NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `modified_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id_akun`, `username`, `address`, `city`, `number`, `id_paypal`, `birth`, `gender`, `email`, `modified_date`) VALUES
(11, '1111', 'Rungkut', 'Jakarta', '085432134567', 'rival', '1994-11-09', 'Male', 'rfoxress@gmail.com', '2024-11-08 00:58:01'),
(12, '2222', 'Gunung Anyar', 'Ambon', '086547587643', 'readyForGo12', '2024-11-13', 'Male', 'damdasukane@gmail.com', '2024-11-08 10:10:42');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id_cart` int(11) NOT NULL,
  `id_akun` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

CREATE TABLE `checkout` (
  `id_checkout` int(11) NOT NULL,
  `id_akun` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_status` enum('Pending','Paid','Declined') NOT NULL DEFAULT 'Pending',
  `checkout_Date` timestamp NOT NULL DEFAULT current_timestamp(),
  `payment_method` enum('Debit/Kredit','Bayar Di Tempat') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checkout`
--

INSERT INTO `checkout` (`id_checkout`, `id_akun`, `total_amount`, `payment_status`, `checkout_Date`, `payment_method`) VALUES
(1, 12, '467250.00', 'Pending', '2024-11-07 22:37:24', 'Bayar Di Tempat');

-- --------------------------------------------------------

--
-- Stand-in structure for view `checkoutview`
-- (See below for the actual view)
--
CREATE TABLE `checkoutview` (
`id_checkout` int(11)
,`id_akun` int(11)
,`total_amount` decimal(10,2)
,`payment_status` enum('Pending','Paid','Declined')
,`checkout_Date` timestamp
,`payment_method` enum('Debit/Kredit','Bayar Di Tempat')
,`PaymentMethodChar` varchar(15)
);

-- --------------------------------------------------------

--
-- Table structure for table `checkout_detail`
--

CREATE TABLE `checkout_detail` (
  `id_checkout_detail` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_checkout` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `harga` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checkout_detail`
--

INSERT INTO `checkout_detail` (`id_checkout_detail`, `id_produk`, `id_checkout`, `nama_produk`, `quantity`, `harga`) VALUES
(1, 1, 1, 'Vitamin C 1000mg', 3, '120000.00'),
(2, 5, 1, 'Thermometer Digital', 1, '85000.00');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `modified_Date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `modified_Date`) VALUES
(1, 'Suplementasi & Vitamin', '2024-11-08 00:00:00'),
(2, 'Perawatan Kulit', '2024-11-08 00:00:00'),
(3, 'Alat Kesehatan', '2024-11-08 00:00:00'),
(4, 'Obat-obatan', '2024-11-08 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `kota`
--

CREATE TABLE `kota` (
  `id_kota` int(11) NOT NULL,
  `nama_kota` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kota`
--

INSERT INTO `kota` (`id_kota`, `nama_kota`) VALUES
(1, 'Jakarta'),
(2, 'Surabaya'),
(3, 'Bandung'),
(4, 'Medan'),
(5, 'Semarang'),
(6, 'Palembang'),
(7, 'Makassar'),
(8, 'Batam'),
(9, 'Yogyakarta'),
(10, 'Banjarmasin'),
(11, 'Malang'),
(12, 'Balikpapan'),
(13, 'Denpasar'),
(14, 'Samarinda'),
(15, 'Pontianak'),
(16, 'Mataram'),
(17, 'Ambon'),
(18, 'Kupang'),
(19, 'Palu'),
(20, 'Jambi'),
(21, 'Timika'),
(22, 'Jayapura'),
(23, 'Cirebon'),
(24, 'Tasikmalaya'),
(25, 'Pekalongan'),
(26, 'Serang'),
(27, 'Padang'),
(28, 'Pangkalpinang');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `harga` int(50) NOT NULL,
  `jumlah` int(50) NOT NULL,
  `gambar` varchar(50) NOT NULL,
  `modified_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `nama_produk`, `harga`, `jumlah`, `gambar`, `modified_date`) VALUES
(1, 1, 'Vitamin C 1000mg', 120000, 50, '4b18f1d3197ae9d0b85db96c8b057ca1.png', '2024-11-08 09:27:37'),
(2, 1, 'Omega 3 Fish Oil', 180000, 30, '9a2f33d02389b2370be3ec12fd7afcc0.jpg', '2024-11-08 09:28:16'),
(3, 2, 'Serum Vitamin C', 250000, 40, '4fa5340dcfd1655f9feb979fb9eb5492.jpg', '2024-11-08 09:29:16'),
(4, 2, 'Moisturizer Cream', 150000, 60, 'fe3626dbf84f3f5705f88eaa0df1fe86.jpg', '2024-11-08 09:29:56'),
(5, 3, 'Thermometer Digital', 85000, 100, '310beb8f44576f4368ca1d2dbe923dd3.jpg', '2024-11-08 09:30:20'),
(6, 3, 'Oximeter Pulse', 200000, 20, '56c8ca23c81b49ba48100bcf9604f35f.jpg', '2024-11-08 09:31:30'),
(7, 4, 'Paracetamol 500mg', 25000, 200, 'eb9b35a694b29d610ff13f11e67a0364.jpg', '2024-11-08 09:31:59'),
(8, 4, 'Ibuprofen 400mg', 35000, 150, '27aca4ec5661fc8bbadf80aab6cd5ab6.png', '2024-11-08 09:32:35'),
(9, 1, 'Multivitamin Adult', 140000, 80, 'f818cfc63fdaead9ec5707e3f752e03a.jpg', '2024-11-08 09:33:49'),
(10, 1, 'Probiotik 10 Billion CFU', 100000, 120, '4d7a81b9d2483c294809d8e829e885dd.jpg', '2024-11-08 09:34:22'),
(11, 2, 'Face Mask Sheet', 50000, 200, 'e6e55637c09ff52b856b7fb359ae3fc5.jpg', '2024-11-08 09:36:14'),
(12, 2, 'Sunscreen SPF 50', 180000, 90, 'f5b5e126d62faa568f0149f0975d870a.jpg', '2024-11-08 09:36:55'),
(13, 3, 'Stethoscope Digital', 350000, 40, '8accff2be07eaea1e7102b6c0b6a21ba.jpg', '2024-11-08 09:37:28'),
(14, 3, 'Blood Pressure Monitor', 450000, 30, 'd8d88216958d51712b7d88e7662572e8.jpg', '2024-11-08 09:38:05'),
(15, 4, 'Antiseptic Liquid 100ml', 45000, 150, '7e3486714b22f17da69838511942fc9d.jpg', '2024-11-08 09:38:32');

-- --------------------------------------------------------

--
-- Structure for view `checkoutview`
--
DROP TABLE IF EXISTS checkoutview;

CREATE VIEW `checkoutview` AS 
SELECT 
    `checkout`.`id_checkout`,
    `checkout`.`id_akun`,
    `checkout`.`total_amount`,
    `checkout`.`payment_status`,
    `checkout`.`checkout_Date`,
    `checkout`.`payment_method`,
    CASE 
        WHEN `checkout`.`payment_method` = 'Debit/Kredit' THEN 'Debit/Kredit'
        WHEN `checkout`.`payment_method` = 'Bayar Di Tempat' THEN 'Bayar Di Tempat'
        ELSE NULL 
    END AS `PaymentMethodChar`
FROM `checkout`;






--
-- Indexes for dumped tables
--

--
-- Indexes for table `akses`
--
ALTER TABLE `akses`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_cart`);

--
-- Indexes for table `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`id_checkout`),
  ADD KEY `id_akun` (`id_akun`);

--
-- Indexes for table `checkout_detail`
--
ALTER TABLE `checkout_detail`
  ADD PRIMARY KEY (`id_checkout_detail`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`id_kota`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `checkout`
--
ALTER TABLE `checkout`
  MODIFY `id_checkout` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `checkout_detail`
--
ALTER TABLE `checkout_detail`
  MODIFY `id_checkout_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kota`
--
ALTER TABLE `kota`
  MODIFY `id_kota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `checkout`
--
ALTER TABLE `checkout`
  ADD CONSTRAINT `checkout_ibfk_1` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id_akun`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
