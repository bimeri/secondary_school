-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2021 at 03:10 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_super` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_name` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '2.png',
  `gender` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `first_name`, `last_name`, `is_super`, `email`, `user_name`, `profile`, `gender`, `date_of_birth`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Bimeri', 'Noel', 1, 'bimerinoel@gmail.com', 'bimeri', 'default.png', 'Male', '25/12/1997', '$2y$10$M6UuO.Bdobt9u0HCymWfEeHgZoU/UzKZRZThCaEoXrAD6AIPySm4.', NULL, '2020-06-26 00:00:53', '2020-06-26 00:00:53'),
(2, 'Second', 'Admin', 0, 'example@gmail.com', 'second', 'default.png', 'Male', '01/02/1992', '$2y$10$6GGZg9mPlbwYvPNCVCMv2.1nhoRSFjz.MLtsSCQVexj/.PjMLbmv6', NULL, '2020-06-26 00:00:53', '2020-06-26 00:00:53'),
(8, 'Valeri', 'Ndelayang', 0, 'valeri@gmail.com', 'valery', '8.jpg', 'Male', 'Jul 28, 1999', '$2y$10$9cOhqX3yhO41g2l0shTQxO1baRlqWR23DQi.UmJOsIcUXcjmjIJrO', NULL, '2020-06-30 23:36:29', '2020-06-30 23:36:29'),
(14, 'test', 'user', 0, 'test@gmail.com', 'test', '14.jpg', 'Female', 'Jul 01, 2020', '$2y$10$wii8mxAbQPMZ0aayuANmleEysIrGgm7ZSlSfV2KrIviTzNcLJP1/G', NULL, '2020-07-03 03:12:42', '2020-07-03 03:12:42'),
(15, 'MBAH', 'ISAAC', 0, 'daf@me.com', 'NISHANG', '15.png', 'Male', 'Jul 13, 2020', '$2y$10$DGrTBYFN2eTDbYHDTjY9EeXyi6y5UrxtGH6qY5j4swMlTloeGg5R.', NULL, '2020-07-05 18:10:20', '2020-07-05 18:10:20');

-- --------------------------------------------------------

--
-- Table structure for table `admin_permission`
--

