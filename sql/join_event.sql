-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2025 at 02:08 PM
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
-- Database: `ecohaven`
--

-- --------------------------------------------------------

--
-- Table structure for table `join_event`
--

CREATE TABLE `join_event` (
  `join_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `age` int(11) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `join_event`
--

INSERT INTO `join_event` (`join_id`, `event_id`, `userID`, `name`, `email`, `phone`, `age`, `address`) VALUES
(1, 1, 2, 'Bowie Chong Yu Shin', 'bawie@gmail.com', '0168949241', 19, '123, Kuala Lumpur'),
(2, 1, 3, 'Ritchie Boon Win Yew', 'richphato@gmail.com', '0157834490', 18, '54, Ampang'),
(3, 1, 4, 'Ian Chin Jun Sheng', 'iancjsheng@gmail.com', '0188374895', 20, '100, Cheras'),
(4, 2, 5, 'John Doe', 'johndoe@gmail.com', '0156728302', 23, '170, Wangsa Maju'),
(5, 2, 6, 'Jane Smith', 'jane@example.com', '0167432891', 24, '170, Sri Petaling'),
(6, 2, 7, 'Mike Jones', 'mike@example.com', '0178949236', 18, '150, Bukit Bintang'),
(7, 3, 8, 'Susan Clark', 'susan@example.com', '0172943298', 40, '130, Bukit Jalil'),
(8, 3, 9, 'David White', 'david@example.com', '0146278138', 21, '35, Pasar Seni'),
(9, 3, 10, 'Emma Brown', 'emma@example.com', '0158274891', 22, '20, Chan Saw Lin'),
(10, 4, 11, 'Charlie Davis', 'charlie@example.com', '0198327492', 25, '10, Titiwangsa'),
(11, 4, 12, 'Olivia Miller', 'olivia@example.com', '0183842294', 20, '120, Hang Tuah'),
(12, 4, 13, 'William Wilson', 'william@example.com', '0153294189', 27, '180, Sungai Besi'),
(13, 5, 14, 'Ava Moore', 'ava@example.com', '0167429481', 28, '60, Puchong'),
(14, 5, 15, 'Noah Taylor', 'noah@example.com', '0167834618', 25, '7, Kajang'),
(17, 5, 16, 'Sophia Anderson', 'sophia@example.com', '0172844219', 22, '120, Masjid Jamek');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `join_event`
--
ALTER TABLE `join_event`
  ADD PRIMARY KEY (`join_id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `userID` (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `join_event`
--
ALTER TABLE `join_event`
  MODIFY `join_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `join_event`
--
ALTER TABLE `join_event`
  ADD CONSTRAINT `Test` FOREIGN KEY (`event_id`) REFERENCES `recycle_event` (`event_id`),
  ADD CONSTRAINT `join_event_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
