-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2018 at 12:10 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `adminId` int(11) NOT NULL,
  `adminName` varchar(20) NOT NULL,
  `adminRole` enum('owner','manager','sales','') NOT NULL,
  `adminPhone` int(11) NOT NULL,
  `adminEmail` varchar(200) NOT NULL,
  `adminPassword` varchar(250) NOT NULL,
  `adminImage` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`adminId`, `adminName`, `adminRole`, `adminPhone`, `adminEmail`, `adminPassword`, `adminImage`) VALUES
(1, 'Sara Zer', 'owner', 525553134, 'sara052555@gmail.com', 'sara', 'owner.png'),
(2, 'Riki Levi', 'manager', 507788643, 'riki@gmail.com', 'riki', 'managerWoman.png'),
(3, 'Shira Menahem', 'sales', 86543345, 'shira@gmail.com', 'shira', 'salesWoman.jpg'),
(4, 'David Levi', 'sales', 23456798, 'david@gmail.com', 'david', 'salesMan.jpg'),
(5, 'Dani Levin', 'manager', 4253467, 'dani@gmail.com', 'dani', 'managerMan.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `courseId` int(11) NOT NULL,
  `courseName` varchar(100) NOT NULL,
  `courseDesc` varchar(500) NOT NULL,
  `courseImage` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`courseId`, `courseName`, `courseDesc`, `courseImage`) VALUES
(1, 'Full Stack ', 'this is developmetdvjk', 'fullstack.png'),
(2, 'MCSA', 'Managing cloud infrastructure and communication networks', 'MCSA.png'),
(3, 'SEO', 'Search Engine Optimization', 'seo.jpg'),
(4, 'QA', 'Quality Assurance', 'QA_cropped.jpg'),
(5, 'Java', 'The Java platform offers many tools to implement security in every layer of your application.', 'java.png'),
(6, 'Animation', 'Animation is currently supported with the FBX, glTF and Blender file formats.', 'seo.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `courses_students`
--

CREATE TABLE `courses_students` (
  `course_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `courses_students`
--

INSERT INTO `courses_students` (`course_id`, `student_id`) VALUES
(1, 1),
(1, 2),
(1, 5),
(1, 7),
(1, 8),
(1, 9),
(2, 1),
(2, 2),
(2, 3),
(2, 6),
(2, 7),
(3, 1),
(3, 8),
(3, 9),
(3, 10),
(4, 1),
(4, 2),
(5, 1),
(5, 3),
(5, 6),
(6, 6);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentId` int(11) NOT NULL,
  `studentName` varchar(100) NOT NULL,
  `studentPhone` int(11) NOT NULL,
  `studentEmail` varchar(100) NOT NULL,
  `studentImage` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentId`, `studentName`, `studentPhone`, `studentEmail`, `studentImage`) VALUES
(1, 'Moti Cohen', 2147483647, 'moti@gmail.com', 'studentMan.png'),
(2, 'Miri Shemsh', 578443215, 'miri@gmail.com', 'studentWoman.png'),
(3, 'Yossi Friedman', 586644332, 'yossi32@gmail.com', 'studentMan.png'),
(4, 'Lea Pur', 1234567890, 'lea@yahoo.co.il', 'studentWoman.png'),
(5, 'Michal Levanon', 578443215, 'michal@gmail.com', 'studentWoman.png'),
(6, 'Rachel Gad', 45267882, 'rachel@walla.com', 'studentWoman.png'),
(7, 'Noam Klain', 1800700700, 'noam@gmail.com', 'studentMan.png'),
(8, 'Tehila Cohen', 1234567890, 'thila@gmail.com', 'studentWoman.png'),
(9, 'David Levin', 2147483647, 'david@gmail.com', 'studentMan.png'),
(10, 'Yinon Malka', 854657324, 'yinon@gmail.com', 'studentMan.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`courseId`);

--
-- Indexes for table `courses_students`
--
ALTER TABLE `courses_students`
  ADD PRIMARY KEY (`course_id`,`student_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `courseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
