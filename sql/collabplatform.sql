-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 11, 2024 at 10:13 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `collabplatform`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `adminID` int NOT NULL AUTO_INCREMENT,
  `firstName` varchar(25) DEFAULT NULL,
  `familyName` varchar(25) DEFAULT NULL,
  `email` char(50) DEFAULT NULL,
  `password` char(20) DEFAULT NULL,
  `address` char(50) DEFAULT NULL,
  `imageUrl` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'noprofile.jpeg',
  PRIMARY KEY (`adminID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `firstName`, `familyName`, `email`, `password`, `address`, `imageUrl`) VALUES
(1, 'hk', 'med', 'medhk@fstm.ma', '123', 'fstm', '1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `affected`
--

DROP TABLE IF EXISTS `affected`;
CREATE TABLE IF NOT EXISTS `affected` (
  `idIndex` int NOT NULL AUTO_INCREMENT,
  `collaboratorID` int NOT NULL,
  `projectID` int NOT NULL,
  `roleID` int NOT NULL,
  PRIMARY KEY (`idIndex`),
  KEY `FK_Affected2` (`projectID`),
  KEY `FK_Affected3` (`roleID`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `affected`
--

INSERT INTO `affected` (`idIndex`, `collaboratorID`, `projectID`, `roleID`) VALUES
(6, 1, 1, 4),
(2, 1, 3, 1),
(7, 1, 2, 1),
(8, 1, 1, 3),
(9, 1, 2, 3),
(10, 1, 1, 1),
(11, 2, 1, 2),
(12, 3, 1, 3),
(13, 4, 2, 2),
(14, 5, 2, 5),
(15, 6, 3, 4),
(16, 7, 4, 6),
(17, 8, 5, 7),
(18, 9, 6, 8),
(19, 10, 7, 9),
(20, 1, 8, 2),
(21, 2, 8, 3),
(22, 3, 9, 4),
(23, 4, 10, 6),
(24, 5, 10, 10),
(25, 6, 7, 4),
(26, 7, 9, 5),
(27, 8, 6, 1),
(28, 9, 5, 9),
(29, 10, 3, 8);

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

DROP TABLE IF EXISTS `answer`;
CREATE TABLE IF NOT EXISTS `answer` (
  `answerID` int NOT NULL AUTO_INCREMENT,
  `answerText` text,
  `isFinal` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`answerID`)
) ENGINE=MyISAM AUTO_INCREMENT=153 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`answerID`, `answerText`, `isFinal`) VALUES
(1, 'Consider taking online courses on platforms like Coursera or Udemy.', 0),
(2, 'Start with the official Python documentation and tutorials.', 0),
(3, 'Commit often with meaningful messages.', 0),
(4, 'Take an introductory course on Coursera or edX.', 0),
(5, 'Use branches effectively.', 0),
(6, 'Java is a programming language while JavaScript is a scripting language.', 0),
(7, 'Work on small projects to apply what you learn.', 0),
(8, 'Use meaningful variable names and comments.', 0),
(9, 'Avoid using global variables.', 0),
(10, 'Use ES6+ features for cleaner code.', 0),
(11, 'Keep functions small and focused.', 0),
(12, 'Regularly refactor your code.', 0),
(13, 'Join machine learning communities to stay updated.', 0),
(14, 'Read books like \"Hands-On Machine Learning with Scikit-Learn and TensorFlow\".', 0),
(15, 'Experiment with datasets available on Kaggle.', 0),
(16, 'Profile your code to find bottlenecks.', 0),
(119, 'sir trta7', NULL),
(120, 'fuck you', NULL),
(121, 'fuck fuck', NULL),
(122, 'dfsjhns', NULL),
(123, 'gfdhshsfh', NULL),
(124, 'hana 3awtany', NULL),
(125, 'You can\'t really understand it unless you start thinking that its branding is wrong', NULL),
(126, 'but otherwise, it\'s not really serverless like the name suggests ', NULL),
(127, 'Alright so we are getting closer', NULL),
(128, 'Now the notification should be sent! ', NULL),
(129, 'Now the notification should be sent! ', NULL),
(130, 'Or use bootstrap', NULL),
(131, 'You can use tailwind as well.', NULL),
(132, 'But then again with tailwind you\'d have to to rely on inline', NULL),
(133, 'if inline css is not your forte, then just use standard css', NULL),
(134, 'dsadasd', NULL),
(135, 'dasdasdk', NULL),
(136, 'sdsadsadasd', NULL),
(137, 'fasdasd', NULL),
(138, 'dasgvasdf', NULL),
(139, 'bonjour', NULL),
(140, 'hh', NULL),
(141, ':::', NULL),
(142, 'sdf', NULL),
(143, 'dvz', NULL),
(144, 'ccvv', NULL),
(145, NULL, NULL),
(146, NULL, NULL),
(147, NULL, NULL),
(148, NULL, NULL),
(149, NULL, NULL),
(150, NULL, NULL),
(151, NULL, NULL),
(152, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `categoryID` int NOT NULL AUTO_INCREMENT,
  `categoryTitle` varchar(25) DEFAULT NULL,
  `categoryDescription` text,
  PRIMARY KEY (`categoryID`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryID`, `categoryTitle`, `categoryDescription`) VALUES
