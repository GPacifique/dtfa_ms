-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 22, 2025 at 07:06 AM
-- Server version: 11.4.8-MariaDB-cll-lve-log
-- PHP Version: 8.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `avanvyov_samsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `target_type` varchar(255) DEFAULT NULL,
  `target_id` bigint(20) UNSIGNED DEFAULT NULL,
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audit_logs`
--

INSERT INTO `audit_logs` (`id`, `user_id`, `action`, `target_type`, `target_id`, `meta`, `created_at`, `updated_at`) VALUES
(1, 2, 'user.patched', 'App\\Models\\User', 3, '{"roles":null,"branch_id":null,"group_id":null}', '2025-10-26 23:55:53', '2025-10-26 23:55:53'),
(2, 2, 'user.patched', 'App\\Models\\User', 3, '{"roles":["admin"],"branch_id":null,"group_id":null}', '2025-10-26 23:56:04', '2025-10-26 23:56:04'),
(3, 2, 'user.patched', 'App\\Models\\User', 4, '{"roles":["coach"],"branch_id":null,"group_id":null}', '2025-10-26 23:56:29', '2025-10-26 23:56:29'),
(4, 3, 'user.created', 'App\\Models\\User', 5, '{"email":"celestin@gmail.com","roles":["Accountant"]}', '2025-10-27 01:54:27', '2025-10-27 01:54:27'),
(5, 3, 'user.patched', 'App\\Models\\User', 3, '{"roles":["Accountant"],"branch_id":null,"group_id":null}', '2025-10-27 02:00:26', '2025-10-27 02:00:26'),
(6, 2, 'user.patched', 'App\\Models\\User', 3, '{"roles":["Accountant"],"branch_id":null,"group_id":null}', '2025-10-27 02:05:07', '2025-10-27 02:05:07'),
(7, 2, 'user.patched', 'App\\Models\\User', 3, '{"roles":["admin"],"branch_id":null,"group_id":null}', '2025-10-27 02:11:53', '2025-10-27 02:11:53'),
(8, 2, 'user.patched', 'App\\Models\\User', 6, '{"roles":["super-admin"],"branch_id":null,"group_id":null}', '2025-10-27 06:05:39', '2025-10-27 06:05:39'),
(9, 2, 'user.patched', 'App\\Models\\User', 7, '{"roles":["Parent"],"branch_id":null,"group_id":null}', '2025-10-28 13:16:07', '2025-10-28 13:16:07'),
(10, 2, 'user.patched', 'App\\Models\\User', 3, '{"roles":["accountant"],"branch_id":null,"group_id":null}', '2025-10-28 13:16:24', '2025-10-28 13:16:24'),
(11, 2, 'user.patched', 'App\\Models\\User', 2, '{"roles":["super-admin"],"branch_id":null,"group_id":null}', '2025-10-28 13:17:23', '2025-10-28 13:17:23'),
(12, 2, 'user.patched', 'App\\Models\\User', 8, '{"roles":["admin"],"branch_id":null,"group_id":null}', '2025-10-28 14:04:48', '2025-10-28 14:04:48'),
(13, 2, 'user.patched', 'App\\Models\\User', 8, '{"roles":["accountant","admin","coach","Parent","super-admin"],"branch_id":null,"group_id":null}', '2025-10-28 14:39:43', '2025-10-28 14:39:43'),
(14, 2, 'user.created', 'App\\Models\\User', 9, '{"email":"gashumbaaimable@gmail.com","roles":["accountant","admin","coach","Parent","super-admin"]}', '2025-10-28 14:50:53', '2025-10-28 14:50:53'),
(15, 2, 'user.patched', 'App\\Models\\User', 2, '{"roles":["accountant","admin","coach","Parent","super-admin"],"branch_id":null,"group_id":null}', '2025-10-28 17:43:51', '2025-10-28 17:43:51'),
(16, 2, 'user.patched', 'App\\Models\\User', 4, '{"roles":["accountant","admin","coach","Parent","super-admin"],"branch_id":null,"group_id":null}', '2025-10-28 17:44:08', '2025-10-28 17:44:08'),
(17, 2, 'user.deleted', 'App\\Models\\User', 3, '{"email":"accountant@mail.com"}', '2025-10-28 17:44:18', '2025-10-28 17:44:18'),
(18, 2, 'user.deleted', 'App\\Models\\User', 5, '{"email":"celestin@gmail.com"}', '2025-10-28 17:44:43', '2025-10-28 17:44:43'),
(19, 2, 'user.deleted', 'App\\Models\\User', 4, '{"email":"admn@example.com"}', '2025-10-28 17:44:53', '2025-10-28 17:44:53'),
(20, 2, 'user.deleted', 'App\\Models\\User', 6, '{"email":"superadmin@example.com"}', '2025-10-28 17:45:12', '2025-10-28 17:45:12'),
(21, 2, 'user.patched', 'App\\Models\\User', 10, '{"roles":["accountant","admin","coach","Parent","super-admin"],"branch_id":null,"group_id":null}', '2025-10-28 17:45:30', '2025-10-28 17:45:30'),
(22, 2, 'user.deleted', 'App\\Models\\User', 1, '{"email":"test@example.com"}', '2025-10-28 17:45:50', '2025-10-28 17:45:50'),
(23, 9, 'user.patched', 'App\\Models\\User', 7, '{"roles":["accountant","admin","coach","Parent"],"branch_id":null,"group_id":null}', '2025-10-30 13:20:08', '2025-10-30 13:20:08'),
(24, 2, 'user.patched', 'App\\Models\\User', 12, '{"roles":["coach"],"branch_id":null,"group_id":null}', '2025-11-01 00:42:47', '2025-11-01 00:42:47'),
(25, 2, 'user.patched', 'App\\Models\\User', 2, '{"roles":["accountant","admin","coach","Parent","super-admin"],"branch_id":null,"group_id":null}', '2025-11-20 12:40:52', '2025-11-20 12:40:52');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`, `code`, `address`, `phone`, `created_at`, `updated_at`) VALUES
(2, 'MASAKA', 'MSK', NULL, NULL, '2025-10-27 01:48:07', '2025-10-27 01:48:07'),
(3, 'KICUKIRO', 'KCK', NULL, NULL, '2025-10-27 01:48:07', '2025-10-27 01:48:07'),
(4, 'MWANZA', 'MWZ', NULL, NULL, '2025-10-27 01:48:08', '2025-10-27 01:48:08');

-- --------------------------------------------------------

--
-- Table structure for table `branch_plan_prices`
--

CREATE TABLE `branch_plan_prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `subscription_plan_id` bigint(20) UNSIGNED NOT NULL,
  `price_cents` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('sportacademyms-cache-gashumba@siteledger.com|102.22.184.152', 'i:3;', 1763529089),
