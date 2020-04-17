-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2020 at 09:29 AM
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
(1, 'c6593adb-a522-44ff-af29-6de45d04deb6', 'TBA Super-Admin', 'superadmin@demo.com', '$2y$10$YoCwxSBgEr1Wv7ktYucoZOPK1pgjNSyA.gwzM6CKc77VTkliI5vkq', NULL, '2020-04-17 01:58:35', '2020-04-17 01:58:35');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isoAlphaCode` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `isoAlphaCode`) VALUES
(1, 'Afghanistan', 'AF'),
(2, 'Aland Islands', 'AX'),
(3, 'Albania', 'AL'),
(4, 'Algeria', 'DZ'),
(5, 'American Samoa', 'AS'),
(6, 'Andorra', 'AD'),
(7, 'Angola', 'AO'),
(8, 'Anguilla', 'AI'),
(9, 'Antarctica', 'AQ'),
(10, 'Antigua and Barbuda', 'AG'),
(11, 'Argentina', 'AR'),
(12, 'Armenia', 'AM'),
(13, 'Aruba', 'AW'),
(14, 'Australia', 'AU'),
(15, 'Austria', 'AT'),
(16, 'Azerbaijan', 'AZ'),
(17, 'Bahamas', 'BS'),
(18, 'Bahrain', 'BH'),
(19, 'Bangladesh', 'BD'),
(20, 'Barbados', 'BB'),
(21, 'Belarus', 'BY'),
(22, 'Belgium', 'BE'),
(23, 'Belize', 'BZ'),
(24, 'Benin', 'BJ'),
(25, 'Bermuda', 'BM'),
(26, 'Bhutan', 'BT'),
(27, 'Bolivia', 'BO'),
(28, 'Bonaire, Saint Eustatius and Saba', 'BQ'),
(29, 'Bosnia and Herzegovina', 'BA'),
(30, 'Botswana', 'BW'),
(31, 'Bouvet Island', 'BV'),
(32, 'Brazil', 'BR'),
(33, 'British Indian Ocean Territory', 'IO'),
(34, 'British Virgin Islands', 'VG'),
(35, 'Brunei', 'BN'),
(36, 'Bulgaria', 'BG'),
(37, 'Burkina Faso', 'BF'),
(38, 'Burundi', 'BI'),
(39, 'Cambodia', 'KH'),
(40, 'Cameroon', 'CM'),
(41, 'Canada', 'CA'),
(42, 'Cape Verde', 'CV'),
(43, 'Cayman Islands', 'KY'),
(44, 'Central African Republic', 'CF'),
(45, 'Chad', 'TD'),
(46, 'Chile', 'CL'),
(47, 'China', 'CN'),
(48, 'Christmas Island', 'CX'),
(49, 'Cocos Islands', 'CC'),
(50, 'Colombia', 'CO'),
(51, 'Comoros', 'KM'),
(52, 'Cook Islands', 'CK'),
(53, 'Costa Rica', 'CR'),
(54, 'Croatia', 'HR'),
(55, 'Cuba', 'CU'),
(56, 'Curacao', 'CW'),
(57, 'Cyprus', 'CY'),
(58, 'Czech Republic', 'CZ'),
(59, 'Democratic Republic of the Congo', 'CD'),
(60, 'Denmark', 'DK'),
(61, 'Djibouti', 'DJ'),
(62, 'Dominica', 'DM'),
(63, 'Dominican Republic', 'DO'),
(64, 'East Timor', 'TL'),
(65, 'Ecuador', 'EC'),
(66, 'Egypt', 'EG'),
(67, 'El Salvador', 'SV'),
(68, 'Equatorial Guinea', 'GQ'),
(69, 'Eritrea', 'ER'),
(70, 'Estonia', 'EE'),
(71, 'Ethiopia', 'ET'),
(72, 'Falkland Islands', 'FK'),
(73, 'Faroe Islands', 'FO'),
(74, 'Fiji', 'FJ'),
(75, 'Finland', 'FI'),
(76, 'France', 'FR'),
(77, 'French Guiana', 'GF'),
(78, 'French Polynesia', 'PF'),
(79, 'French Southern Territories', 'TF'),
(80, 'Gabon', 'GA'),
(81, 'Gambia', 'GM'),
(82, 'Georgia', 'GE'),
(83, 'Germany', 'DE'),
(84, 'Ghana', 'GH'),
(85, 'Gibraltar', 'GI'),
(86, 'Greece', 'GR'),
(87, 'Greenland', 'GL'),
(88, 'Grenada', 'GD'),
(89, 'Guadeloupe', 'GP'),
(90, 'Guam', 'GU'),
(91, 'Guatemala', 'GT'),
(92, 'Guernsey', 'GG'),
(93, 'Guinea', 'GN'),
(94, 'Guinea-Bissau', 'GW'),
(95, 'Guyana', 'GY'),
(96, 'Haiti', 'HT'),
(97, 'Heard Island and McDonald Islands', 'HM'),
(98, 'Honduras', 'HN'),
(99, 'Hong Kong', 'HK'),
(100, 'Hungary', 'HU'),
(101, 'Iceland', 'IS'),
(102, 'India', 'IN'),
(103, 'Indonesia', 'ID'),
(104, 'Iran', 'IR'),
(105, 'Iraq', 'IQ'),
(106, 'Ireland', 'IE'),
(107, 'Isle of Man', 'IM'),
(108, 'Israel', 'IL'),
(109, 'Italy', 'IT'),
(110, 'Ivory Coast', 'CI'),
(111, 'Jamaica', 'JM'),
(112, 'Japan', 'JP'),
(113, 'Jersey', 'JE'),
(114, 'Jordan', 'JO'),
(115, 'Kazakhstan', 'KZ'),
(116, 'Kenya', 'KE'),
(117, 'Kiribati', 'KI'),
(118, 'Kosovo', 'XK'),
(119, 'Kuwait', 'KW'),
(120, 'Kyrgyzstan', 'KG'),
(121, 'Laos', 'LA'),
(122, 'Latvia', 'LV'),
(123, 'Lebanon', 'LB'),
(124, 'Lesotho', 'LS'),
(125, 'Liberia', 'LR'),
(126, 'Libya', 'LY'),
(127, 'Liechtenstein', 'LI'),
(128, 'Lithuania', 'LT'),
(129, 'Luxembourg', 'LU'),
(130, 'Macao', 'MO'),
(131, 'Macedonia', 'MK'),
(132, 'Madagascar', 'MG'),
(133, 'Malawi', 'MW'),
(134, 'Malaysia', 'MY'),
(135, 'Maldives', 'MV'),
(136, 'Mali', 'ML'),
(137, 'Malta', 'MT'),
(138, 'Marshall Islands', 'MH'),
(139, 'Martinique', 'MQ'),
(140, 'Mauritania', 'MR'),
(141, 'Mauritius', 'MU'),
(142, 'Mayotte', 'YT'),
(143, 'Mexico', 'MX'),
(144, 'Micronesia', 'FM'),
(145, 'Moldova', 'MD'),
(146, 'Monaco', 'MC'),
(147, 'Mongolia', 'MN'),
(148, 'Montenegro', 'ME'),
(149, 'Montserrat', 'MS'),
(150, 'Morocco', 'MA'),
(151, 'Mozambique', 'MZ'),
(152, 'Myanmar', 'MM'),
(153, 'Namibia', 'NA'),
(154, 'Nauru', 'NR'),
(155, 'Nepal', 'NP'),
(156, 'Netherlands', 'NL'),
(157, 'New Caledonia', 'NC'),
(158, 'New Zealand', 'NZ'),
(159, 'Nicaragua', 'NI'),
(160, 'Niger', 'NE'),
(161, 'Nigeria', 'NG'),
(162, 'Niue', 'NU'),
(163, 'Norfolk Island', 'NF'),
(164, 'North Korea', 'KP'),
(165, 'Northern Mariana Islands', 'MP'),
(166, 'Norway', 'NO'),
(167, 'Oman', 'OM'),
(168, 'Pakistan', 'PK'),
(169, 'Palau', 'PW'),
(170, 'Palestinian Territory', 'PS'),
(171, 'Panama', 'PA'),
(172, 'Papua New Guinea', 'PG'),
(173, 'Paraguay', 'PY'),
(174, 'Peru', 'PE'),
(175, 'Philippines', 'PH'),
(176, 'Pitcairn', 'PN'),
(177, 'Poland', 'PL'),
(178, 'Portugal', 'PT'),
(179, 'Puerto Rico', 'PR'),
(180, 'Qatar', 'QA'),
(181, 'Republic of the Congo', 'CG'),
(182, 'Reunion', 'RE'),
(183, 'Romania', 'RO'),
(184, 'Russia', 'RU'),
(185, 'Rwanda', 'RW'),
(186, 'Saint Barthelemy', 'BL'),
(187, 'Saint Helena', 'SH'),
(188, 'Saint Kitts and Nevis', 'KN'),
(189, 'Saint Lucia', 'LC'),
(190, 'Saint Martin', 'MF'),
(191, 'Saint Pierre and Miquelon', 'PM'),
(192, 'Saint Vincent and the Grenadines', 'VC'),
(193, 'Samoa', 'WS'),
(194, 'San Marino', 'SM'),
(195, 'Sao Tome and Principe', 'ST'),
(196, 'Saudi Arabia', 'SA'),
(197, 'Senegal', 'SN'),
(198, 'Serbia', 'RS'),
(199, 'Seychelles', 'SC'),
(200, 'Sierra Leone', 'SL'),
(201, 'Singapore', 'SG'),
(202, 'Sint Maarten', 'SX'),
(203, 'Slovakia', 'SK'),
(204, 'Slovenia', 'SI'),
(205, 'Solomon Islands', 'SB'),
(206, 'Somalia', 'SO'),
(207, 'South Africa', 'ZA'),
(208, 'South Georgia and the South Sandwich Islands', 'GS'),
(209, 'South Korea', 'KR'),
(210, 'South Sudan', 'SS'),
(211, 'Spain', 'ES'),
(212, 'Sri Lanka', 'LK'),
(213, 'Sudan', 'SD'),
(214, 'Suriname', 'SR'),
(215, 'Svalbard and Jan Mayen', 'SJ'),
(216, 'Swaziland', 'SZ'),
(217, 'Sweden', 'SE'),
(218, 'Switzerland', 'CH'),
(219, 'Syria', 'SY'),
(220, 'Taiwan', 'TW'),
(221, 'Tajikistan', 'TJ'),
(222, 'Tanzania', 'TZ'),
(223, 'Thailand', 'TH'),
(224, 'Togo', 'TG'),
(225, 'Tokelau', 'TK'),
(226, 'Tonga', 'TO'),
(227, 'Trinidad and Tobago', 'TT'),
(228, 'Tunisia', 'TN'),
(229, 'Turkey', 'TR'),
(230, 'Turkmenistan', 'TM'),
(231, 'Turks and Caicos Islands', 'TC'),
(232, 'Tuvalu', 'TV'),
(233, 'U.S. Virgin Islands', 'VI'),
(234, 'Uganda', 'UG'),
(235, 'Ukraine', 'UA'),
(236, 'United Arab Emirates', 'AE'),
(237, 'United Kingdom', 'GB'),
(238, 'United States', 'US'),
(239, 'United States Minor Outlying Islands', 'UM'),
(240, 'Uruguay', 'UY'),
(241, 'Uzbekistan', 'UZ'),
(242, 'Vanuatu', 'VU'),
(243, 'Vatican', 'VA'),
(244, 'Venezuela', 'VE'),
(245, 'Vietnam', 'VN'),
(246, 'Wallis and Futuna', 'WF'),
(247, 'Western Sahara', 'EH'),
(248, 'Yemen', 'YE'),
(249, 'Zambia', 'ZM'),
(250, 'Zimbabwe', 'ZW');

-- --------------------------------------------------------

--
-- Table structure for table `diseases`
--

CREATE TABLE `diseases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `health_institution_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `diseaseCode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `infectionQrCode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recoveredQrCode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deadQrCode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `selfQuarantineQrCode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `riskLevel` tinyint(4) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `diseases`
--

