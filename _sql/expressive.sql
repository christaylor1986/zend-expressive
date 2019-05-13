-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 12, 2019 at 08:31 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: 'expressive'
--
CREATE DATABASE IF NOT EXISTS 'expressive' DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE 'expressive';

-- --------------------------------------------------------

--
-- Table structure for table 'bookings'
--

DROP TABLE IF EXISTS 'bookings';
CREATE TABLE IF NOT EXISTS 'bookings' (
  'id' int(11) NOT NULL AUTO_INCREMENT,
  'username' varchar(255) NOT NULL,
  'reason' varchar(255) NOT NULL,
  'startdate' datetime NOT NULL,
  'enddate' datetime NOT NULL,
  PRIMARY KEY ('id')
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
