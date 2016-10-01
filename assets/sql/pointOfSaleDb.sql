-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 01, 2016 at 09:59 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`brandid`, `brandname`, `adminid`, `active`, `createdat`) VALUES
(1, 'Jokey', 7, 'active', '2016-09-03 22:50:45'),
(2, 'Ramraj', 7, 'active', '2016-09-03 22:50:56'),
(3, 'testbrand', 7, 'deleted', '2016-09-03 22:51:08'),
(4, 'ramraj', 2, 'active', '2016-09-10 07:49:03');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_categorytype`
--

INSERT INTO `tbl_categorytype` (`categorytypeid`, `categorytype`, `adminId`, `active`, `createdAt`) VALUES
(1, 'Pant', 7, 'active', '2016-09-03'),
(2, 'Shirt', 7, 'active', '2016-09-03'),
(3, 'underwear', 7, 'active', '2016-09-03'),
(4, 'test', 7, 'deleted', '2016-09-03'),
(5, 'testpant', 7, 'active', '2016-09-10'),
(6, 'paniyan12', 2, 'active', '2016-09-10'),
(7, 'jutty1', 2, 'active', '2016-09-10');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `usedAt` datetime DEFAULT NULL,
  `active` varchar(255) DEFAULT 'active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_forgotPasswordRequest`
--