('sportacademyms-cache-gashumba@siteledger.com|102.22.184.152:timer', 'i:1763529089;', 1763529089),
('sportacademyms-cache-gashumbaaimable@gmail.com|102.22.184.152', 'i:1;', 1763570958),
('sportacademyms-cache-gashumbaaimable@gmail.com|102.22.184.152:timer', 'i:1763570958;', 1763570958),
('sportacademyms-cache-spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:72:{i:0;a:4:{s:1:\"a\";s:1:\"1\";s:1:\"b\";s:12:\"manage users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:6;}}i:1;a:4:{s:1:\"a\";s:1:\"2\";s:1:\"b\";s:12:\"manage teams\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:6;}}i:2;a:4:{s:1:\"a\";s:1:\"3\";s:1:\"b\";s:15:\"manage finances\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:5;i:2;i:6;}}i:3;a:4:{s:1:\"a\";s:1:\"4\";s:1:\"b\";s:13:\"view invoices\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:5;i:2;i:6;}}i:4;a:4:{s:1:\"a\";s:1:\"5\";s:1:\"b\";s:15:\"view child info\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:4;i:2;i:6;}}i:5;a:4:{s:1:\"a\";s:1:\"6\";s:1:\"b\";s:22:\"view training schedule\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:4;i:3;i:6;}}i:6;a:4:{s:1:\"a\";s:1:\"7\";s:1:\"b\";s:10:\"view users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:6;}}i:7;a:4:{s:1:\"a\";s:1:\"8\";s:1:\"b\";s:12:\"create users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:6;}}i:8;a:4:{s:1:\"a\";s:1:\"9\";s:1:\"b\";s:10:\"edit users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:6;}}i:9;a:4:{s:1:\"a\";s:2:\"10\";s:1:\"b\";s:12:\"delete users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:6;}}i:10;a:4:{s:1:\"a\";s:2:\"11\";s:1:\"b\";s:13:\"restore users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:6;}}i:11;a:4:{s:1:\"a\";s:2:\"12\";s:1:\"b\";s:13:\"view students\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:5;i:3;i:6;}}i:12;a:4:{s:1:\"a\";s:2:\"13\";s:1:\"b\";s:15:\"create students\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:6;}}i:13;a:4:{s:1:\"a\";s:2:\"14\";s:1:\"b\";s:13:\"edit students\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:6;}}i:14;a:4:{s:1:\"a\";s:2:\"15\";s:1:\"b\";s:15:\"delete students\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:6;}}i:15;a:4:{s:1:\"a\";s:2:\"16\";s:1:\"b\";s:15:\"manage students\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:6;}}i:16;a:4:{s:1:\"a\";s:2:\"17\";s:1:\"b\";s:13:\"view branches\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:6;}}i:17;a:4:{s:1:\"a\";s:2:\"18\";s:1:\"b\";s:15:\"create branches\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:6;}}i:18;a:4:{s:1:\"a\";s:2:\"19\";s:1:\"b\";s:13:\"edit branches\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:6;}}i:19;a:4:{s:1:\"a\";s:2:\"20\";s:1:\"b\";s:15:\"delete branches\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:6;}}i:20;a:4:{s:1:\"a\";s:2:\"21\";s:1:\"b\";s:15:\"manage branches\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:6;}}i:21;a:4:{s:1:\"a\";s:2:\"22\";s:1:\"b\";s:11:\"view groups\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:6;}}i:22;a:4:{s:1:\"a\";s:2:\"23\";s:1:\"b\";s:13:\"create groups\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:6;}}i:23;a:4:{s:1:\"a\";s:2:\"24\";s:1:\"b\";s:11:\"edit groups\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:6;}}i:24;a:4:{s:1:\"a\";s:2:\"25\";s:1:\"b\";s:13:\"delete groups\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:6;}}i:25;a:4:{s:1:\"a\";s:2:\"26\";s:1:\"b\";s:13:\"manage groups\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:6;}}i:26;a:4:{s:1:\"a\";s:2:\"27\";s:1:\"b\";s:22:\"view training sessions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:6;}}i:27;a:4:{s:1:\"a\";s:2:\"28\";s:1:\"b\";s:24:\"create training sessions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:6;}}i:28;a:4:{s:1:\"a\";s:2:\"29\";s:1:\"b\";s:22:\"edit training sessions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:6;}}i:29;a:4:{s:1:\"a\";s:2:\"30\";s:1:\"b\";s:24:\"delete training sessions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:6;}}i:30;a:4:{s:1:\"a\";s:2:\"31\";s:1:\"b\";s:24:\"manage training sessions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:6;}}i:31;a:4:{s:1:\"a\";s:2:\"32\";s:1:\"b\";s:23:\"view subscription plans\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:5;i:2;i:6;}}i:32;a:4:{s:1:\"a\";s:2:\"33\";s:1:\"b\";s:25:\"create subscription plans\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:6;}}i:33;a:4:{s:1:\"a\";s:2:\"34\";s:1:\"b\";s:23:\"edit subscription plans\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:6;}}i:34;a:4:{s:1:\"a\";s:2:\"35\";s:1:\"b\";s:25:\"delete subscription plans\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:6;}}i:35;a:4:{s:1:\"a\";s:2:\"36\";s:1:\"b\";s:25:\"manage subscription plans\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:6;}}i:36;a:4:{s:1:\"a\";s:2:\"37\";s:1:\"b\";s:18:\"view subscriptions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:5;i:2;i:6;}}i:37;a:4:{s:1:\"a\";s:2:\"38\";s:1:\"b\";s:20:\"create subscriptions\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:5;i:2;i:6;}}i:38;a:4:{s:1\"a\";s:2\"39\";s:1\"b\";s:18\"edit subscriptions\";s:1\"c\";s:3\"web\";s:1\"r\";a:3:{i:0;i:1;i:1;i:5;i:2;i:6;}}i:39;a:4:{s:1\"a\";s:2\"40\";s:1\"b\";s:20\"delete subscriptions\";s:1\"c\";s:3\"web\";s:1\"r\";a:2:{i:0;i:1;i:1;i:6;}}i:40;a:4:{s:1\"a\";s:2\"41\";s:1\"b\";s:20\"manage subscriptions\";s:1\"c\";s:3\"web\";s:1\"r\";a:3:{i:0;i:1;i:1;i:5;i:2;i:6;}}i:41;a:4:{s:1\"a\";s:2\"42\";s:1\"b\";s:15\"create invoices\";s:1\"c\";s:3\"web\";s:1\"r\";a:3:{i:0;i:1;i:1;i:5;i:2;i:6;}}i:42;a:4:{s:1\"a\";s:2\"43\";s:1\"b\";s:13\"edit invoices\";s:1\"c\";s:3\"web\";s:1\"r\";a:3:{i:0;i:1;i:1;i:5;i:2;i:6;}}i:43;a:4:{s:1\"a\";s:2\"44\";s:1\"b\";s:15\"delete invoices\";s:1\"c\";s:3\"web\";s:1\"r\";a:2:{i:0;i:1;i:1;i:6;}}i:44;a:4:{s:1\"a\";s:2\"45\";s:1\"b\";s:15\"manage invoices\";s:1\"c\";s:3\"web\";s:1\"r\";a:3:{i:0;i:1;i:1;i:5;i:2;i:6;}}i:45;a:4:{s:1\"a\";s:2\"46\";s:1\"b\";s:13\"view payments\";s:1\"c\";s:3\"web\";s:1\"r\";a:3:{i:0;i:1;i:1;i:5;i:2;i:6;}}i:46;a:4:{s:1\"a\";s:2\"47\";s:1\"b\";s:15\"create payments\";s:1\"c\";s:3\"web\";s:1\"r\";a:3:{i:0;i:1;i:1;i:5;i:2;i:6;}}i:47;a:4:{s:1\"a\";s:2\"48\";s:1\"b\";s:13\"edit payments\";s:1\"c\";s:3\"web\";s:1\"r\";a:2:{i:0;i:1;i:1;i:6;}}i:48;a:4:{s:1\"a\";s:2\"49\";s:1\"b\";s:15\"delete payments\";s:1\"c\";s:3\"web\";s:1\"r\";a:2:{i:0;i:1;i:1;i:6;}}i:49;a:4:{s:1\"a\";s:2\"50\";s:1\"b\";s:15\"manage payments\";s:1\"c\";s:3\"web\";s:1\"r\";a:3:{i:0;i:1;i:1;i:5;i:2;i:6;}}i:50;a:4:{s:1\"a\";s:2\"51\";s:1\"b\";s:15\"record payments\";s:1\"c\";s:3\"web\";s:1\"r\";a:3:{i:0;i:1;i:1;i:5;i:2;i:6;}}i:51;a:4:{s:1\"a\";s:2\"52\";s:1\"b\";s:13\"view finances\";s:1\"c\";s:3\"web\";s:1\"r\";a:3:{i:0;i:1;i:1;i:5;i:2;i:6;}}i:52;a:4:{s:1\"a\";s:2\"53\";s:1\"b\";s:22\"view financial reports\";s:1\"c\";s:3\"web\";s:1\"r\";a:3:{i:0;i:1;i:1;i:5;i:2;i:6;}}i:53;a:4:{s:1\"a\";s:2\"54\";s:1\"b\";s:21\"export financial data\";s:1\"c\";s:3\"web\";s:1\"r\";a:3:{i:0;i:1;i:1;i:5;i:2;i:6;}}i:54;a:4:{s:1\"a\";s:2\"55\";s:1\"b\";s:10\"view teams\";s:1\"c\";s:3\"web\";s:1\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:6;}}i:55;a:4:{s:1\"a\";s:2\"56\";s:1\"b\";s:17\"view own invoices\";s:1\"c\";s:3\"web\";s:1\"r\";a:3:{i:0;i:1;i:1;i:4;i:2;i:6;}}i:56;a:4:{s:1\"a\";s:2\"57\";s:1\"b\";s:13\"make payments\";s:1\"c\";s:3\"web\";s:1\"r\";a:3:{i:0;i:1;i:1;i:4;i:2;i:6;}}i:57;a:4:{s:1\"a\";s:2\"58\";s:1\"b\";s:12\"view reports\";s:1\"c\";s:3\"web\";s:1\"r\";a:3:{i:0;i:1;i:1;i:5;i:2;i:6;}}i:58;a:4:{s:1\"a\";s:2\"59\";s:1\"b\";s:14\"view dashboard\";s:1\"c\";s:3\"web\";s:1\"r\";a:5:{i:0;i:1;i:1;i:2;i:2;i:4;i:3;i:5;i:4;i:6;}}i:59;a:4:{s:1\"a\";s:2\"60\";s:1\"b\";s:14\"view analytics\";s:1\"c\";s:3\"web\";s:1\"r\";a:3:{i:0;i:1;i:1;i:5;i:2;i:6;}}i:60;a:4:{s:1\"a\";s:2\"61\";s:1\"b\";s:13\"view expenses\";s:1\"c\";s:3\"web\";s:1\"r\";a:3:{i:0;i:1;i:1;i:5;i:2;i:6;}}i:61;a:4:{s:1\"a\";s:2\"62\";s:1\"b\";s:15\"create expenses\";s:1\"c\";s:3\"web\";s:1\"r\";a:3:{i:0;i:1;i:1;i:5;i:2;i:6;}}i:62;a:4:{s:1\"a\";s:2\"63\";s:1\"b\";s:13\"edit expenses\";s:1\"c\";s:3\"web\";s:1\"r\";a:3:{i:0;i:1;i:1;i:5;i:2;i:6;}}i:63;a:4:{s:1\"a\";s:2\"64\";s:1\"b\";s:15\"delete expenses\";s:1\"c\";s:3\"web\";s:1\"r\";a:3:{i:0;i:1;i:1;i:5;i:2;i:6;}}i:64;a:4:{s:1\"a\";s:2\"65\";s:1\"b\";s:15\"manage expenses\";s:1\"c\";s:3\"web\";s:1\"r\";a:3:{i:0;i:1;i:1;i:5;i:2;i:6;}}i:65;a:4:{s:1\"a\";s:2\"66\";s:1\"b\";s:16\"approve expenses\";s:1\"c\";s:3\"web\";s:1\"r\";a:3:{i:0;i:1;i:1;i:5;i:2;i:6;}}i:66;a:4:{s:1\"a\";s:2\"67\";s:1\"b\";s:15\"reject expenses\";s:1\"c\";s:3\"web\";s:1\"r\";a:3:{i:0;i:1;i:1;i:5;i:2;i:6;}}i:67;a:4:{s:1\"a\";s:2\"68\";s:1\"b\";s:14\"view equipment\";s:1\"c\";s:3\"web\";s:1\"r\";a:4:{i:0;i:1;i:1;i:2;i:2;i:5;i:3;i:6;}}i:68;a:4:{s:1\"a\";s:2\"69\";s:1\"b\";s:16\"create equipment\";s:1\"c\";s:3\"web\";s:1\"r\";a:2:{i:0;i:1;i:1;i:6;}}i:69;a:4:{s:1\"a\";s:2\"70\";s:1\"b\";s:14\"edit equipment\";s:1\"c\";s:3\"web\";s:1\"r\";a:2:{i:0;i:1;i:1;i:6;}}i:70;a:4:{s:1\"a\";s:2\"71\";s:1\"b\";s:16\"delete equipment\";s:1\"c\";s:3\"web\";s:1\"r\";a:2:{i:0;i:1;i:1;i:6;}}i:71;a:4:{s:1\"a\";s:2\"72\";s:1\"b\";s:16\"manage equipment\";s:1\"c\";s:3\"web\";s:1\"r\";a:2:{i:0;i:1;i:1;i:6;}}}s:5:\"roles\";a:5:{i:0;a:3:{s:1:\"a\";s:1:\"1\";s:1:\"b\";s:5:\"admin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";s:1:\"6\";s:1:\"b\";s:11:\"super-admin\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";s:1:\"2\";s:1:\"b\";s:5:\"coach\";s:1:\"c\";s:3:\"web\";}i:3;a:3:{s:1:\"a\";s:1:\"5\";s:1:\"b\";s:10:\"accountant\";s:1:\"c\";s:3:\"web\";}i:4;a:3:{s:1:\"a\";s:1:\"4\";s:1:\"b\";s:6:\"Parent\";s:1:\"c\";s:3:\"web\";}}}', 1763831818);

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
-- Table structure for table `coach_attendances`
--

