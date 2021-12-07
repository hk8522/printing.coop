-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 20, 2020 at 10:08 AM
-- Server version: 10.3.18-MariaDB-cll-lve
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nnheonou_printingcoop`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pin_code` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-is Active 0-Inactive',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `mobile` bigint(20) DEFAULT 0,
  `address` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `city` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(10) COLLATE utf8_unicode_ci DEFAULT 'India',
  `state` smallint(6) DEFAULT NULL,
  `landmark` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alternate_phone` bigint(20) NOT NULL DEFAULT 0,
  `address_type` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `default_delivery_address` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `user_id`, `name`, `pin_code`, `status`, `created`, `updated`, `mobile`, `address`, `city`, `country`, `state`, `landmark`, `alternate_phone`, `address_type`, `default_delivery_address`) VALUES
(1, 1, 'Neelu Sharma', '476111', 1, '2019-07-20 11:37:48', '2019-07-20 11:58:28', 7837130540, 'Sco11 11', 'Mohali', 'India', 66, 'Amar Hospital', 7837130540, 'home', 1),
(2, 1, 'Neelu Sharma', '160071', 1, '2019-07-20 12:14:55', '2019-07-20 12:14:55', 9907767164, 'Sco11 11', 'Mohali', 'India', 53, 'Amar Hospital', 9879744444, 'work', NULL),
(3, 19, 'Noor Sharma ', '160059', 1, '2019-07-23 06:24:20', '2019-07-23 06:24:20', 9478233816, '5 Phase Mohali', 'Mohali', 'India', 53, 'Hari mandir', 0, 'home', 1),
(4, 19, 'Noor Sharma ', '160059', 1, '2019-07-23 06:25:02', '2019-07-23 06:25:02', 9478233816, '& phase industrial area', 'Mohali', 'India', 53, 'ICICI Bank ', 0, 'work', NULL),
(5, 20, 'Noor Sharma ', '160059', 1, '2019-07-23 08:02:02', '2019-07-23 08:02:02', 9478233816, '5 Phase Mohali', 'Mohali', 'India', 53, 'ICICI Bank ', 0, 'home', 1),
(6, 23, 'Noor Sharma ', '160059', 1, '2019-07-23 10:26:32', '2019-07-25 11:16:09', 9478233816, '5 Phase Mohali', 'Mohali', 'India', 53, 'ICICI Bank ', 9478233816, 'home', 1),
(7, 23, 'test', '145847', 1, '2019-07-24 10:11:28', '2019-07-24 10:11:28', 5896514822, 'mohlai', 'mohlai', 'India', 64, 'hari', 5896514822, 'work', NULL),
(8, 23, 'Noor', '169970', 1, '2019-07-25 11:05:28', '2019-07-25 11:05:28', 9478233816, 'Mohali', 'Mohali', 'India', 53, 'Hari mandir', 0, 'home', NULL),
(9, 24, 'Peehu', '160089', 1, '2019-07-25 12:33:07', '2019-07-25 12:33:07', 9478233816, '1683 Mohali 5 phase ', 'Mohali ', 'India', 53, 'Hari mandir', 9478233816, 'home', 1),
(10, 24, 'Noor ', '160059', 1, '2019-07-26 11:45:26', '2019-07-26 11:45:26', 9478233816, '1683 Mohali 5 Phase', 'Mohali', 'India', 53, 'Hari mandir ', 9478233816, 'home', NULL),
(11, 25, 'Peehu', '160059', 1, '2019-07-26 13:00:31', '2019-07-26 15:41:49', 9478233819, '5phase mohali', 'Mohali', 'India', 53, 'Hari Mandir', 9478233819, 'home', 1),
(13, 25, 'Noor ', '160059', 1, '2019-07-26 15:52:41', '2019-07-26 15:52:41', 9478233816, '1683 Mohali 5 Phase', 'Mohali', 'India', 50, 'Hari mandir ', 0, 'work', NULL),
(14, 25, 'Noor ', '160059', 1, '2019-07-26 15:56:11', '2019-07-26 15:56:11', 9478233816, '1683 Mohali 5 Phase', 'Mohali', 'India', 53, 'Hari mandir ', 0, 'home', NULL),
(15, 26, 'Love ', '160089', 1, '2019-07-30 12:38:38', '2019-07-30 12:38:38', 7973440852, 'Mohali ', 'Mohali ', 'India', 53, 'Hari mandir ', 0, 'home', 1),
(17, 27, 'Peehu', '160059', 1, '2019-08-12 15:09:14', '2019-08-12 15:09:14', 9478233816, 'Mohali 5 phase', 'Mohali ', 'India', 53, 'Hari Mandir ', 9865321478, 'home', 1),
(18, 28, 'Lucy', '100331', 1, '2019-08-14 11:38:05', '2019-08-14 11:38:05', 9478233816, 'Mohali ', 'Mohali ', 'India', 53, 'Mohali ', 9478233816, 'home', 1),
(19, 28, 'Lucy', '100331', 1, '2019-08-14 11:38:05', '2019-08-14 11:38:05', 9478233816, 'Mohali ', 'Mohali ', 'India', 53, 'Mohali ', 9478233816, 'home', NULL),
(20, 30, 'Lucy', '160059', 1, '2019-08-21 11:57:31', '2019-08-21 11:58:14', 9478233816, 'Mohali ', 'Mohali ', 'India', 53, 'Mohali ', 9478233816, 'home', 1),
(21, 31, 'Peehu', '160059', 1, '2019-08-21 17:00:23', '2019-08-21 17:09:52', 9478233819, '5phase mohali', 'Mohali', 'India', 53, 'PUNJAB', 9478233819, 'home', 1),
(22, 32, 'sumit', '177107', 1, '2019-10-11 10:39:59', '2019-10-11 10:39:59', 9736511416, 'garh', 'kangra', 'India', 42, 'fwewf', 8956412365, 'home', 1),
(23, 35, 'neelu', '476111', 1, '2019-10-19 12:22:43', '2019-10-19 12:22:43', 7837130540, '1128 Sector-70 ', 'Mohali', 'India', 53, 'Amar Hospital', 7837130540, 'home', 1),
(24, 36, 'neelu', '476111', 1, '2019-10-19 13:53:10', '2019-10-19 14:36:43', 7837130540, '1128 Sector-70', 'Mohali', 'India', 53, 'Amar Hospital', 7837130540, 'home', 1),
(25, 38, 'Neelu Kuamr', '476111', 1, '2019-11-08 17:28:47', '2019-11-08 17:28:48', 7837130540, '1128 Sector-70', 'Ambala', 'India', 60, 'Amar Hospital', 7837130540, 'home', 1),
(26, 41, 'Neelu Sharma', '476111', 1, '2020-01-01 12:24:56', '2020-01-01 12:24:57', 7837130540, '1128 Sector-70', 'Mohali', 'India', 53, 'Amar Hospital', 7837130540, 'home', 1);

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-is Active 0-Inactive',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'admin',
  `profile_pic` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `status`, `created`, `updated`, `email`, `password`, `username`, `role`, `profile_pic`) VALUES
(1, 'admin', 1, '2019-07-10 05:19:07', '2019-07-28 20:19:37', 'printingcoop@gmail.com', '379868b714d47de2433f19ecc276a89b', 'printingcoop', 'admin', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `short_description` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `full_description` text CHARACTER SET utf8 DEFAULT NULL,
  `banner_image` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-is Active 0-Inactive',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `title` varchar(200) NOT NULL,
  `tags` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `title`, `tags`) VALUES
(1, 'ECMAScript 2015: A SitePoint Anthology', '{\"writeown\":[\"1\",\"1\"],\"paragraph_char\":[\"ger\",\"ergegreg\"],\"paragraph_title\":[\"erge\",\"ergreg\"],\"paragraph_character\":[\"ergeg\",\"regreger\"],\"paragraph_description\":[\"ergeg\",\"ergeg\"]}');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `short_description` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `full_description` text CHARACTER SET utf8 DEFAULT NULL,
  `brand_image` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-is Active 0-Inactive',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-is Active 0-Inactive',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `menu_id` int(11) NOT NULL DEFAULT 0,
  `category_order` int(11) NOT NULL,
  `image` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` int(11) NOT NULL,
  `code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `discount_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'discount_percent',
  `discount` float(10,2) NOT NULL DEFAULT 0.00,
  `discount_valid_from` datetime DEFAULT NULL,
  `discount_valid_to` datetime DEFAULT NULL,
  `discount_requirement_quantity` mediumint(9) DEFAULT 1,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `discount_code_limit` mediumint(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-is Active 0-Inactive',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `menu_order` smallint(6) NOT NULL DEFAULT 0,
  `image` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `collection` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `description` longtext CHARACTER SET utf8 DEFAULT NULL,
  `html` longtext CHARACTER SET utf8 DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `shortOrder` smallint(6) NOT NULL DEFAULT 0,
  `slug` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `category_id`, `title`, `description`, `html`, `created`, `updated`, `status`, `shortOrder`, `slug`) VALUES
