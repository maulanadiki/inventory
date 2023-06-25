-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 25, 2023 at 06:04 PM
-- Server version: 5.7.34
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `defashoes`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_barang` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_barang` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `warna` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ukuran` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `beli` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f_barang` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `nama_barang`, `warna`, `ukuran`, `beli`, `deskripsi`, `f_barang`, `created_at`, `updated_at`) VALUES
(17, 'BRG-00001', 'Adidas Sport', 'putih strip hitam', '39', '150000', 'putih strip hitam', '34876.jpg', '2023-06-19 19:56:01', '2023-06-19 19:56:01'),
(18, 'BRG-00002', 'Adidas Sport', 'putih strip hitam', '40', '150000', 'putih strip hitam', '37527.jpg', '2023-06-19 19:56:24', '2023-06-19 19:56:24'),
(19, 'BRG-00003', 'Adidas Sport', 'putih strip hitam', '41', '150000', 'putih strip hitam', '68109.jpg', '2023-06-19 19:56:50', '2023-06-19 19:56:50'),
(20, 'BRG-00004', 'Adidas Sport', 'putih strip hitam', '42', '150000', 'putih strip hitam', '12591.jpg', '2023-06-19 19:57:14', '2023-06-19 19:57:14'),
(21, 'BRG-00005', 'Adidas Sport', 'putih strip hitam', '43', '150000', 'putih strip hitam', '13879.jpg', '2023-06-19 19:57:37', '2023-06-19 19:57:37'),
(22, 'BRG-00006', 'Puma Sneker', 'hitam strip putih', '39', '155000', 'hitam strip putih', '45919.jpg', '2023-06-19 19:59:09', '2023-06-19 19:59:09'),
(23, 'BRG-00007', 'Puma Sneker', 'hitam strip putih', '40', '155000', 'hitam strip putih', '19658.jpg', '2023-06-19 19:59:39', '2023-06-19 19:59:39'),
(24, 'BRG-00008', 'Puma Sneker', 'hitam strip putih', '41', '155000', 'hitam strip putih', '23075.jpg', '2023-06-19 20:00:14', '2023-06-19 20:00:14'),
(25, 'BRG-00009', 'Puma Sneker', 'hitam strip putih', '42', '155000', 'hitam strip putih', '41391.jpg', '2023-06-19 20:00:38', '2023-06-19 20:00:38'),
(26, 'BRG-00010', 'Puma Sneker', 'hitam strip putih', '43', '155000', 'hitam strip putih', '42749.jpg', '2023-06-19 20:01:25', '2023-06-19 20:01:25'),
(27, 'BRG-00011', 'Adidas Run', 'biru strip putih', '39', '145000', 'biru strip putih', '62449.jpg', '2023-06-21 00:35:35', '2023-06-21 00:35:35'),
(28, 'BRG-00012', 'ADIDAS RUN', 'biru strip putih', '40', '145000', 'biru strip putih', '89586.jpg', '2023-06-21 00:36:02', '2023-06-21 00:36:02'),
(29, 'BRG-00013', 'Adidas Run', 'biru strip putih', '41', '145000', 'biru strip putih', '30684.jpg', '2023-06-21 00:36:26', '2023-06-21 00:36:26'),
(30, 'BRG-00014', 'Adidas Run', 'biru strip putih', '42', '145000', 'biru strip putih', '59114.jpg', '2023-06-21 00:36:52', '2023-06-21 00:36:52');

-- --------------------------------------------------------

--
-- Table structure for table `detailprocurment`
--

CREATE TABLE `detailprocurment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_po` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_barang` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detailprocurment`
--