INSERT INTO `diseases` (`id`, `uuid`, `health_institution_id`, `name`, `diseaseCode`, `infectionQrCode`, `recoveredQrCode`, `deadQrCode`, `selfQuarantineQrCode`, `riskLevel`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'c985c411-a22a-41a8-bd63-59748a371647', 2, 'Covid-19', 'D84k5yDs', 'demo/covid_19_infection_1586416911.png', 'demo/covid_19_recovered_1586416911.png', 'demo/covid_19_dead_1586416911.png', 'demo/covid_19_selfquarantine_1586416911.png', 1, NULL, '2020-04-17 01:58:35', '2020-04-17 01:58:35'),
(2, 'efe98899-795b-4da1-8c39-76fce5c56429', 2, 'Spanish Flu', 'Dp4k5yRs', 'demo/spanish_flu_infection_1586416922.png', 'demo/spanish_flu_recovered_1586416922.png', 'demo/spanish_flu_dead_1586416922.png', 'demo/spanish_flu_selfquarantine_1586416922.png', 2, NULL, '2020-04-17 01:58:35', '2020-04-17 01:58:35');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_profiles`
--

CREATE TABLE `doctor_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `health_institution_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profileQrCode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doctor_profiles`
--

INSERT INTO `doctor_profiles` (`id`, `uuid`, `health_institution_id`, `name`, `email`, `phone`, `profileQrCode`, `created_at`, `updated_at`) VALUES
(1, 'd2f65cbd-3bc0-4025-95d3-2307f90a3d9a', 2, 'John Abraham', 'john@doctor.com', '+918282828282', 'demo/john_abraham_doctor_1586752345.png', '2020-04-17 01:58:35', '2020-04-17 01:58:35'),
(2, 'bd910ec2-51a9-4678-b91f-28800db85177', 2, 'Roger Verne', 'roger@doctor.com', '+918282828282', 'demo/roger_verne_doctor_1586755631.png', '2020-04-17 01:58:35', '2020-04-17 01:58:35');

