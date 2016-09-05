-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 05, 2016 at 05:45 PM
-- Server version: 5.5.49-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.17

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`brandid`, `brandname`, `adminid`, `active`, `createdat`) VALUES
(1, 'Jokey', 7, 'active', '2016-09-03 22:50:45'),
(2, 'Ramraj', 7, 'active', '2016-09-03 22:50:56'),
(3, 'testbrand', 7, 'deleted', '2016-09-03 22:51:08');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categorytype`
--

CREATE TABLE IF NOT EXISTS `tbl_categorytype` (
  `categorytypeid` bigint(20) NOT NULL AUTO_INCREMENT,
  `categorytype` varchar(255) DEFAULT NULL,
  `adminId` int(11) DEFAULT NULL,
  `active` varchar(200) DEFAULT 'active',
  `createdAt` date DEFAULT NULL,
  PRIMARY KEY (`categorytypeid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_categorytype`
--

INSERT INTO `tbl_categorytype` (`categorytypeid`, `categorytype`, `adminId`, `active`, `createdAt`) VALUES
(1, 'Pant', 7, 'active', '2016-09-03'),
(2, 'Shirt', 7, 'active', '2016-09-03'),
(3, 'underwear', 7, 'active', '2016-09-03'),
(4, 'test', 7, 'deleted', '2016-09-03');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `name`, `mobileno`, `active`) VALUES
(1, 'dfdfg', '54636345634', 1);

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
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_customerreceipt`
--

