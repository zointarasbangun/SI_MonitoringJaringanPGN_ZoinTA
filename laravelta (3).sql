-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2024 at 07:18 AM
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
-- Database: `laravelta`
--

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_perangkat` varchar(255) NOT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_perangkat` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`id`, `nama_perangkat`, `latitude`, `longitude`, `user_id`, `ip_perangkat`, `created_at`, `updated_at`) VALUES
(4, 'ITR-DEVICE12', -5.35826429, 105.37484413, 3, '121.50.34.58', '2024-04-12 12:49:06', '2024-04-24 02:52:05'),
(5, 'realme', -5.35820554, 105.31484413, 6, '192.168.93.184', '2024-04-13 02:13:08', '2024-04-13 02:13:08'),
(6, 'UNL-1', -5.35820555, 105.41484450, 7, '192.168', '2024-04-19 11:57:49', '2024-04-23 22:47:13'),
(7, 'DVC-KLIEN1', -5.40021900, 105.24290400, 3, '192.168.1.12', '2024-04-21 01:53:14', '2024-04-21 01:53:14');

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
-- Table structure for table `logperbaikan`
--

CREATE TABLE `logperbaikan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teknisi` varchar(255) DEFAULT NULL,
  `teknisi_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `server_id` bigint(20) UNSIGNED DEFAULT NULL,
  `device_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tanggal` date NOT NULL,
  `judul` enum('Wi-fi','Router','Switch','Mati Lampu','Faktor lainnya','') DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `statusadmin` enum('ditolak','menunggu','disetujui') NOT NULL DEFAULT 'menunggu',
  `keteranganadmin` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logperbaikan`
--

