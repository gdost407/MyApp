-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 06, 2024 at 06:02 AM
-- Server version: 10.5.20-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id21906452_aniketg4_myapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `calendar`
--

CREATE TABLE `calendar` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
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
(1, 2, '1997-03-04', 'Aniket Golhar', 'Owner of ASG', 'Yearly', 'Birthday', '2024-02-25 12:58:46'),
(2, 2, '1991-01-28', 'Megha Tai', 'Now become a Narad', 'Yearly', 'Birthday', '2024-02-27 10:07:39'),
(3, 2, '1985-09-03', 'Ashwini Tai', 'Now become a Bari', 'Yearly', 'Birthday', '2024-02-27 10:09:33'),
(4, 2, '1991-09-03', 'Kailas Narad', 'Bhauji Allipur', 'Yearly', 'Birthday', '2024-02-27 10:10:17'),
(5, 2, '2023-02-27', 'Wade', 'Shubham & Sujata', 'Yearly', 'Anniversary', '2024-02-27 10:11:06'),
(6, 2, '2023-01-27', 'Golar', 'Shubham & Shiwani', 'Yearly', 'Anniversary', '2024-02-27 10:11:39'),
(7, 3, '1996-02-27', 'Aarti', 'Never miss', 'Yearly', 'Birthday', '2024-02-27 17:29:44'),
(8, 3, '2024-05-12', 'Love first', 'Started loving from my side', 'Yearly', 'Event', '2024-02-27 17:30:57'),
(9, 3, '2023-05-12', 'First Meet', 'We meet after long time', 'Yearly', 'Event', '2024-02-27 17:32:05'),
(10, 3, '2022-11-17', 'First Call', 'I call him', 'Yearly', 'Event', '2024-02-27 17:34:55'),
(11, 3, '2023-11-30', 'Bone Break', 'Everything is broken, FULL STOP', 'Yearly', 'Event', '2024-02-27 17:36:41'),
(12, 2, '1988-02-28', 'Pravin Lichade', 'Real date is 29', 'Yearly', 'Birthday', '2024-02-29 15:25:58'),
(13, 1, '2024-03-08', 'Mahashivratri', 'Shiv Parwati Shubhvivah', 'Once', 'Event', '2024-03-01 03:05:39'),
(14, 1, '2024-03-25', 'Holi', 'Rango ka tyohar', 'Once', 'Event', '2024-03-01 03:06:24'),
(15, 1, '2024-01-26', 'Republic Day', 'India acquire voting', 'Yearly', 'Event', '2024-03-01 04:15:24'),
(16, 1, '2024-08-15', 'Independence Day', 'India will independent', 'Yearly', 'Event', '2024-03-01 04:16:15'),
(17, 1, '2024-04-23', 'Hanuman Bday', 'Birthday of my life partner', 'Once', 'Event', '2024-03-01 04:18:18'),
(18, 1, '2024-04-09', 'Gudipadwa', 'Marathi New Year', 'Once', 'Event', '2024-03-01 04:19:15'),
(19, 2, '1995-04-04', 'Shubham', 'Bawankule, pulgaon', 'Yearly', 'Birthday', '2024-03-03 11:47:46'),
(20, 2, '1956-05-27', 'Suresh Golhar', 'my family', 'Yearly', 'Birthday', '2024-03-05 04:04:42'),
(21, 2, '1995-03-06', 'Sujata wade', 'vahini before gulhane', 'Yearly', 'Birthday', '2024-03-06 01:15:00'),
(22, 2, '1991-03-15', 'Aprna Ruikar', 'Vahini, Wife of Dinesh Dada', 'Yearly', 'Birthday', '2024-03-15 04:17:30'),
(23, 2, '2016-03-20', 'Pimpalkar', 'Priya & Ritesh Pimpalkar', 'Yearly', 'Anniversary', '2024-03-20 11:29:26'),
(24, 1, '2024-04-11', 'Ramjan Ed', 'Ed Mubarak', 'Once', 'Event', '2024-04-04 03:15:37');

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
(1, 'ASG', 'asg@gmail.com', '9dbbae8b0159030ac238af0985c3ad65', 'aniket', '1997-03-04', 'Shende-Lay-Out, Ward no 3', 'Maharashtra', 'Pulgaon', '442302', '20.7153248', '78.3082921', '9049611445', 'assets/Profile/a2e0d72e909b87677a56833007788a4e.jpeg', '2024-02-27 20:32:24'),
(2, 'Aniket S Golhar', 'golharaniket07@gmail.com', '9dbbae8b0159030ac238af0985c3ad65', 'aniket', '1996-03-04', 'Shivaji Colony, Pulgaon, Maharashtra, India', 'Maharashtra', 'Pulgaon', '442302', '20.7308022', '78.31736409999999', '9049611445', 'assets/Profile/a2e0d72e909b87677a56833007788a4e.jpeg', '2024-03-05 14:14:32'),
(3, 'A A G', 'aag@gmail.com', '3da6d380072b2669166030c3e251a86e', 'Aarti@27', '1996-02-27', NULL, NULL, NULL, NULL, '20.7153248', '78.3082921', '9923517473', NULL, '2024-02-27 17:28:19'),
(4, 'Vaishnavi Nimje', 'vaishnonimje13@gmail.com', '6e677fe703cba1f6a4a44db8596e505e', 'anvi1304', '1999-10-13', 'Nachangaon Road pulgaon', 'India', 'Wardha', '442302', '20.721627', '78.332076', '9561101456', NULL, '2024-02-28 12:01:50'),
(5, 'Madhusudan Chawat', 'madhusudanchawat@gmail.com', '3445ffd1beb7f12b8c6c58ba9d202684', 'Maddy@123', '2024-03-03', NULL, NULL, NULL, NULL, '20.721627', '78.332076', NULL, NULL, '2024-03-03 12:42:31'),
(6, 'Test Lockene', 'dealerlockene@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '123456', '2024-03-06', NULL, NULL, NULL, NULL, '20.721627', '78.332076', NULL, NULL, '2024-03-06 13:26:57');

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 1,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `type` enum('Credit','Debit') NOT NULL DEFAULT 'Debit',
  `bank` varchar(20) NOT NULL DEFAULT 'Wallet',
  `amount` int(11) NOT NULL DEFAULT 0,
  `perticular` text DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`id`, `user_id`, `date`, `type`, `bank`, `amount`, `perticular`, `created`) VALUES