CREATE TABLE `coach_attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coach_user_id` bigint(20) UNSIGNED NOT NULL,
  `training_session_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('present','absent','late','excused') NOT NULL DEFAULT 'present',
  `notes` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `category` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `available_quantity` int(11) NOT NULL DEFAULT 0,
  `purchase_price` decimal(10,2) DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `condition` varchar(255) NOT NULL DEFAULT 'good',
  `location` varchar(255) DEFAULT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'available',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`id`, `name`, `description`, `category`, `quantity`, `available_quantity`, `purchase_price`, `purchase_date`, `condition`, `location`, `branch_id`, `status`, `notes`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Tango m23', 'it is used for football', 'balls', 34, 34, 450000.00, '2025-10-27', 'good', 'Office Stock', 3, 'available', NULL, '2025-10-27 08:24:45', '2025-10-30 13:22:41', '2025-10-30 13:22:41');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `notes` text DEFAULT NULL,
  `amount_cents` int(11) NOT NULL,
  `currency` varchar(3) NOT NULL DEFAULT 'RWF',
  `expense_date` date NOT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `receipt_number` varchar(255) DEFAULT NULL,
  `vendor_name` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
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
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `branch_id`, `name`, `created_at`, `updated_at`) VALUES
(7, 2, 'A', '2025-10-27 01:48:07', '2025-10-27 01:48:07'),
(8, 2, 'B', '2025-10-27 01:48:07', '2025-10-27 01:48:07'),
(9, 2, 'C', '2025-10-27 01:48:07', '2025-10-27 01:48:07'),
(10, 2, 'D', '2025-10-27 01:48:07', '2025-10-27 01:48:07'),
(11, 2, 'E', '2025-10-27 01:48:07', '2025-10-27 01:48:07'),
(12, 2, 'F', '2025-10-27 01:48:07', '2025-10-27 01:48:07'),
(13, 3, 'A', '2025-10-27 01:48:07', '2025-10-27 01:48:07'),
(14, 3, 'B', '2025-10-27 01:48:08', '2025-10-27 01:48:08'),
(15, 3, 'C', '2025-10-27 01:48:08', '2025-10-27 01:48:08'),
(16, 3, 'D', '2025-10-27 01:48:08', '2025-10-27 01:48:08'),
(17, 3, 'E', '2025-10-27 01:48:08', '2025-10-27 01:48:08'),
(18, 3, 'F', '2025-10-27 01:48:08', '2025-10-27 01:48:08'),
(19, 4, 'A', '2025-10-27 01:48:08', '2025-10-27 01:48:08'),
(20, 4, 'B', '2025-10-27 01:48:08', '2025-10-27 01:48:08'),
(21, 4, 'C', '2025-10-27 01:48:08', '2025-10-27 01:48:08'),
(22, 4, 'D', '2025-10-27 01:48:08', '2025-10-27 01:48:08'),
(23, 4, 'E', '2025-10-27 01:48:09', '2025-10-27 01:48:09'),
(24, 4, 'F', '2025-10-27 01:48:09', '2025-10-27 01:48:09');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subscription_id` bigint(20) UNSIGNED NOT NULL,
  `amount_cents` int(10) UNSIGNED NOT NULL,
  `currency` varchar(3) NOT NULL DEFAULT 'RWF',
  `due_date` date NOT NULL,
  `status` enum('pending','paid','overdue','cancelled') NOT NULL DEFAULT 'pending',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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

-- (rest of file omitted for brevity in commit) --

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
