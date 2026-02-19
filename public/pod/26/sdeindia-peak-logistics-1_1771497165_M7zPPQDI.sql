-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 16, 2026 at 10:08 AM
-- Server version: 8.0.45
-- PHP Version: 8.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sdeindia_peak_logistics`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_panels`
--

CREATE TABLE `admin_panels` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `billing_entities`
--

CREATE TABLE `billing_entities` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `is_active`, `created_at`, `updated_at`, `logo`) VALUES
(1, 'tata', 'tata', 1, '2026-01-20 23:57:07', '2026-01-21 01:52:43', 'logos/1768980163_WhatsApp Image 2025-12-19 at 11.53.15 AM.jpeg'),
(2, 'Toyota', 'toyota', 1, '2026-01-21 01:52:14', '2026-01-21 01:52:14', 'logos/1768980134_WhatsApp Image 2025-12-19 at 11.53.15 AM.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cargo_types`
--

CREATE TABLE `cargo_types` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cargo_types`
--

INSERT INTO `cargo_types` (`id`, `title`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'cargoType1', NULL, 'assets/cargoImages/cargo_6989b0bd78103.jpeg', '2026-02-09 10:02:37', '2026-02-09 10:02:37'),
(2, 'cargotype2', NULL, 'assets/cargoImages/cargo2_6989bc51dc3a7.png', '2026-02-09 10:03:16', '2026-02-09 10:52:01'),
(3, 'dsdsa', NULL, NULL, '2026-02-09 10:03:28', '2026-02-09 10:03:28');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` bigint UNSIGNED NOT NULL,
  `hub_id` bigint UNSIGNED DEFAULT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `timezone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `country_id`, `hub_id`, `postal_code`, `latitude`, `longitude`, `timezone`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'test', 1, NULL, '12345', 25.12345600, 50.12345600, 'Asia', 1, 2, 2, '2026-01-22 01:50:05', '2026-01-22 01:50:05');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci,
  `billing_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `billing_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `franchise` bigint UNSIGNED DEFAULT NULL,
  `mobile_no` longtext COLLATE utf8mb4_unicode_ci,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `address`, `billing_name`, `billing_address`, `franchise`, `mobile_no`, `email`, `password`, `photo`, `created_at`, `updated_at`) VALUES
(1, 'raj', '[\"123 Main St\",\"Apt 4B\",\"Anytown, USA\"]', NULL, NULL, NULL, '[\"9999999999\"]', 'raj147@gmail.com', '$2y$12$14RI/G365dmhlThN5/tLp.PvavKm/d5dWwFY8Jnr8IC/AvI0iZGlG', 'customer_photos/1770186265_WhatsApp Image 2026-01-06 at 7.57.22 PM.jpeg', '2026-02-04 00:51:11', '2026-02-04 00:54:25'),
(2, 'John Doe', '[\"123 Main St\",\"Apt 4B\",\"Anytown, USA\"]', 'Mayur Jawale', 'College road, Nashik', NULL, '[\"9999999999\",\"8888888888\",\"2222222222\"]', 'john.doe@example.com', '$2y$12$RbqzQYhVYKDN/p/eCBQyuOX1zb2isAAnxXHNF4F1LU6Z2tLMAYbVS', NULL, '2026-02-06 05:34:44', '2026-02-06 05:34:44'),
(3, 'nilesh pathak', '[\"nashik\",\"america\"]', 'mayur jawale', 'wfewjfnwkfw f', NULL, '[\"9394939493\",\"9999999999\"]', 'mayurjawale999@example.com', '$2y$12$hKf6qzMB0cmPj0balIlCYuGu/P4ZZ5EhJUqt70wX1m3Zvq2GIm3Ei', 'customer_photos/customer_3_698efc678c627.png', '2026-02-06 05:53:52', '2026-02-13 10:26:47'),
(4, 'Mayur', '[\"123 Main St\",\"Apt 4B\",\"Anytown, USA\"]', 'Mayur Jawale', 'College road, Nashik', NULL, '[\"9999999999\",\"8888888888\",\"2222222222\"]', 'mj@gmail.com', '$2y$12$lxVCGOTiy/m5zrHUFNGrYuF7/VvDCKL8eQrWZoJ3q3DYLML4EgyPy', NULL, '2026-02-06 23:39:20', '2026-02-06 23:39:20'),
(5, 'Mayur', '[\"123 Main St\",\"Apt 4B\",\"Anytown, USA\"]', 'Mayur Jawale', 'College road, Nashik', NULL, '[\"9999999999\",\"8888888888\",\"2222222222\"]', 'mj1@gmail.com', '$2y$12$oV2R3rLBlMBKnA82vVCWAu2n34vRVmQ9qpdAHbk56EY5CKTZamf8O', NULL, '2026-02-07 07:09:32', '2026-02-07 07:09:32'),
(6, 'nilesh', '[\"123 Main St\",\"Apt 4B\",\"Anytown, USA\"]', 'Mayur Jawale', 'College road, Nashik', NULL, '[\"7777777788\"]', 'pathak1998@gmail.com.com', '$2y$12$xvJxKSNO7GdeBZC/EfBV..rwLrORWpEs7hPth1VHyK.A4zHsNq7IC', NULL, '2026-02-07 08:31:19', '2026-02-07 08:31:19'),
(7, 'densh', '[\"123 Main St\",\"Apt 4B\",\"Anytown, USA\"]', 'Mayur Jawale', 'College road, Nashik', NULL, '[\"7777777787\",\"8888888888\",\"2222222222\"]', 'pathak199@gmail.com.com', '$2y$12$4HKIy68NK7HUTF0nKXF2cerwUZgmtwVyUNzrveaRIbLGJGyjdVSSW', NULL, '2026-02-07 08:44:21', '2026-02-07 08:44:21'),
(8, 'nilesh', '[\"pathaknilesh1998@gmail.com\"]', '1234', 'nashii', NULL, '[\"917756011548\"]', 'pathaknilesh1998@gmail.com', '$2y$12$H29vchRnYf3g.4Nfn9gXkuCA3QDRlqzZm8NFuX9XmYMWi9om9bPli', NULL, '2026-02-07 08:47:55', '2026-02-07 08:47:55'),
(9, 'sumit', '[\"demo@gmail.com\"]', 'nashik', 'address', NULL, '[\"919834705267\"]', 'test@gmail.com', '$2y$12$z4Uiivw3qrwkzYeI/yd.nOddlAvMKBBnFCqldZ6G8oxv0sjKcLz5i', NULL, '2026-02-07 09:06:25', '2026-02-07 09:06:25'),
(10, 'pritesh', '[\"nashik\"]', 'nashik', 'sdsd', NULL, '[\"917756011549\"]', 'demo@gmail.com', '$2y$12$7yGhfENzQhqEl/KGrRt4duvf8EohRD.Kri.GlzVfkfCOZZl9kAvrO', NULL, '2026-02-07 09:30:22', '2026-02-07 09:30:22'),
(11, 'Mayur', '[\"123 Main St\",\"Apt 4B\",\"Anytown, USA\"]', 'Mayur Jawale', 'College road, Nashik', 11, '[\"9999999999\",\"8888888888\",\"2222222222\"]', 'mj2@gmail.com', '$2y$12$lDVciCB0FL3d91hdGSQjG.7DHV/k7bTpMBdEeQE.PR8QxlM098dP6', NULL, '2026-02-10 07:26:45', '2026-02-10 07:26:45');

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `id` bigint UNSIGNED NOT NULL,
  `driver_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationality` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `blood_group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alternateMobile` json DEFAULT NULL,
  `franchise` bigint UNSIGNED DEFAULT NULL,
  `emergency_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emergencyRelation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `residenceId` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passportExpiryDate` date DEFAULT NULL,
  `residencePermitStatus` enum('valid','expired') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `LicenseCategory` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `LicenseValidity` date DEFAULT NULL,
  `vehicleBrandAndModel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vehicleManufactureYear` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vehicleRegstrationNo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vehicleFuelType` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `heavyVehiclePermit` enum('valid','expired') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `InsuranceExpiryDate` date DEFAULT NULL,
  `LicenseExpiryDate` date DEFAULT NULL,
  `LicenseExpiryAlert` tinyint(1) NOT NULL DEFAULT '0',
  `drivingLicenseNo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `driverType` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `driverPhoto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `drivingLicense` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vehicleInsurance` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `consent` tinyint(1) NOT NULL DEFAULT '0',
  `TermsConditions` tinyint(1) NOT NULL DEFAULT '0',
  `RlcGatepass` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MicGatepass` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qatarId` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `license_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `license_expiry` date NOT NULL,
  `license_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_trips` int NOT NULL DEFAULT '0',
  `experience_years` int NOT NULL,
  `status` enum('on_duty','off_duty','on_leave') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'off_duty',
  `avatar_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `recordedAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`id`, `driver_id`, `name`, `email`, `nationality`, `dob`, `blood_group`, `phone`, `alternateMobile`, `franchise`, `emergency_phone`, `emergencyRelation`, `residenceId`, `passport`, `passportExpiryDate`, `residencePermitStatus`, `LicenseCategory`, `LicenseValidity`, `vehicleBrandAndModel`, `vehicleManufactureYear`, `vehicleRegstrationNo`, `vehicleFuelType`, `heavyVehiclePermit`, `InsuranceExpiryDate`, `LicenseExpiryDate`, `LicenseExpiryAlert`, `drivingLicenseNo`, `driverType`, `driverPhoto`, `drivingLicense`, `vehicleInsurance`, `consent`, `TermsConditions`, `RlcGatepass`, `MicGatepass`, `qatarId`, `address`, `license_number`, `license_expiry`, `license_type`, `total_trips`, `experience_years`, `status`, `avatar_path`, `created_at`, `updated_at`, `latitude`, `longitude`, `recordedAt`) VALUES
