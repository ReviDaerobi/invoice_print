-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Apr 26, 2025 at 02:55 PM
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
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat_1` text NOT NULL,
  `alamat_2` text DEFAULT NULL,
  `alamat_3` text DEFAULT NULL,
  `no_telp` varchar(255) NOT NULL,
  `contact_person` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `nama`, `alamat_1`, `alamat_2`, `alamat_3`, `no_telp`, `contact_person`, `created_at`, `updated_at`) VALUES
(1, 'PT. Maju Jaya', 'Jl. Raya Makmur No. 123', 'Kelurahan Makmur', 'Jakarta Selatan', '021-5551234', 'Ahmad Setiawan', '2025-04-19 00:49:54', '2025-04-19 00:49:54'),
(2, 'Toko Sejahtera', 'Jl. Pasar Baru No. 45', 'Kecamatan Andir', 'Bandung', '022-4567890', 'Sinta Dewi', '2025-04-19 00:49:54', '2025-04-19 00:49:54'),
(3, 'CV Mandiri Abadi', 'Jl. Industri Raya No. 78', 'Kelurahan Rungkut', 'Surabaya', '031-7654321', 'Rudi Hartono', '2025-04-19 00:49:54', '2025-04-19 00:49:54'),
(4, 'PT. Sukses Bersama', 'Jl. Gatot Subroto No. 55', 'Kelurahan Kuningan', 'Jakarta Selatan', '021-3334444', 'Doni Pratama', '2025-04-19 00:49:54', '2025-04-19 00:49:54'),
(5, 'Bintang Makmur', 'Jl. Diponegoro No. 34', 'Kelurahan Pleburan', 'Semarang', '024-8765432', 'Wati Susanti', '2025-04-19 00:49:54', '2025-04-19 00:49:54');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_orders`
--

CREATE TABLE `delivery_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_do` varchar(255) NOT NULL,
  `tanggal_do` date NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `purchase_order_id` bigint(20) UNSIGNED NOT NULL,
  `no_po_customer` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(50) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery_orders`
--

INSERT INTO `delivery_orders` (`id`, `no_do`, `tanggal_do`, `customer_id`, `purchase_order_id`, `no_po_customer`, `created_at`, `updated_at`, `status`) VALUES
(1, 'DO/001/2025', '2025-04-26', 1, 1, 'PO-001/MJ/2025', '2025-04-19 00:50:10', '2025-04-26 04:53:26', 'invoiced'),
(2, 'DO/002/2025', '2025-04-05', 2, 2, 'PO-003/TS/2025', '2025-04-19 00:50:10', '2025-04-19 00:50:10', 'pending'),
(3, 'DO/003/2025', '2025-03-25', 3, 3, 'PO-007/MA/2025', '2025-04-19 00:50:10', '2025-04-19 00:50:10', 'pending'),
(4, 'DO/004/2025', '2025-03-20', 4, 4, 'PO-010/SB/2025', '2025-04-19 00:50:10', '2025-04-19 00:50:10', 'pending'),
(5, 'DO/005/2025', '2025-03-15', 5, 5, 'PO-015/BM/2025', '2025-04-19 00:50:10', '2025-04-19 00:50:10', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_order_details`
--

