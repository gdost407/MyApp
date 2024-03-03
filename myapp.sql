-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2024 at 07:13 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `calendar`
--

CREATE TABLE `calendar` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `title` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `repeat_this` enum('Once','Daily','Monthly','Yearly') NOT NULL DEFAULT 'Yearly',
  `type` enum('Birthday','Anniversary','Event','ToDo') NOT NULL DEFAULT 'Event',
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `calendar`
--

INSERT INTO `calendar` (`id`, `user_id`, `date`, `title`, `description`, `repeat_this`, `type`, `created`) VALUES
(1, 1, '1996-02-27', 'AAG', 'I don\'t want to remember this.', 'Yearly', 'Birthday', '2024-02-25 08:01:50'),
(2, 1, '2023-02-27', 'Brother', 'S & S Marriage Anniversary', 'Yearly', 'Anniversary', '2024-02-25 08:08:44'),
(3, 1, '2024-02-01', 'Lokhande', 'Brainz1techub friend Anniversary', 'Once', 'Anniversary', '2024-02-25 08:09:24'),
(4, 1, '2024-02-11', 'Birthday Shoping', 'My birthday Shoping', 'Yearly', 'Event', '2024-02-25 08:10:20'),
(5, 1, '2024-02-18', 'Car wash', 'Wash car & make look cool', 'Once', 'ToDo', '2024-02-25 08:10:57'),
(6, 1, '1997-03-04', 'Aniket', 'My Birthday', 'Yearly', 'Birthday', '2024-02-25 09:19:19'),
(7, 1, '2024-03-21', 'Holi Hai', 'are o samba, kab he holi', 'Yearly', 'Event', '2024-02-29 14:36:39'),
(9, 1, '2024-04-25', 'april fool', 'not at all', 'Yearly', 'ToDo', '2024-02-29 15:08:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `spass` varchar(50) DEFAULT NULL,
  `dob` date NOT NULL DEFAULT current_timestamp(),
  `address` text DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `pincode` varchar(6) DEFAULT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `profile` text DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `spass`, `dob`, `address`, `state`, `city`, `pincode`, `latitude`, `longitude`, `mobile`, `profile`, `created`) VALUES
(1, 'Aniket S Golhar', 'aniket@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '123456', '1997-03-04', 'Plo, MH-32', 'Maharashtra', 'Pulgaon', '442302', '21.13536', '79.0986752', '9049611445', NULL, '2024-02-27 20:32:24'),
(2, 'A A G', 'aag@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '123456', '2024-02-27', NULL, NULL, NULL, NULL, '20.721627', '78.332076', NULL, NULL, '2024-02-27 21:13:34');

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `type` enum('Credit','Debit') NOT NULL DEFAULT 'Debit',
  `bank` varchar(20) NOT NULL DEFAULT 'Wallet',
  `amount` int(11) NOT NULL DEFAULT 0,
  `perticular` text DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`id`, `user_id`, `date`, `type`, `bank`, `amount`, `perticular`, `created`) VALUES
(2, 1, '2024-02-25', 'Credit', 'Wallet', 1200, 'from father', '2024-02-25 13:58:36'),
(3, 1, '2024-02-21', 'Debit', 'Wallet', 500, 'pavbhaji', '2024-02-25 13:59:16'),
(4, 1, '2024-03-03', 'Debit', 'BOI', 1500, 'room rent', '2024-03-02 06:12:01'),
(5, 1, '2024-03-12', 'Credit', 'SBI', 20000, 'add money', '2024-03-02 06:30:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calendar`
--
ALTER TABLE `calendar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calendar`
--
ALTER TABLE `calendar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
