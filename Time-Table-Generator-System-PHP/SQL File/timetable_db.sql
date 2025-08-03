-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2025 at 07:19 PM
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
-- Database: `timetable_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `name`, `creationDate`) VALUES
(1, 'Class 10', '2025-03-13 05:29:45'),
(2, 'Class  9', '2025-03-13 05:29:45'),
(3, 'Class 11', '2025-03-13 05:29:45'),
(5, 'Class 12', '2025-03-13 11:23:24'),
(6, 'Class 8', '2025-03-16 17:41:30');

-- --------------------------------------------------------

--
-- Table structure for table `classrooms`
--

CREATE TABLE `classrooms` (
  `id` int(11) NOT NULL,
  `room_no` varchar(50) NOT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classrooms`
--

INSERT INTO `classrooms` (`id`, `room_no`, `creationDate`) VALUES
(1, 'A101', '2025-03-16 04:48:06'),
(2, 'B202', '2025-03-16 04:48:06'),
(4, 'C303', '2025-03-16 05:02:31'),
(5, 'A102', '2025-03-16 17:43:42'),
(7, 'A103', '2025-03-16 17:43:56');

-- --------------------------------------------------------

--
-- Table structure for table `class_subject`
--

CREATE TABLE `class_subject` (
  `id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `allocationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_subject`
--

INSERT INTO `class_subject` (`id`, `class_id`, `subject_id`, `allocationDate`) VALUES
(1, 1, 1, '2025-03-16 17:18:20'),
(2, 1, 5, '2025-03-16 17:18:26'),
(3, 1, 6, '2025-03-16 17:18:31'),
(4, 2, 1, '2025-03-16 17:18:55'),
(5, 2, 5, '2025-03-16 17:19:00'),
(6, 2, 6, '2025-03-16 17:19:08'),
(7, 3, 1, '2025-03-16 17:19:16'),
(8, 3, 2, '2025-03-16 17:19:23'),
(9, 3, 3, '2025-03-16 17:19:29'),
(10, 3, 6, '2025-03-16 17:19:36'),
(11, 5, 1, '2025-03-16 17:19:44'),
(12, 5, 2, '2025-03-16 17:19:48'),
(13, 5, 3, '2025-03-16 17:19:53'),
(14, 5, 6, '2025-03-16 17:19:58'),
(15, 6, 1, '2025-03-16 17:42:55'),
(16, 6, 5, '2025-03-16 17:43:00'),
(17, 6, 6, '2025-03-16 17:43:05'),
(18, 6, 7, '2025-03-16 17:43:10');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `creationDate`) VALUES
(1, 'Mathematics', '2025-03-13 06:30:48'),
(2, 'Physics', '2025-03-13 06:30:48'),
(3, 'Chemistry', '2025-03-13 06:30:48'),
(5, 'Hindi', '2025-03-13 11:27:37'),
(6, 'English', '2025-03-16 04:47:31'),
(7, 'Drawing', '2025-03-16 17:42:02');

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(10) NOT NULL,
  `AdminName` varchar(200) DEFAULT NULL,
  `UserName` varchar(200) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `AdminRegdate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `AdminName`, `UserName`, `MobileNumber`, `Email`, `Password`, `AdminRegdate`) VALUES
