-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Sep 07, 2019 at 06:25 PM
-- Server version: 10.3.14-MariaDB
-- PHP Version: 7.2.18

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
-- Table structure for table `answered_test`
--

DROP TABLE IF EXISTS `answered_test`;
CREATE TABLE IF NOT EXISTS `answered_test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `test_id` int(11) DEFAULT NULL,
  `schoolmember_enroll` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT 0,
  `done` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `schoolmember_enroll` (`schoolmember_enroll`),
  KEY `test_id` (`test_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answered_test`
--

INSERT INTO `answered_test` (`id`, `test_id`, `schoolmember_enroll`, `score`, `done`) VALUES
(1, 21, 11, 0, 0),
(2, 21, 10, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `gradeclass`
--

DROP TABLE IF EXISTS `gradeclass`;
CREATE TABLE IF NOT EXISTS `gradeclass` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `classLetter` varchar(1) DEFAULT NULL,
  `gradeNumber` int(11) DEFAULT NULL,
  `school_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_gradeclass_01` (`school_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gradeclass`
--

INSERT INTO `gradeclass` (`id`, `classLetter`, `gradeNumber`, `school_id`) VALUES
(2, 'A', 3, 4),
(3, 'A', 1, 5),
(4, 'B', 1, 5),
(5, 'C', 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `test_id` int(11) NOT NULL,
  `correct_answer` int(11) DEFAULT NULL,
  `topic_id` int(11) DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  `dificult` enum('f','m','d') DEFAULT NULL,
  `nick` varchar(300) DEFAULT 'sem titulo',
  `option_quant` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `test_id` (`test_id`),
  KEY `topic_id` (`topic_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `test_id`, `correct_answer`, `topic_id`, `number`, `dificult`, `nick`, `option_quant`) VALUES
(1, 21, 1, 1, 2, 'd', 'questao 1', 5),
(2, 21, 2, 1, 3, 'f', 'questao2', 5);

-- --------------------------------------------------------

--
-- Table structure for table `question_answered_test`
--

DROP TABLE IF EXISTS `question_answered_test`;
CREATE TABLE IF NOT EXISTS `question_answered_test` (
  `answered_test_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `option_choosed` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`answered_test_id`,`question_id`),
  KEY `question_id` (`question_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question_answered_test`
--

INSERT INTO `question_answered_test` (`answered_test_id`, `question_id`, `option_choosed`) VALUES
(1, 1, '2'),
(2, 1, '3');

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

DROP TABLE IF EXISTS `school`;
CREATE TABLE IF NOT EXISTS `school` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`id`, `name`) VALUES
(3, 'UFAL'),
(4, 'ic'),
(5, 'ufal');

-- --------------------------------------------------------

--
-- Table structure for table `schoolmember`
--

DROP TABLE IF EXISTS `schoolmember`;
CREATE TABLE IF NOT EXISTS `schoolmember` (
  `enrollnumber` int(11) NOT NULL,
  `name` varchar(300) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` enum('masculino','feminino') DEFAULT NULL,
  `type` enum('aluno','professor') DEFAULT NULL,
  `schoolid` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`enrollnumber`),
  KEY `schoolid` (`schoolid`),
  KEY `class_id` (`class_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schoolmember`
--

INSERT INTO `schoolmember` (`enrollnumber`, `name`, `age`, `gender`, `type`, `schoolid`, `class_id`) VALUES
(1, 'Samuel', 20, 'masculino', 'aluno', 5, 4),
(10, 'Valerio', 20, 'masculino', 'aluno', 5, 3),
(11, 'Jhonnye', 19, 'masculino', 'aluno', 5, 4),
(101, 'Hugo', 20, 'masculino', 'aluno', 5, 5),
(111, 'Caio', 20, 'masculino', 'aluno', 5, 5),
(190, 'Algusto', 20, 'masculino', 'aluno', 5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

DROP TABLE IF EXISTS `subject`;
CREATE TABLE IF NOT EXISTS `subject` (
  `name` varchar(100) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

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

DROP TABLE IF EXISTS `test`;
CREATE TABLE IF NOT EXISTS `test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dt` date NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `nick` varchar(300) DEFAULT 'sem titulo',
  `status` enum('ready','inprogress') DEFAULT 'inprogress',
  PRIMARY KEY (`id`),
  KEY `class_id` (`class_id`),
  KEY `subject_id` (`subject_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `dt`, `class_id`, `subject_id`, `nick`, `status`) VALUES
(21, '2019-12-18', 2, 1, 'testing2', 'inprogress'),
(22, '2019-09-06', 4, 1, 'prova1', 'inprogress'),
(23, '2019-09-06', 4, 1, 'prova1', 'inprogress');

-- --------------------------------------------------------

--
-- Table structure for table `topic`
--

DROP TABLE IF EXISTS `topic`;
CREATE TABLE IF NOT EXISTS `topic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) NOT NULL,
  `subject_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `subject_id` (`subject_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `topic`
--

INSERT INTO `topic` (`id`, `name`, `subject_id`) VALUES
(1, 'd1', 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gradeclass`
--
ALTER TABLE `gradeclass`
  ADD CONSTRAINT `FK_gradeclass_01` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`);

--
-- Constraints for table `schoolmember`
--
ALTER TABLE `schoolmember`
  ADD CONSTRAINT `schoolmember_ibfk_1` FOREIGN KEY (`schoolid`) REFERENCES `school` (`id`),
  ADD CONSTRAINT `schoolmember_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `gradeclass` (`id`);

--
-- Constraints for table `topic`
--
ALTER TABLE `topic`
  ADD CONSTRAINT `topic_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
