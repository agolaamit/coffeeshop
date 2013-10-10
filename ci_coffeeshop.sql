-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 12, 2013 at 09:37 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ci_coffeeshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `bf_activities`
--

CREATE TABLE IF NOT EXISTS `bf_activities` (
  `activity_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `activity` varchar(255) NOT NULL,
  `module` varchar(255) NOT NULL,
  `created_on` datetime NOT NULL,
  `deleted` tinyint(12) NOT NULL DEFAULT '0',
  PRIMARY KEY (`activity_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=233 ;

--
-- Dumping data for table `bf_activities`
--

INSERT INTO `bf_activities` (`activity_id`, `user_id`, `activity`, `module`, `created_on`, `deleted`) VALUES
(1, 2, 'registered a new account.', 'users', '2013-07-10 10:46:45', 0),
(2, 2, 'logged in from: 127.0.0.1', 'users', '2013-07-10 10:47:05', 0),
(3, 2, 'logged out from: 127.0.0.1', 'users', '2013-07-10 10:47:35', 0),
(4, 1, 'logged in from: 127.0.0.1', 'users', '2013-07-10 10:47:52', 0),
(5, 1, 'App settings saved from: 127.0.0.1', 'core', '2013-07-10 11:04:24', 0),
(6, 1, 'Created Module: Todo : 127.0.0.1', 'modulebuilder', '2013-07-10 11:14:19', 0),
(7, 1, 'Deleted Module: Todo : 127.0.0.1', 'builder', '2013-07-10 11:15:17', 0),
(8, 1, 'logged out from: 127.0.0.1', 'users', '2013-07-10 11:18:34', 0),
(9, 1, 'logged in from: 127.0.0.1', 'users', '2013-07-11 05:59:19', 0),
(10, 1, 'Created Module: blog : 127.0.0.1', 'modulebuilder', '2013-07-11 06:01:32', 0),
(11, 1, 'Created record with ID: 1 : 127.0.0.1', 'blog', '2013-07-11 06:03:52', 0),
(12, 1, 'created a new User: pankit', 'users', '2013-07-11 06:05:34', 0),
(13, 1, 'logged out from: 127.0.0.1', 'users', '2013-07-11 06:06:46', 0),
(14, 3, 'logged in from: 127.0.0.1', 'users', '2013-07-11 06:07:06', 0),
(15, 3, 'logged out from: 127.0.0.1', 'users', '2013-07-11 06:07:20', 0),
(16, 1, 'logged in from: 127.0.0.1', 'users', '2013-07-11 06:07:33', 0),
(17, 1, 'App settings saved from: 127.0.0.1', 'core', '2013-07-11 06:08:08', 0),
(18, 1, 'logged out from: 127.0.0.1', 'users', '2013-07-11 06:46:21', 0),
(19, 1, 'logged in from: 192.168.10.61', 'users', '2013-07-15 05:53:28', 0),
(20, 1, 'App settings saved from: 192.168.10.61', 'core', '2013-07-15 05:54:35', 0),
(21, 1, 'logged in from: 192.168.10.61', 'users', '2013-07-15 06:11:37', 0),
(22, 1, 'Created Module: Category : 192.168.10.61', 'modulebuilder', '2013-07-15 06:17:06', 0),
(23, 1, 'Migrate Type: category_ Uninstalled Version: 0 from: 192.168.10.61', 'migrations', '2013-07-15 06:21:55', 0),
(24, 1, 'Migrate Type: category_ to Version: 0 from: 192.168.10.61', 'migrations', '2013-07-15 06:23:00', 0),
(25, 1, 'Deleted Module: Category : 192.168.10.61', 'builder', '2013-07-15 06:25:09', 0),
(26, 1, 'Deleted Module: Category : 192.168.10.61', 'builder', '2013-07-15 06:25:15', 0),
(27, 1, 'Created Module: Category : 192.168.10.61', 'modulebuilder', '2013-07-15 06:25:44', 0),
(28, 1, 'Created Module: Category : 192.168.10.61', 'modulebuilder', '2013-07-15 06:26:19', 0),
(29, 1, 'Created record with ID: 1 : 192.168.10.61', 'category', '2013-07-15 06:26:32', 0),
(30, 1, 'Updated record with ID: 1 : 192.168.10.61', 'category', '2013-07-15 06:26:41', 0),
(31, 1, 'Deleted Module: Category : 192.168.10.61', 'builder', '2013-07-15 06:27:19', 0),
(32, 1, 'Created Module: Category : 192.168.10.61', 'modulebuilder', '2013-07-15 06:29:04', 0),
(33, 1, 'Created record with ID: 1 : 192.168.10.61', 'category', '2013-07-15 06:29:19', 0),
(34, 1, 'Updated record with ID: 1 : 192.168.10.61', 'category', '2013-07-15 06:29:31', 0),
(35, 1, 'Created record with ID: 2 : 192.168.10.61', 'category', '2013-07-15 06:30:14', 0),
(36, 1, 'Created record with ID: 3 : 192.168.10.61', 'category', '2013-07-15 06:30:27', 0),
(37, 1, 'App settings saved from: 192.168.10.61', 'core', '2013-07-15 06:37:28', 0),
(38, 1, 'App settings saved from: 192.168.10.61', 'core', '2013-07-15 06:37:31', 0),
(39, 1, 'Created Module: Cafe : 192.168.10.61', 'modulebuilder', '2013-07-15 06:45:52', 0),
(40, 1, 'Deleted Module: Cafe : 192.168.10.61', 'builder', '2013-07-15 06:46:30', 0),
(41, 1, 'Created Module: Cafe : 192.168.10.61', 'modulebuilder', '2013-07-15 06:51:08', 0),
(42, 1, 'Created record with ID: 1 : 192.168.10.61', 'cafe', '2013-07-15 07:01:21', 0),
(43, 1, 'Updated record with ID: 1 : 192.168.10.61', 'cafe', '2013-07-15 07:01:29', 0),
(44, 1, 'Updated record with ID: 1 : 192.168.10.61', 'cafe', '2013-07-15 07:01:42', 0),
(45, 1, 'Created record with ID: 2 : 192.168.10.61', 'cafe', '2013-07-15 07:03:30', 0),
(46, 1, 'Updated record with ID: 2 : 192.168.10.61', 'cafe', '2013-07-15 07:05:14', 0),
(47, 1, 'Created Module: Sub Category : 192.168.10.61', 'modulebuilder', '2013-07-15 07:07:45', 0),
(48, 1, 'logged in from: 192.168.10.61', 'users', '2013-07-15 12:49:15', 0),
(49, 1, 'logged in from: 127.0.0.1', 'users', '2013-07-24 16:06:31', 0),
(50, 1, 'Created record with ID: 3 : 127.0.0.1', 'cafe', '2013-07-24 16:17:51', 0),
(51, 1, 'logged out from: 127.0.0.1', 'users', '2013-07-24 16:21:59', 0),
(52, 1, 'logged in from: 127.0.0.1', 'users', '2013-07-24 16:41:33', 0),
(53, 1, 'logged out from: 127.0.0.1', 'users', '2013-07-24 16:57:03', 0),
(54, 1, 'logged in from: 127.0.0.1', 'users', '2013-07-24 16:58:37', 0),
(55, 1, 'App settings saved from: 127.0.0.1', 'core', '2013-07-24 17:10:21', 0),
(56, 1, 'App settings saved from: 127.0.0.1', 'core', '2013-07-24 17:10:42', 0),
(57, 1, 'logged in from: 127.0.0.1', 'users', '2013-08-04 17:28:44', 0),
(58, 1, 'logged out from: 127.0.0.1', 'users', '2013-08-04 19:03:48', 0),
(59, 1, 'logged in from: 127.0.0.1', 'users', '2013-08-04 19:58:38', 0),
(60, 1, 'logged in from: 127.0.0.1', 'users', '2013-08-04 20:02:25', 0),
(61, 1, 'logged in from: 127.0.0.1', 'users', '2013-08-07 20:19:32', 0),
(62, 1, 'logged out from: 127.0.0.1', 'users', '2013-08-07 20:58:45', 0),
(63, 1, 'logged in from: 127.0.0.1', 'users', '2013-08-07 20:58:58', 0),
(64, 1, 'logged in from: 127.0.0.1', 'users', '2013-08-09 16:44:12', 0),
(65, 1, 'logged in from: 127.0.0.1', 'users', '2013-08-10 04:45:13', 0),
(66, 1, 'logged in from: 127.0.0.1', 'users', '2013-08-29 16:45:17', 0),
(67, 1, 'created a new User: Pankit', 'users', '2013-08-29 16:46:53', 0),
(68, 1, 'modified user: Pankit', 'users', '2013-08-29 16:47:44', 0),
(69, 1, 'logged out from: 127.0.0.1', 'users', '2013-08-29 16:48:06', 0),
(70, 4, 'logged in from: 127.0.0.1', 'users', '2013-08-29 16:48:33', 0),
(71, 4, 'modified user: Pankit', 'users', '2013-08-29 16:48:51', 0),
(72, 4, 'modified user: Pankit', 'users', '2013-08-29 16:49:07', 0),
(73, 4, 'logged out from: 127.0.0.1', 'users', '2013-08-29 16:50:45', 0),
(74, 4, 'logged in from: 127.0.0.1', 'users', '2013-09-02 16:21:01', 0),
(75, 4, 'Created record with ID: 4 : 127.0.0.1', 'cafe', '2013-09-02 17:12:35', 0),
(76, 4, 'Updated record with ID: 3 : 127.0.0.1', 'cafe', '2013-09-02 17:13:18', 0),
(77, 4, 'Updated record with ID: 3 : 127.0.0.1', 'cafe', '2013-09-02 17:13:40', 0),
(78, 4, 'Updated record with ID: 2 : 127.0.0.1', 'cafe', '2013-09-02 17:14:06', 0),
(79, 4, 'modified user: amit', 'users', '2013-09-02 17:15:14', 0),
(80, 4, 'modified user: amit', 'users', '2013-09-02 17:15:33', 0),
(81, 4, 'modified user: amit1', 'users', '2013-09-02 17:38:36', 0),
(82, 4, 'modified user: amit', 'users', '2013-09-02 17:38:57', 0),
(83, 4, 'modified user: amit', 'users', '2013-09-02 17:53:02', 0),
(84, 4, 'logged in from: 127.0.0.1', 'users', '2013-09-03 04:29:00', 0),
(85, 4, 'modified user: amit', 'users', '2013-09-03 04:29:29', 0),
(86, 4, 'modified user: amit', 'users', '2013-09-03 06:00:46', 0),
(87, 4, 'created a new User: Test', 'users', '2013-09-03 06:48:12', 0),
(88, 4, 'modified user: Test', 'users', '2013-09-03 06:48:23', 0),
(89, 4, 'modified user: Test', 'users', '2013-09-03 06:48:42', 0),
(90, 4, 'deleted user: Test', 'users', '2013-09-03 06:54:36', 0),
(91, 4, 'logged in from: 127.0.0.1', 'users', '2013-09-03 09:13:07', 0),
(92, 4, 'modified user: Amit', 'users', '2013-09-03 09:14:21', 0),
(93, 4, ': prashant : Deactivateed', 'users', '2013-09-03 09:17:08', 0),
(94, 4, ': prashant : Activateed', 'users', '2013-09-03 09:17:21', 0),
(95, 4, ': prashant : Activateed', 'users', '2013-09-03 09:17:30', 0),
(96, 4, 'Updated record with ID: 4 : 127.0.0.1', 'cafe', '2013-09-03 09:30:24', 0),
(97, 4, 'Updated record with ID: 4 : 127.0.0.1', 'cafe', '2013-09-03 09:43:15', 0),
(98, 4, 'Updated record with ID: 4 : 127.0.0.1', 'cafe', '2013-09-03 09:43:54', 0),
(99, 4, 'Updated record with ID: 4 : 127.0.0.1', 'cafe', '2013-09-03 09:44:09', 0),
(100, 4, 'modified user: Amit', 'users', '2013-09-03 09:46:38', 0),
(101, 4, 'Updated record with ID: 4 : 127.0.0.1', 'cafe', '2013-09-03 09:47:16', 0),
(102, 4, 'Updated record with ID: 4 : 127.0.0.1', 'cafe', '2013-09-03 09:47:31', 0),
(103, 4, 'Created record with ID: 1 : 127.0.0.1', 'sub_category', '2013-09-03 12:14:16', 0),
(104, 4, 'Created record with ID: 2 : 127.0.0.1', 'sub_category', '2013-09-03 12:18:02', 0),
(105, 4, 'Created record with ID: 3 : 127.0.0.1', 'sub_category', '2013-09-03 12:27:57', 0),
(106, 4, 'Updated record with ID: 3 : 127.0.0.1', 'sub_category', '2013-09-03 12:28:33', 0),
(107, 4, 'Updated record with ID: 3 : 127.0.0.1', 'sub_category', '2013-09-03 12:28:45', 0),
(108, 4, 'logged in from: 127.0.0.1', 'users', '2013-09-04 07:40:05', 0),
(109, 4, 'logged in from: 127.0.0.1', 'users', '2013-09-04 09:53:40', 0),
(110, 4, 'logged in from: 127.0.0.1', 'users', '2013-09-04 09:54:14', 0),
(111, 4, 'logged in from: 127.0.0.1', 'users', '2013-09-04 12:25:25', 0),
(112, 4, 'logged in from: 127.0.0.1', 'users', '2013-09-04 12:45:22', 0),
(113, 4, 'logged out from: 127.0.0.1', 'users', '2013-09-04 12:47:08', 0),
(114, 4, 'logged in from: 127.0.0.1', 'users', '2013-09-04 12:47:28', 0),
(115, 4, 'logged in from: 192.168.10.204', 'users', '2013-09-04 12:51:48', 0),
(116, 4, 'logged in from: 192.168.10.171', 'users', '2013-09-04 12:52:35', 0),
(117, 4, 'deleted user: ravigami', 'users', '2013-09-04 12:52:47', 0),
(118, 4, 'deleted user: prashant', 'users', '2013-09-04 12:52:47', 0),
(119, 4, 'logged out from: 192.168.10.171', 'users', '2013-09-04 12:54:10', 0),
(120, 4, 'logged in from: 127.0.0.1', 'users', '2013-09-05 08:13:12', 0),
(121, 4, 'logged in from: 127.0.0.1', 'users', '2013-09-05 10:33:59', 0),
(122, 4, 'Created record with ID: 4 : 127.0.0.1', 'sub_category', '2013-09-05 10:40:19', 0),
(123, 4, 'Updated record with ID: 2 : 127.0.0.1', 'sub_category', '2013-09-05 10:40:31', 0),
(124, 4, 'Created record with ID: 5 : 127.0.0.1', 'sub_category', '2013-09-05 10:43:07', 0),
(125, 4, 'logged in from: 127.0.0.1', 'users', '2013-09-06 07:11:57', 0),
(126, 4, 'Created record with ID: 6 : 127.0.0.1', 'sub_category', '2013-09-06 07:45:47', 0),
(127, 4, 'Created record with ID: 7 : 127.0.0.1', 'sub_category', '2013-09-06 07:47:11', 0),
(128, 4, 'Created record with ID: 1 : 127.0.0.1', 'sub_category', '2013-09-06 12:30:53', 0),
(129, 4, 'Created record with ID: 2 : 127.0.0.1', 'sub_category', '2013-09-06 12:53:15', 0),
(130, 4, 'Created record with ID: 2 : 127.0.0.1', 'sub_category', '2013-09-06 12:55:38', 0),
(131, 4, 'Created record with ID: 2 : 127.0.0.1', 'sub_category', '2013-09-06 12:57:44', 0),
(132, 4, 'logged in from: 127.0.0.1', 'users', '2013-09-07 09:03:00', 0),
(133, 4, 'Created record with ID: 3 : 127.0.0.1', 'sub_category', '2013-09-07 09:35:50', 0),
(134, 4, 'Created record with ID: 4 : 127.0.0.1', 'sub_category', '2013-09-07 09:39:40', 0),
(135, 4, 'Updated record with ID: 1 : 127.0.0.1', 'sub_category', '2013-09-07 10:54:57', 0),
(136, 4, 'Updated record with ID: 1 : 127.0.0.1', 'sub_category', '2013-09-07 10:55:49', 0),
(137, 4, 'Updated record with ID: 1 : 127.0.0.1', 'sub_category', '2013-09-07 10:56:06', 0),
(138, 4, 'Updated record with ID: 1 : 127.0.0.1', 'sub_category', '2013-09-07 10:56:26', 0),
(139, 4, 'Updated record with ID: 4 : 127.0.0.1', 'sub_category', '2013-09-07 12:08:41', 0),
(140, 4, 'Created record with ID: 5 : 127.0.0.1', 'sub_category', '2013-09-07 12:14:39', 0),
(141, 4, 'Created record with ID: 6 : 127.0.0.1', 'sub_category', '2013-09-07 12:38:52', 0),
(142, 4, 'Created record with ID: 7 : 127.0.0.1', 'sub_category', '2013-09-07 12:39:57', 0),
(143, 4, 'Created record with ID: 8 : 127.0.0.1', 'sub_category', '2013-09-07 12:41:54', 0),
(144, 4, 'Updated record with ID: 8 : 127.0.0.1', 'sub_category', '2013-09-07 12:42:09', 0),
(145, 4, 'Updated record with ID: 8 : 127.0.0.1', 'sub_category', '2013-09-07 12:42:46', 0),
(146, 4, 'logged in from: 127.0.0.1', 'users', '2013-09-08 10:18:10', 0),
(147, 4, 'Created record with ID: 1 : 127.0.0.1', 'sub_category', '2013-09-08 11:12:43', 0),
(148, 4, 'Updated record with ID: 1 : 127.0.0.1', 'sub_category', '2013-09-08 11:33:46', 0),
(149, 4, 'Created record with ID: 2 : 127.0.0.1', 'sub_category', '2013-09-08 11:34:09', 0),
(150, 4, 'Created record with ID: 3 : 127.0.0.1', 'sub_category', '2013-09-08 12:11:28', 0),
(151, 4, 'logged in from: 127.0.0.1', 'users', '2013-09-08 14:15:44', 0),
(152, 4, 'Updated record with ID: 7 : 127.0.0.1', 'sub_category', '2013-09-08 14:40:45', 0),
(153, 4, 'Updated record with ID: 2 : 127.0.0.1', 'sub_category', '2013-09-08 14:41:41', 0),
(154, 4, 'Updated record with ID: 2 : 127.0.0.1', 'sub_category', '2013-09-08 14:41:59', 0),
(155, 4, 'logged out from: 127.0.0.1', 'users', '2013-09-08 14:42:52', 0),
(156, 4, 'logged in from: 192.168.10.204', 'users', '2013-09-09 07:28:41', 0),
(157, 1, 'logged in from: 192.168.10.171', 'users', '2013-09-09 07:29:04', 0),
(158, 1, 'Created record with ID: 4 : 192.168.10.171', 'sub_category', '2013-09-09 07:29:30', 0),
(159, 4, 'logged in from: 127.0.0.1', 'users', '2013-09-09 10:11:58', 0),
(160, 4, 'logged in from: 127.0.0.1', 'users', '2013-09-09 12:55:50', 0),
(161, 4, 'Created record with ID: 8 : 127.0.0.1', 'sub_category', '2013-09-09 13:29:45', 0),
(162, 4, 'Updated record with ID: 8 : 127.0.0.1', 'sub_category', '2013-09-09 13:32:13', 0),
(163, 4, 'Updated record with ID: 8 : 127.0.0.1', 'sub_category', '2013-09-09 13:32:43', 0),
(164, 4, 'Updated record with ID: 8 : 127.0.0.1', 'sub_category', '2013-09-09 13:33:36', 0),
(165, 4, 'Updated record with ID: 8 : 127.0.0.1', 'sub_category', '2013-09-09 13:33:42', 0),
(166, 4, 'Updated record with ID: 8 : 127.0.0.1', 'sub_category', '2013-09-09 13:33:53', 0),
(167, 4, 'Updated record with ID: 8 : 127.0.0.1', 'sub_category', '2013-09-09 13:34:41', 0),
(168, 4, 'Updated record with ID: 8 : 127.0.0.1', 'sub_category', '2013-09-09 13:36:40', 0),
(169, 4, 'Updated record with ID: 8 : 127.0.0.1', 'sub_category', '2013-09-09 13:42:26', 0),
(170, 4, 'logged in from: 127.0.0.1', 'users', '2013-09-10 04:49:08', 0),
(171, 4, 'Created record with ID: 5 : 127.0.0.1', 'cafe', '2013-09-10 05:05:34', 0),
(172, 4, 'Updated record with ID: 1 : 127.0.0.1', 'sub_category', '2013-09-10 05:27:57', 0),
(173, 4, 'Updated record with ID: 1 : 127.0.0.1', 'sub_category', '2013-09-10 05:38:26', 0),
(174, 4, 'Created record with ID: 9 : 127.0.0.1', 'sub_category', '2013-09-10 05:39:07', 0),
(175, 4, 'Updated record with ID: 9 : 127.0.0.1', 'sub_category', '2013-09-10 05:40:07', 0),
(176, 4, 'Created record with ID: 10 : 127.0.0.1', 'sub_category', '2013-09-10 05:43:10', 0),
(177, 4, 'Created record with ID: 11 : 127.0.0.1', 'sub_category', '2013-09-10 05:45:14', 0),
(178, 4, 'Created record with ID: 12 : 127.0.0.1', 'sub_category', '2013-09-10 05:46:38', 0),
(179, 4, 'Updated record with ID: 2 : 127.0.0.1', 'sub_category', '2013-09-10 06:43:34', 0),
(180, 4, 'Updated record with ID: 5 : 127.0.0.1', 'sub_category', '2013-09-10 06:49:03', 0),
(181, 4, 'Updated record with ID: 2 : 127.0.0.1', 'sub_category', '2013-09-10 07:36:25', 0),
(182, 4, 'Updated record with ID: 1 : 127.0.0.1', 'sub_category', '2013-09-10 07:37:13', 0),
(183, 4, 'Updated record with ID: 2 : 127.0.0.1', 'sub_category', '2013-09-10 07:37:24', 0),
(184, 4, 'Updated record with ID: 4 : 127.0.0.1', 'sub_category', '2013-09-10 07:37:37', 0),
(185, 4, 'logged in from: 127.0.0.1', 'users', '2013-09-11 05:03:20', 0),
(186, 4, 'Updated record with ID: 1 : 127.0.0.1', 'sub_category', '2013-09-11 05:54:07', 0),
(187, 4, 'Updated record with ID: 2 : 127.0.0.1', 'sub_category', '2013-09-11 05:54:23', 0),
(188, 4, 'Updated record with ID: 3 : 127.0.0.1', 'sub_category', '2013-09-11 05:55:15', 0),
(189, 4, 'Created record with ID: 5 : 127.0.0.1', 'sub_category', '2013-09-11 05:55:32', 0),
(190, 4, 'Created record with ID: 6 : 127.0.0.1', 'sub_category', '2013-09-11 05:55:43', 0),
(191, 4, 'Created record with ID: 1 : 127.0.0.1', 'product', '2013-09-11 07:49:08', 0),
(192, 4, 'Updated record with ID: 1 : 127.0.0.1', 'sub_category', '2013-09-11 07:59:16', 0),
(193, 4, 'Created record with ID: 7 : 127.0.0.1', 'sub_category', '2013-09-11 07:59:57', 0),
(194, 4, 'Created record with ID: 8 : 127.0.0.1', 'sub_category', '2013-09-11 08:00:08', 0),
(195, 4, 'Created record with ID: 9 : 127.0.0.1', 'sub_category', '2013-09-11 08:00:18', 0),
(196, 4, 'Created record with ID: 1 : 127.0.0.1', 'sub_category', '2013-09-11 08:02:40', 0),
(197, 4, 'Created record with ID: 2 : 127.0.0.1', 'sub_category', '2013-09-11 08:02:55', 0),
(198, 4, 'Created record with ID: 3 : 127.0.0.1', 'sub_category', '2013-09-11 08:05:24', 0),
(199, 4, 'Created record with ID: 4 : 127.0.0.1', 'sub_category', '2013-09-11 08:05:40', 0),
(200, 4, 'Created record with ID: 5 : 127.0.0.1', 'sub_category', '2013-09-11 08:05:52', 0),
(201, 4, 'Created record with ID: 1 : 127.0.0.1', 'sub_category', '2013-09-11 08:08:22', 0),
(202, 4, 'Created record with ID: 2 : 127.0.0.1', 'sub_category', '2013-09-11 08:09:43', 0),
(203, 4, 'Created record with ID: 1 : 127.0.0.1', 'sub_category', '2013-09-11 08:10:10', 0),
(204, 4, 'Created record with ID: 2 : 127.0.0.1', 'sub_category', '2013-09-11 08:10:22', 0),
(205, 4, 'Created record with ID: 3 : 127.0.0.1', 'sub_category', '2013-09-11 08:10:36', 0),
(206, 4, 'Updated record with ID: 1 : 127.0.0.1', 'sub_category', '2013-09-11 08:11:18', 0),
(207, 4, 'Created record with ID: 4 : 127.0.0.1', 'sub_category', '2013-09-11 08:12:02', 0),
(208, 4, 'Created record with ID: 5 : 127.0.0.1', 'sub_category', '2013-09-11 08:12:13', 0),
(209, 4, 'Created record with ID: 3 : 127.0.0.1', 'sub_category', '2013-09-11 08:13:32', 0),
(210, 4, 'Created record with ID: 4 : 127.0.0.1', 'sub_category', '2013-09-11 08:14:09', 0),
(211, 4, 'Updated record with ID: 4 : 127.0.0.1', 'sub_category', '2013-09-11 08:14:23', 0),
(212, 4, 'Updated record with ID: 4 : 127.0.0.1', 'sub_category', '2013-09-11 08:14:37', 0),
(213, 4, 'Created record with ID: 6 : 127.0.0.1', 'sub_category', '2013-09-11 08:25:08', 0),
(214, 4, 'Created record with ID: 7 : 127.0.0.1', 'sub_category', '2013-09-11 08:25:18', 0),
(215, 4, 'Created record with ID: 8 : 127.0.0.1', 'sub_category', '2013-09-11 08:26:10', 0),
(216, 4, 'Created record with ID: 9 : 127.0.0.1', 'sub_category', '2013-09-11 08:26:19', 0),
(217, 4, 'Updated record with ID: 1 : 127.0.0.1', 'sub_category', '2013-09-11 08:32:05', 0),
(218, 4, 'Updated record with ID: 2 : 127.0.0.1', 'sub_category', '2013-09-11 08:35:01', 0),
(219, 4, 'Updated record with ID: 4 : 127.0.0.1', 'sub_category', '2013-09-11 08:35:38', 0),
(220, 4, 'Updated record with ID: 3 : 127.0.0.1', 'sub_category', '2013-09-11 08:36:24', 0),
(221, 4, 'Updated record with ID: 4 : 127.0.0.1', 'sub_category', '2013-09-11 08:36:47', 0),
(222, 4, 'Updated record with ID: 8 : 127.0.0.1', 'sub_category', '2013-09-11 08:37:03', 0),
(223, 4, 'Updated record with ID: 9 : 127.0.0.1', 'sub_category', '2013-09-11 08:37:16', 0),
(224, 4, 'Created record with ID: 10 : 127.0.0.1', 'sub_category', '2013-09-11 08:37:58', 0),
(225, 4, 'Created record with ID: 1 : 127.0.0.1', 'product', '2013-09-11 08:57:26', 0),
(226, 4, 'logged in from: 127.0.0.1', 'users', '2013-09-12 04:52:45', 0),
(227, 4, 'Created record with ID: 2 : 127.0.0.1', 'product', '2013-09-12 07:05:24', 0),
(228, 4, 'Updated record with ID: 2 : 127.0.0.1', 'product', '2013-09-12 07:34:03', 0),
(229, 4, 'Updated record with ID: 2 : 127.0.0.1', 'product', '2013-09-12 07:34:27', 0),
(230, 4, 'Updated record with ID: 2 : 127.0.0.1', 'product', '2013-09-12 08:14:00', 0),
(231, 4, 'Created record with ID: 6 : 127.0.0.1', 'sub_category', '2013-09-12 09:20:53', 0),
(232, 4, 'Created record with ID: 3 : 127.0.0.1', 'product', '2013-09-12 09:31:31', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bf_blog`
--

CREATE TABLE IF NOT EXISTS `bf_blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_title` varchar(255) NOT NULL,
  `blog_description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `bf_blog`
--


-- --------------------------------------------------------

--
-- Table structure for table `bf_cafe`
--

CREATE TABLE IF NOT EXISTS `bf_cafe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cafe_name` varchar(255) NOT NULL,
  `cafe_url_name` varchar(255) NOT NULL,
  `cafe_status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `bf_cafe`
--

INSERT INTO `bf_cafe` (`id`, `cafe_name`, `cafe_url_name`, `cafe_status`) VALUES
(1, 'coffee day', 'ccd', '0'),
(2, 'meeting point', 'xyz', '0'),
(3, 'lover''s point', 'lmn', '0');

-- --------------------------------------------------------

--
-- Table structure for table `bf_category`
--

CREATE TABLE IF NOT EXISTS `bf_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `bf_category`
--

INSERT INTO `bf_category` (`id`, `category_name`) VALUES
(1, 'Food'),
(2, 'Drink'),
(3, 'Coffee');

-- --------------------------------------------------------

--
-- Table structure for table `bf_email_queue`
--

CREATE TABLE IF NOT EXISTS `bf_email_queue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `to_email` varchar(128) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `alt_message` text,
  `max_attempts` int(11) NOT NULL DEFAULT '3',
  `attempts` int(11) NOT NULL DEFAULT '0',
  `success` tinyint(1) NOT NULL DEFAULT '0',
  `date_published` datetime DEFAULT NULL,
  `last_attempt` datetime DEFAULT NULL,
  `date_sent` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `bf_email_queue`
--


-- --------------------------------------------------------

--
-- Table structure for table `bf_login_attempts`
--

CREATE TABLE IF NOT EXISTS `bf_login_attempts` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(40) NOT NULL,
  `login` varchar(50) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `bf_login_attempts`
--


-- --------------------------------------------------------

--
-- Table structure for table `bf_permissions`
--

CREATE TABLE IF NOT EXISTS `bf_permissions` (
  `permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(100) NOT NULL,
  `status` enum('active','inactive','deleted') DEFAULT 'active',
  PRIMARY KEY (`permission_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=164 ;

--
-- Dumping data for table `bf_permissions`
--

INSERT INTO `bf_permissions` (`permission_id`, `name`, `description`, `status`) VALUES
(1, 'Site.Signin.Allow', 'Allow users to login to the site', 'active'),
(2, 'Site.Content.View', 'Allow users to view the Content Context', 'active'),
(3, 'Site.Reports.View', 'Allow users to view the Reports Context', 'active'),
(4, 'Site.Settings.View', 'Allow users to view the Settings Context', 'active'),
(5, 'Site.Developer.View', 'Allow users to view the Developer Context', 'active'),
(6, 'Coffeeshop.Roles.Manage', 'Allow users to manage the user Roles', 'active'),
(7, 'Coffeeshop.Users.Manage', 'Allow users to manage the site Users', 'active'),
(8, 'Coffeeshop.Users.View', 'Allow users access to the User Settings', 'active'),
(9, 'Coffeeshop.Users.Add', 'Allow users to add new Users', 'active'),
(10, 'Coffeeshop.Database.Manage', 'Allow users to manage the Database settings', 'active'),
(11, 'Coffeeshop.Emailer.Manage', 'Allow users to manage the Emailer settings', 'active'),
(12, 'Coffeeshop.Logs.View', 'Allow users access to the Log details', 'active'),
(13, 'Coffeeshop.Logs.Manage', 'Allow users to manage the Log files', 'active'),
(14, 'Coffeeshop.Emailer.View', 'Allow users access to the Emailer settings', 'active'),
(15, 'Site.Signin.Offline', 'Allow users to login to the site when the site is offline', 'active'),
(16, 'Coffeeshop.Permissions.View', 'Allow access to view the Permissions menu unders Settings Context', 'active'),
(17, 'Coffeeshop.Permissions.Manage', 'Allow access to manage the Permissions in the system', 'active'),
(18, 'Coffeeshop.Roles.Delete', 'Allow users to delete user Roles', 'active'),
(19, 'Coffeeshop.Modules.Add', 'Allow creation of modules with the builder.', 'active'),
(20, 'Coffeeshop.Modules.Delete', 'Allow deletion of modules.', 'active'),
(21, 'Permissions.Administrator.Manage', 'To manage the access control permissions for the Administrator role.', 'active'),
(22, 'Permissions.Editor.Manage', 'To manage the access control permissions for the Editor role.', 'active'),
(24, 'Permissions.User.Manage', 'To manage the access control permissions for the User role.', 'active'),
(25, 'Permissions.Developer.Manage', 'To manage the access control permissions for the Developer role.', 'active'),
(27, 'Activities.Own.View', 'To view the users own activity logs', 'active'),
(28, 'Activities.Own.Delete', 'To delete the users own activity logs', 'active'),
(29, 'Activities.User.View', 'To view the user activity logs', 'active'),
(30, 'Activities.User.Delete', 'To delete the user activity logs, except own', 'active'),
(31, 'Activities.Module.View', 'To view the module activity logs', 'active'),
(32, 'Activities.Module.Delete', 'To delete the module activity logs', 'active'),
(33, 'Activities.Date.View', 'To view the users own activity logs', 'active'),
(34, 'Activities.Date.Delete', 'To delete the dated activity logs', 'active'),
(35, 'Coffeeshop.UI.Manage', 'Manage the Coffeeshop UI settings', 'active'),
(36, 'Coffeeshop.Settings.View', 'To view the site settings page.', 'active'),
(37, 'Coffeeshop.Settings.Manage', 'To manage the site settings.', 'active'),
(38, 'Coffeeshop.Activities.View', 'To view the Activities menu.', 'active'),
(39, 'Coffeeshop.Database.View', 'To view the Database menu.', 'active'),
(40, 'Coffeeshop.Migrations.View', 'To view the Migrations menu.', 'active'),
(41, 'Coffeeshop.Builder.View', 'To view the Modulebuilder menu.', 'active'),
(42, 'Coffeeshop.Roles.View', 'To view the Roles menu.', 'active'),
(43, 'Coffeeshop.Sysinfo.View', 'To view the System Information page.', 'active'),
(44, 'Coffeeshop.Translate.Manage', 'To manage the Language Translation.', 'active'),
(45, 'Coffeeshop.Translate.View', 'To view the Language Translate menu.', 'active'),
(46, 'Coffeeshop.UI.View', 'To view the UI/Keyboard Shortcut menu.', 'active'),
(47, 'Coffeeshop.Update.Manage', 'To manage the Coffeeshop Update.', 'active'),
(48, 'Coffeeshop.Update.View', 'To view the Developer Update menu.', 'active'),
(49, 'Coffeeshop.Profiler.View', 'To view the Console Profiler Bar.', 'active'),
(50, 'Coffeeshop.Roles.Add', 'To add New Roles', 'active'),
(51, 'Blog.Content.View', '', 'active'),
(52, 'Blog.Content.Create', '', 'active'),
(53, 'Blog.Content.Edit', '', 'active'),
(54, 'Blog.Content.Delete', '', 'active'),
(55, 'Blog.Reports.View', '', 'active'),
(56, 'Blog.Reports.Create', '', 'active'),
(57, 'Blog.Reports.Edit', '', 'active'),
(58, 'Blog.Reports.Delete', '', 'active'),
(59, 'Blog.Settings.View', '', 'active'),
(60, 'Blog.Settings.Create', '', 'active'),
(61, 'Blog.Settings.Edit', '', 'active'),
(62, 'Blog.Settings.Delete', '', 'active'),
(63, 'Blog.Developer.View', '', 'active'),
(64, 'Blog.Developer.Create', '', 'active'),
(65, 'Blog.Developer.Edit', '', 'active'),
(66, 'Blog.Developer.Delete', '', 'active'),
(99, 'Category.Content.View', '', 'active'),
(100, 'Category.Content.Create', '', 'active'),
(101, 'Category.Content.Edit', '', 'active'),
(102, 'Category.Content.Delete', '', 'active'),
(103, 'Category.Reports.View', '', 'active'),
(104, 'Category.Reports.Create', '', 'active'),
(105, 'Category.Reports.Edit', '', 'active'),
(106, 'Category.Reports.Delete', '', 'active'),
(107, 'Category.Settings.View', '', 'active'),
(108, 'Category.Settings.Create', '', 'active'),
(109, 'Category.Settings.Edit', '', 'active'),
(110, 'Category.Settings.Delete', '', 'active'),
(111, 'Category.Developer.View', '', 'active'),
(112, 'Category.Developer.Create', '', 'active'),
(113, 'Category.Developer.Edit', '', 'active'),
(114, 'Category.Developer.Delete', '', 'active'),
(115, 'Permissions.Cafe Admin.Manage', 'To manage the access control permissions for the Cafe Admin role.', 'active'),
(132, 'Cafe.Content.View', '', 'active'),
(133, 'Cafe.Content.Create', '', 'active'),
(134, 'Cafe.Content.Edit', '', 'active'),
(135, 'Cafe.Content.Delete', '', 'active'),
(136, 'Cafe.Reports.View', '', 'active'),
(137, 'Cafe.Reports.Create', '', 'active'),
(138, 'Cafe.Reports.Edit', '', 'active'),
(139, 'Cafe.Reports.Delete', '', 'active'),
(140, 'Cafe.Settings.View', '', 'active'),
(141, 'Cafe.Settings.Create', '', 'active'),
(142, 'Cafe.Settings.Edit', '', 'active'),
(143, 'Cafe.Settings.Delete', '', 'active'),
(144, 'Cafe.Developer.View', '', 'active'),
(145, 'Cafe.Developer.Create', '', 'active'),
(146, 'Cafe.Developer.Edit', '', 'active'),
(147, 'Cafe.Developer.Delete', '', 'active'),
(148, 'Sub_Category.Content.View', '', 'active'),
(149, 'Sub_Category.Content.Create', '', 'active'),
(150, 'Sub_Category.Content.Edit', '', 'active'),
(151, 'Sub_Category.Content.Delete', '', 'active'),
(152, 'Sub_Category.Reports.View', '', 'active'),
(153, 'Sub_Category.Reports.Create', '', 'active'),
(154, 'Sub_Category.Reports.Edit', '', 'active'),
(155, 'Sub_Category.Reports.Delete', '', 'active'),
(156, 'Sub_Category.Settings.View', '', 'active'),
(157, 'Sub_Category.Settings.Create', '', 'active'),
(158, 'Sub_Category.Settings.Edit', '', 'active'),
(159, 'Sub_Category.Settings.Delete', '', 'active'),
(160, 'Sub_Category.Developer.View', '', 'active'),
(161, 'Sub_Category.Developer.Create', '', 'active'),
(162, 'Sub_Category.Developer.Edit', '', 'active'),
(163, 'Sub_Category.Developer.Delete', '', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `bf_product`
--

CREATE TABLE IF NOT EXISTS `bf_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cafe_id` int(11) NOT NULL DEFAULT '0',
  `cat_id` int(11) NOT NULL DEFAULT '0',
  `sub_cat_id` int(11) NOT NULL DEFAULT '0',
  `product_name` varchar(255) NOT NULL,
  `price` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `bf_product`
--

INSERT INTO `bf_product` (`id`, `cafe_id`, `cat_id`, `sub_cat_id`, `product_name`, `price`) VALUES
(1, 1, 3, 1, 'Cold brew', 50),
(2, 1, 3, 2, 'Cappuccino', 30);

-- --------------------------------------------------------

--
-- Table structure for table `bf_product_attributes`
--

CREATE TABLE IF NOT EXISTS `bf_product_attributes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL DEFAULT '0',
  `sub_cat_attr_option_id` int(11) NOT NULL DEFAULT '0',
  `extra_price` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `bf_product_attributes`
--

INSERT INTO `bf_product_attributes` (`id`, `product_id`, `sub_cat_attr_option_id`, `extra_price`) VALUES
(1, 1, 6, 0),
(2, 1, 7, 20),
(3, 1, 10, 40),
(4, 1, 8, 10),
(5, 1, 9, 10),
(6, 2, 1, 0),
(7, 2, 2, 10),
(8, 2, 3, 20),
(9, 2, 4, 15);

-- --------------------------------------------------------

--
-- Table structure for table `bf_roles`
--

CREATE TABLE IF NOT EXISTS `bf_roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(60) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `default` tinyint(1) NOT NULL DEFAULT '0',
  `can_delete` tinyint(1) NOT NULL DEFAULT '1',
  `login_destination` varchar(255) NOT NULL DEFAULT '/',
  `deleted` int(1) NOT NULL DEFAULT '0',
  `default_context` varchar(255) NOT NULL DEFAULT 'content',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `bf_roles`
--

INSERT INTO `bf_roles` (`role_id`, `role_name`, `description`, `default`, `can_delete`, `login_destination`, `deleted`, `default_context`) VALUES
(1, 'Administrator', 'Has full control over every aspect of the site.', 0, 0, '', 0, 'content'),
(2, 'Editor', 'Can handle day-to-day management, but does not have full power.', 0, 1, '', 0, 'content'),
(4, 'User', 'This is the default user with access to login.', 1, 0, '', 0, 'content'),
(6, 'Developer', 'Developers typically are the only ones that can access the developer tools. Otherwise identical to Administrators, at least until the site is handed off.', 0, 1, '', 0, 'content'),
(7, 'Cafe Admin', '', 0, 1, '', 0, 'content');

-- --------------------------------------------------------

--
-- Table structure for table `bf_role_permissions`
--

CREATE TABLE IF NOT EXISTS `bf_role_permissions` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`role_id`,`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bf_role_permissions`
--

INSERT INTO `bf_role_permissions` (`role_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 24),
(1, 25),
(1, 27),
(1, 28),
(1, 29),
(1, 30),
(1, 31),
(1, 32),
(1, 33),
(1, 34),
(1, 35),
(1, 36),
(1, 37),
(1, 38),
(1, 39),
(1, 40),
(1, 41),
(1, 42),
(1, 43),
(1, 44),
(1, 45),
(1, 46),
(1, 47),
(1, 48),
(1, 49),
(1, 50),
(1, 51),
(1, 52),
(1, 53),
(1, 54),
(1, 55),
(1, 56),
(1, 57),
(1, 58),
(1, 59),
(1, 60),
(1, 61),
(1, 62),
(1, 63),
(1, 64),
(1, 65),
(1, 66),
(1, 99),
(1, 100),
(1, 101),
(1, 102),
(1, 103),
(1, 104),
(1, 105),
(1, 106),
(1, 107),
(1, 108),
(1, 109),
(1, 110),
(1, 111),
(1, 112),
(1, 113),
(1, 114),
(1, 115),
(1, 132),
(1, 133),
(1, 134),
(1, 135),
(1, 136),
(1, 137),
(1, 138),
(1, 139),
(1, 140),
(1, 141),
(1, 142),
(1, 143),
(1, 144),
(1, 145),
(1, 146),
(1, 147),
(1, 148),
(1, 149),
(1, 150),
(1, 151),
(1, 152),
(1, 153),
(1, 154),
(1, 155),
(1, 156),
(1, 157),
(1, 158),
(1, 159),
(1, 160),
(1, 161),
(1, 162),
(1, 163),
(2, 1),
(2, 2),
(2, 3),
(4, 1),
(6, 1),
(6, 2),
(6, 3),
(6, 4),
(6, 5),
(6, 6),
(6, 7),
(6, 8),
(6, 9),
(6, 10),
(6, 11),
(6, 12),
(6, 13),
(6, 49);

-- --------------------------------------------------------

--
-- Table structure for table `bf_schema_version`
--

CREATE TABLE IF NOT EXISTS `bf_schema_version` (
  `type` varchar(40) NOT NULL,
  `version` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bf_schema_version`
--

INSERT INTO `bf_schema_version` (`type`, `version`) VALUES
('app_', 0),
('blog_', 2),
('cafe_', 2),
('category_', 2),
('core', 34),
('sub_category_', 2);

-- --------------------------------------------------------

--
-- Table structure for table `bf_sessions`
--

CREATE TABLE IF NOT EXISTS `bf_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bf_sessions`
--


-- --------------------------------------------------------

--
-- Table structure for table `bf_settings`
--

CREATE TABLE IF NOT EXISTS `bf_settings` (
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `module` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`name`),
  UNIQUE KEY `unique - name` (`name`),
  KEY `index - name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bf_settings`
--

INSERT INTO `bf_settings` (`name`, `module`, `value`) VALUES
('auth.allow_name_change', 'core', '1'),
('auth.allow_register', 'core', '1'),
('auth.allow_remember', 'core', '1'),
('auth.do_login_redirect', 'core', '1'),
('auth.login_type', 'core', 'email'),
('auth.name_change_frequency', 'core', '1'),
('auth.name_change_limit', 'core', '1'),
('auth.password_force_mixed_case', 'core', '0'),
('auth.password_force_numbers', 'core', '0'),
('auth.password_force_symbols', 'core', '0'),
('auth.password_min_length', 'core', '8'),
('auth.password_show_labels', 'core', '0'),
('auth.remember_length', 'core', '1209600'),
('auth.use_extended_profile', 'core', '0'),
('auth.use_usernames', 'core', '1'),
('auth.user_activation_method', 'core', '0'),
('form_save', 'core.ui', 'ctrl+s/⌘+s'),
('goto_content', 'core.ui', 'alt+c'),
('mailpath', 'email', '/usr/sbin/sendmail'),
('mailtype', 'email', 'text'),
('protocol', 'email', 'mail'),
('sender_email', 'email', 'amit.patel@sparsh.com'),
('site.languages', 'core', 'a:1:{i:0;s:7:"english";}'),
('site.list_limit', 'core', '10'),
('site.show_front_profiler', 'core', '1'),
('site.show_profiler', 'core', '1'),
('site.status', 'core', '1'),
('site.system_email', 'core', 'amit.patel@sparsh.com'),
('site.title', 'core', 'Coffee - Shop'),
('smtp_host', 'email', ''),
('smtp_pass', 'email', ''),
('smtp_port', 'email', ''),
('smtp_timeout', 'email', ''),
('smtp_user', 'email', ''),
('updates.bleeding_edge', 'core', '1'),
('updates.do_check', 'core', '1');

-- --------------------------------------------------------

--
-- Table structure for table `bf_sub_category`
--

CREATE TABLE IF NOT EXISTS `bf_sub_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cafe_id` int(11) NOT NULL DEFAULT '0',
  `cat_id` int(11) NOT NULL DEFAULT '0',
  `sub_category_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `bf_sub_category`
--

INSERT INTO `bf_sub_category` (`id`, `cafe_id`, `cat_id`, `sub_category_name`) VALUES
(1, 1, 3, 'Cold'),
(2, 1, 3, 'Hot'),
(3, 1, 1, 'Breakfast'),
(4, 1, 1, 'Lunch'),
(5, 1, 1, 'Dinner');

-- --------------------------------------------------------

--
-- Table structure for table `bf_sub_category_attributes`
--

CREATE TABLE IF NOT EXISTS `bf_sub_category_attributes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cafe_id` int(11) NOT NULL DEFAULT '0',
  `sub_cat_id` int(11) NOT NULL DEFAULT '0',
  `attribute_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `bf_sub_category_attributes`
--

INSERT INTO `bf_sub_category_attributes` (`id`, `cafe_id`, `sub_cat_id`, `attribute_name`) VALUES
(1, 1, 2, 'Size'),
(2, 1, 2, 'Extra'),
(3, 1, 1, 'Size'),
(4, 1, 1, 'Extra');

-- --------------------------------------------------------

--
-- Table structure for table `bf_sub_category_attributes_options`
--

CREATE TABLE IF NOT EXISTS `bf_sub_category_attributes_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cafe_id` int(11) NOT NULL DEFAULT '0',
  `sub_cat_attr_id` int(11) NOT NULL DEFAULT '0',
  `option_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `bf_sub_category_attributes_options`
--

INSERT INTO `bf_sub_category_attributes_options` (`id`, `cafe_id`, `sub_cat_attr_id`, `option_name`) VALUES
(1, 1, 1, 'Small'),
(2, 1, 1, 'Medium'),
(3, 1, 1, 'Large'),
(4, 1, 2, 'Chocolate'),
(6, 1, 3, 'Medium'),
(7, 1, 3, 'Large'),
(8, 1, 4, 'Cream'),
(9, 1, 4, 'Chocolate'),
(10, 1, 3, 'Extra Large');

-- --------------------------------------------------------

--
-- Table structure for table `bf_users`
--

CREATE TABLE IF NOT EXISTS `bf_users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL DEFAULT '4',
  `cafe_id` int(4) NOT NULL,
  `email` varchar(120) NOT NULL,
  `username` varchar(30) NOT NULL DEFAULT '',
  `phone` varchar(20) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `password_hash` varchar(40) NOT NULL,
  `reset_hash` varchar(40) DEFAULT NULL,
  `salt` varchar(7) NOT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_ip` varchar(40) NOT NULL DEFAULT '',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ban_message` varchar(255) DEFAULT NULL,
  `reset_by` int(10) DEFAULT NULL,
  `display_name` varchar(255) DEFAULT '',
  `display_name_changed` date DEFAULT NULL,
  `timezone` char(4) NOT NULL DEFAULT 'UM6',
  `language` varchar(20) NOT NULL DEFAULT 'english',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `activate_hash` varchar(40) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `bf_users`
--

INSERT INTO `bf_users` (`id`, `role_id`, `cafe_id`, `email`, `username`, `phone`, `occupation`, `dob`, `password_hash`, `reset_hash`, `salt`, `last_login`, `last_ip`, `created_on`, `deleted`, `banned`, `ban_message`, `reset_by`, `display_name`, `display_name_changed`, `timezone`, `language`, `active`, `activate_hash`, `status`) VALUES
(1, 1, 4, 'amit.patel@test.com', 'amit', '9898989898', 'Business', '1979-08-08', '924086083ea2359c7b8bb1311b5ff1f99db4e2a7', NULL, '5Ck6Udq', '2013-09-09 07:29:04', '192.168.10.171', '0000-00-00 00:00:00', 0, 0, NULL, NULL, 'Amit', NULL, 'UM6', 'english', 1, '', 0),
(2, 4, 0, 'ravi.gami@test.com', 'ravigami', '', '', '0000-00-00', 'd35a6eddf18f7f5f4c4373a7973437d5043b2ed3', 'bb5334edf68f7abc7b578f0d22a30c3b2c025b1b', 'YAJKwl2', '2013-07-10 10:47:05', '127.0.0.1', '2013-07-10 10:46:44', 1, 0, NULL, 1375729570, '', NULL, 'UP55', 'english', 1, '', 0),
(3, 4, 0, 'prashant.gami@test.com', 'prashant', '', '', '0000-00-00', 'b4518443b949ee52c2b7f173ccb2129013a0041d', NULL, 'OWZTXm7', '2013-07-11 06:07:06', '127.0.0.1', '2013-07-11 06:05:34', 1, 0, NULL, NULL, '', NULL, 'UM5', 'english', 1, '', 0),
(4, 1, 0, 'pankit@gmail.com', 'panks', '', '', '0000-00-00', '9e94d1859c11843d06f67e4df04b7b87a72aaa15', NULL, '4uOoQKz', '2013-09-12 04:52:45', '127.0.0.1', '2013-08-29 16:46:53', 0, 0, NULL, NULL, 'Pankit', NULL, 'UP55', 'english', 1, '', 0),
(5, 4, 4, 'test@gmail.com', 'Test', '9898989898', 'Business', '1990-09-09', 'c3111715d2a2549910b8f4c08c9d0f7aca090850', NULL, 'Hatqk04', '0000-00-00 00:00:00', '', '2013-09-03 06:48:12', 1, 0, NULL, NULL, 'Test', NULL, 'UM6', 'english', 1, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bf_user_cookies`
--

CREATE TABLE IF NOT EXISTS `bf_user_cookies` (
  `user_id` bigint(20) NOT NULL,
  `token` varchar(128) NOT NULL,
  `created_on` datetime NOT NULL,
  KEY `token` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bf_user_cookies`
--


-- --------------------------------------------------------

--
-- Table structure for table `bf_user_meta`
--

CREATE TABLE IF NOT EXISTS `bf_user_meta` (
  `meta_id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) NOT NULL DEFAULT '',
  `meta_value` text,
  PRIMARY KEY (`meta_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `bf_user_meta`
--

INSERT INTO `bf_user_meta` (`meta_id`, `user_id`, `meta_key`, `meta_value`) VALUES
(1, 2, 'state', 'DE'),
(2, 2, 'country', 'IN'),
(3, 3, 'state', 'SC'),
(4, 3, 'country', 'US'),
(5, 3, 'type', 'small'),
(6, 4, 'state', 'NJ'),
(7, 4, 'country', 'US'),
(8, 4, 'type', 'small'),
(9, 1, 'state', '0'),
(10, 1, 'country', '0'),
(11, 1, 'type', '0');
