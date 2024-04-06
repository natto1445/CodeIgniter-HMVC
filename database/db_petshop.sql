-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 06, 2024 at 04:13 AM
-- Server version: 5.7.40
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_petshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bank`
--

DROP TABLE IF EXISTS `tbl_bank`;
CREATE TABLE IF NOT EXISTS `tbl_bank` (
  `bank_id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_branch` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_owner` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_status` int(11) DEFAULT NULL,
  `bank_pic` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `user_create` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`bank_id`),
  UNIQUE KEY `bank_code` (`bank_code`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_bank`
--

INSERT INTO `tbl_bank` (`bank_id`, `bank_code`, `bank_name`, `bank_branch`, `bank_owner`, `bank_status`, `bank_pic`, `date_create`, `user_create`) VALUES
(1, '000-00-00-000', 'กรุงไทย', 'เดอะมอล บางกะปิ', 'ณัฐนนท์ ศรีทนนาง', 1, 'bank07133407.png', '2024-02-05 12:19:44', '0000000001'),
(2, '111-11-11-111', 'กสิกรไทย', 'เดอะมอล บางกะปิ', 'ณัฐนนท์ ศรีทนนาง', 1, 'bank07133246.png', '2024-02-05 12:19:59', '0000000001'),
(5, '222-22-22-222', 'กรุงเทพ', 'เดอะมอล บางกะปิ', 'ณัฐนนท์ ศรีทนนาง', 1, 'bank07133238.jpg', '2024-02-07 13:12:59', '0000000001');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_delivery_order`
--

DROP TABLE IF EXISTS `tbl_delivery_order`;
CREATE TABLE IF NOT EXISTS `tbl_delivery_order` (
  `delivery_id` int(11) NOT NULL AUTO_INCREMENT,
  `delivery_order` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `delivery_tracking` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `delivery_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `delivery_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `delivery_tel` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `delivery_date` datetime DEFAULT NULL,
  `delivery_send` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `delivery_pic` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `delivery_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`delivery_id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_delivery_order`
--

INSERT INTO `tbl_delivery_order` (`delivery_id`, `delivery_order`, `delivery_tracking`, `delivery_name`, `delivery_address`, `delivery_tel`, `delivery_date`, `delivery_send`, `delivery_pic`, `delivery_status`) VALUES
(26, 'ODO0000072', NULL, 'asd', 'asd', 'asd', NULL, NULL, NULL, NULL),
(25, 'ODO0000071', NULL, 'asd', 'asd', 'asd', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

DROP TABLE IF EXISTS `tbl_order`;
CREATE TABLE IF NOT EXISTS `tbl_order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_no` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_type` int(11) DEFAULT NULL,
  `user_order` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_order` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_order` datetime DEFAULT NULL,
  `total_order` float(10,2) DEFAULT NULL,
  `discount_order` float(10,2) DEFAULT NULL,
  `use_point_order` int(11) DEFAULT NULL,
  `slip_order` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status_order` int(11) DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=74 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`order_id`, `order_no`, `order_type`, `user_order`, `customer_order`, `date_order`, `total_order`, `discount_order`, `use_point_order`, `slip_order`, `status_order`) VALUES
(73, 'ODF0000073', 1, '0000000001', '0000000020', '2024-04-06 03:52:41', 475.00, 0.00, 0, NULL, 99),
(71, 'ODO0000071', 2, NULL, '0000000001', '2024-04-06 03:45:17', 47.50, 0.00, 0, 'slip_20240406_ODO0000071.jpg', 2),
(72, 'ODO0000072', 2, NULL, '0000000001', '2024-04-06 03:45:49', 95.00, 0.00, 0, 'slip_20240406_ODO0000072.jpg', 2),
(70, 'ODF0000070', 1, '0000000001', '0000000020', '2024-04-06 03:44:07', 47.50, 0.00, 0, NULL, 99),
(69, 'ODF0000001', 1, '0000000001', '0000000020', '2024-04-06 03:43:25', 57.00, 0.00, 0, NULL, 99);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_detail`
--

DROP TABLE IF EXISTS `tbl_order_detail`;
CREATE TABLE IF NOT EXISTS `tbl_order_detail` (
  `detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_no` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `num_product` int(11) DEFAULT NULL,
  `cost_product` float(10,2) DEFAULT NULL,
  `price_product` float(10,2) DEFAULT NULL,
  `discount_product` float(10,2) DEFAULT NULL,
  `status_detail` int(11) DEFAULT NULL,
  PRIMARY KEY (`detail_id`)
) ENGINE=MyISAM AUTO_INCREMENT=81 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_order_detail`
--

