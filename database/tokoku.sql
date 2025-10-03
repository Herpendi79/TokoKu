-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 03, 2025 at 11:49 PM
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
-- Database: `tokoku`
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
(4, '2025_09_13_222254_create_produk_models_table', 1),
(5, '2025_09_20_095441_add_role_to_users_table', 1),
(6, '2025_10_03_120340_create_transaksi_table', 2),
(7, '2025_10_03_124009_create_transaksi_table', 3),
(8, '2025_10_03_124415_rename_id_to_user_id_in_users_table', 4);

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
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `foto_produk` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `deskripsi_produk` text NOT NULL,
  `harga_produk` bigint(20) NOT NULL,
  `stock_produk` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `foto_produk`, `nama_produk`, `deskripsi_produk`, `harga_produk`, `stock_produk`, `created_at`, `updated_at`) VALUES
(2, 'pVsJp0fF1przdvPFEKHVo7LiHp0XZT5POpW3nXeq.png', 'Pancasila dan Kewarganegaraan', '<p>Buku dasar hukum Indonesia</p>', 150000, 20, '2025-10-01 08:44:29', '2025-10-01 08:44:29'),
(4, 'EAyzLKq6ArckcmeaGvzIIBElKejKih2MznKkVZ6t.png', 'Pemrograman Basis Data', '<p>Buku dasar Basis Data</p>', 100000, 10, '2025-10-01 08:52:20', '2025-10-01 08:52:20');

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
('bry2Bp6pPOIdwJ7he0XnuAB6v0hgtvSrQCPWB2UM', NULL, '127.0.0.1', 'Veritrans', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiZHdNT2hvWnJHUE5SRHBEV1Q5VzhzN3NuRm9TZDQ3OERiNFN0ZG9ySSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1759506700),
('EApqiWGLDpMScbEak1j0UoTabtINHuTZcUozmfqv', NULL, '127.0.0.1', 'Veritrans', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiblBXUHQ2NVBCWEo2S2JZdDZib2JNQjdvRW5jSGIxZW43Ym1DaURLUiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1759506292),
('gRjwboGl3uV33MZ0KUjrHWsVDAvkkudONNhgaOUl', NULL, '127.0.0.1', 'Veritrans', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiV1pXUDN1Z2NNY3pHa0REUVRoeHE2dmowb3o1cGJjQklpalhabFRZQiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1759506676),
('Jb0gnBfWEdHYeDuBImqKnqFNwK89esfrqj8SHG8h', NULL, '127.0.0.1', 'Veritrans', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoicGl1VUlWWHc1WlNZdVY3SG8yU3V3V1FDMExEcXpsV2h3d09jU3JWQiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1759506135),
('kgYlMB5Hro68LAuicX60eJ4v2errVTRwir2EPHHu', NULL, '127.0.0.1', 'Veritrans', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiWkk0WlpKMTFmMXB2S1dKbnVnUjRGUmlRaXZsOU1qaHk3NTV6ZEtocyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1759506525),
('KkPxnrcF0lEWcnnafg2CTIMI2LzCCe4tpVnB1VuE', NULL, '127.0.0.1', 'Veritrans', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiWldNVWZMQVh6UGZ5MUpMczhDN05TMEZGNjBsQ3hrcTBiUE5ZaGNoayI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1759506163),
('McoZcsVAFM3lWDlPxi29QdWX1647qnyrRbRUxlha', 2, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Safari/605.1.15', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicDNnZDJuaDBweWtocUdQMEdQTzhzYXN1YnRFV2RqazRzaU9ZUzd4WCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyL3Byb2R1ay9oaXN0b3J5Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1759503408),
('N3JYAm7wUYOTevfIhXrzPFmq7i34PjcXAE4d9EMC', NULL, '127.0.0.1', 'PostmanRuntime/7.48.0', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiNEh1TW9IdmJvcDltdFE3QVFqcFhFeGRhcGRUbThDNVhNQ3lVUnM4NiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1759506962),
('nUMxbCDzk9ix7E8icOPb7IkhOGxU3exq9rNexA6G', 2, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.6 Safari/605.1.15', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoielZEbEJsNnF0c01rd29tS3F6STFTTVF1Q2pCbk9nSXd1SFlYTHNzZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTQ6Imh0dHA6Ly85ZGU0OGQyYWVjMDUubmdyb2stZnJlZS5hcHAvdXNlci9wcm9kdWsvaGlzdG9yeSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1759511640),
('oyZ6Hinkypjstlh662xCCMOFs2w33HmGPy92bJtN', NULL, '127.0.0.1', 'Veritrans', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoidzNGeDNoSmRtcU1IcTdMc3JpNEZPQVY1ZmpHUlpIcHJwZ2NiR1VaVCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1759506289),
('uZBOpmmi6stH9x5mZo12hp9YbEvUh5M1ZjWFWHHd', NULL, '127.0.0.1', 'Veritrans', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoibzNGUEowcmt4cjRTU0xGa0F1Z1R2a1lNMzdPZTJScUV0R0xLZHhzcSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1759506259);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `transaksi_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `status` varchar(255) NOT NULL,
  `snap_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`transaksi_id`, `user_id`, `id`, `order_id`, `price`, `status`, `snap_token`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 'ORDER-1759499630', 150000.00, 'pending', '06c982e5-08cc-44e4-86bf-b44362315d75', '2025-10-03 06:53:50', '2025-10-03 06:53:50'),
(2, 2, 4, 'ORDER-1759500441', 100000.00, 'pending', 'e659aa8b-b601-4228-83ae-ff7f05e33b91', '2025-10-03 07:07:21', '2025-10-03 07:07:21'),
(3, 2, 2, 'ORDER-1759501907', 150000.00, 'pending', 'd26c8cb7-350e-4cc4-9130-5b6de4660a3f', '2025-10-03 07:31:47', '2025-10-03 07:31:47'),
(4, 2, 2, 'ORDER-1759502129', 150000.00, 'pending', '2b042335-cc45-4727-9441-c4bd1ac85283', '2025-10-03 07:35:29', '2025-10-03 07:35:29'),
(5, 2, 2, 'ORDER-1759502154', 150000.00, 'pending', '7700077f-9373-4116-8697-a0d58385fcea', '2025-10-03 07:35:54', '2025-10-03 07:35:54'),
(6, 2, 2, 'ORDER-1759502182', 150000.00, 'pending', '763076e5-70ba-4a4f-a057-9e607b520741', '2025-10-03 07:36:22', '2025-10-03 07:36:22'),
(7, 2, 2, 'ORDER-1759502220', 150000.00, 'pending', '9c208b7b-ff19-4fa1-af9b-bfa6c4423ada', '2025-10-03 07:37:00', '2025-10-03 07:37:00'),
(8, 2, 2, 'ORDER-1759502654', 150000.00, 'pending', 'd00aa338-98f7-4143-ae53-49537cc9ea26', '2025-10-03 07:44:14', '2025-10-03 07:44:14'),
(9, 2, 4, 'ORDER-1759504767', 100000.00, 'success', 'ea2b144b-4dd7-4fd8-bf14-83c81b99036a', '2025-10-03 08:19:27', '2025-10-03 10:13:47'),
(10, 2, 4, 'ORDER-1759506159', 100000.00, 'pending', '15753ac0-e1ce-4f15-944c-a0c50e21a24a', '2025-10-03 08:42:39', '2025-10-03 08:42:39'),
(11, 2, 4, 'ORDER-1759510906', 100000.00, 'expired', 'e25aa157-59f9-4f4c-81c0-6b243fc669be', '2025-10-03 10:01:46', '2025-10-03 10:05:48'),
(12, 2, 4, 'ORDER-1759511467', 100000.00, 'success', '573c2cc2-6801-4a51-8d33-c0882f22e7a3', '2025-10-03 10:11:07', '2025-10-03 10:11:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$12$yxmgkph4AaYvhE4HzAyONuaJGVfBlNwS8i4UP5M82Va1k6mtbHckO', 'admin', NULL, '2025-10-01 08:33:57', '2025-10-01 08:33:57'),
(2, 'Budi', 'budi@gmail.com', NULL, '$2y$12$IRQyt9buxIV2tOJOyJpkbOn0kEcWH7QSwlKbu5zT5J5emWp9lb/Y.', 'user', NULL, '2025-10-01 08:35:07', '2025-10-01 08:35:07');

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
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`transaksi_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
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
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `transaksi_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
