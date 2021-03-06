-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2020 at 01:39 PM
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
(1, 'b27f6b0e-1bda-47fe-b992-d6327fce3cf7', 'TBA Super-Admin', 'superadmin@demo.com', '$2y$10$2oD.D2rYGL1IfeoY/H.TCOPQshWzgOTVYee4cvI2d1uF2lmZtNHOK', NULL, '2020-04-17 06:08:50', '2020-04-17 06:08:50');

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
(1, '365be0bc-f489-49d1-8ff4-e2eca9bbc3b4', 2, 'Covid-19', 'D84k5yDs', 'demo/covid_19_infection_1586416911.png', 'demo/covid_19_recovered_1586416911.png', 'demo/covid_19_dead_1586416911.png', 'demo/covid_19_selfquarantine_1586416911.png', 1, NULL, '2020-04-17 06:08:50', '2020-04-17 06:08:50'),
(2, '98994e92-01e8-4b7e-8245-3833cb8b3eeb', 2, 'Spanish Flu', 'Dp4k5yRs', 'demo/spanish_flu_infection_1586416922.png', 'demo/spanish_flu_recovered_1586416922.png', 'demo/spanish_flu_dead_1586416922.png', 'demo/spanish_flu_selfquarantine_1586416922.png', 2, NULL, '2020-04-17 06:08:50', '2020-04-17 06:08:50');

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
(1, 'd02eada5-a5dd-4679-8a78-1cd702b9dd74', 2, 'John Abraham', 'john@doctor.com', '+918282828282', 'demo/john_abraham_doctor_1586752345.png', '2020-04-17 06:08:50', '2020-04-17 06:08:50'),
(2, '69faed3a-5ef3-4c5b-bdf3-651dd613b4c0', 2, 'Roger Verne', 'roger@doctor.com', '+918282828282', 'demo/roger_verne_doctor_1586755631.png', '2020-04-17 06:08:50', '2020-04-17 06:08:50');

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
(1, '92a065b0-0127-4088-bfb9-35d8823a5d80', 'Demo Country Head', 'CHHpqa3x', 'countryhead@demo.com', '$2y$10$E3M/mmuaXNE0Jjikuq2eeejvSLNp2lVWzyOhWpKmDswGgZKFgKsvi', 1, 1, 102, NULL, NULL, '2020-04-17 06:08:50', '2020-04-17 06:08:50'),
(2, '0f119e08-8bde-4c75-a14e-2734000ab869', 'Cosmo Hospital Institution', 'HIN53xOp', 'institution@demo.com', '$2y$10$Z3pjdYa44weUblX5B4PpredCwErXV/DqFcXZ7aY1aV690ZL4KIKTW', 0, 1, 102, NULL, NULL, '2020-04-17 06:08:50', '2020-04-17 06:08:50');

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
(1, 2, 1, '9219592195', 'Pottakuzhy Rd, Pattom, Thiruvananthapuram, Kerala, India 695004', 2, 2, '2020-04-17 06:08:50', '2020-04-17 06:08:50');

-- --------------------------------------------------------

--
-- Table structure for table `license_subscriptions`
--

