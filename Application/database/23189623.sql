-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2024 at 11:17 AM
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
-- Database: `23189623`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(30) NOT NULL,
  `branch_code` varchar(50) NOT NULL,
  `street` text NOT NULL,
  `city` text NOT NULL,
  `state` text NOT NULL,
  `zip_code` varchar(50) NOT NULL,
  `country` text NOT NULL,
  `contact` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `branch_code`, `street`, `city`, `state`, `zip_code`, `country`, `contact`, `date_created`) VALUES
(1, '8GFy5jJhVZeqmS7', 'Kapan', 'Kathmandu', 'Bagmati', '44600', 'Nepal', '87656789876', '2024-06-16 14:06:30'),
(2, 'xrVqCUoTvzu7S5f', 'Rue Jacques', 'Drancy', 'Paris', '39700', 'France', '345676543456', '2024-06-16 14:07:17'),
(3, 'p3NwB0snodPl8Xu', 'Wolverhampton', 'London', 'UK', '53300', 'England', '834756784347', '2024-06-17 14:51:10'),
(4, 'OWhfln2VgGxzM3s', 'Malley', 'Lisbon', 'Lisbon', '39433', 'Portugal', '7656767676756', '2024-06-17 18:29:09'),
(5, 'eF4GdYyq2S5EujM', 'example', 'example', 'example', 'example', 'example', 'example', '2024-06-17 18:51:35'),
(6, '2brGo9S0fEJXu7y', 'Birmingham', 'Birmingham', '-', '38454', 'England', '123456789987', '2024-06-19 20:04:29');

-- --------------------------------------------------------

--
-- Table structure for table `parcels`
--

CREATE TABLE `parcels` (
  `id` int(30) NOT NULL,
  `reference_number` varchar(100) NOT NULL,
  `sender_name` text NOT NULL,
  `sender_address` text NOT NULL,
  `sender_contact` text NOT NULL,
  `recipient_name` text NOT NULL,
  `recipient_address` text NOT NULL,
  `recipient_contact` text NOT NULL,
  `type` int(1) NOT NULL COMMENT '1 = Deliver, 2=Pickup',
  `from_branch_id` varchar(30) NOT NULL,
  `to_branch_id` varchar(30) NOT NULL,
  `weight` varchar(100) NOT NULL,
  `height` varchar(100) NOT NULL,
  `width` varchar(100) NOT NULL,
  `length` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `status` int(2) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parcels`
--

INSERT INTO `parcels` (`id`, `reference_number`, `sender_name`, `sender_address`, `sender_contact`, `recipient_name`, `recipient_address`, `recipient_contact`, `type`, `from_branch_id`, `to_branch_id`, `weight`, `height`, `width`, `length`, `price`, `status`, `date_created`) VALUES
(1, '831790067400', 'Sample 1', 'Example 1', '928374839', 'Sample 2', 'Example 2', '2938478394', 1, '2', '', '20', '20', '20', '20', 2000, 9, '2024-06-16 15:49:46'),
(2, '146505821447', 'Kevin Raj Karki', 'Nepal, Kathmandu', '928374839', 'Anushna Chaulagain', 'Baluwatar', '2938478394', 2, '2', '1', '30', '40', '30', '10', 20000, 3, '2024-06-16 16:13:04'),
(3, '504830625482', 'Kevin Raj Karki', 'Nepal, Kathmandu', '928374839', 'Anushna Chaulagain', 'Baluwatar', '2938478394', 2, '2', '1', '10', '20', '20', '20', 15000, 4, '2024-06-16 16:13:04'),
(4, '038787009505', 'Example2', 'Example2', 'Example2', 'Example2', 'Example2', 'Example2', 2, '2', '4', '20', '20', '20', '20', 20000, 8, '2024-06-17 19:19:29'),
(5, '309783575128', 'Example3', 'Example3', '12345', 'Example3.1', 'Example3.1', '09876', 2, '3', '4', '10', '20', '40', '30', 5000, 2, '2024-06-18 14:25:45'),
(6, '335299346955', 'EXAMPLE5', 'EXAMPLE5', 'EXAMPLE5', 'EXAMPLE5', 'EXAMPLE5', 'EXAMPLE5`', 2, '3', '1', '40', '30', '30', '30', 70000, 2, '2024-06-19 21:25:45'),
(7, '364740672992', 'EXAMPLE5', 'EXAMPLE5', 'EXAMPLE5', 'EXAMPLE5', 'EXAMPLE5', 'EXAMPLE5`', 2, '3', '1', '50', '50', '50', '50', 50000, 1, '2024-06-19 21:25:45');

-- --------------------------------------------------------

--
-- Table structure for table `parcel_tracks`
--

CREATE TABLE `parcel_tracks` (
  `id` int(30) NOT NULL,
  `parcel_id` int(30) NOT NULL,
  `status` int(2) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parcel_tracks`
--

INSERT INTO `parcel_tracks` (`id`, `parcel_id`, `status`, `date_created`) VALUES
(1, 1, 1, '2024-06-02 23:13:55'),
(2, 1, 8, '2024-06-02 23:14:26');

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `name`, `email`, `contact`, `address`) VALUES
(1, 'Courier Management System', 'kevinrajkarki97@gmail.com', '9818546347', 'Jorpati, Kathmandu, Bagmati Province, 44600');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1 = admin, 2 = staff',
  `branch_id` int(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `type`, `branch_id`, `date_created`) VALUES
(1, 'Kevin', 'Admin', 'kevin.karki@mail.bcu.ac.uk', 'd2e7a2105d0fb461fe6f2858cc33942f', 1, 0, '2024-05-01 10:57:04'),
(2, 'Staff', '1', 'staff1@gmail.com', 'e909cfcd6b7bf9d92cff781472e503c4', 2, 1, '2024-06-16 14:08:16'),
(3, 'Staff', '3', 'staff3@gmail.com', 'e909cfcd6b7bf9d92cff781472e503c4', 2, 2, '2024-06-16 15:46:04'),
(4, 'Staff', '2', 'staff2@gmail.com', 'e909cfcd6b7bf9d92cff781472e503c4', 2, 3, '2024-06-17 18:49:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parcels`
--
ALTER TABLE `parcels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parcel_tracks`
--
ALTER TABLE `parcel_tracks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
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
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `parcels`
--
ALTER TABLE `parcels`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `parcel_tracks`
--
ALTER TABLE `parcel_tracks`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