(1, 'Technology', 'Events related to technology.'),
(2, 'Art', 'Events related to art.'),
(3, 'Music', 'Events related to music.'),
(4, 'Food', 'Events related to food.'),
(5, 'Literature', 'Events related to literature.'),
(6, 'Science', 'Events related to science.'),
(7, 'Film', 'Events related to films.'),
(8, 'Health', 'Events related to health and wellness.'),
(9, 'Gaming', 'Events related to gaming.'),
(10, 'Business', 'Events related to business and startups.');

-- --------------------------------------------------------

--
-- Table structure for table `collabanswer`
--

DROP TABLE IF EXISTS `collabanswer`;
CREATE TABLE IF NOT EXISTS `collabanswer` (
  `collaboratorID` int NOT NULL,
  `questionID` int NOT NULL,
  `answerID` int NOT NULL,
  PRIMARY KEY (`collaboratorID`,`questionID`,`answerID`),
  KEY `FK_collabAnswer` (`questionID`),
  KEY `FK_Answer3` (`answerID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `collabanswer`
--

INSERT INTO `collabanswer` (`collaboratorID`, `questionID`, `answerID`) VALUES
(1, 1, 1),
(1, 2, 130),
(1, 2, 131),
(1, 2, 132),
(1, 2, 133),
(1, 3, 2),
(1, 4, 125),
(1, 4, 126),
(1, 4, 127),
(1, 4, 128),
(1, 4, 129),
(1, 4, 145),
(1, 4, 146),
(1, 4, 147),
(1, 4, 148),
(1, 4, 149),
(1, 4, 150),
(1, 4, 151),
(1, 4, 152),
(1, 13, 134),
(1, 13, 135),
(1, 13, 136),
(1, 13, 137),
(1, 13, 138),
(1, 13, 140),
(1, 49, 119),
(1, 49, 120),
(1, 49, 121),
(1, 49, 122),
(1, 49, 123),
(1, 49, 124),
(1, 51, 141),
(1, 51, 142),
(1, 51, 143),
(1, 51, 144),
(2, 1, 6),
(2, 2, 5),
(2, 3, 7),
(2, 5, 4),
(2, 7, 3),
(3, 3, 8),
(4, 1, 10),
(4, 3, 139),
(4, 4, 9);

-- --------------------------------------------------------

--
-- Table structure for table `collabhasskill`
--

DROP TABLE IF EXISTS `collabhasskill`;
CREATE TABLE IF NOT EXISTS `collabhasskill` (
  `idIndex` int NOT NULL AUTO_INCREMENT,
  `collaboratorID` int NOT NULL,
  `skillID` int NOT NULL,
  `levelID` int NOT NULL,
  PRIMARY KEY (`idIndex`),
  KEY `FK_collabHasSkill2` (`skillID`),
  KEY `FK_collabHasSkill3` (`levelID`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `collabhasskill`
--

INSERT INTO `collabhasskill` (`idIndex`, `collaboratorID`, `skillID`, `levelID`) VALUES
(14, 1, 0, 1),
(13, 1, 0, 1),
(16, 1, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `collabnotification`
--

DROP TABLE IF EXISTS `collabnotification`;
CREATE TABLE IF NOT EXISTS `collabnotification` (
  `id` int NOT NULL AUTO_INCREMENT,
  `collaboratorID` int NOT NULL,
  `notificationID` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_collab` (`collaboratorID`),
  KEY `fk_notif` (`notificationID`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `collabnotification`
--

INSERT INTO `collabnotification` (`id`, `collaboratorID`, `notificationID`) VALUES
(3, 2, 3),
(10, 6, 10),
(29, 6, 29),
(12, 4, 12),
(28, 1, 28),
(27, 1, 27),
(26, 4, 26),
(16, 4, 16),
(17, 4, 17),
(18, 3, 18),
(19, 2, 19),
(21, 2, 21);

-- --------------------------------------------------------

--
-- Table structure for table `collaborator`
--

DROP TABLE IF EXISTS `collaborator`;
CREATE TABLE IF NOT EXISTS `collaborator` (
  `collaboratorID` int NOT NULL AUTO_INCREMENT,
  `firstName` varchar(25) DEFAULT NULL,
  `familyName` varchar(25) DEFAULT NULL,
  `cin` char(8) NOT NULL,
  `birthDate` date NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `imageUrl` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '1.png',
  `speciality` char(50) NOT NULL,
  `number` int NOT NULL,
  PRIMARY KEY (`collaboratorID`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `collaborator`
--

INSERT INTO `collaborator` (`collaboratorID`, `firstName`, `familyName`, `cin`, `birthDate`, `email`, `password`, `address`, `imageUrl`, `speciality`, `number`) VALUES
(1, 'mohammed', 'HERAK', 'ae303729', '2003-08-16', 'mohammedherak37@gmail.com', 'azerty123', 'hay karima sale', '1.jpeg', 'mol chi', 0),
(2, 'John', 'Doe', 'A1234567', '1990-01-01', 'john.doe@example.com', 'password1', '123 Main St', '0.jpeg', 'Software Development', 1234567890),
(3, 'Jane', 'Smith', 'B2345678', '1985-02-02', 'jane.smith@example.com', 'password2', '456 Elm St', '2.jpeg', 'Data Science', 2147483647),
(4, 'Alice', 'Johnson', 'C3456789', '1992-03-03', 'alice.johnson@example.com', 'password3', '789 Oak St', '4.jpeg', 'UI/UX Design', 2147483647),
(5, 'Bob', 'Brown', 'D4567890', '1988-04-04', 'bob.brown@example.com', 'password4', '101 Pine St', '1.jpeg', 'DevOps', 2147483647),
(6, 'Charlie', 'Davis', 'E5678901', '1995-05-05', 'charlie.davis@example.com', 'password5', '202 Maple St', '1.jpeg', 'Security', 2147483647),
(7, 'Eve', 'Miller', 'F6789012', '1991-06-06', 'eve.miller@example.com', 'password6', '303 Birch St', '1.jpeg', 'QA', 2147483647),
(8, 'Frank', 'Wilson', 'G7890123', '1989-07-07', 'frank.wilson@example.com', 'password7', '404 Cedar St', '1.jpeg', 'Business Analysis', 2147483647),
(9, 'Grace', 'Moore', 'H8901234', '1987-08-08', 'grace.moore@example.com', 'password8', '505 Spruce St', '1.jpeg', 'Project Management', 2147483647),
(10, 'Hank', 'Taylor', 'I9012345', '1986-09-09', 'hank.taylor@example.com', 'password9', '606 Willow St', '1.jpeg', 'Product Ownership', 2147483647),
(32, 'dfdfdfds', 'jdsfsdfsd', '', '0000-00-00', 'hamza@gmail.Com', 'SV6zKGFl', NULL, '1.png', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `collabreact`
--

DROP TABLE IF EXISTS `collabreact`;
CREATE TABLE IF NOT EXISTS `collabreact` (
  `CollaboratorID` int NOT NULL,
  `answerID` int NOT NULL,
  `Reaction` tinyint(1) NOT NULL,
  PRIMARY KEY (`CollaboratorID`,`answerID`) USING BTREE,
  KEY `answerID` (`answerID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `compose`
--

DROP TABLE IF EXISTS `compose`;
CREATE TABLE IF NOT EXISTS `compose` (
  `collaboratorID` int NOT NULL,
  `eventID` int NOT NULL,
  PRIMARY KEY (`collaboratorID`,`eventID`),
  KEY `FK_Compose2` (`eventID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `compose`
--

INSERT INTO `compose` (`collaboratorID`, `eventID`) VALUES
(1, 10),
(1, 11);

-- --------------------------------------------------------

--
-- Table structure for table `coursecategory`
--

DROP TABLE IF EXISTS `coursecategory`;
CREATE TABLE IF NOT EXISTS `coursecategory` (
  `categoryID` int NOT NULL,
  `courseID` int NOT NULL,
  PRIMARY KEY (`categoryID`,`courseID`),
  KEY `FK_knowledgeDocType7` (`courseID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `coursecategory`
--

INSERT INTO `coursecategory` (`categoryID`, `courseID`) VALUES
(1, 1),
(1, 4),
(1, 6),
(1, 8),
(1, 10),
(1, 15),
(1, 16),
(2, 7),
(5, 5),
(6, 3),
(10, 2),
(10, 9);

-- --------------------------------------------------------

--
-- Table structure for table `coursekeyword`
--

DROP TABLE IF EXISTS `coursekeyword`;
CREATE TABLE IF NOT EXISTS `coursekeyword` (
  `keywordID` int NOT NULL,
  `courseID` int NOT NULL,
  PRIMARY KEY (`keywordID`,`courseID`),
  KEY `FK_courseCategory9` (`courseID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `coursekeyword`
--

INSERT INTO `coursekeyword` (`keywordID`, `courseID`) VALUES
(1, 1),
(1, 4),
(1, 8),
(1, 10),
(1, 15),
(1, 16),
(2, 7),
(2, 15),
(3, 1),
(3, 15),
(3, 16),
(5, 5),
(6, 3),
(6, 6),
(6, 10),
(7, 7),
(7, 16),
(8, 8),
(9, 4),
(9, 16),
(10, 2),
(10, 9),
(10, 16);

-- --------------------------------------------------------

--
-- Table structure for table `demande`
--

DROP TABLE IF EXISTS `demande`;
CREATE TABLE IF NOT EXISTS `demande` (
  `demandeID` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `familyname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`demandeID`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `eventID` int NOT NULL AUTO_INCREMENT,
  `publicationDate` date DEFAULT NULL,
  `place` varchar(20) DEFAULT NULL,
  `eventTitle` varchar(100) DEFAULT NULL,
  `eventDescription` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `likeCount` int NOT NULL DEFAULT '0',
  `dislikeCount` int NOT NULL DEFAULT '0',
  `startday` datetime DEFAULT NULL,
  `endDay` datetime DEFAULT NULL,
  PRIMARY KEY (`eventID`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`eventID`, `publicationDate`, `place`, `eventTitle`, `eventDescription`, `likeCount`, `dislikeCount`, `startday`, `endDay`) VALUES
(2, '2024-06-02', 'Los Angeles', 'Art Expo 2024', 'An exhibition showcasing modern art.', 0, 0, '2024-08-05 10:00:00', '2024-08-07 18:00:00'),
(3, '2024-06-03', 'Chicago', 'Music Festival', 'A festival featuring various musical performances.', 0, 0, '2024-09-10 12:00:00', '2024-09-12 23:00:00'),
(4, '2024-06-04', 'Houston', 'Food Carnival', 'A carnival with a variety of food stalls and activities.', 0, 0, '2024-07-20 11:00:00', '2024-07-22 22:00:00'),
(5, '2024-06-05', 'Phoenix', 'Book Fair', 'A fair with books from various genres.', 0, 0, '2024-08-15 09:00:00', '2024-08-17 19:00:00'),
(6, '2024-06-06', 'Philadelphia', 'Science Symposium', 'A symposium discussing recent advancements in science.', 0, 0, '2024-09-05 08:00:00', '2024-09-06 18:00:00'),
(7, '2024-06-07', 'San Antonio', 'Film Festival', 'A festival showcasing independent films.', 0, 0, '2024-07-25 10:00:00', '2024-07-28 23:00:00'),
(8, '2024-06-08', 'San Diego', 'Health and Wellness Expo', 'An expo focused on health and wellness.', 0, 0, '2024-08-10 09:00:00', '2024-08-12 18:00:00'),
(9, '2024-06-09', 'Dallas', 'Gaming Convention', 'A convention for video game enthusiasts.', 0, 0, '2024-09-20 10:00:00', '2024-09-22 20:00:00'),
(10, '2024-06-10', 'San Jose', 'Startup Summit', 'A summit for startup founders and investors.', 0, 0, '2024-10-01 09:00:00', '2024-10-03 18:00:00'),
(11, '2024-06-08', 'FST Mohammedia', 'testing once again', 'event  usually are links', 0, 0, '2024-06-08 15:46:00', '2024-06-24 15:46:00');

-- --------------------------------------------------------

--
-- Table structure for table `eventcategory`
--

DROP TABLE IF EXISTS `eventcategory`;
CREATE TABLE IF NOT EXISTS `eventcategory` (
  `categoryID` int NOT NULL,
  `eventID` int NOT NULL,
  PRIMARY KEY (`categoryID`,`eventID`),
  KEY `FK_questionCategory` (`eventID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `eventcategory`
--

INSERT INTO `eventcategory` (`categoryID`, `eventID`) VALUES
(1, 1),
(1, 11),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10);

-- --------------------------------------------------------

--
-- Table structure for table `eventkeyword`
--

DROP TABLE IF EXISTS `eventkeyword`;
CREATE TABLE IF NOT EXISTS `eventkeyword` (
  `keywordID` int NOT NULL,
  `eventID` int NOT NULL,
  PRIMARY KEY (`keywordID`,`eventID`),
  KEY `FK_knowledgeDocKeyWord` (`eventID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `eventkeyword`
--

INSERT INTO `eventkeyword` (`keywordID`, `eventID`) VALUES
(1, 1),
(1, 10),
(2, 2),
(3, 3),
(3, 4),
(4, 4),
(5, 5),
(5, 7),
(6, 6),
(7, 7),
(7, 8),
(8, 8),
(9, 1),
(9, 9),
(10, 10);

-- --------------------------------------------------------

--
-- Table structure for table `keyword`
--

DROP TABLE IF EXISTS `keyword`;
CREATE TABLE IF NOT EXISTS `keyword` (
  `keywordID` int NOT NULL AUTO_INCREMENT,
  `keyWord` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`keywordID`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `keyword`
--

INSERT INTO `keyword` (`keywordID`, `keyWord`) VALUES
(1, 'Web Developement '),
(2, 'AI'),
(3, 'Cloud computing'),
(4, 'Data Engineering'),
(5, 'Machine Learning'),
(6, 'Software developement'),
(7, 'Software Engineering'),
(8, 'Data Scince'),
(9, 'Data analytics'),
(10, 'Entrepreneurship');

-- --------------------------------------------------------

--
-- Table structure for table `knowledgedockeyword`
--

DROP TABLE IF EXISTS `knowledgedockeyword`;
CREATE TABLE IF NOT EXISTS `knowledgedockeyword` (
  `keywordID` int NOT NULL,
  `knowledgeDocID` int NOT NULL,
  PRIMARY KEY (`keywordID`,`knowledgeDocID`),
  KEY `FK_knowledgeDocType0` (`knowledgeDocID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `knowledgedockeyword`
--

INSERT INTO `knowledgedockeyword` (`keywordID`, `knowledgeDocID`) VALUES
(1, 14),
(1, 16),
(2, 15),
(4, 14),
(5, 15),
(6, 14),
(6, 15),
(7, 15),
(8, 14);

-- --------------------------------------------------------

--
-- Table structure for table `knowledgedocumentcontent`
--

DROP TABLE IF EXISTS `knowledgedocumentcontent`;
CREATE TABLE IF NOT EXISTS `knowledgedocumentcontent` (
  `knowledgeDocID` int NOT NULL AUTO_INCREMENT,
  `knowledgeDocumentContent` text,
  `time` datetime DEFAULT CURRENT_TIMESTAMP,
  `url_img` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `url_pdf` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  PRIMARY KEY (`knowledgeDocID`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `knowledgedocumentcontent`
--

INSERT INTO `knowledgedocumentcontent` (`knowledgeDocID`, `knowledgeDocumentContent`, `time`, `url_img`, `url_pdf`, `title`) VALUES
(6, 'img plus pdf', '2024-06-09 16:33:36', '1717947216_WIN_20240521_14_27_10_Pro.jpg', '1717947216_Contrôle 2 2023 final.pdf', 'first test'),
(7, 'only pdf', '2024-06-09 16:34:00', '0.png', '1717947240_Contrôle 2 2023 final.pdf', 'second test'),
(15, 'not testing', '2024-06-09 17:29:27', '1717950567_Screenshot 2024-06-03 102529.png', '1717950567_Stage.pdf', 'testing'),
(14, 'not really', '2024-06-09 17:08:06', '0.png', '1717949286_Mon_CV.pdf', 'not working '),
(16, 'testing', '2024-06-10 15:11:40', '1718028700_0.jpg', '1718028700_Contrôle 2 2023 final.pdf', 'another test');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

DROP TABLE IF EXISTS `level`;
CREATE TABLE IF NOT EXISTS `level` (
  `levelID` int NOT NULL AUTO_INCREMENT,
  `levelName` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`levelID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`levelID`, `levelName`) VALUES
(1, 'debutant'),
(2, 'intermediate'),
(3, 'expert');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `notificationID` int NOT NULL AUTO_INCREMENT,
  `message` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`notificationID`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notificationID`, `message`, `created_at`) VALUES
(4, 'HERAK mohammed vient de s\'interesser a votre formation.', '2024-06-09 21:41:37'),
(3, 'Votre question a recu 5 reponses. Elle est complete.', '2024-06-09 20:47:05'),
(7, 'HERAK mohammed vient de s\'interesser a votre formation.', '2024-06-09 23:09:08'),
(10, 'HERAK mohammed vient de s\'interesser a votre formation.', '2024-06-10 11:03:33'),
(22, 'HERAK mohammed vient de s\'interesser a votre formation.', '2024-06-10 11:05:44'),
(12, 'HERAK mohammed vient de s\'interesser a votre formation.', '2024-06-10 11:03:50'),
(13, 'HERAK mohammed vient de s\'interesser a votre formation.', '2024-06-10 11:03:54'),
(14, 'HERAK mohammed vient de s\'interesser a votre formation.', '2024-06-10 11:03:56'),
(15, 'HERAK mohammed vient de s\'interesser a votre formation.', '2024-06-10 11:03:57'),
(16, 'HERAK mohammed vient de s\'interesser a votre formation.', '2024-06-10 11:03:58'),
(17, 'HERAK mohammed vient de s\'interesser a votre formation.', '2024-06-10 11:03:59'),
(18, 'HERAK mohammed vient de s\'interesser a votre formation.', '2024-06-10 11:04:00'),
(19, 'HERAK mohammed vient de s\'interesser a votre formation.', '2024-06-10 11:04:01'),
(23, 'HERAK mohammed vient de s\'interesser a votre formation.', '2024-06-10 11:06:25'),
(21, 'HERAK mohammed vient de s\'interesser a votre formation.', '2024-06-10 11:04:04'),
(24, 'HERAK mohammed vient de s\'interesser a votre formation.', '2024-06-10 12:59:43'),
(25, 'HERAK mohammed vient de s\'interesser a votre formation.', '2024-06-10 13:00:02'),
(26, 'HERAK mohammed vient de s\'interesser a votre formation.', '2024-06-10 13:35:12'),
(27, 'HERAK mohammed vient de s\'interesser a votre formation.', '2024-06-10 13:57:23'),
(28, 'HERAK mohammed vient de s\'interesser a votre formation.', '2024-06-10 14:04:42'),
(29, 'HERAK mohammed vient de s\'interesser a votre formation.', '2024-06-10 14:04:46');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
CREATE TABLE IF NOT EXISTS `project` (
  `projectID` int NOT NULL AUTO_INCREMENT,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `projectTitle` varchar(100) DEFAULT NULL,
  `projectDescription` text,
  PRIMARY KEY (`projectID`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`projectID`, `startDate`, `endDate`, `projectTitle`, `projectDescription`) VALUES
(1, '2023-05-16', '2025-06-15', 'AI Model ', 'for supervising calls quality for a call center'),
(2, '2024-05-02', '2024-08-02', 'collaboration platform', 'for making collabartion between devs easier'),
(3, '2024-05-01', '2024-05-31', 'GTK', 'mazal mafhmnahach'),
(4, '2024-01-01', '2024-06-01', 'AI Chatbot Development', 'Developing an AI chatbot for customer support.'),
(5, '2024-02-15', '2024-08-15', 'E-commerce Website', 'Building a scalable e-commerce platform.'),
(6, '2024-03-01', '2024-09-01', 'Mobile App for Fitness Tracking', 'Creating a mobile app for tracking fitness activities.'),
(7, '2024-04-01', '2024-10-01', 'Cloud Storage Solution', 'Developing a secure cloud storage solution.'),
(8, '2024-05-01', '2024-11-01', 'Machine Learning Model for Predictions', 'Building a machine learning model for sales predictions.'),
(9, '2024-06-01', '2024-12-01', 'Blockchain for Supply Chain', 'Implementing a blockchain solution for supply chain management.'),
(10, '2024-07-01', '2025-01-01', 'IoT Home Automation System', 'Creating an IoT system for home automation.'),
(11, '2024-08-01', '2025-02-01', 'Data Visualization Tool', 'Developing a tool for visualizing big data.'),
(12, '2024-09-01', '2025-03-01', 'Cybersecurity Framework', 'Building a framework for enhancing cybersecurity.'),
(13, '2024-10-01', '2025-04-01', 'Natural Language Processing Tool', 'Creating a tool for natural language processing.');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `questionID` int NOT NULL AUTO_INCREMENT,
  `stateID` int NOT NULL,
  `collaboratorID` int NOT NULL,
  `datePub` datetime NOT NULL,
  `questionTitle` varchar(100) DEFAULT NULL,
  `questionDescription` text,
  PRIMARY KEY (`questionID`),
  KEY `FK_Ask` (`collaboratorID`),
  KEY `FK_collabHasSkill` (`stateID`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`questionID`, `stateID`, `collaboratorID`, `datePub`, `questionTitle`, `questionDescription`) VALUES
(51, 3, 1, '2024-06-10 15:07:16', 'testing', 'aujou'),
(2, 4, 2, '2024-06-18 11:00:00', 'How to create a responsive design?', 'What are the best practices for creating a responsive web design?'),
(3, 3, 3, '2024-06-19 12:00:00', 'How to optimize database performance?', 'What are some techniques to optimize database performance?'),
(4, 4, 4, '2024-06-20 13:00:00', 'What is serverless architecture?', 'Can someone explain what serverless architecture is and its benefits?'),
(6, 1, 2, '2024-06-07 16:00:00', 'What is a REST API?', 'Can someone explain what a REST API is and how to use it?'),
(7, 3, 3, '2024-06-08 17:00:00', 'Best IDE for web development?', 'What is the best IDE for web development and why?'),
(8, 2, 4, '2024-06-09 18:00:00', 'How to handle exceptions in Python?', 'What are the best practices for handling exceptions in Python?'),
(9, 3, 1, '2024-06-10 19:00:00', 'pour tester', '&lt;b&gt;&lt;u&gt;&lt;span style=&quot;color:rgb(255,0,0);&quot;&gt;What are the common practices to secure a web application?&lt;/span&gt;&lt;/u&gt;&lt;/b&gt;'),
(10, 2, 2, '2024-06-11 20:00:00', 'What is Docker?', 'Can someone explain what Docker is and how it works?'),
(11, 1, 3, '2024-06-12 21:00:00', 'Best resources to learn React?', 'What are some good resources to learn React?'),
(12, 2, 4, '2024-06-13 22:00:00', 'How to write unit tests?', 'What are the best practices for writing unit tests?'),
(13, 5, 1, '2024-06-14 23:00:00', 'What is Kubernetes?', 'Can someone explain what Kubernetes is and its uses?'),
(14, 2, 2, '2024-06-15 08:00:00', 'Best practices for SQL queries?', 'How can I write efficient SQL queries?'),
(15, 3, 3, '2024-06-16 09:00:00', 'How to use async/await in JavaScript?', 'Can someone explain how to use async/await in JavaScript?'),
(16, 1, 4, '2024-06-03 12:00:00', 'Difference between Java and JavaScript?', 'Can someone explain the difference between Java and JavaScript?'),
(17, 2, 1, '2024-06-04 13:00:00', 'How to use Git effectively?', 'What are some tips for using Git in a team environment?'),
(18, 3, 2, '2024-06-05 14:00:00', 'Introduction to Machine Learning?', 'What is the best way to get started with machine learning?'),
(19, 2, 3, '2024-06-01 10:00:00', 'How to learn Python?', 'I am new to programming and want to learn Python. Where should I start?'),
(20, 3, 4, '2024-06-02 11:00:00', 'Best practices for JavaScript?', 'What are some best practices for writing clean and efficient JavaScript code?'),
(50, 1, 1, '2024-06-09 21:40:28', 'This question should make me complete', 'AI is overrated bro.');

-- --------------------------------------------------------

--
-- Table structure for table `questioncategory`
--

DROP TABLE IF EXISTS `questioncategory`;
CREATE TABLE IF NOT EXISTS `questioncategory` (
  `categoryID` int NOT NULL,
  `questionID` int NOT NULL,
  PRIMARY KEY (`categoryID`,`questionID`),
  KEY `FK_knowledgeDocType3` (`questionID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `questioncategory`
--

INSERT INTO `questioncategory` (`categoryID`, `questionID`) VALUES
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
(1, 20);

-- --------------------------------------------------------

--
-- Table structure for table `questionkeyword`
--

DROP TABLE IF EXISTS `questionkeyword`;
CREATE TABLE IF NOT EXISTS `questionkeyword` (
  `keywordID` int NOT NULL,
  `questionID` int NOT NULL,
  PRIMARY KEY (`keywordID`,`questionID`),
  KEY `FK_courseKeyWord` (`questionID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `questionkeyword`
--

INSERT INTO `questionkeyword` (`keywordID`, `questionID`) VALUES
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
(1, 47),
(1, 48),
(1, 50),
(2, 47),
(2, 48),
(2, 49),
(2, 50),
(3, 47),
(3, 49),
(3, 50),
(3, 51),
(4, 47),
(7, 51),
(8, 49),
(8, 51),
(9, 48);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `roleID` int NOT NULL AUTO_INCREMENT,
  `rolename` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`roleID`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`roleID`, `rolename`) VALUES
(1, 'frontend dev'),
(2, 'backend dev'),
(3, 'testeur'),
(4, 'ML superviseur'),
(5, 'Project Manager'),
(6, 'Software Developer'),
(7, 'Data Scientist'),
(8, 'QA Engineer'),
(9, 'UI/UX Designer'),
(10, 'DevOps Engineer'),
(11, 'Business Analyst'),
(12, 'Product Owner'),
(13, 'Scrum Master'),
(14, 'Security Specialist');

-- --------------------------------------------------------

--
-- Table structure for table `signin`
--

DROP TABLE IF EXISTS `signin`;
CREATE TABLE IF NOT EXISTS `signin` (
  `courseID` int NOT NULL,
  `collaboratorID` int NOT NULL,
  PRIMARY KEY (`courseID`,`collaboratorID`),
  KEY `FK_SignIn2` (`collaboratorID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `signin`
--

INSERT INTO `signin` (`courseID`, `collaboratorID`) VALUES
(1, 1),
(3, 1),
(15, 1);

-- --------------------------------------------------------

--
-- Table structure for table `skill`
--

DROP TABLE IF EXISTS `skill`;
CREATE TABLE IF NOT EXISTS `skill` (
  `skillID` int NOT NULL AUTO_INCREMENT,
  `skillName` varchar(20) DEFAULT NULL,
  `skillDescription` text,
  PRIMARY KEY (`skillID`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `skill`
--

INSERT INTO `skill` (`skillID`, `skillName`, `skillDescription`) VALUES
(2, 'C (langage)', 'C est un langage de programmation impératif, généraliste et de bas niveau. Inventé au début des années 1970 pour réécrire Unix.'),
(3, 'c++', 'oriented object langage usually used for complex programs and games'),
(4, 'problem solving', 'Problem solving is the act of defining a problem; determining the cause of the problem; identifying, prioritizing, and selecting alternatives for a solution; and implementing a solution.');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

DROP TABLE IF EXISTS `state`;
CREATE TABLE IF NOT EXISTS `state` (
  `stateID` int NOT NULL AUTO_INCREMENT,
  `etat` char(15) DEFAULT NULL,
  PRIMARY KEY (`stateID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`stateID`, `etat`) VALUES
(3, 'En Cours'),
(2, 'Relancée'),
(1, 'Nouvelle'),
(4, 'Complète'),
(5, 'Résolue');

-- --------------------------------------------------------

--
-- Table structure for table `trainingprogram`
--

DROP TABLE IF EXISTS `trainingprogram`;
CREATE TABLE IF NOT EXISTS `trainingprogram` (
  `courseID` int NOT NULL AUTO_INCREMENT,
  `programTitle` varchar(100) DEFAULT NULL,
  `programDescription` text,
  `tutor` text,
  `online` tinyint(1) DEFAULT NULL,
  `publicationDate` date DEFAULT NULL,
  `startday` datetime NOT NULL,
  `endday` date NOT NULL,
  `durationperday` int NOT NULL,
  `createdBy` int DEFAULT NULL,
  PRIMARY KEY (`courseID`),
  KEY `trainingprogram_collaborator_collaboratorID_fk` (`createdBy`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `trainingprogram`
--

INSERT INTO `trainingprogram` (`courseID`, `programTitle`, `programDescription`, `tutor`, `online`, `publicationDate`, `startday`, `endday`, `durationperday`, `createdBy`) VALUES
(8, 'Creative Writing Workshop', 'Improve your creative writing skills.', 'David Wilson', 0, '2024-06-05', '2024-08-15 11:00:00', '2024-08-20', 5, 4),
(5, 'Digital Marketing 101', 'Learn the basics of digital marketing.', 'Jane Smith', 0, '2024-06-02', '2024-08-01 10:00:00', '2024-08-03', 2, 1),
(6, 'Project Management Professional', 'Prepare for the PMP certification.', 'Michael Johnson', 1, '2024-06-03', '2024-09-10 08:00:00', '2024-09-14', 4, 2),
(4, 'Advanced Python Programming', 'An in-depth course on advanced Python topics.', 'Dr. John Doe', 1, '2024-06-01', '2024-07-01 09:00:00', '2024-07-05', 4, 2),
(9, 'Cybersecurity Essentials', 'Learn the basics of cybersecurity.', 'Sarah Brown', 1, '2024-06-06', '2024-09-05 09:00:00', '2024-09-07', 2, 4),
(10, 'Graphic Design Masterclass', 'Master the art of graphic design.', 'Chris Martin', 0, '2024-06-07', '2024-07-25 10:00:00', '2024-07-30', 5, 1),
(11, 'Introduction to Machine Learning', 'An introductory course on machine learning.', 'Laura Lee', 1, '2024-06-08', '2024-08-10 09:00:00', '2024-08-12', 2, 1),
(12, 'BUSINESS 101', 'Learn the basics of starting a business.', 'James Thompson', 0, '2024-06-09', '2024-09-20 09:00:00', '2024-09-23', 3, 1),
(13, 'Blockchain Technology', 'An introduction to blockchain technology.', 'Jennifer White', 1, '2024-06-10', '2024-10-01 09:00:00', '2024-10-05', 4, 1),
(14, 'ILISI', 'software engineering diploma', 'FST', 0, '2024-06-08', '2024-06-01 19:36:00', '2024-08-31', 91, 4),
(15, 'ILISI', 'software engineering diploma', 'FST', 0, '2024-06-08', '2024-06-01 19:36:00', '2024-08-31', 0, 6),
(16, 'Next.js ', 'Pretty simple framework', 'Ali', 1, '2024-06-09', '2024-06-04 20:29:00', '2024-06-26', 22, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
