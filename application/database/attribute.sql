/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.4.8-MariaDB : Database - db_printing_imprimeur
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_printing_imprimeur` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `db_printing_imprimeur`;

/*Table structure for table `attribute_items` */

DROP TABLE IF EXISTS `attribute_items`;

CREATE TABLE `attribute_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `attribute_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `name_fr` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item` (`attribute_id`,`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `attributes` */

DROP TABLE IF EXISTS `attributes`;

CREATE TABLE `attributes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `label_fr` varchar(255) DEFAULT NULL,
  `type` int(10) unsigned DEFAULT 999,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `product_attribute_item_map` */

DROP TABLE IF EXISTS `product_attribute_item_map`;

CREATE TABLE `product_attribute_item_map` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned DEFAULT NULL,
  `attribute_id` bigint(20) unsigned DEFAULT NULL,
  `attribute_item_id` bigint(20) unsigned DEFAULT NULL,
  `show_order` int(10) unsigned DEFAULT 0,
  `additional_fee` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `attribute_item` (`product_id`,`attribute_id`,`attribute_item_id`,`show_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Table structure for table `product_attribute_map` */

DROP TABLE IF EXISTS `product_attribute_map`;

CREATE TABLE `product_attribute_map` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned DEFAULT NULL,
  `attribute_id` bigint(20) unsigned DEFAULT NULL,
  `show_order` int(10) unsigned DEFAULT 0,
  `use_items` tinyint(4) unsigned DEFAULT 1,
  `value_min` decimal(10,2) DEFAULT 0.00,
  `value_max` decimal(10,2) DEFAULT 0.00,
  `additional_fee` decimal(10,2) DEFAULT NULL,
  `fee_apply_size` tinyint(3) unsigned DEFAULT 1,
  `fee_apply_width` tinyint(3) unsigned DEFAULT 1,
  `fee_apply_length` tinyint(3) unsigned DEFAULT 1,
  `fee_apply_diameter` tinyint(3) unsigned DEFAULT 1,
  `fee_apply_depth` tinyint(3) unsigned DEFAULT 1,
  `fee_apply_pages` tinyint(3) unsigned DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `attribute` (`product_id`,`attribute_id`,`show_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