-- --------------------------------------------------------

--
-- Table structure for table `health_institutions`
--

CREATE TABLE `health_institutions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `institutionCode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isHead` tinyint(1) NOT NULL DEFAULT '0',
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `health_institutions`
--

INSERT INTO `health_institutions` (`id`, `uuid`, `name`, `institutionCode`, `email`, `password`, `isHead`, `isActive`, `country_id`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '9aabcc7f-465b-4d19-a774-5a4a729b8a56', 'Demo Country Head', 'CHHpqa3x', 'countryhead@demo.com', '$2y$10$Ud5J1BGhEUkm3/yWkdSsTO3TfE2RtAYcleS56YZsbyDA3QN3K5q7C', 1, 1, 102, NULL, NULL, '2020-04-17 01:58:35', '2020-04-17 01:58:35'),
(2, '66a13e1e-15e2-421b-978b-d9a7bf4b8835', 'Cosmo Hospital Institution', 'HIN53xOp', 'institution@demo.com', '$2y$10$Qs1P2YxV7mTKc4vYPoAWvenlC5cTkF0SWX40f/ryFPu4z49c86IDa', 0, 1, 102, NULL, NULL, '2020-04-17 01:58:35', '2020-04-17 01:58:35'),
(3, '7e752973-1036-45b2-9a74-510c853b8615', 'Demo Roger', 'HINjkFd9', 'ddddddddddddddd@sfsa.com', '$2y$10$az0Z9Qs5fPYD/QgXdHgJhutepY3h.skHO9/ZEeRz7/ZPhJn7oewbi', 0, 1, 102, NULL, NULL, '2020-04-17 01:59:09', '2020-04-17 01:59:09');

-- --------------------------------------------------------

--
-- Table structure for table `health_institution_profiles`
--

CREATE TABLE `health_institution_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `health_institution_id` bigint(20) UNSIGNED NOT NULL,
  `head_health_institution_id` bigint(20) UNSIGNED NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchasedDoctorConnects` int(11) NOT NULL DEFAULT '0',
  `remainingDoctorConnects` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `health_institution_profiles`
--

INSERT INTO `health_institution_profiles` (`id`, `health_institution_id`, `head_health_institution_id`, `phone`, `address`, `purchasedDoctorConnects`, `remainingDoctorConnects`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '9219592195', 'Pottakuzhy Rd, Pattom, Thiruvananthapuram, Kerala, India 695004', 0, 0, '2020-04-17 01:58:35', '2020-04-17 01:58:35'),
(2, 3, 1, '09219592195', 'Test street address', 0, 0, '2020-04-17 01:59:10', '2020-04-17 01:59:10');

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
(1, 1, '999.00', '2020-03-30', '2021-03-30', 1, '2020-04-17 01:58:35', '2020-04-17 01:58:35'),
(2, 2, '999.00', '2020-03-30', '2021-03-30', 1, '2020-04-17 01:58:35', '2020-04-17 01:58:35');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `health_institution_id` bigint(20) UNSIGNED NOT NULL,
  `isPosted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `uuid`, `title`, `content`, `health_institution_id`, `isPosted`, `created_at`, `updated_at`) VALUES
