-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2021 at 04:25 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eassetsmk`
--

-- --------------------------------------------------------

--
-- Table structure for table `budgetings`
--

CREATE TABLE `budgetings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `organitation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `budgetings`
--

INSERT INTO `budgetings` (`id`, `code`, `name`, `created_at`, `updated_at`, `organitation_id`, `user_id`) VALUES
(1, '01', 'Dana BOS MM', '2021-10-19 18:34:20', '2021-10-19 18:34:20', 1, 2),
(2, '02', 'Dana Kas MM', '2021-10-19 18:34:20', '2021-10-19 18:34:20', 1, 3),
(3, '01', 'Dana BOS TKJ', '2021-10-19 18:34:20', '2021-10-19 18:34:20', 2, 4),
(4, '02', 'Dana Kas TKJ', '2021-10-19 18:34:20', '2021-10-19 18:34:20', 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fiscalyears`
--

CREATE TABLE `fiscalyears` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` year(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `organitation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fiscalyears`
--

INSERT INTO `fiscalyears` (`id`, `code`, `year`, `created_at`, `updated_at`, `organitation_id`, `user_id`) VALUES
(1, '20', 2020, '2021-10-19 18:34:20', '2021-10-19 18:34:20', 1, 2),
(2, '21', 2021, '2021-10-19 18:34:20', '2021-10-19 18:34:20', 1, 3),
(3, '20', 2020, '2021-10-19 18:34:20', '2021-10-19 18:34:20', 2, 4),
(4, '21', 2021, '2021-10-19 18:34:20', '2021-10-19 18:34:20', 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no` int(11) NOT NULL,
  `qrcode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `purchase_price` double(20,2) DEFAULT 0.00,
  `good_qty` smallint(6) DEFAULT 0,
  `med_qty` smallint(6) DEFAULT 0,
  `bad_qty` smallint(6) DEFAULT 0,
  `lost_qty` smallint(6) DEFAULT 0,
  `picture` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qrpicture` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `budgeting_id` bigint(20) UNSIGNED DEFAULT NULL,
  `fiscalyear_id` bigint(20) UNSIGNED DEFAULT NULL,
  `itemtype_id` bigint(20) UNSIGNED DEFAULT NULL,
  `storeroom_id` bigint(20) UNSIGNED DEFAULT NULL,
  `organitation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `no`, `qrcode`, `name`, `description`, `purchase_date`, `purchase_price`, `good_qty`, `med_qty`, `bad_qty`, `lost_qty`, `picture`, `qrpicture`, `created_at`, `updated_at`, `budgeting_id`, `fiscalyear_id`, `itemtype_id`, `storeroom_id`, `organitation_id`, `user_id`) VALUES
(1, 1, '01.01.20.001.00001', 'Laptop', 'Laptop Dari Dana BOS', '2021-09-11', 0.00, 15, 0, 0, 0, '', '', '2021-10-19 18:34:20', '2021-10-19 18:34:20', 1, 1, 1, 1, 1, 2),
(2, 1, '01.02.21.002.00001', 'sdad', 'dasdsa', '2021-10-20', 1111111111.00, 12, 212, 2, 22, '', 'qrcode/01/01_02_21_002_00001.png', '2021-10-19 18:34:48', '2021-10-19 18:34:48', 2, 2, 2, 1, 1, 2),
(3, 2, '01.01.20.001.00002', 'dsasad', NULL, '2021-10-14', 23232.00, 54, 5, 6, 8, '', 'qrcode/01/01_01_20_001_00002.png', '2021-10-20 21:22:46', '2021-10-20 21:22:46', 1, 1, 1, 1, 1, 2),
(4, 1, '02.01.20.001.00001', 'sadsad', 'dsadsa', '2021-10-14', 32131.00, 323, 2, 32, 3, '', 'qrcode/02/02_01_20_001_00001.png', '2021-10-20 22:08:54', '2021-10-20 22:08:54', 3, 3, 3, 2, 2, 4),
(5, 1, '02.02.21.002.00001', 'dsad', 'dsad', '2021-10-14', 232.00, 123, 23, 1, 2, '', 'qrcode/02/02_02_21_002_00001.png', '2021-10-20 22:09:29', '2021-10-20 22:09:29', 4, 4, 4, 2, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `itemtypes`
--

CREATE TABLE `itemtypes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shortname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `typename` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `organitation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `itemtypes`
--

INSERT INTO `itemtypes` (`id`, `code`, `shortname`, `typename`, `created_at`, `updated_at`, `organitation_id`, `user_id`) VALUES
(1, '001', 'COMP', 'Peralatan Komputer', '2021-10-19 18:34:20', '2021-10-19 18:34:20', 1, 2),
(2, '002', 'CAM', 'Peralatan Kamera', '2021-10-19 18:34:20', '2021-10-19 18:34:20', 1, 3),
(3, '001', 'NET', 'Peralatan Jaringan', '2021-10-19 18:34:20', '2021-10-19 18:34:20', 2, 4),
(4, '002', 'BOOK', 'Buku Sumber Ajar', '2021-10-19 18:34:20', '2021-10-19 18:34:20', 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2021_10_06_000000_create_organitations_table', 1),
(2, '2021_10_06_000001_create_users_table', 1),
(3, '2021_10_06_000002_create_password_resets_table', 1),
(4, '2021_10_06_000003_create_failed_jobs_table', 1),
(5, '2021_10_06_000004_create_permission_tables', 1),
(6, '2021_10_06_000005_create_budgetings_table', 1),
(7, '2021_10_06_000006_create_fiscalyears_table', 1),
(8, '2021_10_06_000007_create_itemtypes_table', 1),
(9, '2021_10_06_000008_create_storerooms_table', 1),
(10, '2021_10_06_000009_create_inventories_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 2),
(1, 'App\\Models\\User', 4),
(2, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 4),
(3, 'App\\Models\\User', 1),
(3, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 4),
(4, 'App\\Models\\User', 1),
(4, 'App\\Models\\User', 2),
(4, 'App\\Models\\User', 4);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 4),
(3, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 5),
(4, 'App\\Models\\User', 6),
(4, 'App\\Models\\User', 7);

-- --------------------------------------------------------

--
-- Table structure for table `organitations`
--

CREATE TABLE `organitations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shortname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `organitations`
--

