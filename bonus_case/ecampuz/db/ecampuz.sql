-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2021 at 05:32 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecampuz`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('958ogc4f9i1cahletsunq06iauus7a4u', '::1', 1631588632, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633313538383633323b),
('b6jj2ln5j6g7fbuk6te093d8uc016tmf', '::1', 1631589191, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633313538393139313b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b4e3b733a373a22726f6c655f6964223b733a313a2231223b7d),
('7b7sr3fe58ph351i1mf12kdht1mgri6g', '::1', 1631589493, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633313538393439333b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b4e3b733a373a22726f6c655f6964223b733a313a2231223b7d),
('n7ju0hpdkgdfaa0jvjgs9v0ggmvglglb', '::1', 1631589852, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633313538393835323b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b4e3b733a373a22726f6c655f6964223b733a313a2231223b7d),
('unt3vnn338fiufj6s6d1liqh041o80en', '::1', 1631590114, 0x5f5f63695f6c6173745f726567656e65726174657c693a313633313538393934373b6c6f676765645f696e7c613a333a7b733a373a22757365725f6964223b733a313a2231223b733a383a22757365726e616d65223b4e3b733a373a22726f6c655f6964223b733a313a2231223b7d);

-- --------------------------------------------------------

--
-- Table structure for table `instansi`
--

CREATE TABLE `instansi` (
  `instansi_id` int(11) NOT NULL,
  `instansi_name` varchar(255) NOT NULL,
  `instansi_description` text NOT NULL,
  `user_create_by` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `role_id`, `full_name`) VALUES
(1, 'helmyfikrih', '712384e9b528fa2e9861620737584d9b', 1, 'Helmy Fikri Husein');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`role_id`, `role_name`) VALUES
(1, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `instansi`
--
ALTER TABLE `instansi`
  ADD PRIMARY KEY (`instansi_id`),
  ADD KEY `instansi_user_create_by_IDX` (`user_create_by`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `users_FK` (`role_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `instansi`
--
ALTER TABLE `instansi`
  MODIFY `instansi_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `instansi`
--
ALTER TABLE `instansi`
  ADD CONSTRAINT `instansi_FK` FOREIGN KEY (`user_create_by`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_FK` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
