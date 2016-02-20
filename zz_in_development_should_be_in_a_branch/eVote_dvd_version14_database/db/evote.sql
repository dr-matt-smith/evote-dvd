-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Feb 18, 2016 at 12:53 PM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `evote`
--

-- --------------------------------------------------------

--
-- Table structure for table `dvd`
--

CREATE TABLE `dvds` (
  `id` int(11) NOT NULL,
  `title` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `voteAverage` decimal(10,0) NOT NULL,
  `numVotes` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dvd`
--

INSERT INTO `dvds` (`id`, `title`, `category`, `price`, `voteAverage`, `numVotes`) VALUES
(1, 'Jaws', 'thriller', 10.00, 5, 1),
(2, 'Jaws II', 'thriller', 5.99, 90, 77),
(3, 'Shrek', 'comedy', 10.00, 50, 5),
(4, 'Shrek II', 'comedy', 4.99, 0, 0),
(5, 'Alien', 'scifi', 19.00, 95, 201);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dvd`
--
ALTER TABLE `dvds`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dvd`
--
ALTER TABLE `dvds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;