CREATE TABLE `license_subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `health_institution_id` bigint(20) UNSIGNED NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `license_subscriptions`
--

INSERT INTO `license_subscriptions` (`id`, `health_institution_id`, `startDate`, `endDate`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-03-30', '2021-03-30', 1, '2020-04-17 06:08:50', '2020-04-17 06:08:50'),
(2, 2, '2020-03-30', '2021-03-30', 1, '2020-04-17 06:08:50', '2020-04-17 06:08:50');

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
(1, 'e76822ed-6776-4295-a21e-f3f66cf35015', 'India To Deploy Rapid Test Kits To Speed Up Covid-19 Screening', 'Central Govt to begin Rapid Test against Covid-19. The serological antibody blood test, which deliver results in 15 minutes, work on blood samples instead of nasal swabs', 2, 1, '2020-04-17 06:08:50', '2020-04-17 06:08:50'),
(2, 'f2c845d0-836e-49ae-8ad6-58b89007f48e', 'Protecting the Future of Medicine During the COVID-19 Pandemic', 'The American Heart Association believes that prematurely allowing medical trainees to provide patient care during the COVID-19 pandemic could put the next generation of medical professionals at serious risk', 2, 1, '2020-04-17 06:08:50', '2020-04-17 06:08:50'),
(3, '87871520-ead3-4113-9937-8fcc50eba0fc', 'How to Prevent Domestic Violence During COVID-19', 'During COVID-19, access to trusted and security internet-based domestic violence services is even more important for survivors and concerned friends and family members who are trying to find ways to keep themselves safe while many states are on \"stay-at-home\" orders', 2, 1, '2020-04-17 06:08:50', '2020-04-17 06:08:50'),
(4, '53d9dff5-298e-4648-9016-8cf17cc11ad6', 'Blue-light Technology Improves Identification of Bladder Cancer', 'Blue-light cystoscopy has previously been available at some institutions, including UT Southwestern, for use in the operating room, but it wasn???t available in a flexible scope until now', 2, 1, '2020-04-17 06:08:50', '2020-04-17 06:08:50'),
(5, 'b913d892-69e0-4fd1-9743-c0e4542190ee', 'Spanish flu: The deadliest pandemic in history', 'In 1918, a strain of influenza known as Spanish flu caused a global pandemic, spreading rapidly and killing indiscriminately. Young, old, sick and otherwise-healthy people all became infected, and at least 10% of patients died', 2, 1, '2020-04-17 06:08:50', '2020-04-17 06:08:50'),
(6, '512c3bbe-6fff-49e3-be17-cc2f4cbbdffa', 'Urgent studies needed into mental health impact of coronavirus', 'Rapid and rigorous research into the impact of Covid-19 on mental health is needed to limit the impact of the pandemic, researchers have said', 2, 1, '2020-04-17 06:08:50', '2020-04-17 06:08:50'),
(7, 'a193ad32-6466-4863-a798-03cfabfb01ee', 'Can Clothes and Shoes Track COVID-19 into Your House?', 'Transfer of the coronavirus via clothing is unlikely, but experts agree there are a few scenarios in which immediate laundering is a good idea', 2, 1, '2020-04-17 06:08:50', '2020-04-17 06:08:50'),
(8, 'ccf0e7a6-6e2f-4c99-9273-81ec88fd2179', 'Why a Virtual Visit to the Doctor May Be the Safest, Most Affordable Option', 'Telehealth options are making a big difference for people seeking medical help during the COVID-19 pandemic ??? especially older adults', 2, 1, '2020-04-17 06:08:50', '2020-04-17 06:08:50'),
(9, '992d88a3-ee74-479a-8c58-fa999904d991', 'Why COVID-19 is Hitting Men Harder Than Women', 'Experts say biology and behavior are among the reasons more men than women are dying from COVID-19', 2, 1, '2020-04-17 06:08:50', '2020-04-17 06:08:50'),
(10, '40352153-59a1-47f3-8e38-1879d07e63cd', 'The Best Materials to Make a Homemade Face Mask', 'Health officials have reversed course and now recommend that people use face masks to prevent transmission of the new coronavirus', 2, 1, '2020-04-17 06:08:50', '2020-04-17 06:08:50'),
(11, '3e991db8-1b30-4622-8630-11008004e171', 'It???s Too Early to Know If Hydroxychloroquine Will Help Treat People with COVID-19', 'Until we have results from larger, well-designed trials ??? which are currently underway ??? hydroxychloroquine and chloroquine should only be used rarely', 2, 1, '2020-04-17 06:08:50', '2020-04-17 06:08:50'),
(12, '40fc9cd0-8ed0-41bd-9d9e-f062e4bc9753', 'Are Ventilators Helping or Harming COVID-19 Patients?', 'Mechanical ventilators have become a symbol of the COVID-19 pandemic, representing the last best hope to survive for people who can no longer draw a life-sustaining breath', 2, 1, '2020-04-17 06:08:50', '2020-04-17 06:08:50'),
(13, '7708db85-5d47-4e89-a591-1484c919fa60', 'Don???t Rely on Supplements to Treat or Prevent COVID-19', 'Doctors warn that relying on supplements ??? and taking too much of them ??? may do more harm than good when trying to combat the COVID-19 outbreak', 2, 1, '2020-04-17 06:08:50', '2020-04-17 06:08:50');

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
(7, '2020_03_26_181000_create_countries_table', 1),
(8, '2020_03_26_181251_create_health_institutions_table', 1),
(9, '2020_03_26_181308_create_health_institution_profiles_table', 1),
(10, '2020_03_26_181316_create_license_subscriptions_table', 1),
(11, '2020_03_26_181320_create_payments_table', 1),
(12, '2020_03_26_181326_create_diseases_table', 1),
(13, '2020_03_26_181350_create_messages_table', 1),
(14, '2020_03_26_181390_create_doctor_profiles_table', 1),
(15, '2020_03_26_181411_create_users_table', 1),
(16, '2020_03_26_181518_create_user_diagnosis_logs_table', 1),
(17, '2020_03_26_181538_create_user_location_logs_table', 1);

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
(1, NULL, 'Laravel Personal Access Client', 'BpQ9axseAt7DJTQK5Wf6lyzZjLoAXzGpQJcPrs1X', 'http://localhost', 1, 0, 0, '2020-04-17 06:08:50', '2020-04-17 06:08:50'),
(2, NULL, 'Laravel Password Grant Client', 'm2KkYjdvXyZ7rIhBp9ajRC2OHdaKxU08wDtu6DOZ', 'http://localhost', 0, 1, 0, '2020-04-17 06:08:50', '2020-04-17 06:08:50');

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
(1, 1, '2020-04-17 06:08:50', '2020-04-17 06:08:50');

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
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `health_institution_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `uuid`, `health_institution_id`, `amount`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 'dfe75e15-60a5-4af8-9fa4-ec88904518da', 1, '999.00', 'Health Head License Purchase', '2020-04-17 06:08:50', '2020-04-17 06:08:50'),
(2, 'e4defb02-cbc7-4b10-b522-6f903e07a99d', 2, '1099.00', 'Health Institution License and Doctor Connects Purchase', '2020-04-17 06:08:50', '2020-04-17 06:08:50');

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
(1, '3015583e-ca9c-40e3-9c6c-a37c4efc39ce', 'UxYUs3Fj', '+918943406910', NULL, 237, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2020-04-17 06:08:50', '2020-04-17 06:08:50'),
(2, '9c453c07-0eb5-40d8-9890-e147a6631c98', 'UzOPs34j', '+448219592198', NULL, 237, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2020-04-17 06:08:50', '2020-04-17 06:08:50'),
(3, 'bc56f0ee-ebd1-4d82-abf1-b1cf35e3ad95', 'UqOZs34e', '+447219592197', NULL, 237, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2020-04-17 06:08:50', '2020-04-17 06:08:50'),
(4, '1fb0daf6-9468-42ab-b6e9-f7422f7be2b7', 'UpOZsQP67', '+446219592196', NULL, 237, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2020-04-17 06:08:50', '2020-04-17 06:08:50'),
(5, 'f284d0c0-e9ca-4265-b311-c75b20afa2ba', 'UwOZsQP10', '+445219592195', NULL, 237, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2020-04-17 06:08:50', '2020-04-17 06:08:50'),
(6, '6bcf538f-c70a-4efb-816c-e4affb219e8c', 'GBRws5P10', '+444219592194', NULL, 237, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2020-04-17 06:08:50', '2020-04-17 06:08:50'),
(7, '3f2d7cfc-5598-4e05-8afe-e2000897f7d5', 'UgRws5Pdr', '+443219592193', NULL, 237, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2020-04-17 06:08:50', '2020-04-17 06:08:50'),
(8, '9556138b-a803-4d0e-8ff5-9b77f3e343d0', 'UgRwopr4x', '+442219592192', NULL, 237, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2020-04-17 06:08:50', '2020-04-17 06:08:50'),
(9, '67f0afb6-8306-4ebe-ad46-3571984aa577', 'Uopr4xPdq', '+441219592191', NULL, 237, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2020-04-17 06:08:50', '2020-04-17 06:08:50'),
(10, '2d830a62-159b-43f3-9c8a-6198498b20c9', 'UvMroPMD', '+449219592199', 1, 102, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2020-04-17 06:08:50', '2020-04-17 06:08:50');

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
(1, '11927d03-d727-4c18-a478-c423b4f0ce76', 1, 1, '2020-04-16 06:08:50', 1, '2020-04-17 06:08:50', '2020-04-17 06:08:50'),
(2, 'a41bc0c6-f2bd-4f39-afa5-91f29a905d2a', 2, 1, '2020-04-17 06:08:50', 1, '2020-04-17 06:08:50', '2020-04-17 06:08:50'),
(3, 'a49da4e6-ad26-447b-bbbe-0a4d264f6c77', 3, 1, '2020-04-17 06:08:50', 1, '2020-04-17 06:08:50', '2020-04-17 06:08:50'),
(4, '3d869755-3b47-41de-8544-772e6a39eb27', 4, 2, '2020-04-17 06:08:50', 1, '2020-04-17 06:08:50', '2020-04-17 06:08:50'),
(5, '5c27114d-3e06-45bc-a8b1-8976f6d20866', 5, 2, '2020-04-17 06:08:50', 1, '2020-04-17 06:08:50', '2020-04-17 06:08:50'),
(6, 'b6eb3742-6970-49ab-9515-a7cc4b6e893f', 6, 1, '2020-04-17 06:08:50', 1, '2020-04-17 06:08:50', '2020-04-17 06:08:50'),
(7, 'ac2d1c99-573f-45d8-b359-0421d675b1e6', 7, 2, '2020-04-17 06:08:50', 1, '2020-04-17 06:08:50', '2020-04-17 06:08:50'),
(8, '55f65dc0-01d9-43f5-9daf-9465af57efd3', 8, 2, '2020-04-17 06:08:50', 1, '2020-04-17 06:08:50', '2020-04-17 06:08:50'),
(9, '650d98f8-f49c-4fa8-8467-1a11e9c2b060', 9, 2, '2020-04-17 06:08:50', 4, '2020-04-17 06:08:50', '2020-04-17 06:08:50');

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
(1, 1, '2020-04-16 06:08:50', '51.528308', '-0.131847', '8-14 Eversholt St, Kings Cross, London NW1 1DG, UK', 0, '2020-04-17 06:08:50', '2020-04-17 06:08:50'),
(2, 1, '2020-04-17 06:08:50', '51.533149', '-0.137069', '76 Oakley Square, London NW1 1NH, UK', 0, '2020-04-17 06:08:50', '2020-04-17 06:08:50'),
(3, 2, '2020-04-17 06:08:50', '51.528390', '-0.151886', 'Regent\'s Park, Nursery Lodge, Inner Cir, London NW1 4NY, UK', 0, '2020-04-17 06:08:50', '2020-04-17 06:08:50'),
(4, 3, '2020-04-17 06:08:50', '51.528390', '-0.151886', 'Regent\'s Park, Nursery Lodge, Inner Cir, London NW1 4NY, UK', 0, '2020-04-17 06:08:50', '2020-04-17 06:08:50'),
(5, 4, '2020-04-17 06:08:50', '51.528380', '-0.151886', 'Regent\'s Park, Nursery Lodge, Inner Cir, London NW1 4NY, UK', 0, '2020-04-17 06:08:50', '2020-04-17 06:08:50'),
(6, 5, '2020-04-17 06:08:50', '51.528380', '-0.161886', '17 Outer Cir, Marylebone, London NW1 4RJ, UK', 0, '2020-04-17 06:08:50', '2020-04-17 06:08:50'),
(7, 6, '2020-04-17 06:08:50', '51.529380', '-0.151886', 'Regent\'s Park, Nursery Lodge, Inner Cir, London NW1 4NY, UK', 0, '2020-04-17 06:08:50', '2020-04-17 06:08:50'),
(8, 7, '2020-04-17 06:08:50', '51.528490', '-0.151886', 'Regent\'s Park, Nursery Lodge, Inner Cir, London NW1 4NY, UK', 0, '2020-04-17 06:08:50', '2020-04-17 06:08:50'),
(9, 8, '2020-04-17 06:08:50', '51.557843', '-0.115479', '25 Arthur Rd, London N7, UK', 0, '2020-04-17 06:08:50', '2020-04-17 06:08:50'),
(10, 9, '2020-04-17 06:08:50', '51.529374', '-0.136748', '43 Cardington St, Kings Cross, London NW1 2LR, UK', 0, '2020-04-17 06:08:50', '2020-04-17 06:08:50');

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
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_uuid_index` (`uuid`),
  ADD KEY `payments_health_institution_id_foreign` (`health_institution_id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_health_institution_id_foreign` FOREIGN KEY (`health_institution_id`) REFERENCES `health_institutions` (`id`) ON DELETE CASCADE;

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
