-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2026 at 12:59 PM
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
-- Database: `office_tms_system_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_calendars`
--

CREATE TABLE `academic_calendars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `event_date` date NOT NULL,
  `type` enum('holiday','celebration','event','deadline','meeting') NOT NULL DEFAULT 'event',
  `image` varchar(255) DEFAULT NULL,
  `is_recurring` tinyint(1) NOT NULL DEFAULT 0,
  `recurrence_type` enum('yearly','monthly','weekly') DEFAULT NULL,
  `recurrence_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`recurrence_data`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `academic_calendars`
--

INSERT INTO `academic_calendars` (`id`, `title`, `description`, `event_date`, `type`, `image`, `is_recurring`, `recurrence_type`, `recurrence_data`, `created_at`, `updated_at`) VALUES
(1, 'makar sankranti', 'happy makar sankranti', '2026-01-14', 'holiday', 'academic-calendar/images/n8JqrWE3Z8YgI48ZWp3FeSDeIRRTIGdtYdOJGT1p.jpg', 0, NULL, NULL, '2026-01-12 08:32:05', '2026-01-12 08:32:05');

-- --------------------------------------------------------

--
-- Table structure for table `accessories`
--

CREATE TABLE `accessories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `accessory_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `serial_number` varchar(255) DEFAULT NULL,
  `model_number` varchar(255) DEFAULT NULL,
  `value` decimal(10,2) DEFAULT NULL,
  `allocation_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `status` enum('allocated','returned','lost','damaged') NOT NULL DEFAULT 'allocated',
  `condition_notes` text DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `punch_in_time` timestamp NULL DEFAULT NULL,
  `punch_out_time` timestamp NULL DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'present',
  `worked_hours` decimal(5,2) DEFAULT NULL,
  `punch_in_source` enum('qr','manual','auto','universal_qr') DEFAULT NULL,
  `punch_out_source` enum('qr','manual','auto','universal_qr') DEFAULT NULL,
  `attendance_type` varchar(255) NOT NULL DEFAULT 'office',
  `working_status` enum('full_day','half_day','no_work') DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `employee_id`, `date`, `punch_in_time`, `punch_out_time`, `status`, `worked_hours`, `punch_in_source`, `punch_out_source`, `attendance_type`, `working_status`, `notes`, `created_at`, `updated_at`) VALUES
(80, 20, '2026-01-01', '2026-01-01 08:36:20', NULL, 'present', NULL, 'universal_qr', NULL, 'office', 'no_work', NULL, '2026-01-01 08:36:20', '2026-01-01 08:36:20'),
(81, 1, '2026-01-01', '2026-01-01 08:42:29', NULL, 'present', NULL, 'universal_qr', NULL, 'office', 'no_work', NULL, '2026-01-01 08:42:29', '2026-01-01 08:42:29'),
(82, 11, '2026-01-01', '2026-01-01 08:54:32', NULL, 'present', NULL, 'universal_qr', NULL, 'office', 'no_work', NULL, '2026-01-01 08:54:32', '2026-01-01 08:54:32'),
(83, 8, '2026-01-01', '2026-01-01 08:56:00', NULL, 'present', NULL, 'universal_qr', NULL, 'office', 'no_work', NULL, '2026-01-01 08:56:00', '2026-01-01 08:56:00'),
(84, 5, '2026-01-01', '2026-01-01 08:56:50', NULL, 'present', NULL, 'universal_qr', NULL, 'office', 'no_work', NULL, '2026-01-01 08:56:50', '2026-01-01 08:56:50'),
(85, 12, '2026-01-01', '2026-01-01 08:57:24', NULL, 'present', NULL, 'universal_qr', NULL, 'office', 'no_work', NULL, '2026-01-01 08:57:24', '2026-01-01 08:57:24'),
(86, 2, '2026-01-01', '2026-01-01 08:58:14', NULL, 'present', NULL, 'universal_qr', NULL, 'office', 'no_work', NULL, '2026-01-01 08:58:14', '2026-01-01 08:58:14'),
(88, 3, '2026-01-01', '2026-01-01 09:02:57', NULL, 'present', NULL, 'universal_qr', NULL, 'office', 'no_work', NULL, '2026-01-01 09:02:57', '2026-01-01 09:02:57'),
(89, 14, '2026-01-01', '2026-01-01 09:03:26', NULL, 'present', NULL, 'universal_qr', NULL, 'office', 'no_work', NULL, '2026-01-01 09:03:26', '2026-01-01 09:03:26'),
(90, 6, '2026-01-01', '2026-01-01 09:03:48', NULL, 'present', NULL, 'universal_qr', NULL, 'office', 'no_work', NULL, '2026-01-01 09:03:48', '2026-01-01 09:03:48'),
(91, 9, '2026-01-01', '2026-01-01 08:57:00', NULL, 'present', NULL, 'manual', NULL, 'office', NULL, NULL, '2026-01-01 09:07:25', '2026-01-01 09:07:25'),
(92, 7, '2026-01-01', '2026-01-01 09:07:29', NULL, 'present', NULL, 'universal_qr', NULL, 'office', 'no_work', NULL, '2026-01-01 09:07:29', '2026-01-01 09:07:29'),
(93, 19, '2026-01-01', '2026-01-01 09:13:20', NULL, 'present', NULL, 'universal_qr', NULL, 'office', 'no_work', NULL, '2026-01-01 09:13:20', '2026-01-01 09:13:20'),
(94, 4, '2026-01-01', '2026-01-01 09:10:00', NULL, 'late', NULL, 'manual', NULL, 'office', NULL, NULL, '2026-01-01 09:14:29', '2026-01-01 09:14:29'),
(95, 16, '2026-01-01', '2026-01-01 09:08:00', NULL, 'late', NULL, 'manual', NULL, 'office', NULL, NULL, '2026-01-01 09:16:14', '2026-01-01 09:16:14'),
(96, 10, '2026-01-01', '2026-01-01 09:18:14', NULL, 'present', NULL, 'universal_qr', NULL, 'office', 'no_work', NULL, '2026-01-01 09:18:14', '2026-01-01 09:18:14');

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
-- Table structure for table `daily_task_reports`
--

CREATE TABLE `daily_task_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `report_date` date NOT NULL,
  `introduction` text DEFAULT NULL,
  `status` enum('draft','submitted') NOT NULL DEFAULT 'draft',
  `submitted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `daily_task_reports`
--

INSERT INTO `daily_task_reports` (`id`, `employee_id`, `report_date`, `introduction`, `status`, `submitted_at`, `created_at`, `updated_at`) VALUES
(4, 1, '2026-01-01', 'Hello sir/Ma\'am, I am sharing my daily work report for 1st January 2026, summarizing the key activities completed during the day.', 'submitted', '2026-01-01 09:37:30', '2026-01-01 09:36:58', '2026-01-01 09:37:30'),
(5, 2, '2026-01-12', 'Hello sir/Ma\'am, I am sharing my daily work report for <b>12th January 2026,</b> summarizing the key activities completed during the day.', 'submitted', '2026-01-12 08:39:08', '2026-01-12 08:38:58', '2026-01-12 08:39:08');

-- --------------------------------------------------------

--
-- Table structure for table `daily_task_report_items`
--

CREATE TABLE `daily_task_report_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `daily_task_report_id` bigint(20) UNSIGNED NOT NULL,
  `sr_no` int(11) NOT NULL,
  `project_name` varchar(255) DEFAULT NULL,
  `module` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `estimated_hours` decimal(5,2) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `actual_hours` decimal(5,2) NOT NULL,
  `status` enum('pending','in_progress','done','blocked') NOT NULL DEFAULT 'in_progress',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `daily_task_report_items`
--

INSERT INTO `daily_task_report_items` (`id`, `daily_task_report_id`, `sr_no`, `project_name`, `module`, `description`, `estimated_hours`, `start_date`, `end_date`, `actual_hours`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 1, NULL, NULL, 'sdfghj', 3.50, '2026-01-01', '2026-01-01', 3.50, 'in_progress', '2026-01-01 09:36:58', '2026-01-01 09:36:58'),
(2, 5, 1, 'test', 'test', '<p>test</p>', 2.00, '2026-01-12', '2026-01-12', 2.50, 'done', '2026-01-12 08:38:58', '2026-01-12 08:38:58');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `document_name` varchar(255) NOT NULL,
  `document_path` varchar(255) NOT NULL,
  `original_filename` varchar(255) NOT NULL,
  `file_size` varchar(255) DEFAULT NULL,
  `mime_type` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` varchar(3) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `address` text NOT NULL,
  `marital_status` enum('single','married','divorced','widowed') NOT NULL,
  `dob` date NOT NULL,
  `phone` varchar(255) NOT NULL,
  `aadhaar_number` varchar(12) DEFAULT NULL,
  `wfh_pin` varchar(6) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `type` enum('intern','onrole') NOT NULL,
  `position` varchar(255) NOT NULL,
  `has_experience` tinyint(1) NOT NULL DEFAULT 0,
  `previous_company` varchar(255) DEFAULT NULL,
  `previous_role` varchar(255) DEFAULT NULL,
  `experience_years` int(11) DEFAULT NULL,
  `experience_months` int(11) DEFAULT NULL,
  `previous_salary` decimal(12,2) DEFAULT NULL,
  `reason_for_leaving` text DEFAULT NULL,
  `skills_expertise` text DEFAULT NULL,
  `reference_name` varchar(255) DEFAULT NULL,
  `reference_contact` varchar(255) DEFAULT NULL,
  `reference_designation` varchar(255) DEFAULT NULL,
  `start_date` date NOT NULL,
  `onrole_date` date DEFAULT NULL,
  `probation_start_date` date DEFAULT NULL,
  `probation_end_date` date DEFAULT NULL,
  `probation_status` enum('active','completed','extended','failed') DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_id`, `first_name`, `middle_name`, `last_name`, `gender`, `address`, `marital_status`, `dob`, `phone`, `aadhaar_number`, `wfh_pin`, `email`, `department`, `type`, `position`, `has_experience`, `previous_company`, `previous_role`, `experience_years`, `experience_months`, `previous_salary`, `reason_for_leaving`, `skills_expertise`, `reference_name`, `reference_contact`, `reference_designation`, `start_date`, `onrole_date`, `probation_start_date`, `probation_end_date`, `probation_status`, `photo`, `created_at`, `updated_at`) VALUES
