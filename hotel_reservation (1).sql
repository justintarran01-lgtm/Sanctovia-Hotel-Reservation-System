-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2026 at 08:47 AM
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
-- Database: `hotel_reservation`
--

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `reservation_id` int(11) NOT NULL,
  `reservation_it` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `check_in` date DEFAULT NULL,
  `Check_out` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`reservation_id`, `reservation_it`, `user_id`, `room_id`, `check_in`, `Check_out`, `address`, `contact_number`) VALUES
(0, 1, 1, 2, '2026-11-10', '2026-11-12', NULL, NULL),
(0, 2, 1, 4, '2026-10-31', '2026-11-28', NULL, NULL),
(0, 3, 1, 3, '2026-09-19', '2026-05-31', NULL, NULL),
(0, 5, 1, 2, '2027-10-03', '0000-00-00', 'mandurirrio hibao am', '09974245325'),
(0, 6, 1, 2, '2027-10-03', '2027-10-21', 'Cebu City', '09974245325'),
(0, 9, 3, 4, '0000-00-00', '0000-00-00', 'manila', '2323232'),
(0, 11, 3, 4, '2027-10-03', '2027-10-05', 'Manila', '2323232'),
(0, 18, 11, 1, '2026-10-25', '2026-10-26', 'ph', '4242342342340'),
(0, 19, 8, 5, '2026-10-25', '2026-10-26', 'balaynimama', '743747385943');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` int(11) NOT NULL,
  `room_name` varchar(100) DEFAULT NULL,
  `price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `room_name`, `price`) VALUES
(1, 'single room', 1000),
(2, 'Double room', 1300),
(3, 'Deluxe room', 1500),
(4, 'Family room', 2500),
(5, 'Excutive Suite', 3500),
(6, 'HoneyMoon Suite', 4000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'customer',
  `address` varchar(500) DEFAULT NULL,
  `contact_number` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `email`, `password`, `role`, `address`, `contact_number`) VALUES
(1, 'justin', 'mdew1123@gmail.com', 'haha', 'customer', NULL, NULL),
(3, 'Ding', 'ding@example.com', 'practice123', 'customer', 'mandurrion,', '232323232'),
(4, 'Maria', 'maria@example.com', 'practice123', 'customer', NULL, NULL),
(5, 'justin tarran', 'mdew60135@gmail.com', '$2y$10$s46EWh99OM8er/oI5qekdOsXNYxF3ZDptpqjiBBlturmssVtHtbmK', '', NULL, NULL),
(6, 'heeeee', 'tngina.thaha.ui@phinmaed.com', '$2y$10$yFCiwACr0pAQolUoi2XanO4dSVVVvL.BhVJm7JJNggCp/Yk.TmUbq', 'customer', NULL, NULL),
(7, 'daniel', 'meme.tarran.ui@phinmaed.com', '$2y$10$t780FV2j.65Pd4dyPXDWdOUuP9wH5mYtK1RqRFoCKm9B3HBCDJYca', 'customer', NULL, NULL),
(8, 'justin', 'jugo.tarran1.ui@phinmaed.com', '$2y$10$IHp61oqgqcUPn5vHiDLHZ.t4bPl/PwYRRgldHTMG2xOHtrPZhXZIe', 'customer', NULL, NULL),
(9, 'JUSTIN GOLEZ TARRAN', 'jugo.tarran2.ui@phinmaed.com', '$2y$10$vW8lfVI6i8dqkNkkjlHYMuJ2ITqKfW84hSoOKYn.6bEUd43GtJ18i', 'customer', NULL, NULL),
(10, 'JUSTIN GOLEZ TARRAN', 'jugo.tarran3.ui@phinmaed.com', '$2y$10$G.JQdVffcV6bE5VxSkyRv.kJ.y8S8YwY/X.fKKBE/HwbM7qDHdeVi', 'customer', NULL, NULL),
(11, 'JUSTIN GOLEZ TARRAN', 'jugo.tarran4.ui@phinmaed.com', '$2y$10$ZmhOAlWFPda2sFBeF2CrwODauBQibngNvLghwxRz6cTplW2qlBExm', 'customer', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reservation_it`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reservation_it` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
