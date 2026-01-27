-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Jan 27, 2026 at 01:10 PM
-- Server version: 9.6.0
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_database`
--
CREATE DATABASE IF NOT EXISTS `my_database` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `my_database`;

-- --------------------------------------------------------

--
-- Stand-in structure for view `a`
-- (See below for the actual view)
--
CREATE TABLE `a` (
`first_name` varchar(35)
,`id` int
,`last_name` varchar(35)
);

-- --------------------------------------------------------

--
-- Table structure for table `error_log`
--

CREATE TABLE `error_log` (
  `id` int NOT NULL,
  `message` varchar(1000) NOT NULL,
  `trace` varchar(1000) NOT NULL,
  `timestamp` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE `people` (
  `id` int NOT NULL,
  `first_name` varchar(35) NOT NULL,
  `last_name` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`id`, `first_name`, `last_name`) VALUES
(1, 'John', 'Doe'),
(2, 'John', 'Doe'),
(3, 'John', 'Doe'),
(4, 'John', 'Doe'),
(5, 'John', 'Doe'),
(6, 'John', 'Doe'),
(7, 'John', 'Doe');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `error_log`
--
ALTER TABLE `error_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `error_log`
--
ALTER TABLE `error_log`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `people`
--
ALTER TABLE `people`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

-- --------------------------------------------------------

--
-- Structure for view `a`
--
DROP TABLE IF EXISTS `a`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `a`  AS SELECT `people`.`id` AS `id`, `people`.`first_name` AS `first_name`, `people`.`last_name` AS `last_name` FROM `people` ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
