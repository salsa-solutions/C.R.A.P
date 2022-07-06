-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 06, 2022 at 10:20 PM
-- Server version: 10.3.34-MariaDB-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crap_useraccount`
--

-- --------------------------------------------------------

--
-- Table structure for table `avil_day`
--

CREATE TABLE `avil_day` (
  `id` int(100) NOT NULL,
  `date` date NOT NULL,
  `monday-start` varchar(4) NOT NULL,
  `monday-end` varchar(4) NOT NULL,
  `tuesday-start` varchar(4) NOT NULL,
  `tuesday-end` varchar(4) NOT NULL,
  `wednesday-start` varchar(4) NOT NULL,
  `wednesday-end` varchar(4) NOT NULL,
  `thursday-start` varchar(4) NOT NULL,
  `thursday-end` varchar(4) NOT NULL,
  `friday-start` varchar(4) NOT NULL,
  `friday-end` varchar(4) NOT NULL,
  `saturday-start` varchar(4) NOT NULL,
  `saturday-end` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avil_day`
--
ALTER TABLE `avil_day`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `avil_day`
--
ALTER TABLE `avil_day`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
