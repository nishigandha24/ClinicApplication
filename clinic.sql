-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2020 at 01:35 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `patientid` int(20) NOT NULL,
  `apptid` int(20) NOT NULL,
  `apptdate` date NOT NULL,
  `operatory` int(5) NOT NULL,
  `provider` int(5) NOT NULL,
  `appttime` time NOT NULL,
  `apptlength` int(5) NOT NULL,
  `amount` int(5) NOT NULL,
  `clinicid` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`patientid`, `apptid`, `apptdate`, `operatory`, `provider`, `appttime`, `apptlength`, `amount`, `clinicid`) VALUES
(1, 1, '2020-08-04', 1, 1, '20:25:01', 30, 50, 1),
(2, 2, '2020-07-30', 20, 20, '20:25:01', 30, 300, 2),
(1, 4, '2020-08-26', 20, 20, '21:37:17', 30, 50, 1),
(2, 6, '2020-09-22', 1, 1, '17:08:55', 10, 50, 2),
(6, 8, '2019-09-22', 1, 1, '17:08:55', 10, 50, 2);

-- --------------------------------------------------------

--
-- Table structure for table `clinic`
--

CREATE TABLE `clinic` (
  `clinicid` int(10) NOT NULL,
  `clinicname` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clinic`
--

INSERT INTO `clinic` (`clinicid`, `clinicname`, `city`, `state`) VALUES
(1, 'Asian Nobel Hospital', 'Pune', 'Maharashtra'),
(2, 'Sukhada Hospital', 'Ahmednagar', 'Maharashtra');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `doctorid` int(20) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `clinicid` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doctorid`, `firstname`, `lastname`, `city`, `state`, `clinicid`) VALUES
(1, 'Sadan', 'Mehta', 'Ahmednagar', 'Maharashtra', 1),
(2, 'Shririn', 'Saumeul', 'Pune', 'Maharashtra', 2);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `patientid` int(20) NOT NULL,
  `practiceid` int(5) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `patientagegroup` varchar(10) NOT NULL,
  `birthdate` date NOT NULL,
  `age` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patientid`, `practiceid`, `firstname`, `lastname`, `city`, `state`, `gender`, `patientagegroup`, `birthdate`, `age`) VALUES
(1, 1, 'Nilesh', 'Lalit', 'Ahmednagar', 'Maharashtra', 'Male', 'Minor', '2020-08-04', 0),
(2, 2, 'Popat', 'Berad', 'Pune', 'Maharashtra', 'Male', 'Minor', '2020-08-27', 0),
(3, 1, 'meera', 'raut', 'Mumbai', 'Maharashtra', 'Female', 'Minor', '2020-08-17', 0),
(5, 2, 'Sadan', 'Lalit', 'Ahmednagar', 'Maharashtra', 'Male', 'Minor', '2018-12-26', 1),
(6, 2, 'Hela', 'Meren', 'Pune', 'Maharashtra', 'Female', 'Adult', '2000-08-27', 19);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transid` int(20) NOT NULL,
  `patientid` int(20) NOT NULL,
  `proceduretype` varchar(20) NOT NULL,
  `proceduredate` date NOT NULL,
  `provider` int(5) NOT NULL,
  `amount` int(20) NOT NULL,
  `clinicid` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transid`, `patientid`, `proceduretype`, `proceduredate`, `provider`, `amount`, `clinicid`) VALUES
(1, 1, 'Production', '2020-08-03', 1, 50, 1),
(2, 2, 'Payment', '2020-07-30', 20, 100, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`apptid`),
  ADD KEY `patientid` (`patientid`),
  ADD KEY `clinicid` (`clinicid`);

--
-- Indexes for table `clinic`
--
ALTER TABLE `clinic`
  ADD PRIMARY KEY (`clinicid`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doctorid`),
  ADD KEY `clinicid` (`clinicid`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patientid`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transid`),
  ADD KEY `clinicid` (`clinicid`),
  ADD KEY `patientid` (`patientid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `apptid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `clinic`
--
ALTER TABLE `clinic`
  MODIFY `clinicid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `doctorid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `patientid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`patientid`) REFERENCES `patient` (`patientid`),
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`clinicid`) REFERENCES `clinic` (`clinicid`);

--
-- Constraints for table `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT `doctor_ibfk_1` FOREIGN KEY (`clinicid`) REFERENCES `clinic` (`clinicid`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`clinicid`) REFERENCES `clinic` (`clinicid`),
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`patientid`) REFERENCES `patient` (`patientid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
