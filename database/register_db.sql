-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 28, 2025 at 06:52 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `register_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `booked_seats`
--

DROP TABLE IF EXISTS `booked_seats`;
CREATE TABLE IF NOT EXISTS `booked_seats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `travel_date` date DEFAULT NULL,
  `bus_name` varchar(100) DEFAULT NULL,
  `seat_number` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `travel_date` (`travel_date`,`bus_name`,`seat_number`)
) ENGINE=MyISAM AUTO_INCREMENT=241 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `booked_seats`
--

INSERT INTO `booked_seats` (`id`, `travel_date`, `bus_name`, `seat_number`) VALUES
(195, '2025-05-28', 'Non-AC(Tulsi)-7:30PM', 'L4'),
(194, '2025-05-28', 'Non-AC(Tulsi)-7:30PM', 'L3'),
(193, '2025-05-28', 'Non-AC(Tulsi)-7:30PM', 'L2'),
(192, '2025-05-28', 'Non-AC(Tulsi)-7:30PM', 'L1'),
(191, '2025-05-29', 'Non-AC(Tulsi)-7:30PM', 'L2'),
(190, '2025-05-29', 'Non-AC(Tulsi)-7:30PM', 'L1'),
(189, '2025-05-31', 'Non-AC(Tulsi)-9:30PM', 'S2'),
(188, '2025-05-31', 'Non-AC(Tulsi)-9:30PM', 'S1'),
(187, '2025-05-31', 'Non-AC(Tulsi)-9:30PM', 'L2'),
(183, '2025-05-26', 'Non-AC(Tulsi)-8:30PM', 'S1'),
(184, '2025-05-26', 'Non-AC(Tulsi)-8:30PM', 'S2'),
(185, '2025-05-26', 'Non-AC(Tulsi)-8:30PM', 'L9'),
(186, '2025-05-31', 'Non-AC(Tulsi)-9:30PM', 'L1'),
(176, '2025-05-26', 'Non-AC(Tulsi)-9:30PM', 'L4'),
(175, '2025-05-26', 'Non-AC(Tulsi)-9:30PM', 'L3'),
(174, '2025-05-26', 'Non-AC(Tulsi)-9:30PM', 'L2'),
(173, '2025-05-26', 'Non-AC(Tulsi)-9:30PM', 'L1'),
(172, '2025-05-26', 'Non-AC(Tulsi)-8:30PM', 'S6'),
(171, '2025-05-26', 'Non-AC(Tulsi)-8:30PM', 'S5'),
(170, '2025-05-26', 'Non-AC(Tulsi)-8:30PM', 'L5'),
(169, '2025-05-26', 'Non-AC(Tulsi)-8:30PM', 'L4'),
(168, '2025-05-26', 'Non-AC(Tulsi)-8:30PM', 'L3'),
(166, '2025-05-27', 'Non-AC(Tulsi)-9:30PM', 'L5'),
(165, '2025-05-23', 'Non-AC(Tulsi)-8:30PM', 'L6'),
(164, '2025-05-26', 'Non-AC(Tulsi)-8:30PM', 'L6'),
(163, '2025-05-26', 'Non-AC(Tulsi)-8:30PM', 'L1'),
(162, '2025-05-29', 'Non-AC(Tulsi)-8:30PM', 'L1'),
(161, '2025-05-23', 'AC Bus(Dolphin)-7:45PM', 'L1'),
(160, '2025-05-15', 'Non-AC(Tulsi)-7:30PM', 'L1'),
(159, '2025-05-13', 'Non-AC(Tulsi)-8:30PM', 'L1'),
(158, '2025-05-20', 'AC Bus-(Dolphin)7:45 PM', 'L7'),
(157, '2025-05-12', 'AC Bus(Dolphin)-7:45PM', 'L4'),
(156, '2025-05-12', 'Non-AC(Tulsi)-7:30PM', 'L7'),
(155, '2025-05-16', 'AC Bus-(Dolphin)7:45 PM', 'L4'),
(153, '2025-05-20', 'AC Bus-(Dolphin)7:45 PM', 'L1'),
(154, '2025-05-14', 'Non-AC(Tulsi)-8:30PM', 'S6'),
(150, '2025-05-12', 'Non-AC(Tulsi)-7:30PM', 'L2'),
(149, '2025-05-12', 'Non-AC(Tulsi)-7:30PM', 'L1'),
(148, '2025-05-13', 'Non-AC(Tulsi)-7:30PM', 'L1'),
(147, '2025-05-11', 'Non-AC(Tulsi)-8:30PM', 'L1'),
(145, '2025-05-11', 'Non-AC(Tulsi)-7:30PM', 'S7'),
(144, '2025-05-11', 'Non-AC(Tulsi)-7:30PM', 'L7'),
(143, '2025-05-11', 'Non-AC(Tulsi)-7:30PM', 'L6'),
(142, '2025-05-11', 'Non-AC(Tulsi)-7:30PM', 'L5'),
(141, '2025-05-11', 'Non-AC(Tulsi)-7:30PM', 'S5'),
(140, '2025-05-12', 'Non-AC(Tulsi)-8:30PM', 'S2'),
(139, '2025-05-12', 'Non-AC(Tulsi)-8:30PM', 'S1'),
(138, '2025-05-12', 'Non-AC(Tulsi)-8:30PM', 'L2'),
(137, '2025-05-12', 'Non-AC(Tulsi)-8:30PM', 'L1'),
(136, '2025-05-11', 'Non-AC(Tulsi)-7:30PM', 'L4'),
(146, '2025-05-11', 'Non-AC(Tulsi)-7:30PM', 'L1'),
(197, '2025-05-28', 'Non-AC(Tulsi)-7:30PM', 'L8'),
(198, '2025-05-28', 'Non-AC(Tulsi)-7:30PM', 'L9'),
(240, '2025-12-25', 'Non-AC(Tulsi)-8:30PM', 'S4'),
(239, '2025-12-25', 'Non-AC(Tulsi)-8:30PM', 'S3'),
(204, '2025-05-29', 'AC Bus-(Dolphin)7:45 PM', 'S1'),
(205, '2025-05-29', 'AC Bus-(Dolphin)7:45 PM', 'S2'),
(206, '2025-05-29', 'AC Bus-(Dolphin)7:45 PM', 'S3'),
(207, '2025-05-29', 'AC Bus-(Dolphin)7:45 PM', 'S4'),
(237, '2025-12-25', 'Non-AC(Tulsi)-8:30PM', 'S1'),
(209, '2025-05-28', 'AC Bus-(Dolphin)7:45 PM', 'S1'),
(210, '2025-05-28', 'AC Bus-(Dolphin)7:45 PM', 'L1'),
(211, '2025-05-28', 'AC Bus-(Dolphin)7:45 PM', 'L2'),
(238, '2025-12-25', 'Non-AC(Tulsi)-8:30PM', 'S2'),
(213, '2025-05-28', 'AC Bus-(Dolphin)7:45 PM', 'L6'),
(214, '2025-05-29', 'Non-AC(Tulsi)-8:30PM', 'L6'),
(215, '2025-05-28', 'AC Bus-(Dolphin)7:45 PM', 'S2'),
(233, '2025-06-02', 'Non-AC(Tulsi)-8:30PM', 'S4'),
(232, '2025-06-02', 'Non-AC(Tulsi)-8:30PM', 'S3'),
(231, '2025-06-02', 'Non-AC(Tulsi)-8:30PM', 'S2'),
(219, '2025-06-03', 'AC Bus(Dolphin)-7:45PM', 'L3'),
(220, '2025-05-29', 'AC Bus-(Dolphin)7:45 PM', 'S5'),
(230, '2025-06-02', 'Non-AC(Tulsi)-8:30PM', 'S1'),
(229, '2025-06-02', 'Non-AC(Tulsi)-8:30PM', 'L7'),
(228, '2025-06-02', 'Non-AC(Tulsi)-8:30PM', 'L2'),
(227, '2025-06-02', 'Non-AC(Tulsi)-8:30PM', 'L1'),
(226, '2025-06-03', 'AC Bus(Dolphin)-7:45PM', 'L4');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_id` varchar(20) DEFAULT NULL,
  `source` varchar(50) DEFAULT NULL,
  `destination` varchar(50) DEFAULT NULL,
  `travel_date` date DEFAULT NULL,
  `bus_name` varchar(100) DEFAULT NULL,
  `seat_numbers` text,
  `total_cost` int(11) DEFAULT NULL,
  `booked_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `payment_method` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `booking_id` (`booking_id`)
) ENGINE=MyISAM AUTO_INCREMENT=216 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `booking_id`, `source`, `destination`, `travel_date`, `bus_name`, `seat_numbers`, `total_cost`, `booked_at`, `email`, `phone`, `payment_method`) VALUES
(202, 'BK6837197C1F494', 'Udupi(City-BusStand)', 'Majestic(kempegowda bus-stand)', '2025-05-29', 'AC Bus-(Dolphin)7:45 PM', 'S5', 921, '2025-05-28 14:11:08', 'anujnya01@gmail.com', '8976767878', 'upi'),
(214, 'BK69305E720E6FE', 'Manipal', 'Madiwala', '2025-12-25', 'Non-AC(Tulsi)-8:30PM', 'S1', 817, '2025-12-03 15:59:46', 'vani@gmail.com', '8795798769', 'upi'),
(212, 'BOOK69304FFC2BF7B', 'City A', 'City B', '2025-12-26', 'Non-AC(Tulsi)-8:30PM', '', 860, '2025-12-03 14:58:04', 'anujnya01@gmail.com', '6767676767', 'Not selected'),
(201, 'BK6835518661059', 'Udupi(City-BusStand)', 'Majestic(kempegowda bus-stand)', '2025-06-03', 'AC Bus(Dolphin)-7:45PM', 'L3', 750, '2025-05-27 05:45:42', 'anujnya01@gmail.com', '8976767878', 'upi'),
(197, 'BK6832E173B9FA6', 'Udupi(City-BusStand)', 'Majestic(kempegowda bus-stand)', '2025-05-29', 'Non-AC(Tulsi)-8:30PM', 'L6', 870, '2025-05-25 09:22:59', 'anujnya01@gmail.com', '9887087768', 'card'),
(198, 'BK6832E5CBB1040', 'Udupi(City-BusStand)', 'Madiwala', '2025-05-28', 'AC Bus-(Dolphin)7:45 PM', 'S2', 980, '2025-05-25 09:41:31', 'akash01@gmail.com', '9887087768', 'card'),
(196, 'BK6832E129E14DA', 'Udupi(City-BusStand)', 'Majestic(kempegowda bus-stand)', '2025-05-28', 'AC Bus-(Dolphin)7:45 PM', 'L6', 921, '2025-05-25 09:21:45', 'anujnya01@gmail.com', '9887087768', 'upi'),
(194, 'BK6832DEF83C026', 'Udupi(City-BusStand)', 'Majestic(kempegowda bus-stand)', '2025-05-28', 'AC Bus-(Dolphin)7:45 PM', 'L1,L2', 1843, '2025-05-25 09:12:24', 'alank@gmail.com', '8897945252', 'upi'),
(215, 'BK693062F989AD4', 'Udupi(City-BusStand)', 'Majestic(kempegowda bus-stand)', '2025-12-25', 'Non-AC(Tulsi)-8:30PM', 'S2,S3,S4', 2451, '2025-12-03 16:19:05', 'anujnya01@gmail.com', '6767676767', 'upi'),
(193, 'BK6832DE946D4B7', 'Udupi(City-BusStand)', 'Majestic(kempegowda bus-stand)', '2025-05-28', 'AC Bus-(Dolphin)7:45 PM', 'S1', 921, '2025-05-25 09:10:44', 'varsha123@gmail.com', '8976767878', 'upi'),
(210, 'BK6839363E87092', 'Udupi(City-BusStand)', 'Majestic(kempegowda bus-stand)', '2025-06-02', 'Non-AC(Tulsi)-8:30PM', 'S1,S2,S3,S4', 3268, '2025-05-30 04:38:22', 'anujnya01@gmail.com', '6767676767', 'upi'),
(209, 'BK68387D8602CA5', 'Udupi(City-BusStand)', 'Majestic(kempegowda bus-stand)', '2025-06-02', 'Non-AC(Tulsi)-8:30PM', 'L7', 870, '2025-05-29 15:30:14', 'anujnya01@gmail.com', '6767676767', 'card'),
(208, 'BK68387D37718E6', 'Manipal', 'Yeshwanthpur', '2025-06-02', 'Non-AC(Tulsi)-8:30PM', 'L1,L2', 1634, '2025-05-29 15:28:55', 'stuthi123@gmail.com', '9980786777', 'upi'),
(191, 'BK6832D9110575A', 'Udupi(City-BusStand)', 'Majestic(kempegowda bus-stand)', '2025-05-29', 'AC Bus-(Dolphin)7:45 PM', 'S1,S2,S3,S4', 3890, '2025-05-25 08:47:13', 'anujnya02@gmail.com', '9887087768', 'card'),
(188, 'BK6832D429A83CF', 'Udupi(City-BusStand)', 'Majestic(kempegowda bus-stand)', '2025-05-28', 'Non-AC(Tulsi)-7:30PM', 'L8,L9', 1662, '2025-05-25 08:26:17', 'anujnya01@gmail.com', '8976767878', 'upi'),
(207, 'BK68371E02D1E5F', 'Udupi(City-BusStand)', 'Majestic(kempegowda bus-stand)', '2025-06-03', 'AC Bus(Dolphin)-7:45PM', 'L4', 750, '2025-05-28 14:30:26', 'varsha123@gmail.com', '8976767878', 'upi'),
(186, 'BK6831F5CE892A1', 'Udupi(City-BusStand)', 'Majestic(kempegowda bus-stand)', '2025-05-28', 'Non-AC(Tulsi)-7:30PM', 'L1,L2,L3,L4', 3325, '2025-05-24 16:37:34', 'anujnya01@gmail.com', '9887087768', 'upi'),
(185, 'BK6831F599C34C5', 'Manipal', 'Madiwala', '2025-05-29', 'Non-AC(Tulsi)-7:30PM', 'L1,L2', 1662, '2025-05-24 16:36:41', 'anujnya01@gmail.com', '9887087768', 'upi'),
(183, 'BK6828C4D5381D7', 'Manipal', 'Mdiwala', '2025-05-26', 'Non-AC(Tulsi)-8:30PM', 'S1,S2,L9', 2451, '2025-05-17 17:18:13', 'xavier123@gmail.com', '9879887879', 'upi'),
(184, 'BK68296B2D7D823', 'Udupi(City-BusStand)', 'Majestic(kempegowda bus-stand)', '2025-05-31', 'Non-AC(Tulsi)-9:30PM', 'L1,L2,S1,S2', 3010, '2025-05-18 05:07:57', 'anujnya01@gmail.com', '9887998767', 'card'),
(181, 'BK6828C37B7192A', 'Udupi(City-BusStand)', 'Majestic(kempegowda bus-stand)', '2025-05-26', 'Non-AC(Tulsi)-9:30PM', 'L1,L2,L3,L4', 2850, '2025-05-17 17:12:27', 'anujnya01@gmail.com', '8879664644', 'upi'),
(179, 'BK6828C3296284F', 'Udupi(City-BusStand)', 'Majestic(kempegowda bus-stand)', '2025-05-26', 'Non-AC(Tulsi)-8:30PM', 'L3,L4,L5', 2451, '2025-05-17 17:11:05', 'anujnya01@gmail.com', '8879664644', 'upi'),
(180, 'BK6828C34CC175C', 'Udupi(City-BusStand)', 'Majestic(kempegowda bus-stand)', '2025-05-26', 'Non-AC(Tulsi)-8:30PM', 'S5,S6', 1634, '2025-05-17 17:11:40', 'anujnya01@gmail.com', '8879664644', 'upi'),
(177, 'BK68273BB472D00', 'Udupi(City-BusStand)', 'Majestic(kempegowda bus-stand)', '2025-05-27', 'Non-AC(Tulsi)-9:30PM', 'L5', 712, '2025-05-16 13:20:52', 'varsha123@gmail.com', '9989663554', 'upi'),
(176, 'BK68248AE40CCDF', 'Manipal', 'Mdiwala', '2025-05-23', 'Non-AC(Tulsi)-8:30PM', 'L6', 870, '2025-05-14 12:21:56', 'varsha123@gmail.com', '9989663554', 'card'),
(175, 'BK68248A9C352F9', 'Kinnimulki', 'Yeshwanthpur', '2025-05-26', 'Non-AC(Tulsi)-8:30PM', 'L6', 870, '2025-05-14 12:20:44', 'varsha123@gmail.com', '9989663554', 'card'),
(173, 'BK6824895382FE2', 'Manipal', 'Yeshwanthpur', '2025-05-29', 'Non-AC(Tulsi)-8:30PM', 'L1', 817, '2025-05-14 12:15:15', 'varsha123@gmail.com', '9989663554', 'upi'),
(174, 'BK68248A20604F6', 'Kinnimulki', 'Yeshwanthpur', '2025-05-26', 'Non-AC(Tulsi)-8:30PM', 'L1', 817, '2025-05-14 12:18:40', 'varsha123@gmail.com', '9989663554', 'upi'),
(172, 'BK682489124E699', 'Manipal', 'Yeshwanthpur', '2025-05-23', 'AC Bus(Dolphin)-7:45PM', 'L1', 750, '2025-05-14 12:14:10', 'anujnya01@gmail.com', '6767676767', 'upi'),
(171, 'BK6824884ED4DD5', 'Kinnimulki', 'Yeshwanthpur', '2025-05-15', 'Non-AC(Tulsi)-7:30PM', 'L1', 831, '2025-05-14 12:10:54', 'anujnya01@gmail.com', '6767676767', 'upi'),
(169, 'BK6820325F9B24A', 'Manipal', 'Mdiwala', '2025-05-20', 'AC Bus-(Dolphin)7:45 PM', 'L7', 921, '2025-05-11 05:15:11', 'varsha123@gmail.com', '9989663554', 'upi'),
(170, 'BK68218803C6C4B', 'Kinnimulki', 'Yeshwanthpur', '2025-05-13', 'Non-AC(Tulsi)-8:30PM', 'L1', 817, '2025-05-12 05:32:51', 'varsha123@gmail.com', '9989663554', 'upi'),
(167, 'BK6820310FDC4A0', 'Udupi(City-BusStand)', 'Majestic(kempegowda bus-stand)', '2025-05-12', 'Non-AC(Tulsi)-7:30PM', 'L7', 831, '2025-05-11 05:09:35', 'varsha123@gmail.com', '9989663554', 'upi'),
(168, 'BK682032014FF3C', 'Udupi(City-BusStand)', 'Majestic(kempegowda bus-stand)', '2025-05-12', 'AC Bus(Dolphin)-7:45PM', 'L4', 750, '2025-05-11 05:13:37', 'varsha123@gmail.com', '9989663554', 'upi'),
(164, 'BK68202E711DED4', 'Kaup', 'Navarang/Rajajinagar', '2025-05-20', 'AC Bus-(Dolphin)7:45 PM', 'L1', 921, '2025-05-11 04:58:25', 'vidhyakumari1@gmail.com', '7866457900', 'upi'),
(165, 'BK68202FBBB4BD7', 'Udupi(City-BusStand)', 'Majestic(kempegowda bus-stand)', '2025-05-14', 'Non-AC(Tulsi)-8:30PM', 'S6', 870, '2025-05-11 05:03:55', 'anujnya01@gmail.com', '9987866688', 'card'),
(161, 'BK681F9D1EAB751', 'Manipal', 'Yeshwanthpur', '2025-05-12', 'Non-AC(Tulsi)-7:30PM', 'L1', 831, '2025-05-10 18:38:22', 'anujnya01@gmail.com', '7866457900', 'upi'),
(162, 'BK681F9EE7AA513', 'Manipal', 'Yeshwanthpur', '2025-05-12', 'Non-AC(Tulsi)-7:30PM', 'L2', 831, '2025-05-10 18:45:59', 'anujnya01@gmail.com', '7866457900', 'upi'),
(160, 'BK681F9BE891AEF', 'Manipal', 'Yeshwanthpur', '2025-05-13', 'Non-AC(Tulsi)-7:30PM', 'L1', 831, '2025-05-10 18:33:12', 'anujnya01@gmail.com', '7866457900', 'upi'),
(166, 'BK682030408F488', 'Udupi(City-BusStand)', 'Majestic(kempegowda bus-stand)', '2025-05-16', 'AC Bus-(Dolphin)7:45 PM', 'L4', 921, '2025-05-11 05:06:08', 'anujnya01@gmail.com', '9987866688', 'upi'),
(156, 'BK681F5F8C6442F', 'Manipal', 'Yeshwanthpur', '2025-05-11', 'Non-AC(Tulsi)-7:30PM', 'S7', 831, '2025-05-10 14:15:40', 'umesh@gmail.com', '8698748678', 'upi'),
(155, 'BK681F5F3036930', 'Manipal', 'Yeshwanthpur', '2025-05-11', 'Non-AC(Tulsi)-7:30PM', 'L5,L6,L7', 2493, '2025-05-10 14:14:08', 'umesh@gmail.com', '8698748678', 'upi'),
(154, 'BK681F5D8BDDC58', 'Kinnimulki', 'Yeshwanthpur', '2025-05-11', 'Non-AC(Tulsi)-7:30PM', 'S5', 831, '2025-05-10 14:07:07', 'varsha123@gmail.com', '8976767878', 'upi'),
(158, 'BK681F9A9985C94', 'Udupi(City-BusStand)', 'Majestic(kempegowda bus-stand)', '2025-05-11', 'Non-AC(Tulsi)-8:30PM', 'L1', 817, '2025-05-10 18:27:37', 'anujnya01@gmail.com', '7866457900', 'upi'),
(153, 'BK681F580367E30', 'Manipal', 'Yeshwanthpur', '2025-05-12', 'Non-AC(Tulsi)-8:30PM', 'S1,S2', 1634, '2025-05-10 13:43:31', 'anujnya01@gmail.com', '8976785437', 'upi'),
(157, 'BK681F984C37432', 'Manipal', 'Mdiwala', '2025-05-11', 'Non-AC(Tulsi)-7:30PM', 'L1', 885, '2025-05-10 18:17:48', 'anujnya01@gmail.com', '7866457900', 'card');

