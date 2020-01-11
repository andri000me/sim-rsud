-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2020 at 04:11 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `has`
--
CREATE DATABASE IF NOT EXISTS `has` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `has`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `Username` char(128) NOT NULL,
  `Password` char(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `Username`, `Password`) VALUES
(1, 'admin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `app_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `doc_id` int(10) NOT NULL,
  `hos_id` int(10) NOT NULL,
  `patient_name` varchar(30) NOT NULL,
  `patient_age` int(3) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `date` varchar(20) NOT NULL,
  `time_slot` varchar(20) NOT NULL,
  `slot_no` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`app_id`, `user_id`, `doc_id`, `hos_id`, `patient_name`, `patient_age`, `gender`, `date`, `time_slot`, `slot_no`) VALUES
(2147483647, 3, 1, 1, 'Candra', 20, 'Pria', '06-11-2018', '10:00 am-10:20 am', 1);

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `doc_id` int(6) NOT NULL,
  `hos_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(40) NOT NULL,
  `dob` varchar(15) NOT NULL,
  `qualification` varchar(60) NOT NULL,
  `experience` int(5) NOT NULL,
  `image` varchar(40) NOT NULL,
  `specialization` varchar(40) NOT NULL,
  `languages` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doc_id`, `hos_id`, `name`, `gender`, `email`, `dob`, `qualification`, `experience`, `image`, `specialization`, `languages`) VALUES
(1, 1, 'Johan Prakoso', 'Pria', 'johan@rsud.com', '', 'Trauma', 8, '', 'Ortho', 'Indonesia, English'),
(2, 1, 'Saira Jihan', 'Wanita', 'jihan@rsud.com', '23-02-1992', 'Bedah', 3, '', 'Bedah Dalam', 'Indonesia, English');

-- --------------------------------------------------------

--
-- Table structure for table `hospital`
--

CREATE TABLE `hospital` (
  `hos_id` int(11) NOT NULL,
  `hos_name` varchar(40) NOT NULL,
  `hos_city` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hospital`
--

INSERT INTO `hospital` (`hos_id`, `hos_name`, `hos_city`) VALUES
(1, 'RSUD', 'Sleman');

-- --------------------------------------------------------

--
-- Table structure for table `registered`
--

CREATE TABLE `registered` (
  `user_id` int(6) NOT NULL,
  `name` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `dob` varchar(15) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `gender` varchar(10) DEFAULT '-Pilih-',
  `city` varchar(30) DEFAULT NULL,
  `image` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registered`
--

INSERT INTO `registered` (`user_id`, `name`, `email`, `password`, `dob`, `mobile`, `gender`, `city`, `image`) VALUES
(3, 'Candra Aditama', 'test@test.com', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', '2018-11-01', '', 'Pria', 'Yogya', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`app_id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `hospital`
--
ALTER TABLE `hospital`
  ADD PRIMARY KEY (`hos_id`);

--
-- Indexes for table `registered`
--
ALTER TABLE `registered`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `app_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483647;
--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `doc_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `hospital`
--
ALTER TABLE `hospital`
  MODIFY `hos_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `registered`
--
ALTER TABLE `registered`
  MODIFY `user_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
