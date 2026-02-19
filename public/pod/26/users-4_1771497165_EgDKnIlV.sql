-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2026 at 06:32 AM
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
-- Database: `fleet_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `role` enum('Super Admin','Admin','Supervisor','Account Staff','Country Finance Aid','Franchise Manager','Co-Ordinator') NOT NULL DEFAULT 'Admin',
  `department` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `date_of_joining` date DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `profile_image` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `franchise_id` bigint(20) UNSIGNED DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `mobile`, `role`, `department`, `position`, `date_of_joining`, `status`, `profile_image`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `franchise_id`, `role_id`) VALUES
(1, 'Qatar Admin', 'qtr@gmail.com', '+974 1234 5678', 'Admin', 'Operations', 'Franchise Manager', '2026-02-09', 'Active', NULL, NULL, '$2y$12$9bIDD0uW98nUREw0SquJaOk2IWW7z1kj2IXz/bfyaIYwrpUgIQqP2', NULL, '2026-02-09 06:53:44', '2026-02-09 06:53:44', 1, 1),
(2, 'Saudi Arabia Admin', 'sau@gmail.com', '+966 50 123 4567', 'Admin', 'Operations', 'Franchise Manager', '2026-02-09', 'Active', NULL, NULL, '$2y$12$1Cz3yBVjnzK2Rfd4Sh9JbejKZPCjuES0fhM3ZklU2D6cAVVJWr5/.', NULL, '2026-02-09 06:53:45', '2026-02-09 06:53:45', 2, 1),
(3, 'UAE Admin', 'uae@gmail.com', '+971 50 123 4567', 'Admin', 'Operations', 'Franchise Manager', '2026-02-09', 'Active', NULL, NULL, '$2y$12$9Vbtgi2bHNMxziGesPMqRu7HFCWDz2Clr.DXMfQ6QZQJR8n0sEfby', NULL, '2026-02-09 06:53:45', '2026-02-09 06:53:45', 3, 1),
(4, 'Super Admin', 'admin@qwikhom.com', '+000 0000 0000', 'Admin', 'Management', 'Super Admin', '2026-02-09', 'Active', NULL, NULL, '$2y$12$ZCSMObWLmTC.GVZ7mmZO6OJaugF6kIYdUE2AD3TPa12lUcik4QXTO', NULL, '2026-02-09 06:53:45', '2026-02-09 06:53:45', NULL, 1);

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
