-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Oct 04, 2021 at 10:30 AM
-- Server version: 8.0.21
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `first`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `creator` varchar(250) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `createddate` date DEFAULT (curdate()),
  `content` varchar(250) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`creator`, `title`, `createddate`, `content`) VALUES
('ahmed', 'announcement', '2021-10-03', 'hi');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `age` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `age`) VALUES
(1, 'mohamed magdy', 23),
(2, 'ahmed ali', 25),
(3, 'ahmed mokhtar', 28),
(4, 'omar ramzy', 25),
(5, 'khalid ahmed', 30),
(36, 'awad ibrahim', 40),
(35, 'leo messi', 33),
(33, 'magdy sabry', 63),
(6, 'ahmed ramzy', 32),
(34, 'mike taison', 83),
(7, 'omar emad', 40);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `registerdate` datetime DEFAULT CURRENT_TIMESTAMP,
  `avatar` varchar(250) DEFAULT NULL,
  `salary` varchar(50) DEFAULT NULL,
  `absence` float DEFAULT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `registerdate`, `avatar`, `salary`, `absence`, `admin`) VALUES
(22, 'fares abdelgawad', 'fares@gmail.com', 'd126378f2c8dca1ead664790b81c8bf3c7a8c431', '2021-09-29 11:02:34', 'uploads/fares.WhatsApp Image 2021-09-09 at 1.54.18 AM.jpeg', '40000', 0, 0),
(21, 'mohamed magdy', 'm7mdmagdy1998@gmail.com', '92bd278b28f8a20da15107d8dd6e8e74f499cd5e', '2021-09-07 14:44:33', 'uploads/mohamed magdy.photo1628525264.jpg', '10000', 0, 1),
(16, 'omar ramzy', 'ramzy@gmail.com', '92bd278b28f8a20da15107d8dd6e8e74f499cd5e', '2021-09-06 01:33:11', 'uploads/amira mohamed.20190624_154633.jpg', '40000', 0, 0),
(23, 'malik', 'malik@gamil.com', 'b68d624f76a04ad4a5542b5a6a2faa8044b53365', '2021-10-01 14:15:31', 'uploads/malik.photo1628526918.jpeg', '5000', 0, 0),
(25, 'ahmed ali', 'ahmedali@gmail.com', 'ad9b80ac138f36dc95c8db96798587cd6e9d5b55', '2021-10-01 14:39:53', 'uploads/ahmed ali.434693.png', '20000', 0, 1),
(27, 'anwar', 'anwar@gmail.com', 'ec1efd16b3dacbdcb598beee5caf60ab5c21e3a1', '2021-10-03 00:26:32', 'uploads/anwar.photo1628525264.jpeg', '4000', 0, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
