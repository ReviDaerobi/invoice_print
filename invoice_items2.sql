-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: May 03, 2025 at 02:25 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `invoice_print`
--

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

CREATE TABLE `invoice_items` (
  `ItemId` int(11) NOT NULL,
  `ItemName` varchar(255) NOT NULL,
  `Unit` varchar(50) NOT NULL,
  `UnitPrice` decimal(16,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_items`
--

INSERT INTO `invoice_items` (`ItemId`, `ItemName`, `Unit`, `UnitPrice`, `created_at`, `updated_at`) VALUES
(2, 'Assembly Instruction S&H DEVON ARMCHAIR', 'Pcs', 2500000.00, NULL, NULL),
(3, 'Assembly Instruction S&H DEVON CHAIR', 'PCS', 250.00, NULL, NULL),
(4, 'KARTU NAMA RICKY HERMAWAN', 'BOX', 50000.00, NULL, NULL),
(5, 'XXXXXXXXXXX', 'XXX', 222222.00, NULL, NULL),
(6, 'Amplop Jaya PT. GEMA SERVICE MOTORINDO', 'BOX', 30000.00, NULL, NULL),
(7, 'AAAAAAAAAAAAAAAAAAAAAAAAAAAA', 'PCS', 115.00, NULL, NULL),
(8, 'abcdefghij', 'pcs', 275.00, NULL, NULL),
(9, 'klmnopqrst', 'box', 25000.00, NULL, NULL),
(10, 'abcdefghijhjhjhj', 'pcs', 275.00, NULL, NULL),
(13, 'Sticker OVVIO UPC# 91549488 (KSL-0276)', 'pcs', 250.00, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD PRIMARY KEY (`ItemId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
