-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 12, 2022 at 08:06 PM
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
  `name` varchar(100) NOT NULL,
  `monday` varchar(10) NOT NULL,
  `tuesday` varchar(10) NOT NULL,
  `wednesday` varchar(10) NOT NULL,
  `thursday` varchar(10) NOT NULL,
  `friday` varchar(10) NOT NULL,
  `saturday` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `avil_day`
--

INSERT INTO `avil_day` (`id`, `date`, `name`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`) VALUES
(1, '2022-07-12', 'ben tsardoulias', '9am-4pm', '9am-4pm', '9am-4pm', '9am-4pm', '9am-4pm', '9am-4pm');

-- --------------------------------------------------------

--
-- Table structure for table `pref_day`
--

CREATE TABLE `pref_day` (
  `id` int(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `monday` varchar(10) NOT NULL,
  `tuesday` varchar(10) NOT NULL,
  `wednesday` varchar(10) NOT NULL,
  `thursday` varchar(10) NOT NULL,
  `friday` varchar(10) NOT NULL,
  `saturday` varchar(10) NOT NULL,
  `hours` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pref_day`
--

INSERT INTO `pref_day` (`id`, `date`, `name`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `hours`) VALUES
(4, '2022-07-12 19:50:08', 'ben tsardoulias', '9am-4pm', '9am-4pm', '9am-4pm', '9am-4pm', '9am-4pm', '9am-4pm', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `roll` varchar(1000) NOT NULL DEFAULT 'CaShIeR',
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `roll`, `firstname`, `lastname`, `email`, `username`, `password`) VALUES
(6, 'CaShIeR', 'ben', 'tsardoulias', 'bent23jam@gmail.com', 'tibthink', '44f67e88ee68463b304b9f06ef8adeaa77fc982f'),
(7, 'CaShIeR', 'ben', 'tsardoulias', 'bent23jam@gmail.com', 'hacker', '44f67e88ee68463b304b9f06ef8adeaa77fc982f');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avil_day`
--
ALTER TABLE `avil_day`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pref_day`
--
ALTER TABLE `pref_day`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `avil_day`
--
ALTER TABLE `avil_day`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pref_day`
--
ALTER TABLE `pref_day`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