CREATE TABLE `admin_permission` (
  `id` int(10) UNSIGNED NOT NULL,
  `admin_id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_role`
--

CREATE TABLE `admin_role` (
  `id` int(10) UNSIGNED NOT NULL,
  `admin_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `id` int(10) UNSIGNED NOT NULL,
  `year_id` int(10) UNSIGNED NOT NULL,
  `teacher_id` int(10) UNSIGNED NOT NULL,
  `subject_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`id`, `year_id`, `teacher_id`, `subject_id`, `name`, `text`, `create_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 28, 'Research on the new Philosopher', 'write your well formated <b>assigments here</b>!', 'Mon, 01 Feb 2121', 0, '2021-02-01 18:53:42', '2021-02-01 18:53:42');

-- --------------------------------------------------------

--
-- Table structure for table `backgrounds`
--

CREATE TABLE `backgrounds` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sector_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `backgrounds`
--

INSERT INTO `backgrounds` (`id`, `name`, `sector_id`, `created_at`, `updated_at`) VALUES
(1, 'first Cycle', 1, '2020-07-05 22:52:07', '2020-07-05 22:52:07'),
(3, 'Second Cycle', 1, '2020-07-06 20:42:27', '2020-07-06 20:42:27'),
(4, 'First Cycle', 4, '2020-08-10 02:35:28', '2020-08-10 02:35:28'),
(5, 'Second Cycle', 4, '2020-10-24 20:06:14', '2020-10-24 20:06:14');

-- --------------------------------------------------------

--
-- Table structure for table `disciplines`
--

CREATE TABLE `disciplines` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `disciplines`
--

INSERT INTO `disciplines` (`id`, `type`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Corrective Discipline', 'When a student has failed to redirect her behavior after repeated attempts at supportive discipline, a teacher may opt for a corrective discipline strategy.', '2020-07-24 22:13:04', '2020-07-24 22:13:04');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Scholarship', '2020-09-17 19:33:20', '2020-09-17 19:33:20'),
(2, 'Medication', '2020-09-17 19:39:11', '2020-09-17 19:39:11'),
(3, 'Part-time Teacher', '2020-09-17 21:41:37', '2020-09-17 21:41:37'),
(4, 'Handicap', '2020-09-19 09:08:21', '2020-09-19 09:08:21'),
(5, 'IDP', '2020-09-27 12:52:29', '2020-09-27 12:52:29'),
(6, 'Library', '2020-09-27 12:52:46', '2020-09-27 12:52:46'),
(7, 'Sport Activities', '2020-10-03 17:33:21', '2020-10-03 17:33:21');

-- --------------------------------------------------------

--
-- Table structure for table `expensetypes`
--

CREATE TABLE `expensetypes` (
  `id` int(10) UNSIGNED NOT NULL,
  `year_id` int(10) UNSIGNED NOT NULL,
  `term_id` int(10) UNSIGNED NOT NULL,
  `expense_id` int(10) UNSIGNED DEFAULT NULL,
  `amount` decimal(6,1) UNSIGNED DEFAULT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expensetypes`
--

INSERT INTO `expensetypes` (`id`, `year_id`, `term_id`, `expense_id`, `amount`, `reason`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '3000.0', 'form one student had medication problem, so little was spent on them', '2020-07-30 10:09:34', '2020-07-30 10:09:34'),
(2, 3, 2, 2, '1500.0', 'money spend on scholarship this terms', '2020-07-30 10:20:48', '2020-07-30 10:20:48'),
(3, 1, 1, 1, '3090.0', 'unknown reason', '2020-09-17 21:42:35', '2020-09-17 21:42:35'),
(4, 1, 1, 3, '1000.0', 'new teachers came entered', '2020-09-19 08:33:41', '2020-09-19 08:33:41'),
(5, 1, 1, 4, '2000.0', 'nothing much', '2020-09-19 10:39:46', '2020-09-19 10:39:46'),
(6, 1, 1, 7, '10000.0', 'spend money of sport', '2020-10-03 17:34:28', '2020-10-03 17:34:28'),
(7, 1, 2, 1, '2000.0', 'best students award', '2020-11-14 08:31:08', '2020-11-14 08:31:08');

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
-- Table structure for table `feecontrols`
--

CREATE TABLE `feecontrols` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `student_school_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `form_id` int(10) UNSIGNED NOT NULL,
  `year_id` int(10) UNSIGNED NOT NULL,
  `clearance_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feecontrols`
--

INSERT INTO `feecontrols` (`id`, `student_id`, `student_school_id`, `form_id`, `year_id`, `clearance_date`, `created_at`, `updated_at`) VALUES
(11, 48, 'BG19A007', 11, 1, 'Mon, 02 Nov 2020 09:00am', '2020-11-02 08:00:10', '2020-11-02 08:00:10'),
(12, 43, 'BG19A002', 11, 1, 'Tue, 09 Feb 2021 19:47pm', '2021-02-09 18:47:48', '2021-02-09 18:47:48'),
(13, 51, 'BG19A010', 11, 1, 'Wed, 10 Feb 2021 10:44am', '2021-02-10 09:44:40', '2021-02-10 09:44:40'),
(14, 54, 'BG19A013', 9, 1, 'Wed, 10 Feb 2021 11:39am', '2021-02-10 10:39:18', '2021-02-10 10:39:18');

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `id` int(10) UNSIGNED NOT NULL,
  `year_id` int(10) UNSIGNED NOT NULL,
  `feetype_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `student_school_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `form_id` int(10) UNSIGNED DEFAULT NULL,
  `scholarship` bigint(10) DEFAULT NULL,
  `amount` bigint(20) UNSIGNED NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balance` bigint(20) UNSIGNED DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `payment_date` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT '01/01/1999',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`id`, `year_id`, `feetype_id`, `student_id`, `student_school_id`, `form_id`, `scholarship`, `amount`, `payment_method`, `balance`, `status`, `payment_date`, `created_at`, `updated_at`) VALUES
(47, 1, 13, 48, 'BG19A007', 11, NULL, 30000, 'mtn money', 4000, 0, 'Nov 02, 2020 - 08:50am', '2020-11-02 07:50:36', '2020-11-02 07:50:36'),
(48, 1, 13, 48, 'BG19A007', 11, NULL, 4000, 'Cash Payment', 0, 1, 'Nov 02, 2020 - 08:59am', '2020-11-02 07:59:30', '2020-11-02 07:59:30'),
(49, 2, 15, 51, 'BG19A010', 11, NULL, 10000, 'mtn money', 20000, 0, 'Feb 09, 2021 - 12:27am', '2021-02-08 23:27:20', '2021-02-08 23:27:20'),
(50, 1, 13, 51, 'BG19A010', 11, NULL, 10000, 'cash collect', 24000, 0, 'Feb 09, 2021 - 12:29am', '2021-02-08 23:29:22', '2021-02-08 23:29:22'),
(51, 1, 13, 51, 'BG19A010', 11, NULL, 10000, NULL, 14000, 0, 'Feb 09, 2021 - 12:30am', '2021-02-08 23:30:57', '2021-02-08 23:30:57'),
(52, 1, 13, 51, 'BG19A010', 11, NULL, 10001, NULL, 3999, 0, 'Feb 09, 2021 - 12:31am', '2021-02-08 23:31:44', '2021-02-08 23:31:44'),
(53, 1, 14, 51, 'BG19A010', 11, NULL, 4000, NULL, 1000, 0, 'Feb 09, 2021 - 12:32am', '2021-02-08 23:32:30', '2021-02-08 23:32:30'),
(54, 1, 14, 51, 'BG19A010', 11, NULL, 999, NULL, 1, 0, 'Feb 09, 2021 - 12:34am', '2021-02-08 23:34:26', '2021-02-08 23:34:26'),
(55, 1, 13, 51, 'BG19A010', 11, NULL, 3999, NULL, 0, 1, 'Feb 09, 2021 - 12:34am', '2021-02-08 23:34:55', '2021-02-08 23:34:55'),
(56, 1, 13, 43, 'BG19A002', 11, NULL, 34000, 'Orange Money', 0, 1, 'Feb 09, 2021 - 07:43pm', '2021-02-09 18:43:47', '2021-02-09 18:43:47'),
(57, 1, 14, 43, 'BG19A002', 11, NULL, 4000, NULL, 1000, 0, 'Feb 09, 2021 - 07:44pm', '2021-02-09 18:44:14', '2021-02-09 18:44:14'),
(58, 1, 14, 42, 'BG19A001', 11, 2000, 1000, NULL, 4000, 0, 'Feb 09, 2021 - 07:46pm', '2021-02-09 18:46:10', '2021-02-09 18:46:10'),
(59, 1, 14, 43, 'BG19A002', 11, NULL, 1000, NULL, 0, 1, 'Feb 09, 2021 - 07:46pm', '2021-02-09 18:46:54', '2021-02-09 18:46:54'),
(60, 1, 14, 48, 'BG19A007', 11, NULL, 3000, NULL, 2000, 0, 'Feb 09, 2021 - 09:48pm', '2021-02-09 20:48:53', '2021-02-09 20:48:53'),
(61, 1, 14, 48, 'BG19A007', 11, NULL, 2000, NULL, 0, 1, 'Feb 09, 2021 - 09:49pm', '2021-02-09 20:49:10', '2021-02-09 20:49:10'),
(62, 1, 14, 51, 'BG19A010', 11, NULL, 1, 'mtn money', 0, 1, 'Feb 09, 2021 - 09:49pm', '2021-02-09 20:49:35', '2021-02-09 20:49:35'),
(63, 1, 14, 45, 'BG19A004', 11, 7000, 5000, 'Orange Money', 0, 1, 'Feb 09, 2021 - 09:50pm', '2021-02-09 20:50:19', '2021-02-09 20:50:19'),
(64, 1, 19, 54, 'BG19A013', 9, 2000, 8000, 'mtn money', 2000, 0, 'Feb 10, 2021 - 11:34am', '2021-02-10 10:34:32', '2021-02-10 10:34:32'),
(65, 1, 19, 54, 'BG19A013', 9, NULL, 1000, NULL, 1000, 0, 'Feb 10, 2021 - 11:35am', '2021-02-10 10:35:13', '2021-02-10 10:35:13'),
(66, 1, 20, 54, 'BG19A013', 9, NULL, 9000, NULL, 1000, 0, 'Feb 10, 2021 - 11:35am', '2021-02-10 10:35:32', '2021-02-10 10:35:32'),
(67, 1, 20, 54, 'BG19A013', 9, NULL, 1000, NULL, 0, 1, 'Feb 10, 2021 - 11:37am', '2021-02-10 10:37:15', '2021-02-10 10:37:15'),
(68, 1, 19, 54, 'BG19A013', 9, NULL, 1000, NULL, 0, 1, 'Feb 10, 2021 - 11:38am', '2021-02-10 10:38:01', '2021-02-10 10:38:01'),
(69, 1, 21, 54, 'BG19A013', 9, NULL, 5000, 'Orange Money', 5000, 0, 'Feb 10, 2021 - 11:38am', '2021-02-10 10:38:45', '2021-02-10 10:38:45'),
(70, 1, 21, 54, 'BG19A013', 9, NULL, 5000, 'mtn money', 0, 1, 'Feb 10, 2021 - 11:39am', '2021-02-10 10:39:18', '2021-02-10 10:39:18');

-- --------------------------------------------------------

--
-- Table structure for table `feetypes`
--

CREATE TABLE `feetypes` (
  `id` int(10) UNSIGNED NOT NULL,
  `year_id` int(10) UNSIGNED NOT NULL,
  `form_id` int(10) UNSIGNED NOT NULL,
  `fee_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feetypes`
--

INSERT INTO `feetypes` (`id`, `year_id`, `form_id`, `fee_type`, `amount`, `created_at`, `updated_at`) VALUES
(13, 1, 11, 'Tuition', 34000, '2020-11-02 07:48:38', '2020-11-02 07:48:38'),
(14, 1, 11, 'Computer', 5000, '2020-11-02 18:55:23', '2020-11-02 18:55:23'),
(15, 2, 11, 'Tuition', 30000, '2020-11-02 18:56:37', '2020-11-02 18:56:37'),
(16, 1, 22, 'Computer', 5000, '2020-11-15 13:11:52', '2020-11-15 13:11:52'),
(17, 1, 10, 'Tuition', 30000, '2021-02-10 09:53:26', '2021-02-10 09:53:26'),
(18, 1, 10, 'Computer', 5000, '2021-02-10 09:53:43', '2021-02-10 09:53:43'),
(19, 1, 9, 'Tuition', 10000, '2021-02-10 09:56:51', '2021-02-10 09:56:51'),
(20, 1, 9, 'Caution', 10000, '2021-02-10 09:57:04', '2021-02-10 09:57:04'),
(21, 1, 9, 'Practical', 10000, '2021-02-10 09:57:16', '2021-02-10 09:57:16');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(10) UNSIGNED NOT NULL,
  `year_id` int(10) UNSIGNED NOT NULL,
  `subject_id` int(10) UNSIGNED NOT NULL,
  `teacher_id` int(10) UNSIGNED NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `share` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `year_id`, `subject_id`, `teacher_id`, `file_name`, `file_path`, `file_type`, `share`, `created_at`, `updated_at`) VALUES
(9, 1, 19, 3, 'noel_3_1.pdf', '/image/files/2019', 'PDF', 1, '2020-11-03 14:32:00', '2020-11-08 18:58:31'),
(10, 1, 19, 3, 'Recept_3_2.pdf', '/image/files/2019', 'PDF', 0, '2020-11-03 14:57:03', '2020-11-03 14:57:03'),
(11, 1, 19, 3, 'Curriculum Victae_3_3.pdf', '/image/files/2019', 'PDF', 0, '2020-11-08 17:05:20', '2020-11-08 17:05:20'),
(12, 2, 17, 3, 'example_3_1.pdf', '/image/files/2020', 'PDF', 1, '2020-11-12 22:49:07', '2020-11-13 10:05:01'),
(13, 1, 28, 1, 'monetbil-payment-api-v1-en_1_1.pdf', '/image/files/2019', 'PDF', 0, '2021-02-01 18:55:49', '2021-02-01 18:55:49');

-- --------------------------------------------------------

--
-- Table structure for table `firsttermresults`
--

CREATE TABLE `firsttermresults` (
  `id` int(10) UNSIGNED NOT NULL,
  `year_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `form_id` int(10) UNSIGNED NOT NULL,
  `form_type` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` int(10) UNSIGNED NOT NULL,
  `seq1` decimal(6,2) DEFAULT NULL,
  `seq2` decimal(6,2) DEFAULT NULL,
  `ave_point` decimal(6,2) DEFAULT NULL,
  `position` int(10) UNSIGNED DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `firsttermresults`
--

INSERT INTO `firsttermresults` (`id`, `year_id`, `student_id`, `form_id`, `form_type`, `subject_id`, `seq1`, `seq2`, `ave_point`, `position`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 44, 11, 'A', 18, '13.70', '15.80', '59.00', NULL, 1, '2020-11-07 12:30:41', '2020-11-23 09:03:14'),
(2, 1, 42, 11, 'A', 18, '16.00', '18.00', '68.00', NULL, 1, '2020-11-08 10:15:38', '2020-11-23 09:00:28'),
(3, 1, 42, 11, 'A', 19, '15.60', '18.50', '51.15', NULL, 1, '2020-11-08 10:16:02', '2020-11-23 09:00:54'),
(4, 1, 46, 11, 'A', 18, '8.50', '0.80', '18.60', NULL, 1, '2020-11-08 10:16:18', '2020-11-08 10:16:33'),
(5, 1, 46, 11, 'A', 19, '12.00', '14.50', '39.75', NULL, 1, '2020-11-08 10:16:42', '2020-11-08 10:16:50'),
(6, 1, 44, 11, 'A', 19, NULL, '18.00', '27.00', NULL, 1, '2020-11-08 10:17:01', '2020-11-23 09:01:05'),
(7, 1, 43, 11, 'B', 18, '15.00', '16.50', '63.00', NULL, 1, '2020-11-08 10:17:14', '2020-11-23 09:01:42'),
(8, 1, 45, 11, 'B', 18, '14.00', NULL, '28.00', NULL, 1, '2020-11-08 10:17:17', '2020-11-23 09:03:22'),
(9, 1, 48, 11, 'B', 18, '5.50', '11.00', '33.00', NULL, 1, '2020-11-08 10:17:21', '2020-11-23 09:03:30'),
(10, 1, 51, 11, 'B', 18, '13.00', '16.00', '58.00', NULL, 1, '2020-11-08 10:17:25', '2020-11-23 09:01:49'),
(11, 1, 43, 11, 'B', 19, '14.70', '9.00', '35.55', NULL, 1, '2020-11-08 10:17:56', '2020-11-23 09:01:33'),
(12, 1, 48, 11, 'B', 19, NULL, '11.00', '16.50', NULL, 1, '2020-11-08 10:18:24', '2020-11-23 09:01:20'),
(13, 1, 51, 11, 'B', 19, '17.00', '15.00', '48.00', NULL, 1, '2020-11-08 10:18:30', '2020-11-23 09:01:27'),
(14, 1, 45, 11, 'B', 19, '14.00', '11.00', '37.50', NULL, 1, '2020-11-08 10:18:45', '2020-11-23 09:01:29'),
(15, 1, 42, 11, 'A', 20, '12.00', '10.00', '22.00', NULL, 1, '2020-11-22 18:34:16', '2020-11-22 18:34:19'),
(16, 1, 44, 11, 'A', 20, '9.00', '11.00', '20.00', NULL, 1, '2020-11-22 18:34:26', '2020-11-22 18:34:29'),
(17, 1, 46, 11, 'A', 20, '8.00', '7.00', '15.00', NULL, 1, '2020-11-22 18:34:33', '2020-11-22 18:34:36'),
(18, 1, 42, 11, 'A', 21, '14.00', '11.50', '25.50', NULL, 1, '2020-11-22 18:34:39', '2020-11-22 18:35:22'),
(19, 1, 45, 11, 'B', 21, '14.00', '14.00', '28.00', NULL, 1, '2020-11-22 18:34:41', '2020-11-23 09:02:56'),
(20, 1, 48, 11, 'B', 21, NULL, '15.50', '15.50', NULL, 1, '2020-11-22 18:34:46', '2020-11-23 09:02:42'),
(21, 1, 43, 11, 'B', 21, '15.50', '13.00', '28.50', NULL, 1, '2020-11-22 18:34:49', '2020-11-23 09:02:52'),
(22, 1, 46, 11, 'A', 21, '13.20', '2.30', '15.50', NULL, 1, '2020-11-22 18:35:01', '2020-11-22 18:35:16'),
(23, 1, 44, 11, 'A', 21, NULL, '9.00', '9.00', NULL, 1, '2020-11-22 18:35:06', '2020-11-22 18:35:06'),
(24, 1, 51, 11, 'B', 21, '16.50', '17.50', '34.00', NULL, 1, '2020-11-22 18:35:31', '2020-11-23 09:02:36'),
(25, 1, 45, 11, 'B', 20, '16.00', NULL, '16.00', NULL, 1, '2020-11-22 18:35:48', '2020-11-22 18:35:48'),
(26, 1, 51, 11, 'B', 20, '15.00', NULL, '15.00', NULL, 1, '2020-11-22 18:35:54', '2020-11-22 18:35:54'),
(27, 1, 48, 11, 'B', 20, NULL, '7.00', '7.00', NULL, 1, '2020-11-22 18:36:10', '2020-11-23 09:02:59'),
(28, 1, 52, 9, 'A', 22, '12.00', '14.00', '52.00', NULL, 1, '2020-11-22 20:37:05', '2020-11-22 20:37:12'),
(29, 1, 52, 9, 'A', 23, '13.00', '11.00', '48.00', NULL, 1, '2020-11-22 20:37:17', '2020-11-22 20:37:20'),
(30, 1, 52, 9, 'A', 26, '17.00', '9.00', '39.00', NULL, 1, '2020-11-22 20:37:22', '2020-11-22 20:37:25'),
(31, 1, 53, 9, 'A', 26, '5.50', '10.00', '23.25', NULL, 1, '2020-11-22 20:37:29', '2020-11-22 20:37:39'),
(32, 1, 54, 9, 'A', 26, '0.00', '10.00', '15.00', NULL, 1, '2020-11-22 20:37:31', '2020-11-22 20:37:32'),
(33, 1, 53, 9, 'A', 23, '12.00', '2.50', '29.00', NULL, 1, '2020-11-22 20:37:43', '2020-11-22 20:37:58'),
(34, 1, 54, 9, 'A', 23, '15.00', '10.00', '50.00', NULL, 1, '2020-11-22 20:37:45', '2020-11-22 20:37:48'),
(35, 1, 54, 9, 'A', 22, '11.50', '11.00', '45.00', NULL, 1, '2020-11-22 20:37:51', '2020-11-22 20:38:13'),
(36, 1, 53, 9, 'A', 22, '6.50', '10.50', '34.00', NULL, 1, '2020-11-22 20:37:55', '2020-11-22 20:38:04'),
(37, 1, 43, 11, 'B', 20, NULL, '9.00', '9.00', NULL, 1, '2020-11-23 08:54:24', '2020-11-23 09:24:41');

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE `forms` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `max_number` int(11) NOT NULL,
  `background_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`id`, `name`, `code`, `type`, `max_number`, `background_id`, `created_at`, `updated_at`) VALUES
(9, 'TST 1', 'TST', 'A', 50, 4, '2020-10-12 19:31:05', '2020-10-12 19:31:05'),
(10, 'HE', 'HE', 'A', 50, 4, '2020-10-12 19:31:37', '2020-10-12 19:31:37'),
(11, 'SEBU  2', 'SEBU  2', 'A', 50, 4, '2020-10-12 19:32:22', '2020-10-12 19:32:22'),
(12, 'ESCOM  2', 'ESCOM  2', 'A', 50, 4, '2020-10-12 19:32:47', '2020-10-12 19:32:47'),
(13, 'HE 2', 'HE 2', 'A', 50, 4, '2020-10-12 19:33:12', '2020-10-12 19:33:12'),
(14, 'SEBU 3', 'SEBU 3', 'A', 50, 4, '2020-10-12 19:33:35', '2020-10-12 19:33:35'),
(15, 'ESCOM  3', 'ESCOM  3', 'A', 50, 4, '2020-10-12 19:33:54', '2020-10-12 19:33:54'),
(16, 'HE 3', 'HE 3', 'A', 50, 4, '2020-10-12 19:34:18', '2020-10-12 19:34:18'),
(17, 'SEBU 4', 'SEBU 4', 'A', 50, 4, '2020-10-12 19:34:43', '2020-10-12 19:34:43'),
(18, 'ESCOM  4', 'ESCOM  4', 'A', 50, 4, '2020-10-12 19:36:00', '2020-10-12 19:36:00'),
(19, 'HE 4', 'HE 4', 'A', 50, 4, '2020-10-12 19:36:32', '2020-10-12 19:36:32'),
(20, 'SAC  5', 'SAC  5', 'A', 50, 5, '2020-10-12 19:36:49', '2020-10-12 19:36:49'),
(21, 'ACC & MKT 5', 'ACC & MKT 5', 'A', 50, 5, '2020-10-12 19:37:22', '2020-10-12 19:37:22'),
(22, 'ESF 5', 'ESF 5', 'A', 50, 5, '2020-10-12 19:44:47', '2020-10-12 19:44:47'),
(23, 'SAC 6', 'SAC 6', 'A', 50, 5, '2020-10-12 19:45:14', '2020-10-12 19:45:14'),
(24, 'ACC & MKT  6', 'ACC & MKT  6', 'A', 50, 5, '2020-10-12 19:45:40', '2020-10-12 19:45:40'),
(25, 'ESF  6', 'ESF  6', 'A', 50, 5, '2020-10-12 19:46:03', '2020-10-12 19:46:03'),
(26, 'SAC  7', 'SAC  7', 'A', 50, 5, '2020-10-12 19:46:23', '2020-10-12 19:46:23'),
(27, 'ACCOUNTING 7', 'ACCOUNTING 7', 'A', 50, 5, '2020-10-12 19:46:53', '2020-10-12 19:46:53'),
(28, 'MARKETING 7', 'MARKETING 7', 'A', 50, 5, '2020-10-12 19:47:11', '2020-10-12 19:47:11'),
(29, 'ESF 7', 'ESF 7', 'A', 50, 5, '2020-10-12 19:47:32', '2020-10-12 19:47:32'),
(31, 'Form Three', 'FM1', 'A', 50, 1, '2020-10-26 17:06:23', '2020-10-26 17:06:23');

-- --------------------------------------------------------

--
-- Table structure for table `generateresults`
--

CREATE TABLE `generateresults` (
  `id` int(10) UNSIGNED NOT NULL,
  `year_id` int(10) UNSIGNED NOT NULL,
  `term_id` int(10) UNSIGNED NOT NULL,
  `form_id` int(10) UNSIGNED NOT NULL,
  `number_of_student` int(10) UNSIGNED NOT NULL,
  `number_passed` int(10) UNSIGNED NOT NULL,
  `class_avg` decimal(6,2) UNSIGNED NOT NULL,
  `highest_avg` decimal(6,2) UNSIGNED NOT NULL,
  `lowest_avg` decimal(6,2) UNSIGNED NOT NULL,
  `rank_student` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `generateresults`
--

INSERT INTO `generateresults` (`id`, `year_id`, `term_id`, `form_id`, `number_of_student`, `number_passed`, `class_avg`, `highest_avg`, `lowest_avg`, `rank_student`, `created_at`, `updated_at`) VALUES
(10, 1, 1, 11, 7, 4, '10.95', '15.15', '6.55', 1, '2020-11-23 12:27:34', '2020-11-23 12:27:34'),
(11, 1, 1, 9, 3, 2, '10.16', '12.64', '7.84', 1, '2020-11-23 17:26:55', '2020-11-23 17:26:55'),
(15, 1, 2, 11, 7, 5, '12.28', '18.73', '8.77', 1, '2020-11-24 21:07:57', '2020-11-24 21:07:57');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(10) UNSIGNED NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `locale`, `active`, `created_at`, `updated_at`) VALUES
(1, 'en', 1, NULL, NULL),
(2, 'fr', 0, NULL, NULL);

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
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2020_06_24_192008_create_years_table', 3),
(6, '2020_06_24_192728_create_settings_table', 4),
(7, '2020_06_24_201413_create_terms_table', 5),
(8, '2020_06_24_202244_create_sequences_table', 5),
(9, '2014_10_12_100000_create_password_resets_table', 6),
(10, '2020_06_26_005616_create_teachers_table', 6),
(11, '2020_06_26_152659_create_students_table', 6),
(12, '2020_06_26_155500_create_admins_table', 6),
(13, '2020_06_28_111118_create_roles_table', 7),
(19, '2020_06_28_113228_create_admin_roles_table', 9),
(23, '2020_06_28_130532_create_permissions_table', 10),
(24, '2020_06_28_132143_create_permission_roles_table', 10),
(25, '2020_07_02_102028_create_admin_permissions_table', 11),
(26, '2020_07_04_185418_create_sectors_table', 12),
(27, '2020_07_04_185824_create_backgrounds_table', 12),
(29, '2020_07_05_161657_create_languages_table', 13),
(30, '2020_07_06_160317_create_forms_table', 14),
(31, '2020_07_07_021444_create_subclasses_table', 15),
(32, '2020_07_07_212527_create_studentinfos_table', 16),
(33, '2020_07_09_231627_create_subjects_table', 17),
(35, '2020_07_24_050369_create_subject_teacher_table', 18),
(36, '2020_07_24_160949_create_disciplines_table', 19),
(42, '2020_07_25_001300_create_studentdisciplines_table', 20),
(43, '2020_07_26_210114_create_feetypes_table', 20),
(47, '2020_07_30_210221_create_expensetypes_table', 21),
(49, '2020_07_31_134444_create_scholarships_table', 23),
(50, '2020_08_06_210257_create_fees_table', 24),
(51, '2020_08_10_135601_create_feecontrols_table', 25),
(55, '2020_08_17_003856_create_generateresults_table', 29),
(56, '2020_08_17_010447_create_secondtermresults_table', 30),
(57, '2020_08_17_031822_create_thirdtermresults_table', 30),
(58, '2020_08_17_121006_create_firsttermresults_table', 30),
(59, '2020_08_22_182327_create_studentresults_table', 31),
(60, '2020_08_30_020338_create_classresults_table', 32),
(61, '2020_09_14_091918_create_expenses_table', 33),
(62, '2020_10_30_210446_create_resultcontrols_table', 34),
(63, '2020_11_02_224142_create_files_table', 35),
(65, '2020_11_04_215614_create_promotions_table', 36),
(70, '2020_11_12_235619_create_assignments_table', 37);

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `parent`, `name`, `name_slug`, `created_at`, `updated_at`) VALUES
(1, 'fees_expenses', 'can create income', 'create_income', '2020-06-28 14:51:25', '2020-06-28 14:51:25'),
(2, 'fees_expenses', 'can create expenses', 'create_expenses', '2020-06-28 14:51:25', '2020-06-28 14:51:25'),
(3, 'fees_expenses', 'can receive fee', 'receive_fees', '2020-06-28 14:51:25', '2020-06-28 14:51:25'),
(4, 'fees_expenses', 'can record expenses', 'record_expense', '2020-06-28 14:51:25', '2020-06-28 14:51:25'),
(5, 'fees_expenses', 'can report fees', 'report_fees', '2020-06-28 14:51:25', '2020-06-28 14:51:25'),
(6, 'fees_expenses', 'can give scholarhip', 'give_scholarship', '2020-06-28 14:51:25', '2020-06-28 14:51:25'),
(7, 'fees_expenses', 'can report Scholarship', 'scholarship_report', '2020-06-28 14:51:25', '2020-06-28 14:51:25'),
(8, 'fees_expenses', 'can see income stement', 'income_statement', '2020-06-28 14:51:25', '2020-06-28 14:51:25'),
(9, 'fees_expenses', 'can print receipt', 'print_reciept', '2020-06-28 14:51:25', '2020-06-28 14:51:25'),
(10, 'classes', 'can create class', 'create_class', '2020-06-28 14:51:25', '2020-06-28 14:51:25'),
(11, 'classes', 'can create Edit/Delete class', 'edit_delete_class', '2020-06-28 14:51:26', '2020-06-28 14:51:26'),
(12, 'classes', 'can create sub-class', 'sub_class', '2020-06-28 14:51:26', '2020-06-28 14:51:26'),
(13, 'classes', 'can see sub-class', 'see_class', '2020-06-28 14:51:26', '2020-06-28 14:51:26'),
(14, 'sector_background', 'can create sector', 'create_sector', '2020-06-28 14:51:26', '2020-06-28 14:51:26'),
(15, 'sector_background', 'can create background', 'create_backgorund', '2020-06-28 14:51:26', '2020-06-28 14:51:26'),
(16, 'sector_background', 'can see all sector', 'see_sector', '2020-06-28 14:51:26', '2020-06-28 14:51:26'),
(17, 'sector_background', 'can see all background', 'see_background', '2020-06-28 14:51:26', '2020-06-28 14:51:26'),
(18, 'students', 'can add students', 'add_student', '2020-06-28 14:51:26', '2020-06-28 14:51:26'),
(19, 'students', 'can see class list', 'class_list', '2020-06-28 14:51:26', '2020-06-28 14:51:26'),
(21, 'students', 'can promote student', 'promote_student', '2020-06-28 14:51:26', '2020-06-28 14:51:26'),
(22, 'students', 'can change student class', 'change_class', '2020-06-28 14:51:26', '2020-06-28 14:51:26'),
(23, 'subjects', 'can create subjects', 'create_subject', '2020-06-28 14:51:26', '2020-06-28 14:51:26'),
(24, 'subjects', 'can see all subjects', 'all_subject', '2020-06-28 14:51:26', '2020-06-28 14:51:26'),
(25, 'teachers', 'can add teacher', 'add_teacher', '2020-06-28 14:51:27', '2020-06-28 14:51:27'),
(26, 'teachers', 'can assign subject', 'assign_subjects', '2020-06-28 14:51:27', '2020-06-28 14:51:27'),
(27, 'teachers', 'can see all teachers/subjects', 'teacher_subjects', '2020-06-28 14:51:27', '2020-06-28 14:51:27'),
(28, 'discipline', 'can add type of discipline', 'add_type', '2020-06-28 14:51:27', '2020-06-28 14:51:27'),
(29, 'discipline', 'can record student discipline', 'record_student', '2020-06-28 14:51:27', '2020-06-28 14:51:27'),
(30, 'discipline', 'can view all discipne statistics', 'view_record_student', '2020-06-28 14:51:27', '2020-06-28 14:51:27'),
(31, 'result', 'can record mark', 'record_mark', '2020-06-28 14:51:27', '2020-06-28 14:51:27'),
(32, 'result', 'can rank student', 'rank_student', '2020-06-28 14:51:27', '2020-06-28 14:51:27'),
(33, 'result', 'can print result', 'print_result', '2020-06-28 14:51:27', '2020-06-28 14:51:27'),
(34, 'result', 'can print rank sheet', 'print_rank', '2020-06-28 14:51:27', '2020-06-28 14:51:27'),
(35, 'result', 'can print fee controlled form', 'print_fee', '2020-06-28 14:51:27', '2020-06-28 14:51:27'),
(36, 'roles', 'can add role', 'add_role', '2020-06-28 14:51:27', '2020-06-28 14:51:27'),
(37, 'roles', 'can edit roles', 'add_user', '2020-06-28 14:51:27', '2020-06-28 14:51:27'),
(38, 'roles', 'can see users role', 'user_role', '2020-06-28 14:51:27', '2020-06-28 14:51:27'),
(39, 'tranfer_result', 'can send result online', 'send_result', '2020-06-28 14:51:28', '2020-06-28 14:51:28'),
(40, 'setting', 'can modify school theme', 'school_theme', '2020-06-28 14:51:28', '2020-06-28 14:51:28'),
(41, 'setting', 'can modify school profile', 'school_profile', '2020-06-28 14:51:28', '2020-06-28 14:51:28');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED DEFAULT NULL,
  `role_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`, `created_at`, `updated_at`) VALUES
(116, 1, 4, NULL, NULL),
(117, 2, 4, NULL, NULL),
(118, 3, 4, NULL, NULL),
(119, 10, 4, NULL, NULL),
(120, 11, 4, NULL, NULL),
(121, 12, 4, NULL, NULL),
(122, 13, 4, NULL, NULL),
(123, 14, 4, NULL, NULL),
(124, 15, 4, NULL, NULL),
(125, 16, 4, NULL, NULL),
(126, 17, 4, NULL, NULL),
(129, 23, 4, NULL, NULL),
(158, 36, 2, NULL, NULL),
(159, 37, 2, NULL, NULL),
(160, 18, 2, NULL, NULL),
(161, 19, 2, NULL, NULL),
(162, 21, 2, NULL, NULL),
(163, 25, 2, NULL, NULL),
(164, 26, 2, NULL, NULL),
(165, 27, 2, NULL, NULL),
(166, 23, 2, NULL, NULL),
(167, 24, 2, NULL, NULL),
(168, 31, 2, NULL, NULL),
(169, 32, 2, NULL, NULL),
(170, 33, 2, NULL, NULL),
(171, 40, 2, NULL, NULL),
(172, 41, 2, NULL, NULL),
(173, 39, 2, NULL, NULL),
(174, 1, 12, NULL, NULL),
(175, 2, 12, NULL, NULL),
(176, 3, 12, NULL, NULL),
(177, 4, 12, NULL, NULL),
(178, 5, 12, NULL, NULL),
(179, 13, 12, NULL, NULL),
(180, 36, 12, NULL, NULL),
(181, 27, 12, NULL, NULL),
(182, 24, 12, NULL, NULL),
(183, 30, 12, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `id` int(10) UNSIGNED NOT NULL,
  `year_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `form_id` int(10) UNSIGNED NOT NULL,
  `form_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `promotions`
--

INSERT INTO `promotions` (`id`, `year_id`, `student_id`, `form_id`, `form_type`, `remark`, `created_at`, `updated_at`) VALUES
(1, 1, 50, 31, 'A', 'New', '2020-11-04 21:39:58', '2020-11-04 21:39:58'),
(2, 1, 51, 11, 'B', 'New', '2020-11-04 21:42:52', '2020-11-04 21:42:52'),
(3, 1, 42, 11, 'A', 'new', NULL, NULL),
(4, 1, 43, 11, 'B', 'new', NULL, NULL),
(5, 1, 44, 11, 'A', 'new', NULL, NULL),
(6, 1, 45, 11, 'B', 'new', NULL, NULL),
(7, 1, 46, 11, 'A', 'new', NULL, NULL),
(8, 1, 47, 11, 'A', 'new', NULL, NULL),
(9, 1, 48, 11, 'B', 'new', NULL, NULL),
(10, 1, 49, 11, 'B', 'new', NULL, NULL),
(11, 1, 52, 9, 'A', 'New', '2020-11-22 20:21:24', '2020-11-22 20:21:24'),
(12, 1, 53, 9, 'A', 'New', '2020-11-22 20:22:17', '2020-11-22 20:22:17'),
(13, 1, 54, 9, 'A', 'New', '2020-11-22 20:23:31', '2020-11-22 20:23:31');

-- --------------------------------------------------------

--
-- Table structure for table `resultcontrols`
--

CREATE TABLE `resultcontrols` (
  `id` int(10) UNSIGNED NOT NULL,
  `year_id` int(10) UNSIGNED DEFAULT NULL,
  `term_id` int(10) UNSIGNED DEFAULT NULL,
  `seq1_id` int(10) UNSIGNED DEFAULT NULL,
  `seq2_id` int(10) UNSIGNED DEFAULT NULL,
  `generateresult_id` int(10) UNSIGNED DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `resultcontrols`
--

INSERT INTO `resultcontrols` (`id`, `year_id`, `term_id`, `seq1_id`, `seq2_id`, `generateresult_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 2, NULL, NULL, '2020-11-14 13:58:51', '2020-11-22 18:31:12');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'Bimeri', '2020-06-30 13:10:16', '2020-06-30 13:10:16'),
(4, 'Director', '2020-06-30 13:52:44', '2020-06-30 13:52:44'),
(11, 'nobody', '2020-07-03 12:22:54', '2020-07-03 12:22:54'),
(12, 'Principal', '2020-07-05 18:07:39', '2020-07-05 18:07:39');