(1, '991', 'Gauri', 'Digambar', 'Jadhav', 'female', 'Permanent Address- New Plot Kacheri Road, Satana\r\nTemporary Address- Tidkey colony, near SS auto work, Anudeep park, Nashik-Maharashtra.', 'single', '2000-05-25', '7385788235', '384385288756', '252000', 'gj255200@gmail.com', 'Management', 'onrole', 'hr management', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-05', '2021-01-05', '2021-01-05', '2021-04-05', 'completed', 'employees/photos/VofFwuqgFuVtP62C5a67s54Y88Vt5984DtELGuUc.jpg', '2025-12-12 14:22:21', '2025-12-12 14:53:11'),
(2, '455', 'Chetan', 'Sanjay', 'Shelake', 'male', 'Permanent Adress : At Post Nagardeo , Dist - Jalgaon , pin- 424104\r\nCurrent Adress : Amrutdham , kk wagh engineering College , Nashik', 'single', '2001-07-14', '9096879903', '580964292042', '142001', 'chetanshelake147@gmail.com', 'Poduction', 'onrole', 'php developer', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-06', '2025-05-01', '2025-05-01', '2025-07-30', 'completed', 'employees/photos/GjlbLdGWs0B6jCm10LD0uXccK3FxHfrLJGLiBgcW.jpg', '2025-12-12 14:22:28', '2026-01-03 10:59:44'),
(3, '577', 'Shivam', 'Nitin', 'Kshatriya', 'male', 'Permanent- Arvind Road, near Balaji temple, Paroda\r\nTemporary- Ashtvinayak Society, amrutdham Nashik', 'single', '2002-10-04', '9527349091', NULL, '042002', 'kshatriyashivam34@gmail.com', 'Production', 'onrole', 'php developer', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-09', '2025-03-26', '2025-03-26', '2025-06-26', 'completed', 'employees/photos/TpTprq4ANgiYJzMGpYh5E8D7nSgX7easf5gt5z1A.jpg', '2025-12-12 14:50:22', '2025-12-12 14:51:06'),
(4, '388', 'Mayur', 'Mohan', 'Jawale', 'male', 'Permanent Address-Kamatwadi, Nashik, Jayesh Park society, Flat no.19, C-ving', 'single', '2001-02-01', '9172593150', NULL, '012001', 'mayurjawale999@gmail.com', 'Production', 'onrole', 'php developer', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-11', '2025-05-20', '2025-05-20', '2025-08-20', 'completed', 'employees/photos/hr8spQvXiIFzNOr9QZmDPVeOTVxbUmTINmVBw2fp.jpg', '2025-12-12 15:03:15', '2025-12-12 15:04:11'),
(5, '622', 'Priyanka', 'Bhausaheb', 'Kakulate', 'female', 'Permanent-Geeta gokuldham, B-501, Jatra Hotel Panchvati Nashik.', 'married', '1996-07-29', '9503253511', NULL, '291996', 'priyankakakulate111@gmail.com', 'Production', 'onrole', 'php developer', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-12-04', '2024-04-15', '2024-04-15', '2024-07-15', 'completed', 'employees/photos/iWAc0BuTHKk75hirKJqu4r9VraqqlKIP7naMZdZk.jpg', '2025-12-12 15:15:35', '2025-12-12 15:17:00'),
(6, '191', 'Jaykumar', 'Naresh', 'Pawar', 'male', 'Plot No.41 sector no.788.1, 3rd floor, Flat No.-301, Skyline Plaza- Nashik (M-Corp) 422009', 'single', '1999-07-01', '9359584253', NULL, '011999', 'jaykumarpawar301@gmail.com', 'Production', 'intern', 'php developer', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-12', NULL, NULL, NULL, NULL, 'employees/photos/N4jKiudl6s8QzNGAB2ng5CA5JE3qFqLKBscj1uTi.jpg', '2025-12-12 15:22:39', '2025-12-12 15:22:39'),
(7, '594', 'Nilesh', 'Rajendra', 'Pathak', 'male', 'Sawata Nagar, Cidco- Nashik', 'single', '1998-05-29', '9130348515', NULL, '291998', 'pathaknilesh1998@gmail.com', 'Production', 'onrole', 'flutter developer', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-05', '2024-06-05', '2024-06-05', '2024-08-05', 'completed', 'employees/photos/7mQXkRBUDmebvuCEKFYhr0Ke47H7heEV4eCxw6b8.jpg', '2025-12-12 15:35:50', '2025-12-12 16:32:39'),
(8, '182', 'Pritesh', 'Shridhar', 'Pawar', 'male', 'Dattakrupa Row house,Dharmaji colony, Near Siddhivinayak Ganapti Temple, Shivajinagar, Satpur, Nashik', 'single', '1999-04-18', '8552011102', NULL, '181999', 'pawarpritesh90@gmail.com', 'IT', 'intern', 'flutter developer', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-20', '2025-01-20', NULL, NULL, NULL, 'employees/photos/T7Xt8IJECzFJFbquVcFl6t7MIZVrDNRrvnY7kiWS.jpg', '2025-12-12 15:42:13', '2025-12-26 10:24:27'),
(9, '139', 'Akash', 'Rajendra', 'Gawale', 'male', 'Songaon, Saykhed, Niphad- Nashik', 'single', '2000-02-27', '9021533077', NULL, '272000', 'akashgawale027@gmail.com', 'Production', 'intern', 'flutter developer', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-01', NULL, NULL, NULL, NULL, 'employees/photos/4RlHYTJy3hdwSZBbY6X9VlCJjrKyq4ba5ciWD862.jpg', '2025-12-12 15:47:31', '2025-12-12 15:47:31'),
(10, '984', 'Yogesh', 'Popatrao', 'Porje', 'male', 'Flat No.1, Savitribai, Porje Wada, Kalaram Mandir, dakshin Darwaja Panchavati. Nashik', 'single', '2003-02-08', '9075594800', NULL, '082003', 'yogeshporje11@gmail.com', 'Production', 'onrole', 'flutter developer', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-05', NULL, NULL, NULL, NULL, 'employees/photos/WcQN0zc4cXZtOh2iZfBCCMxawZgDAcBzEBkZ5vqe.jpg', '2025-12-12 16:09:52', '2025-12-12 16:09:52'),
(11, '325', 'Sumit', 'Bhikaji', 'Pathak', 'male', 'shivaji nagar , satpur , Nashik', 'single', '2002-07-17', '7620075780', NULL, '172002', 'sumitpathakofficial914@gmail.com', 'Production', 'intern', 'node js developer', 1, 'HDFC ERGO', 'Software engineer', 3, 5, 50000.00, 'Relocation Problem', NULL, NULL, NULL, NULL, '2024-06-10', '2024-06-10', '2024-06-10', '2024-09-10', 'completed', 'employees/photos/UMnZz6NO6vsCZfCR2ScmQMor9JCqVq9fQVnvpsPR.png', '2025-12-12 16:32:04', '2025-12-12 16:33:13'),
(12, '217', 'Tejas', 'Sudhakar', 'Derle', 'male', 'At post Karanji kh. Tal: Niphad , Nashik', 'single', '2002-05-24', '9011765581', NULL, '242002', 'tejasderle24@gmail.com', 'Production', 'onrole', 'react developer', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-13', '2025-12-08', '2025-12-08', '2026-03-08', 'active', 'employees/photos/5Jatf1pHc0iCLNYfQ8lhQzTiwkvzIUIrtFLc5o6B.jpg', '2025-12-12 16:39:12', '2025-12-12 16:40:40'),
(14, '603', 'Tanmay', 'Digambar', 'Rote', 'male', 'Permanent Address : At post Rui , Tal: Niphad , Dist : Nashik\r\nTemporary Address : Tidke Colony , Durwakar PG , Nashik', 'single', '2003-11-20', '7276512156', '829117574304', '202003', 'tanmayrote325@gmail.com', 'Production', 'intern', 'react developer', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-06', NULL, NULL, NULL, NULL, 'employees/photos/uvdcBFq1TVZAna1DRLYO9RDkwT15OHJDWkOc3Zu7.jpg', '2025-12-12 17:00:25', '2025-12-12 17:00:25'),
(15, '080', 'Harvansh Singh', 'Khushbir Singh', 'Panesar', 'male', 'At Post  ASB/29 Ashwin nagar , cidco , Nashik', 'single', '2004-03-19', '7756030024', NULL, '192004', 'harvanshpanesar@gmail.com', 'Design', 'intern', 'uiux designer', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-07', NULL, NULL, NULL, NULL, 'employees/photos/ET9Hhli6gJboCDz6MRBrBmyNr39cx5ASPTdVrFZX.jpg', '2025-12-12 17:06:26', '2025-12-12 17:06:26'),
(16, '354', 'Samiksha', 'Chandrakant', 'Raka', 'female', 'Pemenent Address : Raka niwas , infront of post office , Taharabad , Tal : satana , Dist : Nashik\r\nTemporary Address : Patil Classics , GovindNagar , Near Pimprikar Hospital , Nashik', 'single', '2001-07-10', '8308611114', '633034803982', '102001', 'rakasamiksha18@gmail.com', 'Design', 'onrole', 'uiux designer', 1, 'Hansa Cequity', 'Designer', 1, 3, 15000.00, NULL, NULL, NULL, NULL, NULL, '2025-03-20', '2025-10-13', '2025-10-13', '2026-01-13', 'active', 'employees/photos/vjV5yQfkcAWCdCVggBA44wuiv3PJylG7tJf6fhri.jpg', '2025-12-12 17:14:46', '2025-12-12 17:16:15'),
(17, '010', 'Pankaj', 'Sajeev', 'Ahirrao', 'male', 'BidiKamgar nagar amrutdham , panchvati nashik', 'married', '1988-09-14', '8888785153', '968122454353', '121988', 'ahirrao.pankaj14@gmail.com', 'Design', 'intern', 'uiux designer', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-06', NULL, NULL, NULL, NULL, 'employees/photos/OYQR6fWm2IOChHoY78eUWfpLU3TqVuclJvmmbA9t.jpg', '2025-12-12 17:28:22', '2025-12-12 17:29:50'),
(18, '454', 'Pooja', NULL, 'Belekar', 'female', 'Jadhav Sankul , Ashoknagar Satpur Nashik', 'single', '2001-01-04', '9130911045', NULL, '042001', 'belekarpooja04@gmail.com', 'Design', 'intern', 'uiux designer', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-05-12', NULL, NULL, NULL, NULL, 'employees/photos/Bk7HiTiUZivRLsNrrfO18wX1UHZspjApeJQigbYD.jpg', '2025-12-12 17:41:08', '2025-12-23 16:18:11'),
(19, '558', 'Omkar', 'Dilip', 'Kushare', 'male', 'Permenent Address : Kushare Farm , Station Road , Ugaon\r\nTemporary Address : Madhav prasad society , P and T colony , Untvadi , Nashik', 'single', '2006-09-21', '7875272898', '836125469655', '212006', 'omkarkushare3@gmail.com', 'Design', 'intern', 'uiux designer', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-01', NULL, NULL, NULL, NULL, 'employees/photos/NS5AZwydJW8r8xAnAk8zdkWTbeB51ksu3EJDBIJe.jpg', '2025-12-12 17:47:26', '2025-12-12 17:47:26'),
(20, '690', 'Prasad', 'Bhaskar', 'Jagtap', 'male', 'motkeshwar vasahat, gadge maharaj dharm shale javal, old Nashik', 'single', '1996-06-04', '9657038951', '685057838783', '041996', 'jagtapprasad@gmail.com', 'Office Assistance', 'onrole', 'office boy', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-02-12', '2025-02-12', NULL, NULL, NULL, 'employees/photos/cOiFOOnyDStFel7yB7Z4UefxgNV1acw6i3qImgPy.jpg', '2025-12-24 16:28:18', '2025-12-24 16:28:18');

-- --------------------------------------------------------

--
-- Table structure for table `employee_logins`
--

CREATE TABLE `employee_logins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `login_attempts` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `current_qr_identifier` varchar(255) DEFAULT NULL,
  `current_qr_secret` varchar(255) DEFAULT NULL,
  `current_qr_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`current_qr_data`)),
  `qr_expires_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_logins`
--

INSERT INTO `employee_logins` (`id`, `employee_id`, `email`, `password`, `is_active`, `last_login_at`, `login_attempts`, `created_at`, `updated_at`, `current_qr_identifier`, `current_qr_secret`, `current_qr_data`, `qr_expires_at`, `remember_token`) VALUES
(21, 9, 'akash.gawale@techmetworks.com', '$2y$12$/4Eo9tA/8JWr0nCLWfzIS.enVgW72N8OPcCbk28WbTrCMfAJtlweu', 1, NULL, 0, '2026-01-01 08:45:06', '2026-01-12 08:26:39', 'qr_139_1768206399_btyE9YEA', '0jlQgtVqiXkLbTgyPF440rO4cYiAM10L', '{\"type\":\"daily_attendance\",\"employee_id\":9,\"employee_3digit_id\":\"139\",\"employee_email\":\"akash.gawale@techmetworks.com\",\"action\":\"punch_in\",\"timestamp\":1768206399,\"secret\":\"0jlQgtVqiXkLbTgyPF440rO4cYiAM10L\",\"expires_at\":1768209999}', '2026-01-12 09:26:39', NULL),
(22, 1, 'gauri.jadhav@techmetworks.com', '$2y$12$DGUXoIk8QY68pp3XvI1iBeUJ8k.PfMHTWbvq/u7QNcv9xksG2h/Yq', 1, '2026-01-01 09:23:33', 0, '2026-01-01 08:45:16', '2026-01-01 09:23:33', NULL, NULL, NULL, NULL, NULL),
(23, 2, 'chetan.shelake@techmetworks.com', '$2y$12$nESW80Nwf0o01XQfM6D49unUx58/97W6f2j/vg4fXTYNKTH6X4SmG', 1, '2026-02-16 10:39:59', 0, '2026-01-01 08:45:17', '2026-02-16 10:39:59', NULL, NULL, NULL, NULL, NULL),
(24, 15, 'harvansh singh.panesar@techmetworks.com', '$2y$12$INcFuRaL0SlfZeF0IAtnG.9zsttDN71NGj72EsZ7EjuZ0Ev2kaxGO', 1, NULL, 0, '2026-01-12 08:26:03', '2026-01-12 08:26:03', NULL, NULL, NULL, NULL, NULL),
(25, 16, 'samiksha.raka@techmetworks.com', '$2y$12$FC1Lsa1vezrLe0UIlfE/He1dglXm8CgmlaWf956SO2g1BYzkFWWuy', 1, NULL, 0, '2026-01-12 08:26:20', '2026-01-12 08:26:20', NULL, NULL, NULL, NULL, NULL);

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
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `leave_type` enum('annual_leave','sick_leave','casual_leave','maternity_leave','paternity_leave','emergency_leave','unpaid_leave','medical_leave','vacation_leave','bereavement_leave','personal_leave') NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `days_count` decimal(4,1) NOT NULL DEFAULT 0.0,
  `reason` text NOT NULL,
  `status` enum('pending','approved','rejected','cancelled') NOT NULL DEFAULT 'pending',
  `is_half_day` tinyint(1) NOT NULL DEFAULT 0,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `rejected_reason` text DEFAULT NULL,
  `admin_notes` text DEFAULT NULL,
  `emergency` tinyint(1) NOT NULL DEFAULT 0,
  `attachments` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`attachments`)),
  `submitted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(4, '2025_11_13_072153_create_employees_table', 1),
(5, '2025_11_13_111029_create_salaries_table', 1),
(6, '2025_11_13_112035_add_probation_fields_to_employees_table', 1),
(7, '2025_11_13_113250_add_aadhaar_number_to_employees_table', 1),
(8, '2025_11_13_114046_add_aadhaar_number_to_salaries_table', 1),
(9, '2025_11_13_114438_create_documents_table', 1),
(10, '2025_11_13_120355_drop_documents_column_from_employees_table', 1),
(11, '2025_11_13_120911_create_accessories_table', 1),
(12, '2025_11_13_122152_create_academic_calendars_table', 1),
(13, '2025_11_14_043425_create_employee_logins_table', 1),
(14, '2025_11_14_054831_create_attendances_table', 1),
(15, '2025_11_14_064520_add_wfh_pin_to_employees_table', 1),
(16, '2025_11_14_064815_add_attendance_source_to_attendances_table', 1),
(17, '2025_11_14_082513_create_leaves_table', 1),
(18, '2025_11_15_104638_add_role_to_users_table', 1),
(19, '2025_11_17_055653_add_qr_fields_to_employee_logins_table', 1),
(20, '2025_11_17_123029_add_working_status_to_attendances_table', 1),
(21, '2025_11_17_125306_fix_working_status_data', 1),
(22, '2025_11_17_135245_create_monthly_salaries_table', 1),
(23, '2025_11_17_150912_add_no_work_to_working_status_enum', 1),
(24, '2025_11_20_140000_create_daily_task_reports_table', 1),
(25, '2025_11_20_140001_create_daily_task_report_items_table', 1),
(26, '2025_11_20_160000_add_experience_fields_to_employees_table', 1),
(27, '2025_11_21_054900_add_remember_token_to_employee_logins_table', 1),
(28, '2025_11_22_145838_create_personal_access_tokens_table', 1),
(29, '2025_12_18_000001_create_universal_qr_codes_table', 2),
(30, '2025_12_18_000002_create_universal_attendance_logs_table', 2),
(31, '2025_12_19_095300_update_attendance_source_enum_for_universal_qr', 3),
(32, '2026_01_01_150539_make_project_name_module_nullable_in_daily_task_report_items_table', 4),
(33, '2026_01_01_163745_create_projects_table', 5),
(34, '2026_01_03_165130_add_domain_hosting_fields_to_projects_table', 6),
(35, '2026_01_08_125500_drop_domain_hosting_fields_from_projects_table', 7),
(36, '2026_01_08_135500_create_products_table', 7),
(37, '2026_01_08_140000_create_team_allocations_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `monthly_salaries`
--

CREATE TABLE `monthly_salaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `salary_year` year(4) NOT NULL,
  `salary_month` tinyint(4) NOT NULL,
  `monthly_basic_salary` decimal(12,2) NOT NULL,
  `daily_rate` decimal(10,2) NOT NULL,
  `calendar_working_days` int(11) NOT NULL,
  `calendar_total_days` int(11) NOT NULL,
  `calendar_weekends` int(11) NOT NULL,
  `calendar_holidays` int(11) NOT NULL,
  `present_days` decimal(5,2) NOT NULL,
  `half_days` decimal(5,2) NOT NULL,
  `absent_days` decimal(5,2) NOT NULL,
  `casual_leave_days` decimal(5,2) NOT NULL,
  `payable_days` decimal(5,2) NOT NULL,
  `calculated_salary` decimal(12,2) NOT NULL,
  `basic_salary` decimal(12,2) NOT NULL DEFAULT 0.00,
  `total_earnings` decimal(12,2) NOT NULL DEFAULT 0.00,
  `total_deductions` decimal(12,2) NOT NULL DEFAULT 0.00,
  `net_salary` decimal(12,2) NOT NULL DEFAULT 0.00,
  `status` enum('pending','processed','paid') NOT NULL DEFAULT 'pending',
  `processed_at` datetime DEFAULT NULL,
  `paid_at` datetime DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `calculation_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`calculation_data`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\EmployeeLogin', 1, 'Employee Token', '7b78df511aa52d26ed6f2d318286b3c484779b678676147be09b59a08ed52bea', '[\"*\"]', NULL, NULL, '2025-12-18 15:09:29', '2025-12-18 15:09:29'),
(2, 'App\\Models\\EmployeeLogin', 1, 'Employee Token', 'fbaeaf048c8fdaf1f3187c50b6dc79d327f41849b29f7f31542745241c8f78ac', '[\"*\"]', NULL, NULL, '2025-12-18 16:06:47', '2025-12-18 16:06:47'),
(3, 'App\\Models\\EmployeeLogin', 1, 'Employee Token', 'd19dd1997040467b8bc4a3a52624e56c462afea50908c041ee34c04b472c24a1', '[\"*\"]', NULL, NULL, '2025-12-18 16:30:28', '2025-12-18 16:30:28'),
(4, 'App\\Models\\EmployeeLogin', 1, 'Employee Token', '429c77e6b86dcbd3290651ffa4fd4a45997043121d042cccf3698394be4c526b', '[\"*\"]', NULL, NULL, '2025-12-18 16:31:34', '2025-12-18 16:31:34'),
(5, 'App\\Models\\EmployeeLogin', 1, 'Employee Token', '292edc9f4bcbd575cb30394304a65b01067502b328f74001dc374297421a183f', '[\"*\"]', NULL, NULL, '2025-12-18 16:54:43', '2025-12-18 16:54:43'),
(6, 'App\\Models\\EmployeeLogin', 1, 'Employee Token', '03e214e64365e1cf5ccf2779f4959c799c99314b95454a945ba5cafb8d0d087b', '[\"*\"]', NULL, NULL, '2025-12-18 17:12:47', '2025-12-18 17:12:47'),
(7, 'App\\Models\\EmployeeLogin', 1, 'Employee Token', '57a0f416d5174fed2eed61323f3a687e2f25b1fa50e3b8320c3de1652de6a364', '[\"*\"]', NULL, NULL, '2025-12-18 17:19:16', '2025-12-18 17:19:16'),
(8, 'App\\Models\\EmployeeLogin', 1, 'Employee Token', '4314f7cecc26d05ad1a02a4ad9a29ef2912b388cd4ed8ced00c99b0a3eff0f2f', '[\"*\"]', NULL, NULL, '2025-12-19 09:40:16', '2025-12-19 09:40:16'),
(9, 'App\\Models\\EmployeeLogin', 1, 'Employee Token', 'dff9d7d33943d645ac7cc27dfdcd72352b66607f1e35553793a6066ba11fabb6', '[\"*\"]', NULL, NULL, '2025-12-19 09:44:32', '2025-12-19 09:44:32'),
(10, 'App\\Models\\EmployeeLogin', 1, 'Employee Token', '6953f953c9c81176a93c8f6fa557a9eb37801fc1a3cc56ebfa411d1a638d113c', '[\"*\"]', NULL, NULL, '2025-12-19 09:48:42', '2025-12-19 09:48:42'),
(11, 'App\\Models\\EmployeeLogin', 1, 'Employee Token', 'fb3a2f5ae51447b3e280ec1c3a35b136d7960cf8cd7046463b067acec45bb5f3', '[\"*\"]', NULL, NULL, '2025-12-19 09:56:19', '2025-12-19 09:56:19'),
(12, 'App\\Models\\EmployeeLogin', 1, 'Employee Token', 'c638de8824654cee0efc4e74d6d707b641f86b2c52760c671b0d90173fd3ba44', '[\"*\"]', NULL, NULL, '2025-12-19 10:06:33', '2025-12-19 10:06:33'),
(13, 'App\\Models\\EmployeeLogin', 1, 'Employee Token', 'e6750fc362ccac34d386af484cc83aa5b056fee37231b3c31fb71ddf18a1f332', '[\"*\"]', NULL, NULL, '2025-12-19 10:08:27', '2025-12-19 10:08:27'),
(14, 'App\\Models\\EmployeeLogin', 1, 'Employee Token', '69d2623e566926250bc94df54af7d2b3082e846bd6665c8d533d8de5b19ce1b2', '[\"*\"]', NULL, NULL, '2025-12-19 10:13:26', '2025-12-19 10:13:26'),
(15, 'App\\Models\\EmployeeLogin', 1, 'Employee Token', '215e4d5ee927128c3b450ed58affdef9d0d23038a0daac2556fc4099aba4bc10', '[\"*\"]', NULL, NULL, '2025-12-19 10:21:15', '2025-12-19 10:21:15'),
(16, 'App\\Models\\EmployeeLogin', 1, 'Employee Token', '81377d8254907e0fc3519038bb221124e3f12b63e838af308923d8e062d9e6d9', '[\"*\"]', NULL, NULL, '2025-12-19 10:36:04', '2025-12-19 10:36:04'),
(17, 'App\\Models\\EmployeeLogin', 1, 'Employee Token', 'e21e7afdee2a828052f74865ea7a996030b7888eba2730f6b44e91115e1040a3', '[\"*\"]', NULL, NULL, '2025-12-19 10:51:32', '2025-12-19 10:51:32'),
(18, 'App\\Models\\EmployeeLogin', 1, 'Employee Token', '65004556d05208530eccc8410fb1022196f0e4c2d18866c16a45302b9e35c872', '[\"*\"]', NULL, NULL, '2025-12-19 10:55:23', '2025-12-19 10:55:23'),
(19, 'App\\Models\\EmployeeLogin', 1, 'Employee Token', 'b16ff12cf0ed33f0de0a92c00debbd2d8330c4c62a8d9e5d2ecbb2b989f74217', '[\"*\"]', NULL, NULL, '2025-12-19 11:02:59', '2025-12-19 11:02:59'),
(20, 'App\\Models\\EmployeeLogin', 1, 'Employee Token', 'ff754da5050a1c7b647ede2d98d68b1f2686b9d9b9b7178dced6688f23692804', '[\"*\"]', NULL, NULL, '2025-12-19 11:11:33', '2025-12-19 11:11:33'),
(21, 'App\\Models\\EmployeeLogin', 1, 'Employee Token', '8361878cb7fd5b05d783be72f1d6b993028285602e874724bd4d5836ebe53ae0', '[\"*\"]', NULL, NULL, '2025-12-19 11:18:58', '2025-12-19 11:18:58'),
(22, 'App\\Models\\EmployeeLogin', 1, 'Employee Token', 'b5b7e7e4dacb6035a7922b917d4e0982a55f96acab4f6c713e89e59485ebc313', '[\"*\"]', NULL, NULL, '2025-12-19 11:31:34', '2025-12-19 11:31:34'),
(23, 'App\\Models\\EmployeeLogin', 1, 'Employee Token', 'e81d7ece72f50d67e260f2dfdfa60b2edde7eadf9969451e8fdf38990a51d353', '[\"*\"]', NULL, NULL, '2025-12-19 11:42:51', '2025-12-19 11:42:51'),
(24, 'App\\Models\\EmployeeLogin', 1, 'Employee Token', 'c5c660b5ea26e9c575af75c6a7c7abf2b2fed1d204560a42f5d3f2edf489067e', '[\"*\"]', NULL, NULL, '2025-12-19 13:00:43', '2025-12-19 13:00:43'),
(25, 'App\\Models\\EmployeeLogin', 1, 'Employee Token', 'b53ec2f9ee237ac60f712b381557887789af869b6f301f67db902b4a52f7bc8e', '[\"*\"]', NULL, NULL, '2025-12-19 13:04:18', '2025-12-19 13:04:18'),
(26, 'App\\Models\\EmployeeLogin', 1, 'Employee Token', '5697c3d94290ed077338fb0cadd4591136a072481af005dc13ca3b9399314cdf', '[\"*\"]', NULL, NULL, '2025-12-19 13:52:18', '2025-12-19 13:52:18'),
(27, 'App\\Models\\EmployeeLogin', 2, 'Employee Token', '7383e7589f65eef32fded612eeef0876b31c2fb79e43be6813bd3cb53d43a2dc', '[\"*\"]', NULL, NULL, '2025-12-19 13:55:06', '2025-12-19 13:55:06'),
(28, 'App\\Models\\EmployeeLogin', 3, 'Employee Token', 'bff369ae7da91a4262efd758979117aeadecbf20ef3001380536d022ee513dae', '[\"*\"]', NULL, NULL, '2025-12-19 13:58:33', '2025-12-19 13:58:33'),
(29, 'App\\Models\\EmployeeLogin', 4, 'Employee Token', 'c4edea00f15b76c7edb592b81c047d8cba4d88c67cfd03e8d46972fc28851615', '[\"*\"]', NULL, NULL, '2025-12-19 13:59:36', '2025-12-19 13:59:36'),
(30, 'App\\Models\\EmployeeLogin', 2, 'Employee Token', 'c4d4499955dd9c392075def59bf7b2ee31f721bfea8311eb9c2432a2db6b350f', '[\"*\"]', NULL, NULL, '2025-12-19 14:00:29', '2025-12-19 14:00:29'),
(31, 'App\\Models\\EmployeeLogin', 1, 'Employee Token', 'b5442204ff0415542deea74a92f5ab197857ae9624bcab7c0dd8f74b11ccc50c', '[\"*\"]', NULL, NULL, '2025-12-19 14:04:06', '2025-12-19 14:04:06'),
(32, 'App\\Models\\EmployeeLogin', 1, 'Employee Token', '525be4634fc9bac1cd47e8c545b4dd8ceed82d4a13cda406fb5776d1ca7985f2', '[\"*\"]', NULL, NULL, '2025-12-19 14:08:23', '2025-12-19 14:08:23'),
(33, 'App\\Models\\EmployeeLogin', 4, 'Employee Token', 'f6032d3b594aa37e1c0fe7025029ec303c60490bd564d0b40c96816fcaf66223', '[\"*\"]', NULL, NULL, '2025-12-19 14:09:01', '2025-12-19 14:09:01'),
(34, 'App\\Models\\EmployeeLogin', 3, 'Employee Token', '1257f2d516676d12c1d0c7554d71695e86a72c41479ab56dc80ff633793d54dd', '[\"*\"]', NULL, NULL, '2025-12-19 14:20:53', '2025-12-19 14:20:53'),
(35, 'App\\Models\\EmployeeLogin', 1, 'Employee Token', '162054b896e48a03958b34c9add92336ac19f4de8e1d5765f6480681aa8cd546', '[\"*\"]', NULL, NULL, '2025-12-19 14:21:07', '2025-12-19 14:21:07'),
(36, 'App\\Models\\EmployeeLogin', 6, 'Employee Token', 'cbd87ac37ada2b15be32d692d03135696bd71e50cf3d5bf1fac01b87d3084539', '[\"*\"]', NULL, NULL, '2025-12-23 14:37:29', '2025-12-23 14:37:29'),
(37, 'App\\Models\\EmployeeLogin', 6, 'Employee Token', '879477fd20f3e923cfd55a728c04132425a30bb182aabb9b0435b424b5db5bd3', '[\"*\"]', NULL, NULL, '2025-12-23 14:57:36', '2025-12-23 14:57:36'),
(38, 'App\\Models\\EmployeeLogin', 6, 'Employee Token', '7ae5ac6b457422a6f4bd54aa1f98620cba562f0e62e1c3dcc147bba16b28f596', '[\"*\"]', NULL, NULL, '2025-12-23 15:14:19', '2025-12-23 15:14:19'),
(39, 'App\\Models\\EmployeeLogin', 6, 'Employee Token', 'b78bed5db515a3a2c4718dee862578c7d1cd984fe0bf01e349a46ca603255bd1', '[\"*\"]', NULL, NULL, '2025-12-23 15:23:04', '2025-12-23 15:23:04'),
(40, 'App\\Models\\EmployeeLogin', 6, 'Employee Token', '8e32c0b3df12d6332f8c58a0ddea6c826989aabe6671f82cd2c3a5fc31b411ea', '[\"*\"]', NULL, NULL, '2025-12-23 15:24:04', '2025-12-23 15:24:04'),
(41, 'App\\Models\\EmployeeLogin', 7, 'Employee Token', '3ddfd0481a3bbfd75fd29a8f08d4820dc612d71f469f708f3f9802748a6458ca', '[\"*\"]', NULL, NULL, '2025-12-23 17:06:35', '2025-12-23 17:06:35'),
(42, 'App\\Models\\EmployeeLogin', 13, 'Employee Token', '24d0cb94baefb4297f00280aeb0b6aa174ced17200a92adef11d230b5551a20c', '[\"*\"]', NULL, NULL, '2025-12-23 17:33:02', '2025-12-23 17:33:02'),
(43, 'App\\Models\\EmployeeLogin', 18, 'Employee Token', 'ef1b0a24db44c66290a9a7dbfc3536b81e698c6fbb2335a6fd2eb7fdc6e608d7', '[\"*\"]', NULL, NULL, '2025-12-24 09:35:02', '2025-12-24 09:35:02'),
(44, 'App\\Models\\EmployeeLogin', 6, 'Employee Token', '8c230c96c6a45a491c2c38614aa09d2a44780752cc6f2ef1bca390885cb7fa9d', '[\"*\"]', NULL, NULL, '2025-12-24 11:42:24', '2025-12-24 11:42:24'),
(45, 'App\\Models\\EmployeeLogin', 10, 'Employee Token', '594e74864b00222d096da738f7c2a2213f62411223d7ea118929c5ded0727d69', '[\"*\"]', NULL, NULL, '2025-12-24 11:46:11', '2025-12-24 11:46:11'),
(46, 'App\\Models\\EmployeeLogin', 1, 'Employee Token', 'a88b07346267594f29c27e44005e34b2fe2ad663e401e3fea01d20ee71cdfdf4', '[\"*\"]', NULL, NULL, '2025-12-24 11:51:39', '2025-12-24 11:51:39'),
(47, 'App\\Models\\EmployeeLogin', 4, 'Employee Token', '144d1be2a3d279727fd5a16bd549870e4949f9c3f4490d6e6bc554922a3ff682', '[\"*\"]', NULL, NULL, '2025-12-24 11:56:15', '2025-12-24 11:56:15'),
(48, 'App\\Models\\EmployeeLogin', 2, 'Employee Token', '9d588c1a017d50e51bc93ab630a3608e0f203a1d11f622e4c6a6601c0b9d8f53', '[\"*\"]', NULL, NULL, '2025-12-24 14:52:47', '2025-12-24 14:52:47'),
(49, 'App\\Models\\EmployeeLogin', 14, 'Employee Token', '3f6ba27ba5d0342f75ca7094a4c4a8a0ec6c8f79e988edf4c3413f4b3cdb09c5', '[\"*\"]', NULL, NULL, '2025-12-24 15:06:39', '2025-12-24 15:06:39'),
(50, 'App\\Models\\EmployeeLogin', 8, 'Employee Token', '5d81a7ec2774cd76ba647e2bc50011637154655a91da4ab0d53cbff8a09441ba', '[\"*\"]', NULL, NULL, '2025-12-24 16:31:16', '2025-12-24 16:31:16'),
(51, 'App\\Models\\EmployeeLogin', 19, 'Employee Token', '988e97ec417028f680563bafe786ac9b29616c4aeec0fed68856309cd604ee34', '[\"*\"]', NULL, NULL, '2025-12-24 16:34:16', '2025-12-24 16:34:16'),
(52, 'App\\Models\\EmployeeLogin', 3, 'Employee Token', '55d0e7830739189b2a24eea9a2856e2b1c7e30922119e0bcf1aaa981606454ca', '[\"*\"]', NULL, NULL, '2025-12-24 17:08:38', '2025-12-24 17:08:38'),
(53, 'App\\Models\\EmployeeLogin', 5, 'Employee Token', '28c808f181ed0b39231d927740412c1b2cdc8092d13467da6aaf15895dd4bf68', '[\"*\"]', NULL, NULL, '2025-12-24 17:10:03', '2025-12-24 17:10:03'),
(54, 'App\\Models\\EmployeeLogin', 12, 'Employee Token', '863890b5495c48653b2b1dedbd68786254af03fd0f6d3038696ac56e1bbcc0ae', '[\"*\"]', NULL, NULL, '2025-12-24 17:14:22', '2025-12-24 17:14:22'),
(55, 'App\\Models\\EmployeeLogin', 15, 'Employee Token', 'e9ed2eb412c9b376b58effac2316329b4e8a7611616d995b3ca31da43b721f3a', '[\"*\"]', NULL, NULL, '2025-12-24 17:14:38', '2025-12-24 17:14:38'),
(56, 'App\\Models\\EmployeeLogin', 1, 'Employee Token', '84a9f44a3ceab2f16c160f62371c2177765aaaeed5e8601f69a578b0aa4b2400', '[\"*\"]', NULL, NULL, '2025-12-25 20:07:13', '2025-12-25 20:07:13'),
(57, 'App\\Models\\EmployeeLogin', 4, 'Employee Token', 'b6621fcadd936430ad82ac936241a471eb70fe6460db8b4b78cf5dccc3f5aed3', '[\"*\"]', NULL, NULL, '2025-12-26 09:40:53', '2025-12-26 09:40:53'),
(58, 'App\\Models\\EmployeeLogin', 17, 'Employee Token', '1ddb17bf79b1b716c0255ec703bd1b589ba5b6cadc49b90d298a97890c1f3945', '[\"*\"]', NULL, NULL, '2025-12-26 09:44:14', '2025-12-26 09:44:14'),
(59, 'App\\Models\\EmployeeLogin', 20, 'Employee Token', '64735a0e1c5af24568ffa0de97c6f2bca37e3bb2d392bf90dd552657394ebf8f', '[\"*\"]', NULL, NULL, '2025-12-26 10:21:15', '2025-12-26 10:21:15'),
(60, 'App\\Models\\EmployeeLogin', 1, 'Employee Token', '55127039cee4f1f55186d115cffeaa1ad2c8fc559bc3f6dc8d79fe21c62a37ed', '[\"*\"]', NULL, NULL, '2025-12-26 10:21:59', '2025-12-26 10:21:59'),
(61, 'App\\Models\\EmployeeLogin', 20, 'Employee Token', '6ccc237fff54099d9f9d6ca55f955c1e874a06e45af2cc2dd64815882158e7a9', '[\"*\"]', NULL, NULL, '2025-12-26 10:25:03', '2025-12-26 10:25:03'),
(62, 'App\\Models\\EmployeeLogin', 20, 'Employee Token', 'e5e2ca7edb3c2f128541086ddc3e3fb1f645cac55759e8fcfb3e2e35ea07d74e', '[\"*\"]', NULL, NULL, '2025-12-26 11:38:20', '2025-12-26 11:38:20'),
(63, 'App\\Models\\EmployeeLogin', 20, 'Employee Token', '49d92fb5e7672419c18ef25d32b8ce469cddd1aa3234ac49e169c0dda963b267', '[\"*\"]', NULL, NULL, '2025-12-26 12:09:40', '2025-12-26 12:09:40'),
(64, 'App\\Models\\EmployeeLogin', 8, 'Employee Token', '9a60bb7d9a498bbd49eafcce9d2ac8ae3a573979f4974eddaedf612eb3542a96', '[\"*\"]', NULL, NULL, '2025-12-26 12:36:47', '2025-12-26 12:36:47'),
(65, 'App\\Models\\EmployeeLogin', 1, 'Employee Token', '62e6183505d6637eba414f5a6150508393fdc0144467e87bd10d99a64111a220', '[\"*\"]', NULL, NULL, '2025-12-29 14:41:28', '2025-12-29 14:41:28'),
(66, 'App\\Models\\EmployeeLogin', 20, 'Employee Token', '953b5b09fe45aab6801500c2f99854f280f0a0791e087e4955aaf3cf431d96d5', '[\"*\"]', NULL, NULL, '2025-12-30 11:20:35', '2025-12-30 11:20:35'),
(67, 'App\\Models\\EmployeeLogin', 2, 'Employee Token', '2f4a3c6a456c578e3fe83cf9f23d145cc59a99984d118fae69ee68aaabda67b7', '[\"*\"]', NULL, NULL, '2025-12-30 11:24:50', '2025-12-30 11:24:50'),
(68, 'App\\Models\\EmployeeLogin', 2, 'Employee Token', '206c14e7c4c797684a22207d7bc1aa07e76237446fde2be01491461573ffecb1', '[\"*\"]', NULL, NULL, '2025-12-30 11:31:51', '2025-12-30 11:31:51'),
(69, 'App\\Models\\EmployeeLogin', 2, 'Employee Token', 'a9997a2929995f366917578bba2b24c807ddd2d9dfd8a5a89a58c33f410e589f', '[\"*\"]', NULL, NULL, '2025-12-30 11:37:08', '2025-12-30 11:37:08'),
(70, 'App\\Models\\EmployeeLogin', 20, 'Employee Token', '09a079016bd4aa02f831f901c0f8c6109b749b139621f7f527dcac16d21d4e19', '[\"*\"]', NULL, NULL, '2025-12-30 11:54:29', '2025-12-30 11:54:29'),
(71, 'App\\Models\\EmployeeLogin', 20, 'Employee Token', 'c0d2a40f493f63446286e2287d0a0845bc628d861b4ca534fb8213a7bfd9937e', '[\"*\"]', NULL, NULL, '2025-12-30 13:01:38', '2025-12-30 13:01:38'),
(72, 'App\\Models\\EmployeeLogin', 2, 'Employee Token', '708c33d92ca8e926791310c31456d45fa12b5680b0c7802019cf16b45f97f50c', '[\"*\"]', NULL, NULL, '2025-12-30 13:47:55', '2025-12-30 13:47:55'),
(73, 'App\\Models\\EmployeeLogin', 20, 'Employee Token', '71aef2230c7c6fb1e721789e8882bcb04741592cda35db3561b9fec07ecc87cf', '[\"*\"]', NULL, NULL, '2025-12-30 13:54:05', '2025-12-30 13:54:05'),
(74, 'App\\Models\\EmployeeLogin', 20, 'Employee Token', '29b7936d928ea31acf362f08527be5a461be809d7376d283a9a4c579d1150c50', '[\"*\"]', NULL, NULL, '2025-12-30 18:05:47', '2025-12-30 18:05:47'),
(75, 'App\\Models\\EmployeeLogin', 4, 'Employee Token', 'e308266efbc5792c889329dceabf47020fac560c63769ec48ecefb92d4c86450', '[\"*\"]', NULL, NULL, '2025-12-31 08:57:40', '2025-12-31 08:57:40'),
(76, 'App\\Models\\EmployeeLogin', 2, 'Employee Token', 'a6df89afe08672d059f24f69938e6d2cdd44c33d1ed59de475c9da873e495af4', '[\"*\"]', NULL, NULL, '2025-12-31 19:47:51', '2025-12-31 19:47:51'),
(77, 'App\\Models\\EmployeeLogin', 10, 'Employee Token', 'e6e68f8b1c9d7787259be81c31dbe8e51a933fc68cb047fdc220895604b2d902', '[\"*\"]', NULL, NULL, '2026-01-01 08:59:51', '2026-01-01 08:59:51');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_provider_name` varchar(255) NOT NULL,
  `registration_date` date NOT NULL,
  `expiration_date` date NOT NULL,
  `product_price` decimal(10,2) DEFAULT NULL,
  `product_description` text DEFAULT NULL,
  `status` enum('active','inactive','expired','cancelled') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `project_id`, `product_name`, `product_provider_name`, `registration_date`, `expiration_date`, `product_price`, `product_description`, `status`, `created_at`, `updated_at`) VALUES
(2, 3, 'Amos Munoz', 'Ifeoma Page', '1992-09-30', '2023-09-01', 828.00, 'Qui consequatur offi', 'expired', '2026-01-08 08:55:12', '2026-01-08 08:55:12'),
(3, 2, 'Xandra Branch', 'Mohammad Wyatt', '2016-06-15', '2021-08-09', 830.00, 'Cum obcaecati ad ess', 'expired', '2026-01-08 09:04:28', '2026-01-08 09:04:28'),
(5, 2, 'Yasir Caldwell', 'Bo Hicks', '1992-02-18', '1996-04-25', 328.00, 'Tempor est temporib', 'expired', '2026-01-08 09:04:46', '2026-01-08 09:04:46'),
(6, 3, 'Amela Hinton', 'Mercedes Garrison', '2008-10-21', '2024-06-12', 915.00, 'Ipsum rerum mollit a', 'expired', '2026-01-08 09:05:11', '2026-01-08 09:05:11'),
(7, 3, 'Sage Fry', 'Keegan Nichols', '2007-01-28', '2021-05-29', 458.00, 'Facilis aut distinct', 'expired', '2026-01-08 09:05:17', '2026-01-08 09:05:17'),
(8, 3, 'Macy Humphrey', 'Jade Hall', '2025-05-26', '2026-02-06', 123.00, 'Nisi exercitation se', 'active', '2026-01-08 09:05:33', '2026-01-08 09:05:33'),
(9, 2, 'Chantale Mcdonald', 'Hannah Phillips', '1985-04-25', '2024-08-23', 533.00, 'Saepe dolor eligendi', 'expired', '2026-01-08 09:17:48', '2026-01-08 09:17:48'),
(10, 3, 'gps tracker devicce', 'tentakalo', '2026-01-12', '2030-01-29', 5500.00, 'purchased from justdial', 'active', '2026-01-12 07:07:46', '2026-01-12 07:07:46');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `client_name` varchar(255) DEFAULT NULL,
  `client_email` varchar(255) DEFAULT NULL,
  `client_phone` varchar(255) DEFAULT NULL,
  `project_type` varchar(255) NOT NULL DEFAULT 'software_development',
  `priority` varchar(255) NOT NULL DEFAULT 'medium',
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `estimated_budget` decimal(15,2) DEFAULT NULL,
  `actual_budget` decimal(15,2) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'planning',
  `technologies` text DEFAULT NULL,
  `requirements` text DEFAULT NULL,
  `project_manager_id` varchar(255) DEFAULT NULL,
  `team_members` text DEFAULT NULL,
  `progress_percentage` int(11) NOT NULL DEFAULT 0,
  `notes` text DEFAULT NULL,
  `repository_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `project_id`, `name`, `description`, `client_name`, `client_email`, `client_phone`, `project_type`, `priority`, `start_date`, `end_date`, `estimated_budget`, `actual_budget`, `status`, `technologies`, `requirements`, `project_manager_id`, `team_members`, `progress_percentage`, `notes`, `repository_url`, `created_at`, `updated_at`) VALUES
(2, 'PRJ-2026-7255', 'testttt', 'test', 'testtt', 'test@gmail.com', '9096879903', 'web_app', 'medium', '2026-01-03', '2026-01-24', 9000000.00, NULL, 'planning', '[\"laravel\",\"react\"]', 'test', '325', '[\"139\",\"455\",\"991\",\"594\",\"010\",\"622\"]', 44, 'testtttt', NULL, '2026-01-03 11:48:28', '2026-01-07 09:29:32'),
(3, 'PRJ-2026-0478', 'Meta', 'Update project details, modify team assignments, and adjust project parametersUpdate project details, modify team assignments, and adjust project parametersUpdate project details, modify team assignments, and adjust project parametersUpdate project details, modify team assignments, and adjust project parametersUpdate project details, modify team assignments, and adjust project parametersUpdate project details, modify team assignments, and adjust project parametersUpdate project details, modify team assignments, and adjust project parameters', 'Elon Musk', 'elon@elon.com', '+1 5566994490', 'software_development', 'critical', '2026-01-05', '2026-01-14', 100000000.00, NULL, 'planning', NULL, 'Update project details, modify team assignments, and adjust project parametersUpdate project details, modify team assignments, and adjust project parametersUpdate project details, modify team assignments, and adjust project parametersUpdate project details, modify team assignments, and adjust project parametersUpdate project details, modify team assignments, and adjust project parametersUpdate project details, modify team assignments, and adjust project parametersUpdate project details, modify team assignments, and adjust project parametersUpdate project details, modify team assignments, and adjust project parametersUpdate project details, modify team assignments, and adjust project parametersUpdate project details, modify team assignments, and adjust project parametersUpdate project details, modify team assignments, and adjust project parametersUpdate project details, modify team assignments, and adjust project parametersUpdate project details, modify team assignments, and adjust project parameters', NULL, NULL, 90, 'Update project details, modify team assignments, and adjust project parametersUpdate project details, modify team assignments, and adjust project parametersUpdate project details, modify team assignments, and adjust project parametersUpdate project details, modify team assignments, and adjust project parametersUpdate project details, modify team assignments, and adjust project parametersUpdate project details, modify team assignments, and adjust project parameters', NULL, '2026-01-05 11:03:33', '2026-01-08 08:30:46');

-- --------------------------------------------------------

--
-- Table structure for table `salaries`
--

CREATE TABLE `salaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `salary_amount` decimal(12,2) NOT NULL,
  `pan_number` varchar(255) DEFAULT NULL,
  `aadhaar_number` varchar(12) DEFAULT NULL,
  `account_holder_name` varchar(255) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `ifsc_code` varchar(255) NOT NULL,
  `branch_name` varchar(255) DEFAULT NULL,
  `effective_date` date NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `basic_salary` decimal(10,2) DEFAULT NULL,
  `hra` decimal(10,2) DEFAULT NULL,
  `conveyance` decimal(10,2) DEFAULT NULL,
  `medical_allowance` decimal(10,2) DEFAULT NULL,
  `lta` decimal(10,2) DEFAULT NULL,
  `special_allowance` decimal(10,2) DEFAULT NULL,
  `provident_fund` decimal(10,2) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
('U8H1cVlUyh3gCjvISDpiKNdiV0mOKdRJcafKLDt6', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiZkI0UEEyUlF0WldaMnFvTU9LcElQcmxUdzMzSlBPaWhoNXU0QUNGViI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9hY2Nlc3Nvcmllcy9jcmVhdGUiO3M6NToicm91dGUiO3M6MjQ6ImFkbWluLmFjY2Vzc29yaWVzLmNyZWF0ZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjU7czo0OiJhdXRoIjthOjE6e3M6MjE6InBhc3N3b3JkX2NvbmZpcm1lZF9hdCI7aToxNzcxMjM4NDUzO31zOjEzOiJsYXN0X2FjdGl2aXR5IjtpOjE3NzEyNDIwNzY7fQ==', 1771242076),
('v1kSC5qbru3pQFE29CYAL2H3Gw8vx0Oh7EBFhGSL', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiR1Y2N1hOWkZ6SzlLNmc0Vmo1aHhOSkRmVDl5eUUxY1ZZcXlGNGNETSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jZW8vdGVhbS1hbGxvY2F0aW9uIjtzOjU6InJvdXRlIjtzOjI1OiJjZW8udGVhbS1hbGxvY2F0aW9uLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fY2VvXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Njt9', 1771238840),
('yXlYxMhvm8WLwvGo20zOGDUHAXL0OVgNvFO2FNlA', 23, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiSHV3a1pvRWNaMWs0RHUxMjJCTGlBYnRaOE12blZXaEVnc2JSTk11NiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjUwOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvZW1wbG95ZWUvdGFzay1yZXBvcnRzL2NyZWF0ZSI7czo1OiJyb3V0ZSI7czoyODoiZW1wbG95ZWUudGFzay1yZXBvcnRzLmNyZWF0ZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTU6ImxvZ2luX2VtcGxveWVlXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjM7fQ==', 1771240126);

-- --------------------------------------------------------

--
-- Table structure for table `team_allocations`
--

CREATE TABLE `team_allocations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `role` enum('lead','developer','designer','tester','analyst','manager') NOT NULL DEFAULT 'developer',
  `allocation_status` enum('active','inactive','completed') NOT NULL DEFAULT 'active',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `allocation_percentage` decimal(5,2) NOT NULL DEFAULT 100.00,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `universal_attendance_logs`
--

CREATE TABLE `universal_attendance_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `universal_qr_code_id` bigint(20) UNSIGNED DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `scan_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ip_address` varchar(255) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `universal_attendance_logs`
--

INSERT INTO `universal_attendance_logs` (`id`, `employee_id`, `universal_qr_code_id`, `action`, `scan_time`, `ip_address`, `user_agent`, `notes`, `created_at`, `updated_at`) VALUES
(97, 20, 9, 'punch_in', '2026-01-01 08:36:20', '157.33.242.220', 'Dart/3.10 (dart:io)', NULL, '2026-01-01 08:36:20', '2026-01-01 08:36:20'),
(98, 1, 9, 'punch_in', '2026-01-01 08:42:29', '103.173.240.85', 'Dart/3.10 (dart:io)', NULL, '2026-01-01 08:42:29', '2026-01-01 08:42:29'),
(99, 11, 9, 'punch_in', '2026-01-01 08:54:32', '103.173.240.85', 'Dart/3.10 (dart:io)', NULL, '2026-01-01 08:54:32', '2026-01-01 08:54:32'),
(100, 8, 9, 'punch_in', '2026-01-01 08:56:00', '103.173.240.85', 'Dart/3.10 (dart:io)', NULL, '2026-01-01 08:56:00', '2026-01-01 08:56:00'),
(101, 5, 9, 'punch_in', '2026-01-01 08:56:50', '103.173.240.85', 'Dart/3.10 (dart:io)', NULL, '2026-01-01 08:56:50', '2026-01-01 08:56:50'),
(102, 12, 9, 'punch_in', '2026-01-01 08:57:24', '103.173.240.85', 'Dart/3.10 (dart:io)', NULL, '2026-01-01 08:57:24', '2026-01-01 08:57:24'),
(103, 2, 9, 'punch_in', '2026-01-01 08:58:14', '103.173.240.85', 'Dart/3.10 (dart:io)', NULL, '2026-01-01 08:58:14', '2026-01-01 08:58:14'),
(106, 3, 9, 'punch_in', '2026-01-01 09:02:57', '103.173.240.85', 'Dart/3.10 (dart:io)', NULL, '2026-01-01 09:02:57', '2026-01-01 09:02:57'),
(107, 14, 9, 'punch_in', '2026-01-01 09:03:26', '103.173.240.85', 'Dart/3.10 (dart:io)', NULL, '2026-01-01 09:03:26', '2026-01-01 09:03:26'),
(108, 6, 9, 'punch_in', '2026-01-01 09:03:48', '103.173.240.85', 'Dart/3.10 (dart:io)', NULL, '2026-01-01 09:03:48', '2026-01-01 09:03:48'),
(109, 7, 9, 'punch_in', '2026-01-01 09:07:29', '103.173.240.85', 'Dart/3.10 (dart:io)', NULL, '2026-01-01 09:07:29', '2026-01-01 09:07:29'),
(110, 19, 9, 'punch_in', '2026-01-01 09:13:20', '103.173.240.85', 'Dart/3.10 (dart:io)', NULL, '2026-01-01 09:13:20', '2026-01-01 09:13:20'),
(111, 10, 9, 'punch_in', '2026-01-01 09:18:14', '103.173.240.85', 'Dart/3.10 (dart:io)', NULL, '2026-01-01 09:18:14', '2026-01-01 09:18:14');

-- --------------------------------------------------------

--
-- Table structure for table `universal_qr_codes`
--

CREATE TABLE `universal_qr_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `qr_identifier` varchar(255) NOT NULL,
  `qr_secret` varchar(255) NOT NULL,
  `qr_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`qr_data`)),
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `universal_qr_codes`
--

INSERT INTO `universal_qr_codes` (`id`, `qr_identifier`, `qr_secret`, `qr_data`, `is_active`, `expires_at`, `created_by`, `notes`, `created_at`, `updated_at`) VALUES
(8, 'UNIVERSAL_6944d6fc53e27_1766119164', '8ab53b5eaa778ad168fc334b9072ca43', '{\"type\": \"universal\", \"purpose\": \"HR Backup Attendance System\", \"created_at\": 1766119164, \"identifier\": \"UNIVERSAL_6944d6fc53e27_1766119164\", \"min_gap_hours\": \"4\"}', 1, NULL, 'hr', NULL, '2025-12-19 10:09:24', '2025-12-19 10:09:24'),
(9, 'UNIVERSAL_694b848cda277_1766556812', '734138a2cd8f2f2020fe4a8155f4ba1c', '{\"type\": \"universal\", \"purpose\": \"HR Backup Attendance System\", \"created_at\": 1766556812, \"identifier\": \"UNIVERSAL_694b848cda277_1766556812\", \"min_gap_hours\": \"4\"}', 1, NULL, 'hr', NULL, '2025-12-24 11:43:32', '2025-12-24 11:43:32');

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
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('admin','ceo') NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(5, 'hr', 'hr@techmetworks.com', NULL, '$2y$12$6/.nz0KgwXUa0EgQKUioPO5feLLz5Cr8x8YlUfbS4iu3d82P6TEwu', NULL, '2025-12-10 12:18:11', '2025-12-10 12:18:11', 'admin'),
(6, 'CEO', 'ceo@gmail.com', NULL, '$2y$12$WdYJSETDEznL5MJsthISbOEZOQSXZ15RMFNx43DxqUsmiOgVbUvTG', NULL, '2025-12-24 04:37:49', '2025-12-24 04:37:49', 'ceo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_calendars`
--
ALTER TABLE `academic_calendars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accessories`
--
ALTER TABLE `accessories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accessories_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendances_employee_id_date_index` (`employee_id`,`date`),
  ADD KEY `attendances_date_index` (`date`);

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
-- Indexes for table `daily_task_reports`
--
ALTER TABLE `daily_task_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `daily_task_reports_employee_id_report_date_index` (`employee_id`,`report_date`),
  ADD KEY `daily_task_reports_status_index` (`status`);

--
-- Indexes for table `daily_task_report_items`
--
ALTER TABLE `daily_task_report_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `daily_task_report_items_daily_task_report_id_index` (`daily_task_report_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `documents_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employees_employee_id_unique` (`employee_id`),
  ADD UNIQUE KEY `employees_email_unique` (`email`),
  ADD UNIQUE KEY `employees_aadhaar_number_unique` (`aadhaar_number`),
  ADD UNIQUE KEY `employees_wfh_pin_unique` (`wfh_pin`),
  ADD KEY `employees_wfh_pin_index` (`wfh_pin`);

--
-- Indexes for table `employee_logins`
--
ALTER TABLE `employee_logins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_logins_email_unique` (`email`),
  ADD KEY `employee_logins_employee_id_foreign` (`employee_id`);

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
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leaves_approved_by_foreign` (`approved_by`),
  ADD KEY `leaves_employee_id_status_index` (`employee_id`,`status`),
  ADD KEY `leaves_start_date_end_date_index` (`start_date`,`end_date`),
  ADD KEY `leaves_status_index` (`status`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monthly_salaries`
--
ALTER TABLE `monthly_salaries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `monthly_salaries_employee_id_salary_year_salary_month_unique` (`employee_id`,`salary_year`,`salary_month`),
  ADD KEY `monthly_salaries_employee_id_salary_year_salary_month_index` (`employee_id`,`salary_year`,`salary_month`),
  ADD KEY `monthly_salaries_status_index` (`status`),
  ADD KEY `monthly_salaries_salary_year_salary_month_index` (`salary_year`,`salary_month`);

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
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_project_id_status_index` (`project_id`,`status`),
  ADD KEY `products_expiration_date_index` (`expiration_date`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `projects_project_id_unique` (`project_id`),
  ADD KEY `projects_status_priority_index` (`status`,`priority`),
  ADD KEY `projects_project_manager_id_index` (`project_manager_id`);

--
-- Indexes for table `salaries`
--
ALTER TABLE `salaries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `salaries_employee_id_unique` (`employee_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `team_allocations`
--
ALTER TABLE `team_allocations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `team_allocations_project_id_employee_id_unique` (`project_id`,`employee_id`),
  ADD KEY `team_allocations_project_id_allocation_status_index` (`project_id`,`allocation_status`),
  ADD KEY `team_allocations_employee_id_allocation_status_index` (`employee_id`,`allocation_status`);

--
-- Indexes for table `universal_attendance_logs`
--
ALTER TABLE `universal_attendance_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `universal_attendance_logs_employee_id_scan_time_index` (`employee_id`,`scan_time`),
  ADD KEY `universal_attendance_logs_action_index` (`action`),
  ADD KEY `universal_attendance_logs_universal_qr_code_id_index` (`universal_qr_code_id`);

--
-- Indexes for table `universal_qr_codes`
--
ALTER TABLE `universal_qr_codes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `universal_qr_codes_qr_identifier_unique` (`qr_identifier`),
  ADD KEY `universal_qr_codes_qr_identifier_index` (`qr_identifier`),
  ADD KEY `universal_qr_codes_is_active_index` (`is_active`);

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
-- AUTO_INCREMENT for table `academic_calendars`
--
ALTER TABLE `academic_calendars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `accessories`
--
ALTER TABLE `accessories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `daily_task_reports`
--
ALTER TABLE `daily_task_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `daily_task_report_items`
--
ALTER TABLE `daily_task_report_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `employee_logins`
--
ALTER TABLE `employee_logins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `monthly_salaries`
--
ALTER TABLE `monthly_salaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `salaries`
--
ALTER TABLE `salaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `team_allocations`
--
ALTER TABLE `team_allocations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `universal_attendance_logs`
--
ALTER TABLE `universal_attendance_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `universal_qr_codes`
--
ALTER TABLE `universal_qr_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accessories`
--
ALTER TABLE `accessories`
  ADD CONSTRAINT `accessories_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `daily_task_reports`
--
ALTER TABLE `daily_task_reports`
  ADD CONSTRAINT `daily_task_reports_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `daily_task_report_items`
--
ALTER TABLE `daily_task_report_items`
  ADD CONSTRAINT `daily_task_report_items_daily_task_report_id_foreign` FOREIGN KEY (`daily_task_report_id`) REFERENCES `daily_task_reports` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employee_logins`
--
ALTER TABLE `employee_logins`
  ADD CONSTRAINT `employee_logins_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `leaves`
--
ALTER TABLE `leaves`
  ADD CONSTRAINT `leaves_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `employees` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `leaves_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `monthly_salaries`
--
ALTER TABLE `monthly_salaries`
  ADD CONSTRAINT `monthly_salaries_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `salaries`
--
ALTER TABLE `salaries`
  ADD CONSTRAINT `salaries_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `team_allocations`
--
ALTER TABLE `team_allocations`
  ADD CONSTRAINT `team_allocations_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `team_allocations_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `universal_attendance_logs`
--
ALTER TABLE `universal_attendance_logs`
  ADD CONSTRAINT `universal_attendance_logs_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `universal_attendance_logs_universal_qr_code_id_foreign` FOREIGN KEY (`universal_qr_code_id`) REFERENCES `universal_qr_codes` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