INSERT INTO `tbl_forgotPasswordRequest` (`id`, `userid`, `otp`, `createdAt`, `expiryDate`, `usedAt`, `active`) VALUES
(1, 2, 131698, '2016-09-25 08:05:35', '2016-09-25 20:05:35', '2016-09-25 08:25:26', 'used'),
(2, 2, 998861, '2016-09-25 08:26:25', '2016-09-25 20:26:25', '2016-09-25 08:31:52', 'used');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE IF NOT EXISTS `tbl_product` (
  `productid` bigint(20) NOT NULL AUTO_INCREMENT,
  `productname` varchar(255) DEFAULT NULL,
  `productrate` varchar(255) NOT NULL DEFAULT '0',
  `productsize` varchar(255) DEFAULT '0',
  `barcode` varchar(255) DEFAULT NULL,
  `categorytypeid` bigint(20) NOT NULL DEFAULT '0',
  `brandid` bigint(20) NOT NULL DEFAULT '0',
  `adminid` bigint(20) NOT NULL DEFAULT '0',
  `active` varchar(255) NOT NULL DEFAULT 'active',
  `createdat` datetime DEFAULT NULL,
  PRIMARY KEY (`productid`),
  UNIQUE KEY `barcode` (`barcode`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`productid`, `productname`, `productrate`, `productsize`, `barcode`, `categorytypeid`, `brandid`, `adminid`, `active`, `createdat`) VALUES
(1, 'full hand shirt', '140', '1', 'full1001', 2, 1, 7, 'active', '2016-09-03 23:06:47'),
(2, 'tshirt', '167', '2', '123300', 3, 0, 7, 'active', '2016-09-07 21:30:55'),
(3, 'j', '166', '4', '12233', 7, 4, 2, 'active', '2016-09-10 07:51:34'),
(4, 'testpant1', '243', '', '65766551', 5, 0, 7, 'active', '2016-09-24 22:49:46'),
(5, 'jutty', '179', '4', '10001', 7, 4, 2, 'active', '2016-09-25 08:41:05'),
(6, 'skc jutty', '1236', '', '123456', 7, 0, 2, 'active', '2016-10-01 20:44:20'),
(7, 'uk paniyan', '156', '4', '12244', 6, 4, 2, 'active', '2016-10-01 20:47:09');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_productBatch`
--

CREATE TABLE IF NOT EXISTS `tbl_productBatch` (
  `id` bigint(25) NOT NULL AUTO_INCREMENT,
  `productid` bigint(25) NOT NULL,
  `showRoomId` bigint(25) NOT NULL,
  `supplierId` bigint(25) NOT NULL DEFAULT '0',
  `adminId` bigint(25) NOT NULL,
  `quantity` bigint(20) NOT NULL DEFAULT '0',
  `batchNumber` varchar(255) DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT NULL,
  `active` varchar(255) NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `tbl_productBatch`
--

INSERT INTO `tbl_productBatch` (`id`, `productid`, `showRoomId`, `supplierId`, `adminId`, `quantity`, `batchNumber`, `createdAt`, `active`) VALUES
(1, 5, 3, 0, 2, 5, NULL, '2016-10-01 15:03:57', 'active'),
(2, 5, 18, 0, 2, 3, NULL, '2016-10-01 15:03:57', 'active'),
(3, 5, 3, 0, 2, 6, NULL, '2016-10-01 15:05:35', 'active'),
(4, 5, 18, 0, 2, 10, NULL, '2016-10-01 15:05:35', 'active'),
(5, 3, 3, 0, 2, 3, NULL, '2016-10-01 15:06:57', 'active'),
(6, 3, 18, 0, 2, 2, NULL, '2016-10-01 15:06:57', 'active'),
(7, 6, 3, 0, 2, 1, NULL, '2016-10-01 15:16:07', 'active'),
(8, 6, 18, 0, 2, 2, NULL, '2016-10-01 15:16:07', 'active'),
(9, 7, 3, 0, 2, 4, NULL, '2016-10-01 15:17:09', 'active'),
(10, 7, 18, 0, 2, 5, NULL, '2016-10-01 15:17:09', 'active'),
(11, 6, 3, 0, 2, 3, NULL, '2016-10-01 15:18:00', 'active'),
(12, 3, 3, 0, 2, 3, NULL, '2016-10-01 16:16:22', 'active'),
(13, 3, 18, 0, 2, 4, NULL, '2016-10-01 16:16:22', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_productMapping`
--

CREATE TABLE IF NOT EXISTS `tbl_productMapping` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productId` varchar(200) DEFAULT NULL,
  `showroomId` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `adminId` int(11) DEFAULT NULL,
  `createAt` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `tbl_productMapping`
--

INSERT INTO `tbl_productMapping` (`id`, `productId`, `showroomId`, `price`, `adminId`, `createAt`) VALUES
(1, '1', 8, 170, 7, '2016-09-03'),
(2, '2', 8, 172, 7, '2016-09-07'),
(3, '1', 17, 55, 7, '2016-09-18'),
(4, '4', 17, 245, 7, '2016-09-24'),
(5, '4', 8, 244, 7, '2016-09-24'),
(6, '5', 3, 183, 2, '2016-09-25'),
(7, '5', 18, 185, 2, '2016-09-25'),
(8, '3', 3, 167, 2, '2016-09-26'),
(9, '3', 18, 169, 2, '2016-10-01'),
(10, '6', 3, 1239, 2, '2016-10-01'),
(11, '6', 18, 1238, 2, '2016-10-01'),
(12, '7', 3, 157, 2, '2016-10-01'),
(13, '7', 18, 158, 2, '2016-10-01');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_sizemaster`
--

INSERT INTO `tbl_sizemaster` (`sizeid`, `size`, `adminId`, `active`, `createdAt`) VALUES
(1, 'XL', 7, 'active', '2016-09-03'),
(2, 'S', 7, 'active', '2016-09-03'),
(3, 'L', 7, 'active', '2016-09-03'),
(4, 'xL', 2, 'active', '2016-09-10');

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
  `tinnumber` varchar(255) DEFAULT NULL,
  `cinnumber` varchar(255) DEFAULT NULL,
  `creditdays` varchar(255) DEFAULT NULL,
  `active` varchar(255) NOT NULL DEFAULT 'active',
  `lastlogin` datetime DEFAULT NULL,
  `createdat` datetime DEFAULT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`userid`, `name`, `email`, `password`, `usertypeid`, `adminid`, `retailerShowRoomId`, `mobile`, `address`, `doj`, `dob`, `tinnumber`, `cinnumber`, `creditdays`, `active`, `lastlogin`, `createdat`) VALUES