(1, 2, 'About Us', '<p>hiiii</p>\r\n', NULL, '2019-10-23 13:49:51', '2019-11-10 08:06:14', 1, 1, 'about-us'),
(2, 2, 'Delivery Information', '<div class=\"row\">\r\n            <div class=\"col-md-12\">\r\n                <div class=\"latest-product-section\">\r\n                    <div class=\"main-single-section\">\r\n                        <div class=\"main-single\">\r\n                            <div class=\"main-single-title\">\r\n                                <span>General Information</span>\r\n                            </div>\r\n                            <div class=\"main-single-info\">\r\n                                <span>All orders are subject to product availability. If an item is not in stock at the time you place your order, we will notify you and refund you the total amount of your order, using the original method of payment. </span>\r\n                            </div>\r\n                        </div>\r\n                        <div class=\"main-single\">\r\n                            <div class=\"main-single-title\">\r\n                                <span>Delivery Time</span>\r\n                            </div>\r\n                            <div class=\"main-single-info\">\r\n                                <span>An estimated delivery time will be provided to you once your order is placed. Delivery times are estimates and commence from the date of shipping, rather than the date of order. Delivery times are to be used as a guide only and are subject to the acceptance and approval of your order. \r\n                                <br>Unless there are exceptional circumstances, we make every effort to fulfill your order within [15] business days of the date of your order. Business day mean Monday to Saturday, except Sundays and Public holidays.\r\n                                <br>Please note we do not ship on [Sundays].</span>\r\n                            </div>\r\n                        </div>\r\n                        <div class=\"main-single\">\r\n                            <div class=\"main-single-title\">\r\n                                <span>Shipping Costs</span>\r\n                            </div>\r\n                            <div class=\"main-single-info\">\r\n                                <span>Shipping costs are based on the weight of your order and the delivery method. To find out how much your order will cost, simple add the items you would like to purchase to your cart, and proceed to the checkout page. Once at the checkout screen, shipping charges will be displayed.\r\n                                <br>Additional shipping charges may apply to remote areas or for large or heavy items. You will be advised of any charges on the checkout page.\r\n                                <br>Sales tax is charged according to the province or territory to which the item is shipped.</span>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </div>', NULL, '2019-10-23 13:52:54', '2019-10-23 13:52:54', 1, 2, 'delivery-information'),
(3, 2, 'Privacy Policy', ' <div class=\"row\">\r\n            <div class=\"col-md-12\">\r\n                <div class=\"latest-product-section\">\r\n                    <div class=\"main-single-section\">\r\n                        <div class=\"main-single\">\r\n                            <div class=\"main-single-info\">\r\n                                <span>http://uniquely.pickseoexpert.com  recognizes the importance of maintaining your privacy. We value your privacy and appreciate your trust in us. \r\n                                This Policy describes how we treat user information we collect on http://uniquely.pickseoexpert.com and other offline sources. \r\n                                This Privacy Policy applies to current and former visitors to our website and to our online customers. \r\n                                By visiting and/or using our website, you agree to this Privacy Policy.</span>\r\n                            </div>\r\n                        </div>\r\n                        <div class=\"main-single\">\r\n                        	<div class=\"main-single-title\">\r\n                        	    <span>Information we collect Contact information.</span>\r\n                        	</div>\r\n                        	<div class=\"main-single-info\">\r\n                        	    <span>We might collect your name, email, mobile number, phone number, street, city, state, pin code, country and ip address.</span>\r\n                        	</div>\r\n                        </div>\r\n                        <div class=\"main-single\">\r\n                        	<div class=\"main-single-title\">\r\n                        	    <span>Payment and billing information.</span>\r\n                        	</div>\r\n                        	<div class=\"main-single-info\">\r\n                        	    <span>We might collect your billing name, billing address and payment method when you buy a ticket. We NEVER collect your credit card number or credit card expiry date or other details pertaining to your credit card on our website. Credit card information will be obtained and processed by our online payment partner CC Avenue.</span>\r\n                        	</div>\r\n                        </div>\r\n                        <div class=\"main-single\">\r\n                        	<div class=\"main-single-title\">\r\n                        	    <span>Information you post.</span>\r\n                        	</div>\r\n                        	<div class=\"main-single-info\">\r\n                        	    <span>We collect information you post in a public space on our website or on a third party social media site belonging to http://uniquely.pickseoexpert.com</span>\r\n                        	</div>\r\n                        </div>\r\n                        <div class=\"main-single\">\r\n                        	<div class=\"main-single-title\">\r\n                        	    <span>Demographic information.</span>\r\n                        	</div>\r\n                        	<div class=\"main-single-info\">\r\n                        	    <span>We may collect demographic information about you, events you like, events you intend to participate in, tickets you buy, or any other information provided by your during the use of our website. We might collect this as a part of a survey also.</span>\r\n                        	</div>\r\n                        </div>\r\n                        <div class=\"main-single\">\r\n                        	<div class=\"main-single-title\">\r\n                        	    <span>Other information.</span>\r\n                        	</div>\r\n                        	<div class=\"main-single-info\">\r\n                        	    <span>If you use our website, we may collect information about your IP address and the browser you\'re using. We might look at what site you came from, duration of time spent on our website, pages accessed or what site you visit when you leave us. We might also collect the type of mobile device you are using, or the version of the operating system your computer or device is running.</span>\r\n                        	</div>\r\n                        </div>\r\n                        <div class=\"main-single\">\r\n                        	<div class=\"main-single-title\">\r\n                        	    <span>We collect information in different ways.</span>\r\n                        	</div>\r\n                        	<div class=\"main-single-info\">\r\n                        	    <span>\r\n                        	    	<b>We collect information directly from you.</b> We collect information directly from you when you register for an event or buy tickets. We also collect information if you post a comment on our websites or ask us a question through phone or email.\r\n                        	    	<br>\r\n                        	    	<b>We collect information from you passively</b> We use tracking tools like Google Analytics, Google Webmaster, browser cookies and web beacons for collecting information about your usage of our website.<br>\r\n                        \r\n                        	    	<b>We get information about you from third parties.</b> For example, if you use an integrated social media feature on our websites. The third party social media site will give us certain information about you. This could include your name and email address.\r\n                        	    </span>\r\n	                        </div>\r\n                        </div>\r\n                        <div class=\"main-single\">\r\n                        	<div class=\"main-single-title\">\r\n                        	    <span>Use of your personal information</span>\r\n                        	</div>\r\n                        	<div class=\"main-single-info\">\r\n	                            <span>\r\n	    	<b> We use information to contact you:</b> We might use the information you provide to contact you for confirmation of a purchase on our website or for other promotional purposes.<br>\r\n	    	<b>We use information to respond to your requests or questions.</b> We might use your information to confirm your registration for an event or contest.<br>\r\n	    	<b>We use information to improve our products and services.</b> We might use your information to customize your experience with us. This could include displaying content based upon your preferences.<br>\r\n	    	<b>We use information to look at site trends and customer interests.</b> We may use your information to make our website and products better. We may combine information we get from you with information about you we get from third parties.<br>\r\n	    	<b>We use information for security purposes.</b> We may use information to protect our company, our customers, or our websites.<br>\r\n	    	<b>We use information for marketing purposes.</b> We might send you information about special promotions or offers. We might also tell you about new features or products. These might be our own offers or products, or third party offers or products we think you might find interesting. Or, for example, if you buy tickets from us we\'ll enroll you in our newsletter.<br>\r\n	    	<b>We use information to send you transactional communications.</b> We might send you emails or SMS about your account or a ticket purchase.<br>\r\n	    	We use information as otherwise permitted by law.<br>\r\n	    	<b>Sharing of information with third parties.</b> We will share information with third parties who perform services on our behalf. We share information with vendors who help us manage our online registration process or payment processors or transactional message processors. Some vendors may be located outside of India.<br>\r\n	    	<b>We will share information with the event organizers.</b> We share your information with event organizers and other parties responsible for fulfilling the purchase obligation. The event organizers and other parties may use the information we give them as described in their privacy policies.\r\n	    	<br>\r\n	    	<b>We will share information with our business partners.</b>\r\n	    	<br>This includes a third party who provide or sponsor an event, or who operates a venue where we hold events. Our partners use the information we give them as described in their privacy policies.\r\n	    	<br>\r\n	    	<b>We may share information if we think we have to in order to comply with the law or to protect ourselves.</b> We will share information to respond to a court order or subpoena.<br>\r\n	    	<b>We may also share it if a government agency or investigatory body requests.</b> Or, we might also share information when we are investigating potential fraud.<br>\r\n	    	<b>We may share information with any successor to all or part of our business.</b> For example, if part of our business is sold we may give our customer list as part of that transaction.<br>\r\n	    	<b>We may share your information for reasons not described in this policy.</b> We will tell you before we do<br>\r\n	    	<b>Email Opt-Out</b><br>You can opt out of receiving our marketing emails. To stop receiving our promotional emails, please feel free to contact us. It may take about ten days to process your request. Even if you opt out of getting marketing messages, we will still be sending you transactional messages through email and SMS about your purchases.<br>\r\n	    	<b>Third party sites</b><br> If you click on one of the links to third party websites, you may be taken to websites we do not control. This policy does not apply to the privacy practices of those websites. Read the privacy policy of other websites carefully. We are not responsible for these third party sites.<br>\r\n	    </span>\r\n	                        </div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </div>', NULL, '2019-10-23 13:56:54', '2019-10-23 13:56:54', 1, 3, 'privacy-policy'),
(4, 2, 'Terms & Conditions', '<div class=\"row\">\r\n            <div class=\"col-md-12\">\r\n                <div class=\"latest-product-section\">\r\n                    <div class=\"main-single-section\">\r\n                        <div class=\"main-single\">\r\n                            <div class=\"main-single-info\">\r\n                                <span>PLEASE READ THIS TERMS OF SERVICE AGREEMENT CAREFULLY. BY USING THIS WEBSITE OR ORDERING PRODUCTS FROM THIS WEBSITE YOU AGREE TO BE BOUND BY ALL OF THE TERMS AND CONDITIONS OF THIS AGREEMENT.\r\n                                <br>\r\n                                    This Terms of Service Agreement governs your use of this website,<a href=\"index.php\"> http://uniquely.pickseoexpert.com</a>, \r\n                                    the \"http://uniquely.pickseoexpert.com\", http://uniquely.pickseoexpert.com, http://uniquely.pickseoexpert.com offer of products for purchase on this Website, \r\n                                    or your purchase of products available on this Website. This Agreement includes, and incorporates by this reference, \r\n                                    the policies and guidelines referenced below. http://uniquely.pickseoexpert.com reserves the right to change or revise the terms and \r\n                                    conditions of this Agreement at any time by posting any changes or a revised Agreement on this Website. http://uniquely.pickseoexpert.com \r\n                                    will alert you that changes or revisions have been made by indicating on the top of this Agreement the date it was last revised. \r\n                                    The changed or revised Agreement will be effective immediately after it is posted on this Website. Your use of the Website following the \r\n                                    posting any such changes or of a revised Agreement will constitute your acceptance of any such changes or revisions. http://uniquely.pickseoexpert.com \r\n                                    encourages you to review this Agreement whenever you visit the Website to make sure that you understand the terms and conditions governing \r\n                                    use of the Website. This Agreement does not alter in any way the terms or conditions of any other written agreement you may have with \r\n                                    http://uniquely.pickseoexpert.com for other products or services. If you do not agree to this Agreement (including any referenced policies or guidelines), \r\n                                    please immediately terminate your use of the Website.</span>\r\n                            </div>\r\n                        </div>\r\n                        <div class=\"main-single\">\r\n                            <div class=\"main-single-title\">\r\n                                <span>Proprietary Rights. </span>\r\n                            </div>\r\n                            <div class=\"main-single-info\">\r\n                                <span>http://uniquely.pickseoexpert.com has proprietary rights and trade secrets in the Products. You may not copy, reproduce, resell or redistribute any Product manufactured \r\n                                and/or distributed by http://uniquely.pickseoexpert.com. http://uniquely.pickseoexpert.com also has rights to all trademarks and trade dress and specific layouts of this webpage, including \r\n                                calls to action, text placement, images and other information.</span>\r\n                            </div>\r\n                        </div>\r\n                        <div class=\"main-single\">\r\n                            <div class=\"main-single-title\">\r\n                                <span>Sales Tax.</span>\r\n                            </div>\r\n                            <div class=\"main-single-info\">\r\n                                <span>If you purchase any Products, you will be responsible for paying any applicable sales tax.</span>\r\n                            </div>\r\n                        </div>\r\n                        <div class=\"main-single\">\r\n                            <div class=\"main-single-title\">\r\n                                <span>WEBSITE</span>\r\n                            </div>\r\n                            <div class=\"main-single-info\">\r\n                                <span>In addition to making Products available, this Website also offers information and marketing materials. To the extent that http://uniquely.pickseoexpert.com does create \r\n                                the content on this Website, such content is protected by intellectual property laws of the India, foreign nations, and international bodies. Unauthorized use \r\n                                of the material may violate copyright, trademark, and/or other laws. You acknowledge that your use of the content on this Website is for personal, noncommercial use. \r\n                                Any links to third party websites are provided solely as a convenience to you. http://uniquely.pickseoexpert.com does not endorse the contents on any such third-party websites \r\n                                http://uniquely.pickseoexpert.com is not responsible for the content of or any damage that may result from your access to or reliance on these third-party websites. \r\n                                If you link to third-party websites, you do so at your own risk. Use of Website; http://uniquely.pickseoexpert.com is not responsible for any damages resulting from use of this\r\n                                website by anyone. You will not use the Website for illegal purposes. You will (1) abide by all applicable local, state, national, and international laws and \r\n                                regulations in your use of the Website (including laws regarding intellectual property), (2) not interfere with or disrupt the use and enjoyment of the Website \r\n                                by other users, (3) not resell material on the Website, (4) not engage, directly or indirectly, in transmission of \"spam\", chain letters, junk mail or any other type \r\n                                of unsolicited communication, and (5) not defame, harass, abuse, or disrupt other users of the Website License. By using this Website, you are granted a limited, \r\n                                non-exclusive, nontransferable right to use the content and materials on the Website in connection with your normal, noncommercial, use of the Website. \r\n                                You may not copy, reproduce, transmit, distribute, or create derivative works of such content or information without express written authorization \r\n                                from http://uniquely.pickseoexpert.com</span>\r\n                            </div>\r\n                        </div>\r\n                        <div class=\"main-single\">\r\n                            <div class=\"main-single-title\">\r\n                                <span>AGREEMENT TO BE BOUND</span>\r\n                            </div>\r\n                            <div class=\"main-single-info\">\r\n                                <span>By using this Website or ordering Products, you acknowledge that you have read and agree to be bound by this Agreement and all terms and conditions \r\n                                on this Website.</span>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </div>', NULL, '2019-10-23 13:57:52', '2019-10-23 13:57:52', 1, 4, 'terms-conditions'),
(5, 3, 'Contact Us', '<div class=\"latest-product-section\">\r\n            <div class=\"main-single-section\">\r\n            	<div class=\"row align-items-center\">\r\n	                <div class=\"col-md-6\">\r\n	                    <div class=\"contact-text-section\">\r\n	                        <div class=\"contact-title-section\">\r\n	                            <div class=\"contact-title1\">\r\n	                                <span>contact us</span>\r\n	                            </div>\r\n	                            <div class=\"contact-detail-section\">\r\n	                                <div class=\"contact-single-detail\">\r\n	                                    <i class=\"fas fa-map-marker-alt\"></i>\r\n	                                    <div class=\"contact-single-detail-text\">\r\n	                                        <div class=\"contact-single-detail-title\">\r\n	                                            <span>Address:</span>\r\n	                                        </div>\r\n	                                        <div class=\"contact-single-detail-info\">\r\n	                                            <span>\r\n	                                                ABC ADDRESS<br>\r\n	                                                XYZ AREA<br>\r\n	                                                1010101<br>\r\n	                                            </span>\r\n	                                        </div>\r\n	                                    </div>\r\n	                                </div>\r\n	                                <div class=\"contact-single-detail\">\r\n	                                    <i class=\"fas fa-phone\"></i>\r\n	                                    <div class=\"contact-single-detail-text\">\r\n	                                        <div class=\"contact-single-detail-title\">\r\n	                                            <span>Telephone:</span>\r\n	                                        </div>\r\n	                                        <div class=\"contact-single-detail-info\">\r\n	                                            <span>\r\n	                                                +91- 0000000000\r\n	                                                <br>\r\n	                                                +91- 0000000001\r\n	                                            </span>\r\n	                                        </div>\r\n	                                    </div>\r\n	                                </div>\r\n	                                <div class=\"contact-single-detail\">\r\n	                                    <i class=\"far fa-envelope\"></i>\r\n	                                    <div class=\"contact-single-detail-text\">\r\n	                                        <div class=\"contact-single-detail-title\">\r\n	                                            <span><a href=\"#\">email@email.com</a></span>\r\n	                                        </div>\r\n	                                    </div>\r\n	                                </div>\r\n	                            </div>\r\n	                        </div>\r\n	                    </div>\r\n	                </div>\r\n	                <div class=\"col-md-6\">\r\n	                	<div class=\"contact-img\">\r\n	                		<img src=\"http://uniquely.pickseoexpert.com/assets/images/dnb6-US70.jpg\">\r\n	                	</div>\r\n	                </div>\r\n                </div>\r\n            </div>\r\n        </div>', NULL, '2019-10-23 14:00:49', '2019-10-23 14:00:49', 1, 1, 'contact-us'),
(6, 3, 'Return and Refund Policy', '<div class=\"row\">\r\n            <div class=\"col-md-12\">\r\n                <div class=\"latest-product-section\">\r\n                    <div class=\"main-single-section\">\r\n                        <div class=\"main-single\">\r\n                            <div class=\"main-single-title\">\r\n                                <span>Return & Refund Policy</span>\r\n                            </div>\r\n                            <div class=\"main-single-info\">\r\n                                <span>Thank you for shopping at Uniquely Yours. If you are not entirely satisfied with your purchase, we are here to help.</span>\r\n                            </div>\r\n                        </div>\r\n                        <div class=\"main-single\">\r\n                            <div class=\"main-single-title\">\r\n                                <span>Returns</span>\r\n                            </div>\r\n                            <div class=\"main-single-info\">\r\n                                <span>You have 7 calendar days to return an item from the date you received it. To be eligible for a return the receipt or proof of purchase is required. Your item must be unused and in the same condition that you received it. Your item must be in the original packaging.</span>\r\n                            </div>\r\n                        </div>\r\n                        <div class=\"main-single\">\r\n                            <div class=\"main-single-title\">\r\n                                <span>Refunds</span>\r\n                            </div>\r\n                            <div class=\"main-single-info\">\r\n                                <span>Once we receive your item, we will inspect it and notify you on the status of your refund. The total refund amount may vary based on the condition of the item, how long you’ve had it and how the item was purchased. If your return is approved, we will initiate a refund to your credit card (or original method of payment). You will receive the credit within a 10 business days, depending on your card issuer&#39;s policies.</span>\r\n                            </div>\r\n                        </div>\r\n                        <div class=\"main-single\">\r\n                            <div class=\"main-single-title\">\r\n                                <span>Shipping</span>\r\n                            </div>\r\n                            <div class=\"main-single-info\">\r\n                                <span>You will be responsible for paying for your own shipping costs for returning your item. Shipping costs are nonrefundable. If you receive a refund, the cost of return shipping will be deducted from your refund.</span>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </div>', NULL, '2019-10-23 14:02:40', '2019-12-18 16:43:44', 1, 2, 'returns-policy'),
(7, 4, 'Brands', '', NULL, '2019-10-23 16:11:21', '2019-10-23 16:11:21', 1, 1, 'brands'),
(8, 4, 'Support', '', NULL, '2019-10-23 16:11:47', '2019-10-23 16:11:47', 1, 2, 'support'),
(9, 5, 'My Account', '', NULL, '2019-10-23 16:13:38', '2019-10-23 16:13:38', 1, 1, 'my-account'),
(10, 5, 'Order History', '', NULL, '2019-10-23 16:14:43', '2019-10-23 16:14:43', 1, 2, 'order-history'),
(11, 5, 'Wishlist', '', NULL, '2019-10-23 16:15:19', '2019-10-23 16:15:19', 1, 3, 'wishlist'),
(12, 3, 'User Agreement & Policies', '<div class=\"row\">\r\n    <div class=\"col-md-12\">\r\n        <div class=\"latest-product-section\">\r\n            <div class=\"main-single-section\">\r\n                <div class=\"main-single\">\r\n                    <div class=\"main-single-title\">\r\n                        <span>What this Agreement Covers</span>\r\n                    </div>\r\n                    <div class=\"main-single-info\">\r\n                        <span>\r\n                            This Agreement governs your use of the Site and the Uniquely Yours service (the \"Service\"). The Service permits customers to design and purchase custom merchandise. You understand that by using the Site and the Service, you have agreed to the terms and conditions of this Agreement and you agree to use the  and the Service solely as provided in this Agreement.\r\n                        </span>\r\n                    </div>\r\n                </div>\r\n                <div class=\"main-single\">\r\n                    <div class=\"main-single-title\">\r\n                        <span>Intellectual Property Rights of Uniquely Yours and Third Parties</span>\r\n                    </div>\r\n                    <div class=\"main-single-info\">\r\n                        <span>\r\n                            Uniquely Yours is committed to the appropriate and legal use of the intellectual property of others, and we require our users to behave similarly. Unless otherwise noted, all materials, including images, illustrations, designs, icons, photographs and written and other materials that appear on the Uniquely Yours Site (collectively the \"Contents\") are copyrights, trademarks, trade dress and/or other intellectual properties owned, controlled or licensed by Uniquely Yours.\r\n                            <br>\r\n                            Trademarks made available through this Site, including logos, slogans, color schemes and design trademarks, are licensed for use by Uniquely Yours from and other third parties (the \"Licensed Marks\"). By using the Uniquely Yours Site, you agree to limit your use of Licensed Marks to uses that are directly  to such third parties and to comply with any restrictions or conditions imposed on the use and access of the Licensed Marks by the third parties. Yours will notify you of such terms if your usage is in violation of such terms.\r\n                            <br>\r\n                            Generally, products created using images available on the site should not be resold commercially. In the event that you wish to resell such products, you agree contact Uniquely Yours and verify the legality of reselling such products prior to doing so. Designs created using the text tools and images available through the site are in no way the exclusive property of the customers who assemble such designs. Uniquely Yours retains the right to display such designs or offer them (or variations of such designs) to other customers.\r\n                            <br>\r\n                            Additionally Uniquely Yours has the sole discretion to reject any order that it considers libelous, defamatory, obscene, profane (according to standards by Consumer Affairs), portraying irresponsible use of alcohol or other substances, advocating persecution based on gender, age, race, religion, disability or, containing explicit sexual content or is otherwise inappropriate for Uniquely Yours production.\r\n                            <br>\r\n                            You agree to not use Uniquely Yours’ Service to create any material that is unlawful, harmful, threatening, abusive, harassing, tortious, defamatory, vulgar, obscene, libelous, invasive of another&#39;s privacy, hateful, or racially, ethnically or otherwise objectionable, or that infringes on any patent, trademark, trade , copyright or other proprietary rights of any third party.\r\n                        </span>\r\n                    </div>\r\n                </div>\r\n                <div class=\"main-single\">\r\n                    <div class=\"main-single-title\">\r\n                        <span>Payment Policies</span>\r\n                    </div>\r\n                    <div class=\"main-single-info\">\r\n                        <span>Uniquely Yours accepts online or telephone payment via credit card or debit card. All payments sent electronically are securely transmitted. Uniquely Yours also accepts payment via purchase order for qualified customers. Invoices may be paid by credit card, debit card or local purchase order. Local purchase orders must be submitted to Uniquely Yours retail store before processing an order.</span>\r\n                    </div>\r\n                </div>\r\n                <div class=\"main-single\">\r\n                    <div class=\"main-single-title\">\r\n                        <span>Cancellation Policy</span>\r\n                    </div>\r\n                    <div class=\"main-single-info\">\r\n                        <span>For Standard Delivery orders, you may change or cancel your order within one (1) hour of submitting your order. For Rush Delivery orders (any order requiring  delivery than a Standard Delivery order), you may not change or cancel your order.</span>\r\n                    </div>\r\n                </div>\r\n                <div class=\"main-single\">\r\n                    <div class=\"main-single-title\">\r\n                        <span>Limit of Uniquely Yours’ Responsibility</span>\r\n                    </div>\r\n                    <div class=\"main-single-info\">\r\n                        <span>\r\n                            Uniquely Yours will be responsible for acting only on those instructions sent to Uniquely Yours that actually are received and does not assume responsibility for malfunctions in communications facilities not under its control that may affect the accuracy or timeliness of any orders you send. Uniquely Yours is not responsible for any losses or delays in transmission of orders arising out of the use of any Internet Access Service Provider or caused by any browser software or any computer virus or related problem that may be attributable to services provided by any Internet Access Service Provider. Uniquely Yours is not responsible should you give incorrect instructions or if your credit-card payment is not processed by your credit-card company.\r\n                            <br>\r\n                            The information and materials contained in this Site, including text, graphics, links or other items, are provided &quot;as is&quot;, &quot;as available&quot;. Uniquely Yours does not warrant the accuracy, adequacy or completeness of the information and materials on the Site and expressly disclaims liability for errors or omissions in this information and materials. No warranty of any kind, implied, express or statutory, including but not limited to the warranties of non-infringement of third party rights, title, merchantability, fitness for a particular purpose or freedom from computer virus, is given in conjunction with the information and materials.\r\n                            <br>\r\n                            In no event will Uniquely Yours be liable for any damages, including without limitation, direct or indirect, special, incidental, or consequential damages, losses or expenses arising in connection with this site or use thereof or inability to use by any party, or in connection with any failure of performance, error, omission, interruption, defect, delay in operation or transmission, computer virus or line or system failure, even if Uniquely Yours, or representatives thereof, are advised of the possibility of such damages, losses or expenses.\r\n                        </span>\r\n                    </div>\r\n                </div>\r\n                <div class=\"main-single\">\r\n                    <div class=\"main-single-title\">\r\n                        <span>Intellectual Property Claims</span>\r\n                    </div>\r\n                    <div class=\"main-single-info\">\r\n                        <span>\r\n                            Uniquely Yours respects the intellectual property rights of others. We have a policy of removing user submissions that violate copyright, trademark, or other property laws, suspending or blocking access to the design-saving or other features of our site to any user who uses our site in violation of any such law, and/or terminating in appropriate circumstances the account (if any) of any user who uses our site in violation of any such law.\r\n                            <br>\r\n                            In order for us to respond to your notice, it must: \r\n                            <ul>\r\n                                <li>(i) contain your physical or electronic signature; </li>\r\n                                <li>(ii) identify the copyrighted work, trademark, or other intellectual property alleged to have been infringed; </li>\r\n                                <li>(iii) identify the allegedly infringing material in a sufficiently precise manner to allow us to locate that material; </li>\r\n                                <li>(iv) contain adequate information by which we can contact you (including postal address, telephone number, and e-mail address); </li><li>(v) contain a statement that you have a good faith belief that use of the copyrighted material, trademark, or other intellectual property is not authorized by the owner, the owner&#39;s agent, or the law; </li>\r\n                                <li>(vi) contain a statement that the information in the written notice is accurate; and </li>\r\n                                <li>(vii) contain a statement, under penalty of perjury, that you are authorized to act on behalf of the copyright, trademark, or other intellectual property right owner.</li>\r\n                            </ul>\r\n                        </span>\r\n                    </div>\r\n                </div>\r\n                <div class=\"main-single\">\r\n                    <div class=\"main-single-title\">\r\n                        <span>Indemnity</span>\r\n                    </div>\r\n                    <div class=\"main-single-info\">\r\n                        <span>You agree to defend, indemnify and hold Uniquely Yours and its affiliates harmless from and against any and all claims, damages, costs and expenses, including attorneys&#39; fees, arising from or relating to your use of Uniquely Yours Site and the Service, your violation of this Agreement, or your violation of any rights of another.</span>\r\n                    </div>\r\n                </div>\r\n                <div class=\"main-single\">\r\n                    <div class=\"main-single-title\">\r\n                        <span>Governing Law</span>\r\n                    </div>\r\n                    <div class=\"main-single-info\">\r\n                        <span>This Agreement shall be governed by the laws of Bermuda and, where applicable, by federal law.</span>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</div>', NULL, '2019-12-18 16:21:52', '2019-12-18 16:55:21', 1, 3, 'user-agreement-policies');

