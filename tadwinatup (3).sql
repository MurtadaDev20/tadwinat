-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2023 at 12:56 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tadwinatup`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'murtadait20@gmail.com', '$2y$10$wrC/9pmnUi/QgBP3Mgg.P.82vZSO/UguK4ZKdeO2kcBth492HXpc2');

-- --------------------------------------------------------

--
-- Table structure for table `catigories`
--

CREATE TABLE `catigories` (
  `id` int(11) NOT NULL,
  `catigoryName` varchar(100) NOT NULL,
  `catigoryDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `catigories`
--

INSERT INTO `catigories` (`id`, `catigoryName`, `catigoryDate`) VALUES
(266, 'php', '2022-06-25 23:41:50'),
(270, 'ويب', '2022-07-01 13:39:42'),
(271, 'HTML', '2022-07-01 13:39:49'),
(272, 'بلوجر', '2022-07-09 18:01:26');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `postTitle` varchar(200) NOT NULL,
  `postCat` varchar(100) NOT NULL,
  `postImage` varchar(200) NOT NULL,
  `postContent` varchar(10000) NOT NULL,
  `postDate` datetime NOT NULL DEFAULT current_timestamp(),
  `postAuthor` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `postTitle`, `postCat`, `postImage`, `postContent`, `postDate`, `postAuthor`) VALUES
(134, 'المقال الاول', '266', 'download.png', 'd', '2022-06-29 00:18:06', 'مرتضى لقمان'),
(135, 'الصحة العالمية: تفشي كورونا يزداد سوءاً في كوريا الشمالية', '266', 'tt.jpg', 'قق', '2022-06-29 00:27:04', 'مرتضى لقمان'),
(136, 'المقال الثاني', '270', 'aa.jpg', 'rrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr', '2022-07-23 18:36:20', 'مرتضى لقمان');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `catigories`
--
ALTER TABLE `catigories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `catigoryName` (`catigoryName`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `catigories`
--
ALTER TABLE `catigories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=273;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
