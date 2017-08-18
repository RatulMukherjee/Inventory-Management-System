-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2017 at 09:26 AM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ims`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` enum('h','s') NOT NULL,
  `brand` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cid`, `name`, `type`, `brand`) VALUES
(1, 'Monitor', 'h', 'Compaq'),
(5, 'Monitor', 'h', 'LG'),
(9, 'Monitor', 'h', 'Samsung'),
(11, 'Monitor', 'h', 'HP'),
(13, 'Laptop', 'h', 'HP'),
(14, 'Printer', 'h', 'HP'),
(15, 'Laptop', 'h', 'Samsung'),
(16, 'Printer', 'h', 'Samsung');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `model` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `gst` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `cid`, `model`, `quantity`, `price`, `gst`) VALUES
(1, 11, 'HP 20 Inch 2072A LED Monitor', 10, 7920, 18),
(3, 11, 'HP 27VX 27 Inches LED Monitor', 10, 23227, 18),
(5, 5, 'LG 21.5 inches (22EN33T) Led Monitor', 10, 9400, 18),
(6, 5, 'LG 27MP38VQ-B 27 Inches LED Monitor Black', 10, 17169, 18),
(7, 9, 'Samsung 18.5 inch LED LS19C170BSQ/XL Monitor', 10, 5000, 18),
(8, 9, 'Samsung LS22D300HY/XL 21.5-inch LED Monitor', 10, 7399, 18),
(9, 1, 'Compaq 18.5 inch LED Backlit LCD - R191b Monitor (Black)', 10, 7200, 18),
(10, 1, 'Compaq 19.45 inch LED Backlit LCD - F201 Monitor (Black)', 10, 7500, 18),
(11, 13, 'HP Imprint (APU Quad Core A6/4GB/1TB/DOS/15.6 Inches) 15-bg005AU Laptop Sparkling Black', 10, 22990, 18),
(12, 13, 'HP Pavilion15 AC 117TU (N8M13PA#ACJ) Intel CDC @1.6Ghz - (4 GB DDR3/500 GB HDD/Free DOS) Notebook', 10, 22999, 18),
(13, 14, 'HP M1005 Multifunction Laserjet PrinterLaptop Sparkling Black', 10, 14999, 18),
(14, 14, 'HP DeskJet Ink Advantage 2135 All-in-One Printer (White) ', 10, 4074, 18);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `uname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `acc_type` enum('1','2') NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `uname`, `password`, `email`, `acc_type`) VALUES
(7, 'Ratul', '123', 'A@A.com', '2'),
(13, 'Kumar', '1234', 'F@F.com', '2'),
(14, 'Ratul', '2123', 'B@B.com', '2'),
(15, 'Ratul', '123456', 'F@FA.com', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`,`cid`),
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `category` (`cid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
