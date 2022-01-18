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

/*Table structure for table `addresses` */

DROP TABLE IF EXISTS `addresses`;

CREATE TABLE `addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pin_code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-is Active 0-Inactive',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `mobile` varchar(50) COLLATE utf8_unicode_ci DEFAULT '0',
  `address` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `city` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(10) COLLATE utf8_unicode_ci DEFAULT 'India',
  `state` smallint(6) DEFAULT NULL,
  `landmark` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alternate_phone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_type` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `default_delivery_address` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=210 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `admin_module` */

DROP TABLE IF EXISTS `admin_module`;

CREATE TABLE `admin_module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_id` (`admin_id`,`module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1800 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `admin_sub_module` */

DROP TABLE IF EXISTS `admin_sub_module`;

CREATE TABLE `admin_sub_module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `sub_module_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_id` (`admin_id`,`module_id`,`sub_module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=242 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `admins` */

DROP TABLE IF EXISTS `admins`;

CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-is Active 0-Inactive',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'admin',
  `profile_pic` varchar(100) COLLATE utf8_unicode_ci DEFAULT '',
  `store_ids` varchar(250) COLLATE utf8_unicode_ci DEFAULT '',
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT '''''',
  `mobile` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `banners` */

DROP TABLE IF EXISTS `banners`;

CREATE TABLE `banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_french` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `short_description` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `short_description_french` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `full_description` text CHARACTER SET utf8 DEFAULT NULL,
  `full_description_french` text CHARACTER SET utf8 DEFAULT NULL,
  `banner_image` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `banner_image_french` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-is Active 0-Inactive',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `main_store_id` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `blocked_ips` */

DROP TABLE IF EXISTS `blocked_ips`;

CREATE TABLE `blocked_ips` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `blog_category` */

DROP TABLE IF EXISTS `blog_category`;

CREATE TABLE `blog_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_name_french` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `order` int(11) NOT NULL DEFAULT 0,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `store_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1,2,3,4,5',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `blog_comments` */

DROP TABLE IF EXISTS `blog_comments`;

CREATE TABLE `blog_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_id` int(11) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `comment` longtext DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `blogs` */

DROP TABLE IF EXISTS `blogs`;

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `title_french` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `content_french` longtext DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `populer` tinyint(4) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `store_id` varchar(100) NOT NULL DEFAULT '1,2,3,4,5',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Table structure for table `book` */

DROP TABLE IF EXISTS `book`;

CREATE TABLE `book` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `tags` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Table structure for table `brands` */

DROP TABLE IF EXISTS `brands`;

CREATE TABLE `brands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `short_description` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `full_description` text CHARACTER SET utf8 DEFAULT NULL,
  `brand_image` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-is Active 0-Inactive',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `bundling` */

DROP TABLE IF EXISTS `bundling`;

CREATE TABLE `bundling` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `name_french` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-is Active 0-Inactive',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `category_order` int(11) NOT NULL,
  `image` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category_dispersion` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `category_dispersion_french` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `show_main_menu` tinyint(4) NOT NULL DEFAULT 1,
  `show_our_printed_product` tinyint(4) NOT NULL DEFAULT 1,
  `show_footer_menu` tinyint(4) NOT NULL DEFAULT 1,
  `image_french` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `store_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1,2,3,4',
  `page_title` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `page_title_france` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_description_content` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_description_content_france` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_keywords_content` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_keywords_content_france` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `categories_images` */

DROP TABLE IF EXISTS `categories_images`;

CREATE TABLE `categories_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `image` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_french` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `main_store_id` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=141 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `categories_images-bk` */

DROP TABLE IF EXISTS `categories_images-bk`;

CREATE TABLE `categories_images-bk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `image` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_french` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `main_store_id` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=135 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `cities` */

DROP TABLE IF EXISTS `cities`;

CREATE TABLE `cities` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `state_id` mediumint(8) unsigned NOT NULL,
  `state_code` varchar(255) NOT NULL,
  `country_id` mediumint(8) unsigned NOT NULL,
  `country_code` char(2) NOT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '2014-01-01 04:31:01',
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `flag` tinyint(1) NOT NULL DEFAULT 1,
  `wikiDataId` varchar(255) DEFAULT NULL COMMENT 'Rapid API GeoDB Cities',
  PRIMARY KEY (`id`),
  KEY `cities_test_ibfk_1` (`state_id`),
  KEY `cities_test_ibfk_2` (`country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=141852 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Table structure for table `cities-bk` */

DROP TABLE IF EXISTS `cities-bk`;

CREATE TABLE `cities-bk` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `state_id` mediumint(8) unsigned NOT NULL,
  `state_code` varchar(255) NOT NULL,
  `country_id` mediumint(8) unsigned NOT NULL,
  `country_code` char(2) NOT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '2014-01-01 04:31:01',
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `flag` tinyint(1) NOT NULL DEFAULT 1,
  `wikiDataId` varchar(255) DEFAULT NULL COMMENT 'Rapid API GeoDB Cities',
  PRIMARY KEY (`id`),
  KEY `cities_test_ibfk_1` (`state_id`),
  KEY `cities_test_ibfk_2` (`country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=141852 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Table structure for table `coating` */

DROP TABLE IF EXISTS `coating`;

CREATE TABLE `coating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_french` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `colors` */

DROP TABLE IF EXISTS `colors`;

CREATE TABLE `colors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_french` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `configurations` */

DROP TABLE IF EXISTS `configurations`;

CREATE TABLE `configurations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_no` varchar(255) DEFAULT NULL,
  `contact_no_french` varchar(255) DEFAULT NULL,
  `office_timing` varchar(255) DEFAULT NULL,
  `office_timing_french` varchar(255) DEFAULT NULL,
  `logo_image` varchar(255) DEFAULT NULL,
  `logo_image_french` varchar(255) DEFAULT NULL,
  `languages` varchar(255) DEFAULT NULL,
  `currencies` varchar(255) DEFAULT NULL,
  `announcement` varchar(255) DEFAULT NULL,
  `announcement_french` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `copy_right` varchar(255) DEFAULT NULL,
  `copy_right_french` varchar(255) DEFAULT NULL,
  `address_one` longtext DEFAULT NULL,
  `address_one_french` longtext DEFAULT NULL,
  `main_store_id` int(11) NOT NULL,
  `favicon` varchar(200) DEFAULT NULL,
  `french_favicon` varchar(250) DEFAULT NULL,
  `log_alt_teg` varchar(250) DEFAULT NULL,
  `log_alt_teg_french` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Table structure for table `contact_us` */

DROP TABLE IF EXISTS `contact_us`;

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `comment` longtext DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `store_id` int(11) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=159 DEFAULT CHARSET=latin1;

/*Table structure for table `countries` */

DROP TABLE IF EXISTS `countries`;

CREATE TABLE `countries` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `iso3` char(3) DEFAULT NULL,
  `iso2` char(2) DEFAULT NULL,
  `phonecode` varchar(255) DEFAULT NULL,
  `capital` varchar(255) DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `flag` tinyint(1) NOT NULL DEFAULT 1,
  `wikiDataId` varchar(255) DEFAULT NULL COMMENT 'Rapid API GeoDB Cities',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=248 DEFAULT CHARSET=utf8;

/*Table structure for table `countries_bk` */

DROP TABLE IF EXISTS `countries_bk`;

CREATE TABLE `countries_bk` (
  `CountryID` int(11) NOT NULL AUTO_INCREMENT,
  `CountrySortName` varchar(3) NOT NULL,
  `CountryName` varchar(150) NOT NULL,
  `PhoneCode` int(11) NOT NULL,
  PRIMARY KEY (`CountryID`)
) ENGINE=InnoDB AUTO_INCREMENT=247 DEFAULT CHARSET=utf8;

/*Table structure for table `currency` */

DROP TABLE IF EXISTS `currency`;

CREATE TABLE `currency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `currency_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symbols` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` smallint(6) DEFAULT 1,
  `product_price_currency` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'price',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `diameter` */

DROP TABLE IF EXISTS `diameter`;

CREATE TABLE `diameter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_french` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `discounts` */

DROP TABLE IF EXISTS `discounts`;

CREATE TABLE `discounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `discount_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'discount_percent',
  `discount` float(10,2) NOT NULL DEFAULT 0.00,
  `discount_valid_from` datetime DEFAULT NULL,
  `discount_valid_to` datetime DEFAULT NULL,
  `discount_requirement_quantity` mediumint(9) DEFAULT 1,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `discount_code_limit` mediumint(9) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `envelope` */

DROP TABLE IF EXISTS `envelope`;

CREATE TABLE `envelope` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_french` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `estimates` */

DROP TABLE IF EXISTS `estimates`;

CREATE TABLE `estimates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_name` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `product_type` varchar(255) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `has_quote_form` tinyint(1) NOT NULL DEFAULT 0,
  `same_quote_request` tinyint(1) NOT NULL DEFAULT 0,
  `qty_1` varchar(255) DEFAULT NULL,
  `qty_2` varchar(255) DEFAULT NULL,
  `qty_3` varchar(255) DEFAULT NULL,
  `more_qty` varchar(255) DEFAULT NULL,
  `flat_size` varchar(255) DEFAULT NULL,
  `finish_size` varchar(255) DEFAULT NULL,
  `paper_stock` varchar(255) DEFAULT NULL,
  `no_of_sides` varchar(255) DEFAULT NULL,
  `folding` varchar(255) DEFAULT NULL,
  `total_versions` varchar(255) DEFAULT NULL,
  `shipping_methods` varchar(255) DEFAULT NULL,
  `notes` longtext DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `store_id` mediumint(9) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

/*Table structure for table `grommets` */

DROP TABLE IF EXISTS `grommets`;

CREATE TABLE `grommets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_french` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `language` */

DROP TABLE IF EXISTS `language`;

CREATE TABLE `language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `menus` */

DROP TABLE IF EXISTS `menus`;

CREATE TABLE `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-is Active 0-Inactive',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `menu_order` smallint(6) NOT NULL DEFAULT 0,
  `image` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `collection` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `module` */

DROP TABLE IF EXISTS `module`;

CREATE TABLE `module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `url` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `class` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT 'fab fa-product-hunt',
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `order` (`order`,`module_name`),
  CONSTRAINT `module_ibfk_1` FOREIGN KEY (`status`) REFERENCES `states_bk` (`StateID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `n_attribute_items` */

DROP TABLE IF EXISTS `n_attribute_items`;

CREATE TABLE `n_attribute_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `neighbor_id` int(10) unsigned DEFAULT NULL,
  `attribute_id` int(10) unsigned DEFAULT NULL,
  `attribute_item_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `attribute` (`neighbor_id`,`attribute_id`,`attribute_item_id`,`name`),
  KEY `name` (`neighbor_id`,`attribute_id`,`name`,`attribute_item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

/*Table structure for table `n_attributes` */

DROP TABLE IF EXISTS `n_attributes`;

CREATE TABLE `n_attributes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `neighbor_id` int(10) unsigned DEFAULT NULL,
  `attribute_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `attribute` (`neighbor_id`,`attribute_id`,`name`),
  KEY `name` (`neighbor_id`,`name`,`attribute_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

/*Table structure for table `n_neighbors` */

DROP TABLE IF EXISTS `n_neighbors`;

CREATE TABLE `n_neighbors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Table structure for table `ncr_parts` */

DROP TABLE IF EXISTS `ncr_parts`;

CREATE TABLE `ncr_parts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_french` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `page_categories` */

DROP TABLE IF EXISTS `page_categories`;

CREATE TABLE `page_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-is Active 0-Inactive',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `category_order` int(11) NOT NULL,
  `image` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `page_quantity` */

DROP TABLE IF EXISTS `page_quantity`;

CREATE TABLE `page_quantity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` int(11) DEFAULT NULL,
  `name_french` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=123 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `page_size` */

DROP TABLE IF EXISTS `page_size`;

CREATE TABLE `page_size` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_french` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `total_page` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `pages` */

DROP TABLE IF EXISTS `pages`;

CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `title_france` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `description` longtext CHARACTER SET utf8 DEFAULT NULL,
  `description_france` longtext CHARACTER SET utf8 DEFAULT NULL,
  `html` longtext CHARACTER SET utf8 DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `shortOrder` smallint(6) NOT NULL DEFAULT 0,
  `slug` varchar(200) DEFAULT NULL,
  `display_on_footer` tinyint(1) NOT NULL DEFAULT 1,
  `display_on_top_menu` tinyint(1) NOT NULL DEFAULT 1,
  `display_on_footer_last_menu` tinyint(1) NOT NULL DEFAULT 0,
  `main_store_id` tinyint(4) NOT NULL DEFAULT 1,
  `page_title_france` varchar(150) DEFAULT NULL,
  `page_title` varchar(150) DEFAULT NULL,
  `meta_description_content` varchar(250) DEFAULT NULL,
  `meta_description_content_france` varchar(250) DEFAULT NULL,
  `meta_keywords_content` varchar(250) DEFAULT NULL,
  `meta_keywords_content_france` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

/*Table structure for table `paper` */

DROP TABLE IF EXISTS `paper`;

CREATE TABLE `paper` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_french` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `paper_quality` */

DROP TABLE IF EXISTS `paper_quality`;

CREATE TABLE `paper_quality` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_french` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `pickup_stores` */

DROP TABLE IF EXISTS `pickup_stores`;

CREATE TABLE `pickup_stores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `printer_series` */

DROP TABLE IF EXISTS `printer_series`;

CREATE TABLE `printer_series` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `name_french` varchar(250) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `printer_brand_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2453 DEFAULT CHARSET=utf8;

/*Table structure for table `printermodels` */

DROP TABLE IF EXISTS `printermodels`;

CREATE TABLE `printermodels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `name_french` varchar(250) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `printer_brand_id` int(11) DEFAULT NULL,
  `printer_series_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10547 DEFAULT CHARSET=utf8;

/*Table structure for table `printers` */

DROP TABLE IF EXISTS `printers`;

CREATE TABLE `printers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `name_french` varchar(250) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `shortOrder` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

/*Table structure for table `product_a_attribute_items` */

DROP TABLE IF EXISTS `product_a_attribute_items`;

CREATE TABLE `product_a_attribute_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned DEFAULT NULL,
  `attribute_id` int(10) unsigned DEFAULT NULL,
  `attribute_item_id` int(10) unsigned DEFAULT NULL,
  `extra_price` decimal(10,2) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Table structure for table `product_a_attributes` */

DROP TABLE IF EXISTS `product_a_attributes`;

CREATE TABLE `product_a_attributes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned DEFAULT NULL,
  `attribute_id` int(10) unsigned DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Table structure for table `product_a_sizes` */

DROP TABLE IF EXISTS `product_a_sizes`;

CREATE TABLE `product_a_sizes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned DEFAULT NULL,
  `size_id` int(10) unsigned DEFAULT NULL,
  `extra_price` decimal(10,2) DEFAULT 0.00,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Table structure for table `product_attribute_datas` */

DROP TABLE IF EXISTS `product_attribute_datas`;

CREATE TABLE `product_attribute_datas` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `attribute_id` int(11) DEFAULT NULL,
  `show_order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=70914 DEFAULT CHARSET=latin1;

/*Table structure for table `product_attribute_item_datas` */

DROP TABLE IF EXISTS `product_attribute_item_datas`;

CREATE TABLE `product_attribute_item_datas` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `attribute_id` int(11) DEFAULT NULL,
  `attribute_item_id` int(11) DEFAULT NULL,
  `show_order` int(11) DEFAULT NULL,
  `extra_price` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `attribute` (`product_id`,`attribute_id`,`attribute_item_id`)
) ENGINE=MyISAM AUTO_INCREMENT=179036 DEFAULT CHARSET=latin1;

/*Table structure for table `product_attribute_items` */

DROP TABLE IF EXISTS `product_attribute_items`;

CREATE TABLE `product_attribute_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(250) DEFAULT NULL,
  `item_name_french` varchar(250) DEFAULT NULL,
  `product_attribute_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2896 DEFAULT CHARSET=latin1;

/*Table structure for table `product_attributes` */

DROP TABLE IF EXISTS `product_attributes`;

CREATE TABLE `product_attributes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `name_french` varchar(250) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=231 DEFAULT CHARSET=latin1;

/*Table structure for table `product_category` */

DROP TABLE IF EXISTS `product_category`;

CREATE TABLE `product_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10105 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `product_descriptions` */

DROP TABLE IF EXISTS `product_descriptions`;

CREATE TABLE `product_descriptions` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `title_french` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_french` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16992 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `product_full_prices` */

DROP TABLE IF EXISTS `product_full_prices`;

CREATE TABLE `product_full_prices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned DEFAULT NULL,
  `quantity_id` int(10) unsigned DEFAULT NULL,
  `size_id` int(10) unsigned DEFAULT NULL,
  `attributes` varchar(255) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `attributes` (`product_id`,`quantity_id`,`size_id`,`attributes`)
) ENGINE=InnoDB AUTO_INCREMENT=200693 DEFAULT CHARSET=utf8;

/*Table structure for table `product_images` */

DROP TABLE IF EXISTS `product_images`;

CREATE TABLE `product_images` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-is Active 0-Inactive',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `product_id` int(11) NOT NULL DEFAULT 0,
  `is_main_image` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21958 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `product_multiple_attribute_items` */

DROP TABLE IF EXISTS `product_multiple_attribute_items`;

CREATE TABLE `product_multiple_attribute_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_name_french` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_attribute_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=364 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `product_multiple_attributes` */

DROP TABLE IF EXISTS `product_multiple_attributes`;

CREATE TABLE `product_multiple_attributes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_french` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `set_order` smallint(6) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `product_order_items` */

DROP TABLE IF EXISTS `product_order_items`;

CREATE TABLE `product_order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL DEFAULT 0,
  `order_id` int(11) DEFAULT NULL,
  `personailise` tinyint(11) NOT NULL DEFAULT 0,
  `personailise_image` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name_french` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `short_description` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `short_description_french` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `full_description` text CHARACTER SET utf8 DEFAULT NULL,
  `full_description_french` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `discount` mediumint(9) NOT NULL DEFAULT 0,
  `product_image` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `brand` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `subtotal` decimal(10,2) NOT NULL DEFAULT 0.00,
  `delivery_charge` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_stock` int(11) NOT NULL DEFAULT 0,
  `cart_images` text CHARACTER SET utf8 DEFAULT NULL,
  `attribute_ids` text CHARACTER SET utf8 DEFAULT NULL,
  `product_size` text CHARACTER SET utf8 DEFAULT NULL,
  `product_width_length` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `votre_text` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `recto_verso` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `page_product_width_length` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `product_depth_length_width` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_box_length` decimal(10,2) DEFAULT NULL,
  `shipping_box_width` decimal(10,2) DEFAULT NULL,
  `shipping_box_height` decimal(10,2) DEFAULT NULL,
  `shipping_box_weight` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=636 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `product_orders` */

DROP TABLE IF EXISTS `product_orders`;

CREATE TABLE `product_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT 0.00,
  `total_sales_tax` decimal(10,2) DEFAULT NULL,
  `sub_total_amount` decimal(10,2) NOT NULL,
  `preffered_customer_discount` decimal(10,2) NOT NULL,
  `payment_status` tinyint(4) DEFAULT 1 COMMENT '1- Pending,2-Success,3-failed',
  `payment_type` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_method` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `delivery_charge` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_items` int(11) DEFAULT 0,
  `billing_pin_code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 2 COMMENT '1-incomplete 2-new 3-process to delivery,4-Delivered 5-cancelled,6-failed',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `billing_mobile` varchar(50) COLLATE utf8_unicode_ci DEFAULT '',
  `billing_address` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `billing_city` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_country` int(11) DEFAULT 39,
  `billing_state` int(11) DEFAULT NULL,
  `billing_landmark` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_alternate_phone` bigint(20) DEFAULT NULL,
  `billing_address_type` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transition_id` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_pin_code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_name` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_mobile` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_address` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_city` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_country` int(11) NOT NULL DEFAULT 39,
  `shipping_state` int(11) DEFAULT NULL,
  `shipping_landmark` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_method` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_alternate_phone` bigint(20) DEFAULT NULL,
  `shipping_address_type` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transition_remark` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `delivery_address_id` int(11) DEFAULT NULL,
  `billing_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin_delete` tinyint(4) NOT NULL DEFAULT 1,
  `user_delete` tinyint(4) NOT NULL DEFAULT 1,
  `order_date` date DEFAULT NULL,
  `shipping_method_formate` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `store_id` int(250) DEFAULT 1,
  `currency_id` int(11) DEFAULT 1,
  `coupon_discount_amount` decimal(10,2) DEFAULT 0.00,
  `coupon_code` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_company` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_company` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_comment` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_admin` int(11) DEFAULT 0,
  `payment_mode` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'live',
  `shipment_id` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tracking_number` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `labels_regular` text CHARACTER SET utf8 DEFAULT NULL,
  `labels_thermal` text CHARACTER SET utf8 DEFAULT NULL,
  `shipment_data` text CHARACTER SET utf8 DEFAULT NULL,
  `flag_shiping_cost` decimal(10,2) DEFAULT NULL,
  `paypal_responce` text COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=463 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `product_personalise` */

DROP TABLE IF EXISTS `product_personalise`;

CREATE TABLE `product_personalise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_Id` int(11) NOT NULL,
  `text_field` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `paragraph` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `image_upload` int(11) NOT NULL,
  `color` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `writeown` tinyint(1) NOT NULL DEFAULT 0,
  `writeown_paragraph_char` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `product_personalise_by_user` */

DROP TABLE IF EXISTS `product_personalise_by_user`;

CREATE TABLE `product_personalise_by_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `productImage` varchar(100) NOT NULL,
  `personaliseDetail` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `product_quantity` */

DROP TABLE IF EXISTS `product_quantity`;

CREATE TABLE `product_quantity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qty` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT 0.00,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1553 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `product_size` */

DROP TABLE IF EXISTS `product_size`;

CREATE TABLE `product_size` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `size_id` int(250) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `price` float(10,2) DEFAULT NULL,
  `ncr_number_parts` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ncr_number_parts_french` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ncr_number_part_price` decimal(10,2) DEFAULT 0.00,
  `stock` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stock_french` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stock_extra_price` decimal(10,2) DEFAULT 0.00,
  `paper_quality` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paper_quality_french` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paper_quality_extra_price` decimal(10,2) DEFAULT 0.00,
  `color` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `color_french` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `color_extra_price` decimal(10,2) DEFAULT 0.00,
  `diameter` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `diameter_french` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `diameter_extra_price` decimal(10,2) DEFAULT 0.00,
  `extra_price` decimal(10,2) DEFAULT 0.00,
  `shape_paper` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `shape_paper_french` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `shape_paper_extra_price` decimal(10,2) DEFAULT 0.00,
  `grommets` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `grommets_french` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `grommets_extra_price` decimal(10,2) DEFAULT 0.00,
  PRIMARY KEY (`id`),
  KEY `color_french` (`color_french`),
  KEY `diameter_french` (`diameter_french`)
) ENGINE=InnoDB AUTO_INCREMENT=5192 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `product_size_new` */

DROP TABLE IF EXISTS `product_size_new`;

CREATE TABLE `product_size_new` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qty` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `size_id` int(11) DEFAULT NULL,
  `extra_price` decimal(10,2) DEFAULT 0.00,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `product_size_new_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7325 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `product_subcategory` */

DROP TABLE IF EXISTS `product_subcategory`;

CREATE TABLE `product_subcategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `sub_category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10125 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `product_templates` */

DROP TABLE IF EXISTS `product_templates`;

CREATE TABLE `product_templates` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `final_dimensions` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `final_dimensions_french` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `template_description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `template_description_french` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `template_file` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7112 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `name_french` varchar(255) CHARACTER SET utf8 NOT NULL,
  `price` decimal(10,2) DEFAULT 0.00,
  `price_euro` decimal(10,2) DEFAULT NULL,
  `price_gbp` decimal(10,2) DEFAULT NULL,
  `price_usd` decimal(10,2) DEFAULT NULL,
  `short_description` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `short_description_french` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `full_description` text CHARACTER SET utf8 DEFAULT NULL,
  `full_description_french` text CHARACTER SET utf8 DEFAULT NULL,
  `is_today_deal` tinyint(4) NOT NULL DEFAULT 0,
  `is_today_deal_date` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-is Active 0-Inactive',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `menu_id` tinyint(11) DEFAULT 0,
  `category_id` int(11) NOT NULL DEFAULT 0,
  `sub_category_id` int(11) DEFAULT 0,
  `is_featured` tinyint(4) NOT NULL DEFAULT 0,
  `is_bestseller` tinyint(4) NOT NULL DEFAULT 0,
  `is_special` tinyint(4) NOT NULL DEFAULT 0,
  `is_stock` tinyint(4) NOT NULL DEFAULT 1,
  `poster_plans` tinyint(1) DEFAULT 0,
  `banners_frames` tinyint(1) NOT NULL DEFAULT 0,
  `cards_invites` tinyint(1) NOT NULL DEFAULT 0,
  `photo_gifts` tinyint(1) NOT NULL DEFAULT 0,
  `cart_name` tinyint(1) NOT NULL DEFAULT 0,
  `catalog` tinyint(1) NOT NULL DEFAULT 0,
  `brochure` tinyint(1) NOT NULL DEFAULT 0,
  `is_printed_product` tinyint(1) NOT NULL DEFAULT 0,
  `total_stock` int(11) NOT NULL DEFAULT 0,
  `discount` mediumint(9) NOT NULL DEFAULT 0,
  `product_image` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `code` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `code_french` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `brand` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `reviews` int(11) NOT NULL DEFAULT 0,
  `rating` int(11) NOT NULL DEFAULT 0,
  `total_visited` int(11) NOT NULL DEFAULT 0,
  `delivery_charge` decimal(10,0) NOT NULL DEFAULT 0,
  `is_bestdeal` tinyint(4) NOT NULL DEFAULT 0,
  `product_type` tinyint(4) DEFAULT 2 COMMENT '1-Custum 2-uncutum',
  `min_order_quantity` int(11) NOT NULL,
  `discount_id` int(11) DEFAULT 0,
  `free_shipping` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1- is free 2 - not free',
  `store_id` varchar(250) COLLATE utf8_unicode_ci DEFAULT '1,2',
  `product_tag` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `add_length_width` tinyint(4) DEFAULT 0,
  `min_length` decimal(10,1) DEFAULT NULL,
  `max_length` decimal(10,1) DEFAULT NULL,
  `min_width` decimal(10,1) DEFAULT NULL,
  `max_width` decimal(10,1) DEFAULT NULL,
  `min_length_min_width_price` decimal(10,4) DEFAULT NULL,
  `length_width_pages_type` varchar(10) COLLATE utf8_unicode_ci DEFAULT 'dropdown',
  `length_width_min_quantity` int(11) DEFAULT 25,
  `length_width_max_quantity` int(11) DEFAULT 5000,
  `length_width_quantity_show` tinyint(4) DEFAULT 1,
  `length_width_unit_price_black` decimal(10,4) DEFAULT NULL,
  `length_width_price_color` decimal(10,4) DEFAULT NULL,
  `length_width_color_show` tinyint(4) DEFAULT 0,
  `votre_text` tinyint(4) DEFAULT 0,
  `recto_verso` tinyint(4) DEFAULT 0,
  `recto_verso_price` int(11) DEFAULT 0,
  `page_add_length_width` tinyint(4) DEFAULT 0,
  `page_min_length` decimal(10,1) DEFAULT NULL,
  `page_max_length` decimal(10,1) DEFAULT NULL,
  `page_min_width` decimal(10,1) DEFAULT NULL,
  `page_max_width` decimal(10,1) DEFAULT NULL,
  `page_min_length_min_width_price` decimal(10,4) DEFAULT NULL,
  `page_length_width_pages_type` varchar(10) COLLATE utf8_unicode_ci DEFAULT 'dropdown',
  `page_length_width_pages_show` tinyint(4) DEFAULT 1,
  `page_length_width_sheets_type` varchar(10) COLLATE utf8_unicode_ci DEFAULT 'dropdown',
  `page_length_width_quantity_type` varchar(10) COLLATE utf8_unicode_ci DEFAULT 'input',
  `page_length_width_sheets_show` tinyint(4) DEFAULT 0,
  `page_length_width_price_color` decimal(10,4) DEFAULT NULL,
  `page_length_width_price_black` decimal(10,4) DEFAULT NULL,
  `page_length_width_color_show` tinyint(4) DEFAULT 0,
  `page_length_width_min_quantity` int(11) DEFAULT 25,
  `page_length_width_max_quantity` int(11) DEFAULT 5000,
  `page_length_width_quantity_show` int(11) DEFAULT 1,
  `call` tinyint(4) DEFAULT 0,
  `phone_number` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `model` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `model_french` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `depth_add_length_width` tinyint(4) DEFAULT 0,
  `min_depth` decimal(10,1) DEFAULT NULL,
  `max_depth` decimal(10,1) DEFAULT NULL,
  `depth_min_length` decimal(10,1) DEFAULT NULL,
  `depth_min_width` decimal(10,1) DEFAULT NULL,
  `depth_max_width` decimal(10,1) DEFAULT NULL,
  `depth_width_length_price` decimal(10,4) DEFAULT NULL,
  `depth_width_length_type` varchar(20) COLLATE utf8_unicode_ci DEFAULT 'input',
  `depth_width_length_quantity_show` varchar(20) COLLATE utf8_unicode_ci DEFAULT '1',
  `depth_max_length` decimal(10,1) DEFAULT NULL,
  `depth_min_quantity` int(11) DEFAULT 25,
  `depth_max_quantity` int(11) DEFAULT 5000,
  `depth_price_color` decimal(10,4) DEFAULT NULL,
  `depth_unit_price_black` decimal(10,4) DEFAULT NULL,
  `depth_color_show` tinyint(4) DEFAULT 0,
  `shipping_box_length` decimal(10,2) DEFAULT NULL,
  `shipping_box_width` decimal(10,2) DEFAULT NULL,
  `shipping_box_height` decimal(10,2) DEFAULT NULL,
  `shipping_box_weight` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13090 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `quantity` */

DROP TABLE IF EXISTS `quantity`;

CREATE TABLE `quantity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` int(11) DEFAULT NULL,
  `name_french` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `show_page_size` tinyint(4) DEFAULT 1,
  `set_order` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=165 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `rating` */

DROP TABLE IF EXISTS `rating`;

CREATE TABLE `rating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `review` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `rate` tinyint(4) DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-is Active 0-Inactive',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `sales-tax-rates-provinces` */

DROP TABLE IF EXISTS `sales-tax-rates-provinces`;

CREATE TABLE `sales-tax-rates-provinces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state_id` int(11) DEFAULT NULL,
  `Province` varchar(250) DEFAULT NULL,
  `type` varchar(250) DEFAULT NULL,
  `pst` decimal(10,3) DEFAULT NULL,
  `gst` decimal(10,3) DEFAULT NULL,
  `hst` decimal(10,3) DEFAULT NULL,
  `total_tax_rate` decimal(10,3) DEFAULT NULL,
  `notes` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `sections` */

DROP TABLE IF EXISTS `sections`;

CREATE TABLE `sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `name_france` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `description_france` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `content_france` longtext CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `main_store_id` int(11) NOT NULL DEFAULT 1,
  `background_image` varchar(250) DEFAULT NULL,
  `french_background_image` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

/*Table structure for table `services` */

DROP TABLE IF EXISTS `services`;

CREATE TABLE `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `name_french` varchar(255) DEFAULT NULL,
  `service_image` varchar(255) DEFAULT NULL,
  `service_image_french` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `description_french` longtext DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `main_store_id` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Table structure for table `shapepaper` */

DROP TABLE IF EXISTS `shapepaper`;

CREATE TABLE `shapepaper` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_french` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `sheets` */

DROP TABLE IF EXISTS `sheets`;

CREATE TABLE `sheets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` int(11) DEFAULT NULL,
  `name_french` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `size_multiple_attributes` */

DROP TABLE IF EXISTS `size_multiple_attributes`;

CREATE TABLE `size_multiple_attributes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `size_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `attribute_id` int(11) DEFAULT NULL,
  `attribute_item_id` int(11) DEFAULT NULL,
  `extra_price` decimal(10,2) DEFAULT 0.00,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `multiple_attribute_item_id` (`attribute_item_id`),
  KEY `extra_price` (`extra_price`),
  KEY `created_at` (`created_at`),
  KEY `updated_at` (`updated_at`)
) ENGINE=InnoDB AUTO_INCREMENT=42715 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `sizes` */

DROP TABLE IF EXISTS `sizes`;

CREATE TABLE `sizes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `size_name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `size_name_french` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `set_order` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `size_name` (`size_name`)
) ENGINE=InnoDB AUTO_INCREMENT=207 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `states` */

