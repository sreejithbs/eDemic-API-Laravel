-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2020 at 11:13 AM
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
(1, '95ff6442-5c4a-460b-92d2-1976791b17a4', 'TBA Super-Admin', 'superadmin@demo.com', '$2y$10$uEADpghudBDiv8DrcBMNEOB4of/GURHazVYemEYFFQkcetvYysPYu', NULL, '2020-04-01 03:43:33', '2020-04-01 03:43:33');

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
  `infectionQrCode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recoveredQrCode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deadQrCode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `selfQuarantineQrCode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `health_institutions`
--

INSERT INTO `health_institutions` (`id`, `uuid`, `name`, `institutionCode`, `email`, `password`, `isHead`, `country_id`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'e65edb8d-65a2-44c7-964c-c8388f51c347', 'Demo Country Head', 'HIN0001', 'countryhead@demo.com', '$2y$10$B/Bl2qTjovK4lboi2Wkd/OBA27eAYwe0f2J9On.26saAOJkfidiNa', 1, 1, NULL, NULL, '2020-04-01 03:43:33', '2020-04-01 03:43:33');

-- --------------------------------------------------------

--
-- Table structure for table `health_institution_profiles`
--

CREATE TABLE `health_institution_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `health_institution_id` bigint(20) UNSIGNED NOT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchasedDoctorConnects` int(11) NOT NULL DEFAULT '0',
  `remainingDoctorConnects` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(2, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(3, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(4, '2016_06_01_000004_create_oauth_clients_table', 1),
(5, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(6, '2020_03_26_180642_create_admins_table', 1),
(7, '2020_03_26_181151_create_countries_table', 1),
(8, '2020_03_26_181251_create_health_institutions_table', 1),
(9, '2020_03_26_181308_create_health_institution_profiles_table', 1),
(10, '2020_03_26_181316_create_license_subscriptions_table', 1),
(11, '2020_03_26_181326_create_diseases_table', 1),
(12, '2020_03_26_181350_create_alert_messages_table', 1),
(13, '2020_03_26_181411_create_users_table', 1),
(14, '2020_03_26_181433_create_doctor_profiles_table', 1),
(15, '2020_03_26_181518_create_user_diagnosis_logs_table', 1),
(16, '2020_03_26_181538_create_user_location_logs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'dLz8wDfYolY9q6nuxuaFVuTXy2coZzZR5BlkS7zo', 'http://localhost', 1, 0, 0, '2020-04-01 03:43:33', '2020-04-01 03:43:33'),
(2, NULL, 'Laravel Password Grant Client', 'JoL1HEZY5DFZibcknsvAUCyocAFmlhLxhNKcJUAV', 'http://localhost', 0, 1, 0, '2020-04-01 03:43:33', '2020-04-01 03:43:33');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-04-01 03:43:33', '2020-04-01 03:43:33');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `androidDeviceToken` text COLLATE utf8mb4_unicode_ci,
  `iosDeviceToken` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uuid`, `userCode`, `phone`, `isDoctor`, `androidDeviceToken`, `iosDeviceToken`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'ddde890c-d094-4eee-9002-9c827cf329fb', 'U0001', '+919219592195', 0, NULL, NULL, NULL, '2020-04-01 03:43:33', '2020-04-01 03:43:33');

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
  ADD KEY `health_institutions_institutioncode_index` (`institutionCode`),
  ADD KEY `health_institutions_country_id_foreign` (`country_id`);

--
-- Indexes for table `health_institution_profiles`
--
ALTER TABLE `health_institution_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `health_institution_profiles_health_institution_id_foreign` (`health_institution_id`);

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
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `health_institution_profiles`
--
ALTER TABLE `health_institution_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `license_subscriptions`
--
ALTER TABLE `license_subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- Constraints for table `health_institutions`
--
ALTER TABLE `health_institutions`
  ADD CONSTRAINT `health_institutions_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `health_institution_profiles`
--
ALTER TABLE `health_institution_profiles`
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
