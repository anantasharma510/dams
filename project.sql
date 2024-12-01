-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2024 at 04:24 PM
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
-- Database: `dams`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password_hash`) VALUES
(1, 'admin', '$2y$10$nQA1D0W.HtgvgoJuA5w2IuHpi4pCFD87HM4DqD18NiUjJM2BO1ERu');

-- --------------------------------------------------------

--
-- Table structure for table `admin_login_history`
--

CREATE TABLE `admin_login_history` (
  `login_id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_login_history`
--

INSERT INTO `admin_login_history` (`login_id`, `admin_id`, `login_time`) VALUES
(1, 1, '2024-08-26 10:44:07'),
(2, 1, '2024-08-30 09:41:12'),
(3, 1, '2024-08-30 11:30:40'),
(4, 1, '2024-08-30 11:53:18'),
(5, 1, '2024-08-30 12:25:41'),
(6, 1, '2024-08-30 15:07:14'),
(7, 1, '2024-08-30 15:41:36'),
(8, 1, '2024-08-30 15:44:15'),
(9, 1, '2024-08-30 16:37:20'),
(10, 1, '2024-08-30 16:39:32'),
(11, 1, '2024-08-31 11:16:11'),
(12, 1, '2024-08-31 12:18:12'),
(13, 1, '2024-08-31 12:54:29'),
(14, 1, '2024-08-31 12:55:08'),
(15, 1, '2024-08-31 12:56:50'),
(16, 1, '2024-08-31 13:23:30'),
(17, 1, '2024-08-31 13:24:19'),
(18, 1, '2024-08-31 13:31:03'),
(19, 1, '2024-08-31 13:36:46'),
(20, 1, '2024-08-31 13:38:48'),
(21, 1, '2024-08-31 16:05:58'),
(22, 1, '2024-08-31 16:08:47'),
(23, 1, '2024-08-31 16:45:06'),
(24, 1, '2024-08-31 16:47:19'),
(25, 1, '2024-08-31 16:50:34'),
(26, 1, '2024-09-01 07:10:03'),
(27, 1, '2024-09-01 07:10:41'),
(28, 1, '2024-09-01 07:21:11'),
(29, 1, '2024-09-01 08:05:27'),
(30, 1, '2024-09-01 08:07:54'),
(31, 1, '2024-09-01 08:17:35'),
(32, 1, '2024-09-01 08:19:22'),
(33, 1, '2024-09-01 08:24:19'),
(34, 1, '2024-09-01 08:25:46'),
(35, 1, '2024-09-01 08:26:18'),
(36, 1, '2024-09-01 08:46:44'),
(37, 1, '2024-09-01 08:50:53'),
(38, 1, '2024-09-01 08:51:37'),
(39, 1, '2024-09-01 08:53:09'),
(40, 1, '2024-09-01 08:53:51'),
(41, 1, '2024-09-01 09:13:12'),
(42, 1, '2024-09-01 09:19:13'),
(43, 1, '2024-09-01 10:53:13'),
(44, 1, '2024-09-01 13:30:53'),
(45, 1, '2024-09-01 13:41:48'),
(46, 1, '2024-09-01 13:59:24'),
(47, 1, '2024-09-01 14:28:54'),
(48, 1, '2024-09-02 06:23:47'),
(49, 1, '2024-09-02 12:05:44'),
(50, 1, '2024-09-02 13:21:14'),
(51, 1, '2024-09-02 13:31:12'),
(52, 1, '2024-09-03 10:31:07'),
(53, 1, '2024-09-03 12:15:05'),
(54, 1, '2024-09-03 12:37:36'),
(55, 1, '2024-09-03 13:02:49'),
(56, 1, '2024-09-03 14:37:38'),
(57, 1, '2024-09-03 14:57:17'),
(58, 1, '2024-09-03 15:00:45'),
(59, 1, '2024-09-03 15:13:09'),
(60, 1, '2024-09-05 15:22:57'),
(61, 1, '2024-09-05 15:35:09'),
(62, 1, '2024-09-05 15:38:14'),
(63, 1, '2024-09-09 13:47:32'),
(64, 1, '2024-09-09 14:26:14'),
(65, 1, '2024-09-10 11:36:14'),
(66, 1, '2024-09-10 14:36:32'),
(67, 1, '2024-09-11 12:44:11'),
(68, 1, '2024-09-18 04:15:23'),
(69, 1, '2024-09-21 05:03:34'),
(70, 1, '2024-09-23 04:50:43'),
(71, 1, '2024-09-25 11:30:00'),
(72, 1, '2024-09-25 11:36:54'),
(73, 1, '2024-10-07 09:50:49'),
(74, 1, '2024-10-08 06:58:25'),
(75, 1, '2024-10-09 02:05:38'),
(76, 1, '2024-10-09 13:38:04'),
(77, 1, '2024-10-15 08:26:29'),
(78, 1, '2024-10-16 05:46:35'),
(79, 1, '2024-10-16 07:01:49'),
(80, 1, '2024-10-16 12:29:42'),
(81, 1, '2024-10-17 06:27:41'),
(82, 1, '2024-10-17 08:26:24'),
(83, 1, '2024-10-17 10:20:39'),
(84, 1, '2024-10-30 11:02:21'),
(85, 1, '2024-11-21 12:19:44'),
(86, 1, '2024-11-22 14:01:28'),
(87, 1, '2024-11-25 05:08:49'),
(88, 1, '2024-12-01 06:22:31'),
(89, 1, '2024-12-01 15:15:43');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `doctorSpecialization` varchar(255) DEFAULT NULL,
  `doctorId` int(11) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  `consultancyFees` int(11) DEFAULT NULL,
  `appointmentDate` date DEFAULT NULL,
  `appointmentTime` time NOT NULL,
  `postingDate` timestamp NULL DEFAULT current_timestamp(),
  `userStatus` int(11) DEFAULT NULL,
  `doctorStatus` int(11) DEFAULT NULL,
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `status` enum('pending','approved') NOT NULL DEFAULT 'pending',
  `visitStatus` enum('pending','visited','not visited') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `doctorSpecialization`, `doctorId`, `userId`, `consultancyFees`, `appointmentDate`, `appointmentTime`, `postingDate`, `userStatus`, `doctorStatus`, `updationDate`, `status`, `visitStatus`) VALUES
(1, NULL, 1, 1, 100, '2024-10-18', '00:00:00', '2024-10-15 10:31:17', 1, 1, '2024-10-16 07:36:44', 'approved', 'visited'),
(2, NULL, 1, 1, 100, '2024-10-19', '00:00:00', '2024-10-15 10:35:31', 1, 1, '2024-11-25 05:10:01', 'approved', 'visited'),
(3, NULL, 3, 1, 90, '2024-10-12', '00:00:00', '2024-10-15 10:41:30', 1, 1, '2024-10-16 07:12:33', 'approved', 'pending'),
(4, NULL, 4, 1, 150, '2024-10-15', '00:00:00', '2024-10-15 11:02:38', 1, 1, '2024-10-16 07:12:35', 'approved', 'pending'),
(5, NULL, 2, 9, 120, '2024-10-15', '00:00:00', '2024-10-15 11:05:27', 1, 1, '2024-10-15 11:11:14', 'approved', 'pending'),
(6, NULL, 3, 9, 90, '2024-10-15', '00:00:00', '2024-10-15 12:14:04', 1, 1, '2024-10-16 07:12:34', 'approved', 'pending'),
(7, NULL, 1, 9, 100, '2024-10-16', '00:00:00', '2024-10-15 12:19:22', 1, 1, '2024-11-25 05:10:03', 'approved', 'visited'),
(8, NULL, 8, 9, 1500, '2024-10-10', '00:00:00', '2024-10-16 08:09:02', 1, 1, '2024-10-16 12:30:52', 'approved', 'pending'),
(9, NULL, 6, 9, 1500, '2024-10-17', '00:00:00', '2024-10-17 07:22:26', 1, 1, '2024-10-17 07:23:05', 'approved', 'visited'),
(10, NULL, 8, 9, 1500, '2024-10-19', '00:00:00', '2024-10-17 10:01:45', 1, 1, '2024-11-21 12:45:02', 'approved', 'pending'),
(11, NULL, 2, 9, 120, '2024-10-16', '00:00:00', '2024-10-17 11:19:39', 1, 1, '2024-10-17 11:20:09', 'approved', 'pending'),
(12, NULL, 6, 9, 1500, '2024-10-28', '00:00:00', '2024-10-30 12:10:43', 1, 1, '2024-11-25 05:11:15', 'approved', 'pending'),
(13, NULL, 1, 9, 100, '2024-10-25', '00:00:00', '2024-10-30 12:16:07', 1, 1, '2024-11-25 05:11:14', 'approved', 'visited'),
(14, NULL, 8, 9, 1500, '2024-10-31', '00:00:00', '2024-11-21 12:44:45', 1, 1, '2024-11-21 12:45:00', 'approved', 'pending'),
(15, '1', 1, 9, 100, '0000-00-00', '11:00:00', '2024-11-25 05:55:01', NULL, NULL, '2024-11-25 06:32:38', 'approved', 'not visited'),
(16, '1', 1, 9, 100, '0000-00-00', '11:00:00', '2024-11-25 05:55:10', NULL, NULL, '2024-11-25 06:32:39', 'approved', 'not visited'),
(17, '1', 1, 9, 100, '0000-00-00', '11:00:00', '2024-11-25 05:55:20', NULL, NULL, '2024-11-25 06:32:41', 'approved', 'not visited');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `doctorName` varchar(255) DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `docFees` varchar(255) DEFAULT NULL,
  `contactno` bigint(11) DEFAULT NULL,
  `docEmail` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `specilization_id` int(11) NOT NULL,
  `specialization` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `doctorName`, `address`, `docFees`, `contactno`, `docEmail`, `password`, `creationDate`, `updationDate`, `specilization_id`, `specialization`) VALUES
(1, 'Dr. John Smith', '123 Main St, Cityville', '100', 1234567890, 'john.smith@example.com', 'password123', '2024-10-15 10:27:14', '2024-10-16 06:14:11', 1, 'Cardiology'),
(2, 'Dr. Jane Doe', '456 Elm St, Townsville', '120', 2345678901, 'jane.doe@example.com', 'password123', '2024-10-15 10:27:14', '2024-10-16 06:14:11', 2, 'Dermatology'),
(3, 'Dr. Emily White', '789 Pine St, Villageburg', '90', 3456789012, 'emily.white@example.com', 'password123', '2024-10-15 10:27:14', '2024-10-16 06:14:11', 3, 'Pediatrics'),
(4, 'Dr. Michael Brown', '321 Oak St, Hamletville', '150', 4567890123, 'michael.brown@example.com', 'password123', '2024-10-15 10:27:14', '2024-10-16 06:14:11', 4, 'Neurology'),
(5, 'Dr. Sarah Johnson', '654 Maple St, Metropolis', '110', 5678901234, 'sarah.johnson@example.com', 'password123', '2024-10-15 10:27:14', '2024-10-16 06:14:11', 5, 'Orthopedics'),
(6, 'tsettttttttttt', 'fdds', '1500', 12345678909, 'nst@gmail.com', 'doc123456', '2024-10-16 05:56:59', '2024-10-16 07:09:41', 4, 'Neurology'),
(7, 'Ananta Sharma', 'kjhj', '1500', 12345678909, 'a@gmail.com', 'a@123456', '2024-10-16 06:02:03', '2024-10-16 06:14:11', 4, 'Neurology'),
(8, 'samir', 'jbdjd', '1500', 12345678909, 't@gmail.com', 'doc@12345', '2024-10-16 06:20:34', NULL, 2, NULL),
(9, 'srd', 'vj', '1500', 12345678909, 'tt@gmail.com', 'tt123456', '2024-10-16 06:24:21', '2024-10-16 07:09:58', 1, 'Cardiology');

-- --------------------------------------------------------

--
-- Table structure for table `doctorspecilization`
--

CREATE TABLE `doctorspecilization` (
  `id` int(11) NOT NULL,
  `specilization` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `doctorspecilization`
--

INSERT INTO `doctorspecilization` (`id`, `specilization`, `creationDate`, `updationDate`) VALUES
(1, 'Cardiology', '2024-10-15 10:27:00', '2024-10-17 08:36:36'),
(2, 'Dermatology', '2024-10-15 10:27:00', NULL),
(3, 'Pediatrics', '2024-10-15 10:27:00', NULL),
(4, 'Neurology', '2024-10-15 10:27:00', NULL),
(5, 'Orthopedics', '2024-10-15 10:27:00', NULL),
(6, 'hypotomology', '2024-10-16 05:48:46', '2024-10-16 05:50:35');

-- --------------------------------------------------------

--
-- Table structure for table `doctors_schedule`
--

CREATE TABLE `doctors_schedule` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `day_of_week` varchar(10) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctor_availability`
--