(1, 'superadmin', 'superadmin@gmail.com', '1234', 1, 0, 0, '8344798628', '107, west street, Ammaiyappan, Thiruvarur.', '0000-00-00', '0000-00-00', NULL, NULL, NULL, 'active', '2016-09-24 21:09:04', NULL),
(2, 'mathan', 'mathanaiht@gmail.com', '12345678', 2, 0, 0, '83446576575', 'ddsdsfsadfd ddf dsfsafasd', '0000-00-00', '0000-00-00', NULL, NULL, NULL, 'active', '2016-10-01 21:10:23', '2016-09-03 14:07:25'),
(3, 'mathankumarsr', 'mathansr@gmail.com', NULL, 3, 2, 0, '656575656575', 'dsihjdfh jhdfjhds hdsfdhj dfjhjdsfh', '0000-00-00', '0000-00-00', NULL, NULL, NULL, 'active', NULL, '2016-09-03 14:08:51'),
(4, 'mathash', 'mathash@gmail.com', '1234', 4, 2, 3, '6576565765', 'dsfdsagdsgdsfg', '2016-09-08', '2016-09-10', NULL, NULL, NULL, 'active', '2016-10-01 21:10:45', '2016-09-03 20:08:45'),
(5, 'mathanse', 'mathanse@gmail.com', '1234', 5, 2, 3, '6565656756', 'fgfgfgfhg fgfg gfgf tytytytyuyiyy', '2016-09-07', '2016-09-14', NULL, NULL, NULL, 'active', NULL, '2016-09-03 20:11:19'),
(6, 'mathanse1', 'mathanse1@gmail.com', '12345', 5, 2, 3, '56454545456', 'ok', '2016-09-01', '2016-09-07', NULL, NULL, NULL, 'active', NULL, '2016-09-03 20:14:58'),
(7, 'manoj', 'manoj@gmail.com', '1234', 2, 0, 0, '56756567', 'chennai', '2016-09-20', '2016-09-23', NULL, NULL, NULL, 'active', '2016-09-25 13:09:33', '2016-09-03 21:23:33'),
(8, 'manojsr', 'manojsr@gmail.com', NULL, 3, 7, 0, '6567576', 'jkdhsfj jhgdj', '0000-00-00', '0000-00-00', NULL, NULL, NULL, 'active', NULL, '2016-09-03 21:25:45'),
(9, 'manojsh', 'manojsh@gmail.com', '1234', 4, 7, 8, '656575656757', 'yes', '2016-09-09', '2016-09-10', NULL, NULL, NULL, 'active', '2016-09-25 22:09:22', '2016-09-03 21:27:36'),
(10, 'manojse', 'manojse@gmail.com', '1234', 5, 7, 8, '6567565656567', 'success', '2016-09-15', '2016-09-16', NULL, NULL, NULL, 'active', '2016-09-07 21:09:46', '2016-09-03 21:28:52'),
(11, 'manojsupplier', 'manojsupplier@gmail.com', '1234', 6, 7, 0, '8681234567', 'chennai-98, testaddress', '0000-00-00', '0000-00-00', NULL, NULL, NULL, 'active', NULL, '2016-09-18 07:18:15'),
(12, 'mathansupplier', 'mhghjjhh@gmail.com', NULL, 6, 7, 0, '86876656756', 'on, 7656, secnd strretet,', '0000-00-00', '0000-00-00', NULL, NULL, NULL, 'active', NULL, '2016-09-18 07:24:03'),
(13, 'nnn', 'bjhgjh2jjkfg@.in', NULL, 6, 2, 0, '766687687686', 'ghjksdfjk,\r\nsadfgfg\r\nsdfusdgfhsd,\r\nsdfsadg.', '0000-00-00', '0000-00-00', NULL, NULL, NULL, 'active', NULL, '2016-09-18 08:13:32'),
(14, 'supplier1', 'jhgjhgj@ghdfgjf.in', NULL, 6, 7, 0, '675675675675', 'gdfghj', '0000-00-00', '0000-00-00', '333333333333333', '444444444444444444', '12', 'active', NULL, '2016-09-18 08:38:19'),
(15, 'sdfasdag', 'rfasfasg@hfgjh.in', NULL, 6, 7, 0, '34242135', 'dfgvsdfg', '0000-00-00', '0000-00-00', '3543245657567', NULL, '35', 'deleted', NULL, '2016-09-18 08:58:56'),
(16, 'testsupplier', 'jdfgdgjh@hjdsgfj.in', NULL, 6, 7, 0, '656756757', 'dfgdsfgds', '0000-00-00', '0000-00-00', '455678', '78533', '234', 'active', NULL, '2016-09-18 09:01:05'),
(17, 'manojsr1', 'manojsr1@gmail.com', NULL, 3, 7, 0, '565656576655', 'ytyrtrytr,\r\njhdgfgh,\r\nfhjkhjkh jgfjhgfhj,\r\ndjfjfgh ,\r\nsyysyuuy', '0000-00-00', '0000-00-00', '56454545465', '564564564', NULL, 'active', NULL, '2016-09-18 17:39:55'),
(18, 'mathansr2', 'mathansr2@gmail.com', NULL, 3, 2, 0, '8344798628', 'chennai,\r\nfirt str,\r\nTN', '0000-00-00', '0000-00-00', '6778966', '767678989', NULL, 'active', NULL, '2016-09-25 08:42:06');

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
(6, 'Supplier', '0', 'active', '2016-07-23 00:00:00'),
(7, 'Delivery Person', '0', 'active', '2016-07-23 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
