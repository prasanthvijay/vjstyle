-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 23, 2016 at 02:21 PM
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
-- Table structure for table `tbl_customerreceipt`
--

CREATE TABLE IF NOT EXISTS `tbl_customerreceipt` (
  `receiptid` bigint(20) NOT NULL AUTO_INCREMENT,
  `receiptnumber` varchar(255) NOT NULL,
  `subtotalamount` varchar(255) NOT NULL DEFAULT '0',
  `vatpercentage` varchar(255) NOT NULL DEFAULT '0',
  `taxpercentage` varchar(255) NOT NULL DEFAULT '0',
  `vatamount` varchar(255) NOT NULL DEFAULT '0',
  `taxamount` varchar(255) NOT NULL DEFAULT '0',
  `totalamount` varchar(255) NOT NULL DEFAULT '0',
  `salesdonebytypeid` bigint(20) NOT NULL,
  `salesdoneby` bigint(20) NOT NULL,
  `adminid` bigint(20) NOT NULL,
  `active` varchar(255) NOT NULL DEFAULT 'active',
  `createdat` datetime DEFAULT NULL,
  PRIMARY KEY (`receiptid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_customerreceipt`
--

INSERT INTO `tbl_customerreceipt` (`receiptid`, `receiptnumber`, `subtotalamount`, `vatpercentage`, `taxpercentage`, `vatamount`, `taxamount`, `totalamount`, `salesdonebytypeid`, `salesdoneby`, `adminid`, `active`, `createdat`) VALUES
(1, '', '0', '0', '0', '0', '0', '0', 0, 0, 0, 'active', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customerreceiptitems`
--

CREATE TABLE IF NOT EXISTS `tbl_customerreceiptitems` (
  `receiptitemsid` bigint(20) NOT NULL AUTO_INCREMENT,
  `receiptid` bigint(20) NOT NULL,
  `productid` bigint(20) NOT NULL,
  `productname` varchar(255) DEFAULT NULL,
  `productamount` varchar(255) NOT NULL DEFAULT '0',
  `discountpercentage` varchar(255) NOT NULL DEFAULT '0',
  `discountamount` varchar(255) NOT NULL DEFAULT '0',
  `finalamount` varchar(255) NOT NULL DEFAULT '0',
  `adminid` bigint(20) NOT NULL,
  `active` varchar(255) NOT NULL DEFAULT 'active',
  `createdat` datetime DEFAULT NULL,
  PRIMARY KEY (`receiptitemsid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_customerreceiptitems`
--

INSERT INTO `tbl_customerreceiptitems` (`receiptitemsid`, `receiptid`, `productid`, `productname`, `productamount`, `discountpercentage`, `discountamount`, `finalamount`, `adminid`, `active`, `createdat`) VALUES
(1, 0, 0, '', '0', '0', '0', '0', 0, 'active', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE IF NOT EXISTS `tbl_product` (
  `productid` bigint(20) NOT NULL AUTO_INCREMENT,
  `productname` varchar(255) DEFAULT NULL,
  `productrate` varchar(255) NOT NULL DEFAULT '0',
  `availablequantity` varchar(255) NOT NULL DEFAULT '0',
  `barcode` varchar(255) DEFAULT NULL,
  `categorytypeid` bigint(20) NOT NULL DEFAULT '0',
  `brandid` bigint(20) NOT NULL DEFAULT '0',
  `adminid` bigint(20) NOT NULL DEFAULT '0',
  `active` varchar(255) NOT NULL DEFAULT 'active',
  `createdat` datetime DEFAULT NULL,
  PRIMARY KEY (`productid`),
  UNIQUE KEY `barcode` (`barcode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `mobile` varchar(255) DEFAULT NULL,
  `address` text,
  `doj` date DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `active` varchar(255) NOT NULL DEFAULT 'active',
  `lastlogin` datetime DEFAULT NULL,
  `createdat` datetime DEFAULT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`userid`, `name`, `email`, `password`, `usertypeid`, `adminid`, `mobile`, `address`, `doj`, `dob`, `active`, `lastlogin`, `createdat`) VALUES
(1, 'superadmin', 'superadmin@gmail.com', '1234', 1, 0, '8344798628', '107 west street, ammaiyappan, thiruvarur, Tamil Nadu', NULL, NULL, 'active', NULL, '2016-07-23 00:00:00'),
(2, 'posadmin1', 'posadmin1@gmail.com', '1234', 2, 1, '8124356981', '102 chennai', NULL, NULL, 'active', NULL, '2016-07-23 19:21:27');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_usertype`
--

INSERT INTO `tbl_usertype` (`usertypeid`, `usertype`, `redirecturl`, `active`, `createdat`) VALUES
(1, 'Super Admin', '0', 'active', '2016-07-23 00:00:00'),
(2, 'Admin', '0', 'active', '2016-07-23 00:00:00'),
(3, 'Seller', '0', 'active', '2016-07-23 00:00:00'),
(4, 'Retailer Show Room', '0', 'active', '2016-07-23 00:00:00'),
(5, 'Sales Executive', '0', 'active', '2016-07-23 00:00:00'),
(6, 'Delivery Person', '0', 'active', '2016-07-23 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;