(1, 'f5080521-af53-415a-9194-79e90b1d2796', 'India To Deploy Rapid Test Kits To Speed Up Covid-19 Screening', 'Central Govt to begin Rapid Test against Covid-19. The serological antibody blood test, which deliver results in 15 minutes, work on blood samples instead of nasal swabs', 2, 1, '2020-04-17 01:58:35', '2020-04-17 01:58:35'),
(2, '49e3fc0e-eb24-4294-b686-7bf61d8fc743', 'Protecting the Future of Medicine During the COVID-19 Pandemic', 'The American Heart Association believes that prematurely allowing medical trainees to provide patient care during the COVID-19 pandemic could put the next generation of medical professionals at serious risk', 2, 1, '2020-04-17 01:58:35', '2020-04-17 01:58:35'),
(3, '7800079d-9577-4754-9452-4508405c78e3', 'How to Prevent Domestic Violence During COVID-19', 'During COVID-19, access to trusted and security internet-based domestic violence services is even more important for survivors and concerned friends and family members who are trying to find ways to keep themselves safe while many states are on \"stay-at-home\" orders', 2, 1, '2020-04-17 01:58:35', '2020-04-17 01:58:35'),
(4, '8da99a07-46b8-498e-89a6-7a1c7a52930a', 'Blue-light Technology Improves Identification of Bladder Cancer', 'Blue-light cystoscopy has previously been available at some institutions, including UT Southwestern, for use in the operating room, but it wasn’t available in a flexible scope until now', 2, 1, '2020-04-17 01:58:35', '2020-04-17 01:58:35'),
(5, '07486afa-839b-4759-950e-da38e7ddc2a8', 'Spanish flu: The deadliest pandemic in history', 'In 1918, a strain of influenza known as Spanish flu caused a global pandemic, spreading rapidly and killing indiscriminately. Young, old, sick and otherwise-healthy people all became infected, and at least 10% of patients died', 2, 1, '2020-04-17 01:58:35', '2020-04-17 01:58:35'),
(6, '2ca68e26-ef06-4bd0-95cb-252ec54d58cd', 'Urgent studies needed into mental health impact of coronavirus', 'Rapid and rigorous research into the impact of Covid-19 on mental health is needed to limit the impact of the pandemic, researchers have said', 2, 1, '2020-04-17 01:58:35', '2020-04-17 01:58:35'),
(7, '8849e220-433f-466a-b07c-a0725901bc3e', 'Can Clothes and Shoes Track COVID-19 into Your House?', 'Transfer of the coronavirus via clothing is unlikely, but experts agree there are a few scenarios in which immediate laundering is a good idea', 2, 1, '2020-04-17 01:58:35', '2020-04-17 01:58:35'),
(8, '23f196de-b977-4d7c-8492-adb87ae977b7', 'Why a Virtual Visit to the Doctor May Be the Safest, Most Affordable Option', 'Telehealth options are making a big difference for people seeking medical help during the COVID-19 pandemic — especially older adults', 2, 1, '2020-04-17 01:58:35', '2020-04-17 01:58:35'),
(9, '04b3b249-cfcf-4b0b-8acd-aeb5032acb3e', 'Why COVID-19 is Hitting Men Harder Than Women', 'Experts say biology and behavior are among the reasons more men than women are dying from COVID-19', 2, 1, '2020-04-17 01:58:35', '2020-04-17 01:58:35'),
(10, '0a9cb549-f4d7-4700-9a55-2af40a10395b', 'The Best Materials to Make a Homemade Face Mask', 'Health officials have reversed course and now recommend that people use face masks to prevent transmission of the new coronavirus', 2, 1, '2020-04-17 01:58:35', '2020-04-17 01:58:35'),
(11, 'ea7e174a-789d-44a7-a2a0-c23d9ece1c69', 'It’s Too Early to Know If Hydroxychloroquine Will Help Treat People with COVID-19', 'Until we have results from larger, well-designed trials — which are currently underway — hydroxychloroquine and chloroquine should only be used rarely', 2, 1, '2020-04-17 01:58:35', '2020-04-17 01:58:35'),
(12, 'b88d3a3c-8545-4f8c-b9d7-0dcb33c91645', 'Are Ventilators Helping or Harming COVID-19 Patients?', 'Mechanical ventilators have become a symbol of the COVID-19 pandemic, representing the last best hope to survive for people who can no longer draw a life-sustaining breath', 2, 1, '2020-04-17 01:58:35', '2020-04-17 01:58:35'),
(13, '2d8be681-c852-424b-97d1-6d8476b2655a', 'Don’t Rely on Supplements to Treat or Prevent COVID-19', 'Doctors warn that relying on supplements — and taking too much of them — may do more harm than good when trying to combat the COVID-19 outbreak', 2, 1, '2020-04-17 01:58:35', '2020-04-17 01:58:35');

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
(12, '2020_03_26_181350_create_messages_table', 1),
(13, '2020_03_26_181390_create_doctor_profiles_table', 1),
(14, '2020_03_26_181411_create_users_table', 1),
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
(1, NULL, 'Laravel Personal Access Client', 'vdhx6fXxAMr4yu7CvbzTcSLOb568IlsPaHoHVFDt', 'http://localhost', 1, 0, 0, '2020-04-17 01:58:36', '2020-04-17 01:58:36'),
(2, NULL, 'Laravel Password Grant Client', 'U4KBl8MBEo6ulVfGmH9KuIXWI7kqUttoI4bvr24e', 'http://localhost', 0, 1, 0, '2020-04-17 01:58:36', '2020-04-17 01:58:36');

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
(1, 1, '2020-04-17 01:58:36', '2020-04-17 01:58:36');

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
  `userCode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_doctor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `country_id` bigint(20) UNSIGNED DEFAULT NULL,
  `androidDeviceId` text COLLATE utf8mb4_unicode_ci,
  `androidPushToken` text COLLATE utf8mb4_unicode_ci,
  `iosDeviceId` text COLLATE utf8mb4_unicode_ci,
  `iosPushToken` text COLLATE utf8mb4_unicode_ci,
  `isVerified` tinyint(1) NOT NULL DEFAULT '0',
  `verificationNonce` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uuid`, `userCode`, `phone`, `is_doctor_id`, `country_id`, `androidDeviceId`, `androidPushToken`, `iosDeviceId`, `iosPushToken`, `isVerified`, `verificationNonce`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'da42b977-9394-4bab-8444-368bba1d5fda', 'UxYUs3Fj', '+918943406910', NULL, 237, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2020-04-17 01:58:35', '2020-04-17 01:58:35'),
