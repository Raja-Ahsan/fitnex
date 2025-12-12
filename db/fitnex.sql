-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Dec 13, 2025 at 12:31 AM
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
-- Database: `fitnex`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `heading` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1' COMMENT '0=inactive , 1=active',
  `deleted_at` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `created_by`, `slug`, `heading`, `image`, `short_description`, `description`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 1, 'about-funky-fit-game', 'ABOUT FUNKY FIT GAME', '24-12-19-220950.png', 'Amid the hustle of raising families, juggling careers, and navigating the daily grind, a group of friends and neighbors found joy in coming together. Tucked away in a neighborhood in Fort Worth, TX, it was a whirlwind of game nights, impromptu driveway hangouts, spontaneous parties, and the occasional Tuesday night happy hour—just because! Over time, though, we realized that while the fun never stopped, the feeling of being our best selves seemed to slip away. That\'s when Funky Fit Game was born! In an effort to get back on track with our health and fitness, we created a New Year’s fitness challenge that not only helped us get moving but also rekindled our sense of community, friendship, and, of course, our love of having a good time.', NULL, '1', NULL, '2024-08-16 12:57:19', '2024-12-19 17:09:50');

-- --------------------------------------------------------

--
-- Table structure for table `advertisements`
--

CREATE TABLE `advertisements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `short_description` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `city_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1' COMMENT '0=inactive , 1=active',
  `deleted_at` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `advertisements`
--

INSERT INTO `advertisements` (`id`, `created_by`, `name`, `short_description`, `description`, `city_id`, `state_id`, `image`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '1', 'Plumber', 'Plumbing services', '<p>Professionals&nbsp;Plumbing services</p>', 5, 366, '24-09-18-182104.webp', '1', NULL, '2024-09-18 13:21:04', '2024-10-04 15:49:48'),
(2, '1', 'Electronics', 'Electronic Services', '<p>Professionals&nbsp;Electronic Services</p>', 8, 476, '24-09-18-182656.webp', '1', NULL, '2024-09-18 13:26:56', '2024-10-04 15:49:35'),
(3, '1', 'Plumber', 'fghfghgfh', '<p>fghfghgfhgfhgf</p>', 6, 379, '24-09-18-182754.jpg', '1', NULL, '2024-09-18 13:27:54', '2024-10-04 15:49:20'),
(4, '1', 'dfghfg', 'fghfgh', '<p>dfghdfghdfgh</p>', 3, 231, '24-09-18-183808.webp', '1', NULL, '2024-09-18 13:38:08', '2024-10-04 15:49:03'),
(5, '1', 'carpet cleaner', 'this is my lastest advertisement', '<p>for all type of carpet cleaner</p>', 4, 283, '24-09-18-222409.webp', '1', NULL, '2024-09-18 17:24:09', '2024-10-04 15:48:53'),
(6, '1', 'My First Advertisement', 'Its my short description for my advertisement.', '<p>Its my some Long description for my advertisement. like and subscribe my youtube channel..</p>', 7, 404, '24-09-18-234740.jpg', '1', NULL, '2024-09-18 18:47:40', '2024-10-04 15:48:39'),
(7, '1', 'This is my Second Advertisement', 'This is my short description for my second advertisement.', '<p>\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"</p>', 2, 18, '24-09-20-182400.png', '1', NULL, '2024-09-20 13:24:00', '2024-10-04 15:45:49'),
(8, '1', 'Maxwell Chen', 'Rerum expedita aut nostrum incidunt dolores commodi soluta voluptatem dolore blanditiis deleniti fugiat sunt ducimus eius ea corporis autem', NULL, 12, 586, '24-10-04-201912.webp', '1', '2024-10-04 20:41:46', '2024-10-04 15:19:12', '2024-10-04 15:41:46'),
(9, '1', 'Judith Payne', 'Dolore aut dolores vitae commodo et quaerat consequuntur alias qui ut sit accusamus qui in et quibusdam', NULL, 1, 2, '24-10-04-203847.png', '1', '2024-10-04 20:41:43', '2024-10-04 15:38:47', '2024-10-04 15:41:43'),
(10, '14', 'Chastity Valdez', 'Enim delectus dicta sapiente et nulla ab doloribus obcaecati', '<p>Enim delectus dicta sapiente et nulla ab doloribus obcaecati&nbsp;Enim delectus dicta sapiente et nulla ab doloribus obcaecati Enim delectus dicta sapiente et nulla ab doloribus obcaecati</p>', 2, 18, '24-10-07-210231.png', '1', NULL, '2024-10-07 16:02:31', '2024-10-07 16:02:31');

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `behance` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1' COMMENT '0=inactive, 1= active',
  `deleted_at` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`id`, `created_by`, `slug`, `name`, `designation`, `facebook`, `twitter`, `instagram`, `behance`, `youtube`, `image`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'janet-richmond', 'Janet Richmond', 'Marketing Manager', 'https://www.facebook.com/', 'https://twitter.com/', 'https://www.instagram.com/', 'https://www.behance.net/', 'https://www.youtube.com/', '05-08-2022-163328.png', '1', NULL, '2022-08-05 11:33:28', '2022-08-05 11:51:52'),
(2, 1, 'grayson-gabrel', 'Grayson Gabrel', 'Buying Agent', 'https://www.facebook.com/', 'https://twitter.com/', 'https://www.instagram.com/', 'https://www.behance.net/', 'https://www.youtube.com/', '05-08-2022-184647.png', '1', NULL, '2022-08-05 13:46:47', '2022-08-05 13:47:27'),
(3, 1, 'jack-london', 'Jack London', 'Selling Agent', 'https://www.facebook.com/', 'https://twitter.com/', 'https://www.instagram.com/', 'https://www.behance.net/', 'https://www.youtube.com/', '05-08-2022-184838.png', '1', NULL, '2022-08-05 13:48:38', '2022-08-05 13:48:38'),
(4, 1, 'grayson-gabriel', 'Grayson Gabriel', 'Agent', 'https://www.facebook.com/', 'https://twitter.com/', 'https://www.instagram.com/', 'https://www.behance.net/', 'https://www.youtube.com/', '05-08-2022-185109.png', '1', NULL, '2022-08-05 13:51:09', '2022-08-05 13:51:09');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `trainer_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `google_calendar_event_id` varchar(255) DEFAULT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `time_zone` varchar(255) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `status` enum('pending','confirmed','cancelled','completed') NOT NULL DEFAULT 'pending',
  `description` text DEFAULT NULL,
  `payment_status` varchar(255) NOT NULL DEFAULT 'pending',
  `stripe_session_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `user_id`, `trainer_id`, `name`, `email`, `phone`, `google_calendar_event_id`, `appointment_date`, `appointment_time`, `time_zone`, `price`, `status`, `description`, `payment_status`, `stripe_session_id`, `created_at`, `updated_at`) VALUES
(1, NULL, 2, 'Quintessa Greer', 'asjadmmc67@gmail.com', NULL, NULL, '2025-12-10', '10:00:00', 'Asia/Karachi', 40.00, 'confirmed', 'Saepe in magni adipi', 'completed', 'cs_test_a118vJeugSsLfH1IcvmSMRl2Q9qRhiDUe95v33edBGqY82twaPjTVX8pad', '2025-12-03 16:37:09', '2025-12-03 16:37:55'),
(2, NULL, 2, 'Muhammad Asjad', 'asjadmmc67@gmail.com', NULL, NULL, '2025-12-10', '09:00:00', 'Asia/Karachi', 40.00, 'confirmed', 'testing', 'completed', 'cs_test_a11ETJIaLBKkYP1ADkR1ELb9XOlCEIu7sJuaFCFGaXj66gJWLP8JYh9luu', '2025-12-03 17:08:12', '2025-12-03 17:08:45'),
(3, NULL, 3, 'Calvin Terry', 'asjadmmc67@gmail.com', NULL, NULL, '2025-12-10', '12:00:00', 'Asia/Karachi', 35.00, 'confirmed', 'Assumenda lorem iste', 'completed', 'cs_test_a1th0OEgqDhZEBBtlWUYK1yyFJVd3Iu0MP9o102o5sZMElfGjMQletQORt', '2025-12-09 10:37:14', '2025-12-09 10:38:50'),
(4, NULL, 3, 'testing', 'asdasdas@gmail.com', NULL, NULL, '2025-12-11', '14:30:00', 'Asia/Karachi', 35.00, 'confirmed', 'testing', 'completed', 'cs_test_a18Vu2yXgqg2cw2eoLdvd2YpiiEOMfyuUr6ZIBztU9JwVXYgbBfN02P9jV', '2025-12-09 17:55:34', '2025-12-09 17:56:14'),
(7, NULL, 9, 'test', 'test@dfsfsd.cvd', NULL, NULL, '2025-12-30', '13:30:00', 'Asia/Karachi', 80.00, 'completed', NULL, 'completed', 'cs_test_a1ykC0hYDBXGZKSEyVAHUTujTITP5K6KNQGJT8bRjtjwdMb07IGHUR9qaA', '2025-12-10 14:48:29', '2025-12-11 11:34:57'),
(8, NULL, 9, 'asja', 'asjadmmc67@gmail.com', NULL, NULL, '2025-12-23', '13:00:00', 'Asia/Karachi', 80.00, 'confirmed', 'testing', 'completed', 'cs_test_a1a9AqEJsL4Jh5VDoTIlBHLgsoScSKfrseaVA9rKbJJetfY3FkRJwWDgG9', '2025-12-11 11:30:34', '2025-12-11 11:31:20'),
(9, NULL, 10, 'John Cena', 'production8430@gmail.com', NULL, NULL, '2025-12-15', '20:00:00', 'Asia/Karachi', 80.00, 'confirmed', 'Testing', 'completed', 'cs_test_a1CZOSZE3YfEE4kQjDNJTRFeRtYT5LLQ2VM2LgccVC3lyKCDfr0gxjsZsb', '2025-12-12 10:50:39', '2025-12-12 10:51:39'),
(10, NULL, 10, 'Kimberly Bishop', 'production8430@gmail.com', '+1 (153) 265-9149', NULL, '2025-12-22', '22:00:00', 'Asia/Karachi', 80.00, 'confirmed', 'Dolorum expedita rei', 'completed', 'cs_test_a1R0sZR26k6uEkFcr6X8nhOwfuYguw0IbloeodllYC0fJyJbiZH3fq26HF', '2025-12-12 17:48:55', '2025-12-12 17:49:35'),
(11, NULL, 10, 'Laurel Stuart', 'wuga@mailinator.com', '+1 (446) 892-2164', NULL, '2026-01-26', '22:00:00', 'Asia/Karachi', 80.00, 'confirmed', 'Et velit error est e', 'completed', 'cs_test_a19NTFLRYnajefLJxKZD2R8ncyLshf2FwWZZAkg9zQ4qcAsU4TGO8Ffle8', '2025-12-12 17:58:04', '2025-12-12 17:58:44');

-- --------------------------------------------------------

--
-- Table structure for table `availabilities`
--

CREATE TABLE `availabilities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trainer_id` bigint(20) UNSIGNED NOT NULL,
  `day_of_week` tinyint(4) NOT NULL COMMENT '0=Sunday, 1=Monday, ..., 6=Saturday',
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `session_duration` enum('30','45','60') NOT NULL DEFAULT '60' COMMENT 'Duration in minutes',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `availabilities`
--

INSERT INTO `availabilities` (`id`, `trainer_id`, `day_of_week`, `start_time`, `end_time`, `session_duration`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 9, 1, '22:00:00', '23:00:00', '60', 1, '2025-12-10 11:40:57', '2025-12-10 11:40:57'),
(3, 9, 2, '13:00:00', '14:00:00', '45', 1, '2025-12-10 14:26:12', '2025-12-10 14:26:12'),
(4, 10, 1, '22:00:00', '23:00:00', '60', 1, '2025-12-11 11:21:10', '2025-12-11 11:21:10'),
(5, 10, 5, '22:00:00', '23:00:00', '60', 1, '2025-12-11 11:26:56', '2025-12-11 11:26:56'),
(6, 10, 1, '20:00:00', '21:00:00', '60', 1, '2025-12-12 10:31:08', '2025-12-12 10:31:35'),
(7, 10, 2, '22:00:00', '22:45:00', '45', 1, '2025-12-12 15:14:45', '2025-12-12 15:15:16');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `short_description` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1' COMMENT '0=inactive , 1=active',
  `deleted_at` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `name`, `slug`, `short_description`, `description`, `image`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 'Book Your Fitness Session with FITNEX', 'trainers', NULL, NULL, '25-07-17-212042.webp', '1', NULL, '2025-07-17 16:20:42', '2025-07-17 16:20:42'),
(3, 'Book Your Trainer Session at FITNEX', 'trainer.detail', NULL, NULL, '25-07-17-212317.webp', '1', NULL, '2025-07-17 16:23:17', '2025-07-17 16:23:17'),
(4, 'About Us', 'about-us', NULL, NULL, '25-07-17-221414.webp', '1', NULL, '2025-07-17 17:14:14', '2025-07-17 17:15:18'),
(5, 'Book Your Session', 'appointments.create', NULL, NULL, '25-07-17-221630.webp', '1', NULL, '2025-07-17 17:16:30', '2025-07-17 17:16:30'),
(6, 'Resigtration', 'registration', NULL, NULL, '25-07-18-164614.webp', '1', NULL, '2025-07-18 11:46:14', '2025-07-18 11:46:14'),
(7, 'Login Your Account', 'login', NULL, NULL, '25-07-18-174534.webp', '1', NULL, '2025-07-18 12:45:34', '2025-07-18 12:45:34'),
(8, 'Contact Us', 'contact-us', NULL, NULL, '25-07-23-164952.webp', '1', NULL, '2025-07-23 11:49:53', '2025-07-23 11:49:53'),
(9, 'Blogs', 'blogs', NULL, NULL, '25-07-25-224823.webp', '1', NULL, '2025-07-25 17:48:23', '2025-07-25 17:48:23');

-- --------------------------------------------------------

--
-- Table structure for table `blocked_slots`
--

CREATE TABLE `blocked_slots` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trainer_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `reason` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blocked_slots`
--

INSERT INTO `blocked_slots` (`id`, `trainer_id`, `date`, `start_time`, `end_time`, `reason`, `created_at`, `updated_at`) VALUES
(1, 9, '2025-12-25', '01:00:00', '14:00:00', 'test', '2025-12-10 14:08:52', '2025-12-10 14:08:52'),
(4, 9, '2025-12-25', '02:00:00', '03:00:00', NULL, '2025-12-10 14:13:24', '2025-12-10 14:13:24');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `category_slug` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `post` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `created_by`, `category_slug`, `title`, `slug`, `description`, `post`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'events', '5 amazing benefits of kickboxing for women', '5-amazing-benefits-of-kickboxing-for-women', '<div>\r\n<h2>What is Lorem Ipsum?</h2>\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n</div>\r\n<div>\r\n<h2>Why do we use it?</h2>\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n</div>\r\n<p>&nbsp;</p>\r\n<div>\r\n<h2>Where does it come from?</h2>\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.<br /><br /><br /></p>\r\n<div>\r\n<h2>What is Lorem Ipsum?</h2>\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n</div>\r\n<div>\r\n<h2>Why do we use it?</h2>\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n</div>\r\n<p>&nbsp;</p>\r\n<div>\r\n<h2>Where does it come from?</h2>\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.<br /><br /><br /></p>\r\n<div>\r\n<h2>What is Lorem Ipsum?</h2>\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n</div>\r\n<div>\r\n<h2>Why do we use it?</h2>\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n</div>\r\n<p>&nbsp;</p>\r\n<div>\r\n<h2>Where does it come from?</h2>\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.<br /><br /><br /></p>\r\n<div>\r\n<h2>What is Lorem Ipsum?</h2>\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n</div>\r\n<div>\r\n<h2>Why do we use it?</h2>\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n</div>\r\n<p>&nbsp;</p>\r\n<div>\r\n<h2>Where does it come from?</h2>\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.<br /><br /><br /></p>\r\n<div>\r\n<h2>What is Lorem Ipsum?</h2>\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n</div>\r\n<div>\r\n<h2>Why do we use it?</h2>\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n</div>\r\n<p>&nbsp;</p>\r\n<div>\r\n<h2>Where does it come from?</h2>\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.<br /><br /><br /></p>\r\n<div>\r\n<h2>What is Lorem Ipsum?</h2>\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n</div>\r\n<div>\r\n<h2>Why do we use it?</h2>\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n</div>\r\n<p>&nbsp;</p>\r\n<div>\r\n<h2>Where does it come from?</h2>\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>', '28-07-2025-222342.jpg', 1, NULL, '2025-07-28 15:41:17', '2025-07-28 17:23:42'),
(2, 1, 'workouts', 'This is the workout blog', 'this-is-the-workout-blog', '<h2>What is Lorem Ipsum?</h2>\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&nbsp;<br /><br /></p>\r\n<h2>What is Lorem Ipsum?</h2>\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br /><br /></p>\r\n<h2>What is Lorem Ipsum?</h2>\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br /><br /></p>\r\n<h2>What is Lorem Ipsum?</h2>\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '28-07-2025-214557.webp', 1, NULL, '2025-07-28 16:45:57', '2025-07-28 16:45:57'),
(3, 1, 'lifestyle', 'This is the Lifestyle blog', 'this-is-the-lifestyle-blog', '<h2>What is Lorem Ipsum?</h2>\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br /><br /></p>\r\n<h2>What is Lorem Ipsum?</h2>\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br /><br /></p>\r\n<h2>What is Lorem Ipsum?</h2>\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br /><br /></p>\r\n<h2>What is Lorem Ipsum?</h2>\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br /><br /></p>\r\n<h2>What is Lorem Ipsum?</h2>\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '28-07-2025-214650.jpg', 1, NULL, '2025-07-28 16:46:50', '2025-07-28 17:22:12');

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `created_by`, `name`, `slug`, `description`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 1, 'Bodybuilding', 'bodybuilding', NULL, 1, NULL, '2025-07-25 18:40:06', '2025-07-28 13:40:32'),
(3, 1, 'Workouts', 'workouts', NULL, 1, NULL, '2025-07-28 13:38:16', '2025-07-28 13:38:16'),
(4, 1, 'Lifestyle', 'lifestyle', NULL, 1, NULL, '2025-07-28 13:38:36', '2025-07-28 13:38:36'),
(5, 1, 'Motivation', 'motivation', NULL, 1, NULL, '2025-07-28 13:38:48', '2025-07-28 13:38:48'),
(6, 1, 'Events', 'events', NULL, 1, NULL, '2025-07-28 13:39:00', '2025-07-28 13:39:00');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `trainer_id` bigint(20) UNSIGNED NOT NULL,
  `time_slot_id` bigint(20) UNSIGNED NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `currency` varchar(3) NOT NULL DEFAULT 'USD',
  `payment_status` enum('pending','paid','failed','refunded') NOT NULL DEFAULT 'pending',
  `stripe_payment_intent` varchar(255) DEFAULT NULL,
  `stripe_session_id` varchar(255) DEFAULT NULL,
  `booking_status` enum('pending','confirmed','cancelled','completed') NOT NULL DEFAULT 'pending',
  `google_event_id` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `cancelled_at` timestamp NULL DEFAULT NULL,
  `cancelled_by` bigint(20) UNSIGNED DEFAULT NULL,
  `cancellation_reason` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booking_reschedules`
--

CREATE TABLE `booking_reschedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `old_slot_id` bigint(20) UNSIGNED NOT NULL,
  `new_slot_id` bigint(20) UNSIGNED NOT NULL,
  `rescheduled_by` bigint(20) UNSIGNED NOT NULL,
  `reason` text DEFAULT NULL,
  `price_difference` decimal(10,2) DEFAULT NULL COMMENT 'Positive if customer owes more, negative if refund needed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `parent_id` varchar(255) DEFAULT NULL COMMENT '0=no parent',
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1' COMMENT '0=inactive, 1= active',
  `deleted_at` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `created_by`, `parent_id`, `title`, `slug`, `image`, `description`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'Personal Training', 'personal-training', '20250704164158.png', NULL, '1', NULL, '2025-07-04 11:41:58', '2025-07-04 16:47:55'),
(2, 1, NULL, 'Nutrition Coaching', 'nutrition-coaching', '20250704164838.png', NULL, '1', NULL, '2025-07-04 11:48:38', '2025-07-04 11:48:38'),
(3, 1, NULL, 'Sports Performance', 'sports-performance', '20250704164852.png', NULL, '1', NULL, '2025-07-04 11:48:52', '2025-07-04 11:48:52'),
(4, 1, NULL, 'Body Building', 'body-building', '20250707192252.jpg', NULL, '1', NULL, '2025-07-04 11:49:09', '2025-07-07 14:22:52'),
(5, 1, NULL, 'Custom Goal-Based Plans', 'custom-goal-based-plans', '20250704164924.png', NULL, '1', NULL, '2025-07-04 11:49:24', '2025-07-04 11:49:24');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `time_zone` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `country`, `city`, `time_zone`, `status`, `created_at`, `updated_at`) VALUES
(1, 'USA', 'New York', 'Eastern Time Zone', 1, '2022-05-19 12:26:17', '2022-05-19 12:26:17'),
(2, 'USA', 'California', 'Pacific Time Zone', 1, '2022-05-19 12:26:18', '2022-05-19 12:26:18'),
(3, 'USA', 'Illinois', 'Central Time Zone', 1, '2022-05-19 12:26:31', '2022-05-19 12:26:31'),
(4, 'USA', 'Texas', 'Central Time Zone, Mountain Time Zone', 1, '2022-05-19 12:26:33', '2022-05-19 12:26:33'),
(5, 'USA', 'Pennsylvania', 'Eastern Time Zone', 1, '2022-05-19 12:26:41', '2022-05-19 12:26:41'),
(6, 'USA', 'Arizona', 'Mountain Time Zone', 1, '2022-05-19 12:26:42', '2022-05-19 12:26:42'),
(7, 'USA', 'Florida', 'Eastern Time Zone, Central Time Zone', 1, '2022-05-19 12:26:44', '2022-05-19 12:26:44'),
(8, 'USA', 'Indiana', 'Eastern Time Zone, Central Time Zone', 1, '2022-05-19 12:26:51', '2022-05-19 12:26:51'),
(9, 'USA', 'Ohio', 'Eastern Time Zone', 1, '2022-05-19 12:26:52', '2022-05-19 12:26:52'),
(10, 'USA', 'North Carolina', 'Eastern Time Zone', 1, '2022-05-19 12:26:55', '2022-05-19 12:26:55'),
(11, 'USA', 'Michigan', 'Eastern Time Zone, Central Time Zone', 1, '2022-05-19 12:26:56', '2022-05-19 12:26:56'),
(12, 'USA', 'Tennessee', 'Eastern Time Zone, Central Time Zone', 1, '2022-05-19 12:26:58', '2022-05-19 12:26:58'),
(13, 'USA', 'Massachusetts', 'Eastern Time Zone', 1, '2022-05-19 12:26:59', '2022-05-19 12:26:59'),
(14, 'USA', 'Washington', 'Pacific Time Zone', 1, '2022-05-19 12:27:02', '2022-05-19 12:27:02'),
(15, 'USA', 'Colorado', 'Mountain Time Zone', 1, '2022-05-19 12:27:03', '2022-05-19 12:27:03'),
(16, 'USA', 'District of Columbia', NULL, 1, '2022-05-19 12:27:04', '2022-05-19 12:27:04'),
(17, 'USA', 'Maryland', 'Eastern Time Zone', 1, '2022-05-19 12:27:05', '2022-05-19 12:27:05'),
(18, 'USA', 'Kentucky', 'Eastern Time Zone, Central Time Zone', 1, '2022-05-19 12:27:05', '2022-05-19 12:27:05'),
(19, 'USA', 'Oregon', 'Pacific Time Zone, Mountain Time Zone', 1, '2022-05-19 12:27:05', '2022-05-19 12:27:05'),
(20, 'USA', 'Oklahoma', 'Central Time Zone', 1, '2022-05-19 12:27:06', '2022-05-19 12:27:06'),
(21, 'USA', 'Wisconsin', 'Central Time Zone', 1, '2022-05-19 12:27:07', '2022-05-19 12:27:07'),
(22, 'USA', 'Nevada', 'Pacific Time Zone, Mountain Time Zone', 1, '2022-05-19 12:27:08', '2022-05-19 12:27:08'),
(23, 'USA', 'New Mexico', 'Mountain Time Zone', 1, '2022-05-19 12:27:08', '2022-05-19 12:27:08'),
(24, 'USA', 'Missouri', 'Central Time Zone', 1, '2022-05-19 12:27:09', '2022-05-19 12:27:09'),
(25, 'USA', 'Virginia', 'Eastern Time Zone', 1, '2022-05-19 12:27:11', '2022-05-19 12:27:11'),
(26, 'USA', 'Georgia', 'Eastern Time Zone', 1, '2022-05-19 12:27:12', '2022-05-19 12:27:12'),
(27, 'USA', 'Nebraska', 'Central Time Zone, Mountain Time Zone', 1, '2022-05-19 12:27:13', '2022-05-19 12:27:13'),
(28, 'USA', 'Minnesota', 'Central Time Zone', 1, '2022-05-19 12:27:13', '2022-05-19 12:27:13'),
(29, 'USA', 'Kansas', 'Central Time Zone, Mountain Time Zone', 1, '2022-05-19 12:27:15', '2022-05-19 12:27:15'),
(30, 'USA', 'Louisiana', 'Central Time Zone', 1, '2022-05-19 12:27:16', '2022-05-19 12:27:16'),
(31, 'USA', 'Hawaii', 'Hawaii-Aleutian Time Zone', 1, '2022-05-19 12:27:16', '2022-05-19 12:27:16'),
(32, 'USA', 'Alaska', 'Alaska Time Zone, Hawaii-Aleutian Time Zone', 1, '2022-05-19 12:27:16', '2022-05-19 12:27:16'),
(33, 'USA', 'New Jersey', 'Eastern Time Zone', 1, '2022-05-19 12:27:16', '2022-05-19 12:27:16'),
(34, 'USA', 'Idaho', 'Mountain Time Zone, Pacific Time Zone', 1, '2022-05-19 12:27:17', '2022-05-19 12:27:17'),
(35, 'USA', 'Alabama', 'Central Time Zone', 1, '2022-05-19 12:27:18', '2022-05-19 12:27:18'),
(36, 'USA', 'Iowa', 'Central Time Zone', 1, '2022-05-19 12:27:19', '2022-05-19 12:27:19'),
(37, 'USA', 'Arkansas', 'Central Time Zone', 1, '2022-05-19 12:27:20', '2022-05-19 12:27:20'),
(38, 'USA', 'Utah', 'Mountain Time Zone', 1, '2022-05-19 12:27:21', '2022-05-19 12:27:21'),
(39, 'USA', 'Rhode Island', 'Eastern Time Zone', 1, '2022-05-19 12:27:22', '2022-05-19 12:27:22'),
(40, 'USA', 'Mississippi', 'Central Time Zone', 1, '2022-05-19 12:27:22', '2022-05-19 12:27:22'),
(41, 'USA', 'South Dakota', 'Central Time Zone, Mountain Time Zone', 1, '2022-05-19 12:27:22', '2022-05-19 12:27:22'),
(42, 'USA', 'Bristol', 'Eastern Time Zone', 1, '2022-05-19 12:27:23', '2022-05-19 12:27:23'),
(43, 'USA', 'South Carolina', 'Eastern Time Zone', 1, '2022-05-19 12:27:23', '2022-05-19 12:27:23'),
(44, 'USA', 'New Hampshire', 'Eastern Time Zone', 1, '2022-05-19 12:27:24', '2022-05-19 12:27:24'),
(45, 'USA', 'North Dakota', 'Central Time Zone, Mountain Time Zone', 1, '2022-05-19 12:27:24', '2022-05-19 12:27:24'),
(46, 'USA', 'Montana', 'Mountain Time Zone', 1, '2022-05-19 12:27:24', '2022-05-19 12:27:24'),
(47, 'USA', 'Delaware', 'Eastern Time Zone', 1, '2022-05-19 12:27:25', '2022-05-19 12:27:25'),
(48, 'USA', 'Maine', 'Eastern Time Zone', 1, '2022-05-19 12:27:25', '2022-05-19 12:27:25'),
(49, 'USA', 'Wyoming', 'Mountain Time Zone', 1, '2022-05-19 12:27:25', '2022-05-19 12:27:25'),
(50, 'USA', 'West Virginia', 'Eastern Time Zone', 1, '2022-05-19 12:27:25', '2022-05-19 12:27:25'),
(51, 'USA', 'Vermont', 'Eastern Time Zone', 1, '2022-05-19 12:27:25', '2022-05-19 12:27:25');

-- --------------------------------------------------------

--
-- Table structure for table `client_contacts`
--

CREATE TABLE `client_contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `epc_developer_id` bigint(20) DEFAULT NULL,
  `project_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1' COMMENT '0=inactive , 1=active',
  `deleted_at` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client_contacts`
--

INSERT INTO `client_contacts` (`id`, `user_id`, `epc_developer_id`, `project_id`, `name`, `email`, `phone`, `message`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 77, 101, 15, 'AD Dev', 'asjadmmc67@gmail.com', '+1 (951) 245-4492', 'Quo cum omnis minim', '1', '2025-06-16 20:16:59', '2025-06-16 13:31:54', '2025-06-16 15:16:59'),
(2, 102, 101, 15, 'Platinum Member', 'platinum@mailinator.com', '+1 (308) 298-6198', 'hi', '1', NULL, '2025-06-16 15:16:14', '2025-06-16 15:16:14'),
(3, 102, 77, 9, 'Platinum Member', 'platinum@mailinator.com', '+1 (308) 298-6198', 'shgasjh', '1', '2025-06-18 18:38:35', '2025-06-18 13:36:35', '2025-06-18 13:38:35');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1' COMMENT '0=inactive , 1=active',
  `deleted_at` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `phone`, `message`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Roary Fowler', 'xaxa@mailinator.com', '+1 (744) 744-9955', 'Nemo animi vitae pa', '1', NULL, '2025-07-23 15:06:56', '2025-07-23 15:06:56');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `service` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1' COMMENT '0=inactive , 1=active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `phone`, `address`, `message`, `service`, `status`, `created_at`, `updated_at`) VALUES
(33, 'Ina Kim', 'lilyp@mailinator.com', '+1 (562) 716-2537', NULL, NULL, 'body-building', '1', '2025-07-17 11:21:03', '2025-07-17 11:21:03'),
(34, 'Rogan Zimmerman', 'gadu@mailinator.com', '+1 (759) 967-1155', NULL, NULL, 'personal-training', '1', '2025-07-17 15:27:31', '2025-07-17 15:27:31'),
(35, 'Madaline Francis', 'humomavy@mailinator.com', NULL, NULL, 'Et irure quasi nostr', NULL, '1', '2025-07-23 14:00:52', '2025-07-23 14:00:52'),
(36, 'Kaseem Andrews', 'hipeh@mailinator.com', '+1 (846) 895-7207', NULL, NULL, 'sports-performance', '1', '2025-07-23 15:07:27', '2025-07-23 15:07:27');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `coupon_type` varchar(255) NOT NULL,
  `discount` bigint(20) NOT NULL,
  `coupon_code` varchar(255) NOT NULL,
  `max_purchase` bigint(20) NOT NULL,
  `start_date` date NOT NULL,
  `expire_date` date NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1' COMMENT '0=inactive, 1= active',
  `deleted_at` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `user_id`, `title`, `slug`, `coupon_type`, `discount`, `coupon_code`, `max_purchase`, `start_date`, `expire_date`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(3, 1, 'New Coupon', 'new-coupon', 'fix', 50, 'UuaeXr', 2, '2022-04-15', '2022-06-30', '1', NULL, '2022-04-13 15:37:02', '2022-06-01 15:28:45'),
(4, 1, 'New Data', 'new-data', 'percent', 10, 'Uuaejh', 30, '2022-04-28', '2022-06-30', '1', NULL, '2022-04-13 15:38:56', '2022-06-01 15:29:08'),
(6, 1, 'floral art 1', 'floral-art-1', 'fix', 5, '7gezfd', 1, '2023-10-27', '2023-10-28', '1', NULL, '2023-10-26 20:15:47', '2023-10-26 20:15:47'),
(7, 1, 'test', 'test', 'fix', 10, 'yoDwqY', 100, '2024-12-11', '2024-12-12', '1', NULL, '2024-12-10 16:15:04', '2024-12-10 16:15:04');

-- --------------------------------------------------------

--
-- Table structure for table `coupon_usages`
--

CREATE TABLE `coupon_usages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `coupon_code` varchar(255) NOT NULL,
  `usages` bigint(20) NOT NULL,
  `deleted_at` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupon_usages`
--

INSERT INTO `coupon_usages` (`id`, `user_id`, `coupon_code`, `usages`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, '7gezfd', 1, '2023-10-26 20:18:19', '2023-10-26 20:16:08', '2023-10-26 20:18:19'),
(2, 1, '7gezfd', 1, NULL, '2023-10-26 20:18:30', '2023-10-26 20:18:30'),
(3, 71, '7gezfd', 1, '2023-10-26 23:07:51', '2023-10-26 20:40:39', '2023-10-26 23:07:51'),
(4, 71, '7gezfd', 1, NULL, '2023-10-27 16:40:02', '2023-10-27 16:40:02'),
(5, 73, '7gezfd', 1, NULL, '2023-10-27 17:37:19', '2023-10-27 17:37:19');

-- --------------------------------------------------------

--
-- Table structure for table `document_repositories`
--

CREATE TABLE `document_repositories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `project_id` bigint(20) UNSIGNED DEFAULT NULL,
  `parent_id` varchar(255) DEFAULT NULL COMMENT '0=no parent',
  `size` varchar(255) DEFAULT NULL,
  `document_file` longtext DEFAULT NULL,
  `status` varchar(255) DEFAULT 'upcoming' COMMENT 'upcoming, ongoing, completed',
  `deleted_at` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `host` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `end_time` time NOT NULL,
  `location` varchar(255) NOT NULL,
  `location_link` varchar(255) NOT NULL,
  `registration_link` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1' COMMENT '0=inactive , 1=active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `created_by`, `title`, `host`, `date`, `time`, `end_time`, `location`, `location_link`, `registration_link`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Prince Edward County Networking and Membership Drive', 'Hosted by Dominion, Strata, SCVBA, and the Farmville Chamber', '2025-06-12', '17:30:00', '19:30:00', 'Catbird Rooftop Terrace, Farmville, VA', 'https://www.hotelweyanoke.com/dining/catbird-rooftop-terrace', 'https://www.eventbrite.com/e/networking-and-membership-drive-tickets-1388453595079', '0', '2025-06-18 18:00:19', '2025-06-18 18:15:35'),
(2, 1, 'Prince Edward County Networking and Membership Drive', 'Hosted by Dominion, Strata, SCVBA, and the Farmville Chamber', '2025-06-13', '17:30:00', '19:30:00', 'Catbird Rooftop Terrace, Farmville, VA', 'https://www.hotelweyanoke.com/dining/catbird-rooftop-terrace', 'https://www.eventbrite.com/e/networking-and-membership-drive-tickets-1388453595079', '1', '2025-06-18 18:13:53', '2025-06-18 18:13:53'),
(3, 1, '21-May-1979', '15-Jul-2012', '2019-12-30', '11:58:00', '05:59:00', '22-Jul-2025', 'https://www.kabuwexubon.co', '11-Aug-2005', '1', '2025-07-25 18:44:12', '2025-07-25 18:44:12');

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
-- Table structure for table `f_a_q_s`
--

CREATE TABLE `f_a_q_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `question` varchar(255) DEFAULT NULL,
  `answer` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1' COMMENT '0=inactive , 1=active',
  `deleted_at` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `f_a_q_s`
--

INSERT INTO `f_a_q_s` (`id`, `created_by`, `question`, `answer`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '1', NULL, '2022-05-19 12:40:36', '2022-05-19 12:40:36'),
(2, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '1', NULL, '2022-05-19 12:41:25', '2022-05-19 12:41:25'),
(3, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '1', NULL, '2022-05-19 12:41:38', '2022-05-19 12:41:38'),
(4, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '1', NULL, '2022-05-19 12:42:06', '2022-05-19 12:42:06'),
(5, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '1', NULL, '2022-05-19 12:42:23', '2022-05-19 12:42:23'),
(6, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '1', NULL, '2022-05-19 12:42:36', '2022-05-19 12:42:36'),
(7, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '1', NULL, '2022-05-19 12:42:49', '2022-05-19 12:42:49'),
(8, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '1', NULL, '2022-05-19 12:43:19', '2022-05-19 12:43:19'),
(9, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '1', NULL, '2022-05-19 12:43:29', '2022-05-19 12:43:29');

-- --------------------------------------------------------

--
-- Table structure for table `home_sliders`
--

CREATE TABLE `home_sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `heading` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_sliders`
--

INSERT INTO `home_sliders` (`id`, `title`, `slug`, `heading`, `description`, `image`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Home Slider', 'home-slider', 'Home', '<h1>We are South-Central Virginia businesses creating jobs,&nbsp;<span>promoting local business owners and workers, and&nbsp;</span><span>knocking down barriers to economic opportunity.</span></h1>', '19-12-2024-172731.jpg', 1, '2025-04-14 17:03:39', '2024-12-19 11:51:40', '2025-04-14 12:03:39'),
(2, 'Home Slider 2', 'home-slider-2', 'Home', '<h1>We are South-Central Virginia businesses creating jobs,&nbsp;<span>promoting local business owners and workers, and&nbsp;</span><span>knocking down barriers to economic opportunity.</span></h1>', '14-04-2025-165118.png', 1, '2025-07-02 18:45:03', '2024-12-19 12:09:29', '2025-07-02 13:45:03'),
(3, NULL, NULL, NULL, '<h1>We are South-Central Virginia businesses creating jobs, promoting local business owners and workers, and knocking down barriers to economic opportunity.</h1>', '14-04-2025-170454.png', 1, '2025-04-14 17:05:16', '2025-04-14 12:04:54', '2025-04-14 12:05:16'),
(4, NULL, NULL, NULL, '<h1>We are South-Central Virginia businesses creating jobs, promoting local business owners and workers, and knocking down barriers to economic opportunity.</h1>', '14-04-2025-170640.png', 1, '2025-07-02 18:44:59', '2025-04-14 12:06:40', '2025-07-02 13:44:59'),
(5, NULL, NULL, NULL, '<p>ertggdgdg dsfgsdgd dfgdfgdfg dgdgdfg sdfgdgdf dfgdgdg sdf</p>', '14-04-2025-210824.png', 1, '2025-04-14 21:08:58', '2025-04-14 16:08:24', '2025-04-14 16:08:58'),
(6, 'Trusted by 100k+ clients', NULL, 'Find Your Perfect Fit with FITNEX', '<p><span>Connect with top wellness professionals&mdash;from fitness trainers to nutritionists&mdash;all in one place.</span></p>', '07-07-2025-202101.png', 1, NULL, '2025-07-07 11:07:13', '2025-07-07 15:25:09'),
(7, 'Trusted by 100k+ clients', NULL, 'Your Goals. Our Trainers. Real Results.', '<p>From weight loss to strength training, find the right fitness coach tailored to your needs. Only on FITNEX.</p>', '07-07-2025-200228.jpg', 1, NULL, '2025-07-07 11:07:46', '2025-07-07 16:13:52'),
(8, 'Trusted by 100k+ clients', NULL, 'You Deserve a Trainer Who Gets You', '<p>FITNEX connects you with personal trainers and fitness experts who guide you every step of the way.</p>', '07-07-2025-200306.jpg', 1, NULL, '2025-07-07 15:03:06', '2025-07-07 16:14:52'),
(9, NULL, NULL, NULL, NULL, NULL, 1, '2025-07-07 20:13:06', '2025-07-07 15:13:01', '2025-07-07 15:13:06');

-- --------------------------------------------------------

--
-- Table structure for table `job_posts`
--

CREATE TABLE `job_posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `job_category_id` int(11) DEFAULT NULL,
  `short_description` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `county` varchar(255) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1' COMMENT '0=inactive , 1=active',
  `deleted_at` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_posts`
--

INSERT INTO `job_posts` (`id`, `created_by`, `name`, `slug`, `job_category_id`, `short_description`, `description`, `county`, `city_id`, `state_id`, `image`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Solar Technical Officer', NULL, NULL, 'Commodi dicta aute velit rerum omnis modi eos expedita', '<p>Commodi dicta aute velit rerum omnis modi eos expedita&nbsp;Commodi dicta aute velit rerum omnis modi eos expedita</p>', 'Charlotte', NULL, NULL, '25-03-19-190022.jpg', '1', NULL, '2025-03-19 14:00:22', '2025-03-20 16:47:12'),
(2, 1, 'Whoopi Beck', NULL, NULL, 'Quia aut eius qui odit fugit ut similique in sit qui dolore', '<p>Quia aut eius qui odit fugit ut similique in sit qui dolore&nbsp;Quia aut eius qui odit fugit ut similique in sit qui dolore</p>', 'Halifax', NULL, NULL, '25-03-19-190320.jpg', '1', NULL, '2025-03-19 14:03:20', '2025-03-20 16:47:03'),
(3, 1, 'Indira Best', NULL, NULL, 'Assumenda eveniet quo accusamus nobis dolorum consequuntur quasi minim qui', '<p>Assumenda eveniet quo accusamus nobis dolorum consequuntur quasi minim qui&nbsp;Assumenda eveniet quo accusamus nobis dolorum consequuntur quasi minim qui</p>', 'Dinwiddie', NULL, NULL, '25-03-19-190336.jpg', '1', NULL, '2025-03-19 14:03:36', '2025-03-20 16:46:54'),
(4, 1, 'Dustin Gaines', NULL, NULL, 'Officia et laborum id itaque atque consequatur Ea commodo rerum deserunt dolorem aspernatur iusto ratione omnis incidunt', '<p>Officia et laborum id itaque atque consequatur Ea commodo rerum deserunt dolorem aspernatur iusto ratione omnis incidunt&nbsp;Officia et laborum id itaque atque consequatur Ea commodo rerum deserunt dolorem aspernatur iusto ratione omnis incidunt</p>', 'Appomattox', NULL, NULL, '25-03-19-190357.jpg', '1', NULL, '2025-03-19 14:03:57', '2025-03-20 16:46:48'),
(5, 1, 'Lyle Haynes', NULL, NULL, 'Ullamco esse aute eos ullamco consequatur Et dignissimos', '<p>Ullamco esse aute eos ullamco consequatur Et dignissimos&nbsp;Ullamco esse aute eos ullamco consequatur Et dignissimos&nbsp;Ullamco esse aute eos ullamco consequatur Et dignissimos</p>', 'Fluvanna', NULL, NULL, '25-03-19-190415.jpg', '1', NULL, '2025-03-19 14:04:15', '2025-03-20 16:46:41'),
(6, 1, 'Lacota Bonner', NULL, NULL, 'Sint aut magni dolores sit quam reprehenderit obcaecati', '<p>Sint aut magni dolores sit quam reprehenderit obcaecati&nbsp;Sint aut magni dolores sit quam reprehenderit obcaecati&nbsp;Sint aut magni dolores sit quam reprehenderit obcaecati</p>', 'Lunenburg', NULL, NULL, '25-03-19-190436.jpg', '1', NULL, '2025-03-19 14:04:36', '2025-03-20 16:46:35'),
(7, 1, 'Uta Wiggins', NULL, NULL, 'Magni ipsa mollit exercitation laboris officiis perferendis ea', '<p>Magni ipsa mollit exercitation laboris officiis perferendis ea&nbsp;Sint aut magni dolores sit quam reprehenderit obcaecati&nbsp;</p>', 'Goochland', NULL, NULL, '25-03-19-190459.jpg', '1', NULL, '2025-03-19 14:04:59', '2025-03-20 16:46:28'),
(8, 1, 'Griffith Bishop', NULL, NULL, 'Et alias cupiditate vero impedit sunt facere nihil et reprehenderit amet hic ex omnis qui dolor', '<p>Et alias cupiditate vero impedit sunt facere nihil et reprehenderit amet hic ex omnis qui dolor&nbsp;Et alias cupiditate vero impedit sunt facere nihil et reprehenderit amet hic ex omnis qui dolor</p>', 'Cumberland', NULL, NULL, '25-03-19-190520.jpg', '1', NULL, '2025-03-19 14:05:20', '2025-03-20 16:46:22'),
(9, 1, 'Wang Skinner', NULL, NULL, 'Voluptatem eum odit sint placeat iusto non et fugiat et et nihil eveniet unde', '<p>Voluptatem eum odit sint placeat iusto non et fugiat et et nihil eveniet unde&nbsp;Voluptatem eum odit sint placeat iusto non et fugiat et et nihil eveniet unde</p>', 'Campbell', NULL, NULL, '25-03-19-190558.jpg', '1', NULL, '2025-03-19 14:05:58', '2025-03-20 16:46:16'),
(10, 1, 'Whoopi Bailey', NULL, 1, NULL, '<p>In ipsum dolorem quia maxime voluptate voluptate odio&nbsp;In ipsum dolorem quia maxime voluptate voluptate odio&nbsp;In ipsum dolorem quia maxime voluptate voluptate odio</p>', 'Amelia', NULL, NULL, '25-03-19-190615.jpg', '1', NULL, '2025-03-19 14:06:15', '2025-05-08 19:23:10'),
(11, 1, 'Keane Moreno', NULL, NULL, 'Ut nobis atque laboris possimus ipsa laborum fugiat tempore nihil harum non cupidatat maiores exercitation', '<p>In ipsum dolorem quia maxime voluptate voluptate odio&nbsp;Ut nobis atque laboris possimus ipsa laborum fugiat tempore nihil harum non cupidatat maiores exercitation</p>', NULL, 42, 955, '25-03-19-190635.jpg', '1', '2025-03-20 21:44:49', '2025-03-19 14:06:35', '2025-03-20 16:44:49'),
(12, 1, 'Barclay Middleton', NULL, NULL, 'Sit aute reprehenderit hic voluptate culpa non placeat eveniet in eiusmod quae id mollit natus', '<p>Sit aute reprehenderit hic voluptate culpa non placeat eveniet in eiusmod quae id mollit natus</p>', NULL, 32, 857, '25-03-20-212416.jpg', '1', '2025-03-20 21:44:46', '2025-03-20 16:24:16', '2025-03-20 16:44:46'),
(13, 1, 'Benjamin Allen', NULL, NULL, 'Nemo fuga Dolor voluptates ut', '<p>Nemo fuga Dolor voluptates ut&nbsp;Nemo fuga Dolor voluptates ut</p>', NULL, NULL, NULL, '25-03-20-213114.jpg', '1', '2025-03-20 21:44:43', '2025-03-20 16:31:14', '2025-03-20 16:44:43'),
(14, 1, 'test', NULL, 1, NULL, '<p>testtingg</p>', 'Brunswick', NULL, NULL, '25-05-09-001917.png', '1', '2025-05-09 00:23:18', '2025-05-08 19:19:17', '2025-05-08 19:23:18');

-- --------------------------------------------------------

--
-- Table structure for table `job_post_categories`
--

CREATE TABLE `job_post_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1' COMMENT '0=inactive, 1= active',
  `deleted_at` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_post_categories`
--

INSERT INTO `job_post_categories` (`id`, `created_by`, `title`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Information Technology', '1', NULL, '2025-05-08 19:12:26', '2025-05-08 19:12:26');

-- --------------------------------------------------------

--
-- Table structure for table `member_directories`
--

CREATE TABLE `member_directories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `category_id` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`category_id`)),
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `phone_no` varchar(255) DEFAULT NULL,
  `hear_about_us` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `rejection_reason` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending' COMMENT 'pending, approved, rejected',
  `deleted_at` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `member_directories`
--

INSERT INTO `member_directories` (`id`, `created_by`, `category_id`, `title`, `slug`, `description`, `name`, `email`, `facebook`, `address`, `url`, `phone_no`, `hear_about_us`, `image`, `rejection_reason`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 29, '[\"7\",\"6\",\"1\"]', 'Dewberry Engineers', 'dewberry-engineers', 'Engineers providing services and subject matter expertise from site selection through record drawings.', 'Danielle Williams', NULL, NULL, NULL, 'https://www.dewberry.com/', '(804) 337-8199', NULL, '20250619182021.png', NULL, 'approved', NULL, '2025-06-19 13:20:21', '2025-06-19 13:34:03'),
(2, 68, '[\"16\",\"1\"]', 'RC FlyBy', 'rc-flyby', 'RCFlyBy would love to capture drone photos and videos for your company and provide quality service.', 'Ryland Clark', NULL, NULL, NULL, 'https://www.rcflyby.com/', '(434) 470-1686', NULL, '20250619182923.png', NULL, 'approved', NULL, '2025-06-19 13:29:23', '2025-06-19 15:33:18'),
(3, 3, '[\"3\",\"2\"]', 'Abbott Farm Suppliers', 'abbott-farm-suppliers', 'Helping farmers, gardeners, hunters, and business owners get the highest quality products.', 'Darnell Abbott', NULL, NULL, NULL, 'https://www.abbottsinc.com/', '(434) 470-6112', NULL, '20250619193313.png', NULL, 'approved', NULL, '2025-06-19 14:33:13', '2025-06-19 14:38:22'),
(4, 19, '[\"14\",\"2\"]', 'Colonial Construction Materials', 'colonial-construction-materials', 'Supplying product solutions for erosion control, and management for stormwater, soil stability, and vegetation.', 'Pat Branin', NULL, NULL, NULL, 'https://colonial-materials.com/', '(804) 264-0128', NULL, '20250619193747.png', NULL, 'approved', NULL, '2025-06-19 14:37:47', '2025-06-19 14:38:12'),
(5, 74, '[\"9\",\"7\",\"2\"]', 'Rocky Branch', 'rocky-branch', 'Family-owned, full-service commercial contracting company with over 30 years of experience.', 'Jody Williams', NULL, NULL, NULL, 'https://rockybranchcontractors.com/', '(434) 372-0552', NULL, '20250619194133.png', NULL, 'approved', NULL, '2025-06-19 14:41:33', '2025-06-19 15:06:47'),
(6, 85, '[\"7\",\"3\",\"2\"]', 'Top Gun', 'top-gun', 'A small, woman-owned business that provides a full range of seeding and erosion control services.', 'Mitch Biggs', NULL, NULL, NULL, 'https://topgunlandscaping.com/', '(434) 636-3320', NULL, '20250619201004.png', NULL, 'approved', NULL, '2025-06-19 15:10:04', '2025-06-19 15:21:03'),
(7, 91, '[\"20\",\"3\",\"2\"]', 'Watkins Nurseries', 'watkins-nurseries', 'Supplying locally grown, native ornamental trees and shrubs, erosion control products, seeding, and green waste recycling services.', 'Robert Watkins', NULL, NULL, NULL, NULL, '(804) 514-1795', NULL, '20250619201904.png', NULL, 'approved', NULL, '2025-06-19 15:19:04', '2025-06-19 15:19:10'),
(8, 5, '[\"3\"]', 'AgriSolar Ranch', 'agrisolar-ranch', 'Providing rotational grazing and mechanical mowing along with other agrivoltaic services.', 'Ryan Romack', NULL, NULL, NULL, 'https://agrisolarranch.com/', '(434) 471-0376', NULL, '20250619202539.png', NULL, 'approved', NULL, '2025-06-19 15:25:40', '2025-06-19 15:25:51'),
(9, 8, '[\"3\"]', 'Anderson Lawn Care', 'anderson-lawn-care', NULL, 'Charles Anderson', NULL, NULL, NULL, 'https://www.charlesandersonlawncare.com/', '(434) 575-5296', NULL, '20250619202846.png', NULL, 'approved', NULL, '2025-06-19 15:28:46', '2025-06-19 15:29:54'),
(10, 11, '[\"13\",\"3\"]', 'Arbor Pro', 'arbor-pro', 'Providing land clearing, grubbing, and logging services.', 'Aaron Miller', NULL, NULL, NULL, 'https://www.msarborpro.com/', '(228) 217-2166', NULL, '20250619203108.png', NULL, 'approved', NULL, '2025-06-19 15:31:08', '2025-06-19 15:32:52'),
(11, 16, '[\"3\"]', 'Capital City', 'capital-city', 'Construction infrastructure services, including hydro excavation, with state-of-the-art equipment.', 'Wayne Norman', NULL, NULL, NULL, 'https://www.capitalcityservices.com/', '(804) 690-9536', NULL, '20250619203821.png', NULL, 'approved', NULL, '2025-06-19 15:38:21', '2025-06-19 15:38:35'),
(12, 1, '[\"3\"]', 'Clowdis Brothers', 'clowdis-brothers', NULL, 'Robert Clowdis', NULL, NULL, NULL, NULL, '(434) 470-0800', NULL, '20250619204632.png', NULL, 'approved', NULL, '2025-06-19 15:46:32', '2025-06-19 15:49:23'),
(13, 37, '[\"16\",\"3\"]', 'Ewe Graze', 'ewe-graze', 'Vegetation management via sheep and mechanical mowing, herbicide application, tree removal and light excavation.', 'John Campbell', 'johncampbell@atlanticbay.com', NULL, NULL, NULL, '(540) 461-2072', NULL, '20250619204917.png', NULL, 'approved', NULL, '2025-06-19 15:49:17', '2025-06-19 15:52:44'),
(14, 39, '[\"3\"]', 'EZ Energy Solutions', 'ez-energy-solutions', 'Family-owned business providing professional mowing and grazing services for solar farms.', 'Matt English', NULL, NULL, NULL, 'https://www.ezenergysolutionsllc.com/', '(434) 907-2689', NULL, '20250619205831.png', NULL, 'approved', NULL, '2025-06-19 15:58:31', '2025-06-19 15:58:48'),
(15, 40, '[\"7\",\"3\"]', 'Finish Line', 'finish-line', 'Providing better water quality for future generations, long term growth and employment opportunities.', 'Frank Pruitt', NULL, NULL, NULL, 'https://www.flcva.com/', '(540) 538-6900', NULL, '20250619210144.png', NULL, 'approved', NULL, '2025-06-19 16:01:44', '2025-06-19 16:04:35'),
(16, 44, '[\"3\"]', 'Goldman Farms', 'goldman-farms', 'Six generation family-owned farm providing produce to local farmers markets.', 'Brick Goldman', NULL, 'https://www.facebook.com/GoldmanFarm/', NULL, NULL, '(434) 542-5202', NULL, '20250619220228.png', NULL, 'approved', NULL, '2025-06-19 17:02:28', '2025-06-19 17:02:39'),
(17, 46, '[\"3\"]', 'Gray’s LAMBscaping', 'grays-lambscaping', 'Vegetation management via sheep and mechanical. Also agricultural plantings, seed mixes, site consultations.', 'Marcus Gray', NULL, NULL, NULL, 'https://grayslambscaping.com/', '(434) 258-4232', NULL, '20250619220429.png', NULL, 'approved', NULL, '2025-06-19 17:04:29', '2025-06-19 17:07:17'),
(18, 60, '[\"3\"]', 'Morton Farm', 'morton-farm', NULL, 'Curtis Morton', NULL, NULL, NULL, NULL, '(434) 470-5691', NULL, '20250619220806.png', NULL, 'approved', NULL, '2025-06-19 17:08:06', '2025-06-19 17:09:56'),
(19, 61, '[\"19\",\"8\",\"3\"]', 'Oak Grove Landscaping', 'oak-grove-landscaping', 'Providing numerous services including landscaping, crane lifts, rigging, hauling, equipment rental, and storage.', 'Anthony Daniel', NULL, NULL, NULL, 'https://www.cranerigcorp.com/', '(434) 865-3528', NULL, '20250619221819.png', NULL, 'approved', NULL, '2025-06-19 17:18:19', '2025-06-19 17:21:59'),
(20, 63, '[\"3\"]', 'Phenix Land', 'phenix-land', 'Specializing in commercial vegetation management including mowing, bush hogging, string trimming.', 'Patrick Andrews', NULL, 'https://www.facebook.com/people/Phenix-Land-Management-LLC/100083527984438/', NULL, NULL, '(434) 391-4956', NULL, '20250619222421.png', NULL, 'approved', NULL, '2025-06-19 17:24:21', '2025-06-19 17:26:03'),
(21, 64, '[\"7\",\"3\"]', 'Piedmont Aerial', 'piedmont-aerial', 'Providing aerial spraying and seeding custom applications.', 'Paul Edmunds', 'piedmontaerialsolutions@gmail.com', NULL, NULL, NULL, '(434) 222-7205', NULL, '20250619223042.png', NULL, 'approved', NULL, '2025-06-19 17:30:42', '2025-06-19 17:34:09'),
(22, 65, '[\"19\",\"9\",\"3\"]', 'Prater Hauling', 'prater-hauling', 'Providing trucking, hauling, excavating, civil works, and landscaping services.', 'Rocky Prater', NULL, 'https://www.facebook.com/people/Phenix-Land-Management-LLC/100083527984438/', NULL, NULL, '(434) 996-2730', NULL, '20250619224824.png', NULL, 'approved', NULL, '2025-06-19 17:48:24', '2025-06-19 17:48:46'),
(23, 67, '[\"9\",\"8\",\"3\"]', 'Rapp Inc.', 'rapp-inc', NULL, 'Charles Payne', NULL, NULL, NULL, NULL, '(434) 547-8617', NULL, '20250619225255.png', NULL, 'approved', NULL, '2025-06-19 17:52:55', '2025-06-19 17:54:50'),
(24, 70, '[\"9\",\"3\"]', 'RDL Environmental', 'rdl-environmental', 'A premier Virginia erosion control contractor, offering hydroseeding, strawblowing, silt fencing, and erosion socks.', 'George Rosser', NULL, 'https://www.facebook.com/people/RDL-Environmental/61555116677780/', NULL, NULL, '(434) 546-6079', NULL, '20250619230527.png', NULL, 'approved', NULL, '2025-06-19 18:05:27', '2025-06-19 18:07:03'),
(25, 71, '[\"13\",\"9\",\"3\"]', 'Red Oak Excavating', 'red-oak-excavating', 'Delivering quality work with state-of-the-art equipment to the community and service area for over 25 years.', 'Lane Gunn', NULL, NULL, NULL, 'https://www.redoakexcavating.com/', '(434) 735-8595', NULL, '20250619231454.png', NULL, 'approved', NULL, '2025-06-19 18:14:54', '2025-06-19 18:16:52'),
(26, 78, '[\"16\",\"11\",\"3\"]', 'Simplicity', 'simplicity', 'Class A building, lawn care, landscaping, and property maintenance contractor. Bonded and insured.', 'Chris Daniel', NULL, NULL, NULL, 'https://www.simplicityhomeandlandscape.com/', '(434) 547-9473', NULL, '20250619235016.png', NULL, 'approved', NULL, '2025-06-19 18:50:16', '2025-06-19 18:52:21'),
(27, 54, '[\"13\",\"8\",\"3\"]', 'Toombs Tree & Lift', 'toombs-tree-lift', 'Providing tree and lift services, land clearing, roll-off container rentals and much more.', 'Kenneth & Austin Toombs', NULL, NULL, NULL, 'https://toombstreeandlift.com/', '(434) 470-8766', NULL, '20250620000041.png', NULL, 'approved', NULL, '2025-06-19 19:00:41', '2025-06-19 19:02:08'),
(28, 51, '[\"8\",\"5\",\"4\"]', 'Hitachi Energy', 'hitachi-energy', 'Providing innovative solutions to customers in the utility, industry,  and infrastructure sectors.', 'Ryland Clark', NULL, NULL, NULL, 'https://www.hitachienergy.com/', '(434) 470-1686', NULL, '20250620000440.png', NULL, 'approved', NULL, '2025-06-19 19:04:40', '2025-06-19 19:05:53'),
(29, 9, '[\"5\"]', 'AES', 'aes', 'Fortune 500 global energy company delivering the greener, smarter energy solutions the world needs.', 'Jason Guarnera', NULL, NULL, NULL, 'https://www.aes.com/', '(804) 441-1285', NULL, '20250620202533.png', NULL, 'approved', NULL, '2025-06-20 15:25:33', '2025-06-20 15:27:11'),
(30, 10, '[\"5\"]', 'Apex Clean Energy', 'apex-clean-energy', NULL, 'Mary-Margaret Hertz', NULL, NULL, NULL, 'https://www.apexcleanenergy.com/', '(434) 282-3230', NULL, '20250620202829.png', NULL, 'approved', NULL, '2025-06-20 15:28:29', '2025-06-20 15:30:21'),
(31, 17, '[\"5\"]', 'CEP Solar', 'cep-solar', 'Partnering with landowners, communities, and customers to develop solar and storage projects across Virginia.', 'Tyson Utt', NULL, NULL, NULL, 'https://www.cepsolar.com/', '(804) 789-4040', NULL, '20250620203626.png', NULL, 'approved', NULL, '2025-06-20 15:36:26', '2025-06-20 15:37:53'),
(32, 26, '[\"5\"]', 'Cypress Creek', 'cypress-creek', 'Developing, financing, owning, and operating utility-scale and distributed solar and energy storage projects across the US.', 'Patrick Harper', NULL, NULL, NULL, 'https://ccrenew.com/', '(804) 762-6838', NULL, '20250620204407.png', NULL, 'approved', NULL, '2025-06-20 15:44:07', '2025-06-20 15:45:51'),
(33, 31, '[\"5\"]', 'Dominion Energy', 'dominion-energy', 'Providing the reliable, affordable, and increasingly clean energy that powers customers every day.', 'Erich Fritz', NULL, NULL, NULL, 'https://www.dominionenergy.com/virginia', '(804) 337-3737', NULL, '20250620205950.png', NULL, 'approved', NULL, '2025-06-20 15:59:50', '2025-06-20 16:01:54'),
(34, 36, '[\"5\"]', 'ESA', 'esa', 'Providing innovative and scalable solutions for solar energy through large-scale solar projects across the United States.', 'Cara Romaine', NULL, NULL, NULL, 'https://esa-solar.com/', '(561) 351-7201', NULL, '20250620210325.png', NULL, 'approved', NULL, '2025-06-20 16:03:25', '2025-06-20 16:04:53'),
(35, 38, '[\"5\"]', 'Exus Renewables', 'exus-renewables', 'Owns, develops, repowers, and manages utility-scale renewable energy projects across the United States.', 'Nadia Durante', NULL, NULL, NULL, 'https://www.exusrenewables.com/north-america', '(412) 523-6864', NULL, '20250620211317.png', NULL, 'approved', NULL, '2025-06-20 16:13:17', '2025-06-20 16:15:35'),
(36, 49, '[\"5\"]', 'Hexagon Energy', 'hexagon-energy', 'Renewable energy developers specializing in Solar and BESS, with strong utility and distributed generation presence.', 'Eric Lord', NULL, NULL, NULL, 'https://hexagon-energy.comm/', '(434) 207-2039', NULL, '20250620211720.png', NULL, 'approved', NULL, '2025-06-20 16:17:20', '2025-06-20 16:18:36'),
(37, 52, '[\"6\",\"5\"]', 'Inovateus Solar', 'inovateus-solar', 'Providing affordable, reliable, and sustainable solar and energy storage solutions.', 'Brennan McKone', NULL, NULL, NULL, 'https://inovateus.com/', '(302) 593-3851', NULL, '20250620211946.png', NULL, 'approved', NULL, '2025-06-20 16:19:46', '2025-06-20 16:21:34'),
(38, 62, '[\"5\"]', 'Palladium Energy', 'palladium-energy', 'Committed to providing sustainable renewable energy across the country for a brighter and cleaner future.', 'Chance Zajicek', NULL, NULL, NULL, 'https://www.pd46energy.com/', '(772) 274-2405', NULL, '20250620212316.png', NULL, 'approved', NULL, '2025-06-20 16:23:16', '2025-06-20 16:24:48'),
(39, 75, '[\"5\"]', 'RWE', 'rwe', 'Developing, constructing, and operating onshore wind, solar, and battery storage facilities.', 'Tory Kaso', NULL, NULL, NULL, 'https://americas.rwe.com/', '(914) 877-0740', NULL, '20250620212548.png', NULL, 'approved', NULL, '2025-06-20 16:25:48', '2025-06-20 16:27:07'),
(40, 80, '[\"5\"]', 'SolUnesco', 'solunesco', 'Creating landowner opportunities through sustainable, cost-competitive energy generation.', 'Francis Hodsoll', NULL, NULL, NULL, 'https://solunesco.com/', '(703) 672-5097', NULL, '20250620212816.png', NULL, 'approved', NULL, '2025-06-20 16:28:16', '2025-06-20 16:29:15'),
(41, 81, '[\"6\",\"5\"]', 'Strata', 'strata', 'Family-owned company focusing on utility-scale clean energy projects.', 'Danielle Walker', NULL, NULL, NULL, 'https://www.stratacleanenergy.com/', '(303) 549-1647', NULL, '20250620213336.png', NULL, 'approved', NULL, '2025-06-20 16:33:36', '2025-06-20 16:34:45'),
(42, 82, '[\"6\",\"5\"]', 'Sun Tribe', 'sun-tribe', 'Clean energy company focusing on utility-scale development, EPC, operations, and maintenance.', 'Seth Herman', NULL, NULL, NULL, 'https://suntribesolar.com/', '(800) 214-4579', NULL, '20250620213621.png', NULL, 'approved', NULL, '2025-06-20 16:36:21', '2025-06-20 16:38:14'),
(43, 83, '[\"5\"]', 'TIC Power', 'tic-power', 'Providing estimating and pre-project planning so clients have certainty in price, schedule, and performance.', 'Cesar Navarro', NULL, NULL, NULL, 'https://www.tic-inc.com/markets/power/', '(970) 819-1631', NULL, '20250620213938.png', NULL, 'approved', NULL, '2025-06-20 16:39:38', '2025-06-20 16:41:17'),
(44, 84, '[\"7\",\"6\",\"5\"]', 'Timmons Group', 'timmons-group', 'Providing full service civil and environmental land development engineering services.', 'Rick Thomas', NULL, NULL, NULL, 'https://www.timmons.com/', '(804) 200-6446', NULL, '20250620214743.svg', NULL, 'approved', NULL, '2025-06-20 16:47:43', '2025-06-20 16:47:49'),
(45, 88, '[\"5\"]', 'Urban Grid', 'urban-grid', 'A leading independent power producer developing high-quality renewable energy projects.', 'Amanda Marple', NULL, NULL, NULL, 'https://www.urbangridsolar.com/', '(304) 707-1053', NULL, '20250620220122.png', NULL, 'approved', NULL, '2025-06-20 17:01:22', '2025-06-20 17:04:10'),
(46, 12, '[\"6\"]', 'Armstrong & Assoc.', 'armstrong-assoc', 'Providing boundary and topographic land surveying, in addition to construction stakeout.', 'Richard Armstrong', NULL, NULL, NULL, 'http://www.armstrongandassociates.net/', '(434) 656-1051', NULL, '20250620221551.png', NULL, 'approved', NULL, '2025-06-20 17:15:51', '2025-06-20 17:23:24'),
(47, 24, '[\"6\"]', 'CPV', 'cpv', 'A leading North American electric power generation development and asset management company.', 'Marlon dos Santos', NULL, NULL, NULL, 'https://www.cpv.com/', '(617) 347-7211', NULL, '20250620222440.png', NULL, 'approved', NULL, '2025-06-20 17:24:40', '2025-06-20 17:26:30'),
(48, 28, '[\"6\"]', 'DEPCOM Power', 'depcom-power', 'A leading energy solutions partner for the utility solar and broader energy industries.', 'Joshua Barkley', NULL, NULL, NULL, 'https://www.depcompower.com/', '(480) 390-5662', NULL, '20250620223903.svg', NULL, 'approved', NULL, '2025-06-20 17:39:03', '2025-06-20 17:39:08'),
(49, 32, '[\"12\",\"6\"]', 'DSB IT', 'dsb-it', 'Providing full turnkey services, designing and constructing fiber optic infrastructure.', 'John Elliot', NULL, NULL, NULL, 'https://dsbitfiber.com/', '(336) 383-0564', NULL, '20250620224121.png', NULL, 'approved', NULL, '2025-06-20 17:41:21', '2025-06-20 17:41:27'),
(50, 55, '[\"6\"]', 'Kiewit Corp.', 'kiewit-corp', NULL, 'Jacob Metzger', NULL, NULL, NULL, 'https://www.kiewit.com/', '(913) 515-4322', NULL, '20250620224318.png', NULL, 'approved', NULL, '2025-06-20 17:43:18', '2025-06-20 17:43:23'),
(51, 33, '[\"16\",\"14\",\"7\"]', 'ECS', 'ecs', 'A leading construction supply company, serving Contractors, Sub-Contractors and Engineers.', 'Joe Belmonte', NULL, NULL, NULL, 'https://ecsproductsva.com/', '(434) 872-1059', NULL, '20250620225930.png', NULL, 'approved', NULL, '2025-06-20 17:59:30', '2025-06-20 18:00:43'),
(52, 92, '[\"7\"]', 'Wetland', 'wetland', 'Providing environmental and cultural resource consulting in the Mid-Atlantic region.', 'Tucker Hudgins', NULL, NULL, NULL, 'https://www.wetlands.com/', '(804) 955-5213', NULL, '20250620230633.png', NULL, 'approved', NULL, '2025-06-20 18:06:33', '2025-06-20 18:07:32'),
(53, 15, '[\"8\"]', 'Carter Machinery', 'carter-machinery', NULL, 'Hayden Dice', NULL, NULL, NULL, 'https://www.cartermachinery.com/rent/', '(434) 821-6928', NULL, '20250620231553.png', NULL, 'approved', NULL, '2025-06-20 18:15:53', '2025-06-20 18:15:59'),
(54, 25, '[\"19\",\"11\",\"8\"]', 'CRC Crane Rigging', 'crc-crane-rigging', 'Providing services including crane rentals, bare crane rentals, industrial rigging, and heavy hauling.', 'George Tanner', NULL, NULL, NULL, 'https://www.cranerigcorp.com/', '(800) 642-5145', NULL, '20250620235105.avif', NULL, 'approved', NULL, '2025-06-20 18:51:05', '2025-06-20 18:51:14'),
(55, 50, '[\"8\"]', 'Hills Machinery', 'hills-machinery', 'A dedicated group of heavy equipment professionals ensure quality performance, parts, and customer service.', 'Travis Wyndham', NULL, NULL, NULL, 'https://www.hillsmachinery.com/', '(240) 440-4843', NULL, '20250620235347.png', NULL, 'approved', NULL, '2025-06-20 18:53:47', '2025-06-20 18:54:27'),
(56, 76, '[\"20\",\"16\",\"8\"]', 'Scotty\'s Sanitation', 'scottys-sanitation', 'Rental of Porta-Johns, handwash stations, holding and septic tank services.', 'Scott Pearce', NULL, 'https://www.facebook.com/people/Scottys-septic-tank-service-llc/100048536786916/', NULL, NULL, '(434) 222-9060', NULL, '20250623152817.png', NULL, 'approved', NULL, '2025-06-23 10:28:17', '2025-06-23 10:28:22'),
(57, 86, '[\"8\"]', 'United Rentals', 'united-rentals', 'Featuring equipment rentals, sales, safety training, maintenance, trench safety, and more.', 'Allyson Schwind Dowdy', NULL, NULL, NULL, 'https://www.unitedrentals.com/', '(540) 267-6232', NULL, '20250623153022.png', NULL, 'approved', NULL, '2025-06-23 10:30:22', '2025-06-23 10:30:28'),
(58, 89, '[\"8\"]', 'Vermeer All Roads', 'vermeer-all-roads', NULL, 'Russell Kenny', NULL, NULL, NULL, 'https://www.vermeerallroads.com/', '(844) 837-6337', NULL, '20250623153138.png', NULL, 'approved', NULL, '2025-06-23 10:31:38', '2025-06-23 10:32:27'),
(59, 2, '[\"9\"]', '360 Excavating', '360-excavating', 'Underground utilities, grading, hauling, septic systems, and rental equipment.', 'Jason Forlines', NULL, 'https://www.facebook.com/360EquipmentRentals', NULL, NULL, '(434) 470-7373', NULL, '20250623153655.png', NULL, 'approved', NULL, '2025-06-23 10:36:55', '2025-06-23 10:37:00'),
(60, 14, '[\"9\"]', 'BCC Excavating Inc.', 'bcc-excavating-inc', NULL, 'Mike Tharpe', NULL, 'https://www.facebook.com/people/CM-Land-Worx-LLC/100063809302360/', NULL, NULL, '(434) 391-4711', NULL, '20250623153856.png', NULL, 'approved', NULL, '2025-06-23 10:38:56', '2025-06-23 10:39:01'),
(61, 21, '[\"9\"]', 'CU LLC', 'cu-llc', 'Family owned and operated, commercial and residential utility installation.', 'Timothy Fortson', NULL, NULL, NULL, 'https://www.completeunderground.com/', '(804) 512-4783', NULL, '20250623154009.png', NULL, 'approved', NULL, '2025-06-23 10:40:09', '2025-06-23 10:40:49'),
(62, 42, '[\"19\",\"13\",\"9\"]', 'Francis Excavating', 'francis-excavating', NULL, 'Logan Francis', 'francisexcavating@hotmail.com', NULL, NULL, NULL, '(434) 470-5507', NULL, '20250623154153.png', NULL, 'approved', NULL, '2025-06-23 10:41:53', '2025-06-23 10:42:49'),
(63, 56, '[\"9\"]', 'KWest Group', 'kwest-group', 'Award-winning civil construction and environmental services company.', 'Chris McNary', NULL, NULL, NULL, 'https://kwestgroup.com/', '(614) 813-9722', NULL, '20250623154442.png', NULL, 'approved', NULL, '2025-06-23 10:44:42', '2025-06-23 10:44:47'),
(64, 73, '[\"11\",\"9\"]', 'RF Howerton Inc.', 'rf-howerton-inc', 'Providing services including excavation, building construction, and roofing.', 'Cheryl Howerton', NULL, 'https://www.facebook.com/RFHINC/', NULL, 'https://cranerigcorp.com/', '(434) 262-2238', NULL, '20250623155149.png', NULL, 'approved', NULL, '2025-06-23 10:51:49', '2025-06-23 10:53:03'),
(65, 79, '[\"19\",\"13\",\"9\"]', 'Smiley\'s Construction', 'smileys-construction', 'Providing services including excavating, grading, clearing, hauling, erosion control, and pouring concrete.', 'Jamie Smiley', NULL, 'https://www.facebook.com/Smileys.Lets.Dig', NULL, NULL, '(434) 689-2344', NULL, '20250623155639.png', NULL, 'approved', NULL, '2025-06-23 10:56:39', '2025-06-23 10:56:45'),
(66, 90, '[\"9\"]', 'Virginia Carolina', 'virginia-carolina', 'Class A Contractor performing earthwork, storm drain system installation, utilities, and concrete work.', 'Kurt Mason', 'kmason@vcpaving.com', NULL, NULL, NULL, '(434) 572-8460', NULL, '20250623165019.png', NULL, 'approved', NULL, '2025-06-23 11:50:19', '2025-06-23 11:50:25'),
(67, 58, '[\"10\"]', 'Microtel', 'microtel', 'Enjoy ample amenities and friendly 24/7 service at this contemporary, pet-friendly hotel by Wyndham South Hill.', 'Michelle Warner', NULL, NULL, NULL, 'https://www.wyndhamhotels.com/microtel/south-hill-virginia/microtel-south-hill/overview', '(434) 447-3461', NULL, '20250623170004.svg', NULL, 'approved', NULL, '2025-06-23 12:00:04', '2025-06-23 12:00:20'),
(68, 34, '[\"12\"]', 'EMPOWER', 'empower', 'Providing middle-mile capacity, retail high-speed internet service, VOIP, and high-speed data services.', 'David Lipscomb', NULL, NULL, NULL, 'https://www.empowermec.net/', '(434) 372-6200', NULL, '20250623170322.svg', NULL, 'approved', NULL, '2025-06-23 12:03:22', '2025-06-23 12:03:27'),
(69, 53, '[\"12\"]', 'Intelliverse', 'intelliverse', 'Providing strategic planning vision and expertise, and modern strategic information technology solutions.', 'Daryll Toomer', NULL, NULL, NULL, 'https://intelliversesolutions.com/', '(434) 222-9259', NULL, '20250623170449.png', NULL, 'approved', NULL, '2025-06-23 12:04:49', '2025-06-23 12:05:15'),
(70, 59, '[\"12\"]', 'Mid-Atlantic Broadband', 'mid-atlantic-broadband', 'Committed to driving technological advancement and the socioeconomic progress of Southern VA.', 'Lauren Mathena', NULL, NULL, NULL, 'https://mbc-va.com/', '(434) 250-1749', NULL, '20250623170611.png', NULL, 'approved', NULL, '2025-06-23 12:06:11', '2025-06-23 12:06:47'),
(71, 72, '[\"16\",\"12\"]', 'RiverStreet Networks', 'riverstreet-networks', 'Providing customers and member-owners with the latest technological advancements and services.', 'Marnita Harris', NULL, NULL, NULL, 'https://myriverstreet.net/', '(336) 973-7120', NULL, '20250623170747.png', NULL, 'approved', NULL, '2025-06-23 12:07:47', '2025-06-23 12:08:27'),
(72, 94, '[\"12\"]', 'Zachary McKinney Technology', 'zachary-mckinney-technology', 'Providing fast, reliable and expert technology assistance to business and individuals alike.', 'Zachary McKinney', NULL, NULL, NULL, 'https://tech.zackmckinney.com/', '(434) 321-8558', NULL, '20250623170928.png', NULL, 'approved', NULL, '2025-06-23 12:09:28', '2025-06-23 12:10:01'),
(73, 30, '[\"13\"]', 'Devin Land & Timber', 'devin-land-timber', NULL, 'JA Devin', NULL, NULL, NULL, NULL, '(434) 470-0188', NULL, '20250623171129.png', NULL, 'approved', NULL, '2025-06-23 12:11:29', '2025-06-23 12:11:36'),
(74, 47, '[\"13\"]', 'H&M Logging', 'hm-logging', 'Providing logging and buying and clearing timber services.', 'Kenneth Hodges', NULL, 'https://www.facebook.com/people/HM-Logging/100063668192307/', NULL, NULL, '(434) 579-4302', NULL, '20250623171417.png', NULL, 'approved', NULL, '2025-06-23 12:14:17', '2025-06-23 12:15:18'),
(75, 4, '[\"20\",\"19\",\"14\"]', 'AJ Transport', 'aj-transport', 'A diversified transportation company with many services and sources.', 'Mason Day', NULL, NULL, NULL, 'https://ajtransportservices.com/', '(434) 572-2477', NULL, '20250623171723.webp', NULL, 'approved', NULL, '2025-06-23 12:17:23', '2025-06-23 12:17:29'),
(76, 20, '[\"14\"]', 'Cove Property', 'cove-property', 'Selling screened or unscreened top soil and sand, fill dirt and wheat straw.', 'Harold Duffey', 'drburnett@gcronline.com', NULL, NULL, NULL, '(434) 470-2214', NULL, '20250623171937.png', NULL, 'approved', NULL, '2025-06-23 12:19:37', '2025-06-23 12:19:44'),
(77, 35, '[\"15\"]', 'Energy Right', 'energy-right', 'Dedicated to educating Virginia localities and their residents on the best practices for solar development.', 'Blake Cox', NULL, NULL, NULL, 'https://www.energyrightva.com/', '(804) 223-0125', NULL, '20250623172100.png', NULL, 'approved', NULL, '2025-06-23 12:21:00', '2025-06-23 12:21:24'),
(78, 6, '[\"16\"]', 'AmeriStaff', 'ameristaff', 'Providing staffing support for temporary projects, contract-to-perm positions, and direct hire positions.', 'Greg Conner', NULL, NULL, NULL, 'https://www.ameristaff.com/', '(276) 734-3263', NULL, '20250623172245.png', NULL, 'approved', NULL, '2025-06-23 12:22:45', '2025-06-23 12:23:05'),
(79, 7, '[\"16\"]', 'Ampliform', 'ampliform', 'Managing utility-scale solar and solar+energy storage facilities from origination through operation.', 'Michelle Spruth', NULL, NULL, NULL, 'https://www.ampliform.com/', '(847) 373-2727', NULL, '20250623173306.png', NULL, 'approved', NULL, '2025-06-23 12:33:06', '2025-06-23 12:35:34'),
(80, 41, '[\"16\"]', 'Foster Fuels', 'foster-fuels', 'Providing residential and commercial fuel services, including propane, diesel fuel, heating oil, and more.', 'Darrell St. John', NULL, NULL, NULL, 'https://fosterfuels.com/', '(434) 376-2322', NULL, '20250623173649.png', NULL, 'approved', NULL, '2025-06-23 12:36:49', '2025-06-23 12:37:07'),
(81, 43, '[\"16\"]', 'Gentry Locke', 'gentry-locke', 'Dedicated to helping companies and individuals meet their legal and business needs.', 'Kathleen Lordan', NULL, NULL, NULL, 'https://www.gentrylocke.com/', '(866) 983-0866', NULL, '20250623173828.png', NULL, 'approved', NULL, '2025-06-23 12:38:28', '2025-06-23 12:38:34'),
(82, 45, '[\"16\"]', 'Grand Springs', 'grand-springs', 'Bottled water services, including five gallon water with cooler rentals and small pack single serve packages.', 'Robert Smith', NULL, NULL, NULL, 'https://grandsprings.com/', '(434) 753-2515', NULL, '20250623173936.png', NULL, 'approved', NULL, '2025-06-23 12:39:36', '2025-06-23 12:39:56'),
(83, 48, '[\"16\"]', 'Hawthorne Law', 'hawthorne-law', 'Providing effective, competent legal representation centered around your goals.', 'Robert Hawthorne', NULL, NULL, NULL, 'https://www.hawthorne.law/', '(434) 292-7676', NULL, '20250623174102.png', NULL, 'approved', NULL, '2025-06-23 12:41:02', '2025-06-23 12:41:35'),
(84, 1, '[\"16\"]', 'Melissa M Hill', 'melissa-m-hill', NULL, 'Melissa Hill', 'mmhillphotography@gmail.com', NULL, NULL, NULL, '(434) 381-0469', NULL, '20250623174248.png', NULL, 'approved', NULL, '2025-06-23 12:42:48', '2025-06-23 12:43:16'),
(85, 69, '[\"16\"]', 'Reaves Trophy', 'reaves-trophy', NULL, 'Jimmy Reaves', NULL, 'https://www.facebook.com/p/Reaves-Trophy-Shop-100063679745294/', NULL, NULL, '(434) 572-6886', NULL, '20250623175231.png', NULL, 'approved', NULL, '2025-06-23 12:52:31', '2025-06-23 12:53:10'),
(86, 77, '[\"16\"]', 'SHINE', 'shine', 'The Solar Hands-On Instructional Network of Excellence, part of the educational and vocational arm of the SCVBA.', 'David Peterson', NULL, NULL, NULL, 'https://www.shine.energy/', NULL, NULL, '20250623175532.png', NULL, 'approved', NULL, '2025-06-23 12:55:32', '2025-06-23 12:56:44'),
(87, 93, '[\"16\"]', 'Wholesale Auto Parts', 'wholesale-auto-parts', NULL, 'Monty Hightower', NULL, NULL, NULL, NULL, '(434) 210-1650', NULL, '20250623175829.png', NULL, 'approved', NULL, '2025-06-23 12:58:29', '2025-06-23 12:58:36'),
(88, 13, '[\"17\"]', 'Austin Excavating', 'austin-excavating', 'Providing buying and selling of land and timber.', 'Eddie Austin', 'eddie.austin6676@gmail.com', NULL, NULL, NULL, '(434) 841-9904', NULL, '20250623180009.png', NULL, 'approved', NULL, '2025-06-23 13:00:09', '2025-06-23 13:00:26'),
(89, 22, '[\"17\"]', 'CBRE', 'cbre', 'A global leader in commercial real estate services and investments.', 'Andrew Ferguson', NULL, NULL, NULL, 'https://www.cbre.com/', '(804) 909-3937', NULL, '20250623180133.png', NULL, 'approved', NULL, '2025-06-23 13:01:33', '2025-06-23 13:01:49'),
(90, 27, '[\"17\"]', 'Dan River Siteworks', 'dan-river-siteworks', 'Providing industrial storage with subdivided blocks available under flexible lease terms.', 'Foster Xiradis', NULL, NULL, NULL, 'https://www.danriversiteworks.com/', '(804) 201-9445', NULL, '20250623180254.png', NULL, 'approved', NULL, '2025-06-23 13:02:54', '2025-06-23 13:03:08'),
(91, 66, '[\"17\"]', 'Properties of Virginia', 'properties-of-virginia', 'Land, farms, country homes, and timber investments throughout the Commonwealth of Virginia.', 'Sandra Towne', NULL, NULL, NULL, 'https://www.propertiesofva.com/', '(434) 729-3900', NULL, '20250623180438.png', NULL, 'approved', NULL, '2025-06-23 13:04:38', '2025-06-23 13:04:49'),
(92, 57, '[\"19\"]', 'James & Company', 'james-company', 'Bulk hauling of sand, stone, fill dirt, agricultural products. Hourly on-site hauling and tailgate spreading.', 'Danielle Ferrell', NULL, NULL, NULL, 'https://jamesandco.biz/', '(434) 563-1122', NULL, '20250623180645.webp', NULL, 'approved', NULL, '2025-06-23 13:06:45', '2025-06-23 13:06:50'),
(93, 54, '[\"20\"]', 'Kcan Disposal', 'kcan-disposal', NULL, 'Austin & Kenneth Toombs', NULL, NULL, NULL, 'https://kcandisposal.com/', '(434) 470-8766', NULL, '20250623180811.png', NULL, 'approved', NULL, '2025-06-23 13:08:11', '2025-06-23 13:08:17'),
(94, 87, '[\"20\"]', 'United Site Services', 'united-site-services', 'Providing portable restroom, roll off dumpster, and temporary fence services.', 'Joe Dargin', NULL, NULL, NULL, 'https://www.unitedsiteservices.com/', '(757) 582-7407', NULL, '20250623180918.png', NULL, 'approved', NULL, '2025-06-23 13:09:18', '2025-06-23 13:09:23');

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_04_06_183800_create_permission_tables', 1),
(13, '2022_04_19_205847_create_vehicles_table', 6),
(14, '2022_03_09_150353_create_categories_table', 7),
(18, '2022_04_25_174651_create_r_v_s_table', 10),
(19, '2022_04_25_211456_create_virtual_tours_table', 11),
(23, '2022_04_27_183505_create_about_us_table', 13),
(24, '2022_04_27_220336_create_car_rents_table', 14),
(25, '2022_04_27_220336_create_steps_of_rent_table', 15),
(26, '2022_02_03_080357_create_settings_table', 16),
(27, '2022_05_04_171218_create_news_letters_table', 17),
(29, '2022_05_09_174141_create_cetagories_table', 19),
(32, '2022_03_09_150353_create_blogcategories_table', 21),
(36, '2022_04_26_181343_create_galleries_table', 24),
(40, '2022_05_11_213649_create_deals_table', 25),
(45, '2022_03_14_084656_create_pages_table', 30),
(46, '2022_03_14_143426_create_page_settings_table', 31),
(49, '2022_05_17_200135_create_products_table', 34),
(50, '2022_05_17_200819_create_product_details_table', 35),
(52, '2022_05_17_201443_create_product_images_table', 36),
(55, '2022_05_09_174141_create_car_types_table', 39),
(56, '2022_04_27_220336_create_how_to_rents_table', 40),
(57, '2022_05_18_192740_create_cities_table', 41),
(58, '2022_05_18_193028_create_states_table', 42),
(61, '2022_05_17_184901_create_bookings_table', 44),
(63, '2022_05_18_194530_create_pick_drop_locations_table', 46),
(66, '2022_05_16_180452_create_payments_table', 47),
(67, '2022_05_23_172759_create_payment_details_table', 48),
(70, '2022_04_20_195848_create_properties_table', 50),
(72, '2022_08_02_154123_create_properties_details_table', 52),
(79, '2022_07_30_003954_create_agents_table', 54),
(80, '2014_10_12_000000_create_users_table', 55),
(82, '2022_08_12_164939_create_properties_areas_table', 56),
(84, '2022_05_18_190010_create_contacts_table', 57),
(85, '2022_08_22_183555_create_client_contacts_table', 58),
(87, '2024_07_09_160257_create_plumbings_table', 60),
(89, '2024_07_25_212503_create_kitchens_table', 61),
(90, '2024_07_26_160908_create_gardenings_table', 62),
(91, '2024_07_26_180728_create_carpets_table', 63),
(92, '2024_07_26_205000_create_gutters_table', 64),
(93, '2024_07_26_214851_create_pests_table', 65),
(94, '2024_07_26_222358_create_roofings_table', 66),
(95, '2024_07_27_001557_create_concretes_table', 67),
(96, '2024_07_30_183805_create_heatings_table', 68),
(97, '2024_07_30_181714_create_constructions_table', 69),
(100, '2024_08_01_173433_create_electronics_table', 70),
(102, '2024_08_03_000021_create_windows_table', 71),
(103, '2024_09_18_170302_create_advertisments_table', 72),
(104, '2024_09_18_173803_create_advertisements_table', 73),
(110, '2024_12_13_151232_create_all_games_table', 74),
(111, '2022_10_06_161808_create_home_sliders_table', 75),
(112, '2024_12_20_172021_create_our_sponsors_table', 76),
(113, '2022_06_10_230308_create_our_locations_table', 77),
(116, '2024_12_24_202323_create_daily_activities_table', 80),
(121, '2024_12_24_201117_create_bonus_activities_table', 83),
(128, '2024_12_24_203901_create_daily_points_table', 85),
(129, '2024_12_24_204257_create_bonus_points_table', 86),
(130, '2025_02_06_215010_create_project_categories_table', 87),
(141, '2025_02_13_225137_create_document_repositories_table', 91),
(147, '2025_03_19_175531_create_job_posts_table', 93),
(148, '2025_05_08_205233_create_job_post_categories_table', 94),
(152, '2025_02_06_221213_create_projects_table', 95),
(153, '2025_05_24_002514_create_notifications_table', 96),
(157, '2025_02_18_190244_create_member_directories_table', 97),
(159, '2025_06_09_213413_create_teams_table', 98),
(162, '2025_06_18_212015_create_events_table', 99),
(164, '2022_02_03_082236_create_testimonials_table', 101),
(165, '2022_05_09_174141_create_categories_table', 102),
(167, '2022_05_18_190058_create_contact_us_table', 103),
(169, '2025_07_01_182412_create_trainers_table', 104),
(171, '2022_03_09_150337_create_blogs_table', 106),
(172, '2022_05_09_190227_blog_categories', 107),
(175, '2022_05_18_203240_create_appointments_table', 108),
(176, '2025_12_09_204500_add_google_calendar_id_to_trainers_table', 109),
(177, '2025_12_10_000001_create_availabilities_table', 110),
(178, '2025_12_10_000002_create_time_slots_table', 111),
(179, '2025_12_10_000003_create_bookings_table', 112),
(180, '2025_12_10_000004_create_booking_reschedules_table', 113),
(181, '2025_12_10_000005_create_trainer_google_accounts_table', 113),
(182, '2025_12_10_000006_create_blocked_slots_table', 113),
(183, '2025_12_10_000007_create_trainer_pricing_table', 113),
(184, '2025_12_12_221316_remove_duplicate_columns_from_trainers_table', 114),
(185, '2025_12_12_224450_add_phone_to_appointments_table', 115),
(186, '2025_12_12_224452_add_phone_to_bookings_table', 115);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 19),
(2, 'App\\Models\\User', 4),
(2, 'App\\Models\\User', 7),
(2, 'App\\Models\\User', 14),
(2, 'App\\Models\\User', 16),
(2, 'App\\Models\\User', 20),
(2, 'App\\Models\\User', 21),
(2, 'App\\Models\\User', 22),
(2, 'App\\Models\\User', 27),
(2, 'App\\Models\\User', 28),
(2, 'App\\Models\\User', 29),
(2, 'App\\Models\\User', 30),
(2, 'App\\Models\\User', 31),
(2, 'App\\Models\\User', 32),
(2, 'App\\Models\\User', 34),
(2, 'App\\Models\\User', 35),
(2, 'App\\Models\\User', 36),
(2, 'App\\Models\\User', 39),
(2, 'App\\Models\\User', 40),
(2, 'App\\Models\\User', 45),
(2, 'App\\Models\\User', 46),
(2, 'App\\Models\\User', 47),
(2, 'App\\Models\\User', 48),
(2, 'App\\Models\\User', 49),
(2, 'App\\Models\\User', 55),
(2, 'App\\Models\\User', 56),
(2, 'App\\Models\\User', 57),
(2, 'App\\Models\\User', 58),
(2, 'App\\Models\\User', 63),
(2, 'App\\Models\\User', 65),
(2, 'App\\Models\\User', 70),
(2, 'App\\Models\\User', 72),
(2, 'App\\Models\\User', 75),
(5, 'App\\Models\\User', 2),
(5, 'App\\Models\\User', 3),
(5, 'App\\Models\\User', 4),
(5, 'App\\Models\\User', 5),
(5, 'App\\Models\\User', 6),
(5, 'App\\Models\\User', 7),
(5, 'App\\Models\\User', 8),
(5, 'App\\Models\\User', 9),
(5, 'App\\Models\\User', 10),
(5, 'App\\Models\\User', 11),
(5, 'App\\Models\\User', 12),
(5, 'App\\Models\\User', 13),
(5, 'App\\Models\\User', 14),
(5, 'App\\Models\\User', 15),
(5, 'App\\Models\\User', 16),
(5, 'App\\Models\\User', 17),
(5, 'App\\Models\\User', 18),
(5, 'App\\Models\\User', 19),
(5, 'App\\Models\\User', 20),
(5, 'App\\Models\\User', 21),
(5, 'App\\Models\\User', 22),
(5, 'App\\Models\\User', 23),
(5, 'App\\Models\\User', 24),
(5, 'App\\Models\\User', 25),
(5, 'App\\Models\\User', 26),
(5, 'App\\Models\\User', 27),
(5, 'App\\Models\\User', 28),
(5, 'App\\Models\\User', 29),
(5, 'App\\Models\\User', 30),
(5, 'App\\Models\\User', 31),
(5, 'App\\Models\\User', 32),
(5, 'App\\Models\\User', 33),
(5, 'App\\Models\\User', 34),
(5, 'App\\Models\\User', 35),
(5, 'App\\Models\\User', 36),
(5, 'App\\Models\\User', 37),
(5, 'App\\Models\\User', 38),
(5, 'App\\Models\\User', 39),
(5, 'App\\Models\\User', 40),
(5, 'App\\Models\\User', 41),
(5, 'App\\Models\\User', 42),
(5, 'App\\Models\\User', 43),
(5, 'App\\Models\\User', 44),
(5, 'App\\Models\\User', 45),
(5, 'App\\Models\\User', 46),
(5, 'App\\Models\\User', 47),
(5, 'App\\Models\\User', 48),
(5, 'App\\Models\\User', 49),
(5, 'App\\Models\\User', 50),
(5, 'App\\Models\\User', 51),
(5, 'App\\Models\\User', 52),
(5, 'App\\Models\\User', 53),
(5, 'App\\Models\\User', 54),
(5, 'App\\Models\\User', 55),
(5, 'App\\Models\\User', 56),
(5, 'App\\Models\\User', 57),
(5, 'App\\Models\\User', 58),
(5, 'App\\Models\\User', 59),
(5, 'App\\Models\\User', 60),
(5, 'App\\Models\\User', 61),
(5, 'App\\Models\\User', 62),
(5, 'App\\Models\\User', 63),
(5, 'App\\Models\\User', 64),
(5, 'App\\Models\\User', 65),
(5, 'App\\Models\\User', 66),
(5, 'App\\Models\\User', 67),
(5, 'App\\Models\\User', 68),
(5, 'App\\Models\\User', 69),
(5, 'App\\Models\\User', 70),
(5, 'App\\Models\\User', 71),
(5, 'App\\Models\\User', 72),
(5, 'App\\Models\\User', 73),
(5, 'App\\Models\\User', 74),
(5, 'App\\Models\\User', 75),
(5, 'App\\Models\\User', 76),
(5, 'App\\Models\\User', 77),
(5, 'App\\Models\\User', 78),
(5, 'App\\Models\\User', 79),
(5, 'App\\Models\\User', 80),
(5, 'App\\Models\\User', 81),
(5, 'App\\Models\\User', 82),
(5, 'App\\Models\\User', 83),
(5, 'App\\Models\\User', 84),
(5, 'App\\Models\\User', 85),
(5, 'App\\Models\\User', 86),
(5, 'App\\Models\\User', 87),
(5, 'App\\Models\\User', 88),
(5, 'App\\Models\\User', 89),
(5, 'App\\Models\\User', 90),
(5, 'App\\Models\\User', 91),
(5, 'App\\Models\\User', 92),
(5, 'App\\Models\\User', 93),
(5, 'App\\Models\\User', 94),
(5, 'App\\Models\\User', 98),
(5, 'App\\Models\\User', 99),
(5, 'App\\Models\\User', 100),
(5, 'App\\Models\\User', 101),
(5, 'App\\Models\\User', 102),
(5, 'App\\Models\\User', 103),
(5, 'App\\Models\\User', 104),
(5, 'App\\Models\\User', 105),
(5, 'App\\Models\\User', 106),
(5, 'App\\Models\\User', 107);

-- --------------------------------------------------------

--
-- Table structure for table `news_letters`
--

CREATE TABLE `news_letters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1' COMMENT '0=inactive , 1=active',
  `deleted_at` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news_letters`
--

INSERT INTO `news_letters` (`id`, `name`, `email`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, NULL, 'lenik@mailinator.com', '1', NULL, '2022-08-03 11:09:06', '2022-08-03 11:09:06'),
(2, NULL, 'zelupabin@mailinator.com', '1', NULL, '2022-08-05 13:37:53', '2022-08-05 13:37:53'),
(3, NULL, 'asjadmmc67@gmail.com', '1', '2024-06-24 22:21:46', '2024-06-24 12:57:19', '2024-06-24 17:21:46'),
(4, NULL, 'admin@gmail.com', '1', NULL, '2024-06-24 13:03:34', '2024-06-24 13:03:34'),
(5, NULL, 'raja.mmc2@gmail.com', '1', '2024-06-24 22:21:52', '2024-06-24 13:06:08', '2024-06-24 17:21:52'),
(6, NULL, 'john@gmail.com', '1', NULL, '2024-06-24 13:10:41', '2024-06-24 13:10:41'),
(7, NULL, 'john@gmail.com', '1', NULL, '2024-06-24 18:23:29', '2024-06-24 18:23:29'),
(8, NULL, 'contractor@gmail.com', '1', NULL, '2024-06-28 19:26:22', '2024-06-28 19:26:22'),
(9, NULL, 'tetucikog@mailinator.com', '1', NULL, '2024-12-20 15:08:59', '2024-12-20 15:08:59'),
(10, NULL, 'mynegy@mailinator.com', '1', NULL, '2024-12-20 15:17:39', '2024-12-20 15:17:39');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('18a73203-8e92-494e-b532-5a40c9cde11d', 'App\\Notifications\\AppointmentBookedNotification', 'App\\Models\\User', 1, '{\"type\":\"appointment_booked\",\"appointment_id\":11,\"trainer_name\":\"Sarah Johnson \",\"appointment_date\":\"2026-01-26\",\"appointment_time\":\"22:00\",\"status\":\"pending\",\"message\":\"Your appointment with Sarah Johnson  has been booked successfully!\"}', NULL, '2025-12-12 17:58:12', '2025-12-12 17:58:12'),
('1a7a88d0-b922-4df4-a3e6-79e978be5b6c', 'App\\Notifications\\AppointmentBookedNotification', 'App\\Models\\User', 19, '{\"type\":\"appointment_booked\",\"appointment_id\":11,\"trainer_name\":\"Sarah Johnson \",\"appointment_date\":\"2026-01-26\",\"appointment_time\":\"22:00\",\"status\":\"pending\",\"message\":\"Your appointment with Sarah Johnson  has been booked successfully!\"}', NULL, '2025-12-12 17:58:12', '2025-12-12 17:58:12'),
('3c4a75b2-d1b6-4960-99d4-3d7467b5db35', 'App\\Notifications\\AppointmentBookedNotification', 'App\\Models\\User', 1, '{\"type\":\"appointment_booked\",\"appointment_id\":3,\"trainer_name\":\"Amelia Rose\",\"appointment_date\":\"2025-12-10\",\"appointment_time\":\"12:00\",\"status\":\"pending\",\"message\":\"Your appointment with Amelia Rose has been booked successfully!\"}', NULL, '2025-12-09 10:37:34', '2025-12-09 10:37:34'),
('5c25263a-57ef-48ab-97a9-8fe5ef230559', 'App\\Notifications\\AppointmentBookedNotification', 'App\\Models\\User', 1, '{\"type\":\"appointment_booked\",\"appointment_id\":9,\"trainer_name\":\"Sarah Johnson\",\"appointment_date\":\"2025-12-15\",\"appointment_time\":\"20:00\",\"status\":\"pending\",\"message\":\"Your appointment with Sarah Johnson has been booked successfully!\"}', NULL, '2025-12-12 10:50:59', '2025-12-12 10:50:59'),
('791ebde2-8b52-48f3-a1a2-ab865a1fe686', 'App\\Notifications\\AppointmentBookedNotification', 'App\\Models\\User', 19, '{\"type\":\"appointment_booked\",\"appointment_id\":4,\"trainer_name\":\"Amelia Rose\",\"appointment_date\":\"2025-12-11\",\"appointment_time\":\"14:30\",\"status\":\"pending\",\"message\":\"Your appointment with Amelia Rose has been booked successfully!\"}', NULL, '2025-12-09 17:55:43', '2025-12-09 17:55:43'),
('8f054232-4dba-4ae1-99fc-5d97dc4451f1', 'App\\Notifications\\AppointmentBookedNotification', 'App\\Models\\User', 1, '{\"type\":\"appointment_booked\",\"appointment_id\":7,\"trainer_name\":\"John Smith\",\"appointment_date\":\"2025-12-30\",\"appointment_time\":\"13:30\",\"status\":\"pending\",\"message\":\"Your appointment with John Smith has been booked successfully!\"}', NULL, '2025-12-10 14:48:47', '2025-12-10 14:48:47'),
('940ffa74-71cc-4ee7-937d-75c96535a1ad', 'App\\Notifications\\AppointmentBookedNotification', 'App\\Models\\User', 19, '{\"type\":\"appointment_booked\",\"appointment_id\":7,\"trainer_name\":\"John Smith\",\"appointment_date\":\"2025-12-30\",\"appointment_time\":\"13:30\",\"status\":\"pending\",\"message\":\"Your appointment with John Smith has been booked successfully!\"}', NULL, '2025-12-10 14:48:47', '2025-12-10 14:48:47'),
('9cc7fd4b-c7da-4bb9-ae25-6e5a30523075', 'App\\Notifications\\AppointmentBookedNotification', 'App\\Models\\User', 1, '{\"type\":\"appointment_booked\",\"appointment_id\":8,\"trainer_name\":\"John Smith\",\"appointment_date\":\"2025-12-23\",\"appointment_time\":\"13:00\",\"status\":\"pending\",\"message\":\"Your appointment with John Smith has been booked successfully!\"}', NULL, '2025-12-11 11:30:54', '2025-12-11 11:30:54'),
('a4e082c4-17ee-4903-9b3f-d3259b680acf', 'App\\Notifications\\AppointmentBookedNotification', 'App\\Models\\User', 19, '{\"type\":\"appointment_booked\",\"appointment_id\":8,\"trainer_name\":\"John Smith\",\"appointment_date\":\"2025-12-23\",\"appointment_time\":\"13:00\",\"status\":\"pending\",\"message\":\"Your appointment with John Smith has been booked successfully!\"}', NULL, '2025-12-11 11:30:54', '2025-12-11 11:30:54'),
('a974b52c-5bcf-4415-ac40-7e05addf3e78', 'App\\Notifications\\AppointmentBookedNotification', 'App\\Models\\User', 19, '{\"type\":\"appointment_booked\",\"appointment_id\":10,\"trainer_name\":\"Sarah Johnson \",\"appointment_date\":\"2025-12-22\",\"appointment_time\":\"22:00\",\"status\":\"pending\",\"message\":\"Your appointment with Sarah Johnson  has been booked successfully!\"}', NULL, '2025-12-12 17:49:03', '2025-12-12 17:49:03'),
('b8122bbc-de85-445b-b42d-809f075c5e1e', 'App\\Notifications\\AppointmentBookedNotification', 'App\\Models\\User', 1, '{\"type\":\"appointment_booked\",\"appointment_id\":4,\"trainer_name\":\"Amelia Rose\",\"appointment_date\":\"2025-12-11\",\"appointment_time\":\"14:30\",\"status\":\"pending\",\"message\":\"Your appointment with Amelia Rose has been booked successfully!\"}', NULL, '2025-12-09 17:55:43', '2025-12-09 17:55:43'),
('e16be858-2579-4a7c-9003-7a5eacfb43a8', 'App\\Notifications\\AppointmentBookedNotification', 'App\\Models\\User', 19, '{\"type\":\"appointment_booked\",\"appointment_id\":9,\"trainer_name\":\"Sarah Johnson\",\"appointment_date\":\"2025-12-15\",\"appointment_time\":\"20:00\",\"status\":\"pending\",\"message\":\"Your appointment with Sarah Johnson has been booked successfully!\"}', NULL, '2025-12-12 10:51:00', '2025-12-12 10:51:00'),
('e482c512-23da-44e6-b8cc-f7470dd77a9a', 'App\\Notifications\\AppointmentBookedNotification', 'App\\Models\\User', 1, '{\"type\":\"appointment_booked\",\"appointment_id\":10,\"trainer_name\":\"Sarah Johnson \",\"appointment_date\":\"2025-12-22\",\"appointment_time\":\"22:00\",\"status\":\"pending\",\"message\":\"Your appointment with Sarah Johnson  has been booked successfully!\"}', NULL, '2025-12-12 17:49:03', '2025-12-12 17:49:03'),
('f14eaf2d-0b36-484e-8357-246f031cfe48', 'App\\Notifications\\AppointmentBookedNotification', 'App\\Models\\User', 1, '{\"type\":\"appointment_booked\",\"appointment_id\":1,\"trainer_name\":\"Liam Daniel\",\"appointment_date\":\"2025-12-10\",\"appointment_time\":\"10:00\",\"status\":\"pending\",\"message\":\"Your appointment with Liam Daniel has been booked successfully!\"}', NULL, '2025-12-03 16:37:18', '2025-12-03 16:37:18'),
('fd068b16-9bf4-4859-9262-bad16443abbe', 'App\\Notifications\\AppointmentBookedNotification', 'App\\Models\\User', 1, '{\"type\":\"appointment_booked\",\"appointment_id\":2,\"trainer_name\":\"Liam Daniel\",\"appointment_date\":\"2025-12-10\",\"appointment_time\":\"09:00\",\"status\":\"pending\",\"message\":\"Your appointment with Liam Daniel has been booked successfully!\"}', NULL, '2025-12-03 17:08:20', '2025-12-03 17:08:20');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `title` varchar(500) DEFAULT NULL,
  `package_for` varchar(255) DEFAULT NULL,
  `period` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1' COMMENT '0=inactive, 1= active',
  `deleted_at` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `created_by`, `title`, `package_for`, `period`, `description`, `price`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Standard Member', '1', 'Year', '<ul>\r\n<li><strong>Add your profile to the member directory</strong></li>\r\n<li><strong>Upgrade your package to access the hub</strong></li>\r\n</ul>', '125', '1', NULL, '2025-05-23 14:31:58', '2025-06-12 18:47:56'),
(2, 1, 'Platinum Member (recommended)', '1', 'Year', '<ul>\r\n<li><strong>Add your profile to the directory</strong></li>\r\n<li><strong>View projects posted in the Hub<br /></strong></li>\r\n</ul>', '300', '1', NULL, '2025-05-23 14:32:49', '2025-06-12 18:49:25'),
(3, 1, 'EPC Member', '2', 'Year', '<ul>\r\n<li><strong>Add your profile to the directory</strong></li>\r\n<li><strong>Post projects to the Hub</strong></li>\r\n<li><strong>View projects in the Hub<br /></strong></li>\r\n</ul>', '300', '1', NULL, '2025-05-23 14:33:25', '2025-06-12 18:50:29');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keyword` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `created_by`, `title`, `slug`, `description`, `meta_title`, `meta_keyword`, `meta_description`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Header', 'header', '<p>Website header</p>', NULL, NULL, NULL, 1, NULL, '2022-06-03 18:22:30', '2024-06-27 18:48:39'),
(2, 1, 'Footer', 'footer', '<p>Website footer</p>', NULL, NULL, NULL, 1, NULL, '2022-06-03 18:24:13', '2024-06-27 18:48:13'),
(6, 1, 'About Us', 'about-us', '<p>About us page</p>', NULL, NULL, NULL, 1, NULL, '2022-06-10 18:28:46', '2024-06-27 18:47:07'),
(8, 1, 'Terms Conditions', 'terms-conditions', '<p>Terms and conditions page</p>', NULL, NULL, NULL, 1, '2024-06-24 17:44:34', '2022-06-10 19:42:07', '2024-06-27 18:46:37'),
(9, 1, 'Privacy Policy', 'privacy-policy', '<p>Privacy policy page</p>', NULL, NULL, NULL, 1, '2024-06-24 17:44:34', '2022-06-10 19:42:24', '2024-06-27 18:45:33'),
(17, 1, 'Our Newsletter', 'our-newsletter', '<p>Newsletter</p>', NULL, NULL, NULL, 1, '2024-06-24 17:44:34', '2024-06-24 12:29:35', '2024-06-24 12:44:34'),
(18, 1, 'Contact us', 'contact-us', '<p>Contact us page</p>', NULL, NULL, NULL, 1, NULL, '2024-06-27 14:52:48', '2024-06-27 18:44:52'),
(19, 1, 'Home About Us', 'home-about-us', '<p>Home About Us</p>', NULL, NULL, NULL, 1, NULL, '2024-12-19 17:14:18', '2024-12-19 17:14:34'),
(20, 1, 'Careers', 'careers', '<p>Careers Page</p>', NULL, NULL, NULL, 1, '2025-07-04 22:50:05', '2025-06-12 12:49:03', '2025-07-04 17:50:05');

-- --------------------------------------------------------

--
-- Table structure for table `page_settings`
--

CREATE TABLE `page_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_slug` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `deleted_at` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `page_settings`
--

INSERT INTO `page_settings` (`id`, `parent_slug`, `key`, `value`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'header', '_token', 'Yt9OUkAXPP2earTEBGiuMUD5Pmv7Me7ZBDU0JTNi', NULL, '2022-06-03 18:31:33', '2025-07-08 11:54:44'),
(2, 'header', 'parent_slug', 'header', NULL, '2022-06-03 18:31:33', '2022-06-03 18:31:33'),
(3, 'header', 'form_blog', NULL, NULL, '2022-06-03 18:31:33', '2022-06-03 18:31:33'),
(4, 'header', 'header_favicon', '08072025190128.png', NULL, '2022-06-03 18:31:33', '2025-07-08 14:01:28'),
(5, 'header', 'header_logo', '08072025173024.png', NULL, '2022-06-03 18:31:33', '2025-07-08 12:30:24'),
(6, 'footer', '_token', 'X03tHX7o9Ur4QCUnh1pZiagbLSoUUUPgqwMf4SF4', NULL, '2022-06-03 18:41:30', '2025-07-23 15:44:32'),
(7, 'footer', 'parent_slug', 'footer', NULL, '2022-06-03 18:41:30', '2022-06-03 18:41:30'),
(8, 'footer', 'footer_description', '<p>Fitnex was born from a passion for fitness and the frustration of navigating a fragmented wellness industry. We\'re building an inclusive ecosystem that connects clients with expert coaches, streamlining the journey to better health, performance, and confidence.</p>', NULL, '2022-06-03 18:41:30', '2025-07-02 13:21:17'),
(14, 'footer', 'footer_copy_right_left_side', '@ Copyright 2025, All Rights Reserved', NULL, '2022-06-03 18:41:30', '2025-02-06 13:30:36'),
(15, 'footer', 'form_blog', NULL, NULL, '2022-06-03 18:41:30', '2022-06-03 18:41:30'),
(16, 'footer', 'footer_image', '08072025173407.png', NULL, '2022-06-03 18:41:30', '2025-07-08 12:34:07'),
(17, 'privacy-policy', '_token', 'Rp5cLVuEZAfi21iGG3qZ6Zt0MytXSffNIFbTZ4h0', NULL, '2022-06-11 00:27:29', '2024-06-27 18:49:41'),
(18, 'privacy-policy', 'parent_slug', 'privacy-policy', NULL, '2022-06-11 00:27:29', '2022-06-11 00:27:29'),
(19, 'privacy-policy', 'mt_service', 'CHAFF MISSION', NULL, '2022-06-11 00:27:29', '2022-06-11 00:27:29'),
(20, 'privacy-policy', 'mk_service', 'WELCOME TO COMPANY', NULL, '2022-06-11 00:27:29', '2022-06-11 00:27:29'),
(21, 'privacy-policy', 'md_service', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\nSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.', NULL, '2022-06-11 00:44:47', '2022-06-11 00:44:47'),
(22, 'privacy-policy', 'service_heading', 'SED UT PERSPICIATIS', NULL, '2022-06-11 00:44:47', '2022-06-11 00:44:47'),
(23, 'privacy-policy', 'service_content', '<div class=\"row about-row-first flex-row-reverse\">\r\n<div class=\"col-md-12\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.</p>\r\n</div>\r\n</div>\r\n<div class=\"row last-para\">\r\n<div class=\"col-md-12\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.</p>\r\n</div>\r\n</div>', NULL, '2022-06-11 00:45:21', '2022-06-11 00:45:21'),
(24, 'privacy-policy', 'form_service', NULL, NULL, '2022-06-11 00:45:21', '2022-06-11 00:45:21'),
(25, 'terms-conditions', '_token', 'Rp5cLVuEZAfi21iGG3qZ6Zt0MytXSffNIFbTZ4h0', NULL, '2022-06-11 00:46:41', '2024-06-27 19:02:36'),
(26, 'terms-conditions', 'parent_slug', 'terms-conditions', NULL, '2022-06-11 00:46:41', '2022-06-11 00:46:41'),
(27, 'terms-conditions', 'mt_service', 'CHAFF MISSION', NULL, '2022-06-11 00:46:41', '2022-06-11 00:46:41'),
(28, 'terms-conditions', 'mk_service', 'WELCOME TO COMPANY', NULL, '2022-06-11 00:46:41', '2022-06-11 00:46:41'),
(29, 'terms-conditions', 'md_service', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\nSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.', NULL, '2022-06-11 00:46:41', '2022-06-11 00:46:41'),
(30, 'terms-conditions', 'service_heading', 'SED UT PERSPICIATIS', NULL, '2022-06-11 00:46:41', '2022-06-11 00:46:41'),
(31, 'terms-conditions', 'service_content', '<div class=\"row about-row-first flex-row-reverse\">\r\n<div class=\"col-md-12\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.</p>\r\n</div>\r\n</div>\r\n<div class=\"row last-para\">\r\n<div class=\"col-md-12\">\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.</p>\r\n</div>\r\n</div>', NULL, '2022-06-11 00:46:41', '2022-06-11 00:46:41'),
(32, 'terms-conditions', 'form_service', NULL, NULL, '2022-06-11 00:46:41', '2022-06-11 00:46:41'),
(79, 'privacy-policy', 'mt_privacy', 'SED UT PERSPICIATIS', NULL, '2022-06-14 17:01:12', '2024-06-24 12:31:15'),
(80, 'privacy-policy', 'mk_privacy', 'WELCOME TO COMPANY', NULL, '2022-06-14 17:01:12', '2022-06-14 17:01:12'),
(81, 'privacy-policy', 'md_privacy', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\nSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.', NULL, '2022-06-14 17:01:12', '2022-06-14 17:01:12'),
(82, 'privacy-policy', 'privacy_heading', 'PRIVACY POLICY', NULL, '2022-06-14 17:01:12', '2024-06-27 18:49:41'),
(83, 'privacy-policy', 'privacy_content', '<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Accusamus esse ea earum a odio ad itaque excepturi maxime error, distinctio perspiciatis dicta sint, vero reprehenderit. Neque debitis quis iusto itaque quam ad, pariatur quos, sequi deserunt nihil sunt! Dolore assumenda obcaecati fuga autem pariatur laborum quam ipsam magni inventore voluptate aspernatur numquam sequi suscipit sapiente sint incidunt culpa delectus doloremque, quae tenetur. Ex corporis eaque ducimus placeat iusto accusamus est iure illum atque repellendus nulla eveniet adipisci aliquid quidem tempore, neque libero earum? Obcaecati dolorem, iusto iure ipsum nisi quas animi doloremque explicabo amet pariatur? Illo libero soluta quo accusamus?</p>\r\n<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Accusamus esse ea earum a odio ad itaque excepturi maxime error, distinctio perspiciatis dicta sint, vero reprehenderit. Neque debitis quis iusto itaque quam ad, pariatur quos, sequi deserunt nihil sunt! Dolore assumenda obcaecati fuga autem pariatur laborum quam ipsam magni inventore voluptate aspernatur numquam sequi suscipit sapiente sint incidunt culpa delectus doloremque, quae tenetur. Ex corporis eaque ducimus placeat iusto accusamus est iure illum atque repellendus nulla eveniet adipisci aliquid quidem tempore, neque libero earum? Obcaecati dolorem, iusto iure ipsum nisi quas animi doloremque explicabo amet pariatur? Illo libero soluta quo accusamus?</p>', NULL, '2022-06-14 17:01:12', '2024-06-27 18:49:41'),
(84, 'terms-conditions', 'mt_term', 'SED UT PERSPICIATIS', NULL, '2022-06-14 17:13:09', '2024-06-24 12:32:05'),
(85, 'terms-conditions', 'mk_term', 'WELCOME TO COMPANY', NULL, '2022-06-14 17:13:09', '2022-06-14 17:13:09'),
(86, 'terms-conditions', 'md_term', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\nSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.', NULL, '2022-06-14 17:13:09', '2022-06-14 17:13:09'),
(87, 'terms-conditions', 'term_heading', 'TERMS & CONDITION', NULL, '2022-06-14 17:13:09', '2024-06-27 19:02:36'),
(88, 'terms-conditions', 'term_content', '<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Accusamus esse ea earum a odio ad itaque excepturi maxime error, distinctio perspiciatis dicta sint, vero reprehenderit. Neque debitis quis iusto itaque quam ad, pariatur quos, sequi deserunt nihil sunt! Dolore assumenda obcaecati fuga autem pariatur laborum quam ipsam magni inventore voluptate aspernatur numquam sequi suscipit sapiente sint incidunt culpa delectus doloremque, quae tenetur. Ex corporis eaque ducimus placeat iusto accusamus est iure illum atque repellendus nulla eveniet adipisci aliquid quidem tempore, neque libero earum? Obcaecati dolorem, iusto iure ipsum nisi quas animi doloremque explicabo amet pariatur? Illo libero soluta quo accusamus?</p>\r\n<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Accusamus esse ea earum a odio ad itaque excepturi maxime error, distinctio perspiciatis dicta sint, vero reprehenderit. Neque debitis quis iusto itaque quam ad, pariatur quos, sequi deserunt nihil sunt! Dolore assumenda obcaecati fuga autem pariatur laborum quam ipsam magni inventore voluptate aspernatur numquam sequi suscipit sapiente sint incidunt culpa delectus doloremque, quae tenetur. Ex corporis eaque ducimus placeat iusto accusamus est iure illum atque repellendus nulla eveniet adipisci aliquid quidem tempore, neque libero earum? Obcaecati dolorem, iusto iure ipsum nisi quas animi doloremque explicabo amet pariatur? Illo libero soluta quo accusamus?</p>', NULL, '2022-06-14 17:13:09', '2024-06-27 19:02:36'),
(105, 'home', '_token', 'bw0AJgqNGUsD3zNOMDhtBcGtwp9llqTjOTEbXsT4', NULL, '2022-06-14 18:23:16', '2022-06-14 18:23:16'),
(106, 'home', 'parent_slug', 'home', NULL, '2022-06-14 18:23:16', '2022-06-14 18:23:16'),
(107, 'home', 'banner_heading', NULL, NULL, '2022-06-14 18:23:16', '2022-06-14 18:23:16'),
(108, 'home', 'location_title', 'OUR LOCATION', NULL, '2022-06-14 18:23:16', '2022-06-14 18:23:16'),
(109, 'home', 'location_keyword', 'CLICK THE PIN TO FIND', NULL, '2022-06-14 18:23:16', '2022-06-14 18:23:16'),
(110, 'home', 'location_description', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', NULL, '2022-06-14 18:23:16', '2022-06-14 18:23:16'),
(111, 'home', 'form_home_blog', NULL, NULL, '2022-06-14 18:23:16', '2022-06-14 18:23:16'),
(114, 'header', 'header_call_us_now', NULL, NULL, '2022-07-29 17:27:09', '2025-07-02 13:18:40'),
(115, 'header', 'header_email', NULL, NULL, '2022-07-29 17:27:09', '2024-12-12 14:44:56'),
(116, 'footer', 'footer_address', '123 Main St, Anytown, USA', NULL, '2022-07-29 17:58:12', '2025-07-02 13:21:17'),
(117, 'about-us', '_token', 'A6AwLSJlTUAW39UPgWpLyHYt90T3g9iZrIry6wyl', NULL, '2022-08-15 11:45:13', '2025-07-16 11:03:04'),
(118, 'about-us', 'parent_slug', 'about-us', NULL, '2022-08-15 11:45:13', '2022-08-15 11:45:13'),
(119, 'about-us', 'about_heading', 'More About Us', NULL, '2022-08-15 11:45:13', '2022-08-23 13:50:45'),
(120, 'about-us', 'about_head_description', '<p>We are an upcoming real estate company, and we want you to grow and partner with us. With a solid foundation in the word of God in everything we do, our main focus is to treat everyone with integrity, compassion, care and to always put others interest above our own. Regardless of race, color, national origin, religion, or sexual orientation, we are here to help and to put every customer in a home of there choice. &nbsp;&nbsp;&nbsp;</p>', NULL, '2022-08-15 11:45:13', '2022-08-23 13:01:51'),
(121, 'about-us', 'title_one', 'Our Mission', NULL, '2022-08-15 11:45:13', '2022-08-15 11:45:13'),
(122, 'about-us', 'about_title_one_description', '<p>To be there when you need us. You can trust, believe, and count on us. We will always be driving the distance for you.</p>', NULL, '2022-08-15 11:45:13', '2022-08-23 13:00:31'),
(123, 'about-us', 'title_two', 'Our Vision', NULL, '2022-08-15 11:45:13', '2022-08-15 11:45:13'),
(124, 'about-us', 'about_title_two_description', '<p>Always looking forward to finding and building an authentic and lasting relationship with every customer, agent, and employee by being a faithful steward and with devotion to helping others.</p>', NULL, '2022-08-15 11:45:13', '2022-08-23 13:00:31'),
(125, 'about-us', 'title_three', 'Our Values', NULL, '2022-08-15 11:45:13', '2022-08-15 11:45:13'),
(126, 'about-us', 'about_title_three_description', '<p>We stand on the word of God which instills Integrity, Compassion, and Respect in all that we do. Managers, agents, and employees put our customers first above all else to help them find their Dream Home. &nbsp;&nbsp;</p>', NULL, '2022-08-15 11:45:13', '2022-08-23 13:00:31'),
(127, 'about-us', 'title_four', NULL, NULL, '2022-08-15 11:45:13', '2022-08-23 11:41:48'),
(128, 'about-us', 'about_title_four_description', NULL, NULL, '2022-08-15 11:45:13', '2022-08-23 11:41:48'),
(129, 'about-us', 'about_status', '0', NULL, '2022-08-15 11:45:13', '2024-12-19 17:17:15'),
(130, 'about-us', 'form_about', NULL, NULL, '2022-08-15 11:45:13', '2022-08-15 11:45:13'),
(131, 'faqs', '_token', 'nyT5Y8lJ7rVQmsPPP174ncnUhmWdREYx7eSSEELA', NULL, '2022-08-23 13:56:40', '2022-08-23 13:56:40'),
(132, 'faqs', 'parent_slug', 'faqs', NULL, '2022-08-23 13:56:40', '2022-08-23 13:56:40'),
(133, 'faqs', 'faqs_title', 'LOREM IPSUM DOLOR SIT AMET', NULL, '2022-08-23 13:56:40', '2022-08-23 13:56:40'),
(134, 'faqs', 'faqs_description', 'FREQUENTLY ASKED QUESTIONS', NULL, '2022-08-23 13:56:40', '2022-08-23 13:56:40'),
(135, 'faqs', 'faqs_question', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.', NULL, '2022-08-23 13:56:40', '2022-08-23 13:56:40'),
(136, 'faqs', 'faqs_answer', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', NULL, '2022-08-23 13:56:40', '2022-08-23 13:56:40'),
(137, 'faqs', 'form_service', NULL, NULL, '2022-08-23 13:56:40', '2022-08-23 13:56:40'),
(138, 'header', 'footer_facebook', NULL, NULL, '2022-08-29 18:03:41', '2024-12-12 14:44:56'),
(139, 'header', 'footer_twitter', NULL, NULL, '2022-08-29 18:03:41', '2024-12-12 14:44:56'),
(140, 'header', 'footer_instagram', NULL, NULL, '2022-08-29 18:03:41', '2024-12-12 14:44:56'),
(141, 'header', 'footer_linkedin', NULL, NULL, '2022-08-29 18:03:41', '2024-06-25 12:21:36'),
(142, 'about-us', 'heading_one', 'ABOUT OUR COMPANY', NULL, '2024-06-27 14:20:29', '2024-06-27 14:20:29'),
(143, 'about-us', 'description_one', '<p>Welcome to Renovaen! We&rsquo;ve created this website to make your life easier more affordable, safe, and trustworthy. We provide everything you need, from fixing problems and remodeling your home or business, to servicing your car or truck.</p>\r\n<p>Introducing our innovative new business, dedicated to providing our customers with the most reliable and affordable contractor services in town. At our company, we understand the stress and inconvenience that can come with household or car repairs, which is why we have created a simple and efficient platform for our customers to post their problems and receive offers from the most experienced and trusted contractors in the area. With no cost to the customer, and often no trip or inspection charges, we make it easy for our customers to choose the best offer for their needs, saving them time and money. And for those who may not have the funds to afford a contractor, our construction loan approval process takes just minutes, allowing our customers to receive the services they need without breaking the bank.</p>\r\n<p>Our goal is simple: to provide fast and reliable service to everyone who needs it. And that&rsquo;s not all &ndash; we also offer a cost-effective taxi service, Renovaen ride, which charges drivers less than other companies, resulting in cheaper fares for our customers, coming soon.</p>\r\n<p>So, if you&rsquo;re looking for a trustworthy and affordable contractor, or a cheap ride to your destination, look no further than our company. We are dedicated to serving our customers with the highest level of quality and satisfaction, and we can&rsquo;t wait to help you with all your needs.</p>', NULL, '2024-06-27 14:20:29', '2024-08-16 13:03:33'),
(144, 'about-us', 'heading_two', 'WELCOME TO RENOVAEN', NULL, '2024-06-27 14:20:29', '2024-08-16 13:03:33'),
(145, 'about-us', 'description_two', '<p>We created this website to make your life easier, more affordable, and more trustworthy. Whether you need to fix problems in your home, business, car, or truck, we have everything you need. We even offer home warranty services with some free services included coming soon. Plus, if you&rsquo;re planning a remodeling project, you can apply for a remodeling loan to help you save money.</p>\r\n<p>At Renovaen, we also provide a taxi service that&rsquo;s cheaper and safer than other companies. And if you&rsquo;re a truck driver, we can help you find loads and even provide repair services if your truck breaks down. We&rsquo;ve figured out a unique way to make our website the number one go-to for contractors and mechanics. No more spending hours on the phone trying to find the right company with the best prices and experience. With Renovaen, all you have to do is tell us what you need, and we&rsquo;ll find the right, trusted, cheapest, and most experienced professionals for you. We&rsquo;ll send your request to our contractors and mechanics, who will make offers for you to choose from. You&rsquo;ll be able to read about each company&rsquo;s offers and choose the one that works best for you. We even conduct background checks on all the contractors and mechanics working with us, so you can rest assured that you&rsquo;re in good hands. Thank you for choosing Renovaen. We&rsquo;re committed to providing you with the best service possible, and we look forward to helping you with all your needs.</p>', NULL, '2024-06-27 14:20:29', '2024-08-16 13:03:33'),
(146, 'about-us', 'title', 'About Us', NULL, '2024-06-27 14:28:52', '2024-06-27 14:28:52'),
(147, 'contact-us', '_token', 'X03tHX7o9Ur4QCUnh1pZiagbLSoUUUPgqwMf4SF4', NULL, '2024-06-27 14:59:53', '2025-07-23 13:47:32'),
(148, 'contact-us', 'parent_slug', 'contact-us', NULL, '2024-06-27 14:59:53', '2024-06-27 14:59:53'),
(149, 'contact-us', 'contact_address', '123 Main St, Anytown, USA', NULL, '2024-06-27 14:59:53', '2025-07-23 13:51:40'),
(150, 'contact-us', 'contact_email', 'Info@fitnex.com', NULL, '2024-06-27 14:59:53', '2025-07-23 13:47:32'),
(151, 'contact-us', 'contact_phone', '5574475582', NULL, '2024-06-27 14:59:53', '2025-07-23 13:47:32'),
(152, 'contact-us', 'form_contact', NULL, NULL, '2024-06-27 14:59:53', '2024-06-27 14:59:53'),
(153, 'contact-us', 'form_heading', 'Get In Touch', NULL, '2024-12-19 14:37:23', '2025-07-23 13:51:24'),
(154, 'contact-us', 'contact_heading', 'SOCIAL <span>MEDIA</span>', NULL, '2024-12-19 14:37:23', '2025-07-23 13:51:24'),
(155, 'contact-us', 'contact_map', NULL, NULL, '2024-12-19 14:37:23', '2025-04-15 11:28:31'),
(156, 'home-about-us', '_token', 'kL21qnAXS4sVUGw6sKDqPyyQI6DO14Hvs2nkfr1X', NULL, '2024-12-19 17:46:15', '2025-07-04 16:55:04'),
(157, 'home-about-us', 'parent_slug', 'home-about-us', NULL, '2024-12-19 17:46:15', '2024-12-19 17:46:15'),
(158, 'home-about-us', 'home_about_heading', 'who we are', NULL, '2024-12-19 17:46:15', '2025-04-15 13:06:07'),
(159, 'home-about-us', 'home_description', '<p>SCVBA ensures that local workers and businesses are always the first choice for providing construction, operational and related services for large infrastructure projects.</p>', NULL, '2024-12-19 17:46:15', '2025-04-15 13:01:42'),
(160, 'home-about-us', 'form_about', NULL, NULL, '2024-12-19 17:46:15', '2024-12-19 17:46:15'),
(161, 'home-about-us', 'home_about_image', '04072025220036.png', NULL, '2024-12-19 17:46:15', '2025-07-04 17:00:36'),
(162, 'home-about-us', 'home_about_title', 'About Fitnex', NULL, '2024-12-19 18:12:59', '2025-07-04 16:56:25'),
(163, 'about-us', 'about_page_heading', 'who we are?', NULL, '2024-12-20 11:32:21', '2025-04-16 15:00:02'),
(164, 'about-us', 'about_description', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', NULL, '2024-12-20 11:32:21', '2025-07-16 11:05:57'),
(165, 'about-us', 'about_description_two', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', NULL, '2024-12-20 11:32:21', '2025-07-16 11:05:57'),
(166, 'about-us', 'why_heading', 'WHY JOIN US?', NULL, '2024-12-20 11:32:21', '2024-12-20 11:32:21'),
(167, 'about-us', 'first_title', 'Fun and Fitness Combined', NULL, '2024-12-20 11:32:21', '2024-12-20 11:32:21'),
(168, 'about-us', 'first_description', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', NULL, '2024-12-20 11:32:21', '2025-07-16 11:05:57'),
(169, 'about-us', 'second_title', 'Customized Solutions', NULL, '2024-12-20 11:32:21', '2024-12-20 11:32:21'),
(170, 'about-us', 'second_description', 'Integer quis urna rhoncus, ultricies nulla vitae, gravida neque. Duis tempus cursus libero, sit amet malesuada massa commodo id. Donec', NULL, '2024-12-20 11:32:21', '2024-12-20 11:32:21'),
(171, 'about-us', 'third_title', 'Track Your Progress', NULL, '2024-12-20 11:32:21', '2024-12-20 11:32:21'),
(172, 'about-us', 'third_description', 'Integer quis urna rhoncus, ultricies nulla vitae, gravida neque. Duis tempus cursus libero, sit amet malesuada massa commodo id. Donec', NULL, '2024-12-20 11:32:21', '2024-12-20 11:32:21'),
(173, 'about-us', 'about_us_image', '16072025161924.jpg', NULL, '2024-12-20 11:32:21', '2025-07-16 11:19:24'),
(174, 'about-us', 'why_image', '16072025183947.jpg', NULL, '2024-12-20 11:32:21', '2025-07-16 13:39:47'),
(175, 'footer', 'footer_number', NULL, NULL, '2024-12-20 16:07:33', '2025-07-02 13:21:17'),
(181, 'contact-us', 'contact_image', '04072025224252.png', NULL, '2025-04-15 11:42:25', '2025-07-04 17:42:52'),
(182, 'home-about-us', 'about_status', '1', NULL, '2025-04-15 12:57:34', '2025-07-04 17:03:13'),
(183, 'home-about-us', 'home_about_description', '<p>Fitnex was born from a passion for fitness and the frustration of navigating a fragmented wellness industry. We\'re building an inclusive ecosystem that connects clients with expert coaches, streamlining the journey to better health, performance, and confidence.</p>', NULL, '2025-04-15 13:06:07', '2025-07-04 16:56:25'),
(184, 'home-about-us', 'home_our_mission_heading', 'OUR Mission', NULL, '2025-04-15 13:06:07', '2025-04-15 13:06:07'),
(185, 'home-about-us', 'home_our_mission_description', '<div>SCVBA ensures that local workers and businesses are always the first choice for providing construction, operational and related services for large infrastructure projects.</div>', NULL, '2025-04-15 13:06:07', '2025-04-15 13:30:59'),
(186, 'home-about-us', 'home_our_mission_image', '15042025180607.png', NULL, '2025-04-15 13:06:07', '2025-04-15 13:06:07'),
(187, 'about-us', 'about_description_three', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', NULL, '2025-04-16 15:01:47', '2025-07-16 11:05:57'),
(188, 'about-us', 'about_us_image2', '16072025160557.jpg', NULL, '2025-04-16 15:03:04', '2025-07-16 11:05:57'),
(189, 'about-us', 'our_mission_heading', 'Our Mission', NULL, '2025-04-16 15:58:17', '2025-04-16 15:58:17'),
(190, 'about-us', 'our_mission_description', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', NULL, '2025-04-16 16:12:43', '2025-07-16 11:05:57'),
(191, 'about-us', 'first_our_mission', 'Fun and Fitness Combined', NULL, '2025-04-16 16:12:43', '2025-04-16 16:12:43'),
(192, 'about-us', 'first_our_mission_description', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', NULL, '2025-04-16 16:23:10', '2025-07-16 11:05:57'),
(193, 'about-us', 'second_our_mission_description', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', NULL, '2025-04-16 16:23:10', '2025-07-16 11:05:57'),
(194, 'about-us', 'third_our_mission_description', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', NULL, '2025-04-16 16:23:10', '2025-07-16 11:05:57'),
(195, 'about-us', 'fourth_our_mission_description', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', NULL, '2025-04-16 16:23:10', '2025-07-16 11:05:57'),
(196, 'careers', '_token', 'vKa0X4KN5luA438ym1PYz9WniawJCkjcwR9XFQo9', NULL, '2025-06-12 12:59:07', '2025-06-12 12:59:07'),
(197, 'careers', 'parent_slug', 'careers', NULL, '2025-06-12 12:59:07', '2025-06-12 12:59:07'),
(198, 'careers', 'careers_heading', 'Join Our Team as</span> <br><span>Executive Director', NULL, '2025-06-12 12:59:07', '2025-06-12 12:59:07'),
(199, 'careers', 'job_summary', 'Job Summary:', NULL, '2025-06-12 12:59:07', '2025-06-12 12:59:07'),
(200, 'careers', 'job_description', '<p class=\"mb-20\" data-aos=\"fade-down\" data-aos-easing=\"linear\" data-aos-duration=\"1500\">The Executive Director of the South-Central Virginia Business Alliance (SCVBA) is responsible for advising and managing the development of organizational strategies, administering policies, preparing budgets, and providing financial reports. This role includes coordinating Board meetings, managing membership recruitment and renewals, and supporting both the Membership Committee and Events Committee. <br /><br />The Executive Director will also oversee the selection and implementation of a Non-profit Membership Management and CRM system, plan and support SCVBA events, and support the development of the Project Hub, an online resource for General Contractors and subcontractors in solar, storage, and other infrastructure projects. Additionally, the Executive Director monitors and responds to emails, ensuring effective communication and collaboration within the organization.</p>', NULL, '2025-06-12 12:59:07', '2025-06-12 13:06:18'),
(201, 'careers', 'job_functions', 'Job Functions:', NULL, '2025-06-12 12:59:07', '2025-06-12 12:59:07'),
(202, 'careers', 'job_functions_description', '<ul class=\"list\">\r\n<li>Advise and manage the development of organizational strategy.</li>\r\n<li>Develop, manage, and administer organizational policies and philosophies.</li>\r\n<li>Prepare SCVBA budgets and manage to these budgets.</li>\r\n<li>Provide financial reports supported by third-party accounting and bookkeeping.</li>\r\n<li>Coordinate Board meetings, develop materials for Board meetings, and distribute materials:\r\n<ul>\r\n<li>Take notes and prepare minutes using AI Note taking for distribution within 5 days of meetings.</li>\r\n<li>Board meetings are scheduled and conducted using MS Teams, and a member company\'s administration manages scheduling.</li>\r\n</ul>\r\n</li>\r\n<li>Monitor and distribute incoming emails appropriately and respond accordingly.</li>\r\n<li>Identify and recruit new members.</li>\r\n<li>Manage membership renewals, track status and provide the Board updates.</li>\r\n<li>Manage and support the Membership Committee.</li>\r\n<li>Manage the member\'s directory, adding new members, coordinating with members on their materials, and updating as needed.</li>\r\n<li>Manage the selection of a non-profit Membership Management and CRM system</li>\r\n<li>Manage and support the planning and implementation of SCVBA events.\r\n<ul>\r\n<li>SCVBA hires third-party event planners and third-party support for Day-of.</li>\r\n</ul>\r\n</li>\r\n<li>Manage and support the development and implementation the Project Hub.\r\n<ul>\r\n<li>The Project HUB is intended to be a comprehensive online resource for stakeholders involved in providing and procuring construction services for solar and storage projects. The website will feature solar project information, company information, project and company documentation, updates, and communication tools. The primary objectives are improving transparency, streamlining project management, and facilitating stakeholder collaboration.</li>\r\n</ul>\r\n</li>\r\n</ul>', NULL, '2025-06-12 12:59:07', '2025-06-12 13:18:46'),
(203, 'careers', 'knowledge_skills_heading', 'Knowledge, Skills, and Abilities:', NULL, '2025-06-12 12:59:07', '2025-06-12 12:59:07'),
(204, 'careers', 'knowledge_skills_description', '<ul class=\"list\">\r\n<li>Knowledge of office administrator responsibilities, systems, and procedures.</li>\r\n<li>Excellent time management skills and ability to multi-task and prioritize.</li>\r\n<li>Positive team player with a \"roll up your sleeves\", service-oriented attitude.</li>\r\n<li>Excellent verbal and written communication skills, with proven ability to clearly communicate with technical support, customers and leadership.</li>\r\n<li>Strong attention to detail and problem-solving skills.</li>\r\n<li>Ability to work well independently as well as part of a team.</li>\r\n<li>Ability to maintain a high level of confidentiality and integrity in all aspects of interactions with internal and external stakeholders.</li>\r\n<li>Proficient in MS Office (Excel, Word, Outlook, PowerPoint, MS Teams, and Publisher).</li>\r\n<li>Experience working with accounting software such as QuickBooks is a plus.</li>\r\n<li>Experience working with non-profit/association membership management and CRM systems is a plus.</li>\r\n</ul>', NULL, '2025-06-12 12:59:07', '2025-06-12 13:20:48'),
(205, 'careers', 'experience_education_heading', 'Experience and Education:', NULL, '2025-06-12 12:59:07', '2025-06-12 12:59:07'),
(206, 'careers', 'experience_education_description', '<ul class=\"list\">\r\n<li>Minimum of two years of proven experience in an administrative role, or preferably a non-profit Executive Director or Deputy working for a non-profit Board or directly for non-profit leadership.</li>\r\n<li>Bachelor\'s degree preferred, high school required.</li>\r\n<li>Ability to be physically located in southern Virginia for SCVBA events is required, and physically present for the SCVBA Board meetings is preferred.</li>\r\n<li>Experience living and working in southern Virginia is preferred.</li>\r\n</ul>', NULL, '2025-06-12 12:59:07', '2025-06-12 13:21:42'),
(207, 'careers', 'compensation_heading', 'Compensation:', NULL, '2025-06-12 12:59:07', '2025-06-12 12:59:07'),
(208, 'careers', 'compensation_description', '<ul class=\"list\">\r\n<li>$30 per hour with expected 25-35 hours per week.</li>\r\n<li>Includes incentive bonuses and approved reimbursements.</li>\r\n</ul>', NULL, '2025-06-12 12:59:07', '2025-06-12 13:22:19'),
(209, 'careers', 'to_apply_heading', 'To Apply:', NULL, '2025-06-12 12:59:07', '2025-06-12 12:59:07'),
(210, 'careers', 'to_apply_description', '<p>Please send resume and cover letter to <a href=\"mailto:careers@solunesco.com\">careers@solunesco.com</a>.</p>', NULL, '2025-06-12 12:59:07', '2025-06-12 13:41:39'),
(211, 'careers', 'careers_status', '1', NULL, '2025-06-12 12:59:07', '2025-06-12 12:59:07'),
(212, 'careers', 'form_about', NULL, NULL, '2025-06-12 12:59:08', '2025-06-12 12:59:08'),
(213, 'about-us', 'about_banner', '16072025161924.webp', NULL, '2025-07-16 11:03:04', '2025-07-16 11:19:24'),
(217, 'contact-us', 'contact_facebok', 'https://www.facebook.com/', NULL, '2025-07-23 15:40:58', '2025-07-23 15:40:58'),
(218, 'contact-us', 'contact_twiter', 'https://x.com/', NULL, '2025-07-23 15:40:58', '2025-07-23 15:40:58'),
(219, 'contact-us', 'contact_linkdin', 'https://www.linkedin.com/', NULL, '2025-07-23 15:40:58', '2025-07-23 15:40:58'),
(220, 'footer', 'footer_instagram', 'https://www.instagram.com/', NULL, '2025-07-23 15:58:49', '2025-07-23 15:58:49'),
(221, 'footer', 'footer_linkdin', 'https://www.linkedin.com/', NULL, '2025-07-23 15:58:49', '2025-07-23 15:58:49'),
(222, 'footer', 'footer_youtube', 'https://www.youtube.com/', NULL, '2025-07-23 15:58:49', '2025-07-23 15:58:49'),
(223, 'footer', 'footer_twiter', 'https://x.com/', NULL, '2025-07-23 15:58:49', '2025-07-23 15:59:39'),
(224, 'footer', 'footer_email', 'youremailhere@gmail.com', NULL, '2025-07-23 15:58:49', '2025-07-23 15:58:49');

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
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `package_id` int(11) DEFAULT NULL,
  `order_number` bigint(20) NOT NULL,
  `total_payment` double(8,2) DEFAULT NULL,
  `paid` double(8,2) NOT NULL,
  `dues` double(8,2) DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `customer_id`, `package_id`, `order_number`, `total_payment`, `paid`, `dues`, `payment_status`, `status`, `created_at`, `updated_at`) VALUES
(1, 77, 3, 15736, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-05-23 15:45:47', '2025-05-23 15:45:47'),
(2, 78, 3, 60141, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-05-27 10:45:35', '2025-05-27 10:45:35'),
(3, 79, 3, 17071, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-05-27 10:50:10', '2025-05-27 10:50:10'),
(4, 80, 2, 26572, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-05-27 11:17:45', '2025-05-27 11:17:45'),
(5, 81, 3, 93846, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-05-27 12:18:51', '2025-05-27 12:18:51'),
(6, 82, 1, 71905, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-03 10:34:25', '2025-06-03 10:34:25'),
(7, 83, 2, 79076, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-03 10:37:11', '2025-06-03 10:37:11'),
(8, 84, 1, 58723, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-03 12:37:07', '2025-06-03 12:37:07'),
(9, 85, 2, 82587, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-03 12:40:01', '2025-06-03 12:40:01'),
(10, 87, 2, 64034, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-03 13:13:43', '2025-06-03 13:13:43'),
(11, 89, 2, 99409, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-03 13:25:37', '2025-06-03 13:25:37'),
(12, 92, 2, 29302, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-03 15:11:24', '2025-06-03 15:11:24'),
(13, 93, 2, 86736, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-03 15:14:21', '2025-06-03 15:14:21'),
(14, 97, 3, 26337, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-03 15:22:50', '2025-06-03 15:22:50'),
(15, 98, 2, 43944, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-03 15:25:40', '2025-06-03 15:25:40'),
(16, 99, 2, 36431, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-03 15:28:54', '2025-06-03 15:28:54'),
(17, 100, 1, 82679, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-03 15:30:40', '2025-06-03 15:30:40'),
(18, 101, 3, 28931, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-03 15:45:11', '2025-06-03 15:45:11'),
(19, 102, 2, 57371, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-10 11:26:17', '2025-06-10 11:26:17'),
(20, 103, 1, 29788, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-10 11:29:13', '2025-06-10 11:29:13'),
(21, 104, 1, 90770, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-17 13:28:43', '2025-06-17 13:28:43'),
(22, 105, 1, 52232, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-24 19:00:02', '2025-06-24 19:00:02'),
(23, 2, 1, 12857, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-24 19:10:29', '2025-06-24 19:10:29'),
(24, 3, 2, 74462, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-25 10:29:37', '2025-06-25 10:29:37'),
(25, 4, 1, 76324, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-25 10:33:34', '2025-06-25 10:33:34'),
(26, 5, 2, 31242, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-25 10:35:33', '2025-06-25 10:35:33'),
(27, 6, 1, 56627, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-25 10:36:35', '2025-06-25 10:36:35'),
(28, 7, 2, 60832, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-25 10:37:47', '2025-06-25 10:37:47'),
(29, 8, 2, 43002, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-25 10:38:54', '2025-06-25 10:38:54'),
(30, 9, 1, 92626, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-25 10:43:07', '2025-06-25 10:43:07'),
(31, 10, 2, 98641, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-25 10:50:51', '2025-06-25 10:50:51'),
(32, 11, 1, 36693, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-25 10:51:53', '2025-06-25 10:51:53'),
(33, 12, 1, 16645, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-25 10:52:58', '2025-06-25 10:52:58'),
(34, 13, 1, 30681, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-25 10:54:03', '2025-06-25 10:54:03'),
(35, 14, 1, 97263, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-25 10:56:23', '2025-06-25 10:56:23'),
(36, 15, 2, 73683, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-25 10:57:32', '2025-06-25 10:57:32'),
(37, 16, 1, 53321, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-25 10:58:36', '2025-06-25 10:58:36'),
(38, 17, 2, 34223, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-25 12:22:31', '2025-06-25 12:22:31'),
(39, 18, 1, 13555, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-25 12:24:12', '2025-06-25 12:24:12'),
(40, 19, 1, 80010, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-25 12:25:23', '2025-06-25 12:25:23'),
(41, 20, 2, 87353, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-25 12:26:51', '2025-06-25 12:26:51'),
(42, 21, 2, 29358, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-25 12:29:09', '2025-06-25 12:29:09'),
(43, 22, 1, 27456, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-25 13:25:11', '2025-06-25 13:25:11'),
(44, 23, 1, 26155, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-25 13:26:35', '2025-06-25 13:26:35'),
(45, 24, 2, 96765, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-25 13:27:59', '2025-06-25 13:27:59'),
(46, 25, 1, 80084, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-25 13:29:08', '2025-06-25 13:29:08'),
(47, 26, 1, 62916, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-25 13:30:16', '2025-06-25 13:30:16'),
(48, 27, 2, 38111, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-25 13:31:45', '2025-06-25 13:31:45'),
(49, 28, 2, 32759, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-25 13:33:02', '2025-06-25 13:33:02'),
(50, 29, 1, 31912, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-25 13:34:28', '2025-06-25 13:34:28'),
(51, 30, 1, 10710, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-25 13:35:38', '2025-06-25 13:35:38'),
(52, 31, 2, 78419, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-25 13:36:45', '2025-06-25 13:36:45'),
(53, 32, 1, 21793, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-25 13:38:18', '2025-06-25 13:38:18'),
(54, 33, 2, 80124, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-25 13:40:18', '2025-06-25 13:40:18'),
(55, 34, 1, 98835, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-25 13:41:49', '2025-06-25 13:41:49'),
(56, 35, 2, 38046, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-25 13:43:14', '2025-06-25 13:43:14'),
(57, 36, 1, 25572, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-25 13:44:47', '2025-06-25 13:44:47'),
(58, 37, 1, 61052, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-25 13:46:26', '2025-06-25 13:46:26'),
(59, 38, 1, 38351, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-25 13:47:50', '2025-06-25 13:47:50'),
(60, 39, 1, 72421, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-25 13:49:14', '2025-06-25 13:49:14'),
(61, 40, 2, 45517, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-25 13:50:25', '2025-06-25 13:50:25'),
(62, 41, 1, 66678, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-25 13:51:47', '2025-06-25 13:51:47'),
(63, 42, 2, 88579, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-25 13:53:05', '2025-06-25 13:53:05'),
(64, 43, 2, 42570, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-25 13:54:29', '2025-06-25 13:54:29'),
(65, 44, 1, 53874, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-25 13:56:05', '2025-06-25 13:56:05'),
(66, 45, 2, 58130, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-25 13:58:40', '2025-06-25 13:58:40'),
(67, 46, 1, 58235, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-25 14:56:25', '2025-06-25 14:56:25'),
(68, 47, 1, 90019, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-25 15:15:20', '2025-06-25 15:15:20'),
(69, 48, 2, 78990, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-25 15:16:39', '2025-06-25 15:16:39'),
(70, 49, 1, 92892, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-25 15:18:18', '2025-06-25 15:18:18'),
(71, 50, 2, 39675, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-25 15:20:25', '2025-06-25 15:20:25'),
(72, 51, 2, 72754, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-25 15:21:32', '2025-06-25 15:21:32'),
(73, 52, 1, 77866, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-25 15:22:46', '2025-06-25 15:22:46'),
(74, 53, 1, 28042, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-25 15:23:57', '2025-06-25 15:23:57'),
(75, 54, 1, 50259, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-25 15:25:07', '2025-06-25 15:25:07'),
(76, 55, 2, 65690, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-25 15:26:14', '2025-06-25 15:26:14'),
(77, 56, 2, 83863, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-25 15:50:22', '2025-06-25 15:50:22'),
(78, 57, 1, 17628, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-25 15:54:25', '2025-06-25 15:54:25'),
(79, 58, 1, 41273, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-25 16:08:18', '2025-06-25 16:08:18'),
(80, 59, 1, 30099, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-25 16:13:45', '2025-06-25 16:13:45'),
(81, 60, 1, 84690, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-25 16:21:00', '2025-06-25 16:21:00'),
(82, 61, 1, 25484, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-25 16:22:23', '2025-06-25 16:22:23'),
(83, 62, 1, 42936, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-25 17:46:38', '2025-06-25 17:46:38'),
(84, 63, 1, 61665, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-25 17:47:55', '2025-06-25 17:47:55'),
(85, 64, 1, 33144, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-25 17:49:54', '2025-06-25 17:49:54'),
(86, 65, 1, 67755, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-25 17:52:07', '2025-06-25 17:52:07'),
(87, 66, 1, 30375, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-25 17:53:29', '2025-06-25 17:53:29'),
(88, 67, 2, 67174, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-25 17:54:43', '2025-06-25 17:54:43'),
(89, 68, 1, 16298, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-25 18:08:16', '2025-06-25 18:08:16'),
(90, 69, 1, 85281, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-25 18:13:01', '2025-06-25 18:13:01'),
(91, 70, 2, 37774, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-25 18:15:15', '2025-06-25 18:15:15'),
(92, 71, 2, 70378, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-25 18:16:38', '2025-06-25 18:16:38'),
(93, 72, 2, 87871, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-25 18:18:23', '2025-06-25 18:18:23'),
(94, 73, 2, 27704, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-25 18:19:43', '2025-06-25 18:19:43'),
(95, 74, 2, 65390, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-25 18:21:32', '2025-06-25 18:21:32'),
(96, 75, 2, 44367, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-25 18:23:35', '2025-06-25 18:23:35'),
(97, 76, 1, 28146, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-25 18:24:55', '2025-06-25 18:24:55'),
(98, 77, 2, 89104, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-25 18:26:52', '2025-06-25 18:26:52'),
(99, 78, 1, 71133, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-25 18:29:16', '2025-06-25 18:29:16'),
(100, 79, 2, 99141, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-25 18:30:48', '2025-06-25 18:30:48'),
(101, 80, 2, 58033, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-25 18:32:22', '2025-06-25 18:32:22'),
(102, 81, 1, 98350, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-25 18:33:49', '2025-06-25 18:33:49'),
(103, 82, 2, 50022, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-25 18:35:05', '2025-06-25 18:35:05'),
(104, 83, 2, 95185, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-25 18:36:23', '2025-06-25 18:36:23'),
(105, 84, 1, 47116, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-25 18:37:40', '2025-06-25 18:37:40'),
(106, 85, 2, 78520, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-25 18:44:41', '2025-06-25 18:44:41'),
(107, 86, 2, 51177, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-25 18:46:52', '2025-06-25 18:46:52'),
(108, 87, 1, 96482, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-25 18:48:00', '2025-06-25 18:48:00'),
(109, 88, 2, 92525, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-25 18:49:11', '2025-06-25 18:49:11'),
(110, 89, 1, 63891, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-25 18:50:26', '2025-06-25 18:50:26'),
(111, 90, 2, 57009, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-25 18:51:40', '2025-06-25 18:51:40'),
(112, 91, 1, 38804, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-25 18:53:09', '2025-06-25 18:53:09'),
(113, 92, 2, 61849, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-25 18:55:09', '2025-06-25 18:55:09'),
(114, 93, 1, 51246, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-25 18:56:52', '2025-06-25 18:56:52'),
(115, 94, 1, 48716, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-25 18:58:56', '2025-06-25 18:58:56'),
(116, 105, 2, 19396, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-26 10:40:20', '2025-06-26 10:40:20'),
(117, 106, 1, 66582, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-26 10:41:25', '2025-06-26 10:41:25'),
(118, 107, 1, 75713, 125.00, 125.00, 0.00, 'succeeded', 1, '2025-06-26 12:14:43', '2025-06-26 12:14:43'),
(119, 108, 3, 98172, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-26 12:17:40', '2025-06-26 12:17:40'),
(120, 95, 3, 65763, 300.00, 300.00, 0.00, 'succeeded', 1, '2025-06-30 10:50:29', '2025-06-30 10:50:29');

-- --------------------------------------------------------

--
-- Table structure for table `payment_details`
--

CREATE TABLE `payment_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_number` bigint(20) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `transaction_status` varchar(255) DEFAULT NULL,
  `transaction_date` date NOT NULL,
  `name_on_card` varchar(255) DEFAULT NULL,
  `expiration_month` varchar(255) NOT NULL,
  `expiration_year` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_details`
--

INSERT INTO `payment_details` (`id`, `order_number`, `transaction_id`, `transaction_status`, `transaction_date`, `name_on_card`, `expiration_month`, `expiration_year`, `created_at`, `updated_at`) VALUES
(1, 15736, 'ch_3RS2TILXqt7gmBJh03Ho41RX', 'succeeded', '2025-05-23', NULL, '11', '2026', '2025-05-23 15:45:47', '2025-05-23 15:45:47'),
(2, 60141, 'ch_3RTPgwLXqt7gmBJh0013ewKb', 'succeeded', '2025-05-27', NULL, '11', '2029', '2025-05-27 10:45:35', '2025-05-27 10:45:35'),
(3, 17071, 'ch_3RTPlSLXqt7gmBJh05rB9I7s', 'succeeded', '2025-05-27', NULL, '11', '2029', '2025-05-27 10:50:10', '2025-05-27 10:50:10'),
(4, 26572, 'ch_3RTQC9LXqt7gmBJh0meuLKt4', 'succeeded', '2025-05-27', NULL, '11', '2029', '2025-05-27 11:17:45', '2025-05-27 11:17:45'),
(5, 93846, 'ch_3RTR9GLXqt7gmBJh11eB2kAl', 'succeeded', '2025-05-27', NULL, '11', '2029', '2025-05-27 12:18:51', '2025-05-27 12:18:51'),
(6, 71905, 'ch_3RVwr0LXqt7gmBJh0tZZghF3', 'succeeded', '2025-06-03', NULL, '11', '2029', '2025-06-03 10:34:25', '2025-06-03 10:34:25'),
(7, 79076, 'ch_3RVwtjLXqt7gmBJh0M2XepSY', 'succeeded', '2025-06-03', NULL, '11', '2029', '2025-06-03 10:37:11', '2025-06-03 10:37:11'),
(8, 58723, 'ch_3RVylkLXqt7gmBJh1tReXNDN', 'succeeded', '2025-06-03', NULL, '11', '2029', '2025-06-03 12:37:07', '2025-06-03 12:37:07'),
(9, 82587, 'ch_3RVyobLXqt7gmBJh1plrf60v', 'succeeded', '2025-06-03', NULL, '11', '2029', '2025-06-03 12:40:01', '2025-06-03 12:40:01'),
(10, 64034, 'ch_3RVzLCLXqt7gmBJh1FWM9e29', 'succeeded', '2025-06-03', NULL, '11', '2029', '2025-06-03 13:13:43', '2025-06-03 13:13:43'),
(11, 99409, 'ch_3RVzWiLXqt7gmBJh09rbybwn', 'succeeded', '2025-06-03', NULL, '11', '2029', '2025-06-03 13:25:37', '2025-06-03 13:25:37'),
(12, 29302, 'ch_3RW1B4LXqt7gmBJh0zPmCm2y', 'succeeded', '2025-06-03', NULL, '11', '2029', '2025-06-03 15:11:24', '2025-06-03 15:11:24'),
(13, 86736, 'ch_3RW1DxLXqt7gmBJh0lbKO0aI', 'succeeded', '2025-06-03', NULL, '11', '2029', '2025-06-03 15:14:21', '2025-06-03 15:14:21'),
(14, 26337, 'ch_3RW1MALXqt7gmBJh06Ana1Kv', 'succeeded', '2025-06-03', NULL, '11', '2029', '2025-06-03 15:22:50', '2025-06-03 15:22:50'),
(15, 43944, 'ch_3RW1OuLXqt7gmBJh0SR2m5rH', 'succeeded', '2025-06-03', NULL, '11', '2029', '2025-06-03 15:25:40', '2025-06-03 15:25:40'),
(16, 36431, 'ch_3RW1S3LXqt7gmBJh0HyBEqu6', 'succeeded', '2025-06-03', NULL, '11', '2029', '2025-06-03 15:28:54', '2025-06-03 15:28:54'),
(17, 82679, 'ch_3RW1TkLXqt7gmBJh0kNNWE9P', 'succeeded', '2025-06-03', NULL, '11', '2029', '2025-06-03 15:30:40', '2025-06-03 15:30:40'),
(18, 28931, 'ch_3RW1hlLXqt7gmBJh01OGEJbo', 'succeeded', '2025-06-03', NULL, '11', '2029', '2025-06-03 15:45:11', '2025-06-03 15:45:11'),
(19, 57371, 'ch_3RYV02LXqt7gmBJh0KBCgN9a', 'succeeded', '2025-06-10', NULL, '11', '2029', '2025-06-10 11:26:17', '2025-06-10 11:26:17'),
(20, 29788, 'ch_3RYV2vLXqt7gmBJh1342r7zV', 'succeeded', '2025-06-10', NULL, '11', '2029', '2025-06-10 11:29:13', '2025-06-10 11:29:13'),
(21, 90770, 'ch_3Rb4FCLXqt7gmBJh06oGj8e5', 'succeeded', '2025-06-17', NULL, '11', '2029', '2025-06-17 13:28:43', '2025-06-17 13:28:43'),
(22, 52232, 'ch_3RdgkrLXqt7gmBJh1udKL2WH', 'succeeded', '2025-06-25', NULL, '11', '2029', '2025-06-24 19:00:02', '2025-06-24 19:00:02'),
(23, 12857, 'ch_3Rdgv0LXqt7gmBJh0YHdqW4E', 'succeeded', '2025-06-25', NULL, '11', '2029', '2025-06-24 19:10:29', '2025-06-24 19:10:29'),
(24, 74462, 'ch_3RdvGQLXqt7gmBJh11hUPoAy', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 10:29:37', '2025-06-25 10:29:37'),
(25, 76324, 'ch_3RdvKHLXqt7gmBJh1vzxSCeU', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 10:33:34', '2025-06-25 10:33:34'),
(26, 31242, 'ch_3RdvMCLXqt7gmBJh1smt31Kn', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 10:35:33', '2025-06-25 10:35:33'),
(27, 56627, 'ch_3RdvNDLXqt7gmBJh1QbaMnFV', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 10:36:35', '2025-06-25 10:36:35'),
(28, 60832, 'ch_3RdvONLXqt7gmBJh0gWj6Twh', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 10:37:47', '2025-06-25 10:37:47'),
(29, 43002, 'ch_3RdvPSLXqt7gmBJh1Z3Q8CCm', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 10:38:54', '2025-06-25 10:38:54'),
(30, 92626, 'ch_3RdvTXLXqt7gmBJh0QfFYB0m', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 10:43:07', '2025-06-25 10:43:07'),
(31, 98641, 'ch_3Rdvb1LXqt7gmBJh1a1Ih6Ta', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 10:50:51', '2025-06-25 10:50:51'),
(32, 36693, 'ch_3Rdvc2LXqt7gmBJh0aE0pfzV', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 10:51:53', '2025-06-25 10:51:53'),
(33, 16645, 'ch_3Rdvd4LXqt7gmBJh02RCjwam', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 10:52:58', '2025-06-25 10:52:58'),
(34, 30681, 'ch_3Rdve7LXqt7gmBJh0gqd8YJI', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 10:54:03', '2025-06-25 10:54:03'),
(35, 97263, 'ch_3RdvgNLXqt7gmBJh1WebczZv', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 10:56:23', '2025-06-25 10:56:23'),
(36, 73683, 'ch_3RdvhULXqt7gmBJh0COjc2lt', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 10:57:32', '2025-06-25 10:57:32'),
(37, 53321, 'ch_3RdviWLXqt7gmBJh1lYpOoWO', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 10:58:36', '2025-06-25 10:58:36'),
(38, 34223, 'ch_3Rdx1hLXqt7gmBJh1D5nZ6uO', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 12:22:32', '2025-06-25 12:22:32'),
(39, 13555, 'ch_3Rdx3MLXqt7gmBJh06UaCl9Q', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 12:24:12', '2025-06-25 12:24:12'),
(40, 80010, 'ch_3Rdx4VLXqt7gmBJh0zhmLF3B', 'succeeded', '2025-06-25', NULL, '11', '2029', '2025-06-25 12:25:23', '2025-06-25 12:25:23'),
(41, 87353, 'ch_3Rdx5vLXqt7gmBJh0iZdMZk9', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 12:26:51', '2025-06-25 12:26:51'),
(42, 29358, 'ch_3Rdx89LXqt7gmBJh0veUWCuY', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 12:29:09', '2025-06-25 12:29:09'),
(43, 27456, 'ch_3Rdy0MLXqt7gmBJh1ArnYr81', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 13:25:11', '2025-06-25 13:25:11'),
(44, 26155, 'ch_3Rdy1kLXqt7gmBJh0acJ25lZ', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 13:26:35', '2025-06-25 13:26:35'),
(45, 96765, 'ch_3Rdy35LXqt7gmBJh0Hho5Flh', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 13:27:59', '2025-06-25 13:27:59'),
(46, 80084, 'ch_3Rdy4CLXqt7gmBJh0xYYYgCn', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 13:29:08', '2025-06-25 13:29:08'),
(47, 62916, 'ch_3Rdy5ILXqt7gmBJh07XhPxY1', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 13:30:16', '2025-06-25 13:30:16'),
(48, 38111, 'ch_3Rdy6kLXqt7gmBJh08Sw9NpU', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 13:31:46', '2025-06-25 13:31:46'),
(49, 32759, 'ch_3Rdy7zLXqt7gmBJh0aPd36mV', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 13:33:03', '2025-06-25 13:33:03'),
(50, 31912, 'ch_3Rdy9MLXqt7gmBJh0WyeQn5E', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 13:34:28', '2025-06-25 13:34:28'),
(51, 10710, 'ch_3RdyAULXqt7gmBJh1fIFrjTh', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 13:35:38', '2025-06-25 13:35:38'),
(52, 78419, 'ch_3RdyBZLXqt7gmBJh1Vt7ACuw', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 13:36:45', '2025-06-25 13:36:45'),
(53, 21793, 'ch_3RdyD5LXqt7gmBJh1fzp4O47', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 13:38:18', '2025-06-25 13:38:18'),
(54, 80124, 'ch_3RdyF0LXqt7gmBJh15ALbaw9', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 13:40:18', '2025-06-25 13:40:18'),
(55, 98835, 'ch_3RdyGULXqt7gmBJh0CNbUSql', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 13:41:49', '2025-06-25 13:41:49'),
(56, 38046, 'ch_3RdyHqLXqt7gmBJh0Bwgdwnt', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 13:43:14', '2025-06-25 13:43:14'),
(57, 25572, 'ch_3RdyJMLXqt7gmBJh1sgXkWEg', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 13:44:47', '2025-06-25 13:44:47'),
(58, 61052, 'ch_3RdyKwLXqt7gmBJh0nP3HqOC', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 13:46:26', '2025-06-25 13:46:26'),
(59, 38351, 'ch_3RdyMJLXqt7gmBJh1Xfccf6w', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 13:47:50', '2025-06-25 13:47:50'),
(60, 72421, 'ch_3RdyNfLXqt7gmBJh0qFV2CFX', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 13:49:14', '2025-06-25 13:49:14'),
(61, 45517, 'ch_3RdyOnLXqt7gmBJh172CJER6', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 13:50:25', '2025-06-25 13:50:25'),
(62, 66678, 'ch_3RdyQ8LXqt7gmBJh1IPNxguf', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 13:51:47', '2025-06-25 13:51:47'),
(63, 88579, 'ch_3RdyRNLXqt7gmBJh1NalrWFT', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 13:53:05', '2025-06-25 13:53:05'),
(64, 42570, 'ch_3RdySjLXqt7gmBJh1ic7ryeL', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 13:54:29', '2025-06-25 13:54:29'),
(65, 53874, 'ch_3RdyUHLXqt7gmBJh1nEJVQZc', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 13:56:05', '2025-06-25 13:56:05'),
(66, 58130, 'ch_3RdyWnLXqt7gmBJh0P1bBjz3', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 13:58:40', '2025-06-25 13:58:40'),
(67, 58235, 'ch_3RdzQgLXqt7gmBJh0vLgeoFQ', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 14:56:25', '2025-06-25 14:56:25'),
(68, 90019, 'ch_3RdzizLXqt7gmBJh1TVUoEqw', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 15:15:20', '2025-06-25 15:15:20'),
(69, 78990, 'ch_3RdzkGLXqt7gmBJh1x1B5ERX', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 15:16:39', '2025-06-25 15:16:39'),
(70, 92892, 'ch_3RdzlqLXqt7gmBJh0An2hclL', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 15:18:18', '2025-06-25 15:18:18'),
(71, 39675, 'ch_3RdznuLXqt7gmBJh11FnuCxu', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 15:20:25', '2025-06-25 15:20:25'),
(72, 72754, 'ch_3RdzoyLXqt7gmBJh196F4sU0', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 15:21:32', '2025-06-25 15:21:32'),
(73, 77866, 'ch_3RdzqALXqt7gmBJh1US0QRh5', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 15:22:46', '2025-06-25 15:22:46'),
(74, 28042, 'ch_3RdzrJLXqt7gmBJh1fxu9TPb', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 15:23:57', '2025-06-25 15:23:57'),
(75, 50259, 'ch_3RdzsRLXqt7gmBJh0Gbmto4T', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 15:25:07', '2025-06-25 15:25:07'),
(76, 65690, 'ch_3RdztXLXqt7gmBJh1zjeMOBN', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 15:26:14', '2025-06-25 15:26:14'),
(77, 83863, 'ch_3Re0GsLXqt7gmBJh1uKBF6PJ', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 15:50:22', '2025-06-25 15:50:22'),
(78, 17628, 'ch_3Re0KnLXqt7gmBJh0wA5k9IW', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 15:54:25', '2025-06-25 15:54:25'),
(79, 41273, 'ch_3Re0YELXqt7gmBJh0VrXlJ3H', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 16:08:18', '2025-06-25 16:08:18'),
(80, 30099, 'ch_3Re0dVLXqt7gmBJh0p8dEaRZ', 'succeeded', '2025-06-25', NULL, '11', '2029', '2025-06-25 16:13:45', '2025-06-25 16:13:45'),
(81, 84690, 'ch_3Re0kWLXqt7gmBJh0K8UazOj', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 16:21:00', '2025-06-25 16:21:00'),
(82, 25484, 'ch_3Re0lrLXqt7gmBJh0LduUcE1', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 16:22:23', '2025-06-25 16:22:23'),
(83, 42936, 'ch_3Re25OLXqt7gmBJh0T36EMMx', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 17:46:38', '2025-06-25 17:46:38'),
(84, 61665, 'ch_3Re26eLXqt7gmBJh1rI9rfyd', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 17:47:55', '2025-06-25 17:47:55'),
(85, 33144, 'ch_3Re28ZLXqt7gmBJh0PaDEfS0', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 17:49:54', '2025-06-25 17:49:54'),
(86, 67755, 'ch_3Re2AiLXqt7gmBJh1Lkw4o61', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 17:52:07', '2025-06-25 17:52:07'),
(87, 30375, 'ch_3Re2C1LXqt7gmBJh03cDtuHV', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 17:53:29', '2025-06-25 17:53:29'),
(88, 67174, 'ch_3Re2DDLXqt7gmBJh0BvqVaYE', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 17:54:43', '2025-06-25 17:54:43'),
(89, 16298, 'ch_3Re2QOLXqt7gmBJh0dlCYEfZ', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 18:08:17', '2025-06-25 18:08:17'),
(90, 85281, 'ch_3Re2UzLXqt7gmBJh1gf9SHQM', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 18:13:01', '2025-06-25 18:13:01'),
(91, 37774, 'ch_3Re2X8LXqt7gmBJh1bv6kefm', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 18:15:15', '2025-06-25 18:15:15'),
(92, 70378, 'ch_3Re2YTLXqt7gmBJh1J7hFhPb', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 18:16:38', '2025-06-25 18:16:38'),
(93, 87871, 'ch_3Re2aALXqt7gmBJh0uwkEhyp', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 18:18:23', '2025-06-25 18:18:23'),
(94, 27704, 'ch_3Re2bSLXqt7gmBJh1ke38WGm', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 18:19:43', '2025-06-25 18:19:43'),
(95, 65390, 'ch_3Re2dDLXqt7gmBJh1oPDzOyj', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 18:21:32', '2025-06-25 18:21:32'),
(96, 44367, 'ch_3Re2fCLXqt7gmBJh0ZTcKpKT', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 18:23:35', '2025-06-25 18:23:35'),
(97, 28146, 'ch_3Re2gVLXqt7gmBJh0rsw2pWQ', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 18:24:55', '2025-06-25 18:24:55'),
(98, 89104, 'ch_3Re2iOLXqt7gmBJh1Yo4TUie', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 18:26:52', '2025-06-25 18:26:52'),
(99, 71133, 'ch_3Re2khLXqt7gmBJh1a7pT3jq', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 18:29:16', '2025-06-25 18:29:16'),
(100, 99141, 'ch_3Re2mCLXqt7gmBJh1EvqXNVY', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 18:30:48', '2025-06-25 18:30:48'),
(101, 58033, 'ch_3Re2niLXqt7gmBJh0LMY9HHk', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 18:32:22', '2025-06-25 18:32:22'),
(102, 98350, 'ch_3Re2p7LXqt7gmBJh0YOtr6y7', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 18:33:49', '2025-06-25 18:33:49'),
(103, 50022, 'ch_3Re2qLLXqt7gmBJh1N5ACdwr', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 18:35:05', '2025-06-25 18:35:05'),
(104, 95185, 'ch_3Re2raLXqt7gmBJh1mcakqFe', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 18:36:23', '2025-06-25 18:36:23'),
(105, 47116, 'ch_3Re2sqLXqt7gmBJh1KL9Zfbr', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 18:37:40', '2025-06-25 18:37:40'),
(106, 78520, 'ch_3Re2zcLXqt7gmBJh1qDKLIk5', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 18:44:41', '2025-06-25 18:44:41'),
(107, 51177, 'ch_3Re31kLXqt7gmBJh0N735dD8', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 18:46:52', '2025-06-25 18:46:52'),
(108, 96482, 'ch_3Re32pLXqt7gmBJh0a5M1SKF', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 18:48:00', '2025-06-25 18:48:00'),
(109, 92525, 'ch_3Re33yLXqt7gmBJh0gAC3Wjh', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 18:49:11', '2025-06-25 18:49:11'),
(110, 63891, 'ch_3Re35CLXqt7gmBJh1eniFDJX', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 18:50:26', '2025-06-25 18:50:26'),
(111, 57009, 'ch_3Re36NLXqt7gmBJh07vMGVJ7', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 18:51:40', '2025-06-25 18:51:40'),
(112, 38804, 'ch_3Re37pLXqt7gmBJh17GIIVLY', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 18:53:09', '2025-06-25 18:53:09'),
(113, 61849, 'ch_3Re39lLXqt7gmBJh0tmp6TaS', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 18:55:09', '2025-06-25 18:55:09'),
(114, 51246, 'ch_3Re3BQLXqt7gmBJh1793JEOy', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 18:56:52', '2025-06-25 18:56:52'),
(115, 48716, 'ch_3Re3DPLXqt7gmBJh1tFFyH3D', 'succeeded', '2025-06-25', NULL, '11', '2026', '2025-06-25 18:58:56', '2025-06-25 18:58:56'),
(116, 19396, 'ch_3ReHuLLXqt7gmBJh0t9ZYLry', 'succeeded', '2025-06-26', NULL, '11', '2026', '2025-06-26 10:40:20', '2025-06-26 10:40:20'),
(117, 66582, 'ch_3ReHvQLXqt7gmBJh1TjxvdKI', 'succeeded', '2025-06-26', NULL, '11', '2026', '2025-06-26 10:41:25', '2025-06-26 10:41:25'),
(118, 75713, 'ch_3ReJNjLXqt7gmBJh0YZcT2o6', 'succeeded', '2025-06-26', NULL, '11', '2026', '2025-06-26 12:14:43', '2025-06-26 12:14:43'),
(119, 98172, 'ch_3ReJQaLXqt7gmBJh1Ew57725', 'succeeded', '2025-06-26', NULL, '11', '2026', '2025-06-26 12:17:40', '2025-06-26 12:17:40'),
(120, 65763, 'ch_3RfjyOLXqt7gmBJh1ZPWK58d', 'succeeded', '2025-06-30', NULL, '11', '2026', '2025-06-30 10:50:29', '2025-06-30 10:50:29');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `permission` varchar(255) DEFAULT NULL,
  `deleted_at` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `permission`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'permission-list', 'web', 'list', NULL, '2022-04-22 14:29:13', '2022-04-22 14:29:13'),
(2, 'permission-create', 'web', 'create', NULL, '2022-04-22 14:29:13', '2022-04-22 14:29:13'),
(3, 'permission-edit', 'web', 'edit', NULL, '2022-04-22 14:29:13', '2022-04-22 14:29:13'),
(4, 'permission-delete', 'web', 'delete', NULL, '2022-04-22 14:29:13', '2022-04-22 14:29:13'),
(5, 'role-list', 'web', 'list', NULL, '2022-04-22 14:29:41', '2022-04-22 14:29:41'),
(6, 'role-create', 'web', 'create', NULL, '2022-04-22 14:29:41', '2022-04-22 14:29:41'),
(7, 'role-edit', 'web', 'edit', NULL, '2022-04-22 14:29:41', '2022-04-22 14:29:41'),
(8, 'role-delete', 'web', 'delete', NULL, '2022-04-22 14:29:41', '2022-04-22 14:29:41'),
(13, 'property-list', 'web', 'list', NULL, '2022-04-22 14:31:18', '2022-04-22 14:31:18'),
(14, 'property-create', 'web', 'create', NULL, '2022-04-22 14:31:18', '2022-04-22 14:31:18'),
(15, 'property-edit', 'web', 'edit', NULL, '2022-04-22 14:31:18', '2022-04-22 14:31:18'),
(16, 'property-delete', 'web', 'delete', NULL, '2022-04-22 14:31:18', '2022-04-22 14:31:18'),
(17, 'blog-list', 'web', 'list', NULL, '2022-04-22 14:33:20', '2022-04-22 14:33:20'),
(18, 'blog-create', 'web', 'create', NULL, '2022-04-22 14:33:20', '2022-04-22 14:33:20'),
(19, 'blog-edit', 'web', 'edit', NULL, '2022-04-22 14:33:20', '2022-04-22 14:33:20'),
(20, 'blog-delete', 'web', 'delete', NULL, '2022-04-22 14:33:20', '2022-04-22 14:33:20'),
(25, 'testimonial-list', 'web', 'list', NULL, '2022-04-22 19:35:59', '2022-04-22 19:35:59'),
(26, 'testimonial-create', 'web', 'create', NULL, '2022-04-22 19:35:59', '2022-04-22 19:35:59'),
(27, 'testimonial-edit', 'web', 'edit', NULL, '2022-04-22 19:35:59', '2022-04-22 19:35:59'),
(28, 'testimonial-delete', 'web', 'delete', NULL, '2022-04-22 19:35:59', '2022-04-22 19:35:59'),
(37, 'gallery-list', 'web', 'list', NULL, '2022-04-26 15:59:02', '2022-04-26 15:59:02'),
(38, 'gallery-create', 'web', 'create', NULL, '2022-04-26 15:59:02', '2022-04-26 15:59:02'),
(39, 'gallery-edit', 'web', 'edit', NULL, '2022-04-26 15:59:02', '2022-04-26 15:59:02'),
(40, 'gallery-delete', 'web', 'delete', NULL, '2022-04-26 15:59:02', '2022-04-26 15:59:02'),
(41, 'about-list', 'web', 'list', NULL, '2022-04-27 15:28:41', '2022-04-27 15:28:41'),
(42, 'about-create', 'web', 'create', NULL, '2022-04-27 15:28:41', '2022-04-27 15:28:41'),
(43, 'about-edit', 'web', 'edit', NULL, '2022-04-27 15:28:41', '2022-04-27 15:28:41'),
(44, 'about-delete', 'web', 'delete', NULL, '2022-04-27 15:28:41', '2022-04-27 15:28:41'),
(49, 'page-list', 'web', 'list', NULL, '2022-04-28 20:12:47', '2022-04-28 20:12:47'),
(50, 'page-create', 'web', 'create', NULL, '2022-04-28 20:12:47', '2022-04-28 20:12:47'),
(51, 'page-edit', 'web', 'edit', NULL, '2022-04-28 20:12:47', '2022-04-28 20:12:47'),
(52, 'page-delete', 'web', 'delete', NULL, '2022-04-28 20:12:47', '2022-04-28 20:12:47'),
(53, 'newsletter-list', 'web', 'list', NULL, '2022-05-04 13:24:30', '2022-05-04 13:24:30'),
(54, 'newsletter-create', 'web', 'create', NULL, '2022-05-04 13:24:30', '2022-05-04 13:24:30'),
(55, 'newsletter-edit', 'web', 'edit', NULL, '2022-05-04 13:24:30', '2022-05-04 13:24:30'),
(56, 'newsletter-delete', 'web', 'delete', NULL, '2022-05-04 13:24:30', '2022-05-04 13:24:30'),
(57, 'categories-list', 'web', 'list', NULL, '2022-05-09 14:39:47', '2022-05-09 14:39:47'),
(58, 'categories-create', 'web', 'create', NULL, '2022-05-09 14:39:47', '2022-05-09 14:39:47'),
(59, 'categories-edit', 'web', 'edit', NULL, '2022-05-09 14:39:47', '2022-05-09 14:39:47'),
(60, 'categories-delete', 'web', 'delete', NULL, '2022-05-09 14:39:47', '2022-05-09 14:39:47'),
(61, 'deals-list', 'web', 'list', NULL, '2022-05-11 17:01:54', '2022-05-11 17:01:54'),
(62, 'deals-create', 'web', 'create', NULL, '2022-05-11 17:01:54', '2022-05-11 17:01:54'),
(63, 'deals-edit', 'web', 'edit', NULL, '2022-05-11 17:01:54', '2022-05-11 17:01:54'),
(64, 'deals-delete', 'web', 'delete', NULL, '2022-05-11 17:01:54', '2022-05-11 17:01:54'),
(69, 'product-list', 'web', 'list', NULL, '2022-05-17 16:31:54', '2022-05-17 16:31:54'),
(70, 'product-create', 'web', 'create', NULL, '2022-05-17 16:31:54', '2022-05-17 16:31:54'),
(71, 'product-edit', 'web', 'edit', NULL, '2022-05-17 16:31:54', '2022-05-17 16:31:54'),
(72, 'product-delete', 'web', 'delete', NULL, '2022-05-17 16:31:54', '2022-05-17 16:31:54'),
(77, 'career-list', 'web', 'list', NULL, '2022-05-20 11:36:04', '2022-05-20 11:36:04'),
(78, 'career-create', 'web', 'create', NULL, '2022-05-20 11:36:04', '2022-05-20 11:36:04'),
(79, 'career-edit', 'web', 'edit', NULL, '2022-05-20 11:36:04', '2022-05-20 11:36:04'),
(80, 'career-delete', 'web', 'delete', NULL, '2022-05-20 11:36:04', '2022-05-20 11:36:04'),
(81, 'contact-list', 'web', 'list', NULL, '2022-05-20 11:37:00', '2022-05-20 11:37:00'),
(82, 'contact-create', 'web', 'create', NULL, '2022-05-20 11:37:00', '2022-05-20 11:37:00'),
(83, 'contact-edit', 'web', 'edit', NULL, '2022-05-20 11:37:00', '2022-05-20 11:37:00'),
(84, 'contact-delete', 'web', 'delete', NULL, '2022-05-20 11:37:00', '2022-05-20 11:37:00'),
(85, 'contactus-list', 'web', 'list', NULL, '2022-05-20 11:38:06', '2022-05-20 11:38:06'),
(86, 'contactus-create', 'web', 'create', NULL, '2022-05-20 11:38:06', '2022-05-20 11:38:06'),
(87, 'contactus-edit', 'web', 'edit', NULL, '2022-05-20 11:38:06', '2022-05-20 11:38:06'),
(88, 'contactus-delete', 'web', 'delete', NULL, '2022-05-20 11:38:06', '2022-05-20 11:38:06'),
(89, 'faq-list', 'web', 'list', NULL, '2022-05-20 12:09:36', '2022-05-20 12:09:36'),
(90, 'faq-create', 'web', 'create', NULL, '2022-05-20 12:09:36', '2022-05-20 12:09:36'),
(91, 'faq-edit', 'web', 'edit', NULL, '2022-05-20 12:09:36', '2022-05-20 12:09:36'),
(92, 'faq-delete', 'web', 'delete', NULL, '2022-05-20 12:09:36', '2022-05-20 12:09:36'),
(93, 'banner-list', 'web', 'list', NULL, '2022-05-20 12:09:52', '2022-05-20 12:09:52'),
(94, 'banner-create', 'web', 'create', NULL, '2022-05-20 12:09:52', '2022-05-20 12:09:52'),
(95, 'banner-edit', 'web', 'edit', NULL, '2022-05-20 12:09:52', '2022-05-20 12:09:52'),
(96, 'banner-delete', 'web', 'delete', NULL, '2022-05-20 12:09:52', '2022-05-20 12:09:52'),
(97, 'booking-list', 'web', 'list', NULL, '2022-05-20 12:35:19', '2022-05-20 12:35:19'),
(98, 'booking-create', 'web', 'create', NULL, '2022-05-20 12:35:19', '2022-05-20 12:35:19'),
(99, 'booking-edit', 'web', 'edit', NULL, '2022-05-20 12:35:19', '2022-05-20 12:35:19'),
(100, 'booking-delete', 'web', 'delete', NULL, '2022-05-20 12:35:19', '2022-05-20 12:35:19'),
(101, 'appointment-list', 'web', 'list', NULL, '2022-05-26 22:54:26', '2022-05-26 22:54:26'),
(102, 'appointment-create', 'web', 'create', NULL, '2022-05-26 22:54:26', '2022-05-26 22:54:26'),
(103, 'appointment-edit', 'web', 'edit', NULL, '2022-05-26 22:54:26', '2022-05-26 22:54:26'),
(104, 'appointment-delete', 'web', 'delete', NULL, '2022-05-26 22:54:26', '2022-05-26 22:54:26'),
(105, 'user-list', 'web', 'list', NULL, '2022-06-06 16:59:05', '2022-06-06 16:59:05'),
(106, 'user-create', 'web', 'create', NULL, '2022-06-06 16:59:05', '2022-06-06 16:59:05'),
(107, 'user-edit', 'web', 'edit', NULL, '2022-06-06 16:59:05', '2022-06-06 16:59:05'),
(108, 'user-delete', 'web', 'delete', NULL, '2022-06-06 16:59:05', '2022-06-06 16:59:05'),
(109, 'our_location-list', 'web', 'list', NULL, '2022-06-11 00:06:27', '2022-06-11 00:06:27'),
(110, 'our_location-create', 'web', 'create', NULL, '2022-06-11 00:06:27', '2022-06-11 00:06:27'),
(111, 'our_location-edit', 'web', 'edit', NULL, '2022-06-11 00:06:27', '2022-06-11 00:06:27'),
(112, 'our_location-delete', 'web', 'delete', NULL, '2022-06-11 00:06:27', '2022-06-11 00:06:27'),
(129, 'properties_area-list', 'web', 'list', NULL, '2022-08-12 12:52:02', '2022-08-12 12:52:02'),
(130, 'properties_area-create', 'web', 'create', NULL, '2022-08-12 12:52:02', '2022-08-12 12:52:02'),
(131, 'properties_area-edit', 'web', 'edit', NULL, '2022-08-12 12:52:02', '2022-08-12 12:52:02'),
(132, 'properties_area-delete', 'web', 'delete', NULL, '2022-08-12 12:52:02', '2022-08-12 12:52:02'),
(133, 'category-list', 'web', 'list', NULL, '2024-06-28 13:06:09', '2024-06-28 13:06:09'),
(134, 'category-create', 'web', 'create', NULL, '2024-06-28 13:06:09', '2024-06-28 13:06:09'),
(135, 'category-edit', 'web', 'edit', NULL, '2024-06-28 13:06:09', '2024-06-28 13:06:09'),
(136, 'category-delete', 'web', 'delete', NULL, '2024-06-28 13:06:09', '2024-06-28 13:06:09'),
(137, 'services-list', 'web', 'list', NULL, '2024-06-28 14:42:44', '2024-06-28 14:42:44'),
(138, 'services-create', 'web', 'create', NULL, '2024-06-28 14:42:44', '2024-06-28 14:42:44'),
(139, 'services-edit', 'web', 'edit', NULL, '2024-06-28 14:42:44', '2024-06-28 14:42:44'),
(140, 'services-delete', 'web', 'delete', NULL, '2024-06-28 14:42:44', '2024-06-28 14:42:44'),
(141, 'package-list', 'web', 'list', NULL, '2024-07-01 11:51:27', '2024-07-01 11:51:27'),
(142, 'package-create', 'web', 'create', NULL, '2024-07-01 11:51:27', '2024-07-01 11:51:27'),
(143, 'package-edit', 'web', 'edit', NULL, '2024-07-01 11:51:27', '2024-07-01 11:51:27'),
(144, 'package-delete', 'web', 'delete', NULL, '2024-07-01 11:51:27', '2024-07-01 11:51:27'),
(173, 'concrete-list', 'web', 'list', NULL, '2024-07-26 19:28:56', '2024-07-26 19:28:56'),
(174, 'concrete-create', 'web', 'create', NULL, '2024-07-26 19:28:56', '2024-07-26 19:28:56'),
(175, 'concrete-edit', 'web', 'edit', NULL, '2024-07-26 19:28:56', '2024-07-26 19:28:56'),
(176, 'concrete-delete', 'web', 'delete', NULL, '2024-07-26 19:28:56', '2024-07-26 19:28:56'),
(177, 'construction-list', 'web', 'list', NULL, '2024-07-30 13:51:42', '2024-07-30 13:51:42'),
(178, 'construction-create', 'web', 'create', NULL, '2024-07-30 13:51:42', '2024-07-30 13:51:42'),
(179, 'construction-edit', 'web', 'edit', NULL, '2024-07-30 13:51:42', '2024-07-30 13:51:42'),
(197, 'advertisement-list', 'web', 'list', NULL, '2024-09-18 12:49:36', '2024-09-18 12:49:36'),
(198, 'advertisement-create', 'web', 'create', NULL, '2024-09-18 12:49:36', '2024-09-18 12:49:36'),
(199, 'advertisement-edit', 'web', 'edit', NULL, '2024-09-18 12:49:36', '2024-09-18 12:49:36'),
(200, 'advertisement-delete', 'web', 'delete', NULL, '2024-09-18 12:49:36', '2024-09-18 12:49:36'),
(205, 'homeslider-list', 'web', 'list', NULL, '2024-12-19 11:48:33', '2024-12-19 11:48:33'),
(206, 'homeslider-create', 'web', 'create', NULL, '2024-12-19 11:48:33', '2024-12-19 11:48:33'),
(207, 'homeslider-edit', 'web', 'edit', NULL, '2024-12-19 11:48:33', '2024-12-19 11:48:33'),
(208, 'homeslider-delete', 'web', 'delete', NULL, '2024-12-19 11:48:33', '2024-12-19 11:48:33'),
(209, 'our_sponsor-list', 'web', 'list', NULL, '2024-12-20 12:31:31', '2024-12-20 12:31:31'),
(210, 'our_sponsor-create', 'web', 'create', NULL, '2024-12-20 12:31:31', '2024-12-20 12:31:31'),
(211, 'our_sponsor-edit', 'web', 'edit', NULL, '2024-12-20 12:31:31', '2024-12-20 12:31:31'),
(212, 'our_sponsor-delete', 'web', 'delete', NULL, '2024-12-20 12:31:31', '2024-12-20 12:31:31'),
(229, 'project_category-list', 'web', 'list', NULL, '2025-02-06 18:00:51', '2025-02-06 18:00:51'),
(230, 'project_category-create', 'web', 'create', NULL, '2025-02-06 18:00:51', '2025-02-06 18:00:51'),
(231, 'project_category-edit', 'web', 'edit', NULL, '2025-02-06 18:00:51', '2025-02-06 18:00:51'),
(232, 'project_category-delete', 'web', 'delete', NULL, '2025-02-06 18:00:51', '2025-02-06 18:00:51'),
(233, 'projects-list', 'web', 'list', NULL, '2025-02-06 18:56:46', '2025-02-06 18:56:46'),
(234, 'projects-create', 'web', 'create', NULL, '2025-02-06 18:56:46', '2025-02-06 18:56:46'),
(235, 'projects-edit', 'web', 'edit', NULL, '2025-02-06 18:56:46', '2025-02-06 18:56:46'),
(236, 'projects-delete', 'web', 'delete', NULL, '2025-02-06 18:56:46', '2025-02-06 18:56:46'),
(237, 'documents-list', 'web', 'list', NULL, '2025-02-14 14:50:20', '2025-02-14 14:50:20'),
(238, 'documents-create', 'web', 'create', NULL, '2025-02-14 14:50:20', '2025-02-14 14:50:20'),
(239, 'documents-edit', 'web', 'edit', NULL, '2025-02-14 14:50:20', '2025-02-14 14:50:20'),
(240, 'documents-delete', 'web', 'delete', NULL, '2025-02-14 14:50:20', '2025-02-14 14:50:20'),
(241, 'delete-file', 'web', NULL, NULL, '2025-02-18 12:35:33', '2025-02-18 12:35:33'),
(242, 'member_directory-list', 'web', 'list', NULL, '2025-02-18 14:11:55', '2025-02-18 14:11:55'),
(243, 'member_directory-create', 'web', 'create', NULL, '2025-02-18 14:11:55', '2025-02-18 14:11:55'),
(244, 'member_directory-edit', 'web', 'edit', NULL, '2025-02-18 14:11:55', '2025-02-18 14:11:55'),
(245, 'member_directory-delete', 'web', 'delete', NULL, '2025-02-18 14:11:55', '2025-02-18 14:11:55'),
(246, 'jobpost-list', 'web', 'list', NULL, '2025-03-19 13:19:33', '2025-03-19 13:19:33'),
(247, 'jobpost-create', 'web', 'create', NULL, '2025-03-19 13:19:33', '2025-03-19 13:19:33'),
(248, 'jobpost-edit', 'web', 'edit', NULL, '2025-03-19 13:19:34', '2025-03-19 13:19:34'),
(249, 'jobpost-delete', 'web', 'delete', NULL, '2025-03-19 13:19:34', '2025-03-19 13:19:34'),
(250, 'jobcategory-list', 'web', 'list', NULL, '2025-05-08 18:51:58', '2025-05-08 18:51:58'),
(251, 'jobcategory-create', 'web', 'create', NULL, '2025-05-08 18:51:59', '2025-05-08 18:51:59'),
(252, 'jobcategory-edit', 'web', 'edit', NULL, '2025-05-08 18:51:59', '2025-05-08 18:51:59'),
(253, 'jobcategory-delete', 'web', 'delete', NULL, '2025-05-08 18:51:59', '2025-05-08 18:51:59'),
(258, 'meet_the_team-list', 'web', 'list', NULL, '2025-06-09 18:32:27', '2025-06-09 18:32:27'),
(259, 'meet_the_team-create', 'web', 'create', NULL, '2025-06-09 18:32:27', '2025-06-09 18:32:27'),
(260, 'meet_the_team-edit', 'web', 'edit', NULL, '2025-06-09 18:32:27', '2025-06-09 18:32:27'),
(261, 'meet_the_team-delete', 'web', 'delete', NULL, '2025-06-09 18:32:27', '2025-06-09 18:32:27'),
(262, 'client_contact-list', 'web', 'list', NULL, '2025-06-13 10:42:32', '2025-06-13 10:42:32'),
(263, 'client_contact-create', 'web', 'create', NULL, '2025-06-13 10:42:32', '2025-06-13 10:42:32'),
(264, 'client_contact-edit', 'web', 'edit', NULL, '2025-06-13 10:42:32', '2025-06-13 10:42:32'),
(265, 'client_contact-delete', 'web', 'delete', NULL, '2025-06-13 10:42:32', '2025-06-13 10:42:32'),
(274, 'event-list', 'web', 'list', NULL, '2025-06-18 17:14:05', '2025-06-18 17:14:05'),
(275, 'event-create', 'web', 'create', NULL, '2025-06-18 17:14:05', '2025-06-18 17:14:05'),
(276, 'event-edit', 'web', 'edit', NULL, '2025-06-18 17:14:05', '2025-06-18 17:14:05'),
(277, 'event-delete', 'web', 'delete', NULL, '2025-06-18 17:14:05', '2025-06-18 17:14:05'),
(278, 'trainer-list', 'web', 'list', NULL, '2025-07-02 13:04:07', '2025-07-02 13:04:07'),
(279, 'trainer-create', 'web', 'create', NULL, '2025-07-02 13:04:07', '2025-07-02 13:04:07'),
(280, 'trainer-edit', 'web', 'edit', NULL, '2025-07-02 13:04:07', '2025-07-02 13:04:07'),
(281, 'trainer-delete', 'web', 'delete', NULL, '2025-07-02 13:04:07', '2025-07-02 13:04:07'),
(282, 'blog_category-list', 'web', 'list', NULL, '2025-07-25 18:22:35', '2025-07-25 18:22:35'),
(283, 'blog_category-create', 'web', 'create', NULL, '2025-07-25 18:22:35', '2025-07-25 18:22:35'),
(284, 'blog_category-edit', 'web', 'edit', NULL, '2025-07-25 18:22:35', '2025-07-25 18:22:35'),
(285, 'blog_category-delete', 'web', 'delete', NULL, '2025-07-25 18:22:35', '2025-07-25 18:22:35');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `project_category_id` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`project_category_id`)),
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `county` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`county`)),
  `company` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `start_date` varchar(255) DEFAULT NULL,
  `end_date` varchar(255) DEFAULT NULL,
  `poc_name` varchar(255) DEFAULT NULL,
  `poc_phone` varchar(255) DEFAULT NULL,
  `poc_email` varchar(255) DEFAULT NULL,
  `key_links` mediumtext DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `file_names` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`file_names`)),
  `file_sizes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`file_sizes`)),
  `document_file` longtext DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending' COMMENT 'pending, approved, rejected',
  `rejection_reason` varchar(255) DEFAULT NULL,
  `deleted_at` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `created_by`, `project_category_id`, `name`, `description`, `county`, `company`, `image`, `start_date`, `end_date`, `poc_name`, `poc_phone`, `poc_email`, `key_links`, `size`, `file_names`, `file_sizes`, `document_file`, `status`, `rejection_reason`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 77, '[\"2\",\"7\",\"8\"]', 'Mercedes Higgins', 'Fugiat enim culpa v', '[\"Amelia\"]', 'Dunlap and Pace LLC', NULL, '2025-06-02', '2025-06-30', 'Shannon Nolan', '+1 (274) 352-2609', 'wezilogu@mailinator.com', 'https://www.ferohycorumid.me.uk', '33.73 KB', '[\"SCVBA_Project_Hub_Dashboard_Changes_May_23 (3).docx\",\"SCVBA_Project_Hub_Dashboard_Changes_May_23 (2).docx\"]', '[17271,17271]', '[\"SCVBA_Project_Hub_Dashboard_Changes_May_23 (3).docx\",\"SCVBA_Project_Hub_Dashboard_Changes_May_23 (2).docx\"]', 'rejected', 'this is not good', NULL, '2025-06-02 12:07:19', '2025-06-02 12:58:01'),
(2, 77, '[\"1\",\"2\",\"3\"]', 'Wynter Riggs', 'Qui maxime enim veli', '[\"Amelia\",\"Appomattox\",\"Campbell\"]', 'Mccarty Henderson Plc', NULL, '2025-06-02', '2025-06-30', 'Myra Church', '+1 (689) 241-9301', 'tijodyv@mailinator.com', 'https://www.waruqajilepuki.info', '33.73 KB', '[\"SCVBA_Project_Hub_Dashboard_Changes_May_23 (3).docx\",\"SCVBA_Project_Hub_Dashboard_Changes_May_23 (2).docx\"]', '[17271,17271]', '[\"SCVBA_Project_Hub_Dashboard_Changes_May_23 (3).docx\",\"SCVBA_Project_Hub_Dashboard_Changes_May_23 (2).docx\"]', 'pending', NULL, NULL, '2025-06-02 13:15:11', '2025-06-02 13:15:11'),
(3, 77, '[\"4\",\"5\",\"6\"]', 'Nyssa Ingram', 'Id quas consequat U', '[\"Brunswick\",\"Campbell\"]', 'Thomas Lancaster Co', NULL, '2025-06-21', '2025-06-30', 'Madison Taylor', '+1 (107) 169-5525', 'juqyq@mailinator.com', 'https://www.sopegogewewek.org', '48.53 KB', '[\"SCVBA_Project_Hub_Dashboard_Changes_May_23 (3).docx\",\"SCVBA_Project_Hub_Dashboard_Changes_May_23 (2).docx\",\"-Project Hub.pdf\"]', '[17271,17271,15156]', '[\"SCVBA_Project_Hub_Dashboard_Changes_May_23 (3).docx\",\"SCVBA_Project_Hub_Dashboard_Changes_May_23 (2).docx\",\"-Project Hub.pdf\"]', 'pending', NULL, NULL, '2025-06-02 13:33:17', '2025-06-02 13:33:17'),
(4, 77, '[\"3\",\"4\",\"5\"]', 'Curran Yang', 'Enim asperiores volu', '[\"Amelia\",\"Appomattox\"]', 'Mcgee Beck Co', NULL, '2025-06-20', '2025-06-30', 'Todd Glover', '+1 (715) 544-4418', 'doxaqovu@mailinator.com', 'https://www.xaxe.co.uk', '48.53 KB', '[\"SCVBA_Project_Hub_Dashboard_Changes_May_23 (3).docx\",\"SCVBA_Project_Hub_Dashboard_Changes_May_23 (2).docx\",\"-Project Hub.pdf\"]', '[17271,17271,15156]', '[\"SCVBA_Project_Hub_Dashboard_Changes_May_23 (3).docx\",\"SCVBA_Project_Hub_Dashboard_Changes_May_23 (2).docx\",\"-Project Hub.pdf\"]', 'pending', NULL, NULL, '2025-06-02 13:33:51', '2025-06-02 13:33:51'),
(5, 77, '[\"1\",\"2\"]', 'Jamalia Bowen', 'Enim id optio dese', '[\"Brunswick\",\"Campbell\",\"Charlotte\"]', 'Hewitt Stephenson Associates', NULL, '2025-06-02', '2025-06-23', 'Emily Harrell', '+1 (436) 288-8583', 'satazos@mailinator.com', 'https://www.vuzihyxicumila.com', '16.87 KB', '[\"SCVBA_Project_Hub_Dashboard_Changes_May_23 (3).docx\"]', '[17271]', '[\"SCVBA_Project_Hub_Dashboard_Changes_May_23 (3).docx\"]', 'pending', NULL, NULL, '2025-06-02 13:34:20', '2025-06-02 13:34:20'),
(6, 77, '[\"2\",\"3\"]', 'Ann Moreno', 'Consequatur consequa', '[\"Amelia\",\"Appomattox\"]', 'Sampson Schultz Inc', NULL, '2025-06-04', '2025-06-25', 'Dominic Nixon', '+1 (475) 374-7525', 'doxuqow@mailinator.com', 'https://www.cocafasimavuc.info', '33.73 KB', '[\"SCVBA_Project_Hub_Dashboard_Changes_May_23 (3).docx\",\"SCVBA_Project_Hub_Dashboard_Changes_May_23 (2).docx\"]', '[17271,17271]', '[\"SCVBA_Project_Hub_Dashboard_Changes_May_23 (3).docx\",\"SCVBA_Project_Hub_Dashboard_Changes_May_23 (2).docx\"]', 'pending', NULL, NULL, '2025-06-02 13:34:49', '2025-06-02 13:34:49'),
(7, 77, '[\"3\",\"4\",\"5\"]', 'Julie Barron', 'Quia non eiusmod quo', '[\"Amelia\"]', 'Ferrell Higgins Co', NULL, '2025-06-03', '2025-06-30', 'Carson Goff', '+1 (448) 653-7062', 'tejuciwuse@mailinator.com', 'https://www.wih.cc', '48.53 KB', '[\"SCVBA_Project_Hub_Dashboard_Changes_May_23 (3).docx\",\"SCVBA_Project_Hub_Dashboard_Changes_May_23 (2).docx\",\"-Project Hub.pdf\"]', '[17271,17271,15156]', '[\"SCVBA_Project_Hub_Dashboard_Changes_May_23 (3).docx\",\"SCVBA_Project_Hub_Dashboard_Changes_May_23 (2).docx\",\"-Project Hub.pdf\"]', 'pending', NULL, NULL, '2025-06-02 13:35:18', '2025-06-02 13:35:18'),
(8, 77, '[\"3\",\"4\",\"5\"]', 'Kasper Richard', 'Veritatis reprehende', '[\"Amelia\"]', 'Page and Pearson LLC', NULL, '2025-06-03', '2025-06-23', 'Davis Mcdonald', '+1 (708) 788-5513', 'xijitiwamy@mailinator.com', '[{\"url\":\"https:\\/\\/www.google.com\\/\",\"label\":\"1\"},{\"url\":\"https:\\/\\/www.google.com\\/\",\"label\":\"2\"},{\"url\":\"https:\\/\\/www.google.com\\/\",\"label\":\"3\"},{\"url\":\"https:\\/\\/www.google.com\\/\",\"label\":\"4\"},{\"url\":\"https:\\/\\/www.google.com\\/\",\"label\":\"5\"},{\"url\":\"https:\\/\\/www.google.com\\/\",\"label\":\"6\"},{\"url\":\"https:\\/\\/www.google.com\\/\",\"label\":\"7\"},{\"url\":\"https:\\/\\/www.google.com\\/\",\"label\":\"8\"},{\"url\":\"https:\\/\\/www.google.com\\/\",\"label\":\"9\"},{\"url\":\"https:\\/\\/www.google.com\\/\",\"label\":\"10\"}]', '31.67 KB', '[\"-Project Hub (1).pdf\",\"SCVBA_Project_Hub_Dashboard_Changes_May_23 (3).docx\"]', '[15156,17271]', '[\"-Project Hub (1).pdf\",\"SCVBA_Project_Hub_Dashboard_Changes_May_23 (3).docx\"]', 'pending', NULL, NULL, '2025-06-02 13:35:49', '2025-06-12 11:28:14'),
(9, 77, '[\"12\"]', 'Project XYZ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '[\"Prince Edward\"]', 'Carey and Alford LLC', '20250611171738.jpg', '2025-06-03', '2025-06-25', 'Ariel Solomon', '+1 (258) 607-3367', 'jiwidu@mailinator.com', '[{\"url\":null,\"label\":null}]', '33.73 KB', '[\"SCVBA_Project_Hub_Dashboard_Changes_May_23 (3).docx\",\"SCVBA_Project_Hub_Dashboard_Changes_May_23 (2).docx\"]', '[17271,17271]', '[\"SCVBA_Project_Hub_Dashboard_Changes_May_23 (3).docx\",\"SCVBA_Project_Hub_Dashboard_Changes_May_23 (2).docx\"]', 'approved', NULL, NULL, '2025-06-02 13:36:26', '2025-06-11 12:39:39'),
(10, 77, '[\"5\"]', 'Project DEF', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '[\"Chesterfield\",\"Campbell\"]', 'Contreras and Singleton Plc', '20250611171107.jpg', '2025-06-02', '2025-06-30', 'Hamilton Hayden', '+1 (367) 669-5295', 'becodo@mailinator.com', '[{\"url\":null,\"label\":null}]', '46.47 KB', '[\"-Project Hub (1) (1).pdf\",\"-Project Hub (1).pdf\",\"SCVBA_Project_Hub_Dashboard_Changes_May_23 (3).docx\"]', '[15156,15156,17271]', '[\"-Project Hub (1) (1).pdf\",\"-Project Hub (1).pdf\",\"SCVBA_Project_Hub_Dashboard_Changes_May_23 (3).docx\"]', 'approved', NULL, NULL, '2025-06-02 13:37:05', '2025-06-11 12:39:25'),
(11, 77, '[\"11\"]', 'Project ABC', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '[\"Amelia\",\"Appomattox\"]', 'Underwood Avila Associates', '20250611171552.jpg', '2025-06-03', '2025-06-25', 'Travis Carney', '+1 (294) 513-4335', 'navywab@mailinator.com', '[{\"url\":null,\"label\":null}]', '33.73 KB', '[\"SCVBA_Project_Hub_Dashboard_Changes_May_23 (3).docx\",\"SCVBA_Project_Hub_Dashboard_Changes_May_23 (2).docx\"]', '[17271,17271]', '[\"SCVBA_Project_Hub_Dashboard_Changes_May_23 (3).docx\",\"SCVBA_Project_Hub_Dashboard_Changes_May_23 (2).docx\",\"hubnotes-6-8.pdf\",\"NFA_Custom_feedback_and_fixes_june_2 (1).docx\",\"SCVBA_Project_Hub_Dashboard_Changes_May_23 (4).docx\"]', 'approved', NULL, NULL, '2025-06-02 13:37:37', '2025-06-11 12:39:05'),
(12, 1, '[\"1\",\"2\",\"3\"]', 'Hilel Riddle', 'testing', '[\"Amelia\",\"Brunswick\"]', 'test', '20250603161232.jpg', '2025-06-03', '2025-06-30', 'Hilel Riddle', '5574475582', 'kisiximuq@mailinator.com', NULL, '33.73 KB', '[\"SCVBA_Project_Hub_Dashboard_Changes_May_23 (3).docx\",\"SCVBA_Project_Hub_Dashboard_Changes_May_23 (2).docx\"]', '[17271,17271]', '[\"SCVBA_Project_Hub_Dashboard_Changes_May_23 (3).docx\",\"SCVBA_Project_Hub_Dashboard_Changes_May_23 (2).docx\"]', 'pending', NULL, '2025-06-11 17:16:10', '2025-06-03 11:12:32', '2025-06-11 12:16:10'),
(13, 1, '[\"1\",\"3\"]', 'Oren Davidson', 'Laboris cupiditate q', '[\"Amelia\",\"Appomattox\"]', 'Blackwell Gentry Associates', '20250610214828.jpg', '2025-06-11', '2025-06-30', 'Rigel Morrison', '+1 (648) 243-8707', 'komow@mailinator.com', '[{\"url\":null,\"label\":null},{\"url\":\"https:\\/\\/www.banal.info\",\"label\":\"Deleniti dolore ut i\"},{\"url\":\"https:\\/\\/www.nymozu.org.uk\",\"label\":\"safasdfa sadf\"}]', '46.47 KB', '[\"-Project Hub (1) (1).pdf\",\"-Project Hub (1).pdf\",\"SCVBA_Project_Hub_Dashboard_Changes_May_23 (3).docx\"]', '[15156,15156,17271]', '[\"-Project Hub (1) (1).pdf\",\"-Project Hub (1).pdf\",\"SCVBA_Project_Hub_Dashboard_Changes_May_23 (3).docx\"]', 'pending', NULL, '2025-06-11 17:16:13', '2025-06-10 16:48:28', '2025-06-11 12:16:13'),
(14, 1, '[\"2\",\"4\"]', 'Tobias Key', 'Nam et assumenda vol', '[\"Appomattox\",\"Campbell\",\"Charlotte\"]', 'Suarez Pitts Trading', '20250610222235.jpg', '2025-06-11', '2025-06-30', 'Sandra Cabrera', '+1 (173) 986-2601', 'kelago@mailinator.com', '[{\"url\":null,\"label\":null}]', '0 bytes', NULL, NULL, NULL, 'pending', NULL, '2025-06-10 22:22:49', '2025-06-10 17:22:35', '2025-06-10 17:22:49'),
(15, 101, '[\"18\"]', 'Martina Alston', 'Perspiciatis omnis', '[\"Appomattox\"]', 'Cherry Contreras Inc', '20250616182841.jpg', '2025-06-15', '2025-06-30', 'Aubrey Hayes', '+1 (141) 981-4291', 'tydulahe@mailinator.com', '[{\"url\":\"https:\\/\\/www.puxyxokokohole.us\",\"label\":\"Suscipit eligendi si\"}]', '63.33 KB', '[\"-Project Hub (1).pdf\",\"SCVBA_Project_Hub_Dashboard_Changes_May_23 (3).docx\",\"SCVBA_Project_Hub_Dashboard_Changes_May_23 (2).docx\",\"-Project Hub.pdf\"]', '[15156,17271,17271,15156]', '[\"-Project Hub (1).pdf\",\"SCVBA_Project_Hub_Dashboard_Changes_May_23 (3).docx\",\"SCVBA_Project_Hub_Dashboard_Changes_May_23 (2).docx\",\"-Project Hub.pdf\"]', 'approved', NULL, NULL, '2025-06-16 13:28:41', '2025-06-16 13:29:24');

-- --------------------------------------------------------

--
-- Table structure for table `project_categories`
--

CREATE TABLE `project_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `parent_id` varchar(255) DEFAULT NULL COMMENT '0=no parent',
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1' COMMENT '0=inactive, 1= active',
  `deleted_at` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_categories`
--

INSERT INTO `project_categories` (`id`, `created_by`, `parent_id`, `title`, `slug`, `image`, `description`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, '0', 'Aerial Imaging', 'aerial-imaging', NULL, NULL, '1', NULL, '2025-05-23 15:51:53', '2025-05-23 15:51:53'),
(2, 1, '0', 'Agricultural Materials Supply', 'agricultural-materials-supply', NULL, NULL, '1', NULL, '2025-05-23 15:52:07', '2025-05-23 15:52:07'),
(3, 1, '0', 'Agriculture & Landscaping Services', 'agriculture-landscaping-services', NULL, NULL, '1', NULL, '2025-05-23 15:52:19', '2025-05-23 15:52:19'),
(4, 1, '0', 'Electrical Contractors', 'electrical-contractors', NULL, NULL, '1', NULL, '2025-05-23 15:52:31', '2025-05-23 15:52:31'),
(5, 1, '0', 'Energy Development', 'energy-development', NULL, NULL, '1', NULL, '2025-05-23 15:52:44', '2025-05-23 15:52:44'),
(6, 1, '0', 'Engineering & Procurement & Construction', 'engineering-procurement-construction', NULL, NULL, '1', NULL, '2025-05-23 15:52:55', '2025-05-23 15:52:55'),
(7, 1, '0', 'Environmental Services', 'environmental-services', NULL, NULL, '1', NULL, '2025-05-23 15:53:19', '2025-05-23 15:53:19'),
(8, 1, '0', 'Equipment Rental & Maintenance', 'equipment-rental-maintenance', NULL, NULL, '1', NULL, '2025-05-23 15:53:31', '2025-05-23 15:53:31'),
(9, 1, '0', 'Excavating & Civil Works', 'excavating-civil-works', NULL, NULL, '1', NULL, '2025-05-23 15:53:40', '2025-05-23 15:53:40'),
(10, 1, '0', 'Food & Lodging Services', 'food-lodging-services', NULL, NULL, '1', NULL, '2025-05-23 15:53:49', '2025-05-23 15:53:49'),
(11, 1, '0', 'General Construction', 'general-construction', NULL, NULL, '1', NULL, '2025-05-23 15:54:00', '2025-05-23 15:54:00'),
(12, 1, '0', 'Information Technology', 'information-technology', NULL, NULL, '1', NULL, '2025-05-23 15:54:09', '2025-05-23 15:54:09'),
(13, 1, '0', 'Land Clearing & Logging', 'land-clearing-logging', NULL, NULL, '1', NULL, '2025-05-23 15:54:21', '2025-05-23 15:54:21'),
(14, 1, '0', 'Material & Construction Supplies', 'material-construction-supplies', NULL, NULL, '1', NULL, '2025-05-23 15:54:31', '2025-05-23 15:54:31'),
(15, 1, '0', 'Non-Profit', 'non-profit', NULL, NULL, '1', NULL, '2025-05-23 15:54:46', '2025-05-23 15:54:46'),
(16, 1, '0', 'Professional Goods & Services', 'professional-goods-services', NULL, NULL, '1', NULL, '2025-05-23 15:54:56', '2025-05-23 15:54:56'),
(17, 1, '0', 'Real Estate Services', 'real-estate-services', NULL, NULL, '1', NULL, '2025-05-23 15:55:07', '2025-05-23 15:55:07'),
(18, 1, '0', 'Site Security', 'site-security', NULL, NULL, '1', NULL, '2025-05-23 15:55:16', '2025-05-23 15:55:16'),
(19, 1, '0', 'Trucking & Hauling', 'trucking-hauling', NULL, NULL, '1', NULL, '2025-05-23 15:55:28', '2025-05-23 15:55:28'),
(20, 1, '0', 'Waste & Recycling Services', 'waste-recycling-services', NULL, NULL, '1', NULL, '2025-05-23 15:55:38', '2025-05-23 15:55:38');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `deleted_at` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `description`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', 'Admin Role Permissions', NULL, '2022-04-06 14:41:39', '2024-07-10 13:27:58'),
(2, 'trainer', 'web', 'Trainer Role Permissions', NULL, '2022-04-22 14:46:54', '2024-07-10 13:28:47'),
(5, 'customer', 'web', 'Customer Role Permissions', NULL, '2025-05-07 19:38:04', '2025-05-07 19:40:02');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(49, 1),
(49, 2),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(88, 1),
(89, 1),
(90, 1),
(91, 1),
(92, 1),
(93, 1),
(94, 1),
(95, 1),
(96, 1),
(97, 1),
(98, 1),
(98, 2),
(99, 1),
(99, 2),
(100, 1),
(101, 1),
(102, 1),
(103, 1),
(104, 1),
(105, 1),
(105, 2),
(106, 1),
(107, 1),
(108, 1),
(111, 1),
(129, 1),
(130, 1),
(131, 1),
(132, 1),
(133, 1),
(134, 1),
(135, 1),
(136, 1),
(137, 1),
(138, 1),
(139, 1),
(140, 1),
(141, 1),
(142, 1),
(143, 1),
(144, 1),
(173, 1),
(173, 2),
(176, 1),
(177, 1),
(177, 2),
(197, 1),
(197, 2),
(198, 1),
(198, 2),
(199, 1),
(199, 2),
(200, 1),
(200, 2),
(205, 1),
(206, 1),
(207, 1),
(208, 1),
(209, 1),
(210, 1),
(211, 1),
(212, 1),
(229, 1),
(230, 1),
(231, 1),
(232, 1),
(233, 1),
(233, 5),
(234, 1),
(235, 1),
(236, 1),
(237, 1),
(238, 1),
(239, 1),
(240, 1),
(241, 1),
(242, 1),
(242, 5),
(243, 1),
(243, 5),
(244, 1),
(244, 5),
(245, 1),
(245, 5),
(246, 1),
(246, 5),
(247, 1),
(248, 1),
(249, 1),
(250, 1),
(251, 1),
(252, 1),
(253, 1),
(258, 1),
(259, 1),
(260, 1),
(261, 1),
(274, 1),
(275, 1),
(276, 1),
(277, 1),
(278, 1),
(278, 2),
(279, 1),
(279, 2),
(280, 1),
(280, 2),
(281, 1),
(281, 2),
(282, 1),
(283, 1),
(284, 1),
(285, 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `photo_logo` varchar(255) DEFAULT NULL,
  `photo_favicon` varchar(255) DEFAULT NULL,
  `top_bar_email` varchar(255) DEFAULT NULL,
  `top_bar_phone` varchar(255) DEFAULT NULL,
  `footer_col1_title` varchar(255) DEFAULT NULL,
  `footer_col2_title` varchar(255) DEFAULT NULL,
  `footer_col3_title` varchar(255) DEFAULT NULL,
  `footer_col4_title` varchar(255) DEFAULT NULL,
  `footer_copyright` longtext DEFAULT NULL,
  `footer_address` longtext DEFAULT NULL,
  `footer_email` varchar(255) DEFAULT NULL,
  `footer_phone` varchar(255) DEFAULT NULL,
  `footer_recent_news_item` varchar(255) DEFAULT NULL,
  `footer_recent_portfolio_item` longtext DEFAULT NULL,
  `newsletter_text` longtext DEFAULT NULL,
  `cta_text` varchar(255) DEFAULT NULL,
  `cta_button_text` longtext DEFAULT NULL,
  `cta_button_url` longtext DEFAULT NULL,
  `cta_background_photo` varchar(255) DEFAULT NULL,
  `send_email_from` varchar(255) DEFAULT NULL,
  `receive_email_to` varchar(255) DEFAULT NULL,
  `photo1` varchar(255) DEFAULT NULL,
  `photo2` varchar(255) DEFAULT NULL,
  `photo3` varchar(255) DEFAULT NULL,
  `photo4` varchar(255) DEFAULT NULL,
  `photo5` varchar(255) DEFAULT NULL,
  `photo6` varchar(255) DEFAULT NULL,
  `photo7` varchar(255) DEFAULT NULL,
  `photo8` varchar(255) DEFAULT NULL,
  `photo9` varchar(255) DEFAULT NULL,
  `photo10` varchar(255) DEFAULT NULL,
  `photo11` varchar(255) DEFAULT NULL,
  `photo12` varchar(255) DEFAULT NULL,
  `photo13` varchar(255) DEFAULT NULL,
  `photo14` varchar(255) DEFAULT NULL,
  `photo15` varchar(255) DEFAULT NULL,
  `sidebar_total_recent_post` varchar(255) DEFAULT NULL,
  `sidebar_news_heading_category` varchar(255) DEFAULT NULL,
  `sidebar_news_heading_recent_post` varchar(255) DEFAULT NULL,
  `sidebar_total_upcoming_event` varchar(255) DEFAULT NULL,
  `sidebar_total_past_event` varchar(255) DEFAULT NULL,
  `sidebar_event_heading_upcoming` varchar(255) DEFAULT NULL,
  `sidebar_event_heading_past` varchar(255) DEFAULT NULL,
  `sidebar_service_heading_service` varchar(255) DEFAULT NULL,
  `sidebar_service_heading_quick_contact` varchar(255) DEFAULT NULL,
  `sidebar_portfolio_heading_project_detail` varchar(255) DEFAULT NULL,
  `sidebar_portfolio_heading_quick_contact` varchar(255) DEFAULT NULL,
  `front_end_color` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `city_id` bigint(20) NOT NULL,
  `state` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `city_id`, `state`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'New York', 1, '2022-05-19 12:26:17', '2022-05-19 12:26:17'),
(2, 1, 'Buffalo', 1, '2022-05-19 12:26:17', '2022-05-19 12:26:17'),
(3, 1, 'Rochester', 1, '2022-05-19 12:26:18', '2022-05-19 12:26:18'),
(4, 1, 'Yonkers', 1, '2022-05-19 12:26:18', '2022-05-19 12:26:18'),
(5, 1, 'Syracuse', 1, '2022-05-19 12:26:18', '2022-05-19 12:26:18'),
(6, 1, 'Albany', 1, '2022-05-19 12:26:18', '2022-05-19 12:26:18'),
(7, 1, 'New Rochelle', 1, '2022-05-19 12:26:18', '2022-05-19 12:26:18'),
(8, 1, 'Mount Vernon', 1, '2022-05-19 12:26:18', '2022-05-19 12:26:18'),
(9, 1, 'Schenectady', 1, '2022-05-19 12:26:18', '2022-05-19 12:26:18'),
(10, 1, 'Utica', 1, '2022-05-19 12:26:18', '2022-05-19 12:26:18'),
(11, 1, 'White Plains', 1, '2022-05-19 12:26:18', '2022-05-19 12:26:18'),
(12, 1, 'Hempstead', 1, '2022-05-19 12:26:18', '2022-05-19 12:26:18'),
(13, 1, 'Troy', 1, '2022-05-19 12:26:18', '2022-05-19 12:26:18'),
(14, 1, 'Niagara Falls', 1, '2022-05-19 12:26:18', '2022-05-19 12:26:18'),
(15, 1, 'Binghamton', 1, '2022-05-19 12:26:18', '2022-05-19 12:26:18'),
(16, 1, 'Freeport', 1, '2022-05-19 12:26:18', '2022-05-19 12:26:18'),
(17, 1, 'Valley Stream', 1, '2022-05-19 12:26:18', '2022-05-19 12:26:18'),
(18, 2, 'Los Angeles', 1, '2022-05-19 12:26:18', '2022-05-19 12:26:18'),
(19, 2, 'San Diego', 1, '2022-05-19 12:26:18', '2022-05-19 12:26:18'),
(20, 2, 'San Jose', 1, '2022-05-19 12:26:18', '2022-05-19 12:26:18'),
(21, 2, 'San Francisco', 1, '2022-05-19 12:26:18', '2022-05-19 12:26:18'),
(22, 2, 'Fresno', 1, '2022-05-19 12:26:18', '2022-05-19 12:26:18'),
(23, 2, 'Sacramento', 1, '2022-05-19 12:26:19', '2022-05-19 12:26:19'),
(24, 2, 'Long Beach', 1, '2022-05-19 12:26:19', '2022-05-19 12:26:19'),
(25, 2, 'Oakland', 1, '2022-05-19 12:26:19', '2022-05-19 12:26:19'),
(26, 2, 'Bakersfield', 1, '2022-05-19 12:26:19', '2022-05-19 12:26:19'),
(27, 2, 'Anaheim', 1, '2022-05-19 12:26:19', '2022-05-19 12:26:19'),
(28, 2, 'Santa Ana', 1, '2022-05-19 12:26:19', '2022-05-19 12:26:19'),
(29, 2, 'Riverside', 1, '2022-05-19 12:26:19', '2022-05-19 12:26:19'),
(30, 2, 'Stockton', 1, '2022-05-19 12:26:19', '2022-05-19 12:26:19'),
(31, 2, 'Chula Vista', 1, '2022-05-19 12:26:19', '2022-05-19 12:26:19'),
(32, 2, 'Irvine', 1, '2022-05-19 12:26:19', '2022-05-19 12:26:19'),
(33, 2, 'Fremont', 1, '2022-05-19 12:26:19', '2022-05-19 12:26:19'),
(34, 2, 'San Bernardino', 1, '2022-05-19 12:26:19', '2022-05-19 12:26:19'),
(35, 2, 'Modesto', 1, '2022-05-19 12:26:19', '2022-05-19 12:26:19'),
(36, 2, 'Fontana', 1, '2022-05-19 12:26:19', '2022-05-19 12:26:19'),
(37, 2, 'Oxnard', 1, '2022-05-19 12:26:19', '2022-05-19 12:26:19'),
(38, 2, 'Moreno Valley', 1, '2022-05-19 12:26:19', '2022-05-19 12:26:19'),
(39, 2, 'Huntington Beach', 1, '2022-05-19 12:26:20', '2022-05-19 12:26:20'),
(40, 2, 'Glendale', 1, '2022-05-19 12:26:20', '2022-05-19 12:26:20'),
(41, 2, 'Santa Clarita', 1, '2022-05-19 12:26:20', '2022-05-19 12:26:20'),
(42, 2, 'Garden Grove', 1, '2022-05-19 12:26:20', '2022-05-19 12:26:20'),
(43, 2, 'Oceanside', 1, '2022-05-19 12:26:20', '2022-05-19 12:26:20'),
(44, 2, 'Rancho Cucamonga', 1, '2022-05-19 12:26:20', '2022-05-19 12:26:20'),
(45, 2, 'Santa Rosa', 1, '2022-05-19 12:26:20', '2022-05-19 12:26:20'),
(46, 2, 'Ontario', 1, '2022-05-19 12:26:20', '2022-05-19 12:26:20'),
(47, 2, 'Lancaster', 1, '2022-05-19 12:26:20', '2022-05-19 12:26:20'),
(48, 2, 'Elk Grove', 1, '2022-05-19 12:26:20', '2022-05-19 12:26:20'),
(49, 2, 'Corona', 1, '2022-05-19 12:26:20', '2022-05-19 12:26:20'),
(50, 2, 'Palmdale', 1, '2022-05-19 12:26:20', '2022-05-19 12:26:20'),
(51, 2, 'Salinas', 1, '2022-05-19 12:26:20', '2022-05-19 12:26:20'),
(52, 2, 'Pomona', 1, '2022-05-19 12:26:20', '2022-05-19 12:26:20'),
(53, 2, 'Hayward', 1, '2022-05-19 12:26:20', '2022-05-19 12:26:20'),
(54, 2, 'Escondido', 1, '2022-05-19 12:26:20', '2022-05-19 12:26:20'),
(55, 2, 'Torrance', 1, '2022-05-19 12:26:20', '2022-05-19 12:26:20'),
(56, 2, 'Sunnyvale', 1, '2022-05-19 12:26:20', '2022-05-19 12:26:20'),
(57, 2, 'Orange', 1, '2022-05-19 12:26:20', '2022-05-19 12:26:20'),
(58, 2, 'Fullerton', 1, '2022-05-19 12:26:21', '2022-05-19 12:26:21'),
(59, 2, 'Pasadena', 1, '2022-05-19 12:26:21', '2022-05-19 12:26:21'),
(60, 2, 'Thousand Oaks', 1, '2022-05-19 12:26:21', '2022-05-19 12:26:21'),
(61, 2, 'Visalia', 1, '2022-05-19 12:26:21', '2022-05-19 12:26:21'),
(62, 2, 'Simi Valley', 1, '2022-05-19 12:26:21', '2022-05-19 12:26:21'),
(63, 2, 'Concord', 1, '2022-05-19 12:26:21', '2022-05-19 12:26:21'),
(64, 2, 'Roseville', 1, '2022-05-19 12:26:21', '2022-05-19 12:26:21'),
(65, 2, 'Victorville', 1, '2022-05-19 12:26:21', '2022-05-19 12:26:21'),
(66, 2, 'Santa Clara', 1, '2022-05-19 12:26:21', '2022-05-19 12:26:21'),
(67, 2, 'Vallejo', 1, '2022-05-19 12:26:21', '2022-05-19 12:26:21'),
(68, 2, 'Berkeley', 1, '2022-05-19 12:26:21', '2022-05-19 12:26:21'),
(69, 2, 'El Monte', 1, '2022-05-19 12:26:21', '2022-05-19 12:26:21'),
(70, 2, 'Downey', 1, '2022-05-19 12:26:21', '2022-05-19 12:26:21'),
(71, 2, 'Costa Mesa', 1, '2022-05-19 12:26:21', '2022-05-19 12:26:21'),
(72, 2, 'Inglewood', 1, '2022-05-19 12:26:21', '2022-05-19 12:26:21'),
(73, 2, 'Carlsbad', 1, '2022-05-19 12:26:21', '2022-05-19 12:26:21'),
(74, 2, 'San Buenaventura (Ventura)', 1, '2022-05-19 12:26:21', '2022-05-19 12:26:21'),
(75, 2, 'Fairfield', 1, '2022-05-19 12:26:21', '2022-05-19 12:26:21'),
(76, 2, 'West Covina', 1, '2022-05-19 12:26:21', '2022-05-19 12:26:21'),
(77, 2, 'Murrieta', 1, '2022-05-19 12:26:21', '2022-05-19 12:26:21'),
(78, 2, 'Richmond', 1, '2022-05-19 12:26:22', '2022-05-19 12:26:22'),
(79, 2, 'Norwalk', 1, '2022-05-19 12:26:22', '2022-05-19 12:26:22'),
(80, 2, 'Antioch', 1, '2022-05-19 12:26:22', '2022-05-19 12:26:22'),
(81, 2, 'Temecula', 1, '2022-05-19 12:26:22', '2022-05-19 12:26:22'),
(82, 2, 'Burbank', 1, '2022-05-19 12:26:23', '2022-05-19 12:26:23'),
(83, 2, 'Daly City', 1, '2022-05-19 12:26:23', '2022-05-19 12:26:23'),
(84, 2, 'Rialto', 1, '2022-05-19 12:26:23', '2022-05-19 12:26:23'),
(85, 2, 'Santa Maria', 1, '2022-05-19 12:26:23', '2022-05-19 12:26:23'),
(86, 2, 'El Cajon', 1, '2022-05-19 12:26:24', '2022-05-19 12:26:24'),
(87, 2, 'San Mateo', 1, '2022-05-19 12:26:24', '2022-05-19 12:26:24'),
(88, 2, 'Clovis', 1, '2022-05-19 12:26:24', '2022-05-19 12:26:24'),
(89, 2, 'Compton', 1, '2022-05-19 12:26:24', '2022-05-19 12:26:24'),
(90, 2, 'Jurupa Valley', 1, '2022-05-19 12:26:25', '2022-05-19 12:26:25'),
(91, 2, 'Vista', 1, '2022-05-19 12:26:25', '2022-05-19 12:26:25'),
(92, 2, 'South Gate', 1, '2022-05-19 12:26:25', '2022-05-19 12:26:25'),
(93, 2, 'Mission Viejo', 1, '2022-05-19 12:26:25', '2022-05-19 12:26:25'),
(94, 2, 'Vacaville', 1, '2022-05-19 12:26:25', '2022-05-19 12:26:25'),
(95, 2, 'Carson', 1, '2022-05-19 12:26:25', '2022-05-19 12:26:25'),
(96, 2, 'Hesperia', 1, '2022-05-19 12:26:25', '2022-05-19 12:26:25'),
(97, 2, 'Santa Monica', 1, '2022-05-19 12:26:25', '2022-05-19 12:26:25'),
(98, 2, 'Westminster', 1, '2022-05-19 12:26:25', '2022-05-19 12:26:25'),
(99, 2, 'Redding', 1, '2022-05-19 12:26:25', '2022-05-19 12:26:25'),
(100, 2, 'Santa Barbara', 1, '2022-05-19 12:26:25', '2022-05-19 12:26:25'),
(101, 2, 'Chico', 1, '2022-05-19 12:26:25', '2022-05-19 12:26:25'),
(102, 2, 'Newport Beach', 1, '2022-05-19 12:26:25', '2022-05-19 12:26:25'),
(103, 2, 'San Leandro', 1, '2022-05-19 12:26:26', '2022-05-19 12:26:26'),
(104, 2, 'San Marcos', 1, '2022-05-19 12:26:26', '2022-05-19 12:26:26'),
(105, 2, 'Whittier', 1, '2022-05-19 12:26:26', '2022-05-19 12:26:26'),
(106, 2, 'Hawthorne', 1, '2022-05-19 12:26:26', '2022-05-19 12:26:26'),
(107, 2, 'Citrus Heights', 1, '2022-05-19 12:26:26', '2022-05-19 12:26:26'),
(108, 2, 'Tracy', 1, '2022-05-19 12:26:26', '2022-05-19 12:26:26'),
(109, 2, 'Alhambra', 1, '2022-05-19 12:26:26', '2022-05-19 12:26:26'),
(110, 2, 'Livermore', 1, '2022-05-19 12:26:26', '2022-05-19 12:26:26'),
(111, 2, 'Buena Park', 1, '2022-05-19 12:26:26', '2022-05-19 12:26:26'),
(112, 2, 'Menifee', 1, '2022-05-19 12:26:26', '2022-05-19 12:26:26'),
(113, 2, 'Hemet', 1, '2022-05-19 12:26:26', '2022-05-19 12:26:26'),
(114, 2, 'Lakewood', 1, '2022-05-19 12:26:26', '2022-05-19 12:26:26'),
(115, 2, 'Merced', 1, '2022-05-19 12:26:26', '2022-05-19 12:26:26'),
(116, 2, 'Chino', 1, '2022-05-19 12:26:26', '2022-05-19 12:26:26'),
(117, 2, 'Indio', 1, '2022-05-19 12:26:26', '2022-05-19 12:26:26'),
(118, 2, 'Redwood City', 1, '2022-05-19 12:26:26', '2022-05-19 12:26:26'),
(119, 2, 'Lake Forest', 1, '2022-05-19 12:26:26', '2022-05-19 12:26:26'),
(120, 2, 'Napa', 1, '2022-05-19 12:26:26', '2022-05-19 12:26:26'),
(121, 2, 'Tustin', 1, '2022-05-19 12:26:26', '2022-05-19 12:26:26'),
(122, 2, 'Bellflower', 1, '2022-05-19 12:26:26', '2022-05-19 12:26:26'),
(123, 2, 'Mountain View', 1, '2022-05-19 12:26:26', '2022-05-19 12:26:26'),
(124, 2, 'Chino Hills', 1, '2022-05-19 12:26:26', '2022-05-19 12:26:26'),
(125, 2, 'Baldwin Park', 1, '2022-05-19 12:26:26', '2022-05-19 12:26:26'),
(126, 2, 'Alameda', 1, '2022-05-19 12:26:26', '2022-05-19 12:26:26'),
(127, 2, 'Upland', 1, '2022-05-19 12:26:27', '2022-05-19 12:26:27'),
(128, 2, 'San Ramon', 1, '2022-05-19 12:26:27', '2022-05-19 12:26:27'),
(129, 2, 'Folsom', 1, '2022-05-19 12:26:27', '2022-05-19 12:26:27'),
(130, 2, 'Pleasanton', 1, '2022-05-19 12:26:27', '2022-05-19 12:26:27'),
(131, 2, 'Union City', 1, '2022-05-19 12:26:27', '2022-05-19 12:26:27'),
(132, 2, 'Perris', 1, '2022-05-19 12:26:27', '2022-05-19 12:26:27'),
(133, 2, 'Manteca', 1, '2022-05-19 12:26:27', '2022-05-19 12:26:27'),
(134, 2, 'Lynwood', 1, '2022-05-19 12:26:27', '2022-05-19 12:26:27'),
(135, 2, 'Apple Valley', 1, '2022-05-19 12:26:27', '2022-05-19 12:26:27'),
(136, 2, 'Redlands', 1, '2022-05-19 12:26:27', '2022-05-19 12:26:27'),
(137, 2, 'Turlock', 1, '2022-05-19 12:26:27', '2022-05-19 12:26:27'),
(138, 2, 'Milpitas', 1, '2022-05-19 12:26:27', '2022-05-19 12:26:27'),
(139, 2, 'Redondo Beach', 1, '2022-05-19 12:26:27', '2022-05-19 12:26:27'),
(140, 2, 'Rancho Cordova', 1, '2022-05-19 12:26:27', '2022-05-19 12:26:27'),
(141, 2, 'Yorba Linda', 1, '2022-05-19 12:26:27', '2022-05-19 12:26:27'),
(142, 2, 'Palo Alto', 1, '2022-05-19 12:26:27', '2022-05-19 12:26:27'),
(143, 2, 'Davis', 1, '2022-05-19 12:26:27', '2022-05-19 12:26:27'),
(144, 2, 'Camarillo', 1, '2022-05-19 12:26:27', '2022-05-19 12:26:27'),
(145, 2, 'Walnut Creek', 1, '2022-05-19 12:26:27', '2022-05-19 12:26:27'),
(146, 2, 'Pittsburg', 1, '2022-05-19 12:26:27', '2022-05-19 12:26:27'),
(147, 2, 'South San Francisco', 1, '2022-05-19 12:26:27', '2022-05-19 12:26:27'),
(148, 2, 'Yuba City', 1, '2022-05-19 12:26:27', '2022-05-19 12:26:27'),
(149, 2, 'San Clemente', 1, '2022-05-19 12:26:27', '2022-05-19 12:26:27'),
(150, 2, 'Laguna Niguel', 1, '2022-05-19 12:26:27', '2022-05-19 12:26:27'),
(151, 2, 'Pico Rivera', 1, '2022-05-19 12:26:27', '2022-05-19 12:26:27'),
(152, 2, 'Montebello', 1, '2022-05-19 12:26:28', '2022-05-19 12:26:28'),
(153, 2, 'Lodi', 1, '2022-05-19 12:26:28', '2022-05-19 12:26:28'),
(154, 2, 'Madera', 1, '2022-05-19 12:26:28', '2022-05-19 12:26:28'),
(155, 2, 'Santa Cruz', 1, '2022-05-19 12:26:28', '2022-05-19 12:26:28'),
(156, 2, 'La Habra', 1, '2022-05-19 12:26:28', '2022-05-19 12:26:28'),
(157, 2, 'Encinitas', 1, '2022-05-19 12:26:28', '2022-05-19 12:26:28'),
(158, 2, 'Monterey Park', 1, '2022-05-19 12:26:28', '2022-05-19 12:26:28'),
(159, 2, 'Tulare', 1, '2022-05-19 12:26:28', '2022-05-19 12:26:28'),
(160, 2, 'Cupertino', 1, '2022-05-19 12:26:28', '2022-05-19 12:26:28'),
(161, 2, 'Gardena', 1, '2022-05-19 12:26:28', '2022-05-19 12:26:28'),
(162, 2, 'National City', 1, '2022-05-19 12:26:28', '2022-05-19 12:26:28'),
(163, 2, 'Rocklin', 1, '2022-05-19 12:26:28', '2022-05-19 12:26:28'),
(164, 2, 'Petaluma', 1, '2022-05-19 12:26:28', '2022-05-19 12:26:28'),
(165, 2, 'Huntington Park', 1, '2022-05-19 12:26:28', '2022-05-19 12:26:28'),
(166, 2, 'San Rafael', 1, '2022-05-19 12:26:28', '2022-05-19 12:26:28'),
(167, 2, 'La Mesa', 1, '2022-05-19 12:26:28', '2022-05-19 12:26:28'),
(168, 2, 'Arcadia', 1, '2022-05-19 12:26:28', '2022-05-19 12:26:28'),
(169, 2, 'Fountain Valley', 1, '2022-05-19 12:26:28', '2022-05-19 12:26:28'),
(170, 2, 'Diamond Bar', 1, '2022-05-19 12:26:28', '2022-05-19 12:26:28'),
(171, 2, 'Woodland', 1, '2022-05-19 12:26:28', '2022-05-19 12:26:28'),
(172, 2, 'Santee', 1, '2022-05-19 12:26:28', '2022-05-19 12:26:28'),
(173, 2, 'Lake Elsinore', 1, '2022-05-19 12:26:29', '2022-05-19 12:26:29'),
(174, 2, 'Porterville', 1, '2022-05-19 12:26:29', '2022-05-19 12:26:29'),
(175, 2, 'Paramount', 1, '2022-05-19 12:26:29', '2022-05-19 12:26:29'),
(176, 2, 'Eastvale', 1, '2022-05-19 12:26:29', '2022-05-19 12:26:29'),
(177, 2, 'Rosemead', 1, '2022-05-19 12:26:29', '2022-05-19 12:26:29'),
(178, 2, 'Hanford', 1, '2022-05-19 12:26:29', '2022-05-19 12:26:29'),
(179, 2, 'Highland', 1, '2022-05-19 12:26:29', '2022-05-19 12:26:29'),
(180, 2, 'Brentwood', 1, '2022-05-19 12:26:29', '2022-05-19 12:26:29'),
(181, 2, 'Novato', 1, '2022-05-19 12:26:29', '2022-05-19 12:26:29'),
(182, 2, 'Colton', 1, '2022-05-19 12:26:29', '2022-05-19 12:26:29'),
(183, 2, 'Cathedral City', 1, '2022-05-19 12:26:29', '2022-05-19 12:26:29'),
(184, 2, 'Delano', 1, '2022-05-19 12:26:29', '2022-05-19 12:26:29'),
(185, 2, 'Yucaipa', 1, '2022-05-19 12:26:29', '2022-05-19 12:26:29'),
(186, 2, 'Watsonville', 1, '2022-05-19 12:26:29', '2022-05-19 12:26:29'),
(187, 2, 'Placentia', 1, '2022-05-19 12:26:29', '2022-05-19 12:26:29'),
(188, 2, 'Glendora', 1, '2022-05-19 12:26:29', '2022-05-19 12:26:29'),
(189, 2, 'Gilroy', 1, '2022-05-19 12:26:29', '2022-05-19 12:26:29'),
(190, 2, 'Palm Desert', 1, '2022-05-19 12:26:29', '2022-05-19 12:26:29'),
(191, 2, 'Cerritos', 1, '2022-05-19 12:26:29', '2022-05-19 12:26:29'),
(192, 2, 'West Sacramento', 1, '2022-05-19 12:26:29', '2022-05-19 12:26:29'),
(193, 2, 'Aliso Viejo', 1, '2022-05-19 12:26:29', '2022-05-19 12:26:29'),
(194, 2, 'Poway', 1, '2022-05-19 12:26:29', '2022-05-19 12:26:29'),
(195, 2, 'La Mirada', 1, '2022-05-19 12:26:29', '2022-05-19 12:26:29'),
(196, 2, 'Rancho Santa Margarita', 1, '2022-05-19 12:26:29', '2022-05-19 12:26:29'),
(197, 2, 'Cypress', 1, '2022-05-19 12:26:29', '2022-05-19 12:26:29'),
(198, 2, 'Dublin', 1, '2022-05-19 12:26:29', '2022-05-19 12:26:29'),
(199, 2, 'Covina', 1, '2022-05-19 12:26:30', '2022-05-19 12:26:30'),
(200, 2, 'Azusa', 1, '2022-05-19 12:26:30', '2022-05-19 12:26:30'),
(201, 2, 'Palm Springs', 1, '2022-05-19 12:26:30', '2022-05-19 12:26:30'),
(202, 2, 'San Luis Obispo', 1, '2022-05-19 12:26:30', '2022-05-19 12:26:30'),
(203, 2, 'Ceres', 1, '2022-05-19 12:26:30', '2022-05-19 12:26:30'),
(204, 2, 'San Jacinto', 1, '2022-05-19 12:26:30', '2022-05-19 12:26:30'),
(205, 2, 'Lincoln', 1, '2022-05-19 12:26:30', '2022-05-19 12:26:30'),
(206, 2, 'Newark', 1, '2022-05-19 12:26:30', '2022-05-19 12:26:30'),
(207, 2, 'Lompoc', 1, '2022-05-19 12:26:30', '2022-05-19 12:26:30'),
(208, 2, 'El Centro', 1, '2022-05-19 12:26:30', '2022-05-19 12:26:30'),
(209, 2, 'Danville', 1, '2022-05-19 12:26:30', '2022-05-19 12:26:30'),
(210, 2, 'Bell Gardens', 1, '2022-05-19 12:26:30', '2022-05-19 12:26:30'),
(211, 2, 'Coachella', 1, '2022-05-19 12:26:30', '2022-05-19 12:26:30'),
(212, 2, 'Rancho Palos Verdes', 1, '2022-05-19 12:26:30', '2022-05-19 12:26:30'),
(213, 2, 'San Bruno', 1, '2022-05-19 12:26:30', '2022-05-19 12:26:30'),
(214, 2, 'Rohnert Park', 1, '2022-05-19 12:26:30', '2022-05-19 12:26:30'),
(215, 2, 'Brea', 1, '2022-05-19 12:26:30', '2022-05-19 12:26:30'),
(216, 2, 'La Puente', 1, '2022-05-19 12:26:30', '2022-05-19 12:26:30'),
(217, 2, 'Campbell', 1, '2022-05-19 12:26:30', '2022-05-19 12:26:30'),
(218, 2, 'San Gabriel', 1, '2022-05-19 12:26:30', '2022-05-19 12:26:30'),
(219, 2, 'Beaumont', 1, '2022-05-19 12:26:30', '2022-05-19 12:26:30'),
(220, 2, 'Morgan Hill', 1, '2022-05-19 12:26:30', '2022-05-19 12:26:30'),
(221, 2, 'Culver City', 1, '2022-05-19 12:26:30', '2022-05-19 12:26:30'),
(222, 2, 'Calexico', 1, '2022-05-19 12:26:30', '2022-05-19 12:26:30'),
(223, 2, 'Stanton', 1, '2022-05-19 12:26:30', '2022-05-19 12:26:30'),
(224, 2, 'La Quinta', 1, '2022-05-19 12:26:30', '2022-05-19 12:26:30'),
(225, 2, 'Pacifica', 1, '2022-05-19 12:26:30', '2022-05-19 12:26:30'),
(226, 2, 'Montclair', 1, '2022-05-19 12:26:30', '2022-05-19 12:26:30'),
(227, 2, 'Oakley', 1, '2022-05-19 12:26:30', '2022-05-19 12:26:30'),
(228, 2, 'Monrovia', 1, '2022-05-19 12:26:30', '2022-05-19 12:26:30'),
(229, 2, 'Los Banos', 1, '2022-05-19 12:26:30', '2022-05-19 12:26:30'),
(230, 2, 'Martinez', 1, '2022-05-19 12:26:30', '2022-05-19 12:26:30'),
(231, 3, 'Chicago', 1, '2022-05-19 12:26:31', '2022-05-19 12:26:31'),
(232, 3, 'Aurora', 1, '2022-05-19 12:26:31', '2022-05-19 12:26:31'),
(233, 3, 'Rockford', 1, '2022-05-19 12:26:31', '2022-05-19 12:26:31'),
(234, 3, 'Joliet', 1, '2022-05-19 12:26:31', '2022-05-19 12:26:31'),
(235, 3, 'Naperville', 1, '2022-05-19 12:26:31', '2022-05-19 12:26:31'),
(236, 3, 'Springfield', 1, '2022-05-19 12:26:31', '2022-05-19 12:26:31'),
(237, 3, 'Peoria', 1, '2022-05-19 12:26:31', '2022-05-19 12:26:31'),
(238, 3, 'Elgin', 1, '2022-05-19 12:26:31', '2022-05-19 12:26:31'),
(239, 3, 'Waukegan', 1, '2022-05-19 12:26:31', '2022-05-19 12:26:31'),
(240, 3, 'Cicero', 1, '2022-05-19 12:26:31', '2022-05-19 12:26:31'),
(241, 3, 'Champaign', 1, '2022-05-19 12:26:31', '2022-05-19 12:26:31'),
(242, 3, 'Bloomington', 1, '2022-05-19 12:26:31', '2022-05-19 12:26:31'),
(243, 3, 'Arlington Heights', 1, '2022-05-19 12:26:31', '2022-05-19 12:26:31'),
(244, 3, 'Evanston', 1, '2022-05-19 12:26:31', '2022-05-19 12:26:31'),
(245, 3, 'Decatur', 1, '2022-05-19 12:26:31', '2022-05-19 12:26:31'),
(246, 3, 'Schaumburg', 1, '2022-05-19 12:26:31', '2022-05-19 12:26:31'),
(247, 3, 'Bolingbrook', 1, '2022-05-19 12:26:31', '2022-05-19 12:26:31'),
(248, 3, 'Palatine', 1, '2022-05-19 12:26:31', '2022-05-19 12:26:31'),
(249, 3, 'Skokie', 1, '2022-05-19 12:26:31', '2022-05-19 12:26:31'),
(250, 3, 'Des Plaines', 1, '2022-05-19 12:26:31', '2022-05-19 12:26:31'),
(251, 3, 'Orland Park', 1, '2022-05-19 12:26:31', '2022-05-19 12:26:31'),
(252, 3, 'Tinley Park', 1, '2022-05-19 12:26:31', '2022-05-19 12:26:31'),
(253, 3, 'Oak Lawn', 1, '2022-05-19 12:26:31', '2022-05-19 12:26:31'),
(254, 3, 'Berwyn', 1, '2022-05-19 12:26:32', '2022-05-19 12:26:32'),
(255, 3, 'Mount Prospect', 1, '2022-05-19 12:26:32', '2022-05-19 12:26:32'),
(256, 3, 'Normal', 1, '2022-05-19 12:26:32', '2022-05-19 12:26:32'),
(257, 3, 'Wheaton', 1, '2022-05-19 12:26:32', '2022-05-19 12:26:32'),
(258, 3, 'Hoffman Estates', 1, '2022-05-19 12:26:32', '2022-05-19 12:26:32'),
(259, 3, 'Oak Park', 1, '2022-05-19 12:26:32', '2022-05-19 12:26:32'),
(260, 3, 'Downers Grove', 1, '2022-05-19 12:26:32', '2022-05-19 12:26:32'),
(261, 3, 'Elmhurst', 1, '2022-05-19 12:26:32', '2022-05-19 12:26:32'),
(262, 3, 'Glenview', 1, '2022-05-19 12:26:32', '2022-05-19 12:26:32'),
(263, 3, 'DeKalb', 1, '2022-05-19 12:26:32', '2022-05-19 12:26:32'),
(264, 3, 'Lombard', 1, '2022-05-19 12:26:32', '2022-05-19 12:26:32'),
(265, 3, 'Belleville', 1, '2022-05-19 12:26:32', '2022-05-19 12:26:32'),
(266, 3, 'Moline', 1, '2022-05-19 12:26:32', '2022-05-19 12:26:32'),
(267, 3, 'Buffalo Grove', 1, '2022-05-19 12:26:32', '2022-05-19 12:26:32'),
(268, 3, 'Bartlett', 1, '2022-05-19 12:26:32', '2022-05-19 12:26:32'),
(269, 3, 'Urbana', 1, '2022-05-19 12:26:32', '2022-05-19 12:26:32'),
(270, 3, 'Quincy', 1, '2022-05-19 12:26:32', '2022-05-19 12:26:32'),
(271, 3, 'Crystal Lake', 1, '2022-05-19 12:26:32', '2022-05-19 12:26:32'),
(272, 3, 'Plainfield', 1, '2022-05-19 12:26:32', '2022-05-19 12:26:32'),
(273, 3, 'Streamwood', 1, '2022-05-19 12:26:33', '2022-05-19 12:26:33'),
(274, 3, 'Carol Stream', 1, '2022-05-19 12:26:33', '2022-05-19 12:26:33'),
(275, 3, 'Romeoville', 1, '2022-05-19 12:26:33', '2022-05-19 12:26:33'),
(276, 3, 'Rock Island', 1, '2022-05-19 12:26:33', '2022-05-19 12:26:33'),
(277, 3, 'Hanover Park', 1, '2022-05-19 12:26:33', '2022-05-19 12:26:33'),
(278, 3, 'Carpentersville', 1, '2022-05-19 12:26:33', '2022-05-19 12:26:33'),
(279, 3, 'Wheeling', 1, '2022-05-19 12:26:33', '2022-05-19 12:26:33'),
(280, 3, 'Park Ridge', 1, '2022-05-19 12:26:33', '2022-05-19 12:26:33'),
(281, 3, 'Addison', 1, '2022-05-19 12:26:33', '2022-05-19 12:26:33'),
(282, 3, 'Calumet City', 1, '2022-05-19 12:26:33', '2022-05-19 12:26:33'),
(283, 4, 'Houston', 1, '2022-05-19 12:26:33', '2022-05-19 12:26:33'),
(284, 4, 'San Antonio', 1, '2022-05-19 12:26:33', '2022-05-19 12:26:33'),
(285, 4, 'Dallas', 1, '2022-05-19 12:26:33', '2022-05-19 12:26:33'),
(286, 4, 'Austin', 1, '2022-05-19 12:26:33', '2022-05-19 12:26:33'),
(287, 4, 'Fort Worth', 1, '2022-05-19 12:26:34', '2022-05-19 12:26:34'),
(288, 4, 'El Paso', 1, '2022-05-19 12:26:34', '2022-05-19 12:26:34'),
(289, 4, 'Arlington', 1, '2022-05-19 12:26:34', '2022-05-19 12:26:34'),
(290, 4, 'Corpus Christi', 1, '2022-05-19 12:26:34', '2022-05-19 12:26:34'),
(291, 4, 'Plano', 1, '2022-05-19 12:26:34', '2022-05-19 12:26:34'),
(292, 4, 'Laredo', 1, '2022-05-19 12:26:34', '2022-05-19 12:26:34'),
(293, 4, 'Lubbock', 1, '2022-05-19 12:26:34', '2022-05-19 12:26:34'),
(294, 4, 'Garland', 1, '2022-05-19 12:26:34', '2022-05-19 12:26:34'),
(295, 4, 'Irving', 1, '2022-05-19 12:26:34', '2022-05-19 12:26:34'),
(296, 4, 'Amarillo', 1, '2022-05-19 12:26:34', '2022-05-19 12:26:34'),
(297, 4, 'Grand Prairie', 1, '2022-05-19 12:26:34', '2022-05-19 12:26:34'),
(298, 4, 'Brownsville', 1, '2022-05-19 12:26:34', '2022-05-19 12:26:34'),
(299, 4, 'Pasadena', 1, '2022-05-19 12:26:34', '2022-05-19 12:26:34'),
(300, 4, 'McKinney', 1, '2022-05-19 12:26:34', '2022-05-19 12:26:34'),
(301, 4, 'Mesquite', 1, '2022-05-19 12:26:34', '2022-05-19 12:26:34'),
(302, 4, 'McAllen', 1, '2022-05-19 12:26:34', '2022-05-19 12:26:34'),
(303, 4, 'Killeen', 1, '2022-05-19 12:26:35', '2022-05-19 12:26:35'),
(304, 4, 'Frisco', 1, '2022-05-19 12:26:35', '2022-05-19 12:26:35'),
(305, 4, 'Waco', 1, '2022-05-19 12:26:35', '2022-05-19 12:26:35'),
(306, 4, 'Carrollton', 1, '2022-05-19 12:26:35', '2022-05-19 12:26:35'),
(307, 4, 'Denton', 1, '2022-05-19 12:26:35', '2022-05-19 12:26:35'),
(308, 4, 'Midland', 1, '2022-05-19 12:26:35', '2022-05-19 12:26:35'),
(309, 4, 'Abilene', 1, '2022-05-19 12:26:35', '2022-05-19 12:26:35'),
(310, 4, 'Beaumont', 1, '2022-05-19 12:26:35', '2022-05-19 12:26:35'),
(311, 4, 'Round Rock', 1, '2022-05-19 12:26:35', '2022-05-19 12:26:35'),
(312, 4, 'Odessa', 1, '2022-05-19 12:26:35', '2022-05-19 12:26:35'),
(313, 4, 'Wichita Falls', 1, '2022-05-19 12:26:35', '2022-05-19 12:26:35'),
(314, 4, 'Richardson', 1, '2022-05-19 12:26:35', '2022-05-19 12:26:35'),
(315, 4, 'Lewisville', 1, '2022-05-19 12:26:35', '2022-05-19 12:26:35'),
(316, 4, 'Tyler', 1, '2022-05-19 12:26:35', '2022-05-19 12:26:35'),
(317, 4, 'College Station', 1, '2022-05-19 12:26:36', '2022-05-19 12:26:36'),
(318, 4, 'Pearland', 1, '2022-05-19 12:26:38', '2022-05-19 12:26:38'),
(319, 4, 'San Angelo', 1, '2022-05-19 12:26:38', '2022-05-19 12:26:38'),
(320, 4, 'Allen', 1, '2022-05-19 12:26:38', '2022-05-19 12:26:38'),
(321, 4, 'League City', 1, '2022-05-19 12:26:38', '2022-05-19 12:26:38'),
(322, 4, 'Sugar Land', 1, '2022-05-19 12:26:38', '2022-05-19 12:26:38'),
(323, 4, 'Longview', 1, '2022-05-19 12:26:38', '2022-05-19 12:26:38'),
(324, 4, 'Edinburg', 1, '2022-05-19 12:26:38', '2022-05-19 12:26:38'),
(325, 4, 'Mission', 1, '2022-05-19 12:26:39', '2022-05-19 12:26:39'),
(326, 4, 'Bryan', 1, '2022-05-19 12:26:39', '2022-05-19 12:26:39'),
(327, 4, 'Baytown', 1, '2022-05-19 12:26:39', '2022-05-19 12:26:39'),
(328, 4, 'Pharr', 1, '2022-05-19 12:26:39', '2022-05-19 12:26:39'),
(329, 4, 'Temple', 1, '2022-05-19 12:26:39', '2022-05-19 12:26:39'),
(330, 4, 'Missouri City', 1, '2022-05-19 12:26:39', '2022-05-19 12:26:39'),
(331, 4, 'Flower Mound', 1, '2022-05-19 12:26:39', '2022-05-19 12:26:39'),
(332, 4, 'Harlingen', 1, '2022-05-19 12:26:39', '2022-05-19 12:26:39'),
(333, 4, 'North Richland Hills', 1, '2022-05-19 12:26:39', '2022-05-19 12:26:39'),
(334, 4, 'Victoria', 1, '2022-05-19 12:26:39', '2022-05-19 12:26:39'),
(335, 4, 'Conroe', 1, '2022-05-19 12:26:39', '2022-05-19 12:26:39'),
(336, 4, 'New Braunfels', 1, '2022-05-19 12:26:39', '2022-05-19 12:26:39'),
(337, 4, 'Mansfield', 1, '2022-05-19 12:26:39', '2022-05-19 12:26:39'),
(338, 4, 'Cedar Park', 1, '2022-05-19 12:26:39', '2022-05-19 12:26:39'),
(339, 4, 'Rowlett', 1, '2022-05-19 12:26:39', '2022-05-19 12:26:39'),
(340, 4, 'Port Arthur', 1, '2022-05-19 12:26:40', '2022-05-19 12:26:40'),
(341, 4, 'Euless', 1, '2022-05-19 12:26:40', '2022-05-19 12:26:40'),
(342, 4, 'Georgetown', 1, '2022-05-19 12:26:40', '2022-05-19 12:26:40'),
(343, 4, 'Pflugerville', 1, '2022-05-19 12:26:40', '2022-05-19 12:26:40'),
(344, 4, 'DeSoto', 1, '2022-05-19 12:26:40', '2022-05-19 12:26:40'),
(345, 4, 'San Marcos', 1, '2022-05-19 12:26:40', '2022-05-19 12:26:40'),
(346, 4, 'Grapevine', 1, '2022-05-19 12:26:40', '2022-05-19 12:26:40'),
(347, 4, 'Bedford', 1, '2022-05-19 12:26:40', '2022-05-19 12:26:40'),
(348, 4, 'Galveston', 1, '2022-05-19 12:26:40', '2022-05-19 12:26:40'),
(349, 4, 'Cedar Hill', 1, '2022-05-19 12:26:40', '2022-05-19 12:26:40'),
(350, 4, 'Texas City', 1, '2022-05-19 12:26:40', '2022-05-19 12:26:40'),
(351, 4, 'Wylie', 1, '2022-05-19 12:26:40', '2022-05-19 12:26:40'),
(352, 4, 'Haltom City', 1, '2022-05-19 12:26:40', '2022-05-19 12:26:40'),
(353, 4, 'Keller', 1, '2022-05-19 12:26:40', '2022-05-19 12:26:40'),
(354, 4, 'Coppell', 1, '2022-05-19 12:26:40', '2022-05-19 12:26:40'),
(355, 4, 'Rockwall', 1, '2022-05-19 12:26:41', '2022-05-19 12:26:41'),
(356, 4, 'Huntsville', 1, '2022-05-19 12:26:41', '2022-05-19 12:26:41'),
(357, 4, 'Duncanville', 1, '2022-05-19 12:26:41', '2022-05-19 12:26:41'),
(358, 4, 'Sherman', 1, '2022-05-19 12:26:41', '2022-05-19 12:26:41'),
(359, 4, 'The Colony', 1, '2022-05-19 12:26:41', '2022-05-19 12:26:41'),
(360, 4, 'Burleson', 1, '2022-05-19 12:26:41', '2022-05-19 12:26:41'),
(361, 4, 'Hurst', 1, '2022-05-19 12:26:41', '2022-05-19 12:26:41'),
(362, 4, 'Lancaster', 1, '2022-05-19 12:26:41', '2022-05-19 12:26:41'),
(363, 4, 'Texarkana', 1, '2022-05-19 12:26:41', '2022-05-19 12:26:41'),
(364, 4, 'Friendswood', 1, '2022-05-19 12:26:41', '2022-05-19 12:26:41'),
(365, 4, 'Weslaco', 1, '2022-05-19 12:26:41', '2022-05-19 12:26:41'),
(366, 5, 'Philadelphia', 1, '2022-05-19 12:26:41', '2022-05-19 12:26:41'),
(367, 5, 'Pittsburgh', 1, '2022-05-19 12:26:41', '2022-05-19 12:26:41'),
(368, 5, 'Allentown', 1, '2022-05-19 12:26:41', '2022-05-19 12:26:41'),
(369, 5, 'Erie', 1, '2022-05-19 12:26:42', '2022-05-19 12:26:42'),
(370, 5, 'Reading', 1, '2022-05-19 12:26:42', '2022-05-19 12:26:42'),
(371, 5, 'Scranton', 1, '2022-05-19 12:26:42', '2022-05-19 12:26:42'),
(372, 5, 'Bethlehem', 1, '2022-05-19 12:26:42', '2022-05-19 12:26:42'),
(373, 5, 'Lancaster', 1, '2022-05-19 12:26:42', '2022-05-19 12:26:42'),
(374, 5, 'Harrisburg', 1, '2022-05-19 12:26:42', '2022-05-19 12:26:42'),
(375, 5, 'Altoona', 1, '2022-05-19 12:26:42', '2022-05-19 12:26:42'),
(376, 5, 'York', 1, '2022-05-19 12:26:42', '2022-05-19 12:26:42'),
(377, 5, 'State College', 1, '2022-05-19 12:26:42', '2022-05-19 12:26:42'),
(378, 5, 'Wilkes-Barre', 1, '2022-05-19 12:26:42', '2022-05-19 12:26:42'),
(379, 6, 'Phoenix', 1, '2022-05-19 12:26:42', '2022-05-19 12:26:42'),
(380, 6, 'Tucson', 1, '2022-05-19 12:26:42', '2022-05-19 12:26:42'),
(381, 6, 'Mesa', 1, '2022-05-19 12:26:42', '2022-05-19 12:26:42'),
(382, 6, 'Chandler', 1, '2022-05-19 12:26:42', '2022-05-19 12:26:42'),
(383, 6, 'Glendale', 1, '2022-05-19 12:26:43', '2022-05-19 12:26:43'),
(384, 6, 'Scottsdale', 1, '2022-05-19 12:26:43', '2022-05-19 12:26:43'),
(385, 6, 'Gilbert', 1, '2022-05-19 12:26:43', '2022-05-19 12:26:43'),
(386, 6, 'Tempe', 1, '2022-05-19 12:26:43', '2022-05-19 12:26:43'),
(387, 6, 'Peoria', 1, '2022-05-19 12:26:43', '2022-05-19 12:26:43'),
(388, 6, 'Surprise', 1, '2022-05-19 12:26:43', '2022-05-19 12:26:43'),
(389, 6, 'Yuma', 1, '2022-05-19 12:26:43', '2022-05-19 12:26:43'),
(390, 6, 'Avondale', 1, '2022-05-19 12:26:43', '2022-05-19 12:26:43'),
(391, 6, 'Goodyear', 1, '2022-05-19 12:26:43', '2022-05-19 12:26:43'),
(392, 6, 'Flagstaff', 1, '2022-05-19 12:26:43', '2022-05-19 12:26:43'),
(393, 6, 'Buckeye', 1, '2022-05-19 12:26:43', '2022-05-19 12:26:43'),
(394, 6, 'Lake Havasu City', 1, '2022-05-19 12:26:43', '2022-05-19 12:26:43'),
(395, 6, 'Casa Grande', 1, '2022-05-19 12:26:43', '2022-05-19 12:26:43'),
(396, 6, 'Sierra Vista', 1, '2022-05-19 12:26:43', '2022-05-19 12:26:43'),
(397, 6, 'Maricopa', 1, '2022-05-19 12:26:43', '2022-05-19 12:26:43'),
(398, 6, 'Oro Valley', 1, '2022-05-19 12:26:43', '2022-05-19 12:26:43'),
(399, 6, 'Prescott', 1, '2022-05-19 12:26:43', '2022-05-19 12:26:43'),
(400, 6, 'Bullhead City', 1, '2022-05-19 12:26:43', '2022-05-19 12:26:43'),
(401, 6, 'Prescott Valley', 1, '2022-05-19 12:26:44', '2022-05-19 12:26:44'),
(402, 6, 'Marana', 1, '2022-05-19 12:26:44', '2022-05-19 12:26:44'),
(403, 6, 'Apache Junction', 1, '2022-05-19 12:26:44', '2022-05-19 12:26:44'),
(404, 7, 'Jacksonville', 1, '2022-05-19 12:26:45', '2022-05-19 12:26:45'),
(405, 7, 'Miami', 1, '2022-05-19 12:26:45', '2022-05-19 12:26:45'),
(406, 7, 'Tampa', 1, '2022-05-19 12:26:45', '2022-05-19 12:26:45'),
(407, 7, 'Orlando', 1, '2022-05-19 12:26:45', '2022-05-19 12:26:45'),
(408, 7, 'St. Petersburg', 1, '2022-05-19 12:26:45', '2022-05-19 12:26:45'),
(409, 7, 'Hialeah', 1, '2022-05-19 12:26:45', '2022-05-19 12:26:45'),
(410, 7, 'Tallahassee', 1, '2022-05-19 12:26:45', '2022-05-19 12:26:45'),
(411, 7, 'Fort Lauderdale', 1, '2022-05-19 12:26:45', '2022-05-19 12:26:45'),
(412, 7, 'Port St. Lucie', 1, '2022-05-19 12:26:45', '2022-05-19 12:26:45'),
(413, 7, 'Cape Coral', 1, '2022-05-19 12:26:45', '2022-05-19 12:26:45'),
(414, 7, 'Pembroke Pines', 1, '2022-05-19 12:26:45', '2022-05-19 12:26:45'),
(415, 7, 'Hollywood', 1, '2022-05-19 12:26:46', '2022-05-19 12:26:46'),
(416, 7, 'Miramar', 1, '2022-05-19 12:26:46', '2022-05-19 12:26:46'),
(417, 7, 'Gainesville', 1, '2022-05-19 12:26:46', '2022-05-19 12:26:46'),
(418, 7, 'Coral Springs', 1, '2022-05-19 12:26:46', '2022-05-19 12:26:46'),
(419, 7, 'Miami Gardens', 1, '2022-05-19 12:26:46', '2022-05-19 12:26:46'),
(420, 7, 'Clearwater', 1, '2022-05-19 12:26:46', '2022-05-19 12:26:46'),
(421, 7, 'Palm Bay', 1, '2022-05-19 12:26:46', '2022-05-19 12:26:46'),
(422, 7, 'Pompano Beach', 1, '2022-05-19 12:26:46', '2022-05-19 12:26:46'),
(423, 7, 'West Palm Beach', 1, '2022-05-19 12:26:46', '2022-05-19 12:26:46'),
(424, 7, 'Lakeland', 1, '2022-05-19 12:26:46', '2022-05-19 12:26:46'),
(425, 7, 'Davie', 1, '2022-05-19 12:26:46', '2022-05-19 12:26:46'),
(426, 7, 'Miami Beach', 1, '2022-05-19 12:26:46', '2022-05-19 12:26:46'),
(427, 7, 'Sunrise', 1, '2022-05-19 12:26:46', '2022-05-19 12:26:46'),
(428, 7, 'Plantation', 1, '2022-05-19 12:26:47', '2022-05-19 12:26:47'),
(429, 7, 'Boca Raton', 1, '2022-05-19 12:26:47', '2022-05-19 12:26:47'),
(430, 7, 'Deltona', 1, '2022-05-19 12:26:47', '2022-05-19 12:26:47'),
(431, 7, 'Largo', 1, '2022-05-19 12:26:47', '2022-05-19 12:26:47'),
(432, 7, 'Deerfield Beach', 1, '2022-05-19 12:26:47', '2022-05-19 12:26:47'),
(433, 7, 'Palm Coast', 1, '2022-05-19 12:26:47', '2022-05-19 12:26:47'),
(434, 7, 'Melbourne', 1, '2022-05-19 12:26:47', '2022-05-19 12:26:47'),
(435, 7, 'Boynton Beach', 1, '2022-05-19 12:26:47', '2022-05-19 12:26:47'),
(436, 7, 'Lauderhill', 1, '2022-05-19 12:26:47', '2022-05-19 12:26:47'),
(437, 7, 'Weston', 1, '2022-05-19 12:26:47', '2022-05-19 12:26:47'),
(438, 7, 'Fort Myers', 1, '2022-05-19 12:26:47', '2022-05-19 12:26:47'),
(439, 7, 'Kissimmee', 1, '2022-05-19 12:26:47', '2022-05-19 12:26:47'),
(440, 7, 'Homestead', 1, '2022-05-19 12:26:47', '2022-05-19 12:26:47'),
(441, 7, 'Tamarac', 1, '2022-05-19 12:26:47', '2022-05-19 12:26:47'),
(442, 7, 'Delray Beach', 1, '2022-05-19 12:26:47', '2022-05-19 12:26:47'),
(443, 7, 'Daytona Beach', 1, '2022-05-19 12:26:48', '2022-05-19 12:26:48'),
(444, 7, 'North Miami', 1, '2022-05-19 12:26:48', '2022-05-19 12:26:48'),
(445, 7, 'Wellington', 1, '2022-05-19 12:26:48', '2022-05-19 12:26:48'),
(446, 7, 'North Port', 1, '2022-05-19 12:26:48', '2022-05-19 12:26:48'),
(447, 7, 'Jupiter', 1, '2022-05-19 12:26:48', '2022-05-19 12:26:48'),
(448, 7, 'Ocala', 1, '2022-05-19 12:26:48', '2022-05-19 12:26:48'),
(449, 7, 'Port Orange', 1, '2022-05-19 12:26:48', '2022-05-19 12:26:48'),
(450, 7, 'Margate', 1, '2022-05-19 12:26:48', '2022-05-19 12:26:48'),
(451, 7, 'Coconut Creek', 1, '2022-05-19 12:26:48', '2022-05-19 12:26:48'),
(452, 7, 'Sanford', 1, '2022-05-19 12:26:48', '2022-05-19 12:26:48'),
(453, 7, 'Sarasota', 1, '2022-05-19 12:26:48', '2022-05-19 12:26:48'),
(454, 7, 'Pensacola', 1, '2022-05-19 12:26:48', '2022-05-19 12:26:48'),
(455, 7, 'Bradenton', 1, '2022-05-19 12:26:48', '2022-05-19 12:26:48'),
(456, 7, 'Palm Beach Gardens', 1, '2022-05-19 12:26:48', '2022-05-19 12:26:48'),
(457, 7, 'Pinellas Park', 1, '2022-05-19 12:26:49', '2022-05-19 12:26:49'),
(458, 7, 'Coral Gables', 1, '2022-05-19 12:26:49', '2022-05-19 12:26:49'),
(459, 7, 'Doral', 1, '2022-05-19 12:26:49', '2022-05-19 12:26:49'),
(460, 7, 'Bonita Springs', 1, '2022-05-19 12:26:49', '2022-05-19 12:26:49'),
(461, 7, 'Apopka', 1, '2022-05-19 12:26:49', '2022-05-19 12:26:49'),
(462, 7, 'Titusville', 1, '2022-05-19 12:26:49', '2022-05-19 12:26:49'),
(463, 7, 'North Miami Beach', 1, '2022-05-19 12:26:49', '2022-05-19 12:26:49'),
(464, 7, 'Oakland Park', 1, '2022-05-19 12:26:49', '2022-05-19 12:26:49'),
(465, 7, 'Fort Pierce', 1, '2022-05-19 12:26:50', '2022-05-19 12:26:50'),
(466, 7, 'North Lauderdale', 1, '2022-05-19 12:26:50', '2022-05-19 12:26:50'),
(467, 7, 'Cutler Bay', 1, '2022-05-19 12:26:50', '2022-05-19 12:26:50'),
(468, 7, 'Altamonte Springs', 1, '2022-05-19 12:26:50', '2022-05-19 12:26:50'),
(469, 7, 'St. Cloud', 1, '2022-05-19 12:26:50', '2022-05-19 12:26:50'),
(470, 7, 'Greenacres', 1, '2022-05-19 12:26:50', '2022-05-19 12:26:50'),
(471, 7, 'Ormond Beach', 1, '2022-05-19 12:26:50', '2022-05-19 12:26:50'),
(472, 7, 'Ocoee', 1, '2022-05-19 12:26:50', '2022-05-19 12:26:50'),
(473, 7, 'Hallandale Beach', 1, '2022-05-19 12:26:50', '2022-05-19 12:26:50'),
(474, 7, 'Winter Garden', 1, '2022-05-19 12:26:50', '2022-05-19 12:26:50'),
(475, 7, 'Aventura', 1, '2022-05-19 12:26:50', '2022-05-19 12:26:50'),
(476, 8, 'Indianapolis', 1, '2022-05-19 12:26:51', '2022-05-19 12:26:51'),
(477, 8, 'Fort Wayne', 1, '2022-05-19 12:26:51', '2022-05-19 12:26:51'),
(478, 8, 'Evansville', 1, '2022-05-19 12:26:51', '2022-05-19 12:26:51'),
(479, 8, 'South Bend', 1, '2022-05-19 12:26:51', '2022-05-19 12:26:51'),
(480, 8, 'Carmel', 1, '2022-05-19 12:26:51', '2022-05-19 12:26:51'),
(481, 8, 'Bloomington', 1, '2022-05-19 12:26:51', '2022-05-19 12:26:51'),
(482, 8, 'Fishers', 1, '2022-05-19 12:26:51', '2022-05-19 12:26:51'),
(483, 8, 'Hammond', 1, '2022-05-19 12:26:51', '2022-05-19 12:26:51'),
(484, 8, 'Gary', 1, '2022-05-19 12:26:51', '2022-05-19 12:26:51'),
(485, 8, 'Muncie', 1, '2022-05-19 12:26:51', '2022-05-19 12:26:51'),
(486, 8, 'Lafayette', 1, '2022-05-19 12:26:51', '2022-05-19 12:26:51'),
(487, 8, 'Terre Haute', 1, '2022-05-19 12:26:51', '2022-05-19 12:26:51'),
(488, 8, 'Kokomo', 1, '2022-05-19 12:26:51', '2022-05-19 12:26:51'),
(489, 8, 'Anderson', 1, '2022-05-19 12:26:51', '2022-05-19 12:26:51'),
(490, 8, 'Noblesville', 1, '2022-05-19 12:26:51', '2022-05-19 12:26:51'),
(491, 8, 'Greenwood', 1, '2022-05-19 12:26:52', '2022-05-19 12:26:52'),
(492, 8, 'Elkhart', 1, '2022-05-19 12:26:52', '2022-05-19 12:26:52'),
(493, 8, 'Mishawaka', 1, '2022-05-19 12:26:52', '2022-05-19 12:26:52'),
(494, 8, 'Lawrence', 1, '2022-05-19 12:26:52', '2022-05-19 12:26:52'),
(495, 8, 'Jeffersonville', 1, '2022-05-19 12:26:52', '2022-05-19 12:26:52'),
(496, 8, 'Columbus', 1, '2022-05-19 12:26:52', '2022-05-19 12:26:52'),
(497, 8, 'Portage', 1, '2022-05-19 12:26:52', '2022-05-19 12:26:52'),
(498, 9, 'Columbus', 1, '2022-05-19 12:26:52', '2022-05-19 12:26:52'),
(499, 9, 'Cleveland', 1, '2022-05-19 12:26:52', '2022-05-19 12:26:52'),
(500, 9, 'Cincinnati', 1, '2022-05-19 12:26:52', '2022-05-19 12:26:52'),
(501, 9, 'Toledo', 1, '2022-05-19 12:26:52', '2022-05-19 12:26:52'),
(502, 9, 'Akron', 1, '2022-05-19 12:26:52', '2022-05-19 12:26:52'),
(503, 9, 'Dayton', 1, '2022-05-19 12:26:52', '2022-05-19 12:26:52'),
(504, 9, 'Parma', 1, '2022-05-19 12:26:53', '2022-05-19 12:26:53'),
(505, 9, 'Canton', 1, '2022-05-19 12:26:53', '2022-05-19 12:26:53'),
(506, 9, 'Youngstown', 1, '2022-05-19 12:26:53', '2022-05-19 12:26:53'),
(507, 9, 'Lorain', 1, '2022-05-19 12:26:53', '2022-05-19 12:26:53'),
(508, 9, 'Hamilton', 1, '2022-05-19 12:26:53', '2022-05-19 12:26:53'),
(509, 9, 'Springfield', 1, '2022-05-19 12:26:53', '2022-05-19 12:26:53'),
(510, 9, 'Kettering', 1, '2022-05-19 12:26:53', '2022-05-19 12:26:53'),
(511, 9, 'Elyria', 1, '2022-05-19 12:26:53', '2022-05-19 12:26:53'),
(512, 9, 'Lakewood', 1, '2022-05-19 12:26:53', '2022-05-19 12:26:53'),
(513, 9, 'Cuyahoga Falls', 1, '2022-05-19 12:26:53', '2022-05-19 12:26:53'),
(514, 9, 'Middletown', 1, '2022-05-19 12:26:53', '2022-05-19 12:26:53'),
(515, 9, 'Euclid', 1, '2022-05-19 12:26:53', '2022-05-19 12:26:53'),
(516, 9, 'Newark', 1, '2022-05-19 12:26:53', '2022-05-19 12:26:53'),
(517, 9, 'Mansfield', 1, '2022-05-19 12:26:53', '2022-05-19 12:26:53'),
(518, 9, 'Mentor', 1, '2022-05-19 12:26:53', '2022-05-19 12:26:53'),
(519, 9, 'Beavercreek', 1, '2022-05-19 12:26:53', '2022-05-19 12:26:53'),
(520, 9, 'Cleveland Heights', 1, '2022-05-19 12:26:54', '2022-05-19 12:26:54'),
(521, 9, 'Strongsville', 1, '2022-05-19 12:26:54', '2022-05-19 12:26:54'),
(522, 9, 'Dublin', 1, '2022-05-19 12:26:54', '2022-05-19 12:26:54'),
(523, 9, 'Fairfield', 1, '2022-05-19 12:26:54', '2022-05-19 12:26:54'),
(524, 9, 'Findlay', 1, '2022-05-19 12:26:54', '2022-05-19 12:26:54'),
(525, 9, 'Warren', 1, '2022-05-19 12:26:54', '2022-05-19 12:26:54'),
(526, 9, 'Lancaster', 1, '2022-05-19 12:26:54', '2022-05-19 12:26:54'),
(527, 9, 'Lima', 1, '2022-05-19 12:26:54', '2022-05-19 12:26:54'),
(528, 9, 'Huber Heights', 1, '2022-05-19 12:26:54', '2022-05-19 12:26:54'),
(529, 9, 'Westerville', 1, '2022-05-19 12:26:54', '2022-05-19 12:26:54'),
(530, 9, 'Marion', 1, '2022-05-19 12:26:54', '2022-05-19 12:26:54'),
(531, 9, 'Grove City', 1, '2022-05-19 12:26:54', '2022-05-19 12:26:54'),
(532, 10, 'Charlotte', 1, '2022-05-19 12:26:55', '2022-05-19 12:26:55'),
(533, 10, 'Raleigh', 1, '2022-05-19 12:26:55', '2022-05-19 12:26:55'),
(534, 10, 'Greensboro', 1, '2022-05-19 12:26:55', '2022-05-19 12:26:55'),
(535, 10, 'Durham', 1, '2022-05-19 12:26:55', '2022-05-19 12:26:55'),
(536, 10, 'Winston-Salem', 1, '2022-05-19 12:26:55', '2022-05-19 12:26:55'),
(537, 10, 'Fayetteville', 1, '2022-05-19 12:26:55', '2022-05-19 12:26:55'),
(538, 10, 'Cary', 1, '2022-05-19 12:26:55', '2022-05-19 12:26:55'),
(539, 10, 'Wilmington', 1, '2022-05-19 12:26:55', '2022-05-19 12:26:55'),
(540, 10, 'High Point', 1, '2022-05-19 12:26:55', '2022-05-19 12:26:55'),
(541, 10, 'Greenville', 1, '2022-05-19 12:26:55', '2022-05-19 12:26:55'),
(542, 10, 'Asheville', 1, '2022-05-19 12:26:55', '2022-05-19 12:26:55'),
(543, 10, 'Concord', 1, '2022-05-19 12:26:55', '2022-05-19 12:26:55'),
(544, 10, 'Gastonia', 1, '2022-05-19 12:26:55', '2022-05-19 12:26:55'),
(545, 10, 'Jacksonville', 1, '2022-05-19 12:26:55', '2022-05-19 12:26:55'),
(546, 10, 'Chapel Hill', 1, '2022-05-19 12:26:55', '2022-05-19 12:26:55'),
(547, 10, 'Rocky Mount', 1, '2022-05-19 12:26:55', '2022-05-19 12:26:55'),
(548, 10, 'Burlington', 1, '2022-05-19 12:26:55', '2022-05-19 12:26:55'),
(549, 10, 'Wilson', 1, '2022-05-19 12:26:55', '2022-05-19 12:26:55'),
(550, 10, 'Huntersville', 1, '2022-05-19 12:26:55', '2022-05-19 12:26:55'),
(551, 10, 'Kannapolis', 1, '2022-05-19 12:26:55', '2022-05-19 12:26:55'),
(552, 10, 'Apex', 1, '2022-05-19 12:26:56', '2022-05-19 12:26:56'),
(553, 10, 'Hickory', 1, '2022-05-19 12:26:56', '2022-05-19 12:26:56'),
(554, 10, 'Goldsboro', 1, '2022-05-19 12:26:56', '2022-05-19 12:26:56'),
(555, 11, 'Detroit', 1, '2022-05-19 12:26:56', '2022-05-19 12:26:56'),
(556, 11, 'Grand Rapids', 1, '2022-05-19 12:26:56', '2022-05-19 12:26:56'),
(557, 11, 'Warren', 1, '2022-05-19 12:26:56', '2022-05-19 12:26:56'),
(558, 11, 'Sterling Heights', 1, '2022-05-19 12:26:56', '2022-05-19 12:26:56'),
(559, 11, 'Ann Arbor', 1, '2022-05-19 12:26:56', '2022-05-19 12:26:56'),
(560, 11, 'Lansing', 1, '2022-05-19 12:26:56', '2022-05-19 12:26:56'),
(561, 11, 'Flint', 1, '2022-05-19 12:26:56', '2022-05-19 12:26:56'),
(562, 11, 'Dearborn', 1, '2022-05-19 12:26:56', '2022-05-19 12:26:56'),
(563, 11, 'Livonia', 1, '2022-05-19 12:26:57', '2022-05-19 12:26:57'),
(564, 11, 'Westland', 1, '2022-05-19 12:26:57', '2022-05-19 12:26:57'),
(565, 11, 'Troy', 1, '2022-05-19 12:26:57', '2022-05-19 12:26:57'),
(566, 11, 'Farmington Hills', 1, '2022-05-19 12:26:57', '2022-05-19 12:26:57'),
(567, 11, 'Kalamazoo', 1, '2022-05-19 12:26:57', '2022-05-19 12:26:57'),
(568, 11, 'Wyoming', 1, '2022-05-19 12:26:57', '2022-05-19 12:26:57'),
(569, 11, 'Southfield', 1, '2022-05-19 12:26:57', '2022-05-19 12:26:57'),
(570, 11, 'Rochester Hills', 1, '2022-05-19 12:26:57', '2022-05-19 12:26:57'),
(571, 11, 'Taylor', 1, '2022-05-19 12:26:57', '2022-05-19 12:26:57'),
(572, 11, 'Pontiac', 1, '2022-05-19 12:26:57', '2022-05-19 12:26:57'),
(573, 11, 'St. Clair Shores', 1, '2022-05-19 12:26:57', '2022-05-19 12:26:57'),
(574, 11, 'Royal Oak', 1, '2022-05-19 12:26:57', '2022-05-19 12:26:57'),
(575, 11, 'Novi', 1, '2022-05-19 12:26:57', '2022-05-19 12:26:57'),
(576, 11, 'Dearborn Heights', 1, '2022-05-19 12:26:57', '2022-05-19 12:26:57'),
(577, 11, 'Battle Creek', 1, '2022-05-19 12:26:57', '2022-05-19 12:26:57'),
(578, 11, 'Saginaw', 1, '2022-05-19 12:26:57', '2022-05-19 12:26:57'),
(579, 11, 'Kentwood', 1, '2022-05-19 12:26:58', '2022-05-19 12:26:58'),
(580, 11, 'East Lansing', 1, '2022-05-19 12:26:58', '2022-05-19 12:26:58'),
(581, 11, 'Roseville', 1, '2022-05-19 12:26:58', '2022-05-19 12:26:58'),
(582, 11, 'Portage', 1, '2022-05-19 12:26:58', '2022-05-19 12:26:58'),
(583, 11, 'Midland', 1, '2022-05-19 12:26:58', '2022-05-19 12:26:58'),
(584, 11, 'Lincoln Park', 1, '2022-05-19 12:26:58', '2022-05-19 12:26:58'),
(585, 11, 'Muskegon', 1, '2022-05-19 12:26:58', '2022-05-19 12:26:58'),
(586, 12, 'Memphis', 1, '2022-05-19 12:26:58', '2022-05-19 12:26:58'),
(587, 12, 'Nashville-Davidson', 1, '2022-05-19 12:26:58', '2022-05-19 12:26:58'),
(588, 12, 'Knoxville', 1, '2022-05-19 12:26:58', '2022-05-19 12:26:58'),
(589, 12, 'Chattanooga', 1, '2022-05-19 12:26:58', '2022-05-19 12:26:58'),
(590, 12, 'Clarksville', 1, '2022-05-19 12:26:59', '2022-05-19 12:26:59'),
(591, 12, 'Murfreesboro', 1, '2022-05-19 12:26:59', '2022-05-19 12:26:59'),
(592, 12, 'Jackson', 1, '2022-05-19 12:26:59', '2022-05-19 12:26:59'),
(593, 12, 'Franklin', 1, '2022-05-19 12:26:59', '2022-05-19 12:26:59'),
(594, 12, 'Johnson City', 1, '2022-05-19 12:26:59', '2022-05-19 12:26:59'),
(595, 12, 'Bartlett', 1, '2022-05-19 12:26:59', '2022-05-19 12:26:59'),
(596, 12, 'Hendersonville', 1, '2022-05-19 12:26:59', '2022-05-19 12:26:59'),
(597, 12, 'Kingsport', 1, '2022-05-19 12:26:59', '2022-05-19 12:26:59'),
(598, 12, 'Collierville', 1, '2022-05-19 12:26:59', '2022-05-19 12:26:59'),
(599, 12, 'Cleveland', 1, '2022-05-19 12:26:59', '2022-05-19 12:26:59'),
(600, 12, 'Smyrna', 1, '2022-05-19 12:26:59', '2022-05-19 12:26:59'),
(601, 12, 'Germantown', 1, '2022-05-19 12:26:59', '2022-05-19 12:26:59'),
(602, 12, 'Brentwood', 1, '2022-05-19 12:26:59', '2022-05-19 12:26:59'),
(603, 13, 'Boston', 1, '2022-05-19 12:26:59', '2022-05-19 12:26:59'),
(604, 13, 'Worcester', 1, '2022-05-19 12:27:00', '2022-05-19 12:27:00'),
(605, 13, 'Springfield', 1, '2022-05-19 12:27:00', '2022-05-19 12:27:00'),
(606, 13, 'Lowell', 1, '2022-05-19 12:27:00', '2022-05-19 12:27:00'),
(607, 13, 'Cambridge', 1, '2022-05-19 12:27:00', '2022-05-19 12:27:00'),
(608, 13, 'New Bedford', 1, '2022-05-19 12:27:00', '2022-05-19 12:27:00'),
(609, 13, 'Brockton', 1, '2022-05-19 12:27:00', '2022-05-19 12:27:00'),
(610, 13, 'Quincy', 1, '2022-05-19 12:27:00', '2022-05-19 12:27:00'),
(611, 13, 'Lynn', 1, '2022-05-19 12:27:00', '2022-05-19 12:27:00'),
(612, 13, 'Fall River', 1, '2022-05-19 12:27:00', '2022-05-19 12:27:00'),
(613, 13, 'Newton', 1, '2022-05-19 12:27:00', '2022-05-19 12:27:00'),
(614, 13, 'Lawrence', 1, '2022-05-19 12:27:00', '2022-05-19 12:27:00'),
(615, 13, 'Somerville', 1, '2022-05-19 12:27:00', '2022-05-19 12:27:00'),
(616, 13, 'Waltham', 1, '2022-05-19 12:27:00', '2022-05-19 12:27:00'),
(617, 13, 'Haverhill', 1, '2022-05-19 12:27:00', '2022-05-19 12:27:00'),
(618, 13, 'Malden', 1, '2022-05-19 12:27:00', '2022-05-19 12:27:00'),
(619, 13, 'Medford', 1, '2022-05-19 12:27:00', '2022-05-19 12:27:00'),
(620, 13, 'Taunton', 1, '2022-05-19 12:27:01', '2022-05-19 12:27:01'),
(621, 13, 'Chicopee', 1, '2022-05-19 12:27:01', '2022-05-19 12:27:01'),
(622, 13, 'Weymouth Town', 1, '2022-05-19 12:27:01', '2022-05-19 12:27:01'),
(623, 13, 'Revere', 1, '2022-05-19 12:27:01', '2022-05-19 12:27:01'),
(624, 13, 'Peabody', 1, '2022-05-19 12:27:01', '2022-05-19 12:27:01'),
(625, 13, 'Methuen', 1, '2022-05-19 12:27:01', '2022-05-19 12:27:01'),
(626, 13, 'Barnstable Town', 1, '2022-05-19 12:27:01', '2022-05-19 12:27:01'),
(627, 13, 'Pittsfield', 1, '2022-05-19 12:27:01', '2022-05-19 12:27:01'),
(628, 13, 'Attleboro', 1, '2022-05-19 12:27:01', '2022-05-19 12:27:01'),
(629, 13, 'Everett', 1, '2022-05-19 12:27:01', '2022-05-19 12:27:01'),
(630, 13, 'Salem', 1, '2022-05-19 12:27:01', '2022-05-19 12:27:01'),
(631, 13, 'Westfield', 1, '2022-05-19 12:27:01', '2022-05-19 12:27:01'),
(632, 13, 'Leominster', 1, '2022-05-19 12:27:01', '2022-05-19 12:27:01'),
(633, 13, 'Fitchburg', 1, '2022-05-19 12:27:01', '2022-05-19 12:27:01'),
(634, 13, 'Beverly', 1, '2022-05-19 12:27:01', '2022-05-19 12:27:01'),
(635, 13, 'Holyoke', 1, '2022-05-19 12:27:01', '2022-05-19 12:27:01'),
(636, 13, 'Marlborough', 1, '2022-05-19 12:27:01', '2022-05-19 12:27:01'),
(637, 13, 'Woburn', 1, '2022-05-19 12:27:01', '2022-05-19 12:27:01'),
(638, 13, 'Chelsea', 1, '2022-05-19 12:27:01', '2022-05-19 12:27:01'),
(639, 14, 'Seattle', 1, '2022-05-19 12:27:02', '2022-05-19 12:27:02'),
(640, 14, 'Spokane', 1, '2022-05-19 12:27:02', '2022-05-19 12:27:02'),
(641, 14, 'Tacoma', 1, '2022-05-19 12:27:02', '2022-05-19 12:27:02'),
(642, 14, 'Vancouver', 1, '2022-05-19 12:27:02', '2022-05-19 12:27:02'),
(643, 14, 'Bellevue', 1, '2022-05-19 12:27:02', '2022-05-19 12:27:02'),
(644, 14, 'Kent', 1, '2022-05-19 12:27:02', '2022-05-19 12:27:02'),
(645, 14, 'Everett', 1, '2022-05-19 12:27:02', '2022-05-19 12:27:02'),
(646, 14, 'Renton', 1, '2022-05-19 12:27:02', '2022-05-19 12:27:02'),
(647, 14, 'Yakima', 1, '2022-05-19 12:27:02', '2022-05-19 12:27:02'),
(648, 14, 'Federal Way', 1, '2022-05-19 12:27:02', '2022-05-19 12:27:02'),
(649, 14, 'Spokane Valley', 1, '2022-05-19 12:27:02', '2022-05-19 12:27:02'),
(650, 14, 'Bellingham', 1, '2022-05-19 12:27:02', '2022-05-19 12:27:02'),
(651, 14, 'Kennewick', 1, '2022-05-19 12:27:03', '2022-05-19 12:27:03'),
(652, 14, 'Auburn', 1, '2022-05-19 12:27:03', '2022-05-19 12:27:03'),
(653, 14, 'Pasco', 1, '2022-05-19 12:27:03', '2022-05-19 12:27:03'),
(654, 14, 'Marysville', 1, '2022-05-19 12:27:03', '2022-05-19 12:27:03'),
(655, 14, 'Lakewood', 1, '2022-05-19 12:27:03', '2022-05-19 12:27:03'),
(656, 14, 'Redmond', 1, '2022-05-19 12:27:03', '2022-05-19 12:27:03'),
(657, 14, 'Shoreline', 1, '2022-05-19 12:27:03', '2022-05-19 12:27:03'),
(658, 14, 'Richland', 1, '2022-05-19 12:27:03', '2022-05-19 12:27:03'),
(659, 14, 'Kirkland', 1, '2022-05-19 12:27:03', '2022-05-19 12:27:03'),
(660, 14, 'Burien', 1, '2022-05-19 12:27:03', '2022-05-19 12:27:03'),
(661, 14, 'Sammamish', 1, '2022-05-19 12:27:03', '2022-05-19 12:27:03'),
(662, 14, 'Olympia', 1, '2022-05-19 12:27:03', '2022-05-19 12:27:03'),
(663, 14, 'Lacey', 1, '2022-05-19 12:27:03', '2022-05-19 12:27:03'),
(664, 14, 'Edmonds', 1, '2022-05-19 12:27:03', '2022-05-19 12:27:03'),
(665, 14, 'Bremerton', 1, '2022-05-19 12:27:03', '2022-05-19 12:27:03'),
(666, 14, 'Puyallup', 1, '2022-05-19 12:27:03', '2022-05-19 12:27:03'),
(667, 15, 'Denver', 1, '2022-05-19 12:27:03', '2022-05-19 12:27:03'),
(668, 15, 'Colorado Springs', 1, '2022-05-19 12:27:03', '2022-05-19 12:27:03'),
(669, 15, 'Aurora', 1, '2022-05-19 12:27:03', '2022-05-19 12:27:03'),
(670, 15, 'Fort Collins', 1, '2022-05-19 12:27:03', '2022-05-19 12:27:03'),
(671, 15, 'Lakewood', 1, '2022-05-19 12:27:04', '2022-05-19 12:27:04'),
(672, 15, 'Thornton', 1, '2022-05-19 12:27:04', '2022-05-19 12:27:04'),
(673, 15, 'Arvada', 1, '2022-05-19 12:27:04', '2022-05-19 12:27:04'),
(674, 15, 'Westminster', 1, '2022-05-19 12:27:04', '2022-05-19 12:27:04'),
(675, 15, 'Pueblo', 1, '2022-05-19 12:27:04', '2022-05-19 12:27:04'),
(676, 15, 'Centennial', 1, '2022-05-19 12:27:04', '2022-05-19 12:27:04'),
(677, 15, 'Boulder', 1, '2022-05-19 12:27:04', '2022-05-19 12:27:04'),
(678, 15, 'Greeley', 1, '2022-05-19 12:27:04', '2022-05-19 12:27:04'),
(679, 15, 'Longmont', 1, '2022-05-19 12:27:04', '2022-05-19 12:27:04'),
(680, 15, 'Loveland', 1, '2022-05-19 12:27:04', '2022-05-19 12:27:04'),
(681, 15, 'Grand Junction', 1, '2022-05-19 12:27:04', '2022-05-19 12:27:04'),
(682, 15, 'Broomfield', 1, '2022-05-19 12:27:04', '2022-05-19 12:27:04'),
(683, 15, 'Castle Rock', 1, '2022-05-19 12:27:04', '2022-05-19 12:27:04'),
(684, 15, 'Commerce City', 1, '2022-05-19 12:27:04', '2022-05-19 12:27:04'),
(685, 15, 'Parker', 1, '2022-05-19 12:27:04', '2022-05-19 12:27:04'),
(686, 15, 'Littleton', 1, '2022-05-19 12:27:04', '2022-05-19 12:27:04'),
(687, 15, 'Northglenn', 1, '2022-05-19 12:27:04', '2022-05-19 12:27:04'),
(688, 16, 'Washington', 1, '2022-05-19 12:27:05', '2022-05-19 12:27:05'),
(689, 17, 'Baltimore', 1, '2022-05-19 12:27:05', '2022-05-19 12:27:05'),
(690, 17, 'Frederick', 1, '2022-05-19 12:27:05', '2022-05-19 12:27:05'),
(691, 17, 'Rockville', 1, '2022-05-19 12:27:05', '2022-05-19 12:27:05'),
(692, 17, 'Gaithersburg', 1, '2022-05-19 12:27:05', '2022-05-19 12:27:05'),
(693, 17, 'Bowie', 1, '2022-05-19 12:27:05', '2022-05-19 12:27:05'),
(694, 17, 'Hagerstown', 1, '2022-05-19 12:27:05', '2022-05-19 12:27:05'),
(695, 17, 'Annapolis', 1, '2022-05-19 12:27:05', '2022-05-19 12:27:05'),
(696, 18, 'Louisville/Jefferson County', 1, '2022-05-19 12:27:05', '2022-05-19 12:27:05'),
(697, 18, 'Lexington-Fayette', 1, '2022-05-19 12:27:05', '2022-05-19 12:27:05'),
(698, 18, 'Bowling Green', 1, '2022-05-19 12:27:05', '2022-05-19 12:27:05'),
(699, 18, 'Owensboro', 1, '2022-05-19 12:27:05', '2022-05-19 12:27:05'),
(700, 18, 'Covington', 1, '2022-05-19 12:27:05', '2022-05-19 12:27:05'),
(701, 19, 'Portland', 1, '2022-05-19 12:27:06', '2022-05-19 12:27:06'),
(702, 19, 'Eugene', 1, '2022-05-19 12:27:06', '2022-05-19 12:27:06'),
(703, 19, 'Salem', 1, '2022-05-19 12:27:06', '2022-05-19 12:27:06'),
(704, 19, 'Gresham', 1, '2022-05-19 12:27:06', '2022-05-19 12:27:06'),
(705, 19, 'Hillsboro', 1, '2022-05-19 12:27:06', '2022-05-19 12:27:06'),
(706, 19, 'Beaverton', 1, '2022-05-19 12:27:06', '2022-05-19 12:27:06'),
(707, 19, 'Bend', 1, '2022-05-19 12:27:06', '2022-05-19 12:27:06'),
(708, 19, 'Medford', 1, '2022-05-19 12:27:06', '2022-05-19 12:27:06'),
(709, 19, 'Springfield', 1, '2022-05-19 12:27:06', '2022-05-19 12:27:06'),
(710, 19, 'Corvallis', 1, '2022-05-19 12:27:06', '2022-05-19 12:27:06'),
(711, 19, 'Albany', 1, '2022-05-19 12:27:06', '2022-05-19 12:27:06');
INSERT INTO `states` (`id`, `city_id`, `state`, `status`, `created_at`, `updated_at`) VALUES
(712, 19, 'Tigard', 1, '2022-05-19 12:27:06', '2022-05-19 12:27:06'),
(713, 19, 'Lake Oswego', 1, '2022-05-19 12:27:06', '2022-05-19 12:27:06'),
(714, 19, 'Keizer', 1, '2022-05-19 12:27:06', '2022-05-19 12:27:06'),
(715, 20, 'Oklahoma City', 1, '2022-05-19 12:27:06', '2022-05-19 12:27:06'),
(716, 20, 'Tulsa', 1, '2022-05-19 12:27:06', '2022-05-19 12:27:06'),
(717, 20, 'Norman', 1, '2022-05-19 12:27:06', '2022-05-19 12:27:06'),
(718, 20, 'Broken Arrow', 1, '2022-05-19 12:27:06', '2022-05-19 12:27:06'),
(719, 20, 'Lawton', 1, '2022-05-19 12:27:06', '2022-05-19 12:27:06'),
(720, 20, 'Edmond', 1, '2022-05-19 12:27:07', '2022-05-19 12:27:07'),
(721, 20, 'Moore', 1, '2022-05-19 12:27:07', '2022-05-19 12:27:07'),
(722, 20, 'Midwest City', 1, '2022-05-19 12:27:07', '2022-05-19 12:27:07'),
(723, 20, 'Enid', 1, '2022-05-19 12:27:07', '2022-05-19 12:27:07'),
(724, 20, 'Stillwater', 1, '2022-05-19 12:27:07', '2022-05-19 12:27:07'),
(725, 20, 'Muskogee', 1, '2022-05-19 12:27:07', '2022-05-19 12:27:07'),
(726, 21, 'Milwaukee', 1, '2022-05-19 12:27:07', '2022-05-19 12:27:07'),
(727, 21, 'Madison', 1, '2022-05-19 12:27:07', '2022-05-19 12:27:07'),
(728, 21, 'Green Bay', 1, '2022-05-19 12:27:07', '2022-05-19 12:27:07'),
(729, 21, 'Kenosha', 1, '2022-05-19 12:27:07', '2022-05-19 12:27:07'),
(730, 21, 'Racine', 1, '2022-05-19 12:27:07', '2022-05-19 12:27:07'),
(731, 21, 'Appleton', 1, '2022-05-19 12:27:07', '2022-05-19 12:27:07'),
(732, 21, 'Waukesha', 1, '2022-05-19 12:27:07', '2022-05-19 12:27:07'),
(733, 21, 'Eau Claire', 1, '2022-05-19 12:27:07', '2022-05-19 12:27:07'),
(734, 21, 'Oshkosh', 1, '2022-05-19 12:27:07', '2022-05-19 12:27:07'),
(735, 21, 'Janesville', 1, '2022-05-19 12:27:07', '2022-05-19 12:27:07'),
(736, 21, 'West Allis', 1, '2022-05-19 12:27:08', '2022-05-19 12:27:08'),
(737, 21, 'La Crosse', 1, '2022-05-19 12:27:08', '2022-05-19 12:27:08'),
(738, 21, 'Sheboygan', 1, '2022-05-19 12:27:08', '2022-05-19 12:27:08'),
(739, 21, 'Wauwatosa', 1, '2022-05-19 12:27:08', '2022-05-19 12:27:08'),
(740, 21, 'Fond du Lac', 1, '2022-05-19 12:27:08', '2022-05-19 12:27:08'),
(741, 21, 'New Berlin', 1, '2022-05-19 12:27:08', '2022-05-19 12:27:08'),
(742, 21, 'Wausau', 1, '2022-05-19 12:27:08', '2022-05-19 12:27:08'),
(743, 21, 'Brookfield', 1, '2022-05-19 12:27:08', '2022-05-19 12:27:08'),
(744, 21, 'Greenfield', 1, '2022-05-19 12:27:08', '2022-05-19 12:27:08'),
(745, 21, 'Beloit', 1, '2022-05-19 12:27:08', '2022-05-19 12:27:08'),
(746, 22, 'Las Vegas', 1, '2022-05-19 12:27:08', '2022-05-19 12:27:08'),
(747, 22, 'Henderson', 1, '2022-05-19 12:27:08', '2022-05-19 12:27:08'),
(748, 22, 'Reno', 1, '2022-05-19 12:27:08', '2022-05-19 12:27:08'),
(749, 22, 'North Las Vegas', 1, '2022-05-19 12:27:08', '2022-05-19 12:27:08'),
(750, 22, 'Sparks', 1, '2022-05-19 12:27:08', '2022-05-19 12:27:08'),
(751, 22, 'Carson City', 1, '2022-05-19 12:27:08', '2022-05-19 12:27:08'),
(752, 23, 'Albuquerque', 1, '2022-05-19 12:27:08', '2022-05-19 12:27:08'),
(753, 23, 'Las Cruces', 1, '2022-05-19 12:27:09', '2022-05-19 12:27:09'),
(754, 23, 'Rio Rancho', 1, '2022-05-19 12:27:09', '2022-05-19 12:27:09'),
(755, 23, 'Santa Fe', 1, '2022-05-19 12:27:09', '2022-05-19 12:27:09'),
(756, 23, 'Roswell', 1, '2022-05-19 12:27:09', '2022-05-19 12:27:09'),
(757, 23, 'Farmington', 1, '2022-05-19 12:27:09', '2022-05-19 12:27:09'),
(758, 23, 'Clovis', 1, '2022-05-19 12:27:09', '2022-05-19 12:27:09'),
(759, 24, 'Kansas City', 1, '2022-05-19 12:27:09', '2022-05-19 12:27:09'),
(760, 24, 'St. Louis', 1, '2022-05-19 12:27:09', '2022-05-19 12:27:09'),
(761, 24, 'Springfield', 1, '2022-05-19 12:27:09', '2022-05-19 12:27:09'),
(762, 24, 'Independence', 1, '2022-05-19 12:27:09', '2022-05-19 12:27:09'),
(763, 24, 'Columbia', 1, '2022-05-19 12:27:09', '2022-05-19 12:27:09'),
(764, 24, 'Lee\'s Summit', 1, '2022-05-19 12:27:10', '2022-05-19 12:27:10'),
(765, 24, 'O\'Fallon', 1, '2022-05-19 12:27:10', '2022-05-19 12:27:10'),
(766, 24, 'St. Joseph', 1, '2022-05-19 12:27:10', '2022-05-19 12:27:10'),
(767, 24, 'St. Charles', 1, '2022-05-19 12:27:10', '2022-05-19 12:27:10'),
(768, 24, 'St. Peters', 1, '2022-05-19 12:27:10', '2022-05-19 12:27:10'),
(769, 24, 'Blue Springs', 1, '2022-05-19 12:27:10', '2022-05-19 12:27:10'),
(770, 24, 'Florissant', 1, '2022-05-19 12:27:10', '2022-05-19 12:27:10'),
(771, 24, 'Joplin', 1, '2022-05-19 12:27:10', '2022-05-19 12:27:10'),
(772, 24, 'Chesterfield', 1, '2022-05-19 12:27:10', '2022-05-19 12:27:10'),
(773, 24, 'Jefferson City', 1, '2022-05-19 12:27:10', '2022-05-19 12:27:10'),
(774, 24, 'Cape Girardeau', 1, '2022-05-19 12:27:10', '2022-05-19 12:27:10'),
(775, 25, 'Virginia Beach', 1, '2022-05-19 12:27:11', '2022-05-19 12:27:11'),
(776, 25, 'Norfolk', 1, '2022-05-19 12:27:11', '2022-05-19 12:27:11'),
(777, 25, 'Chesapeake', 1, '2022-05-19 12:27:11', '2022-05-19 12:27:11'),
(778, 25, 'Richmond', 1, '2022-05-19 12:27:11', '2022-05-19 12:27:11'),
(779, 25, 'Newport News', 1, '2022-05-19 12:27:11', '2022-05-19 12:27:11'),
(780, 25, 'Alexandria', 1, '2022-05-19 12:27:11', '2022-05-19 12:27:11'),
(781, 25, 'Hampton', 1, '2022-05-19 12:27:11', '2022-05-19 12:27:11'),
(782, 25, 'Roanoke', 1, '2022-05-19 12:27:11', '2022-05-19 12:27:11'),
(783, 25, 'Portsmouth', 1, '2022-05-19 12:27:11', '2022-05-19 12:27:11'),
(784, 25, 'Suffolk', 1, '2022-05-19 12:27:11', '2022-05-19 12:27:11'),
(785, 25, 'Lynchburg', 1, '2022-05-19 12:27:11', '2022-05-19 12:27:11'),
(786, 25, 'Harrisonburg', 1, '2022-05-19 12:27:11', '2022-05-19 12:27:11'),
(787, 25, 'Leesburg', 1, '2022-05-19 12:27:11', '2022-05-19 12:27:11'),
(788, 25, 'Charlottesville', 1, '2022-05-19 12:27:11', '2022-05-19 12:27:11'),
(789, 25, 'Danville', 1, '2022-05-19 12:27:12', '2022-05-19 12:27:12'),
(790, 25, 'Blacksburg', 1, '2022-05-19 12:27:12', '2022-05-19 12:27:12'),
(791, 25, 'Manassas', 1, '2022-05-19 12:27:12', '2022-05-19 12:27:12'),
(792, 26, 'Atlanta', 1, '2022-05-19 12:27:12', '2022-05-19 12:27:12'),
(793, 26, 'Columbus', 1, '2022-05-19 12:27:12', '2022-05-19 12:27:12'),
(794, 26, 'Augusta-Richmond County', 1, '2022-05-19 12:27:12', '2022-05-19 12:27:12'),
(795, 26, 'Savannah', 1, '2022-05-19 12:27:12', '2022-05-19 12:27:12'),
(796, 26, 'Athens-Clarke County', 1, '2022-05-19 12:27:12', '2022-05-19 12:27:12'),
(797, 26, 'Sandy Springs', 1, '2022-05-19 12:27:12', '2022-05-19 12:27:12'),
(798, 26, 'Roswell', 1, '2022-05-19 12:27:12', '2022-05-19 12:27:12'),
(799, 26, 'Macon', 1, '2022-05-19 12:27:12', '2022-05-19 12:27:12'),
(800, 26, 'Johns Creek', 1, '2022-05-19 12:27:12', '2022-05-19 12:27:12'),
(801, 26, 'Albany', 1, '2022-05-19 12:27:12', '2022-05-19 12:27:12'),
(802, 26, 'Warner Robins', 1, '2022-05-19 12:27:13', '2022-05-19 12:27:13'),
(803, 26, 'Alpharetta', 1, '2022-05-19 12:27:13', '2022-05-19 12:27:13'),
(804, 26, 'Marietta', 1, '2022-05-19 12:27:13', '2022-05-19 12:27:13'),
(805, 26, 'Valdosta', 1, '2022-05-19 12:27:13', '2022-05-19 12:27:13'),
(806, 26, 'Smyrna', 1, '2022-05-19 12:27:13', '2022-05-19 12:27:13'),
(807, 26, 'Dunwoody', 1, '2022-05-19 12:27:13', '2022-05-19 12:27:13'),
(808, 27, 'Omaha', 1, '2022-05-19 12:27:13', '2022-05-19 12:27:13'),
(809, 27, 'Lincoln', 1, '2022-05-19 12:27:13', '2022-05-19 12:27:13'),
(810, 27, 'Bellevue', 1, '2022-05-19 12:27:13', '2022-05-19 12:27:13'),
(811, 27, 'Grand Island', 1, '2022-05-19 12:27:13', '2022-05-19 12:27:13'),
(812, 28, 'Minneapolis', 1, '2022-05-19 12:27:13', '2022-05-19 12:27:13'),
(813, 28, 'St. Paul', 1, '2022-05-19 12:27:13', '2022-05-19 12:27:13'),
(814, 28, 'Rochester', 1, '2022-05-19 12:27:13', '2022-05-19 12:27:13'),
(815, 28, 'Duluth', 1, '2022-05-19 12:27:14', '2022-05-19 12:27:14'),
(816, 28, 'Bloomington', 1, '2022-05-19 12:27:14', '2022-05-19 12:27:14'),
(817, 28, 'Brooklyn Park', 1, '2022-05-19 12:27:14', '2022-05-19 12:27:14'),
(818, 28, 'Plymouth', 1, '2022-05-19 12:27:14', '2022-05-19 12:27:14'),
(819, 28, 'St. Cloud', 1, '2022-05-19 12:27:14', '2022-05-19 12:27:14'),
(820, 28, 'Eagan', 1, '2022-05-19 12:27:14', '2022-05-19 12:27:14'),
(821, 28, 'Woodbury', 1, '2022-05-19 12:27:14', '2022-05-19 12:27:14'),
(822, 28, 'Maple Grove', 1, '2022-05-19 12:27:14', '2022-05-19 12:27:14'),
(823, 28, 'Eden Prairie', 1, '2022-05-19 12:27:14', '2022-05-19 12:27:14'),
(824, 28, 'Coon Rapids', 1, '2022-05-19 12:27:14', '2022-05-19 12:27:14'),
(825, 28, 'Burnsville', 1, '2022-05-19 12:27:14', '2022-05-19 12:27:14'),
(826, 28, 'Blaine', 1, '2022-05-19 12:27:15', '2022-05-19 12:27:15'),
(827, 28, 'Lakeville', 1, '2022-05-19 12:27:15', '2022-05-19 12:27:15'),
(828, 28, 'Minnetonka', 1, '2022-05-19 12:27:15', '2022-05-19 12:27:15'),
(829, 28, 'Apple Valley', 1, '2022-05-19 12:27:15', '2022-05-19 12:27:15'),
(830, 28, 'Edina', 1, '2022-05-19 12:27:15', '2022-05-19 12:27:15'),
(831, 28, 'St. Louis Park', 1, '2022-05-19 12:27:15', '2022-05-19 12:27:15'),
(832, 28, 'Mankato', 1, '2022-05-19 12:27:15', '2022-05-19 12:27:15'),
(833, 28, 'Maplewood', 1, '2022-05-19 12:27:15', '2022-05-19 12:27:15'),
(834, 28, 'Moorhead', 1, '2022-05-19 12:27:15', '2022-05-19 12:27:15'),
(835, 28, 'Shakopee', 1, '2022-05-19 12:27:15', '2022-05-19 12:27:15'),
(836, 29, 'Wichita', 1, '2022-05-19 12:27:15', '2022-05-19 12:27:15'),
(837, 29, 'Overland Park', 1, '2022-05-19 12:27:15', '2022-05-19 12:27:15'),
(838, 29, 'Kansas City', 1, '2022-05-19 12:27:15', '2022-05-19 12:27:15'),
(839, 29, 'Olathe', 1, '2022-05-19 12:27:15', '2022-05-19 12:27:15'),
(840, 29, 'Topeka', 1, '2022-05-19 12:27:15', '2022-05-19 12:27:15'),
(841, 29, 'Lawrence', 1, '2022-05-19 12:27:15', '2022-05-19 12:27:15'),
(842, 29, 'Shawnee', 1, '2022-05-19 12:27:16', '2022-05-19 12:27:16'),
(843, 29, 'Manhattan', 1, '2022-05-19 12:27:16', '2022-05-19 12:27:16'),
(844, 29, 'Lenexa', 1, '2022-05-19 12:27:16', '2022-05-19 12:27:16'),
(845, 29, 'Salina', 1, '2022-05-19 12:27:16', '2022-05-19 12:27:16'),
(846, 29, 'Hutchinson', 1, '2022-05-19 12:27:16', '2022-05-19 12:27:16'),
(847, 30, 'New Orleans', 1, '2022-05-19 12:27:16', '2022-05-19 12:27:16'),
(848, 30, 'Baton Rouge', 1, '2022-05-19 12:27:16', '2022-05-19 12:27:16'),
(849, 30, 'Shreveport', 1, '2022-05-19 12:27:16', '2022-05-19 12:27:16'),
(850, 30, 'Lafayette', 1, '2022-05-19 12:27:16', '2022-05-19 12:27:16'),
(851, 30, 'Lake Charles', 1, '2022-05-19 12:27:16', '2022-05-19 12:27:16'),
(852, 30, 'Kenner', 1, '2022-05-19 12:27:16', '2022-05-19 12:27:16'),
(853, 30, 'Bossier City', 1, '2022-05-19 12:27:16', '2022-05-19 12:27:16'),
(854, 30, 'Monroe', 1, '2022-05-19 12:27:16', '2022-05-19 12:27:16'),
(855, 30, 'Alexandria', 1, '2022-05-19 12:27:16', '2022-05-19 12:27:16'),
(856, 31, 'Honolulu', 1, '2022-05-19 12:27:16', '2022-05-19 12:27:16'),
(857, 32, 'Anchorage', 1, '2022-05-19 12:27:16', '2022-05-19 12:27:16'),
(858, 33, 'Newark', 1, '2022-05-19 12:27:16', '2022-05-19 12:27:16'),
(859, 33, 'Jersey City', 1, '2022-05-19 12:27:16', '2022-05-19 12:27:16'),
(860, 33, 'Paterson', 1, '2022-05-19 12:27:16', '2022-05-19 12:27:16'),
(861, 33, 'Elizabeth', 1, '2022-05-19 12:27:17', '2022-05-19 12:27:17'),
(862, 33, 'Clifton', 1, '2022-05-19 12:27:17', '2022-05-19 12:27:17'),
(863, 33, 'Trenton', 1, '2022-05-19 12:27:17', '2022-05-19 12:27:17'),
(864, 33, 'Camden', 1, '2022-05-19 12:27:17', '2022-05-19 12:27:17'),
(865, 33, 'Passaic', 1, '2022-05-19 12:27:17', '2022-05-19 12:27:17'),
(866, 33, 'Union City', 1, '2022-05-19 12:27:17', '2022-05-19 12:27:17'),
(867, 33, 'Bayonne', 1, '2022-05-19 12:27:17', '2022-05-19 12:27:17'),
(868, 33, 'East Orange', 1, '2022-05-19 12:27:17', '2022-05-19 12:27:17'),
(869, 33, 'Vineland', 1, '2022-05-19 12:27:17', '2022-05-19 12:27:17'),
(870, 33, 'New Brunswick', 1, '2022-05-19 12:27:17', '2022-05-19 12:27:17'),
(871, 33, 'Hoboken', 1, '2022-05-19 12:27:17', '2022-05-19 12:27:17'),
(872, 33, 'Perth Amboy', 1, '2022-05-19 12:27:17', '2022-05-19 12:27:17'),
(873, 33, 'West New York', 1, '2022-05-19 12:27:17', '2022-05-19 12:27:17'),
(874, 33, 'Plainfield', 1, '2022-05-19 12:27:17', '2022-05-19 12:27:17'),
(875, 33, 'Hackensack', 1, '2022-05-19 12:27:17', '2022-05-19 12:27:17'),
(876, 33, 'Sayreville', 1, '2022-05-19 12:27:17', '2022-05-19 12:27:17'),
(877, 33, 'Kearny', 1, '2022-05-19 12:27:17', '2022-05-19 12:27:17'),
(878, 33, 'Linden', 1, '2022-05-19 12:27:17', '2022-05-19 12:27:17'),
(879, 33, 'Atlantic City', 1, '2022-05-19 12:27:17', '2022-05-19 12:27:17'),
(880, 34, 'Boise City', 1, '2022-05-19 12:27:17', '2022-05-19 12:27:17'),
(881, 34, 'Nampa', 1, '2022-05-19 12:27:17', '2022-05-19 12:27:17'),
(882, 34, 'Meridian', 1, '2022-05-19 12:27:18', '2022-05-19 12:27:18'),
(883, 34, 'Idaho Falls', 1, '2022-05-19 12:27:18', '2022-05-19 12:27:18'),
(884, 34, 'Pocatello', 1, '2022-05-19 12:27:18', '2022-05-19 12:27:18'),
(885, 34, 'Caldwell', 1, '2022-05-19 12:27:18', '2022-05-19 12:27:18'),
(886, 34, 'Coeur d\'Alene', 1, '2022-05-19 12:27:18', '2022-05-19 12:27:18'),
(887, 34, 'Twin Falls', 1, '2022-05-19 12:27:18', '2022-05-19 12:27:18'),
(888, 35, 'Birmingham', 1, '2022-05-19 12:27:18', '2022-05-19 12:27:18'),
(889, 35, 'Montgomery', 1, '2022-05-19 12:27:19', '2022-05-19 12:27:19'),
(890, 35, 'Mobile', 1, '2022-05-19 12:27:19', '2022-05-19 12:27:19'),
(891, 35, 'Huntsville', 1, '2022-05-19 12:27:19', '2022-05-19 12:27:19'),
(892, 35, 'Tuscaloosa', 1, '2022-05-19 12:27:19', '2022-05-19 12:27:19'),
(893, 35, 'Hoover', 1, '2022-05-19 12:27:19', '2022-05-19 12:27:19'),
(894, 35, 'Dothan', 1, '2022-05-19 12:27:19', '2022-05-19 12:27:19'),
(895, 35, 'Auburn', 1, '2022-05-19 12:27:19', '2022-05-19 12:27:19'),
(896, 35, 'Decatur', 1, '2022-05-19 12:27:19', '2022-05-19 12:27:19'),
(897, 35, 'Madison', 1, '2022-05-19 12:27:19', '2022-05-19 12:27:19'),
(898, 35, 'Florence', 1, '2022-05-19 12:27:19', '2022-05-19 12:27:19'),
(899, 35, 'Gadsden', 1, '2022-05-19 12:27:19', '2022-05-19 12:27:19'),
(900, 36, 'Des Moines', 1, '2022-05-19 12:27:19', '2022-05-19 12:27:19'),
(901, 36, 'Cedar Rapids', 1, '2022-05-19 12:27:19', '2022-05-19 12:27:19'),
(902, 36, 'Davenport', 1, '2022-05-19 12:27:19', '2022-05-19 12:27:19'),
(903, 36, 'Sioux City', 1, '2022-05-19 12:27:19', '2022-05-19 12:27:19'),
(904, 36, 'Iowa City', 1, '2022-05-19 12:27:19', '2022-05-19 12:27:19'),
(905, 36, 'Waterloo', 1, '2022-05-19 12:27:19', '2022-05-19 12:27:19'),
(906, 36, 'Council Bluffs', 1, '2022-05-19 12:27:19', '2022-05-19 12:27:19'),
(907, 36, 'Ames', 1, '2022-05-19 12:27:20', '2022-05-19 12:27:20'),
(908, 36, 'West Des Moines', 1, '2022-05-19 12:27:20', '2022-05-19 12:27:20'),
(909, 36, 'Dubuque', 1, '2022-05-19 12:27:20', '2022-05-19 12:27:20'),
(910, 36, 'Ankeny', 1, '2022-05-19 12:27:20', '2022-05-19 12:27:20'),
(911, 36, 'Urbandale', 1, '2022-05-19 12:27:20', '2022-05-19 12:27:20'),
(912, 36, 'Cedar Falls', 1, '2022-05-19 12:27:20', '2022-05-19 12:27:20'),
(913, 37, 'Little Rock', 1, '2022-05-19 12:27:20', '2022-05-19 12:27:20'),
(914, 37, 'Fort Smith', 1, '2022-05-19 12:27:20', '2022-05-19 12:27:20'),
(915, 37, 'Fayetteville', 1, '2022-05-19 12:27:20', '2022-05-19 12:27:20'),
(916, 37, 'Springdale', 1, '2022-05-19 12:27:20', '2022-05-19 12:27:20'),
(917, 37, 'Jonesboro', 1, '2022-05-19 12:27:20', '2022-05-19 12:27:20'),
(918, 37, 'North Little Rock', 1, '2022-05-19 12:27:21', '2022-05-19 12:27:21'),
(919, 37, 'Conway', 1, '2022-05-19 12:27:21', '2022-05-19 12:27:21'),
(920, 37, 'Rogers', 1, '2022-05-19 12:27:21', '2022-05-19 12:27:21'),
(921, 37, 'Pine Bluff', 1, '2022-05-19 12:27:21', '2022-05-19 12:27:21'),
(922, 37, 'Bentonville', 1, '2022-05-19 12:27:21', '2022-05-19 12:27:21'),
(923, 38, 'Salt Lake City', 1, '2022-05-19 12:27:21', '2022-05-19 12:27:21'),
(924, 38, 'West Valley City', 1, '2022-05-19 12:27:21', '2022-05-19 12:27:21'),
(925, 38, 'Provo', 1, '2022-05-19 12:27:21', '2022-05-19 12:27:21'),
(926, 38, 'West Jordan', 1, '2022-05-19 12:27:21', '2022-05-19 12:27:21'),
(927, 38, 'Orem', 1, '2022-05-19 12:27:21', '2022-05-19 12:27:21'),
(928, 38, 'Sandy', 1, '2022-05-19 12:27:21', '2022-05-19 12:27:21'),
(929, 38, 'Ogden', 1, '2022-05-19 12:27:22', '2022-05-19 12:27:22'),
(930, 38, 'St. George', 1, '2022-05-19 12:27:22', '2022-05-19 12:27:22'),
(931, 38, 'Layton', 1, '2022-05-19 12:27:22', '2022-05-19 12:27:22'),
(932, 38, 'Taylorsville', 1, '2022-05-19 12:27:22', '2022-05-19 12:27:22'),
(933, 38, 'South Jordan', 1, '2022-05-19 12:27:22', '2022-05-19 12:27:22'),
(934, 38, 'Lehi', 1, '2022-05-19 12:27:22', '2022-05-19 12:27:22'),
(935, 38, 'Logan', 1, '2022-05-19 12:27:22', '2022-05-19 12:27:22'),
(936, 38, 'Murray', 1, '2022-05-19 12:27:22', '2022-05-19 12:27:22'),
(937, 38, 'Draper', 1, '2022-05-19 12:27:22', '2022-05-19 12:27:22'),
(938, 38, 'Bountiful', 1, '2022-05-19 12:27:22', '2022-05-19 12:27:22'),
(939, 38, 'Riverton', 1, '2022-05-19 12:27:22', '2022-05-19 12:27:22'),
(940, 38, 'Roy', 1, '2022-05-19 12:27:22', '2022-05-19 12:27:22'),
(941, 39, 'Providence', 1, '2022-05-19 12:27:22', '2022-05-19 12:27:22'),
(942, 39, 'Warwick', 1, '2022-05-19 12:27:22', '2022-05-19 12:27:22'),
(943, 39, 'Cranston', 1, '2022-05-19 12:27:22', '2022-05-19 12:27:22'),
(944, 39, 'Pawtucket', 1, '2022-05-19 12:27:22', '2022-05-19 12:27:22'),
(945, 39, 'East Providence', 1, '2022-05-19 12:27:22', '2022-05-19 12:27:22'),
(946, 39, 'Woonsocket', 1, '2022-05-19 12:27:22', '2022-05-19 12:27:22'),
(947, 40, 'Jackson', 1, '2022-05-19 12:27:22', '2022-05-19 12:27:22'),
(948, 40, 'Gulfport', 1, '2022-05-19 12:27:22', '2022-05-19 12:27:22'),
(949, 40, 'Southaven', 1, '2022-05-19 12:27:22', '2022-05-19 12:27:22'),
(950, 40, 'Hattiesburg', 1, '2022-05-19 12:27:22', '2022-05-19 12:27:22'),
(951, 40, 'Biloxi', 1, '2022-05-19 12:27:22', '2022-05-19 12:27:22'),
(952, 40, 'Meridian', 1, '2022-05-19 12:27:22', '2022-05-19 12:27:22'),
(953, 41, 'Sioux Falls', 1, '2022-05-19 12:27:22', '2022-05-19 12:27:22'),
(954, 41, 'Rapid City', 1, '2022-05-19 12:27:23', '2022-05-19 12:27:23'),
(955, 42, 'Bridgeport', 1, '2022-05-19 12:27:23', '2022-05-19 12:27:23'),
(956, 42, 'New Haven', 1, '2022-05-19 12:27:23', '2022-05-19 12:27:23'),
(957, 42, 'Stamford', 1, '2022-05-19 12:27:23', '2022-05-19 12:27:23'),
(958, 42, 'Hartford', 1, '2022-05-19 12:27:23', '2022-05-19 12:27:23'),
(959, 42, 'Waterbury', 1, '2022-05-19 12:27:23', '2022-05-19 12:27:23'),
(960, 42, 'Norwalk', 1, '2022-05-19 12:27:23', '2022-05-19 12:27:23'),
(961, 42, 'Danbury', 1, '2022-05-19 12:27:23', '2022-05-19 12:27:23'),
(962, 42, 'New Britain', 1, '2022-05-19 12:27:23', '2022-05-19 12:27:23'),
(963, 42, 'Meriden', 1, '2022-05-19 12:27:23', '2022-05-19 12:27:23'),
(964, 42, 'Chicago', 1, '2022-05-19 12:27:23', '2022-05-19 12:27:23'),
(965, 42, 'West Haven', 1, '2022-05-19 12:27:23', '2022-05-19 12:27:23'),
(966, 42, 'Milford', 1, '2022-05-19 12:27:23', '2022-05-19 12:27:23'),
(967, 42, 'Middletown', 1, '2022-05-19 12:27:23', '2022-05-19 12:27:23'),
(968, 42, 'Norwich', 1, '2022-05-19 12:27:23', '2022-05-19 12:27:23'),
(969, 42, 'Shelton', 1, '2022-05-19 12:27:23', '2022-05-19 12:27:23'),
(970, 43, 'Columbia', 1, '2022-05-19 12:27:23', '2022-05-19 12:27:23'),
(971, 43, 'Charleston', 1, '2022-05-19 12:27:24', '2022-05-19 12:27:24'),
(972, 43, 'North Charleston', 1, '2022-05-19 12:27:24', '2022-05-19 12:27:24'),
(973, 43, 'Mount Pleasant', 1, '2022-05-19 12:27:24', '2022-05-19 12:27:24'),
(974, 43, 'Rock Hill', 1, '2022-05-19 12:27:24', '2022-05-19 12:27:24'),
(975, 43, 'Greenville', 1, '2022-05-19 12:27:24', '2022-05-19 12:27:24'),
(976, 43, 'Summerville', 1, '2022-05-19 12:27:24', '2022-05-19 12:27:24'),
(977, 43, 'Sumter', 1, '2022-05-19 12:27:24', '2022-05-19 12:27:24'),
(978, 43, 'Goose Creek', 1, '2022-05-19 12:27:24', '2022-05-19 12:27:24'),
(979, 43, 'Hilton Head Island', 1, '2022-05-19 12:27:24', '2022-05-19 12:27:24'),
(980, 43, 'Florence', 1, '2022-05-19 12:27:24', '2022-05-19 12:27:24'),
(981, 43, 'Spartanburg', 1, '2022-05-19 12:27:24', '2022-05-19 12:27:24'),
(982, 44, 'Manchester', 1, '2022-05-19 12:27:24', '2022-05-19 12:27:24'),
(983, 44, 'Nashua', 1, '2022-05-19 12:27:24', '2022-05-19 12:27:24'),
(984, 44, 'Concord', 1, '2022-05-19 12:27:24', '2022-05-19 12:27:24'),
(985, 45, 'Fargo', 1, '2022-05-19 12:27:24', '2022-05-19 12:27:24'),
(986, 45, 'Bismarck', 1, '2022-05-19 12:27:24', '2022-05-19 12:27:24'),
(987, 45, 'Grand Forks', 1, '2022-05-19 12:27:24', '2022-05-19 12:27:24'),
(988, 45, 'Minot', 1, '2022-05-19 12:27:24', '2022-05-19 12:27:24'),
(989, 46, 'Billings', 1, '2022-05-19 12:27:25', '2022-05-19 12:27:25'),
(990, 46, 'Missoula', 1, '2022-05-19 12:27:25', '2022-05-19 12:27:25'),
(991, 46, 'Great Falls', 1, '2022-05-19 12:27:25', '2022-05-19 12:27:25'),
(992, 46, 'Bozeman', 1, '2022-05-19 12:27:25', '2022-05-19 12:27:25'),
(993, 47, 'Wilmington', 1, '2022-05-19 12:27:25', '2022-05-19 12:27:25'),
(994, 47, 'Dover', 1, '2022-05-19 12:27:25', '2022-05-19 12:27:25'),
(995, 48, 'Portland', 1, '2022-05-19 12:27:25', '2022-05-19 12:27:25'),
(996, 49, 'Cheyenne', 1, '2022-05-19 12:27:25', '2022-05-19 12:27:25'),
(997, 49, 'Casper', 1, '2022-05-19 12:27:25', '2022-05-19 12:27:25'),
(998, 50, 'Charleston', 1, '2022-05-19 12:27:25', '2022-05-19 12:27:25'),
(999, 50, 'Huntington', 1, '2022-05-19 12:27:25', '2022-05-19 12:27:25'),
(1000, 51, 'Burlington', 1, '2022-05-19 12:27:25', '2022-05-19 12:27:25');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1' COMMENT '0=inactive , 1=active',
  `deleted_at` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`, `designation`, `image`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Jane Doe', 'Executive Director', '09-06-2025-225054.png', '1', NULL, '2025-06-09 17:50:54', '2025-06-09 18:03:20'),
(2, 'John Smith', 'Director of Business Development', '09-06-2025-230609.png', '1', NULL, '2025-06-09 18:06:09', '2025-06-09 18:06:09'),
(3, 'Mary Johnson', 'Community Engagement Manager', '09-06-2025-230652.png', '1', NULL, '2025-06-09 18:06:52', '2025-06-09 18:06:52'),
(4, 'David Brown', 'Financial Officer', '09-06-2025-230735.png', '1', NULL, '2025-06-09 18:07:35', '2025-06-09 18:07:35'),
(5, 'David Brown', 'Financial Officer', '10-06-2025-155204.png', '1', NULL, '2025-06-09 18:08:16', '2025-06-10 10:52:04');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `rating` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `slug`, `designation`, `rating`, `image`, `comment`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Robert Ryan', 'robert-ryan', NULL, '5', '03-07-2025-164015.png', '<p>Overcame gym intimidation with strongX\'s friendly atmosphere. Personalized training plan helped me reach my fitness goals. Feeling stronger and more confident!</p>', 1, NULL, '2025-07-03 11:40:15', '2025-07-03 12:13:28'),
(2, 'Michael Field', 'michael-field', NULL, '4', '03-07-2025-171143.png', '<p>Overcame gym intimidation with strongX\'s friendly atmosphere. Personalized training plan helped me reach my fitness goals. Feeling stronger and more confident!</p>', 1, NULL, '2025-07-03 12:11:43', '2025-07-03 12:11:43'),
(3, 'John Doe', 'john-doe', NULL, '3', '03-07-2025-171250.png', '<p>Overcame gym intimidation with strongX\'s friendly atmosphere. Personalized training plan helped me reach my fitness goals. Feeling stronger and more confident!</p>', 1, NULL, '2025-07-03 12:12:50', '2025-07-03 12:12:50');

-- --------------------------------------------------------

--
-- Table structure for table `time_slots`
--

CREATE TABLE `time_slots` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trainer_id` bigint(20) UNSIGNED NOT NULL,
  `availability_id` bigint(20) UNSIGNED DEFAULT NULL,
  `slot_datetime` datetime NOT NULL,
  `is_booked` tinyint(1) NOT NULL DEFAULT 0,
  `booking_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `time_slots`
--

INSERT INTO `time_slots` (`id`, `trainer_id`, `availability_id`, `slot_datetime`, `is_booked`, `booking_id`, `created_at`, `updated_at`) VALUES
(9, 9, 1, '2025-12-15 22:00:00', 0, NULL, '2025-12-10 13:38:49', '2025-12-10 13:38:49'),
(10, 9, 1, '2025-12-22 22:00:00', 0, NULL, '2025-12-10 13:38:49', '2025-12-10 13:38:49'),
(11, 9, 1, '2025-12-29 22:00:00', 0, NULL, '2025-12-10 13:38:49', '2025-12-10 13:38:49'),
(12, 9, 1, '2026-01-05 22:00:00', 0, NULL, '2025-12-10 13:38:49', '2025-12-10 13:38:49'),
(13, 9, 1, '2026-01-12 22:00:00', 0, NULL, '2025-12-10 13:38:49', '2025-12-10 13:38:49'),
(14, 9, 1, '2026-01-19 22:00:00', 0, NULL, '2025-12-10 13:38:49', '2025-12-10 13:38:49'),
(15, 9, 1, '2026-01-26 22:00:00', 0, NULL, '2025-12-10 13:38:49', '2025-12-10 13:38:49'),
(16, 9, 1, '2026-02-02 22:00:00', 0, NULL, '2025-12-10 13:38:49', '2025-12-10 13:38:49'),
(17, 9, 3, '2025-12-16 13:00:00', 0, NULL, '2025-12-10 14:26:12', '2025-12-10 14:26:12'),
(18, 9, 3, '2025-12-23 13:00:00', 0, NULL, '2025-12-10 14:26:12', '2025-12-10 14:26:12'),
(19, 9, 3, '2025-12-30 13:00:00', 0, NULL, '2025-12-10 14:26:12', '2025-12-10 14:26:12'),
(20, 9, 3, '2026-01-06 13:00:00', 0, NULL, '2025-12-10 14:26:12', '2025-12-10 14:26:12'),
(21, 9, 3, '2026-01-13 13:00:00', 0, NULL, '2025-12-10 14:26:12', '2025-12-10 14:26:12'),
(22, 9, 3, '2026-01-20 13:00:00', 0, NULL, '2025-12-10 14:26:12', '2025-12-10 14:26:12'),
(23, 9, 3, '2026-01-27 13:00:00', 0, NULL, '2025-12-10 14:26:12', '2025-12-10 14:26:12'),
(24, 9, 3, '2026-02-03 13:00:00', 0, NULL, '2025-12-10 14:26:12', '2025-12-10 14:26:12'),
(79, 10, 5, '2025-12-12 22:00:00', 0, NULL, '2025-12-12 15:15:17', '2025-12-12 15:15:17'),
(80, 10, 4, '2025-12-15 22:00:00', 0, NULL, '2025-12-12 15:15:17', '2025-12-12 15:15:17'),
(81, 10, 6, '2025-12-15 20:00:00', 0, NULL, '2025-12-12 15:15:17', '2025-12-12 15:15:17'),
(82, 10, 7, '2025-12-16 22:00:00', 0, NULL, '2025-12-12 15:15:17', '2025-12-12 15:15:17'),
(83, 10, 5, '2025-12-19 22:00:00', 0, NULL, '2025-12-12 15:15:17', '2025-12-12 15:15:17'),
(84, 10, 4, '2025-12-22 22:00:00', 0, NULL, '2025-12-12 15:15:17', '2025-12-12 15:15:17'),
(85, 10, 6, '2025-12-22 20:00:00', 0, NULL, '2025-12-12 15:15:17', '2025-12-12 15:15:17'),
(86, 10, 7, '2025-12-23 22:00:00', 0, NULL, '2025-12-12 15:15:17', '2025-12-12 15:15:17'),
(87, 10, 5, '2025-12-26 22:00:00', 0, NULL, '2025-12-12 15:15:17', '2025-12-12 15:15:17'),
(88, 10, 4, '2025-12-29 22:00:00', 0, NULL, '2025-12-12 15:15:17', '2025-12-12 15:15:17'),
(89, 10, 6, '2025-12-29 20:00:00', 0, NULL, '2025-12-12 15:15:17', '2025-12-12 15:15:17'),
(90, 10, 7, '2025-12-30 22:00:00', 0, NULL, '2025-12-12 15:15:17', '2025-12-12 15:15:17'),
(91, 10, 5, '2026-01-02 22:00:00', 0, NULL, '2025-12-12 15:15:17', '2025-12-12 15:15:17'),
(92, 10, 4, '2026-01-05 22:00:00', 0, NULL, '2025-12-12 15:15:17', '2025-12-12 15:15:17'),
(93, 10, 6, '2026-01-05 20:00:00', 0, NULL, '2025-12-12 15:15:17', '2025-12-12 15:15:17'),
(94, 10, 7, '2026-01-06 22:00:00', 0, NULL, '2025-12-12 15:15:17', '2025-12-12 15:15:17'),
(95, 10, 5, '2026-01-09 22:00:00', 0, NULL, '2025-12-12 15:15:17', '2025-12-12 15:15:17'),
(96, 10, 4, '2026-01-12 22:00:00', 0, NULL, '2025-12-12 15:15:17', '2025-12-12 15:15:17'),
(97, 10, 6, '2026-01-12 20:00:00', 0, NULL, '2025-12-12 15:15:17', '2025-12-12 15:15:17'),
(98, 10, 7, '2026-01-13 22:00:00', 0, NULL, '2025-12-12 15:15:17', '2025-12-12 15:15:17'),
(99, 10, 5, '2026-01-16 22:00:00', 0, NULL, '2025-12-12 15:15:17', '2025-12-12 15:15:17'),
(100, 10, 4, '2026-01-19 22:00:00', 0, NULL, '2025-12-12 15:15:17', '2025-12-12 15:15:17'),
(101, 10, 6, '2026-01-19 20:00:00', 0, NULL, '2025-12-12 15:15:17', '2025-12-12 15:15:17'),
(102, 10, 7, '2026-01-20 22:00:00', 0, NULL, '2025-12-12 15:15:17', '2025-12-12 15:15:17'),
(103, 10, 5, '2026-01-23 22:00:00', 0, NULL, '2025-12-12 15:15:17', '2025-12-12 15:15:17'),
(104, 10, 4, '2026-01-26 22:00:00', 0, NULL, '2025-12-12 15:15:17', '2025-12-12 15:15:17'),
(105, 10, 6, '2026-01-26 20:00:00', 0, NULL, '2025-12-12 15:15:17', '2025-12-12 15:15:17'),
(106, 10, 7, '2026-01-27 22:00:00', 0, NULL, '2025-12-12 15:15:17', '2025-12-12 15:15:17'),
(107, 10, 5, '2026-01-30 22:00:00', 0, NULL, '2025-12-12 15:15:17', '2025-12-12 15:15:17'),
(108, 10, 4, '2026-02-02 22:00:00', 0, NULL, '2025-12-12 15:15:17', '2025-12-12 15:15:17'),
(109, 10, 6, '2026-02-02 20:00:00', 0, NULL, '2025-12-12 15:15:17', '2025-12-12 15:15:17'),
(110, 10, 7, '2026-02-03 22:00:00', 0, NULL, '2025-12-12 15:15:17', '2025-12-12 15:15:17'),
(111, 10, 5, '2026-02-06 22:00:00', 0, NULL, '2025-12-12 15:15:17', '2025-12-12 15:15:17'),
(112, 10, 4, '2026-02-09 22:00:00', 0, NULL, '2025-12-12 15:15:17', '2025-12-12 15:15:17'),
(113, 10, 6, '2026-02-09 20:00:00', 0, NULL, '2025-12-12 15:15:17', '2025-12-12 15:15:17'),
(114, 10, 7, '2026-02-10 22:00:00', 0, NULL, '2025-12-12 15:15:17', '2025-12-12 15:15:17');

-- --------------------------------------------------------

--
-- Table structure for table `trainers`
--

CREATE TABLE `trainers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `trainer_type` varchar(255) DEFAULT NULL,
  `google_calendar_id` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `rating` varchar(255) DEFAULT NULL,
  `specialization` mediumtext DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1' COMMENT '0=inactive , 1=active',
  `deleted_at` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trainers`
--

INSERT INTO `trainers` (`id`, `created_by`, `trainer_type`, `google_calendar_id`, `description`, `price`, `rating`, `specialization`, `city`, `state`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 1, 'Gym Trainer', 'AYqNkNDybjf6wYGH9', 'Personalized workout plans and strength training sessions tailored to your fitness goals, whether you\'re a beginner or advanced.', '40', '4', '[\"Strength & Conditioning\",\"Bodybuilding\",\"Functional Training\",\"Weight Loss\"]', '0', '0', '1', NULL, '2025-07-08 17:26:41', '2025-12-03 16:31:30'),
(3, 1, 'Yoga Trainer', 'asjadmmc67@gmail.com', 'Guided yoga sessions focusing on flexibility, mindfulness, and relaxation for all skill levels, from beginners to experienced yogis.', '35', '4', '[\"Vinyasa & Hatha Yoga\",\"Flexibility & Mobility\",\"Mindfulness & Meditation\",\"Stress Relief & Recovery\"]', '0', '0', '1', NULL, '2025-07-08 18:09:21', '2025-12-03 14:19:52'),
(4, 1, 'Kickfit Trainer', NULL, 'High-energy kickboxing fitness classes designed to boost your cardio, coordination, and strength while burning calories.', '45', '4', '[\"Kickboxing & Cardio Conditioning\",\"Agility & Coordination\",\"Combat Fitness\",\"Fat Burn & Endurance\"]', '0', '0', '1', NULL, '2025-07-08 18:10:44', '2025-07-08 18:10:44'),
(5, 1, 'Group-X Trainer', NULL, 'Motivating group exercise classes including aerobics, dance, and functional training to keep you energized and socially connected.', '30', '4', '[\"Group Aerobics & Dance\",\"Circuit & HIIT Training\",\"Team Motivation\",\"Total Body Conditioning\"]', '0', '0', '1', NULL, '2025-07-08 18:12:26', '2025-07-08 18:12:26'),
(6, 1, 'In-Person Only', NULL, 'Personalized coaching tailored for women going through menopause, as well as individuals\r\n managing obesity and long-term health challenges. Sarah provides empathetic, focused guidance\r\n for fitness and wellness goals.', '35', '4', '[\"Menopause Coaching\",\"Personal Training\",\"Weight Management\",\"Health for Chronic Conditions\"]', 'Bolton Le Sands', 'England', '1', NULL, '2025-07-15 14:05:52', '2025-07-15 17:12:29'),
(7, 1, 'In-Person & Online', NULL, 'Offering tailored personal training and nutrition guidance in both small-group and individual formats.\r\n Lance helps clients build consistency in their fitness journey-whether in person or online.', '40', '4', '[\"Personal Training\",\"Nutrition Coaching\",\"Semi-private\\/Small Group Training\",\"Online Training\"]', 'Sanford', 'Florida', '1', NULL, '2025-07-15 16:34:00', '2025-07-15 17:11:56'),
(8, 1, 'In-Person Only', NULL, 'Helping individuals transform their fitness with in-person sessions focused on strength, endurance,\r\n and overall wellness. Kaushik is passionate about building visibility and empowering others to build\r\n healthier habits.', '30', '4', '[\"Functional Fitness\",\"General Conditioning\",\"Strength Building\",\"Fitness for Beginners\"]', 'Oshiwara', 'India', '1', NULL, '2025-07-15 17:32:00', '2025-07-15 17:32:00'),
(9, 20, NULL, NULL, 'Specialized in strength training and weight loss with 10+ years of experience.', '80', NULL, NULL, NULL, NULL, '1', NULL, '2025-12-09 17:30:52', '2025-12-09 17:30:52'),
(10, 21, NULL, NULL, 'Expert in yoga, pilates, and flexibility training. Certified instructor since 2015.', '80', NULL, NULL, NULL, NULL, '1', NULL, '2025-12-09 17:30:52', '2025-12-11 11:03:18'),
(11, 22, NULL, NULL, 'High-intensity interval training and CrossFit specialist. Former athlete.', '62', NULL, NULL, NULL, NULL, '1', NULL, '2025-12-09 17:30:52', '2025-12-09 17:30:52'),
(12, 27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '2025-12-12 16:08:09', '2025-12-12 16:08:09'),
(13, 28, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '2025-12-12 16:17:11', '2025-12-12 16:17:11'),
(14, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '2025-12-12 16:20:48', '2025-12-12 16:20:48'),
(15, 30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '2025-12-12 16:45:10', '2025-12-12 16:46:00'),
(17, 32, 'Trainer', NULL, 'Nisi dolore illum e', '70', '1', '[\"test\",\"testing\"]', 'Karachi', 'Sindh', '1', NULL, '2025-12-12 17:31:40', '2025-12-12 17:31:43');

-- --------------------------------------------------------

--
-- Table structure for table `trainer_google_accounts`
--

CREATE TABLE `trainer_google_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trainer_id` bigint(20) UNSIGNED NOT NULL,
  `access_token` text NOT NULL,
  `refresh_token` text NOT NULL,
  `calendar_id` varchar(255) DEFAULT NULL,
  `token_expiry` timestamp NULL DEFAULT NULL,
  `is_connected` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trainer_pricing`
--

CREATE TABLE `trainer_pricing` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trainer_id` bigint(20) UNSIGNED NOT NULL,
  `session_duration` enum('30','45','60') NOT NULL COMMENT 'Duration in minutes',
  `price` decimal(10,2) NOT NULL,
  `currency` varchar(3) NOT NULL DEFAULT 'USD',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trainer_pricing`
--

INSERT INTO `trainer_pricing` (`id`, `trainer_id`, `session_duration`, `price`, `currency`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 9, '30', 40.00, 'USD', 1, '2025-12-10 11:53:50', '2025-12-10 11:53:50'),
(2, 9, '45', 90.00, 'USD', 1, '2025-12-10 11:53:50', '2025-12-10 11:53:50'),
(3, 9, '60', 120.00, 'USD', 1, '2025-12-10 11:53:50', '2025-12-10 11:53:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `package_id` int(11) DEFAULT NULL,
  `category_id` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `team` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `top_rated` varchar(255) DEFAULT '0' COMMENT '0=inactive, 1= active	',
  `leaderboard` varchar(255) DEFAULT '0' COMMENT '0=inactive, 1= active	',
  `about_me` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `whatsapp` varchar(255) DEFAULT NULL,
  `skype` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `city_id` bigint(20) DEFAULT NULL,
  `state_id` bigint(20) DEFAULT NULL,
  `zip_code` bigint(20) DEFAULT NULL,
  `license` bigint(20) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `verify_token` varchar(100) DEFAULT NULL,
  `deleted_at` varchar(255) DEFAULT NULL,
  `expiry_date` timestamp NULL DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1' COMMENT '0=inactive, 1= active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `role`, `package_id`, `category_id`, `designation`, `team`, `phone`, `email`, `address`, `top_rated`, `leaderboard`, `about_me`, `date_of_birth`, `gender`, `whatsapp`, `skype`, `facebook`, `twitter`, `instagram`, `linkedin`, `youtube`, `city_id`, `state_id`, `zip_code`, `license`, `image`, `email_verified_at`, `password`, `verify_token`, `deleted_at`, `expiry_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'admin@gmail.com', NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$QowHn04SUEIx8Lo.kQahTehd1cmYS2NnLkwDlqRARD7bVtpnNg/mi', '676f265264ab2', NULL, NULL, '1', NULL, NULL),
(19, 'Admin User', NULL, 'trainer', NULL, NULL, NULL, NULL, '1234567890', 'admin@fitnex.com', NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$ZQzKLxE9Evo/35EfRPCAV.VMVzQ3Bl5ejz/BuGq7hux5KTjb9S6lK', NULL, NULL, NULL, '1', '2025-12-09 17:30:51', '2025-12-09 17:30:51'),
(20, 'John Smith', NULL, 'trainer', NULL, NULL, NULL, NULL, '5552445845', 'john.trainer@fitnex.com', NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1765390919.jpg', NULL, '$2y$10$1XY8vEd05xFImtmfln4UfeByNlpg.ZKcSSa4ENIj8BjurGlafW2gS', NULL, NULL, NULL, '1', '2025-12-09 17:30:52', '2025-12-10 13:21:59'),
(21, 'Sarah Johnson', NULL, 'trainer', NULL, NULL, NULL, NULL, '5559676546', 'sarah.trainer@fitnex.com', NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1765468998.jpg', NULL, '$2y$10$1qPHHqBf5b94ttlez4anxe4MbQfUCj8wYD/5RmfNVO9p4RsaA8TVi', NULL, NULL, NULL, '1', '2025-12-09 17:30:52', '2025-12-11 11:03:18'),
(22, 'Mike Davis', NULL, 'trainer', NULL, NULL, NULL, NULL, '5557908018', 'mike.trainer@fitnex.com', NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$BVPeMDBSz3oHGQL4AWjsN.Ju3m7BG2Zr2OTLMuZqLDUwyl3ggd.GO', NULL, NULL, NULL, '1', '2025-12-09 17:30:52', '2025-12-09 17:30:52'),
(23, 'Alice Brown', NULL, 'trainer', NULL, NULL, NULL, NULL, '5553123658', 'alice@example.com', NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$f10PecAoBzrpWttyPplbh.n42.BVvKM0oobRQ0hvo4S3sXmePsfL.', NULL, NULL, NULL, '1', '2025-12-09 17:30:52', '2025-12-09 17:30:52'),
(24, 'Bob Wilson', NULL, 'trainer', NULL, NULL, NULL, NULL, '5558727390', 'bob@example.com', NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$eWxZLjYo8Fi3BODOD/RxtOI9.Y..E5dZbCapO4NKJ31mLFXmBfx8.', NULL, NULL, NULL, '1', '2025-12-09 17:30:53', '2025-12-09 17:30:53'),
(25, 'Carol Martinez', NULL, 'trainer', NULL, NULL, NULL, NULL, '5557912722', 'carol@example.com', NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$QMZvxaB2IGRiCHPirGPaXudEcjpm.rqVtsLtUi/aPzREGSvTzllNa', NULL, NULL, NULL, '1', '2025-12-09 17:30:53', '2025-12-09 17:30:53'),
(30, 'Scarlet', 'Grant', 'trainer', NULL, NULL, NULL, NULL, '+1 (423) 261-4691', 'herryview@yopmail.com', NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1765575960.jpg', '2025-12-12 16:39:15', '$2y$10$jzOT.hcA2yRmpBR7q58XbO0UayeXFOC6ZPTr/Tptg8w2oEDjueI9y', NULL, NULL, NULL, '1', '2025-12-12 16:39:02', '2025-12-12 16:46:00'),
(32, 'jukoqiji', NULL, 'Trainer', NULL, NULL, 'wumygica@mailinator.com', NULL, '1231231231', 'asjadmmc67@gmail', NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '25-12-12-223140.jpg', NULL, '$2y$10$/GYiLXiQk66gknnIWWcUwull6CyKGPNwalz9tZVBBgdfrVX40.lF.', NULL, NULL, NULL, '1', '2025-12-12 17:31:39', '2025-12-12 17:31:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advertisements`
--
ALTER TABLE `advertisements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointments_user_id_foreign` (`user_id`),
  ADD KEY `appointments_trainer_id_foreign` (`trainer_id`);

--
-- Indexes for table `availabilities`
--
ALTER TABLE `availabilities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `availabilities_trainer_id_day_of_week_index` (`trainer_id`,`day_of_week`),
  ADD KEY `availabilities_is_active_index` (`is_active`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blocked_slots`
--
ALTER TABLE `blocked_slots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blocked_slots_trainer_id_date_index` (`trainer_id`,`date`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_time_slot_id_foreign` (`time_slot_id`),
  ADD KEY `bookings_cancelled_by_foreign` (`cancelled_by`),
  ADD KEY `bookings_user_id_booking_status_index` (`user_id`,`booking_status`),
  ADD KEY `bookings_trainer_id_booking_status_index` (`trainer_id`,`booking_status`),
  ADD KEY `bookings_payment_status_index` (`payment_status`),
  ADD KEY `bookings_stripe_session_id_index` (`stripe_session_id`);

--
-- Indexes for table `booking_reschedules`
--
ALTER TABLE `booking_reschedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_reschedules_old_slot_id_foreign` (`old_slot_id`),
  ADD KEY `booking_reschedules_new_slot_id_foreign` (`new_slot_id`),
  ADD KEY `booking_reschedules_booking_id_index` (`booking_id`),
  ADD KEY `booking_reschedules_rescheduled_by_index` (`rescheduled_by`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_contacts`
--
ALTER TABLE `client_contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon_usages`
--
ALTER TABLE `coupon_usages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document_repositories`
--
ALTER TABLE `document_repositories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `document_repositories_project_id_foreign` (`project_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `f_a_q_s`
--
ALTER TABLE `f_a_q_s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_sliders`
--
ALTER TABLE `home_sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_posts`
--
ALTER TABLE `job_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_post_categories`
--
ALTER TABLE `job_post_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_directories`
--
ALTER TABLE `member_directories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `news_letters`
--
ALTER TABLE `news_letters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_settings`
--
ALTER TABLE `page_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_categories`
--
ALTER TABLE `project_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_slots`
--
ALTER TABLE `time_slots`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `time_slots_trainer_id_slot_datetime_unique` (`trainer_id`,`slot_datetime`),
  ADD KEY `time_slots_availability_id_foreign` (`availability_id`),
  ADD KEY `time_slots_trainer_id_slot_datetime_index` (`trainer_id`,`slot_datetime`),
  ADD KEY `time_slots_trainer_id_is_booked_index` (`trainer_id`,`is_booked`),
  ADD KEY `time_slots_slot_datetime_index` (`slot_datetime`);

--
-- Indexes for table `trainers`
--
ALTER TABLE `trainers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trainer_google_accounts`
--
ALTER TABLE `trainer_google_accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `trainer_google_accounts_trainer_id_unique` (`trainer_id`),
  ADD KEY `trainer_google_accounts_is_connected_index` (`is_connected`);

--
-- Indexes for table `trainer_pricing`
--
ALTER TABLE `trainer_pricing`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `trainer_pricing_trainer_id_session_duration_unique` (`trainer_id`,`session_duration`),
  ADD KEY `trainer_pricing_trainer_id_is_active_index` (`trainer_id`,`is_active`);

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
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `advertisements`
--
ALTER TABLE `advertisements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `availabilities`
--
ALTER TABLE `availabilities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `blocked_slots`
--
ALTER TABLE `blocked_slots`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `booking_reschedules`
--
ALTER TABLE `booking_reschedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `client_contacts`
--
ALTER TABLE `client_contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `coupon_usages`
--
ALTER TABLE `coupon_usages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `document_repositories`
--
ALTER TABLE `document_repositories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `f_a_q_s`
--
ALTER TABLE `f_a_q_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `home_sliders`
--
ALTER TABLE `home_sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `job_posts`
--
ALTER TABLE `job_posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `job_post_categories`
--
ALTER TABLE `job_post_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `member_directories`
--
ALTER TABLE `member_directories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=187;

--
-- AUTO_INCREMENT for table `news_letters`
--
ALTER TABLE `news_letters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `page_settings`
--
ALTER TABLE `page_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=225;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=286;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `project_categories`
--
ALTER TABLE `project_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1001;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `time_slots`
--
ALTER TABLE `time_slots`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `trainers`
--
ALTER TABLE `trainers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `trainer_google_accounts`
--
ALTER TABLE `trainer_google_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trainer_pricing`
--
ALTER TABLE `trainer_pricing`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_trainer_id_foreign` FOREIGN KEY (`trainer_id`) REFERENCES `trainers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `availabilities`
--
ALTER TABLE `availabilities`
  ADD CONSTRAINT `availabilities_trainer_id_foreign` FOREIGN KEY (`trainer_id`) REFERENCES `trainers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `blocked_slots`
--
ALTER TABLE `blocked_slots`
  ADD CONSTRAINT `blocked_slots_trainer_id_foreign` FOREIGN KEY (`trainer_id`) REFERENCES `trainers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_cancelled_by_foreign` FOREIGN KEY (`cancelled_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `bookings_time_slot_id_foreign` FOREIGN KEY (`time_slot_id`) REFERENCES `time_slots` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_trainer_id_foreign` FOREIGN KEY (`trainer_id`) REFERENCES `trainers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `booking_reschedules`
--
ALTER TABLE `booking_reschedules`
  ADD CONSTRAINT `booking_reschedules_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `booking_reschedules_new_slot_id_foreign` FOREIGN KEY (`new_slot_id`) REFERENCES `time_slots` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `booking_reschedules_old_slot_id_foreign` FOREIGN KEY (`old_slot_id`) REFERENCES `time_slots` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `booking_reschedules_rescheduled_by_foreign` FOREIGN KEY (`rescheduled_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `document_repositories`
--
ALTER TABLE `document_repositories`
  ADD CONSTRAINT `document_repositories_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `time_slots`
--
ALTER TABLE `time_slots`
  ADD CONSTRAINT `time_slots_availability_id_foreign` FOREIGN KEY (`availability_id`) REFERENCES `availabilities` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `time_slots_trainer_id_foreign` FOREIGN KEY (`trainer_id`) REFERENCES `trainers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `trainer_google_accounts`
--
ALTER TABLE `trainer_google_accounts`
  ADD CONSTRAINT `trainer_google_accounts_trainer_id_foreign` FOREIGN KEY (`trainer_id`) REFERENCES `trainers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `trainer_pricing`
--
ALTER TABLE `trainer_pricing`
  ADD CONSTRAINT `trainer_pricing_trainer_id_foreign` FOREIGN KEY (`trainer_id`) REFERENCES `trainers` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