(1, 'SuperAdmin', 'admin', 5689784592, 'admin@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '2025-02-01 06:28:35');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `name`, `creationDate`) VALUES
(1, 'John Doe', '2025-03-16 04:46:40'),
(2, 'Rahul Singh', '2025-03-16 04:46:58'),
(3, 'Garima', '2025-03-16 04:47:10'),
(4, 'Amita', '2025-03-16 04:47:44'),
(5, 'Amit Kumar', '2025-03-16 17:42:30');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_subject`
--

CREATE TABLE `teacher_subject` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher_subject`
--

INSERT INTO `teacher_subject` (`id`, `teacher_id`, `subject_id`) VALUES
(6, 1, 1),
(7, 2, 5),
(8, 3, 3),
(9, 4, 6),
(10, 5, 7);

-- --------------------------------------------------------

--
-- Table structure for table `timeslots`
--

CREATE TABLE `timeslots` (
  `id` int(11) NOT NULL,
  `day` varchar(50) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timeslots`
--

INSERT INTO `timeslots` (`id`, `day`, `start_time`, `end_time`) VALUES
(1, 'Monday', '09:00:00', '10:00:00'),
(2, 'Monday', '10:00:00', '11:00:00'),
(3, 'Tuesday', '09:00:00', '10:00:00'),
(4, 'Monday', '13:00:00', '13:50:00'),
(6, 'Wednesday', '12:00:00', '13:00:00'),
(7, 'Wednesday', '11:00:00', '12:00:00'),
(8, 'Wednesday', '10:00:00', '11:00:00'),
(9, 'Thursday', '09:00:00', '10:59:00'),
(10, 'Thursday', '11:00:00', '12:00:00'),
(11, 'Friday', '09:10:00', '10:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
  `id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `classroom_id` int(11) DEFAULT NULL,
  `timeslot_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`id`, `class_id`, `subject_id`, `teacher_id`, `classroom_id`, `timeslot_id`) VALUES
(47, 1, 5, 2, 7, 1),
(48, 1, 6, 4, 5, 2),
(49, 1, 5, 2, 1, 3),
(50, 1, 6, 4, 7, 4),
(51, 1, 6, 4, 1, 6),
(52, 1, 1, 1, 2, 7),
(53, 1, 5, 2, 4, 8),
(54, 1, 1, 1, 1, 9),
(55, 1, 6, 4, 1, 10),
(56, 1, 5, 2, 2, 11),
(57, 2, 6, 4, 4, 1),
(58, 2, 5, 2, 7, 2),
(59, 2, 1, 1, 5, 3),
(60, 2, 1, 1, 4, 4),
(61, 2, 1, 1, 2, 6),
(62, 2, 5, 2, 1, 7),
(63, 2, 1, 1, 1, 8),
(64, 2, 6, 4, 1, 9),
(65, 2, 5, 2, 7, 10),
(66, 2, 1, 1, 7, 11),
(67, 3, 1, 1, 1, 1),
(68, 3, 1, 1, 2, 2),
(69, 3, 3, 3, 4, 3),
(70, 3, 3, 3, 1, 4),
(71, 3, 3, 3, 5, 6),
(72, 3, 6, 4, 5, 7),
(73, 3, 3, 3, 2, 8),
(74, 3, 3, 3, 4, 9),
(75, 3, 3, 3, 7, 10),
(76, 3, 6, 4, 1, 11),
(77, 5, 3, 3, 4, 1),
(78, 5, 3, 3, 1, 2),
(79, 5, 6, 4, 2, 3),
(80, 5, 3, 3, 4, 7),
(81, 5, 6, 4, 2, 8),
(82, 5, 1, 1, 2, 10),
(83, 5, 3, 3, 5, 11),
(84, 6, 7, 5, 5, 1),
(85, 6, 7, 5, 1, 2),
(86, 6, 7, 5, 1, 3),
(87, 6, 5, 2, 4, 4),
(88, 6, 5, 2, 7, 6),
(89, 6, 7, 5, 2, 7),
(90, 6, 7, 5, 5, 8),
(91, 6, 5, 2, 4, 9),
(92, 6, 7, 5, 1, 10),
(93, 6, 7, 5, 5, 11);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classrooms`
--
ALTER TABLE `classrooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_subject`
--
ALTER TABLE `class_subject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_subject`
--
ALTER TABLE `teacher_subject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `timeslots`
--
ALTER TABLE `timeslots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `classroom_id` (`classroom_id`),
  ADD KEY `timeslot_id` (`timeslot_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `classrooms`
--
ALTER TABLE `classrooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `class_subject`
--
ALTER TABLE `class_subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `teacher_subject`
--
ALTER TABLE `teacher_subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `timeslots`
--
ALTER TABLE `timeslots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `class_subject`
--
ALTER TABLE `class_subject`
  ADD CONSTRAINT `class_subject_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`),
  ADD CONSTRAINT `class_subject_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
