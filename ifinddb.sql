-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2017 at 03:46 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ifinddb`
--
CREATE DATABASE IF NOT EXISTS `ifinddb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ifinddb`;

-- --------------------------------------------------------

--
-- Table structure for table `building`
--

DROP TABLE IF EXISTS `building`;
CREATE TABLE `building` (
  `buildingId` int(20) NOT NULL,
  `buildingName` varchar(50) NOT NULL,
  `gpsLat` double(15,10) NOT NULL,
  `gpsLng` double(15,10) NOT NULL,
  `facultyId` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `building`
--

INSERT INTO `building` (`buildingId`, `buildingName`, `gpsLat`, `gpsLng`, `facultyId`) VALUES(100, 'Natural Sciences Building', 10.6409910000, -61.4002790000, 'FST');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE `course` (
  `courseCode` varchar(20) NOT NULL,
  `courseName` varchar(50) NOT NULL,
  `sTime` time NOT NULL,
  `fTime` time NOT NULL,
  `day` varchar(20) NOT NULL,
  `roomId` varchar(20) NOT NULL,
  `departmentId` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`courseCode`, `courseName`, `sTime`, `fTime`, `day`, `roomId`, `departmentId`) VALUES('INFO 3410', 'Web Systems & Technologies', '14:00:00', '16:00:00', 'Wednesday', 'FST CSL2', 'DCIT');
INSERT INTO `course` (`courseCode`, `courseName`, `sTime`, `fTime`, `day`, `roomId`, `departmentId`) VALUES('INFO 3425', 'Professional Ethics and Law', '10:00:00', '12:00:00', 'Friday', 'FST CSL2', 'DCIT');
INSERT INTO `course` (`courseCode`, `courseName`, `sTime`, `fTime`, `day`, `roomId`, `departmentId`) VALUES('INFO 3425', 'Professional Ethics and Law', '11:00:00', '12:00:00', 'Monday', 'FST 113', 'DCIT');
INSERT INTO `course` (`courseCode`, `courseName`, `sTime`, `fTime`, `day`, `roomId`, `departmentId`) VALUES('INFO 3425', 'Professional Ethics and Law', '11:00:00', '12:00:00', 'Tuesday', 'FST 114', 'DCIT');
INSERT INTO `course` (`courseCode`, `courseName`, `sTime`, `fTime`, `day`, `roomId`, `departmentId`) VALUES('INFO 3490', 'Project', '08:00:00', '09:00:00', 'Monday', 'FST 412', 'DCIT');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE `department` (
  `departmentId` varchar(20) NOT NULL,
  `departmentName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`departmentId`, `departmentName`) VALUES('DCIT', 'Department of Computing and Information Technology');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

