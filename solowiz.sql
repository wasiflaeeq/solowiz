-- phpMyAdmin SQL Dump
-- version 2.10.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Nov 23, 2011 at 04:57 AM
-- Server version: 5.0.45
-- PHP Version: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `solowiz`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `images`
-- 

CREATE TABLE `images` (
  `id` int(4) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `images`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `ippools`
-- 

CREATE TABLE `ippools` (
  `id` int(4) NOT NULL auto_increment,
  `netid` varchar(15) NOT NULL,
  `netmask` varchar(15) NOT NULL,
  `gateway` varchar(15) NOT NULL,
  `dns1` varchar(15) NOT NULL,
  `dns2` varchar(15) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `ippools`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `ips`
-- 

CREATE TABLE `ips` (
  `id` int(4) NOT NULL auto_increment,
  `ip` varchar(15) NOT NULL,
  `poolid` int(4) NOT NULL,
  `vmid` int(4) NOT NULL default '0',
  `primary` tinyint(1) NOT NULL,
  `reserved` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `ips`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `sms_sessions`
-- 

CREATE TABLE `sms_sessions` (
  `id` int(4) NOT NULL auto_increment,
  `uid` int(4) NOT NULL,
  `cellnumber` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

-- 
-- Dumping data for table `sms_sessions`
-- 

INSERT INTO `sms_sessions` (`id`, `uid`, `cellnumber`) VALUES 
(1, 1, ''),
(2, 1, '03028739885'),
(3, 1, '03028739885'),
(4, 1, '03028739885'),
(5, 1, '03028739885'),
(6, 1, '03028739885'),
(7, 1, '03028739885'),
(8, 1, '03028739885'),
(9, 1, '03028739885'),
(10, 1, '03028739885'),
(11, 1, '03028739885'),
(12, 1, '03028739885'),
(13, 1, '03028739885'),
(14, 1, '03028739885'),
(15, 1, '03028739885'),
(16, 1, '03028739885'),
(17, 1, '03028739885'),
(18, 1, '03028739885'),
(19, 1, '03028739885'),
(20, 1, '03028739885'),
(21, 1, '03028739885'),
(22, 1, '03028739885'),
(23, 1, '030287398851'),
(24, 1, '03028739885'),
(25, 1, '03028739885'),
(26, 1, '03028739885'),
(27, 1, '03028739885'),
(28, 1, '030287398851'),
(29, 1, '03028739885'),
(30, 1, '0302339885'),
(31, 1, '03012339885');

-- --------------------------------------------------------

-- 
-- Table structure for table `users`
-- 

CREATE TABLE `users` (
  `id` int(4) NOT NULL auto_increment,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `users`
-- 

INSERT INTO `users` (`id`, `username`, `password`) VALUES 
(1, 'admin', '41457ad4f442e28897abf02a0f20878e'),
(2, 'testing', '41457ad4f442e28897abf02a0f20878e');

-- --------------------------------------------------------

-- 
-- Table structure for table `vm`
-- 

CREATE TABLE `vm` (
  `id` int(3) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `password` varchar(30) NOT NULL,
  `os` varchar(100) NOT NULL,
  `state` varchar(30) NOT NULL,
  `ipaddress` varchar(15) NOT NULL default '0.0.0.0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

-- 
-- Dumping data for table `vm`
-- 

