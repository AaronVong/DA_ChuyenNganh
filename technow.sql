-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 20, 2020 at 03:38 PM
-- Server version: 8.0.21
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `technow`
--

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `getAllCategories`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getAllCategories` ()  NO SQL
SELECT `category_name` FROM `tn_category`$$

DROP PROCEDURE IF EXISTS `getAllProductsByCategory`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getAllProductsByCategory` (IN `categoy` VARCHAR(20))  NO SQL
SELECT `product_id`,`product_name`,`product_thumb`,`product_originprice`, `product_sale`, `producer_name`,`category_name`
FROM `tn_product`
INNER JOIN `tn_producer`
ON `tn_product`.`producer_id`=`tn_producer`.`producer_id`
INNER JOIN `tn_category`
ON `tn_product`.`category_id`=`tn_category`.`category_id`
WHERE BINARY `category_name`= BINARY categoy$$

DROP PROCEDURE IF EXISTS `getHighlightProducts`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getHighlightProducts` ()  NO SQL
SELECT
	`product_id`,
    `product_name`,
    `product_thumb`,
    `product_originprice`,
    `product_sale`,
    `producer_name`,
    `category_name`
FROM
    `tn_product`
INNER JOIN `tn_producer` ON `tn_product`.`producer_id` = `tn_producer`.`producer_id`
INNER JOIN `tn_category` ON `tn_product`.`category_id` = `tn_category`.`category_id`
WHERE
    `tn_product`.`status_id` = 1 AND `tn_product`.`product_ishighlight` = 1
    LIMIT 0,4$$

DROP PROCEDURE IF EXISTS `getProductById`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getProductById` (IN `pid` INT)  NO SQL
SELECT `product_id`, `product_name`, `product_thumb`, `product_originprice`, `product_sale`, `producer_name`, `category_name`FROM `tn_product` INNER JOIN `tn_producer` on `tn_product`.`producer_id`=`tn_producer`.`producer_id` INNER JOIN `tn_category` ON `tn_product`.`category_id`=`tn_category`.`category_id` WHERE `product_id`=pid$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tn_category`
--

DROP TABLE IF EXISTS `tn_category`;
CREATE TABLE IF NOT EXISTS `tn_category` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tn_category`
--

INSERT INTO `tn_category` (`category_id`, `category_name`) VALUES
(1, 'phone'),
(2, 'laptop'),
(3, 'tablet'),
(4, 'speaker'),
(5, 'headphone'),
(6, 'charger'),
(7, 'portable-charger');

-- --------------------------------------------------------

--
-- Table structure for table `tn_customer`
--