(1, 2, '2024-01-27', 'Credit', 'Kotal 811', 29092, 'Balance', '2024-02-25 14:19:42'),
(2, 2, '2024-02-14', 'Credit', 'Kotal 811', 23967, 'Jan24 Payment', '2024-02-25 14:20:24'),
(3, 2, '2024-01-27', 'Credit', 'BOI', 14115, 'Balance', '2024-02-25 14:21:16'),
(4, 2, '2024-02-01', 'Debit', 'BOI', 1770, 'Feb24 Rent', '2024-02-25 14:21:51'),
(5, 2, '2024-02-26', 'Debit', 'BOI', 6700, 'Dr. Dhage Fees', '2024-02-26 09:43:57'),
(6, 2, '2024-02-28', 'Debit', 'Kotal 811', 20000, 'Boi trasfer', '2024-02-28 04:30:31'),
(7, 2, '2024-02-28', 'Credit', 'BOI', 20000, 'Kotak trasfer', '2024-02-28 04:30:52'),
(8, 2, '2024-03-03', 'Debit', 'BOI', 1500, 'March room rent', '2024-03-03 11:27:45'),
(9, 2, '2024-03-05', 'Debit', 'BOI', 212, 'Airtel Recharge', '2024-03-05 08:14:16'),
(10, 2, '2024-03-05', 'Debit', 'BOI', 108, 'Baba BSNL recharge', '2024-03-05 09:42:14'),
(11, 2, '2024-03-06', 'Debit', 'BOI', 720, 'Vi recharge', '2024-03-06 10:25:42'),
(12, 2, '2024-03-06', 'Debit', 'BOI', 18, 'SMS charges', '2024-03-06 15:07:42'),
(13, 2, '2024-03-11', 'Credit', 'Kotal 811', 19110, 'Feb24 Payment', '2024-03-11 11:04:57'),
(14, 2, '2024-03-11', 'Debit', 'Kotal 811', 10000, 'Trasfer to Baba', '2024-03-11 11:05:21'),
(15, 2, '2024-03-13', 'Debit', 'Kotal 811', 39000, 'HP 15s laptop', '2024-03-13 13:47:40'),
(16, 2, '2024-04-02', 'Debit', 'BOI', 1500, 'April 24 Room Rent', '2024-04-02 11:11:13'),
(17, 2, '2024-04-02', 'Debit', 'BOI', 211, 'Airtel Recharge', '2024-04-02 16:21:20');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