-- --------------------------------------------------------

--
-- Table structure for table `scholarships`
--

CREATE TABLE `scholarships` (
  `id` int(10) UNSIGNED NOT NULL,
  `year_id` int(10) UNSIGNED NOT NULL,
  `term_id` int(10) UNSIGNED NOT NULL,
  `form_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `amount` bigint(20) NOT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `scholarships`
--

INSERT INTO `scholarships` (`id`, `year_id`, `term_id`, `form_id`, `student_id`, `amount`, `reason`, `created_at`, `updated_at`) VALUES
(8, 1, 1, 11, 42, 2000, 'best student', '2021-02-08 16:50:52', '2021-02-08 16:50:52'),
(13, 1, 1, 11, 45, 7000, 'i am very good boy', '2021-02-08 23:15:40', '2021-02-08 23:15:40'),
(14, 1, 1, 9, 54, 2000, 'good student', '2021-02-10 10:01:11', '2021-02-10 10:01:11');

-- --------------------------------------------------------

--
-- Table structure for table `secondtermresults`
--

CREATE TABLE `secondtermresults` (
  `id` int(10) UNSIGNED NOT NULL,
  `year_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `form_id` int(10) UNSIGNED NOT NULL,
  `form_type` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` int(10) UNSIGNED NOT NULL,
  `seq3` decimal(6,2) DEFAULT NULL,
  `seq4` decimal(6,2) DEFAULT NULL,
  `ave_point` decimal(6,2) DEFAULT NULL,
  `position` int(10) UNSIGNED DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `secondtermresults`
--

INSERT INTO `secondtermresults` (`id`, `year_id`, `student_id`, `form_id`, `form_type`, `subject_id`, `seq3`, `seq4`, `ave_point`, `position`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 42, 11, 'A', 18, '19.00', '20.00', '78.00', NULL, 1, '2020-11-24 18:32:40', '2020-11-24 18:32:46'),
(2, 1, 42, 11, 'A', 19, '17.00', '19.00', '54.00', NULL, 1, '2020-11-24 18:32:50', '2020-11-24 18:32:52'),
(3, 1, 42, 11, 'A', 21, '19.00', '17.00', '36.00', NULL, 1, '2020-11-24 18:33:35', '2020-11-24 18:34:05'),
(4, 1, 42, 11, 'A', 20, '18.00', '20.00', '38.00', NULL, 1, '2020-11-24 18:33:57', '2020-11-24 18:34:02'),
(5, 1, 44, 11, 'A', 18, '12.00', '15.00', '54.00', NULL, 1, '2020-11-24 18:34:08', '2020-11-24 18:34:10'),
(6, 1, 46, 11, 'A', 19, '9.00', '12.00', '31.50', NULL, 1, '2020-11-24 18:34:13', '2020-11-24 18:34:15'),
(7, 1, 44, 11, 'A', 19, '10.00', '13.50', '35.25', NULL, 1, '2020-11-24 18:34:19', '2020-11-24 18:35:13'),
(8, 1, 43, 11, 'B', 19, '14.00', '16.50', '45.75', NULL, 1, '2020-11-24 18:34:24', '2020-11-24 18:34:26'),
(9, 1, 43, 11, 'B', 18, '13.00', '6.00', '38.00', NULL, 1, '2020-11-24 18:34:31', '2020-11-24 18:36:36'),
(10, 1, 46, 11, 'A', 18, '16.00', '14.00', '60.00', NULL, 1, '2020-11-24 18:34:40', '2020-11-24 18:35:09'),
(11, 1, 46, 11, 'A', 20, '20.00', '17.00', '37.00', NULL, 1, '2020-11-24 18:34:46', '2020-11-24 18:34:51'),
(12, 1, 46, 11, 'A', 21, '16.00', '15.00', '31.00', NULL, 1, '2020-11-24 18:34:54', '2020-11-24 18:34:57'),
(13, 1, 44, 11, 'A', 20, '12.00', '9.00', '21.00', NULL, 1, '2020-11-24 18:35:03', '2020-11-24 18:35:16'),
(14, 1, 44, 11, 'A', 21, '8.50', '6.30', '14.80', NULL, 1, '2020-11-24 18:35:19', '2020-11-24 18:35:23'),
(15, 1, 43, 11, 'B', 21, '6.00', '12.20', '18.20', NULL, 1, '2020-11-24 18:35:27', '2020-11-24 18:35:50'),
(16, 1, 45, 11, 'B', 21, '7.00', '9.80', '16.80', NULL, 1, '2020-11-24 18:35:34', '2020-11-24 18:35:48'),
(17, 1, 48, 11, 'B', 21, '14.00', '11.00', '25.00', NULL, 1, '2020-11-24 18:35:36', '2020-11-24 18:35:53'),
(18, 1, 51, 11, 'B', 21, '14.00', '7.00', '21.00', NULL, 1, '2020-11-24 18:35:38', '2020-11-24 18:35:41'),
(19, 1, 45, 11, 'B', 20, '3.00', '12.00', '15.00', NULL, 1, '2020-11-24 18:35:43', '2020-11-24 18:36:02'),
(20, 1, 48, 11, 'B', 20, '7.00', '12.00', '19.00', NULL, 1, '2020-11-24 18:35:45', '2020-11-24 18:36:04'),
(21, 1, 51, 11, 'B', 20, '11.00', '2.00', '13.00', NULL, 1, '2020-11-24 18:35:55', '2020-11-24 18:36:06'),
(22, 1, 43, 11, 'B', 20, '0.00', '1.00', '1.00', NULL, 1, '2020-11-24 18:35:57', '2020-11-24 18:35:58'),
(23, 1, 45, 11, 'B', 19, '19.00', '18.00', '55.50', NULL, 1, '2020-11-24 18:36:08', '2020-11-24 18:36:18'),
(24, 1, 48, 11, 'B', 19, '9.00', '14.00', '34.50', NULL, 1, '2020-11-24 18:36:21', '2020-11-24 18:36:33'),
(25, 1, 51, 11, 'B', 19, '12.00', '1.00', '19.50', NULL, 1, '2020-11-24 18:36:25', '2020-11-24 18:36:28'),
(26, 1, 45, 11, 'B', 18, '9.50', '12.50', '44.00', NULL, 1, '2020-11-24 18:36:43', '2020-11-24 18:36:55'),
(27, 1, 51, 11, 'B', 18, '11.00', '10.50', '43.00', NULL, 1, '2020-11-24 18:36:49', '2020-11-24 18:37:04'),
(28, 1, 48, 11, 'B', 18, '14.50', '8.50', '46.00', NULL, 1, '2020-11-24 18:36:52', '2020-11-24 18:36:59');

-- --------------------------------------------------------

--
-- Table structure for table `sectors`
--

CREATE TABLE `sectors` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sectors`
--

INSERT INTO `sectors` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'English Sector', 'All English student from these section.', '2020-07-05 02:30:23', '2020-07-05 02:30:23'),
(4, 'Commercial Sector', 'All commercial Student from form one to uppersixth', '2020-07-05 22:47:06', '2020-07-05 22:47:06'),
(5, 'French Sector', 'all lower-sixth and upper-sixth students', '2020-07-05 22:47:50', '2020-07-05 22:47:50'),
(6, 'Second Cycle', 'Second Cycle', '2020-10-24 20:05:22', '2020-10-24 20:05:22');

