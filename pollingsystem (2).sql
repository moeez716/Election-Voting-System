-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2025 at 08:57 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pollingsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminID`, `Name`, `Email`, `Password`, `CreatedAt`, `UpdatedAt`) VALUES
(1234, 'Abdul Moeez Tariq', 'abdulmoeeztariq@gmail.com', '18022001Am@', '2025-01-25 13:44:26', '2025-01-25 13:44:26');

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

CREATE TABLE `candidate` (
  `cnic` varchar(20) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `PartyID` int(11) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `candidate`
--

INSERT INTO `candidate` (`cnic`, `Name`, `Email`, `PartyID`, `position`) VALUES
('35202-7546270-4', 'Asif ali zardari', 'asifali716@gmail.com', 3, 'MNA'),
('35202-7546270-5', 'Gohar khan', 'goharkhan716@gmail.com', 1, 'MPA'),
('35202-7546270-6', 'Shebaz Sherief', 'shebazsherief716@gmail.com', 2, 'MPA'),
('35202-7546270-7', 'Bilawal Bhuto', 'bilawalbhuto716@gmail.com', 3, 'MPA'),
('3520275462701', 'Imran khan', 'abdulmoeeztariq716@gmail.com', 1, 'MNA'),
('3520275462702', 'Nawaz Sherief', 'nawazsherief716@gmail.com', 2, 'MNA');

-- --------------------------------------------------------

--
-- Table structure for table `party`
--

CREATE TABLE `party` (
  `PartyID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `party`
--

INSERT INTO `party` (`PartyID`, `Name`, `CreatedAt`, `UpdatedAt`) VALUES
(1, 'Pakistan Tahreek e Insaf (PTI)', '2025-01-25 17:35:31', '2025-01-25 17:35:31'),
(2, 'pakistan muslim league N (PMLN)', '2025-01-26 16:00:31', '2025-01-26 16:00:31'),
(3, 'Pakistan Peoples Party (PPP)', '2025-01-26 16:02:25', '2025-01-26 16:02:25');

-- --------------------------------------------------------

--
-- Table structure for table `poll`
--

