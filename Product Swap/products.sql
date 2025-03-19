-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2025 at 07:13 AM
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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `full_name` varchar(100) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `category` enum('Home & Decor','Stationery','Toys & Kids Items','Clothing & Accessories','Gardening & Outdoor','Handmade Crafts','Others') NOT NULL,
  `product_condition` enum('New','Used','Like New') NOT NULL,
  `location` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `userID`, `full_name`, `product_name`, `category`, `product_condition`, `location`, `image`) VALUES
(1, 1, '0', 'Empty Glass Bottle', 'Others', 'Used', 'KL', 'uploadImage/my-borosil-borosilicate-glass-bottles-550-ml-neo-borosilicate-glass-bottle-silver-lid-32349056630922.webp'),
(2, 1, '0', 'DIY Lamp', 'Home & Decor', 'New', 'Puchong', 'uploadImage/diy-lamp-shades-vasililights-1.jpg'),
(3, 2, 'Ian Chin Jun Sheng', 'Black T-shirt', 'Clothing & Accessories', 'Like New', 'Bandar Tasik Selatan ', 'uploadImage/edd921c3-scaled-550x550.webp'),
(4, NULL, 'YY', 'Handmade Clay Pot', 'Gardening & Outdoor', 'New', 'Terengganu', 'uploadImage/EL-021-108_A_720x.webp'),
(5, NULL, 'Mei Ling', 'Flower Pot', 'Gardening & Outdoor', 'New', 'Kelantan', 'uploadImage/Korean-Hand-Pinched-Flower-Pot-Creative-Hand-Sized-Breathable-Small-Ceramic-Succulent-Plant-Pot-with-Feet.avif'),
(6, NULL, 'Ian', 'Badminton', 'Others', 'Used', 'Puchong', 'uploadImage/astrox100zz_kurenai.webp'),
(7, NULL, 'Sin Yi', 'Mug', 'Home & Decor', 'New', 'Bandar Tasik Selatan ', 'uploadImage/cup.jpg'),
(9, NULL, 'Bowie Chong Yu Shin', 'White Canva Bag', 'Clothing & Accessories', 'Used', 'Pahang', 'uploadImage/celine.webp'),
(10, 3, 'Cheang Zhi Lin', 'Hype T-Shirt', 'Clothing & Accessories', 'Used', 'Perak', 'uploadImage/shopping.webp'),
(11, 3, 'Cheang Zhi Lin', 'Coke bottle', 'Others', 'Used', 'Puchong', 'uploadImage/images (2).jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`userID`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
