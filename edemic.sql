-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2020 at 07:23 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edemic`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `uuid`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '48d7b835-da18-4317-bc72-300768e82ea4', 'TBA Super-Admin', 'admin@tba.com', '$2y$10$xR1vf7ohJFcHyIZAdjvXCe2sMeImLvMa9bYN5uq3ez53b4/Mz8YEe', NULL, '2020-03-29 11:17:42', '2020-03-29 11:17:42');

-- --------------------------------------------------------

--
-- Table structure for table `alert_messages`
--

CREATE TABLE `alert_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `health_institution_id` bigint(20) UNSIGNED NOT NULL,
  `isPosted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isoCode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `isoCode`) VALUES
(1, 'India', 'IN'),
(2, 'United States of America', 'US'),
(3, 'United Kingdom', 'UK');

-- --------------------------------------------------------

--
-- Table structure for table `diseases`
--

CREATE TABLE `diseases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `diseaseCode` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `infectedQrCode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recoveredQrCode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deadQrCode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `selfQuarantineQrCode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `riskLevel` tinyint(4) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctor_profiles`
--

CREATE TABLE `doctor_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `health_institution_id` bigint(20) UNSIGNED NOT NULL,
  `loginQrCode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `health_institutions`
--

CREATE TABLE `health_institutions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `institutionCode` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isHead` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `health_institutions`
--

INSERT INTO `health_institutions` (`id`, `uuid`, `name`, `institutionCode`, `email`, `password`, `isHead`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'e300b1df-551a-4048-a509-e60c963ba8b8', 'Centre for Disease Control (NCDC)', 'HIN0001', 'ncdc@institution.com', '$2y$10$L3TkS7wbb7QTZeK/vzKmR.m0MMTyjIV/DT2j8LRj94ZE8.K4NtcIK', 1, NULL, NULL, '2020-03-29 11:17:42', '2020-03-29 11:17:42'),
(2, 'd4c1b984-f8f0-4007-8640-6f9c519a61e2', 'Cosmopolitan Hospital', 'HIN0002', 'cosmo@institution.com', '$2y$10$JT7jprLGYlaG71oknOJaN.RXW/G8.Y9PWlwVkFpLJlvT4gpoYp74G', 0, NULL, NULL, '2020-03-29 11:17:42', '2020-03-29 11:17:42');

-- --------------------------------------------------------

--
-- Table structure for table `health_institution_profiles`
--

CREATE TABLE `health_institution_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `health_institution_id` bigint(20) UNSIGNED NOT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `year` int(11) NOT NULL,
  `purchasedDoctorConnects` int(11) NOT NULL,
  `remainingDoctorConnects` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `health_institution_profiles`
--

INSERT INTO `health_institution_profiles` (`id`, `health_institution_id`, `phone`, `address`, `country_id`, `year`, `purchasedDoctorConnects`, `remainingDoctorConnects`, `created_at`, `updated_at`) VALUES
(1, 2, '9219592195', 'Pottakuzhy Rd, Pattom, Thiruvananthapuram, Kerala 695004', 1, 2020, 20, 10, '2020-03-29 11:17:42', '2020-03-29 11:17:42');

-- --------------------------------------------------------

--
-- Table structure for table `license_subscriptions`
--

CREATE TABLE `license_subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `health_institution_id` bigint(20) UNSIGNED NOT NULL,
  `feeAmount` decimal(12,2) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `license_subscriptions`
--

INSERT INTO `license_subscriptions` (`id`, `health_institution_id`, `feeAmount`, `startDate`, `endDate`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, '999.00', '2020-03-20', '2021-03-20', 1, '2020-03-29 11:17:42', '2020-03-29 11:17:42');

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
(1, '2020_03_26_180642_create_admins_table', 1),
(2, '2020_03_26_181151_create_countries_table', 1),
(3, '2020_03_26_181251_create_health_institutions_table', 1),
(4, '2020_03_26_181308_create_health_institution_profiles_table', 1),
(5, '2020_03_26_181316_create_license_subscriptions_table', 1),
(6, '2020_03_26_181326_create_diseases_table', 1),
(7, '2020_03_26_181350_create_alert_messages_table', 1),
(8, '2020_03_26_181411_create_users_table', 1),
(9, '2020_03_26_181433_create_doctor_profiles_table', 1),
(10, '2020_03_26_181518_create_user_diagnosis_logs_table', 1),
(11, '2020_03_26_181538_create_user_location_logs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userCode` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isDoctor` tinyint(1) NOT NULL DEFAULT '0',
  `deviceToken` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_diagnosis_logs`