-- --------------------------------------------------------

--
-- Table structure for table `page_categories`
--

CREATE TABLE `page_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-is Active 0-Inactive',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `category_order` int(11) NOT NULL,
  `image` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `short_description` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `full_description` text CHARACTER SET utf8 DEFAULT NULL,
  `is_today_deal` tinyint(4) NOT NULL DEFAULT 0,
  `is_today_deal_date` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-is Active 0-Inactive',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `menu_id` int(11) NOT NULL DEFAULT 0,
  `category_id` int(11) NOT NULL DEFAULT 0,
  `sub_category_id` int(11) DEFAULT 0,
  `is_featured` tinyint(4) NOT NULL DEFAULT 0,
  `is_bestseller` tinyint(4) NOT NULL DEFAULT 0,
  `is_special` tinyint(4) NOT NULL DEFAULT 0,
  `is_stock` tinyint(4) NOT NULL DEFAULT 1,
  `total_stock` int(11) NOT NULL DEFAULT 0,
  `discount` mediumint(9) NOT NULL DEFAULT 0,
  `product_image` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `brand` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reviews` int(11) NOT NULL DEFAULT 0,
  `rating` int(11) NOT NULL DEFAULT 0,
  `total_visited` int(11) NOT NULL DEFAULT 0,
  `delivery_charge` decimal(10,0) NOT NULL DEFAULT 0,
  `is_bestdeal` tinyint(4) NOT NULL DEFAULT 0,
  `product_type` tinyint(4) DEFAULT 2 COMMENT '1-Custum 2-uncutum',
  `your_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `color` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `weight` float NOT NULL,
  `size` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `min_order_quantity` int(11) NOT NULL,
  `discount_id` int(11) DEFAULT 0,
  `free_shipping` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1- is free 2 - not free'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-is Active 0-Inactive',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `product_id` int(11) NOT NULL DEFAULT 0,
  `is_main_image` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_orders`