DROP TABLE IF EXISTS `faculty`;
CREATE TABLE `faculty` (
  `facultyId` varchar(20) NOT NULL,
  `facultyName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`facultyId`, `facultyName`) VALUES('FST', 'Faculty of Science and Technology');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_department`
--

DROP TABLE IF EXISTS `faculty_department`;
CREATE TABLE `faculty_department` (
  `facultyId` varchar(20) NOT NULL,
  `departmentId` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty_department`
--

INSERT INTO `faculty_department` (`facultyId`, `departmentId`) VALUES('FST', 'DCIT');

-- --------------------------------------------------------

--
-- Table structure for table `pending_users`
--

DROP TABLE IF EXISTS `pending_users`;
CREATE TABLE `pending_users` (
  `tokenid` int(11) NOT NULL,
  `userId` int(20) NOT NULL,
  `token` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

DROP TABLE IF EXISTS `room`;
CREATE TABLE `room` (
  `roomId` varchar(20) NOT NULL,
  `floor` varchar(10) NOT NULL,
  `url` varchar(300) NOT NULL,
  `entrance` varchar(200) NOT NULL,
  `buildingId` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`roomId`, `floor`, `url`, `entrance`, `buildingId`) VALUES('FST 113', 'G', 'https://goo.gl/AIsH49', '../images/FST 113.jpg', 100);
INSERT INTO `room` (`roomId`, `floor`, `url`, `entrance`, `buildingId`) VALUES('FST 114', 'G', 'https://goo.gl/1vgWyl', '../images/FST 114.jpg', 100);
INSERT INTO `room` (`roomId`, `floor`, `url`, `entrance`, `buildingId`) VALUES('FST 212', '1', 'https://goo.gl/xKZ7xU', '', 100);
INSERT INTO `room` (`roomId`, `floor`, `url`, `entrance`, `buildingId`) VALUES('FST 213', '1', 'https://goo.gl/mzfOOY', '', 100);
INSERT INTO `room` (`roomId`, `floor`, `url`, `entrance`, `buildingId`) VALUES('FST 214', '1', 'https://goo.gl/619wiy', '', 100);
INSERT INTO `room` (`roomId`, `floor`, `url`, `entrance`, `buildingId`) VALUES('FST 412', '3', 'https://goo.gl/ZtHW9K', '', 100);
INSERT INTO `room` (`roomId`, `floor`, `url`, `entrance`, `buildingId`) VALUES('FST 413', '3', 'https://goo.gl/8cDbgF', '', 100);
INSERT INTO `room` (`roomId`, `floor`, `url`, `entrance`, `buildingId`) VALUES('FST CSL1', '2', 'https://goo.gl/vRWm0I', '', 100);
INSERT INTO `room` (`roomId`, `floor`, `url`, `entrance`, `buildingId`) VALUES('FST CSL2', '2', 'https://goo.gl/hREjo0', '', 100);
INSERT INTO `room` (`roomId`, `floor`, `url`, `entrance`, `buildingId`) VALUES('FST LS1', 'G', 'https://goo.gl/Z0A6cI', '', 100);
INSERT INTO `room` (`roomId`, `floor`, `url`, `entrance`, `buildingId`) VALUES('FST LS2', 'G', 'https://goo.gl/VQNC1Q', '', 100);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `userId` int(20) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `departmentId` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `fname`, `lname`, `email`, `password`, `departmentId`) VALUES(1, 'Safraz', 'Doolan', 'safraz@gmail.com', 'c80f5bc166cd6739ba9ba6d94acabc0aa01494da', 'DCIT');
INSERT INTO `user` (`userId`, `fname`, `lname`, `email`, `password`, `departmentId`) VALUES(2, 'Michael', 'Sam', 'sam@gmail.com', '47b8015d98d5103a8a6981a979514855cac10ebc', 'DCIT');
INSERT INTO `user` (`userId`, `fname`, `lname`, `email`, `password`, `departmentId`) VALUES(5004, 'Reza', 'Mohammed', 'reza@gmail.com', '3d4edf3cd249de9f27898c5b763e4b9a3e7aaa55', 'DCIT');
INSERT INTO `user` (`userId`, `fname`, `lname`, `email`, `password`, `departmentId`) VALUES(5005, 'rice', 'summer', 'rice@gmail.com', '1ba95c1c3aacb805f7ee7b33dd8ba38657ea1bb4', 'DCIT');
INSERT INTO `user` (`userId`, `fname`, `lname`, `email`, `password`, `departmentId`) VALUES(5006, 'Saffiyah', 'Doolan', 'saffiyahdoolan@gmail.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'DCIT');
INSERT INTO `user` (`userId`, `fname`, `lname`, `email`, `password`, `departmentId`) VALUES(5007, 'Shamar', 'Culzac', 'shamarculzac@gmail.com', '99345ce680cd3e48acdb9ab4212e4bd9bf9358b7', 'DCIT');
INSERT INTO `user` (`userId`, `fname`, `lname`, `email`, `password`, `departmentId`) VALUES(5010, 'Sade', 'Lopez', 'sad3@gmail.com', '99345ce680cd3e48acdb9ab4212e4bd9bf9358b7', 'DCIT');

-- --------------------------------------------------------

--
-- Table structure for table `user_course`
--

DROP TABLE IF EXISTS `user_course`;
CREATE TABLE `user_course` (
  `userId` int(20) NOT NULL,
  `courseCode` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_course`
--

INSERT INTO `user_course` (`userId`, `courseCode`) VALUES(1, 'INFO 3425');
INSERT INTO `user_course` (`userId`, `courseCode`) VALUES(2, 'INFO 3410');
INSERT INTO `user_course` (`userId`, `courseCode`) VALUES(5004, 'INFO 3410');
INSERT INTO `user_course` (`userId`, `courseCode`) VALUES(5005, 'INFO 3410');
INSERT INTO `user_course` (`userId`, `courseCode`) VALUES(5005, 'INFO 3425');
INSERT INTO `user_course` (`userId`, `courseCode`) VALUES(5005, 'INFO 3490');
INSERT INTO `user_course` (`userId`, `courseCode`) VALUES(5007, 'INFO 3410');
INSERT INTO `user_course` (`userId`, `courseCode`) VALUES(5007, 'INFO 3425');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `building`
--
ALTER TABLE `building`
  ADD PRIMARY KEY (`buildingId`),
  ADD KEY `facultyId` (`facultyId`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`courseCode`,`sTime`,`day`),
  ADD KEY `departmentId` (`departmentId`),
  ADD KEY `roomId` (`roomId`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`departmentId`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`facultyId`);

--
-- Indexes for table `faculty_department`
--
ALTER TABLE `faculty_department`
  ADD PRIMARY KEY (`facultyId`,`departmentId`),
  ADD KEY `facultyId` (`facultyId`),
  ADD KEY `departmentId` (`departmentId`);

--
-- Indexes for table `pending_users`
--
ALTER TABLE `pending_users`
  ADD PRIMARY KEY (`tokenid`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`roomId`),
  ADD KEY `buildingId` (`buildingId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`),
  ADD KEY `departmentId` (`departmentId`);

--
-- Indexes for table `user_course`
--
ALTER TABLE `user_course`
  ADD PRIMARY KEY (`userId`,`courseCode`),
  ADD KEY `courseCode` (`courseCode`),
  ADD KEY `userId` (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pending_users`
--
ALTER TABLE `pending_users`
  MODIFY `tokenid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5011;
--
-- AUTO_INCREMENT for table `user_course`
--
ALTER TABLE `user_course`
  MODIFY `userId` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5008;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `building`
--
ALTER TABLE `building`
  ADD CONSTRAINT `building_ibfk_1` FOREIGN KEY (`facultyId`) REFERENCES `faculty` (`facultyId`);

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `departmentId_fk` FOREIGN KEY (`departmentId`) REFERENCES `department` (`departmentId`),
  ADD CONSTRAINT `roomId_fk` FOREIGN KEY (`roomId`) REFERENCES `room` (`roomId`);

--
-- Constraints for table `faculty_department`
--
ALTER TABLE `faculty_department`
  ADD CONSTRAINT `faculty_department_ibfk_1` FOREIGN KEY (`facultyId`) REFERENCES `faculty` (`facultyId`),
  ADD CONSTRAINT `faculty_department_ibfk_2` FOREIGN KEY (`departmentId`) REFERENCES `department` (`departmentId`);

--
-- Constraints for table `pending_users`
--
ALTER TABLE `pending_users`
  ADD CONSTRAINT `userId` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`);

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`buildingId`) REFERENCES `building` (`buildingId`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`departmentId`) REFERENCES `department` (`departmentId`);

--
-- Constraints for table `user_course`
--
ALTER TABLE `user_course`
  ADD CONSTRAINT `user_course_ibfk_2` FOREIGN KEY (`courseCode`) REFERENCES `course` (`courseCode`),
  ADD CONSTRAINT `user_id_ibfk_3` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
