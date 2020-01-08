-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 08, 2020 at 03:18 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lcb`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `categories_id` int(11) DEFAULT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `users_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `categories_id`, `text`, `title`, `users_id`) VALUES
(1, 1, 'q3', 'q3', 1),
(2, 1, 'ovo je clanak 2', 'naslov clanka 2', 1),
(3, 2, 'ovo je clanak 3', 'naslov clanka 3', 1),
(4, 1, 'ovo je clanak 4', 'naslov clanka 4', 3),
(24, 17, 'art11', 'art11', 1),
(25, 17, 'art2', 'art2', 1),
(26, 17, 'art3', 'art3', 1),
(27, 17, 'art4', 'art4', 1),
(33, 17, 'XXX', 'XXX', 2);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `users_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `users_id`) VALUES
(1, 'kategorija 1', 1),
(2, 'kategorija 22', 1),
(17, 'cat1', 1),
(18, 'cat2', 1),
(19, 'cat33', 1),
(22, 'cat4', 3),
(25, 'qqq23', 2);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `articles_id` int(11) DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `articles_id`, `users_id`, `title`, `text`) VALUES
(1, 1, 1, 'qqq11', 'qqq11'),
(4, 3, 3, 'xxx', 'xxx'),
(6, 1, 1, 'qwe', 'qwe'),
(7, 1, 3, 'xxx1', '1xxx'),
(8, 2, 3, 'xxx1234', 'xxx22222'),
(23, 1, 2, 'qwe', 'qwe2');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `plainPassword` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `is_active`, `plainPassword`) VALUES
(1, 'aaa', 'aaa', 'aaa', 0, ''),
(2, 'qqq', '$2y$13$935Dw316/MzRtV34hjr/rOrsA.lpsWc7Bdfp/IWBtk/le4.fEszAO', 'odavicmilan@gmail.com', 0, 'qqq'),
(3, 'qqq2', '$2y$13$KcwS/FzjmmryMf8PW9u8O.pVOBFFWhXL5JsKwOgCxLS0/n7WxvbWu', 'odavicmilan2@gmail.com', 0, 'qqq'),
(4, 'qqq3', '$2y$13$P2H5TEY/tvfj.pWUGaViq.yxQcpWih6S7zg/FB0xgG9JSAZUtoeS.', 'odavicmilan3@gmail.com', 0, 'qqq3'),
(5, 'qqq5', '$2y$13$lsBAniVZdPxqA4WMJdbuR.nBhJe.OdWHnR8E6ctWsHYMnjT6BDEqy', 'odavicmilan@gmail.com5', 0, 'qqq5'),
(6, 'qqq6', '$2y$13$nB9OTB8wMckmgICO99bSDO4VouERsx6IwppyPEqoXlrQCyhnJuChi', 'odavicmilan@gmail.com6', 0, 'qqq6'),
(7, 'x1', '$2y$13$N72hfSwAu8BhpsrRfKHkqeZwuRoVpnUyWSD.IZ7i8yNvsgx8Pn7Ra', 'odavicmilan@gmail.comx1', 0, 'x1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articles_ibfk_1` (`categories_id`),
  ADD KEY `articles_users` (`users_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_users` (`users_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_articles` (`articles_id`),
  ADD KEY `comments_users` (`users_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `FK_BFDD3168A21214B7` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `articles_users` FOREIGN KEY (`users_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_users` FOREIGN KEY (`users_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `FK_5F9E962A1EBAF6CC` FOREIGN KEY (`articles_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_users` FOREIGN KEY (`users_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
