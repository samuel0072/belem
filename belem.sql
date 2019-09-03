-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 03, 2019 at 09:47 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `belem`
--

-- --------------------------------------------------------

--
-- Table structure for table `classmember`
--

CREATE TABLE `classmember` (
  `id` int(11) NOT NULL,
  `schoolmember` int(11) NOT NULL,
  `classid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE `grade` (
  `gradeNumber` int(11) NOT NULL,
  `schoolId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gradeclass`
--

CREATE TABLE `gradeclass` (
  `id` int(11) NOT NULL,
  `gradeNumber` int(11) NOT NULL,
  `teacherEnroll` int(11) NOT NULL,
  `classLetter` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `correct_answer` varchar(1) DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `topic_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE `school` (
  `id` int(11) NOT NULL,
  `name` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `schoolmember`
--

CREATE TABLE `schoolmember` (
  `enrollnumber` int(11) NOT NULL,
  `name` varchar(300) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` enum('masculino','feminino') DEFAULT NULL,
  `type` enum('aluno','professor') DEFAULT NULL,
  `schoolid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `name` varchar(100) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`name`, `id`) VALUES
('portugues', 1),
('matematica', 2);

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `dt` date NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `topic`
--

CREATE TABLE `topic` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classmember`
--
ALTER TABLE `classmember`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schoolmember` (`schoolmember`),
  ADD KEY `classid` (`classid`);

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`gradeNumber`),
  ADD KEY `schoolId` (`schoolId`);

--
-- Indexes for table `gradeclass`
--
ALTER TABLE `gradeclass`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gradeNumber` (`gradeNumber`),
  ADD KEY `teacherEnroll` (`teacherEnroll`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `test_id` (`test_id`),
  ADD KEY `topic_id` (`topic_id`);

--
-- Indexes for table `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schoolmember`
--
ALTER TABLE `schoolmember`
  ADD PRIMARY KEY (`enrollnumber`),
  ADD KEY `schoolid` (`schoolid`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classmember`
--
ALTER TABLE `classmember`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gradeclass`
--
ALTER TABLE `gradeclass`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `school`
--
ALTER TABLE `school`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `topic`
--
ALTER TABLE `topic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `classmember`
--
ALTER TABLE `classmember`
  ADD CONSTRAINT `classmember_ibfk_1` FOREIGN KEY (`schoolmember`) REFERENCES `schoolmember` (`enrollnumber`),
  ADD CONSTRAINT `classmember_ibfk_2` FOREIGN KEY (`classid`) REFERENCES `gradeclass` (`id`);

--
-- Constraints for table `grade`
--
ALTER TABLE `grade`
  ADD CONSTRAINT `grade_ibfk_1` FOREIGN KEY (`schoolId`) REFERENCES `school` (`id`);

--
-- Constraints for table `gradeclass`
--
ALTER TABLE `gradeclass`
  ADD CONSTRAINT `GradeClass_ibfk_1` FOREIGN KEY (`gradeNumber`) REFERENCES `grade` (`gradeNumber`),
  ADD CONSTRAINT `GradeClass_ibfk_2` FOREIGN KEY (`teacherEnroll`) REFERENCES `schoolmember` (`enrollnumber`);

--
-- Constraints for table `schoolmember`
--
ALTER TABLE `schoolmember`
  ADD CONSTRAINT `schoolmember_ibfk_1` FOREIGN KEY (`schoolid`) REFERENCES `school` (`id`);

--
-- Constraints for table `topic`
--
ALTER TABLE `topic`
  ADD CONSTRAINT `topic_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;