DROP TABLE IF EXISTS `states`;

CREATE TABLE `states` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `country_id` mediumint(8) unsigned NOT NULL,
  `country_code` char(2) NOT NULL,
  `fips_code` varchar(255) DEFAULT NULL,
  `iso2` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `flag` tinyint(1) NOT NULL DEFAULT 1,
  `wikiDataId` varchar(255) DEFAULT NULL COMMENT 'Rapid API GeoDB Cities',
  `clover_mode` int(1) DEFAULT 0,
  `clover_sandbox_api_key` varchar(255) DEFAULT NULL,
  `clover_sandbox_secret` varchar(255) DEFAULT NULL,
  `clover_api_key` varchar(255) DEFAULT NULL,
  `clover_secret` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `country_region` (`country_id`),
  CONSTRAINT `country_region_final` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4852 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Table structure for table `states_bk` */

DROP TABLE IF EXISTS `states_bk`;

CREATE TABLE `states_bk` (
  `StateID` int(11) NOT NULL AUTO_INCREMENT,
  `StateName` varchar(30) NOT NULL,
  `CountryID` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`StateID`)
) ENGINE=InnoDB AUTO_INCREMENT=4122 DEFAULT CHARSET=latin1;

/*Table structure for table `stocks` */

DROP TABLE IF EXISTS `stocks`;

