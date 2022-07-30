/*
SQLyog Community v13.1.8 (64 bit)
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

/*Table structure for table `provider_option_values` */

DROP TABLE IF EXISTS `provider_option_values`;

CREATE TABLE `provider_option_values` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `option_id` bigint(20) unsigned NOT NULL,
  `provider_option_value_id` bigint(20) unsigned NOT NULL,
  `value` varchar(255) NOT NULL,
  `img_src` varchar(255) DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0,
  `extra_turnaround_days` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `option` (`provider_option_value_id`),
  KEY `option_value` (`provider_option_value_id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `provider_options` */

DROP TABLE IF EXISTS `provider_options`;

CREATE TABLE `provider_options` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `provider_id` bigint(20) unsigned DEFAULT NULL,
  `provider_option_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `type` int(11) DEFAULT 2,
  `attribute_id` bigint(20) unsigned DEFAULT NULL,
  `html_type` varchar(16) DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `option_id` (`provider_id`,`provider_option_id`),
  KEY `attribute_id` (`attribute_id`),
  KEY `type` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `provider_orders` */

DROP TABLE IF EXISTS `provider_orders`;

CREATE TABLE `provider_orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned NOT NULL,
  `provider_order_id` bigint(20) unsigned NOT NULL,
  `grandtotal` double DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `shipping_cost` double DEFAULT NULL,
  `subtotal` double DEFAULT NULL,
  `tax` double DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `provider_product_options` */

DROP TABLE IF EXISTS `provider_product_options`;

CREATE TABLE `provider_product_options` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `provider_id` bigint(20) unsigned NOT NULL,
  `provider_product_id` bigint(20) unsigned NOT NULL,
  `option_id` bigint(20) unsigned NOT NULL,
  `provider_option_value_id` bigint(20) unsigned NOT NULL,
  `deleted` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `option` (`provider_id`,`provider_product_id`,`option_id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `provider_products` */

DROP TABLE IF EXISTS `provider_products`;

CREATE TABLE `provider_products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `provider_id` bigint(20) unsigned NOT NULL,
  `provider_product_id` bigint(20) unsigned NOT NULL,
  `sku` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `enabled` tinyint(4) DEFAULT 0,
  `product_id` bigint(20) unsigned DEFAULT NULL,
  `information_type` int(10) unsigned DEFAULT 0,
  `deleted` tinyint(4) DEFAULT 0,
  `updating` tinyint(4) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `name` (`provider_id`,`name`),
  KEY `sku` (`provider_id`,`sku`),
  KEY `category` (`provider_id`,`category`),
  KEY `provider_product_id` (`provider_id`,`provider_product_id`),
  KEY `deleted` (`provider_id`,`deleted`),
  KEY `updating` (`provider_id`,`updating`),
  KEY `product_id` (`provider_id`,`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=245 DEFAULT CHARSET=utf8mb4;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