(1, 'DRV001', 'Rajesh Kumar', '', NULL, NULL, 'O+', '9876543210', NULL, NULL, '+91 9876543211', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, '123 Main Street, Mumbai, Maharashtra 400001', 'MH0123456789', '2025-12-31', 'Heavy Motor Vehicle', 150, 8, 'off_duty', NULL, '2026-01-21 01:45:36', '2026-02-11 07:21:53', 19.9840804, 73.7553243, '2026-02-11 07:21:00'),
(2, 'DRV002', 'Amit Singh', '', NULL, NULL, 'A+', '+91 9876543212', NULL, NULL, '+91 9876543213', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, '456 Park Avenue, Delhi, Delhi 110001', 'DL0123456789', '2026-06-15', 'Light Motor Vehicle', 200, 10, 'on_duty', NULL, '2026-01-21 01:45:36', '2026-01-21 01:45:36', NULL, NULL, NULL),
(3, 'DRV003', 'Suresh Patel', '', NULL, NULL, 'B+', '+91 9876543214', NULL, NULL, '+91 9876543215', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, '789 Gandhi Road, Ahmedabad, Gujarat 380001', 'GJ0123456789', '2025-08-20', 'Transport Vehicle', 120, 6, 'off_duty', NULL, '2026-01-21 01:45:36', '2026-01-21 01:45:36', NULL, NULL, NULL),
(4, 'DRV004', 'Vikram Sharma', '', NULL, NULL, 'AB+', '+91 9876543216', NULL, NULL, '+91 9876543217', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, '321 Ring Road, Bangalore, Karnataka 560001', 'KA0123456789', '2026-03-10', 'Heavy Motor Vehicle', 180, 9, 'on_duty', NULL, '2026-01-21 01:45:36', '2026-01-21 01:45:36', NULL, NULL, NULL),
(5, 'DRV005', 'Mohan Reddy', '', NULL, NULL, 'O-', '+91 9876543218', NULL, NULL, '+91 9876543219', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, '654 MG Road, Hyderabad, Telangana 500001', 'TS0123456789', '2025-11-05', 'Light Motor Vehicle', 95, 5, 'off_duty', NULL, '2026-01-21 01:45:36', '2026-01-21 01:45:36', 18.9977460, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `driving_teams`
--

CREATE TABLE `driving_teams` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `driver_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emergency_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `blood_group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `license_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `license_expiry` date NOT NULL,
  `license_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `experience` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `driver_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `license_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `kyc_status` enum('pending','under_review','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `driving_teams`
--

INSERT INTO `driving_teams` (`id`, `created_at`, `updated_at`, `name`, `driver_id`, `phone_number`, `emergency_number`, `address`, `blood_group`, `license_number`, `license_expiry`, `license_type`, `experience`, `driver_photo`, `license_photo`, `status`, `kyc_status`) VALUES
(1, '2026-01-21 00:51:20', '2026-01-21 01:08:30', 'test', '101', '9096879903', '9090676767', 'AT POST NAGARDEOLA , waghnagar , near grampanchaayat', 'O positive', 'jsnjfnsf12341234', '2026-02-07', '4 wheeler', '2 years', 'driver_photos/1768977510_e0cca17b-652a-429d-b960-9f5301760f82.jpeg', 'license_photos/1768976480_Geography (Cities).png', 'active', 'pending'),
(2, '2026-01-21 03:15:51', '2026-01-21 03:17:29', 'aakash', '0002', '+919096879903', '9090676767', 'AT POST NAGARDEOLA , waghnagar , near grampanchaayat', 'A+', 'jsnjfnf12341234', '2026-01-31', 'commercial', '9 years', 'driver_photos/1768985151_WhatsApp Image 2026-01-13 at 4.34.43 PM.jpeg', 'license_photos/1768985151_Geography (Cities).png', 'active', 'approved'),
(3, '2026-01-22 04:08:24', '2026-01-22 04:08:44', 'Aspen Rogers', 'Vel quibusdam dolor', '+1 (463) 268-9304', '+1 (397) 968-4912', 'Recusandae Voluptas', 'O+', '256', '2004-12-15', 'Enim ut dolor delect', 'Delectus pariatur', 'driver_photos/1769074704_WhatsApp Image 2026-01-13 at 4.34.43 PM.jpeg', 'license_photos/1769074704_screencapture-127-0-0-1-8000-admin-team-members-2026-01-21-16_29_32.png', 'active', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fleets`
--

CREATE TABLE `fleets` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `franchises`
--

CREATE TABLE `franchises` (
  `id` bigint UNSIGNED NOT NULL,
  `country_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `has_tax` tinyint(1) NOT NULL DEFAULT '0',
  `tax_percentage` decimal(5,2) NOT NULL DEFAULT '0.00',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `franchises`
--

INSERT INTO `franchises` (`id`, `country_name`, `currency`, `has_tax`, `tax_percentage`, `is_active`, `created_at`, `updated_at`) VALUES
(11, 'Qatar', 'QAR', 0, 0.00, 1, '2026-02-10 07:14:29', '2026-02-10 07:14:29'),
(12, 'Saudi Arabia', 'SAR', 1, 15.00, 1, '2026-02-10 07:14:29', '2026-02-10 07:14:29'),
(13, 'United Arab Emirates', 'AED', 1, 5.00, 1, '2026-02-10 07:14:29', '2026-02-10 07:14:29');

-- --------------------------------------------------------

--
-- Table structure for table `geographies`
--

CREATE TABLE `geographies` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `geographies`
--

INSERT INTO `geographies` (`id`, `name`, `code`, `currency`, `region`, `description`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'test', 'test', 'test', 'Asia', 'test', 1, 2, 2, '2026-01-22 01:29:29', '2026-01-22 03:35:22');

-- --------------------------------------------------------

--
-- Table structure for table `help_centers`
--

CREATE TABLE `help_centers` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hubs`
--

CREATE TABLE `hubs` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` bigint UNSIGNED NOT NULL,
  `city_id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `contact_person` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hubs`
--

INSERT INTO `hubs` (`id`, `name`, `country_id`, `city_id`, `code`, `address`, `contact_person`, `contact_number`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'jnasdfn', 1, 1, 'test', 'test', 'testt', '09096879903', 1, 2, 2, '2026-01-22 01:57:41', '2026-01-22 01:57:41');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(15, '0001_01_01_000000_create_users_table', 1),
(16, '0001_01_01_000001_create_cache_table', 1),
(17, '0001_01_01_000002_create_jobs_table', 1),
(18, '2025_12_04_092426_create_team_members_table', 1),
(19, '2025_12_04_092430_create_driving_teams_table', 1),
(25, '2026_01_21_045102_create_brands_table', 2),
(26, '2026_01_21_045128_create_drivers_table', 3),
(27, '2025_12_04_092444_create_vehicles_table', 4),
(28, '2026_01_21_053508_add_logo_to_brands_table', 5),
(29, '2026_01_21_060845_add_fields_to_driving_teams_table', 6),
(30, '2026_01_21_065549_update_driver_foreign_key_in_vehicles_table', 7),
(31, '2026_01_21_083859_add_kyc_status_to_driving_teams_table', 8),
(32, '2026_01_21_091529_add_team_member_fields_to_users_table', 9),
(33, '2026_01_21_093652_create_roles_table', 10),
(34, '2026_01_21_093945_update_users_table_add_role_id_foreign_key', 11),
(35, '2025_12_04_092433_create_billing_entities_table', 12),
(36, '2025_12_04_092448_create_peak_accounts_table', 12),
(37, '2025_12_04_092452_create_tyres_table', 12),
(38, '2025_12_04_092459_create_fleets_table', 12),
(39, '2025_12_04_092503_create_transports_table', 12),
(40, '2025_12_04_092507_create_expenses_table', 12),
(41, '2025_12_04_092510_create_attendances_table', 12),
(42, '2025_12_04_092513_create_geographies_table', 12),
(43, '2025_12_04_092519_create_performance_reports_table', 12),
(44, '2025_12_04_092522_create_admin_panels_table', 12),
(45, '2025_12_04_092526_create_utility_tools_table', 12),
(46, '2025_12_04_092530_create_help_centers_table', 12),
(47, '2025_12_04_092536_create_my_assistances_table', 12),
(50, '2026_01_21_123221_create_geographies_table', 15),
(51, '2026_01_22_050425_create_cities_table', 16),
(52, '2026_01_22_050449_create_hubs_table', 17),
(53, '2026_01_22_055038_add_fields_to_geographies_table', 18),
(54, '2026_01_22_055057_update_hubs_table_structure', 19),
(55, '2026_01_22_055113_update_cities_table_structure', 20),
(56, '2026_01_22_070949_add_city_id_to_hubs_table', 21),
(57, '2026_01_27_113407_create_franchises_table', 22),
(58, '2026_01_30_095415_add_consignment_fields_to_transports_table', 23),
(59, '2026_01_31_071200_add_assigned_status_to_vehicles_table', 24),
(60, '2026_02_02_100000_add_location_fields_to_transports_table', 25),
(61, '2026_02_02_110000_add_distance_fields_to_transports_table', 26),
(62, '2026_02_03_000001_add_order_no_to_transports_table', 27),
(63, '2026_02_03_100000_update_transports_status_column', 28),
(64, '2026_02_03_110000_create_pods_table', 29),
(65, '2026_02_03_120000_update_pods_table', 30),
(66, '2026_02_04_060200_create_customers_table', 31),
(67, '2026_02_04_070000_add_customer_id_to_transports_table', 32),
(68, '2026_02_04_100000_add_pending_status_to_transports_table', 33),
(69, '2026_02_06_110312_add_billing_columns_to_customers_table', 34),
(70, '2026_02_06_100850_create_personal_access_tokens_table', 35),
(71, '2026_02_06_113210_add_columns_to_transports_table', 36),
(72, '2026_02_06_115657_create_cargo_types_table', 37),
(73, '2026_02_09_061750_add_type_to_transports_table', 38),
(74, '2026_02_10_061102_add_delivery_status_column_to_transport_table', 39),
(75, '2026_02_10_063856_add_franchise_column_to_customers_and_drivers_table', 40),
(76, '2026_02_10_081619_add_columns_to_drivers_table', 41),
(77, '2026_02_10_105323_add_columns_to_transports_table', 42),
(78, '2026_02_12_095501_create_notifications_table', 43);

-- --------------------------------------------------------

--
-- Table structure for table `my_assistances`
--

CREATE TABLE `my_assistances` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('16f45e54-089d-11f1-9700-52549bb03c44', 'App/Notifications/SendNotification', 'App/Models/Customer', 3, '{\"title\":\"Consignment Booked Successfully\",\"message\":\"Your Consignment is booked successfull please visit to check the shipment tracking\",\"type\":\"Booking\"}\r\n', NULL, '2026-02-13 11:01:59', '2026-02-13 11:02:08');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peak_accounts`
--

CREATE TABLE `peak_accounts` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `performance_reports`
--

CREATE TABLE `performance_reports` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\Customer', 2, 'auth_token', '211f22ea116e27c5f9db617295582fa2b72c6733648c0dd6c82d700c99501ed5', '[\"*\"]', NULL, NULL, '2026-02-06 05:51:34', '2026-02-06 05:51:34'),
(2, 'App\\Models\\Customer', 2, 'auth_token', 'f1354ebec245e56f520495bccf45079e1b3a83b87642ccd13a2c101ebe7601c0', '[\"*\"]', NULL, NULL, '2026-02-06 05:52:16', '2026-02-06 05:52:16'),
(3, 'App\\Models\\Customer', 3, 'auth_token', '254e75197000e22d897fde5f4d8de25e872dda92fdb05d1e32aec84cf458fcd3', '[\"*\"]', NULL, NULL, '2026-02-06 05:54:28', '2026-02-06 05:54:28'),
(4, 'App\\Models\\Customer', 3, 'auth_token', '3054e923d97fef22f0ef74a8ff5a67ee814f1018009289b028de655c3aa71e47', '[\"*\"]', NULL, NULL, '2026-02-06 05:56:52', '2026-02-06 05:56:52'),
(5, 'App\\Models\\Customer', 3, 'customer_token', 'bed7cf1f24aacf1ffae858c5d86b7c6eef24e0cae476beddd8b0a8d5d63ae1c0', '[\"*\"]', NULL, NULL, '2026-02-06 23:18:54', '2026-02-06 23:18:54'),
(6, 'App\\Models\\Customer', 3, 'customer_token', '5f8a68c962b62cf1c189bdc639c8308ee8bbfce5335f989a214cdfdda4682abb', '[\"*\"]', '2026-02-06 23:24:26', NULL, '2026-02-06 23:20:35', '2026-02-06 23:24:26'),
(8, 'App\\Models\\Customer', 3, 'customer_token', 'af0b6ff340e3a5c4e03193834efa7dec3c4f20ce99b328985804f9143936d8ef', '[\"*\"]', NULL, NULL, '2026-02-07 07:12:29', '2026-02-07 07:12:29'),
(10, 'App\\Models\\Customer', 3, 'customer_token', 'ef6860044cfc985a61ff5bdf154a7b448702f094301bb7659766c2fdf5605f87', '[\"*\"]', '2026-02-09 07:27:09', NULL, '2026-02-07 09:21:45', '2026-02-09 07:27:09'),
(11, 'App\\Models\\Customer', 3, 'customer_token', '5937eabb8a45b1c4ae4b8f6e9d51255c12d799bf3b4c6c746e70a3f736231c46', '[\"*\"]', NULL, NULL, '2026-02-07 09:51:02', '2026-02-07 09:51:02'),
(12, 'App\\Models\\Customer', 8, 'customer_token', '3cf0a5219a32e848220344208dbbf55e02f73207d419983f9f06717bde2bdfb6', '[\"*\"]', NULL, NULL, '2026-02-07 10:02:02', '2026-02-07 10:02:02'),
(13, 'App\\Models\\Customer', 3, 'customer_token', 'e865240e59ec58f4ba56dbdc30faa11184abf1dca0c21a75d2f36ddcbc1c1974', '[\"*\"]', '2026-02-09 07:21:59', NULL, '2026-02-07 11:46:03', '2026-02-09 07:21:59'),
(14, 'App\\Models\\Customer', 3, 'customer_token', '6742617dce630f243661f66e27e8356abaf801f8f31e1f5719cf144fdb4e3a88', '[\"*\"]', '2026-02-16 09:51:10', NULL, '2026-02-09 09:30:05', '2026-02-16 09:51:10'),
(15, 'App\\Models\\Customer', 4, 'customer_token', 'f8363503bca46c246f37352679a204bb243e92700ca0645816a58bb291153179', '[\"*\"]', NULL, NULL, '2026-02-10 06:04:40', '2026-02-10 06:04:40'),
(16, 'App\\Models\\Customer', 3, 'customer_token', '2548b4515835f823d7b6e42823489c78c7c3050064353b29ab86ec9f6a5b3a0b', '[\"*\"]', NULL, NULL, '2026-02-10 06:21:33', '2026-02-10 06:21:33'),
(17, 'App\\Models\\Customer', 3, 'customer_token', '9ee73300a4b3176777fa68fa1acea9a1f975fcc05a132754e81b19501079f075', '[\"*\"]', NULL, NULL, '2026-02-10 06:34:52', '2026-02-10 06:34:52'),
(18, 'App\\Models\\Customer', 3, 'customer_token', 'f5a9774671fa9fbc1552f554d42ba4627f55f62966fc02c1986db12326346874', '[\"*\"]', '2026-02-12 05:07:03', NULL, '2026-02-10 06:35:34', '2026-02-12 05:07:03'),
(19, 'App\\Models\\Customer', 3, 'customer_token', 'f71d774fe95574276a59aa637e65c5ee0788a671bee668a071fce0783429df06', '[\"*\"]', '2026-02-11 05:58:35', NULL, '2026-02-10 09:53:32', '2026-02-11 05:58:35'),
(20, 'App\\Models\\Customer', 3, 'customer_token', 'b67d0fc73ef374d8bbf400bc47609f7bbc8d56153e6c44cf7e4553cae3e2401d', '[\"*\"]', '2026-02-11 08:45:32', NULL, '2026-02-11 04:55:11', '2026-02-11 08:45:32'),
(21, 'App\\Models\\Driver', 1, 'driver_token', '6ed592bffca2a57961626143f756ef1727075f9260e735723e0ce588eba32f85', '[\"*\"]', NULL, NULL, '2026-02-11 06:51:26', '2026-02-11 06:51:26'),
(22, 'App\\Models\\Driver', 1, 'driver_token', '68722f0a1919357ed560ca24ac21239a27da0c646283753b0bd3bbbd03f2fd57', '[\"*\"]', '2026-02-11 07:21:53', NULL, '2026-02-11 06:52:19', '2026-02-11 07:21:53'),
(23, 'App\\Models\\Customer', 3, 'customer_token', '1854def40a06cef7c3840a5e0a1a775facaebcdd5b1db7cb27d2b0d3652e210b', '[\"*\"]', '2026-02-11 07:29:23', NULL, '2026-02-11 07:04:55', '2026-02-11 07:29:23'),
(24, 'App\\Models\\Customer', 3, 'customer_token', 'db07904d637cc0b8f28c9b6ed7e996fdf3e88584950926ed6bf2d18f036da56c', '[\"*\"]', '2026-02-11 08:47:12', NULL, '2026-02-11 08:46:58', '2026-02-11 08:47:12'),
(25, 'App\\Models\\Customer', 3, 'customer_token', '92ffd5a0baaec8dd4988baf7c719a499ed3503244d7c6a6da581d5d6262992af', '[\"*\"]', '2026-02-11 08:57:52', NULL, '2026-02-11 08:57:36', '2026-02-11 08:57:52'),
(26, 'App\\Models\\Customer', 3, 'customer_token', 'aacc102a89160713ce50e953e83b555fa78f4f2d08998ff7b925402a6e2b6ba5', '[\"*\"]', '2026-02-11 08:59:16', NULL, '2026-02-11 08:59:05', '2026-02-11 08:59:16'),
(27, 'App\\Models\\Customer', 3, 'customer_token', 'c8a0284e8573364186852dad61b42c3a2d9987a5e7e95e5d02701ca7786a4677', '[\"*\"]', '2026-02-11 09:30:01', NULL, '2026-02-11 09:03:29', '2026-02-11 09:30:01'),
(28, 'App\\Models\\Customer', 3, 'customer_token', '1d8a90219ed32de75d76c469c51a9e714dcf9603563f801c861f84d1c4204c46', '[\"*\"]', '2026-02-11 09:50:00', NULL, '2026-02-11 09:36:36', '2026-02-11 09:50:00'),
(29, 'App\\Models\\Customer', 3, 'customer_token', 'c4ff8c263500f6dfe59b90ac1f41f78d21a0042241950f5fd199b80cfc876265', '[\"*\"]', '2026-02-11 09:55:55', NULL, '2026-02-11 09:51:47', '2026-02-11 09:55:55'),
(30, 'App\\Models\\Customer', 3, 'customer_token', 'a3518a28db29e2c45d0bfd0d163651dd17831a3a3f81bcce83bb6ff51de6437f', '[\"*\"]', '2026-02-11 12:39:38', NULL, '2026-02-11 09:56:27', '2026-02-11 12:39:38'),
(31, 'App\\Models\\Customer', 3, 'customer_token', 'd976f98736476baf8e6806344bc0c880b464b2bf2394292cf2b1dd7331507456', '[\"*\"]', '2026-02-16 10:01:09', NULL, '2026-02-11 11:03:07', '2026-02-16 10:01:09'),
(32, 'App\\Models\\Customer', 3, 'customer_token', '95207ef6c92395672231ab347f344dad7f41fbd5203a0863d7a636de14c88699', '[\"*\"]', '2026-02-12 04:13:50', NULL, '2026-02-12 04:12:50', '2026-02-12 04:13:50'),
(33, 'App\\Models\\Customer', 3, 'customer_token', '3d767f048a67e0d5112a181787198e164d98d15f0cfbac9ca8d3f7eb4f8d9f0c', '[\"*\"]', '2026-02-13 10:06:06', NULL, '2026-02-12 05:07:38', '2026-02-13 10:06:06'),
(34, 'App\\Models\\Customer', 3, 'customer_token', '6cfb8ef2e6d9e512931f96856abe5fb9124a1e9157ec3170e6c58f800ef4812c', '[\"*\"]', NULL, NULL, '2026-02-13 04:26:19', '2026-02-13 04:26:19'),
(35, 'App\\Models\\Customer', 3, 'customer_token', '487993757ea27483e51993cb86cbfe06d01de8f5ffe65f327913f6ead6fe9363', '[\"*\"]', '2026-02-16 09:50:07', NULL, '2026-02-13 04:27:25', '2026-02-16 09:50:07'),
(36, 'App\\Models\\Customer', 3, 'customer_token', '5f1f0eef514afea7ebdc99219aadc3eb716b60be2e055c7631f9c37c23a0990f', '[\"*\"]', NULL, NULL, '2026-02-16 09:50:48', '2026-02-16 09:50:48'),
(37, 'App\\Models\\Customer', 3, 'customer_token', 'd83636b041a63a4b8577eac6444379a34964b63a0e51b6de7a32a25bf8052cba', '[\"*\"]', '2026-02-16 10:00:51', NULL, '2026-02-16 09:51:30', '2026-02-16 10:00:51');

-- --------------------------------------------------------

--
-- Table structure for table `pods`
--

CREATE TABLE `pods` (
  `id` bigint UNSIGNED NOT NULL,
  `transport_id` bigint UNSIGNED NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `original_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pods`
--

INSERT INTO `pods` (`id`, `transport_id`, `file_name`, `original_name`, `file_path`, `created_at`, `updated_at`) VALUES
(2, 8, 'invoice-inv-uae-00005_1770116575_Tlcy6ihU.html', 'invoice-INV-UAE-00005.html', 'pod/8/invoice-inv-uae-00005_1770116575_Tlcy6ihU.html', '2026-02-03 05:32:55', '2026-02-03 05:32:55'),
(3, 8, 'logistics-invoice_1770116575_TiNYwsng.pdf', 'logistics_invoice.pdf', 'pod/8/logistics-invoice_1770116575_TiNYwsng.pdf', '2026-02-03 05:32:55', '2026-02-03 05:32:55'),
(4, 8, 'ledger-vch-columnar1_1770116575_0DHMb9oR.gif', 'ledger_vch_columnar1.gif', 'pod/8/ledger-vch-columnar1_1770116575_0DHMb9oR.gif', '2026-02-03 05:32:55', '2026-02-03 05:32:55'),
(5, 8, '1769745469-ohhxcu3vhf_1770116575_IbxAiWYB.jpeg', '1769745469_Ohhxcu3Vhf.jpeg', 'pod/8/1769745469-ohhxcu3vhf_1770116575_IbxAiWYB.jpeg', '2026-02-03 05:32:55', '2026-02-03 05:32:55'),
(6, 8, '1769745482-6ssq9kijne_1770116575_VY9OIkEE.jpeg', '1769745482_6sSq9KIJNE.jpeg', 'pod/8/1769745482-6ssq9kijne_1770116575_VY9OIkEE.jpeg', '2026-02-03 05:32:55', '2026-02-03 05:32:55'),
(7, 8, 'pettycashcontroller-1_1770116575_WqGJfUYE.php', 'PettyCashController (1).php', 'pod/8/pettycashcontroller-1_1770116575_WqGJfUYE.php', '2026-02-03 05:32:55', '2026-02-03 05:32:55'),
(8, 8, 'yellow-sport-sedan-road-side-view_1770116575_HoMdhm7q.jpg', 'yellow-sport-sedan-road-side-view.jpg', 'pod/8/yellow-sport-sedan-road-side-view_1770116575_HoMdhm7q.jpg', '2026-02-03 05:32:55', '2026-02-03 05:32:55'),
(9, 26, 'recording01', 'recording01.mp4', '[\"assets/pod/26/recording01.mp4\",\"assets/pod/26/Screenshot-2026-02-10-113453.png\",\"assets/pod/26/pic1.png\",\"assets/pod/26/pic2.png\"]', '2026-02-12 12:01:33', '2026-02-12 12:01:39');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(2, 'Super Admin', 'super-admin', 'Full system access with all permissions', 1, '2026-01-21 04:35:34', '2026-01-21 04:35:34'),
(3, 'Admin', 'admin', 'Administrative access with most permissions', 1, '2026-01-21 04:35:34', '2026-01-21 04:35:34'),
(4, 'Supervisor', 'supervisor', 'Supervisory role with team management permissions', 1, '2026-01-21 04:35:34', '2026-01-21 04:35:34'),
(5, 'Account Staff', 'account-staff', 'Accounting and financial operations staff', 1, '2026-01-21 04:35:34', '2026-01-21 04:35:34'),
(6, 'Country Finance Aid', 'country-finance-aid', 'Country-level financial assistance coordinator', 1, '2026-01-21 04:35:34', '2026-01-21 04:35:34'),
(7, 'Franchise Manager', 'franchise-manager', 'Manages franchise operations and partnerships', 1, '2026-01-21 04:35:34', '2026-01-21 04:35:34'),
(8, 'Co-Ordinator', 'coordinator', 'Coordinates operations and logistics', 1, '2026-01-21 04:35:34', '2026-01-21 04:35:34'),
(11, 'subadmin', 'subadmin', 'cfghj', 1, '2026-01-22 04:38:20', '2026-01-22 04:40:06'),
(12, 'abc', 'abc', 'ertwet', 1, '2026-02-05 01:12:17', '2026-02-05 01:12:17');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('0fK1toXOZsprR7GaJuq0B5jqnX1a2ti1Y6mbEHYQ', NULL, '16.144.17.106', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.80 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibUZ3QWkzNjY5MTR1VGRiaXVleFBDSnYxcnJEZmkzdGM5cEtIZzVKRiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHBzOi8vc2RlaW5kaWEuaW4iO3M6NToicm91dGUiO3M6MTY6ImZyYW5jaGlzZXMuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1771226260),
('fgATBekto0tzC6ntJAK1Jr7duYfig7XWo1J1pvMC', NULL, '167.71.228.151', 'Mozilla/5.0 (X11; Linux x86_64; rv:142.0) Gecko/20100101 Firefox/142.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNzBjYlJENWh2TWtNdjI4OEk0Umh1TnY1NVFvVnhzMU5pNXoyUGpRTyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjM6Imh0dHA6Ly9tYWlsLnNkZWluZGlhLmluIjtzOjU6InJvdXRlIjtzOjE2OiJmcmFuY2hpc2VzLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1771230914),
('fHoGa4Z0ERH8y87GIKHV1oyKOs3FRzTR0gfJ8UDV', NULL, '103.108.58.16', 'FaviconHash-API/1.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidGxGUHdEWEw4OU41VWhGdlJ1UVVzaWJlaDM0VGV4S2VCSm4xbHNybCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTk6Imh0dHBzOi8vc2RlaW5kaWEuaW4iO3M6NToicm91dGUiO3M6MTY6ImZyYW5jaGlzZXMuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1771224389),
('H1rV7ovEAI6hl8zhKD4sFXGFPy7aVQWjAfcZ9e88', NULL, '167.71.228.151', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieml4V3VtOUFYM0FDM2RzcEM2NGVrYjhHSHY2MlVDRUthT202M2RNYSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjQ6Imh0dHBzOi8vbWFpbC5zZGVpbmRpYS5pbiI7czo1OiJyb3V0ZSI7czoxNjoiZnJhbmNoaXNlcy5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1771230914),
('Vv2tfIywgOGRvKrehMaVcyaPVQac4ORH3kJbhjsZ', NULL, '103.173.240.129', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoickpXZTVGZlEyNTQydWF5RFFBZ3Zqd2xjTmx4QzJOMnNsYmlTQmRxQSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vc2RlaW5kaWEuaW4vY2xlYXIiO3M6NToicm91dGUiO047fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1771236439);

-- --------------------------------------------------------

--
-- Table structure for table `team_members`
--

CREATE TABLE `team_members` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transports`
--

CREATE TABLE `transports` (
  `id` bigint UNSIGNED NOT NULL,
  `order_no` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('local','international') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `consigner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pickup_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source_pincode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source_state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pickupLatitude` decimal(10,7) DEFAULT NULL,
  `pickupLongitude` decimal(10,7) DEFAULT NULL,
  `deliveryLatitude` decimal(10,7) DEFAULT NULL,
  `deliveryLongitude` decimal(10,7) DEFAULT NULL,
  `address_line` text COLLATE utf8mb4_unicode_ci,
  `building_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dest_pincode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dest_state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dest_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pickup_datetime` datetime DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `receiver_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receiver_mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cargoType` bigint DEFAULT NULL,
  `fragile` tinyint(1) NOT NULL DEFAULT '0',
  `perishable` tinyint(1) NOT NULL DEFAULT '0',
  `width` decimal(8,2) DEFAULT NULL,
  `height` decimal(8,2) DEFAULT NULL,
  `length` decimal(8,2) DEFAULT NULL,
  `Instructions` longtext COLLATE utf8mb4_unicode_ci,
  `invoice` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `packageSlip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deliveryChallan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CargoDocs` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `party_lr_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `packages` int DEFAULT NULL,
  `weight` decimal(10,2) DEFAULT NULL,
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trip_type` enum('FTL','LTL','Express') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vehicle_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `assigned_vehicle_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `assigned_driver` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `assigned_driver_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `handling_instructions` text COLLATE utf8mb4_unicode_ci,
  `third_party_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `third_party_vehicle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `freight_weight` decimal(10,2) DEFAULT NULL,
  `weight_unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rate_per_unit` decimal(10,2) DEFAULT NULL,
  `total_packages` int DEFAULT NULL,
  `rate_per_package` decimal(10,2) DEFAULT NULL,
  `fixed_cost` decimal(10,2) DEFAULT NULL,
  `expense_types` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `expense_amounts` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `expense_remarks` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `final_notes` text COLLATE utf8mb4_unicode_ci,
  `status` enum('pending','draft','assigned','confirmed','in_transit','delivered','cancelled') COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `deliveryStatus` enum('pending','booked','pickedUp','inTransit','delivered','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `consignment_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `total_cost` decimal(10,2) DEFAULT NULL,
  `total_distance` decimal(10,2) DEFAULT NULL,
  `total_travel_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source_building_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source_maps_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dest_building_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dest_maps_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` bigint UNSIGNED DEFAULT NULL
) ;

--
-- Dumping data for table `transports`
--

INSERT INTO `transports` (`id`, `order_no`, `type`, `created_at`, `updated_at`, `consigner`, `pickup_location`, `source_pincode`, `source_city`, `source_state`, `source_country`, `delivery_location`, `pickupLatitude`, `pickupLongitude`, `deliveryLatitude`, `deliveryLongitude`, `address_line`, `building_no`, `dest_pincode`, `dest_state`, `dest_country`, `pickup_datetime`, `delivery_date`, `receiver_name`, `receiver_mobile`, `cargoType`, `fragile`, `perishable`, `width`, `height`, `length`, `Instructions`, `invoice`, `packageSlip`, `deliveryChallan`, `CargoDocs`, `remarks`, `party_lr_no`, `packages`, `weight`, `invoice_no`, `invoice_value`, `trip_type`, `vehicle_type`, `assigned_vehicle_no`, `assigned_driver`, `assigned_driver_id`, `handling_instructions`, `third_party_name`, `third_party_vehicle`, `freight_weight`, `weight_unit`, `rate_per_unit`, `total_packages`, `rate_per_package`, `fixed_cost`, `expense_types`, `expense_amounts`, `expense_remarks`, `final_notes`, `status`, `deliveryStatus`, `consignment_type`, `total_cost`, `total_distance`, `total_travel_time`, `source_building_no`, `source_maps_link`, `dest_building_no`, `dest_maps_link`, `customer_id`) VALUES
(1, 'TR001', NULL, '2026-01-30 04:32:49', '2026-02-02 23:59:24', 'raj consignment', '3985+P79 - Hay Mogader - Sharjah - United Arab Emirates', '123456', 'Kalba', 'Sharjah', 'United Arab Emirates', '1 Sheikh Mohammed bin Rashid Blvd - Burj Khalifa - Downtown Dubai - Dubai - United Arab Emirates', NULL, NULL, NULL, NULL, 'Sheikh Mohammed bin Rashid Boulevard', '1', '1211', 'Dubai', 'United Arab Emirates', '2026-02-25 20:38:00', '2026-02-27', 'Harry', '9096879903', NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9111', 100, 100.00, '98765', '98700', 'LTL', 'SUV', 'MH0120202', 'test', '1', 'rest', NULL, NULL, NULL, NULL, NULL, 100, 80.00, NULL, '[\"Soft material\"]', '[\"90\"]', '[\"test remark\"]', 'no instruction', 'confirmed', 'pending', 'admin', 8090.00, NULL, NULL, NULL, 'https://www.google.com/maps?q=25.06648183892282,56.35778841023096', NULL, 'https://www.google.com/maps?q=25.197197,55.27437639999999', NULL),
(5, 'TR005', NULL, '2026-01-31 01:40:04', '2026-02-06 03:33:53', 'Uae', '22 Al Hannouf St - Abu Dhabi Industrial City - ICAD I - Abu Dhabi - United Arab Emirates', '232342', 'Abu Dhabi', 'Abu Dhabi', 'United Arab Emirates', 'JJDC3812، 3812 خبيب بن عدي الأنصاري(رضي الله عنه)، 6782, Al Sanabel, Jeddah 22443, Saudi Arabia', NULL, NULL, NULL, NULL, 'خبيب بن عدي الأنصاري(رضي الله عنه)', '3812', '22443', 'Makkah Province', 'Saudi Arabia', '2026-01-31 16:42:00', '2026-02-07', 'safdasf', '9096879903', NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '32424', 2342, 234234.00, '24324', '23234', 'FTL', 'Truck', 'MH0120202', 'test', '2', 'stay safe', NULL, NULL, 1500.00, 'Kg', 100.00, NULL, NULL, NULL, '[\"Soft material\"]', '[\"100000\"]', '[\"test remark\"]', 'confirmed from the admin', 'confirmed', 'pending', 'admin', 250000.00, NULL, NULL, '22', 'https://www.google.com/maps?q=24.33511816072425,54.50673346352144', NULL, 'https://www.google.com/maps?q=21.39360662250922,39.29633655018912', NULL),
(8, 'TR008', NULL, '2026-02-02 04:33:40', '2026-02-05 01:04:16', 'uae', 'LQJA4937، 4937 ابن اكثم، 9474, Alwurud, Alquwayiyah 19248, Saudi Arabia', '19248', 'Alquwayiyah', 'Riyadh Province', 'Saudi Arabia', '6748+R2 - Al Wasl - Dubai - United Arab Emirates', NULL, NULL, NULL, NULL, '6748+R2 - Al Wasl - Dubai - United Arab Emirates', NULL, NULL, 'Dubai', 'United Arab Emirates', '2026-02-14 15:30:00', '2026-03-14', 'raj', '1234567891', NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1111', 11, 11.00, '1212', '111111', 'LTL', 'Truck', '23456', 'Aspen Rogers', '3', 'keep go slow , the material is so soft', NULL, NULL, 900.00, 'Tons', 90.00, NULL, NULL, NULL, '[\"Soft material\"]', '[\"90\"]', '[\"none\"]', 'confirmed from the admin', 'delivered', 'pending', 'admin', 81090.00, 725.00, '7 hours 42 mins', '4937', 'https://www.google.com/maps?q=24.066123333986198,45.29774528519275', NULL, 'https://www.google.com/maps?q=25.206882968843544,55.26503752705113', NULL),
(10, 'TR009', NULL, '2026-02-03 22:49:54', '2026-02-06 06:35:24', 'Ullam dicta natus de', '7 Street 29 - Dasman - Halwan - Sharjah - United Arab Emirates', 'Aliquam cupiditate i', 'Sharjah', 'Sharjah', 'United Arab Emirates', 'XMGP+6G Al Madam - Sharjah - United Arab Emirates', NULL, NULL, NULL, NULL, 'XMGP+6G Al Madam - Sharjah - United Arab Emirates', 'Culpa rerum distinct', 'Voluptas vel vel vol', 'Sharjah', 'United Arab Emirates', '1981-03-11 15:40:00', '1973-05-31', 'Emma Mcclain', '+1 (747) 977-8858', NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '32435345354', 1, 15.00, '434343434', 'Ut eos itaque accusa', 'Express', 'Truck', 'MH010101', 'Aspen Rogers', '1', 'Consectetur harum a', 'Stephanie Shepherd', 'Cupidatat Nam amet', 12.00, 'Tons', 399.00, NULL, NULL, NULL, '[\"Ut rerum ipsam porro\"]', '[\"23\"]', '[\"Voluptatem ut dolor\"]', 'Illum sit fuga Nec', 'confirmed', 'pending', 'admin', 4811.00, 66.80, '52 mins', '7', 'https://www.google.com/maps?q=25.350935076827223,55.42262497445492', NULL, 'https://www.google.com/maps?q=24.975560411279023,55.68629684945492', NULL),
(11, 'TR010', NULL, '2026-02-04 05:29:09', '2026-02-04 05:29:09', 'customer entry', '665M+R7R - Jumeira Bay - Jumeirah 2 - Dubai - United Arab Emirates', NULL, 'Dubai', 'Dubai', 'United Arab Emirates', '57H8+W84 - Business Bay - Dubai - United Arab Emirates', NULL, NULL, NULL, NULL, '57H8+W84 - Business Bay - Dubai - United Arab Emirates', NULL, NULL, 'Dubai', 'United Arab Emirates', '2026-03-05 16:23:00', '2026-03-06', 'test', '1234567899', NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 'pending', 'customer', NULL, NULL, NULL, NULL, 'https://www.google.com/maps?q=25.20952031355882,55.23316366057666', NULL, 'https://www.google.com/maps?q=25.179857454910263,55.26582871395796', 1),
(12, 'TR011', NULL, '2026-02-04 06:03:48', '2026-02-07 11:48:56', 'customer entry2', '111 Abu Hail St - Al Wuheida - Deira - Dubai - United Arab Emirates', NULL, 'Dubai', 'Dubai', 'United Arab Emirates', 'Mumbai, India', NULL, NULL, NULL, NULL, '17 Street', '2', NULL, 'Dubai', 'United Arab Emirates', '2026-03-14 17:03:00', '2026-03-14', 'Mayur jawale', '9876543210', NULL, 1, 0, 30.50, 45.20, 60.80, 'Handle with care', NULL, NULL, NULL, NULL, NULL, '1111', 11, 25.50, '00003', '12222', 'LTL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'kg', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, 'confirmed', 'pending', 'customer', NULL, NULL, '19 mins', '111', 'https://www.google.com/maps?q=25.291670349973828,55.32936090276735', NULL, 'https://www.google.com/maps?q=25.288566175864275,55.38875573919313', 1),
(14, 'TR013', NULL, '2026-02-07 11:09:14', '2026-02-07 11:49:07', NULL, 'kamathwade, nashik', NULL, NULL, NULL, NULL, 'Mumbai, India', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-08 09:15:00', NULL, 'Mayur jawale', '9876543210', NULL, 1, 0, 30.50, 45.20, 60.80, 'Handle with care', 'assets/consignmentDocs/consignment_14_1770463596.png', 'assets/consignmentDocs/consignment_14_1770463596.jpeg', 'assets/consignmentDocs/consignment_14_1770463596.jpeg', 'assets/consignmentDocs/consignment_14_1770463596.jpeg', NULL, NULL, NULL, 25.50, NULL, NULL, 'LTL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'kg', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 'pending', 'customer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3),
(15, 'TR014', NULL, '2026-02-07 11:49:17', '2026-02-07 12:06:50', NULL, 'kamathwade, nashik', NULL, NULL, NULL, NULL, 'Mumbai, India', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-08 09:15:00', NULL, 'Mayur jawale', '9876543210', NULL, 1, 0, 30.50, 45.20, 60.80, 'Handle with care', 'assets/consignmentDocs/consignment15_69872adaa0348.jpeg', 'assets/consignmentDocs/consignment15_69872adaa04f1.jpeg', 'assets/consignmentDocs/consignment15_69872adaa05c3.jpeg', 'assets/consignmentDocs/consignment15_69872adaa0668.jpeg', NULL, NULL, NULL, 25.50, NULL, NULL, 'LTL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'kg', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 'pending', 'customer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3),
(16, 'TR015', 'international', '2026-02-09 06:25:56', '2026-02-09 06:25:56', NULL, 'kamathwade, nashik', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-08 09:15:00', NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 'pending', 'customer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3),
(17, 'TR016', 'local', '2026-02-09 06:26:17', '2026-02-09 06:26:17', NULL, 'kamathwade, nashik', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-08 09:15:00', NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 'pending', 'customer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3),
(18, 'TR017', 'local', '2026-02-09 06:40:16', '2026-02-09 06:40:16', NULL, 'kamathwade, nashik', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-08 09:15:00', NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 'pending', 'customer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3),
(19, 'TR018', 'local', '2026-02-09 07:27:09', '2026-02-09 07:27:09', NULL, 'kamathwade, nashik', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-08 09:15:00', NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'FTL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 'pending', 'customer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3),
(20, 'TR019', 'local', '2026-02-09 09:30:23', '2026-02-09 09:30:23', NULL, '123 Main St', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-15 14:30:00', NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, 'assets/consignmentDocs/consignment_6989a92f2eb41.jpeg', 'assets/consignmentDocs/consignment_6989a92f2eceb.jpeg', 'assets/consignmentDocs/consignment_6989a92f2edf1.jpeg', 'assets/consignmentDocs/consignment_6989a92f2eec4.jpeg', NULL, NULL, NULL, NULL, NULL, NULL, 'LTL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 'pending', 'customer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3),
(21, 'TR020', 'local', '2026-02-09 09:31:24', '2026-02-09 09:31:24', NULL, '123 Main St', NULL, NULL, NULL, NULL, '456 Delivery Ave', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-15 14:30:00', NULL, 'John Doe', '+1234567890', 1, 1, 0, 50.00, 60.00, 70.00, 'Handle with care', 'assets/consignmentDocs/consignment_6989a96c53a83.jpeg', 'assets/consignmentDocs/consignment_6989a96c53bc9.jpeg', 'assets/consignmentDocs/consignment_6989a96c53c52.jpeg', 'assets/consignmentDocs/consignment_6989a96c53ce0.jpeg', NULL, NULL, NULL, 25.50, NULL, NULL, 'LTL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'kg', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, 'draft', 'pending', 'customer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3),
(22, 'TR021', 'local', '2026-02-09 10:54:26', '2026-02-09 10:54:26', NULL, 'Trimurti Chowk, Cidco, Nashik, Maharashtra, India', NULL, NULL, NULL, NULL, 'Nashik Road, Nashik, Maharashtra, India', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-10 18:24:00', NULL, 'nilesh', '7756011548', 2, 1, 0, 1.00, 1.00, 1.00, NULL, 'assets/consignmentDocs/consignment_6989bce283782.png', NULL, NULL, NULL, NULL, NULL, NULL, 1.00, NULL, NULL, 'LTL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ton', NULL, 40, NULL, NULL, NULL, NULL, NULL, NULL, 'draft', 'pending', 'customer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3),
(23, 'TR022', 'local', '2026-02-09 11:13:27', '2026-02-09 11:13:27', NULL, 'Trimurti Chowk, Cidco, Nashik, Maharashtra, India', NULL, NULL, NULL, NULL, 'Nashik Road, Nashik, Maharashtra, India', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-09 16:42:00', NULL, 'nilesh', '7756011548', 2, 1, 0, 1.00, 1.00, 1.00, 'yy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6.00, NULL, NULL, 'LTL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'kg', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, 'draft', 'pending', 'customer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3),
(24, 'TR023', 'local', '2026-02-09 11:17:41', '2026-02-09 11:17:41', NULL, 'Pathardi Phata, Nashik, Maharashtra, India', NULL, NULL, NULL, NULL, 'Nashik Road, Nashik, Maharashtra, India', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-02-10 18:46:00', NULL, 'Pritesh', '9999999999', 3, 1, 0, 1.00, 1.00, 1.00, 'jh', 'assets/consignmentDocs/consignment_6989c2552faf1.jpg', 'assets/consignmentDocs/consignment_6989c2552fd26.jpg', 'assets/consignmentDocs/consignment_6989c2552fe48.jpg', 'assets/consignmentDocs/consignment_6989c2552ff23.jpg', NULL, NULL, NULL, 1.00, NULL, NULL, 'LTL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ton', NULL, 56, NULL, NULL, NULL, NULL, NULL, NULL, 'assigned', 'pending', 'customer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3),
(25, 'TR024', 'local', '2026-02-10 09:49:00', '2026-02-10 09:49:00', NULL, 'Trimurti Chowk, Cidco, Nashik, Maharashtra, India', NULL, NULL, NULL, NULL, 'Nashik Road, Nashik, Maharashtra, India', 18.9977460, 72.8375050, 19.0422870, 72.9132150, NULL, NULL, NULL, NULL, NULL, '2026-02-11 17:14:00', NULL, 'sumit', '7756011548', 2, 1, 0, 1.00, 1.00, 1.00, 'sdssds', 'assets/consignmentDocs/consignment_698aff0c10c77.jpg', 'assets/consignmentDocs/consignment_698aff0c10dfa.jpg', 'assets/consignmentDocs/consignment_698aff0c10e9a.jpg', 'assets/consignmentDocs/consignment_698aff0c1101d.jpg', NULL, NULL, NULL, 56.00, 'INV-2025-1344', NULL, 'LTL', NULL, 'MH0123456789', NULL, '1', NULL, NULL, NULL, NULL, 'kg', NULL, 56, NULL, NULL, NULL, NULL, NULL, NULL, 'delivered', 'pending', 'customer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3),
(26, 'TR025', 'local', '2026-02-11 05:28:12', '2026-02-11 05:28:12', NULL, 'Trimurti Chowk, Cidco, Nashik, Maharashtra, India', NULL, NULL, NULL, NULL, 'Nashik Road, Nashik, Maharashtra, India', 19.9840804, 73.7553243, 19.9728896, 73.8229516, NULL, NULL, NULL, NULL, NULL, '2026-02-12 05:50:00', NULL, 'pritesh', '7756011548', 2, 1, 0, 1.00, 1.00, 1.00, 'ddd', NULL, 'assets/consignmentDocs/consignment_698c136cac6f3.jpg', 'assets/consignmentDocs/consignment_698c136cac823.jpg', 'assets/consignmentDocs/consignment_698c136cac90e.jpg', NULL, NULL, NULL, 2.00, NULL, NULL, 'LTL', NULL, 'MH0123456789', NULL, '1', NULL, NULL, NULL, NULL, 'kg', NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, 'delivered', 'delivered', 'customer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3),
(27, 'TR026', 'local', '2026-02-11 05:30:55', '2026-02-11 05:30:55', NULL, '123 Main St', NULL, NULL, NULL, NULL, '456 Delivery Ave', 19.9840804, 19.9840804, 19.9840804, 19.9840804, NULL, NULL, NULL, NULL, NULL, '2024-01-15 14:30:00', NULL, 'John Doe', '+1234567890', 1, 1, 0, 50.00, 60.00, 70.00, 'Handle with care', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25.50, NULL, NULL, 'LTL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'kg', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 'pending', 'customer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3),
(28, 'TR027', 'local', '2026-02-12 10:35:59', '2026-02-12 10:35:59', NULL, '123 Main St', NULL, NULL, NULL, NULL, '456 Delivery Ave', 19.4345435, 73.2565457, 19.3456544, 72.9865746, NULL, NULL, NULL, NULL, NULL, '2024-01-15 14:30:00', NULL, 'John Doe', '+1234567890', 1, 1, 0, 50.00, 60.00, 70.00, 'Handle with care', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25.50, NULL, NULL, 'LTL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'kg', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 'pending', 'customer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3),
(29, 'TR028', 'local', '2026-02-12 10:36:31', '2026-02-12 10:36:31', NULL, '123 Main St', NULL, NULL, NULL, NULL, '456 Delivery Ave', 19.4345435, 73.2565457, 19.3456544, 72.9865746, NULL, NULL, NULL, NULL, NULL, '2024-01-15 14:30:00', NULL, 'John Doe', '+1234567890', 1, 1, 0, 50.00, 60.00, 70.00, 'Handle with care', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25.50, NULL, NULL, 'LTL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'kg', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 'pending', 'customer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3),
(30, 'TR029', 'local', '2026-02-12 10:38:45', '2026-02-12 10:38:45', NULL, '123 Main St', NULL, NULL, NULL, NULL, '456 Delivery Ave', 19.4345435, 73.2565457, 19.3456544, 72.9865746, NULL, NULL, NULL, NULL, NULL, '2024-01-15 14:30:00', NULL, 'John Doe', '+1234567890', 1, 1, 0, 50.00, 60.00, 70.00, 'Handle with care', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25.50, NULL, NULL, 'LTL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'kg', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 'pending', 'customer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3),
(31, 'TR030', 'local', '2026-02-12 10:39:26', '2026-02-12 10:39:26', NULL, '123 Main St', NULL, NULL, NULL, NULL, '456 Delivery Ave', 19.4345435, 73.2565457, 19.3456544, 72.9865746, NULL, NULL, NULL, NULL, NULL, '2024-01-15 14:30:00', NULL, 'John Doe', '+1234567890', 1, 1, 0, 50.00, 60.00, 70.00, 'Handle with care', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25.50, NULL, NULL, 'LTL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'kg', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 'pending', 'customer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3),
(32, 'TR031', 'local', '2026-02-12 10:41:13', '2026-02-12 10:41:13', NULL, '123 Main St', NULL, NULL, NULL, NULL, '456 Delivery Ave', 19.4345435, 73.2565457, 19.3456544, 72.9865746, NULL, NULL, NULL, NULL, NULL, '2024-01-15 14:30:00', NULL, 'John Doe', '+1234567890', 1, 1, 0, 50.00, 60.00, 70.00, 'Handle with care', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25.50, NULL, NULL, 'LTL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'kg', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 'pending', 'customer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3),
(33, 'TR032', 'international', '2026-02-13 05:46:05', '2026-02-13 05:46:05', NULL, 'Trimurti Chowk, Cidco, Nashik, Maharashtra, India', NULL, NULL, NULL, NULL, 'Nashik Road, Nashik, Maharashtra, India', 19.9840804, 73.7553243, 19.9728896, 73.8229516, NULL, NULL, NULL, NULL, NULL, '2026-02-13 11:12:00', NULL, 'nilesh', '7756011548', 2, 1, 0, 1.00, 1.00, 1.00, 'sdsds', 'assets/consignmentDocs/consignment_698eba9d643eb.jpg', 'assets/consignmentDocs/consignment_698eba9d64788.jpg', 'assets/consignmentDocs/consignment_698eba9d6486d.jpg', 'assets/consignmentDocs/consignment_698eba9d64a03.jpg', NULL, NULL, NULL, 1.00, NULL, NULL, 'FTL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'kg', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 'pending', 'customer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3),
(34, 'TR033', 'international', '2026-02-16 09:49:08', '2026-02-16 09:49:08', NULL, 'Trimurti Chowk, Cidco, Nashik, Maharashtra, India', NULL, NULL, NULL, NULL, 'Nashik Road, Nashik, Maharashtra, India', 19.9840804, 73.7553243, 19.9728896, 73.8229516, NULL, NULL, NULL, NULL, NULL, '2026-02-16 17:17:00', NULL, 'ghh', '7756011548', 5, 1, 0, 1.00, 1.00, 1.00, 'gh', 'assets/consignmentDocs/consignment_6992e8142c15a.png', 'assets/consignmentDocs/consignment_6992e8142c4cb.png', 'assets/consignmentDocs/consignment_6992e8142c8d4.jpg', 'assets/consignmentDocs/consignment_6992e8142cc41.png', NULL, NULL, NULL, 5.00, NULL, NULL, 'FTL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'kg', NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', 'pending', 'customer', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tyres`
--

CREATE TABLE `tyres` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_joining` date DEFAULT NULL,
  `status` enum('Active','Inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `mobile`, `department`, `position`, `date_of_joining`, `status`, `profile_image`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role_id`) VALUES
(2, 'admin', 'adminqwikhom@gmail.com', NULL, NULL, NULL, NULL, 'Active', NULL, NULL, '$2y$12$ZdnxICSWCfeMtfph2Pu0HeZTfHRBqVglqG5DRecgAOEGsOXPvOUn2', 'uuphTZYsHoAzYHLu4sWgs1CTceH4ecpxzS2va2ldetlGjmohBeqTnHVpIHSn', '2025-11-12 06:20:17', '2025-11-12 06:20:17', NULL),
(3, 'mayur', 'mayur@gmail.com', '+919096879903', 'subadmin', 'test', '2025-02-07', 'Active', 'profile_images/1768989777_WhatsApp Image 2026-01-13 at 4.34.43 PM.jpeg', NULL, '$2y$12$B6qzD6bN3f/6GfwWmLediudkA8T5uDYLPNOf93aGCMN1p86fs7FI6', NULL, '2026-01-21 04:32:57', '2026-01-21 05:20:34', 3),
(4, 'raj', 'raj@gmail.com', '+919096879903', 'test', 'test', '2026-01-07', 'Active', 'profile_images/1768992198_WhatsApp Image 2026-01-06 at 7.57.22 PM.jpeg', NULL, '$2y$12$T16UrtfW9INTi7scG.FgG.FH64dPtQU9hdos5AWfUA2zZIjYPO05m', NULL, '2026-01-21 05:13:18', '2026-01-21 05:13:18', 2);

-- --------------------------------------------------------

--
-- Table structure for table `utility_tools`
--

CREATE TABLE `utility_tools` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` bigint UNSIGNED NOT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_date` date NOT NULL,
  `registration_year` int NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fuel_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `average` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_weight` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `current_odometer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `insurance_valid_till` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `puc_expiry` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('available','not_available','assigned') COLLATE utf8mb4_unicode_ci DEFAULT 'available',
  `driver_id` bigint UNSIGNED DEFAULT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `documents_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `brand`, `model`, `vehicle_number`, `purchase_date`, `registration_year`, `color`, `fuel_type`, `average`, `max_weight`, `current_odometer`, `insurance_valid_till`, `puc_expiry`, `vehicle_type`, `status`, `driver_id`, `image_path`, `documents_path`, `created_at`, `updated_at`) VALUES
(1, 'tata', 'test', 'MH010101', '2001-01-01', 2020, 'white', 'Petrol', '30km', '1000', '9000', '31/1/2030', '31/1/2030', 'Truck', 'assigned', 2, 'vehicle_photos/1770187800_Black sport car on dark background 3d render _ Premium Photo.jpg', 'vehicle_documents/1768975254_Geography (Hubs).png', '2026-01-21 00:30:54', '2026-02-06 06:33:56'),
(2, 'Toyota', 'toyata1', 'MH0120202', '2000-01-09', 2001, 'BLACK', 'Petrol', '12KM/L', '9000', '8999', '31/1/2050', '9/1/2025', 'SUV', 'assigned', 1, 'vehicle_photos/1768980265_WhatsApp Image 2025-12-19 at 11.53.15 AM.jpeg', 'vehicle_documents/1768980265_1768976480_Geography (Cities).png', '2026-01-21 01:54:25', '2026-02-06 03:33:53'),
(3, 'tata', '234567', '23456', '2026-02-01', 2020, 'BLACK', 'Petrol', '22', '1212', '1111', '31/1/2030', '31/1/2030', 'Truck', 'assigned', 3, 'vehicle_photos/1770015610_Login Page.png', 'vehicle_documents/1770015610_chetan_shelake_portfolio_prd.pdf', '2026-02-02 01:30:10', '2026-02-02 05:04:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_panels`
--
ALTER TABLE `admin_panels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billing_entities`
--
ALTER TABLE `billing_entities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_slug_unique` (`slug`);

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
-- Indexes for table `cargo_types`
--
ALTER TABLE `cargo_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cities_created_by_foreign` (`created_by`),
  ADD KEY `cities_updated_by_foreign` (`updated_by`),
  ADD KEY `cities_country_id_foreign` (`country_id`),
  ADD KEY `cities_hub_id_foreign` (`hub_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_email_unique` (`email`),
  ADD KEY `customers_franchise_foreign` (`franchise`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `drivers_driver_id_unique` (`driver_id`),
  ADD KEY `drivers_franchise_foreign` (`franchise`);

--
-- Indexes for table `driving_teams`
--
ALTER TABLE `driving_teams`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `driving_teams_driver_id_unique` (`driver_id`),
  ADD UNIQUE KEY `driving_teams_license_number_unique` (`license_number`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fleets`
--
ALTER TABLE `fleets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `franchises`
--
ALTER TABLE `franchises`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `geographies`
--
ALTER TABLE `geographies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `geographies_created_by_foreign` (`created_by`),
  ADD KEY `geographies_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `help_centers`
--
ALTER TABLE `help_centers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hubs`
--
ALTER TABLE `hubs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hubs_code_unique` (`code`),
  ADD KEY `hubs_created_by_foreign` (`created_by`),
  ADD KEY `hubs_updated_by_foreign` (`updated_by`),
  ADD KEY `hubs_country_id_foreign` (`country_id`),
  ADD KEY `hubs_city_id_foreign` (`city_id`);

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
-- Indexes for table `my_assistances`
--
ALTER TABLE `my_assistances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `peak_accounts`
--
ALTER TABLE `peak_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `performance_reports`
--
ALTER TABLE `performance_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `pods`
--
ALTER TABLE `pods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pods_transport_id_foreign` (`transport_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`),
  ADD UNIQUE KEY `roles_slug_unique` (`slug`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `team_members`
--
ALTER TABLE `team_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transports`
--
ALTER TABLE `transports`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transports_order_no_unique` (`order_no`),
  ADD KEY `transports_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `tyres`
--
ALTER TABLE `tyres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `utility_tools`
--
ALTER TABLE `utility_tools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicles_driver_id_foreign` (`driver_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_panels`
--
ALTER TABLE `admin_panels`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `billing_entities`
--
ALTER TABLE `billing_entities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cargo_types`
--
ALTER TABLE `cargo_types`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `driving_teams`
--
ALTER TABLE `driving_teams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fleets`
--
ALTER TABLE `fleets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `franchises`
--
ALTER TABLE `franchises`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `geographies`
--
ALTER TABLE `geographies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `help_centers`
--
ALTER TABLE `help_centers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hubs`
--
ALTER TABLE `hubs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `my_assistances`
--
ALTER TABLE `my_assistances`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `peak_accounts`
--
ALTER TABLE `peak_accounts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `performance_reports`
--
ALTER TABLE `performance_reports`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `pods`
--
ALTER TABLE `pods`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `team_members`
--
ALTER TABLE `team_members`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transports`
--
ALTER TABLE `transports`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tyres`
--
ALTER TABLE `tyres`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `utility_tools`
--
ALTER TABLE `utility_tools`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `geographies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cities_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cities_hub_id_foreign` FOREIGN KEY (`hub_id`) REFERENCES `hubs` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `cities_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_franchise_foreign` FOREIGN KEY (`franchise`) REFERENCES `franchises` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `drivers`
--
ALTER TABLE `drivers`
  ADD CONSTRAINT `drivers_franchise_foreign` FOREIGN KEY (`franchise`) REFERENCES `franchises` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `geographies`
--
ALTER TABLE `geographies`
  ADD CONSTRAINT `geographies_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `geographies_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `hubs`
--
ALTER TABLE `hubs`
  ADD CONSTRAINT `hubs_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hubs_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `geographies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hubs_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `hubs_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `pods`
--
ALTER TABLE `pods`
  ADD CONSTRAINT `pods_transport_id_foreign` FOREIGN KEY (`transport_id`) REFERENCES `transports` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transports`
--
ALTER TABLE `transports`
  ADD CONSTRAINT `transports_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `driving_teams` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
