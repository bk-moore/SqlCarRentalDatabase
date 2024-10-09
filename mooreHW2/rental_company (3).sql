-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2022 at 09:38 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rental_company`
--

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE `car` (
  `Vehical_Id` int(4) NOT NULL,
  `Type` varchar(24) NOT NULL,
  `Model` varchar(24) NOT NULL,
  `Year` int(4) NOT NULL,
  `Daily_Rate` double NOT NULL,
  `Weekly_Rate` double NOT NULL,
  `Is_Available` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`Vehical_Id`, `Type`, `Model`, `Year`, `Daily_Rate`, `Weekly_Rate`, `Is_Available`) VALUES
(1001, 'Medium', 'BMW', 2012, 20, 140, 1),
(1002, 'Compact', 'Fiat', 2013, 5, 35, 0),
(1003, 'Large', 'Ford', 2021, 50, 350, 0),
(1004, 'SUV', 'Honda', 2022, 40, 280, 0),
(1005, 'Van', 'Mercedes', 2014, 35, 245, 0),
(1006, 'Truck', 'Dodge', 2005, 10, 70, 0),
(1007, 'Medium', 'Audi', 2012, 100, 700, 0),
(1008, 'Compact', 'Ford', 2017, 15, 105, 0),
(1009, 'Large', 'Toyota', 2013, 10, 70, 0),
(1010, 'SUV', 'Cadillac', 2020, 20, 140, 0),
(1011, 'Van', 'Dodge', 2001, 20, 140, 0),
(1012, 'Truck', 'Ford', 2003, 25, 175, 0),
(1013, 'Medium', 'Mclaren', 2015, 200, 1400, 0),
(1014, 'Compact', 'Nissan', 2016, 30, 210, 0),
(1015, 'Large', 'GMC', 2005, 15, 105, 0),
(1016, 'SUV', 'Lexus', 2009, 33, 231, 0),
(1017, 'Van', 'Mercedes', 2001, 12, 84, 0),
(1018, 'Truck', 'Honda', 2004, 16, 112, 0),
(1019, 'Medium', 'Lotus', 2022, 150, 1050, 0),
(1020, 'Compact', 'Mini', 2007, 30, 210, 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Id_Number` int(9) NOT NULL,
  `F_Initial` varchar(1) NOT NULL,
  `Last_Name` varchar(15) NOT NULL,
  `Phone` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Id_Number`, `F_Initial`, `Last_Name`, `Phone`) VALUES
(1, 'J', 'Bond', '303-666-6757'),
(2, 'A', 'Person', '817-313-7757'),
(3, 'U', 'Cerious', '716-293-1992'),
(4, 'I', 'Sleepy', '162-129-2211'),
(5, 'E', 'Flubert', '515-231-1191'),
(6, 'N', 'Abyle', '333-132-1323'),
(7, 'B', 'Utton', '819-999-4562'),
(8, 'C', 'Owerd', '612-111-4541'),
(9, 'S', 'Wilbon', '532-135-5519'),
(10, 'T', 'Ired', '412-673-1992');

-- --------------------------------------------------------

--
-- Table structure for table `dailyrental`
--

CREATE TABLE `dailyrental` (
  `Id_Number` int(9) NOT NULL,
  `Vehical_Id` int(4) NOT NULL,
  `Is_Active` tinyint(1) NOT NULL,
  `Is_Scheduled` tinyint(1) NOT NULL,
  `No_of_Days` int(4) NOT NULL,
  `Start_Date` date NOT NULL,
  `Amount_Due` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dailyrental`
--

INSERT INTO `dailyrental` (`Id_Number`, `Vehical_Id`, `Is_Active`, `Is_Scheduled`, `No_of_Days`, `Start_Date`, `Amount_Due`) VALUES
(1, 1001, 0, 0, 1, '2022-12-07', 20),
(2, 1002, 1, 0, 3, '2022-12-05', 15),
(3, 1003, 1, 0, 3, '2022-12-05', 150),
(4, 1004, 0, 1, 4, '2022-12-09', 160),
(5, 1005, 0, 1, 5, '2022-12-10', 175),
(6, 1006, 1, 0, 6, '2022-12-02', 60),
(7, 1007, 1, 0, 4, '2022-12-04', 400),
(8, 1008, 0, 1, 2, '2022-12-25', 30),
(9, 1009, 1, 0, 1, '2022-11-30', 10),
(10, 1010, 0, 1, 1, '2023-01-01', 20);

-- --------------------------------------------------------

--
-- Table structure for table `weeklyrental`
--

CREATE TABLE `weeklyrental` (
  `Id_Number` int(9) NOT NULL,
  `Vehical_Id` int(4) NOT NULL,
  `Is_Active` tinyint(1) NOT NULL,
  `Is_Scheduled` tinyint(1) NOT NULL,
  `No_of_Weeks` int(11) NOT NULL,
  `Start_Date` date NOT NULL,
  `Amount_Due` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `weeklyrental`
--

INSERT INTO `weeklyrental` (`Id_Number`, `Vehical_Id`, `Is_Active`, `Is_Scheduled`, `No_of_Weeks`, `Start_Date`, `Amount_Due`) VALUES
(1, 1011, 1, 0, 1, '2022-12-07', 140),
(2, 1012, 0, 1, 2, '2022-12-05', 350),
(3, 1013, 1, 0, 3, '2022-12-05', 4200),
(4, 1014, 1, 0, 4, '2022-12-09', 840),
(5, 1015, 0, 1, 5, '2022-12-10', 525),
(6, 1016, 1, 0, 4, '2022-12-02', 924),
(7, 1017, 0, 1, 3, '2022-12-04', 252),
(8, 1018, 0, 1, 2, '2022-12-25', 224),
(9, 1019, 1, 0, 1, '2022-11-30', 1050),
(10, 1020, 0, 1, 1, '2023-01-01', 210);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`Vehical_Id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Id_Number`);

--
-- Indexes for table `dailyrental`
--
ALTER TABLE `dailyrental`
  ADD PRIMARY KEY (`Id_Number`,`Vehical_Id`),
  ADD KEY `Vehical_Id` (`Vehical_Id`);

--
-- Indexes for table `weeklyrental`
--
ALTER TABLE `weeklyrental`
  ADD PRIMARY KEY (`Id_Number`,`Vehical_Id`),
  ADD KEY `Vehical_Id` (`Vehical_Id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dailyrental`
--
ALTER TABLE `dailyrental`
  ADD CONSTRAINT `Id_Number` FOREIGN KEY (`Id_Number`) REFERENCES `customer` (`Id_Number`),
  ADD CONSTRAINT `Vehical_Id` FOREIGN KEY (`Vehical_Id`) REFERENCES `car` (`Vehical_Id`);

--
-- Constraints for table `weeklyrental`
--
ALTER TABLE `weeklyrental`
  ADD CONSTRAINT `IdNumberRealtion` FOREIGN KEY (`Id_Number`) REFERENCES `customer` (`Id_Number`),
  ADD CONSTRAINT `VehicalIdRealtion` FOREIGN KEY (`Vehical_Id`) REFERENCES `car` (`Vehical_Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