DROP TABLE IF EXISTS `tn_customer`;
CREATE TABLE IF NOT EXISTS `tn_customer` (
  `customer_id` int NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `customer_phone` char(13) NOT NULL,
  `customer_gender` tinyint(1) DEFAULT '1',
  `customer_address` text NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tn_order`
--

DROP TABLE IF EXISTS `tn_order`;
CREATE TABLE IF NOT EXISTS `tn_order` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `order_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_deadline` datetime NOT NULL,
  `order_worth` double NOT NULL,
  `status_id` tinyint NOT NULL,
  `customer_id` int NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `fk_order_customer` (`customer_id`),
  KEY `fk_order_status` (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tn_order_detail`
--

DROP TABLE IF EXISTS `tn_order_detail`;
CREATE TABLE IF NOT EXISTS `tn_order_detail` (
  `product_id` int NOT NULL,
  `order_id` int NOT NULL,
  `order_detail_money` double NOT NULL,
  `order_detail_number` tinyint NOT NULL,
  PRIMARY KEY (`order_id`,`product_id`),
  KEY `fk_orderDetail_product` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tn_producer`
--

DROP TABLE IF EXISTS `tn_producer`;
CREATE TABLE IF NOT EXISTS `tn_producer` (
  `producer_id` int NOT NULL AUTO_INCREMENT,
  `producer_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`producer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tn_producer`
--

INSERT INTO `tn_producer` (`producer_id`, `producer_name`) VALUES
(1, 'samsung'),
(2, 'apple'),
(3, 'asus'),
(4, 'acer'),
(5, 'xiaomi'),
(6, 'huawei'),
(7, 'dell'),
(8, 'hp'),
(9, 'sony'),
(10, 'lenovo'),
(11, 'anker'),
(12, 'ava'),
(13, 'oppo');

-- --------------------------------------------------------

--
-- Table structure for table `tn_product`
--

DROP TABLE IF EXISTS `tn_product`;
CREATE TABLE IF NOT EXISTS `tn_product` (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `product_thumb` varchar(255) NOT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `product_originprice` decimal(10,0) NOT NULL,
  `product_sale` float NOT NULL,
  `product_saleprice` decimal(10,0) NOT NULL,
  `product_instock` int NOT NULL,
  `product_ishighlight` tinyint(1) NOT NULL DEFAULT '0',
  `product_detail` text,
  `status_id` tinyint NOT NULL,
  `producer_id` int NOT NULL,
  `category_id` int NOT NULL,
  PRIMARY KEY (`product_id`),
  KEY `status_id` (`status_id`),
  KEY `producer_id` (`producer_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tn_product`
--

INSERT INTO `tn_product` (`product_id`, `product_name`, `product_thumb`, `product_image`, `product_originprice`, `product_sale`, `product_saleprice`, `product_instock`, `product_ishighlight`, `product_detail`, `status_id`, `producer_id`, `category_id`) VALUES
(1, 'iphone 11 64gb', 'iphone-11-red-600x600.jpg', NULL, '19990000', 0, '19990000', 10, 1, NULL, 1, 2, 1),
(2, 'iphone 12 pro max 512GB', 'iphone-12-pro-max-512gb-191020-021035-600x600.jpg', NULL, '43990000', 0, '43990000', 10, 0, NULL, 1, 2, 1),
(3, 'iphone 12 pro 512GB', 'iphone-12-pro-max-512gb-191020-021035-600x600.jpg', NULL, '40990000', 0, '40990000', 10, 0, NULL, 1, 2, 1),
(4, 'iphone 12 pro max 256GB', 'iphone-12-pro-max-512gb-191020-021035-600x600.jpg', NULL, '37990000', 0, '37990000', 10, 0, NULL, 1, 2, 1),
(5, 'iphone 11 pro max 512GB', 'iphone-11-pro-max-512gb-gold-600x600.jpg', NULL, '37990000', 0, '37990000', 10, 0, NULL, 1, 2, 1),
(6, 'iphone 11 pro max 256GB', 'iphone-11-pro-max-256gb-black-600x600.jpg', NULL, '33990000', 0, '33990000', 10, 0, NULL, 1, 2, 1),
(7, 'iphone 7 32GB', 'iphone-7-plus-32gb-gold-600x600-600x600.jpg', NULL, '8990000', 0, '8990000', 10, 0, NULL, 1, 2, 1),
(8, 'iphone SE 128GB', 'iphone-se-128gb-2020-261820-101803-200x200.jpg', NULL, '13990000', 0, '13990000', 10, 0, NULL, 1, 2, 1),
(9, 'samsung galaxy note 20 ultra 5g', 'samsung-galaxy-note-20-ultra-5g-063420-123447-600x600.jpg', NULL, '32990000', 0.06, '32990000', 10, 1, NULL, 1, 1, 1),
(10, 'samsung galaxy a51', 'samsung-galaxy-a51-8gb-blue-600x600-600x600.jpg', NULL, '8390000', 0, '8390000', 10, 0, NULL, 1, 1, 1),
(11, 'samsung galaxy a21s', 'samsung-galaxy-a21s-3gb-055520-045548-600x600.jpg', NULL, '5690000', 0.07, '5690000', 10, 0, NULL, 1, 1, 1),
(12, 'samsung galaxy a31', 'samsung-galaxy-a31-055720-045750-600x600.jpg', NULL, '6490000', 0, '6490000', 10, 0, NULL, 1, 1, 1),
(13, 'samsung galaxy note 20', 'samsung-galaxy-note-20-062220-122200-600x600.jpg', NULL, '23900000', 0.08, '23900000', 10, 0, NULL, 1, 1, 1),
(14, 'samsung galaxy s10 lite', 'samsung-galaxy-s10-lite-blue-thumb-600x600.jpg', NULL, '14990000', 0.13, '14990000', 10, 0, NULL, 1, 1, 1),
(15, 'samsung galaxy s20+', 'samsung-galaxy-s20-plus-600x600-fix-600x600.jpg', NULL, '23990000', 0, '23990000', 10, 0, NULL, 1, 1, 1),
(16, 'samsung galaxy note 10 lite', 'samsung-galaxy-note-10-lite-thumb-600x600.jpg', NULL, '11490000', 0.06, '11490000', 10, 0, NULL, 1, 1, 1),
(17, 'oppo reno4', 'oppo-reno4-pro-274720-034747-600x600.jpg', NULL, '8490000', 0, '8490000', 10, 1, NULL, 1, 13, 1),
(18, 'oppo a93', 'oppo-a93-230520-060532-200x200.jpg', NULL, '7490000', 0, '7490000', 10, 1, NULL, 1, 13, 1),
(19, 'oppo find x2', 'oppo-find-x2-blue-600x600-600x600.jpg', NULL, '23090000', 0.16, '23900000', 10, 1, NULL, 1, 13, 1),
(20, 'oppo reno3 pro', 'oppo-reno3-trang-600x600-600x600.jpg', NULL, '14290000', 0.37, '14290000', 10, 0, NULL, 1, 13, 1),
(21, 'oppo a52', 'oppo-a52-black-600x600-600x600.jpg', NULL, '5990000', 0, '5990000', 10, 0, NULL, 1, 2, 1),
(22, 'oppo a53', 'oppo-a53-2020-blue-600x600-600x600.jpg', NULL, '4490000', 0, '4490000', 10, 0, NULL, 1, 13, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tn_status`
--

DROP TABLE IF EXISTS `tn_status`;
CREATE TABLE IF NOT EXISTS `tn_status` (
  `status_id` tinyint NOT NULL AUTO_INCREMENT,
  `status_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tn_status`
--

INSERT INTO `tn_status` (`status_id`, `status_name`) VALUES
(1, 'available'),
(2, 'not available'),
(3, 'pending'),
(4, 'new'),
(5, 'shipping'),
(6, 'delivered'),
(7, 'aborted');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tn_order`
--
ALTER TABLE `tn_order`
  ADD CONSTRAINT `fk_order_customer` FOREIGN KEY (`customer_id`) REFERENCES `tn_customer` (`customer_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_order_status` FOREIGN KEY (`status_id`) REFERENCES `tn_status` (`status_id`) ON UPDATE CASCADE;

--
-- Constraints for table `tn_order_detail`
--
ALTER TABLE `tn_order_detail`
  ADD CONSTRAINT `fk_orderDetail_order` FOREIGN KEY (`order_id`) REFERENCES `tn_order` (`order_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_orderDetail_product` FOREIGN KEY (`product_id`) REFERENCES `tn_product` (`product_id`) ON UPDATE CASCADE;

--
-- Constraints for table `tn_product`
--
ALTER TABLE `tn_product`
  ADD CONSTRAINT `fk_product_category` FOREIGN KEY (`category_id`) REFERENCES `tn_category` (`category_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_producer` FOREIGN KEY (`producer_id`) REFERENCES `tn_producer` (`producer_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_status` FOREIGN KEY (`status_id`) REFERENCES `tn_status` (`status_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