INSERT INTO `detailprocurment` (`id`, `no_po`, `kode_barang`, `harga_beli`, `qty`, `subtotal`, `created_at`, `updated_at`) VALUES
(110, 'PO.2306230001', 'BRG-00002', 150000, 10, 1500000, '2023-06-23 01:18:34', '2023-06-23 01:18:34'),
(111, 'PO.2306230001', 'BRG-00006', 155000, 10, 1550000, '2023-06-23 01:18:34', '2023-06-23 01:18:34'),
(112, 'PO.2306230001', 'BRG-00004', 150000, 10, 1500000, '2023-06-23 01:18:34', '2023-06-23 01:18:34'),
(113, 'PO.2306230002', 'BRG-00003', 150000, 10, 1500000, '2023-06-23 01:19:08', '2023-06-23 01:19:08'),
(114, 'PO.2306230002', 'BRG-00006', 155000, 10, 1550000, '2023-06-23 01:19:08', '2023-06-23 01:19:08'),
(115, 'PO.2306230002', 'BRG-00008', 155000, 10, 1550000, '2023-06-23 01:19:08', '2023-06-23 01:19:08'),
(116, 'PO.2306230002', 'BRG-00007', 155000, 10, 1550000, '2023-06-23 01:19:08', '2023-06-23 01:19:08'),
(117, 'PO.2306230002', 'BRG-00009', 155000, 10, 1550000, '2023-06-23 01:19:08', '2023-06-23 01:19:08'),
(118, 'PO.2306230002', 'BRG-00010', 155000, 1, 155000, '2023-06-23 01:19:08', '2023-06-23 01:19:08'),
(119, 'PO.2306230002', 'BRG-00011', 145000, 1, 145000, '2023-06-23 01:19:08', '2023-06-23 01:19:08'),
(120, 'PO.2306230002', 'BRG-00012', 145000, 1, 145000, '2023-06-23 01:19:08', '2023-06-23 01:19:08'),
(121, 'PO.2306230002', 'BRG-00013', 145000, 1, 145000, '2023-06-23 01:19:08', '2023-06-23 01:19:08'),
(122, 'PO.2306230003', 'BRG-00003', 150000, 1, 150000, '2023-06-23 09:28:12', '2023-06-23 09:28:12'),
(123, 'PO.2306230003', 'BRG-00006', 155000, 1, 155000, '2023-06-23 09:28:12', '2023-06-23 09:28:12');

-- --------------------------------------------------------

--
-- Table structure for table `employe`
--

CREATE TABLE `employe` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nik` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `npwp` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `kelamin` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `norek` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f_nik` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f_npwp` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f_tabungan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `akses` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employe`
--