INSERT INTO `tbl_customerreceipt` (`id`, `discount`, `roundoff`, `Total`, `customerId`, `date`) VALUES
(1, 0, 0, 0, 1, '2016-09-03 23:42:10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customerreceiptproduct`
--

CREATE TABLE IF NOT EXISTS `tbl_customerreceiptproduct` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receiptId` int(11) DEFAULT NULL,
  `productId` int(11) DEFAULT NULL,
  `showroomId` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `discount` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_customerreceiptproduct`
--

INSERT INTO `tbl_customerreceiptproduct` (`id`, `receiptId`, `productId`, `showroomId`, `price`, `qty`, `discount`) VALUES
(1, 1, 1, NULL, 100, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_forgotPasswordRequest`
--

CREATE TABLE IF NOT EXISTS `tbl_forgotPasswordRequest` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `userid` bigint(20) DEFAULT NULL,
  `otp` int(11) NOT NULL,
  `createdAt` datetime NOT NULL,
  `expiryDate` datetime NOT NULL,
  `active` varchar(255) DEFAULT 'active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_forgotPasswordRequest`
--

INSERT INTO `tbl_forgotPasswordRequest` (`id`, `userid`, `otp`, `createdAt`, `expiryDate`, `active`) VALUES
(1, 7, 236400, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(2, 7, 268423, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(3, 7, 750337, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(4, 2, 404587, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(5, 2, 290938, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(6, 2, 101973, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(7, 2, 985443, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE IF NOT EXISTS `tbl_product` (
  `productid` bigint(20) NOT NULL AUTO_INCREMENT,
  `productname` varchar(255) DEFAULT NULL,
  `productrate` varchar(255) NOT NULL DEFAULT '0',
  `productsize` varchar(255) DEFAULT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `categorytypeid` bigint(20) NOT NULL DEFAULT '0',
  `brandid` bigint(20) NOT NULL DEFAULT '0',
  `adminid` bigint(20) NOT NULL DEFAULT '0',
  `active` varchar(255) NOT NULL DEFAULT 'active',
  `createdat` datetime DEFAULT NULL,
  PRIMARY KEY (`productid`),
  UNIQUE KEY `barcode` (`barcode`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`productid`, `productname`, `productrate`, `productsize`, `barcode`, `categorytypeid`, `brandid`, `adminid`, `active`, `createdat`) VALUES
(1, 'full hand shirt', '120', '3', 'full1001', 2, 2, 7, 'active', '2016-09-03 23:06:47');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_productMapping`
--

INSERT INTO `tbl_productMapping` (`id`, `productId`, `showroomId`, `price`, `quantity`, `adminId`, `createAt`) VALUES
(1, '1', 8, 130, 10, 7, '2016-09-03');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_returnProduct`
--

CREATE TABLE IF NOT EXISTS `tbl_returnProduct` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oldReceipt` int(11) DEFAULT NULL,
  `newReceipt` int(11) DEFAULT NULL,
  `productId` int(11) DEFAULT NULL,
  `reduceCount` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sizemaster`
--

CREATE TABLE IF NOT EXISTS `tbl_sizemaster` (
  `sizeid` int(11) NOT NULL AUTO_INCREMENT,
  `size` varchar(200) DEFAULT NULL,
  `adminId` int(11) DEFAULT NULL,
  `active` varchar(200) DEFAULT 'active',
  `createdAt` date DEFAULT NULL,
  PRIMARY KEY (`sizeid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_sizemaster`
--

INSERT INTO `tbl_sizemaster` (`sizeid`, `size`, `adminId`, `active`, `createdAt`) VALUES
(1, 'XL', 7, 'active', '2016-09-03'),
(2, 'S', 7, 'active', '2016-09-03'),
(3, 'L', 7, 'active', '2016-09-03');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`userid`, `name`, `email`, `password`, `usertypeid`, `adminid`, `retailerShowRoomId`, `mobile`, `address`, `doj`, `dob`, `active`, `lastlogin`, `createdat`) VALUES
(1, 'superadmin', 'superadmin@gmail.com', '1234', 1, 0, 0, '8344798628', '107, west street, Ammaiyappan, Thiruvarur.', '0000-00-00', '0000-00-00', 'active', '2016-09-05 08:09:44', NULL),
(2, 'mathan', 'mathanaiht@gmail.com', '1234', 2, 0, 0, '83446576575', 'ddsdsfsadfd ddf dsfsafasd', '0000-00-00', '0000-00-00', 'active', NULL, '2016-09-03 14:07:25'),
(3, 'mathansr', 'mathansr@gmail.com', NULL, 3, 2, 0, '656575656575', 'dsihjdfh jhdfjhds hdsfdhj dfjhjdsfh', '0000-00-00', '0000-00-00', 'active', NULL, '2016-09-03 14:08:51'),
(4, 'mathash', 'mathash@gmail.com', '1234', 4, 2, 3, '6576565765', 'dsfdsagdsgdsfg', '2016-09-08', '2016-09-10', 'active', NULL, '2016-09-03 20:08:45'),
(5, 'mathanse', 'mathanse@gmail.com', '1234', 5, 2, 3, '6565656756', 'fgfgfgfhg fgfg gfgf tytytytyuyiyy', '2016-09-07', '2016-09-14', 'active', NULL, '2016-09-03 20:11:19'),
(6, 'mathanse1', 'mathanse1@gmail.com', '12345', 5, 2, 3, '56454545456', 'ok', '2016-09-01', '2016-09-07', 'active', NULL, '2016-09-03 20:14:58'),
(7, 'manoj', 'manoj@gmail.com', '1234', 2, 0, 0, '56756567', 'chennai', '2016-09-20', '2016-09-23', 'active', '2016-09-05 17:09:22', '2016-09-03 21:23:33'),
(8, 'manojsr', 'manojsr@gmail.com', NULL, 3, 7, 0, '6567576', 'jkdhsfj jhgdj', '0000-00-00', '0000-00-00', 'active', NULL, '2016-09-03 21:25:45'),
(9, 'manojsh', 'manojsh@gmail.com', '1234', 4, 7, 8, '656575656757', 'yes', '2016-09-09', '2016-09-10', 'active', '2016-09-03 23:09:44', '2016-09-03 21:27:36'),
(10, 'manojse', 'manojse@gmail.com', '1234', 5, 7, 8, '6567565656567', 'success', '2016-09-15', '2016-09-16', 'active', NULL, '2016-09-03 21:28:52');

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
(1, 'Super Admin', 'Frontend/adminMaster', 'active', '2016-07-23 00:00:00'),
(2, 'Admin', 'Product/ProductMaster', 'active', '2016-07-23 00:00:00'),
(3, 'Retailer Show Room', '0', 'active', '2016-07-23 00:00:00'),
(4, 'Sales Head', 'sales/pos', 'active', '2016-07-23 00:00:00'),
(5, 'Sales Executive', 'sales/pos', 'active', '2016-07-23 00:00:00'),
(6, 'Seller', '0', 'active', '2016-07-23 00:00:00'),
(7, 'Delivery Person', '0', 'active', '2016-07-23 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