CREATE TABLE `delivery_order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `delivery_order_id` bigint(20) UNSIGNED NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `satuan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery_order_details`
--

INSERT INTO `delivery_order_details` (`id`, `delivery_order_id`, `nama_barang`, `jumlah`, `satuan`, `created_at`, `updated_at`) VALUES
(1, 1, 'Laptop Asus X441', 2, 'unit', '2025-04-19 00:50:17', '2025-04-19 00:50:17'),
(3, 2, 'Printer Epson L3110', 1, 'unit', '2025-04-19 00:50:17', '2025-04-19 00:50:17'),
(4, 3, 'Monitor Samsung 24\"', 3, 'unit', '2025-04-19 00:50:17', '2025-04-19 00:50:17'),
(5, 4, 'Desktop PC Dell Inspiron', 3, 'unit', '2025-04-19 00:50:17', '2025-04-19 00:50:17'),
(6, 5, 'Keyboard Mechanical Gaming', 5, 'unit', '2025-04-19 00:50:17', '2025-04-19 00:50:17');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nomor_invoice` varchar(255) NOT NULL,
  `tanggal_invoice` date NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `attention` varchar(255) NOT NULL,
  `delivery_order_id` bigint(20) UNSIGNED NOT NULL,
  `no_po_customer` varchar(255) NOT NULL,
  `keterangan_pengiriman` text DEFAULT NULL,
  `subtotal` decimal(15,2) NOT NULL DEFAULT 0.00,
  `ongkos_kirim` decimal(15,2) NOT NULL DEFAULT 0.00,
  `bea_materai` decimal(15,2) NOT NULL DEFAULT 0.00,
  `ppn` decimal(15,2) NOT NULL DEFAULT 0.00,
  `grand_total` decimal(15,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `nomor_invoice`, `tanggal_invoice`, `customer_id`, `attention`, `delivery_order_id`, `no_po_customer`, `keterangan_pengiriman`, `subtotal`, `ongkos_kirim`, `bea_materai`, `ppn`, `grand_total`, `created_at`, `updated_at`) VALUES
(1, '#INV-0001', '2025-04-15', 1, 'Bpk. Ahmad Setiawan', 1, 'PO-001/MJ/2025', 'Pengiriman ke gudang Jakarta', 950000.00, 50000.00, 10000.00, 140000.00, 2500000.00, '2025-04-19 00:50:41', '2025-04-24 06:08:24'),
(2, '#INV-0002', '2025-04-10', 2, 'Ibu Sinta Dewi', 2, 'PO-003/TS/2025', 'Pengiriman ke toko cabang Bandung', 1600000.00, 75000.00, 10000.00, 65000.00, 1750000.00, '2025-04-19 00:50:41', '2025-04-19 00:50:41'),
(3, '#INV-0003', '2025-04-05', 3, 'Bpk. Rudi Hartono', 3, 'PO-007/MA/2025', 'Pengiriman ke pabrik Surabaya', 3000000.00, 100000.00, 10000.00, 140000.00, 3250000.00, '2025-04-19 00:50:41', '2025-04-19 00:50:41'),
(4, '#INV-0004', '2025-04-01', 4, 'Bpk. Doni Pratama', 4, 'PO-010/SB/2025', 'Pengiriman ke kantor pusat Jakarta', 4500000.00, 75000.00, 10000.00, 265000.00, 4850000.00, '2025-04-19 00:50:41', '2025-04-19 00:50:41'),
(5, '#INV-0005', '2025-03-25', 5, 'Ibu Wati Susanti', 5, 'PO-015/BM/2025', 'Pengiriman ke toko Semarang', 1150000.00, 50000.00, 10000.00, 40000.00, 1250000.00, '2025-04-19 00:50:41', '2025-04-19 00:50:41');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE `invoice_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `satuan` varchar(255) NOT NULL,
  `harga` decimal(15,2) NOT NULL,
  `total_harga` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`id`, `invoice_id`, `nama_barang`, `jumlah`, `satuan`, `harga`, `total_harga`, `created_at`, `updated_at`) VALUES
(27, 2, 'Printer Epson L3110', 1, 'unit', 1600000.00, 1600000.00, '2025-04-19 00:53:25', '2025-04-19 00:53:25'),
(28, 3, 'Monitor Samsung 24\"', 3, 'unit', 1000000.00, 3000000.00, '2025-04-19 00:53:25', '2025-04-19 00:53:25'),
(29, 4, 'Desktop PC Dell Inspiron', 3, 'unit', 1500000.00, 4500000.00, '2025-04-19 00:53:25', '2025-04-19 00:53:25'),
(30, 5, 'Keyboard Mechanical Gaming', 5, 'unit', 230000.00, 1150000.00, '2025-04-19 00:53:25', '2025-04-19 00:53:25'),
(37, 1, 'Laptop Asus X441', 2, 'unit', 75000.00, 150000.00, '2025-04-24 06:08:24', '2025-04-24 06:08:24'),
(38, 1, 'Mouse Wireless Logitech', 10, 'unit', 80000.00, 800000.00, '2025-04-24 06:08:24', '2025-04-24 06:08:24');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_02_16_120118_create_costumers_table', 1),
(5, '2025_03_15_120206_create_orders_table', 1),
(6, '2025_03_16_120205_create_delivery_orders_table', 1),
(7, '2025_04_16_104936_create_invoices_table', 1),
(8, '2025_04_16_120021_create_penawarans_table', 1),
(9, '2025_04_16_120109_create_perusahaans_table', 1),
(10, '2025_04_16_144717_create_profit_records_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penawarans`
--

