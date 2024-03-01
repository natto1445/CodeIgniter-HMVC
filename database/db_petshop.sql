-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 01, 2024 at 02:56 PM
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
(1, '030-33-11-405', 'กรุงไทย', 'เดอะมอล บางกะปิ', 'ณัฐนนท์ ศรีทนนาง', 1, 'bank07133407.png', '2024-02-05 12:19:44', '0000000001'),
(2, '030-33-11-408', 'กสิกรไทย', 'เดอะมอล บางกะปิ', 'ณัฐนนท์ ศรีทนนาง', 1, 'bank07133246.png', '2024-02-05 12:19:59', '0000000001'),
(5, '030-33-11-406', 'กรุงเทพ', 'เดอะมอล บางกะปิ', 'ณัฐนนท์ ศรีทนนาง', 2, 'bank07133238.jpg', '2024-02-07 13:12:59', '0000000001');

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
  `delivery_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`delivery_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_delivery_order`
--

INSERT INTO `tbl_delivery_order` (`delivery_id`, `delivery_order`, `delivery_tracking`, `delivery_name`, `delivery_address`, `delivery_tel`, `delivery_date`, `delivery_send`, `delivery_status`) VALUES
(1, 'ODO0000009', NULL, 'test', 'test', '0000000000', NULL, NULL, NULL),
(2, 'ODO0000011', NULL, 'aaaa', 'sdadasdsad', '0000000000', NULL, NULL, NULL),
(3, 'ODO0000012', NULL, 'aaaa', 'aaaaaaaaaaaaaaaa', '555555', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

DROP TABLE IF EXISTS `tbl_order`;
CREATE TABLE IF NOT EXISTS `tbl_order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_no` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_type` int(1) DEFAULT NULL,
  `user_order` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_order` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_order` datetime DEFAULT NULL,
  `total_order` float(10,2) DEFAULT NULL,
  `discount_order` float(10,2) DEFAULT NULL,
  `status_order` int(1) DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`order_id`, `order_no`, `order_type`, `user_order`, `customer_order`, `date_order`, `total_order`, `discount_order`, `status_order`) VALUES
