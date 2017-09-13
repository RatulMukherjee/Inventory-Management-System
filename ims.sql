-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2017 at 07:30 AM
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
(14, 'Printer', 'h', 'HP');

-- --------------------------------------------------------

--
-- Table structure for table `companyinfo`
--

CREATE TABLE `companyinfo` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(255) NOT NULL,
  `c_addr` varchar(1024) NOT NULL,
  `c_gstin_no` int(50) NOT NULL,
  `c_contact_no` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_description`
--

CREATE TABLE `invoice_description` (
  `in_id` int(11) NOT NULL,
  `invoice_number` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `product` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `part_number` varchar(255) NOT NULL DEFAULT 'NA',
  `hsn_code` varchar(255) DEFAULT NULL,
  `no_of_units` int(11) NOT NULL,
  `unit_value` int(11) NOT NULL,
  `cgst` int(11) DEFAULT '0',
  `sgst` int(11) DEFAULT '0',
  `igst` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE `invoice_details` (
  `invoice_number` varchar(255) NOT NULL,
  `type_of_customer` enum('Registered','Unregistered','','') NOT NULL,
  `order_no` varchar(255) DEFAULT NULL,
  `billed_to` varchar(255) NOT NULL,
  `billing_addr` varchar(255) NOT NULL,
  `shipped_to` varchar(255) NOT NULL,
  `shipping_addr` varchar(255) NOT NULL,
  `gstin_no` varchar(255) NOT NULL,
  `po_date` date NOT NULL,
  `invoice_date` date NOT NULL,
  `payment_method` enum('Cash','Bank') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`invoice_number`, `type_of_customer`, `order_no`, `billed_to`, `billing_addr`, `shipped_to`, `shipping_addr`, `gstin_no`, `po_date`, `invoice_date`, `payment_method`) VALUES
('STPL/17-18/08-59', 'Registered', 'O-123', 'Supreme Industries Pvt. Ltd.', 'Sarat Bose Road Kol-700020', 'Supreme Industries Pvt. Ltd', 'Sarat Bose Road Kol-700020', '19AAACT1344F1ZL', '2017-08-26', '2017-08-28', 'Cash'),
('STPL/17-18/08-60', 'Registered', 'O-124', 'Supreme Industries Pvt. Ltd.', 'Sarat Bose Road Kol-700020', 'Supreme Industries Pvt. Ltd.', 'Sarat Bose Road Kol-700020', '19AAACT1344F1ZL', '2017-08-26', '2017-08-27', 'Cash');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `model` varchar(255) NOT NULL,
  `part_number` varchar(255) NOT NULL DEFAULT 'NA',
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `gst` int(11) NOT NULL,
  `product_dscp` varchar(255) DEFAULT 'No details available'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `cid`, `model`, `part_number`, `quantity`, `price`, `gst`, `product_dscp`) VALUES
(1, 11, 'HP 20 Inch 2072A LED Monitor', 'B1NGK', 10, 7920, 18, 'No details available'),
(3, 11, 'HP 27VX 27 Inches LED Monitor', 'YQW345', 10, 23227, 18, 'No details available'),
(5, 5, 'LG 21.5 inches (22EN33T) Led Monitor', 'NA', 30, 10800, 12, 'No details available'),
(6, 5, 'LG 27MP38VQ-B 27 Inches LED Monitor Black', 'NA', 30, 19000, 12, 'No details available'),
(7, 9, 'Samsung 18.5 inch LED LS19C170BSQ/XL Monitor', 'NA', 10, 5000, 18, 'No details available'),
(8, 9, 'Samsung LS22D300HY/XL 21.5-inch LED Monitor', 'NA', 10, 7399, 18, 'No details available'),
(9, 1, 'Compaq 18.5 inch LED Backlit LCD - R191b Monitor (Black)', 'NA', 20, 5000, 12, 'No details available'),
(10, 1, 'Compaq 19.45 inch LED Backlit LCD - F201 Monitor (Black)', 'NA', 10, 7500, 18, 'No details available'),
(11, 13, 'HP Imprint (APU Quad Core A6/4GB/1TB/DOS/15.6 Inches) 15-bg005AU Laptop Sparkling Black', 'CVB123', 10, 22990, 18, 'No details available'),
(12, 13, 'HP Pavilion15 AC 117TU (N8M13PA#ACJ) Intel CDC @1.6Ghz - (4 GB DDR3/500 GB HDD/Free DOS) Notebook', 'NA', 10, 22999, 18, 'No details available'),
(13, 14, 'HP M1005 Multifunction Laserjet PrinterLaptop Sparkling Black', 'NA', 10, 14999, 18, 'No details available'),
(14, 14, 'HP DeskJet Ink Advantage 2135 All-in-One Printer (White) ', 'CVB134', 10, 4074, 18, 'No details available'),
(22, 13, 'Elitebook x360 1030 G2', '1UX16PA#ACJ', 108, 100000, 18, 'i7-7600U, 16GB DDR4 RAM, 512GB PCIe SSD, Win 10 Pro, 13.3\" FHD IPS Touchscreen\r\nDisplay with HP Sureview, No ODD, 3 Year Onsite Warranty with 1 year ADP, With Bag'),
(25, 13, 'Elitebook x360 1030 G2', '1UX15PA#ACJ', 10, 119190, 18, '6th Gen i7-7600U, 8GB DDR4 RAM, 256GB PCIe SSD, Win 10 Pro, 13.3\" FHD IPS Touchscreen Display with HP Sureview, No ODD, 3 Year Onsite Warranty with 1 year ADP, With Bag');

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
(16, 'Ratul', '1234', 'Z@Z.com', '2'),
(17, 'Sutanu', '123', 'S@S.com', '2'),
(19, 'Zial', '123', 'C@C.com', '2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `companyinfo`
--
ALTER TABLE `companyinfo`
  ADD PRIMARY KEY (`c_id`),
  ADD UNIQUE KEY `c_name` (`c_name`);

--
-- Indexes for table `invoice_description`
--
ALTER TABLE `invoice_description`
  ADD PRIMARY KEY (`in_id`,`invoice_number`),
  ADD KEY `invoice_number` (`invoice_number`);

--
-- Indexes for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD PRIMARY KEY (`invoice_number`);

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
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `companyinfo`
--
ALTER TABLE `companyinfo`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `invoice_description`
--
ALTER TABLE `invoice_description`
  MODIFY `in_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoice_description`
--
ALTER TABLE `invoice_description`
  ADD CONSTRAINT `invoice_description_ibfk_1` FOREIGN KEY (`invoice_number`) REFERENCES `invoice_details` (`invoice_number`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `category` (`cid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