CREATE TABLE `stocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_french` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `stores` */

DROP TABLE IF EXISTS `stores`;

CREATE TABLE `stores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_id` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `langue_id` int(11) DEFAULT NULL,
  `shopping_id` int(11) DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `default_currency_id` int(11) NOT NULL DEFAULT 1,
  `stor_type` int(11) NOT NULL DEFAULT 1,
  `main_store` int(11) NOT NULL DEFAULT 1,
  `main_store_id` int(11) DEFAULT NULL,
  `order_id_prefix` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `show_all_categories` tinyint(4) NOT NULL DEFAULT 1,
  `show_language_translation` tinyint(4) NOT NULL DEFAULT 1,
  `email_footer_line` text CHARACTER SET utf8 DEFAULT NULL,
  `from_email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'info@printing.coop',
  `admin_email1` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'info@printing.coop',
  `admin_email2` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'imprimeur.coop@gmail.com',
  `admin_email3` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'techbull.in@gmail.com',
  `email_template_logo` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paypal_business_email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'imprimeur.coop@gmail.com',
  `paypal_payment_mode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'sendbox',
  `paypal_sandbox_business_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'sb-ks2ro721209@business.example.com',
  `order_pdf_company` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_pdf_company` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pdf_template_logo` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `http_url` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flag_ship` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `stores_email_images` */

