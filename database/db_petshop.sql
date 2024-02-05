-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 05 ก.พ. 2024 เมื่อ 12:52 PM
-- เวอร์ชันของเซิร์ฟเวอร์: 5.7.36
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
-- โครงสร้างตาราง `tbl_bank`
--

DROP TABLE IF EXISTS `tbl_bank`;
CREATE TABLE IF NOT EXISTS `tbl_bank` (
  `bank_id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_branch` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_owner` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_status` int(11) DEFAULT NULL,
  `date_create` datetime DEFAULT NULL,
  `user_create` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`bank_id`),
  UNIQUE KEY `bank_code` (`bank_code`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- dump ตาราง `tbl_bank`
--

INSERT INTO `tbl_bank` (`bank_id`, `bank_code`, `bank_name`, `bank_branch`, `bank_owner`, `bank_status`, `date_create`, `user_create`) VALUES
(1, '030-33-11-405', 'กรุงไทย', 'เดอะมอล บางกะปิ', 'ณัฐนนท์ ศรีทนนาง', 1, '2024-02-05 12:19:44', '0000000001'),
(2, '030-33-11-408', 'กสิกรไทย', 'เดอะมอล บางกะปิ', 'ณัฐนนท์ ศรีทนนาง', 1, '2024-02-05 12:19:59', '0000000001');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `tbl_order`
--

DROP TABLE IF EXISTS `tbl_order`;
CREATE TABLE IF NOT EXISTS `tbl_order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_no` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_type` int(1) DEFAULT NULL,
  `user_order` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_order` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_order` date DEFAULT NULL,
  `total_order` float(10,2) DEFAULT NULL,
  `discount` float(10,2) DEFAULT NULL,
  `status_order` int(1) DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `tbl_order_detail`
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `tbl_product`
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
  `date_create` datetime DEFAULT NULL,
  `date_exp` datetime DEFAULT NULL,
  `user_create` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_product`),
  KEY `fk_product_code` (`product_code`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- dump ตาราง `tbl_product`
--

INSERT INTO `tbl_product` (`id_product`, `product_code`, `name_product`, `code_type`, `num`, `minstock`, `cost`, `price`, `discount_per`, `discount_bath`, `unit`, `detail`, `status_product`, `date_create`, `date_exp`, `user_create`) VALUES
(1, 'P00001', 'อาหารแมว', 'T0001', 100, 10, 180.00, 100.00, 5.00, 10.00, 'อัน', 'อาหารแมว สมาร์ทฮาร์ท โกลด์ มีส่วนผสมอันดับ 1 คือโปรตีนเน้น ๆ จากเนื้อสัตว์ชนิดเดียว ซึ่งเป็นจุดที่น่าสนใจ เพราะช่วยลดความเสี่ยงการแพ้โปรตีนชนิดอื่นในอาหารแมว ทำให้เจ้าของเลือกได้ง่ายขึ้นว่าสูตรไหนที่เหมาะกับแมวที่ตัวเองเลี้ยง ทุกสูตรไม่มีผลพลอยได้จากสัตว์ปีกป่น แมวแพ้ไก่ทานได้ ไม่ต้องกังวลพลิกฉลากไปมา แถมไม่มีข้าวโพด ไม่มีการแต่งกลิ่นหรือสีสังเคราะห์ productnation', 1, '2024-02-01 15:19:33', '2024-02-28 00:00:00', '0000000001'),
(2, 'P00002', 'อาหารแมว', 'T0002', 100, 10, 180.00, 250.00, 5.00, 5.00, 'ชิ้น', 'อาหารแมว สมาร์ทฮาร์ท โกลด์ มีส่วนผสมอันดับ 1 คือโปรตีนเน้น ๆ จากเนื้อสัตว์ชนิดเดียว ซึ่งเป็นจุดที่น่าสนใจ เพราะช่วยลดความเสี่ยงการแพ้โปรตีนชนิดอื่นในอาหารแมว ทำให้เจ้าของเลือกได้ง่ายขึ้นว่าสูตรไหนที่เหมาะกับแมวที่ตัวเองเลี้ยง ทุกสูตรไม่มีผลพลอยได้จากสัตว์ปีกป่น แมวแพ้ไก่ทานได้ ไม่ต้องกังวลพลิกฉลากไปมา แถมไม่มีข้าวโพด ไม่มีการแต่งกลิ่นหรือสีสังเคราะห์ productnation', 1, '2024-02-01 15:20:24', '2024-02-01 00:00:00', '0000000001'),
(3, 'P00003', 'อาหารแมว', 'T0002', 100, 10, 180.00, 300.00, 5.00, 5.00, 'ถุง', 'อาหารแมว สมาร์ทฮาร์ท โกลด์ มีส่วนผสมอันดับ 1 คือโปรตีนเน้น ๆ จากเนื้อสัตว์ชนิดเดียว ซึ่งเป็นจุดที่น่าสนใจ เพราะช่วยลดความเสี่ยงการแพ้โปรตีนชนิดอื่นในอาหารแมว ทำให้เจ้าของเลือกได้ง่ายขึ้นว่าสูตรไหนที่เหมาะกับแมวที่ตัวเองเลี้ยง ทุกสูตรไม่มีผลพลอยได้จากสัตว์ปีกป่น แมวแพ้ไก่ทานได้ ไม่ต้องกังวลพลิกฉลากไปมา แถมไม่มีข้าวโพด ไม่มีการแต่งกลิ่นหรือสีสังเคราะห์ productnation', 1, '2024-02-01 15:20:33', '2024-02-01 15:20:33', '0000000001'),
(6, 'P00004', 'อาหารแมว', 'T0005', 100, 10, 180.00, 250.00, 5.00, 10.00, 'ชิ้น', 'อาหารแมว สมาร์ทฮาร์ท โกลด์ มีส่วนผสมอันดับ 1 คือโปรตีนเน้น ๆ จากเนื้อสัตว์ชนิดเดียว ซึ่งเป็นจุดที่น่าสนใจ เพราะช่วยลดความเสี่ยงการแพ้โปรตีนชนิดอื่นในอาหารแมว ทำให้เจ้าของเลือกได้ง่ายขึ้นว่าสูตรไหนที่เหมาะกับแมวที่ตัวเองเลี้ยง ทุกสูตรไม่มีผลพลอยได้จากสัตว์ปีกป่น แมวแพ้ไก่ทานได้ ไม่ต้องกังวลพลิกฉลากไปมา แถมไม่มีข้าวโพด ไม่มีการแต่งกลิ่นหรือสีสังเคราะห์ productnation', 1, '2024-02-01 15:37:35', '2024-02-29 00:00:00', '0000000001'),
(5, 'P00005', 'อาหารแมว', 'T0004', 100, 10, 180.00, 400.00, 5.00, 20.00, 'ถุง', 'อาหารแมว สมาร์ทฮาร์ท โกลด์ มีส่วนผสมอันดับ 1 คือโปรตีนเน้น ๆ จากเนื้อสัตว์ชนิดเดียว ซึ่งเป็นจุดที่น่าสนใจ เพราะช่วยลดความเสี่ยงการแพ้โปรตีนชนิดอื่นในอาหารแมว ทำให้เจ้าของเลือกได้ง่ายขึ้นว่าสูตรไหนที่เหมาะกับแมวที่ตัวเองเลี้ยง ทุกสูตรไม่มีผลพลอยได้จากสัตว์ปีกป่น แมวแพ้ไก่ทานได้ ไม่ต้องกังวลพลิกฉลากไปมา แถมไม่มีข้าวโพด ไม่มีการแต่งกลิ่นหรือสีสังเคราะห์ productnation', 1, '2024-02-01 15:21:09', '2024-02-01 15:21:09', '0000000001'),
(7, 'P00006', 'อาหารแมว', 'T0002', 100, 10, 180.00, 250.00, 5.00, 5.00, 'ชิ้น', 'อาหารแมว สมาร์ทฮาร์ท โกลด์ มีส่วนผสมอันดับ 1 คือโปรตีนเน้น ๆ จากเนื้อสัตว์ชนิดเดียว ซึ่งเป็นจุดที่น่าสนใจ เพราะช่วยลดความเสี่ยงการแพ้โปรตีนชนิดอื่นในอาหารแมว ทำให้เจ้าของเลือกได้ง่ายขึ้นว่าสูตรไหนที่เหมาะกับแมวที่ตัวเองเลี้ยง ทุกสูตรไม่มีผลพลอยได้จากสัตว์ปีกป่น แมวแพ้ไก่ทานได้ ไม่ต้องกังวลพลิกฉลากไปมา แถมไม่มีข้าวโพด ไม่มีการแต่งกลิ่นหรือสีสังเคราะห์ productnation', 1, '2024-02-01 16:07:54', '2024-02-29 00:00:00', '0000000001'),
(8, 'P00007', 'อาหารแมว', 'T0004', 100, 10, 180.00, 500.00, 5.00, 5.00, 'ถุง', 'อาหารแมว สมาร์ทฮาร์ท โกลด์ มีส่วนผสมอันดับ 1 คือโปรตีนเน้น ๆ จากเนื้อสัตว์ชนิดเดียว ซึ่งเป็นจุดที่น่าสนใจ เพราะช่วยลดความเสี่ยงการแพ้โปรตีนชนิดอื่นในอาหารแมว ทำให้เจ้าของเลือกได้ง่ายขึ้นว่าสูตรไหนที่เหมาะกับแมวที่ตัวเองเลี้ยง ทุกสูตรไม่มีผลพลอยได้จากสัตว์ปีกป่น แมวแพ้ไก่ทานได้ ไม่ต้องกังวลพลิกฉลากไปมา แถมไม่มีข้าวโพด ไม่มีการแต่งกลิ่นหรือสีสังเคราะห์ productnation', 1, '2024-02-02 13:53:54', '2024-02-29 00:00:00', '0000000001'),
(9, 'P00008', 'อาหารแมว', 'T0002', 100, 10, 180.00, 250.00, 5.00, 5.00, 'ชิ้น', 'อาหารแมว สมาร์ทฮาร์ท โกลด์ มีส่วนผสมอันดับ 1 คือโปรตีนเน้น ๆ จากเนื้อสัตว์ชนิดเดียว ซึ่งเป็นจุดที่น่าสนใจ เพราะช่วยลดความเสี่ยงการแพ้โปรตีนชนิดอื่นในอาหารแมว ทำให้เจ้าของเลือกได้ง่ายขึ้นว่าสูตรไหนที่เหมาะกับแมวที่ตัวเองเลี้ยง ทุกสูตรไม่มีผลพลอยได้จากสัตว์ปีกป่น แมวแพ้ไก่ทานได้ ไม่ต้องกังวลพลิกฉลากไปมา แถมไม่มีข้าวโพด ไม่มีการแต่งกลิ่นหรือสีสังเคราะห์ productnation', 1, '2024-02-02 14:32:28', '2024-02-24 00:00:00', '0000000001'),
(10, 'P00010', 'อาหารแมว', 'T0002', 100, 10, 180.00, 250.00, 5.00, 5.00, 'ถุง', 'อาหารแมว สมาร์ทฮาร์ท โกลด์ มีส่วนผสมอันดับ 1 คือโปรตีนเน้น ๆ จากเนื้อสัตว์ชนิดเดียว ซึ่งเป็นจุดที่น่าสนใจ เพราะช่วยลดความเสี่ยงการแพ้โปรตีนชนิดอื่นในอาหารแมว ทำให้เจ้าของเลือกได้ง่ายขึ้นว่าสูตรไหนที่เหมาะกับแมวที่ตัวเองเลี้ยง ทุกสูตรไม่มีผลพลอยได้จากสัตว์ปีกป่น แมวแพ้ไก่ทานได้ ไม่ต้องกังวลพลิกฉลากไปมา แถมไม่มีข้าวโพด ไม่มีการแต่งกลิ่นหรือสีสังเคราะห์ productnation', 1, '2024-02-02 14:32:28', '2024-02-24 00:00:00', '0000000001'),
(11, 'P00011', 'อาหารแมว', 'T0002', 100, 10, 180.00, 1000.00, 5.00, 5.00, 'ชิ้น', 'อาหารแมว สมาร์ทฮาร์ท โกลด์ มีส่วนผสมอันดับ 1 คือโปรตีนเน้น ๆ จากเนื้อสัตว์ชนิดเดียว ซึ่งเป็นจุดที่น่าสนใจ เพราะช่วยลดความเสี่ยงการแพ้โปรตีนชนิดอื่นในอาหารแมว ทำให้เจ้าของเลือกได้ง่ายขึ้นว่าสูตรไหนที่เหมาะกับแมวที่ตัวเองเลี้ยง ทุกสูตรไม่มีผลพลอยได้จากสัตว์ปีกป่น แมวแพ้ไก่ทานได้ ไม่ต้องกังวลพลิกฉลากไปมา แถมไม่มีข้าวโพด ไม่มีการแต่งกลิ่นหรือสีสังเคราะห์ productnation', 1, '2024-02-02 14:32:45', '2024-02-24 00:00:00', '0000000001');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `tbl_store`
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
-- dump ตาราง `tbl_store`
--

INSERT INTO `tbl_store` (`id`, `store_code`, `store_name`, `store_address`, `store_logo`, `store_tel`, `date_create`, `user_create`) VALUES
(2, 'S00001', 'ร้านทดสอบ', 'รามคำแหง', '', '0000000000', '2024-01-28 12:17:09', '0000000001');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `tbl_type_product`
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
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- dump ตาราง `tbl_type_product`
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
-- โครงสร้างตาราง `tbl_user`
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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- dump ตาราง `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `usr_id`, `usr_name`, `usr_fname`, `usr_lname`, `usr_mail`, `usr_tel`, `usr_password`, `auth`, `date_time_create`) VALUES
(1, '0000000001', 'admin', 'natthanon', 'sritonnang', 'admin@gmail.com', '0000000000', '1234', '9', '2024-01-03 13:14:26'),
(2, '0000000002', 'customer', 'customer', 'customer', 'customer@gmail.com', '0000000000', 'customer', '1', '2024-01-07 06:28:54'),
(3, '0000000003', 'customer2', 'customer2', 'customer2', 'customer2@gmail.com', '0000000000', 'customer2\r\n', '1', '2024-01-07 07:02:34'),
(4, '0000000004', 'employee', 'employee', 'employee', 'employee@gmail.com', '0000000000', 'employee', '5', '2024-01-07 07:38:26'),
(8, '0000000005', 'employee2', 'employee2', 'employee2', 'employee2@gmail.com', '0000000000', 'employee2', '5', '2024-01-26 23:36:52');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
