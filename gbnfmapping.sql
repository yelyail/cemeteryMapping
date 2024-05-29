-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2024 at 01:04 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gbnfmapping`
--

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
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2024_05_05_035833_create_tblstaff_table', 1),
(3, '2024_05_05_040033_create_tblowner_table', 1),
(4, '2024_05_05_040102_create_tblplotinvent_table', 1),
(5, '2024_05_05_040256_create_tbldeceaseinfo_table', 1),
(6, '2024_05_05_040352_create_tblmaintenance_table', 1),
(7, '2024_05_05_143458_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
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
-- Table structure for table `tbldeceaseinfo`
--

CREATE TABLE `tbldeceaseinfo` (
  `deceaseID` bigint(20) UNSIGNED NOT NULL,
  `plotInventID` bigint(20) UNSIGNED DEFAULT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `middleName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `bornDate` date DEFAULT NULL,
  `diedDate` date DEFAULT NULL,
  `burialDate` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblmaintenance`
--

CREATE TABLE `tblmaintenance` (
  `maintainRec_ID` bigint(20) UNSIGNED NOT NULL,
  `staffID` bigint(20) UNSIGNED DEFAULT NULL,
  `deceaseID` bigint(20) UNSIGNED DEFAULT NULL,
  `maintenanceName` varchar(255) DEFAULT NULL,
  `maintainDescription` varchar(255) DEFAULT NULL,
  `amount` double(8,2) DEFAULT NULL,
  `renewalPaymentDate` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblowner`
--

CREATE TABLE `tblowner` (
  `ownerID` bigint(20) UNSIGNED NOT NULL,
  `fullName` varchar(255) DEFAULT NULL,
  `contactNum` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblplotinvent`
--

CREATE TABLE `tblplotinvent` (
  `plotInventID` bigint(20) UNSIGNED NOT NULL,
  `ownerID` bigint(20) UNSIGNED DEFAULT NULL,
  `cemName` varchar(255) DEFAULT NULL,
  `plotNum` int(11) DEFAULT NULL,
  `plotTotal` int(11) DEFAULT NULL,
  `plotPrice` double(8,2) DEFAULT NULL,
  `stat` varchar(255) DEFAULT NULL,
  `post_status` int(11) DEFAULT NULL,
  `plotMaintenanceFee` double(8,2) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `establishmentDate` date DEFAULT NULL,
  `purchaseDate` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblstaff`
--

CREATE TABLE `tblstaff` (
  `staffID` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `contactNum` varchar(255) DEFAULT NULL,
  `contactEmail` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `passRecQues` varchar(255) DEFAULT NULL,
  `passRecAns` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `tbldeceaseinfo`
--
ALTER TABLE `tbldeceaseinfo`
  ADD PRIMARY KEY (`deceaseID`),
  ADD KEY `tbldeceaseinfo_plotinventid_foreign` (`plotInventID`);

--
-- Indexes for table `tblmaintenance`
--
ALTER TABLE `tblmaintenance`
  ADD PRIMARY KEY (`maintainRec_ID`),
  ADD KEY `tblmaintenance_staffid_foreign` (`staffID`),
  ADD KEY `tblmaintenance_deceaseid_foreign` (`deceaseID`);

--
-- Indexes for table `tblowner`
--
ALTER TABLE `tblowner`
  ADD PRIMARY KEY (`ownerID`);

--
-- Indexes for table `tblplotinvent`
--
ALTER TABLE `tblplotinvent`
  ADD PRIMARY KEY (`plotInventID`),
  ADD KEY `tblplotinvent_ownerid_foreign` (`ownerID`);

--
-- Indexes for table `tblstaff`
--
ALTER TABLE `tblstaff`
  ADD PRIMARY KEY (`staffID`),
  ADD UNIQUE KEY `tblstaff_contactemail_unique` (`contactEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbldeceaseinfo`
--
ALTER TABLE `tbldeceaseinfo`
  MODIFY `deceaseID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblmaintenance`
--
ALTER TABLE `tblmaintenance`
  MODIFY `maintainRec_ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblowner`
--
ALTER TABLE `tblowner`
  MODIFY `ownerID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblplotinvent`
--
ALTER TABLE `tblplotinvent`
  MODIFY `plotInventID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblstaff`
--
ALTER TABLE `tblstaff`
  MODIFY `staffID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbldeceaseinfo`
--
ALTER TABLE `tbldeceaseinfo`
  ADD CONSTRAINT `tbldeceaseinfo_plotinventid_foreign` FOREIGN KEY (`plotInventID`) REFERENCES `tblplotinvent` (`plotInventID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblmaintenance`
--
ALTER TABLE `tblmaintenance`
  ADD CONSTRAINT `tblmaintenance_deceaseid_foreign` FOREIGN KEY (`deceaseID`) REFERENCES `tbldeceaseinfo` (`deceaseID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblmaintenance_staffid_foreign` FOREIGN KEY (`staffID`) REFERENCES `tblstaff` (`staffID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblplotinvent`
--
ALTER TABLE `tblplotinvent`
  ADD CONSTRAINT `tblplotinvent_ownerid_foreign` FOREIGN KEY (`ownerID`) REFERENCES `tblowner` (`ownerID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