DROP TABLE IF EXISTS `stores_email_images`;

CREATE TABLE `stores_email_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` smallint(4) NOT NULL,
  `email_template_name` varchar(150) DEFAULT NULL,
  `image` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

/*Table structure for table `stores_email_images-bk` */

DROP TABLE IF EXISTS `stores_email_images-bk`;

CREATE TABLE `stores_email_images-bk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` smallint(4) NOT NULL,
  `email_template_name` varchar(150) DEFAULT NULL,
  `image` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Table structure for table `sub_categories` */

DROP TABLE IF EXISTS `sub_categories`;

CREATE TABLE `sub_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_french` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-is Active 0-Inactive',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL DEFAULT 0,
  `sub_category_order` int(11) NOT NULL,
  `image` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sub_category_dispersion` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `sub_category_dispersion_french` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `show_main_menu` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=222 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `sub_module` */

DROP TABLE IF EXISTS `sub_module`;

CREATE TABLE `sub_module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` int(11) DEFAULT NULL,
  `sub_module_name` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `url` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `show_menu` tinyint(4) DEFAULT 1,
  `status` tinyint(4) DEFAULT 1,
  `sub_module_class` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT 'fas fa-circle',
  PRIMARY KEY (`id`),
  KEY `module_id` (`module_id`,`sub_module_name`),
  KEY `module_id_2` (`module_id`,`order`,`sub_module_name`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `subscribe_emails` */

DROP TABLE IF EXISTS `subscribe_emails`;

CREATE TABLE `subscribe_emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-is Active 0-Inactive',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `store_id` int(11) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `tags` */

