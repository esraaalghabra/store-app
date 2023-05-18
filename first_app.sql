-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 18, 2023 at 08:54 PM
-- Server version: 5.7.31
-- PHP Version: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `first_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `photo`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Esraa Alghabra', 'esraalghabra@gmail.com', NULL, '$2y$10$Ypi7hrlA3qhAGM0scPFqXe2q./KSGVehTKlZ5CMemZzn54rnnt4xq', '2022-10-23 04:37:33', '2022-10-23 04:37:33');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `main_categories`
--

DROP TABLE IF EXISTS `main_categories`;
CREATE TABLE IF NOT EXISTS `main_categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `main_categories`
--

INSERT INTO `main_categories` (`id`, `name`, `details`, `photo`, `active`, `created_at`, `updated_at`) VALUES
(1, 'الألبسة الرجالية', 'قمصان -ملابس عمل -ملابس داخلية', 'man.svg', 1, NULL, NULL),
(2, 'الألبسة النسائية', 'قمصان -ملابس عمل -ملابس داخلية', 'woman.svg', 1, NULL, NULL),
(3, 'ألبسة الأطفال', 'قمصان -ملابس عمل -ملابس داخلية', 'child.svg', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_10_17_191429_create_main_categories_table', 2),
(6, '2022_10_17_193433_create_sub_categories_table', 3),
(7, '2022_10_17_194407_create_products_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `main_category_id` bigint(20) UNSIGNED NOT NULL,
  `sub_category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `discounts` int(11) NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_main_category_id_foreign` (`main_category_id`),
  KEY `products_sub_category_id_foreign` (`sub_category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `main_category_id`, `sub_category_id`, `name`, `details`, `price`, `amount`, `discounts`, `photo`, `active`, `created_at`, `updated_at`) VALUES
(2, 2, 2, 'phone', 'www www www www www www www www www www www www www www www www www www www www www www www www www www www www www www www www www www ', 20000, 200, 20, '1.png', 1, NULL, NULL),
(1, 1, 1, '1', 'sss sss sss sss sss sss sss sss sss sss sss sss sss sss sss sss sss sss sss sss sss sss sss ', 1, 1, 1, 'laptop.png', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

DROP TABLE IF EXISTS `sub_categories`;
CREATE TABLE IF NOT EXISTS `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `main_category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sub_categories_main_category_id_foreign` (`main_category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `main_category_id`, `name`, `details`, `photo`, `active`, `created_at`, `updated_at`) VALUES
(1, 1, 'ألبسة عمل', 'قمصان - ملابس عمل - ملابس أطقم رسمية', 'Man\'s underwear.svg', 1, NULL, NULL),
(2, 1, 'ألبسة داخلية', 'قمصان - شورتات -بنتكورات', 'woman formal wear.svg', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verify_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `verify_code`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(14, 'osamaa', 'osamaaabdalmalik@gmail.com', '15086', '2023-03-31 04:20:34', '$2y$10$y1clAiCpgHsziRkl8kkfrei27WrAsA4rS6fSjF.5PpvHKB921xfUm', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL3Jlc2V0LXBhc3N3b3JkIiwiaWF0IjoxNjgwMjQzNjM0LCJleHAiOjM0ODAyNDM2MzQsIm5iZiI6MTY4MDI0MzYzNCwianRpIjoiOTh5dWsya2JoU3dIVURNWSIsInN1YiI6IjE0IiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.u0sMw4_4IOExVyLsfZEDFkc6aqBZW7XyG6-du-Z9-68', '2022-10-20 10:31:40', '2023-04-03 05:34:20'),
(21, 'esraasy', 'esrasy@gmail.com', NULL, NULL, '$2y$10$eADg8hMXm8GWs0s0Ukgeg.6UJS6ULk89Si4DH/bcW/gB.RWxmL0O6', NULL, '2023-03-30 08:45:58', '2023-03-30 08:45:58'),
(15, 'osama', 'esraa@gmail.com', NULL, NULL, '$2y$10$uxkurqhaJvR5JMgtZqJATeRwZyBg7nqkEXPO/y6n9tGloHROquJCC', NULL, '2022-10-20 13:51:14', '2022-10-20 13:51:14'),
(16, 'esraa', 'esraaddd@gmail.com', NULL, NULL, '$2y$10$YUxe1LPYGrbKUpDoCOchpe.IZ7EguWStnn.DMkksWCOI0rgZ0Wkpu', NULL, '2022-10-24 09:12:38', '2022-10-24 09:12:38'),
(17, 'osama', 'esrssaa@gmail.com', NULL, NULL, '$2y$10$Aus9hr176SSkWEU1qQw69O/7J/wbicK5bWYYV1XelNrAkAQWYlRi2', NULL, '2022-10-24 09:58:23', '2022-10-24 09:58:23'),
(18, 'osama', 'osamddsaaabdalmalik@gmail.com', NULL, NULL, '$2y$10$9Yp.DXcQWesZSR5X4QYxwOA4.XzBrGWeAD51mKaqm41SPRqvdzfpS', NULL, '2022-11-24 10:32:54', '2022-11-24 10:32:54'),
(19, 'osama', 'osajhsgabdalmalik@gmail.com', NULL, NULL, '$2y$10$5YgAFeX7ZPYsJgHOK31YFeAKLGCmWOjQ1qz5xK9i92K0xToflTGlS', NULL, '2022-11-24 10:37:34', '2022-11-24 10:37:34'),
(20, 'esraasy', 'esraasy@gmail.com', NULL, NULL, '$2y$10$eZf7fGumN0gJh3tsgERtf.vszSQnK7TwauaapqaXSIgK/xsVuccCa', NULL, '2023-03-30 08:08:52', '2023-03-30 08:08:52'),
(22, 'esraa', 'esraaalghabra3040@gmail.com', '63587', '2023-04-03 05:51:31', '$2y$10$E5Jq5Uzq69Pw3J5X64Ji3exRvVRReXtuf3jatrCX0UlNljfd9Sviu', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL3ZlcmlmeS1jb2RlIiwiaWF0IjoxNjgwNTA4MjkxLCJleHAiOjM0ODA1MDgyOTEsIm5iZiI6MTY4MDUwODI5MSwianRpIjoiYkJ1blRRa1lRRU5aZ041QSIsInN1YiI6IjIyIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.4wOfE-I6aMSL-RixSMYON91lRP5PdV7F5RPsQPSdE7w', '2023-03-30 09:34:23', '2023-05-18 18:47:21');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
