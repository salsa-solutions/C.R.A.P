-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 17, 2022 at 01:16 AM
-- Server version: 8.0.31-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `id` int NOT NULL,
  `date` date NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `monday` varchar(10) NOT NULL,
  `tuesday` varchar(10) NOT NULL,
  `wednesday` varchar(10) NOT NULL,
  `thursday` varchar(10) NOT NULL,
  `friday` varchar(10) NOT NULL,
  `saturday` varchar(10) NOT NULL,
  `approved` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `current_schedule`
--

CREATE TABLE `current_schedule` (
  `id` int NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pref_day`
--

CREATE TABLE `pref_day` (
  `id` int NOT NULL,
  `date` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `monday` varchar(9) NOT NULL,
  `tuesday` varchar(9) NOT NULL,
  `wednesday` varchar(9) NOT NULL,
  `thursday` varchar(9) NOT NULL,
  `friday` varchar(9) NOT NULL,
  `saturday` varchar(9) NOT NULL,
  `hours` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sp`
--

CREATE TABLE `sp` (
  `id` int NOT NULL,
  `date` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `message` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `succesful_logins`
--

CREATE TABLE `succesful_logins` (
  `id` int NOT NULL,
  `date` text NOT NULL,
  `username` mediumtext NOT NULL,
  `name` mediumtext NOT NULL,
  `ip` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unsuccesful_logins`
--

CREATE TABLE `unsuccesful_logins` (
  `id` int NOT NULL,
  `date` text NOT NULL,
  `username` mediumtext NOT NULL,
  `name` mediumtext NOT NULL,
  `ip` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `date` varchar(100) NOT NULL,
  `roll` varchar(1000) NOT NULL DEFAULT 'CaShIeR',
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `approved` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `date`, `roll`, `firstname`, `lastname`, `email`, `username`, `password`, `approved`) VALUES
(4, '2022-10-26 21:34:50', 'admin', 'ben', 'tsardoulias', 'bent23jam@gmail.com', 'tibthink', '44f67e88ee68463b304b9f06ef8adeaa77fc982f', 'approved'),
(7, '2022-11-16 23:22:35', 'CaShIeR', 'Rebecca', 'Nee', 'neeinc', 'rnee', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'approved');

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
-- Indexes for table `sp`
--
ALTER TABLE `sp`
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
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `current_schedule`
--
ALTER TABLE `current_schedule`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pref_day`
--
ALTER TABLE `pref_day`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp`
--
ALTER TABLE `sp`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `succesful_logins`
--
ALTER TABLE `succesful_logins`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `unsuccesful_logins`
--
ALTER TABLE `unsuccesful_logins`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
