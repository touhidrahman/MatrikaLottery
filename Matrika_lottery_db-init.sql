-- phpMyAdmin SQL Dump
-- version 4.0.5
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306

-- Generation Time: Nov 26, 2013 at 04:23 PM
-- Server version: 5.5.33
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lottery_sd`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicants_bn`
--

CREATE TABLE `applicants_bn` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(63) NOT NULL,
  `father` varchar(63) NOT NULL,
  `mother` varchar(63) NOT NULL,
  `bd` date NOT NULL,
  `roll` int(5) NOT NULL,
  `pic` varchar(128) NOT NULL,
  `marked` tinyint(1) NOT NULL DEFAULT '0',
  `add_dt` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roll` (`roll`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `applicants_en`
--

CREATE TABLE `applicants_en` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(63) NOT NULL,
  `father` varchar(63) NOT NULL,
  `mother` varchar(63) NOT NULL,
  `bd` date NOT NULL,
  `roll` int(5) NOT NULL,
  `pic` varchar(128) NOT NULL,
  `marked` tinyint(1) NOT NULL DEFAULT '0',
  `add_dt` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roll` (`roll`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `result_bn`
--

CREATE TABLE `result_bn` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roll` int(5) NOT NULL,
  `name` varchar(64) NOT NULL,
  `father` varchar(64) NOT NULL,
  `mother` varchar(64) NOT NULL,
  `timestamp` datetime NOT NULL,
  `queue` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `result_en`
--

CREATE TABLE `result_en` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `roll` int(5) NOT NULL,
  `name` varchar(64) NOT NULL,
  `father` varchar(64) NOT NULL,
  `mother` varchar(64) NOT NULL,
  `timestamp` datetime NOT NULL,
  `queue` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `vacancy`
--

CREATE TABLE `vacancy` (
  `vacancy_bn` int(4) NOT NULL,
  `vacancy_bn_sby` int(4) NOT NULL,
  `vacancy_en` int(4) NOT NULL,
  `vacancy_en_sby` int(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