-- --------------------------------------------------------

--
-- Table structure for table `sequences`
--

CREATE TABLE `sequences` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `term_id` int(10) UNSIGNED NOT NULL,
  `active` tinyint(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sequences`
--

INSERT INTO `sequences` (`id`, `name`, `term_id`, `active`, `created_at`, `updated_at`) VALUES
(1, 'First Sequence', 1, 1, '2020-07-04 02:08:57', '2020-07-04 02:08:57'),
(2, 'Second Sequence', 1, 0, '2020-07-04 18:36:45', '2020-07-04 18:36:45'),
(3, 'Third Sequence', 2, 0, '2020-11-07 21:05:55', '2020-11-07 21:05:55'),
(4, 'Fourth Sequence', 2, 0, '2020-11-07 21:06:07', '2020-11-07 21:06:07'),
(6, 'Firth Sequence', 3, 0, '2020-11-07 21:09:56', '2020-11-07 21:09:56'),
(7, 'Sixth Sequence', 3, 0, '2020-11-07 21:10:17', '2020-11-07 21:10:17');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `year_id` int(10) UNSIGNED DEFAULT NULL,
  `school_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `school_id` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `motto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `test_session` int(11) DEFAULT NULL,
  `exam_session` int(11) DEFAULT NULL,
  `start_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `break_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stop_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hours_per_period` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `year_id`, `school_name`, `school_id`, `motto`, `logo`, `test_session`, `exam_session`, `start_time`, `break_time`, `stop_time`, `hours_per_period`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bilingual Grammar School Molyko', 'BG', 'Knowledge with Wisdom', 'logo.png', 0, 0, '07:30 AM', '12:00 PM', '04:30 PM', '2 hrs', '2020-06-24 20:28:34', '2020-06-24 20:28:34');

-- --------------------------------------------------------

--
-- Table structure for table `studentdisciplines`
--

CREATE TABLE `studentdisciplines` (
  `id` int(10) UNSIGNED NOT NULL,
  `year_id` int(10) UNSIGNED NOT NULL,
  `term_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `discipline_id` int(10) UNSIGNED NOT NULL,
  `consequences` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `studentinfos`
--

CREATE TABLE `studentinfos` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED DEFAULT NULL,
  `student_school_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year_id` int(10) UNSIGNED DEFAULT NULL,
  `form_id` int(10) UNSIGNED NOT NULL,
  `subform_id` int(10) UNSIGNED DEFAULT NULL,
  `parent_contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'default.png',
  `date_of_birth` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `studentinfos`
--

INSERT INTO `studentinfos` (`id`, `student_id`, `student_school_id`, `year_id`, `form_id`, `subform_id`, `parent_contact`, `parent_email`, `address`, `profile`, `date_of_birth`, `gender`, `created_at`, `updated_at`) VALUES
(1, 42, 'BG19A001', 1, 11, NULL, '123456789', NULL, NULL, 'default.png', '2020-10-21', 'Male', '2020-10-24 20:22:58', '2020-10-24 20:22:58'),
(2, 43, 'BG19A002', 1, 11, 9, '678657959', 'example@gmail.com', 'lonstreet', 'BG19A002.jpg', '2020-10-15', 'Female', '2020-10-26 20:59:57', '2021-02-08 02:55:31'),
(3, 44, 'BG19A003', 1, 11, NULL, '678657952', 'efange@gmail.com', 'new town akwa', 'BG19A003.jpg', '1995-07-20', 'Male', '2020-10-30 06:52:31', '2020-10-30 06:52:31'),
(4, 45, 'BG19A004', 1, 11, 9, '123456789', 'fombu@gmail.com', 'tole', 'BG19A004.jpg', '2020-07-15', 'Male', '2020-10-30 19:59:41', '2020-10-30 19:59:41'),
(5, 46, 'BG19A005', 1, 11, NULL, '435678769', 'bimerinoel@gmail.com', 'molyko', 'default.png', '2020-10-07', 'Female', '2020-10-30 20:27:44', '2020-10-30 20:27:44'),
(6, 47, 'BG19A006', 1, 31, NULL, '234345676', 'lim@xxx.com', 'limbe', 'BG19A006.jpg', '2020-10-02', 'Male', '2020-10-31 20:10:03', '2020-10-31 20:10:03'),
(7, 48, 'BG19A007', 1, 11, 9, '567898987', 'etim@gmail.com', 'Muyuka Motto Park', 'default.png', '2020-10-02', 'Female', '2020-11-01 19:44:32', '2020-11-01 19:44:32'),
(8, 49, 'BG19A008', 1, 31, NULL, '67567879', 'admitted@gmail.com', 'wonganga', 'BG19A008.jpg', '2020-10-07', 'Male', '2020-11-04 21:32:14', '2020-11-04 21:32:14'),
(9, 50, 'BG19A009', 1, 31, NULL, '675467890', NULL, 'longstreet', 'default.png', NULL, 'Male', '2020-11-04 21:39:58', '2020-11-04 21:39:58'),
(10, 51, 'BG19A010', 1, 11, 9, '546789765', 'exab@gmai.com', 'molyko', 'BG19A010.jpeg', '2020-07-09', 'Male', '2020-11-04 21:42:52', '2020-11-04 21:42:52'),
(11, 52, 'BG19A011', 1, 9, NULL, '654678978', 'enamgs@gmail.com', 'small soppo buea cameroon', 'BG19A011.jpg', '2020-11-19', 'Female', '2020-11-22 20:21:23', '2020-11-22 20:21:23'),
(12, 53, 'BG19A012', 1, 9, NULL, '678980987', NULL, NULL, 'default.png', '2020-11-06', 'Male', '2020-11-22 20:22:17', '2020-11-22 20:22:17'),
(13, 54, 'BG19A013', 1, 9, NULL, NULL, NULL, NULL, 'BG19A013.jpg', '2020-10-01', 'Male', '2020-11-22 20:23:31', '2020-11-22 20:23:31');

-- --------------------------------------------------------

--
-- Table structure for table `studentresults`
--

CREATE TABLE `studentresults` (
  `id` int(10) UNSIGNED NOT NULL,
  `year_id` int(10) UNSIGNED NOT NULL,
  `term_id` int(10) UNSIGNED NOT NULL,
  `form_id` int(10) UNSIGNED NOT NULL,
  `form_type` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `student_school_id` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `average_point` decimal(6,2) DEFAULT NULL,
  `sum_coff` decimal(6,2) DEFAULT NULL,
  `stud_ave` decimal(6,2) DEFAULT NULL,
  `position` int(5) DEFAULT NULL,
  `class_position` int(5) DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `studentresults`
--

INSERT INTO `studentresults` (`id`, `year_id`, `term_id`, `form_id`, `form_type`, `student_id`, `student_school_id`, `average_point`, `sum_coff`, `stud_ave`, `position`, `class_position`, `remark`, `created_at`, `updated_at`) VALUES
(18, 1, 1, 11, 'A', 42, 'BG19A001', '166.65', '11.00', '15.15', 1, 1, NULL, '2020-11-23 12:27:32', '2020-11-23 13:19:37'),
(19, 1, 1, 11, 'B', 43, 'BG19A002', '136.05', '11.00', '12.37', 3, 2, NULL, '2020-11-23 12:27:32', '2020-11-23 13:19:38'),
(20, 1, 1, 11, 'A', 44, 'BG19A003', '115.00', '11.00', '10.45', 4, 2, NULL, '2020-11-23 12:27:33', '2020-11-23 13:19:37'),
(21, 1, 1, 11, 'B', 45, 'BG19A004', '109.50', '11.00', '9.95', 5, 3, NULL, '2020-11-23 12:27:34', '2020-11-23 13:19:38'),
(22, 1, 1, 11, 'A', 46, 'BG19A005', '88.85', '11.00', '8.08', 6, 3, NULL, '2020-11-23 12:27:34', '2020-11-23 13:19:37'),
(23, 1, 1, 11, 'B', 48, 'BG19A007', '72.00', '11.00', '6.55', 7, 4, NULL, '2020-11-23 12:27:34', '2020-11-23 13:19:38'),
(24, 1, 1, 11, 'B', 51, 'BG19A010', '155.00', '11.00', '14.09', 2, 1, NULL, '2020-11-23 12:27:34', '2020-11-23 13:19:37'),
(25, 1, 1, 9, 'A', 52, 'BG19A011', '139.00', '11.00', '12.64', 1, 1, NULL, '2020-11-23 17:26:53', '2020-11-23 17:27:42'),
(26, 1, 1, 9, 'A', 53, 'BG19A012', '86.25', '11.00', '7.84', 3, 3, NULL, '2020-11-23 17:26:54', '2020-11-23 17:27:42'),
(27, 1, 1, 9, 'A', 54, 'BG19A013', '110.00', '11.00', '10.00', 2, 2, NULL, '2020-11-23 17:26:55', '2020-11-23 17:27:42'),
(42, 1, 2, 11, 'A', 42, 'BG19A001', '206.00', '11.00', '18.73', 1, 1, NULL, '2020-11-24 21:07:56', '2020-11-24 21:11:39'),
(43, 1, 2, 11, 'B', 43, 'BG19A002', '102.95', '11.00', '9.36', 6, 3, NULL, '2020-11-24 21:07:56', '2020-11-24 21:11:40'),
(44, 1, 2, 11, 'A', 44, 'BG19A003', '125.05', '11.00', '11.37', 4, 3, NULL, '2020-11-24 21:07:56', '2020-11-24 21:11:39'),
(45, 1, 2, 11, 'B', 45, 'BG19A004', '131.30', '11.00', '11.94', 3, 1, NULL, '2020-11-24 21:07:56', '2020-11-24 21:11:40'),
(46, 1, 2, 11, 'A', 46, 'BG19A005', '159.50', '11.00', '14.50', 2, 2, NULL, '2020-11-24 21:07:56', '2020-11-24 21:11:39'),
(47, 1, 2, 11, 'B', 48, 'BG19A007', '124.50', '11.00', '11.32', 5, 2, NULL, '2020-11-24 21:07:56', '2020-11-24 21:11:40'),
(48, 1, 2, 11, 'B', 51, 'BG19A010', '96.50', '11.00', '8.77', 7, 4, NULL, '2020-11-24 21:07:56', '2020-11-24 21:11:40');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `place_of_birth` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'place_of_birth',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_enrolled` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `suspend` tinyint(1) NOT NULL DEFAULT 0,
  `dismissed` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `full_name`, `school_id`, `email`, `place_of_birth`, `password`, `date_enrolled`, `suspend`, `dismissed`, `remember_token`, `created_at`, `updated_at`) VALUES
(42, 'Bimeri Noel', 'BG19A001', 'bimerinoel@gmail.com', 'buea Hospital', '$2y$10$xkuLk/X2.W24rXdx9yPzO.SczBbVWhyc/vxNZU1cfL8N4z/Qx7e..', 'Sat, 24 Oct 2020 21:22pm', 1, 0, NULL, '2020-10-24 20:22:58', '2020-10-24 20:22:58'),
(43, 'Mari Saquare', 'BG19A002', 'example@gmail.com', 'buea Hospital', '$2y$10$81YsV93qy8BrkCc5vC9DrOHdiNcip3M44QD/fpMZPjtxzd4ZKgJLi', 'Mon, 26 Oct 2020 21:59pm', 0, 1, NULL, '2020-10-26 20:59:57', '2021-02-10 21:09:35'),
(44, 'Lydia Efange', 'BG19A003', 'lydia@gmail.com', 'buea Hospital', '$2y$10$UpJAP.IpAvep2orWzqESDO0VO9ZZ6PUr/nsBOGQu1X0LMcN/ObMqu', 'Fri, 30 Oct 2020 07:52am', 0, 0, NULL, '2020-10-30 06:52:31', '2020-10-30 06:52:31'),
(45, 'example three', 'BG19A004', 'exam@fgmail.com', 'buea Hospital', '$2y$10$vXCiR2iY69UXC8D6/lkY2u9eDbLAhRRPDteHf4i1/dgCkinwVbS2u', 'Fri, 30 Oct 2020 20:59pm', 0, 0, NULL, '2020-10-30 19:59:41', '2021-02-08 01:12:45'),
(46, 'Enow Florence', 'BG19A005', 'wang@fgmail.com', 'buea Hospital', '$2y$10$BaRnL9h/U4stNRwbbXVak.6ER3h0hpRq1yXSJTHz4oGGD.7pyc9Pm', 'Fri, 30 Oct 2020 21:27pm', 0, 0, NULL, '2020-10-30 20:27:44', '2020-10-30 20:27:44'),
(47, 'Eugine xyz', 'BG19A006', 'eu@gmail.com', 'buea Hospital', '$2y$10$ywcqEo5L/kOw6T5HgQK55uZ72y1qVcHysoOfgeeujoyS4dnZ5i8Ae', 'Sat, 31 Oct 2020 21:10pm', 0, 0, NULL, '2020-10-31 20:10:02', '2020-10-31 20:10:02'),
(48, 'Etima Joshua', 'BG19A007', 'uek@gmail.com', 'buea Hospital', '$2y$10$jfIdR5MPPL5hkMZi83S33ufpRV0N8ZcUSLFkfr32QsEuZYbROLj6W', 'Sun, 01 Nov 2020 20:44pm', 0, 0, NULL, '2020-11-01 19:44:31', '2021-02-08 00:52:07'),
(49, 'Newly Admitted', 'BG19A008', 'new@gmail.com', 'buea Hospital', '$2y$10$7M/Bb/lPs.1kL3uOyMGKiumMreNpqSMygW8nNVkTtyseAWb.d3MVy', 'Wed, 04 Nov 2020 22:32pm', 0, 0, NULL, '2020-11-04 21:32:14', '2020-11-04 21:32:14'),
(50, 'Emile Magaza', 'BG19A009', 'email@gmail.com', 'buea Hospital', '$2y$10$hAbxWbnR8UNIesaSoulff.lZ8FfUiAsv8rzRScy2uNPJBLqHUMBRm', 'Wed, 04 Nov 2020 22:39pm', 0, 0, NULL, '2020-11-04 21:39:57', '2020-11-04 21:39:57'),
(51, 'Last Test', 'BG19A010', 'testlast@gmail.com', 'buea Hospital', '$2y$10$Wuoyw32EJnQNEIgvJBbJZuvhGi5bNhVQ.0Js6xvnxXejegYlNI3E2', 'Wed, 04 Nov 2020 22:42pm', 0, 0, NULL, '2020-11-04 21:42:52', '2021-02-08 01:13:11'),
(52, 'enanga Rolse', 'BG19A011', 'enags@gmail.com', 'buea Hospital', '$2y$10$p/JGI2SDHADu6Slinzu4U.98ZuLgs30aF/WxMR1EZnj/fAVgohVd2', 'Sun, 22 Nov 2020 21:21pm', 0, 0, NULL, '2020-11-22 20:21:23', '2020-11-22 20:21:23'),
(53, 'Joel Motombi', 'BG19A012', NULL, 'buea Hospital', '$2y$10$Smc1FN4eIPMoutgG33kenuZAdRlsRh8kHJoTv4GuqIZYBj7J9IbeS', 'Sun, 22 Nov 2020 21:22pm', 0, 0, NULL, '2020-11-22 20:22:17', '2020-11-22 20:22:17'),
(54, 'lucien Moyal', 'BG19A013', NULL, 'buea Hospital', '$2y$10$Ktky4wwneEAiJy.YNxo4o.QsDzrw3B5ny9gd3WGbnR977uZS3eNQS', 'Sun, 22 Nov 2020 21:23pm', 0, 0, NULL, '2020-11-22 20:23:30', '2020-11-22 20:23:30');

-- --------------------------------------------------------

--
-- Table structure for table `subclasses`
--

CREATE TABLE `subclasses` (
  `id` int(10) UNSIGNED NOT NULL,
  `form_id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_number` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subclasses`
--

INSERT INTO `subclasses` (`id`, `form_id`, `type`, `max_number`, `created_at`, `updated_at`) VALUES
(9, 11, 'B', 20, '2020-10-26 19:46:22', '2020-10-26 19:46:22'),
(10, 31, 'B', 20, '2020-11-14 08:06:07', '2020-11-14 08:06:07');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `form_id` int(10) UNSIGNED NOT NULL,
  `coefficient` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `code`, `form_id`, `coefficient`, `created_at`, `updated_at`) VALUES
(17, 'English', 'ENG', 12, 3, '2020-10-26 19:58:47', '2020-10-26 19:58:47'),
(18, 'Business Mathematics', 'BMS', 11, 4, '2020-10-27 21:55:33', '2020-10-27 21:55:33'),
(19, 'French', 'FR1', 11, 3, '2020-10-27 21:57:51', '2020-10-27 21:57:51'),
(20, 'Chemistry', 'CHM101', 11, 2, '2020-10-30 20:29:19', '2020-10-30 20:29:19'),
(21, 'Economics', 'ECO', 11, 2, '2020-11-01 19:45:46', '2020-11-01 19:45:46'),
(22, 'Mathematics', 'mat01', 9, 4, '2020-11-22 20:25:02', '2020-11-22 20:25:02'),
(23, 'English', 'eng1', 9, 4, '2020-11-22 20:25:25', '2020-11-22 20:25:25'),
(26, 'French', 'fre1', 9, 3, '2020-11-22 20:36:29', '2020-11-22 20:36:29'),
(28, 'English Literature', '', 11, 4, '2021-02-01 08:56:33', '2021-02-01 08:56:33');

-- --------------------------------------------------------

--
-- Table structure for table `subject_teacher`
--

CREATE TABLE `subject_teacher` (
  `id` int(10) UNSIGNED NOT NULL,
  `subject_id` int(10) UNSIGNED NOT NULL,
  `teacher_id` int(10) UNSIGNED NOT NULL,
  `year_id` int(10) UNSIGNED DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subject_teacher`
--

INSERT INTO `subject_teacher` (`id`, `subject_id`, `teacher_id`, `year_id`, `status`, `created_at`, `updated_at`) VALUES
(16, 17, 3, 1, 0, NULL, NULL),
(17, 18, 3, 1, 0, NULL, NULL),
(18, 19, 3, 1, 0, NULL, NULL),
(20, 28, 1, 1, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'default.png',
  `date_of_birth` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `suspend` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `full_name`, `user_name`, `profile`, `date_of_birth`, `gender`, `email`, `password`, `suspend`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'John Calvine', 'paul', 'default.png', '2014-11-12', 'Male', 'paul@gmail.com', '$2y$10$AkEnPO60.B4QCm20u5.A1uAS8QWIpcHReIxRVyDN319/4VmIC24fm', 0, NULL, '2020-06-26 22:44:54', '2021-02-01 20:01:16'),
(2, 'Lucien Magaza', 'lucien', 'lucien.jpg', '5555-02-05', 'Male', 'lucien@gmail.com', '$2y$10$ET2HJ4wUtBsK0YQXY2ty3uuMSlB1dHGqdjIujwDeVuydq7nIkMEq2', 0, NULL, '2020-07-16 22:53:07', '2020-07-16 22:53:07'),
(3, 'Claris Busi', 'Busi', 'Busi.jpg', '2002-02-23', 'Female', 'busi@gmail.com', '$2y$10$aNRSB8RgIZNXph1HN9HMtuOUGwfKszNsKUlAU/5aV6CuDUrsbG6rG', 0, NULL, '2020-07-17 01:04:40', '2021-02-01 20:01:02'),
(4, 'Muyal Magaza', 'Muyal', 'Muyal.jpg', '2003-12-13', 'Male', 'muyal@gmail.com', '$2y$10$G73FUJPmJ40zr0AaUwm4OuXhPh5tuDsx9SDtC6mq2YRrq2RB/wR/i', 0, NULL, '2020-07-17 01:06:18', '2020-07-17 01:06:18'),
(5, 'Tawa Peggy', 'peggy', 'peggy.jpg', '2000-02-22', 'Female', 'tawa@peggy.com', '$2y$10$WgBow6KdY4Ye/DEplrJF4uYelGaCs7iFSS1ddy3kUNn2yTOC.b1Xu', 0, NULL, '2020-08-01 18:16:11', '2020-08-01 18:16:11'),
(6, 'noelino', 'noel', 'noel.jpg', '2020-10-01', 'Male', 'noel@email.com', '$2y$10$y0pFtxYbBylK1QHZ3A658.GHsbffBpRgCW2zIel7ZDZoZgmQ67/z6', 0, NULL, '2020-10-03 17:42:54', '2020-10-03 17:42:54');

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE `terms` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`id`, `name`, `active`, `created_at`, `updated_at`) VALUES
(1, 'First Term', 1, '2020-06-24 20:10:29', '2020-06-24 20:10:29'),
(2, 'Second Term', 0, '2020-06-24 20:10:29', '2020-06-24 20:10:29'),
(3, 'Third Term', 0, '2020-06-24 20:10:29', '2020-06-24 20:10:29');

-- --------------------------------------------------------

--
-- Table structure for table `thirdtermresults`
--

CREATE TABLE `thirdtermresults` (
  `id` int(10) UNSIGNED NOT NULL,
  `year_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `form_id` int(10) UNSIGNED NOT NULL,
  `form_type` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` int(10) UNSIGNED NOT NULL,
  `seq5` decimal(6,1) DEFAULT NULL,
  `seq6` decimal(6,1) DEFAULT NULL,
  `ave_point` decimal(6,2) DEFAULT NULL,
  `position` int(10) UNSIGNED DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `thirdtermresults`
--

INSERT INTO `thirdtermresults` (`id`, `year_id`, `student_id`, `form_id`, `form_type`, `subject_id`, `seq5`, `seq6`, `ave_point`, `position`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 42, 11, 'A', 18, '20.0', '19.0', '78.00', NULL, 1, '2021-02-01 07:43:22', '2021-02-01 08:13:00'),
(2, 1, 42, 11, 'A', 20, '18.5', '17.6', '36.10', NULL, 1, '2021-02-01 07:43:35', '2021-02-01 08:12:47'),
(3, 1, 42, 11, 'A', 21, '18.0', '17.0', '35.00', NULL, 1, '2021-02-01 07:43:52', '2021-02-01 08:01:54'),
(4, 1, 44, 11, 'A', 19, '13.0', '9.0', '33.00', NULL, 1, '2021-02-01 07:51:29', '2021-02-01 08:02:14'),
(5, 1, 46, 11, 'A', 19, '17.5', '12.0', '44.25', NULL, 1, '2021-02-01 07:51:41', '2021-02-01 07:59:58'),
(6, 1, 43, 11, 'B', 19, '11.0', '12.0', '34.50', NULL, 1, '2021-02-01 07:55:48', '2021-02-01 07:57:38'),
(7, 1, 45, 11, 'B', 19, '14.3', '17.0', '46.95', NULL, 1, '2021-02-01 07:55:51', '2021-02-01 07:57:30'),
(8, 1, 45, 11, 'B', 20, '13.0', '12.0', '25.00', NULL, 1, '2021-02-01 07:56:00', '2021-02-01 08:12:16'),
(9, 1, 43, 11, 'B', 20, '9.0', '11.0', '20.00', NULL, 1, '2021-02-01 07:56:05', '2021-02-01 07:56:46'),
(10, 1, 43, 11, 'B', 21, '8.5', '11.0', '19.50', NULL, 1, '2021-02-01 07:56:08', '2021-02-01 07:56:10'),
(11, 1, 45, 11, 'B', 21, '12.7', '9.5', '22.20', NULL, 1, '2021-02-01 07:56:14', '2021-02-01 07:56:20'),
(12, 1, 48, 11, 'B', 21, '14.0', '10.0', '24.00', NULL, 1, '2021-02-01 07:56:23', '2021-02-01 07:56:29'),
(13, 1, 51, 11, 'B', 21, '11.0', '7.0', '18.00', NULL, 1, '2021-02-01 07:56:34', '2021-02-01 07:56:40'),
(14, 1, 48, 11, 'B', 20, '6.8', '7.9', '14.70', NULL, 1, '2021-02-01 07:56:51', '2021-02-01 07:56:57'),
(15, 1, 51, 11, 'B', 20, '14.0', '14.0', '28.00', NULL, 1, '2021-02-01 07:57:00', '2021-02-01 07:57:03'),
(16, 1, 51, 11, 'B', 19, '9.9', '17.0', '40.35', NULL, 1, '2021-02-01 07:57:06', '2021-02-01 07:57:19'),
(17, 1, 48, 11, 'B', 19, '12.6', '16.0', '42.90', NULL, 1, '2021-02-01 07:57:09', '2021-02-01 07:57:24'),
(18, 1, 43, 11, 'B', 18, '18.5', '6.8', '50.60', NULL, 1, '2021-02-01 07:57:35', '2021-02-01 07:58:00'),
(19, 1, 45, 11, 'B', 18, '12.0', '16.0', '56.00', NULL, 1, '2021-02-01 07:57:44', '2021-02-01 07:57:54'),
(20, 1, 48, 11, 'B', 18, '3.0', '5.5', '17.00', NULL, 1, '2021-02-01 07:57:48', '2021-02-01 07:57:52'),
(21, 1, 51, 11, 'B', 18, '12.0', '7.0', '38.00', NULL, 1, '2021-02-01 07:57:49', '2021-02-01 07:58:03'),
(22, 1, 46, 11, 'A', 20, '13.0', '18.0', '31.00', NULL, 1, '2021-02-01 07:59:59', '2021-02-01 08:00:01'),
(23, 1, 46, 11, 'A', 21, '9.0', '6.5', '15.50', NULL, 1, '2021-02-01 08:00:04', '2021-02-01 08:00:14'),
(24, 1, 44, 11, 'A', 21, '12.0', '11.0', '23.00', NULL, 1, '2021-02-01 08:00:17', '2021-02-01 08:00:19'),
(25, 1, 44, 11, 'A', 20, '14.0', '13.0', '27.00', NULL, 1, '2021-02-01 08:00:29', '2021-02-01 08:00:53'),
(26, 1, 42, 11, 'A', 19, '19.5', '20.0', '59.25', NULL, 1, '2021-02-01 08:00:37', '2021-02-01 08:01:23'),
(27, 1, 44, 11, 'A', 18, '9.5', '15.0', '49.00', NULL, 1, '2021-02-01 08:02:17', '2021-02-01 08:03:08'),
(28, 1, 46, 11, 'A', 18, '13.0', '5.5', '37.00', NULL, 1, '2021-02-01 08:03:14', '2021-02-01 08:03:17'),
(29, 1, 42, 11, NULL, 28, '19.5', '20.0', '79.00', NULL, 1, '2021-02-01 18:49:43', '2021-02-01 18:49:46'),
(30, 1, 44, 11, NULL, 28, '10.0', '9.0', '38.00', NULL, 1, '2021-02-01 18:49:49', '2021-02-01 18:49:50'),
(31, 1, 46, 11, NULL, 28, '8.5', '11.0', '39.00', NULL, 1, '2021-02-01 18:49:54', '2021-02-01 18:49:56'),
(32, 1, 48, 11, NULL, 28, NULL, '12.0', '24.00', NULL, 1, '2021-02-01 18:50:07', '2021-02-01 18:50:07');

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
(1, 'fr', 'bimernoel@gmai.com', NULL, 'bimerinoel', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `years`
--

CREATE TABLE `years` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `years`
--

INSERT INTO `years` (`id`, `name`, `active`, `created_at`, `updated_at`) VALUES
(1, '2019/2020', 1, '2020-06-24 20:04:28', '2020-06-24 20:04:28'),
(2, '2020/2021', 0, '2020-06-24 20:04:28', '2020-06-24 20:04:28'),
(3, '2021/2022', 0, '2020-06-24 20:04:28', '2020-06-24 20:04:28'),
(4, '2015/2016', 0, '2020-08-08 08:16:01', '2020-08-08 08:16:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `admin_permission`
--
ALTER TABLE `admin_permission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_permission_admin_id_foreign` (`admin_id`),
  ADD KEY `admin_permission_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `admin_role`
--
ALTER TABLE `admin_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_role_role_id_foreign` (`role_id`),
  ADD KEY `admin_role_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assignments_year_id_foreign` (`year_id`),
  ADD KEY `assignments_teacher_id_foreign` (`teacher_id`),
  ADD KEY `assignments_subject_id_foreign` (`subject_id`);

--
-- Indexes for table `backgrounds`
--
ALTER TABLE `backgrounds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `backgrounds_sector_id_foreign` (`sector_id`);

--
-- Indexes for table `disciplines`
--
ALTER TABLE `disciplines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expensetypes`
--
ALTER TABLE `expensetypes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expensetypes_year_id_foreign` (`year_id`),
  ADD KEY `expensetypes_term_id_foreign` (`term_id`),
  ADD KEY `expensetypes_expense_id_foreign` (`expense_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feecontrols`
--
ALTER TABLE `feecontrols`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feecontrols_student_id_foreign` (`student_id`),
  ADD KEY `feecontrols_form_id_foreign` (`form_id`),
  ADD KEY `feecontrols_year_id_foreign` (`year_id`);

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fees_year_id_foreign` (`year_id`),
  ADD KEY `fees_feetype_id_foreign` (`feetype_id`),
  ADD KEY `fees_student_id_foreign` (`student_id`),
  ADD KEY `fees_student_school_id_foreign` (`student_school_id`),
  ADD KEY `fees_form_id_foreign` (`form_id`);

--
-- Indexes for table `feetypes`
--
ALTER TABLE `feetypes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feetypes_year_id_foreign` (`year_id`),
  ADD KEY `feetypes_form_id_foreign` (`form_id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `files_year_id_foreign` (`year_id`),
  ADD KEY `files_subject_id_foreign` (`subject_id`),
  ADD KEY `files_teacher_id_foreign` (`teacher_id`);

--
-- Indexes for table `firsttermresults`
--
ALTER TABLE `firsttermresults`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `form_id` (`form_id`,`year_id`,`subject_id`,`student_id`),
  ADD KEY `firsttermresults_year_id_foreign` (`year_id`),
  ADD KEY `firsttermresults_student_id_foreign` (`student_id`),
  ADD KEY `firsttermresults_subject_id_foreign` (`subject_id`);

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `forms_code_unique` (`code`),
  ADD KEY `forms_background_id_foreign` (`background_id`);

--
-- Indexes for table `generateresults`
--
ALTER TABLE `generateresults`
  ADD PRIMARY KEY (`id`),
  ADD KEY `generateresults_year_id_foreign` (`year_id`),
  ADD KEY `generateresults_form_id_foreign` (`form_id`),
  ADD KEY `generateresults_term_id_foreign` (`term_id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
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
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_role_permission_id_foreign` (`permission_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `promotions_year_id_foreign` (`year_id`),
  ADD KEY `promotions_student_id_foreign` (`student_id`),
  ADD KEY `promotions_form_id_foreign` (`form_id`);

--
-- Indexes for table `resultcontrols`
--
ALTER TABLE `resultcontrols`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resultcontrols_year_id_foreign` (`year_id`),
  ADD KEY `resultcontrols_term_id_foreign` (`term_id`),
  ADD KEY `resultcontrols_sequence_id_foreign` (`seq1_id`),
  ADD KEY `resultcontrols_generateresult_id_foreign` (`generateresult_id`),
  ADD KEY `resultcontrols_seq2_id_foreign` (`seq2_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pinky` (`name`);

--
-- Indexes for table `scholarships`
--
ALTER TABLE `scholarships`
  ADD PRIMARY KEY (`id`),
  ADD KEY `scholarships_year_id_foreign` (`year_id`),
  ADD KEY `scholarships_term_id_foreign` (`term_id`),
  ADD KEY `scholarships_form_id_foreign` (`form_id`),
  ADD KEY `scholarships_student_id_foreign` (`student_id`);

--
-- Indexes for table `secondtermresults`
--
ALTER TABLE `secondtermresults`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `form_id` (`form_id`,`year_id`,`subject_id`,`student_id`),
  ADD KEY `secondtermresults_year_id_foreign` (`year_id`),
  ADD KEY `secondtermresults_student_id_foreign` (`student_id`),
  ADD KEY `secondtermresults_subject_id_foreign` (`subject_id`);

--
-- Indexes for table `sectors`
--
ALTER TABLE `sectors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sequences`
--
ALTER TABLE `sequences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sequences_term_id_foreign` (`term_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `settings_year_id_foreign` (`year_id`);

--
-- Indexes for table `studentdisciplines`
--
ALTER TABLE `studentdisciplines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `studentdisciplines_year_id_foreign` (`year_id`),
  ADD KEY `studentdisciplines_term_id_foreign` (`term_id`),
  ADD KEY `studentdisciplines_student_id_foreign` (`student_id`),
  ADD KEY `studentdisciplines_discipline_id_foreign` (`discipline_id`);

--
-- Indexes for table `studentinfos`
--
ALTER TABLE `studentinfos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `studentinfos_form_id_foreign` (`form_id`),
  ADD KEY `studentinfos_year_id_foreign` (`year_id`),
  ADD KEY `studentinfos_student_id_foreign` (`student_id`),
  ADD KEY `studentinfos_subform_id_foreign` (`subform_id`);

--
-- Indexes for table `studentresults`
--
ALTER TABLE `studentresults`
  ADD PRIMARY KEY (`id`),
  ADD KEY `studentresults_year_id_foreign` (`year_id`),
  ADD KEY `studentresults_term_id_foreign` (`term_id`),
  ADD KEY `studentresults_form_id_foreign` (`form_id`),
  ADD KEY `studentresults_student_id_foreign` (`student_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_school_id_unique` (`school_id`),
  ADD UNIQUE KEY `students_email_unique` (`email`);

--
-- Indexes for table `subclasses`
--
ALTER TABLE `subclasses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subclasses_form_id_foreign` (`form_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `form_id` (`form_id`,`name`);

--
-- Indexes for table `subject_teacher`
--
ALTER TABLE `subject_teacher`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subject_teacher_subject_id_unique` (`subject_id`),
  ADD KEY `subject_teacher_teacher_id_foreign` (`teacher_id`),
  ADD KEY `subject_teacher_year_id_foreign` (`year_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `teachers_email_unique` (`email`);

--
-- Indexes for table `terms`
--
ALTER TABLE `terms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thirdtermresults`
--
ALTER TABLE `thirdtermresults`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `form_id` (`form_id`,`year_id`,`subject_id`,`student_id`),
  ADD KEY `thirdtermresults_year_id_foreign` (`year_id`),
  ADD KEY `thirdtermresults_student_id_foreign` (`student_id`),
  ADD KEY `thirdtermresults_subject_id_foreign` (`subject_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `years`
--
ALTER TABLE `years`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `year_name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `admin_permission`
--
ALTER TABLE `admin_permission`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `admin_role`
--
ALTER TABLE `admin_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `backgrounds`
--
ALTER TABLE `backgrounds`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `disciplines`
--
ALTER TABLE `disciplines`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `expensetypes`
--
ALTER TABLE `expensetypes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feecontrols`
--
ALTER TABLE `feecontrols`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `feetypes`
--
ALTER TABLE `feetypes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `firsttermresults`
--
ALTER TABLE `firsttermresults`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `generateresults`
--
ALTER TABLE `generateresults`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;

--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `resultcontrols`
--
ALTER TABLE `resultcontrols`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `scholarships`
--
ALTER TABLE `scholarships`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `secondtermresults`
--
ALTER TABLE `secondtermresults`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `sectors`
--
ALTER TABLE `sectors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sequences`
--
ALTER TABLE `sequences`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `studentdisciplines`
--
ALTER TABLE `studentdisciplines`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `studentinfos`
--
ALTER TABLE `studentinfos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `studentresults`
--
ALTER TABLE `studentresults`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `subclasses`
--
ALTER TABLE `subclasses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `subject_teacher`
--
ALTER TABLE `subject_teacher`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `terms`
--
ALTER TABLE `terms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `thirdtermresults`
--
ALTER TABLE `thirdtermresults`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `years`
--
ALTER TABLE `years`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_permission`
--
ALTER TABLE `admin_permission`
  ADD CONSTRAINT `admin_permission_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `admin_permission_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `admin_role`
--
ALTER TABLE `admin_role`
  ADD CONSTRAINT `admin_role_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `admin_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `assignments`
--
ALTER TABLE `assignments`
  ADD CONSTRAINT `assignments_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `assignments_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `assignments_year_id_foreign` FOREIGN KEY (`year_id`) REFERENCES `years` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `backgrounds`
--
ALTER TABLE `backgrounds`
  ADD CONSTRAINT `backgrounds_sector_id_foreign` FOREIGN KEY (`sector_id`) REFERENCES `sectors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `expensetypes`
--
ALTER TABLE `expensetypes`
  ADD CONSTRAINT `expensetypes_expense_id_foreign` FOREIGN KEY (`expense_id`) REFERENCES `expenses` (`id`),
  ADD CONSTRAINT `expensetypes_term_id_foreign` FOREIGN KEY (`term_id`) REFERENCES `terms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `expensetypes_year_id_foreign` FOREIGN KEY (`year_id`) REFERENCES `years` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `feecontrols`
--
ALTER TABLE `feecontrols`
  ADD CONSTRAINT `feecontrols_form_id_foreign` FOREIGN KEY (`form_id`) REFERENCES `forms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `feecontrols_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `feecontrols_year_id_foreign` FOREIGN KEY (`year_id`) REFERENCES `years` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fees`
--
ALTER TABLE `fees`
  ADD CONSTRAINT `fees_feetype_id_foreign` FOREIGN KEY (`feetype_id`) REFERENCES `feetypes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fees_form_id_foreign` FOREIGN KEY (`form_id`) REFERENCES `forms` (`id`),
  ADD CONSTRAINT `fees_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fees_student_school_id_foreign` FOREIGN KEY (`student_school_id`) REFERENCES `students` (`school_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fees_year_id_foreign` FOREIGN KEY (`year_id`) REFERENCES `years` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `feetypes`
--
ALTER TABLE `feetypes`
  ADD CONSTRAINT `feetypes_form_id_foreign` FOREIGN KEY (`form_id`) REFERENCES `forms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `feetypes_year_id_foreign` FOREIGN KEY (`year_id`) REFERENCES `years` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `files_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `files_year_id_foreign` FOREIGN KEY (`year_id`) REFERENCES `years` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `firsttermresults`
--
ALTER TABLE `firsttermresults`
  ADD CONSTRAINT `firsttermresults_form_id_foreign` FOREIGN KEY (`form_id`) REFERENCES `forms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `firsttermresults_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `firsttermresults_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `firsttermresults_year_id_foreign` FOREIGN KEY (`year_id`) REFERENCES `years` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `forms`
--
ALTER TABLE `forms`
  ADD CONSTRAINT `forms_background_id_foreign` FOREIGN KEY (`background_id`) REFERENCES `backgrounds` (`id`);

--
-- Constraints for table `generateresults`
--
ALTER TABLE `generateresults`
  ADD CONSTRAINT `generateresults_form_id_foreign` FOREIGN KEY (`form_id`) REFERENCES `forms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `generateresults_term_id_foreign` FOREIGN KEY (`term_id`) REFERENCES `terms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `generateresults_year_id_foreign` FOREIGN KEY (`year_id`) REFERENCES `years` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `promotions`
--
ALTER TABLE `promotions`
  ADD CONSTRAINT `promotions_form_id_foreign` FOREIGN KEY (`form_id`) REFERENCES `forms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `promotions_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `promotions_year_id_foreign` FOREIGN KEY (`year_id`) REFERENCES `years` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `resultcontrols`
--
ALTER TABLE `resultcontrols`
  ADD CONSTRAINT `resultcontrols_generateresult_id_foreign` FOREIGN KEY (`generateresult_id`) REFERENCES `generateresults` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `resultcontrols_seq2_id_foreign` FOREIGN KEY (`seq2_id`) REFERENCES `sequences` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `resultcontrols_sequence_id_foreign` FOREIGN KEY (`seq1_id`) REFERENCES `sequences` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `resultcontrols_term_id_foreign` FOREIGN KEY (`term_id`) REFERENCES `terms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `resultcontrols_year_id_foreign` FOREIGN KEY (`year_id`) REFERENCES `years` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `scholarships`
--
ALTER TABLE `scholarships`
  ADD CONSTRAINT `scholarships_form_id_foreign` FOREIGN KEY (`form_id`) REFERENCES `forms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `scholarships_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `scholarships_term_id_foreign` FOREIGN KEY (`term_id`) REFERENCES `terms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `scholarships_year_id_foreign` FOREIGN KEY (`year_id`) REFERENCES `years` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `secondtermresults`
--
ALTER TABLE `secondtermresults`
  ADD CONSTRAINT `secondtermresults_form_id_foreign` FOREIGN KEY (`form_id`) REFERENCES `forms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `secondtermresults_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `secondtermresults_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `secondtermresults_year_id_foreign` FOREIGN KEY (`year_id`) REFERENCES `years` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sequences`
--
ALTER TABLE `sequences`
  ADD CONSTRAINT `sequences_term_id_foreign` FOREIGN KEY (`term_id`) REFERENCES `terms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `settings`
--
ALTER TABLE `settings`
  ADD CONSTRAINT `settings_year_id_foreign` FOREIGN KEY (`year_id`) REFERENCES `years` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `studentdisciplines`
--
ALTER TABLE `studentdisciplines`
  ADD CONSTRAINT `studentdisciplines_discipline_id_foreign` FOREIGN KEY (`discipline_id`) REFERENCES `disciplines` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `studentdisciplines_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `studentdisciplines_term_id_foreign` FOREIGN KEY (`term_id`) REFERENCES `terms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `studentdisciplines_year_id_foreign` FOREIGN KEY (`year_id`) REFERENCES `years` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `studentinfos`
--
ALTER TABLE `studentinfos`
  ADD CONSTRAINT `studentinfos_form_id_foreign` FOREIGN KEY (`form_id`) REFERENCES `forms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `studentinfos_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `studentinfos_subform_id_foreign` FOREIGN KEY (`subform_id`) REFERENCES `subclasses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `studentinfos_year_id_foreign` FOREIGN KEY (`year_id`) REFERENCES `years` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `studentresults`
--
ALTER TABLE `studentresults`
  ADD CONSTRAINT `studentresults_form_id_foreign` FOREIGN KEY (`form_id`) REFERENCES `forms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `studentresults_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `studentresults_term_id_foreign` FOREIGN KEY (`term_id`) REFERENCES `terms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `studentresults_year_id_foreign` FOREIGN KEY (`year_id`) REFERENCES `years` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subclasses`
--
ALTER TABLE `subclasses`
  ADD CONSTRAINT `subclasses_form_id_foreign` FOREIGN KEY (`form_id`) REFERENCES `forms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_form_id_foreign` FOREIGN KEY (`form_id`) REFERENCES `forms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subject_teacher`
--
ALTER TABLE `subject_teacher`
  ADD CONSTRAINT `subject_teacher_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subject_teacher_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subject_teacher_year_id_foreign` FOREIGN KEY (`year_id`) REFERENCES `years` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `thirdtermresults`
--
ALTER TABLE `thirdtermresults`
  ADD CONSTRAINT `thirdtermresults_form_id_foreign` FOREIGN KEY (`form_id`) REFERENCES `forms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `thirdtermresults_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `thirdtermresults_subject_id_foreign` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `thirdtermresults_year_id_foreign` FOREIGN KEY (`year_id`) REFERENCES `years` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
