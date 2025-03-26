-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2025 at 05:02 PM
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
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `age` int(11) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `join_event`
--

INSERT INTO `join_event` (`join_id`, `event_id`, `name`, `email`, `phone`, `age`, `address`) VALUES
(1, 1, 'Tan Ren Jie', 'tanrenjie@gmail.com', '0168949241', 19, '123, Kuala Lumpur'),
(2, 1, 'Noah', 'noah@example.com', '0157834490', 18, '54, Ampang'),
(3, 1, 'John', 'john@gmail.com', '0188374895', 20, '100, Cheras'),
(4, 2, 'Jonny', 'johnny@gmail.com', '0156728302', 23, '170, Wangsa Maju'),
(5, 2, 'Wong Qi Jun', 'qjwong@hotmail.com', '0167432891', 24, '170, Sri Petaling'),
(6, 2, 'Chong Jun Jie', 'cjj@example.com', '0178949236', 18, '150, Bukit Bintang'),
(7, 3, 'Chow Yuen Qi', 'cyq@yahoo.com', '0172943298', 40, '130, Bukit Jalil'),
(8, 3, 'Ting Yue Kin', 'yuekin@gmail.com', '0146278138', 21, '35, Pasar Seni'),
(9, 3, 'Yuan Lok Kee', 'lokee@gmail.com', '0158274891', 22, '20, Chan Saw Lin'),
(10, 4, 'Alice Lee Ying Jie', 'alice@hotmail.com', '0198327492', 25, '10, Titiwangsa'),
(11, 4, 'Low Kai Wen', 'kaiwen@example.com', '0183842294', 20, '120, Hang Tuah'),
(12, 4, 'Chen Ming Ming', 'mmchen@gmail.com', '0153294189', 27, '180, Sungai Besi'),
(13, 5, 'Pang Jun Jun', 'jjunpang@example.com', '0167429481', 28, '60, Puchong'),
(14, 5, 'Heng Yoah Kai', 'ykh@gmail.com', '0167834618', 25, '7, Kajang');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `join_event`
--
ALTER TABLE `join_event`
  ADD PRIMARY KEY (`join_id`),
  ADD KEY `event_id` (`event_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `join_event`
--
ALTER TABLE `join_event`
  MODIFY `join_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `join_event`
--
ALTER TABLE `join_event`
  ADD CONSTRAINT `Test` FOREIGN KEY (`event_id`) REFERENCES `recycle_event` (`event_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
