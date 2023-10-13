-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2023 at 07:31 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hostel`
--
-- CREATE DATABASE
CREATE DATABASE IF NOT EXISTS `hostel`;

-- Use the created TABLE
USE `hostel`;
-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(4) UNSIGNED ZEROFILL NOT NULL,
  `category_name` varchar(64) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `description`) VALUES
(0001, 'category A', NULL),
(0002, 'Category B', NULL),
(0003, 'Category C', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hostels`
--

CREATE TABLE IF NOT EXISTS `hostels` (
  `hostel_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `hostel_name` varchar(128) NOT NULL,
  `owner_id` int(4) UNSIGNED ZEROFILL DEFAULT NULL,
  `city` varchar(64) DEFAULT NULL,
  `category_id` int(4) UNSIGNED ZEROFILL DEFAULT NULL,
  `contact_no` varchar(64) DEFAULT NULL,
  `pincode` varchar(32) DEFAULT NULL,
  `seat_availability` varchar(64) DEFAULT NULL,
  `county` varchar(64) DEFAULT NULL,
  `charge_triple` float(10,2) DEFAULT NULL,
  `charge_single` float(10,2) DEFAULT NULL,
  `charge_double` float(10,2) DEFAULT NULL,
  `cap_single` int(11) DEFAULT NULL,
  `cap_double` int(11) DEFAULT NULL,
  `cap_triple` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hostels`
--

INSERT INTO `hostels` (`hostel_id`, `hostel_name`, `owner_id`, `city`, `category_id`, `contact_no`, `pincode`, `seat_availability`, `county`, `charge_triple`, `charge_single`, `charge_double`, `cap_single`, `cap_double`, `cap_triple`) VALUES
(000001, 'Maskani Apartments', 0087, 'Mombasa', 0001, '0755258454', '01000', 'YES', 'Mombasa', 2500.00, 8000.00, 4000.00, 10, 7, 6),
(000002, 'Highrise Hostels', 0098, 'Nairobi', 0002, '0758986523', '01200', 'YES', 'Nairobi', 4000.00, 7500.00, 6000.00, 5, 2, 3),
(000005, 'Makaazi bora Apartments', 0001, 'Kisumu', 0001, '07456879652', '12300', 'YES', 'Kisumu', 4000.00, 12000.00, 6500.00, 12, 12, 2),
(000010, 'Nakuru Ironsides', 0002, 'Nakuru', 0001, '0246543635456', '024645', 'YES', 'Nakuru', 5000.00, 15000.00, 7500.00, 15, 7, 4),
(000012, 'Restfull Hostels', 0003, 'Muranga', 0002, '0325478964', '0022', 'YES', 'Murang\'a', 3000.00, 5000.00, 2500.00, 15, 0, 16),
(000016, 'Aftermath Heights', 0004, 'Isiolo', 0003, '657654654', '125020', 'YES', 'Garissa', 2500.00, 7500.00, 3750.00, 71, 7, 25),
(000024, 'Gwababa Riverside', 0005, 'Thika', 0003, '0124536987', '03020', 'YES', 'Kiambu', 3000.00, 9000.00, 4500.00, 2, 23, 5),
(000365, 'HighSkies', 0003, 'Muranga', 0001, '06545654546', '032341', 'NO', 'Murang\'a', 2000.00, 6000.00, 3000.00, 0, 0, 0),
(000366, 'Makejani', 0000, 'Naivasha', 0003, '0546416678', '022120', 'YES', 'Rift Valley', 3500.00, 10000.00, 5000.00, 12, 1, 0),
(000371, 'Keja Zetu', 0000, 'Thika', 0003, '0790431217', '01000', 'YES', 'Kiambu', 3500.00, 10000.00, 5000.00, 12, 2, 21),
(000374, 'Concrete homes', 0000, 'Thika', 0001, '023135435456', '01000', 'NO', 'Kiambu', 5000.00, 15000.00, 7500.00, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `owners`
--

CREATE TABLE IF NOT EXISTS `owners` (
  `owner_id` int(4) UNSIGNED ZEROFILL NOT NULL,
  `name` varchar(128) NOT NULL,
  `username` varchar(64) DEFAULT NULL,
  `email` varchar(64) NOT NULL,
  `phoneno` varchar(64) NOT NULL,
  `password` varchar(512) DEFAULT NULL,
  `otp_code` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `owners`
--

INSERT INTO `owners` (`owner_id`, `name`, `username`, `email`, `phoneno`, `password`, `otp_code`) VALUES
(0000, 'Admin ', 'admin', 'admin@email.test', '01335658754', '21232f297a57a5a743894a0e4a801fc3', 'RM09LO'),
(0001, 'Damian Njoroge', 'damian', 'damian@email.test', '03565456456', '21232f297a57a5a743894a0e4a801fc3', NULL),
(0002, 'Nathan Ochuka', 'nate', 'nate@email.com', '032646854654', '21232f297a57a5a743894a0e4a801fc3', NULL),
(0003, 'Ashleys Limited', 'ashe', 'ash@email.com', '031263463465', '21232f297a57a5a743894a0e4a801fc3', NULL),
(0004, 'Njoroge Wa Kamau', 'njoro', 'njoro@email.com', '03246454135', '21232f297a57a5a743894a0e4a801fc3', NULL),
(0005, 'Curtain Realtors', 'curts', 'curtsey@info.com', '036465465456', '21232f297a57a5a743894a0e4a801fc3', NULL),
(0087, 'Planter Sacco', 'sacco', 'planters@email.com', '02456345646', '21232f297a57a5a743894a0e4a801fc3', NULL),
(0098, 'Skyfall Realtors', 'skyfall', 'skyfall@email.com', '03554465474', '21232f297a57a5a743894a0e4a801fc3', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `queries`
--

CREATE TABLE IF NOT EXISTS `queries` (
  `query_id` int(12) UNSIGNED ZEROFILL NOT NULL,
  `full_name` varchar(64) NOT NULL,
  `phone` varchar(16) DEFAULT NULL,
  `email` varchar(32) NOT NULL,
  `subject` varchar(64) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `queries`
--

INSERT INTO `queries` (`query_id`, `full_name`, `phone`, `email`, `subject`, `message`) VALUES
(000000000001, 'Kevin Kipsang', '0725414587', 'brian.gicharu@gmail.com', 'Looking for new place', 'i\'d like to know if I can search for houses around me using this site'),
(000000000002, 'Michael Miller', '0733549654', 'michaels@email.test', 'Payment issue', 'Am wondering if you\'d integrate payment methods in the near future for personal convenience'),
(000000000003, 'Don Self', '0215646546', 'donself@email.test', 'Review', 'Please add more apartments and hostels');

-- --------------------------------------------------------

--
-- Table structure for table `reserve`
--

CREATE TABLE IF NOT EXISTS `reserve` (
  `reserve_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `name` varchar(128) NOT NULL,
  `gender` varchar(8) NOT NULL,
  `birthday` date DEFAULT NULL,
  `hostel_id` int(4) UNSIGNED ZEROFILL DEFAULT NULL,
  `hostel_name` varchar(64) DEFAULT NULL,
  `category_id` int(4) UNSIGNED ZEROFILL DEFAULT NULL,
  `room_type` varchar(256) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `phoneno` varchar(16) DEFAULT NULL,
  `student_id` int(4) UNSIGNED ZEROFILL DEFAULT NULL,
  `owner_id` int(4) UNSIGNED ZEROFILL DEFAULT NULL,
  `registration_status` varchar(128) DEFAULT 'NOT PAID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reserve`
--

INSERT INTO `reserve` (`reserve_id`, `name`, `gender`, `birthday`, `hostel_id`, `hostel_name`, `category_id`, `room_type`, `email`, `phoneno`, `student_id`, `owner_id`, `registration_status`) VALUES
(000001, 'Arthur Knightly', 'male', '2003-03-13', 0005, 'Makaazi bora Apartments', 0001, '2', 'arthurs21@email.test', '4654465464', 0001, 0001, 'NOT PAID'),
(000002, 'Abijah', 'female', '1999-06-01', 0016, 'Aftermath Heights', 0002, '2', 'beejah534@email.com', '023444687464', 0001, 0004, 'NOT PAID'),
(000003, 'Aurora', 'female', '0000-00-00', 0365, 'HighSkies', 0001, '1', 'ora@email.com', '02341334', 0000, 0003, 'NOT PAID'),
(000004, 'Athelstein', 'male', '2009-09-09', 0005, 'Makaazi bora Apartments', 0002, '1', 'kamas@email.com', '05454354345354', 0000, 0001, 'NOT PAID');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `student_id` int(4) UNSIGNED ZEROFILL NOT NULL,
  `username` varchar(64) NOT NULL,
  `first_name` varchar(64) NOT NULL,
  `second_name` varchar(64) NOT NULL,
  `last_name` varchar(64) DEFAULT NULL,
  `gender` varchar(8) DEFAULT NULL,
  `email` varchar(128) NOT NULL,
  `phone_number` varchar(16) DEFAULT NULL,
  `password` varchar(512) DEFAULT NULL,
  `otp_code` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `username`, `first_name`, `second_name`, `last_name`, `gender`, `email`, `phone_number`, `password`, `otp_code`) VALUES
(0000, 'janedoe', '', '', NULL, NULL, 'janedoe@email.test', '023134335', '1a1dc91c907325c69271ddf0c944bc72', NULL),
(0001, 'tester', 'John', 'Doe', 'Stephens', 'male', 'brian.gicharu@gmail.com', '0712345678', '5f4dcc3b5aa765d61d8327deb882cf99', 'XUNXF9'),
(0004, 'Theo', 'Theodore', 'Sande', NULL, 'male', 'theodoresande@gmail.com', '0795498648', '5f4dcc3b5aa765d61d8327deb882cf99', 'C2PRMP');

-- --------------------------------------------------------

--
-- Table structure for table `supervisors`
--

CREATE TABLE IF NOT EXISTS `supervisors` (
  `id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `username` varchar(32) DEFAULT NULL,
  `first_name` varchar(32) NOT NULL,
  `second_name` varchar(32) NOT NULL,
  `last_name` varchar(32) DEFAULT NULL,
  `email` varchar(32) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `otp_code` varchar(8) DEFAULT NULL,
  `last_login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supervisors`
--

INSERT INTO `supervisors` (`id`, `username`, `first_name`, `second_name`, `last_name`, `email`, `password`, `otp_code`, `last_login`) VALUES
(000, 'briangicharu', 'Brian', 'Gicharu', 'Guchu', 'brian.gicharu@gmail.com', '32250170a0dca92d53ec9624f336ca24', 'GWD4E6', '2023-10-12 11:47:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `hostels`
--
ALTER TABLE `hostels`
  ADD PRIMARY KEY (`hostel_id`),
  ADD KEY `fk_owner_id` (`owner_id`),
  ADD KEY `fk_category_id` (`category_id`);

--
-- Indexes for table `owners`
--
ALTER TABLE `owners`
  ADD PRIMARY KEY (`owner_id`);

--
-- Indexes for table `queries`
--
ALTER TABLE `queries`
  ADD PRIMARY KEY (`query_id`);

--
-- Indexes for table `reserve`
--
ALTER TABLE `reserve`
  ADD PRIMARY KEY (`reserve_id`),
  ADD KEY `fk_student_id` (`student_id`),
  ADD KEY `fk_hostel_id` (`hostel_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `supervisors`
--
ALTER TABLE `supervisors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hostels`
--
ALTER TABLE `hostels`
  MODIFY `hostel_id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=375;

--
-- AUTO_INCREMENT for table `queries`
--
ALTER TABLE `queries`
  MODIFY `query_id` int(12) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reserve`
--
ALTER TABLE `reserve`
  MODIFY `reserve_id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hostels`
--
ALTER TABLE `hostels`
  ADD CONSTRAINT `fk_category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_owner_id` FOREIGN KEY (`owner_id`) REFERENCES `owners` (`owner_id`) ON UPDATE CASCADE;

--
-- Constraints for table `reserve`
--
ALTER TABLE `reserve`
  ADD CONSTRAINT `fk_hostel_id` FOREIGN KEY (`hostel_id`) REFERENCES `hostels` (`hostel_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_student_id` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
