-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 28, 2016 at 05:49 PM
-- Server version: 5.6.31-0ubuntu0.14.04.2
-- PHP Version: 5.5.9-1ubuntu4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pointOfSaleDb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE IF NOT EXISTS `tbl_brand` (
  `brandid` bigint(20) NOT NULL AUTO_INCREMENT,
  `brandname` varchar(255) DEFAULT NULL,
  `adminid` bigint(20) NOT NULL DEFAULT '0',
  `active` varchar(255) NOT NULL DEFAULT 'active',
  `createdat` datetime DEFAULT NULL,
  PRIMARY KEY (`brandid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`brandid`, `brandname`, `adminid`, `active`, `createdat`) VALUES
(1, 'Test', 3, 'active', '2016-08-03 02:28:22'),
(2, 'Sample', 3, 'active', '2016-08-03 02:28:48'),
(3, 'Shirt', 3, 'active', '2016-08-03 02:28:58'),
(4, 'tshirt', 3, 'active', '2016-08-03 02:29:09'),
(5, 'jeans', 3, 'active', '2016-08-03 02:29:18'),
(6, 'MArts', 3, 'active', '2016-08-05 00:07:27'),
(7, 'Paint', 2, 'active', '2016-08-18 00:40:58'),
(8, 'Modle', 2, 'active', '2016-08-18 00:53:32');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE IF NOT EXISTS `tbl_category` (
  `categorytypeid` bigint(20) NOT NULL AUTO_INCREMENT,
  `categorytype` varchar(255) DEFAULT NULL,
  `adminid` bigint(20) NOT NULL DEFAULT '0',
  `active` varchar(255) NOT NULL DEFAULT 'active',
  `createdat` datetime DEFAULT NULL,
  PRIMARY KEY (`categorytypeid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`categorytypeid`, `categorytype`, `adminid`, `active`, `createdat`) VALUES
(1, 'Super Admin', 0, 'active', '2016-07-23 00:00:00'),
(2, 'Admin', 0, 'active', '2016-07-23 00:00:00'),
(3, 'Seller', 0, 'active', '2016-07-23 00:00:00'),
(4, 'Retailer Show Room', 0, 'active', '2016-07-23 00:00:00'),
(5, 'Sales Executive', 0, 'active', '2016-07-23 00:00:00'),
(6, 'Delivery Person', 0, 'active', '2016-07-23 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE IF NOT EXISTS `tbl_customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `mobileno` text,
  `active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customerreceipt`
--

CREATE TABLE IF NOT EXISTS `tbl_customerreceipt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `discount` double DEFAULT NULL,
  `roundoff` double DEFAULT NULL,
  `Total` double DEFAULT NULL,
  `customerId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customerreceiptproduct`
--

CREATE TABLE IF NOT EXISTS `tbl_customerreceiptproduct` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receiptId` int(11) DEFAULT NULL,
  `productId` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `discount` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE IF NOT EXISTS `tbl_product` (
  `productid` bigint(20) NOT NULL AUTO_INCREMENT,
  `productname` varchar(255) DEFAULT NULL,
  `productrate` varchar(255) NOT NULL DEFAULT '0',
  `productsize` varchar(255) DEFAULT NULL,
  `availablequantity` varchar(255) NOT NULL DEFAULT '0',
  `barcode` varchar(255) DEFAULT NULL,
  `categorytypeid` bigint(20) NOT NULL DEFAULT '0',
  `brandid` bigint(20) NOT NULL DEFAULT '0',
  `adminid` bigint(20) NOT NULL DEFAULT '0',
  `ShowRoomId` int(11) DEFAULT NULL,
  `active` varchar(255) NOT NULL DEFAULT 'active',
  `createdat` datetime DEFAULT NULL,
  PRIMARY KEY (`productid`),
  UNIQUE KEY `barcode` (`barcode`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`productid`, `productname`, `productrate`, `productsize`, `availablequantity`, `barcode`, `categorytypeid`, `brandid`, `adminid`, `ShowRoomId`, `active`, `createdat`) VALUES
(1, 'Test', '150', 'Xl', '50', 'BAR1234', 1, 1, 2, 1, 'active', '2016-07-31 00:00:00'),
(2, 'Jeans', '1234', 'XXL', '34', 'DSF23222', 1, 5, 2, 1, 'active', '2016-08-05 00:44:53'),
(3, 'paint', '450', 'M', '30', 'PAN001', 1, 5, 2, 1, 'active', '2016-08-12 22:24:36'),
(4, 'T-Shirt', '350', 'XL', '60', 'TSH001', 1, 4, 2, 1, 'active', '2016-08-12 22:25:51'),
(5, 'shirt-Mens', '450', 'L', '60', 'SH002', 1, 3, 2, 1, 'active', '2016-08-12 22:27:44'),
(6, 'Jeans-Shirt', '850', 'L', '88', 'JESH002', 1, 5, 2, 1, 'active', '2016-08-12 22:29:07'),
(7, 'Jeans-T-Shirt', '850', 'L', '100', 'JTSH002', 1, 5, 2, 1, 'active', '2016-08-12 22:29:07'),
(8, 'shirt', '450', '2', '40', 'HJAHS11', 1, 8, 2, 1, 'active', '2016-08-19 00:35:43'),
(9, 'bew_paint', '562', '3', '40', 'FDSF111', 1, 0, 2, 1, 'active', '2016-08-19 00:38:24'),
(11, 'test', '3245', '3', '33', 'qwqeqsa123', 1, 8, 2, 1, 'active', '2016-08-22 23:47:39'),
(12, 'tersa', '456', '2', '33', 'fdffdffaz', 1, 8, 2, 1, 'active', '2016-08-24 01:28:39'),
(13, 'sample', '20', '35', '55', 'ssdfdce', 1, 8, 2, NULL, 'active', '2016-08-28 16:17:08'),
(14, 'samplegg', '10', '35', '88', 'fdgfdgfdgf', 1, 7, 2, NULL, 'active', '2016-08-28 16:18:27'),
(15, 'sample', '2345', '2', '234', 'sdfsdf', 1, 7, 2, NULL, 'active', '2016-08-28 17:45:48');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_productMapping`
--

CREATE TABLE IF NOT EXISTS `tbl_productMapping` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productId` varchar(200) DEFAULT NULL,
  `showroomId` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `adminId` int(11) DEFAULT NULL,
  `createAt` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_productMapping`
--

INSERT INTO `tbl_productMapping` (`id`, `productId`, `showroomId`, `price`, `quantity`, `adminId`, `createAt`) VALUES
(1, 'sample', 35, 233, 33, 2, '2016-08-28'),
(2, 'sample', 32, 2333, 22, 2, '2016-08-28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_showroom`
--

CREATE TABLE IF NOT EXISTS `tbl_showroom` (
  `ShowRoomId` int(11) NOT NULL AUTO_INCREMENT,
  `ShowRoomName` varchar(200) DEFAULT NULL,
  `Address` text,
  `ShowRoomOpenDate` date DEFAULT NULL,
  `adminId` int(11) DEFAULT NULL,
  `active` varchar(200) DEFAULT 'active',
  `ShowRoomImagePath` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`ShowRoomId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_showroom`
--

INSERT INTO `tbl_showroom` (`ShowRoomId`, `ShowRoomName`, `Address`, `ShowRoomOpenDate`, `adminId`, `active`, `ShowRoomImagePath`) VALUES
(1, 'MeShop', 'Chennai', '2014-08-20', 2, 'active', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sizemaster`
--

CREATE TABLE IF NOT EXISTS `tbl_sizemaster` (
  `sizeid` int(11) NOT NULL AUTO_INCREMENT,
  `size` varchar(200) DEFAULT NULL,
  `adminId` int(11) DEFAULT NULL,
  `status` varchar(200) DEFAULT 'active',
  `createdAt` date DEFAULT NULL,
  PRIMARY KEY (`sizeid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_sizemaster`
--

INSERT INTO `tbl_sizemaster` (`sizeid`, `size`, `adminId`, `status`, `createdAt`) VALUES
(1, 'XL', 2, 'active', '2016-08-18'),
(2, 'XXL', 2, 'active', '2016-08-19'),
(3, 'L', 2, 'active', '2016-08-19'),
(4, '', 2, 'active', '2016-08-24');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `userid` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `usertypeid` bigint(20) NOT NULL DEFAULT '0',
  `adminid` bigint(20) NOT NULL DEFAULT '0',
  `retailerShowRoomId` bigint(20) DEFAULT '0',
  `mobile` varchar(255) DEFAULT NULL,
  `address` text,
  `doj` date DEFAULT '0000-00-00',
  `dob` date DEFAULT '0000-00-00',
  `active` varchar(255) NOT NULL DEFAULT 'active',
  `lastlogin` datetime DEFAULT NULL,
  `createdat` datetime DEFAULT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`userid`, `name`, `email`, `password`, `usertypeid`, `adminid`, `retailerShowRoomId`, `mobile`, `address`, `doj`, `dob`, `active`, `lastlogin`, `createdat`) VALUES
(1, 'superadmin', 'superadmin@gmail.com', '1234', 1, 0, NULL, '8344798628', '107 west street, ammaiyappan, thiruvarur, Tamil Nadu', NULL, NULL, 'active', '2016-08-14 15:08:12', '2016-07-23 00:00:00'),
(2, 'posadmin1', 'posadmin1@gmail.com', '1234', 2, 0, NULL, '8124356981', '102 chennai', NULL, NULL, 'active', '2016-08-15 07:08:16', '2016-07-23 19:21:27'),
(3, 'Prasanth', 'prasanth@gmail.com', '1234', 2, 0, NULL, '8122334168', 'salem', '0000-00-00', '0000-00-00', 'active', '2016-08-28 16:08:45', '2016-08-03 02:25:22'),
(32, 'kuru', 'yughgf@hjgdfh.in', '1234', 3, 2, 0, '67567576', 'hjdsff', '0000-00-00', '0000-00-00', 'active', NULL, '2016-08-14 09:26:53'),
(33, 'praveen', 'praveen@dotcue.com', '1234', 5, 2, 32, '54564', 'ok', '2016-08-17', '2016-08-31', 'active', '2016-08-22 23:08:20', '2016-08-14 09:27:39'),
(34, 'oko', 'oko@gmail.com', '1234', 4, 2, 32, '54546', 'dgsdfgdsfg', '2016-08-16', '2016-08-30', 'active', NULL, '2016-08-14 09:28:20'),
(35, 'posaa', 'jhgjh', 'hhgh', 3, 2, 0, 'uyggg', 'hhgh', '0000-00-00', '0000-00-00', 'active', NULL, '2016-08-14 09:31:54');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_usertype`
--

CREATE TABLE IF NOT EXISTS `tbl_usertype` (
  `usertypeid` bigint(11) NOT NULL AUTO_INCREMENT,
  `usertype` varchar(255) DEFAULT NULL,
  `redirecturl` varchar(255) DEFAULT NULL,
  `active` varchar(255) NOT NULL DEFAULT 'active',
  `createdat` datetime DEFAULT NULL,
  PRIMARY KEY (`usertypeid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_usertype`
--

INSERT INTO `tbl_usertype` (`usertypeid`, `usertype`, `redirecturl`, `active`, `createdat`) VALUES
(1, 'Super Admin', 'dashboard', 'active', '2016-07-23 00:00:00'),
(2, 'Admin', 'product/AddProduct', 'active', '2016-07-23 00:00:00'),
(3, 'Retailer Show Room', '0', 'active', '2016-07-23 00:00:00'),
(4, 'Sales Head', 'sales/pos', 'active', '2016-07-23 00:00:00'),
(5, 'Sales Executive', 'sales/pos', 'active', '2016-07-23 00:00:00'),
(6, 'Seller', '0', 'active', '2016-07-23 00:00:00'),
(7, 'Delivery Person', '0', 'active', '2016-07-23 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