(1, 'ODO0000001', 1, '0000000001', NULL, '2024-02-09 00:00:00', 1.00, 0.00, 99),
(2, 'ODO0000002', 1, '0000000001', NULL, '2024-02-09 00:00:00', 1.00, 100.00, 99),
(3, 'ODO0000003', 1, '0000000001', NULL, '2024-02-09 00:00:00', 1.00, 50.00, 99),
(4, 'ODO0000004', 1, '0000000001', NULL, '2024-02-09 13:47:03', 7145.00, 0.00, 99),
(5, 'ODO0000005', 1, '0000000001', NULL, '2024-02-09 13:47:34', 2205.00, 100.00, 99),
(6, 'ODF0000006', 1, '0000000001', NULL, '2024-02-09 14:03:17', 16965.00, 100.00, 99),
(7, 'ODF0000007', 1, '0000000001', NULL, '2024-02-10 07:47:06', 3410.00, 50.00, 99),
(8, 'ODO0000008', 2, NULL, '0000000001', '2024-02-18 11:57:22', 1080.00, 0.00, 1),
(9, 'ODO0000009', 2, NULL, '0000000001', '2024-02-18 12:16:21', 1225.00, 0.00, 2),
(10, 'ODF0000010', 1, '0000000001', NULL, '2024-02-23 05:50:36', 3100.00, 100.00, 99),
(11, 'ODO0000011', 2, NULL, '0000000001', '2024-02-24 08:04:46', 2450.00, 0.00, 1),
(12, 'ODO0000012', 2, NULL, '0000000001', '2024-02-25 04:19:26', 2950.00, 0.00, 1),
(13, 'ODF0000013', 1, '0000000001', NULL, '2024-02-25 04:21:25', 2830.00, 30.00, 99),
(14, 'ODF0000014', 1, '0000000001', NULL, '2024-02-25 04:47:36', 1080.00, 0.00, 99);

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
  `price_product` float(10,2) DEFAULT NULL,
  `discount_product` float(10,2) DEFAULT NULL,
  `status_detail` int(1) DEFAULT NULL,
  PRIMARY KEY (`detail_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_order_detail`
--

INSERT INTO `tbl_order_detail` (`detail_id`, `order_no`, `product_code`, `num_product`, `price_product`, `discount_product`, `status_detail`) VALUES
(1, 'ODF0000006', 'P00002', 5, 250.00, 5.00, 1),
(2, 'ODF0000006', 'P00005', 10, 400.00, 20.00, 1),
(3, 'ODF0000006', 'P00011', 12, 1000.00, 5.00, 1),
(4, 'ODF0000007', 'P00002', 4, 250.00, 5.00, 1),
(5, 'ODF0000007', 'P00003', 4, 300.00, 5.00, 1),
(6, 'ODF0000007', 'P00005', 2, 400.00, 20.00, 1),
(7, 'ODF0000007', 'P00006', 2, 250.00, 5.00, 1),
(8, 'ODO0000008', 'P00002', 2, 250.00, 5.00, 1),
(9, 'ODO0000008', 'P00003', 2, 300.00, 5.00, 1),
(10, 'ODO0000009', 'P00002', 5, 250.00, 5.00, 1),
(11, 'ODF0000010', 'P00002', 4, 250.00, 5.00, 1),
(12, 'ODF0000010', 'P00003', 1, 300.00, 5.00, 1),
(13, 'ODF0000010', 'P00004', 5, 250.00, 10.00, 1),
(14, 'ODF0000010', 'P00006', 1, 250.00, 5.00, 1),
(15, 'ODF0000010', 'P00005', 1, 400.00, 20.00, 1),
(16, 'ODO0000011', 'P00002', 10, 250.00, 5.00, 1),
(17, 'ODO0000012', 'P00003', 10, 300.00, 5.00, 1),
(18, 'ODF0000013', 'P00002', 5, 250.00, 5.00, 1),
(19, 'ODF0000013', 'P00003', 3, 300.00, 5.00, 1),
(20, 'ODF0000013', 'P00004', 3, 250.00, 10.00, 1),
(21, 'ODF0000014', 'P00002', 2, 250.00, 5.00, 1),
(22, 'ODF0000014', 'P00003', 2, 300.00, 5.00, 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id_product`, `product_code`, `name_product`, `code_type`, `num`, `minstock`, `cost`, `price`, `discount_per`, `discount_bath`, `unit`, `detail`, `status_product`, `pic_product`, `date_create`, `date_exp`, `user_create`) VALUES
(1, 'P00001', 'อาหารแมว', 'T0001', 0, 10, 180.00, 100.00, 0.00, 0.00, 'อัน', 'อาหารแมว สมาร์ทฮาร์ท โกลด์ มีส่วนผสมอันดับ 1 คือโปรตีนเน้น ๆ จากเนื้อสัตว์ชนิดเดียว ซึ่งเป็นจุดที่น่าสนใจ เพราะช่วยลดความเสี่ยงการแพ้โปรตีนชนิดอื่นในอาหารแมว ทำให้เจ้าของเลือกได้ง่ายขึ้นว่าสูตรไหนที่เหมาะกับแมวที่ตัวเองเลี้ยง ทุกสูตรไม่มีผลพลอยได้จากสัตว์ปีกป่น แมวแพ้ไก่ทานได้ ไม่ต้องกังวลพลิกฉลากไปมา แถมไม่มีข้าวโพด ไม่มีการแต่งกลิ่นหรือสีสังเคราะห์ productnation', 1, 'product07144431.jpg', '2024-02-01 15:19:33', '2024-02-28 00:00:00', '0000000001'),
(2, 'P00002', 'อาหารแมว', 'T0002', 100, 10, 180.00, 250.00, 5.00, 5.00, 'ชิ้น', 'อาหารแมว สมาร์ทฮาร์ท โกลด์ มีส่วนผสมอันดับ 1 คือโปรตีนเน้น ๆ จากเนื้อสัตว์ชนิดเดียว ซึ่งเป็นจุดที่น่าสนใจ เพราะช่วยลดความเสี่ยงการแพ้โปรตีนชนิดอื่นในอาหารแมว ทำให้เจ้าของเลือกได้ง่ายขึ้นว่าสูตรไหนที่เหมาะกับแมวที่ตัวเองเลี้ยง ทุกสูตรไม่มีผลพลอยได้จากสัตว์ปีกป่น แมวแพ้ไก่ทานได้ ไม่ต้องกังวลพลิกฉลากไปมา แถมไม่มีข้าวโพด ไม่มีการแต่งกลิ่นหรือสีสังเคราะห์ productnation', 1, 'product07144436.jpg', '2024-02-01 15:20:24', '2024-02-01 00:00:00', '0000000001'),
(3, 'P00003', 'อาหารแมว', 'T0002', 100, 10, 180.00, 300.00, 5.00, 5.00, 'ถุง', 'อาหารแมว สมาร์ทฮาร์ท โกลด์ มีส่วนผสมอันดับ 1 คือโปรตีนเน้น ๆ จากเนื้อสัตว์ชนิดเดียว ซึ่งเป็นจุดที่น่าสนใจ เพราะช่วยลดความเสี่ยงการแพ้โปรตีนชนิดอื่นในอาหารแมว ทำให้เจ้าของเลือกได้ง่ายขึ้นว่าสูตรไหนที่เหมาะกับแมวที่ตัวเองเลี้ยง ทุกสูตรไม่มีผลพลอยได้จากสัตว์ปีกป่น แมวแพ้ไก่ทานได้ ไม่ต้องกังวลพลิกฉลากไปมา แถมไม่มีข้าวโพด ไม่มีการแต่งกลิ่นหรือสีสังเคราะห์ productnation', 1, 'product07144248.jpg', '2024-02-01 15:20:33', '2024-02-01 00:00:00', '0000000001'),
(6, 'P00004', 'อาหารแมว', 'T0005', 100, 10, 180.00, 250.00, 5.00, 10.00, 'ชิ้น', 'อาหารแมว สมาร์ทฮาร์ท โกลด์ มีส่วนผสมอันดับ 1 คือโปรตีนเน้น ๆ จากเนื้อสัตว์ชนิดเดียว ซึ่งเป็นจุดที่น่าสนใจ เพราะช่วยลดความเสี่ยงการแพ้โปรตีนชนิดอื่นในอาหารแมว ทำให้เจ้าของเลือกได้ง่ายขึ้นว่าสูตรไหนที่เหมาะกับแมวที่ตัวเองเลี้ยง ทุกสูตรไม่มีผลพลอยได้จากสัตว์ปีกป่น แมวแพ้ไก่ทานได้ ไม่ต้องกังวลพลิกฉลากไปมา แถมไม่มีข้าวโพด ไม่มีการแต่งกลิ่นหรือสีสังเคราะห์ productnation', 1, NULL, '2024-02-01 15:37:35', '2024-02-29 00:00:00', '0000000001'),
(5, 'P00005', 'อาหารแมว', 'T0004', 100, 10, 180.00, 400.00, 5.00, 20.00, 'ถุง', 'อาหารแมว สมาร์ทฮาร์ท โกลด์ มีส่วนผสมอันดับ 1 คือโปรตีนเน้น ๆ จากเนื้อสัตว์ชนิดเดียว ซึ่งเป็นจุดที่น่าสนใจ เพราะช่วยลดความเสี่ยงการแพ้โปรตีนชนิดอื่นในอาหารแมว ทำให้เจ้าของเลือกได้ง่ายขึ้นว่าสูตรไหนที่เหมาะกับแมวที่ตัวเองเลี้ยง ทุกสูตรไม่มีผลพลอยได้จากสัตว์ปีกป่น แมวแพ้ไก่ทานได้ ไม่ต้องกังวลพลิกฉลากไปมา แถมไม่มีข้าวโพด ไม่มีการแต่งกลิ่นหรือสีสังเคราะห์ productnation', 1, NULL, '2024-02-01 15:21:09', '2024-02-01 15:21:09', '0000000001'),
(7, 'P00006', 'อาหารแมว', 'T0002', 100, 10, 180.00, 250.00, 5.00, 5.00, 'ชิ้น', 'อาหารแมว สมาร์ทฮาร์ท โกลด์ มีส่วนผสมอันดับ 1 คือโปรตีนเน้น ๆ จากเนื้อสัตว์ชนิดเดียว ซึ่งเป็นจุดที่น่าสนใจ เพราะช่วยลดความเสี่ยงการแพ้โปรตีนชนิดอื่นในอาหารแมว ทำให้เจ้าของเลือกได้ง่ายขึ้นว่าสูตรไหนที่เหมาะกับแมวที่ตัวเองเลี้ยง ทุกสูตรไม่มีผลพลอยได้จากสัตว์ปีกป่น แมวแพ้ไก่ทานได้ ไม่ต้องกังวลพลิกฉลากไปมา แถมไม่มีข้าวโพด ไม่มีการแต่งกลิ่นหรือสีสังเคราะห์ productnation', 1, NULL, '2024-02-01 16:07:54', '2024-02-29 00:00:00', '0000000001'),
(8, 'P00007', 'อาหารแมว', 'T0004', 100, 10, 180.00, 500.00, 5.00, 5.00, 'ถุง', 'อาหารแมว สมาร์ทฮาร์ท โกลด์ มีส่วนผสมอันดับ 1 คือโปรตีนเน้น ๆ จากเนื้อสัตว์ชนิดเดียว ซึ่งเป็นจุดที่น่าสนใจ เพราะช่วยลดความเสี่ยงการแพ้โปรตีนชนิดอื่นในอาหารแมว ทำให้เจ้าของเลือกได้ง่ายขึ้นว่าสูตรไหนที่เหมาะกับแมวที่ตัวเองเลี้ยง ทุกสูตรไม่มีผลพลอยได้จากสัตว์ปีกป่น แมวแพ้ไก่ทานได้ ไม่ต้องกังวลพลิกฉลากไปมา แถมไม่มีข้าวโพด ไม่มีการแต่งกลิ่นหรือสีสังเคราะห์ productnation', 1, NULL, '2024-02-02 13:53:54', '2024-02-29 00:00:00', '0000000001'),
(9, 'P00008', 'อาหารแมว', 'T0002', 100, 10, 180.00, 250.00, 5.00, 5.00, 'ชิ้น', 'อาหารแมว สมาร์ทฮาร์ท โกลด์ มีส่วนผสมอันดับ 1 คือโปรตีนเน้น ๆ จากเนื้อสัตว์ชนิดเดียว ซึ่งเป็นจุดที่น่าสนใจ เพราะช่วยลดความเสี่ยงการแพ้โปรตีนชนิดอื่นในอาหารแมว ทำให้เจ้าของเลือกได้ง่ายขึ้นว่าสูตรไหนที่เหมาะกับแมวที่ตัวเองเลี้ยง ทุกสูตรไม่มีผลพลอยได้จากสัตว์ปีกป่น แมวแพ้ไก่ทานได้ ไม่ต้องกังวลพลิกฉลากไปมา แถมไม่มีข้าวโพด ไม่มีการแต่งกลิ่นหรือสีสังเคราะห์ productnation', 1, NULL, '2024-02-02 14:32:28', '2024-02-24 00:00:00', '0000000001'),
(10, 'P00010', 'อาหารแมว', 'T0002', 100, 10, 180.00, 250.00, 5.00, 5.00, 'ถุง', 'อาหารแมว สมาร์ทฮาร์ท โกลด์ มีส่วนผสมอันดับ 1 คือโปรตีนเน้น ๆ จากเนื้อสัตว์ชนิดเดียว ซึ่งเป็นจุดที่น่าสนใจ เพราะช่วยลดความเสี่ยงการแพ้โปรตีนชนิดอื่นในอาหารแมว ทำให้เจ้าของเลือกได้ง่ายขึ้นว่าสูตรไหนที่เหมาะกับแมวที่ตัวเองเลี้ยง ทุกสูตรไม่มีผลพลอยได้จากสัตว์ปีกป่น แมวแพ้ไก่ทานได้ ไม่ต้องกังวลพลิกฉลากไปมา แถมไม่มีข้าวโพด ไม่มีการแต่งกลิ่นหรือสีสังเคราะห์ productnation', 1, NULL, '2024-02-02 14:32:28', '2024-02-24 00:00:00', '0000000001'),
(11, 'P00011', 'อาหารแมว', 'T0002', 100, 10, 180.00, 1000.00, 5.00, 5.00, 'ชิ้น', 'อาหารแมว สมาร์ทฮาร์ท โกลด์ มีส่วนผสมอันดับ 1 คือโปรตีนเน้น ๆ จากเนื้อสัตว์ชนิดเดียว ซึ่งเป็นจุดที่น่าสนใจ เพราะช่วยลดความเสี่ยงการแพ้โปรตีนชนิดอื่นในอาหารแมว ทำให้เจ้าของเลือกได้ง่ายขึ้นว่าสูตรไหนที่เหมาะกับแมวที่ตัวเองเลี้ยง ทุกสูตรไม่มีผลพลอยได้จากสัตว์ปีกป่น แมวแพ้ไก่ทานได้ ไม่ต้องกังวลพลิกฉลากไปมา แถมไม่มีข้าวโพด ไม่มีการแต่งกลิ่นหรือสีสังเคราะห์ productnation', 2, NULL, '2024-02-02 14:32:45', '2024-02-24 00:00:00', '0000000001'),
(12, 'P00012', 'test', 'T0001', 10, 10, 10.00, 10.00, 1.00, 0.10, 'ชิ้น', 'test', 1, 'product07135059.jpg', '2024-02-07 13:50:59', '2024-02-10 00:00:00', '0000000001'),
(13, 'P00013', 'aaa', 'T0001', 123, 123, 1.00, 22.00, 1.00, 0.22, 'ชิ้น', 'test', 1, 'product23054925.jpg', '2024-02-23 05:49:25', '2024-02-23 00:00:00', '0000000001'),
(14, 'P00014', 'ddddd', 'T0008', 100, 10, 500.00, 520.00, 10.00, 52.00, 'ถุง', 'หกดไดำไไำดำไดำไำได', 1, 'product25042358.jpg', '2024-02-25 04:23:58', '2024-02-29 00:00:00', '0000000001');

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
  `date_create` datetime DEFAULT NULL,
  `user_create` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `store_code` (`store_code`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_store`
--

INSERT INTO `tbl_store` (`id`, `store_code`, `store_name`, `store_address`, `store_logo`, `store_tel`, `date_create`, `user_create`) VALUES
(2, 'S00001', 'ร้าน petshop', 'ร้อยเอ็ด', 'logo05151429.png', '0613581445', '2024-02-25 04:24:56', '0000000001');

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
(9, 'T0009', 'อื่นๆ', '2', '2024-01-28 00:29:21', '2024-01-28 07:29:45', '0000000001', '0000000001'),
(10, 'T0010', 'bbbbbb', '1', '2024-02-24 21:22:51', '0000-00-00 00:00:00', '0000000001', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `usr_id` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usr_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usr_fname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usr_lname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usr_mail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usr_tel` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usr_password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_time_create` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `usr_id` (`usr_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `usr_id`, `usr_name`, `usr_fname`, `usr_lname`, `usr_mail`, `usr_tel`, `usr_password`, `auth`, `date_time_create`) VALUES
(1, '0000000001', 'admin', 'natthanon', 'sritonnang', 'admin@gmail.com', '0000000000', '1234', '9', '2024-01-03 13:14:26'),
(2, '0000000002', 'customer', 'customer', 'customer', 'customer@gmail.com', '0000000000', '1234', '1', '2024-01-07 06:28:54'),
(20, '0000000020', 'no', 'ไม่ระบุ', 'ไม่ระบุ', 'no@gmail.com', '0999999999', '1234', '1', '2024-03-01 07:38:58'),
(3, '0000000003', 'employee', 'employee', 'employee', 'employee@gmail.com', '0000000000', '1234', '5', '2024-01-07 07:38:26'),
(19, '0000000019', '0000000000', '', '', '', '0000000000', '0000000000', '1', '2024-03-01 07:37:40'),
(18, '0000000015', 'shopee', 'shopee', 'shopee', 'shopee@gmail.com', '0000000000', '1234', '1', '2024-03-01 07:36:33');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
