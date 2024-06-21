-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2024 at 04:12 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `investmentrecommendation`
--

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `PortfolioID` int(11) NOT NULL,
  `Ticker` varchar(10) NOT NULL,
  `Amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`PortfolioID`, `Ticker`, `Amount`) VALUES
(1, 'AAPL', 10),
(1, 'GOOGL', 5),
(2, 'TSLA', 15),
(2, 'US10Y', 20);

-- --------------------------------------------------------

--
-- Table structure for table `equities`
--

CREATE TABLE `equities` (
  `Ticker` varchar(10) NOT NULL,
  `EquityType` enum('shares','bonds') DEFAULT NULL,
  `EquityName` varchar(255) NOT NULL,
  `EquityPrice` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equities`
--

INSERT INTO `equities` (`Ticker`, `EquityType`, `EquityName`, `EquityPrice`) VALUES
('AAPL', 'shares', 'Apple Inc.', 150.00),
('GOOGL', 'shares', 'Alphabet Inc.', 2800.00),
('TSLA', 'shares', 'Tesla Inc.', 700.00),
('US10Y', 'bonds', 'US 10 Year Treasury', 100.00);

-- --------------------------------------------------------

--
-- Table structure for table `portfolios`
--

CREATE TABLE `portfolios` (
  `PortfolioID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `PortfolioDescription` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `portfolios`
--

INSERT INTO `portfolios` (`PortfolioID`, `UserID`, `PortfolioDescription`) VALUES
(1, 3, 'User One Portfolio'),
(2, 3, 'User Two Portfolio');

-- --------------------------------------------------------

--
-- Table structure for table `risktolerances`
--

CREATE TABLE `risktolerances` (
  `UserID` int(11) NOT NULL,
  `Tolerance` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `risktolerances`
--

INSERT INTO `risktolerances` (`UserID`, `Tolerance`) VALUES
(3, 'High');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `UserEmail` varchar(255) NOT NULL,
  `UserFullName` varchar(255) NOT NULL,
  `UserPassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `UserEmail`, `UserFullName`, `UserPassword`) VALUES
(3, 'joman@gmail.com', 'Joshua Manasye', '$2y$10$eqJDpxRFUptMtTqB6HZ1juotYPJzLKJWIz9ezH.WQM6kTYu0gmh/u');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`PortfolioID`,`Ticker`),
  ADD KEY `Ticker` (`Ticker`);

--
-- Indexes for table `equities`
--
ALTER TABLE `equities`
  ADD PRIMARY KEY (`Ticker`);

--
-- Indexes for table `portfolios`
--
ALTER TABLE `portfolios`
  ADD PRIMARY KEY (`PortfolioID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `risktolerances`
--
ALTER TABLE `risktolerances`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `UserEmail` (`UserEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `portfolios`
--
ALTER TABLE `portfolios`
  MODIFY `PortfolioID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assets`
--
ALTER TABLE `assets`
  ADD CONSTRAINT `assets_ibfk_1` FOREIGN KEY (`PortfolioID`) REFERENCES `portfolios` (`PortfolioID`),
  ADD CONSTRAINT `assets_ibfk_2` FOREIGN KEY (`Ticker`) REFERENCES `equities` (`Ticker`);

--
-- Constraints for table `portfolios`
--
ALTER TABLE `portfolios`
  ADD CONSTRAINT `portfolios_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `risktolerances`
--
ALTER TABLE `risktolerances`
  ADD CONSTRAINT `risktolerances_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
