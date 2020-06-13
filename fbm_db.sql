-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2020 at 08:57 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fbm`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounting_contacts`
--

CREATE TABLE `accounting_contacts` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `post_code` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounting_contacts`
--

INSERT INTO `accounting_contacts` (`id`, `client_id`, `first_name`, `email`, `telephone`, `post_code`, `created_at`, `updated_at`) VALUES
(1, 1, 'Nangi', 'mangapanchu@gmail.com', '4168767055', NULL, '2019-10-10 11:09:44', '2019-10-10 11:09:44'),
(2, 2, 'maaga', 'mangapanchu@gmail.com', '4168767055', NULL, '2019-11-06 21:37:28', '2019-11-06 21:37:28'),
(3, 3, 'Nangi', 'mangapanchu@gmail.com', '4168767055', NULL, '2019-11-12 08:45:43', '2019-11-12 11:46:06'),
(4, 4, 'df', 'mangapanchu@gmail.com', '4168767055', NULL, '2019-11-12 10:55:18', '2019-11-12 10:55:18'),
(6, 8, 'eererere', 'rachithamadhawa@gmail.com', '+94779605539', NULL, '2020-05-05 22:19:06', '2020-05-05 22:19:06'),
(7, 9, 'eererere', 'rachithamadhawa@gmail.com', '+94779605539', NULL, '2020-05-05 22:29:51', '2020-05-05 22:29:51');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `street_number` varchar(255) DEFAULT NULL,
  `street_name` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `post_code` varchar(10) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `agreement_start` datetime DEFAULT NULL,
  `level` tinyint(4) DEFAULT NULL,
  `pan_number` varchar(255) DEFAULT NULL,
  `initial_password` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `termination` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `user_id`, `first_name`, `last_name`, `street_number`, `street_name`, `city`, `post_code`, `telephone`, `mobile`, `agreement_start`, `level`, `pan_number`, `initial_password`, `updated_at`, `created_at`, `deleted_at`, `termination`) VALUES
(1, 1, 'Super', 'Admin', 'street', 'street', 'ciry', 'postcode', 'telephone', 'mobile', '2018-08-28 05:05:03', 0, '', '123456', '2018-08-28 05:05:16', '2018-08-28 05:05:17', NULL, NULL),
(5, 13, 'test', 'admin', 'Thotupalawattha', 'test', 'Kalutara', '0014', '+94779605539', '+94779605539', '2020-05-13 00:00:00', 1, 'FBM 00013', 'iQMdsw', '2020-05-12 23:22:56', '2020-05-12 23:22:56', NULL, NULL),
(6, 14, 'test', 'rachitha', 'Thotupalawattha', 'test', 'Kalutara', '0014', '+94779605539', '+94779605539', '2020-05-13 00:00:00', 1, 'FBM 00014', 'QN321l', '2020-05-14 07:42:13', '2020-05-13 00:06:01', NULL, 'ssssss');

-- --------------------------------------------------------

--
-- Table structure for table `alerts`
--

CREATE TABLE `alerts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alerts`
--

INSERT INTO `alerts` (`id`, `title`, `message`, `type`, `date`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'dust on table', 'Please check task 1-2019-10-10 11:48:53-task for new complaint', 'cleaner', '2019-10-10 00:00:00', 1, '2019-10-10 11:48:54', '2019-10-10 11:56:19', '2019-10-10 11:56:19'),
(2, 'dust on table', 'Please check task 1-2019-10-10 11:48:53-task for new complaint', 'inspector', '2019-10-10 00:00:00', 1, '2019-10-10 11:48:54', '2019-10-10 11:56:19', '2019-10-10 11:56:19'),
(3, 'asdf', 'Please check task 1-2019-10-29 01:41:08-task for new complaint', 'cleaner', '2019-10-29 00:00:00', 1, '2019-10-29 01:41:09', '2019-11-13 11:17:49', '2019-11-13 11:17:49'),
(4, 'asdf', 'Please check task 1-2019-10-29 01:41:08-task for new complaint', 'inspector', '2019-10-29 00:00:00', 1, '2019-10-29 01:41:09', '2019-11-13 11:17:49', '2019-11-13 11:17:49'),
(5, 'did not set alarm', 'Please check task 1-2019-11-06 21:54:37-task for new complaint', 'cleaner', '2019-11-06 00:00:00', 1, '2019-11-06 21:54:37', '2019-11-13 11:17:38', '2019-11-13 11:17:38'),
(6, 'did not set alarm', 'Please check task 1-2019-11-06 21:54:37-task for new complaint', 'inspector', '2019-11-06 00:00:00', 1, '2019-11-06 21:54:37', '2019-11-13 11:17:38', '2019-11-13 11:17:38'),
(7, 'dust at front desk', 'Please check task 1-2019-11-13 11:18:41-task for new complaint', 'cleaner', '2019-11-13 00:00:00', 1, '2019-11-13 11:18:43', '2020-01-20 05:33:18', '2020-01-20 05:33:18'),
(8, 'dust at front desk', 'Please check task 1-2019-11-13 11:18:41-task for new complaint', 'inspector', '2019-11-13 00:00:00', 1, '2019-11-13 11:18:43', '2020-01-20 05:33:18', '2020-01-20 05:33:18'),
(9, 'Under table & chairs', 'Please check task 1-2019-11-13 13:56:04-task for new complaint', 'cleaner', '2019-11-13 00:00:00', 1, '2019-11-13 13:56:04', '2019-11-13 13:56:04', NULL),
(10, 'test', 'Please check task 10-2020-05-14 07:25:46-task for new complaint', 'cleaner', '2020-05-14 00:00:00', 1, '2020-05-14 07:25:48', '2020-05-19 01:42:28', '2020-05-19 01:42:28'),
(11, 'test', 'Please check task 10-2020-05-14 07:25:46-task for new complaint', 'inspector', '2020-05-14 00:00:00', 1, '2020-05-14 07:25:48', '2020-05-19 01:42:28', '2020-05-19 01:42:28'),
(12, 'qwert', 'Please check task 11-2020-05-18 07:17:03-task for new complaint', 'cleaner', '2020-05-18 00:00:00', 1, '2020-05-18 07:17:06', '2020-05-18 08:53:33', '2020-05-18 08:53:33'),
(13, 'qwert', 'Please check task 11-2020-05-18 07:17:03-task for new complaint', 'inspector', '2020-05-18 00:00:00', 1, '2020-05-18 07:17:06', '2020-05-18 08:53:33', '2020-05-18 08:53:33'),
(14, 'ewewe', 'Please check task 7-2020-05-19 03:02:35-task for new complaint', 'cleaner', '2020-05-19 00:00:00', 1, '2020-05-19 03:02:37', '2020-05-19 03:08:23', '2020-05-19 03:08:23'),
(15, 'ewewe', 'Please check task 7-2020-05-19 03:02:35-task for new complaint', 'inspector', '2020-05-19 00:00:00', 1, '2020-05-19 03:02:37', '2020-05-19 03:08:23', '2020-05-19 03:08:23'),
(16, 'ttttttttttttttttttttttttttttttt', 'Please check task 11-2020-05-19 03:23:22-task for new complaint', 'cleaner', '2020-05-19 00:00:00', 1, '2020-05-19 03:23:24', '2020-05-19 03:23:24', NULL),
(17, 'ttttttttttttttttttttttttttttttt', 'Please check task 11-2020-05-19 03:23:22-task for new complaint', 'inspector', '2020-05-19 00:00:00', 1, '2020-05-19 03:23:24', '2020-05-19 03:23:24', NULL),
(18, 'qqqqqqqqqqqqqqqqqqqqqqq', 'Please check task 7-2020-05-19 03:25:30-task for new complaint', 'cleaner', '2020-05-19 00:00:00', 1, '2020-05-19 03:25:32', '2020-05-19 03:25:32', NULL),
(19, 'qqqqqqqqqqqqqqqqqqqqqqq', 'Please check task 7-2020-05-19 03:25:30-task for new complaint', 'inspector', '2020-05-19 00:00:00', 1, '2020-05-19 03:25:33', '2020-05-19 03:25:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Regular Office', '2019-10-10 10:57:07', '2019-10-10 10:57:07', NULL),
(2, 'Restaurant', '2019-10-10 10:57:32', '2019-10-10 10:57:32', NULL),
(3, 'Dealer Ship', '2019-10-10 10:57:56', '2019-10-10 10:57:56', NULL),
(4, 'test', '2020-04-24 07:04:44', '2020-04-24 07:04:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `checklists`
--

CREATE TABLE `checklists` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `order` int(10) UNSIGNED DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `checklists`
--

INSERT INTO `checklists` (`id`, `category_id`, `title`, `order`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Entrance', 0, '2019-10-10 11:34:32', '2019-10-10 11:34:32', NULL),
(2, 1, 'Reception', 1, '2019-10-10 11:34:32', '2019-10-10 11:34:32', NULL),
(3, 1, 'tt', 0, '2019-10-30 02:37:25', '2019-10-30 02:37:25', NULL),
(4, 1, 'bybg', 1, '2019-10-30 02:37:25', '2019-10-30 02:37:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `checklist_items`
--

CREATE TABLE `checklist_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `checklist_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `sunday` tinyint(1) DEFAULT 0,
  `monday` tinyint(1) DEFAULT 0,
  `tuesday` tinyint(1) DEFAULT 0,
  `wednesday` tinyint(1) DEFAULT 0,
  `thursday` tinyint(1) DEFAULT 0,
  `friday` tinyint(1) DEFAULT 0,
  `saturday` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `checklist_items`
--

INSERT INTO `checklist_items` (`id`, `checklist_id`, `name`, `order`, `sunday`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Cob Web (in/out & corners)', 0, 0, 0, 0, 0, 0, 0, 0, '2019-10-10 11:34:32', '2019-10-10 11:34:32', NULL),
(2, 1, 'Double door glass(both side)', 1, 0, 0, 0, 0, 0, 0, 0, '2019-10-10 11:34:32', '2019-10-10 11:34:32', NULL),
(3, 1, 'Base board/Vents/Ledges', 2, 0, 0, 0, 0, 0, 0, 0, '2019-10-10 11:34:32', '2019-10-10 11:34:32', NULL),
(4, 1, 'Mats & Carpets', 3, 0, 0, 0, 0, 0, 0, 0, '2019-10-10 11:34:32', '2019-10-10 11:34:32', NULL),
(5, 2, 'Wall fixture', 0, 0, 0, 0, 0, 0, 0, 0, '2019-10-10 11:34:32', '2019-10-10 11:34:32', NULL),
(6, 2, 'Monitors & Screens', 1, 0, 0, 0, 0, 0, 0, 0, '2019-10-10 11:34:32', '2019-10-10 11:34:32', NULL),
(7, 2, 'Garbage Bins', 2, 0, 0, 0, 0, 0, 0, 0, '2019-10-10 11:34:32', '2019-10-10 11:34:32', NULL),
(8, 2, 'Table & Chairs', 3, 0, 0, 0, 0, 0, 0, 0, '2019-10-10 11:34:32', '2019-10-10 11:34:32', NULL),
(9, 2, 'Under table & chairs', 4, 0, 0, 0, 0, 0, 0, 0, '2019-10-10 11:34:32', '2019-10-10 11:34:32', NULL),
(10, 3, 'yy', 0, 0, 0, 0, 0, 0, 0, 0, '2019-10-30 02:37:25', '2019-10-30 02:37:25', NULL),
(11, 3, 'tty', 1, 0, 0, 0, 0, 0, 0, 0, '2019-10-30 02:37:25', '2019-10-30 02:37:25', NULL),
(12, 4, 'hbhb', 0, 0, 0, 0, 0, 0, 0, 0, '2019-10-30 02:37:25', '2019-10-30 02:37:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `checklist_item_feedbacks`
--

CREATE TABLE `checklist_item_feedbacks` (
  `id` int(10) UNSIGNED NOT NULL,
  `checklist_item_id` int(10) UNSIGNED DEFAULT NULL,
  `inspector_id` int(11) DEFAULT NULL,
  `task_id` int(11) DEFAULT NULL,
  `inspector_schedule_id` int(11) DEFAULT NULL,
  `feedback` int(10) UNSIGNED DEFAULT NULL,
  `audio` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `checklist_item_feedbacks`
--

INSERT INTO `checklist_item_feedbacks` (`id`, `checklist_item_id`, `inspector_id`, `task_id`, `inspector_schedule_id`, `feedback`, `audio`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, 3, 6, NULL, '2019-11-13 13:56:03', '2019-11-13 13:56:03', NULL),
(2, 2, 1, 1, 3, 5, NULL, '2019-11-13 13:56:03', '2019-11-13 13:56:03', NULL),
(3, 3, 1, 1, 3, 6, NULL, '2019-11-13 13:56:03', '2019-11-13 13:56:03', NULL),
(4, 4, 1, 1, 3, 10, NULL, '2019-11-13 13:56:03', '2019-11-13 13:56:03', NULL),
(5, 5, 1, 1, 3, 7, NULL, '2019-11-13 13:56:03', '2019-11-13 13:56:03', NULL),
(6, 6, 1, 1, 3, 8, NULL, '2019-11-13 13:56:03', '2019-11-13 13:56:03', NULL),
(7, 7, 1, 1, 3, 10, NULL, '2019-11-13 13:56:04', '2019-11-13 13:56:04', NULL),
(8, 8, 1, 1, 3, 10, NULL, '2019-11-13 13:56:04', '2019-11-13 13:56:04', NULL),
(9, 9, 1, 1, 3, 2, NULL, '2019-11-13 13:56:04', '2019-11-13 13:56:04', NULL),
(10, 10, 1, 1, 3, 6, NULL, '2019-11-13 13:56:04', '2019-11-13 13:56:04', NULL),
(11, 11, 1, 1, 3, 7, NULL, '2019-11-13 13:56:05', '2019-11-13 13:56:05', NULL),
(12, 12, 1, 1, 3, 6, NULL, '2019-11-13 13:56:05', '2019-11-13 13:56:05', NULL),
(13, 1, 1, 1, 4, 10, NULL, '2019-11-14 11:31:58', '2019-11-14 11:31:58', NULL),
(14, 2, 1, 1, 4, 10, NULL, '2019-11-14 11:31:58', '2019-11-14 11:31:58', NULL),
(15, 3, 1, 1, 4, 10, NULL, '2019-11-14 11:31:58', '2019-11-14 11:31:58', NULL),
(16, 4, 1, 1, 4, 10, NULL, '2019-11-14 11:31:58', '2019-11-14 11:31:58', NULL),
(17, 5, 1, 1, 4, 10, NULL, '2019-11-14 11:31:58', '2019-11-14 11:31:58', NULL),
(18, 6, 1, 1, 4, 8, NULL, '2019-11-14 11:31:58', '2019-11-14 11:31:58', NULL),
(19, 7, 1, 1, 4, 10, NULL, '2019-11-14 11:31:58', '2019-11-14 11:31:58', NULL),
(20, 8, 1, 1, 4, 10, NULL, '2019-11-14 11:31:58', '2019-11-14 11:31:58', NULL),
(21, 9, 1, 1, 4, 10, NULL, '2019-11-14 11:31:58', '2019-11-14 11:31:58', NULL),
(22, 10, 1, 1, 4, 10, NULL, '2019-11-14 11:31:58', '2019-11-14 11:31:58', NULL),
(23, 11, 1, 1, 4, 10, NULL, '2019-11-14 11:31:58', '2019-11-14 11:31:58', NULL),
(24, 12, 1, 1, 4, 10, NULL, '2019-11-14 11:31:58', '2019-11-14 11:31:58', NULL),
(25, 1, 3, 10, 5, 10, NULL, '2019-11-14 11:40:35', '2019-11-14 11:40:35', NULL),
(26, 2, 3, 10, 5, 10, NULL, '2019-11-14 11:40:35', '2019-11-14 11:40:35', NULL),
(27, 3, 3, 10, 5, 10, NULL, '2019-11-14 11:40:35', '2019-11-14 11:40:35', NULL),
(28, 4, 3, 10, 5, 10, NULL, '2019-11-14 11:40:35', '2019-11-14 11:40:35', NULL),
(29, 5, 3, 10, 5, 10, NULL, '2019-11-14 11:40:35', '2019-11-14 11:40:35', NULL),
(30, 6, 3, 10, 5, 10, NULL, '2019-11-14 11:40:35', '2019-11-14 11:40:35', NULL),
(31, 7, 3, 10, 5, 10, NULL, '2019-11-14 11:40:35', '2019-11-14 11:40:35', NULL),
(32, 8, 3, 10, 5, 10, NULL, '2019-11-14 11:40:35', '2019-11-14 11:40:35', NULL),
(33, 9, 3, 10, 5, 10, NULL, '2019-11-14 11:40:35', '2019-11-14 11:40:35', NULL),
(34, 10, 3, 10, 5, 10, NULL, '2019-11-14 11:40:35', '2019-11-14 11:40:35', NULL),
(35, 11, 3, 10, 5, 10, NULL, '2019-11-14 11:40:35', '2019-11-14 11:40:35', NULL),
(36, 12, 3, 10, 5, 10, NULL, '2019-11-14 11:40:35', '2019-11-14 11:40:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `checklist_item_feedback_media`
--

CREATE TABLE `checklist_item_feedback_media` (
  `id` int(10) UNSIGNED NOT NULL,
  `checklist_item_feedback_id` int(10) UNSIGNED DEFAULT NULL,
  `media_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cleaners`
--

CREATE TABLE `cleaners` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `street_number` varchar(255) DEFAULT NULL,
  `street_name` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `post_code` varchar(10) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `type` tinyint(1) DEFAULT 1,
  `pan_number` varchar(10) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `initial_password` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `termination` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cleaners`
--

INSERT INTO `cleaners` (`id`, `user_id`, `first_name`, `last_name`, `telephone`, `mobile`, `street_number`, `street_name`, `city`, `post_code`, `start_date`, `type`, `pan_number`, `image`, `initial_password`, `created_at`, `updated_at`, `deleted_at`, `termination`) VALUES
(1, 2, 'manga', 'vimal', '9055546223', '4168767055', '16', 'whitlock cres', 'ajax', 'l1z2b1', '2019-10-10 00:00:00', 1, 'FBM 0002', NULL, 'ratnam', '2019-10-10 10:30:11', '2019-11-06 21:51:46', NULL, NULL),
(2, 4, 'Janaka', 'Dombawela', '0712345678', '0712345678', '21/1/1', '21/1/1, Nelson Place, Wellawatthe', 'Colombo', '00600', '2019-10-29 00:00:00', 1, 'FBM 0004', 'cleaners/L4IgEjN3bZHpkhtlFQgraatPLwKybqIRLtvlX9bi.jpeg', '1JoqnJ', '2019-10-29 03:31:16', '2019-10-29 03:31:16', NULL, NULL),
(3, 5, 'wwwe', 'wwwe', '0344477777', '1213242342', '1/21', '1/21, galled rd', 'Wellawatta', '00600', '2019-10-29 00:00:00', 1, 'FBM 0005', '', 'jH9h5d', '2019-10-29 03:33:42', '2019-10-29 03:33:42', NULL, NULL),
(4, 6, 'aaa', 'wwwe', '0344477777', '0344477777', '1/21', '1/21, galled rd', 'Wellawatta', '00600', '2019-10-29 00:00:00', 1, 'FBM 0006', 'cleaners/3FQlMgydQ4UsKpCsg9m33xvDeXGzQZLX1JFNHAdO.docx', '60XFcC', '2019-10-29 04:47:59', '2020-04-11 22:55:52', NULL, 'dfscds'),
(5, 7, 'janaka', 'yy', '0344477777', '0344477777', '1/21', '1/21, galled rd', 'Wellawatta', '00600', '2019-10-29 00:00:00', 1, 'FBM 0007', '', 'AGI4ms', '2019-10-29 04:53:08', '2020-05-13 23:31:32', '2020-05-13 23:31:32', 'sdsdasd');

-- --------------------------------------------------------

--
-- Table structure for table `cleaner_alert`
--

CREATE TABLE `cleaner_alert` (
  `id` int(11) NOT NULL,
  `cleaner_id` int(11) DEFAULT NULL,
  `alert_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cleaner_alert`
--

INSERT INTO `cleaner_alert` (`id`, `cleaner_id`, `alert_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2019-10-10 11:48:54', '2019-10-10 11:48:54'),
(2, 1, 3, '2019-10-29 01:41:09', '2019-10-29 01:41:09'),
(3, 1, 5, '2019-11-06 21:54:38', '2019-11-06 21:54:38'),
(4, 1, 7, '2019-11-13 11:18:43', '2019-11-13 11:18:43'),
(5, 1, 9, '2019-11-13 13:56:04', '2019-11-13 13:56:04'),
(6, 1, 10, '2020-05-14 07:25:48', '2020-05-14 07:25:48'),
(7, 4, 12, '2020-05-18 07:17:06', '2020-05-18 07:17:06'),
(8, 1, 14, '2020-05-19 03:02:37', '2020-05-19 03:02:37'),
(9, 4, 16, '2020-05-19 03:23:24', '2020-05-19 03:23:24'),
(10, 1, 18, '2020-05-19 03:25:33', '2020-05-19 03:25:33');

-- --------------------------------------------------------

--
-- Table structure for table `cleaner_check_lists`
--

CREATE TABLE `cleaner_check_lists` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cleaner_check_lists`
--

INSERT INTO `cleaner_check_lists` (`id`, `client_id`, `title`, `order`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 8, 'dfdfdfd', '1', '2020-05-06 03:19:05', '2020-05-06 03:19:05', NULL),
(4, 8, 'ddrererer', '3', '2020-05-06 03:19:05', '2020-05-06 03:19:05', NULL),
(5, 9, 'list1', '1', '2020-05-06 03:29:51', '2020-05-06 03:29:51', NULL),
(6, 9, 'list2', '2', '2020-05-06 03:29:51', '2020-05-06 03:29:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cleaner_check_list_items`
--

CREATE TABLE `cleaner_check_list_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `checklist_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cleaner_check_list_items`
--

INSERT INTO `cleaner_check_list_items` (`id`, `checklist_id`, `name`, `order`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 3, 'ddrerere111', 0, '2020-05-06 03:19:05', '2020-05-06 03:19:05', NULL),
(4, 4, 'qqqqqqqqqqqqq22', 0, '2020-05-06 03:19:06', '2020-05-06 03:19:06', NULL),
(5, 5, 'ddrerere11', 0, '2020-05-06 03:29:51', '2020-05-06 03:29:51', NULL),
(6, 5, '111', 1, '2020-05-06 03:29:51', '2020-05-06 03:29:51', NULL),
(7, 6, '22222', 0, '2020-05-06 03:29:51', '2020-05-06 03:29:51', NULL),
(8, 6, '2223333', 1, '2020-05-06 03:29:51', '2020-05-06 03:29:51', NULL),
(9, 6, '33333', 2, '2020-05-06 03:29:51', '2020-05-06 03:29:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cleaner_schedules`
--

CREATE TABLE `cleaner_schedules` (
  `id` int(11) NOT NULL,
  `cleaner_id` int(11) DEFAULT NULL,
  `task_id` int(11) DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cleaner_schedules`
--

INSERT INTO `cleaner_schedules` (`id`, `cleaner_id`, `task_id`, `start_time`, `end_time`, `created_at`, `updated_at`) VALUES
(1, 4, 11, '2019-11-06 21:10:24', '2019-11-06 23:25:16', '2019-11-06 21:10:25', '2019-11-06 21:13:16'),
(2, 4, 1, '2019-11-11 12:29:08', '2019-11-11 12:54:32', '2019-11-11 12:29:08', '2019-11-11 12:54:32'),
(3, 1, 1, '2019-11-11 13:04:34', NULL, '2019-11-11 13:04:34', '2019-11-11 13:04:34'),
(4, 1, 1, '2019-11-11 13:06:54', NULL, '2019-11-11 13:06:55', '2019-11-11 13:06:55'),
(5, 1, 1, '2019-11-11 13:10:00', NULL, '2019-11-11 13:10:00', '2019-11-11 13:10:00'),
(6, 1, 1, '2019-11-12 08:51:43', '2019-11-12 08:51:59', '2019-11-12 08:51:43', '2019-11-12 08:51:59'),
(7, 1, 6, '2019-11-12 09:51:39', '2019-11-12 11:01:15', '2019-11-12 09:51:39', '2019-11-12 11:01:15'),
(8, 1, 1, '2019-11-12 14:13:09', '2019-11-12 14:15:32', '2019-11-12 14:13:10', '2019-11-12 14:15:32'),
(9, 1, 8, '2019-11-13 11:35:09', '2019-11-13 11:35:54', '2019-11-13 11:35:09', '2019-11-13 11:35:54'),
(10, 1, 8, '2019-11-13 11:40:24', '2019-11-13 11:40:34', '2019-11-13 11:40:24', '2019-11-13 11:40:34'),
(11, 1, 9, '2019-11-13 14:12:33', '2019-11-13 14:12:48', '2019-11-13 14:12:33', '2019-11-13 14:12:48'),
(12, 1, 1, '2019-11-14 10:35:08', '2019-11-14 10:38:04', '2019-11-14 10:35:08', '2019-11-14 10:38:04');

-- --------------------------------------------------------

--
-- Table structure for table `cleaner_schedule_audio`
--

CREATE TABLE `cleaner_schedule_audio` (
  `id` int(11) NOT NULL,
  `cleaner_schedule_id` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `audio` varchar(255) DEFAULT NULL,
  `notification` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cleaner_schedule_audio`
--

INSERT INTO `cleaner_schedule_audio` (`id`, `cleaner_schedule_id`, `date`, `audio`, `notification`, `created_at`, `updated_at`) VALUES
(1, 2, '2019-11-11 12:54:09', 'audio/audio_20191111125408.m4a', 0, '2019-11-11 12:54:09', '2019-11-11 12:54:09'),
(2, 6, '2019-11-12 08:51:53', 'audio/audio_20191112085153.m4a', 1, '2019-11-12 08:51:53', '2019-11-12 08:51:53');

-- --------------------------------------------------------

--
-- Table structure for table `cleaner_schedule_media`
--

CREATE TABLE `cleaner_schedule_media` (
  `id` int(11) NOT NULL,
  `media_id` int(11) DEFAULT NULL,
  `cleaner_schedule_id` int(11) DEFAULT NULL,
  `task_item_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cleaner_schedule_media`
--

INSERT INTO `cleaner_schedule_media` (`id`, `media_id`, `cleaner_schedule_id`, `task_item_id`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 1, '2019-11-06 21:12:44', '2019-11-06 21:12:44'),
(2, 7, 7, 11, '2019-11-12 09:52:05', '2019-11-12 09:52:05'),
(3, 9, 9, 16, '2019-11-13 11:35:40', '2019-11-13 11:35:40');

-- --------------------------------------------------------

--
-- Table structure for table `cleaner_schedule_product`
--

CREATE TABLE `cleaner_schedule_product` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `cleaner_schedule_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cleaner_task`
--

CREATE TABLE `cleaner_task` (
  `id` int(11) NOT NULL,
  `cleaner_id` int(11) DEFAULT NULL,
  `task_id` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cleaner_task`
--

INSERT INTO `cleaner_task` (`id`, `cleaner_id`, `task_id`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2019-10-10', NULL, NULL, NULL),
(2, 1, 2, '2019-10-10', '2019-10-10', NULL, NULL),
(3, 1, 3, '2019-10-29', '2019-10-29', NULL, NULL),
(4, 1, 4, '2019-11-06', '2019-11-06', NULL, NULL),
(5, 1, 5, '2019-11-16', '2019-11-17', NULL, NULL),
(6, 1, 6, '2019-11-12', NULL, NULL, NULL),
(7, 1, 7, '2019-11-13', '2019-11-13', NULL, NULL),
(8, 1, 8, '2019-11-13', '2019-11-13', NULL, NULL),
(9, 1, 9, '2019-11-13', '2019-11-13', NULL, NULL),
(10, 1, 10, '2019-11-14', NULL, NULL, NULL),
(11, 4, 11, '2020-01-23', '2020-03-16', NULL, NULL),
(12, 1, 12, '2020-05-14', '2020-05-14', NULL, NULL),
(13, 4, 13, '2020-05-18', '2020-05-18', NULL, NULL),
(14, 1, 14, '2020-05-19', '2020-05-19', NULL, NULL),
(15, 4, 15, '2020-05-19', '2020-05-19', NULL, NULL),
(16, 1, 16, '2020-05-19', '2020-05-19', NULL, NULL),
(17, 3, 18, '2020-05-21', '2020-06-02', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cleaner_times`
--

CREATE TABLE `cleaner_times` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `cleaner_id` int(11) NOT NULL,
  `client_sub_id` int(11) DEFAULT NULL,
  `work_days` int(11) DEFAULT NULL,
  `work_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_of_people` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_in` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_out` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cleaner_times`
--

INSERT INTO `cleaner_times` (`id`, `client_id`, `cleaner_id`, `client_sub_id`, `work_days`, `work_date`, `time`, `mobile`, `telephone`, `number_of_people`, `time_in`, `time_out`, `total`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, 2, NULL, 2, '2020-05-11', NULL, '1234', '1111', '1', '04.00 am', '06.00 pm', '', '2020-05-10 18:30:00', '2020-05-10 18:30:00', '2020-05-10 18:30:00'),
(2, 5, 1, NULL, 2, '2020-05-10', NULL, '1234', '1111', '1', '04.00 am', '06.00 pm', '', '2020-05-10 18:30:00', '2020-05-10 18:30:00', '2020-05-10 18:30:00'),
(3, 5, 1, NULL, 2, '2020-05-11', NULL, '1234', '1111', '1', '04.00 am', '06.00 pm', '', '2020-05-10 18:30:00', '2020-05-10 18:30:00', '2020-05-10 18:30:00'),
(5, 1, 3, 2, 3, '2020-05-12', '10:43 PM to 10:43 PM', '1234', '123456', '2', '10:43 PM', '10:46 PM', NULL, '2020-05-12 18:13:26', '2020-05-12 18:13:26', NULL),
(6, 5, 5, NULL, 31, '2020-05-12', '9:45 PM to 10:45 PM', '1234', '123456', '3', '10:43 PM', '10:48 PM', NULL, '2020-05-12 18:16:04', '2020-05-12 18:16:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `street_number` varchar(255) DEFAULT NULL,
  `street_name` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `post_code` varchar(255) DEFAULT NULL,
  `continuous` tinyint(1) DEFAULT 1,
  `supply_required` tinyint(1) DEFAULT 0,
  `termination_date` date DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `lock_code` varchar(255) DEFAULT NULL,
  `alarm_code` varchar(255) DEFAULT NULL,
  `payment` date DEFAULT NULL,
  `contract` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `category_id`, `name`, `street_number`, `street_name`, `city`, `post_code`, `continuous`, `supply_required`, `termination_date`, `start_date`, `lock_code`, `alarm_code`, `payment`, `contract`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Luxury Bridal', '16', 'whitlock cres', 'ajax', 'l1z2b1', 1, 1, NULL, '2019-10-10', NULL, '1234', '2019-10-15', 'contract/0GrwgFhT6WFrGYHdZdnDbs5BMOI03mr2B8osfPgu.pdf', '2019-10-10 11:09:44', '2019-10-10 11:09:44', NULL),
(2, 1, 'walmart', 'whitlock cres', '10', 'ajax', 'l1z2b1', 0, 0, NULL, '2019-11-06', NULL, '1234', '2019-11-06', 'contract/UGyJjdtvkQVFFMuF6kSV4tJ4iHd7se0CYiTYOEcF.png', '2019-11-06 21:37:28', '2019-11-06 21:37:28', NULL),
(3, 2, 'Spice', '20', 'whitlock cres', 'notajax', 'l1z2b1', 1, 0, NULL, '2019-11-12', '12', '12', '2019-11-12', NULL, '2019-11-12 08:45:43', '2019-11-12 11:46:06', NULL),
(4, 2, 'canbe', '10', 'salem rd', 'notajax', 'l1z2b1', 0, 0, NULL, '2019-11-12', NULL, NULL, '2019-11-12', NULL, '2019-11-12 10:55:18', '2019-11-12 10:55:18', NULL),
(5, 2, 'Codelantic Pvt Ltd', 'Thotupalawattha', 'test', 'Kalutara', '0014', 1, 0, NULL, '2020-04-25', NULL, NULL, '2020-04-24', NULL, '2020-01-21 04:20:54', '2020-04-24 21:34:19', NULL),
(8, 1, 'madhawa', 'Thotupalawattha', 'erererer', 'Kalutara', '0014', 1, 0, NULL, '2020-05-27', NULL, NULL, '2020-05-05', NULL, '2020-05-05 22:19:05', '2020-05-05 22:19:05', NULL),
(9, 2, 'madhawa', 'Thotupalawattha', 'dewewewe', 'Kalutara', '0014', 1, 0, NULL, '2020-05-07', NULL, NULL, '2020-05-05', NULL, '2020-05-05 22:29:51', '2020-05-05 22:29:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `client_followups`
--

CREATE TABLE `client_followups` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `task_id` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client_followups`
--

INSERT INTO `client_followups` (`id`, `client_id`, `admin_id`, `task_id`, `type`, `comment`, `date`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0, 'Document', 'Contract document is not given by customer.', '2020-05-02 00:00:00', 'OPEN', '2019-10-10 12:09:33', '2019-10-10 12:09:33'),
(2, 1, 1, 1, 'Service Feedback', 'Service Feedback', '2020-05-10 00:00:00', 'OPEN', '2019-10-29 04:35:15', '2019-10-29 04:50:58'),
(3, 1, 1, 0, 'Complaint', 'eerererere', '2020-05-20 00:00:00', 'ENDED', '2020-05-20 09:56:38', '2020-05-22 03:24:33'),
(4, 4, 1, 0, 'Payment', 'sdsdsdsd', '2020-05-20 00:00:00', 'OPEN', '2020-05-20 10:48:25', '2020-05-20 10:48:25'),
(5, 3, 1, 0, 'Service Feedback', 'wwqqqqqqqqq', '2020-05-19 00:00:00', 'ENDED', '2020-05-20 10:48:45', '2020-05-21 02:14:31');

-- --------------------------------------------------------

--
-- Table structure for table `client_followup_comments`
--

CREATE TABLE `client_followup_comments` (
  `id` int(11) NOT NULL,
  `client_followup_id` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `upload` varchar(255) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client_followup_comments`
--

INSERT INTO `client_followup_comments` (`id`, `client_followup_id`, `admin_id`, `type`, `date`, `upload`, `comment`, `description`, `created_at`, `updated_at`) VALUES
(6, 3, 1, NULL, '2020-05-20 00:00:00', '', 'qqqqqqqqqqq', NULL, '2020-05-20 10:05:26', '2020-05-20 10:05:26'),
(7, 3, 1, NULL, '2020-05-20 00:00:00', 'client-followups/x1NkEdHGZvRqvSwXyQ9bh7YJ1SPcqybYPED6LOG3.jpeg', 'rrrrrrrrrrrrrrrrrrrrrrrrrrr', NULL, '2020-05-20 10:06:01', '2020-05-20 10:06:01'),
(8, 3, 1, NULL, '2020-05-20 00:00:00', '', 'gggggggggggggggg', NULL, '2020-05-20 10:06:50', '2020-05-20 10:06:50'),
(9, 3, 1, NULL, '2020-05-20 00:00:00', '', 'tttttttttttttttttt', NULL, '2020-05-20 10:06:58', '2020-05-20 10:06:58'),
(10, 3, 1, NULL, '2020-05-24 00:00:00', '', 'zzzzzzzzzzzz', NULL, '2020-05-22 01:26:05', '2020-05-22 01:26:05');

-- --------------------------------------------------------

--
-- Table structure for table `client_product`
--

CREATE TABLE `client_product` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `shortage_alert` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` int(11) NOT NULL,
  `ticket` varchar(255) DEFAULT NULL,
  `cleaner_id` int(11) DEFAULT NULL,
  `task_id` int(11) DEFAULT NULL,
  `inspector_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `complaint` text DEFAULT NULL,
  `upload` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `resolved` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`id`, `ticket`, `cleaner_id`, `task_id`, `inspector_id`, `date`, `complaint`, `upload`, `type`, `resolved`, `created_at`, `updated_at`) VALUES
(1, '1-2019-10-10 11:48:53', 1, 1, 1, '2019-10-10', 'dust on table', '', NULL, 1, '2019-10-10 11:48:53', '2019-10-10 11:56:19'),
(2, '1-2019-10-29 01:41:08', 1, 1, 1, '2020-01-20', 'asdfasdfasdf', '', NULL, 1, '2019-10-29 01:41:08', '2020-01-21 06:25:07'),
(3, '1-2019-11-06 21:54:37', 1, 1, 1, '2019-11-06', 'did not set alarm', '', NULL, 1, '2019-11-06 21:54:37', '2019-11-13 11:17:38'),
(4, '1-2019-11-13 11:18:41', 1, 1, 1, '2019-11-13', 'dust at front desk', '', NULL, 1, '2019-11-13 11:18:41', '2020-01-20 05:33:18'),
(5, '1-2019-11-13 13:56:04', 1, 1, 1, '2019-11-13', 'Under table & chairs', NULL, NULL, 0, '2019-11-13 13:56:04', '2019-11-13 13:56:04'),
(6, '1-2020-05-14 05:02:28', 1, 1, 1, '2020-05-14', 'sdsds', '', NULL, 0, '2020-05-14 05:02:28', '2020-05-14 05:02:28'),
(7, '1-2020-05-14 06:23:42', 1, 1, 1, '2020-05-14', 'xxxxxxxxxxxxxxxxxx', '', NULL, 1, '2020-05-14 06:23:42', '2020-05-14 06:54:41'),
(8, '1-2020-05-14 06:24:00', 1, 1, 1, '2020-05-14', 'xxxxxxxxxxxxxxxxxx', '', NULL, 1, '2020-05-14 06:24:00', '2020-05-14 06:54:22'),
(10, '11-2020-05-18 07:17:03', 4, 11, 2, '2020-05-18', 'qwert', '', NULL, 1, '2020-05-18 07:17:04', '2020-05-18 13:22:09'),
(11, '7-2020-05-19 01:48:38', 1, 7, 1, '2020-05-19', 'dwdwdwdw', '', NULL, 0, '2020-05-19 01:48:38', '2020-05-19 01:48:38'),
(12, '7-2020-05-19 01:51:25', 1, 7, 1, '2020-05-19', 'dwdwdwdw', '', NULL, 0, '2020-05-19 01:51:25', '2020-05-19 01:51:25'),
(13, '5-2020-05-19 02:03:43', 1, 5, 1, '2020-05-19', 'qseq', '', NULL, 0, '2020-05-19 02:03:43', '2020-05-19 02:03:43'),
(14, '10-2020-05-19 02:08:14', 1, 10, 2, '2020-05-19', 'qseq', '', NULL, 0, '2020-05-19 02:08:14', '2020-05-19 02:08:14'),
(15, '10-2020-05-19 02:09:03', 1, 10, 2, '2020-05-19', 'qeqe', '', NULL, 0, '2020-05-19 02:09:03', '2020-05-19 02:09:03'),
(16, '10-2020-05-19 02:22:52', 1, 10, 2, '2020-05-19', 'hghfg', '', NULL, 0, '2020-05-19 02:22:52', '2020-05-19 02:22:52'),
(17, '7-2020-05-19 02:23:08', 1, 7, 1, '2020-05-19', 'hghfg', '', NULL, 0, '2020-05-19 02:23:08', '2020-05-19 02:23:08'),
(18, '7-2020-05-19 03:02:35', 1, 7, 1, '2020-05-19', 'ewewe', '', NULL, 1, '2020-05-19 03:02:35', '2020-05-19 03:08:23'),
(19, '11-2020-05-19 03:15:31', 4, 11, 2, '2020-05-19', 'wrer', '', NULL, 0, '2020-05-19 03:15:31', '2020-05-19 03:15:31'),
(20, '11-2020-05-19 03:15:56', 4, 11, 2, '2020-05-19', 'wrer', '', NULL, 0, '2020-05-19 03:15:56', '2020-05-19 03:15:56'),
(21, '11-2020-05-19 03:16:11', 4, 11, 2, '2020-05-19', 'wrer', '', NULL, 0, '2020-05-19 03:16:11', '2020-05-19 03:16:11'),
(22, '11-2020-05-19 03:16:54', 4, 11, 2, '2020-05-19', 'wrer', '', NULL, 0, '2020-05-19 03:16:54', '2020-05-19 03:16:54'),
(23, '11-2020-05-19 03:17:03', 4, 11, 2, '2020-05-19', 'wrer', '', NULL, 0, '2020-05-19 03:17:03', '2020-05-19 03:17:03'),
(24, '11-2020-05-19 03:19:01', 4, 11, 2, '2020-05-19', 'wrer', '', NULL, 0, '2020-05-19 03:19:01', '2020-05-19 03:19:01'),
(25, '10-2020-05-19 03:20:24', 1, 10, 2, '2020-05-19', 'wrer', '', NULL, 0, '2020-05-19 03:20:24', '2020-05-19 03:20:24'),
(26, '11-2020-05-19 03:23:22', 4, 11, 2, '2020-05-19', 'ttttttttttttttttttttttttttttttt', '', NULL, 0, '2020-05-19 03:23:22', '2020-05-19 03:23:22'),
(27, '7-2020-05-19 03:25:30', 1, 7, 1, '2020-05-19', 'qqqqqqqqqqqqqqqqqqqqqqq', '', NULL, 0, '2020-05-19 03:25:30', '2020-05-19 03:25:30');

-- --------------------------------------------------------

--
-- Table structure for table `complaint_followups`
--

CREATE TABLE `complaint_followups` (
  `id` int(11) NOT NULL,
  `complaint_id` int(11) DEFAULT NULL,
  `inspector_id` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `upload` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `complaint_media`
--

CREATE TABLE `complaint_media` (
  `id` int(11) NOT NULL,
  `complaint_id` int(11) DEFAULT NULL,
  `media_id` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT 'image',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complaint_media`
--

INSERT INTO `complaint_media` (`id`, `complaint_id`, `media_id`, `type`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'image', '2019-10-10 11:48:53', '2019-10-10 11:48:53'),
(2, 2, 2, 'image', '2019-10-29 01:41:09', '2019-10-29 01:41:09'),
(3, 2, 3, 'image', '2019-10-29 01:41:09', '2019-10-29 01:41:09'),
(4, 3, 5, 'image', '2019-11-06 21:54:37', '2019-11-06 21:54:37'),
(5, 3, 6, 'image', '2019-11-06 21:54:37', '2019-11-06 21:54:37'),
(6, 4, 8, 'image', '2019-11-13 11:18:42', '2019-11-13 11:18:42'),
(8, 10, 11, 'image', '2020-05-18 07:17:04', '2020-05-18 07:17:04'),
(9, 18, 12, 'audio', '2020-05-19 03:02:35', '2020-05-19 03:02:35'),
(10, 26, 13, 'audio', '2020-05-19 03:23:22', '2020-05-19 03:23:22'),
(11, 27, 14, 'image', '2020-05-19 03:25:30', '2020-05-19 03:25:30'),
(12, 27, 15, 'image', '2020-05-19 03:25:30', '2020-05-19 03:25:30');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `task_id` int(11) DEFAULT NULL,
  `cleaner_id` int(11) DEFAULT NULL,
  `inspector_id` int(11) DEFAULT NULL,
  `feedback` text DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `followups`
--

CREATE TABLE `followups` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `inspector_id` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `followup_comments`
--

CREATE TABLE `followup_comments` (
  `id` int(11) NOT NULL,
  `followup_id` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `inspector_id` int(11) DEFAULT NULL,
  `upload` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inspectors`
--

CREATE TABLE `inspectors` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `street_number` varchar(255) DEFAULT NULL,
  `street_name` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `post_code` varchar(10) DEFAULT NULL,
  `agreement_start` datetime DEFAULT NULL,
  `pan_number` varchar(10) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `initial_password` varchar(255) DEFAULT NULL,
  `level` varchar(20) DEFAULT 'INSPECTOR_1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `termination` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inspectors`
--

INSERT INTO `inspectors` (`id`, `user_id`, `first_name`, `last_name`, `telephone`, `mobile`, `street_number`, `street_name`, `city`, `post_code`, `agreement_start`, `pan_number`, `image`, `initial_password`, `level`, `created_at`, `updated_at`, `deleted_at`, `termination`) VALUES
(1, 3, 'vimal', 'muthu', '9055546223', '4167275410', '16', 'whitlock cres', 'ajax', 'l1z2b1', '2019-10-10 00:00:00', 'FBM 0003', NULL, 'vmuthu', 'INSPECTOR_1', '2019-10-10 10:47:54', '2019-11-13 12:06:02', NULL, NULL),
(2, 8, 'Dombawela', 'yy', '0344477777', '0344477777', '1/21', '40 Simon Marks Court', 'Wellawatta', 'LS12 4BE', '2019-10-29 00:00:00', 'FBM 0008', '', 'VMwyr2', 'INSPECTOR_1', '2019-10-29 04:55:12', '2019-10-29 04:55:12', NULL, NULL),
(3, 9, 'John', 'D', '9055546223', '4168767055', '16', 'whitlock cres', 'ajax', 'l1z2b1', '2019-11-06 00:00:00', 'FBM 0009', '', 'johnDD', 'INSPECTOR_2', '2019-11-06 21:25:24', '2019-11-14 11:33:22', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `inspector_alert`
--

CREATE TABLE `inspector_alert` (
  `id` int(11) NOT NULL,
  `inspector_id` int(11) DEFAULT NULL,
  `alert_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inspector_alert`
--

INSERT INTO `inspector_alert` (`id`, `inspector_id`, `alert_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2019-10-10 11:48:54', '2019-10-10 11:48:54'),
(2, 1, 4, '2019-10-29 01:41:09', '2019-10-29 01:41:09'),
(3, 1, 6, '2019-11-06 21:54:38', '2019-11-06 21:54:38'),
(4, 1, 8, '2019-11-13 11:18:43', '2019-11-13 11:18:43'),
(5, 2, 11, '2020-05-14 07:25:48', '2020-05-14 07:25:48'),
(6, 2, 13, '2020-05-18 07:17:06', '2020-05-18 07:17:06'),
(7, 1, 15, '2020-05-19 03:02:37', '2020-05-19 03:02:37'),
(8, 2, 17, '2020-05-19 03:23:24', '2020-05-19 03:23:24'),
(9, 1, 19, '2020-05-19 03:25:33', '2020-05-19 03:25:33');

-- --------------------------------------------------------

--
-- Table structure for table `inspector_schedules`
--

CREATE TABLE `inspector_schedules` (
  `id` int(11) NOT NULL,
  `inspector_id` int(11) DEFAULT NULL,
  `task_id` int(11) DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inspector_schedules`
--

INSERT INTO `inspector_schedules` (`id`, `inspector_id`, `task_id`, `start_time`, `end_time`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2019-11-13 13:49:54', NULL, '2019-11-13 13:49:54', '2019-11-13 13:49:54'),
(2, 1, 1, '2019-11-13 13:50:34', NULL, '2019-11-13 13:50:34', '2019-11-13 13:50:34'),
(3, 1, 1, '2019-11-13 13:51:22', NULL, '2019-11-13 13:51:22', '2019-11-13 13:51:22'),
(4, 1, 1, '2019-11-14 11:22:36', NULL, '2019-11-14 11:22:36', '2019-11-14 11:22:36'),
(5, 3, 10, '2019-11-14 11:40:06', NULL, '2019-11-14 11:40:06', '2019-11-14 11:40:06');

-- --------------------------------------------------------

--
-- Table structure for table `inspector_task`
--

CREATE TABLE `inspector_task` (
  `id` int(11) NOT NULL,
  `task_id` int(11) DEFAULT NULL,
  `inspector_id` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inspector_task`
--

INSERT INTO `inspector_task` (`id`, `task_id`, `inspector_id`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2019-10-10', NULL, NULL, NULL),
(2, 2, 1, '2019-10-10', '2019-10-10', NULL, NULL),
(3, 3, 1, '2019-10-29', '2019-10-29', NULL, NULL),
(4, 4, 1, '2019-11-06', '2019-11-06', NULL, NULL),
(5, 5, 1, '2019-11-16', '2019-11-17', NULL, NULL),
(6, 6, 1, '2019-11-12', NULL, NULL, NULL),
(7, 7, 1, '2019-11-13', '2019-11-13', NULL, NULL),
(8, 8, 1, '2019-11-13', '2019-11-13', NULL, NULL),
(9, 9, 1, '2019-11-13', '2019-11-13', NULL, NULL),
(10, 10, 2, '2019-11-14', NULL, NULL, NULL),
(11, 11, 2, '2020-01-23', '2020-03-16', NULL, NULL),
(12, 12, 2, '2020-05-14', '2020-05-14', NULL, NULL),
(13, 13, 2, '2020-05-18', '2020-05-18', NULL, NULL),
(14, 14, 1, '2020-05-19', '2020-05-19', NULL, NULL),
(15, 15, 2, '2020-05-19', '2020-05-19', NULL, NULL),
(16, 16, 1, '2020-05-19', '2020-05-19', NULL, NULL),
(17, 18, 1, '2020-05-21', '2020-06-02', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `name`, `path`, `created_at`, `updated_at`) VALUES
(1, 'complaint-1', 'complaints/rGf8k3SlUi8Bib8JzJgrgCRlCS37dhAgsNkDcrua.pdf', '2019-10-10 11:48:53', '2019-10-10 11:48:53'),
(2, 'complaint-2', 'complaints/IS5aEvtpOIrmBKf57yKk4i3Y2LEQhYTi11yR2VRH.jpeg', '2019-10-29 01:41:09', '2019-10-29 01:41:09'),
(3, 'complaint-2', 'complaints/Fg9ZsVAby0zeyxgI4SHEctJOuprlMUbD1zksGrun.jpeg', '2019-10-29 01:41:09', '2019-10-29 01:41:09'),
(4, 'task-image-1-1', 'tasks/vo5vfV8OlqGvs9AwMAEeDCVTntFsVckOXSHF5jgJ.jpeg', '2019-11-06 21:12:44', '2019-11-06 21:12:44'),
(5, 'complaint-3', 'complaints/ON9iXP01t4N0cZ7BARlvUyCXC4qtsbJW02FYiuHM.png', '2019-11-06 21:54:37', '2019-11-06 21:54:37'),
(6, 'complaint-3', 'complaints/5MSfl8peNCN8JVOfOtmmQeF2D6icG9k0t2CHdexY.png', '2019-11-06 21:54:37', '2019-11-06 21:54:37'),
(7, 'task-image-7-11', 'tasks/lW3wbTAY2Vpq2MM2ncPyCDwAFyweVHBlPW3Fxq3O.jpeg', '2019-11-12 09:52:05', '2019-11-12 09:52:05'),
(8, 'complaint-4', 'complaints/LHtZ1Bl0pQ42JBFe4E8BK2rojwKwxSpXeGKpDZl7.png', '2019-11-13 11:18:42', '2019-11-13 11:18:42'),
(9, 'task-image-9-16', 'tasks/oDVzON4VWpUBIybcfYb5MBaLvBJx151uF0KhhTF1.jpeg', '2019-11-13 11:35:40', '2019-11-13 11:35:40'),
(10, 'complaint-9', 'complaints/F3r8kbE6nsBh5sDj4do2fLs8yEn8IZ5fJK5lusSO.jpeg', '2020-05-14 07:25:46', '2020-05-14 07:25:46'),
(11, 'complaint-10', 'complaints/G1SqGUlId05KbGm0cjMVBwOIleQWuS2iZt0PbA48.jpeg', '2020-05-18 07:17:04', '2020-05-18 07:17:04'),
(12, 'complaint-18', 'complaints/rcp5kDbBA0s2tuQ0QVP9CORihvmuRNIZZt6FCMyF.mpga', '2020-05-19 03:02:35', '2020-05-19 03:02:35'),
(13, 'complaint-26', 'complaints/Tf56lc8Rf2mQOoH9fnC4gJ58upwNPEqSiOgGWhLe.mpga', '2020-05-19 03:23:22', '2020-05-19 03:23:22'),
(14, 'complaint-27', 'complaints/gcKyVvtcgcatzJjQgeVovJgH9pnH1DCvAt26fyhY.jpeg', '2020-05-19 03:25:30', '2020-05-19 03:25:30'),
(15, 'complaint-27', 'complaints/GkBtYIdK5C2osl3wregddSVAWbGGchSHxbdqsC2O.jpeg', '2020-05-19 03:25:30', '2020-05-19 03:25:30');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `parent` int(11) DEFAULT 0,
  `level` int(11) DEFAULT NULL,
  `admin_level` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `url`, `parent`, `level`, `admin_level`, `created_at`, `updated_at`) VALUES
(1, 'Overview', '/', 0, 1, 5, '2018-02-19 14:39:21', '2018-02-19 14:39:24'),
(2, 'Admin', '/admin/administrators', 0, 1, 5, '2018-02-19 14:39:48', '2018-02-19 14:39:49'),
(3, 'Inventory', '/inventory/product/add-product', 0, 1, 5, '2018-02-19 14:40:04', '2018-02-19 14:40:04'),
(4, 'Complaints', '/complaints', 0, 1, 5, '2018-02-19 14:40:17', '2018-02-19 14:40:17'),
(5, 'Reports', '/reports/store', 0, 1, 5, '2018-02-19 14:40:29', '2018-02-19 14:40:29'),
(6, 'Sales', '/sales/prospects', 0, 1, 5, '2018-02-19 14:40:41', '2018-02-19 14:40:41'),
(7, 'Client Followups', '/client-followups', 0, 1, 5, '2018-02-19 14:41:08', '2018-02-19 14:41:08'),
(8, 'Administrators', '/admin/administrators', 2, 2, 5, '2018-02-19 14:43:08', '2018-02-19 14:43:09'),
(9, 'Cleaners', '/admin/cleaners', 2, 2, 5, '2018-02-19 14:43:26', '2018-02-19 14:43:27'),
(10, 'Inspectors', '/admin/inspectors', 2, 2, 5, '2018-02-19 14:43:58', '2018-02-19 14:43:58'),
(11, 'User Management', '/admin/user-management', 2, 2, 5, '2018-02-19 14:44:30', '2018-02-19 14:44:32'),
(12, 'Client Information', '/admin/clients', 2, 2, 5, '2018-02-19 14:44:54', '2018-02-19 14:44:55'),
(13, 'Product', '/inventory/product', 3, 2, 5, '2018-02-19 15:00:20', '2018-02-19 15:00:20'),
(14, 'Alert', '/inventory/alert', 3, 2, 5, '2018-02-19 15:00:34', '2018-02-19 15:00:36'),
(15, 'Overview', '/inventory/overview', 3, 2, 5, '2018-02-19 15:00:51', '2018-02-19 15:00:40'),
(16, 'Add a Product', '/inventory/product/add-product', 13, 3, 5, '2018-02-19 15:01:43', '2018-02-19 15:01:47'),
(17, 'Manage Inventory', '/inventory/product/client-supply', 13, 3, 5, '2018-02-19 15:01:43', '2018-02-19 15:01:47'),
(18, 'Cost Monitoring', '/inventory/product/cost-monitoring', 13, 3, 5, '2018-02-19 15:01:43', '2018-02-19 15:01:47'),
(19, 'Cleaner Information', '/admin/cleaners/', 9, 3, 5, '2018-02-19 15:05:02', '2018-02-19 15:05:02'),
(20, 'Login Details', '/admin/cleaners/login-details', 9, 3, 5, '2018-02-19 15:05:02', '2018-02-19 15:05:02'),
(21, 'Register Client', '/admin/clients/add-new', 12, 3, 5, '2018-02-19 15:06:45', '2018-02-19 15:06:45'),
(22, 'Allocations', '/admin/clients/allocations', 12, 3, 5, '2018-02-19 15:06:45', '2018-02-19 15:06:45'),
(23, 'Store', '/reports/store', 5, 2, 5, '2018-02-19 15:14:30', '2018-02-19 15:14:30'),
(24, 'Complaints', '/reports/complaints', 5, 2, 5, '2018-02-19 15:14:30', '2018-02-19 15:14:30'),
(25, 'Cleaners', '/reports/cleaners', 5, 2, 5, '2018-02-19 15:14:30', '2018-02-19 15:14:30'),
(26, 'Inspectors', '/reports/inspectors', 5, 2, 5, '2018-02-19 15:14:30', '2018-02-19 15:14:30'),
(27, 'Prospects', '/sales/prospects', 6, 2, 5, '2018-02-19 15:17:58', '2018-02-19 15:17:58'),
(28, 'Followup', '/sales/followup', 6, 2, 5, '2018-02-19 15:17:58', '2018-02-19 15:17:58'),
(29, 'Tasks', '/reports/tasks', 5, 2, 5, '2018-04-09 12:27:31', '2018-04-09 12:27:38');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(6, '2020_04_13_235541_create_accounting_contacts_table', 0),
(7, '2020_04_13_235541_create_admins_table', 0),
(8, '2020_04_13_235541_create_alerts_table', 0),
(9, '2020_04_13_235541_create_categories_table', 0),
(10, '2020_04_13_235541_create_checklist_item_feedback_media_table', 0),
(11, '2020_04_13_235541_create_checklist_item_feedbacks_table', 0),
(12, '2020_04_13_235541_create_checklist_items_table', 0),
(13, '2020_04_13_235541_create_checklists_table', 0),
(14, '2020_04_13_235541_create_cleaner_alert_table', 0),
(15, '2020_04_13_235541_create_cleaner_schedule_audio_table', 0),
(16, '2020_04_13_235541_create_cleaner_schedule_media_table', 0),
(17, '2020_04_13_235541_create_cleaner_schedule_product_table', 0),
(18, '2020_04_13_235541_create_cleaner_schedules_table', 0),
(19, '2020_04_13_235541_create_cleaner_task_table', 0),
(20, '2020_04_13_235541_create_cleaners_table', 0),
(21, '2020_04_13_235541_create_client_followup_comments_table', 0),
(22, '2020_04_13_235541_create_client_followups_table', 0),
(23, '2020_04_13_235541_create_client_product_table', 0),
(24, '2020_04_13_235541_create_clients_table', 0),
(25, '2020_04_13_235541_create_complaint_followups_table', 0),
(26, '2020_04_13_235541_create_complaint_media_table', 0),
(28, '2020_04_13_235541_create_feedback_table', 0),
(29, '2020_04_13_235541_create_followup_comments_table', 0),
(30, '2020_04_13_235541_create_followups_table', 0),
(31, '2020_04_13_235541_create_inspector_alert_table', 0),
(32, '2020_04_13_235541_create_inspector_schedules_table', 0),
(33, '2020_04_13_235541_create_inspector_task_table', 0),
(34, '2020_04_13_235541_create_inspectors_table', 0),
(35, '2020_04_13_235541_create_media_table', 0),
(36, '2020_04_13_235541_create_menus_table', 0),
(37, '2020_04_13_235541_create_oauth_access_tokens_table', 0),
(38, '2020_04_13_235541_create_oauth_auth_codes_table', 0),
(39, '2020_04_13_235541_create_oauth_clients_table', 0),
(40, '2020_04_13_235541_create_oauth_personal_access_clients_table', 0),
(41, '2020_04_13_235541_create_oauth_refresh_tokens_table', 0),
(42, '2020_04_13_235541_create_operational_contacts_table', 0),
(43, '2020_04_13_235541_create_password_resets_table', 0),
(44, '2020_04_13_235541_create_permission_role_table', 0),
(45, '2020_04_13_235541_create_permissions_table', 0),
(46, '2020_04_13_235541_create_products_table', 0),
(47, '2020_04_13_235541_create_prospect_comments_table', 0),
(48, '2020_04_13_235541_create_prospect_meetings_table', 0),
(49, '2020_04_13_235541_create_prospects_table', 0),
(50, '2020_04_13_235541_create_query_log_table', 0),
(51, '2020_04_13_235541_create_roles_table', 0),
(52, '2020_04_13_235541_create_schedule_task_table', 0),
(53, '2020_04_13_235541_create_schedules_table', 0),
(54, '2020_04_13_235541_create_stock_product_table', 0),
(55, '2020_04_13_235541_create_stocks_table', 0),
(56, '2020_04_13_235541_create_task_item_status_table', 0),
(57, '2020_04_13_235541_create_task_items_table', 0),
(58, '2020_04_13_235541_create_task_options_table', 0),
(59, '2020_04_13_235541_create_task_status_table', 0),
(60, '2020_04_13_235541_create_tasks_table', 0),
(61, '2020_04_13_235541_create_users_table', 0),
(62, '2020_04_13_235547_add_foreign_keys_to_accounting_contacts_table', 0),
(63, '2020_04_13_235547_add_foreign_keys_to_admins_table', 0),
(64, '2020_04_13_235547_add_foreign_keys_to_checklist_item_feedbacks_table', 0),
(65, '2020_04_13_235547_add_foreign_keys_to_checklist_items_table', 0),
(66, '2020_04_13_235547_add_foreign_keys_to_checklists_table', 0),
(67, '2020_04_13_235547_add_foreign_keys_to_cleaner_alert_table', 0),
(68, '2020_04_13_235547_add_foreign_keys_to_cleaner_schedule_audio_table', 0),
(69, '2020_04_13_235547_add_foreign_keys_to_cleaner_schedule_media_table', 0),
(70, '2020_04_13_235547_add_foreign_keys_to_cleaner_schedule_product_table', 0),
(71, '2020_04_13_235547_add_foreign_keys_to_cleaner_schedules_table', 0),
(72, '2020_04_13_235547_add_foreign_keys_to_cleaner_task_table', 0),
(73, '2020_04_13_235547_add_foreign_keys_to_cleaners_table', 0),
(74, '2020_04_13_235547_add_foreign_keys_to_client_followup_comments_table', 0),
(75, '2020_04_13_235547_add_foreign_keys_to_client_product_table', 0),
(76, '2020_04_13_235547_add_foreign_keys_to_clients_table', 0),
(77, '2020_04_13_235547_add_foreign_keys_to_complaint_followups_table', 0),
(78, '2020_04_13_235547_add_foreign_keys_to_complaint_media_table', 0),
(79, '2020_04_13_235547_add_foreign_keys_to_complaints_table', 0),
(80, '2020_04_13_235547_add_foreign_keys_to_feedback_table', 0),
(81, '2020_04_13_235547_add_foreign_keys_to_followup_comments_table', 0),
(82, '2020_04_13_235547_add_foreign_keys_to_inspector_alert_table', 0),
(83, '2020_04_13_235547_add_foreign_keys_to_inspector_schedules_table', 0),
(84, '2020_04_13_235547_add_foreign_keys_to_inspector_task_table', 0),
(85, '2020_04_13_235547_add_foreign_keys_to_inspectors_table', 0),
(86, '2020_04_13_235547_add_foreign_keys_to_operational_contacts_table', 0),
(87, '2020_04_13_235547_add_foreign_keys_to_prospect_comments_table', 0),
(88, '2020_04_13_235547_add_foreign_keys_to_prospect_meetings_table', 0),
(89, '2020_04_13_235547_add_foreign_keys_to_schedule_task_table', 0),
(90, '2020_04_13_235547_add_foreign_keys_to_stock_product_table', 0),
(91, '2020_04_13_235547_add_foreign_keys_to_task_item_status_table', 0),
(92, '2020_04_13_235547_add_foreign_keys_to_task_items_table', 0),
(93, '2020_04_13_235547_add_foreign_keys_to_task_status_table', 0),
(94, '2020_04_13_235547_add_foreign_keys_to_tasks_table', 0),
(95, '2020_04_14_001645_add_votes_to_users_table', 2),
(96, '2020_04_14_001713_add_status_to_menus_table', 2),
(97, '2020_05_04_232917_create_cleaner_check_lists_table', 3),
(98, '2020_05_05_015542_create_cleaner_check_list_items_table', 3),
(100, '2020_05_11_003411_create_cleaner_times_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('02770bfd612a696cd9cbc4f8cd1dd8d8e164091d4ccf47dde9c8db31c42f559260e2d7ec41d1fa23', 76, 2, NULL, '[\"*\"]', 0, '2019-02-19 15:17:25', '2019-02-19 15:17:25', '2020-02-19 15:47:25'),
('0376333d09d5a5c5621358bc4020785fc56d6d248b10f983f1525734864f3413a414472be948ada0', 88, 2, NULL, '[\"*\"]', 0, '2019-05-08 10:34:28', '2019-05-08 10:34:28', '2020-05-08 11:04:28'),
('037a8d13c3802c68c2d7e8e47839941468713c3e75ec86075624014c7c16be4e569c91345f5478bb', 2, 2, NULL, '[\"*\"]', 0, '2019-11-06 21:20:20', '2019-11-06 21:20:20', '2020-11-06 21:50:20'),
('0400c9b04f8639498b92cdd5b2532d5fe04be7e594d3612d620de5fcdcc0dd8b877b4bbe287a99c5', 73, 2, NULL, '[\"*\"]', 0, '2019-03-01 12:25:23', '2019-03-01 12:25:23', '2020-03-01 12:55:23'),
('04343856ec9873cb4050169a5b730b5b584f383afd26d206b480e93aae0b6a9652bcaaee0f45d3fe', 76, 2, NULL, '[\"*\"]', 0, '2019-03-21 02:16:22', '2019-03-21 02:16:22', '2020-03-21 02:46:22'),
('093c641036b39420b1f9f42453b696b74f47a69477676eba2158d44444e948ef08f1143a6745ca17', 71, 2, NULL, '[\"*\"]', 0, '2019-04-10 06:29:37', '2019-04-10 06:29:37', '2020-04-10 06:59:37'),
('0a594de7ee6ecc6c3e25d41bbffbb61881268ab7252fe01a657b4772a9357c01fc3bf3d26bc75bac', 88, 2, NULL, '[\"*\"]', 0, '2019-07-03 10:15:05', '2019-07-03 10:15:05', '2020-07-03 10:45:05'),
('0a6fa3b57bc1fe846b772ce9ee4cbb87f0ab635c4ce870dee7a71cda6d04a0e440c612802fecc01a', 88, 2, NULL, '[\"*\"]', 0, '2019-05-10 11:22:41', '2019-05-10 11:22:41', '2020-05-10 11:52:41'),
('0a9d105e9b06c07386f3f786fd01b37fe2ac3170ca069729f0aebdc0c3f228e4e53390fcb512812d', 72, 2, NULL, '[\"*\"]', 0, '2019-06-25 01:44:17', '2019-06-25 01:44:17', '2020-06-25 02:14:17'),
('0b9f4c56a052865af53e9367bda0fdeb0b86ed645e3650db6d44c6c69c228d04d07ea2cf6b288f80', 69, 2, NULL, '[\"*\"]', 0, '2019-02-28 03:53:23', '2019-02-28 03:53:23', '2020-02-28 04:23:23'),
('0c3c07ae4b3a85d0bdffd7688dff205bbb2d785454898790dbbadcc93dfd7a050f57c8d4d77a1774', 69, 2, NULL, '[\"*\"]', 0, '2019-02-14 05:42:37', '2019-02-14 05:42:37', '2020-02-14 06:12:37'),
('0c7e8333d398512358507d3660ad3a52a18f586d5fa97817c7b6f59c2efae1815e1e7eea0ca1c7e6', 71, 2, NULL, '[\"*\"]', 0, '2019-02-28 03:52:48', '2019-02-28 03:52:48', '2020-02-28 04:22:48'),
('0caf7f08a7754600620e26493a12ef094cfb0a0b091816a856a2d9881aeabd792d1741633f58d0fe', 75, 2, NULL, '[\"*\"]', 0, '2019-03-21 02:11:52', '2019-03-21 02:11:52', '2020-03-21 02:41:52'),
('101a51810cbf2f8ec47757d56014a96b9c48fd83023d4eab533eb1fab550588912408ad010ccad13', 2, 2, NULL, '[\"*\"]', 0, '2019-10-28 04:04:10', '2019-10-28 04:04:10', '2020-10-28 04:34:10'),
('104e8ceb7b6b64758e87450b6be1228c65b6c3bbcaffa95969b1d9abff0762ccbffbc1b3040579ce', 78, 2, NULL, '[\"*\"]', 0, '2019-03-12 23:29:09', '2019-03-12 23:29:09', '2020-03-12 23:59:09'),
('1052a5e4873eb95ef2657d36998ec354aec28164f1601f39a2ce76be408fbcaf9417c6bc654c75d7', 88, 2, NULL, '[\"*\"]', 0, '2019-05-08 12:11:55', '2019-05-08 12:11:55', '2020-05-08 12:41:55'),
('10e701ae641f6130c822fec9041b76d4075adc2a3ed50b060cd39e71801d2db18e59324647a004e5', 74, 2, NULL, '[\"*\"]', 0, '2019-03-20 23:07:53', '2019-03-20 23:07:53', '2020-03-20 23:37:53'),
('11c85a2cf32155ba1b1d2e71470e4da07c23ed1f51d085903042b1e8afb5cb2af283601dc1c28f15', 78, 2, NULL, '[\"*\"]', 0, '2019-04-09 03:59:41', '2019-04-09 03:59:41', '2020-04-09 04:29:41'),
('18db89e95bdeadf3eb66dfbc2568ad0625b189ea0cda6c2fff4b1378597c0f8b14b648bcfe6b5731', 88, 2, NULL, '[\"*\"]', 0, '2019-04-29 17:52:23', '2019-04-29 17:52:23', '2020-04-29 18:22:23'),
('19ab247ad5be89d574f11dbaa6fd6e074e6742434a8c85861147afd485f8c1d5dffebc5f66cd752b', 8, 2, NULL, '[\"*\"]', 0, '2019-10-29 06:04:03', '2019-10-29 06:04:03', '2020-10-29 06:34:03'),
('1a15696481b8ba18be72ce36ed8cbf5f5204907f668612319919dd4d5cd448d9c8620abfa3548322', 72, 2, NULL, '[\"*\"]', 0, '2019-02-14 06:32:15', '2019-02-14 06:32:15', '2020-02-14 07:02:15'),
('1acf6e825f62d1b84ce227efe19c909225c18380d0b6995c3495363a7fe0e2ad805f7650f2f0403a', 3, 2, NULL, '[\"*\"]', 0, '2019-11-14 10:35:59', '2019-11-14 10:35:59', '2020-11-14 11:05:59'),
('1b1b792a3d84f9677fdb2aa5612be66f02ccf43e49a8f1c46a35539380f2933d2385640b051ddbde', 71, 2, NULL, '[\"*\"]', 0, '2019-02-14 06:24:51', '2019-02-14 06:24:51', '2020-02-14 06:54:51'),
('1c1fb2eb6883008b76c5a008f67d9bc96e44e389aafabbd54aaf1059d917c3a8045f03b2513d7a19', 88, 2, NULL, '[\"*\"]', 0, '2019-05-08 12:05:49', '2019-05-08 12:05:49', '2020-05-08 12:35:49'),
('1c88cb6564b40d0ccb021688ff238cac6324de33cc19ed9c4b08714457690260b1c8dbe98e85a728', 88, 2, NULL, '[\"*\"]', 0, '2019-05-17 10:40:50', '2019-05-17 10:40:50', '2020-05-17 11:10:50'),
('1d539ccaf6ae52328cf8b1f52d0765c716ea3ac2f33da71974a260166696020e0d20badcf47062de', 88, 2, NULL, '[\"*\"]', 0, '2019-04-15 09:38:43', '2019-04-15 09:38:43', '2020-04-15 10:08:43'),
('1e26d942575a599972774fba7c055c8525c16cc27b37d45a11889b461b8aa7a14929ec4af8875590', 88, 2, NULL, '[\"*\"]', 0, '2019-05-03 10:06:14', '2019-05-03 10:06:14', '2020-05-03 10:36:14'),
('2011522ac50d588b3ae08b98c81d7a2e29fea587f6cfd2acae883d0801ae50fc885766dba3ec345d', 73, 2, NULL, '[\"*\"]', 0, '2019-06-28 11:40:53', '2019-06-28 11:40:53', '2020-06-28 12:10:53'),
('21572b5c06b1aaccfad58f8bc703569a13364d389b98c3f97081ee596987fa3c6ee7d32ce43091be', 88, 2, NULL, '[\"*\"]', 0, '2019-04-22 13:22:52', '2019-04-22 13:22:52', '2020-04-22 13:52:52'),
('24bbbfbbc8b6845756f47e1f1059006a60c0ef9536475cac037a07f91fbe61ee10d945def13644ab', 71, 2, NULL, '[\"*\"]', 0, '2019-06-25 01:55:27', '2019-06-25 01:55:27', '2020-06-25 02:25:27'),
('24d60d77bd1169c0bdfebf05f5c3a11eaf232fb5c1f8b6a06369d8eca03fdae87812d5f0ac6ddfac', 72, 2, NULL, '[\"*\"]', 0, '2019-02-28 03:58:41', '2019-02-28 03:58:41', '2020-02-28 04:28:41'),
('26122eb84f21fbda68c6b482e8dd8353203ad46f769a903adcfb282bb2c5cdd37a338414a3b2ef8f', 88, 2, NULL, '[\"*\"]', 0, '2019-05-15 11:12:24', '2019-05-15 11:12:24', '2020-05-15 11:42:24'),
('265eb6a44cdb30a220b9fb8d343698544082bd06efdb1d29c111f95fbbdd80c551c5f04880352b2f', 88, 2, NULL, '[\"*\"]', 0, '2019-04-30 11:25:41', '2019-04-30 11:25:41', '2020-04-30 11:55:41'),
('2698c9fb47a3be663bfd3e14f5debadedcc3aa7b8e298d419782e718bf201a8468ad624228ad6cf0', 88, 2, NULL, '[\"*\"]', 0, '2019-05-24 14:02:59', '2019-05-24 14:02:59', '2020-05-24 14:32:59'),
('28aa882468ce6349ceefbe1b118ae1168f60f51c4c2c351511d28aa504f364f509c93613100c3ba3', 88, 2, NULL, '[\"*\"]', 0, '2019-05-08 12:03:00', '2019-05-08 12:03:00', '2020-05-08 12:33:00'),
('296e27d0c430ae410a9d0ae98e242cec22f88da4f34e2256461e8ad5e83aaed0ff0d3c9cd1a5148c', 71, 2, NULL, '[\"*\"]', 0, '2019-04-10 06:55:39', '2019-04-10 06:55:39', '2020-04-10 07:25:39'),
('2a3b59359e3c339bb44da850d02a305e1dbdbfe44b62cdca90fa3020400700b6b37e6d2d39927b77', 76, 2, NULL, '[\"*\"]', 0, '2019-03-12 23:33:26', '2019-03-12 23:33:26', '2020-03-13 00:03:26'),
('2ab04bc00128171a98af20e9d474741e4a5b5798e23eb7d04561ad5732bf5f300eff172fa131cf24', 76, 2, NULL, '[\"*\"]', 0, '2019-03-01 12:06:47', '2019-03-01 12:06:47', '2020-03-01 12:36:47'),
('2c3bc935766e92a970456f13bdce06f4379d55c2599170b02bb30f097363cc61fb293c1e9f71c59b', 88, 2, NULL, '[\"*\"]', 0, '2019-07-17 20:52:16', '2019-07-17 20:52:16', '2020-07-17 21:22:16'),
('2daec09401b54cfd793d3ee3a1180852c78c0bf6b48f7eab27fe44ec5aa71d7d463bbe3d0a772998', 70, 2, NULL, '[\"*\"]', 0, '2019-02-14 22:25:05', '2019-02-14 22:25:05', '2020-02-14 22:55:05'),
('2fc3c7dfcc879bedb364555e86759c1a56714f0b301794d9569a712f110160988c31add883272272', 78, 2, NULL, '[\"*\"]', 0, '2019-04-16 13:37:45', '2019-04-16 13:37:45', '2020-04-16 14:07:45'),
('304f488a3f563d3fd5a80f491d6dc58f1d4947989eb234bee3eef7a08d584df6884b63d12557a42e', 76, 2, NULL, '[\"*\"]', 0, '2019-03-01 14:33:24', '2019-03-01 14:33:24', '2020-03-01 15:03:24'),
('30ce17a09cf228761ee11a275a818ce244ce42877e733b8a0f184575298243e8b54a40f5d439c6bf', 88, 2, NULL, '[\"*\"]', 0, '2019-05-15 12:41:03', '2019-05-15 12:41:03', '2020-05-15 13:11:03'),
('319951226c052bef252673fd6f35baa613e544562da3706f75f44b300ec034161cc25c2703ca4b25', 78, 2, NULL, '[\"*\"]', 0, '2019-04-11 20:31:59', '2019-04-11 20:31:59', '2020-04-11 21:01:59'),
('326ed1a7089fe589993aeb444e2fb3dfaba116e7a1c0016a997746928ba8a211ec9759b44d4558f2', 78, 2, NULL, '[\"*\"]', 0, '2019-03-08 16:13:42', '2019-03-08 16:13:42', '2020-03-08 16:43:42'),
('32fa60e5d96e73ffcd2155a549f5690b52e3c4312731aab679e2ebd389049eef574dc9c56b024775', 78, 2, NULL, '[\"*\"]', 0, '2019-06-28 11:43:45', '2019-06-28 11:43:45', '2020-06-28 12:13:45'),
('33bef60f22d26d4df4cf498e2c282339b8002d4be4f6eab0118424bd1ea2705299eb8ab48685dd1c', 73, 2, NULL, '[\"*\"]', 0, '2019-02-21 11:09:39', '2019-02-21 11:09:39', '2020-02-21 11:39:39'),
('34224e53cd7f175d68bbf1e2401bab5a187064b8f9a28d5d6d10a20559559fe3eff018abe90cd603', 88, 2, NULL, '[\"*\"]', 0, '2019-05-17 09:21:05', '2019-05-17 09:21:05', '2020-05-17 09:51:05'),
('3586a0d274a426459a6c33e0abbeab4a41ea1402b00187d836886d21b183f2594a94ba86f4ff9a92', 88, 2, NULL, '[\"*\"]', 0, '2019-07-08 12:53:26', '2019-07-08 12:53:26', '2020-07-08 13:23:26'),
('3761d2d2866db7ff2eed852c84a99a7fb7d57cf866820383d40cd02edc46822635625a7a2e80156f', 76, 2, NULL, '[\"*\"]', 0, '2019-02-22 15:52:29', '2019-02-22 15:52:29', '2020-02-22 16:22:29'),
('378a913b5564dd723e51c0b0af124c6ed3fcf01d1f849d2c9dcbd828d96b1ed22192b3c2bc547693', 72, 2, NULL, '[\"*\"]', 0, '2019-04-10 01:17:05', '2019-04-10 01:17:05', '2020-04-10 01:47:05'),
('39541b85d3192f957be0e5a2e79939c683882947f71f2ac4fd948db23b890083358eb5615f5cf2bb', 72, 2, NULL, '[\"*\"]', 0, '2019-02-14 06:34:49', '2019-02-14 06:34:49', '2020-02-14 07:04:49'),
('3a70ae9c54167d1fbcf9ef096c22071ed504c95b6d75cc805eaa644e826e5fe19ea5e21bfd2bad09', 69, 2, NULL, '[\"*\"]', 0, '2019-07-20 13:28:39', '2019-07-20 13:28:39', '2020-07-20 13:58:39'),
('3ca11ec816948f21401aa4ba83069ede8e2427e14ad12721b0dc965799eb77db7f6821da45f63641', 9, 2, NULL, '[\"*\"]', 0, '2019-11-14 11:03:43', '2019-11-14 11:03:43', '2020-11-14 11:33:43'),
('3df5deb810e3d9a35c2dabe73f8e99a28c0c248b4b188422b6a4c176ac7cd990676a7a4f94efc050', 88, 2, NULL, '[\"*\"]', 0, '2019-05-10 10:07:32', '2019-05-10 10:07:32', '2020-05-10 10:37:32'),
('3e464154d045b73f2c10da018988d0550224e5352ae67a6f9cad1e2ec5be9a826a45de542e4e4702', 72, 2, NULL, '[\"*\"]', 0, '2019-06-25 01:51:16', '2019-06-25 01:51:16', '2020-06-25 02:21:16'),
('3e7935f2f7f492c5a9aa505883fc1e7d4c90fb8d147a3363f635edfac4bfe2672c72a0c2061bf742', 69, 2, NULL, '[\"*\"]', 0, '2019-04-10 06:30:44', '2019-04-10 06:30:44', '2020-04-10 07:00:44'),
('401ae9f1a273fd82446e589bf508130c4d9eb1c691b80ffff02366e150c4b266bc73a41f9c1be784', 90, 2, NULL, '[\"*\"]', 0, '2019-06-03 11:39:48', '2019-06-03 11:39:48', '2020-06-03 12:09:48'),
('409042a4b481936da712a0d25bed9e1b8f5170a9321fa9304c5155fc1bf810d1681e29e58e409a2e', 71, 2, NULL, '[\"*\"]', 0, '2019-06-24 10:03:00', '2019-06-24 10:03:00', '2020-06-24 10:33:00'),
('40ec5e88590a527eaa4efbbcd5d8a198df94f54847fc17e7a15fef9c0ee5014262871b4769eb24e9', 72, 2, NULL, '[\"*\"]', 0, '2019-04-10 00:30:57', '2019-04-10 00:30:57', '2020-04-10 01:00:57'),
('416313d91855c59db8cae7bbcf0690b6efac5781b04f25441523d408237cd59a9fa8ccc0be3bc288', 72, 2, NULL, '[\"*\"]', 0, '2019-04-10 01:04:17', '2019-04-10 01:04:17', '2020-04-10 01:34:17'),
('41e660a08ef389c04ff3723eedb43ccd1e64e0e87cf8c76ae396f5cfbfae7812b810cd9dcaea0717', 80, 2, NULL, '[\"*\"]', 0, '2019-04-11 12:20:02', '2019-04-11 12:20:02', '2020-04-11 12:50:02'),
('431edcfb74fecaa857d6d5abf09050db7d2353c9eb7ef03d4c99f196da88c5840750e2e41dd026a0', 88, 2, NULL, '[\"*\"]', 0, '2019-05-24 10:49:08', '2019-05-24 10:49:08', '2020-05-24 11:19:08'),
('44333abc6d530d0fdd4c42ee093d74ff2b2bc597f4e45cec0568cb6dbe49cfd0d887b14889af24b8', 69, 2, NULL, '[\"*\"]', 0, '2019-04-11 04:37:06', '2019-04-11 04:37:06', '2020-04-11 05:07:06'),
('46817aa34b74e1f82c1a1cba62a29876887bfb8b866367e273f6e3a4b6eaefbee2ffc7a54560cb44', 73, 2, NULL, '[\"*\"]', 0, '2019-03-01 12:08:30', '2019-03-01 12:08:30', '2020-03-01 12:38:30'),
('46cdd67f551dda37f5f9533f5c39cdd497d9760f1113b74791420f507b49b11c583d094b9241ef7e', 88, 2, NULL, '[\"*\"]', 0, '2019-05-17 10:15:06', '2019-05-17 10:15:06', '2020-05-17 10:45:06'),
('4719cacd94c11c7c3a25ad6350ef5d3b7e357a06bcd7f4a6ca5a836b39f4fe85a46373733b4ce24c', 88, 2, NULL, '[\"*\"]', 0, '2019-05-08 11:29:38', '2019-05-08 11:29:38', '2020-05-08 11:59:38'),
('4735402ce8b394318557ca9e4dcd19b34878278d495f42092ead17253cc15306091179f5c922f4fd', 78, 2, NULL, '[\"*\"]', 0, '2019-09-05 11:16:18', '2019-09-05 11:16:18', '2020-09-05 11:46:18'),
('4a61a975647a4fda5b637cdf9b0b8c104dee808accdb29348b0f923c7158d825a44ae215de0a6709', 88, 2, NULL, '[\"*\"]', 0, '2019-05-16 11:15:42', '2019-05-16 11:15:42', '2020-05-16 11:45:42'),
('4d73e620d8bee5e0242efdd8c2ccbc785151e9600a5535f501224909b7a2a75c6af471b1bc64a8f4', 88, 2, NULL, '[\"*\"]', 0, '2019-04-26 10:42:28', '2019-04-26 10:42:28', '2020-04-26 11:12:28'),
('4e83306a8e8bc9548cf75f92065d6b35cac05fb1cf6de75bddd0238beb23b2478c090f6d822eb178', 69, 2, NULL, '[\"*\"]', 0, '2019-05-20 04:47:38', '2019-05-20 04:47:38', '2020-05-20 05:17:38'),
('4f35868e670a3974044d1c5486b878a349546e7c4e57cce5eadebbb69454b2b64a1418d2f27691e9', 88, 2, NULL, '[\"*\"]', 0, '2019-05-22 11:27:05', '2019-05-22 11:27:05', '2020-05-22 11:57:05'),
('4f9d578875dda5626df53f9181f0021033163688dd4a27307867cb196c81170550f51fd6bb0f5822', 77, 2, NULL, '[\"*\"]', 0, '2019-02-19 15:07:14', '2019-02-19 15:07:14', '2020-02-19 15:37:14'),
('4fa3d120bdf02c9ad69f619b44c0e3f4b3a5a85d57533696bf436ada4794715b7d47280c50aaaebc', 88, 2, NULL, '[\"*\"]', 0, '2019-07-16 10:12:48', '2019-07-16 10:12:48', '2020-07-16 10:42:48'),
('4fa77ed9ad2eba527ecddf6b63dc88afc302d199f58def9c39532cf4d445e60f10b6b88866d6b0da', 90, 2, NULL, '[\"*\"]', 0, '2019-06-13 12:31:09', '2019-06-13 12:31:09', '2020-06-13 13:01:09'),
('51a223fa9b9d1ac17ee2d1c42ecd71119b9bf678ee3662c287edeeea1f30f208fa390bbdb38f2b9a', 78, 2, NULL, '[\"*\"]', 0, '2019-03-20 23:15:33', '2019-03-20 23:15:33', '2020-03-20 23:45:33'),
('539bd3c44e9fb9a7e9a393e4fce651cc0fade4ab5a21b58b03705c16ebea18b750f46e6c0004525b', 88, 2, NULL, '[\"*\"]', 0, '2019-05-03 12:15:59', '2019-05-03 12:15:59', '2020-05-03 12:45:59'),
('54d779101f83c71a58dff7f639e8868339e12bd86e3bcfc64c6cdd52529d8792fea22fca66f53907', 78, 2, NULL, '[\"*\"]', 0, '2019-04-10 05:13:44', '2019-04-10 05:13:44', '2020-04-10 05:43:44'),
('55bcdf034a6a845173f49a346e7a184df83a2091370f95a952882a3a3f6850b298eee1bcf1163457', 70, 2, NULL, '[\"*\"]', 0, '2019-04-10 01:33:49', '2019-04-10 01:33:49', '2020-04-10 02:03:49'),
('55c67fc424f9c6efb0d4f510cb82dde1a2690f0d5333189f3fec72628194732871ff7a8bc132cd1f', 88, 2, NULL, '[\"*\"]', 0, '2019-07-02 11:17:01', '2019-07-02 11:17:01', '2020-07-02 11:47:01'),
('56bf498b22cc41f818f203199239e59740c83d15d38e7bbdbc94f851ea187884839ef2f9f4015ef4', 88, 2, NULL, '[\"*\"]', 0, '2019-05-22 12:45:34', '2019-05-22 12:45:34', '2020-05-22 13:15:34'),
('5a988856a1e28da587e3718a59de1e81799187512b7fccb4f807b50cbedeb946d38e4d134c186695', 78, 2, NULL, '[\"*\"]', 0, '2019-10-08 08:00:31', '2019-10-08 08:00:31', '2020-10-08 08:30:31'),
('5c219310d92ae5018b12daefe5293ab8cead2244b723f1698fcd26f57cb369e2f22094ac6fd04a99', 71, 2, NULL, '[\"*\"]', 0, '2019-02-14 05:57:25', '2019-02-14 05:57:25', '2020-02-14 06:27:25'),
('5d97cfa5b710c17094a43e3a16aed3cde4ba7b003beef7066c98e1cd5aec85c345843986080ad5ae', 78, 2, NULL, '[\"*\"]', 0, '2019-03-01 12:33:09', '2019-03-01 12:33:09', '2020-03-01 13:03:09'),
('61981a714daccee5b19cd048fad1c4e7685832af17819526a083c9fe6a82b06f85949255efeadf21', 73, 2, NULL, '[\"*\"]', 0, '2019-02-19 15:16:06', '2019-02-19 15:16:06', '2020-02-19 15:46:06'),
('62cca7be496d978aad7f5a0cf037dfce5325e9f08c8d72dca10e9e88d3c764a64b2cef704408efc3', 83, 2, NULL, '[\"*\"]', 0, '2019-03-08 13:07:10', '2019-03-08 13:07:10', '2020-03-08 13:37:10'),
('63c33069a2441377d1b218fabee6a9bd4c2398adba47d13146886ac7fd2e4643141a6f487476f3e3', 75, 2, NULL, '[\"*\"]', 0, '2019-03-13 10:35:34', '2019-03-13 10:35:34', '2020-03-13 11:05:34'),
('63fec055516632e5c9c349cf929d6c35e978e5f48040d3fcb4838eccc0a4240b8586b169cd3bf4d7', 71, 2, NULL, '[\"*\"]', 0, '2019-04-10 06:57:30', '2019-04-10 06:57:30', '2020-04-10 07:27:30'),
('646d40642d86ea386fd6ac6d91530a514c7ac4770d4b33e319f1d8bf0f43a321468529db3e5b0443', 76, 2, NULL, '[\"*\"]', 0, '2019-03-01 12:09:32', '2019-03-01 12:09:32', '2020-03-01 12:39:32'),
('65681ffe95278fe48bb4ed6a3c139714421cfb129184d0d66655274650d0c800aa05182c4d1c79b7', 88, 2, NULL, '[\"*\"]', 0, '2019-05-16 12:47:44', '2019-05-16 12:47:44', '2020-05-16 13:17:44'),
('65b5ec65c9f63f2dbba5f55cba9311310db953bcfbadfa3c7520a15de567f7ad36608f79157eb4d4', 88, 2, NULL, '[\"*\"]', 0, '2019-05-30 12:43:21', '2019-05-30 12:43:21', '2020-05-30 13:13:21'),
('65bcaa21e0ff182e57ce6cef47360329451ecce3000bd6717b7d0927197795b44d198c33727c2791', 74, 2, NULL, '[\"*\"]', 0, '2019-03-21 02:13:09', '2019-03-21 02:13:09', '2020-03-21 02:43:09'),
('67677086f304df625ef75215817358bea3644ec9eda1de93a1d635027a6d294673ebde151113ef7c', 88, 2, NULL, '[\"*\"]', 0, '2019-04-22 13:23:38', '2019-04-22 13:23:38', '2020-04-22 13:53:38'),
('67957f1fae1218e8c35a8abe26fc511bf6c8dbdaedfd170c833b756a61c8ab48acb3c9c3d4b23812', 88, 2, NULL, '[\"*\"]', 0, '2019-05-08 13:04:46', '2019-05-08 13:04:46', '2020-05-08 13:34:46'),
('689830c213ade7fec7a22ea6b5042938f958dc48cc74eab0730874571fe76008e1fcdd85aaf154dd', 9, 2, NULL, '[\"*\"]', 0, '2019-11-06 20:56:34', '2019-11-06 20:56:34', '2020-11-06 21:26:34'),
('6af62f977d69b86b4be30288134887ee6f68a9bd27ee46a4d6e5857c132ceb835d6e351241331b79', 78, 2, NULL, '[\"*\"]', 0, '2019-03-20 19:11:54', '2019-03-20 19:11:54', '2020-03-20 19:41:54'),
('6bf8af7806cf7d7fac55804ea8ca182a94cce719d6a015237b109c2adfeda643f996ec22be31ec19', 83, 2, NULL, '[\"*\"]', 0, '2019-03-08 13:23:42', '2019-03-08 13:23:42', '2020-03-08 13:53:42'),
('6c9a5889c41c4572b5fbaf117e4cd0695349f8c88f96ce817028ceb7526a35aeafacf1199693ced9', 88, 2, NULL, '[\"*\"]', 0, '2019-05-17 10:12:27', '2019-05-17 10:12:27', '2020-05-17 10:42:27'),
('6e9504f9726c50b31622ed1956370ce7b6b71b5f2eb4bef7cfa898fc9f9b548e0739aa630ba9610c', 2, 2, NULL, '[\"*\"]', 0, '2019-11-06 21:20:25', '2019-11-06 21:20:25', '2020-11-06 21:50:25'),
('6f819e149ca9b2cb3303dfb656b1496e93c32549eb399e2a5725a38ada5aef37b4dd63ed98d25e4d', 69, 2, NULL, '[\"*\"]', 0, '2019-02-20 22:15:10', '2019-02-20 22:15:10', '2020-02-20 22:45:10'),
('70119f502edc59d455492994797309d56c10cc63176acb8c0d26b614443beebf00a4764ea331e3ad', 88, 2, NULL, '[\"*\"]', 0, '2019-06-04 13:44:17', '2019-06-04 13:44:17', '2020-06-04 14:14:17'),
('72bfc4a5b4d05478e0330e0af9fb8804185e70af8ba1a44cc042407f573fbc76d8fc9b71b5a9deee', 69, 2, NULL, '[\"*\"]', 0, '2019-09-07 02:19:25', '2019-09-07 02:19:25', '2020-09-07 02:49:25'),
('73e0cf502107a5ac140af27ce7249fa2d9aff7ffb47ee7291a9f6fc46b9b2919382c8f87c92cb012', 88, 2, NULL, '[\"*\"]', 0, '2019-05-22 11:27:52', '2019-05-22 11:27:52', '2020-05-22 11:57:52'),
('74bdc87650a00a410cb2a3cdee0be04c806221c83257bcc9baf9a4f788b741e7baf853e7cacb0ea7', 69, 2, NULL, '[\"*\"]', 0, '2019-06-24 09:54:44', '2019-06-24 09:54:44', '2020-06-24 10:24:44'),
('750e040cd05e5d7b172070c6893c0d3f068ab1bc5791df4d9ed9d41764ef37bef5b13780e12a8f95', 88, 2, NULL, '[\"*\"]', 0, '2019-05-17 11:36:25', '2019-05-17 11:36:25', '2020-05-17 12:06:25'),
('77ac134fa1962af4e528e88adc8f4475b976142d730f093233e77136486bbef39c7889849c79a283', 88, 2, NULL, '[\"*\"]', 0, '2019-05-17 13:05:23', '2019-05-17 13:05:23', '2020-05-17 13:35:23'),
('78f6210e707f3003df4b3fd47004d75474bb6823ff5b95231e59345be04f3e4ba9058a3267e2b4ad', 69, 2, NULL, '[\"*\"]', 0, '2019-02-27 23:21:00', '2019-02-27 23:21:00', '2020-02-27 23:51:00'),
('79a833bb1bf01db7238ce8d359a5a6aee755b9b61f7a86bbdb96528eee6a6bf1b630220fc02f4115', 2, 2, NULL, '[\"*\"]', 0, '2019-11-06 21:20:54', '2019-11-06 21:20:54', '2020-11-06 21:50:54'),
('7a50b52afa73baa739894cf76c7183253b4e4fabf54ee87f0f898778f0a3f5ecc9d74b1c74f1e102', 88, 2, NULL, '[\"*\"]', 0, '2019-05-16 09:58:35', '2019-05-16 09:58:35', '2020-05-16 10:28:35'),
('7b81d9c798d813a6ec52065a73f6fbb08d77f10a7322deada235a8f19a3d770b953eda99c62e454b', 2, 2, NULL, '[\"*\"]', 0, '2019-11-13 13:41:36', '2019-11-13 13:41:36', '2020-11-13 14:11:36'),
('7c6573fd0f9de79869ffa57c03d5eae46e4840d2a227a0974d29e4d88d6e1517706693a8f981025d', 74, 2, NULL, '[\"*\"]', 0, '2019-04-09 03:57:55', '2019-04-09 03:57:55', '2020-04-09 04:27:55'),
('7dbb4a1524b3594e5d918b99a9d75642f3a56ae0d99371798d5d50d99456d41887dbda417c5d3f1e', 88, 2, NULL, '[\"*\"]', 0, '2019-04-17 22:25:35', '2019-04-17 22:25:35', '2020-04-17 22:55:35'),
('806c284b3ef612eab5fa4b680ce92dac8f70fb1f12f9cf105676de845cc98b33195d85ec880e07f3', 76, 2, NULL, '[\"*\"]', 0, '2019-02-19 15:14:38', '2019-02-19 15:14:38', '2020-02-19 15:44:38'),
('8143a691a1321f64cb845fa77b6f018de0c55b998c0e928c124319df6f66f9560ac0fe416e94b132', 78, 2, NULL, '[\"*\"]', 0, '2019-04-18 17:02:48', '2019-04-18 17:02:48', '2020-04-18 17:32:48'),
('827a62eecb0cd73febb3ca9ed4b9f248398c661ccf6a7290b40c129f50bb235fd632a29e7f36993e', 88, 2, NULL, '[\"*\"]', 0, '2019-04-22 09:07:33', '2019-04-22 09:07:33', '2020-04-22 09:37:33'),
('82f78ccebb758baa74b13b754d680132d7a35e35f39d790645754e1d62b37f6e119a255082a9a67d', 71, 2, NULL, '[\"*\"]', 0, '2019-06-25 01:45:47', '2019-06-25 01:45:47', '2020-06-25 02:15:47'),
('83f5da6f47e3a64a1e6a63e4becd9426baf704bd5535e39c77e0fe3f71e7ca7efe6a471811dd895d', 88, 2, NULL, '[\"*\"]', 0, '2019-07-08 11:20:13', '2019-07-08 11:20:13', '2020-07-08 11:50:13'),
('873bcaff4a7d296b519925b92d7947ea6a89864f7b5569562ce4382aef2eaff394dc6e73d22e617c', 72, 2, NULL, '[\"*\"]', 0, '2019-02-14 05:59:56', '2019-02-14 05:59:56', '2020-02-14 06:29:56'),
('87fed81df3e37976f6f82c4f322de008e8739ef6a66a6f3dc456101e4aceb8962d72294289b55295', 72, 2, NULL, '[\"*\"]', 0, '2019-04-10 01:16:22', '2019-04-10 01:16:22', '2020-04-10 01:46:22'),
('8871cdbe805059cb2aebc2865d2f3f23e571e2b6f461c16cd7f660eaad7f87993300bb5983d40c69', 88, 2, NULL, '[\"*\"]', 0, '2019-04-18 11:49:11', '2019-04-18 11:49:11', '2020-04-18 12:19:11'),
('8b244fec3e1c3242ef0a340f98e184d191da90e6e841cd8dc1082ca4e797864d6f7edfba7c49ab65', 78, 2, NULL, '[\"*\"]', 0, '2019-04-11 20:41:46', '2019-04-11 20:41:46', '2020-04-11 21:11:46'),
('8b5dd97909b8a529c33fa73e5d760c741cb0682a0680ca66a412a0f8a3d706da4f0e33d63b7f7f08', 69, 2, NULL, '[\"*\"]', 0, '2019-04-10 06:29:14', '2019-04-10 06:29:14', '2020-04-10 06:59:14'),
('8cf44e5f4ab196429b2caa096e27406452f796e4c3f9394a3751df4d0adc9ffa8f71c83ed43cb953', 88, 2, NULL, '[\"*\"]', 0, '2019-05-15 12:18:54', '2019-05-15 12:18:54', '2020-05-15 12:48:54'),
('8efd196ff4a218829263c61ec15bc2c5ebeebb72ee18407e2d093c9b672d01888da2e4d4a252f9f9', 69, 2, NULL, '[\"*\"]', 0, '2019-02-14 05:48:30', '2019-02-14 05:48:30', '2020-02-14 06:18:30'),
('8fad8df3e66558a322a59bdadcfbdef5cfdab1fc8700c754b728834591566210dbfcd1dd3f9edbfa', 88, 2, NULL, '[\"*\"]', 0, '2019-05-03 21:01:39', '2019-05-03 21:01:39', '2020-05-03 21:31:39'),
('8fe14a12079b19f21adc7eddddfd60801760e39d91f9c9a530daea8adfe326fa083dfad4d41ae4da', 88, 2, NULL, '[\"*\"]', 0, '2019-05-15 12:19:43', '2019-05-15 12:19:43', '2020-05-15 12:49:43'),
('91ad3b04b6536d5ede032b3db5a066b58378fbfe3429889bd87cb5b1ce855e0ccca7a423f26a388f', 74, 2, NULL, '[\"*\"]', 0, '2019-04-10 05:11:14', '2019-04-10 05:11:14', '2020-04-10 05:41:14'),
('92c0746adbdc1d83441e17acda0131c9a586114fd7e6ed95fb6edace9f890d112b82189d7b72b255', 72, 2, NULL, '[\"*\"]', 0, '2019-06-25 01:54:42', '2019-06-25 01:54:42', '2020-06-25 02:24:42'),
('93fb33cf8cf6725511ccb6994374c696df546d0da0b06341f0234d2e00196df4b309bd6a7de3e143', 71, 2, NULL, '[\"*\"]', 0, '2019-02-28 03:29:27', '2019-02-28 03:29:27', '2020-02-28 03:59:27'),
('943c274a94554c5ab6d9b3f9272bb829ac2cf2d37f67540657c1f3c77c7515d4c23a16a807b7ae17', 74, 2, NULL, '[\"*\"]', 0, '2019-03-12 23:20:47', '2019-03-12 23:20:47', '2020-03-12 23:50:47'),
('99cbd55df260916e4ed35c448ef3604c4937dd1ec3fb869bd3ae0998a4ffd9d2f2a51d91d13486c2', 71, 2, NULL, '[\"*\"]', 0, '2019-02-14 05:57:53', '2019-02-14 05:57:53', '2020-02-14 06:27:53'),
('99daceb4688beb8b568176fe92329a97809bd9f165ea05c43118d819951c804303c366c228bbe73f', 72, 2, NULL, '[\"*\"]', 0, '2019-06-25 01:56:23', '2019-06-25 01:56:23', '2020-06-25 02:26:23'),
('9a96763d02022802db78ad5378e9aa15bcd38a9a39360a66fb8fa39b158ac16815476deb903430f3', 78, 2, NULL, '[\"*\"]', 0, '2019-03-08 13:17:11', '2019-03-08 13:17:11', '2020-03-08 13:47:11'),
('9b84733815a171f7208ccc623c42a235a985f4f0a09a1bd3b64462879494da4e68def5b107e58239', 2, 2, NULL, '[\"*\"]', 0, '2019-11-06 21:42:04', '2019-11-06 21:42:04', '2020-11-06 22:12:04'),
('9c8fcd7b9822dddfc43456222d380e3b3e11e1483b5bffb66504b4fd4177a024582813f7fb5bd5af', 69, 2, NULL, '[\"*\"]', 0, '2019-02-14 05:50:45', '2019-02-14 05:50:45', '2020-02-14 06:20:45'),
('a165997dbc2efe22389de04aad5949fd41f9ae5b46693456c24a8554dd085ce645d97a8bdb16d86d', 88, 2, NULL, '[\"*\"]', 0, '2019-05-16 12:48:52', '2019-05-16 12:48:52', '2020-05-16 13:18:52'),
('a29f2a5dbf8f9e8928b190d01fe123f06bf2814772fb68ccaa3034d8270e42b4e53625d96dac92e0', 89, 2, NULL, '[\"*\"]', 0, '2019-04-29 08:14:23', '2019-04-29 08:14:23', '2020-04-29 08:44:23'),
('a2fb7b564ddd26b1490bc6d9328e2656a819698e242d82093257f532b392e9777460c53afc087d65', 78, 2, NULL, '[\"*\"]', 0, '2019-04-11 07:03:37', '2019-04-11 07:03:37', '2020-04-11 07:33:37'),
('a33494f720529a449259626c8751c674e63e74f3c20a563cbebd8fb31eaba94185f1ea1ee8aed64e', 87, 2, NULL, '[\"*\"]', 0, '2019-04-18 17:02:41', '2019-04-18 17:02:41', '2020-04-18 17:32:41'),
('a4017b22d4188435e7549a954a9b7935cf405c71f197beee7daa77b56f729c08ebccee9a91c88e6f', 78, 2, NULL, '[\"*\"]', 0, '2019-04-16 19:26:41', '2019-04-16 19:26:41', '2020-04-16 19:56:41'),
('a5308c49dc9915ac31e4275df4e358697f98f7cfb52906a2082633e8a80f803d211431685833d90c', 73, 2, NULL, '[\"*\"]', 0, '2019-03-08 14:15:32', '2019-03-08 14:15:32', '2020-03-08 14:45:32'),
('a6d5cc07d5b3614381f9d8987168b28f668b6607b678942bbfd93ee2822d524c92e69de48be6f275', 88, 2, NULL, '[\"*\"]', 0, '2019-06-04 10:07:15', '2019-06-04 10:07:15', '2020-06-04 10:37:15'),
('a7c12affe006442f10f56cab99acac87b0a2c50f0cf089f50db1c01f72f40141c7e18c45e33e8f4d', 88, 2, NULL, '[\"*\"]', 0, '2019-04-30 14:21:49', '2019-04-30 14:21:49', '2020-04-30 14:51:49'),
('a84a897eeffbaff1168b2cab1b69f2e4c95112d7ebe1a55c6ebfc1d637c3385a14943f21641ab6fa', 71, 2, NULL, '[\"*\"]', 0, '2019-02-20 22:18:21', '2019-02-20 22:18:21', '2020-02-20 22:48:21'),
('a85bbc5dab9341ce5fff264c51c7ab41a5bbdecb443f02fa2184dd4a4d2d0f672caed1e9d4cf9e8e', 69, 2, NULL, '[\"*\"]', 0, '2019-07-20 13:26:34', '2019-07-20 13:26:34', '2020-07-20 13:56:34'),
('a9d8981b36181ee1bcbe911e0c39198b3055918fd5a328e5668b3fce1aeb12bd2e1729bea2a90595', 2, 2, NULL, '[\"*\"]', 0, '2019-11-11 10:11:17', '2019-11-11 10:11:17', '2020-11-11 10:41:17'),
('ab7b075196a6fc5fe509a29e007e1899b2566e639ac3a10db714ae4f1b9d5c91e402a9ba7be50107', 3, 2, NULL, '[\"*\"]', 0, '2019-11-13 11:36:22', '2019-11-13 11:36:22', '2020-11-13 12:06:22'),
('abb558d91078987a7c9d884d505564281d7065fee9b74072aba1c275d0a03c29d102fcf8b7034cf0', 88, 2, NULL, '[\"*\"]', 0, '2019-05-24 14:04:34', '2019-05-24 14:04:34', '2020-05-24 14:34:34'),
('adecb95b138c9d1d67642dc0176fe288f7f2e2aacb335874757fd41d5a1dc4c04d292bcc535552f6', 71, 2, NULL, '[\"*\"]', 0, '2019-04-10 01:33:12', '2019-04-10 01:33:12', '2020-04-10 02:03:12'),
('ae9f9b49fe21e319ad2c538d3f675a229c4ae8299c919f256a7a43c02b39ed40b01938eb5d4c0a07', 71, 2, NULL, '[\"*\"]', 0, '2019-05-28 00:30:29', '2019-05-28 00:30:29', '2020-05-28 01:00:29'),
('afb6c9ffa2ad500a9ef72c9035535aef7eb9221478078bbf1972eaa4a58830b218b08417d2a30799', 90, 2, NULL, '[\"*\"]', 0, '2019-06-07 13:24:07', '2019-06-07 13:24:07', '2020-06-07 13:54:07'),
('b38617011e3ce8a68fe14f95dec765513800e1ea1a6afcdfd1e71609321e4d22558b4ce18ab25422', 71, 2, NULL, '[\"*\"]', 0, '2019-05-20 04:50:29', '2019-05-20 04:50:29', '2020-05-20 05:20:29'),
('b3f3ffe6d3896c890dd1171fc2a86068803822c054ca09cddf5efa7def56a6b2d4d22efeabb674cf', 72, 2, NULL, '[\"*\"]', 0, '2019-02-14 06:24:23', '2019-02-14 06:24:23', '2020-02-14 06:54:23'),
('b68087897f173ca001dbf27dc0387cd2332ebb26e400ba66c13abc3247c206df6a59f03d18c7bfbd', 73, 2, NULL, '[\"*\"]', 0, '2019-02-22 16:04:41', '2019-02-22 16:04:41', '2020-02-22 16:34:41'),
('b6f0e4b1fdf7f05fb76d7f5364931d5545523fe34f06f151735429c89a86f4ffea6012a97165f639', 70, 2, NULL, '[\"*\"]', 0, '2019-06-25 13:53:05', '2019-06-25 13:53:05', '2020-06-25 14:23:05'),
('b7a4752208657c68ace3565ce0a1fe4947c3f4458349f97761a050acaf81fcc27a11a8e8b81e7bd2', 80, 2, NULL, '[\"*\"]', 0, '2019-04-11 21:04:23', '2019-04-11 21:04:23', '2020-04-11 21:34:23'),
('bd8bba2059c63db451e91f2e1062cbabb8278c1e3abd63de7cb1e62b65d1d4dbe89703e25a7bd5f9', 88, 2, NULL, '[\"*\"]', 0, '2019-05-22 09:56:19', '2019-05-22 09:56:19', '2020-05-22 10:26:19'),
('bd9bd42f060720bdb7624db2b767af8e49eb44209a52b3bdbb1e8dcd3eec5e8e60186bec010f3fbb', 88, 2, NULL, '[\"*\"]', 0, '2019-07-24 09:57:44', '2019-07-24 09:57:44', '2020-07-24 10:27:44'),
('be34cf6271a62ef7145631d71ef28ac2ba899877cc98102fdeda93f4c6cd18ed01677f5d5dc6812d', 71, 2, NULL, '[\"*\"]', 0, '2019-04-10 06:17:45', '2019-04-10 06:17:45', '2020-04-10 06:47:45'),
('c2d51814df2e03df8b1396b5cb5f9e2198c516977373045aa8fb9b6551f7fe30dbfbd47740c01418', 3, 2, NULL, '[\"*\"]', 0, '2019-11-06 20:50:12', '2019-11-06 20:50:12', '2020-11-06 21:20:12'),
('c3927a561c0fe06760e87806fb11eba9390e6c1b9e3e1eb0e138f969d85c3f7fb9525f2db8a1cc9e', 78, 2, NULL, '[\"*\"]', 0, '2019-04-09 03:56:25', '2019-04-09 03:56:25', '2020-04-09 04:26:25'),
('c399248448629912767ea7ffcce8f57d33bf2c8567585291d5b733bbb10cdc3c6f8c8cdacd84e670', 90, 2, NULL, '[\"*\"]', 0, '2019-06-03 11:29:54', '2019-06-03 11:29:54', '2020-06-03 11:59:54'),
('c3e19154b849ce8483a2b3e96f43c3c360ebae8d69f5f0c313f0dd8b1093110f971fd96b51251a0b', 72, 2, NULL, '[\"*\"]', 0, '2019-02-14 05:59:14', '2019-02-14 05:59:14', '2020-02-14 06:29:14'),
('c3ecb193e378b75a2f8d3b48a9087cb6a243920096fa7560949820de9bf1b7880e04df8de3d4be5c', 71, 2, NULL, '[\"*\"]', 0, '2019-06-25 01:49:47', '2019-06-25 01:49:47', '2020-06-25 02:19:47'),
('c53f2aac46afa0e6eac13ca1fa67d970e142dc264d09bcb432d9237ddd23b1eeb8f3652918b64ba8', 88, 2, NULL, '[\"*\"]', 0, '2019-05-15 10:53:20', '2019-05-15 10:53:20', '2020-05-15 11:23:20'),
('c6f2f346bd8b899b87e1545f14bf63b8994fade4a2338e4c12e9164541d956670931efc6f5823843', 85, 2, NULL, '[\"*\"]', 0, '2019-03-08 10:38:55', '2019-03-08 10:38:55', '2020-03-08 11:08:55'),
('c7923aae64caa87046ea1ab77a4b94a9ff381342af6f809027c44cb7583cc59051b3224921cf5967', 88, 2, NULL, '[\"*\"]', 0, '2019-05-24 10:03:20', '2019-05-24 10:03:20', '2020-05-24 10:33:20'),
('ca827952403a06e52b572fad11fde1c7219f391472f807381583f5c56ec141e40b481eb7f20e1c10', 86, 2, NULL, '[\"*\"]', 0, '2019-04-11 12:30:07', '2019-04-11 12:30:07', '2020-04-11 13:00:07'),
('ca86592355f6514a5a212ad9c2f2ac7d7d6b140e808dc58ecea39d98a89151c7b10bee2eacd385af', 88, 2, NULL, '[\"*\"]', 0, '2019-05-16 21:55:13', '2019-05-16 21:55:13', '2020-05-16 22:25:13'),
('cc89c2e19dc11d4e9a682bcbbef28bf87b8bdd4f8611a8250908b8398cf12c22b1e39ce64da7d6c5', 89, 2, NULL, '[\"*\"]', 0, '2019-04-24 04:42:03', '2019-04-24 04:42:03', '2020-04-24 05:12:03'),
('ccd89d5efef93349054ce70495c675455aca49b6c25d0c646f4aeea5626f9659baf27c976c371dbf', 70, 2, NULL, '[\"*\"]', 0, '2019-02-14 22:24:32', '2019-02-14 22:24:32', '2020-02-14 22:54:32'),
('cdff4a75884ffc88d3ee929971771ed626c2b94da5910103372e67e1728029a7bfe3a8468b551e4b', 88, 2, NULL, '[\"*\"]', 0, '2019-05-16 09:56:50', '2019-05-16 09:56:50', '2020-05-16 10:26:50'),
('ce63db3440f76910b7d8c0a8f5b6eaa5ed2f7a757eac88fadb021bfd1b5972d00cee41ec14e9db0c', 73, 2, NULL, '[\"*\"]', 0, '2019-02-19 15:03:14', '2019-02-19 15:03:14', '2020-02-19 15:33:14'),
('cf3397ded97e40389c0e00f25ed13ba750e123a29ae210154a8884d6bca7095824fcf4a64f2c4f22', 88, 2, NULL, '[\"*\"]', 0, '2019-04-15 09:35:09', '2019-04-15 09:35:09', '2020-04-15 10:05:09'),
('d10ad1f4118bddabb8644491107e076978def94e7e2a1e5d00c7d69054d2fd21d1f766aa2f53536c', 88, 2, NULL, '[\"*\"]', 0, '2019-05-16 22:08:03', '2019-05-16 22:08:03', '2020-05-16 22:38:03'),
('d17ef8a5f9eada49903cbb011ce2248b033d76ecba2c4d55eb4b07bd93e8fefb828893c09d9ef203', 74, 2, NULL, '[\"*\"]', 0, '2019-03-12 23:30:34', '2019-03-12 23:30:34', '2020-03-13 00:00:34'),
('d198b6a8508163b349dae799519673f8f89c0567de725bd8b71e6de96b4684befa48c507ca6ef915', 72, 2, NULL, '[\"*\"]', 0, '2019-02-14 06:28:58', '2019-02-14 06:28:58', '2020-02-14 06:58:58'),
('d26f6ae8c71734a4e4338a616d4a6d36a9ef0edf54200f41be2b175d16df2e999f1cff6b9864f520', 72, 2, NULL, '[\"*\"]', 0, '2019-04-10 00:29:49', '2019-04-10 00:29:49', '2020-04-10 00:59:49'),
('d3bc5e4f4350335c29ac8c8a73684ce12043f51a5bf1fa266a60ed83b2973e25a85423844c163673', 88, 2, NULL, '[\"*\"]', 0, '2019-05-16 21:17:36', '2019-05-16 21:17:36', '2020-05-16 21:47:36'),
('d439b39a462bb8b595d73fc314b4de0d0594381307edd88ba068719b3a40b585cbc40d35b398da1d', 88, 2, NULL, '[\"*\"]', 0, '2019-05-29 10:30:46', '2019-05-29 10:30:46', '2020-05-29 11:00:46'),
('d5579be968dedf9ddeaae86c8ac884c92011f700be63e10df8693f326821c43bf0851c87562a0bbf', 77, 2, NULL, '[\"*\"]', 0, '2019-06-28 11:41:56', '2019-06-28 11:41:56', '2020-06-28 12:11:56'),
('d5e7e2af264a5418924b66db15da1bc09268a5980a2b791cb31a6ef16e39c9a8b00997e26348c226', 72, 2, NULL, '[\"*\"]', 0, '2019-04-10 01:13:24', '2019-04-10 01:13:24', '2020-04-10 01:43:24'),
('d98355e6535a517e1fe8373ee0f30fde88a13df2cc3625c288c8028a47f2a2e675d24f4f2ee6f180', 69, 2, NULL, '[\"*\"]', 0, '2019-05-28 00:29:15', '2019-05-28 00:29:15', '2020-05-28 00:59:15'),
('d9f3ca0eae1a6d0e1379e526187d38c09a5568836fb0ac233ccdb8d854fe6727910bc94b33fb0b22', 70, 2, NULL, '[\"*\"]', 0, '2019-03-08 02:31:27', '2019-03-08 02:31:27', '2020-03-08 03:01:27'),
('dd9ef26e56f55f468b0734f795a379f0521c4fd3cc32e90346653065ab585a5e18dbcb97b8550849', 71, 2, NULL, '[\"*\"]', 0, '2019-02-14 22:26:18', '2019-02-14 22:26:18', '2020-02-14 22:56:18'),
('de2f29cbd47daee8cc83a74bbb470e76f55b05ed39689bed19c50e32db62fb83327a06110233207c', 88, 2, NULL, '[\"*\"]', 0, '2019-05-24 10:04:38', '2019-05-24 10:04:38', '2020-05-24 10:34:38'),
('e0f46564cca44c2eb3d8313db6eb40e964316891984854e456013e8630fab44f661b31550567ee1b', 71, 2, NULL, '[\"*\"]', 0, '2019-06-25 01:26:58', '2019-06-25 01:26:58', '2020-06-25 01:56:58'),
('e129434e7c9beb30c9b2ce1beaffb3a04172edabafa4e42865f03492d33722d4e12b7751c7533fd0', 88, 2, NULL, '[\"*\"]', 0, '2019-07-22 08:13:23', '2019-07-22 08:13:23', '2020-07-22 08:43:23'),
('e14ad3aa2a2233a276a4ab546f222f24284bc0fa1a35f736f3f3f1a256dcef7f416be844b0ccef9f', 2, 2, NULL, '[\"*\"]', 0, '2019-11-06 20:39:20', '2019-11-06 20:39:20', '2020-11-06 21:09:20'),
('e1a1f20a36420a0072077e53bbd0946c8c7287358032e430c9916b40ba51d98c0b54b9b4298463d4', 91, 2, NULL, '[\"*\"]', 0, '2019-06-07 10:43:44', '2019-06-07 10:43:44', '2020-06-07 11:13:44'),
('e2aceaac667e0b037e82a487f9e5a32db72f881cc406fee0e896cbcbdc629118bf860c8ef3ea6e51', 88, 2, NULL, '[\"*\"]', 0, '2019-05-15 11:07:22', '2019-05-15 11:07:22', '2020-05-15 11:37:22'),
('e32b52df1831aa17465185add468bc437de8abfd8376411c70d065099ffb6fdba2e9242e3b4cea8d', 72, 2, NULL, '[\"*\"]', 0, '2019-04-10 01:17:25', '2019-04-10 01:17:25', '2020-04-10 01:47:25'),
('e67e16f05b70fc6967e90346c0e923cb08d7aa86bcec7b799ed7173387e8b42b3e27bf19f1d6ae45', 74, 2, NULL, '[\"*\"]', 0, '2019-03-20 19:13:51', '2019-03-20 19:13:51', '2020-03-20 19:43:51'),
('e8ea3f043edd6955e956c0f6284bb25da9c83578d36a158b3a7c447ca35b385515c22148aa24aa74', 76, 2, NULL, '[\"*\"]', 0, '2019-03-12 23:26:56', '2019-03-12 23:26:56', '2020-03-12 23:56:56'),
('ebc7525353bcda6d022127691f5a941015a261150999941ac5875556a69a847705ef42e7c538b977', 88, 2, NULL, '[\"*\"]', 0, '2019-07-24 11:22:12', '2019-07-24 11:22:12', '2020-07-24 11:52:12'),
('ee793b84048c53766dbf432610b1d5b4d236f3a7ccaf6419d2e1914d3b30057df6ed94a2a216236e', 76, 2, NULL, '[\"*\"]', 0, '2019-03-20 23:11:48', '2019-03-20 23:11:48', '2020-03-20 23:41:48'),
('eed9eeeb6b9d44c7a9d4f0bff8382920e60f72671eed8cc765a4ea903877b24cccbd805a6043e334', 2, 2, NULL, '[\"*\"]', 0, '2019-11-06 21:22:11', '2019-11-06 21:22:11', '2020-11-06 21:52:11'),
('eeed87f699186ab60a576c405ca6c7fb30785ba5995a6d2e7330be04ba5ecce8c104a75961036358', 88, 2, NULL, '[\"*\"]', 0, '2019-04-17 10:16:10', '2019-04-17 10:16:10', '2020-04-17 10:46:10'),
('f0cd6379f57434437d1b00892acb8585f74bae593deda9c08dd91e4145cbc6ad59a9d3c17e6766ef', 90, 2, NULL, '[\"*\"]', 0, '2019-06-03 11:32:08', '2019-06-03 11:32:08', '2020-06-03 12:02:08'),
('f114eff8310500fae7444f1b4a700a87e11bfd8b56413c33ea5375d4711a0befd29f766114b9627d', 88, 2, NULL, '[\"*\"]', 0, '2019-04-30 11:26:38', '2019-04-30 11:26:38', '2020-04-30 11:56:38'),
('f171e781669e198846e40f6d18e66d68a654f9a7a8ed997677456142a9535f92149831acd36ff7c5', 73, 2, NULL, '[\"*\"]', 0, '2019-06-13 12:06:21', '2019-06-13 12:06:21', '2020-06-13 12:36:21'),
('f2c1478772ab2678630497b1408b1ef561602128941bdb61b74eb04ae5ccdedb1a4ab8dff98ee36b', 88, 2, NULL, '[\"*\"]', 0, '2019-05-22 13:50:25', '2019-05-22 13:50:25', '2020-05-22 14:20:25'),
('f4ac89440555cb834b79b07fda118ee5ef3d9d44cc1710ce3d603ffc9aba2ab065f61dda1ba28c23', 69, 2, NULL, '[\"*\"]', 0, '2019-07-20 13:35:59', '2019-07-20 13:35:59', '2020-07-20 14:05:59'),
('f4c407f5dea2d679e41ab6e80feb4a87e80c1a4ce10a6a766d4df26c79e20972a8236df794d8db53', 78, 2, NULL, '[\"*\"]', 0, '2019-04-10 05:08:39', '2019-04-10 05:08:39', '2020-04-10 05:38:39'),
('f5e9818d79b889ca9c42127f4f56c9bd22499cdb8fd43ea3acae866af54b7bf1a03db987656cd4f2', 71, 2, NULL, '[\"*\"]', 0, '2019-04-11 02:07:48', '2019-04-11 02:07:48', '2020-04-11 02:37:48'),
('f9b31b7d02c4bcabed5017acfc05b59fc94e6f395e2bb79524dd1302c3a9e93f56d9f8299d463fe6', 76, 2, NULL, '[\"*\"]', 0, '2019-03-01 12:20:20', '2019-03-01 12:20:20', '2020-03-01 12:50:20'),
('f9b3468532209b4f0e36fc4e3142d14f05df7178e711fe198a79ff46fe6b766afd19d4a52aef75c0', 88, 2, NULL, '[\"*\"]', 0, '2019-06-04 13:46:16', '2019-06-04 13:46:16', '2020-06-04 14:16:16'),
('fa4d7126e6f52e1b160a2f9b8cc83a1a6813f06e9b84f2d2372dac76db3254c9df98f32f9ee5f16f', 76, 2, NULL, '[\"*\"]', 0, '2019-03-20 23:14:32', '2019-03-20 23:14:32', '2020-03-20 23:44:32'),
('faf320856ccc8cf420a99c4fc82bbd0b3dc922728af1f224f6acb5b5fe2023b1b429f09691bba779', 69, 2, NULL, '[\"*\"]', 0, '2019-02-14 06:12:10', '2019-02-14 06:12:10', '2020-02-14 06:42:10'),
('fb47a1f0bdd030d53ffd91345a3b015bd50523cafde30d6af2f69f4521ec54d5bf1ed092ac4af8c8', 74, 2, NULL, '[\"*\"]', 0, '2019-03-01 14:27:48', '2019-03-01 14:27:48', '2020-03-01 14:57:48'),
('fbf879e5f8d7ca2fdf8bb16cbebf9ae3bd8a4df914e621b0bf3466321864dea56e4171d988716b16', 89, 2, NULL, '[\"*\"]', 0, '2019-04-26 13:34:54', '2019-04-26 13:34:54', '2020-04-26 14:04:54'),
('fd5728f4c605a186631fbb4f9eac47855f1214f96cb9aebc339f01a8c88466c47a560eb0a6c3ae5f', 69, 2, NULL, '[\"*\"]', 0, '2019-02-28 03:53:39', '2019-02-28 03:53:39', '2020-02-28 04:23:39'),
('fdf91e69198ba900c00afe81840e9c8940ba6d519ea370a2230bcb1c7c70cbb1be368a5cdc8ae155', 70, 2, NULL, '[\"*\"]', 0, '2019-02-15 08:49:01', '2019-02-15 08:49:01', '2020-02-15 09:19:01'),
('feac52f8814baa305ec7ce02bee59d809b590c1afbd09f68d593dc986906e86adb4951c0a223eb68', 88, 2, NULL, '[\"*\"]', 0, '2019-07-08 10:00:06', '2019-07-08 10:00:06', '2020-07-08 10:30:06'),
('ff13ed3d30c2e77bd47dd054a3bcd4fd861d913d66c665d7a5bdd4cc78a029b35f1d4beb798a13fb', 88, 2, NULL, '[\"*\"]', 0, '2019-05-08 15:22:33', '2019-05-08 15:22:33', '2020-05-08 15:52:33');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(1, NULL, 'Laravel Personal Access Client', 'iLEkg2tioh2Zlq2oUypsd29ZhVobiLWzRksEb3Qp', 'http://localhost', 1, 0, 0, '2017-10-30 00:18:48', '2017-10-30 00:18:48'),
(2, NULL, 'Laravel Password Grant Client', 'VmLLE7OlJSAM9fYpBpFZtpMaatkKgs7dEGb2l3lG', 'http://localhost', 0, 1, 0, '2017-10-30 00:18:49', '2017-10-30 00:18:49'),
(3, NULL, 'live', 'TgUoLaMTJHJjB8EnHu7tiZ5plh9PpoeFqKBmyF5P', 'http://localhost', 0, 1, 0, '2018-05-04 02:39:21', '2018-05-04 02:39:21');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2017-10-30 00:18:49', '2017-10-30 00:18:49');

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

--
-- Dumping data for table `oauth_refresh_tokens`
--

INSERT INTO `oauth_refresh_tokens` (`id`, `access_token_id`, `revoked`, `expires_at`) VALUES
('00108f0ad0c86222a1f16a8e8019bcfa6c7d8828cdf33d9dc8db5945ea40501ff0192a43be7ac1e5', '37ed284b7e6665a7e3cbd827aaffcc1e3fad533bc20ded4f49cc57977284ddb8a788d506ef0eadfb', 0, '2019-10-11 09:31:45'),
('00442726e49dbdef4b1c827ac39b81700813500ea7e6025afa2e97de685c01c884e7181e095acfaf', 'da390f0e336ef120e838e3a799493040c82dcb664e1d416bbc2c9fdbf3f02bb7bc31802f46911ab7', 0, '2019-02-07 12:32:42'),
('0052fee2166528990662d5d8a41ffd3207e43dc3d7c28d72944a76cf1b57847c47369a90b71599ae', '4720ad47a362062c522c5b0bc29ebcb72430ec6b88c5b60216e3ba4afae889d1fdbdcfbc44a2fb7c', 0, '2019-04-18 12:55:08'),
('0053be400b5a999a8f904760790737f47c0f485cdb8789e5016b7f351bde9620d6640b0bbe88b6b1', 'c2763e1ff19945447f308eda6e896b049d7631d487e61c879c750e844fb720e10ac31ca0e633f83a', 0, '2019-07-23 09:26:10'),
('00679175dfc7789d53d350a25f60e9df47bdc7d47cabe5683e7aeeffa19d1ff949202c1d9b68ffa8', 'e5b0a1164a2ee25221940d3b852437cb76590bb65196ce3e50af5ab7cc3c76537651d2a8d74c8a3b', 0, '2019-05-31 07:14:29'),
('00808361aa75096fb7d910bf8c81941366044cc219fe983fac17f42a4d8ea328ab3d7dd730578615', '1529f38ea243f259a07fbcb6e78ef16a581e7b45be9f2b76369b201dbc21f696730ddb3e11d6ae3c', 0, '2019-02-07 13:57:46'),
('00a2fc04351d904a1cc62904949a3714e31196eb4da61ddc6ba7b150d1fe5531e5f6ec19b0bb69b2', '2ff1a3bfc424f0ae3b0bc72214217201740e6e42187863adbbd4cff5911e9c35774c7c6a00e2269c', 0, '2019-05-14 09:34:56'),
('00a90c1f97149e2681f52b4b4054dd29a85a2f5f9a53c7f764687a2d6ae9b216cae8ea86c9705a50', '59740b044b737dc1c09d2ae5902cf2e0064343b9531fbf8fe50104394254521ab06c024031981400', 0, '2019-04-10 04:25:52'),
('00d99c9134764e71e131ec1406874607a55aed0ddced4748e635f9acfcb3c14e60464d9d2534487f', '1cc368cd1aa8802978fafe19a3443f8504f3220446acb05c79a0026f6b5e9ee221468563f62660ce', 0, '2020-02-11 07:04:59'),
('00e2e445a3415b760d6eb434c52cb3f727020eb060d5405ec3447c53b129256851adee4eabccbc65', '12daf5dfd36c77803670600ca4d178f7f1b3c2337c2de519fc12a43e32ab476dc538ec151b42b5ea', 0, '2019-04-24 06:34:01'),
('00e6146f42d31adbf491d8eb6c7222f9c091b5187968a3c362684aa2026cb1e237072d9151075a44', 'ca86592355f6514a5a212ad9c2f2ac7d7d6b140e808dc58ecea39d98a89151c7b10bee2eacd385af', 0, '2020-05-16 22:25:13'),
('010095679794e9f7868b988251a127e0bb36b257f4aa6ab8004d917fd522f967a4c77f1476446862', '13fe0a0dff03de9bc9e9ef90eb09509e75e8cd8a2ff5f5ae815bd82199de0ab911794bded59b7615', 0, '2019-02-06 10:51:51'),
('0104b2271a4cd5c4df58f3dd8a3f2025878c5f8f74962ecd706c3ffd3917b750ef04dba04f6f4648', 'd4c1653aa2ecf05743def17cc0168c66b23b793e45419e6f4257d1edd54c988c5e4961c9ef73052e', 0, '2019-02-09 15:11:55'),
('012aee3599914066a566891c3e0299e31c174c7b5feec4751b34f3847b2afefb4a8f67aeeaf71185', 'eb4078b20f0a793eeb1b45a5092453557a2d98dc4281b057470bdafa14b40bff708ab580696f3a00', 0, '2019-02-08 10:12:03'),
('014e12f4ed761066ea31ca5591c61a79e37395b3c3d23e97d29e96bd2e65230d73d288ce37d45950', '1915ec3bfd512f5b4c6960c349d6b21ffacefcb4fdf23c2c49b67937c49e2d7f5f3907a118e412eb', 0, '2019-05-19 15:45:45'),
('0182ffda4a885c879447e00da6601273d89de07156dc654f320a49906aeecb963203d21219bd36bc', '7d28e0f69ee81203d96bc638a5a74143e8d3a686fb8afcda97e28d152da6d89f20a1bcea954450fb', 0, '2020-02-13 05:42:58'),
('018f33ea441e5e7c8f0d8db066db6dfeaac651d167a379444c285602d21b9d26acb681241f73e06e', 'e8b8ea2c8dec9cd24c9bc449c66ae678c77f7875b5b530a5da5de0e01650a9312602da286cec0b25', 0, '2019-05-17 14:19:59'),
('01d8ed84d201f7335d2e89e0673e2c3077dd5387488757eea8a478d3596a653851dccd4f57bb4346', 'd3f318d417bb473a9f196b91c14b8c7d69cf9c2479c0e7109bdc43a07d8259a5c166214ca9d2175f', 0, '2019-04-24 11:08:01'),
('0229137aa543b8269a209172c61e5b8d126d1f684a919c11b63e756a75c850c895026d6d5943de8a', '18c40bd64e00d7fd01a9f6783ef3982bb3d9b371e7b7a9f8a3f8f93ca3bf9e887c12aff643eb7186', 0, '2019-10-05 08:51:16'),
('02dddc9b80753e39abf87331e12ce6b0e4c18853bae730af0fa641822845ee2b62bb97bf1f234712', '30ce17a09cf228761ee11a275a818ce244ce42877e733b8a0f184575298243e8b54a40f5d439c6bf', 0, '2020-05-15 13:11:03'),
('02e2adf99ba8af96fc015502d9f36e41e83b48cc2fa6bf5e16f1deb2e85172528643dbfc0b05e945', '549e393f56a02a52b3ecd613e4330f682d895aec4b082be729c2de4e7c4466db8f5fb6dca30a19ea', 0, '2019-03-27 04:45:26'),
('03362b259b8c0d2b371afaa61efec3bb7b30a5760ec4248c74defd5ef712b9b0328e0bc5d9736691', 'bad9b853c0f841cb3a10c2f04d9de46eab7e3b344f19142d23eedac068cce288866b793b1b9936dc', 0, '2019-05-09 06:37:44'),
('0343d0010aad8931944b8353192151269485b6e144a96c1e038cfac1b173d734df2c9e68b34d8be7', 'd75bda8eb7b1bf4e67450c01ac90eaa1c933669ee1f329ed94730ec56538f9444ae12c021bd4459b', 0, '2019-05-04 08:42:40'),
('03805003f923bbdf7b12b73d3895bb7d2e5d4e04300f89bb71f23cd1ff6dfe0b510fff30f36223c0', 'b2f37a0dd581779d085d6106833e1d211fed1b654fbac0cf3b99b0ff2a3f78e2679c13d4fd450a64', 0, '2019-04-18 13:37:34'),
('03a4d6122c9164ae637ab3882ad920586a368006a17e28869ea749e6457bc9e96976dbc8115def65', 'b7f134fd9900039d25cd6ced9f57d5f35138e411f03fab5334615c0b31f322c390cb8a5fa80fe259', 0, '2019-10-09 18:28:54'),
('03a8aa6dbc59c8babef48aa16c2f18635470948cd368de1ec57f0d95274f30f575ac9a82775a881c', 'b3f3ffe6d3896c890dd1171fc2a86068803822c054ca09cddf5efa7def56a6b2d4d22efeabb674cf', 0, '2020-02-14 06:54:23'),
('03acca8cf8f9a9461455092ec9d9b24af05db47afc54489d021c765386451e26003353e4869201c3', '63a9f3ec2d435a2bcb3520c419e36cbdc0fb6deb6bc19d267336151e4515440a0660300d7f66916f', 0, '2019-02-08 11:08:25'),
('03c3063439176587ab8d447b585e0e4c78706e9ebb2cd3ba39d4b7f81642357910e56e390ca1d8b9', '5b9bbe32892672297923a4b3713cd76d772fcc6b5405bd8403af1267749b9c91f0e30522d883b9ad', 0, '2019-07-25 02:28:04'),
('03d6e78129e90bf58f167a33d274a55a786e6a7d8aac01d60dfb427cd0cc9cfbf221289ea767e27e', 'd0a1d6d9243f550f46b681449c063f5700476cbb57793ac57f114af2bcde6c7bc90205555ba8c8fb', 0, '2019-02-13 04:59:50'),
('040e15d160235f4bdc6db9e14c4701540bc5ea6977499ebe3e5453492d0a9ec3ad9eb064d26c2457', 'dcf438ecf34774a0f1d5f5fbf1465586e046dfa5356e49209df0c40692405a77c0615a68f8583de2', 0, '2019-03-27 04:41:17'),
('04104e286898c731261f764c8dadfd1acfebabbbe277bfd65f9a7359d08bb0820424fb91da118d24', 'f12b9fb9eafa3637a1f299a51a7de2c45bb1ffc6893aeb1abfa9b4f47d7bb64b28abb4a1027acaf9', 0, '2020-02-10 23:14:56'),
('042209dec80da6c66d7764338a455034c3e1970a8257cc1a19319149f3ba51fe0d48d68d78d0d793', '2d5096fafedd8bd69a50da2bb8abca5b9e75fed746277a63ab52e80f4b75622d49e5ae7332619ee5', 0, '2020-02-13 07:00:37'),
('04441956270fad0b063e897dc42f82a1d3fbc81d2827ef08784878971c8e32171a1b2450fef87c03', 'd8630f7388fe9ebc4c048caa676937d12297d597e6a219af3b61043cec4801dc13eef82e9353f8fa', 0, '2019-04-25 07:14:28'),
('0474d0f9273f543d77711f051615574395e6fc1f79490ca3e368db4d228b5efac82e6aaccbe6db3b', '6f34ed6afc879718381d2e7695b6d61446e8984f2a32b83291b5665f6eb0c6ad73fd3ac8991603e5', 0, '2019-10-11 07:50:25'),
('0477841dd1a7450b818deb71232cf3209e1c0c2ba65ef9daeb4c1ee3210b21c904cbc4387b476305', 'f7d8550e052455355e0381b27dbf929ffd1e4d33f81bff0d8970d668331f45bd5e6beaf82b0fd267', 0, '2019-10-09 05:45:39'),
('047b9467f26537f6e3c2a974d3cb9b3f907b3c027dd7e4a32f70e8d63e905e8e4db6292320223184', '01e803462acbe4b6bcf5a27ef98c511f0b0b125cfa6357972c1f492ad540059a7f248b4de24c7b37', 0, '2019-12-07 09:48:59'),
('047d6ce16755d56ec995e708bd4a00aaac4e6471a34e8a7bf71e58eea66d459159927532d97aa62f', '6ea050fb2258ef470919e9576fa0b55e6b346acd326790b1339c67fb3102d4fc1a7977d9f2101949', 0, '2019-10-02 00:18:50'),
('0490f1211fd53517eb3a7a178f2546092e73b3cf73614a8a261a492e7fd6806e6e44cc752fcaf8f8', '2528161c4ad3abdf2bae34ba0f8e455d5beaf0fd9e421fa45d85807adcc71738623119eddbbfd225', 0, '2019-02-08 06:25:04'),
('04b75336aec58d75620556f712bded28574e48570672d98cc8872900a74513a99f3b3ce926f452a3', 'd2787b2dc0692b8ac61939c183848add534041ffe05183856b7f16348588cf24c5cb314917198aa6', 0, '2019-04-12 05:56:43'),
('04c8f9776aa16201250482ad4d78ee1c432b86375b74c75fc5469895fa9219657e782f9be21a9c72', 'd67d91c45f042310f9ec5b3cfec3c4add7588be774675b6da548672b255de3c2997aba96b009988b', 0, '2019-04-02 09:31:28'),
('04f4db6e76e9a21a73b9f8fc1bb620b2d88590d052755c6442cde6ea3fb9961ac3a8f20224e1cf33', 'ec626599cff811fdee09ed2bfb866b759abdb4c422c2d210d19507cfd41ca7997dbf1e7027bbefe3', 0, '2019-07-26 09:59:18'),
('05072f237e0f521400afc4c68aa94d67a2ea4e5458380f969b49388465fc1ce42b2da4495246beb7', '5da417af8539157ee1717265752e3169e7aeb15f396467de448fdae348adb55ee096039e95cf7c04', 0, '2019-10-11 23:53:53'),
('050d4530cc72087c1fae0135d1f8dbf4eff3c45b26337724667bca19e0416a61af2ee0e0ee38bb70', 'bca838449b4a371bac73eb110c358d7f3b7faa5f0db23ad73505b89fe214010ebf2f47695bdc3cc4', 0, '2019-05-31 12:32:20'),
('05102a9c0e29766282c5a76f4dac9b9595c98ccb39c82142ebd63451f83f0ec9fe8795cf75a885a8', '131fad5db2d4e4e2ef0334bf3f83615cf9013bf3d990eab550e09bf3ee476fee8ebdc51be6155e12', 0, '2019-02-13 09:02:22'),
('0510edad94b8787c72ca53471ff71af8329837879564639b762625e587134fc10e3eb606b1c04a37', '75abfead68ee6939751a5304477bc626b5a77e67b86e378328be8ad85a0c3a274ac933cb2f7a7142', 0, '2019-08-10 22:17:52'),
('0516a4bd26a14660c6b9c08f18f8bf2d0b0b7a8deeab2234c473303f70996a636a318aa99eb575d6', '4b8c1cbb1d37ec1544d19f3c9ec32f231a575b3b7a02e3d024990283c8f7ac45cd78b104814aba4d', 0, '2019-07-24 08:48:57'),
('051e03cfbd144978b8de6342c65c37e9739b8606b69c55841ae8cdae401f79d488465fb1fa5f0697', 'b7989513690c83debfe807fc9483ec8ac70139a62fea192587b7cb4dc9d0fa592ce4fa126bf1668e', 0, '2019-03-29 08:05:49'),
('05969f1243ced7afb3620b476cc20ce3be598ce3eedf71b8ca683bdfe046bd74674b75e85d4c8b3f', 'a14157b96176ddaf8c6f79e2bd6e69361b2b7668d989746100be12cecc3196f55b7044356aa979ed', 0, '2019-05-23 06:28:36'),
('0597676ad013185dd258f0ba7b2ec0a81362045c441d62246df78038106affdab57b1dcc4c5c2797', 'defcdc5f94f16608027b6155b2718e2e75816ab98df3c4722c687dd104eea4b98f7626518b2977c5', 0, '2019-02-08 13:00:49'),
('05bfc6278500805b9141fce27c905a255911dcc442a68bc1ba0f5150139ca8e4c4cca508355df286', '54b4d2a2f517ace5b276274d32b8db88ac38bc932921d7a60b66a28f3fe09f5ee7ac1ec3e64a7802', 0, '2019-02-07 09:13:58'),
('05ccca54272a0cf0bf532b611facdcff894a1722e2adf2781c8f4b9ec88352f2e830a8c99bf811b2', '28b1f4112a9bb5b8f674bf6d695d1a560de33ab36a86179879a0c42504ab646f906eab75af83e398', 0, '2019-07-24 00:39:01'),
('05f109d7b83698048f5d1faaa2847da6053b270aad9acd3d53059050a86a25b92926f76763d292be', 'f4c407f5dea2d679e41ab6e80feb4a87e80c1a4ce10a6a766d4df26c79e20972a8236df794d8db53', 0, '2020-04-10 05:38:39'),
('05f3ce184c32a5e0e97629a4ba29f7e17f41960e0f2f0d9bc5452e73d81e3c04298af67de1af644f', '22c5d85b5a9c62910568d81b6ef6f9562da988557bb3f056af809be5110a334100d821523e1dbdf2', 0, '2019-10-02 07:02:14'),
('060cbd07159bb3d5d8b08a04dee8390fee60047ec75e6e13ab87e059a0f6296b4359a55dff362521', 'a903c59a2bf4b6e6ec646b0e1d5815c8854d8db90495661408cd85804108e16b52710760098b5633', 0, '2019-07-16 20:28:35'),
('0632a99748ddd08a24ae4be8a93b03a6ad4529540c097e58276954ab98339577305a2bba92db0314', '45edd474191e220098cf97f755fd901257e7f63f3e2e6f4a8323c605c7fe021e4a20dca7ddd3d58f', 0, '2019-03-16 10:11:18'),
('0634b6fe5e2217b95ddda9ac93b886048c834fad04c935ac8100ead5747697a5129f80fcf538d74d', '4ad4bbf5700f3e7fcb21f778e78096bf78343bdb85de539ae0d63f664062b85dc421d5780d34073e', 0, '2019-05-21 16:57:47'),
('063fc2e3fd4640142a8b3b74c7ac2eb209c263c40c4386a02e189e6c28d31c1f93502218c5fcf206', '494a38fa3d7bddabc605b6c7ee192f78b6e4eadd20233d9a7b3ba787a4c54681397e6fe6b707483b', 0, '2019-04-24 10:22:50'),
('06613396e5d8c7e4244866e4ce29faf68bedadd9a06d8079cb62f2943ede37001cfcb7ea4ca2dc3e', 'a4654c8e588073cc636caea8032d5c36a32181b27db868b98253da49d3b73733d395e14dff8a8b53', 0, '2019-05-09 06:42:30'),
('06bab9d6c830f1a8e799e58beaad0a48761b88b37a879f6291be7f3348d4fdaeff03cd041b2b212f', 'b50184c72529fb1280f195b4ee7f4ce3c6c7f3354002739c02e57e6de83d57142d62e7c02b7a35f0', 0, '2019-03-16 08:21:08'),
('07005e569517915a51ec6bf0c1dd362447661b78b1a91d679a3ef81759c5851b2be62c7ebc97825e', '2a4526858343337031c5d01f704c6bd4a03f10ce01bcd82b3f7dc843c8a90ff35b8fb1f341fa8d21', 0, '2019-04-25 07:08:23'),
('07369f63a2f273001e27b1d75319093f471fd52d562af57f56cd9b2c6cd0f7cb7717166f2bb43f77', '5fc8e845ca07aa4810181e3ebeaf869fda4687671756d078dae9845edbbb0ee11432b9426a61aa4f', 0, '2020-02-11 00:06:17'),
('07423123fe1f09bd8f2cc1e9b49df96f4fb6f49e0a722aa8d52f9748a8dc32bf79095e9db871bac5', 'c8378fd9a8a6a1537b74fb7d20c9c07a32afa68272edb6f44f395ee0f2330b48237f0a49f6760822', 0, '2019-02-09 13:37:33'),
('0753e61772ccdebc67e40c925b961832333f6bcf2e0d4ef286610bd4a70f7e655f3af9c15ea547d3', '592e2f9fe703d60b17cbe1199f89aadded5c3636e5b508d1294a2d47273b84c5296e879dceb399f4', 0, '2019-07-24 09:38:11'),
('0795ea00cb47412fa48c51e73764d87752c15311118b196ea0e6c1527a4ec205b0421e7250413812', '8d4148d599a06a7412b9399b9d3580402200c0042637e9d6354cbe3dd361e9a3b0cee349ea4264bf', 0, '2019-07-24 09:49:15'),
('079dab1a60ac12b4adf6a78a0646ecb07d328aa7f9dcd20641feaf944fe9cf018aa93d6920ac5a0c', 'be34cf6271a62ef7145631d71ef28ac2ba899877cc98102fdeda93f4c6cd18ed01677f5d5dc6812d', 0, '2020-04-10 06:47:45'),
('07b3fc9282e9791554e02a4986aa36ac7ff8faae10fac6370640aa150befc346db0ef0e229ebedbc', 'a14043c41be1a297a2d66489cfd0af19a033fe86cb23e8d2b737d362bf3531df0aee2f35d21dfc32', 0, '2019-10-18 17:33:17'),
('07e692e0e9180376b209d74c37d09ca9153d8640fcdc0669aaf3caea582d5e74816bf8d525a0e7b4', 'f15468744912dddbb7ddb30a16bd8430a221d155e1c728f675d590fadb8ca6b68397ceeebc72f9a5', 0, '2019-04-27 10:50:28'),
('07f707ef890a314ed8ef0bea5b1ca8dc613be2bf2c7a4c7fef67427453f7c20f7e0b701f4eaf6e47', '1731bd0f67a3b5aff31d3920d837cf14f32959295a40cd717dc914b1241440af23beee09227d0177', 0, '2019-09-28 02:18:00'),
('07fa9f4c863e4c93a887b28afa5813181b5c41fb307240939745faa21d9f4a8af38cba2635848ac9', 'd7274d2e75d24d3946da02fc82d8d01e7e03ea127de4e92d9c0127642f8eafbb9648e38519e9523b', 0, '2019-10-09 21:03:01'),
('08019c5f421128340246eae480a13645eeb48bb10bcc5487a1fd8a2ced85eb5e74d5066200d49215', '323e1d2323e7b4ecd96734599a6373e655ee4a50be0c7c347dccba5322d2ef8160d0a47a83d3c53a', 0, '2019-12-19 01:45:55'),
('08061079c2204f4a77d1a927ca29b355c718ba6e98c2e3d130499acf211adbcb7c6eff59cd654ee7', '40c6e143e2c9ba328136dadb78c78ac89b32d8d02364b09f46431d920e74131f05819b472676125e', 0, '2019-10-10 16:24:08'),
('08126ea03e0338f4f229e61d41df32fa7541d4b36a27ff033c2fc0c62e5a9fcec065a40767e84e63', '19e9fb88bab5878165612f4ecefcd4aa9f47ef2d727c3530bd2cf90d946187401e14de25dd54fbbf', 0, '2019-06-12 14:25:54'),
('0830dfaf815de6905785037155c43fa219f9fb05712c56f4f1bca88972267fd419f7ffa00e94a5d1', 'e950d8f6d3a33b14a7f4de845d055cf5c270703ff8d5699f1477741edfc1d176bf1bd104b0fc06b6', 0, '2020-02-13 00:26:57'),
('088c451392eeb6fb1614f7fc68faf1129188553118b7379361caf2d75f39899d651520fa5241c7c8', '9bdcfc2a1977564461ace7b87723b038a64f5244c7babdc8c9a6c2c4d632f5303eee15f3b3df9953', 0, '2019-10-10 05:54:01'),
('08c6a2a8dcc12592f2a3d02ce00793cce2eca24d72fc6a55519261d6213aa2307d49ce13ece06b97', '2c4f7832dcf1f61d37ea61e2419bc7b2255509e2d542297cd85a139bf8a9f23e0a2d2a865dd43c3f', 0, '2019-10-24 23:04:37'),
('08cad3a5418cd0ecfad6b1684dcb7fe308ed1e63afea37cb7669d98696f15bce350c07eee933b74c', 'ac1c7e0642e03ed17dd14312f94c0c79c51fbe03b8434b9b91483e146abcaff71f084d9c1959a6b7', 0, '2019-05-04 10:15:36'),
('0909b3f1fbdc55605e9d77604561f5d5faf8672f0c4e4767303735027dbda6a652366c71ec833412', '391dffc7913f55d1441059e530685e97a062d3d76311d5f0ef4b0f8e200a3a8703bd4be3093a2648', 0, '2020-02-04 23:33:44'),
('092a5ffa5d33d3385b9721de976d4fcde69f1845c0c86d2a141b3d1ed05e7a6549b41b3398d72ce3', '70b50a35aba2cfea1ccdc80a78fbd6421f4d2036b2005a90d9ca655169e27c7cf29faf0dfa8a98d0', 0, '2019-02-08 10:30:35'),
('0936036558d590d6c28674c001b8d1c7bbec023f2345b2ebff1ec5fc0d12d53ff8f5a1fd98e8741e', '188318cd0a528772b792c354384fb2fe54f11c32545bab7c1dd1a905e51c6a6700ba9553bda6a0cc', 0, '2019-10-11 04:25:07'),
('095089533406f36b18582cf8803fedecb080fcb9234b4833465748dae0e78c78ecbdfcf98bc04e68', '58484a555651e51c3f3ccf414b498d39e05c18b38770e553fb6a02d52b29959bb929399a76784903', 0, '2019-02-07 05:11:25'),
('095cdd676c56bf84b5c00c49dded0d871a93746ed9342436eb0ffd70bf7a2d78f6f8e9a78df17979', 'fb6e83c4754dfb1e4a5417f43d1e940bd1af913447093d7710ca16756d1ea672e1c3ec1fca4ceb78', 0, '2020-01-11 06:27:34'),
('096d6ad7f1652351d03a86a9bbe44c77cccf6474597ebfd7c5767665aae145596070ebcadc47619f', 'e6c397e6dd6cbfa6b869582f6a06127c0f5c9873f3af3b08a444daf2fe7ecc16c5f34029bd384994', 0, '2019-05-31 07:29:48'),
('09b47023f1df0b0aaa0b7c0bfd1308e86e171281baf7c566a4bb80e74b594d3fab44e6dd121b83bc', 'b9a2d7d8757fa758479814cc696b63d3c2f4fc1d8e08c0dbe7fbe054e88d0d4fb936d9329458b64b', 0, '2019-06-12 14:31:14'),
('09d1a87a54a788bd7562fadb3b491bb791a884def604f52c74f7054e1cd8082235847f547f78c450', '27d13f3bf661e52d3f1cf3642831f962b4c91be01d89f6ab7dedc81cbd1f01dc047fe63aa3bb1d81', 0, '2019-02-06 07:07:05'),
('09fce9441d17113221b4b3938415032d9a230129ede671bf54ffb831e98e6c37eef0a8eee9c3b2fb', '866ecfbfdb8ed2c4c0a478a001242b4db8e339e738e55c74067b7d0cca937fd0535f38c0a830441d', 0, '2019-11-28 14:28:10'),
('0a095ea2f5ce589f8fccb5da341d024fb737dfae8b1970adb1e59b4695a4aaaa155906d155602308', '5386d23242b6f99a880038ee0b30285051a8408f730b6823a7679d7bded90b8be4fcaa3fa009293b', 0, '2019-05-03 10:43:59'),
('0a350ca870bfdd087b26bf4e8d4dc78ef8e3f8bbf66e51402c11936cb3f61943d78a55cf8cd2f355', 'ca12ceb18e975c4d4e1c5ab368a3822bff5dca343782ecb9986605f8b3cfded7dc9073ef1a6ca5a2', 0, '2019-04-19 06:41:38'),
('0a48dbedbb737baa13c1f953ba5846f236f6ad23b356e9d2878125efac586443a18477ff483bd008', 'c92a5369548661a6c4678c8a38f89011e712a09de3ca07eb0d9f8823a66690a0e453cc3568d6ce74', 0, '2019-03-22 10:39:43'),
('0a652cec6a6b5730d6fbe3dcb37c0589e27803e47434ec9011b3dcf8df65fe1aa870c6ad592d2f13', '54d779101f83c71a58dff7f639e8868339e12bd86e3bcfc64c6cdd52529d8792fea22fca66f53907', 0, '2020-04-10 05:43:44'),
('0a863e43d4d1b12d0865a55185a4794d295103198e0914b3adc3e1f7158327645b8809911b7318ff', 'f3bbaa731dfbf94311ceeefcd00962f494c770bd2ad02b6541fcf1923171111c817e74366f4f84ca', 0, '2019-02-12 12:32:25'),
('0a8802cecd188c001f27508487db1cb1f8ac247f0bf48f74df8fd22a26d10b1ebca3449a6dc91d45', 'b81c517480aca1979843d183cfc229d1f849bd922c95b130418ddcaae1a19d4ae1525a0cfe13b1cb', 0, '2019-10-12 23:05:19'),
('0a8fc2392d08c757b4ec0b7448667f6b999084f0955a6eaf9ad8b862bae8459dbc2108dd54e4bf74', '7062a97f34ff9f1fceed0875f67ff46c3750aa0ec0085b31e879be99bce44053c19721dfcb72e3cb', 0, '2020-02-05 01:05:44'),
('0aa1fecc8d828b00df4b43972bfa09b84cc38ead5918978e39e82524be30426773485149b35a098d', '2c3bc935766e92a970456f13bdce06f4379d55c2599170b02bb30f097363cc61fb293c1e9f71c59b', 0, '2020-07-17 21:22:16'),
('0ab3459416952a1fb4d512dd635bd9b21f37d53785d8ce5d8f4696c2396cb957a99736fbff4ec6c2', '434969b58108d80a4b98a35d7333ef2aba459e84ff31865d4bd483639383cf4c6b7a7e1e03ccfa39', 0, '2019-02-09 13:18:48'),
('0ac3bac8b56cd54a76f54507cecc0b866ebf22d95cd388840d1efff289ea2335d76da7385511620c', 'c8fc6da05776ac9e21b19ea08bcb1ea961b9abdbf76419267fee6de63f9d20736d8b771a8ba33ab9', 0, '2019-02-08 06:24:23'),
('0afdac5ebcb2170f926e9bb30f59dcb908ed41a4144f58c2728ba8a4526b95838bb4be84d279320a', 'a7dddff67e6482d9ea1fedaac95e5f0a28345984c298f9da7a9a9c63a8ad36dbee1aef8133128dc4', 0, '2019-02-16 12:20:46'),
('0aff5c578b906e3e415cc0c22374531443603506fbe94691e1bb2526f8fae94eb506a467894c1984', '877e0702a586cff52310593bb38e92028fb6e765104edeb88f0adebc17228c124d42a1a4a3a78033', 0, '2019-05-14 09:32:06'),
('0b0f9457bacb353b2fe7eec6db283e67e0477b90c6d9918bcc2435367dcf31e37c0b43998766e968', '4fa3d120bdf02c9ad69f619b44c0e3f4b3a5a85d57533696bf436ada4794715b7d47280c50aaaebc', 0, '2020-07-16 10:42:48'),
('0b0fb5520c48beb9191999e371a037a50b89716471ba833640509168b132eadf605d5f9d143fe36b', '2e2713f9318150fb8fcf0e243bb49609c72cdf4bc53cead95dc01ba3d34c7136b74ea58de4bea46e', 0, '2019-07-19 07:20:16'),
('0b3bc412fe373fb755e02d8f30b3108deda8de8f7bd445b48e977257a505536822693cecb990f394', 'f9b3468532209b4f0e36fc4e3142d14f05df7178e711fe198a79ff46fe6b766afd19d4a52aef75c0', 0, '2020-06-04 14:16:16'),
('0b453180e1d5234eb6ea29d2aeaa679ed05f47bc2588c3fabf18168e18ed6e8efcf6dd109e595676', 'e5c354b6215dca4d6983208f50e9e274e57e99bb10e1c8069fcd308f911dbd478ff0891cac1b45a9', 0, '2020-02-11 08:38:57'),
('0b50da3c17d2f8198276cd679cafe261751552017da5913a46095f9de133b042e33753a981c72609', '6d668df3f4f38516c27dcf8d39fd30f7ce88229277c0929ff47dfa371c22b5631b0e7f496713dd4a', 0, '2019-04-05 12:07:42'),
('0bb252b48662c464324892b7fa780b1da2cbd9fb454cc232784d1433cc82435da3c248a694c190d0', '7a7f3f03f9343c4cdee6095a4a1d6983ed34ddd66d91359c8ee3790afc8431e2da1dc54e55988c57', 0, '2019-07-24 09:37:57'),
('0be9ade9a92caa9efe33d2505bb76f5b1c0873a6eb4f2008d5e65ced1562f6e132895e60796b3659', '5b46296c44af1fa92c5b984005e51211c5bb286a25d2c5638e4202a19087a708da6632a379d6cb8a', 0, '2019-12-06 05:09:46'),
('0bf5bf408aa73b122f8b55e52a3138bf3e600185ae8f6f8867fc1685c6c21be4a6362ef02ea9f0ab', '3991d949d619e23fedb03b386cd7f7ebbe98d384b4994e7af5e22db7e285193e6a6fb3ee21b83620', 0, '2019-12-15 13:31:20'),
('0c55f34560e423f393b33f45da7cfe8d446fc9af554de31bfb646b42ff0fde232d2e30d553ea775e', '4db2db64bd0f0fe56e50b4b56669d557919f14f5c5863bdb36f7c41a6f9345892376849f9ed13353', 0, '2019-10-11 07:39:21'),
('0c88e786e28d428e70084f0309e6ed8d491c3659fcbbdfba30639635a64300e6ab6a75802e67ef06', 'eeed87f699186ab60a576c405ca6c7fb30785ba5995a6d2e7330be04ba5ecce8c104a75961036358', 0, '2020-04-17 10:46:10'),
('0c91edf940eb88448b644b3d4ee2c0528ff25aeb07a3903217fb567b34064e0ad0f0e3f5a0138fd7', '483a69fe4f1e0f1a63fe5001349be43902f0ab163f3975823f524be12312880adf12b672932f834d', 0, '2019-02-13 06:45:17'),
('0c922ed2fab280b42af791e3b84e6b7fa32bfcedcc3c385164ec3169867d1c05f64ba34a8adc1cd8', '9c213eac4190f788e4b4bad44b0e9de707cfdcb1c51394f68cdcb82fc3c2a6bda7f189fc51c33768', 0, '2020-02-13 00:27:35'),
('0cd5fc879aff8183a10c6272da54f4b9107a4d26ca3eee3737c5904f583a68a0cbac8cebd2c0bcea', '25367d814a462a6c41fff2b7ebcb56c02b82ce39da2303c4b1e9f0fe232e06403598c2fe97641607', 0, '2019-11-29 12:18:57'),
('0cf143cbefc8340bc7a32cb096c55fbf377c71330ee47357992ad02497fc98597d5b307a215c5574', 'e0d1db915cf99e434dafbd136454987190de25187703b82d58158aea1f1987f506a502f335c7b8e2', 0, '2019-03-30 06:04:23'),
('0cf26c8346a61984ab4183b14458511e559df3882c6e9ab15ba360677b35e3a51c78a00f3308179a', '8a289141133470d3958bd20d6faf71fc524e3b372477eed111cfdf0162cfcc654d3c4be0b9d663fb', 0, '2020-02-06 01:01:15'),
('0d2cf40b3730e3728aed5d5048db09531f9883705df6748cb6a38d03a1195c348bd0dab3af8584c5', 'd593cb0af5773fafc95ce1524ae7be25c0b7fb820b052e7f90062a03c13097a5ef274fdfdbdbe046', 0, '2019-05-14 09:10:42'),
('0d6cd2e232890af83d32aa1b59c5acde48c633623eba2675453dbe4e0cd7cdd42d2e62deb299e7eb', '938c492af0875e0e562413b24c8039e4a62bbc51aa8b808612d7c02fda8f56a7584950d45ed1d9b6', 0, '2019-05-16 07:28:39'),
('0d8a3f9f7f7d5744937aaeff33e32f485e12980103cd4b74b9b25b7bdf620a4653b0720aa5caf853', '3474742966fe32c2e189d982a8e407cff94aeef1d1eca54ea0e7356307287f5abe45941a5d1146f6', 0, '2019-02-13 07:06:43'),
('0da13dcc9191fe85dbf823d9de2dbff93b309a68ef2dd8834ea365ee2b069b5781a2a1371349bbd8', '00d16a1f48ca737bcec8d533f23c5334fc1a8addd0708d79e3bffbeada527bdf59864760b67340e8', 0, '2019-03-28 06:57:30'),
('0dab846da3a47c92b334aa4903f3765f493aec2dff8baa08f3bb7e9b8b47d848666743bcc0336efa', '956714953e9b548e5129290cc84c8bfe43f49c2989fe382512c59e6192dbbb015c51ef6aba9bae4b', 0, '2019-11-27 09:36:53'),
('0db762d0463d1b3f5f6f3deb1426bab302b0edb1be9494aa7a2269665a4ce278c06bdb60d7c42aa6', '3645b65fbb9008ef0ad9983e097302860b034ca68fc9ca208d15d0820f694e02f2dd70132f70aef1', 0, '2019-05-14 09:11:35'),
('0ded68ce5774851af7e05e14b7ab6fbe3f4e4c061af52f34a83e00ba803d114e9e42709446808955', 'e43b3a7b0cb3c16632352a48a30ef92c19e67dcaae1c5727b94b163dae9b837744ee96915c9b34c6', 0, '2019-02-07 12:10:47'),
('0e0925cdbf7c6f9c201607c030fbf948b27571b20b4d79d865453c64bb19efd3debc6b8c164f5f62', '0677463fa8bcbc7b928bb6138d65c1901cb3e70ffde9a01d66b2435bf6882e1106df8e5b49f546d1', 0, '2019-04-27 10:36:55'),
('0e3e7d44853f2f629d2f6fc2c7a1cb47d764ed9e9d62c33d06e34fde002a223096980737888ae08f', 'f5e4743a649c910390b66739474ccbadd7f55214bb45de49d31c80c663de877b5791349cf51852d0', 0, '2019-05-08 18:23:33'),
('0e6952528e17da277666a158798c2d65470a6b703f55a68091da41caabdf83334292af8d8070fa3d', 'e169d4d3871d642c2838563d3434e19fb028dae309c98b46ef8e680b05bad696d86d3657df67a608', 0, '2019-07-26 16:28:33'),
('0eb83d6fe864ac86503e110f26f6f89cef087b2edf524f9a63e69f362a38352caf0be496f2baad02', '45ece8f61e4996fc8f18678b40afa917c7e9ab819d5f14d05363560e66d5f1f8202ad26a3104f19b', 0, '2019-02-09 14:29:54'),
('0f09b4649be955c0d1c02695292a2f7e6f3dc24d23f3eba2e857277c79b5c1f35e7250b7ed808dd3', '84861e2d54d6e64e5a20e2b3399b405682a073d8ee4d20a5707dbc96955fe9738f77a7652ec8f139', 0, '2019-12-20 03:21:59'),
('0f346d15bdd7ce65fd0a182836089dcfc2efc51f696936f6ce808f1084b572cd82ddf5c21c503fdb', 'a995974e18bad04540e30388582db8e77e87b4154ca1d6a26bcc7556ebd75b431e6e81ba66c9e0d8', 0, '2019-02-08 09:22:41'),
('0f3fb0bb9bea1275ab78fe115cc67e2da55432c5667cd4d204a52883e9ac690051871f13297f65e9', '24d60d77bd1169c0bdfebf05f5c3a11eaf232fb5c1f8b6a06369d8eca03fdae87812d5f0ac6ddfac', 0, '2020-02-28 04:28:41'),
('0f6ff1f31038f18ec69a808fba6624eb416e148f4b9c5509d343cb6930d35b1284746b8ea4efa76e', 'd8c9a8091b7d294d13a57d3c4230cf37d2ce7cf8eb86d483d6af4cad81b8d04f5fee4918a1cfe9dc', 0, '2019-03-22 06:33:47'),
('0f73404b3d37792ae8fda3c0b5bf64d5f6547c16c215bcb3c97274e22667f9f735c6cf9e89916bd6', '91bdf30b6523d6d14e369816288fb454f58ac8f7a5e0662e4c1e3afeb9c781a91b710fbdc9dd52f0', 0, '2019-05-09 03:58:09'),
('0f85e1c71b5480994488240d756ba44701a837da6a11a718fa70324812886795001e6a5ec0265378', '4595f30577773da38710293f7d9f01831c9c595e81b6f80ac1ec2d14748ca884a065962a1d5c44b6', 0, '2019-02-08 04:54:01'),
('0f9f1e3021b41da965267a5065924ea320c77d42e9a591e111519f2e3592fad31d4a49796bfa7264', '1789f537f16676187bba437a50490674e4f28d2fd8e75f9b0d5ee3510da1156309eb3eb6ed2ec5ff', 0, '2019-02-13 20:07:46'),
('0fb8e81bd1718d41495d599e199cb46a75633c51180dcd6d983c3a43a4551353a157f6fc69e5f94b', '58957a230367cd9d71bfd8980ef138a921f6406e37d48a59cb88b7bc6bc3a262ae7f6477585e68ad', 0, '2019-10-05 05:01:58'),
('0fb96ce9282e26b7dd9f7dc8ec2da917f30976bcdfb0c63a75e4fa48a31c56a7d53f4bfa1d480f9f', 'bda5ac842804a3516851f03d30490557dd5eccd579086e73358bedf7b56550b522de885c13aba6fc', 0, '2019-05-20 01:39:57'),
('0fbd77cd7a628e5378ba3a49fb69c29edfc10b6859c49800549544130e7232cb6cc9d392fb6c92e3', '3a5a7bd11b8faef91a7dc29c494e0f8cfbba53e32a3339e606c329de14741e753f01e61a22c94c47', 0, '2019-03-22 12:20:19'),
('0ff2edc1870e46e025c78e419d0fb3a9d44aacf53e6ce09552468a51b2b516e5d4f51de3bf209f6f', '1acf6e825f62d1b84ce227efe19c909225c18380d0b6995c3495363a7fe0e2ad805f7650f2f0403a', 0, '2020-11-14 11:05:59'),
('0ffd2e67eb16af1bcf125266735a5ab11ea90302740c9c533a5afac1749eed7eff82f8aacab4e8bd', 'a9d8981b36181ee1bcbe911e0c39198b3055918fd5a328e5668b3fce1aeb12bd2e1729bea2a90595', 0, '2020-11-11 10:41:17'),
('1015f8f9a3cb55c3cfb08d6389917f2d4b561c030bda078b73b045091d900c0e55e99ba0ae8d0040', '15af761bf2a97281f9314a0537180b6db2a75d4856e95a8aed44de9709e59b429bd20c650d909e77', 0, '2020-02-08 05:24:27'),
('10201bbb79aab1ea0b7a33cc76567a8e03d782c899672483b826836d3210d21be66ceb5a7a516a74', 'c53f2aac46afa0e6eac13ca1fa67d970e142dc264d09bcb432d9237ddd23b1eeb8f3652918b64ba8', 0, '2020-05-15 11:23:20'),
('102221a8b2e6cb3e7aacb31891c091db4d66f138ccecd2bfeceaa5a063280aa18be843181908d44b', '54ef3bee93546ba23f56eb3de2ae7ceb4f58ac26e9943bffbbe4bb4081cc040effee0bef5bb8ce22', 0, '2019-06-12 14:18:03'),
('1028f66e14663e040552a575a778d3a929342216a753fa1e82b7c384a647a64c5c6ea03005f4cc97', '4fa2c4455b446346efd5e622e63cf586f949775aa4973ee0dec3672f02c2d1947da16452c2cda3be', 0, '2019-02-06 10:19:21'),
('106f7618d532d46ca0dc34ba9713a9752b490c37e7293d9f43e5c3d8bf9bd129dae58f75dbad77ba', 'c118d35ad0c85322bc43927ed8c56528dc5ecb4faa54a8019e1d658807321119057e4db5fb52c67e', 0, '2019-10-08 09:56:32'),
('107f7ed55c92b50f9ec7f6f6b492703497f9a3396bad2e531e91710763d55f05be18a813cac223b7', '02e4e209dfb8f9824a3b23456a46f21af199601bbde0284f221a359de9dcfd25c8ef07e262a2097d', 0, '2019-07-24 02:39:20'),
('10d536ba8a468abc03c35980d888ebbf914e935010c7e7483237304815868c1d4d9834f42a36f065', 'a553084d61b3568bad1b5ebea78418b27f9a849dd90c32ef32141ad67e710b1b5d10530092ed4546', 0, '2019-02-08 04:50:05'),
('111bad00ea98815b5002427d07ad7767c0230adf2f1d18f005b5b57332185c926ab08bb1db735cc4', '9f10346b56fa6ddcc955589344afbfe9578d419046c4c0b2d42e1e3f2b855320031e6f332dfa924c', 0, '2019-03-23 08:47:08'),
('1157de75928040647eeee36754a7b913430f76ab84a50a71428ac8a561cd8e484ae756bd6ae92347', '1557300a5857e833da3da55bd7b1195eea8ac000e6f3e81c1a99498940e63e6f4aa2f415066bf20c', 0, '2019-10-03 09:14:38'),
('11733468e65b58860072a3c728c5a843f3cd9094b7bdae6417a459b24a8c2cd852644be4fab94b75', '8d7922aede34a44b5e00bf4b69508874dc7c29e6d39f917188020a6997c6bd1aba4e1d6d1dd3e2d7', 0, '2020-02-06 00:38:20'),
('117ae7a1caed1ab21e42a730c54f1f12c41c6388027e84ef5ecd79266142cc31b6a8633bcab33c99', '0799896383b360e30320e5409f44d0f2c338f94fd651771659df8355a7612a981be2ecf3e8daaa5e', 0, '2019-05-01 09:07:33'),
('11892fc6eae1ad2cb3af22a25003954c5817af22cdd92e5d8c6093932b592c7250d3e0b0b2a0cf23', '517a449818720a1217c1a255c1cef682761e1b55472f2e324cd869e953fff0a6098532f93ae498b5', 0, '2019-08-01 05:41:59'),
('11a2c2885012e9d5dbb851ffb1cf033358b0e570799175aa3a07e6f9451a4bdd8394fdc5536e8e4d', 'f9683a2298b82a87e3abce6c7f342d9be15a00f9eb998256376f1d3a66b1ae1b799f8385fb831ad9', 0, '2020-01-22 05:56:28'),
('11ad44bd1315fb3395e9d329771fd54a37b39be00819b29e403d263b248d9931ee8b5a1c65fdc15e', '0818d9c4daf913c77a476dbf4528b9220658b31f2c0150d20539daa545a6c6ec93572dd5ce40c646', 0, '2020-02-13 04:21:35'),
('11c03e1379a0f1c7843334ed01cb8b3f97a283f1f6e03fcc67e13605411f2b76dca6a06df0297fbe', '0be56ea49c4614f152b6e9038bdfdc39c4d5eae25eceff433c9abfc20b60ac63e7a34244954fc2df', 0, '2019-03-30 06:08:10'),
('11f5999d47d5665e33b232e97388e43d2bef053ea93efd7902a906b1664073cacf3203cafb36f441', '3761d2d2866db7ff2eed852c84a99a7fb7d57cf866820383d40cd02edc46822635625a7a2e80156f', 0, '2020-02-22 16:22:29'),
('1222aef5c0e15f87575a63dcbc219ab7a7dc8140712c2cdb640de480a8e0bbe44154740d6993e775', 'eaddeef4532e3cc6deedd067cb1e6e4e76ee1ce9091e37f20d27d48d95557454e63a3b93093b2847', 0, '2019-09-21 11:36:41'),
('122da7c7de1ab879476fe9b5918703f4cb3299b02231b1438e14f2a080bdbf4eff5b3e67ca32b194', 'd6b2f1690cd27c4aaeaaea199d2bb093a66b10040b0b8fa6f443f75bcbecd037c0a1766be5f8abfa', 0, '2019-10-09 08:05:16'),
('128a40b26953533e573e99a9b07b9ea1e890f33e9c1fd6fed6e5ee62909c978ef2bf351c86d118f4', '96d6a3c47a8695c4ee8498da86ff34198b5125f2f39964825c83cae46762a8782597cc3aff08df0c', 0, '2019-12-15 13:38:09'),
('129d53ac67b819a2da4ad0742c90d35c70970c8d26e13a2d1b85fa07ca93486fd9eb51b53b7e03a7', 'a842d36586c38bbf8131f6f89e13fc2cf737939746c56577afbb546a50514cd3d2326d1c074ff13f', 0, '2019-04-24 12:08:20'),
('12aca985c2d2553f2c499f6f1d2b58d7ec6faa504d62c88b4914b92955373a82a044da9b22e06dd0', 'f6de9b0da70341ceeaaceb2ee8c741c5536d26a045da3eb8ebc6d5f71c9fdf95384c22914ff8875d', 0, '2019-05-31 07:17:00'),
('12cc6c06f947b6b3d563e052a9b0dfecf44f6b46c4f1c889032e3e78b1b0bdae101a6b06df4943fc', 'd644ddc7aa48a6e7a58e9dc34dd287c72e2d225caa343f328a56daff79f163ebb208790509847797', 0, '2019-05-09 04:02:07'),
('12d200c21b576ee3093d5641534677fcc6a3d82a4007acf01528c14b687748c9a97bf194edfd7db0', 'a6d8edbf83ead21138684627982d0e2488719cb13ee39a01a4146d3ec54e2fec9d2a821194bc7d03', 0, '2019-12-20 03:20:06'),
('131de5f52b1d5f1a7419043102e7571ba8436a1a22b2b270551cdaf5e6926983588c464a5449f7ff', '490a057ef3fcd5a116bcd7df8e86b8ef20b750c51cacf79bd7b1e7e699eb490b6d2696b548677056', 0, '2019-02-12 12:36:24'),
('13a416bde4f7dad2fcaeb895c3588be3c0a9ac51694025a5e3cf7a9e95fe3808ecfb4a8d55d7cb53', 'cf275a1007cd90ab19563de641db74fdfbf8c75b554d4f1ea318835fb1d1b0a4cf91280ca86b18ad', 0, '2019-03-21 04:39:31'),
('13b150e82e3f7ba0d12eb2a4ee8683a14db07e8062208eda48ca9fca347291aee03428ff16767bb7', 'a5aa2233eec602364841813a8445a330b517007da548f2fe72c3f51d85cdfec13740ebcede566431', 0, '2019-12-18 23:25:10'),
('13c0d550aa84e4d5bf8a6eb27669691d5584208829d2b1d28003876576cd92d2f73e2e173ea2e89c', 'f5c5150a082e64d93d4822f11212f1c8b12ad14b29023831ddab1dba761a81cc364cfbf95d1f42fa', 0, '2019-06-12 07:37:02'),
('13db716db4b784eb91f21dcfbc8bd7a3e93cc88970a5d76f0a188959cae3a79e60014684430ebd0b', '46650b5fea9c8462a7507b2850b0266f2fbdc20bb663e76f221f49925d9937c272c298cb317fd8eb', 0, '2020-02-11 00:33:19'),
('14573dd1da63344f4dd970ca67aa005ce6d517180b1c4c79f9ac3669f0105e25d33e6d879f523972', 'd7da86bb16a27a3fc115b9589a1d982316f8e375d083c6b6995ac8fe5ffec2a807bed73710e288a8', 0, '2020-02-11 05:52:33'),
('14773a8de167cb481b6f6e51a6ad7a42b5ece4b15c4d1cf648919db2686154a819fac8a4c2b56a6c', '8d318baa734478356519a1403333df05b30b03997e11661a9cef1a09a81e6e80440952fbe68141e9', 0, '2019-10-13 03:07:36'),
('147a954ecc2d9120a8a4cbb7ef2bae3bfd9b147e2eb668e8aea7d12d03c00961373827d4da526df0', '072838fd05dc78564cfad665e7ca7485d3726242dcf91d4691b762c0d74844d87b82ea7a36e7c8e6', 0, '2019-11-06 11:16:24'),
('148771c5f4548f36218c3e59928c37afbefe98182f5d3535640b4db976e48d73569ffcbdb56f6b37', 'ddd8995138a9ded4ecad04750c42b4bdc50d690a48627ca62761ebf265f50a5a900db0ce96cdbf36', 0, '2019-04-25 05:31:02'),
('1499fb7d3aeb54c64474d083f5d57e193d2125955ec41037e2957a3e9aff57937ab11179521de1da', '15b7ac79bd3bbf399f4f6568a91dd664339a73bfa05315333ecb6bba52d66d15da5e0cfc38fe172b', 0, '2019-07-16 20:35:02'),
('14f3b9979b0aae234cba2e48e9f2bc6a1a82a32531a84c039825a1d8784b322982ed2274794dbed1', '52887e8feceaa7bda77475cdc842e4f33e09d003e9377043d910998edf34d34b3378f7d9f2b5cd8a', 0, '2019-05-01 06:14:40'),
('14f6cee2eb30cacdf5bcb66ba08d5cadc9b44a3dccc9d5c6f8ecf4714c5390da32f2fb8f89a0aee0', '40e83471eca7851e991bf52000b5077ee7c338995ad52ed0bc63c04a04a9fc10e4072926d0450a33', 0, '2020-02-07 01:49:22'),
('1575caf4d5ed0a9088ebddd520062832deb997bd83cc6f61d6897c16cd9961f79847c773113e8962', '5c6362f6c1686ca15d2fd0a3c4fa6fb7752d1bf58f0e7d3750e468ab157865f6ca31f470d6834b3f', 0, '2019-05-17 14:21:43'),
('1592ea3bd896c18858229bac8ae151644707034d86131095b2eaf566dbac49d83017d1545bd7ce39', 'bb704ada3369c8ab63b01ae928e6032a124eb54fb00d298f535c6c860d6f294cccdeb07893568a48', 0, '2020-02-11 06:08:21'),
('15a2c1f7ff3c459edd31661fbc7d595274ccd28b496e7d95aa34a58c98089418bac387c6b88f78d1', 'c250c21a98a91d40016ddfc45b42ddaeb86414ee709d5390c9d975c0b7265bdc1709e29d510026c1', 0, '2019-04-25 07:12:55'),
('1607a91df9d0eee8cecea206024f575bd8e68801d69e3dc7699f61d1be2e50228525d51f7ff2a50a', 'f81738c9c101ce52d9379027715986f029a42bfec2119b214b15d16fa8361125e8d5ba07924399c2', 0, '2019-05-16 07:55:11'),
('16158fdb341d07cfeafd811d9ab9e9017c86cc01c0303f4bb2ac95ba585ec052ac308399777144c3', '269d5274471ff163c5f13d851ff19ea30290254b337d1b6207a7e9dfa1e1c7c316138b092ecee191', 0, '2019-02-16 12:12:01'),
('16180c528920bc5aa71e37a2d1718889b93ff456534eb63aae5216e7cb81c5c7eae0435ed75e2989', '6cd839b3ee8a6f8753efc275cf1e13653a0361e0fa5380c2a81441f51c74c2dbf394ff477e448a0f', 0, '2019-04-09 04:18:42'),
('161e09b36045f5bf72f2563133de2f0c2d2e05ad172e545af37e9ebf3b057e0dad27726c31560a2c', '6c460f271f9316fc6f4f76e54a48f7d1f4b5f801dc66714b8354e6a32240d1c5b31f2d9d0fe152e4', 0, '2019-10-08 07:08:06'),
('1655ede027c063d21a5032b62eace0f943b53318c80ee36b8ff4fd4f9f1af97a649b5851e9e0f9dc', '2191aed7a8167b32eb6998eb9f56636b0f17409ad914b5ebb45b7fb0ce558e396c645f55fc5110c6', 0, '2019-05-09 06:31:11'),
('167e74f28961680c33d4c7ac04450cd0202577fc6bdd0c1da59c4b4cbb6f40533c2a79358c2019f3', 'c12953352292b105bbf74889a9669362f1f6a338fcc2f4e40631dabaece006df7b8832c8dda06cdc', 0, '2019-03-23 08:48:20'),
('16ab3422afb7733bd39e194b889017f8b960f90bf0aec659912379a6a7c8ec877da4452cef4d62be', '933f5bae5534496d5e72dbbee908d17ba7f248890390dba8bf70d510e6f9e9f68fa1f4679b043da0', 0, '2019-11-27 12:31:52'),
('16d3c2dffa70e1b539a21e715f0f341c27e9989a2553bd207b999092bfcf5c59d706a731084f1265', '7fbbec1061ce5ac7e697bd5c758ebcd88c5e930a78d730055bc3fb898e87c408243b14f37e921e23', 0, '2019-07-25 11:12:53'),
('16e0bdb3d097686887e69d3630cb1f586520342ed50820d1854fc2599d5106f85fa81995e0a3b944', '2e4c527a09c07642451c648d138acef0508361a5f9421d3f291fb568f3ce5fbe31621ac6b91902b0', 0, '2019-05-23 06:36:15'),
('16ec2cbb939db68a534a8a3f39015942d205f43912028b05588420d9f0af387eaca283ae2ebf0d49', 'df27770d7baf11ed65132a399a4125a0c8d505e8a7ec66ba8720c744cea206a3171ca1bb67d8c7ec', 0, '2019-03-22 04:31:28'),
('16f280b8b0fff2d1496d60c2888db2b59a1231ddf1ac3a75101849e0c3585106bed7db6e413455e4', '41479bb406a3f718595df6382d43f9118e7b5d3d8a9819dd3ae952e1d03931f2bb39aa7267c03ff4', 0, '2019-03-21 10:40:04'),
('16fa1d31faf29fbf891cc87adc1359d2003827df46391a54db5bd2793d3e7a1295e0f3b2261609ad', '4465bddeb03c6fc9e3347f309ef791125278a2a0b218d4a425682908793e919a4f6f6fc557ffb880', 0, '2019-02-14 05:18:51'),
('1713af583a1c82053f8db0fb7481af00a7ae7c669720e6ea12715ac9e989bbc9d5101e7c2ce8f638', '55c87baee64c737232bad003f626da6e0dd589b060fd8071edeab7433dc92e23a4f14711c04af18b', 0, '2020-02-05 01:02:37'),
('1749c13fe58356a5bca6aa542b180a25c969874969e4248428e4caa3dbf3e3b43c07719c97647388', 'bc577c4a2e638ebff4815e9bce63f1b817863f7fb5cd2fb4e0a6e0c2303ee5f4b6b782582e6fc139', 0, '2019-03-26 05:05:38'),
('174cb6f2b438014825e52310853767e4e698ee85664f21f8878548b6b2ac5f4c91a774edc9774679', '9e223798dcdc5e53453ecc47cff7fec6c5da97fed94a64ddefb5a56a0b267b598b7f8aed80ef893a', 0, '2019-02-13 17:23:32'),
('175a2833dc02892256ee8b2363fa7787f67dad4c3a3f3fc7d494777e701c35e7d7709560b918b89b', '4d73e620d8bee5e0242efdd8c2ccbc785151e9600a5535f501224909b7a2a75c6af471b1bc64a8f4', 0, '2020-04-26 11:12:28'),
('175d4e6a4aadae5d9589f65889d12cf9a3831557d4b6a5b6e5bbe91ae062f7b784335a1289875ab5', 'e879254c002affdd3d7d726db23dc2a43f045b090fc76fc5df55f85764a279ceac0ca4b22a6485e3', 0, '2019-02-06 12:38:58'),
('1763e1c5335819815b262fa67e9917847c34a964d3cf37f32bde2c35d028d96f20449b7c2b110b8f', '78ffb4bd0e472874edb2736a7f204aa9cdfe2ec2a41bb458a7a3e74d333d78d8296885624cb17507', 0, '2019-02-12 04:59:52'),
('177ad9af6ab2f82c05a6cf9a3fa1f11328c215fc3aa524bedc9701345ccceefd8ae15c2dd25bee8c', '1427b4e8f36d35d1edd5cf1b07735eaf73a4e15b37cb5055fa57a1b3b4c0e49919b97c62f704e818', 0, '2019-11-22 17:57:43'),
('1812fb8f5310ae9f3eeae63df8378f40f3d62fe0c3c19b09cfe4f6d81ec65fe4daec298c52de4509', 'd62cadc7bd0c136a849be4c9516b62aba9a0b725325ee7a6f451a9a787d20953664e7fca65a5f4b7', 0, '2019-02-08 09:31:50'),
('1825351b395cdca18199ede3ed1d1d00faeb0b543d219dc22c30b10f5ce854dcfbb60e95d7d0acce', 'dbdffd67be66fb0c2486dccb88cd43acde76b3aa37c2db239e62c5a1bfa69d42db3a3bc4d466ac76', 0, '2020-02-12 07:37:30'),
('184f20517836e4f496df83d86107894c17c57ed3504c8415773d84908b3ca720b1bebe21c6500944', 'c6f2f346bd8b899b87e1545f14bf63b8994fade4a2338e4c12e9164541d956670931efc6f5823843', 0, '2020-03-08 11:08:55'),
('187c0082b684a992ee0dab63cb6e817c12fd19182180a89cab57897bb0781108f4588ce5a72619ab', '60d7abd60a650426c66a650883eb7bc6b0849b4df6482ee0048dd0539445286cce6800714e110704', 0, '2019-03-16 09:07:04'),
('18b1de02422ae933fdec61be3b153bc799630fde4c078ceeed403c7a4bec9cc0bdd0b7105ceadfe1', 'b9dae7e906f626127db105c250b878a41ce1f0057df12b643627c5d6fe6df00c5ecafe5d3995ad3f', 0, '2019-10-24 23:43:11'),
('18b9701b78fe34b4da6388e2595072537dcf4a73b6e0f8b9b15afd07a156c15c7943274d095e15ba', '4d18bdd1b5884b6e06755a1627f1a134df6261d7ce30ea50d39fcd7119aeb1cbafea81286f8bc0c5', 0, '2019-10-05 05:24:28'),
('18c4f06be388701cb7a7a48c01d582596148bde6a866da2e26f43522754e03bdfd2039db8942ed59', '9c01b77bab35c557422fa2dcaa50d1aed68f491d8d2972695b5560bffd91aa3fcfb4490367b89d1c', 0, '2019-04-08 17:57:27'),
('18dc4580662269abe39c8491c78c50826a3565e9a0357e3ab650320e52a3773e0c24f11ffd840f8c', '4325634abdd7ce8a5c6e18924cf0826b7da42d390b543735b8971ad5a626edaa2a55aa036cff711f', 0, '2019-05-09 06:47:58'),
('1917764be46ab96a0051258cbdb2b0f68d8ee00a55b5426cd5a413397c3a6fcc8f39607de673331f', 'a15635495d80777c7bdfef7179f55a0d08220eda3270fffa831513653f7f6c30ee45c903f69f1ee6', 0, '2019-07-19 07:16:01'),
('192045e0bf6a837df4cc2b8cdfc2670327f9670698995a48da01530a562b39331dc3613f41b96180', '273a69b8b8cc902c9183e48b0cdfe747f55b5cf972bd80064bc6e1446fdc10d68fa2eea3e96987c1', 0, '2019-04-05 09:46:15'),
('194b10a16070511d7c769266e89f3b4b3e6a4622e6033b907e13c815ff99ccae4f5e640fe1d9ca84', '9c29e10efa1425e8ac949b242c497662661bc69c8da1192518eab2319d71fab2ebb4c3b14b487685', 0, '2019-05-01 05:14:16'),
('195ba728ad77d3c60c5bff19bf623b6f746119210ff85a686dc02a5dbde27dacd3df4dae42c945a8', 'f0e5e7f9e6116a6f66225523dc10051ad5b402b33ddfeb27a17c4336f88b8def859e48f6e49a17a2', 0, '2019-02-16 12:54:03'),
('196445474b79c55e452bdce62458b43a3fae58fe36685cc8eb43548d8eb3d7e04dfb1e975a544042', '35696f242b64f86eae226bc7272d584c60033336bb86ca5f5a83c69e13ceec0c44042b942030e890', 0, '2019-12-19 00:31:27'),
('19712f9342718757d65d01e50ee1196cf5addea26814a8bb6a7e529a23d31a93e40f5e88c262ff4d', 'b98cf10d2cb331f76815ab9f8eddad17a09fc7d4a88f4df3c8f5b25ffbd733ea677f16ec9e36971c', 0, '2019-05-17 15:03:15'),
('19cb55dbaa5e601e017f311546ac3cdf15ced32f4a17cc8ec2ec3f01fbc04ad20b8dac4af1c38ffc', '01cd59c99c8977ff3665ca408b90e3608bfe2fc009b57c748169f3af67acc6ce6c7a1c06d903df4b', 0, '2020-02-14 00:30:37'),
('1a3b863d98e2a186cc2fcaa9d2e8a2b145d425a8e6ea42175d39cd3d601a9d10dbecd515ff436a46', 'f89909df3b80156c0b56fc91d468132d460e7cb5963d69d7579882aea6d7a5607f2b8063ebd49c25', 0, '2020-02-11 01:15:23'),
('1ab684bb7f5ba351a1a729ae6cd45a1b44262cf4f72d63310423f4f3294bea689a9c50801c4adbd7', '77d8dcda4f2fd3126823f9c9f02a18ce57e1c94267c1c9edf6a8237768f573012fce20812d9eb0f3', 0, '2019-07-24 09:16:36'),
('1ac127eb8b200450fee6e6f452f17022b010c233eb0d23bdf3df117f620954884b27406ecb165a4f', 'b13dabe9a0b2873df530ff46b9b372cb887c0edad4df7fff4b175a9cc3a90dd2a21834a06ed54c5f', 0, '2020-02-06 00:02:03'),
('1afa7667f7320c193bf47d486388d1dcc3706ad688b9c4be257e9e0d6562d7edcbe85fb79e986486', 'c7d2f4e1cde85b7a058b3731204b81d21ca59458e9e5b779591b8c69e473b97c4a2d15dbced592cb', 0, '2020-01-22 04:11:01'),
('1afcfc8661d30346f1dd173e83bf0fcebd909ca6d61df36b1a4f244c7458b42e37db7950238ffa6f', '1b7f7fa2b46d9551a760a69af95d26fc4b9d0a567833989ff791bcf5032a8a9e30b16d2ca61e461c', 0, '2019-03-23 08:58:03'),
('1b089d23979d7dc2dad04d057881b4ee242f6d0e689452612f5392bc4bfeb4f712235dea48c06e38', '539bd3c44e9fb9a7e9a393e4fce651cc0fade4ab5a21b58b03705c16ebea18b750f46e6c0004525b', 0, '2020-05-03 12:45:59'),
('1b288af621bddb124e0c7dc60d5b4f4412a2d814f2365bc72fb0643e3a704fb6f18dbddd5133d974', '1659123eab95684a268e3ae56577b3a9dee4de16a4d48353afe01f21675f7bdd62646d2034267fc5', 0, '2019-05-17 12:35:53'),
('1b2db85a57f5e2c7b69eafeb2ec4ac91864d6fbc5be8c388dd73bae9905a12710cce40d34d8bffc8', '6e82094cad0e32e3078eaa7ac8c3f57981d95025506e247d362c510f169cfd17a29106f97033e1f5', 0, '2019-09-25 03:43:39'),
('1b3a2c06e88ec3a7f839ddcf1e4c2596d83477aad5cd61eba95bc954df9169b27abdff78bd5981e5', '58af11962bc74acbc729f640ff488f7d637c1c436030c9bdc2bb1a22df71dc36e8dc89166b7384c4', 0, '2019-10-11 07:44:03'),
('1b54934dc25dc87f1fda0a29e875048e65252344954fb678ac1e535695b4ef30e0a2cf09caf2261b', 'f079c4fd7891de41446886dcabab9e19b5ca78cf3c3d4145699d217fee31bcda4e097f19107cb821', 0, '2019-04-24 09:30:01'),
('1b658c9920bcaca7333e3fbcd20071a2691c9713c1b6c066f11c3a7091ba47c45fcdbbec29574634', '8b943cd5fefeced36a85ece1aa4caaa75a5a17a2454a1cc7682ac044abce629ead31dd76cbf86319', 0, '2019-05-15 06:52:37'),
('1b81fa229b45077fdcd123f9e4208a2e4697f500a488654438caf45f219d6d386867b08b7c47f89b', 'ff955b7cea62f2f27c8f1c7fae17cb15965359349736b134c0b0e2089b6b92cd839f16521ec2d081', 0, '2019-10-18 04:35:42'),
('1ba503bc32f057d91948d298d88ee54b6b4a5abaf212f44b46f7621c7879c5f768601ba15b5b2a36', '9cf7692b5c04aa51948ef65ef671f06112012e1e14996f8f4a18ad42290e2aa624dbd5a8b1f93ad2', 0, '2019-10-11 07:21:36'),
('1ba8bc626590da728c7d891b126b46a902690fef9b7efa98816d7e2b9b36f0c009fc0f39099bc95b', 'd6ac7b2cc1e8da1103fcbf3e1f5a26d32167c9251c91743749b790a13a5896f1cb31429ee75bbac8', 0, '2019-08-15 12:36:03'),
('1bbcd1347afe153692a6b84d4d4d99fcf5fb728e7ffac56309a127267d7a578c2b9adc7bef67cbe8', '068bc431a1f041de45831b1a860c7f164f440e6fed5862290fac048d5f936e4e34c60d1458ff464e', 0, '2019-12-06 05:08:14'),
('1bdff4648a6c2433d6f998aa44b3c18ae9523fdc72fb07a3bea8ffc66675e9bf18bed7fbe2a38356', '7ca5f1ba60bd43121d37e181863db95cebbb8000fc360e1c1d0e9a2aa19121c3eb954aa157f26932', 0, '2019-03-29 07:53:35'),
('1c3da8834f1b71f3728f8c862acb0b8ae6305e2a873ec6268d87750952bb5a86196c2cd2d5ead24e', '12cb83b3e8bc51adc895b94996a3e2a6c44fd5a82f72287b0d5338765ead6a551f887eb3e2417ef7', 0, '2019-10-09 18:38:10'),
('1c78e81b21fc4a52552683aef4332645954d22db0e95fef5157cc0bfdd655ab5a9e0c95b205fed7c', '736a9fddb3b0c8b5e59aa50f2b2c4901bc38e971cb8192da3578080b9235a5d2778946f7249ed961', 0, '2019-02-07 09:40:58'),
('1cbc453574d61893632e4ab78058d639aeb3469cd224d302ff4b550f0324ddd81b0b82ffc1aee827', 'eea38287d16fb5403f78d25b35dcd1db2b65beee2556eb29db2ae069987176a2d3e2269dcbd5a32b', 0, '2019-04-24 06:29:07'),
('1d03d64254c352d97237bb7c71c8e18e6546621987783a3bb4e577901a85e5b84ad42d62939962d2', '9a798568b9ec08b51ff8c9a46d38627f55ba13fdf38447a5e629ea75654cd33af41a0e0f4c394506', 0, '2020-02-05 01:02:36'),
('1d05f381966f58f091470ea799c548e0c8d131c68861a0a38443bae17f92d3c7d28ae7d607caf396', 'e1a1f20a36420a0072077e53bbd0946c8c7287358032e430c9916b40ba51d98c0b54b9b4298463d4', 0, '2020-06-07 11:13:44'),
('1d0f31ed4be6e87cb3c41b917fb20f0b70f17df296e04e9c8869b9b3637f029859131fc9690e66e4', 'ed9174be8bc1b2df79e4a912953ac4c0656f264b34f544530237275335aec4da5cac0cbea1118224', 0, '2019-02-14 14:08:42'),
('1d5668c7a43be7f2aea5e2238dc4e7bbb200233ce463901ad9cec4d4dbe7bddbd0bcb5f37399fd70', 'ed2ea011d072bbd4f47800440911608e845a81b50a363099d68c1e000273defd291d2b0e7e48ef5f', 0, '2019-06-12 14:32:20'),
('1db9495ac74933c04a14be6d5f5ef6e9db700a343bf8a2a72eeb5a937de06f286b9e30e418469c4b', '9df44a510cd4a7b5558a98519a20a8ea0109a6e8f5636bed0ac717415a53d26859ff3b1798af0ae3', 0, '2019-04-23 04:02:22'),
('1de7dae89cd29d103da7b458c47a69e2544ced2fe5ed4d0b7c572b2a0f98d2bacc6fad351dff627e', '5f58565e9c425a5fac78097fef988358eeba65281db8f494134f2c5eaa88c739d1824c0f536112d6', 0, '2019-02-07 09:11:29'),
('1decde97adfed976eeaae9cc58c49c44ef43f043d5c56544deea0d119685c11723c863e1c5325c67', '069bc7fd45b0214bc3397c4c5df3a0b2570fe09150b4bcb9ea5bb869293f449c2c9408c4567a332d', 0, '2019-06-22 13:02:03'),
('1e0bfbb1eea17c80dab71c9f2ac376fe7f16996eed981fea134b07d84f78a573f7b09b0673ebdff4', '7a73ce794aaea1741bc642887965908c1a42c60b9fae297f4466cf0819113ea8a79c9c4ad8ee446d', 0, '2019-02-08 09:19:38'),
('1e38970bad3dbba775d45a0547e71e4f734f643d9cddb23de4f4908166fb399d53a3bb4b2e4c900c', '57b0ca7ade13226e189c75a468d9c61897166029d7c2f670eb0367237c6012eca7fc070ef567a687', 0, '2019-05-09 05:50:41'),
('1e4df12ddd630b5590f39f2fd5398c632c1641d5712f83abeb000af82b53b1ba1d0b2de3d11ac05e', '827a62eecb0cd73febb3ca9ed4b9f248398c661ccf6a7290b40c129f50bb235fd632a29e7f36993e', 0, '2020-04-22 09:37:33'),
('1e8db1aea0a2cced753c4f20d328563cc6fd239a7d68458083dee995bd974e654701f5765d85de07', '2260652ead6f38f869139f0df224df2f6a5138981f9604928a2fabf25a3a337d075a415904e8ea33', 0, '2020-02-10 23:58:41'),
('1e97667df13d5214868ffcca12218702e742afb02c3426a049dd4b8bef578580dbd4765c085a3089', '3c1001821e344ad5ea59462e6942259d1e35f1cde9d3659335f9f469be1c4837359f306bf0cac3f7', 0, '2019-02-15 07:34:27'),
('1f01877d1140601e1ea306966990be01f18132db2acddbadd7d64a55b3d3dea58e152a27e11aaf75', 'e0bacc19d931fe2cba9e02e131494f79b93f262e4f220ba7029255bad64d36692f4fc7ae8c1efaf7', 0, '2019-07-24 02:37:31'),
('1f0dd49c54914114d11aa159f31223b59002d709a2b88a2368b00b1ae2c323b8942aa1c1e7c51062', '4bebcc20f078b547b28af61b982314d913cf2903fbe8dbf8c8961cc84fba008566c5594c6ae3c68c', 0, '2020-02-14 02:34:08'),
('1f1836eb8baed61ebc19cbdaed94d2354068bb76af5d48358864dd8ba2273a2c243f883317087a2a', '87fed81df3e37976f6f82c4f322de008e8739ef6a66a6f3dc456101e4aceb8962d72294289b55295', 0, '2020-04-10 01:46:22'),
('1f3267b7a2daf2d392ecbf932f796b1f232ac2a976828622cee087ef3747823bc346e4de3760428c', 'ef0b3e6c41d91a30e6ca50eff361642a55c3c7e68b9d107dc523575364f806b797397d8918ce66ca', 0, '2019-05-01 13:06:04'),
('1f587900652fd49d9198bc3c377d3014964caa0fb6e18649076355940e4d2c44f1c2c423c620d171', '7357a1b402d82b013835281d13bed7270278a768c2fdecd67ba95fcc602b5d988933028c4d91116c', 0, '2019-04-24 07:01:07'),
('1f80e4e877f35eb86423a835e13edbbf0cf7576bffe6e34cd95506f6cace603120791a9e6ca8c5b8', '653c5112e9f273dce551793884dd1f076b69c0738eb20af5117f906176264efc5c5cf91cc0d9b8ca', 0, '2019-05-21 13:28:04'),
('1f87a9cdc58506060cf3cbdee710b3782625b5b102b5c3463a0678c9130b60c955ec97d8fd4db476', 'ec38d368637cea1f5e4578839e3bfd2bafe8c7036290a2b7ec539ff0130fc6d455303f882438d738', 0, '2019-10-11 12:07:38'),
('1f8c903d2eb468c9d69d7d3c902269e482a949566cbd2d722c52dabfbba7bef253f48e557dad0b99', '0c49cf863b1d89b7b37d3dd4506b3e44b18d61f163ee09b374c79adb137cf706729729015cbfbb94', 0, '2019-07-27 10:32:43'),
('1fa12205f64cdf88df3e9b8875f31f068c0dd0b06c19fb4b5ab1b6407ddfcc67f73572f48209ec4d', 'd1cc52797a5d247eb136c5a852049538c29eab8b4e1f8bd492a8fa23536786fcbc084ce12676b3a9', 0, '2019-05-04 08:38:03'),
('1fa4927f68d7c8f31623b79a64b883a85a5d80ddf4c58f41e75c310a6876bc1680f8efc14e3d387f', 'a6925e3b7695ec5338dc8d9b680a0669d3dc5b6d75ef17c5143e7d2ae4ee48675b48c80864095081', 0, '2020-02-07 01:55:29'),
('1fb0eda69cd34ab52ca3f7a74ddf2f976e79896805d43cc486ad1a7feb3010b8e9ec5779ceae9966', '75ffe24e24d6f391b6ef4e3d693801aa8c6c492727010dd59dedc4e1cf21f3401b06087489480736', 0, '2019-07-20 06:55:26'),
('1fe499c20765d4c5ec728ca5db98544e68ef30ca36808fd356ec0249cacf6a0ba12ae12eb858d2e7', 'fd5ecec7758457716be3024f144dd67fc7b7b7a95e1093774211a675312d01606c70a9ea067310d9', 0, '2019-10-11 07:23:52'),
('2031958bd966063a9998fad791bb8bfe2cfadf285a03485beb6e3915f5c9ee9619fcf459380f457d', 'd3a551181f83c13f8deceac2e9931d75adbfbfcedd9105f40e827da86e3cd8fe06eef455d632fa1a', 0, '2019-03-21 04:30:36'),
('20354c4c824790c9c988d2b15b4ebd004eefa2a2e77253bb9bc714ce90fd9a3dae8c83b7d64d0190', 'e46a4d50b4ff6384c719a9dd570cfbcbca8db93e26e9220a16aa14d6949bf479fde520a4dab105a7', 0, '2019-04-24 12:10:57'),
('206b290e5322a4e5702b0e6ac5fc10e5b7a90331b98a1771ad2b2dc6d3b88dda348bf2bd8109c2f1', '38ea198ca3b3cb92203d5757b5b0cbd7832b3ddc6c958c3db98de54515cf463e460368d7ae8a45e2', 0, '2019-03-09 04:47:04'),
('208f47d4356598812654bee07a632e0b4c871b485cf905d4f505c841ed9810f637a2f01de218cadb', 'f93e771225348a4b61f83f997bfc871285bfdd824e56c93a9ac80ee675108efce08525a107d01e7d', 0, '2019-10-18 14:50:00'),
('20925c7c6e1b8639756298ef7ae95b8fc02168f794214febfa0bf60e8e5ea481ba4564809fbcf492', 'ce63db3440f76910b7d8c0a8f5b6eaa5ed2f7a757eac88fadb021bfd1b5972d00cee41ec14e9db0c', 0, '2020-02-19 15:33:14'),
('20a65fc860e392c50be7017946596890d9110c0e57e733affddd2fba21fec37924056a346c61ebbc', '2777834dfebb0a44ecbc7bd7bf6bc015f10deee1ef87ec9275e88e6e72ea2e580fa7a4f1f0734fa1', 0, '2020-02-11 05:57:47'),
('20b54beb6fcd143ff84635e539412a606575d8d48cf002181440ec1d2194bdcc85a736b90a8a519e', '9b84733815a171f7208ccc623c42a235a985f4f0a09a1bd3b64462879494da4e68def5b107e58239', 0, '2020-11-06 22:12:04');
INSERT INTO `oauth_refresh_tokens` (`id`, `access_token_id`, `revoked`, `expires_at`) VALUES
('20bafd263a780c3e629ef44c51cea8ba4ab0a42a032ca29113d6b7f2d8cfb120dbf0a838c3a95a98', '70f00e557a19743a7f320cac8fa1921df645cfbf6ee0a4e64930312e2e49a9be9fe2d52b2d020f0f', 0, '2019-02-07 09:46:16'),
('20cc4ec4dd218853898b5625f7f59eb44011be2b5215179f5d8448a2bfde2712617e9d909c665d88', '2bd82a3cfb5b1b7c681bd903961126b3f747bfc63c56038638ffcd364b0b44bf26307619f973c2e9', 0, '2019-03-22 12:13:31'),
('20dfb09966bab55150a829a973e2a29cbfb8948a29e7993b038315e34ea9117467d00048249edc94', '1e26d942575a599972774fba7c055c8525c16cc27b37d45a11889b461b8aa7a14929ec4af8875590', 0, '2020-05-03 10:36:14'),
('20f0bd1ec6049eaa951a2d6b0ebf7c47fc89978186d57c7e7270d5d5bf0a42e966edd9f2b9f4aa51', '12f465c5c1b35c10d22268266c67521d44986484019f36d0a0ae5c0a94c6bba6cff092366f696274', 0, '2019-05-04 08:50:38'),
('2108043e70d94eba3c5500b119d51f082639404594b88a3b8d2176cb86a51cbc42fa2483931bbd20', 'b526dec26ad0b7051341fd42d4fe32c7292a987a91b6d9577d222484303233cbf2c42f9d463c110a', 0, '2019-05-21 05:24:53'),
('213e781578929d7d769d4cc1aff5254919c16a77918322e508eec8de7e51071a563438e51ee388cf', '29564e035f13c05f86ee8d3b404c3970abb4dac76e8fb3ea3d118b05586615f5fc2b2e67b2cd8857', 0, '2020-02-13 04:48:40'),
('213fbdb199b7dd4c79bb402c1423367fa65d0ace410ada28021988d44eb153c77bc822dcc9d54fb2', '7334029e666050302ebe615ef375fbb476d39a618438ab29466935fca50f2ebcb009a409ff69e30e', 0, '2019-03-29 10:37:09'),
('214fa5fae78303a94a99cae6244ecefa2fbe2a06899605763bb6e86a29348b4ec0058efdf0427d78', '573a02801679b84e754ba5a6317de0df024a5142f2fbb8fb617deb9f513a51a2567fc2e936f34cef', 0, '2019-02-06 09:55:37'),
('21919d07bf273f60128cf43410845ddc0782a992e29e2b90f6102c1aa3cc078ff9f035eca375b25e', '8143a691a1321f64cb845fa77b6f018de0c55b998c0e928c124319df6f66f9560ac0fe416e94b132', 0, '2020-04-18 17:32:48'),
('219ae70b89deaf2f787ed1338f3785c114c76c825b16fcbfbe1bc76dce8324cce2ed6a1c641720df', '64687817dc9ef1e4b6f0c7dd3e0fd728410093770a2991beb5278ecc4f48a5b3a2a4e7cf30d8c439', 0, '2019-02-08 05:23:11'),
('22093e90fb82a8a9bceb90454cbdf652e714dfbec89c5c24d8d1088fc5e1b6003202b9018ed89f1d', '10ac213067f79bfce61b03a99e6c7e6af39abfef17967bbc7b0c19ab0ddd6b2925a1377787c029a0', 0, '2019-10-18 05:00:26'),
('222cf4bd0001b0f2af4f0665ae2bc33af1503d632797208421575cae32884874e57c1fce1a79e1d5', '79d461cf6259ae3cd0a2ac0ae5215063372eb12e983185d5994b91baac1a23d381b7784154733f73', 0, '2020-02-14 00:59:27'),
('222f2f00e8e39d28f5eeb20861c363f347c17bd1210c9891b9fb65d188106d31681247ef7f5298dc', 'b1ac16ecc3047a231d67e61a0ecf35f596bd2050996af9c62e4537325102d85b8924caac35e90e0f', 0, '2019-12-11 06:59:23'),
('22ac4d821397add3c77df7cea5f635e2fcebcf021a1d9bd280da5464bf486dced8f4ec17ae6fde3b', '77eb360b24d9303698b77cb51de2a5b889c291f9463b7be2b4e2f1c71bd0b1b23728c3e17b80091a', 0, '2019-05-11 12:02:38'),
('22b91c43a4b119953d548a7ef23ef0e5b07bdfe72c47c66d2fe3db9b19147880ca7c0218697a8f34', '5713906cec269cd8f57fc5bd2ace91dc83a195c3868b7a80c9a733c808c006ece7b0af27616b7eec', 0, '2019-03-28 06:46:21'),
('22c25ce31d30e6274b7113d2fc0db66d8956212f4c5937e3fcd563c16aedb716ea01ae8b6b86f509', 'fd5d5e339ece66303739b964e47b3b55e18d9e1880ec9f10958cff5373f842ca3793e274b00f3639', 0, '2020-02-11 05:47:19'),
('232d43f5c36428e174650301bd62550973faafe2c00c6dd3a123cca58e78c8fd2823f50f65e7590e', 'dcbfbd508d2618bf3f1de90ad3ecc275952f09374756c7a5650f9dced222fb1eb5a231551726fcd1', 0, '2019-03-29 10:11:37'),
('234b7a31dd31504d06d7c36a5e502424f644e2c805332ea12e429ecdf4e725c095727641e3a057ed', '5e0f2a7cae3e28fc2463a1b8379a2557d6639c76c4e51367dfee863e516f6195a1e33746457ac619', 0, '2019-02-13 05:03:00'),
('2361bc0699d1612522bee93da574f3b0e5d7ea9a444324be435cf6cd7d45060bd0df7ac4898eab41', '90fd7cc63e120341b3f5037676bd797cf543087dfac26246aaffec7000285e4308b728895a7c0891', 0, '2019-10-11 09:23:23'),
('23829e5d1ebf0f594e4b2896be1413bfff0bf10081084c1e702a080dd3cb89c8e0f2fcb365059d82', 'c7c8ee950859df6cd281a253f25c833df5fb24ed180e2efdfbde1a761fa726a432134126c1e233be', 0, '2019-05-16 08:51:00'),
('23b5cead4e02fe66065e15ef147eed06869ec2821a7414bc1a85db361b932d47428396db688d18b9', '9b4f8e6c5f1d6b788130c22084fa11bcd97ceace2af9ab6a24d7d8f13e22b74d86bd1a6b8272ed44', 0, '2019-02-13 15:15:44'),
('24295b9615699918732b71dfef1f0a493666fa838739c343805d1de4216be7488e79ed9ad7ff158a', '46cd8a19d0021aa1431050b41c4ed974823a87a8a8c2b93125d592276fd5d7fedcb661b9ccfa2ddc', 0, '2019-05-19 15:03:33'),
('244c47ef6764e6f6fedcdfbb91d44d8c87b2c1f91a2d058ae63ea8dc94ec48def2031ca097238139', '0842193692111d0ea28ad6ecf1ff4ddf0beafde644b49c22dd42a3b46adc870f6fd9eb3926a942fd', 0, '2020-02-07 03:47:37'),
('2458f4660a2b37bacc123797209b0a51a62aa13f904712df4a8edbdaf13b40805d8fb8387781c659', 'b01c874eb62ebb6a5a75a5c91fec19e2f0556a4f6e8576498cdd839ffb3b2099b9fe5dafa76789d3', 0, '2019-05-10 07:05:05'),
('24ddee4623cf005bd68cc6a106fc2d3e3b620d6d5ccea9dd846850dabf020a60b831c0068b89444d', '807a3f01ca8dcb1c4a48a41ed2915b858c07b36371347a79c8e1c9fd19bc7d8422410cbca303916c', 0, '2019-07-05 00:51:36'),
('24df32770af5c12dfcfcc364bd1592fdc972c3cda7e47f76f75141d315c38fd94ba6b10755c4383e', 'a1af9d9621ddc9defab2995c20e475284a1602c97de149ae90b73585ea4de3d862c5ce93ed725d71', 0, '2019-02-07 09:30:13'),
('252db635f91a0f3050c034d6f193aeb2698307f11ee7d3577ff87a523e7487d7ec02b460a8f9c480', '4c13fdaed7ecd0ff2bdb70ebfebcffbb17203e86e400558f597baeff851b4e8a3f606dc8e458cdc7', 0, '2019-04-06 04:58:19'),
('25309b771f299f3c23b4aa193ca7e5622c694c17d37789fe2e4a2947ec8002ebfcafff25226adb31', 'ec948f4089b7eae727681b85c96214841c8c6894402eb9eed7abd00a41e5b86a7bd3d85a3e2b7449', 0, '2020-02-12 07:41:53'),
('258892b07cc50e79f0b5aa35e48330b267615d51ff3f39a905efb15c3f4aa319dbe204ce1e7c7ae5', 'ed674f47d50f47b62075912390355a5948a2b6340c497d34767a088cbf1bb982ffcaed5349a13b8f', 0, '2019-11-27 20:53:04'),
('25c0bcbacf47a7f668a0990f95bbb4a666c4b89aa0c006c7f4d77a4cc4a210863b7b0c8518f1f147', 'c406c140aa41f325eaa5db940f13c9d2be64e96437f85945a634f12b7c6460b6b0f8dbe1a98d1373', 0, '2019-03-21 11:24:23'),
('261da091ef15fbf2afca1ccb9e95899b2bb405d34bfe063debe8a4aa12f1c137a145403a2a8aceb3', 'a8ace4f5911b03fe0d9da198ca2bd7f40c212b11ce4fac82f0075148df24081daf085499c74cbb45', 0, '2019-05-04 10:35:59'),
('2657f10de923d41b508e6d89373f74724d3e8852e127b62d6041dd26bd5b0c40c1a1b575e13130d1', '402dfe8f0fdf69b5edfedb20268e421a40c0ba87f9d2838d5fbde8d56bac56517ec17bdc48e9d2f9', 0, '2019-02-08 06:18:32'),
('265f1166149c6766bc771554e3894d36bd7d32746a7fe1544e943c9a047fbf87356e95c01c4b4cdb', 'db895583fd895e4d1f560c6ac0c18b0097630fb22aa52fc7ff4c8a47c59907e9fe8b3da11774df10', 0, '2019-05-04 10:11:33'),
('26809529a24537f07441d5a1113217b011eb50eb4b5aeb1d6673cbb671ea2328de63d6f9e5247da7', '739be77a5621e212633cf03ded8bc8c20aa8cd4c64a16c9ad0ce65b8c985509206c1c9914f5cfc8b', 0, '2019-05-14 10:17:21'),
('270a2c6a83b6de73ae9f54dc07ef9ba4ab2fcda4adb7d1721ee4b7db8328226156f5a7685c6a09c4', 'b9812ce56a26ce3e75f3ddd8a5971529ab8027aa68761d19dbae49f21af3cea5ef66d6c328398d47', 0, '2020-02-05 01:08:00'),
('279d78d8a22cb8e9d02b9fddf785611f36e45634d05ef3b2545221b6708c930d46283b41500c7ec7', '93dda2156f4fce5a539ee4e7579482f5f939d2efb0cdf92a1b4d8c2c037c68d142f20cc88622c087', 0, '2019-10-04 01:48:27'),
('27a3f175588a77f4e61a44fae08ac2b5e6d86715ab51d2fb295f65cb407f3b28d18c3b331b2e7e36', 'dcafdf54785b1635da8534b05ebd9b2b00b86cce1cfed9e6d80d62a8953d309257d3c538f3570a24', 0, '2019-12-19 00:55:10'),
('27b256512021a35114bac9473ef5947cf01405971e1aca726565960ffc04d32d0df827c792968cdb', 'b97d4683a3ffda37f68d7554e4e365c8a994ee32321d4eb2428a4056e06aea735643a4f3940b36d3', 0, '2019-03-21 04:49:52'),
('27eed9c7f522a3b285bfe4a3f80c17678682fcac29dcb00c65bc0d8c85116f7ea772c74755609d38', '1cb2cb3ceea21cfa9521a9b09f64def8c641291a5a70a0fb85d757d197a278bbea3c5839892059c1', 0, '2019-02-14 13:18:42'),
('27f664a5421305a9d07c5fc9178af71b460976d6de00fe3b079623f2a59737fcec27d4bc011d9202', '36e95d60bae692bed4e5df6501b08d8b97a714ee75f1c8254a9e26b26331428931e589ecd902fc59', 0, '2019-11-08 04:38:11'),
('27fe4eaf7db6e5b680af11eb8834a6cda9424ce531090c6fd09c136895ae19799ada7a60ae762efc', '83162efbc71b5a8280cb1005600091fb63379e907ba1540a66591b605fbec9c2d35d4404d8e84d19', 0, '2019-08-15 12:32:05'),
('281bce9f99f2536c52a02f5ff57ba8d6cb60fd8c483cdc9cd8f01d95e3508f9e16235a8b15906f2b', '8585c7e65085fd727aab1901fc7efcda566822182f00bbd5adbdd89bd25e3e2e4a9b2ce16893f003', 0, '2019-10-10 05:55:11'),
('28294a0adc70b506b3109bb811ffedd03667992aaf6782b4fe3ed6c39eace3c8c3636d9b8059a5b9', 'a835001f3879daaaeee176448d1463aa1c63baf7fbfb8c811ebdd5377d41c4fc6616100fa526e6ba', 0, '2019-10-11 07:06:58'),
('2834f8a9a52b80421154790ebe79c4376e49fbc3c1afec0fee30fa7497fcdda68e5d2716630c83c5', '0c3c07ae4b3a85d0bdffd7688dff205bbb2d785454898790dbbadcc93dfd7a050f57c8d4d77a1774', 0, '2020-02-14 06:12:37'),
('2852c7105a753d24c7469f315466ec7bf9c42e55d647a88b2ff9ab579b92ad60d51652c38bd431a8', '3bbdd30c48d0c1e86338883a924a4aef1884cff67bd4d8d91945665a54cb198c6aae3955a6273396', 0, '2019-10-05 06:05:59'),
('2856d045f4d965abda9a7de11a0134bf99c7c6e807ae720bc1c23568446f62e3bdab72cbb7504c6f', 'e4cce4105bbcbfd8bf12647514a302ae7dc6eab129ffaa573b3c42939a77753fa303f819e1bfc024', 0, '2020-02-11 00:26:00'),
('287756ceda8dcc893208ade2bad4272a46817a89f1f67768b06cb355ee91e4d08718c87b56dc3a49', '9d6249a10a172d2066aea7179337d2b1a96c3c72ed3bc3166abbd10894bc0007a5caddc8e3cb3167', 0, '2019-03-29 04:33:13'),
('28afee877563dab5fcf575ff4cf331e2a8767a279a0764e15f54defc01ebad028bcf48c65c9f423d', 'ff6803902587e7fdd93de226c24d6c6586b9f3e64440c4be7dade689019b50febc380e3a5df4ecc4', 0, '2019-04-24 12:12:35'),
('28beb000a4bb98c92310ffee73662b2f9321fe8d66ddff8b53eac1984e12d0977d17d03d539d1cfe', 'b0dad38f80b496fbb4399256bbc272e972705060e79d6108cfea63f44098b4722c4367a9089b47f4', 0, '2019-10-25 03:34:15'),
('2985114f944dedc66f5e471fbe1e7807385b317fa11b7869fb28fa5622f5db64ac566c7b2e644f28', '737996bf0a1f36d7c14b7884a027f1c694ded29f85fa519b761bc794e3f33eb38bc4bec52196ead5', 0, '2019-12-10 22:51:30'),
('298f8c4ba6c6e41834e44aa030bba826e34848eca5083322bacb472765efff3de909285d02780dbf', 'e04d0320f98f7ceae3aa39eb80f7c014cccae6e5a7f6df9f8d6b022a3450099904f9dee159174064', 0, '2019-05-17 14:55:56'),
('299373a4b2687954ee1f489464cdede4d4b98472096cfe9acc53d4df11edb13aa0aa63c5a22f6652', 'd7424e7108515c4434d2e383711fd67d18998e15d5e2fc8286a57bcaf538a181387894fe8cfdcd6c', 0, '2019-10-10 13:14:34'),
('2a24c6327d9619b05923b2e1cf70e20c16a5fa52138ea1268d075a7a7d39d001fb26cadf4b40d236', '0ec6dd5482240281944eecdd968554c4bbf5d8f3eaf8c8402c45120407f05ff466bf9321ee3c007c', 0, '2019-04-09 04:24:22'),
('2a29f4035fd52a099b682f55a27184c5f4395c4abcf4dbd442e82e4f2dae7d57f82167e59a5b76ad', '7e268c937aa5bcbd7a2ba86dca5419397d0accfe79b5eef7f5cbd5f69bc41bb2f8a804bee8eeed23', 0, '2019-10-18 16:14:19'),
('2a3661b6e4c0f4050314b8685a3b9f0568c7ece683fd4b9065e82cd30776dca79d218747690c11f0', '2f50c4d8bda5d147978396efb136a4fb88211b630dfaa859c4b16d12c9fedc69fe3bc52dfdc06991', 0, '2020-02-01 18:14:09'),
('2a3c0534d7a7b9884db4042ceb1d5371f2d621b483a4dbcaf88620077ff567e8ac21a6a9f7dd0073', 'a2a32e1ddd7acf98dc42f6c1cc2285c2ac41d97a67a7b9b2ea28a593c7ba7d4e6f815c52a888645a', 0, '2019-05-17 12:17:43'),
('2a4b87f6d6b206296eb87c34a9f9433d363785934e546c8a207b90809876de33aeb8b676b630d4d1', '0d66c39cbaec9cd4b907e142737bd8a1da586b594888cfde70a50bab24e0b2b724edc1eb3f821707', 0, '2019-02-13 06:35:29'),
('2a6c03f888b3a2b589975cc225f545209c9554060926ce5f2a8b4c91c8195e35ed3f825e01a0c0fd', '63cf74d7b120331c60313acacbfdead87a0972753eb3d193602df923dbd25ace5eeaaf78b759fe65', 0, '2019-09-26 09:13:24'),
('2a88a02d9582d791b10b17dbe90a62db47b27dc063b24a05b4fce90648ce578885abbbab28b05dc9', 'ad188d7e650de15e5d42c447ab7c2b1bd5bb26adac1dea8a11cad3a21b52b7a19603cceadb1b7d04', 0, '2019-04-24 06:38:25'),
('2a8f31733b4f3144a59a085449ce69b695136c5d741cc1d82ca681603314af89fd039cad9c739bad', '37e75a088de6738e36cbde0718f5f9b57bd1f5cfbb4b5aed935a0bb15492aea83a2aab44cadfddc0', 0, '2019-10-22 02:51:28'),
('2ab03218d8ced5c3d80f13b9cd3945937b124cb38e6b18c43f94235b4e3469d9fc2f60844cbb5908', '609f224bb237f5faf69966479574eda8c918ecd824514cb34fbfa49c3874a139e84a344cd00df9ba', 0, '2019-04-04 09:43:09'),
('2ae489d17c9b08bc9b60987652d83b120e7607543310fa59aaee48f9f8d332e70138d4b1b1795950', '02770bfd612a696cd9cbc4f8cd1dd8d8e164091d4ccf47dde9c8db31c42f559260e2d7ec41d1fa23', 0, '2020-02-19 15:47:25'),
('2af69f004a25c8a7b48a2b7155e364cae26f85b927ad9cd9aee8065bb3ffd2600e67ed0e615c7ec4', '6bf8af7806cf7d7fac55804ea8ca182a94cce719d6a015237b109c2adfeda643f996ec22be31ec19', 0, '2020-03-08 13:53:43'),
('2b4c3843a394b5a0dd05fcbfae84b12b07f760c3000806e37da7e32ba237832c2528bbb23e361dd5', '33453c789ec7ba6458ff95170fdd243c84cfb170e6163b1bfee78e3d9c967d3aced1ff72cabb5bd0', 0, '2019-03-21 10:43:13'),
('2b5b421e852d52fbba7ffcc1c97102895c469f59dc5668c406f1258ba28fffd771d756b94b11990f', 'faefe41ab22dd2a589b776f9f5f660f68edc1ac65bfdb9b0ae065f9c38518dfe9355bc32db04dc19', 0, '2019-02-08 05:25:21'),
('2b624bdcebcefdba1446280b3ce9007c45eafbe9f8c15cd15f24a4f8b926b331a8feb4f774babe8a', 'a4523ada15779d54bac8fac5940309afa984a33150e5912f4ed295de3eeb210cc31159487d42d94f', 0, '2019-03-27 14:15:22'),
('2b642f5ef6bd4ae2c433ded444e3bd10a5eb5df51d6e7d63ca196d547fc7b537e3a1430e21d7aecb', '683eda87e25b0c4dbd0f866dca32e38035e12a354417e60730b5a687918cf9dc83fb107968a05ea4', 0, '2019-11-27 11:33:57'),
('2c220d6ba513466f892a5ad2355430a4b5dac2491bb928b39da4cf74ee41d70a1034a6263e83e9ba', 'a0054b9264526a30e657320325ede34c4c2e32073ad101263d3961e0586de560ad5df3b83cd25a20', 0, '2019-03-29 05:23:13'),
('2c2bae8ec809f8d4bfed5c835c4203fa7b4a85208a63f634d476824bde32ceb3b0232cf8145eb241', '862640aefb1525a70cb4126f11e1eb95d3f410375f674cc3c20f4bf293971de7aa06898b76240158', 0, '2019-04-10 04:38:21'),
('2c3097a687c8e305838f82d0015417d9a5c91825d0261057b4eacfec31f40208fc32b1bc7b48ab3a', '18db89e95bdeadf3eb66dfbc2568ad0625b189ea0cda6c2fff4b1378597c0f8b14b648bcfe6b5731', 0, '2020-04-29 18:22:23'),
('2c7b901e4632748b49e9f1442ae880a3c0fb56466b904e9ffdfc7981ae7344340b865d575b547170', '4cfe7e92facd196267b7614d6f0b5baf722c786e8193186fe8a3a4f869e030cac570260222327f4d', 0, '2019-04-27 10:20:08'),
('2c98c5b887810f9aebbc3beebfa6d39fd3a90ec3331b0ec11698194c1b8cc995d2321f500e97fb32', '84c2b27c465a8a2fb2105bd796a7c3c45c15572bfccee36aaeebc03b83f9afbc8bc31cdd120a57e5', 0, '2019-10-08 07:14:09'),
('2ca153bae63fa746b7910702817d121f1592c01845bc64d8acc86a94cd31ff99610e9c8c3fc09cf4', '0c7e8333d398512358507d3660ad3a52a18f586d5fa97817c7b6f59c2efae1815e1e7eea0ca1c7e6', 0, '2020-02-28 04:22:48'),
('2cddaae3ad01c71b5362aeff592cbb8ff736f72a0968464d3fb396114093dcfe77e2931b1498b151', '3ca11ec816948f21401aa4ba83069ede8e2427e14ad12721b0dc965799eb77db7f6821da45f63641', 0, '2020-11-14 11:33:43'),
('2cf78f9dce5f994a5fc44843dbf62abb27b84aa87a448bda37a2e8d688af497bec8efeddae2b6c2b', '2ab04bc00128171a98af20e9d474741e4a5b5798e23eb7d04561ad5732bf5f300eff172fa131cf24', 0, '2020-03-01 12:36:47'),
('2d66ca84aa6a9bf22f58b2a2c5ba42319cbce81aecbcebc5c10eb1f69da56e076253377ae18e3ecb', '62cca7be496d978aad7f5a0cf037dfce5325e9f08c8d72dca10e9e88d3c764a64b2cef704408efc3', 0, '2020-03-08 13:37:10'),
('2d6877ba6adae34e2496c73fb5a4dc6ef6d2fd635496d09faf7eb401baf550bdb3990b48160465c8', '093c641036b39420b1f9f42453b696b74f47a69477676eba2158d44444e948ef08f1143a6745ca17', 0, '2020-04-10 06:59:37'),
('2d799bd8c608f677ce1a7782ec8983c193fd83c48eb9b1090ce04ed2003e58d041f38f9337e75053', '0f2ec9de557c5602bbf3b5a94950ea2e89675aa043e962e38f5728f74b99c67c488e8557496de168', 0, '2019-10-09 18:39:15'),
('2d7de7bc76a65d20e1952dc96f3e5efa71e453480d78e888c97403bbff7b88d97d2484f5cdc1f114', '0e2021506cf1b73c7f0fdcb085fe1123bd56f78329d07ead5febe8d9ff70858fa924c701bf901d9b', 0, '2019-07-24 05:03:26'),
('2d833d2d675c8c167d5bc374625584e3b033a8cc0439c9fa5a69849cd995a72f0d0d345f87b3f17c', 'f2c1478772ab2678630497b1408b1ef561602128941bdb61b74eb04ae5ccdedb1a4ab8dff98ee36b', 0, '2020-05-22 14:20:25'),
('2dbc35dead0c18f67f2d6080f679f97f7c72b8ce8be8d0643a144fc04b9d504195d9fdbebffe9d1b', '634a8bc61d5f088f03bc05ce9d16bffe92ad266df36df4ee799f25167d02d13ce2e97e6912cc7e46', 0, '2019-05-21 07:03:29'),
('2dbc7cf52b19772277d1029af5b32b767fd2cbff7af325d354a4bb649b6d3df32a0e453d226fae97', 'cfe2d7521ff731099e7ef2ce673b9a6ca0187248d6e2f67d0c6e12c490961495a80b281d98fa4a6e', 0, '2019-09-28 01:12:55'),
('2dce9aa82b9a72c1215f3a053209d3aa5aa1f11b3d31d5723774e941f52b66a539a5d6e41bf2feb5', '0eaf6be7c247f3c9e23f6c78edf782376f7518e7875a719ddd8547538ed817ec3211b7ddffb004c3', 0, '2019-02-08 11:00:29'),
('2e017088dace713d9f792fa6637fe1838634cbd0a248d890fc7b85bb77ddadaf1c6dd53853dabe77', 'fa514a0081ecbb5063607fbd77ff821a6dbc652f291de0e84b010ae67cd7a0209ad26f20f4e0da1f', 0, '2019-03-24 03:41:39'),
('2e01be67960a16b24bd1c2248b795330e07b81fec5c2d8af98770433016a1f74e23109342d9e62c8', '903800bc656be18699c4cab7919e846c8c4fed349cbcbcac81d1d46999eaca90e618c651c7178060', 0, '2020-02-04 23:31:57'),
('2e828b1c17951abf8b412ad7875e2f374a5bdb5812224825b1365eaec60484ef0be3b8a8c5d2691a', '182eec492708dc7e1e7e98da3643212e5f4e1c181369901dd1a3700418de26a51e6af333a315fb53', 0, '2019-02-14 06:06:52'),
('2e9be2a07f4c172f3f793cbe1170944fa1247384fca752c4a388f8f6ca08fa25ffbc3537fb2c5c88', '10c35eb85b962a2ba7a64ff159af22f61ed9d7e218391c2eff09c260c225a54fa5d2d3155e0f89e0', 0, '2019-02-16 11:45:04'),
('2ed5f0d287c1643230cc91aa0b7080bd9e310a0d0b8593546f29f09fdb287aae3dfaa29472054bb9', '9a46e5d3b97c8545d961d1d0569379fcb5be823b463954a471ff4ff827100b512441b712b4354296', 0, '2019-10-05 08:43:13'),
('2ee9521f53a8361b63bc55d39619dfa6ff3406230a1f924d16d892abf22ac7539b1449c3f6370b97', 'b5ab42db1b87c91c23eb304c0825c30c3d1b3c1c5b2f3a35a6e30b213ebe6fbbe12f6b0a8fe649f2', 0, '2019-02-07 11:40:53'),
('2f3bcd562f9ec2a5c7d6c00ea205f5b9e8c081b41a1716f39d19361305cb783266540ce03a48fc77', '3e302f45fd4b9ffce99c16a922d40262322643514eacafcf778c396a73d88d15367f1cd5a3fbb430', 0, '2019-07-23 11:30:23'),
('2f4bd2962e6d6ad6187334737918607fee2b56ff7b6ebc4d5bafe886a81806813361148016c8bd7c', '3fb7a849948434712589753767d6b28a4317d249c28b4ae5c714054ebd3933f0a8ff05727176b7be', 0, '2019-02-07 11:46:35'),
('2f632374b9e0956b1342e84557e12f2402a6e41efbe2c95065b9244b679cde1afad3dd63f0494322', '43394ac2c554eb38f806e828ee327bb09b94c3d836ce0d72f92d998737739c72b404efde9e5f87f0', 0, '2019-04-18 13:33:41'),
('2f691a5125a91981eda10e143f685b3d54d2427fe1590cae49c1fca36c9882b0e0ae6ee3f9c49679', '6059984628ef0a8b555eb2c15fc48ef0eb88321aa94f3f38c21a365b7423bcecd8393eee832a726c', 0, '2019-10-12 04:04:02'),
('2f72be32ab64412d39bad39276d24963546e4bebfc8bde1a38cf16cc244f114c7a5a3ec65a8f908d', '5a7be13c3e911a9bb65b715b9a330af8641fd6397b9a18c979a5c1da980507d4a5bcbffb9e443bbe', 0, '2019-12-26 01:25:52'),
('2fc37b12651458bd8c90b2f4eaccb0f633d49440a7f11b61e6982ee950291c756c1e81510c602d86', '87a72f2cac865e58933c7a25093319c973485aefea93dc5a776ed1fe5012700b271098a1564d9cc5', 0, '2019-04-06 10:49:48'),
('2fe6dcdf060b4b70abcd627cbf5e84308326764f19ccc7189ad09faf533b0d5efc8a37c53c37c725', 'bd5555ea20b387bda0927e12b9df6722fae3d31dba9a87198378319166a5a53a7d7b0c1aba6f8324', 0, '2019-02-07 04:54:04'),
('3020e48edcea2f2a3197c870152434482edf79cb0a1601fdd7dd6256efb11e8b6d03b568b8a59c09', '63fec055516632e5c9c349cf929d6c35e978e5f48040d3fcb4838eccc0a4240b8586b169cd3bf4d7', 0, '2020-04-10 07:27:30'),
('302f4d21f8aaa9c8a5266162d94fae854745d7e371c4a87146b0163cc04094ab804f87c21deb6400', 'c8eb8e89978f094ff9b7c3afef06db22624715c91389e2400474808fa30aabb9769a22f3dc10ce44', 0, '2019-05-04 05:01:28'),
('305cccbbec62186eb9f2f8e745bd4d08d1807c75b5474abee2dd1513ac0b3b651f4f8df858e288c2', '75ab77e0f1a62a6c02615abfe3752a6a80d680729b30a324a4d102a0771a906ae2c5628f11caea4c', 0, '2019-02-08 12:47:59'),
('3074b2bb80313ccb630f5ac0db90f7e6f53b6bc004f1022827a59a12ace2750c295d0da388a3ae60', '201dab2c6b1481fd8cc4855d8336d01590269544096e2565bddb5837be18cf221d925eea166a24c1', 0, '2019-02-13 19:21:31'),
('3104611f1a9bb416f2c017e4f906259bb6ae50b848a2c8423c996eb18f55da14f12ca23519d1745f', 'a369351e9fcfcf92321439af308a841cf261cde1e5bf68e7f1dc2b9f81a4b740a8c1638e065c2016', 0, '2019-11-27 09:44:10'),
('31ea4897e71d75e575e36b3c4fd2fe4f3fb8a43077bde027707a23e0800609210ac84d304c844b3a', '9032e9b8074ba5638f2b8e162a189896158577d74a45bc123fa63f530c9fc30b11f87a29ea57e535', 0, '2019-05-16 08:52:37'),
('32118e8b06aaa5713a7bb3b63c7935d772af04e32f219713f4b322f49545c7a8e05bbb99cd96ec44', '0f0c3139a306a108e8a969c8d1923f7fb63ef47dff9d69ee38f16d1cc6ec5adbdcd0953f1ea86bec', 0, '2019-05-21 10:39:03'),
('321a04a977731cb39f26373fb38781207414b7d4d7f23da3422ccfc34b07db79abb340cba0895cc7', 'fe0355d25e085bb39e1319347b4057c45154789403b9289dc3dc68437bc0fe3490ecd7bb9d426696', 0, '2019-02-16 12:32:06'),
('321e8ddbff5aeb3ccca6f2f7baf08121da2ce18fc8f40e18ca445e86eea64e11c53f6ff979bb86e4', '81b11ef62c7a757ccf779923bc64a864316a638179dacbb257f9e001b9435ccb454014bb72cb82c7', 0, '2019-09-20 01:16:19'),
('321f47d1ae3be7f41a522dcb04c06b9ffaae07e9550ed50e7d6f7e63781a274a9f76090675f73ea7', '2586dab2af724df5fa3bdc5f1c231244e65445ef169db3280c9fd9059137ac4face0513d9361f637', 0, '2020-02-05 22:30:12'),
('32259aefbea9ad76d7344fcb14672df4f467b8fa55995fbe711216a61579a9182915bffef3cb870d', 'a4079f8c0a674ea8a1ac8958a19e6cee4270f3d84c09b2956d745c1b6f759766fae62b36e0aa5081', 0, '2019-04-25 06:24:38'),
('323742d6807ea3572ffde40e24992beb7e1ca03a5b056becf2f3df7af5666afcda39ab2a99405d29', '630881db8266edf9400ac9180355d4155bbc15a243dbd6a956f856fc613d2e79edbb54d54f42e164', 0, '2019-05-09 06:11:05'),
('326e6fb32b314a53e39dcb2025da2ef1f9d39310d575e165c3ea078316afc39c3e8b4223b6beb013', 'ec4e070a695c2d601c748fddd608b4779d6b850abec6595d59a6076e9c4ced45e1389519d803934a', 0, '2019-06-22 13:02:30'),
('3279e922fafbf2b1f225da193f42cac1daf7cde84e37a47633477fc1ce1058938ea590ce971f2add', 'aa8c9904bed41ad1315eca41fa56cce1aabfcf6d6dede63b31457e58f90d54ab1b2cab9224cdccb6', 0, '2019-05-30 12:06:05'),
('32b2f19c1a1ea88313a31b7db0ace2ed0c758bcef987b3586ddb163f112d3f4c737e0661001d2995', '8efd196ff4a218829263c61ec15bc2c5ebeebb72ee18407e2d093c9b672d01888da2e4d4a252f9f9', 0, '2020-02-14 06:18:30'),
('32b4dc1aef29a6cb6347fb381b66a4192bce17dd461f310e8544c99105604a1af803a9b61e44302f', '994cd51f345fcb8cef6b9d72ab9e5cca17330b24f94ab9edb78c4a44cd24a97d9c39962780632952', 0, '2019-05-09 06:32:11'),
('32bca713221dd2933b27834e1c3511f0f52ffd92728f16fb403c1d74f0b8d59dcec95d2142b32c6c', '4b4ad518b8e123bc0e303c7eaddb08d7041b634a30024332e8638750055be2014ef5405f44cb039b', 0, '2019-02-08 07:14:22'),
('32c21d46442ac09c0bf5c8341e25f3a338f022a8cd589240d0a55abfe8d454af4670199b9e2b29ee', '3f8bcac3afaa1ab69a17eef33e7eaa657255699ecf4e8a8f63d4d73878c2c1cb214ec2ba0b29ca26', 0, '2019-05-16 13:52:56'),
('32d4a74d227059b081fdfbad1a714cd3920e75cb7284918dcacc416476b3bc0b395923ff00a6ab18', 'aa719fa4f0675454cfe0c653afcc925038bbf64f0a31d606a9a197381ee0b054d5b1b1032b024dcc', 0, '2019-07-27 12:04:47'),
('330a8febbda317c9795c76663f42aed1add836ad72d2c3dc57825c4ffb1c267568e8498ecbbc4a71', '5191498d95e08aa41c86fb433718a6a2258f9e8665909b0ee09161dca425c2e0a6ccaa792cad8d89', 0, '2019-02-12 08:16:41'),
('333749d73651c08bac2f53eff5400882b2e3fe021185165f2495c20c48125942f15f4547de6b586c', 'e0d68e0a3eb482860f4bcfcdc1385845cf7883a3d72282dfcc5bd18bbb7a0ef15503a7e44dd6a6ba', 0, '2019-05-31 11:36:38'),
('334f526bbe6306462fec66c80eb57b8757aff2858d56928d7a4683abfc38156c63fc68d6bb4e9917', '406739d80e02699c633348857ca5a594521816975f6e568009f2a7ab003f96b257abfb328b6aada6', 0, '2019-11-30 13:21:05'),
('338834263378cf02d0987597c6eddadf4d01ed8199127d34d586a69c9be40fc686692af087dbf42a', '60d1c1be17d3b6c44558e588eb6a00baf5c8551e3772af6ccd4285027170f8fc5f1c20b3572c0323', 0, '2019-02-08 06:37:25'),
('338f79eed98b709d3b2fcb1d3142362cddb9f4dd3e334cbfb0cd2f87057a4edd3902ec72c3808ba8', 'a6f1709a124c96e59878d96d60e12dc1952b491427f373fef25e948199a8b7655817b3fd67d59f52', 0, '2019-05-31 11:43:01'),
('33a7e926c81031730ffe1e589dbbf52a365879f534f2ead20e5fca98ecfac972df6db83be7d61252', '339f176fefb12c0fc54b5c9b9d6cc2ee75ed2f06a7df529c9c1a2f753cc6a9d2589c7f92c85c7354', 0, '2019-07-23 09:29:42'),
('33aa4528140454c88cec81dd9ca631f65c6b9e7f12a260991147725cd29b15bb16b2cff456b66dc3', '104e8ceb7b6b64758e87450b6be1228c65b6c3bbcaffa95969b1d9abff0762ccbffbc1b3040579ce', 0, '2020-03-12 23:59:09'),
('33abb1ef54a2634876b29435e9c15a51a641dbefdd72d6932f1db3809a796ccb643abeede766a6e2', 'fc2e61d72c3340fd1ec7d12dc5c9af02d8d8d229aba835619aaf9d5c8c5d3c521fba6a04d84bb583', 0, '2019-03-22 04:50:53'),
('33c8d3155eeae15e6a1cddc05a30bb0b46228e77289f9e99f89131425de54cbbd3909efa9514ec0f', 'd50e267c688ee7758e921a1a0c2839f8beec19883f9eb89fac6f465e132e31867179dbe0bfc4b7cb', 0, '2019-02-07 07:17:54'),
('33d76e87d9253139d40bfc633e0af8a26d90a21d238fe59051a96cf4f89111a5e863d736c7af0a6e', '5a592e0f448d16e33178931bbd4e3852a188172aaa7fcef0416fec5193b0f585bc44933ef347a765', 0, '2019-10-08 05:35:27'),
('33e6fda0f57f55a6faeb40b9fd03589639dd15d8b5df76f165ec736b38a3f6d99bcb062b53243c2c', '5d28363172da4f60a84ed3a99a80196fe19298bf046bba71e02ce9d5ccbd594884d4760aceb8eda5', 0, '2019-08-12 19:52:06'),
('33fbc99bd359b982b1e5aa34492492e2a62943bd47e53449823f9254d2cd3a3d60075851984f8584', '60eb9ff7de20fd5b645af53b852c777381df05bb37c64fd3bcb1a448fd2bd3f64ce77df0ef7e28e1', 0, '2019-07-24 00:50:08'),
('347737a7fc3b9bb669597f7e581a5eac54babce114b433ca611e7ade4c480f4938cc0da48831a0bd', '911bbaedc1c694b1a84ec117adbca51b037442b0eef3a3fdf1b0197be85cffe23460aebb4c4e17e1', 0, '2019-10-11 06:49:51'),
('347f75bce835a051c5e6d6dad90e13f9ffd0f268ebdd0aa2e71e1f692a6b439003780ab940f77d70', '0f06916dbf046d71be1f8796666446d966bb4d23d10b821b56c08ef2d9c232b5c3863466e9967d20', 0, '2019-11-28 06:02:41'),
('34997eed788f7758f1b30bb46a59430115784ceb14161682762e01e33d38601a89544e6fad8193ca', '085cfbb459901bce27860a9f931f18c6421ed1e9c27e2ed0f759a4b74a5e4904dd48ed37104a4b52', 0, '2019-02-08 10:51:11'),
('349cafbe5fa1d8dfbd3c1eb667c183c610f1bab2623efb038117c9e703ca7df11772b95ede6d01d9', '696a0299d6ea64a754af5f18e72405c95db11534f21edeaf5ab08464a14445cbdffa7d6a5308a3a8', 0, '2019-09-20 00:23:14'),
('34b9b6fce1530e76e57e66a04c11ad47590011b5bc11e779c6ae1aef5a5b5f7949e0fdbf60b12e2e', '6af66e9ee9dace745bf5f3f19f06a51b250b0c65bcb62e3563dcf006012c07c08fc5c1d11fab1c42', 0, '2019-10-23 07:39:04'),
('34e28fc756ca3a1d0ffb441754a4d88e4ca31fd58ef1bd8a5ca6ce89b36a9272ee07636aecabed6a', '8ecc708d1c7a072834de83f2029689d3edbb4de5ac26e9f516106233d2fe577d17346bc15b038417', 0, '2019-10-12 00:49:19'),
('34f42c734aa589a5746c26a4cfac3d37be66ac036d5ae147636c2742cbddc2f76e6471792375c5d6', 'd84cace6c78d826a13cc65a239cfd848b70c9d3bab26a94832cf184e5f5b9c2b521742f252d4f092', 0, '2019-10-11 11:42:18'),
('35183e3d743beb52331e6fd8f30ae63fa9abc86539868d9becf0bf445f1f4bbc17bf58e388d41511', 'c7923aae64caa87046ea1ab77a4b94a9ff381342af6f809027c44cb7583cc59051b3224921cf5967', 0, '2020-05-24 10:33:20'),
('354f9ff17cf9aa6022c3741a68c303c4a92d9890f954d4520bc9942e8683ae0a698382f583ae23c0', '9807c3cd2f0414b04c267a4b4530586d6aa1970dd99e7d9f252eff553fa73c516f0c6367fc13a734', 0, '2019-02-16 12:49:07'),
('35821246396dded7bc73cf5337b19bd1c02981389374c5ddaa718146d915d9bc2c2e0343ba6d040d', 'dad2dd7ec087414336662d8da2b4ca1436c47d6e8fa2bd2fc91af3bc74344c74abb985aa3a3c4161', 0, '2019-10-10 02:16:04'),
('35e1a48b0764ad1feec46db973526f0997a1fd50c1869cf48fd264ff8096783b0f92b54892f8d1de', '5863c1781539f96856ba2f0acc567e08e510b99179a218e314d268409f3e6e56b9901094f0256c40', 0, '2019-02-12 03:50:03'),
('360dd64bc9af7b639ec698aa85f31f52ec4e4b8d7787362ea5bffa898c2c42a1edb21e77a74860ab', '34dc3185136450ecc5666d3862fbf796124f0a01cc21c9350679ecc9110bc09bd5f25a343dd2f902', 0, '2019-10-05 12:23:51'),
('3617b1549d4bc501b7cf81f6f694c677d7655e96432271d4e31253bbb531977e62f3dba4d0cda64c', '649de6e6e9963e959dab56af30475ef6901d3a9d477f7a751c0b76085d45ff791d99afd679af193c', 0, '2019-03-22 10:17:45'),
('361fb6982eb41f5215150d575e7d50befe5697c3c93b75eb8873559426c0956b093968ccf8d7debd', 'e4efc9cb63425de86b1a5a5d0744ff5cbc99c90729649f3ad940e542f5e38b4ce6d73ca007504655', 0, '2019-02-06 06:45:43'),
('3651e6524173373d8a5227db50278c285eaaa6d647d74093c9576b2bc52a266f7ffff56bc901f32c', '369422bbc23bf74b42f169d8b5bf393ccc1a176786f1db4f60abb996537e05b1139cb7158e8e46de', 0, '2019-03-23 11:41:19'),
('36a0e37825e71de4589dde5d30f38c4a46c4f8ea604f7b3b9f1afc6bce9ea62f176eccd7661818ae', '6c7dd3a795df557bea998144ddaeb95d6b693692e58adc347b189796d58cd2bbf08ae025d0159aee', 0, '2019-03-29 07:26:12'),
('36c93b11c355066d641683a69d9692183b6769bae22999604c17e2d6cf44cefc1aebce063fd01b77', 'c84140b88675158875c435109d49a203305d73b3d3bd77cd45f2ecc94bc74f9945ee71da0228d21a', 0, '2019-02-07 11:01:06'),
('36dcadac16c88eeedeeaf930858a84ab8cdccb8d75086d54f41a805d130accac52148a38f0ee53dc', 'ff13ed3d30c2e77bd47dd054a3bcd4fd861d913d66c665d7a5bdd4cc78a029b35f1d4beb798a13fb', 0, '2020-05-08 15:52:33'),
('36e9e69c3d2b3b9a5f8d7755f5ba20c049314fec65d8860c3f1742366fcdd21928265ad2e9690513', 'ca827952403a06e52b572fad11fde1c7219f391472f807381583f5c56ec141e40b481eb7f20e1c10', 0, '2020-04-11 13:00:07'),
('36fedd7062d0641163a9b5dca47d6cf566f410cfe9e0fa85ec61884fdc1c2c3858988995a2a8daf6', 'c1aa138c1c0203797d5ec5a36666937b06c2ba8681e7ead25072d04af42b96ce905f21e74dd11a43', 0, '2020-02-08 04:43:59'),
('3735e6ab73a0ac622eaa5991e0625e1b9ca926ce87f38b1251cc61780052780818a299181c1b9541', 'e3fd9656031e8fd962ff78d0a2837c651bca1e8ad6fffe5a6ecd146037ec5598d8dec38830741187', 0, '2019-04-24 09:01:42'),
('373cce626705e958b21f97c6e7072d87dc8a00ccf8fdf1e9d0ecf9a216c6c2e458f78a2b862a586b', 'fb0260b851d46abfc98be6a84e9e9a9ab999e230a12d65906fa6bee962357e6481e85a05741189a4', 0, '2019-02-07 10:32:21'),
('374de6f310d0a70b54b5744c18421ea324b9f49a81e2bb2aa5f74227211dad778e64e9654161b177', 'd727da77da951f100a4fa69caced3dc5a581dd58d856c999cb1b322ebae8ef686e35dae8dabb213b', 0, '2019-10-15 06:30:37'),
('376fdc5a2f84c364add2dfc15cc1af74353231c8550e7dc970f989b20ba6533754d4f3e710845918', '2410ba4d633f341da0f0865f4b1bc11e9ece327b45afabd4d6443a38ae85aaed94886f596059e721', 0, '2019-05-15 06:54:50'),
('37baa568c80db25a7096cc0a85d1a14c3a3f01d7a5ced0ee14cb757c038bd004fd3580f3852660d5', '03b62635e0d25bdbf719536bb1b7541b81fa5a95ad14f65414cf173a08ef2d060c69fd601ef76b65', 0, '2019-05-16 08:00:53'),
('37f6fa928dcf61bd8674eefa16263ff291722322a116354a4f1da4ad1f9669c69b31cc06a7cfa721', 'a6d5cc07d5b3614381f9d8987168b28f668b6607b678942bbfd93ee2822d524c92e69de48be6f275', 0, '2020-06-04 10:37:15'),
('3842b2a4ceb8db1dea1025480c69a7fec5905298cfce2d6996a5713143d15aac2cea872d40fdf8fc', '5bd584bb480d22fb0a641afa6500750091f3fa18a95afdf6f9d61970c0bb2f9d918faa01e9b849d4', 0, '2019-10-12 07:02:33'),
('38486947ad7b54517d541b1cb2fbfd6b7344446911c91fd84175b34bc365011a9672c3bde8f5272c', '5ce6920da6fbf465bf3103646d4098b104b37a0c2d6728681a145165af1a26ef66a6a3eb5d8310b0', 0, '2019-05-04 08:33:19'),
('3864ac33f5947403e70cb50382bf61a155d9ea6eecdbfdba40cbf3fe4701e63f556a0847561c8a54', 'dad74e9ab024abbef61709ad70923c073ce81094b85195d954fdfdac9cc2699a112581535de35ebf', 0, '2020-02-10 23:56:56'),
('3866dca323a1fe9ff45aefbb4a5b8e04898109c4cf5bbc9aadc6ba99ba7514128b2f19d759c63d5d', '61d3dbe6c57f4a5fbdf148cf83210fc97399bb75108cd604991d79294f3b2902f4f4ae61a4516b56', 0, '2019-03-21 06:47:34'),
('38853b670088137e815d5a4689848c15cb5ce3d27834cf248e144e592503f72627eb4b3664312c1d', '8adf232acc8d7230d6bc5f613e6f9b3cefe77d898d678b1ef942187738cd641ff43673eb69b4e094', 0, '2019-05-23 18:37:31'),
('38b37310a679def54121488cd667e1caa266bdcca5a09cb95e86b238b2c08549065a1b7e8a4fa6db', 'c6d23c1613f9ea7670c2e9ff5cf48cc8d31ec352b2c172d451be57693e14e545d5c09c69a6f9eb0c', 0, '2019-10-17 15:31:44'),
('38b8a432d87273a6ee1b29d2d5924370bd4aad26ac79b25471c73eeb56573faf6207ad593b6d9338', '01861e539ec3aa7a1539b23f92fd4b7609c6234d4016bf2291ef910a14f5969d22d466aa4edd14a3', 0, '2019-10-02 07:51:43'),
('38f63068dbad3559089a1bfdc93d8f80ea85208ac3669f523d71cb338bde7cf28f9ed7b426df4959', '6026e147bef5929533f82077a85c9f6fb0ff6eaa17c628d70da0b111f6079ba78c457671909fac7d', 0, '2019-04-11 17:43:52'),
('38f737b8b950b6f2c9218a392855fc7f1c22364131310fdd4a8dd86ee88d7c7fb3b422d3f9742bb7', 'e96d602597d2993193ac0af4cd7ad52a80d978a4f2cd5eca269caef3695e6371b04c5c9eb97dade9', 0, '2019-05-09 12:05:33'),
('3909458ba93ae453b533cd69966349d3eee210152056f4c506fe2cd43c0dd1b15e4cd67a7cbef49e', 'f383c97b6fa49867144de74e89d848ffae0730fde2fd0c33314c6338dd83eaa9963c9dbdfb8f70c9', 0, '2019-02-09 06:03:20'),
('39249c708ea42d9a0de27ce3f04fd9e7b87e63f6e4929ce2d12b0a9dd48034ba7476b33b41c02dc8', '8871cdbe805059cb2aebc2865d2f3f23e571e2b6f461c16cd7f660eaad7f87993300bb5983d40c69', 0, '2020-04-18 12:19:11'),
('393f82cfa0e1f2e169ddebe972b8d4234aa978951d348ed932184e7a59baed12ee07d067c7357980', '6eb9a1306f8033f92a55764264d038b75ede24d9e544f052fc30a1b7f921dbc238437a42cc60f642', 0, '2019-10-08 16:55:09'),
('39604fcbafc252d1aca8b4316fcc489f5c87320f86103874670501dfd9ccfbec29874fd625ee47d3', '6c9a5889c41c4572b5fbaf117e4cd0695349f8c88f96ce817028ceb7526a35aeafacf1199693ced9', 0, '2020-05-17 10:42:27'),
('39a7decac1e2dca16d12d3ac862966c394a12216f0bcdaac60de7087962138863ee26224e8fb14da', '1d3c85bdccfc0cef361ef1619c2b9558b299b2ff74a83dc7b8c542912dd2081f16bed73847e64b95', 0, '2019-03-22 07:29:43'),
('39b7c71cd843d6933efc111de29ab150802fcbf669bc657c8972b63be0c9f7a2f6be92046fe45370', '3181f24ef2163a11e3d8b8eebeeae13d76e9b1bb8733a0836e678994d360fe4d3ffe6b12c63c5210', 0, '2019-02-19 08:21:26'),
('39f6d2ad0f754d1b9fdd10195bedd9dac090c385ab54dbf180d3c3545c96fb2640d197ee4ab6b60d', '489351cf76e3774b21a6a93edfbf605b24f560ef7e32ca132d6dfa0b2634111cdf328a1969b08054', 0, '2019-02-12 10:50:26'),
('3a10172ae0292ef52218a6f14e1f51ee551cfb68ad82785c3cd5a559aa5d38dd0a6206af1f831dbe', '6f238c81f9839081056a197692c35cc46c418a541f0c3819c3ddf509c1bdfac85672f50b02ae8787', 0, '2019-05-14 10:19:25'),
('3a2f7caaae125379347b8fcd7e7e97e48071caed987561c43f3b6ee77b8ae7b57bf93222f893740d', 'd7b38743a12d710ce77b4a7b2b48b6962ebe95630e6463340e54426d93629ae737bf576ecae68dd9', 0, '2019-05-17 12:33:23'),
('3a5f173da91990877aa0974bce337d2b967fc823d83cdd2b304123f2b3b6daae3a911e1108c0a12a', '4a3f63d826ce53147d45d72488314d8b91f8ed8a4e3003b0977667170a292f8e8009ec68d6dca9a5', 0, '2019-10-12 07:17:51'),
('3a8316f9d5a464aa5e60ddde0e41b70609f82c5de23f6673c531951cc1f5943519f70b5329ebc92b', '409042a4b481936da712a0d25bed9e1b8f5170a9321fa9304c5155fc1bf810d1681e29e58e409a2e', 0, '2020-06-24 10:33:00'),
('3aa2d402bb6c3b9424e2e0731335355608f776c12680c6077a0458e8c19b8de71e322a704ed605d5', '361e0df8ae6f0a5673613a6490bba36a7bf8d5f9731e6ba034de6e96956d27a565ecb46f2fbbd712', 0, '2019-02-06 10:53:52'),
('3aa378fd6e0a25b1c1ce52cc3150f41e776bcd1eae1c48735762ce12778c7f7938ff99d057dc9530', '02eb4f30d61049d3a10e30a974e818c3e457ddd70a89da5e5f3c733d9a12285ea746d4f440be3157', 0, '2020-02-12 07:46:02'),
('3ac0d6364a02754d5ad15d109983c7251d362a4ef15d631abd00a1a4a24762db6e597daeade9da71', '101a51810cbf2f8ec47757d56014a96b9c48fd83023d4eab533eb1fab550588912408ad010ccad13', 0, '2020-10-28 04:34:10'),
('3ae124a6e881d48cd125b610c8d8ebe3b83d91e57e513bdf0e286e98682f404749345af905f79c7f', 'afc7511a7aa4333167181a7f423a8a0b4684496f75d43651a1b08a809e6a450e280b7fb36b6ff266', 0, '2019-02-06 09:25:07'),
('3aeafd843b9cd7050032a9323d3438c4f99daa1102c2f8cb8cd0f1a35bdc9ebb548d0b9b1b7f06a6', '408fb01cd125d80481f098007355abaa590fba3eb1ba6fd8c54d53d132ac239e52eb8cdaa2eb7dc3', 0, '2019-03-22 06:02:56'),
('3b0a4b014d10fca8b15fe1c6be409f0757e9cf5cc3d0c1b9db31daf5ad7dee8593d55ebf045f2850', '1e344a490ec74b246fb891f6ee01eb62f8dd17c6e598d59c4f4da74e2f25f2dabc7083084cc863d8', 0, '2019-05-06 21:08:52'),
('3b1951f8aa742471c6724a32282228cebbdea8ed0e0c2f286d5042066e139df0f5268f1ee8e21d69', '2622813a755979a4d642127a4218e15f36c57be42193ecf04d2e174c7c823c6bc674454e3f9c173e', 0, '2019-04-27 10:34:33'),
('3b200bc45fced89eb1d0e1ddbc24910303ebc46e39d74740992b0f9e8438a33634b9f02eed88da95', 'bb4f247df2dc665b4fad297367b8623a441f09660d200af36ebd2e79ab4437056957ead6c76fb1b5', 0, '2020-01-16 04:35:35'),
('3b84fa3d81a89a2f534d0e72c6c716b93d329e45f54ce1c4908621a67b44fef8682a9511f61d2ada', '3aa2b7a64d78e0aa467bc7b212f2cb86905643da5e67a8b474d0ae73301176a950193404daa0c660', 0, '2019-04-24 10:44:57'),
('3bb64372024c55569643a49c60dc0fe3ff305cd7c669d3df79e1300e1852c9936c6b14417bd894ab', '77ac134fa1962af4e528e88adc8f4475b976142d730f093233e77136486bbef39c7889849c79a283', 0, '2020-05-17 13:35:23'),
('3be1af3c23809681e60fdf64514234ee6aad8a063fea211227f19ec48c93510ccb5c347e42405b00', '426510cdb0c0a62089ed69f49ce8831eaa5debee9c3a96e5ccab70cbca395e26ce52185cad84a547', 0, '2019-03-22 10:23:51'),
('3bfada9ec23368175512508aed8540151c4bae283e1b0e205eabbb8bb79c6a539aedf9562f32f667', '4679f298ba11b7b0562af918cd159af719078df8134c67ca45a7f592a5c9e881aca029d82d784c0c', 0, '2020-01-09 06:03:30'),
('3c0f83bb64dc62398dce5e7b982d77075b5477ee3cd90ade7e15912d0fb086f6d313636a1cb0edad', 'da94e49e7c3f4e6adf660a289e22127fdd5e8d966250cadb4d94fa7417067bcb2d015f7c81e20d8d', 0, '2019-07-27 10:06:20'),
('3c2a29a5ee6ec3e7cddb0dd883eada7282bc79c6695bb7cf09006ed1a47ebf015fccdd6456e835be', 'a8dcb7d9f00cec0c60fcb5c54f7ed7afc544446a50442197ef48908cba8a6d5bc45c300ebf19e6c4', 0, '2019-05-16 10:19:48'),
('3c35212d81d873ec0fbd997465793cd86467f15af365abc668d90c905b11e4b0c8f0344e38048793', '8fd0013bed678202a87f2b59c3fd6a2331154e231d8faf2d318c85e61db189ebf23e0f03cce93943', 0, '2019-02-07 05:13:05'),
('3c85c1b0e3bae6693284c0481eb6587ae26e60d40aa4604592bcb7c1da0a62bc16a091093f324ac2', 'f5e9818d79b889ca9c42127f4f56c9bd22499cdb8fd43ea3acae866af54b7bf1a03db987656cd4f2', 0, '2020-04-11 02:37:48'),
('3c92bb389ef3310102be612b4df23d0ab4ff43abf85c86a1b51ee016e91e687b269681eafebcd17f', '83c0015dd9b207df2c6c0b5bf6df2cd08390da987db2ff49f05e0f5f4432d2b6ace1611b5bc8ca42', 0, '2019-05-23 06:47:15'),
('3c999b1c90973ef1df38f319e9e433d5a91da0ed142df81cbdb79d7d1a7f3fbb2efb1ae23d8fd77e', 'e8bf6818747afb5fd021b4aad0bb32945f448b0134d6ec0204e4ce58ccc359e6a0d1b44042ad381b', 0, '2019-02-06 13:31:12'),
('3c9c7fed118cf3cafd03b92db203d64947da4f907142551cae24510b401e38a8b133bb35f0a6cfae', 'a512c8f350a219f8ccdf51eeb07c74d72204aac776c67b877b1abb9b1c5047c7a681380449d52aef', 0, '2019-04-27 09:46:52'),
('3cd189d79d5e0d217b094152edd0ddb74768bfb0395f3793c86dd16ca9735fd042e42512632f8460', 'bd27c4e921d537618a662b4f3f37f44ada4a482069ab1f71038756bc43b416e0e1138b8ac89756eb', 0, '2019-02-07 09:23:36'),
('3cf8ba6cde7af8dbfdee2ff168f164f4378f10f87a59d6084656d6c570df2f7637c3f9cb9018a5e9', '87832a8cf091df4a70e0a9361d49728148e19a2b24edf76e231ec2210272bff381f89976aa6f39ae', 0, '2019-02-07 08:49:56'),
('3cfe8f6b849f64268a19da83391703daaec3e6ca7d3fcaf4890fb28cf9e3eb437e6085b09a4baf20', '91fdb5cd953e045ff3f3571f812799f55117dcc79d9d041d241d810571fc645f154fe9a2747c04ae', 0, '2019-03-28 11:06:55'),
('3d4010a6f8813f85353b5bf34cff4935892d618289e7d820146f3802ec2a334681cc4d2557295b46', 'dc66cb7e6a89fc77f4c2200445a1ed1c58b4a940caac62f32ce96badee882f5a7137a5f11c589f06', 0, '2019-04-18 20:35:46'),
('3d7f1b6e64a6afd76be07778e3653a71f4697cada71ae26eabad75ecc2cc96fd1eb5bc384cca4ba1', '8cea7171227632bab9b5573fc49180d117d34e3ae68f52cafd2d9cce78cb120fa4227a362ecbd9a5', 0, '2019-07-23 09:28:25'),
('3dd9ef48c2bf99952f93de75c8626690214d2248a5917d38cc60733c31246a7374eeb57fea4b1381', '4cddb8a6a534aeee71bc2c95da49fc329b084e646bd7189048ad0c47b50e5e8eba7d963eaf591809', 0, '2019-11-28 12:17:46'),
('3e12fad17b31bd04c3bf4c5edbaad370d6efdfaf262a2c8451d57c4db0589e102c41d377c01d3672', '8e4baae4aa3fb3318a5e1d8ba9474936da48615c9e6d54e099d6c8a930be6e7112ddfbac0512235b', 0, '2019-03-15 04:28:04'),
('3e1d9439d07bafd3010eebfd0b1327dd1a86138aa19751190d20bf207c3733ba3072ee32dd267c5a', '3908fdcff4b1f6bd676fe75a0bf013ea7232f182408d0e9bb044752a975cb8a38d2465fe3fa4d2d0', 0, '2019-11-14 17:41:16'),
('3e48fa03d4acf79df7a4e1c34b0681364f97f6454ce800aabf66e487ef24357f1ab16c5bca022e2b', '611d283012317c02c7f121f4ddbc0c2f2584e20d2139439416fd86f3c81eb6671722d21db5970f73', 0, '2019-04-11 11:44:39'),
('3ec41d1f019da2bedb6a58520eec961b25d78c0adfcd071e4fd0452fe13d0a3e875bab4a1192cba0', '410e086bacd6f435730a0bd7ed5cf90892777d95fb8285694f527322caa8085e616de7613cdd4f98', 0, '2019-10-11 07:41:46'),
('3ed06878ec04bafb4dcf521c42986d6b4d530936b72afe3cdfbb6d723cb3f9fb56ece5253c48d222', 'd9f3ca0eae1a6d0e1379e526187d38c09a5568836fb0ac233ccdb8d854fe6727910bc94b33fb0b22', 0, '2020-03-08 03:01:27'),
('3ee8d9ac83be35f415e19cb19fa22872f7e203a4a22d600054ff991dd1dac02623fc168d7a0738a0', 'cf3397ded97e40389c0e00f25ed13ba750e123a29ae210154a8884d6bca7095824fcf4a64f2c4f22', 0, '2020-04-15 10:05:09'),
('3effb77759afc2985df9944eefccf0f038405d2693af5231e500ee0bf670caf47c4f369eeb04fbec', 'd727c480fdbd810672f1d6ab4102b04cf0d4ccad5000a84a45c7582b4d313b9e93d614c08263a66c', 0, '2019-10-24 19:33:14'),
('3f26d71a7b007f0f478ff003d3075400107df9fe73a41939967fe575346a02e11ea43321358d486f', '0628131560a5438b9e576a49420c140ee3808ea2ce8e87e22accbfcaac8a8066b04185394a9acbc4', 0, '2019-10-24 20:13:56'),
('3f29b2c6d5c3f60874a782ccf87ba99db73275c076f8ddf722a79a4699e04ba74319784aa50bc497', 'dd31e394eab06a5873ace07debe5f615001abc67742eac38e549d3eb51564e2e3c3dbc2b9b690cf8', 0, '2019-05-31 11:56:00'),
('3fa8094ff869d0674b7e6ad3069b24553e94ec669c8cb170ebeb98bba5f3f9511f927b4201b2b9d0', '6f819e149ca9b2cb3303dfb656b1496e93c32549eb399e2a5725a38ada5aef37b4dd63ed98d25e4d', 0, '2020-02-20 22:45:10'),
('3fd44fa43c3aa9f92a017c730f4705d88cf962d278e5dfabc4101b2ff3acfe5c35ae5469a8b7eacd', 'a9fcef33f45e3397d623095553143eb3abff4b36cec0916dba390f6cd5ff3c7407ce4d1279c0fb6b', 0, '2020-02-05 23:22:51'),
('402e3241df101e8a6be9c9598ba6e9d2ce5254590c6a0e079ad1d9997739ee8b830472c1d7b6749e', '40ec5e88590a527eaa4efbbcd5d8a198df94f54847fc17e7a15fef9c0ee5014262871b4769eb24e9', 0, '2020-04-10 01:00:57'),
('402ed531510a1c9e2146ab56a730ea8a99e00e8c704859980254c9ae103e8ab3090f13fbd8f8150c', '6af306526e00ba348cf46f728b842f075b9adfa826e43f87c25c9ecfab9bcf5705d11969294eeb01', 0, '2019-02-07 08:59:47'),
('404b9ecfb8d16ab98bc7bf769fc44c37295bed7e8b821bda0d38b591105557536bdb16ce185fbb03', 'a1acf2bd724a7d871ba5897ba163ac7d42d41fd1daef834ae9d1e901891eb69ee35650856a85a281', 0, '2019-06-25 12:15:33'),
('404c95524bea697e088968b5474a866cefa875e899295dcbe49bae278514fd5f6813e1afbf4d1664', 'ef00421b89d1d4960325eecd84f97a5c48db8543ba7fa1cdf9b90bd469a9cc0bbd95e4a3b9b40783', 0, '2019-05-11 08:31:07'),
('404fd9f4cc5cc9ed0917bba19c0424f8bfef98b41a5addfc2ff1819a99ff436e605fb59c9ecb600a', '084e90eb83c39f2bfbb8769d1a3ba0ee1ae555c2ce93f075ffc60929af2bc0866963d309ca71bbfa', 0, '2019-06-12 14:25:07'),
('4067f4707385cd778bae84f159bb6b6c31cf85fa4edcbc1e8789d2047852eaf6feffc63ec823ad3c', '281d9adeb2a383fcb423ffad3fcebc9d9e21be730ddef97b6270c8fe1f8cef07c0a30112f97dd227', 0, '2019-03-27 07:38:22'),
('40865508f46a874d13a92df477a7e7ac93676d150823b9fe45d0f77fbbc5f89e5fad6d05a88d2ec7', 'daac9c43ce5945f6679f01a3871808626352198477d98a37b6f000a62c3a5488924f6770a35d8449', 0, '2019-04-27 10:44:08'),
('40f16bc7d127ed4f0a8ad99ec734fa7ab2c197b5f298d30ea3477c75583dc68c615498b888e6aa69', '7a5c850611f4e046e3faf6f9f269b2482e543ab7a43b57411ad75e76bb68a9ebb561311affbd6ae7', 0, '2019-02-13 06:04:04'),
('41071b710be9faedbf01a334304f98442d912d66b6ebcc2b61cfb41d85819955038654292cba439d', 'c48051a6fb991cf83edf2a16f2638de41eaf3297dd86dfc74db79b85d9fc0ef520a7d4e5a2c7a832', 0, '2019-02-12 10:33:31'),
('4121524ed5516ed58ceb3a8e403958bacbf05fbaa6a8df7b55087d59a48d25ed4fe91ca022b87e43', 'ece9c1676c5b7f07f8f4da0ab28cc65d7915baaba684456021b6fd2fe560cdbe2301cd9cd4ec1a7e', 0, '2019-11-01 08:07:16'),
('412931232abfa8600dde57e85b36892e980a8e2af5c36b4eaced62b79cefc93088d7ada3f805311a', 'd5576f87800eac919236863425f0769448ebe06d2fefa85196f7a69e2761715661d6578ca492748e', 0, '2019-04-27 10:45:41'),
('41327d3706ff3ac07c13eaeba15fcb213c8ab64ac67c418f69042e3361c23f3741c36e6c53c1d624', '229412ebf10204ab29c0089d91f25b5bf64a6fc1bb88135bdfed847021a39f01631fe298c7e69595', 0, '2019-05-19 15:02:03'),
('416815f7b6eeafe0192391cf8012cb9858de62f5bc8c093f043d45cb908423bb7faea615f490abb5', 'ae3d849528fdfeff10824d5c2a631f3445870122ee08b002b78f791a37a8cc84353cb9f7be129a2d', 0, '2019-02-13 06:13:33'),
('41797d6c33532bdced57f0d59b34495876898989a94bf97290344bb33165a145a42df68b987ecf3c', 'aad7754cbb43c616b3bd4f028fe7dcbcf92e6f2f5ea97f588dc67198798ce7437d91b1d797b3c6d8', 0, '2019-05-21 05:23:24'),
('418f6dea5ba5977c9273ac9ca9f7237fedbe7e12bf3a8c25aff9e68324c2aabd94a7c4f5bed78078', 'd369bbb4790c792b8fe22bac6f8ecee30d7bdbd25dd42e653e43c460bbd7b1e04e8bd06d1254bc19', 0, '2019-02-14 13:33:19'),
('41935c13b4ada4a371638cba5547acacf8d6653248f800801e7b0f20b3daddc1c0cd0d17fac51bd5', '87a82f1bfc224288b67dd32acae0d8555561c60fad060d3adaae7c1bf62c3f651d5887d01177184e', 0, '2019-10-11 07:41:34'),
('41b467ed5c5b64c253f7438e1d5d70ce08f048993262ade8f848123420ee835fc42e68ef02ddc35d', 'db7e1145bf22b0fd356f3b32ebda70acff40928f19d4508882d454c19d64a9ebe04765c541e9355a', 0, '2019-12-19 01:02:52'),
('41e0b743eeec83a4f02fb17a285025e957a33235f604b3a2001d5c9467d6b546f30393b24126fde1', '3a938d5475a93255c79a3d62bc17d8c38e903e03f5e3b5e11950458ae32449e55da6ba4dd879268d', 0, '2020-02-08 06:07:43'),
('41e250951ee49b24e4a66caffeb916b31584ac70bf4becbdc80150500230fcf544f4dc0c7000cb2b', '2f18aaf34b187704be153231c5d2faf6a53b84036bf3d52fad74e707f06516c2b19ca65609239a72', 0, '2020-02-08 06:07:15'),
('4210d14c1cab1e7f911332595dbae079b44c2750f3d3dd6db5cf7f59ba580935e485a23fe578033c', '1bbb88639f93f15ae9fb0f02dc98dfd066f896b93376ea7e4e5d5742443fee2bf8e6b4444051144a', 0, '2019-07-20 14:10:27'),
('4213a8fdb96f4052e047839a1320609afd3fed101781d35a2a98a088150d7349009a29ba860970e0', '567540f160cc7b987e6b07fb2e585e84df040bc30312a7676beaae458651ee0938a3d7f62c4da9b1', 0, '2019-02-19 08:23:56'),
('423ebf26d9b5080cb62ed2e5d30e2be60be9ad195eda416f64e65de162e8090852af3f03bbf7dd13', '4e83306a8e8bc9548cf75f92065d6b35cac05fb1cf6de75bddd0238beb23b2478c090f6d822eb178', 0, '2020-05-20 05:17:38'),
('42775dbaf3172f653c27e5973860e130745471ce518f5457cedda4220235570ee77bf79e1e15b97e', '5e296b80b15ca8e25f63e45a0121281159aefdeae59b7247b8f8c4c09feb9be79897762ef60f803c', 0, '2019-05-16 14:40:41'),
('42924c541fbf170e1ba8b7b57bad626ff9bfc993f242c2c8f19115080ab739c81bd61a4a3b21e01c', '87f810385ac605f7c47109227a156924be6e8bf592a8ab99ee18d36f893d464e6f69a3b6c43d3433', 0, '2020-02-12 09:10:50'),
('42a45bd35d3fa86d77ffe078432745a6b6364509ab12a79fccdfb068513ef5a315e6d1a76738ebac', 'c6e0ace2a0db38ef9667fe0f6ccbe59766219f632007258eed48b6dc86f3bc2fc5752ba3b01c316d', 0, '2019-03-28 04:28:40'),
('42daa084ceb62aa577a35a9178331f5f472720e351eb15b55ac0873e1707f765fef3a88e50989432', '104a435b8d867af1e8aec8ccc137ec7bfc216455dcfb3849b1d9780fd8ba70265d7d8d9e596ea0e7', 0, '2019-04-02 09:30:23'),
('42e38ab491957f7dbfb40daadc8ea3689d4fd4f25b5f96a6f16bda4ca823264731c0f2db65b6f841', '4f848ec1222c2364ccb4bfd86822918afc48069a508ecef281b2ed75c6868663514592d7ce0e2654', 0, '2019-10-08 17:08:38'),
('42e4055ce185ea1cc50ed8abae36f6b9ccf9886bdaa310926bb7a0ad91aab0951bffb81d5e5210f2', '99ad2972b19057fa97dcb3dddc40b637d1d03dab25e9ee4d1007f6bf517069b2d884977a21da7fcb', 0, '2019-05-03 10:50:44'),
('42f6fd12b965b418e82160fecce838bfb243bb6d0d0a5853123bbfe8a105562574623faf766c36ac', '265eb6a44cdb30a220b9fb8d343698544082bd06efdb1d29c111f95fbbdd80c551c5f04880352b2f', 0, '2020-04-30 11:55:41'),
('4330d98f9261eb85d6e638884138525370bf0c1e10679316d3160fa7c26f333442be974b645aa18d', '3dc96f9b5b1cf988a76aafbd0caaea8c67d336d64b9bbf3d605f64dbf157343da4fcffb1cf5d355c', 0, '2019-10-31 18:50:25'),
('4353d1ea436009740d17ec50eb249cc725db1e2c19a875ca9c7b21a920266befdd5b03611f04e698', '41fd65a96ae749eeb4df445b0681368d79c5a6cd3a7f7dba7d0b84ac0c52256106e6b271ea4f55f2', 0, '2019-03-15 05:37:05'),
('43762a6979be105d1697bf0f119210142c4c39a44b6afd5f45792fad0247e11321bd5fc60b6f6ebb', '5d97cfa5b710c17094a43e3a16aed3cde4ba7b003beef7066c98e1cd5aec85c345843986080ad5ae', 0, '2020-03-01 13:03:09'),
('437ab7d03eb47514010c328d5f4a194d358ebab560d7085ab88a88f4a63f6fa2cdd01ace9b5aa44e', 'e7e45ac52acfbfaf06e8e55afebfb1218ee51c7f4071fbe4df8233cc125640068aa38c9ed1c993a8', 0, '2020-01-18 04:08:15'),
('437d70637a88bbc3355d68b415b0be402f987ee5b9a9e97708d9b86b14210605bdf0e708dfa6a170', '6b123212506475e83881f3ae6bcfa98f2bde1f2419fdfc900c6f6f7c018aea986f07f4af4ed71c46', 0, '2019-11-30 12:56:51'),
('438a386a1b7197ce3345b3713a078d6d7a37c7da8097d82091711520eda2106ba3865a3d13a102ce', 'a23f7977897fc17a233764374e5dc2f766b3ebd7b8a11c12573869dabb1bc3f2c6992196e9e8c6c0', 0, '2019-05-16 13:53:59'),
('43908205a045929bbd530318f0a81eeff02e305abdd3723e0d57854e92a6c0ceaaa1b0bd959b1f5a', '9923f3592f4f2142f3523a1952992b3bf87cf2966f5b1d81f5671c897598c1860921edbcb9a07e6e', 0, '2019-07-23 11:07:33'),
('43930a438b9bdd0205a853c9698dab0166f9b06dcb021a6023c40bd2da537e235175d6929b12c5be', '5960d695b69f043745f7e76b385a936cf56af5484ef9ed04c435b06eac2d704f5c56bb6b4395c0c3', 0, '2020-02-14 01:26:10'),
('43991b51b9d6f1c6ba044370dd2f0c8d310a390904d977a705251410cfe608904d1f7eb2ab536043', '4dfc9917dde43d5b817e603da827b8d1c684660f69f8f5bff8d53e32722faec95a2d02fa97167f1e', 0, '2019-03-23 11:35:31'),
('43a7cf4d1907733ef3e8bc4e40d2c9b7ef7426c56738325298fff189ca0b25be727b304f83c3cbd7', 'c3927a561c0fe06760e87806fb11eba9390e6c1b9e3e1eb0e138f969d85c3f7fb9525f2db8a1cc9e', 0, '2020-04-09 04:26:25'),
('44327d367cfbdc5a899119ee3904da8376541c3616adeb8ccc8cb752c2651b8fd539496253d9599c', '02a1b73d041fd9af815584156ad1d61dcae303f4a99232bec9c6296f8ecd0586e4c413108e80ad66', 0, '2019-05-18 13:14:18'),
('444627ec98e973750ae3ca24c9543edff6f49630f525bd67eec7fd33ffab7091281b8f3d00364bfb', '57dce0c77a2a8221a40fa8c8413cc9c60aa364cb9c940ba56665b7a436ec10d91130ea1e14db3402', 0, '2019-04-27 09:48:56'),
('445adfd664fd19c605c694dde354bbc9d0385d1041cae54a1fcddb38adb438f707672ba57db504e8', '12b6105cd657fb88462065372c25ab759cc0823a4a6e79f04740b3f1e41d0b40e4367479f1d6ab69', 0, '2019-11-30 12:42:28'),
('4460e68509e81cf24c32dd757f778ffeae1021bfc788f45d2993408c345b8f0ee1ade4e9e2f25df6', '79a833bb1bf01db7238ce8d359a5a6aee755b9b61f7a86bbdb96528eee6a6bf1b630220fc02f4115', 0, '2020-11-06 21:50:54'),
('44658032b284f57eaeafbdea583b6c2392bf30d3789d2194fcf94f76a7c9bfc0cd2229719293cf0f', '28aa882468ce6349ceefbe1b118ae1168f60f51c4c2c351511d28aa504f364f509c93613100c3ba3', 0, '2020-05-08 12:33:00'),
('44d5d1c69bee978616c4d6886cccf5f9701bcd68183a0711ea5401fd74a4a993faa52687e216a9d0', '3c8462369b5dca5aadcfbcdad9f4db199a327da804f875153fed87d6e2ea8910396ee7aa1ce292a4', 0, '2019-02-06 15:05:57'),
('44dab84aaf99c6634cde945c297029cdd6af26c3f312470c567694ea0d5b7d930f1eaab339935c0f', '46817aa34b74e1f82c1a1cba62a29876887bfb8b866367e273f6e3a4b6eaefbee2ffc7a54560cb44', 0, '2020-03-01 12:38:30'),
('44f65a07417e36896456eb283fe782db20ef91091e2e5285777c0232acd051a00e32a3d57c97a6f3', 'a85bbc5dab9341ce5fff264c51c7ab41a5bbdecb443f02fa2184dd4a4d2d0f672caed1e9d4cf9e8e', 0, '2020-07-20 13:56:34'),
('450c18104c51feb2b004096cf873339d4eebd84f37ddcff1fa7955891c023dd86184cc1c4b8ae355', 'e837ec77567c95f71ef154c76a092e4d5d27e688f499ae34852fb3bfb6c794e77d34930d4dac7c9d', 0, '2019-12-19 00:52:44');
INSERT INTO `oauth_refresh_tokens` (`id`, `access_token_id`, `revoked`, `expires_at`) VALUES
('4512cf72d4434405ebc6336d8356331140385f12516aa3cecc44bbc70ee8c1890bb35d59b5742ff3', 'd6bfd5859c6dc88e345b08d75b68d0605c71eb48c348a546efa7a8e82d04b480610df1412f3f3335', 0, '2020-02-11 08:49:35'),
('4524867f021dd1a1a49d16706dcfb66c656ef28075fb33225fb4d7ba38d7f6aa9e8493a469b501f3', '4a61a975647a4fda5b637cdf9b0b8c104dee808accdb29348b0f923c7158d825a44ae215de0a6709', 0, '2020-05-16 11:45:42'),
('45420fe09b0f86d38de61a9d933f7490b1a670f8601b3ff3ed98c083fcc1ce03ae34b816da596f8f', 'd388e5cdd7faa6cd8ec40ee1f0670fb14c3a477d0eebca0948a024cbfdcc62c374ce9cd0b319accb', 0, '2019-03-16 10:35:09'),
('45781be569bcd70ab42a014f9caf2f3ff5e032f28e3f8009269cae00b7a2a09db9aee3f86382a8ca', '19812e2da1fe9fca44dcdca120c1928883a72aa4809fe2800edd1f84ee6144982251450d096ef009', 0, '2020-02-06 00:29:24'),
('45b43abef322d9c414c9799eb6d93daeb05201ba245b23936c45b118733bbf95218be3a57cd79f80', 'cbc89e9e383fe38bd477632bc678bbf535b933ac4f7903380fae5a444f603c477a65e093a566b328', 0, '2019-02-09 12:58:55'),
('46341840fc02f3cd8c5b641a4574fc6313c577c68b6b6d199d400097759ce7e137fadfb0a8d94d75', 'd26d8b8ec50f0f9dd403b6340223ce58952dfa43b47e7cefca209d20d9e4bc499580a4ad60dad1de', 0, '2019-05-08 09:08:58'),
('46c93c89912cbf0e73abf817510fa2dda46fcfdfd60eb8478cb54eeca0100aed8beb1b3320693e11', 'b134fb9940b975706d3be10020700b503d3b18469f96016ee8a587ea3cb8bb770a0f5bc1d0adb113', 0, '2019-02-13 04:44:52'),
('46da79f63a89ad7e493b60e75112d4d5be99ad6f9a04d02676af3a4870eb1eaf295e899e13654044', '3337f8167a61ef7131467824afa8e2c195f6118c21654d78424a4585786d6e0fbde29a510f3a5cc2', 0, '2019-02-09 06:47:25'),
('46fd433491f2376572bf7c7117b8dcc1e8358ef9b8cd97e67f452f7470a47630257be419c3e50d6c', '6d1dd4506ad6c09eb43db1c7bb0a87733d61e4ecb770fc8c364776bad227b9b3d46e455f6314dfde', 0, '2019-10-10 15:48:29'),
('471e24102235d501dee17fd16fd4b144f7b44c9460be92dafc47aab06ac433e3be14b63ca1cff98f', 'da19b72a2c49ef93cff0c9305403f84f475ea6190b055136a6e13d175b0d344a1d8b97b058867240', 0, '2020-02-11 00:29:08'),
('472a09d74812eced6112234f854644c7afc434ffb68a6784eff89b0b5dba70e7f09857db413bfe6e', '890a6171de3f818f6a31e851b4122385d1cb1b31703ede80ea66d0e3b3628bdea1ec84aad8184ae6', 0, '2019-03-28 11:57:09'),
('4733ed31fa683e4fec80dc218cf2c03d1192eeee8bb041a4882bc44ef7ca3b34ec5977d1847714c0', '84e2305504652e41dd352c2e24baf476abc259798d8997250393e071cf4bd253e38f6df920d8cf47', 0, '2020-02-13 05:29:03'),
('47b7daa4069ce2e9f49aa0bdf09c287dbda0462d01899de4026bdc87b513228b024f2bed2aed6229', 'a553ec4a01c94833666a15045b7c350910528079e509f2452fa2e491ae925722a99bea78c97ae6a4', 0, '2019-07-26 03:14:49'),
('47d62c56b3bb4fce2b7a42ed2d3145539271302e97dc576a6099924bc8a71e80bc3db3944e2e6c9b', 'e51bc12c6f1df32066d02ca44b49a59d348df341974bc225a5d56814c28cbb64e465f6a5ecddb259', 0, '2019-05-18 04:53:05'),
('4844057ccaef36df1c0b292308299dec234643d88ab209758ebd24706746f6181c2c3a7848ccb6df', 'fe362d383b38bce367d10b329d9ff606fee218f109570f90f591232e9df3fd7dc3869c676d7a339d', 0, '2019-03-22 07:25:57'),
('4854f2c4d17760b2928400f8706be85fcb9f4937163f71c46e2e5e42531a00d8226335df9dafb960', '811c7814ccbbba96500fd89e46e984567f2e71112ca987b6277a901211a011491a66c5cef47ed9de', 0, '2019-08-04 14:40:14'),
('48611994f8071c93265ee2d11013aeced7a54227a63e45c184745aa15ef45b651ffa23b05dfd4d58', '435dc391ca9aaca9e9ac1c6796a0cfe007f4c2494e8b69f0aa940b6e34a6fe6884c4191b185ff9cf', 0, '2019-03-26 06:10:04'),
('4895d28d0d778dad71142592de5054c19f6ed7b8c4dc0d1e77e202e7aa1375d2d06dd5507f8cb6cd', 'a3c18bace543dfbecb047d5c87b1e3163c0b4a3c90a543f2bc3d508b39cf5ab5b43ae7e9c3a60b7d', 0, '2019-05-14 07:41:58'),
('48a08fd9bcf483bf0c4122eac31df8bd8b63d5b76727fdfd4487a0eedab8b9af8ce9042be9557f8f', 'b5c167d3e0b2eb40a509ebfe9c16290aa524b1c1a81904d5d150b6607692e130c172922051c261e3', 0, '2020-01-22 05:30:46'),
('48c50848b23369a9e629ce06eb2e2b269840bb2ceec64a1c03a03a960431cd7d272cf389b5c9c040', 'c922859b8216a4d38941cbc40af61d6a53ca33b2bb74f7508c058cf1316432e58d647add22f80a79', 0, '2019-05-10 16:21:12'),
('48c7586f1645d291eb396e3bf4f6d263639d2269c31f1e90dd8344be88fcd19b0486cfa5f3f171fb', 'f05937e75b080ae146e85785dbd9b245221e5c0fe463e7a16e73201543c59ae913fcfae802c47e77', 0, '2019-05-09 05:40:16'),
('4926e833026c87b1a0f4a951b7e1b26af36c9514f0034fb02c2e956ba044b92f49f44fd89a5941b8', 'da956cd0dc0e75ebe8f3904d005ba4e224844ed1e854b368bc27ed64add6bf3dc90af47ac43c8f37', 0, '2019-05-17 14:58:29'),
('492a1ca84cf7f2931f68e7ad2b918aafba04e4f211e17235f781a60dd57f959e2fbabce86ce7f073', 'e211a7c42c9a32a8ed13fda2ec2299689d4fca902d0de742f7c18f3df626bc4776984def103292ce', 0, '2019-05-01 05:33:33'),
('495aa9745ac6ab493e58292a91f68be11028c8fea90d92b681879ae3362a1672277c255ec73c76eb', '7848fc56047be21891ea0544fdd3b571393906e31536bf2c05e633986103bfc10f8fab55e63d6792', 0, '2020-01-08 23:16:05'),
('497d939a1f029831366e95305adaf9213ab6c478f6ca304fd30ec850f3f9b24aebbc1386a3f31e8e', '32fa60e5d96e73ffcd2155a549f5690b52e3c4312731aab679e2ebd389049eef574dc9c56b024775', 0, '2020-06-28 12:13:45'),
('4980c7ca9c6db1e3bbae37d37112d30e8d57eb34b657d60e7a467b82c9377792d90d076c73e6db5c', 'c3e19154b849ce8483a2b3e96f43c3c360ebae8d69f5f0c313f0dd8b1093110f971fd96b51251a0b', 0, '2020-02-14 06:29:14'),
('4997f1251ac29beba65cc3b652de20cb85aad0b4f1128c0731086d36de030108e3fe01a00e5a6c92', '659b9710623b3049f0aa64d524d63a758bae9740066176248c51b9bd2511af4e92a54a6ffdf70e8e', 0, '2019-02-08 11:05:47'),
('499863268890da4e7f6d9b09bc20cb9c66cd52aba399397853f0c29fa4233ea424c20e928dab5692', '81ec3a2249c6daf7e2d6e718196715f9b7057f7378e996a58ae60a5539f707b79d739d1f3d182b09', 0, '2019-07-23 09:15:47'),
('49b7678e3e17db2dce581ebf36268665fdda4a3a0ff1434f66e8b8bb4a5804f62b930b770b777eb1', '67677086f304df625ef75215817358bea3644ec9eda1de93a1d635027a6d294673ebde151113ef7c', 0, '2020-04-22 13:53:38'),
('4a39c8145fa8ee052d7237e2bfbc4953c6778c2cde2b58e1ef06737cb71acce7a8d0af151031e74c', 'f349437c789df57db07999929a7adadda87ec4472c3aae4e9fe0cd7bdfe264dc7acd2b50b655c821', 0, '2019-07-24 07:13:40'),
('4a4b7141ca9c18733a3a3159cf375c90e12da443ab312109a8a8ad7460fe7490d1e7886045ad1afa', 'c0cfe76c532973c8e37890134e20a810f14eea4a93f4daf3300c9f73240d448eae846fbcc58ad2bc', 0, '2019-02-07 05:22:47'),
('4a8a135ad600355f5b9dd2714d5b80b565f1047172786b6ef3ee4f5e8f767e315e06f18100434777', 'd47c0d745e7630ca3e0f1afe02fbc01a7825de5c6e019b814981f7c6a48682b52d2ac1a63a50f881', 0, '2019-07-23 09:15:27'),
('4b4be046da0e876379b69f9eecf2396bab2ca0954204ff1bed2129989d229a4472fac05a4044dcd5', 'a781fcc5082d67f8fed5536ae7e07823866c96bd65eb1b0b200b7f77b9172d4c36d841a313a06507', 0, '2019-02-07 08:44:33'),
('4bb066c643d3704f2f8e988df66a7535f64847343a9d79646fe19f21a7acbe5839db2ba46faa57b6', '10feea6ebe96a8136bde3c68b987145ed38a7b2c40b1380c6127f36a1828daf52a550b0b8a9aa463', 0, '2019-03-22 11:52:08'),
('4be94f2e80c8d4a48722d206bba1527704a444623a144e857458f999ef54b8ecb7a40fbdba9e7869', '95af6d273dc53b7ab6474036960d1190b2bafff9be0c85cff48a810008e845897e5584b4417662ba', 0, '2019-05-11 10:47:30'),
('4bf28bccc34a3bd164ee456e9c6c9f07abeff43a1c4b077f9a92d285426037af0d2f49adad7693a8', '4aa331363e390fdce573ec667cc08a4164b52ada7369e06fc7272af7bff8c54a917f7e6f1cb2f296', 0, '2020-02-14 02:35:37'),
('4c11a3dc9bf76f6e19094590299f373cca92cf6452966e3594296a559ed2ff485c619cc9f782e954', '18baef700424e243ebf8fe0e86bf0e84a96c197aa5f8c84af2f324bcdfb2bb0ea75386c74c98676e', 0, '2019-10-02 05:33:31'),
('4c966cea021b8c7349dc5fe0d39f0e91a771b32e743a40520a64290918e66551bd24f1ba5fa5f329', '9d7401ad2a888305c659dd47f448c68152afdd16eb959d1918cd7863aa2cd7ea9f4b2c687d512e4a', 0, '2019-12-19 00:33:06'),
('4cc345789ce3eeb726df18f9f44a54f840a2ae8135b0df042cde259762090452269124266be1193d', '72a923004264c2bc64fc342557cad392d6edb80f04dd5055f56141b9ea22c06ea4957214e93a7813', 0, '2019-05-17 12:30:58'),
('4ce2cb95d6151e2f8186e31d80899c093a40c900ff28a22a161f1f909d090da95e187aa598b31413', '4de7b5b1e58b2c9a2ccfb5b4004abc415897528881f56eb08d09f435b00c0d741406a44a72539bb0', 0, '2019-07-23 08:13:54'),
('4d28e8e25caf147a1411719de82ae459200d03a0164c0ea59dd28099e2e62010ed51d3d81c41b1c9', '96c925abb99281464ea20e56551682dfd66856228fc1a450f2d38ab2b73424cd9788afc2b98488e9', 0, '2019-03-20 08:28:36'),
('4d6d7554677d439b534d7baa59831bdf66ea5d3e74af908d2e6cce04cb00ad22ac43e172c16852ae', '4d8adef444b35a0be6859f33c13ffc338b7dda07dd2d8e48399e3e0b2c467d673943fe2693023e58', 0, '2019-04-02 08:28:31'),
('4d97d2a0b785ae77132d8f20c0c95e9c82e40e0975d312a374662d40659af80fd9321e8dd716fee6', '1c8ff0583aa6753f35cf629f04bdae254709f06040fc1b7d597dd8b41a39b3428f11edf41cafb12f', 0, '2019-11-27 11:38:39'),
('4da1b52333a1148d51ef951d6fd586bf29634ec49962513f2440a7b8b013ce87af1f8c8e7125407c', '873bcaff4a7d296b519925b92d7947ea6a89864f7b5569562ce4382aef2eaff394dc6e73d22e617c', 0, '2020-02-14 06:29:56'),
('4de2e2b4bbc5313501740dc4f31a756df31a12d9b34c62130088a12e25ba17bb94ca132cbabfc208', '05383b425550b0c6edf74e44edcaafc30e80587386092ff442d33f00e26e03a999b5f185b3a5f0f3', 0, '2020-02-11 01:22:01'),
('4e118d3dba5f85a40bdaf3978e104d889394416a75086ad9ec49f21c9d2acfe8373110ef8c57d877', '025a04c76390478bf0e97f7d3f20fb9257d59bff2117e81ee298829ad519f953e9abce397a204457', 0, '2020-02-12 02:24:27'),
('4e121a893361872e684da039d15c1180ba4d71f06dbada0c75d34845ce5595800a728d35387b850b', '0769f54ee3a3aecca425672bc92c7c45a6b1cafc055940e6ac0375526a6b380d13e45de47a643796', 0, '2019-04-25 05:49:57'),
('4e2653f704346547686d2d88f5f9e9205887fd93889429d2d29977b2b01189333e65e59affd8af9a', '378a913b5564dd723e51c0b0af124c6ed3fcf01d1f849d2c9dcbd828d96b1ed22192b3c2bc547693', 0, '2020-04-10 01:47:05'),
('4e598a20ab23745ef79da24d575740d407c8c7d1d23be915eb230e7bde5179d4de86922479c20dc1', '8158c8c06e7ba133020e3013eda171a69dd50f510740774163fb722cf3d7ab618b52a29c2307ee64', 0, '2019-02-16 12:54:28'),
('4e6443b2c60dff73d06720060f350b1bdf523bab77f3be54a2429ec08cf1fb36379457606bae3ba6', 'a2c8c8891e7f4fc785a9ba89904b90d52a5c5f9d85ece37d6ec1a0df47b52c8b7dd7089500aabf9c', 0, '2019-02-08 05:34:23'),
('4e6fc33c36ebf0ba25a0b77a6a8fe75919b6281ec8f06658ba44384147a4bcc0454f29acbe34c2b6', '9af7d5567daddbfc1aa2ec4d0c79bd6c14a321a9caacc8aed15178056ebee1cd7c1998325df68a09', 0, '2019-10-11 09:44:36'),
('4ea45e0ce3b42c8b82d0bc733e8eb3c5b85df7e949bb5d0029a6710e71d7fb0fb868277b520b99ce', 'dbbfee582ffa6ac46c158832d9dc714edabeb7af647073dbe777ce82c54b59ca2d021f054f046d77', 0, '2019-02-08 09:40:34'),
('4eb11117418e0f1f3047fb3b7641fa9a86124adbaaea275ff3e742ed0d9b6eecc0cd706dfc418754', '55bcdf034a6a845173f49a346e7a184df83a2091370f95a952882a3a3f6850b298eee1bcf1163457', 0, '2020-04-10 02:03:49'),
('4ec6116b2ef6ad4161caefca114a92806cb56bbc828fc8f9e290e736c2dd9adb7c15ffa3fe28ca4f', 'ddbc6b75ab72837e404839b8136c85b029ea149a5aaa09354cb2862144d577af15a4003b122d018e', 0, '2019-05-03 11:10:36'),
('4ee7c549a168f406f65722413260127ee02dcdf6c9238a816308820e7c1532b9540eef055321c595', '36d27e1798e31a65fdb0d67b66cc67be91a2c06b7125621cc77615603bb956bf95338a21fce451c0', 0, '2019-04-10 04:11:58'),
('4eec733ee7308180ce5ab6439f40be7392648efe44205ce2bf9a188ce8d859dad505260d32e9a5ec', '0a70b240d0c745c3b7a2a8549b294c8cf58788c5fa572729ff456810ed129b96357621a04c60d06c', 0, '2019-04-24 06:56:41'),
('4f10a5b99d2925624733b5b132cfb8e0dec1b0c6d25e70e1ad6e9c5e6c617d7df3c3066f2cd0ae89', '6937dd165f4b7ac69b0d69db0368f80a714102bb85f9964f82338beb09f3bcf7719e7374e545a6cb', 0, '2019-05-04 09:55:38'),
('4f423e417a848f7e1988152b968897b8ae810ea845642c550bf84cfb1c0e9813b53ae6eca7e50bfc', '36da0decc997cbcd53abef05c23338c231467b565fc8800a7773aa1d7295f785ddab6376be58fc8b', 0, '2019-04-05 05:59:08'),
('4f828af5cae2252d7edea9d1c696735ceedd449d74d05d7d03838a020d999e9554fafb792d2120b0', 'd1d1ea486592b0732571de269e0ec492f6cc65c8302a585c1e7f346c41232b039b1e7a53c2513995', 0, '2019-04-25 07:01:30'),
('4fc7847f31f8d0e8a992185d3e7da579a5b3ba22d5514f5c8df67d11f503d0a3ae0beb4e59a0490e', 'ba6cc13da98c4e20b044a12ed687d4cbd8d8c43f104292beb2e0638a52f79f744f51102d4979945e', 0, '2019-10-10 02:21:12'),
('4fd531353c089bf2737c9af08bc5d0697bfe3a0246af85d512a736613465f76896ccbe9e4acc826b', 'fa4da762d8a6f40b0a5732d728229cf1330dd595ff974fa6beb000151cfbef7d2ad7c85390e0ad62', 0, '2019-08-01 05:48:31'),
('5017b5da320262bdbb765f70863a447c081552eef0c56555992b3ade0bb2fafa7c7c030f05aeb47a', 'c82a864972ccf538ed6d96d9ef10182edfeeec5d380c1858c0ff8c6cace6c7d425275ac281e79b1a', 0, '2019-05-14 07:21:08'),
('503e19839871f92b3f1324abdb19885e627d6ccf22eaa2679ecc1790f679ca373b068ea69c0b527d', 'c84f4118dc38b2dcc445d2496d2476c7ffc5986fa9e94ddb5f06f98691516538c16aefcb7c831e3f', 0, '2020-02-12 02:20:32'),
('50728e90611c337128ca643cb94833fc8e1c7aa2538b422914b6905fed4e12245254040e982fbb53', 'b7d18a84768587102dfda0b01018c5e81ca306a9e9505da3b7051a5e1b41bc1f870b37b4261f5fd3', 0, '2019-07-23 09:03:29'),
('50814071b0a30ae840ebadd163eefc7c68dec0e3375e4b540a4932e2d6fa537c9422d77b85974eb1', '43cbdd40aa2e6bb9b9e310741ddcd70fd316b4ec53d06bfb0778d1ccb8b87688de987ba29ae5c845', 0, '2019-10-05 05:40:24'),
('50965067895d75ce84b19b779952f3cf35af7709aba1c52dc1a96dbd6730eae4ff921b7fe9d500cb', '2979284fa32df3efd0789ea303f5ee443dbe6d367657fd7e305fcf6475f2e044c1684e0e699c09ac', 0, '2019-03-23 11:44:32'),
('50c4a85a4e132ff66301b2463e91bfe7e22c5348a4db6afc87838d7d96b9e3dc61d7bcad059e8f95', '6c73665a18d220ae08dd6dfa7fa76623b893d530232867bf941370bded5f0a82c2a4f2c085454705', 0, '2019-10-18 04:21:31'),
('50fe2255142315e15e3902b9fa4a7e245faa00e16b1037bc1f4bf103592d9e72808d1e6b9537d773', 'de2f29cbd47daee8cc83a74bbb470e76f55b05ed39689bed19c50e32db62fb83327a06110233207c', 0, '2020-05-24 10:34:38'),
('51b3ebfbe49bfef2ed8196f424cc685c200367ef76a33079346b6fe62ca1a8416ee23c0bd4c52d3f', 'd6fadaf0a694da53d4c966e32cb2352c1905d3a0560342cd1064f206160a84abebce38a22011e1a9', 0, '2019-04-24 04:13:42'),
('51c5bab09af23b3c66c7ca9ab568f8008ed6c2d112340f426fc9707e415f467f55a72cc0f110be9a', 'fd93fabd9d09d6f6a97e1c5f75001a2d7a28a0f48ddfd5dc3284b6d82fe1e8f8c7719894bb0f12d9', 0, '2019-10-11 06:21:17'),
('51d0ca20f8c8cfa0debb2fbd2e7bdad2b2ebf321412b23861e631c5de50063b0d1c9b29ac6692d3c', '8caa06a02f1fa59a1e60ae85c8ea7ae4e03bdae78d8a9d515d1f06d005393558d7394f03424ec4a0', 0, '2020-02-05 00:36:03'),
('51ede322aa02a2700463b0bbfc520f3b2296b2744c8005f2e5f53e11e17063aede37517a23a44984', '26ec7c5ab5250ff80560896ff3177cd73ef2df553aec1b917902d74e7e0448c3f2cad489ede836db', 0, '2019-10-01 07:57:42'),
('5234897e9fd8987af55580c9e1e138816a0075f475be8988910ee98a121fa29231637cfb275dddd7', '57b33ab4cbe4cb6c93861804e9d4fe85fb2e18bddc07d1553f059f19c3378f5904c0cc8c47a34179', 0, '2019-04-25 06:20:44'),
('52f01995bbcb92228e7fc5dd59e5909cbf38985efd61e6c9609e81e1b88ef4941a0a97fba06f7707', '2011522ac50d588b3ae08b98c81d7a2e29fea587f6cfd2acae883d0801ae50fc885766dba3ec345d', 0, '2020-06-28 12:10:53'),
('52fccd374d48ad12f68513eb24b9116cf8b557126cd3b66ec0a4fcdf15aa037aadc013cce2e64c89', '5119f830536d5822e457999fd7951f214ab78a5e9d0b0b8499f7357ddf9b81c0eca9c13875896952', 0, '2019-10-12 00:43:42'),
('5322aab4f07d92ffd14edd59680a9e09e2cf85a9b3c997aad5e844406c2dbbc9cecd412f3a7e8410', '5229215a2183cb599101b7f75af5b4581b1e34bc3c09707f0c5806972761bd57e613fb56a0a9fd9e', 0, '2019-08-21 12:52:20'),
('5346f2a3c44715a2fc8a149e7eec9a80a8cc90052e3b04097b55c930006e1fbc5575aaf7a1a79d40', '9113373e3f2059180fa2b609128396173a1a4d8b630b0d8a1206b74522bb694c9fca9c22e54c2f1b', 0, '2019-07-16 20:25:35'),
('53500f04752000c9eebe9a7fb276706d967743203e94747cf2541254758814062bab987ceabb158a', 'a2fb7b564ddd26b1490bc6d9328e2656a819698e242d82093257f532b392e9777460c53afc087d65', 0, '2020-04-11 07:33:37'),
('5357b5dc557397132714531b5b80ef2165d2f190dce16d56d273c709f07525a9066843a679d4e977', 'f15cf03bc5bd2c796725e8e726a10bcb8c6f20f7e490129253a7dabd32bce4962a913688e17a084a', 0, '2019-04-25 05:50:52'),
('5359acef2b45140337f98c229c4b45b910385e45bf0179eb7f9d0aa016d6c82453d493ab27973cfa', '56400b683d8828ae2cac5a7172544ef6c4d423723e7ec276ea28dc1b9e1d055b8050a55c0ac4f75b', 0, '2019-10-25 03:33:34'),
('5380f2ba56ef1e224bc8891351d664071e4dd3e1715a3a0022e871113e6c043e6c2415d544e1cbc3', '3323e0bf55fd39bfdecd51e6fbc04152706b654ffb44fbca58319c7146ac18c1d6f14ad891c13e00', 0, '2019-02-09 13:25:27'),
('53a8ba87bdfd28f972fa4afc2013bb04e4a03f49d96ad9005a2d83fea2726a7b7fcb8f365cd28b8f', 'f9b31b7d02c4bcabed5017acfc05b59fc94e6f395e2bb79524dd1302c3a9e93f56d9f8299d463fe6', 0, '2020-03-01 12:50:20'),
('53fbc1279a8aa8d6c2d52de637568c5fb89d5a007667da38c91fec4e3fb640734ce8aa4fe2bd5d0e', '6aadc8d17acc4ab16658a8afeab57ea13ec9885b5a16a145ef5ba0af7e10ca21496379a3a9e10fab', 0, '2019-05-04 08:31:04'),
('542579a7a39dbda666aa9fb8e1af584997039e9adbed94fe642d412a352628a5712767162a600cd8', 'efa26117da194ae71dddbdaf5e1a56b629448661564fb0351c1d94b7e882a204c3b700684ad00313', 0, '2019-05-11 03:38:13'),
('544b6f17f72974937e5c08c5c55a4cc0e594b3eb75e4369e838e96ac77062486c908f10b1bb3509c', '35f397ab28602bce8e01495eb9b7d9fefa3f106d6cad195f75c4795fe2d1bb4665f365adf6c98a43', 0, '2019-11-27 09:26:52'),
('546442d19d336190fa90c871127c30d75c0045b61980ffa69a231d5f613b95457142d3c431c71de2', '01765f98b147e87a1b93429f35b9dc1c862889057da0ab96fb4e9b604fe7ad0e1fb6afe0b20415b1', 0, '2019-03-21 11:55:04'),
('546bce2cf3645fa1b36890415c79b747e219ec07306f3b0db4b8ba83e38b3238ad71bd280fffded6', '84543ba7082c705b974394e6a9cbd0fc3948c76086aab0c333e09dfa00eda76419e2a384ff030a24', 0, '2019-02-09 12:57:13'),
('547f9df26e66c3f146f875ab7df11b70e51046074ab12f1436e28a8b72b7670357fc6eb4721aa773', 'd439b39a462bb8b595d73fc314b4de0d0594381307edd88ba068719b3a40b585cbc40d35b398da1d', 0, '2020-05-29 11:00:46'),
('548af76c78e151cb798cc65a6c3f24e69b0076b001106e033e3a70e2f4862f5899285cec4f12c8a7', '2daec09401b54cfd793d3ee3a1180852c78c0bf6b48f7eab27fe44ec5aa71d7d463bbe3d0a772998', 0, '2020-02-14 22:55:05'),
('548e8d94c72ddc972a66251ce86d958277c60c0d2d84ea61f3bded5e5df33efd7535cc4b9a0d7d2e', 'db37fa99d3eecb289796632237d54426aea86828c747da6a8273bad0e5181d382d1d17eaee7d0e00', 0, '2019-11-28 04:00:02'),
('54a960cf16dc54530e2c03db5b8afc3171f1cda7c02f7176759cf6e594c3c445e11970286892ed8c', 'bb8bba8d861785b53e142ced57771ee80ef7c7dfe108ac9dac88502521d925a220676cb60d32bf6c', 0, '2019-05-16 08:53:26'),
('54d088e13935baa984299b98541d20e063ef92d44b4a7d6bd16dad3807433ae7b935f659e9e25a01', 'd3bc5e4f4350335c29ac8c8a73684ce12043f51a5bf1fa266a60ed83b2973e25a85423844c163673', 0, '2020-05-16 21:47:36'),
('54d9f2b3e405ac38407359c17ded5e69d2024f9be3a87fc93921bfd73813514eabf4dbbc2f855471', 'c745025aa876b9dfd22bea43058f2540802d15d1240eebdc14b05f3d3223fd54edf0a5a33d85bfd9', 0, '2019-12-18 19:49:20'),
('550070d8884d65b42f12d94fe5534b58e81a7985733dc9a7ab321fe99e8125064a82f8ef20498004', '59cd3116b4595b39cb783b813e48167bde5c95985e94bb4975ccd1ffaf996d3a12ecf219172b31ae', 0, '2019-02-07 09:49:10'),
('55222f1d1cfc547a5a5f01dfc22a687c52dbc05bc860b66d7917f3aff0a44fecd4a63f805084785b', 'c982bdbd7219ef175b00c0e1b9d0fd2709d70552f7d660c757c314029325b4db97bde0ec0f31b182', 0, '2020-02-05 01:06:28'),
('5545bdb69fd364b8174e8ea6f01aa7e779cbf94f1ab9ebe095a204cf57573acd43a3f7b1f520b468', '7f570d5feb74feb7817a7f4678aa4f32e4aab7fa87f8fa522ec232f5f4a8ca917484359e0b89d29b', 0, '2019-02-06 06:42:46'),
('557a06756c3cf124b02ed4c6cf0a2fff90e777fe38311ace2bf68d1a7ca71b067c8009494b6c24df', 'ee793b84048c53766dbf432610b1d5b4d236f3a7ccaf6419d2e1914d3b30057df6ed94a2a216236e', 0, '2020-03-20 23:41:48'),
('55b43502ae8dfdc2f043364c00a12c5bec4b03ddf689029b8ee23747ace436d40cb45dd084bf60f4', 'ad895fbafaeced4de0ee741836fb9d4a342bebbba67ad1ab8f1a769aa926a2246f8260e249af51d9', 0, '2019-03-29 05:25:15'),
('55f7d44db2a76a7c6de07fd5437fe58a2b25e938773d47bd5d1ac7f0aa5aa6ada9bb6a2a76d3cd3f', 'a3e969212e3fdaaa600815f334ff854c08b9d42d8930ccee2bc1fc5081ccfdc8fa2ffebf5f170008', 0, '2019-05-17 14:01:28'),
('562544bc7e1fb8cf1e6f8ffd115a3227764d7cf81c3a8c7c7585ae999fa5cc69218ae435b7303a4d', 'a72e6ac66c0421a294597742b52ca18fbfd1e1604bd6d470b670b04472147246f5ef205d8653583a', 0, '2019-02-12 03:33:28'),
('56353e2c04831267d5c84cd6c906637f2d0b072cbfc0bcdd450b07138fe399e07bd3af580b673616', '70119f502edc59d455492994797309d56c10cc63176acb8c0d26b614443beebf00a4764ea331e3ad', 0, '2020-06-04 14:14:17'),
('5635e407743fca603bac5818d2d52bd19ff022976a83b6a825aab8d69248f5af23d0580bb7c7c013', 'd35435550b1c8d15d0e661d0c26d27b0092ca6864f026878b592ba9aa70e7b05571519b8ae15051c', 0, '2019-02-07 09:50:23'),
('564e4ca2493aef82c92761d7469ad405ec6d37b7ac59020c03fc8e4450a507cf222f62abe0820254', '8fe5898647204011b829e24c933afd924a229997196bc44094b927079b03643bf345968dfc2f7f2c', 0, '2019-03-26 06:08:58'),
('56868ff244595abcd58521e2eb5dbddd89ccd76a75b17a6be9dcd9736372431a2d7e88596a4df8ad', '216cb99f4f97ca5aba27bbf928efb288c7d932b2d61e1c5ea2c4ae77ada84b025bc0108c4f4c357f', 0, '2019-10-10 11:40:19'),
('56c1716db2f89fb59bacab94f2234d5f7e049b49e9bc3b538d3507db1a7966bce0f115780f858be5', 'c8203d031efb57cf677568b3ea87167ab34e294550f05bb127fe7f0f30c84244b10945ee0fc9ffc7', 0, '2020-02-12 07:28:02'),
('5737f6835f40592e13d7347c1a16f1384fb090dbfdf0afa905c98c7324e538a27c3f0b4b4ba78ec0', '4735402ce8b394318557ca9e4dcd19b34878278d495f42092ead17253cc15306091179f5c922f4fd', 0, '2020-09-05 11:46:19'),
('573d967cf64615d438cb745088e3c955064da96e3da1408897e4e0833b289e8fdca5c6787dfc7b54', '01a7e5474500df4f9b0ff90145bb14e087121848217ffe678f096c7a3cb3ffd757073b169d00baeb', 0, '2019-04-19 06:36:41'),
('5751bc01f2e700a877a11c6db4c462a0949023494293f779cbefd754a1e92293132a1dfee9c6255d', 'b110e90627ee0e772057e08cf3906a41fb7ca36a806c1a913d5778a9b77aaa4d6a0c36bc294f2bba', 0, '2019-05-14 04:59:09'),
('57939f6f2977e89531bba874ae18c0e8d7e4fee660c2d017d4e9650d30983e97814bec53bec8043b', 'b3aaadeed7b25204d21a65671f1376a34656f2149be0b47a1415eb56070f77701fd6072b844d9288', 0, '2019-10-18 09:48:35'),
('57bdf7f134e39920b2271482ac5c3aa7c0946e994c1b8c7d83d87a86916ff2c09d24a748ccc68949', 'd471623b82bc67e9e2f6c201615b6db0116622b8686da5dd796f8828722315da75c6c985ea6c7b59', 0, '2019-03-21 08:56:31'),
('57ce09928f9e7a239db501ad3707b22c21adbda5cd6331c83c784cc043a5f6ef14ded8bdefbd809e', 'feac52f8814baa305ec7ce02bee59d809b590c1afbd09f68d593dc986906e86adb4951c0a223eb68', 0, '2020-07-08 10:30:06'),
('57ce7a3fae5d2362bb1fbd30e20b788250a51a19edc7ea2a07b141295c22dab19c104758e7b90d37', 'bd0a8cffdff9e9b8305bceffe577643df7b7c006d06d345075e5b3745b1ee34e8cb2bafe7f5ff91d', 0, '2019-05-04 08:51:13'),
('57d819c29bd2f71e14b48e62acbe3e07139c3eb0a2aff49ef7f09c7b58bf6cec6d4eb410e743defa', '7dbb4a1524b3594e5d918b99a9d75642f3a56ae0d99371798d5d50d99456d41887dbda417c5d3f1e', 0, '2020-04-17 22:55:35'),
('58638b8ad11f96fda96253a865d7389c07b9997d0faa3959a13913a2101ff2cf50c485d2349e3fe2', '5809acbedc32121742f7fb6fe9ef3683afe59d2c268f14e3b1af455e7825de24261a62f2c3af5da4', 0, '2020-02-08 05:48:30'),
('588f1838d12a6b2872062dbec7e0ff8bc7eb17b78496ddb87d8553943a14572c58d641616bb9be03', 'fe315d933e9c830960281c205ba76977254ab6ca66aea298999c70c5b9c52b00878ec0caa2cf451a', 0, '2020-02-07 03:57:47'),
('58b11cd2b99bd5a0683f78eb51985ca0dd98c6f4f8952563f334319ca19c655669cdf6734cc3a860', '09bfad012084ffcea3b7dffc758c8cf910a4d11b34447cc3656310f8fd3a04c383d83f7a89b0d3b1', 0, '2019-02-07 10:41:40'),
('58bbf5a72284435447c164d7ddbcf58f1d161a053b8511eade0600bec4068f14362020d6d14c9c97', 'b6297b14d9b4e776cf2e8fadee92746bc3b26c1e38a7f066e8e4c1b578717746a41c2bbae569b685', 0, '2019-02-07 09:45:04'),
('58bdd9f1bff31449bff75e70afb00821fb0e59298d4fbae07005231c06c8183b44dd07bbbeb5f219', 'd0e62be91014e75094f78abe17e283c482fc753c96ff75a75b08b4414e8e9af1cf4e9f5cfe149ffc', 0, '2019-10-18 09:40:26'),
('58d51829fed70cf1acef231eada44400f0aee6a8041bd260fdc1764fdb203c7cb7d10d4a1e66e883', '45bd71e96385d897cebbca23973831590a1f0865e411fd0ccea9142908f9443950ad1a757fabbc82', 0, '2019-05-19 16:08:35'),
('58e2d5fd548641cf6d644f2379ddaaa1d69dd0a2b2a0c3e04b9877d806df095bf1a955d17fbddfc0', '5ec0f6ed94f510196515d63aa7f5981621b3af4ea5bed510c490784d6944810f57cbf8b821ee8c5a', 0, '2019-10-04 10:56:07'),
('58fa42c0af567428918e4c4524d517ecc4aae1f16914833d195ba3bea964ea9abe7c824867518c0c', '996ff28bba9f4cdd2276dbf7801b09ccab63fec679d6789cb4b983cee00bad4f57b08f4673d775ba', 0, '2019-10-10 12:52:26'),
('59278d6a06be1cb69ef15485fe758e88da9765ddf54a70905f00476d6bb9219f7ae5ab24fd9b96f6', 'd2a7ea4c8805363a3d468d770600b8ca45286ac0a275a6806687902fc1cae7eca9a64cc481e28441', 0, '2019-10-10 14:37:26'),
('5929391168bb6592c825ec44d89c8adf272c9d581a58fc45d815b074612685b0f627f2952158d8c9', '8344cb81663138a46a8f1bebfe9570cb3d36b2db4eba0b66a18484ff6b19194dbc16f839a34f6c03', 0, '2019-07-05 13:09:24'),
('5935dc572f4fc2aeaeee76fcbe14c224e3da5622b00e5713796abefc0d872e8e2e84c7713364c8ac', '2a1de098ed8751379be9be8ae1299728d0827568296d0903e4045695650415b4e33e8cbcfe9496e5', 0, '2019-02-09 13:40:14'),
('5987d2f43ca03ccf78d54d643ebab976154b3495b5a773c7af7035e77bfba595ca0d8f1e95c8a676', 'f8bfae164486f1007608b3ae4ff2f3871a8fa13019713b6716755ff7a9cf78ad30a0a4788b4670a3', 0, '2019-07-24 04:49:39'),
('59c803ababa6b7adfeff8ee7052a7cbddb2d21a22f521d2038b76b48d442c24b1cbf4398d4b0137f', 'f37411ca80314efa46618aface6a2b82f0cc57bd7136cf9fc37fbff0156c01ae022068e89bfb08f9', 0, '2019-10-24 00:07:33'),
('59ec8b07509f57e1107f5fbb42a05eaf49ab66e9c8833bd9d368f524c22a12a28ea352fcfa15b52e', '5a129e67b2af62d8e8208e32403471ec6c45b0be9df59d8bc54649ab5a4c090dbf2bdf862c8dcf56', 0, '2020-02-05 01:11:27'),
('59fbfb1934ad83c8cfdfa6fd068245caa739cf7a9b4dcf99a168e6f63bfceb709ef49f334af5b5a1', '4338a8c8185380926245061fa0087a331a089df31cb292d99632ba3790c29ef485a0f4f837692a2a', 0, '2019-05-04 08:27:20'),
('5a184e39e5a90214ecb7d23c6a6da4ab8ece907ee2e04d8b98f04c05f51d5bbe925656eae7c65f71', '56bf498b22cc41f818f203199239e59740c83d15d38e7bbdbc94f851ea187884839ef2f9f4015ef4', 0, '2020-05-22 13:15:34'),
('5a1af8b858fe6a8fce52ddadc5548da10b9ec7c5a586d0f33eefff5d7ff10c830e6c2a5edbbd475d', 'b3e1fd7fd3870144d08f7a7b7cfe5438895bbf40ab6feae580c6aef43e736d4a2d780572c40c325a', 0, '2019-10-09 21:43:47'),
('5a1f5d1f4321d10f4099eaaa2b1bb59517fcce016a4123b3511eccf571f8f8355614e6f4d21c3dfc', '5ddfaacc564c0057362082e6d6836ad50baa2171386570baac5ebb62f352a1949a358e4c29c80deb', 0, '2019-03-27 10:40:42'),
('5a27ab1fe3dabda61aac215b1c1e8ab8557e3347d8ae91e95fffac45ff4c63ef95b97ec487e70381', '58ccd321bbe276295cd2ebcdef2e5a6c4d667b19c6f6ac1cc3ffad18a47af47f96c12ebf55c1848e', 0, '2019-10-10 13:33:19'),
('5a2f8b69c2b7b7666208a2018dbc1a9bc46aeafa2991c6d5a3997a82387618859cd8ea859f051a6f', '9497a72830bddce344a4aa3ae0e20eff616f71af0321416a0aac5cc5d490b5853c6c908144197ecf', 0, '2019-08-15 12:50:21'),
('5a4783d23afb9b9708b9b6ee2e93d889b5e1dcaba770f7edcef665478fa243e956cc8f8637efcbc5', 'a20afd475675454e851729fef69080bfdd7f04d665a2c7b2deaedd77d86e27a833f9a59c7af908d3', 0, '2020-02-11 03:52:55'),
('5a4a3924b018cbf5582d5aa101b9b36ed18d3111b3be00e150ef7ba3a44fc7aa0a717dda055ea89c', 'b38617011e3ce8a68fe14f95dec765513800e1ea1a6afcdfd1e71609321e4d22558b4ce18ab25422', 0, '2020-05-20 05:20:29'),
('5a6a50e8b3db806b92ff0700e9f996b2e04ad8f288dfde4ce84a63b5728d32135b2fc58a0bbeefac', '5dcda53f6aa7a03b2aa6aaec208089830286d9e8edd8993578f1cf056d994f5372f1cbb8ccce917a', 0, '2019-10-23 17:37:33'),
('5a9f55fc85574903aa16f2eea562a52512195dfbd82f925258f8b960d6c8573d0e390a3fc93a3202', 'e82c6a7640acb956633f51a360040550ad84dd5af453b4601c3a705429c0a765b6afdbc7826b954d', 0, '2019-03-22 10:18:48'),
('5aaf04ebd4aa838eb06ca8fc25fc2a77b7d458ed54873bb9fceb5996ba673cc95031148063c6b020', '94a21151594fd90235bc55635916b540e1585a9a2d680b30af0c7fd8e9e00ca796bf5ceeca25de23', 0, '2019-04-27 10:28:21'),
('5ad64af94670b9cb7959aa81d57fa396f3e3dd7e83b1dbf5fcc035747170576163bbb08a30defc82', '1c88cb6564b40d0ccb021688ff238cac6324de33cc19ed9c4b08714457690260b1c8dbe98e85a728', 0, '2020-05-17 11:10:50'),
('5af2829b12919d533e265458e68bb8a9c5d605a23acd6b41cdba3bfb28fba917590da5aeb919a484', 'ae49cefccbaa34a4d3f9322bb85c969811fb83e3166b2bda69cfec6c69c40ad4ea082e41334aea77', 0, '2019-12-10 19:39:22'),
('5b2fa991596d6e342a0b51f4665abf3655b6fa004daf818b8aa69646093c68fb7fbb36357af4bc35', '8b58dcf583528b0cd5708abcfd928774815aba5673c6d988659b2dc13e7f6a479c45e5b77bd634bf', 0, '2019-05-21 05:27:28'),
('5b45d70fbc9350c4a5e9cd54705d752ece8aea39a8d54851729909254ef97ab70e3809e8603814ec', 'ffd34d845b6c14aa2d6f5616a72eb172e5e42622bfb6dc650ddda74fd2093c07e7bdc0009574d5cb', 0, '2019-10-10 09:14:33'),
('5b4d874e9d735db744fa588003de5ad5800810aa814cd044aca8dc9c24e14ff7e8aff96a8bc55b3a', '916f2ca8568606e44f89aabe93983d605efa7c96b1cd4e3a134f6f19c2292b4d0f68a6016b0ae48e', 0, '2020-02-04 23:41:11'),
('5b5fbb5fc392ca4a972ebe9ad55fe18ce1b893d900bdeef8c1e61cce92d978d94efb20d5e312961e', '2693f6476ed45d81019a606f6592aa1bd09445eaf597eba81fabf1510f87f22d90ca70749f32a7f6', 0, '2020-02-05 01:10:30'),
('5b655347f62d3552b57043f48f998dc14fde0cfbf82dbdeb67c32f9505de6c9d51de6df6c9d2f847', '16bedebcd7172f4987f9194e37d401baff0397ebb81b10db2012650d94cfcc08e89f1393e6b4ba0c', 0, '2019-10-09 21:54:16'),
('5b702c5a33bfd929789f4630fa8f8f3692a69afc4d8a29d8e0811b31e40e6bf102b57f6040c6da03', 'e8416f7c5f7b7ccbd2d46385c3d48258463cea36dacc096d3e92db976b59ec251167dc4de37765fe', 0, '2019-05-23 18:32:09'),
('5bb3f87404b94fa809db9c588e9c94328b8358c82f1bd8645c23d6b02f8e37918cc2b0e8e04bfd3d', '96e7f1d9380de23045e655e218da7c4c8f728f8f62e32d8d7b0e86186f2ce9c5607816bb8e39afeb', 0, '2019-11-28 12:14:27'),
('5bccfae4228995a52027712c908da63cca4f314d6ced5b092a096d345666fa9e89174dd78ea1f9e5', '8b244fec3e1c3242ef0a340f98e184d191da90e6e841cd8dc1082ca4e797864d6f7edfba7c49ab65', 0, '2020-04-11 21:11:46'),
('5bfe3dde9fdf9683412f0d7ca4c6c9da1c156946ced90bede3503c9101ad908f9396b1fa15e74678', '5e58340c0760120af1222b8a9b2b802cfe3d3481408342a52e84dd056ab9161be1bcdf044d3528ea', 0, '2019-10-03 05:30:17'),
('5c1d849831dc35d44c5ea799fdd25bcc033db5ca61fc9815fb9ae70831cb405ab2adfe6c66691f44', 'eb29067021c9e2fae79b4782c5ec340c16f9c06d003d4ff0b44e6642cb814d5df69d4adb088fe5ac', 0, '2019-05-03 13:22:53'),
('5c57ff7e891273cdaec99e74b229d4ff88bfa583a0f3c11355ffbc35ea7d9c3e1fcbd96ea5392c25', '0324ffa75b09d4f7b9d931a9626da0a4bffb426fcd713fc2863a958b92083a5247fccd4083955436', 0, '2019-10-26 01:22:01'),
('5c5b127d7ffbabfa9be7e4facaa5a589aa49e4e67966664328c6e37b4246d90c340d3a0d41b08aa1', '78f6210e707f3003df4b3fd47004d75474bb6823ff5b95231e59345be04f3e4ba9058a3267e2b4ad', 0, '2020-02-27 23:51:00'),
('5c610f83b979f448e1552d8deb89015f72bc3e35582ccf1f8e570450a6d05e4b3293f66930367122', '26bb9fdc71374818c9ecf6290c8db57e30d567e2f27897d01b2c5267741c03b88def76b51d4c47b7', 0, '2019-10-30 17:20:43'),
('5c72cd1a3801561ba4561f46f084de1c52e54bbcdb4a22a94e6ccb77c8807bd9e701021856741056', '5439accf15a7b32242f02324d20a3848a21013d759236f3dd65b892d8b8b3b5d70abd93007fcbebf', 0, '2019-05-06 21:25:49'),
('5c89dc5d0bdd8155eda5bff10b3fc6259f08954eb7aacbab91fd94805ed1708a70e765be92acb86f', '2144fa91400a80f5bb578f03cb69b467a6dde8c7605a648297edddc4b9149a129337a6f6087a86c6', 0, '2019-02-08 10:10:17'),
('5c8f74be2480bc209ac3c7d74abe38b6d9a8206231eaf3690159bc9e328a77a447293e20db7ef4cd', '5f29510e7679096c890092f02da4e6aeda44dcfdfc9d4037d800045e69e93b929679a05ad3b5ec7e', 0, '2019-12-10 22:50:18'),
('5cb20b9169a61d8ce9c4147e5489e3b349554dbae53c277d09c16fc70cab927592af539bb9e6700a', '8077629d029ba94cd449bdbc44c2be430950490514a9b9f72d6216a174ac16565396fd48b237ee42', 0, '2019-07-26 10:29:30'),
('5cb269a4f697bcb05a8f42a355ad6766bbc9a6d64b87feadec1da6ddfb1f7a174f82e3b61dbbfc81', 'b600ac783aa4ec218e2d2b5d6653ffc2209531a08c364c7ca57d352037071546b56d9264d9fa7e64', 0, '2019-03-22 10:51:34'),
('5cb47ae13604430446b9140dffa3b11762dc2ac07e35039245b92c08e810413df73d84f871e85b1f', '70913ab8e0dd9e6d5e856f8d32913b29fe4ef9e924abd1ebc7c6bfb19c5ddc8207a2195ea4c54b25', 0, '2019-10-03 01:41:41'),
('5cd18e12e421d138707fb36e5e2c037f712a9721afab25e598b0fa5435f2d0eee50284a5d0d0684a', '037a8d13c3802c68c2d7e8e47839941468713c3e75ec86075624014c7c16be4e569c91345f5478bb', 0, '2020-11-06 21:50:20'),
('5ce7555085fb1bbf3ebddf33634ed091c46407eace3af6a9a590cfcc6fa08bfa93b0972afe5770ab', '67ffe7d18e11eac2b7c14c32025ec69f3cae1baa1c4d50b31c679717bb71069e4592147e3428050e', 0, '2019-04-05 04:55:33'),
('5d3ba8160834e97748d280df9abdd22ebfe85f531e88cee3d2848277255cac9f87dedc2c0d45421a', '67d0ca9ec173504ec1d0bc0082929544d15b652602b6e0989afda34f50935cbbae8a48c78f7b9bae', 0, '2019-05-09 06:31:39'),
('5d6dac9c29e0ab464c79c7f341fb74ec9cc6eff2f32fe91d81c4c6bb2c512229e1410488a9c0debc', '754268de3c440b56b5e0a1d274ce619318a65cb1b27e6d22f9dbc7ecbf78f9208b228bcffeee67ab', 0, '2019-05-04 10:53:40'),
('5d74226c0ecdc93036e0b26febbf6e0caf622568841d50a1d9d9923d15ecd1ca5958b6f9093dc460', 'b71858f2a3214df4cc2d68e0fddfacb8d1a1e598fc95e4f6cd1c216af24901a3d62117448eb8d0ad', 0, '2019-04-17 14:13:07'),
('5d78fd1c8b2aa3f9d6a8d1fa70853c3525aea7e3ce3b824243731e96ffda8c21b9ace1372d180ded', '1c95be5fbde72de89d782d2c501e64957feea674d16803198ea03c6b53acccc2ff5ede520c3f1cf0', 0, '2019-02-08 13:46:11'),
('5dc6ecd2f62f01fc99614b00e08deb31f814020f62ba4665b0f4a9a0b318d7177816cdd51f24f9ad', 'b38113c95e09b5c675497d26a227d200d9ccc0378ef2313300cdf7ed53b28823644870ff52b4ed1b', 0, '2019-10-11 07:46:32'),
('5dd3462beebe3d8ad69849ba982bb60bc47e269eacd8c468103d57ba8de4dcb0a0c727c1ee53aad7', '5a834fcd2f0d9a6f76780d4f99e404c68823f6a52b13e2c705cc0a7c23e41ba0c1d3edc71e81d2a3', 0, '2019-02-08 04:52:19'),
('5dd4e3f6a3cbe155bd8d50531bcfcb898927bce6710baa1fb62a3dcde25861d423d1d84f28c3d417', '6542087dd8cbda6ffb33b5ea29b5e8ddba5a298966dad0cae62f06550735a30dc8461938191153ec', 0, '2019-02-06 13:37:05'),
('5e5de62c6f71a1a7338be1693151c9a356ea6467fab70e4b7b8cb796bb8e82b30d6fac3854201b52', 'eb28873f7cd8fd48d00aa37d0fe633922dfa9b1dbcbeb662196f0de6e8cc991cb7eb7d12b7e9a9cf', 0, '2019-02-07 11:40:11'),
('5e9f9f9e0dcf717dd715fe7451f377b43cdd9b262f6aee296225644dba67e31b02848738526345cc', '3699706833fb941770de2e0e96bb5990dafb5a9246a4a0279128c6e4b87e412cb4d7c326cc401948', 0, '2020-02-11 08:46:49'),
('5ef0f192fb245dc574334da8f33427b6ca9d26601ff0afc43bddb554985e06a4943ce8164464f01f', '0a9d105e9b06c07386f3f786fd01b37fe2ac3170ca069729f0aebdc0c3f228e4e53390fcb512812d', 0, '2020-06-25 02:14:17'),
('5ef79c69a2fd920f51c0e7402bf6a019d21b0aec1d7459d316710066271fbbae85b13e46d5e157f9', 'df2a430c3e8c5eb63861834e946064047e07e9c6f4834c8bdc376a1707f14928146e630ebfeff304', 0, '2020-01-30 01:42:03'),
('5f2c066f40f1f8274ac9b7dc33e76576ccb9a6a44a5d4200c56c3b716b494b93fe2f58decfb81b98', 'ad05463ac92860d95d90ada093305ad234ec1cbd6023b805f32de50d03694822c9d0f0a4e418f1e9', 0, '2020-02-10 23:27:12'),
('5f54cd0437223a4d41447b9a3f2fb586736616aea21c578d7b7c3135276a0b3bca5a3ba6f563bfb9', '95ab9f0b3742fa9cbd553093b9f1dc918bd7f3c990171528243379d2d9a57ef0e8ce3a71c319307e', 0, '2019-02-12 04:55:41'),
('5f628c4892d2eec6c176b18c09d7923bc812cd4c55150aa70893251fb6bfa1a789ae5cc651da0d5a', '0c58b4d26b87b67d83ad2ec1cb40d2e452370ba1731097b643ffedb90bdd98443bc9c90e75c00537', 0, '2019-05-01 06:06:08'),
('5f68c9b9d7d3e86a8b157c588a4ce95cb67ea81589051dbd2b0b6305b8bb0bab25fbf1e3343e4ecd', '93277685e813098c7dd36baee80aadeafa082f84a8948d8e89004f8338940253875accc57515b5f4', 0, '2019-10-05 08:38:42'),
('5f6a07e728146d579db1586e0923dbaf8df8d94bf368037f3b5dfa331e699708ff3ce78304bdacb2', '3a70ae9c54167d1fbcf9ef096c22071ed504c95b6d75cc805eaa644e826e5fe19ea5e21bfd2bad09', 0, '2020-07-20 13:58:39'),
('5fa8861ee27ca0703d05c541f1981e8394c520f2b3967676a1b9ef4162d96301f4ee31a56714b671', 'd6afd006a54ad51583cf2448846efdba1f96a430bcf64cbe363dfd9c284a2fd0c6bfc6ba2af70eb4', 0, '2019-03-30 06:08:47'),
('5fe531531d762f1ed00ff09b79e5bd27363ad45a600a5af6b46cbcfaea3cdf0cfdc9681bb0966cf6', '1eff895e047ca9d7c890d33f870416fffeee060388f3dc4507ccbca613c06dc45837e4ce8fbb5982', 0, '2019-04-18 13:40:18'),
('5ff14824993b899c71842ba5828b51e630aea3a15f2fdc5427c4324a8fa0b49e6d28f916df168e5f', '76c0ba7268e934001a907f8f7b26d34af81e44dabf0b1d0e4345c09c0a2afed4f8f01d2bd6926efd', 0, '2019-04-05 06:16:09'),
('60079a697a4afe250fb8ed5b48e910359ff8ad0f505ab647465009546357b5c1f0c1a02cacf49625', '76475ba56f1d770201bd07c8fbc09e048903d02b896b5617004d5e2f814f3ff02f80ff7b03ffd2bb', 0, '2019-02-06 15:12:18'),
('60110435c28e688e46696f762ea19939f6c56f14669f65b8f1935b90d419ed2ca108669e2f1e4437', '6ad034eb721653a5b328aa443e9b90342a410506c259d1e392ed108fdbbc23b1d0f7cd6759d10831', 0, '2020-02-13 06:36:54'),
('60217b2fbb1804f3a2e7281b2fc011d01dc2bfa5fde07d352a76352464b1443f301e84d123d80cb2', '78bde91ee92037410daa0eceb34a011fb9a9939b07837d89b75d9a6f7acfacbb37e4a848f90c2c45', 0, '2020-02-08 07:17:03'),
('602f3e4ac028a6aa2fc096a10469fc5b3d5aa61cc6af888700959cda5f31f988a5b23628c7b57cb1', '751074b0a8e9a0d81d4687b8573dec1ecb8550c8b818b4d5ce547e11d6f616333ea410bfb9a7de1f', 0, '2019-07-24 06:18:02'),
('603fc36a13bf22df33fdf34d058ad5814a493614c235f5622b3e4d5b8fa0a3634ba0d796d8af9d2d', 'a4017b22d4188435e7549a954a9b7935cf405c71f197beee7daa77b56f729c08ebccee9a91c88e6f', 0, '2020-04-16 19:56:41'),
('60647a3b1cd9097108efe8a9f69918e0c14e4fcd3c4f16b620fd65702803aed4c14c6ab7302881ef', '32f1c577a9b0bd83a27e4f2818e660f38eb43a49c50f0ba9c865b7ca0536c3110b8d85400e9275a3', 0, '2019-02-06 10:05:28'),
('606b56ced7d8b3e59964c509c4d19187f82d04a9545441096ff420a678b812faaf7c0d6b756502dc', '791e5e7359395f64c2ef51385fbce1a89d3d0e72f21f00350b24570d5e7a2dcc1654d5618e4c2ecf', 0, '2020-02-11 03:10:06'),
('60852b3ac6575576a3bed28c85b880607f0b1d75c96c34298a34e46f33a6e8db26d50c86f2738c42', '9b2c1fa1256c7c3a8cd434c4793f052971d0060fe35fdf80e9d0e460386b73e434bad051f8fe6aec', 0, '2019-02-12 11:22:40'),
('60c5474e9f5c001606909754ab75a8076db609163d90018175b8c072b4920bd0919fa54796ec6fad', '8fc02f7bd5de0a1d4d282199d18e917e72a72f509a343aa89f89b2edbe7bce044025331c4924c41d', 0, '2019-07-24 05:09:27'),
('60cb60e94d5560f36b19b0115a7ef8bd968cc88148ae3a0630ac249ef3b6f364dc5ef068bf353220', '6ad4ee351cf9aed325f6ee4d93ae3735bf69e515f9229e7e92819648fac389885015d443be67f3d1', 0, '2019-10-11 23:46:51'),
('60d2c7aaba3c019038528a31e00da5aa2fc32a9b9eb95284923df86f5cdd85966c40e19c63b2b744', '81c2a02cc53592bbb245ae45a6847b8eb1298eecfa79b5505517101b6751addf28a69ab31eb925f2', 0, '2020-02-08 00:08:50'),
('60e0e9ae3bd5a49004a0ceec890be4fc31588792c33ee4ccf61472d0348c0719ed20dc87b9a63db8', '76b611965c798c13e829cff689d6c1a07fbace328aee8e924a3d7727bbcbdfeec8cac5762e36dd49', 0, '2020-02-05 04:43:27'),
('60e8a38bc0eb04fc0a74a83a674c9bb8b766ca2cc6cd32107b3af64c24d1020b6464f947b191d58e', '7b019b474c5b39766c02c0d05ff0ca53c8ddffcc6619d2d2d7efd13dc63eb8224637a9b634e16a8b', 0, '2019-10-03 07:00:03'),
('60ff02aee080aa875de70116f711f2c16903c55b1c331e6ead115efea38b6c70a30fa1379c0087af', 'efb4274d92ac053eaa3dc14d19355124720564c4bcc444e307b6fc667fd866ec3934ac086f55c03a', 0, '2019-03-21 11:09:20'),
('610d5ced36b634af20497214203db6e1c0f712f52f42e3a2ae6fdc7114dcc77cb8a0979195110bdf', 'ec02c54652592ab6db0178574fb437a2228f4407b1f37807ee4383ab7eb1593eea1200bbd78ee592', 0, '2019-10-25 17:16:30'),
('612957c73037b347cf241e013906c71a25f97b8a11edeefd768c0951b56899e6989711e9244ea8b4', 'eea98f8b90535472ccd9d797f32300f271788eacbc32e7ce4f14850f544130195b64d073ab12c15b', 0, '2019-02-12 08:08:03'),
('6152b834349cc8af7f95ee6d9d65bfc65bd60b4bd69b58f56f17a51d3ff39f0b8457428416330311', '38bb893f8314250f0b278d98d50265c6d51b29a23d4f681ed7918dbe1411c604e1161b15ef2828f5', 0, '2019-02-06 11:45:27'),
('6167f4d4aaf57c91345605ba04b1a0bb87b800ea1921a130f03c730314980c2a9e40104dc3b9e7dd', 'd5e7e2af264a5418924b66db15da1bc09268a5980a2b791cb31a6ef16e39c9a8b00997e26348c226', 0, '2020-04-10 01:43:24'),
('6177267ba353a70481f3bbb407f0dd598a1375c183462772b84c1bfef1576df47dec318cb4c71d49', '486c5a664662acf71793daf02db4bb1676050583ac9ae09691b88ffb58ba215ba3ebd59e22d967fc', 0, '2019-05-16 08:56:21'),
('617b4c1c139b5685376a05fd8812bf65ffcdfad096a2e4f6992d697c0273c6cce193b5f6dd085fb2', '1cd31cf4c77d239060305e7bbd55e4fee2f1928e5bb1afa244a5ef3c7aaaf716d7f4d1b5c20c914b', 0, '2019-11-28 12:36:20'),
('61880cd551f091da7661ea28a9a809d28352cf2a101e8a7630ed1570529b136b4d942bfd05317f23', 'f5a49aa73f2172a5db3df5a02d6761840f8842ebd21d202ff27d7bc0091a890bf14e97032c089526', 0, '2019-02-07 09:21:50'),
('619095278f965b624d08fa458fdb4560ae038f3e551d63cd7870f1192ce059b2f9593f3f2e0b11c6', '91e0c6df79bb625b33c50845fedebe56ba5ab537f41016e2986df8c4407e6b7f8dffa623680b9564', 0, '2019-05-09 12:06:44'),
('6197d4d78a6aff82a29308fa7345a6a280fa37d736232638ab2f7d6afa92f8c492b1b7d94b389843', '47f748f0418e5eacd72a0255a348fafe6a2ce116502de63f22d7bdecd71888aa06a6d1006dddc679', 0, '2019-05-01 12:41:26'),
('61cfdd933b0460a4175b9aeea714e6daa0bf76b257588c72b4e60e55d5a65a38c2c6383db122fbbe', '401ae9f1a273fd82446e589bf508130c4d9eb1c691b80ffff02366e150c4b266bc73a41f9c1be784', 0, '2020-06-03 12:09:48'),
('61d28a05423160056021e14b3d9cf084e7cb95027a05093a9903fecd59584ac05fc231ed15f45031', '9327042e671f3ef99ab7db7e4a34f96167837a576e77382a2d5eea79941f37b65ef33fa280081aee', 0, '2019-07-23 08:49:48'),
('620b501b690d75c1bd12123548204668349028488c354f7dd892e649862ef2e17674c394e447095c', 'bbd2a36d0934ae1927e6aa281f2555e0f76fcdd6eebabb6f946b3e162efceda4474a05d4d95518e4', 0, '2019-05-04 08:22:38'),
('621d00da378e3c17579cdc1b7265873c7964001833150903c0010ae90fedb98160d6089f66fed55e', 'd4ca8ed810d8038792af31fc412c318e173f4b5056746b1c495c0cad35adeb28d8df8d6d6cd41c16', 0, '2019-05-03 10:12:58'),
('624498ec3e41a38310a69f9e64412053530148fc4c1f401a544320afa7a5ad452e214f3a1a277f72', 'e14ad3aa2a2233a276a4ab546f222f24284bc0fa1a35f736f3f3f1a256dcef7f416be844b0ccef9f', 0, '2020-11-06 21:09:20'),
('626dcc5d908c434b60e8d062d0dedde3caa7c1ec65ef87203d18c62880bde2fdfc177d5e929668e5', '295a5cbaf8022c42abc5e2f244fb5ec74bff9cc7b408a44a4f28e7eeea7fa5c687b5d0e7baef7b3a', 0, '2019-10-12 14:42:08'),
('626e64e5843c8aa88585eb062e4af39eee2ebf57fd0c1cf484888e595f060375f7c3e41039a8195e', 'b68087897f173ca001dbf27dc0387cd2332ebb26e400ba66c13abc3247c206df6a59f03d18c7bfbd', 0, '2020-02-22 16:34:41'),
('629548848e368ea5776354ce8fe9eaf278a334185230521cb7bdddf6f302b9a00030275983698a58', 'ecd280972af74a9f01217e35b73cb43001a84ef495f36d82c6c816d6f81e755e9ca9e086529bd238', 0, '2019-05-16 10:19:34'),
('629bb7849c7d0614d9cee710abea87e5e716fcbb46f969c9ab8c897bd78ec9feb79a3aea2886c2c1', '68589c395bf9d747443cb2bb14c00ef54514e9a2be077eabda717b93702c8caaceef4c10b3eb3d4e', 0, '2019-03-23 09:11:13'),
('62b22ba03d0ab1d828dbfe85974dd7f4ede68bd58a393a532d5e59dd884b34a876c49f3ecc787954', 'c2c0284093d63be4e80ae8102d2e76b2e214e1a5860a7983f2f6553a3cac6bd7fbe71690f6ba1578', 0, '2019-03-21 05:14:55'),
('62b41462c27c8fea76d9f9207a3a85fd767617e81d70608f792768d0cca986c8744edab1f04f157e', 'a85d54cb1b17190fe4fbc849ed28469219e042020b5060c4f6e73324ca5b1a61beafa45ee822d6cb', 0, '2020-02-05 23:47:06'),
('62b6796262ac71370a3e23a0a3399624b722bec1b9696f705874a903c1ad0d990a266a319acddb2b', 'b1b5655c2e0bb809aaff3076eea29d530bccc9cf5384c32a47909a03a55192a0a82571bcfe83dd10', 0, '2019-09-18 09:05:04'),
('62ff6b17edf1efee9e8e3b8215c39c1d2a85e3f7e373d16e68390d676ecf96190818d785f2e0d77e', '0376333d09d5a5c5621358bc4020785fc56d6d248b10f983f1525734864f3413a414472be948ada0', 0, '2020-05-08 11:04:28'),
('630be8dd4927ca3c58a2464b2dc1c21673b616e9b4bcc72c0fef0660e63afee9807f649f5259260c', '39044d35f075c3461b6b099228618176dae7976a18dddd0eefc92bdc0acd63c6de692b99808f506b', 0, '2019-10-11 06:58:39'),
('630d684056d4f42cf5566a157925f3199e7a99a4785f319b712b0446f37cb93934adad9e20d53a04', '335700d7a96a461941f95b126b1ec294a8040c5ec443e80dba2415c1296e64f50de7d67e05918787', 0, '2019-04-06 04:57:40'),
('63aa4d5022d37968cacd3409ab5122bb42278ee8b13f034d18a0a2c9ca7fbe8f7a5f04471d4a59fb', '0e1a5475b639867d74623c11c36c6dd72b4c87e640f4e21820510b3bd72154d3dd4f232bd384f003', 0, '2020-02-12 08:02:15'),
('63b60714b5ee5026701abdf7bd9c008a8843294f4cd5b5c9fb6b2bd90f2365184c229a86a134bf96', '726c9b449d2cba15d39b9e7b283a6d9cd34ace9ec665a1072606895c5575aaeb1f56a444851eda32', 0, '2019-02-08 11:22:46'),
('63c8906dd4cf8fb0f77fa1e779bfa08f03f68f3410428d499c7585d57f87642e982154ff9e78b54b', '74bdc87650a00a410cb2a3cdee0be04c806221c83257bcc9baf9a4f788b741e7baf853e7cacb0ea7', 0, '2020-06-24 10:24:44'),
('63e2f7dec41e9ea05963b8d28f4c45266e32e8998bfde4ac7be25422f5062718d7b5657fc28f6ae2', 'a738d85045568993c3fbb0c0d995dc419a5d8fbdc69780d36392de88b53dca8b5847a17be80eda53', 0, '2019-07-23 09:28:49'),
('6455cf81b13141739f5843ff3a05a06aaca284acb3a87d7e3ac362f59a0deb5546f1f4e2e9599bc4', '3515893dd3b4ed21b4b974aa35c69d1a2abe5e45b3d5c91409763092339f4a115898ae3b348bb044', 0, '2019-11-28 10:17:32'),
('646d21b38a50283b641ee06e9c62eb69af95a2747d25f7f7530c225ca9e22f929b5e47658d24eb22', 'a4515d79311e6b250ea3476306fb78fd43a1fcbff8c818b5c4a035dcfa25be950696d668eeb86b5c', 0, '2019-10-12 05:50:10'),
('64d2a91a89845b489cda718860ac1613d65a810039040cf363c0bcbe724a905b9421e956fb8c10eb', '6aea678fa34344b7f474465f61ed62e36ddb2fa9f590020c069e17868476343f6c051a39b5108f66', 0, '2019-05-04 08:14:40'),
('64d5acfcb9fa12962d1fa7c064f6150b77bb2ab1199dc34ac02a29ae785e22a1a3e563bb3365e7c5', '1e43ad36b2b39d9b7a1d6deb9fc5602992f318be148c68d4ba9cf5c91658fd79fb272594d040cffa', 0, '2019-03-23 10:03:59'),
('6545651958ee05dac243449de60c1d60db8cce8620a5004906bf2fdf7e64e001b8c087ec4c03db73', 'd445ab4b26f61923f2a5919db2badab604a55a090ee6191d89a1e3ba0c1df42fd6809c14e9a8c7c9', 0, '2019-12-18 23:18:22'),
('6554537dc500900aae27e6fc896e2c1bdb87e503e743e65c5c0956ce3165dd7ab529d06dcd00f10a', '33e382577587d6daa9f0bdf0a7d3769f565d5022a9f4fcdaa5f852fd2b18db72f78f8bec330c74c4', 0, '2019-02-08 07:18:02'),
('65612511dbca8efc399cac1b43c96882518bb6c0b2f13548a6d9deaee011fc731254d9ed02d0197b', '99daceb4688beb8b568176fe92329a97809bd9f165ea05c43118d819951c804303c366c228bbe73f', 0, '2020-06-25 02:26:23'),
('65ae47ab8ede85b80f43a5d3cd3e81eb635f5d60b6d76e913bddb92cb669968027b2272a4afaa5e8', '2302800c4f15fae02dda6e60c46d7db438d81a3abf632c9a1b71eb4f6a343b14f803e2d284709e4b', 0, '2019-02-06 10:52:52'),
('65b14a09b6384ea6fcbc12c09914569b9163bcd295503a6c4cc86d0457c46017dbc43ee98f267219', '6003bae168a698d8eb8b16c0dea10ca1565bcb91172acd315e67b920a4323fa4fe7ac75e68fdfb4a', 0, '2020-02-11 01:18:19'),
('65b6e60cdcf050c95573625a017e0167f4b084882f91e55a6ce6a5177ffeacf41fc18ae4e5af8bca', 'd3fe0a523d1cc5cbd374ab9606b0db0ee268c09c7be0a2fb676ab959d0320ff6a06b74fa6b6c483d', 0, '2019-07-05 13:09:47'),
('65d9cc28158b1ee3dad82a2c967632e85960576a9b242b8971e4620dbb0149f8c07e068b7dcc8a14', '9c77b6f55c11877e14f3542c6a28ead77652004ef466d66b92d7bf6de6d3a0d3cee5e529740b1125', 0, '2019-05-21 17:09:54'),
('66215636b58256d5197f4da9c943e80c0757c5d2954081ff54e576e6d31b7ffb11912922efbc2910', '6adffd95c53ce6084febae0aece62fba9ccda09de0d3a183f3af594b5dd79f056ea06bd0c2c3d5c5', 0, '2019-07-21 12:31:40'),
('662b34ab2123c8fa3872cd522762f58fb254f65c67cf2db2ad21210117eb6f5e87428b7bf56856b9', '4a0b631b212f5cb090f06b6d2407823b591ebc7240d5fb78b12bddbec029100efa2384f8c1f68d38', 0, '2019-02-14 14:17:30'),
('6631b65ba239f4b37d5cd803c785663ab6ebc51e465a44ad6d0c601222af9702a6c68f0964ae7cfe', '7a50b52afa73baa739894cf76c7183253b4e4fabf54ee87f0f898778f0a3f5ecc9d74b1c74f1e102', 0, '2020-05-16 10:28:35'),
('66437c7347dcfcb8c2071aea3a647a72509a3b02531e18e69ede7ebd2a8ab4e07bd5d3702d5c34cb', '1c1fb2eb6883008b76c5a008f67d9bc96e44e389aafabbd54aaf1059d917c3a8045f03b2513d7a19', 0, '2020-05-08 12:35:49'),
('665d63ad924f84d04546fa71f4ab11284922a43120bfb7d08dfdce4d03c4770cb1eb413d27b30168', '287d7c90d1a7d2cb8da623a1daf5503280e7d4532b814c4495aa0834eb168b43591aca87aafd0957', 0, '2019-05-14 10:57:00'),
('6686fb7e061ef08079a8689535be0817db464c935d62d2f2325b12519fffbf9387b80f3ff9af4b44', 'bb353b8a721cc7acd80402dffadb37245a701bad7665b71117465ac284f49c967e73b06cc7aac096', 0, '2020-02-13 00:09:54'),
('66a7c1e04d8cdb85ac70bb6fec48a0a40cab17e16aa5b792f96917db5c9b7a1dc2ceaef0a9233909', '681065a50c2318882b87573824fd74bb438fa4f61fdad5d189c89d5f540e69a6119a6ea533967fa7', 0, '2019-04-15 03:42:37'),
('66ba75b8129fc1a4b6f9105d88560315a0041fb5f75a3db7a9ae1474c0929a27196c8276c4351d41', '70e33cba474fdd7ca950167e0f9404d61c3baf9fb8d58380c3c9c9dff6ce86fed4a2ba3d5140c966', 0, '2019-04-17 13:35:42'),
('66baca2c04a29ee926ec054372d658fd49ebf64d79f0f82cf39ca127da92c137a2a4fdb0c52f0aea', 'e67e16f05b70fc6967e90346c0e923cb08d7aa86bcec7b799ed7173387e8b42b3e27bf19f1d6ae45', 0, '2020-03-20 19:43:51'),
('66f6d0b214a6f98e6366ef06e96cc4d6806070fd36e496c57aeb91355c2c958e80e17425e12295a9', 'a82bc5317a346ee878167268a34e0258186f7a729cb6fc8fa0702d94641be04b04e9b0177e45ce71', 0, '2020-02-07 23:19:48'),
('66f6ed101b16205b4a7856e08d23e4b32c4338c8f36051737a44c60cabede06b3c98e1194090f354', '7d03fae6d7b6dab45f3bb03e956a6c844ca6bd561dd50b512996194199e002204a3b24aeb1c94063', 0, '2019-10-23 23:56:25'),
('67c2840bb7fa1af2a8b6ce9e1d9fb71d50e34fcb2d6f3d49d25f64217ff1b8209ec13bd94ef9c8a1', '7aa2f4d7e2f19db489875e4fc7557983102be50d6bc8c8ae00edb65f3edd7577d5679e090f864d51', 0, '2019-05-01 06:09:27'),
('6815beca7f1ec3c7bf0dfe7fe8436b202b168a4497e50aa9ea0a4a2bca89a217f70cf23482608823', '8b55d600df69731e59e8873f6b866b93ddb97425c9d59330eb455d1ea69b7db429010bced6329a98', 0, '2019-02-08 06:34:25'),
('684991a68edf4e898188627c9832835454863468fb33e4de6b7bb45bdba92470206255b06bffa309', '37dccd70c9d4fb65eee96312d8167de142fd3b096ab62143f0a4e0eab001066e070ad1244b1b46d1', 0, '2019-10-01 01:41:02'),
('6885dfcd2566a853e14cd0ae78479a5c6f9d76e4e8f8919e9656fd5581abe9a10b77c0529d1ac58a', '8547d6695eff0e22a6f7c930930f0d5fa8b94d4769c37fafabd82c77490df98452469d86d7a6b830', 0, '2019-09-28 01:36:41'),
('68c9a9c47627e979a3d54a0808bb74731c8b5369cc51974b3ef31ab8578728b93e3f9db75b7dfa50', '8c2e94cbcfed7d797e0616a00eda7bfbfb98915724406ac71fea5d8edbb1f0d28adcada24056fb7a', 0, '2019-02-16 11:25:04'),
('68f1a6a71bb922e5014d42eabff97873ad9d36183a58e010266a89dff2bf576ed414e2e7f55c1efb', '7a8c99eca3553bd973b1487e1becabf2780ff7cb0eca2f64cc4b1841ee713802bd3920c85b58bd41', 0, '2019-02-08 10:38:48'),
('690a11512230a97d9426899d70a3d9631f6c5b1017e11eded48c3892b488de2aa2cb9dc2da1b0027', 'e9ad5da980614102b18c3ff5155bd3183f36a1afffdaaa0b752f09b3dbf18a7520a03d457690c419', 0, '2019-03-22 12:06:43'),
('6924329f2a35b13d5e67d6aadc8c5888cc381d6174c7263c605dc48780b760abd109552bcb87d20a', '3c2cecbca4c5c85901753e9068588a4e3dc1b6d64613d01ddf6a9c62a59e4985293c9816a8ccb709', 0, '2019-05-09 05:33:19'),
('693e8b559b814806bfdcbe97afdf2015fa1dc9fbb89cfb7c0f5334e7a614e8dce37333d2854ece80', '8a5e9a1e90d8af065b213d759eb89bd94dc9a392eaff08bb47a3411d42bb6863eac5e3c3e8c03a4d', 0, '2019-03-28 14:21:34'),
('6951c8ebfa4b3eb0c60a770f6ab21c7505f8e8e35aaecfde981b24b1bd24740a4ab8811d1d7a1e4c', '61ad01104c38cd72b073a4187832fbf0c145aabaa0031837507ffb185755d1d0f609fee61b955b39', 0, '2019-10-08 08:51:54'),
('695a6c96931a9956d7024a3e202845a8a94f82af3798655557cd126b659095f113b67e7c22539bb9', '9055d66115de4a29fad66ab38dfc73111ab4a3369ae8dfdef124b998f7dfc9c69abeff8fc1eea83b', 0, '2019-04-18 13:34:30'),
('696f9a15bf395c2ff542f6f0d50337719fb1a0e1e57bb6b7131b598892db9a6a713bd82ed69800c7', '1fa3af7efd36e9b16e2a753eac8710dee7bdac230a6cb3c95f874c506cca321063f430bb594b21d5', 0, '2019-04-10 04:59:07'),
('6986ade5f3f722093ae29efec3d2d630c32385a06b8a2caeca2a7e14440aa1b0f0b353dbdece9f5e', '9a96763d02022802db78ad5378e9aa15bcd38a9a39360a66fb8fa39b158ac16815476deb903430f3', 0, '2020-03-08 13:47:11');
INSERT INTO `oauth_refresh_tokens` (`id`, `access_token_id`, `revoked`, `expires_at`) VALUES
('69eaf80ace8a3ec0f49f0e2e4a72d5218559c4ec44784ff38ff44cac66eb2651a35e2ed4f265b0ab', '73e0cf502107a5ac140af27ce7249fa2d9aff7ffb47ee7291a9f6fc46b9b2919382c8f87c92cb012', 0, '2020-05-22 11:57:52'),
('69ef79112459a635f8cf29c640d2d1f74dc97b39aeb461bdcfbcfd212ccce76dc22507a1b095f674', 'a165997dbc2efe22389de04aad5949fd41f9ae5b46693456c24a8554dd085ce645d97a8bdb16d86d', 0, '2020-05-16 13:18:52'),
('6a0ed33e12e90239dc7b3aa7151298d6d06b754a8f5f41c02c0ea3fd7395593d1d8c708abcbb610e', 'a10d70fe888533c555d839833391cfcd1fdfa1cdcb1dd33f3b35233a50c24adf72b60cd1a8601193', 0, '2019-02-08 09:36:34'),
('6a70832a82d9a0265a7fd2a74eb686b992164399a577f6bb4bf3be0ab5751c35e569bdccfa581d49', 'd3b56f7b63a751d42813ef135d39497940c4c0e9da0dd1eb94e848f8f7469b65c46d56189f112f1f', 0, '2019-05-21 13:28:52'),
('6afda06cfefe2fb3b56650c7a0572d6601aa5e123ef993d370cfeded3f00e4e0abfc02ab47c7c6f6', 'fd84317af4d54b9c49a377321f8c2dc8110fddfeeee1bf71619754241a785ac6c2d2b0c18a66d14b', 0, '2019-02-06 13:33:04'),
('6b1bbef6ed111cd97eccdbd61985ff8a3f856d3154c738f06612aadd4964f1e08e9b0e9ec5303a10', 'c14dfc11f5e15792dea2512498ab403d804004f0a25dd67da0d41c34399c60fb2ab9e1c374c63292', 0, '2019-03-24 06:37:20'),
('6b1fdd22ba5ec28c87a0ab2a811e0289578fc4bf4e97fd23dc5096be4eb9478fe1cd3b3c850d74f3', '53d626568d298db0f08b419bcff9cced38b38e7264bc60dc6b47bb46cdcd78795f73e36e5e91770b', 0, '2019-02-09 15:30:52'),
('6b23a469a133df62b4bcab1cc194e1881f55e80accd8b05d607fc93f4cb2baa1230895d0a6793275', '9b5a9216b0304473abf2f3a65340bea04e13f786a945ed383db69ab0ac848585c4610e52015e5f74', 0, '2019-07-23 09:02:52'),
('6b7003017a2b46f2cf01a16fa53ad1146f3667f282f8a8e6f7841c4216f25e768e360556407070a6', 'aaa98f616d86b15f2f5b21ca5d62d795b960b881ae4ba72b8ecf3161e470f0e53f8b823cedb4373e', 0, '2019-10-10 06:47:57'),
('6b7260642860ef06ffe0c41da7bb00c0a61934013d4c363ceeb76bca4b954fec53ff6fdc8c48d167', 'fb5eec407e7c4e555a90b3fc649e1f09424b19f8a4f59904765d4a95f86d26add645d857476beb59', 0, '2019-02-07 05:46:51'),
('6bb030d71c0b5e3bbd1a9c28648518566bc74878f2830e00bf78a464d7114c37205070f50bc00148', '14e69d407d8a0b63e74fdd456e1836c0f28915c1476caad6d4370f5dec79ae508c7aa786985af981', 0, '2019-05-14 10:05:32'),
('6c1d52c596e5f2b4621aa1a244da3854d6077c825de08b04981bc4f089f5c70b5af5e86f0ef37a4b', '73b2c735351e010e15bb9fb4f4b413d208871e77e8f9fffec913824928926831cb1ffc4e3a272704', 0, '2019-03-29 05:00:17'),
('6c5d570885f007a52a75c08b1a2261fe6cd9d5a38535e2acb501a92b58961c00616ba3a003d80798', '7bc7c18c7487ed1607c7fb9609c5b15baf58321feeafd12fc8bb41fe18acab96c054dcd4c7da8894', 0, '2019-09-27 05:03:14'),
('6c72b05fb648d2d51449182704195e5e31b72bee047234fd8d3fae825261e9b1e21897b113b78ddd', '147b0f02e88305ba933518ba544c1e14cb4ed33b18653b2829bce2b08e499b932899e7a77c1ae53c', 0, '2019-07-26 08:39:32'),
('6cce988f924cc27a30b264e683bcfc98741cd1240b2c9614205307297c267b10737182b0b3fe133c', '13bce56f74fd1994b5ea209ae39203080e59f5a183f14d6918799124679e59241eb1e7c9de0ccf4e', 0, '2019-02-09 12:51:40'),
('6cfba52db0493c7a2e01b51409d86192ca662a7920310b2dc30e107941c0edc229c75dc1aa9bf981', 'e1616d5a95bb88be7d119464c5b78eb359b9c8c4dcc0e2f365fd4c5a463cc1bb43709223dae9ce9a', 0, '2019-03-29 04:47:02'),
('6d2f801ae2af36cc4e52551541bbcddc483853249a025f8faadc6672ee29bec5f27029701e7bc973', '33f789009f329851a38ec42959ad57e5e58d18381faff492c44fd726c4d451f7469f847c222f1be5', 0, '2019-07-24 01:23:57'),
('6d48d5c106971856872b51b6ff36515a66ee2ade54f5dff4acb8adb92e4cb4652df083239bfb4e82', '4ddfcdbaef58a5ddbffa1f507cb48e0198347dd60bfe5c340005f678b9f522c5ca110a77202c442a', 0, '2019-06-11 14:18:19'),
('6d884ed26c378002996e7c36e4a82e24d55312ca368450b184b64a1a35d7c9d86378857753d20a8d', '15af00c6932b944fcee25194b8d4f941bdbe2ae2a05212f6d1923ed712f69fac3f03a345ebc1ee16', 0, '2019-05-03 10:13:12'),
('6d910ecb6755cf9c6acb82c3a9b6e6ca56cf2b03eabcac4a9582811d15c7d2d0b6627b4d9a97bf46', 'dce85564b6ba2c62282ec9bfd3fdf13dfef4b2ad7536fc34b237816aea1740ce40d6cadd7830faa4', 0, '2019-09-28 01:24:33'),
('6db196dce00a2d3dcd7d0327372620b86ccadcd23de65b70e3710d5e1d6f8783120ecff4b8827ff6', '304f488a3f563d3fd5a80f491d6dc58f1d4947989eb234bee3eef7a08d584df6884b63d12557a42e', 0, '2020-03-01 15:03:24'),
('6de084898c4d4f39b4c87486630d84a6c6a1cf073a7156e115cd168221d11002faffc29b228dd306', 'e9f8972597502d7d75d6cfcba93a1d9c2b974377f88a07707ec65f3eb3d82ec730a32c87a1d6fe5e', 0, '2019-02-06 11:23:52'),
('6e0ffdc52a9ade11b86f50cacca3b2fd263adcc6a39990c57808126055dab140f1afdf1886c7e7ec', '1ef242efb60c4c06c5c60964c2a05bc4c0696da6a55211949600a077123fc3709c6e0fc1e0e8b2a3', 0, '2019-07-19 01:46:08'),
('6e21518abe4aef836995f589ef94a6f161ba3fc4be90287077402d11dbc307bce46375e9431a27f3', '86ae63ac9017e8c93a67c9a4c10ec4a23f0de139acc15c1bc1681743d018738b37ca9fa947eaad73', 0, '2019-04-11 11:36:07'),
('6e28de48ed47cc0e517bd7b45df2a0c6bf4666481673d5fe12999642fe7befd95a8bb8ce340d8bd1', '4f811e7d5943f7011674172bd407807c099734a2bb869fa9149ffe57eaf1d91ef91df3372334bd4b', 0, '2019-05-31 07:19:36'),
('6e2f496f94438840d8eb620a30813907249f264e52b4904c7d47b5d728819473cca5b8005f44378a', 'd4befcf74f2f7227ed21bb7bec1082fe0bee30e7b2391e84533bfe801b8df22f522b8e4e370a8fa6', 0, '2019-06-12 14:31:50'),
('6e673addb6e43e0c94844b3496a7e9d6376887c89acc0748b84e32cc3bd3ad55e1241ffca9bcbb40', 'a5308c49dc9915ac31e4275df4e358697f98f7cfb52906a2082633e8a80f803d211431685833d90c', 0, '2020-03-08 14:45:32'),
('6e6fe174446f41abc369128987069c5fcbbd50618d76a556f3788eb2e290e04742a8c00244e476b6', '2575694e794357269ba5046e25deed92e15d4b168e5c5d62db2cab83c0f300665dfad25ea72de24c', 0, '2019-02-07 09:43:02'),
('6e78cadabe8396dd1f54d32c13f65a4a1885cfde48a33c25433512c01ec571beaa64a69ad9d9ebed', '52a4c2703fd3f3df137fff5431dac4f3e165e61d15843e3b5680862866f57fb5f3e666a9fe758923', 0, '2019-03-29 07:35:30'),
('6eaa7c077838447fe703eaacd3d4b76d7f08838a4465df16c139bb9e2776a24c9952f1610f62bbe7', '8c111922d0a04debf5e06d7458699761ec6c88da8a84cd431a203edf94bb46675e1b2f18d4db0079', 0, '2019-02-06 09:57:04'),
('6efcc27114d0423deba51a0c180c1939299fd0b261ef6b3eb317c26123100037ab5bd4da2fec66ff', '0b23a72519cd0f294c274ab550adf4ea98103888332bc153d575cbf8a27b5e1093ca720415ec1fef', 0, '2019-12-19 01:42:32'),
('6f108d9b7e2cf28cfc4560b56335c2c2ac8d579f9e7f0c0bb67f3a5087da26e96d7a1d6c9e0eab3b', 'db0627c941d2cb91c7dca012eef18cafd02cccf6dd00988517c04fceed8eda9caa2494d9cf369c8e', 0, '2019-04-09 11:28:40'),
('6f3264bfc4cfead6153b8aabd4eb289f75a041a63364fdc8077c671f2137b8af6c5230cc45bce1c8', '8b6cda21e7b1a4a21bc961c9066f033c5066e1669537ee1bb9474221276b054abe6fc9524a81eb79', 0, '2019-03-26 05:53:24'),
('6f95e5e3d70d791f527613aebe96b54fb44f48ba840e6b3b5db6a7aa756fe54d8a5aa3bc609ce36a', 'e6bd4d4bb52dfac6aeed7090b88af8c364a031d0130897e759cd40d9ab1da80e4f8ca6cf39ae96bf', 0, '2019-05-03 10:48:28'),
('6fc309e80c0d9cb42a7c8ba42447072a6b8f77504cf3c9f1be9c33e1abe34f0ed104fcac38084b72', '814c2543aead5c35c441423b5512e5011ca26c788b41eec33344fccc342b7c92bbd174332acd81bf', 0, '2019-02-07 04:47:18'),
('6ffb51e9d85830f314ecc663bae3e996557dac284342ef5acab726c702756896993691efd94afc8a', '479f43d59de739003261cba70c9bbe7b114494b7d198172c79bc290d55ee0f415b9892dc36751dd1', 0, '2019-03-29 08:04:08'),
('6ffc379119d992a058962fdb98ddf7047419b89fe0d72f9b573506db39b2f63de005933c0024c337', 'f4ac89440555cb834b79b07fda118ee5ef3d9d44cc1710ce3d603ffc9aba2ab065f61dda1ba28c23', 0, '2020-07-20 14:05:59'),
('7001b742cc45f106a343d9683d85f45a21e0c7162b14334c35bf30c150b1636cfcdb0a7c29836f75', 'cdc5802d6d88563c002edd2cfaf58bc0743ac3f627f327e264ed37c1a1215794ce7d013985c072ed', 0, '2019-05-09 03:58:42'),
('7025ac9668078364a872a9df8660aa82145892662276bed0a6bcfbd75ed17bc8cb00790be211c13a', 'a26c3c806658988199246f97a92249c2a2fc78a298c06cf4d04024e1ed965d474fe212daec58854a', 0, '2019-10-12 14:58:51'),
('707270f4ac8b988d8100b1d31219c8d87326b0b9d86b8cb1e392ef37882104a0b46225aff6d16ee1', '10e701ae641f6130c822fec9041b76d4075adc2a3ed50b060cd39e71801d2db18e59324647a004e5', 0, '2020-03-20 23:37:53'),
('7072f42bb42c34356e527b3f33675f7500c8b170495e27244cba894286e30185a4c97a326b2da8c9', 'de6608d1c78c6f687f03c4fefabc84719f162346851da1322845e803eb6a239615c12d6da50a4428', 0, '2019-02-06 12:56:49'),
('70948288b1058581aa9a518523eed155e780d52a565e2888f3b1d8b2b41d326dc0fa4eec865a0504', 'd98f14d4da6796976b55d9acbf7127ede5d842aa511f01c9b94027ed78fd67d88477c576d86bfdab', 0, '2019-07-24 03:20:25'),
('70a6b73dedd2030c0c7c4503559995b26f7b42da6c01d483cdae013860bd941d3143c031173136e0', 'c7827f628d147f8cad287d08683e1d1841adc3ecd47f43a3aa2074c8bc6edc43c0c1e1a3725d8ef7', 0, '2019-09-25 04:00:38'),
('70a93f3badd490a1a881283cf4aed6292b076e25a404a2d73c8edb8d0ca59b29e47bdcb49e4fcf8f', '416313d91855c59db8cae7bbcf0690b6efac5781b04f25441523d408237cd59a9fa8ccc0be3bc288', 0, '2020-04-10 01:34:17'),
('70fb9ba0488762bbff188004d3eb2beac238ec42d75acbba389f7f39d44968b28380f83c89581a16', '59fbe92cc40dd223978a4889a2dcc6c2f2ca93c69088c5ae2fced7c9aaa8f3a222b9fc9d7d6c3165', 0, '2019-02-06 06:59:04'),
('7117444aefb9a3b453c3686f025115b6c92f669ae8a46e4584818fdccce1acce3c8a1e307683cf75', 'bbe5a5b8e60dd32febfe112c5e19ddbc9790d556062b39965fda3398cdaf1ce4d735c2ebe95369ef', 0, '2020-02-11 05:31:33'),
('7126fb51d405fc795454564fbee5dc81cacdb0680d2f3502a4f505e0cbe64d77096b6cbfacef3b1f', '101299af011d5858a2cc1361b9a49054ed5f542329f6ae1b19217bc58f5bbb9cf01fdd1fed4d5119', 0, '2019-05-17 13:04:29'),
('714b967744fc55403e311e59c6c59a6a6708e36839eed043d1ebc986c548df0c52c20a2c6624bd2e', '3b04b4e5e582517e4cd4b916bef5297a4123b445a18c5f60bcbec31e95b78224c8d1a157f699c7da', 0, '2020-02-14 02:02:45'),
('71637674db2403139cfcd7bc6b41527f8cf40e41fdc8dbdbdda09686c2207b2df01caaaef4c3e23e', 'b9bcfe3e14718eab1a76972763ea87e129451eb7654c5c03257f5027fc1d5d4aac390010f4dde690', 0, '2019-10-11 07:35:13'),
('717e5cf411278d99b44bb272827cedad84b9041c10d8e372b9b5319132c2caff83fa1d96a1d1eaf5', 'fe1366d1da90c8dfb606acf577e78fdc8f9e84ba2629c4e52c830c805a28954a8af38f47825f5e9f', 0, '2019-05-14 09:43:51'),
('71ee3038a7563a30cbd6fcc9b567658396f5e474346689f0b55b16ac70a6cc393b4b04a8b08eed17', 'e0f46564cca44c2eb3d8313db6eb40e964316891984854e456013e8630fab44f661b31550567ee1b', 0, '2020-06-25 01:56:58'),
('720c6d3eb3d3c43aa0ebcd05abc41217e4352d6455adf9e14897a2d5f24ee9a4d4983dbbbc42ee25', 'b0f9a012246d959dedfb41060e1075092d903a95d1583f77561128855171282d62cfc6dd36905f1b', 0, '2019-02-13 06:33:15'),
('72669a1336441657b0a372a18032f61f5909b8c518c8128e397b844670986eed9326324d4d1b3875', '4a8b0de8a89180a29f94ca14da2cc194b1d7f0072061e34e93076221584b508ee85bbeee34961e9e', 0, '2019-05-23 06:37:33'),
('72973b25b7264b9e15470765a5d52e3f7dc51172c159f94123c748a69178b11e30527fbb71a904d3', '2e7759eae315e1d1618aa8a649589665cf65ad6479334723679a84736ec3e0c6eb81610d0a22e962', 0, '2019-06-12 14:48:46'),
('7307e774d1b42b83c4371cb5e5f143ee7df97a454c2fec5207a2e21ecc98c4bebcd8b02198c19d58', 'afce3e4be3aa47334013a09b24e7cc9484410165aee757067c0781df5dead417c7b3c1376d0c8060', 0, '2019-02-27 03:48:14'),
('7314e3f26311d549f0b507ffc2233d1c4ec83e9841d3af9eab00dbb8b09745da6ee17e78b10bf57d', 'f5b37de09b3e1d828a7ba718df20faed1685f57e08a443c627fc66621cc3ade3dc1215e38404b76c', 0, '2019-12-21 00:34:35'),
('73590762f698952174fe13f39ffc38e334c3eaed02067ee9306aff6edfb1df0a787adb7c98662f5b', '3cc0cbd77d700ff1397e17d40365a680c47474fb3ba68434ff4ef7ce45012450075541f5a77fb1dc', 0, '2019-11-28 05:25:31'),
('73787333f7f70886d2d60ab84627f74b3aa156b81af602f2bc56a708419a29e5a536ec3cc27da46c', 'fdec06c8213e1116e4bae2eae9c0b287ea0c09019ab40327faf80ae6bcb1080834975a0aaf1762e2', 0, '2019-09-20 01:45:18'),
('73a1d9e26bb3eb171c3a7d574a225fcd659059960eaf5251aeb41d5064354eac52758b39c80e79c0', 'ec0630bfabdaa830ae4b5d206823d50ff8b9dcf57e602890262282de8ef5f449a644f4178bea9533', 0, '2019-05-03 11:08:51'),
('73c49e0b6e615a4acc3aef3d0a009f944f4da17a0cd5c42d9abc92c09947381128eda792de3701b6', '92751d286957eff356fe3961167dc2fa784d9a542f40b848263b9df38f04a5e25816b34908c23ce6', 0, '2019-05-31 11:41:07'),
('7423a717249c7f5df0601cd27cd9494f1cde75c312b50855e95ecfa0bc65c59210f5700d1e407166', '574cce2ed39c4b48d001e1a1c82e50b1ef356d339e01bab1e4f6aa0cbaa8a924b8c5b66d38dba93d', 0, '2019-03-22 12:38:10'),
('7435cde69a669dbcb7209e40dea9a5c934d09b43fa72ebc0b0597337bcc48f2db9320642aceda740', '651c24b2143e2fcf9a9f07d1473679b3a26e4b2a931cd12b4d3773d3d8ce4cd094e91dca4f376cc7', 0, '2019-05-21 06:23:06'),
('743606b8ccf8081d14ea5b71920d9243ab72d13ffac91778a4ac9f8763471373cc73ef3fe882e516', '55c67fc424f9c6efb0d4f510cb82dde1a2690f0d5333189f3fec72628194732871ff7a8bc132cd1f', 0, '2020-07-02 11:47:01'),
('743f8e3aebf31a51b99946ba9702d3b0b7946b1556d39ed40d9aa5dd84aa26f04e8f33db17037b1f', '528c7bd6f4a63fee49181657f3ca7c01c65343eab4e1e74797fcd3681d0d671fd0b4633dd2dca9a0', 0, '2019-04-24 11:45:12'),
('745d221664df9a182742f9cf47be6f97d102b83a10bd272ba4a7971d095fa42239a1db4cedfaae95', '37ea5c97bd07fdbdd64fea48321bcf699129ed5fa43b62fab40d878db325a323d736f2ad7a759949', 0, '2019-02-15 10:09:00'),
('748fa8985c2cd4c6f2d054aef13ce92f5130908da282448268004f62c862f6a0f8e508125a72c8c5', 'cb78bb71d326e8b9ee0bad5453bda423e8df2eadf8f9a719cd227350f2e292b558caef6ad1f77cab', 0, '2019-04-02 05:53:54'),
('74a2d247fa620d57ef007ad7d0f3ea568be857ca832ecef4a8ebbd9d260d59d33e0c748bfefb9357', '541039f60220d1e0025aa9b0faaaad2548f0d7ace22147b7c8717d0172d2d73fd0d0d7c7f3c7223e', 0, '2019-05-22 11:21:45'),
('74f7c98da49b6f026395adc7eb40f19acc64e986b263b350db0a9c6b433babc946281ccdbbe4c27d', 'a84a897eeffbaff1168b2cab1b69f2e4c95112d7ebe1a55c6ebfc1d637c3385a14943f21641ab6fa', 0, '2020-02-20 22:48:21'),
('74feee7bc20d272d1cc2e00bcde2334c666bea31a9a9e648a7c73d0983ddcccc37033d7c8d0dbf11', '0813309973ff1679dcdee9f4678b749fb0cadf4fc6aeb88452ea1066d6e315614f562e7a0d6ba642', 0, '2019-05-19 14:54:09'),
('7500fd3eaaeee7e68ecf8aa0da8f58a2a4b20649773ba0e7b5208d2f287bc00748b242648e1dce9c', '6f8213db037de3629a6c96e7833c75cae8ac5e4f584a1e4707fb7853b0ac93246dbede9dcbc6acfd', 0, '2020-01-18 04:35:15'),
('7526f6fbe424fe14cbd107cbc2d4de168f639bc3b083a888403815138a9d42f9d82d5c6ea7f96719', 'dece83b6735139ffa4b034132b711a14d252e4a5ec191ca427b4ffb092520b42947703849bee8737', 0, '2019-10-13 04:40:08'),
('75355dc07e4be8b1445d42890176b12e0044d1efadd9ca828127c25f501cbd3ac5d479b4640ee15a', 'c3ee501bb335c1c7e76b33827be73efbb8e3a2e369b9a135972fb762fa148f82d197c258addb8a42', 0, '2019-03-20 07:33:48'),
('7548867585205b11c78d522cc04169371a3098b7430c58fa3f25e48f0a9afb1ed9c203c8e68b8ff4', '433218836226eb8e364cf24146e8262decc427ec0759c51088ef8f757e96bf6d98345b96b9fab225', 0, '2019-09-25 04:00:59'),
('757ab2a402b636a4faacbe6404ad4290f568851de1c9c8de42f9e8b487016a3babf64415993d2ab1', '2289bf1828b7dd6f2d4cb0c1ea65b7a291cb1c855dec59dd069e77f2d9aee77857eab830787c70f6', 0, '2019-05-18 04:26:22'),
('75818d386c43d7f5fd60a71e967bf412adc829867ca6afff1a65817a536d58687c9e2d6f19404749', 'ab0dc7329a0c0e4caef831358e17655ceb03e2f07adfb5b1653823c31973016ff72ff13ed7685a8e', 0, '2019-02-16 12:14:28'),
('759a3009b0dbea7a82cde188264f4dac5d8698b5cbf532041c0773a60c30d41b41d125e8f7f3b31c', '489ef6fa4ca6a0ff188cd9673f17f52670e3c25250ecfce80d81d09eb7077a65f82031151df2f3c3', 0, '2019-03-21 04:54:55'),
('75d17dd1653da87a6f9be30e10abb0ce457f6a02a01996f6b5e9722685a116c90dca9b2ddb56d94d', 'a8709bc9756535eac1bd6ce9c6d4427f6cc26c60b2e7e86da13dae7616a0ddc3a740be4f0a5ffc34', 0, '2020-01-18 03:43:37'),
('75ec36480f3488418a05f537ea028d669eabfdd87dd4c84b578b23e90a0f20c6a988c53fc0f6e84a', '61981a714daccee5b19cd048fad1c4e7685832af17819526a083c9fe6a82b06f85949255efeadf21', 0, '2020-02-19 15:46:06'),
('761d7dfb2243b7267ad6a0847a5678f7a3cbf9a29f4d2fb706fe797f80afc530a1d345232e60af81', 'cb140bdae749916972d133622c7ba495350d6b6a63a755f3d872d5871d888734fc8963928d2ff49a', 0, '2019-10-09 18:02:37'),
('7625936be73381374718429eb01ef209cc0f84524fda81e669a86f27df210233037e6b228561f1b9', '5c05c57c184143cb17d6bcc0a2c7be530ef7707badf5d41f95c869fdf1fd38dbcf7c6372d1d3649a', 0, '2019-02-13 14:05:45'),
('767dc78b94690aac7d860877516f53189aa1e3a635bea543c19e363538b812a5f6229c7bbb089a1c', 'b9b4c583ce4abfc2adc0af989a83323f426ca64df76e5470559cfc8232539725b13f3539bc197560', 0, '2019-02-07 07:23:48'),
('7690559aaa42caf34754aaa59d15c25031c6ef98080a72616259d81f299dfc773728bc5c65e7d971', 'd72655ab0cf88215690f6e13cf5dd47ca9e859932321dd31e5cd518ed5d2342c502d5bff8e178ff7', 0, '2019-09-25 08:23:57'),
('76b294177ebc79e56fad696ad2305b44852257e158ce438ae31c737ae5b3a1999875d6dd9aa67e7e', 'cd7cb54866f7bdfad7e9784beb84a1624a3a8d59fb7fe419fc5b71bd74bca473237c3dc4c545e661', 0, '2019-03-30 06:13:24'),
('76c6624b096a9b38283095b55b6a1c36a05a8bc6e020ddaf0bf9846331cd519d24f3ce3fcd27f69c', '7a15f6de6d8eb3ad624221ae9d78593f94d140fb3e8585738000491705e6a4c8a107eeada892d8eb', 0, '2019-02-06 10:52:11'),
('76f57b47b0661b00bec6c641b1d782b761359c18a0593c4ae348c21b33ca579f9f6b824e99b30564', '066c0c0e553904259df037f17ba7b8f317035ff04bd4eb2be8c06ea6ea4d10a717300d5d3a74e517', 0, '2020-01-18 03:49:29'),
('770398baacb04a267c26c2d255e8a0f33fea17277551e14aa3d8f0111e1b11804bbdc6f201a4464c', 'a4d5a520c0141850d4736ff75dde5afdebf6f079d17fca195a1e346662c51cade7cbfa3da3c66059', 0, '2019-04-27 10:18:17'),
('7721612c38fe2be220b6ee11a8f225d31772eb7b1a73c83363586d9e55e869cb8dcc99a25f0a4859', 'ac962e3564d52f2ae090c9a9f9457be857dc0fe017da997f45400e603e7e364b9ecc4161cef32927', 0, '2019-02-08 04:47:51'),
('773c95f5fa079621d9cb0a98046943bbf9c9b1897d741d8bd998d7030d269e119d2e3820a634852d', '7fe3b5a223b50ffd6d0c4e8ceefc26895b0fb5f5adceaf25475a2a8e24e56ba1504d0cee9c5d04f2', 0, '2019-02-07 04:52:17'),
('773e9bf8092f18c469744f8ae2d72a0660a1657924db0697fa8a3a10490801b83d7d9883dfc62e21', '2e5b3e05196c3360994d69dbabaa7b18925aa598a1d039805ae58f845c438be29bd6be7656004d74', 0, '2019-11-29 12:04:09'),
('77511abac433e7235005859ee4b12568bfdf1044af788f46b6d71a23767fbcbe4b3b131dff8e143a', 'e8ea3f043edd6955e956c0f6284bb25da9c83578d36a158b3a7c447ca35b385515c22148aa24aa74', 0, '2020-03-12 23:56:56'),
('776c65ae1ad55af1bbc7214cd9a370ab8ffdd1d0e06a3049c84c6b13162bb296f58a614717ef51c9', '51a223fa9b9d1ac17ee2d1c42ecd71119b9bf678ee3662c287edeeea1f30f208fa390bbdb38f2b9a', 0, '2020-03-20 23:45:33'),
('778e69bd69bea06d781c57e8d05893f747ec12eb6200d12f50f4749a0aa1d3c4ee61a093fab606d0', '86e8ff80914ce897f01dfbe9ea966bff9edacea814e3d40ddd32f2493697d486c31272b97dbfd41d', 0, '2019-05-21 10:36:25'),
('779d85d5c11c3d847034d99cc1ededc645871650f74fd4986073cf8f377a543f57a9ac59292ee3f2', 'f5577b5d1e74cdd497eff507325edfcf42cab6d7c4f1abb25e44366f967b01f77b1b1bbcf784c5f8', 0, '2019-02-06 10:44:58'),
('77d0798b64fade06159c3e7e349d49ce84ea2e443fe5c76b3f7352272fd58f69d1569eae88873aff', 'bf7eddf8132f6e848023e9cadd5c6208215c07b4f24c54f4ec2880fb3ab353aa683aee3c7f8bbd50', 0, '2019-03-22 10:47:08'),
('78026e235c55ef347ab6091fe937760646a8d23ac0103d3f0c471a998ea2c5a3b6ac89219ee153e1', '196bfbc6cf964341b80bf389d3fd4e4e729b31f2634813d49480b97d87e6a242b4d3766f9861af7f', 0, '2019-04-27 09:47:26'),
('7832cd4588449f6a9a0881e02e91abcc047833b0224d0e1a415e3648d4a1986bfef54eff135409b9', '499dfe8f51a6d16538183eaaf0d802f271fd3b3496e9a30a8d282713702e2dc1734d83c97944c34c', 0, '2019-03-22 06:40:58'),
('7841d4afc662722a2b6f2178e6bcc88588bc606894e8d79c3e1691b65be3f25ce6235c54f876db71', '8fad8df3e66558a322a59bdadcfbdef5cfdab1fc8700c754b728834591566210dbfcd1dd3f9edbfa', 0, '2020-05-03 21:31:39'),
('78506336a0de9588bcbcadaa51f61e9d84b809987cb2c541f21827e6c4abb380c8816632c8ef9f1c', 'c546e6619105388f4d934606e35545c98a9c5b704a9bdcac768e1b830cf43ea73ca1721c1363a7cd', 0, '2019-02-08 08:53:59'),
('785f4aa8690b9baf26a2a2c05a0d7aba3f36baa340ca239e14ca7cb1ea5008338b5baae6c7bdb6cb', '9e53e231881994967d4d5a64aeac9a77527ee20d680442c65c08fe03393980704a08f3a18e2396e4', 0, '2019-04-12 05:55:57'),
('791acd4355c560230bda1e063ac40e870afec14d4391dddffbafd2f36fe50e4bb9cd301ead40aac2', '4cdde1780dafaee157a49f88777976c39d07f531abc3493d3f782279944866dc037b17a91296db70', 0, '2019-10-10 11:40:37'),
('79304ff3457801edd4532659d16fe91a4bcf0103ae546f93ed7d7f7e04f0339a83ea1495a980fe5d', 'f32eda01131fa3bbca399b61abdd24df25f9c4709c82b3d14ca9e6dbf397983ddf21c79e9d664c8f', 0, '2019-05-18 04:56:15'),
('7957b1d2de6c65facdc9e3c0b48edb02ef3c075a722aad3b27369edaab3ce189a284e32222f64279', 'b8da8a6cd89c8ce167143d40f03a38ad7e41911624043b8b49bd50dacaf9c032d2debfc4338dd013', 0, '2019-05-14 04:30:04'),
('79580444ba3001efbd7780145f468828f5288389e6e869fa422df417bae14bbfe38b7efdf99cbda7', 'e1a968d0ebb85a2bc133f00621bbd47e71fe4c4b73eabaf42ed007b83a215a3a18612c0fb486aa63', 0, '2019-10-12 00:59:46'),
('79dfaf3d77a985aa3dc1c7a1713c7ffe68411be2e288b83b437aa359afb81d70592b67aee1cf2945', '6609c72195941332f5b85802f1d48f1a44cba8abc9d05eb8bc08bdd893cb94aa947e16e133377839', 0, '2019-05-21 11:13:06'),
('79e0ac4065feaa21c2f0b34bd1572fe1fb4efa26ecdb73fc6397685196b5194fe24e820ca57a7c52', '5411886ffb7056dba33777d5c4d177ba483f89c5c391733db6b9fa3bb03eb9788af260ecd0914af4', 0, '2019-07-24 00:45:53'),
('7a25eaa5d7b893ece50ce8115e375ffd3236a85e646be36b10c0dfc725ed20e44c933232f3591fd5', '70300496c0b783f592a714d40a3bee6f36eb7a8446bf72ca902034295a0dab992fe2a796cf29d02e', 0, '2019-04-25 07:02:53'),
('7a31688fd984b18a337e4d3ae67cfe753773d861fa8a07bfc096621cf8c7d376013702b3257a159c', 'ed3fac270887c8e449b8b7785c5b67ef7a25d6a8a34a9eee507d452432563a53046a6bb4043a6b70', 0, '2020-02-12 04:26:22'),
('7a3214c5049f1b392f330ed513fc3ded711046667e7d040c9db1766170a186587b3277954c720a7b', '088738920344cc2df5d3fdae123122393eedc86d5c931847a94987851f1761b1a48462852addc7b5', 0, '2019-02-16 12:13:37'),
('7a5599e093dcf08ec35f3367966cd06af8e36b58126d1f559c5dcbf3b3bf04eb69267b85c457c8f4', '91ad3b04b6536d5ede032b3db5a066b58378fbfe3429889bd87cb5b1ce855e0ccca7a423f26a388f', 0, '2020-04-10 05:41:14'),
('7aa74b12a736c13b64d7ecf4a2243c7714d3e3aaa739973cd8422c60c76518e9504d8ccfbd7050ef', '0f25f6b28ece2ac07a7317d570b04d4d22a25dbf90c3eefb5ff1ed568e435b199025e404bcf34680', 0, '2019-10-09 17:53:47'),
('7aa9c145415678bf4a180636beb189e96c2e1ddcb001063fbeea7d2e9cb4bc86649d2b9a332e277a', 'f843ad71e82343eaa0d2b26bd1ee2265d89b6611e7bd9c128d6d8dfb106b3ef9a7f90a4566e3fd2d', 0, '2019-05-18 05:59:57'),
('7aad25511bd5d9e72c6e4130bce4c258ee3951b39fee94e8285e7fec73fbf43cc4bacf5048853971', 'fbe82912157393653a1884f8b5fffb4c31d014f5734f16c8c388f615f476a823ffb773aee680fb5e', 0, '2019-03-29 10:18:32'),
('7b2108c5c0ae1eaf0cf6097facd1e370fb797c261477500043c88b3571719cd7a08c489776c26068', '4fbc8ed75adf067d053c844bf2d0828e5a6e90c4aa640539ebf1f93b844f688de30dd61e285794a0', 0, '2019-03-21 11:55:54'),
('7b687dc16b0b677f4f3150e05c654c5b83b4d8df62d37d38570e0537b8f1923694336851bcd8f0bf', 'd291283db39f3463ea82c2868c5ca11de1200a8e3d262324d9dc89f763346c3aacec4fb194272e6e', 0, '2019-05-25 11:21:20'),
('7b746d10af43ca4d0b785dff8ee8592ffbc9ba68e374653c53fdc11a7e6c707f765eafe4973fa0b4', 'd99d1dcc9f073c0fc6e1459d40e976236f7a6deb68fcee362b077145ccb782ef17c86a89f5234753', 0, '2019-05-01 05:18:36'),
('7b96b653b7200a4e95014dbdd1aabd76aa2d6e08eb888452c05bdc76c3c13edf6a4e4479e6f1c51e', '0757fbf4472b4bc9ac2d8142c50bf976410d63e155ea349d33349b676f66dd1319585c0f9acd4cb3', 0, '2019-05-03 11:13:08'),
('7bf7de74659402080a46afac7441080716f992218da19d7364368bff5dd669dfc78052473e3edbfc', '1c95dc7ad702e25d49538f6132fef2a88ae71967078d4420a88403fa2a8b9a14a510fbfa7816eb5e', 0, '2020-01-22 05:21:14'),
('7c0b63fc8a341aa9ef13be8e17972b33d9fd23810e9122533b1442f14761d6ddfd2cef8469f5a3e9', 'd62865648d5611f3cb6d78d13756c71866f0bcb2d9202acbbe21607a01921be5788d2577867a5308', 0, '2019-03-16 05:22:24'),
('7c440cca58b11d53e3af666a5e9511fc2201a02ba551f7f4b4dc709bc13ba262ce7c1b823a4bc0a3', '6b78e9aad6ef5e228b380f057c9d2c65934386ffb58530a796d5dfb5c98550e3b1d78bf138941e55', 0, '2019-10-09 06:55:37'),
('7c89ba06dafc319a0a74e03621a6f12ee85a5ca6bcfe16c16c859011659371d8a9f08a279d9493d9', '5c082580dd2c5ca1abff8a21387ffbeb4e06b85b3748cd0b9316c1e9d3191527d0f4343d1a5066d9', 0, '2019-03-30 08:42:48'),
('7cad7a2d94c33b5893bbe1fcca54d4d2564d0b58ece36ded7e235fd454e53e77f7e4c6f9720a0e18', 'c995ed54424b85ca04aaf31c7cb55f4145f275f68d8d54b938ac92c9eaf0fe8141e59d93afd59a51', 0, '2019-03-16 10:33:34'),
('7ce834e2bff4e92426711bd8a63b0a28849a7d189b500af0069121674e62a0887efc698f4d1da114', '54f026fcc5fd3c55d295c70e99e51303f18ac74e10f7a5bcbc0bfcbb55d0171959d31e576512346c', 0, '2019-10-23 17:17:24'),
('7cf3cb6446c1fd8ec9660a42cc2681b3a6576a82fea16d09db830edd26c26cb67cd391de6fff5b1d', '1807eb17d6f619611db54bbba5ac86d0d559786f1af3b809ba9ee94954459fae60fbe3998e8d8e73', 0, '2019-12-10 22:03:36'),
('7cf885528033d4afd115965204d0ea2dd968855981614f32db99a3e3c7a7b023faef99a57a08f496', 'f13a2dd221a5aa36321dff68fbb3c7bb3b9ec62e9de91e128000e789a2249e1c6a059670028e928b', 0, '2019-08-16 09:08:45'),
('7d069ca7b7670e34f160fd2f7e470b0545d17c170a6ee0e1c664337f815ce8495a3bfe1eb692a5cd', 'd0fe8fc4e7a9e7740d655ba6afe99e99503e64a849a4a65f32da605033e84013e30cc6e02df84c84', 0, '2020-02-13 00:10:23'),
('7d106d1ec99b096a5d4cafd161986280f24fe9102e3091028f7dcf32e1da8c036d1d0153ec7f1a59', 'c5d88faa20e4653a159246fe78ae8ef4daedd5ce7a138ff312984092c0aa3a4233717716e61e69ac', 0, '2019-05-17 15:26:53'),
('7d330f12620d83738fe6f4d86b2f693b022ef113190478fa65f97f3f59d04317c99f07fdee6afe61', 'fbad0e4833a7d54e8f32cc686a791990826839277400d846a0765096ae8f05a9441621a51d063c19', 0, '2019-05-09 12:06:09'),
('7d4a9e43409da500cba3fcf80b0e11ab471d4511e46c37bd0f72bc3145efd0f161f25065744ff059', '440d2142e1bedeae386795270147f69a204b3bccd8430aaf6f65d29ee8a9ac4d58ce764c666af3e0', 0, '2019-06-12 14:25:10'),
('7d6857dfc2f21f14367f06ac562f549ffb6b2b042101882b3b0136f2d438e867eb157c90941bf678', '42cb378059c7c457d1ee0678882ff763db3e7d9a935caec5cd41db7f6eaf42a4f12ccc684a8fb2b5', 0, '2019-03-23 09:10:28'),
('7d6c92a1c0f79e790c5a8737debafac770db884051173ededf9dc07d961ccb9c62b18755a82e9e8f', 'eb6e2357fd8606c8a93ed7b795036771eb83b9752700fb68806bd3c8e7f11af58b8b51b1f8b01b7f', 0, '2019-07-20 02:04:31'),
('7dabedb46c774a05a4811e987e779327749cb0f21e4079604652171424ec5b64011003645ad9762a', 'd986f643ec079e6571790ff36dab000ef886dab45f776468b3c518c2d7d342d487d83d8e27ae4c9d', 0, '2019-05-18 05:10:07'),
('7de1ed1d6a9e0a1209dcc6cd4fbf8bc423b89a843c4fbacaf2db857002fab00a192426a1a1182584', 'd097f3cccfe828d73ebc7a6123360b1f048db8da86a39b6abf8ba33ec3e04d2b40597d11a3b1d640', 0, '2019-04-15 03:38:28'),
('7df202fd06596f5b67c700a03af763365b0e5099a989d6c26a60fa322b79aeb30fcdb747f0ee3c2d', '35c4689c9db755a81db737861a819bb5d79b837d35b4698f2f3c5ecf4ebee2b7ef8f3ab62201e452', 0, '2019-05-04 05:34:31'),
('7dfd903ab21cf6384f3860eb9c494d91eb0a39fdb9fdf6cec79644fca110730d2bd91348611a08ef', '95292de3350ebcac6730a49f7eaf21e8338377b213462a83acce5646b7e9d75a918dbba7b1529be3', 0, '2020-02-11 05:55:31'),
('7e1ec87e36257cd538e40178e118f0018f0af586b8d34784d8f4f29f019b84c35db3ff733ad02692', '19ab247ad5be89d574f11dbaa6fd6e074e6742434a8c85861147afd485f8c1d5dffebc5f66cd752b', 0, '2020-10-29 06:34:04'),
('7e47361a61889ab07e9267ac9f5dc5897981e64581ee39df09ddeebc633a60af46574b0db43942f8', '437a1c20364578063ca57bce4d2b5d398482208baf708e5009ddb689e8403db70e1b7848babf2923', 0, '2019-02-16 11:52:40'),
('7e5200892dea6abfdefe49ec86986bd03a960e8275ca431696117f74beed94da0ea4495d93b63725', '794ae9c1f29b5a3354e981e9fb4c7dbc50bdc962e2677c4e1c5d37fb160afafc5698ccab19ae110f', 0, '2019-03-23 09:17:25'),
('7eaf978b1e07cb489a6d68b2a0d2730f01960687f47401134d07a3fd88f3ad72509404f392fcda99', '2046494cad0d82b1776cb03eb49bfd01e0fcfe12c9c121008e3f3d908d4c827888fbc74271f81d2c', 0, '2020-02-14 00:46:34'),
('7ed35274062a300d1ddbec163e9ebba0985bc544b5ffc4183e4e5a2daf08325fd2d06d8b6278179b', '29250d4340c297699daa98415e94ca25544a6a5fa9e1a266481aa392ed65d3725df83a06960ef6ae', 0, '2019-02-07 12:37:54'),
('7eda04e43b1c0bddbe7bc898d31812a7446579389ec8286c54f596c5fd13b0b17a9f42c453c4686f', '686622aee85fc96aa0d2ffd68509083f8417ebbd0d103858647da718f3fd00c05ef67fcc41753c41', 0, '2019-02-08 09:34:39'),
('7f4c8bb9037ac5bf9756cc0e6e8c5734c87e79833b225806c0df74d432b5524da0c8d39c82e3f1fd', 'd36f7842de5ca7b5dbbd621280bfad206dfbc6c4aabf2ed3c0a08352945a85e0c50439249cdbf6f6', 0, '2019-10-10 12:23:22'),
('7f518a6def705bf6b74f470bd534a2949d3f4b3bb6608ab4f2a993333d2a993708136248734f1889', 'f4a8a4c0feaa7e523de776d26d1695de55fa7d1ddd0d8ba97b1024c108fd20c0c3768e659cff32b2', 0, '2019-02-12 08:04:54'),
('7f90473ec5ff481c9ad502103170c663f06b3c56d7e4f11f7b2dca1e61f34dcc849f4cd67606b1bc', '4c581c3cc12cd44c1b6a567866b0901dc8764565159b73711a2ccae78dd5da8aa19687b77460ed88', 0, '2020-02-10 23:23:00'),
('7fb9429ab7f0eeb4c60dadd40d5deec06d83a212aa4188705136aac057428a9dbcef87cb04c4f7f2', '5653e3626d782ed0502f01e02a6bc24cb76227fd77da9a0858565aaa3584daf6794de8f85ec00392', 0, '2019-07-27 12:16:44'),
('7fc2f5fb848f812ac2f76ceb618de10d2337fda49c8d2d1773af9ae03872a21c9e8931632aa8dc0c', '22dad4d8b394065669d073c3917b624e1029cab7e56f8b15043b968ffe6b08db4b9f5292d3136d18', 0, '2019-11-27 09:28:32'),
('7fcbe1123aa8176f632014ef2a308f26e177485c8228d5d390cc07bbf6ff38625a656c522b44d4a2', 'bbe163669140a12c743904ff68fc0085267e09d74e63ac30d2e66c8524a835edd5106e904d046dd4', 0, '2020-02-14 00:24:43'),
('801eaeb6bba7716c5bca4515df2f0f944981253758076672e6ea1431dfb258197197a4e64e6d2880', '9f5f9830286540604c73bc9cffe9f028934c553f2faa3d43f06d652fc04ebd65978ed3ccd8b38482', 0, '2019-05-31 07:33:52'),
('8083f5eff3ae6103ee2a4c2e387aa319403b844c327b5db8e9c886be94748c9b79554cc346a5dda4', 'faf6e3ed5baf858a7445604de6f6224b2e47f066928fe745cd0e4154fcb6e5037cd9a2246c32d073', 0, '2019-05-04 10:52:03'),
('80978ebac9198969c32aa1e32d2e02ba7094dbaa31be4863cc2d791114050493e2d5294976c9a3b8', 'c2d00e88a7ef93b3ea73f0647cb9fc5658977968429ce043124761536b441900a9601f7c19208926', 0, '2019-02-15 07:33:30'),
('80b7827786da7bf77ffbe11f8e748cb2abbba37fad334bc02c2bf94615ab9e66f5d4aa8ce6253828', '6c405e72144d65d8bdeb05f805e5dfae09745be8097be9593736047bb982cb0d970abecbe43e43a6', 0, '2019-05-18 06:02:14'),
('80f7eb2d22da4693d8ad95aa3633c92804d0a18145bafacd922eb6381a5cbc1a74a70586fd8d4a20', '472f78a9b223d0c702dc0257834cd9965fb0def2f4fcbe9041d0712ef8bb4f10b37da73b9a21ff04', 0, '2019-10-11 04:12:54'),
('81023f37b384704ded01c601d3e59e831ea27495faf7598b6cde3c2d34302e27ed3bdb27fc7e05ba', '51692742f3d48cea81625076454f4de1c609adcfbfa0741790fa825ba87ac7c3221a4dc30589a62c', 0, '2019-02-08 11:10:50'),
('8124e071cda504cbc2ffae7bb0f970f757a1d9f927b7e90a2a6ba71eb2b34977f1e8a65471b23d83', 'abb558d91078987a7c9d884d505564281d7065fee9b74072aba1c275d0a03c29d102fcf8b7034cf0', 0, '2020-05-24 14:34:34'),
('812d3c8115e809d46e64d67404c7873a5783a5f85cf3f48decb418400ac4ccd4736b2ec3036588eb', '4a4e0c2aa117107eed1b951053a8bcad2836d04a01dc5b457b8599cc7cd9360d7c8d4f8b2b65d727', 0, '2019-03-29 07:55:26'),
('813fa502280cdfa27ee8e993b6c9d1fc85d9bda250bc338ec19f939b372154b35229d067b3327e63', 'ca909f298949f634da48c5a2f990e031c06668bfdeab97a287c2c72c8bf1e5296a37736adfe63ded', 0, '2020-02-11 03:52:41'),
('81804e956e6fd7e44fc22049446f0b4af59fa6086a3dc3ce6d35693da449f06de5724432631f3085', '8b775bf048b49c1561b12c2561a844f75efc7187cb5d0c2269a076d40bfd9caff1ecc429425c24d4', 0, '2019-04-05 09:44:39'),
('81e88c4d04fe2491abbde3362fe6b9e5522581530e8bbb2b7bc0179f8dabe9f7dc6fd82f749f0927', 'dcfd676b3c7f35e83954c2d447fd4834b58f78e4dbfa07259438283b121aed3215346ec027299ca9', 0, '2019-02-07 07:30:13'),
('82132b4e03733de219875e45531be95894a43912125eec989ed8778f29fba9f5175e8db925bbc4b3', 'ed27f06734356dbbad19b9067b3c0c75a218b31fe57c01e38db3f7666cc672d66f18eade1f70a0ff', 0, '2019-03-22 12:43:27'),
('821c4dd23e122f57f6f7e73d3e62928c55133a22b53ff553ac451528ef4d20e2c6ea6cb5207f4938', '1b0ae03b296d8b472b245ceb2e30d446ac266d733dd67017db06a491ca78ec9d065ea1963348abf3', 0, '2019-02-12 13:13:54'),
('823e34e783678c5262a648d6b7da8db32cba7d5969663707948729d9487604de7ec5e8f991a869ec', 'e289f5956db91b9c08c4c68a38acd69c0f7921f678cdcf195ade1551c7c0b5d5798f2670b2de29a8', 0, '2019-10-18 18:03:27'),
('8242e40ae194502642145884bfa764e70cae76fac1dd90ddfa78c1a3f0af7125ed24af0e33b0d662', '985076998496bbaaa93851af6780f715fa8d932521309d2b744d28166e14d935ed847cfb900d239e', 0, '2019-04-10 04:46:47'),
('82642145d7e484a21ce212cfccf2315b808f437a0fc23b89dfc006d637b8cfe2cff49f0fff4c1922', '853e8ead9dc3f11717eca7530771eaff4fe72505fc769a6dfcdb773db05905c43b9583d4422e1ec1', 0, '2019-04-05 22:03:25'),
('828338a3faa25b95787808d8a4f301e6694dba539951c7141ae728ad3d9854e249b785e69bb59f32', '82682d632f8b8957dd9c650cd1cdb3a11ccffd855741e90c862ac4261bb789aa996596941816a69c', 0, '2019-10-02 07:35:15'),
('82a720035777be876c5ba5edf9c97e25646c499792d3174e7a63917aac840c97bb5a20afbd0cd62f', '50a52fa945763f0854de230eac737349b3dd82c3d3904839a020396dfc895b2ac2d418b76d2c26e1', 0, '2019-11-01 16:34:53'),
('82da9527febfb97c5b2173bc3abdf7bebd862c7754c1729237ff405469d06150584fbc0e913770a1', '79bf7cd856521327e2af454adf630afadaaf48b46a3efb75d8816faa222aaa270f843e8a6a255a29', 0, '2019-10-09 21:16:55'),
('830391c2c4de942f136a99b57337a65a4452ec601764dc80e48d6192964feea837e760ee8a96ab9c', '8949b0f16e5ab20d421d9ccddcc4fb068494200d98a312c2bdcde5b1c6b1e26eb026453257bf60f0', 0, '2019-03-15 06:39:45'),
('830a7d3fa83b598916bfc399acdf0d23d2373607c632c45d353b13dfb807cfae9ee47a4c70b00cd8', 'f28342da04e0932de24b843f7c943aa0172dd243ceff1f431aa6d272aaa18e90bd71f27c786ca1f7', 0, '2019-05-03 05:40:19'),
('8310d1a4633bdadd0a649f4477dcd97ea8b6b74a546b6dd9d9764c0326c77b92d6700ded2fae052d', 'd4694768fe06b9bc50f9cb425a1f4797375137a27cb4100f6641629ea9f0a89575d5f29df360e11b', 0, '2019-10-24 06:34:03'),
('831b36ad416076c85157fb73d84815b89dfa30c5439c31981a7c76849166c3e6bc1daefa2a8426fb', '22ef4ce2c00747d613011229187b3bcfb13e1145d32c154477acc4e125ec943cd828cb34e3d4eae7', 0, '2019-10-10 06:58:33'),
('8353448841d264e08534e066da4a23aa8ecc60023a40717cd57abca32cb640d5ae62ac83e60b53f2', '0193aaf735c161293e0c256232673eee77cb1159612fc86783b3ec1da80a8bfebecfe815503b3c0b', 0, '2019-04-17 13:43:43'),
('836c0f1f2abf78a6f9252e012a2d03907fbee17badd197b61b08257cbcb0da927e2e451758e65a83', 'd6aa3e21b867c9830d4184b71c0965e5c7e22397f0e14c8e6edfdded74521559a8193aa99c5c9a7c', 0, '2019-02-07 09:27:27'),
('83c3ec2c92c579ca6cfb0085c299bf9348847b9647a546e34b6726ce983b0e9bd472cebdf1a2a7f0', 'bea10e6a98cb7f5f20f106898719e9e5284c0abcf3304fe19bad2abbf754c64b40ac64e5cdb994a3', 0, '2019-07-23 12:16:24'),
('83f896cffb35bead5a656f88b1ff32e9b17b1eb9861dd0fce3bf94a94f8f6789011ea2cf1f26078a', '3e464154d045b73f2c10da018988d0550224e5352ae67a6f9cad1e2ec5be9a826a45de542e4e4702', 0, '2020-06-25 02:21:16'),
('8428658088341ae1bf9c2f4cd47ca6bbd167c8c3729196247d96001a539546bfefd2658ae0367a87', '57e707aea0e4a2a7af955d6c979ab9dacc26ae6dcfe868f6e49a7051e324996e136b7ca43aecb1b6', 0, '2019-02-07 11:38:32'),
('8472f10343510cab4aed9f5c41aecac82c1dd4d6bc11f686a01dcbcc21ba19da41bb17a68fca5d90', '7b3bc7c5c3c666183621c617cf7d494423c97bdadccd2bd256976d9d9fb80726aef2be928a6f59ce', 0, '2019-12-07 09:49:35'),
('848544116bf7ecbaa6b0504f3125fee8f92bc09998e04b4d9ae5293903f0cd51070214365f0bc3e2', '0a05d79f7aadb7f308a51d852b8c9e2baf2d87a6bcf075aa73a42c65b30ca11a62a6750e1f6a0235', 0, '2019-03-21 07:08:57'),
('8544bdeef533e13f414dc90d7081104634190a4653a57e79815a278f362448ad6ffa4e5e94d9f9fc', '2f0a3c710a8eb6a937ac1cde74423ea88231474b2f9060da15b6169e49a48b0af4865de30c5b6b8b', 0, '2020-02-11 06:21:39'),
('8594636a247af190acbcc0c38322c2f36c32786a8d9a603268e21ba646124620bd147f8134d07bc8', '7445b274cbe91d9210f38ae27441fc578bb6fab9523060e27128a07f6311cef7dae5e7e9a197ae8f', 0, '2019-02-12 11:15:01'),
('8596e41a0d9c9a2fde6a52a086b79d64f2876714046b51fc87a2f2a83e478187b2fe162595c338e3', '2d734950c79003fbd8b18b6bfb11556e0d7b9208dc8d6cfea7cc36ab504081b17cf7ead71f17da79', 0, '2019-04-25 07:11:48'),
('8598f25c8d907b9a405bb2488cb4e2ce25217925caf14a1a1989984b3b3f8f169f2fc46a8b6f9ced', 'b7a4752208657c68ace3565ce0a1fe4947c3f4458349f97761a050acaf81fcc27a11a8e8b81e7bd2', 0, '2020-04-11 21:34:23'),
('85ddf8486cf8aaf7fb365e8872d79540e50c34b8a4e9092debf8b30c4d8e1e02670c270d78b08549', '0e9c750ceedda63d270d11141e170f180f3f870ec133cfce2f26bf9ae54d8f917d8252484f45f889', 0, '2019-10-10 11:40:54'),
('85ec7749caa32413680f7460b436af8fc1e823ee7d1b311c77fdb59750ce39edc1b78ae9b4013bea', '356a093ce6bc5bd0a07cd08e46fb055cc1eac4b2dbb3ce9203ffdbfd46f531fcf42b7d02b85fe01d', 0, '2019-04-05 06:40:59'),
('8612272af042522174c471dc36442d9d9297d28675587d795619180bf69450055d7c812c98a9ad0f', 'b410e453b9dd23467d4df3150034d40dfb21b51d989a96ea0b5d6ebd50a5425685da7e5b7eeab605', 0, '2020-02-06 00:40:17'),
('862778cf19fcf457c64e9b21d3daa39f5dbf9f75e3294383a88f0652dd30cd98cbea4ee28a17b15e', '60d10cb5f26246f2423ce1d895f59e9a6d0d55e521a76cd61bcd60cffd9988e43c672abd384b6776', 0, '2019-06-12 14:17:41'),
('863e4ef7430a8de5214edece3e90ff157970e7ffb95ef3946b8057d5f2cdbc13a6cf2fc4b1f5d0ad', '7dbc2f0012c3b664635c86529808df52d8f3fd117c6666059f0dd3cab55d48efcd25a1bf85e62444', 0, '2019-02-09 12:01:28'),
('864290c987d67e126bcd7e037af0473bfbadf8fdda3941606f11a9ccdd70e916aa65516134882930', '123f87ee6e466566e36ca76f05d61d01587775d42eb52b8c912e2248519e9b63d403fc5643d1acae', 0, '2019-04-27 09:46:43'),
('8686a0451d126ec4c917c259f4581e276f607069f0b8ed777b0b2f12e472b409acbf48354b8c61f1', 'd1026bfd15f88392d64bce2405196063c1de331067ddc94d5fa9bd933f0bd8a174355e5cd42796c0', 0, '2019-02-08 06:19:56'),
('869763f045f4932e8f3593c8b97091327cd564473bf32713cb0831db76247ccdec30574db094e28d', '329836b759f98d7aa78a136f25d2021d24870ab26d5a7d1f71cf1c75968f507dde6b56643d6d36c4', 0, '2019-03-30 08:39:05'),
('86c6c03193bc7d7485c0f800790812d4262e6de41a37a23d3e663bed3440411bbe2fc2b10a1e3007', '38bfe15697344ef952158409db123ce197ecf804675baaa7d1983b1dc9e64c844842c859c5ac5e5d', 0, '2019-05-08 04:10:51'),
('86c7017d13bee554ccc1a420403dbe053f649d306f9c12ee3c44952f96c1e440fef3bd5692eda275', 'e87aa7624d5c8cfa3bcdae10498daa5c035e8f11ec3529d7118f7b2629109baaebd700f6e9b110ad', 0, '2019-04-25 05:01:47'),
('8718ead780cbd69ab894b68218e7ed59adc6e0a923a35beb02979e8e69884bdc804287a5cab4a4d0', 'ebfae85481f9f78c0ff8f75bbda950c93a0c42932e4a15a024f8567d85b3b0a39c6d1b178db66d8d', 0, '2019-10-01 07:30:44'),
('8762a4b86f03ae8d22cfa1b211565e951201570ec17a081d4597a6bba38b63dcecd740642a40c0a8', '5c28f50a85dc95dc30633157cf455250c4a642dd28fc3a418513dc87a7591a701a760337ed1b5bbb', 0, '2019-03-27 14:00:50'),
('877e68e2f4988d9c6b1cd1ee25beb75048b0c5889aa3d1547aad5ad465aadf98ab032d046be00cd6', '18509715d2d3b69dc0d8d1cc7fdee8a6b69279804b7f155deda2168942411fbeaf4efb6894ee3dd5', 0, '2019-05-09 06:33:17'),
('878e020324395fadd4f0ec16b5ba7a83db12b7d04d2a8e27dc0492305ec6830abf93bf3fc879465c', 'a70a2a1041d43417ee72473cf8bb9256ebb4e0e7ab2a5b0ad23bec21ea373f587d9c5b5a5a0d8c1e', 0, '2019-08-01 05:08:32'),
('87a7035a1e3006847ee313a90c2c1b6bcce98124bfe369bd4af5bd35cfeb030190598cbdcd1fe7ee', 'bc32b54bf43512fa177cc75cbf6623caeb790f067b77b08ead0853c07e48127c06232b3e09ff3dd4', 0, '2019-11-28 11:51:34'),
('87b164c56f2087c5c9607a701fb961b883021c44c65930f79d97a5afce708cb5fa6d2bffe5245aba', '2ef57d42bc532a3eea004c2cecf96f2cbe53a9badb200755ea8a35e4443fa59f6f4cb47b4451fc2a', 0, '2020-02-11 05:35:13'),
('87f5fe4b2f3793aeea33ce75cdf77afc74ec3b070501e605412b3242920d2439122c0a47010e2991', 'd5183b5e74665aae559fdfb66be2bf42c711e458a4dbf3682092e323de371a1909c89599d2b0e04a', 0, '2019-03-21 10:41:02'),
('8813a9e112eba27bc8221247bcf8da1d113f1f1ee47264aea10871d2b1af888532a0d45b5bdef0e6', '17164d95dfe8ecac4090b3f52608354f00e0cce98142b9a7c9b5a0376745d0dd35ebb85c5d797a48', 0, '2019-10-01 07:48:46'),
('88201afed687921b3aae6aa52057b9e253dc9907822d2fc6dfa42aca6ec9acd724ec0c039b1785ed', '0f6c41330c5d8c9b269ab7da93c44a25aaba1f0ff2829684443f349f7fb66b15c9e37dc4f1ae574d', 0, '2019-05-08 04:09:45'),
('882153618f87f4684ef7ea77057d5d45f8d402c87323708e087d105c0352ffb224b600d0ba5dcfd5', '1d82631b3a0b1c10c3e82905011ff28f521a65ac04a86a241c7275fdd671b6d457b2387ead0da7ba', 0, '2019-03-22 06:04:26'),
('8829abc0d9a78cdbb82c18e8fadedcc5cb26b1ffb4f1ecad405628f02765fc1a8c27a3766ae34f0e', '2157f8bf1c6e1a6b7acf633a43de761bcac26a62feaf0580a6cb925ef56fadeba1d0250f6d0633b0', 0, '2020-01-18 04:06:01'),
('8835943e291dec70f327239c6faa07f6eebbcb1270328159a59caba7150628a92d38543e1460e1c6', 'b4b21c00e891f7e2490b6b3f21b507fde9a761f2d0173a308175aba190b5a9c3b995bc458e05eb26', 0, '2019-08-02 09:02:11'),
('8870559eefce9f5a952570cb8d961f924051016c5b68b6f5425b4b1d7943fd113ffce4e6cf42f70e', 'a8e8556f9edc3def0673866745716b201d412975623e20c5c61e8d3b21b6b8841d0148a86581576d', 0, '2019-05-21 11:08:49'),
('888dcf0052dcb9c77893ee97209b3b8e77edffaf586cd5fb0b2877c808c5bd4e49233490f3931e4c', 'a6d8c2693549cf8a473779ac4e4e6b4d917ce9d920bded6c5c4b4c7f5e89e18a3be9649e469c57ff', 0, '2019-06-12 14:25:03'),
('88a6343dc9726b100082f95c44183b2d82a60fda112f1d9800e2b6a8083be7d58e816e5b1042ab95', '2a04d9c8ec5a6c26472ecc7a8b53761c35c048f3f51cc6f948efc564119caadc26c701c6525b3e0c', 0, '2019-10-10 13:22:24'),
('88ae7522c9b09af7075686115e0bc1700c443b08e80012195f46dad93f46a51feefd3ecb4e09a55a', '647a12def2fabd4b25c83209e804baef53d7fd55e7811a22d44a036521afbe4f6a9b2edfdfea3275', 0, '2020-01-22 05:33:08'),
('88db177c43808e1b72c94cb6cd741ec63ecc6dba1f9ff9d9bdc7bc4438a5b7811d7f2c402723fc8d', '4ca713005cfe8724255c5401f81e0bcecf5897482ad208318ef67fbbd3cedd197470e3e5140eb986', 0, '2019-05-03 13:23:13'),
('88ef856d02bedf15745d39e1febfe96790c823e726ce8ec32f8598cf1763b6fdf54c31611ec9384f', '8b7a4621201ddafd591fe3aa2423432a26017537144977062ee854338274788ec16bda5f2d6ba4da', 0, '2019-10-11 06:16:54'),
('89074c31e769a84a153a7e152c59a60622c42b871803752b75c9318d8e036773d37cfaa488cba1d0', '98ac90335fc5a4dfb654e3467abec60a7520fc359c2e9de29ef7629233c5ae4908471cce263949cb', 0, '2019-04-04 03:59:50'),
('890db0be69feaae5cee9903a545659ad3a43340e2e47308dac8f751226eeacc5694b1687c03593b4', '7de4f55ef8f558b993dabf1991a07319cbb742e6220ae92cbe73d48f95ec9249ee64818af282d4ef', 0, '2019-05-04 08:55:44'),
('8912c44a458677b82100ea482a1552c8eb75e7d47dc40a286ae3b264338e6c1b7244aecc407e357f', '42fa41a60ee415bd4c6db58b95036b664312b3d2629d91ef64ab804bae53c2fb505276d922f4f6ba', 0, '2020-02-11 05:59:42'),
('8958e629d621aa15200b9ce29603e42d4f6126680b7afef38fe694134715f2ad2116094298b90436', '9d642ca326f2d3aa84d59466f10fe4527c2eb8d4a6439c022ed8fb1c5c3278d084601c3b5a9375e5', 0, '2019-05-01 12:44:52'),
('89add3603efe077a7a805d91b93673e22a561e75a49e11d9f4dbad18689eb421e51a5004053088fd', '0ab44fe1015db898340cf2c09dc41516ac92753c89e9f704de0529fa766db7184d372cd58bd7ec75', 0, '2019-11-12 03:53:59'),
('89d6ac8fd98ea14185d8d162f17f80256705082701260183c369cfb855a7f8c65016d8c56e3d0407', '663571de6d8842a80a2c66d71a8eef2193e5c394e8746cfbc0e64378d7b9b9362e4b12de0d0a9900', 0, '2019-04-04 12:50:25'),
('89de878dfcb28108411f9b95e2e16812c5493cb66d0578e1d08ce3bbaa0cbe023b2e9d347aa95b04', '1e005b44d6a1da417c2bc71a89e4f6fe3f3d5f9c3a7dcee7459b6ec098e6fd548daa150ea494c864', 0, '2019-05-18 06:00:39'),
('89f376a23bd13ec0a77d3040fbabbb2acb7a6a206be25359a41a10646775115bc14b4cfecfb62064', 'a769ee24207f85b8356c15f3af829e5a26bf1833626102719cfd1a51b646d1121d2ec5f81a15a6c0', 0, '2019-12-05 00:58:59'),
('89ff9621678ce26daf214cb057f7eed4f2f010d85a4c97aa0902d776cef6fdd3bbf2218c51bb9d68', '53c140a7509bc345fd0a0afafb984797f8c56b49e185de96ede1bc94d650473da13896a6d9015c30', 0, '2019-05-04 09:17:46'),
('8a037fbe40e7b32576d3984dbe8a852966dbf60004cf2136540086dd19a7dc3a7cebe850cdaa0027', '008a9bb4ad1887e7c80fc3c1506b1132c35982f0a4df223f9d15eba8f5c4a1bc684ab83eb5adbf20', 0, '2019-10-08 06:09:19'),
('8a073536e9e68a88cb56fcbb3f8775312f19198a45fd5f2700b49d3f6d09d63c0d4db8266e93d922', '4f0fe0bfb4bdfb2e3cea49ca39e5d8c75080ea6b14ac64c3946cd73cae34d62f69716fcf5fd972c9', 0, '2019-12-26 01:56:07'),
('8a0d9a85dab4022aeb599eee36b86ca5d43cdaa31aed54b085bd0546bca581aa5244dce84c8ad034', 'd5da4e1721014a9ec20598bfdd091ed6faa43fe774a26d25757788d0fd7de48312899f0868808458', 0, '2019-03-23 10:56:53'),
('8a818bae2224ec559e2569bb2624e67a6b950286ad3d49aa27a3bc56155119e7dfb0c891102a1812', '4c157bddac950f48d2b99c068335a344f32c368b682aabdcb8a7bde644ad255e5984c6bde25cef80', 0, '2019-07-23 06:31:14'),
('8a8cbd04f2b5e386543e34314bfabae164908cea6496409a428d59b42bdf8a1227fefe72a66803bb', 'ab7b075196a6fc5fe509a29e007e1899b2566e639ac3a10db714ae4f1b9d5c91e402a9ba7be50107', 0, '2020-11-13 12:06:23'),
('8ae88b8550276145aac0a0f4e33a99c8c11ba673e8791865c9309f6e74c4fcf797270b1ed4ba0759', 'fd5728f4c605a186631fbb4f9eac47855f1214f96cb9aebc339f01a8c88466c47a560eb0a6c3ae5f', 0, '2020-02-28 04:23:39'),
('8b475626da171996301f0718dd663b4007fd22b3ea9e840aff0306247646a509fa13157f1d1afb10', 'b450c927b8635e105d804e130acdb8a8280b2a5836cce87dd89aa18445ce8445d11d7fbecc47aea4', 0, '2019-04-27 09:46:31'),
('8b56ca9645e644984c3ba0525cd70cb9e77c2e7f126e8d839de387610cc2249e6f7aa7a569f0c4a1', 'bd9bd42f060720bdb7624db2b767af8e49eb44209a52b3bdbb1e8dcd3eec5e8e60186bec010f3fbb', 0, '2020-07-24 10:27:44'),
('8b96302913d8235a3ce1fd3065b3603350af852a7ab8bb12355f1eac6c32a19c5ec9f124cbabb47c', 'e01f3561843341ad17ffa6a35684ef6db9c7cf2a1bd766d8984ca9967e5d7955f6fa48c2f44f3b81', 0, '2019-04-02 05:58:25'),
('8b96df2de2ee5bb57295ba8e1019a094b2be16cd1447ec006c05ad46c9afbcd174b6f5d813f0775c', 'd35565f61e442b045534e2dd67418d40fa4b8de48a3f1ecea97835ab806c30defb532997f88c914d', 0, '2019-04-02 05:28:34'),
('8bd9a0ecadbbf372d62023eff97acc7f6babd11b4e33f95e8a495290679951cb0b372fcf4505e934', '0a6fa3b57bc1fe846b772ce9ee4cbb87f0ab635c4ce870dee7a71cda6d04a0e440c612802fecc01a', 0, '2020-05-10 11:52:41'),
('8be03850f4c1c3760150c8bbe053c928167cd728e313d196f08c27babebdaadf5f27695aebf9e9ae', '498e3b355567f4d4ceed1e7a4627536a2dee4ec4e47664a5d8aefead10b5bea9ed6449d3ae95cd5d', 0, '2019-03-30 06:12:04'),
('8bf84082722aa2b9b190e09382ae8d25f2f9c76b94669532ea8400587b6f9a1da776f3c77d3758d0', '942916f848aaebd2f46e6f2dc7c417c7dac5c1627649c5b44602ab7a7009b23b975a4c57cd9066a3', 0, '2019-03-28 11:55:20'),
('8bf9e7ed026dd562a7e444452db21a88acfba52411ba8cd511a3515e47feee68140bbf912a403f3b', 'c399248448629912767ea7ffcce8f57d33bf2c8567585291d5b733bbb10cdc3c6f8c8cdacd84e670', 0, '2020-06-03 11:59:54'),
('8c2c2a767d075a44071fcbfe0bffcb92a2aa78970cbbd6de5877445cef160c702ba2c81d56234879', '16f55c7a8ac237cb3639540ff7616f65cc5a6ce7f20ca5dc389c02082095922b1d8550ac2a9f73f6', 0, '2019-10-11 06:46:18'),
('8c784d222a0d7de72c27007bb46aabd77e89883946db8ce1c12d3c556e82ceba4f1d400c3b176c03', '515b58837769ea764f57e863e2b49e7da662618e0f1f14651a1e7fe92e827c379d6227de2d4c2368', 0, '2019-04-09 09:02:05'),
('8c91938505caaeb1718f7939e1acfac991f6e0847037b6e2a775a566e4ded6f357753fe407f8001f', '0a594de7ee6ecc6c3e25d41bbffbb61881268ab7252fe01a657b4772a9357c01fc3bf3d26bc75bac', 0, '2020-07-03 10:45:05'),
('8c96973f317083fe8a63c3af5c24387fc92367948df51b4f3a7951bd22b19fee6f2e25256a67f6a9', '9a2d8714fc0f2f9c6f54504be2cb6c975b4c016039114bf6c0f4929445a3bf82fe42208b5be08618', 0, '2019-07-23 09:12:59'),
('8cb0fce16864d3dcbfc6e52256a842b5aa090567adc4d35a0d17734efdc511812c40f28455f3b2a6', 'adf92b78dce2214fe4c130574f918114d10790da4ef42992b0b5f377a301f51980d4a0aa4e58abe9', 0, '2019-05-21 13:37:45'),
('8d104e361160769a7ad923a1efde45d7c7c2c5173f148569182c3aec865445d95897b5767824a083', '1120dd521b0f20ceead0c30ebea4a227263a06bc82a16496e41c882088de60840fc1dadd401ae523', 0, '2019-05-14 05:56:52'),
('8d1bb41cfd25697c2f82c3d2da2cd60e791fc943c713fc1be4a185899e3dc6e8b7502a1ac61a4040', '4ca14baef56e9b66286259913635031a4ffb34fd4cb80c2c09f9d2774876acd1dd57ef9190a72760', 0, '2019-07-27 09:43:57'),
('8d6d0f8bf515666b1e97524bad7ba8173d724c70eed74887d5e75aa428498f300e81e42f6c273fcc', 'c90b9afd369041575ae02b9feb28753b7d6ac4f746547636e0aaa1a1cf36ca4796c21feeb9fa7a2e', 0, '2019-02-16 07:36:03'),
('8da707b2c92877560f169ac10846d49bd67787b9f3295bb274929ed4be91c713e0ce0bf9261ce962', '327b45be6972437bc58368dfc39f56b32be6bd41145b22dcc286eaac3d5f35e51877a62a13cd0e22', 0, '2020-02-14 02:26:33'),
('8daa9decca70ad05047391d28601fe865a19fd04b3d17bd8c867b78466c5cf5f4eadad50274b4cee', '8d8a8560129e1aea15871cc1cb61818bba2467603c3f1f15ecd0c8ef72c314ae93b4012563d7d143', 0, '2019-03-16 05:12:37'),
('8dd9bcdb3d7c7c10af93ba8977b2c1e927ab49556631c3a67e04ccf7185fde2dd667b57b253e6aee', 'f1987123b5043bf7a47e26f1f3e8fc36fa38a12f3ea57fcca90d632f4e0c252c1dd7d597955137ff', 0, '2019-07-19 03:51:06'),
('8e0b30c836ac668330b15821172396d9ba88112b53c978a2e8293042f196de3e233097a4a9e35277', 'ee95e6b02b76c9e59c1e554808bd0a9068ccd6bdbe4b155e0f0c8bd1367396bff6fe64140c2f1fcb', 0, '2019-10-31 16:32:35'),
('8e6b360f24cbb998d877997e4098c417757555547adf14fdfa7fb7497ad1855fd2d926b6a55a2c9f', '94ec939b23588667e25ec56392989531b7e4491ec14a82731382cad4dca0c8068482f8ac73a89345', 0, '2019-12-20 02:19:03'),
('8e7537662c1b9e8a568b0d09782c3b5dbeb7655cf9d8029129b7ef2791c3becf83cbc5ba69acfa35', '9b74317a28ffb21295431f69ae7436db2676ced83c7e1e3014cf2aa481319f160772041d9bad1802', 0, '2019-10-11 07:06:50'),
('8ebc947c6a7968f2d6a22066ef1f4c10a806664ee19d8bccdec25a53569b45ba95af7beee15fcc87', '21572b5c06b1aaccfad58f8bc703569a13364d389b98c3f97081ee596987fa3c6ee7d32ce43091be', 0, '2020-04-22 13:52:52'),
('8ed4b5c15d88c342c1d174e53bff7739cd9a609a7292d9ba8f2f86a061d92ef3d8bc6c6d8c2167bb', 'd2aadbe72da13835145f3d9371e2773c74f38ac4a6d38ae751ce38fec6e0bd29a71fcd865b39a1bb', 0, '2019-02-07 09:47:58'),
('8edb18da3f67e02567c8cd0425e7a0272121e4659396c6baff79c977fe2ff37d68a5684e14a44bd4', '54ebad26307d6fc107f7e7dcdb7e119ad4cf7f4fbd8d1814d6187de7cd38dceda8b1bf17e6c23661', 0, '2020-02-14 00:00:18'),
('8edcba6bc1735710da59845a0857424fb2db0b08b8baf568870c66a0e1d3defc68bc0a0b35b7c034', '8c92f547cd0ebc49d5572e984f487cf630323afdd09f206b9bd02c62e8c4c7d1096bfbcbb4ac52d8', 0, '2019-10-02 07:33:11'),
('8ef327b455e2e9db02b812ff9b954a6f496f5c33568345ca31f5da140f973fbfb9075343ad29aeaa', '4896de534b046c66a0bcfdb3122c98281c875aa103dbd7b0026ee763430b6364ae2dff51dc0b87a7', 0, '2019-07-24 04:53:13'),
('8f22b0e13b897833016b445c8a8df3887a176977f1b1f83458608ec0a44ecb9a24010c3d5f2e8fbf', 'a5f75f076a38e63cc0665bf77f9c7ef6cad5e9b94c8e780d58648b13f42a5582403838c749430a36', 0, '2019-07-23 08:39:43'),
('8f46bffd09aaba9789605ce849f6a23a57edb5a00620f06a507cbcf20dbdaa1736bc767320d66b43', 'f8fd83c22a1ad8d46344c87ffb3a0e3b4eae8c5c89a4e52952109ae06abd311806a48d05e83b560d', 0, '2019-10-04 01:11:41'),
('8fa5c4b95b0f25427616d56a12cd3139b89fc3ca5c4cb82e9d773f519b102a09d19e3e5a73e0e8dc', '083a1aa558e4ac9240370475b2b3864fd5dda540ff02860e23473591e8d9f304998cb7a009349c5a', 0, '2019-02-09 12:53:47'),
('900fe2a3c968209746d294febb981c5b0a3519f37d5fec702593f6ab7d0814913a09520a8699bf38', '01a2f082ebfbb6d7a62dfbc81c56ce4672a09c906a31977b4774a2e12f4145b1433dc853c9f5c58d', 0, '2019-06-12 14:24:59'),
('90350e0e98e085720c5d73bb2794c21a028e506a6c42a7169a14604bbf2602b6c8ae5e8cbc1ae8ec', '82f78ccebb758baa74b13b754d680132d7a35e35f39d790645754e1d62b37f6e119a255082a9a67d', 0, '2020-06-25 02:15:47'),
('9058ba4ddf4fe3c6416d095c6fc75f878d1a810fa583da75cb4422849ba041d161e256c384fbfc77', '6e9504f9726c50b31622ed1956370ce7b6b71b5f2eb4bef7cfa898fc9f9b548e0739aa630ba9610c', 0, '2020-11-06 21:50:25'),
('906c30fd8989a63238b52fe70fb3ceaba89514a2f0186f097f70038eb6ce264baf5134e7f2eeaa45', 'ae9f9b49fe21e319ad2c538d3f675a229c4ae8299c919f256a7a43c02b39ed40b01938eb5d4c0a07', 0, '2020-05-28 01:00:29');
INSERT INTO `oauth_refresh_tokens` (`id`, `access_token_id`, `revoked`, `expires_at`) VALUES
('90c402a5f65f85813a89317754cdbf2f758e489768ff9f5f7f32f7fbd9902e54841d15ca697af89c', '53c48f8a57d1f97ca7eaf30b25ff3944fa43cbb84e62267ec284393ea018b2afc9506f081f626889', 0, '2019-11-28 11:56:28'),
('90cd869a6d6a64f1abce440a68d92b06804a881f1cade6f74a497fae0fc6a604863e3194f3f95fe2', '4f35ac6600d8a8c7b580fa031d51dc4dcddcc1b5c8d042326869d1334509b0bde4d60630c6eba7a4', 0, '2019-02-07 11:30:33'),
('90da52553320285e1e824384e1d2b8ba3a0909d1dabc81831ed1797582dda209eb0de04cd43276c4', 'ff958b1d7f6b78a7fa2975e01c471dd8db970ba08052b913e6c1ea442b22bf87916825188703a21b', 0, '2020-02-12 04:42:26'),
('90e71986ce11c4343918c59668456cff2aaefa03eedca35767d47850b5db3e341df14d1f56ceb6b0', '99865790d98a1a4f639ed230b1df01f5ccc58d85adf703f87256c47e68e022125b8d5a146c6a0ca2', 0, '2019-10-24 03:31:50'),
('90f8c0cb79c79de3b46d68a9b6fe15099a327335332b92431289479f316c4a0f4b5e3ef541a9b8a2', 'b290943a9522bfa6e4b2c902e60b243c5aa3674d5b1042a9acc8761a8af7d6f57ee4c0d86caac6e9', 0, '2020-02-08 04:28:06'),
('9111c0c3ce8d6fca31ba40a45d6a57d53ac49e0f24a2ea409535851785ebbfe1d97f95b471014450', '7a8dd7015372ecf1bb545a37140ecb6abb3b268a0ae44c0f0de582a14e37730795088d8f1cc85af1', 0, '2019-10-12 01:01:15'),
('912acab9f316f55fbe7079fcbe9d3e776de6535b65ccad316cfba8ec1039af82e0dcdb88bb5615fe', '943c274a94554c5ab6d9b3f9272bb829ac2cf2d37f67540657c1f3c77c7515d4c23a16a807b7ae17', 0, '2020-03-12 23:50:47'),
('91307fbf92639524fe7583d3002a2a2ee38fc1cb2c50a23dba18939ba39ac1b5f5a2fafd3f0dcc34', '1b7f15b15bd36471b1d16c4f67003cd433a9ae1b9092c374c420f91580b266440b284c2254e4be42', 0, '2019-04-03 05:40:13'),
('913aa722b4cb340c92378461272eb4f46ed84fd8a24973020b888bf1c31a7348c08696ae82627b2d', 'a153a2244eb2db50d1cfd1d6fd3c68ba183b064e0a3ef2488be27c76cd1df353f5ee8564d44200ca', 0, '2019-04-06 09:58:04'),
('915f197ee7e4f2dce8abc4e436c92a5d2b80f2359e216c89cade48d629b7f11aef48eefeefc0b8c6', '6cf19555d72822de75237a218fdca94168d4c1ac7d8b8e3ffc82990b36003df571a983e0c476ee2a', 0, '2019-07-25 11:28:48'),
('91693c22ed6fa587d934c5dd2f1847c93619603c62acb5622beba4c5578582b9faf82449491f6911', '58ce6d261d43e3e13a6b6c18d9b40910e8a36b3a5173df6f9d23300511f795788c8cad9942851530', 0, '2019-02-13 06:04:29'),
('917771fc3b57087795f89d7c26af7d4610ff5f58de90864bcda9c1dbdfbb74aa02e9fb0015a1f03f', '956d92a863fc74e780a6f4fbbb9008a8dc7c11cb851baf5ceccb98c144b3857af7fd7f48a9f830ca', 0, '2019-05-01 05:52:44'),
('9179cf3e30e32faee087c7920bb3c82d06185a1479aac2f095a5423fc5549eed96a2de81059a07a8', '789b74689a9c858dcd13a6c4eb384d60d3a049899e858e223c95c9a47966dab5aa64378323bfb1f5', 0, '2019-10-08 08:52:43'),
('918ac9823b13391a10712e3615c147c9158fe8df5a91b49f238dc77b65ab84e8722e0c17e4affc16', '72bfc4a5b4d05478e0330e0af9fb8804185e70af8ba1a44cc042407f573fbc76d8fc9b71b5a9deee', 0, '2020-09-07 02:49:25'),
('9198d905b77549ffdc75fa05bab33e3171c1aa7c4652c363abafbfe9be6f0322bca20654b7e3df28', 'c56055848eb783f6957b0565fd6012480da855101aaf7303fac5782b351e9d622535bd13310c25e4', 0, '2019-07-20 14:15:06'),
('91a81aef8f4445ba519aef135241742dcf4f6297a36c9b1591b209e7a3cf98d4658c73f104f58d09', '1c9d186e53b30696acea5c59085129c7f89b7f6122636d9d6a2883e21e0bc880717577fa247b4eff', 0, '2019-06-12 14:48:50'),
('91ea3f6882580c55e4db0c5f11d6286ff998471bd572b932c5e7b8b86bf39e4b133c41def9921c7c', '8f08a699e9a2bb19bea35f9ee52a5a65fe7567940d394e8eb2d0b69fc2855fb85974b96a03d16565', 0, '2019-04-25 05:02:08'),
('92045b65b698184c4563c959b4e3e979f6d9b2eaea54e189b42ab7d2d07c063ee2ee0238f11126d6', 'd9297556167f148fa2395fe035b3d24499fb6bcf449a83000597afce6b4dae40dc0f21d224153a90', 0, '2019-02-16 12:19:20'),
('9250de4814c3ec88fc9614dc919044456df204020c11214f17003156dc8ec19828a10f74a377ff5d', 'a2ff5fe9901dd89346db0adc20a2123c503c55fa0ea48130e3d3d1671e34398cc59f1ef0712e0723', 0, '2019-05-19 16:10:21'),
('925a289749f07ab4baf8703c141c07948dcfacb4b648c190c84e794cbe31a63f17da79b0cbe504d6', '8f3765e47bdfdbef4a7386e1236889b363ee060a3af384043a94c62bb59e73459b9852aa8ce39a5a', 0, '2019-05-01 05:19:58'),
('925dc1ddbb983afd43a52b08c29d856c0cce0e851a8bac60305eb6cb874c07518309f49fce1c4994', 'b58dfc9934853fcf8dfc6bf87f2b4d6541736ecd1476186c53d971ab7e28a85c99c5d67fc6465020', 0, '2019-02-15 14:02:01'),
('926b93cc5d85cc64bb0d314e3da8226fda9b5e0965d51dde072dc3c8bfd90e57c48e99919a4e2727', '7062ff61c88a684f560c4b4f5dc92652db83b87ae8e977665cb0f00aa88a85067803ca98cc3048fd', 0, '2019-10-02 06:42:12'),
('926f9cfd34c00c0f539e63eedcae10559c416f6cc9cdfb7cdea478acecea0aa731c360b9eda2cd80', 'e32b52df1831aa17465185add468bc437de8abfd8376411c70d065099ffb6fdba2e9242e3b4cea8d', 0, '2020-04-10 01:47:25'),
('9289af7588f23c64fa5f371b5cdc00b999a2ffea567268ce5cc439aa3db0faa33eeaed0341507c12', '4c817b0cdaf06f3de7a8a85ce5dcc4efc249c3a10a769ed92b32373f804c021369ad794b37683059', 0, '2019-09-28 01:26:20'),
('9293ef90bb58c8fce5c9e7c710ad71457cbec92d1b8f26929e8510da6c524d81e77b83aebb58d7b2', '09b42a8960e4f68fac4c80dbb5738b93d924ba1dfe01fd7b6c1833566c944d9e2ec8443b0299efb7', 0, '2019-02-12 07:58:17'),
('92a0bf11474341f1cb0354511217164e4898367c627301cd6889276bd1daf6d95d3a5e821a189f8b', 'abdd1cc90ec905d2e441437567dbc355d149cac307937c385b271e864045f25dfe4ad5b99e59bbd3', 0, '2019-03-16 12:04:26'),
('92ac7f30e28a18d4fb0da5a8c30385587cd495f630166fea439bcb47a9ed955374b5ad89982a251f', '24c08519abb0107e7495e1f02a9b73b67711e24674be8e79dd2330c47c173cbf5f432e8d618e21cd', 0, '2019-03-21 07:12:23'),
('92ebd479f9fc451aa39bf3dd6fe1697f864f9f951a5bb81d17cc7c2d1e6d9676118d1b586b616479', '3d707d7f82f3d4a5c7c31a4619d176ae1f056fc743471cf19187ed5e4fec25f0932f7336be2522c2', 0, '2019-10-09 21:46:04'),
('92eeb0a8a0721b974a50c0513b328b018acd4e6e190db9926a4c3eeb5ec5fb20b62dac02f0a8aa46', '2088814d235796965e77919f06fa959b3cfb132fdf0d2b839e9fff0e8809b63cbd42b5cd45245abb', 0, '2019-12-15 13:16:22'),
('92fe071bdeb251c38235cdc6b3558256f1c74ef0be7f7b409c42276ecbf9c34b9940587def98f483', 'f15cae311e609bf00219aa09f926084b2164187c32301e5a6968f035fa3b7d54ed349cd06e2944df', 0, '2019-09-20 01:19:12'),
('930a76ea9da2d88a0f5f77e9796695c10994bfd6874f1b62bbf3496f220c5a9d139d2c60493b1be0', '781582622efeb81e1aa8056ba6c5a60941ffea66d8006346e74542f2964a08d2cceaf717eeac83ce', 0, '2019-10-10 04:14:42'),
('931797658b9f6e8870defa7a6b61482932ac67a867dfbcac0b545e1264bf0ec193c71e17aeab602d', 'e5eb51813011957fd60c287ef5b5c5a55188060a37f0f4e0caf842e481dac60a224691555e8cea70', 0, '2019-02-14 13:41:07'),
('931a6f4c2e3d9e5e26d0371cdd106582468d17aaa54d685f0e4389e74fa6d967db249b1a7de48d68', '4b3b8e8e40b2812c628c0904302c2c4a18e195fe166aa74de502df669709a9ff4369cd78ad5a93b1', 0, '2019-05-01 09:49:50'),
('9335713c607e11940f135cd5f523fd0ce6ef25ecdf692011eca192392e43b5f1b44875cc65ef0774', 'b6f0e4b1fdf7f05fb76d7f5364931d5545523fe34f06f151735429c89a86f4ffea6012a97165f639', 0, '2020-06-25 14:23:05'),
('933bbe8dbe9bf31cfaeef4facebf0470bf35be273fcf4e446d59f0e33589413a5e5d26f2da407a2d', '848dfc8860ae1f70500386306764f0bf29343d903e1d92bb8abb8edcae3e95ca63506c3062a22be6', 0, '2019-05-11 10:45:28'),
('934601ce9e24ded52416e6ff6457b3881dbfb3ec5e94f94b2ac465489ef68b57c0ea453d2adbb54c', 'b5723ef1e0098d9ae397be55d2336a4c700238b3980820c0dae915abf39cbca5d14469be6d5bb8c1', 0, '2019-02-13 09:55:56'),
('937bceae7899fefad2837bab8f78a17448fb09dce19e23041f46bb0260fe1ee890ad8bb93923eb5f', '6dbdf22c23c8828efdbc686e0cc47d896cb5fa64e92fb15b34fc8d14d2a4b82833b1bed104ae136e', 0, '2019-10-05 04:52:20'),
('9392a94be200b2e82380a12f9aa3dc148edb2d62e2011a11f65f0576b316c4f57e2493be08dd54f8', '909dea87d474ebe645fb6c029c7b194e85cf1c3305217f624d40d4d8fa84b5bf9430cfac6f1fc436', 0, '2019-02-07 07:32:21'),
('93958e4097e83034362c3e1d49f0514cc4daf9c9ecc5acc2ce3669e067e0e1f0021dfacf05acd2a1', 'faa052d39603abd187795618cf8a8cac0d2b7246d413c63d82327ad709bc0f4e59c8a91090484203', 0, '2019-06-13 06:10:05'),
('93c735925335d7cdf1b057a33eaff8ca6125b0e82e10c5e42bdef91df510801950323a747905220e', '55c72401bdb2ed305831dde8697e02b962cde6c461586a159307897692adada683819c55338e946b', 0, '2019-07-20 06:36:16'),
('93e9057db3f7a1fc86db7960d0c80f881e72d86383dced33170047102b10d52809aac05961eacf0f', 'ce7b4726931f76433f59e3522c3ff97decc140e0a9a7f33ab117582e102d53cc9a6f8ba5da275068', 0, '2019-10-25 02:18:28'),
('93f7332bbf60e7230e50c6ff1855590cf1a4a466bb8f4377995afa2b75636e3dcfd8c40e21a2b3aa', 'fe616d58297b3e9a0c7398f933369869e50df57a1b237843b3d2dbb756ac256896b118c3727c1bb2', 0, '2019-02-08 12:52:04'),
('94612d8ae963f5d2415b932fb4bfe555f7c61024270b59313bdec85bb249210e1fe6e71db4c4b4ef', 'd10ad1f4118bddabb8644491107e076978def94e7e2a1e5d00c7d69054d2fd21d1f766aa2f53536c', 0, '2020-05-16 22:38:03'),
('94ad3fad4afd72ae3f5ef59c113229c639df14452dfc819b8a14e689745ef196c89a0d2184a90bd9', '2ecc781dfb37a667cecafd37f75f3c99a068b6dfc74cbc4ec69962d787448e381479a9aa0fe0a3da', 0, '2019-05-04 08:16:19'),
('94ba1c1b609a9189b05d1ed71a4a2edaa3eeca998763026cb5c2acec4baada0c49aec25f40ac5408', 'f114eff8310500fae7444f1b4a700a87e11bfd8b56413c33ea5375d4711a0befd29f766114b9627d', 0, '2020-04-30 11:56:38'),
('94c406e5e4b679ef22742992510d45b596ebe73f10d18df1c5a90d3ffa6e5dd5c7cda03c852ce855', '36242ffeb8a4ae73fa3805b01db6f164ec94c7efe30772d63cc7e1ee0f3e58f85f082e480d7e48fa', 0, '2019-03-23 10:03:11'),
('94e778069b630382db05149f10d70bea71cfa6c8bc3ef9751d0b891511ac69bd7fbfcfc1f2c358a2', '63b01cb0e17177d594bc3ec5ef7f9a8972bae2c35d3c56e254bf196fd913bcecbd2bbe9290651e42', 0, '2019-04-24 11:05:57'),
('94eff1ee3498ae5d08a3da6ef645d7560c6b889d6d09fcf92491c4bdca682bbe382ff5eb6fe83471', '9ababc57645965f53833e8310aa253093b41967cad8d3eb82eb95022efe765e9a5c9fb356e41dbd4', 0, '2019-10-01 00:32:51'),
('94f69326a85a051dc63a9ddb4b296d52d25ee4208bac5c39597b48ed53eec235060023f356870537', '466eadabd9e45f96315cc554125a1ded6a48bf96122b2fd534e04033939fa8482745ac9d8ce0aea2', 0, '2020-02-11 01:15:53'),
('950814d3b0866fbc158f780c9808d25ac4dce1636ac8827cef3640012a27ee5f5a667649a6bc0067', 'd6f9b194885bfa1f7b9713b569593481bc77bd184b6bf20fa98c822233d1f1e6da1788b16b7b2543', 0, '2019-03-29 05:12:18'),
('950e4f525de724134e9a9a08df2a4a2a0baf48767976b40a0bdf585ff637e930e7ceb90cc12b1e52', '440fa90c862c06c5943ba5b6169539567eb90f1e6c21142d83343f1faa3b7327f7a47d5591b28638', 0, '2019-03-29 11:58:06'),
('9521c56cfb745d591bd393cfa31e4bf9d68e4c709ce119e9ea0f3800059516977d7021fce04b1c0f', '5958e08f53a276053cebfd2d097d0c5422b027705d4945f4557ed09dc353b3fe867ef28b2cb3f497', 0, '2019-02-07 05:05:28'),
('952abb1846f5e43aa06eddf931addd74e854f4ece6bf57eb529c5e250a89e0b077352fc606e7b64a', '7b7b55848769c3b16a8e5a6caef4db0f273f05b7d393347fd35c5e3ca79761c39f94b38e1eb4f6e8', 0, '2019-03-27 14:10:03'),
('952dc166433f3eedd2a17d430f9d29a27d2168e1ac5147fc4ea416aa5c446faf8ad0926887b9aa94', '28001e01a3ba1ab3b5580c4e2e6c9b5971d26c92b45123541b879836c137489d81f39a730fc35e6e', 0, '2019-10-11 07:08:03'),
('953004a44a850733452275caef43f5915054dc211fb36272b3f8ed02a370446d229fa1511340a8a0', 'f39e8b86d4e0c8a50590e6212b01b6ce537ca0ebc3f7f86c03847b9b4f3dee0d443a3e02a8477455', 0, '2019-05-16 07:59:54'),
('95722bdcb73ca04bfdb7e011eb732eea837050be1f44ebc90b794251bbdb78ea1829ed12e70fd911', '74af4a1f337136b6756b5d6f0bc4cbf4bd2a91eb924599b11481bcf10f019c64e821f563862730b7', 0, '2020-02-05 00:39:38'),
('959feaee5cfa0ce5ab1327cadeb7a2fc068c7c2fe708f04040328f47b11cdb370003c41b94b99553', '47a441a4e52ed288f9c9beceffe79fe014cd94714c40529c4157996a935d42d534c6e78d0b652fde', 0, '2019-02-07 12:12:26'),
('95cd30023e14f2ffcf2c32cd10d1c5b0ca4b0e782db2b1ec66263018de9e58a54cace1288acd62cd', '9330217a8d075e8b3cdbe3045c89a585ccb34217699ea5b5fb6f696b2dad72bde2ee7dad95bc5cad', 0, '2019-08-01 05:03:05'),
('95d12d6454935a2e1e4f8f10324b11e3f6ea0d24204b4a90eb6849e3a4f667ac34aa0d143b316a41', '5c56c48ede8ce000329d2bc6ba6037ef22e6b1ea98bc28927f11e129e9b79034022d483bb26af293', 0, '2019-05-09 06:30:19'),
('95e360f81b82919c344c1e206b0a5112fb9f3591489577cf5cc8f0c4a071a3537461cc716ca17955', '3e7935f2f7f492c5a9aa505883fc1e7d4c90fb8d147a3363f635edfac4bfe2672c72a0c2061bf742', 0, '2020-04-10 07:00:44'),
('95ef20761d1a06b8a7acd3f86602ce7903c5626af01a5404d7388f67f49b9a1eb5be2013e06b46c1', '0dc826affa99fdc7f6dd5eaaab04fcbfc2f231dda0b4f1693ed09a11863d3064ae6319dd02ba3637', 0, '2020-01-17 06:57:59'),
('95ef5266b800ff8b00381622a0e4ba0f25f659b389220f50f3d32a21e44cbbda210ccc1cb3a99287', '7e58f5300555c63bccc378cd9a9b7e174a07d91e83cc68d17aa330673a88ab806ceee7c319090922', 0, '2020-02-14 02:09:12'),
('95f5dab6f4b487c2a1a4b69614b613fbb5c33d2640bb79b5764f74d5371fc00e2169de32d82145f2', 'd198b6a8508163b349dae799519673f8f89c0567de725bd8b71e6de96b4684befa48c507ca6ef915', 0, '2020-02-14 06:58:58'),
('966121bcc179ebe4c2f7bab8a0e9017a9578ccdff7a09e600bf20a98548f95a5f9ed181899c8c2a2', '7ab7f06aef7a72f45e7fdc77123b86be16463613474c2768298d18050aaf42d85924e9e7d892f229', 0, '2019-07-27 11:39:54'),
('96852145fcb42bc6140151eabcd3eecf226b88995a89df883bc1bd627858f76bd304b20a2c247439', '20dd965e0202a3edd1bd68b0657d863c2c28b03dfa2f3643af59e5455e5110c2973f0eb0796a86d7', 0, '2020-02-12 06:58:13'),
('96e621516b67fdf708ba24af155fd682aa5e9c1278a97b7d7f23506421a404b93b8439128b3730bd', 'd837f7d62750b474d9c3b5099dbf07b8f5a3e209102632c4adda7b37e289a44085042c338bc0b5b4', 0, '2019-03-21 06:27:47'),
('970985f268d6937673fad96851d9ff5f8178008c60a79aa552f6f93fc33a5b176e6d331c903e412a', '7694b603551bd92af4400c4eb218406d2782b6d41811eb0e36a8afd819a82279ff9f4d799352757e', 0, '2019-07-24 08:32:16'),
('972467cd633a83bc934cacc6a4adf56fb0ef14cd50c8bbdd37b844a4b99c4dbc12501d780821c922', 'badde28d503895fd843812e817cc717f8f3b4d6b667ff28200b51e69314ae7052d671d0b707b3cb1', 0, '2019-07-27 07:03:47'),
('97356362ae175bb21eb1e3c672f72de89d330c0056036a8eb154471ed25531eaa0eeb0615a14e843', '29ecee9e6cb577efbec390f2a94f47a8a63de295cc86b47794cce487703876c89b8f9c19c6835daa', 0, '2019-07-05 13:06:59'),
('9739050a55345dfdaa5ea90b010eaa4c8205ee0152605065f4a87ab4715826ff53e4a85ff04ed3d3', '443c950ad64dcbc119500f0846c72041847471a04cb535ef954ba0176ea9915d12e81f3a06c1887c', 0, '2019-04-27 10:27:17'),
('9787350dc17b0f2438a59cb7d518fa837905be90381c49ee3dffc21337fab7a56e82feb0b2c97897', '79a07ea488fc0e94c8c76af89bb06b2dd440b8b24e921cfd51944332abd62f3b1d7813594b120410', 0, '2020-02-11 01:19:24'),
('97c7341a104efe2b0f4deb10e483c0c633e6c1cefbd9c1efc0bb35b0660cfb3c3c6e31426ec861a9', 'db069eea378d395dbfc96c606c696aa60dc622b30c91219e0feb44e90d499fc47e544127d18b28b8', 0, '2019-05-21 17:05:36'),
('97d16c063d95467b44b996848939fa149646d953d9f63e03ea20a50ca0df2bcee577d52aaab6793b', '78d92c31dbfcaad9a5faa8fc5a9634800c750af87b36b72382c043d55e28f9e24608e8eb5ac9b50a', 0, '2019-03-20 14:35:24'),
('97dda5b7beddef081d5f8b34056187831f5dd57ba2db56895226bb866fd27141b30486ec848c70ff', '170cfed29695e01b1a579d1e64be1bb33bd518046f676f5d313ab3c6a355fa2d931738f4634ab4be', 0, '2020-02-11 05:54:30'),
('97f30ebf6782446a87d1af06b05b62475a54d2255ff47792d79e3f9379133cdc7fb498d9816242fa', 'c9e27d9101d9a1623ac10558c27007b6178c6230afe1f30a46d249a8d7af5cc3dd50fef38e2377fc', 0, '2019-11-28 04:01:27'),
('9823dd0502ec922fbfe3879d9988bd1eefe84ce1d4d74163782d020d0a894242c0a1f0a1613ece81', '326ed1a7089fe589993aeb444e2fb3dfaba116e7a1c0016a997746928ba8a211ec9759b44d4558f2', 0, '2020-03-08 16:43:42'),
('982a4896566f7982c27c0571509c338a26b10f2ce0b6e3053274da58491401413bb234b4939c93c6', '7fed56957e7edead627b1c6e32906947b4ec224146742433a071260b46767579d605a9a9d7e96a0b', 0, '2019-02-09 14:23:48'),
('985fc43e845438e17e08756fb2d368f353522b5299659b4e0e8d58d312637359d2073aa01aff6648', '0385ed5e298fa63687658fc44d32ea82152f5b848bf0b4a8645c80c12b8cc739af1649e16265d0e1', 0, '2019-02-07 09:25:54'),
('9899e691bab320a5cf178811846bc837f238b37534c606f1857d26835334d2f94988b6a06c72d9b5', 'aa9c06ac5e556cf1cabc4537e7d50d2fe787dc23ab96a776179038678a6a016c22f1889f51e454d0', 0, '2019-02-06 13:43:18'),
('98d2951eaac9059259cb91db1cf175cb24d12b2d7bdcd843d21106f531ad7e6534a75e78e38fb7a2', 'badf23d1adcd0b915183636ac2b1b1dafbf5fd7fcc8c3979d0edf6b83fd56caaf9ada277fc46fca7', 0, '2019-10-12 22:53:01'),
('98f23fd8c28c760badc9866798b91ecbf0f1b1ad3dcdfabab1649cdf5fff2dee7f2bc4cb279a6f11', 'be8e5c40c0cd4e64e51a8af7fb106ee0d14ecf1e82eec86ad5e8823010e19e2b6a7cc6c47d5fb9c8', 0, '2019-05-31 07:04:20'),
('98ff6aaadfefe22789cf54ab4766846d1be4250304ffbc2371a71d2b0d8d5d44b8e806c1052c2b51', '1d539ccaf6ae52328cf8b1f52d0765c716ea3ac2f33da71974a260166696020e0d20badcf47062de', 0, '2020-04-15 10:08:43'),
('991d4294c6d5f981028e7e25bc8954becb1d55076495dc1a5be1ee7dc0cc296dde2e52348e11aee7', '04343856ec9873cb4050169a5b730b5b584f383afd26d206b480e93aae0b6a9652bcaaee0f45d3fe', 0, '2020-03-21 02:46:22'),
('991e9b30c080118b3e1b86b082a01c5731e90dcb6c76e3c8f11b753e5749db49d02738271d12f4ce', 'e4e564192332eeec5173938f8cced603adf2a5871ae649ee72cef5ad7670f49a9bb6969a3e67f841', 0, '2019-10-10 11:40:13'),
('993f6c052d7fe2f89ab7dc242695f418dcc5e4b6b73fdeaf8e88ddf63738c9814c60dd58a1fcbf82', 'a26063118688b3a59faab8353a3ef2170e86d1c859b76ab3cee9d83f0c411051b4193e08425a2b9d', 0, '2020-02-12 07:36:28'),
('9945939efbf5123241e1cdf48d74c382d6b97a203220030e75399c996ba8865f3de1785447b58df6', '5bc2cd3c58392094b67aacb3d6cdd356c6b9d3190cfcc3aff5aa813c0efe3f88991b6c189ef7c57e', 0, '2019-02-12 11:16:57'),
('995c582796c92ae17265a37a831a90cd73ed62c97ef62a919611e3046b2abbd256bf32d9ab8c9f22', 'ba3a0b56159231bae2699168ddc329a468f2e87227bdf9c207c63073427a5a64d2dd6cd6be7fcf0e', 0, '2019-06-22 14:38:29'),
('9978e3f22ef0b70c5e914110efcd0761c77bad3b4e376425e2d32adc822f6ead14d1d28ce505c313', 'ae1648c2be4622ba2138e1b1cebbfbd863f9c00933fc7ab4d7de25a5f0a6b1cb7143dfcce40ed7c1', 0, '2019-10-10 12:36:04'),
('99aa45f8e238f18296893361954c830edef6e51ba5d484db3033d7b01b51e63eb2df0d803bdfef39', 'c4a8cd2d259743487424b7fd8f98263df946e2804e1ee67c2c682d140049dbaf9b80abc64bde9e08', 0, '2019-10-10 04:15:06'),
('99cefec5d173013304a14698b40ffd2a8207e9c40a5e5732c243389c1347d4f9be3d383c56383a9b', 'ba4045076905fa94a9ccd9f64afb52804924cc2803bc164f7d6e1e40dbe4dc89b83bbfc784e90b2f', 0, '2019-10-11 07:42:33'),
('99e683989dc3ca01b795526d6668688be15b83e5baa0c0096547f6b771df0d676a0acb48aabf5eba', '60a358e9c3a07fe163c4e7941ea6bf2ba6f44e0f25f9e57d7a8fa7ba8703c154e05d0d58f25a2700', 0, '2019-07-23 09:00:55'),
('99f3f6402272489cdc685252b64cc20c07bfaacfa01a5aee716161433d80b1b2cdb51d0749866696', '3d4ea040cb6ec7d49b8b85b825226b68f98b6d131b0f818252e9c0cd73242e6f8eb3eac067878a66', 0, '2019-02-16 05:46:40'),
('9a0ac555291c9e91db243cf3b25f6ba31526336459da5ada255d93e32d953bf67df55c376da12500', '8e59903c5562595a2870ef0d51b67528ec6328ce726d8675525d914c5f78d95203ed451bd95955e7', 0, '2019-10-11 09:46:02'),
('9abbcf5e7bda7af41c68fefa71c6bc7c47feabc6a69caf60cf8075259bd5df1be34aaca2169f2bd9', '0e04ff1fe8571c1cedcb52397a993e1dc40cbb603501c0fee987afa870a3f169b1c2e65aebdbad9c', 0, '2019-02-08 06:44:20'),
('9ac579778f69f88756b7d4ff3504a29142dc062955f2da1b1ef7f678a95aeb6ba7eb0c74a3a743bf', '594b0426ba425ca67827f000453e8e82d98b8863a318f0119890c583242e4d9a2c10854ff651252d', 0, '2019-05-01 12:58:28'),
('9ae4ddafd8d69a32473d0a512b4ad002091135f0bc7c0d441a9bece9cfb245ed52afb28fc83490f2', '64e519c7748b7b76edcebe54be9682319a3e183f40a40dfaa296a3c61a3991d5067d7cbbc960ffd1', 0, '2019-07-24 08:20:31'),
('9ae6e69d992ce7ba9e632456ece9b8f177e6f6afa41570f57e3fd329f4657d7c8630dfb212cba5b4', '1c0943b3f999c5aeb7b5458a031d626afae1e2b25c56b1d3c231e5672271984b8387748168ee7a8f', 0, '2020-02-12 07:41:00'),
('9b3732515d893b22077df9de917b204a770932b8e0ede7c885819154e9ad0ffd993157c070ac3c1d', '9100e800d3f05c4fe05e46ef408fee5f1af95b59cccc93cd272264356178132c86e52c3ae23f5935', 0, '2019-03-29 04:41:54'),
('9b518e42a15bd2a680ed787125d73949ef7647724241a9be2555c3d77dd97fd2ecba14e9747a0e43', 'e3bc3d785cca4944e92d5ed631cc898c69e07ea122ed0f03ec57e34ab23d56281abc5ee0c363aede', 0, '2019-02-06 07:08:05'),
('9b56ac1cd0e3afd99370f5fa372295e63705a1610135a62abc85201581ba278f4a4ef3edab5f5808', 'd17ef8a5f9eada49903cbb011ce2248b033d76ecba2c4d55eb4b07bd93e8fefb828893c09d9ef203', 0, '2020-03-13 00:00:34'),
('9ba0d68ae4fcba7a7dedbbf3ffc40297c67ce78080d0f3e67d3a02c087ae6f594089a4a4ac28be1e', '8d0243b03552f91d1368124e02410b1e7583895dd784b571ebbc890f070d8181e9f0d70c3406995c', 0, '2020-01-17 02:24:55'),
('9ba0efa830fa9cb26fcd38bf062a11695fae13f10a685d1358fedb7e2fc3ff3c0187513ef05bc668', 'c0c597a49dea4f2c841929bac308efccbca100ecb0df0081b26dfca382ff9b7edcb02cbbe1fedff9', 0, '2019-04-27 10:47:42'),
('9bb788e277e02e21ed693bf643413cc7cfd6d712a658c8629a7234547d556104fd08e64938a225a1', 'ca25c1f7476a55f42ca2b268a685372dae34d8605fc377b1dde59c4e792b790729b30ccceb5cb0d5', 0, '2019-02-12 13:15:50'),
('9bc9d2c1ae35992eeedda5c56a415f3985805ed091b227ebf0582605e034c4c6120358caf8138d21', '65b5ec65c9f63f2dbba5f55cba9311310db953bcfbadfa3c7520a15de567f7ad36608f79157eb4d4', 0, '2020-05-30 13:13:21'),
('9c1a924e148c7d7f5bef9f4f9259819ef974c128064a80fc77dfdc8cf35b378dcfb55a8633c14ee9', '17c9498f33f72b8846813babc3dff6b3a646a5421504c6bc4ea4ebcc0ce5deb3438e54d4027ba799', 0, '2019-07-26 08:46:25'),
('9c218dc403dfe7f72d471d040f6a7844f6290375909000752691ec2e473751e3179b7114ee75f97b', '5dc7fef0ece9e12bd0e846191b2c2d72ca0070ae852ab68727f46ea5b709df4843f5e0d9f8cb307d', 0, '2019-03-27 09:41:09'),
('9c7532543bb51d420d20ae4122a493b34e6ff67880628b2bb2dc3b071c87581b889289cb2b2ef44e', '22a93cf9f636136bd6f18aa9cd8400db6d371cef1db956ded8371340634eb98cf1791132b89587bf', 0, '2019-02-14 05:11:52'),
('9c7602eff41242bfc419ade67ed627c044b501421e77471e3bb52729725515492cbe9c40136918f8', '6f0087eb1e456504c91a84d47d0bf10ec1500eaad0e51ee8ac6f436ff3b636357ed7f90019bbc83e', 0, '2020-01-18 03:47:43'),
('9ca57ff945526b87afbd4dd2119c1cfa22422fad57da723c2149d551c3acc5966d559a5ba9489825', 'fb47a1f0bdd030d53ffd91345a3b015bd50523cafde30d6af2f69f4521ec54d5bf1ed092ac4af8c8', 0, '2020-03-01 14:57:48'),
('9cbc90106c8ba8f5c9246f1e29c50cd51ade624fa22e687c441081f39dd6dd94feb8c662aafa2612', '0e9cd5105a0ff4e44503efb5a45202f5f99ef71b0feeb964163186e32af3f39d57a7fcf197010f25', 0, '2019-05-10 07:46:22'),
('9d2ee2bb8ac846984526bee9e0ec3e3c7bba152523e01df80dac4a42704aa6dc6eee771cd4573208', '4746eede97e66055f123001217976985252fca0eddccdbf595c1240554ef6076bec1d70dbd89d0b6', 0, '2019-12-10 22:11:21'),
('9d33cce2bbd498f262b23d77ea310ef569d364f39387a910241b153d7cc58d9aa5607a21151d4fc0', '63ecde0bdc2e1e5d9a1d3116ca99bc474e244016798d95c2bcbabb3d6390935443269b0836542cd5', 0, '2019-05-17 12:31:31'),
('9d38b11af35ad48f11d8f21dc92b730048d7df33d615620f45f41f257acb0028f6b1d56bee34e876', '56a8ae67ccdf44ec301b2641910460621e086973af2e8145349712b1b406e24dd03996d9191ca7a6', 0, '2019-04-25 07:04:50'),
('9d39143b9e29806ac3d071f967639a6ed5c549926b06d967748f9084961a766b88c2969a68c423d0', 'ee6cbeb6fe555637f72c8c3909d79602d609a141f6430ab1f4ef35b183070c9563d63185fde03180', 0, '2019-12-18 19:53:42'),
('9d43afe10639173f6876b5e3a04e233d110e9e1ee36178772a02156d67a3d16048dbf7355d89dd8b', '24bbbfbbc8b6845756f47e1f1059006a60c0ef9536475cac037a07f91fbe61ee10d945def13644ab', 0, '2020-06-25 02:25:27'),
('9d4a053ce8b06510f5257c14dd5a7f07ce41c57445ec31f67e1ec5a694f48425fe0bf98b63f7019d', 'fedfe7b5710a7a7de4eae4b730d5d329d7eb19d5cd39d5e07e8de23f5a88c18701100f702d8da6b8', 0, '2019-05-01 05:13:24'),
('9d859764de3125bb86cc169ed4494dc47f41b6cbab67b5b1feec4821388bfdf5b78d8154eff06d52', '868bc333631c4923919c606c189d69fc1d55861a86269e7f8cfba64260fb6feb5a4f813d9159bed1', 0, '2019-07-23 08:35:35'),
('9da9acdc0a8bd64c2c3d432e134262bea760e328443813c87022b566544eeab0d2ec717cdb963f5f', '6a086e1ae1bf18152d5d570642be880ed005c0da371d8fc0d11f2381cc70cdf55c36004802d54748', 0, '2019-02-09 12:57:02'),
('9ddbd1a5a42a045765153686b74600548e4672b77dc98f0ace4b554ba24251e1960ef0e6af04e56a', 'd5579be968dedf9ddeaae86c8ac884c92011f700be63e10df8693f326821c43bf0851c87562a0bbf', 0, '2020-06-28 12:11:56'),
('9de346eaf76ab5ef9e12ec38c280c1c39c1ddcb4adc15427d980d9da16352fa15291691e50267c72', '40f36dc8d1f897a3e40a26656824004db7cb7e1c09f7aa5a3c3bd2ea896da8009ab2ed995b89ad74', 0, '2019-10-01 01:28:14'),
('9df261d96931c31e9aa26fc733113fdf875754cd1f3b7219bf07f3c2bc8821aadb505065af95997a', '597cb57949b3c7a0e274d1d8b7d7885dfa8a522de19740671fcbc7fb4b9194ed04755c74b68e81c9', 0, '2019-04-10 04:39:24'),
('9dfa7b4ce1807bc485d02cfcfd89f7bbf0f3b7c6ae946ed6210c2acf766ac7f1458b9e2c6f325c02', 'b18ada631c307c75d8445894b03b7220156510bc17156c01e1ab5217f54612a8b19c7254afde4e17', 0, '2019-05-31 11:54:23'),
('9dfe9eff8534c52e1d7225cedfb5168cb90daa6e67994c5af4c6c0891a7ae8688f1a2c3835b4b9f1', 'f5ed3bd79d6b317bd6df5758475b43c755eb94986fea7d86a5be4cab685255b3375403c7e98906cc', 0, '2019-05-22 06:25:38'),
('9e1db13c8bd44e5e018b2d77dda7e416fe90e7108d707196b53a965eb1ccac7a22a3c59ce33b0220', 'ee834996cbe75ffde7b70d08a877a887b9bed347f2ad995236409dc323626c11c2792aa64192625c', 0, '2019-02-09 12:50:28'),
('9e277cdfc403168d2d3405d3ea8d2875c697a36355feb28bb5e0e55c6bf1addd2935585598290509', '1bd849102f6c49b03d3a4b583d6e6ef53331195c0e29698dede45d19a7665374843c6e95873e86ec', 0, '2020-01-28 00:40:44'),
('9e4a285104888935188a00da172f860b0880f969141027ab7993370046866a7073b06042412523d5', 'b5e67c94bfe8ca26f949b790ded45362d9fdb851fb6211c28e1dfb512405a165d09af5964783f6e2', 0, '2019-07-05 02:17:41'),
('9e5fc95084c6377972cddb6861e4eb15abab6157532fa48bbdb14598b2325071e6112c14829c5462', '0acb147d2f181ba1b4a420f0fc092ac7013f57ddd125aef428f9bf9abcbc120f5d8483f2cfc74f56', 0, '2019-07-23 02:36:40'),
('9e6f4c19bc97ff55643bfd70e87160bdf694ec543756ffccbff2beee9416f0ca0dc806c4b8321deb', 'b85d009d371d22318119c2dbb5447fd323a1a7015b6517ec1af7ef98cb3120583dc3caeab73291a9', 0, '2019-09-20 02:03:23'),
('9eb2ce0dee70bf0d442727b263c5abf43a450ff3a9f988fb9e3d883c885477cb79c906afdfa6ced0', 'aeac5280b991724cd8b28b52d060693aa4ab423b930f62078d979a985f06f47a2f928e776210d01f', 0, '2019-04-18 13:36:51'),
('9eb57a1d4fdcf63dabf0c076d60918c810d3ec64ddda4bbc064a9587e481ce1f65c2fd08f3cbd7af', 'ecc6e46103c8ef83afc1b0a528fc309126c3ae700b198dd3c379e866017374d35f708b972a52c69b', 0, '2020-01-30 01:39:39'),
('9ebc51626c39ef73d5e51629b0da1a0582d20a212782924e3c40c39b023d00d4283fcf046f622211', '9bbd3dd04089adafe1180b31c89b9bb69fbf52c7cd3cb1547d52aff3cdc0bb6d5275d3e975eb667e', 0, '2019-04-27 10:24:35'),
('9ebf3c31feb707ce2ba60924268ca1aba6705a2f1de6e1546555e36cada68a0d10598390e5f33f03', '34224e53cd7f175d68bbf1e2401bab5a187064b8f9a28d5d6d10a20559559fe3eff018abe90cd603', 0, '2020-05-17 09:51:05'),
('9edaac04f6cb9949a46323216b53ea874c3f425374fc67397baef909aba576350c810dcda0bee263', '35c62fb832eb915031380b3bafcbbfdf0eb22462297a226583d2275a52d3743cb2359cdd92ef61df', 0, '2019-10-24 19:33:57'),
('9efcc08195c32766ac5d0a1bf9569ca28e71d28c9533bbe8d1353d1beee55ccb0f57d0f571c695f2', 'da19ac9627d9a9518b1d1ad51819826fbfdd6aee6a2238ef38a27c5747d5e0b78cc43eddfc138053', 0, '2019-02-06 11:44:03'),
('9f1ff79d3b0737bef03529a83a52c7d05755f0a9cdf1624db17391c22c27b0f407d62741bc33115d', '3c46dfdcf94cce78446d9957d6eb689e7a57279576986e2c12781fc6ff9b2ac9eac50cd2cc53f271', 0, '2019-03-15 05:26:11'),
('9f217a32575ce0dd2a9eccc7dfac46c16ab3f245528a82ae9901882eb0c4c1bb7bdabe4d2eb7f587', 'ccd89d5efef93349054ce70495c675455aca49b6c25d0c646f4aeea5626f9659baf27c976c371dbf', 0, '2020-02-14 22:54:32'),
('9f3a90cd4ea543175a8176ce9e52df08a166e28d4d58e247485c937ae035934e82d55bf354f91b18', '1c534a4252d272753c41e132e6ab86d8ff3b6ff0211ea923c0d5bb0d8f0f5f2209da6aef6f6982ee', 0, '2019-10-09 21:58:32'),
('9f938d617131504d12f6e5e240f92632bda76f1f966a1ed7ed4a84076b6c52f1dde802c2cbdc8deb', '7782c293f5749981b2f43ef7ec2019cf4b52377f79fa6fde88970730ce9af02928c71f078527ac76', 0, '2020-02-12 09:11:24'),
('9fc75f35a5d928bfbbca08552a353a3a58e1b950eec211b6b03f3e02f2a2d8f460c735f77dfdbc75', 'b1ced1cbc43854c20acc3706252851b653321c515a72293e2a26724835935bbf5829c6b0a3b520cd', 0, '2019-07-23 08:38:52'),
('a022514de98cb8b455c977e03dfae53a193d882ea6c7383f6b8c37eac59bf9c8b28904337c736287', '97bbc9972d33a9cb9d4ed8dcb70d431a1cd367b292771c48e40b4e744b68759a31b3b5b68d9c9c5d', 0, '2020-02-14 00:47:30'),
('a029f8a7a9144f7c88ff2da2f96324728efde5092eeda3eec125523f41f7390145883da0bc84e0a3', '0b9f4c56a052865af53e9367bda0fdeb0b86ed645e3650db6d44c6c69c228d04d07ea2cf6b288f80', 0, '2020-02-28 04:23:23'),
('a03cb1af18dc7ee917af784c715d04e53f7b4499502d03f10d908229bbd15ed04b5e2bcd23d45907', '2b6cd9ece2e0159348ef564d391a5b85067eef7b7ead7c70db17cbb0fdb20b35a80a2285c531a89e', 0, '2019-02-13 04:59:18'),
('a0be8f7a59af3eb1cc4d015a4913c128b6969672e6c382a830ea7290d12e6a5d00ef64dd7e646af2', '616d9006ddb7863529d4fe14634f42b9582f404585ea767263de2c7f3938a19b037283f7fdd8cffb', 0, '2019-10-04 09:12:43'),
('a0bf41571fbeb5528a55b7856d84d0e67ea9ff4807635415617201876e2ade1c12f78b7aa08ec588', '2f2ff475b6f6acc224320993a827218521513130a13bcc75dcbd6493f893738cda032153edbdbe90', 0, '2020-02-12 01:53:12'),
('a0ec105b851fe61f9ddb7358041426aaa742cedbc315eca52be48a7d46f2e4390cd21df7168ac155', 'd3c56a2951d233b046080e10342f79e5a7517b5c3c34ae5d91a531f93e288139196b59887707f9c5', 0, '2019-11-28 06:44:26'),
('a11ccfa3af3b0943a00ac0401fe67ab719b5f378eed122a9ea25abaf6745d1f0ccc53f2ada3617d8', '0efbb3dc35d146df408305663c707a5e95ce001f4b525883995e08927b5708c24b53327ace518fdf', 0, '2019-11-27 09:31:59'),
('a12dbb9a005c32e4dddb7a802a024e305b87288392d7a85d7f36e4c71a6a23ed24b6e3a0d91b8153', '0400c9b04f8639498b92cdd5b2532d5fe04be7e594d3612d620de5fcdcc0dd8b877b4bbe287a99c5', 0, '2020-03-01 12:55:23'),
('a14c1f5e18d6d079b3bcccc5f4b19bd5571d75d3701c56e7243089a0d7cfc564fcfceaa79d69cd45', 'aeb46fd8fb44b8db54943208ff4a29930d0b692147b7bb212a0863647e1fa5144126364ed37440e3', 0, '2019-11-28 10:24:44'),
('a1516ac3190dc8aeb97e3cb1ccc3b22dc00729f9153a74dae4d89bd0eddbb97912c89fe0295a230e', '37b5a752f9cf008c6851dddd05b8044e339bfaab128baf71668541695dd21c86af9856268c33d77d', 0, '2019-02-06 07:29:54'),
('a15c996ca9a8561e82bbbd856f97a76d21703965c15c35e6db9eea9666399f0ae66f0a8e5dad2fde', '55d0e4964b158127f613bc65b4aae1b34aa33681e8037f706d6f0c021b456b3a8d1dadbc8e3f3f57', 0, '2019-11-28 07:03:43'),
('a15ca3ca6b8da3c0f2f01e19713214b74b0d136e92919fff37bf7f7a8437745dcc9c2053e1aacdc7', '7bf035d880b13d6476a426ed9f3386ffba58b912e1e765fed5d01aa7f09bf1aa6f8cb19902ad8169', 0, '2019-05-10 07:47:46'),
('a166d9c6f6b0edb25e0be7d3a0342449fe6d0733d7a87e735823eb706feb39afc61b58813bf56ef4', '750e040cd05e5d7b172070c6893c0d3f068ab1bc5791df4d9ed9d41764ef37bef5b13780e12a8f95', 0, '2020-05-17 12:06:25'),
('a184c56f7bfb96d95f34eef13c781f7718f6077d9b613687b7df5378b5f1ea40a9003e5b16d3b7d2', 'b8cdfc8d6529af151995996526548b3d157cab8966341046280d3e271410c2ab3582139ff27e06e1', 0, '2019-02-16 11:37:12'),
('a189af9624dd8899c9772c934e1dd6e385cb992aebf1c2d1ef629cb8dca67933e0d0eaed8deb01ad', 'c1057052f3d7c33a605ccc6cbc437b99961ec3712f9249fcdda1aebaae30ad5cf0d0265aee350b4f', 0, '2019-10-05 11:14:52'),
('a18dd949f18cd93b5b2b787f5677d52e111cc3dc3962ff9230da6eb057e4d21ffb80bb323b15dec1', '2698c9fb47a3be663bfd3e14f5debadedcc3aa7b8e298d419782e718bf201a8468ad624228ad6cf0', 0, '2020-05-24 14:32:59'),
('a1d1fbbde1a4b3453e3000d6abd8c5c675e0c79c9c7c5e52d9c865bded0fa4675f01865cd32469e0', 'fd6b566616840fc50779544634e4c60254cf63ce53bac59133da7e56e396d54ca21b416253ea7592', 0, '2019-07-23 11:06:05'),
('a1e741447afbfc276e7ebfd85fce6c8f96fcdede2fe32a38ad227853f52eb772ea756a6ccf899576', 'e75e12ecb11be793d99cb84c3bb0cd6e21b93046a4d9939d6c06b550321af2173e37096280a27b7b', 0, '2019-11-28 10:02:50'),
('a1f6c8dd90e2eb7f632e332ff40606b912edb4066cdcb0112e8c17c5d56de352df70bfb7cd67c53d', 'd2a8b9057f4f34c002ff8792b885eb3b4c2f50d69bf105351d537e8196829396b91076ffae647514', 0, '2020-02-05 03:34:00'),
('a2300bd3d507b824d63b21cfaccfebb12e562f91a6d9a01021d91e69cd074601146dcfd1994ec580', 'd26f6ae8c71734a4e4338a616d4a6d36a9ef0edf54200f41be2b175d16df2e999f1cff6b9864f520', 0, '2020-04-10 00:59:49'),
('a24822a0d9e3cdcfcf79e687ab255e008d2686ed032237f80958fe043cf8f5e94ffa830ddcc9d8b7', 'eb6cf55d59ca639648281a9569fa5010b8946e8cf0868fadd98bca61c1891e83464c8874070f5953', 0, '2019-05-14 09:38:31'),
('a29fd69358cfb61a27e24ca0f60098b4da640c100055cc2d7506d14a34aa03ce0ad60b969ea35748', '143f55426f86e26c756119c5b808cefcd94b1ef41437e67f3030d77390f490f6ac2d7d0cccd0856e', 0, '2019-05-09 04:55:28'),
('a2b379a55315af3267aa5f79dd4c9f1bd9d625f6dceddbfc89c5820e1226dbf304a51686aec34290', '0f5fc96729833e35d97a44d5fd867898eab5929d3ea5d03f06d284c423cf34f0e157bb71e2dbad1f', 0, '2019-02-07 08:54:18'),
('a2ba89d41c6d54143d4c7789596eae76d93722a45c786a0514718f27127d5478a74500e14a60efe3', '620268294dec24b45b0387fa6c3e6a7350c92e124811ac6d5b063b41229bc358d82453bd0b30eb8c', 0, '2019-05-09 04:26:15'),
('a2cec82477cbc93a9b4eaa55e11abfda233d2936862a9e38061013dc368df7b7b444b6d2a576e424', '9e9455ca9f3b0b6f0f4331a42994b352338965ae5d07be50a1a808f727f77b19a0f514d5995741ea', 0, '2019-03-27 07:43:24'),
('a2e8b6c47868dd8430200c369f84291387d7410c679e137387cacf534b271302e72dd93c939ac72f', '80873a36546506d694dd7e3b538c8135ca8c34331d5dfda61a98fff38837bd90b80e47debc89c559', 0, '2019-02-07 10:45:47'),
('a2f1cd9b86ea066df9c8183b9edfad15ea3a9820c065d379389cb1fe4b66e4c8421f74094e28c8da', '4b0a33739fe7815eedc2a9cf3d9f92c2de595e757674c5cc9bb4f6824c9fb7d2a2e69f3890027056', 0, '2019-12-19 00:58:25'),
('a30a5188dcc21c30c80c756228b23ddd57a8e26407a608d96d6d6d32255e438656721bdc73a434c7', '1052a5e4873eb95ef2657d36998ec354aec28164f1601f39a2ce76be408fbcaf9417c6bc654c75d7', 0, '2020-05-08 12:41:55'),
('a30bbba7e26412a599c6ee1c47e137ae36fd010f28e473b6cc7a70f9e5337df667c737936758e950', 'ebc7c3cdd1fc4dc96d84dbaaf07d361d339358e7e6a6b976319b7c2f3026ef09d6beec2a9f3706cd', 0, '2019-03-22 06:31:06'),
('a30fd0f2bfdf0ab977a1bd5064c7a5501059bec6c649ba72627ba583ce1ef32c3196597041d674a6', 'afa9dca1fd2da8b8f0e9bdf5df78f708eab09fc6295f9bee578195a26640c692920f79bde9c6674d', 0, '2019-04-06 10:05:29'),
('a31a09668c8101abf32bb9eb42f21c190eae41f61303f7495105974491c687a6bbeb74ae1cbc67f5', '646d40642d86ea386fd6ac6d91530a514c7ac4770d4b33e319f1d8bf0f43a321468529db3e5b0443', 0, '2020-03-01 12:39:32'),
('a32a2dad5759e5f7bd220957ed259d6cc190cf2f9257ef05496cd87b8690b9b64d9c561c5c6791db', '5e85f82fe072a521c83c9b37b7ba85f6f69777fb3dca9f3dc6e91cc928155acecaa4a84c66d49479', 0, '2020-01-18 03:51:56'),
('a33342bf1482b3ab874c4364e1e3d463dc98b8c90e8dacd35f338ee9ac474ef0fb0173149ccffdae', '1b1b792a3d84f9677fdb2aa5612be66f02ccf43e49a8f1c46a35539380f2933d2385640b051ddbde', 0, '2020-02-14 06:54:51'),
('a35d4872afb6da4eb8fec5bef970f9c33e1e1cd594d3bbfe6f8d8109b6b23e45f5124e903b74e03e', '1b1e4741ba3dd48941736b869f4dcdfcb729f5f2e6aeddbdddce7f9b86577d36ba9941e54e12e5a5', 0, '2020-01-09 05:06:19'),
('a381bf2988ffaa01f67628342997e5951e4cd39a5286316df5e2cd34c0fbbe8a2f5e6fd356a40a98', '4719cacd94c11c7c3a25ad6350ef5d3b7e357a06bcd7f4a6ca5a836b39f4fe85a46373733b4ce24c', 0, '2020-05-08 11:59:38'),
('a3cc9876a48d5f94bd6ba74cfe2926f679533804694a01f58034ac13b46efbaeb8294a3e1ccb582a', 'adecb95b138c9d1d67642dc0176fe288f7f2e2aacb335874757fd41d5a1dc4c04d292bcc535552f6', 0, '2020-04-10 02:03:12'),
('a40a3d5f2587919612f0ceadb2ecd03ea74fc858ea0a70aba83e263c4b8c4daa5da22402e9f175f9', '41c0920b567df4b85e2442a3a0e179c408febe64233c0fa93c2c2d340a57158a17597155c20f0a79', 0, '2019-03-24 05:52:39'),
('a421f5541dd0fc614ac99d69577571e262ebe10761b2fe7fe65612327e46d2492613ce2592f03bf8', '4c74377c53e25b2ae34c51a3ca129251fcc92536edcf164c043711209a0bd0b4ea505cc238b8f507', 0, '2019-04-02 05:30:09'),
('a4260a3a429d56ad74eedea3bdfc6e5251dcbd7e2d041ffec53c07c34ebf40fc61a593fdcf533215', 'c2d51814df2e03df8b1396b5cb5f9e2198c516977373045aa8fb9b6551f7fe30dbfbd47740c01418', 0, '2020-11-06 21:20:12'),
('a44224fcb774f0e282ca8ec39d1c779ade4618073303d2a0cc54c1c84660529dd632489ed87b2eb1', 'fb1d66ae13e0b86ad384bad64cacab215a8fd55554caf7c4fe0ed52e0f813b239073aa7b237285fb', 0, '2019-04-17 13:40:44'),
('a4f078dd4f33708f008e7a9318fc9687fd5cb942f66431941a7e717e01211a3929e1707e8c777c1f', '4628f6b5f113048ec573c973c2c4b7025e631953cf1c29e5932e5c4050574137d27f04d92ce6d7e8', 0, '2020-02-13 04:20:17'),
('a4f773b0e8dc1dcb58ab0a213e2934872f1388ad3515f03efb1cb384040973f609d9c9502b61d885', 'ae2c13bcae493f41c9a0f88bec46fac4bc3e9f0c80955e0de947fb0723a470e97148208240b42d63', 0, '2019-03-21 12:04:06'),
('a510e54ffbf9308699efe1c0d659ba0e758e00a15ed7330e182498272f0a0ae94aeac1163324d20b', 'dd1838a2923ec283c85123ec751b16c14a7478dff0345496c1388e6f049360a7a986c0723cc38170', 0, '2019-11-01 16:35:20'),
('a56504b95d233a88189da306bd3f1dd7d88c265bbf7b498690d8dbaddd28c2266aba785f071feba2', 'a33494f720529a449259626c8751c674e63e74f3c20a563cbebd8fb31eaba94185f1ea1ee8aed64e', 0, '2020-04-18 17:32:41'),
('a5792c30fdd33811c9bbb6ce7165a704ab93b4cfc67fd616661c71b11a582ecfe7c20096516c6693', '9c8fcd7b9822dddfc43456222d380e3b3e11e1483b5bffb66504b4fd4177a024582813f7fb5bd5af', 0, '2020-02-14 06:20:45'),
('a57db8de98f79fdfc6399a8966d3e914b98f00e1e9dbbf683a267315fbe1ad0430c341d4a8f15be0', '126ebf15d595adf83b3abcd83238402637ecef995afc48d20544b14df311fd32e0f86c8bccafa9f5', 0, '2019-02-08 09:34:17'),
('a595e538e738cf1cae68ac63a591999dbd2c12e9d998ebb19a0779c6990821a9bc21cdf4f422c91b', 'c1720a0139c4823e1af0ca8a96ee2efc83f1c5c9dc0e75f8ea7b0aa4fa8828938453d48947214227', 0, '2019-03-29 05:43:56'),
('a5a775dd7c97dedf92c70a47b0a7702041fe784d2f29f3ce8a246a48c0001e165c3724a9089d98a0', '9c8544e41f17b002324a8720f3bf399c13190a04beb9b7955a15c7797e37c961496b4186ace87382', 0, '2019-02-06 10:15:15'),
('a5cb967cacd599bf4d839882928076f1f3d253ffe6f67133372d1cd94e4c711c3dc12f4221ed03e3', '67ddacef43dfd129ff51bbb126c33da8714ac48a3254c2ba27333fbb64baf20a61c122239a98d28e', 0, '2019-07-20 14:17:14'),
('a62d1a92d4bef5f622837dcab26816bbf80b0e7c1bc6687975c429a2f4255ab6d54c5a353f26b0de', 'e29bc88e6d9ee1efe6c0c2228e55ae95e15f4bdc2053ec5657c600257d07adc3fb586546ca2a0086', 0, '2019-03-29 11:33:00'),
('a630aa0f609047c6f8a14cd4c7f4d4195e16625b486a1c9d40a048eb7857ce09079ccaa66f3a5ca6', '0b4af193e69a33f7a270b3e95159ae14ff19656f6da5c1a211f50bbf0e8aae03f90ebb8186586ec3', 0, '2019-06-12 14:17:55'),
('a631b5b30067329c711a1c72936cf44566fe5ecd95d678579b89d68459243c6abd21a144d7c5dc42', '843fe35c30cfb32ec61930f3ce9819b48bb05aa6451dc3b2957603750a35df65cd328f312370f93c', 0, '2019-05-14 10:55:50'),
('a6321ae34e6d94aa5d44ade401e2e20ab3842f22f74719008ebda2eba882da0ec5fc43a28e216414', '8ccf7e588601628d907e6319b2ec64e44d737c78d1aa7d957406cae216327153fb321ed2bdb77f28', 0, '2020-02-13 00:28:14'),
('a65a44671533f8c01c49b890e1df352fdf7ebb7baa6c89e0995a7d6397071e2c3e38807a40e229f0', 'd715e7b054bc24a8761d5e680228faac25e9e223d95cbeb7942fb8ee725633b08eeeedd49aca71a2', 0, '2019-03-27 07:44:36'),
('a6602e6f6d690d39f0d985b07649b85380297cb89ba5bda8660de11eecf5edeac69eaf47e9e30718', '91da7354b9ef23a34e5d058d2edb8e43328951028ea7123291dce10d1fe45313e97cbc35c0d59c33', 0, '2020-02-12 04:34:35'),
('a69be8726c2a41cf418eb05558a84c6583248a035587edbd9eaf968a231e845235c218840ac149c3', '35e63a2b91439fbfbea819944f290f4f4b17463c6c4a6f0f8fcbb5ce7ee727d506672b1e2d590ba5', 0, '2019-04-25 08:32:18'),
('a6c5fd58efb58eed272b2e4608e48f70304d63d76f8abc49809efea61b85a154e76342741505129d', '5f779d92ce474f053273f5adf22519e0bd5e97e84b3059e77b0a5f703882b809150804e9b45c579f', 0, '2019-04-09 04:23:40'),
('a70d97ab8fe4de73e23241f3ce77df73bfc45829c6018da42ebf760477b595880d0b0231e915b8f4', '51e590596477a81008125933d5a21e198865523370087f9dc0141eff9b683b06b44ddf62f2e85eac', 0, '2019-10-01 23:25:06'),
('a71ff1daa7d6e20d54f0c8e710311e1836f0ee2cf58657e9e83ef0f1a02992bb34d424770a1d7625', '89557ab7bfcaaece370f638c64bf53db0cc77505d1a6af9aa8e23b4fff6694437b6014fc3c2b877b', 0, '2019-05-21 13:28:22'),
('a74a46d0b03234234c3b3695fbc63e1857b51f368275da9909262f7bdf3c5b2751778ec1e79d56bf', 'd31bb0203be819df91e10ebbdc566031fb07563fd9fbb93de5bff403395b877832b2ee2c5ec80489', 0, '2019-05-16 14:43:36'),
('a77486b8d697c7b52886cf6901f4cf433b01c622ab04c29660d8b83ce575b1e9fba97082b3a01e97', '1d979b44379d322a081b22dfc052dd17609f78d72733b4d6df5ec72b250e97dce404156d93cfa0e0', 0, '2019-02-07 04:58:15'),
('a79cbb90a4d52d29163132f4ad130d2933f40ff609611f26a7a2ecdc6531207cfcb7d3e7a5a4a627', '5b4db5b0c9223fc627a599daf695aca1cce0c84977a8f4cde2c269404d4333cf67b8a67ce18706a9', 0, '2019-10-25 02:12:49'),
('a79e2d4e6a656f8db26e21f84a1e59fa19220f8d8a11eb31f3062e3644d037a4fa24f3dc4571eff7', 'dcab258d38113a6f1cfeca6b2493598e3f853b637fac535d68fa051a90c3ac7e554bf4f25e04b6b5', 0, '2019-04-10 08:46:21'),
('a7c29a1641b088565aebef909cc6d2b9b006285e77538cbfcf4365743f5682af4fff7cc4ebb7b550', '0d7b06c5272f3ea27c5e2e06bc1ee8331b6632210b8022486db51768274b19de862a573003e86fcb', 0, '2019-05-31 12:36:35'),
('a7d4946c0f2b51b59f54c377f21c3554794231f992c98e84bdda4342696bf698a8026ff85e6d0fb5', 'fab526aaf94b9f066c2df8386ec755c652af1ea33b01f6921a476724027b7ad98e6b08714f5700c5', 0, '2019-03-27 12:15:17'),
('a7dcc633162f892224751085d3809c1d9dd0f9e4cdb067b367398a3033ed75442bbde2bf753d5e33', '2501f461e7a52bf610a247c279a4a74abe3a2608f8ccd3a591384e6df70a1581dbfe6801429b096b', 0, '2019-05-04 08:25:06'),
('a7f0affd4eec6a1eed8f9794dafcedd767d576c21155d63ba116a5cc0afb98e2ccb42637e38dc7ef', '44df6591a98c873ae9a983ef6e3a837212652890622bc9aaef009b0b2fa45e23c45086034a4dcc09', 0, '2019-05-03 10:47:28'),
('a88c02ba93ced3d6b21a5339483521b7ee35e9c606517c81bd79c0f238ca0054981e9771b5289c08', '3df5deb810e3d9a35c2dabe73f8e99a28c0c248b4b188422b6a4c176ac7cd990676a7a4f94efc050', 0, '2020-05-10 10:37:32'),
('a8dc8d0e81767c46baf14fb7dc4a7d880531d51cd96ad61330a6eb5ff534e200699a25c15a424023', '8e1fac5e7c43ea0de660fbf45a18b3fce12eee7e4ecbd145283554728e71b3b7b48b25dc90904f50', 0, '2020-02-12 04:05:33'),
('a990fedbc59e8a9b1f558ac75c742cce7dffcfbf7e5ba93ce9bd59170a85dbe646e566b8cc27fcef', '3fa962956d50072edadd92c469cbedc6ef6e3cc0e25a4a055995165972cb4e2a73898270745028ef', 0, '2019-12-25 17:20:49'),
('a9f0c259f6a37596134df53e00ca73139be6eb9a27f486ae842b80f44ee0ab3d13ae21a68726582f', '001d080c3c1bda152d4d74f62dec3a343bc1278baac2b3b52e10d19406052706c7f5d087361dc8f3', 0, '2019-04-17 14:00:28'),
('aa023cc25f77b04a86722d92a8a9f0e16cfec847824e84fad658424445ececae2e1c1386cb609bff', 'bf68bbd24813ee54ecacef153e0eb2e98dc40d3d3e0abbafd2ab3d9f7967940bb4f5f5e9e7f0061e', 0, '2019-02-08 09:42:48'),
('aa58826f618788ca879f607d6084cda9e0f1e621e2f4b50f11813f7725daf9d0216b4d4f14cf351d', 'ea7b8701d20563e81544f7b39a41d42b8a8000be729601be3159bcc610540d7a5e0cba9f6ffeeb02', 0, '2019-02-12 12:23:55'),
('aa908ca2e248adae6fd8d098d6b65bd383fd76c53f3e5eeeb98ea78c90b8e0d2c3c5e96b4b9d9fb2', '39541b85d3192f957be0e5a2e79939c683882947f71f2ac4fd948db23b890083358eb5615f5cf2bb', 0, '2020-02-14 07:04:49'),
('aa97ca563aef19fc713ac97c1b39ce7e5fc9319191ccc08b787fce78d585ed4c243c0d94f5f251a9', '7f0c0291bbd4f618514b5d0407da67fe6581e31232162fa51617bc0ad05613768ce450a252375a44', 0, '2019-11-15 18:41:17'),
('ab17fe9d1b97c670bb80736c0740863456bef42c99fd7e51a5c3398cbfc3c347e564a7b9972416ad', '76e2a5e9790003e4d1b75f5c7c7735612132516e55422d3b2160e6a194e0542b2630a0b9ed2bb6c3', 0, '2019-03-23 11:40:08'),
('ab4968bb81aeba7f6d734b62106280004b9b9f2d667afd0a445945aacae0a72c89fe9c2a9280327b', '31f99dad298cf05c136bc698047384b8a57459aab8ce2ad79ed21ed871009584fcd461bd9b4d1857', 0, '2020-01-18 04:22:41'),
('ab5c5cd1cac6acf70eb9cacd8b38bf737ff34ed255a983455873d6b815b012e8cc6bfa31cf498378', 'ead62ef8be395bab393eeb395bd20ddaff8e272253f11b3775a1c291831303805bf365aa3281a4ba', 0, '2019-10-02 06:47:20'),
('ab660ce54a708458e89ea7c15b49e7097587b3dc4f0d21601593c72b36966974cfbb2931f66f4c89', '0a38ec421c9dc126f601cc148022519c80df2217c96af5e2061b47b0fcbe188fe8563ad113767c63', 0, '2019-05-15 07:43:09'),
('ab716b9c5210e87285b69197cf560061d8fd30bcfececbe92cca02318d43ec9c0c7dcdbd14925e30', 'ab9201f7b5b7463d9342a5c98f39499ada6bd3ef14a1e2d45ba69ed91cb4cea015efbbc883fe8a79', 0, '2019-05-11 08:36:21'),
('ab9a4a68950a878d17f0b57dc73dcfddbe2d6e4a176cb27a382ea0290754c903e314c84b1f156a1a', 'ff7dc56cce863047e8ad45e7f742d2a908903a3118223cd91721cfb5decb2a8703ff2322312ca118', 0, '2019-10-10 13:04:39'),
('abb587eef03e96784409319311758db7fc7512ef86315151e3c5929d1c512072dcaf40251c3e03e7', '4e56d74d600c1864d9ba66c110c89db0035c8905d781be5d7bfbbd1eb07e5d218864c6d064fa3747', 0, '2019-05-31 11:38:52'),
('abb5ede5d984541ecba78bd3efb0e6efd69a6ebe014331c4989c21c9bbf9fa5542fce094c402e2c3', 'e3937f93444b753fdcae9258ec16b18591f038cc07a6ece8c8c65d59bb4dd4f1d9c970e358e7b4d9', 0, '2019-05-04 09:50:02'),
('abbf70172c972a110b33797b038b79d2003f0edf48c7f13afb205e58fee6efaee8cdf9cd28489243', '2dfc6edc3dad849885221c2442ac58d0c198d506e0721296e5dbaf7bf46bf7dc0b7318d0c33898fa', 0, '2019-12-21 00:31:14'),
('abd86f8f9957c3a97bb24c4984a54456cb1713d557ad01d0a02944fc5483e8f2c8d4dec62749d6a8', '6dbc399e888f7e6b2d665715f838d4e7e784f023c54638d86184c284a29f500f6f0c62eded722079', 0, '2019-10-18 09:51:20'),
('abe85db40d2c0ce80884a175a154324c05e91eb908c41a1a83fc4e0bf196eab336e7329fc25617f7', 'd1afaac19a163ddd9a282f0f5cb0481471cc7d2c76dce6e3afe0d0883b3620e1a15ceaeaf16e3a16', 0, '2019-07-24 04:51:15'),
('abfceda88db6b5d381360771d194e48e5e98a61f6a748f57c6abb752a520477757fc347318070d39', '2322eb967091b73db9879bb4bf2b5810fba596d7623bcf789a278cb7640b06df171d4c9dd31690a7', 0, '2019-04-02 05:49:45'),
('ac3bc35dacf7a107e918cf9426ff8bd59826a88ebaad14f92ebe55a2a12773d6bbc1bc78c1828134', 'e2a20ed49fc5e3bfec9a618c3f05a065cc60204d147f9982af48acac5fb05a54e01d15bff57c5a25', 0, '2019-03-22 12:07:16'),
('ac6f9ec4b0f70164bdb82e5789155d71b10813a966f8363c6c184e44ecdd80bca451a06a24e4ccde', '4415a977befbed8e78bb99b33fb3f2f0c1aa4374709000875df6eda7366a955cc4390412d403a17a', 0, '2019-05-21 05:16:19'),
('ac769b18bd37d965f10d03c6671658bc72cc02869ec3bd90fc1e062402519ef2a6abd698ca14de75', '180bae949d98d2c5810e3f1e3f1022f6fa9fa29a2363889dca42b67944a4c4ec8667c2921111d32d', 0, '2019-10-12 00:12:43'),
('ac825c23afef184fb7a0c810e6b9e0074676838468a4baa1624c5acdbc9ea441beffcb9ca773fbde', 'fbece2f8743dcedbaea39dc8fef809580e6c050e1390b068b8440df2bbd735a16ce7e04a0eec812e', 0, '2019-05-17 15:22:48'),
('acaed9e9e009ec60aaf3c30b7f355640e9df6d8d354947f167f1db0d58dec38329ac78dd757c6400', '342ac28de12358c2c2b7a169fb4f5dc15b895a7fe2eda90bf2415430bad1474f4f2883b2c72bbe8f', 0, '2019-04-17 13:42:11'),
('ad3382efdd08b150d9a86fe1f1f798de66c49ea17fb114c97c353311fd7138a92481f03747ad53aa', '57fc6afb4f97fb5b50d0f963facb49acc1858dc54cb618754f10a37f167b9eedd8fbdafad9ee817a', 0, '2019-04-10 04:45:52'),
('ad49e4fff1792722a2082b31f6d4dbaed7c5c35c787b17a1f33b7d3ae72461f79b8cfea69b58f82b', 'bd8bba2059c63db451e91f2e1062cbabb8278c1e3abd63de7cb1e62b65d1d4dbe89703e25a7bd5f9', 0, '2020-05-22 10:26:19'),
('ad7f6526d168d66165ec23f6c1ab9bcaa45c35706f712a8e2f6ecff41ee74689cf0fbdb9b1a93ce7', '80a217d16be39dd460831b3aecc2283b86705cfb7e6f4caee0edc8cab745391a438da995921380e9', 0, '2019-02-08 08:42:35'),
('ad8badc2e918bcada990d045b80ebd8c04958b42ca256c58249f3b5ce5e86f2253ab1650c5235781', '77f87675d1a93b74c8b0c4a227599f067b29fcdc09c4c2c7c9bc7709f141a9bd558feddbe69a1db0', 0, '2020-02-13 03:03:12'),
('ad9c53df945a7039a69edbe33636a237709b7791bb542547873f49bce36e0fcc393c69d77af8fde1', '12acb6ae8a559d45ffb8b182bd7d2a1e153df25bc4fea312bd588e592231c269fffac248d22eb8e4', 0, '2019-05-09 05:41:13'),
('ad9e7c3516373f257633a10475bf62041d96468ec2a04c0a2467db356e05f517b1bae45d2a4b943c', '67c5fdfc20fee10bf1b86496bbb451fcfcd66ae89de9b6f547fd59f2873b0f407774197642ec71c2', 0, '2019-11-27 13:17:01'),
('adc4926abcec11f983eb13cb878902d0ab1c32896d063e55fd835b0ab30c1cf72dfffcd1caa48365', '98038a6387fbff508e12569ba7e6f6a2d4354fe2d2b0671d6de999b31c0f6a445812d10361338cbb', 0, '2019-11-28 00:05:25'),
('adcb08e88bd975ab2719a3d8077df5ab80a7681fd84aa40040e541f95c885323f26d111e57a3ff9c', '19092f9543989ad381f1762678c6e02978901b4b80c4ddc39856da8681a1040cc5784a5038592dc9', 0, '2019-03-23 08:58:45'),
('ade239432f516d43286956ea16c3bcadd9e6e9531c7242d8a859c598714ff51f6e27921b7d43536b', '1a41afd20397a789ff26ea411c9c1b107869c6b6d4fd931ac7426ba229528ae661640e37d1494633', 0, '2019-05-16 07:52:48'),
('ae0e16970c555aa67e010662196f106fe4752867b3bd90bfee197faed6609ef0dcddcaf81b3f71c5', '2160132f230ff325040502cb59fdabf9d13bff36ecc43e1738c747af175ea7dfc0c3d71cd04f2301', 0, '2019-02-07 09:55:26'),
('ae381b366535a720f4ba1c8e16c2c85d688498d10d9d72632abc0fea107d56d3156fe201f600b906', '70075c019477b974f3c4da41cd913cdacd9afeb3abe075b13a3b28a6f497823b397d31abea7b9759', 0, '2019-05-09 06:10:44'),
('ae4f9e772dc20bce6e4aacc4e364373555de0e00c0eb014554743fe93759eceaee48e7a1a56c63a2', '92e44fa8e19a4d09f5aeda35ccf99fb51d7c5504b97349fa83ee2a90f3e46376c4fa58b4ca3fd258', 0, '2019-02-13 14:04:55'),
('ae5688001dbc497dac8af3a1e708a2b957687682095a4db095c90b17cc8a235922f5b7cecaa1cf1a', '65cdeba4744c7d819e51414c2dbaf539e1c9a390d470780eb54f5bc21bfd40e94f2bee3346a5f463', 0, '2019-10-16 00:46:27'),
('ae59e1ed25e7bcfaf3b6c07fe12d34e5a243ca3fd3a118079db237dbe847e3de2d0550d9d419600c', 'bce5ab616651545ccab2eace6b5d6d1314b5febe9ec17782cfcd8650723ec8f4262435a9d8f57be7', 0, '2019-03-24 03:29:34'),
('ae6771e6f262f5470728e411117fa0834bcd96290cb0eed04954fc408021feeb4caa998088b34550', '0cf43f985bbbc515ae2e852f02dfbf09de6d450a13fe3baa296e860f9b3b4df329b20130eb88fd6c', 0, '2019-06-12 14:31:03'),
('ae704121ac5d32bf0c208553406c029c5c9315358e9048e8aaf9671a366f2590b06770421bda6b6e', '99f20cf03d3a8fa732ddeac8bd07162ea0c79ee599df463e55c8b0a9ad3e0a96c295ecdd5c539d7a', 0, '2019-05-04 06:19:28'),
('ae7a5c2ca6549b83aaeac4752e02ebdab95aa71de9e7c3f4a6ac6ab85c79291482df8453e0405be2', '90ffde54e27b9452ba14de37171c23481a2c56bd9df4fbfd0827aea7042fb5fa334a90140cd630dd', 0, '2019-03-30 06:10:28'),
('ae91d1e90d2ab979a81a077b207a2a8877b5a6407f4c9ec72d6310ed79d7f166240d2672e9b07325', '18c90e88f57fe5212bceb8817ccc2b0d86fa221f71283c508de8ce8fa34c9c557b951de3c6c21095', 0, '2019-02-08 08:49:23'),
('ae96c11a028f819e4ea31699ac4d719e7fe26cfb0991a591d6b58ee70fcdeebcb01959060e9145e2', '663b584322825ff4220c6ae78a07dda4d1ff4cb405acc3456cca5567cb7271cdbfa1c816c15bfaf0', 0, '2019-04-18 12:47:33'),
('aeae97d3bf41913cbab69cd11be15cc60e9336023805b585dd150299f43741504bbe180053e0881a', 'eb6528781147469cae91158cd9ef95bdbb047aa2ac6366ab9cb36c54c6ea76f28125124e0dc36786', 0, '2019-10-03 02:08:57'),
('aedad21879675669f69bc1d8ffc4a82adbf45c15a17b578d7a56725a76e710be88bef8fad2af2a6d', '7c94bc1e46fffa7cf94349f22e11fd5163f3013169d3135eac8d2aeea343aca7268b6e724794c9b3', 0, '2019-10-17 22:57:00'),
('af572cff6c148e2f1767014b7fa62ff29e7770f5ef01eadb955d42cb1823f6744fd82cf980cc0826', '451da11518a3e399e27ebf86e80c9908f4ba78e033563aee9fae66d114891bb2e41bf9b3faf1f3be', 0, '2019-06-25 14:06:55'),
('af6b97dc3735c122cd12468e928560f02103a6bc1cb212ef8fc16aed3a31952dbdcc5504abeac493', '2ac78f4f8faca0006cec83c3e642f77038bea8b6509d595fcc98d75a1ff6dc29788906110acbb144', 0, '2019-02-15 07:53:07'),
('afb2fb0953fe0619fe5d1bae7979b8745fada5a4b7e044e51fa30e1d08a5420cd731de595c4a79d9', 'afb6c9ffa2ad500a9ef72c9035535aef7eb9221478078bbf1972eaa4a58830b218b08417d2a30799', 0, '2020-06-07 13:54:07'),
('afcee27fd9d928d2856716fbe19cc591f6873a7c1e8c268caec5b8d4794a85b108ccdb408f210828', '2bc1af1990bc39b358e489cbd839bc3b23dda53b095b46cce67a2f570d9b9a8737e27d5e71e0ef4a', 0, '2019-03-23 09:19:10'),
('b01da83d9de8e5411504499904da9f5130bb8ca178da833d564a1451b2a86cf34ea1494eeb06965f', '6dbac502267cd1ede5998aa69c1a2df81eb10372a3e3bf8aa429a6a37201dee6b4780ecea82d2dd4', 0, '2019-02-07 08:45:51');
INSERT INTO `oauth_refresh_tokens` (`id`, `access_token_id`, `revoked`, `expires_at`) VALUES
('b020f655749df6b8b9f41747cefbe6c27c7087fe68075adadec97238edf795bfa31f133873318413', 'fa632e905e54afcdca1d648e1907b913c20a3133c4c4ef5901b251121ee9c8b81197f72b11d12a88', 0, '2019-04-24 11:05:20'),
('b03eb98a9eefb42d9a29ec8b49702b57964fca3223c8b0a3134d2d3c94c282317c033bf032f50696', '7f6260545080643883c63474f95558a7a87b50ee81542850c8841d173d7e363deead1f24e09b6fb0', 0, '2019-03-29 04:39:59'),
('b04489b43a12900283d68c67773d231bc06c62df7383c1432651a635724018e30c32b7004914cdd0', 'e84642350515b50b5fc56f294c3f8cd1d29823460159bfb45e40d46e3ac9d5720ed0e24591363b2d', 0, '2019-05-14 07:23:51'),
('b0bebf1ec5de079be17266c4ac7fbf23b74e576fa6de66f387fb2d7f26ed14b63ac9d2de56a778e1', '471d704cb8f9473bf25110daf46cd68d1cada8b85e86a186de91f62c811425eb4b4605e29ab18b1e', 0, '2019-05-31 12:33:26'),
('b0cba193a69076370be727a8d41214777db23ed3306621e0ccb0fdd06bc7934a421ff794533fe9b2', '1abbad39ca0db0f93db442f46d4ae855730552a82d26a0e44c65dd79278d5d792e39fcde270aa5ff', 0, '2019-10-10 06:55:42'),
('b0e3d166cb59f92b93f86718e08afa3a74764409c2c5fa1b8d73a37d071816618c441b67a4a395ca', 'bdfb014b908d6d1d190665064800e05b716941ba0ca71ff235bd537b0b4abc9bf8636d4d22cce4aa', 0, '2019-06-12 14:30:52'),
('b11cf9d2a6532c60665c44e1d7d06c3af8e843fdd0ea713e823ba9f102e3f1aa824e97a666cc4c3f', '129b0d6de5fb485894af7812218edf9e53c3fba67da795a1d251d7c26d2536d69d9a173e8151fbbc', 0, '2019-02-07 10:47:57'),
('b14a80789fd3ab11a7e7b5904ee00e0158bb06d8bb388fa26205ac3b7d8ce0aad32219a7b72cb41f', '7f794f84fe049e5cf41fe105c602e89c42a1fa3dd624bccd7ca4f258816187506c3e842223beaf82', 0, '2019-05-23 18:47:24'),
('b16bcf4e3415aa428b2ae849b988bced88823cfb34a1b7712047d4abe22ed12faee23ccb475f4ea9', 'f0438f2d489fdfe1896e07590331ca34b3d1118f200d2f9760d8d17dfcf4eaa113b6394b45d099a2', 0, '2019-03-21 04:45:19'),
('b1b0f4491671c2d017578a7dea9dd43f8019f55eb97f74e33d538dd34811577abc086ce26b959b74', '4967822a79bec22f9e3664587a7ceb4b55bc503e26cfa29764cf5e1b82f5fe2eac79b561d158dcd8', 0, '2019-10-10 02:12:50'),
('b22fb732d25d48cc60ba19df6c1f9671941811febb5ec82b61b7c0695cb28321cd3fc46d717a8be6', 'fdf91e69198ba900c00afe81840e9c8940ba6d519ea370a2230bcb1c7c70cbb1be368a5cdc8ae155', 0, '2020-02-15 09:19:01'),
('b241d7d13edbdf90a8e48ee97bc94bb70b89ecf6cebc1cbbc38ecdb00191caeef8f5c8280db7863e', '80b4b73e329e5d4031091492970b110bbddd53a59b8829eda332c4c7a405dcc0592046e95ed53f50', 0, '2019-02-07 11:37:13'),
('b24370dafe4f45fd059b0b03f97d95a687dbfd72a7c3a65027e4a9e87f9272e0f4962d284010aaa7', '037be80ab38a86c94754c1ca749b631728dfee8dfc220aba3ab2f3c19665bb0bf2734e3ee8409064', 0, '2019-05-01 11:37:18'),
('b285aabe421439c88bbc0d7594f3f007a8dae908b4b38061c6085a37055bc8f4159ac4b47d528a66', '0a190d13abf83fa773e9b68fb30f0e3e26f99d3f97cabb521f5664c74c98dcfa43155a2cc2363efa', 0, '2019-08-15 13:26:29'),
('b2b5be6194ae6c1c6281d4ecc16336777df68cc314f6bdcf4d2267c796e2f63a35b31e0ccb32bd5c', '4e553b4651ccc1bce127beacebdfef0c13a689c6877c0112460eff795e13c3fd88632fd70b120be4', 0, '2019-07-24 11:52:49'),
('b2bb82d7c196a506e1ee0668cb1cbf3b04e1dd75d9e789ee12666d43bb22bfb4992bd4f29751f352', 'e7a875c0e63cd33318997876dcfb6434e6d61d69351a4ade8180fd53703a4fa8624838b7bf007346', 0, '2019-10-10 11:40:45'),
('b2f7539ebf6baa97e0e541c6490f9c3dcd86aa8fb21569907bea09ab3ab30891738e68012e3afbd6', 'eb93c735bfe7ab4bf77ee9044236b7f9ce7fa147bf5a785f7a687799156204ee202d2d2b5d61ef43', 0, '2019-05-03 10:15:49'),
('b30d6e4b76faff973ce1481cf41f5f809fda404b4d67a244b176404aff5fc7c264c5f54c0d8e5c8d', '6eb1447734e8e94c0acfd75152c87f25423a51a27c2df6de66c17e9fc3cfe5a7190b6c553a95e086', 0, '2019-05-22 06:09:45'),
('b3100c20a2d7c4cb89ab834b7535fa9e356ab4258c9a3f5b49850bc06db11a3f2ffa9c10eddb6983', 'bc62235200eeedc9e10e9d31869f2f40f3a2b7c42c9a75dbec52ce6fd94f69ea194d944d203e1ba8', 0, '2019-02-09 15:00:28'),
('b331766c0d6fa20b90f14e3350ad9f5e6790714f3060a31f109d40ddfca2755306f9c84654618fe8', '70d41fd05e7ccb13f8e9f5dd1eedb04a8ab3f745ac76937e87c41c7106585a2002d187b77d391426', 0, '2019-10-23 19:24:24'),
('b3537db0768e98225754efc83488946b76c50b48c604707ef46523b44b7badafdfa9a23c3155a2be', 'b09253b7953f4ce9cebb23d006328ec55763d8d31e0ddf874c68b728e3efe1c2766b152ed1bd4430', 0, '2019-10-11 11:08:53'),
('b359a5ee567145f9a499ae789b65e52b477087093a22487e1520ab4c94b2d9ee547860eff221e847', 'dc702a77dde8eaaecad84dd21da7e339457e8487b12ffe462f41f24878fcf4c9ef3fe32dc530f50d', 0, '2019-05-11 03:37:21'),
('b35f2de5ba51a6c77d0582bc7f1d037c6c142e622020d5ac36568cd5d8d7e33117df0733db73e4b3', 'e096d69757c2001496aa0c2025c5b13624bd3c15e21db51c047202d5cf3b5633a2ec1e9bd0b6187d', 0, '2019-10-05 08:46:57'),
('b363bea46cdc29ab76e13d339e7821f7675ae8e3225db222fb14b11f625dbebec8cf447a080fb7af', 'ee4c8b2bfdeb2decdc895a24810411e4fa370113e2ecc2d72ef8102824723c3589701aef3b0bb00a', 0, '2019-03-27 05:15:10'),
('b385c96d287662562a0b21cda87536abc56148ff2c971bdedca7364a98eed2d4287c0cabec2fe7bb', 'a79c82ec77cd4ee61a1919fde77b62c89b9b775e9996c27d532e8f63f0ee92fd46429611dc8b1858', 0, '2019-04-09 11:38:55'),
('b3c6e896456431f25aacfa8ced27df800d007214d1cdff1bb590a62fc689a9d3bdb55d93658821b5', 'c7f3ffb725015d07dc4b2380d436c22f3978fff8771830c712291945acf4f85687f7846abebaa082', 0, '2019-10-10 04:17:10'),
('b3fe7397c830b7e6e666e9635292e818f1fa8e5236a23d51880d62b80b6cdb1f4894550bb662da0e', 'f3da61dec84c7746177ae20ac8653dc8869dffa82b9b1775d1bfcc8fb2b68abaeb556b7ff86364ca', 0, '2019-02-07 09:15:14'),
('b400e01e01282b3372ffba230ff932ef17c88f36b50dbdcd6b6fc534c554efdedc91b2c4337b1f5e', '610843460624161567d33d75eb2242d05837510e03f7e9b0104bdd278ba49a7095f2b44d3364e650', 0, '2019-02-14 15:31:32'),
('b41ef5a4c7efb0611a1340f34f666f13ea944550da797505dcf37205792674db9f181ac9e0a7eef9', 'ac97c303df2c676aeb55911a1fa1b704e61a667196bc723b0152afbbff8bb9cc099b67b03a7417be', 0, '2019-05-04 09:50:18'),
('b423a86a60215877d376a98252cd7e316a85f16fe992729d0e6a7a2c512e5a004d112acb1f6cd5bf', '1155de3df8cca3b4aa01b5693a959c73514c2cbf76b290a5c3548da19ebbdff19daf00f78d60e0f9', 0, '2019-12-11 06:05:32'),
('b4348f45343f8d37d1b14ce355f094764f3221ffc8379d27d339d436963fbe2fd9da3f134640ef4b', 'fa4d7126e6f52e1b160a2f9b8cc83a1a6813f06e9b84f2d2372dac76db3254c9df98f32f9ee5f16f', 0, '2020-03-20 23:44:32'),
('b43c71b593297cfb16e719f2333b7af6bcb027e4fa26e037e2fb29a2f054a6d38baaadc619e2d305', 'bcb95228633455e49146dcf460858c108dbccb600bddbf3300ad8bb4ace1d490672c168430f91d32', 0, '2019-09-25 03:21:25'),
('b440b9eec55e585e9e59eca4fb0af0e0443ab938984d37490a4d41295f08bc411e618b68267f5689', '9fc8b79596e53c5382e6e5783d36fd2115a705dc2df9e88bd31f662c6cc4684b0fd60254bb2e33a8', 0, '2019-03-30 06:11:13'),
('b47210748e74384b999a6dcd4744daa0307ae365ca22a4118df270046ffa369473fe5c69f015c669', 'd3d63a864f78ff6c33023102b9e5c0dc6aec1172b2d6949fb43527186b4b85df1be8066efdc271d9', 0, '2019-02-09 13:46:34'),
('b486169355c4b963f3ff5be946ea25b43fd6243c96f2890a7d5a14b602574794b7a299fa423decaf', '8b5dd97909b8a529c33fa73e5d760c741cb0682a0680ca66a412a0f8a3d706da4f0e33d63b7f7f08', 0, '2020-04-10 06:59:14'),
('b4d14d32907a28d8a8b85506c4a81929e197686c251aebc30aa75937b7452f9422e889762d39965f', 'f4b66f9e0c2358809b5d056e8800b1d73e23aa74d3bb1987f6cef55c65dcb801ab2401115b985ae8', 0, '2019-12-11 01:39:38'),
('b4efb4988736b8085fa2f6cd1af369213d47ca3507c59dd46a39fcd23f99b80b4316d8bb6c2c7f77', 'f4340d7e74e9209e9ea8d404728f4cecdb2727744b61c48a59f394ced55db7ccdaf49aafb5187016', 0, '2020-02-05 03:05:16'),
('b517914ed40b232f74dd5927cef677d0d901db9daf53078cbafc930095581948bf42125d876302c2', '614792980edcbcddf4b0d759015cd0d76bf2c671167028fd7965b5fbdeb8f67065665a382f6f5a45', 0, '2019-10-11 07:24:15'),
('b52cf675b2118b12a8f2756b1611571f01727f306554b909b2866716b5fd79682784b6904e757ee1', '0651cfc86fcbb800eb5bf56591defc92719b6128e2dfefbc8d88fe8d6a42e38976e0dbcec6b937c4', 0, '2019-05-16 07:35:29'),
('b59eb39861e632fd5d3f49cd3eaa70a1b5762144deab0643cc39acff988c5a9b20a6d81777bc3452', 'b0bb23b93e5a383d5b1114db2b94656975282c2bf5fa24c771d689b5ee3d7f95a32b07ddc7b8a6f7', 0, '2019-12-25 21:08:57'),
('b5a50f99b82ca21927d310da36daad01b00a4b8a6867b95d8b26e85dda97e6878d55d4b0989ffa0f', 'cf6f4cac5d079631bcf45417d8e5841e484addacf658d50f7417d77c65ee03cf7f29238af7a310be', 0, '2019-05-17 12:27:27'),
('b5c92a02e95beca0489c3a05a63e0ebcfd7fe38e1c261265dc759e6c352d3270de4a45080029f3b7', '44be4c264c61f6119d55e22da3a80d0b6f7a8481ab0a0ee015258d738cc4b2c4452ca4bf04ab7db8', 0, '2019-03-22 12:13:13'),
('b5cf6aa5416863b214dce4d4595c0fd9bdfef4d4370546f4645e6623376c203628755f8efcc0e8bf', 'da69125dbf1da1d607ee753f6d3b802cfd96e0868b1fe6f6289452d164144da6383e5a59bec8d533', 0, '2019-05-04 10:19:11'),
('b5d37881437a1ffd8a83e3f830952ef22102e25a514302a7c4b5b3d733c46c70d1a0184db293e830', '92aad75aea5dc2953a9c5498962dfc3126eef924209d1a9454f31a1ecb166269262d052d02723513', 0, '2019-05-14 10:53:19'),
('b5f33e68993f1c8e087e49c06a084a36a460582ea1d51bff0d2f8c4ebc6a2c556fc33f8e96335f75', '6627441c793888dfff8bc8d035befeaa6d599bd92a8922363cfb7ee21ed9dbff9ee764a8f7766707', 0, '2019-02-06 09:37:20'),
('b5fa273d870d12711e97cf95dd1b80abc2bf8e9593248eaa361b5dc81a36589c185f1967b4fb5980', '0e4dac2b829ed41ef5b9918ece8be0254213ac09638f27bb103e4109bf4340d71e40b0901574674a', 0, '2020-02-12 04:11:11'),
('b61e88435d4ba1e452623f2f209215302d16ec93518dee8877931615c2588424406d2d1d75eafa1c', '4f6047a4bbf6644111a22db0eb912ea982ef5f40ca741bb7da64556e0cabeb81abc6c57dbd7e0f2d', 0, '2019-03-27 10:44:31'),
('b6253c84fdc7a7d268f7876216a9d9de39601f495f36d1d2d1a452ec6134421284294fbf91c81a87', '02a0423b2847b6fc58b1169f8b9d9a5733627de2d127430f2e59b0de6ad6c3c54c0761e7c49fa869', 0, '2019-04-27 10:12:15'),
('b666f6cd0239996424ee1e101ab086c5f085bed54a83bce0c474c0c6dd270f23b73a59ef6690921a', '38b302daaecdb710c36d976508ab4964a08a77b31e5e84df18c345e02762547dcbbf0956dc16399a', 0, '2019-04-17 13:52:51'),
('b6898b818b573e54d5ba9ad10825af562460d766e2a1b797b6b9c15e24ee39d098830109f927746b', '369587a3bdd6fd7b8a949772a24f71aee527e019cbb0e1c9a4b62661919507c6b192317c10c3ed45', 0, '2020-02-14 02:11:08'),
('b77ae923496d52b0dba3182694b9b7c7dc66d49061d5ecd8db9c7ad98cfe50216ea6bad81169e6b8', '38689c55b7f11a5400392df0205865cf8f35b01b4114e6159559e038ea2ed6c489d2d10bb37cd294', 0, '2020-02-05 01:37:20'),
('b77d627729c9adbc08cfe78b48cf3427c6fde26e810eaba50370e21bc1a7e27feaa78ea01a70de73', '964af9d3f15dfa92d5b7785faccaeba878f088676d5d42011e368aea811ad24f13b1a7319151120f', 0, '2019-02-08 06:33:50'),
('b78c380ee743c753a3be5dacedfffa36cc30eb1a1dee2d1ac21a3df7ade827020fb3f23529e417cf', 'd54747e3ae2b5d7cf44992d2950d1761d8b8776f7dede05657fb74f720e0de93a279798416359b29', 0, '2019-02-09 12:47:29'),
('b797d496e62fd18ea1db5bf9a714a97df188476ab6dd0f8ada96a24e9b71ff7b8024f19c93797201', 'f0cd6379f57434437d1b00892acb8585f74bae593deda9c08dd91e4145cbc6ad59a9d3c17e6766ef', 0, '2020-06-03 12:02:08'),
('b79d4212361e7a73addc5c9470cefffc135f2396a8605ec580b4168239b6b47d7a784f37cac8c0a2', 'fe5290ed68d6cb66e87271bfc953f5bc832c968a75cd9725897d19d8206a1cb3cc8a84b6e6a2327a', 0, '2019-03-14 07:19:28'),
('b7bdf7ff8d382567e301293aef447d7aacda6694c340c6293d59fb7b1ce7d9e061ba97aaa3dfa886', '40a28a84a52718f03d297618530a012380a1c4f70fbe75ed8a8b9b5efa0197a3da363b8187ada8b7', 0, '2019-02-13 04:42:13'),
('b840dbbc3c28a3da3f263613d7e1da3674ad4f0de12dfff59a801e11241cc5a039fd1a86c7ca43f0', '64fd88d11ab4dd19a9e20097e09a0278e4e4dbd1415f110d41c4e3cd3b1a983805eb4019e4451ee2', 0, '2019-04-17 14:16:20'),
('b8622ccd89b17a21e8e6a03be0958d3e2fef3b325c4b7ebac161fef0b7bd1fe8799d41d01b159467', 'cda94061e015351f4c501125a4f655d263ab1e5c473123bd428b594b24e698e48c799adf52c421df', 0, '2019-05-21 06:12:26'),
('b8b20513511c570549bd225e209b055558b06b82929611306b07504acb7b87f014f1a11789b84fed', 'd08ccfd52d1479c5d3f0183d131e4b821dad0678cfa7bdf6c3e996e860f396d78da5242dbaf50274', 0, '2019-05-18 06:02:02'),
('b8c03bcb9fd1aa1e022fc539be9a841ff3c9ea83d535d033c31f135bebf85edb8a8b66a995c0f1f0', '283d640812958da7f7ddb54a984fe67519b528a9b36ea82ef9a91754440e1072c8a331f8bc18d566', 0, '2019-02-08 09:39:28'),
('b8c15507d981c61c05838da4be1b8fa88fc16e5ef6ced134a94c1f83fa84122c147d12d5829b2b47', 'd6e4d7780581c6ea4c485a9f59ab55e2f1b482225765a139e5f2b08d38a43eb0a3e3afdd0ba59087', 0, '2019-11-28 11:12:49'),
('b8ebca27b837ec6fb663329f8abe261292ba33061cf2193b5e3dadcb1bc3c6cc6f643b183d34739d', '1fe0395e90e4d95e3712930558d6f4cf0be11748df0be10b3a5f50749e1c0b8c6c8c052b415dac0d', 0, '2019-02-12 12:41:08'),
('b90a5532680a54bacbc4ef867dbfa73355d643f378de968886a3dd21e3c237495681d02014f48e32', '4274e93e8e0b4aece5cdb059e8c83be101128fb9ad23915133e79f5322015a125fb160fb8530f798', 0, '2019-10-02 07:55:10'),
('b9675c6a4801b515830922d2a4005a6c94cf9566a0bef598e50a3ed791c9eeda4f98e7efe93633a8', '46cdd67f551dda37f5f9533f5c39cdd497d9760f1113b74791420f507b49b11c583d094b9241ef7e', 0, '2020-05-17 10:45:06'),
('b96df9491bce2bca4eb272d7345280068b9b588bee6ad82090aa918f2c2aa7c85b448a963d54da8a', '05893bd1689f3076bb5916a8df9dc644562c604e97f60172e893c40f571173bc8663970b7b372847', 0, '2019-02-14 13:02:56'),
('b98bfad178d24e7f8f9e225bfd26190760ee85eb4b4a7ca583dc2ffb0240bd3bc7731e8af0157ea8', 'd2ac5c4208bdcb00a6d3711e4c6ebc86f4c906bb1fa35acb66a0a3afc47cb7624d54a2100ab4367c', 0, '2019-10-03 03:57:16'),
('b990ddfa584fa25ce61ff1ce7aeee4b76d72036a94d6ec25fe268c6978b9f9dd335e2c70aa58b92b', '4ec2773c212001ac22cea14dd43de4379566d18abebc5168db475c33b907e509e5e7a2709023858c', 0, '2019-05-17 14:13:47'),
('b9dfbec5e1857b190f6322589fa78c824f642fe95cac0ed60c024e87eadfa905b510687ec5d5aa1a', '2b5899128f3715586f67e698b5019130492327798bcaad315dca4defaaabf66b217f5e2be43e2b42', 0, '2019-03-20 08:39:26'),
('b9e3457dac086bf34f88f97fc4870fbcd46c02cd8559072802f8d0976cc855588c5e506484554588', '45c02d4c5ec813a00f1be6120c9014776ab8d37b238999cc6e4ce246f9a31c1daf7aee885eee93c6', 0, '2020-02-12 08:35:44'),
('ba429162ed19dfe9955d092fb4d2b02d9894ccb1daf3fa5daa0e801bdc93caeb3985900f76e5394f', '880b5601977092ce22b548debe599949336ce20cadec08942935d3eb75bd126e650011ce4abb1229', 0, '2019-03-28 13:52:39'),
('ba5b706d9fc431d25ed85c71f8ecfd90f9df416f496e575d2810a4d80e873a41537ec1af32887d77', 'c78081a550d9df1df9fceef0e8ce0740d2f73081f7e0d6c071a326f14d4753e508e078ca4a856fcb', 0, '2019-10-02 09:06:06'),
('ba5d1f136095787f9e2e9047c8ca6f04479381f3d27b498158c4503357ef046c1cdd3816fd4e09df', 'e60d9676305ad219ba39657ac52b939a0fc72770e23db340c5c127b03077ac2c42c1117e9d01098c', 0, '2019-02-06 13:00:54'),
('ba7a4c27d507244450564e01b4c452eb711a5a4a849f95218874c966de612d2ddb96b5777d519192', '6ccc3d0cf1b32c34f0a76f8a8d685268f8b14170ab7ed05a9aedd53279de9b28127671bb8ec2f3e6', 0, '2020-02-13 04:34:17'),
('ba9e6fbf7482948aa9eececa0053ee2caa7c99e5b6670767a78c74f4c86d0bc7a941b506b2f6b116', 'dee2e6f95032ba7ebaf18c357e81aa789588a099f3f463161693cafb215cbc14fed24bfe8dd6b24c', 0, '2019-03-30 08:12:52'),
('bab6decf3d802aa55af506372513fc7ccdb9ae6970586bc48c7a1722cdf30ab542b924166ea228b8', '366132a301ab942cbc526dc522ba2375b9623c31e8812aa0654c8bce42251a4f46b299bddaf41ed9', 0, '2019-02-06 09:31:34'),
('bad05ca19b58c3c28bc66710c1cd6f5c75d43cbbca4ac04db5cbf85114e81d91c0b06f88efd6d13d', '3bf9d58a4ed8e3f190c844a7a0797795c6611bf9eb975e4b2df626c4cc95adea424aa194147163e0', 0, '2019-02-06 14:30:23'),
('bae978fa72f1623778b7625938748a580eb740eb0a85824960e3a788c51e2af7b2426d4c6e014753', 'df6297ea34a1d691ebdf116a6587661f70bd41c03224ad46cfd7c3619a8613039141a5aa4be9c81d', 0, '2019-03-23 11:55:12'),
('bb38842f1b2f8dbbef8ab1ee8645a21d1342b4aa184a51dc3c46f7dbab6c08af880aa17d75377025', '315faf2b134e511cc1249ab3987995219e4e415756ab9653c4b7b4f807c9e57c34069b56cca77fc9', 0, '2020-02-14 02:32:14'),
('bb67f04cb38b17fc850bcb80f5bcf97217be820957be090efd7024cd7dd934ef9e2f6f4a51e1d92f', 'ebc7525353bcda6d022127691f5a941015a261150999941ac5875556a69a847705ef42e7c538b977', 0, '2020-07-24 11:52:12'),
('bb8bf881c71283c76b20d7dfb8ade402197cd5bf48879fbc4de88b46037664f98cb030f796b06a10', '2858ca7a6d59521b2d3fc7ec21ebacad96e6bf8b23015bfc6813ae6530a8b36516d8c9a4a5b9c270', 0, '2019-10-13 02:55:17'),
('bbb53e55d94b21c1df22b4fb12939cbc0be3aa827b64c423523e33d2c9a6340fc2e42b501a1e4ecb', 'b54c5dc45083daf292ccec672ba4f0a0b2e4f399f08aa871bdeb2485501375ce49cf272dda414cf7', 0, '2019-02-14 12:46:10'),
('bc1bac2f7d3c4af0d8732940cc0e2dbb968a02ae31f530ca5fb091cbc0d9a3b279bf03e42e310d40', 'e129434e7c9beb30c9b2ce1beaffb3a04172edabafa4e42865f03492d33722d4e12b7751c7533fd0', 0, '2020-07-22 08:43:23'),
('bc228391d222e868ba5268ee892e145a8413c33cf49409114b60a2b74ea87d15fc6f8eb510db3570', 'e435d34ed72957df5a0a90dc00088d26d5e21b46a32b5a4efea7bdb94435b616709f1d6ab4261ff3', 0, '2019-12-15 13:30:06'),
('bc288ca8f551366430b8e003880dadc2f3c725f06b8a945506e9a5b37b347627464cd7f3a2da51e1', '24b31275adca8afbe11f1fd4a062d25e22efe141ce6124977a59bdbcd7c4eb9354eca89eae0455d6', 0, '2019-05-14 09:49:12'),
('bc3762b9674814070c1bc06bf48d4abfc2d46ea88cc025b60062b975ada7ec61403404e93901245b', '337ee16ce96a2069ae7fe7082a5c8b0ecfb50060b499f7214c6dbf66edfe6c002208f6d3d1382dda', 0, '2019-10-31 03:40:45'),
('bcba888a0727497ed294fa7604a4d297d24009115ac1068d5f5840f336ccea8250f5e516e2244330', '7fde63abeedfadeac9f1c5fd05ab6768fe6c77aa913adee40bd662f70004fa876175ffb683750b7b', 0, '2019-05-04 12:03:05'),
('bcec8b55335aa6aa8168cc9ac00e3ab8ba409bc5ba6d79024c7e4914aa7395b65d2a3d773243670a', '51588898d9ba557a316051ac96b019d80907314405b0126d763016e228bc474c87f67700fdf70a97', 0, '2019-02-08 06:35:17'),
('bcecfeaaee07f1b4279bc8bcdb35ef98431fed6614dfbd37a09e49debae06e4701da07a0879eb61c', '574bebb0538186bbdffed8162e4526d87285547d29df4d6fbfabca5d5e66c36be76d603c4e7325f0', 0, '2019-02-06 10:46:42'),
('bd199c2785bdbb9ae9000f53882184c139c98285a168d6c777ce7de0c4c9bc9612fdb78ab86608fc', 'fefedde1819e965c30de8c31bf60b6205e5e865fd81fbc732dbd416509eb249ddf9bc68522a11db7', 0, '2019-10-25 01:05:16'),
('bd3caa6e71fb70d59a059941837819d40612c07901c87db64b322512ada30a2bb039b2d1bbc8b31d', '0f8b6e92abc320e2c7e3159b39ea1e7cbc99eeb6f515c22fb6ee8f7fd1ddadf536d480ee4b089cbd', 0, '2019-10-03 05:17:58'),
('bd3daea48061c95d150857f038ffbff3e374f5abd3960ece32536d1830023c4880aac34d004359cf', '972d243f1686355e94395f81ef5c9621a6259b6fb9fac5e78b16d7eb5d41076d698be54a09a710db', 0, '2019-07-20 03:09:33'),
('bd5b10a45cf88876c840dc498a41841a27d928c0406051ddc247461a5b03ef955bd11b9bec2eecf8', 'b898932c3811e2960cbc523480b7de8e41c05c99347abd4982507cf5abb7b54edaafcd24c25feada', 0, '2019-05-21 13:37:00'),
('bd6ad674b7b9f7fcb599917ba796e22eb8317526b03404beade404f05789ba3e61b7c0bb9483918a', '26122eb84f21fbda68c6b482e8dd8353203ad46f769a903adcfb282bb2c5cdd37a338414a3b2ef8f', 0, '2020-05-15 11:42:24'),
('bd8a2e761932184e5f51d2f85109a0b7bb718c0706b1f971a9d6d8012367e4c45f34ff75ebf3eb6a', '55bf7315e4a868c2fbc67ccf1bed18c7005b5fd3aef5ac380723b6f00937d544da673a26dcc57d7a', 0, '2019-10-05 11:11:00'),
('bd900c980b1920d4faa4051bc5058c92c382164f9611dfe6ab7b10e29dadab2a225c0efc7bf7310a', '2a3b59359e3c339bb44da850d02a305e1dbdbfe44b62cdca90fa3020400700b6b37e6d2d39927b77', 0, '2020-03-13 00:03:26'),
('be2f2f0d65cf3cd190f91c25589449794e9c2bf553e58791defced80e08e7b7acafb7c622f4910f6', 'd9c07e419bce9e4f1feb193b9bcc15326c5f4c1172d679c5e8290694fcf12e6b7816b11f405c1695', 0, '2019-10-02 06:58:37'),
('be8d7ad448d1bccb3b58ac16f44e6f00edac457a03ea00310db2ab9058a0964186f200658bcbb0b5', '51df1949b7eb3bf2b6c058a6aa9b7d936888209cabee80147b439c208f381091b264e4b3d5f7cbb4', 0, '2019-05-01 05:19:31'),
('bf15e56916b0ced5f7b101030c6863236504030aff1c977347f318daf595e4159eb34c5d7fe08c7e', '9c12311fc7e8609b6d62096e1b9e6b55553b4426b8865371648e34139345d4e4d5d8fe6c9aa3b8e3', 0, '2019-05-09 06:29:28'),
('bf30ee2d9a6ef5591e63cdc3efdb5b6824422db38a3b8905c6b46e50c2b44aa33b09f78e1faac5a6', '93053272d32cf3544f7b6e7e20558b1a53b91a21af241c346ac0eeac07f518e2d4f19221fce87842', 0, '2019-10-10 04:30:24'),
('bf3960630086659cb0eee1452137f3cc8d9a8aa1d3c7ad9934404fa6964db83c2be3f8d61af1fb5a', '2d627a964ff8cc17f4d83e1d18b0d1ba1ac88b9100059d63d1389327cfd854e2ecacf6679433b0d5', 0, '2019-07-26 16:30:52'),
('bf3b92eda56641a7cfbe3b4eb2b946d01cc93b131f7333b7a99e2204d4524d9677d102f3bd56508e', 'e2e8467cc2efc1bef2f20a24741ac4db1254dc5d7abc9b725f8eb0e2630ef06354cff47d07490e01', 0, '2019-05-08 07:53:36'),
('bf67c32ba662681599c7e50575369ec1986e131f9c520b455689dfbb2749b6addaf80214f853bd79', '1b115845dc1b8d1004cd34a0e9263a94b96486216a5d4b5f448fc5ca4582aeae651ddfab9253b49d', 0, '2019-07-23 08:45:27'),
('bf7bd9288e949957ce9d2b0f432403bf3fb22cd764f73702bbab1c7ec6c1cf142f43715b81cf88e6', '018cfb2b4f4da70f9ae3dd72cd37e12da097bfcb29b39bacd0de38e6c875d95e414e9bc06487287b', 0, '2019-04-05 11:59:26'),
('bff6f4601ce9f228e435edfeea7304896122358992f6b0530b75d89d928f0e532a4764ca4309b75c', '0604bb3b3832cf3aa9cd5a55f858e7a87f07c2d6712d89ab70da8b3b2c9a3cf873a006d074c00301', 0, '2019-10-03 06:57:39'),
('c01fac4f684b4e30396d98bcabc108891d4de8bbc2a34feb4ff62ecae90a2cf09f118f41ddb29435', '8eec42c0b652ac9f69eba7e8c4b89a8678a5ccc2a8fbadc501df5a1c8a94dbe5d481cff69f7d86ba', 0, '2019-07-27 09:33:57'),
('c058871683187994b346e88bec4bfaba831eaa1e3ae949007c9c9b22fff18c9782a12d843d9c3277', '8abb95e61b25a674670129c9384805125f80e6dbcbec9736854e677f78a97245e924130cf65c201a', 0, '2019-02-08 11:48:20'),
('c07fb750142ba009c2bf3b063ae646032f2d0c7498105c66c9296b737cab4fe6e5ecdd736b352f9a', 'f93e953f4c52b90afdc62967d949a18c320fba047b10c2235af56bc8e50ec69e0e45c1c46a9c2fe3', 0, '2019-05-19 16:00:52'),
('c0945c6197d41ab89dec629e48e4fd96718ae6bd1f2dd0faa2d88acdea334110a062655332f0ea8e', '368e89faa753e4e560fc2fd56856bcc9af9c27859b9f44d83b5a45dfe827a4ecf26ca40558b9d049', 0, '2019-10-18 21:24:56'),
('c0aacb0bc83c27b240c8d3fc2dbedb101050a3582e3833bae2178ab03249cff548df4405062d65b3', '8fe14a12079b19f21adc7eddddfd60801760e39d91f9c9a530daea8adfe326fa083dfad4d41ae4da', 0, '2020-05-15 12:49:43'),
('c0edf03e47777488150bc05f8c7ffdc373af4350f5b7a5c5f4302339be746c28a595bc4b812028d5', '8a22ebb4dca2412762b8bba37988fed04860dbbfc94db7c9c31a4990a91bbd34180e8961f3d7f855', 0, '2019-03-27 14:13:58'),
('c0f42e981d1fa23a7aae1e4dee2d2f2b7f50304d10561cd22395086264e2cce8c7b4d6f05d413eae', '85fd533d2b34004e71725b9fed276271f09228863a3ece40b7ad56f30dfde66b8a82080890675b59', 0, '2019-02-12 03:35:22'),
('c1bfc6f1acec3053fdba306a1390ad73d8bd39b2a755e3a8154756af3b1560b6435eaaf173832e2b', 'd98355e6535a517e1fe8373ee0f30fde88a13df2cc3625c288c8028a47f2a2e675d24f4f2ee6f180', 0, '2020-05-28 00:59:15'),
('c1d558ead4f4903bbb97d65a9d682f9a8e4da1011a0317c2a3cd11ed9e5aeed05e72bf9e3125efd3', 'ab9f9d39aefeeeed28ed57c645a13a6ae5b7cae6c3ceabbad8a2a5786c8747e340ba3d8a6636b6bb', 0, '2019-10-04 08:28:53'),
('c1e774cf6b2199f4f926f0524ad2532193ad3de919a4ed42942e23aa4612664834cf7322971c5b7a', '8cf44e5f4ab196429b2caa096e27406452f796e4c3f9394a3751df4d0adc9ffa8f71c83ed43cb953', 0, '2020-05-15 12:48:54'),
('c20f2e6b7dc83b03fafaea3d160d01d39fb108e644dd14c8ee577be66c546218ad00be8ed85fd13c', '489e43528493d880cd5f392182746829b68105c5aeab86652a6e071de20bfe0ec3472da5ebc7e819', 0, '2019-02-06 11:20:46'),
('c210c71eede6cf18405a94bf0d87e4067ba679d47ddad12aefc8e6c3afc096755e934a9d414b8dbc', 'a69482719ad84510b847c33fb0f2a5db5efc58f0f5a4768901077c59343efbccdc6a5efb95c57b26', 0, '2019-10-11 04:17:56'),
('c23f56c7ab949e7d539d777134fbb2e2ea7de9caeee1dde972c26bbb9faf4dfd68eff86d62cdef92', '870ccf2a283bf30e4f9cd43548ec2ed10e7b0f68ba9242e58e4b3d24ac185e0d16788d88d56c82b0', 0, '2019-07-20 03:06:34'),
('c240364f4ff182e81270f9234d038ef8ab521e65b2dadf988627d08bc5c25a548228cfe98ebaf37d', '3d1e91600ac65c79648850dd9bdfc18187c6030e61e2c1818885339b2e41f0c94cf0536342be43cb', 0, '2019-07-27 10:31:46'),
('c2473e39b02bf44ba10d4e2ef59bd4071a367a494a834ee4eeba7f1fe99bd358bb7130abb5457fce', '6687ee5ce6135fd01ce00b07c28ad828db2fbc9bf81524281f5db20f7b7a47e9746b9dcc9566bbf5', 0, '2020-02-05 00:46:01'),
('c25528fb0acd2bc19360db5ff19d736d5492acc0cc42a7a76ddb17b0c776ae5dff0e4d4e43e37a8e', 'ba8c50fb1e6834a8724625b2d466397340b70146fedbf324f491b6abe9f85d3d5910e30269e25233', 0, '2019-02-09 15:33:41'),
('c27455189d28f5870ba6f17ee637dc2967d5de9a56e3a62b04473b1b204d467cb87b47fb6d26a8d2', 'add18eee46921c73825add9427280c0795b71d0dbc84608fec308e0fd9b07d54c6e928e146000ac5', 0, '2019-03-28 13:45:09'),
('c274a8d276082d0d7fe272882355bc34e83b6546ace5ce1ec8551d355a127852137cac49ba3f2e29', '80a3a5cde7096bdb8153500e8f018f9d22985a420bbb390f60aa96d0562ed16ee1bf2b4dd8f90c2e', 0, '2019-05-14 10:06:15'),
('c2909d34d3f0ab2d0f99fdbc586c2eb13f7b438ad0b44a1a9caa0dfe302a199d74450bcdfb772525', '016880f26f1a0c9a311faa991f319e2ed28df9f45327343456ad4a108e43f5a74e124f6638b935a0', 0, '2020-02-11 00:46:39'),
('c29d6e94ca458c47cf7e7ef030c3c2316ab3cb75a3b530755821e695cf50e61e8d9e1028e2c6cd1b', 'c332fb9225779727d6827829988885ab2209bd6f5f553dede2bc5b51047464115274b47f29f5998a', 0, '2019-10-08 09:52:58'),
('c2ae285fc2c403f250a3918d3cdd0651ed68b032b38f8691153399cd754846a64757dee9a926a0cd', '1ded03cfdca184dcbe60d1bdacaf8a015018c57db9cb878ba410b0fbce6e43e12d1918904379a0b9', 0, '2019-02-08 07:17:10'),
('c2af7de588a0569b922c3f21413d44f5005e323a4687a88458ebb1b3fd44fcb0cfdb0ab75a54fa6b', 'b5b2567889a0928acc0c345040400977c0404cafa2f48fd11b85c09a62e47897eb8b259a0f0044e8', 0, '2019-11-12 03:55:54'),
('c2d6f8b713d45dc6ece7b65e2a18cbb8f9cb1d3538aa5c0175d2ca1b0da262c683b8a3bc6c8643f9', '730f55eed84e9b7d5b9f55978c3bfe164246d9d2aa01d6e09638fb2a140dfac93e3c4a7edc987ad4', 0, '2019-05-21 08:20:47'),
('c2f2ee69fbec86c3a42373fc283cf15394cbd128fd5e0e31ec0e38a1eb057d83a0e3db2630620542', '7ec73b2d5c11d2650c8b968539325736f4320c1ad37bea19cd38d6ec9990f45e93eae353affb65a6', 0, '2019-02-26 13:13:36'),
('c36a42ece7c7bb62337194bdffbca2ea4a64ae3d859fd15f3b28d6e0839ea2603e46e30fc4dc3621', '12fb8bbed6cbf4bf19af7287fabf36195e905a53142cf0dd68cb04ddb0a380cc70faa0eb18d23df2', 0, '2020-02-12 07:43:02'),
('c394cdad58f536bc2011d2f8038b708afbaba86a33b7e8f8afff05bac733b702f94254b4d98cd21c', 'f3a4b8b2caa4a90d37c51b6887f478743f278ace1de6839402ea8bf2f4579a5201c2ab09a9b89b64', 0, '2019-10-05 11:11:25'),
('c3a2a05ab12ef34970f27cab07d0f30670a5c8883cacf18d9e9ae79ed0fac5a5dacfa991128eb6bc', '65bcaa21e0ff182e57ce6cef47360329451ecce3000bd6717b7d0927197795b44d198c33727c2791', 0, '2020-03-21 02:43:09'),
('c3b5d8b99e5e5367ef001fd9e1f4bcb877ff94f31c22ce1dbd1dc4de8fe5ebc9a0af3b359c8f8ed8', '80efddbfa027cd036dedfebe800599c4575d0f41dde3213fc0d32fc0a0a696ce9239ae88d8c14b22', 0, '2019-04-04 09:38:34'),
('c3c7237adbe49049d24f304d7d080e71410890c4f9d6b6c3aa5526ec6f8b194aae6534c383b7c613', '94444e60469b378be6146ecc5c0af5fa95abe321bb619b941c27c1458a3ae28cb204290e90be5fae', 0, '2020-02-12 05:57:46'),
('c3cb1b0eaf4be82e7ad13590f738b8f75c24c3d95a84aeea700bfa9c95a198c6cd6e8b3bb66f80c0', 'dcdc97a2221d23d57a00804438fe80823c81e02db577a7cbbecd9536f0415c93c8f24e184be835bc', 0, '2019-07-24 08:18:27'),
('c40c5a7628f8379cd8fb4e88efb807e2b0f12bec0fc6b51dd99ada97c81697a0590b68d08a467c57', '8d85e75320cadc0805fb5771f441b8982b27874eef899f546d50b2c49bb1c5b5f37e2cd78bd110e5', 0, '2020-02-14 00:00:35'),
('c4260098abe59238d791cf96b195725e49884f3aa41cb0e4222f262d207cf5ad9a9c21697e162325', 'de5622d0b9b88d904961d8fd9e7a03804c3fcc54f7b77071f03d69cd06bbb8f87fd03055552c89cb', 0, '2020-02-12 00:27:25'),
('c434c60048beb1d2ab6d1d9ff3d6fc7cc9c5bcb93dbbb275d231601797ce12d8c5b978796d578d21', '78a848949e3d398b9f983076d44f2f197c9953cb9c3b6309e88880275e2a050a86a548b304fe1a42', 0, '2019-05-14 08:05:01'),
('c477c78432cdad073215fbe3187c9b0fc8329306e004fc80512e86d1e03fb933419320182965f151', 'cc89c2e19dc11d4e9a682bcbbef28bf87b8bdd4f8611a8250908b8398cf12c22b1e39ce64da7d6c5', 0, '2020-04-24 05:12:03'),
('c48dc303bc2896b7103db4ba540968ba1f45a63783c6cde539f8e8be82de9d6422bedf6b80915a03', 'cc61065a180fb0caa4bccc9a1889204f39915b5cc430a28c57895260c9257c190700601424edb49d', 0, '2019-03-21 07:06:47'),
('c4aeec9fbf1e244651f50ecbe05520158a9851571d5b468fb2afe25bb11b2532b853c7c131070b37', 'a9304c669c785b17282be9526207b3f8fc08cc9ac22b89eb279ca83d8c7e88a09be09957866162ea', 0, '2019-10-09 18:36:06'),
('c4f00194f4035848498cab8211ec06b609ba7a77114f8af9c15f086330f6bb2535d96f16405cac20', '5c350a7284edbbca9736f0d6db3f321a72030ba59f467b5fc1659b2d872c3a0d3ede08eacd08ec10', 0, '2019-10-18 21:23:02'),
('c502973ebe5abeefb9245f53834036c30fbae571b254fa4bf2791f322688c456ff4202c73bf346a2', '98036cf7b8f42edd305d10f20854be03d340b9dc4bc32d47e42402873fc7d3256a77ef1660a68fc2', 0, '2019-04-27 10:15:15'),
('c50ef2ef591183a9413ab81228cbbbf3e79ba46a898730b8bd3a526ae9d1095f9e15ea3d27267125', '3d0192d0af6f8ee3aca2ba0089a04a01277141ae4250c8c6e1c960212c8ac3ee67d9cbec2273eea4', 0, '2019-05-31 07:23:34'),
('c52988ee9478207f1bd3f6cd2f4c8d74f9663e3a7cdcb22fb2efb3d391a02b97576ef89199b76a42', '40205dfe382fa15bd6bf7b98df6ba892ea9a532490c9dbfa26702d5c07977ee1fdc49b4d40c54241', 0, '2019-05-31 12:37:31'),
('c5584a0c2633b4b978af33a9cc941cd751bc0ae89b4168ce2639322e3b3cbf2926db7f96fd730ac1', '83f5da6f47e3a64a1e6a63e4becd9426baf704bd5535e39c77e0fe3f71e7ca7efe6a471811dd895d', 0, '2020-07-08 11:50:13'),
('c559b834277eaafa1950240923759343ad4d9959a4981491113fe74a44a8e1ebca7dd865e48f01b9', 'a0e113ec20485f7d943332ee8819053010b038df4ba91a026dc9ea1a97e7fcd061ae8949fd236b11', 0, '2019-03-22 10:25:34'),
('c57d663cd09c5f85df2a082813c4a10802ede5145e6465b3aa1d88060cf427aab03f1ccc82576a81', 'd6a0e790e41929ed13b7e00a6d668f173303f7d82829d7518bf22a84d00c33ce496a63acbdd643c3', 0, '2019-04-15 06:20:03'),
('c57de94d076f13dbfe1ad463b3084b5266a0b787632453dbbfd756a149262627e804f626fdb414f7', 'ecce3c37eb872399e300c9b22fb694e9057f4d702066c8017326705121436ff8b8c1dce924b90b22', 0, '2019-10-11 06:39:48'),
('c58ed040ddb7ca9aaeadd4a7aee154faa937bba25a68dfd9a3bcf34752deef6c413aaea0616d96b7', '3d08362528cfb2307d79c94f380ca741f780567a096325e81e908737e10a1e714de4f6cd33479d5a', 0, '2019-02-06 11:33:43'),
('c5d2c0c8d1a12df18afc428978203b6e39aabc98bf4156685154ff0d7d938dae9bc87b3c7ea5e69e', '69f247b259c5b5a646561c59006bfdb38e4d05b0110608e45f38e2f9cc0ca7deda6064c9733b4a91', 0, '2019-03-22 09:25:20'),
('c5dc6090cd85a00461f0add49c74175e8df7dc3b979a55f4ea934a42910a7d5869095f0577ce2da7', '6f8f463b9f074614c75efd60ff240e5bc593849689ebde81b2968caa248f2927cc553ea7f5dbb93d', 0, '2019-05-17 12:46:09'),
('c5df30cbbca99817a11c8e78b8a29e5097626dcc14b9e80f6256418102c6a4aed35e67f2c49a8d6d', 'ea4ca6f0bbcac7edea819367a2decfc81c65345505fb3640c3a5e8fdeea85f83c1e5ba5ee3376656', 0, '2019-07-23 08:37:11'),
('c5e69228eb1f95c9cdd6ca96dabd039a339af59fde99381e57cbd79101f090dff6611122aceac2a6', '66ebda5b19bc4f362a0f0bf3eadc2aba4ab096f8a41db9ae50d152a470029fe439ee43c7ef1577c8', 0, '2019-03-22 10:03:13'),
('c608bbedea7d435c6a346800742175a199265ab75d14f3dabad64559e124aa6374d3e05f931cb92b', '1ce809c7c78b3773ce92bceb07313bde8929051b82909c6f5f1364a61aeeed4c2cf15b60ee32f752', 0, '2019-05-04 08:35:37'),
('c608d51e77c7616dcd770d200abd2d216c193086de7d1318545455169d84540cebc2dbc6b5428983', 'cd3cdb869828c00f3540ca90c19f6a9c7f5ce9078711ae848eb7771555f1ab604bddb68559beb8cf', 0, '2019-04-05 05:59:49'),
('c694c0e51212f7dfefc7bcb2eea40c05ced2dab98fe0c9f3e43ec085fa4735e073a9ea0470bae7e2', '858ff232a9961ec1772a670d8d09857365979d908f4d65eaebd0e7045447c3f8ec5f899dd8e3fa36', 0, '2019-10-17 22:48:10'),
('c6a77307efb8b33f394dfa8fe6233b96898541add0b786ffbcf692929ba9cf85e223984c72c1a119', 'aafc829888db7b3118a599d07039e075b8887dea64b8cfaaf96e79b3073886f3743c97a925236963', 0, '2019-03-28 07:08:52'),
('c6d0c4e20be80c9055a5d4fe7262e2ee75cc23eeb31cd7f7ba18a844e39b8cd9c678c9b5458ba314', 'faf320856ccc8cf420a99c4fc82bbd0b3dc922728af1f224f6acb5b5fe2023b1b429f09691bba779', 0, '2020-02-14 06:42:10'),
('c6d0ef0034d3472023f2999ca5b15aeaf150350b40ed6b4f24f5dfdb1b3d745431c3dc7099726fb1', '9f3057b0a5054799a73e3b2992f83e25297c1dc457dc0517103effc805f0b43b8326a22d25247430', 0, '2019-10-18 14:50:30'),
('c71e62f8324fc301365478478937c55ea87c017f4dea4c039e6b73c00477346ae171f151b20e2e93', 'd6c32651a84d86816c5a126bb4a4d292680abd805d54ebd50e0872f48d6fb09d0ebabebfd81e62e9', 0, '2019-07-23 07:59:52'),
('c75243a8c1bae5c7b2591ea5e13338515cc29a8ed7bc618b3e22b395eb5b0517cd1932813fa40ac7', 'fbed099c87461b81f52d7809263cfdf9cf3f313506051a0c2ce413658b140f27166036c595f60e48', 0, '2019-02-07 15:49:31'),
('c76561234b0c266236ef2a075eb253684bec93deef37d3e206b6bf40424da6c80da7052de13fb27b', 'ee13fd1dbbc9b6ec763292be8d2e78132f90916ee4685e61e8aea7ff64743e27ac4f2afdcce51970', 0, '2019-02-15 13:10:58'),
('c7c28c7167d7aafc8fe7fac63f5638c317f1aa22a2c075a24e643ce8d3c253af8b48d11d8a4f155b', 'abcb61bee50a5444a87cd184506d2adb846ffb84adb8f8915c64e8f642f6caee172e7a9cd816ba3d', 0, '2019-05-18 05:57:56'),
('c82f1042db5b37dc9f68a93f5bf44da99a28302c4896c8888855703a0022013eecf1897e0ce91c9e', '85c8f1006d9cb0cfa907a0fcb9b1751369e075b6a71944a115f62bc271bf6f5e78f349baf12b6df3', 0, '2020-02-12 04:11:00'),
('c84d33e049c930bc15c552852680bd5b369c82e46020c9b972072a625da03cbd722669d95ee820f7', 'e166db5fd9cff690f16f0a83e8fcedb8e841c5379b958c85b370e65745e049abc9cc9b4507b6abf4', 0, '2019-05-31 07:26:30'),
('c8501d3f4f8609fcf78798f1ef789aa85a56da23cbe87b8eb29179f4771a16ad8d65d2445b192e5c', '25322c9746fea34b4f284bc49ea75f98fffc1b2d0e32d71001ef60b7c38b3d9ff085ad6eb170ad53', 0, '2019-10-17 16:52:52'),
('c8690ebd87f936e5804b04f6c58de25f6a85202f66b55ac160c856a2d5535960080d17697499295f', '3a27bc6bd495d5ea76ea7586e22b6ecb589cf1485c0fff89be3e9054bb24c4c9b8823f152eb70e6a', 0, '2019-11-28 11:25:28'),
('c86a165654c00642638c97c407e071634fd78763121e94a4d8818c8771240b4a5398011671c99e33', '57d3d44c25d97e37c2c374619f18b7d33457f3cec4ae15a5700e714fce5e830383adaaf228eca947', 0, '2020-02-13 04:31:01'),
('c8a752de6c6a41f49c07358b719b729b77dddb4a260504662d70a9ca8cf652ce69c44d3712fed40b', '44333abc6d530d0fdd4c42ee093d74ff2b2bc597f4e45cec0568cb6dbe49cfd0d887b14889af24b8', 0, '2020-04-11 05:07:06'),
('c8b662e009f56f2410a2667a53337192779de131ed627b830fd4612cfc385531369214c595951381', 'ea8c043d5c0add0fbc96772cb58c442bb4d9ed9e383903e6eafbbcf24d6c7447460e99f487260ad9', 0, '2019-04-18 15:54:38'),
('c8b70cc4897ca65405cc9c483d650fc329853c19c6ba2f3ce725aa1f8f517d7af8210446659b3aeb', '2c425e253069f6e408926e2fdc7310fd492d1e0970d4ddbe88fa9ad7e83151baaa2b91ef8a80df3c', 0, '2019-09-20 02:01:47'),
('c8baa91e03525d663e80c6b03a25ae5c82b642d7aacd958bdcb897a6fbc7cdbb0d782fd141596776', '0b2f2c1a6009cd10658459d68f25f68c4ff6295e972bbe63dfc452b7be73e9d26476496904644edd', 0, '2019-02-09 13:49:56'),
('c8e1c8eda412608103e1fa16b7a2b4def16576ecf8a32fc216680b60be1d43de7f42b1f83ab46877', '6fc4f72bafb57447ab13b66da5f397d8059a9ab88f8cf12f9a1a423481c142d7bd97c856cb45896d', 0, '2019-03-22 10:29:49'),
('c8fa5c8af4f24fd90af5d6772d217661fdecc07c092a9697f89f7daad30031bf05e455e71ebdfd0b', '50c687c3a0522a10bd5cc40486b266ff1962445c4ca0f9779409c1574ed952c438ec38f85c9ae8e7', 0, '2019-02-12 01:50:31'),
('c96d75b3b2881c10b49fccaa6bf788719dc2626829e833d3b668fc03fd6c87e22a0d600a04f93c1f', '5677740edd838c96c95c97a8a8d28417bc9a361294e75954340d7cf153df7ed1b36c89a3348d7189', 0, '2020-02-12 04:38:22'),
('c9914ae5dc7a457b97c4c6a322e90a3c14743820f33b1e11fe2f049baa90a2c9252c9be03b79fb1e', '8121b962e8ed1c5d5d8fbbc741cc55950bc14fb4e12e357fa91f0fbb22c319c2b3ed6134612171c0', 0, '2019-02-09 14:51:45'),
('c992c156ebce9c3501f93eb6b7dae8b256b5c69c8d70eba1deb2dab180f896a148a07a62160ce117', 'b4259b65da58cb79542a3d9684479f135aad88ec6def1091295a48a7ad43651205459b0989ca31ba', 0, '2019-03-29 04:26:52'),
('c9b00055e89f037b4e36c761438a44c0705a0cef584640b67ce873d9d20061ab75233486f99504bb', '179eb8029ce6bc53f11d2e4fcc7be1f773ff43ae2f0bf0e303dde2812bf489ad23d3d35c6563c7f3', 0, '2019-03-22 07:02:19'),
('c9b1588c469d6bb3864cdb0674f9d93940dc2e719da657c126f723851558feeeb4c863fc168a5f0b', 'a7516d93184ab3c6d5a6237998cb6165ff88b1a79f9e271875e76c0e571cd1af3a5b2201db3867aa', 0, '2019-03-22 10:50:01'),
('c9c211dd892af06ba41eb6132e31498c996bf5b0c3e1ff511f4e4f912b66efd0d97dbaae20abe67e', 'a799c49df541d319547ad739e4f7283f3471b93371719e54a216cd89017ea462955bcc82fa12e27f', 0, '2019-02-08 10:37:10'),
('ca1a14a23dc533d7403b98d83d6e046da4de241551d3c097db8b2ba4f1f20e28abe3ac4a9452a291', '84b0bfe25cbced6060ff3e65837470fec4bffd7f9a961a93e6929912e0734ac7859466570745d8c1', 0, '2019-11-28 11:31:51'),
('ca1a37485abd096bacc61c5ee0571eac57c3abb9c9b62b3a18ceb591bc8bf5fcdce86b60f7764d33', 'b519c9f280241e4c49c80a5a72d8d198b5ea6a9244890bdf9c2f1af56a51067c2a1d0848cb753e90', 0, '2019-02-07 08:44:58'),
('ca24d076124ca87e951107a10dfa491f6280f2659d219435836fc254deae4734d0a55fef3b7a974b', '0caf7f08a7754600620e26493a12ef094cfb0a0b091816a856a2d9881aeabd792d1741633f58d0fe', 0, '2020-03-21 02:41:52'),
('ca40bff61b8f2b405cf73102ba08b99850633a771dee557cae8130c6e33c28f0e773f7b2ab10b87f', '35c2e751cace1eda9b3477a5efe9f8e4e2dbdce9e7f85b4dc3c4411ae0282dc2b54971ac350518e5', 0, '2019-02-09 13:44:23'),
('ca84d1625866429c641f13399fa7c791f5d3d4dbbe3a045790b66c1f8d52c811767953cd53e60625', '607af4e04b5228a084a03a7aacb9727f105d4bb536273402c942155351a3210e46b58653c2dbe61a', 0, '2019-06-12 14:25:29'),
('cad0ede6d7c27bcafb0caab526145a6af2ccbb6bbf275c90e3c6c6ccf73ab682cc977d4c2d8abbb2', '33bef60f22d26d4df4cf498e2c282339b8002d4be4f6eab0118424bd1ea2705299eb8ab48685dd1c', 0, '2020-02-21 11:39:39'),
('cad770ef0a281459fd0ce86c79173122824e388cdb4c0a8e777a487deedbf42ab068b20425075c10', '704ba8c0f19ad2d62ba3cec70c84204ff3fa05ba2fc0890d9713144a304e3faeeadf2c5a5f27ac85', 0, '2019-03-15 06:48:57'),
('caf88f4ab90992196bf51367b378a3244ca4b00cce7f4cce483f46ba7ed94787a7faf28ab8764a5e', '8c7b56368c429406979e73272bc02c29eebb74d2321352beafe29d132f7a166f4650bd582098a415', 0, '2020-02-11 00:09:14'),
('cb42577779c83c58db5ec6c9394560cecb3a036f8fd479a9294bda7a38fa323831f8b93de9df938c', 'f8654fa32a236f22fb7fe61654253af1b04fe14a95d7ad99ca0c959b4cf03dadd0c58cc0d353d69f', 0, '2019-12-18 22:07:13'),
('cb77c2a9f413c111f26ebda76c08629aaef383e4a3678ffb9ed3a55c4a80220e670ab5008c443f14', '94dba5853b962151059ce9682c9a3d09a23ed56dfb8c5438c113d5e2ad21bf0b3811508f9dc255ca', 0, '2019-06-25 12:29:44'),
('cba2b4e21d8d96d33d930d3f6d5f93c045ebd0221c6b0d1585b86083ec93dc216cb5c2ef5bd34e81', '37b54950d63e5e8a687005a32bb067249e7d1ec0794fc0d8c6da63da99ecc94a06bde4e4c37dbdf0', 0, '2020-01-18 03:54:51'),
('cbb120e868a4ae7b4445925e20aaff94ec10bcb5dffe741fe7e4c7313444faf324ae74b6d740aea9', '312c07c7095ca4e92fa930a96d400faa4902591c7095a7bbaf36f1d669e6d429efb79f2900ade9b9', 0, '2019-05-14 07:33:20'),
('cbeb86130ef886f42a0090f8b1189bd660c1b834ddbe873fdafe3cfa8ac2b14829d5c9e2a83df083', '3321af729b3a2778c0489acfcd9eb524e76aa261894d629663c2a5ed70f30b0c68b5a07481d0376c', 0, '2019-04-24 06:35:46'),
('cbf39c5e74cf833c72bdba859ab40474aff19484c8d304e97a4306c4428a6ff1cf213c6368720fe5', '1e663619b0e6e92d2ef6041140f208a28695f69e053f944b68ba99f264cb9fc4fd32894e0fda7bd5', 0, '2020-01-18 03:52:30'),
('cc033094025289494cb2344cec07061e33691437174791e790201e9e2b06570dfebb27f7e9e65fac', '3b45599e062e76366bf6cb6327817e4f46a175bbad1c79e167a99f02817546fa7f79749e724ac723', 0, '2019-05-04 06:42:52'),
('cc0d28a5467cf3632a904b8ca53f4b8f5f9973fe4e95ebaa561b8ae7612b89150b8f1a9582760880', '48d9126775decf8bd2016da278db4e657ea62441d80b3355078b5afeaf0f71ea612581b7f975fc52', 0, '2019-10-04 00:52:09'),
('cc393eb782865e7858f57899ab8f5e88fe0d37eb1b75b35b0fb52e06806ba789d5d5bd17725966b3', '0609352e3968946e4286def4e18fc21f816c7991c588d7214a141bb7c6f906ebf1d1787983452b8c', 0, '2019-10-05 11:13:49'),
('cc66baab7838f357283107b766f21c152ac23cb8396ba76714f8735e9271921380fcbae901d97f5c', '7e939610c58e84d23df56b7128cbc310861813c4ffa95cf8dd41abfdbef64d3e7291546d93f33fd0', 0, '2019-05-04 08:26:56'),
('ccb526f9bde152d0fef0d7f62d4b40e51935938acce558f18acc6eeb82d71bba74663bf71b45aa3a', '32beb0db25c3541326064a326878780c99ec38e558198acac4245402f0ee85c3926d34c795a591eb', 0, '2019-02-07 05:16:05'),
('ccfc3fcc775dcd560ea4af02a5739a2984319edd4bbd88f8f272f00eef5f0d2b359cd31aa10f1c7b', '118e7947a518ad6718eade521dfa201a2cad6d33749b855dec715638be8c8e01e410aa35cb5cbce9', 0, '2019-10-12 06:06:16'),
('cd07714c3b0304d3b60b306e049b7f423fa3061f8e379bba160cb8a81e03002eb1d5dcacac6f7062', '0844be187cf55b73f8d57a3d9340aa8988ad1cc6223745679f6268f6d7ceb1643f7f698469be3213', 0, '2019-10-12 06:21:06'),
('cd1640c82ba4e3cd73dda967bff9ff3f7bddc758ee6fa43e317c8cb891573ff7cbee22b7cc78b208', '8651e21982735cb665396344ca2be89bbbfc32c41d4b58cf1a0084d4766479d231e9625f51604ec2', 0, '2019-11-06 17:04:23'),
('cd23d02f983d75d2d45fc9eb73a43eb1e6461889bb099608459bde0a08f86acf7546d891512c37da', '0816fd1dca07a573fda0f5bb1405bcbba4f7672789e477125627f685332a6e895367020f03a45cce', 0, '2019-10-30 17:21:18'),
('cd84def9b8ef62fc7ee9daf8af3fab4a527cfb38bb1096e2919e6943c8a06a35926a61959e5374fc', '7d34341390090bf2b715d290f57959c50f24fd016604815a08e43187d8e35f49fc2b59a290d09135', 0, '2019-10-31 03:37:26'),
('cd954487949daabdaffbb790af203243dd5cd2466a796f332b01a5535a560dc83dbb349342e9ba2f', '470e3cf05f179b15d97959f18e055a0e3da1eec5c5c2a2b36b39988f5da59ff8dfe74e43a8d11d9e', 0, '2019-03-28 10:15:02'),
('cdac13a0ed05f37eb70d0bff78e7d130bcc51fbd6c385e30560ff45ecfd3c676c9a5f9d742cf10e4', 'e2eacc8e40d54264ddd0940a0774e79246f7bb08d9d9437d3d5ad170b51ed72c6d6b425d460abea4', 0, '2020-02-08 05:47:21'),
('ce0041bc08f3f8420e22b5ee8e5c0fb6b5a6f894c3f13128caf3e9e9fda383d41dd0bb929c50c9e0', '4c1f36f491cc07c9680890079c6b984face47b2ab871d185a175d78171d9179701a24aeb3f5d8f9a', 0, '2019-05-04 17:51:32'),
('ce310cced9d7ba9f8779ed742bd1df35b82f60b80b053bb8f450b012290e6ddb83e7646d492825c7', 'fca3782d9c29bb0a6f234f509cb3d1d673481f671ed7fc4c1379fd8a05a9d05441a1322205e104c4', 0, '2019-04-10 08:45:37'),
('ce63c97f621f234607a2ae50f8ad4a5b231a34a1849096654b1d4afb0ac4651d1c95a97ffc41d748', 'b4eaacd29b37cbe68845759ef3b6b94c1bf92c62a397d7822a0e2669a3e77a6452d3c97a907d98f3', 0, '2019-03-27 07:36:52'),
('ce67e7b39efdd24496e543a8f40efccb2ee7d7bf5668ec322d789f0b731825bd6908f535a4dbd451', '906d8540495a12a67eb38689604e1921205dfa6b24e9a487c4339720d478ee3dc394edde57036852', 0, '2019-02-09 12:42:06'),
('ce72e874e2eb758ffc867a590a6d303e73397597a6c0cbc4c5a6f41428dfcb9b76fd78d6dbb4ade9', '2f1137a9c5c8ae40bd2abec878cc0a71316581c760dcfd104f13d24d7844fb56b9982a348feea50e', 0, '2020-02-14 02:31:46'),
('ce77aa61ef46c0594cfad7a23dd6cff3f3e7a5d9433082d2d25e7a996021c108ebc712c114405252', '5f4d1460d1f6242d0e25dcde4869ebc259ee283956da0e296e7867e2d32503a55f324f8add46ef74', 0, '2019-10-18 23:50:19'),
('ce99f128ce5d915a78a46b8e9c45d7ea5c2377fba0b743296c7feb71e08981554095bd31ff6b8efb', 'f8038aaff44c4da1b16bafe82debb095a775570ca53c9f6ec128f926bbc6216c3ec432cc8c2f9043', 0, '2019-05-23 18:33:59'),
('ce9d6902a655506fed22d4e842f3993b1e79844e7f2121a64da4f7a64bf15c1554859b37cc5854cd', '5a988856a1e28da587e3718a59de1e81799187512b7fccb4f807b50cbedeb946d38e4d134c186695', 0, '2020-10-08 08:30:31'),
('cea027d5ea041c339dc3ddb06c0a298b1213324cab4c57f24727a7c3eaf285a99b0705bbd65243ac', '2b6afdcb6e92421b71e837adb07285e5717f416f25ec2a48a8c5cb9e71274b9646907a6d5aa250f8', 0, '2019-10-24 21:18:57'),
('ceb8cd92562c368b7296235464b6ec33ed99a37203e5fae4146d1bc96d2e991ae7d369076af912ad', '9956d96312c9409726e684699f184e88eac0601c1ab1d98b028056a0aa802cad2a3c461ec3ff808a', 0, '2019-03-28 12:24:46'),
('ced3f8cbe32fbcd619201caaaab529b2066b636f0bd9c52a8c26a5779c8820a5d7b0b7e91d6b935e', 'f18f39fee3692d7e8408fda6c675f4fbfee04593ae1ce3b3dac02776f6812262b91d5e76aa1372ea', 0, '2019-10-11 11:06:59'),
('cf1119c960f31e20c6f7d6881e73d3e180578a9c0d2078d041608400ec39a84ffd7fff17027ffea0', '5e10f4125691ed0f67253a82b48c2961df011f709bbda106a7373a909771479d066ea9a7043a24b6', 0, '2019-02-13 06:45:47'),
('cf1515c7bbd41a3eca14813680cd43d8dcc7cad38a306bd4862b5fa3d58dc9485841354f16d9c5c6', 'a31373e024e743236f340061204e03ccfcef828bc9927a700d95c95e4428dcd0405d80df1864f8ae', 0, '2019-02-07 07:34:34'),
('cf2fa1e27f0df11b1ea38c42abee6064c18a2af9ff90dbd69424446f6d7de7fd3a63913fa9973cd8', 'b5b4f0869e9a43098824a73e6fe7f0e7014741dcb6c13bd45700b7a700eaf254bb2f4cb033e6b5e9', 0, '2019-05-18 12:04:38'),
('cf2fb684d28ac0d26c39860ed526a3bd43124a08934666ac2470c59f22af48ef7500d2957125c998', 'd19510e38c743d106d5643362a1055436404980502f04deff9c2abda763825735c61fb3c6e384f04', 0, '2019-03-21 08:41:08'),
('cf7d9909f24e41f843c8fff96d3aaace63849fdbcdfabdd73d134f9af1a859bcca4b420c11fe1da1', '2d2f5e45c5558f17348a32145d29a5f26baaa065065484bd73a1d6ac02dd29cc2432ba5f16945505', 0, '2019-04-04 12:51:15'),
('cfc150f4ad49c88b0671140e7b5c71991ef5df66403ee4d79a17a30718bf0c6ad7382c02a9106bba', '4c10ecc9cc3af0c1357ddade9aed8396780d94060bca73ec58e6de5312ffc2c6a565ee0913e09357', 0, '2019-05-01 06:12:14'),
('cff840e4779f299a04f3d67c2e98033d09981afe642d5fdf5fbd177ec5a2c67827e23a6183f271c0', 'c80559becbe16bea64436c294edbd711612504c2369d43e543aa01f320c07c10f36878373260ff25', 0, '2019-02-06 12:59:51'),
('cffb78c5cd3d25a2fa2803ec2eb4933b1007750e80e07434ed574cf0f15b856da7c22b45c3e5977f', '860427d1462e72c474953e880261168b8fe361c5d5bb114d4c9bed62860365778360a81f8cada2b4', 0, '2019-03-14 07:19:41'),
('cffbf39dfcfd7226b8ae297260bfd4ed949ea274f11e86c4fb9e6213db4c62620dd7a4abebfb1782', '28aa0876e0cde64c6b2c0a57f56482d9f563bac9fa014d17097ad5976b94ca7c7ddebdda7e7524c4', 0, '2019-04-25 08:31:30'),
('d018ea09cf5b5ed73638f10ca1fe9263d4a4b33d20ffefa4746c13c6d836d925c89f3ea349b53efc', '926c62dda3063209f0204ae53f91d3033384863a50699f580794b592956353493819b945693358c0', 0, '2019-05-17 15:24:49'),
('d030a30cac3142de821c7e5e216d5120108ca11bf56ee98cde8c304bdeb46f12c4e9151f9b8cafc8', 'b2aaf1641d752caf2d3b4d5ce3273563515db15d114deadddd5a7a25e82fbfc9899e7a8f79a1416b', 0, '2019-02-07 12:34:09'),
('d03eac54da810a64c9fc7dcfa01f727dd196fbabf98d2ac8327925ce1bc78ae697342f4614517284', 'dea0212760ea8f8538c44e2aaadb520f8ced7d747bad02b21894a330f1fa32ce8f886da3558966a6', 0, '2019-08-04 14:34:20'),
('d0513f8b8c158a17bf35ce5004ddf4c3d3d0f7425daa472cde9c501181f6ff86ca71fc17d0ef3e04', 'd06562f5ca8aedf97a5cf1eedcda52f710f1a47826c6a4784765b1c96e6388b66be5f14d3c943de0', 0, '2019-04-24 06:44:14'),
('d073d1e98a377a3ca83245aa4b990eb5d9999a242390951da701da1acc8955727762fb9c3f2177a9', '4e30709f7d48940214d6cf5ed22605b21242ed3fdbcaf920a9fc3916350f7e36425a889ec3344ce2', 0, '2019-04-27 11:42:42'),
('d0a3b6fe5f314899ac0084174185e78e24482fe4766f383043e466570d96ab1f454c8bb099f673c5', '45e83e2837bee034a8c5fadee8cec09818d4cb42f9e516038f2a91b1c1de7948a5eddbcdd2164ac3', 0, '2019-10-11 09:27:43'),
('d125e0b34a9ebbe72603bf8c2ffd3b671ba70527d64bbb8d76234c07311022a6adf99e922e6e08e6', '2c21a54cd805f59541daae94a1ed933a9a8fab0d1e9db2269d8958fbeff6afb56d5c7c2d09acfb22', 0, '2019-02-14 14:09:52'),
('d131f085e16996b64e5ea925c1cba7d8cd06d93cba47c0c63bf8e9efe16744ce9a9cf5ad221fe2b9', 'b4979309a484f62a2ec6cbb85bcad01d80662dd1c782ac04596d40b087a261704ea18944a0a83c53', 0, '2020-02-10 23:06:25'),
('d13e9ffcaaa76df05f4315d4fbfa555e59268f9c6c8aa31ada7e95c47b2aab74f48912e9fa150d02', 'e99e61430e5502b9e9c22f32ecf29543d1a5bdba3c1435b4b6e1367239361c16848143a8dbbb8ef4', 0, '2019-02-07 10:46:59'),
('d145188679f2ec009c4ad8ae03bef93854b957447972e3fe6f40cfdbb075d39ceca90ae8a24007a9', '27bc802df528b1d3d07491807e8b94203faa0654fb5de1bf4fd3dcda2adca6c35f651268e28378ce', 0, '2019-04-27 11:54:01'),
('d15e3f66784a658a30bbddc3b16b6d841cedd46c460c57a7a88ed031a93bcd14a1201741b15b06dc', '1d0406430727bd8b0b09d64303e45cdb56e5113a1780d62b9c19b877a3dedeae9d72ddb4390f0f51', 0, '2019-05-06 14:13:05'),
('d18a2a57d013eb3867f1b4f781ed615ce6642b60d2563da1813dc311d9964d8295af73533870a2f1', '11c85a2cf32155ba1b1d2e71470e4da07c23ed1f51d085903042b1e8afb5cb2af283601dc1c28f15', 0, '2020-04-09 04:29:41'),
('d1db5a5a7d0e6448ab0379bf43c1784a3777450bb352ca6931c8c7533c67c47e5e836ac48b1f372a', '8de2bea95a35ed6eae8b3e9bc5b7de19539e9b73f373d1ce2b274d3bd0728ea85e87e13a9fabe443', 0, '2019-02-07 04:49:24'),
('d1e4b69b7e9f2c1560487089c8963eb61f5dfa3caa99817fd2e36f48b8e5cb409aecebaaa35a161a', 'd04fc34569dcdd7397702c8d909852a6e072f0d2184b5e46211a2a12a7234ce6b95749f1887844cd', 0, '2020-02-13 05:46:25'),
('d1fbfb5840f0701c561f082ca8b83aec3b59f77b24bc6fff97555f4f166d01a584034bca843da9c2', '99cbd55df260916e4ed35c448ef3604c4937dd1ec3fb869bd3ae0998a4ffd9d2f2a51d91d13486c2', 0, '2020-02-14 06:27:53'),
('d20b8417433eafafa00e38f209753c4ca7b644cbcc266bb0b6a4cf290cfde59158ac00e6e98a741c', '88d0ec5cd1c1af1859ea6028137dabd3883e86275fdbc2691b3d47a84aa01e72dddd6fa9379d9371', 0, '2020-01-31 00:30:37'),
('d22aa10137f96e8197c8a4520dbf3fef42eb24a86adc0c146fa8238ed9f01dc2a77c3fdcbcc55c67', 'eed9eeeb6b9d44c7a9d4f0bff8382920e60f72671eed8cc765a4ea903877b24cccbd805a6043e334', 0, '2020-11-06 21:52:11'),
('d23e1bc8363bc095429b79847afb53f9560fdf0536708f6f66f7b5caaf22d1afbb34bd645fe1ea0e', '0b692d1e42926d5b4f80eb8192a7066af9dbb4923383704f6de7ec532b84ef70b0a722060350c8e7', 0, '2019-05-16 07:49:59'),
('d25e8d49f80f67b7770f3cf1f44d9f9bc2618bd54a0fbf10a508a03a02468d86d5a5a1558fcdf8b9', '829c0ab1afd274b4abd0ca82d09944f8fcd9213281a915479a7c2335f72754005fac154c4fffeabe', 0, '2019-05-17 15:17:24'),
('d268200c486fad12da2625b18745dacc5a42781786f58a3e61ca0c7a8055dda23ab3bb40130a7132', 'f3dfa20e2560e99b9be7c910fad06548fab64153db64d4d839c3807e6053fc34c8d44899f5cdcca5', 0, '2020-01-17 02:26:06'),
('d2737d8140df4b66a1a35d9ab8cb4d01eb0dba90871e3825dbaa47ed1e47ee6bb97ff5c74e74ecd2', '464a9eaf92ed9f8e5e162ab21c037fcacd1f20cd6987d7ebf3a3698b69f1aa0dfabf48b578d2f43a', 0, '2019-07-24 07:34:42'),
('d2f370a59419e0309aa329b5c1017afbcf143fbda27cf3a9ca96d3ef4427c4de9806ca32d1f50108', '820ee218a2f28550902c03afe6caee1d4b1fae26341f7e3a6fc149f76b24195b00e6c6f8c709002a', 0, '2020-02-12 07:53:13'),
('d301154f1ce0c58aa4e3cb8a2782aee59b50bbb63fca94bab1e3546e6d063c1c2c5e09e3199a658e', 'd5bbbd937898e2d7e0f81808086630a1850c5ada025a3c55f405c06a41e6d8174b7724a41b4d96bb', 0, '2020-02-07 22:50:17'),
('d340011e8467c131c79f050390e1ad3ea024118ec4e6ce15a0da0e11572279f22586488461e4ce91', '44a6416042edda8083a5ead92ce4d82e64afb61f13a37cf4f8870e2d85c0b5ab056883291907240e', 0, '2019-05-03 11:03:38'),
('d37b550b9b30c829e6645d073425e644df01ffd97f8ae03bf16edd65f1af12d824b6a273c2697226', '6f821576a43035945eb1ab106c969e8fbf77e540d7ca40f24a0d2d6f72667604fa5342ffc0d335d3', 0, '2019-06-11 13:03:32'),
('d37c9b1ffc77e392cfb63d7d01f844bcbda5cdad412b20262d219996468b615a09a5ab1aef6755bf', '912dce5af3e1777dc82969dbdbce669788735266d5fcb0a20d9202cb211e292f3f1f1943ef71c098', 0, '2019-10-17 22:54:46'),
('d3a50690e50738305c4e9a5c5261c82314c82a8eab5b38562ba72ec6e7e139ae79c73b1e620ffb2c', '524eadafeca3f84cad76191674e68fe0e6395058faba937c522f5e32bd31eb7b0fbb97844ef3a104', 0, '2019-10-09 17:48:34'),
('d3c37d3303d81f492b8ca28a4e1a1fb0befc1bc13f9c5f7965f8fbd9b1781c517a569ac5ef0641b5', '4092f4a52c4b2261535f115303c379e9f34a173580cd14a040dc9ffcb4d60dbe378f460db8c86d34', 0, '2019-05-21 10:43:14'),
('d3c5dfcce1751edcd18f5f294dccab7b5494e46e521273a2b925f10850f578e12e5ad6eba7311c0e', '4fa77ed9ad2eba527ecddf6b63dc88afc302d199f58def9c39532cf4d445e60f10b6b88866d6b0da', 0, '2020-06-13 13:01:09'),
('d3d271fb6f7688cea3daecd4c1d2409439da10ff9386f5611757a124aa3eb80b0073511cc281f94f', '09c65564702801b4205b9509a247e3950da303e30def025ad20bc327f695271e5234a20f1cd5f5d7', 0, '2020-02-11 07:33:46'),
('d41660eae8bcab277f4eeaad4595706bb2098e1126ca2780bcb1a89688f0a47eb7e61caf1e0608a0', 'fc667dced30358dd3681c3f52b0423e66b96f0015c1744beaf63a9ab7d4de5487e1ceecb9db77f97', 0, '2019-05-19 15:00:15');
INSERT INTO `oauth_refresh_tokens` (`id`, `access_token_id`, `revoked`, `expires_at`) VALUES
('d41dfe32a4a0e04917b5d5dd0d38b41ee9b1d3191031bd2c89098628ed6aa035aabaeacf05b78fe7', 'db9ed37bdaf5ec5e190d8ef3b59c296b4c06d907b83d4ba1a9054f14dd340f0cbb1e41bf9495ca19', 0, '2019-05-01 05:25:19'),
('d42af3d4d8243903e44e179eaec20b2605274896b0226a165219c8d09258d7174c0e249c786b14a2', 'c92bb50506bbba7afc40934094a5fb35de57f1fae0a35f74b18d3054ceecd31f05298e1ddd8c799f', 0, '2019-02-08 09:15:54'),
('d440085a1f5e7289eb4c9de130431320bd1bded73ad1aead391aa439e01f7a53251d1c42579f482b', '24861831b9391c410443e48d8b3c5ee04133624c63a59662eab2c7ca5d28b55576190e8a8b5a3d67', 0, '2019-02-09 14:52:24'),
('d46f237804cf250811dc98e606b3954b28a6f4757e5e7436a61424cc6805d53b0455e81f64efc98d', '73085f362f620b9a870f92f9f63f8f0efcc7c6b3586e7122d6ccd5afa9db4b1ca9e3d850280a10b7', 0, '2019-02-27 03:51:10'),
('d482058aae282710a7b9f2ea4d4f72568b64a90683001a85f6c383edfb1e88f71e69854b25d26469', 'da7cc41ac7c3abb2a8530e3d9c4ebca409098884cd6788bd2bf913eac9905fe18661e3fd76214b00', 0, '2020-02-12 05:12:50'),
('d4b2fb31d8fe6eb6d84efc525275445a36de77ef5d3451d8be584f9bb0161c4f3cc22d31a794b920', 'ba63eb073cd1c5dad3b83234b0727523b6b4dc70a4c4cc530779cb938c262a2c5013fc22f0d4cb1a', 0, '2019-02-06 10:02:27'),
('d4b44bca33804e03652667c302e0003b427b1568dd39e2b92d9fe73a2a83caa2bb8e10370e59d437', 'e8efd2374802daf9a7d60d17d7293670599365ed8b9a3298854502d751abf3ec67815b4d515c8357', 0, '2019-02-08 05:35:41'),
('d4bc858a24c8e65c3c473cb76f15f7d4e07a84b5a16ed8a98047eeffa8d470db12169ae9dcad9177', 'beac7b78fb632bf8b4e05c7f06393d59a53e1393138c48022d29315c8ed7b1784a7b60279603565c', 0, '2019-03-22 10:42:36'),
('d4f68efb9d329f2d6dd4b62a90409fd6205bc75396ed8f587d5ae2b692168b49da6950afc934cb76', 'cdc36b87624da733bf49d9939317ad464bca3b7d91c7055e092badfb3889d8bde53dc79ee253fa2e', 0, '2019-02-08 05:28:39'),
('d4f7edd5c1c8e1558db1608523c3798a1b2d255eaaded85b8c068ed7759fa46715914b52cac8ce45', 'a7a21bf29932f8e24555ae26fc2fe5e225753d4d4a6cc59bc12a8b0d40e09c6913baf724a91a48b0', 0, '2019-10-11 07:28:25'),
('d53b68bae718b61f2027eb6337c13903d6aa1ebf1b4814abb81442c139c55839ab63a52d67f93fa0', 'e62edb4466aa2520eb92a629c9472ed55cdbbd394ef203960218c12b5fd8cbe49696faac0b357507', 0, '2019-02-13 06:13:03'),
('d53fd768403d2bc7c89269e29ff03ca6d72da3ae0cbc502c58eeb32cbfc4ff3675557fdb05d10a63', 'a8c6313f9d08345726565067f0448bcb6161cb045f35229099c5624be255b45f83fe8230c2123a1c', 0, '2019-04-09 11:47:59'),
('d55257c59f3f490c1c95124181d7eb9a63b1c7b2467de15ffe22b1a795a101705ddb47f6646edec7', '4b147ad88dc242e3d48e739b9d58d740993d801808bd8db24899633fc3612e1394c64ae3cf8fb409', 0, '2019-10-24 21:12:24'),
('d5c6cfbfde8401b58ad59fe923a540cd88be3f0af9832384892dade347b75e5accc0dca15a8f72b8', '0d0a745e1a282784b22e5c521578681c2a6b274e0e9190b2775a536c695310f6badfda201cbe392d', 0, '2019-03-30 06:01:13'),
('d5dad955bceb4cea1af559e6aac72b21d139bd51f9f189e7e7bb884ada47dd447d01ce9a382981a7', '9e4831fb56f771588907532abf186fb8b2d203a07481fa0c883b4f45f683f06a48501827a6d9b334', 0, '2019-03-27 04:42:28'),
('d5e81332f544ea5059b7783d426e0dfedba0dedda44d9241b4753f80358c1c593b4e7925d5bebc2c', '53bffe66974cd82ff07be8e5c7ea0c8f3d54498c508c68c859b863318f897d067e24b2c25725dd69', 0, '2019-12-18 20:31:05'),
('d5f227baeb0c2a568f7e56d752f41dc1c3fddcbe32487e95736e1f0ca41dbf7cae4b71cdd491e140', 'b161d0ae52fbad01af09b39f6574e1c63546b6f6bb9b9d009e255d3d54b8f2f9d0da794f01f0c8af', 0, '2019-02-08 11:49:20'),
('d60d37eedc4a725f0dcda3a5d72e654ce8bd58755c945fad8abf902ec0975d40746ef449b74d681e', '10a40db7e289da25afec85aee85bca0bf146383b2c2f7049863e92bc6acfaf4d11cbf65b78341a1c', 0, '2019-04-24 12:06:24'),
('d66832fe6cd2980bcb55d7a37395f36fd68c1823650a496d15bde108782269d2d5220a3c4e4dda17', 'd6076725bd27da022732247eab854487ebb1775aef0a49816f5785972987cd45e544eb172881a5da', 0, '2019-02-09 14:37:59'),
('d67b15e2291d88829483f9e366411ba7d0dad405ad9507cbc13a2475faf862a2ce890f465ae1aa42', 'd24ca77b61aa6e034ba4565954cea509151c4beb0334f8afc1dcbda105f07d374f45c6ce142ccbbe', 0, '2019-05-16 07:30:40'),
('d68adc865ae2d2ea6f98dc0452115809d9c2078812076781a667f4739cdc6edc1f55362be0599198', '66667723c0ae43344b1dbaae7a7e2e0fbb3c41357fc2f00df68dc1f35172b8f4b585d521e12e30de', 0, '2019-02-12 12:34:53'),
('d6a941a961bd6bffea4db53c25f58157ac5a5340d8327ed2552ba305cfe3be13e9e0fc95752c66cd', 'e52d2226f503afb5c8ed07f40291a1186d946f3a1e2efe089adef1c0b01366ee7b85b769bfe403b2', 0, '2019-08-08 08:46:43'),
('d6b2b48924e88629d68e9c6be0a1b423c50cba3dc2a39525c17c160988f7c05608b03b53aafc42ac', 'd7eaa6f0d608cbb429e9ca04a6bc8ea9c183e499a319079a11fd07385a67808a75da8c21d82fb059', 0, '2019-03-23 08:29:13'),
('d6d60669bdb922740d677b6357579ac8ecbe34e9d1c883817342a650f642c4f98e12cc68c5d1c533', 'dd9ef26e56f55f468b0734f795a379f0521c4fd3cc32e90346653065ab585a5e18dbcb97b8550849', 0, '2020-02-14 22:56:18'),
('d6fe5405d7e25fe7fa5bc8ef56daed219537ae68c871d42666df7ae0885b673d1d2f67ef68a84914', 'b40904fc9cad857a32036d5844749550485f0ff9a70ed82fae34766e51975ab13bc6e3f6ae0a70b5', 0, '2019-09-28 01:23:03'),
('d728d46f3c5e0b0447fdd773a9187eb2fc27eed3a9946c6e4bd059293b66fe1aea3a33193c3c3b06', 'c3ecb193e378b75a2f8d3b48a9087cb6a243920096fa7560949820de9bf1b7880e04df8de3d4be5c', 0, '2020-06-25 02:19:47'),
('d751c4301d4f13819e551a7d25ce0832e031743c23ad69fc044444be8c3ff2253187dc3cdac27028', 'cdff4a75884ffc88d3ee929971771ed626c2b94da5910103372e67e1728029a7bfe3a8468b551e4b', 0, '2020-05-16 10:26:50'),
('d7629a57a4293c2433c5845742f9b347c0792ce101c7850b8bd1c5dc2b0e68a86fe9a0cc74fd2b1b', 'f7af925e19ca374fb6bb0ac06e2897aa6bd2a580f7d2f656aeab3e6eeb1c8bc92e1dfacf9e331a07', 0, '2019-02-09 14:28:29'),
('d7c24e35da3dc8a829bafec0ac1bc43fc9455733ac3166419476d468fed71a3ca80dd9a2c01b5d42', '6ffa3682ac063a7b80fff0b83382905cd39f1604cf028b54676021f5873c942935185787009e580c', 0, '2019-03-15 04:25:52'),
('d7fede2954ceadb0e329432c881a2b82db840df215c44d8999267eccb43cca356178aeb8a96c5612', 'a3db5e530f792851eb48ea57c9113a664fcbf3b2f87863e892f4ef35ceba3c746b44d6af5287602c', 0, '2019-04-27 10:40:21'),
('d80a89825aed74df5c3ecbf6615e3a01cea9fa31655adc073dcaddd55790c792aa0cdb6337f0c19d', '50797153d6b06b7fa0f27c0574f0a07ee19e7d1988886ef14042b322d8f418fa0b8eb60fc11b6f2c', 0, '2019-03-28 08:48:42'),
('d8496525b8d2023f784506c7d12ca573e7fb99417fe4c5624648700ae57ba27956b6277fb6b0dacd', '58bef221fbbbfd9d50fd8d73501c9f0fea2fd5d1d072efbaa5d02c51123bea292c6eb366850baa49', 0, '2019-07-24 08:19:18'),
('d8983d6398c7e95c31030ec2a05c08cc62a054158753e086ebf54730b00b92579fbd7b1faea81ff0', '8998a1058b2df0925915e448d26ed048326aec577ac060ef0e2c983aec9d7798db049eaa64c6cb92', 0, '2019-04-24 12:16:33'),
('d8b1c26d6892a59844771223edfd1997bb708860e631fb8a0c195ec03b5d7512d3fd45910cf44387', '689830c213ade7fec7a22ea6b5042938f958dc48cc74eab0730874571fe76008e1fcdd85aaf154dd', 0, '2020-11-06 21:26:34'),
('d8bb433301d882af7ce1af16689c9aeb718f1c9e0f2b2dc9f3ec09898ea525d6b178c9c94d21a6db', '1b3fb4b27483b8a3c4af659456772b3b1f5d99806a3a64bd60df8fa8991a12c18e16868c63b7e541', 0, '2019-07-26 09:57:46'),
('d8cb9dd2dbe3e3727fa7f9cd8c93912fea8a8ae3751182d8bf8738f608ac17d2ab0c9f2a9f960e30', '3f754a114b7a40407ae1dbeeb2126bec4eb3beaef982e2869867164f8c424af13b87c5ea30a63db4', 0, '2019-08-08 09:15:28'),
('d8ef7074e169319efaa04ecb3d1e9e8d4825f52a0f976901b56ddde543d9beb7a540e89031d4a1c3', '99c024cd622bcae566166b6e16774a9e755b5dc77f1244f610e83212caa46508e44dd73954544725', 0, '2019-05-14 10:54:43'),
('d91c3540ad623886cccdf714f323df919a5d187f24fa52450c8f6d5c24c12352f99290615e51437f', 'dd9f14bdb7ae5917a594943361ad094d7e27805d07933644cdc1e8ed69fd062d131e1c2c995b79e4', 0, '2019-05-01 06:03:31'),
('d921f0ff9459b4218feddc7c6dbf17d3c75704db7de0b260a0bda7627d81108ef9a9b1d0da586c24', '1a15696481b8ba18be72ce36ed8cbf5f5204907f668612319919dd4d5cd448d9c8620abfa3548322', 0, '2020-02-14 07:02:15'),
('d934f3792e53ca91415adf279478ee9a7ad90d8134b62eb4771bb3d53339cfa5f5ca911a4bc532e7', '940d7127135b8cb6ad92677f24925a091b6c1111d3da83bd3bc3cc27ec1905a287f2e2cc43c38a13', 0, '2019-04-10 04:43:32'),
('d94c467f6d48da49b27a23a89892c189b3be7990d70781bc1bbe7deab851326198b494b33036daf5', 'f4fae45e4f7f4e30dd7a4cbfdb6c4c9a4464eb571cd5056eaa06877596c712e21d42d56acb4b390c', 0, '2019-02-13 07:04:27'),
('d98f862e22f29a5eb6333b85bbacb0d573e753c0c2b77bcf1a31442e07ac39dbceb6a81d1510049a', 'f6874ab9e578769e12baaebdd711d43d3f06e3e78249abdc1a7ecdf33cf68959428febfc888c08d5', 0, '2019-12-25 17:09:46'),
('d9b94c91a5ed1345a27ba169722b9f12356235d40e56de55c377400344652877f81a675e1eebddc9', 'c656b20cb08306f60dd5e58ed2f5348b5a9e6f79cd7b4be334001fe72ab7a79d7960fdfc12ad1f41', 0, '2019-04-12 07:53:18'),
('d9c289dfe3c1b095abbe2f34d8ed9acd66301505225e2547f7aedef8f03c45f999a4255b77fc71fd', 'd4a245828c7f60429b99105651afaddaae3f0ee4ce606f014b0c69bed02579572f5cfbd04f322a0d', 0, '2019-05-04 08:27:33'),
('d9e67bee7131a6c4eab50173b07e021e9cc30fdf5670a937ee6d8460fc4393ffc0cc4fedce9a294f', '33e2b1e14d3023d55f63b7c4c47522eb70e1073f5b9e7b3c59cbecc5e7df0de2262dc2726b4556d2', 0, '2019-10-03 04:38:40'),
('da0fd86cf607f1c1c0ce7416d6161c28f3d3add4aa85dc0991fc01bdadce052fde461ebbc38058c0', '1051a62bb4d93f13e2a55e76322ae78585b226ab3cae085dc9a2e8fd5f07e67daa7c44b6efe9d8f2', 0, '2019-10-12 03:29:00'),
('daec448a118458e45714b6d8c406f1b2b064a5c94502ea3534dfc5248f8ee3c712d5bec841e97b23', '21d8ff1d5f859517c515eef4c2f0ae76b3b53bd1f7f737ebeeffb134c26ec2a096910383d71a95c1', 0, '2019-11-28 14:27:06'),
('daf7a5200b8879a54094447c6c1877c346ed685b99add621e05a1d5b1f9728f8f45775799f885aba', '76cd54f4276bdca123e8e56b3ca930861c6c43f2b2497ac3a629de0fe94c81f94a892d8414301468', 0, '2019-05-17 13:06:38'),
('db0bdaa96f763aa53529167813dd875affd12d0edd7496031234c30fd69eb1cbf83b591d32bcf8e1', 'e9252086223be53d2aeb7d9bf14d6e9409df9d5177af7309ff80ad89111ce0915668b0281dd3319f', 0, '2019-12-19 00:32:03'),
('db2467241fd628f71b98ede9ca0c3a4a50957e9809a542385a32a5978c399616631267d66b39711f', 'd4c2341be31561e7ddb488f88d1be1e1c9a7b063db65807df1516f8d72852968f1ec6ae8a82864c7', 0, '2019-04-24 09:19:21'),
('db3b261e193483078c91dad56bfc1d87e1e87935faf3abb66ec55ac778e6db59e06cd5722950b960', '039462e226ec61c41d13222267ca9361378036c17c1fa29a0169e7e57322546db21db8f5983e8796', 0, '2019-07-24 04:48:37'),
('db520767fb2e2ae6cf303af1a066b581118af1821232cfe22acbc9ffe6e9948d3df4be0f68c574cd', '76440f6376bb0a6131258e69351ef48200434c88e2bbb5a9c6df80cd89f4154e1e23ca3aa0ad3445', 0, '2019-02-07 12:06:42'),
('db83208ac87b1358363db99e08a20668b08e166576226a8ddd799cdf1fa3f96981bd8c5e58c4c8f3', 'fbf879e5f8d7ca2fdf8bb16cbebf9ae3bd8a4df914e621b0bf3466321864dea56e4171d988716b16', 0, '2020-04-26 14:04:54'),
('db9dbdb4ce5a56e5b0ebb3d5e96aed00ecc18f7950396289e497532d7448ae12b029e9793b243752', 'c392fb6d6ee5d8828f254c91d6afe2cf3e8e6f4b64275d503166b36b283f389ead98f757d9819c27', 0, '2019-07-24 05:39:24'),
('dbe5e648c05fa7fd432d50318e6c8160c380ebd95c2caa6e09d4594aa96df26013fd792ef753f370', 'd1b5525988fb4184339738ede34bb813c39a59e8b26f90f875fe4847eb45493dc6c5b7358326c355', 0, '2019-04-05 20:13:05'),
('dbf2f76ae1ce18b571197173fbac2762c0f102cde2fa30bfc5d11468d500fd71bdca5d57ab2fdda9', '91bf523470725a320a965e4baf62a8482de865143ff2ed523817e9425a284645d78dc4826761f61d', 0, '2019-10-13 03:50:41'),
('dbf64e22e9abddf072a65492163e794c195041e39e9ae9d83ac4c017a65d359e12b541b0d8285d8f', '80cdce5c0eabe432ccd9983c75069c99a183f39d42dccdbfc4160d982e679df1b70918a77127e6c7', 0, '2019-10-11 07:26:39'),
('dc068ec2e8e2c91db1721d6e8c3413614611c2389210496a3800c1217b58f73c43faefdf2ce68c7f', '1f903b329eb330345c3ae6295eb730ad4f6695f3292d3466043907e4a6f1e6297224c40f8f646925', 0, '2019-10-08 08:51:53'),
('dc3153ebb347d76794086b66be6fe662079a30c8f7fc8e181f04a341e654629974dcaa7ab79824bf', '7031b6a4ce40474238c782be2fd0bd6d480ebafb652cd6e2e776353da5f1e71078e2a092f57cd83c', 0, '2019-10-05 05:44:23'),
('dc319e562b2649cfcf2e1e7bfa0a1b0047bf490c7855c941680308d0a3b520bd509e07888dd04e6d', '858435628e52101e7a58871b0ccf96e351d6b3ceaff75dd329af226ccff6e82d5481684827b1b007', 0, '2019-05-03 11:05:30'),
('dc50c8438c3c735bdaa4496fbde87eb97db0c9220bc0542d17d72709a924bab348424c3860aa2522', '7e64c2483ed53e57b52f21d196a9591e16e0fbf69ed222bb6d8e105050ed738f045cdfe21a6fa633', 0, '2019-07-26 19:38:15'),
('dc8c2f894a07ac26deb32223294fd0657bb8af75d74d26f31dcd146effc19324e7fbfaced9d26ec9', '52af69234f9cb418565d6510aaa5e79151c9154942bb8e35330605d9809ecba7141a9ff847c34e26', 0, '2019-11-08 04:45:18'),
('dcd1470c8c2fd140f37a2c7e4faf747f0eb96ea8a81bb95c6d9f6a68dc6fbf35b109c0b00c83d400', '93fb33cf8cf6725511ccb6994374c696df546d0da0b06341f0234d2e00196df4b309bd6a7de3e143', 0, '2020-02-28 03:59:27'),
('dcfc2ae779e6d601e38cab108724ba18e9bcfb5227dd0e1e0ccb5ecd64d2664ccf3c1d11a176a52d', '43e7ecd44b70dbe10f295983d874588e0c4d7940d1ef572e34f87b5ab03c452ab901289b91b13ce6', 0, '2019-05-04 08:17:00'),
('dd10740fe8046107322b067b534ae81bdd5cffc72dd15df3aa8c702799942c605f7a1b16044c800a', 'c9afee879e0ddb2e4f233695e08ea82f6d3c715d34b1dd023ac88333e2ec36df6611d8ca8740a082', 0, '2019-02-14 12:22:53'),
('dd2556669bc89f6e4232f43fbb0b0f851d49b5c0b15f0ec2e3abb148d935fb8d6db0b7a1dd766ec8', 'a7c12affe006442f10f56cab99acac87b0a2c50f0cf089f50db1c01f72f40141c7e18c45e33e8f4d', 0, '2020-04-30 14:51:49'),
('dd2d0010008ec5a0b74d3bd69db53a7bae91b86ac77855ea0dd8e4225aa950a79422dfc4bea7fb0a', '13ef3c6c2a9840694e5035f4e6f7dd318812651e7a08544722d2832233f0c44d49bec577ccfc051b', 0, '2019-04-27 09:59:05'),
('dd427439d9c109d5630126e8d11b406fdeccca90d44f9a3771cfbda431b63bba3ae80ede903c3032', '0afa71a91e36432531ed9ca782bd703322b1efe7966c36a851a2250b5dbe4e9e570cd25d6af62a6b', 0, '2019-02-06 10:26:23'),
('dd56a6cee8cf5a1e642068c91db0c218221c431fdde7c5ae124ad673f6d9145037cf61fc4c75e0c8', '55b18b43e502a97d6aba34490f6f44ed91de880fc4adf2f3678866bfa5ae3626b3064df19351410f', 0, '2020-02-10 23:17:37'),
('dd61c19ee2bec9b2a3c87a72a6138ce00d8b5fc7b2834134f8ae1819fd39252c221f34f88a2f20ff', '260d849dc3bc967ff57a454d84a48f18ac1fa3359452c1135b5fbaef67b47354b797f1dea3005878', 0, '2019-02-26 13:10:56'),
('dd6d7207526591abd1457d13c63fed362bebc34a8b752b7899a1192e211c650762c07e6af25251b9', 'e234a19ab9acc26bbd4b38b3191185d65d026809f991463d752a8b1c95e0d2d55ad6a1e936172b8f', 0, '2019-10-11 11:56:21'),
('dd7331d173d6728d0a11edc21a1faa15f1963e5d24ad42594afe14147042b682001f4b96685a7dd2', '8071c3026908e02996196a7e9f8de4e2fc9b9c13a667dc76c8bd489021687745ae80c880c5e73dfa', 0, '2019-02-12 09:31:44'),
('dd744652c08a58e490530c7e9a2ceaf081c23c8890ed19958833ef10aa5c6e879b035f44314b6226', 'd715fab42448c73a7b0f48b9ed4c6bf4151d356b7214b4c51e5dfc43bd93c11af03d54f6743d305d', 0, '2019-03-26 05:10:09'),
('dd75ef6ea14b8a024ada53641aef272fe78c7705d7089f4018a4932997a2a4ce4fcc816b4f299145', 'e354b8ce87e35d1963dc42f795ea678d8470a1ef8c7ed974df9f465bed6701e97e6b34cfdbda804a', 0, '2019-04-25 08:33:17'),
('dd78a9c427a6915262bae347d2ac34d7155172fa70af9ab0e76825125eae4cdc6d27cf3698712f3e', '8515c6cda67665b9456c3697d7939f66de13bb8ecc488edc93e96995a25b07b3a53028530ef725b9', 0, '2020-01-11 02:47:14'),
('dda4d2b6861f155d5230a18918fa2ecfbf231fc49df0d8698de2a6535200e0fb04cbdcd90783dd03', 'f0436cec886c87130e9972573248764b45cec40addf3085ce76bf6de6c7e349c32b90d22751ababf', 0, '2019-10-25 01:05:43'),
('de2746f279c544bdda5ddbea527043718e801f33e7c6e6571e10b55a24a4d71803a0ff887d32ed9a', 'bbf023d9640a88eda2b15fe9dd8b0b58e42227238178a75722401156543a6d04f058951fb400e269', 0, '2019-02-06 10:01:09'),
('de60d49d3d2a9c716c9d8927eddf7bbe9566067e63d6caebf6d4f2f5e8cf63e612d224294cbe4ea7', 'ec0a8e54102c046340b84a97590d7bcc1eb7f4fe163b5a8a195f8a600aaeca72d1ce738dfa34b277', 0, '2019-10-25 01:08:25'),
('de99f93f58c467158a578d46c9e360d90ae20cf3f9f06911fdc0c7fc89aa0853cd7c159528cc7264', '6771577c29281a12c6abd6aee9a5df3ce61abe9b7122b0c761046df64baf9fadc7dc63f7d0f5ad28', 0, '2019-02-07 12:28:54'),
('deae56aab4308f44330276704ba76ea6028d84cbc67dd79b2d2be662f33ec17e2e0bf41724057f6a', '76c3e69079c479153f9edae61fd1031372b05aa9c4a64d40c1afc2cd7985e2372894c72851e3f301', 0, '2019-02-09 14:54:18'),
('dece886ccd2e1034f8daf0d9b735054fe4b1456c46f11d8b6c46aba1fe2a8fb0cb123c90ac3cb7bc', 'b76eaf87b2929ccdc727974457c3edd292850c190d6e4f5f5285e29096f3b60a0b5a3c0c32531c89', 0, '2019-10-01 00:38:14'),
('defe99c826a9d2742630a9caeb0b8e510724182e2954250711bc8324b337fb7eba31834a5777ceb7', 'cfe918ca60ffb1a4e364cf81cf61d3787aa787e37f44ac03ea06d21305f526877b47cc113f3be277', 0, '2019-02-09 13:32:00'),
('df1b41d51fefa7d3ce8c4948b40b3aa25e5c68a230a26b9e142a0728e177b09bc72dadcb853e6dba', '220c32e0920b74f200b1af6d29641bb86f1c0898fab0c4a21a5ae5151c962e79bde95a9f6ea2b814', 0, '2020-02-12 07:43:51'),
('df52198f6f19180d3133e593a5450962732c9c63127da673458df371f8a3d5a25f4b9e4abe9c0d43', '6a19310f1bb012eb2be8e6e2882fabc990bd1159ac7338cc53499fc284a3579d7a604715d0c18e42', 0, '2019-09-17 13:07:26'),
('df5974588b0566ba36fb6de9ef44dbfcec3ed5cd4e2572197dd5a50d95d3654497089373e7b35f98', 'b462f6c6c5f0c729e5b28ffbe224ab41589952349328f54431d459a1bc03939a8ec5ddaab44798a7', 0, '2019-12-19 01:01:10'),
('df787e6b812caf054e62e4000386a05e04599d138a0ac607f43832395a3f10f78517fe04da4133ea', 'ffa8718e9d8ccbb18dccc006dae7772bbed9bbfd239be7498b78248d5a12a4b535d23d382ecd7eda', 0, '2019-10-12 12:48:31'),
('dff2f2645fc1fb3bad5d461c798b4fb437d50f212b97d982e22d797d05cba77e1d9574e1367adf11', '0d9a6aeb636defde0661306c8b5adebc1db60280ee2e5beccd0619cf4e46197a52d0d8da52e50e59', 0, '2019-04-05 05:55:54'),
('e0140541711f8ee4ce3d32cb4e4e463763837fd5580404abaf7259ef38253bfad842781021ca9601', '8e1530e0b4afb19f1666e9d4626f0db88608abab192294f6807981b2e4f86d5b3f79aec345935976', 0, '2019-07-24 07:19:19'),
('e03b9118b00d7ffcb7939ecbe74f15faa71548331acf87039fb96af14bbbe1abde20ab625a01f476', '54956a706428ab7cd9964807c39474e22d5bd6cdfa6583dbbdcda9f6cffbee4b9bd006cea1fdf033', 0, '2019-02-06 10:51:16'),
('e04a49d3f1842c93239aaefddc6a833ad4b6e445e15b01bd849b4a83f2044971e89b4b94ec17548b', '63c33069a2441377d1b218fabee6a9bd4c2398adba47d13146886ac7fd2e4643141a6f487476f3e3', 0, '2020-03-13 11:05:34'),
('e082ac3825a6d5b3b600013a556c52f10a185bb7791141f77f56b267603a0f4f874cb031752991bf', '90777926bd4910182a040d89adeb463622c087d07eeb52866d2b97eee6bf7321f19456177108059a', 0, '2019-10-12 07:42:59'),
('e0c3d25841ea497a226fc991e40efbb19daa815fdd88a7327f83244ef10b2fda5599c345ebcbce8b', 'dd0fc99af1d8ca7d788c521c13f4323065d7303eccdcc45cacacf20e86a29916f3cefd9903051dce', 0, '2019-07-25 11:33:41'),
('e10e1860b929edcc8aaa25ccb1b161a99b99173ee56f6f2f7b0d70725f69052c457c7e267a5a723a', 'c894fdb7859dbb02fd7a013c9aef63da6ccbca8b652c1c7c97193ba17738f7993009a5bffa2c97ec', 0, '2019-07-24 09:33:21'),
('e13580dcd07ec8193fbbd56f9cc2070952d09835248a9e99bd8beff0ccbbd0f37616104f9326ebdb', 'cdddfbf16fc10c7f11b7a180a46316824015860da94359ed68089aa275fb9675ebc9ea0ae891de99', 0, '2019-03-21 06:03:38'),
('e13e7c1cbf8aad9aed45853d2b0328a48b954ebc52325defece2f94b0d4397b6dd07b5424e967cfe', '36f3dd20a7a431449555da45da4975d4ccd59945f1fab7cd8b78587e1f2667681b22ac669f4cf9ba', 0, '2019-02-12 11:18:17'),
('e228eaecb45cabe624d17998b8558f5ff02529661d57ef8cf8c260d6b237d41cfbf9535c5e69d49e', 'd5d84ec2bc921207e1a12a18efe4da4a43a03524f9672d69002e5aee3ffc8bee8511538c1b275bc3', 0, '2019-10-23 16:28:17'),
('e23fa8e2c3f4894769af9f9e8ad33084441720410a60e0f4f55ddbe0f26582e1bf6a644eb39dc145', '2da4f676e86d8d96d6a72d762c0405b6b2ae9decb5fdb2099a26d7b9f8bd2507a182fce277008da2', 0, '2019-02-14 14:48:08'),
('e25cfedf0ebf79a455054b3201adc5195962f9a58d55de8f513233563b69a99a7b7ad10b1f8ce718', '96df325aa0ea7c748bbfcc0b0fbc56e0f59f5886de90772d01c6d1f5b20971e7712f2e50b80373dd', 0, '2019-02-07 10:31:54'),
('e2721c97387d4e4c0414555a8532dbf301c52067caf4a417f8fc33c6a9cdd55bf4043ab909c56858', 'b060aaa820cb67a5720d3963c1bd4498acde23fea89b1e8a7dec733173c59153b49cba8851d5ab08', 0, '2019-03-26 05:35:56'),
('e2c2aea7d8bf42883a4847a3037872d448913b2bb024b8ed21b580b8e57caa8be9054e44ccbf66a8', '53581763a5aa359692a174737d30630479131f1c4031a6c52a9c506f91a29e969ddd288c2ede2d94', 0, '2019-05-08 12:50:01'),
('e33bd84fad5faff9da567afc520315c8a2e9fd14ebfa019f669f2c05198ea0bbf980be3ecad07735', '3602c9b3180623046f10a3bc51fc1106f5c678e4a02fdd0b84f5e70c1bcb798ea7d3386584b658f0', 0, '2019-04-24 09:23:42'),
('e363700502d0534a6607b0c9841ad56fd493d52f2ac1d88f4b69ccaf746e7fd2638b9b84572ec0e4', '028e9cab2a2e8cd68d23087cd21fb91a35ca84fe83ca7e92b4793ff31a5a0dcc6304b2f8f681505f', 0, '2019-03-26 04:50:10'),
('e36f0c1cb84f119cfe9067e77d58210a429760e1c1c799127e2b6f890ab7266932f0076adb84a0df', '0d3dca30d5645246fdcf0c784ee9a6233ae7d20f2bf24a801130c26756849328682a0d7813a96d6d', 0, '2019-02-14 13:35:20'),
('e39ac3b1fafb980ec4db29676ffedbc9edeb82c92f40890cfccbf867cab7a1afe26669e979142971', '3effa6c62c3cfcee9236210601a2fbf1c8ab795207a84e369dbecff911dc4fdcdbe24169492efb8d', 0, '2019-02-06 10:05:22'),
('e39dbf7204b85202e5b21be7485843bfcae6cfa7bd316f58ad9fb902f0338d3a559056088c503af8', '9a97c28f0d99655511e98bf406d74f06a65fd97df1065e4506df2f66b220a0c306e1eecb6de780ca', 0, '2019-04-24 09:30:19'),
('e413d242a7f939b9b637cbce5395299c0b306993ba966c9422bcd481b49264f602749d2f0f80ffdb', 'dcf9ac2b539575b224bf82464cc2c1c9f9df9ce18ed4e308212460015971c246a9ce7d2c3721ed11', 0, '2019-03-16 10:43:30'),
('e458d9a385449f58abd22618d1b7fbc93ed637f1c04348c7d201d68c155a8e9a328a2c760e61216e', 'fe93a67cf1ba2cbd3c6fd797df4acf9427df1d6f5cbe46bdf82c66aaee57420d4b596c3bccd0ea61', 0, '2019-04-25 06:18:52'),
('e46cdd3eaa4017ea6740c57512f9da0e4b748f1450163d93b31fe45d8d3aca2f43e1085faf277117', 'eecef15b5ca5c0cfe62f1b0c8b0a159e2ef8bbbcf556a073849ac12bbd245a9b6b21b77ac1a7b272', 0, '2019-03-16 08:30:25'),
('e4834cb2859f06bff2ba863215190aece1846516b7d50a4ffbc3e931157ae8a085095f93c71cae3b', 'af9e20371a31e29c4bd18881637c9422270b0d307c020c3bf1bd3ad7bd083872835a051c9511d8e7', 0, '2019-03-27 10:07:40'),
('e50a0caf8cf236990e55508fdfbcfa68289f9701e49c4d0fcef64759820c639a5d95095415f93550', 'e54d4e290eb8205ae518f51cea63d761e329063870a8a6bcfa3e5d9fe4ca1946d0e24307f3a1cc8b', 0, '2019-10-11 07:44:34'),
('e510c030ff8424d6ff42a267f7665aa30e10ebdc2f51d3a735e3301d4dd21890c9d9f35c5ad45462', '62956bc91d863b44cbf7e90718e480cc0be8a8cb0042484291f8fc9a19d3d370bca53eff8f9808c9', 0, '2019-02-06 12:43:20'),
('e5a1b1b455c62063f618ebeede9caefa057b16882e94d3166dbc824a8dd63cd19fad9f6ed5bea167', 'fcddf2ce080717e6572a9ef7e2c78a5fe108d5e32b4dff21b614ab24bfc1e3f55ea75e9f1d9535bc', 0, '2019-05-04 08:46:41'),
('e5a52c21861363b8113766c967a3cbc8e0be8e67e9d967dc925212ac4b7a73aae6f65009fea0065c', 'eab67f09745368998d936e7607f0aac7e597b0b0e722bfb61751e1c4348b41bc9b87121585b87527', 0, '2019-02-09 05:54:16'),
('e5d14f9acd9f6bee4cac3e839c41600cf2e0f58d6135c813210ebd0336b3c2e84f2bfd87871c1ba4', 'ac4433aa2b81c048694ccd5e10e5580d14e136317f4223036244d7026f0b7ca55e1a7bab1abf5215', 0, '2019-11-27 09:28:37'),
('e64ff02f04c2e54d30ef4ed522a339dd4e47794e83188d0094178c07db1d94a8f87e9621e56a0dae', '431edcfb74fecaa857d6d5abf09050db7d2353c9eb7ef03d4c99f196da88c5840750e2e41dd026a0', 0, '2020-05-24 11:19:08'),
('e6693becc3765b80d0b3ec7db4c43d6815aa9e2e80b00591c290b9efd44b58f3575c89b4bb41f16a', '8910b92a1dd957ad872d7e738747cb732071accac3d20401f4a5564487873ff3f3e86d4f4e244f8e', 0, '2019-02-12 12:30:23'),
('e66a874ccfa6c37c056559d3822579781e3306cfd9844300f9c983cc79e1a58ca25cf14bbc1d6418', 'f890cc8b9f4f7c9fd5a8ebdd9d5c7541c3e9b97f9964c82cebde3c1ed090bb2008754ebc74d57b51', 0, '2020-02-05 01:12:38'),
('e671ce73784f39961531b1682d76271ad86fa4bab2dcfd47bc3f5c306c15979a465719ab715eeb28', '7c6573fd0f9de79869ffa57c03d5eae46e4840d2a227a0974d29e4d88d6e1517706693a8f981025d', 0, '2020-04-09 04:27:55'),
('e6a6060904f1aab411487c9845028b280c7f1e4b7e9a0f6e5a035e624e48d88613a72bb4f8ce6d6b', '1f246d91ad4e4824314e879d1953bae52a319fcd401f9e0f2b8130261fe4a3ebf4c2ba94f6c9ebbe', 0, '2019-07-23 09:20:28'),
('e6b67cf091765aa84e05681491e56db75b1d8a7cf253a35a796a3a43785c437d2e5702c78144970b', '09b2a5af5c12ecc5e3ca8c042c9c573c9fdfac5db48a2871cb070e756e5d4acc096b11e463895d55', 0, '2020-02-05 02:11:14'),
('e70f9599f0b274e293f1a4f174ea2146e2ab6ba68e7e7f3312567e49988f6992790fdd446d0553e9', 'b52123e3faf555a596b7bd61f1eed2ff1fb0ce2a5a5077da21685c5b4a2f6ffc4d306f564275c779', 0, '2019-05-19 16:03:15'),
('e7152c02d2889fc47f4de45e9255721594ad2af3f3cca80e4cb015025b77e1fa83b427a47f96a1d3', 'f171e781669e198846e40f6d18e66d68a654f9a7a8ed997677456142a9535f92149831acd36ff7c5', 0, '2020-06-13 12:36:21'),
('e717efe63ed0f5eec80ab80200039cf3bd0e248faee033437d2ef81128259342e597176d40ceddf8', '7a0a7583b0bec64663c98ea9150273cf0da2f623462becad521fb231f162883ea1d3f63e1cd54740', 0, '2019-10-12 01:15:01'),
('e7b2cbeb6698c88a9a9fb4def1ad0de0f3e1513adbb61b6f4bc464fc4e9026f071b3341ec1713115', '1ce99e93e774a59c2df8448050700b8c0a1e73bea17c14c3545ba2c1ccca8dcbc75d10f64f251bc0', 0, '2020-01-22 05:32:24'),
('e7d11fe863c5dbebfe44c414860847ef029b263770c2d43248e11331652b73be2da204074dd0fdb7', 'f87c4667dc9b430a53901b5b541bd4856b488bc338f5a522bfbd492c56ed8307ca7fb0396b0b4708', 0, '2020-02-11 05:31:27'),
('e7d856547b215f89394d87072512019a8d1e9ff9ad04b12d1b839ad1fc15cddb7c294ca5a2ff9115', '7766ab06673a422fe90dcb010e647e852af85d3225791f44188546ee963c2591e46249c9059a8417', 0, '2019-05-31 11:49:21'),
('e8186a015e5d318c84dd56fe6b5567bc35e2dc6e897c450955c6b02118a5afaf63194a1c573543ae', '7151cb26bdc39dfdf25e7551734a4b100529f98afbcd4fb34de1a576270bb9936153776855e94d9d', 0, '2019-02-08 07:20:25'),
('e871a35e97f6b742c62c05112de62b9d030c1e9d9bf5a69d092c33ad552c04a03841469a80560fbf', 'e843d1b0c6d467af2c93d56082d447a0b526d9b11d569f2d95aebb888d630152dd8d7445bd0a0ca2', 0, '2019-03-22 10:57:34'),
('e875c36d386ebca068aa84d4b9820fce3a8c60ef9a49ea4d81913fab520bbead5e571dd778c0d64a', '2fc3c7dfcc879bedb364555e86759c1a56714f0b301794d9569a712f110160988c31add883272272', 0, '2020-04-16 14:07:45'),
('e881557d45ee87dd7c55ec4b1d40b8805f6f55e0129d3c927b23806138c8ffb9e11c55877e5bed03', 'bac786a9c2ef870c2744377065eb98ddb02ea4a4c166f5b50f1f0a4ee04b7047d82844622adaf44c', 0, '2019-02-07 05:41:43'),
('e88434b4f765c40797bd80e385637b0c825f113c9244d80225f7605f30f33dc744055a7a402a169d', 'cd41c3cbcbfb3a2a09803990de89b807e323f6aaf0c85e41c05979f33c74be69f409a7fc05d3efc1', 0, '2019-03-29 10:13:26'),
('e8be4811931c61aec2b7b71df7bdcbad0bc7c010e81acb11261ba0367f9cdafa5edc96336cf89453', '1d4b47e1a7293adfb3891bca27d45cc28f09170aedc5e34e63443efa25878dad2c668d69ddde29b9', 0, '2019-11-28 11:55:33'),
('e8cde897ae00dde39cb72f602c66da777893d0323f8e6de11a899a522788a67dee95f7eb343ae644', '806c284b3ef612eab5fa4b680ce92dac8f70fb1f12f9cf105676de845cc98b33195d85ec880e07f3', 0, '2020-02-19 15:44:38'),
('e907c993d41ef45f35418bc4268d4da49b71b01a0f3ff022499ce0d85c877bcb1236900c5a92a2ca', '4f9d578875dda5626df53f9181f0021033163688dd4a27307867cb196c81170550f51fd6bb0f5822', 0, '2020-02-19 15:37:14'),
('e928cf111a1f6047185b83ce73300dc1c46611d72e1245b4758806ea42a753422cd25fca2ea6160b', '21b26e0d9f7a485a73e69eca2f01297a1a762d738d9c07e703cbecb359cb32e1c3af3a69efeb062d', 0, '2020-02-13 04:17:05'),
('e93bc1939f0132f1408e1c9756a540980cade5d3ea5c9394dcd48df099fe0ca28fa8b8fc283b6602', '56d1cab5f48e2cc37a905ca21fbd8788f823519e12ce522dfdf35f5f4d65d29e787df51a0a9a72d3', 0, '2019-02-12 04:57:52'),
('e97ccfd738ae8a7852170758e97a0b1c9487f49225a21f72a38ba51748b42ef3186e04a1d76b60b7', '3aa082ba0da7a740f020de72ea69dccaa77fd3acfd63989cd044cee28874dad69cad380d8c758e21', 0, '2019-03-21 05:53:43'),
('e9d979c55dd3185242ef57f2ba4810f4cbb827597076a35235aae1a48111e0068e11ab169dad23df', '303f4d88a66b31b7c1c3220bdd66b25184123e72cd5cae87864224c40a0724cc994a6f12599548c7', 0, '2019-10-09 05:55:29'),
('e9f8a931085e3c2671967b191338c76e95745ef951adea75edc53e092022ec2320219f0379225544', 'a8c17161d249f13ee28559e5fa71bee6a91eb9cf6c7fd458a7feaacc41d41fd5995461cce228f6d7', 0, '2019-09-20 01:14:47'),
('ea21697287b3352e0a1d034734836f6568ae364cc539536a7129a8f061a1757fa7371e2e84f1ec7b', 'f773279c30b541cd1b500bc7d0a57c2255e37b0754d88782579d60a74bbb6fe5ee5faa6f8aa56ab5', 0, '2019-05-19 16:08:04'),
('ea2d9ebdf0518cde4b60c41e5413c1dfecdfdcbc05fcf9be816179872287e2d89da18baa79507d6b', '534e8b5f6d3148874f5adbd987964d87ee7356e68b0d036a514ec5df3346e87d55181afaecc32a07', 0, '2020-02-12 07:29:09'),
('ea482c0e7e1cfbc2f2bad2389884986e16ba90595b042f50de360ad4277f94851d93477da7239578', 'b80ab961e1c99a0b9b5a100bf5e2760d2e76929fffc3d15a61e4c02f31f47ef616d3bf80a66511d9', 0, '2019-03-22 07:30:29'),
('ea893af4e07824a461f6009f36c39731105e759bdc18af8623b74dfbd07f86ccf00f33cf25690c27', '95392c4da240ef187ba41199d219be7b5071daddc13fa788a6f9ed5967cccbd371ce9a2037c96c30', 0, '2019-05-09 05:21:18'),
('eab83d1fc755a61659425ce9a0d1cecbbdb6a3c6dcafd7634f2644102983737dfbf74094fe8ab02b', '0265a51c4333f247f2cfe56ab7bea3bc9aaf5cd320ae70566a534d7aa8a464e15e721fcbaf9910f7', 0, '2019-11-30 12:53:32'),
('ead80c39a73c9b8a80a98f33247f8d85f18bcc39ae1592c6eb4ed67fb7a30d4eff40c753dc77a6f9', '8bee152ec2a6cbf7f5925cff638c53f6594fb2f4f8fa9abcfada845a16e7fc197a4a9cd325b72363', 0, '2019-10-12 14:34:33'),
('eae40c1f7b6d3f6db67be84c9dbc7fda5900aa5651753f8a791dc05dfec001a723a315fa1da48b07', '4fa24a3a983e39af90c3ce119b50a0d6338090fd94c33e35fdf20a455516a0fa543847b41a6e7b8a', 0, '2019-11-01 07:24:03'),
('eaf322c9b9d66451c3cecf665bfe6fb766247cc2547671af138c43aa0eb8f7dd5c6c792103e62172', '4f35868e670a3974044d1c5486b878a349546e7c4e57cce5eadebbb69454b2b64a1418d2f27691e9', 0, '2020-05-22 11:57:05'),
('eb0646e115f5789a8f8f0c2165d6ed7dcebb126a2bd0135a1281f2ec96154ee0e707f68974c6ab5c', '3586a0d274a426459a6c33e0abbeab4a41ea1402b00187d836886d21b183f2594a94ba86f4ff9a92', 0, '2020-07-08 13:23:26'),
('eb688863f285f7c17802e9872da6b39166fa91e74592d8e524ad28ec7fa68c546c56f6d88c7c077c', 'c711ec78f4715ece5dc3e8c1fc9e0716e69e4ced8b7accb027f6b6bf9178b831cab93fc8afa1ddea', 0, '2019-03-22 07:22:05'),
('eb7f23da17fea6dfd13ee58c1f3b6b860cad7b77bcbd4c26a9e20f8b9f6edc6b9c9d7c558e573820', '7c16784dbe696a61dec9bb0ef7f9db7be9c570be11c926f4f19b5f8152d82a903cf6460e524f95a1', 0, '2019-04-02 05:50:33'),
('eb95bb5aac4eea51865ee0614fe018bdabf9f9d12e7adc0f7eb39ed8d2a2a295867ccebd85dae37d', '1239357a2783c02aed5954cf45bf66aaf9d2050e655f53adbba0131d7eb73fb3ac57c8b98a57e591', 0, '2020-02-05 03:04:51'),
('eb9fa56329fc78483818de644915d4c47a9543d33540001054db37216538bc7a38314a797fc41624', 'a49a91be9cc9999e7c91fb38149f1cfce50fabd76a570adc9fd5c3b76f7e67acd949ec0b674219f3', 0, '2019-02-08 10:41:06'),
('ebcd73f18f7366346882c451615e20a2f24c34f1096e5df2c48268f5dd23fe5584873ae1e5e80936', 'b8d0aa105f34a6214839aa7072b50e37fd01c6ff8109a285f9cf34d8d4342ab360c30cf494074326', 0, '2019-04-02 09:27:49'),
('ebf9fbde97e8e93c38f1fd6bb6b79ba819e4b7a69a2abab80285eb779ec92f9f0ab3d658fc74a37b', 'ed447c066a18e2c70803f45c141a73b83d47eaab4fb31e832fd43e88dbde4affa7002cb75c776d76', 0, '2019-02-09 13:34:33'),
('ec55857f2fcfb213f9a7417b1f38c02732b7763bd808afc7e2f3781a9de7dc422ed506e61bf4ffb4', 'd568710150fc789e6b58d27eb10309d750565d3cbf418b5bcaa698c615fbc4c97c5738611fe659d6', 0, '2019-03-29 04:57:43'),
('ec6fa4d94b62ce6b3ae7d450bad61519d22fabeb83df327ed43d5b67d0cba56635ee7dd38588a0ac', '932b35a81b1459bfc53596fe28b9944e6c4d2f86c2afee33c10ff12570bad82db38aa6ad1d3ef711', 0, '2019-11-28 10:14:28'),
('ec7c348fcad7cac18d6407dd4761c79259473426202b31dd9602c790cda0ff06a58ed6c108699ab1', '8850c1b8a8315b68def72c73ef066ce41a87597b44b0d17aa86a3a990ad7975aeee50778197fef6b', 0, '2019-05-19 15:58:20'),
('eca7478fea4cbb2b310e47b07e67c73a151267840b275388145347af85b15c2713fbc6cda5b2de8c', '615a997771df93747bc53c96e2a17a10a8882a927234462b133574c1cc4f9fd56cdbd5779adb7dfa', 0, '2019-04-27 11:54:55'),
('ecbd93628d062c615afe1a31dffa2f0cc228ded8267fbc800ff1451a9f3981a54db9770111acb273', '28fb39f0568676b8e7f5febc843608bbc8f2fbb7e3f5226e126005cf9844e676e3c87ee3bec748ce', 0, '2019-09-20 02:37:59'),
('ecd3b6c83152a89af0f0bb935ab4d4fe58f469582f4db72ff6b3abac4f645d0f29c8031f5254c595', 'de15b139cecbe1aba5a4cfae3eb8cb87aa0e09e2126e644b96ebd91910f41052955d6ad0c15cad25', 0, '2019-05-31 07:32:29'),
('ecedfecdd9ddd883298e9253c8187a88f376a801faa6453c498eaba7204974d2c9fda79e98c64dcf', '41e660a08ef389c04ff3723eedb43ccd1e64e0e87cf8c76ae396f5cfbfae7812b810cd9dcaea0717', 0, '2020-04-11 12:50:02'),
('ed066b884de7652292d1530b0541b5f74ea7cad06aa5b7b0caaad83f9c063115059aa34181dd1dfd', '9f6734cb6757de6cae6b52e5928c2f85184f902e26a5b8346609b55a3b2913d96dce3d0524d87341', 0, '2019-03-22 06:40:13'),
('ed4d89ef06b4a842b866e7479ff2e44e0c98b151bc7273dea6608995b959d7ddb2cf5ca3b31e59be', '3760ee36a46b2acc0c206f78937fc157ad7953c41fa741d39b6c26f6d1b54d1e72925785f719def0', 0, '2019-04-05 06:03:55'),
('ed5b454721cf06b45a19118dad531c024468ede817ad343ee2fa77307ef76f8b622e2fc756d312c9', '363d9aef126ee260810b4ea037918d037daee0bc58182688cf55314a7e2804090559ed6879715911', 0, '2019-02-13 05:04:18'),
('ed8174d9ed3500394562baed4cc67515d60447a590a81109f1aca680829163b3319075d853fc8624', '3b20f4f16a9b00aaed415ef19e300139fb8dc8f6d7bac462beedde2950233d4d1e1e8f53df2783fc', 0, '2019-07-23 09:29:59'),
('ed81c1c9510ad6f3e510eaa0eef8e7c7025ece509faf76798ecabca9f103f09c6fa08175396eaf16', '15183181ec6ee3b046ddc3a22e109dacdf5c73c946d218fd376067b6cb7d8437ed1259f5558670b6', 0, '2019-09-20 01:31:24'),
('edb1aee9e1a1f936f7cd8b284a404a3d036313cbc7d3a584cfc524e7edcb7efe03e0232e3e8c2f69', '4149ed2f936d17e944d13800e29aecd3cdcbdcf6f1baee4834efe5d683d87576b54b72e1e228b7c8', 0, '2019-02-07 05:23:33'),
('ee47cbf8df3ac16d70725a125844180f8b6b8a4aa3a30ae6bc0283f1119254a5e1daffcfb1959b4b', '9a97d5ef5fc85029a8bb7133ff2d4a9124b67bc096f400378b2b22f155beb0d46c2e1baabaf658ab', 0, '2019-10-11 04:11:43'),
('ee8310a436849905901f675ef9e35c7f2ef2e98c05ffac3c1cc7f8d5a6203e56e2cceb733405da89', '386726e33540dc191b8575520fffb0ef8c7eb1ccb74a8fcb0c997628b13c0ffbcbb2d4dc72bab5ca', 0, '2019-10-18 07:09:47'),
('ef0a9bcd1353ccb4483dbce8b9f84cc884f7b3a531ff81aed465086aea119a1ced98aa36130cea0b', 'df84a6f1d1e61736c5eec42b47f46c07a495f1d86ab573b84b655d3b7d1878a683a3db39a76da2f1', 0, '2019-04-27 10:17:05'),
('ef42309ececf2146e2b5c6c40877bb932ddcb4230b56132a19e50652c6089014ddbbbe29fac29c00', 'be7c79bede258a90dae1679e3d54ff75f6d3bd772abb65236255820b874e518909f9a8912ab7abc5', 0, '2019-06-12 07:39:32'),
('ef4a42a31e3669ea8cd2ec82213e23f962ce6e5b7f1406341b3b2bc6a7f8ce8db6f8997b3e9eb19f', 'c8d0a780f2b15b6fdd05c2e4db2dad1a4bed66fcd58422cf0cbb7bd0777392ffc10ea9346187b8f8', 0, '2019-02-06 14:10:51'),
('ef98f5d29eea7be9b3dcb230fc688bb19950c4e233a168dca3ec9e10489c02c6b171cb1baf4b7e7b', '0342d4c565f51c371a186784bfc684c1145ff8b995d6cf59645cb27d430f30a10161da8ce5df6d53', 0, '2019-05-18 04:36:04'),
('f050b81c581b21ac3a7cf5c301c490eddfda25ef58102d8db2c8b59d25805c981b6623d70005a055', '67957f1fae1218e8c35a8abe26fc511bf6c8dbdaedfd170c833b756a61c8ab48acb3c9c3d4b23812', 0, '2020-05-08 13:34:46'),
('f0797985f75ef189270052a436835f574eec9e427746f633b823fa124853fb21a0f145078d10175b', 'a49c2d4d9cb1d33bbcafa96a6dafac1e1bc0bb5baf3a8b440c4a4460e53b788e9f413d18c28c3749', 0, '2019-10-11 10:33:19'),
('f07a515aca9481683ae04223fa01f170fe7d89636c50e21058205bbe65bdcfeb73536f04b0db7307', 'c0dffc91e9b6f54b215d4f305364f220606a5eb740ea36de9938c30b59e38bc7714b065ee77ea065', 0, '2019-03-28 12:25:25'),
('f0c6f0490dd4d32b08a4d2f15b996258daed58e026d45da426da615211ec46a5d6987e5dafe62a9e', '5fb39ed2cb5efb98c4f7767d1202910618d5fb9e94c63ac275a4e3ed48ad4d4687741b83455bea9b', 0, '2019-10-02 07:42:19'),
('f0d8cbb1765edf7f47574d9236ba570c8f72baf5d5ea718d68ae8ee9b077b92f5d3e79f5744c3ea6', '1d643a4321c851045a57fb88701651e76ed1ed3d170c640c5072e01c5d662f7814ed843159f9cbcb', 0, '2019-10-12 06:19:18'),
('f15270e081034de17af04b83e039f69cb703a78ce6ab89d8ec473e402cd853eedab65dd899f3730d', 'c3b871ff4f1a02cc1e3484acc59a2c8d0be7bddca3c4cf564f459ce833a00347f133637ce0f43858', 0, '2019-10-12 03:28:17'),
('f1bea52ea1861f9bf26544f04b88d1e303c470f0c385ca3d44691c84e57e096aef103807380c224f', 'd63b02c00af5ff564b1e77516a74c5df3ce8cb7c9ec82c8b14ae5fe9958b817eabe4c204663774b5', 0, '2020-02-12 07:54:17'),
('f1d6cacc60e32d52c2783d9066428d426d94fa322e8d1fb5995234fa400ec79cd7e0dac8ae383fc7', 'f8bc8e374a4cdd49191ec77ac5ce6d660a39a697718eb6d6fed3a6a1840fd73ebeacf89d3f487ea7', 0, '2019-07-19 02:02:51'),
('f22388254b92c37cc7fad9fc1be270f568d7b58494b7ec9b214e7f209a0a5b730c53d61cb8473e14', 'f996a5a4653420d5381d29064b7d2e96dcbc33dce349d61c36f08e62826e194ac1afd4b5fc41dcab', 0, '2019-02-07 09:42:13'),
('f2670982c6cbc635810d7865ad7fb96260bd597085a69cdb124a131d84a51cd842dfad23c2916973', '65681ffe95278fe48bb4ed6a3c139714421cfb129184d0d66655274650d0c800aa05182c4d1c79b7', 0, '2020-05-16 13:17:44'),
('f269a67e4968af70e60ef7053d7d017feac466999e84a1e01ac5ed4fb92b17146ae662a700013f51', '092854461ca5862b3244b3c77ad6aa5ad102605fa805471e5b4a0b56d18dfa456176359d2672bbd3', 0, '2019-10-12 00:55:37'),
('f279ee0dd28b8080206ba01fe70e5179b57e9da20be85b1a4c235c1f586e116d9863674bff04e348', 'efa9ab80207f5c39e7d6ec5a180a0957cc84655ae7064035170beca3bcf3e581c70f0c1d01962c6b', 0, '2019-04-12 09:18:59'),
('f2c8bffeec6ff62c3eaa08bc685e0dd8d93de43562b45c8989a701bd619b3dfbe97b3fce7916ee2e', 'ebb621c3cf05b3866e1103f72f381e5a5a26f2ef8d835d7c256720cf69f73acc3d03d34afc0e24f5', 0, '2020-01-18 04:15:34'),
('f2f4c23f6a1b714e5911f04cdef0312b91ad43cb0e44766b53974e9e673217a95ffc493e9e39155c', 'fa424c434184af645d12f8798d5c4865b06560b64fe12415c51d7ff67d542b83b3b0ceffc150e97d', 0, '2019-04-02 06:04:11'),
('f3018dc387bdf0668882e184ac0888e6b221619a995c123d141f76c296df58f8488857aa9aa7a881', '0557e664d808e93fb225ffd741683db03a81e52fff03f945ca3579a74f4991dca16413de80b766c1', 0, '2019-04-18 12:55:28'),
('f30887a602b6c9a8bb4d4cf7d26e724fe4896a794b8c76f7d8bf81a158fb230aa25245bf5d2afc9b', 'cff248a6cec329e8ca8a02dd4184b6bf42142e56c28e50a1735f5e42c0f9625bb7e8ff147c74d7bd', 0, '2019-02-08 09:44:32'),
('f33eb79fca9bbdd3d1c29965ae39e7981937a5ce76ea9d3ad6c7b0dbff127b740a6a774081f023ff', '9af8a7e3c407599ce3db15df27b8302f1490862d1110a022be96687f0a4a7ca0e1567aa5ea652388', 0, '2019-03-27 07:37:05'),
('f35ba873e7094d0c22a585861b4cec5e17ea93f0aea285bda6e5a66f6dc42165a359efce982226de', '2b121b5794a4ca34347d5388c04da758a0d2565c36b7f23499d7d2cac2541f1f65d79302a0173658', 0, '2019-10-05 05:27:36'),
('f3745959decf4e484c455cecccc54cd2f97cb05e7cf303a9665997d2ed5986d47ed14f5834122023', '96e1e0427a48c136966b4737a517854adfde9bbd7b099a962e4f53dbc7c7efc3505f3ef4fa9ce994', 0, '2019-10-18 18:02:13'),
('f4136fd77c1f1346510d64b5ae0ef59c8642d933a4bd7c328324e4610e4707e61c700b331431e7e6', '2d18ccfa260341a1b7d522397bcb54767c758fae58dad699af37fffffb84db86a2a25439a78ab6b6', 0, '2020-02-11 06:06:08'),
('f421a4e22c7633851d4ba7dff082e8dec925f1c6cddfac528412a41fd8991cfaba9904743ce4675e', '2402ed1554dbb0c64e0d26709579a90a22c95faae896b78f71ff1b0fc3875fd8efa151908155fafb', 0, '2019-05-17 12:47:00'),
('f43c291457bbedcb1aef9dd0c79ae485ea44ecd9adb8e9d650d9f938557655053c10ccbe43b62cdf', 'a29f2a5dbf8f9e8928b190d01fe123f06bf2814772fb68ccaa3034d8270e42b4e53625d96dac92e0', 0, '2020-04-29 08:44:23'),
('f45e46f612af68d842b4a9925c8a7d9bdbaf4d7dcf6a1d2103f8df90ead13c03e7999c389926145c', '9624d7a546d639a51ba6ff3d28dc14a93eb5eb566dd96a510385f6134f8b3b1736afa03b75260a5b', 0, '2019-02-06 07:08:50'),
('f47c5201757f1c24a12adaa6f0643ca51ccfa0f50479bac57e28d6fcc488f2d5070560a92c2bc714', 'b7e12ca7d33390468c1719a0600b8e6d78e6f4c4f183daaa8e328b1c259a676b227ea82f3d31e456', 0, '2019-04-05 09:45:13'),
('f4a148c0ad3d08b6c3e52f8ffebb9160efb5f10b48b9be0e702ff5f4f77fe99dc1f733f86ff26cac', 'a6033abc068d444fc31967252358016b767a1847fc12a96b3b436d0eabe8332fd0565d2cae826a68', 0, '2019-03-28 07:12:58'),
('f4b7c0b66b94a46940ebb5081a217c13b98487541e6921e1fa43d6fb1261b8f3d66fc506e0d26c4a', '582b8a2d3095219ec7056721c10c789012f0384612a7a66c884cb50a10d86cf26de62289459aa733', 0, '2020-01-17 02:07:49'),
('f524946ea126fa9a6b80af8be95fae93f3faec58260aca6fc11e06222e189c313d573c4f6ef1c838', 'aae5011bb893c61d454b381e0771d4bfccb31177ce16ff45adb063f3803d5c482ab7fecae737eebf', 0, '2019-10-30 06:27:20'),
('f543c2f58dda8fbf45877defe4599ce6ff6ba91baec9475f5ddd3fc60a1d4c49824d82ba465c1bb5', 'cf55ef963abb2189e1d63ff97a6faa2cf8a5446574ded160257e3afae56c7cfa08de8bc697a3d3a4', 0, '2019-07-24 01:51:11'),
('f58451b227225ffb7481cf8b97ae0efda3105c5ec3053ccd2bf194707d0887ae8083884fda748f6e', '4801662bff3e2e812c75fcc3dfc3314fb0804b3856fd57bf01cb78dd56e81d7611da1a6307e25881', 0, '2019-02-08 10:35:51'),
('f5932d0a9e50fc28511a37524e8a5179c24e80b6ee3428f203188db81911156ffb2dc19cd35caef3', '7764824e5af787a6929dc43a1de6549c844052f26c4afdf2a9679bf7870f624e1265e4a210da7bcb', 0, '2019-02-13 16:40:24'),
('f59b09cfc7c8d8300fa46226a02e8f2df4e99fcc2f7cc62b9d86dff0d7014f00144e03f670051d89', '10318c491da99597567c944f6973345d416a9f09b21cb2afb6778334df4e00fa3044ff2714275ee7', 0, '2019-04-25 08:32:25'),
('f59be7090fdd865a4e5e67a163162a8d1df63d11c8269129a654a40c0eb328d7769568fb5b366683', '26f388c9b93c63d5a02a23543d47810b87e074aba0fd0ae30346991db5a36043299925ae7b326b57', 0, '2019-05-17 15:01:34'),
('f5c031dce7db113cc9edb12ab7ec5b36b89f2bdb9c0509b26cfc60c656e77fa6cfcbd5e09ba6a3c8', '32f458da1a8ef634ab6f0ce9606588d6bbad1136181f9b73e03505d615c89aa7091c9ce49cfe7ea8', 0, '2020-02-08 08:14:55'),
('f604ceae626edb5f3f6594a29f093a95211b6e987c01c1cf0d4708d4028a83e204740f4902e0aabd', 'e2aceaac667e0b037e82a487f9e5a32db72f881cc406fee0e896cbcbdc629118bf860c8ef3ea6e51', 0, '2020-05-15 11:37:22'),
('f60652455b4a37286a4f56bf1769c815edb436d02ea40d56a00a3b6ba9ef3fc51401a05b79a133f4', 'e6523ca26db3f61b6d261e8a1075590b6583f412e6b1032c5b5b96f431d99fccb301e97e9f912b42', 0, '2019-05-01 06:00:12'),
('f676d1c1428df2fb815e51299c4de5d2f9a6117f2b47a426613bac1c109de8e0078d1ec5c57f8eb7', '64cb273ae8560bf4b79031095e6e0efd42ddfdb25f120cbca56a6a4d9aa405a0005f52c471b60aae', 0, '2019-11-27 09:35:28'),
('f677857548f9265616290910faf40a8ec867109076b656f367affccade269f4e0711e9b66e5abfc5', '532268364f26f43dc9ba2cc3b2ae4e97b9ec3e876bd3361c205ad8239cbe22ce2b56fc583630111f', 0, '2019-04-10 05:06:32'),
('f67834a930bd5eb2b522277c7216dd4a9f65019c2b24bb96968ed3810fe13e9f5e7faa0a731de56c', 'e3be5bf03b66505c24272a908816af5b7cd09a884d4642a4e8f6ab6deb6464d080ab91bf9f868252', 0, '2020-01-09 04:54:42'),
('f6e4aba95db0112ce9944e6635b36ca8f3c25de7f22e19f66ec9c6cdba8accc83fbc6fdbf0e3bbc6', '286de73be631998d62451819ff7fb9b07e7a4ce5519393fefb45321aab9aae4d42ac867af592906c', 0, '2019-12-25 17:58:10'),
('f70e4afc4ca1cc055c43eb10d24d5be424028072c2cd7d8f5b9c66fa720a67de2949082c053672af', '71aeb7f48fa2c7d6b238c8579279d6cf2380656d03adec80bb32dcf6cac50007c73d76bef6a50974', 0, '2019-05-21 13:24:43'),
('f7227a3e1630ef2fd6292db759731a882ef1f1d091a3fad09b9c7dc8b5fc86ab93c4a5601e9c1c1c', 'fddf4da4dc8e7d60d9549e8a565c9f1e41633fde3569015d09b648a4958ca9602ac200f626ba5bf4', 0, '2019-03-30 08:19:00'),
('f729e227dad72d998b3c508f160a076efd97abc821108d710ec608809b1931dc5a1cca29329c714a', 'f7e54a02243fc7e88bf623558ead8bff1636b3b6f34d50e5f02689f2a3078711c79244fbb51ac6ca', 0, '2019-05-09 05:43:59'),
('f72eb3772a896591e58d98827e470722cf301736939898b7c85dd3bbc35a4f2e4eaa4b64a6580519', '0d54fa257d27c2fe308e37033a54198f2be95173e97c26c7a7ab0159ca4d3bbd3df02636f5bd53c8', 0, '2020-01-31 07:41:57'),
('f732402284386adf839c50c1fcab8aaee9ded6826e45a3d8801864ec2975e147f9d63d41e60a36c2', '2230fdb06400e0a268d0a9934942741bc6b2d8d03b86f2311a9263f01057870e5e8165e801aeac0c', 0, '2019-12-25 21:28:19'),
('f75da5e741f430140e39c53d9c8af0dadbcbc6fc9d1af8c8ae6b957b3e984d4b04dc944c47faf963', '17ce4fef1c64d7c8c6d24b59b4ba52bd05ea7a23c555c6a1bb7eafb518ee43743eca91908a204563', 0, '2019-10-12 00:47:29'),
('f7616e4f34d32021235f463ebd6abb8376cd92480f9b29387f2867173eb74bde73ee02def11a2613', 'e73d689c5ff55ae9db5530813ec54ce371e61f4369403e8450ae06413cdc80bb63037afe4ea2826f', 0, '2020-02-12 07:24:56'),
('f777221a674a59f87c1bb0fe9616615a1a4c9b7408b57fcbebc442915adaa2278750a5c1d41f2d92', 'd3170cda15d705c4e86151c2dcd839b671020e96ea2685e0fea3faa2d2bf98a2383eddcce22cc8cc', 0, '2019-02-15 13:39:50'),
('f77844e161895fd6ffef22945cbdcaf9dc07a91b921f34c1faa5ed7df9278c49106bd3068d8c5422', '4570d298462b27ad96509ee47ad3e692c582fc2a815bf2f2146def25d5ed425e177178723eba7348', 0, '2019-10-10 13:24:56'),
('f7c7ea0fd421e699cfd46cc5a36c9a5dcb7e709c8d669458d3fcb652becfcdd970d2add80090514b', '7b2ad36cc9bfb8b9231f7f9ef009d6a934cc34ce12d867120ceb99af1e65309725f8cea1e7c420f4', 0, '2019-07-25 08:31:57'),
('f818e70633a8ed33cd61d0462d3030498f8f5d9b05ad3244cb142a00fec3be0100ccafa24c646c44', 'c0c16c8e73d90000fd760b27585bd7f0cebf9f768e92c92de7b3c355da73b5f768b5429759fc6e83', 0, '2020-02-06 23:17:16'),
('f81e668ac9e733e2924cbba6bdab87f01eeecc5bc42ab286156d4eea53f68b5a251cb6cbf0cdaed5', 'd8c74bc11e2b468e65e8e93cb1fd61c1a2f0d957c326259873a65bcff27e3b7f921b05a595228472', 0, '2020-02-13 00:33:24'),
('f87083e4a9d317b173f3ab634aedad9fb1f7a3eb3f578d5d49892a4a3251bda49845e5898247a25d', '2d8f910cf4f4b44ca3bc0ea46da5b0fa7c34386a62f60c4990219363c69e3f53a3451c7776013da5', 0, '2020-02-12 04:36:56'),
('f871e78b1c947e70a8d85eb6726e6daa76261269d45e343afb4d337d5c204a64edbff53bd7581055', '1623df2ba6dadf9b304df3a4560bacaa8a57c5e8208e1012117703c9555854af3d5823ed1b2203b7', 0, '2019-04-27 11:54:27'),
('f8af33e9727acc62f50db0d4835217114e664f6737d507570cd5f54a6c3494663db8a5f9c13122f3', 'bd02275c413c0ecfb6c8fa509721bae4a796f9cbc4ee4be82275c288a717ed2b41359ee860d02405', 0, '2019-11-26 21:34:22'),
('f8b13ffded873e0becefe3081c96f8a629ad60419e95c249827b79b6d3a6863bd16b1b043c804c0a', '8e96a958dad6cffa212ff245a7fbeb16a6b158267dd800cb9b465f66c98616df0c4ceef42f29c6d6', 0, '2019-05-04 08:19:37'),
('f8cedb0101d2c03b721f2f6d4d2448b5ec3bf8f7aa74b22bc0b9bfdd5967b7d1c77b648c92010ddf', '7b81d9c798d813a6ec52065a73f6fbb08d77f10a7322deada235a8f19a3d770b953eda99c62e454b', 0, '2020-11-13 14:11:37'),
('f90702ac951597101ee70a4349a42bff99df2d851f22ca749c50d9f0739a96052665200736fec970', '6deb16440f1b5db31bbd9e72d3afe70d4ebb56aeb8100eb2c06dd62f9b525b5782deb55e24f675d8', 0, '2019-05-09 06:34:06'),
('f922978926a6b5cdddd7af3b91f72af3994556802d112fb78f78f990e1b25d8784382455f4bcc962', '4c949c300743d60397aceea6db2a5a676cc61d57780aec6430f84b80c8795ae28907a068e261b966', 0, '2019-02-06 13:55:33'),
('f923b6d8c33fe210c3416aea5fb02c7335b83029e8cd6137746ffa105166b295fc206cdb209013ed', 'd7224be43e12ff87dcf7840de05b76ca85326c5dd573ad9a765804e00e44993d60f5353dbb228967', 0, '2020-02-12 01:03:32'),
('f9a0e473e3f3ff5f46da0108bf44cbd1772764aaf06a745580a82399a89f1e168bfbba21dd385d46', '30ddf2df68d0036aef0f103699288d3d23dee0ba51ff5e849ee933293c11e75f0e3896f658de04e2', 0, '2020-02-13 00:22:14'),
('f9a6241247db149bf4ec64f079c7ab6005fa16dfcee4508408a7e6181f1a20e957056dfed21f1d82', '4b30d9b15b2653cf95219a7ae83c0433d1917595979c1241ed305ea849420a91a5e6af74f0ce96c3', 0, '2020-02-12 09:16:50'),
('f9e9ae95b4597143f13f70cbeacb17e11931d5b6d0bbdc32b9f45ad696ee668ed54f102ec67cda60', '50864ef365f65074ab92b521f72f6b2958c739afc720a67d76af8ed954af74157399c8b17b478d1c', 0, '2019-05-04 10:56:34'),
('fa26c97d93e9ff6537fa89322362784ccbd25b04411ae1db63080994914143f8e6d9d44e61b4d527', 'ab2d1c246c1e06c9a3b2c898dbaad958fcf2923b0d14f0645fa5fdaec2980f4f59f5406f9a6eee75', 0, '2019-05-14 11:46:09'),
('fa32bd897242cfd93c6c8024acbf8e3161c184519fb153c2464dba922e53fc94495ec2257131be3e', '296e27d0c430ae410a9d0ae98e242cec22f88da4f34e2256461e8ad5e83aaed0ff0d3c9cd1a5148c', 0, '2020-04-10 07:25:39'),
('fa61874f346584b453e01fa30beb168bba43f3cffe024e3fba4f28852fbb6f56f6e0a5024f50e23b', 'ba276c49466b3c0f1b361e0683bc19262a5ccef68e03d55c8840d351b5bca9bb0fa2abbbb4f3d8b2', 0, '2019-03-29 07:49:31'),
('fa7b0800d584ac9dd64d4152dc7c92a32fc2921d85bdc180bdeeb142e08009f371f225f0c6f142da', 'da5e430b7d3b1de888767670a0f6058074b3d45ee5a95a260d1d1d9c0e4512f41b8f48d174b1e1a8', 0, '2019-05-15 07:40:29'),
('fac5b588c525f012ebc80b719cb040908c87caee3df6daff4608fd3cb4c8946d4edd396a61f841ab', 'bc31c21e1f2b4e696820dc0eed518178567a5b71ed44fb2c9040062c409edca62f3b82013d623116', 0, '2019-02-13 05:14:30'),
('fad8f1528f43acb2356939e2d89083975abe932051c35c8e0978dca5b6cbe158312b9a08d8b0e00b', '097242c6ac0aa639fdb72181d07753d66fd740cd96b79009b455cdf81796d2e352a7109c08855e9d', 0, '2019-02-08 10:07:25'),
('fade85229c72b3da4654f36ff7edd770ff406d298bc52069349511a20642043a34ac6efbce761a40', '7cb1fcf77a5d874a16fe2ee627183439bbeca59575d31518eed0838314b3364f1afc40c203072ae6', 0, '2019-03-22 12:44:19'),
('fae7f384fa75f8f18a86167ef550d3c2637da77d1f5418c7c4207effa8578855da6d496a3b2d3d64', '4b8f3a8118b8a597edf772ff3108cf14801e51aa9799d71e3515e0ac937630cb17c0e2f428d332bd', 0, '2019-02-15 08:05:16'),
('fb1d45357542a33c90bd633d1ae09bf762c6421e7ff4c25d3bb59c347ce46f5ec1cd33b82a80968a', 'b57349fa6206a8ce58e3a517019f6718cf52611717a8f82950144390bf89fd6dbc575758eb655f1a', 0, '2019-02-12 11:56:02'),
('fb3ce3ec0ebe4fb7d644905ea8226dc673ec3bcaddd36dd316d35b44c23514846b14cdf83c79715d', 'da30fad17f42217fa2d41e5d65655716bf6c97556a2e46ab176a73cd8f1ba403f7e8084fa7f575be', 0, '2019-10-11 04:15:29'),
('fb585e318f1d92af12f121693c5a5292c2e2250a74c3ed0d395b3803e6b0103be2291ebd5f5fec83', 'e42b242401782bdc2990297948936004d1d3f7b57d3be1fc14e10f850eee95486319e8edbb3cd377', 0, '2019-02-08 11:50:23'),
('fb90c8c58030064884bec096a6b16988ee2f253de53ad28bdf40c8ab9957ed1c5b85bee75b0e2ac0', '51e828498b1b569fd485a41ce098eca05609f1d4d6c9b857126ffcf47292925911290a3b91836c63', 0, '2019-04-05 05:53:38'),
('fbb1086b6620249fa5a42b1ab6faa1090dd33b11f7671ae047c35dc87e44660e4c0f2c437a40088a', '87ffa1c034004e2f36b0698a1ad97ae375da36bf5d88a0654304db8ac8169893856f0c0be7880e61', 0, '2019-05-23 05:14:49'),
('fc16076ba27eee0bc025e09c970b3a9caf747c1397e875bad26dcbf9e1576d7cbfd8bcb897212c4c', '0d9b3b0deb587962d00db9da4bcbadbae140d807696f6b174cd45fbdd8c4d5370925842c82db6cd9', 0, '2019-11-14 17:43:19'),
('fc3dc180dc5f08a86d9e50f2e638eab28d1109404bf85cb436aaed7be68b6fe4eab92e7011922730', '7475b8624a6596fc854c74b447ff6304715cc1e9a9fa1b82913c266473dc7350e32a127a5482f6eb', 0, '2020-01-08 23:17:46'),
('fc91105262bd9735295b892b1711211811f74d9b53faf53cbe17c2b09debf3977a6fe47b906c3471', '2fcc05bfc1d2a8decddd5e3b7763453524e6242f2586c90f5cd677f433b7fd799af985e7d0ff94a4', 0, '2019-02-13 05:13:54'),
('fca87ca03d037946c0538c384a99187e805313f2ba6592402939adb01ef2afce7f2bf80cff8d8551', 'fc97de249ba489181cd44267511ba565e4ce4be1cf2a4ebf68dcf911e9819456abd1745a8ae53144', 0, '2020-02-05 01:08:31'),
('fcd3893429b393617726fa6ff5c0999fb079d72d9bba3f85fdef39f0d7048696ffc0de21c61553c5', '066b1470e74527fdd811d8ce216fa66582ae1c38dee660a1b475bcbe8e9c069098964d6fa67c7662', 0, '2019-06-29 11:25:04'),
('fcdd7c8ac38aeaed80410e411b3a24424758e46eca2f9ebf9e67652a94e6d445cf5333e9941b0d5f', '669723818a9d0a39404e27360cb005d507fbcb02acd14075ea0c24d8a9cbbff9464739563fbd6518', 0, '2019-11-27 11:36:39'),
('fcf6e2ba219943c4f32fc8eddc2a86050ae66dab62e853a0cd61f8067fb95c027f1525e53db3db83', 'ef5d8c5087d3bf0cb90c76a10d4ad6fc349921d644efd879a58bcc31b3157f4d7abfbf396c81ee67', 0, '2019-10-09 21:19:28'),
('fd01fa74e42a4c5b7ebe4da8f25916a302e1c3fd06ed78a49637b3918c279fd08a97baeefd7a2264', '8b5d7e4f74e3c75fde2bed084d9eaf3223151b0441e7308a99428fb523345340cab39b260b10fa1a', 0, '2019-05-04 06:19:05'),
('fd1ab521c1faaf2ba75eb7286ce039a85b28caddc72fbbe156a8336c7161324f75634420c2e3c5c5', '2b4b4b3cbd472ba6a8724e5665d136a244d032a058770521c646b4b216e559597691c0fd24b16249', 0, '2019-04-27 09:59:58');
INSERT INTO `oauth_refresh_tokens` (`id`, `access_token_id`, `revoked`, `expires_at`) VALUES
('fd44fc2ccb26c89951d473bd9e54f717852268f755ffa2bc66bfe481a658fa837c48f70631c66a23', 'b9e2cffba2dedf44be16c551e92be87519a0c2e0d4e7a36bab7f8547998f57c973f398c3c8dc2e6a', 0, '2019-04-19 06:40:05'),
('fd510d5eea5f15dcfe2bf2dd88530c6373ce59a46fdfe78008768920b8b388372709770af6f67a91', 'f8d95ff1afc0a355a6e7d59703999dd84b1f5ba73635952177153b69603e94062ac06b5a7311dea0', 0, '2019-04-02 05:26:26'),
('fd71cc2105d7f424af32e90de373f2e8b558abf0c6562312fb6916d0e9c0c9d22e44063c9c2737a1', '5c219310d92ae5018b12daefe5293ab8cead2244b723f1698fcd26f57cb369e2f22094ac6fd04a99', 0, '2020-02-14 06:27:25'),
('fde8317cff7895b9439cfc3390e7c224298b0e079f8aec151576b62e8d9984492edb38732b3ab4bf', 'e302c618b37c06c56a32dfdc82ba3d94960612fd4af945b68ccc230734d3ea8a6b8fd624b5fa36f4', 0, '2019-05-14 12:09:05'),
('fe375a7480f377fad19acb9b749effd2af834dab8a82ca53d9b87bb33ee8f6ba5278e20907f309b7', 'a660cfa45affaff6ba1dc2caecae10a26cd9e158d4d14402cc5bc54cfc82aa467719925333f9bd50', 0, '2019-06-12 14:18:29'),
('febb36916b0b7e2ef72fbcf758c67eb0facb9c064d7b056c2d1385d14efb938d41a680b40219766f', 'c05c05dd86b0f61fbaf503cdf0be79f7e49ee7348fdbaf6664dbf1bc7a53ef0a3b117904b0001a0f', 0, '2019-04-09 09:41:23'),
('fec06f3f74edb5ab88ea4a40e3a6e5edb527e5840a271f91228fe711e4a470087c838a09b76f9a3e', '8d0fa16ec0f31d12bf7af4baf61e2417fbff2140690fceb6dd3041642768e15fa1b3b176441f45e7', 0, '2019-02-06 07:05:44'),
('feeb591c76cacb9f60b885a8357e35201ce9e0a5d6a09e4bf715c43f4f31aa80b91aea1629020196', '4beb7a22d53f598172582e17d176a6535fa3175b3555c0f408b9e3d7be0ebf1b2ab8e10bd6c1a46f', 0, '2019-05-18 13:06:35'),
('feec320566ae61b1d8e9f945621431f8f999403991fe3841b36444a1d17993c750ac59f5926196c1', '7a11a3ff74592f6c5e8331851832c2664e8eedd6edd3b7aa59d0ff1f2a89825556b8de63bf018ab5', 0, '2019-05-18 05:10:33'),
('feeca4489b012d3b737706b699e79d3fe9945ed1bd76f0d67600e922fa419bbd3f3d89a6be170e51', '319951226c052bef252673fd6f35baa613e544562da3706f75f44b300ec034161cc25c2703ca4b25', 0, '2020-04-11 21:01:59'),
('ff04e48c159953984cd46ece740dbc95d09ba7fd8d0ea1b42fb18a409a74bb9a925bcb2fa9477ecc', '637a62927d246ba37135ee42c4baf200d2c14254a0dbdb398368c7dbc2525c257da3c8409c2593eb', 0, '2019-02-09 14:58:03'),
('ff18889fa356c2572b9e572a6dd44131b764aa437687cf8fd65ff88793a01ae6e4cdc61883d44007', 'c2038edf8837b0556d1ff74401cd9a6ac7bba7d9e55849fab761f7f3d04f8ec9e66626043108a1d5', 0, '2019-03-23 09:08:33'),
('ff8021f3539105b21edd324304fd8fc667b06b4e56c7ac32d4ce3363948f9dca7c266f4cdd4a323e', '92c0746adbdc1d83441e17acda0131c9a586114fd7e6ed95fb6edace9f890d112b82189d7b72b255', 0, '2020-06-25 02:24:42'),
('ff8989a668d886c9a2d2a2bc9fa5a26e5b36edd1d8738d4a7fcb49314a89a64d64b5f45fab2b978e', 'e5e5ef930a64138cb60576a6b4ef26b745b7aeb8680c3389b5710ce91884e066f31ea3eb5e2e66d3', 0, '2020-02-12 05:11:16'),
('ff8f235a80831b914541982046bfde425ccbc1d3a4ad7c01252d94c8b60e16d99d3156a1e2bddafc', '5ee8af6638c3bed3d46e1b7aa334b6882fb43d3d4a147b9d6dfd15e744704adb56a71c6cc0992d9c', 0, '2019-10-12 14:37:27'),
('ff9f8437518e5a73cce6c7f9ebebb98b73bc56ffb2ef65a17ef0a11b407c3f40ea4a2baeabf901e8', '6af62f977d69b86b4be30288134887ee6f68a9bd27ee46a4d6e5857c132ceb835d6e351241331b79', 0, '2020-03-20 19:41:54'),
('ffde0834c2b4a17f14a6284118967977da539a3ce39eb88f645105ce3c9181ae99cd351d182e4905', 'a1dadd8df6695097debb5b23b5cf0c4348dd8df6426c3bfe18c160b06728445e8296fa37e60daf56', 0, '2019-10-08 06:44:30'),
('ffe4c80ac48af907fae5c3d9f18f9c08937d9f179b75b001d627047dcf60e2e3a3dbd3ba081e636b', '4bfa3031a8a4c726960728a519f7ba9e660eb2cf655404aefa6b08944281549209292847260f1664', 0, '2019-02-07 11:04:57'),
('ffe7fdbb7bfe7e08fdf75402ba71f91bb305b7b389c31a250d5eb85ab33ee6132da7225784932c4b', '9b83a742de7c9502b8fd570244ab8edff0a06b7f8ae89077c6e1ee83a171ae8d23ec3b7f8ea6e411', 0, '2019-05-09 04:05:33');

-- --------------------------------------------------------

--
-- Table structure for table `operational_contacts`
--

CREATE TABLE `operational_contacts` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `post_code` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `operational_contacts`
--

INSERT INTO `operational_contacts` (`id`, `client_id`, `first_name`, `email`, `telephone`, `post_code`, `created_at`, `updated_at`) VALUES
(1, 1, 'Nangi', 'mangapanchu@gmail.com', '4168767055', NULL, '2019-10-10 11:09:44', '2019-10-10 11:09:44'),
(2, 2, 'maaga', 'mangapanchu@gmail.com', '4168767055', NULL, '2019-11-06 21:37:28', '2019-11-06 21:37:28'),
(3, 3, 'Nangi', 'mangapanchu@gmail.com', '4168767055', NULL, '2019-11-12 08:45:43', '2019-11-12 11:46:06'),
(4, 4, 'df', 'mangapanchu@gmail.com', '4168767055', NULL, '2019-11-12 10:55:18', '2019-11-12 10:55:18'),
(6, 8, 'wewewe', 'rachithamadhawa@gmail.com', '+94779605539', NULL, '2020-05-05 22:19:06', '2020-05-05 22:19:06'),
(7, 9, 'wewewe', 'rachithamadhawa@gmail.com', '+94779605539', NULL, '2020-05-05 22:29:51', '2020-05-05 22:29:51');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', NULL, '2020-05-20 09:30:05', NULL),
(2, 'Inventory', NULL, NULL, NULL),
(3, 'Assign tasks', NULL, '2020-05-20 09:30:44', '2020-05-20 09:30:44'),
(6, 'Complaints', '2020-05-13 11:57:44', '2020-05-13 11:57:44', NULL),
(9, 'Overview', '2020-05-14 03:22:53', '2020-05-14 03:23:23', NULL),
(10, 'Reports', '2020-05-14 03:24:30', '2020-05-14 03:24:30', NULL),
(11, 'Client Followups', '2020-05-20 09:32:24', '2020-05-20 09:32:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `id` int(11) NOT NULL,
  `permission_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(8, 2, 3, NULL, NULL, NULL),
(28, 6, 3, NULL, NULL, NULL),
(29, 9, 3, NULL, NULL, NULL),
(30, 10, 3, NULL, NULL, NULL),
(34, 1, 3, NULL, NULL, NULL),
(35, 1, 4, NULL, NULL, NULL),
(36, 1, 5, NULL, NULL, NULL),
(39, 11, 3, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `product_code` varchar(255) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `units` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `available` tinyint(1) DEFAULT 1,
  `shortage_alert` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `prospects`
--

CREATE TABLE `prospects` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `reference` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `sq_footage` varchar(255) DEFAULT NULL,
  `quote` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prospects`
--

INSERT INTO `prospects` (`id`, `first_name`, `last_name`, `telephone`, `mobile`, `address`, `email`, `reference`, `status`, `sq_footage`, `quote`, `created_at`, `updated_at`) VALUES
(1, 'Janaka', 'Codelantic Pvt. Ltd.', '0712345678', NULL, '21/1/1, Nelson Place, Wellawatthe', 'janaka@codelantic.com', 'Deep Cleaning', 'Sale Closed', NULL, '', '2019-10-22 07:32:57', '2020-01-21 04:20:54'),
(2, 'sandy', 'hyghy', '0344477777', '121313232', '\'njnk', 'start@sportsmeet.live', 'Regular Cleaning', 'Sale Closed', '555', '', '2019-10-29 03:20:12', '2020-01-21 04:08:40');

-- --------------------------------------------------------

--
-- Table structure for table `prospect_comments`
--

CREATE TABLE `prospect_comments` (
  `id` int(11) NOT NULL,
  `prospect_id` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `upload` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prospect_comments`
--

INSERT INTO `prospect_comments` (`id`, `prospect_id`, `admin_id`, `upload`, `date`, `comment`, `description`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '', '2020-01-21 03:56:49', 'asdfasdfasdf', 'asdfasdfasdf', '2020-01-21 03:56:49', '2020-01-21 03:56:49');

-- --------------------------------------------------------

--
-- Table structure for table `prospect_meetings`
--

CREATE TABLE `prospect_meetings` (
  `id` int(11) NOT NULL,
  `prospect_id` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prospect_meetings`
--

INSERT INTO `prospect_meetings` (`id`, `prospect_id`, `date`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, '2019-11-15 00:00:00', 'meet Jone for walkthrough and finalize the price', '2019-11-11 13:46:31', '2019-11-11 13:46:31');

-- --------------------------------------------------------

--
-- Table structure for table `query_log`
--

CREATE TABLE `query_log` (
  `id` int(11) NOT NULL,
  `sql` varchar(255) DEFAULT NULL,
  `bindings` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Super Admin', '2020-01-14 01:52:56', '2020-05-13 11:02:39', NULL),
(3, 'Admin', '2020-01-14 01:53:06', '2020-01-14 01:53:06', NULL),
(4, 'Cleaner', '2020-01-14 01:53:16', '2020-01-14 01:53:16', NULL),
(5, 'Inspector', '2020-01-14 01:53:25', '2020-01-14 01:53:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
  `repeat` tinyint(1) DEFAULT 0,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `repeat_mode` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `repeat`, `start_time`, `end_time`, `repeat_mode`, `created_at`, `updated_at`) VALUES
(1, 1, '2019-10-10 06:00:00', '2019-10-10 22:00:00', '0_1_2_3_4_5_6_', '2019-10-10 11:16:25', '2019-10-10 11:16:25'),
(2, 0, '2019-11-16 01:00:00', '2019-11-17 23:00:00', '6 months', '2019-11-11 11:01:28', '2019-11-11 11:01:28'),
(3, 1, '2019-11-12 04:00:00', '2019-11-12 23:00:00', '2_', '2019-11-12 08:49:43', '2019-11-12 08:49:43'),
(4, 0, '2019-11-13 06:56:00', '2019-11-13 22:56:00', '1 year', '2019-11-12 10:58:04', '2019-11-12 10:58:04'),
(5, 1, '2019-11-14 00:35:00', '2019-11-14 23:35:00', '5_', '2019-11-14 11:39:22', '2019-11-14 11:39:22'),
(6, 0, '2020-01-23 11:07:00', '2020-03-16 11:07:00', '3 months', '2020-01-03 00:37:58', '2020-01-03 00:37:58'),
(7, 0, '2020-05-21 08:02:00', '2020-05-31 20:02:00', NULL, '2020-05-20 22:34:29', '2020-05-20 22:34:29'),
(8, 0, '2020-05-21 08:07:00', '2020-06-02 20:07:00', NULL, '2020-05-20 22:37:33', '2020-05-20 22:37:33');

-- --------------------------------------------------------

--
-- Table structure for table `schedule_task`
--

CREATE TABLE `schedule_task` (
  `id` int(11) NOT NULL,
  `schedule_id` int(11) DEFAULT NULL,
  `task_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule_task`
--

INSERT INTO `schedule_task` (`id`, `schedule_id`, `task_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 5, NULL, NULL),
(3, 3, 6, NULL, NULL),
(4, 4, 7, NULL, NULL),
(5, 5, 10, NULL, NULL),
(6, 6, 11, NULL, NULL),
(7, 7, 17, NULL, NULL),
(8, 8, 18, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` int(11) NOT NULL,
  `added_date` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stock_product`
--

CREATE TABLE `stock_product` (
  `id` int(11) NOT NULL,
  `stock_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'ACTIVE',
  `notification` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `client_id`, `address`, `latitude`, `longitude`, `type`, `status`, `notification`, `created_at`, `updated_at`) VALUES
(1, 'Regular Cleaning', 5, '16, whitlock cres, ajax, l1z2b1', '43.8859407', '-79.0053025', NULL, 'ACTIVE', 0, '2019-10-10 11:16:25', '2020-04-13 22:01:04'),
(2, '1-2019-10-10 11:48:53-task', 1, '16, whitlock cres, ajax l1z2b1', '43.8859407', '-79.0053025', 'complaint', 'ACTIVE', 1, '2019-10-10 11:48:54', '2019-10-10 11:48:54'),
(3, '1-2019-10-29 01:41:08-task', 1, '16, whitlock cres, ajax l1z2b1', '43.8859407', '-79.0053025', 'complaint', 'ACTIVE', 1, '2019-10-29 01:41:09', '2019-10-29 01:41:09'),
(4, '1-2019-11-06 21:54:37-task', 1, '16, whitlock cres, ajax l1z2b1', '43.8859407', '-79.0053025', 'complaint', 'ACTIVE', 1, '2019-11-06 21:54:37', '2019-11-06 21:54:37'),
(5, 'Carpet Cleaning', 1, '16, whitlock cres, ajax, l1z2b1', '43.8859407', '-79.0053025', NULL, 'ACTIVE', 0, '2019-11-11 11:01:28', '2020-05-22 07:08:40'),
(6, 'Regular Cleaning', 3, '20, whitlock cres, ajax, l1z2b1', '43.8859978', '-79.0050079', NULL, 'ACTIVE', 0, '2019-11-12 08:49:43', '2020-04-13 22:01:06'),
(7, 'waxing', 4, '10, salem rd, ajax, l1z2b1', '43.862943', '-79.0165909', NULL, 'ACTIVE', 0, '2019-11-12 10:58:04', '2020-04-13 22:01:07'),
(8, '1-2019-11-13 11:18:41-task', 1, '16, whitlock cres, ajax l1z2b1', '43.8859407', '-79.0053025', 'complaint', 'ACTIVE', 1, '2019-11-13 11:18:43', '2019-11-13 11:18:43'),
(9, '1-2019-11-13 13:56:04-task', 1, '16, whitlock cres, ajax l1z2b1', '43.8859407', '-79.0053025', 'complaint', 'ACTIVE', 1, '2019-11-13 13:56:04', '2019-11-13 13:56:04'),
(10, 'Regular Cleaning', 2, '16, whitlock cres, ajax, l1z2b1', '43.8859407', '-79.0053025', NULL, 'ACTIVE', 0, '2019-11-14 11:39:22', '2020-04-13 22:01:08'),
(11, 'waxing', 1, '16, whitlock cres, ajax, l1z2b1', '43.8859407', '-79.0053025', NULL, 'ACTIVE', 0, '2020-01-03 00:37:58', '2020-05-22 07:08:41'),
(13, '11-2020-05-18 07:17:03-task', 1, '16, whitlock cres, ajax l1z2b1', '43', '-79', 'complaint', 'ACTIVE', 1, '2020-05-18 07:17:05', '2020-05-18 07:17:05'),
(14, '7-2020-05-19 03:02:35-task', 4, '10, salem rd, notajax l1z2b1', '41', '-73', 'complaint', 'ACTIVE', 1, '2020-05-19 03:02:36', '2020-05-19 03:02:36'),
(15, '11-2020-05-19 03:23:22-task', 1, '16, whitlock cres, ajax l1z2b1', '43', '-79', 'complaint', 'ACTIVE', 1, '2020-05-19 03:23:23', '2020-05-19 03:23:23'),
(16, '7-2020-05-19 03:25:30-task', 4, '10, salem rd, notajax l1z2b1', '41', '-73', 'complaint', 'ACTIVE', 1, '2020-05-19 03:25:32', '2020-05-19 03:25:32'),
(17, 'Carpet Cleaning', 1, '16, whitlock cres, ajax, l1z2b1', '43', '-79', NULL, 'ACTIVE', 1, '2020-05-20 22:34:29', '2020-05-20 22:34:29'),
(18, 'test 1', 2, 'whitlock cres, 10, ajax, l1z2b1', '43', '-79', NULL, 'ACTIVE', 1, '2020-05-20 22:37:33', '2020-05-20 22:37:33');

-- --------------------------------------------------------

--
-- Table structure for table `task_items`
--

CREATE TABLE `task_items` (
  `id` int(11) NOT NULL,
  `task_id` int(11) DEFAULT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `checked` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task_items`
--

INSERT INTO `task_items` (`id`, `task_id`, `name`, `checked`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Sweep Hallway', 1, '2019-10-10 11:16:25', '2019-11-14 10:35:13', NULL),
(2, 1, 'Dust desk and equipment', 1, '2019-10-10 11:16:25', '2019-11-14 10:35:13', NULL),
(3, 1, 'Clean dishes', 1, '2019-10-10 11:16:25', '2019-11-14 10:35:13', NULL),
(4, 1, 'remove garbage', 1, '2019-10-10 11:16:25', '2019-11-14 10:35:13', NULL),
(5, 1, 'Lock door and set alarm', 1, '2019-10-10 11:16:25', '2019-11-14 10:35:13', NULL),
(6, 2, 'dust on table', 0, '2019-10-10 11:48:54', '2019-10-10 11:48:54', NULL),
(7, 3, 'asdf', 0, '2019-10-29 01:41:09', '2019-10-29 01:41:09', NULL),
(8, 4, 'did not set alarm', 0, '2019-11-06 21:54:37', '2019-11-06 21:54:37', NULL),
(9, 5, 'clean carpet in front and back area', 0, '2019-11-11 11:01:28', '2019-11-11 11:01:28', NULL),
(10, 6, 'Dust wall and equipments', 1, '2019-11-12 08:49:43', '2019-11-12 11:01:12', NULL),
(11, 6, 'Vaccume floor', 1, '2019-11-12 08:49:43', '2019-11-12 11:01:12', NULL),
(12, 6, 'Empty garbage bin', 1, '2019-11-12 08:49:43', '2019-11-12 11:01:12', NULL),
(13, 7, 'wax front entrance', 0, '2019-11-12 10:58:04', '2019-11-12 10:58:04', NULL),
(14, 7, 'wax hall way', 0, '2019-11-12 10:58:04', '2019-11-12 10:58:04', NULL),
(15, 7, 'wax cafeteria', 0, '2019-11-12 10:58:04', '2019-11-12 10:58:04', NULL),
(16, 8, 'dust at front desk', 1, '2019-11-13 11:18:43', '2019-11-13 11:40:30', NULL),
(17, 9, 'Under table & chairs', 1, '2019-11-13 13:56:04', '2019-11-13 14:12:42', NULL),
(18, 10, 'sweep & mop floor', 0, '2019-11-14 11:39:22', '2019-11-14 11:39:22', NULL),
(19, 10, 'remove garbage', 0, '2019-11-14 11:39:22', '2019-11-14 11:39:22', NULL),
(20, 11, 'tesat', 0, '2020-01-03 00:37:58', '2020-01-03 00:37:58', NULL),
(21, 12, 'test', 0, '2020-05-14 07:25:48', '2020-05-14 07:25:48', NULL),
(22, 13, 'qwert', 0, '2020-05-18 07:17:06', '2020-05-18 07:17:06', NULL),
(23, 14, 'ewewe', 0, '2020-05-19 03:02:37', '2020-05-19 03:02:37', NULL),
(24, 15, 'ttttttttttttttttttttttttttttttt', 0, '2020-05-19 03:23:23', '2020-05-19 03:23:23', NULL),
(25, 16, 'qqqqqqqqqqqqqqqqqqqqqqq', 0, '2020-05-19 03:25:32', '2020-05-19 03:25:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `task_item_status`
--

CREATE TABLE `task_item_status` (
  `id` int(11) NOT NULL,
  `task_item_id` int(11) DEFAULT NULL,
  `schedule_task_id` int(11) DEFAULT NULL,
  `cleaner_schedule_id` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task_item_status`
--

INSERT INTO `task_item_status` (`id`, `task_item_id`, `schedule_task_id`, `cleaner_schedule_id`, `status`, `date`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'FINISHED', '2019-11-06 00:00:00', '2019-11-06 21:13:01', '2019-11-06 21:13:01'),
(2, 2, 1, 1, 'FINISHED', '2019-11-06 00:00:00', '2019-11-06 21:13:01', '2019-11-06 21:13:01'),
(3, 3, 1, 1, 'FINISHED', '2019-11-06 00:00:00', '2019-11-06 21:13:01', '2019-11-06 21:13:01'),
(4, 4, 1, 1, 'FINISHED', '2019-11-06 00:00:00', '2019-11-06 21:13:01', '2019-11-06 21:13:01'),
(5, 5, 1, 1, 'FINISHED', '2019-11-06 00:00:00', '2019-11-06 21:13:01', '2019-11-06 21:13:01'),
(6, 1, 1, 2, 'FINISHED', '2019-11-11 00:00:00', '2019-11-11 12:54:08', '2019-11-11 12:54:08'),
(7, 2, 1, 2, 'FINISHED', '2019-11-11 00:00:00', '2019-11-11 12:54:08', '2019-11-11 12:54:08'),
(8, 3, 1, 2, 'FINISHED', '2019-11-11 00:00:00', '2019-11-11 12:54:08', '2019-11-11 12:54:08'),
(9, 4, 1, 2, 'FINISHED', '2019-11-11 00:00:00', '2019-11-11 12:54:08', '2019-11-11 12:54:08'),
(10, 5, 1, 2, 'FINISHED', '2019-11-11 00:00:00', '2019-11-11 12:54:08', '2019-11-11 12:54:08'),
(11, 1, 1, 6, 'FINISHED', '2019-11-12 00:00:00', '2019-11-12 08:51:53', '2019-11-12 08:51:53'),
(12, 2, 1, 6, 'FINISHED', '2019-11-12 00:00:00', '2019-11-12 08:51:53', '2019-11-12 08:51:53'),
(13, 3, 1, 6, 'FINISHED', '2019-11-12 00:00:00', '2019-11-12 08:51:53', '2019-11-12 08:51:53'),
(14, 4, 1, 6, 'FINISHED', '2019-11-12 00:00:00', '2019-11-12 08:51:53', '2019-11-12 08:51:53'),
(15, 5, 1, 6, 'FINISHED', '2019-11-12 00:00:00', '2019-11-12 08:51:53', '2019-11-12 08:51:53'),
(16, 10, 3, 7, 'FINISHED', '2019-11-12 00:00:00', '2019-11-12 11:01:12', '2019-11-12 11:01:12'),
(17, 11, 3, 7, 'FINISHED', '2019-11-12 00:00:00', '2019-11-12 11:01:12', '2019-11-12 11:01:12'),
(18, 12, 3, 7, 'FINISHED', '2019-11-12 00:00:00', '2019-11-12 11:01:12', '2019-11-12 11:01:12'),
(19, 1, 1, 8, 'FINISHED', '2019-11-12 00:00:00', '2019-11-12 14:15:27', '2019-11-12 14:15:27'),
(20, 2, 1, 8, 'FINISHED', '2019-11-12 00:00:00', '2019-11-12 14:15:27', '2019-11-12 14:15:27'),
(21, 3, 1, 8, 'FINISHED', '2019-11-12 00:00:00', '2019-11-12 14:15:27', '2019-11-12 14:15:27'),
(22, 4, 1, 8, 'FINISHED', '2019-11-12 00:00:00', '2019-11-12 14:15:27', '2019-11-12 14:15:27'),
(23, 5, 1, 8, 'FINISHED', '2019-11-12 00:00:00', '2019-11-12 14:15:28', '2019-11-12 14:15:28'),
(24, 16, NULL, 9, 'FINISHED', '2019-11-13 00:00:00', '2019-11-13 11:35:47', '2019-11-13 11:35:47'),
(25, 16, NULL, 10, 'FINISHED', '2019-11-13 00:00:00', '2019-11-13 11:40:30', '2019-11-13 11:40:30'),
(26, 17, NULL, 11, 'FINISHED', '2019-11-13 00:00:00', '2019-11-13 14:12:42', '2019-11-13 14:12:42'),
(27, 1, 1, 12, 'FINISHED', '2019-11-14 00:00:00', '2019-11-14 10:35:13', '2019-11-14 10:35:13'),
(28, 2, 1, 12, 'FINISHED', '2019-11-14 00:00:00', '2019-11-14 10:35:13', '2019-11-14 10:35:13'),
(29, 3, 1, 12, 'FINISHED', '2019-11-14 00:00:00', '2019-11-14 10:35:13', '2019-11-14 10:35:13'),
(30, 4, 1, 12, 'FINISHED', '2019-11-14 00:00:00', '2019-11-14 10:35:13', '2019-11-14 10:35:13'),
(31, 5, 1, 12, 'FINISHED', '2019-11-14 00:00:00', '2019-11-14 10:35:13', '2019-11-14 10:35:13');

-- --------------------------------------------------------

--
-- Table structure for table `task_options`
--

CREATE TABLE `task_options` (
  `id` int(11) NOT NULL,
  `text` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task_options`
--

INSERT INTO `task_options` (`id`, `text`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Regular Cleaning', 'repeat', '2019-10-10 11:16:25', '2019-10-10 11:16:25'),
(2, 'Carpet Cleaning', 'single', '2019-11-11 11:01:28', '2019-11-11 11:01:28'),
(3, 'waxing', 'single', '2019-11-12 10:58:04', '2019-11-12 10:58:04'),
(4, 'test 1', 'single', '2020-05-20 22:37:33', '2020-05-20 22:37:33');

-- --------------------------------------------------------

--
-- Table structure for table `task_status`
--

CREATE TABLE `task_status` (
  `id` int(11) NOT NULL,
  `cleaner_schedule_id` int(11) DEFAULT NULL,
  `schedule_task_id` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task_status`
--

INSERT INTO `task_status` (`id`, `cleaner_schedule_id`, `schedule_task_id`, `status`, `date`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'STARTED', '2019-11-06 21:10:25', '2019-11-06 21:10:25', '2019-11-06 21:10:25'),
(2, 1, 1, 'FINISHED', '2019-11-06 21:13:16', '2019-11-06 21:13:16', '2019-11-06 21:13:16'),
(3, 2, 1, 'STARTED', '2019-11-11 12:29:08', '2019-11-11 12:29:08', '2019-11-11 12:29:08'),
(4, 2, 1, 'FINISHED', '2019-11-11 12:54:32', '2019-11-11 12:54:32', '2019-11-11 12:54:32'),
(5, 3, 1, 'STARTED', '2019-11-11 13:04:34', '2019-11-11 13:04:34', '2019-11-11 13:04:34'),
(6, 4, 1, 'STARTED', '2019-11-11 13:06:55', '2019-11-11 13:06:55', '2019-11-11 13:06:55'),
(7, 5, 1, 'STARTED', '2019-11-11 13:10:00', '2019-11-11 13:10:00', '2019-11-11 13:10:00'),
(8, 6, 1, 'STARTED', '2019-11-12 08:51:43', '2019-11-12 08:51:43', '2019-11-12 08:51:43'),
(9, 6, 1, 'FINISHED', '2019-11-12 08:51:59', '2019-11-12 08:51:59', '2019-11-12 08:51:59'),
(10, 7, 3, 'STARTED', '2019-11-12 09:51:39', '2019-11-12 09:51:39', '2019-11-12 09:51:39'),
(11, 7, 3, 'FINISHED', '2019-11-12 11:01:15', '2019-11-12 11:01:15', '2019-11-12 11:01:15'),
(12, 8, 1, 'STARTED', '2019-11-12 14:13:10', '2019-11-12 14:13:10', '2019-11-12 14:13:10'),
(13, 8, 1, 'FINISHED', '2019-11-12 14:15:32', '2019-11-12 14:15:32', '2019-11-12 14:15:32'),
(14, 9, NULL, 'STARTED', '2019-11-13 11:35:09', '2019-11-13 11:35:09', '2019-11-13 11:35:09'),
(15, 9, NULL, 'FINISHED', '2019-11-13 11:35:54', '2019-11-13 11:35:54', '2019-11-13 11:35:54'),
(16, 10, NULL, 'STARTED', '2019-11-13 11:40:24', '2019-11-13 11:40:24', '2019-11-13 11:40:24'),
(17, 10, NULL, 'FINISHED', '2019-11-13 11:40:34', '2019-11-13 11:40:34', '2019-11-13 11:40:34'),
(18, 11, NULL, 'STARTED', '2019-11-13 14:12:33', '2019-11-13 14:12:33', '2019-11-13 14:12:33'),
(19, 11, NULL, 'FINISHED', '2019-11-13 14:12:48', '2019-11-13 14:12:48', '2019-11-13 14:12:48'),
(20, 12, 1, 'STARTED', '2019-11-14 10:35:08', '2019-11-14 10:35:08', '2019-11-14 10:35:08'),
(21, 12, 1, 'FINISHED', '2019-11-14 10:38:04', '2019-11-14 10:38:04', '2019-11-14 10:38:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `status` varchar(10) DEFAULT 'ACTIVE',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `username`, `password`, `role`, `remember_token`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 'SuperAdmin', 'admin@fbm.com', 'admin', '$2y$10$s8ngFrjVqSXj71Oz1D8tYOEuFNjJnmmPJrxHFBzPzvohA0DBD3ace', 'ADMIN', '3mRBwISWtYQJHj4wXFWAw3FP5rmmtNpl2TFuRpyVdF4YEnpb6nAhlaUEVNlF', 'ACTIVE', '2018-08-28 05:00:24', '2018-10-15 05:27:39', NULL),
(2, NULL, 'mangavimal', 'mangapanchu@gmail.com', 'mangavimal', '$2y$10$2aETrzL3z39TeqOOSwOGgOSfxzRkGFJ70A1iMmEen3S.alEYduPbS', 'CLEANER', NULL, 'ACTIVE', '2019-10-10 10:30:11', '2019-11-06 21:51:46', NULL),
(3, NULL, 'vimalmuthu', 'vimal26@hotmail.com', 'vimalmuthu', '$2y$10$jLJSh3IwOJ2yl1oYXswY.e4websls2ZEwclzeNYVDpp4ZGzUyfh22', 'INSPECTOR_1', NULL, 'ACTIVE', '2019-10-10 10:47:54', '2019-11-13 12:06:02', NULL),
(4, NULL, 'Janaka Dombawela', 'janaka@codelantic.com', 'Janaka Dombawela', '$2y$10$5FY5ORyEyXTGK/wG7ure4.85rhNbmvzwSg2ywdHWXCqxLQQHD/hbi', 'CLEANER', NULL, 'ACTIVE', '2019-10-29 03:31:16', '2019-10-29 03:31:16', NULL),
(5, NULL, 'wwwe wwwe', 'www@gmail.com', 'wwwe wwwe', '$2y$10$xbrN5ZVCaQYcLZKGGQO16OfnWB1lFf/fcO1yXQcbl6inHCDN9Yaaq', 'CLEANER', NULL, 'ACTIVE', '2019-10-29 03:33:42', '2019-10-29 03:33:42', NULL),
(6, NULL, 'aaae wwwe', 'www@gmrail.com', 'aaae wwwe', '$2y$10$GzS25kSkg6oG1mBNpquGu.H.QZWvzunOaXPB3yh0Gh2SILS2.6LGe', 'CLEANER', NULL, 'ACTIVE', '2019-10-29 04:47:59', '2020-04-11 22:55:52', '2020-04-11 22:55:52'),
(7, NULL, 'janaka yy', 'sect@sportsmeet.live', 'janaka yy', '$2y$10$I/FIDudjnX88JmdSVU5Cl.MU7WBhJ8yHCiLQH8EJBa6dbEfbK5s1q', 'CLEANER', NULL, 'ACTIVE', '2019-10-29 04:53:08', '2020-05-13 23:31:32', '2020-05-13 23:31:32'),
(8, NULL, 'sandy@gmail.com', 'janakagg@codelantic.com', 'sandy@gmail.com', '$2y$10$eI8FvdrATNAMymjChCLP2ewYOmmaNw9GxEcHcgDXXlHLDGKwKIZCq', 'INSPECTOR_1', NULL, 'ACTIVE', '2019-10-29 04:55:12', '2019-10-29 06:34:55', NULL),
(9, NULL, 'john', 'nangi999@yahoo.com', 'john', '$2y$10$Rb1cDcTe5QYqnudQyXMqbemWV..sJ3lTmUnGmIddAKy7RXLy095/e', 'INSPECTOR_2', NULL, 'ACTIVE', '2019-11-06 21:25:24', '2019-11-14 11:33:22', NULL),
(13, 3, 'test', 'rachithamadhawa@gmail.com', NULL, '$2y$10$fYrud8MlKK9EqYqNMeezTeJzeP01UGHSzuHVyN3YP3RPy0yWBgHRW', 'ADMIN', NULL, 'ACTIVE', '2020-05-12 23:22:56', '2020-05-12 23:22:56', NULL),
(14, 3, 'test', 'rachitha@codelantic.com', NULL, '$2y$10$mBsaO8Jz1KTfEd6I7LKQ5OezuDL5z4lCcOr8Kw9MJhk49oZxAXhUq', 'ADMIN', NULL, 'ACTIVE', '2020-05-13 00:06:01', '2020-05-14 07:42:13', '2020-05-14 07:42:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounting_contacts`
--
ALTER TABLE `accounting_contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accounting_contacts_clients_id_fk` (`client_id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admins_users_id_fk` (`user_id`);

--
-- Indexes for table `alerts`
--
ALTER TABLE `alerts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `checklists`
--
ALTER TABLE `checklists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `checklists_categories_categories_fk` (`category_id`);

--
-- Indexes for table `checklist_items`
--
ALTER TABLE `checklist_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `checklist_items_checklists_id_fk` (`checklist_id`);

--
-- Indexes for table `checklist_item_feedbacks`
--
ALTER TABLE `checklist_item_feedbacks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `checklist_item_feedbacks_checklist_items_id_fk` (`checklist_item_id`),
  ADD KEY `checklist_item_feedbacks_inspector_schedules_id_fk` (`inspector_schedule_id`),
  ADD KEY `checklist_item_feedbacks_inspectors_id_fk` (`inspector_id`),
  ADD KEY `checklist_item_feedbacks_tasks_id_fk` (`task_id`);

--
-- Indexes for table `checklist_item_feedback_media`
--
ALTER TABLE `checklist_item_feedback_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `checklist_item_feedback_media_checklist_item_feedbacks_id_fk` (`checklist_item_feedback_id`),
  ADD KEY `checklist_item_feedback_media_media_id_fk` (`media_id`);

--
-- Indexes for table `cleaners`
--
ALTER TABLE `cleaners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cleaners_users_id_fk` (`user_id`);

--
-- Indexes for table `cleaner_alert`
--
ALTER TABLE `cleaner_alert`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cleaner_alert_alerts_id_fk` (`alert_id`),
  ADD KEY `cleaner_alert_cleaners_id_fk` (`cleaner_id`);

--
-- Indexes for table `cleaner_check_lists`
--
ALTER TABLE `cleaner_check_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cleaner_check_lists_client_id_foreign` (`client_id`);

--
-- Indexes for table `cleaner_check_list_items`
--
ALTER TABLE `cleaner_check_list_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cleaner_check_list_items_checklist_id_foreign` (`checklist_id`);

--
-- Indexes for table `cleaner_schedules`
--
ALTER TABLE `cleaner_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cleaner_schedules_cleaners_id_fk` (`cleaner_id`),
  ADD KEY `cleaner_schedules_tasks_id_fk` (`task_id`);

--
-- Indexes for table `cleaner_schedule_audio`
--
ALTER TABLE `cleaner_schedule_audio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cleaner_schedule_audio_cleaner_schedules_id_fk` (`cleaner_schedule_id`);

--
-- Indexes for table `cleaner_schedule_media`
--
ALTER TABLE `cleaner_schedule_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cleaner_schedule_media_cleaner_schedules_id_fk` (`cleaner_schedule_id`),
  ADD KEY `cleaner_schedule_media_media_id_fk` (`media_id`),
  ADD KEY `cleaner_schedule_media_task_items_id_fk` (`task_item_id`);

--
-- Indexes for table `cleaner_schedule_product`
--
ALTER TABLE `cleaner_schedule_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cleaner_schedule_product_cleaner_schedules_id_fk` (`cleaner_schedule_id`),
  ADD KEY `cleaner_schedule_product_products_id_fk` (`product_id`);

--
-- Indexes for table `cleaner_task`
--
ALTER TABLE `cleaner_task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cleaner_task_cleaners_id_fk` (`cleaner_id`),
  ADD KEY `cleaner_task_tasks_id_fk` (`task_id`);

--
-- Indexes for table `cleaner_times`
--
ALTER TABLE `cleaner_times`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cleaner_times_client_id_foreign` (`client_id`),
  ADD KEY `cleaner_times_cleaner_id_foreign` (`cleaner_id`),
  ADD KEY `cleaner_times_client_sub_id_foreign` (`client_sub_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clients_categories_id_fk` (`category_id`);

--
-- Indexes for table `client_followups`
--
ALTER TABLE `client_followups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_followups_admins_id_fk` (`admin_id`),
  ADD KEY `client_followups_clients_id_fk` (`client_id`);

--
-- Indexes for table `client_followup_comments`
--
ALTER TABLE `client_followup_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_followup_comments_admins_id_fk` (`admin_id`),
  ADD KEY `client_followup_comments_client_followups_id_fk` (`client_followup_id`);

--
-- Indexes for table `client_product`
--
ALTER TABLE `client_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_product_clients_id_fk` (`client_id`),
  ADD KEY `client_product_products_id_fk` (`product_id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`),
  ADD KEY `complaints_cleaners_id_fk` (`cleaner_id`),
  ADD KEY `complaints_inspectors_id_fk` (`inspector_id`),
  ADD KEY `complaints_tasks_id_fk` (`task_id`);

--
-- Indexes for table `complaint_followups`
--
ALTER TABLE `complaint_followups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `complaint_followups_admins_id_fk` (`admin_id`),
  ADD KEY `complaint_followups_complaints_id_fk` (`complaint_id`),
  ADD KEY `complaint_followups_inspectors_id_fk` (`inspector_id`);

--
-- Indexes for table `complaint_media`
--
ALTER TABLE `complaint_media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `complaint_media_complaints_id_fk` (`complaint_id`),
  ADD KEY `complaint_media_media_id_fk` (`media_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feedback_tasks_id_fk` (`task_id`),
  ADD KEY `feedback_cleaners_id_fk` (`cleaner_id`),
  ADD KEY `feedback_inspectors_id_fk` (`inspector_id`);

--
-- Indexes for table `followups`
--
ALTER TABLE `followups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `followups_admins_id_fk` (`admin_id`),
  ADD KEY `followups_clients_id_fk` (`client_id`),
  ADD KEY `followups_inspectors_id_fk` (`inspector_id`);

--
-- Indexes for table `followup_comments`
--
ALTER TABLE `followup_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `followup_comments_admins_id_fk` (`admin_id`),
  ADD KEY `followup_comments_followups_id_fk` (`followup_id`),
  ADD KEY `followup_comments_inspectors_id_fk` (`inspector_id`);

--
-- Indexes for table `inspectors`
--
ALTER TABLE `inspectors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inspectors_users_id_fk` (`user_id`);

--
-- Indexes for table `inspector_alert`
--
ALTER TABLE `inspector_alert`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inspector_alert_alerts_id_fk` (`alert_id`),
  ADD KEY `inspector_alert_inspectors_id_fk` (`inspector_id`);

--
-- Indexes for table `inspector_schedules`
--
ALTER TABLE `inspector_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inspector_schedules_inspectors_id_fk` (`inspector_id`),
  ADD KEY `inspector_schedules_tasks_id_fk` (`task_id`);

--
-- Indexes for table `inspector_task`
--
ALTER TABLE `inspector_task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inspector_task_inspectors_id_fk` (`inspector_id`),
  ADD KEY `inspector_task_tasks_id_fk` (`task_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `operational_contacts`
--
ALTER TABLE `operational_contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `operational_contacts_clients_id_fk` (`client_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_role_permissions_id_fk` (`permission_id`),
  ADD KEY `permission_role_roles_id_fk` (`role_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prospects`
--
ALTER TABLE `prospects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prospect_comments`
--
ALTER TABLE `prospect_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prospect_comments_admins_id_fk` (`admin_id`),
  ADD KEY `prospect_comments_prospects_id_fk` (`prospect_id`);

--
-- Indexes for table `prospect_meetings`
--
ALTER TABLE `prospect_meetings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prospect_meetings_prospects_id_fk` (`prospect_id`);

--
-- Indexes for table `query_log`
--
ALTER TABLE `query_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_task`
--
ALTER TABLE `schedule_task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schedule_task_schedules_id_fk` (`schedule_id`),
  ADD KEY `schedule_task_tasks_id_fk` (`task_id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_product`
--
ALTER TABLE `stock_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_product_products_id_fk` (`product_id`),
  ADD KEY `stock_product_stocks_id_fk` (`stock_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_clients_id_fk` (`client_id`);

--
-- Indexes for table `task_items`
--
ALTER TABLE `task_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_items_tasks_id_fk` (`task_id`);

--
-- Indexes for table `task_item_status`
--
ALTER TABLE `task_item_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_item_status_cleaner_schedules_id_fk` (`cleaner_schedule_id`),
  ADD KEY `task_item_status_schedule_task_id_fk` (`schedule_task_id`),
  ADD KEY `task_item_status_task_items_id_fk` (`task_item_id`);

--
-- Indexes for table `task_options`
--
ALTER TABLE `task_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_status`
--
ALTER TABLE `task_status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_status_cleaner_schedules_id_fk` (`cleaner_schedule_id`),
  ADD KEY `task_status_schedule_task_id_fk` (`schedule_task_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounting_contacts`
--
ALTER TABLE `accounting_contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `alerts`
--
ALTER TABLE `alerts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `checklists`
--
ALTER TABLE `checklists`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `checklist_items`
--
ALTER TABLE `checklist_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `checklist_item_feedbacks`
--
ALTER TABLE `checklist_item_feedbacks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `checklist_item_feedback_media`
--
ALTER TABLE `checklist_item_feedback_media`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cleaners`
--
ALTER TABLE `cleaners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cleaner_alert`
--
ALTER TABLE `cleaner_alert`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cleaner_check_lists`
--
ALTER TABLE `cleaner_check_lists`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cleaner_check_list_items`
--
ALTER TABLE `cleaner_check_list_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cleaner_schedules`
--
ALTER TABLE `cleaner_schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `cleaner_schedule_audio`
--
ALTER TABLE `cleaner_schedule_audio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cleaner_schedule_media`
--
ALTER TABLE `cleaner_schedule_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cleaner_schedule_product`
--
ALTER TABLE `cleaner_schedule_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cleaner_task`
--
ALTER TABLE `cleaner_task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `cleaner_times`
--
ALTER TABLE `cleaner_times`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `client_followups`
--
ALTER TABLE `client_followups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `client_followup_comments`
--
ALTER TABLE `client_followup_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `client_product`
--
ALTER TABLE `client_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `complaint_followups`
--
ALTER TABLE `complaint_followups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `complaint_media`
--
ALTER TABLE `complaint_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `followups`
--
ALTER TABLE `followups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `followup_comments`
--
ALTER TABLE `followup_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inspectors`
--
ALTER TABLE `inspectors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `inspector_alert`
--
ALTER TABLE `inspector_alert`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `inspector_schedules`
--
ALTER TABLE `inspector_schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `inspector_task`
--
ALTER TABLE `inspector_task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `operational_contacts`
--
ALTER TABLE `operational_contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prospects`
--
ALTER TABLE `prospects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `prospect_comments`
--
ALTER TABLE `prospect_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `prospect_meetings`
--
ALTER TABLE `prospect_meetings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `query_log`
--
ALTER TABLE `query_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `schedule_task`
--
ALTER TABLE `schedule_task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_product`
--
ALTER TABLE `stock_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `task_items`
--
ALTER TABLE `task_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `task_item_status`
--
ALTER TABLE `task_item_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `task_options`
--
ALTER TABLE `task_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `task_status`
--
ALTER TABLE `task_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounting_contacts`
--
ALTER TABLE `accounting_contacts`
  ADD CONSTRAINT `accounting_contacts_clients_id_fk` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`);

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_users_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `checklists`
--
ALTER TABLE `checklists`
  ADD CONSTRAINT `checklists_categories_categories_fk` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `checklist_items`
--
ALTER TABLE `checklist_items`
  ADD CONSTRAINT `checklist_items_checklists_id_fk` FOREIGN KEY (`checklist_id`) REFERENCES `checklists` (`id`);

--
-- Constraints for table `checklist_item_feedbacks`
--
ALTER TABLE `checklist_item_feedbacks`
  ADD CONSTRAINT `checklist_item_feedbacks_checklist_items_id_fk` FOREIGN KEY (`checklist_item_id`) REFERENCES `checklist_items` (`id`),
  ADD CONSTRAINT `checklist_item_feedbacks_inspector_schedules_id_fk` FOREIGN KEY (`inspector_schedule_id`) REFERENCES `inspector_schedules` (`id`),
  ADD CONSTRAINT `checklist_item_feedbacks_inspectors_id_fk` FOREIGN KEY (`inspector_id`) REFERENCES `inspectors` (`id`),
  ADD CONSTRAINT `checklist_item_feedbacks_tasks_id_fk` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`);

--
-- Constraints for table `cleaners`
--
ALTER TABLE `cleaners`
  ADD CONSTRAINT `cleaners_users_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `cleaner_alert`
--
ALTER TABLE `cleaner_alert`
  ADD CONSTRAINT `cleaner_alert_alerts_id_fk` FOREIGN KEY (`alert_id`) REFERENCES `alerts` (`id`),
  ADD CONSTRAINT `cleaner_alert_cleaners_id_fk` FOREIGN KEY (`cleaner_id`) REFERENCES `cleaners` (`id`);

--
-- Constraints for table `cleaner_check_lists`
--
ALTER TABLE `cleaner_check_lists`
  ADD CONSTRAINT `cleaner_check_lists_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cleaner_check_list_items`
--
ALTER TABLE `cleaner_check_list_items`
  ADD CONSTRAINT `cleaner_check_list_items_checklist_id_foreign` FOREIGN KEY (`checklist_id`) REFERENCES `cleaner_check_lists` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cleaner_schedules`
--
ALTER TABLE `cleaner_schedules`
  ADD CONSTRAINT `cleaner_schedules_cleaners_id_fk` FOREIGN KEY (`cleaner_id`) REFERENCES `cleaners` (`id`),
  ADD CONSTRAINT `cleaner_schedules_tasks_id_fk` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`);

--
-- Constraints for table `cleaner_schedule_audio`
--
ALTER TABLE `cleaner_schedule_audio`
  ADD CONSTRAINT `cleaner_schedule_audio_cleaner_schedules_id_fk` FOREIGN KEY (`cleaner_schedule_id`) REFERENCES `cleaner_schedules` (`id`);

--
-- Constraints for table `cleaner_schedule_media`
--
ALTER TABLE `cleaner_schedule_media`
  ADD CONSTRAINT `cleaner_schedule_media_cleaner_schedules_id_fk` FOREIGN KEY (`cleaner_schedule_id`) REFERENCES `cleaner_schedules` (`id`),
  ADD CONSTRAINT `cleaner_schedule_media_media_id_fk` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`),
  ADD CONSTRAINT `cleaner_schedule_media_task_items_id_fk` FOREIGN KEY (`task_item_id`) REFERENCES `task_items` (`id`);

--
-- Constraints for table `cleaner_schedule_product`
--
ALTER TABLE `cleaner_schedule_product`
  ADD CONSTRAINT `cleaner_schedule_product_cleaner_schedules_id_fk` FOREIGN KEY (`cleaner_schedule_id`) REFERENCES `cleaner_schedules` (`id`),
  ADD CONSTRAINT `cleaner_schedule_product_products_id_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `cleaner_task`
--
ALTER TABLE `cleaner_task`
  ADD CONSTRAINT `cleaner_task_cleaners_id_fk` FOREIGN KEY (`cleaner_id`) REFERENCES `cleaners` (`id`),
  ADD CONSTRAINT `cleaner_task_tasks_id_fk` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`);

--
-- Constraints for table `cleaner_times`
--
ALTER TABLE `cleaner_times`
  ADD CONSTRAINT `cleaner_times_cleaner_id_foreign` FOREIGN KEY (`cleaner_id`) REFERENCES `cleaners` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cleaner_times_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cleaner_times_client_sub_id_foreign` FOREIGN KEY (`client_sub_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_categories_id_fk` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `client_followup_comments`
--
ALTER TABLE `client_followup_comments`
  ADD CONSTRAINT `client_followup_comments_admins_id_fk` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `client_followup_comments_client_followups_id_fk` FOREIGN KEY (`client_followup_id`) REFERENCES `client_followups` (`id`);

--
-- Constraints for table `client_product`
--
ALTER TABLE `client_product`
  ADD CONSTRAINT `client_product_clients_id_fk` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `client_product_products_id_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `complaints`
--
ALTER TABLE `complaints`
  ADD CONSTRAINT `complaints_cleaners_id_fk` FOREIGN KEY (`cleaner_id`) REFERENCES `cleaners` (`id`),
  ADD CONSTRAINT `complaints_inspectors_id_fk` FOREIGN KEY (`inspector_id`) REFERENCES `inspectors` (`id`),
  ADD CONSTRAINT `complaints_tasks_id_fk` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`);

--
-- Constraints for table `complaint_followups`
--
ALTER TABLE `complaint_followups`
  ADD CONSTRAINT `complaint_followups_admins_id_fk` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `complaint_followups_complaints_id_fk` FOREIGN KEY (`complaint_id`) REFERENCES `complaints` (`id`),
  ADD CONSTRAINT `complaint_followups_inspectors_id_fk` FOREIGN KEY (`inspector_id`) REFERENCES `inspectors` (`id`);

--
-- Constraints for table `complaint_media`
--
ALTER TABLE `complaint_media`
  ADD CONSTRAINT `complaint_media_complaints_id_fk` FOREIGN KEY (`complaint_id`) REFERENCES `complaints` (`id`),
  ADD CONSTRAINT `complaint_media_media_id_fk` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_cleaners_a_id_fk` FOREIGN KEY (`cleaner_id`) REFERENCES `cleaners` (`id`),
  ADD CONSTRAINT `feedback_inspectors_a_id_fk` FOREIGN KEY (`inspector_id`) REFERENCES `inspectors` (`id`),
  ADD CONSTRAINT `feedback_tasks_a_id_fk` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`),
  ADD CONSTRAINT `feedback_tasks_id_fk` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`);

--
-- Constraints for table `followup_comments`
--
ALTER TABLE `followup_comments`
  ADD CONSTRAINT `followup_comments_admins_id_fk` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `followup_comments_followups_id_fk` FOREIGN KEY (`followup_id`) REFERENCES `followups` (`id`),
  ADD CONSTRAINT `followup_comments_inspectors_id_fk` FOREIGN KEY (`inspector_id`) REFERENCES `inspectors` (`id`);

--
-- Constraints for table `inspectors`
--
ALTER TABLE `inspectors`
  ADD CONSTRAINT `inspectors_users_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `inspector_alert`
--
ALTER TABLE `inspector_alert`
  ADD CONSTRAINT `inspector_alert_alerts_id_fk` FOREIGN KEY (`alert_id`) REFERENCES `alerts` (`id`),
  ADD CONSTRAINT `inspector_alert_inspectors_id_fk` FOREIGN KEY (`inspector_id`) REFERENCES `inspectors` (`id`);

--
-- Constraints for table `inspector_schedules`
--
ALTER TABLE `inspector_schedules`
  ADD CONSTRAINT `inspector_schedules_inspectors_id_fk` FOREIGN KEY (`inspector_id`) REFERENCES `inspectors` (`id`),
  ADD CONSTRAINT `inspector_schedules_tasks_id_fk` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`);

--
-- Constraints for table `inspector_task`
--
ALTER TABLE `inspector_task`
  ADD CONSTRAINT `inspector_task_inspectors_id_fk` FOREIGN KEY (`inspector_id`) REFERENCES `inspectors` (`id`),
  ADD CONSTRAINT `inspector_task_tasks_id_fk` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`);

--
-- Constraints for table `operational_contacts`
--
ALTER TABLE `operational_contacts`
  ADD CONSTRAINT `operational_contacts_clients_id_fk` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`);

--
-- Constraints for table `prospect_comments`
--
ALTER TABLE `prospect_comments`
  ADD CONSTRAINT `prospect_comments_admins_id_fk` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`),
  ADD CONSTRAINT `prospect_comments_prospects_id_fk` FOREIGN KEY (`prospect_id`) REFERENCES `prospects` (`id`);

--
-- Constraints for table `prospect_meetings`
--
ALTER TABLE `prospect_meetings`
  ADD CONSTRAINT `prospect_meetings_prospects_id_fk` FOREIGN KEY (`prospect_id`) REFERENCES `prospects` (`id`);

--
-- Constraints for table `schedule_task`
--
ALTER TABLE `schedule_task`
  ADD CONSTRAINT `schedule_task_schedules_id_fk` FOREIGN KEY (`schedule_id`) REFERENCES `schedules` (`id`),
  ADD CONSTRAINT `schedule_task_tasks_id_fk` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`);

--
-- Constraints for table `stock_product`
--
ALTER TABLE `stock_product`
  ADD CONSTRAINT `stock_product_products_id_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `stock_product_stocks_id_fk` FOREIGN KEY (`stock_id`) REFERENCES `stocks` (`id`);

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_clients_id_fk` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`);

--
-- Constraints for table `task_items`
--
ALTER TABLE `task_items`
  ADD CONSTRAINT `task_items_tasks_id_fk` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`);

--
-- Constraints for table `task_item_status`
--
ALTER TABLE `task_item_status`
  ADD CONSTRAINT `task_item_status_cleaner_schedules_id_fk` FOREIGN KEY (`cleaner_schedule_id`) REFERENCES `cleaner_schedules` (`id`),
  ADD CONSTRAINT `task_item_status_schedule_task_id_fk` FOREIGN KEY (`schedule_task_id`) REFERENCES `schedule_task` (`id`),
  ADD CONSTRAINT `task_item_status_task_items_id_fk` FOREIGN KEY (`task_item_id`) REFERENCES `task_items` (`id`);

--
-- Constraints for table `task_status`
--
ALTER TABLE `task_status`
  ADD CONSTRAINT `task_status_cleaner_schedules_id_fk` FOREIGN KEY (`cleaner_schedule_id`) REFERENCES `cleaner_schedules` (`id`),
  ADD CONSTRAINT `task_status_schedule_task_id_fk` FOREIGN KEY (`schedule_task_id`) REFERENCES `schedule_task` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