INSERT INTO `organitations` (`id`, `code`, `shortname`, `name`, `created_at`, `updated_at`) VALUES
(1, '01', 'mm', 'Multimedia', '2021-10-19 18:34:19', '2021-10-19 18:34:19'),
(2, '02', 'tkj', 'Teknik Komputer dan Jaringan', '2021-10-19 18:34:19', '2021-10-19 18:34:19');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'create.*', 'web', '2021-10-19 18:34:19', '2021-10-19 18:34:19'),
(2, 'read.*', 'web', '2021-10-19 18:34:19', '2021-10-19 18:34:19'),
(3, 'update.*', 'web', '2021-10-19 18:34:19', '2021-10-19 18:34:19'),
(4, 'delete.*', 'web', '2021-10-19 18:34:19', '2021-10-19 18:34:19'),
(5, 'create.sumber_anggaran', 'web', '2021-10-19 18:34:19', '2021-10-19 18:34:19'),
(6, 'read.sumber_anggaran', 'web', '2021-10-19 18:34:19', '2021-10-19 18:34:19'),
(7, 'update.sumber_anggaran', 'web', '2021-10-19 18:34:19', '2021-10-19 18:34:19'),
(8, 'delete.sumber_anggaran', 'web', '2021-10-19 18:34:19', '2021-10-19 18:34:19'),
(9, 'create.organisasi', 'web', '2021-10-19 18:34:19', '2021-10-19 18:34:19'),
(10, 'read.organisasi', 'web', '2021-10-19 18:34:19', '2021-10-19 18:34:19'),
(11, 'update.organisasi', 'web', '2021-10-19 18:34:19', '2021-10-19 18:34:19'),
(12, 'delete.organisasi', 'web', '2021-10-19 18:34:19', '2021-10-19 18:34:19'),
(13, 'create.tahun_anggaran', 'web', '2021-10-19 18:34:19', '2021-10-19 18:34:19'),
(14, 'read.tahun_anggaran', 'web', '2021-10-19 18:34:19', '2021-10-19 18:34:19'),
(15, 'update.tahun_anggaran', 'web', '2021-10-19 18:34:19', '2021-10-19 18:34:19'),
(16, 'delete.tahun_anggaran', 'web', '2021-10-19 18:34:19', '2021-10-19 18:34:19'),
(17, 'create.jenis_barang', 'web', '2021-10-19 18:34:19', '2021-10-19 18:34:19'),
(18, 'read.jenis_barang', 'web', '2021-10-19 18:34:19', '2021-10-19 18:34:19'),
(19, 'update.jenis_barang', 'web', '2021-10-19 18:34:19', '2021-10-19 18:34:19'),
(20, 'delete.jenis_barang', 'web', '2021-10-19 18:34:19', '2021-10-19 18:34:19'),
(21, 'create.penyimpanan', 'web', '2021-10-19 18:34:19', '2021-10-19 18:34:19'),
(22, 'read.penyimpanan', 'web', '2021-10-19 18:34:19', '2021-10-19 18:34:19'),
(23, 'update.penyimpanan', 'web', '2021-10-19 18:34:19', '2021-10-19 18:34:19'),
(24, 'delete.penyimpanan', 'web', '2021-10-19 18:34:19', '2021-10-19 18:34:19');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2021-10-19 18:34:19', '2021-10-19 18:34:19'),
(2, 'kabeng', 'web', '2021-10-19 18:34:19', '2021-10-19 18:34:19'),
(3, 'toolman', 'web', '2021-10-19 18:34:19', '2021-10-19 18:34:19'),
(4, 'user', 'web', '2021-10-19 18:34:19', '2021-10-19 18:34:19');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `storerooms`
--

