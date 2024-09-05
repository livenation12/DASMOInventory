-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2024 at 08:52 AM
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
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `activitylogs`
--

CREATE TABLE `activitylogs` (
  `id` int(100) NOT NULL,
  `activityLogId` varchar(50) NOT NULL,
  `action` varchar(255) NOT NULL,
  `providerId` varchar(50) DEFAULT NULL,
  `consumerId` varchar(50) DEFAULT NULL,
  `activityDate` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activitylogs`
--

INSERT INTO `activitylogs` (`id`, `activityLogId`, `action`, `providerId`, `consumerId`, `activityDate`) VALUES
(10, 'kzmYenXPEjTKKQto3NwvBlxObG0qhI8nI7BaY82TtaNxa7Ajc8', 'ADDED', 'S9cujNiwXE', 'TYfKDt4Ofs0mRllljUXI8fGOoxDpTaYvFlvMZFSXKqOzV824mp', '2024-09-04 06:53:56'),
(11, 'ekXSURs7mCh2lqj2hOeSOc6t1KKB2Mb8SjLO7q2TnWaWdOxu8N', 'ADDED', 'S9cujNiwXE', 'vAhMFA42iTbem4ld0gqHmffY7n4Mmx2EzNJ5gwzrvhmOJdAZhm', '2024-09-04 08:18:32');

-- --------------------------------------------------------

--
-- Table structure for table `itemassets`
--

CREATE TABLE `itemassets` (
  `id` int(10) NOT NULL,
  `itemassetId` varchar(50) NOT NULL,
  `asset` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `itemassets`
--

INSERT INTO `itemassets` (`id`, `itemassetId`, `asset`) VALUES
(1, '8CU0XMW4ZT9T0MGEJQAKPGEJN0WG2SYF0DWRRQQVRFPVFX66QA', 'MOUSE'),
(2, 'LR9XH4HC7VVQFPXLDBSB9LCXZXU3RKJHL97GW7TTMECQKRRUIY', 'AVR'),
(3, 'GHPYHRFQEFR1PAHYJNRYCQ0LBU8YGFDGZTIS7KSYCYEVFCLKCA', 'POWER SUPPLY'),
(4, 'OXAX7ORSHQJF5BS0HNZVTSJJNNG2DYQGCBZQAVMD4VPQXQYZ4V', 'KEYBOARD'),
(5, 'L9W2GJRW8K0A08LBG7L3UBRILIECMSACSUN4SP6UPXSGBN5ZQI', 'MONITOR');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(100) NOT NULL,
  `itemId` varchar(50) NOT NULL,
  `assetType` varchar(225) NOT NULL,
  `brand` varchar(200) DEFAULT NULL,
  `quantity` int(100) NOT NULL DEFAULT 1,
  `propNumber` varchar(100) DEFAULT NULL,
  `serialNumber` varchar(100) DEFAULT NULL,
  `designation` text NOT NULL,
  `endUser` varchar(100) DEFAULT NULL,
  `addedBy` varchar(100) NOT NULL,
  `currentLocation` varchar(20) DEFAULT NULL,
  `inHouse` int(10) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `itemId`, `assetType`, `brand`, `quantity`, `propNumber`, `serialNumber`, `designation`, `endUser`, `addedBy`, `currentLocation`, `inHouse`) VALUES
(72, 'vAhMFA42iTbem4ld0gqHmffY7n4Mmx2EzNJ5gwzrvhmOJdAZhm', 'MONITOR', 'Lenovo', 1, 'MDR45533330004', '5SDAWD333FFDD', '4TH FLOOR', 'NOEL LAS', 'S9cujNiwXE', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `attempt` enum('success','failed','','') NOT NULL DEFAULT 'failed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(100) NOT NULL,
  `transactionId` varchar(50) NOT NULL,
  `itemId` varchar(50) NOT NULL,
  `approverId` varchar(100) NOT NULL,
  `pullOutType` varchar(100) NOT NULL,
  `puller` varchar(100) NOT NULL,
  `fromLocation` varchar(200) NOT NULL,
  `toLocation` varchar(200) NOT NULL,
  `pullOutDate` varchar(100) DEFAULT NULL,
  `returnDate` varchar(100) DEFAULT NULL,
  `returnedDate` varchar(100) DEFAULT NULL,
  `receiverId` varchar(50) DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT '0',
  `attachment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `transactionId`, `itemId`, `approverId`, `pullOutType`, `puller`, `fromLocation`, `toLocation`, `pullOutDate`, `returnDate`, `returnedDate`, `receiverId`, `status`, `attachment`) VALUES
(51, 'RsfjwA3y7ep13u6J9VY3jU9SKN9J5t0OJVmlKtZz8FmmraLEZa', 'vAhMFA42iTbem4ld0gqHmffY7n4Mmx2EzNJ5gwzrvhmOJdAZhm', 'S9cujNiwXE', 'Temporary', 'John Smith', '7TH FLOOR', '4TH FLOOR', '2024-09-05 13:59:07', '2024-09-11T13:58', '2024-09-05 14:04:51', 'S9cujNiwXE', '0', 'Application-Form-FINAL.pdf'),
(52, '3n5RWQj4yeAFi8riHrrOwMNLFtB4COwZTzI5obrgtQkOmtNZl6', 'vAhMFA42iTbem4ld0gqHmffY7n4Mmx2EzNJ5gwzrvhmOJdAZhm', 'S9cujNiwXE', 'Permanent', 'John Smith', '7TH FLOOR', '4TH FLOOR', '2024-09-05 14:09:01', NULL, NULL, NULL, '0', 'Application-Form-FINAL(1).pdf');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `userId` varchar(10) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `userId`, `firstname`, `lastname`, `username`, `password`) VALUES
(1, 'S9cujNiwXE', 'Joshua', 'Dionio', 'admin', '$2y$10$112C2sNluDJay5p5IyfXOeAXUInCZWwaqMiBDiG7gG7eHlvF45Ku.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activitylogs`
--
ALTER TABLE `activitylogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `itemassets`
--
ALTER TABLE `itemassets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `itemId` (`itemId`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transactionId` (`transactionId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userId` (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activitylogs`
--
ALTER TABLE `activitylogs`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `itemassets`
--
ALTER TABLE `itemassets`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
