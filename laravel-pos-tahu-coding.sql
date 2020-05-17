-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2020 at 03:55 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel-pos-tahu-coding`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history_products`
--

CREATE TABLE `history_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `qty` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qtyChange` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `history_products`
--

INSERT INTO `history_products` (`id`, `product_id`, `user_id`, `qty`, `qtyChange`, `tipe`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '3', '0', 'created product', '2020-05-17 06:43:48', '2020-05-17 06:43:48'),
(2, 2, 1, '3', '0', 'created product', '2020-05-17 06:44:07', '2020-05-17 06:44:07'),
(3, 3, 1, '3', '0', 'created product', '2020-05-17 06:44:47', '2020-05-17 06:44:47'),
(4, 4, 1, '2', '0', 'created product', '2020-05-17 06:45:10', '2020-05-17 06:45:10'),
(5, 5, 1, '4', '0', 'created product', '2020-05-17 06:45:37', '2020-05-17 06:45:37'),
(6, 6, 1, '2', '0', 'created product', '2020-05-17 06:45:53', '2020-05-17 06:45:53'),
(7, 7, 1, '4', '0', 'created product', '2020-05-17 06:46:22', '2020-05-17 06:46:22'),
(8, 8, 1, '2', '0', 'created product', '2020-05-17 06:46:39', '2020-05-17 06:46:39'),
(9, 9, 1, '3', '0', 'created product', '2020-05-17 06:47:05', '2020-05-17 06:47:05'),
(10, 10, 1, '3', '0', 'created product', '2020-05-17 06:47:26', '2020-05-17 06:47:26'),
(11, 11, 1, '2', '0', 'created product', '2020-05-17 06:48:05', '2020-05-17 06:48:05'),
(12, 12, 1, '3', '0', 'created product', '2020-05-17 06:48:36', '2020-05-17 06:48:36'),
(13, 13, 1, '2', '0', 'created product', '2020-05-17 06:48:57', '2020-05-17 06:48:57'),
(14, 13, 1, '2', '2', 'change product qty from admin', '2020-05-17 06:49:47', '2020-05-17 06:49:47'),
(15, 13, 1, '4', '-1', 'change product qty from admin', '2020-05-17 06:49:54', '2020-05-17 06:49:54'),
(16, 12, 1, '3', '-1', 'decrease from transaction', '2020-05-17 06:53:04', '2020-05-17 06:53:04'),
(17, 8, 1, '2', '-1', 'decrease from transaction', '2020-05-17 06:53:04', '2020-05-17 06:53:04'),
(18, 6, 1, '2', '-2', 'decrease from transaction', '2020-05-17 06:53:04', '2020-05-17 06:53:04'),
(19, 13, 1, '3', '-1', 'decrease from transaction', '2020-05-17 06:54:05', '2020-05-17 06:54:05'),
(20, 3, 1, '3', '-1', 'decrease from transaction', '2020-05-17 06:54:05', '2020-05-17 06:54:05'),
(21, 9, 1, '3', '-1', 'decrease from transaction', '2020-05-17 06:54:05', '2020-05-17 06:54:05'),
(22, 11, 1, '2', '-1', 'decrease from transaction', '2020-05-17 06:54:17', '2020-05-17 06:54:17'),
(23, 10, 1, '3', '-1', 'decrease from transaction', '2020-05-17 06:54:17', '2020-05-17 06:54:17'),
(24, 8, 1, '1', '-1', 'decrease from transaction', '2020-05-17 06:54:30', '2020-05-17 06:54:30'),
(25, 2, 1, '3', '-1', 'decrease from transaction', '2020-05-17 06:54:30', '2020-05-17 06:54:30');

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
(4, '2020_05_16_070107_create_products_table', 1),
(5, '2020_05_16_072227_create_transcations_table', 1),
(6, '2020_05_16_072533_create_product_transation_table', 1),
(7, '2020_05_16_120622_create_history_products_table', 1);

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `qty`, `description`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'SUS TUF Gaming FX505', 5500000, 'uploads/images/15897230280-53b3f04ff9cc14bb1142e42bdcac9c6c_600x400.jpg', 3, 'What is Lorem Ipsum?\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2020-05-17 06:43:48', '2020-05-17 06:43:48'),
(2, 'Merk Laptop Terbaik Acer Chromebook 514', 8000000, 'uploads/images/158972304707b7bd971b5eb04d3dce2094c1700a69.jpg', 2, 'What is Lorem Ipsum?\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2020-05-17 06:44:07', '2020-05-17 06:54:30'),
(3, 'Toshiba Portege X20W', 6500000, 'uploads/images/15897230879cc24894a24c30519644e44fb3e32128.jpg', 2, 'awdadaw', 1, '2020-05-17 06:44:47', '2020-05-17 06:54:05'),
(4, 'ASUS VivoBook A442UQ', 7500000, 'uploads/images/15897231106301872_sd.jpg', 2, 'awdawd', 1, '2020-05-17 06:45:10', '2020-05-17 06:45:10'),
(5, 'Lenovo IdeaPad 320 | i7-7500U', 8500000, 'uploads/images/1589723137Asus.png', 4, 'awdawd', 1, '2020-05-17 06:45:37', '2020-05-17 06:45:37'),
(6, 'Dell Inspiron 3567 | i7-7500', 6800000, 'uploads/images/1589723153ASUS_VivoBook_S13_S330FA__L_1.jpg', 0, 'adwawd', 1, '2020-05-17 06:45:53', '2020-05-17 06:53:04'),
(7, 'Acer Aspire E5-473G-76RT', 7500000, 'uploads/images/1589723182caja_pc_unykach_armor_evo_transparente_rgb_01_l.jpg', 4, 'awdawdaw', 1, '2020-05-17 06:46:22', '2020-05-17 06:46:22'),
(8, 'Lenovo Ideapad 320-14IKB', 8000000, 'uploads/images/1589723199download.jpg', 0, 'awdawd', 1, '2020-05-17 06:46:39', '2020-05-17 06:54:30'),
(9, 'HP Chromebook Version 1', 6000000, 'uploads/images/1589723225images.jpg', 2, 'awdawd', 1, '2020-05-17 06:47:05', '2020-05-17 06:54:05'),
(10, 'Asus ZenBook Flip 14 Inch', 8500000, 'uploads/images/1589723246intel_intel_set_pc_gaming_-i7-3770-_rx_570-_4gb-_4gb_ddr5-_free_wifi-_full02_fu9l0nri.jpg', 2, 'awdawd', 1, '2020-05-17 06:47:26', '2020-05-17 06:54:17'),
(11, 'Toshiba P55W-C5316-4K-D1.D', 9000000, 'uploads/images/1589723285MSI_creator_17_02_cropped.0.jpg', 1, 'adwaw', 1, '2020-05-17 06:48:05', '2020-05-17 06:54:17'),
(12, 'Asus ROG Game terbaik', 20000000, 'uploads/images/1589723316unnamed.jpg', 2, 'awdawd', 1, '2020-05-17 06:48:36', '2020-05-17 06:53:04'),
(13, 'Xiaomi Gaming Laptop 18Inch', 15000000, 'uploads/images/1589723337Xiaomi_Gaming_Laptop_L_1.jpg', 2, 'awdawd', 1, '2020-05-17 06:48:57', '2020-05-17 06:54:05');

