-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2018 at 11:33 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.1.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `besfrend`
--

-- --------------------------------------------------------

--
-- Table structure for table `aid_workers`
--

CREATE TABLE `aid_workers` (
  `id` int(10) UNSIGNED NOT NULL,
  `person_id` int(10) UNSIGNED NOT NULL,
  `field` enum('Rescue','Medical','Technical','Security','Others') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('Active','Inactive') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aid_workers`
--

INSERT INTO `aid_workers` (`id`, `person_id`, `field`, `created_at`, `updated_at`, `status`) VALUES
(8, 12, 'Rescue', '2018-10-24 06:33:10', '2018-10-24 06:33:10', 'Active'),
(10, 14, 'Technical', '2018-10-24 06:35:09', '2018-10-24 06:35:09', 'Active'),
(11, 21, 'Medical', '2018-10-27 03:20:00', '2018-11-03 19:52:41', 'Active'),
(12, 22, 'Technical', '2018-11-03 18:54:06', '2018-11-08 23:25:30', 'Active'),
(15, 25, 'Medical', '2018-11-04 04:29:04', '2018-11-04 04:29:04', 'Active'),
(16, 42, 'Technical', '2018-11-08 06:15:58', '2018-11-08 06:15:58', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `aid_worker_assignments`
--

CREATE TABLE `aid_worker_assignments` (
  `id` int(10) UNSIGNED NOT NULL,
  `aid_worker_id` int(10) UNSIGNED NOT NULL,
  `center_id` int(10) UNSIGNED DEFAULT NULL,
  `status` enum('Present','Transferred','En Route','Last Post') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aid_worker_assignments`
--

INSERT INTO `aid_worker_assignments` (`id`, `aid_worker_id`, `center_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 10, 1, 'Transferred', '2018-10-24 06:35:56', '2018-11-08 21:18:38'),
(9, 8, 1, 'Present', NULL, '2018-10-30 00:37:13'),
(10, 11, 1, 'Present', '2018-10-29 04:00:00', '2018-10-30 11:39:32'),
(16, 15, 1, 'Present', '2018-11-04 04:29:04', '2018-11-04 18:54:42'),
(17, 12, 1, 'Transferred', '2018-11-08 06:05:46', '2018-11-09 05:00:42'),
(18, 16, 1, 'Present', '2018-11-08 06:16:11', '2018-11-08 18:41:34'),
(19, 10, 2, 'Transferred', '2018-11-09 05:00:07', '2018-11-09 00:04:04'),
(20, 12, 2, 'Transferred', '2018-11-09 05:00:42', '2018-11-09 00:05:25'),
(21, 10, 3, 'Transferred', '2018-11-09 05:19:32', '2018-11-09 00:05:25'),
(22, 12, 1, 'Present', '2018-11-09 00:05:25', '2018-11-09 00:05:25'),
(23, 10, 1, 'Present', '2018-11-09 00:05:25', '2018-11-09 00:05:25');

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `center_id` int(10) UNSIGNED NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `center_id`, `body`, `created_at`, `updated_at`) VALUES
(13, 'Major Outbreak in Brgy. Mantuyong', 1, '<p>Marami ang namatay sa kasalukuyang major outbreak sa Brgy. Mantuyong, hindi ito kanais-nais na pangyayari. May nagsasabi na sa isang <strong><em>color green </em></strong>na bahay nagsimula ang outbreak. Mga zombies ang nakita ng mga residente na umaatake sa kanila, kapag nahawakan lang sila ng mga <strong>pesteng </strong>zombies ay nagiging ganon yun tao at mamatay pagkatapos ng limang minuto. Sa ngayon, wala pa panglunas ang mga doktor kaya ang mga kinatawan ng pulis at military ay umaksyon para labanan yun mga zombies. Dahil sa dumadami na mga hindi pangkaraniwang nilalang ay nilagyan nila ng malaking harang ang ibang areas na hindi pa na-apektohan ng outbreak. Laging maghanda sa mga panganib dumating, yan ang mensahe ng kapitan ng brgy. mantuyong. At yon&#39; lang ang balita sa araw na ito, adios!</p>', '2018-10-14 13:46:18', '2018-10-20 04:31:10');

-- --------------------------------------------------------

--
-- Table structure for table `barangays`
--

CREATE TABLE `barangays` (
  `id` int(10) UNSIGNED NOT NULL,
  `brgy` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_municipality` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangays`
--

INSERT INTO `barangays` (`id`, `brgy`, `city_municipality`, `created_at`, `updated_at`) VALUES
(1, 'Mantuyong', 'Mandaue City', NULL, NULL),
(2, 'Tipolo', 'Mandaue City', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `centers`
--

CREATE TABLE `centers` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `brgy_id` int(10) UNSIGNED NOT NULL,
  `accommodation` int(11) NOT NULL,
  `location` text COLLATE utf8mb4_unicode_ci,
  `lat` text COLLATE utf8mb4_unicode_ci,
  `lng` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `centers`
--

INSERT INTO `centers` (`id`, `user_id`, `brgy_id`, `accommodation`, `location`, `lat`, `lng`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 15, 'Day Care Center - Mantuyong Branch', '10.335723919209988', '123.93698225610000', NULL, NULL),
(2, 20, 1, 10, 'Brgy. Mantuyong Barangay Hall', '10.335723919200999', '123.93698225612344', '2018-09-29 18:33:49', '2018-09-29 18:33:49'),
(3, 21, 1, 5, 'Mantuyong Public Market', '10.335723919201233', '123.93698225612344', '2018-10-01 22:59:42', '2018-10-01 22:59:42'),
(4, 22, 1, 45, 'Mantuyong Stadium', '10.335723919212312', '123.93698225611233', '2018-10-21 21:07:15', '2018-10-21 21:07:15');

-- --------------------------------------------------------

--
-- Table structure for table `evacuations`
--

CREATE TABLE `evacuations` (
  `id` int(10) UNSIGNED NOT NULL,
  `emergency` enum('Fire','Typhoon','Non-Typhoon Flooding','Tsunami','Earthquake','Volcanic Activity','Landslide','Mass Violence','Outbreak') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `brgy_id` int(10) UNSIGNED NOT NULL,
  `status` enum('Ongoing','Done') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `evacuations`
--

INSERT INTO `evacuations` (`id`, `emergency`, `remarks`, `brgy_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Typhoon', 'Beware of strong winds and heavy rain.', 1, 'Done', '2018-10-01 05:22:30', NULL),
(2, 'Earthquake', 'Caution: Landslides', 1, 'Done', '2018-10-01 23:09:22', '2018-10-03 18:57:30'),
(4, 'Mass Violence', 'Beware of serial killers.', 1, 'Done', '2018-10-03 22:36:15', '2018-10-15 19:00:31'),
(9, 'Outbreak', 'Beware of Zombies and Vampires', 1, 'Done', '2018-10-16 12:57:44', '2018-11-08 23:05:13'),
(10, 'Fire', 'MAMATAY NA SILA', 1, 'Done', '2018-11-09 07:32:37', '2018-11-08 23:59:26');

-- --------------------------------------------------------

--
-- Table structure for table `households`
--

CREATE TABLE `households` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `house_num` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brgy_id` int(10) UNSIGNED NOT NULL,
  `active_check` enum('Yes','No') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `households`
--

INSERT INTO `households` (`id`, `user_id`, `house_num`, `street`, `area`, `brgy_id`, `active_check`, `created_at`, `updated_at`) VALUES
(1, 1, '123', 'Test Street', 'Sitio Test', 1, NULL, '2018-09-25 17:56:45', '2018-09-25 17:56:45'),
(2, 2, '23', 'Street of the KING', 'Sitio Kalibunan', 1, NULL, '2018-09-25 18:23:25', '2018-09-25 18:23:25'),
(3, 21, '612', 'Dahlia St.', 'Subdivision', 1, NULL, '2018-10-16 20:53:08', '2018-10-16 20:53:08'),
(4, 29, '99', 'Example Street', 'Sitio Example', 1, NULL, '2018-10-29 03:38:47', '2018-10-29 03:38:47'),
(5, 30, '1211', '11', 'pusok', 1, NULL, '2018-11-09 06:20:48', '2018-11-09 06:20:48'),
(6, 31, '52ABX', 'King street', 'Area51', 1, NULL, '2018-11-09 07:07:21', '2018-11-09 07:07:21'),
(7, 32, 'House 69', 'pota', 'Haunted Area', 1, 'No', '2018-11-09 07:19:28', '2018-11-08 23:24:07');

-- --------------------------------------------------------

--
-- Table structure for table `household_evacs`
--

CREATE TABLE `household_evacs` (
  `id` int(10) UNSIGNED NOT NULL,
  `household_member_id` int(10) UNSIGNED NOT NULL,
  `center_id` int(10) UNSIGNED DEFAULT NULL,
  `evacuation_id` int(10) UNSIGNED NOT NULL,
  `whereabouts` enum('Found','Missing') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Fine','Injured/Sick','Deceased','Unknown') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `household_evacs`
--

INSERT INTO `household_evacs` (`id`, `household_member_id`, `center_id`, `evacuation_id`, `whereabouts`, `status`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 'Found', 'Fine', '', NULL, NULL),
(2, 1, NULL, 2, 'Found', 'Fine', 'Default data, change when necessary.', '2018-10-01 23:32:21', '2018-10-01 23:44:46'),
(3, 2, NULL, 2, 'Found', 'Fine', 'Default data, change when necessary.', '2018-10-01 23:32:22', '2018-10-11 23:00:52'),
(4, 3, 2, 2, 'Found', 'Fine', 'Default data, change when necessary.', '2018-10-01 23:32:23', '2018-10-11 23:01:16'),
(5, 1, 2, 4, 'Found', 'Fine', 'Default data, change when necessary.', '2018-10-05 05:41:58', '2018-10-05 05:41:58'),
(6, 2, NULL, 4, 'Found', 'Fine', 'Default data, change when necessary.', '2018-10-05 05:41:59', '2018-10-05 05:41:59'),
(7, 3, 2, 4, 'Found', 'Fine', 'Default data, change when necessary.', '2018-10-05 05:41:59', '2018-10-16 04:56:08'),
(28, 1, 2, 9, 'Found', 'Deceased', 'Default data, change when necessary.', '2018-10-16 12:57:44', '2018-10-16 12:57:44'),
(29, 2, 2, 9, 'Missing', 'Injured/Sick', 'Naligsan ug bike', '2018-10-16 12:57:44', '2018-10-28 22:38:20'),
(30, 3, 2, 9, 'Found', 'Fine', 'She\'s fine and healthy.', '2018-10-16 12:57:45', '2018-11-04 18:22:13'),
(31, 4, 3, 9, 'Found', 'Fine', 'Default data, change when necessary.', '2018-10-21 16:00:00', '2018-10-21 16:00:00'),
(32, 5, 2, 9, 'Found', 'Injured/Sick', 'Gihilantan: 40 degrees', '2018-10-16 12:57:45', '2018-10-30 04:56:49'),
(33, 8, NULL, 9, 'Found', 'Fine', 'Registered during the event of an evacuation.', '2018-10-29 03:38:48', '2018-11-05 22:46:52'),
(36, 12, NULL, 9, 'Found', 'Fine', 'Registered during the event of an evacuation.', '2018-11-04 17:50:18', '2018-11-04 17:50:18'),
(42, 13, NULL, 9, 'Found', 'Fine', 'Registered during the event of an evacuation.', '2018-11-04 19:40:22', '2018-11-04 20:44:22'),
(44, 19, NULL, 9, 'Found', 'Fine', 'Registered during the event of an evacuation.', '2018-11-05 06:25:50', '2018-11-05 06:25:50'),
(45, 20, NULL, 9, 'Found', 'Fine', 'Registered during the event of an evacuation.', '2018-11-05 06:45:15', '2018-11-05 06:45:15'),
(46, 21, NULL, 9, 'Found', 'Fine', 'Registered during the event of an evacuation.', '2018-11-05 16:19:33', '2018-11-05 16:19:33'),
(47, 22, NULL, 9, 'Found', 'Fine', 'Registered during the event of an evacuation.', '2018-11-05 16:21:23', '2018-11-05 16:21:23'),
(48, 6, NULL, 9, 'Found', 'Fine', 'Nakaligtas siya sa outbreak.', '2018-11-04 02:26:52', '2018-11-04 04:48:00'),
(49, 7, NULL, 9, 'Found', 'Fine', 'Default remarks.', '2018-11-04 05:22:46', '2018-11-04 07:16:12'),
(50, 27, NULL, 9, 'Found', 'Fine', 'Registered during the event of an evacuation.', '2018-11-09 06:20:48', '2018-11-09 06:20:48'),
(51, 28, NULL, 9, 'Found', 'Fine', 'Registered during the event of an evacuation.', '2018-11-08 22:41:02', '2018-11-08 22:41:02'),
(52, 29, NULL, 9, 'Found', 'Fine', 'Registered during the event of an evacuation.', '2018-11-08 22:44:24', '2018-11-08 22:44:24'),
(53, 30, NULL, 9, 'Found', 'Fine', 'Registered during the event of an evacuation.', '2018-11-08 22:45:27', '2018-11-08 22:45:27'),
(54, 31, NULL, 9, 'Found', 'Fine', 'Registered during the event of an evacuation.', '2018-11-08 22:48:42', '2018-11-08 22:48:42'),
(55, 2, 2, 10, 'Found', 'Fine', 'Default data, change when necessary.', '2018-11-09 07:32:37', '2018-11-08 23:34:11'),
(56, 3, NULL, 10, 'Found', 'Fine', 'Default data, change when necessary.', '2018-11-09 07:32:37', '2018-11-09 07:32:37'),
(57, 4, NULL, 10, 'Found', 'Fine', 'Default data, change when necessary.', '2018-11-09 07:32:37', '2018-11-09 07:32:37'),
(58, 5, 2, 10, 'Found', 'Fine', 'nakit\'an sa kalibunan', '2018-11-09 07:32:37', '2018-11-08 23:37:16'),
(59, 6, NULL, 10, 'Found', 'Fine', 'Default data, change when necessary.', '2018-11-09 07:32:37', '2018-11-09 07:32:37'),
(60, 7, NULL, 10, 'Found', 'Fine', 'Default data, change when necessary.', '2018-11-09 07:32:37', '2018-11-09 07:32:37'),
(61, 8, NULL, 10, 'Found', 'Fine', 'Default data, change when necessary.', '2018-11-09 07:32:37', '2018-11-09 07:32:37'),
(62, 11, NULL, 10, 'Found', 'Fine', 'Default data, change when necessary.', '2018-11-09 07:32:37', '2018-11-09 07:32:37'),
(63, 12, NULL, 10, 'Found', 'Fine', 'Default data, change when necessary.', '2018-11-09 07:32:37', '2018-11-09 07:32:37'),
(64, 13, NULL, 10, 'Found', 'Fine', 'Default data, change when necessary.', '2018-11-09 07:32:37', '2018-11-09 07:32:37'),
(65, 19, NULL, 10, 'Found', 'Fine', 'Default data, change when necessary.', '2018-11-09 07:32:38', '2018-11-09 07:32:38'),
(66, 20, NULL, 10, 'Found', 'Fine', 'Default data, change when necessary.', '2018-11-09 07:32:38', '2018-11-09 07:32:38'),
(67, 21, NULL, 10, 'Found', 'Fine', 'Default data, change when necessary.', '2018-11-09 07:32:38', '2018-11-09 07:32:38'),
(68, 22, NULL, 10, 'Found', 'Fine', 'Default data, change when necessary.', '2018-11-09 07:32:38', '2018-11-09 07:32:38'),
(69, 23, NULL, 10, 'Found', 'Fine', 'Default data, change when necessary.', '2018-11-09 07:32:38', '2018-11-09 07:32:38'),
(70, 24, NULL, 10, 'Found', 'Fine', 'Default data, change when necessary.', '2018-11-09 07:32:38', '2018-11-09 07:32:38'),
(71, 25, NULL, 10, 'Found', 'Fine', 'Default data, change when necessary.', '2018-11-09 07:32:38', '2018-11-09 07:32:38'),
(72, 26, NULL, 10, 'Found', 'Fine', 'Default data, change when necessary.', '2018-11-09 07:32:38', '2018-11-09 07:32:38'),
(73, 27, NULL, 10, 'Found', 'Fine', 'Default data, change when necessary.', '2018-11-09 07:32:38', '2018-11-09 07:32:38'),
(74, 28, NULL, 10, 'Found', 'Fine', 'Default data, change when necessary.', '2018-11-09 07:32:38', '2018-11-09 07:32:38'),
(75, 29, NULL, 10, 'Found', 'Fine', 'Default data, change when necessary.', '2018-11-09 07:32:38', '2018-11-09 07:32:38'),
(76, 30, NULL, 10, 'Found', 'Fine', 'Default data, change when necessary.', '2018-11-09 07:32:38', '2018-11-09 07:32:38'),
(77, 31, NULL, 10, 'Found', 'Fine', 'Default data, change when necessary.', '2018-11-09 07:32:38', '2018-11-09 07:32:38'),
(78, 32, NULL, 10, 'Found', 'Fine', 'Default data, change when necessary.', '2018-11-09 07:32:38', '2018-11-09 07:32:38');

-- --------------------------------------------------------

--
-- Table structure for table `household_members`
--

CREATE TABLE `household_members` (
  `id` int(10) UNSIGNED NOT NULL,
  `person_id` int(10) UNSIGNED NOT NULL,
  `house_id` int(10) UNSIGNED NOT NULL,
  `registrant` enum('Yes','No') COLLATE utf8mb4_unicode_ci NOT NULL,
  `heirarchy` enum('Not Applicable','Parent','Child','Relative','Roommate') COLLATE utf8mb4_unicode_ci NOT NULL,
  `other_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `household_members`
--

INSERT INTO `household_members` (`id`, `person_id`, `house_id`, `registrant`, `heirarchy`, `other_address`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Yes', 'Parent', 'Dorm in TC', '2018-09-25 17:56:45', '2018-11-04 18:43:08'),
(2, 2, 1, 'No', 'Child', 'Dorm in Main Campus', '2018-09-25 18:17:40', '2018-09-25 18:20:02'),
(3, 3, 1, 'No', 'Child', NULL, '2018-09-25 18:21:21', '2018-09-25 18:21:21'),
(4, 4, 2, 'Yes', 'Roommate', NULL, '2018-09-25 18:23:25', '2018-11-05 16:14:52'),
(5, 5, 2, 'No', 'Roommate', 'Cebu City', '2018-09-25 23:51:56', '2018-11-05 16:15:17'),
(6, 15, 2, 'No', 'Child', NULL, '2018-10-25 21:28:49', '2018-11-05 16:14:25'),
(7, 16, 2, 'No', 'Roommate', 'none', '2018-10-25 21:32:11', '2018-11-04 18:01:58'),
(8, 17, 4, 'Yes', 'Roommate', NULL, '2018-10-29 03:38:47', '2018-11-06 00:25:44'),
(11, 20, 1, 'No', 'Roommate', NULL, '2018-10-28 22:20:08', '2018-11-05 06:02:19'),
(12, 26, 1, 'No', 'Roommate', 'Houston, Texas', '2018-11-04 17:50:18', '2018-11-04 17:50:18'),
(13, 27, 2, 'No', 'Relative', NULL, '2018-11-04 18:09:27', '2018-11-04 18:09:27'),
(19, 33, 1, 'No', 'Roommate', NULL, '2018-11-05 06:25:50', '2018-11-05 06:25:50'),
(20, 34, 1, 'No', 'Relative', 'San Antonio, Texas', '2018-11-05 06:45:15', '2018-11-05 06:45:15'),
(21, 35, 2, 'No', 'Parent', NULL, '2018-11-05 16:19:33', '2018-11-05 16:19:33'),
(22, 36, 2, 'No', 'Parent', NULL, '2018-11-05 16:21:23', '2018-11-05 16:21:23'),
(23, 37, 4, 'No', 'Roommate', NULL, '2018-11-06 00:27:19', '2018-11-06 00:27:19'),
(24, 38, 4, 'No', 'Roommate', 'Canduman, Mandaue City', '2018-11-06 00:30:09', '2018-11-06 00:30:09'),
(25, 39, 4, 'No', 'Child', 'Lapu-Lapu City, Cebu', '2018-11-06 00:34:39', '2018-11-06 00:34:39'),
(26, 40, 4, 'No', 'Roommate', NULL, '2018-11-06 00:36:10', '2018-11-06 00:36:10'),
(27, 43, 5, 'Yes', 'Not Applicable', NULL, '2018-11-09 06:20:48', '2018-11-09 06:20:48'),
(28, 44, 5, 'No', 'Child', NULL, '2018-11-08 22:41:02', '2018-11-08 22:41:02'),
(29, 45, 5, 'No', 'Not Applicable', 'dasdasdasd', '2018-11-08 22:44:24', '2018-11-08 22:44:24'),
(30, 46, 5, 'No', 'Not Applicable', 'dj', '2018-11-08 22:45:27', '2018-11-08 22:45:27'),
(31, 47, 5, 'No', 'Not Applicable', 'ddd', '2018-11-08 22:48:42', '2018-11-08 22:48:42'),
(32, 48, 6, 'Yes', 'Not Applicable', NULL, '2018-11-09 07:07:21', '2018-11-09 07:07:21'),
(33, 49, 7, 'Yes', 'Not Applicable', 'oh yeah', '2018-11-09 07:19:29', '2018-11-08 23:20:35'),
(34, 50, 7, 'No', 'Child', 'fooking', '2018-11-08 23:22:09', '2018-11-08 23:22:09');

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `id` int(10) UNSIGNED NOT NULL,
  `center_id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `qty_left` decimal(19,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `center_id`, `item_id`, `qty_left`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '81.00', NULL, '2018-11-09 07:48:29'),
(2, 1, 6, '98.00', '2018-10-20 04:37:20', '2018-11-06 03:11:32'),
(3, 1, 7, '100.00', '2018-10-20 04:39:35', '2018-10-20 04:39:35'),
(4, 1, 1, '25.00', '2018-10-20 04:39:35', '2018-10-20 04:49:19'),
(5, 1, 8, '2.00', '2018-10-20 04:39:35', '2018-11-06 11:11:57'),
(10, 2, 7, '5.00', '2018-10-22 10:24:54', '2018-11-09 07:28:53'),
(11, 2, 3, '7.00', '2018-10-22 10:24:54', '2018-11-09 07:28:53'),
(12, 2, 2, '38.00', '2018-10-22 10:24:54', '2018-11-09 07:28:53'),
(13, 3, 7, '3.00', '2018-10-22 02:27:11', '2018-10-22 02:27:11'),
(14, 3, 2, '20.00', '2018-10-22 02:31:22', '2018-10-22 02:31:22'),
(15, 2, 9, '18.00', '2018-10-23 06:18:42', '2018-11-06 09:50:15'),
(17, 2, 11, '9.00', '2018-10-29 07:29:08', '2018-11-08 23:30:53'),
(18, 1, 15, '25.00', '2018-11-04 04:58:42', '2018-11-03 20:58:51'),
(19, 2, 8, '8.00', '2018-11-09 07:49:14', '2018-11-09 07:49:14'),
(20, 1, 16, '4.00', '2018-11-09 07:50:19', '2018-11-09 07:50:19');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('Food','Medicine','Clothing','Equipment','Others') COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_measurement` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `type`, `unit_measurement`, `created_at`, `updated_at`) VALUES
(1, 'Lucky Me Pancit Canton', 'Food', 'packs', '2018-10-12 05:56:44', '2018-10-12 05:56:55'),
(2, 'Bioflu', 'Medicine', 'tablets', NULL, NULL),
(3, 'Nutella Tsokolate', 'Food', 'jar', '2018-10-12 05:56:24', '2018-10-12 05:56:24'),
(5, 'C2 Solo Large', 'Food', 'bottles', '2018-10-16 05:49:47', '2018-10-16 05:49:47'),
(6, 'Colt M4A1 Rifle', 'Equipment', 'units', '2018-10-20 04:37:13', '2018-10-20 04:37:13'),
(7, 'Century Tuna Spicy', 'Food', 'cans', '2018-10-20 04:38:21', '2018-10-20 04:38:21'),
(8, 'Nokia 3210', 'Equipment', 'units', '2018-10-20 04:39:29', '2018-10-20 04:39:29'),
(9, 'Tender Juicy Hotdog', 'Food', 'packs', '2018-10-23 06:18:37', '2018-10-23 06:18:37'),
(11, 'Cheeseburger', 'Food', 'packs', '2018-10-29 07:15:39', '2018-10-29 07:15:39'),
(14, 'Nature Spring Drinking Water', 'Food', 'bottles', '2018-10-29 13:22:24', '2018-10-29 13:22:24'),
(15, 'Sprite Litro', 'Food', 'liters', '2018-11-04 04:58:42', '2018-11-04 04:58:42'),
(16, 'Chippy', 'Food', 'packs', '2018-11-09 07:50:16', '2018-11-09 07:50:16');

-- --------------------------------------------------------

--
-- Table structure for table `item_request_forms`
--

CREATE TABLE `item_request_forms` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `reasons` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Pending','Approved','Denied','Encoding') COLLATE utf8mb4_unicode_ci NOT NULL,
  `final_remarks` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_request_forms`
--

INSERT INTO `item_request_forms` (`id`, `user_id`, `reasons`, `status`, `final_remarks`, `created_at`, `updated_at`) VALUES
(8, 20, 'Additional Item Request by evac_admin.', 'Encoding', NULL, '2018-10-11 00:00:56', '2018-10-11 00:00:56'),
(11, 20, 'This is applicable for the people who belong to Brgy. Mantuyong.', 'Approved', 'kdfnsdnfsg', '2018-10-11 00:54:29', '2018-11-08 22:12:39'),
(12, 20, 'Donation from US Military Forces.', 'Approved', 'Approved by Command Center Admin.', '2018-10-16 05:46:53', '2018-11-08 00:11:13'),
(13, 20, 'Clothes from NBA.', 'Encoding', NULL, '2018-10-26 16:56:15', '2018-10-26 16:56:15'),
(14, 20, 'Eat bulaga', 'Approved', 'BULAGGAAAA', '2018-11-09 07:50:49', '2018-11-08 23:52:05');

-- --------------------------------------------------------

--
-- Table structure for table `item_request_lists`
--

CREATE TABLE `item_request_lists` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_request_form_id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `qty_requested` decimal(19,2) NOT NULL,
  `priority_level` enum('Low','Mid','High') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_request_lists`
--

INSERT INTO `item_request_lists` (`id`, `item_request_form_id`, `item_id`, `qty_requested`, `priority_level`, `created_at`, `updated_at`) VALUES
(3, 12, 5, '3.00', 'Mid', '2018-10-16 05:49:47', '2018-10-16 05:49:47'),
(4, 11, 9, '2.00', 'Low', '2018-10-23 15:42:11', '2018-10-23 15:42:11'),
(5, 13, 1, '2.00', 'Low', '2018-10-26 16:56:33', '2018-10-26 16:56:33'),
(6, 13, 2, '3.00', 'Mid', '2018-10-29 13:21:29', '2018-10-29 05:21:46'),
(7, 13, 14, '100.00', 'High', '2018-10-29 13:22:24', '2018-10-29 13:22:24'),
(8, 8, 5, '4.00', 'Mid', '2018-11-06 11:26:58', '2018-11-06 11:26:58'),
(9, 14, 16, '222.00', 'Low', '2018-11-09 07:51:10', '2018-11-09 07:51:10');

-- --------------------------------------------------------

--
-- Table structure for table `medical_backgrounds`
--

CREATE TABLE `medical_backgrounds` (
  `id` int(10) UNSIGNED NOT NULL,
  `household_member_id` int(10) UNSIGNED NOT NULL,
  `condition` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `severity` enum('Fully Recovered','Mild','Severe','Life-Threatening') COLLATE utf8mb4_unicode_ci NOT NULL,
  `medication` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `medical_backgrounds`
--

INSERT INTO `medical_backgrounds` (`id`, `household_member_id`, `condition`, `severity`, `medication`, `created_at`, `updated_at`) VALUES
(1, 1, 'Liptospyrosis', 'Mild', 'Proper Medication and MX-3', '2018-09-25 22:41:28', '2018-10-28 22:28:06'),
(2, 3, 'Yeast Infection', 'Fully Recovered', 'Antibiotics', '2018-09-25 22:55:55', '2018-10-15 22:23:52'),
(3, 5, 'Headache', 'Life-Threatening', 'Biogesic', '2018-09-26 00:02:08', '2018-09-27 01:09:48'),
(4, 4, 'Prostate Cancer(Stage 1)', 'Severe', 'Robust', '2018-09-26 00:22:05', '2018-10-16 04:33:24'),
(5, 4, 'Torn Muscles', 'Fully Recovered', 'Omega Pain Killer', '2018-09-26 00:22:42', '2018-10-16 04:33:09'),
(6, 5, 'Pimples', 'Severe', 'Facial Soap', '2018-09-26 21:39:18', '2018-09-26 21:39:18'),
(7, 5, 'Cough', 'Severe', 'Water', '2018-09-27 01:11:07', '2018-09-27 01:11:07'),
(8, 3, 'Rushes', 'Fully Recovered', 'Lotion', '2018-10-15 22:21:03', '2018-10-15 22:23:18'),
(9, 3, 'Boy Genius', 'Fully Recovered', 'Study', '2018-10-15 22:22:22', '2018-10-22 01:21:37'),
(10, 3, 'Leptospirosis', 'Severe', 'Manghimasa', '2018-10-22 01:52:07', '2018-10-22 01:52:07'),
(11, 3, 'Cheche Bureche', 'Mild', 'Mangamote', '2018-10-22 01:56:14', '2018-10-28 00:05:02'),
(12, 1, 'Headache', 'Severe', 'Take biogesic and enough rest.', '2018-10-27 23:19:33', '2018-10-27 23:27:39'),
(13, 11, 'Gonorrhea', 'Severe', 'Koi Herbal Capsule', '2018-10-28 22:28:57', '2018-10-28 22:28:57'),
(14, 5, 'Lung Cancer', 'Fully Recovered', 'Fruits and Vegetables', '2018-10-29 22:58:34', '2018-10-29 23:29:27'),
(15, 33, 'pasar na this?', 'Life-Threatening', 'yes', '2018-11-08 23:21:16', '2018-11-08 23:21:25');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `message`, `created_at`, `updated_at`) VALUES
(23, 3, 'Hello evac_admin', '2018-11-08 00:05:19', '2018-11-08 00:05:19'),
(24, 20, 'yes Cmd_admin?', '2018-11-08 00:05:36', '2018-11-08 00:05:36'),
(25, 3, 'Naa pamo available nga aidworker diha?', '2018-11-08 00:06:25', '2018-11-08 00:06:25'),
(26, 20, 'Naa pa kaayo cmd_admin', '2018-11-08 00:06:38', '2018-11-08 00:06:38'),
(27, 20, 'huy', '2018-11-08 23:38:57', '2018-11-08 23:38:57'),
(28, 3, 'peste ka', '2018-11-08 23:39:07', '2018-11-08 23:39:07');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_09_25_040831_create_people_table', 1),
(4, '2018_09_25_042110_create_barangays_table', 1),
(5, '2018_09_25_062004_create_centers_table', 1),
(6, '2018_09_25_062840_create_aid_workers_table', 1),
(7, '2018_09_25_062926_create_households_table', 1),
(8, '2018_09_25_062941_create_household_members_table', 1),
(9, '2018_09_25_064422_create_medical_backgrounds_table', 1),
(10, '2018_09_25_065254_create_household_evacs_table', 1),
(12, '2018_09_27_073146_create_items_table', 2),
(13, '2018_09_27_074102_create_inventories_table', 2),
(14, '2018_09_27_080414_create_item_request_forms_table', 2),
(15, '2018_09_27_081357_create_item_request_lists_table', 2),
(16, '2018_09_27_082053_create_relief_operations_table', 2),
(17, '2018_09_27_082450_create_relief_packages_table', 2),
(18, '2018_09_27_083132_create_worker_requests_table', 2),
(19, '2018_09_28_034756_create_announcements_table', 3),
(20, '2018_09_29_031715_create_evacuations_table', 3),
(21, '2018_09_29_034252_add_foreign_key_to_household_evacs', 4),
(22, '2018_10_21_124001_create_messages_table', 5),
(23, '2018_10_22_100508_add_sender_column_to_relief_operations', 6),
(24, '2018_10_23_220302_create_aid_worker_assignments_table', 7),
(25, '2018_10_23_222532_remove_column_in_aid_workers_table', 7),
(26, '2018_10_23_223102_add_retired_column_in_aid_workers', 7),
(27, '2018_11_07_125654_add_activate_status', 8);

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
-- Table structure for table `people`
--

CREATE TABLE `people` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('Male','Female') COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` date NOT NULL,
  `birth_place` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_num` char(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dead` enum('Yes','No') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`id`, `first_name`, `middle_name`, `last_name`, `gender`, `birth_date`, `birth_place`, `mobile_num`, `email`, `photo`, `dead`, `created_at`, `updated_at`) VALUES
(1, 'Johnny', NULL, 'Sins', 'Male', '1985-10-19', NULL, '09989712824', 'johnny_sins@gmail.com', 'johnny_sins_1541428137.png', 'Yes', '2018-09-25 17:56:44', '2018-11-05 06:28:57'),
(2, 'Kylie', NULL, 'Quinn', 'Female', '1998-01-01', NULL, '09224922566', 'kq@test.com', 'kylie_quinn_1541428112.jpg', 'No', '2018-09-25 18:17:39', '2018-11-05 06:28:32'),
(3, 'Ava', NULL, 'Taylor', 'Female', '1995-01-05', NULL, NULL, 'at@test.com', 'ava_taylor_1541428081.jpg', 'No', '2018-09-25 18:21:21', '2018-11-05 06:28:02'),
(4, 'Carl Haiden', NULL, 'Fuentes', 'Male', '1998-12-30', NULL, '09568768204', 'carlfuentes@yahoo.com', 'carl_jr_1541383495_1541463292.png', 'No', '2018-09-25 18:23:25', '2018-11-05 16:14:52'),
(5, 'Clem Joshua', NULL, 'Rama', 'Male', '1996-06-15', NULL, NULL, 'clem_joshua@yahoo.com', 'clem_1541463317.png', 'No', '2018-09-25 23:51:56', '2018-11-05 16:15:17'),
(12, 'Marion Dale', 'Cojuangco', 'Zosa', 'Male', '1963-02-11', NULL, NULL, 'marion_dale@gmail.com', NULL, NULL, '2018-10-24 06:33:10', '2018-11-05 22:11:11'),
(13, 'Angelica Gayle', 'Roa', 'Tuyogan', 'Female', '1943-11-09', NULL, NULL, 'angelica_98@yahoo.com', NULL, NULL, '2018-10-24 06:34:08', '2018-11-05 22:11:49'),
(14, 'Jude Ephraim', NULL, 'Pastor', 'Male', '2000-05-05', NULL, NULL, NULL, NULL, NULL, '2018-10-24 06:35:09', '2018-10-29 04:29:22'),
(15, 'Rina', 'Dion', 'Buenaventura', 'Female', '1995-10-10', NULL, NULL, 'rina_22@gmail.com', 'rina_1541463265.png', 'No', '2018-10-25 21:28:49', '2018-11-05 16:14:26'),
(16, 'Kristian', NULL, 'Romeo', 'Male', '1996-12-27', NULL, NULL, 'kristian_romeo@gmail.com', 'kristian_1541390255_1541463342.png', 'No', '2018-10-25 21:32:11', '2018-11-05 16:15:43'),
(17, 'Ismael', NULL, 'Fabular Jr.', 'Male', '1995-04-06', NULL, NULL, 'maelsfabular@gmail.com', 'fabular_1541492745.jpg', 'No', '2018-10-29 03:38:47', '2018-11-06 00:30:56'),
(20, 'LeBron', NULL, 'James', 'Male', '1984-09-21', NULL, NULL, 'king_james@gmail.com', 'leBron_1541428322.jpg', 'No', '2018-10-28 22:20:07', '2018-11-05 06:32:02'),
(21, 'Danica', NULL, 'Torres', 'Female', '1991-10-08', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'Antonietta', NULL, 'Saladas', 'Female', '1993-07-09', NULL, '09224447856', 'email@gmail.com', NULL, NULL, NULL, '2018-11-08 23:25:50'),
(23, 'Tomas', NULL, 'Satoranski', 'Male', '1996-12-27', NULL, NULL, 'tomas_satoranski@gmail.com', NULL, NULL, '2018-11-04 03:37:09', '2018-11-05 22:07:50'),
(24, 'Ramonito', NULL, 'Baltazar', 'Male', '1995-12-27', NULL, NULL, NULL, NULL, NULL, '2018-11-04 04:00:05', '2018-11-05 22:08:23'),
(25, 'Katty', NULL, 'Pipper', 'Female', '1993-11-05', NULL, NULL, NULL, NULL, NULL, '2018-11-04 04:29:04', '2018-11-04 04:29:04'),
(26, 'Scott Leigh', NULL, 'Lariosa', 'Male', '1995-02-12', NULL, NULL, 'scotty2hotty@yahoo.com', 'scott_1541428172.jpg', 'No', '2018-11-04 17:50:18', '2018-11-05 06:29:32'),
(27, 'Trisha', NULL, 'Dionson', 'Female', '1996-11-07', NULL, NULL, 'trisha_gee@yahoo.com', 'trisha_1541463377.jpg', 'No', '2018-11-04 18:09:27', '2018-11-05 16:16:17'),
(33, 'Abegail Jane', NULL, 'Martillan', 'Female', '1997-01-08', NULL, NULL, 'martillan_abegail@yahoo.com', 'abegail_1541429261.jpg', 'No', '2018-11-05 06:25:50', '2018-11-05 06:47:41'),
(34, 'Gregg', NULL, 'Popovich', 'Male', '1946-04-19', NULL, NULL, 'gregg_theGreat_popovich@yahoo.com', 'gregg_popovich_1541429115.jpg', 'No', '2018-11-05 06:45:15', '2018-11-05 06:45:15'),
(35, 'Luzviminda Nikka', NULL, 'Buenaventura', 'Female', '1935-11-04', NULL, NULL, NULL, 'granny_1541463596.jpg', 'No', '2018-11-05 16:19:33', '2018-11-06 01:20:40'),
(36, 'Crisanto Hesus', NULL, 'Buenaventura', 'Male', '1933-08-06', NULL, NULL, NULL, 'grandpa_1541463683.jpg', 'No', '2018-11-05 16:21:23', '2018-11-06 01:20:53'),
(37, 'Crishane Marie', NULL, 'Quimbo', 'Female', '1998-02-26', NULL, NULL, 'crishane_22@gmail.com', 'crishane marie quimbo_1541492839.jpg', 'No', '2018-11-06 00:27:19', '2018-11-06 01:08:27'),
(38, 'Monique Claire', NULL, 'Cornejo', 'Female', '1998-07-18', NULL, NULL, 'moniqueclaire_11@gmail.com', 'monique_1541493008.jpg', 'No', '2018-11-06 00:30:08', '2018-11-06 00:30:35'),
(39, 'Lowell Jared', NULL, 'Relao', 'Male', '1996-02-04', NULL, '09884523365', 'lowelljaredrelao@yahoo.com', 'lowell_1541493279.jpg', 'No', '2018-11-06 00:34:39', '2018-11-06 00:34:39'),
(40, 'Joemar', NULL, 'Jugalbot', 'Male', '1995-05-19', NULL, '09235557821', 'joemar_jugalbot@gmail.com', 'jomar_1541493370.jpg', 'No', '2018-11-06 00:36:10', '2018-11-06 00:36:10'),
(41, 'Arwind', NULL, 'Santos', 'Male', '1982-02-11', NULL, '09352224518', 'arwind_santos@gmail.com', NULL, 'No', '2018-11-07 14:31:18', '2018-11-07 14:31:18'),
(42, 'Monica', NULL, 'Lim', 'Female', '1994-04-11', NULL, '09225478856', 'monicalim@gmail.com', NULL, NULL, '2018-11-08 06:15:58', '2018-11-08 06:15:58'),
(43, 'scott', 'scott', 'scott', 'Female', '1996-02-22', NULL, '9222222224', 'test@test.test', NULL, 'No', '2018-11-09 06:20:47', '2018-11-08 23:13:24'),
(44, 'fitt', NULL, 'lariosa', 'Male', '1991-12-26', NULL, '912335448', 'fitt@fitt.com', 'noimagemale.png', 'No', '2018-11-08 22:41:02', '2018-11-08 22:41:02'),
(45, 'dsadsadasdasdas', NULL, 'dasdsadas', 'Male', '2000-03-22', NULL, '9110009766', 'dasdasdas@fadsada.com', 'noimagemale.png', 'No', '2018-11-08 22:44:23', '2018-11-08 22:44:23'),
(46, 'dasdas', NULL, 'okkko', 'Male', '2009-01-02', NULL, '9887776544', 'variable@yahoo.com', 'noimagemale.png', 'No', '2018-11-08 22:45:27', '2018-11-08 22:45:27'),
(47, 'whattt', 'whattt', 'whattt', 'Male', '2009-01-02', NULL, '9988877766', 'what@gmail.com', 'noimagemale.png', 'No', '2018-11-08 22:48:42', '2018-11-08 22:48:42'),
(48, 'Godwin', NULL, 'Monserate', 'Male', '1990-11-28', NULL, '00956876927', 'gsm@email.com', NULL, 'No', '2018-11-09 07:07:21', '2018-11-09 07:07:21'),
(49, 'Future', NULL, 'Nalang', 'Female', '1990-08-01', NULL, '00913830830', 'future@nalang.com', '1_1541748057.png', 'No', '2018-11-09 07:19:28', '2018-11-08 23:20:57'),
(50, 'olajuwon', NULL, 'hakeem', 'Male', '2009-02-11', NULL, '9221234213', 'email@gmail.com', '3_1541748129.png', 'No', '2018-11-08 23:22:09', '2018-11-08 23:22:09');

-- --------------------------------------------------------

--
-- Table structure for table `relief_operations`
--

CREATE TABLE `relief_operations` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `donor` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sender_id` int(10) UNSIGNED DEFAULT NULL,
  `dest_center_id` int(10) UNSIGNED NOT NULL,
  `confirmation` enum('En Route','Arrived','Encoding') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `relief_operations`
--

INSERT INTO `relief_operations` (`id`, `name`, `donor`, `sender_id`, `dest_center_id`, `confirmation`, `created_at`, `updated_at`) VALUES
(4, 'Kapuso Mo Jessica Soho - Operation Typhoon', 'Michael V. Pangilingan', NULL, 1, 'Arrived', '2018-10-20 04:32:54', '2018-10-20 04:39:35'),
(5, 'Helping Hands', 'Red Cross International', NULL, 1, 'Arrived', '2018-10-20 04:35:57', '2018-10-20 04:42:46'),
(6, 'International Help', 'United Nations', NULL, 1, 'Arrived', '2018-10-20 04:36:50', '2018-10-20 04:37:20'),
(7, 'Resupply', NULL, 1, 2, 'Arrived', '2018-10-20 04:48:28', '2018-11-09 07:48:29'),
(8, 'Hating Kapatid', NULL, 2, 3, 'Arrived', '2018-10-22 10:20:28', '2018-10-29 04:59:27'),
(9, 'Hustle, Loyalty & Respect', 'Mr. Reymart Dait', NULL, 2, 'Arrived', '2018-10-22 10:23:24', '2018-11-09 07:28:53'),
(10, 'TEAM PH SEPAK TAKRAW FOUNDATION', NULL, 2, 3, 'En Route', '2018-10-22 10:30:51', '2018-10-29 04:46:36'),
(11, 'Holy Water', 'James Yap', NULL, 2, 'Arrived', '2018-10-23 06:17:00', '2018-10-23 06:18:42'),
(14, 'WWE Cares', 'The Undertaker', NULL, 2, 'Arrived', '2018-10-29 07:13:46', '2018-10-29 07:29:08'),
(15, 'Sagip Kapamilya Foundation', NULL, 2, 3, 'Encoding', '2018-10-29 12:35:21', '2018-10-29 12:35:21'),
(18, 'Alberto\'s Loves People', NULL, 2, 3, 'Encoding', '2018-11-04 04:36:44', '2018-11-04 04:36:44'),
(19, 'Alagang PBA', NULL, 1, 2, 'Arrived', '2018-11-04 04:43:13', '2018-11-09 07:49:14'),
(20, 'Chooks To Go Foundation', NULL, 1, 2, 'Encoding', '2018-11-05 07:09:20', '2018-11-05 07:09:20'),
(21, 'Stick Together', 'Mr. Jude Pantillano', NULL, 2, 'Encoding', '2018-11-05 07:13:28', '2018-11-05 07:13:28'),
(22, '2018-11-08 - Approved Relief Operation for SM City Seaside', NULL, 1, 2, 'Encoding', '2018-11-08 08:11:13', '2018-11-08 08:11:13'),
(23, '2018-11-09 - Approved Relief Operation for SM City Seaside', NULL, 1, 2, 'Encoding', '2018-11-09 06:12:40', '2018-11-09 06:12:40'),
(24, 'Mission Impossible', NULL, 1, 2, 'Encoding', '2018-11-09 07:47:25', '2018-11-09 07:47:25'),
(25, 'Alay Lakad', 'Mr. Fuentes Dad', NULL, 1, 'Arrived', '2018-11-09 07:49:51', '2018-11-09 07:50:19'),
(26, '2018-11-09 - Approved Relief Operation for SM City Seaside', NULL, 1, 2, 'Encoding', '2018-11-09 07:52:05', '2018-11-09 07:52:05');

-- --------------------------------------------------------

--
-- Table structure for table `relief_packages`
--

CREATE TABLE `relief_packages` (
  `id` int(10) UNSIGNED NOT NULL,
  `relief_operation_id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `qty` decimal(19,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `relief_packages`
--

INSERT INTO `relief_packages` (`id`, `relief_operation_id`, `item_id`, `qty`, `created_at`, `updated_at`) VALUES
(2, 6, 6, '100.00', '2018-10-20 04:37:13', '2018-10-20 04:37:13'),
(3, 4, 7, '100.00', '2018-10-20 04:38:21', '2018-10-20 04:38:21'),
(4, 4, 1, '20.00', '2018-10-20 04:38:54', '2018-10-20 04:38:54'),
(5, 4, 8, '10.00', '2018-10-20 04:39:29', '2018-10-20 04:39:29'),
(6, 5, 1, '30.00', '2018-10-20 04:42:42', '2018-10-20 04:42:42'),
(7, 7, 1, '25.00', '2018-10-20 04:49:19', '2018-10-20 04:49:19'),
(8, 9, 7, '3.00', '2018-10-22 10:23:41', '2018-10-22 10:23:41'),
(9, 9, 3, '5.00', '2018-10-22 10:23:57', '2018-10-22 10:23:57'),
(10, 9, 2, '20.00', '2018-10-22 10:24:25', '2018-10-22 10:24:25'),
(13, 11, 9, '23.00', '2018-10-23 06:18:37', '2018-10-23 06:18:37'),
(16, 14, 11, '2.00', '2018-10-29 07:15:39', '2018-10-29 07:15:39'),
(17, 14, 1, '1.00', '2018-10-29 07:23:01', '2018-10-29 07:23:01'),
(20, 8, 2, '2.00', '2018-10-29 12:59:18', '2018-10-29 12:59:18'),
(23, 20, 6, '2.00', '2018-11-05 07:09:40', '2018-11-05 07:09:40'),
(24, 15, 11, '2.00', '2018-11-06 09:47:13', '2018-11-06 09:47:13'),
(26, 18, 9, '5.00', '2018-11-06 09:50:15', '2018-11-06 09:50:15'),
(28, 19, 8, '8.00', '2018-11-06 11:11:57', '2018-11-06 11:11:57'),
(29, 25, 16, '4.00', '2018-11-09 07:50:16', '2018-11-09 07:50:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` enum('Household Account','Evacuation Center Account','Command Center Account') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `user_type`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'test123', '$2y$10$/rmCMvge5W7/qLghT8gzLeI7ezSU0tEAgV4KaTk.x3XWHn8kmJshi', 'Household Account', '6IqiitnKsvSPgBKug5qxDCX4V6kddV9LvpLRg7Xz11PQA6yObfy8uKSfqHzL', '2018-09-25 17:56:45', '2018-09-25 17:56:45'),
(2, 'king_goat', '$2y$10$T1VPRMzCroR9Io95X3fr9OziDFJ6no/JPciOaQaDtuuiJsdAIMBLu', 'Household Account', 'TWaxkPXZVK1lT6ZxvU9UAizW2jmXtwU68DV6qgqnhlX2GN3KCy2PfytQjSjc', '2018-09-25 18:23:25', '2018-09-25 18:23:25'),
(3, 'admin', '$2y$10$T1VPRMzCroR9Io95X3fr9OziDFJ6no/JPciOaQaDtuuiJsdAIMBLu', 'Command Center Account', 'TXzhe4vfFtondsRELehWkc7BJL4pZCZITfWLniiFeGH8AjwbxKYIeCbNBSOQ', NULL, NULL),
(20, 'evac_admin', '$2y$10$tJU0E/Q/QNFGRVE4fSoBPe5Z9Ya8WvZlFIZZYbEXUXWMhxeL4m6xC', 'Evacuation Center Account', 'AiNe2HF8YPCX8oX1ogy15qVUVzRvYYQmxqoOE4aQhwpaJ83S8REb1nNM4Ghq', '2018-09-29 18:33:49', '2018-10-19 21:11:03'),
(21, 'evac_admin_2', '$2y$10$7qTRyNNpuSAqmD5dD6fUjON4uEeYA4.uXRMTAuf/W/GBBOE0HDOfe', 'Evacuation Center Account', 'UvOm3cfBbOKXDIg3ubV3VSjmcVwfPZwbhpt9lSO6yVEt0vgtmPfRNR6BelXK', '2018-10-01 22:59:42', '2018-10-01 22:59:42'),
(22, 'evaclapu', '$2y$10$oagMSumx2rXE0utTAWpmNejPeQ9XDzD6HQt7Z6jmVHM08yOR3TZKW', 'Evacuation Center Account', 'KhfQIopJhpM7ofBKcmc9b3CtBW9YoJZ5XIK0nDBf92SSKPcVfEkHQK5OlmzT', '2018-10-21 21:07:15', '2018-10-21 21:07:15'),
(29, 'example_123', '$2y$10$qAEAiqC4gVo9ITI4FKhGAurUsnpxla.rZkiIQnYFSZ7ul7DnVTNNi', 'Household Account', 'STPYOK11tQZITHy0Cp7sfv5I3M4xrdZy8wwnd2q1qMrsDdljQXNdtPMW2uRM', '2018-10-29 03:38:47', '2018-10-29 03:38:47'),
(30, 'scott', '$2y$10$RLEXxTvLWYxXkHmCfNihWOO08sLVv8nebVx7kzZ.I2zVuej9BKvnO', 'Household Account', 'tsfCesHLO5ZRQkwMkqCgF02g1ms05BQ1DPKVa7QHYSKOodGb80E1gPtdJp1E', '2018-11-09 06:20:48', '2018-11-09 06:20:48'),
(31, 'fresh96', '$2y$10$750EHWQnUkk6/sys0hL4MuR5K0mDJT7owJF3B3h7BuJ/UoR.hWxKm', 'Household Account', NULL, '2018-11-09 07:07:21', '2018-11-09 07:07:21'),
(32, 'capstone', '$2y$10$HWkMhWPxSzbb9zd45a8nDuTIlUlbNbvK7kV29Y8hPV838Qc/fkZbS', 'Household Account', 'ElxMRzUCwnqTtCFaJsx6en1wQ2hbliM8aLwxnyOxKgUK07OI6jcRx4T0ixXH', '2018-11-09 07:19:28', '2018-11-08 23:23:54');

-- --------------------------------------------------------

--
-- Table structure for table `worker_requests`
--

CREATE TABLE `worker_requests` (
  `id` int(10) UNSIGNED NOT NULL,
  `center_id` int(10) UNSIGNED NOT NULL,
  `num_staff_needed` int(11) NOT NULL,
  `reasons` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Pending','Approved','Denied','Encoding') COLLATE utf8mb4_unicode_ci NOT NULL,
  `final_remarks` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `worker_requests`
--

INSERT INTO `worker_requests` (`id`, `center_id`, `num_staff_needed`, `reasons`, `status`, `final_remarks`, `created_at`, `updated_at`) VALUES
(5, 2, 8, 'mao lang tripping haha xD', 'Approved', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aid_workers`
--
ALTER TABLE `aid_workers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aid_workers_person_id_foreign` (`person_id`);

--
-- Indexes for table `aid_worker_assignments`
--
ALTER TABLE `aid_worker_assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aid_worker_assignments_aid_worker_id_foreign` (`aid_worker_id`),
  ADD KEY `aid_worker_assignments_center_id_foreign` (`center_id`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `announcements_center_id_foreign` (`center_id`);

--
-- Indexes for table `barangays`
--
ALTER TABLE `barangays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `centers`
--
ALTER TABLE `centers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `centers_user_id_foreign` (`user_id`),
  ADD KEY `centers_brgy_id_foreign` (`brgy_id`);

--
-- Indexes for table `evacuations`
--
ALTER TABLE `evacuations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evacuations_brgy_id_foreign` (`brgy_id`);

--
-- Indexes for table `households`
--
ALTER TABLE `households`
  ADD PRIMARY KEY (`id`),
  ADD KEY `households_user_id_foreign` (`user_id`),
  ADD KEY `households_brgy_id_foreign` (`brgy_id`);

--
-- Indexes for table `household_evacs`
--
ALTER TABLE `household_evacs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `household_evacs_household_member_id_foreign` (`household_member_id`),
  ADD KEY `household_evacs_center_id_foreign` (`center_id`),
  ADD KEY `household_evacs_evacuation_id_foreign` (`evacuation_id`);

--
-- Indexes for table `household_members`
--
ALTER TABLE `household_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `household_members_person_id_foreign` (`person_id`),
  ADD KEY `household_members_house_id_foreign` (`house_id`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventories_center_id_foreign` (`center_id`),
  ADD KEY `inventories_item_id_foreign` (`item_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_request_forms`
--
ALTER TABLE `item_request_forms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_request_forms_center_id_foreign` (`user_id`);

--
-- Indexes for table `item_request_lists`
--
ALTER TABLE `item_request_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_request_lists_request_id_foreign` (`item_request_form_id`),
  ADD KEY `item_request_lists_item_id_foreign` (`item_id`);

--
-- Indexes for table `medical_backgrounds`
--
ALTER TABLE `medical_backgrounds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medical_backgrounds_household_member_id_foreign` (`household_member_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_user_id_foreign` (`user_id`);

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
-- Indexes for table `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `relief_operations`
--
ALTER TABLE `relief_operations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `relief_operations_dest_center_id_foreign` (`dest_center_id`),
  ADD KEY `relief_operations_sender_id_foreign` (`sender_id`);

--
-- Indexes for table `relief_packages`
--
ALTER TABLE `relief_packages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `relief_packages_relief_ops_id_foreign` (`relief_operation_id`),
  ADD KEY `relief_packages_item_id_foreign` (`item_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- Indexes for table `worker_requests`
--
ALTER TABLE `worker_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `worker_requests_center_id_foreign` (`center_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aid_workers`
--
ALTER TABLE `aid_workers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `aid_worker_assignments`
--
ALTER TABLE `aid_worker_assignments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `barangays`
--
ALTER TABLE `barangays`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `centers`
--
ALTER TABLE `centers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `evacuations`
--
ALTER TABLE `evacuations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `households`
--
ALTER TABLE `households`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `household_evacs`
--
ALTER TABLE `household_evacs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `household_members`
--
ALTER TABLE `household_members`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `item_request_forms`
--
ALTER TABLE `item_request_forms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `item_request_lists`
--
ALTER TABLE `item_request_lists`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `medical_backgrounds`
--
ALTER TABLE `medical_backgrounds`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `people`
--
ALTER TABLE `people`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `relief_operations`
--
ALTER TABLE `relief_operations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `relief_packages`
--
ALTER TABLE `relief_packages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `worker_requests`
--
ALTER TABLE `worker_requests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aid_workers`
--
ALTER TABLE `aid_workers`
  ADD CONSTRAINT `aid_workers_person_id_foreign` FOREIGN KEY (`person_id`) REFERENCES `people` (`id`);

--
-- Constraints for table `aid_worker_assignments`
--
ALTER TABLE `aid_worker_assignments`
  ADD CONSTRAINT `aid_worker_assignments_aid_worker_id_foreign` FOREIGN KEY (`aid_worker_id`) REFERENCES `aid_workers` (`id`),
  ADD CONSTRAINT `aid_worker_assignments_center_id_foreign` FOREIGN KEY (`center_id`) REFERENCES `centers` (`id`);

--
-- Constraints for table `announcements`
--
ALTER TABLE `announcements`
  ADD CONSTRAINT `announcements_center_id_foreign` FOREIGN KEY (`center_id`) REFERENCES `centers` (`id`);

--
-- Constraints for table `centers`
--
ALTER TABLE `centers`
  ADD CONSTRAINT `centers_brgy_id_foreign` FOREIGN KEY (`brgy_id`) REFERENCES `barangays` (`id`),
  ADD CONSTRAINT `centers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `evacuations`
--
ALTER TABLE `evacuations`
  ADD CONSTRAINT `evacuations_brgy_id_foreign` FOREIGN KEY (`brgy_id`) REFERENCES `barangays` (`id`);

--
-- Constraints for table `households`
--
ALTER TABLE `households`
  ADD CONSTRAINT `households_brgy_id_foreign` FOREIGN KEY (`brgy_id`) REFERENCES `barangays` (`id`),
  ADD CONSTRAINT `households_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `household_evacs`
--
ALTER TABLE `household_evacs`
  ADD CONSTRAINT `household_evacs_center_id_foreign` FOREIGN KEY (`center_id`) REFERENCES `centers` (`id`),
  ADD CONSTRAINT `household_evacs_evacuation_id_foreign` FOREIGN KEY (`evacuation_id`) REFERENCES `evacuations` (`id`),
  ADD CONSTRAINT `household_evacs_household_member_id_foreign` FOREIGN KEY (`household_member_id`) REFERENCES `household_members` (`id`);

--
-- Constraints for table `household_members`
--
ALTER TABLE `household_members`
  ADD CONSTRAINT `household_members_house_id_foreign` FOREIGN KEY (`house_id`) REFERENCES `households` (`id`),
  ADD CONSTRAINT `household_members_person_id_foreign` FOREIGN KEY (`person_id`) REFERENCES `people` (`id`);

--
-- Constraints for table `inventories`
--
ALTER TABLE `inventories`
  ADD CONSTRAINT `inventories_center_id_foreign` FOREIGN KEY (`center_id`) REFERENCES `centers` (`id`),
  ADD CONSTRAINT `inventories_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`);

--
-- Constraints for table `item_request_forms`
--
ALTER TABLE `item_request_forms`
  ADD CONSTRAINT `item_request_forms_center_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `item_request_lists`
--
ALTER TABLE `item_request_lists`
  ADD CONSTRAINT `item_request_lists_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `item_request_lists_request_id_foreign` FOREIGN KEY (`item_request_form_id`) REFERENCES `item_request_forms` (`id`);

--
-- Constraints for table `medical_backgrounds`
--
ALTER TABLE `medical_backgrounds`
  ADD CONSTRAINT `medical_backgrounds_household_member_id_foreign` FOREIGN KEY (`household_member_id`) REFERENCES `household_members` (`id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `relief_operations`
--
ALTER TABLE `relief_operations`
  ADD CONSTRAINT `relief_operations_dest_center_id_foreign` FOREIGN KEY (`dest_center_id`) REFERENCES `centers` (`id`),
  ADD CONSTRAINT `relief_operations_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `centers` (`id`);

--
-- Constraints for table `relief_packages`
--
ALTER TABLE `relief_packages`
  ADD CONSTRAINT `relief_packages_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`),
  ADD CONSTRAINT `relief_packages_relief_ops_id_foreign` FOREIGN KEY (`relief_operation_id`) REFERENCES `relief_operations` (`id`);

--
-- Constraints for table `worker_requests`
--
ALTER TABLE `worker_requests`
  ADD CONSTRAINT `worker_requests_center_id_foreign` FOREIGN KEY (`center_id`) REFERENCES `centers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
