-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 23, 2020 at 04:26 PM
-- Server version: 10.2.31-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u6566546_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `covid_wilayah`
--

CREATE TABLE `covid_wilayah` (
  `wl_id` int(11) NOT NULL,
  `wl_nama` varchar(100) NOT NULL,
  `wl_terjangkit` int(11) NOT NULL,
  `wl_suspect` int(11) NOT NULL,
  `wl_cured` int(11) NOT NULL,
  `wl_dead` int(11) NOT NULL,
  `wl_updated` datetime NOT NULL,
  `wl_updatetime` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `covid_wilayah`
--

INSERT INTO `covid_wilayah` (`wl_id`, `wl_nama`, `wl_terjangkit`, `wl_suspect`, `wl_cured`, `wl_dead`, `wl_updated`, `wl_updatetime`) VALUES
(1, 'Indonesia', 47896, 0, 19241, 2535, '2020-06-23 16:10:09', '1592903342750');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `covid_wilayah`
--
ALTER TABLE `covid_wilayah`
  ADD PRIMARY KEY (`wl_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `covid_wilayah`
--
ALTER TABLE `covid_wilayah`
  MODIFY `wl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