--

CREATE TABLE `product_orders` (
  `id` int(11) NOT NULL,
  `order_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` bigint(20) DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT 0.00,
  `payment_status` tinyint(4) DEFAULT 1 COMMENT '1- Pending,2-Success,3-failed',
  `payment_type` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_method` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `delivery_charge` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_items` int(11) DEFAULT 0,
  `billing_pin_code` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-incomplete 2-new 3-process to delivery,4-Delivered 5-cancelled,6-failed',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `billing_mobile` bigint(20) DEFAULT 0,
  `billing_address` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `billing_city` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_country` varchar(10) COLLATE utf8_unicode_ci DEFAULT 'India',
  `billing_state` smallint(6) DEFAULT NULL,
  `billing_landmark` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_alternate_phone` bigint(20) NOT NULL DEFAULT 0,
  `billing_address_type` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transition_id` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_pin_code` int(10) DEFAULT NULL,
  `shipping_name` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_mobile` bigint(20) DEFAULT NULL,
  `shipping_address` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_city` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_country` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'India',
  `shipping_state` smallint(6) DEFAULT NULL,
  `shipping_landmark` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_alternate_phone` bigint(20) DEFAULT NULL,
  `shipping_address_type` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transition_remark` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `delivery_address_id` int(11) DEFAULT NULL,
  `billing_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin_delete` tinyint(4) NOT NULL DEFAULT 1,
  `user_delete` tinyint(4) NOT NULL DEFAULT 1,
  `order_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_order_items`
--

CREATE TABLE `product_order_items` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL DEFAULT 0,
  `order_id` int(11) DEFAULT NULL,
  `personailise` tinyint(11) NOT NULL DEFAULT 0,
  `personailise_image` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `short_description` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `full_description` text CHARACTER SET utf8 DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `discount` mediumint(9) NOT NULL DEFAULT 0,
  `product_image` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `brand` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `subtotal` decimal(10,2) NOT NULL DEFAULT 0.00,
  `delivery_charge` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_stock` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_personalise`
--

CREATE TABLE `product_personalise` (
  `id` int(11) NOT NULL,
  `product_Id` int(11) NOT NULL,
  `text_field` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `paragraph` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `image_upload` int(11) NOT NULL,
  `color` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `writeown` tinyint(1) NOT NULL DEFAULT 0,
  `writeown_paragraph_char` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_personalise_by_user`
--

CREATE TABLE `product_personalise_by_user` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `ProductId` int(11) NOT NULL,
  `productImage` varchar(100) NOT NULL,
  `personaliseDetail` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `review` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `rate` tinyint(4) DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-is Active 0-Inactive',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `StateID` int(11) NOT NULL,
  `CountryID` int(11) NOT NULL,
  `StateName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`StateID`, `CountryID`, `StateName`) VALUES
(36, 1, 'ANDHRA PRADESH'),
(37, 1, 'ASSAM'),
(38, 1, 'ARUNACHAL PRADESH'),
(39, 1, 'BIHAR'),
(40, 1, 'GUJRAT'),
(41, 1, 'HARYANA'),
(42, 1, 'HIMACHAL PRADESH'),
(43, 1, 'JAMMU & KASHMIR'),
(44, 1, 'KARNATAKA'),
(45, 1, 'KERALA'),
(46, 1, 'MADHYA PRADESH'),
(47, 1, 'MAHARASHTRA'),
(48, 1, 'MANIPUR'),
(49, 1, 'MEGHALAYA'),
(50, 1, 'MIZORAM'),
(51, 1, 'NAGALAND'),
(52, 1, 'ORISSA'),
(53, 1, 'PUNJAB'),
(54, 1, 'RAJASTHAN'),
(55, 1, 'SIKKIM'),
(56, 1, 'TAMIL NADU'),
(57, 1, 'TRIPURA'),
(58, 1, 'UTTAR PRADESH'),
(59, 1, 'WEST BENGAL'),
(60, 1, 'DELHI'),
(61, 1, 'GOA'),
(62, 1, 'PONDICHERY'),
(63, 1, 'LAKSHDWEEP'),
(64, 1, 'DAMAN & DIU'),
(65, 1, 'DADRA & NAGAR'),
(66, 1, 'CHANDIGARH'),
(67, 1, 'ANDAMAN & NICOBAR'),
(68, 1, 'UTTARANCHAL'),
(69, 1, 'JHARKHAND'),
(70, 1, 'CHATTISGARH');

-- --------------------------------------------------------

--
-- Table structure for table `subscribe_emails`
--

CREATE TABLE `subscribe_emails` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-is Active 0-Inactive',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-is Active 0-Inactive',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `menu_id` int(11) NOT NULL DEFAULT 0,
  `category_id` int(11) NOT NULL DEFAULT 0,
  `sub_category_order` int(11) NOT NULL,
  `image` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` tinyint(4) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `contact_no` varchar(10) NOT NULL,
  `subject` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_comments`
--

CREATE TABLE `ticket_comments` (
  `id` int(11) NOT NULL,
  `message` text DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `type` tinyint(4) DEFAULT 1 COMMENT '1-text and 2=media',
  `ticket_id` int(11) DEFAULT NULL,
  `receiver_read` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 is not read and 2 is read',
  `comment_author` int(11) NOT NULL DEFAULT 0 COMMENT '0 is Support and 0 < is user'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fname` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lname` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1-is Active 0-Inactive',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` bigint(20) DEFAULT NULL,
  `role` varchar(10) CHARACTER SET utf8 NOT NULL DEFAULT 'client',
  `profile_pic` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `last_login_ip` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_verification` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0-unverifid,1-verifid '
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL DEFAULT 0 COMMENT '1-is Active 0-Inactive',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_categories`
--
ALTER TABLE `page_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_orders`
--
ALTER TABLE `product_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_order_items`
--
ALTER TABLE `product_order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_personalise`
--
ALTER TABLE `product_personalise`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_personalise_by_user`
--
ALTER TABLE `product_personalise_by_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`StateID`);

--
-- Indexes for table `subscribe_emails`
--
ALTER TABLE `subscribe_emails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_comments`
--
ALTER TABLE `ticket_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `page_categories`
--
ALTER TABLE `page_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_orders`
--
ALTER TABLE `product_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_order_items`
--
ALTER TABLE `product_order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_personalise`
--
ALTER TABLE `product_personalise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_personalise_by_user`
--
ALTER TABLE `product_personalise_by_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `StateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `subscribe_emails`
--
ALTER TABLE `subscribe_emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ticket_comments`
--
ALTER TABLE `ticket_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