CREATE TABLE `penawarans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `nomor_penawaran` varchar(255) NOT NULL,
  `tanggal_penawaran` date NOT NULL,
  `keterangan_pengiriman` text DEFAULT NULL,
  `subtotal` decimal(15,2) NOT NULL DEFAULT 0.00,
  `ongkos_kirim` decimal(15,2) NOT NULL DEFAULT 0.00,
  `bea_materai` decimal(15,2) NOT NULL DEFAULT 0.00,
  `ppn` decimal(15,2) NOT NULL DEFAULT 0.00,
  `grand_total` decimal(15,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penawarans`
--

INSERT INTO `penawarans` (`id`, `customer_id`, `nomor_penawaran`, `tanggal_penawaran`, `keterangan_pengiriman`, `subtotal`, `ongkos_kirim`, `bea_materai`, `ppn`, `grand_total`, `created_at`, `updated_at`) VALUES
(1, 1, 'PNW/001/2025', '2025-04-05', 'Pengiriman ke gudang Jakarta', 2300000.00, 50000.00, 10000.00, 140000.00, 2500000.00, '2025-04-19 00:50:24', '2025-04-19 00:50:24'),
(2, 2, 'PNW/002/2025', '2025-04-01', 'Pengiriman ke toko cabang Bandung', 1600000.00, 75000.00, 10000.00, 65000.00, 1750000.00, '2025-04-19 00:50:24', '2025-04-19 00:50:24'),
(3, 3, 'PNW/003/2025', '2025-03-20', 'Pengiriman ke pabrik Surabaya', 3000000.00, 100000.00, 10000.00, 140000.00, 3250000.00, '2025-04-19 00:50:24', '2025-04-19 00:50:24'),
(4, 4, 'PNW/004/2025', '2025-03-15', 'Pengiriman ke kantor pusat Jakarta', 4500000.00, 75000.00, 10000.00, 265000.00, 4850000.00, '2025-04-19 00:50:24', '2025-04-19 00:50:24'),
(5, 5, 'PNW/005/2025', '2025-03-10', 'Pengiriman ke toko Semarang', 1150000.00, 50000.00, 10000.00, 40000.00, 1250000.00, '2025-04-19 00:50:24', '2025-04-19 00:50:24');

-- --------------------------------------------------------

--
-- Table structure for table `penawaran_details`
--

CREATE TABLE `penawaran_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `penawaran_id` bigint(20) UNSIGNED NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `satuan` varchar(255) NOT NULL,
  `harga` decimal(15,2) NOT NULL,
  `total_harga` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penawaran_details`
--

INSERT INTO `penawaran_details` (`id`, `penawaran_id`, `nama_barang`, `jumlah`, `satuan`, `harga`, `total_harga`, `created_at`, `updated_at`) VALUES
(1, 1, 'Laptop Asus X441', 2, 'unit', 750000.00, 1500000.00, '2025-04-19 00:50:33', '2025-04-19 00:50:33'),
(2, 1, 'Mouse Wireless Logitech', 10, 'unit', 80000.00, 800000.00, '2025-04-19 00:50:33', '2025-04-19 00:50:33'),
(3, 2, 'Printer Epson L3110', 1, 'unit', 1600000.00, 1600000.00, '2025-04-19 00:50:33', '2025-04-19 00:50:33'),
(4, 3, 'Monitor Samsung 24\"', 3, 'unit', 1000000.00, 3000000.00, '2025-04-19 00:50:33', '2025-04-19 00:50:33'),
(5, 4, 'Desktop PC Dell Inspiron', 3, 'unit', 1500000.00, 4500000.00, '2025-04-19 00:50:33', '2025-04-19 00:50:33'),
(6, 5, 'Keyboard Mechanical Gaming', 5, 'unit', 230000.00, 1150000.00, '2025-04-19 00:50:33', '2025-04-19 00:50:33');