CREATE TABLE `storerooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shortname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roomname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `organitation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `storerooms`
--

INSERT INTO `storerooms` (`id`, `shortname`, `roomname`, `created_at`, `updated_at`, `organitation_id`, `user_id`) VALUES
(1, 'LAB-MM', 'Laboratorium MM', '2021-10-19 18:34:20', '2021-10-19 18:34:20', 1, 2),
(2, 'LAB-TKJ', 'Laboratorium TKJ', '2021-10-19 18:34:20', '2021-10-19 18:34:20', 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `organitation_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `organitation_id`) VALUES
(1, 'Admin', 'admin@test.id', NULL, '$2y$10$3vy72HAaqKqLmMHCyE07i.paztOhDlDYHvzGU/X59N9YYILEMeVF.', NULL, '2021-10-19 18:34:19', '2021-10-19 18:34:19', NULL),
(2, 'Kabeng MM', 'kabengmm@test.id', NULL, '$2y$10$VNGxohGpdBz/qwUO69AZRe4KZwGGnd00WQulwOYEvZm4rYYWR2eSi', NULL, '2021-10-19 18:34:19', '2021-10-19 18:34:19', 1),
(3, 'Toolman MM', 'toolmanmm@test.id', NULL, '$2y$10$5NY/C9t/dL2aMnHJ7YLJ5.C29s4jP/0d0egG6BCv9t4PwLz5hOFku', NULL, '2021-10-19 18:34:20', '2021-10-19 18:34:20', 1),
(4, 'Kabeng TKJ', 'kabengtkj@test.id', NULL, '$2y$10$IcaDEJ51/ro3klUNCW3YIuQQoNJhkk2vG4y./Ttmenlw.MlhLiWC6', NULL, '2021-10-19 18:34:20', '2021-10-19 18:34:20', 2),
(5, 'Toolman TKJ', 'toolmantkj@test.id', NULL, '$2y$10$K3kK6VUyCA5EMyE7vf9C.uFLc6U/kp/KjWdkOPsx5bqZ34gEzM4F.', NULL, '2021-10-19 18:34:20', '2021-10-19 18:34:20', 2),
(6, 'User MM', 'usermm@test.id', NULL, '$2y$10$33TU0.bzTmo2raFsvCwv8eedzq31ypVBJgVn6bHMMXXPuKfku7FJ6', NULL, '2021-10-19 18:34:20', '2021-10-19 18:34:20', 1),
(7, 'User TKJ', 'usertkj@test.id', NULL, '$2y$10$KBv3YUA4WKeNfnsVMrE6p.P.zxe2INf1jw7cVBNhdsk4xNN10GLY6', NULL, '2021-10-19 18:34:20', '2021-10-19 18:34:20', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `budgetings`
--
ALTER TABLE `budgetings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `budgetings_organitation_id_foreign` (`organitation_id`),
  ADD KEY `budgetings_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fiscalyears`
--
ALTER TABLE `fiscalyears`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fiscalyears_organitation_id_foreign` (`organitation_id`),
  ADD KEY `fiscalyears_user_id_foreign` (`user_id`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventories_budgeting_id_foreign` (`budgeting_id`),
  ADD KEY `inventories_fiscalyear_id_foreign` (`fiscalyear_id`),
  ADD KEY `inventories_itemtype_id_foreign` (`itemtype_id`),
  ADD KEY `inventories_storeroom_id_foreign` (`storeroom_id`),
  ADD KEY `inventories_organitation_id_foreign` (`organitation_id`),
  ADD KEY `inventories_user_id_foreign` (`user_id`);

--
-- Indexes for table `itemtypes`
--
ALTER TABLE `itemtypes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `itemtypes_organitation_id_foreign` (`organitation_id`),
  ADD KEY `itemtypes_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `organitations`
--
ALTER TABLE `organitations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `organitations_code_unique` (`code`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `storerooms`
--
ALTER TABLE `storerooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `storerooms_organitation_id_foreign` (`organitation_id`),
  ADD KEY `storerooms_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_organitation_id_foreign` (`organitation_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `budgetings`
--
ALTER TABLE `budgetings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fiscalyears`
--
ALTER TABLE `fiscalyears`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `itemtypes`
--
ALTER TABLE `itemtypes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `organitations`
--
ALTER TABLE `organitations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `storerooms`
--
ALTER TABLE `storerooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `budgetings`
--
ALTER TABLE `budgetings`
  ADD CONSTRAINT `budgetings_organitation_id_foreign` FOREIGN KEY (`organitation_id`) REFERENCES `organitations` (`id`),
  ADD CONSTRAINT `budgetings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `fiscalyears`
--
ALTER TABLE `fiscalyears`
  ADD CONSTRAINT `fiscalyears_organitation_id_foreign` FOREIGN KEY (`organitation_id`) REFERENCES `organitations` (`id`),
  ADD CONSTRAINT `fiscalyears_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `inventories`
--
ALTER TABLE `inventories`
  ADD CONSTRAINT `inventories_budgeting_id_foreign` FOREIGN KEY (`budgeting_id`) REFERENCES `budgetings` (`id`),
  ADD CONSTRAINT `inventories_fiscalyear_id_foreign` FOREIGN KEY (`fiscalyear_id`) REFERENCES `fiscalyears` (`id`),
  ADD CONSTRAINT `inventories_itemtype_id_foreign` FOREIGN KEY (`itemtype_id`) REFERENCES `itemtypes` (`id`),
  ADD CONSTRAINT `inventories_organitation_id_foreign` FOREIGN KEY (`organitation_id`) REFERENCES `organitations` (`id`),
  ADD CONSTRAINT `inventories_storeroom_id_foreign` FOREIGN KEY (`storeroom_id`) REFERENCES `storerooms` (`id`),
  ADD CONSTRAINT `inventories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `itemtypes`
--
ALTER TABLE `itemtypes`
  ADD CONSTRAINT `itemtypes_organitation_id_foreign` FOREIGN KEY (`organitation_id`) REFERENCES `organitations` (`id`),
  ADD CONSTRAINT `itemtypes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `storerooms`
--
ALTER TABLE `storerooms`
  ADD CONSTRAINT `storerooms_organitation_id_foreign` FOREIGN KEY (`organitation_id`) REFERENCES `organitations` (`id`),
  ADD CONSTRAINT `storerooms_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_organitation_id_foreign` FOREIGN KEY (`organitation_id`) REFERENCES `organitations` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