CREATE TABLE `poll` (
  `PollID` int(11) NOT NULL,
  `Title` varchar(200) NOT NULL,
  `AdminID` int(11) NOT NULL,
  `Status` enum('Active','Closed','Draft') DEFAULT 'Draft',
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `StartDate` datetime DEFAULT NULL,
  `EndDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `poll`
--

INSERT INTO `poll` (`PollID`, `Title`, `AdminID`, `Status`, `CreatedAt`, `UpdatedAt`, `StartDate`, `EndDate`) VALUES
(2, 'National Assembly vote', 1234, 'Closed', '2025-01-26 10:21:28', '2025-01-27 18:55:00', '2025-01-27 23:50:00', '2025-01-27 23:55:00'),
(3, 'provincial assembly vote', 1234, 'Closed', '2025-01-26 15:54:00', '2025-01-27 18:55:00', '2025-01-27 23:50:00', '2025-01-27 23:55:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `cnic` varchar(20) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `VenueID` int(11) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`cnic`, `Name`, `Email`, `Password`, `VenueID`, `CreatedAt`, `UpdatedAt`) VALUES
('33100-9371405-5', 'Tariq Mahmood', 'tariqmahmood3@gmail.com', '18022001Am@', 1002, '2025-01-27 14:09:14', '2025-01-27 14:09:14'),
('35202-1111235-5', 'Abdul moeiz majid khan', 'moiezmajid123@gmail.com', '18022001Am@', 1001, '2025-01-27 16:03:20', '2025-01-27 16:03:20'),
('35202-1111235-6', 'jawad', 'jawad123@gmail.com', '18022001Am@', 1001, '2025-01-27 18:46:29', '2025-01-27 18:46:29'),
('35202-7546270-3', 'Abdul Moeez tariq', 'abdulmoeeztariq716@gmail.com', '18022001Am@', 1001, '2025-01-26 14:45:25', '2025-01-26 14:45:25'),
('35202-7546270-4', 'Abdul manaf', 'manaf716@gmail.com', '18022001Am@', 1002, '2025-01-26 20:27:34', '2025-01-26 20:27:34');

-- --------------------------------------------------------

--
-- Table structure for table `venue`
--

CREATE TABLE `venue` (
  `VenueID` int(11) NOT NULL,
  `VenueAddress` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `venue`
--

INSERT INTO `venue` (`VenueID`, `VenueAddress`) VALUES
(1001, '325 topaz block park view city lahore'),
(1002, '329 topaz block park view city lahore');

-- --------------------------------------------------------

--
-- Table structure for table `venuecandidate`
--

CREATE TABLE `venuecandidate` (
  `VenueID` int(11) NOT NULL,
  `CandidateID` varchar(20) NOT NULL,
  `AssignedDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `PollID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `venuecandidate`
--

INSERT INTO `venuecandidate` (`VenueID`, `CandidateID`, `AssignedDate`, `PollID`) VALUES
(1001, '35202-7546270-4', '2025-01-26 16:28:08', 2),
(1001, '35202-7546270-5', '2025-01-26 16:28:41', 3),
(1001, '35202-7546270-6', '2025-01-26 16:29:25', 3),
(1001, '35202-7546270-7', '2025-01-26 16:29:51', 3),
(1001, '3520275462701', '2025-01-26 14:26:45', 2),
(1001, '3520275462702', '2025-01-26 16:30:15', 2),
(1002, '35202-7546270-5', '2025-01-26 20:34:19', 3),
(1002, '35202-7546270-6', '2025-01-26 20:33:52', 3),
(1002, '3520275462701', '2025-01-26 20:28:52', 2),
(1002, '3520275462702', '2025-01-26 20:33:23', 2);

-- --------------------------------------------------------

--
-- Table structure for table `vote`
--

CREATE TABLE `vote` (
  `VoteID` int(11) NOT NULL,
  `PollID` int(11) NOT NULL,
  `UserID` varchar(20) DEFAULT NULL,
  `VenueID` int(11) DEFAULT NULL,
  `CandidateID` varchar(20) DEFAULT NULL,
  `VotedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vote`
--

INSERT INTO `vote` (`VoteID`, `PollID`, `UserID`, `VenueID`, `CandidateID`, `VotedAt`) VALUES
(1, 2, '35202-7546270-3', 1001, '3520275462701', '2025-01-26 19:48:00'),
(2, 3, '35202-7546270-3', 1001, '35202-7546270-5', '2025-01-26 19:53:05'),
(3, 2, '35202-7546270-4', 1002, '3520275462701', '2025-01-26 20:36:30'),
(4, 3, '35202-7546270-4', 1002, '35202-7546270-6', '2025-01-26 20:36:40'),
(5, 2, '33100-9371405-5', 1002, '3520275462702', '2025-01-27 14:12:11'),
(6, 3, '33100-9371405-5', 1002, '35202-7546270-6', '2025-01-27 14:12:33'),
(7, 2, '35202-1111235-5', 1001, '35202-7546270-4', '2025-01-27 16:07:23'),
(8, 3, '35202-1111235-5', 1001, '35202-7546270-7', '2025-01-27 16:07:36'),
(9, 2, '35202-1111235-6', 1001, '3520275462702', '2025-01-27 18:50:51'),
(10, 3, '35202-1111235-6', 1001, '35202-7546270-6', '2025-01-27 18:51:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `candidate`
--
ALTER TABLE `candidate`
  ADD PRIMARY KEY (`cnic`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD KEY `FK_Candidate_Party` (`PartyID`);

--
-- Indexes for table `party`
--
ALTER TABLE `party`
  ADD PRIMARY KEY (`PartyID`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `poll`
--
ALTER TABLE `poll`
  ADD PRIMARY KEY (`PollID`),
  ADD KEY `FK_Poll_Admin` (`AdminID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`cnic`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD KEY `FK_User_Venue` (`VenueID`);

--
-- Indexes for table `venue`
--
ALTER TABLE `venue`
  ADD PRIMARY KEY (`VenueID`);

--
-- Indexes for table `venuecandidate`
--
ALTER TABLE `venuecandidate`
  ADD PRIMARY KEY (`VenueID`,`CandidateID`),
  ADD KEY `FK_VenueCandidate_Candidate` (`CandidateID`),
  ADD KEY `fk_1` (`PollID`);

--
-- Indexes for table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`VoteID`),
  ADD KEY `FK_Vote_Poll` (`PollID`),
  ADD KEY `FK_Vote_User` (`UserID`),
  ADD KEY `FK_Vote_Venue` (`VenueID`),
  ADD KEY `FK_Vote_Candidate` (`CandidateID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `poll`
--
ALTER TABLE `poll`
  MODIFY `PollID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vote`
--
ALTER TABLE `vote`
  MODIFY `VoteID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `candidate`
--
ALTER TABLE `candidate`
  ADD CONSTRAINT `FK_Candidate_Party` FOREIGN KEY (`PartyID`) REFERENCES `party` (`PartyID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `poll`
--
ALTER TABLE `poll`
  ADD CONSTRAINT `FK_Poll_Admin` FOREIGN KEY (`AdminID`) REFERENCES `admin` (`AdminID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_User_Venue` FOREIGN KEY (`VenueID`) REFERENCES `venue` (`VenueID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `venuecandidate`
--
ALTER TABLE `venuecandidate`
  ADD CONSTRAINT `FK_VenueCandidate_Candidate` FOREIGN KEY (`CandidateID`) REFERENCES `candidate` (`cnic`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_VenueCandidate_Venue` FOREIGN KEY (`VenueID`) REFERENCES `venue` (`VenueID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_1` FOREIGN KEY (`PollID`) REFERENCES `poll` (`PollID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `FK_Vote_Candidate` FOREIGN KEY (`CandidateID`) REFERENCES `candidate` (`cnic`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Vote_Poll` FOREIGN KEY (`PollID`) REFERENCES `poll` (`PollID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Vote_User` FOREIGN KEY (`UserID`) REFERENCES `users` (`cnic`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Vote_Venue` FOREIGN KEY (`VenueID`) REFERENCES `venue` (`VenueID`) ON DELETE SET NULL ON UPDATE CASCADE;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `update_poll_status_event` ON SCHEDULE EVERY 1 SECOND STARTS '2025-01-27 14:41:58' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    DECLARE currentDateTime DATETIME;
    SET currentDateTime = NOW();

    -- Update to 'Active' within StartDate and EndDate
    UPDATE poll
    SET Status = 'Active'
    WHERE StartDate <= currentDateTime
      AND EndDate > currentDateTime
      AND Status != 'Active';

UPDATE poll
    SET Status = 'Draft'
    WHERE StartDate > currentDateTime
      AND Status != 'Draft';
    -- Update to 'Closed' if EndDate is past
    UPDATE poll
    SET Status = 'Closed'
    WHERE EndDate <= currentDateTime
      AND Status != 'Closed';

    -- You can add other updates here if needed
END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
