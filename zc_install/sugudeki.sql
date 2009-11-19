-- MySQL dump 10.9
--
-- Host: localhost    Database: ohtsuji_sugudeki
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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `address_book`
--

LOCK TABLES `address_book` WRITE;
/*!40000 ALTER TABLE `address_book` DISABLE KEYS */;
INSERT INTO `address_book` VALUES (1,1,'m','JustaDemo','Bill','Smith','123 Any Avenue','','12345','Here','',223,12,'',NULL,'',''),(2,2,'m','','saito','s','上新城',NULL,'010-0134','秋田市','',107,186,'0123456789','','さいとう','さ');
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
INSERT INTO `address_format` VALUES (1,'$firstname $lastname$cr$streets$cr$city, $postcode$cr$statecomma$country','$city / $country'),(2,'$firstname $lastname$cr$streets$cr$city, $state    $postcode$cr$country','$city, $state / $country'),(3,'$firstname $lastname$cr$streets$cr$city$cr$postcode - $statecomma$country','$state / $country'),(4,'$firstname $lastname$cr$streets$cr$city ($postcode)$cr$country','$postcode / $country'),(5,'$firstname $lastname$cr$streets$cr$postcode $city$cr$country','$city / $country'),(6,'$firstname $lastname$cr$postcode$cr$state$city$cr$streets$cr$country$cr$telephone$cr$fax','$statename $city');
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
INSERT INTO `admin` VALUES (1,'admin','ohtsuji@ark-web.jp','a191c752052af1ef6e405beb89e63567:dd',1);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
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
) ENGINE=MyISAM AUTO_INCREMENT=236 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `admin_activity_log`
--

LOCK TABLES `admin_activity_log` WRITE;
/*!40000 ALTER TABLE `admin_activity_log` DISABLE KEYS */;
INSERT INTO `admin_activity_log` VALUES (1,'2009-11-19 12:42:23',1,'addon_modules.php','','192.168.0.100'),(2,'2009-11-19 12:42:32',1,'addon_modules.php','module=addon_modules&','192.168.0.100'),(3,'2009-11-19 12:42:37',1,'addon_modules.php','module=addon_modules&action=install&','192.168.0.100'),(4,'2009-11-19 12:42:38',1,'addon_modules.php','module=addon_modules&action=edit&','192.168.0.100'),(5,'2009-11-19 12:43:00',1,'addon_modules.php','module=addon_modules&action=save&','192.168.0.100'),(6,'2009-11-19 12:43:00',1,'addon_modules.php','module=addon_modules&','192.168.0.100'),(7,'2009-11-19 12:46:49',1,'addon_modules.php','module=addon_modules&','192.168.0.100'),(8,'2009-11-19 12:47:06',1,'template_select.php','','192.168.0.100'),(9,'2009-11-19 12:47:11',1,'template_select.php','page=1&tID=1&action=edit&','192.168.0.100'),(10,'2009-11-19 12:47:11',1,'template_select.php','page=1&tID=1&action=edit&','192.168.0.100'),(11,'2009-11-19 12:47:21',1,'template_select.php','page=1&tID=1&action=save&','192.168.0.100'),(12,'2009-11-19 12:50:43',1,'template_select.php','page=1&tID=1&action=edit&','192.168.0.100'),(13,'2009-11-19 12:50:46',1,'addon_modules.php','','192.168.0.100'),(14,'2009-11-19 12:50:52',1,'addon_modules.php','module=aboutbox&action=install&','192.168.0.100'),(15,'2009-11-19 12:50:53',1,'addon_modules.php','module=aboutbox&action=edit&','192.168.0.100'),(16,'2009-11-19 12:50:53',1,'addon_modules.php','module=aboutbox&action=install&','192.168.0.100'),(17,'2009-11-19 12:51:00',1,'addon_modules.php','','192.168.0.100'),(18,'2009-11-19 12:51:11',1,'addon_modules.php','module=ajax_category_tree&','192.168.0.100'),(19,'2009-11-19 12:51:17',1,'addon_modules.php','module=ajax_category_tree&action=install&','192.168.0.100'),(20,'2009-11-19 12:51:17',1,'addon_modules.php','module=ajax_category_tree&','192.168.0.100'),(21,'2009-11-19 12:51:27',1,'addon_modules.php','module=jquery&','192.168.0.100'),(22,'2009-11-19 12:51:33',1,'addon_modules.php','module=jquery&action=install&','192.168.0.100'),(23,'2009-11-19 12:51:33',1,'addon_modules.php','module=jquery&action=edit&','192.168.0.100'),(24,'2009-11-19 12:51:43',1,'addon_modules.php','module=jquery&action=save&','192.168.0.100'),(25,'2009-11-19 12:51:43',1,'addon_modules.php','module=jquery&','192.168.0.100'),(26,'2009-11-19 12:51:52',1,'addon_modules.php','module=ajax_category_tree&','192.168.0.100'),(27,'2009-11-19 12:51:55',1,'addon_modules.php','module=ajax_category_tree&action=install&','192.168.0.100'),(28,'2009-11-19 12:51:56',1,'addon_modules.php','module=ajax_category_tree&action=edit&','192.168.0.100'),(29,'2009-11-19 12:52:09',1,'addon_modules.php','module=ajax_category_tree&action=save&','192.168.0.100'),(30,'2009-11-19 12:52:09',1,'addon_modules.php','module=ajax_category_tree&','192.168.0.100'),(31,'2009-11-19 12:52:18',1,'addon_modules.php','module=ajax_category_tree&action=edit&','192.168.0.100'),(32,'2009-11-19 12:52:25',1,'addon_modules.php','module=blog&','192.168.0.100'),(33,'2009-11-19 12:52:36',1,'addon_modules.php','module=blog&action=install&','192.168.0.100'),(34,'2009-11-19 12:52:36',1,'addon_modules.php','module=blog&action=edit&','192.168.0.100'),(35,'2009-11-19 12:52:52',1,'addon_modules.php','module=blog&action=save&','192.168.0.100'),(36,'2009-11-19 12:52:53',1,'addon_modules.php','module=blog&','192.168.0.100'),(37,'2009-11-19 12:52:59',1,'addon_modules.php','module=calendar&','192.168.0.100'),(38,'2009-11-19 12:53:04',1,'addon_modules.php','module=calendar&action=install&','192.168.0.100'),(39,'2009-11-19 12:53:05',1,'addon_modules.php','module=calendar&action=edit&','192.168.0.100'),(40,'2009-11-19 12:53:16',1,'addon_modules.php','module=calendar&action=save&','192.168.0.100'),(41,'2009-11-19 12:53:16',1,'addon_modules.php','module=calendar&','192.168.0.100'),(42,'2009-11-19 12:53:48',1,'addon_modules.php','module=carousel_ui&','192.168.0.100'),(43,'2009-11-19 12:53:57',1,'addon_modules.php','module=carousel_ui&action=install&','192.168.0.100'),(44,'2009-11-19 12:53:57',1,'addon_modules.php','module=carousel_ui&action=edit&','192.168.0.100'),(45,'2009-11-19 12:54:17',1,'addon_modules.php','module=carousel_ui&action=save&','192.168.0.100'),(46,'2009-11-19 12:54:18',1,'addon_modules.php','module=carousel_ui&','192.168.0.100'),(47,'2009-11-19 12:54:36',1,'addon_modules.php','module=category_sitemap&','192.168.0.100'),(48,'2009-11-19 12:54:42',1,'addon_modules.php','module=category_sitemap&action=install&','192.168.0.100'),(49,'2009-11-19 12:54:43',1,'addon_modules.php','module=category_sitemap&action=edit&','192.168.0.100'),(50,'2009-11-19 12:54:50',1,'addon_modules.php','module=category_sitemap&action=save&','192.168.0.100'),(51,'2009-11-19 12:54:50',1,'addon_modules.php','module=category_sitemap&','192.168.0.100'),(52,'2009-11-19 12:54:59',1,'configuration.php','gID=18&','192.168.0.100'),(53,'2009-11-19 12:55:37',1,'configuration.php','gID=100&','192.168.0.100'),(54,'2009-11-19 12:55:37',1,'configuration.php','gID=18&cID=335&action=edit&','192.168.0.100'),(55,'2009-11-19 12:55:50',1,'configuration.php','gID=18&','192.168.0.100'),(56,'2009-11-19 12:55:55',1,'addon_modules.php','module=category_sitemap&','192.168.0.100'),(57,'2009-11-19 12:56:03',1,'addon_modules.php','module=checkout_step&','192.168.0.100'),(58,'2009-11-19 12:56:18',1,'addon_modules.php','module=checkout_step&action=install&','192.168.0.100'),(59,'2009-11-19 12:56:18',1,'addon_modules.php','module=checkout_step&action=edit&','192.168.0.100'),(60,'2009-11-19 12:56:27',1,'addon_modules.php','module=easy_admin&','192.168.0.100'),(61,'2009-11-19 12:56:42',1,'addon_modules.php','module=easy_admin&action=install&','192.168.0.100'),(62,'2009-11-19 12:56:42',1,'addon_modules.php','module=easy_admin&action=edit&','192.168.0.100'),(63,'2009-11-19 12:56:50',1,'addon_modules.php','module=easy_admin&action=save&','192.168.0.100'),(64,'2009-11-19 12:56:50',1,'addon_modules.php','module=easy_admin&','192.168.0.100'),(65,'2009-11-19 12:57:03',1,'addon_modules.php','module=easy_admin_simplify&','192.168.0.100'),(66,'2009-11-19 12:59:19',1,'addon_modules.php','module=easy_admin_simplify&','192.168.0.100'),(67,'2009-11-19 12:59:21',1,'addon_modules.php','module=easy_admin_simplify&action=install&','192.168.0.100'),(68,'2009-11-19 12:59:21',1,'addon_modules.php','module=easy_admin_simplify&action=edit&','192.168.0.100'),(69,'2009-11-19 12:59:30',1,'addon_modules.php','module=easy_admin_simplify&action=save&','192.168.0.100'),(70,'2009-11-19 12:59:30',1,'addon_modules.php','module=easy_admin_simplify&','192.168.0.100'),(71,'2009-11-19 12:59:42',1,'addon_modules.php','module=easy_design&','192.168.0.100'),(72,'2009-11-19 12:59:53',1,'addon_modules.php','module=easy_design&action=install&','192.168.0.100'),(73,'2009-11-19 12:59:53',1,'addon_modules.php','module=easy_design&action=edit&','192.168.0.100'),(74,'2009-11-19 13:00:02',1,'addon_modules.php','module=easy_design&action=save&','192.168.0.100'),(75,'2009-11-19 13:00:02',1,'addon_modules.php','module=easy_design&','192.168.0.100'),(76,'2009-11-19 13:01:26',1,'addon_modules.php','module=email_templates&','192.168.0.100'),(77,'2009-11-19 13:01:34',1,'addon_modules.php','module=email_templates&action=install&','192.168.0.100'),(78,'2009-11-19 13:01:34',1,'addon_modules.php','module=email_templates&action=edit&','192.168.0.100'),(79,'2009-11-19 13:01:43',1,'addon_modules.php','module=email_templates&action=save&','192.168.0.100'),(80,'2009-11-19 13:01:43',1,'addon_modules.php','module=email_templates&','192.168.0.100'),(81,'2009-11-19 13:01:53',1,'addon_modules.php','module=email_templates&action=edit&','192.168.0.100'),(82,'2009-11-19 13:02:01',1,'addon_modules.php','module=email_templates&action=save&','192.168.0.100'),(83,'2009-11-19 13:02:02',1,'addon_modules.php','module=email_templates&','192.168.0.100'),(84,'2009-11-19 13:02:12',1,'addon_modules.php','module=feature_area&','192.168.0.100'),(85,'2009-11-19 13:02:18',1,'addon_modules.php','module=feature_area&action=install&','192.168.0.100'),(86,'2009-11-19 13:02:19',1,'addon_modules.php','module=feature_area&action=edit&','192.168.0.100'),(87,'2009-11-19 13:02:41',1,'addon_modules.php','module=feature_area&action=save&','192.168.0.100'),(88,'2009-11-19 13:02:42',1,'addon_modules.php','module=feature_area&','192.168.0.100'),(89,'2009-11-19 13:03:07',1,'addon_modules.php','module=globalnavi&','192.168.0.100'),(90,'2009-11-19 13:03:12',1,'addon_modules.php','module=globalnavi&action=install&','192.168.0.100'),(91,'2009-11-19 13:03:13',1,'addon_modules.php','module=globalnavi&action=edit&','192.168.0.100'),(92,'2009-11-19 13:03:34',1,'addon_modules.php','module=globalnavi&action=save&','192.168.0.100'),(93,'2009-11-19 13:03:34',1,'addon_modules.php','module=globalnavi&','192.168.0.100'),(94,'2009-11-19 13:03:45',1,'addon_modules.php','module=multiple_image_view&','192.168.0.100'),(95,'2009-11-19 13:03:54',1,'addon_modules.php','module=multiple_image_view&action=install&','192.168.0.100'),(96,'2009-11-19 13:03:58',1,'addon_modules.php','module=multiple_image_view&action=edit&','192.168.0.100'),(97,'2009-11-19 13:04:10',1,'addon_modules.php','module=multiple_image_view&action=save&','192.168.0.100'),(98,'2009-11-19 13:04:11',1,'addon_modules.php','module=multiple_image_view&','192.168.0.100'),(99,'2009-11-19 13:04:23',1,'addon_modules.php','module=product_csv&','192.168.0.100'),(100,'2009-11-19 13:04:30',1,'addon_modules.php','module=product_csv&action=install&','192.168.0.100'),(101,'2009-11-19 13:04:31',1,'addon_modules.php','module=product_csv&action=edit&','192.168.0.100'),(102,'2009-11-19 13:04:41',1,'addon_modules.php','module=product_csv&action=save&','192.168.0.100'),(103,'2009-11-19 13:04:41',1,'addon_modules.php','module=product_csv&','192.168.0.100'),(104,'2009-11-19 13:04:50',1,'addon_modules.php','module=products_with_attributes_stock&','192.168.0.100'),(105,'2009-11-19 13:05:03',1,'addon_modules.php','module=products_with_attributes_stock&action=install&','192.168.0.100'),(106,'2009-11-19 13:05:03',1,'addon_modules.php','module=products_with_attributes_stock&action=edit&','192.168.0.100'),(107,'2009-11-19 13:05:13',1,'addon_modules.php','module=products_with_attributes_stock&action=save&','192.168.0.100'),(108,'2009-11-19 13:05:13',1,'addon_modules.php','module=products_with_attributes_stock&','192.168.0.100'),(109,'2009-11-19 13:05:23',1,'addon_modules.php','module=reviews&','192.168.0.100'),(110,'2009-11-19 13:05:33',1,'addon_modules.php','module=reviews&action=install&','192.168.0.100'),(111,'2009-11-19 13:05:33',1,'addon_modules.php','module=reviews&action=edit&','192.168.0.100'),(112,'2009-11-19 13:05:43',1,'addon_modules.php','module=reviews&action=save&','192.168.0.100'),(113,'2009-11-19 13:05:43',1,'addon_modules.php','module=reviews&','192.168.0.100'),(114,'2009-11-19 13:05:53',1,'addon_modules.php','module=search_more&','192.168.0.100'),(115,'2009-11-19 13:06:01',1,'addon_modules.php','module=search_more&action=install&','192.168.0.100'),(116,'2009-11-19 13:06:02',1,'addon_modules.php','module=search_more&action=edit&','192.168.0.100'),(117,'2009-11-19 13:06:10',1,'addon_modules.php','module=search_more&action=save&','192.168.0.100'),(118,'2009-11-19 13:06:10',1,'addon_modules.php','module=search_more&','192.168.0.100'),(119,'2009-11-19 13:06:20',1,'addon_modules.php','module=visitors&','192.168.0.100'),(120,'2009-11-19 13:06:28',1,'addon_modules.php','module=visitors&action=install&','192.168.0.100'),(121,'2009-11-19 13:06:28',1,'addon_modules.php','module=visitors&action=edit&','192.168.0.100'),(122,'2009-11-19 13:06:36',1,'addon_modules.php','module=visitors&action=save&','192.168.0.100'),(123,'2009-11-19 13:06:37',1,'addon_modules.php','module=visitors&','192.168.0.100'),(124,'2009-11-19 13:09:53',1,'alt_nav.php','','192.168.0.100'),(125,'2009-11-19 13:10:03',1,'configuration.php','gID=30&','192.168.0.100'),(126,'2009-11-19 13:10:17',1,'configuration.php','gID=30&cID=482&action=edit&','192.168.0.100'),(127,'2009-11-19 13:10:24',1,'configuration.php','gID=30&cID=482&action=save&','192.168.0.100'),(128,'2009-11-19 13:10:25',1,'configuration.php','gID=30&cID=482&','192.168.0.100'),(129,'2009-11-19 13:15:00',1,'ezpages.php','','192.168.0.100'),(130,'2009-11-19 13:17:20',1,'ezpages.php','action=status_header&current=1&ezID=1&page=1&','192.168.0.100'),(131,'2009-11-19 13:17:21',1,'ezpages.php','page=1&ezID=1&','192.168.0.100'),(132,'2009-11-19 13:17:27',1,'ezpages.php','page=1&ezID=1&','192.168.0.100'),(133,'2009-11-19 13:17:41',1,'ezpages.php','page=1&ezID=1&','192.168.0.100'),(134,'2009-11-19 13:17:42',1,'ezpages.php','action=status_header&current=0&ezID=1&page=1&','192.168.0.100'),(135,'2009-11-19 13:17:43',1,'ezpages.php','page=1&ezID=1&','192.168.0.100'),(136,'2009-11-19 13:20:01',1,'addon_modules_admin.php','module=easy_design&','192.168.0.100'),(137,'2009-11-19 13:23:39',1,'addon_modules_admin.php','module=easy_design&','192.168.0.100'),(138,'2009-11-19 13:24:44',1,'addon_modules_admin.php','module=easy_design&','192.168.0.100'),(139,'2009-11-19 13:25:15',1,'addon_modules.php','','192.168.0.100'),(140,'2009-11-19 13:25:23',1,'addon_modules.php','module=aboutbox&action=edit&','192.168.0.100'),(141,'2009-11-19 13:27:38',1,'addon_modules.php','module=aboutbox&action=save&','192.168.0.100'),(142,'2009-11-19 13:27:39',1,'addon_modules.php','module=aboutbox&','192.168.0.100'),(143,'2009-11-19 13:28:20',1,'addon_modules_admin.php','module=easy_design&','192.168.0.100'),(144,'2009-11-19 13:29:52',1,'addon_modules_admin.php','module=easy_design&','192.168.0.100'),(145,'2009-11-19 13:30:52',1,'alt_nav.php','','192.168.0.100'),(146,'2009-11-19 13:30:53',1,'alt_nav.php','','192.168.0.100'),(147,'2009-11-19 13:31:12',1,'banner_manager.php','','192.168.0.100'),(148,'2009-11-19 13:31:32',1,'banner_manager.php','action=new&','192.168.0.100'),(149,'2009-11-19 13:33:36',1,'banner_manager.php','action=insert&','192.168.0.100'),(150,'2009-11-19 14:05:12',1,'admin.php','','192.168.0.113'),(151,'2009-11-19 14:05:14',1,'admin.php','page=1&adminID=1&action=resetpassword&','192.168.0.113'),(152,'2009-11-19 14:05:19',1,'admin.php','page=1&adminID=1&action=reset&','192.168.0.113'),(153,'2009-11-19 14:05:19',1,'admin.php','page=1&adminID=1&','192.168.0.113'),(154,'2009-11-19 14:05:23',1,'logoff.php','','192.168.0.113'),(155,'2009-11-19 16:22:52',1,'alt_nav.php','','192.168.0.100'),(156,'2009-11-19 16:23:15',1,'addon_modules_admin.php','module=products_with_attributes_stock&','192.168.0.100'),(157,'2009-11-19 16:24:11',1,'addon_modules_admin.php','module=products_with_attributes_stock&action=add&products_id=90&','192.168.0.100'),(158,'2009-11-19 16:25:11',1,'addon_modules_admin.php','module=products_with_attributes_stock&action=confirm&','192.168.0.100'),(159,'2009-11-19 16:25:11',1,'addon_modules_admin.php','module=products_with_attributes_stock&products_id=90&quantity=11&skumodel=%A3%D7%A3%B5%A3%B0%A3%B0&attributes=319&add_edit=add&action=execute&','192.168.0.100'),(160,'2009-11-19 16:25:11',1,'addon_modules_admin.php','module=products_with_attributes_stock&','192.168.0.100'),(161,'2009-11-19 16:25:54',1,'addon_modules_admin.php','module=products_with_attributes_stock&action=edit&products_id=90&stock_id=1&','192.168.0.100'),(162,'2009-11-19 16:26:50',1,'addon_modules_admin.php','module=products_with_attributes_stock&','192.168.0.100'),(163,'2009-11-19 18:24:58',1,'modules.php','set=ordertotal&','192.168.0.100'),(164,'2009-11-19 18:25:05',1,'modules.php','set=ordertotal&module=ot_addpoint&action=install&','192.168.0.100'),(165,'2009-11-19 18:25:05',1,'modules.php','set=ordertotal&module=ot_addpoint&','192.168.0.100'),(166,'2009-11-19 18:25:15',1,'modules.php','set=ordertotal&module=ot_addpoint&action=install&','192.168.0.100'),(167,'2009-11-19 18:25:16',1,'modules.php','set=ordertotal&module=ot_addpoint&','192.168.0.100'),(168,'2009-11-19 18:25:27',1,'addon_modules.php','','192.168.0.100'),(169,'2009-11-19 18:25:35',1,'addon_modules.php','module=point_base&','192.168.0.100'),(170,'2009-11-19 18:25:40',1,'addon_modules.php','module=point_base&action=install&','192.168.0.100'),(171,'2009-11-19 18:25:41',1,'addon_modules.php','module=point_base&action=edit&','192.168.0.100'),(172,'2009-11-19 18:25:49',1,'addon_modules.php','module=point_base&action=save&','192.168.0.100'),(173,'2009-11-19 18:25:49',1,'addon_modules.php','module=point_base&','192.168.0.100'),(174,'2009-11-19 18:25:54',1,'modules.php','set=ordertotal&module=ot_addpoint&action=install&','192.168.0.100'),(175,'2009-11-19 18:25:54',1,'modules.php','set=ordertotal&module=ot_addpoint&action=edit&','192.168.0.100'),(176,'2009-11-19 18:26:02',1,'modules.php','set=ordertotal&module=ot_addpoint&action=save&','192.168.0.100'),(177,'2009-11-19 18:26:02',1,'modules.php','set=ordertotal&module=ot_addpoint&','192.168.0.100'),(178,'2009-11-19 18:26:06',1,'modules.php','set=ordertotal&module=ot_subpoint&','192.168.0.100'),(179,'2009-11-19 18:26:12',1,'modules.php','set=ordertotal&module=ot_subpoint&action=install&','192.168.0.100'),(180,'2009-11-19 18:26:12',1,'modules.php','set=ordertotal&module=ot_subpoint&action=edit&','192.168.0.100'),(181,'2009-11-19 18:26:20',1,'modules.php','set=ordertotal&module=ot_subpoint&action=save&','192.168.0.100'),(182,'2009-11-19 18:26:20',1,'modules.php','set=ordertotal&module=ot_subpoint&','192.168.0.100'),(183,'2009-11-19 18:26:37',1,'addon_modules_admin.php','module=addon_modules/blocks&','192.168.0.100'),(184,'2009-11-19 18:27:16',1,'addon_modules_admin.php','module=addon_modules/blocks&page=&bID=178&action=edit&','192.168.0.100'),(185,'2009-11-19 18:27:47',1,'addon_modules_admin.php','module=addon_modules/blocks&page=&bID=178&action=save&block=block&','192.168.0.100'),(186,'2009-11-19 18:27:48',1,'addon_modules_admin.php','module=addon_modules/blocks&page=&bID=178&','192.168.0.100'),(187,'2009-11-19 18:55:40',1,'addon_modules.php','','192.168.0.100'),(188,'2009-11-19 18:56:01',1,'addon_modules.php','module=point_createaccount&','192.168.0.100'),(189,'2009-11-19 18:56:07',1,'addon_modules.php','module=point_createaccount&action=install&','192.168.0.100'),(190,'2009-11-19 18:56:08',1,'addon_modules.php','module=point_createaccount&action=edit&','192.168.0.100'),(191,'2009-11-19 18:56:16',1,'addon_modules.php','module=point_createaccount&action=save&','192.168.0.100'),(192,'2009-11-19 18:56:16',1,'addon_modules.php','module=point_createaccount&','192.168.0.100'),(193,'2009-11-19 18:56:23',1,'addon_modules.php','module=point_customersrate&','192.168.0.100'),(194,'2009-11-19 18:56:29',1,'addon_modules.php','module=point_customersrate&action=install&','192.168.0.100'),(195,'2009-11-19 18:56:29',1,'addon_modules.php','module=point_customersrate&action=edit&','192.168.0.100'),(196,'2009-11-19 18:56:37',1,'addon_modules.php','module=point_customersrate&action=save&','192.168.0.100'),(197,'2009-11-19 18:56:38',1,'addon_modules.php','module=point_customersrate&','192.168.0.100'),(198,'2009-11-19 18:56:45',1,'addon_modules.php','module=point_grouprate&','192.168.0.100'),(199,'2009-11-19 18:56:53',1,'addon_modules.php','module=point_grouprate&action=install&','192.168.0.100'),(200,'2009-11-19 18:56:53',1,'addon_modules.php','module=point_grouprate&action=edit&','192.168.0.100'),(201,'2009-11-19 18:57:07',1,'addon_modules.php','module=point_grouprate&action=save&','192.168.0.100'),(202,'2009-11-19 18:57:08',1,'addon_modules.php','module=point_grouprate&','192.168.0.100'),(203,'2009-11-19 18:57:14',1,'addon_modules.php','module=point_productsrate&','192.168.0.100'),(204,'2009-11-19 18:57:27',1,'addon_modules.php','module=point_productsrate&action=install&','192.168.0.100'),(205,'2009-11-19 18:57:28',1,'addon_modules.php','module=point_productsrate&action=edit&','192.168.0.100'),(206,'2009-11-19 18:57:36',1,'addon_modules.php','module=point_productsrate&action=save&','192.168.0.100'),(207,'2009-11-19 18:57:36',1,'addon_modules.php','module=point_productsrate&','192.168.0.100'),(208,'2009-11-19 19:01:57',1,'addon_modules_admin.php','module=addon_modules/blocks&','192.168.0.100'),(209,'2009-11-19 19:06:57',1,'alt_nav.php','','192.168.0.100'),(210,'2009-11-19 19:07:02',1,'alt_nav.php','','192.168.0.100'),(211,'2009-11-19 19:07:19',1,'layout_controller.php','','192.168.0.100'),(212,'2009-11-19 19:07:42',1,'layout_controller.php','page=&cID=98&template_dir=sugudeki&layout_page=&','192.168.0.100'),(213,'2009-11-19 19:07:48',1,'layout_controller.php','page=&cID=98&action=edit&template_dir=sugudeki&layout_page=&','192.168.0.100'),(214,'2009-11-19 19:08:13',1,'layout_controller.php','page=&cID=98&action=save&layout_box_name=shopping_cart.php&template_dir=sugudeki&layout_page=&','192.168.0.100'),(215,'2009-11-19 19:08:13',1,'layout_controller.php','page=&cID=98&template_dir=sugudeki&layout_page=&','192.168.0.100'),(216,'2009-11-19 19:08:23',1,'addon_modules_admin.php','module=addon_modules/blocks&','192.168.0.100'),(217,'2009-11-19 19:11:19',1,'addon_modules_admin.php','module=addon_modules/blocks&page=&bID=&action=save_all&','192.168.0.100'),(218,'2009-11-19 19:11:19',1,'addon_modules_admin.php','module=addon_modules/blocks&page=&bID=&','192.168.0.100'),(219,'2009-11-19 19:16:52',1,'layout_controller.php','','192.168.0.100'),(220,'2009-11-19 19:16:53',1,'layout_controller.php','','192.168.0.100'),(221,'2009-11-19 19:16:55',1,'layout_controller.php','','192.168.0.100'),(222,'2009-11-19 19:17:10',1,'layout_controller.php','page=&cID=98&template_dir=sugudeki&layout_page=&','192.168.0.100'),(223,'2009-11-19 19:17:11',1,'layout_controller.php','page=&cID=98&action=edit&template_dir=sugudeki&layout_page=&','192.168.0.100'),(224,'2009-11-19 19:17:26',1,'layout_controller.php','page=&cID=98&action=save&layout_box_name=shopping_cart.php&template_dir=sugudeki&layout_page=&','192.168.0.100'),(225,'2009-11-19 19:17:27',1,'layout_controller.php','page=&cID=98&template_dir=sugudeki&layout_page=&','192.168.0.100'),(226,'2009-11-19 19:36:45',1,'addon_modules.php','','192.168.0.115'),(227,'2009-11-19 19:37:29',1,'addon_modules.php','','192.168.0.115'),(228,'2009-11-19 19:37:33',1,'addon_modules.php','module=shopping_cart_summary&','192.168.0.115'),(229,'2009-11-19 19:37:35',1,'addon_modules.php','module=shopping_cart_summary&action=install&','192.168.0.115'),(230,'2009-11-19 19:37:35',1,'addon_modules.php','module=shopping_cart_summary&action=edit&','192.168.0.115'),(231,'2009-11-19 19:37:38',1,'addon_modules.php','module=shopping_cart_summary&action=save&','192.168.0.115'),(232,'2009-11-19 19:37:38',1,'addon_modules.php','module=shopping_cart_summary&','192.168.0.115'),(233,'2009-11-19 19:37:51',1,'addon_modules_admin.php','module=addon_modules/blocks&','192.168.0.115'),(234,'2009-11-19 19:38:14',1,'addon_modules_admin.php','module=addon_modules/blocks&page=&bID=&action=save_all&','192.168.0.115'),(235,'2009-11-19 19:38:14',1,'addon_modules_admin.php','module=addon_modules/blocks&page=&bID=&','192.168.0.115');
/*!40000 ALTER TABLE `admin_activity_log` ENABLE KEYS */;
UNLOCK TABLES;

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
INSERT INTO `banners` VALUES (1,'Zen Cart','http://www.zen-cart.com','banners/zencart_468_60_02.gif','Wide-Banners','',0,NULL,NULL,'2004-01-11 20:59:12',NULL,1,1,1,0),(2,'Zen Cart the art of e-commerce','http://www.zen-cart.com','banners/125zen_logo.gif','SideBox-Banners','',0,NULL,NULL,'2004-01-11 20:59:12',NULL,1,1,1,0),(3,'Zen Cart the art of e-commerce','http://www.zen-cart.com','banners/125x125_zen_logo.gif','SideBox-Banners','',0,NULL,NULL,'2004-01-11 20:59:12',NULL,1,1,1,0),(4,'if you have to think ... you haven\'t been Zenned!','http://www.zen-cart.com','banners/think_anim.gif','Wide-Banners','',0,NULL,NULL,'2004-01-12 20:53:18',NULL,1,1,1,0),(5,'Sashbox.net - the ultimate e-commerce hosting solution','http://www.sashbox.net/zencart/','banners/sashbox_125x50.jpg','BannersAll','',0,NULL,NULL,'2005-05-13 10:53:50',NULL,1,1,1,20),(6,'Zen Cart the art of e-commerce','http://www.zen-cart.com','banners/bw_zen_88wide.gif','BannersAll','',0,NULL,NULL,'2005-05-13 10:54:38',NULL,1,1,1,10),(7,'Sashbox.net - the ultimate e-commerce hosting solution','http://www.sashbox.net/zencart/','banners/sashbox_468x60.jpg','Wide-Banners','',0,NULL,NULL,'2005-05-13 10:55:11',NULL,1,1,1,0),(8,'Start Accepting Credit Cards For Your Business Today!','http://www.zen-cart.com/modules/freecontent/index.php?id=29','banners/cardsvcs_468x60.gif','Wide-Banners','',0,NULL,NULL,'2006-03-13 11:02:43',NULL,1,1,1,0);
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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `banners_history`
--

LOCK TABLES `banners_history` WRITE;
/*!40000 ALTER TABLE `banners_history` DISABLE KEYS */;
INSERT INTO `banners_history` VALUES (1,6,29,0,'2009-11-19 12:50:05'),(2,5,29,0,'2009-11-19 12:50:05');
/*!40000 ALTER TABLE `banners_history` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=MyISAM AUTO_INCREMENT=180 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `blocks`
--

LOCK TABLES `blocks` WRITE;
/*!40000 ALTER TABLE `blocks` DISABLE KEYS */;
INSERT INTO `blocks` VALUES (1,'sideboxes','banner_box.php','classic',0,'',0,0,''),(2,'sideboxes','banner_box2.php','classic',0,'',0,0,''),(3,'sideboxes','banner_box_all.php','classic',0,'',0,0,''),(4,'sideboxes','best_sellers.php','classic',0,'',0,0,''),(5,'sideboxes','categories.php','classic',0,'',0,0,''),(6,'sideboxes','currencies.php','classic',0,'',0,0,''),(7,'sideboxes','document_categories.php','classic',0,'',0,0,''),(8,'sideboxes','ezpages.php','classic',0,'',0,0,''),(9,'sideboxes','featured.php','classic',0,'',0,0,''),(10,'sideboxes','information.php','classic',0,'',0,0,''),(11,'sideboxes','languages.php','classic',0,'',0,0,''),(12,'sideboxes','manufacturer_info.php','classic',0,'',0,0,''),(13,'sideboxes','manufacturers.php','classic',0,'',0,0,''),(14,'sideboxes','more_information.php','classic',0,'',0,0,''),(15,'sideboxes','music_genres.php','classic',0,'',0,0,''),(16,'sideboxes','order_history.php','classic',0,'',0,0,''),(17,'sideboxes','product_notifications.php','classic',0,'',0,0,''),(18,'sideboxes','record_companies.php','classic',0,'',0,0,''),(19,'sideboxes','reviews.php','classic',0,'',0,0,''),(20,'sideboxes','search.php','classic',0,'',0,0,''),(21,'sideboxes','search_header.php','classic',0,'',0,0,''),(22,'sideboxes','shopping_cart.php','classic',0,'',0,0,''),(23,'sideboxes','specials.php','classic',0,'',0,0,''),(24,'sideboxes','tell_a_friend.php','classic',0,'',0,0,''),(25,'sideboxes','whats_new.php','classic',0,'',0,0,''),(26,'sideboxes','whos_online.php','classic',0,'',0,0,''),(28,'globalnavi','block','classic',0,'',0,0,''),(29,'sideboxes','banner_box.php','addon_modules',0,'',0,0,''),(30,'sideboxes','banner_box2.php','addon_modules',0,'',0,0,''),(31,'sideboxes','banner_box_all.php','addon_modules',0,'',0,0,''),(32,'sideboxes','best_sellers.php','addon_modules',0,'',0,0,''),(33,'sideboxes','categories.php','addon_modules',0,'',0,0,''),(34,'sideboxes','currencies.php','addon_modules',0,'',0,0,''),(35,'sideboxes','document_categories.php','addon_modules',0,'',0,0,''),(36,'sideboxes','ezpages.php','addon_modules',0,'',0,0,''),(37,'sideboxes','featured.php','addon_modules',0,'',0,0,''),(38,'sideboxes','information.php','addon_modules',0,'',0,0,''),(39,'sideboxes','languages.php','addon_modules',0,'',0,0,''),(40,'sideboxes','manufacturer_info.php','addon_modules',0,'',0,0,''),(41,'sideboxes','manufacturers.php','addon_modules',0,'',0,0,''),(42,'sideboxes','more_information.php','addon_modules',0,'',0,0,''),(43,'sideboxes','music_genres.php','addon_modules',0,'',0,0,''),(44,'sideboxes','order_history.php','addon_modules',0,'',0,0,''),(45,'sideboxes','product_notifications.php','addon_modules',0,'',0,0,''),(46,'sideboxes','record_companies.php','addon_modules',0,'',0,0,''),(47,'sideboxes','reviews.php','addon_modules',0,'',0,0,''),(48,'sideboxes','search.php','addon_modules',0,'',0,0,''),(49,'sideboxes','search_header.php','addon_modules',0,'',0,0,''),(50,'sideboxes','shopping_cart.php','addon_modules',0,'',0,0,''),(51,'sideboxes','specials.php','addon_modules',0,'',0,0,''),(52,'sideboxes','tell_a_friend.php','addon_modules',0,'',0,0,''),(53,'sideboxes','whats_new.php','addon_modules',0,'',0,0,''),(54,'sideboxes','whos_online.php','addon_modules',0,'',0,0,''),(55,'globalnavi','block','addon_modules',0,'',0,0,''),(70,'carousel_ui','block_featured_products','addon_modules',0,'',0,0,''),(71,'carousel_ui','block_specials_products','addon_modules',0,'',0,0,''),(72,'carousel_ui','block_also_purchased_products','addon_modules',0,'',0,0,''),(73,'carousel_ui','block_xsell_products','addon_modules',0,'',0,0,''),(61,'multiple_image_view','block','addon_modules',0,'',0,1,'product_free_shipping_info\nproduct_info\nproduct_music_info'),(62,'multiple_image_view','block_expd','addon_modules',0,'',0,0,''),(63,'multiple_image_view','block_thmb','addon_modules',0,'',0,0,''),(81,'search_more','block_sort','addon_modules',0,'',0,0,''),(80,'search_more','block_par_page','addon_modules',0,'',0,0,''),(69,'carousel_ui','block_new_products','addon_modules',0,'',0,0,''),(79,'search_more','block_search_form','addon_modules',0,'',0,0,''),(78,'search_more','block','addon_modules',0,'',0,0,''),(82,'sideboxes','banner_box.php','accessible_and_usable',0,'',0,0,''),(83,'sideboxes','banner_box2.php','accessible_and_usable',0,'',0,0,''),(84,'sideboxes','banner_box_all.php','accessible_and_usable',0,'',0,0,''),(85,'sideboxes','best_sellers.php','accessible_and_usable',0,'',0,0,''),(86,'sideboxes','categories.php','accessible_and_usable',0,'',0,0,''),(87,'sideboxes','currencies.php','accessible_and_usable',0,'',0,0,''),(88,'sideboxes','document_categories.php','accessible_and_usable',0,'',0,0,''),(89,'sideboxes','ezpages.php','accessible_and_usable',0,'',0,0,''),(90,'sideboxes','featured.php','accessible_and_usable',0,'',0,0,''),(91,'sideboxes','information.php','accessible_and_usable',0,'',0,0,''),(92,'sideboxes','languages.php','accessible_and_usable',0,'',0,0,''),(93,'sideboxes','manufacturer_info.php','accessible_and_usable',0,'',0,0,''),(94,'sideboxes','manufacturers.php','accessible_and_usable',0,'',0,0,''),(95,'sideboxes','more_information.php','accessible_and_usable',0,'',0,0,''),(96,'sideboxes','music_genres.php','accessible_and_usable',0,'',0,0,''),(97,'sideboxes','order_history.php','accessible_and_usable',0,'',0,0,''),(98,'sideboxes','product_notifications.php','accessible_and_usable',0,'',0,0,''),(99,'sideboxes','record_companies.php','accessible_and_usable',0,'',0,0,''),(100,'sideboxes','reviews.php','accessible_and_usable',0,'',0,0,''),(101,'sideboxes','search.php','accessible_and_usable',0,'',0,0,''),(102,'sideboxes','search_header.php','accessible_and_usable',0,'',0,0,''),(103,'sideboxes','shopping_cart.php','accessible_and_usable',0,'',0,0,''),(104,'sideboxes','specials.php','accessible_and_usable',0,'',0,0,''),(105,'sideboxes','tell_a_friend.php','accessible_and_usable',0,'',0,0,''),(106,'sideboxes','whats_new.php','accessible_and_usable',0,'',0,0,''),(107,'sideboxes','whos_online.php','accessible_and_usable',0,'',0,0,''),(108,'carousel_ui','block_new_products','accessible_and_usable',0,'',0,0,''),(109,'carousel_ui','block_featured_products','accessible_and_usable',0,'',0,0,''),(110,'carousel_ui','block_specials_products','accessible_and_usable',0,'',0,0,''),(111,'carousel_ui','block_also_purchased_products','accessible_and_usable',0,'',0,0,''),(112,'carousel_ui','block_xsell_products','accessible_and_usable',0,'',0,0,''),(113,'globalnavi','block','accessible_and_usable',0,'',0,0,''),(114,'multiple_image_view','block','accessible_and_usable',0,'',0,0,''),(115,'multiple_image_view','block_expd','accessible_and_usable',0,'',0,0,''),(116,'multiple_image_view','block_thmb','accessible_and_usable',0,'',0,0,''),(117,'search_more','block','accessible_and_usable',1,'main_bottom',0,0,''),(118,'search_more','block_search_form','accessible_and_usable',0,'',0,0,''),(119,'search_more','block_par_page','accessible_and_usable',0,'',0,0,''),(120,'search_more','block_sort','accessible_and_usable',0,'',0,0,''),(121,'sideboxes','banner_box.php','sugudeki',0,'',0,0,''),(122,'sideboxes','banner_box2.php','sugudeki',0,'',0,0,''),(123,'sideboxes','banner_box_all.php','sugudeki',1,'sidebar_left',2,0,'checkout_confirmation\ncheckout_payment\ncheckout_payment_address\ncheckout_shipping\ncheckout_shipping_address\ncheckout_success\ncreate_account\ncreate_account_success\nlogin\nlogoff\npassword_forgotten\nshopping_cart\nvisitors#page_create_visitor\nvisitors#page_visitor_edit\nvisitors#page_visitor_to_account'),(124,'sideboxes','best_sellers.php','sugudeki',1,'sidebar_right',0,1,'index'),(125,'sideboxes','categories.php','sugudeki',0,'',0,0,''),(126,'sideboxes','currencies.php','sugudeki',0,'',0,0,''),(127,'sideboxes','document_categories.php','sugudeki',0,'',0,0,''),(128,'sideboxes','ezpages.php','sugudeki',0,'',0,0,''),(129,'sideboxes','featured.php','sugudeki',0,'',0,0,''),(130,'sideboxes','information.php','sugudeki',0,'',0,0,''),(131,'sideboxes','languages.php','sugudeki',0,'',0,0,''),(132,'sideboxes','manufacturer_info.php','sugudeki',0,'',0,0,''),(133,'sideboxes','manufacturers.php','sugudeki',0,'',0,0,''),(134,'sideboxes','more_information.php','sugudeki',0,'',0,0,''),(135,'sideboxes','music_genres.php','sugudeki',0,'',0,0,''),(136,'sideboxes','order_history.php','sugudeki',0,'',0,0,''),(137,'sideboxes','product_notifications.php','sugudeki',0,'',0,0,''),(138,'sideboxes','record_companies.php','sugudeki',0,'',0,0,''),(139,'sideboxes','reviews.php','sugudeki',1,'main_bottom',0,1,'product_info'),(140,'sideboxes','search.php','sugudeki',1,'header',0,0,''),(141,'sideboxes','search_header.php','sugudeki',0,'',0,0,''),(142,'sideboxes','shopping_cart.php','sugudeki',0,'',1,0,''),(143,'sideboxes','specials.php','sugudeki',0,'',0,0,''),(144,'sideboxes','tell_a_friend.php','sugudeki',0,'',0,0,''),(145,'sideboxes','whats_new.php','sugudeki',0,'',0,0,''),(146,'sideboxes','whos_online.php','sugudeki',0,'',0,0,''),(147,'aboutbox','block','sugudeki',1,'footer',1,0,''),(148,'ajax_category_tree','block','sugudeki',1,'sidebar_left',0,0,'checkout_confirmation\ncheckout_payment\ncheckout_payment_address\ncheckout_shipping\ncheckout_shipping_address\ncheckout_success\ncreate_account\ncreate_account_success\nlogin\nlogoff\npassword_forgotten\nshopping_cart\nvisitors#page_create_visitor\nvisitors#page_visitor_edit\nvisitors#page_visitor_to_account'),(149,'calendar','block','sugudeki',0,'',0,0,''),(150,'calendar','block_desired_delivery_date','sugudeki',0,'',0,0,''),(151,'calendar','block_desired_delivery_time','sugudeki',0,'',0,0,''),(152,'calendar','block_delivery_info','sugudeki',0,'',0,0,''),(153,'carousel_ui','block_new_products','sugudeki',0,'',0,0,''),(154,'carousel_ui','block_featured_products','sugudeki',0,'',0,0,''),(155,'carousel_ui','block_specials_products','sugudeki',0,'',0,0,''),(156,'carousel_ui','block_also_purchased_products','sugudeki',1,'main_bottom',1,1,'product_info'),(157,'carousel_ui','block_xsell_products','sugudeki',1,'main_bottom',2,1,'product_info'),(158,'easy_admin','block','sugudeki',0,'',0,0,''),(159,'easy_admin','block_right_top_menu','sugudeki',0,'',0,0,''),(160,'easy_admin','block_dropdown_menu','sugudeki',0,'',0,0,''),(162,'globalnavi','block','sugudeki',0,'',0,0,''),(163,'multiple_image_view','block','sugudeki',0,'',0,0,''),(164,'multiple_image_view','block_expd','sugudeki',0,'',0,0,''),(165,'multiple_image_view','block_thmb','sugudeki',0,'',0,0,''),(166,'search_more','block','sugudeki',0,'',0,0,''),(167,'search_more','block_search_form','sugudeki',0,'',0,0,''),(168,'search_more','block_par_page','sugudeki',0,'',0,0,''),(169,'search_more','block_sort','sugudeki',0,'',0,0,''),(170,'category_sitemap','block','sugudeki',1,'footer',0,0,''),(171,'checkout_step','block','sugudeki',1,'main_top',0,1,'checkout_confirmation\ncheckout_payment\ncheckout_payment_address\ncheckout_shipping\ncheckout_shipping_address\ncheckout_success'),(172,'easy_design','block','sugudeki',0,'',0,0,''),(173,'products_with_attributes_stock','block','sugudeki',0,'',0,0,''),(174,'reviews','block','sugudeki',0,'',0,0,''),(175,'feature_area','block','sugudeki',0,'',0,0,''),(176,'blog','block','sugudeki',0,'',0,0,''),(177,'easy_admin_simplify','block','sugudeki',0,'',0,0,''),(178,'point_base','block','sugudeki',1,'main_bottom',0,1,'account'),(179,'shopping_cart_summary','block','sugudeki',1,'header',2,0,'');
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
INSERT INTO `categories` VALUES (1,'',0,10,'2007-01-15 13:01:41','2007-02-01 17:33:02',1),(2,'',1,0,'2007-01-15 13:01:41','2007-02-01 17:34:46',1),(3,'',0,20,'2007-01-15 13:10:03','2007-02-01 17:33:18',1),(4,'',3,0,'2007-01-15 13:10:03','2007-02-01 17:35:48',1),(5,'',1,0,'2007-01-15 13:10:04','2007-02-01 17:34:55',1),(6,'',0,30,'2007-01-15 13:10:04','2007-02-01 17:33:37',1),(7,'',6,0,'2007-01-15 13:10:04','2007-02-01 17:36:37',1),(8,'',3,0,'2007-01-15 13:10:04','2007-02-01 17:36:05',1),(9,'',3,0,'2007-01-15 13:10:04','2007-02-01 17:35:38',1),(10,'',6,0,'2007-01-15 13:10:04','2007-02-01 17:36:49',1),(11,'',3,0,'2007-01-15 13:10:04','2007-02-01 17:35:56',1),(12,'',3,0,'2007-01-15 13:10:04','2007-02-01 17:35:22',1),(13,'',3,0,'2007-01-15 13:10:04','2007-02-01 17:35:30',1),(14,'',3,0,'2007-01-15 13:10:04','2007-02-01 17:35:14',1),(15,'',1,0,'2007-01-15 13:10:04','2007-02-01 17:34:37',1),(16,'',1,0,'2007-01-15 13:10:04','2007-02-01 17:34:25',1),(17,'',6,0,'2007-01-15 13:10:04','2007-02-01 17:36:28',1),(96,NULL,94,20,'2007-01-26 03:33:54',NULL,1),(27,NULL,25,20,'2007-01-16 00:24:50','2007-01-26 03:31:06',1),(20,'',0,190,'2007-01-15 13:10:05','2007-02-01 17:38:10',1),(21,'',0,100,'2007-01-15 13:15:14','2007-02-01 17:37:40',1),(22,'',0,110,'2007-01-15 13:15:17','2007-02-01 17:37:55',1),(26,NULL,25,10,'2007-01-16 00:24:31','2007-01-26 03:43:46',1),(23,'',0,40,'2007-01-15 14:10:00','2007-02-01 17:37:13',1),(25,NULL,0,9000,'2007-01-16 00:22:56','2007-01-26 03:31:59',1),(29,NULL,26,10,'2007-01-16 00:25:31','2007-01-26 03:34:26',1),(30,NULL,26,20,'2007-01-16 00:25:46','2007-01-26 03:34:33',1),(31,NULL,26,30,'2007-01-16 00:26:06','2007-01-26 03:34:44',1),(94,NULL,25,30,'2007-01-26 03:29:40','2007-01-26 03:45:01',1),(95,NULL,94,10,'2007-01-26 03:32:51','2007-01-26 03:33:32',1),(45,'',84,100,'2007-01-16 19:27:32','2007-01-24 17:11:06',1),(41,'',0,400,'2007-01-16 15:11:23','2007-01-19 01:41:40',1),(40,'categories/category_free.gif',0,300,'2007-01-16 15:03:58','2007-02-01 17:41:21',1),(70,'',66,100,'2007-01-18 14:08:42','2007-01-18 14:40:49',1),(68,'',66,210,'2007-01-18 14:08:42','2007-01-18 14:19:31',1),(69,'',66,220,'2007-01-18 14:08:42','2007-01-18 14:19:51',1),(67,'',66,200,'2007-01-18 14:08:42','2007-01-18 15:28:46',1),(66,'',0,1000,'2007-01-18 14:08:42','2007-01-19 00:29:36',1),(61,'',59,0,'2007-01-17 15:20:31','2007-02-01 17:39:54',1),(62,'',59,0,'2007-01-17 15:20:31','2007-02-01 17:39:08',1),(63,'',59,0,'2007-01-17 15:20:31','2007-02-01 17:39:33',1),(64,NULL,66,10000,'2007-01-17 18:06:48','2007-01-19 00:25:42',1),(60,'',59,0,'2007-01-17 15:20:31','2007-02-01 17:40:03',1),(59,'',0,200,'2007-01-17 15:20:31','2007-02-01 17:38:41',1),(58,NULL,99,10000,'2007-01-16 21:31:45','2007-01-26 18:10:30',1),(71,'',66,700,'2007-01-18 14:08:42','2007-01-19 00:03:55',1),(72,'',66,1000,'2007-01-18 14:11:14','2007-01-19 00:05:31',1),(73,'',66,500,'2007-01-18 14:11:14','2007-01-18 14:18:33',1),(74,'',66,510,'2007-01-18 14:11:14','2007-01-18 14:18:39',1),(75,'',66,520,'2007-01-18 14:13:02','2007-01-18 14:18:46',1),(76,NULL,77,10,'2007-01-18 17:10:12','2007-01-23 00:59:03',1),(77,NULL,0,1200,'2007-01-18 17:40:48','2007-01-26 16:30:14',1),(78,NULL,77,20,'2007-01-18 17:45:38','2007-01-23 23:49:43',1),(79,NULL,0,500,'2007-01-19 01:25:28','2007-02-01 17:40:56',1),(80,NULL,99,3000,'2007-01-21 21:47:15','2007-01-26 18:15:51',1),(81,NULL,99,4000,'2007-01-23 10:24:53','2007-01-26 18:10:49',1),(82,NULL,99,5000,'2007-01-23 11:44:05','2007-01-26 18:12:53',1),(83,NULL,84,200,'2007-01-24 10:06:24','2007-01-25 20:18:56',1),(84,NULL,0,1100,'2007-01-24 10:18:28',NULL,1),(85,NULL,84,300,'2007-01-24 17:09:48','2007-01-24 17:10:44',1),(86,NULL,77,30,'2007-01-24 19:31:55','2007-01-24 20:55:37',1),(87,NULL,0,1300,'2007-01-24 20:02:17','2007-01-26 16:17:44',1),(89,NULL,0,2000,'2007-01-25 20:32:45','2007-01-26 18:17:18',1),(91,NULL,0,7200,'2007-01-26 03:16:19','2007-01-26 18:03:38',1),(99,NULL,0,10000,'2007-01-26 18:10:20',NULL,1),(93,NULL,0,7400,'2007-01-26 03:22:16','2007-01-26 18:04:08',1),(98,NULL,0,7300,'2007-01-26 14:12:54','2007-01-26 18:03:49',1),(97,NULL,0,7500,'2007-01-26 11:30:57','2007-01-26 18:18:53',1),(100,NULL,0,800,'2007-01-26 18:19:30',NULL,1),(101,NULL,59,0,'2007-01-31 01:39:40','2007-02-01 17:39:44',1);
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
INSERT INTO `categories_description` VALUES (1,2,'Ｔシャツ（白）','ホワイトＴシャツ（大人サイズ）です'),(2,2,'ロゴ(白)',''),(3,2,'Ｔシャツ（カラー）','カラーＴシャツ（大人サイズ）です'),(4,2,'ロゴ(カラー)',''),(5,2,'猫シリーズ(白)',''),(6,2,'キッズT','子供向けのＴシャツです。'),(7,2,'かわいいの(for KIDS)',''),(8,2,'猫シリーズ(カラー)',''),(9,2,'ドラゴン(カラー)',''),(10,2,'ドラゴン(for KIDS)',''),(11,2,'犬シリーズ(カラー)',''),(12,2,'アニマル(カラー)',''),(13,2,'イラスト(カラー)',''),(14,2,'アイコン(カラー)',''),(15,2,'イラスト(白)',''),(16,2,'アニマル(白)',''),(17,2,'おさかな(for KIDS)',''),(20,2,'ギフト券','ご家族やお友達、会社の同僚にギフト券を贈りましょう！<br /><br />\r\n\r\nギフト券はショップ内のすべての商品購入に使えます。<br /><br />\r\n\r\nギフト券を購入すると、まず自分のマイページ上にギフト券残高が追加され、この残高の範囲で誰か他の人に引換コードを贈ることができるようになります。'),(21,2,'禅太郎\'s セレクト（リンク商品）','このカテゴリは「リンク商品」のサンプルです。<br />つまり、ここにある商品はすべて他のカテゴリにも登録され、共通の商品情報を参照している状態です。<br /><br />リンク商品の商品情報は、どちらか一方を編集するだけで両方に反映されます。<br /><br />複数のカテゴリにリンクしている商品には、「商品マスターカテゴリ」を指定しておきます。これは例えばセールなど商品カテゴリ毎に価格設定をするような場合に使われます。所属するマスターカテゴリにセール設定すると、その商品が適用対象になります。<br /><br />\r\n\r\n<strong>ONE POINT：ページングについて</strong><br />\r\nこのカテゴリ配下には10以上の商品が入っています。10を超えた分は次のページで表示されます。'),(22,2,'当店オリジナル（非リンク商品）','このカテゴリは、非リンク商品の例です。<br/>\r\n非リンク商品とは、つまり他のどのカテゴリからもリンクされていない（このカテゴリ配下にしか存在しない）商品という意味です。<br /><br />\r\n\r\n<strong>ONE POINT（1）：ページングについて</strong><br />\r\nこのカテゴリ配下には10以上の商品が入っています。10を超えた分は次のページで表示されます。<br /><br />\r\n\r\n<strong>ONE POINT（2）：商品の並び順について</strong><br />\r\n商品が一覧されるときは、商品名のABC、あいうえお順に並びますが、<br />\r\n漢字を含む商品名は期待通りに並んでくれない可能性が高いです。<br /><br />\r\nもし、商品の並び順を明示的に与えたければ、商品情報の「ソート順」に数字をセットします。<br />\r\n同じカテゴリ内で、上から「ソート順」の数字が小さい順に並びます。<br />\r\nセットする数字は10、20、100など飛び飛びでもかまいません。'),(23,2,'オリジナル壁紙','ダウンロード販売商品のサンプルです。'),(25,1,'[1]Category(top level)',''),(25,2,'カテゴリ構成例（[1]第1カテゴリ','これは、カテゴリ構成を理解するためのものです。<br /><br />\r\nここは第1レベルのカテゴリです。<br /><br />\r\n\r\nこのカテゴリは以下のようなツリー構成になっています。<br /><br />\r\n[1]第1カテゴリ<br />\r\n　├[1.1]第2カテゴリ<br />\r\n　│　├[1.1.1]第3カテゴリ<br />\r\n　│　├[1.1.2]第3カテゴリ<br />\r\n　│　└[1.1.3]第3カテゴリ<br />\r\n　├[1.2]第2カテゴリ<br />\r\n　└[1.3]第2カテゴリ(1.3)<br />\r\n　　　├[1.3.1]第3カテゴリ<br />\r\n　　　└[1.3.2]第3カテゴリ'),(95,1,'[1.3.1]Category(level3)',''),(95,2,'[1.3.1]第3カテゴリ','第3レベルのカテゴリです。<br />\r\nこのカテゴリには子カテゴリがなく、これが最下位カテゴリです。<br />\r\n従って配下の商品一覧が表示されます。'),(26,1,'[1.1]Category(level2)',''),(26,2,'[1.1]第2カテゴリ','第2レベルのカテゴリです。<br /><br />\r\n\r\nこのカテゴリには子カテゴリが存在します。<br />\r\n従って、商品一覧ではなく、子カテゴリの一覧を表示します。'),(27,1,'[1.2]Category(level2)',''),(27,2,'[1.2]第2カテゴリ','第2レベルのカテゴリです。<br />\r\nこのカテゴリには子カテゴリがなく、これが最下位カテゴリです。<br />\r\n従って配下の商品一覧が表示されます。'),(96,1,'[1.3.2]Category(level3)',''),(29,1,'[1.1.1]Category(level3)',''),(29,2,'[1.1.1]第3カテゴリ','第3レベルのカテゴリです。<br />\r\nこのカテゴリには子カテゴリがなく、これが最下位カテゴリです。<br />\r\n従って配下の商品一覧が表示されます。'),(30,1,'[1.1.2]Category(level3)',''),(30,2,'[1.1.2]第3カテゴリ','第3レベルのカテゴリです。<br />\r\nこのカテゴリには子カテゴリがなく、これが最下位カテゴリです。<br />\r\n従って配下の商品一覧が表示されます。'),(31,1,'[1.1.3]Category(level3)',''),(31,2,'[1.1.3]第3カテゴリ','第3レベルのカテゴリです。<br />\r\nこのカテゴリには子カテゴリがなく、これが最下位カテゴリです。<br />\r\n従って配下の商品一覧が表示されます。'),(94,1,'[1.3]Category(level2)',''),(94,2,'[1.3]第2カテゴリ','第2レベルのカテゴリです。<br /><br />\r\n\r\nこのカテゴリには子カテゴリが存在します。<br />\r\n従って、商品一覧ではなく、子カテゴリの一覧を表示します。'),(41,2,'お問い合せ商品例','価格お問い合せ商品の例です。<br /><br />\r\n\r\n価格お問い合せに指定した商品では、通常の購入（カゴに入れる）ボタンの代わりに、お問い合せフォームへのリンクが表示されます。<br /><br />顧客と担当者間での個別打ち合わせをはさんで下代を決めたい商品や、事前見積もりが必要なワークフローなどのケースに使います。'),(40,2,'無料サンプル品の例','サンプル商品の提供など価格無料商品の各種設定例です。無料カタログ、プレゼント商品の提供などいろいろな応用シーンが考えられます。<br /><br />\r\n\r\n元の価格を表示しつつ無料化することや、本体価格は無料だが特定のオプション料金は有料とするなど細かい設定が可能です。また、送料も同時に無料にしたり、反対に送料だけ有料とすることも可能です。'),(58,1,'SEO(META, Title..)',''),(58,2,'SEO（METAタグ）設定例','SEO対策の一環として、Zen CartではMETAタグやtitleタグを明示的に設定することができます。<br /><br />\r\n\r\nこのカテゴリに対して、以下のように設定しました。<br />\r\nブラウザの「ソースを表示」で、このページのHTMLソースの<head>〜</head>部分を確認してみてください。<br /><br />\r\n\r\n\r\n【設定メモ：META】<br />\r\n・title：<br />\r\n　　「このカテゴリには明示的にtitleタグを設定しました。」<br /><br />\r\n・META（keyword）：<br />\r\n　　「このカテゴリには明示的にMETA（keyword）を設定しています,キーワード1,キーワード2,キーワード3」<br /><br />\r\n\r\n・META（description）：<br />\r\n　　「このカテゴリには明示的にMETA（description）を設定しています。Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus sit amet velit・・・」<br />'),(45,2,'【基本】商品に対する数量割引設定','ここでは、いわゆるボリュームディスカウントの設定例を集めました。'),(63,2,'DROPDOWNとRADIOタイプ',''),(59,2,'商品オプションの各種タイプ','商品オプション属性の設定例を、オプションのタイプ別に例示します。'),(60,2,'TEXTタイプ',''),(61,2,'READONLYタイプ',''),(62,2,'CHCKBOXタイプ',''),(64,1,'(temporary)',''),(64,2,'※商品オプション活用例説明用','※このカテゴリは、他の機能説明カテゴリ内でセール適用商品を例示するため設けたダミーカテゴリです。<br />\r\n　このカテゴリ自体にはあまり意味がありません。'),(66,2,'セールと特価','このカテゴリは、\r\nZen Cartが持つさまざまな割引機能の中でメイン機能ともいえる「特価」と「セール」について理解を深めるためのサンプル集です。<br /><br />\r\n\r\n\r\n<strong>NOTE：</strong> 特価とセールの違い<br />\r\n特価は、商品単位で設定可能な割引機能です。<br />\r\nそれに対してセールは、カテゴリ単位で設定可能な割引機能です。<br />\r\nこの2つは両方組み合わせて適用することも、どちらかを優先させることも可能です。<br /><br /><br />\r\n\r\n<strong>NOTE：</strong><br />\r\n以下の各カテゴリには全く同じ商品が3点ずつ収められており、違いはカテゴリに対するセール設定だけとしています。<br />\r\n異なるカテゴリの同じ商品同士を見比べると、セール設定によるふるまいの違いが理解しやすいと思います。<br /><br />\r\n\r\n★以下の3カテゴリには同じ設定の商品が3点ずつ入っています<br />\r\n　・セール：10％OFF<br />\r\n　・セール：10％OFF<br />\r\n　・セール：1万円を8000円に<br /><br />\r\n\r\n★以下の3カテゴリには同じ設定の特価適用商品が3点ずつ入っています<br />\r\n　・セール×特価：両方適用<br />\r\n　・セール×特価：セール優先<br />\r\n　・セール×特価：特価優先<br /><br /><br />\r\n\r\n---------\r\nなお、<br />\r\n「※商品オプション活用例説明用」カテゴリは<br />\r\n　他の機能説明カテゴリ内でセール適用商品を例示するため設けたダミーカテゴリです。<br />\r\n　このカテゴリ自体にはあまり意味がありません。'),(67,2,'セール：10％OFF','セール機能を理解するための、ごくシンプルな例です。\r\nこのカテゴリに対して、10％引きのセール設定がされており、\r\nこのカテゴリをマスターカテゴリとする全商品に適用されます。'),(68,2,'セール：500円OFF','セール機能を理解するための、ごくシンプルな例です。\r\nこのカテゴリに対して、500円引きのセール設定がされており、\r\nこのカテゴリをマスターカテゴリとする全商品に適用されます。'),(69,2,'セール：1万円を8000円に','セール機能を理解するための、ごくシンプルな例です。\r\nこのカテゴリに対して、8000円（新しい価格）にするセール設定がされており、\r\nこのカテゴリをマスターカテゴリとする全商品に適用されます。'),(70,2,'特価設定例','商品単位で特価価格を設定することができます。<br />\r\nこのカテゴリでは特価機能の基本例を収めています。'),(71,2,'セール関連etc',''),(72,2,'セール対象外カテゴリ','このカテゴリは「商品マスターカテゴリ」を理解するためのサンプルです。<br />\r\n複数のカテゴリにリンクされた商品の場合、商品マスターカテゴリのセール設定が適用されます。<br /><br />\r\n\r\nこのカテゴリにはセールの設定をしていません。<br />\r\nこのカテゴリ配下には、共に複数のカテゴリにリンクされた商品が2つ入っています。<br /><br />\r\n\r\n1つは、このカテゴリが商品マスターカテゴリなのでセールは適用されません。<br />\r\nしかし、もう一方の商品は、セール適用カテゴリ「10％OFF」を商品マスターカテゴリとしているため、\r\n（このカテゴリがセール対象でないにもかかわらず）10％OFFになります。'),(73,2,'セール×特価：両方適用',''),(74,2,'セール×特価：セール優先',''),(75,2,'セール×特価：特価優先',''),(76,1,'Qty Min',''),(76,2,'最小購入数：ご購入は●個から！','最小購入数を使えば<br />\r\n「ご購入は10個からとさせていただきます」といったケースに対応できます。'),(78,1,'Qty Max',''),(78,2,'最大購入数：お一人さま●点まで！','最大購入数の設定により\r\n「お一人さま1点まで」のように一度の購入に買える数を制限することができます。'),(77,1,'Qty Min,Mix, Units',''),(77,2,'購入単位や最小/大購入数の制限','Zen Cartでは、最小販売数、最大販売数を制限したり、購入単位の制限（ご購入は5個ずつ）などが可能です。'),(79,1,'Shipping free products',''),(79,2,'送料無料商品例','ここでは配送料無料とする設定例をご紹介します。<br />\r\nダウンロード商品はもちろん、有形の商品を送料サービスにしたい場合に使います。<br /><br />\r\n\r\nなお、<strong>ショップ全体に「ご購入1万円以上で送料無料！」を適用したい</strong>などのケースについては、配送モジュール設定の範疇ですので、ここでは扱いません。'),(80,1,'Product Expected & Out of Stock',''),(80,2,'入荷予定と在庫切れ商品例','このカテゴリには入荷予定商品と在庫切れ商品の例を収めてあります。<br /><br />\r\n\r\n<strong>【入荷予定商品】</strong>\r\n商品情報の「提供可能日」に未来の日付を入力すると入荷予定商品として扱われます。<br /><br />\r\n\r\n・入荷予定商品の場合、ユーザは商品情報の閲覧ができ、注文も可能です。<br />\r\n・入荷予定商品は、管理メニューの商品の管理＞入荷予定商品の管理 で一覧表示され一括管理することができます。<br /><br />\r\n\r\n\r\n<strong>【在庫切れ商品】</strong>\r\n在庫数が0になると、その商品には在庫切れ商品のアイコンが表示されます。<br /><br />\r\n\r\n・在庫切れ商品は、ユーザは商品情報の閲覧はできますが、注文はできません。<br />\r\n・在庫が0になったときのふるまい（在庫切れアイコンを表示させるかどうか等）は、管理サイトの一般設定＞在庫の管理から制御可能です。以下のような設定ができます。<br />\r\n　　・在庫がなくなった商品に、「カートに入れる」ボタンの<br />\r\n　　　代わりに「売り切れ」アイコンを表示する/しない<br />\r\n　　・在庫切れ商品を注文できる/できない<br />\r\n　　・在庫切れ商品のステータス変更：<br />\r\n　　　在庫がなくなったら商品ステータスをOFFにして、<br />\r\n　　　ショップ上への掲載を自動で取りやめる/やめない<br />\r\n　　・在庫数をチェックして水準以下になったら運営者に<br />\r\n　　　メールで知らせる/知らせない'),(81,1,'Consumption Tax',''),(81,2,'消費税の扱い','消費税の扱いは2通り考えられます。<br />\r\nどちらも方法でも表示価格は同じように税込み価格で表示されますが、運営側内部で商品価格を内税/外税のどちらで管理するかが異なります。<br /><br />\r\n（1）外税で管理する：<br />\r\n　　商品価格には消費税分を含めない価格を入力します。<br />\r\n　　商品価格(グロス)には自動計算された税込み価格が入り、表示価格にはこれが表示されます。<br />\r\n　　消費税率が変更された場合は、管理サイトから税率を変えるだけで、対象商品全てに反映されます。<br /><br />\r\n（2）内税で管理する：<br />\r\n　　商品価格(グロス)に消費税分を含めた価格を入力して税区分を「消費税」とするか、税区分を「なし」にして商品価格に内税価格を直接入力するの2方法あります。<br />\r\n　　表示価格は、内税が表示されます。<br />\r\n　　もともとショップ内の基本台帳が税込み価格で管理されている場合はこちらを使います。<br />\r\n　　税込みの表示価格をキッカリ9800円にしたいなどの場合は内税で管理する方がわかりやすいです。<br />\r\n　　ただし、税区分を「なし」で設定した場合は、税率が変われば対象商品すべてを見直す必要があります'),(82,1,'Add Images',''),(82,2,'説明欄に追加の画像を掲載する方法','商品説明欄に、メイン画像以外の商品画像を掲載する方法を説明しています。<br />\r\n実現方法は、（1）自動表示する方法と（2）説明欄にHTML直書きして表示させる（手動）の2タイプあります。<br /><br />\r\n\r\n機能としては別モノですが、<br />\r\n商品オプションごとに画像を掲載する方法についても併せて掲載しておきます。'),(83,1,'Qty Discounts by Attributes',''),(83,2,'オプションに対する数量割引','Zen Cartでボリュームディスカウントを実現するもう一つの方法として、商品のオプション属性ごとのボリュームディスカウント設定方法があります。<br /><br />\r\n\r\n商品オプションごとの設定をすると、<br />\r\n同じTシャツ商品に対して、レッド選択時は10個以上で100円引きだけど、イエローだったら5個以上で200円引き・・といったことが実現できます。'),(84,1,'Qty Discounts','Discount Quantities can be set for Products or on the individual attributes.<br />\r\nDiscounts on the Product do NOT reflect on the attributes price.<br />\r\nOnly discounts based on Special and Sale Prices are applied to attribute prices.'),(84,2,'ボリュームディスカウント例','数量割引（ボリュームディスカウント）の設定例を集めたカテゴリです。<br /><br />\r\n\r\nZen Cartのボリュームディスカウント機能は2方法あり、設定対象や実現できることが異なります。<br /><br />\r\n\r\n（1）その商品に対して数量割引を行う方法<br />\r\n　　　数量割引の基本機能です。<br />\r\n　　　[商品価格の管理(Price Manager)]から設定します。<br /><br />\r\n\r\n（2）その商品のオプション属性に対して数量割引を行う方法<br />\r\n　　　オプション属性ごとに異なる数量割引設定が可能です。<br />\r\n<br />\r\n　　　[商品オプション属性]から設定します。<br />'),(85,1,'OneTime Discount',''),(85,2,'ワンタイム割引','オプション属性のワンタイム割引機能についての説明カテゴリです。<br />\r\n最初の1点目だけ500円割り引くといった使い方をします。<br />\"割引\"とネーミングされていますが、使い方次第で何個買っても1回だけかかる「基本料金（つまり割増）」としても使えます。'),(86,1,'Qty Unit',''),(86,2,'商品の数量単位：●個単位でご注文','ユニット単位で販売したい場合は、[商品の数量単位]を設定します。<br /><br />\r\n[商品の最小数量]や[商品の最大数量]の設定を組み合わせれば、<br />「1000個以上、200個単位でご注文ください。注文可能な最大数は5000個までです」<br />\r\nのような販売が可能になります。<br /><br />'),(87,1,'Price-factor, Offset',''),(87,2,'プライスファクターとオフセット','商品オプション属性の中でも、わかりづらいと悪評高い？！[プライスファクター]、[オフセット]などについて説明します。'),(89,1,'Base/Product/Option Price',''),(89,2,'ベース価格、商品価格、オプション','<strong>ベース価格、商品価格、オプション価格の関係</strong><br /><br />\r\n\r\nZen Cartでは、「ベース価格」という言い方があちこちに出てきますが、これは管理画面で入力した「商品価格」や「オプション価格」とどう違うのでしょうか？<br /><br />\r\n\r\nベース価格は、特価やセールなどの値引き計算や、プライスファクターを適用する際の基準額として使われます。商品名直下に表示される価格（ここでは表示価格と呼んでおきます）もこのベース価格が表示されます。<br /><br />\r\n\r\nあるオプションを選択した場合のベース価格は、<br /><br />\r\n\r\n　<strong>基本的には・・・<br />\r\n　[ベース価格]＝[商品価格]＋[（そのオプションの）オプション価格]</strong><br />\r\n\r\nです。<br />\r\nただし、以下の2つのフラグの状態によってオプション価格をベース価格に含めない場合があります。逆に言えばそのオプションに対してどう値付けをしたいかによってこのフラグを制御するわけです。\r\n<ul>\r\n <li>[商品属性による価格]フラグ　※商品情報の設定（1商品全体に影響する）</li>\r\n <li>[属性による価格増減をベース価格に含める]フラグ　※オプション属性ごとの設定（そのオプションだけに影響する）</li>\r\n</ul>\r\nフラグとベース価格の関係を表にすると・・・<br /><br />\r\n\r\n<table border=\"1\">\r\n  <tr>\r\n    <th width=\"20%\">[商品属性による価格]</th>\r\n   <td colspan=\"2\" width=\"60%\"><b>\"はい\"</b></td>\r\n   <td width=\"20%\"><b>\"いいえ\"</b></td>\r\n  </tr>\r\n  <tr>\r\n   <th>[属性による価格増減をベース価格に含める]</th>\r\n   <td width=\"40%\"><b>\"はい\"</b></td>\r\n   <td width=\"20%\">\"いいえ\"</td>\r\n   <td>−</td>\r\n  </tr>\r\n  <tr>\r\n   <th>[ベース価格]</th>\r\n   <td style=\"background:#E6E68A;\">＝[商品価格]＋[オプション価格]</td>\r\n   <td colspan=\"2\" style=\"background:#E6E68A;\">＝[商品価格]</td>\r\n  </tr>\r\n  <tr>\r\n   <th>表示価格の対象？</th>\r\n   <td style=\"background:#E6E68A;\">YES（ベース価格中最小値なら表示される）</td>\r\n   <td colspan=\"2\" style=\"background:#E6E68A;\">表示対象外</td>\r\n  </tr>\r\n</table>\r\n<br />\r\n家の電灯にたとえると、[商品属性による価格]フラグは家全体のブレーカー（これが切れれば全ての電灯が消える）にあたり、[属性による価格増減をベース価格に含める]フラグは各部屋のスイッチにあたります。'),(91,1,'Product - Music',''),(91,2,'特別な製品タイプ：Music',''),(99,1,'Tips',''),(93,1,'Document Type',''),(93,2,'特別な製品タイプ：Document','商品タイプがドキュメントのカテゴリは、第1レベルでないとうまく動かないようです。'),(96,2,'[1.3.2]第3カテゴリ','第3レベルのカテゴリです。<br />\r\nこのカテゴリには子カテゴリがなく、これが最下位カテゴリです。<br />\r\n従って配下の商品一覧が表示されます。'),(98,2,'特別な製品タイプ：Free Shipping',''),(98,1,'Product - Free Shipping',''),(97,1,'Mixed Product Types','This is a category with mixed product types. This includes both products and documents. There are two types of documents - Documents that are for reading and Documents that are for reading and purchasing.'),(97,2,'さまざまな製品タイプを含む例','カテゴリに対する[商品タイプの制限]をしないか、あるいは扱いたい製品タイプを複数登録しておけば、そのカテゴリに異なる製品タイプを混在させることができます。'),(99,2,'その他のTips',''),(100,1,'Download Files',''),(100,2,'ダウンロード商品',''),(101,1,'FILE type',''),(101,2,'FILEタイプ','このオプションタイプにすると、アップロード用のファイル選択欄が表示されます。'),(1,1,'T-shirts(white)','T-shirts(white)'),(2,1,'Logo T(white)',''),(3,1,'T-shirts(color)','T-shirts(color)'),(4,1,'Logo T(color)',''),(5,1,'Cat T(white)',''),(6,1,'T-shirts for kids','T-shirts for kids'),(7,1,'Cute T(for Kids)',''),(8,1,'Cat T(color)',''),(9,1,'Dragon T(color)',''),(10,1,'Dragon T(for Kids)',''),(11,1,'Dog T(color)',''),(12,1,'Animal T(color)',''),(13,1,'Illust. T(color)',''),(14,1,'Icon T(color)',''),(15,1,'Illust. T(white)',''),(16,1,'Animal T(white)',''),(17,1,'Fish T(for Kids)',''),(20,1,'Gift Certificates','Send a Gift Certificate today!<br />\r\nGift Certificates are good for anything in the store.'),(21,1,'Zen\'s selection(Linked products','All of these products are \"Linked Products\".\r\n\r\nThis means that they appear in more than one Category.\r\n\r\nHowever, you only have to maintain the product in one place.\r\n\r\nThe Master Product is used for pricing purposes.'),(22,1,'Shop Original(unlinked products)','shop originals. these are unlinked products.'),(23,1,'wallpapers','wallpapers(download)'),(40,1,'Free products','Free products'),(41,1,'Call Stuff','call staff products'),(45,1,'Qty Discount',''),(59,1,'Option Types','Option Types'),(60,1,'TEXT type',''),(61,1,'READONLY Type',''),(62,1,'CHCKBOX Type',''),(63,1,'DROPDOWN & RADIO Type',''),(66,1,'SALE & Special price','Sale & Special price'),(67,1,'SALE Percent: 10% off','SALE 10% off'),(68,1,'SALE Deduction: 500yen off','Sale Deduction'),(69,1,'SALE New Price: set 8000 yen','Sale New Price'),(70,1,'Special Price','Special Price'),(71,1,'SALE etc..',''),(72,1,'Not SALE',''),(73,1,'SALE x Special',''),(74,1,'SALE x Special: skip special',''),(75,1,'SALE x Special: skip SALE','');
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
) ENGINE=MyISAM AUTO_INCREMENT=652 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `configuration`
--

LOCK TABLES `configuration` WRITE;
/*!40000 ALTER TABLE `configuration` DISABLE KEYS */;
INSERT INTO `configuration` VALUES (1,'ショップ名','STORE_NAME','すぐでき（る）パック デモショップ','ショップ名を設定します。',1,1,NULL,'2009-11-19 12:39:39',NULL,NULL),(2,'ショップオーナー名','STORE_OWNER','すぐでき（る）パック 開発チーム','ショップオーナー名(または運営管理者名)を設定します。',1,2,NULL,'2009-11-19 12:39:39',NULL,NULL),(3,'国','STORE_COUNTRY','107','店舗が存在する国名を入力してください。<strong>注意：変更したら店舗のゾーンの更新を忘れずに行ってください。</strong>',1,6,NULL,'2009-11-19 12:39:39','zen_get_country_name','zen_cfg_pull_down_country_list('),(4,'地域','STORE_ZONE','194','ショップの所在地域(県名)を設定します。',1,7,NULL,'2009-11-19 12:39:39','zen_cfg_get_zone_name','zen_cfg_pull_down_zone_list('),(5,'入荷予定商品のソート順','EXPECTED_PRODUCTS_SORT','desc','入荷予定商品のソート順を設定します。<br /><br />\r\n・asc(昇順)<br />\r\n・desc(降順)',1,8,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'asc\', \'desc\'), '),(6,'入荷予定商品のソート順に用いるフィールド','EXPECTED_PRODUCTS_FIELD','date_expected','入荷予定商品のソート順に使用するフィールドを設定します。<BR>・products_name:品名<BR>・date_expected:予定日',1,9,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'products_name\', \'date_expected\'), '),(7,'表示言語と通貨の連動','USE_DEFAULT_LANGUAGE_CURRENCY','false','表示言語と通貨の変更を連動させるかどうか設定します。<br /><br />true(連動)<br />false(非連動)',1,10,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(8,'表示言語の選択','LANGUAGE_DEFAULT_SELECTOR','Default','ショップのデフォルトの表示言語はショップの初期設定またはユーザーのブラウザ設定のどちらに基づくかを設定します。<br /><br />デフォルト：ショップの初期設定',1,11,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'Default\', \'Browser\'), '),(9,'サーチエンジンフレンドリーなURL表記(開発中)','SEARCH_ENGINE_FRIENDLY_URLS','false','サーチエンジンに拾われやすい、静的HTMLのようなURL表記を行うかどうかを設定します。<br /><br />注意：Googleでは動的URLのクロールが強化されたため、あまり意味はないようです。',6,12,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(10,'商品の追加後にカートを表示','DISPLAY_CART','true','商品をカートに追加した直後にカートの内容を表示するか、または元ページにすぐ戻るかを設定します。<br /><br />\r\n・true (表示)<br />\r\n・false (非表示)',1,14,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(11,'デフォルトの検索演算子','ADVANCED_SEARCH_DEFAULT_OPERATOR','and','デフォルトの検索演算子を設定します。',1,17,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'and\', \'or\'), '),(12,'ショップの住所と電話番号','STORE_NAME_ADDRESS','店舗名\r\n 住所\r\n 国名\r\n 電話番号','ショップ名、国名、住所、電話番号を設定します。',1,18,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_textarea('),(13,'カテゴリ内の商品数を表示','SHOW_COUNTS','true','カテゴリ内の商品数を下位カテゴリも含めてカウント表示するかどうかを設定します。<br /><br />\r\n・true (する)<br />\r\n・false (しない)',1,19,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(14,'税額の小数点位置','TAX_DECIMAL_PLACES','0','税額の小数点以下の桁数を設定します。',1,20,NULL,'2009-11-19 12:39:39',NULL,NULL),(15,'価格を税込みで表示','DISPLAY_PRICE_WITH_TAX','true','価格を税込みで表示するかどうかを設定します。<br /><br />\r\n・true = 価格を税込みで表示<br />\r\n・false = 税額をまとめて表示',1,21,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(16,'価格を税込みで表示 - 管理画面','DISPLAY_PRICE_WITH_TAX_ADMIN','true','管理画面で価格を税込みで表示するかどうかを設定します。<br /><br />\r\n・true = 価格を税込みで表示<br />\r\n・false = 最後に税額を表示',1,21,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(17,'商品にかかる税額の算定基準','STORE_PRODUCT_TAX_BASIS','Shipping','商品にかかる税額を算出する際の基準を設定します。<br /><br />\r\n・Shipping …顧客(商品送付先)の住所<br />\r\n・Billing …顧客の請求先の住所<br />\r\n・Store …ショップの所在地による(送付先・請求先ともショップの所在地域である場合に有効)\r\n',1,21,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'Shipping\', \'Billing\', \'Store\'), '),(18,'送料にかかる税額の算定基準','STORE_SHIPPING_TAX_BASIS','Shipping','送料にかかる税金を算出する際の基準を設定します。<br /><br />\r\n・Shipping …顧客(商品送付先)の住所<br />\r\n・Billing …顧客の請求先の住所<br />\r\n・Store …ショップの所在地による(送付先・請求先ともショップの所在地域である場合に有効)<br />\r\n注意：この設定は配送モジュールによってオーバーライド(上書き設定)が可能です。',1,21,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'Shipping\', \'Billing\', \'Store\'), '),(19,'税金の表示','STORE_TAX_DISPLAY_STATUS','0','合計額が0円でも税金を表示しますか?<br />0= Off<br />1= On',1,21,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), '),(20,'管理画面のタイムアウト設定(秒数)','SESSION_TIMEOUT_ADMIN','3600','管理画面がタイムアウトするまでの秒数を設定します。デフォルトは3600秒＝1時間です。<br />あまり短めに設定すると商品登録中などにタイムアウトしてしまいますので注意。<br />900秒未満を設定すると900秒に自動的に設定されます。',1,40,NULL,'2009-11-19 12:39:39',NULL,NULL),(21,'管理画面のプログラム処理の上限時間設定(秒)\r\n','GLOBAL_SET_TIME_LIMIT','60','管理画面においてなんらかの操作を行った場合の、プログラム処理の強制終了時間を設定します。デフォルトは60秒＝1分。この設定は、プログラム処理時間に問題がある場合などにだけ変更してください。\r\n',1,42,NULL,'2009-11-19 12:39:39',NULL,NULL),(22,'Zen Cart新バージョンの自動チェック(ヘッダで告知するか否か)','SHOW_VERSION_UPDATE_IN_HEADER','true','Zen Cartの新バージョンがリリースされた場合、ヘッダに情報を表示しますか?<br /><br />\r\n注意：この設定をオンにすると、管理者ページの表示が遅くなる場合があります。インターネットに繋がっていないテスト環境などではfalseにしてください。\r\n',1,44,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(23,'ショップのステータス','STORE_STATUS','0','ショップの状態を設定します。<br /><br />\r\n・0＝通常のショップ<br />\r\n・1＝価格表示なしのデモショップ<br />\r\n・2＝価格表示付きのデモショップ\r\n',1,25,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), '),(24,'サーバの稼動時間(アップタイム)','DISPLAY_SERVER_UPTIME','true','サーバの稼働時間を表示するかどうかを設定します。この情報はいくつかのサーバでエラーログとして残ることがあります。<br /><br />true＝表示<br /><br />false＝非表示',1,46,'2003-11-08 20:24:47','0001-01-01 00:00:00','','zen_cfg_select_option(array(\'true\', \'false\'),'),(25,'リンク切れページのチェック','MISSING_PAGE_CHECK','On','Zen Cartがリンク切れページを検知した際に自動的にトップページに転送しますか?<br /><br />\r\n・On = オン<br />\r\n・Off = オフ<br />\r\n・Page Not Found = ページが見つかりません画面へ遷移する<br />\r\n<br />\r\n注意：デバックの際などにはこの機能をオフにするとよいでしょう。',1,48,'2003-11-08 20:24:47','0001-01-01 00:00:00','','zen_cfg_select_option(array(\'On\', \'Off\', \'Page Not Found\'),'),(26,'HTMLエディタ','HTML_EDITOR_PREFERENCE','NONE','メールマガジンや商品説明などで用いるHTML/リッチテキスト用のソフトウェアを設定します。',1,110,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'HTMLAREA\', \'NONE\'),'),(27,'phpBBへのリンクを表示','PHPBB_LINKS_ENABLED','false','Zen Cart上に(インストール済みの)phpBBのフォーラムへのリンクを表示するかどうかを設定します。\r\n',1,120,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),'),(28,'カテゴリ内の商品数を表示 - 管理画面','SHOW_COUNTS_ADMIN','true','カテゴリ内の商品数を下位カテゴリも含めてカウント表示しますか?<br /><br />\r\n・true (する)<br />\r\n・false (しない)',1,130,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(29,'名前の最小文字数','ENTRY_FIRST_NAME_MIN_LENGTH','1','名前の文字数の最小値を設定します。',2,1,NULL,'2009-11-19 12:39:39',NULL,NULL),(30,'姓の最小文字数','ENTRY_LAST_NAME_MIN_LENGTH','1','姓の文字数の最小値を設定します。',2,2,NULL,'2009-11-19 12:39:39',NULL,NULL),(31,'生年月日の最小文字数','ENTRY_DOB_MIN_LENGTH','10','生年月日の文字数の最小値を設定します。',2,3,NULL,'2009-11-19 12:39:39',NULL,NULL),(32,'メールアドレスの最小文字数','ENTRY_EMAIL_ADDRESS_MIN_LENGTH','6','メールアドレスの文字数の最小値を設定します。',2,4,NULL,'2009-11-19 12:39:39',NULL,NULL),(33,'住所の最小文字数','ENTRY_STREET_ADDRESS_MIN_LENGTH','1','番地・マンション・アパート名の最小文字数を設定します。',2,5,NULL,'2009-11-19 12:39:39',NULL,NULL),(34,'会社名の最小文字数','ENTRY_COMPANY_MIN_LENGTH','2','会社名の文字数の最小値を設定します。',2,6,NULL,'2009-11-19 12:39:39',NULL,NULL),(35,'郵便番号の最小文字数','ENTRY_POSTCODE_MIN_LENGTH','4','郵便番号の文字数の最小値を設定します。',2,7,NULL,'2009-11-19 12:39:39',NULL,NULL),(36,'市区町村の最小文字数','ENTRY_CITY_MIN_LENGTH','2','市区町村の文字数の最小値を設定します。',2,8,NULL,'2009-11-19 12:39:39',NULL,NULL),(37,'都道府県名の最小文字数','ENTRY_STATE_MIN_LENGTH','2','都道府県の文字数の最小値を設定します。',2,9,NULL,'2009-11-19 12:39:39',NULL,NULL),(38,'電話番号の最小文字数','ENTRY_TELEPHONE_MIN_LENGTH','3','電話番号の文字数の最小値を設定します。',2,10,NULL,'2009-11-19 12:39:39',NULL,NULL),(39,'パスワードの最小文字数','ENTRY_PASSWORD_MIN_LENGTH','5','パスワードの文字数の最小値を設定します。',2,11,NULL,'2009-11-19 12:39:39',NULL,NULL),(40,'クレジットカード名義の最小文字数','CC_OWNER_MIN_LENGTH','3','クレジットカード所有者名の文字数の最小値を設定します。',2,12,NULL,'2009-11-19 12:39:39',NULL,NULL),(41,'クレジットカード番号の最小文字数','CC_NUMBER_MIN_LENGTH','10','クレジットカード番号の文字数の最小値を設定します。',2,13,NULL,'2009-11-19 12:39:39',NULL,NULL),(42,'クレジットカードCVV番号の最小文字数','CC_CVV_MIN_LENGTH','3','クレジットカードCVV番号の文字数の最小値を設定します。',2,13,NULL,'2009-11-19 12:39:39',NULL,NULL),(43,'レビューの文章の最小文字数','REVIEW_TEXT_MIN_LENGTH','50','レビューの文章の文字数の最小値を設定します。',2,14,NULL,'2009-11-19 12:39:39',NULL,NULL),(44,'ベストセラーの最小表示件数','MIN_DISPLAY_BESTSELLERS','1','ベストセラーとして表示する商品の最小値を設定します。',2,15,NULL,'2009-11-19 12:39:39',NULL,NULL),(45,'「こんな商品も購入しています」の最小表示数','MIN_DISPLAY_ALSO_PURCHASED','1','「この商品を購入した人はこんな商品も購入しています」で表示する商品数の最小値を設定します。',2,16,NULL,'2009-11-19 12:39:39',NULL,NULL),(46,'ニックネームの最小文字数','ENTRY_NICK_MIN_LENGTH','3','ニックネームの文字数の最小値を設定します。',2,1,NULL,'2009-11-19 12:39:39',NULL,NULL),(47,'アドレス帳の最大登録数','MAX_ADDRESS_BOOK_ENTRIES','5','顧客が登録できるアドレス帳の登録数の最大値を設定します。',3,1,NULL,'2009-11-19 12:39:39',NULL,NULL),(48,'管理画面 - 1ページに表示する検索結果の最大数','MAX_DISPLAY_SEARCH_RESULTS','20','管理画面の1ページに表示する検索結果の数の最大値を設定します。',3,2,NULL,'2009-11-19 12:39:39',NULL,NULL),(49,'ページ・リンク数の最大表示数','MAX_DISPLAY_PAGE_LINKS','5','商品リストや購入履歴の一覧表示でページの下などに表示されるページ数・リンク数の最大値を設定します。',3,3,NULL,'2009-11-19 12:39:39',NULL,NULL),(50,'特価商品の最大表示数','MAX_DISPLAY_SPECIAL_PRODUCTS','9','特価商品として表示する商品数の最大値を設定します。',3,4,NULL,'2009-11-19 12:39:39',NULL,NULL),(51,'今月の新着商品の最大表示数','MAX_DISPLAY_NEW_PRODUCTS','9','今月の新着商品数の最大値を設定します。',3,5,NULL,'2009-11-19 12:39:39',NULL,NULL),(52,'入荷予定商品の最大表示数','MAX_DISPLAY_UPCOMING_PRODUCTS','10','入荷予定商品として表示する商品数の最大値を設定します。',3,6,NULL,'2009-11-19 12:39:39',NULL,NULL),(53,'メーカーリスト - スクロールボックスのサイズ/スタイル','MAX_MANUFACTURERS_LIST','3','スクロールボックスに表示されるメーカー数は ?<br />1か0に設定するとドロップダウンリストになります。',3,7,NULL,'2009-11-19 12:39:39',NULL,NULL),(54,'メーカーリスト - 商品の存在を確認','PRODUCTS_MANUFACTURERS_STATUS','1','各メーカーについて、1点以上の商品があり、かつ閲覧可能であるかどうかを確認しますか?<br /><br />注意：この機能がONの場合、商品数やメーカーの数が多いと表示が遅くなります。<br />0= off 1= on',3,7,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), '),(55,'音楽ジャンルリスト - スクロールボックスのサイズ/スタイル','MAX_MUSIC_GENRES_LIST','3','スクロールボックスに表示される音楽ジャンルリストの数を設定します。1か0に設定すると、ドロップダウンリストになります。\r\n',3,7,NULL,'2009-11-19 12:39:39',NULL,NULL),(56,'レコード会社リスト - スクロールボックスのサイズ/スタイル','MAX_RECORD_COMPANY_LIST','3','スクロールボックスに表示されるレコード会社リストの数です。1か0に設定すると、ドロップダウンリストになります。\r\n',3,7,NULL,'2009-11-19 12:39:39',NULL,NULL),(57,'レコード会社名表示の長さ','MAX_DISPLAY_RECORD_COMPANY_NAME_LEN','15','レコード会社名ボックスで表示される名前の長さを設定します。設定より長い名前は省略表示されます。\r\n',3,8,NULL,'2009-11-19 12:39:39',NULL,NULL),(58,'音楽ジャンル名の文字数の長さ','MAX_DISPLAY_MUSIC_GENRES_NAME_LEN','15','音楽ジャンルボックスで表示される名前の長さを設定します。設定より長い名前は省略表示されます。\r\n',3,8,NULL,'2009-11-19 12:39:39',NULL,NULL),(59,'メーカー名の長さ','MAX_DISPLAY_MANUFACTURER_NAME_LEN','15','メーカーリストで表示されるメーカー名の文字数の最大値を設定します。',3,8,NULL,'2009-11-19 12:39:39',NULL,NULL),(60,'新しいレビューの表示数最大値','MAX_DISPLAY_NEW_REVIEWS','6','新しいレビューとして表示される数の最大値を設定します。',3,9,NULL,'2009-11-19 12:39:39',NULL,NULL),(61,'レビューのランダム表示数','MAX_RANDOM_SELECT_REVIEWS','10','ランダムに表示するレビュー数の最大値を設定します。<br /><br />注意：この設定値をXとすると、ランダム表示の対象になるのは、もっとも古いアクティブなレビューから数えてX番目に登録されたアクティブなレビューまでになります。',3,10,NULL,'2009-11-19 12:39:39',NULL,NULL),(62,'新着商品のランダム表示数','MAX_RANDOM_SELECT_NEW','10','ランダムに表示する新着商品数の最大値を設定します。<br /><br />注意：この設定値をXとすると、ランダム表示の対象になるのは、もっとも古いアクティブな新着商品から数えてX番目に登録されたアクティブな新着商品までになります。',3,11,NULL,'2009-11-19 12:39:39',NULL,NULL),(63,'特価商品のランダム表示数','MAX_RANDOM_SELECT_SPECIALS','10','ランダムに表示する特価商品数の最大値を設定します。<br /><br />注意：この設定値をXとすると、ランダム表示の対象になるのは、もっとも古いアクティブな特価商品から数えてX番目に登録されたアクティブな特価商品までになります。',3,12,NULL,'2009-11-19 12:39:39',NULL,NULL),(64,'一行に表示するカテゴリ数','MAX_DISPLAY_CATEGORIES_PER_ROW','3','一行に表示するカテゴリ数を設定します。',3,13,NULL,'2009-11-19 12:39:39',NULL,NULL),(65,'新着商品一覧表示数','MAX_DISPLAY_PRODUCTS_NEW','10','新着商品ページ１ページに表示する商品数の最大値を設定します。',3,14,NULL,'2009-11-19 12:39:39',NULL,NULL),(66,'ベストセラーの最大表示件数','MAX_DISPLAY_BESTSELLERS','10','ベストセラーページ１ページに表示するベストセラー商品数の最大値を設定します。',3,15,NULL,'2009-11-19 12:39:39',NULL,NULL),(67,'「こんな商品も買っています」の最大表示件数','MAX_DISPLAY_ALSO_PURCHASED','6','「こんな商品も買っています」欄に表示する商品数の最大値を設定します。',3,16,NULL,'2009-11-19 12:39:39',NULL,NULL),(68,'顧客の注文履歴ボックスの最大表示数','MAX_DISPLAY_PRODUCTS_IN_ORDER_HISTORY_BOX','6','顧客の注文履歴ボックスに表示する商品数の最大値を設定します。',3,17,NULL,'2009-11-19 12:39:39',NULL,NULL),(69,'注文履歴ページの最大表示件数','MAX_DISPLAY_ORDER_HISTORY','10','顧客の注文履歴ページ１ページに表示する商品数の最大値を設定します。',3,18,NULL,'2009-11-19 12:39:39',NULL,NULL),(70,'顧客管理ページで表示する顧客数の最大値','MAX_DISPLAY_SEARCH_RESULTS_CUSTOMER','20','',3,19,NULL,'2009-11-19 12:39:39',NULL,NULL),(71,'注文管理ページで表示する注文数の最大値','MAX_DISPLAY_SEARCH_RESULTS_ORDERS','20','',3,20,NULL,'2009-11-19 12:39:39',NULL,NULL),(72,'レポートページで表示する商品数の最大値','MAX_DISPLAY_SEARCH_RESULTS_REPORTS','20','',3,21,NULL,'2009-11-19 12:39:39',NULL,NULL),(73,'カテゴリ/商品ページで表示するリスト数','MAX_DISPLAY_RESULTS_CATEGORIES','10','１ページに表示する商品数の最大値を設定します。',3,22,NULL,'2009-11-19 12:39:39',NULL,NULL),(74,'商品リスト - ページあたり最大表示数','MAX_DISPLAY_PRODUCTS_LISTING','10','トップページの商品リスト表示での最大表示数を設定します。',3,30,NULL,'2009-11-19 12:39:39',NULL,NULL),(75,'商品オプション - オプション名とオプション値の表示','MAX_ROW_LISTS_OPTIONS','10','商品オプションページで表示するオプション名/オプション値の最大値を設定します。',3,24,NULL,'2009-11-19 12:39:39',NULL,NULL),(76,'商品オプション - オプション管理画面','MAX_ROW_LISTS_ATTRIBUTES_CONTROLLER','30','オプション管理画面で表示するオプション数の最大値を設定します。',3,25,NULL,'2009-11-19 12:39:39',NULL,NULL),(77,'商品属性- ダウンロード管理ページの表示','MAX_DISPLAY_SEARCH_RESULTS_DOWNLOADS_MANAGER','30','ダウンロード管理画面で、ダウンロード商品の属性の最大表示数を設定します。',3,26,NULL,'2009-11-19 12:39:39',NULL,NULL),(78,'おすすめ商品 - 管理画面でのページあたり表示最大数','MAX_DISPLAY_SEARCH_RESULTS_FEATURED_ADMIN','10','管理画面において、ページあたりのおすすめ商品を最大表示件数を設定します。',3,27,NULL,'2009-11-19 12:39:39',NULL,NULL),(79,'おすすめ商品 - トップページでの最大表示数','MAX_DISPLAY_SEARCH_RESULTS_FEATURED','9','トップページでおすすめ商品を最大何点表示するかを設定します。',3,28,NULL,'2009-11-19 12:39:39',NULL,NULL),(80,'おすすめ商品 - 商品リストでの最大表示数','MAX_DISPLAY_PRODUCTS_FEATURED_PRODUCTS','10','商品リストでおすすめ商品をページあたり最大何点表示するかを設定します。',3,29,NULL,'2009-11-19 12:39:39',NULL,NULL),(81,'おすすめ商品のランダム表示ボックス - 最大表示数','MAX_RANDOM_SELECT_FEATURED_PRODUCTS','10','おすすめ商品のランダム表示ボックスにおいて、最大何点表示するかを設定します。',3,30,NULL,'2009-11-19 12:39:39',NULL,NULL),(82,'特価商品 - トップページでの最大表示点数','MAX_DISPLAY_SPECIAL_PRODUCTS_INDEX','9','トップページで、特価商品を最大何点表示するかを設定します。',3,31,NULL,'2009-11-19 12:39:39',NULL,NULL),(83,'新着商品 - 表示期限','SHOW_NEW_PRODUCTS_LIMIT','0','新着商品の表示期限を設定します。<br />\r\n<br />\r\n・0=全て・降順<br />\r\n・1=当月登録分のみ<br />\r\n・30=登録から30日間<br />\r\n・60=登録から60日間(ほか90、120の設定が可能)',3,40,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'7\', \'14\', \'30\', \'60\', \'90\', \'120\'), '),(84,'商品一覧ページ - ページあたり表示点数','MAX_DISPLAY_PRODUCTS_ALL','10','商品一覧において、ページあたりの最大表示点数を設定します。',3,45,NULL,'2009-11-19 12:39:39',NULL,NULL),(85,'言語サイドボックス -　フラッグ最大表示数','MAX_LANGUAGE_FLAGS_COLUMNS','3','言語サイドボックスにおいて、列あたりのフラッグの最大表示点数を設定します。',3,50,NULL,'2009-11-19 12:39:39',NULL,NULL),(86,'ファイルのアップロードサイズ - 上限','MAX_FILE_UPLOAD_SIZE','2048000','ファイルアップロードの際の上限サイズを設定します。デフォルトは2MB(2,048,000バイト)です。',3,60,NULL,'2009-11-19 12:39:39',NULL,NULL),(87,'アップロードファイルに許可するファイルタイプ','UPLOAD_FILENAME_EXTENSIONS','jpg,jpeg,gif,png,eps,cdr,ai,pdf,tif,tiff,bmp,zip','ユーザーがアップロードするファイルに対して許可するファイルタイプの拡張子を設定します。複数の場合はカンマ(,)で区切り、コロン(.)は含めないでください。<br /><br />設定例: \"jpg,jpeg,gif,png,eps,cdr,ai,pdf,tif,tiff,bmp,zip\"',3,61,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_textarea('),(88,'管理画面の注文リストで表示する注文詳細の最大件数','MAX_DISPLAY_RESULTS_ORDERS_DETAILS_LISTING','0','管理画面の注文リストでの注文詳細の最大表示件数は?<br />0 = 無制限',3,65,NULL,'2009-11-19 12:39:39',NULL,NULL),(89,'管理画面のリストで表示するPayPal IPNの最大件数','MAX_DISPLAY_SEARCH_RESULTS_PAYPAL_IPN','20','管理画面のリストでのPayPal IPNの表示件数は?<br />デフォルトは20です。',3,66,NULL,'2009-11-19 12:39:39',NULL,NULL),(90,'マルチカテゴリマネージャで商品を表示するカラムの最大数','MAX_DISPLAY_PRODUCTS_TO_CATEGORIES_COLUMNS','3','マルチカテゴリマネージャ(Multiple Categories Manager)で商品を表示するカラムの最大数は?<br />3 = デフォルト',3,70,NULL,'2009-11-19 12:39:39',NULL,NULL),(91,'EZページの表示の最大件数','MAX_DISPLAY_SEARCH_RESULTS_EZPAGE','20','EZページの表示の最大件数は?<br />20 = デフォルト',3,71,NULL,'2009-11-19 12:39:39',NULL,NULL),(92,'商品画像(小)の横幅','SMALL_IMAGE_WIDTH','100','小さな画像の横幅(ピクセル)を設定します。',4,1,NULL,'2009-11-19 12:39:39',NULL,NULL),(93,'商品画像(小)の高さ','SMALL_IMAGE_HEIGHT','80','小さな画像の高さ(ピクセル)を設定します。',4,2,NULL,'2009-11-19 12:39:39',NULL,NULL),(94,'ヘッダ画像の横幅 - 管理画面','HEADING_IMAGE_WIDTH','57','管理画面でのヘッダ画像の横幅を設定します。',4,3,NULL,'2009-11-19 12:39:39',NULL,NULL),(95,'ヘッダ画像の高さ - 管理画面','HEADING_IMAGE_HEIGHT','40','管理画面でのヘッダ画像の高さを設定します。',4,4,NULL,'2009-11-19 12:39:39',NULL,NULL),(96,'サブカテゴリ画像の横幅','SUBCATEGORY_IMAGE_WIDTH','100','サブカテゴリ画像の横幅をピクセル数で設定します。',4,5,NULL,'2009-11-19 12:39:39',NULL,NULL),(97,'サブカテゴリ画像の高さ','SUBCATEGORY_IMAGE_HEIGHT','57','サブカテゴリ画像の高さをピクセル数で設定します。',4,6,NULL,'2009-11-19 12:39:39',NULL,NULL),(98,'画像サイズを計算','CONFIG_CALCULATE_IMAGE_SIZE','true','画像サイズを自動的に計算するかどうかを設定します。',4,7,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(99,'画像を必須とする','IMAGE_REQUIRED','true','画像がないことを表示します。(カタログの作成時に有効)',4,8,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(100,'ショッピングカートの中身 - 商品画像の表示オン・オフ','IMAGE_SHOPPING_CART_STATUS','1','ショッピングカートの中身に入っている商品の画像を表示するかどうかを設定します。<br /><br />\r\n・0= off<br />\r\n・1= on',4,9,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), '),(101,'ショッピングカートの中身の画像の横幅','IMAGE_SHOPPING_CART_WIDTH','50','デフォルト = 50',4,10,NULL,'2009-11-19 12:39:39',NULL,NULL),(102,'ショッピングカートの中身の画像の高さ','IMAGE_SHOPPING_CART_HEIGHT','40','デフォルト = 40',4,11,NULL,'2009-11-19 12:39:39',NULL,NULL),(103,'商品情報 - カテゴリアイコン画像の横幅','CATEGORY_ICON_IMAGE_WIDTH','57','商品情報ページでのカテゴリアイコンの横幅(ピクセル数)は?',4,13,NULL,'2009-11-19 12:39:39',NULL,NULL),(104,'商品情報 - カテゴリアイコン画像の高さ','CATEGORY_ICON_IMAGE_HEIGHT','40','商品情報ページでのカテゴリアイコンの高さ(ピクセル数)は?',4,14,NULL,'2009-11-19 12:39:39',NULL,NULL),(105,'商品情報 - 画像の横幅','MEDIUM_IMAGE_WIDTH','150','商品画像の横幅を設定します。',4,20,NULL,'2009-11-19 12:39:39',NULL,NULL),(106,'商品情報 - 画像の高さ','MEDIUM_IMAGE_HEIGHT','120','商品画像の高さを設定します。',4,21,NULL,'2009-11-19 12:39:39',NULL,NULL),(107,'商品情報 - 画像(中)のファイル接尾辞(Suffix)','IMAGE_SUFFIX_MEDIUM','_MED','商品画像のファイル接尾辞を設定します。<br /><br />・デフォルト = _MED',4,22,NULL,'2009-11-19 12:39:39',NULL,NULL),(108,'商品情報 - 画像(大)のファイル接尾辞(Suffix)','IMAGE_SUFFIX_LARGE','_LRG','商品画像のファイル接尾辞を設定します。<br /><br />\r\n・デフォルト = _LRG',4,23,NULL,'2009-11-19 12:39:39',NULL,NULL),(109,'商品情報 - １行に表示する追加画像数','IMAGES_AUTO_ADDED','3','商品情報で１行に表示する追加画像数を設定します。<br /><br />\r\n・デフォルト = 3',4,30,NULL,'2009-11-19 12:39:39',NULL,NULL),(110,'商品リスト - 画像の横幅','IMAGE_PRODUCT_LISTING_WIDTH','100','デフォルト = 100',4,40,NULL,'2009-11-19 12:39:39',NULL,NULL),(111,'商品リスト - 画像の高さ','IMAGE_PRODUCT_LISTING_HEIGHT','80','デフォルト = 80',4,41,NULL,'2009-11-19 12:39:39',NULL,NULL),(112,'新商品リスト - 画像の横幅','IMAGE_PRODUCT_NEW_LISTING_WIDTH','100','デフォルト = 100',4,42,NULL,'2009-11-19 12:39:39',NULL,NULL),(113,'新商品リスト - 画像の高さ','IMAGE_PRODUCT_NEW_LISTING_HEIGHT','80','デフォルト = 80',4,43,NULL,'2009-11-19 12:39:39',NULL,NULL),(114,'新商品 - 画像の横幅','IMAGE_PRODUCT_NEW_WIDTH','100','デフォルト = 100',4,44,NULL,'2009-11-19 12:39:39',NULL,NULL),(115,'新商品 - 画像の高さ','IMAGE_PRODUCT_NEW_HEIGHT','80','デフォルト = 80',4,45,NULL,'2009-11-19 12:39:39',NULL,NULL),(116,'おすすめ商品 -画像の幅','IMAGE_FEATURED_PRODUCTS_LISTING_WIDTH','100','デフォルト = 100',4,46,NULL,'2009-11-19 12:39:39',NULL,NULL),(117,'おすすめ商品 - 画像の高さ','IMAGE_FEATURED_PRODUCTS_LISTING_HEIGHT','80','デフォルト = 80',4,47,NULL,'2009-11-19 12:39:39',NULL,NULL),(118,'全商品一覧 - 画像の幅','IMAGE_PRODUCT_ALL_LISTING_WIDTH','100','デフォルト = 100',4,48,NULL,'2009-11-19 12:39:39',NULL,NULL),(119,'全商品一覧 - 画像の高さ','IMAGE_PRODUCT_ALL_LISTING_HEIGHT','80','デフォルト = 80',4,49,NULL,'2009-11-19 12:39:39',NULL,NULL),(120,'商品画像 - 画像がない場合のNo Image画像','PRODUCTS_IMAGE_NO_IMAGE_STATUS','1','「No Image」画像を自動的に表示するかどうかを設定します。<br /><br />\r\n・0= off<br />\r\n・1= On<br />',4,60,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), '),(121,'商品画像 - No Image画像の指定','PRODUCTS_IMAGE_NO_IMAGE','no_picture.gif','商品画像がない場合に表示するNo Image画像を設定します。<br /><br />Default = no_picture.gif',4,61,NULL,'2009-11-19 12:39:39',NULL,NULL),(122,'商品画像 - 商品・カテゴリでプロポーショナルな画像を使う','PROPORTIONAL_IMAGES_STATUS','1','商品情報・カテゴリでプロポーショナルな画像を使いますか?<br /><br />注意：プロポーショナル画像には高さ・横幅とも\"0\"(ピクセル)を指定しないでください。<br />0= off 1= on',4,75,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), '),(123,'(メール用)敬称表示(Mr. or Ms)','ACCOUNT_GENDER','true','顧客のアカウント作成の際、メール用の敬称(Mr. or Ms) を表示するかどうかを設定します。',5,1,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(124,'生年月日','ACCOUNT_DOB','true','顧客のアカウント作成の際、「生年月日」の欄を表示するかどうかを設定します。<br />注意: 不要な場合はfalseに、必要な場合はtrueを指定してください。',5,2,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(125,'会社名','ACCOUNT_COMPANY','true','顧客のアカウント作成の際、「会社名」を表示するかどうかを設定します。',5,3,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(126,'住所2','ACCOUNT_SUBURB','false','顧客のアカウント作成の際、「住所2」を表示するかどうかを設定します。',5,4,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(127,'都道府県名','ACCOUNT_STATE','true','顧客のアカウント作成の際、「都道府県名」を表示するかどうかを設定します。',5,5,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(128,'都道府県名 - ドロップダウンで表示','ACCOUNT_STATE_DRAW_INITIAL_DROPDOWN','false','「都道府県名」は常にドロップダウン形式で表示しますか?',5,5,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(129,'アカウントのデフォルト国別IDの作成','SHOW_CREATE_ACCOUNT_DEFAULT_COUNTRY','107','アカウントのデフォルト国別IDを設定します。<br />デフォルトは223です。',5,6,NULL,'2009-11-19 12:39:39','zen_get_country_name','zen_cfg_pull_down_country_list_none('),(130,'Fax番号','ACCOUNT_FAX_NUMBER','true','顧客のアカウント作成の際、「Fax番号」を表示するかどうかを設定します。',5,10,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(131,'メールマガジンのチェックボックスの表示','ACCOUNT_NEWSLETTER_STATUS','1','メールマガジンのチェックボックスの表示設定をします。<br />0= 表示オフ<br />1= ボックス表示・チェックなし状態<br />2= ボックス表示・チェックあり状態<br />【注意】デフォルトで「チェックあり」の状態にしておくと、各国のスパム規制法規に抵触する恐れがあります。',5,45,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), '),(132,'デフォルトのメール形式の設定','ACCOUNT_EMAIL_PREFERENCE','0','顧客のデフォルトのメール形式を設定します。<br />0= テキスト形式<br />1= HTML形式',5,46,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), '),(133,'顧客への商品の通知 - ステータス','CUSTOMERS_PRODUCTS_NOTIFICATION_STATUS','1','顧客がチェックアウト後に、商品の通知(product notifications)について尋ねるかどうかを設定します。<br /><br />\r\n・0= 尋ねない<br />\r\n・1= 尋ねる(サイト全体に対して設定されていない場合)<br />\r\n【注意】サイドボックスはこの設定とは別にオフにする必要があります。',5,50,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), '),(134,'商品・価格の閲覧制限','CUSTOMERS_APPROVAL','0','顧客がショップ内で商品や価格を閲覧するのを制限するかどうかを設定します。<br />0= 要ログインなどの制限なし<br />1= ブラウスにはログインが必須<br />2= ログインなしでブラウズ可能だが価格は非表示<br />3= 商品閲覧のみ<br /><br />【注意】オプション「2」は、サーチエンジンのロボットに収集されたくない場合や、ログイン済みの顧客にのみ価格を開示したい場合に有効です。',5,55,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'), '),(135,'顧客の購入オーソライズ','CUSTOMERS_APPROVAL_AUTHORIZATION','0','ショップでの購入に際して、顧客はショップ側に審査・許可される必要があるかどうかを設定します。<br />0= 不要<br />1= 商品の閲覧にも許可が必要<br />2= 商品の閲覧は自由だが価格の閲覧は許可された顧客のみ<br />【注意】オプション「2」はサーチエンジンのロボット除けに用いることもできます。',5,65,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'), '),(136,'顧客のオーソライズ(閲覧制限) - ファイル名','CUSTOMERS_AUTHORIZATION_FILENAME','customers_authorization','顧客のオーソライズ(閲覧制限)に使うファイル名を設定します。拡張子なしで表記してください。<br />デフォルトは\r\n\"customers_authorization\"',5,66,NULL,'2009-11-19 12:39:39',NULL,''),(137,'顧客のオーソライズ(閲覧制限) - ヘッダを隠す','CUSTOMERS_AUTHORIZATION_HEADER_OFF','false','顧客のオーソライズ(閲覧制限) でヘッダを表示するかどうかを設定します。<br /><br />\r\n・true=hide<br />\r\n・false=show',5,67,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(138,'顧客のオーソライズ(閲覧制限) - 左カラムを隠す','CUSTOMERS_AUTHORIZATION_COLUMN_LEFT_OFF','false','顧客のオーソライズ(閲覧制限) で、左カラムを表示するかどうかを設定します。<br /><br />\r\n・true=hide<br />\r\n・false=show',5,68,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(139,'顧客のオーソライズ(閲覧制限) - 右カラムを隠す','CUSTOMERS_AUTHORIZATION_COLUMN_RIGHT_OFF','false','顧客のオーソライズ(閲覧制限)で、右カラムを表示するかどうかを設定します。<br /><br />\r\n・true=hide<br />\r\n・false=show',5,69,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(140,'顧客のオーソライズ(閲覧制限) - フッタを隠す','CUSTOMERS_AUTHORIZATION_FOOTER_OFF','false','顧客のオーソライズ(閲覧制限) で、フッタを表示するかどうかを設定します。<br /><br />\r\n・true=hide<br />\r\n・false=show',5,70,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(141,'顧客のオーソライズ(閲覧制限) - 価格の非表示','CUSTOMERS_AUTHORIZATION_PRICES_OFF','false','顧客のオーソライズで、価格を表示するかどうかを設定します。<br /><br />\r\n・true=hide<br />\r\n・false=show',5,71,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(142,'顧客の紹介(Customers Referral)ステータス','CUSTOMERS_REFERRAL_STATUS','0','顧客の紹介コードについて設定します。<br />0= Off<br />1= 1st Discount Coupon Code used最初のディスカウントクーポンを使用済み<br />2= アカウント作成の際、顧客自身が追加・編集可能<br /><br />注意：顧客の紹介コードがセットされると、管理画面からだけ変更することができます。',5,80,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), '),(143,'インストール済みの支払いモジュール','MODULE_PAYMENT_INSTALLED','cc.php;cod.php','インストールされている支払いモジュールのファイル名のリスト( セミコロン(;)区切り )です。この情報は自動的に更新されますので編集の必要はありません。',6,0,NULL,'2009-11-19 12:39:39',NULL,NULL),(144,'インストール済み注文合計モジュール','MODULE_ORDER_TOTAL_INSTALLED','ot_subtotal.php;ot_shipping.php;ot_coupon.php;ot_tax.php;ot_loworderfee.php;ot_gv.php;ot_subpoint.php;ot_total.php;ot_addpoint.php','インストールされている注文合計モジュールのファイル名のリスト(セミコロン(;)区切り)です。\r\n<br /><br />\r\n【注意】この情報は自動的に更新されますので編集の必要はありません。',6,0,'2009-11-19 18:26:12','2009-11-19 12:39:39',NULL,NULL),(145,'インストール済み配送モジュール','MODULE_SHIPPING_INSTALLED','flat.php','インストールされている配送モジュールのファイル名のリスト(セミコロン(;)区切り)です。この情報は自動的に更新されますので編集の必要はありません。',6,0,NULL,'2009-11-19 12:39:39',NULL,NULL),(146,'代金引換モジュールを有効にする','MODULE_PAYMENT_COD_STATUS','True','代金引換モジュールを有効にするかどうかを設定します。',6,1,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'True\', \'False\'), '),(147,'支払い地域','MODULE_PAYMENT_COD_ZONE','0','地域を選択した場合、選択された地域に対してのみ支払い方法が適用されます。',6,2,NULL,'2009-11-19 12:39:39','zen_get_zone_class_title','zen_cfg_pull_down_zone_classes('),(148,'表示の整列順','MODULE_PAYMENT_COD_SORT_ORDER','0','表示の整列順を設定します。数字が小さいほど上位に表示されます。',6,0,NULL,'2009-11-19 12:39:39',NULL,NULL),(149,'注文ステータスの設定','MODULE_PAYMENT_COD_ORDER_STATUS_ID','0','この支払い方法の場合の注文ステータスを設定します。',6,0,NULL,'2009-11-19 12:39:39','zen_get_order_status_name','zen_cfg_pull_down_order_statuses('),(150,'クレジットカードモジュールを有効にする','MODULE_PAYMENT_CC_STATUS','True','クレジットカードによる支払いを有効にするかどうかを設定します。',6,0,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'True\', \'False\'), '),(151,'クレジットカード番号を分割する','MODULE_PAYMENT_CC_EMAIL','','メールアドレスが入力された場合、クレジットカードの中間の数字をそのアドレスに送信し、残りの外側の番号をデータベースに保存します。',6,0,NULL,'2009-11-19 12:39:39',NULL,NULL),(152,'CVV番号を保存する','MODULE_PAYMENT_CC_COLLECT_CVV','false','CVV番号を収集/保存しますか? 注意：有効にすると、CVV番号はエンコードされた状態でデータベースに保存されます。',6,0,NULL,'2004-01-11 22:55:51',NULL,'zen_cfg_select_option(array(\'True\', \'False\'),'),(153,'クレジットカードナンバーを収集・保存する','MODULE_PAYMENT_CC_STORE_NUMBER','False','クレジットカード番号を収集・保存するかどうかを設定します。<br /><br />\r\n【注意】クレジットカード番号は暗号化なしに保存されます。セキュリティ上の問題に十分注意してください。',6,0,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'True\', \'False\'),'),(154,'表示の整列順','MODULE_PAYMENT_CC_SORT_ORDER','0','表示の整列順を設定します. 数字が小さいほど上位に表示されます。',6,0,NULL,'2009-11-19 12:39:39',NULL,NULL),(155,'支払い地域','MODULE_PAYMENT_CC_ZONE','0','地域を選択した場合、選択された地域にたいしてのみ支払い方法が適用されます。',6,2,NULL,'2009-11-19 12:39:39','zen_get_zone_class_title','zen_cfg_pull_down_zone_classes('),(156,'注文ステータス','MODULE_PAYMENT_CC_ORDER_STATUS_ID','0','この支払い方法の場合の注文ステータスを設定します。',6,0,NULL,'2009-11-19 12:39:39','zen_get_order_status_name','zen_cfg_pull_down_order_statuses('),(157,'定額料金','MODULE_SHIPPING_FLAT_STATUS','True','定額料金による配送を提供するかどうかを設定します。',6,0,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'True\', \'False\'), '),(158,'配送料金','MODULE_SHIPPING_FLAT_COST','5.00','すべての注文に対して適用される配送料金を設定します。',6,0,NULL,'2009-11-19 12:39:39',NULL,NULL),(159,'税種別','MODULE_SHIPPING_FLAT_TAX_CLASS','0','定額料金に適用される税種別を選択します。',6,0,NULL,'2009-11-19 12:39:39','zen_get_tax_class_title','zen_cfg_pull_down_tax_classes('),(160,'税率の計算ベース','MODULE_SHIPPING_FLAT_TAX_BASIS','Shipping','配送料にかかる税金オプションの設定します。<br /><br />\r\n・Shipping - 顧客の送付先住所に基づく<br />\r\n・Billing - 顧客の請求先住所に基づく<br />\r\n・Store - ショップの所在住所に基づく(送付先/請求先がショップ所在地と同じ地域の場合に有効)',6,0,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'Shipping\', \'Billing\', \'Store\'), '),(161,'配送地域','MODULE_SHIPPING_FLAT_ZONE','0','配送地域を選択すると選択された地域のみで利用可能になります。',6,0,NULL,'2009-11-19 12:39:39','zen_get_zone_class_title','zen_cfg_pull_down_zone_classes('),(162,'表示の整列順','MODULE_SHIPPING_FLAT_SORT_ORDER','0','表示の整列順を設定できます。数字が小さいほど上位に表示されます。',6,0,NULL,'2009-11-19 12:39:39',NULL,NULL),(163,'デフォルトの通貨','DEFAULT_CURRENCY','JPY','デフォルトの通貨を設定します。',6,0,NULL,'2009-11-19 12:39:39',NULL,NULL),(164,'デフォルトの言語','DEFAULT_LANGUAGE','ja','デフォルトの言語を設定します。',6,0,NULL,'2009-11-19 12:39:39',NULL,NULL),(165,'新規注文のデフォルトステータス','DEFAULT_ORDERS_STATUS_ID','1','新規の注文を受け付けたときのデフォルトステータスを設定します。',6,0,NULL,'2009-11-19 12:39:39',NULL,NULL),(166,'管理画面で設定キー(configuration_key)を表示','ADMIN_CONFIGURATION_KEY_ON','0','管理画面で設定キー(configuration_key)を表示しますか?<br />\r\n表示したい場合は1に設定してください。',6,0,NULL,'2009-11-19 12:39:39',NULL,NULL),(167,'出荷国名','SHIPPING_ORIGIN_COUNTRY','107','配送料の計算に利用するための国名を選択します。',7,1,NULL,'2009-11-19 12:39:39','zen_get_country_name','zen_cfg_pull_down_country_list('),(168,'ショップの郵便番号','SHIPPING_ORIGIN_ZIP','100-0000','ショップの郵便番号を入力します。',7,2,NULL,'2009-11-19 12:39:39',NULL,NULL),(169,'一回の配送で配送可能な最大重量(kg)','SHIPPING_MAX_WEIGHT','50','一回の配送で可能な重量(kg)の最大値を設定します。例えば10kgに設定した状態でカートに30kgの商品があった場合、10kg × 3回の配送という形で処理されます。',7,3,NULL,'2009-11-19 12:39:39',NULL,NULL),(170,'小・中パッケージの風袋 - 比率・重量','SHIPPING_BOX_WEIGHT','0:3','典型的な小・中パッケージの風袋(ふうたい：大きさと重量)を設定します。<br />\r\n例：10% + 1lb 10:1<br />\r\n10% + 0lbs 10:0<br />\r\n0% + 5lbs 0:5<br />\r\n0% + 0lbs 0:0',7,4,NULL,'2009-11-19 12:39:39',NULL,NULL),(171,'大型パッケージの風袋 - 大きさ・重量','SHIPPING_BOX_PADDING','10:0','大きなパッケージの風袋風袋(ふうたい：大きさと重量)を設定します。<br />\r\n例：10% + 1lb 10:1<br />\r\n10% + 0lbs 10:0<br />\r\n0% + 5lbs 0:5<br />\r\n0% + 0lbs 0:0',7,5,NULL,'2009-11-19 12:39:39',NULL,NULL),(172,'個数と重量の表示','SHIPPING_BOX_WEIGHT_DISPLAY','3','配送する荷物の個数と重量を表示するかどうかを設定します。<br /><br />\r\n・0= off<br />\r\n・1= 個数のみ表示<br />\r\n・2= 重量のみ表示<br />\r\n・3= 両方表示',7,15,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'), '),(173,'送料概算表示の表示・非表示','SHOW_SHIPPING_ESTIMATOR_BUTTON','1','送料概算ボタンの表示するかどうかを設定します。<br />\r\n・0= Off<br />\r\n・1= ショッピングカート上にボタンとして表示',7,20,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), '),(174,'注文の重量が0なら送料無料に','ORDER_WEIGHT_ZERO_STATUS','1','注文の重量が0の場合、送料無料にしますか?\r\n<br />\r\n・0= いいえ<br />\r\n・1= はい<br />\r\n注意：「送料無料」表記をしたい場合には送料無料モジュールを使うことをお勧めします。このオプションは実際に送料無料のときに表示されるだけです。',7,15,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), '),(175,'商品イメージの表示','PRODUCT_LIST_IMAGE','1','商品一覧中の商品画像の表示・非表示/ソート順を設定します。<br /><br />\r\n・数値が小さいほど先に表示<br />\r\n・0 = 非表示',8,1,NULL,'2009-11-19 12:39:39',NULL,NULL),(176,'商品メーカーの表示','PRODUCT_LIST_MANUFACTURER','0','商品のメーカー名を表示するかどうかを設定します。<br /><br />\r\n・数値が小さいほど先に表示<br />\r\n・0 = 非表示',8,2,NULL,'2009-11-19 12:39:39',NULL,NULL),(177,'商品型番の表示','PRODUCT_LIST_MODEL','0','商品一覧中の商品型番の表示・非表示/ソート順を設定します。数値が小さいほど先に表示されます。(0 = 非表示)',8,3,NULL,'2009-11-19 12:39:39',NULL,NULL),(178,'商品名','PRODUCT_LIST_NAME','2','商品一覧中の商品名の表示・非表示/ソート順を設定します。<br /><br />\r\n・数値が小さいほど先に表示<br />\r\n・0 = 非表示',8,4,NULL,'2009-11-19 12:39:39',NULL,NULL),(179,'商品価格・「カートに入れる」を表示','PRODUCT_LIST_PRICE','3','商品価格・「カートに入れる」ボタンを表示するかどうかを設定します。<br />\r\n<br />\r\n・数値が小さいほど先に表示<br />\r\n・0 = 非表示',8,5,NULL,'2009-11-19 12:39:39',NULL,NULL),(180,'商品数量の表示','PRODUCT_LIST_QUANTITY','0','商品一覧中の商品数量の表示・非表示/ソート順を設定します。<br /><br />\r\n・数値が小さいほど先に表示<br />\r\n・0 = 非表示',8,6,NULL,'2009-11-19 12:39:39',NULL,NULL),(181,'商品重量の表示','PRODUCT_LIST_WEIGHT','0','商品一覧中の商品重量の表示・非表示/ソート順を設定します。数値が小さいほど先に表示されます。(0 = 非表示)',8,7,NULL,'2009-11-19 12:39:39',NULL,NULL),(182,'商品価格・「カートに入れる」カラムの幅','PRODUCTS_LIST_PRICE_WIDTH','125','商品価格・「カートに入れる」ボタンを表示するカラムの幅(ピクセル数)を設定します。<br />\r\n・Default= 125',8,8,NULL,'2009-11-19 12:39:39',NULL,NULL),(183,'カテゴリ/メーカーの絞り込みの表示','PRODUCT_LIST_FILTER','1','カテゴリ一覧ページで [絞り込み] を表示するかどうかを設定します。<br />\r\n・0=非表示<br />\r\n・1=表示',8,9,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), '),(184,'[前ページ] [次ページ] の表示位置','PREV_NEXT_BAR_LOCATION','3','[前ページ] [次ページ] の表示位置を設定します。<br /><br />\r\n・1 = 上<br />\r\n・2 = 下<br />\r\n・3 = 両方',8,10,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'1\', \'2\', \'3\'), '),(185,'商品リストのデフォルトソート順','PRODUCT_LISTING_DEFAULT_SORT_ORDER','','商品リストのデフォルトのソート順を設定します。\r\n<br />\r\n注意：商品でソートする場合は空欄に。\r\nSort the Product Listing in the order you wish for the default display to start in to get the sort order setting. Example: 2a',8,15,NULL,'2009-11-19 12:39:39',NULL,NULL),(186,'「カートに入れる」ボタンの表示','PRODUCT_LIST_PRICE_BUY_NOW','1','「カートに入れる」ボタンを表示するかどうかを設定します。<br /><br />\r\n・0= off<br />\r\n・1= on',8,20,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), '),(187,'複数商品の数量欄の有無・表示位置','PRODUCT_LISTING_MULTIPLE_ADD_TO_CART','3','複数商品をカートに入れる数量欄の表示するかどうかと、表示位置を設定します。<br />0= off<br />1= 上部<br />2= 下部<br />3= 両方',8,25,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'), '),(188,'商品説明の表示','PRODUCT_LIST_DESCRIPTION','150','商品説明を表示するかどうかを設定します。<br /><br />0= OFF<br />150= 推奨する長さ。または自由に表示する商品説明の最大文字数を設定してください。',8,30,NULL,'2009-11-19 12:39:39',NULL,NULL),(189,'商品リストの昇順を表示する記号','PRODUCT_LIST_SORT_ORDER_ASCENDING','+','商品リストの昇順を示す記号は?<br />デフォルト = +',8,40,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_textarea_small('),(190,'商品リストの降順を表示する記号','PRODUCT_LIST_SORT_ORDER_DESCENDING','-','商品リストの降順を示す記号は?<br />デフォルト = -',8,41,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_textarea_small('),(191,'在庫水準のチェック','STOCK_CHECK','true','十分な在庫があるかチェックするかどうかを設定します。',9,1,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(192,'在庫数からマイナス','STOCK_LIMITED','true','受注時点で各在庫数から注文数をマイナスしますか?',9,2,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(193,'チェックアウトを許可','STOCK_ALLOW_CHECKOUT','true','在庫が不足している場合にチェックアウトを許可しますか?',9,3,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(194,'在庫切れ商品のサイン','STOCK_MARK_PRODUCT_OUT_OF_STOCK','在庫切れです','注文時点で商品が在庫切れの場合に顧客へ表示するサインを設定します。',9,4,NULL,'2009-11-19 12:39:39',NULL,NULL),(195,'在庫の再注文水準','STOCK_REORDER_LEVEL','5','在庫の再注文が必要になる商品数を設定します。',9,5,NULL,'2009-11-19 12:39:39',NULL,NULL),(196,'在庫切れ商品のステータス変更','SHOW_PRODUCTS_SOLD_OUT','0','商品の在庫がない場合のステータス表示を設定します。<br /><br />0= 商品ステータスをOFFに<br />1= 商品ステータスはONのまま',9,10,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), '),(197,'在庫切れ商品に「売り切れ」画像表示','SHOW_PRODUCTS_SOLD_OUT_IMAGE','1','在庫がなくなった商品の場合に「カートへ入れる」ボタンの代わりに「売り切れ」画像を表示しますか?<br /><br />\r\n・0= 表示しない<br />\r\n・1= 表示する',9,11,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), '),(198,'商品数量に指定できる小数点の桁数','QUANTITY_DECIMALS','0','商品の数量に小数点の利用を許可する桁数を設定します。<br /><br />\r\n・0= off',9,15,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'), '),(199,'ショッピングカート - 「削除」チェックボックス/ボタン','SHOW_SHOPPING_CART_DELETE','3','「削除」チェックボックス/ボタンの表示について設定します。<br /><br />1= ボタンのみ<br />2= チェックボックスのみ<br />3= ボタン/チェックボックス両方',9,20,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'1\', \'2\', \'3\'), '),(200,'ショッピングカート -「カートの中身を更新」ボタンの位置','SHOW_SHOPPING_CART_UPDATE','3','「カートの中身を更新」ボタンの位置を設定します。<br /><br />1=「注文数」欄の横<br />2= 商品リストの下<br />3=「注文数」欄の横と商品リストの下<br /><br />注意：この設定は3つの\"tpl_shopping_cart_default\"ファイルが呼ばれる部分を設定します。',9,22,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'1\', \'2\', \'3\'), '),(201,'ページのパースに要した時間をログに記録するかどうかを設定します。','STORE_PAGE_PARSE_TIME','false','ページのパースに要した時間をログに記録するかどうかを設定します。',10,1,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(202,'ページのパースログを保存するディレクトリとファイル名を設定します。','STORE_PAGE_PARSE_TIME_LOG','/var/log/www/zen/page_parse_time.log','ページのパースログを保存するディレクトリとファイル名を設定します。',10,2,NULL,'2009-11-19 12:39:39',NULL,NULL),(203,'ログに記録する日付形式を設定します。','STORE_PARSE_DATE_TIME_FORMAT','%d/%m/%Y %H:%M:%S','ログに記録する日付形式を設定します。',10,3,NULL,'2009-11-19 12:39:39',NULL,NULL),(204,'各ページの下にパース時間を表示するかどうかを設定します。<br />「ページのパース時間を記録」を true にしておく必要はありません。','DISPLAY_PAGE_PARSE_TIME','false','各ページの下にパース時間を表示するかどうかを設定します。<br />「ページのパース時間を記録」を true にしておく必要はありません。',10,4,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(205,'ログにデータベースクエリーを記録しておくかどうか設定します。(PHP4の場合のみ)','STORE_DB_TRANSACTIONS','false','ログにデータベースクエリーを記録しておくかどうか設定します。(PHP4の場合のみ)',10,5,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(206,'メール送信 - 接続方法','EMAIL_TRANSPORT','sendmail','メール送信にsendmailへのローカル接続を使用するかTCP/IP経由のSMTP接続を使用するかを設定します。サーバのOSがWindowsやMacOSの場合はSMTPに設定してください。<br /><br />SMTPAUTHは、サーバーがメール送信の際にSMTP authorizationを求める場合にのみ使ってください。その場合、管理画面でSMTPAUTH設定を行う必要があります。<br /><br />\"Sendmail -f\"は、-fパラメータが必要なサーバ向けの設定で、スプーフィングを防ぐために用いられることが多いセキュリティ上の設定です。メールサーバーのホスト側で使用可能な設定になっていない場合、エラーになることがあります。',12,1,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'sendmail\', \'sendmail-f\', \'smtp\', \'smtpauth\'),'),(207,'SMTP認証 - メールアカウント','EMAIL_SMTPAUTH_MAILBOX','YourEmailAccountNameHere','あなたのホスティングサービスが提供しているメールアカウント(例：me@mydomain.com)を入力してください。これはSMTP認証に必要な情報です。<br />メールにSMTP認証を使っている場合にのみ必要です。',12,101,NULL,'2009-11-19 12:39:39',NULL,NULL),(208,'SMTP認証 - パスワード','EMAIL_SMTPAUTH_PASSWORD','YourPasswordHere','SMTPメールボックスのパスワードを入力してください。<br />メールにSMTP認証を使っている場合にのみ必要です。',12,101,NULL,'2009-11-19 12:39:39',NULL,NULL),(209,'SMTP認証 - DNS名','EMAIL_SMTPAUTH_MAIL_SERVER','mail.EnterYourDomain.com','SMTPメールサーバのDNS名を入力してください。<br />例：mail.mydomain.com or 55.66.77.88<br />メールにSMTP認証を使っている場合にのみ必要です。',12,101,NULL,'2009-11-19 12:39:39',NULL,NULL),(210,'SMTP認証 - IPポート番号','EMAIL_SMTPAUTH_MAIL_SERVER_PORT','25','SMTPメールサーバが運用されているIPポート番号を入力してください。<br />メールにSMTP認証を使っている場合にのみ必要です。',12,101,NULL,'2009-11-19 12:39:39',NULL,NULL),(211,'テキストメールでの貨幣の変換','CURRENCIES_TRANSLATIONS','&amp;pound;,£:&amp;euro;,EUR','テキスト形式のメールに、どんな貨幣の変換が必要ですか?<br />Default = &amp;pound;,£:&amp;euro;,EUR',12,120,NULL,'2003-11-21 00:00:00',NULL,'zen_cfg_textarea_small('),(212,'メールの改行コード','EMAIL_LINEFEED','LF','メールヘッダを区切るのに使用する改行コードを指定します。',12,2,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'LF\', \'CRLF\'),'),(213,'メール送信にMIME HTMLを使用','EMAIL_USE_HTML','false','メールをHTML形式で送信するかどうかを設定します。',12,3,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),'),(214,'メールアドレスをDNSで確認','ENTRY_EMAIL_ADDRESS_CHECK','false','メールアドレスをDNSサーバに問い合わせ確認するかどうかを設定します。',12,4,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(215,'メールを送信','SEND_EMAILS','true','E-Mailを外部に送信するかどうかを設定します。',12,5,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(216,'メール保存の設定','EMAIL_ARCHIVE','false','送信済みのメールを保存しておく場合はtrueを設定してください。',12,6,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),'),(217,'メール送信エラーの表示','EMAIL_FRIENDLY_ERRORS','false','メール送信が失敗した際、人目でわかるエラーを表示しますか? 運営中のショップではtrueに設定することを勧めます。falseに設定するとPHPのエラーメッセージを表示されるので、トラブル解決のヒントになります。',12,7,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),'),(218,'メールアドレス (ショップに表示する問い合わせ先)','STORE_OWNER_EMAIL_ADDRESS','ohtsuji@ark-web.jp','ショップオーナーのメールアドレスとしてサイト上で表示されるアドレスを設定します。',12,10,NULL,'2009-11-19 12:39:39',NULL,NULL),(219,'メールアドレス (顧客への送信元)','EMAIL_FROM','ohtsuji@ark-web.jp','顧客に送信されるメールのデフォルトの送信元として表示されるアドレスを設定します。<br />\r\n管理画面でメールを作成をする都度、書き換えることもできます。',12,11,NULL,'2009-11-19 12:39:39',NULL,NULL),(220,'送信メールの送信元アドレスの実在性','EMAIL_SEND_MUST_BE_STORE','No','お使いのメールサーバでは、送信するメールの送信元(From)アドレスがWebサーバ上に実在することが必須ですか?<br /><br />spam送信を防止するなどのためにこのように設定されていることがあります。Yesに設定すると、送信元アドレスとメール内のFromアドレスが一致していることが求められます。',12,11,NULL,'0001-01-01 00:00:00',NULL,'zen_cfg_select_option(array(\'No\', \'Yes\'), '),(221,'管理者が送信するメールフォーマット','ADMIN_EXTRA_EMAIL_FORMAT','TEXT','管理者が送付するメールフォーマットを設定します。<br /><br />\r\n・TEXT =テキスト形式<br />\r\n・HTML =HTML形式',12,12,NULL,'0001-01-01 00:00:00',NULL,'zen_cfg_select_option(array(\'TEXT\', \'HTML\'), '),(222,'注文確認メール(コピー)送信先','SEND_EXTRA_ORDER_EMAILS_TO','ohtsuji@ark-web.jp','顧客に送信される注文確認メールのコピーを送付するメールアドレスを設定します。<br />記入例: 名前1 &lt;email@address1&gt;, 名前2 &lt;email@address2&gt;',12,12,NULL,'2009-11-19 12:39:39',NULL,NULL),(223,'アカウント作成完了メール(コピー)の送信','SEND_EXTRA_CREATE_ACCOUNT_EMAILS_TO_STATUS','0','アカウント作成完了メールのコピーを指定のメールアドレスに送信しますか?<br /><br />\r\n・0= off<br />\r\n・1= on',12,13,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'),'),(224,'アカウント作成完了メール(コピー)の送信先','SEND_EXTRA_CREATE_ACCOUNT_EMAILS_TO','ohtsuji@ark-web.jp','アカウント作成完了メールのコピーを送信するメールアドレスを設定します。<br /><br />\r\n記入例： 名前1 &lt;email@address1&gt;, 名前2 &lt;email@address2&gt;',12,14,NULL,'2009-11-19 12:39:39',NULL,NULL),(225,'「友達に知らせる」メール(コピー)の送信','SEND_EXTRA_TELL_A_FRIEND_EMAILS_TO_STATUS','0','「友達に知らせる」メールのコピーを送信しますか?<br />0= off 1= on',12,15,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'),'),(226,'「友達に知らせる」メール(コピー)の送信先','SEND_EXTRA_TELL_A_FRIEND_EMAILS_TO','ohtsuji@ark-web.jp','「友達に知らせる」メールのコピーを送信するメールアドレスを設定します。記入例: 名前1 &lt;email@address1&gt;, 名前2 &lt;email@address2&gt;',12,16,NULL,'2009-11-19 12:39:39',NULL,NULL),(227,'ギフト券送付メール(コピー)の送信','SEND_EXTRA_GV_CUSTOMER_EMAILS_TO_STATUS','0','顧客が送付するギフト券送付メールのコピーを送信しますか?<br /><br />\r\n・0= off<br />\r\n・1= on',12,17,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'),'),(228,'ギフト券送付メール(コピー)の送信先','SEND_EXTRA_GV_CUSTOMER_EMAILS_TO','ohtsuji@ark-web.jp','顧客が送付するギフト券送付メールのコピーを送信するメールアドレスを設定します。<br /><br />記入例： 名前1 &lt;email@address1&gt;, 名前2&lt;email@address2&gt;',12,18,NULL,'2009-11-19 12:39:39',NULL,NULL),(229,'ショップ運営者からのギフト券送付メール(コピー)の送信','SEND_EXTRA_GV_ADMIN_EMAILS_TO_STATUS','0','ショップ運営者からのギフト券送付メールのコピーを送信しますか?<br /><br />\r\n・0= off<br />\r\n・1= on',12,19,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'),'),(230,'ショップ運営者からのギフト券送付メール(コピー)の送信先','SEND_EXTRA_GV_ADMIN_EMAILS_TO','ohtsuji@ark-web.jp','ショップ運営者からのギフト券送付メールのコピーを送信するメールアドレスを設定します。<br /><br />\r\n記入例：名前1 &lt;email@address1&gt;, 名前2 &lt;email@address2&gt;',12,20,NULL,'2009-11-19 12:39:39',NULL,NULL),(231,'ショップ運営者からのクーポン券送付メール(コピー)の送信','SEND_EXTRA_DISCOUNT_COUPON_ADMIN_EMAILS_TO_STATUS','0','ショップ運営者からのクーポン券送付メールのコピーを送信しますか?<br />0= off 1= on',12,21,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'),'),(232,'ショップ運営者からのクーポン券送付メール(コピー)の送信先','SEND_EXTRA_DISCOUNT_COUPON_ADMIN_EMAILS_TO','ohtsuji@ark-web.jp','ショップ運営者からのクーポン券送付メールのコピーを送信するメールアドレスを設定します。<br /><br />\r\n記入例： 名前1 &lt;email@address1&gt;, 名前2 &lt;email@address2&gt;',12,22,NULL,'2009-11-19 12:39:39',NULL,NULL),(233,'ショップ運営者の注文ステータスメール(コピー)の送信','SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO_STATUS','0','ショップ運営者の注文ステータスメールのコピーを送信しますか?<br /><br />\r\n・0= off<br />\r\n・1= on',12,23,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'),'),(234,'ショップ運営者の注文ステータスメール(コピー)の送信先','SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO','ohtsuji@ark-web.jp','ショップ運営者の注文ステータスメールのコピーを送信するメールアドレスを設定します。<br /><br />\r\n記入例： 名前1 &lt;email@address1&gt;, 名前2 &lt;email@address2&gt;',12,24,NULL,'2009-11-19 12:39:39',NULL,NULL),(235,'掲載待ちレビューについてメール送信','SEND_EXTRA_REVIEW_NOTIFICATION_EMAILS_TO_STATUS','0','掲載待ちのレビューについてメールを送信しますか?<br />0= off 1= on',12,25,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'),'),(236,'掲載待ちレビューについてのメール送信先','SEND_EXTRA_REVIEW_NOTIFICATION_EMAILS_TO','ohtsuji@ark-web.jp','掲載待ちのレビューについてのメールを送信するアドレスを設定します。<br />フォーマット：Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;',12,26,NULL,'2009-11-19 12:39:39',NULL,NULL),(237,'「お問い合わせ」メールのドロップダウン設定','CONTACT_US_LIST','','「お問い合わせ」ページで、メールアドレスのリストを設定し、ドロップダウンリストとして表示できます。<br />\r\nフォーマット：Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;',12,40,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_textarea('),(238,'ゲストに「友達に知らせる」機能を許可','ALLOW_GUEST_TO_TELL_A_FRIEND','false','ゲスト(未登録ユーザ)に「友達に知らせる」機能を許可するかどうかを設定します。 <br />[false]に設定すると、この機能を利用しようとした際にログインを促します。',12,50,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(239,'「お問い合わせ」にショップ名と住所を表記','CONTACT_US_STORE_NAME_ADDRESS','1','「お問い合わせ」画面にショップ名と住所を表記するかどうかを設定します。<br /><br />\r\n・0= off<br />\r\n・1= on',12,50,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), '),(240,'在庫わずかになったらメール送信','SEND_LOWSTOCK_EMAIL','0','商品の在庫が水準を下回った際にメールを送信するかどうかを設定します。<br />\r\n・0= off<br />\r\n・1= on',12,60,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'),'),(241,'在庫わずかになった際のメール送信先','SEND_EXTRA_LOW_STOCK_EMAILS_TO','ohtsuji@ark-web.jp','商品の在庫が水準を下回った際にメールを送信するアドレスを設定します。複数設定することができます。<br />\r\nフォーマット：Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;',12,61,NULL,'2009-11-19 12:39:39',NULL,NULL),(242,'「メールマガジンの購読解除」リンクの表示','SHOW_NEWSLETTER_UNSUBSCRIBE_LINK','true','「メールマガジンの購読解除」リンクをインフォメーションサイドボックスに表示しますか?',12,70,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),'),(243,'オンラインユーザー数の表示設定','AUDIENCE_SELECT_DISPLAY_COUNTS','true','オンラインのユーザ(audiences/recipients)を表示する際、recipientsを含めますか?<br /><br />\r\n【注意】この設定をtrueにすると、沢山の顧客がいる場合などに表示が遅くなる場合があります。',12,90,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),'),(244,'ダウンロードを有効にする','DOWNLOAD_ENABLED','true','商品のダウンロード機能を設定します。',13,1,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(245,'リダイレクトでダウンロード画面へ','DOWNLOAD_BY_REDIRECT','true','ダウンロードの際にブラウザによるリダイレクト(転送)を可能にするかどうかを設定します。<br />\r\nUNIX系でないサーバではオフにしてください。\r\n<br />注意：この設定をオンにしたら、/pub ディレクトリのパーミッションを777にしてください。',13,2,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(246,'ストリーミングによるダウンロード','DOWNLOAD_IN_CHUNKS','false','「リダイレクトでダウンロード」がオフで、かつPHP memory_limit設定が8MB以下の場合、この設定をオンにしてください。ストリーミングで、より小さな単位でのファイル転送を行うためです。<br /><br />「リダイレクトでダウンロード」がオンの場合、効果はありません。',13,2,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(247,'ダウンロードの有効期限(日数)','DOWNLOAD_MAX_DAYS','7','ダウンロードリンクの有効期間の日数を設定します。<br /><br />\r\n・0 = 無期限',13,3,NULL,'2009-11-19 12:39:39',NULL,''),(248,'ダウンロード可能回数(商品ごと)','DOWNLOAD_MAX_COUNT','5','ダウンロードできる回数の最大値を設定します。<br /><br />\r\n・0 = ダウンロード不可',13,4,NULL,'2009-11-19 12:39:39',NULL,''),(249,'ダウンロード設定 - 注文状況による更新','DOWNLOADS_ORDERS_STATUS_UPDATED_VALUE','4','orders_statusによるダウンロードの有効期限・可能回数のリセットについて設定します。<br />デフォルト = 4',13,10,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,NULL),(250,'ダウンロード可能となる注文ステータスのID - デフォルト >= 2','DOWNLOADS_CONTROLLER_ORDERS_STATUS','2','ダウンロード可能となる注文ステータスのID - デフォルト >= 2<br /><br />注文ステータスのIDがこの値より高い注文はダウンロード可能になります。購入完了時の注文ステータスは支払いモジュールに毎に設定されます。',13,12,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,NULL),(251,'ダウンロード終了となる注文ステータスのID','DOWNLOADS_CONTROLLER_ORDERS_STATUS_END','4','ダウンロード終了となる注文ステータスのID - デフォルト >= 4<br /><br />注文ステータスがこの値より高い注文はダウンロードが終了となります。',13,13,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,NULL),(252,'Price Factor属性を可能にする','ATTRIBUTES_ENABLED_PRICE_FACTOR','true','Price Factor属性を可能にするかどうかを設定します。',13,25,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(253,'Qty Price Discount属性のオン/オフ','ATTRIBUTES_ENABLED_QTY_PRICES','true','「大量購入による値引き」属性のオン/オフを設定します。',13,26,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(254,'イメージ属性のオン/オフ','ATTRIBUTES_ENABLED_IMAGES','true','イメージ属性のオン/オフを設定します。',13,28,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(255,'(言葉・文字による)テキストによる価格設定のオン/オフ','ATTRIBUTES_ENABLED_TEXT_PRICES','true','テキストによる価格設定の属性のオン/オフを設定します。',13,35,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(256,'テキストによる価格設定 - 空欄の場合は無料','TEXT_SPACES_FREE','1','テキストによる価格設定の場合、空欄のままなら無料にするかどうかを設定します。<br /><br />\r\n・0= off<br />\r\n・1= on',13,36,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), '),(257,'Read Only属性の商品 -「カートに入れる」ボタンの表示','PRODUCTS_OPTIONS_TYPE_READONLY_IGNORED','1','READONLY属性だけが設定された商品に「カートに入れる」ボタンを表示しますか?<br />0= OFF<br />1= ON',13,37,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), '),(258,'GZip圧縮を使用する','GZIP_LEVEL','0','HTTP通信にGZip圧縮を使用してページを転送しますか?<br /><br />\r\n・0= off<br />\r\n・1= on',14,1,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'),'),(259,'セッション情報保存ディレクトリ','SESSION_WRITE_DIRECTORY','/var/www/projects/z/zen-cart/htdocs/ohtsuji/zencart-sugu/cache','セッション管理がファイルベースの場合に保存するディレクトリを設定します。',15,1,NULL,'2009-11-19 12:39:39',NULL,NULL),(260,'クッキーに保存するドメイン名の設定','SESSION_USE_FQDN','True','クッキーに保存するドメイン名について設定します。<br /><br />\r\n\r\n・True = ドメインネーム全体をクッキーに保存(例：www.mydomain.com)<br />\r\n・False = ドメインネームの一部を保存(例：mydomain.com)。<br />\r\nよくわからない場合はこの設定はTrueにしておいてください。',15,2,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'True\', \'False\'), '),(261,'クッキー利用を必須にする','SESSION_FORCE_COOKIE_USE','True','セッションに必ずクッキーを利用します。True指定するとブラウザのクッキーがオフになっている場合はセッションを開始しません。セキュリティ上の理由から余程の理由のない限りはTrue指定のままとすることを強く推奨します。',15,2,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'True\', \'False\'), '),(262,'SSLセッションIDチェック','SESSION_CHECK_SSL_SESSION_ID','False','全てのHTTPSリクエストでSSLセッションIDをチェックしますか?',15,3,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'True\', \'False\'), '),(263,'User Agentチェック','SESSION_CHECK_USER_AGENT','False','全てのリクエスト時にUser Agentのチェックを行いますか?',15,4,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'True\', \'False\'), '),(264,'IPアドレスチェック','SESSION_CHECK_IP_ADDRESS','False','全てのリクエスト時にIPアドレスをチェックしますか?',15,5,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'True\', \'False\'), '),(265,'ロボット(スパイダー)のセッションを防止','SESSION_BLOCK_SPIDERS','True','既知のロボット(スパイダー)がセッションを開始することを防止しますか?',15,6,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'True\', \'False\'), '),(266,'セッション再発行','SESSION_RECREATE','True','ユーザーがログオンまたはアカウントを作成した場合にセッションを再発行しますか?<br />(PHP4.1以上が必要)',15,7,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'True\', \'False\'), '),(267,'IPアドレス変換の設定','SESSION_IP_TO_HOST_ADDRESS','true','IPアドレスをホストアドレスに変換しますか?<br /><br />注意：サーバによっては、この設定でメール送信のスタート・終了が遅くなることがあります。',15,10,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(268,'ギフト/クーポン券コードの長さ','SECURITY_CODE_LENGTH','10','ギフト/クーポン券コードの長さを設定します。<br /><br />\r\n注意：コードが長いほど安全です。',16,1,NULL,'2009-11-19 12:39:39',NULL,NULL),(269,'差引残高0の場合の注文ステータス','DEFAULT_ZERO_BALANCE_ORDERS_STATUS_ID','2','注文の差引残高が0の場合に適用される注文ステータスを設定します。',16,0,NULL,'2009-11-19 12:39:39','zen_get_order_status_name','zen_cfg_pull_down_order_statuses('),(270,'ウェルカムクーポン券','NEW_SIGNUP_DISCOUNT_COUPON','','会員登録時にその会員にウェルカムクーポン券として自動発行するクーポン券を選択してください。',16,75,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_coupon_id('),(271,'新しいギフト券の登録額','NEW_SIGNUP_GIFT_VOUCHER_AMOUNT','','新しいギフト券の登録額を設定します。<br /><br />\r\n・空白 = なし<br />\r\n・1000 = 1000円',16,76,NULL,'2009-11-19 12:39:39',NULL,NULL),(272,'クーポン券のページあたり最大表示件数','MAX_DISPLAY_SEARCH_RESULTS_DISCOUNT_COUPONS','20','クーポン券の1ページあたりの表示件数を設定します。',16,81,NULL,'2009-11-19 12:39:39',NULL,NULL),(273,'クーポン券レポートのページあたり最大表示件数','MAX_DISPLAY_SEARCH_RESULTS_DISCOUNT_COUPONS_REPORTS','20','クーポン券のレポートページでの表示件数を設定します。',16,81,NULL,'2009-11-19 12:39:39',NULL,NULL),(274,'ギフト券残高の最大値数','MAX_GIFT_AMOUNT','100000','ギフト券残高の最大値を設定します。ギフト券引き換え結果がこの値を超える場合は引き換え処理ができません。値は100000以下を指定してください。',16,82,NULL,'2009-11-19 12:39:39',NULL,NULL),(275,'クレジットカード利用の可否 - VISA','CC_ENABLED_VISA','1','VISAを有効にしますか?<br /><br />\r\n・0= off<br />\r\n・1= on',17,1,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), '),(276,'クレジットカード利用の可否 - MasterCard','CC_ENABLED_MC','1','MasterCardを有効にしますか?<br /><br />\r\n・0= off<br />\r\n・1= on',17,2,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), '),(277,'クレジットカード利用の可否 - AmericanExpress','CC_ENABLED_AMEX','0','AmericanExpressを有効にしますか?<br /><br />\r\n・0= off<br />\r\n・1= on',17,3,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), '),(278,'クレジットカード利用の可否 - Diners Club','CC_ENABLED_DINERS_CLUB','0','Diners Clubを有効にしますか?<br /><br />\r\n・0= off<br />\r\n・1= on',17,4,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), '),(279,'クレジットカード利用の可否 - Discover Card','CC_ENABLED_DISCOVER','0','Discover Cardを有効にしますか?<br /><br />\r\n・0= off<br />\r\n・1= on',17,5,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), '),(280,'クレジットカード利用の可否 - JCB','CC_ENABLED_JCB','0','JCBを有効にしますか?<br /><br />\r\n・0= off<br />\r\n・1= on',17,6,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), '),(281,'クレジットカード利用の可否 - AUSTRALIAN BANKCARD','CC_ENABLED_AUSTRALIAN_BANKCARD','0','AUSTRALIAN BANKCARDを有効にしますか?<br /><br />\r\n・0= off<br />\r\n・1= on',17,7,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), '),(282,'利用可能なクレジットカード - 支払いページに表示','SHOW_ACCEPTED_CREDIT_CARDS','0','利用可能なクレジットカードを支払いページに表示しますか?<br /><br />\r\n・0= off<br />\r\n・1= テキストを表示<br />\r\n・2= 画像を表示<br />\r\n【注意】クレジットカードの画像とテキストは、データベースとランゲージファイル内で定義されている必要があります。',17,50,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), '),(283,'ギフト券の表示','MODULE_ORDER_TOTAL_GV_STATUS','true','',6,1,NULL,'2003-10-30 22:16:40',NULL,'zen_cfg_select_option(array(\'true\'),'),(284,'表示の整列順','MODULE_ORDER_TOTAL_GV_SORT_ORDER','840','表示の整列順を設定します。<br />数字が小さいほど上位に表示されます。',6,2,NULL,'2003-10-30 22:16:40',NULL,NULL),(285,'購入を承認待ちに','MODULE_ORDER_TOTAL_GV_QUEUE','true','ギフト券購入を承認待ちリストに追加しますか?',6,3,NULL,'2003-10-30 22:16:40',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),'),(286,'送料を含める','MODULE_ORDER_TOTAL_GV_INC_SHIPPING','true','合計計算に送料を含めますか?',6,5,NULL,'2003-10-30 22:16:40',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),'),(287,'税金を含める','MODULE_ORDER_TOTAL_GV_INC_TAX','true','計算時に税金を含めるかどうかを設定します。',6,6,NULL,'2003-10-30 22:16:40',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),'),(288,'税金を再計算','MODULE_ORDER_TOTAL_GV_CALC_TAX','None','税金を再計算しますか?',6,7,NULL,'2003-10-30 22:16:40',NULL,'zen_cfg_select_option(array(\'None\', \'Standard\', \'Credit Note\'),'),(289,'税種別','MODULE_ORDER_TOTAL_GV_TAX_CLASS','0','ギフト券に適用される税種別を設定します。',6,0,NULL,'2003-10-30 22:16:40','zen_get_tax_class_title','zen_cfg_pull_down_tax_classes('),(290,'税金を付加する','MODULE_ORDER_TOTAL_GV_CREDIT_TAX','false','ギフト券を計算する際に税金を付加しますか?',6,8,NULL,'2003-10-30 22:16:40',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),'),(291,'低額商品取扱い手数料の表示','MODULE_ORDER_TOTAL_LOWORDERFEE_STATUS','true','',6,1,NULL,'2003-10-30 22:16:43',NULL,'zen_cfg_select_option(array(\'true\'),'),(292,'表示の整列順','MODULE_ORDER_TOTAL_LOWORDERFEE_SORT_ORDER','400','表示の整列順を設定します。数字が小さいほど上位に表示されます。',6,2,NULL,'2003-10-30 22:16:43',NULL,NULL),(293,'低額商品取扱い手数料の設定','MODULE_ORDER_TOTAL_LOWORDERFEE_LOW_ORDER_FEE','false','低額商品取扱い手数料設定を有効にしますか?',6,3,NULL,'2003-10-30 22:16:43',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),'),(294,'低額商品取扱い手数料を課金する注文金額','MODULE_ORDER_TOTAL_LOWORDERFEE_ORDER_UNDER','50','この注文金額未満の場合、手数料を課金します。',6,4,NULL,'2003-10-30 22:16:43','currencies->format',NULL),(295,'取扱い手数料の設定','MODULE_ORDER_TOTAL_LOWORDERFEE_FEE','5','手数料を設定します。<br /><br />\r\n率(%)で計算する場合には「10%」などと記入し、固定の場合には「500」(500円)などと記入します。',6,5,NULL,'2003-10-30 22:16:43','',NULL),(296,'低額商品取扱い手数料を適用する地域','MODULE_ORDER_TOTAL_LOWORDERFEE_DESTINATION','both','設定した地域に対して低額商品取扱い手数料が適用されます。',6,6,NULL,'2003-10-30 22:16:43',NULL,'zen_cfg_select_option(array(\'national\', \'international\', \'both\'),'),(297,'税種別','MODULE_ORDER_TOTAL_LOWORDERFEE_TAX_CLASS','0','低額商品取扱い手数料金額に適用される税種別を設定します。',6,7,NULL,'2003-10-30 22:16:43','zen_get_tax_class_title','zen_cfg_pull_down_tax_classes('),(298,'低額商品取扱い手数料はヴァーチャル商品には非適用','MODULE_ORDER_TOTAL_LOWORDERFEE_VIRTUAL','false','カート内がヴァーチャル商品だけの際に、低額商品取扱い手数料を徴収するかどうかを設定します。',6,8,NULL,'2004-04-20 22:16:43',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),'),(299,'低額商品取扱い手数料はギフト券には非適用','MODULE_ORDER_TOTAL_LOWORDERFEE_GV','false','カート内がギフト券などだけのときに低額商品取扱い手数料を徴収するかどうかを設定します。',6,9,NULL,'2004-04-20 22:16:43',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),'),(300,'送料の表示','MODULE_ORDER_TOTAL_SHIPPING_STATUS','true','',6,1,NULL,'2003-10-30 22:16:46',NULL,'zen_cfg_select_option(array(\'true\'),'),(301,'表示の整列順','MODULE_ORDER_TOTAL_SHIPPING_SORT_ORDER','200','表示の整列順を設定します。<br />\r\n数字が小さいほど上位に表示されます。',6,2,NULL,'2003-10-30 22:16:46',NULL,NULL),(302,'送料無料設定','MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING','false','送料無料設定を有効にしますか?',6,3,NULL,'2003-10-30 22:16:46',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),'),(303,'送料無料にする購入金額設定','MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER','50','設定金額以上のご購入の場合は送料を無料にします。',6,4,NULL,'2003-10-30 22:16:46','currencies->format',NULL),(304,'送料無料にする地域の設定','MODULE_ORDER_TOTAL_SHIPPING_DESTINATION','national','設定した地域に対して送料無料を適用します。',6,5,NULL,'2003-10-30 22:16:46',NULL,'zen_cfg_select_option(array(\'national\', \'international\', \'both\'),'),(305,'小計の表示','MODULE_ORDER_TOTAL_SUBTOTAL_STATUS','true','',6,1,NULL,'2003-10-30 22:16:49',NULL,'zen_cfg_select_option(array(\'true\'),'),(306,'表示の整列順','MODULE_ORDER_TOTAL_SUBTOTAL_SORT_ORDER','100','表示の整列順を設定します。<br />\r\n数字が小さいほど上位に表示されます。',6,2,NULL,'2003-10-30 22:16:49',NULL,NULL),(307,'税金の表示','MODULE_ORDER_TOTAL_TAX_STATUS','true','',6,1,NULL,'2003-10-30 22:16:52',NULL,'zen_cfg_select_option(array(\'true\'),'),(308,'表示の整列順','MODULE_ORDER_TOTAL_TAX_SORT_ORDER','300','表示の整列順を設定できます. 数字が小さいほど上位に表示されます。',6,2,NULL,'2003-10-30 22:16:52',NULL,NULL),(309,'合計の表示','MODULE_ORDER_TOTAL_TOTAL_STATUS','true','',6,1,NULL,'2003-10-30 22:16:55',NULL,'zen_cfg_select_option(array(\'true\'),'),(310,'表示の整列順','MODULE_ORDER_TOTAL_TOTAL_SORT_ORDER','999','表示の整列順を設定できます。<br />\r\n数字が小さいほど上位に表示されます。',6,2,NULL,'2003-10-30 22:16:55',NULL,NULL),(311,'税種別','MODULE_ORDER_TOTAL_COUPON_TAX_CLASS','0','クーポン券に適用される税種別を設定します。',6,0,NULL,'2003-10-30 22:16:36','zen_get_tax_class_title','zen_cfg_pull_down_tax_classes('),(312,'税金を含める - オン/オフ','MODULE_ORDER_TOTAL_COUPON_INC_TAX','true','代金計算に税金を含めるかどうかを設定します。',6,6,NULL,'2003-10-30 22:16:36',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),'),(313,'表示の整列順','MODULE_ORDER_TOTAL_COUPON_SORT_ORDER','280','表示の整列順を設定します。',6,2,NULL,'2003-10-30 22:16:36',NULL,NULL),(314,'送料を含める','MODULE_ORDER_TOTAL_COUPON_INC_SHIPPING','false','送料を計算に含めるかどうかを設定します。',6,5,NULL,'2003-10-30 22:16:36',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),'),(315,'クーポン券の表示','MODULE_ORDER_TOTAL_COUPON_STATUS','true','',6,1,NULL,'2003-10-30 22:16:36',NULL,'zen_cfg_select_option(array(\'true\'),'),(316,'税金を再計算','MODULE_ORDER_TOTAL_COUPON_CALC_TAX','Standard','税金を再計算しますか?',6,7,NULL,'2003-10-30 22:16:36',NULL,'zen_cfg_select_option(array(\'None\', \'Standard\', \'Credit Note\'),'),(317,'管理者デモ -オン/オフ','ADMIN_DEMO','0','管理者デモを有効にするかどうかを設定します。<br /><br />\r\n・0= off<br />\r\n・1= on',6,0,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), '),(318,'商品オプション - セレクトボックス型','PRODUCTS_OPTIONS_TYPE_SELECT','0','セレクトボックス型の商品オプションの数値は?',0,NULL,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,NULL),(319,'商品オプション - テキスト型','PRODUCTS_OPTIONS_TYPE_TEXT','1','テキスト型の商品オプションの数値は?',6,NULL,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,NULL),(320,'商品オプション - ラジオボタン型','PRODUCTS_OPTIONS_TYPE_RADIO','2','ラジオボタン型の商品オプションの数値は?',6,NULL,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,NULL),(321,'商品オプション - チェックボックス型','PRODUCTS_OPTIONS_TYPE_CHECKBOX','3','チェックボックス型の商品オプションの数値は?',6,NULL,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,NULL),(322,'商品オプション - ファイル型','PRODUCTS_OPTIONS_TYPE_FILE','4','ファイル型の商品オプションの数値は?',6,NULL,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,NULL),(323,'ID for text and file products options values','PRODUCTS_OPTIONS_VALUES_TEXT_ID','0','テキスト型・ファイル型属性のproducts_options_values_idで使われる数値は?',6,NULL,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,NULL),(324,'アップロードオプションの接頭辞(Prefix)','UPLOAD_PREFIX','upload_','アップロードオプションを他のオプションと区別するために使う接頭辞(Prefix)は?',0,NULL,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,NULL),(325,'テキストの接頭辞(Prefix)','TEXT_PREFIX','txt_','テキストオプションを他のオプションと区別するために使う接頭辞(Prefix)は?',0,NULL,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,NULL),(326,'商品オプション - READ ONLY型','PRODUCTS_OPTIONS_TYPE_READONLY','5','READ ONLY型の商品オプションの数値は?',6,NULL,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,NULL),(327,'商品情報 - 商品オプションのソート順','PRODUCTS_OPTIONS_SORT_ORDER','0','商品情報におけるオプション名のソート順を設定します。<br />\r\n<br />\r\n・0= ソート順、オプション名<br />\r\n・1= オプション名',18,35,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'),'),(328,'商品情報 - 商品オプション値のソート順','PRODUCTS_OPTIONS_SORT_BY_PRICE','1','商品説明での商品オプション値のソート順を設定します。<br />\r\n<br />\r\n・0= ソート順、価格<br />\r\n・1= ソート順、オプション値の名称',18,36,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'),'),(329,'商品の属性画像の下に表示するオプション値','PRODUCT_IMAGES_ATTRIBUTES_NAMES','1','商品の属性画像の下にオプション名を表示しますか?<br /><br />\r\n・0= off<br />\r\n・1= on',18,41,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), '),(330,'商品情報 - セール割引表示','SHOW_SALE_DISCOUNT_STATUS','1','セール割引分を表示しますか?<br /><br />\r\n・0= off<br />\r\n・1= on',18,45,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), '),(331,'商品情報 - セール割引の表示方法(割引額・パーセント)','SHOW_SALE_DISCOUNT','1','セール割引の表示方法を設定します。<br /><br />\r\n・1= 割引率(%) でのoff<br />\r\n・2= 割引金額 でのoff',18,46,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'1\', \'2\'), '),(332,'商品情報 - 割引率表示の小数点','SHOW_SALE_DISCOUNT_DECIMALS','0','割引率表示のパーセントの小数点位置を設定します。<br /><br />\r\n・デフォルト= 0',18,47,NULL,'2009-11-19 12:39:39',NULL,NULL),(333,'商品情報- 無料商品の画像・テキストのステータス','OTHER_IMAGE_PRICE_IS_FREE_ON','1','商品情報での無料商品の画像・イメージの表示を設定します。<br />\r\n<br />\r\n・0= Text<br />\r\n・1= Image',18,50,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), '),(334,'商品情報 - お問い合わせ商品表示設定','PRODUCTS_PRICE_IS_CALL_IMAGE_ON','1','お問い合わせ商品であることを表示する画像またはテキストについて設定します。<br /><br />\r\n・0= テキスト<br />\r\n・1= 画像',18,51,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), '),(335,'商品の数量欄 - 新しく商品を追加する際に','PRODUCTS_QTY_BOX_STATUS','1','新しく商品を登録する際、商品の数量欄のデフォルト設定をどうしますか?<br /><br />\r\n・0= off<br />\r\n・1= on<br />\r\n注意：onにすると数量欄を表示し、「カートに加える」もonになります。(This will show a Qty Box when ON and default the Add to Cart to 1)',18,55,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), '),(336,'商品レビュー - 承認の要否','REVIEWS_APPROVAL','1','商品レビューの表示には承認が必要にしますか?<br /><br />\r\n・0= off<br />\r\n・1= on<br />\r\n注意：レビューが非表示設定になっている場合は無視されます。',18,62,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), '),(337,'METAタグ - TITLEタグへの商品価格表示','META_TAG_INCLUDE_PRICE','1','TITLEタグに商品価格を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1= on',18,70,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), '),(338,'METAタグ - Meta Descriptionの長さ','MAX_META_TAG_DESCRIPTION_LENGTH','50','Meta Descriptionの最大の長さを設定してください。<br />デフォルトの最大値(ワード数)：50',18,71,NULL,'2009-11-19 12:39:39','',''),(339,'「こんな商品も購入しています」 - 横列あたりの表示点数','SHOW_PRODUCT_INFO_COLUMNS_ALSO_PURCHASED_PRODUCTS','3','「こんな商品も買っています」の横列(Row)あたりの表示点数を設定します。<br />0= off またはソート順を設定',18,72,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\', \'5\', \'6\', \'7\', \'8\', \'9\', \'10\', \'11\', \'12\'), '),(340,'[前へ] [次へ] - ナビゲーションバーの位置','PRODUCT_INFO_PREVIOUS_NEXT','1','[前へ] [次へ] ナビゲーションバーの位置を設定します。<br /><br />\r\n・0= off<br />\r\n・1= ページ上部<br />\r\n・2= ページ下部<br />\r\n・3= ページ上部・下部',18,21,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Off\'), array(\'id\'=>\'1\', \'text\'=>\'Top of Page\'), array(\'id\'=>\'2\', \'text\'=>\'Bottom of Page\'), array(\'id\'=>\'3\', \'text\'=>\'Both Top & Bottom of Page\')),'),(341,'[前へ] [次へ] - ソート順','PRODUCT_INFO_PREVIOUS_NEXT_SORT','1','商品のソート順を設定します。\r\n<br /><br />\r\n・0= 商品ID<br />\r\n・1= 商品名<br />\r\n・2= 型番<br />\r\n・3= 価格、商品名<br />\r\n・4= 価格、型番<br />\r\n・5= 商品名, 型番',18,22,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Product ID\'), array(\'id\'=>\'1\', \'text\'=>\'Name\'), array(\'id\'=>\'2\', \'text\'=>\'Product Model\'), array(\'id\'=>\'3\', \'text\'=>\'Product Price - Name\'), array(\'id\'=>\'4\', \'text\'=>\'Product Price - Model\'), array(\'id\'=>\'5\', \'text\'=>\'Product Name - Model\'), array(\'id\'=>\'6\', \'text\'=>\'Product Sort Order\')),'),(342,'[前へ] [次へ] - ボタンと画像のステータス','SHOW_PREVIOUS_NEXT_STATUS','0','ボタンと画像のステータスを設定します。<br /><br />\r\n・0= Off<br />\r\n・1= On',18,20,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Off\'), array(\'id\'=>\'1\', \'text\'=>\'On\')),'),(343,'[前へ] [次へ] - ボタンと画像の表示設定','SHOW_PREVIOUS_NEXT_IMAGES','0','[前へ] [次へ] のボタンと画像の表示を設定します。<br /><br />\r\n・0= ボタンのみ<br />\r\n・1= ボタン・商品画像<br />\r\n・2= 商品画像のみ',18,21,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Button Only\'), array(\'id\'=>\'1\', \'text\'=>\'Button and Product Image\'), array(\'id\'=>\'2\', \'text\'=>\'Product Image Only\')),'),(344,'[前へ] [次へ] - 画像の横幅','PREVIOUS_NEXT_IMAGE_WIDTH','50','[前へ] [次へ] 画像の横幅の横幅は?',18,22,NULL,'2009-11-19 12:39:39','',''),(345,'[前へ] [次へ] - 画像の高さ','PREVIOUS_NEXT_IMAGE_HEIGHT','40','[前へ] [次へ] 画像の横幅の高さは?',18,23,NULL,'2009-11-19 12:39:39','',''),(346,'[前へ] [次へ] - カテゴリ名と画像の配置','PRODUCT_INFO_CATEGORIES','1','[前へ] [次へ] のカテゴリの画像と名称の配置は?<br /><br />\r\n・0= off<br />\r\n・1= 左に配置<br />\r\n・2= 中央に配置<br />\r\n・3= 右に配置',18,20,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Off\'), array(\'id\'=>\'1\', \'text\'=>\'Align Left\'), array(\'id\'=>\'2\', \'text\'=>\'Align Center\'), array(\'id\'=>\'3\', \'text\'=>\'Align Right\')),'),(347,'左側サイドボックスの横幅','BOX_WIDTH_LEFT','150px','左側に表示されるサイドボックスの横幅を設定します。pxを含めて入力できます。\r\n<br /><br />\r\n・デフォルト = 150px',19,1,NULL,'2003-11-21 22:16:36',NULL,NULL),(348,'右側サイドボックスの横幅','BOX_WIDTH_RIGHT','150px','右側に表示されるサイドボックスの横幅を設定します。pxを含めて入力できます。<br /><br />\r\n・Default = 150px',19,2,NULL,'2003-11-21 22:16:36',NULL,NULL),(349,'パン屑リストの区切り文字','BREAD_CRUMBS_SEPARATOR','&nbsp;::&nbsp;','パン屑リストの区切り文字を設定します。<br /><br />\r\n【注意】空白を含む場合は&amp;nbsp;を使用することができます。<br />\r\n・デフォルト = &amp;nbsp;::&amp;nbsp;',19,3,NULL,'2003-11-21 22:16:36',NULL,'zen_cfg_textarea_small('),(350,'パン屑リストの設定','DEFINE_BREADCRUMB_STATUS','1','パン屑リストのリンクを有効にしますか?<br />0= OFF<br />1= ON',19,4,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), '),(351,'ベストセラー - 桁数合わせ文字','BEST_SELLERS_FILLER','&nbsp;','桁数を合わせるために挿入する文字を設定します。<br />デフォルト = &amp;nbsp;(空白)',19,5,NULL,'2003-11-21 22:16:36',NULL,'zen_cfg_textarea_small('),(352,'ベストセラー - 表示文字数','BEST_SELLERS_TRUNCATE','35','ベストセラーのサイドボックスで表示する商品名の長さを設定します。<br />デフォルト = 35',19,6,NULL,'2003-11-21 22:16:36',NULL,NULL),(353,'ベストセラー - 表示文字数を超えた場合に「...」を表示','BEST_SELLERS_TRUNCATE_MORE','true','商品名が途中で切れた場合に「...」を表示します。<br />デフォルト = true',19,7,'2003-03-21 13:08:25','2003-03-21 11:42:47',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),'),(354,'カテゴリボックス - 特価商品のリンク表示','SHOW_CATEGORIES_BOX_SPECIALS','true','カテゴリボックスに特価商品のリンクを表示します。',19,8,'2003-03-21 13:08:25','2003-03-21 11:42:47',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),'),(355,'カテゴリボックス - 新着商品のリンク表示','SHOW_CATEGORIES_BOX_PRODUCTS_NEW','true','カテゴリボックスに新着商品へのリンクを表示します。',19,9,'2003-03-21 13:08:25','2003-03-21 11:42:47',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),'),(356,'ショッピングカートボックスの表示','SHOW_SHOPPING_CART_BOX_STATUS','1','ショッピングカートの表示を設定します。<br />\r\n<br />\r\n・0= 常に表示<br />\r\n・1= 商品が入っているときだけ表示<br />\r\n・2= 商品が入っているときに表示するが、ショッピングカートページでは表示しない',19,10,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), '),(357,'カテゴリボックス - おすすめ商品へのリンクを表示','SHOW_CATEGORIES_BOX_FEATURED_PRODUCTS','true','カテゴリボックスにおすすめ商品へのリンクを表示しますか?',19,11,'2003-03-21 13:08:25','2003-03-21 11:42:47',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),'),(358,'カテゴリボックス - 全商品リストへのリンクを表示','SHOW_CATEGORIES_BOX_PRODUCTS_ALL','true','カテゴリボックスに全商品リストへのリンクを表示しますか?',19,12,'2003-03-21 13:08:25','2003-03-21 11:42:47',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),'),(359,'左側カラムの表示','COLUMN_LEFT_STATUS','1','左側カラムを表示しますか? (ページをオーバーライドするものがない場合)<br /><br />\r\n・0= 常に非表示<br />\r\n1= オーバーライドがなければ表示',19,15,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), '),(360,'右側カラムの表示','COLUMN_RIGHT_STATUS','1','右側カラムを表示しますか? (ページをオーバーライドするものがない場合)<br /><br />\r\n・0= 常に非表示<br />\r\n・1= オーバーライドがなければ表示',19,16,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), '),(361,'左側カラムの横幅','COLUMN_WIDTH_LEFT','150px','左側カラムの横幅を設定します。pxを含めて指定可能。<br /><br />\r\nデフォルト = 150px',19,20,NULL,'2003-11-21 22:16:36',NULL,NULL),(362,'右側カラムの横幅','COLUMN_WIDTH_RIGHT','150px','右側カラムの横幅を設定します。pxを含めて指定可能。<br /><br />\r\nデフォルト = 150px',19,21,NULL,'2003-11-21 22:16:36',NULL,NULL),(363,'カテゴリ名・リンク間の区切り','SHOW_CATEGORIES_SEPARATOR_LINK','1','カテゴリ名とリンク（「おすすめ商品」など）の間にセパレータ(区切り)を表示しますか?<br /><br />\r\n・0= off<br />\r\n・1= on',19,24,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), '),(364,'カテゴリの区切り - カテゴリ名・商品数','CATEGORIES_SEPARATOR','-&gt;','カテゴリ名と(カテゴリ内の)商品数の間のセパレータ(区切り)は何にしますか?<br /><br />\r\nデフォルト = -&amp;gt;',19,25,NULL,'2003-11-21 22:16:36',NULL,'zen_cfg_textarea_small('),(365,'カテゴリの区切り - カテゴリ名とサブカテゴリ名の間','CATEGORIES_SEPARATOR_SUBS','|_&nbsp;','カテゴリ名・サブカテゴリ名の間のセパレータ(区切り)は何にしますか?<br />\r\n<br />\r\nデフォルト = |_&amp;nbsp;',19,26,NULL,'2004-03-25 22:16:36',NULL,'zen_cfg_textarea_small('),(366,'カテゴリ内商品数の接頭辞(Prefix)','CATEGORIES_COUNT_PREFIX','&nbsp;(','カテゴリ内の商品数表示の接頭辞(Prefix)は?\r\n<br /><br />\r\n・デフォルト= (',19,27,NULL,'2003-01-21 22:16:36',NULL,'zen_cfg_textarea_small('),(367,'カテゴリ内商品数の接尾辞(Suffix)','CATEGORIES_COUNT_SUFFIX',')','カテゴリ内の商品数表示の接尾辞(Suffix)は?\r\n<br /><br />\r\n・デフォルト= )',19,28,NULL,'2003-01-21 22:16:36',NULL,'zen_cfg_textarea_small('),(368,'カテゴリ・サブカテゴリのインデント','CATEGORIES_SUBCATEGORIES_INDENT','&nbsp;&nbsp;','サブカテゴリをインデント(字下げ)表示する際の文字・記号は?<br /><br />\r\n・デフォルト = &nbsp;&nbsp;',19,29,NULL,'2004-06-24 22:16:36',NULL,'zen_cfg_textarea_small('),(369,'商品登録0のカテゴリ - 表示・非表示','CATEGORIES_COUNT_ZERO','0','商品数が0のカテゴリを表示しますか?<br />\r\n<br />\r\n・0 = off<br />\r\n・1 = on',19,30,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), '),(370,'カテゴリボックスのスプリット(分割)表示','CATEGORIES_SPLIT_DISPLAY','True','商品タイプによってカテゴリボックスをスプリット(分割)表示するかどうかを設定します。',19,31,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'True\', \'False\'), '),(371,'ショッピングカート - 合計を表示','SHOW_TOTALS_IN_CART','1','合計額をショッピングカートの上に表示しますか?<br />・0= off<br />・1= on: 商品の数量、重量合計<br />・2= on: 商品の数量、重量合計(0のときには非表示)<br />・3= on: 商品の数量合計',19,31,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'), '),(372,'顧客への挨拶 - トップページに表示','SHOW_CUSTOMER_GREETING','1','顧客への歓迎メッセージを常にトップページに表示しますか?<br />0= off<br />1= on',19,40,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), '),(373,'カテゴリ - トップページに表示','SHOW_CATEGORIES_ALWAYS','0','カテゴリを常にトップページに表示しますか?<br />\r\n・0= off<br />\r\n・1= on<br />\r\n・Default category can be set to Top Level or a Specific Top Level',19,45,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), '),(374,'カテゴリ - トップページ での開閉','CATEGORIES_START_MAIN','0','トップページにおけるカテゴリの開閉状態を設定します。<br />\r\n・0= トップレベル(親)カテゴリのみ<br />\r\n・特定のカテゴリを開くにはカテゴリIDで指定。サブカテゴリも指定可能。<br />\r\n【例】3_10 (カテゴリID:3、サブカテゴリID:10)',19,46,NULL,'2009-11-19 12:39:39','',''),(375,'カテゴリ - サブカテゴリを常に開いておく','SHOW_CATEGORIES_SUBCATEGORIES_ALWAYS','1','カテゴリとサブカテゴリは常に表示しますか?<br />0= OFF 親カテゴリのみ<br />1= ON カテゴリ・サブカテゴリは選択されたら常に表示',19,47,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), '),(376,'バナー表示グループ - ヘッダポジション1','SHOW_BANNERS_GROUP_SET1','','どのバナーグループをヘッダポジション1に使用しますか? 使わない場合は未記入にします。<br />\r\n<br />\r\nバナー表示グループは1つ(1バナーグループ)または複数(マルチバナーグループ)にすることもできます。マルチバナーグループを表示するためにはグループ名をコロン(<strong>:</strong>)で区切って入力します。<br />\r\n例：Wide-Banners:SideBox-Banners',19,55,NULL,'2009-11-19 12:39:39','',''),(377,'バナー表示グループ - ヘッダポジション2','SHOW_BANNERS_GROUP_SET2','','どのバナーグループをヘッダポジション2に使用しますか? 使わない場合は未記入にします。<br />\r\n<br />\r\nバナー表示グループは1つ(1バナーグループ)または複数(マルチバナーグループ)にすることもできます。マルチバナーグループを表示するためにはグループ名をコロン(<strong>:</strong>)で区切って入力します。<br />\r\n例：Wide-Banners:SideBox-Banners',19,56,NULL,'2009-11-19 12:39:39','',''),(378,'バナー表示グループ - ヘッダポジション3','SHOW_BANNERS_GROUP_SET3','','どのバナーグループをヘッダポジション3に使用しますか? 使わない場合は未記入にします。<br />\r\n<br />\r\nバナー表示グループは1つ(1バナーグループ)または複数(マルチバナーグループ)にすることもできます。マルチバナーグループを表示するためにはグループ名をコロン(<strong>:</strong>)で区切って入力します。<br />\r\n例：Wide-Banners:SideBox-Banners',19,57,NULL,'2009-11-19 12:39:39','',''),(379,'バナー表示グループ - フッタポジション1','SHOW_BANNERS_GROUP_SET4','','どのバナーグループをフッタポジション1に使用しますか? 使わない場合は未記入にします。<br />\r\n<br />\r\nバナー表示グループは1つ(1バナーグループ)または複数(マルチバナーグループ)にすることもできます。マルチバナーグループを表示するためにはグループ名をコロン(<strong>:</strong>)で区切って入力します。<br />\r\n例：Wide-Banners:SideBox-Banners',19,65,NULL,'2009-11-19 12:39:39','',''),(380,'バナー表示グループ - フッタポジション2','SHOW_BANNERS_GROUP_SET5','','どのバナーグループをフッタポジション2に使用しますか? 使わない場合は未記入にします。<br />\r\n<br />\r\nバナー表示グループは1つ(1バナーグループ)または複数(マルチバナーグループ)にすることもできます。マルチバナーグループを表示するためにはグループ名をコロン(<strong>:</strong>)で区切って入力します。<br />\r\n例：Wide-Banners:SideBox-Banners',19,66,NULL,'2009-11-19 12:39:39','',''),(381,'バナー表示グループ - フッタポジション3','SHOW_BANNERS_GROUP_SET6','Wide-Banners','どのバナーグループをフッタポジション3に使用しますか? 使わない場合は未記入にします。<br />\r\n<br />\r\nバナー表示グループは1つ(1バナーグループ)または複数(マルチバナーグループ)にすることもできます。マルチバナーグループを表示するためにはグループ名をコロン(<strong>:</strong>)で区切って入力します。<br />\r\n例：Wide-Banners:SideBox-Banners',19,67,NULL,'2009-11-19 12:39:39','',''),(382,'バナー表示グループ - サイドボックス内バナーボックス','SHOW_BANNERS_GROUP_SET7','SideBox-Banners','どのバナーグループをサイドボックス内バナーボックス2に使用しますか? 使わない場合は未記入にします。<br />\r\nデフォルトのグループはSideBox-Bannersです。<br />\r\n<br />\r\nバナー表示グループは1つ(1バナーグループ)または複数(マルチバナーグループ)にすることもできます。マルチバナーグループを表示するためにはグループ名をコロン(<strong>:</strong>)で区切って入力します。<br />\r\n例：Wide-Banners:SideBox-Banners',19,70,NULL,'2009-11-19 12:39:39','',''),(383,'バナー表示グループ - サイドボックス内バナーボックス2','SHOW_BANNERS_GROUP_SET8','SideBox-Banners','どのバナーグループをサイドボックス内バナーボックス2に使用しますか? 使わない場合は未記入にします。<br />\r\nデフォルトのグループはSideBox-Bannersです。<br />\r\n<br />\r\nバナー表示グループは1つ(1バナーグループ)または複数(マルチバナーグループ)にすることもできます。マルチバナーグループを表示するためにはグループ名をコロン(<strong>:</strong>)で区切って入力します。<br />\r\n例：Wide-Banners:SideBox-Banners',19,71,NULL,'2009-11-19 12:39:39','',''),(384,'バナー表示グループ - サイドボックス内バナーボックス全て','SHOW_BANNERS_GROUP_SET_ALL','BannersAll','サイドボックス内バナーボックス全て(Banner All sidebox)で表示するバナー表示グループは、1つです。デフォルトのグループはBannersAllです。どのバナーグループをサイドボックスのbanner_box_allに表示しますか?<br />表示しない場合は空欄にしてください。',19,72,NULL,'2009-11-19 12:39:39','',''),(385,'フッタ - IPアドレスの表示・非表示','SHOW_FOOTER_IP','1','顧客のIPアドレスをフッタに表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1= on<br />',19,80,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), '),(386,'数量割引 - 追加割引レベル数','DISCOUNT_QTY_ADD','5','数量割引の割引レベルの追加数を指定します。一つの割引レベルに一つの割引設定を行うことができます。',19,90,NULL,'2009-11-19 12:39:39','',''),(387,'数量割引 - 一行あたりの表示数','DISCOUNT_QUANTITY_PRICES_COLUMN','5','商品情報ページで表示する数量割引設定の一行あたり表示数を指定します。割引設定数（割引レベル数）が一行あたりの表示数を超えた場合は、複数行で表示されます。',19,95,NULL,'2009-11-19 12:39:39','',''),(388,'カテゴリ/商品のソート順','CATEGORIES_PRODUCTS_SORT_ORDER','0','カテゴリ/商品のソート順を設定します。<br />0= カテゴリ/商品 ソート順/名前<br />1= カテゴリ/商品 名前<br />2= 商品モデル<br />3= 商品数量+, 商品名<br />4= 商品数量-, 商品名<br />5= 商品価格+, 商品名<br />6= 商品価格+, 商品名',19,100,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\', \'5\', \'6\'), '),(389,'オプション名/オプション値の追加・コピー・削除','OPTION_NAMES_VALUES_GLOBAL_STATUS','1','オプション名/オプション値の追加・コピー・削除の機能についてのグローバルな設定を行います。<br />0= 機能を隠す<br />1= 機能を表示する<br />2= 商品モデル',19,110,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), '),(390,'カテゴリ - タブメニュー','CATEGORIES_TABS_STATUS','1','カテゴリ - タブをオンにするとショップ画面のヘッダ部分にカテゴリが表示されます。さまざまな応用ができるでしょう。<br />0= カテゴリのタブを隠す<br />1= カテゴリのタブを表示',19,112,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), '),(391,'サイトマップ - Myページの表示','SHOW_ACCOUNT_LINKS_ON_SITE_MAP','No','Myページのリンクをサイトマップに表示しますか?<br />注意：サーチエンジンのクローラーがこのページをインデックスしようとしてログインページに誘導されてしまう可能性があり、お勧めしません。<br /><br />デフォルト：false (表示しない)',19,115,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'Yes\', \'No\'), '),(392,'1商品だけのカテゴリの表示をスキップ','SKIP_SINGLE_PRODUCT_CATEGORIES','False','商品が1つだけのカテゴリの表示をスキップしますか?<br />このオプションがTrueの場合、ユーザーが商品が1つだけのカテゴリをクリックすると、Zen Cartは直接商品ページを表示するようになります。<br />デフォルト：True',19,120,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'True\', \'False\'), '),(393,'CSSボタン','IMAGE_USE_CSS_BUTTONS','No','CSS画像(gif/jpg)の代わりにボタンを表示しますか?<br />ONにした場合、ボタンのスタイルはスタイルシートで定義してください。',19,147,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'No\', \'Yes\'), '),(394,'<strong>「メンテナンス中」 オン/オフ</strong>','DOWN_FOR_MAINTENANCE','false','「メンテナンス中」の表示について設定します。<br />\r\n<br />\r\n・true=on\r\n・false=off',20,1,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(395,'「メンテナンス中」- 表示するファイル','DOWN_FOR_MAINTENANCE_FILENAME','down_for_maintenance','メンテナンス中に表示するファイルのファイル名を設定します。デフォルトは\"down_for_maintenance\"です。<br /><br />\r\n【注意】拡張子は付けないでください。',20,2,NULL,'2009-11-19 12:39:39',NULL,''),(396,'「メンテナンス中」- ヘッダを隠す','DOWN_FOR_MAINTENANCE_HEADER_OFF','false','「メンテナンス中」表示モードの際、ヘッダを隠しますか?<br /><br />\r\n・true=hide<br />\r\n・false=show',20,3,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(397,'「メンテナンス中」- 左カラムを隠す','DOWN_FOR_MAINTENANCE_COLUMN_LEFT_OFF','false','「メンテナンス中」表示モードの際、左カラムを隠しますか?<br /><br />\r\n・true=hide<br />\r\n・false=show',20,4,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(398,'「メンテナンス中」- 右カラムを隠す','DOWN_FOR_MAINTENANCE_COLUMN_RIGHT_OFF','false','「メンテナンス中」表示モードの際、右カラムを隠しますか?<br /><br />\r\n・true=hide<br />\r\n・false=show',20,5,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(399,'「メンテナンス中」- フッタを隠す','DOWN_FOR_MAINTENANCE_FOOTER_OFF','false','「メンテナンス中」表示モードの際、フッタを隠しますか?<br /><br />\r\n・true=hide<br />\r\n・false=show',20,6,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(400,'「メンテナンス中」- 価格を表示しない','DOWN_FOR_MAINTENANCE_PRICES_OFF','false','「メンテナンス中」表示モードの際、商品価格を隠しますか?<br /><br />\r\n・true=hide<br />\r\n・false=show',20,7,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(401,'「メンテナンス中」- 設定したIPアドレスを除く','EXCLUDE_ADMIN_IP_FOR_MAINTENANCE','your IP (ADMIN)','ショップ管理者用などに、「メンテナンス中」表示モードの際でもアクセス可能なIPアドレスを設定しますか?<br /><br />\r\n複数のIPアドレスを指定するにはカンマ(,)で区切ります。また、あなたのアクセス元のIPアドレスがわからない場合は、ショップのフッタに表示されるIPアドレスをチェックしてください。',20,8,'2003-03-21 13:43:22','2003-03-21 21:20:07',NULL,NULL),(402,'「メンテナンス予告(NOTICE PUBLIC)」-  オン/オフ','WARN_BEFORE_DOWN_FOR_MAINTENANCE','false','ショップの「メンテナンス中」表示を出す前に告知を出しますか?<br /><br />\r\n・true=on<br />\r\n・false=off<br />\r\n注意：「メンテナンス中」表示が有効になると、この設定は自動的にfalseに書き換えられます。',20,9,'2003-03-21 13:08:25','2003-03-21 11:42:47',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),'),(403,'「メンテナンス予告」- メッセージに表示する日時','PERIOD_BEFORE_DOWN_FOR_MAINTENANCE','15/05/2003  2-3 PM','ヘッダに表示するメンテナンス予告メッセージの開始日と時間を設定します。',20,10,'2003-03-21 13:08:25','2003-03-21 11:42:47',NULL,NULL),(404,'「メンテナンス中」- メンテナンスを開始した日時(when webmaster has enabled maintenance)を表示','DISPLAY_MAINTENANCE_TIME','false','ショップ管理者がいつ「メンテナンス中」表示をオンにしたか表示しますか?<br /><br />\r\n・true=on<br />\r\n・false=off',20,11,'2003-03-21 13:08:25','2003-03-21 11:42:47',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),'),(405,'「メンテナンス中」- メンテナンス期間を表示','DISPLAY_MAINTENANCE_PERIOD','false','メンテナンスの期間を表示しますか?<br /><br />\r\n・true=on<br />\r\n・false=off',20,12,'2003-03-21 13:08:25','2003-03-21 11:42:47',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),'),(406,'メンテナンス期間','TEXT_MAINTENANCE_PERIOD_TIME','2h00','メンテナンス期間を設定します。<br />\r\n書式：(hh:mm)<br />h = 時間　m = 分',20,13,'2003-03-21 13:08:25','2003-03-21 11:42:47',NULL,NULL),(407,'チェックアウト時に「ご利用規約」確認画面を表示','DISPLAY_CONDITIONS_ON_CHECKOUT','false','チェックアウトの際に「ご利用規約」の画面を表示しますか?',11,1,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(408,'アカウント作成時に個人情報保護方針確認画面を表示','DISPLAY_PRIVACY_CONDITIONS','true','アカウント作成の際、個人情報保護方針への同意画面を表示しますか?<br /><div style=\"color: red;\">注意：「個人情報保護法」では、個人情報保護方針を開示することが求められています。</div>',11,2,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(409,'商品画像を表示','PRODUCT_NEW_LIST_IMAGE','1102','商品画像を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',21,1,NULL,'2009-11-19 12:39:39',NULL,NULL),(410,'商品の数量を表示','PRODUCT_NEW_LIST_QUANTITY','1202','商品数量を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',21,2,NULL,'2009-11-19 12:39:39',NULL,NULL),(411,'「今すぐ買う」ボタンの表示','PRODUCT_NEW_BUY_NOW','1300','「今すぐ買う」ボタンを表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',21,3,NULL,'2009-11-19 12:39:39',NULL,NULL),(412,'商品名の表示','PRODUCT_NEW_LIST_NAME','2101','商品名を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',21,4,NULL,'2009-11-19 12:39:39',NULL,NULL),(413,'商品型番の表示','PRODUCT_NEW_LIST_MODEL','2201','商品型番を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',21,5,NULL,'2009-11-19 12:39:39',NULL,NULL),(414,'商品メーカーの表示','PRODUCT_NEW_LIST_MANUFACTURER','2302','商品メーカーを表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',21,6,NULL,'2009-11-19 12:39:39',NULL,NULL),(415,'商品価格の表示','PRODUCT_NEW_LIST_PRICE','2402','商品価格を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',21,7,NULL,'2009-11-19 12:39:39',NULL,NULL),(416,'商品重量の表示','PRODUCT_NEW_LIST_WEIGHT','2502','商品の重量を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',21,8,NULL,'2009-11-19 12:39:39',NULL,NULL),(417,'商品登録日の表示','PRODUCT_NEW_LIST_DATE_ADDED','2601','商品登録日を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',21,9,NULL,'2009-11-19 12:39:39',NULL,NULL),(418,'商品説明の表示','PRODUCT_NEW_LIST_DESCRIPTION','1','商品説明(最初の150文字)を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1= on',21,10,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), '),(419,'商品の表示 - デフォルトのソート順','PRODUCT_NEW_LIST_SORT_DEFAULT','6','新着商品リストの表示のデフォルトのソート順は? デフォルト値は6です。<br /><br />\r\n・1= 商品名<br />\r\n・2= 商品名(降順)<br />\r\n・3= 価格が安いものから商品名<br />\r\n・4= 価格が高いものから商品名<br />\r\n・5= 型番<br />\r\n・6= 商品登録日(降順)<br />\r\n・7= 商品登録日<br />\r\n・8= 商品順(Product Sort)\r\n',21,11,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'1\', \'2\', \'3\', \'4\', \'5\', \'6\', \'7\', \'8\'), '),(420,'新着商品 - デフォルトのグループID','PRODUCT_NEW_LIST_GROUP_ID','21','新着商品リストの設定グループID(configuration_group_id)は何ですか?<br />\r\n<br />\r\n注意：全商品リストのグループIDがデフォルトの21から変更されたときだけ設定してください。',21,12,NULL,'2009-11-19 12:39:39',NULL,NULL),(421,'複数商品の数量欄の有無・表示位置','PRODUCT_NEW_LISTING_MULTIPLE_ADD_TO_CART','3','複数商品の数量欄の表示の有無と表示位置について設定します。<br />0= off<br />1= 上部<br />2= 下部<br />3= 両方',21,25,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'), '),(422,'商品画像の表示','PRODUCT_FEATURED_LIST_IMAGE','1102','商品画像を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />\r\n',22,1,NULL,'2009-11-19 12:39:39',NULL,NULL),(423,'商品数量の表示','PRODUCT_FEATURED_LIST_QUANTITY','1202','商品数量を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />\r\n',22,2,NULL,'2009-11-19 12:39:39',NULL,NULL),(424,'「今すぐ買う」ボタンの表示','PRODUCT_FEATURED_BUY_NOW','1300','「今すぐ買う」ボタンを表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',22,3,NULL,'2009-11-19 12:39:39',NULL,NULL),(425,'商品名の表示','PRODUCT_FEATURED_LIST_NAME','2101','商品名を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',22,4,NULL,'2009-11-19 12:39:39',NULL,NULL),(426,'商品型番の表示','PRODUCT_FEATURED_LIST_MODEL','2201','商品型番を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',22,5,NULL,'2009-11-19 12:39:39',NULL,NULL),(427,'商品メーカーの表示','PRODUCT_FEATURED_LIST_MANUFACTURER','2302','商品メーカーを表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',22,6,NULL,'2009-11-19 12:39:39',NULL,NULL),(428,'商品価格の表示','PRODUCT_FEATURED_LIST_PRICE','2402','商品価格を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',22,7,NULL,'2009-11-19 12:39:39',NULL,NULL),(429,'商品重量の表示','PRODUCT_FEATURED_LIST_WEIGHT','2502','商品重量を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',22,8,NULL,'2009-11-19 12:39:39',NULL,NULL),(430,'商品登録日の表示','PRODUCT_FEATURED_LIST_DATE_ADDED','2601','商品登録日を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',22,9,NULL,'2009-11-19 12:39:39',NULL,NULL),(431,'商品説明の表示','PRODUCT_FEATURED_LIST_DESCRIPTION','1','商品説明(最初の150文字)を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1= on',22,10,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), '),(432,'商品表示 - デフォルトのソート順','PRODUCT_FEATURED_LIST_SORT_DEFAULT','1','おすすめ商品リストの表示のデフォルトのソート順は? デフォルト値は1です。<br />\r\n<br />\r\n・1= 商品名<br />\r\n・2= 商品名(降順)<br />\r\n・3= 価格が安いものから、商品名<br />\r\n・4= 価格が高いものから、商品名<br />\r\n・5= 型番<br />\r\n・6= 商品登録日(降順)<br />\r\n・7= 商品登録日<br />\r\n・8= 商品順(Product Sort)',22,11,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'1\', \'2\', \'3\', \'4\', \'5\', \'6\', \'7\', \'8\'), '),(433,'おすすめ商品 - デフォルトのグループID','PRODUCT_FEATURED_LIST_GROUP_ID','22','おすすめ商品リストの設定グループID(configuration_group_id)は何ですか?<br />\r\n<br />\r\n注意：おすすめ商品リストのグループIDがデフォルトの22から変更されたときだけ設定してください。\r\n',22,12,NULL,'2009-11-19 12:39:39',NULL,NULL),(434,'複数商品の数量欄の有無・表示位置','PRODUCT_FEATURED_LISTING_MULTIPLE_ADD_TO_CART','3','複数商品の数量欄の表示の有無と表示位置について設定します。<br />0= off<br />1= 上部<br />2= 下部<br />3= 両方',22,25,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'), '),(435,'商品画像の表示','PRODUCT_ALL_LIST_IMAGE','1102','商品画像を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',23,1,NULL,'2009-11-19 12:39:39',NULL,NULL),(436,'商品数量の表示','PRODUCT_ALL_LIST_QUANTITY','1202','商品数量を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',23,2,NULL,'2009-11-19 12:39:39',NULL,NULL),(437,'「今すぐ買う」ボタンの表示','PRODUCT_ALL_BUY_NOW','1300','「今すぐ買う」ボタンを表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',23,3,NULL,'2009-11-19 12:39:39',NULL,NULL),(438,'商品価格の表示','PRODUCT_ALL_LIST_NAME','2101','商品価格を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',23,4,NULL,'2009-11-19 12:39:39',NULL,NULL),(439,'商品型番の表示','PRODUCT_ALL_LIST_MODEL','2201','商品型番を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',23,5,NULL,'2009-11-19 12:39:39',NULL,NULL),(440,'商品メーカーの表示','PRODUCT_ALL_LIST_MANUFACTURER','2302','商品メーカーを表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',23,6,NULL,'2009-11-19 12:39:39',NULL,NULL),(441,'商品価格の表示','PRODUCT_ALL_LIST_PRICE','2402','商品価格を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',23,7,NULL,'2009-11-19 12:39:39',NULL,NULL),(442,'商品重量の表示','PRODUCT_ALL_LIST_WEIGHT','2502','商品重量を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',23,8,NULL,'2009-11-19 12:39:39',NULL,NULL),(443,'商品登録日の表示','PRODUCT_ALL_LIST_DATE_ADDED','2601','商品登録日を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',23,9,NULL,'2009-11-19 12:39:39',NULL,NULL),(444,'商品説明の表示','PRODUCT_ALL_LIST_DESCRIPTION','1','商品説明(最初の150文字)を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1= on',23,10,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), '),(445,'商品表示 - デフォルトのソート順','PRODUCT_ALL_LIST_SORT_DEFAULT','1','全商品リストの表示のデフォルトのソート順は? デフォルト値は1です。<br />\r\n<br />\r\n・1= 商品名<br />\r\n・2= 商品名(降順)<br />\r\n・3= 価格が安いものから、商品名<br />\r\n・4= 価格が高いものから、商品名<br />\r\n・5= 型番<br />\r\n・6= 商品登録日(降順)<br />\r\n・7= 商品登録日<br />\r\n・8= 商品順(Product Sort)',23,11,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'1\', \'2\', \'3\', \'4\', \'5\', \'6\', \'7\', \'8\'), '),(446,'全商品リスト - デフォルトのグループID','PRODUCT_ALL_LIST_GROUP_ID','23','全商品リストの設定グループID(configuration_group_id)は?<br />\r\n<br />\r\n注意：全商品リストのグループIDがデフォルトの23から変更されたときだけ設定してください。\r\n',23,12,NULL,'2009-11-19 12:39:39',NULL,NULL),(447,'複数商品の数量欄の有無・表示位置','PRODUCT_ALL_LISTING_MULTIPLE_ADD_TO_CART','3','複数商品の数量欄の表示の有無と表示位置について設定します。<br />0= off<br />1= 上部<br />2= 下部<br />3= 両方',23,25,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'), '),(448,'新着商品をトップページに表示する','SHOW_PRODUCT_INFO_MAIN_NEW_PRODUCTS','1','新着商品をトップページに表示 しますか?\r\n<br />\r\n0= off<br />\r\nまたは表示順を数値(1〜4)で設定してください。\r\n',24,65,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), '),(449,'おすすめ商品をトップページに表示する','SHOW_PRODUCT_INFO_MAIN_FEATURED_PRODUCTS','2','おすすめ商品をトップページに表示 しますか?\r\n<br />\r\n0= off<br />\r\nまたは表示順を数値(1〜4)で設定してください。\r\n',24,66,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), '),(450,'特価商品をトップページに表示する','SHOW_PRODUCT_INFO_MAIN_SPECIALS_PRODUCTS','3','特価商品をトップページに表示 しますか?\r\n<br />\r\n0= off<br />\r\nまたは表示順を数値(1〜4)で設定してください。\r\n',24,67,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), '),(451,'入荷予定商品をトップページに表示する','SHOW_PRODUCT_INFO_MAIN_UPCOMING','4','入荷予定商品をトップページに表示 しますか?\r\n<br />\r\n0= off<br />\r\nまたは表示順を数値(1〜4)で設定してください。\r\n',24,68,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), '),(452,'新着商品をトップページに表示する - カテゴリ・サブカテゴリ共に\r\n','SHOW_PRODUCT_INFO_CATEGORY_NEW_PRODUCTS','1','新着商品を(トップレベル)カテゴリ・サブカテゴリ共にトップページに表示 しますか?\r\n<br />\r\n0= off<br />\r\nまたは表示順を数値(1〜4)で設定してください。\r\n',24,70,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), '),(453,'おすすめ商品をトップページに表示する - カテゴリ・サブカテゴリ共に','SHOW_PRODUCT_INFO_CATEGORY_FEATURED_PRODUCTS','2','おすすめ商品を(トップレベル)カテゴリ・サブカテゴリ共にトップページに表示 しますか?\r\n<br />\r\n0= off<br />\r\nまたは表示順を数値(1〜4)で設定してください。\r\n',24,71,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), '),(454,'特価商品をトップページに表示する - カテゴリ・サブカテゴリ共に','SHOW_PRODUCT_INFO_CATEGORY_SPECIALS_PRODUCTS','3','特価商品を(トップレベル)カテゴリ・サブカテゴリ共にトップページに表示 しますか?\r\n<br />\r\n0= off<br />\r\nまたは表示順を数値(1〜4)で設定してください。\r\n',24,72,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), '),(455,'入荷予定商品をトップページに表示する - カテゴリ・サブカテゴリ共に','SHOW_PRODUCT_INFO_CATEGORY_UPCOMING','4','入荷予定商品を(トップレベル)カテゴリ・サブカテゴリ共にトップページに表示 しますか?\r\n<br />\r\n0= off<br />\r\nまたは表示順を数値(1〜4)で設定してください。\r\n',24,73,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), '),(456,'新着商品をトップページに表示する - エラーとリンク切れ商品ページ','SHOW_PRODUCT_INFO_MISSING_NEW_PRODUCTS','1','新着予定商品をトップページに表示 しますか?\r\n(エラーとリンク切れ商品ページ・/* 訳注・意味不明 */)<br />\r\n0= off<br />\r\nまたは順番を数値(1〜4)で設定してください。',24,75,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), '),(457,'おすすめ商品をトップページに表示する - エラーとリンク切れ商品ページ','SHOW_PRODUCT_INFO_MISSING_FEATURED_PRODUCTS','2','おすすめ商品をトップページに表示 しますか?\r\n(エラーとリンク切れ商品ページ・/* 訳注・意味不明 */)<br />\r\n0= off<br />\r\nまたは順番を数値(1〜4)で設定してください。',24,76,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), '),(458,'特価商品をトップページに表示する - エラーとリンク切れ商品ページ','SHOW_PRODUCT_INFO_MISSING_SPECIALS_PRODUCTS','3','特価商品をトップページに表示 しますか?\r\n(エラーとリンク切れ商品ページ・/* 訳注・意味不明 */)<br />\r\n0= off<br />\r\nまたは順番を数値(1〜4)で設定してください。',24,77,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), '),(459,'入荷予定商品をトップページに表示する - エラーとリンク切れ商品ページ','SHOW_PRODUCT_INFO_MISSING_UPCOMING','4','入荷予定商品をトップページに表示 しますか?\r\n(エラーとリンク切れ商品ページ・/* 訳注・意味不明 */)<br />\r\n0= off<br />\r\nまたは順番を数値(1〜4)で設定してください。',24,78,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), '),(460,'新着商品を表示する - 商品リストの下部に','SHOW_PRODUCT_INFO_LISTING_BELOW_NEW_PRODUCTS','1','商品リストの下に新着商品を表示しますか?\r\n<br />0= off <br />\r\nまたは配置順を数値(1〜4)で設定してください。',24,85,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), '),(461,'おすすめ商品を表示する - 商品リストの下部に','SHOW_PRODUCT_INFO_LISTING_BELOW_FEATURED_PRODUCTS','2','商品リストの下におすすめ商品を表示しますか?\r\n<br />0= off <br />\r\nまたは配置順を数値(1〜4)で設定してください。',24,86,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), '),(462,'特価商品を表示する - 商品リストの下部に','SHOW_PRODUCT_INFO_LISTING_BELOW_SPECIALS_PRODUCTS','3','商品リストの下に特価商品を表示しますか?\r\n<br />0= off <br />\r\nまたは配置順を数値(1〜4)で設定してください。',24,87,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), '),(463,'入荷予定商品を表示する - 商品リストの下部に','SHOW_PRODUCT_INFO_LISTING_BELOW_UPCOMING','4','商品リストの下に入荷予定商品を表示しますか?\r\n<br />0= off <br />\r\nまたは配置順を数値(1〜4)で設定してください。',24,88,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), '),(464,'新着商品 - 横列あたりの表示点数','SHOW_PRODUCT_INFO_COLUMNS_NEW_PRODUCTS','3','新着商品の列(Row)あたりの配置点数を設定します。',24,95,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'1\', \'2\', \'3\', \'4\', \'5\', \'6\', \'7\', \'8\', \'9\', \'10\', \'11\', \'12\'), '),(465,'おすすめ商品 - 横列あたりの表示点数','SHOW_PRODUCT_INFO_COLUMNS_FEATURED_PRODUCTS','3','おすすめ商品の列(Row)あたりの配置点数を設定します。',24,96,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'1\', \'2\', \'3\', \'4\', \'5\', \'6\', \'7\', \'8\', \'9\', \'10\', \'11\', \'12\'), '),(466,'特価商品 - 横列あたりの表示点数','SHOW_PRODUCT_INFO_COLUMNS_SPECIALS_PRODUCTS','3','特価商品の列(Row)あたりの配置点数を設定します。',24,97,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'1\', \'2\', \'3\', \'4\', \'5\', \'6\', \'7\', \'8\', \'9\', \'10\', \'11\', \'12\'), '),(467,'トップレベル(親)カテゴリの商品リスト表示 - フィルタ表示・全商品表示','SHOW_PRODUCT_INFO_ALL_PRODUCTS','1','現在のメインカテゴリに商品リストが適用された際、商品をフィルタ表示しますか? それとも全カテゴリから商品を表示しますか?<br />\r\n・0= Filter\r\n・Off 1=Filter On',24,100,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), '),(468,'トップページの定義領域 - ステータス','DEFINE_MAIN_PAGE_STATUS','1','編集された領域の表示を行いますか?<br />0= リンク:表示　　編集領域:非表示<br />1= リンク:表示　　編集領域:表示<br />2= リンク:非表示　編集領域:表示<br />3= リンク:非表示　編集領域:非表示',25,60,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),'),(469,'「お問い合わせ」ページの表示 - ステータス','DEFINE_CONTACT_US_STATUS','1','編集された「お問い合わせ」テキストを表示しますか?<br />0= リンク:表示　　編集領域:非表示<br />1= リンク:表示　　編集領域:表示<br />2= リンク:非表示　編集領域:表示<br />3= リンク:非表示　編集領域:非表示',25,61,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),'),(470,'「個人情報保護方針」表示 - ステータス','DEFINE_PRIVACY_STATUS','1','編集された「個人情報保護方針」を表示しますか?<br />0= リンク:表示　　編集領域:非表示<br />1= リンク:表示　　編集領域:表示<br />2= リンク:非表示　編集領域:表示<br />3= リンク:非表示　編集領域:非表示',25,62,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),'),(471,'「配送・送料について」 ページ - ステータス','DEFINE_SHIPPINGINFO_STATUS','1','編集された「配送・送料について」テキストを表示しますか?<br />0= リンク:表示　　編集領域:非表示<br />1= リンク:表示　　編集領域:表示<br />2= リンク:非表示　編集領域:表示<br />3= リンク:非表示　編集領域:非表示',25,63,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),'),(472,'「ご利用規約」ページ - ステータス','DEFINE_CONDITIONS_STATUS','1','編集された「ご利用規約」ページを表示しますか?<br />0= リンク:表示　　編集領域:非表示<br />1= リンク:表示　　編集領域:表示<br />2= リンク:非表示　編集領域:表示<br />3= リンク:非表示　編集領域:非表示',25,64,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),'),(473,'「ご注文が完了しました」ページ - ステータス','DEFINE_CHECKOUT_SUCCESS_STATUS','1','編集された「ご注文が完了しました」テキストを表示しますか?<br />0= リンク:表示　　編集領域:非表示<br />1= リンク:表示　　編集領域:表示<br />2= リンク:非表示　編集領域:表示<br />3= リンク:非表示　編集領域:非表示',25,65,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),'),(474,'「クーポン券」ページ - ステータス','DEFINE_DISCOUNT_COUPON_STATUS','1','編集された「クーポン券」テキストを表示しますか?<br />0= リンク:表示　　編集領域:非表示<br />1= リンク:表示　　編集領域:表示<br />2= リンク:非表示　編集領域:表示<br />3= リンク:非表示　編集領域:非表示',25,66,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),'),(475,'「サイトマップ」ページ - ステータス','DEFINE_SITE_MAP_STATUS','1','編集された「クーポン券」テキストを表示しますか?<br />0= リンク:表示　　編集領域:非表示<br />1= リンク:表示　　編集領域:表示<br />2= リンク:非表示　編集領域:表示<br />3= リンク:非表示　編集領域:非表示',25,67,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),'),(476,'自由編集ページ(Define Page) 2','DEFINE_PAGE_2_STATUS','1','自由編集ページ2を表示しますか?<br />0= リンク:表示　　編集領域:非表示<br />1= リンク:表示　　編集領域:表示<br />2= リンク:非表示　編集領域:表示<br />3= リンク:非表示　編集領域:非表示',25,82,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),'),(477,'自由編集ページ(Define Page) 3','DEFINE_PAGE_3_STATUS','1','自由編集ページ3 を表示しますか?<br />0= リンク:表示　　編集領域:非表示<br />1= リンク:表示　　編集領域:表示<br />2= リンク:非表示　編集領域:表示<br />3= リンク:非表示　編集領域:非表示',25,83,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),'),(478,'自由編集ページ(Define Page) 4','DEFINE_PAGE_4_STATUS','1','自由編集ページ(Define Page) 4を表示しますか?<br />0= リンク:表示　　編集領域:非表示<br />1= リンク:表示　　編集領域:表示<br />2= リンク:非表示　編集領域:表示<br />3= リンク:非表示　編集領域:非表示',25,84,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),'),(479,'EZページの表示 - ページヘッダ','EZPAGES_STATUS_HEADER','1','EZページのコンテンツをページヘッダに表示するかどうかをグローバル(サイト全体)に設定します。<br />0 = Off<br />1 = On<br />2= サイトメンテナンスの際に管理者のIPアドレスでアクセスした場合のみ表示<br />注意：ワーニングは公開されず管理者にだけ表示されます。',30,10,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), '),(480,'EZページの表示 - ページフッタ','EZPAGES_STATUS_FOOTER','1','EZページのコンテンツをページフッタに表示するかどうかをグローバル(サイト全体)に設定します。<br />0 = Off<br />1 = On<br />2= サイトメンテナンスの際に管理者のIPアドレスでアクセスした場合のみ表示<br />注意：ワーニングは公開されず管理者にだけ表示されます。',30,11,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), '),(481,'EZページの表示 - サイドボックス','EZPAGES_STATUS_SIDEBOX','1','EZページのコンテンツをサイドボックスに表示するかどうかをグローバル(サイト全体)に設定します。<br />0 = Off<br />1 = On<br />2= サイトメンテナンスの際に管理者のIPアドレスでアクセスした場合のみ表示<br />注意：ワーニングは公開されず管理者にだけ表示されます。',30,12,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), '),(482,'EZページ のヘッダ - リンクのセパレータ(区切り記号)','EZPAGES_SEPARATOR_HEADER','','EＺページのヘッダのリンク表示のセパレータ(区切り文字)は?<br />デフォルト = &amp;nbsp;::&amp;nbsp;',30,20,'2009-11-19 13:10:25','2009-11-19 12:39:39',NULL,'zen_cfg_textarea_small('),(483,'EZページ のフッタ - リンクのセパレータ(区切り記号)','EZPAGES_SEPARATOR_FOOTER','&nbsp;::&nbsp;','EＺページのフッタのリンク表示のセパレータ(区切り文字)は?<br />デフォルト = &amp;nbsp;::&amp;nbsp;',30,21,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_textarea_small('),(484,'EZページ - [次へ][前へ]ボタン','EZPAGES_SHOW_PREV_NEXT_BUTTONS','2','EZページのコンテンツ内[前へ][続ける][次へ]ボタンを表示しますか?<br />0=OFF (ボタンなし)<br />1=「続ける」を表示<br />2=「前へ」「続ける」「次へ」を表示<br /><br />デフォルト：2',30,30,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), '),(485,'EZページ - 目次の表示','EZPAGES_SHOW_TABLE_CONTENTS','1','EZページの目次を表示しますか?<br />0= OFF<br />1= ON',30,35,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'),'),(486,'EZ-ページ - ヘッダで表示しないページ','EZPAGES_DISABLE_HEADER_DISPLAY_LIST','','EZページのうち通常のページヘッダに表示しないページは?<br />表示しないページのページIDをカンマ(,)区切りで記述してください。ページIDは管理画面の[追加設定・ツール]のEZページ設定画面で確認できます。<br />例：1,5,2<br />ない場合は空欄のまま',30,40,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_textarea_small('),(487,'EZ-ページ - フッタで表示しないページ','EZPAGES_DISABLE_FOOTER_DISPLAY_LIST','','EZページのうち通常のページフッタに表示しないページは?<br />表示しないページのページIDをカンマ(,)区切りで記述してください。ページIDは管理画面の[追加設定・ツール]のEZページ設定画面で確認できます。<br />例：3,7<br />ない場合は空欄のまま',30,41,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_textarea_small('),(488,'EZ-ページ - 左カラムで表示しないページ','EZPAGES_DISABLE_LEFTCOLUMN_DISPLAY_LIST','','EZページのうち通常の左カラムに表示しないページは?<br />表示しないページのページIDをカンマ(,)区切りで記述してください。ページIDは管理画面の[追加設定・ツール]のEZページ設定画面で確認できます。<br />例：6,17<br />ない場合は空欄のまま',30,42,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_textarea_small('),(489,'EZ-ページ - 右カラムで表示しないページ','EZPAGES_DISABLE_RIGHTCOLUMN_DISPLAY_LIST','','EZページのうち通常の右カラムに表示しないページは?<br />表示しないページのページIDをカンマ(,)区切りで記述してください。ページIDは管理画面の[追加設定・ツール]のEZページ設定画面で確認できます。<br />例：5,23,47<br />ない場合は空欄のまま',30,43,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_textarea_small('),(490,'お問い合わせ時の個人情報確認画面表示','DISPLAY_CONTACT_US_PRIVACY_CONDITIONS','true','お問い合わせする画面で個人情報の確認画面を表示します。<div style=\"color: red;\">2005年4月1日に施行された「個人情報保護法」では、個人情報保護方針を開示することが求められています。</div>',11,3,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(491,'ふりがなが必要な国','FURIKANA_NECESSARY_COUNTRIES','Japanese','ふりがなが必要な国名をカンマで区切って入力してください',5,100,NULL,'2009-11-19 12:39:40',NULL,''),(492,'Product Listing - Layout Style','PRODUCT_LISTING_LAYOUT_STYLE','rows','Select the layout style:<br />Each product can be listed in its own row (rows option) or products can be listed in multiple columns per row (columns option)',8,40,NULL,'2009-11-19 12:39:41',NULL,'zen_cfg_select_option(array(\"rows\", \"columns\"),'),(493,'Product Listing - Columns Per Row','PRODUCT_LISTING_COLUMNS_PER_ROW','3','Select the number of columns of products to show in each row in the product listing. The default setting is 3.',8,41,NULL,'2009-11-19 12:39:41',NULL,NULL),(494,'Display Cross-Sell Products','MIN_DISPLAY_XSELL','1','This is the minimum number of configured Cross-Sell products required in order to cause the Cross Sell information to be displayed.<br />Default: 1',2,17,NULL,'2009-11-19 12:39:41',NULL,NULL),(495,'Display Cross-Sell Products','MAX_DISPLAY_XSELL','6','This is the maximum number of configured Cross-Sell products to be displayed.<br />Default: 6',3,66,NULL,'2009-11-19 12:39:41',NULL,NULL),(496,'Cross-Sell Products Columns per Row','SHOW_PRODUCT_INFO_COLUMNS_XSELL_PRODUCTS','3','Cross-Sell Products Columns to display per Row<br />0= off or set the sort order.<br />Default: 3',18,72,NULL,'2009-11-19 12:39:41',NULL,'zen_cfg_select_option(array(0, 1, 2, 3, 4), '),(497,'Cross-Sell - Display prices?','XSELL_DISPLAY_PRICE','false','Cross-Sell -- Do you want to display the product prices too?<br />Default: false',18,72,NULL,'2009-11-19 12:39:41',NULL,'zen_cfg_select_option(array(\'true\',\'false\'), '),(498,'無料配送','MODULE_SHIPPING_FREESHIPPER_STATUS','True','無料配送を提供しますか？',6,0,NULL,'2009-11-19 12:41:06',NULL,'zen_cfg_select_option(array(\'True\', \'False\'), '),(499,'無料配送コスト','MODULE_SHIPPING_FREESHIPPER_COST','0','無料配送にかかるコスト',6,6,NULL,'2009-11-19 12:41:06',NULL,NULL),(500,'手数料','MODULE_SHIPPING_FREESHIPPER_HANDLING','0','無料配送にかかる手数料.',6,0,NULL,'2009-11-19 12:41:06',NULL,NULL),(501,'税種別','MODULE_SHIPPING_FREESHIPPER_TAX_CLASS','0','定額料金に適用される税種別を選択してください。',6,0,NULL,'2009-11-19 12:41:06','zen_get_tax_class_title','zen_cfg_pull_down_tax_classes('),(502,'配送地域','MODULE_SHIPPING_FREESHIPPER_ZONE','0','配送地域を選択すると選択された地域のみで利用可能になります。.',6,0,NULL,'2009-11-19 12:41:06','zen_get_zone_class_title','zen_cfg_pull_down_zone_classes('),(503,'表示の整列順','MODULE_SHIPPING_FREESHIPPER_SORT_ORDER','0','表示の整列順を設定できます。数字が小さいほど上位に表示されます。',6,0,NULL,'2009-11-19 12:41:06',NULL,NULL),(504,'佐川急便の配送を有効にする','MODULE_SHIPPING_YAMATO_STATUS','True','ヤマト運輸(宅急便)の配送を提供しますか?',6,0,NULL,'2009-11-19 12:41:06',NULL,'zen_cfg_select_option(array(\'True\', \'False\'), '),(505,'取扱い手数料','MODULE_SHIPPING_YAMATO_HANDLING','0','送料に適用する取扱手数料を設定できます.',6,1,NULL,'2009-11-19 12:41:06',NULL,NULL),(506,'送料無料設定','MODULE_SHIPPING_YAMATO_FREE_SHIPPING','False','送料無料設定を有効にしますか? [合計モジュール]-[送料]-[送料無料設定]を優先する場合は False を選んでください.',6,2,NULL,'2009-11-19 12:41:06',NULL,'zen_cfg_select_option(array(\'True\', \'False\'), '),(507,'送料を無料にする購入金額設定','MODULE_SHIPPING_YAMATO_OVER','5000','設定金額以上をご購入の場合は送料を無料にします.',6,3,NULL,'2009-11-19 12:41:06',NULL,NULL),(508,'送料の値引率','MODULE_SHIPPING_YAMATO_DISCOUNT','0','送料の値引率を指定します.(％)',6,4,NULL,'2009-11-19 12:41:06',NULL,NULL),(509,'配送地域','MODULE_SHIPPING_YAMATO_ZONE','0','配送地域を選択すると選択された地域のみで利用可能となります.',6,5,NULL,'2009-11-19 12:41:06','zen_get_zone_class_title','zen_cfg_pull_down_zone_classes('),(510,'表示の整列順','MODULE_SHIPPING_YAMATO_SORT_ORDER','0','表示の整列順を設定できます. 数字が小さいほど上位に表示されます.',6,6,NULL,'2009-11-19 12:41:06',NULL,NULL),(511,'Installed Modules','ADDON_MODULE_INSTALLED','aboutbox;addon_modules;feature_area;carousel_ui;ajax_category_tree;blog;calendar;category_sitemap;checkout_step;easy_admin;easy_admin_simplify;easy_design;email_templates;globalnavi;jquery;multiple_image_view;point_base;point_createaccount;point_customersrate;point_grouprate;point_productsrate;product_csv;products_with_attributes_stock;reviews;search_more;shopping_cart_summary;visitors','This is automatically updated. No need to edit.',6,0,'2009-11-19 19:37:36','2009-11-19 12:42:23',NULL,NULL),(512,'コアモジュールの有効化','MODULE_ADDON_MODULES_STATUS','true','無効にすることは出来ません。',6,0,NULL,'2009-11-19 12:42:37',NULL,'zen_cfg_select_option(array(\'true\'), '),(513,'配布元URLリスト','MODULE_ADDON_MODULES_DISTRIBUTION_URL','http://sugu.e7.com','addonモジュールパッケージを取得するサイトのURLを指定してください。<br/>複数指定する場合は改行して入力してください。',6,1,NULL,'2009-11-19 12:42:37',NULL,'zen_cfg_textarea_small('),(514,'優先順','MODULE_ADDON_MODULES_SORT_ORDER','0','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,2,NULL,'2009-11-19 12:42:37',NULL,NULL),(515,'パケット料金節約の設定','MOBILE_SLIM_SIZE','1','パケット料金の節約に関する設定をします<BR />この設定はHTML中の改行やスペースを取り除きファイルサイズを小さくします。この設定でパケット料金を節約する事が出来ます<br />0=OFF<br />1=ON<br />',100,2,NULL,'0001-01-01 00:00:00',NULL,'zen_cfg_select_option(array(\'0\', \'1\'),'),(516,'携帯サイトテーマカラーの設定','MOBILE_THEME_COLOR','#CA6312','サイトのテーマカラーを「#666666」などHTMLカラーコードで設定します。このテーマカラーは、見出しの帯の背景色などで使用されます',100,3,NULL,'0001-01-01 00:00:00',NULL,NULL),(517,'CSSの設定','MOBILE_CSS_CONF','0','ここではHTML中の[class]と[id]の有無を設定します<br />デフォルトではファイルサイズ縮小目的の為に0が設定されています<br />CSSを使用する場合は1を設定して下さい<BR /><br />0=CSSを使用しない<br />1=CSSを使用する<br />',100,4,NULL,'0001-01-01 00:00:00',NULL,'zen_cfg_select_option(array(\'0\', \'1\'),'),(518,'アバウトボックスブロックの有効化','MODULE_ABOUTBOX_STATUS','true','アバウトボックスを有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 12:50:52',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(519,'優先順','MODULE_ABOUTBOX_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,1,NULL,'2009-11-19 12:50:52',NULL,NULL),(520,'アバウトボックスのタイトル','MODULE_ABOUTBOX_CFG_HEADER','','アバウトボックスブロックに表示するタイトルを指定します。',6,2,NULL,'2009-11-19 12:50:52',NULL,NULL),(521,'アバウトボックス説明文のタイトル','MODULE_ABOUTBOX_CFG_GREETING_TITLE','店長からの挨拶','アバウトボックスに表示する説明文のタイトルを指定します。',6,3,NULL,'2009-11-19 12:50:52',NULL,NULL),(522,'アバウトボックス説明文の本文','MODULE_ABOUTBOX_CFG_GREETING_TEXT','すぐでき（る）パックのデモショップです。\r\nテンプレートの実装をがんばろー！','アバウトボックスに表示する説明文の本文を指定します。',6,4,NULL,'2009-11-19 12:50:52',NULL,'zen_cfg_textarea_small('),(523,'アバウトボックスに表示する画像','MODULE_ABOUTBOX_CFG_IMAGEPATH','images/my.jpg','アバウトボックスに表示する画像のパスを指定します。',6,5,NULL,'2009-11-19 12:50:52',NULL,NULL),(524,'カレンダー表示','MODULE_ABOUTBOX_DISPLAY_CALENDAR','true','営業カレンダーを表示するかどうか指定します。営業カレンダーモジュールがインストールされていないとtrueにしても表示されません。<br />true: 表示<br />false: 非表示',6,6,NULL,'2009-11-19 12:50:52',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(525,'対応クレジットカード表示','MODULE_ABOUTBOX_AVALABLE_CARDS','2','対応クレジットカードを表示するかどうか指定します<br />0: 非表示<br />1: テキスト表示<br />2: 画像表示',6,7,NULL,'2009-11-19 12:50:52',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), '),(526,'jQueryの有効化','MODULE_JQUERY_STATUS','true','jQueryを有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 12:51:33',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(527,'jQueryライブラリ','MODULE_JQUERY_LIBRARY','jquery.js','jQueryライブラリのファイル名を設定します。特に理由がない限り変更する必要はありません。<br />・初期値 = jquery.js',6,1,NULL,'2009-11-19 12:51:33',NULL,NULL),(528,'noConflictの有効化','MODULE_JQUERY_NOCONFLICT_STATUS','false','noConflictを有効にしますか？ <br />true: 有効<br />false: 無効',6,2,NULL,'2009-11-19 12:51:33',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(529,'優先順','MODULE_JQUERY_SORT_ORDER','1','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,3,NULL,'2009-11-19 12:51:33',NULL,NULL),(530,'商品カテゴリの有効化','MODULE_ADDON_MODULES_AJAXCATEGORYTREE_STATUS','true','商品カテゴリ表示を有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 12:51:55',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(531,'優先順','MODULE_ADDON_MODULES_AJAXCATEGORYTREE_SORT_ORDER','1000','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,1,NULL,'2009-11-19 12:51:55',NULL,NULL),(532,'ブログの有効化','MODULE_BLOG_STATUS','true','ブログを有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 12:52:36',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),'),(533,'ブログURL','MODULE_BLOG_URL','','取得対象のURLを http:// から入力してください(https未対応)',6,1,NULL,'2009-11-19 12:52:36',NULL,NULL),(534,'タイムアウト','MODULE_BLOG_TIMEOUT','1','取得リミット時間を設定します、ここで指定した時間以上に取得に時間がかかった場合は取得を中止します',6,2,NULL,'2009-11-19 12:52:36',NULL,NULL),(535,'表示件数','MODULE_BLOG_COUNT','10','最大表示件数を設定します、0の場合はすべてとなります',6,3,NULL,'2009-11-19 12:52:36',NULL,NULL),(536,'優先順','MODULE_BLOG_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,4,NULL,'2009-11-19 12:52:36',NULL,NULL),(537,'営業カレンダーの有効化','MODULE_CALENDAR_STATUS','true','営業カレンダーを有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 12:53:04',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),'),(538,'週の開始が日曜日','MODULE_CALENDAR_START_SUNDAY','true','週の開始を日曜日としますか？ <br />true: 日曜<br />false: 月曜',6,1,NULL,'2009-11-19 12:53:04',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),'),(539,'最短配送可能日: 注文日の翌日からの営業日','MODULE_CALENDAR_DELIVERY_START','3','配送日として指定できる範囲を日数として指定します',6,2,NULL,'2009-11-19 12:53:04',NULL,NULL),(540,'最終配送可能日: 最短配送可能日から日間','MODULE_CALENDAR_DELIVERY_END','14','配送日として指定できる範囲を日数として指定します',6,3,NULL,'2009-11-19 12:53:04',NULL,NULL),(541,'配送時刻の選択項目','MODULE_CALENDAR_HOPE_DELIVERY_TIME','指定しない,午前中,12時〜15時,15時〜18時,18時〜21時','配送時刻の選択項目をカンマ区切りで入力してください',6,4,NULL,'2009-11-19 12:53:04',NULL,NULL),(542,'優先順','MODULE_CALENDAR_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,5,NULL,'2009-11-19 12:53:04',NULL,NULL),(543,'カルーセルUIの有効化','MODULE_CAROUSEL_UI_STATUS','true','カルーセルUIを有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 12:53:57',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(544,'jCarouselLiteライブラリ','MODULE_CAROUSEL_UI_JCAROUSELLITE_LIBRARY','jcarousellite.js','jCarouselLiteライブラリのファイル名を設定します。特に理由がない限り変更する必要はありません。<br />・初期値 = jcarousellite.js',6,1,NULL,'2009-11-19 12:53:57',NULL,NULL),(545,'優先順','MODULE_CAROUSEL_UI_SORT_ORDER','11','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。<br />※jQueryモジュールよりも大きな数字を設定してください。',6,2,NULL,'2009-11-19 12:53:57',NULL,NULL),(546,'新着商品 - 最大表示件数','MODULE_CAROUSEL_UI_MAX_DISPLAY_NEW_PRODUCTS','4','新着商品の最大表示件数を設定します。<br />・初期値 = 4',6,3,NULL,'2009-11-19 12:53:57',NULL,NULL),(547,'新着商品 - 自動スクロール','MODULE_CAROUSEL_UI_CONF_AUTO_NEW_PRODUCTS','0','新着商品を自動的にスクロールする場合の間隔(ミリ秒)を設定します。<br />0ミリ秒の場合は自動スクロールしません。<br />・初期値 = 0',6,4,NULL,'2009-11-19 12:53:57',NULL,NULL),(548,'新着商品 - スクロール速度','MODULE_CAROUSEL_UI_CONF_SPEED_NEW_PRODUCTS','200','新着商品をスクロールする速度(ミリ秒)を設定します。<br />設定値を大きくするとゆっくりスクロールします。0に設定するとスクロールしなくなります。<br />・初期値 = 200',6,5,NULL,'2009-11-19 12:53:57',NULL,NULL),(549,'新着商品 - 縦スクロール','MODULE_CAROUSEL_UI_CONF_VERTICAL_NEW_PRODUCTS','false','新着商品を縦にスクロールしますか？<br />true: 縦スクロール<br />false: 横スクロール<br />・初期値 = false',6,6,NULL,'2009-11-19 12:53:57',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(550,'新着商品 - 循環スクロール','MODULE_CAROUSEL_UI_CONF_CIRCULAR_NEW_PRODUCTS','true','新着商品を循環的にスクロールしますか？<br />true: 循環スクロール<br />false: 往復スクロール<br />・初期値 = true',6,7,NULL,'2009-11-19 12:53:57',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(551,'新着商品 - スクロールエリア表示件数','MODULE_CAROUSEL_UI_CONF_VISIBLE_NEW_PRODUCTS','3','新着商品のスクロールエリアに表示する件数を設定します。<br />・初期値 = 3',6,8,NULL,'2009-11-19 12:53:57',NULL,NULL),(552,'新着商品 - スクロール件数','MODULE_CAROUSEL_UI_CONF_SCROLL_NEW_PRODUCTS','1','新着商品の一度にスクロールさせる件数を設定します。<br />・初期値 = 1',6,9,NULL,'2009-11-19 12:53:57',NULL,NULL),(553,'おすすめ商品 - 最大表示件数','MODULE_CAROUSEL_UI_MAX_DISPLAY_FEATURED_PRODUCTS','4','おすすめ商品の最大表示件数を設定します。<br />・初期値 = 4',6,10,NULL,'2009-11-19 12:53:57',NULL,NULL),(554,'おすすめ商品 - 自動スクロール','MODULE_CAROUSEL_UI_CONF_AUTO_FEATURED_PRODUCTS','0','おすすめ商品を自動的にスクロールする場合の間隔(ミリ秒)を設定します。<br />0ミリ秒の場合は自動スクロールしません。<br />・初期値 = 0',6,11,NULL,'2009-11-19 12:53:57',NULL,NULL),(555,'おすすめ商品 - スクロール速度','MODULE_CAROUSEL_UI_CONF_SPEED_FEATURED_PRODUCTS','200','おすすめ商品をスクロールする速度(ミリ秒)を設定します。<br />設定値を大きくするとゆっくりスクロールします。0に設定するとスクロールしなくなります。<br />・初期値 = 200',6,12,NULL,'2009-11-19 12:53:57',NULL,NULL),(556,'おすすめ商品 - 縦スクロール','MODULE_CAROUSEL_UI_CONF_VERTICAL_FEATURED_PRODUCTS','false','おすすめ商品を縦にスクロールしますか？<br />true: 縦スクロール<br />false: 横スクロール<br />・初期値 = false',6,13,NULL,'2009-11-19 12:53:57',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(557,'おすすめ商品 - 循環スクロール','MODULE_CAROUSEL_UI_CONF_CIRCULAR_FEATURED_PRODUCTS','true','おすすめ商品を循環的にスクロールしますか？<br />true: 循環スクロール<br />false: 往復スクロール<br />・初期値 = true',6,14,NULL,'2009-11-19 12:53:57',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(558,'おすすめ商品 - スクロールエリア表示件数','MODULE_CAROUSEL_UI_CONF_VISIBLE_FEATURED_PRODUCTS','3','おすすめ商品のスクロールエリアに表示する件数を設定します。<br />・初期値 = 3',6,15,NULL,'2009-11-19 12:53:57',NULL,NULL),(559,'おすすめ商品 - スクロール件数','MODULE_CAROUSEL_UI_CONF_SCROLL_FEATURED_PRODUCTS','1','おすすめ商品の一度にスクロールさせる件数を設定します。<br />・初期値 = 1',6,16,NULL,'2009-11-19 12:53:57',NULL,NULL),(560,'特価商品 - 最大表示件数','MODULE_CAROUSEL_UI_MAX_DISPLAY_SPECIALS_PRODUCTS','4','特価商品の最大表示件数を設定します。<br />・初期値 = 4',6,17,NULL,'2009-11-19 12:53:57',NULL,NULL),(561,'特価商品 - 自動スクロール','MODULE_CAROUSEL_UI_CONF_AUTO_SPECIALS_PRODUCTS','0','特価商品を自動的にスクロールする場合の間隔(ミリ秒)を設定します。<br />0ミリ秒の場合は自動スクロールしません。<br />・初期値 = 0',6,18,NULL,'2009-11-19 12:53:57',NULL,NULL),(562,'特価商品 - スクロール速度','MODULE_CAROUSEL_UI_CONF_SPEED_SPECIALS_PRODUCTS','200','特価商品をスクロールする速度(ミリ秒)を設定します。<br />設定値を大きくするとゆっくりスクロールします。0に設定するとスクロールしなくなります。<br />・初期値 = 200',6,19,NULL,'2009-11-19 12:53:57',NULL,NULL),(563,'特価商品 - 縦スクロール','MODULE_CAROUSEL_UI_CONF_VERTICAL_SPECIALS_PRODUCTS','false','特価商品を縦にスクロールしますか？<br />true: 縦スクロール<br />false: 横スクロール<br />・初期値 = false',6,20,NULL,'2009-11-19 12:53:57',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(564,'特価商品 - 循環スクロール','MODULE_CAROUSEL_UI_CONF_CIRCULAR_SPECIALS_PRODUCTS','true','特価商品を循環的にスクロールしますか？<br />true: 循環スクロール<br />false: 往復スクロール<br />・初期値 = true',6,21,NULL,'2009-11-19 12:53:57',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(565,'特価商品 - スクロールエリア表示件数','MODULE_CAROUSEL_UI_CONF_VISIBLE_SPECIALS_PRODUCTS','3','特価商品のスクロールエリアに表示する件数を設定します。<br />・初期値 = 3',6,22,NULL,'2009-11-19 12:53:57',NULL,NULL),(566,'特価商品 - スクロール件数','MODULE_CAROUSEL_UI_CONF_SCROLL_SPECIALS_PRODUCTS','1','特価商品の一度にスクロールさせる件数を設定します。<br />・初期値 = 1',6,23,NULL,'2009-11-19 12:53:57',NULL,NULL),(567,'こんな商品も購入しています - 最大表示件数','MODULE_CAROUSEL_UI_MAX_DISPLAY_ALSO_PURCHASED_PRODUCTS','4','こんな商品も購入していますの最大表示件数を設定します。<br />・初期値 = 4',6,24,NULL,'2009-11-19 12:53:57',NULL,NULL),(568,'こんな商品も購入しています - 自動スクロール','MODULE_CAROUSEL_UI_CONF_AUTO_ALSO_PURCHASED_PRODUCTS','0','こんな商品も購入していますを自動的にスクロールする場合の間隔(ミリ秒)を設定します。<br />0ミリ秒の場合は自動スクロールしません。<br />・初期値 = 0',6,25,NULL,'2009-11-19 12:53:57',NULL,NULL),(569,'こんな商品も購入しています - スクロール速度','MODULE_CAROUSEL_UI_CONF_SPEED_ALSO_PURCHASED_PRODUCTS','200','こんな商品も購入していますをスクロールする速度(ミリ秒)を設定します。<br />設定値を大きくするとゆっくりスクロールします。0に設定するとスクロールしなくなります。<br />・初期値 = 200',6,26,NULL,'2009-11-19 12:53:57',NULL,NULL),(570,'こんな商品も購入しています - 縦スクロール','MODULE_CAROUSEL_UI_CONF_VERTICAL_ALSO_PURCHASED_PRODUCTS','false','こんな商品も購入していますを縦にスクロールしますか？<br />true: 縦スクロール<br />false: 横スクロール<br />・初期値 = false',6,27,NULL,'2009-11-19 12:53:57',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(571,'こんな商品も購入しています - 循環スクロール','MODULE_CAROUSEL_UI_CONF_CIRCULAR_ALSO_PURCHASED_PRODUCTS','true','こんな商品も購入していますを循環的にスクロールしますか？<br />true: 循環スクロール<br />false: 往復スクロール<br />・初期値 = true',6,28,NULL,'2009-11-19 12:53:57',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(572,'こんな商品も購入しています - スクロールエリア表示件数','MODULE_CAROUSEL_UI_CONF_VISIBLE_ALSO_PURCHASED_PRODUCTS','3','こんな商品も購入していますのスクロールエリアに表示する件数を設定します。<br />・初期値 = 3',6,29,NULL,'2009-11-19 12:53:57',NULL,NULL),(573,'こんな商品も購入しています - スクロール件数','MODULE_CAROUSEL_UI_CONF_SCROLL_ALSO_PURCHASED_PRODUCTS','1','こんな商品も購入していますの一度にスクロールさせる件数を設定します。<br />・初期値 = 1',6,30,NULL,'2009-11-19 12:53:57',NULL,NULL),(574,'関連商品 - 最大表示件数','MODULE_CAROUSEL_UI_MAX_DISPLAY_XSELL_PRODUCTS','4','関連商品の最大表示件数を設定します。<br />・初期値 = 4',6,31,NULL,'2009-11-19 12:53:57',NULL,NULL),(575,'関連商品 - 自動スクロール','MODULE_CAROUSEL_UI_CONF_AUTO_XSELL_PRODUCTS','0','関連商品を自動的にスクロールする場合の間隔(ミリ秒)を設定します。<br />0ミリ秒の場合は自動スクロールしません。<br />・初期値 = 0',6,32,NULL,'2009-11-19 12:53:57',NULL,NULL),(576,'関連商品 - スクロール速度','MODULE_CAROUSEL_UI_CONF_SPEED_XSELL_PRODUCTS','200','関連商品をスクロールする速度(ミリ秒)を設定します。<br />設定値を大きくするとゆっくりスクロールします。0に設定するとスクロールしなくなります。<br />・初期値 = 200',6,33,NULL,'2009-11-19 12:53:57',NULL,NULL),(577,'関連商品 - 縦スクロール','MODULE_CAROUSEL_UI_CONF_VERTICAL_XSELL_PRODUCTS','false','関連商品を縦にスクロールしますか？<br />true: 縦スクロール<br />false: 横スクロール<br />・初期値 = false',6,34,NULL,'2009-11-19 12:53:57',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(578,'関連商品 - 循環スクロール','MODULE_CAROUSEL_UI_CONF_CIRCULAR_XSELL_PRODUCTS','true','関連商品を循環的にスクロールしますか？<br />true: 循環スクロール<br />false: 往復スクロール<br />・初期値 = true',6,35,NULL,'2009-11-19 12:53:57',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(579,'関連商品 - スクロールエリア表示件数','MODULE_CAROUSEL_UI_CONF_VISIBLE_XSELL_PRODUCTS','3','関連商品のスクロールエリアに表示する件数を設定します。<br />・初期値 = 3',6,36,NULL,'2009-11-19 12:53:57',NULL,NULL),(580,'関連商品 - スクロール件数','MODULE_CAROUSEL_UI_CONF_SCROLL_XSELL_PRODUCTS','1','関連商品の一度にスクロールさせる件数を設定します。<br />・初期値 = 1',6,37,NULL,'2009-11-19 12:53:57',NULL,NULL),(581,'カテゴリサイトマップの有効化','MODULE_ADDON_MODULES_CATEGORY_SITEMAP_STATUS','true','カテゴリサイトマップ表示を有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 12:54:42',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(582,'表示するカテゴリの深さ','MODULE_ADDON_MODULES_CATEGORY_SITEMAP_TREE_LEVEL','2','表示するカテゴリの深さを指定します（デフォルト=2）',6,1,NULL,'2009-11-19 12:54:42',NULL,NULL),(583,'優先順','MODULE_ADDON_MODULES_CATEGORY_SITEMAP_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,2,NULL,'2009-11-19 12:54:42',NULL,NULL),(584,'注文ステップ表示の有効化','MODULE_CHECKOUT_STEP_STATUS','true','注文ステップ表示を有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 12:56:18',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(585,'優先順','MODULE_CHECKOUT_STEP_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,1,NULL,'2009-11-19 12:56:18',NULL,NULL),(586,'管理メニューの設定の有効化','MODULE_EASY_ADMIN_STATUS','true','管理メニューの設定を有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 12:56:42',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),'),(587,'優先順','MODULE_EASY_ADMIN_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,1,NULL,'2009-11-19 12:56:42',NULL,NULL),(588,'管理メニューの設定の有効化','MODULE_EASY_ADMIN_SIMPLIFY_STATUS','true','管理メニューの設定を有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 12:59:21',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),'),(589,'優先順','MODULE_EASY_ADMIN_SIMPLIFY_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,1,NULL,'2009-11-19 12:59:21',NULL,NULL),(590,'デザインの設定の有効化','MODULE_EASY_DESIGN_STATUS','true','デザインの設定を有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 12:59:53',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),'),(591,'優先順','MODULE_EASY_DESIGN_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,1,NULL,'2009-11-19 12:59:53',NULL,NULL),(592,'メールテンプレートの有効化','MODULE_EMAIL_TEMPLATES_STATUS','false','メールテンプレートを有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 13:01:34',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(593,'優先順','MODULE_EMAIL_TEMPLATES_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,1,NULL,'2009-11-19 13:01:34',NULL,NULL),(594,'フィーチャーエリアUIの有効化','MODULE_FEATURE_AREA_STATUS','true','フィーチャーエリアUIを有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 13:02:18',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(595,'優先順','MODULE_FEATURE_AREA_SORT_ORDER','10','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,1,NULL,'2009-11-19 13:02:18',NULL,NULL),(596,'サムネイル - 自動スクロール ','MODULE_FEATURE_AREA_UI_CONF_AUTO','6200','サムネイルを自動的にスクロールする場合の間隔(ミリ秒)を設定します。<br />0ミリ秒の場合は自動スクロールしません。<br />・初期値 = 6200',6,2,NULL,'2009-11-19 13:02:18',NULL,NULL),(597,'サムネイル - スクロール速度','MODULE_FEATURE_AREA_UI_CONF_SPEED','800','サムネイルをスクロールする速度(ミリ秒)を設定します。<br />設定値を大きくするとゆっくりスクロールします。0に設定するとスクロールしなくなります。<br />・初期値 = 800',6,3,NULL,'2009-11-19 13:02:18',NULL,NULL),(598,'サムネイル - スクロールエリア表示件数','MODULE_FEATURE_AREA_UI_CONF_VISIBLE','5','サムネイルのスクロールエリアに表示する件数を設定します。<br />・初期値 = 5',6,4,NULL,'2009-11-19 13:02:18',NULL,NULL),(599,'グローバルナビブロックの有効化','MODULE_GLOBALNAVI_STATUS','true','グローバルナビを有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 13:03:12',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(600,'優先順','MODULE_GLOBALNAVI_SORT_ORDER','1950','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,1,NULL,'2009-11-19 13:03:12',NULL,NULL),(601,'表示するカテゴリの上限','MODULE_GLOBALNAVI_CFG_LIMIT','5','グローバルナビに表示するカテゴリ数の上限を設定します',6,2,NULL,'2009-11-19 13:03:12',NULL,NULL),(602,'複数画像表示 の有効化','MODULE_MULTIPLE_IMAGE_VIEW_STATUS','true','複数画像表示を有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 13:03:54',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(603,'優先順','MODULE_MULTIPLE_IMAGE_VIEW_SORT_ORDER','10','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,1,NULL,'2009-11-19 13:03:54',NULL,NULL),(604,'サムネイルサイズ：幅','MODULE_MULTIPLE_IMAGE_VIEW_THMB_WIDTH','100','サムネイル画像の表示幅を設定できます。(pixel)',6,2,NULL,'2009-11-19 13:03:54',NULL,NULL),(605,'サムネイルサイズ：高さ','MODULE_MULTIPLE_IMAGE_VIEW_THMB_HEIGHT','80','サムネイル画像の表示高さを設定できます。(pixel)',6,3,NULL,'2009-11-19 13:03:54',NULL,NULL),(606,'CSVによる商品一括登録の有効化','MODULE_PRODUCT_CSV_STATUS','true','CSVによる商品一括登録を有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 13:04:30',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(607,'優先順','MODULE_PRODUCT_CSV_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,1,NULL,'2009-11-19 13:04:30',NULL,NULL),(608,'オプション毎の在庫管理の有効化','MODULE_PRODUCTS_WITH_ATTRIBUTES_STOCK_STATUS','true','オプション毎の在庫管理を有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 13:05:03',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),'),(609,'優先順','MODULE_PRODUCTS_WITH_ATTRIBUTES_STOCK_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,1,NULL,'2009-11-19 13:05:03',NULL,NULL),(610,'商品レビューの有効化','MODULE_REVIEWS_STATUS','true','商品レビューを有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 13:05:33',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(611,'商品詳細ページ　レビュー表示数','MODULE_REVIEWS_MAX_DISPLAY_NEW_REVIEWS','3','商品詳細ページで表示される商品レビューの数を設定してください。<br />商品レビュー一覧ページのレビュー数は「一般設定」-「最大値の設定」-「新しいレビューの表示数最大値」で設定してください。',6,1,NULL,'2009-11-19 13:05:33',NULL,NULL),(612,'非ログインユーザーの商品レビュー閲覧禁止','MODULE_REVIEWS_LIST_DISPLAY_FORCE_LOGIN','false','ログインしていないユーザーは商品レビュー閲覧ができない。',6,2,NULL,'2009-11-19 13:05:33',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(613,'優先順','MODULE_REVIEWS_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,3,NULL,'2009-11-19 13:05:33',NULL,NULL),(614,'もっと検索の有効化','MODULE_SEARCH_MORE_STATUS','true','もっと検索を有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 13:06:01',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),'),(615,'表示件数リストボックスのタイトル','MODULE_SEARCH_MORE_PAGE_MAX_LIST_NAME','表示件数','商品一覧の中で表示される商品の数を指定するリストのラベルを指定してください。デフォルト値は「表示件数」です。',6,1,NULL,'2009-11-19 13:06:01',NULL,NULL),(616,'表示件数リストボックスの値','MODULE_SEARCH_MORE_PAGE_MAX_LIST_VALUE','10,25,50,100','商品一覧の中で表示される商品の数を指定するリストの内容をカンマ(,)区切りで指定してください。デフォルト値は「10,25,50,100」です。',6,2,NULL,'2009-11-19 13:06:01',NULL,NULL),(617,'並び替えリストボックスのタイトル','MODULE_SEARCH_MORE_SORT_LIST_NAME','並び替え','商品一覧のソート順を指定するリストのラベルを指定してください。デフォルト値は「並び替え」です。',6,3,NULL,'2009-11-19 13:06:01',NULL,NULL),(618,'優先順','MODULE_SEARCH_MORE_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,4,NULL,'2009-11-19 13:06:01',NULL,NULL),(619,'ビジターモジュールの有効化','MODULE_VISITORS_STATUS','true','ビジターモジュールを有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 13:06:28',NULL,'zen_cfg_select_option(array(\'true\'), '),(620,'ビジターの顧客データを保存しておく日数','MODULE_VISITORS_CUSTOMERS_DATA_KEEP_DAYS','10','ビジターの顧客データを商品購入日から何日間保存するかを設定します。指定した日数を超えると自動的にビジターの顧客データがデータベースから削除されます。自動削除しない場合は空欄にします。<br />・初期値 = 10',6,1,NULL,'2009-11-19 13:06:28',NULL,NULL),(621,'優先順','MODULE_VISITORS_SORT_ORDER','0','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,2,NULL,'2009-11-19 13:06:28',NULL,NULL),(622,'ポイントモジュールの有効化<br />有効化の後に<a href=\"http://zen-cart.ark-web.jp/ohtsuji/zencart-sugu/admin/addon_modules_admin.php?module=addon_modules/blocks\">ブロックの設定</a>から「現在のポイント残額」ブロックの表示設定をしてください。','MODULE_POINT_BASE_STATUS','true','ポイントを有効にしますか？ (ポイントモジュールは他の全てのポイントモジュールにとって必須です)<br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 18:25:40',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(623,'ポイント単位名称','MODULE_POINT_BASE_POINT_SYMBOL','point','ポイントの単位名称を入力してください。<br />・初期値 = point',6,1,NULL,'2009-11-19 18:25:40',NULL,NULL),(624,'ポイント管理ページで表示するポイント履歴の最大値','MODULE_POINT_BASE_MAX_DISPLAY_SEARCH_RESULTS_POINTS','20','ポイント管理ページで表示するポイント履歴の最大値を設定してください。<br />・初期値 = 20',6,2,NULL,'2009-11-19 18:25:40',NULL,NULL),(625,'優先順','MODULE_POINT_BASE_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,3,NULL,'2009-11-19 18:25:40',NULL,NULL),(626,'購入ポイントモジュールの有効化','MODULE_ORDER_TOTAL_ADDPOINT_STATUS','true','購入ポイントモジュールを有効にしますか？<br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 18:25:54',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(627,'購入ポイント還元率','MODULE_ORDER_TOTAL_ADDPOINT_RATE','1','商品購入金額に対してのポイント還元率をパーセントで設定します。<br />例: 1 (1% - 商品購入金額100円で1ポイント還元)',6,1,NULL,'2009-11-19 18:25:54',NULL,NULL),(628,'購入ポイントを使用可能にする注文ステータス','MODULE_ORDER_TOTAL_ADDPOINT_DEPOSIT_ORDER_STATUS_ID','0','設定した注文ステータスに更新された時に購入ポイントを使用可能にします。',6,2,NULL,'2009-11-19 18:25:54','zen_get_order_status_name','zen_cfg_pull_down_order_statuses('),(629,'購入ポイントを取消す注文ステータス','MODULE_ORDER_TOTAL_ADDPOINT_CANCEL_ORDER_STATUS_ID','0','設定した注文ステータスに更新された時に購入ポイントを取り消します。',6,3,NULL,'2009-11-19 18:25:54','zen_get_order_status_name','zen_cfg_pull_down_order_statuses('),(630,'表示の整列順','MODULE_ORDER_TOTAL_ADDPOINT_SORT_ORDER','1100','表示の整列順を設定できます. 数字が小さいほど上位に表示されます。',6,4,NULL,'2009-11-19 18:25:54',NULL,NULL),(631,'使用ポイントモジュールの有効化','MODULE_ORDER_TOTAL_SUBPOINT_STATUS','true','使用ポイントモジュールを有効にしますか？<br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 18:26:12',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(632,'送料を含める','MODULE_ORDER_TOTAL_SUBPOINT_INC_SHIPPING','true','送料を計算に含めますか？',6,1,NULL,'2009-11-19 18:26:12',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(633,'税金を含める','MODULE_ORDER_TOTAL_SUBPOINT_INC_TAX','true','税金を計算に含めますか？',6,2,NULL,'2009-11-19 18:26:12',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(634,'税金を再計算する','MODULE_ORDER_TOTAL_SUBPOINT_CALC_TAX','None','税金を再計算しますか？',6,3,NULL,'2009-11-19 18:26:12',NULL,'zen_cfg_select_option(array(\'None\', \'Standard\', \'Credit Note\'), '),(635,'税種別','MODULE_ORDER_TOTAL_SUBPOINT_TAX_CLASS','0','ポイントに適用される税種別',6,4,NULL,'2009-11-19 18:26:12','zen_get_tax_class_title','zen_cfg_pull_down_tax_classes('),(636,'ポイントに税金を付加する','MODULE_ORDER_TOTAL_SUBPOINT_CREDIT_TAX','false','ポイント購入時に税金を付加しますか？',6,5,NULL,'2009-11-19 18:26:12',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(637,'注文ステータス','MODULE_ORDER_TOTAL_SUBPOINT_ORDER_STATUS_ID','0','ポイントで全額支払いを行った場合の注文ステータスを設定します。',6,6,NULL,'2009-11-19 18:26:12','zen_get_order_status_name','zen_cfg_pull_down_order_statuses('),(638,'使用ポイントを取消す注文ステータス','MODULE_ORDER_TOTAL_SUBPOINT_CANCEL_ORDER_STATUS_ID','0','設定した注文ステータスに更新された時に使用ポイントを取り消します。',6,7,NULL,'2009-11-19 18:26:12','zen_get_order_status_name','zen_cfg_pull_down_order_statuses('),(639,'表示の整列順','MODULE_ORDER_TOTAL_SUBPOINT_SORT_ORDER','860','表示の整列順を設定できます. 数字が小さいほど上位に表示されます。',6,8,NULL,'2009-11-19 18:26:12',NULL,NULL),(640,'会員登録ポイント発行モジュールの有効化','MODULE_POINT_CREATEACCOUNT_STATUS','true','会員登録ポイント発行モジュールを有効にしますか？<br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 18:56:07',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(641,'発行ポイントの保留','MODULE_POINT_CREATEACCOUNT_PENDING','false','ポイント発行時にそのポイントの使用を保留にしますか？<br />保留しない場合はポイント発行後すぐに使用できます。<br />true: 保留にする<br />false: 保留にしない（即時使用可能）',6,1,NULL,'2009-11-19 18:56:07',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(642,'会員登録ポイント数','MODULE_POINT_CREATEACCOUNT_POINT','','会員登録時にその会員へプレゼントするポイント数を設定します。<br />例: 500 (会員登録時に500ポイントプレゼント)',6,2,NULL,'2009-11-19 18:56:07',NULL,NULL),(643,'優先順','MODULE_POINT_CREATEACCOUNT_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,3,NULL,'2009-11-19 18:56:07',NULL,NULL),(644,'顧客毎ポイント還元率設定モジュールの有効化','MODULE_POINT_CUSTOMERSRATE_STATUS','true','顧客毎ポイント還元率設定を有効にしますか？<br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 18:56:29',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(645,'優先順','MODULE_POINT_CUSTOMERSRATE_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,1,NULL,'2009-11-19 18:56:29',NULL,NULL),(646,'顧客グループ毎ポイント還元率設定モジュールの有効化','MODULE_POINT_GROUPRATE_STATUS','true','顧客グループ毎ポイント還元率設定を有効にしますか？<br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 18:56:53',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(647,'優先順','MODULE_POINT_GROUPRATE_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,1,NULL,'2009-11-19 18:56:53',NULL,NULL),(648,'商品毎ポイント還元率設定モジュールの有効化','MODULE_POINT_PRODUCTSRATE_STATUS','true','商品毎ポイント還元率設定を有効にしますか？<br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 18:57:28',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(649,'優先順','MODULE_POINT_PRODUCTSRATE_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,1,NULL,'2009-11-19 18:57:28',NULL,NULL),(650,'ショッピングカートサマリーブロックの有効化','MODULE_SHOPPING_CART_SUMMARY_STATUS','true','ショッピングカートサマリーブロックを有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 19:37:35',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), '),(651,'優先順','MODULE_SHOPPING_CART_SUMMARY_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,1,NULL,'2009-11-19 19:37:35',NULL,NULL);
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
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table `configuration_foreach_template`
--

LOCK TABLES `configuration_foreach_template` WRITE;
/*!40000 ALTER TABLE `configuration_foreach_template` DISABLE KEYS */;
/*!40000 ALTER TABLE `configuration_foreach_template` ENABLE KEYS */;
UNLOCK TABLES;

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
INSERT INTO `configuration_group` VALUES (1,'ショップ全般の設定','ショップの一般的な項目を設定します。',1,1),(2,'最小値の設定','機能・データ類の最小(少)値について設定します。',2,1),(3,'最大値の設定','機能・データ類の最大値について設定します。',3,1),(4,'画像の設定','各種の画像について設定します。',4,1),(5,'顧客アカウントの設定','顧客について各種の設定をします。',5,1),(6,'モジュールの設定','(設定画面では隠れています)',6,0),(7,'配送料・パッケージの設定','拝承料・パッケージ(梱包)について各種の設定をします。',7,1),(8,'商品リストの設定','商品リストの表示について各種の設定をします。',8,1),(9,'在庫の設定','在庫について各種の設定をします。',9,1),(10,'ログの設定','ログについて各種の設定をします。',10,1),(11,'規約関連の設定','規約について各種の設定をします。',16,1),(12,'メールの設定','メールの送受信や書式について各種の設定をします。',12,1),(13,'商品属性の設定','商品属性について各種の設定をします。',13,1),(14,'GZip圧縮の設定','GZip圧縮について設定します。',14,1),(15,'セッション管理の設定','セッション情報の管理について各種の設定をします。',15,1),(16,'ギフト券・クーポン券の設定','ギフト券・クーポン券について各種の設定をします。',16,1),(17,'クレジットカードの設定','クレジットカードについて各種の設定をします。',17,1),(18,'商品情報の設定','商品情報の表示について各種の設定をします。',18,1),(19,'レイアウトの設定','ショップの表示レイアウトについて各種の設定をします。',19,1),(20,'メンテナンス表示の設定','「メンテナンス中」表示などについて各種の設定をします。',20,1),(21,'新着商品リストの設定','新着商品リストについて各種の設定をします。',21,1),(22,'おすすめ商品リストの設定','おすすめ商品リストについて各種の設定をします。',22,1),(23,'全商品リストの設定','全商品リストについて各種の設定をします。',23,1),(24,'トップページの表示設定','トップページの要素表示について各種の設定をします。',24,1),(25,'定番ページの表示設定','定番ページとHTMLAreaなどについて各種の設定をします。',25,1),(30,'EZ-Pagesの設定','EZページについて各種の設定をします。',30,1),(100,'携帯サイトの管理','携帯サイトについて各種の設定をします。',100,1);
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
INSERT INTO `counter` VALUES ('20091119',51);
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
-- Dumping data for table `counter_history`
--

LOCK TABLES `counter_history` WRITE;
/*!40000 ALTER TABLE `counter_history` DISABLE KEYS */;
INSERT INTO `counter_history` VALUES ('20091119',51,8);
/*!40000 ALTER TABLE `counter_history` ENABLE KEYS */;
UNLOCK TABLES;

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
INSERT INTO `countries` VALUES (240,'Aaland Islands','AX','ALA',1),(1,'Afghanistan','AF','AFG',1),(2,'Albania','AL','ALB',1),(3,'Algeria','DZ','DZA',1),(4,'American Samoa','AS','ASM',1),(5,'Andorra','AD','AND',1),(6,'Angola','AO','AGO',1),(7,'Anguilla','AI','AIA',1),(8,'Antarctica','AQ','ATA',1),(9,'Antigua and Barbuda','AG','ATG',1),(10,'Argentina','AR','ARG',1),(11,'Armenia','AM','ARM',1),(12,'Aruba','AW','ABW',1),(13,'Australia','AU','AUS',1),(14,'Austria','AT','AUT',5),(15,'Azerbaijan','AZ','AZE',1),(16,'Bahamas','BS','BHS',1),(17,'Bahrain','BH','BHR',1),(18,'Bangladesh','BD','BGD',1),(19,'Barbados','BB','BRB',1),(20,'Belarus','BY','BLR',1),(21,'Belgium','BE','BEL',1),(22,'Belize','BZ','BLZ',1),(23,'Benin','BJ','BEN',1),(24,'Bermuda','BM','BMU',1),(25,'Bhutan','BT','BTN',1),(26,'Bolivia','BO','BOL',1),(27,'Bosnia and Herzegowina','BA','BIH',1),(28,'Botswana','BW','BWA',1),(29,'Bouvet Island','BV','BVT',1),(30,'Brazil','BR','BRA',1),(31,'British Indian Ocean Territory','IO','IOT',1),(32,'Brunei Darussalam','BN','BRN',1),(33,'Bulgaria','BG','BGR',1),(34,'Burkina Faso','BF','BFA',1),(35,'Burundi','BI','BDI',1),(36,'Cambodia','KH','KHM',1),(37,'Cameroon','CM','CMR',1),(38,'Canada','CA','CAN',1),(39,'Cape Verde','CV','CPV',1),(40,'Cayman Islands','KY','CYM',1),(41,'Central African Republic','CF','CAF',1),(42,'Chad','TD','TCD',1),(43,'Chile','CL','CHL',1),(44,'China','CN','CHN',1),(45,'Christmas Island','CX','CXR',1),(46,'Cocos (Keeling) Islands','CC','CCK',1),(47,'Colombia','CO','COL',1),(48,'Comoros','KM','COM',1),(49,'Congo','CG','COG',1),(50,'Cook Islands','CK','COK',1),(51,'Costa Rica','CR','CRI',1),(52,'Cote D\'Ivoire','CI','CIV',1),(53,'Croatia','HR','HRV',1),(54,'Cuba','CU','CUB',1),(55,'Cyprus','CY','CYP',1),(56,'Czech Republic','CZ','CZE',1),(57,'Denmark','DK','DNK',1),(58,'Djibouti','DJ','DJI',1),(59,'Dominica','DM','DMA',1),(60,'Dominican Republic','DO','DOM',1),(61,'East Timor','TP','TMP',1),(62,'Ecuador','EC','ECU',1),(63,'Egypt','EG','EGY',1),(64,'El Salvador','SV','SLV',1),(65,'Equatorial Guinea','GQ','GNQ',1),(66,'Eritrea','ER','ERI',1),(67,'Estonia','EE','EST',1),(68,'Ethiopia','ET','ETH',1),(69,'Falkland Islands (Malvinas)','FK','FLK',1),(70,'Faroe Islands','FO','FRO',1),(71,'Fiji','FJ','FJI',1),(72,'Finland','FI','FIN',1),(73,'France','FR','FRA',1),(74,'France, Metropolitan','FX','FXX',1),(75,'French Guiana','GF','GUF',1),(76,'French Polynesia','PF','PYF',1),(77,'French Southern Territories','TF','ATF',1),(78,'Gabon','GA','GAB',1),(79,'Gambia','GM','GMB',1),(80,'Georgia','GE','GEO',1),(81,'Germany','DE','DEU',5),(82,'Ghana','GH','GHA',1),(83,'Gibraltar','GI','GIB',1),(84,'Greece','GR','GRC',1),(85,'Greenland','GL','GRL',1),(86,'Grenada','GD','GRD',1),(87,'Guadeloupe','GP','GLP',1),(88,'Guam','GU','GUM',1),(89,'Guatemala','GT','GTM',1),(90,'Guinea','GN','GIN',1),(91,'Guinea-bissau','GW','GNB',1),(92,'Guyana','GY','GUY',1),(93,'Haiti','HT','HTI',1),(94,'Heard and Mc Donald Islands','HM','HMD',1),(95,'Honduras','HN','HND',1),(96,'Hong Kong','HK','HKG',1),(97,'Hungary','HU','HUN',1),(98,'Iceland','IS','ISL',1),(99,'India','IN','IND',1),(100,'Indonesia','ID','IDN',1),(101,'Iran (Islamic Republic of)','IR','IRN',1),(102,'Iraq','IQ','IRQ',1),(103,'Ireland','IE','IRL',1),(104,'Israel','IL','ISR',1),(105,'Italy','IT','ITA',1),(106,'Jamaica','JM','JAM',1),(107,'Japan','JP','JPN',6),(108,'Jordan','JO','JOR',1),(109,'Kazakhstan','KZ','KAZ',1),(110,'Kenya','KE','KEN',1),(111,'Kiribati','KI','KIR',1),(112,'Korea, Democratic People\'s Republic of','KP','PRK',1),(113,'Korea, Republic of','KR','KOR',1),(114,'Kuwait','KW','KWT',1),(115,'Kyrgyzstan','KG','KGZ',1),(116,'Lao People\'s Democratic Republic','LA','LAO',1),(117,'Latvia','LV','LVA',1),(118,'Lebanon','LB','LBN',1),(119,'Lesotho','LS','LSO',1),(120,'Liberia','LR','LBR',1),(121,'Libyan Arab Jamahiriya','LY','LBY',1),(122,'Liechtenstein','LI','LIE',1),(123,'Lithuania','LT','LTU',1),(124,'Luxembourg','LU','LUX',1),(125,'Macau','MO','MAC',1),(126,'Macedonia, The Former Yugoslav Republic of','MK','MKD',1),(127,'Madagascar','MG','MDG',1),(128,'Malawi','MW','MWI',1),(129,'Malaysia','MY','MYS',1),(130,'Maldives','MV','MDV',1),(131,'Mali','ML','MLI',1),(132,'Malta','MT','MLT',1),(133,'Marshall Islands','MH','MHL',1),(134,'Martinique','MQ','MTQ',1),(135,'Mauritania','MR','MRT',1),(136,'Mauritius','MU','MUS',1),(137,'Mayotte','YT','MYT',1),(138,'Mexico','MX','MEX',1),(139,'Micronesia, Federated States of','FM','FSM',1),(140,'Moldova, Republic of','MD','MDA',1),(141,'Monaco','MC','MCO',1),(142,'Mongolia','MN','MNG',1),(143,'Montserrat','MS','MSR',1),(144,'Morocco','MA','MAR',1),(145,'Mozambique','MZ','MOZ',1),(146,'Myanmar','MM','MMR',1),(147,'Namibia','NA','NAM',1),(148,'Nauru','NR','NRU',1),(149,'Nepal','NP','NPL',1),(150,'Netherlands','NL','NLD',1),(151,'Netherlands Antilles','AN','ANT',1),(152,'New Caledonia','NC','NCL',1),(153,'New Zealand','NZ','NZL',1),(154,'Nicaragua','NI','NIC',1),(155,'Niger','NE','NER',1),(156,'Nigeria','NG','NGA',1),(157,'Niue','NU','NIU',1),(158,'Norfolk Island','NF','NFK',1),(159,'Northern Mariana Islands','MP','MNP',1),(160,'Norway','NO','NOR',1),(161,'Oman','OM','OMN',1),(162,'Pakistan','PK','PAK',1),(163,'Palau','PW','PLW',1),(164,'Panama','PA','PAN',1),(165,'Papua New Guinea','PG','PNG',1),(166,'Paraguay','PY','PRY',1),(167,'Peru','PE','PER',1),(168,'Philippines','PH','PHL',1),(169,'Pitcairn','PN','PCN',1),(170,'Poland','PL','POL',1),(171,'Portugal','PT','PRT',1),(172,'Puerto Rico','PR','PRI',1),(173,'Qatar','QA','QAT',1),(174,'Reunion','RE','REU',1),(175,'Romania','RO','ROM',1),(176,'Russian Federation','RU','RUS',1),(177,'Rwanda','RW','RWA',1),(178,'Saint Kitts and Nevis','KN','KNA',1),(179,'Saint Lucia','LC','LCA',1),(180,'Saint Vincent and the Grenadines','VC','VCT',1),(181,'Samoa','WS','WSM',1),(182,'San Marino','SM','SMR',1),(183,'Sao Tome and Principe','ST','STP',1),(184,'Saudi Arabia','SA','SAU',1),(185,'Senegal','SN','SEN',1),(186,'Seychelles','SC','SYC',1),(187,'Sierra Leone','SL','SLE',1),(188,'Singapore','SG','SGP',4),(189,'Slovakia (Slovak Republic)','SK','SVK',1),(190,'Slovenia','SI','SVN',1),(191,'Solomon Islands','SB','SLB',1),(192,'Somalia','SO','SOM',1),(193,'South Africa','ZA','ZAF',1),(194,'South Georgia and the South Sandwich Islands','GS','SGS',1),(195,'Spain','ES','ESP',3),(196,'Sri Lanka','LK','LKA',1),(197,'St. Helena','SH','SHN',1),(198,'St. Pierre and Miquelon','PM','SPM',1),(199,'Sudan','SD','SDN',1),(200,'Suriname','SR','SUR',1),(201,'Svalbard and Jan Mayen Islands','SJ','SJM',1),(202,'Swaziland','SZ','SWZ',1),(203,'Sweden','SE','SWE',1),(204,'Switzerland','CH','CHE',1),(205,'Syrian Arab Republic','SY','SYR',1),(206,'Taiwan','TW','TWN',1),(207,'Tajikistan','TJ','TJK',1),(208,'Tanzania, United Republic of','TZ','TZA',1),(209,'Thailand','TH','THA',1),(210,'Togo','TG','TGO',1),(211,'Tokelau','TK','TKL',1),(212,'Tonga','TO','TON',1),(213,'Trinidad and Tobago','TT','TTO',1),(214,'Tunisia','TN','TUN',1),(215,'Turkey','TR','TUR',1),(216,'Turkmenistan','TM','TKM',1),(217,'Turks and Caicos Islands','TC','TCA',1),(218,'Tuvalu','TV','TUV',1),(219,'Uganda','UG','UGA',1),(220,'Ukraine','UA','UKR',1),(221,'United Arab Emirates','AE','ARE',1),(222,'United Kingdom','GB','GBR',1),(223,'United States','US','USA',2),(224,'United States Minor Outlying Islands','UM','UMI',1),(225,'Uruguay','UY','URY',1),(226,'Uzbekistan','UZ','UZB',1),(227,'Vanuatu','VU','VUT',1),(228,'Vatican City State (Holy See)','VA','VAT',1),(229,'Venezuela','VE','VEN',1),(230,'Viet Nam','VN','VNM',1),(231,'Virgin Islands (British)','VG','VGB',1),(232,'Virgin Islands (U.S.)','VI','VIR',1),(233,'Wallis and Futuna Islands','WF','WLF',1),(234,'Western Sahara','EH','ESH',1),(235,'Yemen','YE','YEM',1),(236,'Yugoslavia','YU','YUG',1),(237,'Zaire','ZR','ZAR',1),(238,'Zambia','ZM','ZMB',1),(239,'Zimbabwe','ZW','ZWE',1);
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
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table `coupon_email_track`
--

LOCK TABLES `coupon_email_track` WRITE;
/*!40000 ALTER TABLE `coupon_email_track` DISABLE KEYS */;
/*!40000 ALTER TABLE `coupon_email_track` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `coupon_gv_customer`
--

LOCK TABLES `coupon_gv_customer` WRITE;
/*!40000 ALTER TABLE `coupon_gv_customer` DISABLE KEYS */;
/*!40000 ALTER TABLE `coupon_gv_customer` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table `coupon_redeem_track`
--

LOCK TABLES `coupon_redeem_track` WRITE;
/*!40000 ALTER TABLE `coupon_redeem_track` DISABLE KEYS */;
/*!40000 ALTER TABLE `coupon_redeem_track` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table `coupons`
--

LOCK TABLES `coupons` WRITE;
/*!40000 ALTER TABLE `coupons` DISABLE KEYS */;
/*!40000 ALTER TABLE `coupons` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `coupons_description`
--

LOCK TABLES `coupons_description` WRITE;
/*!40000 ALTER TABLE `coupons_description` DISABLE KEYS */;
/*!40000 ALTER TABLE `coupons_description` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `csv_columns`
--

LOCK TABLES `csv_columns` WRITE;
/*!40000 ALTER TABLE `csv_columns` DISABLE KEYS */;
INSERT INTO `csv_columns` VALUES (1001,1,'商品タイプ','validateProductTypeExists','product_types','type_handler'),(1002,1,'在庫数','validateIsSignedFloat','products','products_quantity'),(1003,1,'型番','validateIsString','products','products_model'),(1004,1,'商品画像名','validateIsPathString','products','products_image'),(1005,1,'価格','validateIsFloat','products','products_price'),(1006,1,'配送不要フラグ','validateIsZeroOne','products','products_virtual'),(1007,1,'登録日','validateIsDatetimeLong','products','products_date_added'),(1008,1,'発売日','validateIsDatetimeLong','products','products_date_available'),(1009,1,'重量(Kg)','validateIsFloat','products','products_weight'),(1010,1,'表示非表示フラグ','validateIsZeroOne','products','products_status'),(1011,1,'税種別','validateTaxClassExists','tax_class','tax_class_title'),(1012,1,'メーカー','validateIsString','manufacturers','manufacturers_name'),(1013,1,'商品既注文数','validateIsInt','products','products_ordered'),(1014,1,'購入可能最小個数','validateIsInt','products','products_quantity_order_min'),(1015,1,'購入可能最大個数','validateIsInt','products','products_quantity_order_max'),(1016,1,'購入個数単位','validateIsInt','products','products_quantity_order_units'),(1017,1,'無料商品フラグ','validateIsZeroOne','products','product_is_free'),(1018,1,'お問い合わせ商品フラグ','validateIsZeroOne','products','product_is_call'),(1019,1,'オプション価格を含むフラグ','validateIsZeroOne','products','products_priced_by_attribute'),(1020,1,'最小数量 単位MIXフラグ','validateIsZeroOne','products','products_quantity_mixed'),(1021,1,'無料配送フラグ','validateIsZeroOne','products','product_is_always_free_shipping'),(1022,1,'数量入力欄表示フラグ','validateIsZeroOne','products','products_qty_box_status'),(1023,1,'並び順','validateIsSignedInt','products','products_sort_order'),(1100,1,'商品名(English):language_id=1','validateIsString','products_description','products_name'),(1101,1,'商品名(Japanese):language_id=2','validateIsString','products_description','products_name'),(1200,1,'商品説明(English):language_id=1','validateIsStringWithReturn','products_description','products_description'),(1201,1,'商品説明(Japanese):language_id=2','validateIsStringWithReturn','products_description','products_description'),(1300,1,'商品URL(English):language_id=1','validateIsUrlString','products_description','products_url'),(1301,1,'商品URL(Japanese):language_id=2','validateIsUrlString','products_description','products_url'),(1400,1,'タイトル(English):language_id=1','validateIsString','meta_tags_products_description','metatags_title'),(1401,1,'タイトル(Japanese):language_id=2','validateIsString','meta_tags_products_description','metatags_title'),(1500,1,'METAキーワード(English):language_id=1','validateIsString','meta_tags_products_description','metatags_keywords'),(1501,1,'METAキーワード(Japanese):language_id=2','validateIsString','meta_tags_products_description','metatags_keywords'),(1600,1,'METAデスクリプション(English):language_id=1','validateIsStringWithReturn','meta_tags_products_description','metatags_description'),(1601,1,'METAデスクリプション(Japanese):language_id=2','validateIsStringWithReturn','meta_tags_products_description','metatags_description'),(1700,1,'おすすめ開始日','validateIsDatetimeShort','featured','featured_date_available'),(1701,1,'おすすめ終了日','validateIsDatetimeShort','featured','expires_date'),(1702,1,'特価価格','validateIsFloat','specials','specials_new_products_price'),(1703,1,'特価価格開始日','validateIsDatetimeShort','specials','specials_date_available'),(1704,1,'特価価格終了日','validateIsDatetimeShort','specials','expires_date'),(1706,1,'商品削除フラグ','validateIsZeroOne','','delete'),(1707,1,'無視','','','ignore'),(2000,2,'カテゴリ名(English)-階層1:language_id=1','validateIsString','categories_description','categories_name'),(2001,2,'カテゴリ名(Japanese)-階層1:language_id=2','validateIsString','categories_description','categories_name'),(2050,2,'カテゴリ名(English)-階層2:language_id=1','validateIsString','categories_description','categories_name'),(2051,2,'カテゴリ名(Japanese)-階層2:language_id=2','validateIsString','categories_description','categories_name'),(2100,2,'カテゴリ名(English)-階層3:language_id=1','validateIsString','categories_description','categories_name'),(2101,2,'カテゴリ名(Japanese)-階層3:language_id=2','validateIsString','categories_description','categories_name'),(2150,2,'カテゴリ名(English)-階層4:language_id=1','validateIsString','categories_description','categories_name'),(2151,2,'カテゴリ名(Japanese)-階層4:language_id=2','validateIsString','categories_description','categories_name'),(2200,2,'カテゴリ名(English)-階層5:language_id=1','validateIsString','categories_description','categories_name'),(2201,2,'カテゴリ名(Japanese)-階層5:language_id=2','validateIsString','categories_description','categories_name'),(2250,2,'カテゴリ名(English)-階層6:language_id=1','validateIsString','categories_description','categories_name'),(2251,2,'カテゴリ名(Japanese)-階層6:language_id=2','validateIsString','categories_description','categories_name'),(2300,2,'カテゴリ名(English)-階層7:language_id=1','validateIsString','categories_description','categories_name'),(2301,2,'カテゴリ名(Japanese)-階層7:language_id=2','validateIsString','categories_description','categories_name'),(2350,2,'カテゴリ名(English)-階層8:language_id=1','validateIsString','categories_description','categories_name'),(2351,2,'カテゴリ名(Japanese)-階層8:language_id=2','validateIsString','categories_description','categories_name'),(2400,2,'カテゴリ名(English)-階層9:language_id=1','validateIsString','categories_description','categories_name'),(2401,2,'カテゴリ名(Japanese)-階層9:language_id=2','validateIsString','categories_description','categories_name'),(2450,2,'カテゴリ名(English)-階層10:language_id=1','validateIsString','categories_description','categories_name'),(2451,2,'カテゴリ名(Japanese)-階層10:language_id=2','validateIsString','categories_description','categories_name'),(2500,2,'カテゴリ説明(English):language_id=1','validateIsStringWithReturn','categories_description','categories_description'),(2501,2,'カテゴリ説明(Japanese):language_id=2','validateIsStringWithReturn','categories_description','categories_description'),(2600,2,'カテゴリ画像ファイル名','validateIsPathString','categories','categories_image'),(2601,2,'カテゴリ並び順','validateIsSignedInt','categories','sort_order'),(2602,2,'カテゴリ有効無効フラグ','validateIsZeroOne','categories','categories_status'),(2603,2,'型番','validateIsString','products','products_model'),(2650,2,'タイトル(English):language_id=1','validateIsString','meta_tags_categories_description','metatags_title'),(2651,2,'タイトル(Japanese):language_id=2','validateIsString','meta_tags_categories_description','metatags_title'),(2700,2,'METAキーワード(English):language_id=1','validateIsString','meta_tags_categories_description','metatags_keywords'),(2701,2,'METAキーワード(Japanese):language_id=2','validateIsString','meta_tags_categories_description','metatags_keywords'),(2750,2,'METAデスクリプション(English):language_id=1','validateIsStringWithReturn','meta_tags_categories_description','metatags_description'),(2751,2,'METAデスクリプション(Japanese):language_id=2','validateIsStringWithReturn','meta_tags_categories_description','metatags_description'),(2800,2,'カテゴリ紐付き削除フラグ','validateIsZeroOne','','delete'),(2801,2,'無視','','','ignore'),(3000,3,'オプション名(English):language_id=1','validateIsNotReservedOptionName','products_options','products_options_name'),(3001,3,'オプション名(Japanese):language_id=2','validateIsNotReservedOptionName','products_options','products_options_name'),(3050,3,'オプション値(English):language_id=1','validateIsString','products_options_values','products_options_values_name'),(3051,3,'オプション値(Japanese):language_id=2','validateIsString','products_options_values','products_options_values_name'),(3100,3,'型番','validateIsString','products','products_model'),(3101,3,'価格','validateIsFloat','products_attributes','options_values_price'),(3102,3,'価格正負','validateIsPlusMinus','products_attributes','price_prefix'),(3103,3,'並び順','validateIsSignedInt','products_attributes','products_options_sort_order'),(3104,3,'無料フラグ','validateIsZeroOne','products_attributes','product_attribute_is_free'),(3105,3,'重量','validateIsFloat','products_attributes','products_attributes_weight'),(3106,3,'重量正負','validateIsPlusMinus','products_attributes','products_attributes_weight_prefix'),(3107,3,'表示のみフラグ','validateIsZeroOne','products_attributes','attributes_display_only'),(3108,3,'デフォルトフラグ','validateIsZeroOne','products_attributes','attributes_default'),(3109,3,'価格割引適用フラグ','validateIsZeroOne','products_attributes','attributes_discounted'),(3110,3,'オプション価格合算フラグ','validateIsZeroOne','products_attributes','attributes_price_base_included'),(3111,3,'画像ファイル名','validateIsPathString','products_attributes','attributes_image'),(3112,3,'必須フラグ','validateIsZeroOne','products_attributes','attributes_required'),(3113,3,'オプション紐付き削除フラグ','validateIsZeroOne','','delete'),(3114,3,'無視','','','ignore');
/*!40000 ALTER TABLE `csv_columns` ENABLE KEYS */;
UNLOCK TABLES;

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
INSERT INTO `csv_format_columns` VALUES (1,1,1001,1),(2,1,1002,2),(3,1,1003,3),(4,1,1004,4),(5,1,1005,5),(6,1,1006,6),(7,1,1007,7),(8,1,1008,8),(9,1,1009,9),(10,1,1010,10),(11,1,1011,11),(12,1,1012,12),(13,1,1013,13),(14,1,1014,14),(15,1,1015,15),(16,1,1016,16),(17,1,1017,17),(18,1,1018,18),(19,1,1019,19),(20,1,1020,20),(21,1,1021,21),(22,1,1022,22),(23,1,1023,23),(24,1,1100,24),(25,1,1101,25),(26,1,1200,26),(27,1,1201,27),(28,1,1300,28),(29,1,1301,29),(30,1,1400,30),(31,1,1401,31),(32,1,1500,32),(33,1,1501,33),(34,1,1600,34),(35,1,1601,35),(36,1,1700,36),(37,1,1701,37),(38,1,1702,38),(39,1,1703,39),(40,1,1704,40),(41,1,1706,41),(42,1,1707,42),(43,2,2000,1),(44,2,2001,2),(45,2,2050,3),(46,2,2051,4),(47,2,2100,5),(48,2,2101,6),(49,2,2150,7),(50,2,2151,8),(51,2,2200,9),(52,2,2201,10),(53,2,2250,11),(54,2,2251,12),(55,2,2300,13),(56,2,2301,14),(57,2,2350,15),(58,2,2351,16),(59,2,2400,17),(60,2,2401,18),(61,2,2450,19),(62,2,2451,20),(63,2,2500,21),(64,2,2501,22),(65,2,2600,23),(66,2,2601,24),(67,2,2602,25),(68,2,2603,26),(69,2,2650,27),(70,2,2651,28),(71,2,2700,29),(72,2,2701,30),(73,2,2750,31),(74,2,2751,32),(75,2,2800,33),(76,2,2801,34),(77,3,3000,1),(78,3,3001,2),(79,3,3050,3),(80,3,3051,4),(81,3,3100,5),(82,3,3101,6),(83,3,3102,7),(84,3,3103,8),(85,3,3104,9),(86,3,3105,10),(87,3,3106,11),(88,3,3107,12),(89,3,3108,13),(90,3,3109,14),(91,3,3110,15),(92,3,3111,16),(93,3,3112,17),(94,3,3113,18),(95,3,3114,19);
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
INSERT INTO `csv_format_types` VALUES (1,'商品マスタ'),(2,'商品カテゴリ'),(3,'商品オプション');
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
INSERT INTO `csv_formats` VALUES (1,1,'商品マスタ(全て)','2009-11-19 13:04:30','2009-11-19 13:04:30'),(2,2,'商品カテゴリ(全て)','2009-11-19 13:04:30','2009-11-19 13:04:30'),(3,3,'商品オプション(全て)','2009-11-19 13:04:30','2009-11-19 13:04:30');
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
INSERT INTO `currencies` VALUES (1,'US Dollar','USD','$','','.',',','2',0.00936500,'2009-11-19 12:39:40'),(2,'Euro','EUR','','EUR','.',',','2',0.00759400,'2009-11-19 12:39:40'),(3,'Japanese Yen','JPY','','円','.',',','',1.00000000,'2009-11-19 12:39:40');
/*!40000 ALTER TABLE `currencies` ENABLE KEYS */;
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
  PRIMARY KEY  (`customers_id`),
  KEY `idx_email_address_zen` (`customers_email_address`),
  KEY `idx_referral_zen` (`customers_referral`(10)),
  KEY `idx_grp_pricing_zen` (`customers_group_pricing`),
  KEY `idx_nick_zen` (`customers_nick`),
  KEY `idx_newsletter_zen` (`customers_newsletter`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,'m','Bill','Smith','2001-01-01 00:00:00','root@localhost','',1,'12345','','d95e8fa7f20a009372eb3477473fcd34:1c','0',0,'TEXT',0,'','','',NULL),(2,'m','saito','s','0001-01-01 00:00:00','saito@ark-web.jp','',2,'0123456789','','','0',0,'',0,'','さいとう','さ',NULL);
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `customers_basket`
--

LOCK TABLES `customers_basket` WRITE;
/*!40000 ALTER TABLE `customers_basket` DISABLE KEYS */;
INSERT INTO `customers_basket` VALUES (1,2,'190:e468d7a4871dca5f6c31f42a03a7c4a2',1,'0.0000','20091119');
/*!40000 ALTER TABLE `customers_basket` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `customers_basket_attributes`
--

LOCK TABLES `customers_basket_attributes` WRITE;
/*!40000 ALTER TABLE `customers_basket_attributes` DISABLE KEYS */;
INSERT INTO `customers_basket_attributes` VALUES (1,2,'190:e468d7a4871dca5f6c31f42a03a7c4a2','3',4,'','100.00110');
/*!40000 ALTER TABLE `customers_basket_attributes` ENABLE KEYS */;
UNLOCK TABLES;

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
INSERT INTO `customers_info` VALUES (1,'0001-01-01 00:00:00',0,'2004-01-21 01:35:28','0001-01-01 00:00:00',0),(2,NULL,0,'2009-11-19 15:19:04',NULL,0);
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
-- Dumping data for table `customers_points`
--

LOCK TABLES `customers_points` WRITE;
/*!40000 ALTER TABLE `customers_points` DISABLE KEYS */;
/*!40000 ALTER TABLE `customers_points` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `customers_wishlist`
--

LOCK TABLES `customers_wishlist` WRITE;
/*!40000 ALTER TABLE `customers_wishlist` DISABLE KEYS */;
/*!40000 ALTER TABLE `customers_wishlist` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `easy_admin_sub_menus`
--

LOCK TABLES `easy_admin_sub_menus` WRITE;
/*!40000 ALTER TABLE `easy_admin_sub_menus` DISABLE KEYS */;
INSERT INTO `easy_admin_sub_menus` VALUES (1,1,'顧客管理','customers.php',1),(2,1,'注文管理','orders.php',2),(3,2,'カテゴリ・商品の管理','categories.php',1),(4,2,'商品価格の管理','products_price_manager.php',2),(5,4,'管理者の設定','admin.php',1),(6,4,'管理メニューの設定','addon_modules_admin.php?module=easy_admin',2);
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
INSERT INTO `easy_admin_top_menus` VALUES (1,'注文・顧客管理',1,0),(2,'商品管理',1,0),(3,'コンテンツ管理',1,0),(4,'初期設定',0,0),(5,'その他',0,0);
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
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `easy_design_colors`
--

LOCK TABLES `easy_design_colors` WRITE;
/*!40000 ALTER TABLE `easy_design_colors` DISABLE KEYS */;
INSERT INTO `easy_design_colors` VALUES (1,'template_default','maincolor','メインカラー','#f4f4f4'),(2,'template_default','subcolor','サブカラー','#ffffff'),(3,'classic','maincolor','メインカラー','#f4f4f4'),(4,'classic','subcolor','サブカラー','#ffffff'),(5,'sugudeki','maincolor','メインカラー','#FF6347'),(6,'addon_modules','maincolor','メインカラー','#f4f4f4'),(7,'addon_modules','subcolor','サブカラー','#ffffff'),(8,'zen_mobile','maincolor','メインカラー','#f4f4f4'),(9,'zen_mobile','subcolor','サブカラー','#ffffff');
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
INSERT INTO `easy_design_languages` VALUES (1,2,'EASY_DESIGN_TAGLINE','タグライン','ECサイトがすぐできる！',1),(2,2,'EASY_DESIGN_KEY_COPYLIGHT','コピーライト','Zen-Cart すぐでき（る）パック',2);
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
-- Dumping data for table `email_archive`
--

LOCK TABLES `email_archive` WRITE;
/*!40000 ALTER TABLE `email_archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `email_archive` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_templates`
--

DROP TABLE IF EXISTS `email_templates`;
CREATE TABLE `email_templates` (
  `id` smallint(6) NOT NULL auto_increment,
  `grp` varchar(50) NOT NULL default '',
  `title` varchar(255) NOT NULL default '',
  `subject` varchar(255) NOT NULL default '',
  `contents` text NOT NULL,
  `updated` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `email_templates`
--

LOCK TABLES `email_templates` WRITE;
/*!40000 ALTER TABLE `email_templates` DISABLE KEYS */;
INSERT INTO `email_templates` VALUES (1,'ユーザー登録','ユーザー登録ありがとうございます','ユーザー登録ありがとうございます','ユーザー登録ありがとうございます\r\n\r\nこれからもよろしくお願いします。','2009-11-19 13:01:34'),(2,'注文完了','ご注文ありがとうございます[会員用]','ご注文ありがとうございます','注文確認書 from XXXXXXXX\r\n\r\n[CUSTOMER_NAME] 様\r\n\r\nご利用ありがとうございます。\r\nご注文内容は以下の通りです。\r\n------------------------------------------------------\r\nご注文番号: [ORDER_ID]\r\nご注文日: [DATE_ORDERED]\r\n請求明細書:\r\n[INVOICE_URL]\r\n\r\n[COMMENT]\r\n\r\n商品\r\n------------------------------------------------------\r\n[PRODUCTS_ORDERED]\r\n------------------------------------------------------\r\n[TOTALS]\r\n\r\nお届け先\r\n------------------------------------------------------\r\n[DELIVERY_ADDRESS]\r\n\r\n請求先住所\r\n------------------------------------------------------\r\n[BILLING_ADDRESS]\r\n\r\nお支払い方法\r\n------------------------------------------------------\r\n[PAYMENT_METHOD]\r\n\r\n\r\n-----\r\nこのメールは当ショップに登録されたお客様に対してお送りしています。\r\nお心当たりが無いようでしたら大変お手数ですがメールにて\r\nxxxxxxx@example.org までご連絡ください。\r\n\r\n-----\r\nCopyright (c) XXXXXXXX Inc. All Rights Reserved\r\n','2009-11-19 13:01:34'),(3,'注文完了','ご注文ありがとうございます[ゲスト用]','ご注文ありがとうございます','注文確認書 from XXXXXXXX\r\n\r\n[CUSTOMER_NAME] 様\r\n\r\nご利用ありがとうございます。\r\nご注文内容は以下の通りです。\r\n------------------------------------------------------\r\nご注文番号: [ORDER_ID]\r\nご注文日: [DATE_ORDERED]\r\n\r\n[COMMENT]\r\n\r\n商品\r\n------------------------------------------------------\r\n[PRODUCTS_ORDERED]\r\n------------------------------------------------------\r\n[TOTALS]\r\n\r\nお届け先\r\n------------------------------------------------------\r\n[DELIVERY_ADDRESS]\r\n\r\n請求先住所\r\n------------------------------------------------------\r\n[BILLING_ADDRESS]\r\n\r\nお支払い方法\r\n------------------------------------------------------\r\n[PAYMENT_METHOD]\r\n\r\n\r\n-----\r\nこのメールは当ショップに登録されたお客様に対してお送りしています。\r\nお心当たりが無いようでしたら大変お手数ですがメールにて\r\nxxxxxxx@example.org までご連絡ください。\r\n\r\n-----\r\nCopyright (c) XXXXXXXX Inc. All Rights Reserved\r\n','2009-11-19 13:01:34'),(4,'ユーザ通知','ステータス変更','ご注文受付状況のお知らせ','\r\n[CUSTOMER_NAME]様\r\n\r\nご利用ありがとうございます。\r\n[DATE_ORDERED]にご利用いただいた\r\nご注文受付番号：[ORDER_ID]の状況が変更されましたのでお知らせします。\r\n\r\nご注文についての情報は下記URLでご覧いただけます。\r\n[INVOICE_URL]\r\n\r\nよろしくお願いします。\r\n\r\n-----\r\nこのメールは当ショップに登録されたお客様に対してお送りしています。\r\nお心当たりが無いようでしたら大変お手数ですがメールにて\r\nxxxxxxx@example.org までご連絡ください。\r\n\r\n-----\r\nCopyright (c) XXXXXXXX Inc. All Rights Reserved\r\n','2009-11-19 13:01:34');
/*!40000 ALTER TABLE `email_templates` ENABLE KEYS */;
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
INSERT INTO `ezpages` VALUES (1,1,'EZページ','','','このページは、ヘッダにある「EZページ」からリンクされているページ群のメインページです。<br />\r\n<br />\r\n<strong>注意：EZページの活用方法については「EZ(イージー)ページとは?」を参照してください。</strong><br />\r\n<br />\r\n「EZページ」ボタンは、ヘッダ、サイドボックス、フッタのいずれか、または全ての場所に表示することができます。<br />\r\n<br />\r\nグルーピングを設定すると、グループ化されたページ郡の目次を表示することができます。<br />\r\n<br />\r\n他のページは、このメインページに設置した目次からリンクするか、またはヘッダーにメニューとして表示することもできます。好みで設定してください。<br />\r\n<br />\r\n',1,0,0,1,10,0,0,10,0,0,10),(2,2,'追加ページ1(EZページの例)','','','このページは追加ページの例です。<br />\r\n<br />\r\nグループID10でグルーピングされ、目次は、表示順に従ってソートされています。<br />\r\n<br />\r\nこのページにはヘッダ、フッタ、サイドボックスからのリンクはなく、メインページの目次に表示されます。<br />\r\n<br />\r\n',0,0,0,1,0,0,0,30,0,0,10),(3,2,'追加ページ2(EZページの例)','','','このページは、グループID10に属するもう1つの追加ページです。<br />\r\n<br />\r\nグループ内の表示順は10・20・30といった順であれば自由にナンバー付けすることができます。また、後でページを追加したり、すでにあるページへのリンクを追加したりすることができます。<br />\r\n<br />\r\nグループの単位にまとめることができるページやリンク先に制限はありません。<br />\r\n<br />\r\n[前へ][次へ]ボタンや、目次の表示・非表示については、設定画面で切り替えることができます。',0,0,0,1,0,0,0,40,0,0,10),(4,2,'Myリンク(EZページの例)','','','これは、サイドボックスにリンクが表示される単独のページの例です。<br />\r\n<br />\r\nこのページは章に属していないので、他の追加ページへのリンクはありません。<br />\r\n<br />\r\nあとからページを作成し、章や目次について設定することもできます。<br />\r\n<br />\r\n章に属していないページでは、[前へ] [次へ] ボタンや目次は自動的に非表示となります。',0,1,0,0,0,10,0,0,0,0,0),(5,2,'何かのページ(EZページの例)','','','ページタイトルとリンク名は、コンテンツの内容を考慮して自由に設定することができます。<br />\r\n<br />\r\nまた、リンクの表示場所はヘッダ、サイドボックス、フッタから1ヵ所だけ・全てなどを設定できます。<br />\r\n<br />\r\nこのページからのリンクを、同一ウィンドウで開くか別ウィンドウで開くか、リンク先は非セキュア(非SSL)ページかセキュア(SSL)ページか、などを設定することもできます。',0,1,0,0,0,20,0,0,0,0,0),(6,2,'シェアード(Shared)ページ(EZページの例)','','','このページはヘッダ、サイドボックス、フッタからのシェアード(Shared)リンクが張られたページの例です。<br />\r\n<br />\r\nソート順はわかりやすく50に設定してありますが、ヘッダ、サイドボックス、フッタのそれぞれで違うものにすることもできます。<br />\r\n<br />\r\n',1,1,1,0,50,50,50,0,0,0,0),(7,2,'Myアカウント(EZページの例)','index.php?main_page=account','','',0,0,1,0,0,0,10,0,0,1,0),(8,2,'サイトマップ(EZページの例)','index.php?main_page=site_map','','',0,1,1,0,0,40,20,0,0,0,0),(9,2,'個人情報保護方針(EZページの例)','index.php?main_page=privacy','','',1,0,1,0,30,0,40,0,0,0,0),(10,2,'Zen Cartについて(EZページの例)','','http://www.zen-cart.com','',1,0,0,0,60,0,0,0,1,0,0),(11,2,'ギフト券について(EZページの例)','index.php?main_page=index&cPath=21','','',0,1,0,0,0,60,0,0,0,0,0),(12,2,'DVD - アクション(EZページの例)','index.php?main_page=index&cPath=3_10','','',0,0,1,0,0,0,60,0,0,0,0),(13,2,'Googleについて(EZページの例)','','http://www.google.com','',0,1,0,0,0,70,0,0,1,0,0),(14,2,'EZ(イージー)ページとは?','','','<table cellspacing=\"4\" cellpadding=\"4\" border=\"3\" align=\"center\" style=\"width: 80%;\"><tbody><tr><td><span style=\"font-style: italic;\"><span style=\"font-weight: bold;\">注意：このEZページは、HTMLareaを使って作成しました。ですので、他のエディタではうまく表示できない可能性があります。</span></span></td></tr></tbody></table><br />\r\n<br />\r\n<span style=\"font-weight: bold; color: rgb(255, 0, 0);\">まとめ</span><br />\r\n<br />\r\n<span style=\"font-weight: bold;\">EZページ</span>では、追加ページの作成や、リンクの設定を簡単に行うことができます。<br />\r\n<br />\r\n追加ページの用途の例：<br />\r\n<ul><li>新規ページ</li><li>サイト内リンクのページ</li><li>サイト外リンクのページ</li><li>セキュア(SSL)/非セキュア(非SSL)ページ</li><li>同一ウィンドウで開くページ/別ウィンドウで開くページ</li></ul>さらにページ同士をグループでまとめ、その「目次」を表示することもできます。<br />\r\n<br />\r\n<span style=\"font-weight: bold; color: rgb(255, 0, 0);\">リンクの命名</span><br />\r\n<br />\r\nリンクはページタイトルで命名されます。すべてのリンクは、機能するためにはページタイトルが必要であり、これを忘れるとリンクを追加することができません。<br />\r\n<br />\r\n<span style=\"font-weight: bold;\"><span style=\"color: rgb(255, 0, 0);\">リンクの設置</span><br />\r\n<br />\r\n</span>管理画面で、ヘッダ、サイドボックス、フッタのどこに表示するかを設定する必要があります。3ヵ所全てに表示することも、好みの場所だけに表示することもできます。<br />\r\n30をヘッダに、50をサイドボックスに、といった設定も可能です。<br />\r\nナンバーの振り方は自由ですが、たとえば10・20・30というナンバー付けをすれば、ソートに役立ち、また後から(それらの間に)リンクを追加することもできるでしょう。<br />\r\n<br />\r\n注意：値を「0」にするとリンクは表示されなくなります。<br />\r\n<br />\r\n<span style=\"font-weight: bold;\"><span style=\"color: rgb(255, 0, 0);\">「別ウィンドウで開く」とセキュア(SSL対応)ページ</span><br />\r\n</span><br />\r\nEZページでは、リンク先を通常のように同一ウィンドウで開くことも、また新規ウィンドウで開くように設定することもできます。<br />\r\nまた、リンク先をセキュア(SSL対応)ページで開くか、非セキュア(SSL非対応)ページとして開くかを設定することもできます。<br />\r\n<br />\r\n<span style=\"font-weight: bold; color: rgb(255, 0, 0);\">「グルーピング」</span><br style=\"font-weight: bold; color: rgb(255, 0, 0);\" /><br />\r\n「グルーピング」は、EZページ同士をまとめ相互をリンクさせるスマートな方法です。<br />\r\n<br />\r\nEZページで作成された複数のページ群がある際に、そのメインページへのリンクをヘッダ、サイドボックス、フッタのいずれかに表示するリンク設定をしましょう。<br />\r\n次に、そのリンクと関連づけるグループIDを設定します。<br />\r\nそして、グループ内の表示順を設定してください。これが目次の並び順になります。<br />\r\n<br />\r\n<span style=\"font-weight: bold; font-style: italic;\">注意：ヘッダ、サイドボックス、フッタには、グループに含まれる全てのページをリンクとして表示することもでき、ヘッダにはAというページを、フッタにはBというページを、と設定することもできます。または、グループのメインページか特定のページが開いている際にだけ表示するリンクを設定することもできます。</span><br />\r\n<br />\r\n<span style=\"color: rgb(255, 0, 0); font-weight: bold;\">「外部リンク」</span><br />\r\n<br />\r\n「外部リンク」は、あなたのショップ外のページへのリンクです。このページへのリンクは \"http://www.sashbox.net/\" のように設定します。<br />\r\nリンク先を同一ウィンドウで開くか、別ウィンドウで開くかを設定することができます。<br />\r\n<br />\r\n<span style=\"color: rgb(255, 0, 0); font-weight: bold;\">「内部リンク」</span><br />\r\n<br />\r\n「内部リンク」はあなたのショップ内のページへのリンクです。このページへのリンクは、たとえばID21のカテゴリへリンクする際には \"index.php?main_page=index&cPath=21\" のように相対パスで設定します。絶対パスで記入する際には、ドメインを変更した際などに修正する必要があることに注意してください。<br />\r\nリンク先を同一ウィンドウで開くか、別ウィンドウで開くかを設定することができます。<br />\r\n<br />\r\n<span style=\"font-weight: bold; color: rgb(255, 0, 0);\">EZページの編集についての注意</span><br />\r\n<br />\r\nHTMLareaのようなエディタを使っている際、HTML編集エリアでEnterキーなどを押すと、コンテンツが追加されたと見なされる(「追加ページ」となる)ことがあります。その場合、内部リンクや外部リンクの設定は無効になってしまいますので注意してください。<br />\r\n<br />\r\n<span style=\"font-weight: bold; color: rgb(255, 0, 0);\">「管理者にのみ表示」設定</span><br />\r\n<br />\r\nこれは、実際に稼動しているショップでEZページを編集する際に便利な設定です。<br />\r\nEZページのヘッダ、サイドボックス、フッタへの表示は<br />\r\n<ul><li>オフ</li><li>オン</li><li>管理者にのみ表示</li></ul>の設定をすることができます。「管理者にのみ表示」にしておくと、管理画面の「『メンテナンス中』- 設定したIPアドレスを除く」で設定したIPアドレスでアクセスした際にだけ、EZページへのリンクが表示されます。<br />\r\n<br />\r\n',0,0,0,1,0,0,0,20,0,0,10);
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
-- Dumping data for table `feature_area`
--

LOCK TABLES `feature_area` WRITE;
/*!40000 ALTER TABLE `feature_area` DISABLE KEYS */;
/*!40000 ALTER TABLE `feature_area` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `feature_area_info`
--

LOCK TABLES `feature_area_info` WRITE;
/*!40000 ALTER TABLE `feature_area_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `feature_area_info` ENABLE KEYS */;
UNLOCK TABLES;

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
INSERT INTO `featured` VALUES (1,18,'2007-01-18 00:38:40',NULL,'0001-01-01',NULL,1,'0001-01-01'),(2,2,'2007-01-18 00:38:50',NULL,'0001-01-01',NULL,1,'0001-01-01'),(3,4,'2007-01-18 00:38:59',NULL,'0001-01-01',NULL,1,'0001-01-01'),(4,9,'2007-01-18 00:39:11',NULL,'0001-01-01',NULL,1,'0001-01-01'),(5,28,'2007-01-18 00:39:33',NULL,'0001-01-01',NULL,1,'0001-01-01'),(6,11,'2007-01-18 00:40:27',NULL,'0001-01-01',NULL,1,'0001-01-01');
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
-- Dumping data for table `files_uploaded`
--

LOCK TABLES `files_uploaded` WRITE;
/*!40000 ALTER TABLE `files_uploaded` DISABLE KEYS */;
/*!40000 ALTER TABLE `files_uploaded` ENABLE KEYS */;
UNLOCK TABLES;

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

--
-- Dumping data for table `geo_zones`
--

LOCK TABLES `geo_zones` WRITE;
/*!40000 ALTER TABLE `geo_zones` DISABLE KEYS */;
INSERT INTO `geo_zones` VALUES (1,'日本','日本（消費税）','2007-01-15 11:44:41','2006-11-29 16:18:40');
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
INSERT INTO `get_terms_to_filter` VALUES ('manufacturers_id'),('music_genre_id'),('record_company_id');
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
-- Dumping data for table `group_point_rate`
--

LOCK TABLES `group_point_rate` WRITE;
/*!40000 ALTER TABLE `group_point_rate` DISABLE KEYS */;
/*!40000 ALTER TABLE `group_point_rate` ENABLE KEYS */;
UNLOCK TABLES;

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
INSERT INTO `holidays` VALUES (1,-1,1,1,-1,-1,0),(2,-1,1,2,-1,-1,0),(3,-1,1,3,-1,-1,0),(4,-1,1,-1,1,2,0),(5,-1,2,11,-1,-1,0),(6,-1,4,29,-1,-1,0),(7,-1,5,3,-1,-1,0),(8,-1,5,4,-1,-1,0),(9,-1,5,5,-1,-1,0),(10,-1,7,-1,1,3,0),(11,-1,9,-1,1,3,0),(12,-1,10,-1,1,2,0),(13,-1,11,3,-1,-1,0),(14,-1,11,23,-1,-1,0),(15,-1,12,23,-1,-1,0),(16,-1,12,29,-1,-1,0),(17,-1,12,30,-1,-1,0),(18,-1,12,31,-1,-1,0),(19,2009,3,20,-1,-1,0),(20,2009,5,6,-1,-1,0),(21,2009,9,22,-1,-1,0),(22,2009,9,23,-1,-1,0),(23,2010,3,21,-1,-1,0),(24,2010,3,22,-1,-1,0),(25,2010,9,23,-1,-1,0);
/*!40000 ALTER TABLE `holidays` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
CREATE TABLE `languages` (
  `languages_id` int(11) NOT NULL auto_increment,
  `name` varchar(32) NOT NULL default '',
  `code` varchar(2) NOT NULL default '',
  `image` varchar(64) default NULL,
  `directory` varchar(32) default NULL,
  `sort_order` int(3) default NULL,
  PRIMARY KEY  (`languages_id`),
  KEY `idx_languages_name_zen` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `languages`
--

LOCK TABLES `languages` WRITE;
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
INSERT INTO `languages` VALUES (1,'English','en','icon.gif','english',1),(2,'Japanese','ja','icon.gif','japanese',1);
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
) ENGINE=MyISAM AUTO_INCREMENT=103 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `layout_boxes`
--

LOCK TABLES `layout_boxes` WRITE;
/*!40000 ALTER TABLE `layout_boxes` DISABLE KEYS */;
INSERT INTO `layout_boxes` VALUES (1,'default_template_settings','banner_box_all.php',1,1,5,0,0,''),(2,'default_template_settings','banner_box.php',1,0,300,1,127,''),(3,'default_template_settings','banner_box2.php',1,1,15,1,15,''),(4,'default_template_settings','best_sellers.php',1,1,30,70,1,''),(5,'default_template_settings','categories.php',1,0,10,10,1,''),(6,'default_template_settings','currencies.php',1,1,80,60,1,''),(7,'default_template_settings','document_categories.php',1,0,0,0,0,''),(8,'default_template_settings','ezpages.php',1,1,-1,2,1,''),(9,'default_template_settings','featured.php',1,0,45,0,0,''),(10,'default_template_settings','information.php',1,0,50,40,1,''),(11,'default_template_settings','languages.php',1,1,70,50,1,''),(12,'default_template_settings','manufacturers.php',1,0,30,20,1,''),(13,'default_template_settings','manufacturer_info.php',1,1,35,95,1,''),(14,'default_template_settings','more_information.php',1,0,200,200,1,''),(15,'default_template_settings','music_genres.php',1,1,0,0,0,''),(16,'default_template_settings','order_history.php',0,0,0,0,0,''),(17,'default_template_settings','product_notifications.php',1,1,55,85,1,''),(18,'default_template_settings','record_companies.php',1,1,0,0,0,''),(19,'default_template_settings','reviews.php',1,0,40,0,0,''),(20,'default_template_settings','search.php',1,1,10,0,0,''),(21,'default_template_settings','search_header.php',0,0,0,0,1,''),(22,'default_template_settings','shopping_cart.php',1,1,20,30,1,''),(23,'default_template_settings','specials.php',1,1,45,0,0,''),(24,'default_template_settings','tell_a_friend.php',1,1,65,0,0,''),(25,'default_template_settings','whats_new.php',1,0,20,0,0,''),(26,'default_template_settings','whos_online.php',1,1,200,200,1,''),(27,'template_default','banner_box_all.php',1,1,5,0,0,''),(28,'template_default','banner_box.php',1,0,300,1,127,''),(29,'template_default','banner_box2.php',1,1,15,1,15,''),(30,'template_default','best_sellers.php',1,1,30,70,1,''),(31,'template_default','categories.php',1,0,10,10,1,''),(32,'template_default','currencies.php',1,1,80,60,1,''),(33,'template_default','ezpages.php',1,1,-1,2,1,''),(34,'template_default','featured.php',1,0,45,0,0,''),(35,'template_default','information.php',1,0,50,40,1,''),(36,'template_default','languages.php',1,1,70,50,1,''),(37,'template_default','manufacturers.php',1,0,30,20,1,''),(38,'template_default','manufacturer_info.php',1,1,35,95,1,''),(39,'template_default','more_information.php',1,0,200,200,1,''),(40,'template_default','my_broken_box.php',1,0,0,0,0,''),(41,'template_default','order_history.php',0,0,0,0,0,''),(42,'template_default','product_notifications.php',1,1,55,85,1,''),(43,'template_default','reviews.php',1,0,40,0,0,''),(44,'template_default','search.php',1,1,10,0,0,''),(45,'template_default','search_header.php',0,0,0,0,1,''),(46,'template_default','shopping_cart.php',1,1,20,30,1,''),(47,'template_default','specials.php',1,1,45,0,0,''),(48,'template_default','tell_a_friend.php',1,1,65,0,0,''),(49,'template_default','whats_new.php',1,0,20,0,0,''),(50,'template_default','whos_online.php',1,1,200,200,1,''),(51,'classic','banner_box.php',1,0,300,1,127,''),(52,'classic','banner_box2.php',1,1,15,1,15,''),(53,'classic','banner_box_all.php',1,1,5,0,0,''),(54,'classic','best_sellers.php',1,1,30,70,1,''),(55,'classic','categories.php',1,0,10,10,1,''),(56,'classic','currencies.php',1,1,80,60,1,''),(57,'classic','document_categories.php',1,0,0,0,0,''),(58,'classic','ezpages.php',1,1,-1,2,1,''),(59,'classic','featured.php',1,0,45,0,0,''),(60,'classic','information.php',1,0,50,40,1,''),(61,'classic','languages.php',1,1,70,50,1,''),(62,'classic','manufacturers.php',1,0,30,20,1,''),(63,'classic','manufacturer_info.php',1,1,35,95,1,''),(64,'classic','more_information.php',1,0,200,200,1,''),(65,'classic','music_genres.php',1,1,0,0,0,''),(66,'classic','order_history.php',0,0,0,0,0,''),(67,'classic','product_notifications.php',1,1,55,85,1,''),(68,'classic','record_companies.php',1,1,0,0,0,''),(69,'classic','reviews.php',1,0,40,0,0,''),(70,'classic','search.php',1,1,10,0,0,''),(71,'classic','search_header.php',0,0,0,0,1,''),(72,'classic','shopping_cart.php',1,1,20,30,1,''),(73,'classic','specials.php',1,1,45,0,0,''),(74,'classic','tell_a_friend.php',1,1,65,0,0,''),(75,'classic','whats_new.php',1,0,20,0,0,''),(76,'classic','whos_online.php',1,1,200,200,1,''),(77,'sugudeki','banner_box.php',0,0,0,0,0,''),(78,'sugudeki','banner_box2.php',0,0,0,0,0,''),(79,'sugudeki','banner_box_all.php',0,0,0,0,0,''),(80,'sugudeki','best_sellers.php',0,0,0,0,0,''),(81,'sugudeki','categories.php',0,0,0,0,0,''),(82,'sugudeki','currencies.php',0,0,0,0,0,''),(83,'sugudeki','document_categories.php',0,0,0,0,0,''),(84,'sugudeki','ezpages.php',0,0,0,0,0,''),(85,'sugudeki','featured.php',0,0,0,0,0,''),(86,'sugudeki','information.php',0,0,0,0,0,''),(87,'sugudeki','languages.php',0,0,0,0,0,''),(88,'sugudeki','manufacturer_info.php',0,0,0,0,0,''),(89,'sugudeki','manufacturers.php',0,0,0,0,0,''),(90,'sugudeki','more_information.php',0,0,0,0,0,''),(91,'sugudeki','music_genres.php',0,0,0,0,0,''),(92,'sugudeki','order_history.php',0,0,0,0,0,''),(93,'sugudeki','product_notifications.php',0,0,0,0,0,''),(94,'sugudeki','record_companies.php',0,0,0,0,0,''),(95,'sugudeki','reviews.php',0,0,0,0,0,''),(96,'sugudeki','search.php',0,0,0,0,0,''),(97,'sugudeki','search_header.php',0,0,0,0,0,''),(98,'sugudeki','shopping_cart.php',0,1,0,0,0,''),(99,'sugudeki','specials.php',0,0,0,0,0,''),(100,'sugudeki','tell_a_friend.php',0,0,0,0,0,''),(101,'sugudeki','whats_new.php',0,0,0,0,0,''),(102,'sugudeki','whos_online.php',0,0,0,0,0,'');
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
INSERT INTO `manufacturers` VALUES (1,'ABCアート',NULL,'2007-01-17 14:59:37','2007-01-21 22:22:03'),(2,'山田屋Tシャツ株式会社',NULL,'2007-01-21 22:19:08','2007-01-21 22:19:55'),(3,'ZenMarT商会',NULL,'2007-01-21 22:20:41',NULL),(4,'XYZデザイン',NULL,'2007-01-21 22:21:38',NULL);
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
  PRIMARY KEY  (`manufacturers_id`,`languages_id`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table `manufacturers_info`
--

LOCK TABLES `manufacturers_info` WRITE;
/*!40000 ALTER TABLE `manufacturers_info` DISABLE KEYS */;
INSERT INTO `manufacturers_info` VALUES (2,1,'',0,NULL),(2,2,'',0,NULL),(3,1,'',0,NULL),(3,2,'',0,NULL),(4,1,'',0,NULL),(4,2,'',0,NULL);
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
INSERT INTO `media_clips` VALUES (1,1,1,'thehunter.mp3','2007-01-26 10:50:45','0001-01-01 00:00:00'),(3,1,1,'help.mp3','2007-01-26 11:03:23','0001-01-01 00:00:00');
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
INSERT INTO `media_manager` VALUES (1,'Help!','2007-01-26 11:03:23','2007-01-26 10:50:30'),(2,'Russ Tippins - The Hunter','2007-01-26 10:51:28','2007-01-26 10:51:10');
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
INSERT INTO `media_to_products` VALUES (1,213),(1,229),(2,212);
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
INSERT INTO `meta_tags_categories_description` VALUES (58,1,'','',''),(58,2,'このカテゴリには明示的にtitleタグを設定しました。','このカテゴリには明示的にMETA（keyword）を設定しています,キーワード1,キーワード2,キーワード3','このカテゴリには明示的にMETA（description）を設定しています。Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus sit amet velit・・・');
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
) ENGINE=MyISAM AUTO_INCREMENT=116 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `meta_tags_products_description`
--

LOCK TABLES `meta_tags_products_description` WRITE;
/*!40000 ALTER TABLE `meta_tags_products_description` DISABLE KEYS */;
INSERT INTO `meta_tags_products_description` VALUES (115,1,'','',''),(115,2,'この商品ページには明示的にtitleタグを設定しました。','この商品ページには明示的にMETA（keyword）を設定しています,商品キーワード1,商品キーワード2,商品キーワード3','この商品ページには明示的にMETA（description）を設定しています。Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus sit amet velit・・・');
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
INSERT INTO `music_genre` VALUES (1,'Jazz','2007-01-26 10:45:31',NULL),(2,'Rock','2007-01-26 10:45:46',NULL);
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
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table `newsletters`
--

LOCK TABLES `newsletters` WRITE;
/*!40000 ALTER TABLE `newsletters` DISABLE KEYS */;
/*!40000 ALTER TABLE `newsletters` ENABLE KEYS */;
UNLOCK TABLES;

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
  PRIMARY KEY  (`orders_id`),
  KEY `idx_status_orders_cust_zen` (`orders_status`,`orders_id`,`customers_id`)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table `orders_products`
--

LOCK TABLES `orders_products` WRITE;
/*!40000 ALTER TABLE `orders_products` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders_products` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table `orders_products_attributes`
--

LOCK TABLES `orders_products_attributes` WRITE;
/*!40000 ALTER TABLE `orders_products_attributes` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders_products_attributes` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table `orders_products_download`
--

LOCK TABLES `orders_products_download` WRITE;
/*!40000 ALTER TABLE `orders_products_download` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders_products_download` ENABLE KEYS */;
UNLOCK TABLES;

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
INSERT INTO `orders_status` VALUES (1,1,'Pending'),(2,1,'Processing'),(3,1,'Delivered'),(4,1,'Update'),(1,2,'処理待ち'),(2,2,'処理中'),(3,2,'配送済み'),(4,2,'更新');
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
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table `orders_status_history`
--

LOCK TABLES `orders_status_history` WRITE;
/*!40000 ALTER TABLE `orders_status_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders_status_history` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table `orders_total`
--

LOCK TABLES `orders_total` WRITE;
/*!40000 ALTER TABLE `orders_total` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders_total` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `paypal`
--

LOCK TABLES `paypal` WRITE;
/*!40000 ALTER TABLE `paypal` DISABLE KEYS */;
/*!40000 ALTER TABLE `paypal` ENABLE KEYS */;
UNLOCK TABLES;

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
INSERT INTO `paypal_payment_status` VALUES (1,'Completed'),(2,'Pending'),(3,'Failed'),(4,'Denied'),(5,'Refunded'),(6,'Canceled_Reversal'),(7,'Reversed');
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
-- Dumping data for table `paypal_payment_status_history`
--

LOCK TABLES `paypal_payment_status_history` WRITE;
/*!40000 ALTER TABLE `paypal_payment_status_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `paypal_payment_status_history` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `paypal_session`
--

LOCK TABLES `paypal_session` WRITE;
/*!40000 ALTER TABLE `paypal_session` DISABLE KEYS */;
/*!40000 ALTER TABLE `paypal_session` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `paypal_testing`
--

LOCK TABLES `paypal_testing` WRITE;
/*!40000 ALTER TABLE `paypal_testing` DISABLE KEYS */;
/*!40000 ALTER TABLE `paypal_testing` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table `point_histories`
--

LOCK TABLES `point_histories` WRITE;
/*!40000 ALTER TABLE `point_histories` DISABLE KEYS */;
/*!40000 ALTER TABLE `point_histories` ENABLE KEYS */;
UNLOCK TABLES;

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
INSERT INTO `product_music_extra` VALUES (212,1,0,2),(213,0,1,2),(229,0,1,2);
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
INSERT INTO `product_type_layout` VALUES (1,'型番表示','SHOW_PRODUCT_INFO_MODEL','1','商品情報で型番を表示する 0= off 1= on',1,1,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(2,'重量表示','SHOW_PRODUCT_INFO_WEIGHT','1','商品情報で型番を表示する 0= off 1= on',1,2,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(3,'オプション重量表示','SHOW_PRODUCT_INFO_WEIGHT_ATTRIBUTES','1','商品情報でオプションの重量を表示する。 0= off 1= on',1,3,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(4,'メーカーの表示','SHOW_PRODUCT_INFO_MANUFACTURER','1','商品ページに、メーカー名を表示しますか？0= off 1= on',1,4,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(5,'カート内の数量表示','SHOW_PRODUCT_INFO_IN_CART_QTY','1','商品情報でカート内の数量を表示する。 0= off 1= on',1,5,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(6,'在庫数表示','SHOW_PRODUCT_INFO_QUANTITY','1','商品情報で在庫数を表示する。 0= off 1= on',1,6,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(7,'レビュー数表示','SHOW_PRODUCT_INFO_REVIEWS_COUNT','1','商品情報でレビュー数を表示する 0= off 1= on',1,7,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(8,'レビューボタン表示','SHOW_PRODUCT_INFO_REVIEWS','1','商品情報でレビューボタンを表示する 0= off 1= on',1,8,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(9,'購入可能になった日付の表示','SHOW_PRODUCT_INFO_DATE_AVAILABLE','1','商品情報で商品が購入可能になった日付を表示する。 0= off 1= on',1,9,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(10,'登録日表示','SHOW_PRODUCT_INFO_DATE_ADDED','1','商品情報で商品が登録された日付を表示します。 0= off 1= on',1,10,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(11,'商品URL表示','SHOW_PRODUCT_INFO_URL','1','商品情報で商品のURLを表示する 0= off 1= on',1,11,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(12,'Show Product Additional Images','SHOW_PRODUCT_INFO_ADDITIONAL_IMAGES','1','Display Additional Images on Product Info 0= off 1= on',1,13,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(13,'ベース価格の表示','SHOW_PRODUCT_INFO_STARTING_AT','1','商品ページに、ベース価格を表示しますか？0= off 1= on',1,12,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(14,'「友達に知らせる」ボタン表示','SHOW_PRODUCT_INFO_TELL_A_FRIEND','1','商品情報で「友達に知らせる」ボタンを表示する。<br /><br />Note: この設定をoffにしてもサイドボックスの「友達に知らせる」は消えません。また、サイドボックスの「友達に知らせる」をoffにしてもこのボタン表示の設定に影響はありません。<br />0= off 1= on',1,15,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(15,'送料無料の画像ステータス - カタログ','SHOW_PRODUCT_INFO_ALWAYS_FREE_SHIPPING_IMAGE_SWITCH','0','カタログ中の送料無料の画像/テキストを表示しますか？',1,16,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), '),(16,'税種別のデフォルト - 新商品追加時','DEFAULT_PRODUCT_TAX_CLASS_ID','0','新商品を追加する時の、税種別のデフォルトIDを入力してください。',1,100,NULL,'2009-11-19 12:39:40','',''),(17,'ヴァーチャル商品のデフォルトステータス - 新商品追加時','DEFAULT_PRODUCT_PRODUCTS_VIRTUAL','0','新商品を追加する時の、ヴァーチャル商品のデフォルトステータスをONにしますか？',1,101,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(18,'Product Free Shipping Default Status - Normal Shipping Rules - When adding new products?','DEFAULT_PRODUCT_PRODUCTS_IS_ALWAYS_FREE_SHIPPING','0','What should the Default Free Shipping status be when adding new products?<br />Yes, Always Free Shipping ON<br />No, Always Free Shipping OFF<br />Special, Product/Download Requires Shipping',1,102,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes, Always ON\'), array(\'id\'=>\'0\', \'text\'=>\'No, Always OFF\'), array(\'id\'=>\'2\', \'text\'=>\'Special\')), '),(19,'型番表示','SHOW_PRODUCT_MUSIC_INFO_MODEL','1','商品情報で型番を表示する 0= off 1= on',2,1,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(20,'重量表示','SHOW_PRODUCT_MUSIC_INFO_WEIGHT','0','商品情報で型番を表示する 0= off 1= on',2,2,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(21,'オプション重量表示','SHOW_PRODUCT_MUSIC_INFO_WEIGHT_ATTRIBUTES','1','商品情報でオプションの重量を表示する。 0= off 1= on',2,3,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(22,'アーティストの表示','SHOW_PRODUCT_MUSIC_INFO_ARTIST','1','商品ページに、アーティスト名を表示しますか？0= off 1= on',2,4,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(23,'音楽ジャンルの表示','SHOW_PRODUCT_MUSIC_INFO_GENRE','1','商品ページに、音楽ジャンルを表示しますか？0= off 1= on',2,4,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(24,'レコード会社の表示','SHOW_PRODUCT_MUSIC_INFO_RECORD_COMPANY','1','商品ページに、レコード会社を表示しますか？0= off 1= on',2,4,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(25,'カート内の数量表示','SHOW_PRODUCT_MUSIC_INFO_IN_CART_QTY','1','商品情報でカート内の数量を表示する。 0= off 1= on',2,5,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(26,'在庫数表示','SHOW_PRODUCT_MUSIC_INFO_QUANTITY','0','商品情報で在庫数を表示する。 0= off 1= on',2,6,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(27,'レビュー数表示','SHOW_PRODUCT_MUSIC_INFO_REVIEWS_COUNT','1','商品情報でレビュー数を表示する 0= off 1= on',2,7,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(28,'レビューボタン表示','SHOW_PRODUCT_MUSIC_INFO_REVIEWS','1','商品情報でレビューボタンを表示する 0= off 1= on',2,8,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(29,'購入可能になった日付の表示','SHOW_PRODUCT_MUSIC_INFO_DATE_AVAILABLE','1','商品情報で商品が購入可能になった日付を表示する。 0= off 1= on',2,9,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(30,'登録日表示','SHOW_PRODUCT_MUSIC_INFO_DATE_ADDED','1','商品情報で商品が登録された日付を表示します。 0= off 1= on',2,10,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(31,'ベース価格の表示','SHOW_PRODUCT_MUSIC_INFO_STARTING_AT','1','商品ページに、ベース価格を表示しますか？0= off 1= on',2,12,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(32,'Show Product Additional Images','SHOW_PRODUCT_MUSIC_INFO_ADDITIONAL_IMAGES','1','Display Additional Images on Product Info 0= off 1= on',2,13,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(33,'「友達に知らせる」ボタン表示','SHOW_PRODUCT_MUSIC_INFO_TELL_A_FRIEND','1','商品情報で「友達に知らせる」ボタンを表示する。<br /><br />Note: この設定をoffにしてもサイドボックスの「友達に知らせる」は消えません。また、サイドボックスの「友達に知らせる」をoffにしてもこのボタン表示の設定に影響はありません。<br />0= off 1= on',2,15,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(34,'送料無料の画像ステータス - カタログ','SHOW_PRODUCT_MUSIC_INFO_ALWAYS_FREE_SHIPPING_IMAGE_SWITCH','0','カタログ中の送料無料の画像/テキストを表示しますか？',2,16,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), '),(35,'税種別のデフォルト - 新商品追加時','DEFAULT_PRODUCT_MUSIC_TAX_CLASS_ID','0','新商品を追加する時の、税種別のデフォルトIDを入力してください。',2,100,NULL,'2009-11-19 12:39:40','',''),(36,'ヴァーチャル商品のデフォルトステータス - 新商品追加時','DEFAULT_PRODUCT_MUSIC_PRODUCTS_VIRTUAL','0','新商品を追加する時の、ヴァーチャル商品のデフォルトステータスをONにしますか？',2,101,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(37,'Product Free Shipping Default Status - Normal Shipping Rules - When adding new products?','DEFAULT_PRODUCT_MUSIC_PRODUCTS_IS_ALWAYS_FREE_SHIPPING','0','What should the Default Free Shipping status be when adding new products?<br />Yes, Always Free Shipping ON<br />No, Always Free Shipping OFF<br />Special, Product/Download Requires Shipping',2,102,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes, Always ON\'), array(\'id\'=>\'0\', \'text\'=>\'No, Always OFF\'), array(\'id\'=>\'2\', \'text\'=>\'Special\')), '),(38,'レビュー数表示','SHOW_DOCUMENT_GENERAL_INFO_REVIEWS_COUNT','1','商品情報でレビュー数を表示する 0= off 1= on',3,7,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(39,'レビューボタン表示','SHOW_DOCUMENT_GENERAL_INFO_REVIEWS','1','商品情報でレビューボタンを表示する 0= off 1= on',3,8,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(40,'購入可能になった日付の表示','SHOW_DOCUMENT_GENERAL_INFO_DATE_AVAILABLE','1','商品情報で商品が購入可能になった日付を表示する。 0= off 1= on',3,9,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(41,'登録日表示','SHOW_DOCUMENT_GENERAL_INFO_DATE_ADDED','1','商品情報で商品が登録された日付を表示します。 0= off 1= on',3,10,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(42,'「友達に知らせる」ボタン表示','SHOW_DOCUMENT_GENERAL_INFO_TELL_A_FRIEND','1','商品情報で「友達に知らせる」ボタンを表示する。<br /><br />Note: この設定をoffにしてもサイドボックスの「友達に知らせる」は消えません。また、サイドボックスの「友達に知らせる」をoffにしてもこのボタン表示の設定に影響はありません。<br />0= off 1= on',3,15,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(43,'商品URL表示','SHOW_DOCUMENT_GENERAL_INFO_URL','1','商品情報で商品のURLを表示する 0= off 1= on',3,11,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(44,'Show Product Additional Images','SHOW_DOCUMENT_GENERAL_INFO_ADDITIONAL_IMAGES','1','Display Additional Images on Product Info 0= off 1= on',3,13,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(45,'型番表示','SHOW_DOCUMENT_PRODUCT_INFO_MODEL','1','商品情報で型番を表示する 0= off 1= on',4,1,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(46,'重量表示','SHOW_DOCUMENT_PRODUCT_INFO_WEIGHT','0','商品情報で型番を表示する 0= off 1= on',4,2,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(47,'オプション重量表示','SHOW_DOCUMENT_PRODUCT_INFO_WEIGHT_ATTRIBUTES','1','商品情報でオプションの重量を表示する。 0= off 1= on',4,3,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(48,'メーカーの表示','SHOW_DOCUMENT_PRODUCT_INFO_MANUFACTURER','1','商品ページに、メーカー名を表示しますか？0= off 1= on',4,4,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(49,'カート内の数量表示','SHOW_DOCUMENT_PRODUCT_INFO_IN_CART_QTY','1','商品情報でカート内の数量を表示する。 0= off 1= on',4,5,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(50,'在庫数表示','SHOW_DOCUMENT_PRODUCT_INFO_QUANTITY','0','商品情報で在庫数を表示する。 0= off 1= on',4,6,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(51,'レビュー数表示','SHOW_DOCUMENT_PRODUCT_INFO_REVIEWS_COUNT','1','商品情報でレビュー数を表示する 0= off 1= on',4,7,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(52,'レビューボタン表示','SHOW_DOCUMENT_PRODUCT_INFO_REVIEWS','1','商品情報でレビューボタンを表示する 0= off 1= on',4,8,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(53,'購入可能になった日付の表示','SHOW_DOCUMENT_PRODUCT_INFO_DATE_AVAILABLE','1','商品情報で商品が購入可能になった日付を表示する。 0= off 1= on',4,9,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(54,'登録日表示','SHOW_DOCUMENT_PRODUCT_INFO_DATE_ADDED','1','商品情報で商品が登録された日付を表示します。 0= off 1= on',4,10,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(55,'商品URL表示','SHOW_DOCUMENT_PRODUCT_INFO_URL','1','商品情報で商品のURLを表示する 0= off 1= on',4,11,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(56,'Show Product Additional Images','SHOW_DOCUMENT_PRODUCT_INFO_ADDITIONAL_IMAGES','1','Display Additional Images on Product Info 0= off 1= on',4,13,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(57,'ベース価格の表示','SHOW_DOCUMENT_PRODUCT_INFO_STARTING_AT','1','商品ページに、ベース価格を表示しますか？0= off 1= on',4,12,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(58,'「友達に知らせる」ボタン表示','SHOW_DOCUMENT_PRODUCT_INFO_TELL_A_FRIEND','1','商品情報で「友達に知らせる」ボタンを表示する。<br /><br />Note: この設定をoffにしてもサイドボックスの「友達に知らせる」は消えません。また、サイドボックスの「友達に知らせる」をoffにしてもこのボタン表示の設定に影響はありません。<br />0= off 1= on',4,15,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(59,'送料無料の画像ステータス - カタログ','SHOW_DOCUMENT_PRODUCT_INFO_ALWAYS_FREE_SHIPPING_IMAGE_SWITCH','0','カタログ中の送料無料の画像/テキストを表示しますか？',4,16,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), '),(60,'税種別のデフォルト - 新商品追加時','DEFAULT_DOCUMENT_PRODUCT_TAX_CLASS_ID','0','新商品を追加する時の、税種別のデフォルトIDを入力してください。',4,100,NULL,'2009-11-19 12:39:40','',''),(61,'ヴァーチャル商品のデフォルトステータス - 新商品追加時','DEFAULT_DOCUMENT_PRODUCT_PRODUCTS_VIRTUAL','0','新商品を追加する時の、ヴァーチャル商品のデフォルトステータスをONにしますか？',4,101,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(62,'Product Free Shipping Default Status - Normal Shipping Rules - When adding new products?','DEFAULT_DOCUMENT_PRODUCT_PRODUCTS_IS_ALWAYS_FREE_SHIPPING','0','What should the Default Free Shipping status be when adding new products?<br />Yes, Always Free Shipping ON<br />No, Always Free Shipping OFF<br />Special, Product/Download Requires Shipping',4,102,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes, Always ON\'), array(\'id\'=>\'0\', \'text\'=>\'No, Always OFF\'), array(\'id\'=>\'2\', \'text\'=>\'Special\')), '),(63,'型番表示','SHOW_PRODUCT_FREE_SHIPPING_INFO_MODEL','1','商品情報で型番を表示する 0= off 1= on',5,1,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(64,'重量表示','SHOW_PRODUCT_FREE_SHIPPING_INFO_WEIGHT','0','商品情報で型番を表示する 0= off 1= on',5,2,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(65,'オプション重量表示','SHOW_PRODUCT_FREE_SHIPPING_INFO_WEIGHT_ATTRIBUTES','1','商品情報でオプションの重量を表示する。 0= off 1= on',5,3,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(66,'メーカーの表示','SHOW_PRODUCT_FREE_SHIPPING_INFO_MANUFACTURER','1','商品ページに、メーカー名を表示しますか？0= off 1= on',5,4,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(67,'カート内の数量表示','SHOW_PRODUCT_FREE_SHIPPING_INFO_IN_CART_QTY','1','商品情報でカート内の数量を表示する。 0= off 1= on',5,5,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(68,'在庫数表示','SHOW_PRODUCT_FREE_SHIPPING_INFO_QUANTITY','1','商品情報で在庫数を表示する。 0= off 1= on',5,6,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(69,'レビュー数表示','SHOW_PRODUCT_FREE_SHIPPING_INFO_REVIEWS_COUNT','1','商品情報でレビュー数を表示する 0= off 1= on',5,7,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(70,'レビューボタン表示','SHOW_PRODUCT_FREE_SHIPPING_INFO_REVIEWS','1','商品情報でレビューボタンを表示する 0= off 1= on',5,8,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(71,'購入可能になった日付の表示','SHOW_PRODUCT_FREE_SHIPPING_INFO_DATE_AVAILABLE','0','商品情報で商品が購入可能になった日付を表示する。 0= off 1= on',5,9,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(72,'登録日表示','SHOW_PRODUCT_FREE_SHIPPING_INFO_DATE_ADDED','1','商品情報で商品が登録された日付を表示します。 0= off 1= on',5,10,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(73,'商品URL表示','SHOW_PRODUCT_FREE_SHIPPING_INFO_URL','1','商品情報で商品のURLを表示する 0= off 1= on',5,11,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(74,'Show Product Additional Images','SHOW_PRODUCT_FREE_SHIPPING_INFO_ADDITIONAL_IMAGES','1','Display Additional Images on Product Info 0= off 1= on',5,13,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(75,'ベース価格の表示','SHOW_PRODUCT_FREE_SHIPPING_INFO_STARTING_AT','1','商品ページに、ベース価格を表示しますか？0= off 1= on',5,12,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(76,'「友達に知らせる」ボタン表示','SHOW_PRODUCT_FREE_SHIPPING_INFO_TELL_A_FRIEND','1','商品情報で「友達に知らせる」ボタンを表示する。<br /><br />Note: この設定をoffにしてもサイドボックスの「友達に知らせる」は消えません。また、サイドボックスの「友達に知らせる」をoffにしてもこのボタン表示の設定に影響はありません。<br />0= off 1= on',5,15,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(77,'送料無料の画像ステータス - カタログ','SHOW_PRODUCT_FREE_SHIPPING_INFO_ALWAYS_FREE_SHIPPING_IMAGE_SWITCH','1','カタログ中の送料無料の画像/テキストを表示しますか？',5,16,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), '),(78,'税種別のデフォルト - 新商品追加時','DEFAULT_PRODUCT_FREE_SHIPPING_TAX_CLASS_ID','0','新商品を追加する時の、税種別のデフォルトIDを入力してください。',5,100,NULL,'2009-11-19 12:39:40','',''),(79,'ヴァーチャル商品のデフォルトステータス - 新商品追加時','DEFAULT_PRODUCT_FREE_SHIPPING_PRODUCTS_VIRTUAL','0','新商品を追加する時の、ヴァーチャル商品のデフォルトステータスをONにしますか？',5,101,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(80,'Product Free Shipping Default Status - Normal Shipping Rules - When adding new products?','DEFAULT_PRODUCT_FREE_SHIPPING_PRODUCTS_IS_ALWAYS_FREE_SHIPPING','1','What should the Default Free Shipping status be when adding new products?<br />Yes, Always Free Shipping ON<br />No, Always Free Shipping OFF<br />Special, Product/Download Requires Shipping',5,102,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes, Always ON\'), array(\'id\'=>\'0\', \'text\'=>\'No, Always OFF\'), array(\'id\'=>\'2\', \'text\'=>\'Special\')), '),(81,'Show Metatags Title Default - Product Title','SHOW_PRODUCT_INFO_METATAGS_TITLE_STATUS','1','Display Product Title in Meta Tags Title 0= off 1= on',1,50,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(82,'Show Metatags Title Default - Product Name','SHOW_PRODUCT_INFO_METATAGS_PRODUCTS_NAME_STATUS','1','Display Product Name in Meta Tags Title 0= off 1= on',1,51,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(83,'Show Metatags Title Default - Product Model','SHOW_PRODUCT_INFO_METATAGS_MODEL_STATUS','1','Display Product Model in Meta Tags Title 0= off 1= on',1,52,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(84,'Show Metatags Title Default - Product Price','SHOW_PRODUCT_INFO_METATAGS_PRICE_STATUS','1','Display Product Price in Meta Tags Title 0= off 1= on',1,53,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(85,'Show Metatags Title Default - Product Tagline','SHOW_PRODUCT_INFO_METATAGS_TITLE_TAGLINE_STATUS','1','Display Product Tagline in Meta Tags Title 0= off 1= on',1,54,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(86,'Show Metatags Title Default - Product Title','SHOW_PRODUCT_MUSIC_INFO_METATAGS_TITLE_STATUS','1','Display Product Title in Meta Tags Title 0= off 1= on',2,50,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(87,'Show Metatags Title Default - Product Name','SHOW_PRODUCT_MUSIC_INFO_METATAGS_PRODUCTS_NAME_STATUS','1','Display Product Name in Meta Tags Title 0= off 1= on',2,51,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(88,'Show Metatags Title Default - Product Model','SHOW_PRODUCT_MUSIC_INFO_METATAGS_MODEL_STATUS','1','Display Product Model in Meta Tags Title 0= off 1= on',2,52,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(89,'Show Metatags Title Default - Product Price','SHOW_PRODUCT_MUSIC_INFO_METATAGS_PRICE_STATUS','1','Display Product Price in Meta Tags Title 0= off 1= on',2,53,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(90,'Show Metatags Title Default - Product Tagline','SHOW_PRODUCT_MUSIC_INFO_METATAGS_TITLE_TAGLINE_STATUS','1','Display Product Tagline in Meta Tags Title 0= off 1= on',2,54,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(91,'Show Metatags Title Default - Document Title','SHOW_DOCUMENT_GENERAL_INFO_METATAGS_TITLE_STATUS','1','Display Document Title in Meta Tags Title 0= off 1= on',3,50,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(92,'Show Metatags Title Default - Document Name','SHOW_DOCUMENT_GENERAL_INFO_METATAGS_PRODUCTS_NAME_STATUS','1','Display Document Name in Meta Tags Title 0= off 1= on',3,51,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(93,'Show Metatags Title Default - Document Tagline','SHOW_DOCUMENT_GENERAL_INFO_METATAGS_TITLE_TAGLINE_STATUS','1','Display Document Tagline in Meta Tags Title 0= off 1= on',3,54,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(94,'Show Metatags Title Default - Document Title','SHOW_DOCUMENT_PRODUCT_INFO_METATAGS_TITLE_STATUS','1','Display Document Title in Meta Tags Title 0= off 1= on',4,50,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(95,'Show Metatags Title Default - Document Name','SHOW_DOCUMENT_PRODUCT_INFO_METATAGS_PRODUCTS_NAME_STATUS','1','Display Document Name in Meta Tags Title 0= off 1= on',4,51,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(96,'Show Metatags Title Default - Document Model','SHOW_DOCUMENT_PRODUCT_INFO_METATAGS_MODEL_STATUS','1','Display Document Model in Meta Tags Title 0= off 1= on',4,52,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(97,'Show Metatags Title Default - Document Price','SHOW_DOCUMENT_PRODUCT_INFO_METATAGS_PRICE_STATUS','1','Display Document Price in Meta Tags Title 0= off 1= on',4,53,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(98,'Show Metatags Title Default - Document Tagline','SHOW_DOCUMENT_PRODUCT_INFO_METATAGS_TITLE_TAGLINE_STATUS','1','Display Document Tagline in Meta Tags Title 0= off 1= on',4,54,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(99,'Show Metatags Title Default - Product Title','SHOW_PRODUCT_FREE_SHIPPING_INFO_METATAGS_TITLE_STATUS','1','Display Product Title in Meta Tags Title 0= off 1= on',5,50,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(100,'Show Metatags Title Default - Product Name','SHOW_PRODUCT_FREE_SHIPPING_INFO_METATAGS_PRODUCTS_NAME_STATUS','1','Display Product Name in Meta Tags Title 0= off 1= on',5,51,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(101,'Show Metatags Title Default - Product Model','SHOW_PRODUCT_FREE_SHIPPING_INFO_METATAGS_MODEL_STATUS','1','Display Product Model in Meta Tags Title 0= off 1= on',5,52,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(102,'Show Metatags Title Default - Product Price','SHOW_PRODUCT_FREE_SHIPPING_INFO_METATAGS_PRICE_STATUS','1','Display Product Price in Meta Tags Title 0= off 1= on',5,53,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(103,'Show Metatags Title Default - Product Tagline','SHOW_PRODUCT_FREE_SHIPPING_INFO_METATAGS_TITLE_TAGLINE_STATUS','1','Display Product Tagline in Meta Tags Title 0= off 1= on',5,54,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), '),(104,'PRODUCT Attribute is Display Only - Default','DEFAULT_PRODUCT_ATTRIBUTES_DISPLAY_ONLY','0','PRODUCT Attribute is Display Only<br />Used For Display Purposes Only<br />0= No 1= Yes',1,200,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), '),(105,'PRODUCT Attribute is Free - Default','DEFAULT_PRODUCT_ATTRIBUTE_IS_FREE','1','PRODUCT Attribute is Free<br />Attribute is Free When Product is Free<br />0= No 1= Yes',1,201,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), '),(106,'PRODUCT Attribute is Default - Default','DEFAULT_PRODUCT_ATTRIBUTES_DEFAULT','0','PRODUCT Attribute is Default<br />Default Attribute to be Marked Selected<br />0= No 1= Yes',1,202,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), '),(107,'PRODUCT Attribute is Discounted - Default','DEFAULT_PRODUCT_ATTRIBUTES_DISCOUNTED','1','PRODUCT Attribute is Discounted<br />Apply Discounts Used by Product Special/Sale<br />0= No 1= Yes',1,203,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), '),(108,'PRODUCT Attribute is Included in Base Price - Default','DEFAULT_PRODUCT_ATTRIBUTES_PRICE_BASE_INCLUDED','1','PRODUCT Attribute is Included in Base Price<br />Include in Base Price When Priced by Attributes<br />0= No 1= Yes',1,204,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), '),(109,'PRODUCT Attribute is Required - Default','DEFAULT_PRODUCT_ATTRIBUTES_REQUIRED','0','PRODUCT Attribute is Required<br />Attribute Required for Text<br />0= No 1= Yes',1,205,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), '),(110,'PRODUCT Attribute Price Prefix - Default','DEFAULT_PRODUCT_PRICE_PREFIX','1','PRODUCT Attribute Price Prefix<br />Default Attribute Price Prefix for Adding<br />Blank, + or -',1,206,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Blank\'), array(\'id\'=>\'1\', \'text\'=>\'+\'), array(\'id\'=>\'2\', \'text\'=>\'-\')), '),(111,'PRODUCT Attribute Weight Prefix - Default','DEFAULT_PRODUCT_PRODUCTS_ATTRIBUTES_WEIGHT_PREFIX','1','PRODUCT Attribute Weight Prefix<br />Default Attribute Weight Prefix<br />Blank, + or -',1,207,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Blank\'), array(\'id\'=>\'1\', \'text\'=>\'+\'), array(\'id\'=>\'2\', \'text\'=>\'-\')), '),(112,'MUSIC Attribute is Display Only - Default','DEFAULT_PRODUCT_MUSIC_ATTRIBUTES_DISPLAY_ONLY','0','MUSIC Attribute is Display Only<br />Used For Display Purposes Only<br />0= No 1= Yes',2,200,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), '),(113,'MUSIC Attribute is Free - Default','DEFAULT_PRODUCT_MUSIC_ATTRIBUTE_IS_FREE','1','MUSIC Attribute is Free<br />Attribute is Free When Product is Free<br />0= No 1= Yes',2,201,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), '),(114,'MUSIC Attribute is Default - Default','DEFAULT_PRODUCT_MUSIC_ATTRIBUTES_DEFAULT','0','MUSIC Attribute is Default<br />Default Attribute to be Marked Selected<br />0= No 1= Yes',2,202,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), '),(115,'MUSIC Attribute is Discounted - Default','DEFAULT_PRODUCT_MUSIC_ATTRIBUTES_DISCOUNTED','1','MUSIC Attribute is Discounted<br />Apply Discounts Used by Product Special/Sale<br />0= No 1= Yes',2,203,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), '),(116,'MUSIC Attribute is Included in Base Price - Default','DEFAULT_PRODUCT_MUSIC_ATTRIBUTES_PRICE_BASE_INCLUDED','1','MUSIC Attribute is Included in Base Price<br />Include in Base Price When Priced by Attributes<br />0= No 1= Yes',2,204,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), '),(117,'MUSIC Attribute is Required - Default','DEFAULT_PRODUCT_MUSIC_ATTRIBUTES_REQUIRED','0','MUSIC Attribute is Required<br />Attribute Required for Text<br />0= No 1= Yes',2,205,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), '),(118,'MUSIC Attribute Price Prefix - Default','DEFAULT_PRODUCT_MUSIC_PRICE_PREFIX','1','MUSIC Attribute Price Prefix<br />Default Attribute Price Prefix for Adding<br />Blank, + or -',2,206,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Blank\'), array(\'id\'=>\'1\', \'text\'=>\'+\'), array(\'id\'=>\'2\', \'text\'=>\'-\')), '),(119,'MUSIC Attribute Weight Prefix - Default','DEFAULT_PRODUCT_MUSIC_PRODUCTS_ATTRIBUTES_WEIGHT_PREFIX','1','MUSIC Attribute Weight Prefix<br />Default Attribute Weight Prefix<br />Blank, + or -',2,207,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Blank\'), array(\'id\'=>\'1\', \'text\'=>\'+\'), array(\'id\'=>\'2\', \'text\'=>\'-\')), '),(120,'DOCUMENT GENERAL Attribute is Display Only - Default','DEFAULT_DOCUMENT_GENERAL_ATTRIBUTES_DISPLAY_ONLY','0','DOCUMENT GENERAL Attribute is Display Only<br />Used For Display Purposes Only<br />0= No 1= Yes',3,200,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), '),(121,'DOCUMENT GENERAL Attribute is Free - Default','DEFAULT_DOCUMENT_GENERAL_ATTRIBUTE_IS_FREE','1','DOCUMENT GENERAL Attribute is Free<br />Attribute is Free When Product is Free<br />0= No 1= Yes',3,201,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), '),(122,'DOCUMENT GENERAL Attribute is Default - Default','DEFAULT_DOCUMENT_GENERAL_ATTRIBUTES_DEFAULT','0','DOCUMENT GENERAL Attribute is Default<br />Default Attribute to be Marked Selected<br />0= No 1= Yes',3,202,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), '),(123,'DOCUMENT GENERAL Attribute is Discounted - Default','DEFAULT_DOCUMENT_GENERAL_ATTRIBUTES_DISCOUNTED','1','DOCUMENT GENERAL Attribute is Discounted<br />Apply Discounts Used by Product Special/Sale<br />0= No 1= Yes',3,203,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), '),(124,'DOCUMENT GENERAL Attribute is Included in Base Price - Default','DEFAULT_DOCUMENT_GENERAL_ATTRIBUTES_PRICE_BASE_INCLUDED','1','DOCUMENT GENERAL Attribute is Included in Base Price<br />Include in Base Price When Priced by Attributes<br />0= No 1= Yes',3,204,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), '),(125,'DOCUMENT GENERAL Attribute is Required - Default','DEFAULT_DOCUMENT_GENERAL_ATTRIBUTES_REQUIRED','0','DOCUMENT GENERAL Attribute is Required<br />Attribute Required for Text<br />0= No 1= Yes',3,205,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), '),(126,'DOCUMENT GENERAL Attribute Price Prefix - Default','DEFAULT_DOCUMENT_GENERAL_PRICE_PREFIX','1','DOCUMENT GENERAL Attribute Price Prefix<br />Default Attribute Price Prefix for Adding<br />Blank, + or -',3,206,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Blank\'), array(\'id\'=>\'1\', \'text\'=>\'+\'), array(\'id\'=>\'2\', \'text\'=>\'-\')), '),(127,'DOCUMENT GENERAL Attribute Weight Prefix - Default','DEFAULT_DOCUMENT_GENERAL_PRODUCTS_ATTRIBUTES_WEIGHT_PREFIX','1','DOCUMENT GENERAL Attribute Weight Prefix<br />Default Attribute Weight Prefix<br />Blank, + or -',3,207,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Blank\'), array(\'id\'=>\'1\', \'text\'=>\'+\'), array(\'id\'=>\'2\', \'text\'=>\'-\')), '),(128,'DOCUMENT PRODUCT Attribute is Display Only - Default','DEFAULT_DOCUMENT_PRODUCT_ATTRIBUTES_DISPLAY_ONLY','0','DOCUMENT PRODUCT Attribute is Display Only<br />Used For Display Purposes Only<br />0= No 1= Yes',4,200,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), '),(129,'DOCUMENT PRODUCT Attribute is Free - Default','DEFAULT_DOCUMENT_PRODUCT_ATTRIBUTE_IS_FREE','1','DOCUMENT PRODUCT Attribute is Free<br />Attribute is Free When Product is Free<br />0= No 1= Yes',4,201,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), '),(130,'DOCUMENT PRODUCT Attribute is Default - Default','DEFAULT_DOCUMENT_PRODUCT_ATTRIBUTES_DEFAULT','0','DOCUMENT PRODUCT Attribute is Default<br />Default Attribute to be Marked Selected<br />0= No 1= Yes',4,202,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), '),(131,'DOCUMENT PRODUCT Attribute is Discounted - Default','DEFAULT_DOCUMENT_PRODUCT_ATTRIBUTES_DISCOUNTED','1','DOCUMENT PRODUCT Attribute is Discounted<br />Apply Discounts Used by Product Special/Sale<br />0= No 1= Yes',4,203,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), '),(132,'DOCUMENT PRODUCT Attribute is Included in Base Price - Default','DEFAULT_DOCUMENT_PRODUCT_ATTRIBUTES_PRICE_BASE_INCLUDED','1','DOCUMENT PRODUCT Attribute is Included in Base Price<br />Include in Base Price When Priced by Attributes<br />0= No 1= Yes',4,204,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), '),(133,'DOCUMENT PRODUCT Attribute is Required - Default','DEFAULT_DOCUMENT_PRODUCT_ATTRIBUTES_REQUIRED','0','DOCUMENT PRODUCT Attribute is Required<br />Attribute Required for Text<br />0= No 1= Yes',4,205,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), '),(134,'DOCUMENT PRODUCT Attribute Price Prefix - Default','DEFAULT_DOCUMENT_PRODUCT_PRICE_PREFIX','1','DOCUMENT PRODUCT Attribute Price Prefix<br />Default Attribute Price Prefix for Adding<br />Blank, + or -',4,206,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Blank\'), array(\'id\'=>\'1\', \'text\'=>\'+\'), array(\'id\'=>\'2\', \'text\'=>\'-\')), '),(135,'DOCUMENT PRODUCT Attribute Weight Prefix - Default','DEFAULT_DOCUMENT_PRODUCT_PRODUCTS_ATTRIBUTES_WEIGHT_PREFIX','1','DOCUMENT PRODUCT Attribute Weight Prefix<br />Default Attribute Weight Prefix<br />Blank, + or -',4,207,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Blank\'), array(\'id\'=>\'1\', \'text\'=>\'+\'), array(\'id\'=>\'2\', \'text\'=>\'-\')), '),(136,'PRODUCT FREE SHIPPING Attribute is Display Only - Default','DEFAULT_PRODUCT_FREE_SHIPPING_ATTRIBUTES_DISPLAY_ONLY','0','PRODUCT FREE SHIPPING Attribute is Display Only<br />Used For Display Purposes Only<br />0= No 1= Yes',5,201,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), '),(137,'PRODUCT FREE SHIPPING Attribute is Free - Default','DEFAULT_PRODUCT_FREE_SHIPPING_ATTRIBUTE_IS_FREE','1','PRODUCT FREE SHIPPING Attribute is Free<br />Attribute is Free When Product is Free<br />0= No 1= Yes',5,201,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), '),(138,'PRODUCT FREE SHIPPING Attribute is Default - Default','DEFAULT_PRODUCT_FREE_SHIPPING_ATTRIBUTES_DEFAULT','0','PRODUCT FREE SHIPPING Attribute is Default<br />Default Attribute to be Marked Selected<br />0= No 1= Yes',5,202,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), '),(139,'PRODUCT FREE SHIPPING Attribute is Discounted - Default','DEFAULT_PRODUCT_FREE_SHIPPING_ATTRIBUTES_DISCOUNTED','1','PRODUCT FREE SHIPPING Attribute is Discounted<br />Apply Discounts Used by Product Special/Sale<br />0= No 1= Yes',5,203,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), '),(140,'PRODUCT FREE SHIPPING Attribute is Included in Base Price - Default','DEFAULT_PRODUCT_FREE_SHIPPING_ATTRIBUTES_PRICE_BASE_INCLUDED','1','PRODUCT FREE SHIPPING Attribute is Included in Base Price<br />Include in Base Price When Priced by Attributes<br />0= No 1= Yes',5,204,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), '),(141,'PRODUCT FREE SHIPPING Attribute is Required - Default','DEFAULT_PRODUCT_FREE_SHIPPING_ATTRIBUTES_REQUIRED','0','PRODUCT FREE SHIPPING Attribute is Required<br />Attribute Required for Text<br />0= No 1= Yes',5,205,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), '),(142,'PRODUCT FREE SHIPPING Attribute Price Prefix - Default','DEFAULT_PRODUCT_FREE_SHIPPING_PRICE_PREFIX','1','PRODUCT FREE SHIPPING Attribute Price Prefix<br />Default Attribute Price Prefix for Adding<br />Blank, + or -',5,206,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Blank\'), array(\'id\'=>\'1\', \'text\'=>\'+\'), array(\'id\'=>\'2\', \'text\'=>\'-\')), '),(143,'PRODUCT FREE SHIPPING Attribute Weight Prefix - Default','DEFAULT_PRODUCT_FREE_SHIPPING_PRODUCTS_ATTRIBUTES_WEIGHT_PREFIX','1','PRODUCT FREE SHIPPING Attribute Weight Prefix<br />Default Attribute Weight Prefix<br />Blank, + or -',5,207,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Blank\'), array(\'id\'=>\'1\', \'text\'=>\'+\'), array(\'id\'=>\'2\', \'text\'=>\'-\')), ');
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
INSERT INTO `product_types` VALUES (1,'Product - General','product',1,'Y','','2009-11-19 12:39:40','2009-11-19 12:39:40'),(2,'Product - Music','product_music',1,'Y','','2009-11-19 12:39:40','2009-11-19 12:39:40'),(3,'Document - General','document_general',3,'N','','2009-11-19 12:39:40','2009-11-19 12:39:40'),(4,'Document - Product','document_product',3,'Y','','2009-11-19 12:39:40','2009-11-19 12:39:40'),(5,'Product - Free Shipping','product_free_shipping',1,'Y','','2009-11-19 12:39:40','2009-11-19 12:39:40');
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
INSERT INTO `product_types_to_category` VALUES (2,91),(3,93),(4,93),(1,97),(3,97),(4,90),(4,92),(4,97),(5,98);
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
INSERT INTO `products` VALUES (1,1,1000,'SAMPLE-T01','sample_t/t-shirt_01.gif','4500.0000',0,'2007-01-16 15:03:58','2007-01-21 22:27:22',NULL,0.25,1,1,3,0,1,1,0,0,0,0,0,1,0,0,0,0,'4050.0000',2,1,0,0,0,0,0),(2,1,1000,'SAMPLE-T02','sample_t/t-shirt_02.gif','4500.0000',0,'2007-01-16 15:03:58','2007-01-21 22:28:03',NULL,0.25,1,1,3,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',4,1,0,0,0,0,0),(3,1,1000,'SAMPLE-T03','sample_t/t-shirt_03.gif','4500.0000',0,'2007-01-16 15:03:56','2007-01-21 22:27:35',NULL,0.25,1,1,3,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',2,1,0,0,0,0,0),(4,1,1000,'SAMPLE-T04','sample_t/t-shirt_04.gif','4500.0000',0,'2007-01-16 15:03:56','2007-01-20 17:48:17',NULL,0.25,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',2,1,0,0,0,0,0),(5,1,1000,'SAMPLE-T05','sample_t/t-shirt_05.gif','4500.0000',0,'2007-01-16 15:03:56','2007-01-21 22:27:48',NULL,0.25,1,1,3,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',4,1,0,0,0,0,0),(6,1,1000,'SAMPLE-T06','sample_t/t-shirt_06.gif','4500.0000',0,'2007-01-16 15:03:58','2007-01-16 15:03:58',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',5,1,0,0,0,0,0),(7,1,1000,'SAMPLE-T06KIDS','sample_t/t-shirt_06.gif','3800.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.2,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'3800.0000',7,1,0,0,0,0,0),(8,1,1000,'SAMPLE-T07','sample_t/t-shirt_07.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',8,1,0,0,0,0,0),(9,1,1000,'SAMPLE-T08','sample_t/t-shirt_08.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',5,1,0,0,0,0,0),(10,1,1000,'SAMPLE-T09','sample_t/t-shirt_09.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',8,1,0,0,0,0,0),(11,1,1000,'SAMPLE-T10','sample_t/t-shirt_10.gif','4500.0000',0,'2007-01-16 15:03:58','2007-01-18 00:42:21',NULL,0.25,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',5,1,0,0,0,0,0),(12,1,0,'SAMPLE-T10KIDS','sample_t/t-shirt_10.gif','3800.0000',0,'2007-01-16 15:03:57','2007-02-01 18:55:14',NULL,0.2,1,1,1,0,1,1,0,0,0,0,0,1,0,10,0,0,'3800.0000',7,1,0,0,0,0,0),(13,1,1000,'SAMPLE-T11','sample_t/t-shirt_11.gif','4500.0000',0,'2007-01-16 15:03:57','2007-02-01 18:56:23',NULL,0.25,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',8,1,0,0,0,0,0),(14,1,0,'SAMPLE-T12','sample_t/t-shirt_12.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-21 22:11:55',NULL,0.25,1,1,0,0,1,1,0,0,0,0,0,1,0,12,0,0,'4500.0000',5,1,0,0,0,0,0),(15,1,1000,'SAMPLE-T13','sample_t/t-shirt_13.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',9,1,0,0,0,0,0),(16,1,1000,'SAMPLE-T13KIDS','sample_t/t-shirt_13.gif','3800.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.2,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'3800.0000',10,1,0,0,0,0,0),(17,1,1000,'SAMPLE-T14','sample_t/t-shirt_14.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'3800.0000',11,0,0,0,0,0,0),(18,1,1000,'SAMPLE-T15','sample_t/t-shirt_15.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',8,1,0,0,0,0,0),(19,1,1000,'SAMPLE-T16','sample_t/t-shirt_16.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-21 22:25:53',NULL,0.25,1,1,4,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',12,1,0,0,0,0,0),(20,1,1000,'SAMPLE-T16KIDS','sample_t/t-shirt_16.gif','3800.0000',0,'2007-01-16 15:03:57','2007-01-21 22:30:37',NULL,0.2,1,1,4,0,1,1,0,0,0,0,0,1,0,0,0,0,'3800.0000',7,1,0,0,0,0,0),(21,1,1000,'SAMPLE-T17','sample_t/t-shirt_17.gif','4500.0000',0,'2007-01-16 15:03:58','2007-01-21 22:26:50',NULL,0.25,1,1,3,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',13,1,0,0,0,0,0),(22,1,1000,'SAMPLE-T18','sample_t/t-shirt_18.gif','4500.0000',0,'2007-01-16 15:03:58','2007-01-21 22:26:38',NULL,0.25,1,1,3,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',13,1,0,0,0,0,0),(23,1,1000,'SAMPLE-T19','sample_t/t-shirt_19.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',14,1,0,0,0,0,0),(24,1,1000,'SAMPLE-T20','sample_t/t-shirt_20.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',14,1,0,0,0,0,0),(25,1,1000,'SAMPLE-T21','sample_t/t-shirt_21.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',11,1,0,0,0,0,0),(26,1,1000,'SAMPLE-T21KIDS','sample_t/t-shirt_21.gif','3800.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.2,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'3800.0000',7,1,0,0,0,0,0),(27,1,1000,'SAMPLE-T22','sample_t/t-shirt_22.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-21 22:31:27',NULL,0.25,1,1,4,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',12,1,0,0,0,0,0),(28,1,1000,'SAMPLE-T22KIDS','sample_t/t-shirt_22.gif','3800.0000',0,'2007-01-16 15:03:57','2007-01-21 22:30:49',NULL,0.2,1,1,4,0,1,1,0,0,0,0,0,1,0,0,0,0,'3800.0000',7,1,0,0,0,0,0),(29,1,1000,'SAMPLE-T23','sample_t/t-shirt_23.gif','4500.0000',0,'2007-01-16 15:03:58','2007-01-16 15:03:58',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',14,1,0,0,0,0,0),(30,1,1000,'SAMPLE-T23KIDS','sample_t/t-shirt_23.gif','3800.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.2,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'3800.0000',7,1,0,0,0,0,0),(31,1,1000,'SAMPLE-T24','sample_t/t-shirt_24.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',14,1,0,0,0,0,0),(32,1,1000,'SAMPLE-T25','sample_t/t-shirt_25.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-18 00:35:01',NULL,0.25,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',14,1,0,0,0,0,0),(33,1,1000,'SAMPLE-T26','sample_t/t-shirt_26.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',13,1,0,0,0,0,0),(34,1,1000,'SAMPLE-T27','sample_t/t-shirt_27.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',13,1,0,0,0,0,0),(35,1,1000,'SAMPLE-T28','sample_t/t-shirt_28.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',9,1,0,0,0,0,0),(36,1,1000,'SAMPLE-T28KIDS','sample_t/t-shirt_28.gif','3800.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.2,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'3800.0000',10,1,0,0,0,0,0),(37,1,1000,'SAMPLE-T29','sample_t/t-shirt_29.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',9,1,0,0,0,0,0),(38,1,1000,'SAMPLE-T30','sample_t/t-shirt_30.gif','4500.0000',0,'2007-01-16 15:03:58','2007-01-26 03:38:47',NULL,0.25,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',9,1,0,0,0,0,0),(39,1,1000,'SAMPLE-T30KIDS','sample_t/t-shirt_30.gif','3800.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.2,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'3800.0000',10,1,0,0,0,0,0),(40,1,1000,'SAMPLE-T31','sample_t/t-shirt_31.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',9,1,0,0,0,0,0),(41,1,1000,'SAMPLE-T31KIDS','sample_t/t-shirt_31.gif','3800.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.2,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'3800.0000',10,1,0,0,0,0,0),(42,1,1000,'SAMPLE-T32','sample_t/t-shirt_32.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',13,1,0,0,0,0,0),(43,1,1000,'SAMPLE-T33','sample_t/t-shirt_33.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-21 21:26:40','2007-06-10 00:00:00',0.25,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',12,1,0,0,0,0,0),(44,1,1000,'SAMPLE-T34','sample_t/t-shirt_34.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',12,1,0,0,0,0,0),(45,1,1000,'SAMPLE-T35','sample_t/t-shirt_35.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',13,1,0,0,0,0,0),(46,1,1000,'SAMPLE-T36','sample_t/t-shirt_36.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-21 22:26:23',NULL,0.25,1,1,4,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',13,1,0,0,0,0,0),(47,1,1000,'SAMPLE-T37','sample_t/t-shirt_37.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',11,1,0,0,0,0,0),(48,1,1000,'SAMPLE-T38','sample_t/t-shirt_38.gif','4500.0000',0,'2007-01-16 15:03:58','2007-01-21 21:25:57','2007-04-01 00:00:00',0.25,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',13,1,0,0,0,0,0),(49,1,1000,'SAMPLE-T39','sample_t/t-shirt_39.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-18 00:37:13',NULL,0.25,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',13,1,0,0,0,0,0),(50,1,1000,'SAMPLE-T40','sample_t/t-shirt_40.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-21 22:24:08',NULL,0.25,1,1,4,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',15,1,0,0,0,0,0),(51,1,1000,'SAMPLE-T41','sample_t/t-shirt_41.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-21 22:23:36',NULL,0.25,1,1,2,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',16,1,0,0,0,0,0),(52,1,1000,'SAMPLE-T41KIDS','sample_t/t-shirt_41.gif','3800.0000',0,'2007-01-16 15:03:57','2007-01-21 22:28:43',NULL,0.2,1,1,2,0,1,1,0,0,0,0,0,1,0,0,0,0,'3800.0000',7,1,0,0,0,0,0),(53,1,1000,'SAMPLE-T42','sample_t/t-shirt_42.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-21 22:22:48',NULL,0.25,1,1,1,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',16,1,0,0,0,0,0),(54,1,1000,'SAMPLE-T43','sample_t/t-shirt_43.gif','4500.0000',0,'2007-01-16 15:03:58','2007-01-21 22:25:40',NULL,0.25,1,1,1,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',12,1,0,0,0,0,0),(55,1,1000,'SAMPLE-T43KIDS','sample_t/t-shirt_43.gif','3800.0000',0,'2007-01-16 15:03:57','2007-01-21 22:29:01',NULL,0.2,1,1,1,0,1,1,0,0,0,0,0,1,0,0,0,0,'3800.0000',7,1,0,0,0,0,0),(56,1,1000,'SAMPLE-T44','sample_t/t-shirt_44.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-21 22:25:19',NULL,0.25,1,1,1,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',12,1,0,0,0,0,0),(57,1,1000,'SAMPLE-T44KIDS','sample_t/t-shirt_44.gif','3800.0000',0,'2007-01-16 15:03:57','2007-01-21 21:58:29','2007-06-03 00:00:00',0.2,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'3800.0000',17,1,0,0,0,0,0),(58,1,1000,'SAMPLE-T45','sample_t/t-shirt_45.gif','4500.0000',0,'2007-01-16 15:03:58','2007-01-16 15:03:58',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',12,1,0,0,0,0,0),(59,1,1000,'SAMPLE-T45KIDS','sample_t/t-shirt_45.gif','3800.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.2,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'3800.0000',17,1,0,0,0,0,0),(60,1,1000,'SAMPLE-T46','sample_t/t-shirt_46.gif','4500.0000',0,'2007-01-16 15:03:58','2007-01-21 22:24:33',NULL,0.25,1,1,1,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',12,1,0,0,0,0,0),(61,1,1000,'SAMPLE-T46KIDS','sample_t/t-shirt_46.gif','3800.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.2,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'3800.0000',17,1,0,0,0,0,0),(62,1,1000,'SAMPLE-T47','sample_t/t-shirt_47.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-21 22:22:26',NULL,0.25,1,1,1,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',16,1,0,0,0,0,0),(63,1,1000,'SAMPLE-T48','sample_t/t-shirt_48.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-21 22:25:02','2007-08-12 00:00:00',0.25,1,1,2,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',12,1,0,0,0,0,0),(64,1,1000,'SAMPLE-T49','sample_t/t-shirt_49.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-21 22:23:12',NULL,0.25,1,1,2,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',16,1,0,0,0,0,0),(65,1,1000,'SAMPLE-T50','sample_t/t-shirt_50.gif','4500.0000',0,'2007-01-16 15:03:57','2007-01-16 15:03:57',NULL,0.25,1,1,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',2,1,0,0,0,0,0),(90,1,11,'SAMPLE-WP03','sample_w/wallpaper_03.jpg','200.0000',1,'2007-01-16 15:50:07','2007-01-23 11:34:23',NULL,0,1,1,0,0,1,1,0,0,0,0,2,1,0,3,0,0,'200.0000',23,1,0,0,0,0,0),(89,1,1000,'SAMPLE-WP02','sample_w/wallpaper_02.jpg','200.0000',1,'2007-01-16 15:50:07','2007-01-23 11:34:10',NULL,0,1,1,0,0,1,1,0,0,0,0,2,1,0,2,0,0,'200.0000',23,1,0,0,0,0,0),(88,1,1000,'SAMPLE-WP01','sample_w/wallpaper_01.jpg','200.0000',1,'2007-01-16 15:50:07','2007-01-23 11:33:59',NULL,0,1,1,0,0,1,1,0,0,0,0,2,1,0,1,0,0,'200.0000',23,1,0,0,0,0,0),(70,1,1000,'GIFT005','gift_certificates/gv_5.gif','500.0000',0,'2007-01-16 15:03:58','2007-01-20 14:40:45',NULL,0,1,0,0,0,1,1,0,0,0,0,0,1,0,500,0,0,'500.0000',20,1,0,0,0,0,0),(71,1,1000,'GIFT 010','gift_certificates/gv_10.gif','1000.0000',0,'2007-01-16 15:03:58','2007-01-20 14:37:46',NULL,0,1,0,0,0,1,1,0,0,0,0,0,1,0,1000,0,0,'1000.0000',20,1,0,0,0,0,0),(72,1,1000,'GIFT025','gift_certificates/gv_25.gif','2500.0000',0,'2007-01-16 15:03:58','2007-01-20 14:38:41',NULL,0,1,0,0,0,1,1,0,0,0,0,0,1,0,2500,0,0,'2500.0000',20,1,0,0,0,0,0),(73,1,1000,'GIFT050','gift_certificates/gv_50.gif','5000.0000',0,'2007-01-16 15:03:58','2007-01-27 20:58:47',NULL,0,1,0,0,0,1,1,0,0,0,0,0,1,0,5000,0,0,'5000.0000',20,1,0,0,0,0,0),(74,1,1000,'GIFT100','gift_certificates/gv_100.gif','10000.0000',0,'2007-01-16 15:03:58','2007-01-20 14:38:11',NULL,0,1,0,0,0,1,1,0,0,0,0,0,1,0,10000,0,0,'10000.0000',20,1,0,0,0,0,0),(75,1,1000,'GIFTSELECT','gift_certificates/gv.gif','0.0000',0,'2007-01-16 15:03:58','2007-01-22 10:56:42',NULL,0,1,0,0,0,1,1,0,0,0,0,0,1,0,20000,0,0,'0.0000',20,1,0,0,0,0,0),(76,1,1000,'NOTLINK01','sample_t/t-sample.gif','2500.0000',0,'2007-01-16 15:03:58','2007-01-18 00:28:51',NULL,1,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'2500.0000',0,1,0,0,0,0,0),(77,1,1000,'NOTLINK02','sample_t/t-sample.gif','2500.0000',0,'2007-01-16 15:03:58','2007-01-18 00:29:10',NULL,1,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'2500.0000',0,1,0,0,0,0,0),(78,1,1000,'NOTLINK03','sample_t/t-sample.gif','2500.0000',0,'2007-01-16 15:03:58','2007-01-18 00:29:22',NULL,1,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'2500.0000',0,1,0,0,0,0,0),(79,1,1000,'NOTLINK04','sample_t/t-sample.gif','2500.0000',0,'2007-01-16 15:03:58','2007-01-18 00:29:33',NULL,1,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'2000.0000',0,1,0,0,0,0,0),(80,1,1000,'NOTLINK05','sample_t/t-sample.gif','2500.0000',0,'2007-01-16 15:03:58','2007-01-18 00:29:52',NULL,1,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'2500.0000',0,1,0,0,0,0,0),(81,1,1000,'NOTLINK08','sample_t/t-sample.gif','2500.0000',0,'2007-01-16 15:03:58','2007-01-18 00:30:45',NULL,1,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'2500.0000',0,1,0,0,0,0,0),(82,1,1000,'NOTLINK10','sample_t/t-sample.gif','2500.0000',0,'2007-01-16 15:03:58','2007-01-18 00:31:56',NULL,1,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'2500.0000',0,1,0,0,0,0,0),(83,1,1000,'NOTLINK06','sample_t/t-sample.gif','2500.0000',0,'2007-01-16 15:03:58','2007-01-18 00:31:04',NULL,1,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'2500.0000',0,1,0,0,0,0,0),(84,1,1000,'NOTLINK07','sample_t/t-sample.gif','2500.0000',0,'2007-01-16 15:03:58','2007-01-18 00:31:20',NULL,1,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'2500.0000',0,1,0,0,0,0,0),(85,1,1000,'NOTLINK12','sample_t/t-sample.gif','2500.0000',0,'2007-01-16 15:03:58','2007-01-18 00:32:37',NULL,1,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'2500.0000',0,1,0,0,0,0,0),(86,1,1000,'NOTLINK09','sample_t/t-sample.gif','2500.0000',0,'2007-01-16 15:03:58','2007-01-18 00:31:41',NULL,1,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'2500.0000',0,1,0,0,0,0,0),(87,1,1000,'NOTLINK11','sample_t/t-sample.gif','2500.0000',0,'2007-01-16 15:03:58','2007-01-18 00:32:23',NULL,1,1,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'2500.0000',0,1,0,0,0,0,0),(92,1,1000,'FREEALL','sample_t/t-sample.gif','0.0000',0,'2007-01-16 15:50:07','2007-01-26 15:10:55',NULL,1,1,0,0,0,1,1,0,1,0,0,1,1,0,10,0,0,'0.0000',40,1,0,0,0,0,0),(93,1,1000,'FREE3','sample_t/t-sample.gif','10000.0000',0,'2007-01-16 15:50:07','2007-01-18 09:59:02',NULL,1,1,0,0,0,1,1,0,1,0,0,0,1,0,40,0,0,'0.0000',40,1,0,0,0,0,0),(91,1,1000,'SAMPLE-WP04','sample_w/wallpaper_04.jpg','200.0000',1,'2007-01-16 15:50:07','2007-01-23 11:34:34',NULL,0,1,1,4,0,1,1,0,0,0,0,2,1,0,4,0,0,'200.0000',23,1,0,0,0,0,0),(222,1,1000,'FREESHIP1','sample_t/t-shirt_01.gif','4000.0000',0,'2007-01-26 15:27:23','2007-01-26 15:39:06',NULL,50,1,0,0,0,1,1,0,0,0,0,1,1,0,1,0,0,'4000.0000',79,1,0,0,0,0,0),(95,1,1000,'FREE1','sample_t/t-sample.gif','10000.0000',0,'2007-01-16 15:50:07','2007-01-18 09:57:54',NULL,10,1,0,0,0,1,1,0,1,0,0,1,1,0,20,0,0,'0.0000',40,1,0,0,0,0,0),(101,1,1000,'CALL3','sample_t/t-sample.gif','10000.0000',0,'2007-01-16 17:24:53','2007-01-24 09:52:47',NULL,1,1,0,0,0,1,1,0,0,1,0,0,1,0,0,0,0,'8100.0000',64,1,0,0,0,0,0),(98,1,1000,'FREEATTRB1','sample_t/t-sample.gif','10000.0000',0,'2007-01-16 15:50:07','2007-01-23 00:15:26',NULL,0,1,0,0,0,1,1,0,1,0,0,0,1,0,50,0,0,'0.0000',40,1,0,0,0,0,0),(99,1,1000,'CALL1','sample_t/t-sample.gif','0.0000',0,'2007-01-16 15:50:07','2007-01-16 15:50:07',NULL,1,1,0,NULL,0,1,1,0,0,1,0,0,1,0,0,0,0,'0.0000',41,1,0,0,0,0,0),(100,1,1000,'CALL2','sample_t/t-sample.gif','10000.0000',0,'2007-01-16 15:50:07','2007-01-21 00:15:45',NULL,1,1,0,0,0,1,1,0,0,1,0,0,1,0,0,0,0,'10000.0000',41,1,0,0,0,0,0),(102,1,1000,'DISCNTQTY1','sample_t/t-sample.gif','10000.0000',0,'2007-01-16 21:10:16','2007-01-17 23:37:02',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,10,1,0,'10000.0000',45,1,0,0,0,0,0),(103,1,1000,'DISCNTQTY2','sample_t/t-sample.gif','10000.0000',0,'2007-01-16 21:10:16','2007-01-21 00:33:44',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,20,3,0,'10000.0000',45,1,0,0,0,0,0),(104,1,1000,'DISCNTQTY3','sample_t/t-sample.gif','10000.0000',0,'2007-01-16 21:10:17','2007-01-17 23:37:35',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,30,2,0,'10000.0000',45,1,0,0,0,0,0),(115,1,1000,'SEO','','10000.0000',0,'2007-01-16 21:41:07','2007-01-17 16:30:59',NULL,1,1,0,0,0,1,1,0,0,0,1,0,1,0,0,0,0,'10000.0000',58,1,1,1,1,1,1),(113,1,1000,'DISCNTQTY8','sample_t/t-sample.gif','10000.0000',0,'2007-01-16 21:10:17','2007-01-24 15:56:19',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,80,1,1,'5000.0000',45,1,0,0,0,0,0),(112,1,1000,'DISCNTQTY7','sample_t/t-sample.gif','10000.0000',0,'2007-01-16 21:10:17','2007-01-24 15:55:33',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,70,1,0,'10000.0000',45,1,0,0,0,0,0),(111,1,1000,'DISCNTQTY5','sample_t/t-sample.gif','10000.0000',0,'2007-01-16 21:10:17','2007-01-17 23:55:45',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,50,1,1,'5000.0000',45,1,0,0,0,0,0),(110,1,1000,'DISCNTQTY4','sample_t/t-sample.gif','10000.0000',0,'2007-01-16 21:10:17','2007-01-17 23:55:21',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,40,1,0,'9500.0000',45,1,0,0,0,0,0),(116,1,1000,'SEO2','','10000.0000',0,'2007-01-16 21:54:19','2007-01-16 22:00:23',NULL,1,1,0,0,0,1,1,0,0,0,1,0,1,0,10,0,0,'10000.0000',58,1,0,0,0,0,0),(151,1,1000,'ATTR_RADIO3','no_picture.gif','0.0000',0,'2007-01-17 18:12:19','2007-01-18 01:04:39',NULL,0,1,0,0,0,10,1,1,0,0,0,0,1,0,0,0,0,'5.0000',63,1,0,0,0,0,0),(227,1,1000,'ATTR_FILE','sample_t/t-shirt_01.gif','4000.0000',0,'2007-01-31 01:40:08','2007-02-01 18:36:02',NULL,0.2,1,0,0,0,1,1,1,0,0,0,0,1,0,0,0,0,'5000.0000',101,1,0,0,0,0,0),(139,1,1000,'ATTR_TEXT1','sample_t/t-shirt_01.gif','4000.0000',0,'2007-01-17 15:20:31','2007-01-17 17:28:37',NULL,0.2,1,0,0,0,1,1,1,0,0,0,0,1,0,0,0,0,'4000.0000',60,1,0,0,0,0,0),(140,1,1000,'ATTR_TEXT2','sample_t/t-shirt_02.gif','4000.0000',0,'2007-01-17 15:20:31','2007-01-17 17:29:01',NULL,0.2,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'4000.0000',60,1,0,0,0,0,0),(141,1,1000,'ATTR_RDONLY','no_picture.gif','4000.0000',0,'2007-01-17 15:20:31','2007-01-17 17:31:44',NULL,0.2,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'4000.0000',61,1,0,0,0,0,0),(142,1,1000,'ATTR_CHKBOX1','sample_t/t-shirt_01.gif','4000.0000',0,'2007-01-17 15:20:31','2007-01-17 15:20:31',NULL,0.2,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'4000.0000',62,1,0,0,0,0,0),(143,1,1000,'ATTR_CHKBOX2','sample_t/t-shirt_02.gif','0.0000',0,'2007-01-17 15:20:31','2007-01-17 17:57:25',NULL,0.2,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'0.0000',62,1,0,0,0,0,0),(144,1,1000,'ATTR_DROPDOWN1','sample_t/t-shirt_01.gif','4000.0000',0,'2007-01-17 15:20:31','2007-01-17 19:09:09',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'4000.0000',63,1,0,0,0,0,0),(152,1,1000,'ATTR_DROPDOWN2','sample_t/t-shirt_01.gif','4000.0000',0,'2007-01-17 19:09:41','2007-01-21 00:04:16',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'3600.0000',64,0,0,0,0,0,0),(146,1,1000,'ATTR_DROPDOWN3','no_picture.gif','0.0000',0,'2007-01-17 15:20:31','2007-01-18 01:04:56',NULL,0,1,0,0,0,10,1,1,0,0,0,0,1,0,0,0,0,'5.0000',63,1,0,0,0,0,0),(156,1,1000,'SALE10-1','sample_t/t-shirt_01.gif','10000.0000',0,'2007-01-18 14:13:01','2007-01-26 15:19:15',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'9000.0000',67,1,0,0,0,0,0),(155,1,1000,'FREEATTRB2','sample_t/t-sample.gif','10000.0000',0,'2007-01-18 10:22:57','2007-01-18 10:25:25',NULL,0,1,0,0,0,1,1,0,1,0,0,0,1,0,50,0,0,'0.0000',40,1,0,0,0,0,0),(157,1,1000,'SALE10-2','sample_t/t-shirt_02.gif','10000.0000',0,'2007-01-18 14:13:01','2007-01-18 14:13:01',NULL,1,1,0,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'10000.0000',67,1,0,0,0,0,0),(158,1,1000,'SALE10-3','sample_t/t-shirt_03.gif','10000.0000',0,'2007-01-18 14:13:01','2007-01-18 23:24:03',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'9000.0000',67,1,0,0,0,0,0),(159,1,1000,'SALE500-1','sample_t/t-shirt_01.gif','10000.0000',0,'2007-01-18 14:13:01','2007-01-18 14:13:01',NULL,1,1,0,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'9500.0000',68,1,0,0,0,0,0),(160,1,1000,'SALE500-2','sample_t/t-shirt_02.gif','10000.0000',0,'2007-01-18 14:13:01','2007-01-19 01:10:08',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'9500.0000',68,1,0,0,0,0,0),(161,1,1000,'SALE500-3','sample_t/t-shirt_03.gif','10000.0000',0,'2007-01-18 14:13:01','2007-01-18 14:13:01',NULL,1,1,0,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'9500.0000',68,1,0,0,0,0,0),(162,1,1000,'SALESET8000-1','sample_t/t-shirt_01.gif','10000.0000',0,'2007-01-18 14:13:01','2007-01-18 14:13:01',NULL,1,1,0,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'8000.0000',69,1,0,0,0,0,0),(163,1,1000,'SALESET8000-2','sample_t/t-shirt_02.gif','10000.0000',0,'2007-01-18 14:13:02','2007-01-19 01:15:03',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'8000.0000',69,1,0,0,0,0,0),(164,1,1000,'SALESET8000-3','sample_t/t-shirt_03.gif','10000.0000',0,'2007-01-18 14:13:02','2007-01-18 14:13:02',NULL,1,1,0,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'8000.0000',69,1,0,0,0,0,0),(165,1,1000,'SPECIAL1-1','sample_t/t-shirt_01.gif','10000.0000',0,'2007-01-18 14:13:02','2007-01-18 14:13:02',NULL,1,1,0,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'8000.0000',70,1,0,0,0,0,0),(166,1,1000,'SPECIAL2-1','sample_t/t-shirt_01.gif','10000.0000',0,'2007-01-18 14:13:02','2007-01-18 14:13:02',NULL,1,1,0,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'5000.0000',70,1,0,0,0,0,0),(167,1,1000,'SPECIAL2-2','sample_t/t-shirt_02.gif','10000.0000',0,'2007-01-18 14:13:02','2007-01-18 14:13:02',NULL,1,1,0,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'5000.0000',70,1,0,0,0,0,0),(168,1,1000,'SPECIAL2-3','sample_t/t-shirt_03.gif','10000.0000',0,'2007-01-18 14:13:02','2007-01-18 14:13:02',NULL,1,1,0,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'5000.0000',70,1,0,0,0,0,0),(169,1,1000,'SPECIAL3','sample_t/t-shirt_04.gif','10000.0000',0,'2007-01-18 14:13:02','2007-01-18 14:29:48',NULL,1,1,0,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'10000.0000',70,0,0,0,0,0,0),(170,1,1000,'SALE_ETC1','sample_t/t-shirt_01.gif','10000.0000',0,'2007-01-18 14:13:02','2007-01-18 14:13:02',NULL,1,1,0,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'10000.0000',71,1,0,0,0,0,0),(171,1,1000,'SALE_ETC2','sample_t/t-shirt_02.gif','7500.0000',0,'2007-01-18 14:13:03','2007-01-18 14:13:03',NULL,1,1,0,NULL,0,1,1,0,0,0,0,0,1,0,0,0,0,'7500.0000',71,1,0,0,0,0,0),(172,1,1000,'NOSALE','sample_t/t-shirt_04.gif','10000.0000',0,'2007-01-18 14:13:01','2007-01-26 15:18:09',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'10000.0000',72,1,0,0,0,0,0),(173,1,1000,'SALE_SPECIAL1-1','sample_t/t-shirt_03.gif','10000.0000',0,'2007-01-18 14:13:02','2007-01-19 13:25:48',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',73,1,0,0,0,0,0),(174,1,1000,'SALE_SPECIAL1-2','sample_t/t-shirt_04.gif','10000.0000',0,'2007-01-18 14:13:02','2007-01-19 13:27:09',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',73,1,0,0,0,0,0),(175,1,1000,'SALE_SPECIAL1-3','sample_t/t-shirt_05.gif','10000.0000',0,'2007-01-18 14:13:02','2007-01-19 13:27:22',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'4500.0000',73,1,0,0,0,0,0),(176,1,1000,'SALE_SPECIAL2-1','sample_t/t-shirt_03.gif','10000.0000',0,'2007-01-18 14:13:02','2007-01-19 13:27:42',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'9000.0000',74,1,0,0,0,0,0),(177,1,1000,'SALE_SPECIAL2-2','sample_t/t-shirt_04.gif','10000.0000',0,'2007-01-18 14:13:02','2007-01-19 13:27:54',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'9000.0000',74,1,0,0,0,0,0),(178,1,1000,'SALE_SPECIAL2-3','sample_t/t-shirt_05.gif','10000.0000',0,'2007-01-18 14:13:02','2007-01-19 13:28:06',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'9000.0000',74,1,0,0,0,0,0),(179,1,1000,'SALE_SPECIAL3-1','sample_t/t-shirt_03.gif','10000.0000',0,'2007-01-18 14:13:02','2007-01-19 13:28:29',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'5000.0000',75,1,0,0,0,0,0),(180,1,1000,'SALE_SPECIAL3-2','sample_t/t-shirt_04.gif','10000.0000',0,'2007-01-18 14:13:02','2007-01-19 13:28:44',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'5000.0000',75,1,0,0,0,0,0),(181,1,1000,'SALE_SPECIAL3-3','sample_t/t-shirt_05.gif','10000.0000',0,'2007-01-18 14:13:02','2007-01-19 13:28:59',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,0,0,0,'5000.0000',75,1,0,0,0,0,0),(182,1,1000,'DISCNTQTY6','sample_t/t-sample.gif','10000.0000',0,'2007-01-18 16:31:53','2007-01-24 15:54:28',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,60,1,0,'10000.0000',45,0,0,0,0,0,0),(183,1,1000,'MIN','','200.0000',0,'2007-01-18 17:13:22','2007-01-24 19:27:00',NULL,1,1,0,0,0,10,1,0,0,0,1,0,1,0,10,0,0,'200.0000',76,1,0,0,0,0,0),(184,1,1000,'MIN_ATR1','','200.0000',0,'2007-01-18 17:14:01','2007-01-24 19:46:56',NULL,1,1,0,0,0,10,1,0,0,0,1,0,1,0,20,0,0,'200.0000',76,1,0,0,0,0,0),(185,1,1000,'MIN_ATR2','','200.0000',0,'2007-01-18 17:19:58','2007-01-24 19:47:20',NULL,1,1,0,0,0,10,1,0,0,0,0,0,1,0,30,0,0,'200.0000',76,0,0,0,0,0,0),(187,1,1000,'LIMIT-5','','200.0000',0,'2007-01-19 01:58:18','2007-01-24 19:15:18',NULL,1,1,0,0,0,1,1,0,0,0,1,0,1,5,10,0,0,'200.0000',78,1,0,0,0,0,0),(188,1,1000,'LIMIT_ATR1','','200.0000',0,'2007-01-19 02:04:36','2007-01-24 19:22:43',NULL,1,1,0,0,0,1,1,0,0,0,1,0,1,5,50,0,0,'200.0000',78,1,0,0,0,0,0),(189,1,1000,'LIMIT_ATR2','','200.0000',0,'2007-01-19 02:13:38','2007-01-24 19:16:03',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,5,60,0,0,'200.0000',78,0,0,0,0,0,0),(190,1,1000,'TAXOUT','sample_t/t-sample.gif','10000.0000',0,'2007-01-23 10:39:16','2007-01-23 11:18:43',NULL,0.25,1,1,0,0,1,1,0,0,0,1,0,1,0,1,0,0,'10000.0000',81,1,0,0,0,0,0),(191,1,1000,'TAXIN','sample_t/t-sample.gif','10000.0000',0,'2007-01-23 10:41:32','2007-01-23 11:29:24',NULL,0.25,1,0,0,0,1,1,0,0,0,1,0,1,0,2,0,0,'10000.0000',81,1,0,0,0,0,0),(192,1,1000,'ATTR_IMAGE1','sample_t/t-shirt_01.gif','4000.0000',0,'2007-01-23 11:50:48','2007-01-24 00:13:12',NULL,1,1,0,0,0,1,1,0,0,0,0,0,1,0,3,0,0,'4000.0000',82,1,0,0,0,0,0),(193,1,1000,'ATTR_IMAGE2','sample_t/t-shirt_02.gif','4000.0000',0,'2007-01-23 11:53:44','2007-01-24 00:15:48',NULL,0.2,1,0,0,0,1,1,0,0,0,0,0,1,0,4,0,0,'4000.0000',82,1,0,0,0,0,0),(194,1,1000,'IMAGE1','samples/IMAGE1.jpg','4000.0000',0,'2007-01-24 00:34:30','2007-01-24 01:59:35',NULL,0.25,1,0,0,0,1,1,0,0,0,1,0,1,0,1,0,0,'4000.0000',82,1,0,0,0,0,0),(195,1,1000,'IMAGE2','samples/IMAGE2.gif','4000.0000',0,'2007-01-24 00:39:27','2007-01-24 02:21:17',NULL,0.25,1,0,0,0,1,1,0,0,0,1,0,1,0,2,0,0,'4000.0000',82,1,0,0,0,0,0),(196,1,1000,'DISCNTQTY_ATTR1','sample_t/t-shirt_01.gif','4000.0000',0,'2007-01-24 11:25:24','2007-01-25 20:01:10',NULL,0.25,1,0,0,0,1,1,0,0,0,0,0,1,0,1,0,0,'4000.0000',83,1,0,0,0,0,0),(197,1,1000,'DISCNTQTY_ATTR2','sample_t/t-shirt_01.gif','0.0000',0,'2007-01-24 15:35:08','2007-01-25 19:26:28',NULL,0.25,1,0,0,0,1,1,1,0,0,0,0,1,0,2,0,0,'4000.0000',83,1,0,0,0,0,0),(198,1,1000,'DSCNT_ONE1','sample_t/t-shirt_01.gif','0.0000',0,'2007-01-24 16:37:59','2007-01-26 03:05:02',NULL,0.25,1,0,0,0,1,1,1,0,0,0,0,1,0,1,0,0,'4000.0000',85,1,0,0,0,0,0),(199,1,1000,'DSCNT_ONE2','sample_t/t-sample.gif','4000.0000',0,'2007-01-24 17:42:19','2007-01-26 03:08:54',NULL,0.25,1,0,0,0,1,1,0,0,0,1,0,1,0,2,0,0,'4000.0000',85,1,0,0,0,0,0),(200,1,1000,'LIMIT-2','','200.0000',0,'2007-01-24 19:07:16','2007-01-24 19:15:29',NULL,1,1,0,0,0,1,1,0,0,0,1,0,1,1,20,0,0,'200.0000',78,1,0,0,0,0,0),(201,1,1000,'UNIT1','','200.0000',0,'2007-01-24 19:32:13','2007-01-24 19:36:47',NULL,1,1,0,0,0,100,100,0,0,0,1,0,1,0,10,0,0,'200.0000',86,1,0,0,0,0,0),(202,1,1000,'UNIT2','','200.0000',0,'2007-01-24 19:37:00','2007-01-24 19:43:47',NULL,1,1,0,0,0,2000,100,0,0,0,1,0,1,0,20,0,0,'200.0000',86,1,0,0,0,0,0),(203,1,1000,'UNIT_ATR1','','200.0000',0,'2007-01-24 19:44:59','2007-01-24 19:52:48',NULL,1,1,0,0,0,100,1,0,0,0,1,0,1,100,30,0,0,'200.0000',86,1,0,0,0,0,0),(204,1,1000,'UNIT_ATR2','','200.0000',0,'2007-01-24 19:45:15','2007-01-24 19:54:44',NULL,1,1,0,0,0,100,100,0,0,0,0,0,1,0,40,0,0,'200.0000',86,0,0,0,0,0,0),(205,1,1000,'PRCFACTOR','samples/teacup.png','20000.0000',0,'2007-01-25 12:48:10','2007-01-25 18:56:07',NULL,1,1,0,0,0,1,1,0,0,0,1,0,1,0,10,0,0,'20000.0000',87,1,0,0,0,0,0),(206,1,1000,'PRCFACTOR_OFFSET','sample_t/t-shirt_01.gif','0.0000',0,'2007-01-25 17:47:50','2007-01-26 01:32:25',NULL,0,1,0,0,0,1,1,1,0,0,1,0,1,0,20,0,0,'4000.0000',87,1,0,0,0,0,0),(209,1,1000,'BASEPRICE1','sample_t/t-shirt_01.gif','4000.0000',0,'2007-01-26 01:57:23','2007-01-26 02:57:14',NULL,0.25,1,0,0,0,1,1,1,0,0,0,0,1,0,1,0,0,'4500.0000',89,1,0,0,0,0,0),(207,1,1000,'PRCFACTOR_OFFSET_ONCE','sample_t/t-sample.gif','4000.0000',0,'2007-01-25 18:59:30','2007-01-26 17:48:08',NULL,0,1,0,0,0,1,1,1,0,0,1,0,1,0,30,0,0,'4000.0000',87,1,0,0,0,0,0),(208,1,1000,'DISCNTQTY_ATTR_ONCE','sample_t/t-shirt_01.gif','4000.0000',0,'2007-01-25 19:23:37','2007-01-25 20:01:38',NULL,0.25,1,0,0,0,1,1,0,0,0,0,0,1,0,3,0,0,'4000.0000',83,1,0,0,0,0,0),(210,1,1000,'BASEPRICE3','sample_t/t-shirt_01.gif','4000.0000',0,'2007-01-26 02:26:19','2007-01-26 02:50:02',NULL,0.25,1,0,0,0,1,1,1,0,0,0,0,1,0,3,0,0,'5000.0000',89,1,0,0,0,0,0),(211,1,1000,'BASEPRICE2','sample_t/t-shirt_02.gif','4000.0000',0,'2007-01-26 02:46:13','2007-01-26 02:59:27',NULL,0.25,1,0,0,0,1,1,0,0,0,0,0,1,0,2,0,0,'4000.0000',89,1,0,0,0,0,0),(212,2,1001,'RTBHUNTER','sooty.jpg','500.0000',0,'2007-01-26 10:54:55','2007-01-26 19:40:58',NULL,3,1,0,NULL,0,1,1,0,0,0,1,0,1,0,1,0,0,'450.0000',91,1,0,0,0,0,0),(213,2,1001,'HELP','samples/music.jpg','3500.0000',0,'2007-01-26 10:55:12','2007-02-01 18:28:20',NULL,0,1,0,NULL,0,1,1,0,0,0,1,2,1,0,2,0,0,'3500.0000',91,1,0,0,0,0,0),(214,3,0,'','samples/DOC_GENERAL.gif','0.0000',0,'2007-01-26 12:02:50','2007-01-26 17:09:58',NULL,0,1,0,0,0,1,1,0,0,0,0,0,0,0,0,0,0,'0.0000',93,1,0,0,0,0,0),(215,4,1000,'DOC_PRODUCT','samples/DOC_PRODUCT.gif','2000.0000',0,'2007-01-26 12:22:09','2007-01-26 17:01:36',NULL,0,1,0,0,0,1,1,0,0,0,1,0,1,0,2,0,0,'2000.0000',93,1,0,0,0,0,0),(225,1,1001,'DOWNLOAD1','samples/download.jpg','5000.0000',0,'2007-01-26 18:38:56','2007-01-26 19:58:12',NULL,0,1,0,0,0,1,1,0,0,0,1,0,1,0,10,0,0,'5000.0000',100,1,0,0,0,0,0),(217,5,1001,'TYPE_P_FREESHIP','sample_t/t-sample.gif','4000.0000',0,'2007-01-26 14:35:30','2007-01-26 16:53:40',NULL,1,1,0,0,0,1,1,0,0,0,1,1,1,0,10,0,0,'4000.0000',98,1,0,0,0,0,0),(218,1,1000,'FREE2','sample_t/t-sample.gif','0.0000',1,'2007-01-26 15:10:08','2007-01-26 15:10:10','0000-00-00 00:00:00',2,1,0,0,0,1,1,0,1,0,0,0,1,0,30,0,0,'0.0000',40,1,0,0,0,0,0),(224,1,1000,'FREESHIP3','sample_t/t-shirt_02.gif','4000.0000',0,'2007-01-26 15:54:57','2007-01-26 16:12:01',NULL,0,1,0,0,0,1,1,0,0,0,1,0,1,0,3,0,0,'4000.0000',79,1,0,0,0,0,0),(223,1,1000,'FREESHIP2','sample_w/wallpaper_M01.jpg','4000.0000',1,'2007-01-26 15:39:15','2007-01-26 15:48:48',NULL,50,1,0,0,0,1,1,0,0,0,0,1,1,0,2,0,0,'4000.0000',79,1,0,0,0,0,0),(226,1,1000,'DOWNLOAD2','samples/download.jpg','5000.0000',0,'2007-01-26 19:08:15','2007-01-26 19:58:26',NULL,0,1,0,0,0,1,1,0,0,0,1,0,1,0,20,0,0,'5000.0000',100,1,0,0,0,0,0),(229,2,1001,'MEDIA_MIX','samples/music.jpg','3500.0000',0,'2007-02-01 18:06:43','2007-02-01 18:30:53',NULL,0,1,0,0,0,1,1,0,0,0,1,2,1,0,30,0,0,'3500.0000',91,1,0,0,0,0,0);
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
) ENGINE=MyISAM AUTO_INCREMENT=422 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `products_attributes`
--

LOCK TABLES `products_attributes` WRITE;
/*!40000 ALTER TABLE `products_attributes` DISABLE KEYS */;
INSERT INTO `products_attributes` VALUES (1,57,2,9,'0.0000','+',210,1,0,'+',0,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(2,57,2,10,'0.0000','+',220,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(3,57,2,11,'0.0000','+',230,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(4,57,2,12,'0.0000','+',240,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(5,57,2,13,'0.0000','+',250,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(306,59,2,13,'0.0000','+',250,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(305,59,2,12,'0.0000','+',240,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(304,59,2,11,'0.0000','+',230,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(303,59,2,10,'0.0000','+',220,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(302,59,2,9,'0.0000','+',210,1,0,'+',0,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(311,61,2,13,'0.0000','+',250,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(310,61,2,12,'0.0000','+',240,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(309,61,2,11,'0.0000','+',230,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(308,61,2,10,'0.0000','+',220,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(307,61,2,9,'0.0000','+',210,1,0,'+',0,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(16,7,2,9,'0.0000','+',210,1,0,'+',0,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(17,7,2,10,'0.0000','+',220,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(18,7,2,11,'0.0000','+',230,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(19,7,2,12,'0.0000','+',240,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(20,7,2,13,'0.0000','+',250,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(21,12,2,9,'0.0000','+',210,1,0,'+',0,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(22,12,2,10,'0.0000','+',220,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(23,12,2,11,'0.0000','+',230,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(24,12,2,12,'0.0000','+',240,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(25,12,2,13,'0.0000','+',250,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(26,20,2,9,'0.0000','+',210,1,0,'+',0,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(27,20,2,10,'0.0000','+',220,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(28,20,2,11,'0.0000','+',230,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(29,20,2,12,'0.0000','+',240,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(30,20,2,13,'0.0000','+',250,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(31,26,2,9,'0.0000','+',210,1,0,'+',0,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(32,26,2,10,'0.0000','+',220,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(33,26,2,11,'0.0000','+',230,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(34,26,2,12,'0.0000','+',240,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(35,26,2,13,'0.0000','+',250,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(36,28,2,9,'0.0000','+',210,1,0,'+',0,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(37,28,2,10,'0.0000','+',220,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(38,28,2,11,'0.0000','+',230,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(39,28,2,12,'0.0000','+',240,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(40,28,2,13,'0.0000','+',250,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(41,30,2,9,'0.0000','+',210,1,0,'+',0,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(42,30,2,10,'0.0000','+',220,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(43,30,2,11,'0.0000','+',230,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(44,30,2,12,'0.0000','+',240,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(45,30,2,13,'0.0000','+',250,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(46,52,2,9,'0.0000','+',210,1,0,'+',0,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(47,52,2,10,'0.0000','+',220,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(48,52,2,11,'0.0000','+',230,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(49,52,2,12,'0.0000','+',240,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(50,52,2,13,'0.0000','+',250,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(51,55,2,9,'0.0000','+',210,1,0,'+',0,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(52,55,2,10,'0.0000','+',220,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(53,55,2,11,'0.0000','+',230,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(54,55,2,12,'0.0000','+',240,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(55,55,2,13,'0.0000','+',250,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(56,16,2,9,'0.0000','+',210,1,0,'+',0,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(57,16,2,10,'0.0000','+',220,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(58,16,2,11,'0.0000','+',230,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(59,16,2,12,'0.0000','+',240,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(60,16,2,13,'0.0000','+',250,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(61,36,2,9,'0.0000','+',210,1,0,'+',0,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(62,36,2,10,'0.0000','+',220,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(63,36,2,11,'0.0000','+',230,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(64,36,2,12,'0.0000','+',240,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(65,36,2,13,'0.0000','+',250,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(66,39,2,9,'0.0000','+',210,1,0,'+',0,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(67,39,2,10,'0.0000','+',220,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(68,39,2,11,'0.0000','+',230,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(69,39,2,12,'0.0000','+',240,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(70,39,2,13,'0.0000','+',250,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(71,41,2,9,'0.0000','+',210,1,0,'+',0,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(72,41,2,10,'0.0000','+',220,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(73,41,2,11,'0.0000','+',230,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(74,41,2,12,'0.0000','+',240,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(75,41,2,13,'0.0000','+',250,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(77,98,3,4,'500.0000','+',110,0,0,'+',0,1,1,'attributes/color_red.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(78,98,3,5,'0.0000','+',120,0,0,'+',0,0,1,'attributes/color_yellow.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(81,112,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(80,98,3,8,'0.0000','+',140,0,0,'+',0,0,1,'attributes/color_black.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(82,112,3,8,'1000.0000','+',140,1,0,'+',0,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(83,113,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(84,113,3,8,'1000.0000','+',140,1,0,'+',0,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(112,141,6,17,'0.0000','+',620,1,0,'+',0,0,1,'attributes/washM40.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(110,141,6,15,'0.0000','+',600,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(107,139,5,0,'0.0000','+',0,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'5.0000',0,1),(108,140,4,0,'0.0000','+',0,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','20.0000',2,'0.0000',0,1),(101,53,1,2,'0.0000','+',20,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(100,53,1,1,'0.0000','+',30,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(104,64,1,2,'0.0000','+',20,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(103,64,1,1,'0.0000','+',30,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(111,141,6,16,'0.0000','+',610,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(106,139,4,0,'0.0000','+',0,0,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'10.0000',5,1),(102,53,1,3,'0.0000','+',10,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(105,64,1,3,'0.0000','+',10,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(113,141,6,18,'0.0000','+',630,1,0,'+',0,0,1,'attributes/ironM.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(115,142,7,21,'0.0000','+',700,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(116,142,7,22,'0.0000','+',710,1,0,'+',0,0,1,'',0,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(117,142,7,23,'100.0000','+',720,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(118,143,8,27,'3000.0000','+',830,1,0.1,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(119,143,8,28,'3000.0000','+',840,1,0.1,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(120,143,8,29,'3000.0000','+',850,1,0.1,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(121,143,8,30,'3500.0000','+',860,1,0.15,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(122,143,8,31,'3500.0000','+',870,1,0.15,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(123,143,8,26,'4500.0000','+',820,1,0.25,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(124,143,8,24,'4000.0000','+',800,1,0.2,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(125,143,8,25,'4000.0000','+',810,1,0.2,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(126,144,1,1,'0.0000','+',30,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(127,144,1,2,'0.0000','+',20,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(128,144,1,3,'0.0000','+',10,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(129,144,1,19,'500.0000','+',40,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(130,144,3,5,'0.0000','+',120,1,0,'+',0,1,0,'attributes/color_yellow.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(132,144,3,8,'500.0000','+',140,1,0,'+',0,0,0,'attributes/color_black.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(133,144,3,7,'0.0000','+',130,1,0,'+',0,0,0,'attributes/color_blue.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(134,144,3,14,'0.0000','+',100,1,0,'+',0,0,0,'attributes/color_white.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(148,144,1,20,'0.0000','+',50,1,0,'+',1,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(163,152,1,19,'500.0000','+',40,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(164,152,3,5,'0.0000','+',120,1,0,'+',0,1,0,'attributes/color_yellow.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(165,152,3,8,'500.0000','+',140,1,0,'+',0,0,0,'attributes/color_black.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(166,152,3,7,'0.0000','+',130,1,0,'+',0,0,0,'attributes/color_blue.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(167,152,3,14,'0.0000','+',100,1,0,'+',0,0,0,'attributes/color_white.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(168,152,1,20,'0.0000','+',50,1,0,'+',1,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(144,146,9,32,'500.0000','',900,1,0.1,'',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(145,146,9,33,'5.0000','',910,1,0.001,'',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(146,151,10,35,'5.0000','',1010,1,0.001,'',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(147,151,10,34,'500.0000','',1000,1,0.1,'',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(149,144,3,4,'0.0000','+',110,1,0,'+',0,0,0,'attributes/color_red.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(169,152,3,4,'0.0000','+',110,1,0,'+',0,0,0,'attributes/color_red.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(160,152,1,1,'0.0000','+',30,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(161,152,1,2,'0.0000','+',20,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(162,152,1,3,'0.0000','+',10,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(173,155,3,4,'0.0000','+',110,1,0,'+',0,1,1,'attributes/color_red.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(174,155,3,5,'0.0000','+',120,0,0,'+',0,0,1,'attributes/color_yellow.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(175,155,3,8,'0.0000','+',140,0,0,'+',0,0,1,'attributes/color_black.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(291,156,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(292,156,3,4,'0.0000','+',110,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(293,156,3,7,'0.0000','+',130,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(290,156,3,5,'0.0000','+',120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(180,157,3,5,'0.0000','+',120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(181,157,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(182,157,3,4,'2000.0000','+',110,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(183,157,3,7,'0.0000','+',130,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(184,158,3,5,'0.0000','+',120,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(185,158,3,14,'0.0000','+',100,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(186,158,3,4,'2000.0000','+',110,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(187,158,3,7,'0.0000','+',130,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(188,176,3,5,'0.0000','+',120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(189,176,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(190,176,3,4,'0.0000','+',110,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(191,176,3,7,'0.0000','+',130,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(192,177,3,5,'0.0000','+',120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(193,177,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(194,177,3,4,'2000.0000','+',110,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','2000.0000',0,'0.0000',0,0),(195,177,3,7,'0.0000','+',130,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(196,178,3,5,'0.0000','+',120,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(197,178,3,14,'0.0000','+',100,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(198,178,3,4,'2000.0000','+',110,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(199,178,3,7,'0.0000','+',130,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(200,159,3,5,'0.0000','+',120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(201,159,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(202,159,3,4,'0.0000','+',110,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(203,159,3,7,'0.0000','+',130,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(204,160,3,5,'0.0000','+',120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(205,160,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(206,160,3,4,'2000.0000','+',110,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(207,160,3,7,'0.0000','+',130,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(208,161,3,5,'0.0000','+',120,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(209,161,3,14,'0.0000','+',100,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(210,161,3,4,'2000.0000','+',110,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(211,161,3,7,'0.0000','+',130,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(212,162,3,5,'0.0000','+',120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(213,162,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(214,162,3,4,'0.0000','+',110,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(215,162,3,7,'0.0000','+',130,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(216,163,3,5,'0.0000','+',120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(217,163,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(218,163,3,4,'2000.0000','+',110,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(219,163,3,7,'0.0000','+',130,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(220,164,3,5,'0.0000','+',120,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(221,164,3,14,'0.0000','+',100,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(222,164,3,4,'2000.0000','+',110,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(223,164,3,7,'0.0000','+',130,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(224,170,3,5,'0.0000','+',120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(225,170,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(226,170,3,4,'0.0000','+',110,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(227,170,3,7,'0.0000','+',130,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(228,171,3,5,'0.0000','+',120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(229,171,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(230,171,3,4,'0.0000','+',110,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(231,171,3,7,'0.0000','+',130,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(232,173,3,5,'0.0000','+',120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(233,173,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(234,173,3,4,'0.0000','+',110,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(235,173,3,7,'0.0000','+',130,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(236,174,3,5,'0.0000','+',120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(237,174,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(238,174,3,4,'2000.0000','+',110,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(239,174,3,7,'0.0000','+',130,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(240,175,3,5,'0.0000','+',120,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(241,175,3,14,'0.0000','+',100,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(242,175,3,4,'2000.0000','+',110,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(243,175,3,7,'0.0000','+',130,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(244,179,3,5,'0.0000','+',120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(245,179,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(246,179,3,4,'0.0000','+',110,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(247,179,3,7,'0.0000','+',130,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(248,180,3,5,'0.0000','+',120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(249,180,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(250,180,3,4,'2000.0000','+',110,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(251,180,3,7,'0.0000','+',130,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(252,181,3,5,'0.0000','+',120,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(253,181,3,14,'0.0000','+',100,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(254,181,3,4,'2000.0000','+',110,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(255,181,3,7,'0.0000','+',130,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(256,172,3,5,'0.0000','+',120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(257,172,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(258,172,3,4,'0.0000','+',110,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(259,172,3,7,'0.0000','+',130,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(260,165,3,5,'0.0000','+',120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(261,165,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(262,165,3,4,'0.0000','+',110,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(263,165,3,7,'0.0000','+',130,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(264,166,3,5,'0.0000','+',120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(265,166,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(266,166,3,4,'0.0000','+',110,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(267,166,3,7,'0.0000','+',130,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(268,167,3,5,'0.0000','+',120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(269,167,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(270,167,3,4,'2000.0000','+',110,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(271,167,3,7,'0.0000','+',130,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(272,168,3,5,'0.0000','+',120,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(273,168,3,14,'0.0000','+',100,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(274,168,3,4,'2000.0000','+',110,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(275,168,3,7,'0.0000','+',130,1,0,'+',0,0,0,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(276,169,3,5,'0.0000','+',120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(277,169,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(278,169,3,4,'0.0000','+',110,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(279,169,3,7,'0.0000','+',130,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(280,182,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(281,182,3,8,'1000.0000','+',140,1,0,'+',0,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(282,184,3,5,'0.0000','+',120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(283,184,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(284,184,3,4,'0.0000','+',110,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(285,184,3,7,'0.0000','+',130,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(286,185,3,5,'0.0000','+',120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(287,185,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(288,185,3,4,'0.0000','+',110,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(289,185,3,7,'0.0000','+',130,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(294,188,3,5,'0.0000','+',120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(295,188,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(296,188,3,4,'0.0000','+',110,1,0,'+',0,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(297,188,3,7,'0.0000','+',130,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(298,189,3,5,'0.0000','+',120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(299,189,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(300,189,3,4,'0.0000','+',110,1,0,'+',0,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(301,189,3,7,'0.0000','+',130,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(316,88,11,37,'0.0000','+',2010,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(315,88,11,36,'0.0000','+',2000,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(317,89,11,36,'0.0000','+',2000,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(318,89,11,37,'0.0000','+',2010,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(319,90,11,36,'0.0000','+',2000,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(320,90,11,37,'0.0000','+',2010,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(321,91,11,36,'0.0000','+',2000,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(322,91,11,37,'0.0000','+',2010,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(356,193,6,15,'0.0000','+',600,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(365,198,3,14,'4000.0000','',100,1,0,'+',0,1,1,'attributes/t-shirt_01mini.gif',1,'-500.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(327,190,3,5,'2000.0000','+',120,1,0,'+',0,0,0,'attributes/color_yellow.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(360,192,3,38,'0.0000','+',150,1,0,'+',0,0,1,'attributes/t-shirt_02mini.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(361,196,3,14,'0.0000','+',100,1,0,'+',0,1,1,'attributes/t-shirt_01mini.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','9:-0,10:-100,11:-200','','0.0000',0,'0.0000',0,0),(330,190,3,14,'1000.0000','+',100,1,0,'+',0,0,0,'attributes/color_white.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(353,192,3,14,'0.0000','+',100,1,0,'+',0,0,1,'attributes/t-shirt_01mini.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(332,190,3,4,'0.0000','+',110,1,0,'+',0,1,0,'attributes/color_red.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(362,196,3,38,'0.0000','+',150,1,0,'+',0,0,1,'attributes/t-shirt_02mini.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','19:-0,20:-150','','0.0000',0,'0.0000',0,0),(363,197,3,14,'4000.0000','',100,1,0,'+',0,1,1,'attributes/t-shirt_01mini.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','9:-0,10:-100,11:-200','','0.0000',0,'0.0000',0,0),(364,197,3,38,'5000.0000','',150,1,0,'+',0,0,1,'attributes/t-shirt_02mini.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','19:-0,20:-150','','0.0000',0,'0.0000',0,0),(366,198,3,38,'5000.0000','',150,1,0,'+',0,0,1,'attributes/t-shirt_02mini.gif',1,'-1000.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(343,191,3,5,'2000.0000','+',120,1,0,'+',0,0,0,'attributes/color_yellow.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(344,191,3,14,'1000.0000','+',100,1,0,'+',0,0,0,'attributes/color_white.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(345,191,3,4,'0.0000','+',110,1,0,'+',0,1,0,'attributes/color_red.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(357,193,6,16,'0.0000','+',610,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(358,193,6,17,'0.0000','+',620,1,0,'+',0,0,1,'attributes/washM40.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(359,193,6,18,'0.0000','+',630,1,0,'+',0,0,1,'attributes/ironM.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(367,199,12,39,'600.0000','+',2100,1,0,'+',0,1,1,'',1,'10000.0000','0.0000','0.0000','0.0000','0.0000','49:-0,50:-200,100:-300','','0.0000',0,'0.0000',0,0),(368,199,12,40,'700.0000','+',2120,1,0,'+',0,0,1,'',1,'20000.0000','0.0000','0.0000','0.0000','0.0000','49:-0,50:-200,100:-300','','0.0000',0,'0.0000',0,0),(369,199,12,41,'800.0000','+',2130,1,0,'+',0,0,1,'',1,'30000.0000','0.0000','0.0000','0.0000','0.0000','49:-0,50:-200,100:-300','','0.0000',0,'0.0000',0,0),(370,203,3,5,'0.0000','+',120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(371,203,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(372,203,3,4,'0.0000','+',110,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(373,203,3,7,'0.0000','+',130,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(374,204,3,5,'0.0000','+',120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(375,204,3,14,'0.0000','+',100,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(376,204,3,4,'0.0000','+',110,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(377,204,3,7,'0.0000','+',130,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(379,205,14,45,'0.0000','+',2310,1,0,'+',0,1,1,'',1,'0.0000','0.0500','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(380,205,14,46,'0.0000','+',2320,1,0,'+',0,0,1,'',1,'0.0000','0.1500','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(381,205,14,44,'0.0000','+',2300,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(382,206,13,43,'4000.0000','',2210,1,0,'+',0,1,1,'',1,'0.0000','100.0000','1.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(389,209,3,50,'1000.0000','+',180,1,0,'+',0,0,1,'attributes/t-shirt_02mini.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(385,208,3,14,'0.0000','+',100,1,0,'+',0,1,1,'attributes/t-shirt_01mini.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','9:-0,10:-1000,11:-4000','0.0000',0,'0.0000',0,0),(386,208,3,38,'0.0000','+',150,1,0,'+',0,0,1,'attributes/t-shirt_02mini.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','19:-0,20:-5000','0.0000',0,'0.0000',0,0),(390,209,3,49,'500.0000','+',170,1,0,'+',0,1,1,'attributes/t-shirt_01mini.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(405,207,7,21,'0.0000','+',700,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.3000','0.1000','','','0.0000',0,'0.0000',0,0),(391,210,3,50,'1000.0000','+',180,1,0,'+',0,0,1,'attributes/t-shirt_02mini.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(393,210,3,48,'500.0000','+',160,1,0,'+',0,1,1,'attributes/t-shirt_01mini.gif',0,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(394,211,3,50,'1000.0000','+',180,1,0,'+',0,0,1,'attributes/t-shirt_02mini.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(396,211,3,49,'500.0000','+',170,1,0,'+',0,1,1,'attributes/t-shirt_01mini.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(397,217,6,18,'1000.0000','+',630,1,10,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(398,217,3,5,'2000.0000','+',120,1,20,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(399,222,3,14,'0.0000','+',100,1,100,'+',0,1,1,'attributes/t-shirt_01mini.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(400,222,3,38,'0.0000','+',150,1,40,'+',0,0,1,'attributes/t-shirt_02mini.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(404,224,3,38,'0.0000','+',150,1,20,'+',0,0,1,'attributes/t-shirt_02mini.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(403,224,3,14,'0.0000','+',100,1,2,'+',0,1,1,'attributes/t-shirt_01mini.gif',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(406,225,15,53,'0.0000','+',3010,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(407,225,15,52,'0.0000','+',3000,1,0,'+',0,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(408,226,15,53,'0.0000','+',3010,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(409,226,15,52,'0.0000','+',3000,1,0,'+',0,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(410,226,16,56,'0.0000','+',3120,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(411,226,16,54,'0.0000','+',3100,1,0,'+',0,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(412,226,16,55,'0.0000','+',3110,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(413,213,17,57,'0.0000','+',4000,1,1,'+',0,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(414,213,17,58,'0.0000','+',4010,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(417,227,18,0,'1000.0000','+',0,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(420,229,17,57,'0.0000','+',4000,1,1,'+',0,1,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0),(421,229,17,58,'0.0000','+',4010,1,0,'+',0,0,1,'',1,'0.0000','0.0000','0.0000','0.0000','0.0000','','','0.0000',0,'0.0000',0,0);
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
INSERT INTO `products_attributes_download` VALUES (315,'wallpaper_M01.jpg',7,5),(316,'wallpaper_L01.jpg',7,5),(317,'wallpaper_M02.jpg',7,5),(318,'wallpaper_L02.jpg',7,5),(319,'wallpaper_M03.jpg',7,5),(320,'wallpaper_L03.jpg',7,5),(321,'wallpaper_M04.jpg',7,5),(322,'wallpaper_L04.jpg',7,5),(406,'pdf_sample.zip',7,5),(407,'ms_word_sample.zip',7,5),(410,'mac-jp.zip',7,5),(409,'pdf_sample.zip',7,5),(408,'ms_word_sample.zip',7,5),(411,'win-en.zip',7,5),(412,'win-jp.zip',7,5),(414,'help.mp3',7,5);
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
INSERT INTO `products_description` VALUES (1,1,'t-shirt_01','','',0),(1,2,'Zen CartロゴTシャツ','Zen CartオリジナルロゴTシャツです。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',2),(2,1,'t-shirt_02','','',0),(2,2,'Zen CartロゴTシャツ','Zen CartオリジナルロゴTシャツです。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',7),(3,1,'t-shirt_03','','',0),(3,2,'CCロゴTシャツ','クリエイティブ・コモンズロゴのTシャツです。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','http://www.creativecommons.jp/',1),(4,1,'t-shirt_04','','',0),(4,2,'GoogleロゴTシャツ','検索エンジン「Google」のロゴTシャツです。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','www.google.co.jp/',6),(5,1,'t-shirt_05','','',0),(5,2,'FeedアイコンTシャツ','フィードアイコンTシャツです。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',1),(6,1,'t-shirt_06','','',0),(6,2,'三毛猫','三毛猫の写真をあしらったキュートなTシャツ。猫好きに大人気！<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',1),(7,1,'t-shirt_06','','',0),(7,2,'三毛猫 for KIDS','三毛猫の写真をあしらったキュートなTシャツ。猫好きに大人気！<br />大人用もございます。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',2),(8,1,'t-shirt_07','','',0),(8,2,'三毛猫','三毛猫の写真をあしらったTシャツです。猫好きに大人気！<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',2),(9,1,'t-shirt_08','','',0),(9,2,'びちっこ','白猫びちっこの写真をあしらったキュートなTシャツ。猫好きに大人気！<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',5),(10,1,'t-shirt_09','','',0),(10,2,'びちっこ','白猫びちっこの写真をあしらったキュートなTシャツ。猫好きに大人気！<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',4),(11,1,'t-shirt_10','','',1),(11,2,'黒猫こまる（1）','段ボール箱にもぐりこんだ子猫のこまるTシャツ。その愛くるしさに当店人気ナンバーワン商品です。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',7),(12,1,'t-shirt_10','','',0),(12,2,'箱の中のこまる for KIDS','段ボール箱に潜り込んだ黒猫\"こまる\"Tシャツ。人気ナンバーワン商品です。<br />\r\n大人用もございます。<br /><br />\r\n\r\nベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 \r\n豊富なカラーバリエーションで人気 No.1のTシャツです。\r\n良質な綿花で知られるメンフィスコットンを主に使用し、 \r\n水分吸収が良くソフトで肌触りが良いのが特徴です。<br /><br />\r\n\r\nNOTE：<br />\r\nこの商品は在庫切れ商品のサンプルです。<br /><br />\r\n【在庫切れ商品】 在庫数が0になると、その商品には在庫切れ商品のアイコンが表示されます。<br />\r\n\r\n・在庫切れ商品は、ユーザは商品情報の閲覧はできますが、注文はできません。<br />\r\n・在庫が0になったときのふるまい（在庫切れアイコンを表示させるかどうか等）は、管理サイトの一般設定＞在庫の管理から制御可能です。以下のような設定ができます。<br />\r\n　　・在庫がなくなった商品に、「カートに入れる」ボタンの<br />\r\n　　　代わりに「売り切れ」アイコンを表示する/しない<br />\r\n　　・在庫切れ商品を注文できる/できない<br />\r\n　　・在庫切れ商品のステータス変更：<br />\r\n　　　在庫がなくなったら商品ステータスをOFFにして、<br />\r\n　　　ショップ上への掲載を自動で取りやめる/やめない<br />\r\n　　・在庫数をチェックして水準以下になったら運営者に<br />\r\n　　　メールで知らせる/知らせない<br />','',11),(13,1,'t-shirt_11','','',0),(13,2,'黒猫こまる（2）','当ショップのモデル猫\"こまる\"のTシャツ。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',3),(14,1,'t-shirt_12','','',0),(14,2,'Extream Cat（モトクロス）','エクストリームキャットシリーズ。<br /><br />\r\n\r\nベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br />豊富なカラーバリエーションで人気 No.1のTシャツです。良質な綿花で知られるメンフィスコットンを主に使用し、水分吸収が良くソフトで肌触りが良いのが特徴です。<br /><br />\r\n\r\nNOTE：<br />\r\nこの商品は在庫切れ商品のサンプルです。<br /><br />\r\n【在庫切れ商品】 在庫数が0になると、その商品には在庫切れ商品のアイコンが表示されます。<br />\r\n\r\n・在庫切れ商品は、ユーザは商品情報の閲覧はできますが、注文はできません。<br />\r\n・在庫が0になったときのふるまい（在庫切れアイコンを表示させるかどうか等）は、管理サイトの一般設定＞在庫の管理から制御可能です。以下のような設定ができます。<br />\r\n　　・在庫がなくなった商品に、「カートに入れる」ボタンの<br />\r\n　　　代わりに「売り切れ」アイコンを表示する/しない<br />\r\n　　・在庫切れ商品を注文できる/できない<br />\r\n　　・在庫切れ商品のステータス変更：<br />\r\n　　　在庫がなくなったら商品ステータスをOFFにして、<br />\r\n　　　ショップ上への掲載を自動で取りやめる/やめない<br />\r\n　　・在庫数をチェックして水準以下になったら運営者に<br />\r\n　　　メールで知らせる/知らせない<br />','',3),(15,1,'t-shirt_13','','',0),(15,2,'レッドドラゴン','貴族の紋章のようなドラゴン柄です。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0),(16,1,'t-shirt_13','','',0),(16,2,'レッドドラゴン for KIDS','貴族の紋章のようなドラゴン柄です。<br />大人用もございます。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0),(17,1,'t-shirt_14','','',0),(17,2,'おねむ・・・','ねむた〜い春にこんな犬柄はいかが？<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',3),(18,1,'t-shirt_15','','',0),(18,2,'Extream Cat（サーフィン）','エクストリームキャットシリーズ。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',3),(19,1,'t-shirt_16','','',0),(19,2,'ラビット','子供たちにも人気の高いラビットキャラ。キッズTも揃っているから親子で揃えて！<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',2),(20,1,'t-shirt_16','','',0),(20,2,'ラビット for KIDS','子供たちに大人気のラビットキャラ。大人用も揃っているから親子で揃えて！<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0),(21,1,'t-shirt_17','','',0),(21,2,'和風（竹）','大人気の和柄に竹シリーズ登場です。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',1),(22,1,'t-shirt_18','','',0),(22,2,'和風（竹）','大人気の和柄に竹シリーズ登場です。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',1),(23,1,'t-shirt_19','','',0),(23,2,'アイコン（二人）','ビビッドな色使いが印象的なアイコンシリーズ。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0),(24,1,'t-shirt_20','','',0),(24,2,'アイコン（ベビー）','ビビッドな色使いが印象的なアイコンシリーズ。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0),(25,1,'t-shirt_21','','',0),(25,2,'花と犬','お花に囲まれシアワ気分の犬の写真をあしらいました。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0),(26,1,'t-shirt_21','','',0),(26,2,'花と犬 for KIDS','お花に囲まれシアワ気分の犬の写真をあしらいました。大人用も揃っているから親子で揃えて！<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0),(27,1,'t-shirt_22','','',0),(27,2,'フラミンゴ','とぼけた表情が隠れた人気のフラミンゴ柄。キッズTも揃っているから親子で揃えて！<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',1),(28,1,'t-shirt_22','','',0),(28,2,'フラミンゴ for KIDS','とぼけた表情が隠れた人気のフラミンゴ柄。大人用も揃っているから親子で揃えて！<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',4),(29,1,'t-shirt_23','','',0),(29,2,'矢印（イエロー）','ビビッドな色使いが印象的なアイコンシリーズ。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',1),(30,1,'t-shirt_23','','',0),(30,2,'矢印（イエロー） for KIDS','ビビッドな色使いが印象的なアイコンシリーズ。<br />大人用もございます。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',2),(31,1,'t-shirt_24','','',0),(31,2,'矢印（グリーン）','ビビッドな色使いが印象的なアイコンシリーズ。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0),(32,1,'t-shirt_25','','',0),(32,2,'アイコン（ハロー）','ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',2),(33,1,'t-shirt_26','','',0),(33,2,'レモンソーダ','レモンソーダのイラストがかわいいです。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0),(34,1,'t-shirt_27','','',0),(34,2,'四つ葉のクローバー（1）','シアワセをよぶ四つ葉のクローバー柄です。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0),(35,1,'t-shirt_28','','',0),(35,2,'グリーンドラゴン','とぼけた表情が大人気のドラゴン柄。キッズTも揃っているから親子で揃えて！<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',2),(36,1,'t-shirt_28','','',0),(36,2,'グリーンドラゴン for KIDS','とぼけた表情が大人気のドラゴン柄。大人用も揃っているから親子で揃えて！<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',2),(37,1,'t-shirt_29','','',0),(37,2,'首長竜','ドラゴンシリーズの定番柄。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0),(38,1,'t-shirt_30','','',0),(38,2,'ドラゴン','不思議な雰囲気が人気のドラゴン柄です。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',1),(39,1,'t-shirt_30','','',0),(39,2,'ドラゴン for KIDS','不思議な雰囲気が人気のドラゴン柄です。<br />大人用もございます。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',1),(40,1,'t-shirt_31','','',0),(40,2,'ドラゴン','不思議な雰囲気が人気のドラゴン柄です。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',1),(41,1,'t-shirt_31','','',0),(41,2,'ドラゴン for KIDS','不思議な雰囲気が人気のドラゴン柄です。<br />大人用もございます。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0),(42,1,'t-shirt_32','','',0),(42,2,'四つ葉のクローバー（2）','シアワセをよぶ四つ葉のクローバー柄です。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',1),(43,1,'t-shirt_33','','',0),(43,2,'ふくろう','冷めた表情のふくろう柄にファン多し。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',4),(44,1,'t-shirt_34','','',0),(44,2,'ふくろう','冷めた表情のふくろう柄にファン多し。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0),(45,1,'t-shirt_35','','',0),(45,2,'四つ葉のクローバー（1）','シアワセをよぶ四つ葉のクローバー柄です。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0),(46,1,'t-shirt_36','','',0),(46,2,'カフェオレ','ホッと一息つきたい時にやさしいカフェオレ柄はいかがですか？<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',1),(47,1,'t-shirt_37','','',0),(47,2,'ミニチュアダックス','ワン好きにはたまらない、人気のミニチュアダックス柄。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0),(48,1,'t-shirt_38','','',0),(48,2,'レディー（1）','チャーリーズエンジェルを思わせるお洒落なイラスト。Ubaさんの作品をあしらいました。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','www.flickr.com/photo_zoom.gne?id=4042701&size=m&context=set-101799',3),(49,1,'t-shirt_39','','',0),(49,2,'レディー（2）','チャーリーズエンジェルを思わせるお洒落なイラスト。Ubaさんの作品をあしらいました。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','www.flickr.com/photo_zoom.gne?id=4042701&size=m&context=set-101799',0),(50,1,'t-shirt_40','','',0),(50,2,'コーラ','ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',7),(51,1,'t-shirt_41','','',0),(51,2,'ザリガニ','表情がかわいい真っ赤なザリガニ。隠れたヒット商品です。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',6),(52,1,'t-shirt_41','','',0),(52,2,'ザリガニ for KIDS','表情がかわいい真っ赤なザリガニ。隠れたヒット商品です。<br />大人用もございます。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',1),(53,1,'t-shirt_42','','',0),(53,2,'ペンギン','人気の皇帝ペンギン柄。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',1),(54,1,'t-shirt_43','','',0),(54,2,'ペンギン','人気の皇帝ペンギン柄。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0),(55,1,'t-shirt_43','','',0),(55,2,'ペンギン for KIDS','人気の皇帝ペンギン柄。<br />大人用もございます。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0),(56,1,'t-shirt_44','','',0),(56,2,'ぷにぷに','正体不明の海の生き物。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0),(57,1,'t-shirt_44','','',0),(57,2,'ぷにぷに for KIDS','正体不明の海の生き物。<br />大人用もございます。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',5),(58,1,'t-shirt_45','','',0),(58,2,'ブルーホエール','神秘的なブルーホエール（くじら）柄。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0),(59,1,'t-shirt_45','','',0),(59,2,'ホエール for KIDS','神秘的なブルーホエール（くじら）柄。<br />大人用もございます。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',1),(60,1,'t-shirt_46','','',0),(60,2,'オルカ（シャチ）','当ショップ定番Tのシャチ柄<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',2),(61,1,'t-shirt_46','','',0),(61,2,'オルカ（シャチ） for KIDS','当ショップ定番Tのシャチ柄<br />大人用もございます。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',1),(62,1,'t-shirt_47','','',0),(62,2,'オルカ（シャチ）','当ショップ定番Tのシャチ柄<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',3),(63,1,'t-shirt_48','','',0),(63,2,'軍鶏','真っ赤な軍鶏がパワーをくれます。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',3),(64,1,'t-shirt_49','','',0),(64,2,'軍鶏','真っ赤な軍鶏がパワーをくれます。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0),(65,1,'t-shirt_50','','',0),(65,2,'I love T-Shirt','定番の「I love T-Shirt」ロゴ。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','',0),(91,1,'wallpaper_04','','',0),(90,2,'Extream Cat（カヌー）','Extream Catシリーズの壁紙です。<br /><br />\r\n\r\n★この商品はダウンロード商品です','',6),(90,1,'wallpaper_03','','',0),(89,2,'Extream Cat（サーフィン）','Extream Catシリーズの壁紙です。<br /><br />\r\n\r\n★この商品はダウンロード商品です','',2),(89,1,'wallpaper_02','','',0),(88,1,'wallpaper_01','','',0),(88,2,'Extream Cat（ジェットスキー）','Extream Catシリーズの壁紙です。<br /><br />\r\n\r\n★この商品はダウンロード商品です','',11),(70,1,'Gift Certificate $  5.00','Purchase a Gift Certificate today to share with your family, friends or business associates!','',0),(70,2,'ギフト券　500円','ギフト券を購入して、ご家族、お友達、会社の仲間に贈りましょう！','',1),(71,1,'Gift Certificate $ 10.00','Purchase a Gift Certificate today to share with your family, friends or business associates!','',0),(71,2,'ギフト券 1,000円','ギフト券を購入して、ご家族、お友達、会社の仲間に贈りましょう！','',0),(72,1,'Gift Certificate $ 25.00','Purchase a Gift Certificate today to share with your family, friends or business associates!','',0),(72,2,'ギフト券 2,500円','ギフト券を購入して、ご家族、お友達、会社の仲間に贈りましょう！','',0),(73,1,'Gift Certificate $ 50.00','Purchase a Gift Certificate today to share with your family, friends or business associates!','',0),(73,2,'ギフト券 5,000円','ギフト券を購入して、ご家族、お友達、会社の仲間に贈りましょう！','',3),(74,1,'Gift Certificate $100.00','Purchase a Gift Certificate today to share with your family, friends or business associates!','',0),(74,2,'ギフト券 10,000円','ギフト券を購入して、ご家族、お友達、会社の仲間に贈りましょう！','',1),(75,1,'Gift Certificates by attributes','Priced by Attributes Gift Certificates.','',0),(75,2,'ギフト券（購入時に種類を選択）','ギフト券の種類（額面）をオプション属性で設定する例です','',2),(76,1,'Test One','This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.','',0),(76,2,'サンプル01','この商品は、他のカテゴリにリンクしていません。','',0),(77,1,'Test Two','This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.','',0),(77,2,'サンプル02','この商品は、他のカテゴリにリンクしていません。','',0),(78,1,'Test Three','This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.','',0),(78,2,'サンプル03','この商品は、他のカテゴリにリンクしていません。','',0),(79,1,'Test Four','This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.','',0),(79,2,'サンプル04','この商品は、他のカテゴリにリンクしていません。','',0),(80,1,'Test Five','This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.','',0),(80,2,'サンプル05','この商品は、他のカテゴリにリンクしていません。','',0),(81,1,'Test Eight','This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.','',0),(81,2,'サンプル08','この商品は、他のカテゴリにリンクしていません。','',2),(82,1,'Test Ten','This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.','',0),(82,2,'サンプル10','この商品は、他のカテゴリにリンクしていません。','',1),(83,1,'Test Six','This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.','',0),(83,2,'サンプル06','この商品は、他のカテゴリにリンクしていません。','',0),(156,2,'【1】セール適用の基本例','セール機能を理解するための、ごくシンプルな例です。<br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />この商品には商品オプション（カラー3種類）がついていますが、<br />オプションには追加料金を設定していないのでもともとどのカラーでも同料金です。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％OFF<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・セール対象のカテゴリ：　「セール10％OFF」カテゴリ<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール10％OFF」カテゴリ<br />・商品価格：　10000円<br /><br />\r\n\r\nNOTE：<br />\r\nこの商品は、「セール10％OFF」カテゴリ（←これがマスターカテゴリ）の他に、\r\n「セールと特価 > セール対象外カテゴリ」にもリンクされています。<br /><br />\r\n「セール対象外カテゴリ」は、セールの設定をしていないカテゴリですが、\r\nこの商品のマスターカテゴリはセール設定されたカテゴリなので、「セール対象外カテゴリ」で表示される時もセールが適用される点に注目してください。','',2),(84,1,'Test Seven','This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.','',0),(84,2,'サンプル07','この商品は、他のカテゴリにリンクしていません。','',0),(85,1,'Test Twelve','This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.','',0),(85,2,'サンプル12','この商品は、他のカテゴリにリンクしていません。','',0),(86,1,'Test Nine','This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.','',0),(86,2,'サンプル09','この商品は、他のカテゴリにリンクしていません。','',0),(87,1,'Test Eleven','This is a test product to fill this category with more 12 randomly entered products to envoke the split page results on products that are not linked, have no specials, sales, etc.','',0),(87,2,'サンプル11','この商品は、他のカテゴリにリンクしていません。','',0),(91,2,'Extream Cat（モトクロス）','Extream Catシリーズの壁紙です。<br /><br />\r\n\r\n★この商品はダウンロード商品です','',2),(92,1,'A Free Product - All','This is a free product where there are no prices at all.  <br /><br />    The Always Free Shipping is also turned ON.  <br /><br />    If this is bought separately, the Zen Cart Free Charge payment module will show if there is no charges on shipping.  <br /><br />    If other products are purchased with a price or shipping charge, then the Zen Cart Free Charge payment module will not show and the shipping will be applied accordingly.','',0),(92,2,'【例1】無料商品：定価0円、送料も無料','無料商品のサンプルです。もともとの商品価格が0円の商品で、同時に送料も無料に設定した例で、例えばデモ商品やサンプル商品請求などのケースがこれにあたるでしょう。<br /><br /><br />なお、同時購入した他の商品すべてがデモ商品であるときは送料は全く発生しませんが、他に送料がかかる商品も購入すれば、送料は通常通りかかります。<br /><br /><br /><br />【設定メモ】<br /><br />・無料商品： はい<br /><br />・商品価格：　0円<br /><br />・常に送料無料：　はい、常に送料無料<br />','',13),(93,1,'A Free Product - SALE','This is a free product that is also on special.  <br />    This should show as having a price, special price but then be free.  <br />','',0),(93,2,'【例4】無料商品：特価商品をさらに無料に。送料は有料','無料商品のサンプルです。もともとの商品価格は10000円で、さらに特価価格7500円の商品ですが、無料商品＝「はい」に設定したことにより、結果的に無料商品となります。もとの商品価格と、特価価格の両方が表示され、さらにそれらが打ち消されて無料商品と表示されます。<br /><br />商品自体は無料となりますが、この例では送料は無料とせず、通常送料がかかるよう設定しました。このケースは、サンプル商品請求時に送料だけは負担していただきたいような場合を想定しています。<br /><br /><br /><br />【設定メモ】<br /><br />・無料商品：　はい<br /><br />・商品価格： 10000円<br /><br />・特価価格： 7500円<br /><br />・常に送料無料： いいえ、通常送料を適用<br />','',10),(222,1,'FREESHIP1','','',0),(222,2,'【1】常に送料無料','[常に送料無料]の設定を\"はい\"にすることで、その商品の重量や価格に関係なく常時送料無料商品として扱う例です。オプション重量も無料対象に含まれます。<br /><br />\r\n\r\n【設定メモ】商品情報<br />\r\n・[常に送料無料]：はい<br />\r\n・[商品重量]：50Kg<br /><br />\r\n\r\n【設定メモ】オプション属性<br />\r\n\"ホワイト\"／\"オレンジ\" の各オプションについて、\r\n・[オプション重量] 100Kg ／ 40Kg','',9),(223,1,'FREESHIP2','','',0),(223,2,'【2】送料無料・バーチャル商品','[常に送料無料]の設定を\"はい\"にすることで、その商品の重量や価格に関係なく常時送料無料商品になります。さらに[ヴァーチャル商品]の設定も\"はい\"にしたので、注文手続き送付先住所の入力ステップがスキップされます。<br />\r\nオプション重量も無料対象に含まれます。<br /><br />\r\n\r\n【設定メモ】商品情報<br />\r\n・[ヴァーチャル商品]：はい、送付先住所をスキップ<br />\r\n・[常に送料無料]：はい<br />\r\n・[商品重量]：50Kg<br /><br />\r\n\r\n【設定メモ】オプション属性<br />\r\n\"ホワイト\"／\"オレンジ\" の各オプションについて、\r\n・[オプション重量] 100Kg ／ 40Kg','',4),(95,1,'Free Ship & Payment Virtual weight 10','Free Shipping and Payment  <br /><br />    The Price is set to 25.00 ... but what makes it Free is that this product has been marked as:  <br />  Product is Free: Yes  <br /><br />    This would allow the product to be listed with a price, but the actual charge is $0.00  <br /><br />    The weight is set to 10 but could be set to 0. What really makes it truely Free Shipping is that it has been marked to be Always Free Shipping.  <br /><br />    Always Free shipping is set to: Yes<br />  This will not charge for shipping, but requres a shipping address.  <br /><br />    Because there is no shipping and the price is 0, the Zen Cart Free Charge comes up for the payment module and the other payment modules vanish.  <br /><br />    You can change the text on the Zen Cart Free Charge module to read as you would prefer.  <br /><br />    Note: if you add products that incur a charge or shipping charge, then the Zen Cart Free Charge payment module will vanish and the regular payment modules will show.','',0),(95,2,'【例2】無料商品：定価1万円のところ価格・送料共に無料化','無料商品で、かつ送料無料の例です。<br /><br /><br />元の商品価格は10000円ですが、無料商品に設定されているため無料となります。<br />また、商品重量は10Kgありますが、送料を無料に設定していますので送料もかかりません。ただし、バーチャル商品＝いいえに設定してあるのでユーザは送付先住所の入力が必要です。<br /><br />【設定メモ】<br />・無料商品： はい<br />・商品価格：　0円<br />・ヴァーチャル商品： いいえ、送付先住所が必要<br />・常に送料無料：　はい、常に送料無料','',14),(101,2,'【例3】価格お問い合せ商品（定価とセール価格表示）','この商品はセール対象商品です。商品価格（定価）と特価価格、セール価格が表示されますが、この商品をカゴに入れて注文することはできず、事前のお問い合せが必要です。<br /><br />通常の購入ボタンのかわりに「価格お問い合わせ商品 」ボタンが表示され、クリックするとお問い合せフォームが開きます。<br /><br /><br /><br />【設定メモ】<br /><br />・価格お問い合わせ商品：　はい<br /><br />・商品価格 (ネット)： 10000円<br /><br />・特価価格： 9000円<br />・商品の管理＞セールの管理：　この商品マスターカテゴリに10％のセール設定してある','',9),(102,1,'Normal Product','<p>This is a normal product priced at $15</p><p>There are quantity discounts setup which will be discounted from the Products Price.</p><p>Discounts are added on the Products Price Manager.</p>','',0),(102,2,'【例1】○個以上買うと1個あたり○％引き','数量割引（いわゆるボリュームディスカウント）の適用例です。<br />9個までは定価、10〜20個で定価の10％引き、20〜49個で20％引き、50個以上で25％引きというように、割引率による数量割引を設定しました。<br /><br />NOTE：　この設定は「商品価格の管理」から行います。<br />※商品の管理＞商品価格の管理　から呼び出すか、あるいは管理画面の商品リストの右端にある[＄]ボタン（緑色のボタン）から呼び出すことができます。<br /><br /><br /><br />【設定メモ：商品価格の管理】<br /><br />以下の設定により、計算式は、購入代金＝｛定価×（1−数量割引率）｝　×　購入数となります。<br />・ディスカウントタイプ：　割引率<br />・この価格からディスカウント：　価格<br />・割引設定<br /><br />　------------------------------------------<br /><br />　割引レベル　　　　最小限の有効数量　　　割引の値<br /><br />　------------------------------------------<br /><br />　割引3　　　　　　　　10　（個）　　　　　　　　　10.0　（％）　<br /><br />　割引4　　　　　　　　20　（個）　　　　　　　　　20.0　（％）　<br /><br />　割引5　　　　　　　　50　（個）　　　　　　　　　25.0　（％）　<br /><br />　------------------------------------------<br /><br />','',11),(103,1,'Normal Product（2）','','',0),(103,2,'【例2】○個以上買うと1個あたり○円引き','数量割引（いわゆるボリュームディスカウント）の適用例です。<br />9個までは定価、10〜20個で定価の1000円引き、20〜49個で1500円引き、50個以上で2000円引きというように、定価から一定額値引きされる数量割引を設定しました。<br /><br />NOTE：　この設定は「商品価格の管理」から行います。<br />※商品の管理＞商品価格の管理　から呼び出すか、あるいは管理画面の商品リストの右端にある[＄]ボタン（緑色のボタン）から呼び出すことができます。<br /><br /><br /><br />【設定メモ：商品価格の管理】<br /><br />以下の設定により、計算式は、購入代金＝（定価−定額値引き）　×　購入数となります。<br /><br />・ディスカウントタイプ：　一定金額割引<br />・この価格からディスカウント：　価格<br />・割引設定<br /><br />　------------------------------------------<br />　割引レベル　　　　最小限の有効数量　　　割引の値<br />　------------------------------------------<br />　割引3　　　　　　　　10　（個）　　　　　　　　　1000　（円）　<br />　割引4　　　　　　　　20　（個）　　　　　　　　　1500　（円）　<br />　割引5　　　　　　　　50　（個）　　　　　　　　　2000　（円）　<br />　------------------------------------------<br />','',8),(155,1,'A Free Product with Attributes','This is a free product that is also on special.  <br /><br />    This should show as having a price, special price but then be free.  <br /><br />    Attributes can be added that can optionally be set to free or not free  <br /><br />    The Color Red attribute is priced at $5.00 but marked as a Free Attribute when the Product is Free  <br /><br />    The Size Medium attribute is priced at $1.00 but marked as a Free Attribute when Product is Free','',0),(101,1,'A Call for Price Product SALE','This is a Call for Price product that is also on special and has a Sale price via Sale Maker.<br /><br /><br /><br /><br />This should show as having a price, special price but then be Call for Price. This means you cannot buy it.<br /><br /><br /><br /><br />The Add to Cart buttons automatically change to Call for Price, which is defined as: TEXT_CALL_FOR_PRICE<br /><br /><br /><br /><br />This link will take the customer to the Contact Us page.<br /><br /><br />','',0),(98,1,'A Free Product with Attributes','This is a free product that is also on special.  <br /><br />    This should show as having a price, special price but then be free.  <br /><br />    Attributes can be added that can optionally be set to free or not free  <br /><br />    The Color Red attribute is priced at $5.00 but marked as a Free Attribute when the Product is Free  <br /><br />    The Size Medium attribute is priced at $1.00 but marked as a Free Attribute when Product is Free','',0),(98,2,'【例5】無料商品：本体無料だけどオプションは有料','商品を無料商品にしても、商品オプションの追加料金の方は有料のままにしたい場合の例です。<br /><br />\r\n\r\nこの例では、カラー＝レッドを選択した場合だけ追加料金（500円増し）が発生する設定になっています。<br />\r\nさらに、「商品が無料のとき属性による価格も無料にする＝いいえ」に設定されているので、商品を無料商品に設定しても\r\n属性価格には影響しません。つまり、レッドを選択すると500円、他の色を選択したときは0円となります。<br /><br />\r\n\r\n\r\n【設定メモ】<br />\r\n・無料商品： はい<br /><br />\r\n\r\n【オプション属性設定メモ： カラー「レッド」】<br />\r\n・オプション名：カラー<br />\r\n・オプション値：レッド<br />\r\n・属性による価格設定：　＋500円<br />\r\n・商品が無料のとき属性による価格も無料にする： いいえ','',18),(155,2,'【例6】無料商品：本体無料ならオプションも無料','商品を無料商品にしたら、商品オプションの追加料金の方も無料にしたい場合の例です。<br /><br />\r\n\r\nこの例では、カラー＝レッドを選択した場合だけ追加料金（500円増し）が発生する設定になっています。<br />\r\nさらに、「商品が無料のとき属性による価格も無料にする＝はい」に設定されているので、商品を無料商品に設定したら\r\n属性価格も無料になります。つまり、レッドを選択しても0円です。<br /><br />\r\n\r\n\r\n【設定メモ】<br />\r\n・無料商品： はい<br /><br />\r\n\r\n【オプション属性設定メモ： カラー「レッド」】<br />\r\n・オプション名：カラー<br />\r\n・オプション値：レッド<br />\r\n・属性による価格設定：　＋500円　（ベース価格に500円増し）<br />\r\n・商品が無料のとき属性による価格も無料にする： はい','',3),(99,1,'A Call No Price','This is a Call for Price product with no price<br /><br /><br />This should show as having a price, special price but then be Call for Price. This means you cannot buy it.<br /><br />','',0),(99,2,'【例1】価格お問い合せ商品（定価表示なし）','これは「価格お問い合せ商品」の例です。<br /><br />商品価格（定価）を0円に設定してあり価格表示はされません（ただし無料商品には設定されていないので無料マークはつかない）。この商品をカゴに入れて注文することはできず、事前のお問い合せが必要です。<br /><br />通常の購入ボタンのかわりに「価格お問い合わせ商品 」ボタンが表示され、クリックするとお問い合せフォームが開きます。<br /><br /><br /><br />【設定メモ】<br /><br />・無料商品： いいえ<br /><br />・価格お問い合わせ商品：　はい<br /><br />・商品価格 (ネット)： 0円','',5),(100,1,'A Call for Price Product','This is a Call for Price product that is also on special. <br /><br /><br />This should show as having a price, special price but then be Call for Price. This means you cannot buy it','',0),(100,2,'【例2】価格お問い合せ商品（価格表示あり）','価格お問い合せ商品の例です<br /><br /><br />この商品には商品価格が表示されますが、この商品をカゴに入れて注文することはできず、事前のお問い合せが必要です。<br /><br />通常の購入ボタンのかわりに「価格お問い合わせ商品 」ボタンが表示され、クリックするとお問い合せフォームが開きます。<br /><br /><br /><br />【設定メモ】<br /><br />・価格お問い合わせ商品：　はい<br /><br />・商品価格 (ネット)： 10000円<br /><br />・特価価格： 9000円','',9),(104,1,'Normal Product(3)','','',0),(104,2,'【例3】○個以上買うと1個あたり○○円','数量割引（いわゆるボリュームディスカウント）の適用例です。<br />9個までは単価10000円、10〜20個で単価9500円、20〜49個で単価9000円、50個以上で単価8000円というように、単価が割り引き価格になるような数量割引を設定しました。<br /><br />NOTE：　この設定は「商品価格の管理」から行います。<br />※商品の管理＞商品価格の管理　から呼び出すか、あるいは管理画面の商品リストの右端にある[＄]ボタン（緑色のボタン）から呼び出すことができます。<br /><br /><br /><br />【設定メモ：商品価格の管理】<br /><br />以下の設定により、計算式は、購入代金＝割引後価格　×　購入数となります。<br /><br />・ディスカウントタイプ：　割引後価格<br />・この価格からディスカウント：　価格<br />・割引設定<br /><br />　------------------------------------------<br />　割引レベル　　　　最小限の有効数量　　　割引の値<br />　------------------------------------------<br />　割引3　　　　　　　　10　（個）　　　　　　　　　9500　（円）　<br />　割引4　　　　　　　　20　（個）　　　　　　　　　9000　（円）　<br />　割引5　　　　　　　　50　（個）　　　　　　　　　8000　（円）　<br />　------------------------------------------<br />','',8),(115,1,'SEO','','',0),(115,2,'商品ページへのSEO（META、title）設定例','SEO対策の一環として、Zen Cartでは個別商品ごとにMETAタグやtitleタグを明示的に設定することができます。<br /><br />\r\n\r\nこのサンプル商品に対して、以下のように設定しました。<br />\r\nブラウザの「ソースを表示」で、このページのHTMLソースの<head>〜</head>部分を確認してみてください。<br /><br />\r\n\r\n【設定メモ：META】<br />\r\n・title：<br />\r\n　　「この商品ページには明示的にtitleタグを設定しました。」<br /><br />\r\n・META（keyword）：<br />\r\n　　「この商品ページには明示的にMETA（keyword）を設定しています,商品キーワード1,商品キーワード2,商品キーワード3」<br /><br />\r\n\r\n・META（description）：<br />\r\n　　「この商品ページには明示的にMETA（description）を設定しています。Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus sit amet velit・・・」<br /><br />\r\n\r\nNOTE：<br />\r\n・ちなみにこの機能を利用しなくても、Zen Cartでは標準機能としてMETAやtitleタグに商品名や価格その他の要素を埋め込むようにできています。<br />\r\n・管理画面の一般設定＞商品情報の設定から、TITLEタグに商品価格を含める（含めない）やMETA（description）のテキスト長などの設定ができます。これは全商品に対して適用されます。<br /><br />','',15),(113,1,'Normal Product(8)','','',0),(113,2,'【例8】カラー混在OKで合計○個以上なら特価をさらに数量割引','サイズやカラーなどのオプション属性を持ち、さらに特価設定された商品に対して数量割引（いわゆるボリュームディスカウント）を適用したやや複雑な設定例です。<br />9個までは定価、10〜20個で定価の10％引き、20〜49個で20％引き、50個以上で25％引きというように、割引率による数量割引を設定しました。<br />特価ベースで数量割引率が適用される点以外は、前の【例6】と同じ設定です。ふるまいがどう変わるか見比べてみてください。<br />NOTE：　この設定は「商品価格の管理」から行います。<br />※商品の管理＞商品価格の管理　から呼び出すか、あるいは管理画面の商品リストの右端にある[＄]ボタン（緑色のボタン）から呼び出すことができます。<br /><br />【設定メモ：商品価格の管理】<br /><br />以下の設定により、計算式は、購入代金＝｛特価×（1−数量割引率）｝　×　購入数となります。<br />・ディスカウントタイプ：　割引率<br />・この価格からディスカウント：　特価<br />・割引設定<br />　------------------------------------------<br />　割引レベル　　　　最小限の有効数量　　　割引の値<br />　------------------------------------------<br />　割引3　　　　　　　　10　（個）　　　　　　　　　10.0　（％）　<br />　割引4　　　　　　　　20　（個）　　　　　　　　　20.0　（％）　<br />　割引5　　　　　　　　50　（個）　　　　　　　　　25.0　（％）　<br />　------------------------------------------<br /><br />\r\n【設定メモ：オプション属性】<br />\r\n1）カラー「ホワイト」<br />\r\n　　・価格： ＋0円<br />\r\n　　・特価/セール割引を適用した価格をベース価格として扱う：　はい<br />\r\n2）カラー「ブラック」<br />\r\n　　・価格：　＋1000円<br />\r\n　　・特価/セール割引を適用した価格をベース価格として扱う：　はい<br />\r\n　　・属性による価格増減をベース価格に含める：　はい<br /><br />\r\n\r\nNOTE：<br />\r\nこの例では、オプションをいろいろ取り混ぜてよく、この商品の合計が規定量以上であれば（個々のオプション選択がなんであれ）割り引きが適用されます。<br />\r\nつまり、ホワイト5コカゴに入れ、続いてブラックを5コカゴに入れた時点で合計10コと見なされて割引価格が適用されます。<br />\r\nもちろんホワイトあるいはブラック単体で10個以上購入しても割引かれます。<br />\r\nこれは、商品価格の管理において、「数量は同一商品であればオプション値に関係なく合算する＝はい」に設定した場合にこのような動作になります。<br /><br />','',9),(112,1,'Normal Product(7)','','',0),(112,2,'【例7】カラー混在OKで合計○個以上なら割引','サイズやカラーなどのオプション属性を持つ商品に、数量割引（いわゆるボリュームディスカウント）を適用したやや複雑な設定例です。<br />\r\n9個までは定価、10〜20個で定価の10％引き、20〜49個で20％引き、50個以上で25％引きというように、割引率による数量割引を設定しました。<br /><br />\r\nこの例では、オプションをいろいろ取り混ぜてよく、この商品の合計が規定量以上であれば（個々のオプション選択がなんであれ）割り引きが適用されます。<br />\r\nつまり、ホワイト5コカゴに入れ、続いてブラックを5コカゴに入れた時点で合計10コと見なされて割引価格が適用されます。<br />\r\nもちろんホワイトあるいはブラック単体で10個以上購入しても割引かれます。<br />\r\nこれは、商品価格の管理において、「数量は同一商品であればオプション値に関係なく合算する＝はい」に設定した場合にこのような動作になります。<br /><br />\r\n\r\n\r\nNOTE：　この設定は「商品価格の管理」から行います。<br />※商品の管理＞商品価格の管理　から呼び出すか、あるいは管理画面の商品リストの右端にある[＄]ボタン（緑色のボタン）から呼び出すことができます。<br /><br />\r\n\r\n【設定メモ：商品価格の管理】<br />\r\n以下の設定により、計算式は、購入代金＝｛定価×（1−数量割引率）｝　×　購入数となります。<br />\r\n・ディスカウントタイプ：　割引率<br />\r\n・この価格からディスカウント：　価格<br />\r\n・割引設定<br /><br />\r\n　　・数量は同一商品であればオプション値に関係なく合算する：　はい<br />\r\n　------------------------------------------<br />\r\n　割引レベル　　　　最小限の有効数量　　　割引の値<br />\r\n　------------------------------------------<br />\r\n　割引3　　　　　　　　10　（個）　　　　　　　　　10.0　（％）<br />\r\n　割引4　　　　　　　　20　（個）　　　　　　　　　20.0　（％）<br />\r\n　割引5　　　　　　　　50　（個）　　　　　　　　　25.0　（％）<br />\r\n　-----------------------------------------<br /><br />\r\n\r\n【設定メモ：オプション属性】<br />\r\n1）カラー「ホワイト」<br />\r\n　　・価格： ＋0円<br />\r\n　　・特価/セール割引を適用した価格をベース価格として扱う：　はい<br />\r\n2）カラー「ブラック」<br />\r\n　　・価格：　＋1000円<br />\r\n　　・特価/セール割引を適用した価格をベース価格として扱う：　はい<br />\r\n　　・属性による価格増減をベース価格に含める：　はい','',16),(110,1,'Normal Product（4）','','',0),(110,2,'【例4】○個までは特価、それ以上なら定価の○％引き','特価価格が設定された商品に数量割引（いわゆるボリュームディスカウント）を適用した例です。<br />数が少ないうちは特価価格が適用され、一定数以上購入すると、1個あたりの価格が、定価の○％値引かれる数量割引が適用されます。つまり数量割引分は定価ベースで計算される設定です。<br /><br />NOTE：　この設定は「商品価格の管理」から行います。<br />※商品の管理＞商品価格の管理　から呼び出すか、あるいは管理画面の商品リストの右端にある[＄]ボタン（緑色のボタン）から呼び出すことができます。<br /><br /><br /><br />【設定メモ：商品価格の管理】<br /><br />以下の設定により、計算式は、<br />　・数量割引以下の時：　購入代＝特価 × 購入数<br />　・数量割引以上の時：　購入代金＝｛定価×（1−数量割引率）｝　×　購入数で計算されます。<br /><br />・ディスカウントタイプ：　割引率（％）<br />・この価格からディスカウント：　定価<br />・割引設定<br /><br />　------------------------------------------<br />　割引レベル　　　　最小限の有効数量　　　割引の値<br />　------------------------------------------<br />　割引3　　　　　　　　10　（個）　　　　　　　　　10　（％）　<br />　割引4　　　　　　　　20　（個）　　　　　　　　　20　（％）　<br />　割引5　　　　　　　　50　（個）　　　　　　　　　25　（％）　<br />　------------------------------------------<br />','',17),(111,1,'Normal Product(5)','','',0),(111,2,'【例5】○個までは特価、それ以上なら特価をさらに○％引き','特価価格が設定された商品に数量割引（いわゆるボリュームディスカウント）を適用した例です。<br />一定数以上購入すると、1個あたりの価格が、特価価格からさらに○％値引かれます。つまり割引分も特価ベースで計算される設定です。<br /><br />NOTE：　この設定は「商品価格の管理」から行います。<br />※商品の管理＞商品価格の管理　から呼び出すか、あるいは管理画面の商品リストの右端にある[＄]ボタン（緑色のボタン）から呼び出すことができます。<br /><br /><br /><br />【設定メモ：商品価格の管理】<br /><br />以下の設定により、計算式は、購入代金＝（特価×（1−数量割引率）　×　購入数となります。<br /><br />・ディスカウントタイプ：　割引率（％）<br />・この価格からディスカウント：　特価<br />・割引設定<br />　------------------------------------------<br />　割引レベル　　　　最小限の有効数量　　　割引の値<br />　------------------------------------------<br />　割引3　　　　　　　　10　（個）　　　　　　　　　10　（％）<br />　割引4　　　　　　　　20　（個）　　　　　　　　　20　（％）<br />　割引5　　　　　　　　50　（個）　　　　　　　　　25　（％）　<br />　------------------------------------------<br />','',12),(116,1,'SEO2','','',0),(116,2,'META、title設定していない標準の商品ページ例','これは標準の商品ページ（META設定例、title設定を明示的に設定していない）のサンプルです。<br /><br />\r\n\r\nSEO対策の一環として、Zen Cartでは個別商品ごとにMETAタグやtitleタグを明示的に設定することができますが、<br />\r\nこのページをみてわかるように、<br />\r\nZen Cartでは標準機能としてMETAやtitleタグに商品名や価格その他の要素を埋め込むようにできています。<br /><br />\r\n\r\n管理画面の一般設定＞商品情報の設定から、TITLEタグに商品価格を含める（含めない）やMETA（description）のテキスト長などの設定ができます。これは全商品に対して適用されます。<br /><br />','',3),(142,1,'ATTR_CHKBOX1','','',0),(142,2,'【1】ギフトオプション','商品オプションのタイプ＝CHECKBOX（チェックボックス）の活用サンプルです。<br /><br />チェックボックスタイプにすると、1商品あたり複数のオプションを同時選択できます。<br />この例では、ご贈答用やプレゼント向けのオプションとして、（1）ギフト包装、（2）メッセージカード、（3）オリジナルキーホルダー付きの3つを設定しました。<br />このうちオリジナルキーホルダー付きは有料オプション、他の2つは無料サービスとしました。なおオプション料金は特価/セールの影響をうけない設定にしています。<br /><br /><br />【設定メモ】<br />■オプション名：　ギフトオプション<br />　・オプションのタイプ：　CHECKBOX<br />■オプション属性＞価格と重量： <br />　オプション値　　　　　　オプション価格　　　特価商品/セールによって割引を適用する<br />　--------------------------------------------------------------<br />　（1）ギフト包装　　　　 　　　＋0円　　　　　　いいえ<br />　（2）メッセージカード　　　　＋0円　　　　　　いいえ<br />　（3）キーホルダー付き　＋100円　　　　　　いいえ<br />','',16),(140,1,'ATTR_TEXT2','','',0),(140,2,'【2】名入れオプション例（1ワードいくら）','商品オプションのタイプ＝TEXTの活用サンプルです。<br />前の例同様、この例でもＴシャツへの名入れ指定として使っています。<br />前の例では1文字いくらの料金設定でしたが、ここでは1ワードいくらでカウントします（Wordでカウントするのは日本語にはなじまないやり方かもしれませんが？！）<br /><br /><br />2ワードまで無料、3ワード以上では1ワードあたり20円の追加料金でTシャツに指定の文字を入れられる設定です。<br /><br />【設定メモ】<br />■オプション名：　名入れ（1）<br />　・オプションのタイプ：　TEXT<br />　・テキスト属性の最長と表示サイズ<br />　　　・コメント：<br />　　　　「入れたい文字列を入力してください（全角40文字まで）。」<br />　　　・行：　1<br />　　　・表示サイズ：　40<br />　　　・最長：　80<br />■商品オプション属性 ＞ 価格と重量<br />　・言葉ごとの価格？：　20円<br />　・無料の言葉？：　2（ワード）<br />　・属性フラグ<br />　　　・属性によって価格がつけられるとき基本価格に含める：　はい<br />　　　・テキスト入力を必須にする：　はい','',5),(141,1,'ATTR_RDONLY','','',0),(141,2,'表示のみオプション利用例','オプション属性の利用方法は、商品バリエーションの選択肢としての利用だけではありません。<br />商品ページに定型文を表示する用途としても利用可能です。<br />その場合は、オプションのタイプとして「READ ONLY」を使います。<br /><br />【設定メモ】<br />■オプション名：　お手入れ方法<br />　・オプションのタイプ：　READ ONLY<br />■オプション値<br />　（1）綿 100％ <br />　（2）６.1オンス<br />　（3）洗濯機（弱水流）または手荒い。水温は40℃まで。※オプション画像を登録<br />　（4）アイロンは中温（〜160℃）まで 　　※オプション画像を登録','',17),(139,1,'ATTR_TEXT1','','',0),(139,2,'【1】名入れオプション例（1文字いくら）','商品オプションのタイプ＝TEXTの活用サンプルです。<br />この例では、Ｔシャツへの名入れ指定として使っています。<br /><br /><br />名入れエリアは最大2行、<br />　・1行目は5文字まで無料、6文字以上は一文字10円<br />　・2行目は1文字5円<br />の追加料金でTシャツに指定の文字を入れられる想定で設定しました。<br /><br />【設定メモ：商品情報】<br />\r\n・商品属性による価格：　はい<br /><br />【設定メモ】　※ 1行目名入れエリア用<br />■オプション名：　名入れ（1）<br />　・オプションのタイプ：　TEXT<br />　・テキスト属性の最長と表示サイズ<br />　　　・コメント：<br />　　　　「1行目に入れる文字を入力してください（全角40文字まで）。」<br />　　　・行：　1<br />　　　・表示サイズ：　40<br />　　　・最長：　80<br />■商品オプション属性 ＞ 価格と重量<br />　・文字ごとの価格？：　10円<br />　・無料の文字？：　5文字<br />　・属性フラグ<br />　　　・属性によって価格がつけられるとき基本価格に含める：　はい<br />　　　・テキスト入力を必須にする：　はい<br /><br />-----------------------<br />【設定メモ】　※2行目名入れエリア用<br />■オプション名：　名入れ（2）<br />　・オプションのタイプ：　TEXT<br />　・テキスト属性の最長と表示サイズ<br />　　　・コメント：<br />　　　　「2行目に入れる文字を入力してください（全角40文字まで）。」<br />　　　・行：　1<br />　　　・表示サイズ：　40<br />　　　・最長：　80<br />■商品オプション属性 ＞ 価格と重量<br />　・文字ごとの価格？：　5円<br />　・無料の文字？：　0文字<br />　・属性フラグ<br />　　　・属性によって価格がつけられるとき基本価格に含める：　はい<br />　　　・テキスト入力を必須にする：　はい<br /><br />','',7),(144,1,'ATTR_DROPDOWN1','','',0),(144,2,'【1】サイズ、カラー選択','商品オプションのタイプ＝DROPDOWN（リストから選択）およびRADIO（ラジオボタン）の活用サンプルです。<br /><br />Tシャツの販売でよく使われる例として、サイズやカラー選択を例にしました。<br />DROPDOWNやRADIOでは、複数ある選択肢の中から1つだけ選択可能です。<br /><br />選択肢によって追加料金を設定することも可能です。<br />ここではXLサイズ（DROPDOWN）とブラック（RADIO）のみ＋500円と設定しました。<br /><br />【設定メモ】<br />■オプション名：　サイズ<br />　・オプションのタイプ：　DROPDOWN<br />　・オプション値：　S、M、L、XL（＋500円）、「ご選択ください・・・」<br />------------------------------<br />■オプション名：　カラー<br />　・オプションのタイプ：　RADIO<br />　・オプション値：　ホワイト、　イエロー、ブルー、ブラック（＋500円）<br /><br />NOTE：<br /> 「ご選択ください・・・」オプション値の属性フラグ設定は、<br />　「表示のみ」＝\"はい\"に、かつ「属性によって価格がつけられるとき基本価格に含める」＝\"いいえ\"に設定されている。 <br />　これにより、「ご選択ください・・・」を選択した状態でカゴに入れることはできないため、ユーザは必ず他のいずれか（SサイズとかMサイズ）を選ぶことになる。<br /><br />\r\n\r\nNOTE：\r\nカラー選択のラジオボタンに、カラーチップ（色見本）が添えられていますが、これは、商品オプション属性＞属性の見本画像 で画像を登録すると表示されます。<br /><br />\r\nなお、ラジオボタン、オプション名、見本画像の配置は、「オプション名の管理」にて、<br />\r\n・列(Row)あたりの属性画像<br />\r\n・ラジオボタン・チェックボックスの属性スタイル<br />\r\nで変更することができます。','',28),(152,1,'ATTR_DROPDOWN2','','',0),(152,2,'【2】サイズ、カラー選択（セール10％オフ適用）','商品オプションのタイプ＝DROPDOWN（リストから選択）およびRADIO（ラジオボタン）の活用サンプルです。<br /><br />前の例（【1】サイズ、カラー選択）とオプション設定内容は全く同じですが、<br />\r\nこの商品はセール10％引きの対象になっている点が異なります。<br /><br />\r\n\r\n選択肢によって追加料金を設定することも可能で、<br />\r\nその場合、セールが追加料金に適用されるかどうかはオプション属性の設定次第です。<br />\r\n\r\n例えばXLサイズは追加料金＋500円のところ、<br />\r\n「オプション属性にも割引を適用する＝はい」に設定しているので<br />\r\nこの追加料金に対しても10％引きが適用されることになり、<br />\r\nXLサイズ選択時の実際の追加料金は＋450円です。<br /><br />\r\n\r\nこれに対してブラック（カラー）はXLサイズと同じ追加料金＋500円ですが、<br />\r\n「オプション属性にも割引を適用する＝いいえ」に設定しているので<br />\r\n10％引きが適用されず、実際の追加料金も＋500円のままかかります。<br /><br />\r\n\r\n【設定メモ】<br />■オプション名：　サイズ<br />　・オプションのタイプ：　DROPDOWN<br />　・オプション値：　S、M、L、XL（＋500円）、「ご選択ください・・・」<br />　・オプション属性にも割引を適用する：　はい<br />------------------------------<br />■オプション名：　カラー<br />　・オプションのタイプ：　RADIO<br />　・オプション値：　ホワイト、　イエロー、ブルー、ブラック（＋500円）<br />　・オプション属性にも割引を適用する：　いいえ<br /><br />NOTE：<br /> 「ご選択ください・・・」オプション値の属性フラグ設定は、<br />　「表示のみ」＝\"はい\"に、かつ「属性によって価格がつけられるとき基本価格に含める」＝\"いいえ\"に設定されている。 <br />　これにより、「ご選択ください・・・」を選択した状態でカゴに入れることはできないため、ユーザは必ず他のいずれか（SサイズとかMサイズ）を選ぶことになる。<br /><br />\r\n\r\nNOTE：\r\nカラー選択のラジオボタンに、カラーチップ（色見本）が添えられていますが、これは、商品オプション属性＞属性の見本画像 で画像を登録すると表示されます。<br /><br />\r\nなお、ラジオボタン、オプション名、見本画像の配置は、「オプション名の管理」にて、<br />\r\n・列(Row)あたりの属性画像<br />\r\n・ラジオボタン・チェックボックスの属性スタイル<br />\r\nで変更することができます。','',43),(146,1,'ATTR_DROPDOWN3','','',0),(146,2,'【3D】リボンの量り売り（DROPDOWN）','商品オプションのタイプ＝DROPDOWN（リストから選択）の活用サンプルです。<br /><br />この例はリボンの量り売りという想定です。<br />ユーザは1メートルあるいは1センチメートル単位で購入できるものとし、<br />購入単位はDROPDOWNタイプの商品オプションを使って選択可能にしています。<br /><br />メートル選択時は、1（m）あたり ＠500円で、商品重量は100g（＝0．1Kg）、<br />センチ選択時は、1（cm）あたり  ＠5円で、商品重量は1g（＝0．001Kg）のように、<br />購入単位の選択に応じて、単位長さあたりの値段と商品重量が決まるところがミソです。<br /><br />また、最小購買数を設定しており、購入は10cm（mの場合は10m）以上からとなります。<br /><br />【設定メモ】<br />■商品情報<br />　・商品属性による価格：　はい<br />　・商品価格 (ネット)：　0<br />　・商品の最小数量：　10<br />　・商品の数量単位：　　1<br />　・商品重量：　0<br /><br />■オプション属性の設定<br />・オプション名：　単位長さ<br />・オプション属性： <br />　・特価商品/セールによって割引を適用する：　はい<br />　・属性によって価格がつけられるとき基本価格に含める：　はい<br /><br />　・価格と重量<br />　　オプション値　　　　　　オプション価格　　　オプション重量<br />　　--------------------------------------------------------------<br />　　（1）メートル　　　　　 　　　500円　　　　　0．1（Kg）<br />　　（2）センチメートル　　 　　5円　　　　　　 0．001（Kg）<br /><br />NOTE：<br />同じカテゴリに、これと商品オプション内容をRADIO（ラジオボタン）タイプで設定した例を掲載しています（→【3R】リボンの量り売り（単位選択））。見た目の違いなどご確認ください。','',12),(157,2,'【2】商品オプション料金にもセール適用する例','セール機能を理解するための、ごくシンプルな例です。<br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />この商品には商品オプション（カラー3種類）がついています。<br />このうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />この例では、セールが適用された時に、オプション料金にもセールが適用されるように設定しています。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％OFF<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・セール対象のカテゴリ：　「セール10％OFF」カテゴリ<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール10％OFF」カテゴリ<br />・商品価格：　10000円<br /><br />【設定メモ：商品オプション属性】　※この商品に関する設定<br />・オプション名：　カラー<br />・オプション値：　レッド<br />・オプション価格：　＋2000円<br />・特価商品/セールによって割引を適用する： はい','',5),(158,2,'【3】商品オプション料金はセール対象外にする例','セール機能を理解するための、ごくシンプルな例です。<br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />この商品には商品オプション（カラー3種類）がついています。<br />このうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />一つ前の例（【2】商品オプションの追加料金にもセールが適用される例）と異なり、この例ではセールが適用された時に、オプション料金にはセールが適用されない設定にしています。つまり、セール中も、通常通りのオプション料金がかかります。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％OFF<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・セール対象のカテゴリ：　「セール10％OFF」カテゴリ<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール10％OFF」カテゴリ<br />・商品価格：　10000円<br /><br /><br />【設定メモ：商品オプション属性】　※この商品に関する設定<br />・オプション名：　カラー<br />・オプション値：　レッド<br />・オプション価格：　＋2000円<br />・特価商品/セールによって割引を適用する： いいえ','',1),(143,1,'ATTR_CHKBOX2','','',0),(143,2,'【2】ファミリー向けセット販売','商品オプションのタイプ＝CHECKBOX（チェックボックス）の活用サンプルです。<br /><br />チェックボックスタイプにすると、1商品あたり複数のオプションを同時選択できます。<br />この例では、ファミリーでお揃いのTシャツを購入するようなケースを想定して、<br />パパ用にLサイズ、ママはSサイズ、お兄ちゃんには身長150cmサイズで妹のA子ちゃんに身長120cmサイズ・・・のようにサイズを選び、<br />セット購入できるよう設定しました。<br /><br /><br />NOTE：<br />選んだサイズごとに価格と商品重量が異なりそれらはオプション料金、オプション重量として設定しています。<br />これらは「特価商品/セールによって割引を適用する＝はい」の設定なので、<br />もしこの商品に特価設定等を行えばオプション料金の額も変化します。<br /><br />【設定メモ】<br />■オプション名：　サイズ<br />　・オプションのタイプ：　CHECKBOX<br />■オプション値：　S, M, L, 110, 120, 130, 140, 150<br />■オプション属性<br />　オプション値　　　　　　オプション価格　　　特価商品/セールによって割引を適用する<br />　--------------------------------------------------------------<br />　Sサイズ　　　　　　　　　　　 +4000円　　　　はい<br />　Mサイズ 　　　　　　　　　　　+4000円　　　　はい<br />　Lサイズ： 　　　　　　　　　　+4500円　　　　はい<br />　140、150cm：　　　　　　　 +3500円　　　　はい<br />　110、120、130cm：　　　　+3000円　　　　はい','',10),(151,1,'ATTR_RADIO3','','',0),(151,2,'【3R】リボンの量り売り（RADIO）','商品オプションのタイプ＝RADIO（ラジオボタン））の活用サンプルです。<br /><br />この例はリボンの量り売りという想定です。<br />ユーザは1メートルあるいは1センチメートル単位で購入できるものとし、<br />購入単位はDROPDOWNタイプの商品オプションを使って選択可能にしています。<br /><br />メートル選択時は、1（m）あたり ＠500円で、商品重量は100g（＝0．1Kg）、<br />センチ選択時は、1（cm）あたり  ＠5円で、商品重量は1g（＝0．001Kg）のように、<br />購入単位の選択に応じて、単位長さあたりの値段と商品重量が決まるところがミソです。<br /><br />また、最小購買数を設定しており、購入は10cm（mの場合は10m）以上からとなります。<br /><br />【設定メモ】<br />■商品情報<br />　・商品属性による価格：　はい<br />　・商品価格 (ネット)：　0<br />　・商品の最小数量：　10<br />　・商品の数量単位：　　1<br />　・商品重量：　0<br /><br />■オプション属性の設定<br />・オプション名：　単位長さ<br />・オプション属性： <br />　・特価商品/セールによって割引を適用する：　はい<br />　・属性によって価格がつけられるとき基本価格に含める：　はい<br /><br />　・価格と重量<br />　　オプション値　　　　　　オプション価格　　　オプション重量<br />　　--------------------------------------------------------------<br />　　（1）メートル　　　　　 　　　500円　　　　　0．1（Kg）<br />　　（2）センチメートル　　 　　5円　　　　　　 0．001（Kg）<br /><br /><br />NOTE：<br />同じカテゴリに、これと商品オプション内容をDROPDOWN（リスト選択）タイプで設定した例を掲載しています（→【3D】リボンの量り売り（単位選択））。見た目の違いなどご確認ください。','',4),(227,2,'【1】ロゴデータ・ファイルを添付して注文','商品オプションのタイプ＝FILEの活用サンプルです。<br /><br />\r\n\r\nFILEタイプにすると、アップロードファイルの指定欄が表示され、ユーザはファイルを添付して注文することができます。<br />\r\n\r\nこの例で扱うＴシャツは、会社やクラブのロゴをオリジナルプリントできる商品で、ロゴのデータファイルはユーザがあらかじめイラストレータなどで作成したものをアップロードして運営者に渡します。なお、オプション料金として1000円かかります。<br /><br /><br />\r\n\r\n\r\n【オプション名の設定】<br />\r\n・[オプション名]：　\"ロゴ・データ添付\"<br />\r\n・[オプションのタイプ]：　FILE<br /><br />\r\n※FILEタイプの場合は、オプション値登録は不要です。<br /><br />\r\n\r\n【設定メモ：商品情報】<br />\r\n・[商品価格]：4000円<br />\r\n・[商品属性による価格]：はい<br /><br />\r\n\r\n【設定メモ：オプション属性】\"ロゴ・データ添付\"オプション<br />\r\n・オプション価格：+1000 円<br />','',4),(227,1,'ATTR_FILE','','',0),(159,2,'【1】セール適用の基本例','セール機能を理解するための、ごくシンプルな例です。<br />このカテゴリに対して、500円引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />この商品には商品オプション（カラー3種類）がついていますが、<br />オプションには追加料金を設定していないのでもともとどのカラーでも同料金です。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　500円OFF<br />・値引き額：　500（円）<br />・タイプ：　値引き額<br />・セール対象のカテゴリ：　「セール：500円OFF」カテゴリ<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール：500円OFF」カテゴリ<br />・商品価格：　10000円<br />','',2),(160,2,'【2】商品オプション料金にもセール適用する例','セール機能を理解するための、ごくシンプルな例です。<br />\r\nこのカテゴリに対して、10％引きのセール設定がされており、このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />\r\n\r\nこの商品には商品オプション（カラー3種類）がついています。<br />\r\nこのうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />\r\nこの例では、セールが適用された時に、オプション料金にもセールが適用されるように設定しています。<br /><br />\r\n\r\n【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />\r\n・セール名：　500円OFF<br />\r\n・値引き額：　500（円）<br />\r\n・タイプ：　値引き額<br />\r\n・セール対象のカテゴリ：　「セール：500円OFF」カテゴリ<br /><br /><br />\r\n\r\n\r\n【設定メモ：商品情報】　※この商品に関する設定<br />\r\n・商品マスターカテゴリ：　「セール：500円OFF」カテゴリ<br />\r\n・商品価格：　10000円<br /><br /><br />\r\n\r\n\r\n【設定メモ：商品オプション属性】　※この商品に関する設定<br />\r\n・オプション名：　カラー<br />\r\n・オプション値：　レッド<br />\r\n・オプション価格：　＋2000円<br />\r\n・特価商品/セールによって割引を適用する： はい<br /><br /><br />\r\n\r\n\r\n<strong>NOTE：</strong>\r\n※実際の運用においては、固定額の値引きセールをオプション料金にも適用する場合は注意が必要です。<br />\r\nこのケースでは、たまたまオプション料金（2000円）がセールの値引き額（-500円）よりも大きいために正常に500円引きが反映されていますが、特に、オプション料金よりもセールの値引き額の方が大きい場合は正しく機能しません。固定額を値引く意味をよく考えて適用を決めてください。<br /><br />','',5),(161,2,'【3】商品オプション料金はセール対象外にする例','セール機能を理解するための、ごくシンプルな例です。<br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />この商品には商品オプション（カラー3種類）がついています。<br />このうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />一つ前の例と異なり、この例では商品へのセール適用時に、オプション料金には適用されない設定にしています。つまり、商品自体がセール価格でもオプション料金に関しては通常通りかかります。<br /><br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　セール500円OFF<br />・値引き額：　500（円）<br />・タイプ：　値引き額<br />・セール対象のカテゴリ：　「セール：500円OFF」カテゴリ<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール：500円OFF」カテゴリ<br />・商品価格：　10000円<br /><br /><br />【設定メモ：商品オプション属性】　※この商品に関する設定<br />・オプション名：　カラー<br />・オプション値：　レッド<br />・オプション価格：　＋2000円<br />・特価商品/セールによって割引を適用する： いいえ','',1),(162,2,'【1】セール適用の基本例','セール機能を理解するための、ごくシンプルな例です。<br />このカテゴリに対して、8000円（新しい価格）にするセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />この商品には商品オプション（カラー3種類）がついていますが、<br />オプションには追加料金を設定していないのでもともとどのカラーでも同料金です。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　新価格8000円<br />・値引き額：　8000（円）<br />・タイプ：　新しい価格<br />・セール対象のカテゴリ：　「セール：1万円を8000円に」カテゴリ<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール：1万円を8000円に」カテゴリ<br />・商品価格：　10000円<br />','',2),(163,2,'【2】商品オプション料金にもセール適用する例','セール機能を理解するための、ごくシンプルな例です。<br />\r\nこのカテゴリに対して、8000円（新しい価格）にするセール設定がされており、このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />\r\n\r\nこの商品には商品オプション（カラー3種類）がついています。<br />\r\nこのうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />\r\nこの例では、セールが適用された時に、オプション料金にもセールが適用されるように設定しています。<br /><br />\r\n\r\n\r\n【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　新価格8000円<br />\r\n・値引き額：　8000（円）<br />\r\n・タイプ：　新しい価格<br />\r\n・セール対象のカテゴリ：　「セール：1万円を8000円に」カテゴリ<br /><br /><br />\r\n\r\n\r\n【設定メモ：商品情報】　※この商品に関する設定<br />\r\n・商品マスターカテゴリ：　「セール：1万円を8000円に」カテゴリ<br />\r\n・商品価格：　10000円<br /><br /><br />\r\n\r\n\r\n【設定メモ：商品オプション属性】　※この商品に関する設定<br />\r\n・オプション名：　カラー<br />\r\n・オプション値：　レッド<br />\r\n・オプション価格：　＋2000円<br />\r\n・特価商品/セールによって割引を適用する： はい<br /><br /><br />\r\n\r\n\r\n<strong>NOTE：</strong><br />\r\n実際にはレッドに対するオプション料金は割引きされません（そもそも2000円のオプション料金に新価格8000円セールを適用したら割り増し価格になってしまいます！）。<br />\r\nこのように、”新しい価格”で元値を置き換えるセール設定をオプションへも適用すること自体無意味な場合が多いため、オプションへの適用は無視される仕様になっています。<br /><br />','',6),(164,2,'【3】商品オプション料金はセール対象外にする例','セール機能を理解するための、ごくシンプルな例です。<br />このカテゴリに対して、8000円（新しい価格）にするセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />この商品には商品オプション（カラー3種類）がついています。<br />このうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />一つ前の例と異なり、この例では商品へのセール適用時に、オプション料金には適用されない設定にしています。つまり、商品自体がセール価格でもオプション料金に関しては通常通りかかります。<br /><br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　新価格8000円<br />・値引き額：　8000（円）<br />・タイプ：　新しい価格<br />・セール対象のカテゴリ：　「セール：1万円を8000円に」カテゴリ<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール：1万円を8000円に」カテゴリ<br />・商品価格：　10000円<br /><br /><br />【設定メモ：商品オプション属性】　※この商品に関する設定<br />・オプション名：　カラー<br />・オプション値：　レッド<br />・オプション価格：　＋2000円<br />・特価商品/セールによって割引を適用する： いいえ<br />','',3),(165,2,'【SP1-1】特価商品の基本例（1万円を8000円に）','特価機能を理解するための、ごくシンプルな例です。<br /><br />この商品には通常価格10000円のところを特価8000円（新価格）にする特価設定がされています。<br />特価は新価格、あるいは割引率で指定可能ですが、これは新価格で設定した例です。<br /><br />この商品には商品オプション（カラー3種類）がついていますが、<br />オプションには追加料金を設定していないのでもともとどのカラーでも同料金です。<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品価格：　10000円<br />・特価価格：　8000円','',0),(166,2,'【SP2-1】特価商品の基本例（50%引）','特価機能を理解するための、ごくシンプルな例です。<br /><br />この商品には通常価格10000円のところを特価8000円（新価格）にする特価設定がされています。<br />特価は新価格、あるいは割引率で指定可能ですが、これは割引率で設定した例です。<br /><br />この商品には商品オプション（カラー3種類）がついていますが、<br />オプションには追加料金を設定していないのでもともとどのカラーでも同料金です。<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品価格：　10000円<br />・特価価格：　50%','',1),(167,2,'【SP2-2】商品オプション料金にも特価適用（50％引）','特価機能を理解するための、ごくシンプルな例です。<br /><br />この商品には通常価格10000円のところを50％引きの特価設定がされています。<br />特価は新価格、あるいは割引率で指定可能ですが、これは割引率で設定した例です。<br /><br /><br />この商品には商品オプション（カラー3種類）がついています。<br />このうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />この例では、商品への特価適用時に、オプション料金にも特価が適用されるように設定しています。<br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品価格：　10000円<br />・特価価格：　50%<br /><br />【設定メモ：商品オプション属性】　※この商品に関する設定<br />・オプション名：　カラー<br />・オプション値：　レッド<br />・オプション価格：　＋2000円<br />・特価商品/セールによって割引を適用する： はい','',2),(168,2,'【SP2-2】商品オプション料金は特価対象外（50％引）','特価機能を理解するための、ごくシンプルな例です。<br /><br />この商品には通常価格10000円のところを50％引きの特価設定がされています。<br />特価は新価格、あるいは割引率で指定可能ですが、これは割引率で設定した例です。<br /><br /><br />この商品には商品オプション（カラー3種類）がついています。<br />このうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />一つ前の例と異なり、この例では商品への特価適用時に、オプション料金には適用されない設定にしています。つまり、商品自体が特価でもオプション料金に関しては通常通りかかります。<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品価格：　10000円<br />・特価価格：　50%<br /><br />【設定メモ：商品オプション属性】　※この商品に関する設定<br />・オプション名：　カラー<br />・オプション値：　レッド<br />・オプション価格：　＋2000円<br />・特価商品/セールによって割引を適用する： いいえ','',0),(169,2,'【SP3】期間限定で特価価格','特価機能を理解するための、ごくシンプルな例です。<br /><br />この商品は通常価格10000円のところを特価で半額にし、<br />さらに特価実施期間を設けました（半年間だけ値引きされます）<br /><br />この商品には商品オプション（カラー3種類）がついていますが、<br />オプションには追加料金を設定していないのでもともとどのカラーでも同料金です。<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品価格：　10000円<br />・特価価格：　50%<br />・提供開始日〜終了日：　2007/1/15 〜 2007/6/15','',0),(170,2,'セール期間と適用価格帯（適用されるケース）','セールの設定では、セール実施期間を限定したり、セール対象を商品価格帯で絞ったりする機能があります。<br />例えば「8月限定バーゲンセール」や「クリスマスセール」を実施したい場合などに活用できるでしょう。<br />さらに価格帯機能を使えば、5000円〜10000円の商品だけを値引きするといったことが可能です。<br /><br />このカテゴリは、10％引きのセール設定がされていますが、<br />特定の実施期間を設けています。また、8000円以上の商品にだけセールを適用するよう設定してあります。<br /><br />この商品の価格は1万円なので、セールが適用されます。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％セール期間と価格帯限定<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・価格幅：　10000円 から [入力しない]円<br />・セール対象のカテゴリ：　「セール関連etc」カテゴリ<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール関連etc」カテゴリ<br />・商品価格：　10000円','',1),(171,2,'セール期間と適用価格帯（適用されないケース）','セールの設定では、セール実施期間を限定したり、セール対象を商品価格帯で絞ったりする機能があります。<br />例えば「8月限定バーゲンセール」や「クリスマスセール」を実施したい場合などに活用できるでしょう。<br />さらに価格帯機能を使えば、5000円〜10000円の商品だけを値引きするといったことが可能です。<br /><br />このカテゴリは、10％引きのセール設定がされていますが、<br />特定の実施期間を設けています。また、8000円以上の商品にだけセールを適用するよう設定してあります。<br /><br />この商品の価格は7500円ですので、セールの適用対象外となります。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％セール期間と価格帯限定<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・価格幅：　10000円 から [入力しない]円<br />・セール対象のカテゴリ：　「セール関連etc」カテゴリ<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール関連etc」カテゴリ<br />・商品価格：　7500円','',2),(172,2,'【4】この商品にはセールが適用されません','この商品はセールが適用されません。なぜでしょうか？<br />理由は、この商品はリンク商品で、「商品マスターカテゴリ」がセール対象外のカテゴリだからです。<br /><br /><strong>NOTE：</strong><br />複数のカテゴリにリンクされた商品の場合、商品マスターカテゴリのセール設定が適用されます。<br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「このカテゴリにはセール設定していない」カテゴリ<br />・商品価格：　10000円','',2),(173,2,'【SP1】特価商品にセール適用の基本例','特価商品にセールを適用した場合のふるまいを理解するための、ごくシンプルな例です。<br /><br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />また、セールとは別に<br />この商品には通常価格10000円のところを半額にする特価設定がされています。<br /><br />特価商品に対するセールの設定を「特価商品の価格にさらにセール値引きを適用する」にしたので<br />特価価格からさらに10％のセール値引きが適用されます。<br /><br /><br />この商品には商品オプション（カラー3種類）がついていますが、<br />オプションには追加料金を設定していないのでもともとどのカラーでも同料金です。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％OFF（特価＋セール）<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・特価商品の場合：　特価商品の価格にさらにセール値引きを適用する<br />・セール対象のカテゴリ：　「セール×特価：特価商品をさらに10％OFF」カテゴリ<br /><br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール×特価：特価商品をさらに10％OFF」カテゴリ<br />・商品価格：　10000円<br />・特価価格：　50%<br />','',2),(174,2,'【SP2】商品オプション料金にもセール・特価適用する例','特価商品にセールを適用した場合のふるまいを理解するための、ごくシンプルな例です。<br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />また、セールとは別に<br />この商品には通常価格10000円のところを半額にする特価設定がされています。<br /><br /><br />特価商品に対するセールの設定を「特価商品の価格にさらにセール値引きを適用する」にしたので<br />特価価格からさらに10％のセール値引きが適用されます。<br /><br /><br />この商品には商品オプション（カラー3種類）がついています。<br />このうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />この例では、セール・特価が適用された時に、オプション料金にもセール・特価が適用されるように設定しています。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％OFF（特価＋セール）<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・特価商品の場合：　特価商品の価格にさらにセール値引きを適用する<br />・セール対象のカテゴリ：　「セール×特価：特価商品をさらに10％OFF」カテゴリ<br /><br />【設定メモ：商品情報】　※この商品に関する設定<br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール×特価：特価商品をさらに10％OFF」カテゴリ<br />・商品価格：　10000円<br />・特価価格：　50%<br /><br />【設定メモ：商品オプション属性】　※この商品に関する設定<br />・オプション名：　カラー<br />・オプション値：　レッド<br />・オプション価格：　＋2000円<br />・特価商品/セールによって割引を適用する： はい<br /><br />','',1),(175,2,'【SP3】商品オプション料金はセール・特価対象外にする例','特価商品にセールを適用した場合のふるまいを理解するための、ごくシンプルな例です。<br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />また、セールとは別に<br />この商品には通常価格10000円のところを半額にする特価設定がされています。<br /><br /><br />特価商品に対するセールの設定を「特価商品の価格にさらにセール値引きを適用する」にしたので<br />特価価格からさらに10％のセール値引きが適用されます。<br /><br /><br />この商品には商品オプション（カラー3種類）がついています。<br />このうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />一つ前の例と異なり、この例では商品への特価適用時に、オプション料金には適用されない設定にしています。つまり、商品自体が特価でもオプション料金に関しては通常通りかかります。<br /><br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％OFF（特価＋セール）<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・特価商品の場合：　特価商品の価格にさらにセール値引きを適用する<br />・セール対象のカテゴリ：　「セール×特価：特価商品をさらに10％OFF」カテゴリ<br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール×特価：特価商品をさらに10％OFF」カテゴリ<br />・商品価格：　10000円<br />・特価価格：　50%<br /><br />【設定メモ：商品オプション属性】　※この商品に関する設定<br />・オプション名：　カラー<br />・オプション値：　レッド<br />・オプション価格：　＋2000円<br />・特価商品/セールによって割引を適用する： いいえ<br />','',2),(176,2,'【SP1】特価商品にセール適用の基本例','特価商品にセールを適用した場合のふるまいを理解するための、ごくシンプルな例です。<br /><br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />また、セールとは別に<br />この商品には通常価格を半額にする特価設定がされていますが、<br />特価商品に対するセールの設定を「特価商品の価格を無視する」にしたので<br />通常価格に10％のセール値引きが適用され、特価価格は無視されます。<br /><br />この商品には商品オプション（カラー3種類）がついていますが、<br />オプションには追加料金を設定していないのでもともとどのカラーでも同料金です。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％OFF（セール優先）<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・特価商品の場合：　特価商品の価格を無視する<br />・セール対象のカテゴリ：　「セール×特価：セール優先（特価設定無視）」カテゴリ<br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール×特価：セール優先（特価設定無視）」カテゴリ<br />・商品価格：　10000円<br />・特価価格：　50%','',4),(177,2,'【SP2】商品オプション料金にもセール・特価適用する例','特価商品にセールを適用した場合のふるまいを理解するための、ごくシンプルな例です。<br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />また、セールとは別に<br />この商品には通常価格10000円のところを半額にする特価設定がされていますが、<br />特価商品に対するセールの設定を「特価商品の価格を無視する」にしたので<br />通常価格に10％のセール値引きが適用され、特価価格は無視されます。<br /><br /><br />この商品には商品オプション（カラー3種類）がついています。<br />このうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />この例では、セール・特価が適用された時に、オプション料金にもセール・特価が適用されるように設定しています。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％OFF（セール優先）<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・特価商品の場合：　特価商品の価格を無視する<br />・セール対象のカテゴリ：　「セール×特価：セール優先（特価設定無視）」カテゴリ<br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール×特価：セール優先（特価設定無視）」カテゴリ<br />・商品価格：　10000円<br />・特価価格：　50%<br /><br />【設定メモ：商品オプション属性】　※この商品に関する設定<br />・オプション名：　カラー<br />・オプション値：　レッド<br />・オプション価格：　＋2000円<br />・特価商品/セールによって割引を適用する： はい<br /><br />','',5),(178,2,'【SP3】商品オプション料金はセール・特価対象外にする例','特価商品にセールを適用した場合のふるまいを理解するための、ごくシンプルな例です。<br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />また、セールとは別に<br />この商品には通常価格10000円のところを半額にする特価設定がされていますが、<br />特価商品に対するセールの設定を「特価商品の価格を無視する」にしたので<br />通常価格に10％のセール値引きが適用され、特価価格は無視されます。<br /><br /><br />この商品には商品オプション（カラー3種類）がついています。<br />このうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />一つ前の例と異なり、この例では商品へのセール・特価適用時に、オプション料金には適用されない設定にしています。つまり、商品自体がセール価格でもオプション料金に関しては通常通りかかります。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％OFF（セール優先）<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・特価商品の場合：　特価商品の価格を無視する<br />・セール対象のカテゴリ：　「セール×特価：セール優先（特価設定無視）」カテゴリ<br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール×特価：セール優先（特価設定無視）」カテゴリ<br />・商品価格：　10000円<br />・特価価格：　50%<br /><br />【設定メモ：商品オプション属性】　※この商品に関する設定<br />・オプション名：　カラー<br />・オプション値：　レッド<br />・オプション価格：　＋2000円<br />・特価商品/セールによって割引を適用する： いいえ','',6),(179,2,'【SP1】特価商品にセール適用の基本例','特価商品にセールを適用した場合のふるまいを理解するための、ごくシンプルな例です。<br /><br />この商品には通常価格10000円のところを半額にする特価設定がされています。<br /><br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />しかし、特価商品に対するセールの設定を「セール対象外」にしたので<br />特価商品にはセール10％引きは適用されません。<br /><br />この商品には商品オプション（カラー3種類）がついていますが、<br />オプションには追加料金を設定していないのでもともとどのカラーでも同料金です。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％OFF（特価優先）<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・特価商品の場合：　セール対象外<br />・セール対象のカテゴリ：　「セール×特価：特価優先（セール対象外）」カテゴリ<br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール×特価：セール優先（セール対象外）」カテゴリ<br />・商品価格：　10000円<br />・特価価格：　50%','',2),(180,2,'【SP2】商品オプション料金にもセール・特価適用する例','特価商品にセールを適用した場合のふるまいを理解するための、ごくシンプルな例です。<br /><br />この商品には通常価格10000円のところを半額にする特価設定がされています。<br /><br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />しかし、特価商品に対するセールの設定を「セール対象外」にしたので<br />特価商品にはセール10％引きは適用されません。<br /><br /><br />この商品には商品オプション（カラー3種類）がついています。<br />このうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />この例では、セール・特価が適用された時に、オプション料金にもセール・特価が適用されるように設定しています。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％OFF（特価優先）<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・特価商品の場合：　セール対象外<br />・セール対象のカテゴリ：　「セール×特価：特価優先（セール対象外）」カテゴリ<br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール×特価：特価優先（セール対象外）」カテゴリ<br />・商品価格：　10000円<br />・特価価格：　50%<br /><br />【設定メモ：商品オプション属性】　※この商品に関する設定<br />・オプション名：　カラー<br />・オプション値：　レッド<br />・オプション価格：　＋2000円<br />・特価商品/セールによって割引を適用する： はい<br />','',2),(181,2,'【SP3】商品オプション料金はセール・特価対象外にする例','特価商品にセールを適用した場合のふるまいを理解するための、ごくシンプルな例です。<br /><br />この商品には通常価格10000円のところを半額にする特価設定がされています。<br /><br />このカテゴリに対して、10％引きのセール設定がされており、<br />このカテゴリをマスターカテゴリとする全商品に適用されます。<br /><br />しかし、特価商品に対するセールの設定を「セール対象外」にしたので<br />特価商品にはセール10％引きは適用されません。<br /><br />この商品には商品オプション（カラー3種類）がついています。<br />このうち、レッドは特別色としてオプション料金（＋2000円）が設定されています。<br />一つ前の例と異なり、この例では商品への特価適用時に、オプション料金には適用されない設定にしています。つまり、商品自体が特価でもオプション料金に関しては通常通りかかります。<br /><br />【設定メモ】　セールの管理　※カテゴリ単位で適用される<br />・セール名：　10％OFF（特価優先）<br />・値引き額：　10.0<br />・タイプ：　率（％）<br />・特価商品の場合：　セール対象外<br />・セール対象のカテゴリ：　「セール×特価：特価優先（セール対象外）」カテゴリ<br /><br />【設定メモ：商品情報】　※この商品に関する設定<br />・商品マスターカテゴリ：　「セール×特価：特価優先（セール対象外）」カテゴリ<br />・商品価格：　10000円<br />・特価価格：　50%<br /><br />【設定メモ：商品オプション属性】　※この商品に関する設定<br />・オプション名：　カラー<br />・オプション値：　レッド<br />・オプション価格：　＋2000円<br />・特価商品/セールによって割引を適用する： いいえ<br />','',2),(182,1,'Normal Product(6)','','',0),(182,2,'【例6】1色あたり○点以上なら割引','サイズやカラーなどのオプション属性を持つ商品に、数量割引（いわゆるボリュームディスカウント）を適用したやや複雑な設定例です。<br />\r\n9個までは定価、10〜20個で定価の10％引き、20〜49個で20％引き、50個以上で25％引きというように、割引率による数量割引を設定しました。<br /><br />\r\nこの例では、1つのオプションに対して規定量以上購入した場合に割り引きが適用されます。<br />\r\nつまり、ホワイトとブラックを5コずつ購入しても割り引き対象にはならず、ホワイトあるいはブラック単体で10個以上購入してはじめて割引になります。<br />\r\nこれは、商品価格の管理において、「数量は同一商品であればオプション値に関係なく合算する＝いいえ」に設定しているからです。<br /><br />\r\n\r\n\r\nNOTE：　この設定は「商品価格の管理」から行います。<br />※商品の管理＞商品価格の管理　から呼び出すか、あるいは管理画面の商品リストの右端にある[＄]ボタン（緑色のボタン）から呼び出すことができます。<br /><br />\r\n\r\n【設定メモ：商品価格の管理】<br />\r\n以下の設定により、計算式は、購入代金＝｛定価×（1−数量割引率）｝　×　購入数となります。<br />\r\n・ディスカウントタイプ：　割引率<br />\r\n・この価格からディスカウント：　価格<br />\r\n・割引設定<br /><br />\r\n　　・数量は同一商品であればオプション値に関係なく合算する：　いいえ<br />\r\n　------------------------------------------<br />\r\n　割引レベル　　　　最小限の有効数量　　　割引の値<br />\r\n　------------------------------------------<br />\r\n　割引3　　　　　　　　10　（個）　　　　　　　　　10.0　（％）<br />\r\n　割引4　　　　　　　　20　（個）　　　　　　　　　20.0　（％）<br />\r\n　割引5　　　　　　　　50　（個）　　　　　　　　　25.0　（％）<br />\r\n　-----------------------------------------<br /><br />\r\n\r\n【設定メモ：オプション属性】<br />\r\n1）カラー「ホワイト」<br />\r\n　　・価格： ＋0円<br />\r\n　　・特価/セール割引を適用した価格をベース価格として扱う：　はい<br />\r\n2）カラー「ブラック」<br />\r\n　　・価格：　＋1000円<br />\r\n　　・特価/セール割引を適用した価格をベース価格として扱う：　はい<br />\r\n　　・属性による価格増減をベース価格に含める：　はい','',7),(183,1,'MIN','','',0),(183,2,'【1】10個以上でご注文ください','これは、「最低10個より販売いたします」など、最小購入数を制限したい場合の設定例です。<br /><br />\r\n\r\n【設定メモ：商品情報】<br />\r\n・最小購入数：　10<br />','',14),(184,1,'MIN_ATR1','','',0),(184,2,'【OP1】オプション問わず合計10個以上で販売','これは、商品オプションありの場合の最小購入数設定例です。<br />\r\nこの例では、オプションをいろいろ取り混ぜてよく、この商品の合計が最小購入数以上であれば（個々のオプション選択がなんであれ）購入可能です。<br />\r\nつまり、ホワイト5コカゴに入れ、続いてブルーを5コカゴに入れた時点で合計10コと見なされて購入可能となります。<br /><br />\r\n\r\n【設定メモ：商品情報】<br />\r\n・最小購入数：　10<br /><br />\r\n\r\n【設定メモ：商品価格の管理】<br />\r\n・最低量とユニット量を組み合わせて適応する：　はい','',7),(185,1,'MIN_ATR2','','',0),(185,2,'【OP2】1オプションあたり10個以上で販売','これは、商品オプションありの場合の最小購入数設定例です。<br />\r\nこの例では、1つのオプションあたりの購入数でカウントし、同じオプションで最小購入数に達しないと決済に進めません。<br />\r\nつまり、ホワイトとブルーを5コずつカゴに入れてもダメで、ホワイトあるいはブルー単体で10個以上ではじめて購入可能となります。<br /><br />\r\n\r\n【設定メモ：商品情報】<br />\r\n・最小購入数：　10<br /><br />\r\n\r\n【設定メモ：商品価格の管理】<br />\r\n・最低量とユニット量を組み合わせて適応する：　いいえ','',4),(187,1,'LIMIT-1','','',0),(187,2,'【1】お一人さま5点まで！','これは、「お一人さま5点まで！」など、注文1回あたりの購入数を制限したい場合の設定例です。<br /><br />\r\n\r\n【設定メモ】<br />\r\n・商品の最小数量：　1<br />\r\n・商品の最大数量：　5<br />\r\n・商品の数量単位：　1<br /><br />','',8),(188,1,'LIMIT_ATR1','','',0),(188,2,'【OP1】カラーを問わず全部で5点まで！','これは、商品オプションありの場合の最大購入数設定例です。<br />\r\nこの例では、オプションにかかわらず、この商品は全部で5点までしか購入できません。<br />\r\nつまり、ホワイトとイエローで計5コカゴに入っていたら、いったん精算しないかぎり追加はできません。<br /><br />\r\n\r\n【設定メモ：商品情報】<br />\r\n・最小購入数：　1<br />\r\n・最大購入数：　5<br />\r\n\r\n【設定メモ：商品価格の管理】<br />\r\n・最低量とユニット量を組み合わせて適応する：　はい','',17),(201,2,'【1】100個単位でご注文ください','これは、「100個単位でご注文ください」のように、ユニット単位の販売を行いたい場合の設定例です。<br /><br />\r\n\r\n【設定メモ：商品情報】<br />\r\n・[最小購入数]：　100　※<br />\r\n・[数量単位]： 100<br /><br />\r\n\r\n※この例において[最小購入数]設定は必須ではないが、どのみち100個ずつ売りたいので一応設定しておく','',0),(189,1,'LIMIT_ATR2','','',0),(189,2,'【OP2】1オプションあたり5点まで！','これは、商品オプションありの場合の最大購入数設定例です。<br /><br />\r\nこの例では、各オプションは独立で扱われ、それぞれについて5点まで購入することができます。<br />\r\nつまり、ホワイト5コをカゴに入れたら、ホワイトはもう追加できませんが、他の色（ブルーやイエロー）なら購入可能です。<br /><br />\r\n\r\n【設定メモ：商品情報】<br />\r\n・最小購入数：　1<br />\r\n・最大購入数：　5<br />\r\n【設定メモ：商品価格の管理】<br />\r\n・最低量とユニット量を組み合わせて適応する：　いいえ','',12),(202,1,'UNIT2','','',0),(190,1,'TAXOUT','','',0),(190,2,'商品価格を税抜き（外税）で管理する例','商品価格を外税（税抜き価格）で管理する例です。<br /><br />\r\n\r\n表示価格には、管理サイト側で入力した商品価格に消費税分を上乗せしたものが表示されます。オプション料金にも同じように適用します。<br /><br />\r\nなお消費税分は、あらかじめショップ全体の設定値として設定したものが使われます（デフォルトで5％になっています）。<br /><br />\r\n\r\n・メリット：\r\n　消費税分が自動で上乗せされるので、運営側では税抜き価格で管理できる。また、消費税率が変わった時に、ショップ全体の税率設定値を変更するだけで済む。<br /><br />\r\n・デメリット： 4,980円など商売上ウケの良い価格表示にしたい場合、制御しづらい<br /><br /><br />\r\n\r\n【設定メモ】商品情報：<br />\r\n・[税種別]：　消費税<br />\r\n・[商品価格（ネット）]：10000円　（消費税分を含めない）<br /><br />\r\n\r\n\r\n【設定メモ】商品オプション属性<br />\r\n・[オプション価格] レッド（＋0/追加料金なし）、ホワイト（＋1000円）、イエロー（＋2000円）<br /><br />\r\n\r\n【ショップ全体の設定】　地域・税率設定＞税率設定　<br />\r\n・[消費税の税率]：　5％<br />','',10),(191,1,'TAXIN-2','','',1),(191,2,'商品価格を税込み（内税）で管理する例(2)','こちらは、商品価格を内税（税込み価格）で管理する例です。<br />\r\n内税の場合、2つのやり方があります（前の例と比べてみてください）。<br />\r\nこのケースでは税種別を「消費税」にしています。商品価格（グロス）の方に内税価格を入力します。<br /><br />\r\n\r\n\r\n[税種別]を消費税に指定し、商品価格（グロス）に内税価格を入力すると、商品価格（ネット）には自動計算された税抜き価格が入ります。ショップ側に表示されるのは商品価格（グロス）の方なのでつまり内税価格が表示されるというわけです。オプション価格は設定値に消費税分が上乗せされて表示されるので注意してください。<br /><br />\r\n\r\n\r\n【設定メモ】内税で管理する：<br />\r\n・[税種別]：　-- 消費税 --<br />\r\n・[商品価格（グロス）]：10000円 （税込み価格を入力する）<br /><br />\r\n\r\n【設定メモ】商品オプション属性<br />\r\n・[オプション価格] レッド（＋0/追加料金なし）、ホワイト（＋1000円）、イエロー（＋2000円）','',8),(192,1,'ATTR_IMAGE1','','',0),(192,2,'【OP1】画像付きオプションの例','画像付き商品オプションの例です。ここでは、2色あるカラー（商品オプション属性）のそれぞれに、画像を添えて表示しています。<br /><br />\r\nこれは、商品オプション属性の見本画像に、画像ファイルを指定することで実現できます。<br />\r\n\r\n【設定メモ】商品オプション属性<br />\r\n※各[オプション値]に対して<br />\r\n　・[属性の見本画像]： 画像ファイル（ここからアップロード可）<br />\r\n　・[属性の見本画像ディレクトリ]： \"attributes\" <br /><br />\r\n\r\n【参考】オプション名<br />\r\n・[オプション名]：　カラー<br />\r\n・[オプションのタイプ]：　RADIO<br />\r\n※ただし見本画像表示はタイプに依らず可能<br /><br />\r\n\r\nNOTE：<br />\r\nなお、要素（ラジオボタン）、オプション名、見本画像の配置関係は、管理メニューの商品の管理＞オプション名の管理から目的のオプション名の[編集]にて<br />\r\n・列(Row)あたりの属性画像<br />\r\n・ラジオボタン・チェックボックスの属性スタイル<br />\r\nの設定で変えることができます。','',19),(193,1,'ATTR_IMAGE2','','',0),(193,2,'【OP2】画像付きオプションの例','画像付き商品オプションの例その2です。<br />\r\nこれは、商品オプション属性の見本画像に、画像ファイルを指定することで実現できます。<br /><br />\r\n\r\nこの例は、「素材とお手入れ方法」（READ ONLYタイプの商品オプションを使用）に関して、洗濯表示とアイロンの温度の2オプションを画像付きにしています。<br />\r\n\r\n【設定メモ】商品オプション属性<br />\r\n※[オプション値]＝\"洗濯機〜\"、および  ”アイロンは〜” に対してそれぞれ下記の見本画像を指定する。<br />\r\n・[属性の見本画像]： ※あらかじめ用意した見本画像のファイル（ここからアップロードできる）<br />\r\n・[属性の見本画像ディレクトリ]： \"attributes\" <br /><br />','',12),(194,1,'IMAGE1','','',0),(194,2,'【1】複数の商品画像を掲載（自動掲載）','メインの画像の他に関連画像を何点か掲載したい場合がありますよね。<br />\r\nそんな時に最も簡単なのがこの方法で、一定のルールで画像ファイルを命名してFTPしておけば自動掲載されます。<br />\r\n→この説明文の一番下に画像が3点掲載されています！<br /><br />\r\n\r\n【ルール】<br />\r\n・2点目以降の画像ファイル名＝[メイン画像ファイル名]＋[枝番(_xx）]＋[.同じ拡張子] でつける<br />\r\n・メイン画像と同じディレクトリにアップロードする<br />\r\n・2点目以降の画像掲載順は、枝番の小さい順になる<br /><br />\r\n\r\n【例】商品情報の管理で<br />\r\n・[商品画像]が[IMAGE1.jpg] <br />\r\n・[アップロード先ディレクトリ]：　”samples”を選択<br />\r\nとした場合は、<br /><br />\r\n\r\n2点目以降の画像<br />\r\n　IMAGE1_01.jpg<br />\r\n　IMAGE1_02.jpg<br />\r\n　IMAGE1_03.jpg<br />\r\n　・・・<br />\r\nを、（ショップ設置ディレクトリ）/images/samples/　配下にFTPすればよい。<br /><br />\r\n\r\nNOTE：<br />\r\n枝番付きの画像が自動掲載されるということは、逆に言えば、ある商品Aの画像ファイル名が、たまたま別の商品Bの画像名_xxになっていたら、商品Bのページに自動掲載されてしまうということを意味します。<br /><br />\r\nこれを避けるためにも、メイン画像についても命名ルールをよく考えて決めましょう。おすすめは、商品型番と同じにしておくことです（通常商品型番は、商品ごとに固有でしょうから）。どの商品の画像かもわかりやすく一石二鳥です。','',18),(195,1,'IMAGE2','','',0),(195,2,'【2】複数の商品画像を掲載(紹介文中にHTML直書き）','[商品説明]欄に＜img＞タグを直書きする方法もアリです。<br /><br />\r\n\r\nこの方法は、\r\n<ul>\r\n<li>紹介文の途中に画像を埋め込め、キャプションを添えることもできるなどレイアウトの自由度が高い</li>\r\n<li>画像名がバラバラだったり、拡張子が異なる画像でも扱える</li>\r\n<li><a href=\"http://www.flickr.com/\">Flickr</a>にアップした画像や、<a href=\"http://www.youtube.com\">YouTube</a>上の動画を掲載することもできる</li>\r\n</ul>\r\nなどのメリットがあります。<br />ただし、HTMLを知らない人にとっては厳しいかもしれません。<br /><br />\r\n\r\n＜img src=\"画像のURL\" alt=\"画像の説明\" /＞を書けばその画像が表示されます。<br /><br />\r\n【例】<br />\r\n<img src=\"http://okra.ark-web.jp/~shinchi/zenc/images/samples/IMAGE2_related.jpg\" alt=\"このTシャツのモデル猫『こまる』です\" /><br />\r\nこのTシャツでも使われている、当ショップ自慢のモデル猫『こまる』です。後ろ姿もかわいいでしょ（*^o^*）b','',17),(196,1,'DISCNTQTY_ATTR1','','',0),(196,2,'【1】カラーで割引条件が異なる数量割引例','オプションごとにボリュームディスカウントの割引条件が異なる設定例です。<br />\r\n数量のしきい値、割引額をオプションごとに独立して設定できます。<br /><br />\r\n\r\nこの例では、ホワイトの購入個数が9点以下なら値引なしで、10点なら＠100円引き、11点以上なら＠200円引きです。<br />\r\n対するオレンジの方は、19点までは割引なしで、20点以上なら＠150円引きになります。<br /><br /><br />\r\n\r\n<strong>オプションの数量値引設定の書式</strong><br />\r\n[しきい値 N:値引き額 D] をワンセットとして、必要セット分だけ「,（半角カンマ）」で繋ぎます。<br /><br />\r\n\r\n書式　　N0:D0, N1:D1, N2:D2・・, N(n-1):D(n-1), Nn:Dn<br /><br />\r\n意味　1〜N0個まで： D0円引き<br />\r\n　　　N1〜N2個まで： D1円引き<br />\r\n　　　：<br />\r\n　　　：<br />\r\n　　　N(n-1)〜Nn個まで： D(n-1)円引き<br />\r\n　　　N(n-1)+1個以上： Dn円引き<br /><br />\r\n\r\n※n=1,2,・・・,Nの自然数。最後のセットのNnの指定値に意味はなく、Dnは常にN(n-1)+1個以上の時の値引額として扱われる。<br /><br />\r\n\r\n【実例1】\"ホワイト\"<br />\r\n[オプションの数値値引設定]　9:-0,10:-100,11:-200<br />\r\n意味：　〜9点までは値引き0、10点は＠100円引き、11点以上で＠200円引き<br /><br />\r\n\r\n【実例1】\"オレンジ\"<br />\r\n[オプションの数値値引設定]　19:-0,20:-150<br />\r\n意味：　〜19点までは値引き0、20点以上買うと＠150円引き<br /><br />\r\n\r\nNOTE：<br />\r\nDの値は頭に「-」をつけて-100なら100円引きに、「+」をつけて+100となら100円増しになる。','',35),(197,1,'DISCNTQTY_ATTR2','','',0),(197,2,'【2】カラーで通常価格も数量割引条件も異なる例','オプションごとにボリュームディスカウントの割引条件が異なる設定例です。<br />\r\n直前の【1】の例と異なるのは、【1】では商品価格側に基本価格分を持たせ、オプション属性では数量割引分だけを担当させていたのに対し、この例では、商品価格を0として、オプション料金側で価格をセットしている点です。<br />\r\n違いがわかるよう、ホワイトの定価（数量割引適用前オプション料金）を4000円、オレンジを5000円にしてあります。<br />\r\n\r\n数量割引額は、【1】と同じ設定になっていて、<br />\r\nホワイトの購入個数が9点以下なら値引なしで、10点なら＠100円引き、11点以上なら＠200円引きです。<br />\r\n対するオレンジの方は、19点までは割引なしで、20点以上なら＠150円引きになります。<br /><br />\r\n\r\n各オプション属性の[オプションの数量値引設定]の書式については【1】で説明していますのでご覧ください。<br /><br />\r\n\r\n\r\n【設定メモ】商品情報<br />\r\n・[商品属性による価格]：はい<br />\r\n・[商品価格 (ネット)]：0円<br /><br />\r\n\r\n【オプション設定メモ】\"ホワイト\"<br />\r\n・[オプションの価格]：4000円<br />\r\n・[属性による価格増減をベース価格に含める]：はい<br />\r\n・[オプションの数値値引設定]　9:-0,10:-100,11:-200<br />\r\n　意味：　〜9点までは値引き0、10点は＠100円引き、11点以上で＠200円引き<br /><br />\r\n\r\n【オプション設定メモ】\"オレンジ\"<br />\r\n・[オプションの価格]：5000円<br />\r\n・[属性による価格増減をベース価格に含める]：はい<br />\r\n・[オプションの数値値引設定]　19:-0,20:-150<br />\r\n　意味：　〜19点までは値引き0、20点以上買うと＠150円引き<br /><br /><br />\r\n\r\n<strong>NOTE1：　[商品属性による価格]：はい　の意味</strong><br /><br />\r\n商品名の下に表示される値段 ＝ [商品価格] ＋ [オプション価格（の最安値)] になります。<br />\r\nここが「いいえ」だと、[商品価格]だけが表示されます（商品価格＝0円の時は表示自体省略）。<br />\r\n今回の例だと、オプション価格の最安値はホワイトの4000円なので、商品名の下に表示される値段 ＝0円＋4000円の結果として4000円と表示されているわけです。<br /><br /><br />\r\n\r\n<strong>NOTE2：[属性による価格増減をベース価格に含める]：はい　の意味</strong><br /><br />\r\nこれが\"いいえ\"のオプションは、たとえそのオプション料金がオプション間で最安値だったとしても<br />\r\nNOTE1で説明した、<br />\r\n　商品名の下に表示される値段 ＝ [商品価格] ＋ [オプション価格（の最安値)] 　<br />\r\nの値としては使われません。','',13),(198,1,'DSCNT_ONE1','','',0),(198,2,'【OT1】ワンタイム割引例：1注文につき500円引き！','オプション属性の[ワンタイム割引]機能を使って、同一商品同一カラーを規定量以上なら「1注文あたり500円引き」を実現する例です。この割引はオプションごとの設定なので、カラーごとに割引額を変えることも可能です。<br /><br />\r\n\r\n【設定メモ】商品情報<br />\r\n・[商品属性による価格]：はい<br />\r\n・[商品価格 (ネット)]：0円<br /><br />\r\n\r\n【オプション設定メモ】\"ホワイト\"<br />\r\n・[オプションの価格]：4000円<br />\r\n・[属性による価格増減をベース価格に含める]：はい<br />\r\n・[ワンタイム値引の値引金額]　-500（円）　※頭に\"-\"をつけること<br /><br />\r\n\r\n【オプション設定メモ】\"オレンジ\"<br />\r\n・[オプションの価格]：5000円<br />\r\n・[属性による価格増減をベース価格に含める]：はい<br />\r\n・[ワンタイム値引の値引金額]　-500（円）　※頭に\"-\"をつけること<br /><br /><br />\r\n\r\n<strong>NOTE1：　[商品属性による価格]：はい　の意味</strong><br /><br />\r\n商品名の下に表示される値段 ＝ [商品価格] ＋ [オプション価格（の最安値)] になります。<br />\r\nここが「いいえ」だと、[商品価格]だけが表示されます（商品価格＝0円の時は表示自体省略）。<br />\r\n今回の例だと、オプション価格の最安値はホワイトの4000円なので、商品名の下に表示される値段 ＝0円＋4000円の結果として4000円と表示されているわけです。<br /><br /><br />\r\n\r\n<strong>NOTE2：[属性による価格増減をベース価格に含める]：はい　の意味</strong><br /><br />\r\nこれが\"いいえ\"のオプションは、たとえそのオプション料金がオプション間で最安値だったとしても<br />\r\nNOTE1で説明した、<br />\r\n　商品名の下に表示される値段 ＝ [商品価格] ＋ [オプション価格（の最安値)] 　<br />\r\nの値としては使われません。<br /><br /><br />','',7),(199,1,'DSCNT_ONE2','','',0),(199,2,'【OT2】ワンタイム割\"増\"例：1注文につき初期費用を加算','ワンタイム割引機能は、使い方次第では初期費用的な使い方もできます。<br />\r\nここで初期費用と言っているのは、「注文個数にかかわらず1回の注文あたり1度だけかかる料金」という意味です。<br /><br />\r\n\r\nかなり応用問題ですが、ワンタイム割引機能＋オプション属性の数量割引を使ったTシャツのオリジナルプリントの例をおみせしましょう。<br /><br />\r\n\r\nこの例は、無地Tシャツにロゴや社名などのオリジナルプリントを加工する、いわゆる\"チームTシャツ\"商品です。料金は以下のように決まります、\r\n<ul>\r\n<li>プリント原版代（版下代）がかかります。インクの色数だけで決まり注文数によりません。</li>\r\n<li>そのほかにTシャツ1枚あたりのプリント代（加工代）がかかります。これもインクの色数で単価が違い、さらに注文数がおおければ単価がさがります。</li>\r\n<li>もちろん、Tシャツ本体の値段が別途かかります</li>\r\n</ul>\r\n\r\n【設定メモ】商品情報<br />\r\n・[商品価格]：　4000円　※Tシャツ本体の価格。<br /><br />\r\n\r\n【設定メモ】オプション属性<br />\r\n[オプション値]／[オプション価格]／[ワンタイム値引の値引金額]／[オプションの数量値引設定]　の順に<br />\r\n・プリント1色　／+ 600 ／ +10000 ／49:-0,50:-200,100:-300<br />\r\n・プリント2色　／+ 700 ／ +20000 ／49:-0,50:-200,100:-300<br />\r\n・プリント3色　／+ 800 ／ +30000 ／49:-0,50:-200,100:-300<br /><br />\r\n\r\nNOTE：<br />\r\n・[商品価格]＝無地Tシャツ代<br />\r\n・[オプション価格]＝加工代<br />\r\n・[ワンタイム値引の値引金額]＝プリント原版代<br />\r\nにあたります。<br /><br />\r\n\r\nワンタイム割引は頭に\"+\"がつけば割増（今回の例）に、\"-\"がつけば割引（【1】の例）として機能します。','',10),(201,1,'UNIT1','','',0),(200,1,'LIMIT-2','','',0),(200,2,'【2】お一人さま1点限り！（数量入力欄非表示）','注文1回あたりの購入数を最大1個に設定すると、数量入力欄は非表示になり、1点ずつしかカートに追加できなくなります。<br /><br />\r\n\r\n【設定メモ】<br />\r\n・商品の最小数量：　1<br />\r\n・商品の最大数量：　1<br />\r\n・商品の数量単位：　1<br /><br />','',1),(202,2,'【2】2000個以上＆100個単位でご注文ください','これは、100個単位で、かつ最低でも2000個以上からの注文だけ受けたいなどのケースを想定した例です。卸販売や大量購入を対象とした販売などで役に立つと思います。<br /><br />\r\n\r\n【設定メモ：商品情報】<br />\r\n・[最小購入数]：　2000<br />\r\n・[数量単位]： 100<br /><br />\r\n\r\nNOTE：<br />\r\nさらに[最大購入数]を設定しておくと、注文の上限を制限できる。<br />','',0),(203,1,'UNIT_ATR1','','',0),(203,2,'【OP1】100個単位でご注文ください（オプション混在OK）','これは、商品オプションありの場合の[商品の数量単位]設定例です。<br />\r\nこの例では、オプションの組み合わせがどうあれ、最終的にこの商品合計点数が単位数量の倍数であれば購入可能です。<br />\r\nつまり、ホワイト50コカゴに入れ、続いてブルーを50コカゴに入れた時点で合計100コと見なされて購入可能となります。<br /><br />\r\n\r\n【設定メモ：商品情報】<br />\r\n・[商品の数量単位]：　100<br /><br />\r\n\r\n【設定メモ：商品価格の管理】<br />\r\n・最低量とユニット量を組み合わせて適応する：　はい','',1),(204,1,'UNIT_ATR2','','',0),(204,2,'【OP2】1オプションあたり100個単位でご注文ください','これは、商品オプションありの場合の[商品の数量単位]設定例です。<br />\r\nこの例では、1つのオプションあたりの購入数でカウントし、同じオプションで単位数量の倍数でないとと決済に進めません。<br />\r\nつまり、ホワイトとブルーを50コずつカゴに入れてもダメで、ホワイトあるいはブルー単体で100個とか200個ではじめて購入可能となります。<br /><br />\r\n\r\n【設定メモ：商品情報】<br />\r\n・[商品の数量単位]：　100<br /><br />\r\n\r\n【設定メモ：商品価格の管理】<br />\r\n・最低量とユニット量を組み合わせて適応する：　いいえ','',1),(205,1,'PRCFACTOR','','',0),(205,2,'【1】プライスファクター：ティーカップ（保証サービスあり）','プライスファクターの例です。<br />\r\nティーカップを販売します。このティーカップには、商品価格の何％かを追加で払うと購入後の一定期間、割れ・欠け時に無償交換してくれる「保証サービス」が用意されています。ここでは、この保証サービスを、プライスファクターを使って設定します。<br /><br />\r\n\r\n【設定メモ】商品情報<br />\r\n・[商品価格]：20000 円<br />\r\n・[商品属性による価格]： はい　※1<br /><br />\r\n\r\n【設定メモ】「5年保証」オプション<br />\r\n・[オプション価格]： 0円<br />\r\n・[プライスファクター]： 0.05 　※ベース価格の5％<br />\r\n・[属性による価格増減をベース価格に含める]： はい　※2<br /><br />\r\n\r\n【設定メモ】「20年保証」オプション<br />\r\n・[プライスファクター]： 0.15 　※ベース価格の15％<br />\r\n・他の設定は「5年保証」オプションと同じ。<br /><br /><br />\r\n\r\n<strong>NOTE： プライスファクターについて</strong><br />\r\nプライスファクターやオフセットは、オプション選択時の追加料金に次のように作用します。<br /><br />\r\n\r\n　<strong>オプション選択時の追加料金<br />\r\n　＝ [オプション価格] ＋  <br />\r\n　　 [ベース価格] ×（[プライスファクター]−[オフセット]）</strong><br /><br />\r\n\r\n　ただし、上記※1,2のフラグが両方とも\"はい\"なら<br />\r\n　[ベース価格] ＝ [商品価格]＋[オプション価格]<br /><br />\r\n\r\n　どちらか（あるいは両方）が\"いいえ\"なら<br /><br />\r\n　[ベース価格] ＝ [商品価格]\r\n\r\n\r\n※この例では1と2のフラグは、両方\"はい\"にしましたが、もともとオプション価格を0円としているので\r\n実際は\"はい\"でも\"いいえ\"でも同じ結果になります。<br />','',69),(206,1,'PRCFACTOR_OFFSET1','','',0),(206,2,'【2】プライスファクターとオフセット：パッケージ販売','前の例ではプライスファクターに1以下の値（価格の5％等）を使いましたが、今度はパッケージ販売を例にとって大きな整数値を使う例をお見せしましょう。この例ではオフセットも併せて利用します。<br /><br />\r\n\r\n業者向けにTシャツをパッケージ販売する想定です。商品名の下には内包物（Tシャツ）1枚の価格が表示されますが、実際の注文は1パック100枚入りをパッケージ数で注文してもらいます。1パックの料金はTシャツ100枚分です。<br /><br />\r\n\r\nここでは、この1パックあたりの値段をオプション料金（＝Tシャツ単価）、プライスファクター（セット枚数）とオフセット（無料サービス分）を使って設定します。<br /><br />\r\n\r\n【設定メモ】商品情報<br />\r\n・[商品価格]：0 円<br />\r\n・[商品属性による価格]： はい　※1<br /><br />\r\n\r\n【設定メモ】「業務用パック（100枚入り）」オプション<br />\r\n・[オプション価格]： 4000円<br />\r\n・[プライスファクター]： 100 <br />\r\n・[オフセット]： 1<br />\r\n・[属性による価格増減をベース価格に含める]： はい　※2<br /><br />\r\n\r\n<strong>NOTE： プライスファクターについて</strong><br />\r\nプライスファクターやオフセットは、オプション選択時の追加料金に次のように作用します。<br /><br />\r\n\r\n　<strong>オプション選択時の購入単価（商品1点あたり）<br />\r\n　＝ [商品価格] ＋ [オプション価格]  <br />\r\n　　＋ [ベース価格] ×（[プライスファクター]−[オフセット]）</strong><br /><br />\r\n\r\n　ただし、上記※1,2のフラグの状態で[ベース価格]が変わり、\r\n<ul>\r\n<li>2フラグともに \"はい\" なら・・<br />\r\n[ベース価格] ＝ [商品価格]＋[オプション価格]</li>\r\n<li>いずれか、あるいは両方 \"いいえ\" なら・・<br />\r\n[ベース価格] ＝ [商品価格]</li>\r\n</ul>\r\n\r\n\r\n<strong>※オフセット値について</strong><br />\r\nこの設定例をみて、「なんでオフセットを1にするんだろう？」と思いませんでしたか？前述の「オプション選択時の追加料金」の式を注意して見て欲しいのですが、プライスファクターで100倍している他に、式の1行目でもう1点分の価格（＝[商品価格] ＋ [オプション価格]）  が加算されていますよね。このままでは101点分の料金になってしまい具合が悪いので、オフセット側で余分な1点分をキャンセルしているのです。<br />\r\n応用例として、上記例で100枚のうち5枚分の料金は無料サービスにするなら、[オフセット]＝\"6\" （キャンセル1＋無料サービス5）となります。<br /><br />\r\n\r\n<strong>NOTE： 在庫の増減について</strong><br />\r\n在庫の増減について注意して欲しいのは、この例ですと1パッケージ購入したら、在庫の減り方としては1（パッケージ）分であって、100枚分（内包物の個数）ではないということです。<br />\r\nもし在庫数を内包物ベースで管理したいのであれば、プライスファクターではなく、[商品の数量単位]を100にする方法（こうすると100単位でしか注文できない）がベターかもしれません。','',41),(207,1,'PRCFACTOR_OFFSET_ONCE','','',0),(207,2,'【3】ワンタイムプライスファクターとオフセット','前の例ではプライスファクターとオフセットを使ったパッケージ販売の例をお見せしました。今度は名前は似ていますが、1注文あたりにかかる料金としてワンタイムプライスファクターとオフセットについて説明します。<br /><br />\r\n\r\n通常のプライスファクター／オフセットと、ワンタイム〜の違いは、<br />\r\n　・追加分が商品単価に加算されるか（プライスファクター。N個買えばN倍かかる）、<br />\r\n　・注文1回あたりだけに加算されるか（ワンタイム〜。何個買っても追加分は1注文あたり一定額）<br />\r\nという点です。<br /><br />\r\n\r\nここでもTシャツを販売します。「ギフト包装」オプションがあって、これは個別包装ではなく（何枚買っても）1個口でラッピングするものとします。つまり1注文あたり1ラッピングということで、このオプションの追加費用として商品1個の値段の20％いただくことにしました。これをワンタイムプライスファクターで実現します。<br /><br /><br />\r\n\r\n\r\n【設定メモ】商品情報<br />\r\n・[商品価格]：4000 円<br />\r\n・[商品属性による価格]： はい　※1<br /><br />\r\n\r\n【設定メモ】ギフトオプション<br />\r\n・[オプション価格]： 0円<br />\r\n・[ワンタイムプライスファクター]： 0.3 <br />\r\n・[ワンタイムオフセット]： 0.1<br />\r\n・[属性による価格増減をベース価格に含める]： はい　※2<br /><br />\r\n\r\n<strong>NOTE： ワンタイムプライスファクターおよびワンタイムオフセットについて</strong><br />\r\nワンタイムプライスファクター／オフセットは、オプション選択時の追加料金に次のように作用します。<br /><br />\r\n\r\n　<strong>オプション選択時の購入単価（商品1点あたり）<br />\r\n　＝ [商品価格] ＋ [オプション価格]</strong><br /><br />\r\n\r\n　この他に、1注文あたりかかる料金があって・・・<br />\r\n　<strong>オプション選択時の追加料金（1注文あたり）<br />\r\n　　 [ベース価格] ×（[ワンタイムプライスファクター]−[ワンタイムオフセット]）</strong><br /><br />\r\n\r\n　ただし、上記※1,2のフラグの状態で[ベース価格]が変わり、\r\n<ul>\r\n<li>2フラグともに \"はい\" なら・・<br />\r\n[ベース価格] ＝ [商品価格]＋[オプション価格]</li>\r\n<li>いずれか、あるいは両方 \"いいえ\" なら・・<br />\r\n[ベース価格] ＝ [商品価格]</li>','',18),(209,1,'BASEPRICE1','','',0),(209,2,'【1】ベース価格＝商品価格＋オプション価格','ベース価格、商品価格、オプション価格の関係を理解する（1）<br /><br />\r\n\r\nベース価格は、オプションごとの数量割引や、プライスファクターを適用する際の基準額として使われます。<br /><br />\r\n\r\nベース価格は、\r\n<ul>\r\n <li>[商品属性による価格]フラグ　※商品情報の設定（1商品全体に影響する）</li>\r\n <li>[属性による価格増減をベース価格に含める]フラグ　※オプション属性ごとの設定（そのオプションだけに影響する）</li>\r\n</ul>\r\nの2フラグの状態が影響します。関係を表にすると・・・<br /><br />\r\n\r\n<table border=\"1\">\r\n  <tr>\r\n    <th width=\"20%\">[商品属性による価格]</th>\r\n   <td colspan=\"2\" width=\"60%\"><b>\"はい\"</b></td>\r\n   <td width=\"20%\"><b>\"いいえ\"</b></td>\r\n  </tr>\r\n  <tr>\r\n   <th>[属性による価格増減をベース価格に含める]</th>\r\n   <td width=\"40%\"><b>\"はい\"</b></td>\r\n   <td width=\"20%\">\"いいえ\"</td>\r\n   <td>−</td>\r\n  </tr>\r\n  <tr>\r\n   <th>[ベース価格]</th>\r\n   <td style=\"background:#E6E68A;\">＝[商品価格]＋[オプション価格]</td>\r\n   <td colspan=\"2\" style=\"background:#E6E68A;\">＝[商品価格]</td>\r\n  </tr>\r\n  <tr>\r\n   <th>表示価格の対象？</th>\r\n   <td style=\"background:#E6E68A;\">YES（ベース価格中最小値なら表示される）</td>\r\n   <td colspan=\"2\" style=\"background:#E6E68A;\">表示対象外</td>\r\n  </tr>\r\n</table>\r\n<br />\r\nここでは、どちらのフラグも\"はい\"の例を提示します。<br /><br />\r\n\r\n【設定メモ】商品情報<br />\r\n・[商品価格]：4000円<br />\r\n・[商品属性による価格]：はい<br /><br />\r\n\r\n【設定メモ】\"ホワイト\"<br />\r\n・[属性による価格増減をベース価格に含める]：はい<br />\r\n・[オプション価格]：500円<br /><br />\r\n\r\n【設定メモ】\"オレンジ\"<br />\r\n・[属性による価格増減をベース価格に含める]：はい<br />\r\n・[オプション価格]：1000円<br /><br />\r\n\r\nNOTE:<br />\r\n表示価格（商品名の下に表示されている価格）には、ベース価格の最小値が表示されます。ホワイトのベース価格の方がオレンジより小さいので、ホワイトの値が表示されているわけです。','',11),(208,1,'DISCNTQTY_ATTR_ONCE','','',0),(208,2,'【3】カラーで割引条件が異なるワンタイム数量割引例','[オプションのワンタイム数量値引設定]を使う例です。<br />\r\n前の2例で扱った[オプションの数量値引設定]が単価に作用する値引きだったのに対して、ここで扱う[オプションのワンタイム数量値引設定]は、1回の注文あたりにかかる値引きである点が異なります。<br /><br />\r\n\r\nつまり、<br />\r\n商品価格が1000円、10個以上買ったら100円引きしたいときに<br />\r\n\r\n[オプションの数量値引設定] で設定した場合：<br />\r\n　　購入価格[10個分]＝（1000円 − 100円）×10個 ＝9000円<br />\r\n　　※単価が900円になる。<br /><br />\r\n　\r\nですが、同じことを<br />\r\n[オプションのワンタイム数量値引設定]で設定した場合：<br />\r\n　　購入価格[10個分]＝ （1000円 × 10個）−100円 ＝ 9900円<br />\r\n　　※単価は変化せず、合計から100円引かれる<br /><br />\r\n\r\nという結果になります。<br />\r\nなお、数量のしきい値、割引額をオプションごとに独立して設定できる点などは同じです。<br /><br /><br />\r\n\r\n<strong>オプションのワンタイム数量値引設定の書式</strong><br />\r\n[しきい値 N:値引き額 D] をワンセットとして、必要セット分だけ「,（半角カンマ）」で繋ぎます。<br /><br />\r\n\r\n書式　　N0:D0, N1:D1, N2:D2・・, N(n-1):D(n-1), Nn:Dn<br /><br />\r\n意味　1〜N0個まで： D0円引き<br />\r\n　　　N1〜N2個まで： D1円引き<br />\r\n　　　：<br />\r\n　　　：<br />\r\n　　　N(n-1)〜Nn個まで： D(n-1)円引き<br />\r\n　　　N(n-1)+1個以上： Dn円引き<br /><br />\r\n\r\n※n=1,2,・・・,Nの自然数。最後のセットのNnの指定値に意味はなく、Dnは常にN(n-1)+1個以上の時の値引額として扱われる。<br /><br />\r\n\r\n【実例1】\"ホワイト\"<br />\r\n[オプションのワンタイム数量値引設定]　9:-0,10:-1000,11:-4000<br />\r\n意味：　〜9点までは値引き0、10点なら合計から1000円引き、11点以上では4000円を合計から引く<br /><br />\r\n\r\n【実例1】\"オレンジ\"<br />\r\n[オプションのワンタイム数量値引設定]　19:-0,20:-5000<br />\r\n意味：　〜19点までは値引き0、20点以上買うと合計から5000円引き<br /><br />\r\n\r\nNOTE：<br />\r\nDの値は頭に「-」をつけて-100なら100円引きに、「+」をつけて+100となら100円増しになる。','',11),(210,1,'BASEPRICE3','','',0),(210,2,'【3】ベース価格に含める/ない 混在','ベース価格、商品価格、オプション価格の関係を理解する（2）<br /><br />\r\n\r\n【1】や【2】の例とほぼ同じ設定ですが、<br />\r\n\"ホワイト\"の方は、[属性による価格増減をベース価格に含める]フラグ＝\"いいえ\"に、<br />\r\n一方\"オレンジ\"はフラグ＝\"はい\"のようにオプションによって混在している例です。<br />\r\n\r\n【設定メモ】商品情報<br />\r\n・[商品価格]：4000円<br />\r\n・[商品属性による価格]：はい<br /><br />\r\n\r\n【設定メモ】\"ホワイト\"<br />\r\n・[属性による価格増減をベース価格に含める]：いいえ<br />\r\n・[オプション価格]：500円<br /><br />\r\n\r\n【設定メモ】\"オレンジ\"<br />\r\n・[属性による価格増減をベース価格に含める]：はい<br />\r\n・[オプション価格]：1000円<br /><br />\r\n\r\nNOTE:<br />\r\n表示価格（商品名の下に表示されている価格）には、通常ベース価格の最小値が表示されます。しかし、ホワイトは[属性による価格増減をベース価格に含める]フラグが\"いいえ\"なので対象からはずれて、オレンジのベース価格が表示されます。','',9),(211,1,'BASEPRICE2','','',0),(211,2,'【2】ベース価格にオプション価格を含めない','ベース価格、商品価格、オプション価格の関係を理解する（2）<br /><br />\r\n\r\nすぐ直前の【1】とほぼ同じ設定ですが、<br />\r\nおおもとの[商品属性による価格]フラグが\"いいえ\"なので<br />\r\n\"ホワイト\"\"オレンジ\"オプションともに[ベース価格]には[オプション料金]を含みません。<br />\r\n\r\n【設定メモ】商品情報<br />\r\n・[商品価格]：4000円<br />\r\n・[商品属性による価格]：はい<br /><br />\r\n\r\n【設定メモ】\"ホワイト\"<br />\r\n・[属性による価格増減をベース価格に含める]：はい<br />\r\n・[オプション価格]：500円<br /><br />\r\n\r\n【設定メモ】\"オレンジ\"<br />\r\n・[属性による価格増減をベース価格に含める]：はい<br />\r\n・[オプション価格]：1000円<br /><br />\r\n\r\nNOTE:<br />\r\n表示価格（商品名の下に表示されている価格）やベース価格（オプションごと数量割引などの基本額）に含まれないだけで、そのオプション選択時の追加料金としては機能します。','',3),(212,1,'Russ Tippins Band - The Hunter','The Product Music Type is specially designed for music media. This can offer a lot more flexibility than the Product','',0),(212,2,'Russ Tippins Band - The Hunter','「Product - Music」は音楽（・映像）商品に最適化した製品タイプです。<br /><br />\r\n\r\nこの製品タイプで商品登録すると、<br />\r\n・アーティスト<br />\r\n・レコード会社<br />\r\n・音楽ジャンル<br />\r\nなどの情報を扱うことができ、<br /><br />\r\n\r\nさらに、ミュージッククリップ（mp3ファイル等）の割り当てが可能など、一般の製品タイプより柔軟性に富んでいます。','',9),(213,1,'Help!','','',0),(213,2,'Help!','この商品も前の例と同じく「Product - Music」商品タイプの音楽商品です。<br />\r\n前の例が、CDやDVDのような実体のある商品だけを対象としていたのに対し、この商品は実体のある商品（CD）とダウンロード商品（mp3ファイル）のどちらか選んで購入できる想定です。<br />\r\nmp3ファイルを選んだ場合は、購入後マイページからダウンロードできるようになります。<br /><br />\r\n\r\n【設定メモ】商品情報<br />\r\n・[ヴァーチャル商品l]：いいえ、送付先住所の入力は必要<br />\r\n・[常に送料無料]：特別商品とダウンロード商品のコンビネーションは配送先住所の登録が必要です。<br />\r\n・[重量]：0（Kg）　※ダウンロード商品の場合があるためオプション属性側で設定する<br /><br />\r\n\r\n【オプション属性設定メモ】メディアタイプ<br />\r\n■オプション属性＝\"CD\"オプションに対し<br />\r\n・[オプション重量]：1（Kg）<br /><br />\r\n\r\n■オプション属性＝\"mp3（ダウンロード）\"に対し<br />\r\n・[オプション重量]：0（Kg）<br />\r\n・[ダウンロード商品ファイル名]：help.mp3<br />\r\n・[有効期間(日)]：7 （日）<br />\r\n・[最大ダウンロード数]: 5 （回）<br /><br />\r\n\r\nNOTE1：<br />\r\n運営者がこの注文の[注文処理ステータス]を\"完了\"にすると、<br />\r\n注文者のマイページにおいてダウンロードできる状態になります。<br /><br />\r\n\r\nNOTE2：<br />\r\nダウンロードファイルは、あらかじめ<br />\r\n　（ショップ設置ディレクトリ）/download<br />\r\n配下にFTPアップロードしておきます。<br /><br />\r\n\r\n\r\nNOTE3：<br />\r\n「Product - Music」は音楽（・映像）商品に最適化した製品タイプです。<br /><br />\r\n\r\nこの製品タイプで商品登録すると、<br />\r\n・アーティスト<br />\r\n・レコード会社<br />\r\n・音楽ジャンル<br />\r\nなどの情報を扱うことができ、<br /><br />\r\n\r\nさらに、ミュージッククリップ（mp3ファイル等）の割り当てが可能など、一般の製品タイプより柔軟性に富んでいます。','',21),(214,1,'DOC_GENERAL','Document General Type is used for Products that are actually Documents. These cannot be added to the cart but can be configured for the Document Sidebox. If your Document Sidebox is not showing, go to the Layout Controller and turn it on for your template.','',0),(214,2,'一般ドキュメント（非売品）の例','これは製品タイプを[Document - General]で登録したドキュメントで、今読んでいるこれは[ドキュメントの内容]そのものです。<br /><br />\r\n\r\n[Document - General]に指定されたドキュメントは、カートに入れられません。また、販売商品ではないので、[\r\n商品型番]もありません。<br /><br />\r\n\r\nそのかわりに、「書類」と名付けられた特別なサイドボックスに掲載されます。この商品タイプは、文字通りドキュメントとして、このサイトのオンラインマニュアルやFAQとして使うなどの用途が考えられます。<br /><br />\r\n\r\n■■■■■\r\n\r\n<p>WWW(World Wide Web)は, スイスのCERN(欧州素粒子物理研究所)において, 所内の研究者間の研究成果の共有を支援することを目的として, 1990年に分散形広域ハイパテキストシステムの構築のためのプロジェクトによって設立された。このハイパテキストでは, テキスト又はテキストの集合を分割してノードという単位に分け, ノード内にアンカ(端点)を定義して, アンカ間の関係としてハイパリンクを規定している。</p> \r\n\r\n<p>WWWのプロジェクトができた当初は, CERNにおいて特定マシン上のラインモードブラウザが用意されただけであったが, 1991年にはCERN以外でもWWWの利用が可能になり, Xウィンドウシステム用のブラウザが開発された。1993年になると, イリノイ大学でMOSAICが発表されて文書中の画像表示が可能になり, Windows版に加えてMAC版も発表された。1994年のNetscape Navigatorのリリースは, WWWの爆発的普及のきっかけをつくり, それがさらにインタネット利用者を増やすことになった。 </p>\r\n\r\n<p>CERNでのハイパテキストの構造記述及びその交換手続きは, 開発当初は研究所内の仕様にとどまっていたが, WWWの普及と共にそれらの標準化への意識が高まり, IETF(Internet Engineering Task Force)において, HTML及びHTTP(Hypertext Transfer Protocol)の作業グループが設立されて本格的な標準化作業が開始された。HTML 2.0は, IETF RFC1866[1]として公表され, その後, HTMLの標準化作業は, W3C(World Wide Web Consortium)に移された。 </p>\r\n\r\n<p>W3Cでの初期のHTML改版作業は, ブラウザメーカの独自の拡張を吸収してスタイル指定を含む多くの機能を盛り込む方針で行われた。しかしその後, HTMLを本来の文書論理構造記述の言語に引き戻して, スタイル指定については別の交換様式で対応するという方針が主流となり, HTML 3.2[2], HTML 4.0[3]へと改版されてきた。</p>','',9),(215,1,'Document - Product type','','',0),(215,2,'商品ドキュメント（販売商品）の例','これは商品として販売するドキュメントで、商品タイプは[Document - Product]です。<br /><br />\r\n\r\n商品タイプが[Document - General]だった直前の例と異なり、ここにはカゴへ入れるボタンが表示されています。<br />\r\n\r\n商品ドキュメント（販売商品）タイプでは、商品情報の入力項目などは一般商品とかわりありません。しかし、「書類」という特別なサイドボックスに表示されるなど、ドキュメントとして特別扱いされます。','',4),(225,1,'Single Download','','',0),(225,2,'ダウンロード商品例（1ファイル）','これはファイルが1つだけの場合のダウンロード例です。<br />\r\nオプションで選んだファイル形式のファイル1点をダウンロード可能です。<br /><br />\r\n\r\n【設定メモ】商品情報<br />\r\n・[ヴァーチャル商品l]：はい、送付先住所をスキップ<br />\r\n・[常に送料無料]：この商品も前の例と同じく「Product - Music」商品タイプの音楽商品です。<br />\r\n前の例が、CDやDVDのような実体のある商品だけを対象としていたのに対し、この商品は実体のある商品（CD）とダウンロード商品（mp3ファイル）のどちらか選んで購入できる想定です。<br />\r\nmp3ファイルを選んだ場合は、購入後マイページからダウンロードできるようになります。\r\n\r\n【設定メモ】商品情報<br />\r\n・[ヴァーチャル商品l]：はい、送付先住所をスキップ<br />\r\n・[常に送料無料]：特別商品とダウンロード商品のコンビネーションは配送先住所の登録が必要です。<br /><br />\r\n\r\n【オプション属性設定メモ】オプション名：\"ファイル形式\"<br />\r\n・[ダウンロード商品ファイル名]：\r\n　-\"mp3（ダウンロード商品）\" オプションにのみ：ms_word_sample.zip<br />\r\n　-\"CD版\"オプション：（設定しない）<br />\r\n・[有効期間(日)]：7 （日）<br />\r\n・[最大ダウンロード数]: 5 （回）<br /><br />\r\n\r\nNOTE1：<br />\r\n運営者がこの注文の[注文処理ステータス]を\"完了\"にすると、<br />\r\n注文者のマイページにおいてダウンロードできる状態になります。<br /><br />\r\n\r\nNOTE2：<br />\r\nダウンロードファイルは、あらかじめ<br />\r\n　（ショップ設置ディレクトリ）/download\r\n配下にFTPアップロードしておきます。<br /><br />\r\n\r\n\r\nNOTE3：<br />\r\n「Product - Music」は音楽（・映像）商品に最適化した製品タイプです。<br /><br />\r\n\r\nこの製品タイプで商品登録すると、<br />\r\n・アーティスト<br />\r\n・レコード会社<br />\r\n・音楽ジャンル<br />\r\nなどの情報を扱うことができ、<br /><br />\r\n\r\nさらに、ミュージッククリップ（mp3ファイル等）の割り当てが可能など、一般の製品タイプより柔軟性に富んでいます。<br /><br />\r\n\r\n【オプション属性設定メモ】オプション名：\"マニュアル\"<br />\r\n・[ダウンロード商品ファイル名]：<br />\r\n　-\"PDFファイル\"オプション： pdf_sample.zip<br />\r\n　-\"Wordファイル\" オプション：ms_word_sample.zip<br />\r\n・[有効期間(日)]：7 （日）<br />\r\n・[最大ダウンロード数]: 5 （回）<br /><br />\r\n\r\nNOTE1：<br />\r\n運営者がこの注文の[注文処理ステータス]を\"完了\"にすると、<br />\r\n注文者のマイページにおいてダウンロードできる状態になります。<br /><br />\r\n\r\nNOTE2：<br />\r\nダウンロードファイルは、あらかじめ<br />\r\n　（ショップ設置ディレクトリ）/download<br />\r\n配下にFTPアップロードしておきます。<br />','',4),(217,1,'Sample of Product Free Shipping Type','<p>Product Free Shipping can be setup to highlight the Free Shipping aspect of the product. <br /><br />These pages include a Free Shipping Image on them. <br /><br />You can define the ALWAYS_FREE_SHIPPING_ICON in the language file. This can be Text, Image, Text/Image Combo or nothing. <br /><br />The weight does not matter on Always Free Shipping if you set Always Free Shipping to Yes. <br /><br />Be sure to have the Free Shipping Module Turned on! Otherwise, if this is the only product in the cart, it will not be able to be shipped. <br /><br />Notice that this is defined with a weight of 5lbs. But because of the Always Free Shipping being set to Y there will be no shipping charges for this product. <br /><br />You do not have to use the Product Free Shipping product type just to use Always Free Shipping. But the reason you may want to do this is so that the layout of the Product Free Shipping product info page can be layout specifically for the Free Shipping aspect of the product. <br /><br />This includes a READONLY attribute for Option Name: Shipping and Option Value: Free Shipping Included. READONLY attributes do not show on the options for the order.</p>','',0),(217,2,'送料無料タイプ商品の例','ここでは、商品タイプあるいはカテゴリを[Product - Free Shipping]タイプにした場合のふるまいを説明します。<br /><br />\r\n\r\nこの商品の所属するカテゴリは、[Product - Free Shipping]商品タイプ（以下、送料無料タイプ）限定に設定されています。このカテゴリ配下で新しい商品を登録すると、送料無料タイプの商品として登録されます。<br /><br />\r\n\r\n送料無料タイプの商品は、機能的には一般の商品とかわりませんが、あらかじめ[常に送料無料]フラグが\"はい\"に設定されています。<br /><br /><br />\r\n\r\n送料無料の商品には「送料無料！」マークがついてハイライト表示されます。<br /><br />\r\n\r\n[常に送料無料]フラグが\"はい\"なら、商品重量に関係なく、常に送料無料となります。<br /><br />\r\nなお、配送モジュールの「配送料無料」モジュールを有効にしておくこと。さもないと、カートに入れた送料無料商品の精算ができなくなってしまいます。<br /><br />\r\n\r\nNOTE:<br />\r\n送料無料になるかどうかの判定基準は5lbs（約2Kg強）です。しかし[常に送料無料]フラグが\"はい\"になっていると、そのしきい値にかかわらず送料は無料です。<br /><br />\r\n\r\nNOTE：<br />\r\nLanguage file中の、[ALWAYS_FREE_SHIPPING_ICON] 変数を変更することで、送料無料の時のふるまい（テキストを表示する／イメージ画像を表示／テキストと画像の組み合わせを表示／なにも表示しない）を制御できます。<br /><br />','',7),(218,1,'Free Ship & Payment Virtual','Product Price is set to 0  <br /><br />    Payment weight is set to 2 ...  <br /><br />    Virtual is ON ... this will skip shipping address  <br /><br />','',0),(218,2,'【例3】無料商品：送料無料かつ送付先住所入力不要','商品価格が0円（無料商品）で、商品重量は2Kgの商品ですが、バーチャル商品扱いに設定したため、送料無料でお届け先の住所入力をスキップします。<br />これは一見不自然な設定に見えますが、例えばお届け先をユーザ登録住所に限定したい（他の住所は指定できない）場合などの利用が考えられます。<br />なお、同時購入した他の商品すべてがデモ商品であるとき、送料は全く発生しません。<br /><br /><br /><br />【設定メモ】<br /><br />・無料商品： はい<br /><br />・商品価格： 0円<br /><br />・・バーチャル商品：　はい、送付先住所をスキップ<br /><br />・常に送料無料：　いいえ、通常送料を適用<br />','',1),(224,1,'FREESHIP3','','',0),(224,2,'【3】送料無料（重量＝０Kgの商品）','【3】送料無料（重量が0Kgの商品）\r\nこれまでの2例では、[常に送料無料]フラグが\"はい\"に設定することにより常時送料無料商品として取り扱われる例を見てきました。<br /><br />\r\nこれに対して、ここでは重量が0である結果として送料が無料になる例を提示します。<br /><br />\r\n\r\nここでの商品重量は0です。またオプションカラー\"ホワイト\"の追加重量も0ですので、ホワイト購入時は送料が無料になります。\r\n※ただしカゴの中に他の送料有料商品が入っていないこと）\r\n\r\n一方\"オレンジ\"のオプション重量は20Kgあります。従って、オレンジ選択時は送料は無料になりません。\r\n\r\n【設定メモ】商品情報\r\n・[常に送料無料]：いいえ、通常送料を適用\r\n・[商品重量]：0（Kg）\r\n\r\n【設定メモ】商品オプション属性\r\n・\"ホワイト\"の[重量]：0（Kg）\r\n・\"オレンジ\"の[重量]：20（Kg）','',6),(226,1,'Multiple Download','<p>This product is set up to have multiple downloads.</p><p>The Product Price is $49.99</p><p>The attributes are setup with two Option Names, one for each download to allow for two downloads at the same time.</p><p>The first Download is listed under:</p><p>Option Name: Version<br />Option Value: Download Windows - English<br />Option Value: Download Windows - Spanish<br />Option Value: DownloadMAC - English<br /></p><p>The second Download is listed under:</p><p>Option Name: Documentation<br />Option Value: PDF - English<br />Option Value:MS Word- English</p>','',0),(226,2,'ダウンロード商品例（複数ファイル）','これは複数ファイル一括ダウンロード商品の例です。<br /><br />\r\nここではソフト本体とそのマニュアルをセットでダウンロード販売する想定です。本体とマニュアルそれぞれのファイル形式を選んで（商品オプション）注文すると、2ファイルが同時にダウンロード可能になります。<br /><br />\r\n\r\n【設定メモ】商品情報<br />\r\n・[ヴァーチャル商品l]：はい、送付先住所をスキップ<br />\r\n・[常に送料無料]：この商品も前の例と同じく「Product - Music」商品タイプの音楽商品です。<br />\r\n前の例が、CDやDVDのような実体のある商品だけを対象としていたのに対し、この商品は実体のある商品（CD）とダウンロード商品（mp3ファイル）のどちらか選んで購入できる想定です。<br />\r\nmp3ファイルを選んだ場合は、購入後マイページからダウンロードできるようになります。\r\n\r\n【設定メモ】商品情報<br />\r\n・[ヴァーチャル商品l]：はい、送付先住所をスキップ<br />\r\n・[常に送料無料]：特別商品とダウンロード商品のコンビネーションは配送先住所の登録が必要です。<br /><br />\r\n\r\n【オプション属性設定メモ】オプション名：\"ファイル形式\"<br />\r\n・[ダウンロード商品ファイル名]：\r\n　-\"mp3（ダウンロード商品）\" オプションにのみ：ms_word_sample.zip<br />\r\n　-\"CD版\"オプション：（設定しない）<br />\r\n・[有効期間(日)]：7 （日）<br />\r\n・[最大ダウンロード数]: 5 （回）<br /><br />\r\n\r\nNOTE1：<br />\r\n運営者がこの注文の[注文処理ステータス]を\"完了\"にすると、<br />\r\n注文者のマイページにおいてダウンロードできる状態になります。<br /><br />\r\n\r\nNOTE2：<br />\r\nダウンロードファイルは、あらかじめ<br />\r\n　（ショップ設置ディレクトリ）/download\r\n配下にFTPアップロードしておきます。<br /><br />\r\n\r\n\r\nNOTE3：<br />\r\n「Product - Music」は音楽（・映像）商品に最適化した製品タイプです。<br /><br />\r\n\r\nこの製品タイプで商品登録すると、<br />\r\n・アーティスト<br />\r\n・レコード会社<br />\r\n・音楽ジャンル<br />\r\nなどの情報を扱うことができ、<br /><br />\r\n\r\nさらに、ミュージッククリップ（mp3ファイル等）の割り当てが可能など、一般の製品タイプより柔軟性に富んでいます。<br /><br />\r\n\r\n【オプション属性設定メモ】<br />\r\n■オプション名：\"ソフト本体\"に関し<br />\r\n・[ダウンロード商品ファイル名]：<br />\r\n　-\"Windows(en)版\": win-en.zip<br />\r\n　-\"Windows(jp)版\": win-jp.zip<br />\r\n　-\"Mac(jp)版\"：mac-jp.zip<br />\r\n・[有効期間(日)]：7 （日）<br />\r\n・[最大ダウンロード数]: 5 （回）<br /><br />\r\n\r\n■オプション名：\"マニュアル\"に関して<br />\r\n・[ダウンロード商品ファイル名]：<br />\r\n　-\"PDFファイル\"オプション： pdf_sample.zip<br />\r\n　-\"Wordファイル\" オプション：ms_word_sample.zip<br />\r\n・[有効期間(日)]：7 （日）<br />\r\n・[最大ダウンロード数]: 5 （回）<br /><br />\r\n\r\n\r\nNOTE1：<br />\r\n運営者がこの注文の[注文処理ステータス]を\"完了\"にすると、<br />\r\n注文者のマイページにおいてダウンロードできる状態になります。<br /><br />\r\n\r\nNOTE2：<br />\r\nダウンロードファイルは、あらかじめ<br />\r\n　（ショップ設置ディレクトリ）/download<br />\r\n配下にFTPアップロードしておきます。<br />','',3),(229,1,'CD and download file(mp3)','','',0),(229,2,'ダウンロード商品とリアル商品の混在（CDとmp3ファイル）','ここまでの2例がダウンロード商品のみで構成されていたのに対し、この商品は実体のある商品（CD）とダウンロード商品（mp3ファイル）が混在した販売例です。ユーザは購入時に好みの媒体を選んでカゴに入れます。<br />\r\nmp3ファイルを選んだ場合は、購入後マイページからダウンロードできるようになります。<br /><br />\r\n\r\n【設定メモ】商品情報<br />\r\n・[ヴァーチャル商品l]：いいえ、送付先住所の入力は必要<br />\r\n・[常に送料無料]：特別商品とダウンロード商品のコンビネーションは配送先住所の登録が必要です。<br />\r\n・[重量]：0（Kg）　※ダウンロード商品の場合があるためオプション属性側で設定する<br /><br />\r\n\r\n【オプション属性設定メモ】メディアタイプ<br />\r\n■オプション属性＝\"CD\"オプションに対し<br />\r\n・[オプション重量]：1（Kg）<br /><br />\r\n\r\n■オプション属性＝\"mp3（ダウンロード）\"に対し<br />\r\n・[オプション重量]：0（Kg）<br />\r\n・[ダウンロード商品ファイル名]：help.mp3<br />\r\n・[有効期間(日)]：7 （日）<br />\r\n・[最大ダウンロード数]: 5 （回）<br /><br />\r\n\r\nNOTE1：<br />\r\n運営者がこの注文の[注文処理ステータス]を\"完了\"にすると、<br />\r\n注文者のマイページにおいてダウンロードできる状態になります。<br /><br />\r\n\r\nNOTE2：<br />\r\nダウンロードファイルは、あらかじめ<br />\r\n　（ショップ設置ディレクトリ）/download\r\n配下にFTPアップロードしておきます。<br /><br />\r\n\r\n\r\nNOTE3：<br />\r\nこの商品の商品タイプは「Product - Music」です。「Product - Music」タイプは音楽（・映像）商品に最適化した製品タイプです。<br /><br />\r\n\r\nこの製品タイプで商品登録すると、<br />\r\n・アーティスト<br />\r\n・レコード会社<br />\r\n・音楽ジャンル<br />\r\nなどの情報を扱うことができ、<br /><br />\r\n\r\nさらに、ミュージッククリップ（mp3ファイル等）の割り当てが可能など、一般の製品タイプより柔軟性に富んでいます。','',2),(230,1,'DOC_GENERAL','Document General Type is used for Products that are actually Documents. These cannot be added to the cart but can be configured for the Document Sidebox. If your Document Sidebox is not showing, go to the Layout Controller and turn it on for your template.','',0),(230,2,'一般ドキュメント（非売品）の例','これは製品タイプを[Document - General]で登録したドキュメントで、今読んでいるこれは[ドキュメントの内容]そのものです。<br /><br />\r\n\r\n[Document - General]に指定されたドキュメントは、カートに入れられません。また、販売商品ではないので、[\r\n商品型番]もありません。<br /><br />\r\n\r\nそのかわりに、「書類」と名付けられた特別なサイドボックスに掲載されます。この商品タイプは、文字通りドキュメントとして、このサイトのオンラインマニュアルやFAQとして使うなどの用途が考えられます。<br /><br />\r\n\r\n■■■■■\r\n\r\n<p>WWW(World Wide Web)は, スイスのCERN(欧州素粒子物理研究所)において, 所内の研究者間の研究成果の共有を支援することを目的として, 1990年に分散形広域ハイパテキストシステムの構築のためのプロジェクトによって設立された。このハイパテキストでは, テキスト又はテキストの集合を分割してノードという単位に分け, ノード内にアンカ(端点)を定義して, アンカ間の関係としてハイパリンクを規定している。</p> \r\n\r\n<p>WWWのプロジェクトができた当初は, CERNにおいて特定マシン上のラインモードブラウザが用意されただけであったが, 1991年にはCERN以外でもWWWの利用が可能になり, Xウィンドウシステム用のブラウザが開発された。1993年になると, イリノイ大学でMOSAICが発表されて文書中の画像表示が可能になり, Windows版に加えてMAC版も発表された。1994年のNetscape Navigatorのリリースは, WWWの爆発的普及のきっかけをつくり, それがさらにインタネット利用者を増やすことになった。 </p>\r\n\r\n<p>CERNでのハイパテキストの構造記述及びその交換手続きは, 開発当初は研究所内の仕様にとどまっていたが, WWWの普及と共にそれらの標準化への意識が高まり, IETF(Internet Engineering Task Force)において, HTML及びHTTP(Hypertext Transfer Protocol)の作業グループが設立されて本格的な標準化作業が開始された。HTML 2.0は, IETF RFC1866[1]として公表され, その後, HTMLの標準化作業は, W3C(World Wide Web Consortium)に移された。 </p>\r\n\r\n<p>W3Cでの初期のHTML改版作業は, ブラウザメーカの独自の拡張を吸収してスタイル指定を含む多くの機能を盛り込む方針で行われた。しかしその後, HTMLを本来の文書論理構造記述の言語に引き戻して, スタイル指定については別の交換様式で対応するという方針が主流となり, HTML 3.2[2], HTML 4.0[3]へと改版されてきた。</p>','',0),(232,1,'Product - Music type','The Product Music Type is specially designed for music media. This can offer a lot more flexibility than the Product','',0),(232,2,'Musicタイプ商品','「Product - Music」は音楽（・映像）商品に最適化した製品タイプです。<br /><br />\r\n\r\nこの製品タイプで商品登録すると、<br />\r\n・アーティスト<br />\r\n・レコード会社<br />\r\n・音楽ジャンル<br />\r\nなどの情報を扱うことができ、<br /><br />\r\n\r\nさらに、ミュージッククリップ（mp3ファイル等）の割り当てが可能など、一般の製品タイプより柔軟性に富んでいます。','',0),(233,1,'Product - General type','','',0),(233,2,'CCロゴTシャツ','クリエイティブ・コモンズロゴのTシャツです。<br /><br /><br />ベースはUSA製、COTTON 100％、６.1オンス、ヘビーウェイトTシャツ。 <br /><br />豊富なカラーバリエーションで人気 No.1のTシャツです。<br /><br />良質な綿花で知られるメンフィスコットンを主に使用し、 <br /><br />水分吸収が良くソフトで肌触りが良いのが特徴です。','http://www.creativecommons.jp/',0),(234,1,'TAXIN-1','','',1),(234,2,'商品価格を税込み（内税）で管理する例(1)','商品価格を内税（税込み価格）で管理する例です。<br />\r\n内税の場合、2つのやり方があります（次の例と比べてみてください）。<br />\r\nこのケースでは商品価格に内税価格を入力し、税種別を「なし」にしています<br /><br />\r\n\r\n[税種別]をなしに指定すると、商品価格（ネット）＝商品価格（グロス）になり、入力額がそのまま表示されます。オプション価格についても同様で入力額がそのまま使われます。<br /><br />\r\n\r\n・メリット：<br />\r\n　消費税分が上乗せされないので、4,980円など商売上ウケの良い価格表示にしたい場合、制御しやすい。<br /><br />\r\n・デメリット：<br />\r\n　消費税率が変わったら、全対象商品について一つ一つ見直しが必要。<br />\r\n　内部的にも税込み価格ベースで管理することになるので経理上は面倒かも？！<br /><br />\r\n\r\n【設定メモ】内税で管理する：<br />\r\n・[税種別]：　-- なし --<br />\r\n・[商品価格（ネット）]：10000円 （税込み価格を入力する）<br /><br />\r\n\r\n【設定メモ】商品オプション属性<br />\r\n・[オプション価格] レッド（＋0/追加料金なし）、ホワイト（＋1000円）、イエロー（＋2000円）','',0),(156,1,'SALE10%OFF-1','','',0),(157,1,'SALE10%OFF-2','','',0),(158,1,'SALE10%OFF-3','','',0),(159,1,'SALE500yenOFF-1','','',0),(160,1,'SALE500yenOFF-2','','',0),(161,1,'SALE500yenOFF-3','','',0),(162,1,'SALE set8000yen-1','','',0),(163,1,'SALE set8000yen-2','','',0),(164,1,'SALE set8000yen-3','','',0),(165,1,'SPECIAL1-1','','',0),(166,1,'SPECIAL2-1','','',0),(167,1,'SPECIAL2-2','','',0),(168,1,'SPECIAL2-3','','',0),(169,1,'SPECIAL3','','',0),(170,1,'SALE_ETC1','','',0),(171,1,'SALE_ETC2','','',0),(172,1,'NOSALE','','',0),(173,1,'SALE_SPECIAL1-1','','',0),(174,1,'SALE_SPECIAL1-2','','',0),(175,1,'SALE_SPECIAL1-3','','',0),(176,1,'SALE_SPECIAL2-1','','',0),(177,1,'SALE_SPECIAL2-2','','',0),(178,1,'SALE_SPECIAL2-3','','',0),(179,1,'SALE_SPECIAL3-1','','',0),(180,1,'SALE_SPECIAL3-2','','',0),(181,1,'SALE_SPECIAL3-3','','',0);
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
INSERT INTO `products_discount_quantity` VALUES (2,182,20,'20.0000'),(1,182,10,'10.0000'),(3,102,50,'25.0000'),(2,102,20,'20.0000'),(1,102,10,'10.0000'),(3,103,50,'2000.0000'),(2,103,20,'1500.0000'),(1,103,10,'1000.0000'),(3,104,50,'8000.0000'),(2,104,20,'9000.0000'),(1,104,10,'9500.0000'),(3,110,50,'25.0000'),(2,110,20,'20.0000'),(1,110,10,'10.0000'),(1,111,10,'10.0000'),(2,111,20,'20.0000'),(3,111,50,'25.0000'),(3,112,50,'25.0000'),(2,112,20,'20.0000'),(1,112,10,'10.0000'),(3,113,50,'25.0000'),(2,113,20,'20.0000'),(1,113,10,'10.0000'),(3,182,50,'25.0000');
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
-- Dumping data for table `products_notifications`
--

LOCK TABLES `products_notifications` WRITE;
/*!40000 ALTER TABLE `products_notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `products_notifications` ENABLE KEYS */;
UNLOCK TABLES;

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
INSERT INTO `products_options` VALUES (1,1,'size',1,0,32,NULL,32,0,0,0),(1,2,'サイズ',1,0,32,NULL,32,0,0,0),(2,1,'size for kids',2,0,32,NULL,32,0,0,0),(2,2,'サイズ（キッズ）',2,0,32,NULL,32,0,0,0),(3,1,'color',100,2,32,'',32,0,0,0),(3,2,'カラー',100,2,32,'カラーを選択してください',32,5,5,0),(4,1,'Line1',500,1,80,'Enter your text up to 80 characters, punctuation and spaces.',60,5,0,1),(4,2,'名入れ（1）',500,1,80,'1行目に入れる文字を入力してください（全角40文字まで）。',60,5,0,1),(5,1,'Line2',510,1,80,'Enter your text up to 80 characters, punctuation and spaces.',60,5,0,1),(5,2,'名入れ（2）',510,1,80,'2行目に入れる文字を入力してください（全角40文字まで）。',60,5,0,1),(6,1,'How to care, materials',600,5,32,'',32,0,0,0),(6,2,'素材とお手入れ方法',600,5,32,'',32,5,0,0),(7,1,'Gift',700,3,32,NULL,32,0,0,0),(7,2,'ギフトオプション',700,3,32,NULL,32,0,0,0),(8,1,'Size(for chckbox)',800,3,32,NULL,32,0,0,0),(8,2,'サイズ（大人・キッズ）',800,3,32,NULL,32,0,0,0),(9,1,'',0,0,32,NULL,32,0,0,0),(9,2,'購入単位',900,0,32,NULL,32,0,0,0),(10,1,'',0,2,32,'',32,0,0,0),(10,2,'購入単位(radio)',1000,2,32,'',32,0,0,0),(11,1,'wallpaper-size',2000,0,32,NULL,32,0,0,0),(11,2,'壁紙サイズ',2000,0,32,NULL,32,0,0,0),(12,1,'print',2100,2,32,'',32,0,0,0),(12,2,'オリジナルプリント',2100,2,32,'',32,0,0,0),(13,1,'Package',2200,2,32,NULL,32,0,0,0),(13,2,'パッケージ',2200,2,32,NULL,32,0,0,0),(14,1,'guarantee',2300,2,32,NULL,32,0,0,0),(14,2,'保証サービス',2300,2,32,NULL,32,0,0,0),(15,1,'File Type(1)',3000,0,32,'',32,0,0,0),(15,2,'マニュアル',3000,0,32,'',32,0,0,0),(16,1,'File Type(2)',3100,0,32,'',32,0,0,0),(16,2,'ソフト本体',3100,0,32,'',32,0,0,0),(17,1,'Media Type',4000,0,32,'',32,0,0,0),(17,2,'メディアタイプ',4000,0,32,'',32,0,0,0),(18,1,'Attach file',5000,4,32,'',32,0,0,0),(18,2,'ロゴ・データ添付',5000,4,32,'',32,0,0,0),(19,1,'test',0,0,32,NULL,32,0,0,0),(19,2,'テスト',0,0,32,NULL,32,0,0,0);
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
INSERT INTO `products_options_types` VALUES (0,'Dropdown'),(1,'Text'),(2,'Radio'),(3,'Checkbox'),(4,'File'),(5,'Read Only');
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
INSERT INTO `products_options_values` VALUES (0,1,'TEXT',0),(0,2,'TEXT',0),(1,1,'Large',30),(1,2,'Ｌサイズ',30),(2,1,'Midium',20),(2,2,'Ｍサイズ',20),(3,1,'Small',10),(3,2,'Ｓサイズ',10),(4,1,'red',110),(4,2,'レッド',110),(5,1,'yellow',120),(5,2,'イエロー',120),(15,1,'COTTON 100％',600),(7,1,'blue',130),(7,2,'ブルー',130),(8,1,'blank',140),(8,2,'ブラック',140),(9,1,'',210),(9,2,'110cm',210),(10,1,'',220),(10,2,'120cm',220),(11,1,'',230),(11,2,'130cm',230),(12,1,'140cm',240),(12,2,'140cm',240),(13,1,'150cm',250),(13,2,'150cm',250),(14,1,'white',100),(14,2,'ホワイト',100),(15,2,'綿 100％',600),(16,1,'',610),(16,2,'６.1オンス',610),(17,1,'',620),(17,2,'洗濯機（弱水流）または手洗い',620),(18,1,'',630),(18,2,'アイロンは中温（〜160℃）まで',630),(19,1,'X-Large',40),(19,2,'XLサイズ',40),(20,1,'Select one...',50),(20,2,'ご選択ください・・・',50),(21,1,'Wrapping',700),(21,2,'ギフト包装',700),(22,1,'Message Card',710),(22,2,'メッセージカード',710),(23,1,'Prezent Keyholder',720),(23,2,'オリジナルキーホルダー',720),(24,1,'S',800),(24,2,'Ｓサイズ',800),(25,1,'M',810),(25,2,'Ｍサイズ',810),(26,1,'L',820),(26,2,'Ｌサイズ',820),(27,1,'110cm',830),(27,2,'110cm',830),(28,1,'120cm',840),(28,2,'120cm',840),(29,1,'130cm',850),(29,2,'130cm',850),(30,1,'140cm',860),(30,2,'140cm',860),(31,1,'150cm',870),(31,2,'150cm',870),(32,1,'m',900),(32,2,'メートル（m）',900),(33,1,'cm',910),(33,2,'センチメートル（cm）',910),(34,1,'m',1000),(34,2,'メートル（m）',1000),(35,1,'cm',1010),(35,2,'センチメートル（cm）',1010),(36,1,'midium',2000),(36,2,'幅500px',2000),(37,1,'Large',2010),(37,2,'幅1024px',2010),(38,1,'orange',150),(38,2,'オレンジ',150),(39,1,'print1',2100),(39,2,'プリント1色',2100),(40,1,'print2',2120),(40,2,'プリント2色',2120),(41,1,'',2130),(41,2,'プリント3色',2130),(42,1,'package5',2200),(42,2,'お試しパック（5枚入り）',2200),(43,1,'package100',2210),(43,2,'業務用パック（100枚入り）',2210),(44,1,'none',2300),(44,2,'なし',2300),(45,1,'5 years',2310),(45,2,'5年保証（保証料は商品の5％分）',2310),(46,1,'20 years',2320),(46,2,'20年保証（保証料は商品の15％分）',2320),(47,2,'初期費用（表示価格の20％）込み',2140),(47,1,'initial cost 20%',2140),(48,1,'white(NOT add to base price)',160),(48,2,'ホワイト（ベース価格に含めない）',160),(49,1,'white (add to base price)',170),(49,2,'ホワイト（ベース価格に含める）',170),(50,1,'orange',180),(50,2,'オレンジ（ベース価格に含める）',180),(51,1,'orange(NOT add to base price)',190),(51,2,'オレンジ（ベース価格に含めない）',190),(52,1,'Adobe PDF',3000),(52,2,'PDFファイル',3000),(53,1,'microsoft Word',3010),(53,2,'Wordファイル',3010),(54,1,'Windows(en)',3100),(54,2,'Windows(en)版',3100),(55,1,'Windows(jp)',3110),(55,2,'Windows(jp)版',3110),(56,1,'Mac(jp)',3120),(56,2,'Mac(jp)版',3120),(57,1,'CD',4000),(57,2,'CD',4000),(58,1,'mp3',4010),(58,2,'mp3（ダウンロード商品）',4010),(59,1,'gold',160),(59,2,'ゴールド',160);
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
) ENGINE=MyISAM AUTO_INCREMENT=64 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `products_options_values_to_products_options`
--

LOCK TABLES `products_options_values_to_products_options` WRITE;
/*!40000 ALTER TABLE `products_options_values_to_products_options` DISABLE KEYS */;
INSERT INTO `products_options_values_to_products_options` VALUES (1,1,1),(2,1,2),(3,1,3),(4,3,4),(5,3,5),(15,4,0),(7,3,7),(8,3,8),(9,2,9),(10,2,10),(11,2,11),(12,2,12),(13,2,13),(14,3,14),(16,5,0),(17,6,15),(18,6,16),(19,6,17),(20,6,18),(21,1,19),(22,1,20),(23,7,21),(24,7,22),(25,7,23),(26,8,24),(27,8,25),(28,8,26),(29,8,27),(30,8,28),(31,8,29),(32,8,30),(33,8,31),(34,9,32),(35,9,33),(36,10,34),(37,10,35),(38,11,36),(39,11,37),(40,3,38),(41,12,39),(42,12,40),(43,12,41),(44,13,42),(45,13,43),(46,14,44),(47,14,45),(48,14,46),(50,12,47),(51,3,48),(52,3,49),(53,3,50),(54,3,51),(55,15,52),(56,15,53),(57,16,54),(58,16,55),(59,16,56),(60,17,57),(61,17,58),(62,18,0),(63,3,59);
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
-- Dumping data for table `products_point_rate`
--

LOCK TABLES `products_point_rate` WRITE;
/*!40000 ALTER TABLE `products_point_rate` DISABLE KEYS */;
/*!40000 ALTER TABLE `products_point_rate` ENABLE KEYS */;
UNLOCK TABLES;

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
INSERT INTO `products_to_categories` VALUES (1,2),(1,21),(2,4),(2,21),(3,2),(4,2),(5,4),(6,5),(6,21),(7,7),(8,8),(9,5),(10,8),(11,5),(11,21),(12,7),(12,80),(13,8),(13,27),(14,5),(14,80),(15,9),(16,10),(17,11),(17,27),(18,8),(19,12),(20,7),(21,13),(21,21),(22,13),(22,21),(23,14),(24,14),(24,96),(25,11),(26,7),(26,30),(27,12),(28,7),(29,14),(29,21),(30,7),(31,14),(32,14),(33,13),(34,13),(35,9),(35,27),(36,10),(37,9),(38,9),(38,21),(38,31),(39,10),(40,9),(41,10),(42,13),(43,12),(44,12),(44,30),(45,13),(46,13),(47,11),(48,13),(48,21),(49,13),(49,96),(50,15),(51,16),(52,7),(53,16),(53,30),(54,12),(54,21),(55,7),(55,29),(56,12),(57,17),(57,80),(57,95),(58,12),(58,21),(59,17),(60,12),(60,21),(61,17),(62,16),(63,12),(63,80),(64,16),(65,2),(65,29),(70,20),(71,20),(72,20),(73,20),(74,20),(75,20),(76,22),(77,22),(78,22),(79,22),(80,22),(81,22),(82,22),(83,22),(84,22),(85,22),(86,22),(87,22),(88,23),(89,23),(89,27),(90,23),(91,23),(92,40),(93,40),(95,40),(98,40),(99,41),(100,41),(101,41),(101,64),(102,45),(103,45),(104,45),(110,45),(111,45),(112,45),(113,45),(115,58),(116,58),(139,60),(140,60),(141,61),(142,62),(143,62),(144,63),(146,63),(151,63),(152,63),(152,64),(155,40),(156,67),(156,72),(157,67),(158,67),(159,68),(160,68),(161,68),(162,69),(163,69),(164,69),(165,70),(166,70),(167,70),(168,70),(169,70),(170,71),(171,71),(172,67),(172,72),(173,73),(174,73),(175,73),(176,74),(177,74),(178,74),(179,75),(180,75),(181,75),(182,45),(183,76),(184,76),(185,76),(187,78),(188,78),(189,78),(190,81),(191,81),(192,82),(193,82),(194,82),(195,82),(196,83),(197,83),(198,85),(199,85),(200,78),(201,86),(202,86),(203,86),(204,86),(205,87),(206,87),(207,87),(208,83),(209,89),(210,89),(211,89),(212,91),(213,91),(214,93),(215,93),(215,97),(217,79),(217,98),(218,40),(222,79),(223,79),(224,79),(225,100),(226,100),(227,101),(229,100);
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
INSERT INTO `products_with_attributes_stock` VALUES (1,90,'319','Ｗ５００',11);
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
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table `products_xsell`
--

LOCK TABLES `products_xsell` WRITE;
/*!40000 ALTER TABLE `products_xsell` DISABLE KEYS */;
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
INSERT INTO `project_version` VALUES (1,'Zen-Cart Main','1','3.0.2-l10n-jp-5','','','','','Fresh Installation','2009-11-19 12:39:40'),(2,'Zen-Cart Database','1','3.0.2-l10n-jp-5','','','','','Fresh Installation','2009-11-19 12:39:40');
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
INSERT INTO `project_version_history` VALUES (1,'Zen-Cart Main','1','3.0.2','','Fresh Installation','2009-11-19 12:39:40'),(2,'Zen-Cart Database','1','3.0.2','','Fresh Installation','2009-11-19 12:39:40'),(3,'Zen-Cart Main','1','3.0.2-l10n-jp-1','','v1.3.0.2-l10n-jp-1','2009-11-19 12:39:40'),(4,'Zen-Cart Database','1','3.0.2-l10n-jp-1','','v1.3.0.2-l10n-jp-1','2009-11-19 12:39:40'),(5,'Zen-Cart Main','1','3.0.2-l10n-jp-2','','v1.3.0.2-l10n-jp-2','2009-11-19 12:39:40'),(6,'Zen-Cart Database','1','3.0.2-l10n-jp-2','','v1.3.0.2-l10n-jp-2','2009-11-19 12:39:40'),(7,'Zen-Cart Main','1','3.0.2-l10n-jp-3','','v1.3.0.2-l10n-jp-3','2009-11-19 12:39:40'),(8,'Zen-Cart Database','1','3.0.2-l10n-jp-3','','v1.3.0.2-l10n-jp-3','2009-11-19 12:39:40'),(9,'Zen-Cart Main','1','3.0.2-l10n-jp-4','','v1.3.0.2-l10n-jp-4','2009-11-19 12:39:40'),(10,'Zen-Cart Database','1','3.0.2-l10n-jp-4','','v1.3.0.2-l10n-jp-4','2009-11-19 12:39:40'),(11,'Zen-Cart Main','1','3.0.2-l10n-jp-5','','v1.3.0.2-l10n-jp-5','2009-11-19 12:39:40'),(12,'Zen-Cart Database','1','3.0.2-l10n-jp-5','','v1.3.0.2-l10n-jp-5','2009-11-19 12:39:40');
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
INSERT INTO `query_builder` VALUES (1,'email','All Customers','Returns all customers name and email address for sending mass emails (ie: for newsletters, coupons, GV\'s, messages, etc).','select customers_email_address, customers_firstname, customers_lastname from TABLE_CUSTOMERS order by customers_lastname, customers_firstname, customers_email_address',''),(2,'email,newsletters','All Newsletter Subscribers','Returns name and email address of newsletter subscribers','select customers_firstname, customers_lastname, customers_email_address from TABLE_CUSTOMERS where customers_newsletter = \'1\'',''),(3,'email,newsletters','Dormant Customers (>3months) (Subscribers)','Subscribers who HAVE purchased something, but have NOT purchased for at least three months.','select c.customers_email_address, c.customers_lastname, c.customers_firstname from TABLE_CUSTOMERS c, TABLE_ORDERS o where c.customers_newsletter = \'1\' AND c.customers_id = o.customers_id and o.date_purchased < subdate(now(),INTERVAL 3 MONTH) GROUP BY c.customers_email_address order by c.customers_lastname, c.customers_firstname ASC',''),(4,'email,newsletters','Active customers in past 3 months (Subscribers)','Newsletter subscribers who are also active customers (purchased something) in last 3 months.','select c.customers_email_address, c.customers_lastname, c.customers_firstname from TABLE_CUSTOMERS c, TABLE_ORDERS o where c.customers_newsletter = \'1\' AND c.customers_id = o.customers_id and o.date_purchased > subdate(now(),INTERVAL 3 MONTH) GROUP BY c.customers_email_address order by c.customers_lastname, c.customers_firstname ASC',''),(5,'email,newsletters','Active customers in past 3 months (Regardless of subscription status)','All active customers (purchased something) in last 3 months, ignoring newsletter-subscription status.','select c.customers_email_address, c.customers_lastname, c.customers_firstname from TABLE_CUSTOMERS c, TABLE_ORDERS o WHERE c.customers_id = o.customers_id and o.date_purchased > subdate(now(),INTERVAL 3 MONTH) GROUP BY c.customers_email_address order by c.customers_lastname, c.customers_firstname ASC',''),(6,'email,newsletters','Administrator','Just the email account of the current administrator','select \'ADMIN\' as customers_firstname, admin_name as customers_lastname, admin_email as customers_email_address from TABLE_ADMIN where admin_id = $SESSION:admin_id',''),(7,'email','ビジターを除く全ての顧客','Returns all customers name and email address for sending mass emails (ie: for newsletters, coupons, GV\'s, messages, etc).','select c.customers_email_address, c.customers_firstname, c.customers_lastname from TABLE_CUSTOMERS c left join TABLE_VISITORS v on c.customers_id = v.visitors_id where v.visitors_id is null order by c.customers_lastname, c.customers_firstname, c.customers_email_address',''),(8,'email,newsletters','ビジターを除く全てのメールマガジン購読者','Returns name and email address of newsletter subscribers','select c.customers_firstname, c.customers_lastname, c.customers_email_address from TABLE_CUSTOMERS c left join TABLE_VISITORS v on c.customers_id = v.visitors_id where c.customers_newsletter = \'1\' and v.visitors_id is null',''),(9,'email,newsletters','ビジターを除く休眠中の顧客 (過去３ヶ月超に注文) (メールマガジン購読者のみ)','Subscribers who HAVE purchased something, but have NOT purchased for at least three months.','select c.customers_email_address, c.customers_lastname, c.customers_firstname from TABLE_CUSTOMERS c left join TABLE_VISITORS v on c.customers_id = v.visitors_id , TABLE_ORDERS o where c.customers_newsletter = \'1\' and c.customers_id = o.customers_id and o.date_purchased < subdate(now(),INTERVAL 3 MONTH) and v.visitors_id is null GROUP BY c.customers_email_address order by c.customers_lastname, c.customers_firstname ASC',''),(10,'email,newsletters','ビジターを除く過去３ヶ月未満に注文があった活発な顧客 (メールマガジン購読者のみ)','Newsletter subscribers who are also active customers (purchased something) in last 3 months.','select c.customers_email_address, c.customers_lastname, c.customers_firstname from TABLE_CUSTOMERS c left join TABLE_VISITORS v on c.customers_id = v.visitors_id, TABLE_ORDERS o where c.customers_newsletter = \'1\' AND c.customers_id = o.customers_id and o.date_purchased > subdate(now(),INTERVAL 3 MONTH) and v.visitors_id is null GROUP BY c.customers_email_address order by c.customers_lastname, c.customers_firstname ASC',''),(11,'email,newsletters','ビジターを除く過去３ヶ月未満に注文があった活発な顧客 (メールマガジン購読者でなくとも)','All active customers (purchased something) in last 3 months, ignoring newsletter-subscription status.','select c.customers_email_address, c.customers_lastname, c.customers_firstname from TABLE_CUSTOMERS c left join TABLE_VISITORS v on c.customers_id = v.visitors_id, TABLE_ORDERS o WHERE c.customers_id = o.customers_id and o.date_purchased > subdate(now(),INTERVAL 3 MONTH) and v.visitors_id is null GROUP BY c.customers_email_address order by c.customers_lastname, c.customers_firstname ASC','');
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
INSERT INTO `record_artists_info` VALUES (1,1,'',0,NULL),(1,2,'',0,NULL);
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
INSERT INTO `record_company_info` VALUES (1,1,'www.hmvgroup.com',0,NULL),(1,2,'www.hmvgroup.com',0,NULL);
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
INSERT INTO `salemaker_sales` VALUES (1,1,'10%OFF','10.0000',1,'0.0000','0.0000',2,'64,67',',64,67,','0001-01-01','0001-01-01','2007-01-17','2007-01-18','2007-01-17'),(2,1,'500円OFF','500.0000',0,'0.0000','0.0000',2,'68',',68,','0001-01-01','0001-01-01','2007-01-18','2007-01-19','2007-01-18'),(3,1,'新価格8000円','8000.0000',2,'0.0000','0.0000',2,'69',',69,','0001-01-01','0001-01-01','2007-01-18','2007-01-19','2007-01-18'),(4,1,'10％OFF（特価＋セール）','10.0000',1,'0.0000','0.0000',2,'73',',73,','0001-01-01','0001-01-01','2007-01-18','2007-01-18','2007-01-18'),(5,1,'10％OFF（セール優先）','10.0000',1,'0.0000','0.0000',0,'74',',74,','0001-01-01','0001-01-01','2007-01-18','2007-01-18','2007-01-18'),(6,1,'10％OFF（特価優先）','10.0000',1,'0.0000','0.0000',1,'75',',75,','0001-01-01','0001-01-01','2007-01-18','2007-01-18','2007-01-18'),(7,0,'10％セール期間と価格帯限定','10.0000',1,'10000.0000','0.0000',2,'71',',71,','2007-01-15','2007-06-15','2007-01-18','2007-01-18','2009-11-19');
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
INSERT INTO `sessions` VALUES ('vlrgcajqsgfh40o9t0j484u8p0',1258611692,'initiated|b:1;securityToken|s:32:\"95769cdc6642d6e213827ba34c206356\";language|s:8:\"japanese\";languages_id|s:1:\"2\";selected_box|s:13:\"configuration\";html_editor_preference_status|s:4:\"NONE\";admin_id|s:1:\"1\";messageToStack|s:0:\"\";ez_sort_order|i:0;'),('1s3847k7v95mulp6tt8ri8apv0',1258606448,'initiated|b:1;customers_host_address|s:11:\"pc100.local\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";s:8:\"physical\";s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.100\";payment|N;'),('0mctk6taf62o3i7a97979gptd5',1258611628,'initiated|b:1;securityToken|s:32:\"6e2360e9c369ae3dc59a6857131544cd\";language|s:8:\"japanese\";languages_id|s:1:\"2\";selected_box|s:13:\"configuration\";html_editor_preference_status|s:4:\"NONE\";admin_id|s:1:\"1\";'),('6nc0cgc4p1bd9egvrer61cbta2',1258613511,'initiated|b:1;customers_host_address|s:11:\"pc115.local\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.115\";'),('plrojh5ohsao9vangt7abnil35',1258615872,'initiated|b:1;securityToken|s:32:\"d6a27db44802ff124655c6581449cfad\";language|s:8:\"japanese\";languages_id|s:1:\"2\";selected_box|s:13:\"configuration\";html_editor_preference_status|s:4:\"NONE\";admin_id|s:1:\"1\";'),('ouobdeu24crqf1mhl6ppupdh77',1258613025,'initiated|b:1;customers_host_address|s:25:\"FLH1Akz188.tky.mesh.ad.jp\";cartID|N;cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:1:{s:36:\"190:e468d7a4871dca5f6c31f42a03a7c4a2\";a:2:{s:3:\"qty\";s:1:\"1\";s:10:\"attributes\";a:1:{i:3;s:1:\"4\";}}}s:5:\"total\";d:10500;s:6:\"weight\";d:0.25;s:6:\"cartID\";N;s:12:\"content_type\";s:8:\"physical\";s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:5:{i:0;a:4:{s:4:\"page\";s:12:\"product_info\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:3:{s:11:\"products_id\";s:3:\"190\";s:17:\"number_of_uploads\";s:1:\"0\";s:6:\"action\";s:11:\"add_product\";}s:4:\"post\";a:5:{s:2:\"id\";a:1:{i:3;i:4;}s:13:\"cart_quantity\";s:1:\"1\";s:11:\"products_id\";s:3:\"190\";s:1:\"x\";s:3:\"111\";s:1:\"y\";s:2:\"24\";}}i:1;a:4:{s:4:\"page\";s:13:\"shopping_cart\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:17:\"number_of_uploads\";s:1:\"0\";}s:4:\"post\";a:0:{}}i:2;a:4:{s:4:\"page\";s:17:\"checkout_shipping\";s:4:\"mode\";s:3:\"SSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:7:{s:6:\"action\";s:7:\"process\";s:8:\"shipping\";s:9:\"flat_flat\";s:26:\"calendar_hope_delivery_day\";s:10:\"最短で発送\";s:27:\"calendar_hope_delivery_time\";s:10:\"指定しない\";s:8:\"comments\";s:0:\"\";s:1:\"x\";s:3:\"161\";s:1:\"y\";s:2:\"18\";}}i:3;a:4:{s:4:\"page\";s:16:\"checkout_payment\";s:4:\"mode\";s:3:\"SSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}i:4;a:4:{s:4:\"page\";s:21:\"checkout_confirmation\";s:4:\"mode\";s:3:\"SSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:8:{s:8:\"cc_owner\";s:7:\"saito s\";s:9:\"cc_number\";s:0:\"\";s:16:\"cc_expires_month\";s:2:\"01\";s:15:\"cc_expires_year\";s:2:\"09\";s:7:\"payment\";s:3:\"cod\";s:8:\"comments\";s:0:\"\";s:1:\"x\";s:3:\"120\";s:1:\"y\";s:2:\"16\";}}}s:8:\"snapshot\";a:4:{s:4:\"page\";s:17:\"checkout_shipping\";s:4:\"mode\";s:3:\"SSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:15:\"125.195.105.188\";new_products_id_in_cart|s:36:\"190:e468d7a4871dca5f6c31f42a03a7c4a2\";valid_to_checkout|b:1;cart_errors|s:0:\"\";payment|s:3:\"cod\";customer_id|i:2;visitors_id|i:2;customer_first_name|s:5:\"saito\";customer_last_name|s:1:\"s\";customer_first_name_kana|s:8:\"さいとう\";customer_last_name_kana|s:2:\"さ\";customer_default_address_id|i:2;customer_country_id|s:3:\"107\";customer_zone_id|s:3:\"186\";customers_authorization|s:1:\"0\";sendto|i:2;shipping|a:4:{s:2:\"id\";s:9:\"flat_flat\";s:5:\"title\";s:8:\"定額料金\";s:4:\"cost\";s:4:\"5.00\";s:8:\"timespec\";N;}calendar_hope_delivery_day|s:10:\"最短で発送\";calendar_hope_delivery_time|s:10:\"指定しない\";billto|i:2;cot_gv|i:0;comments|s:0:\"\";'),('bkeocfe30iro27kpicul05mhu1',1258612903,'initiated|b:1;customers_host_address|s:25:\"FLH1Akz188.tky.mesh.ad.jp\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:1:{s:36:\"190:e468d7a4871dca5f6c31f42a03a7c4a2\";a:2:{s:3:\"qty\";i:1;s:10:\"attributes\";a:1:{i:3;i:4;}}}s:5:\"total\";d:10500;s:6:\"weight\";d:0.25;s:6:\"cartID\";s:5:\"59357\";s:12:\"content_type\";s:8:\"physical\";s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:5:{i:0;a:4:{s:4:\"page\";s:12:\"product_info\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:3:{s:11:\"products_id\";s:3:\"190\";s:17:\"number_of_uploads\";s:1:\"0\";s:6:\"action\";s:11:\"add_product\";}s:4:\"post\";a:5:{s:2:\"id\";a:1:{i:3;i:4;}s:13:\"cart_quantity\";s:1:\"1\";s:11:\"products_id\";s:3:\"190\";s:1:\"x\";s:3:\"111\";s:1:\"y\";s:2:\"24\";}}i:1;a:4:{s:4:\"page\";s:13:\"shopping_cart\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:17:\"number_of_uploads\";s:1:\"0\";}s:4:\"post\";a:0:{}}i:2;a:4:{s:4:\"page\";s:17:\"checkout_shipping\";s:4:\"mode\";s:3:\"SSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}i:3;a:4:{s:4:\"page\";s:5:\"login\";s:4:\"mode\";s:3:\"SSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}i:4;a:4:{s:4:\"page\";s:5:\"addon\";s:4:\"mode\";s:3:\"SSL\";s:3:\"get\";a:1:{s:6:\"module\";s:23:\"visitors/create_visitor\";}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:4:{s:4:\"page\";s:17:\"checkout_shipping\";s:4:\"mode\";s:3:\"SSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:15:\"125.195.105.188\";new_products_id_in_cart|s:36:\"190:e468d7a4871dca5f6c31f42a03a7c4a2\";valid_to_checkout|b:1;cart_errors|s:0:\"\";payment|N;'),('4162ks23csgpfv95li9a7e2iv1',1258620110,'initiated|b:1;securityToken|s:32:\"67a4962d1aa6a9af6e2adc92b888f4c7\";language|s:8:\"japanese\";languages_id|s:1:\"2\";selected_box|s:13:\"configuration\";html_editor_preference_status|s:4:\"NONE\";admin_id|s:1:\"1\";messageToStack|s:0:\"\";'),('2mpo9v4064m0qn8egv6k2ou0m4',1258621356,'initiated|b:1;customers_host_address|s:11:\"pc115.local\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":8:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:4:\"page\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:2:{s:2:\"id\";s:1:\"1\";s:7:\"chapter\";s:2:\"10\";}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.115\";'),('0259nrnjmsgdhla4gr5p7ga2j0',1258624480,'initiated|b:1;customers_host_address|s:11:\"pc100.local\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.100\";'),('85opkjsig5gqhhl9vneuenicm6',1258630347,'initiated|b:1;securityToken|s:32:\"97693886982edef97f8d8bfa99079054\";language|s:8:\"japanese\";languages_id|s:1:\"2\";selected_box|s:13:\"configuration\";html_editor_preference_status|s:4:\"NONE\";admin_id|s:1:\"1\";cot_gv|s:4:\"0.00\";cot_subpoint|s:1:\"0\";messageToStack|s:0:\"\";'),('4f8mutp7q1cc9g12qm2rfgmd90',1258627004,'initiated|b:1;customers_host_address|s:11:\"pc100.local\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:1:{i:40;a:1:{s:3:\"qty\";i:1;}}s:5:\"total\";d:4725;s:6:\"weight\";d:0.25;s:6:\"cartID\";s:5:\"75367\";s:12:\"content_type\";s:8:\"physical\";s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:4:{s:4:\"page\";s:17:\"checkout_shipping\";s:4:\"mode\";s:3:\"SSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.100\";new_products_id_in_cart|s:0:\"\";valid_to_checkout|b:1;cart_errors|s:0:\"\";payment|N;'),('n4oi1c21jmqu2o2be1ddtvfv77',1258628682,'initiated|b:1;customers_host_address|s:11:\"pc115.local\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:1:{i:92;a:1:{s:3:\"qty\";i:1;}}s:5:\"total\";d:0;s:6:\"weight\";i:0;s:6:\"cartID\";s:5:\"81447\";s:12:\"content_type\";s:8:\"physical\";s:18:\"free_shipping_item\";i:1;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";d:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:5:{i:0;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:12:\"product_info\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:2:{s:11:\"products_id\";s:2:\"92\";s:6:\"action\";s:11:\"add_product\";}s:4:\"post\";a:4:{s:13:\"cart_quantity\";s:1:\"1\";s:11:\"products_id\";s:2:\"92\";s:1:\"x\";s:2:\"50\";s:1:\"y\";s:2:\"25\";}}i:2;a:4:{s:4:\"page\";s:13:\"shopping_cart\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}i:3;a:4:{s:4:\"page\";s:17:\"checkout_shipping\";s:4:\"mode\";s:3:\"SSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}i:4;a:4:{s:4:\"page\";s:5:\"login\";s:4:\"mode\";s:3:\"SSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:4:{s:4:\"page\";s:17:\"checkout_shipping\";s:4:\"mode\";s:3:\"SSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.115\";new_products_id_in_cart|s:2:\"92\";valid_to_checkout|b:1;cart_errors|s:0:\"\";payment|N;'),('a63vbn3dugqnoa3sn33b971s13',1258631595,'initiated|b:1;securityToken|s:32:\"fed19a589b71f30bdf7e8f02e3eee33a\";language|s:8:\"japanese\";languages_id|s:1:\"2\";selected_box|s:13:\"configuration\";html_editor_preference_status|s:4:\"NONE\";admin_id|s:1:\"1\";messageToStack|s:0:\"\";');
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
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
INSERT INTO `specials` VALUES (1,1,'4050.0000','2007-01-16 00:29:45',NULL,'0001-01-01',NULL,1,'0001-01-01'),(2,17,'3800.0000','2007-01-16 00:31:09','2007-01-16 00:31:50','0001-01-01',NULL,1,'0001-01-01'),(3,79,'2000.0000','2007-01-16 00:34:02',NULL,'0001-01-01',NULL,1,'0001-01-01'),(4,93,'7500.0000','2007-01-16 15:11:23','2007-01-16 15:50:07','0001-01-01',NULL,1,'0001-01-01'),(7,101,'9000.0000','2007-01-16 17:24:53',NULL,'0001-01-01',NULL,1,'0001-01-01'),(27,212,'450.0000','2007-01-26 11:08:19',NULL,'0001-01-01',NULL,1,'0001-01-01'),(11,111,'5000.0000','2007-01-16 20:38:12','2007-01-16 21:13:28','0001-01-01',NULL,1,'0001-01-01'),(10,110,'9500.0000','2007-01-16 20:38:12','2007-01-16 21:10:17','0001-01-01',NULL,1,'0001-01-01'),(12,113,'5000.0000','2007-01-16 21:03:43','2007-01-16 21:14:42','0001-01-01',NULL,1,'0001-01-01'),(13,165,'8000.0000','2007-01-18 14:08:42','2007-01-18 14:13:02','0001-01-01',NULL,1,'0001-01-01'),(14,166,'5000.0000','2007-01-18 14:28:21',NULL,'0001-01-01',NULL,1,'0001-01-01'),(15,167,'5000.0000','2007-01-18 14:28:40',NULL,'0001-01-01',NULL,1,'0001-01-01'),(16,168,'5000.0000','2007-01-18 14:28:51',NULL,'0001-01-01',NULL,1,'0001-01-01'),(17,169,'5000.0000','2007-01-18 14:29:19','2007-01-18 14:29:48','2007-06-15','2009-11-19 12:41:47',0,'2007-01-15'),(18,173,'5000.0000','2007-01-18 14:30:15',NULL,'0001-01-01',NULL,1,'0001-01-01'),(19,174,'5000.0000','2007-01-18 14:30:26',NULL,'0001-01-01',NULL,1,'0001-01-01'),(20,175,'5000.0000','2007-01-18 14:30:35',NULL,'0001-01-01',NULL,1,'0001-01-01'),(21,176,'5000.0000','2007-01-18 14:30:53',NULL,'0001-01-01',NULL,1,'0001-01-01'),(22,177,'5000.0000','2007-01-18 14:31:03',NULL,'0001-01-01',NULL,1,'0001-01-01'),(23,178,'5000.0000','2007-01-18 14:31:11',NULL,'0001-01-01',NULL,1,'0001-01-01'),(24,179,'5000.0000','2007-01-18 14:34:01',NULL,'0001-01-01',NULL,1,'0001-01-01'),(25,180,'5000.0000','2007-01-18 14:34:11',NULL,'0001-01-01',NULL,1,'0001-01-01'),(26,181,'5000.0000','2007-01-18 14:34:24',NULL,'0001-01-01',NULL,1,'0001-01-01');
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
-- Table structure for table `template_select`
--

DROP TABLE IF EXISTS `template_select`;
CREATE TABLE `template_select` (
  `template_id` int(11) NOT NULL auto_increment,
  `template_dir` varchar(64) NOT NULL default '',
  `template_language` varchar(64) NOT NULL default '0',
  PRIMARY KEY  (`template_id`),
  KEY `idx_tpl_lang_zen` (`template_language`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=ujis;

--
-- Dumping data for table `template_select`
--

LOCK TABLES `template_select` WRITE;
/*!40000 ALTER TABLE `template_select` DISABLE KEYS */;
INSERT INTO `template_select` VALUES (1,'sugudeki','0');
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
INSERT INTO `upgrade_exceptions` VALUES (1,'mysql_zencart.sql','REASON_TABLE_NOT_FOUND CHECK PREFIXES!','2009-11-19 12:39:41','UPDATE `query_builder` SET `query_name` = \'全顧客\' WHERE `query_id` =1 LIMIT 1;'),(2,'mysql_zencart.sql','REASON_TABLE_NOT_FOUND CHECK PREFIXES!','2009-11-19 12:39:41','UPDATE `query_builder` SET `query_name` = \'メールマガジン希望者\' WHERE `query_id` =2 LIMIT 1;'),(3,'mysql_zencart.sql','REASON_TABLE_NOT_FOUND CHECK PREFIXES!','2009-11-19 12:39:41','UPDATE `query_builder` SET `query_name` = \'休眠顧客（過去三ヶ月間、配信希望者のみ）\' WHERE `query_id` =3 LIMIT 1;'),(4,'mysql_zencart.sql','REASON_TABLE_NOT_FOUND CHECK PREFIXES!','2009-11-19 12:39:41','UPDATE `query_builder` SET `query_name` = \'稼動顧客（過去三ヶ月間、配信希望者のみ）\' WHERE `query_id` =4 LIMIT 1;'),(5,'mysql_zencart.sql','REASON_TABLE_NOT_FOUND CHECK PREFIXES!','2009-11-19 12:39:41','UPDATE `query_builder` SET `query_name` = \'稼動顧客（過去三ヶ月間）\' WHERE `query_id` =5 LIMIT 1;'),(6,'mysql_zencart.sql','REASON_TABLE_NOT_FOUND CHECK PREFIXES!','2009-11-19 12:39:41','UPDATE `query_builder` SET `query_name` = \'管理者\' WHERE `query_id` =6 LIMIT 1;');
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
-- Dumping data for table `visitors`
--

LOCK TABLES `visitors` WRITE;
/*!40000 ALTER TABLE `visitors` DISABLE KEYS */;
INSERT INTO `visitors` VALUES (2,'saito@ark-web.jp','2009-11-19 15:19:04',NULL);
/*!40000 ALTER TABLE `visitors` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `whos_online`
--

LOCK TABLES `whos_online` WRITE;
/*!40000 ALTER TABLE `whos_online` DISABLE KEYS */;
INSERT INTO `whos_online` VALUES (0,'&yen;Guest','n4oi1c21jmqu2o2be1ddtvfv77','192.168.0.115','1258626939','1258627242','/ohtsuji/zencart-sugu/index.php?main_page=login','pc115.local','Mozilla/5.0 (Windows; U; Windows NT 5.1; ja; rv:1.9.1.5) Gecko/20091102 Firefox/3.5.5 (.NET CLR 3.5.30729)');
/*!40000 ALTER TABLE `whos_online` ENABLE KEYS */;
UNLOCK TABLES;

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
INSERT INTO `zones` VALUES (1,223,'AL','Alabama'),(2,223,'AK','Alaska'),(3,223,'AS','American Samoa'),(4,223,'AZ','Arizona'),(5,223,'AR','Arkansas'),(6,223,'AF','Armed Forces Africa'),(7,223,'AA','Armed Forces Americas'),(8,223,'AC','Armed Forces Canada'),(9,223,'AE','Armed Forces Europe'),(10,223,'AM','Armed Forces Middle East'),(11,223,'AP','Armed Forces Pacific'),(12,223,'CA','California'),(13,223,'CO','Colorado'),(14,223,'CT','Connecticut'),(15,223,'DE','Delaware'),(16,223,'DC','District of Columbia'),(17,223,'FM','Federated States Of Micronesia'),(18,223,'FL','Florida'),(19,223,'GA','Georgia'),(20,223,'GU','Guam'),(21,223,'HI','Hawaii'),(22,223,'ID','Idaho'),(23,223,'IL','Illinois'),(24,223,'IN','Indiana'),(25,223,'IA','Iowa'),(26,223,'KS','Kansas'),(27,223,'KY','Kentucky'),(28,223,'LA','Louisiana'),(29,223,'ME','Maine'),(30,223,'MH','Marshall Islands'),(31,223,'MD','Maryland'),(32,223,'MA','Massachusetts'),(33,223,'MI','Michigan'),(34,223,'MN','Minnesota'),(35,223,'MS','Mississippi'),(36,223,'MO','Missouri'),(37,223,'MT','Montana'),(38,223,'NE','Nebraska'),(39,223,'NV','Nevada'),(40,223,'NH','New Hampshire'),(41,223,'NJ','New Jersey'),(42,223,'NM','New Mexico'),(43,223,'NY','New York'),(44,223,'NC','North Carolina'),(45,223,'ND','North Dakota'),(46,223,'MP','Northern Mariana Islands'),(47,223,'OH','Ohio'),(48,223,'OK','Oklahoma'),(49,223,'OR','Oregon'),(50,223,'PW','Palau'),(51,223,'PA','Pennsylvania'),(52,223,'PR','Puerto Rico'),(53,223,'RI','Rhode Island'),(54,223,'SC','South Carolina'),(55,223,'SD','South Dakota'),(56,223,'TN','Tennessee'),(57,223,'TX','Texas'),(58,223,'UT','Utah'),(59,223,'VT','Vermont'),(60,223,'VI','Virgin Islands'),(61,223,'VA','Virginia'),(62,223,'WA','Washington'),(63,223,'WV','West Virginia'),(64,223,'WI','Wisconsin'),(65,223,'WY','Wyoming'),(66,38,'AB','Alberta'),(67,38,'BC','British Columbia'),(68,38,'MB','Manitoba'),(69,38,'NF','Newfoundland'),(70,38,'NB','New Brunswick'),(71,38,'NS','Nova Scotia'),(72,38,'NT','Northwest Territories'),(73,38,'NU','Nunavut'),(74,38,'ON','Ontario'),(75,38,'PE','Prince Edward Island'),(76,38,'QC','Quebec'),(77,38,'SK','Saskatchewan'),(78,38,'YT','Yukon Territory'),(79,81,'NDS','Niedersachsen'),(80,81,'BAW','Baden-Wrttemberg'),(81,81,'BAY','Bayern'),(82,81,'BER','Berlin'),(83,81,'BRG','Brandenburg'),(84,81,'BRE','Bremen'),(85,81,'HAM','Hamburg'),(86,81,'HES','Hessen'),(87,81,'MEC','Mecklenburg-Vorpommern'),(88,81,'NRW','Nordrhein-Westfalen'),(89,81,'RHE','Rheinland-Pfalz'),(90,81,'SAR','Saarland'),(91,81,'SAS','Sachsen'),(92,81,'SAC','Sachsen-Anhalt'),(93,81,'SCN','Schleswig-Holstein'),(94,81,'THE','Thringen'),(95,14,'WI','Wien'),(96,14,'NO','Niedersterreich'),(97,14,'OO','Obersterreich'),(98,14,'SB','Salzburg'),(99,14,'KN','Kten'),(100,14,'ST','Steiermark'),(101,14,'TI','Tirol'),(102,14,'BL','Burgenland'),(103,14,'VB','Voralberg'),(104,204,'AG','Aargau'),(105,204,'AI','Appenzell Innerrhoden'),(106,204,'AR','Appenzell Ausserrhoden'),(107,204,'BE','Bern'),(108,204,'BL','Basel-Landschaft'),(109,204,'BS','Basel-Stadt'),(110,204,'FR','Freiburg'),(111,204,'GE','Genf'),(112,204,'GL','Glarus'),(113,204,'JU','Graubnden'),(114,204,'JU','Jura'),(115,204,'LU','Luzern'),(116,204,'NE','Neuenburg'),(117,204,'NW','Nidwalden'),(118,204,'OW','Obwalden'),(119,204,'SG','St. Gallen'),(120,204,'SH','Schaffhausen'),(121,204,'SO','Solothurn'),(122,204,'SZ','Schwyz'),(123,204,'TG','Thurgau'),(124,204,'TI','Tessin'),(125,204,'UR','Uri'),(126,204,'VD','Waadt'),(127,204,'VS','Wallis'),(128,204,'ZG','Zug'),(129,204,'ZH','Zrich'),(130,195,'A Corua','A Corua'),(131,195,'Alava','Alava'),(132,195,'Albacete','Albacete'),(133,195,'Alicante','Alicante'),(134,195,'Almeria','Almeria'),(135,195,'Asturias','Asturias'),(136,195,'Avila','Avila'),(137,195,'Badajoz','Badajoz'),(138,195,'Baleares','Baleares'),(139,195,'Barcelona','Barcelona'),(140,195,'Burgos','Burgos'),(141,195,'Caceres','Caceres'),(142,195,'Cadiz','Cadiz'),(143,195,'Cantabria','Cantabria'),(144,195,'Castellon','Castellon'),(145,195,'Ceuta','Ceuta'),(146,195,'Ciudad Real','Ciudad Real'),(147,195,'Cordoba','Cordoba'),(148,195,'Cuenca','Cuenca'),(149,195,'Girona','Girona'),(150,195,'Granada','Granada'),(151,195,'Guadalajara','Guadalajara'),(152,195,'Guipuzcoa','Guipuzcoa'),(153,195,'Huelva','Huelva'),(154,195,'Huesca','Huesca'),(155,195,'Jaen','Jaen'),(156,195,'La Rioja','La Rioja'),(157,195,'Las Palmas','Las Palmas'),(158,195,'Leon','Leon'),(159,195,'Lleida','Lleida'),(160,195,'Lugo','Lugo'),(161,195,'Madrid','Madrid'),(162,195,'Malaga','Malaga'),(163,195,'Melilla','Melilla'),(164,195,'Murcia','Murcia'),(165,195,'Navarra','Navarra'),(166,195,'Ourense','Ourense'),(167,195,'Palencia','Palencia'),(168,195,'Pontevedra','Pontevedra'),(169,195,'Salamanca','Salamanca'),(170,195,'Santa Cruz de Tenerife','Santa Cruz de Tenerife'),(171,195,'Segovia','Segovia'),(172,195,'Sevilla','Sevilla'),(173,195,'Soria','Soria'),(174,195,'Tarragona','Tarragona'),(175,195,'Teruel','Teruel'),(176,195,'Toledo','Toledo'),(177,195,'Valencia','Valencia'),(178,195,'Valladolid','Valladolid'),(179,195,'Vizcaya','Vizcaya'),(180,195,'Zamora','Zamora'),(181,195,'Zaragoza','Zaragoza'),(182,107,'北海道','北海道'),(183,107,'青森県','青森県'),(184,107,'岩手県','岩手県'),(185,107,'宮城県','宮城県'),(186,107,'秋田県','秋田県'),(187,107,'山形県','山形県'),(188,107,'福島県','福島県'),(189,107,'茨城県','茨城県'),(190,107,'栃木県','栃木県'),(191,107,'群馬県','群馬県'),(192,107,'埼玉県','埼玉県'),(193,107,'千葉県','千葉県'),(194,107,'東京都','東京都'),(195,107,'神奈川県','神奈川県'),(196,107,'新潟県','新潟県'),(197,107,'富山県','富山県'),(198,107,'石川県','石川県'),(199,107,'福井県','福井県'),(200,107,'山梨県','山梨県'),(201,107,'長野県','長野県'),(202,107,'岐阜県','岐阜県'),(203,107,'静岡県','静岡県'),(204,107,'愛知県','愛知県'),(205,107,'三重県','三重県'),(206,107,'滋賀県','滋賀県'),(207,107,'京都府','京都府'),(208,107,'大阪府','大阪府'),(209,107,'兵庫県','兵庫県'),(210,107,'奈良県','奈良県'),(211,107,'和歌山県','和歌山県'),(212,107,'鳥取県','鳥取県'),(213,107,'島根県','島根県'),(214,107,'岡山県','岡山県'),(215,107,'広島県','広島県'),(216,107,'山口県','山口県'),(217,107,'徳島県','徳島県'),(218,107,'香川県','香川県'),(219,107,'愛媛県','愛媛県'),(220,107,'高知県','高知県'),(221,107,'福岡県','福岡県'),(222,107,'佐賀県','佐賀県'),(223,107,'長崎県','長崎県'),(224,107,'熊本県','熊本県'),(225,107,'大分県','大分県'),(226,107,'宮崎県','宮崎県'),(227,107,'鹿児島県','鹿児島県'),(228,107,'沖縄県','沖縄県');
/*!40000 ALTER TABLE `zones` ENABLE KEYS */;
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