-- --------------------------------------------------------

--
-- Table structure for table `buses`
--

DROP TABLE IF EXISTS `buses`;
CREATE TABLE IF NOT EXISTS `buses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bus_name` varchar(100) NOT NULL,
  `bus_time` time NOT NULL,
  `cost` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `buses`
--

INSERT INTO `buses` (`id`, `bus_name`, `bus_time`, `cost`) VALUES
(4, 'Non-AC(Tulsi)-9:30PM', '21:30:00', 750),
(5, 'AC Bus-(Dolphin)7:45 PM', '19:45:00', 970),
(6, 'Non-AC(Tulsi)-8:30PM', '20:30:00', 860),
(7, 'AC Bus(Dolphin)-7:45PM', '19:45:00', 790),
(8, 'Non-AC(Tulsi)-7:30PM', '19:30:00', 875),
(9, 'AC Bus (Canara)- 9:45PM	', '21:45:00', 860);

-- --------------------------------------------------------

--
-- Table structure for table `canceled_bookings`
--

DROP TABLE IF EXISTS `canceled_bookings`;
CREATE TABLE IF NOT EXISTS `canceled_bookings` (
  `cancel_id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_id` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_phone` varchar(20) DEFAULT NULL,
  `travel_date` date DEFAULT NULL,
  `bus_name` varchar(255) DEFAULT NULL,
  `seat_numbers` text,
  `cancel_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cancel_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `canceled_bookings`
--

INSERT INTO `canceled_bookings` (`cancel_id`, `booking_id`, `user_name`, `user_phone`, `travel_date`, `bus_name`, `seat_numbers`, `cancel_time`) VALUES
(4, 'BK681F554160100', 'ramesh123@gmail.com', '7864557654', '2025-05-11', 'Non-AC(Tulsi)-7:30PM', 'L1', '2025-05-10 14:20:06'),
(8, 'BK6832D4D7F241D', 'anujnya01@gmail.com', '8976767878', '2025-05-31', 'AC Bus(Canara) - 8:00 PM	', 'L5,L6', '2025-05-25 08:39:53'),
(5, 'BK682020DDA11EE', 'vidhyakumari1@gmail.com', '7866457900', '2025-05-12', 'AC Bus(Dolphin)-7:45PM', 'L1,L2', '2025-05-11 04:03:55'),
(6, 'BK68273E7C2C4CA', 'anujnya01@gmail.com', '6767676767', '2025-05-29', 'AC Bus-(Dolphin)7:45 PM', 'L5', '2025-05-16 13:34:14'),
(7, 'BK6828C3BD4A8A4', 'anujnya01@gmail.com', '8879664644', '2025-05-26', 'Non-AC(Tulsi)-7:30PM', 'L1,L2,L3,L4,L5,L6', '2025-05-17 17:13:51'),
(9, 'BK68395F1034C39', 'abc@gmail.com', '6767676767', '2025-06-02', 'Non-AC(Tulsi)-9:30PM', 'L1,L2', '2025-05-30 07:34:56'),
(10, 'BK693051BC26CF9', 'abc@gmail.com', '6767676767', '2025-12-04', 'AC Bus (Canara)- 9:45PM	', 'S1', '2025-12-03 15:06:03');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `message` text,
  `submitted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `rating`, `message`, `submitted_at`) VALUES
(1, 'anujnya g bhandary', 'anujnya01@gmail.com', 3, 'good facility', '2025-05-14 13:44:23'),
(2, 'xavier', 'xavier123@gmail.com', 4, 'good service', '2025-05-17 17:19:17'),
(3, 'ranjan', 'ranjan1234@gmail.com', 5, 'website is user-friendly', '2025-05-27 04:33:04');

-- --------------------------------------------------------

--
-- Table structure for table `passengers`
--

DROP TABLE IF EXISTS `passengers`;
CREATE TABLE IF NOT EXISTS `passengers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_id` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `booking_id` (`booking_id`)
) ENGINE=MyISAM AUTO_INCREMENT=159 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `passengers`
--

INSERT INTO `passengers` (`id`, `booking_id`, `name`, `age`, `gender`) VALUES
(158, 'BK693062F989AD4', 'anujnya g bhandary', 45, 'Male'),
(157, 'BK693062F989AD4', 'anujnya g bhandary', 56, 'Male'),
(156, 'BK693062F989AD4', 'vani', 34, 'Male'),
(155, 'BK69305E720E6FE', 'vani', 34, 'Female'),
(153, 'BOOK69304FFC2BF7B', 'anujnya g bhandary', 67, 'Female'),
(150, 'BK6839363E87092', 'anujnya g bhandary', 34, 'Female'),
(149, 'BK6839363E87092', 'stuthi shanon', 23, 'Female'),
(148, 'BK6839363E87092', 'varsha davis', 23, 'Female'),
(147, 'BK6839363E87092', 'vidhya', 24, 'Female'),
(145, 'BK68387D37718E6', 'sharan', 56, 'Male'),
(146, 'BK68387D8602CA5', 'anujnya g bhandary', 23, 'Female'),
(144, 'BK68387D37718E6', 'stuthi', 34, 'Female'),
(143, 'BK68371E02D1E5F', 'varsha ', 34, 'Female'),
(142, 'BK68371D4F17550', 'varsha davis', 34, 'Female'),
(140, 'BK68371C5D3E24F', 'ranjan', 45, 'Male'),
(141, 'BK68371CC08A2A8', 'varsha davis', 34, 'Female'),
(139, 'BK68371B5000657', 'ranjitha', 45, 'Female'),
(138, 'BK68371B5000657', 'ranjan', 45, 'Male'),
(137, 'BK6837197C1F494', 'anujnya g bhandary', 45, 'Female'),
(136, 'BK6835518661059', 'anujnya g bhandary', 45, 'Female'),
(135, 'BK68354DF8A4FFB', 'ranjan', 45, 'Male'),
(134, 'BK68353FEF04350', 'ranjitha', 45, 'Female'),
(133, 'BK68353FEF04350', 'ranjan', 45, 'Male'),
(132, 'BK6832E5CBB1040', 'akash', 24, 'Male'),
(131, 'BK6832E173B9FA6', 'veena', 24, 'Female'),
(130, 'BK6832E129E14DA', 'veena', 24, 'Female'),
(128, 'BK6832DEF83C026', 'alok', 23, 'Male'),
(129, 'BK6832E0EFBE532', 'vidhya', 24, 'Female'),
(127, 'BK6832DEF83C026', 'alank', 23, 'Male'),
(126, 'BK6832DE946D4B7', 'varsha davis', 45, 'Female'),
(125, 'BK6832DBC653561', 'varsha davis', 45, 'Female'),
(124, 'BK6832D9110575A', 'vidhya', 24, 'Female'),
(123, 'BK6832D9110575A', 'veena', 23, 'Female'),
(122, 'BK6832D9110575A', 'varsha davis', 24, 'Female'),
(121, 'BK6832D9110575A', 'anujnya g bhandary', 23, 'Female'),
(120, 'BK6832D84389A77', 'narayan', 34, 'Male'),
(119, 'BK6832D84389A77', 'nayana', 34, 'Female'),
(118, 'BK6832D84389A77', 'naveen', 23, 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

DROP TABLE IF EXISTS `registration`;
CREATE TABLE IF NOT EXISTS `registration` (
  `reg_id` int(10) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` bigint(15) NOT NULL,
  `password` varchar(60) NOT NULL,
  PRIMARY KEY (`reg_id`),
  UNIQUE KEY `reg_id` (`reg_id`,`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=73 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`reg_id`, `firstname`, `lastname`, `username`, `email`, `phone`, `password`) VALUES
(46, 'umesh', 'k', 'umesh@k', 'umesh@gmail.com', 8978988788, '$2y$10$jRx7KphmHqXiKypKhUPPt.SFC8qTx9LCiZQGVl/UiFvPjEW14E2wC'),
(47, 'akshay', 'k', 'akshay_k', 'akshay23@gmail.com', 7865456756, '$2y$10$kP3zLh1VVFt0SdmNaFJz5.dTdhLMwQ.BM2g5QZkQreB1V5re3YhT2'),
(48, 'bhim', 'chand', 'bhim_chand', 'bhim123@gmail.com', 9987896575, '$2y$10$zau4V4dRgn7knaHYzfBSVeAV1kXNaegmx3UvyyrrO.LqDm8EKr4p2'),
(49, 'kamal', 's', 'kamal_s', 'kamal@gmail.com', 8997676898, '$2y$10$8xrGwiEhAYB0if9ecmaVguJ6HUbJz6x.Q2JcbVwCrfxx7..9fPlGy'),
(50, 'usha', 'fernandis', 'usha_f', 'usha@gmail.com', 9908789643, '$2y$10$Hmbu.2lP6bRkmRvOnLkXleQ81g4mBcedzEgCgspESaaGM1bVqmFOm'),
(51, 'lokesh', 'nath', 'lokesh@', 'lok@gmail.com', 9980989789, '$2y$10$ugEHmDVz2UVt8ZC8KJzAYeyxONFZxYQEXRyBsPCmcyPVnByodcJ6a'),
(52, 'prajwal', 'b', 'prajwal_@', 'prajwal@gmail.com', 9980786894, '$2y$10$JnSJTk6JhdP5gcwaXmwFaOl7mHADPSXcS0OdOCC1hEf5CDYlupSmK'),
(53, 'anujnya', 'kumari', 'anujnya@', 'varsha123@gmail.com', 9989787680, '$2y$10$PjiEI21N2ujZsQ.4O.wxf.aNVSve4531vSTf6x8FZdOvfcL.yobtS'),
(54, 'asha', 'latha', 'asha@k', 'anujnya01@gmail.com', 6767676767, '$2y$10$5505r8D3OkjUmn/68C6evOkdxY6J/F7/grtToab13q1eI1JtbFm1.'),
(55, 'akash', 'kumar', 'akash@k', 'akash123@gmail.com', 8796678896, '$2y$10$RB31nJV8/45FT23cXLufGOsqExUOfqDeNPHToR.CsLocJMewDhh0S'),
(56, 'veena', 'sharma', 'veena@', 'veena123@gmail.com', 9989078643, '$2y$10$f.MqtfG2Qp9gEzC1gH/hT.FAvTYRI.bm6DmIZh8heKGddCXL46phm'),
(57, 'varsha', 'kumari', 'varsha@123', 'varsha1234@gmail.com', 9987878867, '$2y$10$G4T77iaJHJN6n9sHZGGL/ebkLG3s4b1xVH5tbgPiGmpl751GpfHaa'),
(58, 'varsha', 'kumari', 'varsha@1234', 'varsha12345@gmail.com', 9987878877, '$2y$10$iCHy6coq8TO.hnlJBarYveUyjjE8jZ/MB4Nv4nFGlmAkhAe/bN9sm'),
(59, 'varsha', 'kumari', 'varsha@12345', 'varsha123456@gmail.com', 9987878897, '$2y$10$llb7/NO.F5go9UCof8mDyuVJca.QUKJBDntTI/jnAmRVQ304YSXU6'),
(60, 'priya', 'sharma', 'priya@1', 'priya@gmail.com', 7834766554, '$2y$10$U7qRCeyB3wGLOgzVFAVR3.OykhAxldxl4kRRGILlrNsKPXuT.Hl6a'),
(61, 'ramesh', 'kumar', 'ramesh@1', 'ramesh123@gmail.com', 7768564987, '$2y$10$m2rEIGFil0ue6cB5D3V69u9ZNUf43hsDcAxRdpJ63GrngZ/DVyLnO'),
(62, 'vidhya', 'kumari', 'vidhya@1', 'vidhyakumari1@gmail.com', 8977675546, '$2y$10$85XOzGCV1Lho6PRCjTATSucxcVx4qL7GfT/BUZmnTmt2yGpY393Ti'),
(63, 'xavier', 'john', 'xavier@1', 'xavier123@gmail.com', 9984665856, '$2y$10$WJRtix2ZBHBHtPYkxdH8eOGLkrFBiHSwu8USBIs1bovNlEqOngqti'),
(64, 'naveen', 'kumar', 'naveen@k', 'naveen345@gmail.com', 8977688678, '$2y$10$Adg1J5XLzVy/F9JQq8OT4.XD3Ecd/p2meieWFPmM4LTgWjTOF9Rce'),
(65, 'ranjan', 'mani', 'ranjan@mani', 'ranjan1234@gmail.com', 9980786423, '$2y$10$L6FSDskoliQelYfE8mCasuK/zIiVe2STejonQU4ZhFF6qmBh66HqK'),
(66, 'stuthi', 'shanon', 'stuthi@s', 'stuthi123@gmail.com', 9980786777, '$2y$10$tHoSfTQ73UoUr2ZgL7MYseduqZh/CBeefXbGIzFs1po8OPfIpdkqO'),
(67, 'thanusha', 'k', 'umesh@k1', 'thanusha@gmail.com', 8759679893, '$2y$10$uLZmcG2kzAQsEi/mh3sydOmJTokDAOxHLLrYFTvFiOxz37q70UxjW'),
(68, 'ashwini', 'achar', 'ashu_06', 'ashuka16@gmail.com', 8957946893, '$2y$10$zu6l1Q4zASkxzJhRz6UG.uUZk60PqUKaFLpWv3aryNGDvP0MeZz7q'),
(69, 'prakash', '.', 'Prakash_06', 'abc@gmail.com', 9765432123, '$2y$10$m2WoKqUM9UBwlevi7FPZJ.rjhxV6K3d5W3uzSZ0KPODUO8NZXnJxO'),
(70, 'anujnya', 'bhandary', 'anujnya', 'anujnya@gmail.com', 9876543219, '$2y$10$1XJ71z9OEGGR3JeMbqyE0./2FlcjAjdpX3QDy1ZTOZ97ST1EyYzV6'),
(71, 'vani', 'lara', 'vani@123', 'vani@gmail.com', 7388738467, '$2y$10$ejTWG3zpfZ3iiYSCIhUvmu4bf9E8h2Cfb78.g813twvnge1wJF3vW'),
(72, 'djhfhs', 'ljlskjdflksj', 'dhfiuwhf', 'ldjfjdjli@jdfhkjdfh.com', 8748298649, '$2y$10$7qEA4u0E5EQfihybQy9wIuEUIAVUsXWjIJZcEjzp4xDiXvl7TyIRK');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
