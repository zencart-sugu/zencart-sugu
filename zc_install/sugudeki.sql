-- MySQL dump 10.9
--
-- Host: localhost    Database: zencart-sugu-hachiya
-- ------------------------------------------------------
-- Server version	4.1.21-standard-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES ujis */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `address_book`
--

DROP TABLE IF EXISTS `address_book`;
CREATE TABLE `address_book` (
  `address_book_id` int(11) NOT NULL auto_increment,
  `customers_id` int(11) NOT NULL default '0',
  `entry_gender` char(1) NOT NULL default '',
  `entry_company` varchar(32) default NULL,
  `entry_firstname` varchar(32) NOT NULL default '',
  `entry_lastname` varchar(32) NOT NULL default '',
  `entry_street_address` varchar(64) NOT NULL default '',
  `entry_suburb` varchar(32) default NULL,
  `entry_postcode` varchar(10) NOT NULL default '',
  `entry_city` varchar(32) NOT NULL default '',
  `entry_state` varchar(32) default NULL,
  `entry_country_id` int(11) NOT NULL default '0',
  `entry_zone_id` int(11) NOT NULL default '0',
  `entry_telephone` varchar(32) NOT NULL default '',
  `entry_fax` varchar(32) default NULL,
  `entry_firstname_kana` varchar(32) NOT NULL default '',
  `entry_lastname_kana` varchar(32) NOT NULL default '',
  PRIMARY KEY  (`address_book_id`),
  KEY `idx_address_book_customers_id_zen` (`customers_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `address_book`
--

LOCK TABLES `address_book` WRITE;
/*!40000 ALTER TABLE `address_book` DISABLE KEYS */;
INSERT INTO `address_book` VALUES (17,16,'f','菱田商事','菱田','好美','花川南一条4-900',NULL,'061-3201','石狩市','',107,182,'0133-66-9874','0133-66-9874','ひしだ','よしみ');
/*!40000 ALTER TABLE `address_book` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `address_format`
--

DROP TABLE IF EXISTS `address_format`;
CREATE TABLE `address_format` (
  `address_format_id` int(11) NOT NULL auto_increment,
  `address_format` varchar(128) NOT NULL default '',
  `address_summary` varchar(48) NOT NULL default '',
  PRIMARY KEY  (`address_format_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `address_format`
--

LOCK TABLES `address_format` WRITE;
/*!40000 ALTER TABLE `address_format` DISABLE KEYS */;
INSERT INTO `address_format` VALUES (1,'$firstname $lastname$cr$streets$cr$city, $postcode$cr$statecomma$country','$city / $country');
INSERT INTO `address_format` VALUES (2,'$firstname $lastname$cr$streets$cr$city, $state    $postcode$cr$country','$city, $state / $country');
INSERT INTO `address_format` VALUES (3,'$firstname $lastname$cr$streets$cr$city$cr$postcode - $statecomma$country','$state / $country');
INSERT INTO `address_format` VALUES (4,'$firstname $lastname$cr$streets$cr$city ($postcode)$cr$country','$postcode / $country');
INSERT INTO `address_format` VALUES (5,'$firstname $lastname$cr$streets$cr$postcode $city$cr$country','$city / $country');
INSERT INTO `address_format` VALUES (6,'$firstname $lastname$cr$postcode$cr$state$city$cr$streets$cr$country$cr$telephone$cr$fax','$statename $city');
/*!40000 ALTER TABLE `address_format` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL auto_increment,
  `admin_name` varchar(32) NOT NULL default '',
  `admin_email` varchar(96) NOT NULL default '',
  `admin_pass` varchar(40) NOT NULL default '',
  `admin_level` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`admin_id`),
  KEY `idx_admin_name_zen` (`admin_name`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'admin','hachiya@ark-web.jp','7e03013a85704ec8e867025932ee69cb:d6',1);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_acl`
--

DROP TABLE IF EXISTS `admin_acl`;
CREATE TABLE `admin_acl` (
  `acl_id` int(11) NOT NULL auto_increment,
  `admin_id` int(11) NOT NULL default '0',
  `easy_admin_top_menu_id` int(11) NOT NULL default '0',
  `easy_admin_sub_menu_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`acl_id`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table `admin_acl`
--

LOCK TABLES `admin_acl` WRITE;
/*!40000 ALTER TABLE `admin_acl` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_acl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_activity_log`
--

DROP TABLE IF EXISTS `admin_activity_log`;
CREATE TABLE `admin_activity_log` (
  `log_id` int(15) NOT NULL auto_increment,
  `access_date` datetime NOT NULL default '0001-01-01 00:00:00',
  `admin_id` int(11) NOT NULL default '0',
  `page_accessed` varchar(80) NOT NULL default '',
  `page_parameters` varchar(150) default NULL,
  `ip_address` varchar(15) NOT NULL default '',
  PRIMARY KEY  (`log_id`),
  KEY `idx_page_accessed_zen` (`page_accessed`),
  KEY `idx_access_date_zen` (`access_date`),
  KEY `idx_ip_zen` (`ip_address`)
) ENGINE=MyISAM AUTO_INCREMENT=2445 DEFAULT CHARSET=ujis;


--
-- Table structure for table `authorizenet`
--

DROP TABLE IF EXISTS `authorizenet`;
CREATE TABLE `authorizenet` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `customer_id` int(11) NOT NULL default '0',
  `order_id` int(11) NOT NULL default '0',
  `response_code` int(1) NOT NULL default '0',
  `response_text` varchar(255) NOT NULL default '',
  `authorization_type` text NOT NULL,
  `transaction_id` int(15) NOT NULL default '0',
  `sent` longtext NOT NULL,
  `received` longtext NOT NULL,
  `time` varchar(50) NOT NULL default '',
  `session_id` varchar(255) NOT NULL default '',
  UNIQUE KEY `idx_auth_net_id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table `authorizenet`
--

LOCK TABLES `authorizenet` WRITE;
/*!40000 ALTER TABLE `authorizenet` DISABLE KEYS */;
/*!40000 ALTER TABLE `authorizenet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
CREATE TABLE `banners` (
  `banners_id` int(11) NOT NULL auto_increment,
  `banners_title` varchar(64) NOT NULL default '',
  `banners_url` varchar(255) NOT NULL default '',
  `banners_image` varchar(64) NOT NULL default '',
  `banners_group` varchar(15) NOT NULL default '',
  `banners_html_text` text,
  `expires_impressions` int(7) default '0',
  `expires_date` datetime default NULL,
  `date_scheduled` datetime default NULL,
  `date_added` datetime NOT NULL default '0001-01-01 00:00:00',
  `date_status_change` datetime default NULL,
  `status` int(1) NOT NULL default '1',
  `banners_open_new_windows` int(1) NOT NULL default '1',
  `banners_on_ssl` int(1) NOT NULL default '1',
  `banners_sort_order` int(11) NOT NULL default '0',
  PRIMARY KEY  (`banners_id`),
  KEY `idx_status_group_zen` (`status`,`banners_group`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `banners`
--

LOCK TABLES `banners` WRITE;
/*!40000 ALTER TABLE `banners` DISABLE KEYS */;
INSERT INTO `banners` VALUES (1,'Zen Cart','http://www.zen-cart.com','banners/zencart_468_60_02.gif','Wide-Banners','',0,NULL,NULL,'2004-01-11 20:59:12',NULL,1,1,1,0);
INSERT INTO `banners` VALUES (2,'Zen Cart the art of e-commerce','http://www.zen-cart.com','banners/125zen_logo.gif','SideBox-Banners','',0,NULL,NULL,'2004-01-11 20:59:12',NULL,1,1,1,0);
INSERT INTO `banners` VALUES (3,'Zen Cart the art of e-commerce','http://www.zen-cart.com','banners/125x125_zen_logo.gif','SideBox-Banners','',0,NULL,NULL,'2004-01-11 20:59:12',NULL,1,1,1,0);
INSERT INTO `banners` VALUES (4,'if you have to think ... you haven\'t been Zenned!','http://www.zen-cart.com','banners/think_anim.gif','Wide-Banners','',0,NULL,NULL,'2004-01-12 20:53:18',NULL,1,1,1,0);
INSERT INTO `banners` VALUES (5,'Sashbox.net - the ultimate e-commerce hosting solution','http://www.sashbox.net/zencart/','banners/sashbox_125x50.jpg','BannersAll','',0,NULL,NULL,'2005-05-13 10:53:50',NULL,1,1,1,20);
INSERT INTO `banners` VALUES (6,'Zen Cart the art of e-commerce','http://www.zen-cart.com','banners/bw_zen_88wide.gif','BannersAll','',0,NULL,NULL,'2005-05-13 10:54:38',NULL,1,1,1,10);
INSERT INTO `banners` VALUES (7,'Sashbox.net - the ultimate e-commerce hosting solution','http://www.sashbox.net/zencart/','banners/sashbox_468x60.jpg','Wide-Banners','',0,NULL,NULL,'2005-05-13 10:55:11',NULL,1,1,1,0);
INSERT INTO `banners` VALUES (8,'Start Accepting Credit Cards For Your Business Today!','http://www.zen-cart.com/modules/freecontent/index.php?id=29','banners/cardsvcs_468x60.gif','Wide-Banners','',0,NULL,NULL,'2006-03-13 11:02:43',NULL,1,1,1,0);
/*!40000 ALTER TABLE `banners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `banners_history`
--

DROP TABLE IF EXISTS `banners_history`;
CREATE TABLE `banners_history` (
  `banners_history_id` int(11) NOT NULL auto_increment,
  `banners_id` int(11) NOT NULL default '0',
  `banners_shown` int(5) NOT NULL default '0',
  `banners_clicked` int(5) NOT NULL default '0',
  `banners_history_date` datetime NOT NULL default '0001-01-01 00:00:00',
  PRIMARY KEY  (`banners_history_id`),
  KEY `idx_banners_id_zen` (`banners_id`)
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=ujis;

--
-- Table structure for table `blocks`
--

DROP TABLE IF EXISTS `blocks`;
CREATE TABLE `blocks` (
  `id` int(11) NOT NULL auto_increment,
  `module` varchar(64) NOT NULL default '',
  `block` varchar(64) NOT NULL default '',
  `template` varchar(64) NOT NULL default '',
  `status` tinyint(1) NOT NULL default '0',
  `location` varchar(64) NOT NULL default '',
  `sort_order` int(11) NOT NULL default '0',
  `visible` tinyint(1) NOT NULL default '0',
  `pages` text NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `UNQ_module_block_template` (`module`,`block`,`template`),
  KEY `IDX_module_template_status_location_sort_order` (`module`,`template`,`status`,`location`,`sort_order`)
) ENGINE=MyISAM AUTO_INCREMENT=186 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `blocks`
--

LOCK TABLES `blocks` WRITE;
/*!40000 ALTER TABLE `blocks` DISABLE KEYS */;
INSERT INTO `blocks` VALUES (1,'sideboxes','banner_box.php','classic',0,'',0,0,'');
INSERT INTO `blocks` VALUES (2,'sideboxes','banner_box2.php','classic',0,'',0,0,'');
INSERT INTO `blocks` VALUES (3,'sideboxes','banner_box_all.php','classic',0,'',0,0,'');
INSERT INTO `blocks` VALUES (4,'sideboxes','best_sellers.php','classic',0,'',0,0,'');
INSERT INTO `blocks` VALUES (5,'sideboxes','categories.php','classic',0,'',0,0,'');
INSERT INTO `blocks` VALUES (6,'sideboxes','currencies.php','classic',0,'',0,0,'');
INSERT INTO `blocks` VALUES (7,'sideboxes','document_categories.php','classic',0,'',0,0,'');
INSERT INTO `blocks` VALUES (8,'sideboxes','ezpages.php','classic',0,'',0,0,'');
INSERT INTO `blocks` VALUES (9,'sideboxes','featured.php','classic',0,'',0,0,'');
INSERT INTO `blocks` VALUES (10,'sideboxes','information.php','classic',0,'',0,0,'');
INSERT INTO `blocks` VALUES (11,'sideboxes','languages.php','classic',0,'',0,0,'');
INSERT INTO `blocks` VALUES (12,'sideboxes','manufacturer_info.php','classic',0,'',0,0,'');
INSERT INTO `blocks` VALUES (13,'sideboxes','manufacturers.php','classic',0,'',0,0,'');
INSERT INTO `blocks` VALUES (14,'sideboxes','more_information.php','classic',0,'',0,0,'');
INSERT INTO `blocks` VALUES (15,'sideboxes','music_genres.php','classic',0,'',0,0,'');
INSERT INTO `blocks` VALUES (16,'sideboxes','order_history.php','classic',0,'',0,0,'');
INSERT INTO `blocks` VALUES (17,'sideboxes','product_notifications.php','classic',0,'',0,0,'');
INSERT INTO `blocks` VALUES (18,'sideboxes','record_companies.php','classic',0,'',0,0,'');
INSERT INTO `blocks` VALUES (19,'sideboxes','reviews.php','classic',0,'',0,0,'');
INSERT INTO `blocks` VALUES (20,'sideboxes','search.php','classic',0,'',0,0,'');
INSERT INTO `blocks` VALUES (21,'sideboxes','search_header.php','classic',0,'',0,0,'');
INSERT INTO `blocks` VALUES (22,'sideboxes','shopping_cart.php','classic',0,'',0,0,'');
INSERT INTO `blocks` VALUES (23,'sideboxes','specials.php','classic',0,'',0,0,'');
INSERT INTO `blocks` VALUES (24,'sideboxes','tell_a_friend.php','classic',0,'',0,0,'');
INSERT INTO `blocks` VALUES (25,'sideboxes','whats_new.php','classic',0,'',0,0,'');
INSERT INTO `blocks` VALUES (26,'sideboxes','whos_online.php','classic',0,'',0,0,'');
INSERT INTO `blocks` VALUES (28,'globalnavi','block','classic',0,'',0,0,'');
INSERT INTO `blocks` VALUES (29,'sideboxes','banner_box.php','addon_modules',0,'',0,0,'');
INSERT INTO `blocks` VALUES (30,'sideboxes','banner_box2.php','addon_modules',0,'',0,0,'');
INSERT INTO `blocks` VALUES (31,'sideboxes','banner_box_all.php','addon_modules',0,'',0,0,'');
INSERT INTO `blocks` VALUES (32,'sideboxes','best_sellers.php','addon_modules',0,'',0,0,'');
INSERT INTO `blocks` VALUES (33,'sideboxes','categories.php','addon_modules',0,'',0,0,'');
INSERT INTO `blocks` VALUES (34,'sideboxes','currencies.php','addon_modules',0,'',0,0,'');
INSERT INTO `blocks` VALUES (35,'sideboxes','document_categories.php','addon_modules',0,'',0,0,'');
INSERT INTO `blocks` VALUES (36,'sideboxes','ezpages.php','addon_modules',0,'',0,0,'');
INSERT INTO `blocks` VALUES (37,'sideboxes','featured.php','addon_modules',0,'',0,0,'');
INSERT INTO `blocks` VALUES (38,'sideboxes','information.php','addon_modules',0,'',0,0,'');
INSERT INTO `blocks` VALUES (39,'sideboxes','languages.php','addon_modules',0,'',0,0,'');
INSERT INTO `blocks` VALUES (40,'sideboxes','manufacturer_info.php','addon_modules',0,'',0,0,'');
INSERT INTO `blocks` VALUES (41,'sideboxes','manufacturers.php','addon_modules',0,'',0,0,'');
INSERT INTO `blocks` VALUES (42,'sideboxes','more_information.php','addon_modules',0,'',0,0,'');
INSERT INTO `blocks` VALUES (43,'sideboxes','music_genres.php','addon_modules',0,'',0,0,'');
INSERT INTO `blocks` VALUES (44,'sideboxes','order_history.php','addon_modules',0,'',0,0,'');
INSERT INTO `blocks` VALUES (45,'sideboxes','product_notifications.php','addon_modules',0,'',0,0,'');
INSERT INTO `blocks` VALUES (46,'sideboxes','record_companies.php','addon_modules',0,'',0,0,'');
INSERT INTO `blocks` VALUES (47,'sideboxes','reviews.php','addon_modules',0,'',0,0,'');
INSERT INTO `blocks` VALUES (48,'sideboxes','search.php','addon_modules',0,'',0,0,'');
INSERT INTO `blocks` VALUES (49,'sideboxes','search_header.php','addon_modules',0,'',0,0,'');
INSERT INTO `blocks` VALUES (50,'sideboxes','shopping_cart.php','addon_modules',0,'',0,0,'');
INSERT INTO `blocks` VALUES (51,'sideboxes','specials.php','addon_modules',0,'',0,0,'');
INSERT INTO `blocks` VALUES (52,'sideboxes','tell_a_friend.php','addon_modules',0,'',0,0,'');
INSERT INTO `blocks` VALUES (53,'sideboxes','whats_new.php','addon_modules',0,'',0,0,'');
INSERT INTO `blocks` VALUES (54,'sideboxes','whos_online.php','addon_modules',0,'',0,0,'');
INSERT INTO `blocks` VALUES (55,'globalnavi','block','addon_modules',0,'',0,0,'');
INSERT INTO `blocks` VALUES (70,'carousel_ui','block_featured_products','addon_modules',0,'',0,0,'');
INSERT INTO `blocks` VALUES (71,'carousel_ui','block_specials_products','addon_modules',0,'',0,0,'');
INSERT INTO `blocks` VALUES (72,'carousel_ui','block_also_purchased_products','addon_modules',0,'',0,0,'');
INSERT INTO `blocks` VALUES (73,'carousel_ui','block_xsell_products','addon_modules',0,'',0,0,'');
INSERT INTO `blocks` VALUES (61,'multiple_image_view','block','addon_modules',0,'',0,1,'product_free_shipping_info\nproduct_info\nproduct_music_info');
INSERT INTO `blocks` VALUES (62,'multiple_image_view','block_expd','addon_modules',0,'',0,0,'');
INSERT INTO `blocks` VALUES (63,'multiple_image_view','block_thmb','addon_modules',0,'',0,0,'');
INSERT INTO `blocks` VALUES (81,'search_more','block_sort','addon_modules',0,'',0,0,'');
INSERT INTO `blocks` VALUES (80,'search_more','block_par_page','addon_modules',0,'',0,0,'');
INSERT INTO `blocks` VALUES (69,'carousel_ui','block_new_products','addon_modules',0,'',0,0,'');
INSERT INTO `blocks` VALUES (79,'search_more','block_search_form','addon_modules',0,'',0,0,'');
INSERT INTO `blocks` VALUES (78,'search_more','block','addon_modules',0,'',0,0,'');
INSERT INTO `blocks` VALUES (82,'sideboxes','banner_box.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO `blocks` VALUES (83,'sideboxes','banner_box2.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO `blocks` VALUES (84,'sideboxes','banner_box_all.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO `blocks` VALUES (85,'sideboxes','best_sellers.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO `blocks` VALUES (86,'sideboxes','categories.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO `blocks` VALUES (87,'sideboxes','currencies.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO `blocks` VALUES (88,'sideboxes','document_categories.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO `blocks` VALUES (89,'sideboxes','ezpages.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO `blocks` VALUES (90,'sideboxes','featured.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO `blocks` VALUES (91,'sideboxes','information.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO `blocks` VALUES (92,'sideboxes','languages.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO `blocks` VALUES (93,'sideboxes','manufacturer_info.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO `blocks` VALUES (94,'sideboxes','manufacturers.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO `blocks` VALUES (95,'sideboxes','more_information.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO `blocks` VALUES (96,'sideboxes','music_genres.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO `blocks` VALUES (97,'sideboxes','order_history.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO `blocks` VALUES (98,'sideboxes','product_notifications.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO `blocks` VALUES (99,'sideboxes','record_companies.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO `blocks` VALUES (100,'sideboxes','reviews.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO `blocks` VALUES (101,'sideboxes','search.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO `blocks` VALUES (102,'sideboxes','search_header.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO `blocks` VALUES (103,'sideboxes','shopping_cart.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO `blocks` VALUES (104,'sideboxes','specials.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO `blocks` VALUES (105,'sideboxes','tell_a_friend.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO `blocks` VALUES (106,'sideboxes','whats_new.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO `blocks` VALUES (107,'sideboxes','whos_online.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO `blocks` VALUES (108,'carousel_ui','block_new_products','accessible_and_usable',0,'',0,0,'');
INSERT INTO `blocks` VALUES (109,'carousel_ui','block_featured_products','accessible_and_usable',0,'',0,0,'');
INSERT INTO `blocks` VALUES (110,'carousel_ui','block_specials_products','accessible_and_usable',0,'',0,0,'');
INSERT INTO `blocks` VALUES (111,'carousel_ui','block_also_purchased_products','accessible_and_usable',0,'',0,0,'');
INSERT INTO `blocks` VALUES (112,'carousel_ui','block_xsell_products','accessible_and_usable',0,'',0,0,'');
INSERT INTO `blocks` VALUES (113,'globalnavi','block','accessible_and_usable',0,'',0,0,'');
INSERT INTO `blocks` VALUES (114,'multiple_image_view','block','accessible_and_usable',0,'',0,0,'');
INSERT INTO `blocks` VALUES (115,'multiple_image_view','block_expd','accessible_and_usable',0,'',0,0,'');
INSERT INTO `blocks` VALUES (116,'multiple_image_view','block_thmb','accessible_and_usable',0,'',0,0,'');
INSERT INTO `blocks` VALUES (117,'search_more','block','accessible_and_usable',1,'main_bottom',0,0,'');
INSERT INTO `blocks` VALUES (118,'search_more','block_search_form','accessible_and_usable',0,'',0,0,'');
INSERT INTO `blocks` VALUES (119,'search_more','block_par_page','accessible_and_usable',0,'',0,0,'');
INSERT INTO `blocks` VALUES (120,'search_more','block_sort','accessible_and_usable',0,'',0,0,'');
INSERT INTO `blocks` VALUES (121,'sideboxes','banner_box.php','sugudeki',0,'',0,0,'');
INSERT INTO `blocks` VALUES (122,'sideboxes','banner_box2.php','sugudeki',0,'',0,0,'');
INSERT INTO `blocks` VALUES (123,'sideboxes','banner_box_all.php','sugudeki',1,'sidebar_left',2,0,'checkout_confirmation\ncheckout_payment\ncheckout_payment_address\ncheckout_shipping\ncheckout_shipping_address\ncheckout_success\ncreate_account\ncreate_account_success\nlogin\nlogoff\npassword_forgotten\nshopping_cart\nvisitors#page_create_visitor\nvisitors#page_visitor_edit\nvisitors#page_visitor_to_account');
INSERT INTO `blocks` VALUES (124,'sideboxes','best_sellers.php','sugudeki',1,'sidebar_right',0,1,'index');
INSERT INTO `blocks` VALUES (125,'sideboxes','categories.php','sugudeki',0,'',0,0,'');
INSERT INTO `blocks` VALUES (126,'sideboxes','currencies.php','sugudeki',0,'',0,0,'');
INSERT INTO `blocks` VALUES (127,'sideboxes','document_categories.php','sugudeki',0,'',0,0,'');
INSERT INTO `blocks` VALUES (128,'sideboxes','ezpages.php','sugudeki',0,'',0,0,'');
INSERT INTO `blocks` VALUES (129,'sideboxes','featured.php','sugudeki',0,'',0,0,'');
INSERT INTO `blocks` VALUES (130,'sideboxes','information.php','sugudeki',0,'',0,0,'');
INSERT INTO `blocks` VALUES (131,'sideboxes','languages.php','sugudeki',0,'',0,0,'');
INSERT INTO `blocks` VALUES (132,'sideboxes','manufacturer_info.php','sugudeki',0,'',0,0,'');
INSERT INTO `blocks` VALUES (133,'sideboxes','manufacturers.php','sugudeki',0,'',0,0,'');
INSERT INTO `blocks` VALUES (134,'sideboxes','more_information.php','sugudeki',0,'',0,0,'');
INSERT INTO `blocks` VALUES (135,'sideboxes','music_genres.php','sugudeki',0,'',0,0,'');
INSERT INTO `blocks` VALUES (136,'sideboxes','order_history.php','sugudeki',0,'',0,0,'');
INSERT INTO `blocks` VALUES (137,'sideboxes','product_notifications.php','sugudeki',0,'',0,0,'');
INSERT INTO `blocks` VALUES (138,'sideboxes','record_companies.php','sugudeki',0,'',0,0,'');
INSERT INTO `blocks` VALUES (139,'sideboxes','reviews.php','sugudeki',1,'main_bottom',0,1,'product_info');
INSERT INTO `blocks` VALUES (140,'sideboxes','search.php','sugudeki',1,'header',0,0,'');
INSERT INTO `blocks` VALUES (141,'sideboxes','search_header.php','sugudeki',0,'',0,0,'');
INSERT INTO `blocks` VALUES (142,'sideboxes','shopping_cart.php','sugudeki',0,'',1,0,'');
INSERT INTO `blocks` VALUES (143,'sideboxes','specials.php','sugudeki',0,'',0,0,'');
INSERT INTO `blocks` VALUES (144,'sideboxes','tell_a_friend.php','sugudeki',0,'',0,0,'');
INSERT INTO `blocks` VALUES (145,'sideboxes','whats_new.php','sugudeki',0,'',0,0,'');
INSERT INTO `blocks` VALUES (146,'sideboxes','whos_online.php','sugudeki',0,'',0,0,'');
INSERT INTO `blocks` VALUES (147,'aboutbox','block','sugudeki',1,'footer',1,0,'');
INSERT INTO `blocks` VALUES (148,'ajax_category_tree','block','sugudeki',1,'sidebar_left',0,0,'checkout_confirmation\ncheckout_payment\ncheckout_payment_address\ncheckout_shipping\ncheckout_shipping_address\ncheckout_success\ncreate_account\ncreate_account_success\nlogin\nlogoff\npassword_forgotten\nshopping_cart\nvisitors#page_create_visitor\nvisitors#page_visitor_edit\nvisitors#page_visitor_to_account');
INSERT INTO `blocks` VALUES (149,'calendar','block','sugudeki',0,'',0,0,'');
INSERT INTO `blocks` VALUES (150,'calendar','block_desired_delivery_date','sugudeki',0,'',0,0,'');
INSERT INTO `blocks` VALUES (151,'calendar','block_desired_delivery_time','sugudeki',0,'',0,0,'');
INSERT INTO `blocks` VALUES (152,'calendar','block_delivery_info','sugudeki',0,'',0,0,'');
INSERT INTO `blocks` VALUES (153,'carousel_ui','block_new_products','sugudeki',0,'',0,0,'');
INSERT INTO `blocks` VALUES (154,'carousel_ui','block_featured_products','sugudeki',0,'',0,0,'');
INSERT INTO `blocks` VALUES (155,'carousel_ui','block_specials_products','sugudeki',0,'',0,0,'');
INSERT INTO `blocks` VALUES (156,'carousel_ui','block_also_purchased_products','sugudeki',1,'main_bottom',1,1,'product_info');
INSERT INTO `blocks` VALUES (157,'carousel_ui','block_xsell_products','sugudeki',1,'main_bottom',2,1,'product_info');
INSERT INTO `blocks` VALUES (181,'easy_admin','block','sugudeki',0,'',0,0,'');
INSERT INTO `blocks` VALUES (182,'easy_admin','block_right_top_menu','sugudeki',0,'',0,0,'');
INSERT INTO `blocks` VALUES (162,'globalnavi','block','sugudeki',0,'',0,0,'');
INSERT INTO `blocks` VALUES (163,'multiple_image_view','block','sugudeki',0,'',0,0,'');
INSERT INTO `blocks` VALUES (164,'multiple_image_view','block_expd','sugudeki',0,'',0,0,'');
INSERT INTO `blocks` VALUES (165,'multiple_image_view','block_thmb','sugudeki',0,'',0,0,'');
INSERT INTO `blocks` VALUES (166,'search_more','block','sugudeki',1,'main_top',10,1,'index_products');
INSERT INTO `blocks` VALUES (167,'search_more','block_search_form','sugudeki',0,'',0,0,'');
INSERT INTO `blocks` VALUES (168,'search_more','block_par_page','sugudeki',0,'',0,0,'');
INSERT INTO `blocks` VALUES (169,'search_more','block_sort','sugudeki',0,'',0,0,'');
INSERT INTO `blocks` VALUES (170,'category_sitemap','block','sugudeki',1,'footer',0,0,'');
INSERT INTO `blocks` VALUES (171,'checkout_step','block','sugudeki',1,'main_top',0,1,'checkout_confirmation\ncheckout_payment\ncheckout_payment_address\ncheckout_shipping\ncheckout_shipping_address\ncheckout_success');
INSERT INTO `blocks` VALUES (172,'easy_design','block','sugudeki',0,'',0,0,'');
INSERT INTO `blocks` VALUES (173,'products_with_attributes_stock','block','sugudeki',0,'',0,0,'');
INSERT INTO `blocks` VALUES (183,'easy_admin','block_dropdown_menu','sugudeki',0,'',0,0,'');
INSERT INTO `blocks` VALUES (175,'feature_area','block','sugudeki',0,'',0,0,'');
INSERT INTO `blocks` VALUES (176,'blog','block','sugudeki',0,'',0,0,'');
INSERT INTO `blocks` VALUES (185,'easy_admin_simplify','block','sugudeki',0,'',0,0,'');
INSERT INTO `blocks` VALUES (178,'point_base','block','sugudeki',1,'main_bottom',0,1,'account');
INSERT INTO `blocks` VALUES (180,'shopping_cart_summary','block','sugudeki',1,'header',1,0,'');
INSERT INTO `blocks` VALUES (184,'easy_reviews','block','sugudeki',0,'',0,0,'');
/*!40000 ALTER TABLE `blocks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `categories_id` int(11) NOT NULL auto_increment,
  `categories_image` varchar(64) default NULL,
  `parent_id` int(11) NOT NULL default '0',
  `sort_order` int(3) default NULL,
  `date_added` datetime default NULL,
  `last_modified` datetime default NULL,
  `categories_status` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`categories_id`),
  KEY `idx_parent_id_cat_id_zen` (`parent_id`,`categories_id`),
  KEY `idx_status_zen` (`categories_status`),
  KEY `idx_sort_order_zen` (`sort_order`)
) ENGINE=MyISAM AUTO_INCREMENT=102 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'',0,10,'2007-01-15 13:01:41','2007-02-01 17:33:02',1);
INSERT INTO `categories` VALUES (2,'',1,0,'2007-01-15 13:01:41','2007-02-01 17:34:46',1);
INSERT INTO `categories` VALUES (3,'',0,20,'2007-01-15 13:10:03','2007-02-01 17:33:18',1);
INSERT INTO `categories` VALUES (4,'',3,0,'2007-01-15 13:10:03','2007-02-01 17:35:48',1);
INSERT INTO `categories` VALUES (5,'',1,0,'2007-01-15 13:10:04','2007-02-01 17:34:55',1);
INSERT INTO `categories` VALUES (6,'',0,30,'2007-01-15 13:10:04','2007-02-01 17:33:37',1);
INSERT INTO `categories` VALUES (7,'',6,0,'2007-01-15 13:10:04','2007-02-01 17:36:37',1);
INSERT INTO `categories` VALUES (8,'',3,0,'2007-01-15 13:10:04','2007-02-01 17:36:05',1);
INSERT INTO `categories` VALUES (9,'',3,0,'2007-01-15 13:10:04','2007-02-01 17:35:38',1);
INSERT INTO `categories` VALUES (10,'',6,0,'2007-01-15 13:10:04','2007-02-01 17:36:49',1);
INSERT INTO `categories` VALUES (11,'',3,0,'2007-01-15 13:10:04','2007-02-01 17:35:56',1);
INSERT INTO `categories` VALUES (12,'',3,0,'2007-01-15 13:10:04','2007-02-01 17:35:22',1);
INSERT INTO `categories` VALUES (13,'',3,0,'2007-01-15 13:10:04','2007-02-01 17:35:30',1);
INSERT INTO `categories` VALUES (14,'',3,0,'2007-01-15 13:10:04','2007-02-01 17:35:14',1);
INSERT INTO `categories` VALUES (15,'',1,0,'2007-01-15 13:10:04','2007-02-01 17:34:37',1);
INSERT INTO `categories` VALUES (16,'',1,0,'2007-01-15 13:10:04','2007-02-01 17:34:25',1);
INSERT INTO `categories` VALUES (17,'',6,0,'2007-01-15 13:10:04','2007-02-01 17:36:28',1);
INSERT INTO `categories` VALUES (96,NULL,94,20,'2007-01-26 03:33:54',NULL,1);
INSERT INTO `categories` VALUES (27,NULL,25,20,'2007-01-16 00:24:50','2007-01-26 03:31:06',1);
INSERT INTO `categories` VALUES (20,'',0,190,'2007-01-15 13:10:05','2007-02-01 17:38:10',1);
INSERT INTO `categories` VALUES (21,'',0,100,'2007-01-15 13:15:14','2007-02-01 17:37:40',1);
INSERT INTO `categories` VALUES (22,'',0,110,'2007-01-15 13:15:17','2007-02-01 17:37:55',1);
INSERT INTO `categories` VALUES (26,NULL,25,10,'2007-01-16 00:24:31','2007-01-26 03:43:46',1);
INSERT INTO `categories` VALUES (23,'',0,40,'2007-01-15 14:10:00','2007-02-01 17:37:13',1);
INSERT INTO `categories` VALUES (25,NULL,0,9000,'2007-01-16 00:22:56','2007-01-26 03:31:59',1);
INSERT INTO `categories` VALUES (29,NULL,26,10,'2007-01-16 00:25:31','2007-01-26 03:34:26',1);
INSERT INTO `categories` VALUES (30,NULL,26,20,'2007-01-16 00:25:46','2007-01-26 03:34:33',1);
INSERT INTO `categories` VALUES (31,NULL,26,30,'2007-01-16 00:26:06','2007-01-26 03:34:44',1);
INSERT INTO `categories` VALUES (94,NULL,25,30,'2007-01-26 03:29:40','2007-01-26 03:45:01',1);
INSERT INTO `categories` VALUES (95,NULL,94,10,'2007-01-26 03:32:51','2007-01-26 03:33:32',1);
INSERT INTO `categories` VALUES (45,'',84,100,'2007-01-16 19:27:32','2007-01-24 17:11:06',1);
INSERT INTO `categories` VALUES (41,'',0,400,'2007-01-16 15:11:23','2007-01-19 01:41:40',1);
INSERT INTO `categories` VALUES (40,'categories/category_free.gif',0,300,'2007-01-16 15:03:58','2007-02-01 17:41:21',1);
INSERT INTO `categories` VALUES (70,'',66,100,'2007-01-18 14:08:42','2007-01-18 14:40:49',1);
INSERT INTO `categories` VALUES (68,'',66,210,'2007-01-18 14:08:42','2007-01-18 14:19:31',1);
INSERT INTO `categories` VALUES (69,'',66,220,'2007-01-18 14:08:42','2007-01-18 14:19:51',1);
INSERT INTO `categories` VALUES (67,'',66,200,'2007-01-18 14:08:42','2007-01-18 15:28:46',1);
INSERT INTO `categories` VALUES (66,'',0,1000,'2007-01-18 14:08:42','2007-01-19 00:29:36',1);
INSERT INTO `categories` VALUES (61,'',59,0,'2007-01-17 15:20:31','2007-02-01 17:39:54',1);
INSERT INTO `categories` VALUES (62,'',59,0,'2007-01-17 15:20:31','2007-02-01 17:39:08',1);
INSERT INTO `categories` VALUES (63,'',59,0,'2007-01-17 15:20:31','2007-02-01 17:39:33',1);
INSERT INTO `categories` VALUES (64,NULL,66,10000,'2007-01-17 18:06:48','2007-01-19 00:25:42',1);
INSERT INTO `categories` VALUES (60,'',59,0,'2007-01-17 15:20:31','2007-02-01 17:40:03',1);
INSERT INTO `categories` VALUES (59,'',0,200,'2007-01-17 15:20:31','2007-02-01 17:38:41',1);
INSERT INTO `categories` VALUES (58,NULL,99,10000,'2007-01-16 21:31:45','2007-01-26 18:10:30',1);
INSERT INTO `categories` VALUES (71,'',66,700,'2007-01-18 14:08:42','2007-01-19 00:03:55',1);
INSERT INTO `categories` VALUES (72,'',66,1000,'2007-01-18 14:11:14','2007-01-19 00:05:31',1);
INSERT INTO `categories` VALUES (73,'',66,500,'2007-01-18 14:11:14','2007-01-18 14:18:33',1);
INSERT INTO `categories` VALUES (74,'',66,510,'2007-01-18 14:11:14','2007-01-18 14:18:39',1);
INSERT INTO `categories` VALUES (75,'',66,520,'2007-01-18 14:13:02','2007-01-18 14:18:46',1);
INSERT INTO `categories` VALUES (76,NULL,77,10,'2007-01-18 17:10:12','2007-01-23 00:59:03',1);
INSERT INTO `categories` VALUES (77,NULL,0,1200,'2007-01-18 17:40:48','2007-01-26 16:30:14',1);
INSERT INTO `categories` VALUES (78,NULL,77,20,'2007-01-18 17:45:38','2007-01-23 23:49:43',1);
INSERT INTO `categories` VALUES (79,NULL,0,500,'2007-01-19 01:25:28','2007-02-01 17:40:56',1);
INSERT INTO `categories` VALUES (80,NULL,99,3000,'2007-01-21 21:47:15','2007-01-26 18:15:51',1);
INSERT INTO `categories` VALUES (81,NULL,99,4000,'2007-01-23 10:24:53','2007-01-26 18:10:49',1);
INSERT INTO `categories` VALUES (82,NULL,99,5000,'2007-01-23 11:44:05','2007-01-26 18:12:53',1);
INSERT INTO `categories` VALUES (83,NULL,84,200,'2007-01-24 10:06:24','2007-01-25 20:18:56',1);
INSERT INTO `categories` VALUES (84,NULL,0,1100,'2007-01-24 10:18:28',NULL,1);
INSERT INTO `categories` VALUES (85,NULL,84,300,'2007-01-24 17:09:48','2007-01-24 17:10:44',1);
INSERT INTO `categories` VALUES (86,NULL,77,30,'2007-01-24 19:31:55','2007-01-24 20:55:37',1);
INSERT INTO `categories` VALUES (87,NULL,0,1300,'2007-01-24 20:02:17','2007-01-26 16:17:44',1);
INSERT INTO `categories` VALUES (89,NULL,0,2000,'2007-01-25 20:32:45','2007-01-26 18:17:18',1);
INSERT INTO `categories` VALUES (91,NULL,0,7200,'2007-01-26 03:16:19','2007-01-26 18:03:38',1);
INSERT INTO `categories` VALUES (99,NULL,0,10000,'2007-01-26 18:10:20',NULL,1);
INSERT INTO `categories` VALUES (93,NULL,0,7400,'2007-01-26 03:22:16','2007-01-26 18:04:08',1);
INSERT INTO `categories` VALUES (98,NULL,0,7300,'2007-01-26 14:12:54','2007-01-26 18:03:49',1);
INSERT INTO `categories` VALUES (97,NULL,0,7500,'2007-01-26 11:30:57','2007-01-26 18:18:53',1);
INSERT INTO `categories` VALUES (100,NULL,0,800,'2007-01-26 18:19:30',NULL,1);
INSERT INTO `categories` VALUES (101,NULL,59,0,'2007-01-31 01:39:40','2007-02-01 17:39:44',1);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories_description`
--

DROP TABLE IF EXISTS `categories_description`;
CREATE TABLE `categories_description` (
  `categories_id` int(11) NOT NULL default '0',
  `language_id` int(11) NOT NULL default '1',
  `categories_name` varchar(32) NOT NULL default '',
  `categories_description` text NOT NULL,
  PRIMARY KEY  (`categories_id`,`language_id`),
  KEY `idx_categories_name_zen` (`categories_name`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table `categories_description`
--

LOCK TABLES `categories_description` WRITE;
/*!40000 ALTER TABLE `categories_description` DISABLE KEYS */;
INSERT INTO `categories_description` VALUES (1,2,'Ｔシャツ（白）','ホワイトＴシャツ（大人サイズ）です');
INSERT INTO `categories_description` VALUES (2,2,'ロゴ(白)','');
INSERT INTO `categories_description` VALUES (3,2,'Ｔシャツ（カラー）','カラーＴシャツ（大人サイズ）です');
INSERT INTO `categories_description` VALUES (4,2,'ロゴ(カラー)','');
INSERT INTO `categories_description` VALUES (5,2,'猫シリーズ(白)','');
INSERT INTO `categories_description` VALUES (6,2,'キッズT','子供向けのＴシャツです。');
INSERT INTO `categories_description` VALUES (7,2,'かわいいの(for KIDS)','');
INSERT INTO `categories_description` VALUES (8,2,'猫シリーズ(カラー)','');
INSERT INTO `categories_description` VALUES (9,2,'ドラゴン(カラー)','');
INSERT INTO `categories_description` VALUES (10,2,'ドラゴン(for KIDS)','');
INSERT INTO `categories_description` VALUES (11,2,'犬シリーズ(カラー)','');
INSERT INTO `categories_description` VALUES (12,2,'アニマル(カラー)','');
INSERT INTO `categories_description` VALUES (13,2,'イラスト(カラー)','');
INSERT INTO `categories_description` VALUES (14,2,'アイコン(カラー)','');
INSERT INTO `categories_description` VALUES (15,2,'イラスト(白)','');
INSERT INTO `categories_description` VALUES (16,2,'アニマル(白)','');
INSERT INTO `categories_description` VALUES (17,2,'おさかな(for KIDS)','');
INSERT INTO `categories_description` VALUES (20,2,'ギフト券','ご家族やお友達、会社の同僚にギフト券を贈りましょう！<br /><br />\r\n\r\nギフト券はショップ内のすべての商品購入に使えます。<br /><br />\r\n\r\nギフト券を購入すると、まず自分のマイページ上にギフト券残高が追加され、この残高の範囲で誰か他の人に引換コードを贈ることができるようになります。');
INSERT INTO `categories_description` VALUES (21,2,'禅太郎\'s セレクト（リンク商品）','このカテゴリは「リンク商品」のサンプルです。<br />つまり、ここにある商品はすべて他のカテゴリにも登録され、共通の商品情報を参照している状態です。<br /><br />リンク商品の商品情報は、どちらか一方を編集するだけで両方に反映されます。<br /><br />複数のカテゴリにリンクしている商品には、「商品マスターカテゴリ」を指定しておきます。これは例えばセールなど商品カテゴリ毎に価格設定をするような場合に使われます。所属するマスターカテゴリにセール設定すると、その商品が適用対象になります。<br /><br />\r\n\r\n<strong>ONE POINT：ページングについて</strong><br />\r\nこのカテゴリ配下には10以上の商品が入っています。10を超えた分は次のページで表示されます。');
INSERT INTO `categories_description` VALUES (22,2,'当店オリジナル（非リンク商品）','このカテゴリは、非リンク商品の例です。<br/>\r\n非リンク商品とは、つまり他のどのカテゴリからもリンクされていない（このカテゴリ配下にしか存在しない）商品という意味です。<br /><br />\r\n\r\n<strong>ONE POINT（1）：ページングについて</strong><br />\r\nこのカテゴリ配下には10以上の商品が入っています。10を超えた分は次のページで表示されます。<br /><br />\r\n\r\n<strong>ONE POINT（2）：商品の並び順について</strong><br />\r\n商品が一覧されるときは、商品名のABC、あいうえお順に並びますが、<br />\r\n漢字を含む商品名は期待通りに並んでくれない可能性が高いです。<br /><br />\r\nもし、商品の並び順を明示的に与えたければ、商品情報の「ソート順」に数字をセットします。<br />\r\n同じカテゴリ内で、上から「ソート順」の数字が小さい順に並びます。<br />\r\nセットする数字は10、20、100など飛び飛びでもかまいません。');
INSERT INTO `categories_description` VALUES (23,2,'オリジナル壁紙','ダウンロード販売商品のサンプルです。');
INSERT INTO `categories_description` VALUES (25,1,'[1]Category(top level)','');
INSERT INTO `categories_description` VALUES (25,2,'カテゴリ構成例（[1]第1カテゴリ','これは、カテゴリ構成を理解するためのものです。<br /><br />\r\nここは第1レベルのカテゴリです。<br /><br />\r\n\r\nこのカテゴリは以下のようなツリー構成になっています。<br /><br />\r\n[1]第1カテゴリ<br />\r\n　├[1.1]第2カテゴリ<br />\r\n　│　├[1.1.1]第3カテゴリ<br />\r\n　│　├[1.1.2]第3カテゴリ<br />\r\n　│　└[1.1.3]第3カテゴリ<br />\r\n　├[1.2]第2カテゴリ<br />\r\n　└[1.3]第2カテゴリ(1.3)<br />\r\n　　　├[1.3.1]第3カテゴリ<br />\r\n　　　└[1.3.2]第3カテゴリ');
INSERT INTO `categories_description` VALUES (95,1,'[1.3.1]Category(level3)','');
INSERT INTO `categories_description` VALUES (95,2,'[1.3.1]第3カテゴリ','第3レベルのカテゴリです。<br />\r\nこのカテゴリには子カテゴリがなく、これが最下位カテゴリです。<br />\r\n従って配下の商品一覧が表示されます。');
INSERT INTO `categories_description` VALUES (26,1,'[1.1]Category(level2)','');
INSERT INTO `categories_description` VALUES (26,2,'[1.1]第2カテゴリ','第2レベルのカテゴリです。<br /><br />\r\n\r\nこのカテゴリには子カテゴリが存在します。<br />\r\n従って、商品一覧ではなく、子カテゴリの一覧を表示します。');
INSERT INTO `categories_description` VALUES (27,1,'[1.2]Category(level2)','');
INSERT INTO `categories_description` VALUES (27,2,'[1.2]第2カテゴリ','第2レベルのカテゴリです。<br />\r\nこのカテゴリには子カテゴリがなく、これが最下位カテゴリです。<br />\r\n従って配下の商品一覧が表示されます。');
INSERT INTO `categories_description` VALUES (96,1,'[1.3.2]Category(level3)','');
INSERT INTO `categories_description` VALUES (29,1,'[1.1.1]Category(level3)','');
INSERT INTO `categories_description` VALUES (29,2,'[1.1.1]第3カテゴリ','第3レベルのカテゴリです。<br />\r\nこのカテゴリには子カテゴリがなく、これが最下位カテゴリです。<br />\r\n従って配下の商品一覧が表示されます。');
INSERT INTO `categories_description` VALUES (30,1,'[1.1.2]Category(level3)','');
INSERT INTO `categories_description` VALUES (30,2,'[1.1.2]第3カテゴリ','第3レベルのカテゴリです。<br />\r\nこのカテゴリには子カテゴリがなく、これが最下位カテゴリです。<br />\r\n従って配下の商品一覧が表示されます。');
INSERT INTO `categories_description` VALUES (31,1,'[1.1.3]Category(level3)','');
INSERT INTO `categories_description` VALUES (31,2,'[1.1.3]第3カテゴリ','第3レベルのカテゴリです。<br />\r\nこのカテゴリには子カテゴリがなく、これが最下位カテゴリです。<br />\r\n従って配下の商品一覧が表示されます。');
INSERT INTO `categories_description` VALUES (94,1,'[1.3]Category(level2)','');
INSERT INTO `categories_description` VALUES (94,2,'[1.3]第2カテゴリ','第2レベルのカテゴリです。<br /><br />\r\n\r\nこのカテゴリには子カテゴリが存在します。<br />\r\n従って、商品一覧ではなく、子カテゴリの一覧を表示します。');
INSERT INTO `categories_description` VALUES (41,2,'お問い合せ商品例','価格お問い合せ商品の例です。<br /><br />\r\n\r\n価格お問い合せに指定した商品では、通常の購入（カゴに入れる）ボタンの代わりに、お問い合せフォームへのリンクが表示されます。<br /><br />顧客と担当者間での個別打ち合わせをはさんで下代を決めたい商品や、事前見積もりが必要なワークフローなどのケースに使います。');
INSERT INTO `categories_description` VALUES (40,2,'無料サンプル品の例','サンプル商品の提供など価格無料商品の各種設定例です。無料カタログ、プレゼント商品の提供などいろいろな応用シーンが考えられます。<br /><br />\r\n\r\n元の価格を表示しつつ無料化することや、本体価格は無料だが特定のオプション料金は有料とするなど細かい設定が可能です。また、送料も同時に無料にしたり、反対に送料だけ有料とすることも可能です。');
INSERT INTO `categories_description` VALUES (58,1,'SEO(META, Title..)','');
INSERT INTO `categories_description` VALUES (58,2,'SEO（METAタグ）設定例','SEO対策の一環として、Zen CartではMETAタグやtitleタグを明示的に設定することができます。<br /><br />\r\n\r\nこのカテゴリに対して、以下のように設定しました。<br />\r\nブラウザの「ソースを表示」で、このページのHTMLソースの<head>0</head>部分を確認してみてください。<br /><br />\r\n\r\n\r\n【設定メモ：META】<br />\r\n・title：<br />\r\n　　「このカテゴリには明示的にtitleタグを設定しました。」<br /><br />\r\n・META（keyword）：<br />\r\n　　「このカテゴリには明示的にMETA（keyword）を設定しています,キーワード1,キーワード2,キーワード3」<br /><br />\r\n\r\n・META（description）：<br />\r\n　　「このカテゴリには明示的にMETA（description）を設定しています。Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus sit amet velit・・・」<br />');
INSERT INTO `categories_description` VALUES (45,2,'【基本】商品に対する数量割引設定','ここでは、いわゆるボリュームディスカウントの設定例を集めました。');
INSERT INTO `categories_description` VALUES (63,2,'DROPDOWNとRADIOタイプ','');
INSERT INTO `categories_description` VALUES (59,2,'商品オプションの各種タイプ','商品オプション属性の設定例を、オプションのタイプ別に例示します。');
INSERT INTO `categories_description` VALUES (60,2,'TEXTタイプ','');
INSERT INTO `categories_description` VALUES (61,2,'READONLYタイプ','');
INSERT INTO `categories_description` VALUES (62,2,'CHCKBOXタイプ','');
INSERT INTO `categories_description` VALUES (64,1,'(temporary)','');
INSERT INTO `categories_description` VALUES (64,2,'※商品オプション活用例説明用','※このカテゴリは、他の機能説明カテゴリ内でセール適用商品を例示するため設けたダミーカテゴリです。<br />\r\n　このカテゴリ自体にはあまり意味がありません。');
INSERT INTO `categories_description` VALUES (66,2,'セールと特価','このカテゴリは、\r\nZen Cartが持つさまざまな割引機能の中でメイン機能ともいえる「特価」と「セール」について理解を深めるためのサンプル集です。<br /><br />\r\n\r\n\r\n<strong>NOTE：</strong> 特価とセールの違い<br />\r\n特価は、商品単位で設定可能な割引機能です。<br />\r\nそれに対してセールは、カテゴリ単位で設定可能な割引機能です。<br />\r\nこの2つは両方組み合わせて適用することも、どちらかを優先させることも可能です。<br /><br /><br />\r\n\r\n<strong>NOTE：</strong><br />\r\n以下の各カテゴリには全く同じ商品が3点ずつ収められており、違いはカテゴリに対するセール設定だけとしています。<br />\r\n異なるカテゴリの同じ商品同士を見比べると、セール設定によるふるまいの違いが理解しやすいと思います。<br /><br />\r\n\r\n★以下の3カテゴリには同じ設定の商品が3点ずつ入っています<br />\r\n　・セール：10％OFF<br />\r\n　・セール：10％OFF<br />\r\n　・セール：1万円を8000円に<br /><br />\r\n\r\n★以下の3カテゴリには同じ設定の特価適用商品が3点ずつ入っています<br />\r\n　・セール×特価：両方適用<br />\r\n　・セール×特価：セール優先<br />\r\n　・セール×特価：特価優先<br /><br /><br />\r\n\r\n---------\r\nなお、<br />\r\n「※商品オプション活用例説明用」カテゴリは<br />\r\n　他の機能説明カテゴリ内でセール適用商品を例示するため設けたダミーカテゴリです。<br />\r\n　このカテゴリ自体にはあまり意味がありません。');
INSERT INTO `categories_description` VALUES (67,2,'セール：10％OFF','セール機能を理解するための、ごくシンプルな例です。\r\nこのカテゴリに対して、10％引きのセール設定がされており、\r\nこのカテゴリをマスターカテゴリとする全商品に適用されます。');
INSERT INTO `categories_description` VALUES (68,2,'セール：500円OFF','セール機能を理解するための、ごくシンプルな例です。\r\nこのカテゴリに対して、500円引きのセール設定がされており、\r\nこのカテゴリをマスターカテゴリとする全商品に適用されます。');
INSERT INTO `categories_description` VALUES (69,2,'セール：1万円を8000円に','セール機能を理解するための、ごくシンプルな例です。\r\nこのカテゴリに対して、8000円（新しい価格）にするセール設定がされており、\r\nこのカテゴリをマスターカテゴリとする全商品に適用されます。');
INSERT INTO `categories_description` VALUES (70,2,'特価設定例','商品単位で特価価格を設定することができます。<br />\r\nこのカテゴリでは特価機能の基本例を収めています。');
INSERT INTO `categories_description` VALUES (71,2,'セール関連etc','');
INSERT INTO `categories_description` VALUES (72,2,'セール対象外カテゴリ','このカテゴリは「商品マスターカテゴリ」を理解するためのサンプルです。<br />\r\n複数のカテゴリにリンクされた商品の場合、商品マスターカテゴリのセール設定が適用されます。<br /><br />\r\n\r\nこのカテゴリにはセールの設定をしていません。<br />\r\nこのカテゴリ配下には、共に複数のカテゴリにリンクされた商品が2つ入っています。<br /><br />\r\n\r\n1つは、このカテゴリが商品マスターカテゴリなのでセールは適用されません。<br />\r\nしかし、もう一方の商品は、セール適用カテゴリ「10％OFF」を商品マスターカテゴリとしているため、\r\n（このカテゴリがセール対象でないにもかかわらず）10％OFFになります。');
INSERT INTO `categories_description` VALUES (73,2,'セール×特価：両方適用','');
INSERT INTO `categories_description` VALUES (74,2,'セール×特価：セール優先','');
INSERT INTO `categories_description` VALUES (75,2,'セール×特価：特価優先','');
INSERT INTO `categories_description` VALUES (76,1,'Qty Min','');
INSERT INTO `categories_description` VALUES (76,2,'最小購入数：ご購入は●個から！','最小購入数を使えば<br />\r\n「ご購入は10個からとさせていただきます」といったケースに対応できます。');
INSERT INTO `categories_description` VALUES (78,1,'Qty Max','');
INSERT INTO `categories_description` VALUES (78,2,'最大購入数：お一人さま●点まで！','最大購入数の設定により\r\n「お一人さま1点まで」のように一度の購入に買える数を制限することができます。');
INSERT INTO `categories_description` VALUES (77,1,'Qty Min,Mix, Units','');
INSERT INTO `categories_description` VALUES (77,2,'購入単位や最小/大購入数の制限','Zen Cartでは、最小販売数、最大販売数を制限したり、購入単位の制限（ご購入は5個ずつ）などが可能です。');
INSERT INTO `categories_description` VALUES (79,1,'Shipping free products','');
INSERT INTO `categories_description` VALUES (79,2,'送料無料商品例','ここでは配送料無料とする設定例をご紹介します。<br />\r\nダウンロード商品はもちろん、有形の商品を送料サービスにしたい場合に使います。<br /><br />\r\n\r\nなお、<strong>ショップ全体に「ご購入1万円以上で送料無料！」を適用したい</strong>などのケースについては、配送モジュール設定の範疇ですので、ここでは扱いません。');
INSERT INTO `categories_description` VALUES (80,1,'Product Expected & Out of Stock','');
INSERT INTO `categories_description` VALUES (80,2,'入荷予定と在庫切れ商品例','このカテゴリには入荷予定商品と在庫切れ商品の例を収めてあります。<br /><br />\r\n\r\n<strong>【入荷予定商品】</strong>\r\n商品情報の「提供可能日」に未来の日付を入力すると入荷予定商品として扱われます。<br /><br />\r\n\r\n・入荷予定商品の場合、ユーザは商品情報の閲覧ができ、注文も可能です。<br />\r\n・入荷予定商品は、管理メニューの商品の管理＞入荷予定商品の管理 で一覧表示され一括管理することができます。<br /><br />\r\n\r\n\r\n<strong>【在庫切れ商品】</strong>\r\n在庫数が0になると、その商品には在庫切れ商品のアイコンが表示されます。<br /><br />\r\n\r\n・在庫切れ商品は、ユーザは商品情報の閲覧はできますが、注文はできません。<br />\r\n・在庫が0になったときのふるまい（在庫切れアイコンを表示させるかどうか等）は、管理サイトの一般設定＞在庫の管理から制御可能です。以下のような設定ができます。<br />\r\n　　・在庫がなくなった商品に、「カートに入れる」ボタンの<br />\r\n　　　代わりに「売り切れ」アイコンを表示する/しない<br />\r\n　　・在庫切れ商品を注文できる/できない<br />\r\n　　・在庫切れ商品のステータス変更：<br />\r\n　　　在庫がなくなったら商品ステータスをOFFにして、<br />\r\n　　　ショップ上への掲載を自動で取りやめる/やめない<br />\r\n　　・在庫数をチェックして水準以下になったら運営者に<br />\r\n　　　メールで知らせる/知らせない');
INSERT INTO `categories_description` VALUES (81,1,'Consumption Tax','');
INSERT INTO `categories_description` VALUES (81,2,'消費税の扱い','消費税の扱いは2通り考えられます。<br />\r\nどちらも方法でも表示価格は同じように税込み価格で表示されますが、運営側内部で商品価格を内税/外税のどちらで管理するかが異なります。<br /><br />\r\n（1）外税で管理する：<br />\r\n　　商品価格には消費税分を含めない価格を入力します。<br />\r\n　　商品価格(グロス)には自動計算された税込み価格が入り、表示価格にはこれが表示されます。<br />\r\n　　消費税率が変更された場合は、管理サイトから税率を変えるだけで、対象商品全てに反映されます。<br /><br />\r\n（2）内税で管理する：<br />\r\n　　商品価格(グロス)に消費税分を含めた価格を入力して税区分を「消費税」とするか、税区分を「なし」にして商品価格に内税価格を直接入力するの2方法あります。<br />\r\n　　表示価格は、内税が表示されます。<br />\r\n　　もともとショップ内の基本台帳が税込み価格で管理されている場合はこちらを使います。<br />\r\n　　税込みの表示価格をキッカリ9800円にしたいなどの場合は内税で管理する方がわかりやすいです。<br />\r\n　　ただし、税区分を「なし」で設定した場合は、税率が変われば対象商品すべてを見直す必要があります');
INSERT INTO `categories_description` VALUES (82,1,'Add Images','');
INSERT INTO `categories_description` VALUES (82,2,'説明欄に追加の画像を掲載する方法','商品説明欄に、メイン画像以外の商品画像を掲載する方法を説明しています。<br />\r\n実現方法は、（1）自動表示する方法と（2）説明欄にHTML直書きして表示させる（手動）の2タイプあります。<br /><br />\r\n\r\n機能としては別モノですが、<br />\r\n商品オプションごとに画像を掲載する方法についても併せて掲載しておきます。');
INSERT INTO `categories_description` VALUES (83,1,'Qty Discounts by Attributes','');
INSERT INTO `categories_description` VALUES (83,2,'オプションに対する数量割引','Zen Cartでボリュームディスカウントを実現するもう一つの方法として、商品のオプション属性ごとのボリュームディスカウント設定方法があります。<br /><br />\r\n\r\n商品オプションごとの設定をすると、<br />\r\n同じTシャツ商品に対して、レッド選択時は10個以上で100円引きだけど、イエローだったら5個以上で200円引き・・といったことが実現できます。');
INSERT INTO `categories_description` VALUES (84,1,'Qty Discounts','Discount Quantities can be set for Products or on the individual attributes.<br />\r\nDiscounts on the Product do NOT reflect on the attributes price.<br />\r\nOnly discounts based on Special and Sale Prices are applied to attribute prices.');
INSERT INTO `categories_description` VALUES (84,2,'ボリュームディスカウント例','数量割引（ボリュームディスカウント）の設定例を集めたカテゴリです。<br /><br />\r\n\r\nZen Cartのボリュームディスカウント機能は2方法あり、設定対象や実現できることが異なります。<br /><br />\r\n\r\n（1）その商品に対して数量割引を行う方法<br />\r\n　　　数量割引の基本機能です。<br />\r\n　　　[商品価格の管理(Price Manager)]から設定します。<br /><br />\r\n\r\n（2）その商品のオプション属性に対して数量割引を行う方法<br />\r\n　　　オプション属性ごとに異なる数量割引設定が可能です。<br />\r\n<br />\r\n　　　[商品オプション属性]から設定します。<br />');
INSERT INTO `categories_description` VALUES (85,1,'OneTime Discount','');
INSERT INTO `categories_description` VALUES (85,2,'ワンタイム割引','オプション属性のワンタイム割引機能についての説明カテゴリです。<br />\r\n最初の1点目だけ500円割り引くといった使い方をします。<br />\"割引\"とネーミングされていますが、使い方次第で何個買っても1回だけかかる「基本料金（つまり割増）」としても使えます。');
INSERT INTO `categories_description` VALUES (86,1,'Qty Unit','');
INSERT INTO `categories_description` VALUES (86,2,'商品の数量単位：●個単位でご注文','ユニット単位で販売したい場合は、[商品の数量単位]を設定します。<br /><br />\r\n[商品の最小数量]や[商品の最大数量]の設定を組み合わせれば、<br />「1000個以上、200個単位でご注文ください。注文可能な最大数は5000個までです」<br />\r\nのような販売が可能になります。<br /><br />');
INSERT INTO `categories_description` VALUES (87,1,'Price-factor, Offset','');
INSERT INTO `categories_description` VALUES (87,2,'プライスファクターとオフセット','商品オプション属性の中でも、わかりづらいと悪評高い？！[プライスファクター]、[オフセット]などについて説明します。');
INSERT INTO `categories_description` VALUES (89,1,'Base/Product/Option Price','');
INSERT INTO `categories_description` VALUES (89,2,'ベース価格、商品価格、オプション','<strong>ベース価格、商品価格、オプション価格の関係</strong><br /><br />\r\n\r\nZen Cartでは、「ベース価格」という言い方があちこちに出てきますが、これは管理画面で入力した「商品価格」や「オプション価格」とどう違うのでしょうか？<br /><br />\r\n\r\nベース価格は、特価やセールなどの値引き計算や、プライスファクターを適用する際の基準額として使われます。商品名直下に表示される価格（ここでは表示価格と呼んでおきます）もこのベース価格が表示されます。<br /><br />\r\n\r\nあるオプションを選択した場合のベース価格は、<br /><br />\r\n\r\n　<strong>基本的には・・・<br />\r\n　[ベース価格]＝[商品価格]＋[（そのオプションの）オプション価格]</strong><br />\r\n\r\nです。<br />\r\nただし、以下の2つのフラグの状態によってオプション価格をベース価格に含めない場合があります。逆に言えばそのオプションに対してどう値付けをしたいかによってこのフラグを制御するわけです。\r\n<ul>\r\n <li>[商品属性による価格]フラグ　※商品情報の設定（1商品全体に影響する）</li>\r\n <li>[属性による価格増減をベース価格に含める]フラグ　※オプション属性ごとの設定（そのオプションだけに影響する）</li>\r\n</ul>\r\nフラグとベース価格の関係を表にすると・・・<br /><br />\r\n\r\n<table border=\"1\">\r\n  <tr>\r\n    <th width=\"20%\">[商品属性による価格]</th>\r\n   <td colspan=\"2\" width=\"60%\"><b>\"はい\"</b></td>\r\n   <td width=\"20%\"><b>\"いいえ\"</b></td>\r\n  </tr>\r\n  <tr>\r\n   <th>[属性による価格増減をベース価格に含める]</th>\r\n   <td width=\"40%\"><b>\"はい\"</b></td>\r\n   <td width=\"20%\">\"いいえ\"</td>\r\n   <td>\"</td>\r\n  </tr>\r\n  <tr>\r\n   <th>[ベース価格]</th>\r\n   <td style=\"background:#E6E68A;\">＝[商品価格]＋[オプション価格]</td>\r\n   <td colspan=\"2\" style=\"background:#E6E68A;\">＝[商品価格]</td>\r\n  </tr>\r\n  <tr>\r\n   <th>表示価格の対象？</th>\r\n   <td style=\"background:#E6E68A;\">YES（ベース価格中最小値なら表示される）</td>\r\n   <td colspan=\"2\" style=\"background:#E6E68A;\">表示対象外</td>\r\n  </tr>\r\n</table>\r\n<br />\r\n家の電灯にたとえると、[商品属性による価格]フラグは家全体のブレーカー（これが切れれば全ての電灯が消える）にあたり、[属性による価格増減をベース価格に含める]フラグは各部屋のスイッチにあたります。');
INSERT INTO `categories_description` VALUES (91,1,'Product - Music','');
INSERT INTO `categories_description` VALUES (91,2,'特別な製品タイプ：Music','');
INSERT INTO `categories_description` VALUES (99,1,'Tips','');
INSERT INTO `categories_description` VALUES (93,1,'Document Type','');
INSERT INTO `categories_description` VALUES (93,2,'特別な製品タイプ：Document','商品タイプがドキュメントのカテゴリは、第1レベルでないとうまく動かないようです。');
INSERT INTO `categories_description` VALUES (96,2,'[1.3.2]第3カテゴリ','第3レベルのカテゴリです。<br />\r\nこのカテゴリには子カテゴリがなく、これが最下位カテゴリです。<br />\r\n従って配下の商品一覧が表示されます。');
INSERT INTO `categories_description` VALUES (98,2,'特別な製品タイプ：Free Shipping','');
INSERT INTO `categories_description` VALUES (98,1,'Product - Free Shipping','');
INSERT INTO `categories_description` VALUES (97,1,'Mixed Product Types','This is a category with mixed product types. This includes both products and documents. There are two types of documents - Documents that are for reading and Documents that are for reading and purchasing.');
INSERT INTO `categories_description` VALUES (97,2,'さまざまな製品タイプを含む例','カテゴリに対する[商品タイプの制限]をしないか、あるいは扱いたい製品タイプを複数登録しておけば、そのカテゴリに異なる製品タイプを混在させることができます。');
INSERT INTO `categories_description` VALUES (99,2,'その他のTips','');
INSERT INTO `categories_description` VALUES (100,1,'Download Files','');
INSERT INTO `categories_description` VALUES (100,2,'ダウンロード商品','');
INSERT INTO `categories_description` VALUES (101,1,'FILE type','');
INSERT INTO `categories_description` VALUES (101,2,'FILEタイプ','このオプションタイプにすると、アップロード用のファイル選択欄が表示されます。');
INSERT INTO `categories_description` VALUES (1,1,'T-shirts(white)','T-shirts(white)');
INSERT INTO `categories_description` VALUES (2,1,'Logo T(white)','');
INSERT INTO `categories_description` VALUES (3,1,'T-shirts(color)','T-shirts(color)');
INSERT INTO `categories_description` VALUES (4,1,'Logo T(color)','');
INSERT INTO `categories_description` VALUES (5,1,'Cat T(white)','');
INSERT INTO `categories_description` VALUES (6,1,'T-shirts for kids','T-shirts for kids');
INSERT INTO `categories_description` VALUES (7,1,'Cute T(for Kids)','');
INSERT INTO `categories_description` VALUES (8,1,'Cat T(color)','');
INSERT INTO `categories_description` VALUES (9,1,'Dragon T(color)','');
INSERT INTO `categories_description` VALUES (10,1,'Dragon T(for Kids)','');
INSERT INTO `categories_description` VALUES (11,1,'Dog T(color)','');
INSERT INTO `categories_description` VALUES (12,1,'Animal T(color)','');
INSERT INTO `categories_description` VALUES (13,1,'Illust. T(color)','');
INSERT INTO `categories_description` VALUES (14,1,'Icon T(color)','');
INSERT INTO `categories_description` VALUES (15,1,'Illust. T(white)','');
INSERT INTO `categories_description` VALUES (16,1,'Animal T(white)','');
INSERT INTO `categories_description` VALUES (17,1,'Fish T(for Kids)','');
INSERT INTO `categories_description` VALUES (20,1,'Gift Certificates','Send a Gift Certificate today!<br />\r\nGift Certificates are good for anything in the store.');
INSERT INTO `categories_description` VALUES (21,1,'Zen\'s selection(Linked products','All of these products are \"Linked Products\".\r\n\r\nThis means that they appear in more than one Category.\r\n\r\nHowever, you only have to maintain the product in one place.\r\n\r\nThe Master Product is used for pricing purposes.');
INSERT INTO `categories_description` VALUES (22,1,'Shop Original(unlinked products)','shop originals. these are unlinked products.');
INSERT INTO `categories_description` VALUES (23,1,'wallpapers','wallpapers(download)');
INSERT INTO `categories_description` VALUES (40,1,'Free products','Free products');
INSERT INTO `categories_description` VALUES (41,1,'Call Stuff','call staff products');
INSERT INTO `categories_description` VALUES (45,1,'Qty Discount','');
INSERT INTO `categories_description` VALUES (59,1,'Option Types','Option Types');
INSERT INTO `categories_description` VALUES (60,1,'TEXT type','');
INSERT INTO `categories_description` VALUES (61,1,'READONLY Type','');
INSERT INTO `categories_description` VALUES (62,1,'CHCKBOX Type','');
INSERT INTO `categories_description` VALUES (63,1,'DROPDOWN & RADIO Type','');
INSERT INTO `categories_description` VALUES (66,1,'SALE & Special price','Sale & Special price');
INSERT INTO `categories_description` VALUES (67,1,'SALE Percent: 10% off','SALE 10% off');
INSERT INTO `categories_description` VALUES (68,1,'SALE Deduction: 500yen off','Sale Deduction');
INSERT INTO `categories_description` VALUES (69,1,'SALE New Price: set 8000 yen','Sale New Price');
INSERT INTO `categories_description` VALUES (70,1,'Special Price','Special Price');
INSERT INTO `categories_description` VALUES (71,1,'SALE etc..','');
INSERT INTO `categories_description` VALUES (72,1,'Not SALE','');
INSERT INTO `categories_description` VALUES (73,1,'SALE x Special','');
INSERT INTO `categories_description` VALUES (74,1,'SALE x Special: skip special','');
INSERT INTO `categories_description` VALUES (75,1,'SALE x Special: skip SALE','');
INSERT INTO `categories_description` VALUES (91,9,'特別な製品タイプ：Music','');
INSERT INTO `categories_description` VALUES (93,9,'特別な製品タイプ：Document','商品タイプがドキュメントのカテゴリは、第1レベルでないとうまく動かないようです。');
INSERT INTO `categories_description` VALUES (94,9,'[1.3]第2カテゴリ','第2レベルのカテゴリです。<br /><br />\r\n\r\nこのカテゴリには子カテゴリが存在します。<br />\r\n従って、商品一覧ではなく、子カテゴリの一覧を表示します。');
INSERT INTO `categories_description` VALUES (95,9,'[1.3.1]第3カテゴリ','第3レベルのカテゴリです。<br />\r\nこのカテゴリには子カテゴリがなく、これが最下位カテゴリです。<br />\r\n従って配下の商品一覧が表示されます。');
INSERT INTO `categories_description` VALUES (96,9,'[1.3.2]第3カテゴリ','第3レベルのカテゴリです。<br />\r\nこのカテゴリには子カテゴリがなく、これが最下位カテゴリです。<br />\r\n従って配下の商品一覧が表示されます。');
INSERT INTO `categories_description` VALUES (99,9,'その他のTips','');
INSERT INTO `categories_description` VALUES (100,9,'ダウンロード商品','');
INSERT INTO `categories_description` VALUES (101,9,'FILEタイプ','このオプションタイプにすると、アップロード用のファイル選択欄が表示されます。');
INSERT INTO `categories_description` VALUES (98,9,'特別な製品タイプ：Free Shipping','');
INSERT INTO `categories_description` VALUES (97,9,'さまざまな製品タイプを含む例','カテゴリに対する[商品タイプの制限]をしないか、あるいは扱いたい製品タイプを複数登録しておけば、そのカテゴリに異なる製品タイプを混在させることができます。');
INSERT INTO `categories_description` VALUES (87,9,'プライスファクターとオフセット','商品オプション属性の中でも、わかりづらいと悪評高い？！[プライスファクター]、[オフセット]などについて説明します。');
INSERT INTO `categories_description` VALUES (89,9,'ベース価格、商品価格、オプション','<strong>ベース価格、商品価格、オプション価格の関係</strong><br /><br />\r\n\r\nZen Cartでは、「ベース価格」という言い方があちこちに出てきますが、これは管理画面で入力した「商品価格」や「オプション価格」とどう違うのでしょうか？<br /><br />\r\n\r\nベース価格は、特価やセールなどの値引き計算や、プライスファクターを適用する際の基準額として使われます。商品名直下に表示される価格（ここでは表示価格と呼んでおきます）もこのベース価格が表示されます。<br /><br />\r\n\r\nあるオプションを選択した場合のベース価格は、<br /><br />\r\n\r\n　<strong>基本的には・・・<br />\r\n　[ベース価格]＝[商品価格]＋[（そのオプションの）オプション価格]</strong><br />\r\n\r\nです。<br />\r\nただし、以下の2つのフラグの状態によってオプション価格をベース価格に含めない場合があります。逆に言えばそのオプションに対してどう値付けをしたいかによってこのフラグを制御するわけです。\r\n<ul>\r\n <li>[商品属性による価格]フラグ　※商品情報の設定（1商品全体に影響する）</li>\r\n <li>[属性による価格増減をベース価格に含める]フラグ　※オプション属性ごとの設定（そのオプションだけに影響する）</li>\r\n</ul>\r\nフラグとベース価格の関係を表にすると・・・<br /><br />\r\n\r\n<table border=\"1\">\r\n  <tr>\r\n    <th width=\"20%\">[商品属性による価格]</th>\r\n   <td colspan=\"2\" width=\"60%\"><b>\"はい\"</b></td>\r\n   <td width=\"20%\"><b>\"いいえ\"</b></td>\r\n  </tr>\r\n  <tr>\r\n   <th>[属性による価格増減をベース価格に含める]</th>\r\n   <td width=\"40%\"><b>\"はい\"</b></td>\r\n   <td width=\"20%\">\"いいえ\"</td>\r\n   <td>\"</td>\r\n  </tr>\r\n  <tr>\r\n   <th>[ベース価格]</th>\r\n   <td style=\"background:#E6E68A;\">＝[商品価格]＋[オプション価格]</td>\r\n   <td colspan=\"2\" style=\"background:#E6E68A;\">＝[商品価格]</td>\r\n  </tr>\r\n  <tr>\r\n   <th>表示価格の対象？</th>\r\n   <td style=\"background:#E6E68A;\">YES（ベース価格中最小値なら表示される）</td>\r\n   <td colspan=\"2\" style=\"background:#E6E68A;\">表示対象外</td>\r\n  </tr>\r\n</table>\r\n<br />\r\n家の電灯にたとえると、[商品属性による価格]フラグは家全体のブレーカー（これが切れれば全ての電灯が消える）にあたり、[属性による価格増減をベース価格に含める]フラグは各部屋のスイッチにあたります。');
INSERT INTO `categories_description` VALUES (86,9,'商品の数量単位：●個単位でご注文','ユニット単位で販売したい場合は、[商品の数量単位]を設定します。<br /><br />\r\n[商品の最小数量]や[商品の最大数量]の設定を組み合わせれば、<br />「1000個以上、200個単位でご注文ください。注文可能な最大数は5000個までです」<br />\r\nのような販売が可能になります。<br /><br />');
INSERT INTO `categories_description` VALUES (85,9,'ワンタイム割引','オプション属性のワンタイム割引機能についての説明カテゴリです。<br />\r\n最初の1点目だけ500円割り引くといった使い方をします。<br />\"割引\"とネーミングされていますが、使い方次第で何個買っても1回だけかかる「基本料金（つまり割増）」としても使えます。');
INSERT INTO `categories_description` VALUES (78,9,'最大購入数：お一人さま●点まで！','最大購入数の設定により\r\n「お一人さま1点まで」のように一度の購入に買える数を制限することができます。');
INSERT INTO `categories_description` VALUES (79,9,'送料無料商品例','ここでは配送料無料とする設定例をご紹介します。<br />\r\nダウンロード商品はもちろん、有形の商品を送料サービスにしたい場合に使います。<br /><br />\r\n\r\nなお、<strong>ショップ全体に「ご購入1万円以上で送料無料！」を適用したい</strong>などのケースについては、配送モジュール設定の範疇ですので、ここでは扱いません。');
INSERT INTO `categories_description` VALUES (80,9,'入荷予定と在庫切れ商品例','このカテゴリには入荷予定商品と在庫切れ商品の例を収めてあります。<br /><br />\r\n\r\n<strong>【入荷予定商品】</strong>\r\n商品情報の「提供可能日」に未来の日付を入力すると入荷予定商品として扱われます。<br /><br />\r\n\r\n・入荷予定商品の場合、ユーザは商品情報の閲覧ができ、注文も可能です。<br />\r\n・入荷予定商品は、管理メニューの商品の管理＞入荷予定商品の管理 で一覧表示され一括管理することができます。<br /><br />\r\n\r\n\r\n<strong>【在庫切れ商品】</strong>\r\n在庫数が0になると、その商品には在庫切れ商品のアイコンが表示されます。<br /><br />\r\n\r\n・在庫切れ商品は、ユーザは商品情報の閲覧はできますが、注文はできません。<br />\r\n・在庫が0になったときのふるまい（在庫切れアイコンを表示させるかどうか等）は、管理サイトの一般設定＞在庫の管理から制御可能です。以下のような設定ができます。<br />\r\n　　・在庫がなくなった商品に、「カートに入れる」ボタンの<br />\r\n　　　代わりに「売り切れ」アイコンを表示する/しない<br />\r\n　　・在庫切れ商品を注文できる/できない<br />\r\n　　・在庫切れ商品のステータス変更：<br />\r\n　　　在庫がなくなったら商品ステータスをOFFにして、<br />\r\n　　　ショップ上への掲載を自動で取りやめる/やめない<br />\r\n　　・在庫数をチェックして水準以下になったら運営者に<br />\r\n　　　メールで知らせる/知らせない');
INSERT INTO `categories_description` VALUES (81,9,'消費税の扱い','消費税の扱いは2通り考えられます。<br />\r\nどちらも方法でも表示価格は同じように税込み価格で表示されますが、運営側内部で商品価格を内税/外税のどちらで管理するかが異なります。<br /><br />\r\n（1）外税で管理する：<br />\r\n　　商品価格には消費税分を含めない価格を入力します。<br />\r\n　　商品価格(グロス)には自動計算された税込み価格が入り、表示価格にはこれが表示されます。<br />\r\n　　消費税率が変更された場合は、管理サイトから税率を変えるだけで、対象商品全てに反映されます。<br /><br />\r\n（2）内税で管理する：<br />\r\n　　商品価格(グロス)に消費税分を含めた価格を入力して税区分を「消費税」とするか、税区分を「なし」にして商品価格に内税価格を直接入力するの2方法あります。<br />\r\n　　表示価格は、内税が表示されます。<br />\r\n　　もともとショップ内の基本台帳が税込み価格で管理されている場合はこちらを使います。<br />\r\n　　税込みの表示価格をキッカリ9800円にしたいなどの場合は内税で管理する方がわかりやすいです。<br />\r\n　　ただし、税区分を「なし」で設定した場合は、税率が変われば対象商品すべてを見直す必要があります');
INSERT INTO `categories_description` VALUES (84,9,'ボリュームディスカウント例','数量割引（ボリュームディスカウント）の設定例を集めたカテゴリです。<br /><br />\r\n\r\nZen Cartのボリュームディスカウント機能は2方法あり、設定対象や実現できることが異なります。<br /><br />\r\n\r\n（1）その商品に対して数量割引を行う方法<br />\r\n　　　数量割引の基本機能です。<br />\r\n　　　[商品価格の管理(Price Manager)]から設定します。<br /><br />\r\n\r\n（2）その商品のオプション属性に対して数量割引を行う方法<br />\r\n　　　オプション属性ごとに異なる数量割引設定が可能です。<br />\r\n<br />\r\n　　　[商品オプション属性]から設定します。<br />');
INSERT INTO `categories_description` VALUES (82,9,'説明欄に追加の画像を掲載する方法','商品説明欄に、メイン画像以外の商品画像を掲載する方法を説明しています。<br />\r\n実現方法は、（1）自動表示する方法と（2）説明欄にHTML直書きして表示させる（手動）の2タイプあります。<br /><br />\r\n\r\n機能としては別モノですが、<br />\r\n商品オプションごとに画像を掲載する方法についても併せて掲載しておきます。');
INSERT INTO `categories_description` VALUES (83,9,'オプションに対する数量割引','Zen Cartでボリュームディスカウントを実現するもう一つの方法として、商品のオプション属性ごとのボリュームディスカウント設定方法があります。<br /><br />\r\n\r\n商品オプションごとの設定をすると、<br />\r\n同じTシャツ商品に対して、レッド選択時は10個以上で100円引きだけど、イエローだったら5個以上で200円引き・・といったことが実現できます。');
INSERT INTO `categories_description` VALUES (77,9,'購入単位や最小/大購入数の制限','Zen Cartでは、最小販売数、最大販売数を制限したり、購入単位の制限（ご購入は5個ずつ）などが可能です。');
INSERT INTO `categories_description` VALUES (75,9,'セール×特価：特価優先','');
INSERT INTO `categories_description` VALUES (76,9,'最小購入数：ご購入は●個から！','最小購入数を使えば<br />\r\n「ご購入は10個からとさせていただきます」といったケースに対応できます。');
INSERT INTO `categories_description` VALUES (74,9,'セール×特価：セール優先','');
INSERT INTO `categories_description` VALUES (73,9,'セール×特価：両方適用','');
INSERT INTO `categories_description` VALUES (70,9,'特価設定例','商品単位で特価価格を設定することができます。<br />\r\nこのカテゴリでは特価機能の基本例を収めています。');
INSERT INTO `categories_description` VALUES (71,9,'セール関連etc','');
INSERT INTO `categories_description` VALUES (72,9,'セール対象外カテゴリ','このカテゴリは「商品マスターカテゴリ」を理解するためのサンプルです。<br />\r\n複数のカテゴリにリンクされた商品の場合、商品マスターカテゴリのセール設定が適用されます。<br /><br />\r\n\r\nこのカテゴリにはセールの設定をしていません。<br />\r\nこのカテゴリ配下には、共に複数のカテゴリにリンクされた商品が2つ入っています。<br /><br />\r\n\r\n1つは、このカテゴリが商品マスターカテゴリなのでセールは適用されません。<br />\r\nしかし、もう一方の商品は、セール適用カテゴリ「10％OFF」を商品マスターカテゴリとしているため、\r\n（このカテゴリがセール対象でないにもかかわらず）10％OFFになります。');
INSERT INTO `categories_description` VALUES (69,9,'セール：1万円を8000円に','セール機能を理解するための、ごくシンプルな例です。\r\nこのカテゴリに対して、8000円（新しい価格）にするセール設定がされており、\r\nこのカテゴリをマスターカテゴリとする全商品に適用されます。');
INSERT INTO `categories_description` VALUES (68,9,'セール：500円OFF','セール機能を理解するための、ごくシンプルな例です。\r\nこのカテゴリに対して、500円引きのセール設定がされており、\r\nこのカテゴリをマスターカテゴリとする全商品に適用されます。');
INSERT INTO `categories_description` VALUES (67,9,'セール：10％OFF','セール機能を理解するための、ごくシンプルな例です。\r\nこのカテゴリに対して、10％引きのセール設定がされており、\r\nこのカテゴリをマスターカテゴリとする全商品に適用されます。');
INSERT INTO `categories_description` VALUES (61,9,'READONLYタイプ','');
INSERT INTO `categories_description` VALUES (62,9,'CHCKBOXタイプ','');
INSERT INTO `categories_description` VALUES (63,9,'DROPDOWNとRADIOタイプ','');
INSERT INTO `categories_description` VALUES (64,9,'※商品オプション活用例説明用','※このカテゴリは、他の機能説明カテゴリ内でセール適用商品を例示するため設けたダミーカテゴリです。<br />\r\n　このカテゴリ自体にはあまり意味がありません。');
INSERT INTO `categories_description` VALUES (58,9,'SEO（METAタグ）設定例','SEO対策の一環として、Zen CartではMETAタグやtitleタグを明示的に設定することができます。<br /><br />\r\n\r\nこのカテゴリに対して、以下のように設定しました。<br />\r\nブラウザの「ソースを表示」で、このページのHTMLソースの<head>0</head>部分を確認してみてください。<br /><br />\r\n\r\n\r\n【設定メモ：META】<br />\r\n・title：<br />\r\n　　「このカテゴリには明示的にtitleタグを設定しました。」<br /><br />\r\n・META（keyword）：<br />\r\n　　「このカテゴリには明示的にMETA（keyword）を設定しています,キーワード1,キーワード2,キーワード3」<br /><br />\r\n\r\n・META（description）：<br />\r\n　　「このカテゴリには明示的にMETA（description）を設定しています。Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus sit amet velit・・・」<br />');
INSERT INTO `categories_description` VALUES (66,9,'セールと特価','このカテゴリは、\r\nZen Cartが持つさまざまな割引機能の中でメイン機能ともいえる「特価」と「セール」について理解を深めるためのサンプル集です。<br /><br />\r\n\r\n\r\n<strong>NOTE：</strong> 特価とセールの違い<br />\r\n特価は、商品単位で設定可能な割引機能です。<br />\r\nそれに対してセールは、カテゴリ単位で設定可能な割引機能です。<br />\r\nこの2つは両方組み合わせて適用することも、どちらかを優先させることも可能です。<br /><br /><br />\r\n\r\n<strong>NOTE：</strong><br />\r\n以下の各カテゴリには全く同じ商品が3点ずつ収められており、違いはカテゴリに対するセール設定だけとしています。<br />\r\n異なるカテゴリの同じ商品同士を見比べると、セール設定によるふるまいの違いが理解しやすいと思います。<br /><br />\r\n\r\n★以下の3カテゴリには同じ設定の商品が3点ずつ入っています<br />\r\n　・セール：10％OFF<br />\r\n　・セール：10％OFF<br />\r\n　・セール：1万円を8000円に<br /><br />\r\n\r\n★以下の3カテゴリには同じ設定の特価適用商品が3点ずつ入っています<br />\r\n　・セール×特価：両方適用<br />\r\n　・セール×特価：セール優先<br />\r\n　・セール×特価：特価優先<br /><br /><br />\r\n\r\n---------\r\nなお、<br />\r\n「※商品オプション活用例説明用」カテゴリは<br />\r\n　他の機能説明カテゴリ内でセール適用商品を例示するため設けたダミーカテゴリです。<br />\r\n　このカテゴリ自体にはあまり意味がありません。');
INSERT INTO `categories_description` VALUES (59,9,'商品オプションの各種タイプ','商品オプション属性の設定例を、オプションのタイプ別に例示します。');
INSERT INTO `categories_description` VALUES (25,9,'カテゴリ構成例（[1]第1カテゴリ','これは、カテゴリ構成を理解するためのものです。<br /><br />\r\nここは第1レベルのカテゴリです。<br /><br />\r\n\r\nこのカテゴリは以下のようなツリー構成になっています。<br /><br />\r\n[1]第1カテゴリ<br />\r\n　├[1.1]第2カテゴリ<br />\r\n　│　├[1.1.1]第3カテゴリ<br />\r\n　│　├[1.1.2]第3カテゴリ<br />\r\n　│　└[1.1.3]第3カテゴリ<br />\r\n　├[1.2]第2カテゴリ<br />\r\n　└[1.3]第2カテゴリ(1.3)<br />\r\n　　　├[1.3.1]第3カテゴリ<br />\r\n　　　└[1.3.2]第3カテゴリ');
INSERT INTO `categories_description` VALUES (60,9,'TEXTタイプ','');
INSERT INTO `categories_description` VALUES (22,9,'当店オリジナル（非リンク商品）','このカテゴリは、非リンク商品の例です。<br/>\r\n非リンク商品とは、つまり他のどのカテゴリからもリンクされていない（このカテゴリ配下にしか存在しない）商品という意味です。<br /><br />\r\n\r\n<strong>ONE POINT（1）：ページングについて</strong><br />\r\nこのカテゴリ配下には10以上の商品が入っています。10を超えた分は次のページで表示されます。<br /><br />\r\n\r\n<strong>ONE POINT（2）：商品の並び順について</strong><br />\r\n商品が一覧されるときは、商品名のABC、あいうえお順に並びますが、<br />\r\n漢字を含む商品名は期待通りに並んでくれない可能性が高いです。<br /><br />\r\nもし、商品の並び順を明示的に与えたければ、商品情報の「ソート順」に数字をセットします。<br />\r\n同じカテゴリ内で、上から「ソート順」の数字が小さい順に並びます。<br />\r\nセットする数字は10、20、100など飛び飛びでもかまいません。');
INSERT INTO `categories_description` VALUES (41,9,'お問い合せ商品例','価格お問い合せ商品の例です。<br /><br />\r\n\r\n価格お問い合せに指定した商品では、通常の購入（カゴに入れる）ボタンの代わりに、お問い合せフォームへのリンクが表示されます。<br /><br />顧客と担当者間での個別打ち合わせをはさんで下代を決めたい商品や、事前見積もりが必要なワークフローなどのケースに使います。');
INSERT INTO `categories_description` VALUES (45,9,'【基本】商品に対する数量割引設定','ここでは、いわゆるボリュームディスカウントの設定例を集めました。');
INSERT INTO `categories_description` VALUES (40,9,'無料サンプル品の例','サンプル商品の提供など価格無料商品の各種設定例です。無料カタログ、プレゼント商品の提供などいろいろな応用シーンが考えられます。<br /><br />\r\n\r\n元の価格を表示しつつ無料化することや、本体価格は無料だが特定のオプション料金は有料とするなど細かい設定が可能です。また、送料も同時に無料にしたり、反対に送料だけ有料とすることも可能です。');
INSERT INTO `categories_description` VALUES (31,9,'[1.1.3]第3カテゴリ','第3レベルのカテゴリです。<br />\r\nこのカテゴリには子カテゴリがなく、これが最下位カテゴリです。<br />\r\n従って配下の商品一覧が表示されます。');
INSERT INTO `categories_description` VALUES (30,9,'[1.1.2]第3カテゴリ','第3レベルのカテゴリです。<br />\r\nこのカテゴリには子カテゴリがなく、これが最下位カテゴリです。<br />\r\n従って配下の商品一覧が表示されます。');
INSERT INTO `categories_description` VALUES (29,9,'[1.1.1]第3カテゴリ','第3レベルのカテゴリです。<br />\r\nこのカテゴリには子カテゴリがなく、これが最下位カテゴリです。<br />\r\n従って配下の商品一覧が表示されます。');
INSERT INTO `categories_description` VALUES (26,9,'[1.1]第2カテゴリ','第2レベルのカテゴリです。<br /><br />\r\n\r\nこのカテゴリには子カテゴリが存在します。<br />\r\n従って、商品一覧ではなく、子カテゴリの一覧を表示します。');
INSERT INTO `categories_description` VALUES (27,9,'[1.2]第2カテゴリ','第2レベルのカテゴリです。<br />\r\nこのカテゴリには子カテゴリがなく、これが最下位カテゴリです。<br />\r\n従って配下の商品一覧が表示されます。');
INSERT INTO `categories_description` VALUES (23,9,'オリジナル壁紙','ダウンロード販売商品のサンプルです。');
INSERT INTO `categories_description` VALUES (17,9,'おさかな(for KIDS)','');
INSERT INTO `categories_description` VALUES (20,9,'ギフト券','ご家族やお友達、会社の同僚にギフト券を贈りましょう！<br /><br />\r\n\r\nギフト券はショップ内のすべての商品購入に使えます。<br /><br />\r\n\r\nギフト券を購入すると、まず自分のマイページ上にギフト券残高が追加され、この残高の範囲で誰か他の人に引換コードを贈ることができるようになります。');
INSERT INTO `categories_description` VALUES (21,9,'禅太郎\'s セレクト（リンク商品）','このカテゴリは「リンク商品」のサンプルです。<br />つまり、ここにある商品はすべて他のカテゴリにも登録され、共通の商品情報を参照している状態です。<br /><br />リンク商品の商品情報は、どちらか一方を編集するだけで両方に反映されます。<br /><br />複数のカテゴリにリンクしている商品には、「商品マスターカテゴリ」を指定しておきます。これは例えばセールなど商品カテゴリ毎に価格設定をするような場合に使われます。所属するマスターカテゴリにセール設定すると、その商品が適用対象になります。<br /><br />\r\n\r\n<strong>ONE POINT：ページングについて</strong><br />\r\nこのカテゴリ配下には10以上の商品が入っています。10を超えた分は次のページで表示されます。');
INSERT INTO `categories_description` VALUES (16,9,'アニマル(白)','');
INSERT INTO `categories_description` VALUES (15,9,'イラスト(白)','');
INSERT INTO `categories_description` VALUES (14,9,'アイコン(カラー)','');
INSERT INTO `categories_description` VALUES (13,9,'イラスト(カラー)','');
INSERT INTO `categories_description` VALUES (12,9,'アニマル(カラー)','');
INSERT INTO `categories_description` VALUES (11,9,'犬シリーズ(カラー)','');
INSERT INTO `categories_description` VALUES (10,9,'ドラゴン(for KIDS)','');
INSERT INTO `categories_description` VALUES (9,9,'ドラゴン(カラー)','');
INSERT INTO `categories_description` VALUES (8,9,'猫シリーズ(カラー)','');
INSERT INTO `categories_description` VALUES (7,9,'かわいいの(for KIDS)','');
INSERT INTO `categories_description` VALUES (6,9,'キッズT','子供向けのＴシャツです。');
INSERT INTO `categories_description` VALUES (5,9,'猫シリーズ(白)','');
INSERT INTO `categories_description` VALUES (4,9,'ロゴ(カラー)','');
INSERT INTO `categories_description` VALUES (2,9,'ロゴ(白)','');
INSERT INTO `categories_description` VALUES (3,9,'Ｔシャツ（カラー）','カラーＴシャツ（大人サイズ）です');
INSERT INTO `categories_description` VALUES (1,9,'Ｔシャツ（白）','ホワイトＴシャツ（大人サイズ）です');
/*!40000 ALTER TABLE `categories_description` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configuration`
--

DROP TABLE IF EXISTS `configuration`;
CREATE TABLE `configuration` (
  `configuration_id` int(11) NOT NULL auto_increment,
  `configuration_title` text NOT NULL,
  `configuration_key` varchar(255) NOT NULL default '',
  `configuration_value` text NOT NULL,
  `configuration_description` text NOT NULL,
  `configuration_group_id` int(11) NOT NULL default '0',
  `sort_order` int(5) default NULL,
  `last_modified` datetime default NULL,
  `date_added` datetime NOT NULL default '0001-01-01 00:00:00',
  `use_function` text,
  `set_function` text,
  PRIMARY KEY  (`configuration_id`),
  UNIQUE KEY `unq_config_key_zen` (`configuration_key`),
  KEY `idx_key_value_zen` (`configuration_key`,`configuration_value`(10)),
  KEY `idx_cfg_grp_id_zen` (`configuration_group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1536 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `configuration`
--

LOCK TABLES `configuration` WRITE;
/*!40000 ALTER TABLE `configuration` DISABLE KEYS */;
INSERT INTO `configuration` VALUES (1,'ショップ名','STORE_NAME','Zen商店','ショップ名を設定します。',1,1,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (2,'ショップオーナー名','STORE_OWNER','善太郎','ショップオーナー名(または運営管理者名)を設定します。',1,2,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (3,'国','STORE_COUNTRY','107','店舗が存在する国名を入力してください。<strong>注意：変更したら店舗のゾーンの更新を忘れずに行ってください。</strong>',1,6,NULL,'2009-11-19 12:39:39','zen_get_country_name','zen_cfg_pull_down_country_list(');
INSERT INTO `configuration` VALUES (4,'地域','STORE_ZONE','194','ショップの所在地域(県名)を設定します。',1,7,NULL,'2009-11-19 12:39:39','zen_cfg_get_zone_name','zen_cfg_pull_down_zone_list(');
INSERT INTO `configuration` VALUES (5,'入荷予定商品のソート順','EXPECTED_PRODUCTS_SORT','desc','入荷予定商品のソート順を設定します。<br /><br />\r\n・asc(昇順)<br />\r\n・desc(降順)',1,8,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'asc\', \'desc\'), ');
INSERT INTO `configuration` VALUES (6,'入荷予定商品のソート順に用いるフィールド','EXPECTED_PRODUCTS_FIELD','date_expected','入荷予定商品のソート順に使用するフィールドを設定します。<BR>・products_name:品名<BR>・date_expected:予定日',1,9,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'products_name\', \'date_expected\'), ');
INSERT INTO `configuration` VALUES (7,'表示言語と通貨の連動','USE_DEFAULT_LANGUAGE_CURRENCY','false','表示言語と通貨の変更を連動させるかどうか設定します。<br /><br />true(連動)<br />false(非連動)',1,10,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (8,'表示言語の選択','LANGUAGE_DEFAULT_SELECTOR','Default','ショップのデフォルトの表示言語はショップの初期設定またはユーザーのブラウザ設定のどちらに基づくかを設定します。<br /><br />デフォルト：ショップの初期設定',1,11,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'Default\', \'Browser\'), ');
INSERT INTO `configuration` VALUES (9,'サーチエンジンフレンドリーなURL表記(開発中)','SEARCH_ENGINE_FRIENDLY_URLS','false','サーチエンジンに拾われやすい、静的HTMLのようなURL表記を行うかどうかを設定します。<br /><br />注意：Googleでは動的URLのクロールが強化されたため、あまり意味はないようです。',6,12,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (10,'商品の追加後にカートを表示','DISPLAY_CART','true','商品をカートに追加した直後にカートの内容を表示するか、または元ページにすぐ戻るかを設定します。<br /><br />\r\n・true (表示)<br />\r\n・false (非表示)',1,14,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (11,'デフォルトの検索演算子','ADVANCED_SEARCH_DEFAULT_OPERATOR','and','デフォルトの検索演算子を設定します。',1,17,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'and\', \'or\'), ');
INSERT INTO `configuration` VALUES (12,'ショップの住所と電話番号','STORE_NAME_ADDRESS','Zen商店\r\n東京都中央区銀座1-1-1\r\n03-0000-0000','ショップ名、国名、住所、電話番号を設定します。',1,18,'2010-06-18 11:34:11','2009-11-19 12:39:39',NULL,'zen_cfg_textarea(');
INSERT INTO `configuration` VALUES (13,'カテゴリ内の商品数を表示','SHOW_COUNTS','true','カテゴリ内の商品数を下位カテゴリも含めてカウント表示するかどうかを設定します。<br /><br />\r\n・true (する)<br />\r\n・false (しない)',1,19,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (14,'税額の小数点位置','TAX_DECIMAL_PLACES','0','税額の小数点以下の桁数を設定します。',1,20,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (15,'価格を税込みで表示','DISPLAY_PRICE_WITH_TAX','true','価格を税込みで表示するかどうかを設定します。<br /><br />\r\n・true = 価格を税込みで表示<br />\r\n・false = 税額をまとめて表示',1,21,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (16,'価格を税込みで表示 - 管理画面','DISPLAY_PRICE_WITH_TAX_ADMIN','true','管理画面で価格を税込みで表示するかどうかを設定します。<br /><br />\r\n・true = 価格を税込みで表示<br />\r\n・false = 最後に税額を表示',1,21,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (17,'商品にかかる税額の算定基準','STORE_PRODUCT_TAX_BASIS','Shipping','商品にかかる税額を算出する際の基準を設定します。<br /><br />\r\n・Shipping …顧客(商品送付先)の住所<br />\r\n・Billing …顧客の請求先の住所<br />\r\n・Store …ショップの所在地による(送付先・請求先ともショップの所在地域である場合に有効)\r\n',1,21,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'Shipping\', \'Billing\', \'Store\'), ');
INSERT INTO `configuration` VALUES (18,'送料にかかる税額の算定基準','STORE_SHIPPING_TAX_BASIS','Shipping','送料にかかる税金を算出する際の基準を設定します。<br /><br />\r\n・Shipping …顧客(商品送付先)の住所<br />\r\n・Billing …顧客の請求先の住所<br />\r\n・Store …ショップの所在地による(送付先・請求先ともショップの所在地域である場合に有効)<br />\r\n注意：この設定は配送モジュールによってオーバーライド(上書き設定)が可能です。',1,21,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'Shipping\', \'Billing\', \'Store\'), ');
INSERT INTO `configuration` VALUES (19,'税金の表示','STORE_TAX_DISPLAY_STATUS','0','合計額が0円でも税金を表示しますか?<br />0= Off<br />1= On',1,21,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO `configuration` VALUES (20,'管理画面のタイムアウト設定(秒数)','SESSION_TIMEOUT_ADMIN','3600','管理画面がタイムアウトするまでの秒数を設定します。デフォルトは3600秒＝1時間です。<br />あまり短めに設定すると商品登録中などにタイムアウトしてしまいますので注意。<br />900秒未満を設定すると900秒に自動的に設定されます。',1,40,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (21,'管理画面のプログラム処理の上限時間設定(秒)\r\n','GLOBAL_SET_TIME_LIMIT','60','管理画面においてなんらかの操作を行った場合の、プログラム処理の強制終了時間を設定します。デフォルトは60秒＝1分。この設定は、プログラム処理時間に問題がある場合などにだけ変更してください。\r\n',1,42,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (22,'Zen Cart新バージョンの自動チェック(ヘッダで告知するか否か)','SHOW_VERSION_UPDATE_IN_HEADER','true','Zen Cartの新バージョンがリリースされた場合、ヘッダに情報を表示しますか?<br /><br />\r\n注意：この設定をオンにすると、管理者ページの表示が遅くなる場合があります。インターネットに繋がっていないテスト環境などではfalseにしてください。\r\n',1,44,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (23,'ショップのステータス','STORE_STATUS','0','ショップの状態を設定します。<br /><br />\r\n・0＝通常のショップ<br />\r\n・1＝価格表示なしのデモショップ<br />\r\n・2＝価格表示付きのデモショップ\r\n',1,25,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), ');
INSERT INTO `configuration` VALUES (24,'サーバの稼動時間(アップタイム)','DISPLAY_SERVER_UPTIME','true','サーバの稼働時間を表示するかどうかを設定します。この情報はいくつかのサーバでエラーログとして残ることがあります。<br /><br />true＝表示<br /><br />false＝非表示',1,46,'2003-11-08 20:24:47','0001-01-01 00:00:00','','zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (25,'リンク切れページのチェック','MISSING_PAGE_CHECK','On','Zen Cartがリンク切れページを検知した際に自動的にトップページに転送しますか?<br /><br />\r\n・On = オン<br />\r\n・Off = オフ<br />\r\n・Page Not Found = ページが見つかりません画面へ遷移する<br />\r\n<br />\r\n注意：デバックの際などにはこの機能をオフにするとよいでしょう。',1,48,'2003-11-08 20:24:47','0001-01-01 00:00:00','','zen_cfg_select_option(array(\'On\', \'Off\', \'Page Not Found\'),');
INSERT INTO `configuration` VALUES (26,'HTMLエディタ','HTML_EDITOR_PREFERENCE','NONE','メールマガジンや商品説明などで用いるHTML/リッチテキスト用のソフトウェアを設定します。',1,110,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'HTMLAREA\', \'NONE\'),');
INSERT INTO `configuration` VALUES (27,'phpBBへのリンクを表示','PHPBB_LINKS_ENABLED','false','Zen Cart上に(インストール済みの)phpBBのフォーラムへのリンクを表示するかどうかを設定します。\r\n',1,120,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (28,'カテゴリ内の商品数を表示 - 管理画面','SHOW_COUNTS_ADMIN','true','カテゴリ内の商品数を下位カテゴリも含めてカウント表示しますか?<br /><br />\r\n・true (する)<br />\r\n・false (しない)',1,130,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (29,'名前の最小文字数','ENTRY_FIRST_NAME_MIN_LENGTH','1','名前の文字数の最小値を設定します。',2,1,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (30,'姓の最小文字数','ENTRY_LAST_NAME_MIN_LENGTH','1','姓の文字数の最小値を設定します。',2,2,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (31,'生年月日の最小文字数','ENTRY_DOB_MIN_LENGTH','10','生年月日の文字数の最小値を設定します。',2,3,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (32,'メールアドレスの最小文字数','ENTRY_EMAIL_ADDRESS_MIN_LENGTH','6','メールアドレスの文字数の最小値を設定します。',2,4,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (33,'住所の最小文字数','ENTRY_STREET_ADDRESS_MIN_LENGTH','1','番地・マンション・アパート名の最小文字数を設定します。',2,5,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (34,'会社名の最小文字数','ENTRY_COMPANY_MIN_LENGTH','2','会社名の文字数の最小値を設定します。',2,6,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (35,'郵便番号の最小文字数','ENTRY_POSTCODE_MIN_LENGTH','4','郵便番号の文字数の最小値を設定します。',2,7,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (36,'市区町村の最小文字数','ENTRY_CITY_MIN_LENGTH','2','市区町村の文字数の最小値を設定します。',2,8,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (37,'都道府県名の最小文字数','ENTRY_STATE_MIN_LENGTH','2','都道府県の文字数の最小値を設定します。',2,9,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (38,'電話番号の最小文字数','ENTRY_TELEPHONE_MIN_LENGTH','3','電話番号の文字数の最小値を設定します。',2,10,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (39,'パスワードの最小文字数','ENTRY_PASSWORD_MIN_LENGTH','5','パスワードの文字数の最小値を設定します。',2,11,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (40,'クレジットカード名義の最小文字数','CC_OWNER_MIN_LENGTH','3','クレジットカード所有者名の文字数の最小値を設定します。',2,12,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (41,'クレジットカード番号の最小文字数','CC_NUMBER_MIN_LENGTH','10','クレジットカード番号の文字数の最小値を設定します。',2,13,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (42,'クレジットカードCVV番号の最小文字数','CC_CVV_MIN_LENGTH','3','クレジットカードCVV番号の文字数の最小値を設定します。',2,13,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (43,'レビューの文章の最小文字数','REVIEW_TEXT_MIN_LENGTH','50','レビューの文章の文字数の最小値を設定します。',2,14,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (44,'ベストセラーの最小表示件数','MIN_DISPLAY_BESTSELLERS','1','ベストセラーとして表示する商品の最小値を設定します。',2,15,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (45,'「こんな商品も購入しています」の最小表示数','MIN_DISPLAY_ALSO_PURCHASED','1','「この商品を購入した人はこんな商品も購入しています」で表示する商品数の最小値を設定します。',2,16,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (46,'ニックネームの最小文字数','ENTRY_NICK_MIN_LENGTH','3','ニックネームの文字数の最小値を設定します。',2,1,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (47,'アドレス帳の最大登録数','MAX_ADDRESS_BOOK_ENTRIES','5','顧客が登録できるアドレス帳の登録数の最大値を設定します。',3,1,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (48,'管理画面 - 1ページに表示する検索結果の最大数','MAX_DISPLAY_SEARCH_RESULTS','20','管理画面の1ページに表示する検索結果の数の最大値を設定します。',3,2,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (49,'ページ・リンク数の最大表示数','MAX_DISPLAY_PAGE_LINKS','5','商品リストや購入履歴の一覧表示でページの下などに表示されるページ数・リンク数の最大値を設定します。',3,3,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (50,'特価商品の最大表示数','MAX_DISPLAY_SPECIAL_PRODUCTS','9','特価商品として表示する商品数の最大値を設定します。',3,4,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (51,'今月の新着商品の最大表示数','MAX_DISPLAY_NEW_PRODUCTS','9','今月の新着商品数の最大値を設定します。',3,5,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (52,'入荷予定商品の最大表示数','MAX_DISPLAY_UPCOMING_PRODUCTS','10','入荷予定商品として表示する商品数の最大値を設定します。',3,6,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (53,'メーカーリスト - スクロールボックスのサイズ/スタイル','MAX_MANUFACTURERS_LIST','3','スクロールボックスに表示されるメーカー数は ?<br />1か0に設定するとドロップダウンリストになります。',3,7,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (54,'メーカーリスト - 商品の存在を確認','PRODUCTS_MANUFACTURERS_STATUS','1','各メーカーについて、1点以上の商品があり、かつ閲覧可能であるかどうかを確認しますか?<br /><br />注意：この機能がONの場合、商品数やメーカーの数が多いと表示が遅くなります。<br />0= off 1= on',3,7,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO `configuration` VALUES (55,'音楽ジャンルリスト - スクロールボックスのサイズ/スタイル','MAX_MUSIC_GENRES_LIST','3','スクロールボックスに表示される音楽ジャンルリストの数を設定します。1か0に設定すると、ドロップダウンリストになります。\r\n',3,7,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (56,'レコード会社リスト - スクロールボックスのサイズ/スタイル','MAX_RECORD_COMPANY_LIST','3','スクロールボックスに表示されるレコード会社リストの数です。1か0に設定すると、ドロップダウンリストになります。\r\n',3,7,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (57,'レコード会社名表示の長さ','MAX_DISPLAY_RECORD_COMPANY_NAME_LEN','15','レコード会社名ボックスで表示される名前の長さを設定します。設定より長い名前は省略表示されます。\r\n',3,8,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (58,'音楽ジャンル名の文字数の長さ','MAX_DISPLAY_MUSIC_GENRES_NAME_LEN','15','音楽ジャンルボックスで表示される名前の長さを設定します。設定より長い名前は省略表示されます。\r\n',3,8,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (59,'メーカー名の長さ','MAX_DISPLAY_MANUFACTURER_NAME_LEN','15','メーカーリストで表示されるメーカー名の文字数の最大値を設定します。',3,8,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (60,'新しいレビューの表示数最大値','MAX_DISPLAY_NEW_REVIEWS','6','新しいレビューとして表示される数の最大値を設定します。',3,9,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (61,'レビューのランダム表示数','MAX_RANDOM_SELECT_REVIEWS','10','ランダムに表示するレビュー数の最大値を設定します。<br /><br />注意：この設定値をXとすると、ランダム表示の対象になるのは、もっとも古いアクティブなレビューから数えてX番目に登録されたアクティブなレビューまでになります。',3,10,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (62,'新着商品のランダム表示数','MAX_RANDOM_SELECT_NEW','10','ランダムに表示する新着商品数の最大値を設定します。<br /><br />注意：この設定値をXとすると、ランダム表示の対象になるのは、もっとも古いアクティブな新着商品から数えてX番目に登録されたアクティブな新着商品までになります。',3,11,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (63,'特価商品のランダム表示数','MAX_RANDOM_SELECT_SPECIALS','10','ランダムに表示する特価商品数の最大値を設定します。<br /><br />注意：この設定値をXとすると、ランダム表示の対象になるのは、もっとも古いアクティブな特価商品から数えてX番目に登録されたアクティブな特価商品までになります。',3,12,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (64,'一行に表示するカテゴリ数','MAX_DISPLAY_CATEGORIES_PER_ROW','3','一行に表示するカテゴリ数を設定します。',3,13,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (65,'新着商品一覧表示数','MAX_DISPLAY_PRODUCTS_NEW','10','新着商品ページ１ページに表示する商品数の最大値を設定します。',3,14,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (66,'ベストセラーの最大表示件数','MAX_DISPLAY_BESTSELLERS','10','ベストセラーページ１ページに表示するベストセラー商品数の最大値を設定します。',3,15,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (67,'「こんな商品も買っています」の最大表示件数','MAX_DISPLAY_ALSO_PURCHASED','6','「こんな商品も買っています」欄に表示する商品数の最大値を設定します。',3,16,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (68,'顧客の注文履歴ボックスの最大表示数','MAX_DISPLAY_PRODUCTS_IN_ORDER_HISTORY_BOX','6','顧客の注文履歴ボックスに表示する商品数の最大値を設定します。',3,17,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (69,'注文履歴ページの最大表示件数','MAX_DISPLAY_ORDER_HISTORY','10','顧客の注文履歴ページ１ページに表示する商品数の最大値を設定します。',3,18,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (70,'顧客管理ページで表示する顧客数の最大値','MAX_DISPLAY_SEARCH_RESULTS_CUSTOMER','20','',3,19,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (71,'注文管理ページで表示する注文数の最大値','MAX_DISPLAY_SEARCH_RESULTS_ORDERS','20','',3,20,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (72,'レポートページで表示する商品数の最大値','MAX_DISPLAY_SEARCH_RESULTS_REPORTS','20','',3,21,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (73,'カテゴリ/商品ページで表示するリスト数','MAX_DISPLAY_RESULTS_CATEGORIES','10','１ページに表示する商品数の最大値を設定します。',3,22,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (74,'商品リスト - ページあたり最大表示数','MAX_DISPLAY_PRODUCTS_LISTING','10','トップページの商品リスト表示での最大表示数を設定します。',3,30,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (75,'商品オプション - オプション名とオプション値の表示','MAX_ROW_LISTS_OPTIONS','10','商品オプションページで表示するオプション名/オプション値の最大値を設定します。',3,24,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (76,'商品オプション - オプション管理画面','MAX_ROW_LISTS_ATTRIBUTES_CONTROLLER','30','オプション管理画面で表示するオプション数の最大値を設定します。',3,25,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (77,'商品属性- ダウンロード管理ページの表示','MAX_DISPLAY_SEARCH_RESULTS_DOWNLOADS_MANAGER','30','ダウンロード管理画面で、ダウンロード商品の属性の最大表示数を設定します。',3,26,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (78,'おすすめ商品 - 管理画面でのページあたり表示最大数','MAX_DISPLAY_SEARCH_RESULTS_FEATURED_ADMIN','10','管理画面において、ページあたりのおすすめ商品を最大表示件数を設定します。',3,27,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (79,'おすすめ商品 - トップページでの最大表示数','MAX_DISPLAY_SEARCH_RESULTS_FEATURED','9','トップページでおすすめ商品を最大何点表示するかを設定します。',3,28,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (80,'おすすめ商品 - 商品リストでの最大表示数','MAX_DISPLAY_PRODUCTS_FEATURED_PRODUCTS','10','商品リストでおすすめ商品をページあたり最大何点表示するかを設定します。',3,29,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (81,'おすすめ商品のランダム表示ボックス - 最大表示数','MAX_RANDOM_SELECT_FEATURED_PRODUCTS','10','おすすめ商品のランダム表示ボックスにおいて、最大何点表示するかを設定します。',3,30,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (82,'特価商品 - トップページでの最大表示点数','MAX_DISPLAY_SPECIAL_PRODUCTS_INDEX','9','トップページで、特価商品を最大何点表示するかを設定します。',3,31,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (83,'新着商品 - 表示期限','SHOW_NEW_PRODUCTS_LIMIT','0','新着商品の表示期限を設定します。<br />\r\n<br />\r\n・0=全て・降順<br />\r\n・1=当月登録分のみ<br />\r\n・30=登録から30日間<br />\r\n・60=登録から60日間(ほか90、120の設定が可能)',3,40,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'7\', \'14\', \'30\', \'60\', \'90\', \'120\'), ');
INSERT INTO `configuration` VALUES (84,'商品一覧ページ - ページあたり表示点数','MAX_DISPLAY_PRODUCTS_ALL','10','商品一覧において、ページあたりの最大表示点数を設定します。',3,45,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (85,'言語サイドボックス -　フラッグ最大表示数','MAX_LANGUAGE_FLAGS_COLUMNS','3','言語サイドボックスにおいて、列あたりのフラッグの最大表示点数を設定します。',3,50,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (86,'ファイルのアップロードサイズ - 上限','MAX_FILE_UPLOAD_SIZE','2048000','ファイルアップロードの際の上限サイズを設定します。デフォルトは2MB(2,048,000バイト)です。',3,60,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (87,'アップロードファイルに許可するファイルタイプ','UPLOAD_FILENAME_EXTENSIONS','jpg,jpeg,gif,png,eps,cdr,ai,pdf,tif,tiff,bmp,zip','ユーザーがアップロードするファイルに対して許可するファイルタイプの拡張子を設定します。複数の場合はカンマ(,)で区切り、コロン(.)は含めないでください。<br /><br />設定例: \"jpg,jpeg,gif,png,eps,cdr,ai,pdf,tif,tiff,bmp,zip\"',3,61,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_textarea(');
INSERT INTO `configuration` VALUES (88,'管理画面の注文リストで表示する注文詳細の最大件数','MAX_DISPLAY_RESULTS_ORDERS_DETAILS_LISTING','0','管理画面の注文リストでの注文詳細の最大表示件数は?<br />0 = 無制限',3,65,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (89,'管理画面のリストで表示するPayPal IPNの最大件数','MAX_DISPLAY_SEARCH_RESULTS_PAYPAL_IPN','20','管理画面のリストでのPayPal IPNの表示件数は?<br />デフォルトは20です。',3,66,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (90,'マルチカテゴリマネージャで商品を表示するカラムの最大数','MAX_DISPLAY_PRODUCTS_TO_CATEGORIES_COLUMNS','3','マルチカテゴリマネージャ(Multiple Categories Manager)で商品を表示するカラムの最大数は?<br />3 = デフォルト',3,70,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (91,'EZページの表示の最大件数','MAX_DISPLAY_SEARCH_RESULTS_EZPAGE','20','EZページの表示の最大件数は?<br />20 = デフォルト',3,71,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (92,'商品画像(小)の横幅','SMALL_IMAGE_WIDTH','100','小さな画像の横幅(ピクセル)を設定します。',4,1,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (93,'商品画像(小)の高さ','SMALL_IMAGE_HEIGHT','80','小さな画像の高さ(ピクセル)を設定します。',4,2,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (94,'ヘッダ画像の横幅 - 管理画面','HEADING_IMAGE_WIDTH','57','管理画面でのヘッダ画像の横幅を設定します。',4,3,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (95,'ヘッダ画像の高さ - 管理画面','HEADING_IMAGE_HEIGHT','40','管理画面でのヘッダ画像の高さを設定します。',4,4,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (96,'サブカテゴリ画像の横幅','SUBCATEGORY_IMAGE_WIDTH','100','サブカテゴリ画像の横幅をピクセル数で設定します。',4,5,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (97,'サブカテゴリ画像の高さ','SUBCATEGORY_IMAGE_HEIGHT','57','サブカテゴリ画像の高さをピクセル数で設定します。',4,6,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (98,'画像サイズを計算','CONFIG_CALCULATE_IMAGE_SIZE','true','画像サイズを自動的に計算するかどうかを設定します。',4,7,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (99,'画像を必須とする','IMAGE_REQUIRED','true','画像がないことを表示します。(カタログの作成時に有効)',4,8,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (100,'ショッピングカートの中身 - 商品画像の表示オン・オフ','IMAGE_SHOPPING_CART_STATUS','1','ショッピングカートの中身に入っている商品の画像を表示するかどうかを設定します。<br /><br />\r\n・0= off<br />\r\n・1= on',4,9,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO `configuration` VALUES (101,'ショッピングカートの中身の画像の横幅','IMAGE_SHOPPING_CART_WIDTH','50','デフォルト = 50',4,10,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (102,'ショッピングカートの中身の画像の高さ','IMAGE_SHOPPING_CART_HEIGHT','40','デフォルト = 40',4,11,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (103,'商品情報 - カテゴリアイコン画像の横幅','CATEGORY_ICON_IMAGE_WIDTH','57','商品情報ページでのカテゴリアイコンの横幅(ピクセル数)は?',4,13,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (104,'商品情報 - カテゴリアイコン画像の高さ','CATEGORY_ICON_IMAGE_HEIGHT','40','商品情報ページでのカテゴリアイコンの高さ(ピクセル数)は?',4,14,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (105,'商品情報 - 画像の横幅','MEDIUM_IMAGE_WIDTH','150','商品画像の横幅を設定します。',4,20,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (106,'商品情報 - 画像の高さ','MEDIUM_IMAGE_HEIGHT','120','商品画像の高さを設定します。',4,21,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (107,'商品情報 - 画像(中)のファイル接尾辞(Suffix)','IMAGE_SUFFIX_MEDIUM','_MED','商品画像のファイル接尾辞を設定します。<br /><br />・デフォルト = _MED',4,22,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (108,'商品情報 - 画像(大)のファイル接尾辞(Suffix)','IMAGE_SUFFIX_LARGE','_LRG','商品画像のファイル接尾辞を設定します。<br /><br />\r\n・デフォルト = _LRG',4,23,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (109,'商品情報 - １行に表示する追加画像数','IMAGES_AUTO_ADDED','3','商品情報で１行に表示する追加画像数を設定します。<br /><br />\r\n・デフォルト = 3',4,30,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (110,'商品リスト - 画像の横幅','IMAGE_PRODUCT_LISTING_WIDTH','100','デフォルト = 100',4,40,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (111,'商品リスト - 画像の高さ','IMAGE_PRODUCT_LISTING_HEIGHT','80','デフォルト = 80',4,41,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (112,'新商品リスト - 画像の横幅','IMAGE_PRODUCT_NEW_LISTING_WIDTH','100','デフォルト = 100',4,42,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (113,'新商品リスト - 画像の高さ','IMAGE_PRODUCT_NEW_LISTING_HEIGHT','80','デフォルト = 80',4,43,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (114,'新商品 - 画像の横幅','IMAGE_PRODUCT_NEW_WIDTH','100','デフォルト = 100',4,44,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (115,'新商品 - 画像の高さ','IMAGE_PRODUCT_NEW_HEIGHT','80','デフォルト = 80',4,45,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (116,'おすすめ商品 -画像の幅','IMAGE_FEATURED_PRODUCTS_LISTING_WIDTH','100','デフォルト = 100',4,46,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (117,'おすすめ商品 - 画像の高さ','IMAGE_FEATURED_PRODUCTS_LISTING_HEIGHT','80','デフォルト = 80',4,47,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (118,'全商品一覧 - 画像の幅','IMAGE_PRODUCT_ALL_LISTING_WIDTH','100','デフォルト = 100',4,48,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (119,'全商品一覧 - 画像の高さ','IMAGE_PRODUCT_ALL_LISTING_HEIGHT','80','デフォルト = 80',4,49,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (120,'商品画像 - 画像がない場合のNo Image画像','PRODUCTS_IMAGE_NO_IMAGE_STATUS','1','「No Image」画像を自動的に表示するかどうかを設定します。<br /><br />\r\n・0= off<br />\r\n・1= On<br />',4,60,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO `configuration` VALUES (121,'商品画像 - No Image画像の指定','PRODUCTS_IMAGE_NO_IMAGE','no_picture.gif','商品画像がない場合に表示するNo Image画像を設定します。<br /><br />Default = no_picture.gif',4,61,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (122,'商品画像 - 商品・カテゴリでプロポーショナルな画像を使う','PROPORTIONAL_IMAGES_STATUS','1','商品情報・カテゴリでプロポーショナルな画像を使いますか?<br /><br />注意：プロポーショナル画像には高さ・横幅とも\"0\"(ピクセル)を指定しないでください。<br />0= off 1= on',4,75,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO `configuration` VALUES (123,'(メール用)敬称表示(Mr. or Ms)','ACCOUNT_GENDER','true','顧客のアカウント作成の際、メール用の敬称(Mr. or Ms) を表示するかどうかを設定します。',5,1,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (124,'生年月日','ACCOUNT_DOB','true','顧客のアカウント作成の際、「生年月日」の欄を表示するかどうかを設定します。<br />注意: 不要な場合はfalseに、必要な場合はtrueを指定してください。',5,2,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (125,'会社名','ACCOUNT_COMPANY','true','顧客のアカウント作成の際、「会社名」を表示するかどうかを設定します。',5,3,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (126,'住所2','ACCOUNT_SUBURB','false','顧客のアカウント作成の際、「住所2」を表示するかどうかを設定します。',5,4,'2010-06-16 16:55:31','2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (127,'都道府県名','ACCOUNT_STATE','true','顧客のアカウント作成の際、「都道府県名」を表示するかどうかを設定します。',5,5,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (128,'都道府県名 - ドロップダウンで表示','ACCOUNT_STATE_DRAW_INITIAL_DROPDOWN','false','「都道府県名」は常にドロップダウン形式で表示しますか?',5,5,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (129,'アカウントのデフォルト国別IDの作成','SHOW_CREATE_ACCOUNT_DEFAULT_COUNTRY','107','アカウントのデフォルト国別IDを設定します。<br />デフォルトは223です。',5,6,NULL,'2009-11-19 12:39:39','zen_get_country_name','zen_cfg_pull_down_country_list_none(');
INSERT INTO `configuration` VALUES (130,'Fax番号','ACCOUNT_FAX_NUMBER','true','顧客のアカウント作成の際、「Fax番号」を表示するかどうかを設定します。',5,10,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (131,'メールマガジンのチェックボックスの表示','ACCOUNT_NEWSLETTER_STATUS','1','メールマガジンのチェックボックスの表示設定をします。<br />0= 表示オフ<br />1= ボックス表示・チェックなし状態<br />2= ボックス表示・チェックあり状態<br />【注意】デフォルトで「チェックあり」の状態にしておくと、各国のスパム規制法規に抵触する恐れがあります。',5,45,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), ');
INSERT INTO `configuration` VALUES (132,'デフォルトのメール形式の設定','ACCOUNT_EMAIL_PREFERENCE','0','顧客のデフォルトのメール形式を設定します。<br />0= テキスト形式<br />1= HTML形式',5,46,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO `configuration` VALUES (133,'顧客への商品の通知 - ステータス','CUSTOMERS_PRODUCTS_NOTIFICATION_STATUS','1','顧客がチェックアウト後に、商品の通知(product notifications)について尋ねるかどうかを設定します。<br /><br />\r\n・0= 尋ねない<br />\r\n・1= 尋ねる(サイト全体に対して設定されていない場合)<br />\r\n【注意】サイドボックスはこの設定とは別にオフにする必要があります。',5,50,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO `configuration` VALUES (134,'商品・価格の閲覧制限','CUSTOMERS_APPROVAL','0','顧客がショップ内で商品や価格を閲覧するのを制限するかどうかを設定します。<br />0= 要ログインなどの制限なし<br />1= ブラウスにはログインが必須<br />2= ログインなしでブラウズ可能だが価格は非表示<br />3= 商品閲覧のみ<br /><br />【注意】オプション「2」は、サーチエンジンのロボットに収集されたくない場合や、ログイン済みの顧客にのみ価格を開示したい場合に有効です。',5,55,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'), ');
INSERT INTO `configuration` VALUES (135,'顧客の購入オーソライズ','CUSTOMERS_APPROVAL_AUTHORIZATION','0','ショップでの購入に際して、顧客はショップ側に審査・許可される必要があるかどうかを設定します。<br />0= 不要<br />1= 商品の閲覧にも許可が必要<br />2= 商品の閲覧は自由だが価格の閲覧は許可された顧客のみ<br />【注意】オプション「2」はサーチエンジンのロボット除けに用いることもできます。',5,65,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'), ');
INSERT INTO `configuration` VALUES (136,'顧客のオーソライズ(閲覧制限) - ファイル名','CUSTOMERS_AUTHORIZATION_FILENAME','customers_authorization','顧客のオーソライズ(閲覧制限)に使うファイル名を設定します。拡張子なしで表記してください。<br />デフォルトは\r\n\"customers_authorization\"',5,66,NULL,'2009-11-19 12:39:39',NULL,'');
INSERT INTO `configuration` VALUES (137,'顧客のオーソライズ(閲覧制限) - ヘッダを隠す','CUSTOMERS_AUTHORIZATION_HEADER_OFF','false','顧客のオーソライズ(閲覧制限) でヘッダを表示するかどうかを設定します。<br /><br />\r\n・true=hide<br />\r\n・false=show',5,67,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (138,'顧客のオーソライズ(閲覧制限) - 左カラムを隠す','CUSTOMERS_AUTHORIZATION_COLUMN_LEFT_OFF','false','顧客のオーソライズ(閲覧制限) で、左カラムを表示するかどうかを設定します。<br /><br />\r\n・true=hide<br />\r\n・false=show',5,68,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (139,'顧客のオーソライズ(閲覧制限) - 右カラムを隠す','CUSTOMERS_AUTHORIZATION_COLUMN_RIGHT_OFF','false','顧客のオーソライズ(閲覧制限)で、右カラムを表示するかどうかを設定します。<br /><br />\r\n・true=hide<br />\r\n・false=show',5,69,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (140,'顧客のオーソライズ(閲覧制限) - フッタを隠す','CUSTOMERS_AUTHORIZATION_FOOTER_OFF','false','顧客のオーソライズ(閲覧制限) で、フッタを表示するかどうかを設定します。<br /><br />\r\n・true=hide<br />\r\n・false=show',5,70,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (141,'顧客のオーソライズ(閲覧制限) - 価格の非表示','CUSTOMERS_AUTHORIZATION_PRICES_OFF','false','顧客のオーソライズで、価格を表示するかどうかを設定します。<br /><br />\r\n・true=hide<br />\r\n・false=show',5,71,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (142,'顧客の紹介(Customers Referral)ステータス','CUSTOMERS_REFERRAL_STATUS','0','顧客の紹介コードについて設定します。<br />0= Off<br />1= 1st Discount Coupon Code used最初のディスカウントクーポンを使用済み<br />2= アカウント作成の際、顧客自身が追加・編集可能<br /><br />注意：顧客の紹介コードがセットされると、管理画面からだけ変更することができます。',5,80,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), ');
INSERT INTO `configuration` VALUES (143,'インストール済みの支払いモジュール','MODULE_PAYMENT_INSTALLED','cc.php;cod.php;moneyorder.php;purchaseorder.php','インストールされている支払いモジュールのファイル名のリスト( セミコロン(;)区切り )です。この情報は自動的に更新されますので編集の必要はありません。',6,0,'2010-06-04 14:41:51','2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (144,'インストール済み注文合計モジュール','MODULE_ORDER_TOTAL_INSTALLED','ot_subtotal.php;ot_shipping.php;ot_coupon.php;ot_group_pricing.php;ot_tax.php;ot_gv.php;ot_cod_fee.php;ot_total.php','インストールされている注文合計モジュールのファイル名のリスト(セミコロン(;)区切り)です。\r\n<br /><br />\r\n【注意】この情報は自動的に更新されますので編集の必要はありません。',6,0,'2010-06-27 04:42:19','2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (145,'インストール済み配送モジュール','MODULE_SHIPPING_INSTALLED','flat.php;freeshipper.php;yamato.php','インストールされている配送モジュールのファイル名のリスト(セミコロン(;)区切り)です。この情報は自動的に更新されますので編集の必要はありません。',6,0,'2010-06-04 14:29:45','2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (146,'代金引換モジュールを有効にする','MODULE_PAYMENT_COD_STATUS','True','代金引換モジュールを有効にするかどうかを設定します。',6,1,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES (147,'支払い地域','MODULE_PAYMENT_COD_ZONE','0','地域を選択した場合、選択された地域に対してのみ支払い方法が適用されます。',6,2,NULL,'2009-11-19 12:39:39','zen_get_zone_class_title','zen_cfg_pull_down_zone_classes(');
INSERT INTO `configuration` VALUES (148,'表示の整列順','MODULE_PAYMENT_COD_SORT_ORDER','0','表示の整列順を設定します。数字が小さいほど上位に表示されます。',6,0,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (149,'注文ステータスの設定','MODULE_PAYMENT_COD_ORDER_STATUS_ID','0','この支払い方法の場合の注文ステータスを設定します。',6,0,NULL,'2009-11-19 12:39:39','zen_get_order_status_name','zen_cfg_pull_down_order_statuses(');
INSERT INTO `configuration` VALUES (150,'クレジットカードモジュールを有効にする','MODULE_PAYMENT_CC_STATUS','True','クレジットカードによる支払いを有効にするかどうかを設定します。',6,0,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES (151,'クレジットカード番号を分割する','MODULE_PAYMENT_CC_EMAIL','','メールアドレスが入力された場合、クレジットカードの中間の数字をそのアドレスに送信し、残りの外側の番号をデータベースに保存します。',6,0,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (152,'CVV番号を保存する','MODULE_PAYMENT_CC_COLLECT_CVV','false','CVV番号を収集/保存しますか? 注意：有効にすると、CVV番号はエンコードされた状態でデータベースに保存されます。',6,0,NULL,'2004-01-11 22:55:51',NULL,'zen_cfg_select_option(array(\'True\', \'False\'),');
INSERT INTO `configuration` VALUES (153,'クレジットカードナンバーを収集・保存する','MODULE_PAYMENT_CC_STORE_NUMBER','False','クレジットカード番号を収集・保存するかどうかを設定します。<br /><br />\r\n【注意】クレジットカード番号は暗号化なしに保存されます。セキュリティ上の問題に十分注意してください。',6,0,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'True\', \'False\'),');
INSERT INTO `configuration` VALUES (154,'表示の整列順','MODULE_PAYMENT_CC_SORT_ORDER','0','表示の整列順を設定します. 数字が小さいほど上位に表示されます。',6,0,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (155,'支払い地域','MODULE_PAYMENT_CC_ZONE','0','地域を選択した場合、選択された地域にたいしてのみ支払い方法が適用されます。',6,2,NULL,'2009-11-19 12:39:39','zen_get_zone_class_title','zen_cfg_pull_down_zone_classes(');
INSERT INTO `configuration` VALUES (156,'注文ステータス','MODULE_PAYMENT_CC_ORDER_STATUS_ID','0','この支払い方法の場合の注文ステータスを設定します。',6,0,NULL,'2009-11-19 12:39:39','zen_get_order_status_name','zen_cfg_pull_down_order_statuses(');
INSERT INTO `configuration` VALUES (157,'定額料金','MODULE_SHIPPING_FLAT_STATUS','True','定額料金による配送を提供するかどうかを設定します。',6,0,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES (158,'配送料金','MODULE_SHIPPING_FLAT_COST','5.00','すべての注文に対して適用される配送料金を設定します。',6,0,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (159,'税種別','MODULE_SHIPPING_FLAT_TAX_CLASS','0','定額料金に適用される税種別を選択します。',6,0,NULL,'2009-11-19 12:39:39','zen_get_tax_class_title','zen_cfg_pull_down_tax_classes(');
INSERT INTO `configuration` VALUES (160,'税率の計算ベース','MODULE_SHIPPING_FLAT_TAX_BASIS','Shipping','配送料にかかる税金オプションの設定します。<br /><br />\r\n・Shipping - 顧客の送付先住所に基づく<br />\r\n・Billing - 顧客の請求先住所に基づく<br />\r\n・Store - ショップの所在住所に基づく(送付先/請求先がショップ所在地と同じ地域の場合に有効)',6,0,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'Shipping\', \'Billing\', \'Store\'), ');
INSERT INTO `configuration` VALUES (161,'配送地域','MODULE_SHIPPING_FLAT_ZONE','0','配送地域を選択すると選択された地域のみで利用可能になります。',6,0,NULL,'2009-11-19 12:39:39','zen_get_zone_class_title','zen_cfg_pull_down_zone_classes(');
INSERT INTO `configuration` VALUES (162,'表示の整列順','MODULE_SHIPPING_FLAT_SORT_ORDER','0','表示の整列順を設定できます。数字が小さいほど上位に表示されます。',6,0,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (163,'デフォルトの通貨','DEFAULT_CURRENCY','JPY','デフォルトの通貨を設定します。',6,0,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (164,'デフォルトの言語','DEFAULT_LANGUAGE','ja','デフォルトの言語を設定します。',6,0,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (165,'新規注文のデフォルトステータス','DEFAULT_ORDERS_STATUS_ID','1','新規の注文を受け付けたときのデフォルトステータスを設定します。',6,0,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (166,'管理画面で設定キー(configuration_key)を表示','ADMIN_CONFIGURATION_KEY_ON','0','管理画面で設定キー(configuration_key)を表示しますか?<br />\r\n表示したい場合は1に設定してください。',6,0,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (167,'出荷国名','SHIPPING_ORIGIN_COUNTRY','107','配送料の計算に利用するための国名を選択します。',7,1,NULL,'2009-11-19 12:39:39','zen_get_country_name','zen_cfg_pull_down_country_list(');
INSERT INTO `configuration` VALUES (168,'ショップの郵便番号','SHIPPING_ORIGIN_ZIP','100-0000','ショップの郵便番号を入力します。',7,2,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (169,'一回の配送で配送可能な最大重量(kg)','SHIPPING_MAX_WEIGHT','50','一回の配送で可能な重量(kg)の最大値を設定します。例えば10kgに設定した状態でカートに30kgの商品があった場合、10kg × 3回の配送という形で処理されます。',7,3,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (170,'小・中パッケージの風袋 - 比率・重量','SHIPPING_BOX_WEIGHT','0:3','典型的な小・中パッケージの風袋(ふうたい：大きさと重量)を設定します。<br />\r\n例：10% + 1lb 10:1<br />\r\n10% + 0lbs 10:0<br />\r\n0% + 5lbs 0:5<br />\r\n0% + 0lbs 0:0',7,4,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (171,'大型パッケージの風袋 - 大きさ・重量','SHIPPING_BOX_PADDING','10:0','大きなパッケージの風袋風袋(ふうたい：大きさと重量)を設定します。<br />\r\n例：10% + 1lb 10:1<br />\r\n10% + 0lbs 10:0<br />\r\n0% + 5lbs 0:5<br />\r\n0% + 0lbs 0:0',7,5,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (172,'個数と重量の表示','SHIPPING_BOX_WEIGHT_DISPLAY','3','配送する荷物の個数と重量を表示するかどうかを設定します。<br /><br />\r\n・0= off<br />\r\n・1= 個数のみ表示<br />\r\n・2= 重量のみ表示<br />\r\n・3= 両方表示',7,15,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'), ');
INSERT INTO `configuration` VALUES (173,'送料概算表示の表示・非表示','SHOW_SHIPPING_ESTIMATOR_BUTTON','1','送料概算ボタンの表示するかどうかを設定します。<br />\r\n・0= Off<br />\r\n・1= ショッピングカート上にボタンとして表示',7,20,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), ');
INSERT INTO `configuration` VALUES (174,'注文の重量が0なら送料無料に','ORDER_WEIGHT_ZERO_STATUS','1','注文の重量が0の場合、送料無料にしますか?\r\n<br />\r\n・0= いいえ<br />\r\n・1= はい<br />\r\n注意：「送料無料」表記をしたい場合には送料無料モジュールを使うことをお勧めします。このオプションは実際に送料無料のときに表示されるだけです。',7,15,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO `configuration` VALUES (175,'商品イメージの表示','PRODUCT_LIST_IMAGE','1','商品一覧中の商品画像の表示・非表示/ソート順を設定します。<br /><br />\r\n・数値が小さいほど先に表示<br />\r\n・0 = 非表示',8,1,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (176,'商品メーカーの表示','PRODUCT_LIST_MANUFACTURER','0','商品のメーカー名を表示するかどうかを設定します。<br /><br />\r\n・数値が小さいほど先に表示<br />\r\n・0 = 非表示',8,2,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (177,'商品型番の表示','PRODUCT_LIST_MODEL','0','商品一覧中の商品型番の表示・非表示/ソート順を設定します。数値が小さいほど先に表示されます。(0 = 非表示)',8,3,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (178,'商品名','PRODUCT_LIST_NAME','2','商品一覧中の商品名の表示・非表示/ソート順を設定します。<br /><br />\r\n・数値が小さいほど先に表示<br />\r\n・0 = 非表示',8,4,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (179,'商品価格・「カートに入れる」を表示','PRODUCT_LIST_PRICE','3','商品価格・「カートに入れる」ボタンを表示するかどうかを設定します。<br />\r\n<br />\r\n・数値が小さいほど先に表示<br />\r\n・0 = 非表示',8,5,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (180,'商品数量の表示','PRODUCT_LIST_QUANTITY','0','商品一覧中の商品数量の表示・非表示/ソート順を設定します。<br /><br />\r\n・数値が小さいほど先に表示<br />\r\n・0 = 非表示',8,6,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (181,'商品重量の表示','PRODUCT_LIST_WEIGHT','0','商品一覧中の商品重量の表示・非表示/ソート順を設定します。数値が小さいほど先に表示されます。(0 = 非表示)',8,7,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (182,'商品価格・「カートに入れる」カラムの幅','PRODUCTS_LIST_PRICE_WIDTH','125','商品価格・「カートに入れる」ボタンを表示するカラムの幅(ピクセル数)を設定します。<br />\r\n・Default= 125',8,8,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (183,'カテゴリ/メーカーの絞り込みの表示','PRODUCT_LIST_FILTER','1','カテゴリ一覧ページで [絞り込み] を表示するかどうかを設定します。<br />\r\n・0=非表示<br />\r\n・1=表示',8,9,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO `configuration` VALUES (184,'[前ページ] [次ページ] の表示位置','PREV_NEXT_BAR_LOCATION','3','[前ページ] [次ページ] の表示位置を設定します。<br /><br />\r\n・1 = 上<br />\r\n・2 = 下<br />\r\n・3 = 両方',8,10,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'1\', \'2\', \'3\'), ');
INSERT INTO `configuration` VALUES (185,'商品リストのデフォルトソート順','PRODUCT_LISTING_DEFAULT_SORT_ORDER','','商品リストのデフォルトのソート順を設定します。\r\n<br />\r\n注意：商品でソートする場合は空欄に。\r\nSort the Product Listing in the order you wish for the default display to start in to get the sort order setting. Example: 2a',8,15,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (186,'「カートに入れる」ボタンの表示','PRODUCT_LIST_PRICE_BUY_NOW','1','「カートに入れる」ボタンを表示するかどうかを設定します。<br /><br />\r\n・0= off<br />\r\n・1= on',8,20,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO `configuration` VALUES (187,'複数商品の数量欄の有無・表示位置','PRODUCT_LISTING_MULTIPLE_ADD_TO_CART','3','複数商品をカートに入れる数量欄の表示するかどうかと、表示位置を設定します。<br />0= off<br />1= 上部<br />2= 下部<br />3= 両方',8,25,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'), ');
INSERT INTO `configuration` VALUES (188,'商品説明の表示','PRODUCT_LIST_DESCRIPTION','150','商品説明を表示するかどうかを設定します。<br /><br />0= OFF<br />150= 推奨する長さ。または自由に表示する商品説明の最大文字数を設定してください。',8,30,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (189,'商品リストの昇順を表示する記号','PRODUCT_LIST_SORT_ORDER_ASCENDING','+','商品リストの昇順を示す記号は?<br />デフォルト = +',8,40,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_textarea_small(');
INSERT INTO `configuration` VALUES (190,'商品リストの降順を表示する記号','PRODUCT_LIST_SORT_ORDER_DESCENDING','-','商品リストの降順を示す記号は?<br />デフォルト = -',8,41,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_textarea_small(');
INSERT INTO `configuration` VALUES (191,'在庫水準のチェック','STOCK_CHECK','true','十分な在庫があるかチェックするかどうかを設定します。',9,1,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (192,'在庫数からマイナス','STOCK_LIMITED','true','受注時点で各在庫数から注文数をマイナスしますか?',9,2,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (193,'チェックアウトを許可','STOCK_ALLOW_CHECKOUT','true','在庫が不足している場合にチェックアウトを許可しますか?',9,3,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (194,'在庫切れ商品のサイン','STOCK_MARK_PRODUCT_OUT_OF_STOCK','在庫切れです','注文時点で商品が在庫切れの場合に顧客へ表示するサインを設定します。',9,4,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (195,'在庫の再注文水準','STOCK_REORDER_LEVEL','5','在庫の再注文が必要になる商品数を設定します。',9,5,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (196,'在庫切れ商品のステータス変更','SHOW_PRODUCTS_SOLD_OUT','0','商品の在庫がない場合のステータス表示を設定します。<br /><br />0= 商品ステータスをOFFに<br />1= 商品ステータスはONのまま',9,10,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO `configuration` VALUES (197,'在庫切れ商品に「売り切れ」画像表示','SHOW_PRODUCTS_SOLD_OUT_IMAGE','1','在庫がなくなった商品の場合に「カートへ入れる」ボタンの代わりに「売り切れ」画像を表示しますか?<br /><br />\r\n・0= 表示しない<br />\r\n・1= 表示する',9,11,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO `configuration` VALUES (198,'商品数量に指定できる小数点の桁数','QUANTITY_DECIMALS','0','商品の数量に小数点の利用を許可する桁数を設定します。<br /><br />\r\n・0= off',9,15,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'), ');
INSERT INTO `configuration` VALUES (199,'ショッピングカート - 「削除」チェックボックス/ボタン','SHOW_SHOPPING_CART_DELETE','3','「削除」チェックボックス/ボタンの表示について設定します。<br /><br />1= ボタンのみ<br />2= チェックボックスのみ<br />3= ボタン/チェックボックス両方',9,20,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'1\', \'2\', \'3\'), ');
INSERT INTO `configuration` VALUES (200,'ショッピングカート -「カートの中身を更新」ボタンの位置','SHOW_SHOPPING_CART_UPDATE','3','「カートの中身を更新」ボタンの位置を設定します。<br /><br />1=「注文数」欄の横<br />2= 商品リストの下<br />3=「注文数」欄の横と商品リストの下<br /><br />注意：この設定は3つの\"tpl_shopping_cart_default\"ファイルが呼ばれる部分を設定します。',9,22,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'1\', \'2\', \'3\'), ');
INSERT INTO `configuration` VALUES (201,'ページのパースに要した時間をログに記録するかどうかを設定します。','STORE_PAGE_PARSE_TIME','false','ページのパースに要した時間をログに記録するかどうかを設定します。',10,1,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (202,'ページのパースログを保存するディレクトリとファイル名を設定します。','STORE_PAGE_PARSE_TIME_LOG','/var/log/www/zen/page_parse_time.log','ページのパースログを保存するディレクトリとファイル名を設定します。',10,2,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (203,'ログに記録する日付形式を設定します。','STORE_PARSE_DATE_TIME_FORMAT','%d/%m/%Y %H:%M:%S','ログに記録する日付形式を設定します。',10,3,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (204,'各ページの下にパース時間を表示するかどうかを設定します。<br />「ページのパース時間を記録」を true にしておく必要はありません。','DISPLAY_PAGE_PARSE_TIME','false','各ページの下にパース時間を表示するかどうかを設定します。<br />「ページのパース時間を記録」を true にしておく必要はありません。',10,4,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (205,'ログにデータベースクエリーを記録しておくかどうか設定します。(PHP4の場合のみ)','STORE_DB_TRANSACTIONS','false','ログにデータベースクエリーを記録しておくかどうか設定します。(PHP4の場合のみ)',10,5,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (206,'メール送信 - 接続方法','EMAIL_TRANSPORT','sendmail','メール送信にsendmailへのローカル接続を使用するかTCP/IP経由のSMTP接続を使用するかを設定します。サーバのOSがWindowsやMacOSの場合はSMTPに設定してください。<br /><br />SMTPAUTHは、サーバーがメール送信の際にSMTP authorizationを求める場合にのみ使ってください。その場合、管理画面でSMTPAUTH設定を行う必要があります。<br /><br />\"Sendmail -f\"は、-fパラメータが必要なサーバ向けの設定で、スプーフィングを防ぐために用いられることが多いセキュリティ上の設定です。メールサーバーのホスト側で使用可能な設定になっていない場合、エラーになることがあります。',12,1,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'sendmail\', \'sendmail-f\', \'smtp\', \'smtpauth\'),');
INSERT INTO `configuration` VALUES (207,'SMTP認証 - メールアカウント','EMAIL_SMTPAUTH_MAILBOX','YourEmailAccountNameHere','あなたのホスティングサービスが提供しているメールアカウント(例：me@mydomain.com)を入力してください。これはSMTP認証に必要な情報です。<br />メールにSMTP認証を使っている場合にのみ必要です。',12,101,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (208,'SMTP認証 - パスワード','EMAIL_SMTPAUTH_PASSWORD','YourPasswordHere','SMTPメールボックスのパスワードを入力してください。<br />メールにSMTP認証を使っている場合にのみ必要です。',12,101,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (209,'SMTP認証 - DNS名','EMAIL_SMTPAUTH_MAIL_SERVER','mail.EnterYourDomain.com','SMTPメールサーバのDNS名を入力してください。<br />例：mail.mydomain.com or 55.66.77.88<br />メールにSMTP認証を使っている場合にのみ必要です。',12,101,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (210,'SMTP認証 - IPポート番号','EMAIL_SMTPAUTH_MAIL_SERVER_PORT','25','SMTPメールサーバが運用されているIPポート番号を入力してください。<br />メールにSMTP認証を使っている場合にのみ必要です。',12,101,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (211,'テキストメールでの貨幣の変換','CURRENCIES_TRANSLATIONS','&amp;pound;,£:&amp;euro;,EUR','テキスト形式のメールに、どんな貨幣の変換が必要ですか?<br />Default = &amp;pound;,£:&amp;euro;,EUR',12,120,NULL,'2003-11-21 00:00:00',NULL,'zen_cfg_textarea_small(');
INSERT INTO `configuration` VALUES (212,'メールの改行コード','EMAIL_LINEFEED','LF','メールヘッダを区切るのに使用する改行コードを指定します。',12,2,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'LF\', \'CRLF\'),');
INSERT INTO `configuration` VALUES (213,'メール送信にMIME HTMLを使用','EMAIL_USE_HTML','false','メールをHTML形式で送信するかどうかを設定します。',12,3,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (214,'メールアドレスをDNSで確認','ENTRY_EMAIL_ADDRESS_CHECK','false','メールアドレスをDNSサーバに問い合わせ確認するかどうかを設定します。',12,4,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (215,'メールを送信','SEND_EMAILS','true','E-Mailを外部に送信するかどうかを設定します。',12,5,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (216,'メール保存の設定','EMAIL_ARCHIVE','false','送信済みのメールを保存しておく場合はtrueを設定してください。',12,6,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (217,'メール送信エラーの表示','EMAIL_FRIENDLY_ERRORS','false','メール送信が失敗した際、人目でわかるエラーを表示しますか? 運営中のショップではtrueに設定することを勧めます。falseに設定するとPHPのエラーメッセージを表示されるので、トラブル解決のヒントになります。',12,7,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (218,'メールアドレス (ショップに表示する問い合わせ先)','STORE_OWNER_EMAIL_ADDRESS','hachiya@ark-web.jp','ショップオーナーのメールアドレスとしてサイト上で表示されるアドレスを設定します。',12,10,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (219,'メールアドレス (顧客への送信元)','EMAIL_FROM','hachiya@ark-web.jp','顧客に送信されるメールのデフォルトの送信元として表示されるアドレスを設定します。<br />\r\n管理画面でメールを作成をする都度、書き換えることもできます。',12,11,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (220,'送信メールの送信元アドレスの実在性','EMAIL_SEND_MUST_BE_STORE','No','お使いのメールサーバでは、送信するメールの送信元(From)アドレスがWebサーバ上に実在することが必須ですか?<br /><br />spam送信を防止するなどのためにこのように設定されていることがあります。Yesに設定すると、送信元アドレスとメール内のFromアドレスが一致していることが求められます。',12,11,NULL,'0001-01-01 00:00:00',NULL,'zen_cfg_select_option(array(\'No\', \'Yes\'), ');
INSERT INTO `configuration` VALUES (221,'管理者が送信するメールフォーマット','ADMIN_EXTRA_EMAIL_FORMAT','TEXT','管理者が送付するメールフォーマットを設定します。<br /><br />\r\n・TEXT =テキスト形式<br />\r\n・HTML =HTML形式',12,12,NULL,'0001-01-01 00:00:00',NULL,'zen_cfg_select_option(array(\'TEXT\', \'HTML\'), ');
INSERT INTO `configuration` VALUES (222,'注文確認メール(コピー)送信先','SEND_EXTRA_ORDER_EMAILS_TO','hachiya@ark-web.jp','顧客に送信される注文確認メールのコピーを送付するメールアドレスを設定します。<br />記入例: 名前1 &lt;email@address1&gt;, 名前2 &lt;email@address2&gt;',12,12,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (223,'アカウント作成完了メール(コピー)の送信','SEND_EXTRA_CREATE_ACCOUNT_EMAILS_TO_STATUS','0','アカウント作成完了メールのコピーを指定のメールアドレスに送信しますか?<br /><br />\r\n・0= off<br />\r\n・1= on',12,13,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'),');
INSERT INTO `configuration` VALUES (224,'アカウント作成完了メール(コピー)の送信先','SEND_EXTRA_CREATE_ACCOUNT_EMAILS_TO','hachiya@ark-web.jp','アカウント作成完了メールのコピーを送信するメールアドレスを設定します。<br /><br />\r\n記入例： 名前1 &lt;email@address1&gt;, 名前2 &lt;email@address2&gt;',12,14,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (225,'「友達に知らせる」メール(コピー)の送信','SEND_EXTRA_TELL_A_FRIEND_EMAILS_TO_STATUS','0','「友達に知らせる」メールのコピーを送信しますか?<br />0= off 1= on',12,15,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'),');
INSERT INTO `configuration` VALUES (226,'「友達に知らせる」メール(コピー)の送信先','SEND_EXTRA_TELL_A_FRIEND_EMAILS_TO','hachiya@ark-web.jp','「友達に知らせる」メールのコピーを送信するメールアドレスを設定します。記入例: 名前1 &lt;email@address1&gt;, 名前2 &lt;email@address2&gt;',12,16,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (227,'ギフト券送付メール(コピー)の送信','SEND_EXTRA_GV_CUSTOMER_EMAILS_TO_STATUS','0','顧客が送付するギフト券送付メールのコピーを送信しますか?<br /><br />\r\n・0= off<br />\r\n・1= on',12,17,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'),');
INSERT INTO `configuration` VALUES (228,'ギフト券送付メール(コピー)の送信先','SEND_EXTRA_GV_CUSTOMER_EMAILS_TO','hachiya@ark-web.jp','顧客が送付するギフト券送付メールのコピーを送信するメールアドレスを設定します。<br /><br />記入例： 名前1 &lt;email@address1&gt;, 名前2&lt;email@address2&gt;',12,18,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (229,'ショップ運営者からのギフト券送付メール(コピー)の送信','SEND_EXTRA_GV_ADMIN_EMAILS_TO_STATUS','0','ショップ運営者からのギフト券送付メールのコピーを送信しますか?<br /><br />\r\n・0= off<br />\r\n・1= on',12,19,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'),');
INSERT INTO `configuration` VALUES (230,'ショップ運営者からのギフト券送付メール(コピー)の送信先','SEND_EXTRA_GV_ADMIN_EMAILS_TO','hachiya@ark-web.jp','ショップ運営者からのギフト券送付メールのコピーを送信するメールアドレスを設定します。<br /><br />\r\n記入例：名前1 &lt;email@address1&gt;, 名前2 &lt;email@address2&gt;',12,20,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (231,'ショップ運営者からのクーポン券送付メール(コピー)の送信','SEND_EXTRA_DISCOUNT_COUPON_ADMIN_EMAILS_TO_STATUS','0','ショップ運営者からのクーポン券送付メールのコピーを送信しますか?<br />0= off 1= on',12,21,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'),');
INSERT INTO `configuration` VALUES (232,'ショップ運営者からのクーポン券送付メール(コピー)の送信先','SEND_EXTRA_DISCOUNT_COUPON_ADMIN_EMAILS_TO','hachiya@ark-web.jp','ショップ運営者からのクーポン券送付メールのコピーを送信するメールアドレスを設定します。<br /><br />\r\n記入例： 名前1 &lt;email@address1&gt;, 名前2 &lt;email@address2&gt;',12,22,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (233,'ショップ運営者の注文ステータスメール(コピー)の送信','SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO_STATUS','0','ショップ運営者の注文ステータスメールのコピーを送信しますか?<br /><br />\r\n・0= off<br />\r\n・1= on',12,23,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'),');
INSERT INTO `configuration` VALUES (234,'ショップ運営者の注文ステータスメール(コピー)の送信先','SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO','hachiya@ark-web.jp','ショップ運営者の注文ステータスメールのコピーを送信するメールアドレスを設定します。<br /><br />\r\n記入例： 名前1 &lt;email@address1&gt;, 名前2 &lt;email@address2&gt;',12,24,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (235,'掲載待ちレビューについてメール送信','SEND_EXTRA_REVIEW_NOTIFICATION_EMAILS_TO_STATUS','0','掲載待ちのレビューについてメールを送信しますか?<br />0= off 1= on',12,25,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'),');
INSERT INTO `configuration` VALUES (236,'掲載待ちレビューについてのメール送信先','SEND_EXTRA_REVIEW_NOTIFICATION_EMAILS_TO','hachiya@ark-web.jp','掲載待ちのレビューについてのメールを送信するアドレスを設定します。<br />フォーマット：Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;',12,26,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (237,'「お問い合わせ」メールのドロップダウン設定','CONTACT_US_LIST','','「お問い合わせ」ページで、メールアドレスのリストを設定し、ドロップダウンリストとして表示できます。<br />\r\nフォーマット：Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;',12,40,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_textarea(');
INSERT INTO `configuration` VALUES (238,'ゲストに「友達に知らせる」機能を許可','ALLOW_GUEST_TO_TELL_A_FRIEND','false','ゲスト(未登録ユーザ)に「友達に知らせる」機能を許可するかどうかを設定します。 <br />[false]に設定すると、この機能を利用しようとした際にログインを促します。',12,50,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (239,'「お問い合わせ」にショップ名と住所を表記','CONTACT_US_STORE_NAME_ADDRESS','1','「お問い合わせ」画面にショップ名と住所を表記するかどうかを設定します。<br /><br />\r\n・0= off<br />\r\n・1= on',12,50,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO `configuration` VALUES (240,'在庫わずかになったらメール送信','SEND_LOWSTOCK_EMAIL','0','商品の在庫が水準を下回った際にメールを送信するかどうかを設定します。<br />\r\n・0= off<br />\r\n・1= on',12,60,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'),');
INSERT INTO `configuration` VALUES (241,'在庫わずかになった際のメール送信先','SEND_EXTRA_LOW_STOCK_EMAILS_TO','hachiya@ark-web.jp','商品の在庫が水準を下回った際にメールを送信するアドレスを設定します。複数設定することができます。<br />\r\nフォーマット：Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;',12,61,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (242,'「メールマガジンの購読解除」リンクの表示','SHOW_NEWSLETTER_UNSUBSCRIBE_LINK','true','「メールマガジンの購読解除」リンクをインフォメーションサイドボックスに表示しますか?',12,70,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (243,'オンラインユーザー数の表示設定','AUDIENCE_SELECT_DISPLAY_COUNTS','true','オンラインのユーザ(audiences/recipients)を表示する際、recipientsを含めますか?<br /><br />\r\n【注意】この設定をtrueにすると、沢山の顧客がいる場合などに表示が遅くなる場合があります。',12,90,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (244,'ダウンロードを有効にする','DOWNLOAD_ENABLED','true','商品のダウンロード機能を設定します。',13,1,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (245,'リダイレクトでダウンロード画面へ','DOWNLOAD_BY_REDIRECT','true','ダウンロードの際にブラウザによるリダイレクト(転送)を可能にするかどうかを設定します。<br />\r\nUNIX系でないサーバではオフにしてください。\r\n<br />注意：この設定をオンにしたら、/pub ディレクトリのパーミッションを777にしてください。',13,2,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (246,'ストリーミングによるダウンロード','DOWNLOAD_IN_CHUNKS','false','「リダイレクトでダウンロード」がオフで、かつPHP memory_limit設定が8MB以下の場合、この設定をオンにしてください。ストリーミングで、より小さな単位でのファイル転送を行うためです。<br /><br />「リダイレクトでダウンロード」がオンの場合、効果はありません。',13,2,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (247,'ダウンロードの有効期限(日数)','DOWNLOAD_MAX_DAYS','7','ダウンロードリンクの有効期間の日数を設定します。<br /><br />\r\n・0 = 無期限',13,3,NULL,'2009-11-19 12:39:39',NULL,'');
INSERT INTO `configuration` VALUES (248,'ダウンロード可能回数(商品ごと)','DOWNLOAD_MAX_COUNT','5','ダウンロードできる回数の最大値を設定します。<br /><br />\r\n・0 = ダウンロード不可',13,4,NULL,'2009-11-19 12:39:39',NULL,'');
INSERT INTO `configuration` VALUES (249,'ダウンロード設定 - 注文状況による更新','DOWNLOADS_ORDERS_STATUS_UPDATED_VALUE','4','orders_statusによるダウンロードの有効期限・可能回数のリセットについて設定します。<br />デフォルト = 4',13,10,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (250,'ダウンロード可能となる注文ステータスのID - デフォルト >= 2','DOWNLOADS_CONTROLLER_ORDERS_STATUS','2','ダウンロード可能となる注文ステータスのID - デフォルト >= 2<br /><br />注文ステータスのIDがこの値より高い注文はダウンロード可能になります。購入完了時の注文ステータスは支払いモジュールに毎に設定されます。',13,12,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (251,'ダウンロード終了となる注文ステータスのID','DOWNLOADS_CONTROLLER_ORDERS_STATUS_END','4','ダウンロード終了となる注文ステータスのID - デフォルト >= 4<br /><br />注文ステータスがこの値より高い注文はダウンロードが終了となります。',13,13,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (252,'Price Factor属性を可能にする','ATTRIBUTES_ENABLED_PRICE_FACTOR','true','Price Factor属性を可能にするかどうかを設定します。',13,25,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (253,'Qty Price Discount属性のオン/オフ','ATTRIBUTES_ENABLED_QTY_PRICES','true','「大量購入による値引き」属性のオン/オフを設定します。',13,26,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (254,'イメージ属性のオン/オフ','ATTRIBUTES_ENABLED_IMAGES','true','イメージ属性のオン/オフを設定します。',13,28,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (255,'(言葉・文字による)テキストによる価格設定のオン/オフ','ATTRIBUTES_ENABLED_TEXT_PRICES','true','テキストによる価格設定の属性のオン/オフを設定します。',13,35,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (256,'テキストによる価格設定 - 空欄の場合は無料','TEXT_SPACES_FREE','1','テキストによる価格設定の場合、空欄のままなら無料にするかどうかを設定します。<br /><br />\r\n・0= off<br />\r\n・1= on',13,36,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO `configuration` VALUES (257,'Read Only属性の商品 -「カートに入れる」ボタンの表示','PRODUCTS_OPTIONS_TYPE_READONLY_IGNORED','1','READONLY属性だけが設定された商品に「カートに入れる」ボタンを表示しますか?<br />0= OFF<br />1= ON',13,37,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO `configuration` VALUES (258,'GZip圧縮を使用する','GZIP_LEVEL','0','HTTP通信にGZip圧縮を使用してページを転送しますか?<br /><br />\r\n・0= off<br />\r\n・1= on',14,1,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'),');
INSERT INTO `configuration` VALUES (259,'セッション情報保存ディレクトリ','SESSION_WRITE_DIRECTORY','/var/www/projects/z/zen-cart/htdocs/hachiya/zencart-sugu/cache','セッション管理がファイルベースの場合に保存するディレクトリを設定します。',15,1,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (260,'クッキーに保存するドメイン名の設定','SESSION_USE_FQDN','True','クッキーに保存するドメイン名について設定します。<br /><br />\r\n\r\n・True = ドメインネーム全体をクッキーに保存(例：www.mydomain.com)<br />\r\n・False = ドメインネームの一部を保存(例：mydomain.com)。<br />\r\nよくわからない場合はこの設定はTrueにしておいてください。',15,2,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES (261,'クッキー利用を必須にする','SESSION_FORCE_COOKIE_USE','True','セッションに必ずクッキーを利用します。True指定するとブラウザのクッキーがオフになっている場合はセッションを開始しません。セキュリティ上の理由から余程の理由のない限りはTrue指定のままとすることを強く推奨します。',15,2,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES (262,'SSLセッションIDチェック','SESSION_CHECK_SSL_SESSION_ID','False','全てのHTTPSリクエストでSSLセッションIDをチェックしますか?',15,3,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES (263,'User Agentチェック','SESSION_CHECK_USER_AGENT','False','全てのリクエスト時にUser Agentのチェックを行いますか?',15,4,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES (264,'IPアドレスチェック','SESSION_CHECK_IP_ADDRESS','False','全てのリクエスト時にIPアドレスをチェックしますか?',15,5,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES (265,'ロボット(スパイダー)のセッションを防止','SESSION_BLOCK_SPIDERS','True','既知のロボット(スパイダー)がセッションを開始することを防止しますか?',15,6,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES (266,'セッション再発行','SESSION_RECREATE','True','ユーザーがログオンまたはアカウントを作成した場合にセッションを再発行しますか?<br />(PHP4.1以上が必要)',15,7,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES (267,'IPアドレス変換の設定','SESSION_IP_TO_HOST_ADDRESS','true','IPアドレスをホストアドレスに変換しますか?<br /><br />注意：サーバによっては、この設定でメール送信のスタート・終了が遅くなることがあります。',15,10,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (268,'ギフト/クーポン券コードの長さ','SECURITY_CODE_LENGTH','10','ギフト/クーポン券コードの長さを設定します。<br /><br />\r\n注意：コードが長いほど安全です。',16,1,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (269,'差引残高0の場合の注文ステータス','DEFAULT_ZERO_BALANCE_ORDERS_STATUS_ID','2','注文の差引残高が0の場合に適用される注文ステータスを設定します。',16,0,NULL,'2009-11-19 12:39:39','zen_get_order_status_name','zen_cfg_pull_down_order_statuses(');
INSERT INTO `configuration` VALUES (270,'ウェルカムクーポン券','NEW_SIGNUP_DISCOUNT_COUPON','','会員登録時にその会員にウェルカムクーポン券として自動発行するクーポン券を選択してください。',16,75,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_coupon_id(');
INSERT INTO `configuration` VALUES (271,'新しいギフト券の登録額','NEW_SIGNUP_GIFT_VOUCHER_AMOUNT','','新しいギフト券の登録額を設定します。<br /><br />\r\n・空白 = なし<br />\r\n・1000 = 1000円',16,76,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (272,'クーポン券のページあたり最大表示件数','MAX_DISPLAY_SEARCH_RESULTS_DISCOUNT_COUPONS','20','クーポン券の1ページあたりの表示件数を設定します。',16,81,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (273,'クーポン券レポートのページあたり最大表示件数','MAX_DISPLAY_SEARCH_RESULTS_DISCOUNT_COUPONS_REPORTS','20','クーポン券のレポートページでの表示件数を設定します。',16,81,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (274,'ギフト券残高の最大値数','MAX_GIFT_AMOUNT','100000','ギフト券残高の最大値を設定します。ギフト券引き換え結果がこの値を超える場合は引き換え処理ができません。値は100000以下を指定してください。',16,82,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (275,'クレジットカード利用の可否 - VISA','CC_ENABLED_VISA','1','VISAを有効にしますか?<br /><br />\r\n・0= off<br />\r\n・1= on',17,1,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO `configuration` VALUES (276,'クレジットカード利用の可否 - MasterCard','CC_ENABLED_MC','1','MasterCardを有効にしますか?<br /><br />\r\n・0= off<br />\r\n・1= on',17,2,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO `configuration` VALUES (277,'クレジットカード利用の可否 - AmericanExpress','CC_ENABLED_AMEX','0','AmericanExpressを有効にしますか?<br /><br />\r\n・0= off<br />\r\n・1= on',17,3,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO `configuration` VALUES (278,'クレジットカード利用の可否 - Diners Club','CC_ENABLED_DINERS_CLUB','0','Diners Clubを有効にしますか?<br /><br />\r\n・0= off<br />\r\n・1= on',17,4,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO `configuration` VALUES (279,'クレジットカード利用の可否 - Discover Card','CC_ENABLED_DISCOVER','0','Discover Cardを有効にしますか?<br /><br />\r\n・0= off<br />\r\n・1= on',17,5,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO `configuration` VALUES (280,'クレジットカード利用の可否 - JCB','CC_ENABLED_JCB','0','JCBを有効にしますか?<br /><br />\r\n・0= off<br />\r\n・1= on',17,6,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO `configuration` VALUES (281,'クレジットカード利用の可否 - AUSTRALIAN BANKCARD','CC_ENABLED_AUSTRALIAN_BANKCARD','0','AUSTRALIAN BANKCARDを有効にしますか?<br /><br />\r\n・0= off<br />\r\n・1= on',17,7,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO `configuration` VALUES (282,'利用可能なクレジットカード - 支払いページに表示','SHOW_ACCEPTED_CREDIT_CARDS','0','利用可能なクレジットカードを支払いページに表示しますか?<br /><br />\r\n・0= off<br />\r\n・1= テキストを表示<br />\r\n・2= 画像を表示<br />\r\n【注意】クレジットカードの画像とテキストは、データベースとランゲージファイル内で定義されている必要があります。',17,50,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), ');
INSERT INTO `configuration` VALUES (283,'ギフト券の表示','MODULE_ORDER_TOTAL_GV_STATUS','true','',6,1,NULL,'2003-10-30 22:16:40',NULL,'zen_cfg_select_option(array(\'true\'),');
INSERT INTO `configuration` VALUES (284,'表示の整列順','MODULE_ORDER_TOTAL_GV_SORT_ORDER','840','表示の整列順を設定します。<br />数字が小さいほど上位に表示されます。',6,2,NULL,'2003-10-30 22:16:40',NULL,NULL);
INSERT INTO `configuration` VALUES (285,'購入を承認待ちに','MODULE_ORDER_TOTAL_GV_QUEUE','true','ギフト券購入を承認待ちリストに追加しますか?',6,3,NULL,'2003-10-30 22:16:40',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (286,'送料を含める','MODULE_ORDER_TOTAL_GV_INC_SHIPPING','true','合計計算に送料を含めますか?',6,5,NULL,'2003-10-30 22:16:40',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (287,'税金を含める','MODULE_ORDER_TOTAL_GV_INC_TAX','true','計算時に税金を含めるかどうかを設定します。',6,6,NULL,'2003-10-30 22:16:40',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (288,'税金を再計算','MODULE_ORDER_TOTAL_GV_CALC_TAX','None','税金を再計算しますか?',6,7,NULL,'2003-10-30 22:16:40',NULL,'zen_cfg_select_option(array(\'None\', \'Standard\', \'Credit Note\'),');
INSERT INTO `configuration` VALUES (289,'税種別','MODULE_ORDER_TOTAL_GV_TAX_CLASS','0','ギフト券に適用される税種別を設定します。',6,0,NULL,'2003-10-30 22:16:40','zen_get_tax_class_title','zen_cfg_pull_down_tax_classes(');
INSERT INTO `configuration` VALUES (290,'税金を付加する','MODULE_ORDER_TOTAL_GV_CREDIT_TAX','false','ギフト券を計算する際に税金を付加しますか?',6,8,NULL,'2003-10-30 22:16:40',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (1524,'テキストメールでの貨幣の変換','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_211','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1525,'配送モジュール','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_MODULES_OT_SHIPPING','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1526,'小計モジュール','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_MODULES_OT_SUBTOTAL','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1532,'小数点','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_SUPER_ORDERS_NUMBER_UNIT','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1533,'小数点','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_SALEMAKER_NUMBER_UNIT','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (958,'優先順','MODULE_EASY_ADMIN_SIMPLIFY_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,1,NULL,'2010-06-07 16:43:06',NULL,NULL);
INSERT INTO `configuration` VALUES (300,'送料の表示','MODULE_ORDER_TOTAL_SHIPPING_STATUS','true','',6,1,NULL,'2003-10-30 22:16:46',NULL,'zen_cfg_select_option(array(\'true\'),');
INSERT INTO `configuration` VALUES (301,'表示の整列順','MODULE_ORDER_TOTAL_SHIPPING_SORT_ORDER','200','表示の整列順を設定します。<br />\r\n数字が小さいほど上位に表示されます。',6,2,NULL,'2003-10-30 22:16:46',NULL,NULL);
INSERT INTO `configuration` VALUES (302,'送料無料設定','MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING','false','送料無料設定を有効にしますか?',6,3,NULL,'2003-10-30 22:16:46',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (303,'送料無料にする購入金額設定','MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER','50','設定金額以上のご購入の場合は送料を無料にします。',6,4,NULL,'2003-10-30 22:16:46','currencies->format',NULL);
INSERT INTO `configuration` VALUES (304,'送料無料にする地域の設定','MODULE_ORDER_TOTAL_SHIPPING_DESTINATION','national','設定した地域に対して送料無料を適用します。',6,5,NULL,'2003-10-30 22:16:46',NULL,'zen_cfg_select_option(array(\'national\', \'international\', \'both\'),');
INSERT INTO `configuration` VALUES (305,'小計の表示','MODULE_ORDER_TOTAL_SUBTOTAL_STATUS','true','',6,1,NULL,'2003-10-30 22:16:49',NULL,'zen_cfg_select_option(array(\'true\'),');
INSERT INTO `configuration` VALUES (306,'表示の整列順','MODULE_ORDER_TOTAL_SUBTOTAL_SORT_ORDER','100','表示の整列順を設定します。<br />\r\n数字が小さいほど上位に表示されます。',6,2,NULL,'2003-10-30 22:16:49',NULL,NULL);
INSERT INTO `configuration` VALUES (307,'税金の表示','MODULE_ORDER_TOTAL_TAX_STATUS','true','',6,1,NULL,'2003-10-30 22:16:52',NULL,'zen_cfg_select_option(array(\'true\'),');
INSERT INTO `configuration` VALUES (308,'表示の整列順','MODULE_ORDER_TOTAL_TAX_SORT_ORDER','300','表示の整列順を設定できます. 数字が小さいほど上位に表示されます。',6,2,NULL,'2003-10-30 22:16:52',NULL,NULL);
INSERT INTO `configuration` VALUES (309,'合計の表示','MODULE_ORDER_TOTAL_TOTAL_STATUS','true','',6,1,NULL,'2003-10-30 22:16:55',NULL,'zen_cfg_select_option(array(\'true\'),');
INSERT INTO `configuration` VALUES (310,'表示の整列順','MODULE_ORDER_TOTAL_TOTAL_SORT_ORDER','999','表示の整列順を設定できます。<br />\r\n数字が小さいほど上位に表示されます。',6,2,NULL,'2003-10-30 22:16:55',NULL,NULL);
INSERT INTO `configuration` VALUES (311,'税種別','MODULE_ORDER_TOTAL_COUPON_TAX_CLASS','0','クーポン券に適用される税種別を設定します。',6,0,NULL,'2003-10-30 22:16:36','zen_get_tax_class_title','zen_cfg_pull_down_tax_classes(');
INSERT INTO `configuration` VALUES (312,'税金を含める - オン/オフ','MODULE_ORDER_TOTAL_COUPON_INC_TAX','true','代金計算に税金を含めるかどうかを設定します。',6,6,NULL,'2003-10-30 22:16:36',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (313,'表示の整列順','MODULE_ORDER_TOTAL_COUPON_SORT_ORDER','280','表示の整列順を設定します。',6,2,NULL,'2003-10-30 22:16:36',NULL,NULL);
INSERT INTO `configuration` VALUES (314,'送料を含める','MODULE_ORDER_TOTAL_COUPON_INC_SHIPPING','false','送料を計算に含めるかどうかを設定します。',6,5,NULL,'2003-10-30 22:16:36',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (315,'クーポン券の表示','MODULE_ORDER_TOTAL_COUPON_STATUS','true','',6,1,NULL,'2003-10-30 22:16:36',NULL,'zen_cfg_select_option(array(\'true\'),');
INSERT INTO `configuration` VALUES (316,'税金を再計算','MODULE_ORDER_TOTAL_COUPON_CALC_TAX','Standard','税金を再計算しますか?',6,7,NULL,'2003-10-30 22:16:36',NULL,'zen_cfg_select_option(array(\'None\', \'Standard\', \'Credit Note\'),');
INSERT INTO `configuration` VALUES (317,'管理者デモ -オン/オフ','ADMIN_DEMO','0','管理者デモを有効にするかどうかを設定します。<br /><br />\r\n・0= off<br />\r\n・1= on',6,0,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO `configuration` VALUES (318,'商品オプション - セレクトボックス型','PRODUCTS_OPTIONS_TYPE_SELECT','0','セレクトボックス型の商品オプションの数値は?',0,NULL,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (319,'商品オプション - テキスト型','PRODUCTS_OPTIONS_TYPE_TEXT','1','テキスト型の商品オプションの数値は?',6,NULL,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (320,'商品オプション - ラジオボタン型','PRODUCTS_OPTIONS_TYPE_RADIO','2','ラジオボタン型の商品オプションの数値は?',6,NULL,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (321,'商品オプション - チェックボックス型','PRODUCTS_OPTIONS_TYPE_CHECKBOX','3','チェックボックス型の商品オプションの数値は?',6,NULL,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (322,'商品オプション - ファイル型','PRODUCTS_OPTIONS_TYPE_FILE','4','ファイル型の商品オプションの数値は?',6,NULL,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (323,'ID for text and file products options values','PRODUCTS_OPTIONS_VALUES_TEXT_ID','0','テキスト型・ファイル型属性のproducts_options_values_idで使われる数値は?',6,NULL,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (324,'アップロードオプションの接頭辞(Prefix)','UPLOAD_PREFIX','upload_','アップロードオプションを他のオプションと区別するために使う接頭辞(Prefix)は?',0,NULL,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (325,'テキストの接頭辞(Prefix)','TEXT_PREFIX','txt_','テキストオプションを他のオプションと区別するために使う接頭辞(Prefix)は?',0,NULL,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (326,'商品オプション - READ ONLY型','PRODUCTS_OPTIONS_TYPE_READONLY','5','READ ONLY型の商品オプションの数値は?',6,NULL,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (327,'商品情報 - 商品オプションのソート順','PRODUCTS_OPTIONS_SORT_ORDER','0','商品情報におけるオプション名のソート順を設定します。<br />\r\n<br />\r\n・0= ソート順、オプション名<br />\r\n・1= オプション名',18,35,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'),');
INSERT INTO `configuration` VALUES (328,'商品情報 - 商品オプション値のソート順','PRODUCTS_OPTIONS_SORT_BY_PRICE','1','商品説明での商品オプション値のソート順を設定します。<br />\r\n<br />\r\n・0= ソート順、価格<br />\r\n・1= ソート順、オプション値の名称',18,36,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'),');
INSERT INTO `configuration` VALUES (329,'商品の属性画像の下に表示するオプション値','PRODUCT_IMAGES_ATTRIBUTES_NAMES','1','商品の属性画像の下にオプション名を表示しますか?<br /><br />\r\n・0= off<br />\r\n・1= on',18,41,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO `configuration` VALUES (330,'商品情報 - セール割引表示','SHOW_SALE_DISCOUNT_STATUS','1','セール割引分を表示しますか?<br /><br />\r\n・0= off<br />\r\n・1= on',18,45,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO `configuration` VALUES (331,'商品情報 - セール割引の表示方法(割引額・パーセント)','SHOW_SALE_DISCOUNT','1','セール割引の表示方法を設定します。<br /><br />\r\n・1= 割引率(%) でのoff<br />\r\n・2= 割引金額 でのoff',18,46,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'1\', \'2\'), ');
INSERT INTO `configuration` VALUES (332,'商品情報 - 割引率表示の小数点','SHOW_SALE_DISCOUNT_DECIMALS','0','割引率表示のパーセントの小数点位置を設定します。<br /><br />\r\n・デフォルト= 0',18,47,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (333,'商品情報- 無料商品の画像・テキストのステータス','OTHER_IMAGE_PRICE_IS_FREE_ON','1','商品情報での無料商品の画像・イメージの表示を設定します。<br />\r\n<br />\r\n・0= Text<br />\r\n・1= Image',18,50,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO `configuration` VALUES (334,'商品情報 - お問い合わせ商品表示設定','PRODUCTS_PRICE_IS_CALL_IMAGE_ON','1','お問い合わせ商品であることを表示する画像またはテキストについて設定します。<br /><br />\r\n・0= テキスト<br />\r\n・1= 画像',18,51,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO `configuration` VALUES (335,'商品の数量欄 - 新しく商品を追加する際に','PRODUCTS_QTY_BOX_STATUS','1','新しく商品を登録する際、商品の数量欄のデフォルト設定をどうしますか?<br /><br />\r\n・0= off<br />\r\n・1= on<br />\r\n注意：onにすると数量欄を表示し、「カートに加える」もonになります。(This will show a Qty Box when ON and default the Add to Cart to 1)',18,55,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO `configuration` VALUES (336,'商品レビュー - 承認の要否','REVIEWS_APPROVAL','1','商品レビューの表示には承認が必要にしますか?<br /><br />\r\n・0= off<br />\r\n・1= on<br />\r\n注意：レビューが非表示設定になっている場合は無視されます。',18,62,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO `configuration` VALUES (337,'METAタグ - TITLEタグへの商品価格表示','META_TAG_INCLUDE_PRICE','1','TITLEタグに商品価格を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1= on',18,70,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO `configuration` VALUES (338,'METAタグ - Meta Descriptionの長さ','MAX_META_TAG_DESCRIPTION_LENGTH','50','Meta Descriptionの最大の長さを設定してください。<br />デフォルトの最大値(ワード数)：50',18,71,NULL,'2009-11-19 12:39:39','','');
INSERT INTO `configuration` VALUES (339,'「こんな商品も購入しています」 - 横列あたりの表示点数','SHOW_PRODUCT_INFO_COLUMNS_ALSO_PURCHASED_PRODUCTS','3','「こんな商品も買っています」の横列(Row)あたりの表示点数を設定します。<br />0= off またはソート順を設定',18,72,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\', \'5\', \'6\', \'7\', \'8\', \'9\', \'10\', \'11\', \'12\'), ');
INSERT INTO `configuration` VALUES (340,'[前へ] [次へ] - ナビゲーションバーの位置','PRODUCT_INFO_PREVIOUS_NEXT','1','[前へ] [次へ] ナビゲーションバーの位置を設定します。<br /><br />\r\n・0= off<br />\r\n・1= ページ上部<br />\r\n・2= ページ下部<br />\r\n・3= ページ上部・下部',18,21,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Off\'), array(\'id\'=>\'1\', \'text\'=>\'Top of Page\'), array(\'id\'=>\'2\', \'text\'=>\'Bottom of Page\'), array(\'id\'=>\'3\', \'text\'=>\'Both Top & Bottom of Page\')),');
INSERT INTO `configuration` VALUES (341,'[前へ] [次へ] - ソート順','PRODUCT_INFO_PREVIOUS_NEXT_SORT','1','商品のソート順を設定します。\r\n<br /><br />\r\n・0= 商品ID<br />\r\n・1= 商品名<br />\r\n・2= 型番<br />\r\n・3= 価格、商品名<br />\r\n・4= 価格、型番<br />\r\n・5= 商品名, 型番',18,22,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Product ID\'), array(\'id\'=>\'1\', \'text\'=>\'Name\'), array(\'id\'=>\'2\', \'text\'=>\'Product Model\'), array(\'id\'=>\'3\', \'text\'=>\'Product Price - Name\'), array(\'id\'=>\'4\', \'text\'=>\'Product Price - Model\'), array(\'id\'=>\'5\', \'text\'=>\'Product Name - Model\'), array(\'id\'=>\'6\', \'text\'=>\'Product Sort Order\')),');
INSERT INTO `configuration` VALUES (342,'[前へ] [次へ] - ボタンと画像のステータス','SHOW_PREVIOUS_NEXT_STATUS','0','ボタンと画像のステータスを設定します。<br /><br />\r\n・0= Off<br />\r\n・1= On',18,20,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Off\'), array(\'id\'=>\'1\', \'text\'=>\'On\')),');
INSERT INTO `configuration` VALUES (343,'[前へ] [次へ] - ボタンと画像の表示設定','SHOW_PREVIOUS_NEXT_IMAGES','0','[前へ] [次へ] のボタンと画像の表示を設定します。<br /><br />\r\n・0= ボタンのみ<br />\r\n・1= ボタン・商品画像<br />\r\n・2= 商品画像のみ',18,21,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Button Only\'), array(\'id\'=>\'1\', \'text\'=>\'Button and Product Image\'), array(\'id\'=>\'2\', \'text\'=>\'Product Image Only\')),');
INSERT INTO `configuration` VALUES (344,'[前へ] [次へ] - 画像の横幅','PREVIOUS_NEXT_IMAGE_WIDTH','50','[前へ] [次へ] 画像の横幅の横幅は?',18,22,NULL,'2009-11-19 12:39:39','','');
INSERT INTO `configuration` VALUES (345,'[前へ] [次へ] - 画像の高さ','PREVIOUS_NEXT_IMAGE_HEIGHT','40','[前へ] [次へ] 画像の横幅の高さは?',18,23,NULL,'2009-11-19 12:39:39','','');
INSERT INTO `configuration` VALUES (346,'[前へ] [次へ] - カテゴリ名と画像の配置','PRODUCT_INFO_CATEGORIES','1','[前へ] [次へ] のカテゴリの画像と名称の配置は?<br /><br />\r\n・0= off<br />\r\n・1= 左に配置<br />\r\n・2= 中央に配置<br />\r\n・3= 右に配置',18,20,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Off\'), array(\'id\'=>\'1\', \'text\'=>\'Align Left\'), array(\'id\'=>\'2\', \'text\'=>\'Align Center\'), array(\'id\'=>\'3\', \'text\'=>\'Align Right\')),');
INSERT INTO `configuration` VALUES (347,'左側サイドボックスの横幅','BOX_WIDTH_LEFT','150px','左側に表示されるサイドボックスの横幅を設定します。pxを含めて入力できます。\r\n<br /><br />\r\n・デフォルト = 150px',19,1,NULL,'2003-11-21 22:16:36',NULL,NULL);
INSERT INTO `configuration` VALUES (348,'右側サイドボックスの横幅','BOX_WIDTH_RIGHT','150px','右側に表示されるサイドボックスの横幅を設定します。pxを含めて入力できます。<br /><br />\r\n・Default = 150px',19,2,NULL,'2003-11-21 22:16:36',NULL,NULL);
INSERT INTO `configuration` VALUES (349,'パン屑リストの区切り文字','BREAD_CRUMBS_SEPARATOR','&nbsp;::&nbsp;','パン屑リストの区切り文字を設定します。<br /><br />\r\n【注意】空白を含む場合は&amp;nbsp;を使用することができます。<br />\r\n・デフォルト = &amp;nbsp;::&amp;nbsp;',19,3,NULL,'2003-11-21 22:16:36',NULL,'zen_cfg_textarea_small(');
INSERT INTO `configuration` VALUES (350,'パン屑リストの設定','DEFINE_BREADCRUMB_STATUS','1','パン屑リストのリンクを有効にしますか?<br />0= OFF<br />1= ON',19,4,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO `configuration` VALUES (351,'ベストセラー - 桁数合わせ文字','BEST_SELLERS_FILLER','&nbsp;','桁数を合わせるために挿入する文字を設定します。<br />デフォルト = &amp;nbsp;(空白)',19,5,NULL,'2003-11-21 22:16:36',NULL,'zen_cfg_textarea_small(');
INSERT INTO `configuration` VALUES (352,'ベストセラー - 表示文字数','BEST_SELLERS_TRUNCATE','35','ベストセラーのサイドボックスで表示する商品名の長さを設定します。<br />デフォルト = 35',19,6,NULL,'2003-11-21 22:16:36',NULL,NULL);
INSERT INTO `configuration` VALUES (353,'ベストセラー - 表示文字数を超えた場合に「...」を表示','BEST_SELLERS_TRUNCATE_MORE','true','商品名が途中で切れた場合に「...」を表示します。<br />デフォルト = true',19,7,'2003-03-21 13:08:25','2003-03-21 11:42:47',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (354,'カテゴリボックス - 特価商品のリンク表示','SHOW_CATEGORIES_BOX_SPECIALS','true','カテゴリボックスに特価商品のリンクを表示します。',19,8,'2003-03-21 13:08:25','2003-03-21 11:42:47',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (355,'カテゴリボックス - 新着商品のリンク表示','SHOW_CATEGORIES_BOX_PRODUCTS_NEW','true','カテゴリボックスに新着商品へのリンクを表示します。',19,9,'2003-03-21 13:08:25','2003-03-21 11:42:47',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (356,'ショッピングカートボックスの表示','SHOW_SHOPPING_CART_BOX_STATUS','1','ショッピングカートの表示を設定します。<br />\r\n<br />\r\n・0= 常に表示<br />\r\n・1= 商品が入っているときだけ表示<br />\r\n・2= 商品が入っているときに表示するが、ショッピングカートページでは表示しない',19,10,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), ');
INSERT INTO `configuration` VALUES (357,'カテゴリボックス - おすすめ商品へのリンクを表示','SHOW_CATEGORIES_BOX_FEATURED_PRODUCTS','true','カテゴリボックスにおすすめ商品へのリンクを表示しますか?',19,11,'2003-03-21 13:08:25','2003-03-21 11:42:47',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (358,'カテゴリボックス - 全商品リストへのリンクを表示','SHOW_CATEGORIES_BOX_PRODUCTS_ALL','true','カテゴリボックスに全商品リストへのリンクを表示しますか?',19,12,'2003-03-21 13:08:25','2003-03-21 11:42:47',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (359,'左側カラムの表示','COLUMN_LEFT_STATUS','1','左側カラムを表示しますか? (ページをオーバーライドするものがない場合)<br /><br />\r\n・0= 常に非表示<br />\r\n1= オーバーライドがなければ表示',19,15,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO `configuration` VALUES (360,'右側カラムの表示','COLUMN_RIGHT_STATUS','1','右側カラムを表示しますか? (ページをオーバーライドするものがない場合)<br /><br />\r\n・0= 常に非表示<br />\r\n・1= オーバーライドがなければ表示',19,16,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO `configuration` VALUES (361,'左側カラムの横幅','COLUMN_WIDTH_LEFT','150px','左側カラムの横幅を設定します。pxを含めて指定可能。<br /><br />\r\nデフォルト = 150px',19,20,NULL,'2003-11-21 22:16:36',NULL,NULL);
INSERT INTO `configuration` VALUES (362,'右側カラムの横幅','COLUMN_WIDTH_RIGHT','150px','右側カラムの横幅を設定します。pxを含めて指定可能。<br /><br />\r\nデフォルト = 150px',19,21,NULL,'2003-11-21 22:16:36',NULL,NULL);
INSERT INTO `configuration` VALUES (363,'カテゴリ名・リンク間の区切り','SHOW_CATEGORIES_SEPARATOR_LINK','1','カテゴリ名とリンク（「おすすめ商品」など）の間にセパレータ(区切り)を表示しますか?<br /><br />\r\n・0= off<br />\r\n・1= on',19,24,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO `configuration` VALUES (364,'カテゴリの区切り - カテゴリ名・商品数','CATEGORIES_SEPARATOR','-&gt;','カテゴリ名と(カテゴリ内の)商品数の間のセパレータ(区切り)は何にしますか?<br /><br />\r\nデフォルト = -&amp;gt;',19,25,NULL,'2003-11-21 22:16:36',NULL,'zen_cfg_textarea_small(');
INSERT INTO `configuration` VALUES (365,'カテゴリの区切り - カテゴリ名とサブカテゴリ名の間','CATEGORIES_SEPARATOR_SUBS','|_&nbsp;','カテゴリ名・サブカテゴリ名の間のセパレータ(区切り)は何にしますか?<br />\r\n<br />\r\nデフォルト = |_&amp;nbsp;',19,26,NULL,'2004-03-25 22:16:36',NULL,'zen_cfg_textarea_small(');
INSERT INTO `configuration` VALUES (366,'カテゴリ内商品数の接頭辞(Prefix)','CATEGORIES_COUNT_PREFIX','&nbsp;(','カテゴリ内の商品数表示の接頭辞(Prefix)は?\r\n<br /><br />\r\n・デフォルト= (',19,27,NULL,'2003-01-21 22:16:36',NULL,'zen_cfg_textarea_small(');
INSERT INTO `configuration` VALUES (367,'カテゴリ内商品数の接尾辞(Suffix)','CATEGORIES_COUNT_SUFFIX',')','カテゴリ内の商品数表示の接尾辞(Suffix)は?\r\n<br /><br />\r\n・デフォルト= )',19,28,NULL,'2003-01-21 22:16:36',NULL,'zen_cfg_textarea_small(');
INSERT INTO `configuration` VALUES (368,'カテゴリ・サブカテゴリのインデント','CATEGORIES_SUBCATEGORIES_INDENT','&nbsp;&nbsp;','サブカテゴリをインデント(字下げ)表示する際の文字・記号は?<br /><br />\r\n・デフォルト = &nbsp;&nbsp;',19,29,NULL,'2004-06-24 22:16:36',NULL,'zen_cfg_textarea_small(');
INSERT INTO `configuration` VALUES (369,'商品登録0のカテゴリ - 表示・非表示','CATEGORIES_COUNT_ZERO','0','商品数が0のカテゴリを表示しますか?<br />\r\n<br />\r\n・0 = off<br />\r\n・1 = on',19,30,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO `configuration` VALUES (370,'カテゴリボックスのスプリット(分割)表示','CATEGORIES_SPLIT_DISPLAY','True','商品タイプによってカテゴリボックスをスプリット(分割)表示するかどうかを設定します。',19,31,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES (371,'ショッピングカート - 合計を表示','SHOW_TOTALS_IN_CART','1','合計額をショッピングカートの上に表示しますか?<br />・0= off<br />・1= on: 商品の数量、重量合計<br />・2= on: 商品の数量、重量合計(0のときには非表示)<br />・3= on: 商品の数量合計',19,31,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'), ');
INSERT INTO `configuration` VALUES (372,'顧客への挨拶 - トップページに表示','SHOW_CUSTOMER_GREETING','1','顧客への歓迎メッセージを常にトップページに表示しますか?<br />0= off<br />1= on',19,40,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO `configuration` VALUES (373,'カテゴリ - トップページに表示','SHOW_CATEGORIES_ALWAYS','0','カテゴリを常にトップページに表示しますか?<br />\r\n・0= off<br />\r\n・1= on<br />\r\n・Default category can be set to Top Level or a Specific Top Level',19,45,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO `configuration` VALUES (374,'カテゴリ - トップページ での開閉','CATEGORIES_START_MAIN','0','トップページにおけるカテゴリの開閉状態を設定します。<br />\r\n・0= トップレベル(親)カテゴリのみ<br />\r\n・特定のカテゴリを開くにはカテゴリIDで指定。サブカテゴリも指定可能。<br />\r\n【例】3_10 (カテゴリID:3、サブカテゴリID:10)',19,46,NULL,'2009-11-19 12:39:39','','');
INSERT INTO `configuration` VALUES (375,'カテゴリ - サブカテゴリを常に開いておく','SHOW_CATEGORIES_SUBCATEGORIES_ALWAYS','1','カテゴリとサブカテゴリは常に表示しますか?<br />0= OFF 親カテゴリのみ<br />1= ON カテゴリ・サブカテゴリは選択されたら常に表示',19,47,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO `configuration` VALUES (376,'バナー表示グループ - ヘッダポジション1','SHOW_BANNERS_GROUP_SET1','','どのバナーグループをヘッダポジション1に使用しますか? 使わない場合は未記入にします。<br />\r\n<br />\r\nバナー表示グループは1つ(1バナーグループ)または複数(マルチバナーグループ)にすることもできます。マルチバナーグループを表示するためにはグループ名をコロン(<strong>:</strong>)で区切って入力します。<br />\r\n例：Wide-Banners:SideBox-Banners',19,55,NULL,'2009-11-19 12:39:39','','');
INSERT INTO `configuration` VALUES (377,'バナー表示グループ - ヘッダポジション2','SHOW_BANNERS_GROUP_SET2','','どのバナーグループをヘッダポジション2に使用しますか? 使わない場合は未記入にします。<br />\r\n<br />\r\nバナー表示グループは1つ(1バナーグループ)または複数(マルチバナーグループ)にすることもできます。マルチバナーグループを表示するためにはグループ名をコロン(<strong>:</strong>)で区切って入力します。<br />\r\n例：Wide-Banners:SideBox-Banners',19,56,NULL,'2009-11-19 12:39:39','','');
INSERT INTO `configuration` VALUES (378,'バナー表示グループ - ヘッダポジション3','SHOW_BANNERS_GROUP_SET3','','どのバナーグループをヘッダポジション3に使用しますか? 使わない場合は未記入にします。<br />\r\n<br />\r\nバナー表示グループは1つ(1バナーグループ)または複数(マルチバナーグループ)にすることもできます。マルチバナーグループを表示するためにはグループ名をコロン(<strong>:</strong>)で区切って入力します。<br />\r\n例：Wide-Banners:SideBox-Banners',19,57,NULL,'2009-11-19 12:39:39','','');
INSERT INTO `configuration` VALUES (379,'バナー表示グループ - フッタポジション1','SHOW_BANNERS_GROUP_SET4','','どのバナーグループをフッタポジション1に使用しますか? 使わない場合は未記入にします。<br />\r\n<br />\r\nバナー表示グループは1つ(1バナーグループ)または複数(マルチバナーグループ)にすることもできます。マルチバナーグループを表示するためにはグループ名をコロン(<strong>:</strong>)で区切って入力します。<br />\r\n例：Wide-Banners:SideBox-Banners',19,65,NULL,'2009-11-19 12:39:39','','');
INSERT INTO `configuration` VALUES (380,'バナー表示グループ - フッタポジション2','SHOW_BANNERS_GROUP_SET5','','どのバナーグループをフッタポジション2に使用しますか? 使わない場合は未記入にします。<br />\r\n<br />\r\nバナー表示グループは1つ(1バナーグループ)または複数(マルチバナーグループ)にすることもできます。マルチバナーグループを表示するためにはグループ名をコロン(<strong>:</strong>)で区切って入力します。<br />\r\n例：Wide-Banners:SideBox-Banners',19,66,NULL,'2009-11-19 12:39:39','','');
INSERT INTO `configuration` VALUES (381,'バナー表示グループ - フッタポジション3','SHOW_BANNERS_GROUP_SET6','Wide-Banners','どのバナーグループをフッタポジション3に使用しますか? 使わない場合は未記入にします。<br />\r\n<br />\r\nバナー表示グループは1つ(1バナーグループ)または複数(マルチバナーグループ)にすることもできます。マルチバナーグループを表示するためにはグループ名をコロン(<strong>:</strong>)で区切って入力します。<br />\r\n例：Wide-Banners:SideBox-Banners',19,67,NULL,'2009-11-19 12:39:39','','');
INSERT INTO `configuration` VALUES (382,'バナー表示グループ - サイドボックス内バナーボックス','SHOW_BANNERS_GROUP_SET7','SideBox-Banners','どのバナーグループをサイドボックス内バナーボックス2に使用しますか? 使わない場合は未記入にします。<br />\r\nデフォルトのグループはSideBox-Bannersです。<br />\r\n<br />\r\nバナー表示グループは1つ(1バナーグループ)または複数(マルチバナーグループ)にすることもできます。マルチバナーグループを表示するためにはグループ名をコロン(<strong>:</strong>)で区切って入力します。<br />\r\n例：Wide-Banners:SideBox-Banners',19,70,NULL,'2009-11-19 12:39:39','','');
INSERT INTO `configuration` VALUES (383,'バナー表示グループ - サイドボックス内バナーボックス2','SHOW_BANNERS_GROUP_SET8','SideBox-Banners','どのバナーグループをサイドボックス内バナーボックス2に使用しますか? 使わない場合は未記入にします。<br />\r\nデフォルトのグループはSideBox-Bannersです。<br />\r\n<br />\r\nバナー表示グループは1つ(1バナーグループ)または複数(マルチバナーグループ)にすることもできます。マルチバナーグループを表示するためにはグループ名をコロン(<strong>:</strong>)で区切って入力します。<br />\r\n例：Wide-Banners:SideBox-Banners',19,71,NULL,'2009-11-19 12:39:39','','');
INSERT INTO `configuration` VALUES (384,'バナー表示グループ - サイドボックス内バナーボックス全て','SHOW_BANNERS_GROUP_SET_ALL','BannersAll','サイドボックス内バナーボックス全て(Banner All sidebox)で表示するバナー表示グループは、1つです。デフォルトのグループはBannersAllです。どのバナーグループをサイドボックスのbanner_box_allに表示しますか?<br />表示しない場合は空欄にしてください。',19,72,NULL,'2009-11-19 12:39:39','','');
INSERT INTO `configuration` VALUES (385,'フッタ - IPアドレスの表示・非表示','SHOW_FOOTER_IP','1','顧客のIPアドレスをフッタに表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1= on<br />',19,80,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO `configuration` VALUES (386,'数量割引 - 追加割引レベル数','DISCOUNT_QTY_ADD','5','数量割引の割引レベルの追加数を指定します。一つの割引レベルに一つの割引設定を行うことができます。',19,90,NULL,'2009-11-19 12:39:39','','');
INSERT INTO `configuration` VALUES (387,'数量割引 - 一行あたりの表示数','DISCOUNT_QUANTITY_PRICES_COLUMN','5','商品情報ページで表示する数量割引設定の一行あたり表示数を指定します。割引設定数（割引レベル数）が一行あたりの表示数を超えた場合は、複数行で表示されます。',19,95,NULL,'2009-11-19 12:39:39','','');
INSERT INTO `configuration` VALUES (388,'カテゴリ/商品のソート順','CATEGORIES_PRODUCTS_SORT_ORDER','0','カテゴリ/商品のソート順を設定します。<br />0= カテゴリ/商品 ソート順/名前<br />1= カテゴリ/商品 名前<br />2= 商品モデル<br />3= 商品数量+, 商品名<br />4= 商品数量-, 商品名<br />5= 商品価格+, 商品名<br />6= 商品価格+, 商品名',19,100,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\', \'5\', \'6\'), ');
INSERT INTO `configuration` VALUES (389,'オプション名/オプション値の追加・コピー・削除','OPTION_NAMES_VALUES_GLOBAL_STATUS','1','オプション名/オプション値の追加・コピー・削除の機能についてのグローバルな設定を行います。<br />0= 機能を隠す<br />1= 機能を表示する<br />2= 商品モデル',19,110,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO `configuration` VALUES (390,'カテゴリ - タブメニュー','CATEGORIES_TABS_STATUS','1','カテゴリ - タブをオンにするとショップ画面のヘッダ部分にカテゴリが表示されます。さまざまな応用ができるでしょう。<br />0= カテゴリのタブを隠す<br />1= カテゴリのタブを表示',19,112,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO `configuration` VALUES (391,'サイトマップ - Myページの表示','SHOW_ACCOUNT_LINKS_ON_SITE_MAP','No','Myページのリンクをサイトマップに表示しますか?<br />注意：サーチエンジンのクローラーがこのページをインデックスしようとしてログインページに誘導されてしまう可能性があり、お勧めしません。<br /><br />デフォルト：false (表示しない)',19,115,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'Yes\', \'No\'), ');
INSERT INTO `configuration` VALUES (392,'1商品だけのカテゴリの表示をスキップ','SKIP_SINGLE_PRODUCT_CATEGORIES','False','商品が1つだけのカテゴリの表示をスキップしますか?<br />このオプションがTrueの場合、ユーザーが商品が1つだけのカテゴリをクリックすると、Zen Cartは直接商品ページを表示するようになります。<br />デフォルト：True',19,120,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES (393,'CSSボタン','IMAGE_USE_CSS_BUTTONS','No','CSS画像(gif/jpg)の代わりにボタンを表示しますか?<br />ONにした場合、ボタンのスタイルはスタイルシートで定義してください。',19,147,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'No\', \'Yes\'), ');
INSERT INTO `configuration` VALUES (394,'<strong>「メンテナンス中」 オン/オフ</strong>','DOWN_FOR_MAINTENANCE','false','「メンテナンス中」の表示について設定します。<br />\r\n<br />\r\n・true=on\r\n・false=off',20,1,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (395,'「メンテナンス中」- 表示するファイル','DOWN_FOR_MAINTENANCE_FILENAME','down_for_maintenance','メンテナンス中に表示するファイルのファイル名を設定します。デフォルトは\"down_for_maintenance\"です。<br /><br />\r\n【注意】拡張子は付けないでください。',20,2,NULL,'2009-11-19 12:39:39',NULL,'');
INSERT INTO `configuration` VALUES (396,'「メンテナンス中」- ヘッダを隠す','DOWN_FOR_MAINTENANCE_HEADER_OFF','false','「メンテナンス中」表示モードの際、ヘッダを隠しますか?<br /><br />\r\n・true=hide<br />\r\n・false=show',20,3,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (397,'「メンテナンス中」- 左カラムを隠す','DOWN_FOR_MAINTENANCE_COLUMN_LEFT_OFF','false','「メンテナンス中」表示モードの際、左カラムを隠しますか?<br /><br />\r\n・true=hide<br />\r\n・false=show',20,4,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (398,'「メンテナンス中」- 右カラムを隠す','DOWN_FOR_MAINTENANCE_COLUMN_RIGHT_OFF','false','「メンテナンス中」表示モードの際、右カラムを隠しますか?<br /><br />\r\n・true=hide<br />\r\n・false=show',20,5,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (399,'「メンテナンス中」- フッタを隠す','DOWN_FOR_MAINTENANCE_FOOTER_OFF','false','「メンテナンス中」表示モードの際、フッタを隠しますか?<br /><br />\r\n・true=hide<br />\r\n・false=show',20,6,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (400,'「メンテナンス中」- 価格を表示しない','DOWN_FOR_MAINTENANCE_PRICES_OFF','false','「メンテナンス中」表示モードの際、商品価格を隠しますか?<br /><br />\r\n・true=hide<br />\r\n・false=show',20,7,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (401,'「メンテナンス中」- 設定したIPアドレスを除く','EXCLUDE_ADMIN_IP_FOR_MAINTENANCE','your IP (ADMIN)','ショップ管理者用などに、「メンテナンス中」表示モードの際でもアクセス可能なIPアドレスを設定しますか?<br /><br />\r\n複数のIPアドレスを指定するにはカンマ(,)で区切ります。また、あなたのアクセス元のIPアドレスがわからない場合は、ショップのフッタに表示されるIPアドレスをチェックしてください。',20,8,'2003-03-21 13:43:22','2003-03-21 21:20:07',NULL,NULL);
INSERT INTO `configuration` VALUES (402,'「メンテナンス予告(NOTICE PUBLIC)」-  オン/オフ','WARN_BEFORE_DOWN_FOR_MAINTENANCE','false','ショップの「メンテナンス中」表示を出す前に告知を出しますか?<br /><br />\r\n・true=on<br />\r\n・false=off<br />\r\n注意：「メンテナンス中」表示が有効になると、この設定は自動的にfalseに書き換えられます。',20,9,'2003-03-21 13:08:25','2003-03-21 11:42:47',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (403,'「メンテナンス予告」- メッセージに表示する日時','PERIOD_BEFORE_DOWN_FOR_MAINTENANCE','15/05/2003  2-3 PM','ヘッダに表示するメンテナンス予告メッセージの開始日と時間を設定します。',20,10,'2003-03-21 13:08:25','2003-03-21 11:42:47',NULL,NULL);
INSERT INTO `configuration` VALUES (404,'「メンテナンス中」- メンテナンスを開始した日時(when webmaster has enabled maintenance)を表示','DISPLAY_MAINTENANCE_TIME','false','ショップ管理者がいつ「メンテナンス中」表示をオンにしたか表示しますか?<br /><br />\r\n・true=on<br />\r\n・false=off',20,11,'2003-03-21 13:08:25','2003-03-21 11:42:47',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (405,'「メンテナンス中」- メンテナンス期間を表示','DISPLAY_MAINTENANCE_PERIOD','false','メンテナンスの期間を表示しますか?<br /><br />\r\n・true=on<br />\r\n・false=off',20,12,'2003-03-21 13:08:25','2003-03-21 11:42:47',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (406,'メンテナンス期間','TEXT_MAINTENANCE_PERIOD_TIME','2h00','メンテナンス期間を設定します。<br />\r\n書式：(hh:mm)<br />h = 時間　m = 分',20,13,'2003-03-21 13:08:25','2003-03-21 11:42:47',NULL,NULL);
INSERT INTO `configuration` VALUES (407,'チェックアウト時に「ご利用規約」確認画面を表示','DISPLAY_CONDITIONS_ON_CHECKOUT','false','チェックアウトの際に「ご利用規約」の画面を表示しますか?',11,1,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (408,'アカウント作成時に個人情報保護方針確認画面を表示','DISPLAY_PRIVACY_CONDITIONS','true','アカウント作成の際、個人情報保護方針への同意画面を表示しますか?<br /><div style=\"color: red;\">注意：「個人情報保護法」では、個人情報保護方針を開示することが求められています。</div>',11,2,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (409,'商品画像を表示','PRODUCT_NEW_LIST_IMAGE','1102','商品画像を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',21,1,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (410,'商品の数量を表示','PRODUCT_NEW_LIST_QUANTITY','1202','商品数量を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',21,2,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (411,'「今すぐ買う」ボタンの表示','PRODUCT_NEW_BUY_NOW','1300','「今すぐ買う」ボタンを表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',21,3,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (412,'商品名の表示','PRODUCT_NEW_LIST_NAME','2101','商品名を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',21,4,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (413,'商品型番の表示','PRODUCT_NEW_LIST_MODEL','2201','商品型番を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',21,5,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (414,'商品メーカーの表示','PRODUCT_NEW_LIST_MANUFACTURER','2302','商品メーカーを表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',21,6,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (415,'商品価格の表示','PRODUCT_NEW_LIST_PRICE','2402','商品価格を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',21,7,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (416,'商品重量の表示','PRODUCT_NEW_LIST_WEIGHT','2502','商品の重量を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',21,8,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (417,'商品登録日の表示','PRODUCT_NEW_LIST_DATE_ADDED','2601','商品登録日を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',21,9,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (418,'商品説明の表示','PRODUCT_NEW_LIST_DESCRIPTION','1','商品説明(最初の150文字)を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1= on',21,10,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO `configuration` VALUES (419,'商品の表示 - デフォルトのソート順','PRODUCT_NEW_LIST_SORT_DEFAULT','6','新着商品リストの表示のデフォルトのソート順は? デフォルト値は6です。<br /><br />\r\n・1= 商品名<br />\r\n・2= 商品名(降順)<br />\r\n・3= 価格が安いものから商品名<br />\r\n・4= 価格が高いものから商品名<br />\r\n・5= 型番<br />\r\n・6= 商品登録日(降順)<br />\r\n・7= 商品登録日<br />\r\n・8= 商品順(Product Sort)\r\n',21,11,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'1\', \'2\', \'3\', \'4\', \'5\', \'6\', \'7\', \'8\'), ');
INSERT INTO `configuration` VALUES (420,'新着商品 - デフォルトのグループID','PRODUCT_NEW_LIST_GROUP_ID','21','新着商品リストの設定グループID(configuration_group_id)は何ですか?<br />\r\n<br />\r\n注意：全商品リストのグループIDがデフォルトの21から変更されたときだけ設定してください。',21,12,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (421,'複数商品の数量欄の有無・表示位置','PRODUCT_NEW_LISTING_MULTIPLE_ADD_TO_CART','3','複数商品の数量欄の表示の有無と表示位置について設定します。<br />0= off<br />1= 上部<br />2= 下部<br />3= 両方',21,25,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'), ');
INSERT INTO `configuration` VALUES (422,'商品画像の表示','PRODUCT_FEATURED_LIST_IMAGE','1102','商品画像を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />\r\n',22,1,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (423,'商品数量の表示','PRODUCT_FEATURED_LIST_QUANTITY','1202','商品数量を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />\r\n',22,2,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (424,'「今すぐ買う」ボタンの表示','PRODUCT_FEATURED_BUY_NOW','1300','「今すぐ買う」ボタンを表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',22,3,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (425,'商品名の表示','PRODUCT_FEATURED_LIST_NAME','2101','商品名を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',22,4,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (426,'商品型番の表示','PRODUCT_FEATURED_LIST_MODEL','2201','商品型番を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',22,5,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (427,'商品メーカーの表示','PRODUCT_FEATURED_LIST_MANUFACTURER','2302','商品メーカーを表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',22,6,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (428,'商品価格の表示','PRODUCT_FEATURED_LIST_PRICE','2402','商品価格を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',22,7,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (429,'商品重量の表示','PRODUCT_FEATURED_LIST_WEIGHT','2502','商品重量を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',22,8,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (430,'商品登録日の表示','PRODUCT_FEATURED_LIST_DATE_ADDED','2601','商品登録日を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',22,9,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (431,'商品説明の表示','PRODUCT_FEATURED_LIST_DESCRIPTION','1','商品説明(最初の150文字)を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1= on',22,10,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO `configuration` VALUES (432,'商品表示 - デフォルトのソート順','PRODUCT_FEATURED_LIST_SORT_DEFAULT','1','おすすめ商品リストの表示のデフォルトのソート順は? デフォルト値は1です。<br />\r\n<br />\r\n・1= 商品名<br />\r\n・2= 商品名(降順)<br />\r\n・3= 価格が安いものから、商品名<br />\r\n・4= 価格が高いものから、商品名<br />\r\n・5= 型番<br />\r\n・6= 商品登録日(降順)<br />\r\n・7= 商品登録日<br />\r\n・8= 商品順(Product Sort)',22,11,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'1\', \'2\', \'3\', \'4\', \'5\', \'6\', \'7\', \'8\'), ');
INSERT INTO `configuration` VALUES (433,'おすすめ商品 - デフォルトのグループID','PRODUCT_FEATURED_LIST_GROUP_ID','22','おすすめ商品リストの設定グループID(configuration_group_id)は何ですか?<br />\r\n<br />\r\n注意：おすすめ商品リストのグループIDがデフォルトの22から変更されたときだけ設定してください。\r\n',22,12,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (434,'複数商品の数量欄の有無・表示位置','PRODUCT_FEATURED_LISTING_MULTIPLE_ADD_TO_CART','3','複数商品の数量欄の表示の有無と表示位置について設定します。<br />0= off<br />1= 上部<br />2= 下部<br />3= 両方',22,25,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'), ');
INSERT INTO `configuration` VALUES (435,'商品画像の表示','PRODUCT_ALL_LIST_IMAGE','1102','商品画像を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',23,1,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (436,'商品数量の表示','PRODUCT_ALL_LIST_QUANTITY','1202','商品数量を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',23,2,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (437,'「今すぐ買う」ボタンの表示','PRODUCT_ALL_BUY_NOW','1300','「今すぐ買う」ボタンを表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',23,3,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (438,'商品価格の表示','PRODUCT_ALL_LIST_NAME','2101','商品価格を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',23,4,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (439,'商品型番の表示','PRODUCT_ALL_LIST_MODEL','2201','商品型番を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',23,5,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (440,'商品メーカーの表示','PRODUCT_ALL_LIST_MANUFACTURER','2302','商品メーカーを表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',23,6,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (441,'商品価格の表示','PRODUCT_ALL_LIST_PRICE','2402','商品価格を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',23,7,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (442,'商品重量の表示','PRODUCT_ALL_LIST_WEIGHT','2502','商品重量を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',23,8,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (443,'商品登録日の表示','PRODUCT_ALL_LIST_DATE_ADDED','2601','商品登録日を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',23,9,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (444,'商品説明の表示','PRODUCT_ALL_LIST_DESCRIPTION','1','商品説明(最初の150文字)を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1= on',23,10,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO `configuration` VALUES (445,'商品表示 - デフォルトのソート順','PRODUCT_ALL_LIST_SORT_DEFAULT','1','全商品リストの表示のデフォルトのソート順は? デフォルト値は1です。<br />\r\n<br />\r\n・1= 商品名<br />\r\n・2= 商品名(降順)<br />\r\n・3= 価格が安いものから、商品名<br />\r\n・4= 価格が高いものから、商品名<br />\r\n・5= 型番<br />\r\n・6= 商品登録日(降順)<br />\r\n・7= 商品登録日<br />\r\n・8= 商品順(Product Sort)',23,11,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'1\', \'2\', \'3\', \'4\', \'5\', \'6\', \'7\', \'8\'), ');
INSERT INTO `configuration` VALUES (446,'全商品リスト - デフォルトのグループID','PRODUCT_ALL_LIST_GROUP_ID','23','全商品リストの設定グループID(configuration_group_id)は?<br />\r\n<br />\r\n注意：全商品リストのグループIDがデフォルトの23から変更されたときだけ設定してください。\r\n',23,12,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO `configuration` VALUES (447,'複数商品の数量欄の有無・表示位置','PRODUCT_ALL_LISTING_MULTIPLE_ADD_TO_CART','3','複数商品の数量欄の表示の有無と表示位置について設定します。<br />0= off<br />1= 上部<br />2= 下部<br />3= 両方',23,25,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'), ');
INSERT INTO `configuration` VALUES (448,'新着商品をトップページに表示する','SHOW_PRODUCT_INFO_MAIN_NEW_PRODUCTS','1','新着商品をトップページに表示 しますか?\r\n<br />\r\n0= off<br />\r\nまたは表示順を数値(104)で設定してください。\r\n',24,65,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ');
INSERT INTO `configuration` VALUES (449,'おすすめ商品をトップページに表示する','SHOW_PRODUCT_INFO_MAIN_FEATURED_PRODUCTS','2','おすすめ商品をトップページに表示 しますか?\r\n<br />\r\n0= off<br />\r\nまたは表示順を数値(104)で設定してください。\r\n',24,66,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ');
INSERT INTO `configuration` VALUES (450,'特価商品をトップページに表示する','SHOW_PRODUCT_INFO_MAIN_SPECIALS_PRODUCTS','3','特価商品をトップページに表示 しますか?\r\n<br />\r\n0= off<br />\r\nまたは表示順を数値(104)で設定してください。\r\n',24,67,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ');
INSERT INTO `configuration` VALUES (451,'入荷予定商品をトップページに表示する','SHOW_PRODUCT_INFO_MAIN_UPCOMING','4','入荷予定商品をトップページに表示 しますか?\r\n<br />\r\n0= off<br />\r\nまたは表示順を数値(104)で設定してください。\r\n',24,68,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ');
INSERT INTO `configuration` VALUES (452,'新着商品をトップページに表示する - カテゴリ・サブカテゴリ共に\r\n','SHOW_PRODUCT_INFO_CATEGORY_NEW_PRODUCTS','1','新着商品を(トップレベル)カテゴリ・サブカテゴリ共にトップページに表示 しますか?\r\n<br />\r\n0= off<br />\r\nまたは表示順を数値(104)で設定してください。\r\n',24,70,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ');
INSERT INTO `configuration` VALUES (453,'おすすめ商品をトップページに表示する - カテゴリ・サブカテゴリ共に','SHOW_PRODUCT_INFO_CATEGORY_FEATURED_PRODUCTS','2','おすすめ商品を(トップレベル)カテゴリ・サブカテゴリ共にトップページに表示 しますか?\r\n<br />\r\n0= off<br />\r\nまたは表示順を数値(104)で設定してください。\r\n',24,71,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ');
INSERT INTO `configuration` VALUES (454,'特価商品をトップページに表示する - カテゴリ・サブカテゴリ共に','SHOW_PRODUCT_INFO_CATEGORY_SPECIALS_PRODUCTS','3','特価商品を(トップレベル)カテゴリ・サブカテゴリ共にトップページに表示 しますか?\r\n<br />\r\n0= off<br />\r\nまたは表示順を数値(104)で設定してください。\r\n',24,72,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ');
INSERT INTO `configuration` VALUES (455,'入荷予定商品をトップページに表示する - カテゴリ・サブカテゴリ共に','SHOW_PRODUCT_INFO_CATEGORY_UPCOMING','4','入荷予定商品を(トップレベル)カテゴリ・サブカテゴリ共にトップページに表示 しますか?\r\n<br />\r\n0= off<br />\r\nまたは表示順を数値(104)で設定してください。\r\n',24,73,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ');
INSERT INTO `configuration` VALUES (456,'新着商品をトップページに表示する - エラーとリンク切れ商品ページ','SHOW_PRODUCT_INFO_MISSING_NEW_PRODUCTS','1','新着予定商品をトップページに表示 しますか?\r\n(エラーとリンク切れ商品ページ・/* 訳注・意味不明 */)<br />\r\n0= off<br />\r\nまたは順番を数値(104)で設定してください。',24,75,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ');
INSERT INTO `configuration` VALUES (457,'おすすめ商品をトップページに表示する - エラーとリンク切れ商品ページ','SHOW_PRODUCT_INFO_MISSING_FEATURED_PRODUCTS','2','おすすめ商品をトップページに表示 しますか?\r\n(エラーとリンク切れ商品ページ・/* 訳注・意味不明 */)<br />\r\n0= off<br />\r\nまたは順番を数値(104)で設定してください。',24,76,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ');
INSERT INTO `configuration` VALUES (458,'特価商品をトップページに表示する - エラーとリンク切れ商品ページ','SHOW_PRODUCT_INFO_MISSING_SPECIALS_PRODUCTS','3','特価商品をトップページに表示 しますか?\r\n(エラーとリンク切れ商品ページ・/* 訳注・意味不明 */)<br />\r\n0= off<br />\r\nまたは順番を数値(104)で設定してください。',24,77,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ');
INSERT INTO `configuration` VALUES (459,'入荷予定商品をトップページに表示する - エラーとリンク切れ商品ページ','SHOW_PRODUCT_INFO_MISSING_UPCOMING','4','入荷予定商品をトップページに表示 しますか?\r\n(エラーとリンク切れ商品ページ・/* 訳注・意味不明 */)<br />\r\n0= off<br />\r\nまたは順番を数値(104)で設定してください。',24,78,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ');
INSERT INTO `configuration` VALUES (460,'新着商品を表示する - 商品リストの下部に','SHOW_PRODUCT_INFO_LISTING_BELOW_NEW_PRODUCTS','1','商品リストの下に新着商品を表示しますか?\r\n<br />0= off <br />\r\nまたは配置順を数値(104)で設定してください。',24,85,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ');
INSERT INTO `configuration` VALUES (461,'おすすめ商品を表示する - 商品リストの下部に','SHOW_PRODUCT_INFO_LISTING_BELOW_FEATURED_PRODUCTS','2','商品リストの下におすすめ商品を表示しますか?\r\n<br />0= off <br />\r\nまたは配置順を数値(104)で設定してください。',24,86,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ');
INSERT INTO `configuration` VALUES (462,'特価商品を表示する - 商品リストの下部に','SHOW_PRODUCT_INFO_LISTING_BELOW_SPECIALS_PRODUCTS','3','商品リストの下に特価商品を表示しますか?\r\n<br />0= off <br />\r\nまたは配置順を数値(104)で設定してください。',24,87,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ');
INSERT INTO `configuration` VALUES (463,'入荷予定商品を表示する - 商品リストの下部に','SHOW_PRODUCT_INFO_LISTING_BELOW_UPCOMING','4','商品リストの下に入荷予定商品を表示しますか?\r\n<br />0= off <br />\r\nまたは配置順を数値(104)で設定してください。',24,88,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ');
INSERT INTO `configuration` VALUES (464,'新着商品 - 横列あたりの表示点数','SHOW_PRODUCT_INFO_COLUMNS_NEW_PRODUCTS','3','新着商品の列(Row)あたりの配置点数を設定します。',24,95,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'1\', \'2\', \'3\', \'4\', \'5\', \'6\', \'7\', \'8\', \'9\', \'10\', \'11\', \'12\'), ');
INSERT INTO `configuration` VALUES (465,'おすすめ商品 - 横列あたりの表示点数','SHOW_PRODUCT_INFO_COLUMNS_FEATURED_PRODUCTS','3','おすすめ商品の列(Row)あたりの配置点数を設定します。',24,96,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'1\', \'2\', \'3\', \'4\', \'5\', \'6\', \'7\', \'8\', \'9\', \'10\', \'11\', \'12\'), ');
INSERT INTO `configuration` VALUES (466,'特価商品 - 横列あたりの表示点数','SHOW_PRODUCT_INFO_COLUMNS_SPECIALS_PRODUCTS','3','特価商品の列(Row)あたりの配置点数を設定します。',24,97,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'1\', \'2\', \'3\', \'4\', \'5\', \'6\', \'7\', \'8\', \'9\', \'10\', \'11\', \'12\'), ');
INSERT INTO `configuration` VALUES (467,'トップレベル(親)カテゴリの商品リスト表示 - フィルタ表示・全商品表示','SHOW_PRODUCT_INFO_ALL_PRODUCTS','1','現在のメインカテゴリに商品リストが適用された際、商品をフィルタ表示しますか? それとも全カテゴリから商品を表示しますか?<br />\r\n・0= Filter\r\n・Off 1=Filter On',24,100,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO `configuration` VALUES (468,'トップページの定義領域 - ステータス','DEFINE_MAIN_PAGE_STATUS','1','編集された領域の表示を行いますか?<br />0= リンク:表示　　編集領域:非表示<br />1= リンク:表示　　編集領域:表示<br />2= リンク:非表示　編集領域:表示<br />3= リンク:非表示　編集領域:非表示',25,60,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
INSERT INTO `configuration` VALUES (469,'「お問い合わせ」ページの表示 - ステータス','DEFINE_CONTACT_US_STATUS','1','編集された「お問い合わせ」テキストを表示しますか?<br />0= リンク:表示　　編集領域:非表示<br />1= リンク:表示　　編集領域:表示<br />2= リンク:非表示　編集領域:表示<br />3= リンク:非表示　編集領域:非表示',25,61,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
INSERT INTO `configuration` VALUES (470,'「個人情報保護方針」表示 - ステータス','DEFINE_PRIVACY_STATUS','1','編集された「個人情報保護方針」を表示しますか?<br />0= リンク:表示　　編集領域:非表示<br />1= リンク:表示　　編集領域:表示<br />2= リンク:非表示　編集領域:表示<br />3= リンク:非表示　編集領域:非表示',25,62,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
INSERT INTO `configuration` VALUES (471,'「配送・送料について」 ページ - ステータス','DEFINE_SHIPPINGINFO_STATUS','1','編集された「配送・送料について」テキストを表示しますか?<br />0= リンク:表示　　編集領域:非表示<br />1= リンク:表示　　編集領域:表示<br />2= リンク:非表示　編集領域:表示<br />3= リンク:非表示　編集領域:非表示',25,63,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
INSERT INTO `configuration` VALUES (472,'「ご利用規約」ページ - ステータス','DEFINE_CONDITIONS_STATUS','1','編集された「ご利用規約」ページを表示しますか?<br />0= リンク:表示　　編集領域:非表示<br />1= リンク:表示　　編集領域:表示<br />2= リンク:非表示　編集領域:表示<br />3= リンク:非表示　編集領域:非表示',25,64,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
INSERT INTO `configuration` VALUES (473,'「ご注文が完了しました」ページ - ステータス','DEFINE_CHECKOUT_SUCCESS_STATUS','1','編集された「ご注文が完了しました」テキストを表示しますか?<br />0= リンク:表示　　編集領域:非表示<br />1= リンク:表示　　編集領域:表示<br />2= リンク:非表示　編集領域:表示<br />3= リンク:非表示　編集領域:非表示',25,65,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
INSERT INTO `configuration` VALUES (474,'「クーポン券」ページ - ステータス','DEFINE_DISCOUNT_COUPON_STATUS','1','編集された「クーポン券」テキストを表示しますか?<br />0= リンク:表示　　編集領域:非表示<br />1= リンク:表示　　編集領域:表示<br />2= リンク:非表示　編集領域:表示<br />3= リンク:非表示　編集領域:非表示',25,66,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
INSERT INTO `configuration` VALUES (475,'「サイトマップ」ページ - ステータス','DEFINE_SITE_MAP_STATUS','1','編集された「クーポン券」テキストを表示しますか?<br />0= リンク:表示　　編集領域:非表示<br />1= リンク:表示　　編集領域:表示<br />2= リンク:非表示　編集領域:表示<br />3= リンク:非表示　編集領域:非表示',25,67,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
INSERT INTO `configuration` VALUES (476,'自由編集ページ(Define Page) 2','DEFINE_PAGE_2_STATUS','1','自由編集ページ2を表示しますか?<br />0= リンク:表示　　編集領域:非表示<br />1= リンク:表示　　編集領域:表示<br />2= リンク:非表示　編集領域:表示<br />3= リンク:非表示　編集領域:非表示',25,82,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
INSERT INTO `configuration` VALUES (477,'自由編集ページ(Define Page) 3','DEFINE_PAGE_3_STATUS','1','自由編集ページ3 を表示しますか?<br />0= リンク:表示　　編集領域:非表示<br />1= リンク:表示　　編集領域:表示<br />2= リンク:非表示　編集領域:表示<br />3= リンク:非表示　編集領域:非表示',25,83,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
INSERT INTO `configuration` VALUES (478,'自由編集ページ(Define Page) 4','DEFINE_PAGE_4_STATUS','1','自由編集ページ(Define Page) 4を表示しますか?<br />0= リンク:表示　　編集領域:非表示<br />1= リンク:表示　　編集領域:表示<br />2= リンク:非表示　編集領域:表示<br />3= リンク:非表示　編集領域:非表示',25,84,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
INSERT INTO `configuration` VALUES (479,'EZページの表示 - ページヘッダ','EZPAGES_STATUS_HEADER','1','EZページのコンテンツをページヘッダに表示するかどうかをグローバル(サイト全体)に設定します。<br />0 = Off<br />1 = On<br />2= サイトメンテナンスの際に管理者のIPアドレスでアクセスした場合のみ表示<br />注意：ワーニングは公開されず管理者にだけ表示されます。',30,10,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), ');
INSERT INTO `configuration` VALUES (480,'EZページの表示 - ページフッタ','EZPAGES_STATUS_FOOTER','1','EZページのコンテンツをページフッタに表示するかどうかをグローバル(サイト全体)に設定します。<br />0 = Off<br />1 = On<br />2= サイトメンテナンスの際に管理者のIPアドレスでアクセスした場合のみ表示<br />注意：ワーニングは公開されず管理者にだけ表示されます。',30,11,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), ');
INSERT INTO `configuration` VALUES (481,'EZページの表示 - サイドボックス','EZPAGES_STATUS_SIDEBOX','1','EZページのコンテンツをサイドボックスに表示するかどうかをグローバル(サイト全体)に設定します。<br />0 = Off<br />1 = On<br />2= サイトメンテナンスの際に管理者のIPアドレスでアクセスした場合のみ表示<br />注意：ワーニングは公開されず管理者にだけ表示されます。',30,12,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), ');
INSERT INTO `configuration` VALUES (482,'EZページ のヘッダ - リンクのセパレータ(区切り記号)','EZPAGES_SEPARATOR_HEADER','','EＺページのヘッダのリンク表示のセパレータ(区切り文字)は?<br />デフォルト = &amp;nbsp;::&amp;nbsp;',30,20,'2009-11-19 13:10:25','2009-11-19 12:39:39',NULL,'zen_cfg_textarea_small(');
INSERT INTO `configuration` VALUES (483,'EZページ のフッタ - リンクのセパレータ(区切り記号)','EZPAGES_SEPARATOR_FOOTER','&nbsp;::&nbsp;','EＺページのフッタのリンク表示のセパレータ(区切り文字)は?<br />デフォルト = &amp;nbsp;::&amp;nbsp;',30,21,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_textarea_small(');
INSERT INTO `configuration` VALUES (484,'EZページ - [次へ][前へ]ボタン','EZPAGES_SHOW_PREV_NEXT_BUTTONS','2','EZページのコンテンツ内[前へ][続ける][次へ]ボタンを表示しますか?<br />0=OFF (ボタンなし)<br />1=「続ける」を表示<br />2=「前へ」「続ける」「次へ」を表示<br /><br />デフォルト：2',30,30,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), ');
INSERT INTO `configuration` VALUES (485,'EZページ - 目次の表示','EZPAGES_SHOW_TABLE_CONTENTS','1','EZページの目次を表示しますか?<br />0= OFF<br />1= ON',30,35,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'),');
INSERT INTO `configuration` VALUES (486,'EZ-ページ - ヘッダで表示しないページ','EZPAGES_DISABLE_HEADER_DISPLAY_LIST','','EZページのうち通常のページヘッダに表示しないページは?<br />表示しないページのページIDをカンマ(,)区切りで記述してください。ページIDは管理画面の[追加設定・ツール]のEZページ設定画面で確認できます。<br />例：1,5,2<br />ない場合は空欄のまま',30,40,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_textarea_small(');
INSERT INTO `configuration` VALUES (487,'EZ-ページ - フッタで表示しないページ','EZPAGES_DISABLE_FOOTER_DISPLAY_LIST','','EZページのうち通常のページフッタに表示しないページは?<br />表示しないページのページIDをカンマ(,)区切りで記述してください。ページIDは管理画面の[追加設定・ツール]のEZページ設定画面で確認できます。<br />例：3,7<br />ない場合は空欄のまま',30,41,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_textarea_small(');
INSERT INTO `configuration` VALUES (488,'EZ-ページ - 左カラムで表示しないページ','EZPAGES_DISABLE_LEFTCOLUMN_DISPLAY_LIST','','EZページのうち通常の左カラムに表示しないページは?<br />表示しないページのページIDをカンマ(,)区切りで記述してください。ページIDは管理画面の[追加設定・ツール]のEZページ設定画面で確認できます。<br />例：6,17<br />ない場合は空欄のまま',30,42,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_textarea_small(');
INSERT INTO `configuration` VALUES (489,'EZ-ページ - 右カラムで表示しないページ','EZPAGES_DISABLE_RIGHTCOLUMN_DISPLAY_LIST','','EZページのうち通常の右カラムに表示しないページは?<br />表示しないページのページIDをカンマ(,)区切りで記述してください。ページIDは管理画面の[追加設定・ツール]のEZページ設定画面で確認できます。<br />例：5,23,47<br />ない場合は空欄のまま',30,43,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_textarea_small(');
INSERT INTO `configuration` VALUES (490,'お問い合わせ時の個人情報確認画面表示','DISPLAY_CONTACT_US_PRIVACY_CONDITIONS','true','お問い合わせする画面で個人情報の確認画面を表示します。<div style=\"color: red;\">2005年4月1日に施行された「個人情報保護法」では、個人情報保護方針を開示することが求められています。</div>',11,3,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (491,'ふりがなが必要な国','FURIKANA_NECESSARY_COUNTRIES','Japanese','ふりがなが必要な国名をカンマで区切って入力してください',5,100,NULL,'2009-11-19 12:39:40',NULL,'');
INSERT INTO `configuration` VALUES (492,'Product Listing - Layout Style','PRODUCT_LISTING_LAYOUT_STYLE','rows','Select the layout style:<br />Each product can be listed in its own row (rows option) or products can be listed in multiple columns per row (columns option)',8,40,'2010-05-28 11:45:17','2009-11-19 12:39:41',NULL,'zen_cfg_select_option(array(\"rows\", \"columns\"),');
INSERT INTO `configuration` VALUES (493,'Product Listing - Columns Per Row','PRODUCT_LISTING_COLUMNS_PER_ROW','3','Select the number of columns of products to show in each row in the product listing. The default setting is 3.',8,41,NULL,'2009-11-19 12:39:41',NULL,NULL);
INSERT INTO `configuration` VALUES (494,'Display Cross-Sell Products','MIN_DISPLAY_XSELL','1','This is the minimum number of configured Cross-Sell products required in order to cause the Cross Sell information to be displayed.<br />Default: 1',2,17,NULL,'2009-11-19 12:39:41',NULL,NULL);
INSERT INTO `configuration` VALUES (495,'Display Cross-Sell Products','MAX_DISPLAY_XSELL','6','This is the maximum number of configured Cross-Sell products to be displayed.<br />Default: 6',3,66,NULL,'2009-11-19 12:39:41',NULL,NULL);
INSERT INTO `configuration` VALUES (496,'Cross-Sell Products Columns per Row','SHOW_PRODUCT_INFO_COLUMNS_XSELL_PRODUCTS','3','Cross-Sell Products Columns to display per Row<br />0= off or set the sort order.<br />Default: 3',18,72,NULL,'2009-11-19 12:39:41',NULL,'zen_cfg_select_option(array(0, 1, 2, 3, 4), ');
INSERT INTO `configuration` VALUES (497,'Cross-Sell - Display prices?','XSELL_DISPLAY_PRICE','false','Cross-Sell -- Do you want to display the product prices too?<br />Default: false',18,72,NULL,'2009-11-19 12:39:41',NULL,'zen_cfg_select_option(array(\'true\',\'false\'), ');
INSERT INTO `configuration` VALUES (498,'無料配送','MODULE_SHIPPING_FREESHIPPER_STATUS','True','無料配送を提供しますか？',6,0,NULL,'2009-11-19 12:41:06',NULL,'zen_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES (499,'無料配送コスト','MODULE_SHIPPING_FREESHIPPER_COST','0','無料配送にかかるコスト',6,6,NULL,'2009-11-19 12:41:06',NULL,NULL);
INSERT INTO `configuration` VALUES (500,'手数料','MODULE_SHIPPING_FREESHIPPER_HANDLING','0','無料配送にかかる手数料.',6,0,NULL,'2009-11-19 12:41:06',NULL,NULL);
INSERT INTO `configuration` VALUES (501,'税種別','MODULE_SHIPPING_FREESHIPPER_TAX_CLASS','0','定額料金に適用される税種別を選択してください。',6,0,NULL,'2009-11-19 12:41:06','zen_get_tax_class_title','zen_cfg_pull_down_tax_classes(');
INSERT INTO `configuration` VALUES (502,'配送地域','MODULE_SHIPPING_FREESHIPPER_ZONE','0','配送地域を選択すると選択された地域のみで利用可能になります。.',6,0,NULL,'2009-11-19 12:41:06','zen_get_zone_class_title','zen_cfg_pull_down_zone_classes(');
INSERT INTO `configuration` VALUES (503,'表示の整列順','MODULE_SHIPPING_FREESHIPPER_SORT_ORDER','0','表示の整列順を設定できます。数字が小さいほど上位に表示されます。',6,0,NULL,'2009-11-19 12:41:06',NULL,NULL);
INSERT INTO `configuration` VALUES (504,'佐川急便の配送を有効にする','MODULE_SHIPPING_YAMATO_STATUS','True','ヤマト運輸(宅急便)の配送を提供しますか?',6,0,NULL,'2009-11-19 12:41:06',NULL,'zen_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES (505,'取扱い手数料','MODULE_SHIPPING_YAMATO_HANDLING','0','送料に適用する取扱手数料を設定できます.',6,1,NULL,'2009-11-19 12:41:06',NULL,NULL);
INSERT INTO `configuration` VALUES (506,'送料無料設定','MODULE_SHIPPING_YAMATO_FREE_SHIPPING','False','送料無料設定を有効にしますか? [合計モジュール]-[送料]-[送料無料設定]を優先する場合は False を選んでください.',6,2,NULL,'2009-11-19 12:41:06',NULL,'zen_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES (507,'送料を無料にする購入金額設定','MODULE_SHIPPING_YAMATO_OVER','5000','設定金額以上をご購入の場合は送料を無料にします.',6,3,NULL,'2009-11-19 12:41:06',NULL,NULL);
INSERT INTO `configuration` VALUES (508,'送料の値引率','MODULE_SHIPPING_YAMATO_DISCOUNT','0','送料の値引率を指定します.(％)',6,4,NULL,'2009-11-19 12:41:06',NULL,NULL);
INSERT INTO `configuration` VALUES (509,'配送地域','MODULE_SHIPPING_YAMATO_ZONE','0','配送地域を選択すると選択された地域のみで利用可能となります.',6,5,NULL,'2009-11-19 12:41:06','zen_get_zone_class_title','zen_cfg_pull_down_zone_classes(');
INSERT INTO `configuration` VALUES (510,'表示の整列順','MODULE_SHIPPING_YAMATO_SORT_ORDER','0','表示の整列順を設定できます. 数字が小さいほど上位に表示されます.',6,6,NULL,'2009-11-19 12:41:06',NULL,NULL);
INSERT INTO `configuration` VALUES (511,'Installed Modules','ADDON_MODULE_INSTALLED','aboutbox;addon_modules;feature_area;carousel_ui;am_ajax_address;ajax_category_tree;blog;calendar;category_sitemap;checkout_step;easy_admin;easy_admin_simplify;easy_design;easy_reviews;email_templates;globalnavi;jquery;multiple_image_view;point_base;point_createaccount;point_customersrate;point_grouprate;point_productsrate;product_csv;products_with_attributes_stock;search_more;shopping_cart_summary;sitemapXML','This is automatically updated. No need to edit.',6,0,'2010-06-27 05:17:44','2009-11-19 12:42:23',NULL,NULL);
INSERT INTO `configuration` VALUES (512,'コアモジュールの有効化','MODULE_ADDON_MODULES_STATUS','true','無効にすることは出来ません。',6,0,NULL,'2009-11-19 12:42:37',NULL,'zen_cfg_select_option(array(\'true\'), ');
INSERT INTO `configuration` VALUES (513,'配布元URLリスト','MODULE_ADDON_MODULES_DISTRIBUTION_URL','http://zen-cart.ark-web.jp/shida/zencart-sugu/','addonモジュールパッケージを取得するサイトのURLを指定してください。<br/>複数指定する場合は改行して入力してください。',6,1,NULL,'2009-11-19 12:42:37',NULL,'zen_cfg_textarea_small(');
INSERT INTO `configuration` VALUES (514,'優先順','MODULE_ADDON_MODULES_SORT_ORDER','0','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,2,NULL,'2009-11-19 12:42:37',NULL,NULL);
INSERT INTO `configuration` VALUES (515,'パケット料金節約の設定','MOBILE_SLIM_SIZE','1','パケット料金の節約に関する設定をします<BR />この設定はHTML中の改行やスペースを取り除きファイルサイズを小さくします。この設定でパケット料金を節約する事が出来ます<br />0=OFF<br />1=ON<br />',100,2,NULL,'0001-01-01 00:00:00',NULL,'zen_cfg_select_option(array(\'0\', \'1\'),');
INSERT INTO `configuration` VALUES (516,'携帯サイトテーマカラーの設定','MOBILE_THEME_COLOR','#CA6312','サイトのテーマカラーを「#666666」などHTMLカラーコードで設定します。このテーマカラーは、見出しの帯の背景色などで使用されます',100,3,NULL,'0001-01-01 00:00:00',NULL,NULL);
INSERT INTO `configuration` VALUES (517,'CSSの設定','MOBILE_CSS_CONF','0','ここではHTML中の[class]と[id]の有無を設定します<br />デフォルトではファイルサイズ縮小目的の為に0が設定されています<br />CSSを使用する場合は1を設定して下さい<BR /><br />0=CSSを使用しない<br />1=CSSを使用する<br />',100,4,NULL,'0001-01-01 00:00:00',NULL,'zen_cfg_select_option(array(\'0\', \'1\'),');
INSERT INTO `configuration` VALUES (518,'アバウトボックスブロックの有効化','MODULE_ABOUTBOX_STATUS','true','アバウトボックスを有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 12:50:52',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (519,'優先順','MODULE_ABOUTBOX_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,1,NULL,'2009-11-19 12:50:52',NULL,NULL);
INSERT INTO `configuration` VALUES (520,'アバウトボックスのタイトル','MODULE_ABOUTBOX_CFG_HEADER','','アバウトボックスブロックに表示するタイトルを指定します。',6,2,NULL,'2009-11-19 12:50:52',NULL,NULL);
INSERT INTO `configuration` VALUES (521,'アバウトボックス説明文のタイトル','MODULE_ABOUTBOX_CFG_GREETING_TITLE','店長からの挨拶','アバウトボックスに表示する説明文のタイトルを指定します。',6,3,NULL,'2009-11-19 12:50:52',NULL,NULL);
INSERT INTO `configuration` VALUES (522,'アバウトボックス説明文の本文','MODULE_ABOUTBOX_CFG_GREETING_TEXT','すぐでき（る）パックのデモショップです。\r\nテンプレートの実装をがんばろー！','アバウトボックスに表示する説明文の本文を指定します。',6,4,NULL,'2009-11-19 12:50:52',NULL,'zen_cfg_textarea_small(');
INSERT INTO `configuration` VALUES (523,'アバウトボックスに表示する画像','MODULE_ABOUTBOX_CFG_IMAGEPATH','images/my.jpg','アバウトボックスに表示する画像のパスを指定します。',6,5,NULL,'2009-11-19 12:50:52',NULL,NULL);
INSERT INTO `configuration` VALUES (524,'カレンダー表示','MODULE_ABOUTBOX_DISPLAY_CALENDAR','true','営業カレンダーを表示するかどうか指定します。営業カレンダーモジュールがインストールされていないとtrueにしても表示されません。<br />true: 表示<br />false: 非表示',6,6,NULL,'2009-11-19 12:50:52',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (525,'対応クレジットカード表示','MODULE_ABOUTBOX_AVALABLE_CARDS','2','対応クレジットカードを表示するかどうか指定します<br />0: 非表示<br />1: テキスト表示<br />2: 画像表示',6,7,NULL,'2009-11-19 12:50:52',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), ');
INSERT INTO `configuration` VALUES (526,'jQueryの有効化','MODULE_JQUERY_STATUS','true','jQueryを有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 12:51:33',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (527,'jQueryライブラリ','MODULE_JQUERY_LIBRARY','jquery.js','jQueryライブラリのファイル名を設定します。特に理由がない限り変更する必要はありません。<br />・初期値 = jquery.js',6,1,NULL,'2009-11-19 12:51:33',NULL,NULL);
INSERT INTO `configuration` VALUES (528,'noConflictの有効化','MODULE_JQUERY_NOCONFLICT_STATUS','false','noConflictを有効にしますか？ <br />true: 有効<br />false: 無効',6,2,NULL,'2009-11-19 12:51:33',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (529,'優先順','MODULE_JQUERY_SORT_ORDER','1','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,3,NULL,'2009-11-19 12:51:33',NULL,NULL);
INSERT INTO `configuration` VALUES (530,'商品カテゴリの有効化','MODULE_ADDON_MODULES_AJAXCATEGORYTREE_STATUS','true','商品カテゴリ表示を有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 12:51:55',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (531,'優先順','MODULE_ADDON_MODULES_AJAXCATEGORYTREE_SORT_ORDER','1000','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,1,NULL,'2009-11-19 12:51:55',NULL,NULL);
INSERT INTO `configuration` VALUES (532,'ブログの有効化','MODULE_BLOG_STATUS','true','ブログを有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 12:52:36',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (533,'ブログURL','MODULE_BLOG_URL','','取得対象のURLを http:// から入力してください(https未対応)',6,1,NULL,'2009-11-19 12:52:36',NULL,NULL);
INSERT INTO `configuration` VALUES (534,'タイムアウト','MODULE_BLOG_TIMEOUT','1','取得リミット時間を設定します、ここで指定した時間以上に取得に時間がかかった場合は取得を中止します',6,2,NULL,'2009-11-19 12:52:36',NULL,NULL);
INSERT INTO `configuration` VALUES (535,'表示件数','MODULE_BLOG_COUNT','10','最大表示件数を設定します、0の場合はすべてとなります',6,3,NULL,'2009-11-19 12:52:36',NULL,NULL);
INSERT INTO `configuration` VALUES (536,'優先順','MODULE_BLOG_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,4,NULL,'2009-11-19 12:52:36',NULL,NULL);
INSERT INTO `configuration` VALUES (537,'営業カレンダーの有効化','MODULE_CALENDAR_STATUS','true','営業カレンダーを有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 12:53:04',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (538,'週の開始が日曜日','MODULE_CALENDAR_START_SUNDAY','true','週の開始を日曜日としますか？ <br />true: 日曜<br />false: 月曜',6,1,NULL,'2009-11-19 12:53:04',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (539,'最短配送可能日: 注文日の翌日からの営業日','MODULE_CALENDAR_DELIVERY_START','3','配送日として指定できる範囲を日数として指定します',6,2,NULL,'2009-11-19 12:53:04',NULL,NULL);
INSERT INTO `configuration` VALUES (540,'最終配送可能日: 最短配送可能日から日間','MODULE_CALENDAR_DELIVERY_END','14','配送日として指定できる範囲を日数として指定します',6,3,NULL,'2009-11-19 12:53:04',NULL,NULL);
INSERT INTO `configuration` VALUES (541,'配送時刻の選択項目','MODULE_CALENDAR_HOPE_DELIVERY_TIME','指定しない,午前中,12時015時,15時018時,18時021時','配送時刻の選択項目をカンマ区切りで入力してください',6,4,NULL,'2009-11-19 12:53:04',NULL,NULL);
INSERT INTO `configuration` VALUES (542,'優先順','MODULE_CALENDAR_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,5,NULL,'2009-11-19 12:53:04',NULL,NULL);
INSERT INTO `configuration` VALUES (543,'カルーセルUIの有効化','MODULE_CAROUSEL_UI_STATUS','true','カルーセルUIを有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 12:53:57',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (544,'jCarouselLiteライブラリ','MODULE_CAROUSEL_UI_JCAROUSELLITE_LIBRARY','jcarousellite.js','jCarouselLiteライブラリのファイル名を設定します。特に理由がない限り変更する必要はありません。<br />・初期値 = jcarousellite.js',6,1,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO `configuration` VALUES (545,'優先順','MODULE_CAROUSEL_UI_SORT_ORDER','11','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。<br />※jQueryモジュールよりも大きな数字を設定してください。',6,2,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO `configuration` VALUES (546,'新着商品 - 最大表示件数','MODULE_CAROUSEL_UI_MAX_DISPLAY_NEW_PRODUCTS','4','新着商品の最大表示件数を設定します。<br />・初期値 = 4',6,3,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO `configuration` VALUES (547,'新着商品 - 自動スクロール','MODULE_CAROUSEL_UI_CONF_AUTO_NEW_PRODUCTS','0','新着商品を自動的にスクロールする場合の間隔(ミリ秒)を設定します。<br />0ミリ秒の場合は自動スクロールしません。<br />・初期値 = 0',6,4,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO `configuration` VALUES (548,'新着商品 - スクロール速度','MODULE_CAROUSEL_UI_CONF_SPEED_NEW_PRODUCTS','200','新着商品をスクロールする速度(ミリ秒)を設定します。<br />設定値を大きくするとゆっくりスクロールします。0に設定するとスクロールしなくなります。<br />・初期値 = 200',6,5,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO `configuration` VALUES (549,'新着商品 - 縦スクロール','MODULE_CAROUSEL_UI_CONF_VERTICAL_NEW_PRODUCTS','false','新着商品を縦にスクロールしますか？<br />true: 縦スクロール<br />false: 横スクロール<br />・初期値 = false',6,6,NULL,'2009-11-19 12:53:57',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (550,'新着商品 - 循環スクロール','MODULE_CAROUSEL_UI_CONF_CIRCULAR_NEW_PRODUCTS','true','新着商品を循環的にスクロールしますか？<br />true: 循環スクロール<br />false: 往復スクロール<br />・初期値 = true',6,7,NULL,'2009-11-19 12:53:57',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (551,'新着商品 - スクロールエリア表示件数','MODULE_CAROUSEL_UI_CONF_VISIBLE_NEW_PRODUCTS','3','新着商品のスクロールエリアに表示する件数を設定します。<br />・初期値 = 3',6,8,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO `configuration` VALUES (552,'新着商品 - スクロール件数','MODULE_CAROUSEL_UI_CONF_SCROLL_NEW_PRODUCTS','1','新着商品の一度にスクロールさせる件数を設定します。<br />・初期値 = 1',6,9,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO `configuration` VALUES (553,'おすすめ商品 - 最大表示件数','MODULE_CAROUSEL_UI_MAX_DISPLAY_FEATURED_PRODUCTS','4','おすすめ商品の最大表示件数を設定します。<br />・初期値 = 4',6,10,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO `configuration` VALUES (554,'おすすめ商品 - 自動スクロール','MODULE_CAROUSEL_UI_CONF_AUTO_FEATURED_PRODUCTS','0','おすすめ商品を自動的にスクロールする場合の間隔(ミリ秒)を設定します。<br />0ミリ秒の場合は自動スクロールしません。<br />・初期値 = 0',6,11,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO `configuration` VALUES (555,'おすすめ商品 - スクロール速度','MODULE_CAROUSEL_UI_CONF_SPEED_FEATURED_PRODUCTS','200','おすすめ商品をスクロールする速度(ミリ秒)を設定します。<br />設定値を大きくするとゆっくりスクロールします。0に設定するとスクロールしなくなります。<br />・初期値 = 200',6,12,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO `configuration` VALUES (556,'おすすめ商品 - 縦スクロール','MODULE_CAROUSEL_UI_CONF_VERTICAL_FEATURED_PRODUCTS','false','おすすめ商品を縦にスクロールしますか？<br />true: 縦スクロール<br />false: 横スクロール<br />・初期値 = false',6,13,NULL,'2009-11-19 12:53:57',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (557,'おすすめ商品 - 循環スクロール','MODULE_CAROUSEL_UI_CONF_CIRCULAR_FEATURED_PRODUCTS','true','おすすめ商品を循環的にスクロールしますか？<br />true: 循環スクロール<br />false: 往復スクロール<br />・初期値 = true',6,14,NULL,'2009-11-19 12:53:57',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (558,'おすすめ商品 - スクロールエリア表示件数','MODULE_CAROUSEL_UI_CONF_VISIBLE_FEATURED_PRODUCTS','3','おすすめ商品のスクロールエリアに表示する件数を設定します。<br />・初期値 = 3',6,15,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO `configuration` VALUES (559,'おすすめ商品 - スクロール件数','MODULE_CAROUSEL_UI_CONF_SCROLL_FEATURED_PRODUCTS','1','おすすめ商品の一度にスクロールさせる件数を設定します。<br />・初期値 = 1',6,16,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO `configuration` VALUES (560,'特価商品 - 最大表示件数','MODULE_CAROUSEL_UI_MAX_DISPLAY_SPECIALS_PRODUCTS','4','特価商品の最大表示件数を設定します。<br />・初期値 = 4',6,17,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO `configuration` VALUES (561,'特価商品 - 自動スクロール','MODULE_CAROUSEL_UI_CONF_AUTO_SPECIALS_PRODUCTS','0','特価商品を自動的にスクロールする場合の間隔(ミリ秒)を設定します。<br />0ミリ秒の場合は自動スクロールしません。<br />・初期値 = 0',6,18,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO `configuration` VALUES (562,'特価商品 - スクロール速度','MODULE_CAROUSEL_UI_CONF_SPEED_SPECIALS_PRODUCTS','200','特価商品をスクロールする速度(ミリ秒)を設定します。<br />設定値を大きくするとゆっくりスクロールします。0に設定するとスクロールしなくなります。<br />・初期値 = 200',6,19,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO `configuration` VALUES (563,'特価商品 - 縦スクロール','MODULE_CAROUSEL_UI_CONF_VERTICAL_SPECIALS_PRODUCTS','false','特価商品を縦にスクロールしますか？<br />true: 縦スクロール<br />false: 横スクロール<br />・初期値 = false',6,20,NULL,'2009-11-19 12:53:57',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (564,'特価商品 - 循環スクロール','MODULE_CAROUSEL_UI_CONF_CIRCULAR_SPECIALS_PRODUCTS','true','特価商品を循環的にスクロールしますか？<br />true: 循環スクロール<br />false: 往復スクロール<br />・初期値 = true',6,21,NULL,'2009-11-19 12:53:57',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (565,'特価商品 - スクロールエリア表示件数','MODULE_CAROUSEL_UI_CONF_VISIBLE_SPECIALS_PRODUCTS','3','特価商品のスクロールエリアに表示する件数を設定します。<br />・初期値 = 3',6,22,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO `configuration` VALUES (566,'特価商品 - スクロール件数','MODULE_CAROUSEL_UI_CONF_SCROLL_SPECIALS_PRODUCTS','1','特価商品の一度にスクロールさせる件数を設定します。<br />・初期値 = 1',6,23,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO `configuration` VALUES (567,'こんな商品も購入しています - 最大表示件数','MODULE_CAROUSEL_UI_MAX_DISPLAY_ALSO_PURCHASED_PRODUCTS','4','こんな商品も購入していますの最大表示件数を設定します。<br />・初期値 = 4',6,24,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO `configuration` VALUES (568,'こんな商品も購入しています - 自動スクロール','MODULE_CAROUSEL_UI_CONF_AUTO_ALSO_PURCHASED_PRODUCTS','0','こんな商品も購入していますを自動的にスクロールする場合の間隔(ミリ秒)を設定します。<br />0ミリ秒の場合は自動スクロールしません。<br />・初期値 = 0',6,25,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO `configuration` VALUES (569,'こんな商品も購入しています - スクロール速度','MODULE_CAROUSEL_UI_CONF_SPEED_ALSO_PURCHASED_PRODUCTS','200','こんな商品も購入していますをスクロールする速度(ミリ秒)を設定します。<br />設定値を大きくするとゆっくりスクロールします。0に設定するとスクロールしなくなります。<br />・初期値 = 200',6,26,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO `configuration` VALUES (570,'こんな商品も購入しています - 縦スクロール','MODULE_CAROUSEL_UI_CONF_VERTICAL_ALSO_PURCHASED_PRODUCTS','false','こんな商品も購入していますを縦にスクロールしますか？<br />true: 縦スクロール<br />false: 横スクロール<br />・初期値 = false',6,27,NULL,'2009-11-19 12:53:57',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (571,'こんな商品も購入しています - 循環スクロール','MODULE_CAROUSEL_UI_CONF_CIRCULAR_ALSO_PURCHASED_PRODUCTS','true','こんな商品も購入していますを循環的にスクロールしますか？<br />true: 循環スクロール<br />false: 往復スクロール<br />・初期値 = true',6,28,NULL,'2009-11-19 12:53:57',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (572,'こんな商品も購入しています - スクロールエリア表示件数','MODULE_CAROUSEL_UI_CONF_VISIBLE_ALSO_PURCHASED_PRODUCTS','3','こんな商品も購入していますのスクロールエリアに表示する件数を設定します。<br />・初期値 = 3',6,29,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO `configuration` VALUES (573,'こんな商品も購入しています - スクロール件数','MODULE_CAROUSEL_UI_CONF_SCROLL_ALSO_PURCHASED_PRODUCTS','1','こんな商品も購入していますの一度にスクロールさせる件数を設定します。<br />・初期値 = 1',6,30,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO `configuration` VALUES (574,'関連商品 - 最大表示件数','MODULE_CAROUSEL_UI_MAX_DISPLAY_XSELL_PRODUCTS','4','関連商品の最大表示件数を設定します。<br />・初期値 = 4',6,31,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO `configuration` VALUES (575,'関連商品 - 自動スクロール','MODULE_CAROUSEL_UI_CONF_AUTO_XSELL_PRODUCTS','0','関連商品を自動的にスクロールする場合の間隔(ミリ秒)を設定します。<br />0ミリ秒の場合は自動スクロールしません。<br />・初期値 = 0',6,32,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO `configuration` VALUES (576,'関連商品 - スクロール速度','MODULE_CAROUSEL_UI_CONF_SPEED_XSELL_PRODUCTS','200','関連商品をスクロールする速度(ミリ秒)を設定します。<br />設定値を大きくするとゆっくりスクロールします。0に設定するとスクロールしなくなります。<br />・初期値 = 200',6,33,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO `configuration` VALUES (577,'関連商品 - 縦スクロール','MODULE_CAROUSEL_UI_CONF_VERTICAL_XSELL_PRODUCTS','false','関連商品を縦にスクロールしますか？<br />true: 縦スクロール<br />false: 横スクロール<br />・初期値 = false',6,34,NULL,'2009-11-19 12:53:57',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (578,'関連商品 - 循環スクロール','MODULE_CAROUSEL_UI_CONF_CIRCULAR_XSELL_PRODUCTS','true','関連商品を循環的にスクロールしますか？<br />true: 循環スクロール<br />false: 往復スクロール<br />・初期値 = true',6,35,NULL,'2009-11-19 12:53:57',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (579,'関連商品 - スクロールエリア表示件数','MODULE_CAROUSEL_UI_CONF_VISIBLE_XSELL_PRODUCTS','3','関連商品のスクロールエリアに表示する件数を設定します。<br />・初期値 = 3',6,36,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO `configuration` VALUES (580,'関連商品 - スクロール件数','MODULE_CAROUSEL_UI_CONF_SCROLL_XSELL_PRODUCTS','1','関連商品の一度にスクロールさせる件数を設定します。<br />・初期値 = 1',6,37,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO `configuration` VALUES (581,'カテゴリサイトマップの有効化','MODULE_ADDON_MODULES_CATEGORY_SITEMAP_STATUS','true','カテゴリサイトマップ表示を有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 12:54:42',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (582,'表示するカテゴリの深さ','MODULE_ADDON_MODULES_CATEGORY_SITEMAP_TREE_LEVEL','2','表示するカテゴリの深さを指定します（デフォルト=2）',6,1,NULL,'2009-11-19 12:54:42',NULL,NULL);
INSERT INTO `configuration` VALUES (583,'優先順','MODULE_ADDON_MODULES_CATEGORY_SITEMAP_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,2,NULL,'2009-11-19 12:54:42',NULL,NULL);
INSERT INTO `configuration` VALUES (584,'注文ステップ表示の有効化','MODULE_CHECKOUT_STEP_STATUS','true','注文ステップ表示を有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 12:56:18',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (585,'優先順','MODULE_CHECKOUT_STEP_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,1,NULL,'2009-11-19 12:56:18',NULL,NULL);
INSERT INTO `configuration` VALUES (586,'管理メニューの設定の有効化','MODULE_EASY_ADMIN_STATUS','false','管理メニューの設定を有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 12:56:42',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (587,'優先順','MODULE_EASY_ADMIN_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,1,NULL,'2009-11-19 12:56:42',NULL,NULL);
INSERT INTO `configuration` VALUES (590,'デザインの設定の有効化','MODULE_EASY_DESIGN_STATUS','true','デザインの設定を有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 12:59:53',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (591,'優先順','MODULE_EASY_DESIGN_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,1,NULL,'2009-11-19 12:59:53',NULL,NULL);
INSERT INTO `configuration` VALUES (1534,'メールテンプレートの有効化','MODULE_EMAIL_TEMPLATES_STATUS','true','メールテンプレートを有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2010-06-27 04:29:58',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (1535,'優先順','MODULE_EMAIL_TEMPLATES_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,1,NULL,'2010-06-27 04:29:58',NULL,NULL);
INSERT INTO `configuration` VALUES (594,'フィーチャーエリアUIの有効化','MODULE_FEATURE_AREA_STATUS','true','フィーチャーエリアUIを有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 13:02:18',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (595,'優先順','MODULE_FEATURE_AREA_SORT_ORDER','10','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,1,NULL,'2009-11-19 13:02:18',NULL,NULL);
INSERT INTO `configuration` VALUES (596,'サムネイル - 自動スクロール ','MODULE_FEATURE_AREA_UI_CONF_AUTO','6200','サムネイルを自動的にスクロールする場合の間隔(ミリ秒)を設定します。<br />0ミリ秒の場合は自動スクロールしません。<br />・初期値 = 6200',6,2,NULL,'2009-11-19 13:02:18',NULL,NULL);
INSERT INTO `configuration` VALUES (597,'サムネイル - スクロール速度','MODULE_FEATURE_AREA_UI_CONF_SPEED','800','サムネイルをスクロールする速度(ミリ秒)を設定します。<br />設定値を大きくするとゆっくりスクロールします。0に設定するとスクロールしなくなります。<br />・初期値 = 800',6,3,NULL,'2009-11-19 13:02:18',NULL,NULL);
INSERT INTO `configuration` VALUES (598,'サムネイル - スクロールエリア表示件数','MODULE_FEATURE_AREA_UI_CONF_VISIBLE','5','サムネイルのスクロールエリアに表示する件数を設定します。<br />・初期値 = 5',6,4,NULL,'2009-11-19 13:02:18',NULL,NULL);
INSERT INTO `configuration` VALUES (599,'グローバルナビブロックの有効化','MODULE_GLOBALNAVI_STATUS','true','グローバルナビを有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 13:03:12',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (600,'優先順','MODULE_GLOBALNAVI_SORT_ORDER','1950','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,1,NULL,'2009-11-19 13:03:12',NULL,NULL);
INSERT INTO `configuration` VALUES (601,'表示するカテゴリの上限','MODULE_GLOBALNAVI_CFG_LIMIT','5','グローバルナビに表示するカテゴリ数の上限を設定します',6,2,NULL,'2009-11-19 13:03:12',NULL,NULL);
INSERT INTO `configuration` VALUES (602,'複数画像表示 の有効化','MODULE_MULTIPLE_IMAGE_VIEW_STATUS','true','複数画像表示を有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 13:03:54',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (603,'優先順','MODULE_MULTIPLE_IMAGE_VIEW_SORT_ORDER','10','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,1,NULL,'2009-11-19 13:03:54',NULL,NULL);
INSERT INTO `configuration` VALUES (604,'サムネイルサイズ：幅','MODULE_MULTIPLE_IMAGE_VIEW_THMB_WIDTH','100','サムネイル画像の表示幅を設定できます。(pixel)',6,2,NULL,'2009-11-19 13:03:54',NULL,NULL);
INSERT INTO `configuration` VALUES (605,'サムネイルサイズ：高さ','MODULE_MULTIPLE_IMAGE_VIEW_THMB_HEIGHT','80','サムネイル画像の表示高さを設定できます。(pixel)',6,3,NULL,'2009-11-19 13:03:54',NULL,NULL);
INSERT INTO `configuration` VALUES (606,'CSVによる商品一括登録の有効化','MODULE_PRODUCT_CSV_STATUS','true','CSVによる商品一括登録を有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 13:04:30',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (607,'優先順','MODULE_PRODUCT_CSV_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,1,NULL,'2009-11-19 13:04:30',NULL,NULL);
INSERT INTO `configuration` VALUES (608,'オプション毎の在庫管理の有効化','MODULE_PRODUCTS_WITH_ATTRIBUTES_STOCK_STATUS','true','オプション毎の在庫管理を有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 13:05:03',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (609,'優先順','MODULE_PRODUCTS_WITH_ATTRIBUTES_STOCK_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,1,NULL,'2009-11-19 13:05:03',NULL,NULL);
INSERT INTO `configuration` VALUES (610,'商品レビューの有効化','MODULE_REVIEWS_STATUS','true','商品レビューを有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 13:05:33',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (611,'商品詳細ページ　レビュー表示数','MODULE_REVIEWS_MAX_DISPLAY_NEW_REVIEWS','3','商品詳細ページで表示される商品レビューの数を設定してください。<br />商品レビュー一覧ページのレビュー数は「一般設定」-「最大値の設定」-「新しいレビューの表示数最大値」で設定してください。',6,1,NULL,'2009-11-19 13:05:33',NULL,NULL);
INSERT INTO `configuration` VALUES (612,'非ログインユーザーの商品レビュー閲覧禁止','MODULE_REVIEWS_LIST_DISPLAY_FORCE_LOGIN','false','ログインしていないユーザーは商品レビュー閲覧ができない。',6,2,NULL,'2009-11-19 13:05:33',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (613,'優先順','MODULE_REVIEWS_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,3,NULL,'2009-11-19 13:05:33',NULL,NULL);
INSERT INTO `configuration` VALUES (614,'もっと検索の有効化','MODULE_SEARCH_MORE_STATUS','true','もっと検索を有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 13:06:01',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (615,'表示件数リストボックスのタイトル','MODULE_SEARCH_MORE_PAGE_MAX_LIST_NAME','表示件数','商品一覧の中で表示される商品の数を指定するリストのラベルを指定してください。デフォルト値は「表示件数」です。',6,1,NULL,'2009-11-19 13:06:01',NULL,NULL);
INSERT INTO `configuration` VALUES (616,'表示件数リストボックスの値','MODULE_SEARCH_MORE_PAGE_MAX_LIST_VALUE','10,25,50,100','商品一覧の中で表示される商品の数を指定するリストの内容をカンマ(,)区切りで指定してください。デフォルト値は「10,25,50,100」です。',6,2,NULL,'2009-11-19 13:06:01',NULL,NULL);
INSERT INTO `configuration` VALUES (617,'並び替えリストボックスのタイトル','MODULE_SEARCH_MORE_SORT_LIST_NAME','並び替え','商品一覧のソート順を指定するリストのラベルを指定してください。デフォルト値は「並び替え」です。',6,3,NULL,'2009-11-19 13:06:01',NULL,NULL);
INSERT INTO `configuration` VALUES (618,'優先順','MODULE_SEARCH_MORE_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,4,NULL,'2009-11-19 13:06:01',NULL,NULL);
INSERT INTO `configuration` VALUES (622,'ポイントモジュールの有効化<br />有効化の後に<a href=\"http://zen-cart.ark-web.jp/ohtsuji/zencart-sugu/admin/addon_modules_admin.php?module=addon_modules/blocks\">ブロックの設定</a>から「現在のポイント残額」ブロックの表示設定をしてください。','MODULE_POINT_BASE_STATUS','true','ポイントを有効にしますか？ (ポイントモジュールは他の全てのポイントモジュールにとって必須です)<br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 18:25:40',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (623,'ポイント単位名称','MODULE_POINT_BASE_POINT_SYMBOL','point','ポイントの単位名称を入力してください。<br />・初期値 = point',6,1,NULL,'2009-11-19 18:25:40',NULL,NULL);
INSERT INTO `configuration` VALUES (624,'ポイント管理ページで表示するポイント履歴の最大値','MODULE_POINT_BASE_MAX_DISPLAY_SEARCH_RESULTS_POINTS','20','ポイント管理ページで表示するポイント履歴の最大値を設定してください。<br />・初期値 = 20',6,2,NULL,'2009-11-19 18:25:40',NULL,NULL);
INSERT INTO `configuration` VALUES (625,'優先順','MODULE_POINT_BASE_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,3,NULL,'2009-11-19 18:25:40',NULL,NULL);
INSERT INTO `configuration` VALUES (640,'会員登録ポイント発行モジュールの有効化','MODULE_POINT_CREATEACCOUNT_STATUS','true','会員登録ポイント発行モジュールを有効にしますか？<br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 18:56:07',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (641,'発行ポイントの保留','MODULE_POINT_CREATEACCOUNT_PENDING','false','ポイント発行時にそのポイントの使用を保留にしますか？<br />保留しない場合はポイント発行後すぐに使用できます。<br />true: 保留にする<br />false: 保留にしない（即時使用可能）',6,1,NULL,'2009-11-19 18:56:07',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (642,'会員登録ポイント数','MODULE_POINT_CREATEACCOUNT_POINT','','会員登録時にその会員へプレゼントするポイント数を設定します。<br />例: 500 (会員登録時に500ポイントプレゼント)',6,2,NULL,'2009-11-19 18:56:07',NULL,NULL);
INSERT INTO `configuration` VALUES (643,'優先順','MODULE_POINT_CREATEACCOUNT_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,3,NULL,'2009-11-19 18:56:07',NULL,NULL);
INSERT INTO `configuration` VALUES (644,'顧客毎ポイント還元率設定モジュールの有効化','MODULE_POINT_CUSTOMERSRATE_STATUS','true','顧客毎ポイント還元率設定を有効にしますか？<br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 18:56:29',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (645,'優先順','MODULE_POINT_CUSTOMERSRATE_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,1,NULL,'2009-11-19 18:56:29',NULL,NULL);
INSERT INTO `configuration` VALUES (646,'顧客グループ毎ポイント還元率設定モジュールの有効化','MODULE_POINT_GROUPRATE_STATUS','true','顧客グループ毎ポイント還元率設定を有効にしますか？<br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 18:56:53',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (647,'優先順','MODULE_POINT_GROUPRATE_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,1,NULL,'2009-11-19 18:56:53',NULL,NULL);
INSERT INTO `configuration` VALUES (648,'商品毎ポイント還元率設定モジュールの有効化','MODULE_POINT_PRODUCTSRATE_STATUS','true','商品毎ポイント還元率設定を有効にしますか？<br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 18:57:28',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (649,'優先順','MODULE_POINT_PRODUCTSRATE_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,1,NULL,'2009-11-19 18:57:28',NULL,NULL);
INSERT INTO `configuration` VALUES (650,'ショッピングカートサマリーブロックの有効化','MODULE_SHOPPING_CART_SUMMARY_STATUS','true','ショッピングカートサマリーブロックを有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 19:37:35',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (651,'優先順','MODULE_SHOPPING_CART_SUMMARY_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,1,NULL,'2009-11-19 19:37:35',NULL,NULL);
INSERT INTO `configuration` VALUES (1531,'商品を修正','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_SUPER_ORDERS_PRODUCTS','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1530,'梱包を分割','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_SUPER_ORDERS_SPLIT','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1529,'注文最終設定','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_SUPER_ORDERS_FINAL','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1528,'支払情報','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_SUPER_ORDERS_PAYMENT','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1527,'合計モジュール','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_MODULES_OT_TOTAL','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1522,'SMTP認証 - DNS名','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_209','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1523,'SMTP認証 - IPポート番号','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_210','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1520,'SMTP認証 - メールアカウント','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_207','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1521,'SMTP認証 - パスワード','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_208','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1519,'オンラインユーザー数の表示設定','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_243','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1517,'在庫わずかになったらメール送信','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_240','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1518,'「メールマガジンの購読解除」リンクの表示','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_242','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1513,'掲載待ちレビューについてのメール送信先','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_236','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1514,'「お問い合わせ」メールのドロップダウン設定','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_237','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1516,'「お問い合わせ」にショップ名と住所を表記','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_239','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1515,'ゲストに「友達に知らせる」機能を許可','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_238','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1510,'ショップ運営者の注文ステータスメール(コピー)の送信','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_233','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1511,'ショップ運営者の注文ステータスメール(コピー)の送信先','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_234','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1512,'掲載待ちレビューについてメール送信','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_235','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1506,'ショップ運営者からのギフト券送付メール(コピー)の送信','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_229','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1507,'ショップ運営者からのギフト券送付メール(コピー)の送信先','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_230','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1508,'ショップ運営者からのクーポン券送付メール(コピー)の送信','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_231','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1509,'ショップ運営者からのクーポン券送付メール(コピー)の送信先','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_232','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1505,'ギフト券送付メール(コピー)の送信先','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_228','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1503,'管理者が送信するメールフォーマット','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_221','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1504,'ギフト券送付メール(コピー)の送信','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_227','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1502,'送信メールの送信元アドレスの実在性','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_220','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1501,'メール送信エラーの表示','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_217','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1500,'メール保存の設定','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_216','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1498,'メールアドレスをDNSで確認','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_214','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1499,'メールを送信','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_215','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1495,'メール送信 - 接続方法','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_206','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1497,'メール送信にMIME HTMLを使用','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_213','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1496,'メールの改行コード','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_212','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1494,'カテゴリ内の商品数を表示 - 管理画面','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_1_28','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1489,'Zen Cart新バージョンの自動チェック(ヘッダで告知するか否か)','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_1_22','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1490,'サーバの稼動時間(アップタイム)','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_1_24','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1491,'リンク切れページのチェック','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_1_25','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1492,'HTMLエディタ','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_1_26','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1493,'phpBBへのリンクを表示','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_1_27','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1488,'管理画面のプログラム処理の上限時間設定(秒)','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_1_21','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1487,'管理画面のタイムアウト設定(秒数)','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_1_20','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1486,'ショップのステータス','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_1_23','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1483,'商品にかかる税額の算定基準','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_1_17','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1484,'送料にかかる税額の算定基準','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_1_18','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1485,'税金の表示','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_1_19','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1482,'価格を税込みで表示 - 管理画面','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_1_16','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1480,'税額の小数点位置','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_1_14','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1481,'価格を税込みで表示','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_1_15','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1476,'表示言語の選択','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_1_8','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1477,'商品の追加後にカートを表示','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_1_10','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1478,'デフォルトの検索演算子','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_1_11','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1479,'カテゴリ内の商品数を表示','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_1_13','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1474,'入荷予定商品のソート順に用いるフィールド','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_1_6','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1475,'表示言語と通貨の連動','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_1_7','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1470,'画像ファイル名を入力','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_BANNER_MANAGER_IMAGE_LOCAL','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1471,'画像の保存先','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_BANNER_MANAGER_IMAGE_TARGET','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1473,'入荷予定商品のソート順','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_1_5','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1472,'ショップオーナー名','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_1_2','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1469,'新しいバナー','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_BANNER_MANAGER_NEW_GROUP','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1468,'重量,属性,値引き列','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_COLUMN','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1466,'商品選択プルダウン','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_PRODUCTS','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1467,'属性凡例','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_LEGEND','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1465,'カテゴリ選択プルダウン','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_CATEGORIES','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1464,'オプション画像','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_IMAGE','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1463,'属性フラグ','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_FLAGS','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1462,'単語/文字値引き','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_PRICE_WORDS','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1461,'数量値引き','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_QTY_PRICES','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1460,'属性のプライスファクター','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_PRICE_FACTOR','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1459,'属性のワンタイム値引き','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_ONETIME','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1458,'属性の重量','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_WEIGHT','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1457,'小数点','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_NUMBER_UNIT','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1456,'複数カテゴリのリンク管理へのリンク','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_CATEGORY','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1455,'商品および価格編集ボタン','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_MODIFY','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1454,'おすすめ商品プルダウン','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_OPTIONS_VALUES_COPIER','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1453,'コピー操作','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_OPTIONS_VALUES_COPY','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1452,'日本語以外の入力項目','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_OPTIONS_VALUES_LANGUAGE','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1451,'テキスト属性の長さ','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_OPTIONS_NAME_LENGTH','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1450,'一連の大きな変更','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_OPTIONS_NAME_BIG_MODIFY','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1449,'日本語以外の入力項目','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_OPTIONS_NAME_LANGUAGE','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1448,'編集へのリンク','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_FEATURED_EDIT_LINK','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1447,'価格の管理へのリンク','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_FEATURED_PRICE_LINK','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1446,'小数点','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_SPECIALS_NUMBER_UNIT','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1445,'選択へのリンク','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_SPECIALS_PRE_ADD','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1443,'価格の管理へのリンク','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_SPECIALS_PRICE_LINK','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1444,'編集へのリンク','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_SPECIALS_EDIT_LINK','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1436,'小数点','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_NUMBER_UNIT','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1437,'メタタグでの注意書き','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_META_TAGS_USAGE','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1438,'複数のカテゴリがマネージャをリンク','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_CATEGORY_MANAGER','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1439,'日本語以外の入力項目','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ORDER_STATUS_LANGUAGE','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1440,'グループ割引','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CUSTOMERS_GROUP_PRICING','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1441,'割引券贈呈','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CUSTOMERS_REFERRAL','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1442,'日本語以外の入力項目','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_MANUFACTURERS_LANGUAGE','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (767,'Sitemap XMLの有効化','MODULE_SITEMAPXML_STATUS','true','Sitemap XMLを有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2010-04-20 19:40:09',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (768,'Compress XML File','MODULE_SITEMAPXML_COMPRESS','false','Compress Google XML Sitemap file',6,1,NULL,'2010-04-20 19:40:09',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (769,'Lastmod tag format','MODULE_SITEMAPXML_LASTMOD_FORMAT','date','Lastmod tag format:<br />date - Complete date: YYYY-MM-DD (eg 1997-07-16)<br />full -    Complete date plus hours, minutes and seconds: YYYY-MM-DDThh:mm:ssTZD (eg 1997-07-16T19:20:30+01:00)',6,2,NULL,'2010-04-20 19:40:09',NULL,'zen_cfg_select_option(array(\'date\', \'full\'), ');
INSERT INTO `configuration` VALUES (770,'Use Existing Files','MODULE_SITEMAPXML_USE_EXISTING_FILES','true','Use Existing XML Files',6,3,NULL,'2010-04-20 19:40:09',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (771,'Generate language_id for default language','MODULE_SITEMAPXML_USE_DEFAULT_LANGUAGE','true','Generate language_id parameter for default language',6,4,NULL,'2010-04-20 19:40:09',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (772,'Ping urls','MODULE_SITEMAPXML_PING_URLS','Google => http://www.google.com/webmasters/sitemaps/ping?sitemap=%s; Yahoo! => http://search.yahooapis.com/SiteExplorerService/V1/ping?sitemap=%s; Ask.com => http://submissions.ask.com/ping?sitemap=%s; Microsoft => http://www.moreover.com/ping?u=%s','List of pinging urls separated by ;',6,5,NULL,'2010-04-20 19:40:09',NULL,'zen_cfg_textarea(');
INSERT INTO `configuration` VALUES (773,'Products order by','MODULE_SITEMAPXML_PRODUCTS_ORDERBY','products_sort_order ASC, last_date DESC','',6,6,NULL,'2010-04-20 19:40:09',NULL,NULL);
INSERT INTO `configuration` VALUES (774,'Products changefreq','MODULE_SITEMAPXML_PRODUCTS_CHANGEFREQ','weekly','How frequently the Product pages page is likely to change.',6,7,NULL,'2010-04-20 19:40:09',NULL,'zen_cfg_select_option(array(\'always\', \'hourly\', \'daily\', \'weekly\', \'monthly\', \'yearly\', \'never\'),');
INSERT INTO `configuration` VALUES (775,'Categories order by','MODULE_SITEMAPXML_CATEGORIES_ORDERBY','sort_order ASC, last_date DESC','',6,8,NULL,'2010-04-20 19:40:09',NULL,NULL);
INSERT INTO `configuration` VALUES (776,'Category changefreq','MODULE_SITEMAPXML_CATEGORIES_CHANGEFREQ','weekly','How frequently the Category pages page is likely to change.',6,9,NULL,'2010-04-20 19:40:09',NULL,'zen_cfg_select_option(array(\'always\', \'hourly\', \'daily\', \'weekly\', \'monthly\', \'yearly\', \'never\'),');
INSERT INTO `configuration` VALUES (777,'Reviews order by','MODULE_SITEMAPXML_REVIEWS_ORDERBY','reviews_rating ASC, last_date DESC','',6,10,NULL,'2010-04-20 19:40:09',NULL,NULL);
INSERT INTO `configuration` VALUES (778,'Reviews changefreq','MODULE_SITEMAPXML_REVIEWS_CHANGEFREQ','weekly','How frequently the Category pages page is likely to change.',6,11,NULL,'2010-04-20 19:40:09',NULL,'zen_cfg_select_option(array(\'always\', \'hourly\', \'daily\', \'weekly\', \'monthly\', \'yearly\', \'never\'),');
INSERT INTO `configuration` VALUES (779,'EZPages order by','MODULE_SITEMAPXML_EZPAGES_ORDERBY','sidebox_sort_order ASC, header_sort_order ASC, footer_sort_order ASC','',6,12,NULL,'2010-04-20 19:40:09',NULL,NULL);
INSERT INTO `configuration` VALUES (780,'EZPages changefreq','MODULE_SITEMAPXML_EZPAGES_CHANGEFREQ','weekly','How frequently the EZPages pages page is likely to change.',6,13,NULL,'2010-04-20 19:40:09',NULL,'zen_cfg_select_option(array(\'always\', \'hourly\', \'daily\', \'weekly\', \'monthly\', \'yearly\', \'never\'),');
INSERT INTO `configuration` VALUES (781,'Testimonials order by','MODULE_SITEMAPXML_TESTIMONIALS_ORDERBY','last_date DESC','',6,14,NULL,'2010-04-20 19:40:09',NULL,NULL);
INSERT INTO `configuration` VALUES (782,'Testimonials changefreq','MODULE_SITEMAPXML_TESTIMONIALS_CHANGEFREQ','weekly','How frequently the EZPages pages page is likely to change.',6,15,NULL,'2010-04-20 19:40:09',NULL,'zen_cfg_select_option(array(\'always\', \'hourly\', \'daily\', \'weekly\', \'monthly\', \'yearly\', \'never\'),');
INSERT INTO `configuration` VALUES (783,'優先順','MODULE_SITEMAPXML_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,16,NULL,'2010-04-20 19:40:09',NULL,NULL);
INSERT INTO `configuration` VALUES (784,'商品レビューの有効化','MODULE_EASY_REVIEWS_STATUS','true','商品レビューを有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2010-05-20 12:54:48',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (785,'商品詳細ページ　レビュー表示数','MODULE_EASY_REVIEWS_MAX_DISPLAY_NEW_REVIEWS','3','商品詳細ページで表示される商品レビューの数を設定してください。<br />商品レビュー一覧ページのレビュー数は「一般設定」-「最大値の設定」-「新しいレビューの表示数最大値」で設定してください。',6,1,NULL,'2010-05-20 12:54:48',NULL,NULL);
INSERT INTO `configuration` VALUES (786,'非ログインユーザーの商品レビュー閲覧禁止','MODULE_EASY_REVIEWS_LIST_DISPLAY_FORCE_LOGIN','false','ログインしていないユーザーは商品レビュー閲覧ができない。',6,2,NULL,'2010-05-20 12:54:48',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (787,'優先順','MODULE_EASY_REVIEWS_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,3,NULL,'2010-05-20 12:54:48',NULL,NULL);
INSERT INTO `configuration` VALUES (788,'郵便番号による住所自動入力の有効化','MODULE_AM_AJAX_ADDRESS_STATUS','true','郵便番号による住所自動入力を有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2010-05-20 13:02:17',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES (1435,'商品重量','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_WEIGHT','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1434,'最小数量/単位ミックス','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_QUANTITY_MIXED','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1433,'商品の数量単位','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_QUANTITY_ORDER_UNIT','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1432,'商品の最大数量','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_QUANTITY_ORDER_MIN','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1431,'商品の最小数量','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_QUANTITY_ORDER_MAX','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1430,'常に送料無料','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_ALWAYS_FREE_SHIPPING','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1429,'ヴァーチャル商品','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_VIRTUAL','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1428,'価格お問い合わせ','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_PRICE_CALL','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1427,'無料商品','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_PRICE_FREE','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1426,'商品価格（グロス）','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_PRICE_GROSS','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1424,'商品属性による価格','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_PRICE_ATTRIBUTE','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1425,'税種別','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_TAX_CLASS','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1423,'日本語以外の入力項目','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_LANGUAGE','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1422,'商品オプションへのリンク','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CATEGORY_PRODUCT_ATTRIBUTE','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1421,'新規商品の商品種類プルダウン','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CATEGORY_PRODUCT_TYPE','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1420,'商品価格管理へのリンク','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CATEGORY_PRICE_LINK','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (1419,'日本語以外の入力項目','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CATEGORY_LANGUAGE','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO `configuration` VALUES (907,'Store Fax','STORE_FAX','03-XXXX-XXXX','Enter the fax number for your store.<br>You can call upon this by using the define <strong>STORE_FAX</strong>.',1,4,'2010-06-18 11:27:23','2010-06-04 14:00:45',NULL,NULL);
INSERT INTO `configuration` VALUES (908,'Store Phone','STORE_PHONE','03-XXXX-XXXX','Enter the phone number for your store.<br>You can call upon this by using the define <strong>STORE_PHONE</strong>.',1,4,'2010-06-18 11:27:28','2010-06-04 14:00:45',NULL,NULL);
INSERT INTO `configuration` VALUES (909,'Enable Purchase Order Module','MODULE_PAYMENT_PURCHASE_ORDER_STATUS','True','Do you want to accept Purchase Order payments?',6,1,'2010-06-04 14:00:45','2010-06-04 14:00:45',NULL,'zen_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES (910,'Make payable to:','MODULE_PAYMENT_PURCHASE_ORDER_PAYTO','Destination ImagiNation, Inc.','Who should payments be made payable to?',6,2,'2010-06-04 14:00:45','2010-06-04 14:00:45',NULL,NULL);
INSERT INTO `configuration` VALUES (911,'Sort order of display.','MODULE_PAYMENT_PURCHASE_ORDER_SORT_ORDER','0','Sort order of display. Lowest is displayed first.',6,4,'2010-06-04 14:00:45','2010-06-04 14:00:45',NULL,NULL);
INSERT INTO `configuration` VALUES (912,'Payment Zone','MODULE_PAYMENT_PURCHASE_ORDER_ZONE','0','If a zone is selected, only enable this payment method for that zone.',6,5,'2010-06-04 14:00:45','2010-06-04 14:00:45','zen_get_zone_class_title','zen_cfg_pull_down_zone_classes(');
INSERT INTO `configuration` VALUES (913,'Set Order Status','MODULE_PAYMENT_PURCHASE_ORDER_ORDER_STATUS_ID','2','Set the status of orders made with this payment module to this value',6,6,'2010-06-04 14:00:45','2010-06-04 14:00:45','zen_get_order_status_name','zen_cfg_pull_down_order_statuses(');
INSERT INTO `configuration` VALUES (914,'Auto Status - Purchase Order','AUTO_STATUS_PO','2','Number of the status assigned to an order when a purchase order is added to the payment data.',28,11,'2010-06-04 14:00:45','2010-06-04 14:00:45','zen_get_order_status_name','zen_cfg_pull_down_order_statuses(');
INSERT INTO `configuration` VALUES (915,'Auto Status - Payment','AUTO_STATUS_PAYMENT','2','Number of the order status assigned when a payment (<B>not</B> attached to a purchase order) is added to the payment data.',28,10,'2010-06-04 14:00:45','2010-06-04 14:00:45','zen_get_order_status_name','zen_cfg_pull_down_order_statuses(');
INSERT INTO `configuration` VALUES (916,'Auto Status - P.O. Payment','AUTO_STATUS_PO_PAYMENT','2','Number of the order status assigned when a payment <B>attached to a purchase order</B> is added to the payment data.',28,10,'2010-06-04 14:00:45','2010-06-04 14:00:45','zen_get_order_status_name','zen_cfg_pull_down_order_statuses(');
INSERT INTO `configuration` VALUES (917,'Auto Status - Refund','AUTO_STATUS_REFUND','2','Number of the order status assigned when a refund is added to the payment data.',28,13,'2010-06-04 14:00:45','2010-06-04 14:00:45','zen_get_order_status_name','zen_cfg_pull_down_order_statuses(');
INSERT INTO `configuration` VALUES (918,'Auto Comments - Payment','AUTO_COMMENTS_PAYMENT','Payment received in our office. Payment ID: %s','You\'ll have the option of adding these pre-configured comments to an order when a payment is entered.  You can attach the payment number to the comments by typing <strong>%s</strong>.',28,14,'2010-06-04 14:00:45','2010-06-04 14:00:45',NULL,NULL);
INSERT INTO `configuration` VALUES (919,'Auto Comments - P.O. Payment','AUTO_COMMENTS_PO_PAYMENT','Payment on purchase order received in our office. Payment ID: %s','You will have the option of adding these pre-configured comments to an order when a purchase order payment is entered.  You can attach the payment number to the comments by typing <strong>%s</strong>.',28,14,'2010-06-04 14:00:45','2010-06-04 14:00:45',NULL,NULL);
INSERT INTO `configuration` VALUES (920,'Auto Comments - Purchase Order','AUTO_COMMENTS_PO','Purchase Order #%s received in our office','You will have the option of adding these pre-configured comments to an order when a purchase order is entered.  You can attach the payment number to the comments by typing <strong>%s</strong>.',28,15,'2010-06-04 14:00:45','2010-06-04 14:00:45',NULL,NULL);
INSERT INTO `configuration` VALUES (921,'Auto Comments - Refund','AUTO_COMMENTS_REFUND','Refund #%s has been issued from our office.','You will have the option of adding these pre-configured comments to an order when a refund is entered.  You can attach the refund number to the comments by typing <strong>%s</strong>.',28,17,'2010-06-04 14:00:45','2010-06-04 14:00:45',NULL,NULL);
INSERT INTO `configuration` VALUES (922,'Federal Tax Exempt Number','FED_TAX_ID_NUMBER','00-000000','If your tax exempt, then you should have a federal tax ID number. Enter the number here and the tax columns will not appear on the invoice. The number will also be displayed at the top of the invoice.',28,50,'2010-06-04 14:00:45','2010-06-04 14:00:45',NULL,NULL);
INSERT INTO `configuration` VALUES (923,'Closed Status - \"Cancelled\"','STATUS_ORDER_CANCELLED','0','Insert the order status ID # you would like to assign to an order when you press the special \"Cancelled!\" button on super_orders.php.<p>If you do not have a \"cancel\" status, or do not want assign one automatically, choose <B>default</B> and this option will be ignored.<p><strong>You cannot attach comments or notify the customer using this option.</strong>',28,30,'2010-06-04 14:00:45','2010-06-04 14:00:45','zen_get_order_status_name','zen_cfg_pull_down_order_statuses(');
INSERT INTO `configuration` VALUES (924,'Closed Status - \"Completed\"','STATUS_ORDER_COMPLETED','0','Insert the order status ID # you would like to assign to an order when you press the special \"Completed!\" button on super_orders.php.<p>If you do not have a \"complete\" status, or do not want assign one automatically, choose <B>default</B> and this option will be ignored.<p><strong>You cannot attach comments or notify the customer using this option.</strong>',28,30,'2010-06-04 14:00:45','2010-06-04 14:00:45','zen_get_order_status_name','zen_cfg_pull_down_order_statuses(');
INSERT INTO `configuration` VALUES (925,'Closed Status - \"Reopened\"','STATUS_ORDER_REOPEN','0','Insert the order status ID # you would like to assign to an order when you undo the cancelled/completed status of an order.<p>If you do not have a \"reopened\" status, or do not want assign one automatically, choose <B>default</B> and this option will be ignored.<p><strong>You cannot attach comments or notify the customer using this option.</strong>',28,30,'2010-06-04 14:00:45','2010-06-04 14:00:45','zen_get_order_status_name','zen_cfg_pull_down_order_statuses(');
INSERT INTO `configuration` VALUES (926,'銀行振込を有効にする','MODULE_PAYMENT_MONEYORDER_STATUS','True','銀行振込による支払いを受け付けますか？',6,1,NULL,'2010-06-04 14:41:50',NULL,'zen_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO `configuration` VALUES (927,'お振込先:','MODULE_PAYMENT_MONEYORDER_PAYTO','','お振込先名義を設定してください。',6,1,NULL,'2010-06-04 14:41:50',NULL,NULL);
INSERT INTO `configuration` VALUES (928,'表示の整列順','MODULE_PAYMENT_MONEYORDER_SORT_ORDER','0','表示の整列順を設定できます。数字が小さいほど上位に表示されます。',6,0,NULL,'2010-06-04 14:41:50',NULL,NULL);
INSERT INTO `configuration` VALUES (929,'適用地域','MODULE_PAYMENT_MONEYORDER_ZONE','0','適用地域を選択すると、選択した地域のみで利用可能となります。',6,2,NULL,'2010-06-04 14:41:50','zen_get_zone_class_title','zen_cfg_pull_down_zone_classes(');
INSERT INTO `configuration` VALUES (930,'初期注文ステータス','MODULE_PAYMENT_MONEYORDER_ORDER_STATUS_ID','0','設定したステータスが受注時に適用されます。',6,0,NULL,'2010-06-04 14:41:50','zen_get_order_status_name','zen_cfg_pull_down_order_statuses(');
INSERT INTO `configuration` VALUES (931,'インストール状態','MODULE_ORDER_TOTAL_GROUP_PRICING_STATUS','true','',6,1,NULL,'2010-06-04 14:43:24',NULL,'zen_cfg_select_option(array(\'true\'), ');
INSERT INTO `configuration` VALUES (932,'表示の整列順','MODULE_ORDER_TOTAL_GROUP_PRICING_SORT_ORDER','290','表示の整列順を設定できます. 数字が小さいほど上位に表示されます。',6,2,NULL,'2010-06-04 14:43:24',NULL,NULL);
INSERT INTO `configuration` VALUES (933,'送料を含める','MODULE_ORDER_TOTAL_GROUP_PRICING_INC_SHIPPING','false','送料を計算に含めますか？',6,5,NULL,'2010-06-04 14:43:24',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (934,'税金を含める','MODULE_ORDER_TOTAL_GROUP_PRICING_INC_TAX','true','税金を計算に含めますか？',6,6,NULL,'2010-06-04 14:43:24',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO `configuration` VALUES (935,'税金の再計算','MODULE_ORDER_TOTAL_GROUP_PRICING_CALC_TAX','Standard','税金を再計算しますか？',6,7,NULL,'2010-06-04 14:43:24',NULL,'zen_cfg_select_option(array(\'None\', \'Standard\', \'Credit Note\'), ');
INSERT INTO `configuration` VALUES (936,'税種別','MODULE_ORDER_TOTAL_GROUP_PRICING_TAX_CLASS','0','顧客割引をCredit Note（貸方票）取引として利用する際に適応する税種別。',6,0,NULL,'2010-06-04 14:43:24','zen_get_tax_class_title','zen_cfg_pull_down_tax_classes(');
INSERT INTO `configuration` VALUES (937,'インストール状態','MODULE_ORDER_TOTAL_COD_STATUS','true','',6,1,NULL,'2010-06-04 14:43:27',NULL,'zen_cfg_select_option(array(\'true\'), ');
INSERT INTO `configuration` VALUES (938,'表示の整列順','MODULE_ORDER_TOTAL_COD_SORT_ORDER','950','表示の整列順を設定できます. 数字が小さいほど上位に表示されます。',6,2,NULL,'2010-06-04 14:43:27',NULL,NULL);
INSERT INTO `configuration` VALUES (939,'COD Fee for FLAT','MODULE_ORDER_TOTAL_COD_FEE_FLAT','AT:3.00,DE:3.58,00:9.99','FLAT: &lt;Country code&gt;:&lt;COD price&gt;, .... 00 as country code applies for all countries. If country code is 00, it must be the last statement. If no 00:9.99 appears, COD shipping in foreign countries is not calculated (not possible)',6,3,NULL,'2010-06-04 14:43:27',NULL,NULL);
INSERT INTO `configuration` VALUES (940,'COD Fee for Free Shipping by default','MODULE_ORDER_TOTAL_COD_FEE_FREE','US:3.00','Free by default: &lt;Country code&gt;:&lt;COD price&gt;, .... 00 as country code applies for all countries. If country code is 00, it must be the last statement. If no 00:9.99 appears, COD shipping in foreign countries is not calculated (not possible)',6,3,NULL,'2010-06-04 14:43:27',NULL,NULL);
INSERT INTO `configuration` VALUES (941,'COD Fee for Free Shipping Module - (freeshipper)','MODULE_ORDER_TOTAL_COD_FEE_FREESHIPPER','CA:4.50,US:3.00,00:9.99','Free Module: &lt;Country code&gt;:&lt;COD price&gt;, .... 00 as country code applies for all countries. If country code is 00, it must be the last statement. If no 00:9.99 appears, COD shipping in foreign countries is not calculated (not possible)',6,3,NULL,'2010-06-04 14:43:27',NULL,NULL);
INSERT INTO `configuration` VALUES (942,'COD Fee for Free-Options Shipping Module - (freeoptions)','MODULE_ORDER_TOTAL_COD_FEE_FREEOPTIONS','CA:4.50,US:3.00,00:9.99','Free+Options: &lt;Country code&gt;:&lt;COD price&gt;, .... 00 as country code applies for all countries. If country code is 00, it must be the last statement. If no 00:9.99 appears, COD shipping in foreign countries is not calculated (not possible)',6,3,NULL,'2010-06-04 14:43:27',NULL,NULL);
INSERT INTO `configuration` VALUES (943,'COD Fee for Per Weight Unit Shipping Module - (perweightunit)','MODULE_ORDER_TOTAL_COD_FEE_PERWEIGHTUNIT','CA:4.50,US:3.00,00:9.99','Per Weight Unit: &lt;Country code&gt;:&lt;COD price&gt;, .... 00 as country code applies for all countries. If country code is 00, it must be the last statement. If no 00:9.99 appears, COD shipping in foreign countries is not calculated (not possible)',6,3,NULL,'2010-06-04 14:43:27',NULL,NULL);
INSERT INTO `configuration` VALUES (944,'COD Fee for ITEM','MODULE_ORDER_TOTAL_COD_FEE_ITEM','AT:3.00,DE:3.58,00:9.99','ITEM: &lt;Country code&gt;:&lt;COD price&gt;, .... 00 as country code applies for all countries. If country code is 00, it must be the last statement. If no 00:9.99 appears, COD shipping in foreign countries is not calculated (not possible)',6,4,NULL,'2010-06-04 14:43:27',NULL,NULL);
INSERT INTO `configuration` VALUES (945,'COD Fee for TABLE','MODULE_ORDER_TOTAL_COD_FEE_TABLE','AT:3.00,DE:3.58,00:9.99','TABLE: &lt;Country code&gt;:&lt;COD price&gt;, .... 00 as country code applies for all countries. If country code is 00, it must be the last statement. If no 00:9.99 appears, COD shipping in foreign countries is not calculated (not possible)',6,5,NULL,'2010-06-04 14:43:27',NULL,NULL);
INSERT INTO `configuration` VALUES (946,'COD Fee for UPS','MODULE_ORDER_TOTAL_COD_FEE_UPS','CA:4.50,US:3.00,00:9.99','UPS: &lt;Country code&gt;:&lt;COD price&gt;, .... 00 as country code applies for all countries. If country code is 00, it must be the last statement. If no 00:9.99 appears, COD shipping in foreign countries is not calculated (not possible)',6,6,NULL,'2010-06-04 14:43:27',NULL,NULL);
INSERT INTO `configuration` VALUES (947,'COD Fee for USPS','MODULE_ORDER_TOTAL_COD_FEE_USPS','CA:4.50,US:3.00,00:9.99','USPS: &lt;Country code&gt;:&lt;COD price&gt;, .... 00 as country code applies for all countries. If country code is 00, it must be the last statement. If no 00:9.99 appears, COD shipping in foreign countries is not calculated (not possible)',6,7,NULL,'2010-06-04 14:43:27',NULL,NULL);
INSERT INTO `configuration` VALUES (948,'COD Fee for ZONES','MODULE_ORDER_TOTAL_COD_FEE_ZONES','CA:4.50,US:3.00,00:9.99','ZONES: &lt;Country code&gt;:&lt;COD price&gt;, .... 00 as country code applies for all countries. If country code is 00, it must be the last statement. If no 00:9.99 appears, COD shipping in foreign countries is not calculated (not possible)',6,8,NULL,'2010-06-04 14:43:27',NULL,NULL);
INSERT INTO `configuration` VALUES (949,'COD Fee for Austrian Post','MODULE_ORDER_TOTAL_COD_FEE_AP','AT:3.63,00:9.99','Austrian Post: &lt;Country code&gt;:&lt;COD price&gt;, .... 00 as country code applies for all countries. If country code is 00, it must be the last statement. If no 00:9.99 appears, COD shipping in foreign countries is not calculated (not possible)',6,9,NULL,'2010-06-04 14:43:27',NULL,NULL);
INSERT INTO `configuration` VALUES (950,'COD Fee for German Post','MODULE_ORDER_TOTAL_COD_FEE_DP','DE:3.58,00:9.99','German Post: &lt;Country code&gt;:&lt;COD price&gt;, .... 00 as country code applies for all countries. If country code is 00, it must be the last statement. If no 00:9.99 appears, COD shipping in foreign countries is not calculated (not possible)',6,10,NULL,'2010-06-04 14:43:27',NULL,NULL);
INSERT INTO `configuration` VALUES (951,'COD Fee for Servicepakke','MODULE_ORDER_TOTAL_COD_FEE_SERVICEPAKKE','NO:69','Servicepakke: &lt;Country code&gt;:&lt;COD price&gt;, .... 00 as country code applies for all countries. If country code is 00, it must be the last statement. If no 00:9.99 appears, COD shipping in foreign countries is not calculated (not possible)',6,11,NULL,'2010-06-04 14:43:27',NULL,NULL);
INSERT INTO `configuration` VALUES (952,'COD Fee for FedEx','MODULE_ORDER_TOTAL_COD_FEE_FEDEX','US:3.00','FedEx: &lt;Country code&gt;:&lt;COD price&gt;, .... 00 as country code applies for all countries. If country code is 00, it must be the last statement. If no 00:9.99 appears, COD shipping in foreign countries is not calculated (not possible)',6,12,NULL,'2010-06-04 14:43:27',NULL,NULL);
INSERT INTO `configuration` VALUES (953,'佐川急便の代金引換(e-コレクト)用の代引き手数料','MODULE_ORDER_TOTAL_COD_FEE_SAGAWA','00:500','e-コレクトの手数料を「国コード:手数料,国コード:手数料,...」という書式で入力してください。国コードがわかならい場合、またはすべて統一する場合は00：手数料で記してください',6,13,NULL,'2010-06-04 14:43:27',NULL,NULL);
INSERT INTO `configuration` VALUES (954,'ヤマト運輸の代金引換(ヤマトコレクト)用の代引き手数料','MODULE_ORDER_TOTAL_COD_FEE_YAMATO','00:400','ヤマトコレクトの手数料を「国コード:手数料,国コード:手数料,...」という書式で入力してください。国コードがわかならい場合、またはすべて統一する場合は00：手数料で記してください',6,14,NULL,'2010-06-04 14:43:27',NULL,NULL);
INSERT INTO `configuration` VALUES (955,'日本通運の代金引換(ペリカン集金サービス)用の代引き手数料','MODULE_ORDER_TOTAL_COD_FEE_NITTSU','00:400','ペリカン集金サービスの手数料を「国コード:手数料,国コード:手数料,...」という書式で入力してください。国コードがわかならい場合、またはすべて統一する場合は00：手数料で記してください',6,15,NULL,'2010-06-04 14:43:27',NULL,NULL);
INSERT INTO `configuration` VALUES (956,'税種別','MODULE_ORDER_TOTAL_COD_TAX_CLASS','0','代金引換手数料に適用される税種別',6,25,NULL,'2010-06-04 14:43:27','zen_get_tax_class_title','zen_cfg_pull_down_tax_classes(');
INSERT INTO `configuration` VALUES (957,'管理メニューの設定の有効化','MODULE_EASY_ADMIN_SIMPLIFY_STATUS','true','管理メニューの設定を有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2010-06-07 16:43:06',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
/*!40000 ALTER TABLE `configuration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configuration_foreach_template`
--

DROP TABLE IF EXISTS `configuration_foreach_template`;
CREATE TABLE `configuration_foreach_template` (
  `configuration_id` int(11) NOT NULL auto_increment,
  `configuration_title` text NOT NULL,
  `configuration_key` varchar(255) NOT NULL default '',
  `configuration_value` text NOT NULL,
  `configuration_description` text NOT NULL,
  `configuration_group_id` int(11) NOT NULL default '0',
  `template_dir` varchar(64) NOT NULL default '',
  `sort_order` int(5) default NULL,
  `last_modified` datetime default NULL,
  `date_added` datetime NOT NULL default '0001-01-01 00:00:00',
  `use_function` text,
  `set_function` text,
  PRIMARY KEY  (`configuration_id`),
  UNIQUE KEY `unq_config_key_zen` (`template_dir`,`configuration_key`),
  KEY `idx_key_value_zen` (`configuration_key`,`configuration_value`(10)),
  KEY `idx_cfg_grp_id_zen` (`configuration_group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=226 DEFAULT CHARSET=ujis;

--
-- Table structure for table `configuration_group`
--

DROP TABLE IF EXISTS `configuration_group`;
CREATE TABLE `configuration_group` (
  `configuration_group_id` int(11) NOT NULL auto_increment,
  `configuration_group_title` varchar(64) NOT NULL default '',
  `configuration_group_description` varchar(255) NOT NULL default '',
  `sort_order` int(5) default NULL,
  `visible` int(1) default '1',
  PRIMARY KEY  (`configuration_group_id`),
  KEY `idx_visible_zen` (`visible`)
) ENGINE=MyISAM AUTO_INCREMENT=101 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `configuration_group`
--

LOCK TABLES `configuration_group` WRITE;
/*!40000 ALTER TABLE `configuration_group` DISABLE KEYS */;
INSERT INTO `configuration_group` VALUES (1,'ショップ全般の設定','ショップの一般的な項目を設定します。',1,1);
INSERT INTO `configuration_group` VALUES (2,'最小値の設定','機能・データ類の最小(少)値について設定します。',2,1);
INSERT INTO `configuration_group` VALUES (3,'最大値の設定','機能・データ類の最大値について設定します。',3,1);
INSERT INTO `configuration_group` VALUES (4,'画像の設定','各種の画像について設定します。',4,1);
INSERT INTO `configuration_group` VALUES (5,'顧客アカウントの設定','顧客について各種の設定をします。',5,1);
INSERT INTO `configuration_group` VALUES (6,'モジュールの設定','(設定画面では隠れています)',6,0);
INSERT INTO `configuration_group` VALUES (7,'配送料・パッケージの設定','拝承料・パッケージ(梱包)について各種の設定をします。',7,1);
INSERT INTO `configuration_group` VALUES (8,'商品リストの設定','商品リストの表示について各種の設定をします。',8,1);
INSERT INTO `configuration_group` VALUES (9,'在庫の設定','在庫について各種の設定をします。',9,1);
INSERT INTO `configuration_group` VALUES (10,'ログの設定','ログについて各種の設定をします。',10,1);
INSERT INTO `configuration_group` VALUES (11,'規約関連の設定','規約について各種の設定をします。',16,1);
INSERT INTO `configuration_group` VALUES (12,'メールの設定','メールの送受信や書式について各種の設定をします。',12,1);
INSERT INTO `configuration_group` VALUES (13,'商品属性の設定','商品属性について各種の設定をします。',13,1);
INSERT INTO `configuration_group` VALUES (14,'GZip圧縮の設定','GZip圧縮について設定します。',14,1);
INSERT INTO `configuration_group` VALUES (15,'セッション管理の設定','セッション情報の管理について各種の設定をします。',15,1);
INSERT INTO `configuration_group` VALUES (16,'ギフト券・クーポン券の設定','ギフト券・クーポン券について各種の設定をします。',16,1);
INSERT INTO `configuration_group` VALUES (17,'クレジットカードの設定','クレジットカードについて各種の設定をします。',17,1);
INSERT INTO `configuration_group` VALUES (18,'商品情報の設定','商品情報の表示について各種の設定をします。',18,1);
INSERT INTO `configuration_group` VALUES (19,'レイアウトの設定','ショップの表示レイアウトについて各種の設定をします。',19,1);
INSERT INTO `configuration_group` VALUES (20,'メンテナンス表示の設定','「メンテナンス中」表示などについて各種の設定をします。',20,1);
INSERT INTO `configuration_group` VALUES (21,'新着商品リストの設定','新着商品リストについて各種の設定をします。',21,1);
INSERT INTO `configuration_group` VALUES (22,'おすすめ商品リストの設定','おすすめ商品リストについて各種の設定をします。',22,1);
INSERT INTO `configuration_group` VALUES (23,'全商品リストの設定','全商品リストについて各種の設定をします。',23,1);
INSERT INTO `configuration_group` VALUES (24,'トップページの表示設定','トップページの要素表示について各種の設定をします。',24,1);
INSERT INTO `configuration_group` VALUES (25,'定番ページの表示設定','定番ページとHTMLAreaなどについて各種の設定をします。',25,1);
INSERT INTO `configuration_group` VALUES (30,'EZ-Pagesの設定','EZページについて各種の設定をします。',30,1);
INSERT INTO `configuration_group` VALUES (100,'携帯サイトの管理','携帯サイトについて各種の設定をします。',100,1);
INSERT INTO `configuration_group` VALUES (28,'Super Orders','Settings for Super Order features',100,1);
/*!40000 ALTER TABLE `configuration_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `counter`
--

DROP TABLE IF EXISTS `counter`;
CREATE TABLE `counter` (
  `startdate` char(8) default NULL,
  `counter` int(12) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table `counter`
--

LOCK TABLES `counter` WRITE;
/*!40000 ALTER TABLE `counter` DISABLE KEYS */;
INSERT INTO `counter` VALUES ('20091119',1898);
/*!40000 ALTER TABLE `counter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `counter_history`
--

DROP TABLE IF EXISTS `counter_history`;
CREATE TABLE `counter_history` (
  `startdate` char(8) default NULL,
  `counter` int(12) default NULL,
  `session_counter` int(12) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=ujis;


--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries` (
  `countries_id` int(11) NOT NULL auto_increment,
  `countries_name` varchar(64) NOT NULL default '',
  `countries_iso_code_2` varchar(2) NOT NULL default '',
  `countries_iso_code_3` varchar(3) NOT NULL default '',
  `address_format_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`countries_id`),
  KEY `idx_countries_name_zen` (`countries_name`)
) ENGINE=MyISAM AUTO_INCREMENT=241 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (240,'Aaland Islands','AX','ALA',1);
INSERT INTO `countries` VALUES (1,'Afghanistan','AF','AFG',1);
INSERT INTO `countries` VALUES (2,'Albania','AL','ALB',1);
INSERT INTO `countries` VALUES (3,'Algeria','DZ','DZA',1);
INSERT INTO `countries` VALUES (4,'American Samoa','AS','ASM',1);
INSERT INTO `countries` VALUES (5,'Andorra','AD','AND',1);
INSERT INTO `countries` VALUES (6,'Angola','AO','AGO',1);
INSERT INTO `countries` VALUES (7,'Anguilla','AI','AIA',1);
INSERT INTO `countries` VALUES (8,'Antarctica','AQ','ATA',1);
INSERT INTO `countries` VALUES (9,'Antigua and Barbuda','AG','ATG',1);
INSERT INTO `countries` VALUES (10,'Argentina','AR','ARG',1);
INSERT INTO `countries` VALUES (11,'Armenia','AM','ARM',1);
INSERT INTO `countries` VALUES (12,'Aruba','AW','ABW',1);
INSERT INTO `countries` VALUES (13,'Australia','AU','AUS',1);
INSERT INTO `countries` VALUES (14,'Austria','AT','AUT',5);
INSERT INTO `countries` VALUES (15,'Azerbaijan','AZ','AZE',1);
INSERT INTO `countries` VALUES (16,'Bahamas','BS','BHS',1);
INSERT INTO `countries` VALUES (17,'Bahrain','BH','BHR',1);
INSERT INTO `countries` VALUES (18,'Bangladesh','BD','BGD',1);
INSERT INTO `countries` VALUES (19,'Barbados','BB','BRB',1);
INSERT INTO `countries` VALUES (20,'Belarus','BY','BLR',1);
INSERT INTO `countries` VALUES (21,'Belgium','BE','BEL',1);
INSERT INTO `countries` VALUES (22,'Belize','BZ','BLZ',1);
INSERT INTO `countries` VALUES (23,'Benin','BJ','BEN',1);
INSERT INTO `countries` VALUES (24,'Bermuda','BM','BMU',1);
INSERT INTO `countries` VALUES (25,'Bhutan','BT','BTN',1);
INSERT INTO `countries` VALUES (26,'Bolivia','BO','BOL',1);
INSERT INTO `countries` VALUES (27,'Bosnia and Herzegowina','BA','BIH',1);
INSERT INTO `countries` VALUES (28,'Botswana','BW','BWA',1);
INSERT INTO `countries` VALUES (29,'Bouvet Island','BV','BVT',1);
INSERT INTO `countries` VALUES (30,'Brazil','BR','BRA',1);
INSERT INTO `countries` VALUES (31,'British Indian Ocean Territory','IO','IOT',1);
INSERT INTO `countries` VALUES (32,'Brunei Darussalam','BN','BRN',1);
INSERT INTO `countries` VALUES (33,'Bulgaria','BG','BGR',1);
INSERT INTO `countries` VALUES (34,'Burkina Faso','BF','BFA',1);
INSERT INTO `countries` VALUES (35,'Burundi','BI','BDI',1);
INSERT INTO `countries` VALUES (36,'Cambodia','KH','KHM',1);
INSERT INTO `countries` VALUES (37,'Cameroon','CM','CMR',1);
INSERT INTO `countries` VALUES (38,'Canada','CA','CAN',1);
INSERT INTO `countries` VALUES (39,'Cape Verde','CV','CPV',1);
INSERT INTO `countries` VALUES (40,'Cayman Islands','KY','CYM',1);
INSERT INTO `countries` VALUES (41,'Central African Republic','CF','CAF',1);
INSERT INTO `countries` VALUES (42,'Chad','TD','TCD',1);
INSERT INTO `countries` VALUES (43,'Chile','CL','CHL',1);
INSERT INTO `countries` VALUES (44,'China','CN','CHN',1);
INSERT INTO `countries` VALUES (45,'Christmas Island','CX','CXR',1);
INSERT INTO `countries` VALUES (46,'Cocos (Keeling) Islands','CC','CCK',1);
INSERT INTO `countries` VALUES (47,'Colombia','CO','COL',1);
INSERT INTO `countries` VALUES (48,'Comoros','KM','COM',1);
INSERT INTO `countries` VALUES (49,'Congo','CG','COG',1);
INSERT INTO `countries` VALUES (50,'Cook Islands','CK','COK',1);
INSERT INTO `countries` VALUES (51,'Costa Rica','CR','CRI',1);
INSERT INTO `countries` VALUES (52,'Cote D\'Ivoire','CI','CIV',1);
INSERT INTO `countries` VALUES (53,'Croatia','HR','HRV',1);
INSERT INTO `countries` VALUES (54,'Cuba','CU','CUB',1);
INSERT INTO `countries` VALUES (55,'Cyprus','CY','CYP',1);
INSERT INTO `countries` VALUES (56,'Czech Republic','CZ','CZE',1);
INSERT INTO `countries` VALUES (57,'Denmark','DK','DNK',1);
INSERT INTO `countries` VALUES (58,'Djibouti','DJ','DJI',1);
INSERT INTO `countries` VALUES (59,'Dominica','DM','DMA',1);
INSERT INTO `countries` VALUES (60,'Dominican Republic','DO','DOM',1);
INSERT INTO `countries` VALUES (61,'East Timor','TP','TMP',1);
INSERT INTO `countries` VALUES (62,'Ecuador','EC','ECU',1);
INSERT INTO `countries` VALUES (63,'Egypt','EG','EGY',1);
INSERT INTO `countries` VALUES (64,'El Salvador','SV','SLV',1);
INSERT INTO `countries` VALUES (65,'Equatorial Guinea','GQ','GNQ',1);
INSERT INTO `countries` VALUES (66,'Eritrea','ER','ERI',1);
INSERT INTO `countries` VALUES (67,'Estonia','EE','EST',1);
INSERT INTO `countries` VALUES (68,'Ethiopia','ET','ETH',1);
INSERT INTO `countries` VALUES (69,'Falkland Islands (Malvinas)','FK','FLK',1);
INSERT INTO `countries` VALUES (70,'Faroe Islands','FO','FRO',1);
INSERT INTO `countries` VALUES (71,'Fiji','FJ','FJI',1);
INSERT INTO `countries` VALUES (72,'Finland','FI','FIN',1);
INSERT INTO `countries` VALUES (73,'France','FR','FRA',1);
INSERT INTO `countries` VALUES (74,'France, Metropolitan','FX','FXX',1);
INSERT INTO `countries` VALUES (75,'French Guiana','GF','GUF',1);
INSERT INTO `countries` VALUES (76,'French Polynesia','PF','PYF',1);
INSERT INTO `countries` VALUES (77,'French Southern Territories','TF','ATF',1);
INSERT INTO `countries` VALUES (78,'Gabon','GA','GAB',1);
INSERT INTO `countries` VALUES (79,'Gambia','GM','GMB',1);
INSERT INTO `countries` VALUES (80,'Georgia','GE','GEO',1);
INSERT INTO `countries` VALUES (81,'Germany','DE','DEU',5);
INSERT INTO `countries` VALUES (82,'Ghana','GH','GHA',1);
INSERT INTO `countries` VALUES (83,'Gibraltar','GI','GIB',1);
INSERT INTO `countries` VALUES (84,'Greece','GR','GRC',1);
INSERT INTO `countries` VALUES (85,'Greenland','GL','GRL',1);
INSERT INTO `countries` VALUES (86,'Grenada','GD','GRD',1);
INSERT INTO `countries` VALUES (87,'Guadeloupe','GP','GLP',1);
INSERT INTO `countries` VALUES (88,'Guam','GU','GUM',1);
INSERT INTO `countries` VALUES (89,'Guatemala','GT','GTM',1);
INSERT INTO `countries` VALUES (90,'Guinea','GN','GIN',1);
INSERT INTO `countries` VALUES (91,'Guinea-bissau','GW','GNB',1);
INSERT INTO `countries` VALUES (92,'Guyana','GY','GUY',1);
INSERT INTO `countries` VALUES (93,'Haiti','HT','HTI',1);
INSERT INTO `countries` VALUES (94,'Heard and Mc Donald Islands','HM','HMD',1);
INSERT INTO `countries` VALUES (95,'Honduras','HN','HND',1);
INSERT INTO `countries` VALUES (96,'Hong Kong','HK','HKG',1);
INSERT INTO `countries` VALUES (97,'Hungary','HU','HUN',1);
INSERT INTO `countries` VALUES (98,'Iceland','IS','ISL',1);
INSERT INTO `countries` VALUES (99,'India','IN','IND',1);
INSERT INTO `countries` VALUES (100,'Indonesia','ID','IDN',1);
INSERT INTO `countries` VALUES (101,'Iran (Islamic Republic of)','IR','IRN',1);
INSERT INTO `countries` VALUES (102,'Iraq','IQ','IRQ',1);
INSERT INTO `countries` VALUES (103,'Ireland','IE','IRL',1);
INSERT INTO `countries` VALUES (104,'Israel','IL','ISR',1);
INSERT INTO `countries` VALUES (105,'Italy','IT','ITA',1);
INSERT INTO `countries` VALUES (106,'Jamaica','JM','JAM',1);
INSERT INTO `countries` VALUES (107,'Japan','JP','JPN',6);
INSERT INTO `countries` VALUES (108,'Jordan','JO','JOR',1);
INSERT INTO `countries` VALUES (109,'Kazakhstan','KZ','KAZ',1);
INSERT INTO `countries` VALUES (110,'Kenya','KE','KEN',1);
INSERT INTO `countries` VALUES (111,'Kiribati','KI','KIR',1);
INSERT INTO `countries` VALUES (112,'Korea, Democratic People\'s Republic of','KP','PRK',1);
INSERT INTO `countries` VALUES (113,'Korea, Republic of','KR','KOR',1);
INSERT INTO `countries` VALUES (114,'Kuwait','KW','KWT',1);
INSERT INTO `countries` VALUES (115,'Kyrgyzstan','KG','KGZ',1);
INSERT INTO `countries` VALUES (116,'Lao People\'s Democratic Republic','LA','LAO',1);
INSERT INTO `countries` VALUES (117,'Latvia','LV','LVA',1);
INSERT INTO `countries` VALUES (118,'Lebanon','LB','LBN',1);
INSERT INTO `countries` VALUES (119,'Lesotho','LS','LSO',1);
INSERT INTO `countries` VALUES (120,'Liberia','LR','LBR',1);
INSERT INTO `countries` VALUES (121,'Libyan Arab Jamahiriya','LY','LBY',1);
INSERT INTO `countries` VALUES (122,'Liechtenstein','LI','LIE',1);
INSERT INTO `countries` VALUES (123,'Lithuania','LT','LTU',1);
INSERT INTO `countries` VALUES (124,'Luxembourg','LU','LUX',1);
INSERT INTO `countries` VALUES (125,'Macau','MO','MAC',1);
INSERT INTO `countries` VALUES (126,'Macedonia, The Former Yugoslav Republic of','MK','MKD',1);
INSERT INTO `countries` VALUES (127,'Madagascar','MG','MDG',1);
INSERT INTO `countries` VALUES (128,'Malawi','MW','MWI',1);
INSERT INTO `countries` VALUES (129,'Malaysia','MY','MYS',1);
INSERT INTO `countries` VALUES (130,'Maldives','MV','MDV',1);
INSERT INTO `countries` VALUES (131,'Mali','ML','MLI',1);
INSERT INTO `countries` VALUES (132,'Malta','MT','MLT',1);
INSERT INTO `countries` VALUES (133,'Marshall Islands','MH','MHL',1);
INSERT INTO `countries` VALUES (134,'Martinique','MQ','MTQ',1);
INSERT INTO `countries` VALUES (135,'Mauritania','MR','MRT',1);
INSERT INTO `countries` VALUES (136,'Mauritius','MU','MUS',1);
INSERT INTO `countries` VALUES (137,'Mayotte','YT','MYT',1);
INSERT INTO `countries` VALUES (138,'Mexico','MX','MEX',1);
INSERT INTO `countries` VALUES (139,'Micronesia, Federated States of','FM','FSM',1);
INSERT INTO `countries` VALUES (140,'Moldova, Republic of','MD','MDA',1);
INSERT INTO `countries` VALUES (141,'Monaco','MC','MCO',1);
INSERT INTO `countries` VALUES (142,'Mongolia','MN','MNG',1);
INSERT INTO `countries` VALUES (143,'Montserrat','MS','MSR',1);
INSERT INTO `countries` VALUES (144,'Morocco','MA','MAR',1);
INSERT INTO `countries` VALUES (145,'Mozambique','MZ','MOZ',1);
INSERT INTO `countries` VALUES (146,'Myanmar','MM','MMR',1);
INSERT INTO `countries` VALUES (147,'Namibia','NA','NAM',1);
INSERT INTO `countries` VALUES (148,'Nauru','NR','NRU',1);
INSERT INTO `countries` VALUES (149,'Nepal','NP','NPL',1);
INSERT INTO `countries` VALUES (150,'Netherlands','NL','NLD',1);
INSERT INTO `countries` VALUES (151,'Netherlands Antilles','AN','ANT',1);
INSERT INTO `countries` VALUES (152,'New Caledonia','NC','NCL',1);
INSERT INTO `countries` VALUES (153,'New Zealand','NZ','NZL',1);
INSERT INTO `countries` VALUES (154,'Nicaragua','NI','NIC',1);
INSERT INTO `countries` VALUES (155,'Niger','NE','NER',1);
INSERT INTO `countries` VALUES (156,'Nigeria','NG','NGA',1);
INSERT INTO `countries` VALUES (157,'Niue','NU','NIU',1);
INSERT INTO `countries` VALUES (158,'Norfolk Island','NF','NFK',1);
INSERT INTO `countries` VALUES (159,'Northern Mariana Islands','MP','MNP',1);
INSERT INTO `countries` VALUES (160,'Norway','NO','NOR',1);
INSERT INTO `countries` VALUES (161,'Oman','OM','OMN',1);
INSERT INTO `countries` VALUES (162,'Pakistan','PK','PAK',1);
INSERT INTO `countries` VALUES (163,'Palau','PW','PLW',1);
INSERT INTO `countries` VALUES (164,'Panama','PA','PAN',1);
INSERT INTO `countries` VALUES (165,'Papua New Guinea','PG','PNG',1);
INSERT INTO `countries` VALUES (166,'Paraguay','PY','PRY',1);
INSERT INTO `countries` VALUES (167,'Peru','PE','PER',1);
INSERT INTO `countries` VALUES (168,'Philippines','PH','PHL',1);
INSERT INTO `countries` VALUES (169,'Pitcairn','PN','PCN',1);
INSERT INTO `countries` VALUES (170,'Poland','PL','POL',1);
INSERT INTO `countries` VALUES (171,'Portugal','PT','PRT',1);
INSERT INTO `countries` VALUES (172,'Puerto Rico','PR','PRI',1);
INSERT INTO `countries` VALUES (173,'Qatar','QA','QAT',1);
INSERT INTO `countries` VALUES (174,'Reunion','RE','REU',1);
INSERT INTO `countries` VALUES (175,'Romania','RO','ROM',1);
INSERT INTO `countries` VALUES (176,'Russian Federation','RU','RUS',1);
INSERT INTO `countries` VALUES (177,'Rwanda','RW','RWA',1);
INSERT INTO `countries` VALUES (178,'Saint Kitts and Nevis','KN','KNA',1);
INSERT INTO `countries` VALUES (179,'Saint Lucia','LC','LCA',1);
INSERT INTO `countries` VALUES (180,'Saint Vincent and the Grenadines','VC','VCT',1);
INSERT INTO `countries` VALUES (181,'Samoa','WS','WSM',1);
INSERT INTO `countries` VALUES (182,'San Marino','SM','SMR',1);
INSERT INTO `countries` VALUES (183,'Sao Tome and Principe','ST','STP',1);
INSERT INTO `countries` VALUES (184,'Saudi Arabia','SA','SAU',1);
INSERT INTO `countries` VALUES (185,'Senegal','SN','SEN',1);
INSERT INTO `countries` VALUES (186,'Seychelles','SC','SYC',1);
INSERT INTO `countries` VALUES (187,'Sierra Leone','SL','SLE',1);
INSERT INTO `countries` VALUES (188,'Singapore','SG','SGP',4);
INSERT INTO `countries` VALUES (189,'Slovakia (Slovak Republic)','SK','SVK',1);
INSERT INTO `countries` VALUES (190,'Slovenia','SI','SVN',1);
INSERT INTO `countries` VALUES (191,'Solomon Islands','SB','SLB',1);
INSERT INTO `countries` VALUES (192,'Somalia','SO','SOM',1);
INSERT INTO `countries` VALUES (193,'South Africa','ZA','ZAF',1);
INSERT INTO `countries` VALUES (194,'South Georgia and the South Sandwich Islands','GS','SGS',1);
INSERT INTO `countries` VALUES (195,'Spain','ES','ESP',3);
INSERT INTO `countries` VALUES (196,'Sri Lanka','LK','LKA',1);
INSERT INTO `countries` VALUES (197,'St. Helena','SH','SHN',1);
INSERT INTO `countries` VALUES (198,'St. Pierre and Miquelon','PM','SPM',1);
INSERT INTO `countries` VALUES (199,'Sudan','SD','SDN',1);
INSERT INTO `countries` VALUES (200,'Suriname','SR','SUR',1);
INSERT INTO `countries` VALUES (201,'Svalbard and Jan Mayen Islands','SJ','SJM',1);
INSERT INTO `countries` VALUES (202,'Swaziland','SZ','SWZ',1);
INSERT INTO `countries` VALUES (203,'Sweden','SE','SWE',1);
INSERT INTO `countries` VALUES (204,'Switzerland','CH','CHE',1);
INSERT INTO `countries` VALUES (205,'Syrian Arab Republic','SY','SYR',1);
INSERT INTO `countries` VALUES (206,'Taiwan','TW','TWN',1);
INSERT INTO `countries` VALUES (207,'Tajikistan','TJ','TJK',1);
INSERT INTO `countries` VALUES (208,'Tanzania, United Republic of','TZ','TZA',1);
INSERT INTO `countries` VALUES (209,'Thailand','TH','THA',1);
INSERT INTO `countries` VALUES (210,'Togo','TG','TGO',1);
INSERT INTO `countries` VALUES (211,'Tokelau','TK','TKL',1);
INSERT INTO `countries` VALUES (212,'Tonga','TO','TON',1);
INSERT INTO `countries` VALUES (213,'Trinidad and Tobago','TT','TTO',1);
INSERT INTO `countries` VALUES (214,'Tunisia','TN','TUN',1);
INSERT INTO `countries` VALUES (215,'Turkey','TR','TUR',1);
INSERT INTO `countries` VALUES (216,'Turkmenistan','TM','TKM',1);
INSERT INTO `countries` VALUES (217,'Turks and Caicos Islands','TC','TCA',1);
INSERT INTO `countries` VALUES (218,'Tuvalu','TV','TUV',1);
INSERT INTO `countries` VALUES (219,'Uganda','UG','UGA',1);
INSERT INTO `countries` VALUES (220,'Ukraine','UA','UKR',1);
INSERT INTO `countries` VALUES (221,'United Arab Emirates','AE','ARE',1);
INSERT INTO `countries` VALUES (222,'United Kingdom','GB','GBR',1);
INSERT INTO `countries` VALUES (223,'United States','US','USA',2);
INSERT INTO `countries` VALUES (224,'United States Minor Outlying Islands','UM','UMI',1);
INSERT INTO `countries` VALUES (225,'Uruguay','UY','URY',1);
INSERT INTO `countries` VALUES (226,'Uzbekistan','UZ','UZB',1);
INSERT INTO `countries` VALUES (227,'Vanuatu','VU','VUT',1);
INSERT INTO `countries` VALUES (228,'Vatican City State (Holy See)','VA','VAT',1);
INSERT INTO `countries` VALUES (229,'Venezuela','VE','VEN',1);
INSERT INTO `countries` VALUES (230,'Viet Nam','VN','VNM',1);
INSERT INTO `countries` VALUES (231,'Virgin Islands (British)','VG','VGB',1);
INSERT INTO `countries` VALUES (232,'Virgin Islands (U.S.)','VI','VIR',1);
INSERT INTO `countries` VALUES (233,'Wallis and Futuna Islands','WF','WLF',1);
INSERT INTO `countries` VALUES (234,'Western Sahara','EH','ESH',1);
INSERT INTO `countries` VALUES (235,'Yemen','YE','YEM',1);
INSERT INTO `countries` VALUES (236,'Yugoslavia','YU','YUG',1);
INSERT INTO `countries` VALUES (237,'Zaire','ZR','ZAR',1);
INSERT INTO `countries` VALUES (238,'Zambia','ZM','ZMB',1);
INSERT INTO `countries` VALUES (239,'Zimbabwe','ZW','ZWE',1);
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupon_email_track`
--

DROP TABLE IF EXISTS `coupon_email_track`;
CREATE TABLE `coupon_email_track` (
  `unique_id` int(11) NOT NULL auto_increment,
  `coupon_id` int(11) NOT NULL default '0',
  `customer_id_sent` int(11) NOT NULL default '0',
  `sent_firstname` varchar(32) default NULL,
  `sent_lastname` varchar(32) default NULL,
  `emailed_to` varchar(32) default NULL,
  `date_sent` datetime NOT NULL default '0001-01-01 00:00:00',
  PRIMARY KEY  (`unique_id`),
  KEY `idx_coupon_id_zen` (`coupon_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=ujis;

--
-- Table structure for table `coupon_gv_customer`
--

DROP TABLE IF EXISTS `coupon_gv_customer`;
CREATE TABLE `coupon_gv_customer` (
  `customer_id` int(5) NOT NULL default '0',
  `amount` decimal(20,4) NOT NULL default '0.0000',
  PRIMARY KEY  (`customer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Table structure for table `coupon_gv_queue`
--

DROP TABLE IF EXISTS `coupon_gv_queue`;
CREATE TABLE `coupon_gv_queue` (
  `unique_id` int(5) NOT NULL auto_increment,
  `customer_id` int(5) NOT NULL default '0',
  `order_id` int(5) NOT NULL default '0',
  `amount` decimal(20,4) NOT NULL default '0.0000',
  `date_created` datetime NOT NULL default '0001-01-01 00:00:00',
  `ipaddr` varchar(32) NOT NULL default '',
  `release_flag` char(1) NOT NULL default 'N',
  PRIMARY KEY  (`unique_id`),
  KEY `idx_cust_id_order_id_zen` (`customer_id`,`order_id`),
  KEY `idx_release_flag_zen` (`release_flag`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table `coupon_gv_queue`
--

LOCK TABLES `coupon_gv_queue` WRITE;
/*!40000 ALTER TABLE `coupon_gv_queue` DISABLE KEYS */;
/*!40000 ALTER TABLE `coupon_gv_queue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupon_redeem_track`
--

DROP TABLE IF EXISTS `coupon_redeem_track`;
CREATE TABLE `coupon_redeem_track` (
  `unique_id` int(11) NOT NULL auto_increment,
  `coupon_id` int(11) NOT NULL default '0',
  `customer_id` int(11) NOT NULL default '0',
  `redeem_date` datetime NOT NULL default '0001-01-01 00:00:00',
  `redeem_ip` varchar(32) NOT NULL default '',
  `order_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`unique_id`),
  KEY `idx_coupon_id_zen` (`coupon_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=ujis;

--
-- Table structure for table `coupon_restrict`
--

DROP TABLE IF EXISTS `coupon_restrict`;
CREATE TABLE `coupon_restrict` (
  `restrict_id` int(11) NOT NULL auto_increment,
  `coupon_id` int(11) NOT NULL default '0',
  `product_id` int(11) NOT NULL default '0',
  `category_id` int(11) NOT NULL default '0',
  `coupon_restrict` char(1) NOT NULL default 'N',
  PRIMARY KEY  (`restrict_id`),
  KEY `idx_coup_id_prod_id_zen` (`coupon_id`,`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table `coupon_restrict`
--

LOCK TABLES `coupon_restrict` WRITE;
/*!40000 ALTER TABLE `coupon_restrict` DISABLE KEYS */;
/*!40000 ALTER TABLE `coupon_restrict` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
CREATE TABLE `coupons` (
  `coupon_id` int(11) NOT NULL auto_increment,
  `coupon_type` char(1) NOT NULL default 'F',
  `coupon_code` varchar(32) NOT NULL default '',
  `coupon_amount` decimal(8,4) NOT NULL default '0.0000',
  `coupon_minimum_order` decimal(8,4) NOT NULL default '0.0000',
  `coupon_start_date` datetime NOT NULL default '0001-01-01 00:00:00',
  `coupon_expire_date` datetime NOT NULL default '0001-01-01 00:00:00',
  `uses_per_coupon` int(5) NOT NULL default '1',
  `uses_per_user` int(5) NOT NULL default '0',
  `restrict_to_products` varchar(255) default NULL,
  `restrict_to_categories` varchar(255) default NULL,
  `restrict_to_customers` text,
  `coupon_active` char(1) NOT NULL default 'Y',
  `date_created` datetime NOT NULL default '0001-01-01 00:00:00',
  `date_modified` datetime NOT NULL default '0001-01-01 00:00:00',
  PRIMARY KEY  (`coupon_id`),
  KEY `idx_active_type_zen` (`coupon_active`,`coupon_type`),
  KEY `idx_coupon_code_zen` (`coupon_code`),
  KEY `idx_coupon_type_zen` (`coupon_type`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=ujis;

--
-- Table structure for table `coupons_description`
--

DROP TABLE IF EXISTS `coupons_description`;
CREATE TABLE `coupons_description` (
  `coupon_id` int(11) NOT NULL default '0',
  `language_id` int(11) NOT NULL default '0',
  `coupon_name` varchar(32) NOT NULL default '',
  `coupon_description` text,
  PRIMARY KEY  (`coupon_id`,`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Table structure for table `csv_columns`
--

DROP TABLE IF EXISTS `csv_columns`;
CREATE TABLE `csv_columns` (
  `csv_column_id` int(11) NOT NULL auto_increment,
  `csv_format_type_id` int(11) default NULL,
  `csv_column_name` varchar(255) default NULL,
  `csv_column_validate_function` text,
  `csv_columns_dbtable` varchar(255) default NULL,
  `csv_columns_dbcolumn` varchar(255) default NULL,
  PRIMARY KEY  (`csv_column_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3115 DEFAULT CHARSET=ujis;

--
-- Table structure for table `csv_format_columns`
--

DROP TABLE IF EXISTS `csv_format_columns`;
CREATE TABLE `csv_format_columns` (
  `csv_format_column_id` int(11) NOT NULL auto_increment,
  `csv_format_id` int(11) default NULL,
  `csv_column_id` int(11) default NULL,
  `csv_format_column_number` int(11) default NULL,
  PRIMARY KEY  (`csv_format_column_id`),
  KEY `idx_csv_format_columns_zen` (`csv_format_id`,`csv_format_column_number`,`csv_column_id`)
) ENGINE=MyISAM AUTO_INCREMENT=96 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `csv_format_columns`
--

LOCK TABLES `csv_format_columns` WRITE;
/*!40000 ALTER TABLE `csv_format_columns` DISABLE KEYS */;
INSERT INTO `csv_format_columns` VALUES (1,1,1001,1);
INSERT INTO `csv_format_columns` VALUES (2,1,1002,2);
INSERT INTO `csv_format_columns` VALUES (3,1,1003,3);
INSERT INTO `csv_format_columns` VALUES (4,1,1004,4);
INSERT INTO `csv_format_columns` VALUES (5,1,1005,5);
INSERT INTO `csv_format_columns` VALUES (6,1,1006,6);
INSERT INTO `csv_format_columns` VALUES (7,1,1007,7);
INSERT INTO `csv_format_columns` VALUES (8,1,1008,8);
INSERT INTO `csv_format_columns` VALUES (9,1,1009,9);
INSERT INTO `csv_format_columns` VALUES (10,1,1010,10);
INSERT INTO `csv_format_columns` VALUES (11,1,1011,11);
INSERT INTO `csv_format_columns` VALUES (12,1,1012,12);
INSERT INTO `csv_format_columns` VALUES (13,1,1013,13);
INSERT INTO `csv_format_columns` VALUES (14,1,1014,14);
INSERT INTO `csv_format_columns` VALUES (15,1,1015,15);
INSERT INTO `csv_format_columns` VALUES (16,1,1016,16);
INSERT INTO `csv_format_columns` VALUES (17,1,1017,17);
INSERT INTO `csv_format_columns` VALUES (18,1,1018,18);
INSERT INTO `csv_format_columns` VALUES (19,1,1019,19);
INSERT INTO `csv_format_columns` VALUES (20,1,1020,20);
INSERT INTO `csv_format_columns` VALUES (21,1,1021,21);
INSERT INTO `csv_format_columns` VALUES (22,1,1022,22);
INSERT INTO `csv_format_columns` VALUES (23,1,1023,23);
INSERT INTO `csv_format_columns` VALUES (24,1,1100,24);
INSERT INTO `csv_format_columns` VALUES (25,1,1101,25);
INSERT INTO `csv_format_columns` VALUES (26,1,1200,26);
INSERT INTO `csv_format_columns` VALUES (27,1,1201,27);
INSERT INTO `csv_format_columns` VALUES (28,1,1300,28);
INSERT INTO `csv_format_columns` VALUES (29,1,1301,29);
INSERT INTO `csv_format_columns` VALUES (30,1,1400,30);
INSERT INTO `csv_format_columns` VALUES (31,1,1401,31);
INSERT INTO `csv_format_columns` VALUES (32,1,1500,32);
INSERT INTO `csv_format_columns` VALUES (33,1,1501,33);
INSERT INTO `csv_format_columns` VALUES (34,1,1600,34);
INSERT INTO `csv_format_columns` VALUES (35,1,1601,35);
INSERT INTO `csv_format_columns` VALUES (36,1,1700,36);
INSERT INTO `csv_format_columns` VALUES (37,1,1701,37);
INSERT INTO `csv_format_columns` VALUES (38,1,1702,38);
INSERT INTO `csv_format_columns` VALUES (39,1,1703,39);
INSERT INTO `csv_format_columns` VALUES (40,1,1704,40);
INSERT INTO `csv_format_columns` VALUES (41,1,1706,41);
INSERT INTO `csv_format_columns` VALUES (42,1,1707,42);
INSERT INTO `csv_format_columns` VALUES (43,2,2000,1);
INSERT INTO `csv_format_columns` VALUES (44,2,2001,2);
INSERT INTO `csv_format_columns` VALUES (45,2,2050,3);
INSERT INTO `csv_format_columns` VALUES (46,2,2051,4);
INSERT INTO `csv_format_columns` VALUES (47,2,2100,5);
INSERT INTO `csv_format_columns` VALUES (48,2,2101,6);
INSERT INTO `csv_format_columns` VALUES (49,2,2150,7);
INSERT INTO `csv_format_columns` VALUES (50,2,2151,8);
INSERT INTO `csv_format_columns` VALUES (51,2,2200,9);
INSERT INTO `csv_format_columns` VALUES (52,2,2201,10);
INSERT INTO `csv_format_columns` VALUES (53,2,2250,11);
INSERT INTO `csv_format_columns` VALUES (54,2,2251,12);
INSERT INTO `csv_format_columns` VALUES (55,2,2300,13);
INSERT INTO `csv_format_columns` VALUES (56,2,2301,14);
INSERT INTO `csv_format_columns` VALUES (57,2,2350,15);
INSERT INTO `csv_format_columns` VALUES (58,2,2351,16);
INSERT INTO `csv_format_columns` VALUES (59,2,2400,17);
INSERT INTO `csv_format_columns` VALUES (60,2,2401,18);
INSERT INTO `csv_format_columns` VALUES (61,2,2450,19);
INSERT INTO `csv_format_columns` VALUES (62,2,2451,20);
INSERT INTO `csv_format_columns` VALUES (63,2,2500,21);
INSERT INTO `csv_format_columns` VALUES (64,2,2501,22);
INSERT INTO `csv_format_columns` VALUES (65,2,2600,23);
INSERT INTO `csv_format_columns` VALUES (66,2,2601,24);
INSERT INTO `csv_format_columns` VALUES (67,2,2602,25);
INSERT INTO `csv_format_columns` VALUES (68,2,2603,26);
INSERT INTO `csv_format_columns` VALUES (69,2,2650,27);
INSERT INTO `csv_format_columns` VALUES (70,2,2651,28);
INSERT INTO `csv_format_columns` VALUES (71,2,2700,29);
INSERT INTO `csv_format_columns` VALUES (72,2,2701,30);
INSERT INTO `csv_format_columns` VALUES (73,2,2750,31);
INSERT INTO `csv_format_columns` VALUES (74,2,2751,32);
INSERT INTO `csv_format_columns` VALUES (75,2,2800,33);
INSERT INTO `csv_format_columns` VALUES (76,2,2801,34);
INSERT INTO `csv_format_columns` VALUES (77,3,3000,1);
INSERT INTO `csv_format_columns` VALUES (78,3,3001,2);
INSERT INTO `csv_format_columns` VALUES (79,3,3050,3);
INSERT INTO `csv_format_columns` VALUES (80,3,3051,4);
INSERT INTO `csv_format_columns` VALUES (81,3,3100,5);
INSERT INTO `csv_format_columns` VALUES (82,3,3101,6);
INSERT INTO `csv_format_columns` VALUES (83,3,3102,7);
INSERT INTO `csv_format_columns` VALUES (84,3,3103,8);
INSERT INTO `csv_format_columns` VALUES (85,3,3104,9);
INSERT INTO `csv_format_columns` VALUES (86,3,3105,10);
INSERT INTO `csv_format_columns` VALUES (87,3,3106,11);
INSERT INTO `csv_format_columns` VALUES (88,3,3107,12);
INSERT INTO `csv_format_columns` VALUES (89,3,3108,13);
INSERT INTO `csv_format_columns` VALUES (90,3,3109,14);
INSERT INTO `csv_format_columns` VALUES (91,3,3110,15);
INSERT INTO `csv_format_columns` VALUES (92,3,3111,16);
INSERT INTO `csv_format_columns` VALUES (93,3,3112,17);
INSERT INTO `csv_format_columns` VALUES (94,3,3113,18);
INSERT INTO `csv_format_columns` VALUES (95,3,3114,19);
/*!40000 ALTER TABLE `csv_format_columns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `csv_format_types`
--

DROP TABLE IF EXISTS `csv_format_types`;
CREATE TABLE `csv_format_types` (
  `csv_format_type_id` int(11) NOT NULL auto_increment,
  `csv_format_type_name` varchar(255) default NULL,
  PRIMARY KEY  (`csv_format_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `csv_format_types`
--

LOCK TABLES `csv_format_types` WRITE;
/*!40000 ALTER TABLE `csv_format_types` DISABLE KEYS */;
INSERT INTO `csv_format_types` VALUES (1,'商品マスタ');
INSERT INTO `csv_format_types` VALUES (2,'商品カテゴリ');
INSERT INTO `csv_format_types` VALUES (3,'商品オプション');
/*!40000 ALTER TABLE `csv_format_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `csv_formats`
--

DROP TABLE IF EXISTS `csv_formats`;
CREATE TABLE `csv_formats` (
  `csv_format_id` int(11) NOT NULL auto_increment,
  `csv_format_type_id` int(11) default NULL,
  `csv_format_name` varchar(255) default NULL,
  `csv_format_date_added` datetime default NULL,
  `csv_format_last_modified` datetime default NULL,
  PRIMARY KEY  (`csv_format_id`),
  KEY `idx_format_name_zen` (`csv_format_name`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `csv_formats`
--

LOCK TABLES `csv_formats` WRITE;
/*!40000 ALTER TABLE `csv_formats` DISABLE KEYS */;
INSERT INTO `csv_formats` VALUES (1,1,'商品マスタ(全て)','2009-11-19 13:04:30','2009-11-19 13:04:30');
INSERT INTO `csv_formats` VALUES (2,2,'商品カテゴリ(全て)','2009-11-19 13:04:30','2009-11-19 13:04:30');
INSERT INTO `csv_formats` VALUES (3,3,'商品オプション(全て)','2009-11-19 13:04:30','2009-11-19 13:04:30');
/*!40000 ALTER TABLE `csv_formats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `currencies`
--

DROP TABLE IF EXISTS `currencies`;
CREATE TABLE `currencies` (
  `currencies_id` int(11) NOT NULL auto_increment,
  `title` varchar(32) NOT NULL default '',
  `code` varchar(3) NOT NULL default '',
  `symbol_left` varchar(24) default NULL,
  `symbol_right` varchar(24) default NULL,
  `decimal_point` char(1) default NULL,
  `thousands_point` char(1) default NULL,
  `decimal_places` char(1) default NULL,
  `value` float(13,8) default NULL,
  `last_updated` datetime default NULL,
  PRIMARY KEY  (`currencies_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `currencies`
--

LOCK TABLES `currencies` WRITE;
/*!40000 ALTER TABLE `currencies` DISABLE KEYS */;
INSERT INTO `currencies` VALUES (1,'US Dollar','USD','$','','.',',','2',0.00936500,'2009-11-19 12:39:40');
INSERT INTO `currencies` VALUES (2,'Euro','EUR','','EUR','.',',','2',0.00759400,'2009-11-19 12:39:40');
INSERT INTO `currencies` VALUES (3,'Japanese Yen','JPY','','円','.',',','',1.00000000,'2009-11-19 12:39:40');
/*!40000 ALTER TABLE `currencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `currencies_m17n`
--

DROP TABLE IF EXISTS `currencies_m17n`;
CREATE TABLE `currencies_m17n` (
  `currencies_id` int(11) NOT NULL default '0',
  `language_id` int(11) NOT NULL default '0',
  `symbol_left` varchar(24) default NULL,
  `symbol_right` varchar(24) default NULL,
  PRIMARY KEY  (`currencies_id`,`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table `currencies_m17n`
--

LOCK TABLES `currencies_m17n` WRITE;
/*!40000 ALTER TABLE `currencies_m17n` DISABLE KEYS */;
INSERT INTO `currencies_m17n` VALUES (1,1,'$','');
INSERT INTO `currencies_m17n` VALUES (2,1,'','EUR');
INSERT INTO `currencies_m17n` VALUES (3,1,'','円');
INSERT INTO `currencies_m17n` VALUES (1,2,'$','');
INSERT INTO `currencies_m17n` VALUES (2,2,'','EUR');
INSERT INTO `currencies_m17n` VALUES (3,2,'','円');
INSERT INTO `currencies_m17n` VALUES (3,9,'','円');
INSERT INTO `currencies_m17n` VALUES (2,9,'','EUR');
INSERT INTO `currencies_m17n` VALUES (1,9,'$','');
/*!40000 ALTER TABLE `currencies_m17n` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `customers_id` int(11) NOT NULL auto_increment,
  `customers_gender` char(1) NOT NULL default '',
  `customers_firstname` varchar(32) NOT NULL default '',
  `customers_lastname` varchar(32) NOT NULL default '',
  `customers_dob` datetime NOT NULL default '0001-01-01 00:00:00',
  `customers_email_address` varchar(96) NOT NULL default '',
  `customers_nick` varchar(96) NOT NULL default '',
  `customers_default_address_id` int(11) NOT NULL default '0',
  `customers_telephone` varchar(32) default NULL,
  `customers_fax` varchar(32) default NULL,
  `customers_password` varchar(40) NOT NULL default '',
  `customers_newsletter` char(1) default NULL,
  `customers_group_pricing` int(11) NOT NULL default '0',
  `customers_email_format` varchar(4) NOT NULL default 'TEXT',
  `customers_authorization` int(1) NOT NULL default '0',
  `customers_referral` varchar(32) NOT NULL default '',
  `customers_firstname_kana` varchar(32) NOT NULL default '',
  `customers_lastname_kana` varchar(32) NOT NULL default '',
  `customers_mobile_serial_number` varchar(64) default NULL,
  `customers_languages_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`customers_id`),
  KEY `idx_email_address_zen` (`customers_email_address`),
  KEY `idx_referral_zen` (`customers_referral`(10)),
  KEY `idx_grp_pricing_zen` (`customers_group_pricing`),
  KEY `idx_nick_zen` (`customers_nick`),
  KEY `idx_newsletter_zen` (`customers_newsletter`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (16,'f','菱田','好美','2000-02-29 00:00:00','hishida@ark-web.jp','',17,'0133-66-9874','0133-66-9874','45fce7b547900a2e40bee673a4ecea37:f3','0',0,'',0,'','ひしだ','よしみ',NULL,2);
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers_admin_notes`
--

DROP TABLE IF EXISTS `customers_admin_notes`;
CREATE TABLE `customers_admin_notes` (
  `admin_notes_id` int(12) NOT NULL auto_increment,
  `customers_id` int(11) NOT NULL default '0',
  `date_added` datetime NOT NULL default '0000-00-00 00:00:00',
  `admin_id` int(11) NOT NULL default '0',
  `admin_notes` text NOT NULL,
  `rating` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`admin_notes_id`),
  KEY `customers_id` (`customers_id`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Table structure for table `customers_basket`
--

DROP TABLE IF EXISTS `customers_basket`;
CREATE TABLE `customers_basket` (
  `customers_basket_id` int(11) NOT NULL auto_increment,
  `customers_id` int(11) NOT NULL default '0',
  `products_id` tinytext NOT NULL,
  `customers_basket_quantity` float NOT NULL default '0',
  `final_price` decimal(15,4) NOT NULL default '0.0000',
  `customers_basket_date_added` varchar(8) default NULL,
  PRIMARY KEY  (`customers_basket_id`),
  KEY `idx_customers_id_zen` (`customers_id`)
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=ujis;

--
-- Table structure for table `customers_basket_attributes`
--

DROP TABLE IF EXISTS `customers_basket_attributes`;
CREATE TABLE `customers_basket_attributes` (
  `customers_basket_attributes_id` int(11) NOT NULL auto_increment,
  `customers_id` int(11) NOT NULL default '0',
  `products_id` tinytext NOT NULL,
  `products_options_id` varchar(64) NOT NULL default '0',
  `products_options_value_id` int(11) NOT NULL default '0',
  `products_options_value_text` blob,
  `products_options_sort_order` text NOT NULL,
  PRIMARY KEY  (`customers_basket_attributes_id`),
  KEY `idx_cust_id_prod_id_zen` (`customers_id`,`products_id`(36))
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=ujis;

--
-- Table structure for table `customers_info`
--

DROP TABLE IF EXISTS `customers_info`;
CREATE TABLE `customers_info` (
  `customers_info_id` int(11) NOT NULL default '0',
  `customers_info_date_of_last_logon` datetime default NULL,
  `customers_info_number_of_logons` int(5) default NULL,
  `customers_info_date_account_created` datetime default NULL,
  `customers_info_date_account_last_modified` datetime default NULL,
  `global_product_notifications` int(1) default '0',
  PRIMARY KEY  (`customers_info_id`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table `customers_info`
--

LOCK TABLES `customers_info` WRITE;
/*!40000 ALTER TABLE `customers_info` DISABLE KEYS */;
INSERT INTO `customers_info` VALUES (16,'2010-07-20 14:23:41',4,'2010-07-16 16:39:59',NULL,0);
/*!40000 ALTER TABLE `customers_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers_point_rate`
--

DROP TABLE IF EXISTS `customers_point_rate`;
CREATE TABLE `customers_point_rate` (
  `customers_id` int(11) NOT NULL default '0',
  `rate` int(11) NOT NULL default '0',
  PRIMARY KEY  (`customers_id`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table `customers_point_rate`
--

LOCK TABLES `customers_point_rate` WRITE;
/*!40000 ALTER TABLE `customers_point_rate` DISABLE KEYS */;
/*!40000 ALTER TABLE `customers_point_rate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers_points`
--

DROP TABLE IF EXISTS `customers_points`;
CREATE TABLE `customers_points` (
  `customers_id` int(11) NOT NULL default '0',
  `deposit` int(11) NOT NULL default '0',
  `pending` int(11) NOT NULL default '0',
  `updated_at` datetime default NULL,
  PRIMARY KEY  (`customers_id`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Table structure for table `customers_wishlist`
--

DROP TABLE IF EXISTS `customers_wishlist`;
CREATE TABLE `customers_wishlist` (
  `products_id` int(13) NOT NULL default '0',
  `customers_id` int(13) NOT NULL default '0',
  `products_model` varchar(13) default NULL,
  `products_name` varchar(64) NOT NULL default '',
  `products_price` decimal(8,2) NOT NULL default '0.00',
  `final_price` decimal(8,2) NOT NULL default '0.00',
  `products_quantity` int(2) NOT NULL default '0',
  `wishlist_name` varchar(64) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Table structure for table `db_cache`
--

DROP TABLE IF EXISTS `db_cache`;
CREATE TABLE `db_cache` (
  `cache_entry_name` varchar(64) NOT NULL default '',
  `cache_data` blob,
  `cache_entry_created` int(15) default NULL,
  PRIMARY KEY  (`cache_entry_name`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table `db_cache`
--

LOCK TABLES `db_cache` WRITE;
/*!40000 ALTER TABLE `db_cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `db_cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `easy_admin_sub_menus`
--

DROP TABLE IF EXISTS `easy_admin_sub_menus`;
CREATE TABLE `easy_admin_sub_menus` (
  `easy_admin_sub_menu_id` int(11) NOT NULL auto_increment,
  `easy_admin_top_menu_id` int(11) default NULL,
  `easy_admin_sub_menu_name` varchar(255) default NULL,
  `easy_admin_sub_menu_url` varchar(255) default NULL,
  `easy_admin_sub_menu_sort_order` int(11) default NULL,
  PRIMARY KEY  (`easy_admin_sub_menu_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `easy_admin_sub_menus`
--

LOCK TABLES `easy_admin_sub_menus` WRITE;
/*!40000 ALTER TABLE `easy_admin_sub_menus` DISABLE KEYS */;
INSERT INTO `easy_admin_sub_menus` VALUES (1,1,'顧客管理','customers.php',1);
INSERT INTO `easy_admin_sub_menus` VALUES (2,1,'注文管理','orders.php',2);
INSERT INTO `easy_admin_sub_menus` VALUES (3,2,'カテゴリ・商品の管理','categories.php',1);
INSERT INTO `easy_admin_sub_menus` VALUES (4,2,'商品価格の管理','products_price_manager.php',2);
INSERT INTO `easy_admin_sub_menus` VALUES (5,4,'管理者の設定','admin.php',1);
INSERT INTO `easy_admin_sub_menus` VALUES (6,4,'管理メニューの設定','addon_modules_admin.php?module=easy_admin',2);
INSERT INTO `easy_admin_sub_menus` VALUES (7,4,'追加モジュールの管理','addon_modules.php',3);
/*!40000 ALTER TABLE `easy_admin_sub_menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `easy_admin_top_menus`
--

DROP TABLE IF EXISTS `easy_admin_top_menus`;
CREATE TABLE `easy_admin_top_menus` (
  `easy_admin_top_menu_id` int(11) NOT NULL auto_increment,
  `easy_admin_top_menu_name` varchar(255) default NULL,
  `is_dropdown` int(1) default NULL,
  `easy_admin_top_menu_sort_order` int(11) default NULL,
  PRIMARY KEY  (`easy_admin_top_menu_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `easy_admin_top_menus`
--

LOCK TABLES `easy_admin_top_menus` WRITE;
/*!40000 ALTER TABLE `easy_admin_top_menus` DISABLE KEYS */;
INSERT INTO `easy_admin_top_menus` VALUES (1,'注文・顧客管理',1,0);
INSERT INTO `easy_admin_top_menus` VALUES (2,'商品管理',1,0);
INSERT INTO `easy_admin_top_menus` VALUES (3,'コンテンツ管理',1,0);
INSERT INTO `easy_admin_top_menus` VALUES (4,'初期設定',0,0);
INSERT INTO `easy_admin_top_menus` VALUES (5,'その他',0,0);
/*!40000 ALTER TABLE `easy_admin_top_menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `easy_design_colors`
--

DROP TABLE IF EXISTS `easy_design_colors`;
CREATE TABLE `easy_design_colors` (
  `easy_design_color_id` int(11) NOT NULL auto_increment,
  `template_dir` varchar(255) default NULL,
  `easy_design_color_key` varchar(255) default NULL,
  `easy_design_color_name` text,
  `easy_design_color_value` text,
  PRIMARY KEY  (`easy_design_color_id`),
  KEY `template_dir` (`template_dir`),
  KEY `easy_design_color_key` (`easy_design_color_key`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `easy_design_colors`
--

LOCK TABLES `easy_design_colors` WRITE;
/*!40000 ALTER TABLE `easy_design_colors` DISABLE KEYS */;
INSERT INTO `easy_design_colors` VALUES (1,'template_default','maincolor','メインカラー','#f4f4f4');
INSERT INTO `easy_design_colors` VALUES (2,'template_default','subcolor','サブカラー','#ffffff');
INSERT INTO `easy_design_colors` VALUES (3,'classic','maincolor','メインカラー','#f4f4f4');
INSERT INTO `easy_design_colors` VALUES (4,'classic','subcolor','サブカラー','#ffffff');
INSERT INTO `easy_design_colors` VALUES (5,'sugudeki','maincolor','メインカラー','#FF6347');
INSERT INTO `easy_design_colors` VALUES (6,'addon_modules','maincolor','メインカラー','#f4f4f4');
INSERT INTO `easy_design_colors` VALUES (7,'addon_modules','subcolor','サブカラー','#ffffff');
INSERT INTO `easy_design_colors` VALUES (8,'zen_mobile','maincolor','メインカラー','#f4f4f4');
INSERT INTO `easy_design_colors` VALUES (9,'zen_mobile','subcolor','サブカラー','#ffffff');
INSERT INTO `easy_design_colors` VALUES (10,'accessible_and_usable','maincolor','メインカラー','#0203E9');
INSERT INTO `easy_design_colors` VALUES (11,'accessible_and_usable','subcolor','サブカラー','#DCDCDC');
/*!40000 ALTER TABLE `easy_design_colors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `easy_design_languages`
--

DROP TABLE IF EXISTS `easy_design_languages`;
CREATE TABLE `easy_design_languages` (
  `easy_design_language_id` int(11) NOT NULL auto_increment,
  `language_id` int(11) default NULL,
  `easy_design_language_key` varchar(255) default NULL,
  `easy_design_language_name` text,
  `easy_design_language_value` text,
  `easy_design_language_sort_order` int(11) default NULL,
  PRIMARY KEY  (`easy_design_language_id`),
  KEY `easy_design_language_key` (`easy_design_language_key`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `easy_design_languages`
--

LOCK TABLES `easy_design_languages` WRITE;
/*!40000 ALTER TABLE `easy_design_languages` DISABLE KEYS */;
INSERT INTO `easy_design_languages` VALUES (1,2,'EASY_DESIGN_TAGLINE','タグライン','ECサイトがすぐできる！',1);
INSERT INTO `easy_design_languages` VALUES (2,2,'EASY_DESIGN_KEY_COPYLIGHT','コピーライト','Zen-Cart すぐでき（る）パック',2);
/*!40000 ALTER TABLE `easy_design_languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_archive`
--

DROP TABLE IF EXISTS `email_archive`;
CREATE TABLE `email_archive` (
  `archive_id` int(11) NOT NULL auto_increment,
  `email_to_name` varchar(96) NOT NULL default '',
  `email_to_address` varchar(96) NOT NULL default '',
  `email_from_name` varchar(96) NOT NULL default '',
  `email_from_address` varchar(96) NOT NULL default '',
  `email_subject` varchar(255) NOT NULL default '',
  `email_html` text NOT NULL,
  `email_text` text NOT NULL,
  `date_sent` datetime NOT NULL default '0001-01-01 00:00:00',
  `module` varchar(64) NOT NULL default '',
  PRIMARY KEY  (`archive_id`),
  KEY `idx_email_to_address_zen` (`email_to_address`),
  KEY `idx_module_zen` (`module`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Table structure for table `email_templates`
--

DROP TABLE IF EXISTS `email_templates`;
CREATE TABLE `email_templates` (
  `id` smallint(6) NOT NULL auto_increment,
  `grp` varchar(50) NOT NULL default '',
  `title` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `email_templates`
--

LOCK TABLES `email_templates` WRITE;
/*!40000 ALTER TABLE `email_templates` DISABLE KEYS */;
INSERT INTO `email_templates` VALUES (1,'ユーザー登録','ユーザー登録ありがとうございます');
INSERT INTO `email_templates` VALUES (2,'注文完了','ご注文ありがとうございます[会員用]');
INSERT INTO `email_templates` VALUES (3,'注文完了','ご注文ありがとうございます[ゲスト用]');
INSERT INTO `email_templates` VALUES (4,'ユーザ通知','ステータス変更');
/*!40000 ALTER TABLE `email_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_templates_description`
--

DROP TABLE IF EXISTS `email_templates_description`;
CREATE TABLE `email_templates_description` (
  `email_templates_id` smallint(6) NOT NULL default '0',
  `language_id` int(11) NOT NULL default '0',
  `subject` varchar(255) NOT NULL default '',
  `contents` text NOT NULL,
  `updated` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`email_templates_id`,`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table `email_templates_description`
--

LOCK TABLES `email_templates_description` WRITE;
/*!40000 ALTER TABLE `email_templates_description` DISABLE KEYS */;
INSERT INTO `email_templates_description` VALUES (1,2,'ユーザー登録ありがとうございます','ユーザー登録ありがとうございます\r\n\r\nこれからもよろしくお願いします。','2010-06-27 12:52:56');
INSERT INTO `email_templates_description` VALUES (1,1,'Thank you for membership registration','Thank you for membership registration','2010-06-27 04:29:58');
INSERT INTO `email_templates_description` VALUES (2,2,'ご注文ありがとうございます[会員用]','注文確認書 from XXXXXXXX\r\n\r\n[CUSTOMER_NAME] 様\r\n\r\nご利用ありがとうございます。\r\nご注文内容は以下の通りです。\r\n------------------------------------------------------\r\nご注文番号: [ORDER_ID]\r\nご注文日: [DATE_ORDERED]\r\n請求明細書:\r\n[INVOICE_URL]\r\n\r\n[COMMENT]\r\n\r\n商品\r\n------------------------------------------------------\r\n[PRODUCTS_ORDERED]\r\n------------------------------------------------------\r\n[TOTALS]\r\n\r\nお届け先\r\n------------------------------------------------------\r\n[DELIVERY_ADDRESS]\r\n\r\n請求先住所\r\n------------------------------------------------------\r\n[BILLING_ADDRESS]\r\n\r\nお支払い方法\r\n------------------------------------------------------\r\n[PAYMENT_METHOD]\r\n\r\n\r\n-----\r\nこのメールは当ショップに登録されたお客様に対してお送りしています。\r\nお心当たりが無いようでしたら大変お手数ですがメールにて\r\nxxxxxxx@example.org までご連絡ください。\r\n\r\n-----\r\nCopyright (c) XXXXXXXX Inc. All Rights Reserved','2010-06-27 12:52:25');
INSERT INTO `email_templates_description` VALUES (2,1,'Thank you for the order[member]','OrderConfirmation from XXXXXXXX\r\n\r\n[CUSTOMER_NAME]\r\n\r\nOrderNumber: [ORDER_ID]\r\nOrderDate: [DATE_ORDERED]\r\nInvoice:\r\n[INVOICE_URL]\r\n\r\n[COMMENT]\r\n\r\nProducts\r\n------------------------------------------------------\r\n[PRODUCTS_ORDERED]\r\n------------------------------------------------------\r\n[TOTALS]\r\n\r\nShipping\r\n------------------------------------------------------\r\n[DELIVERY_ADDRESS]\r\n\r\nInvoiceAddress\r\n------------------------------------------------------\r\n[BILLING_ADDRESS]\r\n\r\nPayment\r\n------------------------------------------------------\r\n[PAYMENT_METHOD]\r\n\r\n\r\n-----\r\nThis E-mail is sent to the customer registered in this shop.\r\nVery sorry to trouble you, but with mail when there is no mind hit\r\nxxxxxxx@example.org\r\n\r\n-----\r\nCopyright (c) XXXXXXXX Inc. All Rights Reserved','2010-06-27 04:29:58');
INSERT INTO `email_templates_description` VALUES (3,2,'ご注文ありがとうございます[ゲスト用]','注文確認書 from XXXXXXXX\r\n\r\n[CUSTOMER_NAME] 様\r\n\r\nご利用ありがとうございます。\r\nご注文内容は以下の通りです。\r\n------------------------------------------------------\r\nご注文番号: [ORDER_ID]\r\nご注文日: [DATE_ORDERED]\r\n\r\n[COMMENT]\r\n\r\n商品\r\n------------------------------------------------------\r\n[PRODUCTS_ORDERED]\r\n------------------------------------------------------\r\n[TOTALS]\r\n\r\nお届け先\r\n------------------------------------------------------\r\n[DELIVERY_ADDRESS]\r\n\r\n請求先住所\r\n------------------------------------------------------\r\n[BILLING_ADDRESS]\r\n\r\nお支払い方法\r\n------------------------------------------------------\r\n[PAYMENT_METHOD]\r\n\r\n\r\n-----\r\nこのメールは当ショップに登録されたお客様に対してお送りしています。\r\nお心当たりが無いようでしたら大変お手数ですがメールにて\r\nxxxxxxx@example.org までご連絡ください。\r\n\r\n-----\r\nCopyright (c) XXXXXXXX Inc. All Rights Reserved','2010-06-27 04:31:58');
INSERT INTO `email_templates_description` VALUES (3,1,'Thank you for the order[guest]','OrderConfirmation from XXXXXXXX\r\n\r\n[CUSTOMER_NAME]\r\n\r\nOrderNumber: [ORDER_ID]\r\nOrderDate: [DATE_ORDERED]\r\nInvoice:\r\n[INVOICE_URL]\r\n\r\n[COMMENT]\r\n\r\nProducts\r\n------------------------------------------------------\r\n[PRODUCTS_ORDERED]\r\n------------------------------------------------------\r\n[TOTALS]\r\n\r\nShipping\r\n------------------------------------------------------\r\n[DELIVERY_ADDRESS]\r\n\r\nInvoiceAddress\r\n------------------------------------------------------\r\n[BILLING_ADDRESS]\r\n\r\nPayment\r\n------------------------------------------------------\r\n[PAYMENT_METHOD]\r\n\r\n\r\n-----\r\nThis E-mail is sent to the customer registered in this shop.\r\nVery sorry to trouble you, but with mail when there is no mind hit\r\nxxxxxxx@example.org\r\n\r\n-----\r\nCopyright (c) XXXXXXXX Inc. All Rights Reserved','2010-06-27 04:29:58');
INSERT INTO `email_templates_description` VALUES (4,2,'ご注文受付状況のお知らせ','[CUSTOMER_NAME] 様\r\n\r\nご利用ありがとうございます。\r\n[DATE_ORDERED]にご利用いただいた\r\nご注文受付番号：[ORDER_ID]の状況が変更されましたのでお知らせします。\r\n\r\nご注文についての情報は下記URLでご覧いただけます。\r\n[INVOICE_URL]\r\n\r\nよろしくお願いします。\r\n\r\n-----\r\nこのメールは当ショップに登録されたお客様に対してお送りしています。\r\nお心当たりが無いようでしたら大変お手数ですがメールにて\r\nxxxxxxx@example.org までご連絡ください。\r\n\r\n-----\r\nCopyright (c) XXXXXXXX Inc. All Rights Reserved','2010-07-20 17:45:11');
INSERT INTO `email_templates_description` VALUES (4,1,'Information of order situation','[CUSTOMER_NAME]\r\n\r\nThank you for use\r\n[DATE_ORDERED]\r\nOrder receipt number：[ORDER_ID]\r\n\r\nYou can see ordering information\r\n[INVOICE_URL]\r\n\r\n-----\r\nThis E-mail is sent to the customer registered in this shop.\r\nVery sorry to trouble you, but with mail when there is no mind hit\r\nxxxxxxx@example.org\r\n\r\n-----\r\nCopyright (c) XXXXXXXX Inc. All Rights Reserved','2010-07-20 17:45:11');
INSERT INTO `email_templates_description` VALUES (1,9,'[携帯版]ユーザー登録完了','ユーザー登録ありがとうございます。','2010-06-27 12:52:56');
INSERT INTO `email_templates_description` VALUES (2,9,'[携帯]注文完了','[CUSTOMER_NAME] 様\r\n\r\nご利用ありがとうございます。\r\nご注文内容は以下の通りです。\r\n\r\nご注文番号: [ORDER_ID]\r\nご注文日: [DATE_ORDERED]\r\n\r\n詳しくはこちら。\r\n[INVOICE_URL]','2010-06-27 12:52:25');
INSERT INTO `email_templates_description` VALUES (3,9,'ご注文ありがとうございます[ゲスト用]','注文確認書 from XXXXXXXX\r\n\r\n[CUSTOMER_NAME] 様\r\n\r\nご利用ありがとうございます。\r\nご注文内容は以下の通りです。\r\n------------------------------------------------------\r\nご注文番号: [ORDER_ID]\r\nご注文日: [DATE_ORDERED]\r\n\r\n[COMMENT]\r\n\r\n商品\r\n------------------------------------------------------\r\n[PRODUCTS_ORDERED]\r\n------------------------------------------------------\r\n[TOTALS]\r\n\r\nお届け先\r\n------------------------------------------------------\r\n[DELIVERY_ADDRESS]\r\n\r\n請求先住所\r\n------------------------------------------------------\r\n[BILLING_ADDRESS]\r\n\r\nお支払い方法\r\n------------------------------------------------------\r\n[PAYMENT_METHOD]\r\n\r\n\r\n-----\r\nこのメールは当ショップに登録されたお客様に対してお送りしています。\r\nお心当たりが無いようでしたら大変お手数ですがメールにて\r\nxxxxxxx@example.org までご連絡ください。\r\n\r\n-----\r\nCopyright (c) XXXXXXXX Inc. All Rights Reserved','0000-00-00 00:00:00');
INSERT INTO `email_templates_description` VALUES (4,9,'[携帯版]ご注文受付状況更新','[CUSTOMER_NAME] 様\r\n\r\nご利用ありがとうございます。\r\n[DATE_ORDERED]にご利用いただいた\r\nご注文受付番号：[ORDER_ID]の状況が変更されましたのでお知らせします。\r\n\r\nご注文についての情報は下記URLでご覧いただけます。\r\n[INVOICE_URL]\r\n\r\nよろしくお願いします。','2010-07-20 17:45:11');
/*!40000 ALTER TABLE `email_templates_description` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ezpages`
--

DROP TABLE IF EXISTS `ezpages`;
CREATE TABLE `ezpages` (
  `pages_id` int(11) NOT NULL auto_increment,
  `languages_id` int(11) NOT NULL default '1',
  `pages_title` varchar(64) NOT NULL default '',
  `alt_url` varchar(255) NOT NULL default '',
  `alt_url_external` varchar(255) NOT NULL default '',
  `pages_html_text` text,
  `status_header` int(1) NOT NULL default '1',
  `status_sidebox` int(1) NOT NULL default '1',
  `status_footer` int(1) NOT NULL default '1',
  `status_toc` int(1) NOT NULL default '1',
  `header_sort_order` int(3) NOT NULL default '0',
  `sidebox_sort_order` int(3) NOT NULL default '0',
  `footer_sort_order` int(3) NOT NULL default '0',
  `toc_sort_order` int(3) NOT NULL default '0',
  `page_open_new_window` int(1) NOT NULL default '0',
  `page_is_ssl` int(1) NOT NULL default '0',
  `toc_chapter` int(11) NOT NULL default '0',
  PRIMARY KEY  (`pages_id`),
  KEY `idx_lang_id_zen` (`languages_id`),
  KEY `idx_ezp_status_header_zen` (`status_header`),
  KEY `idx_ezp_status_sidebox_zen` (`status_sidebox`),
  KEY `idx_ezp_status_footer_zen` (`status_footer`),
  KEY `idx_ezp_status_toc_zen` (`status_toc`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `ezpages`
--

LOCK TABLES `ezpages` WRITE;
/*!40000 ALTER TABLE `ezpages` DISABLE KEYS */;
INSERT INTO `ezpages` VALUES (1,1,'EZページ','','','このページは、ヘッダにある「EZページ」からリンクされているページ群のメインページです。<br />\r\n<br />\r\n<strong>注意：EZページの活用方法については「EZ(イージー)ページとは?」を参照してください。</strong><br />\r\n<br />\r\n「EZページ」ボタンは、ヘッダ、サイドボックス、フッタのいずれか、または全ての場所に表示することができます。<br />\r\n<br />\r\nグルーピングを設定すると、グループ化されたページ郡の目次を表示することができます。<br />\r\n<br />\r\n他のページは、このメインページに設置した目次からリンクするか、またはヘッダーにメニューとして表示することもできます。好みで設定してください。<br />\r\n<br />\r\n',1,0,0,1,10,0,0,10,0,0,10);
INSERT INTO `ezpages` VALUES (2,2,'追加ページ1(EZページの例)','','','このページは追加ページの例です。<br />\r\n<br />\r\nグループID10でグルーピングされ、目次は、表示順に従ってソートされています。<br />\r\n<br />\r\nこのページにはヘッダ、フッタ、サイドボックスからのリンクはなく、メインページの目次に表示されます。<br />\r\n<br />\r\n',0,0,0,1,0,0,0,30,0,0,10);
INSERT INTO `ezpages` VALUES (3,2,'追加ページ2(EZページの例)','','','このページは、グループID10に属するもう1つの追加ページです。<br />\r\n<br />\r\nグループ内の表示順は10・20・30といった順であれば自由にナンバー付けすることができます。また、後でページを追加したり、すでにあるページへのリンクを追加したりすることができます。<br />\r\n<br />\r\nグループの単位にまとめることができるページやリンク先に制限はありません。<br />\r\n<br />\r\n[前へ][次へ]ボタンや、目次の表示・非表示については、設定画面で切り替えることができます。',0,0,0,1,0,0,0,40,0,0,10);
INSERT INTO `ezpages` VALUES (4,2,'Myリンク(EZページの例)','','','これは、サイドボックスにリンクが表示される単独のページの例です。<br />\r\n<br />\r\nこのページは章に属していないので、他の追加ページへのリンクはありません。<br />\r\n<br />\r\nあとからページを作成し、章や目次について設定することもできます。<br />\r\n<br />\r\n章に属していないページでは、[前へ] [次へ] ボタンや目次は自動的に非表示となります。',0,1,0,0,0,10,0,0,0,0,0);
INSERT INTO `ezpages` VALUES (5,2,'何かのページ(EZページの例)','','','ページタイトルとリンク名は、コンテンツの内容を考慮して自由に設定することができます。<br />\r\n<br />\r\nまた、リンクの表示場所はヘッダ、サイドボックス、フッタから1ヵ所だけ・全てなどを設定できます。<br />\r\n<br />\r\nこのページからのリンクを、同一ウィンドウで開くか別ウィンドウで開くか、リンク先は非セキュア(非SSL)ページかセキュア(SSL)ページか、などを設定することもできます。',0,1,0,0,0,20,0,0,0,0,0);
INSERT INTO `ezpages` VALUES (6,2,'シェアード(Shared)ページ(EZページの例)','','','このページはヘッダ、サイドボックス、フッタからのシェアード(Shared)リンクが張られたページの例です。<br />\r\n<br />\r\nソート順はわかりやすく50に設定してありますが、ヘッダ、サイドボックス、フッタのそれぞれで違うものにすることもできます。<br />\r\n<br />\r\n',1,1,1,0,50,50,50,0,0,0,0);
INSERT INTO `ezpages` VALUES (7,2,'Myアカウント(EZページの例)','index.php?main_page=account','','',0,0,1,0,0,0,10,0,0,1,0);
INSERT INTO `ezpages` VALUES (8,2,'サイトマップ(EZページの例)','index.php?main_page=site_map','','',0,1,1,0,0,40,20,0,0,0,0);
INSERT INTO `ezpages` VALUES (9,2,'個人情報保護方針(EZページの例)','index.php?main_page=privacy','','',1,0,1,0,30,0,40,0,0,0,0);
INSERT INTO `ezpages` VALUES (10,2,'Zen Cartについて(EZページの例)','','http://www.zen-cart.com','',1,0,0,0,60,0,0,0,1,0,0);
INSERT INTO `ezpages` VALUES (11,2,'ギフト券について(EZページの例)','index.php?main_page=index&cPath=21','','',0,1,0,0,0,60,0,0,0,0,0);
INSERT INTO `ezpages` VALUES (12,2,'DVD - アクション(EZページの例)','index.php?main_page=index&cPath=3_10','','',0,0,1,0,0,0,60,0,0,0,0);
INSERT INTO `ezpages` VALUES (13,2,'Googleについて(EZページの例)','','http://www.google.com','',0,1,0,0,0,70,0,0,1,0,0);
INSERT INTO `ezpages` VALUES (14,2,'EZ(イージー)ページとは?','','','<table cellspacing=\"4\" cellpadding=\"4\" border=\"3\" align=\"center\" style=\"width: 80%;\"><tbody><tr><td><span style=\"font-style: italic;\"><span style=\"font-weight: bold;\">注意：このEZページは、HTMLareaを使って作成しました。ですので、他のエディタではうまく表示できない可能性があります。</span></span></td></tr></tbody></table><br />\r\n<br />\r\n<span style=\"font-weight: bold; color: rgb(255, 0, 0);\">まとめ</span><br />\r\n<br />\r\n<span style=\"font-weight: bold;\">EZページ</span>では、追加ページの作成や、リンクの設定を簡単に行うことができます。<br />\r\n<br />\r\n追加ページの用途の例：<br />\r\n<ul><li>新規ページ</li><li>サイト内リンクのページ</li><li>サイト外リンクのページ</li><li>セキュア(SSL)/非セキュア(非SSL)ページ</li><li>同一ウィンドウで開くページ/別ウィンドウで開くページ</li></ul>さらにページ同士をグループでまとめ、その「目次」を表示することもできます。<br />\r\n<br />\r\n<span style=\"font-weight: bold; color: rgb(255, 0, 0);\">リンクの命名</span><br />\r\n<br />\r\nリンクはページタイトルで命名されます。すべてのリンクは、機能するためにはページタイトルが必要であり、これを忘れるとリンクを追加することができません。<br />\r\n<br />\r\n<span style=\"font-weight: bold;\"><span style=\"color: rgb(255, 0, 0);\">リンクの設置</span><br />\r\n<br />\r\n</span>管理画面で、ヘッダ、サイドボックス、フッタのどこに表示するかを設定する必要があります。3ヵ所全てに表示することも、好みの場所だけに表示することもできます。<br />\r\n30をヘッダに、50をサイドボックスに、といった設定も可能です。<br />\r\nナンバーの振り方は自由ですが、たとえば10・20・30というナンバー付けをすれば、ソートに役立ち、また後から(それらの間に)リンクを追加することもできるでしょう。<br />\r\n<br />\r\n注意：値を「0」にするとリンクは表示されなくなります。<br />\r\n<br />\r\n<span style=\"font-weight: bold;\"><span style=\"color: rgb(255, 0, 0);\">「別ウィンドウで開く」とセキュア(SSL対応)ページ</span><br />\r\n</span><br />\r\nEZページでは、リンク先を通常のように同一ウィンドウで開くことも、また新規ウィンドウで開くように設定することもできます。<br />\r\nまた、リンク先をセキュア(SSL対応)ページで開くか、非セキュア(SSL非対応)ページとして開くかを設定することもできます。<br />\r\n<br />\r\n<span style=\"font-weight: bold; color: rgb(255, 0, 0);\">「グルーピング」</span><br style=\"font-weight: bold; color: rgb(255, 0, 0);\" /><br />\r\n「グルーピング」は、EZページ同士をまとめ相互をリンクさせるスマートな方法です。<br />\r\n<br />\r\nEZページで作成された複数のページ群がある際に、そのメインページへのリンクをヘッダ、サイドボックス、フッタのいずれかに表示するリンク設定をしましょう。<br />\r\n次に、そのリンクと関連づけるグループIDを設定します。<br />\r\nそして、グループ内の表示順を設定してください。これが目次の並び順になります。<br />\r\n<br />\r\n<span style=\"font-weight: bold; font-style: italic;\">注意：ヘッダ、サイドボックス、フッタには、グループに含まれる全てのページをリンクとして表示することもでき、ヘッダにはAというページを、フッタにはBというページを、と設定することもできます。または、グループのメインページか特定のページが開いている際にだけ表示するリンクを設定することもできます。</span><br />\r\n<br />\r\n<span style=\"color: rgb(255, 0, 0); font-weight: bold;\">「外部リンク」</span><br />\r\n<br />\r\n「外部リンク」は、あなたのショップ外のページへのリンクです。このページへのリンクは \"http://www.sashbox.net/\" のように設定します。<br />\r\nリンク先を同一ウィンドウで開くか、別ウィンドウで開くかを設定することができます。<br />\r\n<br />\r\n<span style=\"color: rgb(255, 0, 0); font-weight: bold;\">「内部リンク」</span><br />\r\n<br />\r\n「内部リンク」はあなたのショップ内のページへのリンクです。このページへのリンクは、たとえばID21のカテゴリへリンクする際には \"index.php?main_page=index&cPath=21\" のように相対パスで設定します。絶対パスで記入する際には、ドメインを変更した際などに修正する必要があることに注意してください。<br />\r\nリンク先を同一ウィンドウで開くか、別ウィンドウで開くかを設定することができます。<br />\r\n<br />\r\n<span style=\"font-weight: bold; color: rgb(255, 0, 0);\">EZページの編集についての注意</span><br />\r\n<br />\r\nHTMLareaのようなエディタを使っている際、HTML編集エリアでEnterキーなどを押すと、コンテンツが追加されたと見なされる(「追加ページ」となる)ことがあります。その場合、内部リンクや外部リンクの設定は無効になってしまいますので注意してください。<br />\r\n<br />\r\n<span style=\"font-weight: bold; color: rgb(255, 0, 0);\">「管理者にのみ表示」設定</span><br />\r\n<br />\r\nこれは、実際に稼動しているショップでEZページを編集する際に便利な設定です。<br />\r\nEZページのヘッダ、サイドボックス、フッタへの表示は<br />\r\n<ul><li>オフ</li><li>オン</li><li>管理者にのみ表示</li></ul>の設定をすることができます。「管理者にのみ表示」にしておくと、管理画面の「『メンテナンス中』- 設定したIPアドレスを除く」で設定したIPアドレスでアクセスした際にだけ、EZページへのリンクが表示されます。<br />\r\n<br />\r\n',0,0,0,1,0,0,0,20,0,0,10);
/*!40000 ALTER TABLE `ezpages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feature_area`
--

DROP TABLE IF EXISTS `feature_area`;
CREATE TABLE `feature_area` (
  `id` int(11) NOT NULL auto_increment,
  `main_image` varchar(64) default NULL,
  `thumb_image` varchar(64) default NULL,
  `link_url` varchar(255) default NULL,
  `sort_order` varchar(255) default NULL,
  `date_added` datetime default NULL,
  `last_modified` datetime default NULL,
  `status` tinyint(1) default NULL,
  `new_window` tinyint(1) default NULL,
  PRIMARY KEY  (`id`),
  KEY `idx_status_zen` (`status`),
  KEY `idx_sort_order_zen` (`sort_order`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Table structure for table `feature_area_info`
--

DROP TABLE IF EXISTS `feature_area_info`;
CREATE TABLE `feature_area_info` (
  `id` int(11) NOT NULL auto_increment,
  `languages_id` int(11) NOT NULL default '0',
  `name` varchar(255) default NULL,
  `url_clicked` int(11) default NULL,
  `date_last_click` datetime default NULL,
  PRIMARY KEY  (`id`,`languages_id`),
  KEY `idx_categories_name_zen` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Table structure for table `featured`
--

DROP TABLE IF EXISTS `featured`;
CREATE TABLE `featured` (
  `featured_id` int(11) NOT NULL auto_increment,
  `products_id` int(11) NOT NULL default '0',
  `featured_date_added` datetime default NULL,
  `featured_last_modified` datetime default NULL,
  `expires_date` date NOT NULL default '0001-01-01',
  `date_status_change` datetime default NULL,
  `status` int(1) NOT NULL default '1',
  `featured_date_available` date NOT NULL default '0001-01-01',
  PRIMARY KEY  (`featured_id`),
  KEY `idx_status_zen` (`status`),
  KEY `idx_products_id_zen` (`products_id`),
  KEY `idx_date_avail_zen` (`featured_date_available`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `featured`
--

LOCK TABLES `featured` WRITE;
/*!40000 ALTER TABLE `featured` DISABLE KEYS */;
INSERT INTO `featured` VALUES (1,18,'2007-01-18 00:38:40',NULL,'0001-01-01',NULL,1,'0001-01-01');
INSERT INTO `featured` VALUES (2,2,'2007-01-18 00:38:50',NULL,'0001-01-01',NULL,1,'0001-01-01');
INSERT INTO `featured` VALUES (3,4,'2007-01-18 00:38:59',NULL,'0001-01-01',NULL,1,'0001-01-01');
INSERT INTO `featured` VALUES (4,9,'2007-01-18 00:39:11',NULL,'0001-01-01',NULL,1,'0001-01-01');
INSERT INTO `featured` VALUES (5,28,'2007-01-18 00:39:33',NULL,'0001-01-01',NULL,1,'0001-01-01');
INSERT INTO `featured` VALUES (6,11,'2007-01-18 00:40:27',NULL,'0001-01-01',NULL,1,'0001-01-01');
/*!40000 ALTER TABLE `featured` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `files_uploaded`
--

DROP TABLE IF EXISTS `files_uploaded`;
CREATE TABLE `files_uploaded` (
  `files_uploaded_id` int(11) NOT NULL auto_increment,
  `sesskey` varchar(32) default NULL,
  `customers_id` int(11) default NULL,
  `files_uploaded_name` varchar(64) NOT NULL default '',
  PRIMARY KEY  (`files_uploaded_id`),
  KEY `idx_customers_id_zen` (`customers_id`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis COMMENT='Must always have either a sesskey or customers_id';

--
-- Table structure for table `geo_zones`
--

DROP TABLE IF EXISTS `geo_zones`;
CREATE TABLE `geo_zones` (
  `geo_zone_id` int(11) NOT NULL auto_increment,
  `geo_zone_name` varchar(32) NOT NULL default '',
  `geo_zone_description` varchar(255) NOT NULL default '',
  `last_modified` datetime default NULL,
  `date_added` datetime NOT NULL default '0001-01-01 00:00:00',
  PRIMARY KEY  (`geo_zone_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=ujis;

LOCK TABLES `geo_zones` WRITE;
/*!40000 ALTER TABLE `geo_zones` DISABLE KEYS */;
INSERT INTO geo_zones VALUES (1,'日本','日本（消費税）','2007-01-15 11:44:41','2006-11-29 16:18:40');
/*!40000 ALTER TABLE `geo_zones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `get_terms_to_filter`
--

DROP TABLE IF EXISTS `get_terms_to_filter`;
CREATE TABLE `get_terms_to_filter` (
  `get_term_name` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`get_term_name`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table `get_terms_to_filter`
--

LOCK TABLES `get_terms_to_filter` WRITE;
/*!40000 ALTER TABLE `get_terms_to_filter` DISABLE KEYS */;
INSERT INTO `get_terms_to_filter` VALUES ('manufacturers_id');
INSERT INTO `get_terms_to_filter` VALUES ('music_genre_id');
INSERT INTO `get_terms_to_filter` VALUES ('record_company_id');
/*!40000 ALTER TABLE `get_terms_to_filter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group_point_rate`
--

DROP TABLE IF EXISTS `group_point_rate`;
CREATE TABLE `group_point_rate` (
  `group_id` int(11) NOT NULL default '0',
  `rate` int(11) NOT NULL default '0',
  PRIMARY KEY  (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Table structure for table `group_pricing`
--

DROP TABLE IF EXISTS `group_pricing`;
CREATE TABLE `group_pricing` (
  `group_id` int(11) NOT NULL auto_increment,
  `group_name` varchar(32) NOT NULL default '',
  `group_percentage` decimal(5,2) NOT NULL default '0.00',
  `last_modified` datetime default NULL,
  `date_added` datetime NOT NULL default '0001-01-01 00:00:00',
  PRIMARY KEY  (`group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `group_pricing`
--

LOCK TABLES `group_pricing` WRITE;
/*!40000 ALTER TABLE `group_pricing` DISABLE KEYS */;
INSERT INTO `group_pricing` VALUES (1,'10%割引','10.00',NULL,'2004-04-29 00:21:04');
/*!40000 ALTER TABLE `group_pricing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group_pricing_m17n`
--

DROP TABLE IF EXISTS `group_pricing_m17n`;
CREATE TABLE `group_pricing_m17n` (
  `group_id` int(11) NOT NULL default '0',
  `language_id` int(11) NOT NULL default '0',
  `group_name` varchar(32) NOT NULL default '',
  PRIMARY KEY  (`group_id`,`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table `group_pricing_m17n`
--

LOCK TABLES `group_pricing_m17n` WRITE;
/*!40000 ALTER TABLE `group_pricing_m17n` DISABLE KEYS */;
INSERT INTO `group_pricing_m17n` VALUES (1,1,'10%割引');
INSERT INTO `group_pricing_m17n` VALUES (1,2,'10%割引');
INSERT INTO `group_pricing_m17n` VALUES (1,9,'10%割引');
/*!40000 ALTER TABLE `group_pricing_m17n` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `holidays`
--

DROP TABLE IF EXISTS `holidays`;
CREATE TABLE `holidays` (
  `id` int(11) NOT NULL auto_increment,
  `year` int(11) default NULL,
  `month` int(11) default NULL,
  `day` int(11) default NULL,
  `week` int(11) default NULL,
  `weekcnt` int(11) default NULL,
  `open` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `holidays`
--

LOCK TABLES `holidays` WRITE;
/*!40000 ALTER TABLE `holidays` DISABLE KEYS */;
INSERT INTO `holidays` VALUES (1,-1,1,1,-1,-1,0);
INSERT INTO `holidays` VALUES (2,-1,1,2,-1,-1,0);
INSERT INTO `holidays` VALUES (3,-1,1,3,-1,-1,0);
INSERT INTO `holidays` VALUES (4,-1,1,-1,1,2,0);
INSERT INTO `holidays` VALUES (5,-1,2,11,-1,-1,0);
INSERT INTO `holidays` VALUES (6,-1,4,29,-1,-1,0);
INSERT INTO `holidays` VALUES (7,-1,5,3,-1,-1,0);
INSERT INTO `holidays` VALUES (8,-1,5,4,-1,-1,0);
INSERT INTO `holidays` VALUES (9,-1,5,5,-1,-1,0);
INSERT INTO `holidays` VALUES (10,-1,7,-1,1,3,0);
INSERT INTO `holidays` VALUES (11,-1,9,-1,1,3,0);
INSERT INTO `holidays` VALUES (12,-1,10,-1,1,2,0);
INSERT INTO `holidays` VALUES (13,-1,11,3,-1,-1,0);
INSERT INTO `holidays` VALUES (14,-1,11,23,-1,-1,0);
INSERT INTO `holidays` VALUES (15,-1,12,23,-1,-1,0);
INSERT INTO `holidays` VALUES (16,-1,12,29,-1,-1,0);
INSERT INTO `holidays` VALUES (17,-1,12,30,-1,-1,0);
INSERT INTO `holidays` VALUES (18,-1,12,31,-1,-1,0);
INSERT INTO `holidays` VALUES (19,2009,3,20,-1,-1,0);
INSERT INTO `holidays` VALUES (20,2009,5,6,-1,-1,0);
INSERT INTO `holidays` VALUES (21,2009,9,22,-1,-1,0);
INSERT INTO `holidays` VALUES (22,2009,9,23,-1,-1,0);
INSERT INTO `holidays` VALUES (23,2010,3,21,-1,-1,0);
INSERT INTO `holidays` VALUES (24,2010,3,22,-1,-1,0);
INSERT INTO `holidays` VALUES (25,2010,9,23,-1,-1,0);
/*!40000 ALTER TABLE `holidays` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
CREATE TABLE `languages` (
  `languages_id` int(11) NOT NULL auto_increment,
  `name` varchar(32) NOT NULL default '',
  `code` varchar(20) NOT NULL default '',
  `image` varchar(64) default NULL,
  `directory` varchar(32) default NULL,
  `sort_order` int(3) default NULL,
  PRIMARY KEY  (`languages_id`),
  KEY `idx_languages_name_zen` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `languages`
--

LOCK TABLES `languages` WRITE;
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
INSERT INTO `languages` VALUES (1,'English','en','icon.gif','english',1);
INSERT INTO `languages` VALUES (2,'Japanese','ja','icon.gif','japanese',1);
INSERT INTO `languages` VALUES (9,'Japanese(mobile)','ja-mobile','icon.gif','japanese',1);
/*!40000 ALTER TABLE `languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `layout_boxes`
--

DROP TABLE IF EXISTS `layout_boxes`;
CREATE TABLE `layout_boxes` (
  `layout_id` int(11) NOT NULL auto_increment,
  `layout_template` varchar(64) NOT NULL default '',
  `layout_box_name` varchar(64) NOT NULL default '',
  `layout_box_status` tinyint(1) NOT NULL default '0',
  `layout_box_location` tinyint(1) NOT NULL default '0',
  `layout_box_sort_order` int(11) NOT NULL default '0',
  `layout_box_sort_order_single` int(11) NOT NULL default '0',
  `layout_box_status_single` tinyint(4) NOT NULL default '0',
  `layout_page` varchar(64) default '',
  PRIMARY KEY  (`layout_id`),
  KEY `idx_name_template_zen` (`layout_template`,`layout_box_name`),
  KEY `idx_layout_box_status_zen` (`layout_box_status`)
) ENGINE=MyISAM AUTO_INCREMENT=1237 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `layout_boxes`
--

LOCK TABLES `layout_boxes` WRITE;
/*!40000 ALTER TABLE `layout_boxes` DISABLE KEYS */;
INSERT INTO `layout_boxes` VALUES (1,'default_template_settings','banner_box_all.php',1,1,5,0,0,'');
INSERT INTO `layout_boxes` VALUES (2,'default_template_settings','banner_box.php',1,0,300,1,127,'');
INSERT INTO `layout_boxes` VALUES (3,'default_template_settings','banner_box2.php',1,1,15,1,15,'');
INSERT INTO `layout_boxes` VALUES (4,'default_template_settings','best_sellers.php',1,1,30,70,1,'');
INSERT INTO `layout_boxes` VALUES (5,'default_template_settings','categories.php',1,0,10,10,1,'');
INSERT INTO `layout_boxes` VALUES (6,'default_template_settings','currencies.php',1,1,80,60,1,'');
INSERT INTO `layout_boxes` VALUES (7,'default_template_settings','document_categories.php',1,0,0,0,0,'');
INSERT INTO `layout_boxes` VALUES (8,'default_template_settings','ezpages.php',1,1,-1,2,1,'');
INSERT INTO `layout_boxes` VALUES (9,'default_template_settings','featured.php',1,0,45,0,0,'');
INSERT INTO `layout_boxes` VALUES (10,'default_template_settings','information.php',1,0,50,40,1,'');
INSERT INTO `layout_boxes` VALUES (11,'default_template_settings','languages.php',1,1,70,50,1,'');
INSERT INTO `layout_boxes` VALUES (12,'default_template_settings','manufacturers.php',1,0,30,20,1,'');
INSERT INTO `layout_boxes` VALUES (13,'default_template_settings','manufacturer_info.php',1,1,35,95,1,'');
INSERT INTO `layout_boxes` VALUES (14,'default_template_settings','more_information.php',1,0,200,200,1,'');
INSERT INTO `layout_boxes` VALUES (15,'default_template_settings','music_genres.php',1,1,0,0,0,'');
INSERT INTO `layout_boxes` VALUES (16,'default_template_settings','order_history.php',0,0,0,0,0,'');
INSERT INTO `layout_boxes` VALUES (17,'default_template_settings','product_notifications.php',1,1,55,85,1,'');
INSERT INTO `layout_boxes` VALUES (18,'default_template_settings','record_companies.php',1,1,0,0,0,'');
INSERT INTO `layout_boxes` VALUES (19,'default_template_settings','reviews.php',1,0,40,0,0,'');
INSERT INTO `layout_boxes` VALUES (20,'default_template_settings','search.php',1,1,10,0,0,'');
INSERT INTO `layout_boxes` VALUES (21,'default_template_settings','search_header.php',0,0,0,0,1,'');
INSERT INTO `layout_boxes` VALUES (22,'default_template_settings','shopping_cart.php',1,1,20,30,1,'');
INSERT INTO `layout_boxes` VALUES (23,'default_template_settings','specials.php',1,1,45,0,0,'');
INSERT INTO `layout_boxes` VALUES (24,'default_template_settings','tell_a_friend.php',1,1,65,0,0,'');
INSERT INTO `layout_boxes` VALUES (25,'default_template_settings','whats_new.php',1,0,20,0,0,'');
INSERT INTO `layout_boxes` VALUES (26,'default_template_settings','whos_online.php',1,1,200,200,1,'');
INSERT INTO `layout_boxes` VALUES (27,'template_default','banner_box_all.php',1,1,5,0,0,'');
INSERT INTO `layout_boxes` VALUES (28,'template_default','banner_box.php',1,0,300,1,127,'');
INSERT INTO `layout_boxes` VALUES (29,'template_default','banner_box2.php',1,1,15,1,15,'');
INSERT INTO `layout_boxes` VALUES (30,'template_default','best_sellers.php',1,1,30,70,1,'');
INSERT INTO `layout_boxes` VALUES (31,'template_default','categories.php',1,0,10,10,1,'');
INSERT INTO `layout_boxes` VALUES (32,'template_default','currencies.php',1,1,80,60,1,'');
INSERT INTO `layout_boxes` VALUES (33,'template_default','ezpages.php',1,1,-1,2,1,'');
INSERT INTO `layout_boxes` VALUES (34,'template_default','featured.php',1,0,45,0,0,'');
INSERT INTO `layout_boxes` VALUES (35,'template_default','information.php',1,0,50,40,1,'');
INSERT INTO `layout_boxes` VALUES (36,'template_default','languages.php',1,1,70,50,1,'');
INSERT INTO `layout_boxes` VALUES (37,'template_default','manufacturers.php',1,0,30,20,1,'');
INSERT INTO `layout_boxes` VALUES (38,'template_default','manufacturer_info.php',1,1,35,95,1,'');
INSERT INTO `layout_boxes` VALUES (39,'template_default','more_information.php',1,0,200,200,1,'');
INSERT INTO `layout_boxes` VALUES (40,'template_default','my_broken_box.php',1,0,0,0,0,'');
INSERT INTO `layout_boxes` VALUES (41,'template_default','order_history.php',0,0,0,0,0,'');
INSERT INTO `layout_boxes` VALUES (42,'template_default','product_notifications.php',1,1,55,85,1,'');
INSERT INTO `layout_boxes` VALUES (43,'template_default','reviews.php',1,0,40,0,0,'');
INSERT INTO `layout_boxes` VALUES (44,'template_default','search.php',1,1,10,0,0,'');
INSERT INTO `layout_boxes` VALUES (45,'template_default','search_header.php',0,0,0,0,1,'');
INSERT INTO `layout_boxes` VALUES (46,'template_default','shopping_cart.php',1,1,20,30,1,'');
INSERT INTO `layout_boxes` VALUES (47,'template_default','specials.php',1,1,45,0,0,'');
INSERT INTO `layout_boxes` VALUES (48,'template_default','tell_a_friend.php',1,1,65,0,0,'');
INSERT INTO `layout_boxes` VALUES (49,'template_default','whats_new.php',1,0,20,0,0,'');
INSERT INTO `layout_boxes` VALUES (50,'template_default','whos_online.php',1,1,200,200,1,'');
INSERT INTO `layout_boxes` VALUES (51,'classic','banner_box.php',1,0,300,1,127,'');
INSERT INTO `layout_boxes` VALUES (52,'classic','banner_box2.php',1,1,15,1,15,'');
INSERT INTO `layout_boxes` VALUES (53,'classic','banner_box_all.php',1,1,5,0,0,'');
INSERT INTO `layout_boxes` VALUES (54,'classic','best_sellers.php',1,1,30,70,1,'');
INSERT INTO `layout_boxes` VALUES (55,'classic','categories.php',1,0,10,10,1,'');
INSERT INTO `layout_boxes` VALUES (56,'classic','currencies.php',1,1,80,60,1,'');
INSERT INTO `layout_boxes` VALUES (57,'classic','document_categories.php',1,0,0,0,0,'');
INSERT INTO `layout_boxes` VALUES (58,'classic','ezpages.php',1,1,-1,2,1,'');
INSERT INTO `layout_boxes` VALUES (59,'classic','featured.php',1,0,45,0,0,'');
INSERT INTO `layout_boxes` VALUES (60,'classic','information.php',1,0,50,40,1,'');
INSERT INTO `layout_boxes` VALUES (61,'classic','languages.php',1,1,70,50,1,'');
INSERT INTO `layout_boxes` VALUES (62,'classic','manufacturers.php',1,0,30,20,1,'');
INSERT INTO `layout_boxes` VALUES (63,'classic','manufacturer_info.php',1,1,35,95,1,'');
INSERT INTO `layout_boxes` VALUES (64,'classic','more_information.php',1,0,200,200,1,'');
INSERT INTO `layout_boxes` VALUES (65,'classic','music_genres.php',1,1,0,0,0,'');
INSERT INTO `layout_boxes` VALUES (66,'classic','order_history.php',0,0,0,0,0,'');
INSERT INTO `layout_boxes` VALUES (67,'classic','product_notifications.php',1,1,55,85,1,'');
INSERT INTO `layout_boxes` VALUES (68,'classic','record_companies.php',1,1,0,0,0,'');
INSERT INTO `layout_boxes` VALUES (69,'classic','reviews.php',1,0,40,0,0,'');
INSERT INTO `layout_boxes` VALUES (70,'classic','search.php',1,1,10,0,0,'');
INSERT INTO `layout_boxes` VALUES (71,'classic','search_header.php',0,0,0,0,1,'');
INSERT INTO `layout_boxes` VALUES (72,'classic','shopping_cart.php',1,1,20,30,1,'');
INSERT INTO `layout_boxes` VALUES (73,'classic','specials.php',1,1,45,0,0,'');
INSERT INTO `layout_boxes` VALUES (74,'classic','tell_a_friend.php',1,1,65,0,0,'');
INSERT INTO `layout_boxes` VALUES (75,'classic','whats_new.php',1,0,20,0,0,'');
INSERT INTO `layout_boxes` VALUES (76,'classic','whos_online.php',1,1,200,200,1,'');
INSERT INTO `layout_boxes` VALUES (77,'sugudeki','banner_box.php',0,0,0,0,0,'');
INSERT INTO `layout_boxes` VALUES (78,'sugudeki','banner_box2.php',0,0,0,0,0,'');
INSERT INTO `layout_boxes` VALUES (79,'sugudeki','banner_box_all.php',0,0,0,0,0,'');
INSERT INTO `layout_boxes` VALUES (80,'sugudeki','best_sellers.php',0,0,0,0,0,'');
INSERT INTO `layout_boxes` VALUES (81,'sugudeki','categories.php',0,0,0,0,0,'');
INSERT INTO `layout_boxes` VALUES (82,'sugudeki','currencies.php',0,0,0,0,0,'');
INSERT INTO `layout_boxes` VALUES (83,'sugudeki','document_categories.php',0,0,0,0,0,'');
INSERT INTO `layout_boxes` VALUES (84,'sugudeki','ezpages.php',0,0,0,0,0,'');
INSERT INTO `layout_boxes` VALUES (85,'sugudeki','featured.php',0,0,0,0,0,'');
INSERT INTO `layout_boxes` VALUES (86,'sugudeki','information.php',0,0,0,0,0,'');
INSERT INTO `layout_boxes` VALUES (87,'sugudeki','languages.php',0,0,0,0,0,'');
INSERT INTO `layout_boxes` VALUES (88,'sugudeki','manufacturer_info.php',0,0,0,0,0,'');
INSERT INTO `layout_boxes` VALUES (89,'sugudeki','manufacturers.php',0,0,0,0,0,'');
INSERT INTO `layout_boxes` VALUES (90,'sugudeki','more_information.php',0,0,0,0,0,'');
INSERT INTO `layout_boxes` VALUES (91,'sugudeki','music_genres.php',0,0,0,0,0,'');
INSERT INTO `layout_boxes` VALUES (92,'sugudeki','order_history.php',0,0,0,0,0,'');
INSERT INTO `layout_boxes` VALUES (93,'sugudeki','product_notifications.php',0,0,0,0,0,'');
INSERT INTO `layout_boxes` VALUES (94,'sugudeki','record_companies.php',0,0,0,0,0,'');
INSERT INTO `layout_boxes` VALUES (95,'sugudeki','reviews.php',0,0,0,0,0,'');
INSERT INTO `layout_boxes` VALUES (96,'sugudeki','search.php',0,0,0,0,0,'');
INSERT INTO `layout_boxes` VALUES (97,'sugudeki','search_header.php',0,0,0,0,0,'');
INSERT INTO `layout_boxes` VALUES (98,'sugudeki','shopping_cart.php',0,1,0,0,0,'');
INSERT INTO `layout_boxes` VALUES (99,'sugudeki','specials.php',0,0,0,0,0,'');
INSERT INTO `layout_boxes` VALUES (100,'sugudeki','tell_a_friend.php',0,0,0,0,0,'');
INSERT INTO `layout_boxes` VALUES (101,'sugudeki','whats_new.php',0,0,0,0,0,'');
INSERT INTO `layout_boxes` VALUES (102,'sugudeki','whos_online.php',0,0,0,0,0,'');
INSERT INTO `layout_boxes` VALUES (1236,'zen_mobile','whos_online.php',0,1,200,200,1,'shopping_cart');
INSERT INTO `layout_boxes` VALUES (1235,'zen_mobile','whos_online.php',0,1,200,200,1,'product_list');
INSERT INTO `layout_boxes` VALUES (1234,'zen_mobile','whos_online.php',0,1,200,200,1,'product_info');
INSERT INTO `layout_boxes` VALUES (1233,'zen_mobile','whos_online.php',0,1,200,200,1,'index');
INSERT INTO `layout_boxes` VALUES (1232,'zen_mobile','whos_online.php',0,1,200,200,1,'');
INSERT INTO `layout_boxes` VALUES (1231,'zen_mobile','whos_online.php',0,0,0,0,0,'mypage');
INSERT INTO `layout_boxes` VALUES (1230,'zen_mobile','whats_new.php',0,0,20,0,0,'shopping_cart');
INSERT INTO `layout_boxes` VALUES (1229,'zen_mobile','whats_new.php',0,0,20,0,0,'product_list');
INSERT INTO `layout_boxes` VALUES (1228,'zen_mobile','whats_new.php',0,0,20,0,0,'product_info');
INSERT INTO `layout_boxes` VALUES (1227,'zen_mobile','whats_new.php',0,0,20,0,0,'index');
INSERT INTO `layout_boxes` VALUES (1225,'zen_mobile','whats_new.php',0,0,0,0,0,'mypage');
INSERT INTO `layout_boxes` VALUES (1226,'zen_mobile','whats_new.php',0,0,20,0,0,'');
INSERT INTO `layout_boxes` VALUES (1224,'zen_mobile','tell_a_friend.php',0,1,65,0,0,'shopping_cart');
INSERT INTO `layout_boxes` VALUES (1223,'zen_mobile','tell_a_friend.php',0,1,65,0,0,'product_list');
INSERT INTO `layout_boxes` VALUES (1222,'zen_mobile','tell_a_friend.php',0,1,65,0,0,'product_info');
INSERT INTO `layout_boxes` VALUES (1221,'zen_mobile','tell_a_friend.php',0,1,65,0,0,'index');
INSERT INTO `layout_boxes` VALUES (1220,'zen_mobile','tell_a_friend.php',0,1,65,0,0,'');
INSERT INTO `layout_boxes` VALUES (1219,'zen_mobile','tell_a_friend.php',0,0,0,0,0,'mypage');
INSERT INTO `layout_boxes` VALUES (1218,'zen_mobile','specials.php',0,1,9,0,0,'shopping_cart');
INSERT INTO `layout_boxes` VALUES (1217,'zen_mobile','specials.php',0,1,45,0,0,'product_list');
INSERT INTO `layout_boxes` VALUES (1215,'zen_mobile','specials.php',0,1,45,0,0,'index');
INSERT INTO `layout_boxes` VALUES (1216,'zen_mobile','specials.php',0,1,45,0,0,'product_info');
INSERT INTO `layout_boxes` VALUES (1214,'zen_mobile','specials.php',0,1,45,0,0,'');
INSERT INTO `layout_boxes` VALUES (1213,'zen_mobile','specials.php',0,0,0,0,0,'mypage');
INSERT INTO `layout_boxes` VALUES (1210,'zen_mobile','shopping_cart.php',0,1,20,30,1,'product_info');
INSERT INTO `layout_boxes` VALUES (1212,'zen_mobile','shopping_cart.php',0,1,20,30,1,'shopping_cart');
INSERT INTO `layout_boxes` VALUES (1211,'zen_mobile','shopping_cart.php',0,1,20,30,1,'product_list');
INSERT INTO `layout_boxes` VALUES (1209,'zen_mobile','shopping_cart.php',0,1,20,30,1,'index');
INSERT INTO `layout_boxes` VALUES (1208,'zen_mobile','shopping_cart.php',0,1,20,30,1,'');
INSERT INTO `layout_boxes` VALUES (1207,'zen_mobile','shopping_cart.php',0,0,0,0,0,'mypage');
INSERT INTO `layout_boxes` VALUES (1206,'zen_mobile','search_header.php',0,1,7,0,1,'shopping_cart');
INSERT INTO `layout_boxes` VALUES (1205,'zen_mobile','search_header.php',0,0,0,0,1,'product_list');
INSERT INTO `layout_boxes` VALUES (1200,'zen_mobile','search.php',1,1,5,0,0,'index');
INSERT INTO `layout_boxes` VALUES (1201,'zen_mobile','search_header.php',0,0,0,0,0,'index');
INSERT INTO `layout_boxes` VALUES (1202,'zen_mobile','search_header.php',0,0,0,0,0,'mypage');
INSERT INTO `layout_boxes` VALUES (1203,'zen_mobile','search_header.php',0,0,0,0,1,'');
INSERT INTO `layout_boxes` VALUES (1204,'zen_mobile','search_header.php',0,0,0,0,1,'product_info');
INSERT INTO `layout_boxes` VALUES (1199,'zen_mobile','search.php',1,1,11,0,0,'product_list');
INSERT INTO `layout_boxes` VALUES (1198,'zen_mobile','search.php',0,1,20,0,0,'shopping_cart');
INSERT INTO `layout_boxes` VALUES (1197,'zen_mobile','search.php',0,1,10,0,0,'product_info');
INSERT INTO `layout_boxes` VALUES (1196,'zen_mobile','search.php',0,1,10,0,0,'');
INSERT INTO `layout_boxes` VALUES (1195,'zen_mobile','search.php',0,0,0,0,0,'mypage');
INSERT INTO `layout_boxes` VALUES (1194,'zen_mobile','reviews.php',0,0,40,0,0,'shopping_cart');
INSERT INTO `layout_boxes` VALUES (1193,'zen_mobile','reviews.php',0,0,40,0,0,'product_list');
INSERT INTO `layout_boxes` VALUES (1192,'zen_mobile','reviews.php',0,0,40,0,0,'product_info');
INSERT INTO `layout_boxes` VALUES (1191,'zen_mobile','reviews.php',0,0,40,0,0,'index');
INSERT INTO `layout_boxes` VALUES (1190,'zen_mobile','reviews.php',0,0,40,0,0,'');
INSERT INTO `layout_boxes` VALUES (1189,'zen_mobile','reviews.php',0,0,0,0,0,'mypage');
INSERT INTO `layout_boxes` VALUES (1187,'zen_mobile','record_companies.php',0,1,0,0,0,'product_list');
INSERT INTO `layout_boxes` VALUES (1188,'zen_mobile','record_companies.php',0,1,0,0,0,'shopping_cart');
INSERT INTO `layout_boxes` VALUES (1186,'zen_mobile','record_companies.php',0,1,0,0,0,'product_info');
INSERT INTO `layout_boxes` VALUES (1185,'zen_mobile','record_companies.php',0,1,0,0,0,'index');
INSERT INTO `layout_boxes` VALUES (1184,'zen_mobile','record_companies.php',0,1,0,0,0,'');
INSERT INTO `layout_boxes` VALUES (1183,'zen_mobile','record_companies.php',0,0,0,0,0,'mypage');
INSERT INTO `layout_boxes` VALUES (1182,'zen_mobile','product_notifications.php',0,1,55,85,1,'shopping_cart');
INSERT INTO `layout_boxes` VALUES (1179,'zen_mobile','product_notifications.php',0,1,55,85,1,'index');
INSERT INTO `layout_boxes` VALUES (1180,'zen_mobile','product_notifications.php',0,1,55,85,1,'product_info');
INSERT INTO `layout_boxes` VALUES (1181,'zen_mobile','product_notifications.php',0,1,55,85,1,'product_list');
INSERT INTO `layout_boxes` VALUES (1178,'zen_mobile','product_notifications.php',0,1,55,85,1,'');
INSERT INTO `layout_boxes` VALUES (1177,'zen_mobile','product_notifications.php',0,0,0,0,0,'mypage');
INSERT INTO `layout_boxes` VALUES (1176,'zen_mobile','order_history.php',0,0,0,0,0,'shopping_cart');
INSERT INTO `layout_boxes` VALUES (1175,'zen_mobile','order_history.php',0,0,0,0,0,'product_list');
INSERT INTO `layout_boxes` VALUES (1174,'zen_mobile','order_history.php',0,0,0,0,0,'product_info');
INSERT INTO `layout_boxes` VALUES (1173,'zen_mobile','order_history.php',0,0,0,0,0,'mypage');
INSERT INTO `layout_boxes` VALUES (1172,'zen_mobile','order_history.php',0,0,0,0,0,'index');
INSERT INTO `layout_boxes` VALUES (1171,'zen_mobile','order_history.php',0,0,0,0,0,'');
INSERT INTO `layout_boxes` VALUES (1169,'zen_mobile','music_genres.php',0,1,0,0,0,'product_list');
INSERT INTO `layout_boxes` VALUES (1170,'zen_mobile','music_genres.php',0,1,0,0,0,'shopping_cart');
INSERT INTO `layout_boxes` VALUES (1168,'zen_mobile','music_genres.php',0,1,0,0,0,'product_info');
INSERT INTO `layout_boxes` VALUES (1167,'zen_mobile','music_genres.php',0,1,0,0,0,'index');
INSERT INTO `layout_boxes` VALUES (1166,'zen_mobile','music_genres.php',0,1,0,0,0,'');
INSERT INTO `layout_boxes` VALUES (1165,'zen_mobile','music_genres.php',0,0,0,0,0,'mypage');
INSERT INTO `layout_boxes` VALUES (1164,'zen_mobile','more_information.php',0,0,200,200,1,'shopping_cart');
INSERT INTO `layout_boxes` VALUES (1163,'zen_mobile','more_information.php',0,0,200,200,1,'product_list');
INSERT INTO `layout_boxes` VALUES (1162,'zen_mobile','more_information.php',0,0,200,200,1,'product_info');
INSERT INTO `layout_boxes` VALUES (1161,'zen_mobile','more_information.php',0,0,200,200,1,'index');
INSERT INTO `layout_boxes` VALUES (1159,'zen_mobile','more_information.php',0,0,0,0,0,'mypage');
INSERT INTO `layout_boxes` VALUES (1160,'zen_mobile','more_information.php',0,0,200,200,1,'');
INSERT INTO `layout_boxes` VALUES (1157,'zen_mobile','manufacturers.php',0,0,30,20,1,'product_list');
INSERT INTO `layout_boxes` VALUES (1158,'zen_mobile','manufacturers.php',0,0,30,20,1,'shopping_cart');
INSERT INTO `layout_boxes` VALUES (1155,'zen_mobile','manufacturers.php',0,0,30,20,1,'index');
INSERT INTO `layout_boxes` VALUES (1156,'zen_mobile','manufacturers.php',0,0,30,20,1,'product_info');
INSERT INTO `layout_boxes` VALUES (1154,'zen_mobile','manufacturers.php',0,0,30,20,1,'');
INSERT INTO `layout_boxes` VALUES (1153,'zen_mobile','manufacturers.php',0,0,0,0,0,'mypage');
INSERT INTO `layout_boxes` VALUES (1152,'zen_mobile','manufacturer_info.php',0,1,35,95,1,'shopping_cart');
INSERT INTO `layout_boxes` VALUES (1151,'zen_mobile','manufacturer_info.php',0,1,35,95,1,'product_list');
INSERT INTO `layout_boxes` VALUES (1147,'zen_mobile','manufacturer_info.php',0,0,0,0,0,'mypage');
INSERT INTO `layout_boxes` VALUES (1150,'zen_mobile','manufacturer_info.php',0,1,35,95,1,'product_info');
INSERT INTO `layout_boxes` VALUES (1149,'zen_mobile','manufacturer_info.php',0,1,35,95,1,'index');
INSERT INTO `layout_boxes` VALUES (1148,'zen_mobile','manufacturer_info.php',0,1,35,95,1,'');
INSERT INTO `layout_boxes` VALUES (1146,'zen_mobile','languages.php',0,1,70,50,1,'shopping_cart');
INSERT INTO `layout_boxes` VALUES (1145,'zen_mobile','languages.php',0,1,70,50,1,'product_list');
INSERT INTO `layout_boxes` VALUES (1142,'zen_mobile','languages.php',0,1,70,50,1,'');
INSERT INTO `layout_boxes` VALUES (1143,'zen_mobile','languages.php',0,1,70,50,1,'index');
INSERT INTO `layout_boxes` VALUES (1144,'zen_mobile','languages.php',0,1,70,50,1,'product_info');
INSERT INTO `layout_boxes` VALUES (1141,'zen_mobile','languages.php',0,0,0,0,0,'mypage');
INSERT INTO `layout_boxes` VALUES (1140,'zen_mobile','information.php',1,1,10,40,1,'index');
INSERT INTO `layout_boxes` VALUES (1139,'zen_mobile','information.php',0,1,50,40,1,'shopping_cart');
INSERT INTO `layout_boxes` VALUES (1138,'zen_mobile','information.php',0,1,50,40,1,'product_info');
INSERT INTO `layout_boxes` VALUES (1137,'zen_mobile','information.php',0,1,50,40,1,'');
INSERT INTO `layout_boxes` VALUES (1136,'zen_mobile','information.php',0,1,50,40,0,'product_list');
INSERT INTO `layout_boxes` VALUES (1133,'zen_mobile','featured.php',0,0,45,0,0,'product_list');
INSERT INTO `layout_boxes` VALUES (1134,'zen_mobile','featured.php',0,0,45,0,0,'shopping_cart');
INSERT INTO `layout_boxes` VALUES (1135,'zen_mobile','information.php',0,0,0,0,0,'mypage');
INSERT INTO `layout_boxes` VALUES (1127,'zen_mobile','ezpages.php',0,1,-1,2,1,'product_list');
INSERT INTO `layout_boxes` VALUES (1128,'zen_mobile','ezpages.php',0,1,-1,2,1,'shopping_cart');
INSERT INTO `layout_boxes` VALUES (1129,'zen_mobile','featured.php',0,0,0,0,0,'mypage');
INSERT INTO `layout_boxes` VALUES (1130,'zen_mobile','featured.php',0,0,45,0,0,'');
INSERT INTO `layout_boxes` VALUES (1131,'zen_mobile','featured.php',0,0,45,0,0,'index');
INSERT INTO `layout_boxes` VALUES (1132,'zen_mobile','featured.php',0,0,45,0,0,'product_info');
INSERT INTO `layout_boxes` VALUES (1126,'zen_mobile','ezpages.php',0,1,-1,2,1,'product_info');
INSERT INTO `layout_boxes` VALUES (1125,'zen_mobile','ezpages.php',0,1,-1,2,1,'index');
INSERT INTO `layout_boxes` VALUES (1124,'zen_mobile','ezpages.php',0,1,-1,2,1,'');
INSERT INTO `layout_boxes` VALUES (1123,'zen_mobile','ezpages.php',0,0,0,0,0,'mypage');
INSERT INTO `layout_boxes` VALUES (1122,'zen_mobile','document_categories.php',0,0,0,0,0,'shopping_cart');
INSERT INTO `layout_boxes` VALUES (1121,'zen_mobile','document_categories.php',0,0,0,0,0,'product_list');
INSERT INTO `layout_boxes` VALUES (1120,'zen_mobile','document_categories.php',0,0,0,0,0,'product_info');
INSERT INTO `layout_boxes` VALUES (1119,'zen_mobile','document_categories.php',0,0,0,0,0,'mypage');
INSERT INTO `layout_boxes` VALUES (1118,'zen_mobile','document_categories.php',0,0,0,0,0,'index');
INSERT INTO `layout_boxes` VALUES (1117,'zen_mobile','document_categories.php',0,0,0,0,0,'');
INSERT INTO `layout_boxes` VALUES (1116,'zen_mobile','currencies.php',0,1,80,60,1,'shopping_cart');
INSERT INTO `layout_boxes` VALUES (1115,'zen_mobile','currencies.php',0,1,80,60,1,'product_list');
INSERT INTO `layout_boxes` VALUES (1114,'zen_mobile','currencies.php',0,1,80,60,1,'product_info');
INSERT INTO `layout_boxes` VALUES (1113,'zen_mobile','currencies.php',0,1,80,60,1,'index');
INSERT INTO `layout_boxes` VALUES (1112,'zen_mobile','currencies.php',0,1,80,60,1,'');
INSERT INTO `layout_boxes` VALUES (1111,'zen_mobile','currencies.php',0,0,0,0,0,'mypage');
INSERT INTO `layout_boxes` VALUES (1110,'zen_mobile','categories.php',1,1,0,10,1,'index');
INSERT INTO `layout_boxes` VALUES (1108,'zen_mobile','categories.php',0,1,10,10,0,'product_list');
INSERT INTO `layout_boxes` VALUES (1109,'zen_mobile','categories.php',0,1,10,10,0,'shopping_cart');
INSERT INTO `layout_boxes` VALUES (1107,'zen_mobile','categories.php',0,1,10,10,0,'product_info');
INSERT INTO `layout_boxes` VALUES (1105,'zen_mobile','categories.php',0,0,0,0,0,'mypage');
INSERT INTO `layout_boxes` VALUES (1106,'zen_mobile','categories.php',0,1,10,10,0,'');
INSERT INTO `layout_boxes` VALUES (1104,'zen_mobile','best_sellers.php',0,1,8,0,1,'shopping_cart');
INSERT INTO `layout_boxes` VALUES (1103,'zen_mobile','best_sellers.php',0,1,30,70,1,'product_list');
INSERT INTO `layout_boxes` VALUES (1102,'zen_mobile','best_sellers.php',0,1,30,70,1,'product_info');
INSERT INTO `layout_boxes` VALUES (1098,'zen_mobile','banner_box_all.php',0,1,5,0,0,'shopping_cart');
INSERT INTO `layout_boxes` VALUES (1101,'zen_mobile','best_sellers.php',0,1,30,70,1,'index');
INSERT INTO `layout_boxes` VALUES (1100,'zen_mobile','best_sellers.php',0,1,30,70,1,'');
INSERT INTO `layout_boxes` VALUES (1099,'zen_mobile','best_sellers.php',0,0,0,0,0,'mypage');
INSERT INTO `layout_boxes` VALUES (1097,'zen_mobile','banner_box_all.php',0,1,5,0,0,'product_list');
INSERT INTO `layout_boxes` VALUES (1096,'zen_mobile','banner_box_all.php',0,1,5,0,0,'product_info');
INSERT INTO `layout_boxes` VALUES (1095,'zen_mobile','banner_box_all.php',0,1,5,0,0,'index');
INSERT INTO `layout_boxes` VALUES (1094,'zen_mobile','banner_box_all.php',0,1,5,0,0,'');
INSERT INTO `layout_boxes` VALUES (1091,'zen_mobile','banner_box2.php',0,1,15,1,1,'product_list');
INSERT INTO `layout_boxes` VALUES (1093,'zen_mobile','banner_box_all.php',0,0,0,0,0,'mypage');
INSERT INTO `layout_boxes` VALUES (1092,'zen_mobile','banner_box2.php',0,1,15,1,1,'shopping_cart');
INSERT INTO `layout_boxes` VALUES (1090,'zen_mobile','banner_box2.php',0,1,15,1,1,'product_info');
INSERT INTO `layout_boxes` VALUES (1089,'zen_mobile','banner_box2.php',0,1,15,1,1,'index');
INSERT INTO `layout_boxes` VALUES (1088,'zen_mobile','banner_box2.php',0,1,15,1,1,'');
INSERT INTO `layout_boxes` VALUES (1087,'zen_mobile','banner_box2.php',0,0,0,0,0,'mypage');
INSERT INTO `layout_boxes` VALUES (1086,'zen_mobile','banner_box.php',0,0,300,1,1,'shopping_cart');
INSERT INTO `layout_boxes` VALUES (1085,'zen_mobile','banner_box.php',0,0,300,1,1,'product_list');
INSERT INTO `layout_boxes` VALUES (1084,'zen_mobile','banner_box.php',0,0,300,1,1,'product_info');
INSERT INTO `layout_boxes` VALUES (1083,'zen_mobile','banner_box.php',0,0,300,1,1,'index');
INSERT INTO `layout_boxes` VALUES (1082,'zen_mobile','banner_box.php',0,0,300,1,1,'');
INSERT INTO `layout_boxes` VALUES (1081,'zen_mobile','banner_box.php',0,0,0,0,0,'mypage');
INSERT INTO `layout_boxes` VALUES (1080,'zen_mobile','account_menu.php',1,1,7,0,0,'index');
INSERT INTO `layout_boxes` VALUES (1079,'zen_mobile','account_menu.php',1,1,30,0,0,'shopping_cart');
INSERT INTO `layout_boxes` VALUES (1078,'zen_mobile','account_menu.php',1,1,30,0,0,'product_list');
INSERT INTO `layout_boxes` VALUES (1077,'zen_mobile','account_menu.php',1,1,0,0,0,'product_info');
INSERT INTO `layout_boxes` VALUES (1076,'zen_mobile','account_menu.php',1,1,0,0,0,'mypage');
INSERT INTO `layout_boxes` VALUES (1075,'zen_mobile','account_menu.php',0,0,0,0,0,'');
/*!40000 ALTER TABLE `layout_boxes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `manufacturers`
--

DROP TABLE IF EXISTS `manufacturers`;
CREATE TABLE `manufacturers` (
  `manufacturers_id` int(11) NOT NULL auto_increment,
  `manufacturers_name` varchar(32) NOT NULL default '',
  `manufacturers_image` varchar(64) default NULL,
  `date_added` datetime default NULL,
  `last_modified` datetime default NULL,
  PRIMARY KEY  (`manufacturers_id`),
  KEY `idx_mfg_name_zen` (`manufacturers_name`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `manufacturers`
--

LOCK TABLES `manufacturers` WRITE;
/*!40000 ALTER TABLE `manufacturers` DISABLE KEYS */;
INSERT INTO `manufacturers` VALUES (1,'ABCアート',NULL,'2007-01-17 14:59:37','2007-01-21 22:22:03');
INSERT INTO `manufacturers` VALUES (2,'山田屋Tシャツ株式会社',NULL,'2007-01-21 22:19:08','2007-01-21 22:19:55');
INSERT INTO `manufacturers` VALUES (3,'ZenMarT商会',NULL,'2007-01-21 22:20:41',NULL);
INSERT INTO `manufacturers` VALUES (4,'XYZデザイン',NULL,'2007-01-21 22:21:38',NULL);
/*!40000 ALTER TABLE `manufacturers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `manufacturers_info`
--

DROP TABLE IF EXISTS `manufacturers_info`;
CREATE TABLE `manufacturers_info` (
  `manufacturers_id` int(11) NOT NULL default '0',
  `languages_id` int(11) NOT NULL default '0',
  `manufacturers_url` varchar(255) NOT NULL default '',
  `url_clicked` int(5) NOT NULL default '0',
  `date_last_click` datetime default NULL,
  `manufacturers_name` varchar(32) NOT NULL default '',
  PRIMARY KEY  (`manufacturers_id`,`languages_id`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table `manufacturers_info`
--

LOCK TABLES `manufacturers_info` WRITE;
/*!40000 ALTER TABLE `manufacturers_info` DISABLE KEYS */;
INSERT INTO `manufacturers_info` VALUES (2,1,'',0,NULL,'山田屋Tシャツ株式会社');
INSERT INTO `manufacturers_info` VALUES (2,2,'',0,NULL,'山田屋Tシャツ株式会社');
INSERT INTO `manufacturers_info` VALUES (3,1,'',0,NULL,'ZenMarT商会');
INSERT INTO `manufacturers_info` VALUES (3,2,'',0,NULL,'ZenMarT商会');
INSERT INTO `manufacturers_info` VALUES (4,1,'',0,NULL,'XYZデザイン');
INSERT INTO `manufacturers_info` VALUES (4,2,'',0,NULL,'XYZデザイン');
INSERT INTO `manufacturers_info` VALUES (4,9,'',0,NULL,'');
INSERT INTO `manufacturers_info` VALUES (3,9,'',0,NULL,'');
INSERT INTO `manufacturers_info` VALUES (2,9,'',0,NULL,'');
/*!40000 ALTER TABLE `manufacturers_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media_clips`
--

DROP TABLE IF EXISTS `media_clips`;
CREATE TABLE `media_clips` (
  `clip_id` int(11) NOT NULL auto_increment,
  `media_id` int(11) NOT NULL default '0',
  `clip_type` smallint(6) NOT NULL default '0',
  `clip_filename` text NOT NULL,
  `date_added` datetime NOT NULL default '0001-01-01 00:00:00',
  `last_modified` datetime NOT NULL default '0001-01-01 00:00:00',
  PRIMARY KEY  (`clip_id`),
  KEY `idx_media_id_zen` (`media_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `media_clips`
--

LOCK TABLES `media_clips` WRITE;
/*!40000 ALTER TABLE `media_clips` DISABLE KEYS */;
INSERT INTO `media_clips` VALUES (1,1,1,'thehunter.mp3','2007-01-26 10:50:45','0001-01-01 00:00:00');
INSERT INTO `media_clips` VALUES (3,1,1,'help.mp3','2007-01-26 11:03:23','0001-01-01 00:00:00');
/*!40000 ALTER TABLE `media_clips` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media_manager`
--

DROP TABLE IF EXISTS `media_manager`;
CREATE TABLE `media_manager` (
  `media_id` int(11) NOT NULL auto_increment,
  `media_name` varchar(255) NOT NULL default '',
  `last_modified` datetime NOT NULL default '0001-01-01 00:00:00',
  `date_added` datetime NOT NULL default '0001-01-01 00:00:00',
  PRIMARY KEY  (`media_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `media_manager`
--

LOCK TABLES `media_manager` WRITE;
/*!40000 ALTER TABLE `media_manager` DISABLE KEYS */;
INSERT INTO `media_manager` VALUES (1,'Help!','2007-01-26 11:03:23','2007-01-26 10:50:30');
INSERT INTO `media_manager` VALUES (2,'Russ Tippins - The Hunter','2007-01-26 10:51:28','2007-01-26 10:51:10');
/*!40000 ALTER TABLE `media_manager` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media_to_products`
--

DROP TABLE IF EXISTS `media_to_products`;
CREATE TABLE `media_to_products` (
  `media_id` int(11) NOT NULL default '0',
  `product_id` int(11) NOT NULL default '0',
  KEY `idx_media_product_zen` (`media_id`,`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table `media_to_products`
--

LOCK TABLES `media_to_products` WRITE;
/*!40000 ALTER TABLE `media_to_products` DISABLE KEYS */;
INSERT INTO `media_to_products` VALUES (1,213);
INSERT INTO `media_to_products` VALUES (1,229);
INSERT INTO `media_to_products` VALUES (2,212);
/*!40000 ALTER TABLE `media_to_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media_types`
--

DROP TABLE IF EXISTS `media_types`;
CREATE TABLE `media_types` (
  `type_id` int(11) NOT NULL auto_increment,
  `type_name` varchar(64) NOT NULL default '',
  `type_ext` varchar(8) NOT NULL default '',
  PRIMARY KEY  (`type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `media_types`
--

LOCK TABLES `media_types` WRITE;
/*!40000 ALTER TABLE `media_types` DISABLE KEYS */;
INSERT INTO `media_types` VALUES (1,'MP3','.mp3');
/*!40000 ALTER TABLE `media_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meta_tags_categories_description`
--

DROP TABLE IF EXISTS `meta_tags_categories_description`;
CREATE TABLE `meta_tags_categories_description` (
  `categories_id` int(11) NOT NULL auto_increment,
  `language_id` int(11) NOT NULL default '1',
  `metatags_title` varchar(255) NOT NULL default '',
  `metatags_keywords` text,
  `metatags_description` text,
  PRIMARY KEY  (`categories_id`,`language_id`)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `meta_tags_categories_description`
--

LOCK TABLES `meta_tags_categories_description` WRITE;
/*!40000 ALTER TABLE `meta_tags_categories_description` DISABLE KEYS */;
INSERT INTO `meta_tags_categories_description` VALUES (58,1,'','','');
INSERT INTO `meta_tags_categories_description` VALUES (58,2,'このカテゴリには明示的にtitleタグを設定しました。','このカテゴリには明示的にMETA（keyword）を設定しています,キーワード1,キーワード2,キーワード3','このカテゴリには明示的にMETA（description）を設定しています。Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus sit amet velit・・・');
INSERT INTO `meta_tags_categories_description` VALUES (58,9,'このカテゴリには明示的にtitleタグを設定しました。','このカテゴリには明示的にMETA（keyword）を設定しています,キーワード1,キーワード2,キーワード3','このカテゴリには明示的にMETA（description）を設定しています。Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus sit amet velit・・・');
/*!40000 ALTER TABLE `meta_tags_categories_description` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meta_tags_products_description`
--

DROP TABLE IF EXISTS `meta_tags_products_description`;
CREATE TABLE `meta_tags_products_description` (
  `products_id` int(11) NOT NULL auto_increment,
  `language_id` int(11) NOT NULL default '1',
  `metatags_title` varchar(255) NOT NULL default '',
  `metatags_keywords` text,
  `metatags_description` text,
  PRIMARY KEY  (`products_id`,`language_id`)
) ENGINE=MyISAM AUTO_INCREMENT=117 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `meta_tags_products_description`
--

LOCK TABLES `meta_tags_products_description` WRITE;
/*!40000 ALTER TABLE `meta_tags_products_description` DISABLE KEYS */;
INSERT INTO `meta_tags_products_description` VALUES (115,1,'','','');
INSERT INTO `meta_tags_products_description` VALUES (115,2,'この商品ページには明示的にtitleタグを設定しました。','この商品ページには明示的にMETA（keyword）を設定しています,商品キーワード1,商品キーワード2,商品キーワード3','この商品ページには明示的にMETA（description）を設定しています。Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus sit amet velit・・・');
INSERT INTO `meta_tags_products_description` VALUES (116,1,'','','');
INSERT INTO `meta_tags_products_description` VALUES (116,2,'','','');
INSERT INTO `meta_tags_products_description` VALUES (115,9,'この商品ページには明示的にtitleタグを設定しました。','この商品ページには明示的にMETA（keyword）を設定しています,商品キーワード1,商品キーワード2,商品キーワード3','この商品ページには明示的にMETA（description）を設定しています。Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus sit amet velit・・・');
INSERT INTO `meta_tags_products_description` VALUES (116,9,'','','');
/*!40000 ALTER TABLE `meta_tags_products_description` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `music_genre`
--

DROP TABLE IF EXISTS `music_genre`;
CREATE TABLE `music_genre` (
  `music_genre_id` int(11) NOT NULL auto_increment,
  `music_genre_name` varchar(32) NOT NULL default '',
  `date_added` datetime default NULL,
  `last_modified` datetime default NULL,
  PRIMARY KEY  (`music_genre_id`),
  KEY `idx_music_genre_name_zen` (`music_genre_name`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `music_genre`
--

LOCK TABLES `music_genre` WRITE;
/*!40000 ALTER TABLE `music_genre` DISABLE KEYS */;
INSERT INTO `music_genre` VALUES (1,'Jazz','2007-01-26 10:45:31',NULL);
INSERT INTO `music_genre` VALUES (2,'Rock','2007-01-26 10:45:46',NULL);
/*!40000 ALTER TABLE `music_genre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newsletters`
--

DROP TABLE IF EXISTS `newsletters`;
CREATE TABLE `newsletters` (
  `newsletters_id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `content` text NOT NULL,
  `content_html` text NOT NULL,
  `module` varchar(255) NOT NULL default '',
  `date_added` datetime NOT NULL default '0001-01-01 00:00:00',
  `date_sent` datetime default NULL,
  `status` int(1) default NULL,
  `locked` int(1) default '0',
  PRIMARY KEY  (`newsletters_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=ujis;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `orders_id` int(11) NOT NULL auto_increment,
  `customers_id` int(11) NOT NULL default '0',
  `customers_name` varchar(64) NOT NULL default '',
  `customers_company` varchar(32) default NULL,
  `customers_street_address` varchar(64) NOT NULL default '',
  `customers_suburb` varchar(32) default NULL,
  `customers_city` varchar(32) NOT NULL default '',
  `customers_postcode` varchar(10) NOT NULL default '',
  `customers_state` varchar(32) default NULL,
  `customers_country` varchar(32) NOT NULL default '',
  `customers_telephone` varchar(32) default NULL,
  `customers_email_address` varchar(96) NOT NULL default '',
  `customers_address_format_id` int(5) NOT NULL default '0',
  `delivery_name` varchar(64) NOT NULL default '',
  `delivery_company` varchar(32) default NULL,
  `delivery_street_address` varchar(64) NOT NULL default '',
  `delivery_suburb` varchar(32) default NULL,
  `delivery_city` varchar(32) NOT NULL default '',
  `delivery_postcode` varchar(10) NOT NULL default '',
  `delivery_state` varchar(32) default NULL,
  `delivery_country` varchar(32) NOT NULL default '',
  `delivery_address_format_id` int(5) NOT NULL default '0',
  `billing_name` varchar(64) NOT NULL default '',
  `billing_company` varchar(32) default NULL,
  `billing_street_address` varchar(64) NOT NULL default '',
  `billing_suburb` varchar(32) default NULL,
  `billing_city` varchar(32) NOT NULL default '',
  `billing_postcode` varchar(10) NOT NULL default '',
  `billing_state` varchar(32) default NULL,
  `billing_country` varchar(32) NOT NULL default '',
  `billing_address_format_id` int(5) NOT NULL default '0',
  `payment_method` varchar(128) NOT NULL default '',
  `payment_module_code` varchar(32) NOT NULL default '',
  `shipping_method` varchar(128) NOT NULL default '',
  `shipping_module_code` varchar(32) NOT NULL default '',
  `coupon_code` varchar(32) NOT NULL default '',
  `cc_type` varchar(20) default NULL,
  `cc_owner` varchar(64) default NULL,
  `cc_number` varchar(32) default NULL,
  `cc_expires` varchar(4) default NULL,
  `cc_cvv` blob,
  `last_modified` datetime default NULL,
  `date_purchased` datetime default NULL,
  `orders_status` int(5) NOT NULL default '0',
  `orders_date_finished` datetime default NULL,
  `currency` varchar(3) default NULL,
  `currency_value` decimal(14,6) default NULL,
  `order_total` decimal(14,2) default NULL,
  `order_tax` decimal(14,2) default NULL,
  `paypal_ipn_id` int(11) NOT NULL default '0',
  `ip_address` varchar(96) NOT NULL default '',
  `delivery_telephone` varchar(32) default NULL,
  `delivery_fax` varchar(32) default NULL,
  `billing_telephone` varchar(32) default NULL,
  `billing_fax` varchar(32) default NULL,
  `customers_fax` varchar(32) default NULL,
  `customers_name_kana` varchar(64) NOT NULL default '',
  `delivery_name_kana` varchar(64) NOT NULL default '',
  `billing_name_kana` varchar(64) NOT NULL default '',
  `date_completed` datetime default NULL,
  `date_cancelled` datetime default NULL,
  `balance_due` decimal(14,2) default NULL,
  PRIMARY KEY  (`orders_id`),
  KEY `idx_status_orders_cust_zen` (`orders_status`,`orders_id`,`customers_id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=ujis;

--
-- Table structure for table `orders_products`
--

DROP TABLE IF EXISTS `orders_products`;
CREATE TABLE `orders_products` (
  `orders_products_id` int(11) NOT NULL auto_increment,
  `orders_id` int(11) NOT NULL default '0',
  `products_id` int(11) NOT NULL default '0',
  `products_model` varchar(32) default NULL,
  `products_name` varchar(64) NOT NULL default '',
  `products_price` decimal(15,4) NOT NULL default '0.0000',
  `final_price` decimal(15,4) NOT NULL default '0.0000',
  `products_tax` decimal(7,4) NOT NULL default '0.0000',
  `products_quantity` float NOT NULL default '0',
  `onetime_charges` decimal(15,4) NOT NULL default '0.0000',
  `products_priced_by_attribute` tinyint(1) NOT NULL default '0',
  `product_is_free` tinyint(1) NOT NULL default '0',
  `products_discount_type` tinyint(1) NOT NULL default '0',
  `products_discount_type_from` tinyint(1) NOT NULL default '0',
  `products_prid` tinytext NOT NULL,
  PRIMARY KEY  (`orders_products_id`),
  KEY `idx_orders_id_prod_id_zen` (`orders_id`,`products_id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=ujis;

--
-- Table structure for table `orders_products_attributes`
--

DROP TABLE IF EXISTS `orders_products_attributes`;
CREATE TABLE `orders_products_attributes` (
  `orders_products_attributes_id` int(11) NOT NULL auto_increment,
  `orders_id` int(11) NOT NULL default '0',
  `orders_products_id` int(11) NOT NULL default '0',
  `products_options` varchar(32) NOT NULL default '',
  `products_options_values` blob NOT NULL,
  `options_values_price` decimal(15,4) NOT NULL default '0.0000',
  `price_prefix` char(1) NOT NULL default '',
  `product_attribute_is_free` tinyint(1) NOT NULL default '0',
  `products_attributes_weight` float NOT NULL default '0',
  `products_attributes_weight_prefix` char(1) NOT NULL default '',
  `attributes_discounted` tinyint(1) NOT NULL default '1',
  `attributes_price_base_included` tinyint(1) NOT NULL default '1',
  `attributes_price_onetime` decimal(15,4) NOT NULL default '0.0000',
  `attributes_price_factor` decimal(15,4) NOT NULL default '0.0000',
  `attributes_price_factor_offset` decimal(15,4) NOT NULL default '0.0000',
  `attributes_price_factor_onetime` decimal(15,4) NOT NULL default '0.0000',
  `attributes_price_factor_onetime_offset` decimal(15,4) NOT NULL default '0.0000',
  `attributes_qty_prices` text,
  `attributes_qty_prices_onetime` text,
  `attributes_price_words` decimal(15,4) NOT NULL default '0.0000',
  `attributes_price_words_free` int(4) NOT NULL default '0',
  `attributes_price_letters` decimal(15,4) NOT NULL default '0.0000',
  `attributes_price_letters_free` int(4) NOT NULL default '0',
  `products_options_id` int(11) NOT NULL default '0',
  `products_options_values_id` int(11) NOT NULL default '0',
  `products_prid` tinytext NOT NULL,
  PRIMARY KEY  (`orders_products_attributes_id`),
  KEY `idx_orders_id_prod_id_zen` (`orders_id`,`orders_products_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=ujis;

--
-- Table structure for table `orders_products_download`
--

DROP TABLE IF EXISTS `orders_products_download`;
CREATE TABLE `orders_products_download` (
  `orders_products_download_id` int(11) NOT NULL auto_increment,
  `orders_id` int(11) NOT NULL default '0',
  `orders_products_id` int(11) NOT NULL default '0',
  `orders_products_filename` varchar(255) NOT NULL default '',
  `download_maxdays` int(2) NOT NULL default '0',
  `download_count` int(2) NOT NULL default '0',
  `products_prid` tinytext NOT NULL,
  PRIMARY KEY  (`orders_products_download_id`),
  KEY `idx_orders_id_zen` (`orders_id`),
  KEY `idx_orders_products_id_zen` (`orders_products_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=ujis;

--
-- Table structure for table `orders_status`
--

DROP TABLE IF EXISTS `orders_status`;
CREATE TABLE `orders_status` (
  `orders_status_id` int(11) NOT NULL default '0',
  `language_id` int(11) NOT NULL default '1',
  `orders_status_name` varchar(32) NOT NULL default '',
  PRIMARY KEY  (`orders_status_id`,`language_id`),
  KEY `idx_orders_status_name_zen` (`orders_status_name`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table `orders_status`
--

LOCK TABLES `orders_status` WRITE;
/*!40000 ALTER TABLE `orders_status` DISABLE KEYS */;
INSERT INTO `orders_status` VALUES (1,1,'Pending');
INSERT INTO `orders_status` VALUES (2,1,'Processing');
INSERT INTO `orders_status` VALUES (3,1,'Delivered');
INSERT INTO `orders_status` VALUES (4,1,'Update');
INSERT INTO `orders_status` VALUES (1,2,'処理待ち');
INSERT INTO `orders_status` VALUES (2,2,'処理中');
INSERT INTO `orders_status` VALUES (3,2,'配送済み');
INSERT INTO `orders_status` VALUES (4,2,'更新');
INSERT INTO `orders_status` VALUES (4,9,'更新');
INSERT INTO `orders_status` VALUES (1,9,'処理待ち');
INSERT INTO `orders_status` VALUES (3,9,'配送済み');
INSERT INTO `orders_status` VALUES (2,9,'処理中');
/*!40000 ALTER TABLE `orders_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders_status_history`
--

DROP TABLE IF EXISTS `orders_status_history`;
CREATE TABLE `orders_status_history` (
  `orders_status_history_id` int(11) NOT NULL auto_increment,
  `orders_id` int(11) NOT NULL default '0',
  `orders_status_id` int(5) NOT NULL default '0',
  `date_added` datetime NOT NULL default '0001-01-01 00:00:00',
  `customer_notified` int(1) default '0',
  `comments` text,
  PRIMARY KEY  (`orders_status_history_id`),
  KEY `idx_orders_id_status_id_zen` (`orders_id`,`orders_status_id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=ujis;

--
-- Table structure for table `orders_total`
--

DROP TABLE IF EXISTS `orders_total`;
CREATE TABLE `orders_total` (
  `orders_total_id` int(10) unsigned NOT NULL auto_increment,
  `orders_id` int(11) NOT NULL default '0',
  `title` varchar(255) NOT NULL default '',
  `text` varchar(255) NOT NULL default '',
  `value` decimal(15,4) NOT NULL default '0.0000',
  `class` varchar(32) NOT NULL default '',
  `sort_order` int(11) NOT NULL default '0',
  PRIMARY KEY  (`orders_total_id`),
  KEY `idx_ot_orders_id_zen` (`orders_id`),
  KEY `idx_ot_class_zen` (`class`)
) ENGINE=MyISAM AUTO_INCREMENT=131 DEFAULT CHARSET=ujis;

--
-- Table structure for table `paypal`
--

DROP TABLE IF EXISTS `paypal`;
CREATE TABLE `paypal` (
  `paypal_ipn_id` int(11) unsigned NOT NULL auto_increment,
  `zen_order_id` int(11) unsigned NOT NULL default '0',
  `txn_type` varchar(10) NOT NULL default '',
  `reason_code` varchar(15) default NULL,
  `payment_type` varchar(7) NOT NULL default '',
  `payment_status` varchar(17) NOT NULL default '',
  `pending_reason` varchar(14) default NULL,
  `invoice` varchar(64) default NULL,
  `mc_currency` varchar(3) NOT NULL default '',
  `first_name` varchar(32) NOT NULL default '',
  `last_name` varchar(32) NOT NULL default '',
  `payer_business_name` varchar(64) default NULL,
  `address_name` varchar(32) default NULL,
  `address_street` varchar(64) default NULL,
  `address_city` varchar(32) default NULL,
  `address_state` varchar(32) default NULL,
  `address_zip` varchar(10) default NULL,
  `address_country` varchar(64) default NULL,
  `address_status` varchar(11) default NULL,
  `payer_email` varchar(96) NOT NULL default '',
  `payer_id` varchar(32) NOT NULL default '',
  `payer_status` varchar(10) NOT NULL default '',
  `payment_date` datetime NOT NULL default '0001-01-01 00:00:00',
  `business` varchar(96) NOT NULL default '',
  `receiver_email` varchar(96) NOT NULL default '',
  `receiver_id` varchar(32) NOT NULL default '',
  `txn_id` varchar(17) NOT NULL default '',
  `parent_txn_id` varchar(17) default NULL,
  `num_cart_items` tinyint(4) unsigned NOT NULL default '1',
  `mc_gross` decimal(7,2) NOT NULL default '0.00',
  `mc_fee` decimal(7,2) NOT NULL default '0.00',
  `payment_gross` decimal(7,2) default NULL,
  `payment_fee` decimal(7,2) default NULL,
  `settle_amount` decimal(7,2) default NULL,
  `settle_currency` varchar(3) default NULL,
  `exchange_rate` decimal(4,2) default NULL,
  `notify_version` decimal(2,1) NOT NULL default '0.0',
  `verify_sign` varchar(128) NOT NULL default '',
  `last_modified` datetime NOT NULL default '0001-01-01 00:00:00',
  `date_added` datetime NOT NULL default '0001-01-01 00:00:00',
  `memo` text,
  PRIMARY KEY  (`paypal_ipn_id`,`txn_id`),
  KEY `idx_zen_order_id_zen` (`zen_order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Table structure for table `paypal_payment_status`
--

DROP TABLE IF EXISTS `paypal_payment_status`;
CREATE TABLE `paypal_payment_status` (
  `payment_status_id` int(11) NOT NULL auto_increment,
  `payment_status_name` varchar(64) NOT NULL default '',
  PRIMARY KEY  (`payment_status_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `paypal_payment_status`
--

LOCK TABLES `paypal_payment_status` WRITE;
/*!40000 ALTER TABLE `paypal_payment_status` DISABLE KEYS */;
INSERT INTO `paypal_payment_status` VALUES (1,'Completed');
INSERT INTO `paypal_payment_status` VALUES (2,'Pending');
INSERT INTO `paypal_payment_status` VALUES (3,'Failed');
INSERT INTO `paypal_payment_status` VALUES (4,'Denied');
INSERT INTO `paypal_payment_status` VALUES (5,'Refunded');
INSERT INTO `paypal_payment_status` VALUES (6,'Canceled_Reversal');
INSERT INTO `paypal_payment_status` VALUES (7,'Reversed');
/*!40000 ALTER TABLE `paypal_payment_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paypal_payment_status_history`
--

DROP TABLE IF EXISTS `paypal_payment_status_history`;
CREATE TABLE `paypal_payment_status_history` (
  `payment_status_history_id` int(11) NOT NULL auto_increment,
  `paypal_ipn_id` int(11) NOT NULL default '0',
  `txn_id` varchar(64) NOT NULL default '',
  `parent_txn_id` varchar(64) NOT NULL default '',
  `payment_status` varchar(17) NOT NULL default '',
  `pending_reason` varchar(14) default NULL,
  `date_added` datetime NOT NULL default '0001-01-01 00:00:00',
  PRIMARY KEY  (`payment_status_history_id`),
  KEY `idx_paypal_ipn_id_zen` (`paypal_ipn_id`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Table structure for table `paypal_session`
--

DROP TABLE IF EXISTS `paypal_session`;
CREATE TABLE `paypal_session` (
  `unique_id` int(11) NOT NULL auto_increment,
  `session_id` text NOT NULL,
  `saved_session` blob NOT NULL,
  `expiry` int(17) NOT NULL default '0',
  PRIMARY KEY  (`unique_id`),
  KEY `idx_session_id_zen` (`session_id`(36))
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Table structure for table `paypal_testing`
--

DROP TABLE IF EXISTS `paypal_testing`;
CREATE TABLE `paypal_testing` (
  `paypal_ipn_id` int(11) unsigned NOT NULL auto_increment,
  `zen_order_id` int(11) unsigned NOT NULL default '0',
  `custom` varchar(255) NOT NULL default '',
  `txn_type` varchar(10) NOT NULL default '',
  `reason_code` varchar(15) default NULL,
  `payment_type` varchar(7) NOT NULL default '',
  `payment_status` varchar(17) NOT NULL default '',
  `pending_reason` varchar(14) default NULL,
  `invoice` varchar(64) default NULL,
  `mc_currency` varchar(3) NOT NULL default '',
  `first_name` varchar(32) NOT NULL default '',
  `last_name` varchar(32) NOT NULL default '',
  `payer_business_name` varchar(64) default NULL,
  `address_name` varchar(32) default NULL,
  `address_street` varchar(64) default NULL,
  `address_city` varchar(32) default NULL,
  `address_state` varchar(32) default NULL,
  `address_zip` varchar(10) default NULL,
  `address_country` varchar(64) default NULL,
  `address_status` varchar(11) default NULL,
  `payer_email` varchar(96) NOT NULL default '',
  `payer_id` varchar(32) NOT NULL default '',
  `payer_status` varchar(10) NOT NULL default '',
  `payment_date` datetime NOT NULL default '0001-01-01 00:00:00',
  `business` varchar(96) NOT NULL default '',
  `receiver_email` varchar(96) NOT NULL default '',
  `receiver_id` varchar(32) NOT NULL default '',
  `txn_id` varchar(17) NOT NULL default '',
  `parent_txn_id` varchar(17) default NULL,
  `num_cart_items` tinyint(4) unsigned NOT NULL default '1',
  `mc_gross` decimal(7,2) NOT NULL default '0.00',
  `mc_fee` decimal(7,2) NOT NULL default '0.00',
  `payment_gross` decimal(7,2) default NULL,
  `payment_fee` decimal(7,2) default NULL,
  `settle_amount` decimal(7,2) default NULL,
  `settle_currency` varchar(3) default NULL,
  `exchange_rate` decimal(4,2) default NULL,
  `notify_version` decimal(2,1) NOT NULL default '0.0',
  `verify_sign` varchar(128) NOT NULL default '',
  `last_modified` datetime NOT NULL default '0001-01-01 00:00:00',
  `date_added` datetime NOT NULL default '0001-01-01 00:00:00',
  `memo` text,
  PRIMARY KEY  (`paypal_ipn_id`,`txn_id`),
  KEY `idx_zen_order_id_zen` (`zen_order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Table structure for table `point_histories`
--

DROP TABLE IF EXISTS `point_histories`;
CREATE TABLE `point_histories` (
  `id` int(11) NOT NULL auto_increment,
  `customers_id` int(11) NOT NULL default '0',
  `related_id_name` varchar(64) NOT NULL default '',
  `related_id_value` int(11) NOT NULL default '0',
  `deposit` int(11) NOT NULL default '0',
  `withdraw` int(11) NOT NULL default '0',
  `pending` int(11) NOT NULL default '0',
  `description` varchar(255) NOT NULL default '',
  `class` varchar(64) NOT NULL default '',
  `created_at` datetime NOT NULL default '0000-00-00 00:00:00',
  `updated_at` datetime default NULL,
  `status` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `IDX_customers_id_status` (`customers_id`,`status`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=ujis;

--
-- Table structure for table `product_music_extra`
--

DROP TABLE IF EXISTS `product_music_extra`;
CREATE TABLE `product_music_extra` (
  `products_id` int(11) NOT NULL default '0',
  `artists_id` int(11) NOT NULL default '0',
  `record_company_id` int(11) NOT NULL default '0',
  `music_genre_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`products_id`),
  KEY `idx_music_genre_id_zen` (`music_genre_id`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table `product_music_extra`
--

LOCK TABLES `product_music_extra` WRITE;
/*!40000 ALTER TABLE `product_music_extra` DISABLE KEYS */;
INSERT INTO `product_music_extra` VALUES (212,1,0,2);
INSERT INTO `product_music_extra` VALUES (213,0,1,2);
INSERT INTO `product_music_extra` VALUES (229,0,1,2);
/*!40000 ALTER TABLE `product_music_extra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_type_layout`
--

DROP TABLE IF EXISTS `product_type_layout`;
CREATE TABLE `product_type_layout` (
  `configuration_id` int(11) NOT NULL auto_increment,
  `configuration_title` text NOT NULL,
  `configuration_key` varchar(255) NOT NULL default '',
  `configuration_value` text NOT NULL,
  `configuration_description` text NOT NULL,
  `product_type_id` int(11) NOT NULL default '0',
  `sort_order` int(5) default NULL,
  `last_modified` datetime default NULL,
  `date_added` datetime NOT NULL default '0001-01-01 00:00:00',
  `use_function` text,
  `set_function` text,
  PRIMARY KEY  (`configuration_id`),
  UNIQUE KEY `unq_config_key_zen` (`configuration_key`),
  KEY `idx_key_value_zen` (`configuration_key`,`configuration_value`(10))
) ENGINE=MyISAM AUTO_INCREMENT=144 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `product_type_layout`
--

LOCK TABLES `product_type_layout` WRITE;
/*!40000 ALTER TABLE `product_type_layout` DISABLE KEYS */;
INSERT INTO `product_type_layout` VALUES (1,'型番表示','SHOW_PRODUCT_INFO_MODEL','1','商品情報で型番を表示する 0= off 1= on',1,1,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (2,'重量表示','SHOW_PRODUCT_INFO_WEIGHT','1','商品情報で型番を表示する 0= off 1= on',1,2,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (3,'オプション重量表示','SHOW_PRODUCT_INFO_WEIGHT_ATTRIBUTES','1','商品情報でオプションの重量を表示する。 0= off 1= on',1,3,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (4,'メーカーの表示','SHOW_PRODUCT_INFO_MANUFACTURER','1','商品ページに、メーカー名を表示しますか？0= off 1= on',1,4,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (5,'カート内の数量表示','SHOW_PRODUCT_INFO_IN_CART_QTY','1','商品情報でカート内の数量を表示する。 0= off 1= on',1,5,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (6,'在庫数表示','SHOW_PRODUCT_INFO_QUANTITY','1','商品情報で在庫数を表示する。 0= off 1= on',1,6,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (7,'レビュー数表示','SHOW_PRODUCT_INFO_REVIEWS_COUNT','1','商品情報でレビュー数を表示する 0= off 1= on',1,7,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (8,'レビューボタン表示','SHOW_PRODUCT_INFO_REVIEWS','1','商品情報でレビューボタンを表示する 0= off 1= on',1,8,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (9,'購入可能になった日付の表示','SHOW_PRODUCT_INFO_DATE_AVAILABLE','1','商品情報で商品が購入可能になった日付を表示する。 0= off 1= on',1,9,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (10,'登録日表示','SHOW_PRODUCT_INFO_DATE_ADDED','1','商品情報で商品が登録された日付を表示します。 0= off 1= on',1,10,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (11,'商品URL表示','SHOW_PRODUCT_INFO_URL','1','商品情報で商品のURLを表示する 0= off 1= on',1,11,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (12,'Show Product Additional Images','SHOW_PRODUCT_INFO_ADDITIONAL_IMAGES','1','Display Additional Images on Product Info 0= off 1= on',1,13,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (13,'ベース価格の表示','SHOW_PRODUCT_INFO_STARTING_AT','1','商品ページに、ベース価格を表示しますか？0= off 1= on',1,12,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (14,'「友達に知らせる」ボタン表示','SHOW_PRODUCT_INFO_TELL_A_FRIEND','1','商品情報で「友達に知らせる」ボタンを表示する。<br /><br />Note: この設定をoffにしてもサイドボックスの「友達に知らせる」は消えません。また、サイドボックスの「友達に知らせる」をoffにしてもこのボタン表示の設定に影響はありません。<br />0= off 1= on',1,15,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (15,'送料無料の画像ステータス - カタログ','SHOW_PRODUCT_INFO_ALWAYS_FREE_SHIPPING_IMAGE_SWITCH','0','カタログ中の送料無料の画像/テキストを表示しますか？',1,16,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO `product_type_layout` VALUES (16,'税種別のデフォルト - 新商品追加時','DEFAULT_PRODUCT_TAX_CLASS_ID','0','新商品を追加する時の、税種別のデフォルトIDを入力してください。',1,100,NULL,'2009-11-19 12:39:40','','');
INSERT INTO `product_type_layout` VALUES (17,'ヴァーチャル商品のデフォルトステータス - 新商品追加時','DEFAULT_PRODUCT_PRODUCTS_VIRTUAL','0','新商品を追加する時の、ヴァーチャル商品のデフォルトステータスをONにしますか？',1,101,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (18,'Product Free Shipping Default Status - Normal Shipping Rules - When adding new products?','DEFAULT_PRODUCT_PRODUCTS_IS_ALWAYS_FREE_SHIPPING','0','What should the Default Free Shipping status be when adding new products?<br />Yes, Always Free Shipping ON<br />No, Always Free Shipping OFF<br />Special, Product/Download Requires Shipping',1,102,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes, Always ON\'), array(\'id\'=>\'0\', \'text\'=>\'No, Always OFF\'), array(\'id\'=>\'2\', \'text\'=>\'Special\')), ');
INSERT INTO `product_type_layout` VALUES (19,'型番表示','SHOW_PRODUCT_MUSIC_INFO_MODEL','1','商品情報で型番を表示する 0= off 1= on',2,1,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (20,'重量表示','SHOW_PRODUCT_MUSIC_INFO_WEIGHT','0','商品情報で型番を表示する 0= off 1= on',2,2,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (21,'オプション重量表示','SHOW_PRODUCT_MUSIC_INFO_WEIGHT_ATTRIBUTES','1','商品情報でオプションの重量を表示する。 0= off 1= on',2,3,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (22,'アーティストの表示','SHOW_PRODUCT_MUSIC_INFO_ARTIST','1','商品ページに、アーティスト名を表示しますか？0= off 1= on',2,4,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (23,'音楽ジャンルの表示','SHOW_PRODUCT_MUSIC_INFO_GENRE','1','商品ページに、音楽ジャンルを表示しますか？0= off 1= on',2,4,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (24,'レコード会社の表示','SHOW_PRODUCT_MUSIC_INFO_RECORD_COMPANY','1','商品ページに、レコード会社を表示しますか？0= off 1= on',2,4,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (25,'カート内の数量表示','SHOW_PRODUCT_MUSIC_INFO_IN_CART_QTY','1','商品情報でカート内の数量を表示する。 0= off 1= on',2,5,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (26,'在庫数表示','SHOW_PRODUCT_MUSIC_INFO_QUANTITY','0','商品情報で在庫数を表示する。 0= off 1= on',2,6,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (27,'レビュー数表示','SHOW_PRODUCT_MUSIC_INFO_REVIEWS_COUNT','1','商品情報でレビュー数を表示する 0= off 1= on',2,7,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (28,'レビューボタン表示','SHOW_PRODUCT_MUSIC_INFO_REVIEWS','1','商品情報でレビューボタンを表示する 0= off 1= on',2,8,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (29,'購入可能になった日付の表示','SHOW_PRODUCT_MUSIC_INFO_DATE_AVAILABLE','1','商品情報で商品が購入可能になった日付を表示する。 0= off 1= on',2,9,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (30,'登録日表示','SHOW_PRODUCT_MUSIC_INFO_DATE_ADDED','1','商品情報で商品が登録された日付を表示します。 0= off 1= on',2,10,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (31,'ベース価格の表示','SHOW_PRODUCT_MUSIC_INFO_STARTING_AT','1','商品ページに、ベース価格を表示しますか？0= off 1= on',2,12,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (32,'Show Product Additional Images','SHOW_PRODUCT_MUSIC_INFO_ADDITIONAL_IMAGES','1','Display Additional Images on Product Info 0= off 1= on',2,13,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (33,'「友達に知らせる」ボタン表示','SHOW_PRODUCT_MUSIC_INFO_TELL_A_FRIEND','1','商品情報で「友達に知らせる」ボタンを表示する。<br /><br />Note: この設定をoffにしてもサイドボックスの「友達に知らせる」は消えません。また、サイドボックスの「友達に知らせる」をoffにしてもこのボタン表示の設定に影響はありません。<br />0= off 1= on',2,15,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (34,'送料無料の画像ステータス - カタログ','SHOW_PRODUCT_MUSIC_INFO_ALWAYS_FREE_SHIPPING_IMAGE_SWITCH','0','カタログ中の送料無料の画像/テキストを表示しますか？',2,16,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO `product_type_layout` VALUES (35,'税種別のデフォルト - 新商品追加時','DEFAULT_PRODUCT_MUSIC_TAX_CLASS_ID','0','新商品を追加する時の、税種別のデフォルトIDを入力してください。',2,100,NULL,'2009-11-19 12:39:40','','');
INSERT INTO `product_type_layout` VALUES (36,'ヴァーチャル商品のデフォルトステータス - 新商品追加時','DEFAULT_PRODUCT_MUSIC_PRODUCTS_VIRTUAL','0','新商品を追加する時の、ヴァーチャル商品のデフォルトステータスをONにしますか？',2,101,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (37,'Product Free Shipping Default Status - Normal Shipping Rules - When adding new products?','DEFAULT_PRODUCT_MUSIC_PRODUCTS_IS_ALWAYS_FREE_SHIPPING','0','What should the Default Free Shipping status be when adding new products?<br />Yes, Always Free Shipping ON<br />No, Always Free Shipping OFF<br />Special, Product/Download Requires Shipping',2,102,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes, Always ON\'), array(\'id\'=>\'0\', \'text\'=>\'No, Always OFF\'), array(\'id\'=>\'2\', \'text\'=>\'Special\')), ');
INSERT INTO `product_type_layout` VALUES (38,'レビュー数表示','SHOW_DOCUMENT_GENERAL_INFO_REVIEWS_COUNT','1','商品情報でレビュー数を表示する 0= off 1= on',3,7,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (39,'レビューボタン表示','SHOW_DOCUMENT_GENERAL_INFO_REVIEWS','1','商品情報でレビューボタンを表示する 0= off 1= on',3,8,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (40,'購入可能になった日付の表示','SHOW_DOCUMENT_GENERAL_INFO_DATE_AVAILABLE','1','商品情報で商品が購入可能になった日付を表示する。 0= off 1= on',3,9,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (41,'登録日表示','SHOW_DOCUMENT_GENERAL_INFO_DATE_ADDED','1','商品情報で商品が登録された日付を表示します。 0= off 1= on',3,10,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (42,'「友達に知らせる」ボタン表示','SHOW_DOCUMENT_GENERAL_INFO_TELL_A_FRIEND','1','商品情報で「友達に知らせる」ボタンを表示する。<br /><br />Note: この設定をoffにしてもサイドボックスの「友達に知らせる」は消えません。また、サイドボックスの「友達に知らせる」をoffにしてもこのボタン表示の設定に影響はありません。<br />0= off 1= on',3,15,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (43,'商品URL表示','SHOW_DOCUMENT_GENERAL_INFO_URL','1','商品情報で商品のURLを表示する 0= off 1= on',3,11,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (44,'Show Product Additional Images','SHOW_DOCUMENT_GENERAL_INFO_ADDITIONAL_IMAGES','1','Display Additional Images on Product Info 0= off 1= on',3,13,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (45,'型番表示','SHOW_DOCUMENT_PRODUCT_INFO_MODEL','1','商品情報で型番を表示する 0= off 1= on',4,1,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (46,'重量表示','SHOW_DOCUMENT_PRODUCT_INFO_WEIGHT','0','商品情報で型番を表示する 0= off 1= on',4,2,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (47,'オプション重量表示','SHOW_DOCUMENT_PRODUCT_INFO_WEIGHT_ATTRIBUTES','1','商品情報でオプションの重量を表示する。 0= off 1= on',4,3,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (48,'メーカーの表示','SHOW_DOCUMENT_PRODUCT_INFO_MANUFACTURER','1','商品ページに、メーカー名を表示しますか？0= off 1= on',4,4,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (49,'カート内の数量表示','SHOW_DOCUMENT_PRODUCT_INFO_IN_CART_QTY','1','商品情報でカート内の数量を表示する。 0= off 1= on',4,5,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (50,'在庫数表示','SHOW_DOCUMENT_PRODUCT_INFO_QUANTITY','0','商品情報で在庫数を表示する。 0= off 1= on',4,6,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (51,'レビュー数表示','SHOW_DOCUMENT_PRODUCT_INFO_REVIEWS_COUNT','1','商品情報でレビュー数を表示する 0= off 1= on',4,7,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (52,'レビューボタン表示','SHOW_DOCUMENT_PRODUCT_INFO_REVIEWS','1','商品情報でレビューボタンを表示する 0= off 1= on',4,8,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (53,'購入可能になった日付の表示','SHOW_DOCUMENT_PRODUCT_INFO_DATE_AVAILABLE','1','商品情報で商品が購入可能になった日付を表示する。 0= off 1= on',4,9,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (54,'登録日表示','SHOW_DOCUMENT_PRODUCT_INFO_DATE_ADDED','1','商品情報で商品が登録された日付を表示します。 0= off 1= on',4,10,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (55,'商品URL表示','SHOW_DOCUMENT_PRODUCT_INFO_URL','1','商品情報で商品のURLを表示する 0= off 1= on',4,11,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (56,'Show Product Additional Images','SHOW_DOCUMENT_PRODUCT_INFO_ADDITIONAL_IMAGES','1','Display Additional Images on Product Info 0= off 1= on',4,13,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (57,'ベース価格の表示','SHOW_DOCUMENT_PRODUCT_INFO_STARTING_AT','1','商品ページに、ベース価格を表示しますか？0= off 1= on',4,12,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (58,'「友達に知らせる」ボタン表示','SHOW_DOCUMENT_PRODUCT_INFO_TELL_A_FRIEND','1','商品情報で「友達に知らせる」ボタンを表示する。<br /><br />Note: この設定をoffにしてもサイドボックスの「友達に知らせる」は消えません。また、サイドボックスの「友達に知らせる」をoffにしてもこのボタン表示の設定に影響はありません。<br />0= off 1= on',4,15,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (59,'送料無料の画像ステータス - カタログ','SHOW_DOCUMENT_PRODUCT_INFO_ALWAYS_FREE_SHIPPING_IMAGE_SWITCH','0','カタログ中の送料無料の画像/テキストを表示しますか？',4,16,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO `product_type_layout` VALUES (60,'税種別のデフォルト - 新商品追加時','DEFAULT_DOCUMENT_PRODUCT_TAX_CLASS_ID','0','新商品を追加する時の、税種別のデフォルトIDを入力してください。',4,100,NULL,'2009-11-19 12:39:40','','');
INSERT INTO `product_type_layout` VALUES (61,'ヴァーチャル商品のデフォルトステータス - 新商品追加時','DEFAULT_DOCUMENT_PRODUCT_PRODUCTS_VIRTUAL','0','新商品を追加する時の、ヴァーチャル商品のデフォルトステータスをONにしますか？',4,101,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (62,'Product Free Shipping Default Status - Normal Shipping Rules - When adding new products?','DEFAULT_DOCUMENT_PRODUCT_PRODUCTS_IS_ALWAYS_FREE_SHIPPING','0','What should the Default Free Shipping status be when adding new products?<br />Yes, Always Free Shipping ON<br />No, Always Free Shipping OFF<br />Special, Product/Download Requires Shipping',4,102,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes, Always ON\'), array(\'id\'=>\'0\', \'text\'=>\'No, Always OFF\'), array(\'id\'=>\'2\', \'text\'=>\'Special\')), ');
INSERT INTO `product_type_layout` VALUES (63,'型番表示','SHOW_PRODUCT_FREE_SHIPPING_INFO_MODEL','1','商品情報で型番を表示する 0= off 1= on',5,1,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (64,'重量表示','SHOW_PRODUCT_FREE_SHIPPING_INFO_WEIGHT','0','商品情報で型番を表示する 0= off 1= on',5,2,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (65,'オプション重量表示','SHOW_PRODUCT_FREE_SHIPPING_INFO_WEIGHT_ATTRIBUTES','1','商品情報でオプションの重量を表示する。 0= off 1= on',5,3,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (66,'メーカーの表示','SHOW_PRODUCT_FREE_SHIPPING_INFO_MANUFACTURER','1','商品ページに、メーカー名を表示しますか？0= off 1= on',5,4,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (67,'カート内の数量表示','SHOW_PRODUCT_FREE_SHIPPING_INFO_IN_CART_QTY','1','商品情報でカート内の数量を表示する。 0= off 1= on',5,5,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (68,'在庫数表示','SHOW_PRODUCT_FREE_SHIPPING_INFO_QUANTITY','1','商品情報で在庫数を表示する。 0= off 1= on',5,6,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (69,'レビュー数表示','SHOW_PRODUCT_FREE_SHIPPING_INFO_REVIEWS_COUNT','1','商品情報でレビュー数を表示する 0= off 1= on',5,7,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (70,'レビューボタン表示','SHOW_PRODUCT_FREE_SHIPPING_INFO_REVIEWS','1','商品情報でレビューボタンを表示する 0= off 1= on',5,8,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (71,'購入可能になった日付の表示','SHOW_PRODUCT_FREE_SHIPPING_INFO_DATE_AVAILABLE','0','商品情報で商品が購入可能になった日付を表示する。 0= off 1= on',5,9,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (72,'登録日表示','SHOW_PRODUCT_FREE_SHIPPING_INFO_DATE_ADDED','1','商品情報で商品が登録された日付を表示します。 0= off 1= on',5,10,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (73,'商品URL表示','SHOW_PRODUCT_FREE_SHIPPING_INFO_URL','1','商品情報で商品のURLを表示する 0= off 1= on',5,11,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (74,'Show Product Additional Images','SHOW_PRODUCT_FREE_SHIPPING_INFO_ADDITIONAL_IMAGES','1','Display Additional Images on Product Info 0= off 1= on',5,13,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (75,'ベース価格の表示','SHOW_PRODUCT_FREE_SHIPPING_INFO_STARTING_AT','1','商品ページに、ベース価格を表示しますか？0= off 1= on',5,12,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (76,'「友達に知らせる」ボタン表示','SHOW_PRODUCT_FREE_SHIPPING_INFO_TELL_A_FRIEND','1','商品情報で「友達に知らせる」ボタンを表示する。<br /><br />Note: この設定をoffにしてもサイドボックスの「友達に知らせる」は消えません。また、サイドボックスの「友達に知らせる」をoffにしてもこのボタン表示の設定に影響はありません。<br />0= off 1= on',5,15,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (77,'送料無料の画像ステータス - カタログ','SHOW_PRODUCT_FREE_SHIPPING_INFO_ALWAYS_FREE_SHIPPING_IMAGE_SWITCH','1','カタログ中の送料無料の画像/テキストを表示しますか？',5,16,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO `product_type_layout` VALUES (78,'税種別のデフォルト - 新商品追加時','DEFAULT_PRODUCT_FREE_SHIPPING_TAX_CLASS_ID','0','新商品を追加する時の、税種別のデフォルトIDを入力してください。',5,100,NULL,'2009-11-19 12:39:40','','');
INSERT INTO `product_type_layout` VALUES (79,'ヴァーチャル商品のデフォルトステータス - 新商品追加時','DEFAULT_PRODUCT_FREE_SHIPPING_PRODUCTS_VIRTUAL','0','新商品を追加する時の、ヴァーチャル商品のデフォルトステータスをONにしますか？',5,101,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (80,'Product Free Shipping Default Status - Normal Shipping Rules - When adding new products?','DEFAULT_PRODUCT_FREE_SHIPPING_PRODUCTS_IS_ALWAYS_FREE_SHIPPING','1','What should the Default Free Shipping status be when adding new products?<br />Yes, Always Free Shipping ON<br />No, Always Free Shipping OFF<br />Special, Product/Download Requires Shipping',5,102,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes, Always ON\'), array(\'id\'=>\'0\', \'text\'=>\'No, Always OFF\'), array(\'id\'=>\'2\', \'text\'=>\'Special\')), ');
INSERT INTO `product_type_layout` VALUES (81,'Show Metatags Title Default - Product Title','SHOW_PRODUCT_INFO_METATAGS_TITLE_STATUS','1','Display Product Title in Meta Tags Title 0= off 1= on',1,50,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (82,'Show Metatags Title Default - Product Name','SHOW_PRODUCT_INFO_METATAGS_PRODUCTS_NAME_STATUS','1','Display Product Name in Meta Tags Title 0= off 1= on',1,51,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (83,'Show Metatags Title Default - Product Model','SHOW_PRODUCT_INFO_METATAGS_MODEL_STATUS','1','Display Product Model in Meta Tags Title 0= off 1= on',1,52,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (84,'Show Metatags Title Default - Product Price','SHOW_PRODUCT_INFO_METATAGS_PRICE_STATUS','1','Display Product Price in Meta Tags Title 0= off 1= on',1,53,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (85,'Show Metatags Title Default - Product Tagline','SHOW_PRODUCT_INFO_METATAGS_TITLE_TAGLINE_STATUS','1','Display Product Tagline in Meta Tags Title 0= off 1= on',1,54,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (86,'Show Metatags Title Default - Product Title','SHOW_PRODUCT_MUSIC_INFO_METATAGS_TITLE_STATUS','1','Display Product Title in Meta Tags Title 0= off 1= on',2,50,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (87,'Show Metatags Title Default - Product Name','SHOW_PRODUCT_MUSIC_INFO_METATAGS_PRODUCTS_NAME_STATUS','1','Display Product Name in Meta Tags Title 0= off 1= on',2,51,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (88,'Show Metatags Title Default - Product Model','SHOW_PRODUCT_MUSIC_INFO_METATAGS_MODEL_STATUS','1','Display Product Model in Meta Tags Title 0= off 1= on',2,52,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (89,'Show Metatags Title Default - Product Price','SHOW_PRODUCT_MUSIC_INFO_METATAGS_PRICE_STATUS','1','Display Product Price in Meta Tags Title 0= off 1= on',2,53,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (90,'Show Metatags Title Default - Product Tagline','SHOW_PRODUCT_MUSIC_INFO_METATAGS_TITLE_TAGLINE_STATUS','1','Display Product Tagline in Meta Tags Title 0= off 1= on',2,54,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (91,'Show Metatags Title Default - Document Title','SHOW_DOCUMENT_GENERAL_INFO_METATAGS_TITLE_STATUS','1','Display Document Title in Meta Tags Title 0= off 1= on',3,50,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (92,'Show Metatags Title Default - Document Name','SHOW_DOCUMENT_GENERAL_INFO_METATAGS_PRODUCTS_NAME_STATUS','1','Display Document Name in Meta Tags Title 0= off 1= on',3,51,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (93,'Show Metatags Title Default - Document Tagline','SHOW_DOCUMENT_GENERAL_INFO_METATAGS_TITLE_TAGLINE_STATUS','1','Display Document Tagline in Meta Tags Title 0= off 1= on',3,54,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (94,'Show Metatags Title Default - Document Title','SHOW_DOCUMENT_PRODUCT_INFO_METATAGS_TITLE_STATUS','1','Display Document Title in Meta Tags Title 0= off 1= on',4,50,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (95,'Show Metatags Title Default - Document Name','SHOW_DOCUMENT_PRODUCT_INFO_METATAGS_PRODUCTS_NAME_STATUS','1','Display Document Name in Meta Tags Title 0= off 1= on',4,51,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (96,'Show Metatags Title Default - Document Model','SHOW_DOCUMENT_PRODUCT_INFO_METATAGS_MODEL_STATUS','1','Display Document Model in Meta Tags Title 0= off 1= on',4,52,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (97,'Show Metatags Title Default - Document Price','SHOW_DOCUMENT_PRODUCT_INFO_METATAGS_PRICE_STATUS','1','Display Document Price in Meta Tags Title 0= off 1= on',4,53,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (98,'Show Metatags Title Default - Document Tagline','SHOW_DOCUMENT_PRODUCT_INFO_METATAGS_TITLE_TAGLINE_STATUS','1','Display Document Tagline in Meta Tags Title 0= off 1= on',4,54,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (99,'Show Metatags Title Default - Product Title','SHOW_PRODUCT_FREE_SHIPPING_INFO_METATAGS_TITLE_STATUS','1','Display Product Title in Meta Tags Title 0= off 1= on',5,50,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (100,'Show Metatags Title Default - Product Name','SHOW_PRODUCT_FREE_SHIPPING_INFO_METATAGS_PRODUCTS_NAME_STATUS','1','Display Product Name in Meta Tags Title 0= off 1= on',5,51,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (101,'Show Metatags Title Default - Product Model','SHOW_PRODUCT_FREE_SHIPPING_INFO_METATAGS_MODEL_STATUS','1','Display Product Model in Meta Tags Title 0= off 1= on',5,52,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (102,'Show Metatags Title Default - Product Price','SHOW_PRODUCT_FREE_SHIPPING_INFO_METATAGS_PRICE_STATUS','1','Display Product Price in Meta Tags Title 0= off 1= on',5,53,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (103,'Show Metatags Title Default - Product Tagline','SHOW_PRODUCT_FREE_SHIPPING_INFO_METATAGS_TITLE_TAGLINE_STATUS','1','Display Product Tagline in Meta Tags Title 0= off 1= on',5,54,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO `product_type_layout` VALUES (104,'PRODUCT Attribute is Display Only - Default','DEFAULT_PRODUCT_ATTRIBUTES_DISPLAY_ONLY','0','PRODUCT Attribute is Display Only<br />Used For Display Purposes Only<br />0= No 1= Yes',1,200,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO `product_type_layout` VALUES (105,'PRODUCT Attribute is Free - Default','DEFAULT_PRODUCT_ATTRIBUTE_IS_FREE','1','PRODUCT Attribute is Free<br />Attribute is Free When Product is Free<br />0= No 1= Yes',1,201,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO `product_type_layout` VALUES (106,'PRODUCT Attribute is Default - Default','DEFAULT_PRODUCT_ATTRIBUTES_DEFAULT','0','PRODUCT Attribute is Default<br />Default Attribute to be Marked Selected<br />0= No 1= Yes',1,202,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO `product_type_layout` VALUES (107,'PRODUCT Attribute is Discounted - Default','DEFAULT_PRODUCT_ATTRIBUTES_DISCOUNTED','1','PRODUCT Attribute is Discounted<br />Apply Discounts Used by Product Special/Sale<br />0= No 1= Yes',1,203,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO `product_type_layout` VALUES (108,'PRODUCT Attribute is Included in Base Price - Default','DEFAULT_PRODUCT_ATTRIBUTES_PRICE_BASE_INCLUDED','1','PRODUCT Attribute is Included in Base Price<br />Include in Base Price When Priced by Attributes<br />0= No 1= Yes',1,204,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO `product_type_layout` VALUES (109,'PRODUCT Attribute is Required - Default','DEFAULT_PRODUCT_ATTRIBUTES_REQUIRED','0','PRODUCT Attribute is Required<br />Attribute Required for Text<br />0= No 1= Yes',1,205,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO `product_type_layout` VALUES (110,'PRODUCT Attribute Price Prefix - Default','DEFAULT_PRODUCT_PRICE_PREFIX','1','PRODUCT Attribute Price Prefix<br />Default Attribute Price Prefix for Adding<br />Blank, + or -',1,206,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Blank\'), array(\'id\'=>\'1\', \'text\'=>\'+\'), array(\'id\'=>\'2\', \'text\'=>\'-\')), ');
INSERT INTO `product_type_layout` VALUES (111,'PRODUCT Attribute Weight Prefix - Default','DEFAULT_PRODUCT_PRODUCTS_ATTRIBUTES_WEIGHT_PREFIX','1','PRODUCT Attribute Weight Prefix<br />Default Attribute Weight Prefix<br />Blank, + or -',1,207,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Blank\'), array(\'id\'=>\'1\', \'text\'=>\'+\'), array(\'id\'=>\'2\', \'text\'=>\'-\')), ');
INSERT INTO `product_type_layout` VALUES (112,'MUSIC Attribute is Display Only - Default','DEFAULT_PRODUCT_MUSIC_ATTRIBUTES_DISPLAY_ONLY','0','MUSIC Attribute is Display Only<br />Used For Display Purposes Only<br />0= No 1= Yes',2,200,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO `product_type_layout` VALUES (113,'MUSIC Attribute is Free - Default','DEFAULT_PRODUCT_MUSIC_ATTRIBUTE_IS_FREE','1','MUSIC Attribute is Free<br />Attribute is Free When Product is Free<br />0= No 1= Yes',2,201,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO `product_type_layout` VALUES (114,'MUSIC Attribute is Default - Default','DEFAULT_PRODUCT_MUSIC_ATTRIBUTES_DEFAULT','0','MUSIC Attribute is Default<br />Default Attribute to be Marked Selected<br />0= No 1= Yes',2,202,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO `product_type_layout` VALUES (115,'MUSIC Attribute is Discounted - Default','DEFAULT_PRODUCT_MUSIC_ATTRIBUTES_DISCOUNTED','1','MUSIC Attribute is Discounted<br />Apply Discounts Used by Product Special/Sale<br />0= No 1= Yes',2,203,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO `product_type_layout` VALUES (116,'MUSIC Attribute is Included in Base Price - Default','DEFAULT_PRODUCT_MUSIC_ATTRIBUTES_PRICE_BASE_INCLUDED','1','MUSIC Attribute is Included in Base Price<br />Include in Base Price When Priced by Attributes<br />0= No 1= Yes',2,204,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO `product_type_layout` VALUES (117,'MUSIC Attribute is Required - Default','DEFAULT_PRODUCT_MUSIC_ATTRIBUTES_REQUIRED','0','MUSIC Attribute is Required<br />Attribute Required for Text<br />0= No 1= Yes',2,205,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO `product_type_layout` VALUES (118,'MUSIC Attribute Price Prefix - Default','DEFAULT_PRODUCT_MUSIC_PRICE_PREFIX','1','MUSIC Attribute Price Prefix<br />Default Attribute Price Prefix for Adding<br />Blank, + or -',2,206,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Blank\'), array(\'id\'=>\'1\', \'text\'=>\'+\'), array(\'id\'=>\'2\', \'text\'=>\'-\')), ');
INSERT INTO `product_type_layout` VALUES (119,'MUSIC Attribute Weight Prefix - Default','DEFAULT_PRODUCT_MUSIC_PRODUCTS_ATTRIBUTES_WEIGHT_PREFIX','1','MUSIC Attribute Weight Prefix<br />Default Attribute Weight Prefix<br />Blank, + or -',2,207,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Blank\'), array(\'id\'=>\'1\', \'text\'=>\'+\'), array(\'id\'=>\'2\', \'text\'=>\'-\')), ');
INSERT INTO `product_type_layout` VALUES (120,'DOCUMENT GENERAL Attribute is Display Only - Default','DEFAULT_DOCUMENT_GENERAL_ATTRIBUTES_DISPLAY_ONLY','0','DOCUMENT GENERAL Attribute is Display Only<br />Used For Display Purposes Only<br />0= No 1= Yes',3,200,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO `product_type_layout` VALUES (121,'DOCUMENT GENERAL Attribute is Free - Default','DEFAULT_DOCUMENT_GENERAL_ATTRIBUTE_IS_FREE','1','DOCUMENT GENERAL Attribute is Free<br />Attribute is Free When Product is Free<br />0= No 1= Yes',3,201,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO `product_type_layout` VALUES (122,'DOCUMENT GENERAL Attribute is Default - Default','DEFAULT_DOCUMENT_GENERAL_ATTRIBUTES_DEFAULT','0','DOCUMENT GENERAL Attribute is Default<br />Default Attribute to be Marked Selected<br />0= No 1= Yes',3,202,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO `product_type_layout` VALUES (123,'DOCUMENT GENERAL Attribute is Discounted - Default','DEFAULT_DOCUMENT_GENERAL_ATTRIBUTES_DISCOUNTED','1','DOCUMENT GENERAL Attribute is Discounted<br />Apply Discounts Used by Product Special/Sale<br />0= No 1= Yes',3,203,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO `product_type_layout` VALUES (124,'DOCUMENT GENERAL Attribute is Included in Base Price - Default','DEFAULT_DOCUMENT_GENERAL_ATTRIBUTES_PRICE_BASE_INCLUDED','1','DOCUMENT GENERAL Attribute is Included in Base Price<br />Include in Base Price When Priced by Attributes<br />0= No 1= Yes',3,204,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO `product_type_layout` VALUES (125,'DOCUMENT GENERAL Attribute is Required - Default','DEFAULT_DOCUMENT_GENERAL_ATTRIBUTES_REQUIRED','0','DOCUMENT GENERAL Attribute is Required<br />Attribute Required for Text<br />0= No 1= Yes',3,205,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO `product_type_layout` VALUES (126,'DOCUMENT GENERAL Attribute Price Prefix - Default','DEFAULT_DOCUMENT_GENERAL_PRICE_PREFIX','1','DOCUMENT GENERAL Attribute Price Prefix<br />Default Attribute Price Prefix for Adding<br />Blank, + or -',3,206,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Blank\'), array(\'id\'=>\'1\', \'text\'=>\'+\'), array(\'id\'=>\'2\', \'text\'=>\'-\')), ');
INSERT INTO `product_type_layout` VALUES (127,'DOCUMENT GENERAL Attribute Weight Prefix - Default','DEFAULT_DOCUMENT_GENERAL_PRODUCTS_ATTRIBUTES_WEIGHT_PREFIX','1','DOCUMENT GENERAL Attribute Weight Prefix<br />Default Attribute Weight Prefix<br />Blank, + or -',3,207,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Blank\'), array(\'id\'=>\'1\', \'text\'=>\'+\'), array(\'id\'=>\'2\', \'text\'=>\'-\')), ');
INSERT INTO `product_type_layout` VALUES (128,'DOCUMENT PRODUCT Attribute is Display Only - Default','DEFAULT_DOCUMENT_PRODUCT_ATTRIBUTES_DISPLAY_ONLY','0','DOCUMENT PRODUCT Attribute is Display Only<br />Used For Display Purposes Only<br />0= No 1= Yes',4,200,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO `product_type_layout` VALUES (129,'DOCUMENT PRODUCT Attribute is Free - Default','DEFAULT_DOCUMENT_PRODUCT_ATTRIBUTE_IS_FREE','1','DOCUMENT PRODUCT Attribute is Free<br />Attribute is Free When Product is Free<br />0= No 1= Yes',4,201,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO `product_type_layout` VALUES (130,'DOCUMENT PRODUCT Attribute is Default - Default','DEFAULT_DOCUMENT_PRODUCT_ATTRIBUTES_DEFAULT','0','DOCUMENT PRODUCT Attribute is Default<br />Default Attribute to be Marked Selected<br />0= No 1= Yes',4,202,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO `product_type_layout` VALUES (131,'DOCUMENT PRODUCT Attribute is Discounted - Default','DEFAULT_DOCUMENT_PRODUCT_ATTRIBUTES_DISCOUNTED','1','DOCUMENT PRODUCT Attribute is Discounted<br />Apply Discounts Used by Product Special/Sale<br />0= No 1= Yes',4,203,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO `product_type_layout` VALUES (132,'DOCUMENT PRODUCT Attribute is Included in Base Price - Default','DEFAULT_DOCUMENT_PRODUCT_ATTRIBUTES_PRICE_BASE_INCLUDED','1','DOCUMENT PRODUCT Attribute is Included in Base Price<br />Include in Base Price When Priced by Attributes<br />0= No 1= Yes',4,204,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO `product_type_layout` VALUES (133,'DOCUMENT PRODUCT Attribute is Required - Default','DEFAULT_DOCUMENT_PRODUCT_ATTRIBUTES_REQUIRED','0','DOCUMENT PRODUCT Attribute is Required<br />Attribute Required for Text<br />0= No 1= Yes',4,205,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO `product_type_layout` VALUES (134,'DOCUMENT PRODUCT Attribute Price Prefix - Default','DEFAULT_DOCUMENT_PRODUCT_PRICE_PREFIX','1','DOCUMENT PRODUCT Attribute Price Prefix<br />Default Attribute Price Prefix for Adding<br />Blank, + or -',4,206,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Blank\'), array(\'id\'=>\'1\', \'text\'=>\'+\'), array(\'id\'=>\'2\', \'text\'=>\'-\')), ');
INSERT INTO `product_type_layout` VALUES (135,'DOCUMENT PRODUCT Attribute Weight Prefix - Default','DEFAULT_DOCUMENT_PRODUCT_PRODUCTS_ATTRIBUTES_WEIGHT_PREFIX','1','DOCUMENT PRODUCT Attribute Weight Prefix<br />Default Attribute Weight Prefix<br />Blank, + or -',4,207,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Blank\'), array(\'id\'=>\'1\', \'text\'=>\'+\'), array(\'id\'=>\'2\', \'text\'=>\'-\')), ');
INSERT INTO `product_type_layout` VALUES (136,'PRODUCT FREE SHIPPING Attribute is Display Only - Default','DEFAULT_PRODUCT_FREE_SHIPPING_ATTRIBUTES_DISPLAY_ONLY','0','PRODUCT FREE SHIPPING Attribute is Display Only<br />Used For Display Purposes Only<br />0= No 1= Yes',5,201,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO `product_type_layout` VALUES (137,'PRODUCT FREE SHIPPING Attribute is Free - Default','DEFAULT_PRODUCT_FREE_SHIPPING_ATTRIBUTE_IS_FREE','1','PRODUCT FREE SHIPPING Attribute is Free<br />Attribute is Free When Product is Free<br />0= No 1= Yes',5,201,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO `product_type_layout` VALUES (138,'PRODUCT FREE SHIPPING Attribute is Default - Default','DEFAULT_PRODUCT_FREE_SHIPPING_ATTRIBUTES_DEFAULT','0','PRODUCT FREE SHIPPING Attribute is Default<br />Default Attribute to be Marked Selected<br />0= No 1= Yes',5,202,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO `product_type_layout` VALUES (139,'PRODUCT FREE SHIPPING Attribute is Discounted - Default','DEFAULT_PRODUCT_FREE_SHIPPING_ATTRIBUTES_DISCOUNTED','1','PRODUCT FREE SHIPPING Attribute is Discounted<br />Apply Discounts Used by Product Special/Sale<br />0= No 1= Yes',5,203,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO `product_type_layout` VALUES (140,'PRODUCT FREE SHIPPING Attribute is Included in Base Price - Default','DEFAULT_PRODUCT_FREE_SHIPPING_ATTRIBUTES_PRICE_BASE_INCLUDED','1','PRODUCT FREE SHIPPING Attribute is Included in Base Price<br />Include in Base Price When Priced by Attributes<br />0= No 1= Yes',5,204,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO `product_type_layout` VALUES (141,'PRODUCT FREE SHIPPING Attribute is Required - Default','DEFAULT_PRODUCT_FREE_SHIPPING_ATTRIBUTES_REQUIRED','0','PRODUCT FREE SHIPPING Attribute is Required<br />Attribute Required for Text<br />0= No 1= Yes',5,205,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO `product_type_layout` VALUES (142,'PRODUCT FREE SHIPPING Attribute Price Prefix - Default','DEFAULT_PRODUCT_FREE_SHIPPING_PRICE_PREFIX','1','PRODUCT FREE SHIPPING Attribute Price Prefix<br />Default Attribute Price Prefix for Adding<br />Blank, + or -',5,206,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Blank\'), array(\'id\'=>\'1\', \'text\'=>\'+\'), array(\'id\'=>\'2\', \'text\'=>\'-\')), ');
INSERT INTO `product_type_layout` VALUES (143,'PRODUCT FREE SHIPPING Attribute Weight Prefix - Default','DEFAULT_PRODUCT_FREE_SHIPPING_PRODUCTS_ATTRIBUTES_WEIGHT_PREFIX','1','PRODUCT FREE SHIPPING Attribute Weight Prefix<br />Default Attribute Weight Prefix<br />Blank, + or -',5,207,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Blank\'), array(\'id\'=>\'1\', \'text\'=>\'+\'), array(\'id\'=>\'2\', \'text\'=>\'-\')), ');
/*!40000 ALTER TABLE `product_type_layout` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_types`
--

DROP TABLE IF EXISTS `product_types`;
CREATE TABLE `product_types` (
  `type_id` int(11) NOT NULL auto_increment,
  `type_name` varchar(255) NOT NULL default '',
  `type_handler` varchar(255) NOT NULL default '',
  `type_master_type` int(11) NOT NULL default '1',
  `allow_add_to_cart` char(1) NOT NULL default 'Y',
  `default_image` varchar(255) NOT NULL default '',
  `date_added` datetime NOT NULL default '0001-01-01 00:00:00',
  `last_modified` datetime NOT NULL default '0001-01-01 00:00:00',
  PRIMARY KEY  (`type_id`),
  KEY `idx_type_master_type_zen` (`type_master_type`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `product_types`
--

LOCK TABLES `product_types` WRITE;
/*!40000 ALTER TABLE `product_types` DISABLE KEYS */;
INSERT INTO `product_types` VALUES (1,'Product - General','product',1,'Y','','2009-11-19 12:39:40','2009-11-19 12:39:40');
INSERT INTO `product_types` VALUES (2,'Product - Music','product_music',1,'Y','','2009-11-19 12:39:40','2009-11-19 12:39:40');
INSERT INTO `product_types` VALUES (3,'Document - General','document_general',3,'N','','2009-11-19 12:39:40','2009-11-19 12:39:40');
INSERT INTO `product_types` VALUES (4,'Document - Product','document_product',3,'Y','','2009-11-19 12:39:40','2009-11-19 12:39:40');
INSERT INTO `product_types` VALUES (5,'Product - Free Shipping','product_free_shipping',1,'Y','','2009-11-19 12:39:40','2009-11-19 12:39:40');
/*!40000 ALTER TABLE `product_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_types_to_category`
--

DROP TABLE IF EXISTS `product_types_to_category`;
CREATE TABLE `product_types_to_category` (
  `product_type_id` int(11) NOT NULL default '0',
  `category_id` int(11) NOT NULL default '0',
  KEY `idx_category_id_zen` (`category_id`),
  KEY `idx_product_type_id_zen` (`product_type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table `product_types_to_category`
--

LOCK TABLES `product_types_to_category` WRITE;
/*!40000 ALTER TABLE `product_types_to_category` DISABLE KEYS */;
INSERT INTO `product_types_to_category` VALUES (2,91);
INSERT INTO `product_types_to_category` VALUES (3,93);
INSERT INTO `product_types_to_category` VALUES (4,93);
INSERT INTO `product_types_to_category` VALUES (1,97);
INSERT INTO `product_types_to_category` VALUES (3,97);
INSERT INTO `product_types_to_category` VALUES (4,90);
INSERT INTO `product_types_to_category` VALUES (4,92);
INSERT INTO `product_types_to_category` VALUES (4,97);
INSERT INTO `product_types_to_category` VALUES (5,98);
/*!40000 ALTER TABLE `product_types_to_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `products_id` int(11) NOT NULL auto_increment,
  `products_type` int(11) NOT NULL default '1',
  `products_quantity` float NOT NULL default '0',
  `products_model` varchar(32) default NULL,
  `products_image` varchar(64) default NULL,
  `products_price` decimal(15,4) NOT NULL default '0.0000',
  `products_virtual` tinyint(1) NOT NULL default '0',
  `products_date_added` datetime NOT NULL default '0001-01-01 00:00:00',
  `products_last_modified` datetime default NULL,
  `products_date_available` datetime default NULL,
  `products_weight` float NOT NULL default '0',
  `products_status` tinyint(1) NOT NULL default '0',
  `products_tax_class_id` int(11) NOT NULL default '0',
  `manufacturers_id` int(11) default NULL,
  `products_ordered` float NOT NULL default '0',
  `products_quantity_order_min` float NOT NULL default '1',
  `products_quantity_order_units` float NOT NULL default '1',
  `products_priced_by_attribute` tinyint(1) NOT NULL default '0',
  `product_is_free` tinyint(1) NOT NULL default '0',
  `product_is_call` tinyint(1) NOT NULL default '0',
  `products_quantity_mixed` tinyint(1) NOT NULL default '0',
  `product_is_always_free_shipping` tinyint(1) NOT NULL default '0',
  `products_qty_box_status` tinyint(1) NOT NULL default '1',
  `products_quantity_order_max` float NOT NULL default '0',
  `products_sort_order` int(11) NOT NULL default '0',
  `products_discount_type` tinyint(1) NOT NULL default '0',
  `products_discount_type_from` tinyint(1) NOT NULL default '0',
  `products_price_sorter` decimal(15,4) NOT NULL default '0.0000',
  `master_categories_id` int(11) NOT NULL default '0',
  `products_mixed_discount_quantity` tinyint(1) NOT NULL default '1',
  `metatags_title_status` tinyint(1) NOT NULL default '0',
  `metatags_products_name_status` tinyint(1) NOT NULL default '0',
  `metatags_model_status` tinyint(1) NOT NULL default '0',
  `metatags_price_status` tinyint(1) NOT NULL default '0',
  `metatags_title_tagline_status` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`products_id`),
  KEY `idx_products_date_added_zen` (`products_date_added`),
  KEY `idx_products_status_zen` (`products_status`)
) ENGINE=MyISAM AUTO_INCREMENT=230 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,1,1000,'SAMPLE-T01','sample_t/t-shirt_01.gif','4500.0000',0,'2007-01-16 15:03:58','2007-01-21 22:27:22',NULL,0.25,1,1,3,0,1,1,0,0,0,0,0,1,0,0,0,0,'4050.0000',2,1,0,0,0,0,0);
INSERT INTO `products` VALUES (2,1,1000,'SAMPLE-T02','sample_t/t-shirt_02.gif','4500.0000',0,'2007-01-16 15:03:58','2007-01-21 22:28:03',NULL,0.25,1,1,3,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',4,1,0,0,0,0,0);
INSERT INTO `products` VALUES (3,1,1000,'SAMPLE-T03','sample_t/t-shirt_03.gif','4500.0000',0,'2007-01-16 15:03:56','2007-01-21 22:27:35',NULL,0.25,1,1,3,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',2,1,0,0,0,0,0);
INSERT INTO `products` VALUES (4,1,1000,'SAMPLE-T04','sample_t/t-shirt_04.gif','4500.0000',0,'2007-01-16 15:03:56','2007-01-20 17:48:17',NULL,0.25,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',2,1,0,0,0,0,0);
INSERT INTO `products` VALUES (5,1,999,'SAMPLE-T05','sample_t/t-shirt_05.gif','4500.0000',0,'2007-01-16 15:03:56','2007-01-21 22:27:48',NULL,0.25,1,1,3,1,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',4,1,0,0,0,0,0);
INSERT INTO `products` VALUES (6,1,997,'SAMPLE-T06','sample_t/t-shirt_06.gif','4500.0000',0,'2007-01-16 15:03:58','2007-01-16 15:03:58',NULL,0.25,1,1,NULL,3,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',5,1,0,0,0,0,0);
INSERT INTO `products` VALUES (7,1,1000,'SAMPLE-T06KIDS','sample_t/t-shirt_06.gif','3800.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.2,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'3800.0000',7,1,0,0,0,0,0);
INSERT INTO `products` VALUES (8,1,1000,'SAMPLE-T07','sample_t/t-shirt_07.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',8,1,0,0,0,0,0);
INSERT INTO `products` VALUES (9,1,996,'SAMPLE-T08','sample_t/t-shirt_08.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,4,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',5,1,0,0,0,0,0);
INSERT INTO `products` VALUES (10,1,1000,'SAMPLE-T09','sample_t/t-shirt_09.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',8,1,0,0,0,0,0);
INSERT INTO `products` VALUES (11,1,996,'SAMPLE-T10','sample_t/t-shirt_10.gif','4500.0000',0,'2007-01-16 15:03:58','2007-01-18 00:42:21',NULL,0.25,1,1,0,4,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',5,1,0,0,0,0,0);
INSERT INTO `products` VALUES (12,1,0,'SAMPLE-T10KIDS','sample_t/t-shirt_10.gif','3800.0000',0,'2007-01-16 15:03:57','2007-02-01 18:55:14',NULL,0.2,1,1,1,0,1,1,0,0,0,0,0,1,0,10,0,0,'3800.0000',7,1,0,0,0,0,0);
INSERT INTO `products` VALUES (13,1,1000,'SAMPLE-T11','sample_t/t-shirt_11.gif','4500.0000',0,'2007-01-16 15:03:57','2007-02-01 18:56:23',NULL,0.25,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',8,1,0,0,0,0,0);
INSERT INTO `products` VALUES (14,1,0,'SAMPLE-T12','sample_t/t-shirt_12.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-21 22:11:55',NULL,0.25,1,1,0,0,1,1,0,0,0,0,0,1,0,12,0,0,'4500.0000',5,1,0,0,0,0,0);
INSERT INTO `products` VALUES (15,1,1000,'SAMPLE-T13','sample_t/t-shirt_13.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',9,1,0,0,0,0,0);
INSERT INTO `products` VALUES (16,1,1000,'SAMPLE-T13KIDS','sample_t/t-shirt_13.gif','3800.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.2,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'3800.0000',10,1,0,0,0,0,0);
INSERT INTO `products` VALUES (17,1,999,'SAMPLE-T14','sample_t/t-shirt_14.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,1,1,1,0,0,0,0,0,1,0,0,0,0,'3800.0000',11,0,0,0,0,0,0);
INSERT INTO `products` VALUES (18,1,1000,'SAMPLE-T15','sample_t/t-shirt_15.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',8,1,0,0,0,0,0);
INSERT INTO `products` VALUES (19,1,1000,'SAMPLE-T16','sample_t/t-shirt_16.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-21 22:25:53',NULL,0.25,1,1,4,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',12,1,0,0,0,0,0);
INSERT INTO `products` VALUES (20,1,1000,'SAMPLE-T16KIDS','sample_t/t-shirt_16.gif','3800.0000',0,'2007-01-16 15:03:57','2007-01-21 22:30:37',NULL,0.2,1,1,4,0,1,1,0,0,0,0,0,1,0,0,0,0,'3800.0000',7,1,0,0,0,0,0);
INSERT INTO `products` VALUES (21,1,1000,'SAMPLE-T17','sample_t/t-shirt_17.gif','4500.0000',0,'2007-01-16 15:03:58','2007-01-21 22:26:50',NULL,0.25,1,1,3,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',13,1,0,0,0,0,0);
INSERT INTO `products` VALUES (22,1,1000,'SAMPLE-T18','sample_t/t-shirt_18.gif','4500.0000',0,'2007-01-16 15:03:58','2007-01-21 22:26:38',NULL,0.25,1,1,3,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',13,1,0,0,0,0,0);
INSERT INTO `products` VALUES (23,1,1000,'SAMPLE-T19','sample_t/t-shirt_19.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',14,1,0,0,0,0,0);
INSERT INTO `products` VALUES (24,1,1000,'SAMPLE-T20','sample_t/t-shirt_20.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',14,1,0,0,0,0,0);
INSERT INTO `products` VALUES (25,1,997,'SAMPLE-T21','sample_t/t-shirt_21.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,3,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',11,1,0,0,0,0,0);
INSERT INTO `products` VALUES (26,1,1000,'SAMPLE-T21KIDS','sample_t/t-shirt_21.gif','3800.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.2,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'3800.0000',7,1,0,0,0,0,0);
INSERT INTO `products` VALUES (27,1,999,'SAMPLE-T22','sample_t/t-shirt_22.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-21 22:31:27',NULL,0.25,1,1,4,1,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',12,1,0,0,0,0,0);
INSERT INTO `products` VALUES (28,1,1000,'SAMPLE-T22KIDS','sample_t/t-shirt_22.gif','3800.0000',0,'2007-01-16 15:03:57','2007-01-21 22:30:49',NULL,0.2,1,1,4,0,1,1,0,0,0,0,0,1,0,0,0,0,'3800.0000',7,1,0,0,0,0,0);
INSERT INTO `products` VALUES (29,1,999,'SAMPLE-T23','sample_t/t-shirt_23.gif','4500.0000',0,'2007-01-16 15:03:58','2007-01-16 15:03:58',NULL,0.25,1,1,NULL,1,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',14,1,0,0,0,0,0);
INSERT INTO `products` VALUES (30,1,1000,'SAMPLE-T23KIDS','sample_t/t-shirt_23.gif','3800.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.2,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'3800.0000',7,1,0,0,0,0,0);
INSERT INTO `products` VALUES (31,1,1000,'SAMPLE-T24','sample_t/t-shirt_24.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',14,1,0,0,0,0,0);
INSERT INTO `products` VALUES (32,1,998,'SAMPLE-T25','sample_t/t-shirt_25.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-18 00:35:01',NULL,0.25,1,1,0,2,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',14,1,0,0,0,0,0);
INSERT INTO `products` VALUES (33,1,1000,'SAMPLE-T26','sample_t/t-shirt_26.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',13,1,0,0,0,0,0);
INSERT INTO `products` VALUES (34,1,1000,'SAMPLE-T27','sample_t/t-shirt_27.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',13,1,0,0,0,0,0);
INSERT INTO `products` VALUES (35,1,1000,'SAMPLE-T28','sample_t/t-shirt_28.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',9,1,0,0,0,0,0);
INSERT INTO `products` VALUES (36,1,1000,'SAMPLE-T28KIDS','sample_t/t-shirt_28.gif','3800.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.2,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'3800.0000',10,1,0,0,0,0,0);
INSERT INTO `products` VALUES (37,1,1000,'SAMPLE-T29','sample_t/t-shirt_29.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',9,1,0,0,0,0,0);
INSERT INTO `products` VALUES (38,1,1000,'SAMPLE-T30','sample_t/t-shirt_30.gif','4500.0000',0,'2007-01-16 15:03:58','2007-01-26 03:38:47',NULL,0.25,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',9,1,0,0,0,0,0);
INSERT INTO `products` VALUES (39,1,1000,'SAMPLE-T30KIDS','sample_t/t-shirt_30.gif','3800.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.2,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'3800.0000',10,1,0,0,0,0,0);
INSERT INTO `products` VALUES (40,1,999,'SAMPLE-T31','sample_t/t-shirt_31.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,1,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',9,1,0,0,0,0,0);
INSERT INTO `products` VALUES (41,1,1000,'SAMPLE-T31KIDS','sample_t/t-shirt_31.gif','3800.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.2,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'3800.0000',10,1,0,0,0,0,0);
INSERT INTO `products` VALUES (42,1,1000,'SAMPLE-T32','sample_t/t-shirt_32.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',13,1,0,0,0,0,0);
INSERT INTO `products` VALUES (43,1,999,'SAMPLE-T33','sample_t/t-shirt_33.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-21 21:26:40','2007-06-10 00:00:00',0.25,1,1,0,1,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',12,1,0,0,0,0,0);
INSERT INTO `products` VALUES (44,1,1000,'SAMPLE-T34','sample_t/t-shirt_34.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',12,1,0,0,0,0,0);
INSERT INTO `products` VALUES (45,1,1000,'SAMPLE-T35','sample_t/t-shirt_35.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',13,1,0,0,0,0,0);
INSERT INTO `products` VALUES (46,1,1000,'SAMPLE-T36','sample_t/t-shirt_36.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-21 22:26:23',NULL,0.25,1,1,4,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',13,1,0,0,0,0,0);
INSERT INTO `products` VALUES (47,1,1000,'SAMPLE-T37','sample_t/t-shirt_37.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',11,1,0,0,0,0,0);
INSERT INTO `products` VALUES (48,1,999,'SAMPLE-T38','sample_t/t-shirt_38.gif','4500.0000',0,'2007-01-16 15:03:58','2007-01-21 21:25:57','2007-04-01 00:00:00',0.25,1,1,0,1,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',13,1,0,0,0,0,0);
INSERT INTO `products` VALUES (49,1,1000,'SAMPLE-T39','sample_t/t-shirt_39.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-18 00:37:13',NULL,0.25,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',13,1,0,0,0,0,0);
INSERT INTO `products` VALUES (50,1,1000,'SAMPLE-T40','sample_t/t-shirt_40.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-21 22:24:08',NULL,0.25,1,1,4,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',15,1,0,0,0,0,0);
INSERT INTO `products` VALUES (51,1,999,'SAMPLE-T41','sample_t/t-shirt_41.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-21 22:23:36',NULL,0.25,1,1,2,1,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',16,1,0,0,0,0,0);
INSERT INTO `products` VALUES (52,1,1000,'SAMPLE-T41KIDS','sample_t/t-shirt_41.gif','3800.0000',0,'2007-01-16 15:03:57','2007-01-21 22:28:43',NULL,0.2,1,1,2,0,1,1,0,0,0,0,0,1,0,0,0,0,'3800.0000',7,1,0,0,0,0,0);
INSERT INTO `products` VALUES (53,1,1000,'SAMPLE-T42','sample_t/t-shirt_42.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-21 22:22:48',NULL,0.25,1,1,1,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',16,1,0,0,0,0,0);
INSERT INTO `products` VALUES (54,1,1000,'SAMPLE-T43','sample_t/t-shirt_43.gif','4500.0000',0,'2007-01-16 15:03:58','2007-01-21 22:25:40',NULL,0.25,1,1,1,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',12,1,0,0,0,0,0);
INSERT INTO `products` VALUES (55,1,1000,'SAMPLE-T43KIDS','sample_t/t-shirt_43.gif','3800.0000',0,'2007-01-16 15:03:57','2007-01-21 22:29:01',NULL,0.2,1,1,1,0,1,1,0,0,0,0,0,1,0,0,0,0,'3800.0000',7,1,0,0,0,0,0);
INSERT INTO `products` VALUES (56,1,1000,'SAMPLE-T44','sample_t/t-shirt_44.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-21 22:25:19',NULL,0.25,1,1,1,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',12,1,0,0,0,0,0);
INSERT INTO `products` VALUES (57,1,1000,'SAMPLE-T44KIDS','sample_t/t-shirt_44.gif','3800.0000',0,'2007-01-16 15:03:57','2007-01-21 21:58:29','2007-06-03 00:00:00',0.2,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'3800.0000',17,1,0,0,0,0,0);
INSERT INTO `products` VALUES (58,1,1000,'SAMPLE-T45','sample_t/t-shirt_45.gif','4500.0000',0,'2007-01-16 15:03:58','2007-01-16 15:03:58',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',12,1,0,0,0,0,0);
INSERT INTO `products` VALUES (59,1,1000,'SAMPLE-T45KIDS','sample_t/t-shirt_45.gif','3800.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.2,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'3800.0000',17,1,0,0,0,0,0);
INSERT INTO `products` VALUES (60,1,1000,'SAMPLE-T46','sample_t/t-shirt_46.gif','4500.0000',0,'2007-01-16 15:03:58','2007-01-21 22:24:33',NULL,0.25,1,1,1,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',12,1,0,0,0,0,0);
INSERT INTO `products` VALUES (61,1,1000,'SAMPLE-T46KIDS','sample_t/t-shirt_46.gif','3800.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.2,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'3800.0000',17,1,0,0,0,0,0);
INSERT INTO `products` VALUES (62,1,999,'SAMPLE-T47','sample_t/t-shirt_47.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-21 22:22:26',NULL,0.25,1,1,1,1,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',16,1,0,0,0,0,0);
INSERT INTO `products` VALUES (63,1,1000,'SAMPLE-T48','sample_t/t-shirt_48.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-21 22:25:02','2007-08-12 00:00:00',0.25,1,1,2,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',12,1,0,0,0,0,0);
INSERT INTO `products` VALUES (64,1,996,'SAMPLE-T49','sample_t/t-shirt_49.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-21 22:23:12',NULL,0.25,1,1,2,4,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',16,1,0,0,0,0,0);
INSERT INTO `products` VALUES (65,1,999,'SAMPLE-T50','sample_t/t-shirt_50.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,1,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',2,1,0,0,0,0,0);
INSERT INTO `products` VALUES (90,1,10,'SAMPLE-WP03','sample_w/wallpaper_03.jpg','200.0000',1,'2007-01-16 15:50:07','2007-01-23 11:34:23',NULL,0,1,1,0,1,1,1,0,0,0,0,2,1,0,3,0,0,'200.0000',23,1,0,0,0,0,0);
INSERT INTO `products` VALUES (89,1,999,'SAMPLE-WP02','sample_w/wallpaper_02.jpg','200.0000',1,'2007-01-16 15:50:07','2007-01-23 11:34:10',NULL,0,1,1,0,1,1,1,0,0,0,0,2,1,0,2,0,0,'200.0000',23,1,0,0,0,0,0);
INSERT INTO `products` VALUES (88,1,998,'SAMPLE-WP01','sample_w/wallpaper_01.jpg','200.0000',1,'2007-01-16 15:50:07','2007-01-23 11:33:59',NULL,0,1,1,0,2,1,1,0,0,0,0,2,1,0,1,0,0,'200.0000',23,1,0,0,0,0,0);
INSERT INTO `products` VALUES (70,1,1000,'GIFT005','gift_certificates/gv_5.gif','500.0000',0,'2007-01-16 15:03:58','2007-01-20 14:40:45',NULL,0,1,0,0,0,1,1,0,0,0,0,0,1,0,500,0,0,'500.0000',20,1,0,0,0,0,0);
INSERT INTO `products` VALUES (71,1,1000,'GIFT 010','gift_certificates/gv_10.gif','1000.0000',0,'2007-01-16 15:03:58','2007-01-20 14:37:46',NULL,0,1,0,0,0,1,1,0,0,0,0,0,1,0,1000,0,0,'1000.0000',20,1,0,0,0,0,0);
INSERT INTO `products` VALUES (72,1,1000,'GIFT025','gift_certificates/gv_25.gif','2500.0000',0,'2007-01-16 15:03:58','2007-01-20 14:38:41',NULL,0,1,0,0,0,1,1,0,0,0,0,0,1,0,2500,0,0,'2500.0000',20,1,0,0,0,0,0);
INSERT INTO `products` VALUES (73,1,1000,'GIFT050','gift_certificates/gv_50.gif','5000.0000',0,'2007-01-16 15:03:58','2007-01-27 20:58:47',NULL,0,1,0,0,0,1,1,0,0,0,0,0,1,0,5000,0,0,'5000.0000',20,1,0,0,0,0,0);
INSERT INTO `products` VALUES (74,1,1000,'GIFT100','gift_certificates/gv_100.gif','10000.0000',0,'2007-01-16 15:03:58','2007-01-20 14:38:11',NULL,0,1,0,0,0,1,1,0,0,0,0,0,1,0,10000,0,0,'10000.0000',20,1,0,0,0,0,0);
INSERT INTO `products` VALUES (75,1,1000,'GIFTSELECT','gift_certificates/gv.gif','0.0000',0,'2007-01-16 15:03:58','2007-01-22 10:56:42',NULL,0,1,0,0,0,1,1,0,0,0,0,0,1,0,20000,0,0,'0.0000',20,1,0,0,0,0,0);
INSERT INTO `products` VALUES (76,1,1000,'NOTLINK01','sample_t/t-sample.gif','2500.0000',0,'2007-01-16 15:03:58','2007-01-18 00:28:51',NULL,1,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'2500.0000',0,1,0,0,0,0,0);
INSERT INTO `products` VALUES (77,1,1000,'NOTLINK02','sample_t/t-sample.gif','2500.0000',0,'2007-01-16 15:03:58','2007-01-18 00:29:10',NULL,1,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'2500.0000',0,1,0,0,0,0,0);
INSERT INTO `products` VALUES (78,1,1000,'NOTLINK03','sample_t/t-sample.gif','2500.0000',0,'2007-01-16 15:03:58','2007-01-18 00:29:22',NULL,1,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'2500.0000',0,1,0,0,0,0,0);
INSERT INTO `products` VALUES (79,1,1000,'NOTLINK04','sample_t/t-sample.gif','2500.0000',0,'2007-01-16 15:03:58','2007-01-18 00:29:33',NULL,1,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'2000.0000',0,1,0,0,0,0,0);
INSERT INTO `products` VALUES (80,1,1000,'NOTLINK05','sample_t/t-sample.gif','2500.0000',0,'2007-01-16 15:03:58','2007-01-18 00:29:52',NULL,1,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'2500.0000',0,1,0,0,0,0,0);
INSERT INTO `products` VALUES (81,1,1000,'NOTLINK08','sample_t/t-sample.gif','2500.0000',0,'2007-01-16 15:03:58','2007-01-18 00:30:45',NULL,1,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'2500.0000',0,1,0,0,0,0,0);
INSERT INTO `products` VALUES (82,1,1000,'NOTLINK10','sample_t/t-sample.gif','2500.0000',0,'2007-01-16 15:03:58','2007-01-18 00:31:56',NULL,1,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'2500.0000',0,1,0,0,0,0,0);
INSERT INTO `products` VALUES (83,1,1000,'NOTLINK06','sample_t/t-sample.gif','2500.0000',0,'2007-01-16 15:03:58','2007-01-18 00:31:04',NULL,1,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'2500.0000',0,1,0,0,0,0,0);
INSERT INTO `products` VALUES (84,1,1000,'NOTLINK07','sample_t/t-sample.gif','2500.0000',0,'2007-01-16 15:03:58','2007-01-18 00:31:20',NULL,1,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'2500.0000',0,1,0,0,0,0,0);
INSERT INTO `products` VALUES (85,1,1000,'NOTLINK12','sample_t/t-sample.gif','2500.0000',0,'2007-01-16 15:03:58','2007-01-18 00:32:37',NULL,1,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'2500.0000',0,1,0,0,0,0,0);
INSERT INTO `products` VALUES (86,1,1000,'NOTLINK09','sample_t/t-sample.gif','2500.0000',0,'2007-01-16 15:03:58','2007-01-18 00:31:41',NULL,1,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'2500.0000',0,1,0,0,0,0,0);
INSERT INTO `products` VALUES (87,1,1000,'NOTLINK11','sample_t/t-sample.gif','2500.0000',0,'2007-01-16 15:03:58','2007-01-18 00:32:23',NULL,1,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'2500.0000',0,1,0,0,0,0,0);
INSERT INTO `products` VALUES (92,1,998,'FREEALL','sample_t/t-sample.gif','0.0000',0,'2007-01-16 15:50:07','2007-01-26 15:10:55',NULL,1,1,0,0,2,1,1,0,1,0,0,1,1,0,10,0,0,'0.0000',40,1,0,0,0,0,0);
INSERT INTO `products` VALUES (93,1,999,'FREE3','sample_t/t-sample.gif','10000.0000',0,'2007-01-16 15:50:07','2007-01-18 09:59:02',NULL,1,1,0,0,1,1,1,0,1,0,0,0,1,0,40,0,0,'0.0000',40,1,0,0,0,0,0);
INSERT INTO `products` VALUES (91,1,1000,'SAMPLE-WP04','sample_w/wallpaper_04.jpg','200.0000',1,'2007-01-16 15:50:07','2007-01-23 11:34:34',NULL,0,1,1,4,0,1,1,0,0,0,0,2,1,0,4,0,0,'200.0000',23,1,0,0,0,0,0);
INSERT INTO `products` VALUES (222,1,1000,'FREESHIP1','sample_t/t-shirt_01.gif','4000.0000',0,'2007-01-26 15:27:23','2007-01-26 15:39:06',NULL,50,1,0,0,0,1,1,0,0,0,0,1,1,0,1,0,0,'4000.0000',79,1,0,0,0,0,0);
INSERT INTO `products` VALUES (95,1,1000,'FREE1','sample_t/t-sample.gif','10000.0000',0,'2007-01-16 15:50:07','2007-01-18 09:57:54',NULL,10,1,0,0,0,1,1,0,1,0,0,1,1,0,20,0,0,'0.0000',40,1,0,0,0,0,0);
INSERT INTO `products` VALUES (101,1,1000,'CALL3','sample_t/t-sample.gif','10000.0000',0,'2007-01-16 17:24:53','2007-01-24 09:52:47',NULL,1,1,0,0,0,1,1,0,0,1,0,0,1,0,0,0,0,'8100.0000',64,1,0,0,0,0,0);
INSERT INTO `products` VALUES (98,1,1000,'FREEATTRB1','sample_t/t-sample.gif','10000.0000',0,'2007-01-16 15:50:07','2007-01-23 00:15:26',NULL,0,1,0,0,0,1,1,0,1,0,0,0,1,0,50,0,0,'0.0000',40,1,0,0,0,0,0);
INSERT INTO `products` VALUES (99,1,1000,'CALL1','sample_t/t-sample.gif','0.0000',0,'2007-01-16 15:50:07','2007-01-16 15:50:07',NULL,1,1,0,NULL,0,1,1,0,0,1,0,0,1,0,0,0,0,'0.0000',41,1,0,0,0,0,0);
INSERT INTO `products` VALUES (100,1,1000,'CALL2','sample_t/t-sample.gif','10000.0000',0,'2007-01-16 15:50:07','2007-01-21 00:15:45',NULL,1,1,0,0,0,1,1,0,0,1,0,0,1,0,0,0,0,'10000.0000',41,1,0,0,0,0,0);
INSERT INTO `products` VALUES (102,1,1000,'DISCNTQTY1','sample_t/t-sample.gif','10000.0000',0,'2007-01-16 21:10:16','2007-01-17 23:37:02',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,10,1,0,'10000.0000',45,1,0,0,0,0,0);
INSERT INTO `products` VALUES (103,1,1000,'DISCNTQTY2','sample_t/t-sample.gif','10000.0000',0,'2007-01-16 21:10:16','2007-01-21 00:33:44',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,20,3,0,'10000.0000',45,1,0,0,0,0,0);
INSERT INTO `products` VALUES (104,1,1000,'DISCNTQTY3','sample_t/t-sample.gif','10000.0000',0,'2007-01-16 21:10:17','2007-01-17 23:37:35',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,30,2,0,'10000.0000',45,1,0,0,0,0,0);
INSERT INTO `products` VALUES (115,1,1000,'SEO','','10000.0000',0,'2007-01-16 21:41:07','2007-01-17 16:30:59',NULL,1,1,0,0,0,1,1,0,0,0,1,0,1,0,0,0,0,'10000.0000',58,1,1,1,1,1,1);
INSERT INTO `products` VALUES (113,1,1000,'DISCNTQTY8','sample_t/t-sample.gif','10000.0000',0,'2007-01-16 21:10:17','2007-01-24 15:56:19',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,80,1,1,'5000.0000',45,1,0,0,0,0,0);
INSERT INTO `products` VALUES (112,1,1000,'DISCNTQTY7','sample_t/t-sample.gif','10000.0000',0,'2007-01-16 21:10:17','2007-01-24 15:55:33',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,70,1,0,'10000.0000',45,1,0,0,0,0,0);
INSERT INTO `products` VALUES (111,1,1000,'DISCNTQTY5','sample_t/t-sample.gif','10000.0000',0,'2007-01-16 21:10:17','2007-01-17 23:55:45',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,50,1,1,'5000.0000',45,1,0,0,0,0,0);
INSERT INTO `products` VALUES (110,1,1000,'DISCNTQTY4','sample_t/t-sample.gif','10000.0000',0,'2007-01-16 21:10:17','2007-01-17 23:55:21',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,40,1,0,'9500.0000',45,1,0,0,0,0,0);
INSERT INTO `products` VALUES (116,1,1000,'SEO2','','10000.0000',0,'2007-01-16 21:54:19','2010-02-15 19:18:08',NULL,1,1,0,0,0,1,1,0,0,0,1,0,1,0,10,0,0,'10000.0000',58,1,1,1,0,0,1);
INSERT INTO `products` VALUES (151,1,1000,'ATTR_RADIO3','no_picture.gif','0.0000',0,'2007-01-17 18:12:19','2007-01-18 01:04:39',NULL,0,1,0,0,0,10,1,1,0,0,0,0,1,0,0,0,0,'5.0000',63,1,0,0,0,0,0);
INSERT INTO `products` VALUES (227,1,1000,'ATTR_FILE','sample_t/t-shirt_01.gif','4000.0000',0,'2007-01-31 01:40:08','2007-02-01 18:36:02',NULL,0.2,1,0,0,0,1,1,1,0,0,0,0,1,0,0,0,0,'5000.0000',101,1,0,0,0,0,0);
INSERT INTO `products` VALUES (139,1,1000,'ATTR_TEXT1','sample_t/t-shirt_01.gif','4000.0000',0,'2007-01-17 15:20:31','2007-01-17 17:28:37',NULL,0.2,1,0,0,0,1,1,1,0,0,0,0,1,0,0,0,0,'4000.0000',60,1,0,0,0,0,0);
INSERT INTO `products` VALUES (140,1,1000,'ATTR_TEXT2','sample_t/t-shirt_02.gif','4000.0000',0,'2007-01-17 15:20:31','2007-01-17 17:29:01',NULL,0.2,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'4000.0000',60,1,0,0,0,0,0);
INSERT INTO `products` VALUES (141,1,1000,'ATTR_RDONLY','no_picture.gif','4000.0000',0,'2007-01-17 15:20:31','2007-01-17 17:31:44',NULL,0.2,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'4000.0000',61,1,0,0,0,0,0);
INSERT INTO `products` VALUES (142,1,1000,'ATTR_CHKBOX1','sample_t/t-shirt_01.gif','4000.0000',0,'2007-01-17 15:20:31','2007-01-17 15:20:31',NULL,0.2,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'4000.0000',62,1,0,0,0,0,0);
INSERT INTO `products` VALUES (143,1,1000,'ATTR_CHKBOX2','sample_t/t-shirt_02.gif','0.0000',0,'2007-01-17 15:20:31','2007-01-17 17:57:25',NULL,0.2,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'0.0000',62,1,0,0,0,0,0);
INSERT INTO `products` VALUES (144,1,1000,'ATTR_DROPDOWN1','sample_t/t-shirt_01.gif','4000.0000',0,'2007-01-17 15:20:31','2007-01-17 19:09:09',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'4000.0000',63,1,0,0,0,0,0);
INSERT INTO `products` VALUES (152,1,1000,'ATTR_DROPDOWN2','sample_t/t-shirt_01.gif','4000.0000',0,'2007-01-17 19:09:41','2007-01-21 00:04:16',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'3600.0000',64,0,0,0,0,0,0);
INSERT INTO `products` VALUES (146,1,1000,'ATTR_DROPDOWN3','no_picture.gif','0.0000',0,'2007-01-17 15:20:31','2007-01-18 01:04:56',NULL,0,1,0,0,0,10,1,1,0,0,0,0,1,0,0,0,0,'5.0000',63,1,0,0,0,0,0);
INSERT INTO `products` VALUES (156,1,999,'SALE10-1','sample_t/t-shirt_01.gif','10000.0000',0,'2007-01-18 14:13:01','2007-01-26 15:19:15',NULL,1,1,0,0,1,1,1,0,0,0,0,0,1,0,0,0,0,'9000.0000',67,1,0,0,0,0,0);
INSERT INTO `products` VALUES (155,1,1000,'FREEATTRB2','sample_t/t-sample.gif','10000.0000',0,'2007-01-18 10:22:57','2007-01-18 10:25:25',NULL,0,1,0,0,0,1,1,0,1,0,0,0,1,0,50,0,0,'0.0000',40,1,0,0,0,0,0);
INSERT INTO `products` VALUES (157,1,1000,'SALE10-2','sample_t/t-shirt_02.gif','10000.0000',0,'2007-01-18 14:13:01','2007-01-18 14:13:01',NULL,1,1,0,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'10000.0000',67,1,0,0,0,0,0);
INSERT INTO `products` VALUES (158,1,1000,'SALE10-3','sample_t/t-shirt_03.gif','10000.0000',0,'2007-01-18 14:13:01','2007-01-18 23:24:03',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'9000.0000',67,1,0,0,0,0,0);
INSERT INTO `products` VALUES (159,1,1000,'SALE500-1','sample_t/t-shirt_01.gif','10000.0000',0,'2007-01-18 14:13:01','2007-01-18 14:13:01',NULL,1,1,0,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'9500.0000',68,1,0,0,0,0,0);
INSERT INTO `products` VALUES (160,1,1000,'SALE500-2','sample_t/t-shirt_02.gif','10000.0000',0,'2007-01-18 14:13:01','2007-01-19 01:10:08',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'9500.0000',68,1,0,0,0,0,0);
INSERT INTO `products` VALUES (161,1,1000,'SALE500-3','sample_t/t-shirt_03.gif','10000.0000',0,'2007-01-18 14:13:01','2007-01-18 14:13:01',NULL,1,1,0,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'9500.0000',68,1,0,0,0,0,0);
INSERT INTO `products` VALUES (162,1,998,'SALESET8000-1','sample_t/t-shirt_01.gif','10000.0000',0,'2007-01-18 14:13:01','2007-01-18 14:13:01',NULL,1,1,0,NULL,2,1,1,0,0,0,0,0,1,0,0,0,0,'8000.0000',69,1,0,0,0,0,0);
INSERT INTO `products` VALUES (163,1,1000,'SALESET8000-2','sample_t/t-shirt_02.gif','10000.0000',0,'2007-01-18 14:13:02','2007-01-19 01:15:03',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'8000.0000',69,1,0,0,0,0,0);
INSERT INTO `products` VALUES (164,1,1000,'SALESET8000-3','sample_t/t-shirt_03.gif','10000.0000',0,'2007-01-18 14:13:02','2007-01-18 14:13:02',NULL,1,1,0,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'8000.0000',69,1,0,0,0,0,0);
INSERT INTO `products` VALUES (165,1,999,'SPECIAL1-1','sample_t/t-shirt_01.gif','10000.0000',0,'2007-01-18 14:13:02','2007-01-18 14:13:02',NULL,1,1,0,NULL,1,1,1,0,0,0,0,0,1,0,0,0,0,'8000.0000',70,1,0,0,0,0,0);
INSERT INTO `products` VALUES (166,1,1000,'SPECIAL2-1','sample_t/t-shirt_01.gif','10000.0000',0,'2007-01-18 14:13:02','2007-01-18 14:13:02',NULL,1,1,0,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'5000.0000',70,1,0,0,0,0,0);
INSERT INTO `products` VALUES (167,1,997,'SPECIAL2-2','sample_t/t-shirt_02.gif','10000.0000',0,'2007-01-18 14:13:02','2007-01-18 14:13:02',NULL,1,1,0,NULL,3,1,1,0,0,0,0,0,1,0,0,0,0,'5000.0000',70,1,0,0,0,0,0);
INSERT INTO `products` VALUES (168,1,1000,'SPECIAL2-3','sample_t/t-shirt_03.gif','10000.0000',0,'2007-01-18 14:13:02','2007-01-18 14:13:02',NULL,1,1,0,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'5000.0000',70,1,0,0,0,0,0);
INSERT INTO `products` VALUES (169,1,1000,'SPECIAL3','sample_t/t-shirt_04.gif','10000.0000',0,'2007-01-18 14:13:02','2007-01-18 14:29:48',NULL,1,1,0,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'10000.0000',70,0,0,0,0,0,0);
INSERT INTO `products` VALUES (170,1,1000,'SALE_ETC1','sample_t/t-shirt_01.gif','10000.0000',0,'2007-01-18 14:13:02','2007-01-18 14:13:02',NULL,1,1,0,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'10000.0000',71,1,0,0,0,0,0);
INSERT INTO `products` VALUES (171,1,1000,'SALE_ETC2','sample_t/t-shirt_02.gif','7500.0000',0,'2007-01-18 14:13:03','2007-01-18 14:13:03',NULL,1,1,0,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'7500.0000',71,1,0,0,0,0,0);
INSERT INTO `products` VALUES (172,1,1000,'NOSALE','sample_t/t-shirt_04.gif','10000.0000',0,'2007-01-18 14:13:01','2007-01-26 15:18:09',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'10000.0000',72,1,0,0,0,0,0);
INSERT INTO `products` VALUES (173,1,1000,'SALE_SPECIAL1-1','sample_t/t-shirt_03.gif','10000.0000',0,'2007-01-18 14:13:02','2007-01-19 13:25:48',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',73,1,0,0,0,0,0);
INSERT INTO `products` VALUES (174,1,998,'SALE_SPECIAL1-2','sample_t/t-shirt_04.gif','10000.0000',0,'2007-01-18 14:13:02','2007-01-19 13:27:09',NULL,1,1,0,0,2,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',73,1,0,0,0,0,0);
INSERT INTO `products` VALUES (175,1,1000,'SALE_SPECIAL1-3','sample_t/t-shirt_05.gif','10000.0000',0,'2007-01-18 14:13:02','2007-01-19 13:27:22',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',73,1,0,0,0,0,0);
INSERT INTO `products` VALUES (176,1,1000,'SALE_SPECIAL2-1','sample_t/t-shirt_03.gif','10000.0000',0,'2007-01-18 14:13:02','2007-01-19 13:27:42',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'9000.0000',74,1,0,0,0,0,0);
INSERT INTO `products` VALUES (177,1,1000,'SALE_SPECIAL2-2','sample_t/t-shirt_04.gif','10000.0000',0,'2007-01-18 14:13:02','2007-01-19 13:27:54',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'9000.0000',74,1,0,0,0,0,0);
INSERT INTO `products` VALUES (178,1,1000,'SALE_SPECIAL2-3','sample_t/t-shirt_05.gif','10000.0000',0,'2007-01-18 14:13:02','2007-01-19 13:28:06',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'9000.0000',74,1,0,0,0,0,0);
INSERT INTO `products` VALUES (179,1,1000,'SALE_SPECIAL3-1','sample_t/t-shirt_03.gif','10000.0000',0,'2007-01-18 14:13:02','2007-01-19 13:28:29',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'5000.0000',75,1,0,0,0,0,0);
INSERT INTO `products` VALUES (180,1,999,'SALE_SPECIAL3-2','sample_t/t-shirt_04.gif','10000.0000',0,'2007-01-18 14:13:02','2007-01-19 13:28:44',NULL,1,1,0,0,1,1,1,0,0,0,0,0,1,0,0,0,0,'5000.0000',75,1,0,0,0,0,0);
INSERT INTO `products` VALUES (181,1,1000,'SALE_SPECIAL3-3','sample_t/t-shirt_05.gif','10000.0000',0,'2007-01-18 14:13:02','2007-01-19 13:28:59',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'5000.0000',75,1,0,0,0,0,0);
INSERT INTO `products` VALUES (182,1,1000,'DISCNTQTY6','sample_t/t-sample.gif','10000.0000',0,'2007-01-18 16:31:53','2007-01-24 15:54:28',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,60,1,0,'10000.0000',45,0,0,0,0,0,0);
INSERT INTO `products` VALUES (183,1,1000,'MIN','','200.0000',0,'2007-01-18 17:13:22','2007-01-24 19:27:00',NULL,1,1,0,0,0,10,1,0,0,0,1,0,1,0,10,0,0,'200.0000',76,1,0,0,0,0,0);
INSERT INTO `products` VALUES (184,1,1000,'MIN_ATR1','','200.0000',0,'2007-01-18 17:14:01','2007-01-24 19:46:56',NULL,1,1,0,0,0,10,1,0,0,0,1,0,1,0,20,0,0,'200.0000',76,1,0,0,0,0,0);
INSERT INTO `products` VALUES (185,1,1000,'MIN_ATR2','','200.0000',0,'2007-01-18 17:19:58','2007-01-24 19:47:20',NULL,1,1,0,0,0,10,1,0,0,0,0,0,1,0,30,0,0,'200.0000',76,0,0,0,0,0,0);
INSERT INTO `products` VALUES (187,1,1000,'LIMIT-5','','200.0000',0,'2007-01-19 01:58:18','2007-01-24 19:15:18',NULL,1,1,0,0,0,1,1,0,0,0,1,0,1,5,10,0,0,'200.0000',78,1,0,0,0,0,0);
INSERT INTO `products` VALUES (188,1,1000,'LIMIT_ATR1','','200.0000',0,'2007-01-19 02:04:36','2007-01-24 19:22:43',NULL,1,1,0,0,0,1,1,0,0,0,1,0,1,5,50,0,0,'200.0000',78,1,0,0,0,0,0);
INSERT INTO `products` VALUES (189,1,1000,'LIMIT_ATR2','','200.0000',0,'2007-01-19 02:13:38','2007-01-24 19:16:03',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,5,60,0,0,'200.0000',78,0,0,0,0,0,0);
INSERT INTO `products` VALUES (190,1,1000,'TAXOUT','sample_t/t-sample.gif','10000.0000',0,'2007-01-23 10:39:16','2007-01-23 11:18:43',NULL,0.25,1,1,0,0,1,1,0,0,0,1,0,1,0,1,0,0,'10000.0000',81,1,0,0,0,0,0);
INSERT INTO `products` VALUES (191,1,1000,'TAXIN','sample_t/t-sample.gif','10000.0000',0,'2007-01-23 10:41:32','2007-01-23 11:29:24',NULL,0.25,1,0,0,0,1,1,0,0,0,1,0,1,0,2,0,0,'10000.0000',81,1,0,0,0,0,0);
INSERT INTO `products` VALUES (192,1,1000,'ATTR_IMAGE1','sample_t/t-shirt_01.gif','4000.0000',0,'2007-01-23 11:50:48','2007-01-24 00:13:12',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,3,0,0,'4000.0000',82,1,0,0,0,0,0);
INSERT INTO `products` VALUES (193,1,1000,'ATTR_IMAGE2','sample_t/t-shirt_02.gif','4000.0000',0,'2007-01-23 11:53:44','2007-01-24 00:15:48',NULL,0.2,1,0,0,0,1,1,0,0,0,0,0,1,0,4,0,0,'4000.0000',82,1,0,0,0,0,0);
INSERT INTO `products` VALUES (194,1,999,'IMAGE1','samples/IMAGE1.jpg','4000.0000',0,'2007-01-24 00:34:30','2007-01-24 01:59:35',NULL,0.25,1,0,0,1,1,1,0,0,0,1,0,1,0,1,0,0,'4000.0000',82,1,0,0,0,0,0);
INSERT INTO `products` VALUES (195,1,1000,'IMAGE2','samples/IMAGE2.gif','4000.0000',0,'2007-01-24 00:39:27','2007-01-24 02:21:17',NULL,0.25,1,0,0,0,1,1,0,0,0,1,0,1,0,2,0,0,'4000.0000',82,1,0,0,0,0,0);
INSERT INTO `products` VALUES (196,1,1000,'DISCNTQTY_ATTR1','sample_t/t-shirt_01.gif','4000.0000',0,'2007-01-24 11:25:24','2007-01-25 20:01:10',NULL,0.25,1,0,0,0,1,1,0,0,0,0,0,1,0,1,0,0,'4000.0000',83,1,0,0,0,0,0);
INSERT INTO `products` VALUES (197,1,999,'DISCNTQTY_ATTR2','sample_t/t-shirt_01.gif','0.0000',0,'2007-01-24 15:35:08','2007-01-25 19:26:28',NULL,0.25,1,0,0,1,1,1,1,0,0,0,0,1,0,2,0,0,'4000.0000',83,1,0,0,0,0,0);
INSERT INTO `products` VALUES (198,1,1000,'DSCNT_ONE1','sample_t/t-shirt_01.gif','0.0000',0,'2007-01-24 16:37:59','2007-01-26 03:05:02',NULL,0.25,1,0,0,0,1,1,1,0,0,0,0,1,0,1,0,0,'4000.0000',85,1,0,0,0,0,0);
INSERT INTO `products` VALUES (199,1,998,'DSCNT_ONE2','sample_t/t-sample.gif','4000.0000',0,'2007-01-24 17:42:19','2007-01-26 03:08:54',NULL,0.25,1,0,0,2,1,1,0,0,0,1,0,1,0,2,0,0,'4000.0000',85,1,0,0,0,0,0);
INSERT INTO `products` VALUES (200,1,1000,'LIMIT-2','','200.0000',0,'2007-01-24 19:07:16','2007-01-24 19:15:29',NULL,1,1,0,0,0,1,1,0,0,0,1,0,1,1,20,0,0,'200.0000',78,1,0,0,0,0,0);
INSERT INTO `products` VALUES (201,1,1000,'UNIT1','','200.0000',0,'2007-01-24 19:32:13','2007-01-24 19:36:47',NULL,1,1,0,0,0,100,100,0,0,0,1,0,1,0,10,0,0,'200.0000',86,1,0,0,0,0,0);
INSERT INTO `products` VALUES (202,1,1000,'UNIT2','','200.0000',0,'2007-01-24 19:37:00','2007-01-24 19:43:47',NULL,1,1,0,0,0,2000,100,0,0,0,1,0,1,0,20,0,0,'200.0000',86,1,0,0,0,0,0);
INSERT INTO `products` VALUES (203,1,1000,'UNIT_ATR1','','200.0000',0,'2007-01-24 19:44:59','2007-01-24 19:52:48',NULL,1,1,0,0,0,100,1,0,0,0,1,0,1,100,30,0,0,'200.0000',86,1,0,0,0,0,0);
INSERT INTO `products` VALUES (204,1,1000,'UNIT_ATR2','','200.0000',0,'2007-01-24 19:45:15','2007-01-24 19:54:44',NULL,1,1,0,0,0,100,100,0,0,0,0,0,1,0,40,0,0,'200.0000',86,0,0,0,0,0,0);
INSERT INTO `products` VALUES (205,1,1000,'PRCFACTOR','samples/teacup.png','20000.0000',0,'2007-01-25 12:48:10','2007-01-25 18:56:07',NULL,1,1,0,0,0,1,1,0,0,0,1,0,1,0,10,0,0,'20000.0000',87,1,0,0,0,0,0);
INSERT INTO `products` VALUES (206,1,1000,'PRCFACTOR_OFFSET','sample_t/t-shirt_01.gif','0.0000',0,'2007-01-25 17:47:50','2007-01-26 01:32:25',NULL,0,1,0,0,0,1,1,1,0,0,1,0,1,0,20,0,0,'4000.0000',87,1,0,0,0,0,0);
INSERT INTO `products` VALUES (209,1,1000,'BASEPRICE1','sample_t/t-shirt_01.gif','4000.0000',0,'2007-01-26 01:57:23','2007-01-26 02:57:14',NULL,0.25,1,0,0,0,1,1,1,0,0,0,0,1,0,1,0,0,'4500.0000',89,1,0,0,0,0,0);
INSERT INTO `products` VALUES (207,1,1000,'PRCFACTOR_OFFSET_ONCE','sample_t/t-sample.gif','4000.0000',0,'2007-01-25 18:59:30','2007-01-26 17:48:08',NULL,0,1,0,0,0,1,1,1,0,0,1,0,1,0,30,0,0,'4000.0000',87,1,0,0,0,0,0);
INSERT INTO `products` VALUES (208,1,1000,'DISCNTQTY_ATTR_ONCE','sample_t/t-shirt_01.gif','4000.0000',0,'2007-01-25 19:23:37','2007-01-25 20:01:38',NULL,0.25,1,0,0,0,1,1,0,0,0,0,0,1,0,3,0,0,'4000.0000',83,1,0,0,0,0,0);
INSERT INTO `products` VALUES (210,1,1000,'BASEPRICE3','sample_t/t-shirt_01.gif','4000.0000',0,'2007-01-26 02:26:19','2007-01-26 02:50:02',NULL,0.25,1,0,0,0,1,1,1,0,0,0,0,1,0,3,0,0,'5000.0000',89,1,0,0,0,0,0);
INSERT INTO `products` VALUES (211,1,1000,'BASEPRICE2','sample_t/t-shirt_02.gif','4000.0000',0,'2007-01-26 02:46:13','2007-01-26 02:59:27',NULL,0.25,1,0,0,0,1,1,0,0,0,0,0,1,0,2,0,0,'4000.0000',89,1,0,0,0,0,0);
INSERT INTO `products` VALUES (212,2,1001,'RTBHUNTER','sooty.jpg','500.0000',0,'2007-01-26 10:54:55','2007-01-26 19:40:58',NULL,3,1,0,NULL,0,1,1,0,0,0,1,0,1,0,1,0,0,'450.0000',91,1,0,0,0,0,0);
INSERT INTO `products` VALUES (213,2,1001,'HELP','samples/music.jpg','3500.0000',0,'2007-01-26 10:55:12','2007-02-01 18:28:20',NULL,0,1,0,NULL,0,1,1,0,0,0,1,2,1,0,2,0,0,'3500.0000',91,1,0,0,0,0,0);
INSERT INTO `products` VALUES (214,3,0,'','samples/DOC_GENERAL.gif','0.0000',0,'2007-01-26 12:02:50','2007-01-26 17:09:58',NULL,0,1,0,0,0,1,1,0,0,0,0,0,0,0,0,0,0,'0.0000',93,1,0,0,0,0,0);
INSERT INTO `products` VALUES (215,4,1000,'DOC_PRODUCT','samples/DOC_PRODUCT.gif','2000.0000',0,'2007-01-26 12:22:09','2007-01-26 17:01:36',NULL,0,1,0,0,0,1,1,0,0,0,1,0,1,0,2,0,0,'2000.0000',93,1,0,0,0,0,0);
INSERT INTO `products` VALUES (225,1,1001,'DOWNLOAD1','samples/download.jpg','5000.0000',0,'2007-01-26 18:38:56','2007-01-26 19:58:12',NULL,0,1,0,0,1,1,1,0,0,0,1,0,1,0,10,0,0,'5000.0000',100,1,0,0,0,0,0);
INSERT INTO `products` VALUES (217,5,1001,'TYPE_P_FREESHIP','sample_t/t-sample.gif','4000.0000',0,'2007-01-26 14:35:30','2007-01-26 16:53:40',NULL,1,1,0,0,0,1,1,0,0,0,1,1,1,0,10,0,0,'4000.0000',98,1,0,0,0,0,0);
INSERT INTO `products` VALUES (218,1,1000,'FREE2','sample_t/t-sample.gif','0.0000',1,'2007-01-26 15:10:08','2007-01-26 15:10:10','0000-00-00 00:00:00',2,1,0,0,0,1,1,0,1,0,0,0,1,0,30,0,0,'0.0000',40,1,0,0,0,0,0);
INSERT INTO `products` VALUES (224,1,999,'FREESHIP3','sample_t/t-shirt_02.gif','4000.0000',0,'2007-01-26 15:54:57','2007-01-26 16:12:01',NULL,0,1,0,0,1,1,1,0,0,0,1,0,1,0,3,0,0,'4000.0000',79,1,0,0,0,0,0);
INSERT INTO `products` VALUES (223,1,1000,'FREESHIP2','sample_w/wallpaper_M01.jpg','4000.0000',1,'2007-01-26 15:39:15','2007-01-26 15:48:48',NULL,50,1,0,0,0,1,1,0,0,0,0,1,1,0,2,0,0,'4000.0000',79,1,0,0,0,0,0);
INSERT INTO `products` VALUES (226,1,1000,'DOWNLOAD2','samples/download.jpg','5000.0000',0,'2007-01-26 19:08:15','2007-01-26 19:58:26',NULL,0,1,0,0,0,1,1,0,0,0,1,0,1,0,20,0,0,'5000.0000',100,1,0,0,0,0,0);
INSERT INTO `products` VALUES (229,2,1001,'MEDIA_MIX','samples/music.jpg','3500.0000',0,'2007-02-01 18:06:43','2007-02-01 18:30:53',NULL,0,1,0,0,0,1,1,0,0,0,1,2,1,0,30,0,0,'3500.0000',91,1,0,0,0,0,0);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_attributes`
--

DROP TABLE IF EXISTS `products_attributes`;
CREATE TABLE `products_attributes` (
  `products_attributes_id` int(11) NOT NULL auto_increment,
  `products_id` int(11) NOT NULL default '0',
  `options_id` int(11) NOT NULL default '0',
  `options_values_id` int(11) NOT NULL default '0',
  `options_values_price` decimal(15,4) NOT NULL default '0.0000',
  `price_prefix` char(1) NOT NULL default '',
  `products_options_sort_order` int(11) NOT NULL default '0',
  `product_attribute_is_free` tinyint(1) NOT NULL default '0',
  `products_attributes_weight` float NOT NULL default '0',
  `products_attributes_weight_prefix` char(1) NOT NULL default '',
  `attributes_display_only` tinyint(1) NOT NULL default '0',
  `attributes_default` tinyint(1) NOT NULL default '0',
  `attributes_discounted` tinyint(1) NOT NULL default '1',
  `attributes_image` varchar(64) default NULL,
  `attributes_price_base_included` tinyint(1) NOT NULL default '1',
  `attributes_price_onetime` decimal(15,4) NOT NULL default '0.0000',
  `attributes_price_factor` decimal(15,4) NOT NULL default '0.0000',
  `attributes_price_factor_offset` decimal(15,4) NOT NULL default '0.0000',
  `attributes_price_factor_onetime` decimal(15,4) NOT NULL default '0.0000',
  `attributes_price_factor_onetime_offset` decimal(15,4) NOT NULL default '0.0000',
  `attributes_qty_prices` text,
  `attributes_qty_prices_onetime` text,
  `attributes_price_words` decimal(15,4) NOT NULL default '0.0000',
  `attributes_price_words_free` int(4) NOT NULL default '0',
  `attributes_price_letters` decimal(15,4) NOT NULL default '0.0000',
  `attributes_price_letters_free` int(4) NOT NULL default '0',
  `attributes_required` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`products_attributes_id`),
  KEY `idx_id_options_id_values_zen` (`products_id`,`options_id`,`options_values_id`)
) ENGINE=MyISAM AUTO_INCREMENT=423 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `products_attributes`
--

LOCK TABLES `products_attributes` WRITE;
/*!40000 ALTER TABLE `products_attributes` DISABLE KEYS */;
INSERT INTO `products_attributes` VALUES (1,57,2,9,'0.0000','+',210,1,0,'+',0,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (2,57,2,10,'0.0000','+',220,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (3,57,2,11,'0.0000','+',230,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (4,57,2,12,'0.0000','+',240,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (5,57,2,13,'0.0000','+',250,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (306,59,2,13,'0.0000','+',250,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (305,59,2,12,'0.0000','+',240,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (304,59,2,11,'0.0000','+',230,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (303,59,2,10,'0.0000','+',220,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (302,59,2,9,'0.0000','+',210,1,0,'+',0,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (311,61,2,13,'0.0000','+',250,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (310,61,2,12,'0.0000','+',240,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (309,61,2,11,'0.0000','+',230,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (308,61,2,10,'0.0000','+',220,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (307,61,2,9,'0.0000','+',210,1,0,'+',0,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (16,7,2,9,'0.0000','+',210,1,0,'+',0,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (17,7,2,10,'0.0000','+',220,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (18,7,2,11,'0.0000','+',230,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (19,7,2,12,'0.0000','+',240,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (20,7,2,13,'0.0000','+',250,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (21,12,2,9,'0.0000','+',210,1,0,'+',0,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (22,12,2,10,'0.0000','+',220,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (23,12,2,11,'0.0000','+',230,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (24,12,2,12,'0.0000','+',240,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (25,12,2,13,'0.0000','+',250,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (26,20,2,9,'0.0000','+',210,1,0,'+',0,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (27,20,2,10,'0.0000','+',220,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (28,20,2,11,'0.0000','+',230,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (29,20,2,12,'0.0000','+',240,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (30,20,2,13,'0.0000','+',250,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (31,26,2,9,'0.0000','+',210,1,0,'+',0,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (32,26,2,10,'0.0000','+',220,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (33,26,2,11,'0.0000','+',230,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (34,26,2,12,'0.0000','+',240,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (35,26,2,13,'0.0000','+',250,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (36,28,2,9,'0.0000','+',210,1,0,'+',0,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (37,28,2,10,'0.0000','+',220,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (38,28,2,11,'0.0000','+',230,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (39,28,2,12,'0.0000','+',240,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (40,28,2,13,'0.0000','+',250,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (41,30,2,9,'0.0000','+',210,1,0,'+',0,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (42,30,2,10,'0.0000','+',220,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (43,30,2,11,'0.0000','+',230,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (44,30,2,12,'0.0000','+',240,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (45,30,2,13,'0.0000','+',250,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (46,52,2,9,'0.0000','+',210,1,0,'+',0,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (47,52,2,10,'0.0000','+',220,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (48,52,2,11,'0.0000','+',230,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (49,52,2,12,'0.0000','+',240,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (50,52,2,13,'0.0000','+',250,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (51,55,2,9,'0.0000','+',210,1,0,'+',0,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (52,55,2,10,'0.0000','+',220,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (53,55,2,11,'0.0000','+',230,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (54,55,2,12,'0.0000','+',240,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (55,55,2,13,'0.0000','+',250,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (56,16,2,9,'0.0000','+',210,1,0,'+',0,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (57,16,2,10,'0.0000','+',220,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (58,16,2,11,'0.0000','+',230,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (59,16,2,12,'0.0000','+',240,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (60,16,2,13,'0.0000','+',250,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (61,36,2,9,'0.0000','+',210,1,0,'+',0,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (62,36,2,10,'0.0000','+',220,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (63,36,2,11,'0.0000','+',230,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (64,36,2,12,'0.0000','+',240,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (65,36,2,13,'0.0000','+',250,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (66,39,2,9,'0.0000','+',210,1,0,'+',0,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (67,39,2,10,'0.0000','+',220,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (68,39,2,11,'0.0000','+',230,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (69,39,2,12,'0.0000','+',240,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (70,39,2,13,'0.0000','+',250,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (71,41,2,9,'0.0000','+',210,1,0,'+',0,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (72,41,2,10,'0.0000','+',220,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (73,41,2,11,'0.0000','+',230,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (74,41,2,12,'0.0000','+',240,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (75,41,2,13,'0.0000','+',250,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (77,98,3,4,'500.0000','+',110,0,0,'+',0,1,1,'attributes/color_red.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (78,98,3,5,'0.0000','+',120,0,0,'+',0,0,1,'attributes/color_yellow.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (81,112,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (80,98,3,8,'0.0000','+',140,0,0,'+',0,0,1,'attributes/color_black.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (82,112,3,8,'1000.0000','+',140,1,0,'+',0,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (83,113,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (84,113,3,8,'1000.0000','+',140,1,0,'+',0,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (112,141,6,17,'0.0000','+',620,1,0,'+',0,0,1,'attributes/washM40.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (110,141,6,15,'0.0000','+',600,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (107,139,5,0,'0.0000','+',0,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'5.0000',0,1);
INSERT INTO `products_attributes` VALUES (108,140,4,0,'0.0000','+',0,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','20.0000',2,'0.0000',0,1);
INSERT INTO `products_attributes` VALUES (111,141,6,16,'0.0000','+',610,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (106,139,4,0,'0.0000','+',0,0,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'10.0000',5,1);
INSERT INTO `products_attributes` VALUES (102,53,1,3,'0.0000','+',10,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (105,64,1,3,'0.0000','+',10,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (113,141,6,18,'0.0000','+',630,1,0,'+',0,0,1,'attributes/ironM.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (115,142,7,21,'0.0000','+',700,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (116,142,7,22,'0.0000','+',710,1,0,'+',0,0,1,'',0,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (117,142,7,23,'100.0000','+',720,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (118,143,8,27,'3000.0000','+',830,1,0.1,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (119,143,8,28,'3000.0000','+',840,1,0.1,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (120,143,8,29,'3000.0000','+',850,1,0.1,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (121,143,8,30,'3500.0000','+',860,1,0.15,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (122,143,8,31,'3500.0000','+',870,1,0.15,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (123,143,8,26,'4500.0000','+',820,1,0.25,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (124,143,8,24,'4000.0000','+',800,1,0.2,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (125,143,8,25,'4000.0000','+',810,1,0.2,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (128,144,1,3,'0.0000','+',10,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (129,144,1,19,'500.0000','+',40,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (130,144,3,5,'0.0000','+',120,1,0,'+',0,1,0,'attributes/color_yellow.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (132,144,3,8,'500.0000','+',140,1,0,'+',0,0,0,'attributes/color_black.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (133,144,3,7,'0.0000','+',130,1,0,'+',0,0,0,'attributes/color_blue.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (134,144,3,14,'0.0000','+',100,1,0,'+',0,0,0,'attributes/color_white.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (148,144,1,20,'0.0000','+',50,1,0,'+',1,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (163,152,1,19,'500.0000','+',40,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (164,152,3,5,'0.0000','+',120,1,0,'+',0,1,0,'attributes/color_yellow.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (165,152,3,8,'500.0000','+',140,1,0,'+',0,0,0,'attributes/color_black.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (166,152,3,7,'0.0000','+',130,1,0,'+',0,0,0,'attributes/color_blue.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (167,152,3,14,'0.0000','+',100,1,0,'+',0,0,0,'attributes/color_white.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (168,152,1,20,'0.0000','+',50,1,0,'+',1,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (144,146,9,32,'500.0000','',900,1,0.1,'',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (145,146,9,33,'5.0000','',910,1,0.001,'',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (146,151,10,35,'5.0000','',1010,1,0.001,'',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (147,151,10,34,'500.0000','',1000,1,0.1,'',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (149,144,3,4,'0.0000','+',110,1,0,'+',0,0,0,'attributes/color_red.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (169,152,3,4,'0.0000','+',110,1,0,'+',0,0,0,'attributes/color_red.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (162,152,1,3,'0.0000','+',10,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (173,155,3,4,'0.0000','+',110,1,0,'+',0,1,1,'attributes/color_red.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (174,155,3,5,'0.0000','+',120,0,0,'+',0,0,1,'attributes/color_yellow.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (175,155,3,8,'0.0000','+',140,0,0,'+',0,0,1,'attributes/color_black.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (291,156,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (292,156,3,4,'0.0000','+',110,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (293,156,3,7,'0.0000','+',130,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (290,156,3,5,'0.0000','+',120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (180,157,3,5,'0.0000','+',120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (181,157,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (182,157,3,4,'2000.0000','+',110,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (183,157,3,7,'0.0000','+',130,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (184,158,3,5,'0.0000','+',120,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (185,158,3,14,'0.0000','+',100,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (186,158,3,4,'2000.0000','+',110,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (187,158,3,7,'0.0000','+',130,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (188,176,3,5,'0.0000','+',120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (189,176,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (190,176,3,4,'0.0000','+',110,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (191,176,3,7,'0.0000','+',130,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (192,177,3,5,'0.0000','+',120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (193,177,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (194,177,3,4,'2000.0000','+',110,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','2000.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (195,177,3,7,'0.0000','+',130,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (196,178,3,5,'0.0000','+',120,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (197,178,3,14,'0.0000','+',100,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (198,178,3,4,'2000.0000','+',110,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (199,178,3,7,'0.0000','+',130,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (200,159,3,5,'0.0000','+',120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (201,159,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (202,159,3,4,'0.0000','+',110,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (203,159,3,7,'0.0000','+',130,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (204,160,3,5,'0.0000','+',120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (205,160,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (206,160,3,4,'2000.0000','+',110,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (207,160,3,7,'0.0000','+',130,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (208,161,3,5,'0.0000','+',120,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (209,161,3,14,'0.0000','+',100,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (210,161,3,4,'2000.0000','+',110,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (211,161,3,7,'0.0000','+',130,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (212,162,3,5,'0.0000','+',120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (213,162,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (214,162,3,4,'0.0000','+',110,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (215,162,3,7,'0.0000','+',130,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (216,163,3,5,'0.0000','+',120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (217,163,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (218,163,3,4,'2000.0000','+',110,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (219,163,3,7,'0.0000','+',130,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (220,164,3,5,'0.0000','+',120,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (221,164,3,14,'0.0000','+',100,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (222,164,3,4,'2000.0000','+',110,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (223,164,3,7,'0.0000','+',130,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (224,170,3,5,'0.0000','+',120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (225,170,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (226,170,3,4,'0.0000','+',110,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (227,170,3,7,'0.0000','+',130,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (228,171,3,5,'0.0000','+',120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (229,171,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (230,171,3,4,'0.0000','+',110,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (231,171,3,7,'0.0000','+',130,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (232,173,3,5,'0.0000','+',120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (233,173,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (234,173,3,4,'0.0000','+',110,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (235,173,3,7,'0.0000','+',130,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (236,174,3,5,'0.0000','+',120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (237,174,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (238,174,3,4,'2000.0000','+',110,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (239,174,3,7,'0.0000','+',130,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (240,175,3,5,'0.0000','+',120,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (241,175,3,14,'0.0000','+',100,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (242,175,3,4,'2000.0000','+',110,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (243,175,3,7,'0.0000','+',130,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (244,179,3,5,'0.0000','+',120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (245,179,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (246,179,3,4,'0.0000','+',110,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (247,179,3,7,'0.0000','+',130,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (248,180,3,5,'0.0000','+',120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (249,180,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (250,180,3,4,'2000.0000','+',110,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (251,180,3,7,'0.0000','+',130,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (252,181,3,5,'0.0000','+',120,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (253,181,3,14,'0.0000','+',100,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (254,181,3,4,'2000.0000','+',110,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (255,181,3,7,'0.0000','+',130,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (256,172,3,5,'0.0000','+',120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (257,172,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (258,172,3,4,'0.0000','+',110,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (259,172,3,7,'0.0000','+',130,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (260,165,3,5,'0.0000','+',120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (261,165,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (262,165,3,4,'0.0000','+',110,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (263,165,3,7,'0.0000','+',130,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (264,166,3,5,'0.0000','+',120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (265,166,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (266,166,3,4,'0.0000','+',110,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (267,166,3,7,'0.0000','+',130,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (268,167,3,5,'0.0000','+',120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (269,167,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (270,167,3,4,'2000.0000','+',110,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (271,167,3,7,'0.0000','+',130,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (272,168,3,5,'0.0000','+',120,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (273,168,3,14,'0.0000','+',100,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (274,168,3,4,'2000.0000','+',110,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (275,168,3,7,'0.0000','+',130,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (276,169,3,5,'0.0000','+',120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (277,169,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (278,169,3,4,'0.0000','+',110,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (279,169,3,7,'0.0000','+',130,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (280,182,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (281,182,3,8,'1000.0000','+',140,1,0,'+',0,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (282,184,3,5,'0.0000','+',120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (283,184,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (284,184,3,4,'0.0000','+',110,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (285,184,3,7,'0.0000','+',130,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (286,185,3,5,'0.0000','+',120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (287,185,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (288,185,3,4,'0.0000','+',110,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (289,185,3,7,'0.0000','+',130,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (294,188,3,5,'0.0000','+',120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (295,188,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (296,188,3,4,'0.0000','+',110,1,0,'+',0,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (297,188,3,7,'0.0000','+',130,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (298,189,3,5,'0.0000','+',120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (299,189,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (300,189,3,4,'0.0000','+',110,1,0,'+',0,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (301,189,3,7,'0.0000','+',130,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (316,88,11,37,'0.0000','+',2010,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (315,88,11,36,'0.0000','+',2000,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (317,89,11,36,'0.0000','+',2000,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (318,89,11,37,'0.0000','+',2010,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (319,90,11,36,'0.0000','+',2000,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (320,90,11,37,'0.0000','+',2010,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (321,91,11,36,'0.0000','+',2000,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (322,91,11,37,'0.0000','+',2010,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (356,193,6,15,'0.0000','+',600,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (365,198,3,14,'4000.0000','',100,1,0,'+',0,1,1,'attributes/t-shirt_01mini.gif',1,'-500.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (327,190,3,5,'2000.0000','+',120,1,0,'+',0,0,0,'attributes/color_yellow.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (360,192,3,38,'0.0000','+',150,1,0,'+',0,0,1,'attributes/t-shirt_02mini.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (361,196,3,14,'0.0000','+',100,1,0,'+',0,1,1,'attributes/t-shirt_01mini.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','9:-0,10:-100,11:-200','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (330,190,3,14,'1000.0000','+',100,1,0,'+',0,0,0,'attributes/color_white.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (353,192,3,14,'0.0000','+',100,1,0,'+',0,0,1,'attributes/t-shirt_01mini.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (332,190,3,4,'0.0000','+',110,1,0,'+',0,1,0,'attributes/color_red.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (362,196,3,38,'0.0000','+',150,1,0,'+',0,0,1,'attributes/t-shirt_02mini.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','19:-0,20:-150','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (363,197,3,14,'4000.0000','',100,1,0,'+',0,1,1,'attributes/t-shirt_01mini.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','9:-0,10:-100,11:-200','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (364,197,3,38,'5000.0000','',150,1,0,'+',0,0,1,'attributes/t-shirt_02mini.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','19:-0,20:-150','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (366,198,3,38,'5000.0000','',150,1,0,'+',0,0,1,'attributes/t-shirt_02mini.gif',1,'-1000.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (343,191,3,5,'2000.0000','+',120,1,0,'+',0,0,0,'attributes/color_yellow.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (344,191,3,14,'1000.0000','+',100,1,0,'+',0,0,0,'attributes/color_white.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (345,191,3,4,'0.0000','+',110,1,0,'+',0,1,0,'attributes/color_red.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (357,193,6,16,'0.0000','+',610,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (358,193,6,17,'0.0000','+',620,1,0,'+',0,0,1,'attributes/washM40.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (359,193,6,18,'0.0000','+',630,1,0,'+',0,0,1,'attributes/ironM.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (367,199,12,39,'600.0000','+',2100,1,0,'+',0,1,1,'',1,'10000.0000','0.0000','0.0000','0.0000','0.0000','49:-0,50:-200,100:-300','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (368,199,12,40,'700.0000','+',2120,1,0,'+',0,0,1,'',1,'20000.0000','0.0000','0.0000','0.0000','0.0000','49:-0,50:-200,100:-300','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (369,199,12,41,'800.0000','+',2130,1,0,'+',0,0,1,'',1,'30000.0000','0.0000','0.0000','0.0000','0.0000','49:-0,50:-200,100:-300','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (370,203,3,5,'0.0000','+',120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (371,203,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (372,203,3,4,'0.0000','+',110,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (373,203,3,7,'0.0000','+',130,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (374,204,3,5,'0.0000','+',120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (375,204,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (376,204,3,4,'0.0000','+',110,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (377,204,3,7,'0.0000','+',130,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (379,205,14,45,'0.0000','+',2310,1,0,'+',0,1,1,'',1,'0.0000','0.0500','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (380,205,14,46,'0.0000','+',2320,1,0,'+',0,0,1,'',1,'0.0000','0.1500','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (381,205,14,44,'0.0000','+',2300,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (382,206,13,43,'4000.0000','',2210,1,0,'+',0,1,1,'',1,'0.0000','100.0000','1.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (389,209,3,50,'1000.0000','+',180,1,0,'+',0,0,1,'attributes/t-shirt_02mini.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (385,208,3,14,'0.0000','+',100,1,0,'+',0,1,1,'attributes/t-shirt_01mini.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','9:-0,10:-1000,11:-4000','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (386,208,3,38,'0.0000','+',150,1,0,'+',0,0,1,'attributes/t-shirt_02mini.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','19:-0,20:-5000','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (390,209,3,49,'500.0000','+',170,1,0,'+',0,1,1,'attributes/t-shirt_01mini.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (405,207,7,21,'0.0000','+',700,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.3000','0.1000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (391,210,3,50,'1000.0000','+',180,1,0,'+',0,0,1,'attributes/t-shirt_02mini.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (393,210,3,48,'500.0000','+',160,1,0,'+',0,1,1,'attributes/t-shirt_01mini.gif',0,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (394,211,3,50,'1000.0000','+',180,1,0,'+',0,0,1,'attributes/t-shirt_02mini.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (396,211,3,49,'500.0000','+',170,1,0,'+',0,1,1,'attributes/t-shirt_01mini.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (397,217,6,18,'1000.0000','+',630,1,10,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (398,217,3,5,'2000.0000','+',120,1,20,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (399,222,3,14,'0.0000','+',100,1,100,'+',0,1,1,'attributes/t-shirt_01mini.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (400,222,3,38,'0.0000','+',150,1,40,'+',0,0,1,'attributes/t-shirt_02mini.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (404,224,3,38,'0.0000','+',150,1,20,'+',0,0,1,'attributes/t-shirt_02mini.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (403,224,3,14,'0.0000','+',100,1,2,'+',0,1,1,'attributes/t-shirt_01mini.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (406,225,15,53,'0.0000','+',3010,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (407,225,15,52,'0.0000','+',3000,1,0,'+',0,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (408,226,15,53,'0.0000','+',3010,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (409,226,15,52,'0.0000','+',3000,1,0,'+',0,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (410,226,16,56,'0.0000','+',3120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (411,226,16,54,'0.0000','+',3100,1,0,'+',0,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (412,226,16,55,'0.0000','+',3110,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (413,213,17,57,'0.0000','+',4000,1,1,'+',0,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (414,213,17,58,'0.0000','+',4010,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (417,227,18,0,'1000.0000','+',0,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (420,229,17,57,'0.0000','+',4000,1,1,'+',0,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (421,229,17,58,'0.0000','+',4010,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
INSERT INTO `products_attributes` VALUES (422,62,2,9,'0.0000','+',0,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
/*!40000 ALTER TABLE `products_attributes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_attributes_download`
--

DROP TABLE IF EXISTS `products_attributes_download`;
CREATE TABLE `products_attributes_download` (
  `products_attributes_id` int(11) NOT NULL default '0',
  `products_attributes_filename` varchar(255) NOT NULL default '',
  `products_attributes_maxdays` int(2) default '0',
  `products_attributes_maxcount` int(2) default '0',
  PRIMARY KEY  (`products_attributes_id`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table `products_attributes_download`
--

LOCK TABLES `products_attributes_download` WRITE;
/*!40000 ALTER TABLE `products_attributes_download` DISABLE KEYS */;
INSERT INTO `products_attributes_download` VALUES (315,'wallpaper_M01.jpg',7,5);
INSERT INTO `products_attributes_download` VALUES (316,'wallpaper_L01.jpg',7,5);
INSERT INTO `products_attributes_download` VALUES (317,'wallpaper_M02.jpg',7,5);
INSERT INTO `products_attributes_download` VALUES (318,'wallpaper_L02.jpg',7,5);
INSERT INTO `products_attributes_download` VALUES (319,'wallpaper_M03.jpg',7,5);
INSERT INTO `products_attributes_download` VALUES (320,'wallpaper_L03.jpg',7,5);
INSERT INTO `products_attributes_download` VALUES (321,'wallpaper_M04.jpg',7,5);
INSERT INTO `products_attributes_download` VALUES (322,'wallpaper_L04.jpg',7,5);
INSERT INTO `products_attributes_download` VALUES (406,'pdf_sample.zip',7,5);
INSERT INTO `products_attributes_download` VALUES (407,'ms_word_sample.zip',7,5);
INSERT INTO `products_attributes_download` VALUES (410,'mac-jp.zip',7,5);
INSERT INTO `products_attributes_download` VALUES (409,'pdf_sample.zip',7,5);
INSERT INTO `products_attributes_download` VALUES (408,'ms_word_sample.zip',7,5);
INSERT INTO `products_attributes_download` VALUES (411,'win-en.zip',7,5);
INSERT INTO `products_attributes_download` VALUES (412,'win-jp.zip',7,5);
INSERT INTO `products_attributes_download` VALUES (414,'help.mp3',7,5);
/*!40000 ALTER TABLE `products_attributes_download` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_description`
--

DROP TABLE IF EXISTS `products_description`;
CREATE TABLE `products_description` (
  `products_id` int(11) NOT NULL auto_increment,
  `language_id` int(11) NOT NULL default '1',
  `products_name` varchar(64) NOT NULL default '',
  `products_description` text,
  `products_url` varchar(255) default NULL,
  `products_viewed` int(5) default '0',
  PRIMARY KEY  (`products_id`,`language_id`),
  KEY `idx_products_name_zen` (`products_name`)
) ENGINE=MyISAM AUTO_INCREMENT=235 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `products_description`
--

LOCK TABLES `products_description` WRITE;
/*!40000 ALTER TABLE `products_description` DISABLE KEYS */;
INSERT INTO `products_description` VALUES (1,1,'t-shirt_01','','',0);
INSERT INTO `products_description` VALUES (1,2,'Zen CartロゴTシャツ','Zen CartオリジナルロゴTシャツです。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',6);
INSERT INTO `products_description` VALUES (2,1,'t-shirt_02','','',0);
INSERT INTO `products_description` VALUES (2,2,'Zen CartロゴTシャツ','Zen CartオリジナルロゴTシャツです。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',7);
INSERT INTO `products_description` VALUES (3,1,'t-shirt_03','','',0);
INSERT INTO `products_description` VALUES (3,2,'CCロゴTシャツ','クリエイティブ・コモンズロゴのTシャツです。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','http://www.creativecommons.jp/',1);
INSERT INTO `products_description` VALUES (4,1,'t-shirt_04','','',0);
INSERT INTO `products_description` VALUES (4,2,'GoogleロゴTシャツ','検索エンジン「Google」のロゴTシャツです。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','www.google.co.jp/',7);
INSERT INTO `products_description` VALUES (5,1,'t-shirt_05','','',0);
INSERT INTO `products_description` VALUES (5,2,'FeedアイコンTシャツ','フィードアイコンTシャツです。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',2);
INSERT INTO `products_description` VALUES (6,1,'t-shirt_06','','',0);
INSERT INTO `products_description` VALUES (6,2,'三毛猫','三毛猫の写真をあしらったキュートなTシャツ。猫好きに大人気！<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',2);
INSERT INTO `products_description` VALUES (7,1,'t-shirt_06','','',0);
INSERT INTO `products_description` VALUES (7,2,'三毛猫 for KIDS','三毛猫の写真をあしらったキュートなTシャツ。猫好きに大人気！<br />大人用もございます。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',2);
INSERT INTO `products_description` VALUES (8,1,'t-shirt_07','','',0);
INSERT INTO `products_description` VALUES (8,2,'三毛猫','三毛猫の写真をあしらったTシャツです。猫好きに大人気！<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',2);
INSERT INTO `products_description` VALUES (9,1,'t-shirt_08','','',0);
INSERT INTO `products_description` VALUES (9,2,'びちっこ','白猫びちっこの写真をあしらったキュートなTシャツ。猫好きに大人気！<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',8);
INSERT INTO `products_description` VALUES (10,1,'t-shirt_09','','',0);
INSERT INTO `products_description` VALUES (10,2,'びちっこ','白猫びちっこの写真をあしらったキュートなTシャツ。猫好きに大人気！<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',4);
INSERT INTO `products_description` VALUES (11,1,'t-shirt_10','','',1);
INSERT INTO `products_description` VALUES (11,2,'黒猫こまる（1）','段ボール箱にもぐりこんだ子猫のこまるTシャツ。その愛くるしさに当店人気ナンバーワン商品です。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',14);
INSERT INTO `products_description` VALUES (12,1,'t-shirt_10','','',0);
INSERT INTO `products_description` VALUES (12,2,'箱の中のこまる for KIDS','段ボール箱に潜り込んだ黒猫\"こまる\"Tシャツ。人気ナンバーワン商品です。<br />\r\n大人用もございます。<br /><br />\r\n\r\nベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 \r\n豊富なカラーバリエーションで人気 No.1のTシャツです。\r\n良質な綿花で知られるメンフィスコットンを主に使用し、 \r\n水分吸収が良くソフトで肌触りが良いのが特徴です。<br /><br />\r\n\r\nNOTE：<br />\r\nこの商品は在庫切れ商品のサンプルです。<br /><br />\r\n【在庫切れ商品】 在庫数が0になると、その商品には在庫切れ商品のアイコンが表示されます。<br />\r\n\r\n・在庫切れ商品は、ユーザは商品情報の閲覧はできますが、注文はできません。<br />\r\n・在庫が0になったときのふるまい（在庫切れアイコンを表示させるかどうか等）は、管理サイトの一般設定＞在庫の管理から制御可能です。以下のような設定ができます。<br />\r\n　　・在庫がなくなった商品に、「カートに入れる」ボタンの<br />\r\n　　　代わりに「売り切れ」アイコンを表示する/しない<br />\r\n　　・在庫切れ商品を注文できる/できない<br />\r\n　　・在庫切れ商品のステータス変更：<br />\r\n　　　在庫がなくなったら商品ステータスをOFFにして、<br />\r\n　　　ショップ上への掲載を自動で取りやめる/やめない<br />\r\n　　・在庫数をチェックして水準以下になったら運営者に<br />\r\n　　　メールで知らせる/知らせない<br />','',12);
INSERT INTO `products_description` VALUES (13,1,'t-shirt_11','','',0);
INSERT INTO `products_description` VALUES (13,2,'黒猫こまる（2）','当ショップのモデル猫\"こまる\"のTシャツ。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',3);
INSERT INTO `products_description` VALUES (14,1,'t-shirt_12','','',0);
INSERT INTO `products_description` VALUES (14,2,'Extream Cat（モトクロス）','エクストリームキャットシリーズ。<br /><br />\r\n\r\nベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br />豊富なカラーバリエーションで人気 No.1のTシャツです。良質な綿花で知られるメンフィスコットンを主に使用し、水分吸収が良くソフトで肌触りが良いのが特徴です。<br /><br />\r\n\r\nNOTE：<br />\r\nこの商品は在庫切れ商品のサンプルです。<br /><br />\r\n【在庫切れ商品】 在庫数が0になると、その商品には在庫切れ商品のアイコンが表示されます。<br />\r\n\r\n・在庫切れ商品は、ユーザは商品情報の閲覧はできますが、注文はできません。<br />\r\n・在庫が0になったときのふるまい（在庫切れアイコンを表示させるかどうか等）は、管理サイトの一般設定＞在庫の管理から制御可能です。以下のような設定ができます。<br />\r\n　　・在庫がなくなった商品に、「カートに入れる」ボタンの<br />\r\n　　　代わりに「売り切れ」アイコンを表示する/しない<br />\r\n　　・在庫切れ商品を注文できる/できない<br />\r\n　　・在庫切れ商品のステータス変更：<br />\r\n　　　在庫がなくなったら商品ステータスをOFFにして、<br />\r\n　　　ショップ上への掲載を自動で取りやめる/やめない<br />\r\n　　・在庫数をチェックして水準以下になったら運営者に<br />\r\n　　　メールで知らせる/知らせない<br />','',3);
INSERT INTO `products_description` VALUES (15,1,'t-shirt_13','','',0);
INSERT INTO `products_description` VALUES (15,2,'レッドドラゴン','貴族の紋章のようなドラゴン柄です。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (16,1,'t-shirt_13','','',0);
INSERT INTO `products_description` VALUES (16,2,'レッドドラゴン for KIDS','貴族の紋章のようなドラゴン柄です。<br />大人用もございます。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (17,1,'t-shirt_14','','',0);
INSERT INTO `products_description` VALUES (17,2,'おねむ・・・','ねむた0い春にこんな犬柄はいかが？<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',5);
INSERT INTO `products_description` VALUES (18,1,'t-shirt_15','','',0);
INSERT INTO `products_description` VALUES (18,2,'Extream Cat（サーフィン）','エクストリームキャットシリーズ。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',3);
INSERT INTO `products_description` VALUES (19,1,'t-shirt_16','','',0);
INSERT INTO `products_description` VALUES (19,2,'ラビット','子供たちにも人気の高いラビットキャラ。キッズTも揃っているから親子で揃えて！<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',7);
INSERT INTO `products_description` VALUES (20,1,'t-shirt_16','','',0);
INSERT INTO `products_description` VALUES (20,2,'ラビット for KIDS','子供たちに大人気のラビットキャラ。大人用も揃っているから親子で揃えて！<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (21,1,'t-shirt_17','','',0);
INSERT INTO `products_description` VALUES (21,2,'和風（竹）','大人気の和柄に竹シリーズ登場です。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',1);
INSERT INTO `products_description` VALUES (22,1,'t-shirt_18','','',0);
INSERT INTO `products_description` VALUES (22,2,'和風（竹）','大人気の和柄に竹シリーズ登場です。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',1);
INSERT INTO `products_description` VALUES (23,1,'t-shirt_19','','',0);
INSERT INTO `products_description` VALUES (23,2,'アイコン（二人）','ビビッドな色使いが印象的なアイコンシリーズ。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',1);
INSERT INTO `products_description` VALUES (24,1,'t-shirt_20','','',0);
INSERT INTO `products_description` VALUES (24,2,'アイコン（ベビー）','ビビッドな色使いが印象的なアイコンシリーズ。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (25,1,'t-shirt_21','','',0);
INSERT INTO `products_description` VALUES (25,2,'花と犬','お花に囲まれシアワ気分の犬の写真をあしらいました。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',1);
INSERT INTO `products_description` VALUES (26,1,'t-shirt_21','','',0);
INSERT INTO `products_description` VALUES (26,2,'花と犬 for KIDS','お花に囲まれシアワ気分の犬の写真をあしらいました。大人用も揃っているから親子で揃えて！<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (27,1,'t-shirt_22','','',0);
INSERT INTO `products_description` VALUES (27,2,'フラミンゴ','とぼけた表情が隠れた人気のフラミンゴ柄。キッズTも揃っているから親子で揃えて！<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',4);
INSERT INTO `products_description` VALUES (28,1,'t-shirt_22','','',0);
INSERT INTO `products_description` VALUES (28,2,'フラミンゴ for KIDS','とぼけた表情が隠れた人気のフラミンゴ柄。大人用も揃っているから親子で揃えて！<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',4);
INSERT INTO `products_description` VALUES (29,1,'t-shirt_23','','',0);
INSERT INTO `products_description` VALUES (29,2,'矢印（イエロー）','ビビッドな色使いが印象的なアイコンシリーズ。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',2);
INSERT INTO `products_description` VALUES (30,1,'t-shirt_23','','',0);
INSERT INTO `products_description` VALUES (30,2,'矢印（イエロー） for KIDS','ビビッドな色使いが印象的なアイコンシリーズ。<br />大人用もございます。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',2);
INSERT INTO `products_description` VALUES (31,1,'t-shirt_24','','',0);
INSERT INTO `products_description` VALUES (31,2,'矢印（グリーン）','ビビッドな色使いが印象的なアイコンシリーズ。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (32,1,'t-shirt_25','','',0);
INSERT INTO `products_description` VALUES (32,2,'アイコン（ハロー）','ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',3);
INSERT INTO `products_description` VALUES (33,1,'t-shirt_26','','',0);
INSERT INTO `products_description` VALUES (33,2,'レモンソーダ','レモンソーダのイラストがかわいいです。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (34,1,'t-shirt_27','','',0);
INSERT INTO `products_description` VALUES (34,2,'四つ葉のクローバー（1）','シアワセをよぶ四つ葉のクローバー柄です。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (35,1,'t-shirt_28','','',0);
INSERT INTO `products_description` VALUES (35,2,'グリーンドラゴン','とぼけた表情が大人気のドラゴン柄。キッズTも揃っているから親子で揃えて！<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',2);
INSERT INTO `products_description` VALUES (36,1,'t-shirt_28','','',0);
INSERT INTO `products_description` VALUES (36,2,'グリーンドラゴン for KIDS','とぼけた表情が大人気のドラゴン柄。大人用も揃っているから親子で揃えて！<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',2);
INSERT INTO `products_description` VALUES (37,1,'t-shirt_29','','',0);
INSERT INTO `products_description` VALUES (37,2,'首長竜','ドラゴンシリーズの定番柄。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (38,1,'t-shirt_30','','',0);
INSERT INTO `products_description` VALUES (38,2,'ドラゴン','不思議な雰囲気が人気のドラゴン柄です。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',1);
INSERT INTO `products_description` VALUES (39,1,'t-shirt_30','','',0);
INSERT INTO `products_description` VALUES (39,2,'ドラゴン for KIDS','不思議な雰囲気が人気のドラゴン柄です。<br />大人用もございます。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',1);
INSERT INTO `products_description` VALUES (40,1,'t-shirt_31','','',0);
INSERT INTO `products_description` VALUES (40,2,'ドラゴン','不思議な雰囲気が人気のドラゴン柄です。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',2);
INSERT INTO `products_description` VALUES (41,1,'t-shirt_31','','',0);
INSERT INTO `products_description` VALUES (41,2,'ドラゴン for KIDS','不思議な雰囲気が人気のドラゴン柄です。<br />大人用もございます。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (42,1,'t-shirt_32','','',0);
INSERT INTO `products_description` VALUES (42,2,'四つ葉のクローバー（2）','シアワセをよぶ四つ葉のクローバー柄です。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',1);
INSERT INTO `products_description` VALUES (43,1,'t-shirt_33','','',0);
INSERT INTO `products_description` VALUES (43,2,'ふくろう','冷めた表情のふくろう柄にファン多し。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',8);
INSERT INTO `products_description` VALUES (44,1,'t-shirt_34','','',0);
INSERT INTO `products_description` VALUES (44,2,'ふくろう','冷めた表情のふくろう柄にファン多し。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (45,1,'t-shirt_35','','',0);
INSERT INTO `products_description` VALUES (45,2,'四つ葉のクローバー（1）','シアワセをよぶ四つ葉のクローバー柄です。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (46,1,'t-shirt_36','','',0);
INSERT INTO `products_description` VALUES (46,2,'カフェオレ','ホッと一息つきたい時にやさしいカフェオレ柄はいかがですか？<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',1);
INSERT INTO `products_description` VALUES (47,1,'t-shirt_37','','',0);
INSERT INTO `products_description` VALUES (47,2,'ミニチュアダックス','ワン好きにはたまらない、人気のミニチュアダックス柄。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (48,1,'t-shirt_38','','',0);
INSERT INTO `products_description` VALUES (48,2,'レディー（1）','チャーリーズエンジェルを思わせるお洒落なイラスト。Ubaさんの作品をあしらいました。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','www.flickr.com/photo_zoom.gne?id=4042701&size=m&context=set-101799',4);
INSERT INTO `products_description` VALUES (49,1,'t-shirt_39','','',0);
INSERT INTO `products_description` VALUES (49,2,'レディー（2）','チャーリーズエンジェルを思わせるお洒落なイラスト。Ubaさんの作品をあしらいました。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','www.flickr.com/photo_zoom.gne?id=4042701&size=m&context=set-101799',0);
INSERT INTO `products_description` VALUES (50,1,'t-shirt_40','','',0);
INSERT INTO `products_description` VALUES (50,2,'コーラ','ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',9);
INSERT INTO `products_description` VALUES (51,1,'t-shirt_41','','',0);
INSERT INTO `products_description` VALUES (51,2,'ザリガニ','表情がかわいい真っ赤なザリガニ。隠れたヒット商品です。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',7);
INSERT INTO `products_description` VALUES (52,1,'t-shirt_41','','',0);
INSERT INTO `products_description` VALUES (52,2,'ザリガニ for KIDS','表情がかわいい真っ赤なザリガニ。隠れたヒット商品です。<br />大人用もございます。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',1);
INSERT INTO `products_description` VALUES (53,1,'t-shirt_42','','',0);
INSERT INTO `products_description` VALUES (53,2,'ペンギン','人気の皇帝ペンギン柄。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',2);
INSERT INTO `products_description` VALUES (54,1,'t-shirt_43','','',0);
INSERT INTO `products_description` VALUES (54,2,'ペンギン','人気の皇帝ペンギン柄。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',1);
INSERT INTO `products_description` VALUES (55,1,'t-shirt_43','','',0);
INSERT INTO `products_description` VALUES (55,2,'ペンギン for KIDS','人気の皇帝ペンギン柄。<br />大人用もございます。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',1);
INSERT INTO `products_description` VALUES (56,1,'t-shirt_44','','',0);
INSERT INTO `products_description` VALUES (56,2,'ぷにぷに','正体不明の海の生き物。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (57,1,'t-shirt_44','','',0);
INSERT INTO `products_description` VALUES (57,2,'ぷにぷに for KIDS','正体不明の海の生き物。<br />大人用もございます。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',7);
INSERT INTO `products_description` VALUES (58,1,'t-shirt_45','','',0);
INSERT INTO `products_description` VALUES (58,2,'ブルーホエール','神秘的なブルーホエール（くじら）柄。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (59,1,'t-shirt_45','','',0);
INSERT INTO `products_description` VALUES (59,2,'ホエール for KIDS','神秘的なブルーホエール（くじら）柄。<br />大人用もございます。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',1);
INSERT INTO `products_description` VALUES (60,1,'t-shirt_46','','',0);
INSERT INTO `products_description` VALUES (60,2,'オルカ（シャチ）','当ショップ定番Tのシャチ柄<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',2);
INSERT INTO `products_description` VALUES (61,1,'t-shirt_46','','',0);
INSERT INTO `products_description` VALUES (61,2,'オルカ（シャチ） for KIDS','当ショップ定番Tのシャチ柄<br />大人用もございます。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',1);
INSERT INTO `products_description` VALUES (62,1,'t-shirt_47','','',0);
INSERT INTO `products_description` VALUES (62,2,'オルカ（シャチ）','当ショップ定番Tのシャチ柄<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',7);
INSERT INTO `products_description` VALUES (63,1,'t-shirt_48','','',0);
INSERT INTO `products_description` VALUES (63,2,'軍鶏','真っ赤な軍鶏がパワーをくれます。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',3);
INSERT INTO `products_description` VALUES (64,1,'t-shirt_49','','',0);
INSERT INTO `products_description` VALUES (64,2,'軍鶏','真っ赤な軍鶏がパワーをくれます。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',1);
INSERT INTO `products_description` VALUES (65,1,'t-shirt_50','','',0);
INSERT INTO `products_description` VALUES (65,2,'I love T-Shirt','定番の「I love T-Shirt」ロゴ。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',2);
INSERT INTO `products_description` VALUES (91,1,'wallpaper_04','','',0);
INSERT INTO `products_description` VALUES (90,2,'Extream Cat（カヌー）','Extream Catシリーズの壁紙です。<br /><br />\r\n\r\n★この商品はダウンロード商品です','',7);
INSERT INTO `products_description` VALUES (90,1,'wallpaper_03','','',0);
INSERT INTO `products_description` VALUES (89,2,'Extream Cat（サーフィン）','Extream Catシリーズの壁紙です。<br /><br />\r\n\r\n★この商品はダウンロード商品です','',7);
INSERT INTO `products_description` VALUES (89,1,'wallpaper_02','','',0);
INSERT INTO `products_description` VALUES (88,1,'wallpaper_01','','',0);
INSERT INTO `products_description` VALUES (88,2,'Extream Cat（ジェットスキー）','Extream Catシリーズの壁紙です。<br /><br />\r\n\r\n★この商品はダウンロード商品です','',12);
INSERT INTO `products_description` VALUES (70,1,'Gift Certificate $  5.00','Purchase a Gift Certificate today to share with your family, friends or business associates!','',0);
INSERT INTO `products_description` VALUES (70,2,'ギフト券　500円','ギフト券を購入して、ご家族、お友達、会社の仲間に贈りましょう！','',1);
INSERT INTO `products_description` VALUES (71,1,'Gift Certificate $ 10.00','Purchase a Gift Certificate today to share with your family, friends or business associates!','',0);
INSERT INTO `products_description` VALUES (71,2,'ギフト券 1,000円','ギフト券を購入して、ご家族、お友達、会社の仲間に贈りましょう！','',0);
INSERT INTO `products_description` VALUES (72,1,'Gift Certificate $ 25.00','Purchase a Gift Certificate today to share with your family, friends or business associates!','',0);
INSERT INTO `products_description` VALUES (72,2,'ギフト券 2,500円','ギフト券を購入して、ご家族、お友達、会社の仲間に贈りましょう！','',0);
INSERT INTO `products_description` VALUES (73,1,'Gift Certificate $ 50.00','Purchase a Gift Certificate today to share with your family, friends or business associates!','',0);
INSERT INTO `products_description` VALUES (73,2,'ギフト券 5,000円','ギフト券を購入して、ご家族、お友達、会社の仲間に贈りましょう！','',3);
INSERT INTO `products_description` VALUES (74,1,'Gift Certificate $100.00','Purchase a Gift Certificate today to share with your family, friends or business associates!','',0);
INSERT INTO `products_description` VALUES (74,2,'ギフト券 10,000円','ギフト券を購入して、ご家族、お友達、会社の仲間に贈りましょう！','',1);
INSERT INTO `products_description` VALUES (75,1,'Gift Certificates by attributes','Priced by Attributes Gift Certificates.','',0);
INSERT INTO `products_description` VALUES (75,2,'ギフト券（購入時に種類を選択）','ギフト券の種類（額面）をオプション属性で設定する例です','',2);
INSERT INTO `products_description` VALUES (76,1,'Test One','This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.','',0);
INSERT INTO `products_description` VALUES (76,2,'サンプル01','この商品は、他のカテゴリにリンクしていません。','',0);
INSERT INTO `products_description` VALUES (77,1,'Test Two','This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.','',0);
INSERT INTO `products_description` VALUES (77,2,'サンプル02','この商品は、他のカテゴリにリンクしていません。','',0);
INSERT INTO `products_description` VALUES (78,1,'Test Three','This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.','',0);
INSERT INTO `products_description` VALUES (78,2,'サンプル03','この商品は、他のカテゴリにリンクしていません。','',0);
INSERT INTO `products_description` VALUES (79,1,'Test Four','This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.','',0);
INSERT INTO `products_description` VALUES (79,2,'サンプル04','この商品は、他のカテゴリにリンクしていません。','',0);
INSERT INTO `products_description` VALUES (80,1,'Test Five','This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.','',0);
INSERT INTO `products_description` VALUES (80,2,'サンプル05','この商品は、他のカテゴリにリンクしていません。','',0);
INSERT INTO `products_description` VALUES (81,1,'Test Eight','This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.','',0);
INSERT INTO `products_description` VALUES (81,2,'サンプル08','この商品は、他のカテゴリにリンクしていません。','',2);
INSERT INTO `products_description` VALUES (82,1,'Test Ten','This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.','',0);
INSERT INTO `products_description` VALUES (82,2,'サンプル10','この商品は、他のカテゴリにリンクしていません。','',1);
INSERT INTO `products_description` VALUES (83,1,'Test Six','This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.','',0);
INSERT INTO `products_description` VALUES (83,2,'サンプル06','この商品は、他のカテゴリにリンクしていません。','',1);
INSERT INTO `products_description` VALUES (156,2,'【1】セール適用の基本例','セール機能を理解するための、ごくシンプルな例です。<br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />この商品には商品オプション（カラー3種類）がついていますが、<br />オプションには追加料金を設定していないのでもともとどのカラーでも同料金です。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％OFF<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・セール対象のカテゴリ：　「セール10％OFF」カテゴリ<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール10％OFF」カテゴリ<br />・商品価格：　10000円<br /><br />\r\n\r\nNOTE：<br />\r\nこの商品は、「セール10％OFF」カテゴリ（←これがマスターカテゴリ）の他に、\r\n「セールと特価 > セール対象外カテゴリ」にもリンクされています。<br /><br />\r\n「セール対象外カテゴリ」は、セールの設定をしていないカテゴリですが、\r\nこの商品のマスターカテゴリはセール設定されたカテゴリなので、「セール対象外カテゴリ」で表示される時もセールが適用される点に注目してください。','',3);
INSERT INTO `products_description` VALUES (84,1,'Test Seven','This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.','',0);
INSERT INTO `products_description` VALUES (84,2,'サンプル07','この商品は、他のカテゴリにリンクしていません。','',0);
INSERT INTO `products_description` VALUES (85,1,'Test Twelve','This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.','',0);
INSERT INTO `products_description` VALUES (85,2,'サンプル12','この商品は、他のカテゴリにリンクしていません。','',0);
INSERT INTO `products_description` VALUES (86,1,'Test Nine','This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.','',0);
INSERT INTO `products_description` VALUES (86,2,'サンプル09','この商品は、他のカテゴリにリンクしていません。','',0);
INSERT INTO `products_description` VALUES (87,1,'Test Eleven','This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.','',0);
INSERT INTO `products_description` VALUES (87,2,'サンプル11','この商品は、他のカテゴリにリンクしていません。','',0);
INSERT INTO `products_description` VALUES (91,2,'Extream Cat（モトクロス）','Extream Catシリーズの壁紙です。<br /><br />\r\n\r\n★この商品はダウンロード商品です','',2);
INSERT INTO `products_description` VALUES (92,1,'A Free Product - All','This is a free product where there are no prices at all.  <br /><br />    The Always Free Shipping is also turned ON.  <br /><br />    If this is bought separately, the Zen Cart Free Charge payment module will show if there is no charges on shipping.  <br /><br />    If other products are purchased with a price or shipping charge, then the Zen Cart Free Charge payment module will not show and the shipping will be applied accordingly.','',0);
INSERT INTO `products_description` VALUES (92,2,'【例1】無料商品：定価0円、送料も無料','無料商品のサンプルです。もともとの商品価格が0円の商品で、同時に送料も無料に設定した例で、例えばデモ商品やサンプル商品請求などのケースがこれにあたるでしょう。<br /><br /><br />なお、同時購入した他の商品すべてがデモ商品であるときは送料は全く発生しませんが、他に送料がかかる商品も購入すれば、送料は通常通りかかります。<br /><br /><br /><br />【設定メモ】<br /><br />・無料商品： はい<br /><br />・商品価格：　0円<br /><br />・常に送料無料：　はい、常に送料無料<br />','',14);
INSERT INTO `products_description` VALUES (93,1,'A Free Product - SALE','This is a free product that is also on special.  <br />    This should show as having a price, special price but then be free.  <br />','',0);
INSERT INTO `products_description` VALUES (93,2,'【例4】無料商品：特価商品をさらに無料に。送料は有料','無料商品のサンプルです。もともとの商品価格は10000円で、さらに特価価格7500円の商品ですが、無料商品＝「はい」に設定したことにより、結果的に無料商品となります。もとの商品価格と、特価価格の両方が表示され、さらにそれらが打ち消されて無料商品と表示されます。<br /><br />商品自体は無料となりますが、この例では送料は無料とせず、通常送料がかかるよう設定しました。このケースは、サンプル商品請求時に送料だけは負担していただきたいような場合を想定しています。<br /><br /><br /><br />【設定メモ】<br /><br />・無料商品：　はい<br /><br />・商品価格： 10000円<br /><br />・特価価格： 7500円<br /><br />・常に送料無料： いいえ、通常送料を適用<br />','',11);
INSERT INTO `products_description` VALUES (222,1,'FREESHIP1','','',0);
INSERT INTO `products_description` VALUES (222,2,'【1】常に送料無料','[常に送料無料]の設定を\"はい\"にすることで、その商品の重量や価格に関係なく常時送料無料商品として扱う例です。オプション重量も無料対象に含まれます。<br /><br />\r\n\r\n【設定メモ】商品情報<br />\r\n・[常に送料無料]：はい<br />\r\n・[商品重量]：50Kg<br /><br />\r\n\r\n【設定メモ】オプション属性<br />\r\n\"ホワイト\"／\"オレンジ\" の各オプションについて、\r\n・[オプション重量] 100Kg ／ 40Kg','',9);
INSERT INTO `products_description` VALUES (223,1,'FREESHIP2','','',0);
INSERT INTO `products_description` VALUES (223,2,'【2】送料無料・バーチャル商品','[常に送料無料]の設定を\"はい\"にすることで、その商品の重量や価格に関係なく常時送料無料商品になります。さらに[ヴァーチャル商品]の設定も\"はい\"にしたので、注文手続き送付先住所の入力ステップがスキップされます。<br />\r\nオプション重量も無料対象に含まれます。<br /><br />\r\n\r\n【設定メモ】商品情報<br />\r\n・[ヴァーチャル商品]：はい、送付先住所をスキップ<br />\r\n・[常に送料無料]：はい<br />\r\n・[商品重量]：50Kg<br /><br />\r\n\r\n【設定メモ】オプション属性<br />\r\n\"ホワイト\"／\"オレンジ\" の各オプションについて、\r\n・[オプション重量] 100Kg ／ 40Kg','',4);
INSERT INTO `products_description` VALUES (95,1,'Free Ship & Payment Virtual weight 10','Free Shipping and Payment  <br /><br />    The Price is set to 25.00 ... but what makes it Free is that this product has been marked as:  <br />  Product is Free: Yes  <br /><br />    This would allow the product to be listed with a price, but the actual charge is $0.00  <br /><br />    The weight is set to 10 but could be set to 0. What really makes it truely Free Shipping is that it has been marked to be Always Free Shipping.  <br /><br />    Always Free shipping is set to: Yes<br />  This will not charge for shipping, but requres a shipping address.  <br /><br />    Because there is no shipping and the price is 0, the Zen Cart Free Charge comes up for the payment module and the other payment modules vanish.  <br /><br />    You can change the text on the Zen Cart Free Charge module to read as you would prefer.  <br /><br />    Note: if you add products that incur a charge or shipping charge, then the Zen Cart Free Charge payment module will vanish and the regular payment modules will show.','',0);
INSERT INTO `products_description` VALUES (95,2,'【例2】無料商品：定価1万円のところ価格・送料共に無料化','無料商品で、かつ送料無料の例です。<br /><br /><br />元の商品価格は10000円ですが、無料商品に設定されているため無料となります。<br />また、商品重量は10Kgありますが、送料を無料に設定していますので送料もかかりません。ただし、バーチャル商品＝いいえに設定してあるのでユーザは送付先住所の入力が必要です。<br /><br />【設定メモ】<br />・無料商品： はい<br />・商品価格：　0円<br />・ヴァーチャル商品： いいえ、送付先住所が必要<br />・常に送料無料：　はい、常に送料無料','',14);
INSERT INTO `products_description` VALUES (101,2,'【例3】価格お問い合せ商品（定価とセール価格表示）','この商品はセール対象商品です。商品価格（定価）と特価価格、セール価格が表示されますが、この商品をカゴに入れて注文することはできず、事前のお問い合せが必要です。<br /><br />通常の購入ボタンのかわりに「価格お問い合わせ商品 」ボタンが表示され、クリックするとお問い合せフォームが開きます。<br /><br /><br /><br />【設定メモ】<br /><br />・価格お問い合わせ商品：　はい<br /><br />・商品価格 (ネット)： 10000円<br /><br />・特価価格： 9000円<br />・商品の管理＞セールの管理：　この商品マスターカテゴリに10％のセール設定してある','',9);
INSERT INTO `products_description` VALUES (102,1,'Normal Product','<p>This is a normal product priced at $15</p><p>There are quantity discounts setup which will be discounted from the Products Price.</p><p>Discounts are added on the Products Price Manager.</p>','',0);
INSERT INTO `products_description` VALUES (102,2,'【例1】○個以上買うと1個あたり○％引き','数量割引（いわゆるボリュームディスカウント）の適用例です。<br />9個までは定価、10020個で定価の10％引き、20049個で20％引き、50個以上で25％引きというように、割引率による数量割引を設定しました。<br /><br />NOTE：　この設定は「商品価格の管理」から行います。<br />※商品の管理＞商品価格の管理　から呼び出すか、あるいは管理画面の商品リストの右端にある[＄]ボタン（緑色のボタン）から呼び出すことができます。<br /><br /><br /><br />【設定メモ：商品価格の管理】<br /><br />以下の設定により、計算式は、購入代金＝｛定価×（1\"数量割引率）｝　×　購入数となります。<br />・ディスカウントタイプ：　割引率<br />・この価格からディスカウント：　価格<br />・割引設定<br /><br />　------------------------------------------<br /><br />　割引レベル　　　　最小限の有効数量　　　割引の値<br /><br />　------------------------------------------<br /><br />　割引3　　　　　　　　10　（個）　　　　　　　　　10.0　（％）　<br /><br />　割引4　　　　　　　　20　（個）　　　　　　　　　20.0　（％）　<br /><br />　割引5　　　　　　　　50　（個）　　　　　　　　　25.0　（％）　<br /><br />　------------------------------------------<br /><br />','',11);
INSERT INTO `products_description` VALUES (103,1,'Normal Product（2）','','',0);
INSERT INTO `products_description` VALUES (103,2,'【例2】○個以上買うと1個あたり○円引き','数量割引（いわゆるボリュームディスカウント）の適用例です。<br />9個までは定価、10020個で定価の1000円引き、20049個で1500円引き、50個以上で2000円引きというように、定価から一定額値引きされる数量割引を設定しました。<br /><br />NOTE：　この設定は「商品価格の管理」から行います。<br />※商品の管理＞商品価格の管理　から呼び出すか、あるいは管理画面の商品リストの右端にある[＄]ボタン（緑色のボタン）から呼び出すことができます。<br /><br /><br /><br />【設定メモ：商品価格の管理】<br /><br />以下の設定により、計算式は、購入代金＝（定価\"定額値引き）　×　購入数となります。<br /><br />・ディスカウントタイプ：　一定金額割引<br />・この価格からディスカウント：　価格<br />・割引設定<br /><br />　------------------------------------------<br />　割引レベル　　　　最小限の有効数量　　　割引の値<br />　------------------------------------------<br />　割引3　　　　　　　　10　（個）　　　　　　　　　1000　（円）　<br />　割引4　　　　　　　　20　（個）　　　　　　　　　1500　（円）　<br />　割引5　　　　　　　　50　（個）　　　　　　　　　2000　（円）　<br />　------------------------------------------<br />','',8);
INSERT INTO `products_description` VALUES (155,1,'A Free Product with Attributes','This is a free product that is also on special.  <br /><br />    This should show as having a price, special price but then be free.  <br /><br />    Attributes can be added that can optionally be set to free or not free  <br /><br />    The Color Red attribute is priced at $5.00 but marked as a Free Attribute when the Product is Free  <br /><br />    The Size Medium attribute is priced at $1.00 but marked as a Free Attribute when Product is Free','',0);
INSERT INTO `products_description` VALUES (101,1,'A Call for Price Product SALE','This is a Call for Price product that is also on special and has a Sale price via Sale Maker.<br /><br /><br /><br /><br />This should show as having a price, special price but then be Call for Price. This means you cannot buy it.<br /><br /><br /><br /><br />The Add to Cart buttons automatically change to Call for Price, which is defined as: TEXT_CALL_FOR_PRICE<br /><br /><br /><br /><br />This link will take the customer to the Contact Us page.<br /><br /><br />','',0);
INSERT INTO `products_description` VALUES (98,1,'A Free Product with Attributes','This is a free product that is also on special.  <br /><br />    This should show as having a price, special price but then be free.  <br /><br />    Attributes can be added that can optionally be set to free or not free  <br /><br />    The Color Red attribute is priced at $5.00 but marked as a Free Attribute when the Product is Free  <br /><br />    The Size Medium attribute is priced at $1.00 but marked as a Free Attribute when Product is Free','',0);
INSERT INTO `products_description` VALUES (98,2,'【例5】無料商品：本体無料だけどオプションは有料','商品を無料商品にしても、商品オプションの追加料金の方は有料のままにしたい場合の例です。<br /><br />\r\n\r\nこの例では、カラー＝レッドを選択した場合だけ追加料金（500円増し）が発生する設定になっています。<br />\r\nさらに、「商品が無料のとき属性による価格も無料にする＝いいえ」に設定されているので、商品を無料商品に設定しても\r\n属性価格には影響しません。つまり、レッドを選択すると500円、他の色を選択したときは0円となります。<br /><br />\r\n\r\n\r\n【設定メモ】<br />\r\n・無料商品： はい<br /><br />\r\n\r\n【オプション属性設定メモ： カラー「レッド」】<br />\r\n・オプション名：カラー<br />\r\n・オプション値：レッド<br />\r\n・属性による価格設定：　＋500円<br />\r\n・商品が無料のとき属性による価格も無料にする： いいえ','',18);
INSERT INTO `products_description` VALUES (155,2,'【例6】無料商品：本体無料ならオプションも無料','商品を無料商品にしたら、商品オプションの追加料金の方も無料にしたい場合の例です。<br /><br />\r\n\r\nこの例では、カラー＝レッドを選択した場合だけ追加料金（500円増し）が発生する設定になっています。<br />\r\nさらに、「商品が無料のとき属性による価格も無料にする＝はい」に設定されているので、商品を無料商品に設定したら\r\n属性価格も無料になります。つまり、レッドを選択しても0円です。<br /><br />\r\n\r\n\r\n【設定メモ】<br />\r\n・無料商品： はい<br /><br />\r\n\r\n【オプション属性設定メモ： カラー「レッド」】<br />\r\n・オプション名：カラー<br />\r\n・オプション値：レッド<br />\r\n・属性による価格設定：　＋500円　（ベース価格に500円増し）<br />\r\n・商品が無料のとき属性による価格も無料にする： はい','',3);
INSERT INTO `products_description` VALUES (99,1,'A Call No Price','This is a Call for Price product with no price<br /><br /><br />This should show as having a price, special price but then be Call for Price. This means you cannot buy it.<br /><br />','',0);
INSERT INTO `products_description` VALUES (99,2,'【例1】価格お問い合せ商品（定価表示なし）','これは「価格お問い合せ商品」の例です。<br /><br />商品価格（定価）を0円に設定してあり価格表示はされません（ただし無料商品には設定されていないので無料マークはつかない）。この商品をカゴに入れて注文することはできず、事前のお問い合せが必要です。<br /><br />通常の購入ボタンのかわりに「価格お問い合わせ商品 」ボタンが表示され、クリックするとお問い合せフォームが開きます。<br /><br /><br /><br />【設定メモ】<br /><br />・無料商品： いいえ<br /><br />・価格お問い合わせ商品：　はい<br /><br />・商品価格 (ネット)： 0円','',5);
INSERT INTO `products_description` VALUES (100,1,'A Call for Price Product','This is a Call for Price product that is also on special. <br /><br /><br />This should show as having a price, special price but then be Call for Price. This means you cannot buy it','',0);
INSERT INTO `products_description` VALUES (100,2,'【例2】価格お問い合せ商品（価格表示あり）','価格お問い合せ商品の例です<br /><br /><br />この商品には商品価格が表示されますが、この商品をカゴに入れて注文することはできず、事前のお問い合せが必要です。<br /><br />通常の購入ボタンのかわりに「価格お問い合わせ商品 」ボタンが表示され、クリックするとお問い合せフォームが開きます。<br /><br /><br /><br />【設定メモ】<br /><br />・価格お問い合わせ商品：　はい<br /><br />・商品価格 (ネット)： 10000円<br /><br />・特価価格： 9000円','',9);
INSERT INTO `products_description` VALUES (104,1,'Normal Product(3)','','',0);
INSERT INTO `products_description` VALUES (104,2,'【例3】○個以上買うと1個あたり○○円','数量割引（いわゆるボリュームディスカウント）の適用例です。<br />9個までは単価10000円、10020個で単価9500円、20049個で単価9000円、50個以上で単価8000円というように、単価が割り引き価格になるような数量割引を設定しました。<br /><br />NOTE：　この設定は「商品価格の管理」から行います。<br />※商品の管理＞商品価格の管理　から呼び出すか、あるいは管理画面の商品リストの右端にある[＄]ボタン（緑色のボタン）から呼び出すことができます。<br /><br /><br /><br />【設定メモ：商品価格の管理】<br /><br />以下の設定により、計算式は、購入代金＝割引後価格　×　購入数となります。<br /><br />・ディスカウントタイプ：　割引後価格<br />・この価格からディスカウント：　価格<br />・割引設定<br /><br />　------------------------------------------<br />　割引レベル　　　　最小限の有効数量　　　割引の値<br />　------------------------------------------<br />　割引3　　　　　　　　10　（個）　　　　　　　　　9500　（円）　<br />　割引4　　　　　　　　20　（個）　　　　　　　　　9000　（円）　<br />　割引5　　　　　　　　50　（個）　　　　　　　　　8000　（円）　<br />　------------------------------------------<br />','',8);
INSERT INTO `products_description` VALUES (115,1,'SEO','','',0);
INSERT INTO `products_description` VALUES (115,2,'商品ページへのSEO（META、title）設定例','SEO対策の一環として、Zen Cartでは個別商品ごとにMETAタグやtitleタグを明示的に設定することができます。<br /><br />\r\n\r\nこのサンプル商品に対して、以下のように設定しました。<br />\r\nブラウザの「ソースを表示」で、このページのHTMLソースの<head>0</head>部分を確認してみてください。<br /><br />\r\n\r\n【設定メモ：META】<br />\r\n・title：<br />\r\n　　「この商品ページには明示的にtitleタグを設定しました。」<br /><br />\r\n・META（keyword）：<br />\r\n　　「この商品ページには明示的にMETA（keyword）を設定しています,商品キーワード1,商品キーワード2,商品キーワード3」<br /><br />\r\n\r\n・META（description）：<br />\r\n　　「この商品ページには明示的にMETA（description）を設定しています。Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus sit amet velit・・・」<br /><br />\r\n\r\nNOTE：<br />\r\n・ちなみにこの機能を利用しなくても、Zen Cartでは標準機能としてMETAやtitleタグに商品名や価格その他の要素を埋め込むようにできています。<br />\r\n・管理画面の一般設定＞商品情報の設定から、TITLEタグに商品価格を含める（含めない）やMETA（description）のテキスト長などの設定ができます。これは全商品に対して適用されます。<br /><br />','',15);
INSERT INTO `products_description` VALUES (113,1,'Normal Product(8)','','',0);
INSERT INTO `products_description` VALUES (113,2,'【例8】カラー混在OKで合計○個以上なら特価をさらに数量割引','サイズやカラーなどのオプション属性を持ち、さらに特価設定された商品に対して数量割引（いわゆるボリュームディスカウント）を適用したやや複雑な設定例です。<br />9個までは定価、10020個で定価の10％引き、20049個で20％引き、50個以上で25％引きというように、割引率による数量割引を設定しました。<br />特価ベースで数量割引率が適用される点以外は、前の【例6】と同じ設定です。ふるまいがどう変わるか見比べてみてください。<br />NOTE：　この設定は「商品価格の管理」から行います。<br />※商品の管理＞商品価格の管理　から呼び出すか、あるいは管理画面の商品リストの右端にある[＄]ボタン（緑色のボタン）から呼び出すことができます。<br /><br />【設定メモ：商品価格の管理】<br /><br />以下の設定により、計算式は、購入代金＝｛特価×（1\"数量割引率）｝　×　購入数となります。<br />・ディスカウントタイプ：　割引率<br />・この価格からディスカウント：　特価<br />・割引設定<br />　------------------------------------------<br />　割引レベル　　　　最小限の有効数量　　　割引の値<br />　------------------------------------------<br />　割引3　　　　　　　　10　（個）　　　　　　　　　10.0　（％）　<br />　割引4　　　　　　　　20　（個）　　　　　　　　　20.0　（％）　<br />　割引5　　　　　　　　50　（個）　　　　　　　　　25.0　（％）　<br />　------------------------------------------<br /><br />\r\n【設定メモ：オプション属性】<br />\r\n1）カラー「ホワイト」<br />\r\n　　・価格： ＋0円<br />\r\n　　・特価/セール割引を適用した価格をベース価格として扱う：　はい<br />\r\n2）カラー「ブラック」<br />\r\n　　・価格：　＋1000円<br />\r\n　　・特価/セール割引を適用した価格をベース価格として扱う：　はい<br />\r\n　　・属性による価格増減をベース価格に含める：　はい<br /><br />\r\n\r\nNOTE：<br />\r\nこの例では、オプションをいろいろ取り混ぜてよく、この商品の合計が規定量以上であれば（個々のオプション選択がなんであれ）割り引きが適用されます。<br />\r\nつまり、ホワイト5コカゴに入れ、続いてブラックを5コカゴに入れた時点で合計10コと見なされて割引価格が適用されます。<br />\r\nもちろんホワイトあるいはブラック単体で10個以上購入しても割引かれます。<br />\r\nこれは、商品価格の管理において、「数量は同一商品であればオプション値に関係なく合算する＝はい」に設定した場合にこのような動作になります。<br /><br />','',9);
INSERT INTO `products_description` VALUES (112,1,'Normal Product(7)','','',0);
INSERT INTO `products_description` VALUES (112,2,'【例7】カラー混在OKで合計○個以上なら割引','サイズやカラーなどのオプション属性を持つ商品に、数量割引（いわゆるボリュームディスカウント）を適用したやや複雑な設定例です。<br />\r\n9個までは定価、10020個で定価の10％引き、20049個で20％引き、50個以上で25％引きというように、割引率による数量割引を設定しました。<br /><br />\r\nこの例では、オプションをいろいろ取り混ぜてよく、この商品の合計が規定量以上であれば（個々のオプション選択がなんであれ）割り引きが適用されます。<br />\r\nつまり、ホワイト5コカゴに入れ、続いてブラックを5コカゴに入れた時点で合計10コと見なされて割引価格が適用されます。<br />\r\nもちろんホワイトあるいはブラック単体で10個以上購入しても割引かれます。<br />\r\nこれは、商品価格の管理において、「数量は同一商品であればオプション値に関係なく合算する＝はい」に設定した場合にこのような動作になります。<br /><br />\r\n\r\n\r\nNOTE：　この設定は「商品価格の管理」から行います。<br />※商品の管理＞商品価格の管理　から呼び出すか、あるいは管理画面の商品リストの右端にある[＄]ボタン（緑色のボタン）から呼び出すことができます。<br /><br />\r\n\r\n【設定メモ：商品価格の管理】<br />\r\n以下の設定により、計算式は、購入代金＝｛定価×（1\"数量割引率）｝　×　購入数となります。<br />\r\n・ディスカウントタイプ：　割引率<br />\r\n・この価格からディスカウント：　価格<br />\r\n・割引設定<br /><br />\r\n　　・数量は同一商品であればオプション値に関係なく合算する：　はい<br />\r\n　------------------------------------------<br />\r\n　割引レベル　　　　最小限の有効数量　　　割引の値<br />\r\n　------------------------------------------<br />\r\n　割引3　　　　　　　　10　（個）　　　　　　　　　10.0　（％）<br />\r\n　割引4　　　　　　　　20　（個）　　　　　　　　　20.0　（％）<br />\r\n　割引5　　　　　　　　50　（個）　　　　　　　　　25.0　（％）<br />\r\n　-----------------------------------------<br /><br />\r\n\r\n【設定メモ：オプション属性】<br />\r\n1）カラー「ホワイト」<br />\r\n　　・価格： ＋0円<br />\r\n　　・特価/セール割引を適用した価格をベース価格として扱う：　はい<br />\r\n2）カラー「ブラック」<br />\r\n　　・価格：　＋1000円<br />\r\n　　・特価/セール割引を適用した価格をベース価格として扱う：　はい<br />\r\n　　・属性による価格増減をベース価格に含める：　はい','',16);
INSERT INTO `products_description` VALUES (110,1,'Normal Product（4）','','',0);
INSERT INTO `products_description` VALUES (110,2,'【例4】○個までは特価、それ以上なら定価の○％引き','特価価格が設定された商品に数量割引（いわゆるボリュームディスカウント）を適用した例です。<br />数が少ないうちは特価価格が適用され、一定数以上購入すると、1個あたりの価格が、定価の○％値引かれる数量割引が適用されます。つまり数量割引分は定価ベースで計算される設定です。<br /><br />NOTE：　この設定は「商品価格の管理」から行います。<br />※商品の管理＞商品価格の管理　から呼び出すか、あるいは管理画面の商品リストの右端にある[＄]ボタン（緑色のボタン）から呼び出すことができます。<br /><br /><br /><br />【設定メモ：商品価格の管理】<br /><br />以下の設定により、計算式は、<br />　・数量割引以下の時：　購入代＝特価 × 購入数<br />　・数量割引以上の時：　購入代金＝｛定価×（1\"数量割引率）｝　×　購入数で計算されます。<br /><br />・ディスカウントタイプ：　割引率（％）<br />・この価格からディスカウント：　定価<br />・割引設定<br /><br />　------------------------------------------<br />　割引レベル　　　　最小限の有効数量　　　割引の値<br />　------------------------------------------<br />　割引3　　　　　　　　10　（個）　　　　　　　　　10　（％）　<br />　割引4　　　　　　　　20　（個）　　　　　　　　　20　（％）　<br />　割引5　　　　　　　　50　（個）　　　　　　　　　25　（％）　<br />　------------------------------------------<br />','',17);
INSERT INTO `products_description` VALUES (111,1,'Normal Product(5)','','',0);
INSERT INTO `products_description` VALUES (111,2,'【例5】○個までは特価、それ以上なら特価をさらに○％引き','特価価格が設定された商品に数量割引（いわゆるボリュームディスカウント）を適用した例です。<br />一定数以上購入すると、1個あたりの価格が、特価価格からさらに○％値引かれます。つまり割引分も特価ベースで計算される設定です。<br /><br />NOTE：　この設定は「商品価格の管理」から行います。<br />※商品の管理＞商品価格の管理　から呼び出すか、あるいは管理画面の商品リストの右端にある[＄]ボタン（緑色のボタン）から呼び出すことができます。<br /><br /><br /><br />【設定メモ：商品価格の管理】<br /><br />以下の設定により、計算式は、購入代金＝（特価×（1\"数量割引率）　×　購入数となります。<br /><br />・ディスカウントタイプ：　割引率（％）<br />・この価格からディスカウント：　特価<br />・割引設定<br />　------------------------------------------<br />　割引レベル　　　　最小限の有効数量　　　割引の値<br />　------------------------------------------<br />　割引3　　　　　　　　10　（個）　　　　　　　　　10　（％）<br />　割引4　　　　　　　　20　（個）　　　　　　　　　20　（％）<br />　割引5　　　　　　　　50　（個）　　　　　　　　　25　（％）　<br />　------------------------------------------<br />','',12);
INSERT INTO `products_description` VALUES (116,1,'SEO2','','',0);
INSERT INTO `products_description` VALUES (116,2,'META、title設定していない標準の商品ページ例','これは標準の商品ページ（META設定例、title設定を明示的に設定していない）のサンプルです。<br /><br />\r\n\r\nSEO対策の一環として、Zen Cartでは個別商品ごとにMETAタグやtitleタグを明示的に設定することができますが、<br />\r\nこのページをみてわかるように、<br />\r\nZen Cartでは標準機能としてMETAやtitleタグに商品名や価格その他の要素を埋め込むようにできています。<br /><br />\r\n\r\n管理画面の一般設定＞商品情報の設定から、TITLEタグに商品価格を含める（含めない）やMETA（description）のテキスト長などの設定ができます。これは全商品に対して適用されます。<br /><br />','',3);
INSERT INTO `products_description` VALUES (142,1,'ATTR_CHKBOX1','','',0);
INSERT INTO `products_description` VALUES (142,2,'【1】ギフトオプション','商品オプションのタイプ＝CHECKBOX（チェックボックス）の活用サンプルです。<br /><br />チェックボックスタイプにすると、1商品あたり複数のオプションを同時選択できます。<br />この例では、ご贈答用やプレゼント向けのオプションとして、（1）ギフト包装、（2）メッセージカード、（3）オリジナルキーホルダー付きの3つを設定しました。<br />このうちオリジナルキーホルダー付きは有料オプション、他の2つは無料サービスとしました。なおオプション料金は特価/セールの影響をうけない設定にしています。<br /><br /><br />【設定メモ】<br />■オプション名：　ギフトオプション<br />　・オプションのタイプ：　CHECKBOX<br />■オプション属性＞価格と重量： <br />　オプション値　　　　　　オプション価格　　　特価商品/セールによって割引を適用する<br />　--------------------------------------------------------------<br />　（1）ギフト包装　　　　 　　　＋0円　　　　　　いいえ<br />　（2）メッセージカード　　　　＋0円　　　　　　いいえ<br />　（3）キーホルダー付き　＋100円　　　　　　いいえ<br />','',18);
INSERT INTO `products_description` VALUES (140,1,'ATTR_TEXT2','','',0);
INSERT INTO `products_description` VALUES (140,2,'【2】名入れオプション例（1ワードいくら）','商品オプションのタイプ＝TEXTの活用サンプルです。<br />前の例同様、この例でもＴシャツへの名入れ指定として使っています。<br />前の例では1文字いくらの料金設定でしたが、ここでは1ワードいくらでカウントします（Wordでカウントするのは日本語にはなじまないやり方かもしれませんが？！）<br /><br /><br />2ワードまで無料、3ワード以上では1ワードあたり20円の追加料金でTシャツに指定の文字を入れられる設定です。<br /><br />【設定メモ】<br />■オプション名：　名入れ（1）<br />　・オプションのタイプ：　TEXT<br />　・テキスト属性の最長と表示サイズ<br />　　　・コメント：<br />　　　　「入れたい文字列を入力してください（全角40文字まで）。」<br />　　　・行：　1<br />　　　・表示サイズ：　40<br />　　　・最長：　80<br />■商品オプション属性 ＞ 価格と重量<br />　・言葉ごとの価格？：　20円<br />　・無料の言葉？：　2（ワード）<br />　・属性フラグ<br />　　　・属性によって価格がつけられるとき基本価格に含める：　はい<br />　　　・テキスト入力を必須にする：　はい','',6);
INSERT INTO `products_description` VALUES (141,1,'ATTR_RDONLY','','',0);
INSERT INTO `products_description` VALUES (141,2,'表示のみオプション利用例','オプション属性の利用方法は、商品バリエーションの選択肢としての利用だけではありません。<br />商品ページに定型文を表示する用途としても利用可能です。<br />その場合は、オプションのタイプとして「READ ONLY」を使います。<br /><br />【設定メモ】<br />■オプション名：　お手入れ方法<br />　・オプションのタイプ：　READ ONLY<br />■オプション値<br />　（1）綿 100％ <br />　（2）６.1オンス<br />　（3）洗濯機（弱水流）または手荒い。水温は40℃まで。※オプション画像を登録<br />　（4）アイロンは中温（0160℃）まで 　　※オプション画像を登録','',17);
INSERT INTO `products_description` VALUES (139,1,'ATTR_TEXT1','','',0);
INSERT INTO `products_description` VALUES (139,2,'【1】名入れオプション例（1文字いくら）','商品オプションのタイプ＝TEXTの活用サンプルです。<br />この例では、Ｔシャツへの名入れ指定として使っています。<br /><br /><br />名入れエリアは最大2行、<br />　・1行目は5文字まで無料、6文字以上は一文字10円<br />　・2行目は1文字5円<br />の追加料金でTシャツに指定の文字を入れられる想定で設定しました。<br /><br />【設定メモ：商品情報】<br />\r\n・商品属性による価格：　はい<br /><br />【設定メモ】　※ 1行目名入れエリア用<br />■オプション名：　名入れ（1）<br />　・オプションのタイプ：　TEXT<br />　・テキスト属性の最長と表示サイズ<br />　　　・コメント：<br />　　　　「1行目に入れる文字を入力してください（全角40文字まで）。」<br />　　　・行：　1<br />　　　・表示サイズ：　40<br />　　　・最長：　80<br />■商品オプション属性 ＞ 価格と重量<br />　・文字ごとの価格？：　10円<br />　・無料の文字？：　5文字<br />　・属性フラグ<br />　　　・属性によって価格がつけられるとき基本価格に含める：　はい<br />　　　・テキスト入力を必須にする：　はい<br /><br />-----------------------<br />【設定メモ】　※2行目名入れエリア用<br />■オプション名：　名入れ（2）<br />　・オプションのタイプ：　TEXT<br />　・テキスト属性の最長と表示サイズ<br />　　　・コメント：<br />　　　　「2行目に入れる文字を入力してください（全角40文字まで）。」<br />　　　・行：　1<br />　　　・表示サイズ：　40<br />　　　・最長：　80<br />■商品オプション属性 ＞ 価格と重量<br />　・文字ごとの価格？：　5円<br />　・無料の文字？：　0文字<br />　・属性フラグ<br />　　　・属性によって価格がつけられるとき基本価格に含める：　はい<br />　　　・テキスト入力を必須にする：　はい<br /><br />','',7);
INSERT INTO `products_description` VALUES (144,1,'ATTR_DROPDOWN1','','',0);
INSERT INTO `products_description` VALUES (144,2,'【1】サイズ、カラー選択','商品オプションのタイプ＝DROPDOWN（リストから選択）およびRADIO（ラジオボタン）の活用サンプルです。<br /><br />Tシャツの販売でよく使われる例として、サイズやカラー選択を例にしました。<br />DROPDOWNやRADIOでは、複数ある選択肢の中から1つだけ選択可能です。<br /><br />選択肢によって追加料金を設定することも可能です。<br />ここではXLサイズ（DROPDOWN）とブラック（RADIO）のみ＋500円と設定しました。<br /><br />【設定メモ】<br />■オプション名：　サイズ<br />　・オプションのタイプ：　DROPDOWN<br />　・オプション値：　S、M、L、XL（＋500円）、「ご選択ください・・・」<br />------------------------------<br />■オプション名：　カラー<br />　・オプションのタイプ：　RADIO<br />　・オプション値：　ホワイト、　イエロー、ブルー、ブラック（＋500円）<br /><br />NOTE：<br /> 「ご選択ください・・・」オプション値の属性フラグ設定は、<br />　「表示のみ」＝\"はい\"に、かつ「属性によって価格がつけられるとき基本価格に含める」＝\"いいえ\"に設定されている。 <br />　これにより、「ご選択ください・・・」を選択した状態でカゴに入れることはできないため、ユーザは必ず他のいずれか（SサイズとかMサイズ）を選ぶことになる。<br /><br />\r\n\r\nNOTE：\r\nカラー選択のラジオボタンに、カラーチップ（色見本）が添えられていますが、これは、商品オプション属性＞属性の見本画像 で画像を登録すると表示されます。<br /><br />\r\nなお、ラジオボタン、オプション名、見本画像の配置は、「オプション名の管理」にて、<br />\r\n・列(Row)あたりの属性画像<br />\r\n・ラジオボタン・チェックボックスの属性スタイル<br />\r\nで変更することができます。','',28);
INSERT INTO `products_description` VALUES (152,1,'ATTR_DROPDOWN2','','',0);
INSERT INTO `products_description` VALUES (152,2,'【2】サイズ、カラー選択（セール10％オフ適用）','商品オプションのタイプ＝DROPDOWN（リストから選択）およびRADIO（ラジオボタン）の活用サンプルです。<br /><br />前の例（【1】サイズ、カラー選択）とオプション設定内容は全く同じですが、<br />\r\nこの商品はセール10％引きの対象になっている点が異なります。<br /><br />\r\n\r\n選択肢によって追加料金を設定することも可能で、<br />\r\nその場合、セールが追加料金に適用されるかどうかはオプション属性の設定次第です。<br />\r\n\r\n例えばXLサイズは追加料金＋500円のところ、<br />\r\n「オプション属性にも割引を適用する＝はい」に設定しているので<br />\r\nこの追加料金に対しても10％引きが適用されることになり、<br />\r\nXLサイズ選択時の実際の追加料金は＋450円です。<br /><br />\r\n\r\nこれに対してブラック（カラー）はXLサイズと同じ追加料金＋500円ですが、<br />\r\n「オプション属性にも割引を適用する＝いいえ」に設定しているので<br />\r\n10％引きが適用されず、実際の追加料金も＋500円のままかかります。<br /><br />\r\n\r\n【設定メモ】<br />■オプション名：　サイズ<br />　・オプションのタイプ：　DROPDOWN<br />　・オプション値：　S、M、L、XL（＋500円）、「ご選択ください・・・」<br />　・オプション属性にも割引を適用する：　はい<br />------------------------------<br />■オプション名：　カラー<br />　・オプションのタイプ：　RADIO<br />　・オプション値：　ホワイト、　イエロー、ブルー、ブラック（＋500円）<br />　・オプション属性にも割引を適用する：　いいえ<br /><br />NOTE：<br /> 「ご選択ください・・・」オプション値の属性フラグ設定は、<br />　「表示のみ」＝\"はい\"に、かつ「属性によって価格がつけられるとき基本価格に含める」＝\"いいえ\"に設定されている。 <br />　これにより、「ご選択ください・・・」を選択した状態でカゴに入れることはできないため、ユーザは必ず他のいずれか（SサイズとかMサイズ）を選ぶことになる。<br /><br />\r\n\r\nNOTE：\r\nカラー選択のラジオボタンに、カラーチップ（色見本）が添えられていますが、これは、商品オプション属性＞属性の見本画像 で画像を登録すると表示されます。<br /><br />\r\nなお、ラジオボタン、オプション名、見本画像の配置は、「オプション名の管理」にて、<br />\r\n・列(Row)あたりの属性画像<br />\r\n・ラジオボタン・チェックボックスの属性スタイル<br />\r\nで変更することができます。','',44);
INSERT INTO `products_description` VALUES (146,1,'ATTR_DROPDOWN3','','',0);
INSERT INTO `products_description` VALUES (146,2,'【3D】リボンの量り売り（DROPDOWN）','商品オプションのタイプ＝DROPDOWN（リストから選択）の活用サンプルです。<br /><br />この例はリボンの量り売りという想定です。<br />ユーザは1メートルあるいは1センチメートル単位で購入できるものとし、<br />購入単位はDROPDOWNタイプの商品オプションを使って選択可能にしています。<br /><br />メートル選択時は、1（m）あたり ＠500円で、商品重量は100g（＝0．1Kg）、<br />センチ選択時は、1（cm）あたり  ＠5円で、商品重量は1g（＝0．001Kg）のように、<br />購入単位の選択に応じて、単位長さあたりの値段と商品重量が決まるところがミソです。<br /><br />また、最小購買数を設定しており、購入は10cm（mの場合は10m）以上からとなります。<br /><br />【設定メモ】<br />■商品情報<br />　・商品属性による価格：　はい<br />　・商品価格 (ネット)：　0<br />　・商品の最小数量：　10<br />　・商品の数量単位：　　1<br />　・商品重量：　0<br /><br />■オプション属性の設定<br />・オプション名：　単位長さ<br />・オプション属性： <br />　・特価商品/セールによって割引を適用する：　はい<br />　・属性によって価格がつけられるとき基本価格に含める：　はい<br /><br />　・価格と重量<br />　　オプション値　　　　　　オプション価格　　　オプション重量<br />　　--------------------------------------------------------------<br />　　（1）メートル　　　　　 　　　500円　　　　　0．1（Kg）<br />　　（2）センチメートル　　 　　5円　　　　　　 0．001（Kg）<br /><br />NOTE：<br />同じカテゴリに、これと商品オプション内容をRADIO（ラジオボタン）タイプで設定した例を掲載しています（→【3R】リボンの量り売り（単位選択））。見た目の違いなどご確認ください。','',12);
INSERT INTO `products_description` VALUES (157,2,'【2】商品オプション料金にもセール適用する例','セール機能を理解するための、ごくシンプルな例です。<br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />この商品には商品オプション（カラー3種類）がついています。<br />このうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />この例では、セールが適用された時に、オプション料金にもセールが適用されるように設定しています。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％OFF<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・セール対象のカテゴリ：　「セール10％OFF」カテゴリ<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール10％OFF」カテゴリ<br />・商品価格：　10000円<br /><br />【設定メモ：商品オプション属性】　※この商品に関する設定<br />・オプション名：　カラー<br />・オプション値：　レッド<br />・オプション価格：　＋2000円<br />・特価商品/セールによって割引を適用する： はい','',5);
INSERT INTO `products_description` VALUES (158,2,'【3】商品オプション料金はセール対象外にする例','セール機能を理解するための、ごくシンプルな例です。<br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />この商品には商品オプション（カラー3種類）がついています。<br />このうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />一つ前の例（【2】商品オプションの追加料金にもセールが適用される例）と異なり、この例ではセールが適用された時に、オプション料金にはセールが適用されない設定にしています。つまり、セール中も、通常通りのオプション料金がかかります。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％OFF<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・セール対象のカテゴリ：　「セール10％OFF」カテゴリ<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール10％OFF」カテゴリ<br />・商品価格：　10000円<br /><br /><br />【設定メモ：商品オプション属性】　※この商品に関する設定<br />・オプション名：　カラー<br />・オプション値：　レッド<br />・オプション価格：　＋2000円<br />・特価商品/セールによって割引を適用する： いいえ','',1);
INSERT INTO `products_description` VALUES (143,1,'ATTR_CHKBOX2','','',0);
INSERT INTO `products_description` VALUES (143,2,'【2】ファミリー向けセット販売','商品オプションのタイプ＝CHECKBOX（チェックボックス）の活用サンプルです。<br /><br />チェックボックスタイプにすると、1商品あたり複数のオプションを同時選択できます。<br />この例では、ファミリーでお揃いのTシャツを購入するようなケースを想定して、<br />パパ用にLサイズ、ママはSサイズ、お兄ちゃんには身長150cmサイズで妹のA子ちゃんに身長120cmサイズ・・・のようにサイズを選び、<br />セット購入できるよう設定しました。<br /><br /><br />NOTE：<br />選んだサイズごとに価格と商品重量が異なりそれらはオプション料金、オプション重量として設定しています。<br />これらは「特価商品/セールによって割引を適用する＝はい」の設定なので、<br />もしこの商品に特価設定等を行えばオプション料金の額も変化します。<br /><br />【設定メモ】<br />■オプション名：　サイズ<br />　・オプションのタイプ：　CHECKBOX<br />■オプション値：　S, M, L, 110, 120, 130, 140, 150<br />■オプション属性<br />　オプション値　　　　　　オプション価格　　　特価商品/セールによって割引を適用する<br />　--------------------------------------------------------------<br />　Sサイズ　　　　　　　　　　　 +4000円　　　　はい<br />　Mサイズ 　　　　　　　　　　　+4000円　　　　はい<br />　Lサイズ： 　　　　　　　　　　+4500円　　　　はい<br />　140、150cm：　　　　　　　 +3500円　　　　はい<br />　110、120、130cm：　　　　+3000円　　　　はい','',11);
INSERT INTO `products_description` VALUES (151,1,'ATTR_RADIO3','','',0);
INSERT INTO `products_description` VALUES (151,2,'【3R】リボンの量り売り（RADIO）','商品オプションのタイプ＝RADIO（ラジオボタン））の活用サンプルです。<br /><br />この例はリボンの量り売りという想定です。<br />ユーザは1メートルあるいは1センチメートル単位で購入できるものとし、<br />購入単位はDROPDOWNタイプの商品オプションを使って選択可能にしています。<br /><br />メートル選択時は、1（m）あたり ＠500円で、商品重量は100g（＝0．1Kg）、<br />センチ選択時は、1（cm）あたり  ＠5円で、商品重量は1g（＝0．001Kg）のように、<br />購入単位の選択に応じて、単位長さあたりの値段と商品重量が決まるところがミソです。<br /><br />また、最小購買数を設定しており、購入は10cm（mの場合は10m）以上からとなります。<br /><br />【設定メモ】<br />■商品情報<br />　・商品属性による価格：　はい<br />　・商品価格 (ネット)：　0<br />　・商品の最小数量：　10<br />　・商品の数量単位：　　1<br />　・商品重量：　0<br /><br />■オプション属性の設定<br />・オプション名：　単位長さ<br />・オプション属性： <br />　・特価商品/セールによって割引を適用する：　はい<br />　・属性によって価格がつけられるとき基本価格に含める：　はい<br /><br />　・価格と重量<br />　　オプション値　　　　　　オプション価格　　　オプション重量<br />　　--------------------------------------------------------------<br />　　（1）メートル　　　　　 　　　500円　　　　　0．1（Kg）<br />　　（2）センチメートル　　 　　5円　　　　　　 0．001（Kg）<br /><br /><br />NOTE：<br />同じカテゴリに、これと商品オプション内容をDROPDOWN（リスト選択）タイプで設定した例を掲載しています（→【3D】リボンの量り売り（単位選択））。見た目の違いなどご確認ください。','',4);
INSERT INTO `products_description` VALUES (227,2,'【1】ロゴデータ・ファイルを添付して注文','商品オプションのタイプ＝FILEの活用サンプルです。<br /><br />\r\n\r\nFILEタイプにすると、アップロードファイルの指定欄が表示され、ユーザはファイルを添付して注文することができます。<br />\r\n\r\nこの例で扱うＴシャツは、会社やクラブのロゴをオリジナルプリントできる商品で、ロゴのデータファイルはユーザがあらかじめイラストレータなどで作成したものをアップロードして運営者に渡します。なお、オプション料金として1000円かかります。<br /><br /><br />\r\n\r\n\r\n【オプション名の設定】<br />\r\n・[オプション名]：　\"ロゴ・データ添付\"<br />\r\n・[オプションのタイプ]：　FILE<br /><br />\r\n※FILEタイプの場合は、オプション値登録は不要です。<br /><br />\r\n\r\n【設定メモ：商品情報】<br />\r\n・[商品価格]：4000円<br />\r\n・[商品属性による価格]：はい<br /><br />\r\n\r\n【設定メモ：オプション属性】\"ロゴ・データ添付\"オプション<br />\r\n・オプション価格：+1000 円<br />','',5);
INSERT INTO `products_description` VALUES (227,1,'ATTR_FILE','','',0);
INSERT INTO `products_description` VALUES (159,2,'【1】セール適用の基本例','セール機能を理解するための、ごくシンプルな例です。<br />このカテゴリに対して、500円引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />この商品には商品オプション（カラー3種類）がついていますが、<br />オプションには追加料金を設定していないのでもともとどのカラーでも同料金です。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　500円OFF<br />・値引き額：　500（円）<br />・タイプ：　値引き額<br />・セール対象のカテゴリ：　「セール：500円OFF」カテゴリ<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール：500円OFF」カテゴリ<br />・商品価格：　10000円<br />','',2);
INSERT INTO `products_description` VALUES (160,2,'【2】商品オプション料金にもセール適用する例','セール機能を理解するための、ごくシンプルな例です。<br />\r\nこのカテゴリに対して、10％引きのセール設定がされており、このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />\r\n\r\nこの商品には商品オプション（カラー3種類）がついています。<br />\r\nこのうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />\r\nこの例では、セールが適用された時に、オプション料金にもセールが適用されるように設定しています。<br /><br />\r\n\r\n【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />\r\n・セール名：　500円OFF<br />\r\n・値引き額：　500（円）<br />\r\n・タイプ：　値引き額<br />\r\n・セール対象のカテゴリ：　「セール：500円OFF」カテゴリ<br /><br /><br />\r\n\r\n\r\n【設定メモ：商品情報】　※この商品に関する設定<br />\r\n・商品マスターカテゴリ：　「セール：500円OFF」カテゴリ<br />\r\n・商品価格：　10000円<br /><br /><br />\r\n\r\n\r\n【設定メモ：商品オプション属性】　※この商品に関する設定<br />\r\n・オプション名：　カラー<br />\r\n・オプション値：　レッド<br />\r\n・オプション価格：　＋2000円<br />\r\n・特価商品/セールによって割引を適用する： はい<br /><br /><br />\r\n\r\n\r\n<strong>NOTE：</strong>\r\n※実際の運用においては、固定額の値引きセールをオプション料金にも適用する場合は注意が必要です。<br />\r\nこのケースでは、たまたまオプション料金（2000円）がセールの値引き額（-500円）よりも大きいために正常に500円引きが反映されていますが、特に、オプション料金よりもセールの値引き額の方が大きい場合は正しく機能しません。固定額を値引く意味をよく考えて適用を決めてください。<br /><br />','',5);
INSERT INTO `products_description` VALUES (161,2,'【3】商品オプション料金はセール対象外にする例','セール機能を理解するための、ごくシンプルな例です。<br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />この商品には商品オプション（カラー3種類）がついています。<br />このうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />一つ前の例と異なり、この例では商品へのセール適用時に、オプション料金には適用されない設定にしています。つまり、商品自体がセール価格でもオプション料金に関しては通常通りかかります。<br /><br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　セール500円OFF<br />・値引き額：　500（円）<br />・タイプ：　値引き額<br />・セール対象のカテゴリ：　「セール：500円OFF」カテゴリ<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール：500円OFF」カテゴリ<br />・商品価格：　10000円<br /><br /><br />【設定メモ：商品オプション属性】　※この商品に関する設定<br />・オプション名：　カラー<br />・オプション値：　レッド<br />・オプション価格：　＋2000円<br />・特価商品/セールによって割引を適用する： いいえ','',1);
INSERT INTO `products_description` VALUES (162,2,'【1】セール適用の基本例','セール機能を理解するための、ごくシンプルな例です。<br />このカテゴリに対して、8000円（新しい価格）にするセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />この商品には商品オプション（カラー3種類）がついていますが、<br />オプションには追加料金を設定していないのでもともとどのカラーでも同料金です。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　新価格8000円<br />・値引き額：　8000（円）<br />・タイプ：　新しい価格<br />・セール対象のカテゴリ：　「セール：1万円を8000円に」カテゴリ<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール：1万円を8000円に」カテゴリ<br />・商品価格：　10000円<br />','',4);
INSERT INTO `products_description` VALUES (163,2,'【2】商品オプション料金にもセール適用する例','セール機能を理解するための、ごくシンプルな例です。<br />\r\nこのカテゴリに対して、8000円（新しい価格）にするセール設定がされており、このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />\r\n\r\nこの商品には商品オプション（カラー3種類）がついています。<br />\r\nこのうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />\r\nこの例では、セールが適用された時に、オプション料金にもセールが適用されるように設定しています。<br /><br />\r\n\r\n\r\n【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　新価格8000円<br />\r\n・値引き額：　8000（円）<br />\r\n・タイプ：　新しい価格<br />\r\n・セール対象のカテゴリ：　「セール：1万円を8000円に」カテゴリ<br /><br /><br />\r\n\r\n\r\n【設定メモ：商品情報】　※この商品に関する設定<br />\r\n・商品マスターカテゴリ：　「セール：1万円を8000円に」カテゴリ<br />\r\n・商品価格：　10000円<br /><br /><br />\r\n\r\n\r\n【設定メモ：商品オプション属性】　※この商品に関する設定<br />\r\n・オプション名：　カラー<br />\r\n・オプション値：　レッド<br />\r\n・オプション価格：　＋2000円<br />\r\n・特価商品/セールによって割引を適用する： はい<br /><br /><br />\r\n\r\n\r\n<strong>NOTE：</strong><br />\r\n実際にはレッドに対するオプション料金は割引きされません（そもそも2000円のオプション料金に新価格8000円セールを適用したら割り増し価格になってしまいます！）。<br />\r\nこのように、”新しい価格”で元値を置き換えるセール設定をオプションへも適用すること自体無意味な場合が多いため、オプションへの適用は無視される仕様になっています。<br /><br />','',6);
INSERT INTO `products_description` VALUES (164,2,'【3】商品オプション料金はセール対象外にする例','セール機能を理解するための、ごくシンプルな例です。<br />このカテゴリに対して、8000円（新しい価格）にするセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />この商品には商品オプション（カラー3種類）がついています。<br />このうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />一つ前の例と異なり、この例では商品へのセール適用時に、オプション料金には適用されない設定にしています。つまり、商品自体がセール価格でもオプション料金に関しては通常通りかかります。<br /><br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　新価格8000円<br />・値引き額：　8000（円）<br />・タイプ：　新しい価格<br />・セール対象のカテゴリ：　「セール：1万円を8000円に」カテゴリ<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール：1万円を8000円に」カテゴリ<br />・商品価格：　10000円<br /><br /><br />【設定メモ：商品オプション属性】　※この商品に関する設定<br />・オプション名：　カラー<br />・オプション値：　レッド<br />・オプション価格：　＋2000円<br />・特価商品/セールによって割引を適用する： いいえ<br />','',3);
INSERT INTO `products_description` VALUES (165,2,'【SP1-1】特価商品の基本例（1万円を8000円に）','特価機能を理解するための、ごくシンプルな例です。<br /><br />この商品には通常価格10000円のところを特価8000円（新価格）にする特価設定がされています。<br />特価は新価格、あるいは割引率で指定可能ですが、これは新価格で設定した例です。<br /><br />この商品には商品オプション（カラー3種類）がついていますが、<br />オプションには追加料金を設定していないのでもともとどのカラーでも同料金です。<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品価格：　10000円<br />・特価価格：　8000円','',1);
INSERT INTO `products_description` VALUES (166,2,'【SP2-1】特価商品の基本例（50%引）','特価機能を理解するための、ごくシンプルな例です。<br /><br />この商品には通常価格10000円のところを特価8000円（新価格）にする特価設定がされています。<br />特価は新価格、あるいは割引率で指定可能ですが、これは割引率で設定した例です。<br /><br />この商品には商品オプション（カラー3種類）がついていますが、<br />オプションには追加料金を設定していないのでもともとどのカラーでも同料金です。<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品価格：　10000円<br />・特価価格：　50%','',1);
INSERT INTO `products_description` VALUES (167,2,'【SP2-2】商品オプション料金にも特価適用（50％引）','特価機能を理解するための、ごくシンプルな例です。<br /><br />この商品には通常価格10000円のところを50％引きの特価設定がされています。<br />特価は新価格、あるいは割引率で指定可能ですが、これは割引率で設定した例です。<br /><br /><br />この商品には商品オプション（カラー3種類）がついています。<br />このうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />この例では、商品への特価適用時に、オプション料金にも特価が適用されるように設定しています。<br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品価格：　10000円<br />・特価価格：　50%<br /><br />【設定メモ：商品オプション属性】　※この商品に関する設定<br />・オプション名：　カラー<br />・オプション値：　レッド<br />・オプション価格：　＋2000円<br />・特価商品/セールによって割引を適用する： はい','',4);
INSERT INTO `products_description` VALUES (168,2,'【SP2-2】商品オプション料金は特価対象外（50％引）','特価機能を理解するための、ごくシンプルな例です。<br /><br />この商品には通常価格10000円のところを50％引きの特価設定がされています。<br />特価は新価格、あるいは割引率で指定可能ですが、これは割引率で設定した例です。<br /><br /><br />この商品には商品オプション（カラー3種類）がついています。<br />このうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />一つ前の例と異なり、この例では商品への特価適用時に、オプション料金には適用されない設定にしています。つまり、商品自体が特価でもオプション料金に関しては通常通りかかります。<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品価格：　10000円<br />・特価価格：　50%<br /><br />【設定メモ：商品オプション属性】　※この商品に関する設定<br />・オプション名：　カラー<br />・オプション値：　レッド<br />・オプション価格：　＋2000円<br />・特価商品/セールによって割引を適用する： いいえ','',0);
INSERT INTO `products_description` VALUES (169,2,'【SP3】期間限定で特価価格','特価機能を理解するための、ごくシンプルな例です。<br /><br />この商品は通常価格10000円のところを特価で半額にし、<br />さらに特価実施期間を設けました（半年間だけ値引きされます）<br /><br />この商品には商品オプション（カラー3種類）がついていますが、<br />オプションには追加料金を設定していないのでもともとどのカラーでも同料金です。<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品価格：　10000円<br />・特価価格：　50%<br />・提供開始日0終了日：　2007/1/15 0 2007/6/15','',0);
INSERT INTO `products_description` VALUES (170,2,'セール期間と適用価格帯（適用されるケース）','セールの設定では、セール実施期間を限定したり、セール対象を商品価格帯で絞ったりする機能があります。<br />例えば「8月限定バーゲンセール」や「クリスマスセール」を実施したい場合などに活用できるでしょう。<br />さらに価格帯機能を使えば、5000円010000円の商品だけを値引きするといったことが可能です。<br /><br />このカテゴリは、10％引きのセール設定がされていますが、<br />特定の実施期間を設けています。また、8000円以上の商品にだけセールを適用するよう設定してあります。<br /><br />この商品の価格は1万円なので、セールが適用されます。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％セール期間と価格帯限定<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・価格幅：　10000円 から [入力しない]円<br />・セール対象のカテゴリ：　「セール関連etc」カテゴリ<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール関連etc」カテゴリ<br />・商品価格：　10000円','',2);
INSERT INTO `products_description` VALUES (171,2,'セール期間と適用価格帯（適用されないケース）','セールの設定では、セール実施期間を限定したり、セール対象を商品価格帯で絞ったりする機能があります。<br />例えば「8月限定バーゲンセール」や「クリスマスセール」を実施したい場合などに活用できるでしょう。<br />さらに価格帯機能を使えば、5000円010000円の商品だけを値引きするといったことが可能です。<br /><br />このカテゴリは、10％引きのセール設定がされていますが、<br />特定の実施期間を設けています。また、8000円以上の商品にだけセールを適用するよう設定してあります。<br /><br />この商品の価格は7500円ですので、セールの適用対象外となります。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％セール期間と価格帯限定<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・価格幅：　10000円 から [入力しない]円<br />・セール対象のカテゴリ：　「セール関連etc」カテゴリ<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール関連etc」カテゴリ<br />・商品価格：　7500円','',2);
INSERT INTO `products_description` VALUES (172,2,'【4】この商品にはセールが適用されません','この商品はセールが適用されません。なぜでしょうか？<br />理由は、この商品はリンク商品で、「商品マスターカテゴリ」がセール対象外のカテゴリだからです。<br /><br /><strong>NOTE：</strong><br />複数のカテゴリにリンクされた商品の場合、商品マスターカテゴリのセール設定が適用されます。<br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「このカテゴリにはセール設定していない」カテゴリ<br />・商品価格：　10000円','',2);
INSERT INTO `products_description` VALUES (173,2,'【SP1】特価商品にセール適用の基本例','特価商品にセールを適用した場合のふるまいを理解するための、ごくシンプルな例です。<br /><br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />また、セールとは別に<br />この商品には通常価格10000円のところを半額にする特価設定がされています。<br /><br />特価商品に対するセールの設定を「特価商品の価格にさらにセール値引きを適用する」にしたので<br />特価価格からさらに10％のセール値引きが適用されます。<br /><br /><br />この商品には商品オプション（カラー3種類）がついていますが、<br />オプションには追加料金を設定していないのでもともとどのカラーでも同料金です。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％OFF（特価＋セール）<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・特価商品の場合：　特価商品の価格にさらにセール値引きを適用する<br />・セール対象のカテゴリ：　「セール×特価：特価商品をさらに10％OFF」カテゴリ<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール×特価：特価商品をさらに10％OFF」カテゴリ<br />・商品価格：　10000円<br />・特価価格：　50%<br />','',2);
INSERT INTO `products_description` VALUES (174,2,'【SP2】商品オプション料金にもセール・特価適用する例','特価商品にセールを適用した場合のふるまいを理解するための、ごくシンプルな例です。<br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />また、セールとは別に<br />この商品には通常価格10000円のところを半額にする特価設定がされています。<br /><br /><br />特価商品に対するセールの設定を「特価商品の価格にさらにセール値引きを適用する」にしたので<br />特価価格からさらに10％のセール値引きが適用されます。<br /><br /><br />この商品には商品オプション（カラー3種類）がついています。<br />このうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />この例では、セール・特価が適用された時に、オプション料金にもセール・特価が適用されるように設定しています。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％OFF（特価＋セール）<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・特価商品の場合：　特価商品の価格にさらにセール値引きを適用する<br />・セール対象のカテゴリ：　「セール×特価：特価商品をさらに10％OFF」カテゴリ<br /><br />【設定メモ：商品情報】　※この商品に関する設定<br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール×特価：特価商品をさらに10％OFF」カテゴリ<br />・商品価格：　10000円<br />・特価価格：　50%<br /><br />【設定メモ：商品オプション属性】　※この商品に関する設定<br />・オプション名：　カラー<br />・オプション値：　レッド<br />・オプション価格：　＋2000円<br />・特価商品/セールによって割引を適用する： はい<br /><br />','',3);
INSERT INTO `products_description` VALUES (175,2,'【SP3】商品オプション料金はセール・特価対象外にする例','特価商品にセールを適用した場合のふるまいを理解するための、ごくシンプルな例です。<br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />また、セールとは別に<br />この商品には通常価格10000円のところを半額にする特価設定がされています。<br /><br /><br />特価商品に対するセールの設定を「特価商品の価格にさらにセール値引きを適用する」にしたので<br />特価価格からさらに10％のセール値引きが適用されます。<br /><br /><br />この商品には商品オプション（カラー3種類）がついています。<br />このうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />一つ前の例と異なり、この例では商品への特価適用時に、オプション料金には適用されない設定にしています。つまり、商品自体が特価でもオプション料金に関しては通常通りかかります。<br /><br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％OFF（特価＋セール）<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・特価商品の場合：　特価商品の価格にさらにセール値引きを適用する<br />・セール対象のカテゴリ：　「セール×特価：特価商品をさらに10％OFF」カテゴリ<br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール×特価：特価商品をさらに10％OFF」カテゴリ<br />・商品価格：　10000円<br />・特価価格：　50%<br /><br />【設定メモ：商品オプション属性】　※この商品に関する設定<br />・オプション名：　カラー<br />・オプション値：　レッド<br />・オプション価格：　＋2000円<br />・特価商品/セールによって割引を適用する： いいえ<br />','',3);
INSERT INTO `products_description` VALUES (176,2,'【SP1】特価商品にセール適用の基本例','特価商品にセールを適用した場合のふるまいを理解するための、ごくシンプルな例です。<br /><br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />また、セールとは別に<br />この商品には通常価格を半額にする特価設定がされていますが、<br />特価商品に対するセールの設定を「特価商品の価格を無視する」にしたので<br />通常価格に10％のセール値引きが適用され、特価価格は無視されます。<br /><br />この商品には商品オプション（カラー3種類）がついていますが、<br />オプションには追加料金を設定していないのでもともとどのカラーでも同料金です。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％OFF（セール優先）<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・特価商品の場合：　特価商品の価格を無視する<br />・セール対象のカテゴリ：　「セール×特価：セール優先（特価設定無視）」カテゴリ<br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール×特価：セール優先（特価設定無視）」カテゴリ<br />・商品価格：　10000円<br />・特価価格：　50%','',4);
INSERT INTO `products_description` VALUES (177,2,'【SP2】商品オプション料金にもセール・特価適用する例','特価商品にセールを適用した場合のふるまいを理解するための、ごくシンプルな例です。<br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />また、セールとは別に<br />この商品には通常価格10000円のところを半額にする特価設定がされていますが、<br />特価商品に対するセールの設定を「特価商品の価格を無視する」にしたので<br />通常価格に10％のセール値引きが適用され、特価価格は無視されます。<br /><br /><br />この商品には商品オプション（カラー3種類）がついています。<br />このうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />この例では、セール・特価が適用された時に、オプション料金にもセール・特価が適用されるように設定しています。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％OFF（セール優先）<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・特価商品の場合：　特価商品の価格を無視する<br />・セール対象のカテゴリ：　「セール×特価：セール優先（特価設定無視）」カテゴリ<br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール×特価：セール優先（特価設定無視）」カテゴリ<br />・商品価格：　10000円<br />・特価価格：　50%<br /><br />【設定メモ：商品オプション属性】　※この商品に関する設定<br />・オプション名：　カラー<br />・オプション値：　レッド<br />・オプション価格：　＋2000円<br />・特価商品/セールによって割引を適用する： はい<br /><br />','',5);
INSERT INTO `products_description` VALUES (178,2,'【SP3】商品オプション料金はセール・特価対象外にする例','特価商品にセールを適用した場合のふるまいを理解するための、ごくシンプルな例です。<br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />また、セールとは別に<br />この商品には通常価格10000円のところを半額にする特価設定がされていますが、<br />特価商品に対するセールの設定を「特価商品の価格を無視する」にしたので<br />通常価格に10％のセール値引きが適用され、特価価格は無視されます。<br /><br /><br />この商品には商品オプション（カラー3種類）がついています。<br />このうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />一つ前の例と異なり、この例では商品へのセール・特価適用時に、オプション料金には適用されない設定にしています。つまり、商品自体がセール価格でもオプション料金に関しては通常通りかかります。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％OFF（セール優先）<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・特価商品の場合：　特価商品の価格を無視する<br />・セール対象のカテゴリ：　「セール×特価：セール優先（特価設定無視）」カテゴリ<br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール×特価：セール優先（特価設定無視）」カテゴリ<br />・商品価格：　10000円<br />・特価価格：　50%<br /><br />【設定メモ：商品オプション属性】　※この商品に関する設定<br />・オプション名：　カラー<br />・オプション値：　レッド<br />・オプション価格：　＋2000円<br />・特価商品/セールによって割引を適用する： いいえ','',7);
INSERT INTO `products_description` VALUES (179,2,'【SP1】特価商品にセール適用の基本例','特価商品にセールを適用した場合のふるまいを理解するための、ごくシンプルな例です。<br /><br />この商品には通常価格10000円のところを半額にする特価設定がされています。<br /><br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />しかし、特価商品に対するセールの設定を「セール対象外」にしたので<br />特価商品にはセール10％引きは適用されません。<br /><br />この商品には商品オプション（カラー3種類）がついていますが、<br />オプションには追加料金を設定していないのでもともとどのカラーでも同料金です。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％OFF（特価優先）<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・特価商品の場合：　セール対象外<br />・セール対象のカテゴリ：　「セール×特価：特価優先（セール対象外）」カテゴリ<br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール×特価：セール優先（セール対象外）」カテゴリ<br />・商品価格：　10000円<br />・特価価格：　50%','',2);
INSERT INTO `products_description` VALUES (180,2,'【SP2】商品オプション料金にもセール・特価適用する例','特価商品にセールを適用した場合のふるまいを理解するための、ごくシンプルな例です。<br /><br />この商品には通常価格10000円のところを半額にする特価設定がされています。<br /><br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />しかし、特価商品に対するセールの設定を「セール対象外」にしたので<br />特価商品にはセール10％引きは適用されません。<br /><br /><br />この商品には商品オプション（カラー3種類）がついています。<br />このうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />この例では、セール・特価が適用された時に、オプション料金にもセール・特価が適用されるように設定しています。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％OFF（特価優先）<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・特価商品の場合：　セール対象外<br />・セール対象のカテゴリ：　「セール×特価：特価優先（セール対象外）」カテゴリ<br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール×特価：特価優先（セール対象外）」カテゴリ<br />・商品価格：　10000円<br />・特価価格：　50%<br /><br />【設定メモ：商品オプション属性】　※この商品に関する設定<br />・オプション名：　カラー<br />・オプション値：　レッド<br />・オプション価格：　＋2000円<br />・特価商品/セールによって割引を適用する： はい<br />','',3);
INSERT INTO `products_description` VALUES (181,2,'【SP3】商品オプション料金はセール・特価対象外にする例','特価商品にセールを適用した場合のふるまいを理解するための、ごくシンプルな例です。<br /><br />この商品には通常価格10000円のところを半額にする特価設定がされています。<br /><br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />しかし、特価商品に対するセールの設定を「セール対象外」にしたので<br />特価商品にはセール10％引きは適用されません。<br /><br />この商品には商品オプション（カラー3種類）がついています。<br />このうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />一つ前の例と異なり、この例では商品への特価適用時に、オプション料金には適用されない設定にしています。つまり、商品自体が特価でもオプション料金に関しては通常通りかかります。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％OFF（特価優先）<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・特価商品の場合：　セール対象外<br />・セール対象のカテゴリ：　「セール×特価：特価優先（セール対象外）」カテゴリ<br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール×特価：特価優先（セール対象外）」カテゴリ<br />・商品価格：　10000円<br />・特価価格：　50%<br /><br />【設定メモ：商品オプション属性】　※この商品に関する設定<br />・オプション名：　カラー<br />・オプション値：　レッド<br />・オプション価格：　＋2000円<br />・特価商品/セールによって割引を適用する： いいえ<br />','',3);
INSERT INTO `products_description` VALUES (182,1,'Normal Product(6)','','',0);
INSERT INTO `products_description` VALUES (182,2,'【例6】1色あたり○点以上なら割引','サイズやカラーなどのオプション属性を持つ商品に、数量割引（いわゆるボリュームディスカウント）を適用したやや複雑な設定例です。<br />\r\n9個までは定価、10020個で定価の10％引き、20049個で20％引き、50個以上で25％引きというように、割引率による数量割引を設定しました。<br /><br />\r\nこの例では、1つのオプションに対して規定量以上購入した場合に割り引きが適用されます。<br />\r\nつまり、ホワイトとブラックを5コずつ購入しても割り引き対象にはならず、ホワイトあるいはブラック単体で10個以上購入してはじめて割引になります。<br />\r\nこれは、商品価格の管理において、「数量は同一商品であればオプション値に関係なく合算する＝いいえ」に設定しているからです。<br /><br />\r\n\r\n\r\nNOTE：　この設定は「商品価格の管理」から行います。<br />※商品の管理＞商品価格の管理　から呼び出すか、あるいは管理画面の商品リストの右端にある[＄]ボタン（緑色のボタン）から呼び出すことができます。<br /><br />\r\n\r\n【設定メモ：商品価格の管理】<br />\r\n以下の設定により、計算式は、購入代金＝｛定価×（1\"数量割引率）｝　×　購入数となります。<br />\r\n・ディスカウントタイプ：　割引率<br />\r\n・この価格からディスカウント：　価格<br />\r\n・割引設定<br /><br />\r\n　　・数量は同一商品であればオプション値に関係なく合算する：　いいえ<br />\r\n　------------------------------------------<br />\r\n　割引レベル　　　　最小限の有効数量　　　割引の値<br />\r\n　------------------------------------------<br />\r\n　割引3　　　　　　　　10　（個）　　　　　　　　　10.0　（％）<br />\r\n　割引4　　　　　　　　20　（個）　　　　　　　　　20.0　（％）<br />\r\n　割引5　　　　　　　　50　（個）　　　　　　　　　25.0　（％）<br />\r\n　-----------------------------------------<br /><br />\r\n\r\n【設定メモ：オプション属性】<br />\r\n1）カラー「ホワイト」<br />\r\n　　・価格： ＋0円<br />\r\n　　・特価/セール割引を適用した価格をベース価格として扱う：　はい<br />\r\n2）カラー「ブラック」<br />\r\n　　・価格：　＋1000円<br />\r\n　　・特価/セール割引を適用した価格をベース価格として扱う：　はい<br />\r\n　　・属性による価格増減をベース価格に含める：　はい','',8);
INSERT INTO `products_description` VALUES (183,1,'MIN','','',0);
INSERT INTO `products_description` VALUES (183,2,'【1】10個以上でご注文ください','これは、「最低10個より販売いたします」など、最小購入数を制限したい場合の設定例です。<br /><br />\r\n\r\n【設定メモ：商品情報】<br />\r\n・最小購入数：　10<br />','',14);
INSERT INTO `products_description` VALUES (184,1,'MIN_ATR1','','',0);
INSERT INTO `products_description` VALUES (184,2,'【OP1】オプション問わず合計10個以上で販売','これは、商品オプションありの場合の最小購入数設定例です。<br />\r\nこの例では、オプションをいろいろ取り混ぜてよく、この商品の合計が最小購入数以上であれば（個々のオプション選択がなんであれ）購入可能です。<br />\r\nつまり、ホワイト5コカゴに入れ、続いてブルーを5コカゴに入れた時点で合計10コと見なされて購入可能となります。<br /><br />\r\n\r\n【設定メモ：商品情報】<br />\r\n・最小購入数：　10<br /><br />\r\n\r\n【設定メモ：商品価格の管理】<br />\r\n・最低量とユニット量を組み合わせて適応する：　はい','',7);
INSERT INTO `products_description` VALUES (185,1,'MIN_ATR2','','',0);
INSERT INTO `products_description` VALUES (185,2,'【OP2】1オプションあたり10個以上で販売','これは、商品オプションありの場合の最小購入数設定例です。<br />\r\nこの例では、1つのオプションあたりの購入数でカウントし、同じオプションで最小購入数に達しないと決済に進めません。<br />\r\nつまり、ホワイトとブルーを5コずつカゴに入れてもダメで、ホワイトあるいはブルー単体で10個以上ではじめて購入可能となります。<br /><br />\r\n\r\n【設定メモ：商品情報】<br />\r\n・最小購入数：　10<br /><br />\r\n\r\n【設定メモ：商品価格の管理】<br />\r\n・最低量とユニット量を組み合わせて適応する：　いいえ','',4);
INSERT INTO `products_description` VALUES (187,1,'LIMIT-1','','',0);
INSERT INTO `products_description` VALUES (187,2,'【1】お一人さま5点まで！','これは、「お一人さま5点まで！」など、注文1回あたりの購入数を制限したい場合の設定例です。<br /><br />\r\n\r\n【設定メモ】<br />\r\n・商品の最小数量：　1<br />\r\n・商品の最大数量：　5<br />\r\n・商品の数量単位：　1<br /><br />','',8);
INSERT INTO `products_description` VALUES (188,1,'LIMIT_ATR1','','',0);
INSERT INTO `products_description` VALUES (188,2,'【OP1】カラーを問わず全部で5点まで！','これは、商品オプションありの場合の最大購入数設定例です。<br />\r\nこの例では、オプションにかかわらず、この商品は全部で5点までしか購入できません。<br />\r\nつまり、ホワイトとイエローで計5コカゴに入っていたら、いったん精算しないかぎり追加はできません。<br /><br />\r\n\r\n【設定メモ：商品情報】<br />\r\n・最小購入数：　1<br />\r\n・最大購入数：　5<br />\r\n\r\n【設定メモ：商品価格の管理】<br />\r\n・最低量とユニット量を組み合わせて適応する：　はい','',17);
INSERT INTO `products_description` VALUES (201,2,'【1】100個単位でご注文ください','これは、「100個単位でご注文ください」のように、ユニット単位の販売を行いたい場合の設定例です。<br /><br />\r\n\r\n【設定メモ：商品情報】<br />\r\n・[最小購入数]：　100　※<br />\r\n・[数量単位]： 100<br /><br />\r\n\r\n※この例において[最小購入数]設定は必須ではないが、どのみち100個ずつ売りたいので一応設定しておく','',0);
INSERT INTO `products_description` VALUES (189,1,'LIMIT_ATR2','','',0);
INSERT INTO `products_description` VALUES (189,2,'【OP2】1オプションあたり5点まで！','これは、商品オプションありの場合の最大購入数設定例です。<br /><br />\r\nこの例では、各オプションは独立で扱われ、それぞれについて5点まで購入することができます。<br />\r\nつまり、ホワイト5コをカゴに入れたら、ホワイトはもう追加できませんが、他の色（ブルーやイエロー）なら購入可能です。<br /><br />\r\n\r\n【設定メモ：商品情報】<br />\r\n・最小購入数：　1<br />\r\n・最大購入数：　5<br />\r\n【設定メモ：商品価格の管理】<br />\r\n・最低量とユニット量を組み合わせて適応する：　いいえ','',12);
INSERT INTO `products_description` VALUES (202,1,'UNIT2','','',0);
INSERT INTO `products_description` VALUES (190,1,'TAXOUT','','',0);
INSERT INTO `products_description` VALUES (190,2,'商品価格を税抜き（外税）で管理する例','商品価格を外税（税抜き価格）で管理する例です。<br /><br />\r\n\r\n表示価格には、管理サイト側で入力した商品価格に消費税分を上乗せしたものが表示されます。オプション料金にも同じように適用します。<br /><br />\r\nなお消費税分は、あらかじめショップ全体の設定値として設定したものが使われます（デフォルトで5％になっています）。<br /><br />\r\n\r\n・メリット：\r\n　消費税分が自動で上乗せされるので、運営側では税抜き価格で管理できる。また、消費税率が変わった時に、ショップ全体の税率設定値を変更するだけで済む。<br /><br />\r\n・デメリット： 4,980円など商売上ウケの良い価格表示にしたい場合、制御しづらい<br /><br /><br />\r\n\r\n【設定メモ】商品情報：<br />\r\n・[税種別]：　消費税<br />\r\n・[商品価格（ネット）]：10000円　（消費税分を含めない）<br /><br />\r\n\r\n\r\n【設定メモ】商品オプション属性<br />\r\n・[オプション価格] レッド（＋0/追加料金なし）、ホワイト（＋1000円）、イエロー（＋2000円）<br /><br />\r\n\r\n【ショップ全体の設定】　地域・税率設定＞税率設定　<br />\r\n・[消費税の税率]：　5％<br />','',10);
INSERT INTO `products_description` VALUES (191,1,'TAXIN-2','','',1);
INSERT INTO `products_description` VALUES (191,2,'商品価格を税込み（内税）で管理する例(2)','こちらは、商品価格を内税（税込み価格）で管理する例です。<br />\r\n内税の場合、2つのやり方があります（前の例と比べてみてください）。<br />\r\nこのケースでは税種別を「消費税」にしています。商品価格（グロス）の方に内税価格を入力します。<br /><br />\r\n\r\n\r\n[税種別]を消費税に指定し、商品価格（グロス）に内税価格を入力すると、商品価格（ネット）には自動計算された税抜き価格が入ります。ショップ側に表示されるのは商品価格（グロス）の方なのでつまり内税価格が表示されるというわけです。オプション価格は設定値に消費税分が上乗せされて表示されるので注意してください。<br /><br />\r\n\r\n\r\n【設定メモ】内税で管理する：<br />\r\n・[税種別]：　-- 消費税 --<br />\r\n・[商品価格（グロス）]：10000円 （税込み価格を入力する）<br /><br />\r\n\r\n【設定メモ】商品オプション属性<br />\r\n・[オプション価格] レッド（＋0/追加料金なし）、ホワイト（＋1000円）、イエロー（＋2000円）','',8);
INSERT INTO `products_description` VALUES (192,1,'ATTR_IMAGE1','','',0);
INSERT INTO `products_description` VALUES (192,2,'【OP1】画像付きオプションの例','画像付き商品オプションの例です。ここでは、2色あるカラー（商品オプション属性）のそれぞれに、画像を添えて表示しています。<br /><br />\r\nこれは、商品オプション属性の見本画像に、画像ファイルを指定することで実現できます。<br />\r\n\r\n【設定メモ】商品オプション属性<br />\r\n※各[オプション値]に対して<br />\r\n　・[属性の見本画像]： 画像ファイル（ここからアップロード可）<br />\r\n　・[属性の見本画像ディレクトリ]： \"attributes\" <br /><br />\r\n\r\n【参考】オプション名<br />\r\n・[オプション名]：　カラー<br />\r\n・[オプションのタイプ]：　RADIO<br />\r\n※ただし見本画像表示はタイプに依らず可能<br /><br />\r\n\r\nNOTE：<br />\r\nなお、要素（ラジオボタン）、オプション名、見本画像の配置関係は、管理メニューの商品の管理＞オプション名の管理から目的のオプション名の[編集]にて<br />\r\n・列(Row)あたりの属性画像<br />\r\n・ラジオボタン・チェックボックスの属性スタイル<br />\r\nの設定で変えることができます。','',19);
INSERT INTO `products_description` VALUES (193,1,'ATTR_IMAGE2','','',0);
INSERT INTO `products_description` VALUES (193,2,'【OP2】画像付きオプションの例','画像付き商品オプションの例その2です。<br />\r\nこれは、商品オプション属性の見本画像に、画像ファイルを指定することで実現できます。<br /><br />\r\n\r\nこの例は、「素材とお手入れ方法」（READ ONLYタイプの商品オプションを使用）に関して、洗濯表示とアイロンの温度の2オプションを画像付きにしています。<br />\r\n\r\n【設定メモ】商品オプション属性<br />\r\n※[オプション値]＝\"洗濯機0\"、および  ”アイロンは0” に対してそれぞれ下記の見本画像を指定する。<br />\r\n・[属性の見本画像]： ※あらかじめ用意した見本画像のファイル（ここからアップロードできる）<br />\r\n・[属性の見本画像ディレクトリ]： \"attributes\" <br /><br />','',12);
INSERT INTO `products_description` VALUES (194,1,'IMAGE1','','',0);
INSERT INTO `products_description` VALUES (194,2,'【1】複数の商品画像を掲載（自動掲載）','メインの画像の他に関連画像を何点か掲載したい場合がありますよね。<br />\r\nそんな時に最も簡単なのがこの方法で、一定のルールで画像ファイルを命名してFTPしておけば自動掲載されます。<br />\r\n→この説明文の一番下に画像が3点掲載されています！<br /><br />\r\n\r\n【ルール】<br />\r\n・2点目以降の画像ファイル名＝[メイン画像ファイル名]＋[枝番(_xx）]＋[.同じ拡張子] でつける<br />\r\n・メイン画像と同じディレクトリにアップロードする<br />\r\n・2点目以降の画像掲載順は、枝番の小さい順になる<br /><br />\r\n\r\n【例】商品情報の管理で<br />\r\n・[商品画像]が[IMAGE1.jpg] <br />\r\n・[アップロード先ディレクトリ]：　”samples”を選択<br />\r\nとした場合は、<br /><br />\r\n\r\n2点目以降の画像<br />\r\n　IMAGE1_01.jpg<br />\r\n　IMAGE1_02.jpg<br />\r\n　IMAGE1_03.jpg<br />\r\n　・・・<br />\r\nを、（ショップ設置ディレクトリ）/images/samples/　配下にFTPすればよい。<br /><br />\r\n\r\nNOTE：<br />\r\n枝番付きの画像が自動掲載されるということは、逆に言えば、ある商品Aの画像ファイル名が、たまたま別の商品Bの画像名_xxになっていたら、商品Bのページに自動掲載されてしまうということを意味します。<br /><br />\r\nこれを避けるためにも、メイン画像についても命名ルールをよく考えて決めましょう。おすすめは、商品型番と同じにしておくことです（通常商品型番は、商品ごとに固有でしょうから）。どの商品の画像かもわかりやすく一石二鳥です。','',19);
INSERT INTO `products_description` VALUES (195,1,'IMAGE2','','',0);
INSERT INTO `products_description` VALUES (195,2,'【2】複数の商品画像を掲載(紹介文中にHTML直書き）','[商品説明]欄に＜img＞タグを直書きする方法もアリです。<br /><br />\r\n\r\nこの方法は、\r\n<ul>\r\n<li>紹介文の途中に画像を埋め込め、キャプションを添えることもできるなどレイアウトの自由度が高い</li>\r\n<li>画像名がバラバラだったり、拡張子が異なる画像でも扱える</li>\r\n<li><a href=\"http://www.flickr.com/\">Flickr</a>にアップした画像や、<a href=\"http://www.youtube.com\">YouTube</a>上の動画を掲載することもできる</li>\r\n</ul>\r\nなどのメリットがあります。<br />ただし、HTMLを知らない人にとっては厳しいかもしれません。<br /><br />\r\n\r\n＜img src=\"画像のURL\" alt=\"画像の説明\" /＞を書けばその画像が表示されます。<br /><br />\r\n【例】<br />\r\n<img src=\"http://okra.ark-web.jp/~shinchi/zenc/images/samples/IMAGE2_related.jpg\" alt=\"このTシャツのモデル猫『こまる』です\" /><br />\r\nこのTシャツでも使われている、当ショップ自慢のモデル猫『こまる』です。後ろ姿もかわいいでしょ（*^o^*）b','',17);
INSERT INTO `products_description` VALUES (196,1,'DISCNTQTY_ATTR1','','',0);
INSERT INTO `products_description` VALUES (196,2,'【1】カラーで割引条件が異なる数量割引例','オプションごとにボリュームディスカウントの割引条件が異なる設定例です。<br />\r\n数量のしきい値、割引額をオプションごとに独立して設定できます。<br /><br />\r\n\r\nこの例では、ホワイトの購入個数が9点以下なら値引なしで、10点なら＠100円引き、11点以上なら＠200円引きです。<br />\r\n対するオレンジの方は、19点までは割引なしで、20点以上なら＠150円引きになります。<br /><br /><br />\r\n\r\n<strong>オプションの数量値引設定の書式</strong><br />\r\n[しきい値 N:値引き額 D] をワンセットとして、必要セット分だけ「,（半角カンマ）」で繋ぎます。<br /><br />\r\n\r\n書式　　N0:D0, N1:D1, N2:D2・・, N(n-1):D(n-1), Nn:Dn<br /><br />\r\n意味　10N0個まで： D0円引き<br />\r\n　　　N10N2個まで： D1円引き<br />\r\n　　　：<br />\r\n　　　：<br />\r\n　　　N(n-1)0Nn個まで： D(n-1)円引き<br />\r\n　　　N(n-1)+1個以上： Dn円引き<br /><br />\r\n\r\n※n=1,2,・・・,Nの自然数。最後のセットのNnの指定値に意味はなく、Dnは常にN(n-1)+1個以上の時の値引額として扱われる。<br /><br />\r\n\r\n【実例1】\"ホワイト\"<br />\r\n[オプションの数値値引設定]　9:-0,10:-100,11:-200<br />\r\n意味：　09点までは値引き0、10点は＠100円引き、11点以上で＠200円引き<br /><br />\r\n\r\n【実例1】\"オレンジ\"<br />\r\n[オプションの数値値引設定]　19:-0,20:-150<br />\r\n意味：　019点までは値引き0、20点以上買うと＠150円引き<br /><br />\r\n\r\nNOTE：<br />\r\nDの値は頭に「-」をつけて-100なら100円引きに、「+」をつけて+100となら100円増しになる。','',35);
INSERT INTO `products_description` VALUES (197,1,'DISCNTQTY_ATTR2','','',0);
INSERT INTO `products_description` VALUES (197,2,'【2】カラーで通常価格も数量割引条件も異なる例','オプションごとにボリュームディスカウントの割引条件が異なる設定例です。<br />\r\n直前の【1】の例と異なるのは、【1】では商品価格側に基本価格分を持たせ、オプション属性では数量割引分だけを担当させていたのに対し、この例では、商品価格を0として、オプション料金側で価格をセットしている点です。<br />\r\n違いがわかるよう、ホワイトの定価（数量割引適用前オプション料金）を4000円、オレンジを5000円にしてあります。<br />\r\n\r\n数量割引額は、【1】と同じ設定になっていて、<br />\r\nホワイトの購入個数が9点以下なら値引なしで、10点なら＠100円引き、11点以上なら＠200円引きです。<br />\r\n対するオレンジの方は、19点までは割引なしで、20点以上なら＠150円引きになります。<br /><br />\r\n\r\n各オプション属性の[オプションの数量値引設定]の書式については【1】で説明していますのでご覧ください。<br /><br />\r\n\r\n\r\n【設定メモ】商品情報<br />\r\n・[商品属性による価格]：はい<br />\r\n・[商品価格 (ネット)]：0円<br /><br />\r\n\r\n【オプション設定メモ】\"ホワイト\"<br />\r\n・[オプションの価格]：4000円<br />\r\n・[属性による価格増減をベース価格に含める]：はい<br />\r\n・[オプションの数値値引設定]　9:-0,10:-100,11:-200<br />\r\n　意味：　09点までは値引き0、10点は＠100円引き、11点以上で＠200円引き<br /><br />\r\n\r\n【オプション設定メモ】\"オレンジ\"<br />\r\n・[オプションの価格]：5000円<br />\r\n・[属性による価格増減をベース価格に含める]：はい<br />\r\n・[オプションの数値値引設定]　19:-0,20:-150<br />\r\n　意味：　019点までは値引き0、20点以上買うと＠150円引き<br /><br /><br />\r\n\r\n<strong>NOTE1：　[商品属性による価格]：はい　の意味</strong><br /><br />\r\n商品名の下に表示される値段 ＝ [商品価格] ＋ [オプション価格（の最安値)] になります。<br />\r\nここが「いいえ」だと、[商品価格]だけが表示されます（商品価格＝0円の時は表示自体省略）。<br />\r\n今回の例だと、オプション価格の最安値はホワイトの4000円なので、商品名の下に表示される値段 ＝0円＋4000円の結果として4000円と表示されているわけです。<br /><br /><br />\r\n\r\n<strong>NOTE2：[属性による価格増減をベース価格に含める]：はい　の意味</strong><br /><br />\r\nこれが\"いいえ\"のオプションは、たとえそのオプション料金がオプション間で最安値だったとしても<br />\r\nNOTE1で説明した、<br />\r\n　商品名の下に表示される値段 ＝ [商品価格] ＋ [オプション価格（の最安値)] 　<br />\r\nの値としては使われません。','',14);
INSERT INTO `products_description` VALUES (198,1,'DSCNT_ONE1','','',0);
INSERT INTO `products_description` VALUES (198,2,'【OT1】ワンタイム割引例：1注文につき500円引き！','オプション属性の[ワンタイム割引]機能を使って、同一商品同一カラーを規定量以上なら「1注文あたり500円引き」を実現する例です。この割引はオプションごとの設定なので、カラーごとに割引額を変えることも可能です。<br /><br />\r\n\r\n【設定メモ】商品情報<br />\r\n・[商品属性による価格]：はい<br />\r\n・[商品価格 (ネット)]：0円<br /><br />\r\n\r\n【オプション設定メモ】\"ホワイト\"<br />\r\n・[オプションの価格]：4000円<br />\r\n・[属性による価格増減をベース価格に含める]：はい<br />\r\n・[ワンタイム値引の値引金額]　-500（円）　※頭に\"-\"をつけること<br /><br />\r\n\r\n【オプション設定メモ】\"オレンジ\"<br />\r\n・[オプションの価格]：5000円<br />\r\n・[属性による価格増減をベース価格に含める]：はい<br />\r\n・[ワンタイム値引の値引金額]　-500（円）　※頭に\"-\"をつけること<br /><br /><br />\r\n\r\n<strong>NOTE1：　[商品属性による価格]：はい　の意味</strong><br /><br />\r\n商品名の下に表示される値段 ＝ [商品価格] ＋ [オプション価格（の最安値)] になります。<br />\r\nここが「いいえ」だと、[商品価格]だけが表示されます（商品価格＝0円の時は表示自体省略）。<br />\r\n今回の例だと、オプション価格の最安値はホワイトの4000円なので、商品名の下に表示される値段 ＝0円＋4000円の結果として4000円と表示されているわけです。<br /><br /><br />\r\n\r\n<strong>NOTE2：[属性による価格増減をベース価格に含める]：はい　の意味</strong><br /><br />\r\nこれが\"いいえ\"のオプションは、たとえそのオプション料金がオプション間で最安値だったとしても<br />\r\nNOTE1で説明した、<br />\r\n　商品名の下に表示される値段 ＝ [商品価格] ＋ [オプション価格（の最安値)] 　<br />\r\nの値としては使われません。<br /><br /><br />','',7);
INSERT INTO `products_description` VALUES (199,1,'DSCNT_ONE2','','',0);
INSERT INTO `products_description` VALUES (199,2,'【OT2】ワンタイム割\"増\"例：1注文につき初期費用を加算','ワンタイム割引機能は、使い方次第では初期費用的な使い方もできます。<br />\r\nここで初期費用と言っているのは、「注文個数にかかわらず1回の注文あたり1度だけかかる料金」という意味です。<br /><br />\r\n\r\nかなり応用問題ですが、ワンタイム割引機能＋オプション属性の数量割引を使ったTシャツのオリジナルプリントの例をおみせしましょう。<br /><br />\r\n\r\nこの例は、無地Tシャツにロゴや社名などのオリジナルプリントを加工する、いわゆる\"チームTシャツ\"商品です。料金は以下のように決まります、\r\n<ul>\r\n<li>プリント原版代（版下代）がかかります。インクの色数だけで決まり注文数によりません。</li>\r\n<li>そのほかにTシャツ1枚あたりのプリント代（加工代）がかかります。これもインクの色数で単価が違い、さらに注文数がおおければ単価がさがります。</li>\r\n<li>もちろん、Tシャツ本体の値段が別途かかります</li>\r\n</ul>\r\n\r\n【設定メモ】商品情報<br />\r\n・[商品価格]：　4000円　※Tシャツ本体の価格。<br /><br />\r\n\r\n【設定メモ】オプション属性<br />\r\n[オプション値]／[オプション価格]／[ワンタイム値引の値引金額]／[オプションの数量値引設定]　の順に<br />\r\n・プリント1色　／+ 600 ／ +10000 ／49:-0,50:-200,100:-300<br />\r\n・プリント2色　／+ 700 ／ +20000 ／49:-0,50:-200,100:-300<br />\r\n・プリント3色　／+ 800 ／ +30000 ／49:-0,50:-200,100:-300<br /><br />\r\n\r\nNOTE：<br />\r\n・[商品価格]＝無地Tシャツ代<br />\r\n・[オプション価格]＝加工代<br />\r\n・[ワンタイム値引の値引金額]＝プリント原版代<br />\r\nにあたります。<br /><br />\r\n\r\nワンタイム割引は頭に\"+\"がつけば割増（今回の例）に、\"-\"がつけば割引（【1】の例）として機能します。','',11);
INSERT INTO `products_description` VALUES (201,1,'UNIT1','','',0);
INSERT INTO `products_description` VALUES (200,1,'LIMIT-2','','',0);
INSERT INTO `products_description` VALUES (200,2,'【2】お一人さま1点限り！（数量入力欄非表示）','注文1回あたりの購入数を最大1個に設定すると、数量入力欄は非表示になり、1点ずつしかカートに追加できなくなります。<br /><br />\r\n\r\n【設定メモ】<br />\r\n・商品の最小数量：　1<br />\r\n・商品の最大数量：　1<br />\r\n・商品の数量単位：　1<br /><br />','',1);
INSERT INTO `products_description` VALUES (202,2,'【2】2000個以上＆100個単位でご注文ください','これは、100個単位で、かつ最低でも2000個以上からの注文だけ受けたいなどのケースを想定した例です。卸販売や大量購入を対象とした販売などで役に立つと思います。<br /><br />\r\n\r\n【設定メモ：商品情報】<br />\r\n・[最小購入数]：　2000<br />\r\n・[数量単位]： 100<br /><br />\r\n\r\nNOTE：<br />\r\nさらに[最大購入数]を設定しておくと、注文の上限を制限できる。<br />','',0);
INSERT INTO `products_description` VALUES (203,1,'UNIT_ATR1','','',0);
INSERT INTO `products_description` VALUES (203,2,'【OP1】100個単位でご注文ください（オプション混在OK）','これは、商品オプションありの場合の[商品の数量単位]設定例です。<br />\r\nこの例では、オプションの組み合わせがどうあれ、最終的にこの商品合計点数が単位数量の倍数であれば購入可能です。<br />\r\nつまり、ホワイト50コカゴに入れ、続いてブルーを50コカゴに入れた時点で合計100コと見なされて購入可能となります。<br /><br />\r\n\r\n【設定メモ：商品情報】<br />\r\n・[商品の数量単位]：　100<br /><br />\r\n\r\n【設定メモ：商品価格の管理】<br />\r\n・最低量とユニット量を組み合わせて適応する：　はい','',1);
INSERT INTO `products_description` VALUES (204,1,'UNIT_ATR2','','',0);
INSERT INTO `products_description` VALUES (204,2,'【OP2】1オプションあたり100個単位でご注文ください','これは、商品オプションありの場合の[商品の数量単位]設定例です。<br />\r\nこの例では、1つのオプションあたりの購入数でカウントし、同じオプションで単位数量の倍数でないとと決済に進めません。<br />\r\nつまり、ホワイトとブルーを50コずつカゴに入れてもダメで、ホワイトあるいはブルー単体で100個とか200個ではじめて購入可能となります。<br /><br />\r\n\r\n【設定メモ：商品情報】<br />\r\n・[商品の数量単位]：　100<br /><br />\r\n\r\n【設定メモ：商品価格の管理】<br />\r\n・最低量とユニット量を組み合わせて適応する：　いいえ','',1);
INSERT INTO `products_description` VALUES (205,1,'PRCFACTOR','','',0);
INSERT INTO `products_description` VALUES (205,2,'【1】プライスファクター：ティーカップ（保証サービスあり）','プライスファクターの例です。<br />\r\nティーカップを販売します。このティーカップには、商品価格の何％かを追加で払うと購入後の一定期間、割れ・欠け時に無償交換してくれる「保証サービス」が用意されています。ここでは、この保証サービスを、プライスファクターを使って設定します。<br /><br />\r\n\r\n【設定メモ】商品情報<br />\r\n・[商品価格]：20000 円<br />\r\n・[商品属性による価格]： はい　※1<br /><br />\r\n\r\n【設定メモ】「5年保証」オプション<br />\r\n・[オプション価格]： 0円<br />\r\n・[プライスファクター]： 0.05 　※ベース価格の5％<br />\r\n・[属性による価格増減をベース価格に含める]： はい　※2<br /><br />\r\n\r\n【設定メモ】「20年保証」オプション<br />\r\n・[プライスファクター]： 0.15 　※ベース価格の15％<br />\r\n・他の設定は「5年保証」オプションと同じ。<br /><br /><br />\r\n\r\n<strong>NOTE： プライスファクターについて</strong><br />\r\nプライスファクターやオフセットは、オプション選択時の追加料金に次のように作用します。<br /><br />\r\n\r\n　<strong>オプション選択時の追加料金<br />\r\n　＝ [オプション価格] ＋  <br />\r\n　　 [ベース価格] ×（[プライスファクター]\"[オフセット]）</strong><br /><br />\r\n\r\n　ただし、上記※1,2のフラグが両方とも\"はい\"なら<br />\r\n　[ベース価格] ＝ [商品価格]＋[オプション価格]<br /><br />\r\n\r\n　どちらか（あるいは両方）が\"いいえ\"なら<br /><br />\r\n　[ベース価格] ＝ [商品価格]\r\n\r\n\r\n※この例では1と2のフラグは、両方\"はい\"にしましたが、もともとオプション価格を0円としているので\r\n実際は\"はい\"でも\"いいえ\"でも同じ結果になります。<br />','',69);
INSERT INTO `products_description` VALUES (206,1,'PRCFACTOR_OFFSET1','','',0);
INSERT INTO `products_description` VALUES (206,2,'【2】プライスファクターとオフセット：パッケージ販売','前の例ではプライスファクターに1以下の値（価格の5％等）を使いましたが、今度はパッケージ販売を例にとって大きな整数値を使う例をお見せしましょう。この例ではオフセットも併せて利用します。<br /><br />\r\n\r\n業者向けにTシャツをパッケージ販売する想定です。商品名の下には内包物（Tシャツ）1枚の価格が表示されますが、実際の注文は1パック100枚入りをパッケージ数で注文してもらいます。1パックの料金はTシャツ100枚分です。<br /><br />\r\n\r\nここでは、この1パックあたりの値段をオプション料金（＝Tシャツ単価）、プライスファクター（セット枚数）とオフセット（無料サービス分）を使って設定します。<br /><br />\r\n\r\n【設定メモ】商品情報<br />\r\n・[商品価格]：0 円<br />\r\n・[商品属性による価格]： はい　※1<br /><br />\r\n\r\n【設定メモ】「業務用パック（100枚入り）」オプション<br />\r\n・[オプション価格]： 4000円<br />\r\n・[プライスファクター]： 100 <br />\r\n・[オフセット]： 1<br />\r\n・[属性による価格増減をベース価格に含める]： はい　※2<br /><br />\r\n\r\n<strong>NOTE： プライスファクターについて</strong><br />\r\nプライスファクターやオフセットは、オプション選択時の追加料金に次のように作用します。<br /><br />\r\n\r\n　<strong>オプション選択時の購入単価（商品1点あたり）<br />\r\n　＝ [商品価格] ＋ [オプション価格]  <br />\r\n　　＋ [ベース価格] ×（[プライスファクター]\"[オフセット]）</strong><br /><br />\r\n\r\n　ただし、上記※1,2のフラグの状態で[ベース価格]が変わり、\r\n<ul>\r\n<li>2フラグともに \"はい\" なら・・<br />\r\n[ベース価格] ＝ [商品価格]＋[オプション価格]</li>\r\n<li>いずれか、あるいは両方 \"いいえ\" なら・・<br />\r\n[ベース価格] ＝ [商品価格]</li>\r\n</ul>\r\n\r\n\r\n<strong>※オフセット値について</strong><br />\r\nこの設定例をみて、「なんでオフセットを1にするんだろう？」と思いませんでしたか？前述の「オプション選択時の追加料金」の式を注意して見て欲しいのですが、プライスファクターで100倍している他に、式の1行目でもう1点分の価格（＝[商品価格] ＋ [オプション価格]）  が加算されていますよね。このままでは101点分の料金になってしまい具合が悪いので、オフセット側で余分な1点分をキャンセルしているのです。<br />\r\n応用例として、上記例で100枚のうち5枚分の料金は無料サービスにするなら、[オフセット]＝\"6\" （キャンセル1＋無料サービス5）となります。<br /><br />\r\n\r\n<strong>NOTE： 在庫の増減について</strong><br />\r\n在庫の増減について注意して欲しいのは、この例ですと1パッケージ購入したら、在庫の減り方としては1（パッケージ）分であって、100枚分（内包物の個数）ではないということです。<br />\r\nもし在庫数を内包物ベースで管理したいのであれば、プライスファクターではなく、[商品の数量単位]を100にする方法（こうすると100単位でしか注文できない）がベターかもしれません。','',41);
INSERT INTO `products_description` VALUES (207,1,'PRCFACTOR_OFFSET_ONCE','','',0);
INSERT INTO `products_description` VALUES (207,2,'【3】ワンタイムプライスファクターとオフセット','前の例ではプライスファクターとオフセットを使ったパッケージ販売の例をお見せしました。今度は名前は似ていますが、1注文あたりにかかる料金としてワンタイムプライスファクターとオフセットについて説明します。<br /><br />\r\n\r\n通常のプライスファクター／オフセットと、ワンタイム0の違いは、<br />\r\n　・追加分が商品単価に加算されるか（プライスファクター。N個買えばN倍かかる）、<br />\r\n　・注文1回あたりだけに加算されるか（ワンタイム0。何個買っても追加分は1注文あたり一定額）<br />\r\nという点です。<br /><br />\r\n\r\nここでもTシャツを販売します。「ギフト包装」オプションがあって、これは個別包装ではなく（何枚買っても）1個口でラッピングするものとします。つまり1注文あたり1ラッピングということで、このオプションの追加費用として商品1個の値段の20％いただくことにしました。これをワンタイムプライスファクターで実現します。<br /><br /><br />\r\n\r\n\r\n【設定メモ】商品情報<br />\r\n・[商品価格]：4000 円<br />\r\n・[商品属性による価格]： はい　※1<br /><br />\r\n\r\n【設定メモ】ギフトオプション<br />\r\n・[オプション価格]： 0円<br />\r\n・[ワンタイムプライスファクター]： 0.3 <br />\r\n・[ワンタイムオフセット]： 0.1<br />\r\n・[属性による価格増減をベース価格に含める]： はい　※2<br /><br />\r\n\r\n<strong>NOTE： ワンタイムプライスファクターおよびワンタイムオフセットについて</strong><br />\r\nワンタイムプライスファクター／オフセットは、オプション選択時の追加料金に次のように作用します。<br /><br />\r\n\r\n　<strong>オプション選択時の購入単価（商品1点あたり）<br />\r\n　＝ [商品価格] ＋ [オプション価格]</strong><br /><br />\r\n\r\n　この他に、1注文あたりかかる料金があって・・・<br />\r\n　<strong>オプション選択時の追加料金（1注文あたり）<br />\r\n　　 [ベース価格] ×（[ワンタイムプライスファクター]\"[ワンタイムオフセット]）</strong><br /><br />\r\n\r\n　ただし、上記※1,2のフラグの状態で[ベース価格]が変わり、\r\n<ul>\r\n<li>2フラグともに \"はい\" なら・・<br />\r\n[ベース価格] ＝ [商品価格]＋[オプション価格]</li>\r\n<li>いずれか、あるいは両方 \"いいえ\" なら・・<br />\r\n[ベース価格] ＝ [商品価格]</li>','',18);
INSERT INTO `products_description` VALUES (209,1,'BASEPRICE1','','',0);
INSERT INTO `products_description` VALUES (209,2,'【1】ベース価格＝商品価格＋オプション価格','ベース価格、商品価格、オプション価格の関係を理解する（1）<br /><br />\r\n\r\nベース価格は、オプションごとの数量割引や、プライスファクターを適用する際の基準額として使われます。<br /><br />\r\n\r\nベース価格は、\r\n<ul>\r\n <li>[商品属性による価格]フラグ　※商品情報の設定（1商品全体に影響する）</li>\r\n <li>[属性による価格増減をベース価格に含める]フラグ　※オプション属性ごとの設定（そのオプションだけに影響する）</li>\r\n</ul>\r\nの2フラグの状態が影響します。関係を表にすると・・・<br /><br />\r\n\r\n<table border=\"1\">\r\n  <tr>\r\n    <th width=\"20%\">[商品属性による価格]</th>\r\n   <td colspan=\"2\" width=\"60%\"><b>\"はい\"</b></td>\r\n   <td width=\"20%\"><b>\"いいえ\"</b></td>\r\n  </tr>\r\n  <tr>\r\n   <th>[属性による価格増減をベース価格に含める]</th>\r\n   <td width=\"40%\"><b>\"はい\"</b></td>\r\n   <td width=\"20%\">\"いいえ\"</td>\r\n   <td>\"</td>\r\n  </tr>\r\n  <tr>\r\n   <th>[ベース価格]</th>\r\n   <td style=\"background:#E6E68A;\">＝[商品価格]＋[オプション価格]</td>\r\n   <td colspan=\"2\" style=\"background:#E6E68A;\">＝[商品価格]</td>\r\n  </tr>\r\n  <tr>\r\n   <th>表示価格の対象？</th>\r\n   <td style=\"background:#E6E68A;\">YES（ベース価格中最小値なら表示される）</td>\r\n   <td colspan=\"2\" style=\"background:#E6E68A;\">表示対象外</td>\r\n  </tr>\r\n</table>\r\n<br />\r\nここでは、どちらのフラグも\"はい\"の例を提示します。<br /><br />\r\n\r\n【設定メモ】商品情報<br />\r\n・[商品価格]：4000円<br />\r\n・[商品属性による価格]：はい<br /><br />\r\n\r\n【設定メモ】\"ホワイト\"<br />\r\n・[属性による価格増減をベース価格に含める]：はい<br />\r\n・[オプション価格]：500円<br /><br />\r\n\r\n【設定メモ】\"オレンジ\"<br />\r\n・[属性による価格増減をベース価格に含める]：はい<br />\r\n・[オプション価格]：1000円<br /><br />\r\n\r\nNOTE:<br />\r\n表示価格（商品名の下に表示されている価格）には、ベース価格の最小値が表示されます。ホワイトのベース価格の方がオレンジより小さいので、ホワイトの値が表示されているわけです。','',11);
INSERT INTO `products_description` VALUES (208,1,'DISCNTQTY_ATTR_ONCE','','',0);
INSERT INTO `products_description` VALUES (208,2,'【3】カラーで割引条件が異なるワンタイム数量割引例','[オプションのワンタイム数量値引設定]を使う例です。<br />\r\n前の2例で扱った[オプションの数量値引設定]が単価に作用する値引きだったのに対して、ここで扱う[オプションのワンタイム数量値引設定]は、1回の注文あたりにかかる値引きである点が異なります。<br /><br />\r\n\r\nつまり、<br />\r\n商品価格が1000円、10個以上買ったら100円引きしたいときに<br />\r\n\r\n[オプションの数量値引設定] で設定した場合：<br />\r\n　　購入価格[10個分]＝（1000円 \" 100円）×10個 ＝9000円<br />\r\n　　※単価が900円になる。<br /><br />\r\n　\r\nですが、同じことを<br />\r\n[オプションのワンタイム数量値引設定]で設定した場合：<br />\r\n　　購入価格[10個分]＝ （1000円 × 10個）\"100円 ＝ 9900円<br />\r\n　　※単価は変化せず、合計から100円引かれる<br /><br />\r\n\r\nという結果になります。<br />\r\nなお、数量のしきい値、割引額をオプションごとに独立して設定できる点などは同じです。<br /><br /><br />\r\n\r\n<strong>オプションのワンタイム数量値引設定の書式</strong><br />\r\n[しきい値 N:値引き額 D] をワンセットとして、必要セット分だけ「,（半角カンマ）」で繋ぎます。<br /><br />\r\n\r\n書式　　N0:D0, N1:D1, N2:D2・・, N(n-1):D(n-1), Nn:Dn<br /><br />\r\n意味　10N0個まで： D0円引き<br />\r\n　　　N10N2個まで： D1円引き<br />\r\n　　　：<br />\r\n　　　：<br />\r\n　　　N(n-1)0Nn個まで： D(n-1)円引き<br />\r\n　　　N(n-1)+1個以上： Dn円引き<br /><br />\r\n\r\n※n=1,2,・・・,Nの自然数。最後のセットのNnの指定値に意味はなく、Dnは常にN(n-1)+1個以上の時の値引額として扱われる。<br /><br />\r\n\r\n【実例1】\"ホワイト\"<br />\r\n[オプションのワンタイム数量値引設定]　9:-0,10:-1000,11:-4000<br />\r\n意味：　09点までは値引き0、10点なら合計から1000円引き、11点以上では4000円を合計から引く<br /><br />\r\n\r\n【実例1】\"オレンジ\"<br />\r\n[オプションのワンタイム数量値引設定]　19:-0,20:-5000<br />\r\n意味：　019点までは値引き0、20点以上買うと合計から5000円引き<br /><br />\r\n\r\nNOTE：<br />\r\nDの値は頭に「-」をつけて-100なら100円引きに、「+」をつけて+100となら100円増しになる。','',11);
INSERT INTO `products_description` VALUES (210,1,'BASEPRICE3','','',0);
INSERT INTO `products_description` VALUES (210,2,'【3】ベース価格に含める/ない 混在','ベース価格、商品価格、オプション価格の関係を理解する（2）<br /><br />\r\n\r\n【1】や【2】の例とほぼ同じ設定ですが、<br />\r\n\"ホワイト\"の方は、[属性による価格増減をベース価格に含める]フラグ＝\"いいえ\"に、<br />\r\n一方\"オレンジ\"はフラグ＝\"はい\"のようにオプションによって混在している例です。<br />\r\n\r\n【設定メモ】商品情報<br />\r\n・[商品価格]：4000円<br />\r\n・[商品属性による価格]：はい<br /><br />\r\n\r\n【設定メモ】\"ホワイト\"<br />\r\n・[属性による価格増減をベース価格に含める]：いいえ<br />\r\n・[オプション価格]：500円<br /><br />\r\n\r\n【設定メモ】\"オレンジ\"<br />\r\n・[属性による価格増減をベース価格に含める]：はい<br />\r\n・[オプション価格]：1000円<br /><br />\r\n\r\nNOTE:<br />\r\n表示価格（商品名の下に表示されている価格）には、通常ベース価格の最小値が表示されます。しかし、ホワイトは[属性による価格増減をベース価格に含める]フラグが\"いいえ\"なので対象からはずれて、オレンジのベース価格が表示されます。','',9);
INSERT INTO `products_description` VALUES (211,1,'BASEPRICE2','','',0);
INSERT INTO `products_description` VALUES (211,2,'【2】ベース価格にオプション価格を含めない','ベース価格、商品価格、オプション価格の関係を理解する（2）<br /><br />\r\n\r\nすぐ直前の【1】とほぼ同じ設定ですが、<br />\r\nおおもとの[商品属性による価格]フラグが\"いいえ\"なので<br />\r\n\"ホワイト\"\"オレンジ\"オプションともに[ベース価格]には[オプション料金]を含みません。<br />\r\n\r\n【設定メモ】商品情報<br />\r\n・[商品価格]：4000円<br />\r\n・[商品属性による価格]：はい<br /><br />\r\n\r\n【設定メモ】\"ホワイト\"<br />\r\n・[属性による価格増減をベース価格に含める]：はい<br />\r\n・[オプション価格]：500円<br /><br />\r\n\r\n【設定メモ】\"オレンジ\"<br />\r\n・[属性による価格増減をベース価格に含める]：はい<br />\r\n・[オプション価格]：1000円<br /><br />\r\n\r\nNOTE:<br />\r\n表示価格（商品名の下に表示されている価格）やベース価格（オプションごと数量割引などの基本額）に含まれないだけで、そのオプション選択時の追加料金としては機能します。','',4);
INSERT INTO `products_description` VALUES (212,1,'Russ Tippins Band - The Hunter','The Product Music Type is specially designed for music media. This can offer a lot more flexibility than the Product','',0);
INSERT INTO `products_description` VALUES (212,2,'Russ Tippins Band - The Hunter','「Product - Music」は音楽（・映像）商品に最適化した製品タイプです。<br /><br />\r\n\r\nこの製品タイプで商品登録すると、<br />\r\n・アーティスト<br />\r\n・レコード会社<br />\r\n・音楽ジャンル<br />\r\nなどの情報を扱うことができ、<br /><br />\r\n\r\nさらに、ミュージッククリップ（mp3ファイル等）の割り当てが可能など、一般の製品タイプより柔軟性に富んでいます。','',10);
INSERT INTO `products_description` VALUES (213,1,'Help!','','',0);
INSERT INTO `products_description` VALUES (213,2,'Help!','この商品も前の例と同じく「Product - Music」商品タイプの音楽商品です。<br />\r\n前の例が、CDやDVDのような実体のある商品だけを対象としていたのに対し、この商品は実体のある商品（CD）とダウンロード商品（mp3ファイル）のどちらか選んで購入できる想定です。<br />\r\nmp3ファイルを選んだ場合は、購入後マイページからダウンロードできるようになります。<br /><br />\r\n\r\n【設定メモ】商品情報<br />\r\n・[ヴァーチャル商品l]：いいえ、送付先住所の入力は必要<br />\r\n・[常に送料無料]：特別商品とダウンロード商品のコンビネーションは配送先住所の登録が必要です。<br />\r\n・[重量]：0（Kg）　※ダウンロード商品の場合があるためオプション属性側で設定する<br /><br />\r\n\r\n【オプション属性設定メモ】メディアタイプ<br />\r\n■オプション属性＝\"CD\"オプションに対し<br />\r\n・[オプション重量]：1（Kg）<br /><br />\r\n\r\n■オプション属性＝\"mp3（ダウンロード）\"に対し<br />\r\n・[オプション重量]：0（Kg）<br />\r\n・[ダウンロード商品ファイル名]：help.mp3<br />\r\n・[有効期間(日)]：7 （日）<br />\r\n・[最大ダウンロード数]: 5 （回）<br /><br />\r\n\r\nNOTE1：<br />\r\n運営者がこの注文の[注文処理ステータス]を\"完了\"にすると、<br />\r\n注文者のマイページにおいてダウンロードできる状態になります。<br /><br />\r\n\r\nNOTE2：<br />\r\nダウンロードファイルは、あらかじめ<br />\r\n　（ショップ設置ディレクトリ）/download<br />\r\n配下にFTPアップロードしておきます。<br /><br />\r\n\r\n\r\nNOTE3：<br />\r\n「Product - Music」は音楽（・映像）商品に最適化した製品タイプです。<br /><br />\r\n\r\nこの製品タイプで商品登録すると、<br />\r\n・アーティスト<br />\r\n・レコード会社<br />\r\n・音楽ジャンル<br />\r\nなどの情報を扱うことができ、<br /><br />\r\n\r\nさらに、ミュージッククリップ（mp3ファイル等）の割り当てが可能など、一般の製品タイプより柔軟性に富んでいます。','',22);
INSERT INTO `products_description` VALUES (214,1,'DOC_GENERAL','Document General Type is used for Products that are actually Documents. These cannot be added to the cart but can be configured for the Document Sidebox. If your Document Sidebox is not showing, go to the Layout Controller and turn it on for your template.','',0);
INSERT INTO `products_description` VALUES (214,2,'一般ドキュメント（非売品）の例','これは製品タイプを[Document - General]で登録したドキュメントで、今読んでいるこれは[ドキュメントの内容]そのものです。<br /><br />\r\n\r\n[Document - General]に指定されたドキュメントは、カートに入れられません。また、販売商品ではないので、[\r\n商品型番]もありません。<br /><br />\r\n\r\nそのかわりに、「書類」と名付けられた特別なサイドボックスに掲載されます。この商品タイプは、文字通りドキュメントとして、このサイトのオンラインマニュアルやFAQとして使うなどの用途が考えられます。<br /><br />\r\n\r\n■■■■■\r\n\r\n<p>WWW(World Wide Web)は, スイスのCERN(欧州素粒子物理研究所)において, 所内の研究者間の研究成果の共有を支援することを目的として, 1990年に分散形広域ハイパテキストシステムの構築のためのプロジェクトによって設立された。このハイパテキストでは, テキスト又はテキストの集合を分割してノードという単位に分け, ノード内にアンカ(端点)を定義して, アンカ間の関係としてハイパリンクを規定している。</p> \r\n\r\n<p>WWWのプロジェクトができた当初は, CERNにおいて特定マシン上のラインモードブラウザが用意されただけであったが, 1991年にはCERN以外でもWWWの利用が可能になり, Xウィンドウシステム用のブラウザが開発された。1993年になると, イリノイ大学でMOSAICが発表されて文書中の画像表示が可能になり, Windows版に加えてMAC版も発表された。1994年のNetscape Navigatorのリリースは, WWWの爆発的普及のきっかけをつくり, それがさらにインタネット利用者を増やすことになった。 </p>\r\n\r\n<p>CERNでのハイパテキストの構造記述及びその交換手続きは, 開発当初は研究所内の仕様にとどまっていたが, WWWの普及と共にそれらの標準化への意識が高まり, IETF(Internet Engineering Task Force)において, HTML及びHTTP(Hypertext Transfer Protocol)の作業グループが設立されて本格的な標準化作業が開始された。HTML 2.0は, IETF RFC1866[1]として公表され, その後, HTMLの標準化作業は, W3C(World Wide Web Consortium)に移された。 </p>\r\n\r\n<p>W3Cでの初期のHTML改版作業は, ブラウザメーカの独自の拡張を吸収してスタイル指定を含む多くの機能を盛り込む方針で行われた。しかしその後, HTMLを本来の文書論理構造記述の言語に引き戻して, スタイル指定については別の交換様式で対応するという方針が主流となり, HTML 3.2[2], HTML 4.0[3]へと改版されてきた。</p>','',9);
INSERT INTO `products_description` VALUES (215,1,'Document - Product type','','',0);
INSERT INTO `products_description` VALUES (215,2,'商品ドキュメント（販売商品）の例','これは商品として販売するドキュメントで、商品タイプは[Document - Product]です。<br /><br />\r\n\r\n商品タイプが[Document - General]だった直前の例と異なり、ここにはカゴへ入れるボタンが表示されています。<br />\r\n\r\n商品ドキュメント（販売商品）タイプでは、商品情報の入力項目などは一般商品とかわりありません。しかし、「書類」という特別なサイドボックスに表示されるなど、ドキュメントとして特別扱いされます。','',8);
INSERT INTO `products_description` VALUES (225,1,'Single Download','','',0);
INSERT INTO `products_description` VALUES (225,2,'ダウンロード商品例（1ファイル）','これはファイルが1つだけの場合のダウンロード例です。<br />\r\nオプションで選んだファイル形式のファイル1点をダウンロード可能です。<br /><br />\r\n\r\n【設定メモ】商品情報<br />\r\n・[ヴァーチャル商品l]：はい、送付先住所をスキップ<br />\r\n・[常に送料無料]：この商品も前の例と同じく「Product - Music」商品タイプの音楽商品です。<br />\r\n前の例が、CDやDVDのような実体のある商品だけを対象としていたのに対し、この商品は実体のある商品（CD）とダウンロード商品（mp3ファイル）のどちらか選んで購入できる想定です。<br />\r\nmp3ファイルを選んだ場合は、購入後マイページからダウンロードできるようになります。\r\n\r\n【設定メモ】商品情報<br />\r\n・[ヴァーチャル商品l]：はい、送付先住所をスキップ<br />\r\n・[常に送料無料]：特別商品とダウンロード商品のコンビネーションは配送先住所の登録が必要です。<br /><br />\r\n\r\n【オプション属性設定メモ】オプション名：\"ファイル形式\"<br />\r\n・[ダウンロード商品ファイル名]：\r\n　-\"mp3（ダウンロード商品）\" オプションにのみ：ms_word_sample.zip<br />\r\n　-\"CD版\"オプション：（設定しない）<br />\r\n・[有効期間(日)]：7 （日）<br />\r\n・[最大ダウンロード数]: 5 （回）<br /><br />\r\n\r\nNOTE1：<br />\r\n運営者がこの注文の[注文処理ステータス]を\"完了\"にすると、<br />\r\n注文者のマイページにおいてダウンロードできる状態になります。<br /><br />\r\n\r\nNOTE2：<br />\r\nダウンロードファイルは、あらかじめ<br />\r\n　（ショップ設置ディレクトリ）/download\r\n配下にFTPアップロードしておきます。<br /><br />\r\n\r\n\r\nNOTE3：<br />\r\n「Product - Music」は音楽（・映像）商品に最適化した製品タイプです。<br /><br />\r\n\r\nこの製品タイプで商品登録すると、<br />\r\n・アーティスト<br />\r\n・レコード会社<br />\r\n・音楽ジャンル<br />\r\nなどの情報を扱うことができ、<br /><br />\r\n\r\nさらに、ミュージッククリップ（mp3ファイル等）の割り当てが可能など、一般の製品タイプより柔軟性に富んでいます。<br /><br />\r\n\r\n【オプション属性設定メモ】オプション名：\"マニュアル\"<br />\r\n・[ダウンロード商品ファイル名]：<br />\r\n　-\"PDFファイル\"オプション： pdf_sample.zip<br />\r\n　-\"Wordファイル\" オプション：ms_word_sample.zip<br />\r\n・[有効期間(日)]：7 （日）<br />\r\n・[最大ダウンロード数]: 5 （回）<br /><br />\r\n\r\nNOTE1：<br />\r\n運営者がこの注文の[注文処理ステータス]を\"完了\"にすると、<br />\r\n注文者のマイページにおいてダウンロードできる状態になります。<br /><br />\r\n\r\nNOTE2：<br />\r\nダウンロードファイルは、あらかじめ<br />\r\n　（ショップ設置ディレクトリ）/download<br />\r\n配下にFTPアップロードしておきます。<br />','',12);
INSERT INTO `products_description` VALUES (217,1,'Sample of Product Free Shipping Type','<p>Product Free Shipping can be setup to highlight the Free Shipping aspect of the product. <br /><br />These pages include a Free Shipping Image on them. <br /><br />You can define the ALWAYS_FREE_SHIPPING_ICON in the language file. This can be Text, Image, Text/Image Combo or nothing. <br /><br />The weight does not matter on Always Free Shipping if you set Always Free Shipping to Yes. <br /><br />Be sure to have the Free Shipping Module Turned on! Otherwise, if this is the only product in the cart, it will not be able to be shipped. <br /><br />Notice that this is defined with a weight of 5lbs. But because of the Always Free Shipping being set to Y there will be no shipping charges for this product. <br /><br />You do not have to use the Product Free Shipping product type just to use Always Free Shipping. But the reason you may want to do this is so that the layout of the Product Free Shipping product info page can be layout specifically for the Free Shipping aspect of the product. <br /><br />This includes a READONLY attribute for Option Name: Shipping and Option Value: Free Shipping Included. READONLY attributes do not show on the options for the order.</p>','',0);
INSERT INTO `products_description` VALUES (217,2,'送料無料タイプ商品の例','ここでは、商品タイプあるいはカテゴリを[Product - Free Shipping]タイプにした場合のふるまいを説明します。<br /><br />\r\n\r\nこの商品の所属するカテゴリは、[Product - Free Shipping]商品タイプ（以下、送料無料タイプ）限定に設定されています。このカテゴリ配下で新しい商品を登録すると、送料無料タイプの商品として登録されます。<br /><br />\r\n\r\n送料無料タイプの商品は、機能的には一般の商品とかわりませんが、あらかじめ[常に送料無料]フラグが\"はい\"に設定されています。<br /><br /><br />\r\n\r\n送料無料の商品には「送料無料！」マークがついてハイライト表示されます。<br /><br />\r\n\r\n[常に送料無料]フラグが\"はい\"なら、商品重量に関係なく、常に送料無料となります。<br /><br />\r\nなお、配送モジュールの「配送料無料」モジュールを有効にしておくこと。さもないと、カートに入れた送料無料商品の精算ができなくなってしまいます。<br /><br />\r\n\r\nNOTE:<br />\r\n送料無料になるかどうかの判定基準は5lbs（約2Kg強）です。しかし[常に送料無料]フラグが\"はい\"になっていると、そのしきい値にかかわらず送料は無料です。<br /><br />\r\n\r\nNOTE：<br />\r\nLanguage file中の、[ALWAYS_FREE_SHIPPING_ICON] 変数を変更することで、送料無料の時のふるまい（テキストを表示する／イメージ画像を表示／テキストと画像の組み合わせを表示／なにも表示しない）を制御できます。<br /><br />','',7);
INSERT INTO `products_description` VALUES (218,1,'Free Ship & Payment Virtual','Product Price is set to 0  <br /><br />    Payment weight is set to 2 ...  <br /><br />    Virtual is ON ... this will skip shipping address  <br /><br />','',0);
INSERT INTO `products_description` VALUES (218,2,'【例3】無料商品：送料無料かつ送付先住所入力不要','商品価格が0円（無料商品）で、商品重量は2Kgの商品ですが、バーチャル商品扱いに設定したため、送料無料でお届け先の住所入力をスキップします。<br />これは一見不自然な設定に見えますが、例えばお届け先をユーザ登録住所に限定したい（他の住所は指定できない）場合などの利用が考えられます。<br />なお、同時購入した他の商品すべてがデモ商品であるとき、送料は全く発生しません。<br /><br /><br /><br />【設定メモ】<br /><br />・無料商品： はい<br /><br />・商品価格： 0円<br /><br />・・バーチャル商品：　はい、送付先住所をスキップ<br /><br />・常に送料無料：　いいえ、通常送料を適用<br />','',1);
INSERT INTO `products_description` VALUES (224,1,'FREESHIP3','','',0);
INSERT INTO `products_description` VALUES (224,2,'【3】送料無料（重量＝０Kgの商品）','【3】送料無料（重量が0Kgの商品）\r\nこれまでの2例では、[常に送料無料]フラグが\"はい\"に設定することにより常時送料無料商品として取り扱われる例を見てきました。<br /><br />\r\nこれに対して、ここでは重量が0である結果として送料が無料になる例を提示します。<br /><br />\r\n\r\nここでの商品重量は0です。またオプションカラー\"ホワイト\"の追加重量も0ですので、ホワイト購入時は送料が無料になります。\r\n※ただしカゴの中に他の送料有料商品が入っていないこと）\r\n\r\n一方\"オレンジ\"のオプション重量は20Kgあります。従って、オレンジ選択時は送料は無料になりません。\r\n\r\n【設定メモ】商品情報\r\n・[常に送料無料]：いいえ、通常送料を適用\r\n・[商品重量]：0（Kg）\r\n\r\n【設定メモ】商品オプション属性\r\n・\"ホワイト\"の[重量]：0（Kg）\r\n・\"オレンジ\"の[重量]：20（Kg）','',7);
INSERT INTO `products_description` VALUES (226,1,'Multiple Download','<p>This product is set up to have multiple downloads.</p><p>The Product Price is $49.99</p><p>The attributes are setup with two Option Names, one for each download to allow for two downloads at the same time.</p><p>The first Download is listed under:</p><p>Option Name: Version<br />Option Value: Download Windows - English<br />Option Value: Download Windows - Spanish<br />Option Value: DownloadMAC - English<br /></p><p>The second Download is listed under:</p><p>Option Name: Documentation<br />Option Value: PDF - English<br />Option Value:MS Word- English</p>','',0);
INSERT INTO `products_description` VALUES (226,2,'ダウンロード商品例（複数ファイル）','これは複数ファイル一括ダウンロード商品の例です。<br /><br />\r\nここではソフト本体とそのマニュアルをセットでダウンロード販売する想定です。本体とマニュアルそれぞれのファイル形式を選んで（商品オプション）注文すると、2ファイルが同時にダウンロード可能になります。<br /><br />\r\n\r\n【設定メモ】商品情報<br />\r\n・[ヴァーチャル商品l]：はい、送付先住所をスキップ<br />\r\n・[常に送料無料]：この商品も前の例と同じく「Product - Music」商品タイプの音楽商品です。<br />\r\n前の例が、CDやDVDのような実体のある商品だけを対象としていたのに対し、この商品は実体のある商品（CD）とダウンロード商品（mp3ファイル）のどちらか選んで購入できる想定です。<br />\r\nmp3ファイルを選んだ場合は、購入後マイページからダウンロードできるようになります。\r\n\r\n【設定メモ】商品情報<br />\r\n・[ヴァーチャル商品l]：はい、送付先住所をスキップ<br />\r\n・[常に送料無料]：特別商品とダウンロード商品のコンビネーションは配送先住所の登録が必要です。<br /><br />\r\n\r\n【オプション属性設定メモ】オプション名：\"ファイル形式\"<br />\r\n・[ダウンロード商品ファイル名]：\r\n　-\"mp3（ダウンロード商品）\" オプションにのみ：ms_word_sample.zip<br />\r\n　-\"CD版\"オプション：（設定しない）<br />\r\n・[有効期間(日)]：7 （日）<br />\r\n・[最大ダウンロード数]: 5 （回）<br /><br />\r\n\r\nNOTE1：<br />\r\n運営者がこの注文の[注文処理ステータス]を\"完了\"にすると、<br />\r\n注文者のマイページにおいてダウンロードできる状態になります。<br /><br />\r\n\r\nNOTE2：<br />\r\nダウンロードファイルは、あらかじめ<br />\r\n　（ショップ設置ディレクトリ）/download\r\n配下にFTPアップロードしておきます。<br /><br />\r\n\r\n\r\nNOTE3：<br />\r\n「Product - Music」は音楽（・映像）商品に最適化した製品タイプです。<br /><br />\r\n\r\nこの製品タイプで商品登録すると、<br />\r\n・アーティスト<br />\r\n・レコード会社<br />\r\n・音楽ジャンル<br />\r\nなどの情報を扱うことができ、<br /><br />\r\n\r\nさらに、ミュージッククリップ（mp3ファイル等）の割り当てが可能など、一般の製品タイプより柔軟性に富んでいます。<br /><br />\r\n\r\n【オプション属性設定メモ】<br />\r\n■オプション名：\"ソフト本体\"に関し<br />\r\n・[ダウンロード商品ファイル名]：<br />\r\n　-\"Windows(en)版\": win-en.zip<br />\r\n　-\"Windows(jp)版\": win-jp.zip<br />\r\n　-\"Mac(jp)版\"：mac-jp.zip<br />\r\n・[有効期間(日)]：7 （日）<br />\r\n・[最大ダウンロード数]: 5 （回）<br /><br />\r\n\r\n■オプション名：\"マニュアル\"に関して<br />\r\n・[ダウンロード商品ファイル名]：<br />\r\n　-\"PDFファイル\"オプション： pdf_sample.zip<br />\r\n　-\"Wordファイル\" オプション：ms_word_sample.zip<br />\r\n・[有効期間(日)]：7 （日）<br />\r\n・[最大ダウンロード数]: 5 （回）<br /><br />\r\n\r\n\r\nNOTE1：<br />\r\n運営者がこの注文の[注文処理ステータス]を\"完了\"にすると、<br />\r\n注文者のマイページにおいてダウンロードできる状態になります。<br /><br />\r\n\r\nNOTE2：<br />\r\nダウンロードファイルは、あらかじめ<br />\r\n　（ショップ設置ディレクトリ）/download<br />\r\n配下にFTPアップロードしておきます。<br />','',3);
INSERT INTO `products_description` VALUES (229,1,'CD and download file(mp3)','','',0);
INSERT INTO `products_description` VALUES (229,2,'ダウンロード商品とリアル商品の混在（CDとmp3ファイル）','ここまでの2例がダウンロード商品のみで構成されていたのに対し、この商品は実体のある商品（CD）とダウンロード商品（mp3ファイル）が混在した販売例です。ユーザは購入時に好みの媒体を選んでカゴに入れます。<br />\r\nmp3ファイルを選んだ場合は、購入後マイページからダウンロードできるようになります。<br /><br />\r\n\r\n【設定メモ】商品情報<br />\r\n・[ヴァーチャル商品l]：いいえ、送付先住所の入力は必要<br />\r\n・[常に送料無料]：特別商品とダウンロード商品のコンビネーションは配送先住所の登録が必要です。<br />\r\n・[重量]：0（Kg）　※ダウンロード商品の場合があるためオプション属性側で設定する<br /><br />\r\n\r\n【オプション属性設定メモ】メディアタイプ<br />\r\n■オプション属性＝\"CD\"オプションに対し<br />\r\n・[オプション重量]：1（Kg）<br /><br />\r\n\r\n■オプション属性＝\"mp3（ダウンロード）\"に対し<br />\r\n・[オプション重量]：0（Kg）<br />\r\n・[ダウンロード商品ファイル名]：help.mp3<br />\r\n・[有効期間(日)]：7 （日）<br />\r\n・[最大ダウンロード数]: 5 （回）<br /><br />\r\n\r\nNOTE1：<br />\r\n運営者がこの注文の[注文処理ステータス]を\"完了\"にすると、<br />\r\n注文者のマイページにおいてダウンロードできる状態になります。<br /><br />\r\n\r\nNOTE2：<br />\r\nダウンロードファイルは、あらかじめ<br />\r\n　（ショップ設置ディレクトリ）/download\r\n配下にFTPアップロードしておきます。<br /><br />\r\n\r\n\r\nNOTE3：<br />\r\nこの商品の商品タイプは「Product - Music」です。「Product - Music」タイプは音楽（・映像）商品に最適化した製品タイプです。<br /><br />\r\n\r\nこの製品タイプで商品登録すると、<br />\r\n・アーティスト<br />\r\n・レコード会社<br />\r\n・音楽ジャンル<br />\r\nなどの情報を扱うことができ、<br /><br />\r\n\r\nさらに、ミュージッククリップ（mp3ファイル等）の割り当てが可能など、一般の製品タイプより柔軟性に富んでいます。','',3);
INSERT INTO `products_description` VALUES (230,1,'DOC_GENERAL','Document General Type is used for Products that are actually Documents. These cannot be added to the cart but can be configured for the Document Sidebox. If your Document Sidebox is not showing, go to the Layout Controller and turn it on for your template.','',0);
INSERT INTO `products_description` VALUES (230,2,'一般ドキュメント（非売品）の例','これは製品タイプを[Document - General]で登録したドキュメントで、今読んでいるこれは[ドキュメントの内容]そのものです。<br /><br />\r\n\r\n[Document - General]に指定されたドキュメントは、カートに入れられません。また、販売商品ではないので、[\r\n商品型番]もありません。<br /><br />\r\n\r\nそのかわりに、「書類」と名付けられた特別なサイドボックスに掲載されます。この商品タイプは、文字通りドキュメントとして、このサイトのオンラインマニュアルやFAQとして使うなどの用途が考えられます。<br /><br />\r\n\r\n■■■■■\r\n\r\n<p>WWW(World Wide Web)は, スイスのCERN(欧州素粒子物理研究所)において, 所内の研究者間の研究成果の共有を支援することを目的として, 1990年に分散形広域ハイパテキストシステムの構築のためのプロジェクトによって設立された。このハイパテキストでは, テキスト又はテキストの集合を分割してノードという単位に分け, ノード内にアンカ(端点)を定義して, アンカ間の関係としてハイパリンクを規定している。</p> \r\n\r\n<p>WWWのプロジェクトができた当初は, CERNにおいて特定マシン上のラインモードブラウザが用意されただけであったが, 1991年にはCERN以外でもWWWの利用が可能になり, Xウィンドウシステム用のブラウザが開発された。1993年になると, イリノイ大学でMOSAICが発表されて文書中の画像表示が可能になり, Windows版に加えてMAC版も発表された。1994年のNetscape Navigatorのリリースは, WWWの爆発的普及のきっかけをつくり, それがさらにインタネット利用者を増やすことになった。 </p>\r\n\r\n<p>CERNでのハイパテキストの構造記述及びその交換手続きは, 開発当初は研究所内の仕様にとどまっていたが, WWWの普及と共にそれらの標準化への意識が高まり, IETF(Internet Engineering Task Force)において, HTML及びHTTP(Hypertext Transfer Protocol)の作業グループが設立されて本格的な標準化作業が開始された。HTML 2.0は, IETF RFC1866[1]として公表され, その後, HTMLの標準化作業は, W3C(World Wide Web Consortium)に移された。 </p>\r\n\r\n<p>W3Cでの初期のHTML改版作業は, ブラウザメーカの独自の拡張を吸収してスタイル指定を含む多くの機能を盛り込む方針で行われた。しかしその後, HTMLを本来の文書論理構造記述の言語に引き戻して, スタイル指定については別の交換様式で対応するという方針が主流となり, HTML 3.2[2], HTML 4.0[3]へと改版されてきた。</p>','',0);
INSERT INTO `products_description` VALUES (232,1,'Product - Music type','The Product Music Type is specially designed for music media. This can offer a lot more flexibility than the Product','',0);
INSERT INTO `products_description` VALUES (232,2,'Musicタイプ商品','「Product - Music」は音楽（・映像）商品に最適化した製品タイプです。<br /><br />\r\n\r\nこの製品タイプで商品登録すると、<br />\r\n・アーティスト<br />\r\n・レコード会社<br />\r\n・音楽ジャンル<br />\r\nなどの情報を扱うことができ、<br /><br />\r\n\r\nさらに、ミュージッククリップ（mp3ファイル等）の割り当てが可能など、一般の製品タイプより柔軟性に富んでいます。','',0);
INSERT INTO `products_description` VALUES (233,1,'Product - General type','','',0);
INSERT INTO `products_description` VALUES (233,2,'CCロゴTシャツ','クリエイティブ・コモンズロゴのTシャツです。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','http://www.creativecommons.jp/',0);
INSERT INTO `products_description` VALUES (234,1,'TAXIN-1','','',1);
INSERT INTO `products_description` VALUES (234,2,'商品価格を税込み（内税）で管理する例(1)','商品価格を内税（税込み価格）で管理する例です。<br />\r\n内税の場合、2つのやり方があります（次の例と比べてみてください）。<br />\r\nこのケースでは商品価格に内税価格を入力し、税種別を「なし」にしています<br /><br />\r\n\r\n[税種別]をなしに指定すると、商品価格（ネット）＝商品価格（グロス）になり、入力額がそのまま表示されます。オプション価格についても同様で入力額がそのまま使われます。<br /><br />\r\n\r\n・メリット：<br />\r\n　消費税分が上乗せされないので、4,980円など商売上ウケの良い価格表示にしたい場合、制御しやすい。<br /><br />\r\n・デメリット：<br />\r\n　消費税率が変わったら、全対象商品について一つ一つ見直しが必要。<br />\r\n　内部的にも税込み価格ベースで管理することになるので経理上は面倒かも？！<br /><br />\r\n\r\n【設定メモ】内税で管理する：<br />\r\n・[税種別]：　-- なし --<br />\r\n・[商品価格（ネット）]：10000円 （税込み価格を入力する）<br /><br />\r\n\r\n【設定メモ】商品オプション属性<br />\r\n・[オプション価格] レッド（＋0/追加料金なし）、ホワイト（＋1000円）、イエロー（＋2000円）','',0);
INSERT INTO `products_description` VALUES (156,1,'SALE10%OFF-1','','',0);
INSERT INTO `products_description` VALUES (157,1,'SALE10%OFF-2','','',0);
INSERT INTO `products_description` VALUES (158,1,'SALE10%OFF-3','','',0);
INSERT INTO `products_description` VALUES (159,1,'SALE500yenOFF-1','','',0);
INSERT INTO `products_description` VALUES (160,1,'SALE500yenOFF-2','','',0);
INSERT INTO `products_description` VALUES (161,1,'SALE500yenOFF-3','','',0);
INSERT INTO `products_description` VALUES (162,1,'SALE set8000yen-1','','',0);
INSERT INTO `products_description` VALUES (163,1,'SALE set8000yen-2','','',0);
INSERT INTO `products_description` VALUES (164,1,'SALE set8000yen-3','','',0);
INSERT INTO `products_description` VALUES (165,1,'SPECIAL1-1','','',0);
INSERT INTO `products_description` VALUES (166,1,'SPECIAL2-1','','',0);
INSERT INTO `products_description` VALUES (167,1,'SPECIAL2-2','','',0);
INSERT INTO `products_description` VALUES (168,1,'SPECIAL2-3','','',0);
INSERT INTO `products_description` VALUES (169,1,'SPECIAL3','','',0);
INSERT INTO `products_description` VALUES (170,1,'SALE_ETC1','','',0);
INSERT INTO `products_description` VALUES (171,1,'SALE_ETC2','','',0);
INSERT INTO `products_description` VALUES (172,1,'NOSALE','','',0);
INSERT INTO `products_description` VALUES (173,1,'SALE_SPECIAL1-1','','',0);
INSERT INTO `products_description` VALUES (174,1,'SALE_SPECIAL1-2','','',0);
INSERT INTO `products_description` VALUES (175,1,'SALE_SPECIAL1-3','','',0);
INSERT INTO `products_description` VALUES (176,1,'SALE_SPECIAL2-1','','',0);
INSERT INTO `products_description` VALUES (177,1,'SALE_SPECIAL2-2','','',0);
INSERT INTO `products_description` VALUES (178,1,'SALE_SPECIAL2-3','','',0);
INSERT INTO `products_description` VALUES (179,1,'SALE_SPECIAL3-1','','',0);
INSERT INTO `products_description` VALUES (180,1,'SALE_SPECIAL3-2','','',0);
INSERT INTO `products_description` VALUES (181,1,'SALE_SPECIAL3-3','','',0);
INSERT INTO `products_description` VALUES (227,9,'【1】ロゴデータ・ファイルを添付して注文','商品オプションのタイプ＝FILEの活用サンプルです。<br /><br />\r\n\r\nFILEタイプにすると、アップロードファイルの指定欄が表示され、ユーザはファイルを添付して注文することができます。<br />\r\n\r\nこの例で扱うＴシャツは、会社やクラブのロゴをオリジナルプリントできる商品で、ロゴのデータファイルはユーザがあらかじめイラストレータなどで作成したものをアップロードして運営者に渡します。なお、オプション料金として1000円かかります。<br /><br /><br />\r\n\r\n\r\n【オプション名の設定】<br />\r\n・[オプション名]：　\"ロゴ・データ添付\"<br />\r\n・[オプションのタイプ]：　FILE<br /><br />\r\n※FILEタイプの場合は、オプション値登録は不要です。<br /><br />\r\n\r\n【設定メモ：商品情報】<br />\r\n・[商品価格]：4000円<br />\r\n・[商品属性による価格]：はい<br /><br />\r\n\r\n【設定メモ：オプション属性】\"ロゴ・データ添付\"オプション<br />\r\n・オプション価格：+1000 円<br />','',0);
INSERT INTO `products_description` VALUES (229,9,'ダウンロード商品とリアル商品の混在（CDとmp3ファイル）','ここまでの2例がダウンロード商品のみで構成されていたのに対し、この商品は実体のある商品（CD）とダウンロード商品（mp3ファイル）が混在した販売例です。ユーザは購入時に好みの媒体を選んでカゴに入れます。<br />\r\nmp3ファイルを選んだ場合は、購入後マイページからダウンロードできるようになります。<br /><br />\r\n\r\n【設定メモ】商品情報<br />\r\n・[ヴァーチャル商品l]：いいえ、送付先住所の入力は必要<br />\r\n・[常に送料無料]：特別商品とダウンロード商品のコンビネーションは配送先住所の登録が必要です。<br />\r\n・[重量]：0（Kg）　※ダウンロード商品の場合があるためオプション属性側で設定する<br /><br />\r\n\r\n【オプション属性設定メモ】メディアタイプ<br />\r\n■オプション属性＝\"CD\"オプションに対し<br />\r\n・[オプション重量]：1（Kg）<br /><br />\r\n\r\n■オプション属性＝\"mp3（ダウンロード）\"に対し<br />\r\n・[オプション重量]：0（Kg）<br />\r\n・[ダウンロード商品ファイル名]：help.mp3<br />\r\n・[有効期間(日)]：7 （日）<br />\r\n・[最大ダウンロード数]: 5 （回）<br /><br />\r\n\r\nNOTE1：<br />\r\n運営者がこの注文の[注文処理ステータス]を\"完了\"にすると、<br />\r\n注文者のマイページにおいてダウンロードできる状態になります。<br /><br />\r\n\r\nNOTE2：<br />\r\nダウンロードファイルは、あらかじめ<br />\r\n　（ショップ設置ディレクトリ）/download\r\n配下にFTPアップロードしておきます。<br /><br />\r\n\r\n\r\nNOTE3：<br />\r\nこの商品の商品タイプは「Product - Music」です。「Product - Music」タイプは音楽（・映像）商品に最適化した製品タイプです。<br /><br />\r\n\r\nこの製品タイプで商品登録すると、<br />\r\n・アーティスト<br />\r\n・レコード会社<br />\r\n・音楽ジャンル<br />\r\nなどの情報を扱うことができ、<br /><br />\r\n\r\nさらに、ミュージッククリップ（mp3ファイル等）の割り当てが可能など、一般の製品タイプより柔軟性に富んでいます。','',0);
INSERT INTO `products_description` VALUES (226,9,'ダウンロード商品例（複数ファイル）','これは複数ファイル一括ダウンロード商品の例です。<br /><br />\r\nここではソフト本体とそのマニュアルをセットでダウンロード販売する想定です。本体とマニュアルそれぞれのファイル形式を選んで（商品オプション）注文すると、2ファイルが同時にダウンロード可能になります。<br /><br />\r\n\r\n【設定メモ】商品情報<br />\r\n・[ヴァーチャル商品l]：はい、送付先住所をスキップ<br />\r\n・[常に送料無料]：この商品も前の例と同じく「Product - Music」商品タイプの音楽商品です。<br />\r\n前の例が、CDやDVDのような実体のある商品だけを対象としていたのに対し、この商品は実体のある商品（CD）とダウンロード商品（mp3ファイル）のどちらか選んで購入できる想定です。<br />\r\nmp3ファイルを選んだ場合は、購入後マイページからダウンロードできるようになります。\r\n\r\n【設定メモ】商品情報<br />\r\n・[ヴァーチャル商品l]：はい、送付先住所をスキップ<br />\r\n・[常に送料無料]：特別商品とダウンロード商品のコンビネーションは配送先住所の登録が必要です。<br /><br />\r\n\r\n【オプション属性設定メモ】オプション名：\"ファイル形式\"<br />\r\n・[ダウンロード商品ファイル名]：\r\n　-\"mp3（ダウンロード商品）\" オプションにのみ：ms_word_sample.zip<br />\r\n　-\"CD版\"オプション：（設定しない）<br />\r\n・[有効期間(日)]：7 （日）<br />\r\n・[最大ダウンロード数]: 5 （回）<br /><br />\r\n\r\nNOTE1：<br />\r\n運営者がこの注文の[注文処理ステータス]を\"完了\"にすると、<br />\r\n注文者のマイページにおいてダウンロードできる状態になります。<br /><br />\r\n\r\nNOTE2：<br />\r\nダウンロードファイルは、あらかじめ<br />\r\n　（ショップ設置ディレクトリ）/download\r\n配下にFTPアップロードしておきます。<br /><br />\r\n\r\n\r\nNOTE3：<br />\r\n「Product - Music」は音楽（・映像）商品に最適化した製品タイプです。<br /><br />\r\n\r\nこの製品タイプで商品登録すると、<br />\r\n・アーティスト<br />\r\n・レコード会社<br />\r\n・音楽ジャンル<br />\r\nなどの情報を扱うことができ、<br /><br />\r\n\r\nさらに、ミュージッククリップ（mp3ファイル等）の割り当てが可能など、一般の製品タイプより柔軟性に富んでいます。<br /><br />\r\n\r\n【オプション属性設定メモ】<br />\r\n■オプション名：\"ソフト本体\"に関し<br />\r\n・[ダウンロード商品ファイル名]：<br />\r\n　-\"Windows(en)版\": win-en.zip<br />\r\n　-\"Windows(jp)版\": win-jp.zip<br />\r\n　-\"Mac(jp)版\"：mac-jp.zip<br />\r\n・[有効期間(日)]：7 （日）<br />\r\n・[最大ダウンロード数]: 5 （回）<br /><br />\r\n\r\n■オプション名：\"マニュアル\"に関して<br />\r\n・[ダウンロード商品ファイル名]：<br />\r\n　-\"PDFファイル\"オプション： pdf_sample.zip<br />\r\n　-\"Wordファイル\" オプション：ms_word_sample.zip<br />\r\n・[有効期間(日)]：7 （日）<br />\r\n・[最大ダウンロード数]: 5 （回）<br /><br />\r\n\r\n\r\nNOTE1：<br />\r\n運営者がこの注文の[注文処理ステータス]を\"完了\"にすると、<br />\r\n注文者のマイページにおいてダウンロードできる状態になります。<br /><br />\r\n\r\nNOTE2：<br />\r\nダウンロードファイルは、あらかじめ<br />\r\n　（ショップ設置ディレクトリ）/download<br />\r\n配下にFTPアップロードしておきます。<br />','',0);
INSERT INTO `products_description` VALUES (223,9,'【2】送料無料・バーチャル商品','[常に送料無料]の設定を\"はい\"にすることで、その商品の重量や価格に関係なく常時送料無料商品になります。さらに[ヴァーチャル商品]の設定も\"はい\"にしたので、注文手続き送付先住所の入力ステップがスキップされます。<br />\r\nオプション重量も無料対象に含まれます。<br /><br />\r\n\r\n【設定メモ】商品情報<br />\r\n・[ヴァーチャル商品]：はい、送付先住所をスキップ<br />\r\n・[常に送料無料]：はい<br />\r\n・[商品重量]：50Kg<br /><br />\r\n\r\n【設定メモ】オプション属性<br />\r\n\"ホワイト\"／\"オレンジ\" の各オプションについて、\r\n・[オプション重量] 100Kg ／ 40Kg','',0);
INSERT INTO `products_description` VALUES (224,9,'【3】送料無料（重量＝０Kgの商品）','【3】送料無料（重量が0Kgの商品）\r\nこれまでの2例では、[常に送料無料]フラグが\"はい\"に設定することにより常時送料無料商品として取り扱われる例を見てきました。<br /><br />\r\nこれに対して、ここでは重量が0である結果として送料が無料になる例を提示します。<br /><br />\r\n\r\nここでの商品重量は0です。またオプションカラー\"ホワイト\"の追加重量も0ですので、ホワイト購入時は送料が無料になります。\r\n※ただしカゴの中に他の送料有料商品が入っていないこと）\r\n\r\n一方\"オレンジ\"のオプション重量は20Kgあります。従って、オレンジ選択時は送料は無料になりません。\r\n\r\n【設定メモ】商品情報\r\n・[常に送料無料]：いいえ、通常送料を適用\r\n・[商品重量]：0（Kg）\r\n\r\n【設定メモ】商品オプション属性\r\n・\"ホワイト\"の[重量]：0（Kg）\r\n・\"オレンジ\"の[重量]：20（Kg）','',0);
INSERT INTO `products_description` VALUES (225,9,'ダウンロード商品例（1ファイル）','これはファイルが1つだけの場合のダウンロード例です。<br />\r\nオプションで選んだファイル形式のファイル1点をダウンロード可能です。<br /><br />\r\n\r\n【設定メモ】商品情報<br />\r\n・[ヴァーチャル商品l]：はい、送付先住所をスキップ<br />\r\n・[常に送料無料]：この商品も前の例と同じく「Product - Music」商品タイプの音楽商品です。<br />\r\n前の例が、CDやDVDのような実体のある商品だけを対象としていたのに対し、この商品は実体のある商品（CD）とダウンロード商品（mp3ファイル）のどちらか選んで購入できる想定です。<br />\r\nmp3ファイルを選んだ場合は、購入後マイページからダウンロードできるようになります。\r\n\r\n【設定メモ】商品情報<br />\r\n・[ヴァーチャル商品l]：はい、送付先住所をスキップ<br />\r\n・[常に送料無料]：特別商品とダウンロード商品のコンビネーションは配送先住所の登録が必要です。<br /><br />\r\n\r\n【オプション属性設定メモ】オプション名：\"ファイル形式\"<br />\r\n・[ダウンロード商品ファイル名]：\r\n　-\"mp3（ダウンロード商品）\" オプションにのみ：ms_word_sample.zip<br />\r\n　-\"CD版\"オプション：（設定しない）<br />\r\n・[有効期間(日)]：7 （日）<br />\r\n・[最大ダウンロード数]: 5 （回）<br /><br />\r\n\r\nNOTE1：<br />\r\n運営者がこの注文の[注文処理ステータス]を\"完了\"にすると、<br />\r\n注文者のマイページにおいてダウンロードできる状態になります。<br /><br />\r\n\r\nNOTE2：<br />\r\nダウンロードファイルは、あらかじめ<br />\r\n　（ショップ設置ディレクトリ）/download\r\n配下にFTPアップロードしておきます。<br /><br />\r\n\r\n\r\nNOTE3：<br />\r\n「Product - Music」は音楽（・映像）商品に最適化した製品タイプです。<br /><br />\r\n\r\nこの製品タイプで商品登録すると、<br />\r\n・アーティスト<br />\r\n・レコード会社<br />\r\n・音楽ジャンル<br />\r\nなどの情報を扱うことができ、<br /><br />\r\n\r\nさらに、ミュージッククリップ（mp3ファイル等）の割り当てが可能など、一般の製品タイプより柔軟性に富んでいます。<br /><br />\r\n\r\n【オプション属性設定メモ】オプション名：\"マニュアル\"<br />\r\n・[ダウンロード商品ファイル名]：<br />\r\n　-\"PDFファイル\"オプション： pdf_sample.zip<br />\r\n　-\"Wordファイル\" オプション：ms_word_sample.zip<br />\r\n・[有効期間(日)]：7 （日）<br />\r\n・[最大ダウンロード数]: 5 （回）<br /><br />\r\n\r\nNOTE1：<br />\r\n運営者がこの注文の[注文処理ステータス]を\"完了\"にすると、<br />\r\n注文者のマイページにおいてダウンロードできる状態になります。<br /><br />\r\n\r\nNOTE2：<br />\r\nダウンロードファイルは、あらかじめ<br />\r\n　（ショップ設置ディレクトリ）/download<br />\r\n配下にFTPアップロードしておきます。<br />','',0);
INSERT INTO `products_description` VALUES (218,9,'【例3】無料商品：送料無料かつ送付先住所入力不要','商品価格が0円（無料商品）で、商品重量は2Kgの商品ですが、バーチャル商品扱いに設定したため、送料無料でお届け先の住所入力をスキップします。<br />これは一見不自然な設定に見えますが、例えばお届け先をユーザ登録住所に限定したい（他の住所は指定できない）場合などの利用が考えられます。<br />なお、同時購入した他の商品すべてがデモ商品であるとき、送料は全く発生しません。<br /><br /><br /><br />【設定メモ】<br /><br />・無料商品： はい<br /><br />・商品価格： 0円<br /><br />・・バーチャル商品：　はい、送付先住所をスキップ<br /><br />・常に送料無料：　いいえ、通常送料を適用<br />','',0);
INSERT INTO `products_description` VALUES (222,9,'【1】常に送料無料','[常に送料無料]の設定を\"はい\"にすることで、その商品の重量や価格に関係なく常時送料無料商品として扱う例です。オプション重量も無料対象に含まれます。<br /><br />\r\n\r\n【設定メモ】商品情報<br />\r\n・[常に送料無料]：はい<br />\r\n・[商品重量]：50Kg<br /><br />\r\n\r\n【設定メモ】オプション属性<br />\r\n\"ホワイト\"／\"オレンジ\" の各オプションについて、\r\n・[オプション重量] 100Kg ／ 40Kg','',0);
INSERT INTO `products_description` VALUES (215,9,'商品ドキュメント（販売商品）の例','これは商品として販売するドキュメントで、商品タイプは[Document - Product]です。<br /><br />\r\n\r\n商品タイプが[Document - General]だった直前の例と異なり、ここにはカゴへ入れるボタンが表示されています。<br />\r\n\r\n商品ドキュメント（販売商品）タイプでは、商品情報の入力項目などは一般商品とかわりありません。しかし、「書類」という特別なサイドボックスに表示されるなど、ドキュメントとして特別扱いされます。','',0);
INSERT INTO `products_description` VALUES (217,9,'送料無料タイプ商品の例','ここでは、商品タイプあるいはカテゴリを[Product - Free Shipping]タイプにした場合のふるまいを説明します。<br /><br />\r\n\r\nこの商品の所属するカテゴリは、[Product - Free Shipping]商品タイプ（以下、送料無料タイプ）限定に設定されています。このカテゴリ配下で新しい商品を登録すると、送料無料タイプの商品として登録されます。<br /><br />\r\n\r\n送料無料タイプの商品は、機能的には一般の商品とかわりませんが、あらかじめ[常に送料無料]フラグが\"はい\"に設定されています。<br /><br /><br />\r\n\r\n送料無料の商品には「送料無料！」マークがついてハイライト表示されます。<br /><br />\r\n\r\n[常に送料無料]フラグが\"はい\"なら、商品重量に関係なく、常に送料無料となります。<br /><br />\r\nなお、配送モジュールの「配送料無料」モジュールを有効にしておくこと。さもないと、カートに入れた送料無料商品の精算ができなくなってしまいます。<br /><br />\r\n\r\nNOTE:<br />\r\n送料無料になるかどうかの判定基準は5lbs（約2Kg強）です。しかし[常に送料無料]フラグが\"はい\"になっていると、そのしきい値にかかわらず送料は無料です。<br /><br />\r\n\r\nNOTE：<br />\r\nLanguage file中の、[ALWAYS_FREE_SHIPPING_ICON] 変数を変更することで、送料無料の時のふるまい（テキストを表示する／イメージ画像を表示／テキストと画像の組み合わせを表示／なにも表示しない）を制御できます。<br /><br />','',0);
INSERT INTO `products_description` VALUES (214,9,'一般ドキュメント（非売品）の例','これは製品タイプを[Document - General]で登録したドキュメントで、今読んでいるこれは[ドキュメントの内容]そのものです。<br /><br />\r\n\r\n[Document - General]に指定されたドキュメントは、カートに入れられません。また、販売商品ではないので、[\r\n商品型番]もありません。<br /><br />\r\n\r\nそのかわりに、「書類」と名付けられた特別なサイドボックスに掲載されます。この商品タイプは、文字通りドキュメントとして、このサイトのオンラインマニュアルやFAQとして使うなどの用途が考えられます。<br /><br />\r\n\r\n■■■■■\r\n\r\n<p>WWW(World Wide Web)は, スイスのCERN(欧州素粒子物理研究所)において, 所内の研究者間の研究成果の共有を支援することを目的として, 1990年に分散形広域ハイパテキストシステムの構築のためのプロジェクトによって設立された。このハイパテキストでは, テキスト又はテキストの集合を分割してノードという単位に分け, ノード内にアンカ(端点)を定義して, アンカ間の関係としてハイパリンクを規定している。</p> \r\n\r\n<p>WWWのプロジェクトができた当初は, CERNにおいて特定マシン上のラインモードブラウザが用意されただけであったが, 1991年にはCERN以外でもWWWの利用が可能になり, Xウィンドウシステム用のブラウザが開発された。1993年になると, イリノイ大学でMOSAICが発表されて文書中の画像表示が可能になり, Windows版に加えてMAC版も発表された。1994年のNetscape Navigatorのリリースは, WWWの爆発的普及のきっかけをつくり, それがさらにインタネット利用者を増やすことになった。 </p>\r\n\r\n<p>CERNでのハイパテキストの構造記述及びその交換手続きは, 開発当初は研究所内の仕様にとどまっていたが, WWWの普及と共にそれらの標準化への意識が高まり, IETF(Internet Engineering Task Force)において, HTML及びHTTP(Hypertext Transfer Protocol)の作業グループが設立されて本格的な標準化作業が開始された。HTML 2.0は, IETF RFC1866[1]として公表され, その後, HTMLの標準化作業は, W3C(World Wide Web Consortium)に移された。 </p>\r\n\r\n<p>W3Cでの初期のHTML改版作業は, ブラウザメーカの独自の拡張を吸収してスタイル指定を含む多くの機能を盛り込む方針で行われた。しかしその後, HTMLを本来の文書論理構造記述の言語に引き戻して, スタイル指定については別の交換様式で対応するという方針が主流となり, HTML 3.2[2], HTML 4.0[3]へと改版されてきた。</p>','',0);
INSERT INTO `products_description` VALUES (212,9,'Russ Tippins Band - The Hunter','「Product - Music」は音楽（・映像）商品に最適化した製品タイプです。<br /><br />\r\n\r\nこの製品タイプで商品登録すると、<br />\r\n・アーティスト<br />\r\n・レコード会社<br />\r\n・音楽ジャンル<br />\r\nなどの情報を扱うことができ、<br /><br />\r\n\r\nさらに、ミュージッククリップ（mp3ファイル等）の割り当てが可能など、一般の製品タイプより柔軟性に富んでいます。','',0);
INSERT INTO `products_description` VALUES (213,9,'Help!','この商品も前の例と同じく「Product - Music」商品タイプの音楽商品です。<br />\r\n前の例が、CDやDVDのような実体のある商品だけを対象としていたのに対し、この商品は実体のある商品（CD）とダウンロード商品（mp3ファイル）のどちらか選んで購入できる想定です。<br />\r\nmp3ファイルを選んだ場合は、購入後マイページからダウンロードできるようになります。<br /><br />\r\n\r\n【設定メモ】商品情報<br />\r\n・[ヴァーチャル商品l]：いいえ、送付先住所の入力は必要<br />\r\n・[常に送料無料]：特別商品とダウンロード商品のコンビネーションは配送先住所の登録が必要です。<br />\r\n・[重量]：0（Kg）　※ダウンロード商品の場合があるためオプション属性側で設定する<br /><br />\r\n\r\n【オプション属性設定メモ】メディアタイプ<br />\r\n■オプション属性＝\"CD\"オプションに対し<br />\r\n・[オプション重量]：1（Kg）<br /><br />\r\n\r\n■オプション属性＝\"mp3（ダウンロード）\"に対し<br />\r\n・[オプション重量]：0（Kg）<br />\r\n・[ダウンロード商品ファイル名]：help.mp3<br />\r\n・[有効期間(日)]：7 （日）<br />\r\n・[最大ダウンロード数]: 5 （回）<br /><br />\r\n\r\nNOTE1：<br />\r\n運営者がこの注文の[注文処理ステータス]を\"完了\"にすると、<br />\r\n注文者のマイページにおいてダウンロードできる状態になります。<br /><br />\r\n\r\nNOTE2：<br />\r\nダウンロードファイルは、あらかじめ<br />\r\n　（ショップ設置ディレクトリ）/download<br />\r\n配下にFTPアップロードしておきます。<br /><br />\r\n\r\n\r\nNOTE3：<br />\r\n「Product - Music」は音楽（・映像）商品に最適化した製品タイプです。<br /><br />\r\n\r\nこの製品タイプで商品登録すると、<br />\r\n・アーティスト<br />\r\n・レコード会社<br />\r\n・音楽ジャンル<br />\r\nなどの情報を扱うことができ、<br /><br />\r\n\r\nさらに、ミュージッククリップ（mp3ファイル等）の割り当てが可能など、一般の製品タイプより柔軟性に富んでいます。','',0);
INSERT INTO `products_description` VALUES (211,9,'【2】ベース価格にオプション価格を含めない','ベース価格、商品価格、オプション価格の関係を理解する（2）<br /><br />\r\n\r\nすぐ直前の【1】とほぼ同じ設定ですが、<br />\r\nおおもとの[商品属性による価格]フラグが\"いいえ\"なので<br />\r\n\"ホワイト\"\"オレンジ\"オプションともに[ベース価格]には[オプション料金]を含みません。<br />\r\n\r\n【設定メモ】商品情報<br />\r\n・[商品価格]：4000円<br />\r\n・[商品属性による価格]：はい<br /><br />\r\n\r\n【設定メモ】\"ホワイト\"<br />\r\n・[属性による価格増減をベース価格に含める]：はい<br />\r\n・[オプション価格]：500円<br /><br />\r\n\r\n【設定メモ】\"オレンジ\"<br />\r\n・[属性による価格増減をベース価格に含める]：はい<br />\r\n・[オプション価格]：1000円<br /><br />\r\n\r\nNOTE:<br />\r\n表示価格（商品名の下に表示されている価格）やベース価格（オプションごと数量割引などの基本額）に含まれないだけで、そのオプション選択時の追加料金としては機能します。','',0);
INSERT INTO `products_description` VALUES (210,9,'【3】ベース価格に含める/ない 混在','ベース価格、商品価格、オプション価格の関係を理解する（2）<br /><br />\r\n\r\n【1】や【2】の例とほぼ同じ設定ですが、<br />\r\n\"ホワイト\"の方は、[属性による価格増減をベース価格に含める]フラグ＝\"いいえ\"に、<br />\r\n一方\"オレンジ\"はフラグ＝\"はい\"のようにオプションによって混在している例です。<br />\r\n\r\n【設定メモ】商品情報<br />\r\n・[商品価格]：4000円<br />\r\n・[商品属性による価格]：はい<br /><br />\r\n\r\n【設定メモ】\"ホワイト\"<br />\r\n・[属性による価格増減をベース価格に含める]：いいえ<br />\r\n・[オプション価格]：500円<br /><br />\r\n\r\n【設定メモ】\"オレンジ\"<br />\r\n・[属性による価格増減をベース価格に含める]：はい<br />\r\n・[オプション価格]：1000円<br /><br />\r\n\r\nNOTE:<br />\r\n表示価格（商品名の下に表示されている価格）には、通常ベース価格の最小値が表示されます。しかし、ホワイトは[属性による価格増減をベース価格に含める]フラグが\"いいえ\"なので対象からはずれて、オレンジのベース価格が表示されます。','',0);
INSERT INTO `products_description` VALUES (209,9,'【1】ベース価格＝商品価格＋オプション価格','ベース価格、商品価格、オプション価格の関係を理解する（1）<br /><br />\r\n\r\nベース価格は、オプションごとの数量割引や、プライスファクターを適用する際の基準額として使われます。<br /><br />\r\n\r\nベース価格は、\r\n<ul>\r\n <li>[商品属性による価格]フラグ　※商品情報の設定（1商品全体に影響する）</li>\r\n <li>[属性による価格増減をベース価格に含める]フラグ　※オプション属性ごとの設定（そのオプションだけに影響する）</li>\r\n</ul>\r\nの2フラグの状態が影響します。関係を表にすると・・・<br /><br />\r\n\r\n<table border=\"1\">\r\n  <tr>\r\n    <th width=\"20%\">[商品属性による価格]</th>\r\n   <td colspan=\"2\" width=\"60%\"><b>\"はい\"</b></td>\r\n   <td width=\"20%\"><b>\"いいえ\"</b></td>\r\n  </tr>\r\n  <tr>\r\n   <th>[属性による価格増減をベース価格に含める]</th>\r\n   <td width=\"40%\"><b>\"はい\"</b></td>\r\n   <td width=\"20%\">\"いいえ\"</td>\r\n   <td>\"</td>\r\n  </tr>\r\n  <tr>\r\n   <th>[ベース価格]</th>\r\n   <td style=\"background:#E6E68A;\">＝[商品価格]＋[オプション価格]</td>\r\n   <td colspan=\"2\" style=\"background:#E6E68A;\">＝[商品価格]</td>\r\n  </tr>\r\n  <tr>\r\n   <th>表示価格の対象？</th>\r\n   <td style=\"background:#E6E68A;\">YES（ベース価格中最小値なら表示される）</td>\r\n   <td colspan=\"2\" style=\"background:#E6E68A;\">表示対象外</td>\r\n  </tr>\r\n</table>\r\n<br />\r\nここでは、どちらのフラグも\"はい\"の例を提示します。<br /><br />\r\n\r\n【設定メモ】商品情報<br />\r\n・[商品価格]：4000円<br />\r\n・[商品属性による価格]：はい<br /><br />\r\n\r\n【設定メモ】\"ホワイト\"<br />\r\n・[属性による価格増減をベース価格に含める]：はい<br />\r\n・[オプション価格]：500円<br /><br />\r\n\r\n【設定メモ】\"オレンジ\"<br />\r\n・[属性による価格増減をベース価格に含める]：はい<br />\r\n・[オプション価格]：1000円<br /><br />\r\n\r\nNOTE:<br />\r\n表示価格（商品名の下に表示されている価格）には、ベース価格の最小値が表示されます。ホワイトのベース価格の方がオレンジより小さいので、ホワイトの値が表示されているわけです。','',0);
INSERT INTO `products_description` VALUES (208,9,'【3】カラーで割引条件が異なるワンタイム数量割引例','[オプションのワンタイム数量値引設定]を使う例です。<br />\r\n前の2例で扱った[オプションの数量値引設定]が単価に作用する値引きだったのに対して、ここで扱う[オプションのワンタイム数量値引設定]は、1回の注文あたりにかかる値引きである点が異なります。<br /><br />\r\n\r\nつまり、<br />\r\n商品価格が1000円、10個以上買ったら100円引きしたいときに<br />\r\n\r\n[オプションの数量値引設定] で設定した場合：<br />\r\n　　購入価格[10個分]＝（1000円 \" 100円）×10個 ＝9000円<br />\r\n　　※単価が900円になる。<br /><br />\r\n　\r\nですが、同じことを<br />\r\n[オプションのワンタイム数量値引設定]で設定した場合：<br />\r\n　　購入価格[10個分]＝ （1000円 × 10個）\"100円 ＝ 9900円<br />\r\n　　※単価は変化せず、合計から100円引かれる<br /><br />\r\n\r\nという結果になります。<br />\r\nなお、数量のしきい値、割引額をオプションごとに独立して設定できる点などは同じです。<br /><br /><br />\r\n\r\n<strong>オプションのワンタイム数量値引設定の書式</strong><br />\r\n[しきい値 N:値引き額 D] をワンセットとして、必要セット分だけ「,（半角カンマ）」で繋ぎます。<br /><br />\r\n\r\n書式　　N0:D0, N1:D1, N2:D2・・, N(n-1):D(n-1), Nn:Dn<br /><br />\r\n意味　10N0個まで： D0円引き<br />\r\n　　　N10N2個まで： D1円引き<br />\r\n　　　：<br />\r\n　　　：<br />\r\n　　　N(n-1)0Nn個まで： D(n-1)円引き<br />\r\n　　　N(n-1)+1個以上： Dn円引き<br /><br />\r\n\r\n※n=1,2,・・・,Nの自然数。最後のセットのNnの指定値に意味はなく、Dnは常にN(n-1)+1個以上の時の値引額として扱われる。<br /><br />\r\n\r\n【実例1】\"ホワイト\"<br />\r\n[オプションのワンタイム数量値引設定]　9:-0,10:-1000,11:-4000<br />\r\n意味：　09点までは値引き0、10点なら合計から1000円引き、11点以上では4000円を合計から引く<br /><br />\r\n\r\n【実例1】\"オレンジ\"<br />\r\n[オプションのワンタイム数量値引設定]　19:-0,20:-5000<br />\r\n意味：　019点までは値引き0、20点以上買うと合計から5000円引き<br /><br />\r\n\r\nNOTE：<br />\r\nDの値は頭に「-」をつけて-100なら100円引きに、「+」をつけて+100となら100円増しになる。','',0);
INSERT INTO `products_description` VALUES (207,9,'【3】ワンタイムプライスファクターとオフセット','前の例ではプライスファクターとオフセットを使ったパッケージ販売の例をお見せしました。今度は名前は似ていますが、1注文あたりにかかる料金としてワンタイムプライスファクターとオフセットについて説明します。<br /><br />\r\n\r\n通常のプライスファクター／オフセットと、ワンタイム0の違いは、<br />\r\n　・追加分が商品単価に加算されるか（プライスファクター。N個買えばN倍かかる）、<br />\r\n　・注文1回あたりだけに加算されるか（ワンタイム0。何個買っても追加分は1注文あたり一定額）<br />\r\nという点です。<br /><br />\r\n\r\nここでもTシャツを販売します。「ギフト包装」オプションがあって、これは個別包装ではなく（何枚買っても）1個口でラッピングするものとします。つまり1注文あたり1ラッピングということで、このオプションの追加費用として商品1個の値段の20％いただくことにしました。これをワンタイムプライスファクターで実現します。<br /><br /><br />\r\n\r\n\r\n【設定メモ】商品情報<br />\r\n・[商品価格]：4000 円<br />\r\n・[商品属性による価格]： はい　※1<br /><br />\r\n\r\n【設定メモ】ギフトオプション<br />\r\n・[オプション価格]： 0円<br />\r\n・[ワンタイムプライスファクター]： 0.3 <br />\r\n・[ワンタイムオフセット]： 0.1<br />\r\n・[属性による価格増減をベース価格に含める]： はい　※2<br /><br />\r\n\r\n<strong>NOTE： ワンタイムプライスファクターおよびワンタイムオフセットについて</strong><br />\r\nワンタイムプライスファクター／オフセットは、オプション選択時の追加料金に次のように作用します。<br /><br />\r\n\r\n　<strong>オプション選択時の購入単価（商品1点あたり）<br />\r\n　＝ [商品価格] ＋ [オプション価格]</strong><br /><br />\r\n\r\n　この他に、1注文あたりかかる料金があって・・・<br />\r\n　<strong>オプション選択時の追加料金（1注文あたり）<br />\r\n　　 [ベース価格] ×（[ワンタイムプライスファクター]\"[ワンタイムオフセット]）</strong><br /><br />\r\n\r\n　ただし、上記※1,2のフラグの状態で[ベース価格]が変わり、\r\n<ul>\r\n<li>2フラグともに \"はい\" なら・・<br />\r\n[ベース価格] ＝ [商品価格]＋[オプション価格]</li>\r\n<li>いずれか、あるいは両方 \"いいえ\" なら・・<br />\r\n[ベース価格] ＝ [商品価格]</li>','',0);
INSERT INTO `products_description` VALUES (206,9,'【2】プライスファクターとオフセット：パッケージ販売','前の例ではプライスファクターに1以下の値（価格の5％等）を使いましたが、今度はパッケージ販売を例にとって大きな整数値を使う例をお見せしましょう。この例ではオフセットも併せて利用します。<br /><br />\r\n\r\n業者向けにTシャツをパッケージ販売する想定です。商品名の下には内包物（Tシャツ）1枚の価格が表示されますが、実際の注文は1パック100枚入りをパッケージ数で注文してもらいます。1パックの料金はTシャツ100枚分です。<br /><br />\r\n\r\nここでは、この1パックあたりの値段をオプション料金（＝Tシャツ単価）、プライスファクター（セット枚数）とオフセット（無料サービス分）を使って設定します。<br /><br />\r\n\r\n【設定メモ】商品情報<br />\r\n・[商品価格]：0 円<br />\r\n・[商品属性による価格]： はい　※1<br /><br />\r\n\r\n【設定メモ】「業務用パック（100枚入り）」オプション<br />\r\n・[オプション価格]： 4000円<br />\r\n・[プライスファクター]： 100 <br />\r\n・[オフセット]： 1<br />\r\n・[属性による価格増減をベース価格に含める]： はい　※2<br /><br />\r\n\r\n<strong>NOTE： プライスファクターについて</strong><br />\r\nプライスファクターやオフセットは、オプション選択時の追加料金に次のように作用します。<br /><br />\r\n\r\n　<strong>オプション選択時の購入単価（商品1点あたり）<br />\r\n　＝ [商品価格] ＋ [オプション価格]  <br />\r\n　　＋ [ベース価格] ×（[プライスファクター]\"[オフセット]）</strong><br /><br />\r\n\r\n　ただし、上記※1,2のフラグの状態で[ベース価格]が変わり、\r\n<ul>\r\n<li>2フラグともに \"はい\" なら・・<br />\r\n[ベース価格] ＝ [商品価格]＋[オプション価格]</li>\r\n<li>いずれか、あるいは両方 \"いいえ\" なら・・<br />\r\n[ベース価格] ＝ [商品価格]</li>\r\n</ul>\r\n\r\n\r\n<strong>※オフセット値について</strong><br />\r\nこの設定例をみて、「なんでオフセットを1にするんだろう？」と思いませんでしたか？前述の「オプション選択時の追加料金」の式を注意して見て欲しいのですが、プライスファクターで100倍している他に、式の1行目でもう1点分の価格（＝[商品価格] ＋ [オプション価格]）  が加算されていますよね。このままでは101点分の料金になってしまい具合が悪いので、オフセット側で余分な1点分をキャンセルしているのです。<br />\r\n応用例として、上記例で100枚のうち5枚分の料金は無料サービスにするなら、[オフセット]＝\"6\" （キャンセル1＋無料サービス5）となります。<br /><br />\r\n\r\n<strong>NOTE： 在庫の増減について</strong><br />\r\n在庫の増減について注意して欲しいのは、この例ですと1パッケージ購入したら、在庫の減り方としては1（パッケージ）分であって、100枚分（内包物の個数）ではないということです。<br />\r\nもし在庫数を内包物ベースで管理したいのであれば、プライスファクターではなく、[商品の数量単位]を100にする方法（こうすると100単位でしか注文できない）がベターかもしれません。','',0);
INSERT INTO `products_description` VALUES (203,9,'【OP1】100個単位でご注文ください（オプション混在OK）','これは、商品オプションありの場合の[商品の数量単位]設定例です。<br />\r\nこの例では、オプションの組み合わせがどうあれ、最終的にこの商品合計点数が単位数量の倍数であれば購入可能です。<br />\r\nつまり、ホワイト50コカゴに入れ、続いてブルーを50コカゴに入れた時点で合計100コと見なされて購入可能となります。<br /><br />\r\n\r\n【設定メモ：商品情報】<br />\r\n・[商品の数量単位]：　100<br /><br />\r\n\r\n【設定メモ：商品価格の管理】<br />\r\n・最低量とユニット量を組み合わせて適応する：　はい','',0);
INSERT INTO `products_description` VALUES (204,9,'【OP2】1オプションあたり100個単位でご注文ください','これは、商品オプションありの場合の[商品の数量単位]設定例です。<br />\r\nこの例では、1つのオプションあたりの購入数でカウントし、同じオプションで単位数量の倍数でないとと決済に進めません。<br />\r\nつまり、ホワイトとブルーを50コずつカゴに入れてもダメで、ホワイトあるいはブルー単体で100個とか200個ではじめて購入可能となります。<br /><br />\r\n\r\n【設定メモ：商品情報】<br />\r\n・[商品の数量単位]：　100<br /><br />\r\n\r\n【設定メモ：商品価格の管理】<br />\r\n・最低量とユニット量を組み合わせて適応する：　いいえ','',0);
INSERT INTO `products_description` VALUES (205,9,'【1】プライスファクター：ティーカップ（保証サービスあり）','プライスファクターの例です。<br />\r\nティーカップを販売します。このティーカップには、商品価格の何％かを追加で払うと購入後の一定期間、割れ・欠け時に無償交換してくれる「保証サービス」が用意されています。ここでは、この保証サービスを、プライスファクターを使って設定します。<br /><br />\r\n\r\n【設定メモ】商品情報<br />\r\n・[商品価格]：20000 円<br />\r\n・[商品属性による価格]： はい　※1<br /><br />\r\n\r\n【設定メモ】「5年保証」オプション<br />\r\n・[オプション価格]： 0円<br />\r\n・[プライスファクター]： 0.05 　※ベース価格の5％<br />\r\n・[属性による価格増減をベース価格に含める]： はい　※2<br /><br />\r\n\r\n【設定メモ】「20年保証」オプション<br />\r\n・[プライスファクター]： 0.15 　※ベース価格の15％<br />\r\n・他の設定は「5年保証」オプションと同じ。<br /><br /><br />\r\n\r\n<strong>NOTE： プライスファクターについて</strong><br />\r\nプライスファクターやオフセットは、オプション選択時の追加料金に次のように作用します。<br /><br />\r\n\r\n　<strong>オプション選択時の追加料金<br />\r\n　＝ [オプション価格] ＋  <br />\r\n　　 [ベース価格] ×（[プライスファクター]\"[オフセット]）</strong><br /><br />\r\n\r\n　ただし、上記※1,2のフラグが両方とも\"はい\"なら<br />\r\n　[ベース価格] ＝ [商品価格]＋[オプション価格]<br /><br />\r\n\r\n　どちらか（あるいは両方）が\"いいえ\"なら<br /><br />\r\n　[ベース価格] ＝ [商品価格]\r\n\r\n\r\n※この例では1と2のフラグは、両方\"はい\"にしましたが、もともとオプション価格を0円としているので\r\n実際は\"はい\"でも\"いいえ\"でも同じ結果になります。<br />','',0);
INSERT INTO `products_description` VALUES (200,9,'【2】お一人さま1点限り！（数量入力欄非表示）','注文1回あたりの購入数を最大1個に設定すると、数量入力欄は非表示になり、1点ずつしかカートに追加できなくなります。<br /><br />\r\n\r\n【設定メモ】<br />\r\n・商品の最小数量：　1<br />\r\n・商品の最大数量：　1<br />\r\n・商品の数量単位：　1<br /><br />','',0);
INSERT INTO `products_description` VALUES (201,9,'【1】100個単位でご注文ください','これは、「100個単位でご注文ください」のように、ユニット単位の販売を行いたい場合の設定例です。<br /><br />\r\n\r\n【設定メモ：商品情報】<br />\r\n・[最小購入数]：　100　※<br />\r\n・[数量単位]： 100<br /><br />\r\n\r\n※この例において[最小購入数]設定は必須ではないが、どのみち100個ずつ売りたいので一応設定しておく','',0);
INSERT INTO `products_description` VALUES (202,9,'【2】2000個以上＆100個単位でご注文ください','これは、100個単位で、かつ最低でも2000個以上からの注文だけ受けたいなどのケースを想定した例です。卸販売や大量購入を対象とした販売などで役に立つと思います。<br /><br />\r\n\r\n【設定メモ：商品情報】<br />\r\n・[最小購入数]：　2000<br />\r\n・[数量単位]： 100<br /><br />\r\n\r\nNOTE：<br />\r\nさらに[最大購入数]を設定しておくと、注文の上限を制限できる。<br />','',0);
INSERT INTO `products_description` VALUES (199,9,'【OT2】ワンタイム割\"増\"例：1注文につき初期費用を加算','ワンタイム割引機能は、使い方次第では初期費用的な使い方もできます。<br />\r\nここで初期費用と言っているのは、「注文個数にかかわらず1回の注文あたり1度だけかかる料金」という意味です。<br /><br />\r\n\r\nかなり応用問題ですが、ワンタイム割引機能＋オプション属性の数量割引を使ったTシャツのオリジナルプリントの例をおみせしましょう。<br /><br />\r\n\r\nこの例は、無地Tシャツにロゴや社名などのオリジナルプリントを加工する、いわゆる\"チームTシャツ\"商品です。料金は以下のように決まります、\r\n<ul>\r\n<li>プリント原版代（版下代）がかかります。インクの色数だけで決まり注文数によりません。</li>\r\n<li>そのほかにTシャツ1枚あたりのプリント代（加工代）がかかります。これもインクの色数で単価が違い、さらに注文数がおおければ単価がさがります。</li>\r\n<li>もちろん、Tシャツ本体の値段が別途かかります</li>\r\n</ul>\r\n\r\n【設定メモ】商品情報<br />\r\n・[商品価格]：　4000円　※Tシャツ本体の価格。<br /><br />\r\n\r\n【設定メモ】オプション属性<br />\r\n[オプション値]／[オプション価格]／[ワンタイム値引の値引金額]／[オプションの数量値引設定]　の順に<br />\r\n・プリント1色　／+ 600 ／ +10000 ／49:-0,50:-200,100:-300<br />\r\n・プリント2色　／+ 700 ／ +20000 ／49:-0,50:-200,100:-300<br />\r\n・プリント3色　／+ 800 ／ +30000 ／49:-0,50:-200,100:-300<br /><br />\r\n\r\nNOTE：<br />\r\n・[商品価格]＝無地Tシャツ代<br />\r\n・[オプション価格]＝加工代<br />\r\n・[ワンタイム値引の値引金額]＝プリント原版代<br />\r\nにあたります。<br /><br />\r\n\r\nワンタイム割引は頭に\"+\"がつけば割増（今回の例）に、\"-\"がつけば割引（【1】の例）として機能します。','',0);
INSERT INTO `products_description` VALUES (198,9,'【OT1】ワンタイム割引例：1注文につき500円引き！','オプション属性の[ワンタイム割引]機能を使って、同一商品同一カラーを規定量以上なら「1注文あたり500円引き」を実現する例です。この割引はオプションごとの設定なので、カラーごとに割引額を変えることも可能です。<br /><br />\r\n\r\n【設定メモ】商品情報<br />\r\n・[商品属性による価格]：はい<br />\r\n・[商品価格 (ネット)]：0円<br /><br />\r\n\r\n【オプション設定メモ】\"ホワイト\"<br />\r\n・[オプションの価格]：4000円<br />\r\n・[属性による価格増減をベース価格に含める]：はい<br />\r\n・[ワンタイム値引の値引金額]　-500（円）　※頭に\"-\"をつけること<br /><br />\r\n\r\n【オプション設定メモ】\"オレンジ\"<br />\r\n・[オプションの価格]：5000円<br />\r\n・[属性による価格増減をベース価格に含める]：はい<br />\r\n・[ワンタイム値引の値引金額]　-500（円）　※頭に\"-\"をつけること<br /><br /><br />\r\n\r\n<strong>NOTE1：　[商品属性による価格]：はい　の意味</strong><br /><br />\r\n商品名の下に表示される値段 ＝ [商品価格] ＋ [オプション価格（の最安値)] になります。<br />\r\nここが「いいえ」だと、[商品価格]だけが表示されます（商品価格＝0円の時は表示自体省略）。<br />\r\n今回の例だと、オプション価格の最安値はホワイトの4000円なので、商品名の下に表示される値段 ＝0円＋4000円の結果として4000円と表示されているわけです。<br /><br /><br />\r\n\r\n<strong>NOTE2：[属性による価格増減をベース価格に含める]：はい　の意味</strong><br /><br />\r\nこれが\"いいえ\"のオプションは、たとえそのオプション料金がオプション間で最安値だったとしても<br />\r\nNOTE1で説明した、<br />\r\n　商品名の下に表示される値段 ＝ [商品価格] ＋ [オプション価格（の最安値)] 　<br />\r\nの値としては使われません。<br /><br /><br />','',0);
INSERT INTO `products_description` VALUES (197,9,'【2】カラーで通常価格も数量割引条件も異なる例','オプションごとにボリュームディスカウントの割引条件が異なる設定例です。<br />\r\n直前の【1】の例と異なるのは、【1】では商品価格側に基本価格分を持たせ、オプション属性では数量割引分だけを担当させていたのに対し、この例では、商品価格を0として、オプション料金側で価格をセットしている点です。<br />\r\n違いがわかるよう、ホワイトの定価（数量割引適用前オプション料金）を4000円、オレンジを5000円にしてあります。<br />\r\n\r\n数量割引額は、【1】と同じ設定になっていて、<br />\r\nホワイトの購入個数が9点以下なら値引なしで、10点なら＠100円引き、11点以上なら＠200円引きです。<br />\r\n対するオレンジの方は、19点までは割引なしで、20点以上なら＠150円引きになります。<br /><br />\r\n\r\n各オプション属性の[オプションの数量値引設定]の書式については【1】で説明していますのでご覧ください。<br /><br />\r\n\r\n\r\n【設定メモ】商品情報<br />\r\n・[商品属性による価格]：はい<br />\r\n・[商品価格 (ネット)]：0円<br /><br />\r\n\r\n【オプション設定メモ】\"ホワイト\"<br />\r\n・[オプションの価格]：4000円<br />\r\n・[属性による価格増減をベース価格に含める]：はい<br />\r\n・[オプションの数値値引設定]　9:-0,10:-100,11:-200<br />\r\n　意味：　09点までは値引き0、10点は＠100円引き、11点以上で＠200円引き<br /><br />\r\n\r\n【オプション設定メモ】\"オレンジ\"<br />\r\n・[オプションの価格]：5000円<br />\r\n・[属性による価格増減をベース価格に含める]：はい<br />\r\n・[オプションの数値値引設定]　19:-0,20:-150<br />\r\n　意味：　019点までは値引き0、20点以上買うと＠150円引き<br /><br /><br />\r\n\r\n<strong>NOTE1：　[商品属性による価格]：はい　の意味</strong><br /><br />\r\n商品名の下に表示される値段 ＝ [商品価格] ＋ [オプション価格（の最安値)] になります。<br />\r\nここが「いいえ」だと、[商品価格]だけが表示されます（商品価格＝0円の時は表示自体省略）。<br />\r\n今回の例だと、オプション価格の最安値はホワイトの4000円なので、商品名の下に表示される値段 ＝0円＋4000円の結果として4000円と表示されているわけです。<br /><br /><br />\r\n\r\n<strong>NOTE2：[属性による価格増減をベース価格に含める]：はい　の意味</strong><br /><br />\r\nこれが\"いいえ\"のオプションは、たとえそのオプション料金がオプション間で最安値だったとしても<br />\r\nNOTE1で説明した、<br />\r\n　商品名の下に表示される値段 ＝ [商品価格] ＋ [オプション価格（の最安値)] 　<br />\r\nの値としては使われません。','',0);
INSERT INTO `products_description` VALUES (195,9,'【2】複数の商品画像を掲載(紹介文中にHTML直書き）','[商品説明]欄に＜img＞タグを直書きする方法もアリです。<br /><br />\r\n\r\nこの方法は、\r\n<ul>\r\n<li>紹介文の途中に画像を埋め込め、キャプションを添えることもできるなどレイアウトの自由度が高い</li>\r\n<li>画像名がバラバラだったり、拡張子が異なる画像でも扱える</li>\r\n<li><a href=\"http://www.flickr.com/\">Flickr</a>にアップした画像や、<a href=\"http://www.youtube.com\">YouTube</a>上の動画を掲載することもできる</li>\r\n</ul>\r\nなどのメリットがあります。<br />ただし、HTMLを知らない人にとっては厳しいかもしれません。<br /><br />\r\n\r\n＜img src=\"画像のURL\" alt=\"画像の説明\" /＞を書けばその画像が表示されます。<br /><br />\r\n【例】<br />\r\n<img src=\"http://okra.ark-web.jp/~shinchi/zenc/images/samples/IMAGE2_related.jpg\" alt=\"このTシャツのモデル猫『こまる』です\" /><br />\r\nこのTシャツでも使われている、当ショップ自慢のモデル猫『こまる』です。後ろ姿もかわいいでしょ（*^o^*）b','',0);
INSERT INTO `products_description` VALUES (196,9,'【1】カラーで割引条件が異なる数量割引例','オプションごとにボリュームディスカウントの割引条件が異なる設定例です。<br />\r\n数量のしきい値、割引額をオプションごとに独立して設定できます。<br /><br />\r\n\r\nこの例では、ホワイトの購入個数が9点以下なら値引なしで、10点なら＠100円引き、11点以上なら＠200円引きです。<br />\r\n対するオレンジの方は、19点までは割引なしで、20点以上なら＠150円引きになります。<br /><br /><br />\r\n\r\n<strong>オプションの数量値引設定の書式</strong><br />\r\n[しきい値 N:値引き額 D] をワンセットとして、必要セット分だけ「,（半角カンマ）」で繋ぎます。<br /><br />\r\n\r\n書式　　N0:D0, N1:D1, N2:D2・・, N(n-1):D(n-1), Nn:Dn<br /><br />\r\n意味　10N0個まで： D0円引き<br />\r\n　　　N10N2個まで： D1円引き<br />\r\n　　　：<br />\r\n　　　：<br />\r\n　　　N(n-1)0Nn個まで： D(n-1)円引き<br />\r\n　　　N(n-1)+1個以上： Dn円引き<br /><br />\r\n\r\n※n=1,2,・・・,Nの自然数。最後のセットのNnの指定値に意味はなく、Dnは常にN(n-1)+1個以上の時の値引額として扱われる。<br /><br />\r\n\r\n【実例1】\"ホワイト\"<br />\r\n[オプションの数値値引設定]　9:-0,10:-100,11:-200<br />\r\n意味：　09点までは値引き0、10点は＠100円引き、11点以上で＠200円引き<br /><br />\r\n\r\n【実例1】\"オレンジ\"<br />\r\n[オプションの数値値引設定]　19:-0,20:-150<br />\r\n意味：　019点までは値引き0、20点以上買うと＠150円引き<br /><br />\r\n\r\nNOTE：<br />\r\nDの値は頭に「-」をつけて-100なら100円引きに、「+」をつけて+100となら100円増しになる。','',0);
INSERT INTO `products_description` VALUES (193,9,'【OP2】画像付きオプションの例','画像付き商品オプションの例その2です。<br />\r\nこれは、商品オプション属性の見本画像に、画像ファイルを指定することで実現できます。<br /><br />\r\n\r\nこの例は、「素材とお手入れ方法」（READ ONLYタイプの商品オプションを使用）に関して、洗濯表示とアイロンの温度の2オプションを画像付きにしています。<br />\r\n\r\n【設定メモ】商品オプション属性<br />\r\n※[オプション値]＝\"洗濯機0\"、および  ”アイロンは0” に対してそれぞれ下記の見本画像を指定する。<br />\r\n・[属性の見本画像]： ※あらかじめ用意した見本画像のファイル（ここからアップロードできる）<br />\r\n・[属性の見本画像ディレクトリ]： \"attributes\" <br /><br />','',0);
INSERT INTO `products_description` VALUES (194,9,'【1】複数の商品画像を掲載（自動掲載）','メインの画像の他に関連画像を何点か掲載したい場合がありますよね。<br />\r\nそんな時に最も簡単なのがこの方法で、一定のルールで画像ファイルを命名してFTPしておけば自動掲載されます。<br />\r\n→この説明文の一番下に画像が3点掲載されています！<br /><br />\r\n\r\n【ルール】<br />\r\n・2点目以降の画像ファイル名＝[メイン画像ファイル名]＋[枝番(_xx）]＋[.同じ拡張子] でつける<br />\r\n・メイン画像と同じディレクトリにアップロードする<br />\r\n・2点目以降の画像掲載順は、枝番の小さい順になる<br /><br />\r\n\r\n【例】商品情報の管理で<br />\r\n・[商品画像]が[IMAGE1.jpg] <br />\r\n・[アップロード先ディレクトリ]：　”samples”を選択<br />\r\nとした場合は、<br /><br />\r\n\r\n2点目以降の画像<br />\r\n　IMAGE1_01.jpg<br />\r\n　IMAGE1_02.jpg<br />\r\n　IMAGE1_03.jpg<br />\r\n　・・・<br />\r\nを、（ショップ設置ディレクトリ）/images/samples/　配下にFTPすればよい。<br /><br />\r\n\r\nNOTE：<br />\r\n枝番付きの画像が自動掲載されるということは、逆に言えば、ある商品Aの画像ファイル名が、たまたま別の商品Bの画像名_xxになっていたら、商品Bのページに自動掲載されてしまうということを意味します。<br /><br />\r\nこれを避けるためにも、メイン画像についても命名ルールをよく考えて決めましょう。おすすめは、商品型番と同じにしておくことです（通常商品型番は、商品ごとに固有でしょうから）。どの商品の画像かもわかりやすく一石二鳥です。','',0);
INSERT INTO `products_description` VALUES (191,9,'商品価格を税込み（内税）で管理する例(2)','こちらは、商品価格を内税（税込み価格）で管理する例です。<br />\r\n内税の場合、2つのやり方があります（前の例と比べてみてください）。<br />\r\nこのケースでは税種別を「消費税」にしています。商品価格（グロス）の方に内税価格を入力します。<br /><br />\r\n\r\n\r\n[税種別]を消費税に指定し、商品価格（グロス）に内税価格を入力すると、商品価格（ネット）には自動計算された税抜き価格が入ります。ショップ側に表示されるのは商品価格（グロス）の方なのでつまり内税価格が表示されるというわけです。オプション価格は設定値に消費税分が上乗せされて表示されるので注意してください。<br /><br />\r\n\r\n\r\n【設定メモ】内税で管理する：<br />\r\n・[税種別]：　-- 消費税 --<br />\r\n・[商品価格（グロス）]：10000円 （税込み価格を入力する）<br /><br />\r\n\r\n【設定メモ】商品オプション属性<br />\r\n・[オプション価格] レッド（＋0/追加料金なし）、ホワイト（＋1000円）、イエロー（＋2000円）','',0);
INSERT INTO `products_description` VALUES (192,9,'【OP1】画像付きオプションの例','画像付き商品オプションの例です。ここでは、2色あるカラー（商品オプション属性）のそれぞれに、画像を添えて表示しています。<br /><br />\r\nこれは、商品オプション属性の見本画像に、画像ファイルを指定することで実現できます。<br />\r\n\r\n【設定メモ】商品オプション属性<br />\r\n※各[オプション値]に対して<br />\r\n　・[属性の見本画像]： 画像ファイル（ここからアップロード可）<br />\r\n　・[属性の見本画像ディレクトリ]： \"attributes\" <br /><br />\r\n\r\n【参考】オプション名<br />\r\n・[オプション名]：　カラー<br />\r\n・[オプションのタイプ]：　RADIO<br />\r\n※ただし見本画像表示はタイプに依らず可能<br /><br />\r\n\r\nNOTE：<br />\r\nなお、要素（ラジオボタン）、オプション名、見本画像の配置関係は、管理メニューの商品の管理＞オプション名の管理から目的のオプション名の[編集]にて<br />\r\n・列(Row)あたりの属性画像<br />\r\n・ラジオボタン・チェックボックスの属性スタイル<br />\r\nの設定で変えることができます。','',0);
INSERT INTO `products_description` VALUES (184,9,'【OP1】オプション問わず合計10個以上で販売','これは、商品オプションありの場合の最小購入数設定例です。<br />\r\nこの例では、オプションをいろいろ取り混ぜてよく、この商品の合計が最小購入数以上であれば（個々のオプション選択がなんであれ）購入可能です。<br />\r\nつまり、ホワイト5コカゴに入れ、続いてブルーを5コカゴに入れた時点で合計10コと見なされて購入可能となります。<br /><br />\r\n\r\n【設定メモ：商品情報】<br />\r\n・最小購入数：　10<br /><br />\r\n\r\n【設定メモ：商品価格の管理】<br />\r\n・最低量とユニット量を組み合わせて適応する：　はい','',0);
INSERT INTO `products_description` VALUES (185,9,'【OP2】1オプションあたり10個以上で販売','これは、商品オプションありの場合の最小購入数設定例です。<br />\r\nこの例では、1つのオプションあたりの購入数でカウントし、同じオプションで最小購入数に達しないと決済に進めません。<br />\r\nつまり、ホワイトとブルーを5コずつカゴに入れてもダメで、ホワイトあるいはブルー単体で10個以上ではじめて購入可能となります。<br /><br />\r\n\r\n【設定メモ：商品情報】<br />\r\n・最小購入数：　10<br /><br />\r\n\r\n【設定メモ：商品価格の管理】<br />\r\n・最低量とユニット量を組み合わせて適応する：　いいえ','',0);
INSERT INTO `products_description` VALUES (187,9,'【1】お一人さま5点まで！','これは、「お一人さま5点まで！」など、注文1回あたりの購入数を制限したい場合の設定例です。<br /><br />\r\n\r\n【設定メモ】<br />\r\n・商品の最小数量：　1<br />\r\n・商品の最大数量：　5<br />\r\n・商品の数量単位：　1<br /><br />','',0);
INSERT INTO `products_description` VALUES (188,9,'【OP1】カラーを問わず全部で5点まで！','これは、商品オプションありの場合の最大購入数設定例です。<br />\r\nこの例では、オプションにかかわらず、この商品は全部で5点までしか購入できません。<br />\r\nつまり、ホワイトとイエローで計5コカゴに入っていたら、いったん精算しないかぎり追加はできません。<br /><br />\r\n\r\n【設定メモ：商品情報】<br />\r\n・最小購入数：　1<br />\r\n・最大購入数：　5<br />\r\n\r\n【設定メモ：商品価格の管理】<br />\r\n・最低量とユニット量を組み合わせて適応する：　はい','',0);
INSERT INTO `products_description` VALUES (189,9,'【OP2】1オプションあたり5点まで！','これは、商品オプションありの場合の最大購入数設定例です。<br /><br />\r\nこの例では、各オプションは独立で扱われ、それぞれについて5点まで購入することができます。<br />\r\nつまり、ホワイト5コをカゴに入れたら、ホワイトはもう追加できませんが、他の色（ブルーやイエロー）なら購入可能です。<br /><br />\r\n\r\n【設定メモ：商品情報】<br />\r\n・最小購入数：　1<br />\r\n・最大購入数：　5<br />\r\n【設定メモ：商品価格の管理】<br />\r\n・最低量とユニット量を組み合わせて適応する：　いいえ','',0);
INSERT INTO `products_description` VALUES (190,9,'商品価格を税抜き（外税）で管理する例','商品価格を外税（税抜き価格）で管理する例です。<br /><br />\r\n\r\n表示価格には、管理サイト側で入力した商品価格に消費税分を上乗せしたものが表示されます。オプション料金にも同じように適用します。<br /><br />\r\nなお消費税分は、あらかじめショップ全体の設定値として設定したものが使われます（デフォルトで5％になっています）。<br /><br />\r\n\r\n・メリット：\r\n　消費税分が自動で上乗せされるので、運営側では税抜き価格で管理できる。また、消費税率が変わった時に、ショップ全体の税率設定値を変更するだけで済む。<br /><br />\r\n・デメリット： 4,980円など商売上ウケの良い価格表示にしたい場合、制御しづらい<br /><br /><br />\r\n\r\n【設定メモ】商品情報：<br />\r\n・[税種別]：　消費税<br />\r\n・[商品価格（ネット）]：10000円　（消費税分を含めない）<br /><br />\r\n\r\n\r\n【設定メモ】商品オプション属性<br />\r\n・[オプション価格] レッド（＋0/追加料金なし）、ホワイト（＋1000円）、イエロー（＋2000円）<br /><br />\r\n\r\n【ショップ全体の設定】　地域・税率設定＞税率設定　<br />\r\n・[消費税の税率]：　5％<br />','',0);
INSERT INTO `products_description` VALUES (183,9,'【1】10個以上でご注文ください','これは、「最低10個より販売いたします」など、最小購入数を制限したい場合の設定例です。<br /><br />\r\n\r\n【設定メモ：商品情報】<br />\r\n・最小購入数：　10<br />','',0);
INSERT INTO `products_description` VALUES (182,9,'【例6】1色あたり○点以上なら割引','サイズやカラーなどのオプション属性を持つ商品に、数量割引（いわゆるボリュームディスカウント）を適用したやや複雑な設定例です。<br />\r\n9個までは定価、10020個で定価の10％引き、20049個で20％引き、50個以上で25％引きというように、割引率による数量割引を設定しました。<br /><br />\r\nこの例では、1つのオプションに対して規定量以上購入した場合に割り引きが適用されます。<br />\r\nつまり、ホワイトとブラックを5コずつ購入しても割り引き対象にはならず、ホワイトあるいはブラック単体で10個以上購入してはじめて割引になります。<br />\r\nこれは、商品価格の管理において、「数量は同一商品であればオプション値に関係なく合算する＝いいえ」に設定しているからです。<br /><br />\r\n\r\n\r\nNOTE：　この設定は「商品価格の管理」から行います。<br />※商品の管理＞商品価格の管理　から呼び出すか、あるいは管理画面の商品リストの右端にある[＄]ボタン（緑色のボタン）から呼び出すことができます。<br /><br />\r\n\r\n【設定メモ：商品価格の管理】<br />\r\n以下の設定により、計算式は、購入代金＝｛定価×（1\"数量割引率）｝　×　購入数となります。<br />\r\n・ディスカウントタイプ：　割引率<br />\r\n・この価格からディスカウント：　価格<br />\r\n・割引設定<br /><br />\r\n　　・数量は同一商品であればオプション値に関係なく合算する：　いいえ<br />\r\n　------------------------------------------<br />\r\n　割引レベル　　　　最小限の有効数量　　　割引の値<br />\r\n　------------------------------------------<br />\r\n　割引3　　　　　　　　10　（個）　　　　　　　　　10.0　（％）<br />\r\n　割引4　　　　　　　　20　（個）　　　　　　　　　20.0　（％）<br />\r\n　割引5　　　　　　　　50　（個）　　　　　　　　　25.0　（％）<br />\r\n　-----------------------------------------<br /><br />\r\n\r\n【設定メモ：オプション属性】<br />\r\n1）カラー「ホワイト」<br />\r\n　　・価格： ＋0円<br />\r\n　　・特価/セール割引を適用した価格をベース価格として扱う：　はい<br />\r\n2）カラー「ブラック」<br />\r\n　　・価格：　＋1000円<br />\r\n　　・特価/セール割引を適用した価格をベース価格として扱う：　はい<br />\r\n　　・属性による価格増減をベース価格に含める：　はい','',0);
INSERT INTO `products_description` VALUES (181,9,'【SP3】商品オプション料金はセール・特価対象外にする例','特価商品にセールを適用した場合のふるまいを理解するための、ごくシンプルな例です。<br /><br />この商品には通常価格10000円のところを半額にする特価設定がされています。<br /><br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />しかし、特価商品に対するセールの設定を「セール対象外」にしたので<br />特価商品にはセール10％引きは適用されません。<br /><br />この商品には商品オプション（カラー3種類）がついています。<br />このうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />一つ前の例と異なり、この例では商品への特価適用時に、オプション料金には適用されない設定にしています。つまり、商品自体が特価でもオプション料金に関しては通常通りかかります。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％OFF（特価優先）<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・特価商品の場合：　セール対象外<br />・セール対象のカテゴリ：　「セール×特価：特価優先（セール対象外）」カテゴリ<br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール×特価：特価優先（セール対象外）」カテゴリ<br />・商品価格：　10000円<br />・特価価格：　50%<br /><br />【設定メモ：商品オプション属性】　※この商品に関する設定<br />・オプション名：　カラー<br />・オプション値：　レッド<br />・オプション価格：　＋2000円<br />・特価商品/セールによって割引を適用する： いいえ<br />','',0);
INSERT INTO `products_description` VALUES (180,9,'【SP2】商品オプション料金にもセール・特価適用する例','特価商品にセールを適用した場合のふるまいを理解するための、ごくシンプルな例です。<br /><br />この商品には通常価格10000円のところを半額にする特価設定がされています。<br /><br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />しかし、特価商品に対するセールの設定を「セール対象外」にしたので<br />特価商品にはセール10％引きは適用されません。<br /><br /><br />この商品には商品オプション（カラー3種類）がついています。<br />このうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />この例では、セール・特価が適用された時に、オプション料金にもセール・特価が適用されるように設定しています。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％OFF（特価優先）<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・特価商品の場合：　セール対象外<br />・セール対象のカテゴリ：　「セール×特価：特価優先（セール対象外）」カテゴリ<br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール×特価：特価優先（セール対象外）」カテゴリ<br />・商品価格：　10000円<br />・特価価格：　50%<br /><br />【設定メモ：商品オプション属性】　※この商品に関する設定<br />・オプション名：　カラー<br />・オプション値：　レッド<br />・オプション価格：　＋2000円<br />・特価商品/セールによって割引を適用する： はい<br />','',0);
INSERT INTO `products_description` VALUES (179,9,'【SP1】特価商品にセール適用の基本例','特価商品にセールを適用した場合のふるまいを理解するための、ごくシンプルな例です。<br /><br />この商品には通常価格10000円のところを半額にする特価設定がされています。<br /><br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />しかし、特価商品に対するセールの設定を「セール対象外」にしたので<br />特価商品にはセール10％引きは適用されません。<br /><br />この商品には商品オプション（カラー3種類）がついていますが、<br />オプションには追加料金を設定していないのでもともとどのカラーでも同料金です。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％OFF（特価優先）<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・特価商品の場合：　セール対象外<br />・セール対象のカテゴリ：　「セール×特価：特価優先（セール対象外）」カテゴリ<br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール×特価：セール優先（セール対象外）」カテゴリ<br />・商品価格：　10000円<br />・特価価格：　50%','',0);
INSERT INTO `products_description` VALUES (178,9,'【SP3】商品オプション料金はセール・特価対象外にする例','特価商品にセールを適用した場合のふるまいを理解するための、ごくシンプルな例です。<br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />また、セールとは別に<br />この商品には通常価格10000円のところを半額にする特価設定がされていますが、<br />特価商品に対するセールの設定を「特価商品の価格を無視する」にしたので<br />通常価格に10％のセール値引きが適用され、特価価格は無視されます。<br /><br /><br />この商品には商品オプション（カラー3種類）がついています。<br />このうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />一つ前の例と異なり、この例では商品へのセール・特価適用時に、オプション料金には適用されない設定にしています。つまり、商品自体がセール価格でもオプション料金に関しては通常通りかかります。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％OFF（セール優先）<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・特価商品の場合：　特価商品の価格を無視する<br />・セール対象のカテゴリ：　「セール×特価：セール優先（特価設定無視）」カテゴリ<br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール×特価：セール優先（特価設定無視）」カテゴリ<br />・商品価格：　10000円<br />・特価価格：　50%<br /><br />【設定メモ：商品オプション属性】　※この商品に関する設定<br />・オプション名：　カラー<br />・オプション値：　レッド<br />・オプション価格：　＋2000円<br />・特価商品/セールによって割引を適用する： いいえ','',0);
INSERT INTO `products_description` VALUES (177,9,'【SP2】商品オプション料金にもセール・特価適用する例','特価商品にセールを適用した場合のふるまいを理解するための、ごくシンプルな例です。<br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />また、セールとは別に<br />この商品には通常価格10000円のところを半額にする特価設定がされていますが、<br />特価商品に対するセールの設定を「特価商品の価格を無視する」にしたので<br />通常価格に10％のセール値引きが適用され、特価価格は無視されます。<br /><br /><br />この商品には商品オプション（カラー3種類）がついています。<br />このうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />この例では、セール・特価が適用された時に、オプション料金にもセール・特価が適用されるように設定しています。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％OFF（セール優先）<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・特価商品の場合：　特価商品の価格を無視する<br />・セール対象のカテゴリ：　「セール×特価：セール優先（特価設定無視）」カテゴリ<br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール×特価：セール優先（特価設定無視）」カテゴリ<br />・商品価格：　10000円<br />・特価価格：　50%<br /><br />【設定メモ：商品オプション属性】　※この商品に関する設定<br />・オプション名：　カラー<br />・オプション値：　レッド<br />・オプション価格：　＋2000円<br />・特価商品/セールによって割引を適用する： はい<br /><br />','',0);
INSERT INTO `products_description` VALUES (176,9,'【SP1】特価商品にセール適用の基本例','特価商品にセールを適用した場合のふるまいを理解するための、ごくシンプルな例です。<br /><br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />また、セールとは別に<br />この商品には通常価格を半額にする特価設定がされていますが、<br />特価商品に対するセールの設定を「特価商品の価格を無視する」にしたので<br />通常価格に10％のセール値引きが適用され、特価価格は無視されます。<br /><br />この商品には商品オプション（カラー3種類）がついていますが、<br />オプションには追加料金を設定していないのでもともとどのカラーでも同料金です。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％OFF（セール優先）<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・特価商品の場合：　特価商品の価格を無視する<br />・セール対象のカテゴリ：　「セール×特価：セール優先（特価設定無視）」カテゴリ<br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール×特価：セール優先（特価設定無視）」カテゴリ<br />・商品価格：　10000円<br />・特価価格：　50%','',0);
INSERT INTO `products_description` VALUES (174,9,'【SP2】商品オプション料金にもセール・特価適用する例','特価商品にセールを適用した場合のふるまいを理解するための、ごくシンプルな例です。<br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />また、セールとは別に<br />この商品には通常価格10000円のところを半額にする特価設定がされています。<br /><br /><br />特価商品に対するセールの設定を「特価商品の価格にさらにセール値引きを適用する」にしたので<br />特価価格からさらに10％のセール値引きが適用されます。<br /><br /><br />この商品には商品オプション（カラー3種類）がついています。<br />このうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />この例では、セール・特価が適用された時に、オプション料金にもセール・特価が適用されるように設定しています。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％OFF（特価＋セール）<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・特価商品の場合：　特価商品の価格にさらにセール値引きを適用する<br />・セール対象のカテゴリ：　「セール×特価：特価商品をさらに10％OFF」カテゴリ<br /><br />【設定メモ：商品情報】　※この商品に関する設定<br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール×特価：特価商品をさらに10％OFF」カテゴリ<br />・商品価格：　10000円<br />・特価価格：　50%<br /><br />【設定メモ：商品オプション属性】　※この商品に関する設定<br />・オプション名：　カラー<br />・オプション値：　レッド<br />・オプション価格：　＋2000円<br />・特価商品/セールによって割引を適用する： はい<br /><br />','',0);
INSERT INTO `products_description` VALUES (172,9,'【4】この商品にはセールが適用されません','この商品はセールが適用されません。なぜでしょうか？<br />理由は、この商品はリンク商品で、「商品マスターカテゴリ」がセール対象外のカテゴリだからです。<br /><br /><strong>NOTE：</strong><br />複数のカテゴリにリンクされた商品の場合、商品マスターカテゴリのセール設定が適用されます。<br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「このカテゴリにはセール設定していない」カテゴリ<br />・商品価格：　10000円','',0);
INSERT INTO `products_description` VALUES (173,9,'【SP1】特価商品にセール適用の基本例','特価商品にセールを適用した場合のふるまいを理解するための、ごくシンプルな例です。<br /><br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />また、セールとは別に<br />この商品には通常価格10000円のところを半額にする特価設定がされています。<br /><br />特価商品に対するセールの設定を「特価商品の価格にさらにセール値引きを適用する」にしたので<br />特価価格からさらに10％のセール値引きが適用されます。<br /><br /><br />この商品には商品オプション（カラー3種類）がついていますが、<br />オプションには追加料金を設定していないのでもともとどのカラーでも同料金です。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％OFF（特価＋セール）<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・特価商品の場合：　特価商品の価格にさらにセール値引きを適用する<br />・セール対象のカテゴリ：　「セール×特価：特価商品をさらに10％OFF」カテゴリ<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール×特価：特価商品をさらに10％OFF」カテゴリ<br />・商品価格：　10000円<br />・特価価格：　50%<br />','',0);
INSERT INTO `products_description` VALUES (175,9,'【SP3】商品オプション料金はセール・特価対象外にする例','特価商品にセールを適用した場合のふるまいを理解するための、ごくシンプルな例です。<br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />また、セールとは別に<br />この商品には通常価格10000円のところを半額にする特価設定がされています。<br /><br /><br />特価商品に対するセールの設定を「特価商品の価格にさらにセール値引きを適用する」にしたので<br />特価価格からさらに10％のセール値引きが適用されます。<br /><br /><br />この商品には商品オプション（カラー3種類）がついています。<br />このうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />一つ前の例と異なり、この例では商品への特価適用時に、オプション料金には適用されない設定にしています。つまり、商品自体が特価でもオプション料金に関しては通常通りかかります。<br /><br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％OFF（特価＋セール）<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・特価商品の場合：　特価商品の価格にさらにセール値引きを適用する<br />・セール対象のカテゴリ：　「セール×特価：特価商品をさらに10％OFF」カテゴリ<br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール×特価：特価商品をさらに10％OFF」カテゴリ<br />・商品価格：　10000円<br />・特価価格：　50%<br /><br />【設定メモ：商品オプション属性】　※この商品に関する設定<br />・オプション名：　カラー<br />・オプション値：　レッド<br />・オプション価格：　＋2000円<br />・特価商品/セールによって割引を適用する： いいえ<br />','',0);
INSERT INTO `products_description` VALUES (171,9,'セール期間と適用価格帯（適用されないケース）','セールの設定では、セール実施期間を限定したり、セール対象を商品価格帯で絞ったりする機能があります。<br />例えば「8月限定バーゲンセール」や「クリスマスセール」を実施したい場合などに活用できるでしょう。<br />さらに価格帯機能を使えば、5000円010000円の商品だけを値引きするといったことが可能です。<br /><br />このカテゴリは、10％引きのセール設定がされていますが、<br />特定の実施期間を設けています。また、8000円以上の商品にだけセールを適用するよう設定してあります。<br /><br />この商品の価格は7500円ですので、セールの適用対象外となります。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％セール期間と価格帯限定<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・価格幅：　10000円 から [入力しない]円<br />・セール対象のカテゴリ：　「セール関連etc」カテゴリ<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール関連etc」カテゴリ<br />・商品価格：　7500円','',0);
INSERT INTO `products_description` VALUES (169,9,'【SP3】期間限定で特価価格','特価機能を理解するための、ごくシンプルな例です。<br /><br />この商品は通常価格10000円のところを特価で半額にし、<br />さらに特価実施期間を設けました（半年間だけ値引きされます）<br /><br />この商品には商品オプション（カラー3種類）がついていますが、<br />オプションには追加料金を設定していないのでもともとどのカラーでも同料金です。<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品価格：　10000円<br />・特価価格：　50%<br />・提供開始日0終了日：　2007/1/15 0 2007/6/15','',0);
INSERT INTO `products_description` VALUES (170,9,'セール期間と適用価格帯（適用されるケース）','セールの設定では、セール実施期間を限定したり、セール対象を商品価格帯で絞ったりする機能があります。<br />例えば「8月限定バーゲンセール」や「クリスマスセール」を実施したい場合などに活用できるでしょう。<br />さらに価格帯機能を使えば、5000円010000円の商品だけを値引きするといったことが可能です。<br /><br />このカテゴリは、10％引きのセール設定がされていますが、<br />特定の実施期間を設けています。また、8000円以上の商品にだけセールを適用するよう設定してあります。<br /><br />この商品の価格は1万円なので、セールが適用されます。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％セール期間と価格帯限定<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・価格幅：　10000円 から [入力しない]円<br />・セール対象のカテゴリ：　「セール関連etc」カテゴリ<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール関連etc」カテゴリ<br />・商品価格：　10000円','',0);
INSERT INTO `products_description` VALUES (168,9,'【SP2-2】商品オプション料金は特価対象外（50％引）','特価機能を理解するための、ごくシンプルな例です。<br /><br />この商品には通常価格10000円のところを50％引きの特価設定がされています。<br />特価は新価格、あるいは割引率で指定可能ですが、これは割引率で設定した例です。<br /><br /><br />この商品には商品オプション（カラー3種類）がついています。<br />このうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />一つ前の例と異なり、この例では商品への特価適用時に、オプション料金には適用されない設定にしています。つまり、商品自体が特価でもオプション料金に関しては通常通りかかります。<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品価格：　10000円<br />・特価価格：　50%<br /><br />【設定メモ：商品オプション属性】　※この商品に関する設定<br />・オプション名：　カラー<br />・オプション値：　レッド<br />・オプション価格：　＋2000円<br />・特価商品/セールによって割引を適用する： いいえ','',0);
INSERT INTO `products_description` VALUES (167,9,'【SP2-2】商品オプション料金にも特価適用（50％引）','特価機能を理解するための、ごくシンプルな例です。<br /><br />この商品には通常価格10000円のところを50％引きの特価設定がされています。<br />特価は新価格、あるいは割引率で指定可能ですが、これは割引率で設定した例です。<br /><br /><br />この商品には商品オプション（カラー3種類）がついています。<br />このうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />この例では、商品への特価適用時に、オプション料金にも特価が適用されるように設定しています。<br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品価格：　10000円<br />・特価価格：　50%<br /><br />【設定メモ：商品オプション属性】　※この商品に関する設定<br />・オプション名：　カラー<br />・オプション値：　レッド<br />・オプション価格：　＋2000円<br />・特価商品/セールによって割引を適用する： はい','',0);
INSERT INTO `products_description` VALUES (166,9,'【SP2-1】特価商品の基本例（50%引）','特価機能を理解するための、ごくシンプルな例です。<br /><br />この商品には通常価格10000円のところを特価8000円（新価格）にする特価設定がされています。<br />特価は新価格、あるいは割引率で指定可能ですが、これは割引率で設定した例です。<br /><br />この商品には商品オプション（カラー3種類）がついていますが、<br />オプションには追加料金を設定していないのでもともとどのカラーでも同料金です。<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品価格：　10000円<br />・特価価格：　50%','',0);
INSERT INTO `products_description` VALUES (163,9,'【2】商品オプション料金にもセール適用する例','セール機能を理解するための、ごくシンプルな例です。<br />\r\nこのカテゴリに対して、8000円（新しい価格）にするセール設定がされており、このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />\r\n\r\nこの商品には商品オプション（カラー3種類）がついています。<br />\r\nこのうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />\r\nこの例では、セールが適用された時に、オプション料金にもセールが適用されるように設定しています。<br /><br />\r\n\r\n\r\n【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　新価格8000円<br />\r\n・値引き額：　8000（円）<br />\r\n・タイプ：　新しい価格<br />\r\n・セール対象のカテゴリ：　「セール：1万円を8000円に」カテゴリ<br /><br /><br />\r\n\r\n\r\n【設定メモ：商品情報】　※この商品に関する設定<br />\r\n・商品マスターカテゴリ：　「セール：1万円を8000円に」カテゴリ<br />\r\n・商品価格：　10000円<br /><br /><br />\r\n\r\n\r\n【設定メモ：商品オプション属性】　※この商品に関する設定<br />\r\n・オプション名：　カラー<br />\r\n・オプション値：　レッド<br />\r\n・オプション価格：　＋2000円<br />\r\n・特価商品/セールによって割引を適用する： はい<br /><br /><br />\r\n\r\n\r\n<strong>NOTE：</strong><br />\r\n実際にはレッドに対するオプション料金は割引きされません（そもそも2000円のオプション料金に新価格8000円セールを適用したら割り増し価格になってしまいます！）。<br />\r\nこのように、”新しい価格”で元値を置き換えるセール設定をオプションへも適用すること自体無意味な場合が多いため、オプションへの適用は無視される仕様になっています。<br /><br />','',0);
INSERT INTO `products_description` VALUES (164,9,'【3】商品オプション料金はセール対象外にする例','セール機能を理解するための、ごくシンプルな例です。<br />このカテゴリに対して、8000円（新しい価格）にするセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />この商品には商品オプション（カラー3種類）がついています。<br />このうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />一つ前の例と異なり、この例では商品へのセール適用時に、オプション料金には適用されない設定にしています。つまり、商品自体がセール価格でもオプション料金に関しては通常通りかかります。<br /><br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　新価格8000円<br />・値引き額：　8000（円）<br />・タイプ：　新しい価格<br />・セール対象のカテゴリ：　「セール：1万円を8000円に」カテゴリ<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール：1万円を8000円に」カテゴリ<br />・商品価格：　10000円<br /><br /><br />【設定メモ：商品オプション属性】　※この商品に関する設定<br />・オプション名：　カラー<br />・オプション値：　レッド<br />・オプション価格：　＋2000円<br />・特価商品/セールによって割引を適用する： いいえ<br />','',0);
INSERT INTO `products_description` VALUES (165,9,'【SP1-1】特価商品の基本例（1万円を8000円に）','特価機能を理解するための、ごくシンプルな例です。<br /><br />この商品には通常価格10000円のところを特価8000円（新価格）にする特価設定がされています。<br />特価は新価格、あるいは割引率で指定可能ですが、これは新価格で設定した例です。<br /><br />この商品には商品オプション（カラー3種類）がついていますが、<br />オプションには追加料金を設定していないのでもともとどのカラーでも同料金です。<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品価格：　10000円<br />・特価価格：　8000円','',0);
INSERT INTO `products_description` VALUES (161,9,'【3】商品オプション料金はセール対象外にする例','セール機能を理解するための、ごくシンプルな例です。<br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />この商品には商品オプション（カラー3種類）がついています。<br />このうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />一つ前の例と異なり、この例では商品へのセール適用時に、オプション料金には適用されない設定にしています。つまり、商品自体がセール価格でもオプション料金に関しては通常通りかかります。<br /><br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　セール500円OFF<br />・値引き額：　500（円）<br />・タイプ：　値引き額<br />・セール対象のカテゴリ：　「セール：500円OFF」カテゴリ<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール：500円OFF」カテゴリ<br />・商品価格：　10000円<br /><br /><br />【設定メモ：商品オプション属性】　※この商品に関する設定<br />・オプション名：　カラー<br />・オプション値：　レッド<br />・オプション価格：　＋2000円<br />・特価商品/セールによって割引を適用する： いいえ','',0);
INSERT INTO `products_description` VALUES (162,9,'【1】セール適用の基本例','セール機能を理解するための、ごくシンプルな例です。<br />このカテゴリに対して、8000円（新しい価格）にするセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />この商品には商品オプション（カラー3種類）がついていますが、<br />オプションには追加料金を設定していないのでもともとどのカラーでも同料金です。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　新価格8000円<br />・値引き額：　8000（円）<br />・タイプ：　新しい価格<br />・セール対象のカテゴリ：　「セール：1万円を8000円に」カテゴリ<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール：1万円を8000円に」カテゴリ<br />・商品価格：　10000円<br />','',0);
INSERT INTO `products_description` VALUES (159,9,'【1】セール適用の基本例','セール機能を理解するための、ごくシンプルな例です。<br />このカテゴリに対して、500円引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />この商品には商品オプション（カラー3種類）がついていますが、<br />オプションには追加料金を設定していないのでもともとどのカラーでも同料金です。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　500円OFF<br />・値引き額：　500（円）<br />・タイプ：　値引き額<br />・セール対象のカテゴリ：　「セール：500円OFF」カテゴリ<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール：500円OFF」カテゴリ<br />・商品価格：　10000円<br />','',0);
INSERT INTO `products_description` VALUES (160,9,'【2】商品オプション料金にもセール適用する例','セール機能を理解するための、ごくシンプルな例です。<br />\r\nこのカテゴリに対して、10％引きのセール設定がされており、このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />\r\n\r\nこの商品には商品オプション（カラー3種類）がついています。<br />\r\nこのうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />\r\nこの例では、セールが適用された時に、オプション料金にもセールが適用されるように設定しています。<br /><br />\r\n\r\n【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />\r\n・セール名：　500円OFF<br />\r\n・値引き額：　500（円）<br />\r\n・タイプ：　値引き額<br />\r\n・セール対象のカテゴリ：　「セール：500円OFF」カテゴリ<br /><br /><br />\r\n\r\n\r\n【設定メモ：商品情報】　※この商品に関する設定<br />\r\n・商品マスターカテゴリ：　「セール：500円OFF」カテゴリ<br />\r\n・商品価格：　10000円<br /><br /><br />\r\n\r\n\r\n【設定メモ：商品オプション属性】　※この商品に関する設定<br />\r\n・オプション名：　カラー<br />\r\n・オプション値：　レッド<br />\r\n・オプション価格：　＋2000円<br />\r\n・特価商品/セールによって割引を適用する： はい<br /><br /><br />\r\n\r\n\r\n<strong>NOTE：</strong>\r\n※実際の運用においては、固定額の値引きセールをオプション料金にも適用する場合は注意が必要です。<br />\r\nこのケースでは、たまたまオプション料金（2000円）がセールの値引き額（-500円）よりも大きいために正常に500円引きが反映されていますが、特に、オプション料金よりもセールの値引き額の方が大きい場合は正しく機能しません。固定額を値引く意味をよく考えて適用を決めてください。<br /><br />','',0);
INSERT INTO `products_description` VALUES (157,9,'【2】商品オプション料金にもセール適用する例','セール機能を理解するための、ごくシンプルな例です。<br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />この商品には商品オプション（カラー3種類）がついています。<br />このうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />この例では、セールが適用された時に、オプション料金にもセールが適用されるように設定しています。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％OFF<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・セール対象のカテゴリ：　「セール10％OFF」カテゴリ<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール10％OFF」カテゴリ<br />・商品価格：　10000円<br /><br />【設定メモ：商品オプション属性】　※この商品に関する設定<br />・オプション名：　カラー<br />・オプション値：　レッド<br />・オプション価格：　＋2000円<br />・特価商品/セールによって割引を適用する： はい','',0);
INSERT INTO `products_description` VALUES (158,9,'【3】商品オプション料金はセール対象外にする例','セール機能を理解するための、ごくシンプルな例です。<br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />この商品には商品オプション（カラー3種類）がついています。<br />このうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />一つ前の例（【2】商品オプションの追加料金にもセールが適用される例）と異なり、この例ではセールが適用された時に、オプション料金にはセールが適用されない設定にしています。つまり、セール中も、通常通りのオプション料金がかかります。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％OFF<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・セール対象のカテゴリ：　「セール10％OFF」カテゴリ<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール10％OFF」カテゴリ<br />・商品価格：　10000円<br /><br /><br />【設定メモ：商品オプション属性】　※この商品に関する設定<br />・オプション名：　カラー<br />・オプション値：　レッド<br />・オプション価格：　＋2000円<br />・特価商品/セールによって割引を適用する： いいえ','',0);
INSERT INTO `products_description` VALUES (155,9,'【例6】無料商品：本体無料ならオプションも無料','商品を無料商品にしたら、商品オプションの追加料金の方も無料にしたい場合の例です。<br /><br />\r\n\r\nこの例では、カラー＝レッドを選択した場合だけ追加料金（500円増し）が発生する設定になっています。<br />\r\nさらに、「商品が無料のとき属性による価格も無料にする＝はい」に設定されているので、商品を無料商品に設定したら\r\n属性価格も無料になります。つまり、レッドを選択しても0円です。<br /><br />\r\n\r\n\r\n【設定メモ】<br />\r\n・無料商品： はい<br /><br />\r\n\r\n【オプション属性設定メモ： カラー「レッド」】<br />\r\n・オプション名：カラー<br />\r\n・オプション値：レッド<br />\r\n・属性による価格設定：　＋500円　（ベース価格に500円増し）<br />\r\n・商品が無料のとき属性による価格も無料にする： はい','',0);
INSERT INTO `products_description` VALUES (156,9,'【1】セール適用の基本例','セール機能を理解するための、ごくシンプルな例です。<br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />この商品には商品オプション（カラー3種類）がついていますが、<br />オプションには追加料金を設定していないのでもともとどのカラーでも同料金です。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％OFF<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・セール対象のカテゴリ：　「セール10％OFF」カテゴリ<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール10％OFF」カテゴリ<br />・商品価格：　10000円<br /><br />\r\n\r\nNOTE：<br />\r\nこの商品は、「セール10％OFF」カテゴリ（←これがマスターカテゴリ）の他に、\r\n「セールと特価 > セール対象外カテゴリ」にもリンクされています。<br /><br />\r\n「セール対象外カテゴリ」は、セールの設定をしていないカテゴリですが、\r\nこの商品のマスターカテゴリはセール設定されたカテゴリなので、「セール対象外カテゴリ」で表示される時もセールが適用される点に注目してください。','',0);
INSERT INTO `products_description` VALUES (152,9,'【2】サイズ、カラー選択（セール10％オフ適用）','商品オプションのタイプ＝DROPDOWN（リストから選択）およびRADIO（ラジオボタン）の活用サンプルです。<br /><br />前の例（【1】サイズ、カラー選択）とオプション設定内容は全く同じですが、<br />\r\nこの商品はセール10％引きの対象になっている点が異なります。<br /><br />\r\n\r\n選択肢によって追加料金を設定することも可能で、<br />\r\nその場合、セールが追加料金に適用されるかどうかはオプション属性の設定次第です。<br />\r\n\r\n例えばXLサイズは追加料金＋500円のところ、<br />\r\n「オプション属性にも割引を適用する＝はい」に設定しているので<br />\r\nこの追加料金に対しても10％引きが適用されることになり、<br />\r\nXLサイズ選択時の実際の追加料金は＋450円です。<br /><br />\r\n\r\nこれに対してブラック（カラー）はXLサイズと同じ追加料金＋500円ですが、<br />\r\n「オプション属性にも割引を適用する＝いいえ」に設定しているので<br />\r\n10％引きが適用されず、実際の追加料金も＋500円のままかかります。<br /><br />\r\n\r\n【設定メモ】<br />■オプション名：　サイズ<br />　・オプションのタイプ：　DROPDOWN<br />　・オプション値：　S、M、L、XL（＋500円）、「ご選択ください・・・」<br />　・オプション属性にも割引を適用する：　はい<br />------------------------------<br />■オプション名：　カラー<br />　・オプションのタイプ：　RADIO<br />　・オプション値：　ホワイト、　イエロー、ブルー、ブラック（＋500円）<br />　・オプション属性にも割引を適用する：　いいえ<br /><br />NOTE：<br /> 「ご選択ください・・・」オプション値の属性フラグ設定は、<br />　「表示のみ」＝\"はい\"に、かつ「属性によって価格がつけられるとき基本価格に含める」＝\"いいえ\"に設定されている。 <br />　これにより、「ご選択ください・・・」を選択した状態でカゴに入れることはできないため、ユーザは必ず他のいずれか（SサイズとかMサイズ）を選ぶことになる。<br /><br />\r\n\r\nNOTE：\r\nカラー選択のラジオボタンに、カラーチップ（色見本）が添えられていますが、これは、商品オプション属性＞属性の見本画像 で画像を登録すると表示されます。<br /><br />\r\nなお、ラジオボタン、オプション名、見本画像の配置は、「オプション名の管理」にて、<br />\r\n・列(Row)あたりの属性画像<br />\r\n・ラジオボタン・チェックボックスの属性スタイル<br />\r\nで変更することができます。','',0);
INSERT INTO `products_description` VALUES (151,9,'【3R】リボンの量り売り（RADIO）','商品オプションのタイプ＝RADIO（ラジオボタン））の活用サンプルです。<br /><br />この例はリボンの量り売りという想定です。<br />ユーザは1メートルあるいは1センチメートル単位で購入できるものとし、<br />購入単位はDROPDOWNタイプの商品オプションを使って選択可能にしています。<br /><br />メートル選択時は、1（m）あたり ＠500円で、商品重量は100g（＝0．1Kg）、<br />センチ選択時は、1（cm）あたり  ＠5円で、商品重量は1g（＝0．001Kg）のように、<br />購入単位の選択に応じて、単位長さあたりの値段と商品重量が決まるところがミソです。<br /><br />また、最小購買数を設定しており、購入は10cm（mの場合は10m）以上からとなります。<br /><br />【設定メモ】<br />■商品情報<br />　・商品属性による価格：　はい<br />　・商品価格 (ネット)：　0<br />　・商品の最小数量：　10<br />　・商品の数量単位：　　1<br />　・商品重量：　0<br /><br />■オプション属性の設定<br />・オプション名：　単位長さ<br />・オプション属性： <br />　・特価商品/セールによって割引を適用する：　はい<br />　・属性によって価格がつけられるとき基本価格に含める：　はい<br /><br />　・価格と重量<br />　　オプション値　　　　　　オプション価格　　　オプション重量<br />　　--------------------------------------------------------------<br />　　（1）メートル　　　　　 　　　500円　　　　　0．1（Kg）<br />　　（2）センチメートル　　 　　5円　　　　　　 0．001（Kg）<br /><br /><br />NOTE：<br />同じカテゴリに、これと商品オプション内容をDROPDOWN（リスト選択）タイプで設定した例を掲載しています（→【3D】リボンの量り売り（単位選択））。見た目の違いなどご確認ください。','',0);
INSERT INTO `products_description` VALUES (146,9,'【3D】リボンの量り売り（DROPDOWN）','商品オプションのタイプ＝DROPDOWN（リストから選択）の活用サンプルです。<br /><br />この例はリボンの量り売りという想定です。<br />ユーザは1メートルあるいは1センチメートル単位で購入できるものとし、<br />購入単位はDROPDOWNタイプの商品オプションを使って選択可能にしています。<br /><br />メートル選択時は、1（m）あたり ＠500円で、商品重量は100g（＝0．1Kg）、<br />センチ選択時は、1（cm）あたり  ＠5円で、商品重量は1g（＝0．001Kg）のように、<br />購入単位の選択に応じて、単位長さあたりの値段と商品重量が決まるところがミソです。<br /><br />また、最小購買数を設定しており、購入は10cm（mの場合は10m）以上からとなります。<br /><br />【設定メモ】<br />■商品情報<br />　・商品属性による価格：　はい<br />　・商品価格 (ネット)：　0<br />　・商品の最小数量：　10<br />　・商品の数量単位：　　1<br />　・商品重量：　0<br /><br />■オプション属性の設定<br />・オプション名：　単位長さ<br />・オプション属性： <br />　・特価商品/セールによって割引を適用する：　はい<br />　・属性によって価格がつけられるとき基本価格に含める：　はい<br /><br />　・価格と重量<br />　　オプション値　　　　　　オプション価格　　　オプション重量<br />　　--------------------------------------------------------------<br />　　（1）メートル　　　　　 　　　500円　　　　　0．1（Kg）<br />　　（2）センチメートル　　 　　5円　　　　　　 0．001（Kg）<br /><br />NOTE：<br />同じカテゴリに、これと商品オプション内容をRADIO（ラジオボタン）タイプで設定した例を掲載しています（→【3R】リボンの量り売り（単位選択））。見た目の違いなどご確認ください。','',0);
INSERT INTO `products_description` VALUES (140,9,'【2】名入れオプション例（1ワードいくら）','商品オプションのタイプ＝TEXTの活用サンプルです。<br />前の例同様、この例でもＴシャツへの名入れ指定として使っています。<br />前の例では1文字いくらの料金設定でしたが、ここでは1ワードいくらでカウントします（Wordでカウントするのは日本語にはなじまないやり方かもしれませんが？！）<br /><br /><br />2ワードまで無料、3ワード以上では1ワードあたり20円の追加料金でTシャツに指定の文字を入れられる設定です。<br /><br />【設定メモ】<br />■オプション名：　名入れ（1）<br />　・オプションのタイプ：　TEXT<br />　・テキスト属性の最長と表示サイズ<br />　　　・コメント：<br />　　　　「入れたい文字列を入力してください（全角40文字まで）。」<br />　　　・行：　1<br />　　　・表示サイズ：　40<br />　　　・最長：　80<br />■商品オプション属性 ＞ 価格と重量<br />　・言葉ごとの価格？：　20円<br />　・無料の言葉？：　2（ワード）<br />　・属性フラグ<br />　　　・属性によって価格がつけられるとき基本価格に含める：　はい<br />　　　・テキスト入力を必須にする：　はい','',0);
INSERT INTO `products_description` VALUES (141,9,'表示のみオプション利用例','オプション属性の利用方法は、商品バリエーションの選択肢としての利用だけではありません。<br />商品ページに定型文を表示する用途としても利用可能です。<br />その場合は、オプションのタイプとして「READ ONLY」を使います。<br /><br />【設定メモ】<br />■オプション名：　お手入れ方法<br />　・オプションのタイプ：　READ ONLY<br />■オプション値<br />　（1）綿 100％ <br />　（2）６.1オンス<br />　（3）洗濯機（弱水流）または手荒い。水温は40℃まで。※オプション画像を登録<br />　（4）アイロンは中温（0160℃）まで 　　※オプション画像を登録','',0);
INSERT INTO `products_description` VALUES (142,9,'【1】ギフトオプション','商品オプションのタイプ＝CHECKBOX（チェックボックス）の活用サンプルです。<br /><br />チェックボックスタイプにすると、1商品あたり複数のオプションを同時選択できます。<br />この例では、ご贈答用やプレゼント向けのオプションとして、（1）ギフト包装、（2）メッセージカード、（3）オリジナルキーホルダー付きの3つを設定しました。<br />このうちオリジナルキーホルダー付きは有料オプション、他の2つは無料サービスとしました。なおオプション料金は特価/セールの影響をうけない設定にしています。<br /><br /><br />【設定メモ】<br />■オプション名：　ギフトオプション<br />　・オプションのタイプ：　CHECKBOX<br />■オプション属性＞価格と重量： <br />　オプション値　　　　　　オプション価格　　　特価商品/セールによって割引を適用する<br />　--------------------------------------------------------------<br />　（1）ギフト包装　　　　 　　　＋0円　　　　　　いいえ<br />　（2）メッセージカード　　　　＋0円　　　　　　いいえ<br />　（3）キーホルダー付き　＋100円　　　　　　いいえ<br />','',0);
INSERT INTO `products_description` VALUES (143,9,'【2】ファミリー向けセット販売','商品オプションのタイプ＝CHECKBOX（チェックボックス）の活用サンプルです。<br /><br />チェックボックスタイプにすると、1商品あたり複数のオプションを同時選択できます。<br />この例では、ファミリーでお揃いのTシャツを購入するようなケースを想定して、<br />パパ用にLサイズ、ママはSサイズ、お兄ちゃんには身長150cmサイズで妹のA子ちゃんに身長120cmサイズ・・・のようにサイズを選び、<br />セット購入できるよう設定しました。<br /><br /><br />NOTE：<br />選んだサイズごとに価格と商品重量が異なりそれらはオプション料金、オプション重量として設定しています。<br />これらは「特価商品/セールによって割引を適用する＝はい」の設定なので、<br />もしこの商品に特価設定等を行えばオプション料金の額も変化します。<br /><br />【設定メモ】<br />■オプション名：　サイズ<br />　・オプションのタイプ：　CHECKBOX<br />■オプション値：　S, M, L, 110, 120, 130, 140, 150<br />■オプション属性<br />　オプション値　　　　　　オプション価格　　　特価商品/セールによって割引を適用する<br />　--------------------------------------------------------------<br />　Sサイズ　　　　　　　　　　　 +4000円　　　　はい<br />　Mサイズ 　　　　　　　　　　　+4000円　　　　はい<br />　Lサイズ： 　　　　　　　　　　+4500円　　　　はい<br />　140、150cm：　　　　　　　 +3500円　　　　はい<br />　110、120、130cm：　　　　+3000円　　　　はい','',0);
INSERT INTO `products_description` VALUES (144,9,'【1】サイズ、カラー選択','商品オプションのタイプ＝DROPDOWN（リストから選択）およびRADIO（ラジオボタン）の活用サンプルです。<br /><br />Tシャツの販売でよく使われる例として、サイズやカラー選択を例にしました。<br />DROPDOWNやRADIOでは、複数ある選択肢の中から1つだけ選択可能です。<br /><br />選択肢によって追加料金を設定することも可能です。<br />ここではXLサイズ（DROPDOWN）とブラック（RADIO）のみ＋500円と設定しました。<br /><br />【設定メモ】<br />■オプション名：　サイズ<br />　・オプションのタイプ：　DROPDOWN<br />　・オプション値：　S、M、L、XL（＋500円）、「ご選択ください・・・」<br />------------------------------<br />■オプション名：　カラー<br />　・オプションのタイプ：　RADIO<br />　・オプション値：　ホワイト、　イエロー、ブルー、ブラック（＋500円）<br /><br />NOTE：<br /> 「ご選択ください・・・」オプション値の属性フラグ設定は、<br />　「表示のみ」＝\"はい\"に、かつ「属性によって価格がつけられるとき基本価格に含める」＝\"いいえ\"に設定されている。 <br />　これにより、「ご選択ください・・・」を選択した状態でカゴに入れることはできないため、ユーザは必ず他のいずれか（SサイズとかMサイズ）を選ぶことになる。<br /><br />\r\n\r\nNOTE：\r\nカラー選択のラジオボタンに、カラーチップ（色見本）が添えられていますが、これは、商品オプション属性＞属性の見本画像 で画像を登録すると表示されます。<br /><br />\r\nなお、ラジオボタン、オプション名、見本画像の配置は、「オプション名の管理」にて、<br />\r\n・列(Row)あたりの属性画像<br />\r\n・ラジオボタン・チェックボックスの属性スタイル<br />\r\nで変更することができます。','',0);
INSERT INTO `products_description` VALUES (116,9,'META、title設定していない標準の商品ページ例','これは標準の商品ページ（META設定例、title設定を明示的に設定していない）のサンプルです。<br /><br />\r\n\r\nSEO対策の一環として、Zen Cartでは個別商品ごとにMETAタグやtitleタグを明示的に設定することができますが、<br />\r\nこのページをみてわかるように、<br />\r\nZen Cartでは標準機能としてMETAやtitleタグに商品名や価格その他の要素を埋め込むようにできています。<br /><br />\r\n\r\n管理画面の一般設定＞商品情報の設定から、TITLEタグに商品価格を含める（含めない）やMETA（description）のテキスト長などの設定ができます。これは全商品に対して適用されます。<br /><br />','',0);
INSERT INTO `products_description` VALUES (139,9,'【1】名入れオプション例（1文字いくら）','商品オプションのタイプ＝TEXTの活用サンプルです。<br />この例では、Ｔシャツへの名入れ指定として使っています。<br /><br /><br />名入れエリアは最大2行、<br />　・1行目は5文字まで無料、6文字以上は一文字10円<br />　・2行目は1文字5円<br />の追加料金でTシャツに指定の文字を入れられる想定で設定しました。<br /><br />【設定メモ：商品情報】<br />\r\n・商品属性による価格：　はい<br /><br />【設定メモ】　※ 1行目名入れエリア用<br />■オプション名：　名入れ（1）<br />　・オプションのタイプ：　TEXT<br />　・テキスト属性の最長と表示サイズ<br />　　　・コメント：<br />　　　　「1行目に入れる文字を入力してください（全角40文字まで）。」<br />　　　・行：　1<br />　　　・表示サイズ：　40<br />　　　・最長：　80<br />■商品オプション属性 ＞ 価格と重量<br />　・文字ごとの価格？：　10円<br />　・無料の文字？：　5文字<br />　・属性フラグ<br />　　　・属性によって価格がつけられるとき基本価格に含める：　はい<br />　　　・テキスト入力を必須にする：　はい<br /><br />-----------------------<br />【設定メモ】　※2行目名入れエリア用<br />■オプション名：　名入れ（2）<br />　・オプションのタイプ：　TEXT<br />　・テキスト属性の最長と表示サイズ<br />　　　・コメント：<br />　　　　「2行目に入れる文字を入力してください（全角40文字まで）。」<br />　　　・行：　1<br />　　　・表示サイズ：　40<br />　　　・最長：　80<br />■商品オプション属性 ＞ 価格と重量<br />　・文字ごとの価格？：　5円<br />　・無料の文字？：　0文字<br />　・属性フラグ<br />　　　・属性によって価格がつけられるとき基本価格に含める：　はい<br />　　　・テキスト入力を必須にする：　はい<br /><br />','',0);
INSERT INTO `products_description` VALUES (115,9,'商品ページへのSEO（META、title）設定例','SEO対策の一環として、Zen Cartでは個別商品ごとにMETAタグやtitleタグを明示的に設定することができます。<br /><br />\r\n\r\nこのサンプル商品に対して、以下のように設定しました。<br />\r\nブラウザの「ソースを表示」で、このページのHTMLソースの<head>0</head>部分を確認してみてください。<br /><br />\r\n\r\n【設定メモ：META】<br />\r\n・title：<br />\r\n　　「この商品ページには明示的にtitleタグを設定しました。」<br /><br />\r\n・META（keyword）：<br />\r\n　　「この商品ページには明示的にMETA（keyword）を設定しています,商品キーワード1,商品キーワード2,商品キーワード3」<br /><br />\r\n\r\n・META（description）：<br />\r\n　　「この商品ページには明示的にMETA（description）を設定しています。Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus sit amet velit・・・」<br /><br />\r\n\r\nNOTE：<br />\r\n・ちなみにこの機能を利用しなくても、Zen Cartでは標準機能としてMETAやtitleタグに商品名や価格その他の要素を埋め込むようにできています。<br />\r\n・管理画面の一般設定＞商品情報の設定から、TITLEタグに商品価格を含める（含めない）やMETA（description）のテキスト長などの設定ができます。これは全商品に対して適用されます。<br /><br />','',0);
INSERT INTO `products_description` VALUES (111,9,'【例5】○個までは特価、それ以上なら特価をさらに○％引き','特価価格が設定された商品に数量割引（いわゆるボリュームディスカウント）を適用した例です。<br />一定数以上購入すると、1個あたりの価格が、特価価格からさらに○％値引かれます。つまり割引分も特価ベースで計算される設定です。<br /><br />NOTE：　この設定は「商品価格の管理」から行います。<br />※商品の管理＞商品価格の管理　から呼び出すか、あるいは管理画面の商品リストの右端にある[＄]ボタン（緑色のボタン）から呼び出すことができます。<br /><br /><br /><br />【設定メモ：商品価格の管理】<br /><br />以下の設定により、計算式は、購入代金＝（特価×（1\"数量割引率）　×　購入数となります。<br /><br />・ディスカウントタイプ：　割引率（％）<br />・この価格からディスカウント：　特価<br />・割引設定<br />　------------------------------------------<br />　割引レベル　　　　最小限の有効数量　　　割引の値<br />　------------------------------------------<br />　割引3　　　　　　　　10　（個）　　　　　　　　　10　（％）<br />　割引4　　　　　　　　20　（個）　　　　　　　　　20　（％）<br />　割引5　　　　　　　　50　（個）　　　　　　　　　25　（％）　<br />　------------------------------------------<br />','',0);
INSERT INTO `products_description` VALUES (112,9,'【例7】カラー混在OKで合計○個以上なら割引','サイズやカラーなどのオプション属性を持つ商品に、数量割引（いわゆるボリュームディスカウント）を適用したやや複雑な設定例です。<br />\r\n9個までは定価、10020個で定価の10％引き、20049個で20％引き、50個以上で25％引きというように、割引率による数量割引を設定しました。<br /><br />\r\nこの例では、オプションをいろいろ取り混ぜてよく、この商品の合計が規定量以上であれば（個々のオプション選択がなんであれ）割り引きが適用されます。<br />\r\nつまり、ホワイト5コカゴに入れ、続いてブラックを5コカゴに入れた時点で合計10コと見なされて割引価格が適用されます。<br />\r\nもちろんホワイトあるいはブラック単体で10個以上購入しても割引かれます。<br />\r\nこれは、商品価格の管理において、「数量は同一商品であればオプション値に関係なく合算する＝はい」に設定した場合にこのような動作になります。<br /><br />\r\n\r\n\r\nNOTE：　この設定は「商品価格の管理」から行います。<br />※商品の管理＞商品価格の管理　から呼び出すか、あるいは管理画面の商品リストの右端にある[＄]ボタン（緑色のボタン）から呼び出すことができます。<br /><br />\r\n\r\n【設定メモ：商品価格の管理】<br />\r\n以下の設定により、計算式は、購入代金＝｛定価×（1\"数量割引率）｝　×　購入数となります。<br />\r\n・ディスカウントタイプ：　割引率<br />\r\n・この価格からディスカウント：　価格<br />\r\n・割引設定<br /><br />\r\n　　・数量は同一商品であればオプション値に関係なく合算する：　はい<br />\r\n　------------------------------------------<br />\r\n　割引レベル　　　　最小限の有効数量　　　割引の値<br />\r\n　------------------------------------------<br />\r\n　割引3　　　　　　　　10　（個）　　　　　　　　　10.0　（％）<br />\r\n　割引4　　　　　　　　20　（個）　　　　　　　　　20.0　（％）<br />\r\n　割引5　　　　　　　　50　（個）　　　　　　　　　25.0　（％）<br />\r\n　-----------------------------------------<br /><br />\r\n\r\n【設定メモ：オプション属性】<br />\r\n1）カラー「ホワイト」<br />\r\n　　・価格： ＋0円<br />\r\n　　・特価/セール割引を適用した価格をベース価格として扱う：　はい<br />\r\n2）カラー「ブラック」<br />\r\n　　・価格：　＋1000円<br />\r\n　　・特価/セール割引を適用した価格をベース価格として扱う：　はい<br />\r\n　　・属性による価格増減をベース価格に含める：　はい','',0);
INSERT INTO `products_description` VALUES (113,9,'【例8】カラー混在OKで合計○個以上なら特価をさらに数量割引','サイズやカラーなどのオプション属性を持ち、さらに特価設定された商品に対して数量割引（いわゆるボリュームディスカウント）を適用したやや複雑な設定例です。<br />9個までは定価、10020個で定価の10％引き、20049個で20％引き、50個以上で25％引きというように、割引率による数量割引を設定しました。<br />特価ベースで数量割引率が適用される点以外は、前の【例6】と同じ設定です。ふるまいがどう変わるか見比べてみてください。<br />NOTE：　この設定は「商品価格の管理」から行います。<br />※商品の管理＞商品価格の管理　から呼び出すか、あるいは管理画面の商品リストの右端にある[＄]ボタン（緑色のボタン）から呼び出すことができます。<br /><br />【設定メモ：商品価格の管理】<br /><br />以下の設定により、計算式は、購入代金＝｛特価×（1\"数量割引率）｝　×　購入数となります。<br />・ディスカウントタイプ：　割引率<br />・この価格からディスカウント：　特価<br />・割引設定<br />　------------------------------------------<br />　割引レベル　　　　最小限の有効数量　　　割引の値<br />　------------------------------------------<br />　割引3　　　　　　　　10　（個）　　　　　　　　　10.0　（％）　<br />　割引4　　　　　　　　20　（個）　　　　　　　　　20.0　（％）　<br />　割引5　　　　　　　　50　（個）　　　　　　　　　25.0　（％）　<br />　------------------------------------------<br /><br />\r\n【設定メモ：オプション属性】<br />\r\n1）カラー「ホワイト」<br />\r\n　　・価格： ＋0円<br />\r\n　　・特価/セール割引を適用した価格をベース価格として扱う：　はい<br />\r\n2）カラー「ブラック」<br />\r\n　　・価格：　＋1000円<br />\r\n　　・特価/セール割引を適用した価格をベース価格として扱う：　はい<br />\r\n　　・属性による価格増減をベース価格に含める：　はい<br /><br />\r\n\r\nNOTE：<br />\r\nこの例では、オプションをいろいろ取り混ぜてよく、この商品の合計が規定量以上であれば（個々のオプション選択がなんであれ）割り引きが適用されます。<br />\r\nつまり、ホワイト5コカゴに入れ、続いてブラックを5コカゴに入れた時点で合計10コと見なされて割引価格が適用されます。<br />\r\nもちろんホワイトあるいはブラック単体で10個以上購入しても割引かれます。<br />\r\nこれは、商品価格の管理において、「数量は同一商品であればオプション値に関係なく合算する＝はい」に設定した場合にこのような動作になります。<br /><br />','',0);
INSERT INTO `products_description` VALUES (110,9,'【例4】○個までは特価、それ以上なら定価の○％引き','特価価格が設定された商品に数量割引（いわゆるボリュームディスカウント）を適用した例です。<br />数が少ないうちは特価価格が適用され、一定数以上購入すると、1個あたりの価格が、定価の○％値引かれる数量割引が適用されます。つまり数量割引分は定価ベースで計算される設定です。<br /><br />NOTE：　この設定は「商品価格の管理」から行います。<br />※商品の管理＞商品価格の管理　から呼び出すか、あるいは管理画面の商品リストの右端にある[＄]ボタン（緑色のボタン）から呼び出すことができます。<br /><br /><br /><br />【設定メモ：商品価格の管理】<br /><br />以下の設定により、計算式は、<br />　・数量割引以下の時：　購入代＝特価 × 購入数<br />　・数量割引以上の時：　購入代金＝｛定価×（1\"数量割引率）｝　×　購入数で計算されます。<br /><br />・ディスカウントタイプ：　割引率（％）<br />・この価格からディスカウント：　定価<br />・割引設定<br /><br />　------------------------------------------<br />　割引レベル　　　　最小限の有効数量　　　割引の値<br />　------------------------------------------<br />　割引3　　　　　　　　10　（個）　　　　　　　　　10　（％）　<br />　割引4　　　　　　　　20　（個）　　　　　　　　　20　（％）　<br />　割引5　　　　　　　　50　（個）　　　　　　　　　25　（％）　<br />　------------------------------------------<br />','',0);
INSERT INTO `products_description` VALUES (103,9,'【例2】○個以上買うと1個あたり○円引き','数量割引（いわゆるボリュームディスカウント）の適用例です。<br />9個までは定価、10020個で定価の1000円引き、20049個で1500円引き、50個以上で2000円引きというように、定価から一定額値引きされる数量割引を設定しました。<br /><br />NOTE：　この設定は「商品価格の管理」から行います。<br />※商品の管理＞商品価格の管理　から呼び出すか、あるいは管理画面の商品リストの右端にある[＄]ボタン（緑色のボタン）から呼び出すことができます。<br /><br /><br /><br />【設定メモ：商品価格の管理】<br /><br />以下の設定により、計算式は、購入代金＝（定価\"定額値引き）　×　購入数となります。<br /><br />・ディスカウントタイプ：　一定金額割引<br />・この価格からディスカウント：　価格<br />・割引設定<br /><br />　------------------------------------------<br />　割引レベル　　　　最小限の有効数量　　　割引の値<br />　------------------------------------------<br />　割引3　　　　　　　　10　（個）　　　　　　　　　1000　（円）　<br />　割引4　　　　　　　　20　（個）　　　　　　　　　1500　（円）　<br />　割引5　　　　　　　　50　（個）　　　　　　　　　2000　（円）　<br />　------------------------------------------<br />','',0);
INSERT INTO `products_description` VALUES (104,9,'【例3】○個以上買うと1個あたり○○円','数量割引（いわゆるボリュームディスカウント）の適用例です。<br />9個までは単価10000円、10020個で単価9500円、20049個で単価9000円、50個以上で単価8000円というように、単価が割り引き価格になるような数量割引を設定しました。<br /><br />NOTE：　この設定は「商品価格の管理」から行います。<br />※商品の管理＞商品価格の管理　から呼び出すか、あるいは管理画面の商品リストの右端にある[＄]ボタン（緑色のボタン）から呼び出すことができます。<br /><br /><br /><br />【設定メモ：商品価格の管理】<br /><br />以下の設定により、計算式は、購入代金＝割引後価格　×　購入数となります。<br /><br />・ディスカウントタイプ：　割引後価格<br />・この価格からディスカウント：　価格<br />・割引設定<br /><br />　------------------------------------------<br />　割引レベル　　　　最小限の有効数量　　　割引の値<br />　------------------------------------------<br />　割引3　　　　　　　　10　（個）　　　　　　　　　9500　（円）　<br />　割引4　　　　　　　　20　（個）　　　　　　　　　9000　（円）　<br />　割引5　　　　　　　　50　（個）　　　　　　　　　8000　（円）　<br />　------------------------------------------<br />','',0);
INSERT INTO `products_description` VALUES (101,9,'【例3】価格お問い合せ商品（定価とセール価格表示）','この商品はセール対象商品です。商品価格（定価）と特価価格、セール価格が表示されますが、この商品をカゴに入れて注文することはできず、事前のお問い合せが必要です。<br /><br />通常の購入ボタンのかわりに「価格お問い合わせ商品 」ボタンが表示され、クリックするとお問い合せフォームが開きます。<br /><br /><br /><br />【設定メモ】<br /><br />・価格お問い合わせ商品：　はい<br /><br />・商品価格 (ネット)： 10000円<br /><br />・特価価格： 9000円<br />・商品の管理＞セールの管理：　この商品マスターカテゴリに10％のセール設定してある','',0);
INSERT INTO `products_description` VALUES (102,9,'【例1】○個以上買うと1個あたり○％引き','数量割引（いわゆるボリュームディスカウント）の適用例です。<br />9個までは定価、10020個で定価の10％引き、20049個で20％引き、50個以上で25％引きというように、割引率による数量割引を設定しました。<br /><br />NOTE：　この設定は「商品価格の管理」から行います。<br />※商品の管理＞商品価格の管理　から呼び出すか、あるいは管理画面の商品リストの右端にある[＄]ボタン（緑色のボタン）から呼び出すことができます。<br /><br /><br /><br />【設定メモ：商品価格の管理】<br /><br />以下の設定により、計算式は、購入代金＝｛定価×（1\"数量割引率）｝　×　購入数となります。<br />・ディスカウントタイプ：　割引率<br />・この価格からディスカウント：　価格<br />・割引設定<br /><br />　------------------------------------------<br /><br />　割引レベル　　　　最小限の有効数量　　　割引の値<br /><br />　------------------------------------------<br /><br />　割引3　　　　　　　　10　（個）　　　　　　　　　10.0　（％）　<br /><br />　割引4　　　　　　　　20　（個）　　　　　　　　　20.0　（％）　<br /><br />　割引5　　　　　　　　50　（個）　　　　　　　　　25.0　（％）　<br /><br />　------------------------------------------<br /><br />','',0);
INSERT INTO `products_description` VALUES (95,9,'【例2】無料商品：定価1万円のところ価格・送料共に無料化','無料商品で、かつ送料無料の例です。<br /><br /><br />元の商品価格は10000円ですが、無料商品に設定されているため無料となります。<br />また、商品重量は10Kgありますが、送料を無料に設定していますので送料もかかりません。ただし、バーチャル商品＝いいえに設定してあるのでユーザは送付先住所の入力が必要です。<br /><br />【設定メモ】<br />・無料商品： はい<br />・商品価格：　0円<br />・ヴァーチャル商品： いいえ、送付先住所が必要<br />・常に送料無料：　はい、常に送料無料','',0);
INSERT INTO `products_description` VALUES (98,9,'【例5】無料商品：本体無料だけどオプションは有料','商品を無料商品にしても、商品オプションの追加料金の方は有料のままにしたい場合の例です。<br /><br />\r\n\r\nこの例では、カラー＝レッドを選択した場合だけ追加料金（500円増し）が発生する設定になっています。<br />\r\nさらに、「商品が無料のとき属性による価格も無料にする＝いいえ」に設定されているので、商品を無料商品に設定しても\r\n属性価格には影響しません。つまり、レッドを選択すると500円、他の色を選択したときは0円となります。<br /><br />\r\n\r\n\r\n【設定メモ】<br />\r\n・無料商品： はい<br /><br />\r\n\r\n【オプション属性設定メモ： カラー「レッド」】<br />\r\n・オプション名：カラー<br />\r\n・オプション値：レッド<br />\r\n・属性による価格設定：　＋500円<br />\r\n・商品が無料のとき属性による価格も無料にする： いいえ','',0);
INSERT INTO `products_description` VALUES (71,9,'ギフト券 1,000円','ギフト券を購入して、ご家族、お友達、会社の仲間に贈りましょう！','',0);
INSERT INTO `products_description` VALUES (72,9,'ギフト券 2,500円','ギフト券を購入して、ご家族、お友達、会社の仲間に贈りましょう！','',0);
INSERT INTO `products_description` VALUES (73,9,'ギフト券 5,000円','ギフト券を購入して、ご家族、お友達、会社の仲間に贈りましょう！','',0);
INSERT INTO `products_description` VALUES (74,9,'ギフト券 10,000円','ギフト券を購入して、ご家族、お友達、会社の仲間に贈りましょう！','',0);
INSERT INTO `products_description` VALUES (100,9,'【例2】価格お問い合せ商品（価格表示あり）','価格お問い合せ商品の例です<br /><br /><br />この商品には商品価格が表示されますが、この商品をカゴに入れて注文することはできず、事前のお問い合せが必要です。<br /><br />通常の購入ボタンのかわりに「価格お問い合わせ商品 」ボタンが表示され、クリックするとお問い合せフォームが開きます。<br /><br /><br /><br />【設定メモ】<br /><br />・価格お問い合わせ商品：　はい<br /><br />・商品価格 (ネット)： 10000円<br /><br />・特価価格： 9000円','',0);
INSERT INTO `products_description` VALUES (99,9,'【例1】価格お問い合せ商品（定価表示なし）','これは「価格お問い合せ商品」の例です。<br /><br />商品価格（定価）を0円に設定してあり価格表示はされません（ただし無料商品には設定されていないので無料マークはつかない）。この商品をカゴに入れて注文することはできず、事前のお問い合せが必要です。<br /><br />通常の購入ボタンのかわりに「価格お問い合わせ商品 」ボタンが表示され、クリックするとお問い合せフォームが開きます。<br /><br /><br /><br />【設定メモ】<br /><br />・無料商品： いいえ<br /><br />・価格お問い合わせ商品：　はい<br /><br />・商品価格 (ネット)： 0円','',0);
INSERT INTO `products_description` VALUES (92,9,'【例1】無料商品：定価0円、送料も無料','無料商品のサンプルです。もともとの商品価格が0円の商品で、同時に送料も無料に設定した例で、例えばデモ商品やサンプル商品請求などのケースがこれにあたるでしょう。<br /><br /><br />なお、同時購入した他の商品すべてがデモ商品であるときは送料は全く発生しませんが、他に送料がかかる商品も購入すれば、送料は通常通りかかります。<br /><br /><br /><br />【設定メモ】<br /><br />・無料商品： はい<br /><br />・商品価格：　0円<br /><br />・常に送料無料：　はい、常に送料無料<br />','',0);
INSERT INTO `products_description` VALUES (93,9,'【例4】無料商品：特価商品をさらに無料に。送料は有料','無料商品のサンプルです。もともとの商品価格は10000円で、さらに特価価格7500円の商品ですが、無料商品＝「はい」に設定したことにより、結果的に無料商品となります。もとの商品価格と、特価価格の両方が表示され、さらにそれらが打ち消されて無料商品と表示されます。<br /><br />商品自体は無料となりますが、この例では送料は無料とせず、通常送料がかかるよう設定しました。このケースは、サンプル商品請求時に送料だけは負担していただきたいような場合を想定しています。<br /><br /><br /><br />【設定メモ】<br /><br />・無料商品：　はい<br /><br />・商品価格： 10000円<br /><br />・特価価格： 7500円<br /><br />・常に送料無料： いいえ、通常送料を適用<br />','',0);
INSERT INTO `products_description` VALUES (88,9,'Extream Cat（ジェットスキー）','Extream Catシリーズの壁紙です。<br /><br />\r\n\r\n★この商品はダウンロード商品です','',0);
INSERT INTO `products_description` VALUES (89,9,'Extream Cat（サーフィン）','Extream Catシリーズの壁紙です。<br /><br />\r\n\r\n★この商品はダウンロード商品です','',0);
INSERT INTO `products_description` VALUES (90,9,'Extream Cat（カヌー）','Extream Catシリーズの壁紙です。<br /><br />\r\n\r\n★この商品はダウンロード商品です','',0);
INSERT INTO `products_description` VALUES (91,9,'Extream Cat（モトクロス）','Extream Catシリーズの壁紙です。<br /><br />\r\n\r\n★この商品はダウンロード商品です','',0);
INSERT INTO `products_description` VALUES (87,9,'サンプル11','この商品は、他のカテゴリにリンクしていません。','',0);
INSERT INTO `products_description` VALUES (85,9,'サンプル12','この商品は、他のカテゴリにリンクしていません。','',0);
INSERT INTO `products_description` VALUES (86,9,'サンプル09','この商品は、他のカテゴリにリンクしていません。','',0);
INSERT INTO `products_description` VALUES (78,9,'サンプル03','この商品は、他のカテゴリにリンクしていません。','',0);
INSERT INTO `products_description` VALUES (79,9,'サンプル04','この商品は、他のカテゴリにリンクしていません。','',0);
INSERT INTO `products_description` VALUES (80,9,'サンプル05','この商品は、他のカテゴリにリンクしていません。','',0);
INSERT INTO `products_description` VALUES (81,9,'サンプル08','この商品は、他のカテゴリにリンクしていません。','',0);
INSERT INTO `products_description` VALUES (82,9,'サンプル10','この商品は、他のカテゴリにリンクしていません。','',0);
INSERT INTO `products_description` VALUES (83,9,'サンプル06','この商品は、他のカテゴリにリンクしていません。','',0);
INSERT INTO `products_description` VALUES (84,9,'サンプル07','この商品は、他のカテゴリにリンクしていません。','',0);
INSERT INTO `products_description` VALUES (77,9,'サンプル02','この商品は、他のカテゴリにリンクしていません。','',0);
INSERT INTO `products_description` VALUES (76,9,'サンプル01','この商品は、他のカテゴリにリンクしていません。','',0);
INSERT INTO `products_description` VALUES (75,9,'ギフト券（購入時に種類を選択）','ギフト券の種類（額面）をオプション属性で設定する例です','',0);
INSERT INTO `products_description` VALUES (70,9,'ギフト券　500円','ギフト券を購入して、ご家族、お友達、会社の仲間に贈りましょう！','',0);
INSERT INTO `products_description` VALUES (65,9,'I love T-Shirt','定番の「I love T-Shirt」ロゴ。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (63,9,'軍鶏','真っ赤な軍鶏がパワーをくれます。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (64,9,'軍鶏','真っ赤な軍鶏がパワーをくれます。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (62,9,'オルカ（シャチ）','当ショップ定番Tのシャチ柄<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',2);
INSERT INTO `products_description` VALUES (56,9,'ぷにぷに','正体不明の海の生き物。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (57,9,'ぷにぷに for KIDS','正体不明の海の生き物。<br />大人用もございます。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (58,9,'ブルーホエール','神秘的なブルーホエール（くじら）柄。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (59,9,'ホエール for KIDS','神秘的なブルーホエール（くじら）柄。<br />大人用もございます。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (60,9,'オルカ（シャチ）','当ショップ定番Tのシャチ柄<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (61,9,'オルカ（シャチ） for KIDS','当ショップ定番Tのシャチ柄<br />大人用もございます。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (54,9,'ペンギン','人気の皇帝ペンギン柄。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (55,9,'ペンギン for KIDS','人気の皇帝ペンギン柄。<br />大人用もございます。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (52,9,'ザリガニ for KIDS','表情がかわいい真っ赤なザリガニ。隠れたヒット商品です。<br />大人用もございます。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (53,9,'ペンギン','人気の皇帝ペンギン柄。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (46,9,'カフェオレ','ホッと一息つきたい時にやさしいカフェオレ柄はいかがですか？<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (47,9,'ミニチュアダックス','ワン好きにはたまらない、人気のミニチュアダックス柄。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (48,9,'レディー（1）','チャーリーズエンジェルを思わせるお洒落なイラスト。Ubaさんの作品をあしらいました。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','www.flickr.com/photo_zoom.gne?id=4042701&size=m&context=set-101799',0);
INSERT INTO `products_description` VALUES (49,9,'レディー（2）','チャーリーズエンジェルを思わせるお洒落なイラスト。Ubaさんの作品をあしらいました。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','www.flickr.com/photo_zoom.gne?id=4042701&size=m&context=set-101799',0);
INSERT INTO `products_description` VALUES (50,9,'コーラ','ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (51,9,'ザリガニ','表情がかわいい真っ赤なザリガニ。隠れたヒット商品です。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (39,9,'ドラゴン for KIDS','不思議な雰囲気が人気のドラゴン柄です。<br />大人用もございます。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (40,9,'ドラゴン','不思議な雰囲気が人気のドラゴン柄です。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (41,9,'ドラゴン for KIDS','不思議な雰囲気が人気のドラゴン柄です。<br />大人用もございます。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (42,9,'四つ葉のクローバー（2）','シアワセをよぶ四つ葉のクローバー柄です。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (43,9,'ふくろう','冷めた表情のふくろう柄にファン多し。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (44,9,'ふくろう','冷めた表情のふくろう柄にファン多し。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (45,9,'四つ葉のクローバー（1）','シアワセをよぶ四つ葉のクローバー柄です。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (33,9,'レモンソーダ','レモンソーダのイラストがかわいいです。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (34,9,'四つ葉のクローバー（1）','シアワセをよぶ四つ葉のクローバー柄です。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (35,9,'グリーンドラゴン','とぼけた表情が大人気のドラゴン柄。キッズTも揃っているから親子で揃えて！<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (36,9,'グリーンドラゴン for KIDS','とぼけた表情が大人気のドラゴン柄。大人用も揃っているから親子で揃えて！<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (37,9,'首長竜','ドラゴンシリーズの定番柄。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (38,9,'ドラゴン','不思議な雰囲気が人気のドラゴン柄です。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (31,9,'矢印（グリーン）','ビビッドな色使いが印象的なアイコンシリーズ。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (32,9,'アイコン（ハロー）','ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (17,9,'おねむ・・・','ねむた0い春にこんな犬柄はいかが？<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (18,9,'Extream Cat（サーフィン）','エクストリームキャットシリーズ。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (19,9,'ラビット','子供たちにも人気の高いラビットキャラ。キッズTも揃っているから親子で揃えて！<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (20,9,'ラビット for KIDS','子供たちに大人気のラビットキャラ。大人用も揃っているから親子で揃えて！<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (21,9,'和風（竹）','大人気の和柄に竹シリーズ登場です。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (22,9,'和風（竹）','大人気の和柄に竹シリーズ登場です。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (23,9,'アイコン（二人）','ビビッドな色使いが印象的なアイコンシリーズ。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (24,9,'アイコン（ベビー）','ビビッドな色使いが印象的なアイコンシリーズ。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (7,9,'三毛猫 for KIDS','三毛猫の写真をあしらったキュートなTシャツ。猫好きに大人気！<br />大人用もございます。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (30,9,'矢印（イエロー） for KIDS','ビビッドな色使いが印象的なアイコンシリーズ。<br />大人用もございます。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (29,9,'矢印（イエロー）','ビビッドな色使いが印象的なアイコンシリーズ。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (25,9,'花と犬','お花に囲まれシアワ気分の犬の写真をあしらいました。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (26,9,'花と犬 for KIDS','お花に囲まれシアワ気分の犬の写真をあしらいました。大人用も揃っているから親子で揃えて！<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (27,9,'フラミンゴ','とぼけた表情が隠れた人気のフラミンゴ柄。キッズTも揃っているから親子で揃えて！<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (28,9,'フラミンゴ for KIDS','とぼけた表情が隠れた人気のフラミンゴ柄。大人用も揃っているから親子で揃えて！<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (16,9,'レッドドラゴン for KIDS','貴族の紋章のようなドラゴン柄です。<br />大人用もございます。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (15,9,'レッドドラゴン','貴族の紋章のようなドラゴン柄です。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (12,9,'箱の中のこまる for KIDS','段ボール箱に潜り込んだ黒猫\"こまる\"Tシャツ。人気ナンバーワン商品です。<br />\r\n大人用もございます。<br /><br />\r\n\r\nベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 \r\n豊富なカラーバリエーションで人気 No.1のTシャツです。\r\n良質な綿花で知られるメンフィスコットンを主に使用し、 \r\n水分吸収が良くソフトで肌触りが良いのが特徴です。<br /><br />\r\n\r\nNOTE：<br />\r\nこの商品は在庫切れ商品のサンプルです。<br /><br />\r\n【在庫切れ商品】 在庫数が0になると、その商品には在庫切れ商品のアイコンが表示されます。<br />\r\n\r\n・在庫切れ商品は、ユーザは商品情報の閲覧はできますが、注文はできません。<br />\r\n・在庫が0になったときのふるまい（在庫切れアイコンを表示させるかどうか等）は、管理サイトの一般設定＞在庫の管理から制御可能です。以下のような設定ができます。<br />\r\n　　・在庫がなくなった商品に、「カートに入れる」ボタンの<br />\r\n　　　代わりに「売り切れ」アイコンを表示する/しない<br />\r\n　　・在庫切れ商品を注文できる/できない<br />\r\n　　・在庫切れ商品のステータス変更：<br />\r\n　　　在庫がなくなったら商品ステータスをOFFにして、<br />\r\n　　　ショップ上への掲載を自動で取りやめる/やめない<br />\r\n　　・在庫数をチェックして水準以下になったら運営者に<br />\r\n　　　メールで知らせる/知らせない<br />','',0);
INSERT INTO `products_description` VALUES (14,9,'Extream Cat（モトクロス）','エクストリームキャットシリーズ。<br /><br />\r\n\r\nベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br />豊富なカラーバリエーションで人気 No.1のTシャツです。良質な綿花で知られるメンフィスコットンを主に使用し、水分吸収が良くソフトで肌触りが良いのが特徴です。<br /><br />\r\n\r\nNOTE：<br />\r\nこの商品は在庫切れ商品のサンプルです。<br /><br />\r\n【在庫切れ商品】 在庫数が0になると、その商品には在庫切れ商品のアイコンが表示されます。<br />\r\n\r\n・在庫切れ商品は、ユーザは商品情報の閲覧はできますが、注文はできません。<br />\r\n・在庫が0になったときのふるまい（在庫切れアイコンを表示させるかどうか等）は、管理サイトの一般設定＞在庫の管理から制御可能です。以下のような設定ができます。<br />\r\n　　・在庫がなくなった商品に、「カートに入れる」ボタンの<br />\r\n　　　代わりに「売り切れ」アイコンを表示する/しない<br />\r\n　　・在庫切れ商品を注文できる/できない<br />\r\n　　・在庫切れ商品のステータス変更：<br />\r\n　　　在庫がなくなったら商品ステータスをOFFにして、<br />\r\n　　　ショップ上への掲載を自動で取りやめる/やめない<br />\r\n　　・在庫数をチェックして水準以下になったら運営者に<br />\r\n　　　メールで知らせる/知らせない<br />','',0);
INSERT INTO `products_description` VALUES (13,9,'黒猫こまる（2）','当ショップのモデル猫\"こまる\"のTシャツ。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (9,9,'びちっこ','白猫びちっこの写真をあしらったキュートなTシャツ。猫好きに大人気！<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (10,9,'びちっこ','白猫びちっこの写真をあしらったキュートなTシャツ。猫好きに大人気！<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (11,9,'黒猫こまる（1）','段ボール箱にもぐりこんだ子猫のこまるTシャツ。その愛くるしさに当店人気ナンバーワン商品です。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (8,9,'三毛猫','三毛猫の写真をあしらったTシャツです。猫好きに大人気！<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (5,9,'FeedアイコンTシャツ','フィードアイコンTシャツです。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (6,9,'三毛猫','三毛猫の写真をあしらったキュートなTシャツ。猫好きに大人気！<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (1,9,'Zen CartロゴTシャツ','Zen CartオリジナルロゴTシャツです。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (2,9,'Zen CartロゴTシャツ','Zen CartオリジナルロゴTシャツです。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0);
INSERT INTO `products_description` VALUES (3,9,'CCロゴTシャツ','クリエイティブ・コモンズロゴのTシャツです。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','http://www.creativecommons.jp/',0);
INSERT INTO `products_description` VALUES (4,9,'GoogleロゴTシャツ','検索エンジン「Google」のロゴTシャツです。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','www.google.co.jp/',0);
/*!40000 ALTER TABLE `products_description` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_discount_quantity`
--

DROP TABLE IF EXISTS `products_discount_quantity`;
CREATE TABLE `products_discount_quantity` (
  `discount_id` int(4) NOT NULL default '0',
  `products_id` int(11) NOT NULL default '0',
  `discount_qty` float NOT NULL default '0',
  `discount_price` decimal(15,4) NOT NULL default '0.0000',
  KEY `idx_id_qty_zen` (`products_id`,`discount_qty`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table `products_discount_quantity`
--

LOCK TABLES `products_discount_quantity` WRITE;
/*!40000 ALTER TABLE `products_discount_quantity` DISABLE KEYS */;
INSERT INTO `products_discount_quantity` VALUES (2,182,20,'20.0000');
INSERT INTO `products_discount_quantity` VALUES (1,182,10,'10.0000');
INSERT INTO `products_discount_quantity` VALUES (3,102,50,'25.0000');
INSERT INTO `products_discount_quantity` VALUES (2,102,20,'20.0000');
INSERT INTO `products_discount_quantity` VALUES (1,102,10,'10.0000');
INSERT INTO `products_discount_quantity` VALUES (3,103,50,'2000.0000');
INSERT INTO `products_discount_quantity` VALUES (2,103,20,'1500.0000');
INSERT INTO `products_discount_quantity` VALUES (1,103,10,'1000.0000');
INSERT INTO `products_discount_quantity` VALUES (3,104,50,'8000.0000');
INSERT INTO `products_discount_quantity` VALUES (2,104,20,'9000.0000');
INSERT INTO `products_discount_quantity` VALUES (1,104,10,'9500.0000');
INSERT INTO `products_discount_quantity` VALUES (3,110,50,'25.0000');
INSERT INTO `products_discount_quantity` VALUES (2,110,20,'20.0000');
INSERT INTO `products_discount_quantity` VALUES (1,110,10,'10.0000');
INSERT INTO `products_discount_quantity` VALUES (1,111,10,'10.0000');
INSERT INTO `products_discount_quantity` VALUES (2,111,20,'20.0000');
INSERT INTO `products_discount_quantity` VALUES (3,111,50,'25.0000');
INSERT INTO `products_discount_quantity` VALUES (3,112,50,'25.0000');
INSERT INTO `products_discount_quantity` VALUES (2,112,20,'20.0000');
INSERT INTO `products_discount_quantity` VALUES (1,112,10,'10.0000');
INSERT INTO `products_discount_quantity` VALUES (3,113,50,'25.0000');
INSERT INTO `products_discount_quantity` VALUES (2,113,20,'20.0000');
INSERT INTO `products_discount_quantity` VALUES (1,113,10,'10.0000');
INSERT INTO `products_discount_quantity` VALUES (3,182,50,'25.0000');
/*!40000 ALTER TABLE `products_discount_quantity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_notifications`
--

DROP TABLE IF EXISTS `products_notifications`;
CREATE TABLE `products_notifications` (
  `products_id` int(11) NOT NULL default '0',
  `customers_id` int(11) NOT NULL default '0',
  `date_added` datetime NOT NULL default '0001-01-01 00:00:00',
  PRIMARY KEY  (`products_id`,`customers_id`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Table structure for table `products_options`
--

DROP TABLE IF EXISTS `products_options`;
CREATE TABLE `products_options` (
  `products_options_id` int(11) NOT NULL default '0',
  `language_id` int(11) NOT NULL default '1',
  `products_options_name` varchar(32) NOT NULL default '',
  `products_options_sort_order` int(11) NOT NULL default '0',
  `products_options_type` int(5) NOT NULL default '0',
  `products_options_length` smallint(2) NOT NULL default '32',
  `products_options_comment` varchar(64) default NULL,
  `products_options_size` smallint(2) NOT NULL default '32',
  `products_options_images_per_row` int(2) default '5',
  `products_options_images_style` int(1) default '0',
  `products_options_rows` smallint(2) NOT NULL default '1',
  PRIMARY KEY  (`products_options_id`,`language_id`),
  KEY `idx_lang_id_zen` (`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table `products_options`
--

LOCK TABLES `products_options` WRITE;
/*!40000 ALTER TABLE `products_options` DISABLE KEYS */;
INSERT INTO `products_options` VALUES (1,1,'size',1,0,32,NULL,32,0,0,0);
INSERT INTO `products_options` VALUES (1,2,'サイズ',1,0,32,NULL,32,0,0,0);
INSERT INTO `products_options` VALUES (2,1,'size for kids',2,0,32,NULL,32,0,0,0);
INSERT INTO `products_options` VALUES (2,2,'サイズ（キッズ）',2,0,32,NULL,32,0,0,0);
INSERT INTO `products_options` VALUES (3,1,'color',100,2,32,'',32,0,0,0);
INSERT INTO `products_options` VALUES (3,2,'カラー',100,2,32,'カラーを選択してください',32,5,5,0);
INSERT INTO `products_options` VALUES (4,1,'Line1',500,1,80,'Enter your text up to 80 characters, punctuation and spaces.',60,5,0,1);
INSERT INTO `products_options` VALUES (4,2,'名入れ（1）',500,1,80,'1行目に入れる文字を入力してください（全角40文字まで）。',60,5,0,1);
INSERT INTO `products_options` VALUES (5,1,'Line2',510,1,80,'Enter your text up to 80 characters, punctuation and spaces.',60,5,0,1);
INSERT INTO `products_options` VALUES (5,2,'名入れ（2）',510,1,80,'2行目に入れる文字を入力してください（全角40文字まで）。',60,5,0,1);
INSERT INTO `products_options` VALUES (6,1,'How to care, materials',600,5,32,'',32,0,0,0);
INSERT INTO `products_options` VALUES (6,2,'素材とお手入れ方法',600,5,32,'',32,5,0,0);
INSERT INTO `products_options` VALUES (7,1,'Gift',700,3,32,NULL,32,0,0,0);
INSERT INTO `products_options` VALUES (7,2,'ギフトオプション',700,3,32,NULL,32,0,0,0);
INSERT INTO `products_options` VALUES (8,1,'Size(for chckbox)',800,3,32,NULL,32,0,0,0);
INSERT INTO `products_options` VALUES (8,2,'サイズ（大人・キッズ）',800,3,32,NULL,32,0,0,0);
INSERT INTO `products_options` VALUES (9,1,'',0,0,32,NULL,32,0,0,0);
INSERT INTO `products_options` VALUES (9,2,'購入単位',900,0,32,NULL,32,0,0,0);
INSERT INTO `products_options` VALUES (10,1,'',0,2,32,'',32,0,0,0);
INSERT INTO `products_options` VALUES (10,2,'購入単位(radio)',1000,2,32,'',32,0,0,0);
INSERT INTO `products_options` VALUES (11,1,'wallpaper-size',2000,0,32,NULL,32,0,0,0);
INSERT INTO `products_options` VALUES (11,2,'壁紙サイズ',2000,0,32,NULL,32,0,0,0);
INSERT INTO `products_options` VALUES (12,1,'print',2100,2,32,'',32,0,0,0);
INSERT INTO `products_options` VALUES (12,2,'オリジナルプリント',2100,2,32,'',32,0,0,0);
INSERT INTO `products_options` VALUES (13,1,'Package',2200,2,32,NULL,32,0,0,0);
INSERT INTO `products_options` VALUES (13,2,'パッケージ',2200,2,32,NULL,32,0,0,0);
INSERT INTO `products_options` VALUES (14,1,'guarantee',2300,2,32,NULL,32,0,0,0);
INSERT INTO `products_options` VALUES (14,2,'保証サービス',2300,2,32,NULL,32,0,0,0);
INSERT INTO `products_options` VALUES (15,1,'File Type(1)',3000,0,32,'',32,0,0,0);
INSERT INTO `products_options` VALUES (15,2,'マニュアル',3000,0,32,'',32,0,0,0);
INSERT INTO `products_options` VALUES (16,1,'File Type(2)',3100,0,32,'',32,0,0,0);
INSERT INTO `products_options` VALUES (16,2,'ソフト本体',3100,0,32,'',32,0,0,0);
INSERT INTO `products_options` VALUES (17,1,'Media Type',4000,0,32,'',32,0,0,0);
INSERT INTO `products_options` VALUES (17,2,'メディアタイプ',4000,0,32,'',32,0,0,0);
INSERT INTO `products_options` VALUES (18,1,'Attach file',5000,4,32,'',32,0,0,0);
INSERT INTO `products_options` VALUES (18,2,'ロゴ・データ添付',5000,4,32,'',32,0,0,0);
INSERT INTO `products_options` VALUES (19,1,'test',0,0,32,NULL,32,0,0,0);
INSERT INTO `products_options` VALUES (19,2,'テスト',0,0,32,NULL,32,0,0,0);
INSERT INTO `products_options` VALUES (19,9,'テスト',0,0,32,'',32,0,0,1);
INSERT INTO `products_options` VALUES (18,9,'ロゴ・データ添付',5000,4,32,'',32,0,0,1);
INSERT INTO `products_options` VALUES (17,9,'メディアタイプ',4000,0,32,'',32,0,0,1);
INSERT INTO `products_options` VALUES (16,9,'ソフト本体',3100,0,32,'',32,0,0,1);
INSERT INTO `products_options` VALUES (15,9,'マニュアル',3000,0,32,'',32,0,0,1);
INSERT INTO `products_options` VALUES (14,9,'保証サービス',2300,2,32,'',32,0,0,1);
INSERT INTO `products_options` VALUES (13,9,'パッケージ',2200,2,32,'',32,0,0,1);
INSERT INTO `products_options` VALUES (12,9,'オリジナルプリント',2100,2,32,'',32,0,0,1);
INSERT INTO `products_options` VALUES (11,9,'壁紙サイズ',2000,0,32,'',32,0,0,1);
INSERT INTO `products_options` VALUES (10,9,'購入単位(radio)',1000,2,32,'',32,0,0,1);
INSERT INTO `products_options` VALUES (9,9,'購入単位',900,0,32,'',32,0,0,1);
INSERT INTO `products_options` VALUES (8,9,'サイズ（大人・キッズ）',800,3,32,'',32,0,0,1);
INSERT INTO `products_options` VALUES (6,9,'素材とお手入れ方法',600,5,32,'',32,5,0,1);
INSERT INTO `products_options` VALUES (7,9,'ギフトオプション',700,3,32,'',32,0,0,1);
INSERT INTO `products_options` VALUES (2,9,'サイズ（キッズ）',2,0,32,'',32,0,0,1);
INSERT INTO `products_options` VALUES (3,9,'カラー',100,2,32,'カラーを選択してください',32,5,5,1);
INSERT INTO `products_options` VALUES (4,9,'名入れ（1）',500,1,80,'1行目に入れる文字を入力してください（全角40文字まで）。',60,5,0,1);
INSERT INTO `products_options` VALUES (5,9,'名入れ（2）',510,1,80,'2行目に入れる文字を入力してください（全角40文字まで）。',60,5,0,1);
INSERT INTO `products_options` VALUES (1,9,'サイズ',1,0,32,'',32,0,0,1);
/*!40000 ALTER TABLE `products_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_options_types`
--

DROP TABLE IF EXISTS `products_options_types`;
CREATE TABLE `products_options_types` (
  `products_options_types_id` int(11) NOT NULL default '0',
  `products_options_types_name` varchar(32) default NULL,
  PRIMARY KEY  (`products_options_types_id`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis COMMENT='Track products_options_types';

--
-- Dumping data for table `products_options_types`
--

LOCK TABLES `products_options_types` WRITE;
/*!40000 ALTER TABLE `products_options_types` DISABLE KEYS */;
INSERT INTO `products_options_types` VALUES (0,'Dropdown');
INSERT INTO `products_options_types` VALUES (1,'Text');
INSERT INTO `products_options_types` VALUES (2,'Radio');
INSERT INTO `products_options_types` VALUES (3,'Checkbox');
INSERT INTO `products_options_types` VALUES (4,'File');
INSERT INTO `products_options_types` VALUES (5,'Read Only');
/*!40000 ALTER TABLE `products_options_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_options_values`
--

DROP TABLE IF EXISTS `products_options_values`;
CREATE TABLE `products_options_values` (
  `products_options_values_id` int(11) NOT NULL default '0',
  `language_id` int(11) NOT NULL default '1',
  `products_options_values_name` varchar(64) NOT NULL default '',
  `products_options_values_sort_order` int(11) NOT NULL default '0',
  PRIMARY KEY  (`products_options_values_id`,`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table `products_options_values`
--

LOCK TABLES `products_options_values` WRITE;
/*!40000 ALTER TABLE `products_options_values` DISABLE KEYS */;
INSERT INTO `products_options_values` VALUES (0,1,'TEXT',0);
INSERT INTO `products_options_values` VALUES (0,2,'TEXT',0);
INSERT INTO `products_options_values` VALUES (0,9,'TEXT',0);
/*!40000 ALTER TABLE `products_options_values` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_options_values_to_products_options`
--

DROP TABLE IF EXISTS `products_options_values_to_products_options`;
CREATE TABLE `products_options_values_to_products_options` (
  `products_options_values_to_products_options_id` int(11) NOT NULL auto_increment,
  `products_options_id` int(11) NOT NULL default '0',
  `products_options_values_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`products_options_values_to_products_options_id`)
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `products_options_values_to_products_options`
--

LOCK TABLES `products_options_values_to_products_options` WRITE;
/*!40000 ALTER TABLE `products_options_values_to_products_options` DISABLE KEYS */;
INSERT INTO `products_options_values_to_products_options` VALUES (3,1,3);
INSERT INTO `products_options_values_to_products_options` VALUES (4,3,4);
INSERT INTO `products_options_values_to_products_options` VALUES (5,3,5);
INSERT INTO `products_options_values_to_products_options` VALUES (15,4,0);
INSERT INTO `products_options_values_to_products_options` VALUES (7,3,7);
INSERT INTO `products_options_values_to_products_options` VALUES (8,3,8);
INSERT INTO `products_options_values_to_products_options` VALUES (9,2,9);
INSERT INTO `products_options_values_to_products_options` VALUES (10,2,10);
INSERT INTO `products_options_values_to_products_options` VALUES (11,2,11);
INSERT INTO `products_options_values_to_products_options` VALUES (12,2,12);
INSERT INTO `products_options_values_to_products_options` VALUES (13,2,13);
INSERT INTO `products_options_values_to_products_options` VALUES (14,3,14);
INSERT INTO `products_options_values_to_products_options` VALUES (16,5,0);
INSERT INTO `products_options_values_to_products_options` VALUES (17,6,15);
INSERT INTO `products_options_values_to_products_options` VALUES (18,6,16);
INSERT INTO `products_options_values_to_products_options` VALUES (19,6,17);
INSERT INTO `products_options_values_to_products_options` VALUES (20,6,18);
INSERT INTO `products_options_values_to_products_options` VALUES (21,1,19);
INSERT INTO `products_options_values_to_products_options` VALUES (22,1,20);
INSERT INTO `products_options_values_to_products_options` VALUES (23,7,21);
INSERT INTO `products_options_values_to_products_options` VALUES (24,7,22);
INSERT INTO `products_options_values_to_products_options` VALUES (25,7,23);
INSERT INTO `products_options_values_to_products_options` VALUES (26,8,24);
INSERT INTO `products_options_values_to_products_options` VALUES (27,8,25);
INSERT INTO `products_options_values_to_products_options` VALUES (28,8,26);
INSERT INTO `products_options_values_to_products_options` VALUES (29,8,27);
INSERT INTO `products_options_values_to_products_options` VALUES (30,8,28);
INSERT INTO `products_options_values_to_products_options` VALUES (31,8,29);
INSERT INTO `products_options_values_to_products_options` VALUES (32,8,30);
INSERT INTO `products_options_values_to_products_options` VALUES (33,8,31);
INSERT INTO `products_options_values_to_products_options` VALUES (34,9,32);
INSERT INTO `products_options_values_to_products_options` VALUES (35,9,33);
INSERT INTO `products_options_values_to_products_options` VALUES (36,10,34);
INSERT INTO `products_options_values_to_products_options` VALUES (37,10,35);
INSERT INTO `products_options_values_to_products_options` VALUES (38,11,36);
INSERT INTO `products_options_values_to_products_options` VALUES (39,11,37);
INSERT INTO `products_options_values_to_products_options` VALUES (40,3,38);
INSERT INTO `products_options_values_to_products_options` VALUES (41,12,39);
INSERT INTO `products_options_values_to_products_options` VALUES (42,12,40);
INSERT INTO `products_options_values_to_products_options` VALUES (43,12,41);
INSERT INTO `products_options_values_to_products_options` VALUES (44,13,42);
INSERT INTO `products_options_values_to_products_options` VALUES (45,13,43);
INSERT INTO `products_options_values_to_products_options` VALUES (46,14,44);
INSERT INTO `products_options_values_to_products_options` VALUES (47,14,45);
INSERT INTO `products_options_values_to_products_options` VALUES (48,14,46);
INSERT INTO `products_options_values_to_products_options` VALUES (50,12,47);
INSERT INTO `products_options_values_to_products_options` VALUES (51,3,48);
INSERT INTO `products_options_values_to_products_options` VALUES (52,3,49);
INSERT INTO `products_options_values_to_products_options` VALUES (53,3,50);
INSERT INTO `products_options_values_to_products_options` VALUES (54,3,51);
INSERT INTO `products_options_values_to_products_options` VALUES (55,15,52);
INSERT INTO `products_options_values_to_products_options` VALUES (56,15,53);
INSERT INTO `products_options_values_to_products_options` VALUES (57,16,54);
INSERT INTO `products_options_values_to_products_options` VALUES (58,16,55);
INSERT INTO `products_options_values_to_products_options` VALUES (59,16,56);
INSERT INTO `products_options_values_to_products_options` VALUES (60,17,57);
INSERT INTO `products_options_values_to_products_options` VALUES (61,17,58);
INSERT INTO `products_options_values_to_products_options` VALUES (62,18,0);
INSERT INTO `products_options_values_to_products_options` VALUES (63,3,59);
/*!40000 ALTER TABLE `products_options_values_to_products_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_point_rate`
--

DROP TABLE IF EXISTS `products_point_rate`;
CREATE TABLE `products_point_rate` (
  `products_id` int(11) NOT NULL default '0',
  `rate` int(11) NOT NULL default '0',
  PRIMARY KEY  (`products_id`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Table structure for table `products_to_categories`
--

DROP TABLE IF EXISTS `products_to_categories`;
CREATE TABLE `products_to_categories` (
  `products_id` int(11) NOT NULL default '0',
  `categories_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`products_id`,`categories_id`),
  KEY `idx_cat_prod_id_zen` (`categories_id`,`products_id`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table `products_to_categories`
--

LOCK TABLES `products_to_categories` WRITE;
/*!40000 ALTER TABLE `products_to_categories` DISABLE KEYS */;
INSERT INTO `products_to_categories` VALUES (1,2);
INSERT INTO `products_to_categories` VALUES (1,21);
INSERT INTO `products_to_categories` VALUES (2,4);
INSERT INTO `products_to_categories` VALUES (2,21);
INSERT INTO `products_to_categories` VALUES (3,2);
INSERT INTO `products_to_categories` VALUES (4,2);
INSERT INTO `products_to_categories` VALUES (5,4);
INSERT INTO `products_to_categories` VALUES (6,5);
INSERT INTO `products_to_categories` VALUES (6,21);
INSERT INTO `products_to_categories` VALUES (7,7);
INSERT INTO `products_to_categories` VALUES (8,8);
INSERT INTO `products_to_categories` VALUES (9,5);
INSERT INTO `products_to_categories` VALUES (10,8);
INSERT INTO `products_to_categories` VALUES (11,5);
INSERT INTO `products_to_categories` VALUES (11,21);
INSERT INTO `products_to_categories` VALUES (12,7);
INSERT INTO `products_to_categories` VALUES (12,80);
INSERT INTO `products_to_categories` VALUES (13,8);
INSERT INTO `products_to_categories` VALUES (13,27);
INSERT INTO `products_to_categories` VALUES (14,5);
INSERT INTO `products_to_categories` VALUES (14,80);
INSERT INTO `products_to_categories` VALUES (15,9);
INSERT INTO `products_to_categories` VALUES (16,10);
INSERT INTO `products_to_categories` VALUES (17,11);
INSERT INTO `products_to_categories` VALUES (17,27);
INSERT INTO `products_to_categories` VALUES (18,8);
INSERT INTO `products_to_categories` VALUES (19,12);
INSERT INTO `products_to_categories` VALUES (20,7);
INSERT INTO `products_to_categories` VALUES (21,13);
INSERT INTO `products_to_categories` VALUES (21,21);
INSERT INTO `products_to_categories` VALUES (22,13);
INSERT INTO `products_to_categories` VALUES (22,21);
INSERT INTO `products_to_categories` VALUES (23,14);
INSERT INTO `products_to_categories` VALUES (24,14);
INSERT INTO `products_to_categories` VALUES (24,96);
INSERT INTO `products_to_categories` VALUES (25,11);
INSERT INTO `products_to_categories` VALUES (26,7);
INSERT INTO `products_to_categories` VALUES (26,30);
INSERT INTO `products_to_categories` VALUES (27,12);
INSERT INTO `products_to_categories` VALUES (28,7);
INSERT INTO `products_to_categories` VALUES (29,14);
INSERT INTO `products_to_categories` VALUES (29,21);
INSERT INTO `products_to_categories` VALUES (30,7);
INSERT INTO `products_to_categories` VALUES (31,14);
INSERT INTO `products_to_categories` VALUES (32,14);
INSERT INTO `products_to_categories` VALUES (33,13);
INSERT INTO `products_to_categories` VALUES (34,13);
INSERT INTO `products_to_categories` VALUES (35,9);
INSERT INTO `products_to_categories` VALUES (35,27);
INSERT INTO `products_to_categories` VALUES (36,10);
INSERT INTO `products_to_categories` VALUES (37,9);
INSERT INTO `products_to_categories` VALUES (38,9);
INSERT INTO `products_to_categories` VALUES (38,21);
INSERT INTO `products_to_categories` VALUES (38,31);
INSERT INTO `products_to_categories` VALUES (39,10);
INSERT INTO `products_to_categories` VALUES (40,9);
INSERT INTO `products_to_categories` VALUES (41,10);
INSERT INTO `products_to_categories` VALUES (42,13);
INSERT INTO `products_to_categories` VALUES (43,12);
INSERT INTO `products_to_categories` VALUES (44,12);
INSERT INTO `products_to_categories` VALUES (44,30);
INSERT INTO `products_to_categories` VALUES (45,13);
INSERT INTO `products_to_categories` VALUES (46,13);
INSERT INTO `products_to_categories` VALUES (47,11);
INSERT INTO `products_to_categories` VALUES (48,13);
INSERT INTO `products_to_categories` VALUES (48,21);
INSERT INTO `products_to_categories` VALUES (49,13);
INSERT INTO `products_to_categories` VALUES (49,96);
INSERT INTO `products_to_categories` VALUES (50,15);
INSERT INTO `products_to_categories` VALUES (51,16);
INSERT INTO `products_to_categories` VALUES (52,7);
INSERT INTO `products_to_categories` VALUES (53,16);
INSERT INTO `products_to_categories` VALUES (53,30);
INSERT INTO `products_to_categories` VALUES (54,12);
INSERT INTO `products_to_categories` VALUES (54,21);
INSERT INTO `products_to_categories` VALUES (55,7);
INSERT INTO `products_to_categories` VALUES (55,29);
INSERT INTO `products_to_categories` VALUES (56,12);
INSERT INTO `products_to_categories` VALUES (57,17);
INSERT INTO `products_to_categories` VALUES (57,80);
INSERT INTO `products_to_categories` VALUES (57,95);
INSERT INTO `products_to_categories` VALUES (58,12);
INSERT INTO `products_to_categories` VALUES (58,21);
INSERT INTO `products_to_categories` VALUES (59,17);
INSERT INTO `products_to_categories` VALUES (60,12);
INSERT INTO `products_to_categories` VALUES (60,21);
INSERT INTO `products_to_categories` VALUES (61,17);
INSERT INTO `products_to_categories` VALUES (62,16);
INSERT INTO `products_to_categories` VALUES (63,12);
INSERT INTO `products_to_categories` VALUES (63,80);
INSERT INTO `products_to_categories` VALUES (64,16);
INSERT INTO `products_to_categories` VALUES (65,2);
INSERT INTO `products_to_categories` VALUES (65,29);
INSERT INTO `products_to_categories` VALUES (70,20);
INSERT INTO `products_to_categories` VALUES (71,20);
INSERT INTO `products_to_categories` VALUES (72,20);
INSERT INTO `products_to_categories` VALUES (73,20);
INSERT INTO `products_to_categories` VALUES (74,20);
INSERT INTO `products_to_categories` VALUES (75,20);
INSERT INTO `products_to_categories` VALUES (76,22);
INSERT INTO `products_to_categories` VALUES (77,22);
INSERT INTO `products_to_categories` VALUES (78,22);
INSERT INTO `products_to_categories` VALUES (79,22);
INSERT INTO `products_to_categories` VALUES (80,22);
INSERT INTO `products_to_categories` VALUES (81,22);
INSERT INTO `products_to_categories` VALUES (82,22);
INSERT INTO `products_to_categories` VALUES (83,22);
INSERT INTO `products_to_categories` VALUES (84,22);
INSERT INTO `products_to_categories` VALUES (85,22);
INSERT INTO `products_to_categories` VALUES (86,22);
INSERT INTO `products_to_categories` VALUES (87,22);
INSERT INTO `products_to_categories` VALUES (88,23);
INSERT INTO `products_to_categories` VALUES (89,23);
INSERT INTO `products_to_categories` VALUES (89,27);
INSERT INTO `products_to_categories` VALUES (90,23);
INSERT INTO `products_to_categories` VALUES (91,23);
INSERT INTO `products_to_categories` VALUES (92,40);
INSERT INTO `products_to_categories` VALUES (93,40);
INSERT INTO `products_to_categories` VALUES (95,40);
INSERT INTO `products_to_categories` VALUES (98,40);
INSERT INTO `products_to_categories` VALUES (99,41);
INSERT INTO `products_to_categories` VALUES (100,41);
INSERT INTO `products_to_categories` VALUES (101,41);
INSERT INTO `products_to_categories` VALUES (101,64);
INSERT INTO `products_to_categories` VALUES (102,45);
INSERT INTO `products_to_categories` VALUES (103,45);
INSERT INTO `products_to_categories` VALUES (104,45);
INSERT INTO `products_to_categories` VALUES (110,45);
INSERT INTO `products_to_categories` VALUES (111,45);
INSERT INTO `products_to_categories` VALUES (112,45);
INSERT INTO `products_to_categories` VALUES (113,45);
INSERT INTO `products_to_categories` VALUES (115,58);
INSERT INTO `products_to_categories` VALUES (116,58);
INSERT INTO `products_to_categories` VALUES (139,60);
INSERT INTO `products_to_categories` VALUES (140,60);
INSERT INTO `products_to_categories` VALUES (141,61);
INSERT INTO `products_to_categories` VALUES (142,62);
INSERT INTO `products_to_categories` VALUES (143,62);
INSERT INTO `products_to_categories` VALUES (144,63);
INSERT INTO `products_to_categories` VALUES (146,63);
INSERT INTO `products_to_categories` VALUES (151,63);
INSERT INTO `products_to_categories` VALUES (152,63);
INSERT INTO `products_to_categories` VALUES (152,64);
INSERT INTO `products_to_categories` VALUES (155,40);
INSERT INTO `products_to_categories` VALUES (156,67);
INSERT INTO `products_to_categories` VALUES (156,72);
INSERT INTO `products_to_categories` VALUES (157,67);
INSERT INTO `products_to_categories` VALUES (158,67);
INSERT INTO `products_to_categories` VALUES (159,68);
INSERT INTO `products_to_categories` VALUES (160,68);
INSERT INTO `products_to_categories` VALUES (161,68);
INSERT INTO `products_to_categories` VALUES (162,69);
INSERT INTO `products_to_categories` VALUES (163,69);
INSERT INTO `products_to_categories` VALUES (164,69);
INSERT INTO `products_to_categories` VALUES (165,70);
INSERT INTO `products_to_categories` VALUES (166,70);
INSERT INTO `products_to_categories` VALUES (167,70);
INSERT INTO `products_to_categories` VALUES (168,70);
INSERT INTO `products_to_categories` VALUES (169,70);
INSERT INTO `products_to_categories` VALUES (170,71);
INSERT INTO `products_to_categories` VALUES (171,71);
INSERT INTO `products_to_categories` VALUES (172,67);
INSERT INTO `products_to_categories` VALUES (172,72);
INSERT INTO `products_to_categories` VALUES (173,73);
INSERT INTO `products_to_categories` VALUES (174,73);
INSERT INTO `products_to_categories` VALUES (175,73);
INSERT INTO `products_to_categories` VALUES (176,74);
INSERT INTO `products_to_categories` VALUES (177,74);
INSERT INTO `products_to_categories` VALUES (178,74);
INSERT INTO `products_to_categories` VALUES (179,75);
INSERT INTO `products_to_categories` VALUES (180,75);
INSERT INTO `products_to_categories` VALUES (181,75);
INSERT INTO `products_to_categories` VALUES (182,45);
INSERT INTO `products_to_categories` VALUES (183,76);
INSERT INTO `products_to_categories` VALUES (184,76);
INSERT INTO `products_to_categories` VALUES (185,76);
INSERT INTO `products_to_categories` VALUES (187,78);
INSERT INTO `products_to_categories` VALUES (188,78);
INSERT INTO `products_to_categories` VALUES (189,78);
INSERT INTO `products_to_categories` VALUES (190,81);
INSERT INTO `products_to_categories` VALUES (191,81);
INSERT INTO `products_to_categories` VALUES (192,82);
INSERT INTO `products_to_categories` VALUES (193,82);
INSERT INTO `products_to_categories` VALUES (194,82);
INSERT INTO `products_to_categories` VALUES (195,82);
INSERT INTO `products_to_categories` VALUES (196,83);
INSERT INTO `products_to_categories` VALUES (197,83);
INSERT INTO `products_to_categories` VALUES (198,85);
INSERT INTO `products_to_categories` VALUES (199,85);
INSERT INTO `products_to_categories` VALUES (200,78);
INSERT INTO `products_to_categories` VALUES (201,86);
INSERT INTO `products_to_categories` VALUES (202,86);
INSERT INTO `products_to_categories` VALUES (203,86);
INSERT INTO `products_to_categories` VALUES (204,86);
INSERT INTO `products_to_categories` VALUES (205,87);
INSERT INTO `products_to_categories` VALUES (206,87);
INSERT INTO `products_to_categories` VALUES (207,87);
INSERT INTO `products_to_categories` VALUES (208,83);
INSERT INTO `products_to_categories` VALUES (209,89);
INSERT INTO `products_to_categories` VALUES (210,89);
INSERT INTO `products_to_categories` VALUES (211,89);
INSERT INTO `products_to_categories` VALUES (212,91);
INSERT INTO `products_to_categories` VALUES (213,91);
INSERT INTO `products_to_categories` VALUES (214,93);
INSERT INTO `products_to_categories` VALUES (215,93);
INSERT INTO `products_to_categories` VALUES (215,97);
INSERT INTO `products_to_categories` VALUES (217,79);
INSERT INTO `products_to_categories` VALUES (217,98);
INSERT INTO `products_to_categories` VALUES (218,40);
INSERT INTO `products_to_categories` VALUES (222,79);
INSERT INTO `products_to_categories` VALUES (223,79);
INSERT INTO `products_to_categories` VALUES (224,79);
INSERT INTO `products_to_categories` VALUES (225,100);
INSERT INTO `products_to_categories` VALUES (226,100);
INSERT INTO `products_to_categories` VALUES (227,101);
INSERT INTO `products_to_categories` VALUES (229,100);
/*!40000 ALTER TABLE `products_to_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_with_attributes_stock`
--

DROP TABLE IF EXISTS `products_with_attributes_stock`;
CREATE TABLE `products_with_attributes_stock` (
  `stock_id` int(11) NOT NULL auto_increment,
  `products_id` int(11) NOT NULL default '0',
  `stock_attributes` varchar(255) NOT NULL default '',
  `skumodel` varchar(255) NOT NULL default '',
  `quantity` float NOT NULL default '0',
  PRIMARY KEY  (`stock_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `products_with_attributes_stock`
--

LOCK TABLES `products_with_attributes_stock` WRITE;
/*!40000 ALTER TABLE `products_with_attributes_stock` DISABLE KEYS */;
INSERT INTO `products_with_attributes_stock` VALUES (1,90,'319','Ｗ５００',10);
/*!40000 ALTER TABLE `products_with_attributes_stock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_xsell`
--

DROP TABLE IF EXISTS `products_xsell`;
CREATE TABLE `products_xsell` (
  `ID` int(10) NOT NULL auto_increment,
  `products_id` int(10) unsigned NOT NULL default '1',
  `xsell_id` int(10) unsigned NOT NULL default '1',
  `sort_order` int(10) unsigned NOT NULL default '1',
  PRIMARY KEY  (`ID`),
  KEY `idx_products_id_xsell` (`products_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `products_xsell`
--

LOCK TABLES `products_xsell` WRITE;
/*!40000 ALTER TABLE `products_xsell` DISABLE KEYS */;
INSERT INTO `products_xsell` VALUES (1,9,15,1);
INSERT INTO `products_xsell` VALUES (2,9,16,2);
INSERT INTO `products_xsell` VALUES (3,9,35,3);
INSERT INTO `products_xsell` VALUES (4,9,36,4);
/*!40000 ALTER TABLE `products_xsell` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_version`
--

DROP TABLE IF EXISTS `project_version`;
CREATE TABLE `project_version` (
  `project_version_id` tinyint(3) NOT NULL auto_increment,
  `project_version_key` varchar(40) NOT NULL default '',
  `project_version_major` varchar(20) NOT NULL default '',
  `project_version_minor` varchar(20) NOT NULL default '',
  `project_version_patch1` varchar(20) NOT NULL default '',
  `project_version_patch2` varchar(20) NOT NULL default '',
  `project_version_patch1_source` varchar(20) NOT NULL default '',
  `project_version_patch2_source` varchar(20) NOT NULL default '',
  `project_version_comment` varchar(250) NOT NULL default '',
  `project_version_date_applied` datetime NOT NULL default '0001-01-01 01:01:01',
  PRIMARY KEY  (`project_version_id`),
  UNIQUE KEY `idx_project_version_key_zen` (`project_version_key`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=ujis COMMENT='Database Version Tracking';

--
-- Dumping data for table `project_version`
--

LOCK TABLES `project_version` WRITE;
/*!40000 ALTER TABLE `project_version` DISABLE KEYS */;
INSERT INTO `project_version` VALUES (1,'Zen-Cart Main','1','3.0.2-l10n-jp-5','','','','','Fresh Installation','2009-11-19 12:39:40');
INSERT INTO `project_version` VALUES (2,'Zen-Cart Database','1','3.0.2-l10n-jp-5','','','','','Fresh Installation','2009-11-19 12:39:40');
/*!40000 ALTER TABLE `project_version` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_version_history`
--

DROP TABLE IF EXISTS `project_version_history`;
CREATE TABLE `project_version_history` (
  `project_version_id` tinyint(3) NOT NULL auto_increment,
  `project_version_key` varchar(40) NOT NULL default '',
  `project_version_major` varchar(20) NOT NULL default '',
  `project_version_minor` varchar(20) NOT NULL default '',
  `project_version_patch` varchar(20) NOT NULL default '',
  `project_version_comment` varchar(250) NOT NULL default '',
  `project_version_date_applied` datetime NOT NULL default '0001-01-01 01:01:01',
  PRIMARY KEY  (`project_version_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=ujis COMMENT='Database Version Tracking History';

--
-- Dumping data for table `project_version_history`
--

LOCK TABLES `project_version_history` WRITE;
/*!40000 ALTER TABLE `project_version_history` DISABLE KEYS */;
INSERT INTO `project_version_history` VALUES (1,'Zen-Cart Main','1','3.0.2','','Fresh Installation','2009-11-19 12:39:40');
INSERT INTO `project_version_history` VALUES (2,'Zen-Cart Database','1','3.0.2','','Fresh Installation','2009-11-19 12:39:40');
INSERT INTO `project_version_history` VALUES (3,'Zen-Cart Main','1','3.0.2-l10n-jp-1','','v1.3.0.2-l10n-jp-1','2009-11-19 12:39:40');
INSERT INTO `project_version_history` VALUES (4,'Zen-Cart Database','1','3.0.2-l10n-jp-1','','v1.3.0.2-l10n-jp-1','2009-11-19 12:39:40');
INSERT INTO `project_version_history` VALUES (5,'Zen-Cart Main','1','3.0.2-l10n-jp-2','','v1.3.0.2-l10n-jp-2','2009-11-19 12:39:40');
INSERT INTO `project_version_history` VALUES (6,'Zen-Cart Database','1','3.0.2-l10n-jp-2','','v1.3.0.2-l10n-jp-2','2009-11-19 12:39:40');
INSERT INTO `project_version_history` VALUES (7,'Zen-Cart Main','1','3.0.2-l10n-jp-3','','v1.3.0.2-l10n-jp-3','2009-11-19 12:39:40');
INSERT INTO `project_version_history` VALUES (8,'Zen-Cart Database','1','3.0.2-l10n-jp-3','','v1.3.0.2-l10n-jp-3','2009-11-19 12:39:40');
INSERT INTO `project_version_history` VALUES (9,'Zen-Cart Main','1','3.0.2-l10n-jp-4','','v1.3.0.2-l10n-jp-4','2009-11-19 12:39:40');
INSERT INTO `project_version_history` VALUES (10,'Zen-Cart Database','1','3.0.2-l10n-jp-4','','v1.3.0.2-l10n-jp-4','2009-11-19 12:39:40');
INSERT INTO `project_version_history` VALUES (11,'Zen-Cart Main','1','3.0.2-l10n-jp-5','','v1.3.0.2-l10n-jp-5','2009-11-19 12:39:40');
INSERT INTO `project_version_history` VALUES (12,'Zen-Cart Database','1','3.0.2-l10n-jp-5','','v1.3.0.2-l10n-jp-5','2009-11-19 12:39:40');
/*!40000 ALTER TABLE `project_version_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `query_builder`
--

DROP TABLE IF EXISTS `query_builder`;
CREATE TABLE `query_builder` (
  `query_id` int(11) NOT NULL auto_increment,
  `query_category` varchar(40) NOT NULL default '',
  `query_name` varchar(80) NOT NULL default '',
  `query_description` text NOT NULL,
  `query_string` text NOT NULL,
  `query_keys_list` text NOT NULL,
  PRIMARY KEY  (`query_id`),
  UNIQUE KEY `query_name` (`query_name`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=ujis COMMENT='Stores queries for re-use in Admin email and report modules';

--
-- Dumping data for table `query_builder`
--

LOCK TABLES `query_builder` WRITE;
/*!40000 ALTER TABLE `query_builder` DISABLE KEYS */;
INSERT INTO `query_builder` VALUES (1,'email','All Customers','Returns all customers name and email address for sending mass emails (ie: for newsletters, coupons, GV\'s, messages, etc).','select customers_email_address, customers_firstname, customers_lastname from TABLE_CUSTOMERS order by customers_lastname, customers_firstname, customers_email_address','');
INSERT INTO `query_builder` VALUES (2,'email,newsletters','All Newsletter Subscribers','Returns name and email address of newsletter subscribers','select customers_firstname, customers_lastname, customers_email_address from TABLE_CUSTOMERS where customers_newsletter = \'1\'','');
INSERT INTO `query_builder` VALUES (3,'email,newsletters','Dormant Customers (>3months) (Subscribers)','Subscribers who HAVE purchased something, but have NOT purchased for at least three months.','select c.customers_email_address, c.customers_lastname, c.customers_firstname from TABLE_CUSTOMERS c, TABLE_ORDERS o where c.customers_newsletter = \'1\' AND c.customers_id = o.customers_id and o.date_purchased < subdate(now(),INTERVAL 3 MONTH) GROUP BY c.customers_email_address order by c.customers_lastname, c.customers_firstname ASC','');
INSERT INTO `query_builder` VALUES (4,'email,newsletters','Active customers in past 3 months (Subscribers)','Newsletter subscribers who are also active customers (purchased something) in last 3 months.','select c.customers_email_address, c.customers_lastname, c.customers_firstname from TABLE_CUSTOMERS c, TABLE_ORDERS o where c.customers_newsletter = \'1\' AND c.customers_id = o.customers_id and o.date_purchased > subdate(now(),INTERVAL 3 MONTH) GROUP BY c.customers_email_address order by c.customers_lastname, c.customers_firstname ASC','');
INSERT INTO `query_builder` VALUES (5,'email,newsletters','Active customers in past 3 months (Regardless of subscription status)','All active customers (purchased something) in last 3 months, ignoring newsletter-subscription status.','select c.customers_email_address, c.customers_lastname, c.customers_firstname from TABLE_CUSTOMERS c, TABLE_ORDERS o WHERE c.customers_id = o.customers_id and o.date_purchased > subdate(now(),INTERVAL 3 MONTH) GROUP BY c.customers_email_address order by c.customers_lastname, c.customers_firstname ASC','');
INSERT INTO `query_builder` VALUES (6,'email,newsletters','Administrator','Just the email account of the current administrator','select \'ADMIN\' as customers_firstname, admin_name as customers_lastname, admin_email as customers_email_address from TABLE_ADMIN where admin_id = $SESSION:admin_id','');
/*!40000 ALTER TABLE `query_builder` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `record_artists`
--

DROP TABLE IF EXISTS `record_artists`;
CREATE TABLE `record_artists` (
  `artists_id` int(11) NOT NULL auto_increment,
  `artists_name` varchar(32) NOT NULL default '',
  `artists_image` varchar(64) default NULL,
  `date_added` datetime default NULL,
  `last_modified` datetime default NULL,
  PRIMARY KEY  (`artists_id`),
  KEY `idx_rec_artists_name_zen` (`artists_name`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `record_artists`
--

LOCK TABLES `record_artists` WRITE;
/*!40000 ALTER TABLE `record_artists` DISABLE KEYS */;
INSERT INTO `record_artists` VALUES (1,'The Russ Tippins Band','sooty.jpg','2007-01-26 10:42:36',NULL);
/*!40000 ALTER TABLE `record_artists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `record_artists_info`
--

DROP TABLE IF EXISTS `record_artists_info`;
CREATE TABLE `record_artists_info` (
  `artists_id` int(11) NOT NULL default '0',
  `languages_id` int(11) NOT NULL default '0',
  `artists_url` varchar(255) NOT NULL default '',
  `url_clicked` int(5) NOT NULL default '0',
  `date_last_click` datetime default NULL,
  PRIMARY KEY  (`artists_id`,`languages_id`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table `record_artists_info`
--

LOCK TABLES `record_artists_info` WRITE;
/*!40000 ALTER TABLE `record_artists_info` DISABLE KEYS */;
INSERT INTO `record_artists_info` VALUES (1,1,'',0,NULL);
INSERT INTO `record_artists_info` VALUES (1,2,'',0,NULL);
INSERT INTO `record_artists_info` VALUES (1,3,'',0,NULL);
INSERT INTO `record_artists_info` VALUES (1,4,'',0,NULL);
INSERT INTO `record_artists_info` VALUES (1,5,'',0,NULL);
INSERT INTO `record_artists_info` VALUES (1,6,'',0,NULL);
INSERT INTO `record_artists_info` VALUES (1,7,'',0,NULL);
INSERT INTO `record_artists_info` VALUES (1,8,'',0,NULL);
INSERT INTO `record_artists_info` VALUES (1,9,'',0,NULL);
/*!40000 ALTER TABLE `record_artists_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `record_company`
--

DROP TABLE IF EXISTS `record_company`;
CREATE TABLE `record_company` (
  `record_company_id` int(11) NOT NULL auto_increment,
  `record_company_name` varchar(32) NOT NULL default '',
  `record_company_image` varchar(64) default NULL,
  `date_added` datetime default NULL,
  `last_modified` datetime default NULL,
  PRIMARY KEY  (`record_company_id`),
  KEY `idx_rec_company_name_zen` (`record_company_name`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `record_company`
--

LOCK TABLES `record_company` WRITE;
/*!40000 ALTER TABLE `record_company` DISABLE KEYS */;
INSERT INTO `record_company` VALUES (1,'HMV Group',NULL,'2007-01-26 10:43:16','2007-01-26 10:43:59');
/*!40000 ALTER TABLE `record_company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `record_company_info`
--

DROP TABLE IF EXISTS `record_company_info`;
CREATE TABLE `record_company_info` (
  `record_company_id` int(11) NOT NULL default '0',
  `languages_id` int(11) NOT NULL default '0',
  `record_company_url` varchar(255) NOT NULL default '',
  `url_clicked` int(5) NOT NULL default '0',
  `date_last_click` datetime default NULL,
  PRIMARY KEY  (`record_company_id`,`languages_id`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table `record_company_info`
--

LOCK TABLES `record_company_info` WRITE;
/*!40000 ALTER TABLE `record_company_info` DISABLE KEYS */;
INSERT INTO `record_company_info` VALUES (1,1,'www.hmvgroup.com',0,NULL);
INSERT INTO `record_company_info` VALUES (1,2,'www.hmvgroup.com',0,NULL);
INSERT INTO `record_company_info` VALUES (1,3,'www.hmvgroup.com',0,NULL);
INSERT INTO `record_company_info` VALUES (1,4,'www.hmvgroup.com',0,NULL);
INSERT INTO `record_company_info` VALUES (1,5,'www.hmvgroup.com',0,NULL);
INSERT INTO `record_company_info` VALUES (1,6,'www.hmvgroup.com',0,NULL);
INSERT INTO `record_company_info` VALUES (1,7,'www.hmvgroup.com',0,NULL);
INSERT INTO `record_company_info` VALUES (1,8,'www.hmvgroup.com',0,NULL);
INSERT INTO `record_company_info` VALUES (1,9,'www.hmvgroup.com',0,NULL);
/*!40000 ALTER TABLE `record_company_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE `reviews` (
  `reviews_id` int(11) NOT NULL auto_increment,
  `products_id` int(11) NOT NULL default '0',
  `customers_id` int(11) default NULL,
  `customers_name` varchar(64) NOT NULL default '',
  `reviews_rating` int(1) default NULL,
  `date_added` datetime default NULL,
  `last_modified` datetime default NULL,
  `reviews_read` int(5) NOT NULL default '0',
  `status` int(1) NOT NULL default '1',
  PRIMARY KEY  (`reviews_id`),
  KEY `idx_products_id_zen` (`products_id`),
  KEY `idx_customers_id_zen` (`customers_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES (1,19,0,'Bill Smith',5,'2003-12-23 03:18:19','0001-01-01 00:00:00',11,1);
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews_description`
--

DROP TABLE IF EXISTS `reviews_description`;
CREATE TABLE `reviews_description` (
  `reviews_id` int(11) NOT NULL default '0',
  `languages_id` int(11) NOT NULL default '0',
  `reviews_text` text NOT NULL,
  PRIMARY KEY  (`reviews_id`,`languages_id`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table `reviews_description`
--

LOCK TABLES `reviews_description` WRITE;
/*!40000 ALTER TABLE `reviews_description` DISABLE KEYS */;
INSERT INTO `reviews_description` VALUES (1,1,'This really is a very funny but old movie!');
/*!40000 ALTER TABLE `reviews_description` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `salemaker_sales`
--

DROP TABLE IF EXISTS `salemaker_sales`;
CREATE TABLE `salemaker_sales` (
  `sale_id` int(11) NOT NULL auto_increment,
  `sale_status` tinyint(4) NOT NULL default '0',
  `sale_name` varchar(30) NOT NULL default '',
  `sale_deduction_value` decimal(15,4) NOT NULL default '0.0000',
  `sale_deduction_type` tinyint(4) NOT NULL default '0',
  `sale_pricerange_from` decimal(15,4) NOT NULL default '0.0000',
  `sale_pricerange_to` decimal(15,4) NOT NULL default '0.0000',
  `sale_specials_condition` tinyint(4) NOT NULL default '0',
  `sale_categories_selected` text,
  `sale_categories_all` text,
  `sale_date_start` date NOT NULL default '0001-01-01',
  `sale_date_end` date NOT NULL default '0001-01-01',
  `sale_date_added` date NOT NULL default '0001-01-01',
  `sale_date_last_modified` date NOT NULL default '0001-01-01',
  `sale_date_status_change` date NOT NULL default '0001-01-01',
  PRIMARY KEY  (`sale_id`),
  KEY `idx_sale_status_zen` (`sale_status`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `salemaker_sales`
--

LOCK TABLES `salemaker_sales` WRITE;
/*!40000 ALTER TABLE `salemaker_sales` DISABLE KEYS */;
INSERT INTO `salemaker_sales` VALUES (1,1,'10%OFF','10.0000',1,'0.0000','0.0000',2,'64,67',',64,67,','0001-01-01','0001-01-01','2007-01-17','2007-01-18','2007-01-17');
INSERT INTO `salemaker_sales` VALUES (2,1,'500円OFF','500.0000',0,'0.0000','0.0000',2,'68',',68,','0001-01-01','0001-01-01','2007-01-18','2007-01-19','2007-01-18');
INSERT INTO `salemaker_sales` VALUES (3,1,'新価格8000円','8000.0000',2,'0.0000','0.0000',2,'69',',69,','0001-01-01','0001-01-01','2007-01-18','2007-01-19','2007-01-18');
INSERT INTO `salemaker_sales` VALUES (4,1,'10％OFF（特価＋セール）','10.0000',1,'0.0000','0.0000',2,'73',',73,','0001-01-01','0001-01-01','2007-01-18','2007-01-18','2007-01-18');
INSERT INTO `salemaker_sales` VALUES (5,1,'10％OFF（セール優先）','10.0000',1,'0.0000','0.0000',0,'74',',74,','0001-01-01','0001-01-01','2007-01-18','2007-01-18','2007-01-18');
INSERT INTO `salemaker_sales` VALUES (6,1,'10％OFF（特価優先）','10.0000',1,'0.0000','0.0000',1,'75',',75,','0001-01-01','0001-01-01','2007-01-18','2007-01-18','2007-01-18');
INSERT INTO `salemaker_sales` VALUES (7,0,'10％セール期間と価格帯限定','10.0000',1,'10000.0000','0.0000',2,'71',',71,','2007-01-15','2007-06-15','2007-01-18','2007-01-18','2009-11-19');
/*!40000 ALTER TABLE `salemaker_sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `sesskey` varchar(32) NOT NULL default '',
  `expiry` int(11) unsigned NOT NULL default '0',
  `value` text NOT NULL,
  PRIMARY KEY  (`sesskey`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('',1277612410,'initiated|b:1;customers_host_address|s:43:\"nttkyo894111.tkyo.nt.ftth.ppp.infoweb.ne.jp\";language|s:8:\"japanese\";languages_id|s:1:\"9\";languages_code|s:9:\"ja-mobile\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:1:{s:35:\"62:78e6a0b3768d7ebf276544913453c289\";a:1:{s:3:\"qty\";s:1:\"1\";}}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:0:{}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:14:\"116.83.144.111\";new_products_id_in_cart|s:35:\"62:78e6a0b3768d7ebf276544913453c289\";valid_to_checkout|b:1;cart_errors|s:0:\"\";last_secure_page|s:22:\"create_account_success\";customer_first_name|s:4:\"志田\";customer_last_name|s:4:\"裕樹\";customer_first_name_kana|s:4:\"シダ\";customer_last_name_kana|s:6:\"ユウキ\";customer_default_address_id|i:16;customer_country_id|s:3:\"107\";customer_zone_id|s:3:\"194\";customers_authorization|s:1:\"0\";');
INSERT INTO `sessions` VALUES ('ri34sv8gncupi48tv2cjpipmk2',1277612290,'initiated|b:1;customers_host_address|s:43:\"nttkyo894111.tkyo.nt.ftth.ppp.infoweb.ne.jp\";language|s:8:\"japanese\";languages_id|s:1:\"8\";languages_code|s:9:\"ja-mobile\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:1:{i:63;a:1:{s:3:\"qty\";s:1:\"1\";}}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:5:\"zenid\";s:26:\"bsuk88lf4r360aej4b733qprp6\";}s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:14:\"logout_confirm\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:5:\"zenid\";s:26:\"bsuk88lf4r360aej4b733qprp6\";}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:5:\"zenid\";s:26:\"bsuk88lf4r360aej4b733qprp6\";}s:4:\"post\";a:0:{}}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:14:\"116.83.144.111\";new_products_id_in_cart|s:2:\"63\";valid_to_checkout|b:1;cart_errors|s:0:\"\";last_secure_page|s:22:\"create_account_success\";customer_id|i:14;customer_first_name|s:4:\"志田\";customer_last_name|s:4:\"裕樹\";customer_first_name_kana|s:4:\"シダ\";customer_last_name_kana|s:6:\"ユウキ\";customer_default_address_id|i:15;customer_country_id|s:3:\"107\";customer_zone_id|s:3:\"194\";customers_authorization|s:1:\"0\";');
INSERT INTO `sessions` VALUES ('94128e157c062jedn6389io2n0',1277612461,'initiated|b:1;customers_host_address|s:43:\"nttkyo894111.tkyo.nt.ftth.ppp.infoweb.ne.jp\";language|s:8:\"japanese\";languages_id|s:1:\"9\";languages_code|s:9:\"ja-mobile\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:8:{i:0;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:2:{s:5:\"cPath\";s:4:\"1_16\";s:5:\"zenid\";s:26:\"bpte9qj9ujqm45a33ea5t4f233\";}s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:12:\"product_info\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:7:{s:5:\"zenid\";s:26:\"bpte9qj9ujqm45a33ea5t4f233\";s:5:\"cPath\";s:4:\"1_16\";s:11:\"products_id\";s:2:\"62\";s:17:\"number_of_uploads\";s:1:\"0\";s:6:\"action\";s:11:\"add_product\";s:2:\"id\";a:1:{i:2;s:1:\"9\";}s:13:\"cart_quantity\";s:1:\"1\";}s:4:\"post\";a:8:{s:5:\"zenid\";s:26:\"bpte9qj9ujqm45a33ea5t4f233\";s:9:\"main_page\";s:12:\"product_info\";s:5:\"cPath\";s:4:\"1_16\";s:11:\"products_id\";s:2:\"62\";s:17:\"number_of_uploads\";s:1:\"0\";s:6:\"action\";s:11:\"add_product\";s:2:\"id\";a:1:{i:2;s:1:\"9\";}s:13:\"cart_quantity\";s:1:\"1\";}}i:2;a:4:{s:4:\"page\";s:13:\"shopping_cart\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:4:{s:17:\"number_of_uploads\";s:1:\"0\";s:2:\"id\";s:5:\"Array\";s:13:\"cart_quantity\";s:1:\"1\";s:5:\"zenid\";s:26:\"bpte9qj9ujqm45a33ea5t4f233\";}s:4:\"post\";a:0:{}}i:3;a:4:{s:4:\"page\";s:17:\"checkout_shipping\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:5:{s:5:\"zenid\";s:26:\"89brl7qvk9b7jjk10m8kc42lm5\";s:6:\"action\";s:7:\"process\";s:8:\"shipping\";s:9:\"flat_flat\";s:15:\"yamato_timespec\";s:8:\"希望なし\";s:8:\"comments\";s:0:\"\";}s:4:\"post\";a:6:{s:5:\"zenid\";s:26:\"89brl7qvk9b7jjk10m8kc42lm5\";s:9:\"main_page\";s:17:\"checkout_shipping\";s:6:\"action\";s:7:\"process\";s:8:\"shipping\";s:9:\"flat_flat\";s:15:\"yamato_timespec\";s:8:\"希望なし\";s:8:\"comments\";s:0:\"\";}}i:4;a:4:{s:4:\"page\";s:16:\"checkout_payment\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:5:\"zenid\";s:26:\"sdo053v82o35v33gfcmlfj2fo1\";}s:4:\"post\";a:0:{}}i:5;a:4:{s:4:\"page\";s:21:\"checkout_confirmation\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:8:{s:5:\"zenid\";s:26:\"ssqdl9fafrqos6o7kpot1njj95\";s:14:\"dc_redeem_code\";s:0:\"\";s:8:\"cc_owner\";s:9:\"志田 裕樹\";s:9:\"cc_number\";s:0:\"\";s:16:\"cc_expires_month\";s:2:\"01\";s:15:\"cc_expires_year\";s:2:\"10\";s:7:\"payment\";s:3:\"cod\";s:8:\"comments\";s:0:\"\";}s:4:\"post\";a:9:{s:5:\"zenid\";s:26:\"ssqdl9fafrqos6o7kpot1njj95\";s:9:\"main_page\";s:21:\"checkout_confirmation\";s:14:\"dc_redeem_code\";s:0:\"\";s:8:\"cc_owner\";s:9:\"志田 裕樹\";s:9:\"cc_number\";s:0:\"\";s:16:\"cc_expires_month\";s:2:\"01\";s:15:\"cc_expires_year\";s:2:\"10\";s:7:\"payment\";s:3:\"cod\";s:8:\"comments\";s:0:\"\";}}i:6;a:4:{s:4:\"page\";s:16:\"checkout_process\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:5:\"zenid\";s:26:\"3qsna8frrft4t0eagv823c0pr1\";}s:4:\"post\";a:2:{s:5:\"zenid\";s:26:\"3qsna8frrft4t0eagv823c0pr1\";s:9:\"main_page\";s:16:\"checkout_process\";}}i:7;a:4:{s:4:\"page\";s:16:\"checkout_success\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:5:\"zenid\";s:26:\"lqm79ulkc092rvsd57cgitgj93\";}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:14:\"116.83.144.111\";new_products_id_in_cart|s:35:\"62:78e6a0b3768d7ebf276544913453c289\";valid_to_checkout|b:1;cart_errors|s:0:\"\";last_secure_page|s:16:\"checkout_success\";customer_id|s:2:\"15\";customer_default_address_id|s:2:\"16\";customers_authorization|s:1:\"0\";customer_first_name|s:4:\"志田\";customer_last_name|s:4:\"裕樹\";customer_country_id|s:3:\"107\";customer_zone_id|s:3:\"194\";cot_gv|b:0;cc_id|s:0:\"\";order_number_created|i:26;|s:7:\"c_ot_gv\";');
INSERT INTO `sessions` VALUES ('2vhonh4v6m8cv9u24tqa4hqjc0',1277614965,'initiated|b:1;securityToken|s:32:\"d3ec14b8463f58269870a61379a43791\";language|s:8:\"japanese\";languages_id|s:1:\"2\";selected_box|s:13:\"configuration\";');
INSERT INTO `sessions` VALUES ('9tgqpko9rgso4gjbfjbtc7gh54',1277614971,'initiated|b:1;securityToken|s:32:\"48f2c6913d40df170ac310e8d41eaae9\";language|s:8:\"japanese\";languages_id|s:1:\"2\";selected_box|s:13:\"configuration\";html_editor_preference_status|s:4:\"NONE\";admin_id|s:1:\"1\";');
INSERT INTO `sessions` VALUES ('tn4v2eb6bskqnt4lk87gkbcsi0',1277615328,'initiated|b:1;securityToken|s:32:\"50f86a5acde7159b4bdd4d7cb138ac9f\";language|s:8:\"japanese\";languages_id|s:1:\"2\";selected_box|s:13:\"configuration\";html_editor_preference_status|s:4:\"NONE\";admin_id|s:1:\"1\";messageToStack|s:0:\"\";');
INSERT INTO `sessions` VALUES ('kbgjnc73pjrd4rqrrle4g820t4',1277612605,'initiated|b:1;customers_host_address|s:43:\"nttkyo894111.tkyo.nt.ftth.ppp.infoweb.ne.jp\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:5:\"zenid\";s:26:\"bsuk88lf4r360aej4b733qprp6\";}s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:5:\"addon\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:2:{s:6:\"module\";s:15:\"email_templates\";s:2:\"id\";s:1:\"4\";}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:14:\"116.83.144.111\";');
INSERT INTO `sessions` VALUES ('9s5ar01hof6a5q0f9ks0dmr9i4',1277612429,'initiated|b:1;customers_host_address|s:43:\"nttkyo894111.tkyo.nt.ftth.ppp.infoweb.ne.jp\";language|s:8:\"japanese\";languages_id|s:1:\"9\";languages_code|s:9:\"ja-mobile\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:1:{s:35:\"62:78e6a0b3768d7ebf276544913453c289\";a:2:{s:3:\"qty\";i:1;s:10:\"attributes\";a:1:{i:2;s:1:\"9\";}}}s:5:\"total\";d:4725;s:6:\"weight\";d:0.25;s:6:\"cartID\";s:5:\"06851\";s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:5:{i:0;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:2:{s:5:\"cPath\";s:4:\"1_16\";s:5:\"zenid\";s:26:\"bpte9qj9ujqm45a33ea5t4f233\";}s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:12:\"product_info\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:7:{s:5:\"zenid\";s:26:\"bpte9qj9ujqm45a33ea5t4f233\";s:5:\"cPath\";s:4:\"1_16\";s:11:\"products_id\";s:2:\"62\";s:17:\"number_of_uploads\";s:1:\"0\";s:6:\"action\";s:11:\"add_product\";s:2:\"id\";a:1:{i:2;s:1:\"9\";}s:13:\"cart_quantity\";s:1:\"1\";}s:4:\"post\";a:8:{s:5:\"zenid\";s:26:\"bpte9qj9ujqm45a33ea5t4f233\";s:9:\"main_page\";s:12:\"product_info\";s:5:\"cPath\";s:4:\"1_16\";s:11:\"products_id\";s:2:\"62\";s:17:\"number_of_uploads\";s:1:\"0\";s:6:\"action\";s:11:\"add_product\";s:2:\"id\";a:1:{i:2;s:1:\"9\";}s:13:\"cart_quantity\";s:1:\"1\";}}i:2;a:4:{s:4:\"page\";s:13:\"shopping_cart\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:4:{s:17:\"number_of_uploads\";s:1:\"0\";s:2:\"id\";s:5:\"Array\";s:13:\"cart_quantity\";s:1:\"1\";s:5:\"zenid\";s:26:\"bpte9qj9ujqm45a33ea5t4f233\";}s:4:\"post\";a:0:{}}i:3;a:4:{s:4:\"page\";s:17:\"checkout_shipping\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:5:\"zenid\";s:26:\"bpte9qj9ujqm45a33ea5t4f233\";}s:4:\"post\";a:0:{}}i:4;a:4:{s:4:\"page\";s:5:\"login\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:5:\"zenid\";s:26:\"9s5ar01hof6a5q0f9ks0dmr9i4\";}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:4:{s:4:\"page\";s:17:\"checkout_shipping\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:5:\"zenid\";s:26:\"bpte9qj9ujqm45a33ea5t4f233\";}s:4:\"post\";a:0:{}}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:14:\"116.83.144.111\";new_products_id_in_cart|s:35:\"62:78e6a0b3768d7ebf276544913453c289\";valid_to_checkout|b:1;cart_errors|s:0:\"\";last_secure_page|s:17:\"checkout_shipping\";');
INSERT INTO `sessions` VALUES ('ek7kudp0bkev2u9jvhpbo6pud2',1277447044,'initiated|b:1;customers_host_address|s:11:\"pc109.local\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";s:8:\"physical\";s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.109\";payment|N;');
INSERT INTO `sessions` VALUES ('s5i64nkvd8f2l1qdmo110lrpj5',1277447739,'initiated|b:1;customers_host_address|s:11:\"pc109.local\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";s:8:\"physical\";s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.109\";customer_id|s:1:\"3\";customer_default_address_id|s:1:\"3\";customers_authorization|s:1:\"0\";customer_first_name|s:4:\"菱田\";customer_last_name|s:4:\"好美\";customer_country_id|s:3:\"107\";customer_zone_id|s:3:\"182\";valid_to_checkout|b:1;cart_errors|s:0:\"\";cot_gv|b:0;cot_subpoint|b:0;cc_id|s:0:\"\";order_number_created|i:18;|s:13:\"c_ot_addpoint\";new_products_id_in_cart|s:3:\"194\";');
INSERT INTO `sessions` VALUES ('3ope3g4tjl7jmonj8gh5k9boo6',1277576607,'initiated|b:1;customers_host_address|s:15:\"okra.ark-web.jp\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:1:{s:36:\"199:a5b8375ec4b65ef7f7a2d726f14dc364\";a:2:{s:3:\"qty\";i:1;s:10:\"attributes\";a:1:{i:12;i:39;}}}s:5:\"total\";d:14600;s:6:\"weight\";d:0.25;s:6:\"cartID\";s:5:\"46322\";s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:5:{i:0;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:12:\"product_info\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:3:{s:11:\"products_id\";s:3:\"199\";s:17:\"number_of_uploads\";s:1:\"0\";s:6:\"action\";s:11:\"add_product\";}s:4:\"post\";a:5:{s:13:\"cart_quantity\";s:1:\"1\";s:11:\"products_id\";s:3:\"199\";s:1:\"x\";s:2:\"31\";s:1:\"y\";s:1:\"7\";s:2:\"id\";a:1:{i:12;i:39;}}}i:2;a:4:{s:4:\"page\";s:13:\"shopping_cart\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:17:\"number_of_uploads\";s:1:\"0\";}s:4:\"post\";a:0:{}}i:3;a:4:{s:4:\"page\";s:17:\"checkout_shipping\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}i:4;a:4:{s:4:\"page\";s:5:\"login\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:6:\"action\";s:7:\"process\";}s:4:\"post\";a:4:{s:13:\"email_address\";s:5:\"admin\";s:8:\"password\";s:5:\"admin\";s:1:\"x\";s:2:\"27\";s:1:\"y\";s:2:\"12\";}}}s:8:\"snapshot\";a:4:{s:4:\"page\";s:17:\"checkout_shipping\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:12:\"192.168.0.77\";new_products_id_in_cart|s:36:\"199:a5b8375ec4b65ef7f7a2d726f14dc364\";valid_to_checkout|b:1;cart_errors|s:0:\"\";');
INSERT INTO `sessions` VALUES ('jj4edvegaaql920vs6o9ge0ec6',1277576617,'initiated|b:1;customers_host_address|s:15:\"okra.ark-web.jp\";cartID|N;cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:4:{s:36:\"199:a5b8375ec4b65ef7f7a2d726f14dc364\";a:2:{s:3:\"qty\";s:1:\"1\";s:10:\"attributes\";a:1:{i:12;s:2:\"39\";}}i:11;a:1:{s:3:\"qty\";s:1:\"1\";}s:35:\"64:5f8a454d7eac16f952537f1187838525\";a:2:{s:3:\"qty\";s:1:\"1\";s:10:\"attributes\";a:1:{i:1;s:1:\"3\";}}i:9;a:1:{s:3:\"qty\";s:1:\"1\";}}s:5:\"total\";d:28775;s:6:\"weight\";d:1;s:6:\"cartID\";N;s:12:\"content_type\";s:8:\"physical\";s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:5:{i:0;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:12:\"product_info\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:3:{s:11:\"products_id\";s:3:\"199\";s:17:\"number_of_uploads\";s:1:\"0\";s:6:\"action\";s:11:\"add_product\";}s:4:\"post\";a:5:{s:13:\"cart_quantity\";s:1:\"1\";s:11:\"products_id\";s:3:\"199\";s:1:\"x\";s:2:\"31\";s:1:\"y\";s:1:\"7\";s:2:\"id\";a:1:{i:12;i:39;}}}i:2;a:4:{s:4:\"page\";s:13:\"shopping_cart\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:17:\"number_of_uploads\";s:1:\"0\";}s:4:\"post\";a:0:{}}i:3;a:4:{s:4:\"page\";s:17:\"checkout_shipping\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:6:{s:6:\"action\";s:7:\"process\";s:8:\"shipping\";s:9:\"flat_flat\";s:15:\"yamato_timespec\";s:8:\"希望なし\";s:8:\"comments\";s:0:\"\";s:1:\"x\";s:2:\"58\";s:1:\"y\";s:2:\"27\";}}i:4;a:4:{s:4:\"page\";s:16:\"checkout_payment\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:12:\"192.168.0.77\";new_products_id_in_cart|s:36:\"199:a5b8375ec4b65ef7f7a2d726f14dc364\";valid_to_checkout|b:1;cart_errors|s:0:\"\";customer_id|s:1:\"4\";customer_default_address_id|s:1:\"5\";customers_authorization|s:1:\"0\";customer_first_name|s:4:\"志田\";customer_last_name|s:4:\"裕樹\";customer_country_id|s:3:\"107\";customer_zone_id|s:3:\"194\";sendto|s:1:\"5\";payment|N;shipping|a:4:{s:2:\"id\";s:9:\"flat_flat\";s:5:\"title\";s:8:\"定額料金\";s:4:\"cost\";s:4:\"5.00\";s:8:\"timespec\";N;}billto|s:1:\"5\";cot_gv|s:4:\"0.00\";');
INSERT INTO `sessions` VALUES ('phv1ucu8eothjlatq0q89esaq3',1277579805,'initiated|b:1;customers_host_address|s:15:\"okra.ark-web.jp\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:1:{i:92;a:1:{s:3:\"qty\";i:1;}}s:5:\"total\";d:0;s:6:\"weight\";i:0;s:6:\"cartID\";s:5:\"25364\";s:12:\"content_type\";s:8:\"physical\";s:18:\"free_shipping_item\";i:1;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";d:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:4:{s:4:\"page\";s:17:\"checkout_shipping\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:12:\"192.168.0.77\";new_products_id_in_cart|s:2:\"92\";valid_to_checkout|b:1;cart_errors|s:0:\"\";payment|N;');
INSERT INTO `sessions` VALUES ('k7l000qaqliq50dbo9aier8kk2',1277579837,'initiated|b:1;customers_host_address|s:15:\"okra.ark-web.jp\";cartID|N;cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:5:{s:36:\"199:a5b8375ec4b65ef7f7a2d726f14dc364\";a:2:{s:3:\"qty\";s:1:\"1\";s:10:\"attributes\";a:1:{i:12;s:2:\"39\";}}i:11;a:1:{s:3:\"qty\";s:1:\"1\";}s:35:\"64:5f8a454d7eac16f952537f1187838525\";a:2:{s:3:\"qty\";s:1:\"1\";s:10:\"attributes\";a:1:{i:1;s:1:\"3\";}}i:92;a:1:{s:3:\"qty\";s:1:\"1\";}i:9;a:1:{s:3:\"qty\";s:1:\"1\";}}s:5:\"total\";d:28775;s:6:\"weight\";d:1;s:6:\"cartID\";N;s:12:\"content_type\";s:8:\"physical\";s:18:\"free_shipping_item\";i:1;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";d:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:16:\"checkout_process\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:2:{s:12:\"btn_submit_x\";s:3:\"104\";s:12:\"btn_submit_y\";s:2:\"25\";}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:12:\"192.168.0.77\";new_products_id_in_cart|s:2:\"92\";valid_to_checkout|b:1;cart_errors|s:0:\"\";payment|s:3:\"cod\";customer_id|s:1:\"4\";customer_default_address_id|s:1:\"5\";customers_authorization|s:1:\"0\";customer_first_name|s:4:\"志田\";customer_last_name|s:4:\"裕樹\";customer_country_id|s:3:\"107\";customer_zone_id|s:3:\"194\";sendto|s:1:\"5\";shipping|a:4:{s:2:\"id\";s:13:\"yamato_yamato\";s:5:\"title\";s:37:\"ヤマト運輸(宅急便) (1 x 4kg) (宅急便)\";s:4:\"cost\";i:950;s:8:\"timespec\";s:8:\"希望なし\";}calendar_hope_delivery_day|s:8:\"07月01日\";calendar_hope_delivery_time|s:10:\"12時015時\";billto|s:1:\"5\";cot_gv|b:0;cot_subpoint|b:0;comments|s:0:\"\";cc_id|s:0:\"\";order_number_created|i:20;');
INSERT INTO `sessions` VALUES ('kpk7if74mmc5leuj4m296v7jf0',1277584251,'initiated|b:1;customers_host_address|s:15:\"okra.ark-web.jp\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:4:{i:0;a:4:{s:4:\"page\";s:6:\"logoff\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:5:\"cPath\";s:1:\"3\";}s:4:\"post\";a:0:{}}i:2;a:4:{s:4:\"page\";s:12:\"product_info\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:11:\"products_id\";s:2:\"54\";}s:4:\"post\";a:0:{}}i:3;a:4:{s:4:\"page\";s:5:\"login\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:12:\"192.168.0.77\";');
INSERT INTO `sessions` VALUES ('10cu7vlltn8lckd6nv90an78m7',1277585550,'initiated|b:1;customers_host_address|s:15:\"okra.ark-web.jp\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:6:\"logoff\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:12:\"192.168.0.77\";customer_id|i:13;customer_first_name|s:4:\"志田\";customer_last_name|s:4:\"裕樹\";customer_first_name_kana|s:4:\"シダ\";customer_last_name_kana|s:6:\"ユウキ\";customer_default_address_id|i:14;customer_country_id|s:3:\"107\";customer_zone_id|s:3:\"194\";customers_authorization|s:1:\"0\";new_products_id_in_cart|s:36:\"224:e21ef06698eb3286347a85479dd1e917\";valid_to_checkout|b:1;cart_errors|s:0:\"\";cot_gv|b:0;cc_id|s:0:\"\";order_number_created|i:24;|s:7:\"c_ot_gv\";');
INSERT INTO `sessions` VALUES ('j0fceufb9bvvln8r5u6loi8g01',1277586144,'initiated|b:1;customers_host_address|s:43:\"nttkyo894111.tkyo.nt.ftth.ppp.infoweb.ne.jp\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:12:\"product_info\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:3:{s:5:\"cPath\";s:4:\"3_12\";s:11:\"products_id\";s:2:\"43\";s:5:\"zenid\";s:26:\"97rlf0thh8m9begi2qt95o9kp5\";}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:14:\"116.83.144.111\";');
INSERT INTO `sessions` VALUES ('97rlf0thh8m9begi2qt95o9kp5',1277586191,'initiated|b:1;customers_host_address|s:43:\"nttkyo894111.tkyo.nt.ftth.ppp.infoweb.ne.jp\";language|s:8:\"japanese\";languages_id|s:1:\"3\";languages_code|s:9:\"ja-mobile\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:1:{i:50;a:1:{s:3:\"qty\";i:1;}}s:5:\"total\";d:4725;s:6:\"weight\";d:0.25;s:6:\"cartID\";s:5:\"79507\";s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:2:{s:5:\"cPath\";s:4:\"3_12\";s:5:\"zenid\";s:26:\"97rlf0thh8m9begi2qt95o9kp5\";}s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:12:\"product_info\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:3:{s:5:\"cPath\";s:4:\"3_12\";s:11:\"products_id\";s:2:\"43\";s:5:\"zenid\";s:26:\"97rlf0thh8m9begi2qt95o9kp5\";}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:14:\"116.83.144.111\";new_products_id_in_cart|s:2:\"50\";valid_to_checkout|b:1;cart_errors|s:0:\"\";');
INSERT INTO `sessions` VALUES ('2vkgivsb3qd7nj0baavgihqd16',1277589155,'initiated|b:1;securityToken|s:32:\"2ee45526082a5b4ed1195abee39025ec\";language|s:8:\"japanese\";languages_id|s:1:\"2\";selected_box|s:13:\"configuration\";');
INSERT INTO `sessions` VALUES ('r2ne67gv4m265hbl7s6fo01vn0',1277589224,'initiated|b:1;securityToken|s:32:\"d04cd3c1aa41cf6e939d95da72c00a32\";language|s:8:\"japanese\";languages_id|s:1:\"2\";selected_box|s:13:\"configuration\";html_editor_preference_status|s:4:\"NONE\";admin_id|s:1:\"1\";');
INSERT INTO `sessions` VALUES ('iplv04eu8e0ukqld1odml361l4',1277589326,'initiated|b:1;securityToken|s:32:\"53bbffcd2f431614cf48b4310670460e\";language|s:8:\"japanese\";languages_id|s:1:\"2\";selected_box|s:13:\"configuration\";');
INSERT INTO `sessions` VALUES ('ujm1cjjp1l7cjne6d6dajrd7q2',1277589326,'initiated|b:1;securityToken|s:32:\"70b5e636865dc184a6d2a779b7e5d0f7\";language|s:8:\"japanese\";languages_id|s:1:\"2\";selected_box|s:13:\"configuration\";html_editor_preference_status|s:4:\"NONE\";');
INSERT INTO `sessions` VALUES ('660lp9rf0mi4krnsojq9qnr1l4',1277589329,'initiated|b:1;securityToken|s:32:\"8d011ed63fe6a30ca3cf29ab6fb8939a\";language|s:8:\"japanese\";languages_id|s:1:\"2\";selected_box|s:13:\"configuration\";html_editor_preference_status|s:4:\"NONE\";admin_id|s:1:\"1\";');
INSERT INTO `sessions` VALUES ('b5gibb5c1eb077hmnp68d77gs1',1277589329,'initiated|b:1;securityToken|s:32:\"8a3b6617b1ea80c8527235aa271d254a\";language|s:8:\"japanese\";languages_id|s:1:\"2\";selected_box|s:13:\"configuration\";');
INSERT INTO `sessions` VALUES ('kutbqhcl40i644kjrst7057oi7',1277589342,'initiated|b:1;securityToken|s:32:\"0edf8e321c5ae57973a0b40982c87ddf\";language|s:8:\"japanese\";languages_id|s:1:\"2\";selected_box|s:13:\"configuration\";html_editor_preference_status|s:4:\"NONE\";admin_id|s:1:\"1\";');
INSERT INTO `sessions` VALUES ('ucqgu20dsq743lqbfq45hjf497',1277613792,'initiated|b:1;securityToken|s:32:\"854762d908b999bcf3c424f6abefc13f\";language|s:8:\"japanese\";languages_id|s:1:\"2\";selected_box|s:13:\"configuration\";html_editor_preference_status|s:4:\"NONE\";admin_id|s:1:\"1\";messageToStack|s:0:\"\";');
INSERT INTO `sessions` VALUES ('9hltqdhvtib6fei95j1bkr8bu7',1277610770,'initiated|b:1;customers_host_address|s:43:\"nttkyo894111.tkyo.nt.ftth.ppp.infoweb.ne.jp\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:12:\"product_info\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:3:{s:5:\"cPath\";s:4:\"3_12\";s:11:\"products_id\";s:2:\"43\";s:5:\"zenid\";s:26:\"97rlf0thh8m9begi2qt95o9kp5\";}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:14:\"116.83.144.111\";');
INSERT INTO `sessions` VALUES ('m18trp7q01smt4dr49feng4s94',1277610751,'initiated|b:1;customers_host_address|s:43:\"nttkyo894111.tkyo.nt.ftth.ppp.infoweb.ne.jp\";language|s:8:\"japanese\";languages_id|s:1:\"8\";languages_code|s:9:\"ja-mobile\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":8:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:12:\"product_info\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:3:{s:5:\"cPath\";s:4:\"3_12\";s:11:\"products_id\";s:2:\"43\";s:5:\"zenid\";s:26:\"97rlf0thh8m9begi2qt95o9kp5\";}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:14:\"116.83.144.111\";');
INSERT INTO `sessions` VALUES ('jkago43toe153eeu1vg8miccv2',1277610758,'initiated|b:1;customers_host_address|s:43:\"nttkyo894111.tkyo.nt.ftth.ppp.infoweb.ne.jp\";language|s:8:\"japanese\";languages_id|s:1:\"8\";languages_code|s:9:\"ja-mobile\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":8:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:2:{s:5:\"cPath\";s:4:\"3_12\";s:5:\"zenid\";s:26:\"97rlf0thh8m9begi2qt95o9kp5\";}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:14:\"116.83.144.111\";');
INSERT INTO `sessions` VALUES ('iu75b88he4btollvp4k24dlk95',1277610758,'initiated|b:1;customers_host_address|s:43:\"nttkyo894111.tkyo.nt.ftth.ppp.infoweb.ne.jp\";language|s:8:\"japanese\";languages_id|s:1:\"8\";languages_code|s:9:\"ja-mobile\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":8:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:12:\"product_info\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:3:{s:5:\"cPath\";s:4:\"3_12\";s:11:\"products_id\";s:2:\"43\";s:5:\"zenid\";s:26:\"97rlf0thh8m9begi2qt95o9kp5\";}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:14:\"116.83.144.111\";');
INSERT INTO `sessions` VALUES ('7kd982j4loij1rk8otu1q8s957',1277610791,'initiated|b:1;customers_host_address|s:43:\"nttkyo894111.tkyo.nt.ftth.ppp.infoweb.ne.jp\";language|s:8:\"japanese\";languages_id|s:1:\"8\";languages_code|s:9:\"ja-mobile\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:1:{i:43;a:1:{s:3:\"qty\";i:1;}}s:5:\"total\";d:4725;s:6:\"weight\";d:0.25;s:6:\"cartID\";s:5:\"99072\";s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:17:\"checkout_shipping\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:5:\"zenid\";s:26:\"sl3s0qh7atsakd58kd65c2i175\";}s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:5:\"login\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:5:\"zenid\";s:26:\"7kd982j4loij1rk8otu1q8s957\";}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:4:{s:4:\"page\";s:17:\"checkout_shipping\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:5:\"zenid\";s:26:\"sl3s0qh7atsakd58kd65c2i175\";}s:4:\"post\";a:0:{}}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:14:\"116.83.144.111\";new_products_id_in_cart|s:2:\"43\";valid_to_checkout|b:1;cart_errors|s:0:\"\";last_secure_page|s:17:\"checkout_shipping\";');
INSERT INTO `sessions` VALUES ('pencg26emfbagb5sqm04i825o3',1277457035,'initiated|b:1;securityToken|s:32:\"eb1fa7667b20c12625d4a233e76b4a12\";language|s:8:\"japanese\";languages_id|s:1:\"2\";selected_box|s:13:\"configuration\";html_editor_preference_status|s:4:\"NONE\";admin_id|s:1:\"1\";messageToStack|s:0:\"\";');
INSERT INTO `sessions` VALUES ('78maq3kbeqgc64coom01ncm765',1277570881,'initiated|b:1;customers_host_address|s:15:\"okra.ark-web.jp\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":8:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:12:\"192.168.0.77\";');
INSERT INTO `sessions` VALUES ('pdpn49u0rkdnquov0a4caqble6',1277571757,'initiated|b:1;customers_host_address|s:15:\"okra.ark-web.jp\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:1:{i:9;a:1:{s:3:\"qty\";i:1;}}s:5:\"total\";d:4725;s:6:\"weight\";d:0.25;s:6:\"cartID\";s:5:\"35254\";s:12:\"content_type\";s:8:\"physical\";s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:4:{i:0;a:4:{s:4:\"page\";s:22:\"advanced_search_result\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:10:{s:7:\"keyword\";s:8:\"びちっこ\";s:13:\"categories_id\";s:0:\"\";s:10:\"inc_subcat\";s:1:\"1\";s:16:\"manufacturers_id\";s:0:\"\";s:5:\"pfrom\";s:0:\"\";s:3:\"pto\";s:0:\"\";s:5:\"dfrom\";s:0:\"\";s:3:\"dto\";s:0:\"\";s:1:\"x\";s:1:\"0\";s:1:\"y\";s:1:\"0\";}s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:12:\"product_info\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:2:{s:11:\"products_id\";s:1:\"9\";s:6:\"action\";s:11:\"add_product\";}s:4:\"post\";a:4:{s:13:\"cart_quantity\";s:1:\"1\";s:11:\"products_id\";s:1:\"9\";s:1:\"x\";s:2:\"95\";s:1:\"y\";s:2:\"15\";}}i:2;a:4:{s:4:\"page\";s:13:\"shopping_cart\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}i:3;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:4:{s:4:\"page\";s:17:\"checkout_shipping\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:12:\"192.168.0.77\";new_products_id_in_cart|s:1:\"9\";valid_to_checkout|b:1;cart_errors|s:0:\"\";payment|N;');
INSERT INTO `sessions` VALUES ('unuesap4ttvj96c2bp2ati40k2',1277574185,'initiated|b:1;securityToken|s:32:\"f8e9028ff2e7626b8c1997a59b32c34c\";language|s:8:\"japanese\";languages_id|s:1:\"2\";selected_box|s:13:\"configuration\";html_editor_preference_status|s:4:\"NONE\";admin_id|s:1:\"1\";');
INSERT INTO `sessions` VALUES ('5ikabdk0n071jfjd19kjhcp372',1277571787,'initiated|b:1;customers_host_address|s:15:\"okra.ark-web.jp\";cartID|N;cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:3:{i:11;a:1:{s:3:\"qty\";s:1:\"1\";}s:35:\"64:5f8a454d7eac16f952537f1187838525\";a:2:{s:3:\"qty\";s:1:\"1\";s:10:\"attributes\";a:1:{i:1;s:1:\"3\";}}i:9;a:1:{s:3:\"qty\";s:1:\"1\";}}s:5:\"total\";d:14175;s:6:\"weight\";d:0.75;s:6:\"cartID\";N;s:12:\"content_type\";s:8:\"physical\";s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:5:{i:0;a:4:{s:4:\"page\";s:22:\"advanced_search_result\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:10:{s:7:\"keyword\";s:8:\"びちっこ\";s:13:\"categories_id\";s:0:\"\";s:10:\"inc_subcat\";s:1:\"1\";s:16:\"manufacturers_id\";s:0:\"\";s:5:\"pfrom\";s:0:\"\";s:3:\"pto\";s:0:\"\";s:5:\"dfrom\";s:0:\"\";s:3:\"dto\";s:0:\"\";s:1:\"x\";s:1:\"0\";s:1:\"y\";s:1:\"0\";}s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:12:\"product_info\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:2:{s:11:\"products_id\";s:1:\"9\";s:6:\"action\";s:11:\"add_product\";}s:4:\"post\";a:4:{s:13:\"cart_quantity\";s:1:\"1\";s:11:\"products_id\";s:1:\"9\";s:1:\"x\";s:2:\"95\";s:1:\"y\";s:2:\"15\";}}i:2;a:4:{s:4:\"page\";s:13:\"shopping_cart\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}i:3;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}i:4;a:4:{s:4:\"page\";s:16:\"checkout_process\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:2:{s:12:\"btn_submit_x\";s:3:\"121\";s:12:\"btn_submit_y\";s:2:\"13\";}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:12:\"192.168.0.77\";new_products_id_in_cart|s:1:\"9\";valid_to_checkout|b:1;cart_errors|s:0:\"\";payment|s:10:\"moneyorder\";customer_id|s:1:\"4\";customer_default_address_id|s:1:\"5\";customers_authorization|s:1:\"0\";customer_first_name|s:4:\"志田\";customer_last_name|s:4:\"裕樹\";customer_country_id|s:3:\"107\";customer_zone_id|s:3:\"194\";sendto|s:1:\"5\";shipping|a:4:{s:2:\"id\";s:9:\"flat_flat\";s:5:\"title\";s:8:\"定額料金\";s:4:\"cost\";s:4:\"5.00\";s:8:\"timespec\";N;}calendar_hope_delivery_day|s:10:\"最短で発送\";calendar_hope_delivery_time|s:10:\"指定しない\";billto|s:1:\"5\";cot_gv|b:0;cot_subpoint|b:0;comments|s:0:\"\";cc_id|s:0:\"\";order_number_created|i:19;');
INSERT INTO `sessions` VALUES ('rmj10lqunql1lpnarn313g03b7',1277588564,'initiated|b:1;securityToken|s:32:\"61cbf25850f17ff55a4379aaed0c5921\";language|s:8:\"japanese\";languages_id|s:1:\"2\";selected_box|s:13:\"configuration\";html_editor_preference_status|s:4:\"NONE\";admin_id|s:1:\"1\";messageToStack|s:0:\"\";categories_products_sort_order|s:1:\"0\";display_categories_dropdown|i:0;cot_gv|s:4:\"0.00\";cot_subpoint|s:1:\"0\";easy_admin_simplify_message|s:0:\"\";');
INSERT INTO `sessions` VALUES ('1fime8hqmhot90l9tm7f706016',1277582212,'initiated|b:1;customers_host_address|s:15:\"okra.ark-web.jp\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:1:{s:35:\"88:d35fdb7752dae9737fa0d654e6056779\";a:2:{s:3:\"qty\";i:1;s:10:\"attributes\";a:1:{i:11;i:36;}}}s:5:\"total\";d:210;s:6:\"weight\";i:0;s:6:\"cartID\";s:5:\"46055\";s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:1;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";d:210;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:5:{i:0;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:12:\"product_info\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:3:{s:11:\"products_id\";s:2:\"88\";s:17:\"number_of_uploads\";s:1:\"0\";s:6:\"action\";s:11:\"add_product\";}s:4:\"post\";a:5:{s:13:\"cart_quantity\";s:1:\"1\";s:11:\"products_id\";s:2:\"88\";s:1:\"x\";s:2:\"49\";s:1:\"y\";s:2:\"23\";s:2:\"id\";a:1:{i:11;i:36;}}}i:2;a:4:{s:4:\"page\";s:13:\"shopping_cart\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:17:\"number_of_uploads\";s:1:\"0\";}s:4:\"post\";a:0:{}}i:3;a:4:{s:4:\"page\";s:17:\"checkout_shipping\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}i:4;a:4:{s:4:\"page\";s:5:\"login\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:4:{s:4:\"page\";s:17:\"checkout_shipping\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:12:\"192.168.0.77\";new_products_id_in_cart|s:35:\"88:d35fdb7752dae9737fa0d654e6056779\";valid_to_checkout|b:1;cart_errors|s:0:\"\";');
INSERT INTO `sessions` VALUES ('6ft3e28oee0v3g09pjr2jm6qc7',1277612474,'initiated|b:1;customers_host_address|s:43:\"nttkyo894111.tkyo.nt.ftth.ppp.infoweb.ne.jp\";language|s:8:\"japanese\";languages_id|s:1:\"9\";languages_code|s:9:\"ja-mobile\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:20:\"account_history_info\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:2:{s:8:\"order_id\";s:2:\"26\";s:5:\"zenid\";s:26:\"lqm79ulkc092rvsd57cgitgj93\";}s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:5:\"login\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:5:\"zenid\";s:26:\"6ft3e28oee0v3g09pjr2jm6qc7\";}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:4:{s:4:\"page\";s:20:\"account_history_info\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:2:{s:8:\"order_id\";s:2:\"26\";s:5:\"zenid\";s:26:\"lqm79ulkc092rvsd57cgitgj93\";}s:4:\"post\";a:0:{}}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";currency|s:3:\"JPY\";last_secure_page|s:20:\"account_history_info\";session_counter|b:1;customers_ip_address|s:14:\"116.83.144.111\";');
INSERT INTO `sessions` VALUES ('ulvl26rbb4mrs6unqpvk0r92l0',1277612486,'initiated|b:1;customers_host_address|s:43:\"nttkyo894111.tkyo.nt.ftth.ppp.infoweb.ne.jp\";language|s:8:\"japanese\";languages_id|s:1:\"9\";languages_code|s:9:\"ja-mobile\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:20:\"account_history_info\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:2:{s:8:\"order_id\";s:2:\"26\";s:5:\"zenid\";s:26:\"a99vldrjju386q05qks8ehc291\";}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";currency|s:3:\"JPY\";last_secure_page|s:20:\"account_history_info\";session_counter|b:1;customers_ip_address|s:14:\"116.83.144.111\";customer_id|s:2:\"15\";customer_default_address_id|s:2:\"16\";customers_authorization|s:1:\"0\";customer_first_name|s:4:\"志田\";customer_last_name|s:4:\"裕樹\";customer_country_id|s:3:\"107\";customer_zone_id|s:3:\"194\";');
INSERT INTO `sessions` VALUES ('crq3chusm037r7qg4jb60jjep0',1277615557,'initiated|b:1;securityToken|s:32:\"bad39433c98b6d59ea780efc5cedab61\";language|s:8:\"japanese\";languages_id|s:1:\"2\";selected_box|s:13:\"configuration\";');
INSERT INTO `sessions` VALUES ('8bslftr66ncd7jv1opksddqpt6',1277618522,'initiated|b:1;securityToken|s:32:\"6e442fee47cdad482c44d4517bb071e5\";language|s:8:\"japanese\";languages_id|s:1:\"2\";selected_box|s:13:\"configuration\";html_editor_preference_status|s:4:\"NONE\";admin_id|s:1:\"1\";');
INSERT INTO `sessions` VALUES ('2s20qbo1p2p301vphk21gdg9e6',1277615465,'initiated|b:1;customers_host_address|s:43:\"nttkyo894111.tkyo.nt.ftth.ppp.infoweb.ne.jp\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:5:\"addon\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:3:{s:6:\"module\";s:15:\"email_templates\";s:2:\"id\";s:1:\"4\";s:8:\"order_id\";s:2:\"18\";}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:14:\"116.83.144.111\";');
INSERT INTO `sessions` VALUES ('0avlp0c89l21fpdv6u13obc6s4',1279265150,'initiated|b:1;customers_host_address|s:11:\"pc104.local\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.104\";');
INSERT INTO `sessions` VALUES ('uhvlkktibl5f38df2ihn01ift5',1279265787,'initiated|b:1;customers_host_address|s:11:\"pc109.local\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.109\";');
INSERT INTO `sessions` VALUES ('ilm070ksdq2s2kmsbah565e3h3',1279267404,'initiated|b:1;customers_host_address|s:11:\"pc109.local\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:14:\"create_account\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:22:{s:6:\"action\";s:7:\"process\";s:15:\"email_pref_html\";s:12:\"email_format\";s:13:\"email_address\";s:18:\"hishida@ark-web.jp\";s:8:\"password\";s:7:\"hishida\";s:12:\"confirmation\";s:7:\"hishida\";s:9:\"firstname\";s:4:\"菱田\";s:8:\"lastname\";s:4:\"好美\";s:14:\"firstname_kana\";s:6:\"ひしだ\";s:13:\"lastname_kana\";s:6:\"よしみ\";s:7:\"country\";s:3:\"107\";s:8:\"postcode\";s:8:\"061-3201\";s:5:\"state\";s:6:\"北海道\";s:4:\"city\";s:6:\"石狩市\";s:14:\"street_address\";s:15:\"花川南一条4-900\";s:7:\"company\";s:8:\"菱田商事\";s:9:\"telephone\";s:12:\"0133-66-9874\";s:3:\"fax\";s:12:\"0133-66-9874\";s:6:\"gender\";s:1:\"f\";s:3:\"dob\";s:10:\"1978/03/32\";s:18:\"privacy_conditions\";s:1:\"1\";s:1:\"x\";s:2:\"12\";s:1:\"y\";s:1:\"6\";}}i:1;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.109\";');
INSERT INTO `sessions` VALUES ('46gbltmn6d3idbn4qbc955cud1',1279265919,'initiated|b:1;customers_host_address|s:11:\"pc109.local\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:14:\"create_account\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.109\";');
INSERT INTO `sessions` VALUES ('kfdme9fj97boqgaa2779r0bae4',1279265943,'initiated|b:1;customers_host_address|s:11:\"pc109.local\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":8:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.109\";');
INSERT INTO `sessions` VALUES ('qf12neo635lrbso8gtt80k4vk1',1279265986,'initiated|b:1;customers_host_address|s:11:\"pc109.local\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:14:\"create_account\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.109\";');
INSERT INTO `sessions` VALUES ('kpmiqi327qf2bepvsmui73ppj6',1279265999,'initiated|b:1;customers_host_address|s:11:\"pc109.local\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:14:\"create_account\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.109\";');
INSERT INTO `sessions` VALUES ('7f60namdcf8d4msjg1tjiiqmd2',1279270080,'initiated|b:1;customers_host_address|s:11:\"pc109.local\";cartID|s:5:\"40974\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:1:{i:225;a:1:{s:3:\"qty\";s:1:\"2\";}}s:5:\"total\";d:10000;s:6:\"weight\";i:0;s:6:\"cartID\";s:5:\"40974\";s:12:\"content_type\";s:8:\"physical\";s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:3:{i:0;a:4:{s:4:\"page\";s:14:\"create_account\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:22:{s:6:\"action\";s:7:\"process\";s:15:\"email_pref_html\";s:12:\"email_format\";s:13:\"email_address\";s:18:\"hishida@ark-web.jp\";s:8:\"password\";s:7:\"hishida\";s:12:\"confirmation\";s:7:\"hishida\";s:9:\"firstname\";s:4:\"菱田\";s:8:\"lastname\";s:4:\"好美\";s:14:\"firstname_kana\";s:6:\"ひしだ\";s:13:\"lastname_kana\";s:6:\"よしみ\";s:7:\"country\";s:3:\"107\";s:8:\"postcode\";s:8:\"061-3201\";s:5:\"state\";s:6:\"北海道\";s:4:\"city\";s:6:\"石狩市\";s:14:\"street_address\";s:15:\"花川南一条4-900\";s:7:\"company\";s:8:\"菱田商事\";s:9:\"telephone\";s:12:\"0133-66-9874\";s:3:\"fax\";s:12:\"0133-66-9874\";s:6:\"gender\";s:1:\"f\";s:3:\"dob\";s:10:\"2000/02/29\";s:18:\"privacy_conditions\";s:1:\"1\";s:1:\"x\";s:2:\"41\";s:1:\"y\";s:1:\"8\";}}i:1;a:4:{s:4:\"page\";s:22:\"create_account_success\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}i:2;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.109\";customer_id|i:16;customer_first_name|s:4:\"菱田\";customer_last_name|s:4:\"好美\";customer_first_name_kana|s:6:\"ひしだ\";customer_last_name_kana|s:6:\"よしみ\";customer_default_address_id|i:17;customer_country_id|s:3:\"107\";customer_zone_id|s:3:\"182\";customers_authorization|s:1:\"0\";new_products_id_in_cart|s:3:\"225\";valid_to_checkout|b:1;cart_errors|s:0:\"\";addon_search_more_par_page|s:2:\"10\";addon_search_more_sort|s:3:\"20a\";cot_gv|i:0;cc_id|s:0:\"\";order_number_created|i:27;|s:7:\"c_ot_gv\";sendto|i:17;payment|s:10:\"moneyorder\";shipping|a:4:{s:2:\"id\";s:23:\"freeshipper_freeshipper\";s:5:\"title\";s:10:\"配送料無料\";s:4:\"cost\";i:0;s:8:\"timespec\";N;}calendar_hope_delivery_day|s:10:\"最短で発送\";calendar_hope_delivery_time|s:10:\"指定しない\";billto|i:17;comments|s:775:\"あのですね、質問なのですが・・・あのですね、質問なのですが・・・あのですね、質問なのですが・・・あのですね、質問なのですが・・・あのですね、質問なのですが・・・あのですね、質問なのですが\r\n★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaasssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss1233333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333\";');
INSERT INTO `sessions` VALUES ('6bdmuen7kmia0jpdlb1gfd8315',1279268432,'initiated|b:1;customers_host_address|s:11:\"pc109.local\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";s:8:\"physical\";s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:5:\"login\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.109\";payment|N;');
INSERT INTO `sessions` VALUES ('jd6ghi0b2kv2f20ki1m4hlsin2',1279269603,'initiated|b:1;customers_host_address|s:11:\"pc109.local\";cartID|N;cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:1:{i:225;a:1:{s:3:\"qty\";s:1:\"2\";}}s:5:\"total\";d:10000;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";s:8:\"physical\";s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:5:\"login\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:6:\"action\";s:7:\"process\";}s:4:\"post\";a:4:{s:13:\"email_address\";s:18:\"hishida@ark-web.jp\";s:8:\"password\";s:7:\"hishida\";s:1:\"x\";s:2:\"65\";s:1:\"y\";s:1:\"6\";}}i:1;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.109\";payment|s:10:\"moneyorder\";customer_id|s:2:\"16\";customer_default_address_id|s:2:\"17\";customers_authorization|s:1:\"0\";customer_first_name|s:4:\"菱田\";customer_last_name|s:4:\"好美\";customer_country_id|s:3:\"107\";customer_zone_id|s:3:\"182\";valid_to_checkout|b:1;cart_errors|s:0:\"\";sendto|s:2:\"17\";shipping|a:4:{s:2:\"id\";s:23:\"freeshipper_freeshipper\";s:5:\"title\";s:10:\"配送料無料\";s:4:\"cost\";i:0;s:8:\"timespec\";N;}calendar_hope_delivery_day|s:10:\"最短で発送\";calendar_hope_delivery_time|s:10:\"指定しない\";billto|s:2:\"17\";cot_gv|i:0;comments|s:775:\"あのですね、質問なのですが・・・あのですね、質問なのですが・・・あのですね、質問なのですが・・・あのですね、質問なのですが・・・あのですね、質問なのですが・・・あのですね、質問なのですが\r\n★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaasssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss1233333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333\";');
INSERT INTO `sessions` VALUES ('593k8jt89p4vn1oabqs8mk9r82',1279269242,'initiated|b:1;customers_host_address|s:11:\"pc109.local\";cartID|N;cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:1:{i:225;a:1:{s:3:\"qty\";s:1:\"2\";}}s:5:\"total\";d:10000;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";s:8:\"physical\";s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:5:\"login\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:6:\"action\";s:7:\"process\";}s:4:\"post\";a:4:{s:13:\"email_address\";s:18:\"hishida@ark-web.jp\";s:8:\"password\";s:7:\"hishida\";s:1:\"x\";s:1:\"0\";s:1:\"y\";s:1:\"0\";}}i:1;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.109\";payment|s:10:\"moneyorder\";customer_id|s:2:\"16\";customer_default_address_id|s:2:\"17\";customers_authorization|s:1:\"0\";customer_first_name|s:4:\"菱田\";customer_last_name|s:4:\"好美\";customer_country_id|s:3:\"107\";customer_zone_id|s:3:\"182\";valid_to_checkout|b:1;cart_errors|s:0:\"\";sendto|s:2:\"17\";shipping|a:4:{s:2:\"id\";s:23:\"freeshipper_freeshipper\";s:5:\"title\";s:10:\"配送料無料\";s:4:\"cost\";i:0;s:8:\"timespec\";N;}calendar_hope_delivery_day|s:10:\"最短で発送\";calendar_hope_delivery_time|s:10:\"指定しない\";comments|s:775:\"あのですね、質問なのですが・・・あのですね、質問なのですが・・・あのですね、質問なのですが・・・あのですね、質問なのですが・・・あのですね、質問なのですが・・・あのですね、質問なのですが\r\n★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaasssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss1233333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333\";billto|s:2:\"17\";cot_gv|i:0;');
INSERT INTO `sessions` VALUES ('hhlm8ej9kc8gf1o58hi2hqcdq3',1279269163,'initiated|b:1;customers_host_address|s:11:\"pc109.local\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";s:8:\"physical\";s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:5:\"login\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.109\";payment|N;');
INSERT INTO `sessions` VALUES ('f5rkk50sco7ku8hgbkupm3kgr3',1279270262,'initiated|b:1;customers_host_address|s:11:\"pc109.local\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:14:\"create_account\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.109\";');
INSERT INTO `sessions` VALUES ('3k17kqn0stkbl1mrsed6vna3p4',1279270269,'initiated|b:1;customers_host_address|s:11:\"pc109.local\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";s:8:\"physical\";s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:5:\"login\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.109\";payment|N;');
INSERT INTO `sessions` VALUES ('o7p1e1b3ko3cqd6e7sb2tritu3',1279270306,'initiated|b:1;customers_host_address|s:11:\"pc109.local\";cartID|N;cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:1:{i:225;a:1:{s:3:\"qty\";s:1:\"2\";}}s:5:\"total\";d:10000;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";s:8:\"physical\";s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:5:\"login\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:6:\"action\";s:7:\"process\";}s:4:\"post\";a:4:{s:13:\"email_address\";s:18:\"hishida@ark-web.jp\";s:8:\"password\";s:7:\"hishida\";s:1:\"x\";s:1:\"0\";s:1:\"y\";s:1:\"0\";}}i:1;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.109\";payment|s:10:\"moneyorder\";customer_id|s:2:\"16\";customer_default_address_id|s:2:\"17\";customers_authorization|s:1:\"0\";customer_first_name|s:4:\"菱田\";customer_last_name|s:4:\"好美\";customer_country_id|s:3:\"107\";customer_zone_id|s:3:\"182\";valid_to_checkout|b:1;cart_errors|s:0:\"\";sendto|s:2:\"17\";shipping|a:4:{s:2:\"id\";s:23:\"freeshipper_freeshipper\";s:5:\"title\";s:10:\"配送料無料\";s:4:\"cost\";i:0;s:8:\"timespec\";N;}calendar_hope_delivery_day|s:10:\"最短で発送\";calendar_hope_delivery_time|s:10:\"指定しない\";comments|s:775:\"あのですね、質問なのですが・・・あのですね、質問なのですが・・・あのですね、質問なのですが・・・あのですね、質問なのですが・・・あのですね、質問なのですが・・・あのですね、質問なのですが\r\n★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaasssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss1233333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333\";billto|s:2:\"17\";cot_gv|i:0;');
INSERT INTO `sessions` VALUES ('7cm1cvnco96u6hagnphmcaejb2',1279604856,'initiated|b:1;customers_host_address|s:11:\"pc109.local\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:1:{i:89;a:1:{s:3:\"qty\";i:1;}}s:5:\"total\";d:210;s:6:\"weight\";i:0;s:6:\"cartID\";s:5:\"40495\";s:12:\"content_type\";s:7:\"virtual\";s:18:\"free_shipping_item\";i:1;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";d:210;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:4:{s:4:\"page\";s:17:\"checkout_shipping\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.109\";addon_search_more_par_page|s:2:\"10\";addon_search_more_sort|s:3:\"20a\";new_products_id_in_cart|s:2:\"89\";valid_to_checkout|b:1;cart_errors|s:0:\"\";payment|N;');
INSERT INTO `sessions` VALUES ('qp0uvdufa6fnt2csedof9djhj2',1279611563,'initiated|b:1;securityToken|s:32:\"9f2e27bc02ed63f5f76b1dc3325c7396\";language|s:8:\"japanese\";languages_id|s:1:\"2\";selected_box|s:13:\"configuration\";html_editor_preference_status|s:4:\"NONE\";admin_id|s:1:\"1\";categories_products_sort_order|s:1:\"0\";display_categories_dropdown|i:0;option_names_values_copier|s:1:\"1\";page_info|s:58:\"attribute_page=1&products_filter=89&current_category_id=27\";messageToStack|s:0:\"\";');
INSERT INTO `sessions` VALUES ('villsmp4emu9l6fmnva5utbou3',1279604845,'initiated|b:1;customers_host_address|s:11:\"pc109.local\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:13:\"shopping_cart\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:17:\"number_of_uploads\";s:1:\"0\";}s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.109\";valid_to_checkout|b:1;cart_errors|s:0:\"\";');
INSERT INTO `sessions` VALUES ('mrjie5t6lhpcn3fhqp9394urp5',1279607743,'initiated|b:1;customers_host_address|s:11:\"pc109.local\";cartID|N;cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:1:{i:89;a:1:{s:3:\"qty\";s:1:\"1\";}}s:5:\"total\";d:210;s:6:\"weight\";i:0;s:6:\"cartID\";s:5:\"26608\";s:12:\"content_type\";s:5:\"mixed\";s:18:\"free_shipping_item\";i:1;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";d:210;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.109\";addon_search_more_par_page|s:2:\"10\";addon_search_more_sort|s:3:\"20a\";new_products_id_in_cart|s:2:\"19\";valid_to_checkout|b:1;cart_errors|s:0:\"\";payment|N;customer_id|s:2:\"16\";customer_default_address_id|s:2:\"17\";customers_authorization|s:1:\"0\";customer_first_name|s:4:\"菱田\";customer_last_name|s:4:\"好美\";customer_country_id|s:3:\"107\";customer_zone_id|s:3:\"182\";sendto|s:2:\"17\";shipping|a:4:{s:2:\"id\";s:23:\"freeshipper_freeshipper\";s:5:\"title\";s:13:\"配送料無料 ()\";s:4:\"cost\";i:0;s:6:\"module\";s:11:\"freeshipper\";}');
INSERT INTO `sessions` VALUES ('1k0j0s5t37p44q1v39ljbdt8h3',1279612748,'initiated|b:1;customers_host_address|s:11:\"pc104.local\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":8:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.104\";');
INSERT INTO `sessions` VALUES ('03hcbr7sv6prh1qua9vdbm51o3',1279620013,'initiated|b:1;securityToken|s:32:\"87db7fecd097b323e534c3d7056fc559\";language|s:8:\"japanese\";languages_id|s:1:\"2\";selected_box|s:5:\"tools\";html_editor_preference_status|s:4:\"NONE\";admin_id|s:1:\"1\";messageToStack|s:0:\"\";');
INSERT INTO `sessions` VALUES ('27arla5buurof9t7jm1i7rosd0',1279615838,'initiated|b:1;customers_host_address|s:11:\"pc104.local\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:5:\"addon\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:3:{s:6:\"module\";s:15:\"email_templates\";s:2:\"id\";s:1:\"4\";s:11:\"language_id\";s:1:\"2\";}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.104\";');
INSERT INTO `sessions` VALUES ('qhevhu02q88ks5e96ugbk086s1',1279624699,'initiated|b:1;customers_host_address|s:11:\"pc104.local\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.104\";');
INSERT INTO `sessions` VALUES ('sl4inlcdm066vemlv3eeft60j2',1279674118,'initiated|b:1;customers_host_address|s:11:\"pc104.local\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.104\";');
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `so_payment_types`
--

DROP TABLE IF EXISTS `so_payment_types`;
CREATE TABLE `so_payment_types` (
  `payment_type_id` int(11) NOT NULL auto_increment,
  `language_id` int(11) NOT NULL default '1',
  `payment_type_code` varchar(4) NOT NULL default '',
  `payment_type_full` varchar(20) NOT NULL default '',
  PRIMARY KEY  (`payment_type_id`),
  UNIQUE KEY `type_code` (`payment_type_code`),
  KEY `type_code_2` (`payment_type_code`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `so_payment_types`
--

LOCK TABLES `so_payment_types` WRITE;
/*!40000 ALTER TABLE `so_payment_types` DISABLE KEYS */;
INSERT INTO `so_payment_types` VALUES (1,1,'CA','Cash');
INSERT INTO `so_payment_types` VALUES (2,1,'CK','Check');
INSERT INTO `so_payment_types` VALUES (3,1,'MO','Money Order');
INSERT INTO `so_payment_types` VALUES (4,1,'ADJ','Adjustment');
INSERT INTO `so_payment_types` VALUES (5,1,'CC','Credit Card');
INSERT INTO `so_payment_types` VALUES (6,1,'MC','Master Card');
INSERT INTO `so_payment_types` VALUES (7,1,'VISA','Visa');
INSERT INTO `so_payment_types` VALUES (8,1,'AMEX','American Express');
INSERT INTO `so_payment_types` VALUES (9,1,'DISC','Discover');
/*!40000 ALTER TABLE `so_payment_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `so_payments`
--

DROP TABLE IF EXISTS `so_payments`;
CREATE TABLE `so_payments` (
  `payment_id` int(11) NOT NULL auto_increment,
  `orders_id` int(11) NOT NULL default '0',
  `payment_number` varchar(32) NOT NULL default '',
  `payment_name` varchar(40) NOT NULL default '',
  `payment_amount` decimal(14,2) NOT NULL default '0.00',
  `payment_type` varchar(20) NOT NULL default '',
  `date_posted` datetime NOT NULL default '0000-00-00 00:00:00',
  `last_modified` datetime NOT NULL default '0000-00-00 00:00:00',
  `purchase_order_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`payment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table `so_payments`
--

LOCK TABLES `so_payments` WRITE;
/*!40000 ALTER TABLE `so_payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `so_payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `so_purchase_orders`
--

DROP TABLE IF EXISTS `so_purchase_orders`;
CREATE TABLE `so_purchase_orders` (
  `purchase_order_id` int(11) NOT NULL auto_increment,
  `orders_id` int(11) NOT NULL default '0',
  `po_number` varchar(32) default NULL,
  `date_posted` datetime NOT NULL default '0000-00-00 00:00:00',
  `last_modified` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`purchase_order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table `so_purchase_orders`
--

LOCK TABLES `so_purchase_orders` WRITE;
/*!40000 ALTER TABLE `so_purchase_orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `so_purchase_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `so_refunds`
--

DROP TABLE IF EXISTS `so_refunds`;
CREATE TABLE `so_refunds` (
  `refund_id` int(11) NOT NULL auto_increment,
  `payment_id` int(11) NOT NULL default '0',
  `orders_id` int(11) NOT NULL default '0',
  `refund_number` varchar(32) NOT NULL default '',
  `refund_name` varchar(40) NOT NULL default '',
  `refund_amount` decimal(14,2) NOT NULL default '0.00',
  `refund_type` varchar(4) NOT NULL default 'CK',
  `date_posted` datetime NOT NULL default '0000-00-00 00:00:00',
  `last_modified` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`refund_id`),
  KEY `refund_id` (`refund_id`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table `so_refunds`
--

LOCK TABLES `so_refunds` WRITE;
/*!40000 ALTER TABLE `so_refunds` DISABLE KEYS */;
/*!40000 ALTER TABLE `so_refunds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `specials`
--

DROP TABLE IF EXISTS `specials`;
CREATE TABLE `specials` (
  `specials_id` int(11) NOT NULL auto_increment,
  `products_id` int(11) NOT NULL default '0',
  `specials_new_products_price` decimal(15,4) NOT NULL default '0.0000',
  `specials_date_added` datetime default NULL,
  `specials_last_modified` datetime default NULL,
  `expires_date` date NOT NULL default '0001-01-01',
  `date_status_change` datetime default NULL,
  `status` int(1) NOT NULL default '1',
  `specials_date_available` date NOT NULL default '0001-01-01',
  PRIMARY KEY  (`specials_id`),
  KEY `idx_status_zen` (`status`),
  KEY `idx_products_id_zen` (`products_id`),
  KEY `idx_date_avail_zen` (`specials_date_available`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `specials`
--

LOCK TABLES `specials` WRITE;
/*!40000 ALTER TABLE `specials` DISABLE KEYS */;
INSERT INTO `specials` VALUES (1,1,'4050.0000','2007-01-16 00:29:45',NULL,'0001-01-01',NULL,1,'0001-01-01');
INSERT INTO `specials` VALUES (2,17,'3800.0000','2007-01-16 00:31:09','2007-01-16 00:31:50','0001-01-01',NULL,1,'0001-01-01');
INSERT INTO `specials` VALUES (3,79,'2000.0000','2007-01-16 00:34:02',NULL,'0001-01-01',NULL,1,'0001-01-01');
INSERT INTO `specials` VALUES (4,93,'7500.0000','2007-01-16 15:11:23','2007-01-16 15:50:07','0001-01-01',NULL,1,'0001-01-01');
INSERT INTO `specials` VALUES (7,101,'9000.0000','2007-01-16 17:24:53',NULL,'0001-01-01',NULL,1,'0001-01-01');
INSERT INTO `specials` VALUES (27,212,'450.0000','2007-01-26 11:08:19',NULL,'0001-01-01',NULL,1,'0001-01-01');
INSERT INTO `specials` VALUES (11,111,'5000.0000','2007-01-16 20:38:12','2007-01-16 21:13:28','0001-01-01',NULL,1,'0001-01-01');
INSERT INTO `specials` VALUES (10,110,'9500.0000','2007-01-16 20:38:12','2007-01-16 21:10:17','0001-01-01',NULL,1,'0001-01-01');
INSERT INTO `specials` VALUES (12,113,'5000.0000','2007-01-16 21:03:43','2007-01-16 21:14:42','0001-01-01',NULL,1,'0001-01-01');
INSERT INTO `specials` VALUES (13,165,'8000.0000','2007-01-18 14:08:42','2007-01-18 14:13:02','0001-01-01',NULL,1,'0001-01-01');
INSERT INTO `specials` VALUES (14,166,'5000.0000','2007-01-18 14:28:21',NULL,'0001-01-01',NULL,1,'0001-01-01');
INSERT INTO `specials` VALUES (15,167,'5000.0000','2007-01-18 14:28:40',NULL,'0001-01-01',NULL,1,'0001-01-01');
INSERT INTO `specials` VALUES (16,168,'5000.0000','2007-01-18 14:28:51',NULL,'0001-01-01',NULL,1,'0001-01-01');
INSERT INTO `specials` VALUES (17,169,'5000.0000','2007-01-18 14:29:19','2007-01-18 14:29:48','2007-06-15','2009-11-19 12:41:47',0,'2007-01-15');
INSERT INTO `specials` VALUES (18,173,'5000.0000','2007-01-18 14:30:15',NULL,'0001-01-01',NULL,1,'0001-01-01');
INSERT INTO `specials` VALUES (19,174,'5000.0000','2007-01-18 14:30:26',NULL,'0001-01-01',NULL,1,'0001-01-01');
INSERT INTO `specials` VALUES (20,175,'5000.0000','2007-01-18 14:30:35',NULL,'0001-01-01',NULL,1,'0001-01-01');
INSERT INTO `specials` VALUES (21,176,'5000.0000','2007-01-18 14:30:53',NULL,'0001-01-01',NULL,1,'0001-01-01');
INSERT INTO `specials` VALUES (22,177,'5000.0000','2007-01-18 14:31:03',NULL,'0001-01-01',NULL,1,'0001-01-01');
INSERT INTO `specials` VALUES (23,178,'5000.0000','2007-01-18 14:31:11',NULL,'0001-01-01',NULL,1,'0001-01-01');
INSERT INTO `specials` VALUES (24,179,'5000.0000','2007-01-18 14:34:01',NULL,'0001-01-01',NULL,1,'0001-01-01');
INSERT INTO `specials` VALUES (25,180,'5000.0000','2007-01-18 14:34:11',NULL,'0001-01-01',NULL,1,'0001-01-01');
INSERT INTO `specials` VALUES (26,181,'5000.0000','2007-01-18 14:34:24',NULL,'0001-01-01',NULL,1,'0001-01-01');
/*!40000 ALTER TABLE `specials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tax_class`
--

DROP TABLE IF EXISTS `tax_class`;
CREATE TABLE `tax_class` (
  `tax_class_id` int(11) NOT NULL auto_increment,
  `tax_class_title` varchar(32) NOT NULL default '',
  `tax_class_description` varchar(255) NOT NULL default '',
  `last_modified` datetime default NULL,
  `date_added` datetime NOT NULL default '0001-01-01 00:00:00',
  PRIMARY KEY  (`tax_class_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `tax_class`
--

LOCK TABLES `tax_class` WRITE;
/*!40000 ALTER TABLE `tax_class` DISABLE KEYS */;
INSERT INTO `tax_class` VALUES (1,'消費税','消費税（日本）','2007-01-15 11:43:40','2004-01-21 01:35:29');
/*!40000 ALTER TABLE `tax_class` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tax_class_m17n`
--

DROP TABLE IF EXISTS `tax_class_m17n`;
CREATE TABLE `tax_class_m17n` (
  `tax_class_id` int(11) NOT NULL default '0',
  `language_id` int(11) NOT NULL default '0',
  `tax_class_title` varchar(32) NOT NULL default '',
  `tax_class_description` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`tax_class_id`,`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table `tax_class_m17n`
--

LOCK TABLES `tax_class_m17n` WRITE;
/*!40000 ALTER TABLE `tax_class_m17n` DISABLE KEYS */;
INSERT INTO `tax_class_m17n` VALUES (1,1,'消費税','消費税（日本）');
INSERT INTO `tax_class_m17n` VALUES (1,2,'消費税','消費税（日本）');
INSERT INTO `tax_class_m17n` VALUES (1,9,'消費税','消費税（日本）');
/*!40000 ALTER TABLE `tax_class_m17n` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tax_rates`
--

DROP TABLE IF EXISTS `tax_rates`;
CREATE TABLE `tax_rates` (
  `tax_rates_id` int(11) NOT NULL auto_increment,
  `tax_zone_id` int(11) NOT NULL default '0',
  `tax_class_id` int(11) NOT NULL default '0',
  `tax_priority` int(5) default '1',
  `tax_rate` decimal(7,4) NOT NULL default '0.0000',
  `tax_description` varchar(255) NOT NULL default '',
  `last_modified` datetime default NULL,
  `date_added` datetime NOT NULL default '0001-01-01 00:00:00',
  PRIMARY KEY  (`tax_rates_id`),
  KEY `idx_tax_zone_id_zen` (`tax_zone_id`),
  KEY `idx_tax_class_id_zen` (`tax_class_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `tax_rates`
--

LOCK TABLES `tax_rates` WRITE;
/*!40000 ALTER TABLE `tax_rates` DISABLE KEYS */;
INSERT INTO `tax_rates` VALUES (1,1,1,1,'5.0000','消費税：5%','2007-01-15 11:44:17','2006-11-29 16:18:40');
/*!40000 ALTER TABLE `tax_rates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tax_rates_m17n`
--

DROP TABLE IF EXISTS `tax_rates_m17n`;
CREATE TABLE `tax_rates_m17n` (
  `tax_rates_id` int(11) NOT NULL default '0',
  `language_id` int(11) NOT NULL default '0',
  `tax_description` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`tax_rates_id`,`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table `tax_rates_m17n`
--

LOCK TABLES `tax_rates_m17n` WRITE;
/*!40000 ALTER TABLE `tax_rates_m17n` DISABLE KEYS */;
INSERT INTO `tax_rates_m17n` VALUES (1,1,'消費税：5%');
INSERT INTO `tax_rates_m17n` VALUES (1,2,'消費税：5%');
INSERT INTO `tax_rates_m17n` VALUES (1,9,'消費税：5%');
/*!40000 ALTER TABLE `tax_rates_m17n` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `template_select`
--

DROP TABLE IF EXISTS `template_select`;
CREATE TABLE `template_select` (
  `template_id` int(11) NOT NULL auto_increment,
  `template_dir` varchar(64) NOT NULL default '',
  `template_language` varchar(64) NOT NULL default '0',
  PRIMARY KEY  (`template_id`),
  KEY `idx_tpl_lang_zen` (`template_language`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `template_select`
--

LOCK TABLES `template_select` WRITE;
/*!40000 ALTER TABLE `template_select` DISABLE KEYS */;
INSERT INTO `template_select` VALUES (1,'sugudeki','0');
INSERT INTO `template_select` VALUES (8,'zen_mobile','9');
/*!40000 ALTER TABLE `template_select` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `upgrade_exceptions`
--

DROP TABLE IF EXISTS `upgrade_exceptions`;
CREATE TABLE `upgrade_exceptions` (
  `upgrade_exception_id` smallint(5) NOT NULL auto_increment,
  `sql_file` varchar(50) default NULL,
  `reason` varchar(200) default NULL,
  `errordate` datetime default '0001-01-01 00:00:00',
  `sqlstatement` text,
  PRIMARY KEY  (`upgrade_exception_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `upgrade_exceptions`
--

LOCK TABLES `upgrade_exceptions` WRITE;
/*!40000 ALTER TABLE `upgrade_exceptions` DISABLE KEYS */;
INSERT INTO `upgrade_exceptions` VALUES (1,'mysql_zencart.sql','REASON_TABLE_NOT_FOUND CHECK PREFIXES!','2009-11-19 12:39:41','UPDATE query_builder SET query_name = \'全顧客\' WHERE query_id =1 LIMIT 1;');
INSERT INTO `upgrade_exceptions` VALUES (2,'mysql_zencart.sql','REASON_TABLE_NOT_FOUND CHECK PREFIXES!','2009-11-19 12:39:41','UPDATE query_builder SET query_name = \'メールマガジン希望者\' WHERE query_id =2 LIMIT 1;');
INSERT INTO `upgrade_exceptions` VALUES (3,'mysql_zencart.sql','REASON_TABLE_NOT_FOUND CHECK PREFIXES!','2009-11-19 12:39:41','UPDATE query_builder SET query_name = \'休眠顧客（過去三ヶ月間、配信希望者のみ）\' WHERE query_id =3 LIMIT 1;');
INSERT INTO `upgrade_exceptions` VALUES (4,'mysql_zencart.sql','REASON_TABLE_NOT_FOUND CHECK PREFIXES!','2009-11-19 12:39:41','UPDATE query_builder SET query_name = \'稼動顧客（過去三ヶ月間、配信希望者のみ）\' WHERE query_id =4 LIMIT 1;');
INSERT INTO `upgrade_exceptions` VALUES (5,'mysql_zencart.sql','REASON_TABLE_NOT_FOUND CHECK PREFIXES!','2009-11-19 12:39:41','UPDATE query_builder SET query_name = \'稼動顧客（過去三ヶ月間）\' WHERE query_id =5 LIMIT 1;');
INSERT INTO `upgrade_exceptions` VALUES (6,'mysql_zencart.sql','REASON_TABLE_NOT_FOUND CHECK PREFIXES!','2009-11-19 12:39:41','UPDATE query_builder SET query_name = \'管理者\' WHERE query_id =6 LIMIT 1;');
/*!40000 ALTER TABLE `upgrade_exceptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visitors`
--

DROP TABLE IF EXISTS `visitors`;
CREATE TABLE `visitors` (
  `visitors_id` int(11) NOT NULL default '0',
  `visitors_email_address` varchar(96) NOT NULL default '',
  `visitors_info_date_account_created` datetime default NULL,
  `visitors_info_date_account_last_modified` datetime default NULL,
  PRIMARY KEY  (`visitors_id`),
  KEY `IDX_visitors_email_address` (`visitors_email_address`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Table structure for table `visitors_orders`
--

DROP TABLE IF EXISTS `visitors_orders`;
CREATE TABLE `visitors_orders` (
  `orders_id` int(11) NOT NULL default '0',
  `visitors_id` int(11) NOT NULL default '0',
  `last_modified` datetime default NULL,
  `date_purchased` datetime default NULL,
  PRIMARY KEY  (`orders_id`),
  KEY `IDX_visitors_id` (`visitors_id`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Table structure for table `whos_online`
--

DROP TABLE IF EXISTS `whos_online`;
CREATE TABLE `whos_online` (
  `customer_id` int(11) default NULL,
  `full_name` varchar(64) NOT NULL default '',
  `session_id` varchar(128) NOT NULL default '',
  `ip_address` varchar(15) NOT NULL default '',
  `time_entry` varchar(14) NOT NULL default '',
  `time_last_click` varchar(14) NOT NULL default '',
  `last_page_url` varchar(255) NOT NULL default '',
  `host_address` text NOT NULL,
  `user_agent` varchar(255) NOT NULL default '',
  KEY `idx_ip_address_zen` (`ip_address`),
  KEY `idx_session_id_zen` (`session_id`),
  KEY `idx_customer_id_zen` (`customer_id`),
  KEY `idx_time_entry_zen` (`time_entry`),
  KEY `idx_time_last_click_zen` (`time_last_click`),
  KEY `idx_last_page_url_zen` (`last_page_url`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Table structure for table `zones`
--

DROP TABLE IF EXISTS `zones`;
CREATE TABLE `zones` (
  `zone_id` int(11) NOT NULL auto_increment,
  `zone_country_id` int(11) NOT NULL default '0',
  `zone_code` varchar(32) NOT NULL default '',
  `zone_name` varchar(32) NOT NULL default '',
  PRIMARY KEY  (`zone_id`)
) ENGINE=MyISAM AUTO_INCREMENT=229 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `zones`
--

LOCK TABLES `zones` WRITE;
/*!40000 ALTER TABLE `zones` DISABLE KEYS */;
INSERT INTO `zones` VALUES (1,223,'AL','Alabama');
INSERT INTO `zones` VALUES (2,223,'AK','Alaska');
INSERT INTO `zones` VALUES (3,223,'AS','American Samoa');
INSERT INTO `zones` VALUES (4,223,'AZ','Arizona');
INSERT INTO `zones` VALUES (5,223,'AR','Arkansas');
INSERT INTO `zones` VALUES (6,223,'AF','Armed Forces Africa');
INSERT INTO `zones` VALUES (7,223,'AA','Armed Forces Americas');
INSERT INTO `zones` VALUES (8,223,'AC','Armed Forces Canada');
INSERT INTO `zones` VALUES (9,223,'AE','Armed Forces Europe');
INSERT INTO `zones` VALUES (10,223,'AM','Armed Forces Middle East');
INSERT INTO `zones` VALUES (11,223,'AP','Armed Forces Pacific');
INSERT INTO `zones` VALUES (12,223,'CA','California');
INSERT INTO `zones` VALUES (13,223,'CO','Colorado');
INSERT INTO `zones` VALUES (14,223,'CT','Connecticut');
INSERT INTO `zones` VALUES (15,223,'DE','Delaware');
INSERT INTO `zones` VALUES (16,223,'DC','District of Columbia');
INSERT INTO `zones` VALUES (17,223,'FM','Federated States Of Micronesia');
INSERT INTO `zones` VALUES (18,223,'FL','Florida');
INSERT INTO `zones` VALUES (19,223,'GA','Georgia');
INSERT INTO `zones` VALUES (20,223,'GU','Guam');
INSERT INTO `zones` VALUES (21,223,'HI','Hawaii');
INSERT INTO `zones` VALUES (22,223,'ID','Idaho');
INSERT INTO `zones` VALUES (23,223,'IL','Illinois');
INSERT INTO `zones` VALUES (24,223,'IN','Indiana');
INSERT INTO `zones` VALUES (25,223,'IA','Iowa');
INSERT INTO `zones` VALUES (26,223,'KS','Kansas');
INSERT INTO `zones` VALUES (27,223,'KY','Kentucky');
INSERT INTO `zones` VALUES (28,223,'LA','Louisiana');
INSERT INTO `zones` VALUES (29,223,'ME','Maine');
INSERT INTO `zones` VALUES (30,223,'MH','Marshall Islands');
INSERT INTO `zones` VALUES (31,223,'MD','Maryland');
INSERT INTO `zones` VALUES (32,223,'MA','Massachusetts');
INSERT INTO `zones` VALUES (33,223,'MI','Michigan');
INSERT INTO `zones` VALUES (34,223,'MN','Minnesota');
INSERT INTO `zones` VALUES (35,223,'MS','Mississippi');
INSERT INTO `zones` VALUES (36,223,'MO','Missouri');
INSERT INTO `zones` VALUES (37,223,'MT','Montana');
INSERT INTO `zones` VALUES (38,223,'NE','Nebraska');
INSERT INTO `zones` VALUES (39,223,'NV','Nevada');
INSERT INTO `zones` VALUES (40,223,'NH','New Hampshire');
INSERT INTO `zones` VALUES (41,223,'NJ','New Jersey');
INSERT INTO `zones` VALUES (42,223,'NM','New Mexico');
INSERT INTO `zones` VALUES (43,223,'NY','New York');
INSERT INTO `zones` VALUES (44,223,'NC','North Carolina');
INSERT INTO `zones` VALUES (45,223,'ND','North Dakota');
INSERT INTO `zones` VALUES (46,223,'MP','Northern Mariana Islands');
INSERT INTO `zones` VALUES (47,223,'OH','Ohio');
INSERT INTO `zones` VALUES (48,223,'OK','Oklahoma');
INSERT INTO `zones` VALUES (49,223,'OR','Oregon');
INSERT INTO `zones` VALUES (50,223,'PW','Palau');
INSERT INTO `zones` VALUES (51,223,'PA','Pennsylvania');
INSERT INTO `zones` VALUES (52,223,'PR','Puerto Rico');
INSERT INTO `zones` VALUES (53,223,'RI','Rhode Island');
INSERT INTO `zones` VALUES (54,223,'SC','South Carolina');
INSERT INTO `zones` VALUES (55,223,'SD','South Dakota');
INSERT INTO `zones` VALUES (56,223,'TN','Tennessee');
INSERT INTO `zones` VALUES (57,223,'TX','Texas');
INSERT INTO `zones` VALUES (58,223,'UT','Utah');
INSERT INTO `zones` VALUES (59,223,'VT','Vermont');
INSERT INTO `zones` VALUES (60,223,'VI','Virgin Islands');
INSERT INTO `zones` VALUES (61,223,'VA','Virginia');
INSERT INTO `zones` VALUES (62,223,'WA','Washington');
INSERT INTO `zones` VALUES (63,223,'WV','West Virginia');
INSERT INTO `zones` VALUES (64,223,'WI','Wisconsin');
INSERT INTO `zones` VALUES (65,223,'WY','Wyoming');
INSERT INTO `zones` VALUES (66,38,'AB','Alberta');
INSERT INTO `zones` VALUES (67,38,'BC','British Columbia');
INSERT INTO `zones` VALUES (68,38,'MB','Manitoba');
INSERT INTO `zones` VALUES (69,38,'NF','Newfoundland');
INSERT INTO `zones` VALUES (70,38,'NB','New Brunswick');
INSERT INTO `zones` VALUES (71,38,'NS','Nova Scotia');
INSERT INTO `zones` VALUES (72,38,'NT','Northwest Territories');
INSERT INTO `zones` VALUES (73,38,'NU','Nunavut');
INSERT INTO `zones` VALUES (74,38,'ON','Ontario');
INSERT INTO `zones` VALUES (75,38,'PE','Prince Edward Island');
INSERT INTO `zones` VALUES (76,38,'QC','Quebec');
INSERT INTO `zones` VALUES (77,38,'SK','Saskatchewan');
INSERT INTO `zones` VALUES (78,38,'YT','Yukon Territory');
INSERT INTO `zones` VALUES (79,81,'NDS','Niedersachsen');
INSERT INTO `zones` VALUES (80,81,'BAW','Baden-Wrttemberg');
INSERT INTO `zones` VALUES (81,81,'BAY','Bayern');
INSERT INTO `zones` VALUES (82,81,'BER','Berlin');
INSERT INTO `zones` VALUES (83,81,'BRG','Brandenburg');
INSERT INTO `zones` VALUES (84,81,'BRE','Bremen');
INSERT INTO `zones` VALUES (85,81,'HAM','Hamburg');
INSERT INTO `zones` VALUES (86,81,'HES','Hessen');
INSERT INTO `zones` VALUES (87,81,'MEC','Mecklenburg-Vorpommern');
INSERT INTO `zones` VALUES (88,81,'NRW','Nordrhein-Westfalen');
INSERT INTO `zones` VALUES (89,81,'RHE','Rheinland-Pfalz');
INSERT INTO `zones` VALUES (90,81,'SAR','Saarland');
INSERT INTO `zones` VALUES (91,81,'SAS','Sachsen');
INSERT INTO `zones` VALUES (92,81,'SAC','Sachsen-Anhalt');
INSERT INTO `zones` VALUES (93,81,'SCN','Schleswig-Holstein');
INSERT INTO `zones` VALUES (94,81,'THE','Thringen');
INSERT INTO `zones` VALUES (95,14,'WI','Wien');
INSERT INTO `zones` VALUES (96,14,'NO','Niedersterreich');
INSERT INTO `zones` VALUES (97,14,'OO','Obersterreich');
INSERT INTO `zones` VALUES (98,14,'SB','Salzburg');
INSERT INTO `zones` VALUES (99,14,'KN','Kten');
INSERT INTO `zones` VALUES (100,14,'ST','Steiermark');
INSERT INTO `zones` VALUES (101,14,'TI','Tirol');
INSERT INTO `zones` VALUES (102,14,'BL','Burgenland');
INSERT INTO `zones` VALUES (103,14,'VB','Voralberg');
INSERT INTO `zones` VALUES (104,204,'AG','Aargau');
INSERT INTO `zones` VALUES (105,204,'AI','Appenzell Innerrhoden');
INSERT INTO `zones` VALUES (106,204,'AR','Appenzell Ausserrhoden');
INSERT INTO `zones` VALUES (107,204,'BE','Bern');
INSERT INTO `zones` VALUES (108,204,'BL','Basel-Landschaft');
INSERT INTO `zones` VALUES (109,204,'BS','Basel-Stadt');
INSERT INTO `zones` VALUES (110,204,'FR','Freiburg');
INSERT INTO `zones` VALUES (111,204,'GE','Genf');
INSERT INTO `zones` VALUES (112,204,'GL','Glarus');
INSERT INTO `zones` VALUES (113,204,'JU','Graubnden');
INSERT INTO `zones` VALUES (114,204,'JU','Jura');
INSERT INTO `zones` VALUES (115,204,'LU','Luzern');
INSERT INTO `zones` VALUES (116,204,'NE','Neuenburg');
INSERT INTO `zones` VALUES (117,204,'NW','Nidwalden');
INSERT INTO `zones` VALUES (118,204,'OW','Obwalden');
INSERT INTO `zones` VALUES (119,204,'SG','St. Gallen');
INSERT INTO `zones` VALUES (120,204,'SH','Schaffhausen');
INSERT INTO `zones` VALUES (121,204,'SO','Solothurn');
INSERT INTO `zones` VALUES (122,204,'SZ','Schwyz');
INSERT INTO `zones` VALUES (123,204,'TG','Thurgau');
INSERT INTO `zones` VALUES (124,204,'TI','Tessin');
INSERT INTO `zones` VALUES (125,204,'UR','Uri');
INSERT INTO `zones` VALUES (126,204,'VD','Waadt');
INSERT INTO `zones` VALUES (127,204,'VS','Wallis');
INSERT INTO `zones` VALUES (128,204,'ZG','Zug');
INSERT INTO `zones` VALUES (129,204,'ZH','Zrich');
INSERT INTO `zones` VALUES (130,195,'A Corua','A Corua');
INSERT INTO `zones` VALUES (131,195,'Alava','Alava');
INSERT INTO `zones` VALUES (132,195,'Albacete','Albacete');
INSERT INTO `zones` VALUES (133,195,'Alicante','Alicante');
INSERT INTO `zones` VALUES (134,195,'Almeria','Almeria');
INSERT INTO `zones` VALUES (135,195,'Asturias','Asturias');
INSERT INTO `zones` VALUES (136,195,'Avila','Avila');
INSERT INTO `zones` VALUES (137,195,'Badajoz','Badajoz');
INSERT INTO `zones` VALUES (138,195,'Baleares','Baleares');
INSERT INTO `zones` VALUES (139,195,'Barcelona','Barcelona');
INSERT INTO `zones` VALUES (140,195,'Burgos','Burgos');
INSERT INTO `zones` VALUES (141,195,'Caceres','Caceres');
INSERT INTO `zones` VALUES (142,195,'Cadiz','Cadiz');
INSERT INTO `zones` VALUES (143,195,'Cantabria','Cantabria');
INSERT INTO `zones` VALUES (144,195,'Castellon','Castellon');
INSERT INTO `zones` VALUES (145,195,'Ceuta','Ceuta');
INSERT INTO `zones` VALUES (146,195,'Ciudad Real','Ciudad Real');
INSERT INTO `zones` VALUES (147,195,'Cordoba','Cordoba');
INSERT INTO `zones` VALUES (148,195,'Cuenca','Cuenca');
INSERT INTO `zones` VALUES (149,195,'Girona','Girona');
INSERT INTO `zones` VALUES (150,195,'Granada','Granada');
INSERT INTO `zones` VALUES (151,195,'Guadalajara','Guadalajara');
INSERT INTO `zones` VALUES (152,195,'Guipuzcoa','Guipuzcoa');
INSERT INTO `zones` VALUES (153,195,'Huelva','Huelva');
INSERT INTO `zones` VALUES (154,195,'Huesca','Huesca');
INSERT INTO `zones` VALUES (155,195,'Jaen','Jaen');
INSERT INTO `zones` VALUES (156,195,'La Rioja','La Rioja');
INSERT INTO `zones` VALUES (157,195,'Las Palmas','Las Palmas');
INSERT INTO `zones` VALUES (158,195,'Leon','Leon');
INSERT INTO `zones` VALUES (159,195,'Lleida','Lleida');
INSERT INTO `zones` VALUES (160,195,'Lugo','Lugo');
INSERT INTO `zones` VALUES (161,195,'Madrid','Madrid');
INSERT INTO `zones` VALUES (162,195,'Malaga','Malaga');
INSERT INTO `zones` VALUES (163,195,'Melilla','Melilla');
INSERT INTO `zones` VALUES (164,195,'Murcia','Murcia');
INSERT INTO `zones` VALUES (165,195,'Navarra','Navarra');
INSERT INTO `zones` VALUES (166,195,'Ourense','Ourense');
INSERT INTO `zones` VALUES (167,195,'Palencia','Palencia');
INSERT INTO `zones` VALUES (168,195,'Pontevedra','Pontevedra');
INSERT INTO `zones` VALUES (169,195,'Salamanca','Salamanca');
INSERT INTO `zones` VALUES (170,195,'Santa Cruz de Tenerife','Santa Cruz de Tenerife');
INSERT INTO `zones` VALUES (171,195,'Segovia','Segovia');
INSERT INTO `zones` VALUES (172,195,'Sevilla','Sevilla');
INSERT INTO `zones` VALUES (173,195,'Soria','Soria');
INSERT INTO `zones` VALUES (174,195,'Tarragona','Tarragona');
INSERT INTO `zones` VALUES (175,195,'Teruel','Teruel');
INSERT INTO `zones` VALUES (176,195,'Toledo','Toledo');
INSERT INTO `zones` VALUES (177,195,'Valencia','Valencia');
INSERT INTO `zones` VALUES (178,195,'Valladolid','Valladolid');
INSERT INTO `zones` VALUES (179,195,'Vizcaya','Vizcaya');
INSERT INTO `zones` VALUES (180,195,'Zamora','Zamora');
INSERT INTO `zones` VALUES (181,195,'Zaragoza','Zaragoza');
INSERT INTO `zones` VALUES (182,107,'北海道','北海道');
INSERT INTO `zones` VALUES (183,107,'青森県','青森県');
INSERT INTO `zones` VALUES (184,107,'岩手県','岩手県');
INSERT INTO `zones` VALUES (185,107,'宮城県','宮城県');
INSERT INTO `zones` VALUES (186,107,'秋田県','秋田県');
INSERT INTO `zones` VALUES (187,107,'山形県','山形県');
INSERT INTO `zones` VALUES (188,107,'福島県','福島県');
INSERT INTO `zones` VALUES (189,107,'茨城県','茨城県');
INSERT INTO `zones` VALUES (190,107,'栃木県','栃木県');
INSERT INTO `zones` VALUES (191,107,'群馬県','群馬県');
INSERT INTO `zones` VALUES (192,107,'埼玉県','埼玉県');
INSERT INTO `zones` VALUES (193,107,'千葉県','千葉県');
INSERT INTO `zones` VALUES (194,107,'東京都','東京都');
INSERT INTO `zones` VALUES (195,107,'神奈川県','神奈川県');
INSERT INTO `zones` VALUES (196,107,'新潟県','新潟県');
INSERT INTO `zones` VALUES (197,107,'富山県','富山県');
INSERT INTO `zones` VALUES (198,107,'石川県','石川県');
INSERT INTO `zones` VALUES (199,107,'福井県','福井県');
INSERT INTO `zones` VALUES (200,107,'山梨県','山梨県');
INSERT INTO `zones` VALUES (201,107,'長野県','長野県');
INSERT INTO `zones` VALUES (202,107,'岐阜県','岐阜県');
INSERT INTO `zones` VALUES (203,107,'静岡県','静岡県');
INSERT INTO `zones` VALUES (204,107,'愛知県','愛知県');
INSERT INTO `zones` VALUES (205,107,'三重県','三重県');
INSERT INTO `zones` VALUES (206,107,'滋賀県','滋賀県');
INSERT INTO `zones` VALUES (207,107,'京都府','京都府');
INSERT INTO `zones` VALUES (208,107,'大阪府','大阪府');
INSERT INTO `zones` VALUES (209,107,'兵庫県','兵庫県');
INSERT INTO `zones` VALUES (210,107,'奈良県','奈良県');
INSERT INTO `zones` VALUES (211,107,'和歌山県','和歌山県');
INSERT INTO `zones` VALUES (212,107,'鳥取県','鳥取県');
INSERT INTO `zones` VALUES (213,107,'島根県','島根県');
INSERT INTO `zones` VALUES (214,107,'岡山県','岡山県');
INSERT INTO `zones` VALUES (215,107,'広島県','広島県');
INSERT INTO `zones` VALUES (216,107,'山口県','山口県');
INSERT INTO `zones` VALUES (217,107,'徳島県','徳島県');
INSERT INTO `zones` VALUES (218,107,'香川県','香川県');
INSERT INTO `zones` VALUES (219,107,'愛媛県','愛媛県');
INSERT INTO `zones` VALUES (220,107,'高知県','高知県');
INSERT INTO `zones` VALUES (221,107,'福岡県','福岡県');
INSERT INTO `zones` VALUES (222,107,'佐賀県','佐賀県');
INSERT INTO `zones` VALUES (223,107,'長崎県','長崎県');
INSERT INTO `zones` VALUES (224,107,'熊本県','熊本県');
INSERT INTO `zones` VALUES (225,107,'大分県','大分県');
INSERT INTO `zones` VALUES (226,107,'宮崎県','宮崎県');
INSERT INTO `zones` VALUES (227,107,'鹿児島県','鹿児島県');
INSERT INTO `zones` VALUES (228,107,'沖縄県','沖縄県');
/*!40000 ALTER TABLE `zones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zones_m17n`
--

DROP TABLE IF EXISTS `zones_m17n`;
CREATE TABLE `zones_m17n` (
  `zone_id` int(11) NOT NULL default '0',
  `language_id` int(11) NOT NULL default '0',
  `zone_name_m17n` varchar(32) NOT NULL default '',
  PRIMARY KEY  (`zone_id`,`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table `zones_m17n`
--

LOCK TABLES `zones_m17n` WRITE;
/*!40000 ALTER TABLE `zones_m17n` DISABLE KEYS */;
INSERT INTO `zones_m17n` VALUES (1,1,'Alabama');
INSERT INTO `zones_m17n` VALUES (2,1,'Alaska');
INSERT INTO `zones_m17n` VALUES (3,1,'American Samoa');
INSERT INTO `zones_m17n` VALUES (4,1,'Arizona');
INSERT INTO `zones_m17n` VALUES (5,1,'Arkansas');
INSERT INTO `zones_m17n` VALUES (6,1,'Armed Forces Africa');
INSERT INTO `zones_m17n` VALUES (7,1,'Armed Forces Americas');
INSERT INTO `zones_m17n` VALUES (8,1,'Armed Forces Canada');
INSERT INTO `zones_m17n` VALUES (9,1,'Armed Forces Europe');
INSERT INTO `zones_m17n` VALUES (10,1,'Armed Forces Middle East');
INSERT INTO `zones_m17n` VALUES (11,1,'Armed Forces Pacific');
INSERT INTO `zones_m17n` VALUES (12,1,'California');
INSERT INTO `zones_m17n` VALUES (13,1,'Colorado');
INSERT INTO `zones_m17n` VALUES (14,1,'Connecticut');
INSERT INTO `zones_m17n` VALUES (15,1,'Delaware');
INSERT INTO `zones_m17n` VALUES (16,1,'District of Columbia');
INSERT INTO `zones_m17n` VALUES (17,1,'Federated States Of Micronesia');
INSERT INTO `zones_m17n` VALUES (18,1,'Florida');
INSERT INTO `zones_m17n` VALUES (19,1,'Georgia');
INSERT INTO `zones_m17n` VALUES (20,1,'Guam');
INSERT INTO `zones_m17n` VALUES (21,1,'Hawaii');
INSERT INTO `zones_m17n` VALUES (22,1,'Idaho');
INSERT INTO `zones_m17n` VALUES (23,1,'Illinois');
INSERT INTO `zones_m17n` VALUES (24,1,'Indiana');
INSERT INTO `zones_m17n` VALUES (25,1,'Iowa');
INSERT INTO `zones_m17n` VALUES (26,1,'Kansas');
INSERT INTO `zones_m17n` VALUES (27,1,'Kentucky');
INSERT INTO `zones_m17n` VALUES (28,1,'Louisiana');
INSERT INTO `zones_m17n` VALUES (29,1,'Maine');
INSERT INTO `zones_m17n` VALUES (30,1,'Marshall Islands');
INSERT INTO `zones_m17n` VALUES (31,1,'Maryland');
INSERT INTO `zones_m17n` VALUES (32,1,'Massachusetts');
INSERT INTO `zones_m17n` VALUES (33,1,'Michigan');
INSERT INTO `zones_m17n` VALUES (34,1,'Minnesota');
INSERT INTO `zones_m17n` VALUES (35,1,'Mississippi');
INSERT INTO `zones_m17n` VALUES (36,1,'Missouri');
INSERT INTO `zones_m17n` VALUES (37,1,'Montana');
INSERT INTO `zones_m17n` VALUES (38,1,'Nebraska');
INSERT INTO `zones_m17n` VALUES (39,1,'Nevada');
INSERT INTO `zones_m17n` VALUES (40,1,'New Hampshire');
INSERT INTO `zones_m17n` VALUES (41,1,'New Jersey');
INSERT INTO `zones_m17n` VALUES (42,1,'New Mexico');
INSERT INTO `zones_m17n` VALUES (43,1,'New York');
INSERT INTO `zones_m17n` VALUES (44,1,'North Carolina');
INSERT INTO `zones_m17n` VALUES (45,1,'North Dakota');
INSERT INTO `zones_m17n` VALUES (46,1,'Northern Mariana Islands');
INSERT INTO `zones_m17n` VALUES (47,1,'Ohio');
INSERT INTO `zones_m17n` VALUES (48,1,'Oklahoma');
INSERT INTO `zones_m17n` VALUES (49,1,'Oregon');
INSERT INTO `zones_m17n` VALUES (50,1,'Palau');
INSERT INTO `zones_m17n` VALUES (51,1,'Pennsylvania');
INSERT INTO `zones_m17n` VALUES (52,1,'Puerto Rico');
INSERT INTO `zones_m17n` VALUES (53,1,'Rhode Island');
INSERT INTO `zones_m17n` VALUES (54,1,'South Carolina');
INSERT INTO `zones_m17n` VALUES (55,1,'South Dakota');
INSERT INTO `zones_m17n` VALUES (56,1,'Tennessee');
INSERT INTO `zones_m17n` VALUES (57,1,'Texas');
INSERT INTO `zones_m17n` VALUES (58,1,'Utah');
INSERT INTO `zones_m17n` VALUES (59,1,'Vermont');
INSERT INTO `zones_m17n` VALUES (60,1,'Virgin Islands');
INSERT INTO `zones_m17n` VALUES (61,1,'Virginia');
INSERT INTO `zones_m17n` VALUES (62,1,'Washington');
INSERT INTO `zones_m17n` VALUES (63,1,'West Virginia');
INSERT INTO `zones_m17n` VALUES (64,1,'Wisconsin');
INSERT INTO `zones_m17n` VALUES (65,1,'Wyoming');
INSERT INTO `zones_m17n` VALUES (66,1,'Alberta');
INSERT INTO `zones_m17n` VALUES (67,1,'British Columbia');
INSERT INTO `zones_m17n` VALUES (68,1,'Manitoba');
INSERT INTO `zones_m17n` VALUES (69,1,'Newfoundland');
INSERT INTO `zones_m17n` VALUES (70,1,'New Brunswick');
INSERT INTO `zones_m17n` VALUES (71,1,'Nova Scotia');
INSERT INTO `zones_m17n` VALUES (72,1,'Northwest Territories');
INSERT INTO `zones_m17n` VALUES (73,1,'Nunavut');
INSERT INTO `zones_m17n` VALUES (74,1,'Ontario');
INSERT INTO `zones_m17n` VALUES (75,1,'Prince Edward Island');
INSERT INTO `zones_m17n` VALUES (76,1,'Quebec');
INSERT INTO `zones_m17n` VALUES (77,1,'Saskatchewan');
INSERT INTO `zones_m17n` VALUES (78,1,'Yukon Territory');
INSERT INTO `zones_m17n` VALUES (79,1,'Niedersachsen');
INSERT INTO `zones_m17n` VALUES (80,1,'Baden-Wrttemberg');
INSERT INTO `zones_m17n` VALUES (81,1,'Bayern');
INSERT INTO `zones_m17n` VALUES (82,1,'Berlin');
INSERT INTO `zones_m17n` VALUES (83,1,'Brandenburg');
INSERT INTO `zones_m17n` VALUES (84,1,'Bremen');
INSERT INTO `zones_m17n` VALUES (85,1,'Hamburg');
INSERT INTO `zones_m17n` VALUES (86,1,'Hessen');
INSERT INTO `zones_m17n` VALUES (87,1,'Mecklenburg-Vorpommern');
INSERT INTO `zones_m17n` VALUES (88,1,'Nordrhein-Westfalen');
INSERT INTO `zones_m17n` VALUES (89,1,'Rheinland-Pfalz');
INSERT INTO `zones_m17n` VALUES (90,1,'Saarland');
INSERT INTO `zones_m17n` VALUES (91,1,'Sachsen');
INSERT INTO `zones_m17n` VALUES (92,1,'Sachsen-Anhalt');
INSERT INTO `zones_m17n` VALUES (93,1,'Schleswig-Holstein');
INSERT INTO `zones_m17n` VALUES (94,1,'Thringen');
INSERT INTO `zones_m17n` VALUES (95,1,'Wien');
INSERT INTO `zones_m17n` VALUES (96,1,'Niedersterreich');
INSERT INTO `zones_m17n` VALUES (97,1,'Obersterreich');
INSERT INTO `zones_m17n` VALUES (98,1,'Salzburg');
INSERT INTO `zones_m17n` VALUES (99,1,'Kten');
INSERT INTO `zones_m17n` VALUES (100,1,'Steiermark');
INSERT INTO `zones_m17n` VALUES (101,1,'Tirol');
INSERT INTO `zones_m17n` VALUES (102,1,'Burgenland');
INSERT INTO `zones_m17n` VALUES (103,1,'Voralberg');
INSERT INTO `zones_m17n` VALUES (104,1,'Aargau');
INSERT INTO `zones_m17n` VALUES (105,1,'Appenzell Innerrhoden');
INSERT INTO `zones_m17n` VALUES (106,1,'Appenzell Ausserrhoden');
INSERT INTO `zones_m17n` VALUES (107,1,'Bern');
INSERT INTO `zones_m17n` VALUES (108,1,'Basel-Landschaft');
INSERT INTO `zones_m17n` VALUES (109,1,'Basel-Stadt');
INSERT INTO `zones_m17n` VALUES (110,1,'Freiburg');
INSERT INTO `zones_m17n` VALUES (111,1,'Genf');
INSERT INTO `zones_m17n` VALUES (112,1,'Glarus');
INSERT INTO `zones_m17n` VALUES (113,1,'Graubnden');
INSERT INTO `zones_m17n` VALUES (114,1,'Jura');
INSERT INTO `zones_m17n` VALUES (115,1,'Luzern');
INSERT INTO `zones_m17n` VALUES (116,1,'Neuenburg');
INSERT INTO `zones_m17n` VALUES (117,1,'Nidwalden');
INSERT INTO `zones_m17n` VALUES (118,1,'Obwalden');
INSERT INTO `zones_m17n` VALUES (119,1,'St. Gallen');
INSERT INTO `zones_m17n` VALUES (120,1,'Schaffhausen');
INSERT INTO `zones_m17n` VALUES (121,1,'Solothurn');
INSERT INTO `zones_m17n` VALUES (122,1,'Schwyz');
INSERT INTO `zones_m17n` VALUES (123,1,'Thurgau');
INSERT INTO `zones_m17n` VALUES (124,1,'Tessin');
INSERT INTO `zones_m17n` VALUES (125,1,'Uri');
INSERT INTO `zones_m17n` VALUES (126,1,'Waadt');
INSERT INTO `zones_m17n` VALUES (127,1,'Wallis');
INSERT INTO `zones_m17n` VALUES (128,1,'Zug');
INSERT INTO `zones_m17n` VALUES (129,1,'Zrich');
INSERT INTO `zones_m17n` VALUES (130,1,'A Corua');
INSERT INTO `zones_m17n` VALUES (131,1,'Alava');
INSERT INTO `zones_m17n` VALUES (132,1,'Albacete');
INSERT INTO `zones_m17n` VALUES (133,1,'Alicante');
INSERT INTO `zones_m17n` VALUES (134,1,'Almeria');
INSERT INTO `zones_m17n` VALUES (135,1,'Asturias');
INSERT INTO `zones_m17n` VALUES (136,1,'Avila');
INSERT INTO `zones_m17n` VALUES (137,1,'Badajoz');
INSERT INTO `zones_m17n` VALUES (138,1,'Baleares');
INSERT INTO `zones_m17n` VALUES (139,1,'Barcelona');
INSERT INTO `zones_m17n` VALUES (140,1,'Burgos');
INSERT INTO `zones_m17n` VALUES (141,1,'Caceres');
INSERT INTO `zones_m17n` VALUES (142,1,'Cadiz');
INSERT INTO `zones_m17n` VALUES (143,1,'Cantabria');
INSERT INTO `zones_m17n` VALUES (144,1,'Castellon');
INSERT INTO `zones_m17n` VALUES (145,1,'Ceuta');
INSERT INTO `zones_m17n` VALUES (146,1,'Ciudad Real');
INSERT INTO `zones_m17n` VALUES (147,1,'Cordoba');
INSERT INTO `zones_m17n` VALUES (148,1,'Cuenca');
INSERT INTO `zones_m17n` VALUES (149,1,'Girona');
INSERT INTO `zones_m17n` VALUES (150,1,'Granada');
INSERT INTO `zones_m17n` VALUES (151,1,'Guadalajara');
INSERT INTO `zones_m17n` VALUES (152,1,'Guipuzcoa');
INSERT INTO `zones_m17n` VALUES (153,1,'Huelva');
INSERT INTO `zones_m17n` VALUES (154,1,'Huesca');
INSERT INTO `zones_m17n` VALUES (155,1,'Jaen');
INSERT INTO `zones_m17n` VALUES (156,1,'La Rioja');
INSERT INTO `zones_m17n` VALUES (157,1,'Las Palmas');
INSERT INTO `zones_m17n` VALUES (158,1,'Leon');
INSERT INTO `zones_m17n` VALUES (159,1,'Lleida');
INSERT INTO `zones_m17n` VALUES (160,1,'Lugo');
INSERT INTO `zones_m17n` VALUES (161,1,'Madrid');
INSERT INTO `zones_m17n` VALUES (162,1,'Malaga');
INSERT INTO `zones_m17n` VALUES (163,1,'Melilla');
INSERT INTO `zones_m17n` VALUES (164,1,'Murcia');
INSERT INTO `zones_m17n` VALUES (165,1,'Navarra');
INSERT INTO `zones_m17n` VALUES (166,1,'Ourense');
INSERT INTO `zones_m17n` VALUES (167,1,'Palencia');
INSERT INTO `zones_m17n` VALUES (168,1,'Pontevedra');
INSERT INTO `zones_m17n` VALUES (169,1,'Salamanca');
INSERT INTO `zones_m17n` VALUES (170,1,'Santa Cruz de Tenerife');
INSERT INTO `zones_m17n` VALUES (171,1,'Segovia');
INSERT INTO `zones_m17n` VALUES (172,1,'Sevilla');
INSERT INTO `zones_m17n` VALUES (173,1,'Soria');
INSERT INTO `zones_m17n` VALUES (174,1,'Tarragona');
INSERT INTO `zones_m17n` VALUES (175,1,'Teruel');
INSERT INTO `zones_m17n` VALUES (176,1,'Toledo');
INSERT INTO `zones_m17n` VALUES (177,1,'Valencia');
INSERT INTO `zones_m17n` VALUES (178,1,'Valladolid');
INSERT INTO `zones_m17n` VALUES (179,1,'Vizcaya');
INSERT INTO `zones_m17n` VALUES (180,1,'Zamora');
INSERT INTO `zones_m17n` VALUES (181,1,'Zaragoza');
INSERT INTO `zones_m17n` VALUES (182,1,'Hokkaido');
INSERT INTO `zones_m17n` VALUES (183,1,'Aomori');
INSERT INTO `zones_m17n` VALUES (184,1,'Iwate');
INSERT INTO `zones_m17n` VALUES (185,1,'Miyagi');
INSERT INTO `zones_m17n` VALUES (186,1,'Akita');
INSERT INTO `zones_m17n` VALUES (187,1,'Yamagata');
INSERT INTO `zones_m17n` VALUES (188,1,'Fukushima');
INSERT INTO `zones_m17n` VALUES (189,1,'Ibaragi');
INSERT INTO `zones_m17n` VALUES (190,1,'Tochigi');
INSERT INTO `zones_m17n` VALUES (191,1,'Gunma');
INSERT INTO `zones_m17n` VALUES (192,1,'Saitama');
INSERT INTO `zones_m17n` VALUES (193,1,'Chiba');
INSERT INTO `zones_m17n` VALUES (194,1,'Tokyo');
INSERT INTO `zones_m17n` VALUES (195,1,'Kanagama');
INSERT INTO `zones_m17n` VALUES (196,1,'Niigata');
INSERT INTO `zones_m17n` VALUES (197,1,'Toyama');
INSERT INTO `zones_m17n` VALUES (198,1,'Ishikawa');
INSERT INTO `zones_m17n` VALUES (199,1,'Fukui');
INSERT INTO `zones_m17n` VALUES (200,1,'Yamagata');
INSERT INTO `zones_m17n` VALUES (201,1,'Nagano');
INSERT INTO `zones_m17n` VALUES (202,1,'Gifu');
INSERT INTO `zones_m17n` VALUES (203,1,'Shizuoka');
INSERT INTO `zones_m17n` VALUES (204,1,'Aichu');
INSERT INTO `zones_m17n` VALUES (205,1,'Mie');
INSERT INTO `zones_m17n` VALUES (206,1,'Shiga');
INSERT INTO `zones_m17n` VALUES (207,1,'Kyoto');
INSERT INTO `zones_m17n` VALUES (208,1,'Osaka');
INSERT INTO `zones_m17n` VALUES (209,1,'Hyogo');
INSERT INTO `zones_m17n` VALUES (210,1,'Nara');
INSERT INTO `zones_m17n` VALUES (211,1,'Wakayama');
INSERT INTO `zones_m17n` VALUES (212,1,'Tottori');
INSERT INTO `zones_m17n` VALUES (213,1,'Shimane');
INSERT INTO `zones_m17n` VALUES (214,1,'Okayama');
INSERT INTO `zones_m17n` VALUES (215,1,'Hiroshima');
INSERT INTO `zones_m17n` VALUES (216,1,'Yamaguchi');
INSERT INTO `zones_m17n` VALUES (217,1,'Tokushima');
INSERT INTO `zones_m17n` VALUES (218,1,'Kagawa');
INSERT INTO `zones_m17n` VALUES (219,1,'Ehime');
INSERT INTO `zones_m17n` VALUES (220,1,'Kochi');
INSERT INTO `zones_m17n` VALUES (221,1,'Fukushima');
INSERT INTO `zones_m17n` VALUES (222,1,'Saga');
INSERT INTO `zones_m17n` VALUES (223,1,'Nagasaki');
INSERT INTO `zones_m17n` VALUES (224,1,'Kumamoto');
INSERT INTO `zones_m17n` VALUES (225,1,'Oita');
INSERT INTO `zones_m17n` VALUES (226,1,'Miyazaki');
INSERT INTO `zones_m17n` VALUES (227,1,'Kagoshima');
INSERT INTO `zones_m17n` VALUES (228,1,'Okinawa');
INSERT INTO `zones_m17n` VALUES (1,2,'Alabama');
INSERT INTO `zones_m17n` VALUES (2,2,'Alaska');
INSERT INTO `zones_m17n` VALUES (3,2,'American Samoa');
INSERT INTO `zones_m17n` VALUES (4,2,'Arizona');
INSERT INTO `zones_m17n` VALUES (5,2,'Arkansas');
INSERT INTO `zones_m17n` VALUES (6,2,'Armed Forces Africa');
INSERT INTO `zones_m17n` VALUES (7,2,'Armed Forces Americas');
INSERT INTO `zones_m17n` VALUES (8,2,'Armed Forces Canada');
INSERT INTO `zones_m17n` VALUES (9,2,'Armed Forces Europe');
INSERT INTO `zones_m17n` VALUES (10,2,'Armed Forces Middle East');
INSERT INTO `zones_m17n` VALUES (11,2,'Armed Forces Pacific');
INSERT INTO `zones_m17n` VALUES (12,2,'California');
INSERT INTO `zones_m17n` VALUES (13,2,'Colorado');
INSERT INTO `zones_m17n` VALUES (14,2,'Connecticut');
INSERT INTO `zones_m17n` VALUES (15,2,'Delaware');
INSERT INTO `zones_m17n` VALUES (16,2,'District of Columbia');
INSERT INTO `zones_m17n` VALUES (17,2,'Federated States Of Micronesia');
INSERT INTO `zones_m17n` VALUES (18,2,'Florida');
INSERT INTO `zones_m17n` VALUES (19,2,'Georgia');
INSERT INTO `zones_m17n` VALUES (20,2,'Guam');
INSERT INTO `zones_m17n` VALUES (21,2,'Hawaii');
INSERT INTO `zones_m17n` VALUES (22,2,'Idaho');
INSERT INTO `zones_m17n` VALUES (23,2,'Illinois');
INSERT INTO `zones_m17n` VALUES (24,2,'Indiana');
INSERT INTO `zones_m17n` VALUES (25,2,'Iowa');
INSERT INTO `zones_m17n` VALUES (26,2,'Kansas');
INSERT INTO `zones_m17n` VALUES (27,2,'Kentucky');
INSERT INTO `zones_m17n` VALUES (28,2,'Louisiana');
INSERT INTO `zones_m17n` VALUES (29,2,'Maine');
INSERT INTO `zones_m17n` VALUES (30,2,'Marshall Islands');
INSERT INTO `zones_m17n` VALUES (31,2,'Maryland');
INSERT INTO `zones_m17n` VALUES (32,2,'Massachusetts');
INSERT INTO `zones_m17n` VALUES (33,2,'Michigan');
INSERT INTO `zones_m17n` VALUES (34,2,'Minnesota');
INSERT INTO `zones_m17n` VALUES (35,2,'Mississippi');
INSERT INTO `zones_m17n` VALUES (36,2,'Missouri');
INSERT INTO `zones_m17n` VALUES (37,2,'Montana');
INSERT INTO `zones_m17n` VALUES (38,2,'Nebraska');
INSERT INTO `zones_m17n` VALUES (39,2,'Nevada');
INSERT INTO `zones_m17n` VALUES (40,2,'New Hampshire');
INSERT INTO `zones_m17n` VALUES (41,2,'New Jersey');
INSERT INTO `zones_m17n` VALUES (42,2,'New Mexico');
INSERT INTO `zones_m17n` VALUES (43,2,'New York');
INSERT INTO `zones_m17n` VALUES (44,2,'North Carolina');
INSERT INTO `zones_m17n` VALUES (45,2,'North Dakota');
INSERT INTO `zones_m17n` VALUES (46,2,'Northern Mariana Islands');
INSERT INTO `zones_m17n` VALUES (47,2,'Ohio');
INSERT INTO `zones_m17n` VALUES (48,2,'Oklahoma');
INSERT INTO `zones_m17n` VALUES (49,2,'Oregon');
INSERT INTO `zones_m17n` VALUES (50,2,'Palau');
INSERT INTO `zones_m17n` VALUES (51,2,'Pennsylvania');
INSERT INTO `zones_m17n` VALUES (52,2,'Puerto Rico');
INSERT INTO `zones_m17n` VALUES (53,2,'Rhode Island');
INSERT INTO `zones_m17n` VALUES (54,2,'South Carolina');
INSERT INTO `zones_m17n` VALUES (55,2,'South Dakota');
INSERT INTO `zones_m17n` VALUES (56,2,'Tennessee');
INSERT INTO `zones_m17n` VALUES (57,2,'Texas');
INSERT INTO `zones_m17n` VALUES (58,2,'Utah');
INSERT INTO `zones_m17n` VALUES (59,2,'Vermont');
INSERT INTO `zones_m17n` VALUES (60,2,'Virgin Islands');
INSERT INTO `zones_m17n` VALUES (61,2,'Virginia');
INSERT INTO `zones_m17n` VALUES (62,2,'Washington');
INSERT INTO `zones_m17n` VALUES (63,2,'West Virginia');
INSERT INTO `zones_m17n` VALUES (64,2,'Wisconsin');
INSERT INTO `zones_m17n` VALUES (65,2,'Wyoming');
INSERT INTO `zones_m17n` VALUES (66,2,'Alberta');
INSERT INTO `zones_m17n` VALUES (67,2,'British Columbia');
INSERT INTO `zones_m17n` VALUES (68,2,'Manitoba');
INSERT INTO `zones_m17n` VALUES (69,2,'Newfoundland');
INSERT INTO `zones_m17n` VALUES (70,2,'New Brunswick');
INSERT INTO `zones_m17n` VALUES (71,2,'Nova Scotia');
INSERT INTO `zones_m17n` VALUES (72,2,'Northwest Territories');
INSERT INTO `zones_m17n` VALUES (73,2,'Nunavut');
INSERT INTO `zones_m17n` VALUES (74,2,'Ontario');
INSERT INTO `zones_m17n` VALUES (75,2,'Prince Edward Island');
INSERT INTO `zones_m17n` VALUES (76,2,'Quebec');
INSERT INTO `zones_m17n` VALUES (77,2,'Saskatchewan');
INSERT INTO `zones_m17n` VALUES (78,2,'Yukon Territory');
INSERT INTO `zones_m17n` VALUES (79,2,'Niedersachsen');
INSERT INTO `zones_m17n` VALUES (80,2,'Baden-Wrttemberg');
INSERT INTO `zones_m17n` VALUES (81,2,'Bayern');
INSERT INTO `zones_m17n` VALUES (82,2,'Berlin');
INSERT INTO `zones_m17n` VALUES (83,2,'Brandenburg');
INSERT INTO `zones_m17n` VALUES (84,2,'Bremen');
INSERT INTO `zones_m17n` VALUES (85,2,'Hamburg');
INSERT INTO `zones_m17n` VALUES (86,2,'Hessen');
INSERT INTO `zones_m17n` VALUES (87,2,'Mecklenburg-Vorpommern');
INSERT INTO `zones_m17n` VALUES (88,2,'Nordrhein-Westfalen');
INSERT INTO `zones_m17n` VALUES (89,2,'Rheinland-Pfalz');
INSERT INTO `zones_m17n` VALUES (90,2,'Saarland');
INSERT INTO `zones_m17n` VALUES (91,2,'Sachsen');
INSERT INTO `zones_m17n` VALUES (92,2,'Sachsen-Anhalt');
INSERT INTO `zones_m17n` VALUES (93,2,'Schleswig-Holstein');
INSERT INTO `zones_m17n` VALUES (94,2,'Thringen');
INSERT INTO `zones_m17n` VALUES (95,2,'Wien');
INSERT INTO `zones_m17n` VALUES (96,2,'Niedersterreich');
INSERT INTO `zones_m17n` VALUES (97,2,'Obersterreich');
INSERT INTO `zones_m17n` VALUES (98,2,'Salzburg');
INSERT INTO `zones_m17n` VALUES (99,2,'Kten');
INSERT INTO `zones_m17n` VALUES (100,2,'Steiermark');
INSERT INTO `zones_m17n` VALUES (101,2,'Tirol');
INSERT INTO `zones_m17n` VALUES (102,2,'Burgenland');
INSERT INTO `zones_m17n` VALUES (103,2,'Voralberg');
INSERT INTO `zones_m17n` VALUES (104,2,'Aargau');
INSERT INTO `zones_m17n` VALUES (105,2,'Appenzell Innerrhoden');
INSERT INTO `zones_m17n` VALUES (106,2,'Appenzell Ausserrhoden');
INSERT INTO `zones_m17n` VALUES (107,2,'Bern');
INSERT INTO `zones_m17n` VALUES (108,2,'Basel-Landschaft');
INSERT INTO `zones_m17n` VALUES (109,2,'Basel-Stadt');
INSERT INTO `zones_m17n` VALUES (110,2,'Freiburg');
INSERT INTO `zones_m17n` VALUES (111,2,'Genf');
INSERT INTO `zones_m17n` VALUES (112,2,'Glarus');
INSERT INTO `zones_m17n` VALUES (113,2,'Graubnden');
INSERT INTO `zones_m17n` VALUES (114,2,'Jura');
INSERT INTO `zones_m17n` VALUES (115,2,'Luzern');
INSERT INTO `zones_m17n` VALUES (116,2,'Neuenburg');
INSERT INTO `zones_m17n` VALUES (117,2,'Nidwalden');
INSERT INTO `zones_m17n` VALUES (118,2,'Obwalden');
INSERT INTO `zones_m17n` VALUES (119,2,'St. Gallen');
INSERT INTO `zones_m17n` VALUES (120,2,'Schaffhausen');
INSERT INTO `zones_m17n` VALUES (121,2,'Solothurn');
INSERT INTO `zones_m17n` VALUES (122,2,'Schwyz');
INSERT INTO `zones_m17n` VALUES (123,2,'Thurgau');
INSERT INTO `zones_m17n` VALUES (124,2,'Tessin');
INSERT INTO `zones_m17n` VALUES (125,2,'Uri');
INSERT INTO `zones_m17n` VALUES (126,2,'Waadt');
INSERT INTO `zones_m17n` VALUES (127,2,'Wallis');
INSERT INTO `zones_m17n` VALUES (128,2,'Zug');
INSERT INTO `zones_m17n` VALUES (129,2,'Zrich');
INSERT INTO `zones_m17n` VALUES (130,2,'A Corua');
INSERT INTO `zones_m17n` VALUES (131,2,'Alava');
INSERT INTO `zones_m17n` VALUES (132,2,'Albacete');
INSERT INTO `zones_m17n` VALUES (133,2,'Alicante');
INSERT INTO `zones_m17n` VALUES (134,2,'Almeria');
INSERT INTO `zones_m17n` VALUES (135,2,'Asturias');
INSERT INTO `zones_m17n` VALUES (136,2,'Avila');
INSERT INTO `zones_m17n` VALUES (137,2,'Badajoz');
INSERT INTO `zones_m17n` VALUES (138,2,'Baleares');
INSERT INTO `zones_m17n` VALUES (139,2,'Barcelona');
INSERT INTO `zones_m17n` VALUES (140,2,'Burgos');
INSERT INTO `zones_m17n` VALUES (141,2,'Caceres');
INSERT INTO `zones_m17n` VALUES (142,2,'Cadiz');
INSERT INTO `zones_m17n` VALUES (143,2,'Cantabria');
INSERT INTO `zones_m17n` VALUES (144,2,'Castellon');
INSERT INTO `zones_m17n` VALUES (145,2,'Ceuta');
INSERT INTO `zones_m17n` VALUES (146,2,'Ciudad Real');
INSERT INTO `zones_m17n` VALUES (147,2,'Cordoba');
INSERT INTO `zones_m17n` VALUES (148,2,'Cuenca');
INSERT INTO `zones_m17n` VALUES (149,2,'Girona');
INSERT INTO `zones_m17n` VALUES (150,2,'Granada');
INSERT INTO `zones_m17n` VALUES (151,2,'Guadalajara');
INSERT INTO `zones_m17n` VALUES (152,2,'Guipuzcoa');
INSERT INTO `zones_m17n` VALUES (153,2,'Huelva');
INSERT INTO `zones_m17n` VALUES (154,2,'Huesca');
INSERT INTO `zones_m17n` VALUES (155,2,'Jaen');
INSERT INTO `zones_m17n` VALUES (156,2,'La Rioja');
INSERT INTO `zones_m17n` VALUES (157,2,'Las Palmas');
INSERT INTO `zones_m17n` VALUES (158,2,'Leon');
INSERT INTO `zones_m17n` VALUES (159,2,'Lleida');
INSERT INTO `zones_m17n` VALUES (160,2,'Lugo');
INSERT INTO `zones_m17n` VALUES (161,2,'Madrid');
INSERT INTO `zones_m17n` VALUES (162,2,'Malaga');
INSERT INTO `zones_m17n` VALUES (163,2,'Melilla');
INSERT INTO `zones_m17n` VALUES (164,2,'Murcia');
INSERT INTO `zones_m17n` VALUES (165,2,'Navarra');
INSERT INTO `zones_m17n` VALUES (166,2,'Ourense');
INSERT INTO `zones_m17n` VALUES (167,2,'Palencia');
INSERT INTO `zones_m17n` VALUES (168,2,'Pontevedra');
INSERT INTO `zones_m17n` VALUES (169,2,'Salamanca');
INSERT INTO `zones_m17n` VALUES (170,2,'Santa Cruz de Tenerife');
INSERT INTO `zones_m17n` VALUES (171,2,'Segovia');
INSERT INTO `zones_m17n` VALUES (172,2,'Sevilla');
INSERT INTO `zones_m17n` VALUES (173,2,'Soria');
INSERT INTO `zones_m17n` VALUES (174,2,'Tarragona');
INSERT INTO `zones_m17n` VALUES (175,2,'Teruel');
INSERT INTO `zones_m17n` VALUES (176,2,'Toledo');
INSERT INTO `zones_m17n` VALUES (177,2,'Valencia');
INSERT INTO `zones_m17n` VALUES (178,2,'Valladolid');
INSERT INTO `zones_m17n` VALUES (179,2,'Vizcaya');
INSERT INTO `zones_m17n` VALUES (180,2,'Zamora');
INSERT INTO `zones_m17n` VALUES (181,2,'Zaragoza');
INSERT INTO `zones_m17n` VALUES (182,2,'北海道');
INSERT INTO `zones_m17n` VALUES (183,2,'青森県');
INSERT INTO `zones_m17n` VALUES (184,2,'岩手県');
INSERT INTO `zones_m17n` VALUES (185,2,'宮城県');
INSERT INTO `zones_m17n` VALUES (186,2,'秋田県');
INSERT INTO `zones_m17n` VALUES (187,2,'山形県');
INSERT INTO `zones_m17n` VALUES (188,2,'福島県');
INSERT INTO `zones_m17n` VALUES (189,2,'茨城県');
INSERT INTO `zones_m17n` VALUES (190,2,'栃木県');
INSERT INTO `zones_m17n` VALUES (191,2,'群馬県');
INSERT INTO `zones_m17n` VALUES (192,2,'埼玉県');
INSERT INTO `zones_m17n` VALUES (193,2,'千葉県');
INSERT INTO `zones_m17n` VALUES (194,2,'東京都');
INSERT INTO `zones_m17n` VALUES (195,2,'神奈川県');
INSERT INTO `zones_m17n` VALUES (196,2,'新潟県');
INSERT INTO `zones_m17n` VALUES (197,2,'富山県');
INSERT INTO `zones_m17n` VALUES (198,2,'石川県');
INSERT INTO `zones_m17n` VALUES (199,2,'福井県');
INSERT INTO `zones_m17n` VALUES (200,2,'山梨県');
INSERT INTO `zones_m17n` VALUES (201,2,'長野県');
INSERT INTO `zones_m17n` VALUES (202,2,'岐阜県');
INSERT INTO `zones_m17n` VALUES (203,2,'静岡県');
INSERT INTO `zones_m17n` VALUES (204,2,'愛知県');
INSERT INTO `zones_m17n` VALUES (205,2,'三重県');
INSERT INTO `zones_m17n` VALUES (206,2,'滋賀県');
INSERT INTO `zones_m17n` VALUES (207,2,'京都府');
INSERT INTO `zones_m17n` VALUES (208,2,'大阪府');
INSERT INTO `zones_m17n` VALUES (209,2,'兵庫県');
INSERT INTO `zones_m17n` VALUES (210,2,'奈良県');
INSERT INTO `zones_m17n` VALUES (211,2,'和歌山県');
INSERT INTO `zones_m17n` VALUES (212,2,'鳥取県');
INSERT INTO `zones_m17n` VALUES (213,2,'島根県');
INSERT INTO `zones_m17n` VALUES (214,2,'岡山県');
INSERT INTO `zones_m17n` VALUES (215,2,'広島県');
INSERT INTO `zones_m17n` VALUES (216,2,'山口県');
INSERT INTO `zones_m17n` VALUES (217,2,'徳島県');
INSERT INTO `zones_m17n` VALUES (218,2,'香川県');
INSERT INTO `zones_m17n` VALUES (219,2,'愛媛県');
INSERT INTO `zones_m17n` VALUES (220,2,'高知県');
INSERT INTO `zones_m17n` VALUES (221,2,'福岡県');
INSERT INTO `zones_m17n` VALUES (222,2,'佐賀県');
INSERT INTO `zones_m17n` VALUES (223,2,'長崎県');
INSERT INTO `zones_m17n` VALUES (224,2,'熊本県');
INSERT INTO `zones_m17n` VALUES (225,2,'大分県');
INSERT INTO `zones_m17n` VALUES (226,2,'宮崎県');
INSERT INTO `zones_m17n` VALUES (227,2,'鹿児島県');
INSERT INTO `zones_m17n` VALUES (228,2,'沖縄県');
INSERT INTO `zones_m17n` VALUES (154,9,'Huesca');
INSERT INTO `zones_m17n` VALUES (153,9,'Huelva');
INSERT INTO `zones_m17n` VALUES (152,9,'Guipuzcoa');
INSERT INTO `zones_m17n` VALUES (151,9,'Guadalajara');
INSERT INTO `zones_m17n` VALUES (150,9,'Granada');
INSERT INTO `zones_m17n` VALUES (149,9,'Girona');
INSERT INTO `zones_m17n` VALUES (148,9,'Cuenca');
INSERT INTO `zones_m17n` VALUES (147,9,'Cordoba');
INSERT INTO `zones_m17n` VALUES (146,9,'Ciudad Real');
INSERT INTO `zones_m17n` VALUES (145,9,'Ceuta');
INSERT INTO `zones_m17n` VALUES (144,9,'Castellon');
INSERT INTO `zones_m17n` VALUES (143,9,'Cantabria');
INSERT INTO `zones_m17n` VALUES (142,9,'Cadiz');
INSERT INTO `zones_m17n` VALUES (141,9,'Caceres');
INSERT INTO `zones_m17n` VALUES (140,9,'Burgos');
INSERT INTO `zones_m17n` VALUES (139,9,'Barcelona');
INSERT INTO `zones_m17n` VALUES (138,9,'Baleares');
INSERT INTO `zones_m17n` VALUES (137,9,'Badajoz');
INSERT INTO `zones_m17n` VALUES (136,9,'Avila');
INSERT INTO `zones_m17n` VALUES (135,9,'Asturias');
INSERT INTO `zones_m17n` VALUES (134,9,'Almeria');
INSERT INTO `zones_m17n` VALUES (133,9,'Alicante');
INSERT INTO `zones_m17n` VALUES (132,9,'Albacete');
INSERT INTO `zones_m17n` VALUES (131,9,'Alava');
INSERT INTO `zones_m17n` VALUES (130,9,'A Corua');
INSERT INTO `zones_m17n` VALUES (129,9,'Zrich');
INSERT INTO `zones_m17n` VALUES (128,9,'Zug');
INSERT INTO `zones_m17n` VALUES (127,9,'Wallis');
INSERT INTO `zones_m17n` VALUES (126,9,'Waadt');
INSERT INTO `zones_m17n` VALUES (125,9,'Uri');
INSERT INTO `zones_m17n` VALUES (124,9,'Tessin');
INSERT INTO `zones_m17n` VALUES (123,9,'Thurgau');
INSERT INTO `zones_m17n` VALUES (122,9,'Schwyz');
INSERT INTO `zones_m17n` VALUES (121,9,'Solothurn');
INSERT INTO `zones_m17n` VALUES (120,9,'Schaffhausen');
INSERT INTO `zones_m17n` VALUES (119,9,'St. Gallen');
INSERT INTO `zones_m17n` VALUES (118,9,'Obwalden');
INSERT INTO `zones_m17n` VALUES (117,9,'Nidwalden');
INSERT INTO `zones_m17n` VALUES (116,9,'Neuenburg');
INSERT INTO `zones_m17n` VALUES (115,9,'Luzern');
INSERT INTO `zones_m17n` VALUES (114,9,'Jura');
INSERT INTO `zones_m17n` VALUES (113,9,'Graubnden');
INSERT INTO `zones_m17n` VALUES (112,9,'Glarus');
INSERT INTO `zones_m17n` VALUES (111,9,'Genf');
INSERT INTO `zones_m17n` VALUES (110,9,'Freiburg');
INSERT INTO `zones_m17n` VALUES (109,9,'Basel-Stadt');
INSERT INTO `zones_m17n` VALUES (108,9,'Basel-Landschaft');
INSERT INTO `zones_m17n` VALUES (107,9,'Bern');
INSERT INTO `zones_m17n` VALUES (106,9,'Appenzell Ausserrhoden');
INSERT INTO `zones_m17n` VALUES (105,9,'Appenzell Innerrhoden');
INSERT INTO `zones_m17n` VALUES (104,9,'Aargau');
INSERT INTO `zones_m17n` VALUES (103,9,'Voralberg');
INSERT INTO `zones_m17n` VALUES (102,9,'Burgenland');
INSERT INTO `zones_m17n` VALUES (101,9,'Tirol');
INSERT INTO `zones_m17n` VALUES (100,9,'Steiermark');
INSERT INTO `zones_m17n` VALUES (99,9,'Kten');
INSERT INTO `zones_m17n` VALUES (98,9,'Salzburg');
INSERT INTO `zones_m17n` VALUES (97,9,'Obersterreich');
INSERT INTO `zones_m17n` VALUES (96,9,'Niedersterreich');
INSERT INTO `zones_m17n` VALUES (95,9,'Wien');
INSERT INTO `zones_m17n` VALUES (94,9,'Thringen');
INSERT INTO `zones_m17n` VALUES (93,9,'Schleswig-Holstein');
INSERT INTO `zones_m17n` VALUES (92,9,'Sachsen-Anhalt');
INSERT INTO `zones_m17n` VALUES (91,9,'Sachsen');
INSERT INTO `zones_m17n` VALUES (90,9,'Saarland');
INSERT INTO `zones_m17n` VALUES (89,9,'Rheinland-Pfalz');
INSERT INTO `zones_m17n` VALUES (88,9,'Nordrhein-Westfalen');
INSERT INTO `zones_m17n` VALUES (87,9,'Mecklenburg-Vorpommern');
INSERT INTO `zones_m17n` VALUES (86,9,'Hessen');
INSERT INTO `zones_m17n` VALUES (85,9,'Hamburg');
INSERT INTO `zones_m17n` VALUES (84,9,'Bremen');
INSERT INTO `zones_m17n` VALUES (83,9,'Brandenburg');
INSERT INTO `zones_m17n` VALUES (82,9,'Berlin');
INSERT INTO `zones_m17n` VALUES (81,9,'Bayern');
INSERT INTO `zones_m17n` VALUES (80,9,'Baden-Wrttemberg');
INSERT INTO `zones_m17n` VALUES (79,9,'Niedersachsen');
INSERT INTO `zones_m17n` VALUES (78,9,'Yukon Territory');
INSERT INTO `zones_m17n` VALUES (77,9,'Saskatchewan');
INSERT INTO `zones_m17n` VALUES (76,9,'Quebec');
INSERT INTO `zones_m17n` VALUES (75,9,'Prince Edward Island');
INSERT INTO `zones_m17n` VALUES (74,9,'Ontario');
INSERT INTO `zones_m17n` VALUES (73,9,'Nunavut');
INSERT INTO `zones_m17n` VALUES (72,9,'Northwest Territories');
INSERT INTO `zones_m17n` VALUES (71,9,'Nova Scotia');
INSERT INTO `zones_m17n` VALUES (70,9,'New Brunswick');
INSERT INTO `zones_m17n` VALUES (69,9,'Newfoundland');
INSERT INTO `zones_m17n` VALUES (68,9,'Manitoba');
INSERT INTO `zones_m17n` VALUES (67,9,'British Columbia');
INSERT INTO `zones_m17n` VALUES (66,9,'Alberta');
INSERT INTO `zones_m17n` VALUES (65,9,'Wyoming');
INSERT INTO `zones_m17n` VALUES (64,9,'Wisconsin');
INSERT INTO `zones_m17n` VALUES (63,9,'West Virginia');
INSERT INTO `zones_m17n` VALUES (62,9,'Washington');
INSERT INTO `zones_m17n` VALUES (61,9,'Virginia');
INSERT INTO `zones_m17n` VALUES (60,9,'Virgin Islands');
INSERT INTO `zones_m17n` VALUES (59,9,'Vermont');
INSERT INTO `zones_m17n` VALUES (58,9,'Utah');
INSERT INTO `zones_m17n` VALUES (57,9,'Texas');
INSERT INTO `zones_m17n` VALUES (56,9,'Tennessee');
INSERT INTO `zones_m17n` VALUES (55,9,'South Dakota');
INSERT INTO `zones_m17n` VALUES (54,9,'South Carolina');
INSERT INTO `zones_m17n` VALUES (53,9,'Rhode Island');
INSERT INTO `zones_m17n` VALUES (52,9,'Puerto Rico');
INSERT INTO `zones_m17n` VALUES (51,9,'Pennsylvania');
INSERT INTO `zones_m17n` VALUES (50,9,'Palau');
INSERT INTO `zones_m17n` VALUES (49,9,'Oregon');
INSERT INTO `zones_m17n` VALUES (48,9,'Oklahoma');
INSERT INTO `zones_m17n` VALUES (47,9,'Ohio');
INSERT INTO `zones_m17n` VALUES (46,9,'Northern Mariana Islands');
INSERT INTO `zones_m17n` VALUES (45,9,'North Dakota');
INSERT INTO `zones_m17n` VALUES (44,9,'North Carolina');
INSERT INTO `zones_m17n` VALUES (43,9,'New York');
INSERT INTO `zones_m17n` VALUES (42,9,'New Mexico');
INSERT INTO `zones_m17n` VALUES (41,9,'New Jersey');
INSERT INTO `zones_m17n` VALUES (40,9,'New Hampshire');
INSERT INTO `zones_m17n` VALUES (39,9,'Nevada');
INSERT INTO `zones_m17n` VALUES (38,9,'Nebraska');
INSERT INTO `zones_m17n` VALUES (37,9,'Montana');
INSERT INTO `zones_m17n` VALUES (36,9,'Missouri');
INSERT INTO `zones_m17n` VALUES (35,9,'Mississippi');
INSERT INTO `zones_m17n` VALUES (34,9,'Minnesota');
INSERT INTO `zones_m17n` VALUES (33,9,'Michigan');
INSERT INTO `zones_m17n` VALUES (32,9,'Massachusetts');
INSERT INTO `zones_m17n` VALUES (31,9,'Maryland');
INSERT INTO `zones_m17n` VALUES (30,9,'Marshall Islands');
INSERT INTO `zones_m17n` VALUES (29,9,'Maine');
INSERT INTO `zones_m17n` VALUES (28,9,'Louisiana');
INSERT INTO `zones_m17n` VALUES (27,9,'Kentucky');
INSERT INTO `zones_m17n` VALUES (26,9,'Kansas');
INSERT INTO `zones_m17n` VALUES (25,9,'Iowa');
INSERT INTO `zones_m17n` VALUES (24,9,'Indiana');
INSERT INTO `zones_m17n` VALUES (23,9,'Illinois');
INSERT INTO `zones_m17n` VALUES (22,9,'Idaho');
INSERT INTO `zones_m17n` VALUES (21,9,'Hawaii');
INSERT INTO `zones_m17n` VALUES (20,9,'Guam');
INSERT INTO `zones_m17n` VALUES (19,9,'Georgia');
INSERT INTO `zones_m17n` VALUES (18,9,'Florida');
INSERT INTO `zones_m17n` VALUES (17,9,'Federated States Of Micronesia');
INSERT INTO `zones_m17n` VALUES (16,9,'District of Columbia');
INSERT INTO `zones_m17n` VALUES (15,9,'Delaware');
INSERT INTO `zones_m17n` VALUES (14,9,'Connecticut');
INSERT INTO `zones_m17n` VALUES (13,9,'Colorado');
INSERT INTO `zones_m17n` VALUES (12,9,'California');
INSERT INTO `zones_m17n` VALUES (11,9,'Armed Forces Pacific');
INSERT INTO `zones_m17n` VALUES (10,9,'Armed Forces Middle East');
INSERT INTO `zones_m17n` VALUES (9,9,'Armed Forces Europe');
INSERT INTO `zones_m17n` VALUES (8,9,'Armed Forces Canada');
INSERT INTO `zones_m17n` VALUES (7,9,'Armed Forces Americas');
INSERT INTO `zones_m17n` VALUES (6,9,'Armed Forces Africa');
INSERT INTO `zones_m17n` VALUES (5,9,'Arkansas');
INSERT INTO `zones_m17n` VALUES (4,9,'Arizona');
INSERT INTO `zones_m17n` VALUES (3,9,'American Samoa');
INSERT INTO `zones_m17n` VALUES (2,9,'Alaska');
INSERT INTO `zones_m17n` VALUES (1,9,'Alabama');
INSERT INTO `zones_m17n` VALUES (155,9,'Jaen');
INSERT INTO `zones_m17n` VALUES (156,9,'La Rioja');
INSERT INTO `zones_m17n` VALUES (157,9,'Las Palmas');
INSERT INTO `zones_m17n` VALUES (158,9,'Leon');
INSERT INTO `zones_m17n` VALUES (159,9,'Lleida');
INSERT INTO `zones_m17n` VALUES (160,9,'Lugo');
INSERT INTO `zones_m17n` VALUES (161,9,'Madrid');
INSERT INTO `zones_m17n` VALUES (162,9,'Malaga');
INSERT INTO `zones_m17n` VALUES (163,9,'Melilla');
INSERT INTO `zones_m17n` VALUES (164,9,'Murcia');
INSERT INTO `zones_m17n` VALUES (165,9,'Navarra');
INSERT INTO `zones_m17n` VALUES (166,9,'Ourense');
INSERT INTO `zones_m17n` VALUES (167,9,'Palencia');
INSERT INTO `zones_m17n` VALUES (168,9,'Pontevedra');
INSERT INTO `zones_m17n` VALUES (169,9,'Salamanca');
INSERT INTO `zones_m17n` VALUES (170,9,'Santa Cruz de Tenerife');
INSERT INTO `zones_m17n` VALUES (171,9,'Segovia');
INSERT INTO `zones_m17n` VALUES (172,9,'Sevilla');
INSERT INTO `zones_m17n` VALUES (173,9,'Soria');
INSERT INTO `zones_m17n` VALUES (174,9,'Tarragona');
INSERT INTO `zones_m17n` VALUES (175,9,'Teruel');
INSERT INTO `zones_m17n` VALUES (176,9,'Toledo');
INSERT INTO `zones_m17n` VALUES (177,9,'Valencia');
INSERT INTO `zones_m17n` VALUES (178,9,'Valladolid');
INSERT INTO `zones_m17n` VALUES (179,9,'Vizcaya');
INSERT INTO `zones_m17n` VALUES (180,9,'Zamora');
INSERT INTO `zones_m17n` VALUES (181,9,'Zaragoza');
INSERT INTO `zones_m17n` VALUES (182,9,'北海道');
INSERT INTO `zones_m17n` VALUES (183,9,'青森県');
INSERT INTO `zones_m17n` VALUES (184,9,'岩手県');
INSERT INTO `zones_m17n` VALUES (185,9,'宮城県');
INSERT INTO `zones_m17n` VALUES (186,9,'秋田県');
INSERT INTO `zones_m17n` VALUES (187,9,'山形県');
INSERT INTO `zones_m17n` VALUES (188,9,'福島県');
INSERT INTO `zones_m17n` VALUES (189,9,'茨城県');
INSERT INTO `zones_m17n` VALUES (190,9,'栃木県');
INSERT INTO `zones_m17n` VALUES (191,9,'群馬県');
INSERT INTO `zones_m17n` VALUES (192,9,'埼玉県');
INSERT INTO `zones_m17n` VALUES (193,9,'千葉県');
INSERT INTO `zones_m17n` VALUES (194,9,'東京都');
INSERT INTO `zones_m17n` VALUES (195,9,'神奈川県');
INSERT INTO `zones_m17n` VALUES (196,9,'新潟県');
INSERT INTO `zones_m17n` VALUES (197,9,'富山県');
INSERT INTO `zones_m17n` VALUES (198,9,'石川県');
INSERT INTO `zones_m17n` VALUES (199,9,'福井県');
INSERT INTO `zones_m17n` VALUES (200,9,'山梨県');
INSERT INTO `zones_m17n` VALUES (201,9,'長野県');
INSERT INTO `zones_m17n` VALUES (202,9,'岐阜県');
INSERT INTO `zones_m17n` VALUES (203,9,'静岡県');
INSERT INTO `zones_m17n` VALUES (204,9,'愛知県');
INSERT INTO `zones_m17n` VALUES (205,9,'三重県');
INSERT INTO `zones_m17n` VALUES (206,9,'滋賀県');
INSERT INTO `zones_m17n` VALUES (207,9,'京都府');
INSERT INTO `zones_m17n` VALUES (208,9,'大阪府');
INSERT INTO `zones_m17n` VALUES (209,9,'兵庫県');
INSERT INTO `zones_m17n` VALUES (210,9,'奈良県');
INSERT INTO `zones_m17n` VALUES (211,9,'和歌山県');
INSERT INTO `zones_m17n` VALUES (212,9,'鳥取県');
INSERT INTO `zones_m17n` VALUES (213,9,'島根県');
INSERT INTO `zones_m17n` VALUES (214,9,'岡山県');
INSERT INTO `zones_m17n` VALUES (215,9,'広島県');
INSERT INTO `zones_m17n` VALUES (216,9,'山口県');
INSERT INTO `zones_m17n` VALUES (217,9,'徳島県');
INSERT INTO `zones_m17n` VALUES (218,9,'香川県');
INSERT INTO `zones_m17n` VALUES (219,9,'愛媛県');
INSERT INTO `zones_m17n` VALUES (220,9,'高知県');
INSERT INTO `zones_m17n` VALUES (221,9,'福岡県');
INSERT INTO `zones_m17n` VALUES (222,9,'佐賀県');
INSERT INTO `zones_m17n` VALUES (223,9,'長崎県');
INSERT INTO `zones_m17n` VALUES (224,9,'熊本県');
INSERT INTO `zones_m17n` VALUES (225,9,'大分県');
INSERT INTO `zones_m17n` VALUES (226,9,'宮崎県');
INSERT INTO `zones_m17n` VALUES (227,9,'鹿児島県');
INSERT INTO `zones_m17n` VALUES (228,9,'沖縄県');
/*!40000 ALTER TABLE `zones_m17n` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zones_to_geo_zones`
--

DROP TABLE IF EXISTS `zones_to_geo_zones`;
CREATE TABLE `zones_to_geo_zones` (
  `association_id` int(11) NOT NULL auto_increment,
  `zone_country_id` int(11) NOT NULL default '0',
  `zone_id` int(11) default NULL,
  `geo_zone_id` int(11) default NULL,
  `last_modified` datetime default NULL,
  `date_added` datetime NOT NULL default '0001-01-01 00:00:00',
  PRIMARY KEY  (`association_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `zones_to_geo_zones`
--

LOCK TABLES `zones_to_geo_zones` WRITE;
/*!40000 ALTER TABLE `zones_to_geo_zones` DISABLE KEYS */;
INSERT INTO `zones_to_geo_zones` VALUES (1,107,NULL,1,'2007-01-21 11:44:32','2006-11-29 16:18:40');
/*!40000 ALTER TABLE `zones_to_geo_zones` ENABLE KEYS */;
UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