-- --------------------------------------------------------

--
-- Table structure for table `perusahaans`
--

CREATE TABLE `perusahaans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_perusahaan` varchar(255) NOT NULL,
  `logo` text DEFAULT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `perusahaans`
--

INSERT INTO `perusahaans` (`id`, `nama_perusahaan`, `logo`, `alamat`, `no_telp`, `created_at`, `updated_at`) VALUES
(1, 'CV. Berkah Jaya', 'logos/berkah-jaya.png', 'Jl. Raya Industri No. 123, Jakarta Utara', '021-5551234', '2025-04-19 00:49:42', '2025-04-19 00:49:42');

-- --------------------------------------------------------

--
-- Table structure for table `profit_records`
--

CREATE TABLE `profit_records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `total_revenue` decimal(15,2) NOT NULL,
  `total_cost` decimal(15,2) NOT NULL,
  `profit` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profit_records`
--

INSERT INTO `profit_records` (`id`, `invoice_id`, `tanggal`, `customer_id`, `total_revenue`, `total_cost`, `profit`, `created_at`, `updated_at`) VALUES
(6, 1, '2025-04-15', 1, 2500000.00, 2000000.00, 500000.00, '2025-04-19 00:53:14', '2025-04-19 00:53:14'),
(7, 2, '2025-04-10', 2, 1750000.00, 1400000.00, 350000.00, '2025-04-19 00:53:14', '2025-04-19 00:53:14'),
(8, 3, '2025-04-05', 3, 3250000.00, 2600000.00, 650000.00, '2025-04-19 00:53:14', '2025-04-19 00:53:14'),
(9, 4, '2025-04-01', 4, 4850000.00, 3880000.00, 970000.00, '2025-04-19 00:53:14', '2025-04-19 00:53:14'),
(10, 5, '2025-03-25', 5, 1250000.00, 1000000.00, 250000.00, '2025-04-19 00:53:14', '2025-04-19 00:53:14');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

CREATE TABLE `purchase_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `no_purchase_order` varchar(255) NOT NULL,
  `tanggal_purchase_order` date NOT NULL,
  `total_amount` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_orders`
--