CREATE TABLE `doctor_availability` (
  `id` int(11) NOT NULL,
  `doctorId` int(11) NOT NULL,
  `day` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor_availability`
--

INSERT INTO `doctor_availability` (`id`, `doctorId`, `day`) VALUES
(11, 1, 'Thursday'),
(12, 1, 'Friday'),
(19, 6, 'Thursday'),
(20, 6, 'Friday'),
(25, 5, 'Wednesday'),
(26, 5, 'Thursday'),
(47, 9, 'Thursday'),
(48, 9, 'Friday'),
(56, 7, 'Wednesday'),
(57, 7, 'Thursday'),
(63, 2, 'Wednesday'),
(64, 2, 'Thursday');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_login_history`
--

CREATE TABLE `doctor_login_history` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `doctor_login_history`
--

INSERT INTO `doctor_login_history` (`id`, `doctor_id`, `login_time`) VALUES
(1, 0, '2024-09-10 14:24:31'),
(2, 0, '2024-09-10 14:30:30'),
(3, 0, '2024-09-18 04:17:58'),
(4, 0, '2024-09-21 11:04:05'),
(5, 1, '2024-09-21 11:46:03'),
(6, 0, '2024-09-21 11:54:22'),
(7, 0, '2024-09-21 11:54:22'),
(8, 0, '2024-09-21 12:07:01'),
(9, 0, '2024-09-23 04:50:59'),
(10, 0, '2024-09-23 12:39:37'),
(11, 0, '2024-09-25 11:46:17'),
(12, 0, '2024-10-08 12:57:48'),
(13, 1, '2024-10-08 13:32:42'),
(14, 0, '2024-10-09 02:14:35'),
(15, 0, '2024-10-09 14:02:05'),
(16, 0, '2024-10-15 08:26:57'),
(17, 1, '2024-10-16 07:27:19'),
(18, 6, '2024-10-17 06:00:44'),
(19, 1, '2024-11-25 05:09:44');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_slots`
--

CREATE TABLE `doctor_slots` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `available_date` date NOT NULL,
  `slot_time` time NOT NULL,
  `is_booked` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor_slots`
--

INSERT INTO `doctor_slots` (`id`, `doctor_id`, `available_date`, `slot_time`, `is_booked`) VALUES
(1, 0, '2024-10-21', '09:00:00', 0),
(2, 0, '2024-10-21', '09:15:00', 0),
(3, 0, '2024-10-21', '09:30:00', 0),
(4, 0, '2024-10-21', '09:45:00', 0),
(5, 0, '2024-10-21', '10:00:00', 0),
(6, 0, '2024-10-21', '10:15:00', 0),
(7, 0, '2024-10-21', '10:30:00', 0),
(8, 0, '2024-10-21', '10:45:00', 0),
(9, 0, '2024-10-21', '11:00:00', 0),
(10, 0, '2024-10-21', '11:15:00', 0),
(11, 0, '2024-10-21', '11:30:00', 0),
(12, 0, '2024-10-21', '11:45:00', 0),
(13, 0, '2024-10-21', '12:00:00', 0),
(14, 0, '2024-10-21', '12:15:00', 0),
(15, 0, '2024-10-21', '12:30:00', 0),
(16, 0, '2024-10-21', '12:45:00', 0),
(17, 0, '2024-10-21', '13:00:00', 0),
(18, 0, '2024-10-21', '13:15:00', 0),
(19, 0, '2024-10-21', '13:30:00', 0),
(20, 0, '2024-10-21', '13:45:00', 0),
(21, 0, '2024-10-21', '14:00:00', 0),
(22, 0, '2024-10-21', '14:15:00', 0),
(23, 0, '2024-10-21', '14:30:00', 0),
(24, 0, '2024-10-21', '14:45:00', 0),
(25, 0, '2024-10-21', '15:00:00', 0),
(26, 0, '2024-10-21', '15:15:00', 0),
(27, 0, '2024-10-21', '15:30:00', 0),
(28, 0, '2024-10-21', '15:45:00', 0),
(29, 0, '2024-10-21', '16:00:00', 0),
(30, 0, '2024-10-21', '16:15:00', 0),
(31, 0, '2024-10-21', '16:30:00', 0),
(32, 0, '2024-10-21', '16:45:00', 0),
(33, 0, '2024-10-21', '17:00:00', 0),
(34, 0, '2024-10-21', '17:15:00', 0),
(35, 0, '2024-10-21', '17:30:00', 0),
(36, 0, '2024-10-21', '17:45:00', 0),
(37, 0, '2024-10-21', '18:00:00', 0),
(38, 0, '2024-10-21', '18:15:00', 0),
(39, 0, '2024-10-21', '18:30:00', 0),
(40, 0, '2024-10-21', '18:45:00', 0),
(41, 0, '2024-10-21', '19:00:00', 0),
(42, 0, '2024-10-21', '19:15:00', 0),
(43, 0, '2024-10-21', '19:30:00', 0),
(44, 0, '2024-10-21', '19:45:00', 0),
(45, 0, '2024-10-21', '20:00:00', 0),
(46, 0, '2024-10-21', '20:15:00', 0),
(47, 0, '2024-10-21', '20:30:00', 0),
(48, 0, '2024-10-21', '20:45:00', 0),
(49, 0, '2024-10-21', '21:00:00', 0),
(50, 0, '2024-10-21', '21:15:00', 0),
(51, 0, '2024-10-21', '21:30:00', 0),
(52, 0, '2024-10-21', '21:45:00', 0),
(53, 0, '2024-10-21', '22:00:00', 0),
(54, 0, '2024-10-21', '22:15:00', 0),
(55, 0, '2024-10-21', '22:30:00', 0),
(56, 0, '2024-10-21', '22:45:00', 0),
(57, 0, '2024-10-21', '23:00:00', 0),
(58, 0, '2024-10-21', '23:15:00', 0),
(59, 0, '2024-10-21', '23:30:00', 0),
(60, 0, '2024-10-21', '23:45:00', 0),
(61, 0, '2024-10-23', '09:00:00', 0),
(62, 0, '2024-10-23', '09:15:00', 0),
(63, 0, '2024-10-23', '09:30:00', 0),
(64, 0, '2024-10-23', '09:45:00', 0),
(65, 0, '2024-10-23', '10:00:00', 0),
(66, 0, '2024-10-23', '10:15:00', 0),
(67, 0, '2024-10-23', '10:30:00', 0),
(68, 0, '2024-10-23', '10:45:00', 0),
(69, 0, '2024-10-23', '11:00:00', 0),
(70, 0, '2024-10-23', '11:15:00', 0),
(71, 0, '2024-10-23', '11:30:00', 0),
(72, 0, '2024-10-23', '11:45:00', 0),
(73, 0, '2024-10-23', '12:00:00', 0),
(74, 0, '2024-10-23', '12:15:00', 0),
(75, 0, '2024-10-23', '12:30:00', 0),
(76, 0, '2024-10-23', '12:45:00', 0),
(77, 0, '2024-10-23', '13:00:00', 0),
(78, 0, '2024-10-23', '13:15:00', 0),
(79, 0, '2024-10-23', '13:30:00', 0),
(80, 0, '2024-10-23', '13:45:00', 0),
(81, 0, '2024-10-23', '14:00:00', 0),
(82, 0, '2024-10-23', '14:15:00', 0),
(83, 0, '2024-10-23', '14:30:00', 0),
(84, 0, '2024-10-23', '14:45:00', 0),
(85, 0, '2024-10-23', '15:00:00', 0),
(86, 0, '2024-10-23', '15:15:00', 0),
(87, 0, '2024-10-23', '15:30:00', 0),
(88, 0, '2024-10-23', '15:45:00', 0),
(89, 0, '2024-10-23', '16:00:00', 0),
(90, 0, '2024-10-23', '16:15:00', 0),
(91, 0, '2024-10-23', '16:30:00', 0),
(92, 0, '2024-10-23', '16:45:00', 0),
(93, 0, '2024-10-23', '17:00:00', 0),
(94, 0, '2024-10-23', '17:15:00', 0),
(95, 0, '2024-10-23', '17:30:00', 0),
(96, 0, '2024-10-23', '17:45:00', 0),
(97, 0, '2024-10-23', '18:00:00', 0),
(98, 0, '2024-10-23', '18:15:00', 0),
(99, 0, '2024-10-23', '18:30:00', 0),
(100, 0, '2024-10-23', '18:45:00', 0),
(101, 0, '2024-10-23', '19:00:00', 0),
(102, 0, '2024-10-23', '19:15:00', 0),
(103, 0, '2024-10-23', '19:30:00', 0),
(104, 0, '2024-10-23', '19:45:00', 0),
(105, 0, '2024-10-23', '20:00:00', 0),
(106, 0, '2024-10-23', '20:15:00', 0),
(107, 0, '2024-10-23', '20:30:00', 0),
(108, 0, '2024-10-23', '20:45:00', 0),
(109, 0, '2024-10-23', '21:00:00', 0),
(110, 0, '2024-10-23', '21:15:00', 0),
(111, 0, '2024-10-23', '21:30:00', 0),
(112, 0, '2024-10-23', '21:45:00', 0),
(113, 0, '2024-10-23', '22:00:00', 0),
(114, 0, '2024-10-23', '22:15:00', 0),
(115, 0, '2024-10-23', '22:30:00', 0),
(116, 0, '2024-10-23', '22:45:00', 0),
(117, 0, '2024-10-23', '23:00:00', 0),
(118, 0, '2024-10-23', '23:15:00', 0),
(119, 0, '2024-10-23', '23:30:00', 0),
(120, 0, '2024-10-23', '23:45:00', 0),
(121, 0, '2024-10-25', '09:00:00', 0),
(122, 0, '2024-10-25', '09:15:00', 0),
(123, 0, '2024-10-25', '09:30:00', 0),
(124, 0, '2024-10-25', '09:45:00', 0),
(125, 0, '2024-10-25', '10:00:00', 0),
(126, 0, '2024-10-25', '10:15:00', 0),
(127, 0, '2024-10-25', '10:30:00', 0),
(128, 0, '2024-10-25', '10:45:00', 0),
(129, 0, '2024-10-25', '11:00:00', 0),
(130, 0, '2024-10-25', '11:15:00', 0),
(131, 0, '2024-10-25', '11:30:00', 0),
(132, 0, '2024-10-25', '11:45:00', 0),
(133, 0, '2024-10-25', '12:00:00', 0),
(134, 0, '2024-10-25', '12:15:00', 0),
(135, 0, '2024-10-25', '12:30:00', 0),
(136, 0, '2024-10-25', '12:45:00', 0),
(137, 0, '2024-10-25', '13:00:00', 0),
(138, 0, '2024-10-25', '13:15:00', 0),
(139, 0, '2024-10-25', '13:30:00', 0),
(140, 0, '2024-10-25', '13:45:00', 0),
(141, 0, '2024-10-25', '14:00:00', 0),
(142, 0, '2024-10-25', '14:15:00', 0),
(143, 0, '2024-10-25', '14:30:00', 0),
(144, 0, '2024-10-25', '14:45:00', 0),
(145, 0, '2024-10-25', '15:00:00', 0),
(146, 0, '2024-10-25', '15:15:00', 0),
(147, 0, '2024-10-25', '15:30:00', 0),
(148, 0, '2024-10-25', '15:45:00', 0),
(149, 0, '2024-10-25', '16:00:00', 0),
(150, 0, '2024-10-25', '16:15:00', 0),
(151, 0, '2024-10-25', '16:30:00', 0),
(152, 0, '2024-10-25', '16:45:00', 0),
(153, 0, '2024-10-25', '17:00:00', 0),
(154, 0, '2024-10-25', '17:15:00', 0),
(155, 0, '2024-10-25', '17:30:00', 0),
(156, 0, '2024-10-25', '17:45:00', 0),
(157, 0, '2024-10-25', '18:00:00', 0),
(158, 0, '2024-10-25', '18:15:00', 0),
(159, 0, '2024-10-25', '18:30:00', 0),
(160, 0, '2024-10-25', '18:45:00', 0),
(161, 0, '2024-10-25', '19:00:00', 0),
(162, 0, '2024-10-25', '19:15:00', 0),
(163, 0, '2024-10-25', '19:30:00', 0),
(164, 0, '2024-10-25', '19:45:00', 0),
(165, 0, '2024-10-25', '20:00:00', 0),
(166, 0, '2024-10-25', '20:15:00', 0),
(167, 0, '2024-10-25', '20:30:00', 0),
(168, 0, '2024-10-25', '20:45:00', 0),
(169, 0, '2024-10-25', '21:00:00', 0),
(170, 0, '2024-10-25', '21:15:00', 0),
(171, 0, '2024-10-25', '21:30:00', 0),
(172, 0, '2024-10-25', '21:45:00', 0),
(173, 0, '2024-10-25', '22:00:00', 0),
(174, 0, '2024-10-25', '22:15:00', 0),
(175, 0, '2024-10-25', '22:30:00', 0),
(176, 0, '2024-10-25', '22:45:00', 0),
(177, 0, '2024-10-25', '23:00:00', 0),
(178, 0, '2024-10-25', '23:15:00', 0),
(179, 0, '2024-10-25', '23:30:00', 0),
(180, 0, '2024-10-25', '23:45:00', 0),
(181, 0, '2024-10-26', '09:00:00', 0),
(182, 0, '2024-10-26', '09:15:00', 0),
(183, 0, '2024-10-26', '09:30:00', 0),
(184, 0, '2024-10-26', '09:45:00', 0),
(185, 0, '2024-10-26', '10:00:00', 0),
(186, 0, '2024-10-26', '10:15:00', 0),
(187, 0, '2024-10-26', '10:30:00', 0),
(188, 0, '2024-10-26', '10:45:00', 0),
(189, 0, '2024-10-26', '11:00:00', 0),
(190, 0, '2024-10-26', '11:15:00', 0),
(191, 0, '2024-10-26', '11:30:00', 0),
(192, 0, '2024-10-26', '11:45:00', 0),
(193, 0, '2024-10-26', '12:00:00', 0),
(194, 0, '2024-10-26', '12:15:00', 0),
(195, 0, '2024-10-26', '12:30:00', 0),
(196, 0, '2024-10-26', '12:45:00', 0),
(197, 0, '2024-10-26', '13:00:00', 0),
(198, 0, '2024-10-26', '13:15:00', 0),
(199, 0, '2024-10-26', '13:30:00', 0),
(200, 0, '2024-10-26', '13:45:00', 0),
(201, 0, '2024-10-26', '14:00:00', 0),
(202, 0, '2024-10-26', '14:15:00', 0),
(203, 0, '2024-10-26', '14:30:00', 0),
(204, 0, '2024-10-26', '14:45:00', 0),
(205, 0, '2024-10-26', '15:00:00', 0),
(206, 0, '2024-10-26', '15:15:00', 0),
(207, 0, '2024-10-26', '15:30:00', 0),
(208, 0, '2024-10-26', '15:45:00', 0),
(209, 0, '2024-10-26', '16:00:00', 0),
(210, 0, '2024-10-26', '16:15:00', 0),
(211, 0, '2024-10-26', '16:30:00', 0),
(212, 0, '2024-10-26', '16:45:00', 0),
(213, 0, '2024-10-26', '17:00:00', 0),
(214, 0, '2024-10-26', '17:15:00', 0),
(215, 0, '2024-10-26', '17:30:00', 0),
(216, 0, '2024-10-26', '17:45:00', 0),
(217, 0, '2024-10-26', '18:00:00', 0),
(218, 0, '2024-10-26', '18:15:00', 0),
(219, 0, '2024-10-26', '18:30:00', 0),
(220, 0, '2024-10-26', '18:45:00', 0),
(221, 0, '2024-10-26', '19:00:00', 0),
(222, 0, '2024-10-26', '19:15:00', 0),
(223, 0, '2024-10-26', '19:30:00', 0),
(224, 0, '2024-10-26', '19:45:00', 0),
(225, 0, '2024-10-26', '20:00:00', 0),
(226, 0, '2024-10-26', '20:15:00', 0),
(227, 0, '2024-10-26', '20:30:00', 0),
(228, 0, '2024-10-26', '20:45:00', 0),
(229, 0, '2024-10-26', '21:00:00', 0),
(230, 0, '2024-10-26', '21:15:00', 0),
(231, 0, '2024-10-26', '21:30:00', 0),
(232, 0, '2024-10-26', '21:45:00', 0),
(233, 0, '2024-10-26', '22:00:00', 0),
(234, 0, '2024-10-26', '22:15:00', 0),
(235, 0, '2024-10-26', '22:30:00', 0),
(236, 0, '2024-10-26', '22:45:00', 0),
(237, 0, '2024-10-26', '23:00:00', 0),
(238, 0, '2024-10-26', '23:15:00', 0),
(239, 0, '2024-10-26', '23:30:00', 0),
(240, 0, '2024-10-26', '23:45:00', 0),
(241, 0, '2024-10-12', '09:00:00', 0),
(242, 0, '2024-10-12', '09:15:00', 0),
(243, 0, '2024-10-12', '09:30:00', 0),
(244, 0, '2024-10-12', '09:45:00', 0),
(245, 0, '2024-10-12', '10:00:00', 0),
(246, 0, '2024-10-12', '10:15:00', 0),
(247, 0, '2024-10-12', '10:30:00', 0),
(248, 0, '2024-10-12', '10:45:00', 0),
(249, 0, '2024-10-12', '11:00:00', 0),
(250, 0, '2024-10-12', '11:15:00', 0),
(251, 0, '2024-10-12', '11:30:00', 0),
(252, 0, '2024-10-12', '11:45:00', 0),
(253, 0, '2024-10-12', '12:00:00', 0),
(254, 0, '2024-10-12', '12:15:00', 0),
(255, 0, '2024-10-12', '12:30:00', 0),
(256, 0, '2024-10-12', '12:45:00', 0),
(257, 0, '2024-10-12', '13:00:00', 0),
(258, 0, '2024-10-12', '13:15:00', 0),
(259, 0, '2024-10-12', '13:30:00', 0),
(260, 0, '2024-10-12', '13:45:00', 0),
(261, 0, '2024-10-12', '14:00:00', 0),
(262, 0, '2024-10-12', '14:15:00', 0),
(263, 0, '2024-10-12', '14:30:00', 0),
(264, 0, '2024-10-12', '14:45:00', 0),
(265, 0, '2024-10-12', '15:00:00', 0),
(266, 0, '2024-10-12', '15:15:00', 0),
(267, 0, '2024-10-12', '15:30:00', 0),
(268, 0, '2024-10-12', '15:45:00', 0),
(269, 0, '2024-10-12', '16:00:00', 0),
(270, 0, '2024-10-12', '16:15:00', 0),
(271, 0, '2024-10-12', '16:30:00', 0),
(272, 0, '2024-10-12', '16:45:00', 0),
(273, 0, '2024-10-12', '17:00:00', 0),
(274, 0, '2024-10-12', '17:15:00', 0),
(275, 0, '2024-10-12', '17:30:00', 0),
(276, 0, '2024-10-12', '17:45:00', 0),
(277, 0, '2024-10-12', '18:00:00', 0),
(278, 0, '2024-10-12', '18:15:00', 0),
(279, 0, '2024-10-12', '18:30:00', 0),
(280, 0, '2024-10-12', '18:45:00', 0),
(281, 0, '2024-10-12', '19:00:00', 0),
(282, 0, '2024-10-12', '19:15:00', 0),
(283, 0, '2024-10-12', '19:30:00', 0),
(284, 0, '2024-10-12', '19:45:00', 0),
(285, 0, '2024-10-12', '20:00:00', 0),
(286, 0, '2024-10-12', '20:15:00', 0),
(287, 0, '2024-10-12', '20:30:00', 0),
(288, 0, '2024-10-12', '20:45:00', 0),
(289, 0, '2024-10-12', '21:00:00', 0),
(290, 0, '2024-10-12', '21:15:00', 0),
(291, 0, '2024-10-12', '21:30:00', 0),
(292, 0, '2024-10-12', '21:45:00', 0),
(293, 0, '2024-10-12', '22:00:00', 0),
(294, 0, '2024-10-12', '22:15:00', 0),
(295, 0, '2024-10-12', '22:30:00', 0),
(296, 0, '2024-10-12', '22:45:00', 0),
(297, 0, '2024-10-12', '23:00:00', 0),
(298, 0, '2024-10-12', '23:15:00', 0),
(299, 0, '2024-10-12', '23:30:00', 0),
(300, 0, '2024-10-12', '23:45:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(100) NOT NULL,
  `expiry` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`id`, `email`, `token`, `expiry`) VALUES
(1, 'anantasharma510@gmail.com', 'a6237d34507f3cd019f05dd0b89163764ccd1c569b2a11f977fc0ac78ecc979762f856808ccee646378c78fed9a6f4f4d2d7', '2024-11-25 09:12:23'),
(2, 'anantasharma510@gmail.com', 'ccb3a5926b99d5a06e0e431dfe7b248c11c025ff6e132a7474b90833fe19c6074d61da15c23af9ab708845fbf047034a5192', '2024-11-25 09:14:48'),
(3, 'anantasharma510@gmail.com', '9a025f2a77c31c0c967507718839eed2f1530ccfc8ea9ac4d17e263f8ff5807f8b281cb6a89e0da7c284ef425b8ffe65ee6a', '2024-11-25 09:24:51'),
(4, 'anantasharma510@gmail.com', '1298f0cbd9277c017ab508a1b48d7f5c419dc86c2f5411335f9ede3556cc3a7283a98b153962952922198928fdbc1d0e3b50', '2024-11-25 09:24:54'),
(5, 'anantasharma510@gmail.com', '3a59356cd8380e6114b97282232eaedde14f5d90509b246ca64c647edd09319531b4424f542f5f391b7a50789f1a4eecbacd', '2024-11-25 09:26:07'),
(6, 'anantasharma510@gmail.com', '928018138bbbdea31722e1d0253be7dc00f20febc5ef5b013a9733618187fef98a195a78ba902b5cebbafb9bcab2b4f6f191', '2024-11-25 09:26:09'),
(7, 'anantasharma510@gmail.com', '76447abe8f9b9a08194f4f33cebce822ee6bf8f0f0c9fc71f4fc64a9cfe818bcd27f31736acea5e2f0e711212c2b66a1018f', '2024-11-25 09:27:04'),
(8, 'anantasharma510@gmail.com', 'fc910a1cc0545f7c299cbb3f263f3e384cc40eb368fb7cee40d07a4fd9abf22cf64837d43a220bf7a2d7f37fc451d25f5253', '2024-11-25 09:33:34');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `reset_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `fullname`, `address`, `city`, `gender`, `email`, `phone`, `password`, `created_at`, `reset_token`) VALUES
(1, 'Samir sharma', 'bagar', 'ss', 'Male', 'aman@gmail.com', '9999999999', 'aman@123', '2024-08-26 09:55:10', NULL),
(3, 'amit kc', 'Pokhara', 'ss', 'Male', 'amitkc@gmail.com', '9112547417', '$2y$10$R.iU6WeAVU8.VkCMZB9L6.tjGBFafGqBzGbH4fgaboHgV5cB9fj6.', '2024-08-30 09:40:17', NULL),
(4, 'test', 'Pokhara1', 'pokhara,bagar', 'Male', 'test@gmail.com', '9845674368', '$2y$10$WK2Wr25aBC9NeKvPnIkizu1VQgCW5NmnvYmQyqF2rMcTXfPCwvVHC', '2024-09-10 12:06:53', NULL),
(5, 'se', 'bagar', 'ss', 'Male', 's@gmail.com', '9112547417', '$2y$10$UJlQFKo1DQPZOLWPYv6BpuLzXgv4pL9jsR3KuvMCP2ejkXEUSmkqC', '2024-09-10 14:46:37', NULL),
(6, 'test1', 'Pokhara', 'ss', 'Male', 'testing@gmail.com', '9999999999', '$2y$10$QwjbZJywIjfO/msae5W85e2x1ThLQZQxlp3fc25EelNFWrOUGVZeq', '2024-09-18 04:19:19', NULL),
(7, 'aman ss', 'bagar', 'pkhr', 'Male', 'aman1@gmail.com', '9846582621', '$2y$10$eQiVVQWm0BehkX3UbuIk7e8DktwKNv.vY2iQHVWBe6..x1bSn42Na', '2024-09-21 12:20:48', NULL),
(8, 'samir', 'pokhara', 'pokhara', 'Male', 'test123@gmail.com', '9877777777', '$2y$10$DzeXV93q2U7UHopj7/XpJedPYtc4YTAFoy5c5hvn/29a5oSCr/nfW', '2024-09-23 12:44:56', NULL),
(9, 'asd', 'bagar', 'pokhara', 'Male', 'asd@gmail.com', '9846582621', '$2y$10$SLy.XsnldAfTWvT.xZm1E.PlMf.OiCGGJOXBLaVykB9/pOYfbNDr.', '2024-09-25 11:28:25', NULL),
(11, 'hem', 'Pokhara', 'pokhara', 'Male', 'anantasharma510@gmail.com', '9846582621', '$2y$10$jARZxlqNLXW2EPLa7tCUzuHa.FOt9VFUqyvLVR8y6CSRRFcqvtTL.', '2024-11-25 07:11:07', 'bf4d2f49d08cf0a29a7707386187606e'),
(12, 'Samir sharma', 'Kathmandu', 'pokhara', 'Male', 'bant98476@gmail.com', '9845674367', '$2y$10$wtAKOFY3HOyWsDhFGUwoduWVfyZN7pp62kzbG0FBu.RbtuxkFohqm', '2024-12-01 08:42:51', '0bacfbcbb9d85680fe09fa9b8487fa4c'),
(13, 'Samir sharma', 'Kathmandu', 'pokhara', 'Male', 'b@gmail.com', '9845674367', '$2y$10$QEqiovSq6VrLk8YmsZ3Fsuxlkb0frNli7WE1lM.qRDSS7tnOyZGKS', '2024-12-01 15:19:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `appointment_id` int(11) DEFAULT NULL,
  `medical_issue` varchar(255) DEFAULT NULL,
  `blood_group` varchar(50) DEFAULT NULL,
  `suggested_medicine` varchar(255) DEFAULT NULL,
  `checked_date` date DEFAULT NULL,
  `report_text` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `appointment_id`, `medical_issue`, `blood_group`, `suggested_medicine`, `checked_date`, `report_text`) VALUES
(1, 1, 'ssss', 's', 'kks', '2024-10-24', 'kss'),
(2, 1, 'fvf', 'f', 'fff', '2024-10-17', 'vdd'),
(3, 1, 'ss', 's', 'sss', '2024-10-17', 'ss'),
(4, 9, 'fvf', 'f', 'sss', '2024-10-17', 'ss');

-- --------------------------------------------------------

--
-- Table structure for table `tblcontact`
--

CREATE TABLE `tblcontact` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcontact`
--

INSERT INTO `tblcontact` (`id`, `name`, `email`, `phone`, `message`, `created_at`) VALUES
(13, 'samir sharma', 'bip1@gmail.com', '9845674367', 'vcbfd', '2024-09-09 14:14:17'),
(14, 'test', 'aman@gmail.com', '9845674367', 'rtgre', '2024-09-09 14:14:30'),
(15, 'hello', 'test@gmail.com', '9999999999', 'rtrtrwe', '2024-09-09 14:14:38'),
(16, 'gd', 'tubca00@gmail.com', '9999999999', 'erwerewq', '2024-09-09 14:14:52'),
(17, 'hello matt', 'test@gmail.com', '9846582621', 'helllo', '2024-10-08 08:25:13');

-- --------------------------------------------------------

--
-- Table structure for table `tblpatient`
--

CREATE TABLE `tblpatient` (
  `ID` int(10) NOT NULL,
  `Docid` int(10) DEFAULT NULL,
  `PatientName` varchar(200) DEFAULT NULL,
  `PatientContno` bigint(10) DEFAULT NULL,
  `PatientEmail` varchar(200) DEFAULT NULL,
  `PatientGender` varchar(50) DEFAULT NULL,
  `PatientAdd` mediumtext DEFAULT NULL,
  `PatientAge` int(10) DEFAULT NULL,
  `PatientMedhis` mediumtext DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblpatient`
--

INSERT INTO `tblpatient` (`ID`, `Docid`, `PatientName`, `PatientContno`, `PatientEmail`, `PatientGender`, `PatientAdd`, `PatientAge`, `PatientMedhis`, `CreationDate`, `UpdationDate`) VALUES
(14, 0, 'ananta', 9876656544, 's@gmail.com', 'male', 'bagarrrrrr', 19, 'cdcdcd', '2024-09-21 11:14:30', '2024-09-21 11:36:06'),
(15, 0, 'kisor', 9876656544, 'dds@gmail.com', 'male', 'fd', 33, 'fefw', '2024-09-21 11:40:42', NULL),
(16, 1, 'ananta', 9876656544, 's@gmail.com', 'male', 'vcdfsd', 33, 'fdd', '2024-09-21 11:46:23', NULL),
(17, 0, 'kisor', 973683772, 'test@gmail.com', 'Male', 'sdws', 33, '0', '2024-09-25 11:36:41', NULL),
(19, 8, 'hello', 9846582621, 'tubca00@gmail.com', 'Male', 'kdknkd', 33, '0', '2024-10-16 12:30:29', NULL),
(20, 7, 'ss', 98465826213, 'bip1@gmail.com', 'Female', 'ss', 27, '0', '2024-10-17 09:41:06', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `admin_login_history`
--
ALTER TABLE `admin_login_history`
  ADD PRIMARY KEY (`login_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctorId` (`doctorId`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `specilization_id` (`specilization_id`);

--
-- Indexes for table `doctorspecilization`
--
ALTER TABLE `doctorspecilization`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors_schedule`
--
ALTER TABLE `doctors_schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `doctor_availability`
--
ALTER TABLE `doctor_availability`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_doctor` (`doctorId`);

--
-- Indexes for table `doctor_login_history`
--
ALTER TABLE `doctor_login_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `doctor_slots`
--
ALTER TABLE `doctor_slots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointment_id` (`appointment_id`);

--
-- Indexes for table `tblcontact`
--
ALTER TABLE `tblcontact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblpatient`
--
ALTER TABLE `tblpatient`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_login_history`
--
ALTER TABLE `admin_login_history`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `doctorspecilization`
--
ALTER TABLE `doctorspecilization`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `doctors_schedule`
--
ALTER TABLE `doctors_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctor_availability`
--
ALTER TABLE `doctor_availability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `doctor_login_history`
--
ALTER TABLE `doctor_login_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `doctor_slots`
--
ALTER TABLE `doctor_slots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=301;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblcontact`
--
ALTER TABLE `tblcontact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tblpatient`
--
ALTER TABLE `tblpatient`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_login_history`
--
ALTER TABLE `admin_login_history`
  ADD CONSTRAINT `admin_login_history_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE CASCADE;

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`doctorId`) REFERENCES `doctors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_ibfk_1` FOREIGN KEY (`specilization_id`) REFERENCES `doctorspecilization` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `doctors_schedule`
--
ALTER TABLE `doctors_schedule`
  ADD CONSTRAINT `doctors_schedule_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`);

--
-- Constraints for table `doctor_availability`
--
ALTER TABLE `doctor_availability`
  ADD CONSTRAINT `doctor_availability_ibfk_1` FOREIGN KEY (`doctorId`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_doctor` FOREIGN KEY (`doctorId`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `doctor_login_history`
--
ALTER TABLE `doctor_login_history`
  ADD CONSTRAINT `doctor_login_history_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `doctor_slots`
--
ALTER TABLE `doctor_slots`
  ADD CONSTRAINT `doctor_slots_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`);

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`appointment_id`) REFERENCES `appointment` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
