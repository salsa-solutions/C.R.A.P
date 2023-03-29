-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 28, 2023 at 10:08 PM
-- Server version: 10.5.18-MariaDB-0+deb11u1
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gs_useraccounts`
--

-- --------------------------------------------------------

--
-- Table structure for table `avil_day`
--

CREATE TABLE `avil_day` (
  `id` int(11) NOT NULL,
  `approved` varchar(100) NOT NULL DEFAULT 'pending',
  `date` date NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `monday` varchar(10) NOT NULL,
  `tuesday` varchar(10) NOT NULL,
  `wednesday` varchar(10) NOT NULL,
  `thursday` varchar(10) NOT NULL,
  `friday` varchar(10) NOT NULL,
  `saturday` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `avil_day`
--

INSERT INTO `avil_day` (`id`, `approved`, `date`, `name`, `username`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`) VALUES
(1, 'approved', '2023-03-24', 'David Alzuraigat', 'Davidz216', '9', '9', '9', '9', '9', '9');

-- --------------------------------------------------------

--
-- Table structure for table `current_schedule`
--

CREATE TABLE `current_schedule` (
  `id` int(11) NOT NULL,
  `approved` varchar(100) NOT NULL,
  `status` text NOT NULL,
  `date` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `monday` varchar(9) NOT NULL,
  `tuesday` varchar(9) NOT NULL,
  `wednesday` varchar(9) NOT NULL,
  `thursday` varchar(9) NOT NULL,
  `friday` varchar(9) NOT NULL,
  `saturday` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `current_schedule`
--

INSERT INTO `current_schedule` (`id`, `approved`, `status`, `date`, `name`, `username`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`) VALUES
(1, 'David Alzuraigat', 'approved', '2023-03-24 21:52:15', 'David Alzuraigat', 'Davidz216', '9-4', 'OFF', 'OFF', '9-4', 'OFF', 'OFF'),
(2, 'David Alzuraigat', 'approved', '2023-03-24 21:52:19', 'David Alzuraigat', 'Davidz216', '9-4', 'OFF', 'OFF', '9-4', 'OFF', 'OFF');

-- --------------------------------------------------------

--
-- Table structure for table `pref_day`
--

CREATE TABLE `pref_day` (
  `id` int(11) NOT NULL,
  `date` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `monday` varchar(9) NOT NULL,
  `tuesday` varchar(9) NOT NULL,
  `wednesday` varchar(9) NOT NULL,
  `thursday` varchar(9) NOT NULL,
  `friday` varchar(9) NOT NULL,
  `saturday` varchar(9) NOT NULL,
  `hours` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `created` varchar(100) NOT NULL,
  `permissions` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role`, `created`, `permissions`) VALUES
(1, 'Admin', 'ben', '');

-- --------------------------------------------------------

--
-- Table structure for table `sr`
--

CREATE TABLE `sr` (
  `id` int(11) NOT NULL,
  `date` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `message` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `succesful_logins`
--

CREATE TABLE `succesful_logins` (
  `id` int(11) NOT NULL,
  `date` text NOT NULL,
  `username` mediumtext NOT NULL,
  `name` mediumtext NOT NULL,
  `ip` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `succesful_logins`
--

INSERT INTO `succesful_logins` (`id`, `date`, `username`, `name`, `ip`) VALUES
(1, '2023-03-24 21:42:57', 'Davidz216', 'David Alzuraigat', '65.24.118.144'),
(2, '2023-03-24 21:43:21', 'tibthink', 'ben tsardoulias', '65.24.118.144'),
(3, '2023-03-24 21:49:53', 'Davidz216', 'David Alzuraigat', '65.24.118.144'),
(4, '2023-03-24 22:56:53', 'tibthink', 'ben tsardoulias', '192.168.1.1'),
(5, '2023-03-25 00:04:50', 'tibthink', 'ben tsardoulias', '192.168.1.1'),
(6, '2023-03-25 12:35:18', 'tibthink', 'ben tsardoulias', '192.168.1.1'),
(7, '2023-03-25 13:10:59', 'tibthink', 'ben tsardoulias', '192.168.1.1'),
(8, '2023-03-25 13:13:44', 'tibthink', 'ben tsardoulias', '192.168.1.1'),
(9, '2023-03-25 17:09:47', 'tibthink', 'ben tsardoulias', '192.168.1.1'),
(10, '2023-03-25 17:35:04', 'tibthink', 'ben tsardoulias', '192.168.1.1'),
(11, '2023-03-26 14:05:53', 'tibthink', 'ben tsardoulias', '192.168.1.1'),
(12, '2023-03-26 14:10:36', 'tibthink', 'ben tsardoulias', '192.168.1.1'),
(13, '2023-03-26 14:12:29', 'tibthink', 'ben tsardoulias', '192.168.1.1'),
(14, '2023-03-26 15:34:41', 'tibthink', 'ben tsardoulias', '192.168.1.1'),
(15, '2023-03-26 15:46:41', 'tibthink', 'ben tsardoulias', '192.168.1.1'),
(16, '2023-03-26 16:38:05', 'tibthink', 'ben tsardoulias', '192.168.1.1'),
(17, '2023-03-26 16:38:15', 'test', 'jane doe', '192.168.1.1'),
(18, '2023-03-26 16:46:13', 'test-admin', 'ben tsardoulias', '192.168.1.1'),
(19, '2023-03-26 18:12:23', 'tibthink', 'ben tsardoulias', '192.168.1.1'),
(20, '2023-03-26 18:12:24', 'tibthink', 'ben tsardoulias', '192.168.1.1'),
(21, '2023-03-26 18:28:08', 'test', 'jane doe', '192.168.1.1'),
(22, '2023-03-26 19:22:41', 'tibthink', 'ben tsardoulias', '192.168.1.1'),
(23, '2023-03-26 20:22:40', 'tibthink', 'ben tsardoulias', '192.168.1.1'),
(24, '2023-03-26 20:38:58', 'tibthink', 'ben tsardoulias', '192.168.1.1'),
(25, '2023-03-26 20:58:42', 'test', 'jane doe', '192.168.1.1'),
(26, '2023-03-26 21:22:24', 'tibthink', 'ben tsardoulias', '192.168.1.1'),
(27, '2023-03-26 23:37:47', 'tibthink', 'ben tsardoulias', '192.168.1.1'),
(28, '2023-03-27 00:49:53', 'tibthink', 'ben tsardoulias', '192.168.1.1'),
(29, '2023-03-27 22:27:19', 'tibthink', 'ben tsardoulias', '104.189.212.179'),
(30, '2023-03-28 17:13:17', 'tibthink', 'ben tsardoulias', '192.168.1.1'),
(31, '2023-03-28 17:14:58', 'test', 'jane doe', '192.168.1.1'),
(32, '2023-03-28 18:42:58', 'tibthink', 'ben tsardoulias', '192.168.1.1'),
(33, '2023-03-28 18:46:35', 'tibthink', 'ben tsardoulias', '192.168.1.1'),
(34, '2023-03-28 18:47:18', 'test', 'jane doe', '192.168.1.1'),
(35, '2023-03-28 19:58:55', 'tibthink', 'ben tsardoulias', '192.168.1.127'),
(36, '2023-03-28 20:00:29', 'tibthink', 'ben tsardoulias', '192.168.1.127'),
(37, '2023-03-28 20:25:09', 'test', 'jane doe', '192.168.1.127'),
(38, '2023-03-28 21:26:11', 'tibthink', 'ben tsardoulias', '192.168.1.127'),
(39, '2023-03-28 21:26:12', 'tibthink', 'ben tsardoulias', '192.168.1.127');

-- --------------------------------------------------------

--
-- Table structure for table `unsuccesful_logins`
--

CREATE TABLE `unsuccesful_logins` (
  `id` int(11) NOT NULL,
  `date` text NOT NULL,
  `username` mediumtext NOT NULL,
  `name` mediumtext NOT NULL,
  `ip` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `unsuccesful_logins`
--

INSERT INTO `unsuccesful_logins` (`id`, `date`, `username`, `name`, `ip`) VALUES
(1, '2023-03-28 20:00:23', 'tibthink', 'ben tsardoulias', '192.168.1.127');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `date` varchar(100) NOT NULL,
  `role` varchar(1000) NOT NULL DEFAULT 'pending',
  `permission` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `approved` varchar(100) NOT NULL,
  `active` varchar(100) NOT NULL DEFAULT 'true'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `date`, `role`, `permission`, `firstname`, `lastname`, `email`, `phone`, `username`, `password`, `approved`, `active`) VALUES
(1, '2023-03-22 23:42:43', 'Admin', '', 'ben', 'tsardoulias', 'bent23jam@gmail.com', '', 'tibthink', '67f27f4a07cfac964d2db9fef1f8f94c2b4d5a04', 'approved', 'true'),
(9, '2023-03-24 17:30:37', 'Server', '', 'jane', 'doe', 'janedoe@gmail.com', '', 'test', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'approved', 'true'),
(10, '2023-03-24 21:42:36', 'Manager', '', 'David', 'Alzuraigat', 'Alzuraigat.david@gmail.com', '', 'davidz216', '4d7d6125686f51ce4de4bb527c4cf9223b9319c3', 'approved', 'true'),
(12, '2023-03-26 16:45:53', 'Manager', '', 'ben', 'tsardoulias', 'bent23jam@gmail.com', '', 'test-admin', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'approved', 'true');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avil_day`
--
ALTER TABLE `avil_day`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `current_schedule`
--
ALTER TABLE `current_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pref_day`
--
ALTER TABLE `pref_day`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sr`
--
ALTER TABLE `sr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `succesful_logins`
--
ALTER TABLE `succesful_logins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unsuccesful_logins`
--
ALTER TABLE `unsuccesful_logins`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `current_schedule`
--
ALTER TABLE `current_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pref_day`
--
ALTER TABLE `pref_day`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sr`
--
ALTER TABLE `sr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `succesful_logins`
--
ALTER TABLE `succesful_logins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `unsuccesful_logins`
--
ALTER TABLE `unsuccesful_logins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`tibthink`@`localhost` EVENT `flush avil_day` ON SCHEDULE EVERY 1 WEEK STARTS '2023-03-26 00:00:00' ON COMPLETION NOT PRESERVE ENABLE COMMENT 'flushes avil_day from the table every week' DO DELETE FROM avil_day$$

CREATE DEFINER=`tibthink`@`localhost` EVENT `flush pref_day` ON SCHEDULE EVERY 1 WEEK STARTS '2023-03-26 00:00:00' ON COMPLETION NOT PRESERVE ENABLE COMMENT 'flushes avil_day from the table every week' DO DELETE FROM pref_day$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