INSERT INTO `purchase_orders` (`id`, `customer_id`, `no_purchase_order`, `tanggal_purchase_order`, `total_amount`, `created_at`, `updated_at`) VALUES
(1, 1, 'PO-001/MJ/2025', '2025-04-10', 2500000.00, '2025-04-19 00:50:02', '2025-04-19 00:50:02'),
(2, 2, 'PO-003/TS/2025', '2025-04-05', 1750000.00, '2025-04-19 00:50:02', '2025-04-19 00:50:02'),
(3, 3, 'PO-007/MA/2025', '2025-03-25', 3250000.00, '2025-04-19 00:50:02', '2025-04-19 00:50:02'),
(4, 4, 'PO-010/SB/2025', '2025-03-20', 4850000.00, '2025-04-19 00:50:02', '2025-04-19 00:50:02'),
(5, 5, 'PO-015/BM/2025', '2025-03-15', 1250000.00, '2025-04-19 00:50:02', '2025-04-19 00:50:02');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('1h6omGnkHDWxo7DsEuQyGQqV8LxrcNd5I6orERtw', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiWkswRTJvWUgwS0xkaHBCNW9kZmJUVzZaQ2pnU2dqSWd3a0lxd1FFVSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM5OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvaW52b2ljZXMvZGV0YWlsLzEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1745582587),
('ACSSKdgUFwtN7jdBMsa3i0wrcDRJnARkbMUakN7H', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiekRRS3JGbVFiMGNIWGZ2cW9ieVd6M0ozMEtxWkh4RXVlaldoNnBaQiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9pbnZvaWNlcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1745648084),
('rwg55eOhNzGJQqWsFYq8Hkr1wiI3sPUcdl7pPlUd', 1, '127.0.0.1', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Mobile Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiSUpGQms0Z3RJa3ZEVzR0a0lScExVSjJReWVLdGJJYng4aEYxcEZhdyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjg1OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvaW52b2ljZXMvY3JlYXRlP190b2tlbj1JSkZCazRndElrdkRXNHRrSVJwTFVKMlF5ZUt0YklieDhoRjFwRmF3Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1745669565);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'revi', 'revi@gmail.com', NULL, '$2y$12$X9FOpcS7DJXcFwuREc5grOcV7LcS.bDkqDzUADcvnREnpOASiUcsS', NULL, '2025-04-16 19:29:06', '2025-04-16 19:29:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_orders`
--
ALTER TABLE `delivery_orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `delivery_orders_no_do_unique` (`no_do`),
  ADD KEY `delivery_orders_customer_id_foreign` (`customer_id`),
  ADD KEY `delivery_orders_purchase_order_id_foreign` (`purchase_order_id`);

--
-- Indexes for table `delivery_order_details`
--
ALTER TABLE `delivery_order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delivery_order_details_delivery_order_id_foreign` (`delivery_order_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoices_nomor_invoice_unique` (`nomor_invoice`),
  ADD KEY `invoices_customer_id_foreign` (`customer_id`),
  ADD KEY `invoices_delivery_order_id_foreign` (`delivery_order_id`);

--
-- Indexes for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_details_invoice_id_foreign` (`invoice_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `penawarans`
--
ALTER TABLE `penawarans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `penawarans_nomor_penawaran_unique` (`nomor_penawaran`),
  ADD KEY `penawarans_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `penawaran_details`
--
ALTER TABLE `penawaran_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penawaran_details_penawaran_id_foreign` (`penawaran_id`);

--
-- Indexes for table `perusahaans`
--
ALTER TABLE `perusahaans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profit_records`
--
ALTER TABLE `profit_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profit_records_invoice_id_foreign` (`invoice_id`),
  ADD KEY `profit_records_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `purchase_orders_no_purchase_order_unique` (`no_purchase_order`),
  ADD KEY `purchase_orders_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `delivery_orders`
--
ALTER TABLE `delivery_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `delivery_order_details`
--
ALTER TABLE `delivery_order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `invoice_details`
--
ALTER TABLE `invoice_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `penawarans`
--
ALTER TABLE `penawarans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `penawaran_details`
--
ALTER TABLE `penawaran_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `perusahaans`
--
ALTER TABLE `perusahaans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `profit_records`
--
ALTER TABLE `profit_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `delivery_orders`
--
ALTER TABLE `delivery_orders`
  ADD CONSTRAINT `delivery_orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `delivery_orders_purchase_order_id_foreign` FOREIGN KEY (`purchase_order_id`) REFERENCES `purchase_orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `delivery_order_details`
--
ALTER TABLE `delivery_order_details`
  ADD CONSTRAINT `delivery_order_details_delivery_order_id_foreign` FOREIGN KEY (`delivery_order_id`) REFERENCES `delivery_orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `invoices_delivery_order_id_foreign` FOREIGN KEY (`delivery_order_id`) REFERENCES `delivery_orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD CONSTRAINT `invoice_details_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `penawarans`
--
ALTER TABLE `penawarans`
  ADD CONSTRAINT `penawarans_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `penawaran_details`
--
ALTER TABLE `penawaran_details`
  ADD CONSTRAINT `penawaran_details_penawaran_id_foreign` FOREIGN KEY (`penawaran_id`) REFERENCES `penawarans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `profit_records`
--
ALTER TABLE `profit_records`
  ADD CONSTRAINT `profit_records_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `profit_records_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD CONSTRAINT `purchase_orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