INSERT INTO `employe` (`id`, `nik`, `npwp`, `nama`, `tempat`, `tanggal`, `kelamin`, `telp`, `email`, `jabatan`, `alamat`, `bank`, `norek`, `f_nik`, `f_npwp`, `f_tabungan`, `akses`, `created_at`, `updated_at`) VALUES
(1, '123', '123', 'purchase@purchase', 'bogor', '1996-02-12', 'L', '088888', 'purchase@purchase', '3', 'purchase@purchase', 'CASH ONLY', '0000', '1683946361.jpeg', '1683946361.jpeg', '1683946361.jpeg', 'Approved', '2023-05-12 19:52:41', '2023-06-22 15:56:07'),
(2, '123', '123', 'sell', 'bogor', '1996-02-12', 'L', '9999', 'sell@sell', '4', 'oke', 'BCA', '1231', '1685698782.jpeg', '1685698782.jpg', '1685698782.jpg', 'Approved', '2023-06-02 02:39:42', '2023-06-21 02:05:25');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_01_01_063744_create_vendor_table', 2),
(6, '2022_01_01_064735_create_barang_table', 2),
(7, '2022_01_01_065036_create_stock_table', 2),
(8, '2022_01_01_065212_create_employe_table', 2),
(9, '2022_01_30_130540_create_procurment_table', 2),
(10, '2022_01_30_131958_create_detailprocurment_table', 2),
(11, '2022_01_30_133041_create_stockgood_table', 2),
(12, '2022_08_13_235559_create_pr_table', 2),
(13, '2022_08_18_154909_create_sell_table', 2),
(14, '2022_08_18_155045_create_selldetail_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pr`
--

CREATE TABLE `pr` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_vendor` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nopo` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `statpo` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `statpay` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `statpr` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bukti` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pr`
--

INSERT INTO `pr` (`id`, `kode_vendor`, `nopo`, `statpo`, `statpay`, `statpr`, `bukti`, `created_at`, `updated_at`) VALUES
(46, 'VNR 1', 'PO.2306230001', 'Approved', 'Done', 'Recieved', '40938.png', '1970-08-23 03:37:03', '2023-06-23 02:56:08'),
(47, 'VNR 2', 'PO.2306230002', 'Approved', 'Done', 'Recieved', '30005.jpeg', '1970-08-23 03:37:03', '2023-06-23 01:27:23'),
(48, 'VNR 2', 'PO.2306230003', 'Pending', 'Pending', 'pending', 'None', '1970-08-23 03:37:03', '2023-06-23 09:28:29');

-- --------------------------------------------------------

--
-- Table structure for table `procurment`
--

CREATE TABLE `procurment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nopo` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Kode_vendor` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grandtotal` int(11) NOT NULL,
  `status_pengajuan` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_bayar` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bukti_bayar` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dibuat` date NOT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `procurment`
--

INSERT INTO `procurment` (`id`, `nopo`, `Kode_vendor`, `grandtotal`, `status_pengajuan`, `status_bayar`, `bukti_bayar`, `dibuat`, `email`, `created_at`, `updated_at`) VALUES
(49, 'PO.2306230001', 'VNR 1', 4550000, 'Approved', 'Done', '87607.jpeg', '2023-06-23', 'purchase@purchase', '2023-06-23 01:18:34', '2023-06-23 01:19:30'),
(50, 'PO.2306230002', 'VNR 2', 8290000, 'Approved', 'Done', '24172.jpeg', '2023-06-23', 'purchase@purchase', '2023-06-23 01:19:08', '2023-06-23 01:19:56'),
(51, 'PO.2306230003', 'VNR 2', 305000, 'Pending', 'Pending', 'Pending', '2023-06-23', 'maulanadiki23@gmail.com', '2023-06-23 09:28:12', '2023-06-23 09:28:29');

-- --------------------------------------------------------

--
-- Table structure for table `sell`
--

CREATE TABLE `sell` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pelanggan` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_pelanggan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_jual` date NOT NULL,
  `market_place` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grandtotal` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bukti_pembelian` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stat_keluar` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stat_sell` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bukti_resi` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sell`
--

INSERT INTO `sell` (`id`, `invoice`, `nama_pelanggan`, `alamat_pelanggan`, `telp`, `tgl_jual`, `market_place`, `grandtotal`, `email`, `bukti_pembelian`, `stat_keluar`, `stat_sell`, `bukti_resi`, `created_at`, `updated_at`) VALUES
(4, 'INV2306230001', 'a', 'a', '1', '2023-06-23', '1', '530000', 'sell@sell', '29969.png', 'Approved', 'Pending', 'Pending', '2023-06-23 01:28:38', '2023-06-22 17:00:00'),
(5, 'INV2306230002', 'b', 'b2', '2', '2023-06-23', '1', '700000', 'sell@sell', '46900.png', 'Rejected', 'Pending', 'Pending', '2023-06-23 01:29:28', '2023-06-22 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `selldetail`
--

CREATE TABLE `selldetail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_barang` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jual` int(7) NOT NULL,
  `subtotal` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `selldetail`
--

INSERT INTO `selldetail` (`id`, `invoice`, `kode_barang`, `qty`, `jual`, `subtotal`, `created_at`, `updated_at`) VALUES
(14, 'INV2306230001', 'BRG-00006', '1', 180000, '180000', '2023-06-23 01:28:38', '2023-06-23 01:28:38'),
(15, 'INV2306230001', 'BRG-00009', '1', 180000, '180000', '2023-06-23 01:28:38', '2023-06-23 01:28:38'),
(16, 'INV2306230001', 'BRG-00012', '1', 170000, '170000', '2023-06-23 01:28:38', '2023-06-23 01:28:38'),
(17, 'INV2306230002', 'BRG-00009', '1', 180000, '180000', '2023-06-23 01:29:28', '2023-06-23 01:29:28'),
(18, 'INV2306230002', 'BRG-00008', '1', 180000, '180000', '2023-06-23 01:29:28', '2023-06-23 01:29:28'),
(19, 'INV2306230002', 'BRG-00011', '1', 170000, '170000', '2023-06-23 01:29:28', '2023-06-23 01:29:28'),
(20, 'INV2306230002', 'BRG-00013', '1', 170000, '170000', '2023-06-23 01:29:28', '2023-06-23 01:29:28');

-- --------------------------------------------------------

--
-- Table structure for table `stockgood`
--

CREATE TABLE `stockgood` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_barang` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kuantitas` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stockgood`
--

INSERT INTO `stockgood` (`id`, `kode_barang`, `kuantitas`, `created_at`, `updated_at`) VALUES
(21, 'BRG-00001', 0, '2023-06-19 17:00:00', '2023-06-22 15:29:32'),
(22, 'BRG-00002', 10, '2023-06-19 17:00:00', '2023-06-23 02:56:08'),
(23, 'BRG-00003', 10, '2023-06-19 17:00:00', '2023-06-23 01:27:23'),
(24, 'BRG-00004', 10, '2023-06-19 17:00:00', '2023-06-23 02:56:08'),
(25, 'BRG-00005', 0, '2023-06-19 17:00:00', '2023-06-20 03:20:09'),
(26, 'BRG-00006', 19, '2023-06-19 17:00:00', '2023-06-23 02:56:08'),
(27, 'BRG-00007', 10, '2023-06-19 17:00:00', '2023-06-23 01:27:23'),
(28, 'BRG-00008', 10, '2023-06-19 17:00:00', '2023-06-23 01:27:23'),
(29, 'BRG-00009', 9, '2023-06-19 17:00:00', '2023-06-23 02:55:44'),
(30, 'BRG-00010', 1, '2023-06-19 17:00:00', '2023-06-23 01:27:23'),
(31, 'BRG-00011', 1, '2023-06-20 17:00:00', '2023-06-23 01:27:23'),
(32, 'BRG-00012', 0, '2023-06-20 17:00:00', '2023-06-23 02:55:44'),
(33, 'BRG-00013', 1, '2023-06-20 17:00:00', '2023-06-23 01:27:23'),
(34, 'BRG-00014', 0, '2023-06-20 17:00:00', '2023-06-21 00:36:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` int(2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `level`, `created_at`, `updated_at`) VALUES
(5, 'Diki Maulana', 'maulanadiki23@gmail.com', NULL, '$2y$10$0hqiUS..jbk6Al/oYZ2HTu8V6wG3mwLodGWt3x2sJijIzBMxWnEfm', NULL, 1, NULL, '2023-06-19 19:45:53'),
(12, 'sell', 'sell@sell', NULL, '$2y$10$ck7LnWDT9aiD6n7qzPVG/.YUW3fidjBfVVcXZ95jdCjxC30Zu5dv2', NULL, 4, '2023-06-21 02:05:25', '2023-06-21 02:05:25'),
(16, 'purchase@purchase', 'purchase@purchase', NULL, '$2y$10$AoQwD27WsRixtqvSU2qy9.w9Ngnj1vb5WhadswA5KzZqXnoxD5W4G', NULL, 3, '2023-06-22 15:56:07', '2023-06-22 15:56:07');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_vendor` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `npwp` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pemilik` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_vendor` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `norek` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f_nik` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f_npwp` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f_tabungan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`id`, `kode_vendor`, `nik`, `npwp`, `nama_pemilik`, `nama_vendor`, `telp`, `alamat`, `bank`, `norek`, `f_nik`, `f_npwp`, `f_tabungan`, `created_at`, `updated_at`) VALUES
(4, 'VNR 1', '123', '123', 'maul', 'Athaya Mutiara Gemilang', '9999', 'cileungsi', 'BCA', '999', '52472.jpg', '36509.jpg', '83804.png', '2023-06-07 21:30:41', '2023-06-07 21:30:41'),
(5, 'VNR 2', '123', '123', 'sunyata', 'cakra', '321', 'depok', 'BCA', '44444', '84729.jpg', '35444.jpg', '93942.png', '2023-06-09 18:56:33', '2023-06-09 18:56:33'),
(6, 'VNR 3', '2', '2', 'adverst', 'adverst', '1', 'a', 'BCA', '3333', '64763.jpeg', '27955.jpeg', '11977.jpg', '2023-06-09 23:03:52', '2023-06-09 23:03:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detailprocurment`
--
ALTER TABLE `detailprocurment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employe`
--
ALTER TABLE `employe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pr`
--
ALTER TABLE `pr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `procurment`
--
ALTER TABLE `procurment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sell`
--
ALTER TABLE `sell`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `selldetail`
--
ALTER TABLE `selldetail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stockgood`
--
ALTER TABLE `stockgood`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `detailprocurment`
--
ALTER TABLE `detailprocurment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `employe`
--
ALTER TABLE `employe`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pr`
--
ALTER TABLE `pr`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `procurment`
--
ALTER TABLE `procurment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `sell`
--
ALTER TABLE `sell`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `selldetail`
--
ALTER TABLE `selldetail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `stockgood`
--
ALTER TABLE `stockgood`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