-- --------------------------------------------------------

--
-- Table structure for table `product_transation`
--

CREATE TABLE `product_transation` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `invoices_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_transation`
--

INSERT INTO `product_transation` (`id`, `product_id`, `invoices_number`, `qty`, `created_at`, `updated_at`) VALUES
(1, 12, 'INV-000001', 1, '2020-05-17 06:53:05', '2020-05-17 06:53:05'),
(2, 8, 'INV-000001', 1, '2020-05-17 06:53:05', '2020-05-17 06:53:05'),
(3, 6, 'INV-000001', 2, '2020-05-17 06:53:05', '2020-05-17 06:53:05'),
(4, 13, 'INV-000002', 1, '2020-05-17 06:54:05', '2020-05-17 06:54:05'),
(5, 3, 'INV-000002', 1, '2020-05-17 06:54:05', '2020-05-17 06:54:05'),
(6, 9, 'INV-000002', 1, '2020-05-17 06:54:05', '2020-05-17 06:54:05'),
(7, 11, 'INV-000003', 1, '2020-05-17 06:54:17', '2020-05-17 06:54:17'),
(8, 10, 'INV-000003', 1, '2020-05-17 06:54:17', '2020-05-17 06:54:17'),
(9, 8, 'INV-000004', 1, '2020-05-17 06:54:30', '2020-05-17 06:54:30'),
(10, 2, 'INV-000004', 1, '2020-05-17 06:54:30', '2020-05-17 06:54:30');

-- --------------------------------------------------------

--
-- Table structure for table `transcations`
--

CREATE TABLE `transcations` (
  `invoices_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `pay` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transcations`
--

INSERT INTO `transcations` (`invoices_number`, `user_id`, `pay`, `total`, `created_at`, `updated_at`) VALUES
('INV-000001', 1, 46000000, 45760000, '2020-05-17 06:53:04', '2020-05-17 06:53:04'),
('INV-000002', 1, 31000000, 30250000, '2020-05-17 06:54:05', '2020-05-17 06:54:05'),
('INV-000003', 1, 20000000, 19250000, '2020-05-17 06:54:17', '2020-05-17 06:54:17'),
('INV-000004', 1, 18000000, 17600000, '2020-05-17 06:54:30', '2020-05-17 06:54:30');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Fadhil Darma Putera Z', 'admin@admin.com', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'BH0vDOLpNq', '2020-05-17 06:42:16', '2020-05-17 06:42:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_products`
--
ALTER TABLE `history_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_transation`
--
ALTER TABLE `product_transation`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history_products`
--
ALTER TABLE `history_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product_transation`
--
ALTER TABLE `product_transation`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
