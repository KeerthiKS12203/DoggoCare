-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2024 at 12:59 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `output`
--

-- --------------------------------------------------------

--
-- Table structure for table `veternary_care`
--

CREATE TABLE `veternary_care` (
  `vid` int(11) NOT NULL,
  `pet_id` int(11) NOT NULL,
  `hospital_name` varchar(60) DEFAULT NULL,
  `consulted_doctor` varchar(60) DEFAULT NULL,
  `issue` varchar(100) NOT NULL,
  `fee` int(11) DEFAULT NULL,
  `v_date` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `veternary_care`
--

INSERT INTO `veternary_care` (`vid`, `pet_id`, `hospital_name`, `consulted_doctor`, `issue`, `fee`, `v_date`) VALUES
(1, 1, 'Yogananda Pet Care', 'Dr. Hemanth', 'Minor Wound', 300, '2024-05-11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `veternary_care`
--
ALTER TABLE `veternary_care`
  ADD PRIMARY KEY (`vid`),
  ADD KEY `pet_id` (`pet_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `veternary_care`
--
ALTER TABLE `veternary_care`
  MODIFY `vid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `veternary_care`
--
ALTER TABLE `veternary_care`
  ADD CONSTRAINT `veternary_care_ibfk_1` FOREIGN KEY (`pet_id`) REFERENCES `pet` (`pet_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