DROP TABLE IF EXISTS `tags`;

CREATE TABLE `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_french` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tag_order` int(11) DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `image` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_french` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proudly_display_your_brand` tinyint(4) NOT NULL DEFAULT 0,
  `montreal_book_printing` tinyint(4) NOT NULL DEFAULT 0,
  `footer` tinyint(4) NOT NULL DEFAULT 0,
  `font_class` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT 'la la-credit-card',
  `store_id` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1,2,3,4',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `ticket_comments` */

DROP TABLE IF EXISTS `ticket_comments`;

CREATE TABLE `ticket_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `type` tinyint(4) DEFAULT 1 COMMENT '1-text and 2=media',
  `ticket_id` int(11) DEFAULT NULL,
  `receiver_read` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 is not read and 2 is read',
  `comment_author` int(11) NOT NULL DEFAULT 0 COMMENT '0 is Support and 0 < is user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `tickets` */

DROP TABLE IF EXISTS `tickets`;

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` tinyint(4) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `contact_no` varchar(10) NOT NULL,
  `subject` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fname` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lname` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-is Active 0-Inactive',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` varchar(10) CHARACTER SET utf8 NOT NULL DEFAULT 'customer',
  `profile_pic` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `last_login_ip` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_verification` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0-unverifid,1-verifid ',
  `company_name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `responsible_name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cp` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active_area` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `region` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip_code` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `request` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-normal 2-Pipred',
  `preferred_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 activre 1-active',
  `store_id` int(11) DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `store_id` (`store_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=393 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `wishlists` */

DROP TABLE IF EXISTS `wishlists`;

CREATE TABLE `wishlists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL DEFAULT 0 COMMENT '1-is Active 0-Inactive',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
