-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2024 at 09:44 AM
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
-- Database: `crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `adminss`
--

CREATE TABLE `adminss` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobileno` varchar(15) NOT NULL,
  `qualification` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adminss`
--

INSERT INTO `adminss` (`id`, `name`, `email`, `mobileno`, `qualification`, `password`) VALUES
(2, 'Mathan raja', 'mathanrajapatchamuthu15@gmail.com', '7708786932', 'Mca', '$2y$10$hn4PUXOZvpr7xlgrjPS8n.rK8Dxi9kwOGcW9WXDQ04AMW2R9K0rfq'),
(4, 'admin', 'admin@gmail.com', '1234567890', 'maths', '$2y$10$OAAEVkr/KRSVagoYelBftedHm9McGwSzKdgCWYfma7ipytHucTzx2');

-- --------------------------------------------------------

--
-- Table structure for table `llog`
--

CREATE TABLE `llog` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobileno` varchar(15) NOT NULL,
  `qualification` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `approved` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `llog`
--

INSERT INTO `llog` (`id`, `name`, `email`, `mobileno`, `qualification`, `password`, `approved`, `created_at`) VALUES
(3, 'logi', 'logi@gmail.com', '1234567890', 'maths', '$2y$10$RxBEO1XF1r3TRdCYttoxmOwLSj0NYY5oIVkEU11dtaZvGbQZP/RuK', 1, '2024-09-17 05:51:58'),
(5, 'Mathan', 'mathan@gmail.com', '7708786932', 'Mca', '$2y$10$XVUXV1wz7Jm592l1wUrFbOw.EFnqJ5lMoGg0wuBW0OGa1ipOc5gYe', 1, '2024-09-17 05:57:00'),
(6, 'poomani', 'poomani@gmail.com', '7708786932', 'maths', '$2y$10$d5gjtGQeT7NeApdhc./xCeEqZ/kUA.FEn4eZSzHrSHk4jvRErBcs6', 0, '2024-09-17 06:17:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`email`);

--
-- Indexes for table `adminss`
--
ALTER TABLE `adminss`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `llog`
--
ALTER TABLE `llog`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `adminss`
--
ALTER TABLE `adminss`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `llog`
--
ALTER TABLE `llog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
