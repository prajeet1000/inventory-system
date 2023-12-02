-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2023 at 01:32 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=Active,1=Inactive',
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0' COMMENT '1=Deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`id`, `name`, `address`, `created_at`, `status`, `is_deleted`) VALUES
(1, 'SBI', 'Kudi Bhagtasni', '2023-02-05 17:44:39', '0', '0'),
(2, 'Demo', 'Demo', '2023-02-06 06:47:08', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `inwards`
--

CREATE TABLE `inwards` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `challan_number` varchar(80) NOT NULL,
  `challan_img` varchar(150) NOT NULL,
  `party` int(11) NOT NULL,
  `remark` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=Active,1=Inactive',
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inwards`
--

INSERT INTO `inwards` (`id`, `date`, `challan_number`, `challan_img`, `party`, `remark`, `created_at`, `status`, `is_deleted`) VALUES
(1, '2023-02-07', '09090', '', 1, 'zfsad', '2023-02-07 09:08:28', '0', '1'),
(2, '2023-02-07', '09090', '', 1, 'zfsad', '2023-02-07 09:08:44', '0', '0'),
(3, '2023-02-07', '1234', '', 1, 'tEST rEMARK', '2023-02-07 10:15:12', '0', '1'),
(4, '2023-02-07', '12', '', 1, 'sdgf', '2023-02-07 10:16:30', '0', '0'),
(5, '2023-02-07', '12', '', 1, 'sdgf', '2023-02-07 10:17:13', '0', '0'),
(6, '2023-02-07', '123456', '1675768981.jpeg', 1, 'Jodhpur', '2023-02-07 11:23:01', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `inwards_item`
--

CREATE TABLE `inwards_item` (
  `id` int(11) NOT NULL,
  `inwards_id` int(11) NOT NULL,
  `reel_number` int(11) NOT NULL,
  `gsm` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `meel` int(11) NOT NULL,
  `reel_ream` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inwards_item`
--

INSERT INTO `inwards_item` (`id`, `inwards_id`, `reel_number`, `gsm`, `size`, `quantity`, `weight`, `meel`, `reel_ream`, `created_at`, `status`) VALUES
(1, 5, 1, 2, 3, 10, 5, 1, 6, '2023-02-07 10:17:13', 1),
(2, 6, 121, 55, 33, 6, 100, 2, 1, '2023-02-07 11:23:01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `machine`
--

CREATE TABLE `machine` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=Active,1=Inactive',
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0' COMMENT '1=Deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `machine`
--

INSERT INTO `machine` (`id`, `name`, `address`, `created_at`, `status`, `is_deleted`) VALUES
(1, 'Test', 'Test Location', '2023-02-06 06:54:31', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `meel`
--

CREATE TABLE `meel` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=Active,1=Inactive',
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0' COMMENT '1=Deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meel`
--

INSERT INTO `meel` (`id`, `name`, `created_at`, `status`, `is_deleted`) VALUES
(1, 'Test Meel', '2023-02-06 07:11:38', '0', '0'),
(2, 'Demo Meel', '2023-02-06 07:11:49', '0', '0'),
(3, 'Hello', '2023-02-06 08:44:42', '1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `outwards`
--

CREATE TABLE `outwards` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `challan_number` varchar(80) NOT NULL,
  `challan_img` varchar(150) NOT NULL,
  `party` int(11) NOT NULL,
  `remark` text NOT NULL,
  `reel_number` int(11) NOT NULL,
  `gsm` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `reel_ream` int(11) NOT NULL,
  `taxi_number` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=Active,1=Inactive',
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `outwards`
--

INSERT INTO `outwards` (`id`, `date`, `challan_number`, `challan_img`, `party`, `remark`, `reel_number`, `gsm`, `size`, `quantity`, `weight`, `reel_ream`, `taxi_number`, `created_at`, `status`, `is_deleted`) VALUES
(1, '2023-02-08', '12345', '1675845980.jpeg', 1, 'Test OUtwards remarks', 0, 0, 0, 0, 0, 0, '', '2023-02-08 08:46:20', '0', '1'),
(2, '2023-02-08', '09090', '1675846406.jpeg', 1, 'Demo', 121, 55, 33, 6, 100, 1, '', '2023-02-08 08:53:26', '0', '1'),
(3, '2023-02-08', '0987', '79751675848974.jpeg', 1, 'Pradeep CHourdhary & Sons', 1, 2, 3, 10, 5, 6, 'RJ 19 BZ 2711', '2023-02-08 09:36:14', '0', '0'),
(4, '2023-02-08', 'Test NEw 001', '30781675855679.jpeg', 1, 'Test 009', 121, 55, 33, 0, 100, 1, 'RJ 19 BZ 0379', '2023-02-08 11:27:59', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `party`
--

CREATE TABLE `party` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `gstin` varchar(80) NOT NULL,
  `person_name` varchar(80) NOT NULL,
  `person_number` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=Active,1=Inactive',
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0' COMMENT '1=Deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `party`
--

INSERT INTO `party` (`id`, `name`, `address`, `gstin`, `person_name`, `person_number`, `created_at`, `status`, `is_deleted`) VALUES
(1, 'Voltas', 'Delhi Gujrat', 'FFF0923049', 'Pradeep Choudhary', 'Test', '2023-02-06 07:02:53', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `production`
--

CREATE TABLE `production` (
  `id` int(11) NOT NULL,
  `reel_number` int(11) NOT NULL,
  `gsm` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `meel` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `machine` int(11) NOT NULL,
  `length` int(11) NOT NULL,
  `width` int(11) NOT NULL,
  `remark` text NOT NULL,
  `sheet_img` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('0','1') DEFAULT '0' COMMENT '0=Active,1=Inactive',
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0' COMMENT '1=Deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `production`
--

INSERT INTO `production` (`id`, `reel_number`, `gsm`, `size`, `weight`, `meel`, `quantity`, `machine`, `length`, `width`, `remark`, `sheet_img`, `created_at`, `status`, `is_deleted`) VALUES
(2, 1, 2, 3, 5, 0, 0, 1, 20, 30, 'Tessdas', '85681675859812.jpeg', '2023-02-08 12:36:52', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `mobile` varchar(30) NOT NULL,
  `branch` varchar(80) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=Active,1=Inactive',
  `is_deleted` enum('0','1') NOT NULL COMMENT '1=Deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `mobile`, `branch`, `password`, `created_at`, `status`, `is_deleted`) VALUES
(1, 'Chetan Makwana', '8442023446', '[\"1\",\"2\"]', 'e10adc3949ba59abbe56e057f20f883e', '2023-02-06 05:26:56', '0', '0'),
(2, 'Pradeep Choudhary', '9079238949', '[\"1\"]', 'e10adc3949ba59abbe56e057f20f883e', '2023-02-06 06:08:48', '0', '0'),
(3, 'Chetan Makwana', '8442023446', '[\"1\"]', '25d55ad283aa400af464c76d713c07ad', '2023-02-06 11:46:16', '0', '0'),
(4, 'New', '8442023446', '[\"1\"]', '25d55ad283aa400af464c76d713c07ad', '2023-02-06 11:47:01', '', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inwards`
--
ALTER TABLE `inwards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inwards_item`
--
ALTER TABLE `inwards_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `machine`
--
ALTER TABLE `machine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meel`
--
ALTER TABLE `meel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `outwards`
--
ALTER TABLE `outwards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `party`
--
ALTER TABLE `party`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `production`
--
ALTER TABLE `production`
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
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inwards`
--
ALTER TABLE `inwards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `inwards_item`
--
ALTER TABLE `inwards_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `machine`
--
ALTER TABLE `machine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `meel`
--
ALTER TABLE `meel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `outwards`
--
ALTER TABLE `outwards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `party`
--
ALTER TABLE `party`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `production`
--
ALTER TABLE `production`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