INSERT INTO `tbl_order_detail` (`detail_id`, `order_no`, `product_code`, `num_product`, `cost_product`, `price_product`, `discount_product`, `status_detail`) VALUES
(76, 'ODF0000001', 'ba001', 1, 50.00, 60.00, 3.00, 1),
(77, 'ODF0000070', 'ba001', 1, 40.00, 50.00, 2.50, 1),
(78, 'ODO0000071', 'ba001', 1, 40.00, 50.00, 2.50, 1),
(79, 'ODO0000072', 'ba001', 1, 20.00, 100.00, 5.00, 1),
(80, 'ODF0000073', 'ba001', 5, 20.00, 100.00, 5.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

DROP TABLE IF EXISTS `tbl_product`;
CREATE TABLE IF NOT EXISTS `tbl_product` (
  `id_product` int(11) NOT NULL AUTO_INCREMENT,
  `product_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_product` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `num` int(11) DEFAULT NULL,
  `minstock` int(11) DEFAULT NULL,
  `cost` float(10,2) DEFAULT NULL,
  `price` float(10,2) DEFAULT NULL,
  `discount_per` float(10,2) DEFAULT NULL,
  `discount_bath` float(10,2) DEFAULT NULL,
  `unit` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `detail` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status_product` int(11) DEFAULT NULL,
  `pic_product` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `date_exp` datetime DEFAULT NULL,
  `user_create` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_product`),
  KEY `fk_product_code` (`product_code`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id_product`, `product_code`, `name_product`, `code_type`, `num`, `minstock`, `cost`, `price`, `discount_per`, `discount_bath`, `unit`, `detail`, `status_product`, `pic_product`, `date_create`, `date_exp`, `user_create`) VALUES
(20, 'ba001', 'barcode001', 'T0001', 91, 10, 20.00, 100.00, 5.00, 5.00, 'ชิ้น', '', 1, '', '2024-04-06 03:39:10', '2024-04-20 00:00:00', '0000000001');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_store`
--

DROP TABLE IF EXISTS `tbl_store`;
CREATE TABLE IF NOT EXISTS `tbl_store` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `store_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `store_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `store_logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `store_tel` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `point` float DEFAULT NULL,
  `ppoint` float DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `user_create` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `store_code` (`store_code`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_store`
--

INSERT INTO `tbl_store` (`id`, `store_code`, `store_name`, `store_address`, `store_logo`, `store_tel`, `point`, `ppoint`, `date_create`, `user_create`) VALUES
(2, 'S00001', 'ร้าน petshop', 'เพชรบูรณ์', 'logo05151429.png', '0000000000', 50, 1, '2024-03-02 15:08:30', '0000000001');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_type_product`
--

DROP TABLE IF EXISTS `tbl_type_product`;
CREATE TABLE IF NOT EXISTS `tbl_type_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_create` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date_edit` datetime DEFAULT NULL,
  `user_create` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_edit` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code_type` (`code_type`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_type_product`
--

INSERT INTO `tbl_type_product` (`id`, `code_type`, `name_type`, `status`, `date_create`, `date_edit`, `user_create`, `user_edit`) VALUES
(1, 'T0001', 'อาหาร', '1', '2024-01-26 15:22:41', '2024-01-27 04:11:00', '0000000001', ''),
(2, 'T0002', 'ของใช้', '1', '2024-01-26 08:48:20', NULL, '', ''),
(6, 'T0005', 'ของเล่น', '1', '2024-01-26 09:33:32', NULL, '', ''),
(4, 'T0004', 'เสื้อผ้า', '1', '2024-01-26 08:49:07', NULL, '', ''),
(7, 'T0007', 'กระเป๋า', '1', '2024-01-26 09:34:03', NULL, '', ''),
(8, 'T0008', 'ยารักษาโรค', '1', '2024-01-26 09:34:07', NULL, '', ''),
(9, 'T0009', 'อื่นๆ', '2', '2024-01-28 00:29:21', '2024-01-28 07:29:45', '0000000001', '0000000001');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usr_id` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usr_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usr_fname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usr_lname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usr_mail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usr_tel` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usr_password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usr_point` int(11) DEFAULT NULL,
  `date_time_create` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `usr_id` (`usr_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `usr_id`, `usr_name`, `usr_fname`, `usr_lname`, `usr_mail`, `usr_tel`, `usr_password`, `auth`, `usr_point`, `date_time_create`) VALUES
(1, '0000000001', 'admin', 'natthanon', 'sritonnang', 'admin@gmail.com', '0123456789', '1234', '9', 102, '2024-01-03 13:14:26'),
(2, '0000000002', 'customer', 'customer', 'customer', 'customer@gmail.com', '9876543210', '1234', '1', 14, '2024-01-07 06:28:54'),
(20, '0000000020', 'no', 'ไม่ระบุ', 'ไม่ระบุ', 'no@gmail.com', '0999999999', '1234', '1', 304, '2024-03-01 07:38:58'),
(3, '0000000003', 'employee', 'employee', 'employee', 'employee@gmail.com', '0888888888', '1234', '5', 10, '2024-01-07 07:38:26'),
(18, '0000000015', 'shopee', 'shopee', 'shopee', 'shopee@gmail.com', '9999999999', '1234', '1', 38, '2024-03-01 07:36:33');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