INSERT INTO `logperbaikan` (`id`, `teknisi`, `teknisi_id`, `user_id`, `server_id`, `device_id`, `tanggal`, `judul`, `keterangan`, `foto`, `statusadmin`, `keteranganadmin`, `created_at`, `updated_at`) VALUES
(2, 'Teknisi', 2, 3, 1, 4, '2024-05-06', 'Wi-fi', 'wadawdawd', 'photos/i7xlqycRMLvb7rBiZa40hpwUnBhhykKSjFOkEmAK.png', 'ditolak', 'Laporan tidak valid', '2024-05-05 14:36:17', '2024-05-11 09:12:44'),
(3, 'Teknisi', 2, 6, 3, 5, '2024-05-11', 'Wi-fi', 'jaringan mati', 'photos/AAh4XZwYcvqcEvNDyRw68z4H30FWOf92PTCp1pSX.jpg', 'ditolak', 'Laporan tidak valid', '2024-05-11 01:12:56', '2024-05-25 03:25:35'),
(4, 'Teknisi3', 10, 3, 1, 7, '2024-05-11', 'Faktor lainnya', 'Tidak bisa didefinisikan', 'photos/2156ahdd1EmBxKrE3P3gUO9eA9r3XvaqMFbok6T7.png', 'ditolak', 'Laporan tidak valid', '2024-05-11 04:49:35', '2024-05-11 09:19:07'),
(13, 'Teknisi', 2, 3, 1, 4, '2024-06-20', 'Wi-fi', 'tru', 'photos/rki5oUQ9Y69YtxEbdIXMhWoB8mxyN6azHnCWXSI4.png', 'ditolak', 'Laporan tidak valid', '2024-06-19 14:24:49', '2024-06-19 14:35:28');

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
(19, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(20, '2019_08_19_000000_create_failed_jobs_table', 1),
(21, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(22, '2024_04_01_064726_create_servers_table', 1),
(23, '2024_04_01_080042_create_users_table', 1),
(24, '2024_04_11_075120_create_devices_table', 1),
(25, '2024_04_27_084559_create_logperbaikan_table', 2),
(26, '2024_05_25_103353_create_notifikasis_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `notifikasis`
--

CREATE TABLE `notifikasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `message` varchar(255) NOT NULL,
  `isread` tinyint(1) NOT NULL DEFAULT 0,
  `device_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifikasis`
--

INSERT INTO `notifikasis` (`id`, `message`, `isread`, `device_id`, `created_at`, `updated_at`) VALUES
(443, 'perangkat tidak terhubung', 0, 4, '2024-06-06 20:57:07', '2024-06-06 20:57:07'),
(444, 'perangkat tidak terhubung', 0, 4, '2024-06-10 22:08:01', '2024-06-10 22:08:01'),
(445, 'perangkat tidak terhubung', 0, 7, '2024-06-10 22:08:31', '2024-06-10 22:08:31'),
(446, 'perangkat tidak terhubung', 0, 4, '2024-06-10 22:09:06', '2024-06-10 22:09:06'),
(447, 'perangkat tidak terhubung', 0, 5, '2024-06-10 22:09:11', '2024-06-10 22:09:11'),
(448, 'perangkat tidak terhubung', 0, 6, '2024-06-10 22:09:17', '2024-06-10 22:09:17'),
(449, 'perangkat tidak terhubung', 0, 5, '2024-06-10 22:09:28', '2024-06-10 22:09:28'),
(450, 'perangkat tidak terhubung', 0, 7, '2024-06-10 22:09:35', '2024-06-10 22:09:35'),
(451, 'perangkat tidak terhubung', 0, 4, '2024-06-10 22:09:46', '2024-06-10 22:09:46'),
(452, 'perangkat tidak terhubung', 0, 5, '2024-06-10 22:09:51', '2024-06-10 22:09:51'),
(453, 'perangkat tidak terhubung', 0, 7, '2024-06-10 22:09:59', '2024-06-10 22:09:59'),
(454, 'perangkat tidak terhubung', 0, 5, '2024-06-10 22:10:21', '2024-06-10 22:10:21'),
(455, 'perangkat tidak terhubung', 0, 7, '2024-06-10 22:10:29', '2024-06-10 22:10:29'),
(456, 'perangkat tidak terhubung', 0, 4, '2024-06-10 22:10:39', '2024-06-10 22:10:39'),
(457, 'perangkat tidak terhubung', 0, 5, '2024-06-10 22:10:45', '2024-06-10 22:10:45'),
(458, 'perangkat tidak terhubung', 0, 6, '2024-06-10 22:10:51', '2024-06-10 22:10:51'),
(459, 'perangkat tidak terhubung', 0, 7, '2024-06-10 22:10:57', '2024-06-10 22:10:57'),
(460, 'perangkat tidak terhubung', 0, 4, '2024-06-10 22:11:03', '2024-06-10 22:11:03'),
(461, 'perangkat tidak terhubung', 0, 5, '2024-06-10 22:11:09', '2024-06-10 22:11:09'),
(462, 'perangkat tidak terhubung', 0, 7, '2024-06-10 22:11:16', '2024-06-10 22:11:16'),
(463, 'perangkat tidak terhubung', 0, 4, '2024-06-10 22:11:23', '2024-06-10 22:11:23'),
(464, 'perangkat tidak terhubung', 0, 5, '2024-06-10 22:11:29', '2024-06-10 22:11:29'),
(465, 'perangkat tidak terhubung', 0, 6, '2024-06-10 22:11:34', '2024-06-10 22:11:34'),
(466, 'perangkat tidak terhubung', 0, 4, '2024-06-11 13:29:13', '2024-06-11 13:29:13'),
(467, 'perangkat tidak terhubung', 0, 4, '2024-06-11 13:49:23', '2024-06-11 13:49:23'),
(468, 'perangkat tidak terhubung', 0, 4, '2024-06-11 15:54:57', '2024-06-11 15:54:57'),
(469, 'perangkat tidak terhubung', 0, 5, '2024-06-11 15:55:04', '2024-06-11 15:55:04'),
(470, 'perangkat tidak terhubung', 0, 4, '2024-06-11 15:55:49', '2024-06-11 15:55:49'),
(471, 'perangkat tidak terhubung', 0, 4, '2024-06-11 15:56:20', '2024-06-11 15:56:20'),
(472, 'perangkat tidak terhubung', 0, 4, '2024-06-11 20:48:51', '2024-06-11 20:48:51'),
(473, 'perangkat tidak terhubung', 0, 5, '2024-06-11 20:48:57', '2024-06-11 20:48:57'),
(474, 'perangkat tidak terhubung', 0, 4, '2024-06-11 20:49:11', '2024-06-11 20:49:11'),
(475, 'perangkat tidak terhubung', 0, 5, '2024-06-11 20:49:17', '2024-06-11 20:49:17'),
(476, 'perangkat tidak terhubung', 0, 4, '2024-06-11 20:51:32', '2024-06-11 20:51:32'),
(477, 'perangkat tidak terhubung', 0, 5, '2024-06-11 20:51:38', '2024-06-11 20:51:38'),
(478, 'perangkat tidak terhubung', 0, 4, '2024-06-11 20:51:52', '2024-06-11 20:51:52'),
(479, 'perangkat tidak terhubung', 0, 5, '2024-06-11 20:51:58', '2024-06-11 20:51:58'),
(480, 'perangkat tidak terhubung', 0, 7, '2024-06-11 20:52:08', '2024-06-11 20:52:08'),
(481, 'perangkat tidak terhubung', 0, 4, '2024-06-11 20:52:14', '2024-06-11 20:52:14'),
(482, 'perangkat tidak terhubung', 0, 5, '2024-06-11 20:52:20', '2024-06-11 20:52:20'),
(483, 'perangkat tidak terhubung', 0, 4, '2024-06-11 20:52:32', '2024-06-11 20:52:32'),
(484, 'perangkat tidak terhubung', 0, 5, '2024-06-11 20:52:38', '2024-06-11 20:52:38'),
(485, 'perangkat tidak terhubung', 0, 4, '2024-06-11 20:52:52', '2024-06-11 20:52:52'),
(486, 'perangkat tidak terhubung', 0, 5, '2024-06-11 20:52:58', '2024-06-11 20:52:58'),
(487, 'perangkat tidak terhubung', 0, 7, '2024-06-11 20:53:08', '2024-06-11 20:53:08'),
(488, 'perangkat tidak terhubung', 0, 4, '2024-06-11 20:53:14', '2024-06-11 20:53:14'),
(489, 'perangkat tidak terhubung', 0, 5, '2024-06-11 20:53:20', '2024-06-11 20:53:20'),
(490, 'perangkat tidak terhubung', 0, 7, '2024-06-11 20:53:30', '2024-06-11 20:53:30'),
(491, 'perangkat tidak terhubung', 0, 4, '2024-06-11 20:55:33', '2024-06-11 20:55:33'),
(492, 'perangkat tidak terhubung', 0, 4, '2024-06-11 21:12:10', '2024-06-11 21:12:10'),
(493, 'perangkat tidak terhubung', 0, 5, '2024-06-11 21:12:22', '2024-06-11 21:12:22'),
(494, 'perangkat tidak terhubung', 0, 4, '2024-06-11 21:12:37', '2024-06-11 21:12:37'),
(495, 'perangkat tidak terhubung', 0, 5, '2024-06-11 21:12:44', '2024-06-11 21:12:44'),
(496, 'perangkat tidak terhubung', 0, 7, '2024-06-11 21:13:10', '2024-06-11 21:13:10'),
(497, 'perangkat tidak terhubung', 0, 4, '2024-06-11 21:13:23', '2024-06-11 21:13:23'),
(498, 'perangkat tidak terhubung', 0, 5, '2024-06-11 21:13:33', '2024-06-11 21:13:33'),
(499, 'perangkat tidak terhubung', 0, 5, '2024-06-11 21:13:44', '2024-06-11 21:13:44'),
(500, 'perangkat tidak terhubung', 0, 4, '2024-06-11 21:14:13', '2024-06-11 21:14:13'),
(501, 'perangkat tidak terhubung', 0, 4, '2024-06-11 21:15:30', '2024-06-11 21:15:30'),
(502, 'perangkat tidak terhubung', 0, 4, '2024-06-11 21:16:17', '2024-06-11 21:16:17'),
(503, 'perangkat tidak terhubung', 0, 5, '2024-06-11 21:16:23', '2024-06-11 21:16:23'),
(504, 'perangkat tidak terhubung', 0, 4, '2024-06-11 21:16:37', '2024-06-11 21:16:37'),
(505, 'perangkat tidak terhubung', 0, 5, '2024-06-11 21:16:43', '2024-06-11 21:16:43'),
(506, 'perangkat tidak terhubung', 0, 4, '2024-06-11 21:16:58', '2024-06-11 21:16:58'),
(507, 'perangkat tidak terhubung', 0, 5, '2024-06-11 21:17:04', '2024-06-11 21:17:04'),
(508, 'perangkat tidak terhubung', 0, 4, '2024-06-11 21:17:18', '2024-06-11 21:17:18'),
(509, 'perangkat tidak terhubung', 0, 5, '2024-06-11 21:17:26', '2024-06-11 21:17:26'),
(510, 'perangkat tidak terhubung', 0, 4, '2024-06-11 21:17:43', '2024-06-11 21:17:43'),
(511, 'perangkat tidak terhubung', 0, 5, '2024-06-11 21:17:56', '2024-06-11 21:17:56'),
(512, 'perangkat tidak terhubung', 0, 4, '2024-06-11 21:20:04', '2024-06-11 21:20:04'),
(513, 'perangkat tidak terhubung', 0, 5, '2024-06-11 21:20:10', '2024-06-11 21:20:10'),
(514, 'perangkat tidak terhubung', 0, 4, '2024-06-11 21:27:51', '2024-06-11 21:27:51'),
(515, 'perangkat tidak terhubung', 0, 5, '2024-06-11 21:37:45', '2024-06-11 21:37:45'),
(516, 'perangkat tidak terhubung', 0, 4, '2024-06-11 21:37:56', '2024-06-11 21:37:56'),
(517, 'perangkat tidak terhubung', 0, 6, '2024-06-11 21:39:23', '2024-06-11 21:39:23'),
(518, 'perangkat tidak terhubung', 0, 5, '2024-06-11 21:39:32', '2024-06-11 21:39:32'),
(519, 'perangkat tidak terhubung', 0, 5, '2024-06-11 21:49:39', '2024-06-11 21:49:39'),
(520, 'perangkat tidak terhubung', 0, 6, '2024-06-11 21:49:51', '2024-06-11 21:49:51'),
(521, 'perangkat tidak terhubung', 0, 5, '2024-06-11 21:50:23', '2024-06-11 21:50:23'),
(522, 'perangkat tidak terhubung', 0, 6, '2024-06-11 21:50:29', '2024-06-11 21:50:29'),
(523, 'perangkat tidak terhubung', 0, 5, '2024-06-11 21:57:37', '2024-06-11 21:57:37'),
(524, 'perangkat tidak terhubung', 0, 6, '2024-06-11 21:57:47', '2024-06-11 21:57:47'),
(525, 'perangkat tidak terhubung', 0, 7, '2024-06-11 21:58:10', '2024-06-11 21:58:10'),
(526, 'perangkat tidak terhubung', 0, 5, '2024-06-11 22:00:09', '2024-06-11 22:00:09'),
(527, 'perangkat tidak terhubung', 0, 6, '2024-06-11 22:00:15', '2024-06-11 22:00:15'),
(528, 'perangkat tidak terhubung', 0, 6, '2024-06-11 23:50:54', '2024-06-11 23:50:54'),
(529, 'perangkat tidak terhubung', 0, 5, '2024-06-11 23:52:04', '2024-06-11 23:52:04'),
(530, 'perangkat tidak terhubung', 0, 5, '2024-06-11 23:55:18', '2024-06-11 23:55:18'),
(531, 'perangkat tidak terhubung', 0, 6, '2024-06-11 23:55:24', '2024-06-11 23:55:24'),
(532, 'perangkat tidak terhubung', 0, 5, '2024-06-11 23:58:03', '2024-06-11 23:58:03'),
(533, 'perangkat tidak terhubung', 0, 6, '2024-06-11 23:58:13', '2024-06-11 23:58:13'),
(534, 'perangkat tidak terhubung', 0, 5, '2024-06-19 10:44:47', '2024-06-19 10:44:47'),
(535, 'perangkat tidak terhubung', 0, 6, '2024-06-19 10:44:53', '2024-06-19 10:44:53'),
(536, 'perangkat tidak terhubung', 0, 5, '2024-06-19 10:47:06', '2024-06-19 10:47:06'),
(537, 'perangkat tidak terhubung', 0, 6, '2024-06-19 10:47:12', '2024-06-19 10:47:12'),
(538, 'perangkat tidak terhubung', 0, 5, '2024-06-19 10:52:06', '2024-06-19 10:52:06'),
(539, 'perangkat tidak terhubung', 0, 6, '2024-06-19 10:52:11', '2024-06-19 10:52:11'),
(540, 'perangkat tidak terhubung', 0, 5, '2024-06-19 11:40:31', '2024-06-19 11:40:31'),
(541, 'perangkat tidak terhubung', 0, 6, '2024-06-19 11:40:36', '2024-06-19 11:40:36');

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `servers`
--

CREATE TABLE `servers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_server` varchar(255) NOT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `servers`
--

INSERT INTO `servers` (`id`, `nama_server`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(1, 'Bandar Lampung', -5.39710000, 105.26680000, NULL, NULL),
(2, 'Lampung Selatan', -5.56230000, 105.54740000, NULL, NULL),
(3, 'Lampung Tengah', -4.80080000, 105.31310000, NULL, NULL),
(4, 'Lampung BaratT', -5.10950000, 104.14660000, '2024-06-06 14:37:16', '2024-06-06 14:48:38'),
(5, 'Sukadana', -5.01828837, 105.53574173, '2024-06-11 21:54:06', '2024-06-11 21:56:46');

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
  `kontak` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `tahun_langganan` year(4) DEFAULT NULL,
  `server_id` bigint(20) UNSIGNED DEFAULT NULL,
  `role` enum('admin','teknisi','klien') NOT NULL DEFAULT 'klien',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `latitude` varchar(100) DEFAULT NULL,
  `longitude` varchar(100) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `kontak`, `alamat`, `tahun_langganan`, `server_id`, `role`, `status`, `latitude`, `longitude`, `image`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$12$8d9f4rMDDuErxCWL8L1ej.XcjOxOn6zWPZKKjhz9bv4mBbThrKy5C', NULL, NULL, NULL, NULL, 'admin', 'active', '', '', 'photos/HCSjxKAsGkuIb3i0r42tGrr3GGZV6UVsEvwQuXQM.png', NULL, '2024-04-12 03:56:13', '2024-05-20 09:55:37'),
(2, 'Teknisi', 'teknisi@gmail.com', NULL, '$2y$12$4XfdsME1IR6nqeAPSuZjuugHk0g1SWKfI5K6IJyZGcBL9vcMqgI6.', '2172197219', NULL, NULL, NULL, 'teknisi', 'active', NULL, NULL, 'photos/P7CiBYo923mAcooBFKro5zt1aKbaFDjqWqDFURYp.png', NULL, '2024-04-12 03:56:13', '2024-06-19 14:10:54'),
(3, 'Universitas bengkulu', 'bengkulu@gmail.com', NULL, '$2y$12$BBjM7NdZYKdBHvjOHPNwK.HvRTi5vRwLsPxlNruRMa9JVU5wYWOvW', '0821652398655', 'bengkulu cityy', '2024', 1, 'klien', 'active', '-5.35809338', '105.3152464668', 'photos/CW9dfU40ATUrh5r8XZTKdI4K6nnUfY8MrtMW6dT8.png', NULL, '2024-04-12 03:56:13', '2024-06-06 11:35:32'),
(6, 'ITERA', 'itera@gmail.com', NULL, '$2y$12$ZnSl.edwAde4/pNP76y5yO1K71omgUAfslGuby4By67VcTwrUIG4e', '082165239865', 'jalan ryucudu', '2024', 3, 'klien', 'active', '-5.35820554387', '105.31484413', 'photos/tshY2bmmE9hJRNS1thGxRseYGFBrbwPUuR8UOxyZ.png', NULL, '2024-04-17 01:05:06', '2024-04-27 01:35:31'),
(7, 'UNILA', 'unila@gmail.com', NULL, '$2y$12$qFUIi.aW7cHPDDXgXO9CWeS8bNl4hu8l2Y/Rx4emD148VuDoiFcui', '082165239865', 'kampung baru unila', '2024', 4, 'klien', 'active', '-5.400219', '105.2121582', 'photos/eXFJndvpW1UDRFfAqt5MeVUcYNpoYor3XCHgSBqF.png', NULL, '2024-04-17 01:23:55', '2024-04-27 00:55:58'),
(10, 'Teknisi3', 'teknisi3@gmail.com', NULL, '$2y$12$ovvEUg1ifkjmNurWuu/A6eu5zZ74GFGif2Kl55x/0sqGTMeQY7Pde', NULL, NULL, NULL, NULL, 'teknisi', 'active', NULL, NULL, NULL, NULL, '2024-04-17 11:08:37', '2024-04-17 11:08:37'),
(18, 'USU', 'usu@gmail.com', NULL, '$2y$12$93aPWDXFSxLcIcC6F47TDeyn74BxR3g..OfdHjd7WFbtkAZztXati', '12131311', 'medan', '2024', 3, 'klien', 'active', '-5.35820554387', '105.242904', 'photos/iAw8jcNFtAwc6OruHVPFC4HBOpoSzEV9xsbpIGGI.png', NULL, '2024-04-23 21:35:24', '2024-04-27 00:40:42'),
(21, 'teknisi2', 'teknisi2@gmail.com', NULL, '$2y$12$D119shLsHgfEq5WfuK.FRO6JGf1g3bBNDxbH1Dydi.xbZzGbetrzq', NULL, NULL, NULL, NULL, 'teknisi', 'active', NULL, NULL, NULL, NULL, '2024-06-06 14:13:25', '2024-06-06 14:13:25'),
(27, 'unsri', 'unsri@gmail.com', NULL, '$2y$12$kCVzt1xPifXKYLoPSdiTkOb2AIWVP8KahPLM9ac08k.3rY7FVOYme', '121313', 'palembang', '2024', 5, 'klien', 'active', '-5.35820554387', '105.242904', 'photos/1h1WV3HIlpWHQgW4OmgnY7LhCAR2ArwZEgMDdk1x.jpg', NULL, '2024-06-19 14:14:11', '2024-06-19 14:14:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `devices_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `logperbaikan`
--
ALTER TABLE `logperbaikan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `logperbaikan_user_id_foreign` (`user_id`),
  ADD KEY `logperbaikan_server_id_foreign` (`server_id`),
  ADD KEY `logperbaikan_device_id_foreign` (`device_id`),
  ADD KEY `teknisi_id_3` (`teknisi_id`),
  ADD KEY `teknisi_id_4` (`teknisi_id`),
  ADD KEY `teknisi_id` (`teknisi_id`) USING BTREE,
  ADD KEY `teknisi_id_2` (`teknisi_id`) USING BTREE;

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifikasis`
--
ALTER TABLE `notifikasis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifikasis_device_id_foreign` (`device_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `servers`
--
ALTER TABLE `servers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_name_unique` (`name`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `users_server_id_foreign` (`server_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logperbaikan`
--
ALTER TABLE `logperbaikan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `notifikasis`
--
ALTER TABLE `notifikasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=542;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `servers`
--
ALTER TABLE `servers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `devices`
--
ALTER TABLE `devices`
  ADD CONSTRAINT `devices_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `logperbaikan`
--
ALTER TABLE `logperbaikan`
  ADD CONSTRAINT `logperbaikan_device_id_foreign` FOREIGN KEY (`device_id`) REFERENCES `devices` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `logperbaikan_server_id_foreign` FOREIGN KEY (`server_id`) REFERENCES `servers` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `logperbaikan_teknisi_id_foreign` FOREIGN KEY (`teknisi_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `logperbaikan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `notifikasis`
--
ALTER TABLE `notifikasis`
  ADD CONSTRAINT `notifikasis_device_id_foreign` FOREIGN KEY (`device_id`) REFERENCES `devices` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_server_id_foreign` FOREIGN KEY (`server_id`) REFERENCES `servers` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
