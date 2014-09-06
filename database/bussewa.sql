-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 06, 2014 at 11:23 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bussewa`
--
CREATE DATABASE IF NOT EXISTS `bussewa` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bussewa`;

-- --------------------------------------------------------

--
-- Table structure for table `bus_info`
--

CREATE TABLE IF NOT EXISTS `bus_info` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `bus_name` varchar(100) NOT NULL,
  `bus_number` varchar(25) NOT NULL,
  `from` varchar(100) NOT NULL,
  `from_time` varchar(15) NOT NULL,
  `to` varchar(100) NOT NULL,
  `to_time` varchar(15) DEFAULT NULL,
  `route` varchar(200) DEFAULT NULL,
  `total_seats` varchar(100) NOT NULL,
  `bus_type` varchar(50) DEFAULT NULL,
  `image` varchar(250) DEFAULT NULL,
  `user_id` varchar(100) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `bus_info`
--

INSERT INTO `bus_info` (`Id`, `bus_name`, `bus_number`, `from`, `from_time`, `to`, `to_time`, `route`, `total_seats`, `bus_type`, `image`, `user_id`) VALUES
(1, 'fkcjgkhjk', 'fdkjhgjkd', 'jsdhgjkh', '5.00 am', 'hjkshdjkgh', '5.00 am', 'hbjkfdhgkj', '33', 'Deluxe', 'C360_2014-08-04-08-29-20-0141.jpg', '1');

-- --------------------------------------------------------

--
-- Table structure for table `reservation_info`
--

CREATE TABLE IF NOT EXISTS `reservation_info` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `bus_id` varchar(15) DEFAULT NULL,
  `no_of_seats` varchar(10) DEFAULT NULL,
  `seats_numbers` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `reservation_info`
--

INSERT INTO `reservation_info` (`Id`, `bus_id`, `no_of_seats`, `seats_numbers`) VALUES
(3, '1', NULL, 'B6,B5,B7,B8,'),
(4, '1', NULL, 'B6,B5,B8,B7,');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE IF NOT EXISTS `user_info` (
  `Id` int(3) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `user_auth_key` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`Id`, `user_name`, `full_name`, `email`, `password`, `user_auth_key`) VALUES
(1, 'homnath', 'jkdshgjkv', 'bhomnath@salyani.com.np', '9fe3ef0f7bab8b8f9c60056e680cd727', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
