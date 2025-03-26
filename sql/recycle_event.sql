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
-- Table structure for table `recycle_event`
--

CREATE TABLE `recycle_event` (
  `event_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recycle_event`
--

INSERT INTO `recycle_event` (`event_id`, `date`, `name`, `title`, `description`, `image`) VALUES
(1, '2025-03-29', 'Lee Jun Hao', 'Green Future Fest: Recycle and Thrive!', 'Join us at Green Future Fest for a day of recycling, sustainability, and fun! Enjoy activities, workshops, and meet eco-conscious friends. Bring recyclables and help build a greener future—every action counts!', 'recycle-event-1.jpg'),
(2, '2025-04-05', 'Jackson Yee', 'Recycle Rally 2025', 'Join us for a day of fun, learning, and eco-action! Enjoy workshops, games, and expert talks while recycling for a greener future. Let’s make a difference together!', 'recycle-event-2.jpeg'),
(3, '2025-04-12', 'Wong Jing Jing', 'Eco Vision', 'Join us in preserving nature by recycling and learning sustainable practices. Engage in interactive activities and educational sessions that empower you to protect the environment. Together, we can build a cleaner, greener world! 🌎♻️', 'recycle-event-3.jpeg'),
(4, '2025-04-13', 'Tham Shi Wen', 'Eco Warriors Cleanup Drive', 'Take part in a community-wide recycling and cleanup drive! Collect waste, recycle plastics, and help restore nature. Together, we can make our surroundings cleaner and healthier! 🌱', 'recycle-event-4.jpeg'),
(5, '2025-04-19', 'Woon Jun Hui', 'Zero Waste Challenge', 'Join our Zero Waste Challenge and learn how to reduce waste effectively! Engage in fun activities, swap items, and discover creative upcycling ideas. Let’s commit to a sustainable future! ♻️', 'recycle-event-5.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `recycle_event`
--
ALTER TABLE `recycle_event`
  ADD PRIMARY KEY (`event_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `recycle_event`
--
ALTER TABLE `recycle_event`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