(2, 'e2d5fdb0-11b2-4ce5-8f41-6ceff7dba4b5', 'UzOPs34j', '+448219592198', NULL, 237, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2020-04-17 01:58:35', '2020-04-17 01:58:35'),
(3, 'cded4d71-0ffd-46d9-a95e-e3eab92f1558', 'UqOZs34e', '+447219592197', NULL, 237, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2020-04-17 01:58:35', '2020-04-17 01:58:35'),
(4, 'ed001153-e3c5-483b-9421-02d2b39cac25', 'UpOZsQP67', '+446219592196', NULL, 237, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2020-04-17 01:58:35', '2020-04-17 01:58:35'),
(5, '0cc80e8b-3ac1-4368-82b2-f1e5b920a037', 'UwOZsQP10', '+445219592195', NULL, 237, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2020-04-17 01:58:35', '2020-04-17 01:58:35'),
(6, '910f1caa-f345-4723-b987-989b1c09e2b6', 'GBRws5P10', '+444219592194', NULL, 237, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2020-04-17 01:58:35', '2020-04-17 01:58:35'),
(7, '30d8cc1a-6c10-4c79-8504-4d7a5aedb2ff', 'UgRws5Pdr', '+443219592193', NULL, 237, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2020-04-17 01:58:35', '2020-04-17 01:58:35'),
(8, '44c6ccf3-5b67-404e-a029-bb05477d1d8c', 'UgRwopr4x', '+442219592192', NULL, 237, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2020-04-17 01:58:35', '2020-04-17 01:58:35'),
(9, '1cea52b5-5854-4f73-9b57-664ff0b506ed', 'Uopr4xPdq', '+441219592191', NULL, 237, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2020-04-17 01:58:35', '2020-04-17 01:58:35'),
(10, 'ae0a58f9-7bfb-4232-9d5c-f57c2d9228fe', 'UvMroPMD', '+449219592199', 1, 102, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2020-04-17 01:58:35', '2020-04-17 01:58:35');

-- --------------------------------------------------------

--
-- Table structure for table `user_diagnosis_logs`
--

CREATE TABLE `user_diagnosis_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `disease_id` bigint(20) UNSIGNED NOT NULL,
  `diagnosisDateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `stage` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_diagnosis_logs`
--

INSERT INTO `user_diagnosis_logs` (`id`, `uuid`, `patient_id`, `disease_id`, `diagnosisDateTime`, `stage`, `created_at`, `updated_at`) VALUES
(1, '87656e29-dbc5-4035-a161-b7726b040a54', 1, 1, '2020-04-16 01:58:35', 1, '2020-04-17 01:58:35', '2020-04-17 01:58:35'),
(2, 'cc303c2f-4f2e-4c86-b7f1-0f95eec833b4', 2, 1, '2020-04-17 01:58:35', 1, '2020-04-17 01:58:35', '2020-04-17 01:58:35'),
(3, '7fa7a6f6-579c-4f9e-87b8-c9204c8fdb21', 3, 1, '2020-04-17 01:58:35', 1, '2020-04-17 01:58:35', '2020-04-17 01:58:35'),
(4, 'e50edb8e-f96b-4154-8c2b-f96d6378f9eb', 4, 2, '2020-04-17 01:58:35', 1, '2020-04-17 01:58:35', '2020-04-17 01:58:35'),
(5, '91954af6-5393-4cbb-98fd-a7ef9d9fe0a5', 5, 2, '2020-04-17 01:58:35', 1, '2020-04-17 01:58:35', '2020-04-17 01:58:35'),
(6, '123ebaa9-6639-4c03-a15d-7e8fce182645', 6, 1, '2020-04-17 01:58:35', 1, '2020-04-17 01:58:35', '2020-04-17 01:58:35'),
(7, '4ad341da-c0bd-4cf6-8030-dd15b5deec9c', 7, 2, '2020-04-17 01:58:35', 1, '2020-04-17 01:58:35', '2020-04-17 01:58:35'),
(8, '91938886-2df5-4820-937a-5b9d3dc784d4', 8, 2, '2020-04-17 01:58:35', 1, '2020-04-17 01:58:35', '2020-04-17 01:58:35'),
(9, '8cea7572-e361-4ba4-a64e-c6da242a8d45', 9, 2, '2020-04-17 01:58:35', 4, '2020-04-17 01:58:35', '2020-04-17 01:58:35');

-- --------------------------------------------------------

--
-- Table structure for table `user_location_logs`
--

CREATE TABLE `user_location_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_diagnosis_log_id` bigint(20) UNSIGNED NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `latitude` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `isIgnored` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_location_logs`
--

INSERT INTO `user_location_logs` (`id`, `user_diagnosis_log_id`, `dateTime`, `latitude`, `longitude`, `address`, `isIgnored`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-04-16 01:58:35', '51.528308', '-0.131847', '8-14 Eversholt St, Kings Cross, London NW1 1DG, UK', 0, '2020-04-17 01:58:35', '2020-04-17 01:58:35'),
(2, 1, '2020-04-17 01:58:35', '51.533149', '-0.137069', '76 Oakley Square, London NW1 1NH, UK', 0, '2020-04-17 01:58:35', '2020-04-17 01:58:35'),
(3, 2, '2020-04-17 01:58:35', '51.528390', '-0.151886', 'Regent\'s Park, Nursery Lodge, Inner Cir, London NW1 4NY, UK', 0, '2020-04-17 01:58:35', '2020-04-17 01:58:35'),
(4, 3, '2020-04-17 01:58:35', '51.528390', '-0.151886', 'Regent\'s Park, Nursery Lodge, Inner Cir, London NW1 4NY, UK', 0, '2020-04-17 01:58:35', '2020-04-17 01:58:35'),
(5, 4, '2020-04-17 01:58:35', '51.528380', '-0.151886', 'Regent\'s Park, Nursery Lodge, Inner Cir, London NW1 4NY, UK', 0, '2020-04-17 01:58:35', '2020-04-17 01:58:35'),
(6, 5, '2020-04-17 01:58:35', '51.528380', '-0.161886', '17 Outer Cir, Marylebone, London NW1 4RJ, UK', 0, '2020-04-17 01:58:35', '2020-04-17 01:58:35'),
(7, 6, '2020-04-17 01:58:35', '51.529380', '-0.151886', 'Regent\'s Park, Nursery Lodge, Inner Cir, London NW1 4NY, UK', 0, '2020-04-17 01:58:35', '2020-04-17 01:58:35'),
(8, 7, '2020-04-17 01:58:35', '51.528490', '-0.151886', 'Regent\'s Park, Nursery Lodge, Inner Cir, London NW1 4NY, UK', 0, '2020-04-17 01:58:35', '2020-04-17 01:58:35'),
(9, 8, '2020-04-17 01:58:35', '51.557843', '-0.115479', '25 Arthur Rd, London N7, UK', 0, '2020-04-17 01:58:35', '2020-04-17 01:58:35'),
(10, 9, '2020-04-17 01:58:35', '51.529374', '-0.136748', '43 Cardington St, Kings Cross, London NW1 2LR, UK', 0, '2020-04-17 01:58:35', '2020-04-17 01:58:35');

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
  ADD KEY `diseases_diseasecode_index` (`diseaseCode`),
  ADD KEY `diseases_health_institution_id_foreign` (`health_institution_id`);

--
-- Indexes for table `doctor_profiles`
--
ALTER TABLE `doctor_profiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `doctor_profiles_email_unique` (`email`),
  ADD KEY `doctor_profiles_uuid_index` (`uuid`),
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
  ADD KEY `health_institution_profiles_health_institution_id_foreign` (`health_institution_id`),
  ADD KEY `health_institution_profiles_head_health_institution_id_foreign` (`head_health_institution_id`);

--
-- Indexes for table `license_subscriptions`
--
ALTER TABLE `license_subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `license_subscriptions_health_institution_id_foreign` (`health_institution_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_uuid_index` (`uuid`),
  ADD KEY `messages_health_institution_id_foreign` (`health_institution_id`);

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
  ADD KEY `users_usercode_index` (`userCode`),
  ADD KEY `users_is_doctor_id_foreign` (`is_doctor_id`),
  ADD KEY `users_country_id_foreign` (`country_id`);

--
-- Indexes for table `user_diagnosis_logs`
--
ALTER TABLE `user_diagnosis_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_diagnosis_logs_uuid_index` (`uuid`),
  ADD KEY `user_diagnosis_logs_patient_id_foreign` (`patient_id`),
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
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;

--
-- AUTO_INCREMENT for table `diseases`
--
ALTER TABLE `diseases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `doctor_profiles`
--
ALTER TABLE `doctor_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `health_institutions`
--
ALTER TABLE `health_institutions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `health_institution_profiles`
--
ALTER TABLE `health_institution_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `license_subscriptions`
--
ALTER TABLE `license_subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_diagnosis_logs`
--
ALTER TABLE `user_diagnosis_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_location_logs`
--
ALTER TABLE `user_location_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `diseases`
--
ALTER TABLE `diseases`
  ADD CONSTRAINT `diseases_health_institution_id_foreign` FOREIGN KEY (`health_institution_id`) REFERENCES `health_institutions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `doctor_profiles`
--
ALTER TABLE `doctor_profiles`
  ADD CONSTRAINT `doctor_profiles_health_institution_id_foreign` FOREIGN KEY (`health_institution_id`) REFERENCES `health_institutions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `health_institutions`
--
ALTER TABLE `health_institutions`
  ADD CONSTRAINT `health_institutions_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `health_institution_profiles`
--
ALTER TABLE `health_institution_profiles`
  ADD CONSTRAINT `health_institution_profiles_head_health_institution_id_foreign` FOREIGN KEY (`head_health_institution_id`) REFERENCES `health_institutions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `health_institution_profiles_health_institution_id_foreign` FOREIGN KEY (`health_institution_id`) REFERENCES `health_institutions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `license_subscriptions`
--
ALTER TABLE `license_subscriptions`
  ADD CONSTRAINT `license_subscriptions_health_institution_id_foreign` FOREIGN KEY (`health_institution_id`) REFERENCES `health_institutions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_health_institution_id_foreign` FOREIGN KEY (`health_institution_id`) REFERENCES `health_institutions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_is_doctor_id_foreign` FOREIGN KEY (`is_doctor_id`) REFERENCES `doctor_profiles` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `user_diagnosis_logs`
--
ALTER TABLE `user_diagnosis_logs`
  ADD CONSTRAINT `user_diagnosis_logs_disease_id_foreign` FOREIGN KEY (`disease_id`) REFERENCES `diseases` (`id`) ON DELETE CASCADE,
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
