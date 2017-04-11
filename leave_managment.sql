-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2015 at 06:20 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `leave_managment`
--
CREATE DATABASE IF NOT EXISTS `leave_managment` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `leave_managment`;

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE IF NOT EXISTS `admin_login` (
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `leavel` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`username`, `password`, `leavel`) VALUES
('admin123', 'root', ''),
('admin123', 'root', ''),
('admin123', 'root', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `emp_info`
--

CREATE TABLE IF NOT EXISTS `emp_info` (
  `emp_id` varchar(200) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `doj` varchar(200) NOT NULL,
  `desig` varchar(200) NOT NULL,
  `department` varchar(200) NOT NULL,
  `role` varchar(50) NOT NULL,
  `cl` int(200) NOT NULL,
  `scl` int(200) NOT NULL,
  `el` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_info`
--

INSERT INTO `emp_info` (`emp_id`, `first_name`, `last_name`, `username`, `password`, `doj`, `desig`, `department`, `role`, `cl`, `scl`, `el`) VALUES
('admin01', '', '', 'admin', 'admin123', '', '', '', 'admin', 15, 60, 15),
('princepal001', 'Dananjay', 'B', 'principal', 'principal123', '3/4/2015', 'principal', 'VVFGC', 'principal', 15, 80, 15),
('registrar01', '', '', 'registerar', 'registerar', '', '', '', 'registerar', 15, 60, 15),
('vvier00', 'Hemanth Kumar', 'B N', 'Hod', 'root', '23/04/1998', 'Hod', 'BCA/MCA', 'hod', 15, 80, 15),
('vviet006', 'Dananjay', 'B', 'principal', 'principal123', '3/4/2015', 'principal', 'VVFGC', 'principal', 15, 80, 15),
('vviet01', 'kiran', 'j', 'kiran', 'kiran', '3/4/2015', 'pro', 'BCA', 'user', 15, 85, 15),
('vviet02', 'Sandeep', 'N K ', 'sandeep', 'sandeep', '4/4/2014', 'pro', 'BCA', 'user', 15, 90, 15),
('vviet03', 'Poornima', 'Shankar', 'poornima', 'poornima', '5/5/2014', 'pro', 'BCA', 'user', 15, 90, 15),
('vviet05', 'apoorva', 'james', 'apoorva', 'james', '3/4/2015', 'pro', 'MCA', 'user', 15, 80, 15),
('vviet10', 'sathvik', 'narasimha', 'sathvik', 'df415e38aaa8f37782d490aadb96cf17', '23/04/2015', 'pro', 'BCA', 'user', 15, 90, 15);

-- --------------------------------------------------------

--
-- Table structure for table `hod_login`
--

CREATE TABLE IF NOT EXISTS `hod_login` (
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hod_login`
--

INSERT INTO `hod_login` (`username`, `password`) VALUES
('hod123', 'root');

-- --------------------------------------------------------

--
-- Table structure for table `leave_login`
--

CREATE TABLE IF NOT EXISTS `leave_login` (
  `empid` varchar(100) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `desig` varchar(200) NOT NULL,
  `role` varchar(220) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leave_login`
--

INSERT INTO `leave_login` (`empid`, `username`, `password`, `first_name`, `last_name`, `email`, `desig`, `role`) VALUES
('vviet01', 'sathvik', 'great', 'sathvik', 'narasimha', 'sathvik@gmail.com', 'pro', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `leave_page`
--

CREATE TABLE IF NOT EXISTS `leave_page` (
`Leave_id` int(11) NOT NULL,
  `empid` varchar(200) NOT NULL,
  `empname` varchar(200) NOT NULL,
  `desig` varchar(200) NOT NULL,
  `department` varchar(200) NOT NULL,
  `rcl` varchar(200) NOT NULL,
  `rscl` varchar(200) NOT NULL,
  `rel` varchar(200) NOT NULL,
  `leave_type` varchar(200) NOT NULL,
  `from_date` varchar(200) NOT NULL,
  `to_date` varchar(200) NOT NULL,
  `app_date` varchar(200) NOT NULL,
  `no_days` varchar(200) NOT NULL,
  `reason` varchar(200) NOT NULL,
  `leave_status` varchar(200) NOT NULL,
  `Approved_principal` varchar(30) NOT NULL DEFAULT 'pending',
  `Approved_registerar` varchar(30) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leave_page`
--

INSERT INTO `leave_page` (`Leave_id`, `empid`, `empname`, `desig`, `department`, `rcl`, `rscl`, `rel`, `leave_type`, `from_date`, `to_date`, `app_date`, `no_days`, `reason`, `leave_status`, `Approved_principal`, `Approved_registerar`) VALUES
(1, 'vviet01', 'kiran', 'pro', 'BCA', '15', '30', '15', 'cl', '2015-03-10', '2015-03-12', '2015-03-09', '2', 'hassan', 'apporved', 'Decline', 'Approve'),
(2, 'vviet02', 'Sandeep', 'pro', 'BCA', '15', '30', '15', 'el', '2015-03-10', '2015-03-12', '2015-03-09', '2', 'banglore', 'apporved', 'Decline', 'Approve'),
(3, 'vviet03', 'Poornima', 'pro', 'BCA', '15', '30', '15', 'el', '2015-03-10', '2015-03-12', '2015-03-09', '2', 'mandya', 'apporved', 'Decline', 'Approve'),
(4, 'vviet01', 'kiran', 'pro', 'BCA', '15', '30', '15', 'scl', '2015-03-10', '2015-03-12', '2015-03-09', '2', 'hassan', 'apporved', 'Decline', 'Decline'),
(5, 'vviet01', 'kiran', 'pro', 'BCA', '15', '30', '15', 'scl', '2015-03-10', '2015-03-12', '2015-03-09', '2', 'asdjkha', 'apporved', 'Decline', 'Decline'),
(6, 'vviet01', 'kiran', 'pro', 'BCA', '15', '30', '15', 'cl', '2015-03-10', '2015-03-12', '2015-03-09', '2', 'going to banglore', 'apporved', 'Decline', 'Decline'),
(7, 'vviet01', 'kiran', 'pro', 'BCA', '15', '30', '15', 'cl', '10-03-2015', '11-03-2015', '10-03-2015', '1', '''sad''las', 'pending', 'Decline', 'Decline'),
(8, 'vviet01', 'kiran', 'pro', 'BCA', '15', '30', '15', 'cl', '14-03-2015', '15-03-2015', '11-03-2015', '1', 'sad', 'apporved', 'Decline', 'Decline'),
(9, 'vviet01', 'kiran', 'pro', 'BCA', '15', '30', '15', 'cl', '17-03-2015', '24-03-2015', '15-03-2015', '7', 'hahahah', 'pending', 'Decline', 'Decline'),
(10, 'vviet01', 'kiran', 'pro', 'BCA', '15', '30', '15', 'cl', '19-03-2015', '23-03-2015', '20-03-2015', '4', 'asjdlasjd', 'apporved', 'Decline', 'Approve'),
(11, 'vviet02', 'Sandeep', 'pro', 'BCA', '15', '30', '15', 'cl', '24-03-2015', '25-03-2015', '23-03-2015', '1', 'sadasd', 'apporved', 'pending', 'pending'),
(12, 'vviet01', 'kiran', 'pro', 'BCA', '15', '30', '15', 'cl', '23-03-2015', '24-03-2015', '23-03-2015', '1', 'dasdasd', 'apporved', 'pending', 'pending'),
(13, 'vviet01', 'kiran', 'pro', 'BCA', '15', '30', '15', 'cl', '04-04-2015', '05-04-2015', '04-04-2015', '1', 'sathvik', 'pending', 'pending', 'Approve'),
(14, 'vviet01', 'kiran', 'pro', 'BCA', '15', '30', '15', 'scl', '16-04-2015', '16-04-2015', '15-04-2015', '1', 'hassan', 'apporved', 'pending', 'Approve'),
(15, 'vviet01', 'kiran', 'pro', 'BCA', '15', '30', '15', 'cl', '23-04-2015', '23-04-2015', '23-04-2015', '1', 'going to mysore', 'apporved', 'Approve', 'Approve');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `emp_info`
--
ALTER TABLE `emp_info`
 ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `leave_login`
--
ALTER TABLE `leave_login`
 ADD PRIMARY KEY (`empid`);

--
-- Indexes for table `leave_page`
--
ALTER TABLE `leave_page`
 ADD PRIMARY KEY (`Leave_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `leave_page`
--
ALTER TABLE `leave_page`
MODIFY `Leave_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