--

CREATE TABLE `user_diagnosis_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `disease_id` bigint(20) UNSIGNED NOT NULL,
  `diagnosisDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `stage` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_location_logs`
--

CREATE TABLE `user_location_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_diagnosis_log_id` bigint(20) UNSIGNED NOT NULL,
  `reportedDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `latitude` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD KEY `admins_uuid_index` (`uuid`);

--
-- Indexes for table `alert_messages`
--
ALTER TABLE `alert_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alert_messages_health_institution_id_foreign` (`health_institution_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diseases`
--
ALTER TABLE `diseases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `diseases_uuid_index` (`uuid`),
  ADD KEY `diseases_diseasecode_index` (`diseaseCode`);

--
-- Indexes for table `doctor_profiles`
--
ALTER TABLE `doctor_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctor_profiles_user_id_foreign` (`user_id`),
  ADD KEY `doctor_profiles_health_institution_id_foreign` (`health_institution_id`);

--
-- Indexes for table `health_institutions`
--
ALTER TABLE `health_institutions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `health_institutions_uuid_index` (`uuid`),
  ADD KEY `health_institutions_institutioncode_index` (`institutionCode`);

--
-- Indexes for table `health_institution_profiles`
--
ALTER TABLE `health_institution_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `health_institution_profiles_health_institution_id_foreign` (`health_institution_id`),
  ADD KEY `health_institution_profiles_country_id_foreign` (`country_id`);

--
-- Indexes for table `license_subscriptions`
--
ALTER TABLE `license_subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `license_subscriptions_health_institution_id_foreign` (`health_institution_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_uuid_index` (`uuid`),
  ADD KEY `users_usercode_index` (`userCode`);

--
-- Indexes for table `user_diagnosis_logs`
--
ALTER TABLE `user_diagnosis_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_diagnosis_logs_patient_id_foreign` (`patient_id`),
  ADD KEY `user_diagnosis_logs_doctor_id_foreign` (`doctor_id`),
  ADD KEY `user_diagnosis_logs_disease_id_foreign` (`disease_id`);

--
-- Indexes for table `user_location_logs`
--
ALTER TABLE `user_location_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_location_logs_user_diagnosis_log_id_foreign` (`user_diagnosis_log_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `alert_messages`
--
ALTER TABLE `alert_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `diseases`
--
ALTER TABLE `diseases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctor_profiles`
--
ALTER TABLE `doctor_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `health_institutions`
--
ALTER TABLE `health_institutions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `health_institution_profiles`
--
ALTER TABLE `health_institution_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `license_subscriptions`
--
ALTER TABLE `license_subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_diagnosis_logs`
--
ALTER TABLE `user_diagnosis_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_location_logs`
--
ALTER TABLE `user_location_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alert_messages`
--
ALTER TABLE `alert_messages`
  ADD CONSTRAINT `alert_messages_health_institution_id_foreign` FOREIGN KEY (`health_institution_id`) REFERENCES `health_institutions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `doctor_profiles`
--
ALTER TABLE `doctor_profiles`
  ADD CONSTRAINT `doctor_profiles_health_institution_id_foreign` FOREIGN KEY (`health_institution_id`) REFERENCES `health_institutions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `doctor_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `health_institution_profiles`
--
ALTER TABLE `health_institution_profiles`
  ADD CONSTRAINT `health_institution_profiles_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `health_institution_profiles_health_institution_id_foreign` FOREIGN KEY (`health_institution_id`) REFERENCES `health_institutions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `license_subscriptions`
--
ALTER TABLE `license_subscriptions`
  ADD CONSTRAINT `license_subscriptions_health_institution_id_foreign` FOREIGN KEY (`health_institution_id`) REFERENCES `health_institutions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_diagnosis_logs`
--
ALTER TABLE `user_diagnosis_logs`
  ADD CONSTRAINT `user_diagnosis_logs_disease_id_foreign` FOREIGN KEY (`disease_id`) REFERENCES `diseases` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_diagnosis_logs_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_diagnosis_logs_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_location_logs`
--
ALTER TABLE `user_location_logs`
  ADD CONSTRAINT `user_location_logs_user_diagnosis_log_id_foreign` FOREIGN KEY (`user_diagnosis_log_id`) REFERENCES `user_diagnosis_logs` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
