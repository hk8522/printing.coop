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

/*Table structure for table `provider_attributes` */

DROP TABLE IF EXISTS `provider_attributes`;

CREATE TABLE `provider_attributes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `provider_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `type` int(11) DEFAULT 2,
  `attribute_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`provider_id`,`name`),
  KEY `attribute_id` (`attribute_id`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `provider_attributes` */

/*Table structure for table `provider_product_attributes` */

DROP TABLE IF EXISTS `provider_product_attributes`;

CREATE TABLE `provider_product_attributes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `provider_id` bigint(20) unsigned DEFAULT NULL,
  `provider_product_id` bigint(20) unsigned DEFAULT NULL,
  `provider_attribute_id` bigint(20) unsigned DEFAULT NULL,
  `value_id` bigint(20) unsigned DEFAULT NULL,
  `value` varchar(255) NOT NULL,
  `deleted` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_attribute_option` (`provider_id`,`provider_product_id`,`provider_attribute_id`,`value`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `provider_product_attributes` */

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `provider_products` */

/*Table structure for table `providers` */

DROP TABLE IF EXISTS `providers`;

CREATE TABLE `providers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varbinary(255) DEFAULT NULL,
  `official_link` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `providers` */

insert  into `providers`(`id`,`name`,`description`,`official_link`) values 
(1,'sina',NULL,'https://apifrontend_stage.sinaliteuppy.com');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
