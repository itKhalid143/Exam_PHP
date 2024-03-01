-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2024 at 03:10 PM
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
-- Database: `monblog`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_auteur`
--

CREATE TABLE `t_auteur` (
  `auteur_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_auteur`
--

INSERT INTO `t_auteur` (`auteur_id`, `username`, `password`) VALUES
(1, 'user1', 'password1'),
(2, 'user2', 'password2'),
(3, 'user3', 'password3');

-- --------------------------------------------------------

--
-- Table structure for table `t_billet`
--

CREATE TABLE `t_billet` (
  `BIL_ID` int(11) NOT NULL,
  `BIL_DATE` datetime NOT NULL,
  `BIL_TITRE` varchar(255) NOT NULL,
  `BIL_CONTENU` text NOT NULL,
  `BIL_AUTEUR` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_billet`
--

INSERT INTO `t_billet` (`BIL_ID`, `BIL_DATE`, `BIL_TITRE`, `BIL_CONTENU`, `BIL_AUTEUR`) VALUES
(1, '2024-02-24 08:00:00', 'First Blog Post', 'This is the content of the first blog post.', 'user1'),
(2, '2024-02-25 10:00:00', 'Second Blog Post', 'This is the content of the second blog post.', 'user2'),
(3, '2024-02-26 12:00:00', 'Third Blog Post', 'This is the content of the third blog post.', 'user3'),
(13, '2024-02-28 10:48:39', 'Khalid\'s Blog', 'Welcome to Khalid\'s Blog, Thank you for checking!', 'user1'),
(14, '2024-02-28 10:49:00', 'Khalid\'s Post', 'Welcome', 'user1');

-- --------------------------------------------------------

--
-- Table structure for table `t_commentaire`
--

CREATE TABLE `t_commentaire` (
  `COM_ID` int(11) NOT NULL,
  `COM_DATE` datetime NOT NULL,
  `COM_AUTEUR` varchar(255) NOT NULL,
  `COM_CONTENU` text NOT NULL,
  `BIL_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_auteur`
--
ALTER TABLE `t_auteur`
  ADD PRIMARY KEY (`auteur_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `t_billet`
--
ALTER TABLE `t_billet`
  ADD PRIMARY KEY (`BIL_ID`),
  ADD KEY `BIL_AUTEUR` (`BIL_AUTEUR`);

--
-- Indexes for table `t_commentaire`
--
ALTER TABLE `t_commentaire`
  ADD PRIMARY KEY (`COM_ID`),
  ADD KEY `COM_AUTEUR` (`COM_AUTEUR`),
  ADD KEY `BIL_ID` (`BIL_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_auteur`
--
ALTER TABLE `t_auteur`
  MODIFY `auteur_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t_billet`
--
ALTER TABLE `t_billet`
  MODIFY `BIL_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `t_commentaire`
--
ALTER TABLE `t_commentaire`
  MODIFY `COM_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `t_billet`
--
ALTER TABLE `t_billet`
  ADD CONSTRAINT `t_billet_ibfk_1` FOREIGN KEY (`BIL_AUTEUR`) REFERENCES `t_auteur` (`username`) ON DELETE CASCADE;

--
-- Constraints for table `t_commentaire`
--
ALTER TABLE `t_commentaire`
  ADD CONSTRAINT `t_commentaire_ibfk_1` FOREIGN KEY (`COM_AUTEUR`) REFERENCES `t_auteur` (`username`) ON DELETE CASCADE,
  ADD CONSTRAINT `t_commentaire_ibfk_2` FOREIGN KEY (`BIL_ID`) REFERENCES `t_billet` (`BIL_ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
