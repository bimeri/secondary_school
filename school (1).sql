-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2020 at 08:25 PM
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
(15, 'MBAH', 'ISAAC', 0, 'daf@me', 'NISHANG', '15.png', 'Male', 'Jul 13, 2020', '$2y$10$a16Q9o9Xf4KOefCMjPjoXO5FKS5KlCzKZ8vqijhATuyYttT3ET8WC', NULL, '2020-07-05 18:10:20', '2020-07-05 18:10:20');

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

--
-- Dumping data for table `admin_permission`
--

INSERT INTO `admin_permission` (`id`, `admin_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(111, 15, 18, NULL, NULL),
(112, 15, 21, NULL, NULL),
(125, 15, 1, NULL, NULL),
(126, 15, 2, NULL, NULL),
(127, 15, 3, NULL, NULL),
(128, 15, 4, NULL, NULL),
(129, 15, 5, NULL, NULL),
(130, 15, 13, NULL, NULL),
(131, 15, 36, NULL, NULL),
(132, 15, 27, NULL, NULL),
(133, 15, 24, NULL, NULL),
(134, 15, 30, NULL, NULL);

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

--
-- Dumping data for table `admin_role`
--

INSERT INTO `admin_role` (`id`, `admin_id`, `role_id`, `created_at`, `updated_at`) VALUES
(84, 15, 12, NULL, NULL);

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
(4, 'First Cycle', 4, '2020-08-10 02:35:28', '2020-08-10 02:35:28');

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
-- Table structure for table `expensetypes`
--

CREATE TABLE `expensetypes` (
  `id` int(10) UNSIGNED NOT NULL,
  `year_id` int(10) UNSIGNED NOT NULL,
  `term_id` int(10) UNSIGNED NOT NULL,
  `expense_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expensetypes`
--

INSERT INTO `expensetypes` (`id`, `year_id`, `term_id`, `expense_type`, `reason`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Medication', 'form one student had medication problem, so little was spent on them', '2020-07-30 10:09:34', '2020-07-30 10:09:34'),
(2, 3, 2, 'Scholarship', 'money spend on scholarship this terms', '2020-07-30 10:20:48', '2020-07-30 10:20:48');

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
(6, 6, 'BG0A03', 3, 1, 'Mon, 10 Aug 2020 15:25pm', '2020-08-10 14:25:25', '2020-08-10 14:25:25');

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
(1, 1, 1, 5, 'BG0A02', 1, 500, 1000, 'Cash Payment', 0, 1, '01/01/1999', '2020-08-06 23:09:21', '2020-08-06 23:09:21'),
(2, 1, 3, 6, 'BG0A03', 3, 0, 1500, 'Cash Payment', 500, 0, '01/01/1999', '2020-08-06 23:26:36', '2020-08-06 23:26:36'),
(9, 1, 4, 6, 'BG0A03', 3, NULL, 500, 'MTN Mobile Money', 250, 0, 'Aug 08, 2020 - 11:42 am', '2020-08-08 10:42:24', '2020-08-08 10:42:24'),
(10, 1, 4, 6, 'BG0A03', 3, NULL, 250, 'Orange Money', 0, 1, 'Aug 08, 2020 - 11:42 am', '2020-08-08 10:42:50', '2020-08-08 10:42:50'),
(11, 1, 3, 6, 'BG0A03', 3, NULL, 500, 'Bank Transaction', 0, 1, 'Aug 08, 2020 - 11:45 am', '2020-08-08 10:45:36', '2020-08-08 10:45:36'),
(12, 4, 7, 6, 'BG0A03', 3, NULL, 250, 'Orange Money', 0, 1, 'Aug 08, 2020 - 11:42 am', '2020-08-08 10:42:50', '2020-08-08 10:42:50'),
(13, 4, 7, 6, 'BG0A03', 3, NULL, 500, 'Bank Transaction', 0, 1, 'Aug 08, 2020 - 11:45 am', '2020-08-08 10:45:36', '2020-08-08 10:45:36'),
(14, 2, 8, 6, 'BG0A03', 4, 0, 600, 'Cash Payment', 0, 1, 'Aug 09, 2020 - 04:12 am', '2020-08-09 03:12:33', '2020-08-09 03:12:33');

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
(1, 1, 1, 'Tuition', 1000, '2020-07-27 19:43:38', '2020-07-27 19:43:38'),
(2, 1, 1, 'Computer', 500, '2020-07-27 19:46:43', '2020-07-27 19:46:43'),
(3, 1, 3, 'Tuition', 2000, '2020-07-28 07:44:13', '2020-07-28 07:44:13'),
(4, 1, 3, 'Computer', 750, '2020-07-30 17:36:40', '2020-07-30 17:36:40'),
(7, 4, 3, 'Tuition test', 2000, '2020-07-28 07:44:13', '2020-07-28 07:44:13'),
(8, 2, 3, 'Tuition', 600, '2020-08-09 03:10:34', '2020-08-09 03:10:34'),
(9, 2, 3, 'Practical', 200, '2020-08-09 03:11:09', '2020-08-09 03:11:09');

-- --------------------------------------------------------

--
-- Table structure for table `firsttermresults`
--

CREATE TABLE `firsttermresults` (
  `id` int(10) UNSIGNED NOT NULL,
  `year_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `form_id` int(10) UNSIGNED NOT NULL,
  `subject_id` int(10) UNSIGNED NOT NULL,
  `seq1` decimal(6,1) DEFAULT NULL,
  `seq2` decimal(6,1) DEFAULT NULL,
  `ave_point` decimal(6,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `firsttermresults`
--

INSERT INTO `firsttermresults` (`id`, `year_id`, `student_id`, `form_id`, `subject_id`, `seq1`, `seq2`, `ave_point`, `created_at`, `updated_at`) VALUES
(1, 1, 6, 3, 13, '13.0', '19.0', '32.00', '2020-08-17 22:12:07', '2020-08-22 22:13:18'),
(2, 1, 7, 3, 13, '11.0', '9.5', '20.50', '2020-08-17 22:12:13', '2020-08-22 22:13:50'),
(3, 1, 8, 3, 13, '6.0', '7.3', '13.30', '2020-08-17 22:12:16', '2020-08-22 22:16:15'),
(4, 1, 9, 3, 13, '12.0', '18.0', '30.00', '2020-08-17 22:12:20', '2020-08-22 22:16:19'),
(5, 1, 23, 3, 13, '4.0', '19.0', '23.00', '2020-08-17 22:12:22', '2020-08-22 22:16:23'),
(6, 1, 24, 3, 13, '13.0', NULL, '13.00', '2020-08-17 22:12:31', '2020-08-22 22:16:32'),
(7, 1, 25, 3, 13, '3.7', '11.0', '14.70', '2020-08-17 22:12:35', '2020-08-22 22:16:38'),
(8, 1, 6, 3, 12, '8.0', '17.0', '25.00', '2020-08-17 22:13:19', '2020-08-22 22:13:11'),
(9, 1, 7, 3, 12, '10.0', '11.5', '21.50', '2020-08-17 22:13:23', '2020-08-22 22:13:58'),
(10, 1, 8, 3, 12, '11.0', NULL, '11.00', '2020-08-17 22:13:28', '2020-08-22 22:17:04'),
(11, 1, 9, 3, 12, '11.0', '9.0', '20.00', '2020-08-17 22:13:30', '2020-08-22 22:17:09'),
(12, 1, 23, 3, 12, NULL, '11.0', '11.00', '2020-08-17 22:13:33', '2020-08-22 22:16:26'),
(13, 1, 25, 3, 12, '9.5', '13.5', '23.00', '2020-08-17 22:13:36', '2020-08-22 22:17:23'),
(14, 1, 24, 3, 12, '12.0', NULL, '12.00', '2020-08-17 22:13:48', '2020-08-22 22:17:17'),
(15, 1, 6, 3, 15, '6.0', '6.0', '24.00', '2020-08-17 22:14:17', '2020-08-22 22:13:30'),
(16, 1, 6, 3, 5, '10.0', '11.6', '32.40', '2020-08-17 22:14:24', '2020-08-23 13:06:41'),
(17, 1, 7, 3, 5, '11.1', '13.0', '36.15', '2020-08-17 22:14:36', '2020-08-22 22:08:44'),
(18, 1, 9, 3, 5, '12.0', '14.0', '39.00', '2020-08-17 22:15:02', '2020-08-22 22:14:21'),
(19, 1, 23, 3, 5, '6.5', '10.0', '24.75', '2020-08-17 22:15:06', '2020-08-22 22:21:39'),
(20, 1, 25, 3, 5, '12.0', '9.4', '32.10', '2020-08-17 22:15:23', '2020-08-22 22:14:37'),
(21, 1, 24, 3, 5, NULL, '8.8', '13.20', '2020-08-17 22:15:33', '2020-08-22 22:14:30'),
(22, 1, 23, 3, 11, '12.0', '11.0', '34.50', '2020-08-17 22:15:43', '2020-08-22 22:18:12'),
(23, 1, 24, 3, 11, NULL, '12.0', '18.00', '2020-08-17 22:15:45', '2020-08-22 22:18:15'),
(24, 1, 25, 3, 11, '17.0', '11.0', '42.00', '2020-08-17 22:15:48', '2020-08-22 22:18:18'),
(25, 1, 9, 3, 11, '20.0', '7.0', '40.50', '2020-08-17 22:15:53', '2020-08-22 22:18:09'),
(26, 1, 7, 3, 11, NULL, '11.0', '16.50', '2020-08-17 22:16:03', '2020-08-22 22:17:59'),
(27, 1, 6, 3, 11, NULL, '12.0', '18.00', '2020-08-17 22:16:08', '2020-08-22 22:17:55'),
(28, 1, 8, 3, 11, '9.0', NULL, '13.50', '2020-08-17 22:16:11', '2020-08-22 22:18:03'),
(29, 1, 8, 3, 5, NULL, '18.0', '27.00', '2020-08-17 22:16:17', '2020-08-22 22:14:24'),
(30, 1, 9, 3, 15, '9.5', '14.0', '47.00', '2020-08-17 22:16:30', '2020-08-22 22:15:46'),
(31, 1, 24, 3, 15, '8.5', '11.0', '39.00', '2020-08-17 22:16:34', '2020-08-22 22:15:32'),
(32, 1, 25, 3, 15, '16.0', '13.0', '58.00', '2020-08-17 22:16:40', '2020-08-22 22:15:27'),
(33, 1, 8, 3, 15, '10.0', '16.0', '52.00', '2020-08-17 22:16:46', '2020-08-22 22:15:50'),
(34, 1, 7, 3, 15, '10.5', NULL, '21.00', '2020-08-17 22:16:50', '2020-08-22 22:13:37'),
(35, 1, 23, 3, 15, '12.0', '8.0', '40.00', '2020-08-17 22:16:58', '2020-08-22 22:15:39'),
(36, 1, 7, 3, 14, NULL, '11.0', '11.00', '2020-08-17 22:17:03', '2020-08-22 22:13:46'),
(37, 1, 8, 3, 14, NULL, '18.0', '18.00', '2020-08-17 22:17:05', '2020-08-22 22:15:58'),
(38, 1, 9, 3, 14, '11.0', NULL, '11.00', '2020-08-17 22:17:07', '2020-08-22 22:16:07'),
(39, 1, 23, 3, 14, NULL, '12.0', '12.00', '2020-08-17 22:17:10', '2020-08-22 22:16:02'),
(40, 1, 24, 3, 14, '6.0', '17.0', '23.00', '2020-08-17 22:17:13', '2020-08-22 22:22:32'),
(41, 1, 25, 3, 14, NULL, '7.0', '7.00', '2020-08-17 22:17:18', '2020-08-22 22:22:28'),
(42, 1, 6, 3, 14, '11.0', '9.5', '20.50', '2020-08-17 22:17:22', '2020-08-22 22:13:26'),
(43, 1, 26, 3, 5, '17.0', '11.0', '42.00', '2020-08-17 22:19:31', '2020-08-22 22:14:53'),
(44, 1, 26, 3, 11, '8.0', NULL, '12.00', '2020-08-17 22:19:34', '2020-08-22 22:14:49'),
(45, 1, 26, 3, 12, '11.0', '9.5', '20.50', '2020-08-17 22:19:37', '2020-08-22 22:15:03'),
(46, 1, 26, 3, 13, '8.5', '15.0', '23.50', '2020-08-17 22:19:45', '2020-08-22 22:15:07'),
(47, 1, 26, 3, 14, '16.0', NULL, '16.00', '2020-08-17 22:19:51', '2020-08-22 22:15:10'),
(48, 1, 26, 3, 15, '12.0', '8.0', '40.00', '2020-08-17 22:19:54', '2020-08-22 22:15:21');

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
(1, 'Form One', 'FM1A01', 'A', 7, 1, '2020-07-06 21:23:58', '2020-07-06 21:23:58'),
(3, 'Form Two', 'FM2A01', 'A', 7, 1, '2020-07-07 01:39:41', '2020-07-07 01:39:41'),
(4, 'Form Three', 'FM301', 'A', 10, 1, '2020-07-16 22:12:20', '2020-07-16 22:12:20'),
(5, 'form One', 'FMC01', 'B', 10, 4, '2020-08-10 03:14:37', '2020-08-10 03:14:37');

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
(1, 1, 1, 3, 8, 2, '9.34', '11.72', '7.39', 1, '2020-08-23 15:35:53', '2020-08-23 15:50:14');

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
(59, '2020_08_22_182327_create_studentresults_table', 31);

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
(3, 1, 1, 1, 5, 500, 'you are a great boy', '2020-07-31 23:52:01', '2020-07-31 23:52:01'),
(4, 2, 2, 3, 7, 1000, 'you did actually well in your previous class', '2020-08-03 23:31:22', '2020-08-03 23:31:22'),
(6, 1, 1, 3, 7, 1000, 'thats good my dear', '2020-08-07 23:45:18', '2020-08-07 23:45:18');

-- --------------------------------------------------------

--
-- Table structure for table `secondtermresults`
--

CREATE TABLE `secondtermresults` (
  `id` int(10) UNSIGNED NOT NULL,
  `year_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `form_id` int(10) UNSIGNED NOT NULL,
  `subject_id` int(10) UNSIGNED NOT NULL,
  `seq3` decimal(6,1) DEFAULT NULL,
  `seq4` decimal(6,1) DEFAULT NULL,
  `ave_point` decimal(6,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(5, 'French Sector', 'all lower-sixth and upper-sixth students', '2020-07-05 22:47:50', '2020-07-05 22:47:50');

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
(1, 'First Sequences', 1, 1, '2020-07-04 02:08:57', '2020-07-04 02:08:57'),
(2, 'Second Sequence', 1, 0, '2020-07-04 18:36:45', '2020-07-04 18:36:45');

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
(1, 1, 'Government Bilingual High School Kumba', 'BG', 'Knowledge with Wisdom', 'logo.png', 0, 0, '07:30 AM', '11:30 AM', '04:30 PM', '2 hrs', '2020-06-24 20:28:34', '2020-06-24 20:28:34');

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
(1, 5, 'BG0A02', 1, 1, NULL, '123456789', 'magaza@gmail.com', 'small soppo', 'BG0A02.jpg', 'Jul 01, 2020', 'Male', '2020-07-08 03:15:24', '2020-07-08 03:15:24'),
(2, 6, 'BG0A03', 1, 3, NULL, '76587987', NULL, 'longstreet buea', 'BG0A03.jpg', 'Jul 02, 1997', 'Male', '2020-07-08 12:09:33', '2020-07-08 12:09:33'),
(3, 7, 'BG0A04', 1, 3, NULL, '678945254', 'nguti@gmail.com', 'bokoko', 'BG0A04.png', 'Jul 01, 2020', 'Female', '2020-07-10 22:25:02', '2020-07-10 22:25:02'),
(4, 8, 'BG0A05', 1, 3, NULL, '123456789', NULL, 'small soppo buea cameroon', 'BG0A05.jpg', 'Jul 15, 2020', 'Male', '2020-07-12 18:53:59', '2020-07-12 18:53:59'),
(5, 9, 'BG0A06', 1, 3, NULL, '657898767', 'dd@example.com', 'molyko', 'BG0A06.jpg', '1997-03-23', 'Female', '2020-07-16 00:17:22', '2020-07-16 00:17:22'),
(6, 10, 'BG0A07', 1, 1, NULL, '678723450', 'enow@gmail.com', 'long street', 'BG0A07.jpg', '2000-02-23', 'Female', '2020-07-30 14:27:11', '2020-07-30 14:27:11'),
(7, 13, 'BG0A08', 1, 1, NULL, '656787890', 'ddd@example.com', 'mile 4', 'default.png', '2020-08-01', 'Female', '2020-08-07 18:44:57', '2020-08-07 18:44:57'),
(8, 14, 'BG0A09', 1, 1, NULL, '123123123', 'example@gmail.com', 'muyuka', 'BG0A09.jpg', '2020-07-02', 'Male', '2020-08-07 18:49:52', '2020-08-07 18:49:52'),
(9, 15, 'BG0A10', 1, 1, NULL, '123456789', NULL, 'molyko buea', 'BG0A10.jpg', '2020-08-06', 'Male', '2020-08-10 03:34:16', '2020-08-10 03:34:16'),
(10, 16, 'BG0A11', 1, 1, NULL, '123234565', NULL, NULL, 'BG0A11.jpg', '2020-08-06', 'Female', '2020-08-10 03:35:57', '2020-08-10 03:35:57'),
(11, 17, 'BG0A12', 1, 1, NULL, '678956709', 'sara@gmail.com', 'camsick', 'BG0A12.jpg', '2020-08-07', 'Female', '2020-08-10 03:49:44', '2020-08-10 03:49:44'),
(13, 20, 'BG0A13', 1, 1, 1, '567898789', 'magaza.noel@gmail.com', 'Limbe Motto Park', 'BG0A13.jpg', '2020-08-07', 'Male', '2020-08-11 00:45:58', '2020-08-11 00:45:58'),
(14, 21, 'BG0A14', 1, 1, 1, NULL, NULL, NULL, 'BG0A14.jpg', '1997-01-17', 'Male', '2020-08-12 22:34:42', '2020-08-12 22:34:42'),
(15, 22, 'BG0A15', 1, 1, 1, '123454567', 'papa@gmail.com', 'molyko', 'BG0A15.jpg', '2019-12-12', 'Male', '2020-08-12 23:44:26', '2020-08-12 23:44:26'),
(16, 23, 'BG0A16', 1, 3, NULL, '123234356', 'ly@gmail.com', 'myea', 'BG0A16.jpg', '2020-08-12', 'Male', '2020-08-16 21:31:30', '2020-08-16 21:31:30'),
(17, 24, 'BG0A17', 1, 3, NULL, '678538564', NULL, 'small soppo buea cameroon', 'BG0A17.jpg', '2020-08-07', 'Male', '2020-08-16 21:34:26', '2020-08-16 21:34:26'),
(18, 25, 'BG0A18', 1, 3, NULL, '687754968', NULL, NULL, 'BG0A18.jpg', '2020-08-12', 'Male', '2020-08-16 21:36:02', '2020-08-16 21:36:02'),
(19, 26, 'BG0A19', 1, 3, 3, '123456567', NULL, 'camsic', 'BG0A19.jpg', '2020-08-12', 'Male', '2020-08-16 21:58:43', '2020-08-16 21:58:43');

-- --------------------------------------------------------

--
-- Table structure for table `studentresults`
--

CREATE TABLE `studentresults` (
  `id` int(10) UNSIGNED NOT NULL,
  `year_id` int(10) UNSIGNED NOT NULL,
  `term_id` int(10) UNSIGNED NOT NULL,
  `form_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `student_school_id` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `average_point` decimal(6,2) DEFAULT NULL,
  `sum_coff` decimal(6,2) DEFAULT NULL,
  `stud_ave` decimal(6,2) DEFAULT NULL,
  `position` int(5) DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `studentresults`
--

INSERT INTO `studentresults` (`id`, `year_id`, `term_id`, `form_id`, `student_id`, `student_school_id`, `average_point`, `sum_coff`, `stud_ave`, `position`, `remark`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 3, 6, 'BG0A03', '151.90', '16.00', '9.49', 4, NULL, '2020-08-23 12:59:58', '2020-08-23 15:50:14'),
(2, 1, 1, 3, 7, 'BG0A04', '126.65', '16.00', '7.92', 7, NULL, '2020-08-23 12:59:58', '2020-08-23 15:50:14'),
(3, 1, 1, 3, 8, 'BG0A05', '134.80', '16.00', '8.43', 6, NULL, '2020-08-23 12:59:58', '2020-08-23 15:50:14'),
(4, 1, 1, 3, 9, 'BG0A06', '187.50', '16.00', '11.72', 1, NULL, '2020-08-23 12:59:58', '2020-08-23 15:50:14'),
(5, 1, 1, 3, 23, 'BG0A16', '145.25', '16.00', '9.08', 5, NULL, '2020-08-23 12:59:59', '2020-08-23 15:50:14'),
(6, 1, 1, 3, 24, 'BG0A17', '118.20', '16.00', '7.39', 8, NULL, '2020-08-23 12:59:59', '2020-08-23 15:50:14'),
(7, 1, 1, 3, 25, 'BG0A18', '176.80', '16.00', '11.05', 2, NULL, '2020-08-23 12:59:59', '2020-08-23 15:50:14'),
(8, 1, 1, 3, 26, 'BG0A19', '154.00', '16.00', '9.63', 3, NULL, '2020-08-23 12:59:59', '2020-08-23 15:50:14');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_enrolled` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `full_name`, `school_id`, `email`, `password`, `date_enrolled`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'Baron Digo', 'FM1A001', 'baron.noelino@gmail.com', '$2y$10$uPBNyOvPHJH7t0ZwpyJLxeosEXs/hGNQCZI4XCzsXi/aKLPjKTQDW', '12/07/2020', NULL, '2020-06-26 08:12:13', '2020-06-26 08:12:13'),
(5, 'noel Magaza', 'BG0A02', 'noel@gmail.com', '$2y$10$jsRJF1xrybHpk9DYH.aVBOSOhWfsHqZ5MZuidUAHxgy3rMvvNT3mW', 'Wed, 08 Jul 2020 04:15am', NULL, '2020-07-08 03:15:24', '2020-07-08 03:15:24'),
(6, 'John calvine', 'BG0A03', NULL, '$2y$10$YfGvI7a1QJ8jjGmJvluVx.T6jGv1yNgMuztajZ0CL3XOB/V4k3Xp6', 'Wed, 08 Jul 2020 13:09pm', NULL, '2020-07-08 12:09:33', '2020-07-08 12:09:33'),
(7, 'Nguti Queen', 'BG0A04', 'queen@gmail.com', '$2y$10$gnO8op79B5WgILK7S.SHwu8QOvsI/NY0INw/UQnB.tTKKX/MyR6Qy', 'Fri, 10 Jul 2020 23:25pm', NULL, '2020-07-10 22:25:02', '2020-07-10 22:25:02'),
(8, 'noelino Coffe', 'BG0A05', NULL, '$2y$10$Brfq6nFYanC.28bnZyovPet0WsyG01tCBAV.5kNCX/nprylhoPMpm', 'Sun, 12 Jul 2020 19:53pm', NULL, '2020-07-12 18:53:59', '2020-07-12 18:53:59'),
(9, 'Stephany Stella', 'BG0A06', 'stella@gmail.com', '$2y$10$6msXI.BSivy8CvU1DHPZvuKejPZ0XR2.3Ht4HdY0qi29PqFUDpdyi', 'Thu, 16 Jul 2020 01:17am', NULL, '2020-07-16 00:17:22', '2020-07-16 00:17:22'),
(10, 'Enow Florence', 'BG0A07', 'enow@gmail.com', '$2y$10$efQG5UxYIJ6eUJCnO3z8IOepSjo0WRjUqRBEuC10QaQisDa.8UZsG', 'Thu, 30 Jul 2020 15:27pm', NULL, '2020-07-30 14:27:11', '2020-07-30 14:27:11'),
(13, 'Anastasia Melani', 'BG0A08', 'ana@gmail.com', '$2y$10$OMS3Vyg0W3E1X4wnI9sDfu7WOp62NJsOnQmxBEpF1RF6.DQaYBI7i', 'Fri, 07 Aug 2020 19:44pm', NULL, '2020-08-07 18:44:57', '2020-08-07 18:44:57'),
(14, 'Ewang Clarks', 'BG0A09', 'ewang@gmail.com', '$2y$10$m8nunP7RIWm2jQTYr7PIQu1DAoqsJ182NsRauxNf3TOfTgGXINsVm', 'Fri, 07 Aug 2020 19:49pm', NULL, '2020-08-07 18:49:52', '2020-08-07 18:49:52'),
(15, 'Tawa Peggy', 'BG0A10', 'tawa@gmail.com', '$2y$10$epoIHRpYcXmRQYbruU2Vs.cKnlFSsdAHe60rEGH17W9GuDhf.msSK', 'Mon, 10 Aug 2020 04:34am', NULL, '2020-08-10 03:34:16', '2020-08-10 03:34:16'),
(16, 'will it', 'BG0A11', 'will@example.mail', '$2y$10$LmnR3TGegI2NGk9cdWCWxOgI/D7CsntXEWR.zLbIUR74aqc6rT/x.', 'Mon, 10 Aug 2020 04:35am', NULL, '2020-08-10 03:35:57', '2020-08-10 03:35:57'),
(17, 'Sarafine', 'BG0A12', 'Folebe@gmail.com', '$2y$10$A2wHhiwcZOmU4i.DBBj50uw5teKaa2swTG1w1x6q8xwmPEEj9zK5a', 'Mon, 10 Aug 2020 04:49am', NULL, '2020-08-10 03:49:44', '2020-08-10 03:49:44'),
(20, 'Elisabeth', 'BG0A13', 'eli@gmail.com', '$2y$10$lvBnCRmNT/blFZoIFqB0yOCpIAEQCpwuKXWQYMzuQIIIvmnz93s0u', 'Tue, 11 Aug 2020 01:45am', NULL, '2020-08-11 00:45:58', '2020-08-11 00:45:58'),
(21, 'Divine man', 'BG0A14', 'dovine@gmail.com', '$2y$10$9GVLjj2MBFL8jZeRnDL6X.aW4VFytVOopI7TDWDTGkkmydyqxwBR2', 'Wed, 12 Aug 2020 23:34pm', NULL, '2020-08-12 22:34:42', '2020-08-12 22:34:42'),
(22, 'New Stuent', 'BG0A15', 'student@gmail.com', '$2y$10$w.CxipsxUwKhyweprV8G3O9x2uPk8EfdKfoEbpeuO.OSV20zs.PHK', 'Thu, 13 Aug 2020 00:44am', NULL, '2020-08-12 23:44:26', '2020-08-12 23:44:26'),
(23, 'Andy Leroyl', 'BG0A16', 'andy@gmail.com', '$2y$10$4T7mQrqcZZIwYY9Qk0OgG.QYzuGfStgrDs3hqSI2jU0M0d6H35fQO', 'Sun, 16 Aug 2020 22:31pm', NULL, '2020-08-16 21:31:30', '2020-08-16 21:31:30'),
(24, 'Eukaria Joshua', 'BG0A17', 'ueka@gmail.com', '$2y$10$HklRBx3gveyfopeChqD7sODa8bNbOw4Wu83FmO32y4hMOyMe99ah.', 'Sun, 16 Aug 2020 22:34pm', NULL, '2020-08-16 21:34:26', '2020-08-16 21:34:26'),
(25, 'Etima Joshua', 'BG0A18', 'uek@gmail.com', '$2y$10$DYUvXjo1PWqF04KQpY2KI.ZwNxRHpGOrnEGX/mEW5IRU2/bBdXzaa', 'Sun, 16 Aug 2020 22:36pm', NULL, '2020-08-16 21:36:02', '2020-08-16 21:36:02'),
(26, 'George', 'BG0A19', 'gg@gmail.com', '$2y$10$zCYdouDa9BfQDJCmNguK2eeVkDlIrcKst2bwdZvQVMkNVNS.7v4Ie', 'Sun, 16 Aug 2020 22:58pm', NULL, '2020-08-16 21:58:43', '2020-08-16 21:58:43');

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
(1, 1, 'B', 4, '2020-07-07 01:55:57', '2020-07-07 01:55:57'),
(3, 3, 'B', 2, '2020-08-16 21:38:06', '2020-08-16 21:38:06');

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
(1, 'Biology comprehosive internal', 'bio101', 1, 2, '2020-07-09 23:51:22', '2020-07-09 23:51:22'),
(2, 'Chemistry', 'chem01', 1, 2, '2020-07-09 23:59:56', '2020-07-09 23:59:56'),
(3, 'History', 'his01', 1, 2, '2020-07-16 22:07:44', '2020-07-16 22:07:44'),
(4, 'Mathematics', 'mat03', 4, 4, '2020-07-17 01:01:14', '2020-07-17 01:01:14'),
(5, 'Mathematics', 'mat02', 3, 3, '2020-07-17 01:01:41', '2020-07-17 01:01:41'),
(6, 'Mathematics', 'mat01', 1, 4, '2020-08-14 22:46:26', '2020-08-14 22:46:26'),
(7, 'English', 'ENG01', 1, 4, '2020-08-14 22:50:35', '2020-08-14 22:50:35'),
(8, 'Physics', 'phy01', 1, 2, '2020-08-14 22:51:51', '2020-08-14 22:51:51'),
(9, 'French', 'fre01', 1, 4, '2020-08-14 22:52:49', '2020-08-14 22:52:49'),
(10, 'Geography', 'geo01', 1, 2, '2020-08-14 22:53:43', '2020-08-14 22:53:43'),
(11, 'English', 'ENG02', 3, 3, '2020-08-16 21:27:05', '2020-08-16 21:27:05'),
(12, 'Geography', 'GEO02', 3, 2, '2020-08-16 21:27:26', '2020-08-16 21:27:26'),
(13, 'History', 'HIS02', 3, 2, '2020-08-16 21:27:51', '2020-08-16 21:27:51'),
(14, 'Economics', 'ECN02', 3, 2, '2020-08-16 21:28:13', '2020-08-16 21:28:13'),
(15, 'French', 'FRE02', 3, 4, '2020-08-16 21:28:35', '2020-08-16 21:28:35');

-- --------------------------------------------------------

--
-- Table structure for table `subject_teacher`
--

CREATE TABLE `subject_teacher` (
  `id` int(10) UNSIGNED NOT NULL,
  `subject_id` int(10) UNSIGNED NOT NULL,
  `teacher_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subject_teacher`
--

INSERT INTO `subject_teacher` (`id`, `subject_id`, `teacher_id`, `created_at`, `updated_at`) VALUES
(9, 4, 3, NULL, NULL),
(10, 5, 3, NULL, NULL),
(11, 1, 1, NULL, NULL),
(12, 2, 1, NULL, NULL),
(13, 15, 1, NULL, NULL);

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
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `full_name`, `user_name`, `profile`, `date_of_birth`, `gender`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'John Calvin', 'paul', 'default.png', NULL, 'Male', 'paul@gmail.com', '$2y$10$AkEnPO60.B4QCm20u5.A1uAS8QWIpcHReIxRVyDN319/4VmIC24fm', NULL, '2020-06-26 22:44:54', '2020-06-26 22:44:54'),
(2, 'Lucien Magaza', 'lucien', 'lucien.jpg', '5555-02-05', 'Male', 'lucien@gmail.com', '$2y$10$ET2HJ4wUtBsK0YQXY2ty3uuMSlB1dHGqdjIujwDeVuydq7nIkMEq2', NULL, '2020-07-16 22:53:07', '2020-07-16 22:53:07'),
(3, 'Claris Busi', 'Busi', 'Busi.jpg', '2002-02-23', 'Female', 'busi@gmail.com', '$2y$10$aNRSB8RgIZNXph1HN9HMtuOUGwfKszNsKUlAU/5aV6CuDUrsbG6rG', NULL, '2020-07-17 01:04:40', '2020-07-17 01:04:40'),
(4, 'Muyal Magaza', 'Muyal', 'Muyal.jpg', '2003-12-13', 'Male', 'muyal@gmail.com', '$2y$10$G73FUJPmJ40zr0AaUwm4OuXhPh5tuDsx9SDtC6mq2YRrq2RB/wR/i', NULL, '2020-07-17 01:06:18', '2020-07-17 01:06:18'),
(5, 'Tawa Peggy', 'peggy', 'peggy.jpg', '2000-02-22', 'Female', 'tawa@peggy.com', '$2y$10$WgBow6KdY4Ye/DEplrJF4uYelGaCs7iFSS1ddy3kUNn2yTOC.b1Xu', NULL, '2020-08-01 18:16:11', '2020-08-01 18:16:11');

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
  `subject_id` int(10) UNSIGNED NOT NULL,
  `seq5` decimal(6,1) DEFAULT NULL,
  `seq6` decimal(6,1) DEFAULT NULL,
  `ave_point` decimal(6,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Indexes for table `expensetypes`
--
ALTER TABLE `expensetypes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expensetypes_year_id_foreign` (`year_id`),
  ADD KEY `expensetypes_term_id_foreign` (`term_id`);

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
  ADD KEY `subject_teacher_teacher_id_foreign` (`teacher_id`);

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
-- AUTO_INCREMENT for table `backgrounds`
--
ALTER TABLE `backgrounds`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `disciplines`
--
ALTER TABLE `disciplines`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `expensetypes`
--
ALTER TABLE `expensetypes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feecontrols`
--
ALTER TABLE `feecontrols`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `feetypes`
--
ALTER TABLE `feetypes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `firsttermresults`
--
ALTER TABLE `firsttermresults`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `generateresults`
--
ALTER TABLE `generateresults`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

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
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `scholarships`
--
ALTER TABLE `scholarships`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `secondtermresults`
--
ALTER TABLE `secondtermresults`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sectors`
--
ALTER TABLE `sectors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sequences`
--
ALTER TABLE `sequences`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `studentdisciplines`
--
ALTER TABLE `studentdisciplines`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `studentinfos`
--
ALTER TABLE `studentinfos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `studentresults`
--
ALTER TABLE `studentresults`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `subclasses`
--
ALTER TABLE `subclasses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `subject_teacher`
--
ALTER TABLE `subject_teacher`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `terms`
--
ALTER TABLE `terms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `thirdtermresults`
--
ALTER TABLE `thirdtermresults`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `years`
--
ALTER TABLE `years`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
-- Constraints for table `backgrounds`
--
ALTER TABLE `backgrounds`
  ADD CONSTRAINT `backgrounds_sector_id_foreign` FOREIGN KEY (`sector_id`) REFERENCES `sectors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `expensetypes`
--
ALTER TABLE `expensetypes`
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
  ADD CONSTRAINT `forms_background_id_foreign` FOREIGN KEY (`background_id`) REFERENCES `backgrounds` (`id`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `subject_teacher_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE;

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
