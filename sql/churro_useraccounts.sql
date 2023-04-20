-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 19, 2023 at 11:32 PM
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
-- Database: `churro_useraccounts`
--

--
-- Dumping data for table `availability`
--

INSERT INTO `availability` (`id`, `uuid`, `approved`, `date`, `name`, `username`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`) VALUES
(2, 'f80db120-6a05-4154-9115-4916cf59cb03', 'pending', '2023-04-19', 'ben tsardoulias', 'tibthink', 'OFF', 'OFF', 'OFF', 'OFF', 'OFF', 'OFF');

--
-- Dumping data for table `current_schedule`
--

INSERT INTO `current_schedule` (`id`, `approved`, `status`, `date`, `name`, `username`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`) VALUES
(1, 'David Alzuraigat', 'approved', '2023-03-24 21:52:15', 'David Alzuraigat', 'Davidz216', '9-4', 'OFF', 'OFF', '9-4', 'OFF', 'OFF'),
(2, 'David Alzuraigat', 'approved', '2023-03-24 21:52:19', 'David Alzuraigat', 'Davidz216', '9-4', 'OFF', 'OFF', '9-4', 'OFF', 'OFF');

--
-- Dumping data for table `role_name`
--

INSERT INTO `role_name` (`id`, `role_name`, `created_date`, `created_by`, `role`) VALUES
(1, 'Admin', 'ben', '', '');

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uuid`, `registration_date`, `role`, `role_name`, `name`, `email`, `phone`, `username`, `password`, `active`) VALUES
(1, 'f80db120-6a05-4154-9115-4916cf59cb03', '2023-04-09 17:36:52', 'dev', 'Dev', 'ben tsardoulias', 'bent23jam@gmail.com', '16149493962', 'tibthink', '$2y$10$CUjBIWOhiqEUyHY3GARzHOENKe2XxYSpIbfge94E5aT4HsJ/npsxi', 'true'),
(2, 'cce3709f-63ea-4ec0-8795-74c936516ee7', '2023-04-19 01:09:46', 'pending', 'Pending', 'ben tsardoulias', 'bent23jam@gmail.com', '16149493962', 'google', '$2y$10$uOi20XsYpVylzu0L9QJKO.IY7s/xaip/3SPjbcIchHG7j8sn2gV22', 'true');

--
-- Dumping data for table `wanted_days`
--

INSERT INTO `wanted_days` (`id`, `uuid`, `date`, `name`, `username`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`) VALUES
(1, '', '2023-04-19 01:06:00', 'ben tsardoulias', 'tibthink', 'OFF', '9am-4pm', 'OFF', 'OFF', 'OFF', 'OFF'),
(2, '', '2023-04-19 01:06:18', 'ben tsardoulias', 'tibthink', 'OFF', '9am-4pm', '9am-4pm', 'OFF', 'OFF', 'OFF'),
(3, '', '2023-04-19 01:06:32', 'ben tsardoulias', 'tibthink', 'OFF', '9am-4pm', '9am-4pm', 'OFF', '9am-4pm', 'OFF'),
(4, '', '2023-04-19 01:06:34', 'ben tsardoulias', 'tibthink', '9am-4pm', '9am-4pm', '9am-4pm', 'OFF', '9am-4pm', 'OFF'),
(5, '', '2023-04-19 01:06:36', 'ben tsardoulias', 'tibthink', '9am-4pm', '9am-4pm', '9am-4pm', 'OFF', '9am-4pm', '9am-4pm'),
(6, '', '2023-04-19 01:06:38', 'ben tsardoulias', 'tibthink', '9am-4pm', '9am-4pm', '9am-4pm', '9am-4pm', '9am-4pm', '9am-4pm'),
(7, '', '2023-04-19 23:06:52', 'ben tsardoulias', 'tibthink', 'OFF', 'OFF', 'OFF', 'OFF', 'OFF', 'OFF'),
(8, '', '2023-04-19 23:08:22', 'ben tsardoulias', 'tibthink', 'OFF', 'OFF', 'OFF', 'OFF', 'OFF', 'OFF'),
(9, 'f80db120-6a05-4154-9115-4916cf59cb03', '2023-04-19 23:10:42', 'ben tsardoulias', 'tibthink', 'OFF', 'OFF', 'OFF', 'OFF', 'OFF', 'OFF'),
(10, 'f80db120-6a05-4154-9115-4916cf59cb03', '2023-04-19 23:11:54', 'ben tsardoulias', 'tibthink', 'OFF', 'OFF', 'OFF', 'OFF', 'OFF', 'OFF'),
(11, 'f80db120-6a05-4154-9115-4916cf59cb03', '2023-04-19 23:12:08', 'ben tsardoulias', 'tibthink', 'OFF', 'OFF', 'OFF', 'OFF', 'OFF', 'OFF');

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
