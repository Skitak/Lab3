-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 01, 2018 at 07:19 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ZendLab`
--

-- --------------------------------------------------------

--
-- Table structure for table `MetaData`
--

CREATE TABLE `MetaData` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valeur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Privilege`
--

CREATE TABLE `Privilege` (
  `id` int(11) NOT NULL,
  `valeur` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Product`
--

CREATE TABLE `Product` (
  `id` int(11) NOT NULL,
  `nom` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Product`
--

INSERT INTO `Product` (`id`, `nom`, `description`, `prix`) VALUES
(3, 'dgdfg', 'shfgh', 12),
(6, 'fgbdbdfgb', 'sbgdbs', 12),
(7, 'Produit 0', 'Description produit 0', 1235),
(8, 'Produit 1', 'Description produit 1', 1235),
(9, 'Produit 2', 'Description produit 2', 1235),
(10, 'Produit 3', 'Description produit 3', 1235),
(11, 'Produit 4', 'Description produit 4', 1235),
(12, 'Produit 5', 'Description produit 5', 1235),
(13, 'Produit 6', 'Description produit 6', 1235),
(14, 'Produit 7', 'Description produit 7', 1235),
(15, 'Produit 8', 'Description produit 8', 1235),
(16, 'Produit 9', 'Description produit 9', 1235),
(17, 'Produit 10', 'Description produit 10', 1235),
(18, 'Produit 11', 'Description produit 11', 1235),
(19, 'Produit 12', 'Description produit 12', 1235),
(20, 'Produit 13', 'Description produit 13', 1235),
(21, 'Produit 14', 'Description produit 14', 1235),
(22, 'Produit 15', 'Description produit 15', 1235),
(23, 'Produit 16', 'Description produit 16', 1235),
(24, 'Produit 17', 'Description produit 17', 1235),
(25, 'Produit 18', 'Description produit 18', 1235),
(26, 'Produit 19', 'Description produit 19', 1235),
(27, 'Produit 20', 'Description produit 20', 1235),
(28, 'Produit 21', 'Description produit 21', 1235),
(29, 'Produit 22', 'Description produit 22', 1235),
(30, 'Produit 23', 'Description produit 23', 1235),
(31, 'Produit 24', 'Description produit 24', 1235),
(32, 'Produit 25', 'Description produit 25', 1235),
(33, 'Produit 26', 'Description produit 26', 1235),
(34, 'Produit 27', 'Description produit 27', 1235),
(35, 'Produit 28', 'Description produit 28', 1235),
(36, 'Produit 29', 'Description produit 29', 1235),
(37, 'Produit 30', 'Description produit 30', 1235),
(38, 'Produit 31', 'Description produit 31', 1235),
(39, 'Produit 32', 'Description produit 32', 1235),
(40, 'Produit 33', 'Description produit 33', 1235),
(41, 'Produit 34', 'Description produit 34', 1235),
(42, 'Produit 35', 'Description produit 35', 1235),
(43, 'Produit 36', 'Description produit 36', 1235),
(44, 'Produit 37', 'Description produit 37', 1235),
(45, 'Produit 38', 'Description produit 38', 1235),
(46, 'Produit 39', 'Description produit 39', 1235),
(47, 'Produit 40', 'Description produit 40', 1235),
(48, 'Produit 41', 'Description produit 41', 1235),
(49, 'Produit 42', 'Description produit 42', 1235),
(50, 'Produit 43', 'Description produit 43', 1235),
(51, 'Produit 44', 'Description produit 44', 1235),
(52, 'Produit 45', 'Description produit 45', 1235),
(53, 'Produit 46', 'Description produit 46', 1235),
(54, 'Produit 47', 'Description produit 47', 1235),
(55, 'Produit 48', 'Description produit 48', 1235),
(56, 'Produit 49', 'Description produit 49', 1235),
(57, 'Produit 50', 'Description produit 50', 1235),
(58, 'Produit 51', 'Description produit 51', 1235),
(59, 'Produit 52', 'Description produit 52', 1235),
(60, 'Produit 53', 'Description produit 53', 1235),
(61, 'Produit 54', 'Description produit 54', 1235),
(62, 'Produit 55', 'Description produit 55', 1235),
(63, 'Produit 56', 'Description produit 56', 1235),
(64, 'Produit 57', 'Description produit 57', 1235),
(65, 'Produit 58', 'Description produit 58', 1235),
(66, 'Produit 59', 'Description produit 59', 1235),
(67, 'Produit 60', 'Description produit 60', 1235),
(68, 'Produit 61', 'Description produit 61', 1235),
(69, 'Produit 62', 'Description produit 62', 1235),
(70, 'Produit 63', 'Description produit 63', 1235),
(71, 'Produit 64', 'Description produit 64', 1235),
(72, 'Produit 65', 'Description produit 65', 1235),
(73, 'Produit 66', 'Description produit 66', 1235),
(74, 'Produit 67', 'Description produit 67', 1235),
(75, 'Produit 68', 'Description produit 68', 1235),
(76, 'Produit 69', 'Description produit 69', 1235),
(77, 'Produit 70', 'Description produit 70', 1235),
(78, 'Produit 71', 'Description produit 71', 1235),
(79, 'Produit 72', 'Description produit 72', 1235),
(80, 'Produit 73', 'Description produit 73', 1235),
(81, 'Produit 74', 'Description produit 74', 1235),
(82, 'Produit 75', 'Description produit 75', 1235),
(83, 'Produit 76', 'Description produit 76', 1235),
(84, 'Produit 77', 'Description produit 77', 1235),
(85, 'Produit 78', 'Description produit 78', 1235),
(86, 'Produit 79', 'Description produit 79', 1235),
(87, 'Produit 80', 'Description produit 80', 1235),
(88, 'Produit 81', 'Description produit 81', 1235),
(89, 'Produit 82', 'Description produit 82', 1235),
(90, 'Produit 83', 'Description produit 83', 1235),
(91, 'Produit 84', 'Description produit 84', 1235),
(92, 'Produit 85', 'Description produit 85', 1235),
(93, 'Produit 86', 'Description produit 86', 1235),
(94, 'Produit 87', 'Description produit 87', 1235),
(95, 'Produit 88', 'Description produit 88', 1235),
(96, 'Produit 89', 'Description produit 89', 1235),
(97, 'Produit 90', 'Description produit 90', 1235),
(98, 'Produit 91', 'Description produit 91', 1235),
(99, 'Produit 92', 'Description produit 92', 1235),
(100, 'Produit 93', 'Description produit 93', 1235),
(101, 'Produit 94', 'Description produit 94', 1235),
(102, 'Produit 95', 'Description produit 95', 1235),
(103, 'Produit 96', 'Description produit 96', 1235),
(104, 'Produit 97', 'Description produit 97', 1235),
(105, 'Produit 98', 'Description produit 98', 1235),
(106, 'Produit 99', 'Description produit 99', 1235);

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`username`, `email`, `password`, `salt`) VALUES
('admin', 'admin', 'ac9689e2272427085e35b9d3e3e8bed88cb3434828b43b86fc0596cad4c6e270', 1234);

-- --------------------------------------------------------

--
-- Table structure for table `UserPrivilege`
--

CREATE TABLE `UserPrivilege` (
  `idUser` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idPrivilege` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `MetaData`
--
ALTER TABLE `MetaData`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Privilege`
--
ALTER TABLE `Privilege`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Product`
--
ALTER TABLE `Product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `UserPrivilege`
--
ALTER TABLE `UserPrivilege`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `MetaData`
--
ALTER TABLE `MetaData`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Product`
--
ALTER TABLE `Product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
