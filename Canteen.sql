-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 05, 2020 at 08:17 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Canteen`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `categoryId` int(5) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `banner` varchar(100) DEFAULT NULL,
  `home` tinyint(4) DEFAULT 0,
  `status` tinyint(4) DEFAULT 1,
  `createAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updateAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`categoryId`, `name`, `description`, `slug`, `image`, `banner`, `home`, `status`, `createAt`, `updateAt`) VALUES
(35, 'peter', '', 'peter', NULL, NULL, 0, 1, '2020-09-29 07:07:54', '2020-09-29 07:07:54'),
(36, 'truong', '', 'truong', NULL, NULL, 0, 1, '2020-09-29 07:07:58', '2020-09-29 07:07:58'),
(37, 'Dell', '', 'dell', NULL, NULL, 0, 1, '2020-09-29 07:08:07', '2020-09-29 07:08:07');

-- --------------------------------------------------------

--
-- Table structure for table `tblitem`
--

CREATE TABLE `tblitem` (
  `itemId` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` decimal(15,3) NOT NULL,
  `categoryId` int(5) NOT NULL,
  `sale` int(11) DEFAULT 0,
  `image` varchar(100) DEFAULT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `statusId` tinyint(4) DEFAULT 0,
  `updateAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `createAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `description` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblitem`
--

INSERT INTO `tblitem` (`itemId`, `name`, `price`, `categoryId`, `sale`, `image`, `slug`, `statusId`, `updateAt`, `createAt`, `description`) VALUES
(6, 'n', '2.000', 36, 0, '75250981_p0.jpg', 'n', 0, '2020-09-30 07:59:07', '2020-09-29 07:08:59', 'n'),
(7, 'b', '3.000', 37, 0, '74907438_p0.jpg', 'b', 0, '2020-09-30 07:59:07', '2020-09-29 07:09:20', 'b'),
(10, 'f', '10.000', 37, 0, '71712113_p0.jpg', 'f', 0, '2020-09-30 10:10:14', '2020-09-30 10:10:14', 'f');

-- --------------------------------------------------------

--
-- Table structure for table `tblorder`
--

CREATE TABLE `tblorder` (
  `orderId` int(5) NOT NULL,
  `createAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblorder-item`
--

CREATE TABLE `tblorder-item` (
  `itemId` int(5) NOT NULL,
  `orderId` int(5) NOT NULL,
  `quantity` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblrole`
--

CREATE TABLE `tblrole` (
  `roleId` int(5) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblrole`
--

INSERT INTO `tblrole` (`roleId`, `name`, `description`) VALUES
(1, 'Admin', 'All privilege'),
(2, 'Caterer', 'Manage item, manage order'),
(3, 'User', 'Client');

-- --------------------------------------------------------

--
-- Table structure for table `tblstatus`
--

CREATE TABLE `tblstatus` (
  `statusId` tinyint(4) NOT NULL,
  `name` varchar(100) DEFAULT 'Stocking'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblstatus`
--

INSERT INTO `tblstatus` (`statusId`, `name`) VALUES
(0, 'Stocking'),
(1, 'Out of stock'),
(3, 'In kitchen'),
(4, 'Accepted'),
(5, 'Ready');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `username` varchar(100) NOT NULL,
  `fullname` varchar(500) DEFAULT NULL,
  `roleId` int(5) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `class` varchar(50) DEFAULT NULL,
  `identityNo` varchar(50) DEFAULT NULL,
  `currentBalance` decimal(15,3) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `createAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`username`, `fullname`, `roleId`, `email`, `phone`, `address`, `class`, `identityNo`, `currentBalance`, `password`, `createAt`) VALUES
('kolo1232323', 'Peter Parker', 1, 'truong@gmail.com', '0585848783', '209-Ho Thi Huong', NULL, '0703147025', NULL, 'd41d8cd98f00b204e9800998ecf8427e', '2020-10-02 01:21:12'),
('kolo4565656', 'Truong', 1, 'leminhschool@gmail.com', '0585848783', '209-Ho Thi Huong', NULL, '0803147025', NULL, '202cb962ac59075b964b07152d234b70', '2020-10-02 01:31:43'),
('qwe', 'qwe', 2, 'qwe@gmail.com', '0505848783', '209-Ho Thi Huong', NULL, '0708147025', NULL, '7815696ecbf1c96e6894b779456d330e', '2020-10-02 02:03:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `tblitem`
--
ALTER TABLE `tblitem`
  ADD PRIMARY KEY (`itemId`),
  ADD KEY `FK_tblitem_tblcategory` (`categoryId`),
  ADD KEY `FK_tblitem_tblstatus` (`statusId`);

--
-- Indexes for table `tblorder`
--
ALTER TABLE `tblorder`
  ADD PRIMARY KEY (`orderId`),
  ADD KEY `FK_tblorder_tbluser` (`username`);

--
-- Indexes for table `tblorder-item`
--
ALTER TABLE `tblorder-item`
  ADD PRIMARY KEY (`itemId`,`orderId`),
  ADD KEY `FK_tblorder-item_tblorder` (`orderId`);

--
-- Indexes for table `tblrole`
--
ALTER TABLE `tblrole`
  ADD PRIMARY KEY (`roleId`);

--
-- Indexes for table `tblstatus`
--
ALTER TABLE `tblstatus`
  ADD PRIMARY KEY (`statusId`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`username`),
  ADD KEY `FK_tbluser_tblrole` (`roleId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `categoryId` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tblitem`
--
ALTER TABLE `tblitem`
  MODIFY `itemId` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tblorder`
--
ALTER TABLE `tblorder`
  MODIFY `orderId` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblrole`
--
ALTER TABLE `tblrole`
  MODIFY `roleId` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblitem`
--
ALTER TABLE `tblitem`
  ADD CONSTRAINT `FK_tblitem_tblcategory` FOREIGN KEY (`categoryId`) REFERENCES `tblcategory` (`categoryId`),
  ADD CONSTRAINT `FK_tblitem_tblstatus` FOREIGN KEY (`statusId`) REFERENCES `tblstatus` (`statusId`);

--
-- Constraints for table `tblorder`
--
ALTER TABLE `tblorder`
  ADD CONSTRAINT `FK_tblorder_tbluser` FOREIGN KEY (`username`) REFERENCES `tbluser` (`username`);

--
-- Constraints for table `tblorder-item`
--
ALTER TABLE `tblorder-item`
  ADD CONSTRAINT `FK_tblorder-item_tblitem` FOREIGN KEY (`itemId`) REFERENCES `tblitem` (`itemId`),
  ADD CONSTRAINT `FK_tblorder-item_tblorder` FOREIGN KEY (`orderId`) REFERENCES `tblorder` (`orderId`);

--
-- Constraints for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD CONSTRAINT `FK_tbluser_tblrole` FOREIGN KEY (`roleId`) REFERENCES `tblrole` (`roleId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
