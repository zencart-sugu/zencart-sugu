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
-- Table structure for table address_book
--

DROP TABLE IF EXISTS address_book;
CREATE TABLE address_book (
address_book_id int(11) NOT NULL auto_increment,
customers_id int(11) NOT NULL default '0',
entry_gender char(1) NOT NULL default '',
entry_company varchar(32) default NULL,
entry_firstname varchar(32) NOT NULL default '',
entry_lastname varchar(32) NOT NULL default '',
entry_street_address varchar(64) NOT NULL default '',
entry_suburb varchar(32) default NULL,
entry_postcode varchar(10) NOT NULL default '',
entry_city varchar(32) NOT NULL default '',
entry_state varchar(32) default NULL,
entry_country_id int(11) NOT NULL default '0',
entry_zone_id int(11) NOT NULL default '0',
entry_telephone varchar(32) NOT NULL default '',
entry_fax varchar(32) default NULL,
entry_firstname_kana varchar(32) NOT NULL default '',
entry_lastname_kana varchar(32) NOT NULL default '',
PRIMARY KEY  (address_book_id),
KEY idx_address_book_customers_id_zen (customers_id)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=ujis;

--
-- Dumping data for table address_book
--


--
-- Table structure for table address_format
--

DROP TABLE IF EXISTS address_format;
CREATE TABLE address_format (
address_format_id int(11) NOT NULL auto_increment,
address_format varchar(128) NOT NULL default '',
address_summary varchar(48) NOT NULL default '',
PRIMARY KEY  (address_format_id)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=ujis;

--
-- Dumping data for table address_format
--

INSERT INTO address_format VALUES (1,'$firstname $lastname$cr$streets$cr$city, $postcode$cr$statecomma$country','$city / $country');
INSERT INTO address_format VALUES (2,'$firstname $lastname$cr$streets$cr$city, $state    $postcode$cr$country','$city, $state / $country');
INSERT INTO address_format VALUES (3,'$firstname $lastname$cr$streets$cr$city$cr$postcode - $statecomma$country','$state / $country');
INSERT INTO address_format VALUES (4,'$firstname $lastname$cr$streets$cr$city ($postcode)$cr$country','$postcode / $country');
INSERT INTO address_format VALUES (5,'$firstname $lastname$cr$streets$cr$postcode $city$cr$country','$city / $country');
INSERT INTO address_format VALUES (6,'$firstname $lastname$cr$postcode$cr$state$city$cr$streets$cr$country$cr$telephone$cr$fax','$statename $city');

--
-- Table structure for table admin
--

DROP TABLE IF EXISTS admin;
CREATE TABLE admin (
admin_id int(11) NOT NULL auto_increment,
admin_name varchar(32) NOT NULL default '',
admin_email varchar(96) NOT NULL default '',
admin_pass varchar(40) NOT NULL default '',
admin_level tinyint(1) NOT NULL default '1',
PRIMARY KEY  (admin_id),
KEY idx_admin_name_zen (admin_name)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=ujis;

--
-- Dumping data for table admin
--

INSERT INTO admin VALUES (1,'admin','hachiya@ark-web.jp','d367f03201e84bb4cfd137da723fc4a0:ae',1);

--
-- Table structure for table admin_acl
--

DROP TABLE IF EXISTS admin_acl;
CREATE TABLE admin_acl (
acl_id int(11) NOT NULL auto_increment,
admin_id int(11) NOT NULL default '0',
easy_admin_top_menu_id int(11) NOT NULL default '0',
easy_admin_sub_menu_id int(11) NOT NULL default '0',
PRIMARY KEY  (acl_id)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table admin_acl
--


--
-- Table structure for table admin_activity_log
--

DROP TABLE IF EXISTS admin_activity_log;
CREATE TABLE admin_activity_log (
log_id int(15) NOT NULL auto_increment,
access_date datetime NOT NULL default '0001-01-01 00:00:00',
admin_id int(11) NOT NULL default '0',
page_accessed varchar(80) NOT NULL default '',
page_parameters varchar(150) default NULL,
ip_address varchar(15) NOT NULL default '',
PRIMARY KEY  (log_id),
KEY idx_page_accessed_zen (page_accessed),
KEY idx_access_date_zen (access_date),
KEY idx_ip_zen (ip_address)
) ENGINE=MyISAM AUTO_INCREMENT=2410 DEFAULT CHARSET=ujis;

--
-- Dumping data for table admin_activity_log
--


--
-- Table structure for table authorizenet
--

DROP TABLE IF EXISTS authorizenet;
CREATE TABLE authorizenet (
id int(11) unsigned NOT NULL auto_increment,
customer_id int(11) NOT NULL default '0',
order_id int(11) NOT NULL default '0',
response_code int(1) NOT NULL default '0',
response_text varchar(255) NOT NULL default '',
authorization_type text NOT NULL,
transaction_id int(15) NOT NULL default '0',
sent longtext NOT NULL,
received longtext NOT NULL,
time varchar(50) NOT NULL default '',
session_id varchar(255) NOT NULL default '',
UNIQUE KEY idx_auth_net_id (id)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table authorizenet
--


--
-- Table structure for table banners
--

DROP TABLE IF EXISTS banners;
CREATE TABLE banners (
banners_id int(11) NOT NULL auto_increment,
banners_title varchar(64) NOT NULL default '',
banners_url varchar(255) NOT NULL default '',
banners_image varchar(64) NOT NULL default '',
banners_group varchar(15) NOT NULL default '',
banners_html_text text,
expires_impressions int(7) default '0',
expires_date datetime default NULL,
date_scheduled datetime default NULL,
date_added datetime NOT NULL default '0001-01-01 00:00:00',
date_status_change datetime default NULL,
status int(1) NOT NULL default '1',
banners_open_new_windows int(1) NOT NULL default '1',
banners_on_ssl int(1) NOT NULL default '1',
banners_sort_order int(11) NOT NULL default '0',
PRIMARY KEY  (banners_id),
KEY idx_status_group_zen (status,banners_group)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=ujis;

--
-- Dumping data for table banners
--

INSERT INTO banners VALUES (1,'Zen Cart','http://www.zen-cart.com','banners/zencart_468_60_02.gif','Wide-Banners','',0,NULL,NULL,'2004-01-11 20:59:12',NULL,1,1,1,0);
INSERT INTO banners VALUES (2,'Zen Cart the art of e-commerce','http://www.zen-cart.com','banners/125zen_logo.gif','SideBox-Banners','',0,NULL,NULL,'2004-01-11 20:59:12',NULL,1,1,1,0);
INSERT INTO banners VALUES (3,'Zen Cart the art of e-commerce','http://www.zen-cart.com','banners/125x125_zen_logo.gif','SideBox-Banners','',0,NULL,NULL,'2004-01-11 20:59:12',NULL,1,1,1,0);
INSERT INTO banners VALUES (4,'if you have to think ... you haven\'t been Zenned!','http://www.zen-cart.com','banners/think_anim.gif','Wide-Banners','',0,NULL,NULL,'2004-01-12 20:53:18',NULL,1,1,1,0);
INSERT INTO banners VALUES (5,'Sashbox.net - the ultimate e-commerce hosting solution','http://www.sashbox.net/zencart/','banners/sashbox_125x50.jpg','BannersAll','',0,NULL,NULL,'2005-05-13 10:53:50',NULL,1,1,1,20);
INSERT INTO banners VALUES (6,'Zen Cart the art of e-commerce','http://www.zen-cart.com','banners/bw_zen_88wide.gif','BannersAll','',0,NULL,NULL,'2005-05-13 10:54:38',NULL,1,1,1,10);
INSERT INTO banners VALUES (7,'Sashbox.net - the ultimate e-commerce hosting solution','http://www.sashbox.net/zencart/','banners/sashbox_468x60.jpg','Wide-Banners','',0,NULL,NULL,'2005-05-13 10:55:11',NULL,1,1,1,0);
INSERT INTO banners VALUES (8,'Start Accepting Credit Cards For Your Business Today!','http://www.zen-cart.com/modules/freecontent/index.php?id=29','banners/cardsvcs_468x60.gif','Wide-Banners','',0,NULL,NULL,'2006-03-13 11:02:43',NULL,1,1,1,0);

--
-- Table structure for table banners_history
--

DROP TABLE IF EXISTS banners_history;
CREATE TABLE banners_history (
banners_history_id int(11) NOT NULL auto_increment,
banners_id int(11) NOT NULL default '0',
banners_shown int(5) NOT NULL default '0',
banners_clicked int(5) NOT NULL default '0',
banners_history_date datetime NOT NULL default '0001-01-01 00:00:00',
PRIMARY KEY  (banners_history_id),
KEY idx_banners_id_zen (banners_id)
) ENGINE=MyISAM AUTO_INCREMENT=65 DEFAULT CHARSET=ujis;

--
-- Dumping data for table banners_history
--


--
-- Table structure for table blocks
--

DROP TABLE IF EXISTS blocks;
CREATE TABLE blocks (
id int(11) NOT NULL auto_increment,
module varchar(64) NOT NULL default '',
block varchar(64) NOT NULL default '',
template varchar(64) NOT NULL default '',
status tinyint(1) NOT NULL default '0',
location varchar(64) NOT NULL default '',
sort_order int(11) NOT NULL default '0',
visible tinyint(1) NOT NULL default '0',
pages text NOT NULL,
PRIMARY KEY  (id),
UNIQUE KEY UNQ_module_block_template (module,block,template),
KEY IDX_module_template_status_location_sort_order (module,template,status,location,sort_order)
) ENGINE=MyISAM AUTO_INCREMENT=186 DEFAULT CHARSET=ujis;

--
-- Dumping data for table blocks
--

INSERT INTO blocks VALUES (1,'sideboxes','banner_box.php','classic',0,'',0,0,'');
INSERT INTO blocks VALUES (2,'sideboxes','banner_box2.php','classic',0,'',0,0,'');
INSERT INTO blocks VALUES (3,'sideboxes','banner_box_all.php','classic',0,'',0,0,'');
INSERT INTO blocks VALUES (4,'sideboxes','best_sellers.php','classic',0,'',0,0,'');
INSERT INTO blocks VALUES (5,'sideboxes','categories.php','classic',0,'',0,0,'');
INSERT INTO blocks VALUES (6,'sideboxes','currencies.php','classic',0,'',0,0,'');
INSERT INTO blocks VALUES (7,'sideboxes','document_categories.php','classic',0,'',0,0,'');
INSERT INTO blocks VALUES (8,'sideboxes','ezpages.php','classic',0,'',0,0,'');
INSERT INTO blocks VALUES (9,'sideboxes','featured.php','classic',0,'',0,0,'');
INSERT INTO blocks VALUES (10,'sideboxes','information.php','classic',0,'',0,0,'');
INSERT INTO blocks VALUES (11,'sideboxes','languages.php','classic',0,'',0,0,'');
INSERT INTO blocks VALUES (12,'sideboxes','manufacturer_info.php','classic',0,'',0,0,'');
INSERT INTO blocks VALUES (13,'sideboxes','manufacturers.php','classic',0,'',0,0,'');
INSERT INTO blocks VALUES (14,'sideboxes','more_information.php','classic',0,'',0,0,'');
INSERT INTO blocks VALUES (15,'sideboxes','music_genres.php','classic',0,'',0,0,'');
INSERT INTO blocks VALUES (16,'sideboxes','order_history.php','classic',0,'',0,0,'');
INSERT INTO blocks VALUES (17,'sideboxes','product_notifications.php','classic',0,'',0,0,'');
INSERT INTO blocks VALUES (18,'sideboxes','record_companies.php','classic',0,'',0,0,'');
INSERT INTO blocks VALUES (19,'sideboxes','reviews.php','classic',0,'',0,0,'');
INSERT INTO blocks VALUES (20,'sideboxes','search.php','classic',0,'',0,0,'');
INSERT INTO blocks VALUES (21,'sideboxes','search_header.php','classic',0,'',0,0,'');
INSERT INTO blocks VALUES (22,'sideboxes','shopping_cart.php','classic',0,'',0,0,'');
INSERT INTO blocks VALUES (23,'sideboxes','specials.php','classic',0,'',0,0,'');
INSERT INTO blocks VALUES (24,'sideboxes','tell_a_friend.php','classic',0,'',0,0,'');
INSERT INTO blocks VALUES (25,'sideboxes','whats_new.php','classic',0,'',0,0,'');
INSERT INTO blocks VALUES (26,'sideboxes','whos_online.php','classic',0,'',0,0,'');
INSERT INTO blocks VALUES (28,'globalnavi','block','classic',0,'',0,0,'');
INSERT INTO blocks VALUES (29,'sideboxes','banner_box.php','addon_modules',0,'',0,0,'');
INSERT INTO blocks VALUES (30,'sideboxes','banner_box2.php','addon_modules',0,'',0,0,'');
INSERT INTO blocks VALUES (31,'sideboxes','banner_box_all.php','addon_modules',0,'',0,0,'');
INSERT INTO blocks VALUES (32,'sideboxes','best_sellers.php','addon_modules',0,'',0,0,'');
INSERT INTO blocks VALUES (33,'sideboxes','categories.php','addon_modules',0,'',0,0,'');
INSERT INTO blocks VALUES (34,'sideboxes','currencies.php','addon_modules',0,'',0,0,'');
INSERT INTO blocks VALUES (35,'sideboxes','document_categories.php','addon_modules',0,'',0,0,'');
INSERT INTO blocks VALUES (36,'sideboxes','ezpages.php','addon_modules',0,'',0,0,'');
INSERT INTO blocks VALUES (37,'sideboxes','featured.php','addon_modules',0,'',0,0,'');
INSERT INTO blocks VALUES (38,'sideboxes','information.php','addon_modules',0,'',0,0,'');
INSERT INTO blocks VALUES (39,'sideboxes','languages.php','addon_modules',0,'',0,0,'');
INSERT INTO blocks VALUES (40,'sideboxes','manufacturer_info.php','addon_modules',0,'',0,0,'');
INSERT INTO blocks VALUES (41,'sideboxes','manufacturers.php','addon_modules',0,'',0,0,'');
INSERT INTO blocks VALUES (42,'sideboxes','more_information.php','addon_modules',0,'',0,0,'');
INSERT INTO blocks VALUES (43,'sideboxes','music_genres.php','addon_modules',0,'',0,0,'');
INSERT INTO blocks VALUES (44,'sideboxes','order_history.php','addon_modules',0,'',0,0,'');
INSERT INTO blocks VALUES (45,'sideboxes','product_notifications.php','addon_modules',0,'',0,0,'');
INSERT INTO blocks VALUES (46,'sideboxes','record_companies.php','addon_modules',0,'',0,0,'');
INSERT INTO blocks VALUES (47,'sideboxes','reviews.php','addon_modules',0,'',0,0,'');
INSERT INTO blocks VALUES (48,'sideboxes','search.php','addon_modules',0,'',0,0,'');
INSERT INTO blocks VALUES (49,'sideboxes','search_header.php','addon_modules',0,'',0,0,'');
INSERT INTO blocks VALUES (50,'sideboxes','shopping_cart.php','addon_modules',0,'',0,0,'');
INSERT INTO blocks VALUES (51,'sideboxes','specials.php','addon_modules',0,'',0,0,'');
INSERT INTO blocks VALUES (52,'sideboxes','tell_a_friend.php','addon_modules',0,'',0,0,'');
INSERT INTO blocks VALUES (53,'sideboxes','whats_new.php','addon_modules',0,'',0,0,'');
INSERT INTO blocks VALUES (54,'sideboxes','whos_online.php','addon_modules',0,'',0,0,'');
INSERT INTO blocks VALUES (55,'globalnavi','block','addon_modules',0,'',0,0,'');
INSERT INTO blocks VALUES (70,'carousel_ui','block_featured_products','addon_modules',0,'',0,0,'');
INSERT INTO blocks VALUES (71,'carousel_ui','block_specials_products','addon_modules',0,'',0,0,'');
INSERT INTO blocks VALUES (72,'carousel_ui','block_also_purchased_products','addon_modules',0,'',0,0,'');
INSERT INTO blocks VALUES (73,'carousel_ui','block_xsell_products','addon_modules',0,'',0,0,'');
INSERT INTO blocks VALUES (61,'multiple_image_view','block','addon_modules',0,'',0,1,'product_free_shipping_info\nproduct_info\nproduct_music_info');
INSERT INTO blocks VALUES (62,'multiple_image_view','block_expd','addon_modules',0,'',0,0,'');
INSERT INTO blocks VALUES (63,'multiple_image_view','block_thmb','addon_modules',0,'',0,0,'');
INSERT INTO blocks VALUES (81,'search_more','block_sort','addon_modules',0,'',0,0,'');
INSERT INTO blocks VALUES (80,'search_more','block_par_page','addon_modules',0,'',0,0,'');
INSERT INTO blocks VALUES (69,'carousel_ui','block_new_products','addon_modules',0,'',0,0,'');
INSERT INTO blocks VALUES (79,'search_more','block_search_form','addon_modules',0,'',0,0,'');
INSERT INTO blocks VALUES (78,'search_more','block','addon_modules',0,'',0,0,'');
INSERT INTO blocks VALUES (82,'sideboxes','banner_box.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO blocks VALUES (83,'sideboxes','banner_box2.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO blocks VALUES (84,'sideboxes','banner_box_all.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO blocks VALUES (85,'sideboxes','best_sellers.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO blocks VALUES (86,'sideboxes','categories.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO blocks VALUES (87,'sideboxes','currencies.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO blocks VALUES (88,'sideboxes','document_categories.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO blocks VALUES (89,'sideboxes','ezpages.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO blocks VALUES (90,'sideboxes','featured.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO blocks VALUES (91,'sideboxes','information.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO blocks VALUES (92,'sideboxes','languages.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO blocks VALUES (93,'sideboxes','manufacturer_info.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO blocks VALUES (94,'sideboxes','manufacturers.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO blocks VALUES (95,'sideboxes','more_information.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO blocks VALUES (96,'sideboxes','music_genres.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO blocks VALUES (97,'sideboxes','order_history.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO blocks VALUES (98,'sideboxes','product_notifications.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO blocks VALUES (99,'sideboxes','record_companies.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO blocks VALUES (100,'sideboxes','reviews.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO blocks VALUES (101,'sideboxes','search.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO blocks VALUES (102,'sideboxes','search_header.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO blocks VALUES (103,'sideboxes','shopping_cart.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO blocks VALUES (104,'sideboxes','specials.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO blocks VALUES (105,'sideboxes','tell_a_friend.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO blocks VALUES (106,'sideboxes','whats_new.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO blocks VALUES (107,'sideboxes','whos_online.php','accessible_and_usable',0,'',0,0,'');
INSERT INTO blocks VALUES (108,'carousel_ui','block_new_products','accessible_and_usable',0,'',0,0,'');
INSERT INTO blocks VALUES (109,'carousel_ui','block_featured_products','accessible_and_usable',0,'',0,0,'');
INSERT INTO blocks VALUES (110,'carousel_ui','block_specials_products','accessible_and_usable',0,'',0,0,'');
INSERT INTO blocks VALUES (111,'carousel_ui','block_also_purchased_products','accessible_and_usable',0,'',0,0,'');
INSERT INTO blocks VALUES (112,'carousel_ui','block_xsell_products','accessible_and_usable',0,'',0,0,'');
INSERT INTO blocks VALUES (113,'globalnavi','block','accessible_and_usable',0,'',0,0,'');
INSERT INTO blocks VALUES (114,'multiple_image_view','block','accessible_and_usable',0,'',0,0,'');
INSERT INTO blocks VALUES (115,'multiple_image_view','block_expd','accessible_and_usable',0,'',0,0,'');
INSERT INTO blocks VALUES (116,'multiple_image_view','block_thmb','accessible_and_usable',0,'',0,0,'');
INSERT INTO blocks VALUES (117,'search_more','block','accessible_and_usable',1,'main_bottom',0,0,'');
INSERT INTO blocks VALUES (118,'search_more','block_search_form','accessible_and_usable',0,'',0,0,'');
INSERT INTO blocks VALUES (119,'search_more','block_par_page','accessible_and_usable',0,'',0,0,'');
INSERT INTO blocks VALUES (120,'search_more','block_sort','accessible_and_usable',0,'',0,0,'');
INSERT INTO blocks VALUES (121,'sideboxes','banner_box.php','sugudeki',0,'',0,0,'');
INSERT INTO blocks VALUES (122,'sideboxes','banner_box2.php','sugudeki',0,'',0,0,'');
INSERT INTO blocks VALUES (123,'sideboxes','banner_box_all.php','sugudeki',1,'sidebar_left',2,0,'checkout_confirmation\ncheckout_payment\ncheckout_payment_address\ncheckout_shipping\ncheckout_shipping_address\ncheckout_success\ncreate_account\ncreate_account_success\nlogin\nlogoff\npassword_forgotten\nshopping_cart\nvisitors#page_create_visitor\nvisitors#page_visitor_edit\nvisitors#page_visitor_to_account');
INSERT INTO blocks VALUES (124,'sideboxes','best_sellers.php','sugudeki',1,'sidebar_right',0,1,'index');
INSERT INTO blocks VALUES (125,'sideboxes','categories.php','sugudeki',0,'',0,0,'');
INSERT INTO blocks VALUES (126,'sideboxes','currencies.php','sugudeki',0,'',0,0,'');
INSERT INTO blocks VALUES (127,'sideboxes','document_categories.php','sugudeki',0,'',0,0,'');
INSERT INTO blocks VALUES (128,'sideboxes','ezpages.php','sugudeki',0,'',0,0,'');
INSERT INTO blocks VALUES (129,'sideboxes','featured.php','sugudeki',0,'',0,0,'');
INSERT INTO blocks VALUES (130,'sideboxes','information.php','sugudeki',0,'',0,0,'');
INSERT INTO blocks VALUES (131,'sideboxes','languages.php','sugudeki',0,'',0,0,'');
INSERT INTO blocks VALUES (132,'sideboxes','manufacturer_info.php','sugudeki',0,'',0,0,'');
INSERT INTO blocks VALUES (133,'sideboxes','manufacturers.php','sugudeki',0,'',0,0,'');
INSERT INTO blocks VALUES (134,'sideboxes','more_information.php','sugudeki',0,'',0,0,'');
INSERT INTO blocks VALUES (135,'sideboxes','music_genres.php','sugudeki',0,'',0,0,'');
INSERT INTO blocks VALUES (136,'sideboxes','order_history.php','sugudeki',0,'',0,0,'');
INSERT INTO blocks VALUES (137,'sideboxes','product_notifications.php','sugudeki',0,'',0,0,'');
INSERT INTO blocks VALUES (138,'sideboxes','record_companies.php','sugudeki',0,'',0,0,'');
INSERT INTO blocks VALUES (139,'sideboxes','reviews.php','sugudeki',1,'main_bottom',0,1,'product_info');
INSERT INTO blocks VALUES (140,'sideboxes','search.php','sugudeki',1,'header',0,0,'');
INSERT INTO blocks VALUES (141,'sideboxes','search_header.php','sugudeki',0,'',0,0,'');
INSERT INTO blocks VALUES (142,'sideboxes','shopping_cart.php','sugudeki',0,'',1,0,'');
INSERT INTO blocks VALUES (143,'sideboxes','specials.php','sugudeki',0,'',0,0,'');
INSERT INTO blocks VALUES (144,'sideboxes','tell_a_friend.php','sugudeki',0,'',0,0,'');
INSERT INTO blocks VALUES (145,'sideboxes','whats_new.php','sugudeki',0,'',0,0,'');
INSERT INTO blocks VALUES (146,'sideboxes','whos_online.php','sugudeki',0,'',0,0,'');
INSERT INTO blocks VALUES (147,'aboutbox','block','sugudeki',1,'footer',1,0,'');
INSERT INTO blocks VALUES (148,'ajax_category_tree','block','sugudeki',1,'sidebar_left',0,0,'checkout_confirmation\ncheckout_payment\ncheckout_payment_address\ncheckout_shipping\ncheckout_shipping_address\ncheckout_success\ncreate_account\ncreate_account_success\nlogin\nlogoff\npassword_forgotten\nshopping_cart\nvisitors#page_create_visitor\nvisitors#page_visitor_edit\nvisitors#page_visitor_to_account');
INSERT INTO blocks VALUES (149,'calendar','block','sugudeki',0,'',0,0,'');
INSERT INTO blocks VALUES (150,'calendar','block_desired_delivery_date','sugudeki',0,'',0,0,'');
INSERT INTO blocks VALUES (151,'calendar','block_desired_delivery_time','sugudeki',0,'',0,0,'');
INSERT INTO blocks VALUES (152,'calendar','block_delivery_info','sugudeki',0,'',0,0,'');
INSERT INTO blocks VALUES (153,'carousel_ui','block_new_products','sugudeki',0,'',0,0,'');
INSERT INTO blocks VALUES (154,'carousel_ui','block_featured_products','sugudeki',0,'',0,0,'');
INSERT INTO blocks VALUES (155,'carousel_ui','block_specials_products','sugudeki',0,'',0,0,'');
INSERT INTO blocks VALUES (156,'carousel_ui','block_also_purchased_products','sugudeki',1,'main_bottom',1,1,'product_info');
INSERT INTO blocks VALUES (157,'carousel_ui','block_xsell_products','sugudeki',1,'main_bottom',2,1,'product_info');
INSERT INTO blocks VALUES (181,'easy_admin','block','sugudeki',0,'',0,0,'');
INSERT INTO blocks VALUES (182,'easy_admin','block_right_top_menu','sugudeki',0,'',0,0,'');
INSERT INTO blocks VALUES (162,'globalnavi','block','sugudeki',0,'',0,0,'');
INSERT INTO blocks VALUES (163,'multiple_image_view','block','sugudeki',0,'',0,0,'');
INSERT INTO blocks VALUES (164,'multiple_image_view','block_expd','sugudeki',0,'',0,0,'');
INSERT INTO blocks VALUES (165,'multiple_image_view','block_thmb','sugudeki',0,'',0,0,'');
INSERT INTO blocks VALUES (166,'search_more','block','sugudeki',1,'main_top',10,1,'index_products');
INSERT INTO blocks VALUES (167,'search_more','block_search_form','sugudeki',0,'',0,0,'');
INSERT INTO blocks VALUES (168,'search_more','block_par_page','sugudeki',0,'',0,0,'');
INSERT INTO blocks VALUES (169,'search_more','block_sort','sugudeki',0,'',0,0,'');
INSERT INTO blocks VALUES (170,'category_sitemap','block','sugudeki',1,'footer',0,0,'');
INSERT INTO blocks VALUES (171,'checkout_step','block','sugudeki',1,'main_top',0,1,'checkout_confirmation\ncheckout_payment\ncheckout_payment_address\ncheckout_shipping\ncheckout_shipping_address\ncheckout_success');
INSERT INTO blocks VALUES (172,'easy_design','block','sugudeki',0,'',0,0,'');
INSERT INTO blocks VALUES (173,'products_with_attributes_stock','block','sugudeki',0,'',0,0,'');
INSERT INTO blocks VALUES (183,'easy_admin','block_dropdown_menu','sugudeki',0,'',0,0,'');
INSERT INTO blocks VALUES (175,'feature_area','block','sugudeki',0,'',0,0,'');
INSERT INTO blocks VALUES (176,'blog','block','sugudeki',0,'',0,0,'');
INSERT INTO blocks VALUES (185,'easy_admin_simplify','block','sugudeki',0,'',0,0,'');
INSERT INTO blocks VALUES (178,'point_base','block','sugudeki',1,'main_bottom',0,1,'account');
INSERT INTO blocks VALUES (180,'shopping_cart_summary','block','sugudeki',1,'header',1,0,'');
INSERT INTO blocks VALUES (184,'easy_reviews','block','sugudeki',0,'',0,0,'');

--
-- Table structure for table categories
--

DROP TABLE IF EXISTS categories;
CREATE TABLE categories (
categories_id int(11) NOT NULL auto_increment,
categories_image varchar(64) default NULL,
parent_id int(11) NOT NULL default '0',
sort_order int(3) default NULL,
date_added datetime default NULL,
last_modified datetime default NULL,
categories_status tinyint(1) NOT NULL default '1',
PRIMARY KEY  (categories_id),
KEY idx_parent_id_cat_id_zen (parent_id,categories_id),
KEY idx_status_zen (categories_status),
KEY idx_sort_order_zen (sort_order)
) ENGINE=MyISAM AUTO_INCREMENT=102 DEFAULT CHARSET=ujis;

--
-- Dumping data for table categories
--


--
-- Table structure for table categories_description
--

DROP TABLE IF EXISTS categories_description;
CREATE TABLE categories_description (
categories_id int(11) NOT NULL default '0',
language_id int(11) NOT NULL default '1',
categories_name varchar(32) NOT NULL default '',
categories_description text NOT NULL,
PRIMARY KEY  (categories_id,language_id),
KEY idx_categories_name_zen (categories_name)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table categories_description
--


--
-- Table structure for table configuration
--

DROP TABLE IF EXISTS configuration;
CREATE TABLE configuration (
configuration_id int(11) NOT NULL auto_increment,
configuration_title text NOT NULL,
configuration_key varchar(255) NOT NULL default '',
configuration_value text NOT NULL,
configuration_description text NOT NULL,
configuration_group_id int(11) NOT NULL default '0',
sort_order int(5) default NULL,
last_modified datetime default NULL,
date_added datetime NOT NULL default '0001-01-01 00:00:00',
use_function text,
set_function text,
PRIMARY KEY  (configuration_id),
UNIQUE KEY unq_config_key_zen (configuration_key),
KEY idx_key_value_zen (configuration_key,configuration_value(10)),
KEY idx_cfg_grp_id_zen (configuration_group_id)
) ENGINE=MyISAM AUTO_INCREMENT=1536 DEFAULT CHARSET=ujis;

--
-- Dumping data for table configuration
--

INSERT INTO configuration VALUES (1,'ショップ名','STORE_NAME','Zen商店','ショップ名を設定します。',1,1,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (2,'ショップオーナー名','STORE_OWNER','善太郎','ショップオーナー名(または運営管理者名)を設定します。',1,2,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (3,'国','STORE_COUNTRY','107','店舗が存在する国名を入力してください。<strong>注意：変更したら店舗のゾーンの更新を忘れずに行ってください。</strong>',1,6,NULL,'2009-11-19 12:39:39','zen_get_country_name','zen_cfg_pull_down_country_list(');
INSERT INTO configuration VALUES (4,'地域','STORE_ZONE','194','ショップの所在地域(県名)を設定します。',1,7,NULL,'2009-11-19 12:39:39','zen_cfg_get_zone_name','zen_cfg_pull_down_zone_list(');
INSERT INTO configuration VALUES (5,'入荷予定商品のソート順','EXPECTED_PRODUCTS_SORT','desc','入荷予定商品のソート順を設定します。<br /><br />\r\n・asc(昇順)<br />\r\n・desc(降順)',1,8,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'asc\', \'desc\'), ');
INSERT INTO configuration VALUES (6,'入荷予定商品のソート順に用いるフィールド','EXPECTED_PRODUCTS_FIELD','date_expected','入荷予定商品のソート順に使用するフィールドを設定します。<BR>・products_name:品名<BR>・date_expected:予定日',1,9,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'products_name\', \'date_expected\'), ');
INSERT INTO configuration VALUES (7,'表示言語と通貨の連動','USE_DEFAULT_LANGUAGE_CURRENCY','false','表示言語と通貨の変更を連動させるかどうか設定します。<br /><br />true(連動)<br />false(非連動)',1,10,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (8,'表示言語の選択','LANGUAGE_DEFAULT_SELECTOR','Default','ショップのデフォルトの表示言語はショップの初期設定またはユーザーのブラウザ設定のどちらに基づくかを設定します。<br /><br />デフォルト：ショップの初期設定',1,11,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'Default\', \'Browser\'), ');
INSERT INTO configuration VALUES (9,'サーチエンジンフレンドリーなURL表記(開発中)','SEARCH_ENGINE_FRIENDLY_URLS','false','サーチエンジンに拾われやすい、静的HTMLのようなURL表記を行うかどうかを設定します。<br /><br />注意：Googleでは動的URLのクロールが強化されたため、あまり意味はないようです。',6,12,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (10,'商品の追加後にカートを表示','DISPLAY_CART','true','商品をカートに追加した直後にカートの内容を表示するか、または元ページにすぐ戻るかを設定します。<br /><br />\r\n・true (表示)<br />\r\n・false (非表示)',1,14,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (11,'デフォルトの検索演算子','ADVANCED_SEARCH_DEFAULT_OPERATOR','and','デフォルトの検索演算子を設定します。',1,17,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'and\', \'or\'), ');
INSERT INTO configuration VALUES (12,'ショップの住所と電話番号','STORE_NAME_ADDRESS','Zen商店\r\n東京都中央区銀座1-1-1\r\n03-0000-0000','ショップ名、国名、住所、電話番号を設定します。',1,18,'2010-06-18 11:34:11','2009-11-19 12:39:39',NULL,'zen_cfg_textarea(');
INSERT INTO configuration VALUES (13,'カテゴリ内の商品数を表示','SHOW_COUNTS','true','カテゴリ内の商品数を下位カテゴリも含めてカウント表示するかどうかを設定します。<br /><br />\r\n・true (する)<br />\r\n・false (しない)',1,19,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (14,'税額の小数点位置','TAX_DECIMAL_PLACES','0','税額の小数点以下の桁数を設定します。',1,20,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (15,'価格を税込みで表示','DISPLAY_PRICE_WITH_TAX','true','価格を税込みで表示するかどうかを設定します。<br /><br />\r\n・true = 価格を税込みで表示<br />\r\n・false = 税額をまとめて表示',1,21,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (16,'価格を税込みで表示 - 管理画面','DISPLAY_PRICE_WITH_TAX_ADMIN','true','管理画面で価格を税込みで表示するかどうかを設定します。<br /><br />\r\n・true = 価格を税込みで表示<br />\r\n・false = 最後に税額を表示',1,21,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (17,'商品にかかる税額の算定基準','STORE_PRODUCT_TAX_BASIS','Shipping','商品にかかる税額を算出する際の基準を設定します。<br /><br />\r\n・Shipping …顧客(商品送付先)の住所<br />\r\n・Billing …顧客の請求先の住所<br />\r\n・Store …ショップの所在地による(送付先・請求先ともショップの所在地域である場合に有効)\r\n',1,21,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'Shipping\', \'Billing\', \'Store\'), ');
INSERT INTO configuration VALUES (18,'送料にかかる税額の算定基準','STORE_SHIPPING_TAX_BASIS','Shipping','送料にかかる税金を算出する際の基準を設定します。<br /><br />\r\n・Shipping …顧客(商品送付先)の住所<br />\r\n・Billing …顧客の請求先の住所<br />\r\n・Store …ショップの所在地による(送付先・請求先ともショップの所在地域である場合に有効)<br />\r\n注意：この設定は配送モジュールによってオーバーライド(上書き設定)が可能です。',1,21,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'Shipping\', \'Billing\', \'Store\'), ');
INSERT INTO configuration VALUES (19,'税金の表示','STORE_TAX_DISPLAY_STATUS','0','合計額が0円でも税金を表示しますか?<br />0= Off<br />1= On',1,21,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO configuration VALUES (20,'管理画面のタイムアウト設定(秒数)','SESSION_TIMEOUT_ADMIN','3600','管理画面がタイムアウトするまでの秒数を設定します。デフォルトは3600秒＝1時間です。<br />あまり短めに設定すると商品登録中などにタイムアウトしてしまいますので注意。<br />900秒未満を設定すると900秒に自動的に設定されます。',1,40,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (21,'管理画面のプログラム処理の上限時間設定(秒)\r\n','GLOBAL_SET_TIME_LIMIT','60','管理画面においてなんらかの操作を行った場合の、プログラム処理の強制終了時間を設定します。デフォルトは60秒＝1分。この設定は、プログラム処理時間に問題がある場合などにだけ変更してください。\r\n',1,42,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (22,'Zen Cart新バージョンの自動チェック(ヘッダで告知するか否か)','SHOW_VERSION_UPDATE_IN_HEADER','true','Zen Cartの新バージョンがリリースされた場合、ヘッダに情報を表示しますか?<br /><br />\r\n注意：この設定をオンにすると、管理者ページの表示が遅くなる場合があります。インターネットに繋がっていないテスト環境などではfalseにしてください。\r\n',1,44,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (23,'ショップのステータス','STORE_STATUS','0','ショップの状態を設定します。<br /><br />\r\n・0＝通常のショップ<br />\r\n・1＝価格表示なしのデモショップ<br />\r\n・2＝価格表示付きのデモショップ\r\n',1,25,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), ');
INSERT INTO configuration VALUES (24,'サーバの稼動時間(アップタイム)','DISPLAY_SERVER_UPTIME','true','サーバの稼働時間を表示するかどうかを設定します。この情報はいくつかのサーバでエラーログとして残ることがあります。<br /><br />true＝表示<br /><br />false＝非表示',1,46,'2003-11-08 20:24:47','0001-01-01 00:00:00','','zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (25,'リンク切れページのチェック','MISSING_PAGE_CHECK','On','Zen Cartがリンク切れページを検知した際に自動的にトップページに転送しますか?<br /><br />\r\n・On = オン<br />\r\n・Off = オフ<br />\r\n・Page Not Found = ページが見つかりません画面へ遷移する<br />\r\n<br />\r\n注意：デバックの際などにはこの機能をオフにするとよいでしょう。',1,48,'2003-11-08 20:24:47','0001-01-01 00:00:00','','zen_cfg_select_option(array(\'On\', \'Off\', \'Page Not Found\'),');
INSERT INTO configuration VALUES (26,'HTMLエディタ','HTML_EDITOR_PREFERENCE','NONE','メールマガジンや商品説明などで用いるHTML/リッチテキスト用のソフトウェアを設定します。',1,110,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'HTMLAREA\', \'NONE\'),');
INSERT INTO configuration VALUES (27,'phpBBへのリンクを表示','PHPBB_LINKS_ENABLED','false','Zen Cart上に(インストール済みの)phpBBのフォーラムへのリンクを表示するかどうかを設定します。\r\n',1,120,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (28,'カテゴリ内の商品数を表示 - 管理画面','SHOW_COUNTS_ADMIN','true','カテゴリ内の商品数を下位カテゴリも含めてカウント表示しますか?<br /><br />\r\n・true (する)<br />\r\n・false (しない)',1,130,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (29,'名前の最小文字数','ENTRY_FIRST_NAME_MIN_LENGTH','1','名前の文字数の最小値を設定します。',2,1,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (30,'姓の最小文字数','ENTRY_LAST_NAME_MIN_LENGTH','1','姓の文字数の最小値を設定します。',2,2,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (31,'生年月日の最小文字数','ENTRY_DOB_MIN_LENGTH','10','生年月日の文字数の最小値を設定します。',2,3,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (32,'メールアドレスの最小文字数','ENTRY_EMAIL_ADDRESS_MIN_LENGTH','6','メールアドレスの文字数の最小値を設定します。',2,4,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (33,'住所の最小文字数','ENTRY_STREET_ADDRESS_MIN_LENGTH','1','番地・マンション・アパート名の最小文字数を設定します。',2,5,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (34,'会社名の最小文字数','ENTRY_COMPANY_MIN_LENGTH','2','会社名の文字数の最小値を設定します。',2,6,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (35,'郵便番号の最小文字数','ENTRY_POSTCODE_MIN_LENGTH','4','郵便番号の文字数の最小値を設定します。',2,7,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (36,'市区町村の最小文字数','ENTRY_CITY_MIN_LENGTH','2','市区町村の文字数の最小値を設定します。',2,8,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (37,'都道府県名の最小文字数','ENTRY_STATE_MIN_LENGTH','2','都道府県の文字数の最小値を設定します。',2,9,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (38,'電話番号の最小文字数','ENTRY_TELEPHONE_MIN_LENGTH','3','電話番号の文字数の最小値を設定します。',2,10,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (39,'パスワードの最小文字数','ENTRY_PASSWORD_MIN_LENGTH','5','パスワードの文字数の最小値を設定します。',2,11,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (40,'クレジットカード名義の最小文字数','CC_OWNER_MIN_LENGTH','3','クレジットカード所有者名の文字数の最小値を設定します。',2,12,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (41,'クレジットカード番号の最小文字数','CC_NUMBER_MIN_LENGTH','10','クレジットカード番号の文字数の最小値を設定します。',2,13,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (42,'クレジットカードCVV番号の最小文字数','CC_CVV_MIN_LENGTH','3','クレジットカードCVV番号の文字数の最小値を設定します。',2,13,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (43,'レビューの文章の最小文字数','REVIEW_TEXT_MIN_LENGTH','50','レビューの文章の文字数の最小値を設定します。',2,14,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (44,'ベストセラーの最小表示件数','MIN_DISPLAY_BESTSELLERS','1','ベストセラーとして表示する商品の最小値を設定します。',2,15,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (45,'「こんな商品も購入しています」の最小表示数','MIN_DISPLAY_ALSO_PURCHASED','1','「この商品を購入した人はこんな商品も購入しています」で表示する商品数の最小値を設定します。',2,16,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (46,'ニックネームの最小文字数','ENTRY_NICK_MIN_LENGTH','3','ニックネームの文字数の最小値を設定します。',2,1,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (47,'アドレス帳の最大登録数','MAX_ADDRESS_BOOK_ENTRIES','5','顧客が登録できるアドレス帳の登録数の最大値を設定します。',3,1,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (48,'管理画面 - 1ページに表示する検索結果の最大数','MAX_DISPLAY_SEARCH_RESULTS','20','管理画面の1ページに表示する検索結果の数の最大値を設定します。',3,2,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (49,'ページ・リンク数の最大表示数','MAX_DISPLAY_PAGE_LINKS','5','商品リストや購入履歴の一覧表示でページの下などに表示されるページ数・リンク数の最大値を設定します。',3,3,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (50,'特価商品の最大表示数','MAX_DISPLAY_SPECIAL_PRODUCTS','9','特価商品として表示する商品数の最大値を設定します。',3,4,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (51,'今月の新着商品の最大表示数','MAX_DISPLAY_NEW_PRODUCTS','9','今月の新着商品数の最大値を設定します。',3,5,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (52,'入荷予定商品の最大表示数','MAX_DISPLAY_UPCOMING_PRODUCTS','10','入荷予定商品として表示する商品数の最大値を設定します。',3,6,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (53,'メーカーリスト - スクロールボックスのサイズ/スタイル','MAX_MANUFACTURERS_LIST','3','スクロールボックスに表示されるメーカー数は ?<br />1か0に設定するとドロップダウンリストになります。',3,7,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (54,'メーカーリスト - 商品の存在を確認','PRODUCTS_MANUFACTURERS_STATUS','1','各メーカーについて、1点以上の商品があり、かつ閲覧可能であるかどうかを確認しますか?<br /><br />注意：この機能がONの場合、商品数やメーカーの数が多いと表示が遅くなります。<br />0= off 1= on',3,7,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO configuration VALUES (55,'音楽ジャンルリスト - スクロールボックスのサイズ/スタイル','MAX_MUSIC_GENRES_LIST','3','スクロールボックスに表示される音楽ジャンルリストの数を設定します。1か0に設定すると、ドロップダウンリストになります。\r\n',3,7,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (56,'レコード会社リスト - スクロールボックスのサイズ/スタイル','MAX_RECORD_COMPANY_LIST','3','スクロールボックスに表示されるレコード会社リストの数です。1か0に設定すると、ドロップダウンリストになります。\r\n',3,7,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (57,'レコード会社名表示の長さ','MAX_DISPLAY_RECORD_COMPANY_NAME_LEN','15','レコード会社名ボックスで表示される名前の長さを設定します。設定より長い名前は省略表示されます。\r\n',3,8,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (58,'音楽ジャンル名の文字数の長さ','MAX_DISPLAY_MUSIC_GENRES_NAME_LEN','15','音楽ジャンルボックスで表示される名前の長さを設定します。設定より長い名前は省略表示されます。\r\n',3,8,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (59,'メーカー名の長さ','MAX_DISPLAY_MANUFACTURER_NAME_LEN','15','メーカーリストで表示されるメーカー名の文字数の最大値を設定します。',3,8,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (60,'新しいレビューの表示数最大値','MAX_DISPLAY_NEW_REVIEWS','6','新しいレビューとして表示される数の最大値を設定します。',3,9,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (61,'レビューのランダム表示数','MAX_RANDOM_SELECT_REVIEWS','10','ランダムに表示するレビュー数の最大値を設定します。<br /><br />注意：この設定値をXとすると、ランダム表示の対象になるのは、もっとも古いアクティブなレビューから数えてX番目に登録されたアクティブなレビューまでになります。',3,10,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (62,'新着商品のランダム表示数','MAX_RANDOM_SELECT_NEW','10','ランダムに表示する新着商品数の最大値を設定します。<br /><br />注意：この設定値をXとすると、ランダム表示の対象になるのは、もっとも古いアクティブな新着商品から数えてX番目に登録されたアクティブな新着商品までになります。',3,11,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (63,'特価商品のランダム表示数','MAX_RANDOM_SELECT_SPECIALS','10','ランダムに表示する特価商品数の最大値を設定します。<br /><br />注意：この設定値をXとすると、ランダム表示の対象になるのは、もっとも古いアクティブな特価商品から数えてX番目に登録されたアクティブな特価商品までになります。',3,12,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (64,'一行に表示するカテゴリ数','MAX_DISPLAY_CATEGORIES_PER_ROW','3','一行に表示するカテゴリ数を設定します。',3,13,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (65,'新着商品一覧表示数','MAX_DISPLAY_PRODUCTS_NEW','10','新着商品ページ１ページに表示する商品数の最大値を設定します。',3,14,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (66,'ベストセラーの最大表示件数','MAX_DISPLAY_BESTSELLERS','10','ベストセラーページ１ページに表示するベストセラー商品数の最大値を設定します。',3,15,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (67,'「こんな商品も買っています」の最大表示件数','MAX_DISPLAY_ALSO_PURCHASED','6','「こんな商品も買っています」欄に表示する商品数の最大値を設定します。',3,16,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (68,'顧客の注文履歴ボックスの最大表示数','MAX_DISPLAY_PRODUCTS_IN_ORDER_HISTORY_BOX','6','顧客の注文履歴ボックスに表示する商品数の最大値を設定します。',3,17,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (69,'注文履歴ページの最大表示件数','MAX_DISPLAY_ORDER_HISTORY','10','顧客の注文履歴ページ１ページに表示する商品数の最大値を設定します。',3,18,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (70,'顧客管理ページで表示する顧客数の最大値','MAX_DISPLAY_SEARCH_RESULTS_CUSTOMER','20','',3,19,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (71,'注文管理ページで表示する注文数の最大値','MAX_DISPLAY_SEARCH_RESULTS_ORDERS','20','',3,20,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (72,'レポートページで表示する商品数の最大値','MAX_DISPLAY_SEARCH_RESULTS_REPORTS','20','',3,21,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (73,'カテゴリ/商品ページで表示するリスト数','MAX_DISPLAY_RESULTS_CATEGORIES','10','１ページに表示する商品数の最大値を設定します。',3,22,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (74,'商品リスト - ページあたり最大表示数','MAX_DISPLAY_PRODUCTS_LISTING','10','トップページの商品リスト表示での最大表示数を設定します。',3,30,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (75,'商品オプション - オプション名とオプション値の表示','MAX_ROW_LISTS_OPTIONS','10','商品オプションページで表示するオプション名/オプション値の最大値を設定します。',3,24,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (76,'商品オプション - オプション管理画面','MAX_ROW_LISTS_ATTRIBUTES_CONTROLLER','30','オプション管理画面で表示するオプション数の最大値を設定します。',3,25,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (77,'商品属性- ダウンロード管理ページの表示','MAX_DISPLAY_SEARCH_RESULTS_DOWNLOADS_MANAGER','30','ダウンロード管理画面で、ダウンロード商品の属性の最大表示数を設定します。',3,26,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (78,'おすすめ商品 - 管理画面でのページあたり表示最大数','MAX_DISPLAY_SEARCH_RESULTS_FEATURED_ADMIN','10','管理画面において、ページあたりのおすすめ商品を最大表示件数を設定します。',3,27,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (79,'おすすめ商品 - トップページでの最大表示数','MAX_DISPLAY_SEARCH_RESULTS_FEATURED','9','トップページでおすすめ商品を最大何点表示するかを設定します。',3,28,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (80,'おすすめ商品 - 商品リストでの最大表示数','MAX_DISPLAY_PRODUCTS_FEATURED_PRODUCTS','10','商品リストでおすすめ商品をページあたり最大何点表示するかを設定します。',3,29,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (81,'おすすめ商品のランダム表示ボックス - 最大表示数','MAX_RANDOM_SELECT_FEATURED_PRODUCTS','10','おすすめ商品のランダム表示ボックスにおいて、最大何点表示するかを設定します。',3,30,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (82,'特価商品 - トップページでの最大表示点数','MAX_DISPLAY_SPECIAL_PRODUCTS_INDEX','9','トップページで、特価商品を最大何点表示するかを設定します。',3,31,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (83,'新着商品 - 表示期限','SHOW_NEW_PRODUCTS_LIMIT','0','新着商品の表示期限を設定します。<br />\r\n<br />\r\n・0=全て・降順<br />\r\n・1=当月登録分のみ<br />\r\n・30=登録から30日間<br />\r\n・60=登録から60日間(ほか90、120の設定が可能)',3,40,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'7\', \'14\', \'30\', \'60\', \'90\', \'120\'), ');
INSERT INTO configuration VALUES (84,'商品一覧ページ - ページあたり表示点数','MAX_DISPLAY_PRODUCTS_ALL','10','商品一覧において、ページあたりの最大表示点数を設定します。',3,45,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (85,'言語サイドボックス -　フラッグ最大表示数','MAX_LANGUAGE_FLAGS_COLUMNS','3','言語サイドボックスにおいて、列あたりのフラッグの最大表示点数を設定します。',3,50,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (86,'ファイルのアップロードサイズ - 上限','MAX_FILE_UPLOAD_SIZE','2048000','ファイルアップロードの際の上限サイズを設定します。デフォルトは2MB(2,048,000バイト)です。',3,60,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (87,'アップロードファイルに許可するファイルタイプ','UPLOAD_FILENAME_EXTENSIONS','jpg,jpeg,gif,png,eps,cdr,ai,pdf,tif,tiff,bmp,zip','ユーザーがアップロードするファイルに対して許可するファイルタイプの拡張子を設定します。複数の場合はカンマ(,)で区切り、コロン(.)は含めないでください。<br /><br />設定例: \"jpg,jpeg,gif,png,eps,cdr,ai,pdf,tif,tiff,bmp,zip\"',3,61,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_textarea(');
INSERT INTO configuration VALUES (88,'管理画面の注文リストで表示する注文詳細の最大件数','MAX_DISPLAY_RESULTS_ORDERS_DETAILS_LISTING','0','管理画面の注文リストでの注文詳細の最大表示件数は?<br />0 = 無制限',3,65,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (89,'管理画面のリストで表示するPayPal IPNの最大件数','MAX_DISPLAY_SEARCH_RESULTS_PAYPAL_IPN','20','管理画面のリストでのPayPal IPNの表示件数は?<br />デフォルトは20です。',3,66,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (90,'マルチカテゴリマネージャで商品を表示するカラムの最大数','MAX_DISPLAY_PRODUCTS_TO_CATEGORIES_COLUMNS','3','マルチカテゴリマネージャ(Multiple Categories Manager)で商品を表示するカラムの最大数は?<br />3 = デフォルト',3,70,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (91,'EZページの表示の最大件数','MAX_DISPLAY_SEARCH_RESULTS_EZPAGE','20','EZページの表示の最大件数は?<br />20 = デフォルト',3,71,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (92,'商品画像(小)の横幅','SMALL_IMAGE_WIDTH','100','小さな画像の横幅(ピクセル)を設定します。',4,1,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (93,'商品画像(小)の高さ','SMALL_IMAGE_HEIGHT','80','小さな画像の高さ(ピクセル)を設定します。',4,2,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (94,'ヘッダ画像の横幅 - 管理画面','HEADING_IMAGE_WIDTH','57','管理画面でのヘッダ画像の横幅を設定します。',4,3,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (95,'ヘッダ画像の高さ - 管理画面','HEADING_IMAGE_HEIGHT','40','管理画面でのヘッダ画像の高さを設定します。',4,4,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (96,'サブカテゴリ画像の横幅','SUBCATEGORY_IMAGE_WIDTH','100','サブカテゴリ画像の横幅をピクセル数で設定します。',4,5,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (97,'サブカテゴリ画像の高さ','SUBCATEGORY_IMAGE_HEIGHT','57','サブカテゴリ画像の高さをピクセル数で設定します。',4,6,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (98,'画像サイズを計算','CONFIG_CALCULATE_IMAGE_SIZE','true','画像サイズを自動的に計算するかどうかを設定します。',4,7,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (99,'画像を必須とする','IMAGE_REQUIRED','true','画像がないことを表示します。(カタログの作成時に有効)',4,8,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (100,'ショッピングカートの中身 - 商品画像の表示オン・オフ','IMAGE_SHOPPING_CART_STATUS','1','ショッピングカートの中身に入っている商品の画像を表示するかどうかを設定します。<br /><br />\r\n・0= off<br />\r\n・1= on',4,9,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO configuration VALUES (101,'ショッピングカートの中身の画像の横幅','IMAGE_SHOPPING_CART_WIDTH','50','デフォルト = 50',4,10,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (102,'ショッピングカートの中身の画像の高さ','IMAGE_SHOPPING_CART_HEIGHT','40','デフォルト = 40',4,11,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (103,'商品情報 - カテゴリアイコン画像の横幅','CATEGORY_ICON_IMAGE_WIDTH','57','商品情報ページでのカテゴリアイコンの横幅(ピクセル数)は?',4,13,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (104,'商品情報 - カテゴリアイコン画像の高さ','CATEGORY_ICON_IMAGE_HEIGHT','40','商品情報ページでのカテゴリアイコンの高さ(ピクセル数)は?',4,14,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (105,'商品情報 - 画像の横幅','MEDIUM_IMAGE_WIDTH','150','商品画像の横幅を設定します。',4,20,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (106,'商品情報 - 画像の高さ','MEDIUM_IMAGE_HEIGHT','120','商品画像の高さを設定します。',4,21,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (107,'商品情報 - 画像(中)のファイル接尾辞(Suffix)','IMAGE_SUFFIX_MEDIUM','_MED','商品画像のファイル接尾辞を設定します。<br /><br />・デフォルト = _MED',4,22,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (108,'商品情報 - 画像(大)のファイル接尾辞(Suffix)','IMAGE_SUFFIX_LARGE','_LRG','商品画像のファイル接尾辞を設定します。<br /><br />\r\n・デフォルト = _LRG',4,23,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (109,'商品情報 - １行に表示する追加画像数','IMAGES_AUTO_ADDED','3','商品情報で１行に表示する追加画像数を設定します。<br /><br />\r\n・デフォルト = 3',4,30,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (110,'商品リスト - 画像の横幅','IMAGE_PRODUCT_LISTING_WIDTH','100','デフォルト = 100',4,40,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (111,'商品リスト - 画像の高さ','IMAGE_PRODUCT_LISTING_HEIGHT','80','デフォルト = 80',4,41,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (112,'新商品リスト - 画像の横幅','IMAGE_PRODUCT_NEW_LISTING_WIDTH','100','デフォルト = 100',4,42,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (113,'新商品リスト - 画像の高さ','IMAGE_PRODUCT_NEW_LISTING_HEIGHT','80','デフォルト = 80',4,43,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (114,'新商品 - 画像の横幅','IMAGE_PRODUCT_NEW_WIDTH','100','デフォルト = 100',4,44,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (115,'新商品 - 画像の高さ','IMAGE_PRODUCT_NEW_HEIGHT','80','デフォルト = 80',4,45,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (116,'おすすめ商品 -画像の幅','IMAGE_FEATURED_PRODUCTS_LISTING_WIDTH','100','デフォルト = 100',4,46,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (117,'おすすめ商品 - 画像の高さ','IMAGE_FEATURED_PRODUCTS_LISTING_HEIGHT','80','デフォルト = 80',4,47,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (118,'全商品一覧 - 画像の幅','IMAGE_PRODUCT_ALL_LISTING_WIDTH','100','デフォルト = 100',4,48,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (119,'全商品一覧 - 画像の高さ','IMAGE_PRODUCT_ALL_LISTING_HEIGHT','80','デフォルト = 80',4,49,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (120,'商品画像 - 画像がない場合のNo Image画像','PRODUCTS_IMAGE_NO_IMAGE_STATUS','1','「No Image」画像を自動的に表示するかどうかを設定します。<br /><br />\r\n・0= off<br />\r\n・1= On<br />',4,60,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO configuration VALUES (121,'商品画像 - No Image画像の指定','PRODUCTS_IMAGE_NO_IMAGE','no_picture.gif','商品画像がない場合に表示するNo Image画像を設定します。<br /><br />Default = no_picture.gif',4,61,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (122,'商品画像 - 商品・カテゴリでプロポーショナルな画像を使う','PROPORTIONAL_IMAGES_STATUS','1','商品情報・カテゴリでプロポーショナルな画像を使いますか?<br /><br />注意：プロポーショナル画像には高さ・横幅とも\"0\"(ピクセル)を指定しないでください。<br />0= off 1= on',4,75,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO configuration VALUES (123,'(メール用)敬称表示(Mr. or Ms)','ACCOUNT_GENDER','true','顧客のアカウント作成の際、メール用の敬称(Mr. or Ms) を表示するかどうかを設定します。',5,1,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (124,'生年月日','ACCOUNT_DOB','true','顧客のアカウント作成の際、「生年月日」の欄を表示するかどうかを設定します。<br />注意: 不要な場合はfalseに、必要な場合はtrueを指定してください。',5,2,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (125,'会社名','ACCOUNT_COMPANY','true','顧客のアカウント作成の際、「会社名」を表示するかどうかを設定します。',5,3,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (126,'住所2','ACCOUNT_SUBURB','false','顧客のアカウント作成の際、「住所2」を表示するかどうかを設定します。',5,4,'2010-06-16 16:55:31','2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (127,'都道府県名','ACCOUNT_STATE','true','顧客のアカウント作成の際、「都道府県名」を表示するかどうかを設定します。',5,5,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (128,'都道府県名 - ドロップダウンで表示','ACCOUNT_STATE_DRAW_INITIAL_DROPDOWN','false','「都道府県名」は常にドロップダウン形式で表示しますか?',5,5,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (129,'アカウントのデフォルト国別IDの作成','SHOW_CREATE_ACCOUNT_DEFAULT_COUNTRY','107','アカウントのデフォルト国別IDを設定します。<br />デフォルトは223です。',5,6,NULL,'2009-11-19 12:39:39','zen_get_country_name','zen_cfg_pull_down_country_list_none(');
INSERT INTO configuration VALUES (130,'Fax番号','ACCOUNT_FAX_NUMBER','true','顧客のアカウント作成の際、「Fax番号」を表示するかどうかを設定します。',5,10,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (131,'メールマガジンのチェックボックスの表示','ACCOUNT_NEWSLETTER_STATUS','1','メールマガジンのチェックボックスの表示設定をします。<br />0= 表示オフ<br />1= ボックス表示・チェックなし状態<br />2= ボックス表示・チェックあり状態<br />【注意】デフォルトで「チェックあり」の状態にしておくと、各国のスパム規制法規に抵触する恐れがあります。',5,45,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), ');
INSERT INTO configuration VALUES (132,'デフォルトのメール形式の設定','ACCOUNT_EMAIL_PREFERENCE','0','顧客のデフォルトのメール形式を設定します。<br />0= テキスト形式<br />1= HTML形式',5,46,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO configuration VALUES (133,'顧客への商品の通知 - ステータス','CUSTOMERS_PRODUCTS_NOTIFICATION_STATUS','1','顧客がチェックアウト後に、商品の通知(product notifications)について尋ねるかどうかを設定します。<br /><br />\r\n・0= 尋ねない<br />\r\n・1= 尋ねる(サイト全体に対して設定されていない場合)<br />\r\n【注意】サイドボックスはこの設定とは別にオフにする必要があります。',5,50,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO configuration VALUES (134,'商品・価格の閲覧制限','CUSTOMERS_APPROVAL','0','顧客がショップ内で商品や価格を閲覧するのを制限するかどうかを設定します。<br />0= 要ログインなどの制限なし<br />1= ブラウスにはログインが必須<br />2= ログインなしでブラウズ可能だが価格は非表示<br />3= 商品閲覧のみ<br /><br />【注意】オプション「2」は、サーチエンジンのロボットに収集されたくない場合や、ログイン済みの顧客にのみ価格を開示したい場合に有効です。',5,55,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'), ');
INSERT INTO configuration VALUES (135,'顧客の購入オーソライズ','CUSTOMERS_APPROVAL_AUTHORIZATION','0','ショップでの購入に際して、顧客はショップ側に審査・許可される必要があるかどうかを設定します。<br />0= 不要<br />1= 商品の閲覧にも許可が必要<br />2= 商品の閲覧は自由だが価格の閲覧は許可された顧客のみ<br />【注意】オプション「2」はサーチエンジンのロボット除けに用いることもできます。',5,65,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'), ');
INSERT INTO configuration VALUES (136,'顧客のオーソライズ(閲覧制限) - ファイル名','CUSTOMERS_AUTHORIZATION_FILENAME','customers_authorization','顧客のオーソライズ(閲覧制限)に使うファイル名を設定します。拡張子なしで表記してください。<br />デフォルトは\r\n\"customers_authorization\"',5,66,NULL,'2009-11-19 12:39:39',NULL,'');
INSERT INTO configuration VALUES (137,'顧客のオーソライズ(閲覧制限) - ヘッダを隠す','CUSTOMERS_AUTHORIZATION_HEADER_OFF','false','顧客のオーソライズ(閲覧制限) でヘッダを表示するかどうかを設定します。<br /><br />\r\n・true=hide<br />\r\n・false=show',5,67,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (138,'顧客のオーソライズ(閲覧制限) - 左カラムを隠す','CUSTOMERS_AUTHORIZATION_COLUMN_LEFT_OFF','false','顧客のオーソライズ(閲覧制限) で、左カラムを表示するかどうかを設定します。<br /><br />\r\n・true=hide<br />\r\n・false=show',5,68,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (139,'顧客のオーソライズ(閲覧制限) - 右カラムを隠す','CUSTOMERS_AUTHORIZATION_COLUMN_RIGHT_OFF','false','顧客のオーソライズ(閲覧制限)で、右カラムを表示するかどうかを設定します。<br /><br />\r\n・true=hide<br />\r\n・false=show',5,69,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (140,'顧客のオーソライズ(閲覧制限) - フッタを隠す','CUSTOMERS_AUTHORIZATION_FOOTER_OFF','false','顧客のオーソライズ(閲覧制限) で、フッタを表示するかどうかを設定します。<br /><br />\r\n・true=hide<br />\r\n・false=show',5,70,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (141,'顧客のオーソライズ(閲覧制限) - 価格の非表示','CUSTOMERS_AUTHORIZATION_PRICES_OFF','false','顧客のオーソライズで、価格を表示するかどうかを設定します。<br /><br />\r\n・true=hide<br />\r\n・false=show',5,71,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (142,'顧客の紹介(Customers Referral)ステータス','CUSTOMERS_REFERRAL_STATUS','0','顧客の紹介コードについて設定します。<br />0= Off<br />1= 1st Discount Coupon Code used最初のディスカウントクーポンを使用済み<br />2= アカウント作成の際、顧客自身が追加・編集可能<br /><br />注意：顧客の紹介コードがセットされると、管理画面からだけ変更することができます。',5,80,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), ');
INSERT INTO configuration VALUES (143,'インストール済みの支払いモジュール','MODULE_PAYMENT_INSTALLED','cc.php;cod.php;moneyorder.php;purchaseorder.php','インストールされている支払いモジュールのファイル名のリスト( セミコロン(;)区切り )です。この情報は自動的に更新されますので編集の必要はありません。',6,0,'2010-06-04 14:41:51','2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (144,'インストール済み注文合計モジュール','MODULE_ORDER_TOTAL_INSTALLED','ot_subtotal.php;ot_shipping.php;ot_coupon.php;ot_group_pricing.php;ot_tax.php;ot_gv.php;ot_cod_fee.php;ot_total.php','インストールされている注文合計モジュールのファイル名のリスト(セミコロン(;)区切り)です。\r\n<br /><br />\r\n【注意】この情報は自動的に更新されますので編集の必要はありません。',6,0,'2010-06-27 04:42:19','2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (145,'インストール済み配送モジュール','MODULE_SHIPPING_INSTALLED','flat.php;freeshipper.php;yamato.php','インストールされている配送モジュールのファイル名のリスト(セミコロン(;)区切り)です。この情報は自動的に更新されますので編集の必要はありません。',6,0,'2010-06-04 14:29:45','2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (146,'代金引換モジュールを有効にする','MODULE_PAYMENT_COD_STATUS','True','代金引換モジュールを有効にするかどうかを設定します。',6,1,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO configuration VALUES (147,'支払い地域','MODULE_PAYMENT_COD_ZONE','0','地域を選択した場合、選択された地域に対してのみ支払い方法が適用されます。',6,2,NULL,'2009-11-19 12:39:39','zen_get_zone_class_title','zen_cfg_pull_down_zone_classes(');
INSERT INTO configuration VALUES (148,'表示の整列順','MODULE_PAYMENT_COD_SORT_ORDER','0','表示の整列順を設定します。数字が小さいほど上位に表示されます。',6,0,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (149,'注文ステータスの設定','MODULE_PAYMENT_COD_ORDER_STATUS_ID','0','この支払い方法の場合の注文ステータスを設定します。',6,0,NULL,'2009-11-19 12:39:39','zen_get_order_status_name','zen_cfg_pull_down_order_statuses(');
INSERT INTO configuration VALUES (150,'クレジットカードモジュールを有効にする','MODULE_PAYMENT_CC_STATUS','True','クレジットカードによる支払いを有効にするかどうかを設定します。',6,0,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO configuration VALUES (151,'クレジットカード番号を分割する','MODULE_PAYMENT_CC_EMAIL','','メールアドレスが入力された場合、クレジットカードの中間の数字をそのアドレスに送信し、残りの外側の番号をデータベースに保存します。',6,0,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (152,'CVV番号を保存する','MODULE_PAYMENT_CC_COLLECT_CVV','false','CVV番号を収集/保存しますか? 注意：有効にすると、CVV番号はエンコードされた状態でデータベースに保存されます。',6,0,NULL,'2004-01-11 22:55:51',NULL,'zen_cfg_select_option(array(\'True\', \'False\'),');
INSERT INTO configuration VALUES (153,'クレジットカードナンバーを収集・保存する','MODULE_PAYMENT_CC_STORE_NUMBER','False','クレジットカード番号を収集・保存するかどうかを設定します。<br /><br />\r\n【注意】クレジットカード番号は暗号化なしに保存されます。セキュリティ上の問題に十分注意してください。',6,0,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'True\', \'False\'),');
INSERT INTO configuration VALUES (154,'表示の整列順','MODULE_PAYMENT_CC_SORT_ORDER','0','表示の整列順を設定します. 数字が小さいほど上位に表示されます。',6,0,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (155,'支払い地域','MODULE_PAYMENT_CC_ZONE','0','地域を選択した場合、選択された地域にたいしてのみ支払い方法が適用されます。',6,2,NULL,'2009-11-19 12:39:39','zen_get_zone_class_title','zen_cfg_pull_down_zone_classes(');
INSERT INTO configuration VALUES (156,'注文ステータス','MODULE_PAYMENT_CC_ORDER_STATUS_ID','0','この支払い方法の場合の注文ステータスを設定します。',6,0,NULL,'2009-11-19 12:39:39','zen_get_order_status_name','zen_cfg_pull_down_order_statuses(');
INSERT INTO configuration VALUES (157,'定額料金','MODULE_SHIPPING_FLAT_STATUS','True','定額料金による配送を提供するかどうかを設定します。',6,0,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO configuration VALUES (158,'配送料金','MODULE_SHIPPING_FLAT_COST','5.00','すべての注文に対して適用される配送料金を設定します。',6,0,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (159,'税種別','MODULE_SHIPPING_FLAT_TAX_CLASS','0','定額料金に適用される税種別を選択します。',6,0,NULL,'2009-11-19 12:39:39','zen_get_tax_class_title','zen_cfg_pull_down_tax_classes(');
INSERT INTO configuration VALUES (160,'税率の計算ベース','MODULE_SHIPPING_FLAT_TAX_BASIS','Shipping','配送料にかかる税金オプションの設定します。<br /><br />\r\n・Shipping - 顧客の送付先住所に基づく<br />\r\n・Billing - 顧客の請求先住所に基づく<br />\r\n・Store - ショップの所在住所に基づく(送付先/請求先がショップ所在地と同じ地域の場合に有効)',6,0,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'Shipping\', \'Billing\', \'Store\'), ');
INSERT INTO configuration VALUES (161,'配送地域','MODULE_SHIPPING_FLAT_ZONE','0','配送地域を選択すると選択された地域のみで利用可能になります。',6,0,NULL,'2009-11-19 12:39:39','zen_get_zone_class_title','zen_cfg_pull_down_zone_classes(');
INSERT INTO configuration VALUES (162,'表示の整列順','MODULE_SHIPPING_FLAT_SORT_ORDER','0','表示の整列順を設定できます。数字が小さいほど上位に表示されます。',6,0,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (163,'デフォルトの通貨','DEFAULT_CURRENCY','JPY','デフォルトの通貨を設定します。',6,0,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (164,'デフォルトの言語','DEFAULT_LANGUAGE','ja','デフォルトの言語を設定します。',6,0,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (165,'新規注文のデフォルトステータス','DEFAULT_ORDERS_STATUS_ID','1','新規の注文を受け付けたときのデフォルトステータスを設定します。',6,0,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (166,'管理画面で設定キー(configuration_key)を表示','ADMIN_CONFIGURATION_KEY_ON','0','管理画面で設定キー(configuration_key)を表示しますか?<br />\r\n表示したい場合は1に設定してください。',6,0,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (167,'出荷国名','SHIPPING_ORIGIN_COUNTRY','107','配送料の計算に利用するための国名を選択します。',7,1,NULL,'2009-11-19 12:39:39','zen_get_country_name','zen_cfg_pull_down_country_list(');
INSERT INTO configuration VALUES (168,'ショップの郵便番号','SHIPPING_ORIGIN_ZIP','100-0000','ショップの郵便番号を入力します。',7,2,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (169,'一回の配送で配送可能な最大重量(kg)','SHIPPING_MAX_WEIGHT','50','一回の配送で可能な重量(kg)の最大値を設定します。例えば10kgに設定した状態でカートに30kgの商品があった場合、10kg × 3回の配送という形で処理されます。',7,3,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (170,'小・中パッケージの風袋 - 比率・重量','SHIPPING_BOX_WEIGHT','0:3','典型的な小・中パッケージの風袋(ふうたい：大きさと重量)を設定します。<br />\r\n例：10% + 1lb 10:1<br />\r\n10% + 0lbs 10:0<br />\r\n0% + 5lbs 0:5<br />\r\n0% + 0lbs 0:0',7,4,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (171,'大型パッケージの風袋 - 大きさ・重量','SHIPPING_BOX_PADDING','10:0','大きなパッケージの風袋風袋(ふうたい：大きさと重量)を設定します。<br />\r\n例：10% + 1lb 10:1<br />\r\n10% + 0lbs 10:0<br />\r\n0% + 5lbs 0:5<br />\r\n0% + 0lbs 0:0',7,5,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (172,'個数と重量の表示','SHIPPING_BOX_WEIGHT_DISPLAY','3','配送する荷物の個数と重量を表示するかどうかを設定します。<br /><br />\r\n・0= off<br />\r\n・1= 個数のみ表示<br />\r\n・2= 重量のみ表示<br />\r\n・3= 両方表示',7,15,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'), ');
INSERT INTO configuration VALUES (173,'送料概算表示の表示・非表示','SHOW_SHIPPING_ESTIMATOR_BUTTON','1','送料概算ボタンの表示するかどうかを設定します。<br />\r\n・0= Off<br />\r\n・1= ショッピングカート上にボタンとして表示',7,20,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), ');
INSERT INTO configuration VALUES (174,'注文の重量が0なら送料無料に','ORDER_WEIGHT_ZERO_STATUS','1','注文の重量が0の場合、送料無料にしますか?\r\n<br />\r\n・0= いいえ<br />\r\n・1= はい<br />\r\n注意：「送料無料」表記をしたい場合には送料無料モジュールを使うことをお勧めします。このオプションは実際に送料無料のときに表示されるだけです。',7,15,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO configuration VALUES (175,'商品イメージの表示','PRODUCT_LIST_IMAGE','1','商品一覧中の商品画像の表示・非表示/ソート順を設定します。<br /><br />\r\n・数値が小さいほど先に表示<br />\r\n・0 = 非表示',8,1,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (176,'商品メーカーの表示','PRODUCT_LIST_MANUFACTURER','0','商品のメーカー名を表示するかどうかを設定します。<br /><br />\r\n・数値が小さいほど先に表示<br />\r\n・0 = 非表示',8,2,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (177,'商品型番の表示','PRODUCT_LIST_MODEL','0','商品一覧中の商品型番の表示・非表示/ソート順を設定します。数値が小さいほど先に表示されます。(0 = 非表示)',8,3,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (178,'商品名','PRODUCT_LIST_NAME','2','商品一覧中の商品名の表示・非表示/ソート順を設定します。<br /><br />\r\n・数値が小さいほど先に表示<br />\r\n・0 = 非表示',8,4,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (179,'商品価格・「カートに入れる」を表示','PRODUCT_LIST_PRICE','3','商品価格・「カートに入れる」ボタンを表示するかどうかを設定します。<br />\r\n<br />\r\n・数値が小さいほど先に表示<br />\r\n・0 = 非表示',8,5,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (180,'商品数量の表示','PRODUCT_LIST_QUANTITY','0','商品一覧中の商品数量の表示・非表示/ソート順を設定します。<br /><br />\r\n・数値が小さいほど先に表示<br />\r\n・0 = 非表示',8,6,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (181,'商品重量の表示','PRODUCT_LIST_WEIGHT','0','商品一覧中の商品重量の表示・非表示/ソート順を設定します。数値が小さいほど先に表示されます。(0 = 非表示)',8,7,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (182,'商品価格・「カートに入れる」カラムの幅','PRODUCTS_LIST_PRICE_WIDTH','125','商品価格・「カートに入れる」ボタンを表示するカラムの幅(ピクセル数)を設定します。<br />\r\n・Default= 125',8,8,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (183,'カテゴリ/メーカーの絞り込みの表示','PRODUCT_LIST_FILTER','1','カテゴリ一覧ページで [絞り込み] を表示するかどうかを設定します。<br />\r\n・0=非表示<br />\r\n・1=表示',8,9,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO configuration VALUES (184,'[前ページ] [次ページ] の表示位置','PREV_NEXT_BAR_LOCATION','3','[前ページ] [次ページ] の表示位置を設定します。<br /><br />\r\n・1 = 上<br />\r\n・2 = 下<br />\r\n・3 = 両方',8,10,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'1\', \'2\', \'3\'), ');
INSERT INTO configuration VALUES (185,'商品リストのデフォルトソート順','PRODUCT_LISTING_DEFAULT_SORT_ORDER','','商品リストのデフォルトのソート順を設定します。\r\n<br />\r\n注意：商品でソートする場合は空欄に。\r\nSort the Product Listing in the order you wish for the default display to start in to get the sort order setting. Example: 2a',8,15,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (186,'「カートに入れる」ボタンの表示','PRODUCT_LIST_PRICE_BUY_NOW','1','「カートに入れる」ボタンを表示するかどうかを設定します。<br /><br />\r\n・0= off<br />\r\n・1= on',8,20,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO configuration VALUES (187,'複数商品の数量欄の有無・表示位置','PRODUCT_LISTING_MULTIPLE_ADD_TO_CART','3','複数商品をカートに入れる数量欄の表示するかどうかと、表示位置を設定します。<br />0= off<br />1= 上部<br />2= 下部<br />3= 両方',8,25,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'), ');
INSERT INTO configuration VALUES (188,'商品説明の表示','PRODUCT_LIST_DESCRIPTION','150','商品説明を表示するかどうかを設定します。<br /><br />0= OFF<br />150= 推奨する長さ。または自由に表示する商品説明の最大文字数を設定してください。',8,30,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (189,'商品リストの昇順を表示する記号','PRODUCT_LIST_SORT_ORDER_ASCENDING','+','商品リストの昇順を示す記号は?<br />デフォルト = +',8,40,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_textarea_small(');
INSERT INTO configuration VALUES (190,'商品リストの降順を表示する記号','PRODUCT_LIST_SORT_ORDER_DESCENDING','-','商品リストの降順を示す記号は?<br />デフォルト = -',8,41,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_textarea_small(');
INSERT INTO configuration VALUES (191,'在庫水準のチェック','STOCK_CHECK','true','十分な在庫があるかチェックするかどうかを設定します。',9,1,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (192,'在庫数からマイナス','STOCK_LIMITED','true','受注時点で各在庫数から注文数をマイナスしますか?',9,2,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (193,'チェックアウトを許可','STOCK_ALLOW_CHECKOUT','true','在庫が不足している場合にチェックアウトを許可しますか?',9,3,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (194,'在庫切れ商品のサイン','STOCK_MARK_PRODUCT_OUT_OF_STOCK','在庫切れです','注文時点で商品が在庫切れの場合に顧客へ表示するサインを設定します。',9,4,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (195,'在庫の再注文水準','STOCK_REORDER_LEVEL','5','在庫の再注文が必要になる商品数を設定します。',9,5,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (196,'在庫切れ商品のステータス変更','SHOW_PRODUCTS_SOLD_OUT','0','商品の在庫がない場合のステータス表示を設定します。<br /><br />0= 商品ステータスをOFFに<br />1= 商品ステータスはONのまま',9,10,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO configuration VALUES (197,'在庫切れ商品に「売り切れ」画像表示','SHOW_PRODUCTS_SOLD_OUT_IMAGE','1','在庫がなくなった商品の場合に「カートへ入れる」ボタンの代わりに「売り切れ」画像を表示しますか?<br /><br />\r\n・0= 表示しない<br />\r\n・1= 表示する',9,11,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO configuration VALUES (198,'商品数量に指定できる小数点の桁数','QUANTITY_DECIMALS','0','商品の数量に小数点の利用を許可する桁数を設定します。<br /><br />\r\n・0= off',9,15,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'), ');
INSERT INTO configuration VALUES (199,'ショッピングカート - 「削除」チェックボックス/ボタン','SHOW_SHOPPING_CART_DELETE','3','「削除」チェックボックス/ボタンの表示について設定します。<br /><br />1= ボタンのみ<br />2= チェックボックスのみ<br />3= ボタン/チェックボックス両方',9,20,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'1\', \'2\', \'3\'), ');
INSERT INTO configuration VALUES (200,'ショッピングカート -「カートの中身を更新」ボタンの位置','SHOW_SHOPPING_CART_UPDATE','3','「カートの中身を更新」ボタンの位置を設定します。<br /><br />1=「注文数」欄の横<br />2= 商品リストの下<br />3=「注文数」欄の横と商品リストの下<br /><br />注意：この設定は3つの\"tpl_shopping_cart_default\"ファイルが呼ばれる部分を設定します。',9,22,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'1\', \'2\', \'3\'), ');
INSERT INTO configuration VALUES (201,'ページのパースに要した時間をログに記録するかどうかを設定します。','STORE_PAGE_PARSE_TIME','false','ページのパースに要した時間をログに記録するかどうかを設定します。',10,1,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (202,'ページのパースログを保存するディレクトリとファイル名を設定します。','STORE_PAGE_PARSE_TIME_LOG','/var/log/www/zen/page_parse_time.log','ページのパースログを保存するディレクトリとファイル名を設定します。',10,2,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (203,'ログに記録する日付形式を設定します。','STORE_PARSE_DATE_TIME_FORMAT','%d/%m/%Y %H:%M:%S','ログに記録する日付形式を設定します。',10,3,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (204,'各ページの下にパース時間を表示するかどうかを設定します。<br />「ページのパース時間を記録」を true にしておく必要はありません。','DISPLAY_PAGE_PARSE_TIME','false','各ページの下にパース時間を表示するかどうかを設定します。<br />「ページのパース時間を記録」を true にしておく必要はありません。',10,4,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (205,'ログにデータベースクエリーを記録しておくかどうか設定します。(PHP4の場合のみ)','STORE_DB_TRANSACTIONS','false','ログにデータベースクエリーを記録しておくかどうか設定します。(PHP4の場合のみ)',10,5,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (206,'メール送信 - 接続方法','EMAIL_TRANSPORT','sendmail','メール送信にsendmailへのローカル接続を使用するかTCP/IP経由のSMTP接続を使用するかを設定します。サーバのOSがWindowsやMacOSの場合はSMTPに設定してください。<br /><br />SMTPAUTHは、サーバーがメール送信の際にSMTP authorizationを求める場合にのみ使ってください。その場合、管理画面でSMTPAUTH設定を行う必要があります。<br /><br />\"Sendmail -f\"は、-fパラメータが必要なサーバ向けの設定で、スプーフィングを防ぐために用いられることが多いセキュリティ上の設定です。メールサーバーのホスト側で使用可能な設定になっていない場合、エラーになることがあります。',12,1,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'sendmail\', \'sendmail-f\', \'smtp\', \'smtpauth\'),');
INSERT INTO configuration VALUES (207,'SMTP認証 - メールアカウント','EMAIL_SMTPAUTH_MAILBOX','YourEmailAccountNameHere','あなたのホスティングサービスが提供しているメールアカウント(例：me@mydomain.com)を入力してください。これはSMTP認証に必要な情報です。<br />メールにSMTP認証を使っている場合にのみ必要です。',12,101,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (208,'SMTP認証 - パスワード','EMAIL_SMTPAUTH_PASSWORD','YourPasswordHere','SMTPメールボックスのパスワードを入力してください。<br />メールにSMTP認証を使っている場合にのみ必要です。',12,101,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (209,'SMTP認証 - DNS名','EMAIL_SMTPAUTH_MAIL_SERVER','mail.EnterYourDomain.com','SMTPメールサーバのDNS名を入力してください。<br />例：mail.mydomain.com or 55.66.77.88<br />メールにSMTP認証を使っている場合にのみ必要です。',12,101,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (210,'SMTP認証 - IPポート番号','EMAIL_SMTPAUTH_MAIL_SERVER_PORT','25','SMTPメールサーバが運用されているIPポート番号を入力してください。<br />メールにSMTP認証を使っている場合にのみ必要です。',12,101,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (211,'テキストメールでの貨幣の変換','CURRENCIES_TRANSLATIONS','&amp;pound;,£:&amp;euro;,EUR','テキスト形式のメールに、どんな貨幣の変換が必要ですか?<br />Default = &amp;pound;,£:&amp;euro;,EUR',12,120,NULL,'2003-11-21 00:00:00',NULL,'zen_cfg_textarea_small(');
INSERT INTO configuration VALUES (212,'メールの改行コード','EMAIL_LINEFEED','LF','メールヘッダを区切るのに使用する改行コードを指定します。',12,2,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'LF\', \'CRLF\'),');
INSERT INTO configuration VALUES (213,'メール送信にMIME HTMLを使用','EMAIL_USE_HTML','false','メールをHTML形式で送信するかどうかを設定します。',12,3,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (214,'メールアドレスをDNSで確認','ENTRY_EMAIL_ADDRESS_CHECK','false','メールアドレスをDNSサーバに問い合わせ確認するかどうかを設定します。',12,4,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (215,'メールを送信','SEND_EMAILS','true','E-Mailを外部に送信するかどうかを設定します。',12,5,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (216,'メール保存の設定','EMAIL_ARCHIVE','false','送信済みのメールを保存しておく場合はtrueを設定してください。',12,6,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (217,'メール送信エラーの表示','EMAIL_FRIENDLY_ERRORS','false','メール送信が失敗した際、人目でわかるエラーを表示しますか? 運営中のショップではtrueに設定することを勧めます。falseに設定するとPHPのエラーメッセージを表示されるので、トラブル解決のヒントになります。',12,7,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (218,'メールアドレス (ショップに表示する問い合わせ先)','STORE_OWNER_EMAIL_ADDRESS','hachiya@ark-web.jp','ショップオーナーのメールアドレスとしてサイト上で表示されるアドレスを設定します。',12,10,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (219,'メールアドレス (顧客への送信元)','EMAIL_FROM','hachiya@ark-web.jp','顧客に送信されるメールのデフォルトの送信元として表示されるアドレスを設定します。<br />\r\n管理画面でメールを作成をする都度、書き換えることもできます。',12,11,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (220,'送信メールの送信元アドレスの実在性','EMAIL_SEND_MUST_BE_STORE','No','お使いのメールサーバでは、送信するメールの送信元(From)アドレスがWebサーバ上に実在することが必須ですか?<br /><br />spam送信を防止するなどのためにこのように設定されていることがあります。Yesに設定すると、送信元アドレスとメール内のFromアドレスが一致していることが求められます。',12,11,NULL,'0001-01-01 00:00:00',NULL,'zen_cfg_select_option(array(\'No\', \'Yes\'), ');
INSERT INTO configuration VALUES (221,'管理者が送信するメールフォーマット','ADMIN_EXTRA_EMAIL_FORMAT','TEXT','管理者が送付するメールフォーマットを設定します。<br /><br />\r\n・TEXT =テキスト形式<br />\r\n・HTML =HTML形式',12,12,NULL,'0001-01-01 00:00:00',NULL,'zen_cfg_select_option(array(\'TEXT\', \'HTML\'), ');
INSERT INTO configuration VALUES (222,'注文確認メール(コピー)送信先','SEND_EXTRA_ORDER_EMAILS_TO','hachiya@ark-web.jp','顧客に送信される注文確認メールのコピーを送付するメールアドレスを設定します。<br />記入例: 名前1 &lt;email@address1&gt;, 名前2 &lt;email@address2&gt;',12,12,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (223,'アカウント作成完了メール(コピー)の送信','SEND_EXTRA_CREATE_ACCOUNT_EMAILS_TO_STATUS','0','アカウント作成完了メールのコピーを指定のメールアドレスに送信しますか?<br /><br />\r\n・0= off<br />\r\n・1= on',12,13,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'),');
INSERT INTO configuration VALUES (224,'アカウント作成完了メール(コピー)の送信先','SEND_EXTRA_CREATE_ACCOUNT_EMAILS_TO','hachiya@ark-web.jp','アカウント作成完了メールのコピーを送信するメールアドレスを設定します。<br /><br />\r\n記入例： 名前1 &lt;email@address1&gt;, 名前2 &lt;email@address2&gt;',12,14,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (225,'「友達に知らせる」メール(コピー)の送信','SEND_EXTRA_TELL_A_FRIEND_EMAILS_TO_STATUS','0','「友達に知らせる」メールのコピーを送信しますか?<br />0= off 1= on',12,15,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'),');
INSERT INTO configuration VALUES (226,'「友達に知らせる」メール(コピー)の送信先','SEND_EXTRA_TELL_A_FRIEND_EMAILS_TO','hachiya@ark-web.jp','「友達に知らせる」メールのコピーを送信するメールアドレスを設定します。記入例: 名前1 &lt;email@address1&gt;, 名前2 &lt;email@address2&gt;',12,16,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (227,'ギフト券送付メール(コピー)の送信','SEND_EXTRA_GV_CUSTOMER_EMAILS_TO_STATUS','0','顧客が送付するギフト券送付メールのコピーを送信しますか?<br /><br />\r\n・0= off<br />\r\n・1= on',12,17,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'),');
INSERT INTO configuration VALUES (228,'ギフト券送付メール(コピー)の送信先','SEND_EXTRA_GV_CUSTOMER_EMAILS_TO','hachiya@ark-web.jp','顧客が送付するギフト券送付メールのコピーを送信するメールアドレスを設定します。<br /><br />記入例： 名前1 &lt;email@address1&gt;, 名前2&lt;email@address2&gt;',12,18,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (229,'ショップ運営者からのギフト券送付メール(コピー)の送信','SEND_EXTRA_GV_ADMIN_EMAILS_TO_STATUS','0','ショップ運営者からのギフト券送付メールのコピーを送信しますか?<br /><br />\r\n・0= off<br />\r\n・1= on',12,19,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'),');
INSERT INTO configuration VALUES (230,'ショップ運営者からのギフト券送付メール(コピー)の送信先','SEND_EXTRA_GV_ADMIN_EMAILS_TO','hachiya@ark-web.jp','ショップ運営者からのギフト券送付メールのコピーを送信するメールアドレスを設定します。<br /><br />\r\n記入例：名前1 &lt;email@address1&gt;, 名前2 &lt;email@address2&gt;',12,20,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (231,'ショップ運営者からのクーポン券送付メール(コピー)の送信','SEND_EXTRA_DISCOUNT_COUPON_ADMIN_EMAILS_TO_STATUS','0','ショップ運営者からのクーポン券送付メールのコピーを送信しますか?<br />0= off 1= on',12,21,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'),');
INSERT INTO configuration VALUES (232,'ショップ運営者からのクーポン券送付メール(コピー)の送信先','SEND_EXTRA_DISCOUNT_COUPON_ADMIN_EMAILS_TO','hachiya@ark-web.jp','ショップ運営者からのクーポン券送付メールのコピーを送信するメールアドレスを設定します。<br /><br />\r\n記入例： 名前1 &lt;email@address1&gt;, 名前2 &lt;email@address2&gt;',12,22,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (233,'ショップ運営者の注文ステータスメール(コピー)の送信','SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO_STATUS','0','ショップ運営者の注文ステータスメールのコピーを送信しますか?<br /><br />\r\n・0= off<br />\r\n・1= on',12,23,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'),');
INSERT INTO configuration VALUES (234,'ショップ運営者の注文ステータスメール(コピー)の送信先','SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO','hachiya@ark-web.jp','ショップ運営者の注文ステータスメールのコピーを送信するメールアドレスを設定します。<br /><br />\r\n記入例： 名前1 &lt;email@address1&gt;, 名前2 &lt;email@address2&gt;',12,24,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (235,'掲載待ちレビューについてメール送信','SEND_EXTRA_REVIEW_NOTIFICATION_EMAILS_TO_STATUS','0','掲載待ちのレビューについてメールを送信しますか?<br />0= off 1= on',12,25,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'),');
INSERT INTO configuration VALUES (236,'掲載待ちレビューについてのメール送信先','SEND_EXTRA_REVIEW_NOTIFICATION_EMAILS_TO','hachiya@ark-web.jp','掲載待ちのレビューについてのメールを送信するアドレスを設定します。<br />フォーマット：Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;',12,26,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (237,'「お問い合わせ」メールのドロップダウン設定','CONTACT_US_LIST','','「お問い合わせ」ページで、メールアドレスのリストを設定し、ドロップダウンリストとして表示できます。<br />\r\nフォーマット：Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;',12,40,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_textarea(');
INSERT INTO configuration VALUES (238,'ゲストに「友達に知らせる」機能を許可','ALLOW_GUEST_TO_TELL_A_FRIEND','false','ゲスト(未登録ユーザ)に「友達に知らせる」機能を許可するかどうかを設定します。 <br />[false]に設定すると、この機能を利用しようとした際にログインを促します。',12,50,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (239,'「お問い合わせ」にショップ名と住所を表記','CONTACT_US_STORE_NAME_ADDRESS','1','「お問い合わせ」画面にショップ名と住所を表記するかどうかを設定します。<br /><br />\r\n・0= off<br />\r\n・1= on',12,50,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO configuration VALUES (240,'在庫わずかになったらメール送信','SEND_LOWSTOCK_EMAIL','0','商品の在庫が水準を下回った際にメールを送信するかどうかを設定します。<br />\r\n・0= off<br />\r\n・1= on',12,60,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'),');
INSERT INTO configuration VALUES (241,'在庫わずかになった際のメール送信先','SEND_EXTRA_LOW_STOCK_EMAILS_TO','hachiya@ark-web.jp','商品の在庫が水準を下回った際にメールを送信するアドレスを設定します。複数設定することができます。<br />\r\nフォーマット：Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;',12,61,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (242,'「メールマガジンの購読解除」リンクの表示','SHOW_NEWSLETTER_UNSUBSCRIBE_LINK','true','「メールマガジンの購読解除」リンクをインフォメーションサイドボックスに表示しますか?',12,70,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (243,'オンラインユーザー数の表示設定','AUDIENCE_SELECT_DISPLAY_COUNTS','true','オンラインのユーザ(audiences/recipients)を表示する際、recipientsを含めますか?<br /><br />\r\n【注意】この設定をtrueにすると、沢山の顧客がいる場合などに表示が遅くなる場合があります。',12,90,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (244,'ダウンロードを有効にする','DOWNLOAD_ENABLED','true','商品のダウンロード機能を設定します。',13,1,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (245,'リダイレクトでダウンロード画面へ','DOWNLOAD_BY_REDIRECT','true','ダウンロードの際にブラウザによるリダイレクト(転送)を可能にするかどうかを設定します。<br />\r\nUNIX系でないサーバではオフにしてください。\r\n<br />注意：この設定をオンにしたら、/pub ディレクトリのパーミッションを777にしてください。',13,2,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (246,'ストリーミングによるダウンロード','DOWNLOAD_IN_CHUNKS','false','「リダイレクトでダウンロード」がオフで、かつPHP memory_limit設定が8MB以下の場合、この設定をオンにしてください。ストリーミングで、より小さな単位でのファイル転送を行うためです。<br /><br />「リダイレクトでダウンロード」がオンの場合、効果はありません。',13,2,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (247,'ダウンロードの有効期限(日数)','DOWNLOAD_MAX_DAYS','7','ダウンロードリンクの有効期間の日数を設定します。<br /><br />\r\n・0 = 無期限',13,3,NULL,'2009-11-19 12:39:39',NULL,'');
INSERT INTO configuration VALUES (248,'ダウンロード可能回数(商品ごと)','DOWNLOAD_MAX_COUNT','5','ダウンロードできる回数の最大値を設定します。<br /><br />\r\n・0 = ダウンロード不可',13,4,NULL,'2009-11-19 12:39:39',NULL,'');
INSERT INTO configuration VALUES (249,'ダウンロード設定 - 注文状況による更新','DOWNLOADS_ORDERS_STATUS_UPDATED_VALUE','4','orders_statusによるダウンロードの有効期限・可能回数のリセットについて設定します。<br />デフォルト = 4',13,10,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (250,'ダウンロード可能となる注文ステータスのID - デフォルト >= 2','DOWNLOADS_CONTROLLER_ORDERS_STATUS','2','ダウンロード可能となる注文ステータスのID - デフォルト >= 2<br /><br />注文ステータスのIDがこの値より高い注文はダウンロード可能になります。購入完了時の注文ステータスは支払いモジュールに毎に設定されます。',13,12,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (251,'ダウンロード終了となる注文ステータスのID','DOWNLOADS_CONTROLLER_ORDERS_STATUS_END','4','ダウンロード終了となる注文ステータスのID - デフォルト >= 4<br /><br />注文ステータスがこの値より高い注文はダウンロードが終了となります。',13,13,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (252,'Price Factor属性を可能にする','ATTRIBUTES_ENABLED_PRICE_FACTOR','true','Price Factor属性を可能にするかどうかを設定します。',13,25,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (253,'Qty Price Discount属性のオン/オフ','ATTRIBUTES_ENABLED_QTY_PRICES','true','「大量購入による値引き」属性のオン/オフを設定します。',13,26,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (254,'イメージ属性のオン/オフ','ATTRIBUTES_ENABLED_IMAGES','true','イメージ属性のオン/オフを設定します。',13,28,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (255,'(言葉・文字による)テキストによる価格設定のオン/オフ','ATTRIBUTES_ENABLED_TEXT_PRICES','true','テキストによる価格設定の属性のオン/オフを設定します。',13,35,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (256,'テキストによる価格設定 - 空欄の場合は無料','TEXT_SPACES_FREE','1','テキストによる価格設定の場合、空欄のままなら無料にするかどうかを設定します。<br /><br />\r\n・0= off<br />\r\n・1= on',13,36,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO configuration VALUES (257,'Read Only属性の商品 -「カートに入れる」ボタンの表示','PRODUCTS_OPTIONS_TYPE_READONLY_IGNORED','1','READONLY属性だけが設定された商品に「カートに入れる」ボタンを表示しますか?<br />0= OFF<br />1= ON',13,37,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO configuration VALUES (258,'GZip圧縮を使用する','GZIP_LEVEL','0','HTTP通信にGZip圧縮を使用してページを転送しますか?<br /><br />\r\n・0= off<br />\r\n・1= on',14,1,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'),');
INSERT INTO configuration VALUES (259,'セッション情報保存ディレクトリ','SESSION_WRITE_DIRECTORY','/var/www/projects/z/zen-cart/htdocs/hachiya/zencart-sugu/cache','セッション管理がファイルベースの場合に保存するディレクトリを設定します。',15,1,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (260,'クッキーに保存するドメイン名の設定','SESSION_USE_FQDN','True','クッキーに保存するドメイン名について設定します。<br /><br />\r\n\r\n・True = ドメインネーム全体をクッキーに保存(例：www.mydomain.com)<br />\r\n・False = ドメインネームの一部を保存(例：mydomain.com)。<br />\r\nよくわからない場合はこの設定はTrueにしておいてください。',15,2,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO configuration VALUES (261,'クッキー利用を必須にする','SESSION_FORCE_COOKIE_USE','True','セッションに必ずクッキーを利用します。True指定するとブラウザのクッキーがオフになっている場合はセッションを開始しません。セキュリティ上の理由から余程の理由のない限りはTrue指定のままとすることを強く推奨します。',15,2,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO configuration VALUES (262,'SSLセッションIDチェック','SESSION_CHECK_SSL_SESSION_ID','False','全てのHTTPSリクエストでSSLセッションIDをチェックしますか?',15,3,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO configuration VALUES (263,'User Agentチェック','SESSION_CHECK_USER_AGENT','False','全てのリクエスト時にUser Agentのチェックを行いますか?',15,4,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO configuration VALUES (264,'IPアドレスチェック','SESSION_CHECK_IP_ADDRESS','False','全てのリクエスト時にIPアドレスをチェックしますか?',15,5,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO configuration VALUES (265,'ロボット(スパイダー)のセッションを防止','SESSION_BLOCK_SPIDERS','True','既知のロボット(スパイダー)がセッションを開始することを防止しますか?',15,6,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO configuration VALUES (266,'セッション再発行','SESSION_RECREATE','True','ユーザーがログオンまたはアカウントを作成した場合にセッションを再発行しますか?<br />(PHP4.1以上が必要)',15,7,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO configuration VALUES (267,'IPアドレス変換の設定','SESSION_IP_TO_HOST_ADDRESS','true','IPアドレスをホストアドレスに変換しますか?<br /><br />注意：サーバによっては、この設定でメール送信のスタート・終了が遅くなることがあります。',15,10,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (268,'ギフト/クーポン券コードの長さ','SECURITY_CODE_LENGTH','10','ギフト/クーポン券コードの長さを設定します。<br /><br />\r\n注意：コードが長いほど安全です。',16,1,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (269,'差引残高0の場合の注文ステータス','DEFAULT_ZERO_BALANCE_ORDERS_STATUS_ID','2','注文の差引残高が0の場合に適用される注文ステータスを設定します。',16,0,NULL,'2009-11-19 12:39:39','zen_get_order_status_name','zen_cfg_pull_down_order_statuses(');
INSERT INTO configuration VALUES (270,'ウェルカムクーポン券','NEW_SIGNUP_DISCOUNT_COUPON','','会員登録時にその会員にウェルカムクーポン券として自動発行するクーポン券を選択してください。',16,75,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_coupon_id(');
INSERT INTO configuration VALUES (271,'新しいギフト券の登録額','NEW_SIGNUP_GIFT_VOUCHER_AMOUNT','','新しいギフト券の登録額を設定します。<br /><br />\r\n・空白 = なし<br />\r\n・1000 = 1000円',16,76,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (272,'クーポン券のページあたり最大表示件数','MAX_DISPLAY_SEARCH_RESULTS_DISCOUNT_COUPONS','20','クーポン券の1ページあたりの表示件数を設定します。',16,81,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (273,'クーポン券レポートのページあたり最大表示件数','MAX_DISPLAY_SEARCH_RESULTS_DISCOUNT_COUPONS_REPORTS','20','クーポン券のレポートページでの表示件数を設定します。',16,81,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (274,'ギフト券残高の最大値数','MAX_GIFT_AMOUNT','100000','ギフト券残高の最大値を設定します。ギフト券引き換え結果がこの値を超える場合は引き換え処理ができません。値は100000以下を指定してください。',16,82,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (275,'クレジットカード利用の可否 - VISA','CC_ENABLED_VISA','1','VISAを有効にしますか?<br /><br />\r\n・0= off<br />\r\n・1= on',17,1,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO configuration VALUES (276,'クレジットカード利用の可否 - MasterCard','CC_ENABLED_MC','1','MasterCardを有効にしますか?<br /><br />\r\n・0= off<br />\r\n・1= on',17,2,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO configuration VALUES (277,'クレジットカード利用の可否 - AmericanExpress','CC_ENABLED_AMEX','0','AmericanExpressを有効にしますか?<br /><br />\r\n・0= off<br />\r\n・1= on',17,3,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO configuration VALUES (278,'クレジットカード利用の可否 - Diners Club','CC_ENABLED_DINERS_CLUB','0','Diners Clubを有効にしますか?<br /><br />\r\n・0= off<br />\r\n・1= on',17,4,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO configuration VALUES (279,'クレジットカード利用の可否 - Discover Card','CC_ENABLED_DISCOVER','0','Discover Cardを有効にしますか?<br /><br />\r\n・0= off<br />\r\n・1= on',17,5,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO configuration VALUES (280,'クレジットカード利用の可否 - JCB','CC_ENABLED_JCB','0','JCBを有効にしますか?<br /><br />\r\n・0= off<br />\r\n・1= on',17,6,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO configuration VALUES (281,'クレジットカード利用の可否 - AUSTRALIAN BANKCARD','CC_ENABLED_AUSTRALIAN_BANKCARD','0','AUSTRALIAN BANKCARDを有効にしますか?<br /><br />\r\n・0= off<br />\r\n・1= on',17,7,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO configuration VALUES (282,'利用可能なクレジットカード - 支払いページに表示','SHOW_ACCEPTED_CREDIT_CARDS','0','利用可能なクレジットカードを支払いページに表示しますか?<br /><br />\r\n・0= off<br />\r\n・1= テキストを表示<br />\r\n・2= 画像を表示<br />\r\n【注意】クレジットカードの画像とテキストは、データベースとランゲージファイル内で定義されている必要があります。',17,50,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), ');
INSERT INTO configuration VALUES (283,'ギフト券の表示','MODULE_ORDER_TOTAL_GV_STATUS','true','',6,1,NULL,'2003-10-30 22:16:40',NULL,'zen_cfg_select_option(array(\'true\'),');
INSERT INTO configuration VALUES (284,'表示の整列順','MODULE_ORDER_TOTAL_GV_SORT_ORDER','840','表示の整列順を設定します。<br />数字が小さいほど上位に表示されます。',6,2,NULL,'2003-10-30 22:16:40',NULL,NULL);
INSERT INTO configuration VALUES (285,'購入を承認待ちに','MODULE_ORDER_TOTAL_GV_QUEUE','true','ギフト券購入を承認待ちリストに追加しますか?',6,3,NULL,'2003-10-30 22:16:40',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (286,'送料を含める','MODULE_ORDER_TOTAL_GV_INC_SHIPPING','true','合計計算に送料を含めますか?',6,5,NULL,'2003-10-30 22:16:40',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (287,'税金を含める','MODULE_ORDER_TOTAL_GV_INC_TAX','true','計算時に税金を含めるかどうかを設定します。',6,6,NULL,'2003-10-30 22:16:40',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (288,'税金を再計算','MODULE_ORDER_TOTAL_GV_CALC_TAX','None','税金を再計算しますか?',6,7,NULL,'2003-10-30 22:16:40',NULL,'zen_cfg_select_option(array(\'None\', \'Standard\', \'Credit Note\'),');
INSERT INTO configuration VALUES (289,'税種別','MODULE_ORDER_TOTAL_GV_TAX_CLASS','0','ギフト券に適用される税種別を設定します。',6,0,NULL,'2003-10-30 22:16:40','zen_get_tax_class_title','zen_cfg_pull_down_tax_classes(');
INSERT INTO configuration VALUES (290,'税金を付加する','MODULE_ORDER_TOTAL_GV_CREDIT_TAX','false','ギフト券を計算する際に税金を付加しますか?',6,8,NULL,'2003-10-30 22:16:40',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (1524,'テキストメールでの貨幣の変換','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_211','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1525,'配送モジュール','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_MODULES_OT_SHIPPING','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1526,'小計モジュール','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_MODULES_OT_SUBTOTAL','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1532,'小数点','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_SUPER_ORDERS_NUMBER_UNIT','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1533,'小数点','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_SALEMAKER_NUMBER_UNIT','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (958,'優先順','MODULE_EASY_ADMIN_SIMPLIFY_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,1,NULL,'2010-06-07 16:43:06',NULL,NULL);
INSERT INTO configuration VALUES (300,'送料の表示','MODULE_ORDER_TOTAL_SHIPPING_STATUS','true','',6,1,NULL,'2003-10-30 22:16:46',NULL,'zen_cfg_select_option(array(\'true\'),');
INSERT INTO configuration VALUES (301,'表示の整列順','MODULE_ORDER_TOTAL_SHIPPING_SORT_ORDER','200','表示の整列順を設定します。<br />\r\n数字が小さいほど上位に表示されます。',6,2,NULL,'2003-10-30 22:16:46',NULL,NULL);
INSERT INTO configuration VALUES (302,'送料無料設定','MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING','false','送料無料設定を有効にしますか?',6,3,NULL,'2003-10-30 22:16:46',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (303,'送料無料にする購入金額設定','MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER','50','設定金額以上のご購入の場合は送料を無料にします。',6,4,NULL,'2003-10-30 22:16:46','currencies->format',NULL);
INSERT INTO configuration VALUES (304,'送料無料にする地域の設定','MODULE_ORDER_TOTAL_SHIPPING_DESTINATION','national','設定した地域に対して送料無料を適用します。',6,5,NULL,'2003-10-30 22:16:46',NULL,'zen_cfg_select_option(array(\'national\', \'international\', \'both\'),');
INSERT INTO configuration VALUES (305,'小計の表示','MODULE_ORDER_TOTAL_SUBTOTAL_STATUS','true','',6,1,NULL,'2003-10-30 22:16:49',NULL,'zen_cfg_select_option(array(\'true\'),');
INSERT INTO configuration VALUES (306,'表示の整列順','MODULE_ORDER_TOTAL_SUBTOTAL_SORT_ORDER','100','表示の整列順を設定します。<br />\r\n数字が小さいほど上位に表示されます。',6,2,NULL,'2003-10-30 22:16:49',NULL,NULL);
INSERT INTO configuration VALUES (307,'税金の表示','MODULE_ORDER_TOTAL_TAX_STATUS','true','',6,1,NULL,'2003-10-30 22:16:52',NULL,'zen_cfg_select_option(array(\'true\'),');
INSERT INTO configuration VALUES (308,'表示の整列順','MODULE_ORDER_TOTAL_TAX_SORT_ORDER','300','表示の整列順を設定できます. 数字が小さいほど上位に表示されます。',6,2,NULL,'2003-10-30 22:16:52',NULL,NULL);
INSERT INTO configuration VALUES (309,'合計の表示','MODULE_ORDER_TOTAL_TOTAL_STATUS','true','',6,1,NULL,'2003-10-30 22:16:55',NULL,'zen_cfg_select_option(array(\'true\'),');
INSERT INTO configuration VALUES (310,'表示の整列順','MODULE_ORDER_TOTAL_TOTAL_SORT_ORDER','999','表示の整列順を設定できます。<br />\r\n数字が小さいほど上位に表示されます。',6,2,NULL,'2003-10-30 22:16:55',NULL,NULL);
INSERT INTO configuration VALUES (311,'税種別','MODULE_ORDER_TOTAL_COUPON_TAX_CLASS','0','クーポン券に適用される税種別を設定します。',6,0,NULL,'2003-10-30 22:16:36','zen_get_tax_class_title','zen_cfg_pull_down_tax_classes(');
INSERT INTO configuration VALUES (312,'税金を含める - オン/オフ','MODULE_ORDER_TOTAL_COUPON_INC_TAX','true','代金計算に税金を含めるかどうかを設定します。',6,6,NULL,'2003-10-30 22:16:36',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (313,'表示の整列順','MODULE_ORDER_TOTAL_COUPON_SORT_ORDER','280','表示の整列順を設定します。',6,2,NULL,'2003-10-30 22:16:36',NULL,NULL);
INSERT INTO configuration VALUES (314,'送料を含める','MODULE_ORDER_TOTAL_COUPON_INC_SHIPPING','false','送料を計算に含めるかどうかを設定します。',6,5,NULL,'2003-10-30 22:16:36',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (315,'クーポン券の表示','MODULE_ORDER_TOTAL_COUPON_STATUS','true','',6,1,NULL,'2003-10-30 22:16:36',NULL,'zen_cfg_select_option(array(\'true\'),');
INSERT INTO configuration VALUES (316,'税金を再計算','MODULE_ORDER_TOTAL_COUPON_CALC_TAX','Standard','税金を再計算しますか?',6,7,NULL,'2003-10-30 22:16:36',NULL,'zen_cfg_select_option(array(\'None\', \'Standard\', \'Credit Note\'),');
INSERT INTO configuration VALUES (317,'管理者デモ -オン/オフ','ADMIN_DEMO','0','管理者デモを有効にするかどうかを設定します。<br /><br />\r\n・0= off<br />\r\n・1= on',6,0,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO configuration VALUES (318,'商品オプション - セレクトボックス型','PRODUCTS_OPTIONS_TYPE_SELECT','0','セレクトボックス型の商品オプションの数値は?',0,NULL,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (319,'商品オプション - テキスト型','PRODUCTS_OPTIONS_TYPE_TEXT','1','テキスト型の商品オプションの数値は?',6,NULL,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (320,'商品オプション - ラジオボタン型','PRODUCTS_OPTIONS_TYPE_RADIO','2','ラジオボタン型の商品オプションの数値は?',6,NULL,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (321,'商品オプション - チェックボックス型','PRODUCTS_OPTIONS_TYPE_CHECKBOX','3','チェックボックス型の商品オプションの数値は?',6,NULL,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (322,'商品オプション - ファイル型','PRODUCTS_OPTIONS_TYPE_FILE','4','ファイル型の商品オプションの数値は?',6,NULL,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (323,'ID for text and file products options values','PRODUCTS_OPTIONS_VALUES_TEXT_ID','0','テキスト型・ファイル型属性のproducts_options_values_idで使われる数値は?',6,NULL,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (324,'アップロードオプションの接頭辞(Prefix)','UPLOAD_PREFIX','upload_','アップロードオプションを他のオプションと区別するために使う接頭辞(Prefix)は?',0,NULL,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (325,'テキストの接頭辞(Prefix)','TEXT_PREFIX','txt_','テキストオプションを他のオプションと区別するために使う接頭辞(Prefix)は?',0,NULL,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (326,'商品オプション - READ ONLY型','PRODUCTS_OPTIONS_TYPE_READONLY','5','READ ONLY型の商品オプションの数値は?',6,NULL,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (327,'商品情報 - 商品オプションのソート順','PRODUCTS_OPTIONS_SORT_ORDER','0','商品情報におけるオプション名のソート順を設定します。<br />\r\n<br />\r\n・0= ソート順、オプション名<br />\r\n・1= オプション名',18,35,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'),');
INSERT INTO configuration VALUES (328,'商品情報 - 商品オプション値のソート順','PRODUCTS_OPTIONS_SORT_BY_PRICE','1','商品説明での商品オプション値のソート順を設定します。<br />\r\n<br />\r\n・0= ソート順、価格<br />\r\n・1= ソート順、オプション値の名称',18,36,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'),');
INSERT INTO configuration VALUES (329,'商品の属性画像の下に表示するオプション値','PRODUCT_IMAGES_ATTRIBUTES_NAMES','1','商品の属性画像の下にオプション名を表示しますか?<br /><br />\r\n・0= off<br />\r\n・1= on',18,41,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO configuration VALUES (330,'商品情報 - セール割引表示','SHOW_SALE_DISCOUNT_STATUS','1','セール割引分を表示しますか?<br /><br />\r\n・0= off<br />\r\n・1= on',18,45,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO configuration VALUES (331,'商品情報 - セール割引の表示方法(割引額・パーセント)','SHOW_SALE_DISCOUNT','1','セール割引の表示方法を設定します。<br /><br />\r\n・1= 割引率(%) でのoff<br />\r\n・2= 割引金額 でのoff',18,46,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'1\', \'2\'), ');
INSERT INTO configuration VALUES (332,'商品情報 - 割引率表示の小数点','SHOW_SALE_DISCOUNT_DECIMALS','0','割引率表示のパーセントの小数点位置を設定します。<br /><br />\r\n・デフォルト= 0',18,47,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (333,'商品情報- 無料商品の画像・テキストのステータス','OTHER_IMAGE_PRICE_IS_FREE_ON','1','商品情報での無料商品の画像・イメージの表示を設定します。<br />\r\n<br />\r\n・0= Text<br />\r\n・1= Image',18,50,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO configuration VALUES (334,'商品情報 - お問い合わせ商品表示設定','PRODUCTS_PRICE_IS_CALL_IMAGE_ON','1','お問い合わせ商品であることを表示する画像またはテキストについて設定します。<br /><br />\r\n・0= テキスト<br />\r\n・1= 画像',18,51,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO configuration VALUES (335,'商品の数量欄 - 新しく商品を追加する際に','PRODUCTS_QTY_BOX_STATUS','1','新しく商品を登録する際、商品の数量欄のデフォルト設定をどうしますか?<br /><br />\r\n・0= off<br />\r\n・1= on<br />\r\n注意：onにすると数量欄を表示し、「カートに加える」もonになります。(This will show a Qty Box when ON and default the Add to Cart to 1)',18,55,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO configuration VALUES (336,'商品レビュー - 承認の要否','REVIEWS_APPROVAL','1','商品レビューの表示には承認が必要にしますか?<br /><br />\r\n・0= off<br />\r\n・1= on<br />\r\n注意：レビューが非表示設定になっている場合は無視されます。',18,62,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO configuration VALUES (337,'METAタグ - TITLEタグへの商品価格表示','META_TAG_INCLUDE_PRICE','1','TITLEタグに商品価格を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1= on',18,70,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO configuration VALUES (338,'METAタグ - Meta Descriptionの長さ','MAX_META_TAG_DESCRIPTION_LENGTH','50','Meta Descriptionの最大の長さを設定してください。<br />デフォルトの最大値(ワード数)：50',18,71,NULL,'2009-11-19 12:39:39','','');
INSERT INTO configuration VALUES (339,'「こんな商品も購入しています」 - 横列あたりの表示点数','SHOW_PRODUCT_INFO_COLUMNS_ALSO_PURCHASED_PRODUCTS','3','「こんな商品も買っています」の横列(Row)あたりの表示点数を設定します。<br />0= off またはソート順を設定',18,72,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\', \'5\', \'6\', \'7\', \'8\', \'9\', \'10\', \'11\', \'12\'), ');
INSERT INTO configuration VALUES (340,'[前へ] [次へ] - ナビゲーションバーの位置','PRODUCT_INFO_PREVIOUS_NEXT','1','[前へ] [次へ] ナビゲーションバーの位置を設定します。<br /><br />\r\n・0= off<br />\r\n・1= ページ上部<br />\r\n・2= ページ下部<br />\r\n・3= ページ上部・下部',18,21,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Off\'), array(\'id\'=>\'1\', \'text\'=>\'Top of Page\'), array(\'id\'=>\'2\', \'text\'=>\'Bottom of Page\'), array(\'id\'=>\'3\', \'text\'=>\'Both Top & Bottom of Page\')),');
INSERT INTO configuration VALUES (341,'[前へ] [次へ] - ソート順','PRODUCT_INFO_PREVIOUS_NEXT_SORT','1','商品のソート順を設定します。\r\n<br /><br />\r\n・0= 商品ID<br />\r\n・1= 商品名<br />\r\n・2= 型番<br />\r\n・3= 価格、商品名<br />\r\n・4= 価格、型番<br />\r\n・5= 商品名, 型番',18,22,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Product ID\'), array(\'id\'=>\'1\', \'text\'=>\'Name\'), array(\'id\'=>\'2\', \'text\'=>\'Product Model\'), array(\'id\'=>\'3\', \'text\'=>\'Product Price - Name\'), array(\'id\'=>\'4\', \'text\'=>\'Product Price - Model\'), array(\'id\'=>\'5\', \'text\'=>\'Product Name - Model\'), array(\'id\'=>\'6\', \'text\'=>\'Product Sort Order\')),');
INSERT INTO configuration VALUES (342,'[前へ] [次へ] - ボタンと画像のステータス','SHOW_PREVIOUS_NEXT_STATUS','0','ボタンと画像のステータスを設定します。<br /><br />\r\n・0= Off<br />\r\n・1= On',18,20,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Off\'), array(\'id\'=>\'1\', \'text\'=>\'On\')),');
INSERT INTO configuration VALUES (343,'[前へ] [次へ] - ボタンと画像の表示設定','SHOW_PREVIOUS_NEXT_IMAGES','0','[前へ] [次へ] のボタンと画像の表示を設定します。<br /><br />\r\n・0= ボタンのみ<br />\r\n・1= ボタン・商品画像<br />\r\n・2= 商品画像のみ',18,21,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Button Only\'), array(\'id\'=>\'1\', \'text\'=>\'Button and Product Image\'), array(\'id\'=>\'2\', \'text\'=>\'Product Image Only\')),');
INSERT INTO configuration VALUES (344,'[前へ] [次へ] - 画像の横幅','PREVIOUS_NEXT_IMAGE_WIDTH','50','[前へ] [次へ] 画像の横幅の横幅は?',18,22,NULL,'2009-11-19 12:39:39','','');
INSERT INTO configuration VALUES (345,'[前へ] [次へ] - 画像の高さ','PREVIOUS_NEXT_IMAGE_HEIGHT','40','[前へ] [次へ] 画像の横幅の高さは?',18,23,NULL,'2009-11-19 12:39:39','','');
INSERT INTO configuration VALUES (346,'[前へ] [次へ] - カテゴリ名と画像の配置','PRODUCT_INFO_CATEGORIES','1','[前へ] [次へ] のカテゴリの画像と名称の配置は?<br /><br />\r\n・0= off<br />\r\n・1= 左に配置<br />\r\n・2= 中央に配置<br />\r\n・3= 右に配置',18,20,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Off\'), array(\'id\'=>\'1\', \'text\'=>\'Align Left\'), array(\'id\'=>\'2\', \'text\'=>\'Align Center\'), array(\'id\'=>\'3\', \'text\'=>\'Align Right\')),');
INSERT INTO configuration VALUES (347,'左側サイドボックスの横幅','BOX_WIDTH_LEFT','150px','左側に表示されるサイドボックスの横幅を設定します。pxを含めて入力できます。\r\n<br /><br />\r\n・デフォルト = 150px',19,1,NULL,'2003-11-21 22:16:36',NULL,NULL);
INSERT INTO configuration VALUES (348,'右側サイドボックスの横幅','BOX_WIDTH_RIGHT','150px','右側に表示されるサイドボックスの横幅を設定します。pxを含めて入力できます。<br /><br />\r\n・Default = 150px',19,2,NULL,'2003-11-21 22:16:36',NULL,NULL);
INSERT INTO configuration VALUES (349,'パン屑リストの区切り文字','BREAD_CRUMBS_SEPARATOR','&nbsp;::&nbsp;','パン屑リストの区切り文字を設定します。<br /><br />\r\n【注意】空白を含む場合は&amp;nbsp;を使用することができます。<br />\r\n・デフォルト = &amp;nbsp;::&amp;nbsp;',19,3,NULL,'2003-11-21 22:16:36',NULL,'zen_cfg_textarea_small(');
INSERT INTO configuration VALUES (350,'パン屑リストの設定','DEFINE_BREADCRUMB_STATUS','1','パン屑リストのリンクを有効にしますか?<br />0= OFF<br />1= ON',19,4,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO configuration VALUES (351,'ベストセラー - 桁数合わせ文字','BEST_SELLERS_FILLER','&nbsp;','桁数を合わせるために挿入する文字を設定します。<br />デフォルト = &amp;nbsp;(空白)',19,5,NULL,'2003-11-21 22:16:36',NULL,'zen_cfg_textarea_small(');
INSERT INTO configuration VALUES (352,'ベストセラー - 表示文字数','BEST_SELLERS_TRUNCATE','35','ベストセラーのサイドボックスで表示する商品名の長さを設定します。<br />デフォルト = 35',19,6,NULL,'2003-11-21 22:16:36',NULL,NULL);
INSERT INTO configuration VALUES (353,'ベストセラー - 表示文字数を超えた場合に「...」を表示','BEST_SELLERS_TRUNCATE_MORE','true','商品名が途中で切れた場合に「...」を表示します。<br />デフォルト = true',19,7,'2003-03-21 13:08:25','2003-03-21 11:42:47',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (354,'カテゴリボックス - 特価商品のリンク表示','SHOW_CATEGORIES_BOX_SPECIALS','true','カテゴリボックスに特価商品のリンクを表示します。',19,8,'2003-03-21 13:08:25','2003-03-21 11:42:47',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (355,'カテゴリボックス - 新着商品のリンク表示','SHOW_CATEGORIES_BOX_PRODUCTS_NEW','true','カテゴリボックスに新着商品へのリンクを表示します。',19,9,'2003-03-21 13:08:25','2003-03-21 11:42:47',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (356,'ショッピングカートボックスの表示','SHOW_SHOPPING_CART_BOX_STATUS','1','ショッピングカートの表示を設定します。<br />\r\n<br />\r\n・0= 常に表示<br />\r\n・1= 商品が入っているときだけ表示<br />\r\n・2= 商品が入っているときに表示するが、ショッピングカートページでは表示しない',19,10,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), ');
INSERT INTO configuration VALUES (357,'カテゴリボックス - おすすめ商品へのリンクを表示','SHOW_CATEGORIES_BOX_FEATURED_PRODUCTS','true','カテゴリボックスにおすすめ商品へのリンクを表示しますか?',19,11,'2003-03-21 13:08:25','2003-03-21 11:42:47',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (358,'カテゴリボックス - 全商品リストへのリンクを表示','SHOW_CATEGORIES_BOX_PRODUCTS_ALL','true','カテゴリボックスに全商品リストへのリンクを表示しますか?',19,12,'2003-03-21 13:08:25','2003-03-21 11:42:47',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (359,'左側カラムの表示','COLUMN_LEFT_STATUS','1','左側カラムを表示しますか? (ページをオーバーライドするものがない場合)<br /><br />\r\n・0= 常に非表示<br />\r\n1= オーバーライドがなければ表示',19,15,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO configuration VALUES (360,'右側カラムの表示','COLUMN_RIGHT_STATUS','1','右側カラムを表示しますか? (ページをオーバーライドするものがない場合)<br /><br />\r\n・0= 常に非表示<br />\r\n・1= オーバーライドがなければ表示',19,16,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO configuration VALUES (361,'左側カラムの横幅','COLUMN_WIDTH_LEFT','150px','左側カラムの横幅を設定します。pxを含めて指定可能。<br /><br />\r\nデフォルト = 150px',19,20,NULL,'2003-11-21 22:16:36',NULL,NULL);
INSERT INTO configuration VALUES (362,'右側カラムの横幅','COLUMN_WIDTH_RIGHT','150px','右側カラムの横幅を設定します。pxを含めて指定可能。<br /><br />\r\nデフォルト = 150px',19,21,NULL,'2003-11-21 22:16:36',NULL,NULL);
INSERT INTO configuration VALUES (363,'カテゴリ名・リンク間の区切り','SHOW_CATEGORIES_SEPARATOR_LINK','1','カテゴリ名とリンク（「おすすめ商品」など）の間にセパレータ(区切り)を表示しますか?<br /><br />\r\n・0= off<br />\r\n・1= on',19,24,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO configuration VALUES (364,'カテゴリの区切り - カテゴリ名・商品数','CATEGORIES_SEPARATOR','-&gt;','カテゴリ名と(カテゴリ内の)商品数の間のセパレータ(区切り)は何にしますか?<br /><br />\r\nデフォルト = -&amp;gt;',19,25,NULL,'2003-11-21 22:16:36',NULL,'zen_cfg_textarea_small(');
INSERT INTO configuration VALUES (365,'カテゴリの区切り - カテゴリ名とサブカテゴリ名の間','CATEGORIES_SEPARATOR_SUBS','|_&nbsp;','カテゴリ名・サブカテゴリ名の間のセパレータ(区切り)は何にしますか?<br />\r\n<br />\r\nデフォルト = |_&amp;nbsp;',19,26,NULL,'2004-03-25 22:16:36',NULL,'zen_cfg_textarea_small(');
INSERT INTO configuration VALUES (366,'カテゴリ内商品数の接頭辞(Prefix)','CATEGORIES_COUNT_PREFIX','&nbsp;(','カテゴリ内の商品数表示の接頭辞(Prefix)は?\r\n<br /><br />\r\n・デフォルト= (',19,27,NULL,'2003-01-21 22:16:36',NULL,'zen_cfg_textarea_small(');
INSERT INTO configuration VALUES (367,'カテゴリ内商品数の接尾辞(Suffix)','CATEGORIES_COUNT_SUFFIX',')','カテゴリ内の商品数表示の接尾辞(Suffix)は?\r\n<br /><br />\r\n・デフォルト= )',19,28,NULL,'2003-01-21 22:16:36',NULL,'zen_cfg_textarea_small(');
INSERT INTO configuration VALUES (368,'カテゴリ・サブカテゴリのインデント','CATEGORIES_SUBCATEGORIES_INDENT','&nbsp;&nbsp;','サブカテゴリをインデント(字下げ)表示する際の文字・記号は?<br /><br />\r\n・デフォルト = &nbsp;&nbsp;',19,29,NULL,'2004-06-24 22:16:36',NULL,'zen_cfg_textarea_small(');
INSERT INTO configuration VALUES (369,'商品登録0のカテゴリ - 表示・非表示','CATEGORIES_COUNT_ZERO','0','商品数が0のカテゴリを表示しますか?<br />\r\n<br />\r\n・0 = off<br />\r\n・1 = on',19,30,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO configuration VALUES (370,'カテゴリボックスのスプリット(分割)表示','CATEGORIES_SPLIT_DISPLAY','True','商品タイプによってカテゴリボックスをスプリット(分割)表示するかどうかを設定します。',19,31,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO configuration VALUES (371,'ショッピングカート - 合計を表示','SHOW_TOTALS_IN_CART','1','合計額をショッピングカートの上に表示しますか?<br />・0= off<br />・1= on: 商品の数量、重量合計<br />・2= on: 商品の数量、重量合計(0のときには非表示)<br />・3= on: 商品の数量合計',19,31,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'), ');
INSERT INTO configuration VALUES (372,'顧客への挨拶 - トップページに表示','SHOW_CUSTOMER_GREETING','1','顧客への歓迎メッセージを常にトップページに表示しますか?<br />0= off<br />1= on',19,40,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO configuration VALUES (373,'カテゴリ - トップページに表示','SHOW_CATEGORIES_ALWAYS','0','カテゴリを常にトップページに表示しますか?<br />\r\n・0= off<br />\r\n・1= on<br />\r\n・Default category can be set to Top Level or a Specific Top Level',19,45,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO configuration VALUES (374,'カテゴリ - トップページ での開閉','CATEGORIES_START_MAIN','0','トップページにおけるカテゴリの開閉状態を設定します。<br />\r\n・0= トップレベル(親)カテゴリのみ<br />\r\n・特定のカテゴリを開くにはカテゴリIDで指定。サブカテゴリも指定可能。<br />\r\n【例】3_10 (カテゴリID:3、サブカテゴリID:10)',19,46,NULL,'2009-11-19 12:39:39','','');
INSERT INTO configuration VALUES (375,'カテゴリ - サブカテゴリを常に開いておく','SHOW_CATEGORIES_SUBCATEGORIES_ALWAYS','1','カテゴリとサブカテゴリは常に表示しますか?<br />0= OFF 親カテゴリのみ<br />1= ON カテゴリ・サブカテゴリは選択されたら常に表示',19,47,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO configuration VALUES (376,'バナー表示グループ - ヘッダポジション1','SHOW_BANNERS_GROUP_SET1','','どのバナーグループをヘッダポジション1に使用しますか? 使わない場合は未記入にします。<br />\r\n<br />\r\nバナー表示グループは1つ(1バナーグループ)または複数(マルチバナーグループ)にすることもできます。マルチバナーグループを表示するためにはグループ名をコロン(<strong>:</strong>)で区切って入力します。<br />\r\n例：Wide-Banners:SideBox-Banners',19,55,NULL,'2009-11-19 12:39:39','','');
INSERT INTO configuration VALUES (377,'バナー表示グループ - ヘッダポジション2','SHOW_BANNERS_GROUP_SET2','','どのバナーグループをヘッダポジション2に使用しますか? 使わない場合は未記入にします。<br />\r\n<br />\r\nバナー表示グループは1つ(1バナーグループ)または複数(マルチバナーグループ)にすることもできます。マルチバナーグループを表示するためにはグループ名をコロン(<strong>:</strong>)で区切って入力します。<br />\r\n例：Wide-Banners:SideBox-Banners',19,56,NULL,'2009-11-19 12:39:39','','');
INSERT INTO configuration VALUES (378,'バナー表示グループ - ヘッダポジション3','SHOW_BANNERS_GROUP_SET3','','どのバナーグループをヘッダポジション3に使用しますか? 使わない場合は未記入にします。<br />\r\n<br />\r\nバナー表示グループは1つ(1バナーグループ)または複数(マルチバナーグループ)にすることもできます。マルチバナーグループを表示するためにはグループ名をコロン(<strong>:</strong>)で区切って入力します。<br />\r\n例：Wide-Banners:SideBox-Banners',19,57,NULL,'2009-11-19 12:39:39','','');
INSERT INTO configuration VALUES (379,'バナー表示グループ - フッタポジション1','SHOW_BANNERS_GROUP_SET4','','どのバナーグループをフッタポジション1に使用しますか? 使わない場合は未記入にします。<br />\r\n<br />\r\nバナー表示グループは1つ(1バナーグループ)または複数(マルチバナーグループ)にすることもできます。マルチバナーグループを表示するためにはグループ名をコロン(<strong>:</strong>)で区切って入力します。<br />\r\n例：Wide-Banners:SideBox-Banners',19,65,NULL,'2009-11-19 12:39:39','','');
INSERT INTO configuration VALUES (380,'バナー表示グループ - フッタポジション2','SHOW_BANNERS_GROUP_SET5','','どのバナーグループをフッタポジション2に使用しますか? 使わない場合は未記入にします。<br />\r\n<br />\r\nバナー表示グループは1つ(1バナーグループ)または複数(マルチバナーグループ)にすることもできます。マルチバナーグループを表示するためにはグループ名をコロン(<strong>:</strong>)で区切って入力します。<br />\r\n例：Wide-Banners:SideBox-Banners',19,66,NULL,'2009-11-19 12:39:39','','');
INSERT INTO configuration VALUES (381,'バナー表示グループ - フッタポジション3','SHOW_BANNERS_GROUP_SET6','Wide-Banners','どのバナーグループをフッタポジション3に使用しますか? 使わない場合は未記入にします。<br />\r\n<br />\r\nバナー表示グループは1つ(1バナーグループ)または複数(マルチバナーグループ)にすることもできます。マルチバナーグループを表示するためにはグループ名をコロン(<strong>:</strong>)で区切って入力します。<br />\r\n例：Wide-Banners:SideBox-Banners',19,67,NULL,'2009-11-19 12:39:39','','');
INSERT INTO configuration VALUES (382,'バナー表示グループ - サイドボックス内バナーボックス','SHOW_BANNERS_GROUP_SET7','SideBox-Banners','どのバナーグループをサイドボックス内バナーボックス2に使用しますか? 使わない場合は未記入にします。<br />\r\nデフォルトのグループはSideBox-Bannersです。<br />\r\n<br />\r\nバナー表示グループは1つ(1バナーグループ)または複数(マルチバナーグループ)にすることもできます。マルチバナーグループを表示するためにはグループ名をコロン(<strong>:</strong>)で区切って入力します。<br />\r\n例：Wide-Banners:SideBox-Banners',19,70,NULL,'2009-11-19 12:39:39','','');
INSERT INTO configuration VALUES (383,'バナー表示グループ - サイドボックス内バナーボックス2','SHOW_BANNERS_GROUP_SET8','SideBox-Banners','どのバナーグループをサイドボックス内バナーボックス2に使用しますか? 使わない場合は未記入にします。<br />\r\nデフォルトのグループはSideBox-Bannersです。<br />\r\n<br />\r\nバナー表示グループは1つ(1バナーグループ)または複数(マルチバナーグループ)にすることもできます。マルチバナーグループを表示するためにはグループ名をコロン(<strong>:</strong>)で区切って入力します。<br />\r\n例：Wide-Banners:SideBox-Banners',19,71,NULL,'2009-11-19 12:39:39','','');
INSERT INTO configuration VALUES (384,'バナー表示グループ - サイドボックス内バナーボックス全て','SHOW_BANNERS_GROUP_SET_ALL','BannersAll','サイドボックス内バナーボックス全て(Banner All sidebox)で表示するバナー表示グループは、1つです。デフォルトのグループはBannersAllです。どのバナーグループをサイドボックスのbanner_box_allに表示しますか?<br />表示しない場合は空欄にしてください。',19,72,NULL,'2009-11-19 12:39:39','','');
INSERT INTO configuration VALUES (385,'フッタ - IPアドレスの表示・非表示','SHOW_FOOTER_IP','1','顧客のIPアドレスをフッタに表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1= on<br />',19,80,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO configuration VALUES (386,'数量割引 - 追加割引レベル数','DISCOUNT_QTY_ADD','5','数量割引の割引レベルの追加数を指定します。一つの割引レベルに一つの割引設定を行うことができます。',19,90,NULL,'2009-11-19 12:39:39','','');
INSERT INTO configuration VALUES (387,'数量割引 - 一行あたりの表示数','DISCOUNT_QUANTITY_PRICES_COLUMN','5','商品情報ページで表示する数量割引設定の一行あたり表示数を指定します。割引設定数（割引レベル数）が一行あたりの表示数を超えた場合は、複数行で表示されます。',19,95,NULL,'2009-11-19 12:39:39','','');
INSERT INTO configuration VALUES (388,'カテゴリ/商品のソート順','CATEGORIES_PRODUCTS_SORT_ORDER','0','カテゴリ/商品のソート順を設定します。<br />0= カテゴリ/商品 ソート順/名前<br />1= カテゴリ/商品 名前<br />2= 商品モデル<br />3= 商品数量+, 商品名<br />4= 商品数量-, 商品名<br />5= 商品価格+, 商品名<br />6= 商品価格+, 商品名',19,100,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\', \'5\', \'6\'), ');
INSERT INTO configuration VALUES (389,'オプション名/オプション値の追加・コピー・削除','OPTION_NAMES_VALUES_GLOBAL_STATUS','1','オプション名/オプション値の追加・コピー・削除の機能についてのグローバルな設定を行います。<br />0= 機能を隠す<br />1= 機能を表示する<br />2= 商品モデル',19,110,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO configuration VALUES (390,'カテゴリ - タブメニュー','CATEGORIES_TABS_STATUS','1','カテゴリ - タブをオンにするとショップ画面のヘッダ部分にカテゴリが表示されます。さまざまな応用ができるでしょう。<br />0= カテゴリのタブを隠す<br />1= カテゴリのタブを表示',19,112,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO configuration VALUES (391,'サイトマップ - Myページの表示','SHOW_ACCOUNT_LINKS_ON_SITE_MAP','No','Myページのリンクをサイトマップに表示しますか?<br />注意：サーチエンジンのクローラーがこのページをインデックスしようとしてログインページに誘導されてしまう可能性があり、お勧めしません。<br /><br />デフォルト：false (表示しない)',19,115,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'Yes\', \'No\'), ');
INSERT INTO configuration VALUES (392,'1商品だけのカテゴリの表示をスキップ','SKIP_SINGLE_PRODUCT_CATEGORIES','False','商品が1つだけのカテゴリの表示をスキップしますか?<br />このオプションがTrueの場合、ユーザーが商品が1つだけのカテゴリをクリックすると、Zen Cartは直接商品ページを表示するようになります。<br />デフォルト：True',19,120,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO configuration VALUES (393,'CSSボタン','IMAGE_USE_CSS_BUTTONS','No','CSS画像(gif/jpg)の代わりにボタンを表示しますか?<br />ONにした場合、ボタンのスタイルはスタイルシートで定義してください。',19,147,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'No\', \'Yes\'), ');
INSERT INTO configuration VALUES (394,'<strong>「メンテナンス中」 オン/オフ</strong>','DOWN_FOR_MAINTENANCE','false','「メンテナンス中」の表示について設定します。<br />\r\n<br />\r\n・true=on\r\n・false=off',20,1,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (395,'「メンテナンス中」- 表示するファイル','DOWN_FOR_MAINTENANCE_FILENAME','down_for_maintenance','メンテナンス中に表示するファイルのファイル名を設定します。デフォルトは\"down_for_maintenance\"です。<br /><br />\r\n【注意】拡張子は付けないでください。',20,2,NULL,'2009-11-19 12:39:39',NULL,'');
INSERT INTO configuration VALUES (396,'「メンテナンス中」- ヘッダを隠す','DOWN_FOR_MAINTENANCE_HEADER_OFF','false','「メンテナンス中」表示モードの際、ヘッダを隠しますか?<br /><br />\r\n・true=hide<br />\r\n・false=show',20,3,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (397,'「メンテナンス中」- 左カラムを隠す','DOWN_FOR_MAINTENANCE_COLUMN_LEFT_OFF','false','「メンテナンス中」表示モードの際、左カラムを隠しますか?<br /><br />\r\n・true=hide<br />\r\n・false=show',20,4,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (398,'「メンテナンス中」- 右カラムを隠す','DOWN_FOR_MAINTENANCE_COLUMN_RIGHT_OFF','false','「メンテナンス中」表示モードの際、右カラムを隠しますか?<br /><br />\r\n・true=hide<br />\r\n・false=show',20,5,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (399,'「メンテナンス中」- フッタを隠す','DOWN_FOR_MAINTENANCE_FOOTER_OFF','false','「メンテナンス中」表示モードの際、フッタを隠しますか?<br /><br />\r\n・true=hide<br />\r\n・false=show',20,6,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (400,'「メンテナンス中」- 価格を表示しない','DOWN_FOR_MAINTENANCE_PRICES_OFF','false','「メンテナンス中」表示モードの際、商品価格を隠しますか?<br /><br />\r\n・true=hide<br />\r\n・false=show',20,7,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (401,'「メンテナンス中」- 設定したIPアドレスを除く','EXCLUDE_ADMIN_IP_FOR_MAINTENANCE','your IP (ADMIN)','ショップ管理者用などに、「メンテナンス中」表示モードの際でもアクセス可能なIPアドレスを設定しますか?<br /><br />\r\n複数のIPアドレスを指定するにはカンマ(,)で区切ります。また、あなたのアクセス元のIPアドレスがわからない場合は、ショップのフッタに表示されるIPアドレスをチェックしてください。',20,8,'2003-03-21 13:43:22','2003-03-21 21:20:07',NULL,NULL);
INSERT INTO configuration VALUES (402,'「メンテナンス予告(NOTICE PUBLIC)」-  オン/オフ','WARN_BEFORE_DOWN_FOR_MAINTENANCE','false','ショップの「メンテナンス中」表示を出す前に告知を出しますか?<br /><br />\r\n・true=on<br />\r\n・false=off<br />\r\n注意：「メンテナンス中」表示が有効になると、この設定は自動的にfalseに書き換えられます。',20,9,'2003-03-21 13:08:25','2003-03-21 11:42:47',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (403,'「メンテナンス予告」- メッセージに表示する日時','PERIOD_BEFORE_DOWN_FOR_MAINTENANCE','15/05/2003  2-3 PM','ヘッダに表示するメンテナンス予告メッセージの開始日と時間を設定します。',20,10,'2003-03-21 13:08:25','2003-03-21 11:42:47',NULL,NULL);
INSERT INTO configuration VALUES (404,'「メンテナンス中」- メンテナンスを開始した日時(when webmaster has enabled maintenance)を表示','DISPLAY_MAINTENANCE_TIME','false','ショップ管理者がいつ「メンテナンス中」表示をオンにしたか表示しますか?<br /><br />\r\n・true=on<br />\r\n・false=off',20,11,'2003-03-21 13:08:25','2003-03-21 11:42:47',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (405,'「メンテナンス中」- メンテナンス期間を表示','DISPLAY_MAINTENANCE_PERIOD','false','メンテナンスの期間を表示しますか?<br /><br />\r\n・true=on<br />\r\n・false=off',20,12,'2003-03-21 13:08:25','2003-03-21 11:42:47',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (406,'メンテナンス期間','TEXT_MAINTENANCE_PERIOD_TIME','2h00','メンテナンス期間を設定します。<br />\r\n書式：(hh:mm)<br />h = 時間　m = 分',20,13,'2003-03-21 13:08:25','2003-03-21 11:42:47',NULL,NULL);
INSERT INTO configuration VALUES (407,'チェックアウト時に「ご利用規約」確認画面を表示','DISPLAY_CONDITIONS_ON_CHECKOUT','false','チェックアウトの際に「ご利用規約」の画面を表示しますか?',11,1,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (408,'アカウント作成時に個人情報保護方針確認画面を表示','DISPLAY_PRIVACY_CONDITIONS','true','アカウント作成の際、個人情報保護方針への同意画面を表示しますか?<br /><div style=\"color: red;\">注意：「個人情報保護法」では、個人情報保護方針を開示することが求められています。</div>',11,2,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (409,'商品画像を表示','PRODUCT_NEW_LIST_IMAGE','1102','商品画像を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',21,1,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (410,'商品の数量を表示','PRODUCT_NEW_LIST_QUANTITY','1202','商品数量を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',21,2,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (411,'「今すぐ買う」ボタンの表示','PRODUCT_NEW_BUY_NOW','1300','「今すぐ買う」ボタンを表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',21,3,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (412,'商品名の表示','PRODUCT_NEW_LIST_NAME','2101','商品名を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',21,4,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (413,'商品型番の表示','PRODUCT_NEW_LIST_MODEL','2201','商品型番を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',21,5,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (414,'商品メーカーの表示','PRODUCT_NEW_LIST_MANUFACTURER','2302','商品メーカーを表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',21,6,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (415,'商品価格の表示','PRODUCT_NEW_LIST_PRICE','2402','商品価格を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',21,7,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (416,'商品重量の表示','PRODUCT_NEW_LIST_WEIGHT','2502','商品の重量を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',21,8,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (417,'商品登録日の表示','PRODUCT_NEW_LIST_DATE_ADDED','2601','商品登録日を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',21,9,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (418,'商品説明の表示','PRODUCT_NEW_LIST_DESCRIPTION','1','商品説明(最初の150文字)を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1= on',21,10,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO configuration VALUES (419,'商品の表示 - デフォルトのソート順','PRODUCT_NEW_LIST_SORT_DEFAULT','6','新着商品リストの表示のデフォルトのソート順は? デフォルト値は6です。<br /><br />\r\n・1= 商品名<br />\r\n・2= 商品名(降順)<br />\r\n・3= 価格が安いものから商品名<br />\r\n・4= 価格が高いものから商品名<br />\r\n・5= 型番<br />\r\n・6= 商品登録日(降順)<br />\r\n・7= 商品登録日<br />\r\n・8= 商品順(Product Sort)\r\n',21,11,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'1\', \'2\', \'3\', \'4\', \'5\', \'6\', \'7\', \'8\'), ');
INSERT INTO configuration VALUES (420,'新着商品 - デフォルトのグループID','PRODUCT_NEW_LIST_GROUP_ID','21','新着商品リストの設定グループID(configuration_group_id)は何ですか?<br />\r\n<br />\r\n注意：全商品リストのグループIDがデフォルトの21から変更されたときだけ設定してください。',21,12,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (421,'複数商品の数量欄の有無・表示位置','PRODUCT_NEW_LISTING_MULTIPLE_ADD_TO_CART','3','複数商品の数量欄の表示の有無と表示位置について設定します。<br />0= off<br />1= 上部<br />2= 下部<br />3= 両方',21,25,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'), ');
INSERT INTO configuration VALUES (422,'商品画像の表示','PRODUCT_FEATURED_LIST_IMAGE','1102','商品画像を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />\r\n',22,1,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (423,'商品数量の表示','PRODUCT_FEATURED_LIST_QUANTITY','1202','商品数量を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />\r\n',22,2,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (424,'「今すぐ買う」ボタンの表示','PRODUCT_FEATURED_BUY_NOW','1300','「今すぐ買う」ボタンを表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',22,3,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (425,'商品名の表示','PRODUCT_FEATURED_LIST_NAME','2101','商品名を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',22,4,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (426,'商品型番の表示','PRODUCT_FEATURED_LIST_MODEL','2201','商品型番を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',22,5,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (427,'商品メーカーの表示','PRODUCT_FEATURED_LIST_MANUFACTURER','2302','商品メーカーを表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',22,6,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (428,'商品価格の表示','PRODUCT_FEATURED_LIST_PRICE','2402','商品価格を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',22,7,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (429,'商品重量の表示','PRODUCT_FEATURED_LIST_WEIGHT','2502','商品重量を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',22,8,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (430,'商品登録日の表示','PRODUCT_FEATURED_LIST_DATE_ADDED','2601','商品登録日を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',22,9,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (431,'商品説明の表示','PRODUCT_FEATURED_LIST_DESCRIPTION','1','商品説明(最初の150文字)を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1= on',22,10,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO configuration VALUES (432,'商品表示 - デフォルトのソート順','PRODUCT_FEATURED_LIST_SORT_DEFAULT','1','おすすめ商品リストの表示のデフォルトのソート順は? デフォルト値は1です。<br />\r\n<br />\r\n・1= 商品名<br />\r\n・2= 商品名(降順)<br />\r\n・3= 価格が安いものから、商品名<br />\r\n・4= 価格が高いものから、商品名<br />\r\n・5= 型番<br />\r\n・6= 商品登録日(降順)<br />\r\n・7= 商品登録日<br />\r\n・8= 商品順(Product Sort)',22,11,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'1\', \'2\', \'3\', \'4\', \'5\', \'6\', \'7\', \'8\'), ');
INSERT INTO configuration VALUES (433,'おすすめ商品 - デフォルトのグループID','PRODUCT_FEATURED_LIST_GROUP_ID','22','おすすめ商品リストの設定グループID(configuration_group_id)は何ですか?<br />\r\n<br />\r\n注意：おすすめ商品リストのグループIDがデフォルトの22から変更されたときだけ設定してください。\r\n',22,12,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (434,'複数商品の数量欄の有無・表示位置','PRODUCT_FEATURED_LISTING_MULTIPLE_ADD_TO_CART','3','複数商品の数量欄の表示の有無と表示位置について設定します。<br />0= off<br />1= 上部<br />2= 下部<br />3= 両方',22,25,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'), ');
INSERT INTO configuration VALUES (435,'商品画像の表示','PRODUCT_ALL_LIST_IMAGE','1102','商品画像を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',23,1,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (436,'商品数量の表示','PRODUCT_ALL_LIST_QUANTITY','1202','商品数量を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',23,2,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (437,'「今すぐ買う」ボタンの表示','PRODUCT_ALL_BUY_NOW','1300','「今すぐ買う」ボタンを表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',23,3,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (438,'商品価格の表示','PRODUCT_ALL_LIST_NAME','2101','商品価格を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',23,4,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (439,'商品型番の表示','PRODUCT_ALL_LIST_MODEL','2201','商品型番を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',23,5,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (440,'商品メーカーの表示','PRODUCT_ALL_LIST_MANUFACTURER','2302','商品メーカーを表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',23,6,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (441,'商品価格の表示','PRODUCT_ALL_LIST_PRICE','2402','商品価格を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',23,7,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (442,'商品重量の表示','PRODUCT_ALL_LIST_WEIGHT','2502','商品重量を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',23,8,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (443,'商品登録日の表示','PRODUCT_ALL_LIST_DATE_ADDED','2601','商品登録日を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />',23,9,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (444,'商品説明の表示','PRODUCT_ALL_LIST_DESCRIPTION','1','商品説明(最初の150文字)を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1= on',23,10,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO configuration VALUES (445,'商品表示 - デフォルトのソート順','PRODUCT_ALL_LIST_SORT_DEFAULT','1','全商品リストの表示のデフォルトのソート順は? デフォルト値は1です。<br />\r\n<br />\r\n・1= 商品名<br />\r\n・2= 商品名(降順)<br />\r\n・3= 価格が安いものから、商品名<br />\r\n・4= 価格が高いものから、商品名<br />\r\n・5= 型番<br />\r\n・6= 商品登録日(降順)<br />\r\n・7= 商品登録日<br />\r\n・8= 商品順(Product Sort)',23,11,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'1\', \'2\', \'3\', \'4\', \'5\', \'6\', \'7\', \'8\'), ');
INSERT INTO configuration VALUES (446,'全商品リスト - デフォルトのグループID','PRODUCT_ALL_LIST_GROUP_ID','23','全商品リストの設定グループID(configuration_group_id)は?<br />\r\n<br />\r\n注意：全商品リストのグループIDがデフォルトの23から変更されたときだけ設定してください。\r\n',23,12,NULL,'2009-11-19 12:39:39',NULL,NULL);
INSERT INTO configuration VALUES (447,'複数商品の数量欄の有無・表示位置','PRODUCT_ALL_LISTING_MULTIPLE_ADD_TO_CART','3','複数商品の数量欄の表示の有無と表示位置について設定します。<br />0= off<br />1= 上部<br />2= 下部<br />3= 両方',23,25,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'), ');
INSERT INTO configuration VALUES (448,'新着商品をトップページに表示する','SHOW_PRODUCT_INFO_MAIN_NEW_PRODUCTS','1','新着商品をトップページに表示 しますか?\r\n<br />\r\n0= off<br />\r\nまたは表示順を数値(104)で設定してください。\r\n',24,65,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ');
INSERT INTO configuration VALUES (449,'おすすめ商品をトップページに表示する','SHOW_PRODUCT_INFO_MAIN_FEATURED_PRODUCTS','2','おすすめ商品をトップページに表示 しますか?\r\n<br />\r\n0= off<br />\r\nまたは表示順を数値(104)で設定してください。\r\n',24,66,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ');
INSERT INTO configuration VALUES (450,'特価商品をトップページに表示する','SHOW_PRODUCT_INFO_MAIN_SPECIALS_PRODUCTS','3','特価商品をトップページに表示 しますか?\r\n<br />\r\n0= off<br />\r\nまたは表示順を数値(104)で設定してください。\r\n',24,67,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ');
INSERT INTO configuration VALUES (451,'入荷予定商品をトップページに表示する','SHOW_PRODUCT_INFO_MAIN_UPCOMING','4','入荷予定商品をトップページに表示 しますか?\r\n<br />\r\n0= off<br />\r\nまたは表示順を数値(104)で設定してください。\r\n',24,68,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ');
INSERT INTO configuration VALUES (452,'新着商品をトップページに表示する - カテゴリ・サブカテゴリ共に\r\n','SHOW_PRODUCT_INFO_CATEGORY_NEW_PRODUCTS','1','新着商品を(トップレベル)カテゴリ・サブカテゴリ共にトップページに表示 しますか?\r\n<br />\r\n0= off<br />\r\nまたは表示順を数値(104)で設定してください。\r\n',24,70,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ');
INSERT INTO configuration VALUES (453,'おすすめ商品をトップページに表示する - カテゴリ・サブカテゴリ共に','SHOW_PRODUCT_INFO_CATEGORY_FEATURED_PRODUCTS','2','おすすめ商品を(トップレベル)カテゴリ・サブカテゴリ共にトップページに表示 しますか?\r\n<br />\r\n0= off<br />\r\nまたは表示順を数値(104)で設定してください。\r\n',24,71,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ');
INSERT INTO configuration VALUES (454,'特価商品をトップページに表示する - カテゴリ・サブカテゴリ共に','SHOW_PRODUCT_INFO_CATEGORY_SPECIALS_PRODUCTS','3','特価商品を(トップレベル)カテゴリ・サブカテゴリ共にトップページに表示 しますか?\r\n<br />\r\n0= off<br />\r\nまたは表示順を数値(104)で設定してください。\r\n',24,72,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ');
INSERT INTO configuration VALUES (455,'入荷予定商品をトップページに表示する - カテゴリ・サブカテゴリ共に','SHOW_PRODUCT_INFO_CATEGORY_UPCOMING','4','入荷予定商品を(トップレベル)カテゴリ・サブカテゴリ共にトップページに表示 しますか?\r\n<br />\r\n0= off<br />\r\nまたは表示順を数値(104)で設定してください。\r\n',24,73,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ');
INSERT INTO configuration VALUES (456,'新着商品をトップページに表示する - エラーとリンク切れ商品ページ','SHOW_PRODUCT_INFO_MISSING_NEW_PRODUCTS','1','新着予定商品をトップページに表示 しますか?\r\n(エラーとリンク切れ商品ページ・/* 訳注・意味不明 */)<br />\r\n0= off<br />\r\nまたは順番を数値(104)で設定してください。',24,75,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ');
INSERT INTO configuration VALUES (457,'おすすめ商品をトップページに表示する - エラーとリンク切れ商品ページ','SHOW_PRODUCT_INFO_MISSING_FEATURED_PRODUCTS','2','おすすめ商品をトップページに表示 しますか?\r\n(エラーとリンク切れ商品ページ・/* 訳注・意味不明 */)<br />\r\n0= off<br />\r\nまたは順番を数値(104)で設定してください。',24,76,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ');
INSERT INTO configuration VALUES (458,'特価商品をトップページに表示する - エラーとリンク切れ商品ページ','SHOW_PRODUCT_INFO_MISSING_SPECIALS_PRODUCTS','3','特価商品をトップページに表示 しますか?\r\n(エラーとリンク切れ商品ページ・/* 訳注・意味不明 */)<br />\r\n0= off<br />\r\nまたは順番を数値(104)で設定してください。',24,77,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ');
INSERT INTO configuration VALUES (459,'入荷予定商品をトップページに表示する - エラーとリンク切れ商品ページ','SHOW_PRODUCT_INFO_MISSING_UPCOMING','4','入荷予定商品をトップページに表示 しますか?\r\n(エラーとリンク切れ商品ページ・/* 訳注・意味不明 */)<br />\r\n0= off<br />\r\nまたは順番を数値(104)で設定してください。',24,78,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ');
INSERT INTO configuration VALUES (460,'新着商品を表示する - 商品リストの下部に','SHOW_PRODUCT_INFO_LISTING_BELOW_NEW_PRODUCTS','1','商品リストの下に新着商品を表示しますか?\r\n<br />0= off <br />\r\nまたは配置順を数値(104)で設定してください。',24,85,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ');
INSERT INTO configuration VALUES (461,'おすすめ商品を表示する - 商品リストの下部に','SHOW_PRODUCT_INFO_LISTING_BELOW_FEATURED_PRODUCTS','2','商品リストの下におすすめ商品を表示しますか?\r\n<br />0= off <br />\r\nまたは配置順を数値(104)で設定してください。',24,86,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ');
INSERT INTO configuration VALUES (462,'特価商品を表示する - 商品リストの下部に','SHOW_PRODUCT_INFO_LISTING_BELOW_SPECIALS_PRODUCTS','3','商品リストの下に特価商品を表示しますか?\r\n<br />0= off <br />\r\nまたは配置順を数値(104)で設定してください。',24,87,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ');
INSERT INTO configuration VALUES (463,'入荷予定商品を表示する - 商品リストの下部に','SHOW_PRODUCT_INFO_LISTING_BELOW_UPCOMING','4','商品リストの下に入荷予定商品を表示しますか?\r\n<br />0= off <br />\r\nまたは配置順を数値(104)で設定してください。',24,88,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ');
INSERT INTO configuration VALUES (464,'新着商品 - 横列あたりの表示点数','SHOW_PRODUCT_INFO_COLUMNS_NEW_PRODUCTS','3','新着商品の列(Row)あたりの配置点数を設定します。',24,95,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'1\', \'2\', \'3\', \'4\', \'5\', \'6\', \'7\', \'8\', \'9\', \'10\', \'11\', \'12\'), ');
INSERT INTO configuration VALUES (465,'おすすめ商品 - 横列あたりの表示点数','SHOW_PRODUCT_INFO_COLUMNS_FEATURED_PRODUCTS','3','おすすめ商品の列(Row)あたりの配置点数を設定します。',24,96,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'1\', \'2\', \'3\', \'4\', \'5\', \'6\', \'7\', \'8\', \'9\', \'10\', \'11\', \'12\'), ');
INSERT INTO configuration VALUES (466,'特価商品 - 横列あたりの表示点数','SHOW_PRODUCT_INFO_COLUMNS_SPECIALS_PRODUCTS','3','特価商品の列(Row)あたりの配置点数を設定します。',24,97,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'1\', \'2\', \'3\', \'4\', \'5\', \'6\', \'7\', \'8\', \'9\', \'10\', \'11\', \'12\'), ');
INSERT INTO configuration VALUES (467,'トップレベル(親)カテゴリの商品リスト表示 - フィルタ表示・全商品表示','SHOW_PRODUCT_INFO_ALL_PRODUCTS','1','現在のメインカテゴリに商品リストが適用された際、商品をフィルタ表示しますか? それとも全カテゴリから商品を表示しますか?<br />\r\n・0= Filter\r\n・Off 1=Filter On',24,100,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'), ');
INSERT INTO configuration VALUES (468,'トップページの定義領域 - ステータス','DEFINE_MAIN_PAGE_STATUS','1','編集された領域の表示を行いますか?<br />0= リンク:表示　　編集領域:非表示<br />1= リンク:表示　　編集領域:表示<br />2= リンク:非表示　編集領域:表示<br />3= リンク:非表示　編集領域:非表示',25,60,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
INSERT INTO configuration VALUES (469,'「お問い合わせ」ページの表示 - ステータス','DEFINE_CONTACT_US_STATUS','1','編集された「お問い合わせ」テキストを表示しますか?<br />0= リンク:表示　　編集領域:非表示<br />1= リンク:表示　　編集領域:表示<br />2= リンク:非表示　編集領域:表示<br />3= リンク:非表示　編集領域:非表示',25,61,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
INSERT INTO configuration VALUES (470,'「個人情報保護方針」表示 - ステータス','DEFINE_PRIVACY_STATUS','1','編集された「個人情報保護方針」を表示しますか?<br />0= リンク:表示　　編集領域:非表示<br />1= リンク:表示　　編集領域:表示<br />2= リンク:非表示　編集領域:表示<br />3= リンク:非表示　編集領域:非表示',25,62,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
INSERT INTO configuration VALUES (471,'「配送・送料について」 ページ - ステータス','DEFINE_SHIPPINGINFO_STATUS','1','編集された「配送・送料について」テキストを表示しますか?<br />0= リンク:表示　　編集領域:非表示<br />1= リンク:表示　　編集領域:表示<br />2= リンク:非表示　編集領域:表示<br />3= リンク:非表示　編集領域:非表示',25,63,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
INSERT INTO configuration VALUES (472,'「ご利用規約」ページ - ステータス','DEFINE_CONDITIONS_STATUS','1','編集された「ご利用規約」ページを表示しますか?<br />0= リンク:表示　　編集領域:非表示<br />1= リンク:表示　　編集領域:表示<br />2= リンク:非表示　編集領域:表示<br />3= リンク:非表示　編集領域:非表示',25,64,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
INSERT INTO configuration VALUES (473,'「ご注文が完了しました」ページ - ステータス','DEFINE_CHECKOUT_SUCCESS_STATUS','1','編集された「ご注文が完了しました」テキストを表示しますか?<br />0= リンク:表示　　編集領域:非表示<br />1= リンク:表示　　編集領域:表示<br />2= リンク:非表示　編集領域:表示<br />3= リンク:非表示　編集領域:非表示',25,65,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
INSERT INTO configuration VALUES (474,'「クーポン券」ページ - ステータス','DEFINE_DISCOUNT_COUPON_STATUS','1','編集された「クーポン券」テキストを表示しますか?<br />0= リンク:表示　　編集領域:非表示<br />1= リンク:表示　　編集領域:表示<br />2= リンク:非表示　編集領域:表示<br />3= リンク:非表示　編集領域:非表示',25,66,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
INSERT INTO configuration VALUES (475,'「サイトマップ」ページ - ステータス','DEFINE_SITE_MAP_STATUS','1','編集された「クーポン券」テキストを表示しますか?<br />0= リンク:表示　　編集領域:非表示<br />1= リンク:表示　　編集領域:表示<br />2= リンク:非表示　編集領域:表示<br />3= リンク:非表示　編集領域:非表示',25,67,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
INSERT INTO configuration VALUES (476,'自由編集ページ(Define Page) 2','DEFINE_PAGE_2_STATUS','1','自由編集ページ2を表示しますか?<br />0= リンク:表示　　編集領域:非表示<br />1= リンク:表示　　編集領域:表示<br />2= リンク:非表示　編集領域:表示<br />3= リンク:非表示　編集領域:非表示',25,82,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
INSERT INTO configuration VALUES (477,'自由編集ページ(Define Page) 3','DEFINE_PAGE_3_STATUS','1','自由編集ページ3 を表示しますか?<br />0= リンク:表示　　編集領域:非表示<br />1= リンク:表示　　編集領域:表示<br />2= リンク:非表示　編集領域:表示<br />3= リンク:非表示　編集領域:非表示',25,83,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
INSERT INTO configuration VALUES (478,'自由編集ページ(Define Page) 4','DEFINE_PAGE_4_STATUS','1','自由編集ページ(Define Page) 4を表示しますか?<br />0= リンク:表示　　編集領域:非表示<br />1= リンク:表示　　編集領域:表示<br />2= リンク:非表示　編集領域:表示<br />3= リンク:非表示　編集領域:非表示',25,84,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
INSERT INTO configuration VALUES (479,'EZページの表示 - ページヘッダ','EZPAGES_STATUS_HEADER','1','EZページのコンテンツをページヘッダに表示するかどうかをグローバル(サイト全体)に設定します。<br />0 = Off<br />1 = On<br />2= サイトメンテナンスの際に管理者のIPアドレスでアクセスした場合のみ表示<br />注意：ワーニングは公開されず管理者にだけ表示されます。',30,10,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), ');
INSERT INTO configuration VALUES (480,'EZページの表示 - ページフッタ','EZPAGES_STATUS_FOOTER','1','EZページのコンテンツをページフッタに表示するかどうかをグローバル(サイト全体)に設定します。<br />0 = Off<br />1 = On<br />2= サイトメンテナンスの際に管理者のIPアドレスでアクセスした場合のみ表示<br />注意：ワーニングは公開されず管理者にだけ表示されます。',30,11,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), ');
INSERT INTO configuration VALUES (481,'EZページの表示 - サイドボックス','EZPAGES_STATUS_SIDEBOX','1','EZページのコンテンツをサイドボックスに表示するかどうかをグローバル(サイト全体)に設定します。<br />0 = Off<br />1 = On<br />2= サイトメンテナンスの際に管理者のIPアドレスでアクセスした場合のみ表示<br />注意：ワーニングは公開されず管理者にだけ表示されます。',30,12,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), ');
INSERT INTO configuration VALUES (482,'EZページ のヘッダ - リンクのセパレータ(区切り記号)','EZPAGES_SEPARATOR_HEADER','','EＺページのヘッダのリンク表示のセパレータ(区切り文字)は?<br />デフォルト = &amp;nbsp;::&amp;nbsp;',30,20,'2009-11-19 13:10:25','2009-11-19 12:39:39',NULL,'zen_cfg_textarea_small(');
INSERT INTO configuration VALUES (483,'EZページ のフッタ - リンクのセパレータ(区切り記号)','EZPAGES_SEPARATOR_FOOTER','&nbsp;::&nbsp;','EＺページのフッタのリンク表示のセパレータ(区切り文字)は?<br />デフォルト = &amp;nbsp;::&amp;nbsp;',30,21,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_textarea_small(');
INSERT INTO configuration VALUES (484,'EZページ - [次へ][前へ]ボタン','EZPAGES_SHOW_PREV_NEXT_BUTTONS','2','EZページのコンテンツ内[前へ][続ける][次へ]ボタンを表示しますか?<br />0=OFF (ボタンなし)<br />1=「続ける」を表示<br />2=「前へ」「続ける」「次へ」を表示<br /><br />デフォルト：2',30,30,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), ');
INSERT INTO configuration VALUES (485,'EZページ - 目次の表示','EZPAGES_SHOW_TABLE_CONTENTS','1','EZページの目次を表示しますか?<br />0= OFF<br />1= ON',30,35,'2009-11-19 12:39:39','2009-11-19 12:39:39',NULL,'zen_cfg_select_option(array(\'0\', \'1\'),');
INSERT INTO configuration VALUES (486,'EZ-ページ - ヘッダで表示しないページ','EZPAGES_DISABLE_HEADER_DISPLAY_LIST','','EZページのうち通常のページヘッダに表示しないページは?<br />表示しないページのページIDをカンマ(,)区切りで記述してください。ページIDは管理画面の[追加設定・ツール]のEZページ設定画面で確認できます。<br />例：1,5,2<br />ない場合は空欄のまま',30,40,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_textarea_small(');
INSERT INTO configuration VALUES (487,'EZ-ページ - フッタで表示しないページ','EZPAGES_DISABLE_FOOTER_DISPLAY_LIST','','EZページのうち通常のページフッタに表示しないページは?<br />表示しないページのページIDをカンマ(,)区切りで記述してください。ページIDは管理画面の[追加設定・ツール]のEZページ設定画面で確認できます。<br />例：3,7<br />ない場合は空欄のまま',30,41,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_textarea_small(');
INSERT INTO configuration VALUES (488,'EZ-ページ - 左カラムで表示しないページ','EZPAGES_DISABLE_LEFTCOLUMN_DISPLAY_LIST','','EZページのうち通常の左カラムに表示しないページは?<br />表示しないページのページIDをカンマ(,)区切りで記述してください。ページIDは管理画面の[追加設定・ツール]のEZページ設定画面で確認できます。<br />例：6,17<br />ない場合は空欄のまま',30,42,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_textarea_small(');
INSERT INTO configuration VALUES (489,'EZ-ページ - 右カラムで表示しないページ','EZPAGES_DISABLE_RIGHTCOLUMN_DISPLAY_LIST','','EZページのうち通常の右カラムに表示しないページは?<br />表示しないページのページIDをカンマ(,)区切りで記述してください。ページIDは管理画面の[追加設定・ツール]のEZページ設定画面で確認できます。<br />例：5,23,47<br />ない場合は空欄のまま',30,43,NULL,'2009-11-19 12:39:39',NULL,'zen_cfg_textarea_small(');
INSERT INTO configuration VALUES (490,'お問い合わせ時の個人情報確認画面表示','DISPLAY_CONTACT_US_PRIVACY_CONDITIONS','true','お問い合わせする画面で個人情報の確認画面を表示します。<div style=\"color: red;\">2005年4月1日に施行された「個人情報保護法」では、個人情報保護方針を開示することが求められています。</div>',11,3,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (491,'ふりがなが必要な国','FURIKANA_NECESSARY_COUNTRIES','Japanese','ふりがなが必要な国名をカンマで区切って入力してください',5,100,NULL,'2009-11-19 12:39:40',NULL,'');
INSERT INTO configuration VALUES (492,'Product Listing - Layout Style','PRODUCT_LISTING_LAYOUT_STYLE','rows','Select the layout style:<br />Each product can be listed in its own row (rows option) or products can be listed in multiple columns per row (columns option)',8,40,'2010-05-28 11:45:17','2009-11-19 12:39:41',NULL,'zen_cfg_select_option(array(\"rows\", \"columns\"),');
INSERT INTO configuration VALUES (493,'Product Listing - Columns Per Row','PRODUCT_LISTING_COLUMNS_PER_ROW','3','Select the number of columns of products to show in each row in the product listing. The default setting is 3.',8,41,NULL,'2009-11-19 12:39:41',NULL,NULL);
INSERT INTO configuration VALUES (494,'Display Cross-Sell Products','MIN_DISPLAY_XSELL','1','This is the minimum number of configured Cross-Sell products required in order to cause the Cross Sell information to be displayed.<br />Default: 1',2,17,NULL,'2009-11-19 12:39:41',NULL,NULL);
INSERT INTO configuration VALUES (495,'Display Cross-Sell Products','MAX_DISPLAY_XSELL','6','This is the maximum number of configured Cross-Sell products to be displayed.<br />Default: 6',3,66,NULL,'2009-11-19 12:39:41',NULL,NULL);
INSERT INTO configuration VALUES (496,'Cross-Sell Products Columns per Row','SHOW_PRODUCT_INFO_COLUMNS_XSELL_PRODUCTS','3','Cross-Sell Products Columns to display per Row<br />0= off or set the sort order.<br />Default: 3',18,72,NULL,'2009-11-19 12:39:41',NULL,'zen_cfg_select_option(array(0, 1, 2, 3, 4), ');
INSERT INTO configuration VALUES (497,'Cross-Sell - Display prices?','XSELL_DISPLAY_PRICE','false','Cross-Sell -- Do you want to display the product prices too?<br />Default: false',18,72,NULL,'2009-11-19 12:39:41',NULL,'zen_cfg_select_option(array(\'true\',\'false\'), ');
INSERT INTO configuration VALUES (498,'無料配送','MODULE_SHIPPING_FREESHIPPER_STATUS','True','無料配送を提供しますか？',6,0,NULL,'2009-11-19 12:41:06',NULL,'zen_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO configuration VALUES (499,'無料配送コスト','MODULE_SHIPPING_FREESHIPPER_COST','0','無料配送にかかるコスト',6,6,NULL,'2009-11-19 12:41:06',NULL,NULL);
INSERT INTO configuration VALUES (500,'手数料','MODULE_SHIPPING_FREESHIPPER_HANDLING','0','無料配送にかかる手数料.',6,0,NULL,'2009-11-19 12:41:06',NULL,NULL);
INSERT INTO configuration VALUES (501,'税種別','MODULE_SHIPPING_FREESHIPPER_TAX_CLASS','0','定額料金に適用される税種別を選択してください。',6,0,NULL,'2009-11-19 12:41:06','zen_get_tax_class_title','zen_cfg_pull_down_tax_classes(');
INSERT INTO configuration VALUES (502,'配送地域','MODULE_SHIPPING_FREESHIPPER_ZONE','0','配送地域を選択すると選択された地域のみで利用可能になります。.',6,0,NULL,'2009-11-19 12:41:06','zen_get_zone_class_title','zen_cfg_pull_down_zone_classes(');
INSERT INTO configuration VALUES (503,'表示の整列順','MODULE_SHIPPING_FREESHIPPER_SORT_ORDER','0','表示の整列順を設定できます。数字が小さいほど上位に表示されます。',6,0,NULL,'2009-11-19 12:41:06',NULL,NULL);
INSERT INTO configuration VALUES (504,'佐川急便の配送を有効にする','MODULE_SHIPPING_YAMATO_STATUS','True','ヤマト運輸(宅急便)の配送を提供しますか?',6,0,NULL,'2009-11-19 12:41:06',NULL,'zen_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO configuration VALUES (505,'取扱い手数料','MODULE_SHIPPING_YAMATO_HANDLING','0','送料に適用する取扱手数料を設定できます.',6,1,NULL,'2009-11-19 12:41:06',NULL,NULL);
INSERT INTO configuration VALUES (506,'送料無料設定','MODULE_SHIPPING_YAMATO_FREE_SHIPPING','False','送料無料設定を有効にしますか? [合計モジュール]-[送料]-[送料無料設定]を優先する場合は False を選んでください.',6,2,NULL,'2009-11-19 12:41:06',NULL,'zen_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO configuration VALUES (507,'送料を無料にする購入金額設定','MODULE_SHIPPING_YAMATO_OVER','5000','設定金額以上をご購入の場合は送料を無料にします.',6,3,NULL,'2009-11-19 12:41:06',NULL,NULL);
INSERT INTO configuration VALUES (508,'送料の値引率','MODULE_SHIPPING_YAMATO_DISCOUNT','0','送料の値引率を指定します.(％)',6,4,NULL,'2009-11-19 12:41:06',NULL,NULL);
INSERT INTO configuration VALUES (509,'配送地域','MODULE_SHIPPING_YAMATO_ZONE','0','配送地域を選択すると選択された地域のみで利用可能となります.',6,5,NULL,'2009-11-19 12:41:06','zen_get_zone_class_title','zen_cfg_pull_down_zone_classes(');
INSERT INTO configuration VALUES (510,'表示の整列順','MODULE_SHIPPING_YAMATO_SORT_ORDER','0','表示の整列順を設定できます. 数字が小さいほど上位に表示されます.',6,6,NULL,'2009-11-19 12:41:06',NULL,NULL);
INSERT INTO configuration VALUES (511,'Installed Modules','ADDON_MODULE_INSTALLED','aboutbox;addon_modules;feature_area;carousel_ui;am_ajax_address;ajax_category_tree;blog;calendar;category_sitemap;checkout_step;easy_admin;easy_admin_simplify;easy_design;easy_reviews;email_templates;globalnavi;jquery;multiple_image_view;point_base;point_createaccount;point_customersrate;point_grouprate;point_productsrate;product_csv;products_with_attributes_stock;search_more;shopping_cart_summary;sitemapXML','This is automatically updated. No need to edit.',6,0,'2010-06-27 05:17:44','2009-11-19 12:42:23',NULL,NULL);
INSERT INTO configuration VALUES (512,'コアモジュールの有効化','MODULE_ADDON_MODULES_STATUS','true','無効にすることは出来ません。',6,0,NULL,'2009-11-19 12:42:37',NULL,'zen_cfg_select_option(array(\'true\'), ');
INSERT INTO configuration VALUES (513,'配布元URLリスト','MODULE_ADDON_MODULES_DISTRIBUTION_URL','http://zen-cart.ark-web.jp/shida/zencart-sugu/','addonモジュールパッケージを取得するサイトのURLを指定してください。<br/>複数指定する場合は改行して入力してください。',6,1,NULL,'2009-11-19 12:42:37',NULL,'zen_cfg_textarea_small(');
INSERT INTO configuration VALUES (514,'優先順','MODULE_ADDON_MODULES_SORT_ORDER','0','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,2,NULL,'2009-11-19 12:42:37',NULL,NULL);
INSERT INTO configuration VALUES (515,'パケット料金節約の設定','MOBILE_SLIM_SIZE','1','パケット料金の節約に関する設定をします<BR />この設定はHTML中の改行やスペースを取り除きファイルサイズを小さくします。この設定でパケット料金を節約する事が出来ます<br />0=OFF<br />1=ON<br />',100,2,NULL,'0001-01-01 00:00:00',NULL,'zen_cfg_select_option(array(\'0\', \'1\'),');
INSERT INTO configuration VALUES (516,'携帯サイトテーマカラーの設定','MOBILE_THEME_COLOR','#CA6312','サイトのテーマカラーを「#666666」などHTMLカラーコードで設定します。このテーマカラーは、見出しの帯の背景色などで使用されます',100,3,NULL,'0001-01-01 00:00:00',NULL,NULL);
INSERT INTO configuration VALUES (517,'CSSの設定','MOBILE_CSS_CONF','0','ここではHTML中の[class]と[id]の有無を設定します<br />デフォルトではファイルサイズ縮小目的の為に0が設定されています<br />CSSを使用する場合は1を設定して下さい<BR /><br />0=CSSを使用しない<br />1=CSSを使用する<br />',100,4,NULL,'0001-01-01 00:00:00',NULL,'zen_cfg_select_option(array(\'0\', \'1\'),');
INSERT INTO configuration VALUES (518,'アバウトボックスブロックの有効化','MODULE_ABOUTBOX_STATUS','true','アバウトボックスを有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 12:50:52',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (519,'優先順','MODULE_ABOUTBOX_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,1,NULL,'2009-11-19 12:50:52',NULL,NULL);
INSERT INTO configuration VALUES (520,'アバウトボックスのタイトル','MODULE_ABOUTBOX_CFG_HEADER','','アバウトボックスブロックに表示するタイトルを指定します。',6,2,NULL,'2009-11-19 12:50:52',NULL,NULL);
INSERT INTO configuration VALUES (521,'アバウトボックス説明文のタイトル','MODULE_ABOUTBOX_CFG_GREETING_TITLE','店長からの挨拶','アバウトボックスに表示する説明文のタイトルを指定します。',6,3,NULL,'2009-11-19 12:50:52',NULL,NULL);
INSERT INTO configuration VALUES (522,'アバウトボックス説明文の本文','MODULE_ABOUTBOX_CFG_GREETING_TEXT','すぐでき（る）パックのデモショップです。\r\nテンプレートの実装をがんばろー！','アバウトボックスに表示する説明文の本文を指定します。',6,4,NULL,'2009-11-19 12:50:52',NULL,'zen_cfg_textarea_small(');
INSERT INTO configuration VALUES (523,'アバウトボックスに表示する画像','MODULE_ABOUTBOX_CFG_IMAGEPATH','images/my.jpg','アバウトボックスに表示する画像のパスを指定します。',6,5,NULL,'2009-11-19 12:50:52',NULL,NULL);
INSERT INTO configuration VALUES (524,'カレンダー表示','MODULE_ABOUTBOX_DISPLAY_CALENDAR','true','営業カレンダーを表示するかどうか指定します。営業カレンダーモジュールがインストールされていないとtrueにしても表示されません。<br />true: 表示<br />false: 非表示',6,6,NULL,'2009-11-19 12:50:52',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (525,'対応クレジットカード表示','MODULE_ABOUTBOX_AVALABLE_CARDS','2','対応クレジットカードを表示するかどうか指定します<br />0: 非表示<br />1: テキスト表示<br />2: 画像表示',6,7,NULL,'2009-11-19 12:50:52',NULL,'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), ');
INSERT INTO configuration VALUES (526,'jQueryの有効化','MODULE_JQUERY_STATUS','true','jQueryを有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 12:51:33',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (527,'jQueryライブラリ','MODULE_JQUERY_LIBRARY','jquery.js','jQueryライブラリのファイル名を設定します。特に理由がない限り変更する必要はありません。<br />・初期値 = jquery.js',6,1,NULL,'2009-11-19 12:51:33',NULL,NULL);
INSERT INTO configuration VALUES (528,'noConflictの有効化','MODULE_JQUERY_NOCONFLICT_STATUS','false','noConflictを有効にしますか？ <br />true: 有効<br />false: 無効',6,2,NULL,'2009-11-19 12:51:33',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (529,'優先順','MODULE_JQUERY_SORT_ORDER','1','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,3,NULL,'2009-11-19 12:51:33',NULL,NULL);
INSERT INTO configuration VALUES (530,'商品カテゴリの有効化','MODULE_ADDON_MODULES_AJAXCATEGORYTREE_STATUS','true','商品カテゴリ表示を有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 12:51:55',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (531,'優先順','MODULE_ADDON_MODULES_AJAXCATEGORYTREE_SORT_ORDER','1000','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,1,NULL,'2009-11-19 12:51:55',NULL,NULL);
INSERT INTO configuration VALUES (532,'ブログの有効化','MODULE_BLOG_STATUS','true','ブログを有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 12:52:36',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (533,'ブログURL','MODULE_BLOG_URL','','取得対象のURLを http:// から入力してください(https未対応)',6,1,NULL,'2009-11-19 12:52:36',NULL,NULL);
INSERT INTO configuration VALUES (534,'タイムアウト','MODULE_BLOG_TIMEOUT','1','取得リミット時間を設定します、ここで指定した時間以上に取得に時間がかかった場合は取得を中止します',6,2,NULL,'2009-11-19 12:52:36',NULL,NULL);
INSERT INTO configuration VALUES (535,'表示件数','MODULE_BLOG_COUNT','10','最大表示件数を設定します、0の場合はすべてとなります',6,3,NULL,'2009-11-19 12:52:36',NULL,NULL);
INSERT INTO configuration VALUES (536,'優先順','MODULE_BLOG_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,4,NULL,'2009-11-19 12:52:36',NULL,NULL);
INSERT INTO configuration VALUES (537,'営業カレンダーの有効化','MODULE_CALENDAR_STATUS','true','営業カレンダーを有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 12:53:04',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (538,'週の開始が日曜日','MODULE_CALENDAR_START_SUNDAY','true','週の開始を日曜日としますか？ <br />true: 日曜<br />false: 月曜',6,1,NULL,'2009-11-19 12:53:04',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (539,'最短配送可能日: 注文日の翌日からの営業日','MODULE_CALENDAR_DELIVERY_START','3','配送日として指定できる範囲を日数として指定します',6,2,NULL,'2009-11-19 12:53:04',NULL,NULL);
INSERT INTO configuration VALUES (540,'最終配送可能日: 最短配送可能日から日間','MODULE_CALENDAR_DELIVERY_END','14','配送日として指定できる範囲を日数として指定します',6,3,NULL,'2009-11-19 12:53:04',NULL,NULL);
INSERT INTO configuration VALUES (541,'配送時刻の選択項目','MODULE_CALENDAR_HOPE_DELIVERY_TIME','指定しない,午前中,12時015時,15時018時,18時021時','配送時刻の選択項目をカンマ区切りで入力してください',6,4,NULL,'2009-11-19 12:53:04',NULL,NULL);
INSERT INTO configuration VALUES (542,'優先順','MODULE_CALENDAR_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,5,NULL,'2009-11-19 12:53:04',NULL,NULL);
INSERT INTO configuration VALUES (543,'カルーセルUIの有効化','MODULE_CAROUSEL_UI_STATUS','true','カルーセルUIを有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 12:53:57',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (544,'jCarouselLiteライブラリ','MODULE_CAROUSEL_UI_JCAROUSELLITE_LIBRARY','jcarousellite.js','jCarouselLiteライブラリのファイル名を設定します。特に理由がない限り変更する必要はありません。<br />・初期値 = jcarousellite.js',6,1,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO configuration VALUES (545,'優先順','MODULE_CAROUSEL_UI_SORT_ORDER','11','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。<br />※jQueryモジュールよりも大きな数字を設定してください。',6,2,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO configuration VALUES (546,'新着商品 - 最大表示件数','MODULE_CAROUSEL_UI_MAX_DISPLAY_NEW_PRODUCTS','4','新着商品の最大表示件数を設定します。<br />・初期値 = 4',6,3,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO configuration VALUES (547,'新着商品 - 自動スクロール','MODULE_CAROUSEL_UI_CONF_AUTO_NEW_PRODUCTS','0','新着商品を自動的にスクロールする場合の間隔(ミリ秒)を設定します。<br />0ミリ秒の場合は自動スクロールしません。<br />・初期値 = 0',6,4,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO configuration VALUES (548,'新着商品 - スクロール速度','MODULE_CAROUSEL_UI_CONF_SPEED_NEW_PRODUCTS','200','新着商品をスクロールする速度(ミリ秒)を設定します。<br />設定値を大きくするとゆっくりスクロールします。0に設定するとスクロールしなくなります。<br />・初期値 = 200',6,5,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO configuration VALUES (549,'新着商品 - 縦スクロール','MODULE_CAROUSEL_UI_CONF_VERTICAL_NEW_PRODUCTS','false','新着商品を縦にスクロールしますか？<br />true: 縦スクロール<br />false: 横スクロール<br />・初期値 = false',6,6,NULL,'2009-11-19 12:53:57',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (550,'新着商品 - 循環スクロール','MODULE_CAROUSEL_UI_CONF_CIRCULAR_NEW_PRODUCTS','true','新着商品を循環的にスクロールしますか？<br />true: 循環スクロール<br />false: 往復スクロール<br />・初期値 = true',6,7,NULL,'2009-11-19 12:53:57',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (551,'新着商品 - スクロールエリア表示件数','MODULE_CAROUSEL_UI_CONF_VISIBLE_NEW_PRODUCTS','3','新着商品のスクロールエリアに表示する件数を設定します。<br />・初期値 = 3',6,8,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO configuration VALUES (552,'新着商品 - スクロール件数','MODULE_CAROUSEL_UI_CONF_SCROLL_NEW_PRODUCTS','1','新着商品の一度にスクロールさせる件数を設定します。<br />・初期値 = 1',6,9,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO configuration VALUES (553,'おすすめ商品 - 最大表示件数','MODULE_CAROUSEL_UI_MAX_DISPLAY_FEATURED_PRODUCTS','4','おすすめ商品の最大表示件数を設定します。<br />・初期値 = 4',6,10,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO configuration VALUES (554,'おすすめ商品 - 自動スクロール','MODULE_CAROUSEL_UI_CONF_AUTO_FEATURED_PRODUCTS','0','おすすめ商品を自動的にスクロールする場合の間隔(ミリ秒)を設定します。<br />0ミリ秒の場合は自動スクロールしません。<br />・初期値 = 0',6,11,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO configuration VALUES (555,'おすすめ商品 - スクロール速度','MODULE_CAROUSEL_UI_CONF_SPEED_FEATURED_PRODUCTS','200','おすすめ商品をスクロールする速度(ミリ秒)を設定します。<br />設定値を大きくするとゆっくりスクロールします。0に設定するとスクロールしなくなります。<br />・初期値 = 200',6,12,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO configuration VALUES (556,'おすすめ商品 - 縦スクロール','MODULE_CAROUSEL_UI_CONF_VERTICAL_FEATURED_PRODUCTS','false','おすすめ商品を縦にスクロールしますか？<br />true: 縦スクロール<br />false: 横スクロール<br />・初期値 = false',6,13,NULL,'2009-11-19 12:53:57',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (557,'おすすめ商品 - 循環スクロール','MODULE_CAROUSEL_UI_CONF_CIRCULAR_FEATURED_PRODUCTS','true','おすすめ商品を循環的にスクロールしますか？<br />true: 循環スクロール<br />false: 往復スクロール<br />・初期値 = true',6,14,NULL,'2009-11-19 12:53:57',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (558,'おすすめ商品 - スクロールエリア表示件数','MODULE_CAROUSEL_UI_CONF_VISIBLE_FEATURED_PRODUCTS','3','おすすめ商品のスクロールエリアに表示する件数を設定します。<br />・初期値 = 3',6,15,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO configuration VALUES (559,'おすすめ商品 - スクロール件数','MODULE_CAROUSEL_UI_CONF_SCROLL_FEATURED_PRODUCTS','1','おすすめ商品の一度にスクロールさせる件数を設定します。<br />・初期値 = 1',6,16,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO configuration VALUES (560,'特価商品 - 最大表示件数','MODULE_CAROUSEL_UI_MAX_DISPLAY_SPECIALS_PRODUCTS','4','特価商品の最大表示件数を設定します。<br />・初期値 = 4',6,17,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO configuration VALUES (561,'特価商品 - 自動スクロール','MODULE_CAROUSEL_UI_CONF_AUTO_SPECIALS_PRODUCTS','0','特価商品を自動的にスクロールする場合の間隔(ミリ秒)を設定します。<br />0ミリ秒の場合は自動スクロールしません。<br />・初期値 = 0',6,18,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO configuration VALUES (562,'特価商品 - スクロール速度','MODULE_CAROUSEL_UI_CONF_SPEED_SPECIALS_PRODUCTS','200','特価商品をスクロールする速度(ミリ秒)を設定します。<br />設定値を大きくするとゆっくりスクロールします。0に設定するとスクロールしなくなります。<br />・初期値 = 200',6,19,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO configuration VALUES (563,'特価商品 - 縦スクロール','MODULE_CAROUSEL_UI_CONF_VERTICAL_SPECIALS_PRODUCTS','false','特価商品を縦にスクロールしますか？<br />true: 縦スクロール<br />false: 横スクロール<br />・初期値 = false',6,20,NULL,'2009-11-19 12:53:57',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (564,'特価商品 - 循環スクロール','MODULE_CAROUSEL_UI_CONF_CIRCULAR_SPECIALS_PRODUCTS','true','特価商品を循環的にスクロールしますか？<br />true: 循環スクロール<br />false: 往復スクロール<br />・初期値 = true',6,21,NULL,'2009-11-19 12:53:57',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (565,'特価商品 - スクロールエリア表示件数','MODULE_CAROUSEL_UI_CONF_VISIBLE_SPECIALS_PRODUCTS','3','特価商品のスクロールエリアに表示する件数を設定します。<br />・初期値 = 3',6,22,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO configuration VALUES (566,'特価商品 - スクロール件数','MODULE_CAROUSEL_UI_CONF_SCROLL_SPECIALS_PRODUCTS','1','特価商品の一度にスクロールさせる件数を設定します。<br />・初期値 = 1',6,23,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO configuration VALUES (567,'こんな商品も購入しています - 最大表示件数','MODULE_CAROUSEL_UI_MAX_DISPLAY_ALSO_PURCHASED_PRODUCTS','4','こんな商品も購入していますの最大表示件数を設定します。<br />・初期値 = 4',6,24,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO configuration VALUES (568,'こんな商品も購入しています - 自動スクロール','MODULE_CAROUSEL_UI_CONF_AUTO_ALSO_PURCHASED_PRODUCTS','0','こんな商品も購入していますを自動的にスクロールする場合の間隔(ミリ秒)を設定します。<br />0ミリ秒の場合は自動スクロールしません。<br />・初期値 = 0',6,25,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO configuration VALUES (569,'こんな商品も購入しています - スクロール速度','MODULE_CAROUSEL_UI_CONF_SPEED_ALSO_PURCHASED_PRODUCTS','200','こんな商品も購入していますをスクロールする速度(ミリ秒)を設定します。<br />設定値を大きくするとゆっくりスクロールします。0に設定するとスクロールしなくなります。<br />・初期値 = 200',6,26,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO configuration VALUES (570,'こんな商品も購入しています - 縦スクロール','MODULE_CAROUSEL_UI_CONF_VERTICAL_ALSO_PURCHASED_PRODUCTS','false','こんな商品も購入していますを縦にスクロールしますか？<br />true: 縦スクロール<br />false: 横スクロール<br />・初期値 = false',6,27,NULL,'2009-11-19 12:53:57',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (571,'こんな商品も購入しています - 循環スクロール','MODULE_CAROUSEL_UI_CONF_CIRCULAR_ALSO_PURCHASED_PRODUCTS','true','こんな商品も購入していますを循環的にスクロールしますか？<br />true: 循環スクロール<br />false: 往復スクロール<br />・初期値 = true',6,28,NULL,'2009-11-19 12:53:57',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (572,'こんな商品も購入しています - スクロールエリア表示件数','MODULE_CAROUSEL_UI_CONF_VISIBLE_ALSO_PURCHASED_PRODUCTS','3','こんな商品も購入していますのスクロールエリアに表示する件数を設定します。<br />・初期値 = 3',6,29,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO configuration VALUES (573,'こんな商品も購入しています - スクロール件数','MODULE_CAROUSEL_UI_CONF_SCROLL_ALSO_PURCHASED_PRODUCTS','1','こんな商品も購入していますの一度にスクロールさせる件数を設定します。<br />・初期値 = 1',6,30,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO configuration VALUES (574,'関連商品 - 最大表示件数','MODULE_CAROUSEL_UI_MAX_DISPLAY_XSELL_PRODUCTS','4','関連商品の最大表示件数を設定します。<br />・初期値 = 4',6,31,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO configuration VALUES (575,'関連商品 - 自動スクロール','MODULE_CAROUSEL_UI_CONF_AUTO_XSELL_PRODUCTS','0','関連商品を自動的にスクロールする場合の間隔(ミリ秒)を設定します。<br />0ミリ秒の場合は自動スクロールしません。<br />・初期値 = 0',6,32,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO configuration VALUES (576,'関連商品 - スクロール速度','MODULE_CAROUSEL_UI_CONF_SPEED_XSELL_PRODUCTS','200','関連商品をスクロールする速度(ミリ秒)を設定します。<br />設定値を大きくするとゆっくりスクロールします。0に設定するとスクロールしなくなります。<br />・初期値 = 200',6,33,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO configuration VALUES (577,'関連商品 - 縦スクロール','MODULE_CAROUSEL_UI_CONF_VERTICAL_XSELL_PRODUCTS','false','関連商品を縦にスクロールしますか？<br />true: 縦スクロール<br />false: 横スクロール<br />・初期値 = false',6,34,NULL,'2009-11-19 12:53:57',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (578,'関連商品 - 循環スクロール','MODULE_CAROUSEL_UI_CONF_CIRCULAR_XSELL_PRODUCTS','true','関連商品を循環的にスクロールしますか？<br />true: 循環スクロール<br />false: 往復スクロール<br />・初期値 = true',6,35,NULL,'2009-11-19 12:53:57',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (579,'関連商品 - スクロールエリア表示件数','MODULE_CAROUSEL_UI_CONF_VISIBLE_XSELL_PRODUCTS','3','関連商品のスクロールエリアに表示する件数を設定します。<br />・初期値 = 3',6,36,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO configuration VALUES (580,'関連商品 - スクロール件数','MODULE_CAROUSEL_UI_CONF_SCROLL_XSELL_PRODUCTS','1','関連商品の一度にスクロールさせる件数を設定します。<br />・初期値 = 1',6,37,NULL,'2009-11-19 12:53:57',NULL,NULL);
INSERT INTO configuration VALUES (581,'カテゴリサイトマップの有効化','MODULE_ADDON_MODULES_CATEGORY_SITEMAP_STATUS','true','カテゴリサイトマップ表示を有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 12:54:42',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (582,'表示するカテゴリの深さ','MODULE_ADDON_MODULES_CATEGORY_SITEMAP_TREE_LEVEL','2','表示するカテゴリの深さを指定します（デフォルト=2）',6,1,NULL,'2009-11-19 12:54:42',NULL,NULL);
INSERT INTO configuration VALUES (583,'優先順','MODULE_ADDON_MODULES_CATEGORY_SITEMAP_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,2,NULL,'2009-11-19 12:54:42',NULL,NULL);
INSERT INTO configuration VALUES (584,'注文ステップ表示の有効化','MODULE_CHECKOUT_STEP_STATUS','true','注文ステップ表示を有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 12:56:18',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (585,'優先順','MODULE_CHECKOUT_STEP_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,1,NULL,'2009-11-19 12:56:18',NULL,NULL);
INSERT INTO configuration VALUES (586,'管理メニューの設定の有効化','MODULE_EASY_ADMIN_STATUS','false','管理メニューの設定を有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 12:56:42',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (587,'優先順','MODULE_EASY_ADMIN_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,1,NULL,'2009-11-19 12:56:42',NULL,NULL);
INSERT INTO configuration VALUES (590,'デザインの設定の有効化','MODULE_EASY_DESIGN_STATUS','true','デザインの設定を有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 12:59:53',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (591,'優先順','MODULE_EASY_DESIGN_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,1,NULL,'2009-11-19 12:59:53',NULL,NULL);
INSERT INTO configuration VALUES (1534,'メールテンプレートの有効化','MODULE_EMAIL_TEMPLATES_STATUS','true','メールテンプレートを有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2010-06-27 04:29:58',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (1535,'優先順','MODULE_EMAIL_TEMPLATES_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,1,NULL,'2010-06-27 04:29:58',NULL,NULL);
INSERT INTO configuration VALUES (594,'フィーチャーエリアUIの有効化','MODULE_FEATURE_AREA_STATUS','true','フィーチャーエリアUIを有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 13:02:18',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (595,'優先順','MODULE_FEATURE_AREA_SORT_ORDER','10','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,1,NULL,'2009-11-19 13:02:18',NULL,NULL);
INSERT INTO configuration VALUES (596,'サムネイル - 自動スクロール ','MODULE_FEATURE_AREA_UI_CONF_AUTO','6200','サムネイルを自動的にスクロールする場合の間隔(ミリ秒)を設定します。<br />0ミリ秒の場合は自動スクロールしません。<br />・初期値 = 6200',6,2,NULL,'2009-11-19 13:02:18',NULL,NULL);
INSERT INTO configuration VALUES (597,'サムネイル - スクロール速度','MODULE_FEATURE_AREA_UI_CONF_SPEED','800','サムネイルをスクロールする速度(ミリ秒)を設定します。<br />設定値を大きくするとゆっくりスクロールします。0に設定するとスクロールしなくなります。<br />・初期値 = 800',6,3,NULL,'2009-11-19 13:02:18',NULL,NULL);
INSERT INTO configuration VALUES (598,'サムネイル - スクロールエリア表示件数','MODULE_FEATURE_AREA_UI_CONF_VISIBLE','5','サムネイルのスクロールエリアに表示する件数を設定します。<br />・初期値 = 5',6,4,NULL,'2009-11-19 13:02:18',NULL,NULL);
INSERT INTO configuration VALUES (599,'グローバルナビブロックの有効化','MODULE_GLOBALNAVI_STATUS','true','グローバルナビを有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 13:03:12',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (600,'優先順','MODULE_GLOBALNAVI_SORT_ORDER','1950','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,1,NULL,'2009-11-19 13:03:12',NULL,NULL);
INSERT INTO configuration VALUES (601,'表示するカテゴリの上限','MODULE_GLOBALNAVI_CFG_LIMIT','5','グローバルナビに表示するカテゴリ数の上限を設定します',6,2,NULL,'2009-11-19 13:03:12',NULL,NULL);
INSERT INTO configuration VALUES (602,'複数画像表示 の有効化','MODULE_MULTIPLE_IMAGE_VIEW_STATUS','true','複数画像表示を有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 13:03:54',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (603,'優先順','MODULE_MULTIPLE_IMAGE_VIEW_SORT_ORDER','10','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,1,NULL,'2009-11-19 13:03:54',NULL,NULL);
INSERT INTO configuration VALUES (604,'サムネイルサイズ：幅','MODULE_MULTIPLE_IMAGE_VIEW_THMB_WIDTH','100','サムネイル画像の表示幅を設定できます。(pixel)',6,2,NULL,'2009-11-19 13:03:54',NULL,NULL);
INSERT INTO configuration VALUES (605,'サムネイルサイズ：高さ','MODULE_MULTIPLE_IMAGE_VIEW_THMB_HEIGHT','80','サムネイル画像の表示高さを設定できます。(pixel)',6,3,NULL,'2009-11-19 13:03:54',NULL,NULL);
INSERT INTO configuration VALUES (606,'CSVによる商品一括登録の有効化','MODULE_PRODUCT_CSV_STATUS','true','CSVによる商品一括登録を有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 13:04:30',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (607,'優先順','MODULE_PRODUCT_CSV_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,1,NULL,'2009-11-19 13:04:30',NULL,NULL);
INSERT INTO configuration VALUES (608,'オプション毎の在庫管理の有効化','MODULE_PRODUCTS_WITH_ATTRIBUTES_STOCK_STATUS','true','オプション毎の在庫管理を有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 13:05:03',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (609,'優先順','MODULE_PRODUCTS_WITH_ATTRIBUTES_STOCK_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,1,NULL,'2009-11-19 13:05:03',NULL,NULL);
INSERT INTO configuration VALUES (610,'商品レビューの有効化','MODULE_REVIEWS_STATUS','true','商品レビューを有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 13:05:33',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (611,'商品詳細ページ　レビュー表示数','MODULE_REVIEWS_MAX_DISPLAY_NEW_REVIEWS','3','商品詳細ページで表示される商品レビューの数を設定してください。<br />商品レビュー一覧ページのレビュー数は「一般設定」-「最大値の設定」-「新しいレビューの表示数最大値」で設定してください。',6,1,NULL,'2009-11-19 13:05:33',NULL,NULL);
INSERT INTO configuration VALUES (612,'非ログインユーザーの商品レビュー閲覧禁止','MODULE_REVIEWS_LIST_DISPLAY_FORCE_LOGIN','false','ログインしていないユーザーは商品レビュー閲覧ができない。',6,2,NULL,'2009-11-19 13:05:33',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (613,'優先順','MODULE_REVIEWS_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,3,NULL,'2009-11-19 13:05:33',NULL,NULL);
INSERT INTO configuration VALUES (614,'もっと検索の有効化','MODULE_SEARCH_MORE_STATUS','true','もっと検索を有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 13:06:01',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (615,'表示件数リストボックスのタイトル','MODULE_SEARCH_MORE_PAGE_MAX_LIST_NAME','表示件数','商品一覧の中で表示される商品の数を指定するリストのラベルを指定してください。デフォルト値は「表示件数」です。',6,1,NULL,'2009-11-19 13:06:01',NULL,NULL);
INSERT INTO configuration VALUES (616,'表示件数リストボックスの値','MODULE_SEARCH_MORE_PAGE_MAX_LIST_VALUE','10,25,50,100','商品一覧の中で表示される商品の数を指定するリストの内容をカンマ(,)区切りで指定してください。デフォルト値は「10,25,50,100」です。',6,2,NULL,'2009-11-19 13:06:01',NULL,NULL);
INSERT INTO configuration VALUES (617,'並び替えリストボックスのタイトル','MODULE_SEARCH_MORE_SORT_LIST_NAME','並び替え','商品一覧のソート順を指定するリストのラベルを指定してください。デフォルト値は「並び替え」です。',6,3,NULL,'2009-11-19 13:06:01',NULL,NULL);
INSERT INTO configuration VALUES (618,'優先順','MODULE_SEARCH_MORE_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,4,NULL,'2009-11-19 13:06:01',NULL,NULL);
INSERT INTO configuration VALUES (622,'ポイントモジュールの有効化<br />有効化の後に<a href=\"http://zen-cart.ark-web.jp/ohtsuji/zencart-sugu/admin/addon_modules_admin.php?module=addon_modules/blocks\">ブロックの設定</a>から「現在のポイント残額」ブロックの表示設定をしてください。','MODULE_POINT_BASE_STATUS','true','ポイントを有効にしますか？ (ポイントモジュールは他の全てのポイントモジュールにとって必須です)<br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 18:25:40',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (623,'ポイント単位名称','MODULE_POINT_BASE_POINT_SYMBOL','point','ポイントの単位名称を入力してください。<br />・初期値 = point',6,1,NULL,'2009-11-19 18:25:40',NULL,NULL);
INSERT INTO configuration VALUES (624,'ポイント管理ページで表示するポイント履歴の最大値','MODULE_POINT_BASE_MAX_DISPLAY_SEARCH_RESULTS_POINTS','20','ポイント管理ページで表示するポイント履歴の最大値を設定してください。<br />・初期値 = 20',6,2,NULL,'2009-11-19 18:25:40',NULL,NULL);
INSERT INTO configuration VALUES (625,'優先順','MODULE_POINT_BASE_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,3,NULL,'2009-11-19 18:25:40',NULL,NULL);
INSERT INTO configuration VALUES (640,'会員登録ポイント発行モジュールの有効化','MODULE_POINT_CREATEACCOUNT_STATUS','true','会員登録ポイント発行モジュールを有効にしますか？<br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 18:56:07',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (641,'発行ポイントの保留','MODULE_POINT_CREATEACCOUNT_PENDING','false','ポイント発行時にそのポイントの使用を保留にしますか？<br />保留しない場合はポイント発行後すぐに使用できます。<br />true: 保留にする<br />false: 保留にしない（即時使用可能）',6,1,NULL,'2009-11-19 18:56:07',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (642,'会員登録ポイント数','MODULE_POINT_CREATEACCOUNT_POINT','','会員登録時にその会員へプレゼントするポイント数を設定します。<br />例: 500 (会員登録時に500ポイントプレゼント)',6,2,NULL,'2009-11-19 18:56:07',NULL,NULL);
INSERT INTO configuration VALUES (643,'優先順','MODULE_POINT_CREATEACCOUNT_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,3,NULL,'2009-11-19 18:56:07',NULL,NULL);
INSERT INTO configuration VALUES (644,'顧客毎ポイント還元率設定モジュールの有効化','MODULE_POINT_CUSTOMERSRATE_STATUS','true','顧客毎ポイント還元率設定を有効にしますか？<br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 18:56:29',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (645,'優先順','MODULE_POINT_CUSTOMERSRATE_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,1,NULL,'2009-11-19 18:56:29',NULL,NULL);
INSERT INTO configuration VALUES (646,'顧客グループ毎ポイント還元率設定モジュールの有効化','MODULE_POINT_GROUPRATE_STATUS','true','顧客グループ毎ポイント還元率設定を有効にしますか？<br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 18:56:53',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (647,'優先順','MODULE_POINT_GROUPRATE_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,1,NULL,'2009-11-19 18:56:53',NULL,NULL);
INSERT INTO configuration VALUES (648,'商品毎ポイント還元率設定モジュールの有効化','MODULE_POINT_PRODUCTSRATE_STATUS','true','商品毎ポイント還元率設定を有効にしますか？<br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 18:57:28',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (649,'優先順','MODULE_POINT_PRODUCTSRATE_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,1,NULL,'2009-11-19 18:57:28',NULL,NULL);
INSERT INTO configuration VALUES (650,'ショッピングカートサマリーブロックの有効化','MODULE_SHOPPING_CART_SUMMARY_STATUS','true','ショッピングカートサマリーブロックを有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2009-11-19 19:37:35',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (651,'優先順','MODULE_SHOPPING_CART_SUMMARY_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,1,NULL,'2009-11-19 19:37:35',NULL,NULL);
INSERT INTO configuration VALUES (1531,'商品を修正','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_SUPER_ORDERS_PRODUCTS','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1530,'梱包を分割','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_SUPER_ORDERS_SPLIT','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1529,'注文最終設定','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_SUPER_ORDERS_FINAL','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1528,'支払情報','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_SUPER_ORDERS_PAYMENT','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1527,'合計モジュール','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_MODULES_OT_TOTAL','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1522,'SMTP認証 - DNS名','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_209','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1523,'SMTP認証 - IPポート番号','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_210','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1520,'SMTP認証 - メールアカウント','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_207','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1521,'SMTP認証 - パスワード','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_208','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1519,'オンラインユーザー数の表示設定','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_243','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1517,'在庫わずかになったらメール送信','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_240','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1518,'「メールマガジンの購読解除」リンクの表示','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_242','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1513,'掲載待ちレビューについてのメール送信先','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_236','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1514,'「お問い合わせ」メールのドロップダウン設定','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_237','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1516,'「お問い合わせ」にショップ名と住所を表記','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_239','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1515,'ゲストに「友達に知らせる」機能を許可','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_238','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1510,'ショップ運営者の注文ステータスメール(コピー)の送信','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_233','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1511,'ショップ運営者の注文ステータスメール(コピー)の送信先','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_234','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1512,'掲載待ちレビューについてメール送信','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_235','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1506,'ショップ運営者からのギフト券送付メール(コピー)の送信','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_229','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1507,'ショップ運営者からのギフト券送付メール(コピー)の送信先','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_230','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1508,'ショップ運営者からのクーポン券送付メール(コピー)の送信','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_231','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1509,'ショップ運営者からのクーポン券送付メール(コピー)の送信先','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_232','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1505,'ギフト券送付メール(コピー)の送信先','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_228','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1503,'管理者が送信するメールフォーマット','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_221','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1504,'ギフト券送付メール(コピー)の送信','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_227','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1502,'送信メールの送信元アドレスの実在性','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_220','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1501,'メール送信エラーの表示','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_217','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1500,'メール保存の設定','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_216','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1498,'メールアドレスをDNSで確認','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_214','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1499,'メールを送信','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_215','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1495,'メール送信 - 接続方法','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_206','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1497,'メール送信にMIME HTMLを使用','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_213','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1496,'メールの改行コード','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_12_212','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1494,'カテゴリ内の商品数を表示 - 管理画面','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_1_28','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1489,'Zen Cart新バージョンの自動チェック(ヘッダで告知するか否か)','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_1_22','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1490,'サーバの稼動時間(アップタイム)','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_1_24','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1491,'リンク切れページのチェック','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_1_25','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1492,'HTMLエディタ','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_1_26','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1493,'phpBBへのリンクを表示','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_1_27','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1488,'管理画面のプログラム処理の上限時間設定(秒)','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_1_21','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1487,'管理画面のタイムアウト設定(秒数)','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_1_20','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1486,'ショップのステータス','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_1_23','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1483,'商品にかかる税額の算定基準','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_1_17','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1484,'送料にかかる税額の算定基準','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_1_18','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1485,'税金の表示','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_1_19','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1482,'価格を税込みで表示 - 管理画面','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_1_16','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1480,'税額の小数点位置','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_1_14','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1481,'価格を税込みで表示','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_1_15','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1476,'表示言語の選択','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_1_8','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1477,'商品の追加後にカートを表示','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_1_10','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1478,'デフォルトの検索演算子','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_1_11','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1479,'カテゴリ内の商品数を表示','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_1_13','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1474,'入荷予定商品のソート順に用いるフィールド','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_1_6','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1475,'表示言語と通貨の連動','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_1_7','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1470,'画像ファイル名を入力','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_BANNER_MANAGER_IMAGE_LOCAL','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1471,'画像の保存先','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_BANNER_MANAGER_IMAGE_TARGET','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1473,'入荷予定商品のソート順','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_1_5','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1472,'ショップオーナー名','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CONFIGURATION_1_2','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1469,'新しいバナー','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_BANNER_MANAGER_NEW_GROUP','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1468,'重量,属性,値引き列','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_COLUMN','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1466,'商品選択プルダウン','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_PRODUCTS','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1467,'属性凡例','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_LEGEND','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1465,'カテゴリ選択プルダウン','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_CATEGORIES','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1464,'オプション画像','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_IMAGE','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1463,'属性フラグ','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_FLAGS','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1462,'単語/文字値引き','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_PRICE_WORDS','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1461,'数量値引き','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_QTY_PRICES','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1460,'属性のプライスファクター','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_PRICE_FACTOR','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1459,'属性のワンタイム値引き','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_ONETIME','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1458,'属性の重量','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_WEIGHT','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1457,'小数点','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_NUMBER_UNIT','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1456,'複数カテゴリのリンク管理へのリンク','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_CATEGORY','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1455,'商品および価格編集ボタン','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_MODIFY','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1454,'おすすめ商品プルダウン','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_OPTIONS_VALUES_COPIER','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1453,'コピー操作','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_OPTIONS_VALUES_COPY','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1452,'日本語以外の入力項目','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_OPTIONS_VALUES_LANGUAGE','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1451,'テキスト属性の長さ','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_OPTIONS_NAME_LENGTH','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1450,'一連の大きな変更','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_OPTIONS_NAME_BIG_MODIFY','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1449,'日本語以外の入力項目','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_OPTIONS_NAME_LANGUAGE','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1448,'編集へのリンク','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_FEATURED_EDIT_LINK','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1447,'価格の管理へのリンク','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_FEATURED_PRICE_LINK','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1446,'小数点','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_SPECIALS_NUMBER_UNIT','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1445,'選択へのリンク','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_SPECIALS_PRE_ADD','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1443,'価格の管理へのリンク','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_SPECIALS_PRICE_LINK','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1444,'編集へのリンク','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_SPECIALS_EDIT_LINK','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1436,'小数点','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_NUMBER_UNIT','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1437,'メタタグでの注意書き','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_META_TAGS_USAGE','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1438,'複数のカテゴリがマネージャをリンク','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_CATEGORY_MANAGER','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1439,'日本語以外の入力項目','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ORDER_STATUS_LANGUAGE','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1440,'グループ割引','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CUSTOMERS_GROUP_PRICING','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1441,'割引券贈呈','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CUSTOMERS_REFERRAL','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1442,'日本語以外の入力項目','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_MANUFACTURERS_LANGUAGE','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (767,'Sitemap XMLの有効化','MODULE_SITEMAPXML_STATUS','true','Sitemap XMLを有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2010-04-20 19:40:09',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (768,'Compress XML File','MODULE_SITEMAPXML_COMPRESS','false','Compress Google XML Sitemap file',6,1,NULL,'2010-04-20 19:40:09',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (769,'Lastmod tag format','MODULE_SITEMAPXML_LASTMOD_FORMAT','date','Lastmod tag format:<br />date - Complete date: YYYY-MM-DD (eg 1997-07-16)<br />full -    Complete date plus hours, minutes and seconds: YYYY-MM-DDThh:mm:ssTZD (eg 1997-07-16T19:20:30+01:00)',6,2,NULL,'2010-04-20 19:40:09',NULL,'zen_cfg_select_option(array(\'date\', \'full\'), ');
INSERT INTO configuration VALUES (770,'Use Existing Files','MODULE_SITEMAPXML_USE_EXISTING_FILES','true','Use Existing XML Files',6,3,NULL,'2010-04-20 19:40:09',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (771,'Generate language_id for default language','MODULE_SITEMAPXML_USE_DEFAULT_LANGUAGE','true','Generate language_id parameter for default language',6,4,NULL,'2010-04-20 19:40:09',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (772,'Ping urls','MODULE_SITEMAPXML_PING_URLS','Google => http://www.google.com/webmasters/sitemaps/ping?sitemap=%s; Yahoo! => http://search.yahooapis.com/SiteExplorerService/V1/ping?sitemap=%s; Ask.com => http://submissions.ask.com/ping?sitemap=%s; Microsoft => http://www.moreover.com/ping?u=%s','List of pinging urls separated by ;',6,5,NULL,'2010-04-20 19:40:09',NULL,'zen_cfg_textarea(');
INSERT INTO configuration VALUES (773,'Products order by','MODULE_SITEMAPXML_PRODUCTS_ORDERBY','products_sort_order ASC, last_date DESC','',6,6,NULL,'2010-04-20 19:40:09',NULL,NULL);
INSERT INTO configuration VALUES (774,'Products changefreq','MODULE_SITEMAPXML_PRODUCTS_CHANGEFREQ','weekly','How frequently the Product pages page is likely to change.',6,7,NULL,'2010-04-20 19:40:09',NULL,'zen_cfg_select_option(array(\'always\', \'hourly\', \'daily\', \'weekly\', \'monthly\', \'yearly\', \'never\'),');
INSERT INTO configuration VALUES (775,'Categories order by','MODULE_SITEMAPXML_CATEGORIES_ORDERBY','sort_order ASC, last_date DESC','',6,8,NULL,'2010-04-20 19:40:09',NULL,NULL);
INSERT INTO configuration VALUES (776,'Category changefreq','MODULE_SITEMAPXML_CATEGORIES_CHANGEFREQ','weekly','How frequently the Category pages page is likely to change.',6,9,NULL,'2010-04-20 19:40:09',NULL,'zen_cfg_select_option(array(\'always\', \'hourly\', \'daily\', \'weekly\', \'monthly\', \'yearly\', \'never\'),');
INSERT INTO configuration VALUES (777,'Reviews order by','MODULE_SITEMAPXML_REVIEWS_ORDERBY','reviews_rating ASC, last_date DESC','',6,10,NULL,'2010-04-20 19:40:09',NULL,NULL);
INSERT INTO configuration VALUES (778,'Reviews changefreq','MODULE_SITEMAPXML_REVIEWS_CHANGEFREQ','weekly','How frequently the Category pages page is likely to change.',6,11,NULL,'2010-04-20 19:40:09',NULL,'zen_cfg_select_option(array(\'always\', \'hourly\', \'daily\', \'weekly\', \'monthly\', \'yearly\', \'never\'),');
INSERT INTO configuration VALUES (779,'EZPages order by','MODULE_SITEMAPXML_EZPAGES_ORDERBY','sidebox_sort_order ASC, header_sort_order ASC, footer_sort_order ASC','',6,12,NULL,'2010-04-20 19:40:09',NULL,NULL);
INSERT INTO configuration VALUES (780,'EZPages changefreq','MODULE_SITEMAPXML_EZPAGES_CHANGEFREQ','weekly','How frequently the EZPages pages page is likely to change.',6,13,NULL,'2010-04-20 19:40:09',NULL,'zen_cfg_select_option(array(\'always\', \'hourly\', \'daily\', \'weekly\', \'monthly\', \'yearly\', \'never\'),');
INSERT INTO configuration VALUES (781,'Testimonials order by','MODULE_SITEMAPXML_TESTIMONIALS_ORDERBY','last_date DESC','',6,14,NULL,'2010-04-20 19:40:09',NULL,NULL);
INSERT INTO configuration VALUES (782,'Testimonials changefreq','MODULE_SITEMAPXML_TESTIMONIALS_CHANGEFREQ','weekly','How frequently the EZPages pages page is likely to change.',6,15,NULL,'2010-04-20 19:40:09',NULL,'zen_cfg_select_option(array(\'always\', \'hourly\', \'daily\', \'weekly\', \'monthly\', \'yearly\', \'never\'),');
INSERT INTO configuration VALUES (783,'優先順','MODULE_SITEMAPXML_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,16,NULL,'2010-04-20 19:40:09',NULL,NULL);
INSERT INTO configuration VALUES (784,'商品レビューの有効化','MODULE_EASY_REVIEWS_STATUS','true','商品レビューを有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2010-05-20 12:54:48',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (785,'商品詳細ページ　レビュー表示数','MODULE_EASY_REVIEWS_MAX_DISPLAY_NEW_REVIEWS','3','商品詳細ページで表示される商品レビューの数を設定してください。<br />商品レビュー一覧ページのレビュー数は「一般設定」-「最大値の設定」-「新しいレビューの表示数最大値」で設定してください。',6,1,NULL,'2010-05-20 12:54:48',NULL,NULL);
INSERT INTO configuration VALUES (786,'非ログインユーザーの商品レビュー閲覧禁止','MODULE_EASY_REVIEWS_LIST_DISPLAY_FORCE_LOGIN','false','ログインしていないユーザーは商品レビュー閲覧ができない。',6,2,NULL,'2010-05-20 12:54:48',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (787,'優先順','MODULE_EASY_REVIEWS_SORT_ORDER','','モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。',6,3,NULL,'2010-05-20 12:54:48',NULL,NULL);
INSERT INTO configuration VALUES (788,'郵便番号による住所自動入力の有効化','MODULE_AM_AJAX_ADDRESS_STATUS','true','郵便番号による住所自動入力を有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2010-05-20 13:02:17',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (1435,'商品重量','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_WEIGHT','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1434,'最小数量/単位ミックス','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_QUANTITY_MIXED','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1433,'商品の数量単位','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_QUANTITY_ORDER_UNIT','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1432,'商品の最大数量','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_QUANTITY_ORDER_MIN','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1431,'商品の最小数量','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_QUANTITY_ORDER_MAX','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1430,'常に送料無料','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_ALWAYS_FREE_SHIPPING','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1429,'ヴァーチャル商品','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_VIRTUAL','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1428,'価格お問い合わせ','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_PRICE_CALL','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1427,'無料商品','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_PRICE_FREE','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1426,'商品価格（グロス）','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_PRICE_GROSS','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1424,'商品属性による価格','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_PRICE_ATTRIBUTE','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1425,'税種別','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_TAX_CLASS','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1423,'日本語以外の入力項目','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_LANGUAGE','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1422,'商品オプションへのリンク','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CATEGORY_PRODUCT_ATTRIBUTE','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1421,'新規商品の商品種類プルダウン','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CATEGORY_PRODUCT_TYPE','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1420,'商品価格管理へのリンク','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CATEGORY_PRICE_LINK','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (1419,'日本語以外の入力項目','MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CATEGORY_LANGUAGE','false','',-1,1,NULL,'2010-06-07 22:43:03',NULL,NULL);
INSERT INTO configuration VALUES (907,'Store Fax','STORE_FAX','03-XXXX-XXXX','Enter the fax number for your store.<br>You can call upon this by using the define <strong>STORE_FAX</strong>.',1,4,'2010-06-18 11:27:23','2010-06-04 14:00:45',NULL,NULL);
INSERT INTO configuration VALUES (908,'Store Phone','STORE_PHONE','03-XXXX-XXXX','Enter the phone number for your store.<br>You can call upon this by using the define <strong>STORE_PHONE</strong>.',1,4,'2010-06-18 11:27:28','2010-06-04 14:00:45',NULL,NULL);
INSERT INTO configuration VALUES (909,'Enable Purchase Order Module','MODULE_PAYMENT_PURCHASE_ORDER_STATUS','True','Do you want to accept Purchase Order payments?',6,1,'2010-06-04 14:00:45','2010-06-04 14:00:45',NULL,'zen_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO configuration VALUES (910,'Make payable to:','MODULE_PAYMENT_PURCHASE_ORDER_PAYTO','Destination ImagiNation, Inc.','Who should payments be made payable to?',6,2,'2010-06-04 14:00:45','2010-06-04 14:00:45',NULL,NULL);
INSERT INTO configuration VALUES (911,'Sort order of display.','MODULE_PAYMENT_PURCHASE_ORDER_SORT_ORDER','0','Sort order of display. Lowest is displayed first.',6,4,'2010-06-04 14:00:45','2010-06-04 14:00:45',NULL,NULL);
INSERT INTO configuration VALUES (912,'Payment Zone','MODULE_PAYMENT_PURCHASE_ORDER_ZONE','0','If a zone is selected, only enable this payment method for that zone.',6,5,'2010-06-04 14:00:45','2010-06-04 14:00:45','zen_get_zone_class_title','zen_cfg_pull_down_zone_classes(');
INSERT INTO configuration VALUES (913,'Set Order Status','MODULE_PAYMENT_PURCHASE_ORDER_ORDER_STATUS_ID','2','Set the status of orders made with this payment module to this value',6,6,'2010-06-04 14:00:45','2010-06-04 14:00:45','zen_get_order_status_name','zen_cfg_pull_down_order_statuses(');
INSERT INTO configuration VALUES (914,'Auto Status - Purchase Order','AUTO_STATUS_PO','2','Number of the status assigned to an order when a purchase order is added to the payment data.',28,11,'2010-06-04 14:00:45','2010-06-04 14:00:45','zen_get_order_status_name','zen_cfg_pull_down_order_statuses(');
INSERT INTO configuration VALUES (915,'Auto Status - Payment','AUTO_STATUS_PAYMENT','2','Number of the order status assigned when a payment (<B>not</B> attached to a purchase order) is added to the payment data.',28,10,'2010-06-04 14:00:45','2010-06-04 14:00:45','zen_get_order_status_name','zen_cfg_pull_down_order_statuses(');
INSERT INTO configuration VALUES (916,'Auto Status - P.O. Payment','AUTO_STATUS_PO_PAYMENT','2','Number of the order status assigned when a payment <B>attached to a purchase order</B> is added to the payment data.',28,10,'2010-06-04 14:00:45','2010-06-04 14:00:45','zen_get_order_status_name','zen_cfg_pull_down_order_statuses(');
INSERT INTO configuration VALUES (917,'Auto Status - Refund','AUTO_STATUS_REFUND','2','Number of the order status assigned when a refund is added to the payment data.',28,13,'2010-06-04 14:00:45','2010-06-04 14:00:45','zen_get_order_status_name','zen_cfg_pull_down_order_statuses(');
INSERT INTO configuration VALUES (918,'Auto Comments - Payment','AUTO_COMMENTS_PAYMENT','Payment received in our office. Payment ID: %s','You\'ll have the option of adding these pre-configured comments to an order when a payment is entered.  You can attach the payment number to the comments by typing <strong>%s</strong>.',28,14,'2010-06-04 14:00:45','2010-06-04 14:00:45',NULL,NULL);
INSERT INTO configuration VALUES (919,'Auto Comments - P.O. Payment','AUTO_COMMENTS_PO_PAYMENT','Payment on purchase order received in our office. Payment ID: %s','You will have the option of adding these pre-configured comments to an order when a purchase order payment is entered.  You can attach the payment number to the comments by typing <strong>%s</strong>.',28,14,'2010-06-04 14:00:45','2010-06-04 14:00:45',NULL,NULL);
INSERT INTO configuration VALUES (920,'Auto Comments - Purchase Order','AUTO_COMMENTS_PO','Purchase Order #%s received in our office','You will have the option of adding these pre-configured comments to an order when a purchase order is entered.  You can attach the payment number to the comments by typing <strong>%s</strong>.',28,15,'2010-06-04 14:00:45','2010-06-04 14:00:45',NULL,NULL);
INSERT INTO configuration VALUES (921,'Auto Comments - Refund','AUTO_COMMENTS_REFUND','Refund #%s has been issued from our office.','You will have the option of adding these pre-configured comments to an order when a refund is entered.  You can attach the refund number to the comments by typing <strong>%s</strong>.',28,17,'2010-06-04 14:00:45','2010-06-04 14:00:45',NULL,NULL);
INSERT INTO configuration VALUES (922,'Federal Tax Exempt Number','FED_TAX_ID_NUMBER','00-000000','If your tax exempt, then you should have a federal tax ID number. Enter the number here and the tax columns will not appear on the invoice. The number will also be displayed at the top of the invoice.',28,50,'2010-06-04 14:00:45','2010-06-04 14:00:45',NULL,NULL);
INSERT INTO configuration VALUES (923,'Closed Status - \"Cancelled\"','STATUS_ORDER_CANCELLED','0','Insert the order status ID # you would like to assign to an order when you press the special \"Cancelled!\" button on super_orders.php.<p>If you do not have a \"cancel\" status, or do not want assign one automatically, choose <B>default</B> and this option will be ignored.<p><strong>You cannot attach comments or notify the customer using this option.</strong>',28,30,'2010-06-04 14:00:45','2010-06-04 14:00:45','zen_get_order_status_name','zen_cfg_pull_down_order_statuses(');
INSERT INTO configuration VALUES (924,'Closed Status - \"Completed\"','STATUS_ORDER_COMPLETED','0','Insert the order status ID # you would like to assign to an order when you press the special \"Completed!\" button on super_orders.php.<p>If you do not have a \"complete\" status, or do not want assign one automatically, choose <B>default</B> and this option will be ignored.<p><strong>You cannot attach comments or notify the customer using this option.</strong>',28,30,'2010-06-04 14:00:45','2010-06-04 14:00:45','zen_get_order_status_name','zen_cfg_pull_down_order_statuses(');
INSERT INTO configuration VALUES (925,'Closed Status - \"Reopened\"','STATUS_ORDER_REOPEN','0','Insert the order status ID # you would like to assign to an order when you undo the cancelled/completed status of an order.<p>If you do not have a \"reopened\" status, or do not want assign one automatically, choose <B>default</B> and this option will be ignored.<p><strong>You cannot attach comments or notify the customer using this option.</strong>',28,30,'2010-06-04 14:00:45','2010-06-04 14:00:45','zen_get_order_status_name','zen_cfg_pull_down_order_statuses(');
INSERT INTO configuration VALUES (926,'銀行振込を有効にする','MODULE_PAYMENT_MONEYORDER_STATUS','True','銀行振込による支払いを受け付けますか？',6,1,NULL,'2010-06-04 14:41:50',NULL,'zen_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO configuration VALUES (927,'お振込先:','MODULE_PAYMENT_MONEYORDER_PAYTO','','お振込先名義を設定してください。',6,1,NULL,'2010-06-04 14:41:50',NULL,NULL);
INSERT INTO configuration VALUES (928,'表示の整列順','MODULE_PAYMENT_MONEYORDER_SORT_ORDER','0','表示の整列順を設定できます。数字が小さいほど上位に表示されます。',6,0,NULL,'2010-06-04 14:41:50',NULL,NULL);
INSERT INTO configuration VALUES (929,'適用地域','MODULE_PAYMENT_MONEYORDER_ZONE','0','適用地域を選択すると、選択した地域のみで利用可能となります。',6,2,NULL,'2010-06-04 14:41:50','zen_get_zone_class_title','zen_cfg_pull_down_zone_classes(');
INSERT INTO configuration VALUES (930,'初期注文ステータス','MODULE_PAYMENT_MONEYORDER_ORDER_STATUS_ID','0','設定したステータスが受注時に適用されます。',6,0,NULL,'2010-06-04 14:41:50','zen_get_order_status_name','zen_cfg_pull_down_order_statuses(');
INSERT INTO configuration VALUES (931,'インストール状態','MODULE_ORDER_TOTAL_GROUP_PRICING_STATUS','true','',6,1,NULL,'2010-06-04 14:43:24',NULL,'zen_cfg_select_option(array(\'true\'), ');
INSERT INTO configuration VALUES (932,'表示の整列順','MODULE_ORDER_TOTAL_GROUP_PRICING_SORT_ORDER','290','表示の整列順を設定できます. 数字が小さいほど上位に表示されます。',6,2,NULL,'2010-06-04 14:43:24',NULL,NULL);
INSERT INTO configuration VALUES (933,'送料を含める','MODULE_ORDER_TOTAL_GROUP_PRICING_INC_SHIPPING','false','送料を計算に含めますか？',6,5,NULL,'2010-06-04 14:43:24',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (934,'税金を含める','MODULE_ORDER_TOTAL_GROUP_PRICING_INC_TAX','true','税金を計算に含めますか？',6,6,NULL,'2010-06-04 14:43:24',NULL,'zen_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration VALUES (935,'税金の再計算','MODULE_ORDER_TOTAL_GROUP_PRICING_CALC_TAX','Standard','税金を再計算しますか？',6,7,NULL,'2010-06-04 14:43:24',NULL,'zen_cfg_select_option(array(\'None\', \'Standard\', \'Credit Note\'), ');
INSERT INTO configuration VALUES (936,'税種別','MODULE_ORDER_TOTAL_GROUP_PRICING_TAX_CLASS','0','顧客割引をCredit Note（貸方票）取引として利用する際に適応する税種別。',6,0,NULL,'2010-06-04 14:43:24','zen_get_tax_class_title','zen_cfg_pull_down_tax_classes(');
INSERT INTO configuration VALUES (937,'インストール状態','MODULE_ORDER_TOTAL_COD_STATUS','true','',6,1,NULL,'2010-06-04 14:43:27',NULL,'zen_cfg_select_option(array(\'true\'), ');
INSERT INTO configuration VALUES (938,'表示の整列順','MODULE_ORDER_TOTAL_COD_SORT_ORDER','950','表示の整列順を設定できます. 数字が小さいほど上位に表示されます。',6,2,NULL,'2010-06-04 14:43:27',NULL,NULL);
INSERT INTO configuration VALUES (939,'COD Fee for FLAT','MODULE_ORDER_TOTAL_COD_FEE_FLAT','AT:3.00,DE:3.58,00:9.99','FLAT: &lt;Country code&gt;:&lt;COD price&gt;, .... 00 as country code applies for all countries. If country code is 00, it must be the last statement. If no 00:9.99 appears, COD shipping in foreign countries is not calculated (not possible)',6,3,NULL,'2010-06-04 14:43:27',NULL,NULL);
INSERT INTO configuration VALUES (940,'COD Fee for Free Shipping by default','MODULE_ORDER_TOTAL_COD_FEE_FREE','US:3.00','Free by default: &lt;Country code&gt;:&lt;COD price&gt;, .... 00 as country code applies for all countries. If country code is 00, it must be the last statement. If no 00:9.99 appears, COD shipping in foreign countries is not calculated (not possible)',6,3,NULL,'2010-06-04 14:43:27',NULL,NULL);
INSERT INTO configuration VALUES (941,'COD Fee for Free Shipping Module - (freeshipper)','MODULE_ORDER_TOTAL_COD_FEE_FREESHIPPER','CA:4.50,US:3.00,00:9.99','Free Module: &lt;Country code&gt;:&lt;COD price&gt;, .... 00 as country code applies for all countries. If country code is 00, it must be the last statement. If no 00:9.99 appears, COD shipping in foreign countries is not calculated (not possible)',6,3,NULL,'2010-06-04 14:43:27',NULL,NULL);
INSERT INTO configuration VALUES (942,'COD Fee for Free-Options Shipping Module - (freeoptions)','MODULE_ORDER_TOTAL_COD_FEE_FREEOPTIONS','CA:4.50,US:3.00,00:9.99','Free+Options: &lt;Country code&gt;:&lt;COD price&gt;, .... 00 as country code applies for all countries. If country code is 00, it must be the last statement. If no 00:9.99 appears, COD shipping in foreign countries is not calculated (not possible)',6,3,NULL,'2010-06-04 14:43:27',NULL,NULL);
INSERT INTO configuration VALUES (943,'COD Fee for Per Weight Unit Shipping Module - (perweightunit)','MODULE_ORDER_TOTAL_COD_FEE_PERWEIGHTUNIT','CA:4.50,US:3.00,00:9.99','Per Weight Unit: &lt;Country code&gt;:&lt;COD price&gt;, .... 00 as country code applies for all countries. If country code is 00, it must be the last statement. If no 00:9.99 appears, COD shipping in foreign countries is not calculated (not possible)',6,3,NULL,'2010-06-04 14:43:27',NULL,NULL);
INSERT INTO configuration VALUES (944,'COD Fee for ITEM','MODULE_ORDER_TOTAL_COD_FEE_ITEM','AT:3.00,DE:3.58,00:9.99','ITEM: &lt;Country code&gt;:&lt;COD price&gt;, .... 00 as country code applies for all countries. If country code is 00, it must be the last statement. If no 00:9.99 appears, COD shipping in foreign countries is not calculated (not possible)',6,4,NULL,'2010-06-04 14:43:27',NULL,NULL);
INSERT INTO configuration VALUES (945,'COD Fee for TABLE','MODULE_ORDER_TOTAL_COD_FEE_TABLE','AT:3.00,DE:3.58,00:9.99','TABLE: &lt;Country code&gt;:&lt;COD price&gt;, .... 00 as country code applies for all countries. If country code is 00, it must be the last statement. If no 00:9.99 appears, COD shipping in foreign countries is not calculated (not possible)',6,5,NULL,'2010-06-04 14:43:27',NULL,NULL);
INSERT INTO configuration VALUES (946,'COD Fee for UPS','MODULE_ORDER_TOTAL_COD_FEE_UPS','CA:4.50,US:3.00,00:9.99','UPS: &lt;Country code&gt;:&lt;COD price&gt;, .... 00 as country code applies for all countries. If country code is 00, it must be the last statement. If no 00:9.99 appears, COD shipping in foreign countries is not calculated (not possible)',6,6,NULL,'2010-06-04 14:43:27',NULL,NULL);
INSERT INTO configuration VALUES (947,'COD Fee for USPS','MODULE_ORDER_TOTAL_COD_FEE_USPS','CA:4.50,US:3.00,00:9.99','USPS: &lt;Country code&gt;:&lt;COD price&gt;, .... 00 as country code applies for all countries. If country code is 00, it must be the last statement. If no 00:9.99 appears, COD shipping in foreign countries is not calculated (not possible)',6,7,NULL,'2010-06-04 14:43:27',NULL,NULL);
INSERT INTO configuration VALUES (948,'COD Fee for ZONES','MODULE_ORDER_TOTAL_COD_FEE_ZONES','CA:4.50,US:3.00,00:9.99','ZONES: &lt;Country code&gt;:&lt;COD price&gt;, .... 00 as country code applies for all countries. If country code is 00, it must be the last statement. If no 00:9.99 appears, COD shipping in foreign countries is not calculated (not possible)',6,8,NULL,'2010-06-04 14:43:27',NULL,NULL);
INSERT INTO configuration VALUES (949,'COD Fee for Austrian Post','MODULE_ORDER_TOTAL_COD_FEE_AP','AT:3.63,00:9.99','Austrian Post: &lt;Country code&gt;:&lt;COD price&gt;, .... 00 as country code applies for all countries. If country code is 00, it must be the last statement. If no 00:9.99 appears, COD shipping in foreign countries is not calculated (not possible)',6,9,NULL,'2010-06-04 14:43:27',NULL,NULL);
INSERT INTO configuration VALUES (950,'COD Fee for German Post','MODULE_ORDER_TOTAL_COD_FEE_DP','DE:3.58,00:9.99','German Post: &lt;Country code&gt;:&lt;COD price&gt;, .... 00 as country code applies for all countries. If country code is 00, it must be the last statement. If no 00:9.99 appears, COD shipping in foreign countries is not calculated (not possible)',6,10,NULL,'2010-06-04 14:43:27',NULL,NULL);
INSERT INTO configuration VALUES (951,'COD Fee for Servicepakke','MODULE_ORDER_TOTAL_COD_FEE_SERVICEPAKKE','NO:69','Servicepakke: &lt;Country code&gt;:&lt;COD price&gt;, .... 00 as country code applies for all countries. If country code is 00, it must be the last statement. If no 00:9.99 appears, COD shipping in foreign countries is not calculated (not possible)',6,11,NULL,'2010-06-04 14:43:27',NULL,NULL);
INSERT INTO configuration VALUES (952,'COD Fee for FedEx','MODULE_ORDER_TOTAL_COD_FEE_FEDEX','US:3.00','FedEx: &lt;Country code&gt;:&lt;COD price&gt;, .... 00 as country code applies for all countries. If country code is 00, it must be the last statement. If no 00:9.99 appears, COD shipping in foreign countries is not calculated (not possible)',6,12,NULL,'2010-06-04 14:43:27',NULL,NULL);
INSERT INTO configuration VALUES (953,'佐川急便の代金引換(e-コレクト)用の代引き手数料','MODULE_ORDER_TOTAL_COD_FEE_SAGAWA','00:500','e-コレクトの手数料を「国コード:手数料,国コード:手数料,...」という書式で入力してください。国コードがわかならい場合、またはすべて統一する場合は00：手数料で記してください',6,13,NULL,'2010-06-04 14:43:27',NULL,NULL);
INSERT INTO configuration VALUES (954,'ヤマト運輸の代金引換(ヤマトコレクト)用の代引き手数料','MODULE_ORDER_TOTAL_COD_FEE_YAMATO','00:400','ヤマトコレクトの手数料を「国コード:手数料,国コード:手数料,...」という書式で入力してください。国コードがわかならい場合、またはすべて統一する場合は00：手数料で記してください',6,14,NULL,'2010-06-04 14:43:27',NULL,NULL);
INSERT INTO configuration VALUES (955,'日本通運の代金引換(ペリカン集金サービス)用の代引き手数料','MODULE_ORDER_TOTAL_COD_FEE_NITTSU','00:400','ペリカン集金サービスの手数料を「国コード:手数料,国コード:手数料,...」という書式で入力してください。国コードがわかならい場合、またはすべて統一する場合は00：手数料で記してください',6,15,NULL,'2010-06-04 14:43:27',NULL,NULL);
INSERT INTO configuration VALUES (956,'税種別','MODULE_ORDER_TOTAL_COD_TAX_CLASS','0','代金引換手数料に適用される税種別',6,25,NULL,'2010-06-04 14:43:27','zen_get_tax_class_title','zen_cfg_pull_down_tax_classes(');
INSERT INTO configuration VALUES (957,'管理メニューの設定の有効化','MODULE_EASY_ADMIN_SIMPLIFY_STATUS','true','管理メニューの設定を有効にしますか？ <br />true: 有効<br />false: 無効',6,0,NULL,'2010-06-07 16:43:06',NULL,'zen_cfg_select_option(array(\'true\', \'false\'),');

--
-- Table structure for table configuration_foreach_template
--

DROP TABLE IF EXISTS configuration_foreach_template;
CREATE TABLE configuration_foreach_template (
configuration_id int(11) NOT NULL auto_increment,
configuration_title text NOT NULL,
configuration_key varchar(255) NOT NULL default '',
configuration_value text NOT NULL,
configuration_description text NOT NULL,
configuration_group_id int(11) NOT NULL default '0',
template_dir varchar(64) NOT NULL default '',
sort_order int(5) default NULL,
last_modified datetime default NULL,
date_added datetime NOT NULL default '0001-01-01 00:00:00',
use_function text,
set_function text,
PRIMARY KEY  (configuration_id),
UNIQUE KEY unq_config_key_zen (template_dir,configuration_key),
KEY idx_key_value_zen (configuration_key,configuration_value(10)),
KEY idx_cfg_grp_id_zen (configuration_group_id)
) ENGINE=MyISAM AUTO_INCREMENT=226 DEFAULT CHARSET=ujis;

--
-- Dumping data for table configuration_foreach_template
--


--
-- Table structure for table configuration_group
--

DROP TABLE IF EXISTS configuration_group;
CREATE TABLE configuration_group (
configuration_group_id int(11) NOT NULL auto_increment,
configuration_group_title varchar(64) NOT NULL default '',
configuration_group_description varchar(255) NOT NULL default '',
sort_order int(5) default NULL,
visible int(1) default '1',
PRIMARY KEY  (configuration_group_id),
KEY idx_visible_zen (visible)
) ENGINE=MyISAM AUTO_INCREMENT=101 DEFAULT CHARSET=ujis;

--
-- Dumping data for table configuration_group
--

INSERT INTO configuration_group VALUES (1,'ショップ全般の設定','ショップの一般的な項目を設定します。',1,1);
INSERT INTO configuration_group VALUES (2,'最小値の設定','機能・データ類の最小(少)値について設定します。',2,1);
INSERT INTO configuration_group VALUES (3,'最大値の設定','機能・データ類の最大値について設定します。',3,1);
INSERT INTO configuration_group VALUES (4,'画像の設定','各種の画像について設定します。',4,1);
INSERT INTO configuration_group VALUES (5,'顧客アカウントの設定','顧客について各種の設定をします。',5,1);
INSERT INTO configuration_group VALUES (6,'モジュールの設定','(設定画面では隠れています)',6,0);
INSERT INTO configuration_group VALUES (7,'配送料・パッケージの設定','拝承料・パッケージ(梱包)について各種の設定をします。',7,1);
INSERT INTO configuration_group VALUES (8,'商品リストの設定','商品リストの表示について各種の設定をします。',8,1);
INSERT INTO configuration_group VALUES (9,'在庫の設定','在庫について各種の設定をします。',9,1);
INSERT INTO configuration_group VALUES (10,'ログの設定','ログについて各種の設定をします。',10,1);
INSERT INTO configuration_group VALUES (11,'規約関連の設定','規約について各種の設定をします。',16,1);
INSERT INTO configuration_group VALUES (12,'メールの設定','メールの送受信や書式について各種の設定をします。',12,1);
INSERT INTO configuration_group VALUES (13,'商品属性の設定','商品属性について各種の設定をします。',13,1);
INSERT INTO configuration_group VALUES (14,'GZip圧縮の設定','GZip圧縮について設定します。',14,1);
INSERT INTO configuration_group VALUES (15,'セッション管理の設定','セッション情報の管理について各種の設定をします。',15,1);
INSERT INTO configuration_group VALUES (16,'ギフト券・クーポン券の設定','ギフト券・クーポン券について各種の設定をします。',16,1);
INSERT INTO configuration_group VALUES (17,'クレジットカードの設定','クレジットカードについて各種の設定をします。',17,1);
INSERT INTO configuration_group VALUES (18,'商品情報の設定','商品情報の表示について各種の設定をします。',18,1);
INSERT INTO configuration_group VALUES (19,'レイアウトの設定','ショップの表示レイアウトについて各種の設定をします。',19,1);
INSERT INTO configuration_group VALUES (20,'メンテナンス表示の設定','「メンテナンス中」表示などについて各種の設定をします。',20,1);
INSERT INTO configuration_group VALUES (21,'新着商品リストの設定','新着商品リストについて各種の設定をします。',21,1);
INSERT INTO configuration_group VALUES (22,'おすすめ商品リストの設定','おすすめ商品リストについて各種の設定をします。',22,1);
INSERT INTO configuration_group VALUES (23,'全商品リストの設定','全商品リストについて各種の設定をします。',23,1);
INSERT INTO configuration_group VALUES (24,'トップページの表示設定','トップページの要素表示について各種の設定をします。',24,1);
INSERT INTO configuration_group VALUES (25,'定番ページの表示設定','定番ページとHTMLAreaなどについて各種の設定をします。',25,1);
INSERT INTO configuration_group VALUES (30,'EZ-Pagesの設定','EZページについて各種の設定をします。',30,1);
INSERT INTO configuration_group VALUES (100,'携帯サイトの管理','携帯サイトについて各種の設定をします。',100,1);
INSERT INTO configuration_group VALUES (28,'Super Orders','Settings for Super Order features',100,1);

--
-- Table structure for table counter
--

DROP TABLE IF EXISTS counter;
CREATE TABLE counter (
startdate char(8) default NULL,
counter int(12) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table counter
--


--
-- Table structure for table counter_history
--

DROP TABLE IF EXISTS counter_history;
CREATE TABLE counter_history (
startdate char(8) default NULL,
counter int(12) default NULL,
session_counter int(12) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table counter_history
--


--
-- Table structure for table countries
--

DROP TABLE IF EXISTS countries;
CREATE TABLE countries (
countries_id int(11) NOT NULL auto_increment,
countries_name varchar(64) NOT NULL default '',
countries_iso_code_2 varchar(2) NOT NULL default '',
countries_iso_code_3 varchar(3) NOT NULL default '',
address_format_id int(11) NOT NULL default '0',
PRIMARY KEY  (countries_id),
KEY idx_countries_name_zen (countries_name)
) ENGINE=MyISAM AUTO_INCREMENT=241 DEFAULT CHARSET=ujis;

--
-- Dumping data for table countries
--

INSERT INTO countries VALUES (240,'Aaland Islands','AX','ALA',1);
INSERT INTO countries VALUES (1,'Afghanistan','AF','AFG',1);
INSERT INTO countries VALUES (2,'Albania','AL','ALB',1);
INSERT INTO countries VALUES (3,'Algeria','DZ','DZA',1);
INSERT INTO countries VALUES (4,'American Samoa','AS','ASM',1);
INSERT INTO countries VALUES (5,'Andorra','AD','AND',1);
INSERT INTO countries VALUES (6,'Angola','AO','AGO',1);
INSERT INTO countries VALUES (7,'Anguilla','AI','AIA',1);
INSERT INTO countries VALUES (8,'Antarctica','AQ','ATA',1);
INSERT INTO countries VALUES (9,'Antigua and Barbuda','AG','ATG',1);
INSERT INTO countries VALUES (10,'Argentina','AR','ARG',1);
INSERT INTO countries VALUES (11,'Armenia','AM','ARM',1);
INSERT INTO countries VALUES (12,'Aruba','AW','ABW',1);
INSERT INTO countries VALUES (13,'Australia','AU','AUS',1);
INSERT INTO countries VALUES (14,'Austria','AT','AUT',5);
INSERT INTO countries VALUES (15,'Azerbaijan','AZ','AZE',1);
INSERT INTO countries VALUES (16,'Bahamas','BS','BHS',1);
INSERT INTO countries VALUES (17,'Bahrain','BH','BHR',1);
INSERT INTO countries VALUES (18,'Bangladesh','BD','BGD',1);
INSERT INTO countries VALUES (19,'Barbados','BB','BRB',1);
INSERT INTO countries VALUES (20,'Belarus','BY','BLR',1);
INSERT INTO countries VALUES (21,'Belgium','BE','BEL',1);
INSERT INTO countries VALUES (22,'Belize','BZ','BLZ',1);
INSERT INTO countries VALUES (23,'Benin','BJ','BEN',1);
INSERT INTO countries VALUES (24,'Bermuda','BM','BMU',1);
INSERT INTO countries VALUES (25,'Bhutan','BT','BTN',1);
INSERT INTO countries VALUES (26,'Bolivia','BO','BOL',1);
INSERT INTO countries VALUES (27,'Bosnia and Herzegowina','BA','BIH',1);
INSERT INTO countries VALUES (28,'Botswana','BW','BWA',1);
INSERT INTO countries VALUES (29,'Bouvet Island','BV','BVT',1);
INSERT INTO countries VALUES (30,'Brazil','BR','BRA',1);
INSERT INTO countries VALUES (31,'British Indian Ocean Territory','IO','IOT',1);
INSERT INTO countries VALUES (32,'Brunei Darussalam','BN','BRN',1);
INSERT INTO countries VALUES (33,'Bulgaria','BG','BGR',1);
INSERT INTO countries VALUES (34,'Burkina Faso','BF','BFA',1);
INSERT INTO countries VALUES (35,'Burundi','BI','BDI',1);
INSERT INTO countries VALUES (36,'Cambodia','KH','KHM',1);
INSERT INTO countries VALUES (37,'Cameroon','CM','CMR',1);
INSERT INTO countries VALUES (38,'Canada','CA','CAN',1);
INSERT INTO countries VALUES (39,'Cape Verde','CV','CPV',1);
INSERT INTO countries VALUES (40,'Cayman Islands','KY','CYM',1);
INSERT INTO countries VALUES (41,'Central African Republic','CF','CAF',1);
INSERT INTO countries VALUES (42,'Chad','TD','TCD',1);
INSERT INTO countries VALUES (43,'Chile','CL','CHL',1);
INSERT INTO countries VALUES (44,'China','CN','CHN',1);
INSERT INTO countries VALUES (45,'Christmas Island','CX','CXR',1);
INSERT INTO countries VALUES (46,'Cocos (Keeling) Islands','CC','CCK',1);
INSERT INTO countries VALUES (47,'Colombia','CO','COL',1);
INSERT INTO countries VALUES (48,'Comoros','KM','COM',1);
INSERT INTO countries VALUES (49,'Congo','CG','COG',1);
INSERT INTO countries VALUES (50,'Cook Islands','CK','COK',1);
INSERT INTO countries VALUES (51,'Costa Rica','CR','CRI',1);
INSERT INTO countries VALUES (52,'Cote D\'Ivoire','CI','CIV',1);
INSERT INTO countries VALUES (53,'Croatia','HR','HRV',1);
INSERT INTO countries VALUES (54,'Cuba','CU','CUB',1);
INSERT INTO countries VALUES (55,'Cyprus','CY','CYP',1);
INSERT INTO countries VALUES (56,'Czech Republic','CZ','CZE',1);
INSERT INTO countries VALUES (57,'Denmark','DK','DNK',1);
INSERT INTO countries VALUES (58,'Djibouti','DJ','DJI',1);
INSERT INTO countries VALUES (59,'Dominica','DM','DMA',1);
INSERT INTO countries VALUES (60,'Dominican Republic','DO','DOM',1);
INSERT INTO countries VALUES (61,'East Timor','TP','TMP',1);
INSERT INTO countries VALUES (62,'Ecuador','EC','ECU',1);
INSERT INTO countries VALUES (63,'Egypt','EG','EGY',1);
INSERT INTO countries VALUES (64,'El Salvador','SV','SLV',1);
INSERT INTO countries VALUES (65,'Equatorial Guinea','GQ','GNQ',1);
INSERT INTO countries VALUES (66,'Eritrea','ER','ERI',1);
INSERT INTO countries VALUES (67,'Estonia','EE','EST',1);
INSERT INTO countries VALUES (68,'Ethiopia','ET','ETH',1);
INSERT INTO countries VALUES (69,'Falkland Islands (Malvinas)','FK','FLK',1);
INSERT INTO countries VALUES (70,'Faroe Islands','FO','FRO',1);
INSERT INTO countries VALUES (71,'Fiji','FJ','FJI',1);
INSERT INTO countries VALUES (72,'Finland','FI','FIN',1);
INSERT INTO countries VALUES (73,'France','FR','FRA',1);
INSERT INTO countries VALUES (74,'France, Metropolitan','FX','FXX',1);
INSERT INTO countries VALUES (75,'French Guiana','GF','GUF',1);
INSERT INTO countries VALUES (76,'French Polynesia','PF','PYF',1);
INSERT INTO countries VALUES (77,'French Southern Territories','TF','ATF',1);
INSERT INTO countries VALUES (78,'Gabon','GA','GAB',1);
INSERT INTO countries VALUES (79,'Gambia','GM','GMB',1);
INSERT INTO countries VALUES (80,'Georgia','GE','GEO',1);
INSERT INTO countries VALUES (81,'Germany','DE','DEU',5);
INSERT INTO countries VALUES (82,'Ghana','GH','GHA',1);
INSERT INTO countries VALUES (83,'Gibraltar','GI','GIB',1);
INSERT INTO countries VALUES (84,'Greece','GR','GRC',1);
INSERT INTO countries VALUES (85,'Greenland','GL','GRL',1);
INSERT INTO countries VALUES (86,'Grenada','GD','GRD',1);
INSERT INTO countries VALUES (87,'Guadeloupe','GP','GLP',1);
INSERT INTO countries VALUES (88,'Guam','GU','GUM',1);
INSERT INTO countries VALUES (89,'Guatemala','GT','GTM',1);
INSERT INTO countries VALUES (90,'Guinea','GN','GIN',1);
INSERT INTO countries VALUES (91,'Guinea-bissau','GW','GNB',1);
INSERT INTO countries VALUES (92,'Guyana','GY','GUY',1);
INSERT INTO countries VALUES (93,'Haiti','HT','HTI',1);
INSERT INTO countries VALUES (94,'Heard and Mc Donald Islands','HM','HMD',1);
INSERT INTO countries VALUES (95,'Honduras','HN','HND',1);
INSERT INTO countries VALUES (96,'Hong Kong','HK','HKG',1);
INSERT INTO countries VALUES (97,'Hungary','HU','HUN',1);
INSERT INTO countries VALUES (98,'Iceland','IS','ISL',1);
INSERT INTO countries VALUES (99,'India','IN','IND',1);
INSERT INTO countries VALUES (100,'Indonesia','ID','IDN',1);
INSERT INTO countries VALUES (101,'Iran (Islamic Republic of)','IR','IRN',1);
INSERT INTO countries VALUES (102,'Iraq','IQ','IRQ',1);
INSERT INTO countries VALUES (103,'Ireland','IE','IRL',1);
INSERT INTO countries VALUES (104,'Israel','IL','ISR',1);
INSERT INTO countries VALUES (105,'Italy','IT','ITA',1);
INSERT INTO countries VALUES (106,'Jamaica','JM','JAM',1);
INSERT INTO countries VALUES (107,'Japan','JP','JPN',6);
INSERT INTO countries VALUES (108,'Jordan','JO','JOR',1);
INSERT INTO countries VALUES (109,'Kazakhstan','KZ','KAZ',1);
INSERT INTO countries VALUES (110,'Kenya','KE','KEN',1);
INSERT INTO countries VALUES (111,'Kiribati','KI','KIR',1);
INSERT INTO countries VALUES (112,'Korea, Democratic People\'s Republic of','KP','PRK',1);
INSERT INTO countries VALUES (113,'Korea, Republic of','KR','KOR',1);
INSERT INTO countries VALUES (114,'Kuwait','KW','KWT',1);
INSERT INTO countries VALUES (115,'Kyrgyzstan','KG','KGZ',1);
INSERT INTO countries VALUES (116,'Lao People\'s Democratic Republic','LA','LAO',1);
INSERT INTO countries VALUES (117,'Latvia','LV','LVA',1);
INSERT INTO countries VALUES (118,'Lebanon','LB','LBN',1);
INSERT INTO countries VALUES (119,'Lesotho','LS','LSO',1);
INSERT INTO countries VALUES (120,'Liberia','LR','LBR',1);
INSERT INTO countries VALUES (121,'Libyan Arab Jamahiriya','LY','LBY',1);
INSERT INTO countries VALUES (122,'Liechtenstein','LI','LIE',1);
INSERT INTO countries VALUES (123,'Lithuania','LT','LTU',1);
INSERT INTO countries VALUES (124,'Luxembourg','LU','LUX',1);
INSERT INTO countries VALUES (125,'Macau','MO','MAC',1);
INSERT INTO countries VALUES (126,'Macedonia, The Former Yugoslav Republic of','MK','MKD',1);
INSERT INTO countries VALUES (127,'Madagascar','MG','MDG',1);
INSERT INTO countries VALUES (128,'Malawi','MW','MWI',1);
INSERT INTO countries VALUES (129,'Malaysia','MY','MYS',1);
INSERT INTO countries VALUES (130,'Maldives','MV','MDV',1);
INSERT INTO countries VALUES (131,'Mali','ML','MLI',1);
INSERT INTO countries VALUES (132,'Malta','MT','MLT',1);
INSERT INTO countries VALUES (133,'Marshall Islands','MH','MHL',1);
INSERT INTO countries VALUES (134,'Martinique','MQ','MTQ',1);
INSERT INTO countries VALUES (135,'Mauritania','MR','MRT',1);
INSERT INTO countries VALUES (136,'Mauritius','MU','MUS',1);
INSERT INTO countries VALUES (137,'Mayotte','YT','MYT',1);
INSERT INTO countries VALUES (138,'Mexico','MX','MEX',1);
INSERT INTO countries VALUES (139,'Micronesia, Federated States of','FM','FSM',1);
INSERT INTO countries VALUES (140,'Moldova, Republic of','MD','MDA',1);
INSERT INTO countries VALUES (141,'Monaco','MC','MCO',1);
INSERT INTO countries VALUES (142,'Mongolia','MN','MNG',1);
INSERT INTO countries VALUES (143,'Montserrat','MS','MSR',1);
INSERT INTO countries VALUES (144,'Morocco','MA','MAR',1);
INSERT INTO countries VALUES (145,'Mozambique','MZ','MOZ',1);
INSERT INTO countries VALUES (146,'Myanmar','MM','MMR',1);
INSERT INTO countries VALUES (147,'Namibia','NA','NAM',1);
INSERT INTO countries VALUES (148,'Nauru','NR','NRU',1);
INSERT INTO countries VALUES (149,'Nepal','NP','NPL',1);
INSERT INTO countries VALUES (150,'Netherlands','NL','NLD',1);
INSERT INTO countries VALUES (151,'Netherlands Antilles','AN','ANT',1);
INSERT INTO countries VALUES (152,'New Caledonia','NC','NCL',1);
INSERT INTO countries VALUES (153,'New Zealand','NZ','NZL',1);
INSERT INTO countries VALUES (154,'Nicaragua','NI','NIC',1);
INSERT INTO countries VALUES (155,'Niger','NE','NER',1);
INSERT INTO countries VALUES (156,'Nigeria','NG','NGA',1);
INSERT INTO countries VALUES (157,'Niue','NU','NIU',1);
INSERT INTO countries VALUES (158,'Norfolk Island','NF','NFK',1);
INSERT INTO countries VALUES (159,'Northern Mariana Islands','MP','MNP',1);
INSERT INTO countries VALUES (160,'Norway','NO','NOR',1);
INSERT INTO countries VALUES (161,'Oman','OM','OMN',1);
INSERT INTO countries VALUES (162,'Pakistan','PK','PAK',1);
INSERT INTO countries VALUES (163,'Palau','PW','PLW',1);
INSERT INTO countries VALUES (164,'Panama','PA','PAN',1);
INSERT INTO countries VALUES (165,'Papua New Guinea','PG','PNG',1);
INSERT INTO countries VALUES (166,'Paraguay','PY','PRY',1);
INSERT INTO countries VALUES (167,'Peru','PE','PER',1);
INSERT INTO countries VALUES (168,'Philippines','PH','PHL',1);
INSERT INTO countries VALUES (169,'Pitcairn','PN','PCN',1);
INSERT INTO countries VALUES (170,'Poland','PL','POL',1);
INSERT INTO countries VALUES (171,'Portugal','PT','PRT',1);
INSERT INTO countries VALUES (172,'Puerto Rico','PR','PRI',1);
INSERT INTO countries VALUES (173,'Qatar','QA','QAT',1);
INSERT INTO countries VALUES (174,'Reunion','RE','REU',1);
INSERT INTO countries VALUES (175,'Romania','RO','ROM',1);
INSERT INTO countries VALUES (176,'Russian Federation','RU','RUS',1);
INSERT INTO countries VALUES (177,'Rwanda','RW','RWA',1);
INSERT INTO countries VALUES (178,'Saint Kitts and Nevis','KN','KNA',1);
INSERT INTO countries VALUES (179,'Saint Lucia','LC','LCA',1);
INSERT INTO countries VALUES (180,'Saint Vincent and the Grenadines','VC','VCT',1);
INSERT INTO countries VALUES (181,'Samoa','WS','WSM',1);
INSERT INTO countries VALUES (182,'San Marino','SM','SMR',1);
INSERT INTO countries VALUES (183,'Sao Tome and Principe','ST','STP',1);
INSERT INTO countries VALUES (184,'Saudi Arabia','SA','SAU',1);
INSERT INTO countries VALUES (185,'Senegal','SN','SEN',1);
INSERT INTO countries VALUES (186,'Seychelles','SC','SYC',1);
INSERT INTO countries VALUES (187,'Sierra Leone','SL','SLE',1);
INSERT INTO countries VALUES (188,'Singapore','SG','SGP',4);
INSERT INTO countries VALUES (189,'Slovakia (Slovak Republic)','SK','SVK',1);
INSERT INTO countries VALUES (190,'Slovenia','SI','SVN',1);
INSERT INTO countries VALUES (191,'Solomon Islands','SB','SLB',1);
INSERT INTO countries VALUES (192,'Somalia','SO','SOM',1);
INSERT INTO countries VALUES (193,'South Africa','ZA','ZAF',1);
INSERT INTO countries VALUES (194,'South Georgia and the South Sandwich Islands','GS','SGS',1);
INSERT INTO countries VALUES (195,'Spain','ES','ESP',3);
INSERT INTO countries VALUES (196,'Sri Lanka','LK','LKA',1);
INSERT INTO countries VALUES (197,'St. Helena','SH','SHN',1);
INSERT INTO countries VALUES (198,'St. Pierre and Miquelon','PM','SPM',1);
INSERT INTO countries VALUES (199,'Sudan','SD','SDN',1);
INSERT INTO countries VALUES (200,'Suriname','SR','SUR',1);
INSERT INTO countries VALUES (201,'Svalbard and Jan Mayen Islands','SJ','SJM',1);
INSERT INTO countries VALUES (202,'Swaziland','SZ','SWZ',1);
INSERT INTO countries VALUES (203,'Sweden','SE','SWE',1);
INSERT INTO countries VALUES (204,'Switzerland','CH','CHE',1);
INSERT INTO countries VALUES (205,'Syrian Arab Republic','SY','SYR',1);
INSERT INTO countries VALUES (206,'Taiwan','TW','TWN',1);
INSERT INTO countries VALUES (207,'Tajikistan','TJ','TJK',1);
INSERT INTO countries VALUES (208,'Tanzania, United Republic of','TZ','TZA',1);
INSERT INTO countries VALUES (209,'Thailand','TH','THA',1);
INSERT INTO countries VALUES (210,'Togo','TG','TGO',1);
INSERT INTO countries VALUES (211,'Tokelau','TK','TKL',1);
INSERT INTO countries VALUES (212,'Tonga','TO','TON',1);
INSERT INTO countries VALUES (213,'Trinidad and Tobago','TT','TTO',1);
INSERT INTO countries VALUES (214,'Tunisia','TN','TUN',1);
INSERT INTO countries VALUES (215,'Turkey','TR','TUR',1);
INSERT INTO countries VALUES (216,'Turkmenistan','TM','TKM',1);
INSERT INTO countries VALUES (217,'Turks and Caicos Islands','TC','TCA',1);
INSERT INTO countries VALUES (218,'Tuvalu','TV','TUV',1);
INSERT INTO countries VALUES (219,'Uganda','UG','UGA',1);
INSERT INTO countries VALUES (220,'Ukraine','UA','UKR',1);
INSERT INTO countries VALUES (221,'United Arab Emirates','AE','ARE',1);
INSERT INTO countries VALUES (222,'United Kingdom','GB','GBR',1);
INSERT INTO countries VALUES (223,'United States','US','USA',2);
INSERT INTO countries VALUES (224,'United States Minor Outlying Islands','UM','UMI',1);
INSERT INTO countries VALUES (225,'Uruguay','UY','URY',1);
INSERT INTO countries VALUES (226,'Uzbekistan','UZ','UZB',1);
INSERT INTO countries VALUES (227,'Vanuatu','VU','VUT',1);
INSERT INTO countries VALUES (228,'Vatican City State (Holy See)','VA','VAT',1);
INSERT INTO countries VALUES (229,'Venezuela','VE','VEN',1);
INSERT INTO countries VALUES (230,'Viet Nam','VN','VNM',1);
INSERT INTO countries VALUES (231,'Virgin Islands (British)','VG','VGB',1);
INSERT INTO countries VALUES (232,'Virgin Islands (U.S.)','VI','VIR',1);
INSERT INTO countries VALUES (233,'Wallis and Futuna Islands','WF','WLF',1);
INSERT INTO countries VALUES (234,'Western Sahara','EH','ESH',1);
INSERT INTO countries VALUES (235,'Yemen','YE','YEM',1);
INSERT INTO countries VALUES (236,'Yugoslavia','YU','YUG',1);
INSERT INTO countries VALUES (237,'Zaire','ZR','ZAR',1);
INSERT INTO countries VALUES (238,'Zambia','ZM','ZMB',1);
INSERT INTO countries VALUES (239,'Zimbabwe','ZW','ZWE',1);

--
-- Table structure for table coupon_email_track
--

DROP TABLE IF EXISTS coupon_email_track;
CREATE TABLE coupon_email_track (
unique_id int(11) NOT NULL auto_increment,
coupon_id int(11) NOT NULL default '0',
customer_id_sent int(11) NOT NULL default '0',
sent_firstname varchar(32) default NULL,
sent_lastname varchar(32) default NULL,
emailed_to varchar(32) default NULL,
date_sent datetime NOT NULL default '0001-01-01 00:00:00',
PRIMARY KEY  (unique_id),
KEY idx_coupon_id_zen (coupon_id)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=ujis;

--
-- Dumping data for table coupon_email_track
--


--
-- Table structure for table coupon_gv_customer
--

DROP TABLE IF EXISTS coupon_gv_customer;
CREATE TABLE coupon_gv_customer (
customer_id int(5) NOT NULL default '0',
amount decimal(20,4) NOT NULL default '0.0000',
PRIMARY KEY  (customer_id)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table coupon_gv_customer
--


--
-- Table structure for table coupon_gv_queue
--

DROP TABLE IF EXISTS coupon_gv_queue;
CREATE TABLE coupon_gv_queue (
unique_id int(5) NOT NULL auto_increment,
customer_id int(5) NOT NULL default '0',
order_id int(5) NOT NULL default '0',
amount decimal(20,4) NOT NULL default '0.0000',
date_created datetime NOT NULL default '0001-01-01 00:00:00',
ipaddr varchar(32) NOT NULL default '',
release_flag char(1) NOT NULL default 'N',
PRIMARY KEY  (unique_id),
KEY idx_cust_id_order_id_zen (customer_id,order_id),
KEY idx_release_flag_zen (release_flag)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table coupon_gv_queue
--


--
-- Table structure for table coupon_redeem_track
--

DROP TABLE IF EXISTS coupon_redeem_track;
CREATE TABLE coupon_redeem_track (
unique_id int(11) NOT NULL auto_increment,
coupon_id int(11) NOT NULL default '0',
customer_id int(11) NOT NULL default '0',
redeem_date datetime NOT NULL default '0001-01-01 00:00:00',
redeem_ip varchar(32) NOT NULL default '',
order_id int(11) NOT NULL default '0',
PRIMARY KEY  (unique_id),
KEY idx_coupon_id_zen (coupon_id)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=ujis;

--
-- Dumping data for table coupon_redeem_track
--


--
-- Table structure for table coupon_restrict
--

DROP TABLE IF EXISTS coupon_restrict;
CREATE TABLE coupon_restrict (
restrict_id int(11) NOT NULL auto_increment,
coupon_id int(11) NOT NULL default '0',
product_id int(11) NOT NULL default '0',
category_id int(11) NOT NULL default '0',
coupon_restrict char(1) NOT NULL default 'N',
PRIMARY KEY  (restrict_id),
KEY idx_coup_id_prod_id_zen (coupon_id,product_id)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table coupon_restrict
--


--
-- Table structure for table coupons
--

DROP TABLE IF EXISTS coupons;
CREATE TABLE coupons (
coupon_id int(11) NOT NULL auto_increment,
coupon_type char(1) NOT NULL default 'F',
coupon_code varchar(32) NOT NULL default '',
coupon_amount decimal(8,4) NOT NULL default '0.0000',
coupon_minimum_order decimal(8,4) NOT NULL default '0.0000',
coupon_start_date datetime NOT NULL default '0001-01-01 00:00:00',
coupon_expire_date datetime NOT NULL default '0001-01-01 00:00:00',
uses_per_coupon int(5) NOT NULL default '1',
uses_per_user int(5) NOT NULL default '0',
restrict_to_products varchar(255) default NULL,
restrict_to_categories varchar(255) default NULL,
restrict_to_customers text,
coupon_active char(1) NOT NULL default 'Y',
date_created datetime NOT NULL default '0001-01-01 00:00:00',
date_modified datetime NOT NULL default '0001-01-01 00:00:00',
PRIMARY KEY  (coupon_id),
KEY idx_active_type_zen (coupon_active,coupon_type),
KEY idx_coupon_code_zen (coupon_code),
KEY idx_coupon_type_zen (coupon_type)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=ujis;

--
-- Dumping data for table coupons
--


--
-- Table structure for table coupons_description
--

DROP TABLE IF EXISTS coupons_description;
CREATE TABLE coupons_description (
coupon_id int(11) NOT NULL default '0',
language_id int(11) NOT NULL default '0',
coupon_name varchar(32) NOT NULL default '',
coupon_description text,
PRIMARY KEY  (coupon_id,language_id)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table coupons_description
--


--
-- Table structure for table csv_columns
--

DROP TABLE IF EXISTS csv_columns;
CREATE TABLE csv_columns (
csv_column_id int(11) NOT NULL auto_increment,
csv_format_type_id int(11) default NULL,
csv_column_name varchar(255) default NULL,
csv_column_validate_function text,
csv_columns_dbtable varchar(255) default NULL,
csv_columns_dbcolumn varchar(255) default NULL,
PRIMARY KEY  (csv_column_id)
) ENGINE=MyISAM AUTO_INCREMENT=3115 DEFAULT CHARSET=ujis;

--
-- Dumping data for table csv_columns
--


--
-- Table structure for table csv_format_columns
--

DROP TABLE IF EXISTS csv_format_columns;
CREATE TABLE csv_format_columns (
csv_format_column_id int(11) NOT NULL auto_increment,
csv_format_id int(11) default NULL,
csv_column_id int(11) default NULL,
csv_format_column_number int(11) default NULL,
PRIMARY KEY  (csv_format_column_id),
KEY idx_csv_format_columns_zen (csv_format_id,csv_format_column_number,csv_column_id)
) ENGINE=MyISAM AUTO_INCREMENT=96 DEFAULT CHARSET=ujis;

--
-- Dumping data for table csv_format_columns
--


--
-- Table structure for table csv_format_types
--

DROP TABLE IF EXISTS csv_format_types;
CREATE TABLE csv_format_types (
csv_format_type_id int(11) NOT NULL auto_increment,
csv_format_type_name varchar(255) default NULL,
PRIMARY KEY  (csv_format_type_id)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=ujis;

--
-- Dumping data for table csv_format_types
--


--
-- Table structure for table csv_formats
--

DROP TABLE IF EXISTS csv_formats;
CREATE TABLE csv_formats (
csv_format_id int(11) NOT NULL auto_increment,
csv_format_type_id int(11) default NULL,
csv_format_name varchar(255) default NULL,
csv_format_date_added datetime default NULL,
csv_format_last_modified datetime default NULL,
PRIMARY KEY  (csv_format_id),
KEY idx_format_name_zen (csv_format_name)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=ujis;

--
-- Dumping data for table csv_formats
--


--
-- Table structure for table currencies
--

DROP TABLE IF EXISTS currencies;
CREATE TABLE currencies (
currencies_id int(11) NOT NULL auto_increment,
title varchar(32) NOT NULL default '',
code varchar(3) NOT NULL default '',
symbol_left varchar(24) default NULL,
symbol_right varchar(24) default NULL,
decimal_point char(1) default NULL,
thousands_point char(1) default NULL,
decimal_places char(1) default NULL,
value float(13,8) default NULL,
last_updated datetime default NULL,
PRIMARY KEY  (currencies_id)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=ujis;

--
-- Dumping data for table currencies
--

INSERT INTO currencies VALUES (1,'US Dollar','USD','$','','.',',','2',0.00936500,'2009-11-19 12:39:40');
INSERT INTO currencies VALUES (2,'Euro','EUR','','EUR','.',',','2',0.00759400,'2009-11-19 12:39:40');
INSERT INTO currencies VALUES (3,'Japanese Yen','JPY','','円','.',',','',1.00000000,'2009-11-19 12:39:40');

--
-- Table structure for table currencies_m17n
--

DROP TABLE IF EXISTS currencies_m17n;
CREATE TABLE currencies_m17n (
currencies_id int(11) NOT NULL default '0',
language_id int(11) NOT NULL default '0',
symbol_left varchar(24) default NULL,
symbol_right varchar(24) default NULL,
PRIMARY KEY  (currencies_id,language_id)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table currencies_m17n
--


--
-- Table structure for table customers
--

DROP TABLE IF EXISTS customers;
CREATE TABLE customers (
customers_id int(11) NOT NULL auto_increment,
customers_gender char(1) NOT NULL default '',
customers_firstname varchar(32) NOT NULL default '',
customers_lastname varchar(32) NOT NULL default '',
customers_dob datetime NOT NULL default '0001-01-01 00:00:00',
customers_email_address varchar(96) NOT NULL default '',
customers_nick varchar(96) NOT NULL default '',
customers_default_address_id int(11) NOT NULL default '0',
customers_telephone varchar(32) default NULL,
customers_fax varchar(32) default NULL,
customers_password varchar(40) NOT NULL default '',
customers_newsletter char(1) default NULL,
customers_group_pricing int(11) NOT NULL default '0',
customers_email_format varchar(4) NOT NULL default 'TEXT',
customers_authorization int(1) NOT NULL default '0',
customers_referral varchar(32) NOT NULL default '',
customers_firstname_kana varchar(32) NOT NULL default '',
customers_lastname_kana varchar(32) NOT NULL default '',
customers_mobile_serial_number varchar(64) default NULL,
customers_languages_id int(11) NOT NULL default '0',
PRIMARY KEY  (customers_id),
KEY idx_email_address_zen (customers_email_address),
KEY idx_referral_zen (customers_referral(10)),
KEY idx_grp_pricing_zen (customers_group_pricing),
KEY idx_nick_zen (customers_nick),
KEY idx_newsletter_zen (customers_newsletter)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=ujis;

--
-- Dumping data for table customers
--


--
-- Table structure for table customers_admin_notes
--

DROP TABLE IF EXISTS customers_admin_notes;
CREATE TABLE customers_admin_notes (
admin_notes_id int(12) NOT NULL auto_increment,
customers_id int(11) NOT NULL default '0',
date_added datetime NOT NULL default '0000-00-00 00:00:00',
admin_id int(11) NOT NULL default '0',
admin_notes text NOT NULL,
rating tinyint(1) NOT NULL default '0',
PRIMARY KEY  (admin_notes_id),
KEY customers_id (customers_id)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table customers_admin_notes
--


--
-- Table structure for table customers_basket
--

DROP TABLE IF EXISTS customers_basket;
CREATE TABLE customers_basket (
customers_basket_id int(11) NOT NULL auto_increment,
customers_id int(11) NOT NULL default '0',
products_id tinytext NOT NULL,
customers_basket_quantity float NOT NULL default '0',
final_price decimal(15,4) NOT NULL default '0.0000',
customers_basket_date_added varchar(8) default NULL,
PRIMARY KEY  (customers_basket_id),
KEY idx_customers_id_zen (customers_id)
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=ujis;

--
-- Dumping data for table customers_basket
--


--
-- Table structure for table customers_basket_attributes
--

DROP TABLE IF EXISTS customers_basket_attributes;
CREATE TABLE customers_basket_attributes (
customers_basket_attributes_id int(11) NOT NULL auto_increment,
customers_id int(11) NOT NULL default '0',
products_id tinytext NOT NULL,
products_options_id varchar(64) NOT NULL default '0',
products_options_value_id int(11) NOT NULL default '0',
products_options_value_text blob,
products_options_sort_order text NOT NULL,
PRIMARY KEY  (customers_basket_attributes_id),
KEY idx_cust_id_prod_id_zen (customers_id,products_id(36))
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=ujis;

--
-- Dumping data for table customers_basket_attributes
--


--
-- Table structure for table customers_info
--

DROP TABLE IF EXISTS customers_info;
CREATE TABLE customers_info (
customers_info_id int(11) NOT NULL default '0',
customers_info_date_of_last_logon datetime default NULL,
customers_info_number_of_logons int(5) default NULL,
customers_info_date_account_created datetime default NULL,
customers_info_date_account_last_modified datetime default NULL,
global_product_notifications int(1) default '0',
PRIMARY KEY  (customers_info_id)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table customers_info
--


--
-- Table structure for table customers_point_rate
--

DROP TABLE IF EXISTS customers_point_rate;
CREATE TABLE customers_point_rate (
customers_id int(11) NOT NULL default '0',
rate int(11) NOT NULL default '0',
PRIMARY KEY  (customers_id)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table customers_point_rate
--


--
-- Table structure for table customers_points
--

DROP TABLE IF EXISTS customers_points;
CREATE TABLE customers_points (
customers_id int(11) NOT NULL default '0',
deposit int(11) NOT NULL default '0',
pending int(11) NOT NULL default '0',
updated_at datetime default NULL,
PRIMARY KEY  (customers_id)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table customers_points
--


--
-- Table structure for table customers_wishlist
--

DROP TABLE IF EXISTS customers_wishlist;
CREATE TABLE customers_wishlist (
products_id int(13) NOT NULL default '0',
customers_id int(13) NOT NULL default '0',
products_model varchar(13) default NULL,
products_name varchar(64) NOT NULL default '',
products_price decimal(8,2) NOT NULL default '0.00',
final_price decimal(8,2) NOT NULL default '0.00',
products_quantity int(2) NOT NULL default '0',
wishlist_name varchar(64) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table customers_wishlist
--


--
-- Table structure for table db_cache
--

DROP TABLE IF EXISTS db_cache;
CREATE TABLE db_cache (
cache_entry_name varchar(64) NOT NULL default '',
cache_data blob,
cache_entry_created int(15) default NULL,
PRIMARY KEY  (cache_entry_name)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table db_cache
--


--
-- Table structure for table easy_admin_sub_menus
--

DROP TABLE IF EXISTS easy_admin_sub_menus;
CREATE TABLE easy_admin_sub_menus (
easy_admin_sub_menu_id int(11) NOT NULL auto_increment,
easy_admin_top_menu_id int(11) default NULL,
easy_admin_sub_menu_name varchar(255) default NULL,
easy_admin_sub_menu_url varchar(255) default NULL,
easy_admin_sub_menu_sort_order int(11) default NULL,
PRIMARY KEY  (easy_admin_sub_menu_id)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=ujis;

--
-- Dumping data for table easy_admin_sub_menus
--


--
-- Table structure for table easy_admin_top_menus
--

DROP TABLE IF EXISTS easy_admin_top_menus;
CREATE TABLE easy_admin_top_menus (
easy_admin_top_menu_id int(11) NOT NULL auto_increment,
easy_admin_top_menu_name varchar(255) default NULL,
is_dropdown int(1) default NULL,
easy_admin_top_menu_sort_order int(11) default NULL,
PRIMARY KEY  (easy_admin_top_menu_id)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=ujis;

--
-- Dumping data for table easy_admin_top_menus
--


--
-- Table structure for table easy_design_colors
--

DROP TABLE IF EXISTS easy_design_colors;
CREATE TABLE easy_design_colors (
easy_design_color_id int(11) NOT NULL auto_increment,
template_dir varchar(255) default NULL,
easy_design_color_key varchar(255) default NULL,
easy_design_color_name text,
easy_design_color_value text,
PRIMARY KEY  (easy_design_color_id),
KEY template_dir (template_dir),
KEY easy_design_color_key (easy_design_color_key)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=ujis;

--
-- Dumping data for table easy_design_colors
--


--
-- Table structure for table easy_design_languages
--

DROP TABLE IF EXISTS easy_design_languages;
CREATE TABLE easy_design_languages (
easy_design_language_id int(11) NOT NULL auto_increment,
language_id int(11) default NULL,
easy_design_language_key varchar(255) default NULL,
easy_design_language_name text,
easy_design_language_value text,
easy_design_language_sort_order int(11) default NULL,
PRIMARY KEY  (easy_design_language_id),
KEY easy_design_language_key (easy_design_language_key)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=ujis;

--
-- Dumping data for table easy_design_languages
--


--
-- Table structure for table email_archive
--

DROP TABLE IF EXISTS email_archive;
CREATE TABLE email_archive (
archive_id int(11) NOT NULL auto_increment,
email_to_name varchar(96) NOT NULL default '',
email_to_address varchar(96) NOT NULL default '',
email_from_name varchar(96) NOT NULL default '',
email_from_address varchar(96) NOT NULL default '',
email_subject varchar(255) NOT NULL default '',
email_html text NOT NULL,
email_text text NOT NULL,
date_sent datetime NOT NULL default '0001-01-01 00:00:00',
module varchar(64) NOT NULL default '',
PRIMARY KEY  (archive_id),
KEY idx_email_to_address_zen (email_to_address),
KEY idx_module_zen (module)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table email_archive
--


--
-- Table structure for table email_templates
--

DROP TABLE IF EXISTS email_templates;
CREATE TABLE email_templates (
id smallint(6) NOT NULL auto_increment,
grp varchar(50) NOT NULL default '',
title varchar(255) NOT NULL default '',
PRIMARY KEY  (id)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=ujis;

--
-- Dumping data for table email_templates
--

INSERT INTO email_templates VALUES (1,'ユーザー登録','ユーザー登録ありがとうございます');
INSERT INTO email_templates VALUES (2,'注文完了','ご注文ありがとうございます[会員用]');
INSERT INTO email_templates VALUES (3,'注文完了','ご注文ありがとうございます[ゲスト用]');
INSERT INTO email_templates VALUES (4,'ユーザ通知','ステータス変更');

--
-- Table structure for table email_templates_description
--

DROP TABLE IF EXISTS email_templates_description;
CREATE TABLE email_templates_description (
email_templates_id smallint(6) NOT NULL default '0',
language_id int(11) NOT NULL default '0',
subject varchar(255) NOT NULL default '',
contents text NOT NULL,
updated datetime NOT NULL default '0000-00-00 00:00:00',
PRIMARY KEY  (email_templates_id,language_id)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table email_templates_description
--

INSERT INTO email_templates_description VALUES (1,2,'ユーザー登録ありがとうございます','ユーザー登録ありがとうございます\r\n\r\nこれからもよろしくお願いします。','2010-06-27 12:52:56');
INSERT INTO email_templates_description VALUES (1,1,'Thank you for membership registration','Thank you for membership registration','2010-06-27 04:29:58');
INSERT INTO email_templates_description VALUES (2,2,'ご注文ありがとうございます[会員用]','注文確認書 from XXXXXXXX\r\n\r\n[CUSTOMER_NAME] 様\r\n\r\nご利用ありがとうございます。\r\nご注文内容は以下の通りです。\r\n------------------------------------------------------\r\nご注文番号: [ORDER_ID]\r\nご注文日: [DATE_ORDERED]\r\n請求明細書:\r\n[INVOICE_URL]\r\n\r\n[COMMENT]\r\n\r\n商品\r\n------------------------------------------------------\r\n[PRODUCTS_ORDERED]\r\n------------------------------------------------------\r\n[TOTALS]\r\n\r\nお届け先\r\n------------------------------------------------------\r\n[DELIVERY_ADDRESS]\r\n\r\n請求先住所\r\n------------------------------------------------------\r\n[BILLING_ADDRESS]\r\n\r\nお支払い方法\r\n------------------------------------------------------\r\n[PAYMENT_METHOD]\r\n\r\n\r\n-----\r\nこのメールは当ショップに登録されたお客様に対してお送りしています。\r\nお心当たりが無いようでしたら大変お手数ですがメールにて\r\nxxxxxxx@example.org までご連絡ください。\r\n\r\n-----\r\nCopyright (c) XXXXXXXX Inc. All Rights Reserved','2010-06-27 12:52:25');
INSERT INTO email_templates_description VALUES (2,1,'Thank you for the order[member]','OrderConfirmation from XXXXXXXX\r\n\r\n[CUSTOMER_NAME]\r\n\r\nOrderNumber: [ORDER_ID]\r\nOrderDate: [DATE_ORDERED]\r\nInvoice:\r\n[INVOICE_URL]\r\n\r\n[COMMENT]\r\n\r\nProducts\r\n------------------------------------------------------\r\n[PRODUCTS_ORDERED]\r\n------------------------------------------------------\r\n[TOTALS]\r\n\r\nShipping\r\n------------------------------------------------------\r\n[DELIVERY_ADDRESS]\r\n\r\nInvoiceAddress\r\n------------------------------------------------------\r\n[BILLING_ADDRESS]\r\n\r\nPayment\r\n------------------------------------------------------\r\n[PAYMENT_METHOD]\r\n\r\n\r\n-----\r\nThis E-mail is sent to the customer registered in this shop.\r\nVery sorry to trouble you, but with mail when there is no mind hit\r\nxxxxxxx@example.org\r\n\r\n-----\r\nCopyright (c) XXXXXXXX Inc. All Rights Reserved','2010-06-27 04:29:58');
INSERT INTO email_templates_description VALUES (3,2,'ご注文ありがとうございます[ゲスト用]','注文確認書 from XXXXXXXX\r\n\r\n[CUSTOMER_NAME] 様\r\n\r\nご利用ありがとうございます。\r\nご注文内容は以下の通りです。\r\n------------------------------------------------------\r\nご注文番号: [ORDER_ID]\r\nご注文日: [DATE_ORDERED]\r\n\r\n[COMMENT]\r\n\r\n商品\r\n------------------------------------------------------\r\n[PRODUCTS_ORDERED]\r\n------------------------------------------------------\r\n[TOTALS]\r\n\r\nお届け先\r\n------------------------------------------------------\r\n[DELIVERY_ADDRESS]\r\n\r\n請求先住所\r\n------------------------------------------------------\r\n[BILLING_ADDRESS]\r\n\r\nお支払い方法\r\n------------------------------------------------------\r\n[PAYMENT_METHOD]\r\n\r\n\r\n-----\r\nこのメールは当ショップに登録されたお客様に対してお送りしています。\r\nお心当たりが無いようでしたら大変お手数ですがメールにて\r\nxxxxxxx@example.org までご連絡ください。\r\n\r\n-----\r\nCopyright (c) XXXXXXXX Inc. All Rights Reserved','2010-06-27 04:31:58');
INSERT INTO email_templates_description VALUES (3,1,'Thank you for the order[guest]','OrderConfirmation from XXXXXXXX\r\n\r\n[CUSTOMER_NAME]\r\n\r\nOrderNumber: [ORDER_ID]\r\nOrderDate: [DATE_ORDERED]\r\nInvoice:\r\n[INVOICE_URL]\r\n\r\n[COMMENT]\r\n\r\nProducts\r\n------------------------------------------------------\r\n[PRODUCTS_ORDERED]\r\n------------------------------------------------------\r\n[TOTALS]\r\n\r\nShipping\r\n------------------------------------------------------\r\n[DELIVERY_ADDRESS]\r\n\r\nInvoiceAddress\r\n------------------------------------------------------\r\n[BILLING_ADDRESS]\r\n\r\nPayment\r\n------------------------------------------------------\r\n[PAYMENT_METHOD]\r\n\r\n\r\n-----\r\nThis E-mail is sent to the customer registered in this shop.\r\nVery sorry to trouble you, but with mail when there is no mind hit\r\nxxxxxxx@example.org\r\n\r\n-----\r\nCopyright (c) XXXXXXXX Inc. All Rights Reserved','2010-06-27 04:29:58');
INSERT INTO email_templates_description VALUES (4,2,'ご注文受付状況のお知らせ','[CUSTOMER_NAME]様\r\n\r\nご利用ありがとうございます。\r\n[DATE_ORDERED]にご利用いただいた\r\nご注文受付番号：[ORDER_ID]の状況が変更されましたのでお知らせします。\r\n\r\nご注文についての情報は下記URLでご覧いただけます。\r\n[INVOICE_URL]\r\n\r\nよろしくお願いします。\r\n\r\n-----\r\nこのメールは当ショップに登録されたお客様に対してお送りしています。\r\nお心当たりが無いようでしたら大変お手数ですがメールにて\r\nxxxxxxx@example.org までご連絡ください。\r\n\r\n-----\r\nCopyright (c) XXXXXXXX Inc. All Rights Reserved','2010-07-20 16:35:51');
INSERT INTO email_templates_description VALUES (4,1,'Information of order situation','MODULE_EMAIL_TEMPLATE_STATUS_MAIL_BODY_EN\', \'\r\n[CUSTOMER_NAME]様\r\n\r\nThank you for use\r\n[DATE_ORDERED]\r\nOrder receipt number：[ORDER_ID]\r\n\r\nYou can see ordering information\r\n[INVOICE_URL]\r\n\r\n-----\r\nThis E-mail is sent to the customer registered in this shop.\r\nVery sorry to trouble you, but with mail when there is no mind hit\r\nxxxxxxx@example.org\r\n\r\n-----\r\nCopyright (c) XXXXXXXX Inc. All Rights Reserved','2010-06-27 04:29:58');
INSERT INTO email_templates_description VALUES (1,9,'[携帯版]ユーザー登録完了','ユーザー登録ありがとうございます。','2010-06-27 12:52:56');
INSERT INTO email_templates_description VALUES (2,9,'[携帯]注文完了','[CUSTOMER_NAME] 様\r\n\r\nご利用ありがとうございます。\r\nご注文内容は以下の通りです。\r\n\r\nご注文番号: [ORDER_ID]\r\nご注文日: [DATE_ORDERED]\r\n\r\n詳しくはこちら。\r\n[INVOICE_URL]','2010-06-27 12:52:25');
INSERT INTO email_templates_description VALUES (3,9,'ご注文ありがとうございます[ゲスト用]','注文確認書 from XXXXXXXX\r\n\r\n[CUSTOMER_NAME] 様\r\n\r\nご利用ありがとうございます。\r\nご注文内容は以下の通りです。\r\n------------------------------------------------------\r\nご注文番号: [ORDER_ID]\r\nご注文日: [DATE_ORDERED]\r\n\r\n[COMMENT]\r\n\r\n商品\r\n------------------------------------------------------\r\n[PRODUCTS_ORDERED]\r\n------------------------------------------------------\r\n[TOTALS]\r\n\r\nお届け先\r\n------------------------------------------------------\r\n[DELIVERY_ADDRESS]\r\n\r\n請求先住所\r\n------------------------------------------------------\r\n[BILLING_ADDRESS]\r\n\r\nお支払い方法\r\n------------------------------------------------------\r\n[PAYMENT_METHOD]\r\n\r\n\r\n-----\r\nこのメールは当ショップに登録されたお客様に対してお送りしています。\r\nお心当たりが無いようでしたら大変お手数ですがメールにて\r\nxxxxxxx@example.org までご連絡ください。\r\n\r\n-----\r\nCopyright (c) XXXXXXXX Inc. All Rights Reserved','0000-00-00 00:00:00');
INSERT INTO email_templates_description VALUES (4,9,'[携帯版]ご注文受付状況更新','[CUSTOMER_NAME]様\r\n\r\nご利用ありがとうございます。\r\n[DATE_ORDERED]にご利用いただいた\r\nご注文受付番号：[ORDER_ID]の状況が変更されましたのでお知らせします。\r\n\r\nご注文についての情報は下記URLでご覧いただけます。\r\n[INVOICE_URL]\r\n\r\nよろしくお願いします。','2010-07-20 16:35:51');

--
-- Table structure for table ezpages
--

DROP TABLE IF EXISTS ezpages;
CREATE TABLE ezpages (
pages_id int(11) NOT NULL auto_increment,
languages_id int(11) NOT NULL default '1',
pages_title varchar(64) NOT NULL default '',
alt_url varchar(255) NOT NULL default '',
alt_url_external varchar(255) NOT NULL default '',
pages_html_text text,
status_header int(1) NOT NULL default '1',
status_sidebox int(1) NOT NULL default '1',
status_footer int(1) NOT NULL default '1',
status_toc int(1) NOT NULL default '1',
header_sort_order int(3) NOT NULL default '0',
sidebox_sort_order int(3) NOT NULL default '0',
footer_sort_order int(3) NOT NULL default '0',
toc_sort_order int(3) NOT NULL default '0',
page_open_new_window int(1) NOT NULL default '0',
page_is_ssl int(1) NOT NULL default '0',
toc_chapter int(11) NOT NULL default '0',
PRIMARY KEY  (pages_id),
KEY idx_lang_id_zen (languages_id),
KEY idx_ezp_status_header_zen (status_header),
KEY idx_ezp_status_sidebox_zen (status_sidebox),
KEY idx_ezp_status_footer_zen (status_footer),
KEY idx_ezp_status_toc_zen (status_toc)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=ujis;

--
-- Dumping data for table ezpages
--


--
-- Table structure for table feature_area
--

DROP TABLE IF EXISTS feature_area;
CREATE TABLE feature_area (
id int(11) NOT NULL auto_increment,
main_image varchar(64) default NULL,
thumb_image varchar(64) default NULL,
link_url varchar(255) default NULL,
sort_order varchar(255) default NULL,
date_added datetime default NULL,
last_modified datetime default NULL,
status tinyint(1) default NULL,
new_window tinyint(1) default NULL,
PRIMARY KEY  (id),
KEY idx_status_zen (status),
KEY idx_sort_order_zen (sort_order)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table feature_area
--


--
-- Table structure for table feature_area_info
--

DROP TABLE IF EXISTS feature_area_info;
CREATE TABLE feature_area_info (
id int(11) NOT NULL auto_increment,
languages_id int(11) NOT NULL default '0',
name varchar(255) default NULL,
url_clicked int(11) default NULL,
date_last_click datetime default NULL,
PRIMARY KEY  (id,languages_id),
KEY idx_categories_name_zen (name)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table feature_area_info
--


--
-- Table structure for table featured
--

DROP TABLE IF EXISTS featured;
CREATE TABLE featured (
featured_id int(11) NOT NULL auto_increment,
products_id int(11) NOT NULL default '0',
featured_date_added datetime default NULL,
featured_last_modified datetime default NULL,
expires_date date NOT NULL default '0001-01-01',
date_status_change datetime default NULL,
status int(1) NOT NULL default '1',
featured_date_available date NOT NULL default '0001-01-01',
PRIMARY KEY  (featured_id),
KEY idx_status_zen (status),
KEY idx_products_id_zen (products_id),
KEY idx_date_avail_zen (featured_date_available)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=ujis;

--
-- Dumping data for table featured
--


--
-- Table structure for table files_uploaded
--

DROP TABLE IF EXISTS files_uploaded;
CREATE TABLE files_uploaded (
files_uploaded_id int(11) NOT NULL auto_increment,
sesskey varchar(32) default NULL,
customers_id int(11) default NULL,
files_uploaded_name varchar(64) NOT NULL default '',
PRIMARY KEY  (files_uploaded_id),
KEY idx_customers_id_zen (customers_id)
) ENGINE=MyISAM DEFAULT CHARSET=ujis COMMENT='Must always have either a sesskey or customers_id';

--
-- Dumping data for table files_uploaded
--


--
-- Table structure for table geo_zones
--

DROP TABLE IF EXISTS geo_zones;
CREATE TABLE geo_zones (
geo_zone_id int(11) NOT NULL auto_increment,
geo_zone_name varchar(32) NOT NULL default '',
geo_zone_description varchar(255) NOT NULL default '',
last_modified datetime default NULL,
date_added datetime NOT NULL default '0001-01-01 00:00:00',
PRIMARY KEY  (geo_zone_id)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=ujis;

--
-- Dumping data for table geo_zones
--

INSERT INTO geo_zones VALUES (1,'日本','日本（消費税）','2007-01-15 11:44:41','2006-11-29 16:18:40');

--
-- Table structure for table get_terms_to_filter
--

DROP TABLE IF EXISTS get_terms_to_filter;
CREATE TABLE get_terms_to_filter (
get_term_name varchar(255) NOT NULL default '',
PRIMARY KEY  (get_term_name)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table get_terms_to_filter
--

INSERT INTO get_terms_to_filter VALUES ('manufacturers_id');
INSERT INTO get_terms_to_filter VALUES ('music_genre_id');
INSERT INTO get_terms_to_filter VALUES ('record_company_id');

--
-- Table structure for table group_point_rate
--

DROP TABLE IF EXISTS group_point_rate;
CREATE TABLE group_point_rate (
group_id int(11) NOT NULL default '0',
rate int(11) NOT NULL default '0',
PRIMARY KEY  (group_id)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table group_point_rate
--


--
-- Table structure for table group_pricing
--

DROP TABLE IF EXISTS group_pricing;
CREATE TABLE group_pricing (
group_id int(11) NOT NULL auto_increment,
group_name varchar(32) NOT NULL default '',
group_percentage decimal(5,2) NOT NULL default '0.00',
last_modified datetime default NULL,
date_added datetime NOT NULL default '0001-01-01 00:00:00',
PRIMARY KEY  (group_id)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=ujis;

--
-- Dumping data for table group_pricing
--


--
-- Table structure for table group_pricing_m17n
--

DROP TABLE IF EXISTS group_pricing_m17n;
CREATE TABLE group_pricing_m17n (
group_id int(11) NOT NULL default '0',
language_id int(11) NOT NULL default '0',
group_name varchar(32) NOT NULL default '',
PRIMARY KEY  (group_id,language_id)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table group_pricing_m17n
--


--
-- Table structure for table holidays
--

DROP TABLE IF EXISTS holidays;
CREATE TABLE holidays (
id int(11) NOT NULL auto_increment,
year int(11) default NULL,
month int(11) default NULL,
day int(11) default NULL,
week int(11) default NULL,
weekcnt int(11) default NULL,
open int(11) default NULL,
PRIMARY KEY  (id)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=ujis;

--
-- Dumping data for table holidays
--


--
-- Table structure for table languages
--

DROP TABLE IF EXISTS languages;
CREATE TABLE languages (
languages_id int(11) NOT NULL auto_increment,
name varchar(32) NOT NULL default '',
code varchar(20) NOT NULL default '',
image varchar(64) default NULL,
directory varchar(32) default NULL,
sort_order int(3) default NULL,
PRIMARY KEY  (languages_id),
KEY idx_languages_name_zen (name)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=ujis;

--
-- Dumping data for table languages
--

INSERT INTO languages VALUES (1,'English','en','icon.gif','english',1);
INSERT INTO languages VALUES (2,'Japanese','ja','icon.gif','japanese',1);
INSERT INTO languages VALUES (9,'Japanese(mobile)','ja-mobile','icon.gif','japanese',1);

--
-- Table structure for table layout_boxes
--

DROP TABLE IF EXISTS layout_boxes;
CREATE TABLE layout_boxes (
layout_id int(11) NOT NULL auto_increment,
layout_template varchar(64) NOT NULL default '',
layout_box_name varchar(64) NOT NULL default '',
layout_box_status tinyint(1) NOT NULL default '0',
layout_box_location tinyint(1) NOT NULL default '0',
layout_box_sort_order int(11) NOT NULL default '0',
layout_box_sort_order_single int(11) NOT NULL default '0',
layout_box_status_single tinyint(4) NOT NULL default '0',
layout_page varchar(64) default '',
PRIMARY KEY  (layout_id),
KEY idx_name_template_zen (layout_template,layout_box_name),
KEY idx_layout_box_status_zen (layout_box_status)
) ENGINE=MyISAM AUTO_INCREMENT=1237 DEFAULT CHARSET=ujis;

--
-- Dumping data for table layout_boxes
--

INSERT INTO layout_boxes VALUES (1,'default_template_settings','banner_box_all.php',1,1,5,0,0,'');
INSERT INTO layout_boxes VALUES (2,'default_template_settings','banner_box.php',1,0,300,1,127,'');
INSERT INTO layout_boxes VALUES (3,'default_template_settings','banner_box2.php',1,1,15,1,15,'');
INSERT INTO layout_boxes VALUES (4,'default_template_settings','best_sellers.php',1,1,30,70,1,'');
INSERT INTO layout_boxes VALUES (5,'default_template_settings','categories.php',1,0,10,10,1,'');
INSERT INTO layout_boxes VALUES (6,'default_template_settings','currencies.php',1,1,80,60,1,'');
INSERT INTO layout_boxes VALUES (7,'default_template_settings','document_categories.php',1,0,0,0,0,'');
INSERT INTO layout_boxes VALUES (8,'default_template_settings','ezpages.php',1,1,-1,2,1,'');
INSERT INTO layout_boxes VALUES (9,'default_template_settings','featured.php',1,0,45,0,0,'');
INSERT INTO layout_boxes VALUES (10,'default_template_settings','information.php',1,0,50,40,1,'');
INSERT INTO layout_boxes VALUES (11,'default_template_settings','languages.php',1,1,70,50,1,'');
INSERT INTO layout_boxes VALUES (12,'default_template_settings','manufacturers.php',1,0,30,20,1,'');
INSERT INTO layout_boxes VALUES (13,'default_template_settings','manufacturer_info.php',1,1,35,95,1,'');
INSERT INTO layout_boxes VALUES (14,'default_template_settings','more_information.php',1,0,200,200,1,'');
INSERT INTO layout_boxes VALUES (15,'default_template_settings','music_genres.php',1,1,0,0,0,'');
INSERT INTO layout_boxes VALUES (16,'default_template_settings','order_history.php',0,0,0,0,0,'');
INSERT INTO layout_boxes VALUES (17,'default_template_settings','product_notifications.php',1,1,55,85,1,'');
INSERT INTO layout_boxes VALUES (18,'default_template_settings','record_companies.php',1,1,0,0,0,'');
INSERT INTO layout_boxes VALUES (19,'default_template_settings','reviews.php',1,0,40,0,0,'');
INSERT INTO layout_boxes VALUES (20,'default_template_settings','search.php',1,1,10,0,0,'');
INSERT INTO layout_boxes VALUES (21,'default_template_settings','search_header.php',0,0,0,0,1,'');
INSERT INTO layout_boxes VALUES (22,'default_template_settings','shopping_cart.php',1,1,20,30,1,'');
INSERT INTO layout_boxes VALUES (23,'default_template_settings','specials.php',1,1,45,0,0,'');
INSERT INTO layout_boxes VALUES (24,'default_template_settings','tell_a_friend.php',1,1,65,0,0,'');
INSERT INTO layout_boxes VALUES (25,'default_template_settings','whats_new.php',1,0,20,0,0,'');
INSERT INTO layout_boxes VALUES (26,'default_template_settings','whos_online.php',1,1,200,200,1,'');
INSERT INTO layout_boxes VALUES (27,'template_default','banner_box_all.php',1,1,5,0,0,'');
INSERT INTO layout_boxes VALUES (28,'template_default','banner_box.php',1,0,300,1,127,'');
INSERT INTO layout_boxes VALUES (29,'template_default','banner_box2.php',1,1,15,1,15,'');
INSERT INTO layout_boxes VALUES (30,'template_default','best_sellers.php',1,1,30,70,1,'');
INSERT INTO layout_boxes VALUES (31,'template_default','categories.php',1,0,10,10,1,'');
INSERT INTO layout_boxes VALUES (32,'template_default','currencies.php',1,1,80,60,1,'');
INSERT INTO layout_boxes VALUES (33,'template_default','ezpages.php',1,1,-1,2,1,'');
INSERT INTO layout_boxes VALUES (34,'template_default','featured.php',1,0,45,0,0,'');
INSERT INTO layout_boxes VALUES (35,'template_default','information.php',1,0,50,40,1,'');
INSERT INTO layout_boxes VALUES (36,'template_default','languages.php',1,1,70,50,1,'');
INSERT INTO layout_boxes VALUES (37,'template_default','manufacturers.php',1,0,30,20,1,'');
INSERT INTO layout_boxes VALUES (38,'template_default','manufacturer_info.php',1,1,35,95,1,'');
INSERT INTO layout_boxes VALUES (39,'template_default','more_information.php',1,0,200,200,1,'');
INSERT INTO layout_boxes VALUES (40,'template_default','my_broken_box.php',1,0,0,0,0,'');
INSERT INTO layout_boxes VALUES (41,'template_default','order_history.php',0,0,0,0,0,'');
INSERT INTO layout_boxes VALUES (42,'template_default','product_notifications.php',1,1,55,85,1,'');
INSERT INTO layout_boxes VALUES (43,'template_default','reviews.php',1,0,40,0,0,'');
INSERT INTO layout_boxes VALUES (44,'template_default','search.php',1,1,10,0,0,'');
INSERT INTO layout_boxes VALUES (45,'template_default','search_header.php',0,0,0,0,1,'');
INSERT INTO layout_boxes VALUES (46,'template_default','shopping_cart.php',1,1,20,30,1,'');
INSERT INTO layout_boxes VALUES (47,'template_default','specials.php',1,1,45,0,0,'');
INSERT INTO layout_boxes VALUES (48,'template_default','tell_a_friend.php',1,1,65,0,0,'');
INSERT INTO layout_boxes VALUES (49,'template_default','whats_new.php',1,0,20,0,0,'');
INSERT INTO layout_boxes VALUES (50,'template_default','whos_online.php',1,1,200,200,1,'');
INSERT INTO layout_boxes VALUES (51,'classic','banner_box.php',1,0,300,1,127,'');
INSERT INTO layout_boxes VALUES (52,'classic','banner_box2.php',1,1,15,1,15,'');
INSERT INTO layout_boxes VALUES (53,'classic','banner_box_all.php',1,1,5,0,0,'');
INSERT INTO layout_boxes VALUES (54,'classic','best_sellers.php',1,1,30,70,1,'');
INSERT INTO layout_boxes VALUES (55,'classic','categories.php',1,0,10,10,1,'');
INSERT INTO layout_boxes VALUES (56,'classic','currencies.php',1,1,80,60,1,'');
INSERT INTO layout_boxes VALUES (57,'classic','document_categories.php',1,0,0,0,0,'');
INSERT INTO layout_boxes VALUES (58,'classic','ezpages.php',1,1,-1,2,1,'');
INSERT INTO layout_boxes VALUES (59,'classic','featured.php',1,0,45,0,0,'');
INSERT INTO layout_boxes VALUES (60,'classic','information.php',1,0,50,40,1,'');
INSERT INTO layout_boxes VALUES (61,'classic','languages.php',1,1,70,50,1,'');
INSERT INTO layout_boxes VALUES (62,'classic','manufacturers.php',1,0,30,20,1,'');
INSERT INTO layout_boxes VALUES (63,'classic','manufacturer_info.php',1,1,35,95,1,'');
INSERT INTO layout_boxes VALUES (64,'classic','more_information.php',1,0,200,200,1,'');
INSERT INTO layout_boxes VALUES (65,'classic','music_genres.php',1,1,0,0,0,'');
INSERT INTO layout_boxes VALUES (66,'classic','order_history.php',0,0,0,0,0,'');
INSERT INTO layout_boxes VALUES (67,'classic','product_notifications.php',1,1,55,85,1,'');
INSERT INTO layout_boxes VALUES (68,'classic','record_companies.php',1,1,0,0,0,'');
INSERT INTO layout_boxes VALUES (69,'classic','reviews.php',1,0,40,0,0,'');
INSERT INTO layout_boxes VALUES (70,'classic','search.php',1,1,10,0,0,'');
INSERT INTO layout_boxes VALUES (71,'classic','search_header.php',0,0,0,0,1,'');
INSERT INTO layout_boxes VALUES (72,'classic','shopping_cart.php',1,1,20,30,1,'');
INSERT INTO layout_boxes VALUES (73,'classic','specials.php',1,1,45,0,0,'');
INSERT INTO layout_boxes VALUES (74,'classic','tell_a_friend.php',1,1,65,0,0,'');
INSERT INTO layout_boxes VALUES (75,'classic','whats_new.php',1,0,20,0,0,'');
INSERT INTO layout_boxes VALUES (76,'classic','whos_online.php',1,1,200,200,1,'');
INSERT INTO layout_boxes VALUES (77,'sugudeki','banner_box.php',0,0,0,0,0,'');
INSERT INTO layout_boxes VALUES (78,'sugudeki','banner_box2.php',0,0,0,0,0,'');
INSERT INTO layout_boxes VALUES (79,'sugudeki','banner_box_all.php',0,0,0,0,0,'');
INSERT INTO layout_boxes VALUES (80,'sugudeki','best_sellers.php',0,0,0,0,0,'');
INSERT INTO layout_boxes VALUES (81,'sugudeki','categories.php',0,0,0,0,0,'');
INSERT INTO layout_boxes VALUES (82,'sugudeki','currencies.php',0,0,0,0,0,'');
INSERT INTO layout_boxes VALUES (83,'sugudeki','document_categories.php',0,0,0,0,0,'');
INSERT INTO layout_boxes VALUES (84,'sugudeki','ezpages.php',0,0,0,0,0,'');
INSERT INTO layout_boxes VALUES (85,'sugudeki','featured.php',0,0,0,0,0,'');
INSERT INTO layout_boxes VALUES (86,'sugudeki','information.php',0,0,0,0,0,'');
INSERT INTO layout_boxes VALUES (87,'sugudeki','languages.php',0,0,0,0,0,'');
INSERT INTO layout_boxes VALUES (88,'sugudeki','manufacturer_info.php',0,0,0,0,0,'');
INSERT INTO layout_boxes VALUES (89,'sugudeki','manufacturers.php',0,0,0,0,0,'');
INSERT INTO layout_boxes VALUES (90,'sugudeki','more_information.php',0,0,0,0,0,'');
INSERT INTO layout_boxes VALUES (91,'sugudeki','music_genres.php',0,0,0,0,0,'');
INSERT INTO layout_boxes VALUES (92,'sugudeki','order_history.php',0,0,0,0,0,'');
INSERT INTO layout_boxes VALUES (93,'sugudeki','product_notifications.php',0,0,0,0,0,'');
INSERT INTO layout_boxes VALUES (94,'sugudeki','record_companies.php',0,0,0,0,0,'');
INSERT INTO layout_boxes VALUES (95,'sugudeki','reviews.php',0,0,0,0,0,'');
INSERT INTO layout_boxes VALUES (96,'sugudeki','search.php',0,0,0,0,0,'');
INSERT INTO layout_boxes VALUES (97,'sugudeki','search_header.php',0,0,0,0,0,'');
INSERT INTO layout_boxes VALUES (98,'sugudeki','shopping_cart.php',0,1,0,0,0,'');
INSERT INTO layout_boxes VALUES (99,'sugudeki','specials.php',0,0,0,0,0,'');
INSERT INTO layout_boxes VALUES (100,'sugudeki','tell_a_friend.php',0,0,0,0,0,'');
INSERT INTO layout_boxes VALUES (101,'sugudeki','whats_new.php',0,0,0,0,0,'');
INSERT INTO layout_boxes VALUES (102,'sugudeki','whos_online.php',0,0,0,0,0,'');
INSERT INTO layout_boxes VALUES (1236,'zen_mobile','whos_online.php',0,1,200,200,1,'shopping_cart');
INSERT INTO layout_boxes VALUES (1235,'zen_mobile','whos_online.php',0,1,200,200,1,'product_list');
INSERT INTO layout_boxes VALUES (1234,'zen_mobile','whos_online.php',0,1,200,200,1,'product_info');
INSERT INTO layout_boxes VALUES (1233,'zen_mobile','whos_online.php',0,1,200,200,1,'index');
INSERT INTO layout_boxes VALUES (1232,'zen_mobile','whos_online.php',0,1,200,200,1,'');
INSERT INTO layout_boxes VALUES (1231,'zen_mobile','whos_online.php',0,0,0,0,0,'mypage');
INSERT INTO layout_boxes VALUES (1230,'zen_mobile','whats_new.php',0,0,20,0,0,'shopping_cart');
INSERT INTO layout_boxes VALUES (1229,'zen_mobile','whats_new.php',0,0,20,0,0,'product_list');
INSERT INTO layout_boxes VALUES (1228,'zen_mobile','whats_new.php',0,0,20,0,0,'product_info');
INSERT INTO layout_boxes VALUES (1227,'zen_mobile','whats_new.php',0,0,20,0,0,'index');
INSERT INTO layout_boxes VALUES (1225,'zen_mobile','whats_new.php',0,0,0,0,0,'mypage');
INSERT INTO layout_boxes VALUES (1226,'zen_mobile','whats_new.php',0,0,20,0,0,'');
INSERT INTO layout_boxes VALUES (1224,'zen_mobile','tell_a_friend.php',0,1,65,0,0,'shopping_cart');
INSERT INTO layout_boxes VALUES (1223,'zen_mobile','tell_a_friend.php',0,1,65,0,0,'product_list');
INSERT INTO layout_boxes VALUES (1222,'zen_mobile','tell_a_friend.php',0,1,65,0,0,'product_info');
INSERT INTO layout_boxes VALUES (1221,'zen_mobile','tell_a_friend.php',0,1,65,0,0,'index');
INSERT INTO layout_boxes VALUES (1220,'zen_mobile','tell_a_friend.php',0,1,65,0,0,'');
INSERT INTO layout_boxes VALUES (1219,'zen_mobile','tell_a_friend.php',0,0,0,0,0,'mypage');
INSERT INTO layout_boxes VALUES (1218,'zen_mobile','specials.php',0,1,9,0,0,'shopping_cart');
INSERT INTO layout_boxes VALUES (1217,'zen_mobile','specials.php',0,1,45,0,0,'product_list');
INSERT INTO layout_boxes VALUES (1215,'zen_mobile','specials.php',0,1,45,0,0,'index');
INSERT INTO layout_boxes VALUES (1216,'zen_mobile','specials.php',0,1,45,0,0,'product_info');
INSERT INTO layout_boxes VALUES (1214,'zen_mobile','specials.php',0,1,45,0,0,'');
INSERT INTO layout_boxes VALUES (1213,'zen_mobile','specials.php',0,0,0,0,0,'mypage');
INSERT INTO layout_boxes VALUES (1210,'zen_mobile','shopping_cart.php',0,1,20,30,1,'product_info');
INSERT INTO layout_boxes VALUES (1212,'zen_mobile','shopping_cart.php',0,1,20,30,1,'shopping_cart');
INSERT INTO layout_boxes VALUES (1211,'zen_mobile','shopping_cart.php',0,1,20,30,1,'product_list');
INSERT INTO layout_boxes VALUES (1209,'zen_mobile','shopping_cart.php',0,1,20,30,1,'index');
INSERT INTO layout_boxes VALUES (1208,'zen_mobile','shopping_cart.php',0,1,20,30,1,'');
INSERT INTO layout_boxes VALUES (1207,'zen_mobile','shopping_cart.php',0,0,0,0,0,'mypage');
INSERT INTO layout_boxes VALUES (1206,'zen_mobile','search_header.php',0,1,7,0,1,'shopping_cart');
INSERT INTO layout_boxes VALUES (1205,'zen_mobile','search_header.php',0,0,0,0,1,'product_list');
INSERT INTO layout_boxes VALUES (1200,'zen_mobile','search.php',1,1,5,0,0,'index');
INSERT INTO layout_boxes VALUES (1201,'zen_mobile','search_header.php',0,0,0,0,0,'index');
INSERT INTO layout_boxes VALUES (1202,'zen_mobile','search_header.php',0,0,0,0,0,'mypage');
INSERT INTO layout_boxes VALUES (1203,'zen_mobile','search_header.php',0,0,0,0,1,'');
INSERT INTO layout_boxes VALUES (1204,'zen_mobile','search_header.php',0,0,0,0,1,'product_info');
INSERT INTO layout_boxes VALUES (1199,'zen_mobile','search.php',1,1,11,0,0,'product_list');
INSERT INTO layout_boxes VALUES (1198,'zen_mobile','search.php',0,1,20,0,0,'shopping_cart');
INSERT INTO layout_boxes VALUES (1197,'zen_mobile','search.php',0,1,10,0,0,'product_info');
INSERT INTO layout_boxes VALUES (1196,'zen_mobile','search.php',0,1,10,0,0,'');
INSERT INTO layout_boxes VALUES (1195,'zen_mobile','search.php',0,0,0,0,0,'mypage');
INSERT INTO layout_boxes VALUES (1194,'zen_mobile','reviews.php',0,0,40,0,0,'shopping_cart');
INSERT INTO layout_boxes VALUES (1193,'zen_mobile','reviews.php',0,0,40,0,0,'product_list');
INSERT INTO layout_boxes VALUES (1192,'zen_mobile','reviews.php',0,0,40,0,0,'product_info');
INSERT INTO layout_boxes VALUES (1191,'zen_mobile','reviews.php',0,0,40,0,0,'index');
INSERT INTO layout_boxes VALUES (1190,'zen_mobile','reviews.php',0,0,40,0,0,'');
INSERT INTO layout_boxes VALUES (1189,'zen_mobile','reviews.php',0,0,0,0,0,'mypage');
INSERT INTO layout_boxes VALUES (1187,'zen_mobile','record_companies.php',0,1,0,0,0,'product_list');
INSERT INTO layout_boxes VALUES (1188,'zen_mobile','record_companies.php',0,1,0,0,0,'shopping_cart');
INSERT INTO layout_boxes VALUES (1186,'zen_mobile','record_companies.php',0,1,0,0,0,'product_info');
INSERT INTO layout_boxes VALUES (1185,'zen_mobile','record_companies.php',0,1,0,0,0,'index');
INSERT INTO layout_boxes VALUES (1184,'zen_mobile','record_companies.php',0,1,0,0,0,'');
INSERT INTO layout_boxes VALUES (1183,'zen_mobile','record_companies.php',0,0,0,0,0,'mypage');
INSERT INTO layout_boxes VALUES (1182,'zen_mobile','product_notifications.php',0,1,55,85,1,'shopping_cart');
INSERT INTO layout_boxes VALUES (1179,'zen_mobile','product_notifications.php',0,1,55,85,1,'index');
INSERT INTO layout_boxes VALUES (1180,'zen_mobile','product_notifications.php',0,1,55,85,1,'product_info');
INSERT INTO layout_boxes VALUES (1181,'zen_mobile','product_notifications.php',0,1,55,85,1,'product_list');
INSERT INTO layout_boxes VALUES (1178,'zen_mobile','product_notifications.php',0,1,55,85,1,'');
INSERT INTO layout_boxes VALUES (1177,'zen_mobile','product_notifications.php',0,0,0,0,0,'mypage');
INSERT INTO layout_boxes VALUES (1176,'zen_mobile','order_history.php',0,0,0,0,0,'shopping_cart');
INSERT INTO layout_boxes VALUES (1175,'zen_mobile','order_history.php',0,0,0,0,0,'product_list');
INSERT INTO layout_boxes VALUES (1174,'zen_mobile','order_history.php',0,0,0,0,0,'product_info');
INSERT INTO layout_boxes VALUES (1173,'zen_mobile','order_history.php',0,0,0,0,0,'mypage');
INSERT INTO layout_boxes VALUES (1172,'zen_mobile','order_history.php',0,0,0,0,0,'index');
INSERT INTO layout_boxes VALUES (1171,'zen_mobile','order_history.php',0,0,0,0,0,'');
INSERT INTO layout_boxes VALUES (1169,'zen_mobile','music_genres.php',0,1,0,0,0,'product_list');
INSERT INTO layout_boxes VALUES (1170,'zen_mobile','music_genres.php',0,1,0,0,0,'shopping_cart');
INSERT INTO layout_boxes VALUES (1168,'zen_mobile','music_genres.php',0,1,0,0,0,'product_info');
INSERT INTO layout_boxes VALUES (1167,'zen_mobile','music_genres.php',0,1,0,0,0,'index');
INSERT INTO layout_boxes VALUES (1166,'zen_mobile','music_genres.php',0,1,0,0,0,'');
INSERT INTO layout_boxes VALUES (1165,'zen_mobile','music_genres.php',0,0,0,0,0,'mypage');
INSERT INTO layout_boxes VALUES (1164,'zen_mobile','more_information.php',0,0,200,200,1,'shopping_cart');
INSERT INTO layout_boxes VALUES (1163,'zen_mobile','more_information.php',0,0,200,200,1,'product_list');
INSERT INTO layout_boxes VALUES (1162,'zen_mobile','more_information.php',0,0,200,200,1,'product_info');
INSERT INTO layout_boxes VALUES (1161,'zen_mobile','more_information.php',0,0,200,200,1,'index');
INSERT INTO layout_boxes VALUES (1159,'zen_mobile','more_information.php',0,0,0,0,0,'mypage');
INSERT INTO layout_boxes VALUES (1160,'zen_mobile','more_information.php',0,0,200,200,1,'');
INSERT INTO layout_boxes VALUES (1157,'zen_mobile','manufacturers.php',0,0,30,20,1,'product_list');
INSERT INTO layout_boxes VALUES (1158,'zen_mobile','manufacturers.php',0,0,30,20,1,'shopping_cart');
INSERT INTO layout_boxes VALUES (1155,'zen_mobile','manufacturers.php',0,0,30,20,1,'index');
INSERT INTO layout_boxes VALUES (1156,'zen_mobile','manufacturers.php',0,0,30,20,1,'product_info');
INSERT INTO layout_boxes VALUES (1154,'zen_mobile','manufacturers.php',0,0,30,20,1,'');
INSERT INTO layout_boxes VALUES (1153,'zen_mobile','manufacturers.php',0,0,0,0,0,'mypage');
INSERT INTO layout_boxes VALUES (1152,'zen_mobile','manufacturer_info.php',0,1,35,95,1,'shopping_cart');
INSERT INTO layout_boxes VALUES (1151,'zen_mobile','manufacturer_info.php',0,1,35,95,1,'product_list');
INSERT INTO layout_boxes VALUES (1147,'zen_mobile','manufacturer_info.php',0,0,0,0,0,'mypage');
INSERT INTO layout_boxes VALUES (1150,'zen_mobile','manufacturer_info.php',0,1,35,95,1,'product_info');
INSERT INTO layout_boxes VALUES (1149,'zen_mobile','manufacturer_info.php',0,1,35,95,1,'index');
INSERT INTO layout_boxes VALUES (1148,'zen_mobile','manufacturer_info.php',0,1,35,95,1,'');
INSERT INTO layout_boxes VALUES (1146,'zen_mobile','languages.php',0,1,70,50,1,'shopping_cart');
INSERT INTO layout_boxes VALUES (1145,'zen_mobile','languages.php',0,1,70,50,1,'product_list');
INSERT INTO layout_boxes VALUES (1142,'zen_mobile','languages.php',0,1,70,50,1,'');
INSERT INTO layout_boxes VALUES (1143,'zen_mobile','languages.php',0,1,70,50,1,'index');
INSERT INTO layout_boxes VALUES (1144,'zen_mobile','languages.php',0,1,70,50,1,'product_info');
INSERT INTO layout_boxes VALUES (1141,'zen_mobile','languages.php',0,0,0,0,0,'mypage');
INSERT INTO layout_boxes VALUES (1140,'zen_mobile','information.php',1,1,10,40,1,'index');
INSERT INTO layout_boxes VALUES (1139,'zen_mobile','information.php',0,1,50,40,1,'shopping_cart');
INSERT INTO layout_boxes VALUES (1138,'zen_mobile','information.php',0,1,50,40,1,'product_info');
INSERT INTO layout_boxes VALUES (1137,'zen_mobile','information.php',0,1,50,40,1,'');
INSERT INTO layout_boxes VALUES (1136,'zen_mobile','information.php',0,1,50,40,0,'product_list');
INSERT INTO layout_boxes VALUES (1133,'zen_mobile','featured.php',0,0,45,0,0,'product_list');
INSERT INTO layout_boxes VALUES (1134,'zen_mobile','featured.php',0,0,45,0,0,'shopping_cart');
INSERT INTO layout_boxes VALUES (1135,'zen_mobile','information.php',0,0,0,0,0,'mypage');
INSERT INTO layout_boxes VALUES (1127,'zen_mobile','ezpages.php',0,1,-1,2,1,'product_list');
INSERT INTO layout_boxes VALUES (1128,'zen_mobile','ezpages.php',0,1,-1,2,1,'shopping_cart');
INSERT INTO layout_boxes VALUES (1129,'zen_mobile','featured.php',0,0,0,0,0,'mypage');
INSERT INTO layout_boxes VALUES (1130,'zen_mobile','featured.php',0,0,45,0,0,'');
INSERT INTO layout_boxes VALUES (1131,'zen_mobile','featured.php',0,0,45,0,0,'index');
INSERT INTO layout_boxes VALUES (1132,'zen_mobile','featured.php',0,0,45,0,0,'product_info');
INSERT INTO layout_boxes VALUES (1126,'zen_mobile','ezpages.php',0,1,-1,2,1,'product_info');
INSERT INTO layout_boxes VALUES (1125,'zen_mobile','ezpages.php',0,1,-1,2,1,'index');
INSERT INTO layout_boxes VALUES (1124,'zen_mobile','ezpages.php',0,1,-1,2,1,'');
INSERT INTO layout_boxes VALUES (1123,'zen_mobile','ezpages.php',0,0,0,0,0,'mypage');
INSERT INTO layout_boxes VALUES (1122,'zen_mobile','document_categories.php',0,0,0,0,0,'shopping_cart');
INSERT INTO layout_boxes VALUES (1121,'zen_mobile','document_categories.php',0,0,0,0,0,'product_list');
INSERT INTO layout_boxes VALUES (1120,'zen_mobile','document_categories.php',0,0,0,0,0,'product_info');
INSERT INTO layout_boxes VALUES (1119,'zen_mobile','document_categories.php',0,0,0,0,0,'mypage');
INSERT INTO layout_boxes VALUES (1118,'zen_mobile','document_categories.php',0,0,0,0,0,'index');
INSERT INTO layout_boxes VALUES (1117,'zen_mobile','document_categories.php',0,0,0,0,0,'');
INSERT INTO layout_boxes VALUES (1116,'zen_mobile','currencies.php',0,1,80,60,1,'shopping_cart');
INSERT INTO layout_boxes VALUES (1115,'zen_mobile','currencies.php',0,1,80,60,1,'product_list');
INSERT INTO layout_boxes VALUES (1114,'zen_mobile','currencies.php',0,1,80,60,1,'product_info');
INSERT INTO layout_boxes VALUES (1113,'zen_mobile','currencies.php',0,1,80,60,1,'index');
INSERT INTO layout_boxes VALUES (1112,'zen_mobile','currencies.php',0,1,80,60,1,'');
INSERT INTO layout_boxes VALUES (1111,'zen_mobile','currencies.php',0,0,0,0,0,'mypage');
INSERT INTO layout_boxes VALUES (1110,'zen_mobile','categories.php',1,1,0,10,1,'index');
INSERT INTO layout_boxes VALUES (1108,'zen_mobile','categories.php',0,1,10,10,0,'product_list');
INSERT INTO layout_boxes VALUES (1109,'zen_mobile','categories.php',0,1,10,10,0,'shopping_cart');
INSERT INTO layout_boxes VALUES (1107,'zen_mobile','categories.php',0,1,10,10,0,'product_info');
INSERT INTO layout_boxes VALUES (1105,'zen_mobile','categories.php',0,0,0,0,0,'mypage');
INSERT INTO layout_boxes VALUES (1106,'zen_mobile','categories.php',0,1,10,10,0,'');
INSERT INTO layout_boxes VALUES (1104,'zen_mobile','best_sellers.php',0,1,8,0,1,'shopping_cart');
INSERT INTO layout_boxes VALUES (1103,'zen_mobile','best_sellers.php',0,1,30,70,1,'product_list');
INSERT INTO layout_boxes VALUES (1102,'zen_mobile','best_sellers.php',0,1,30,70,1,'product_info');
INSERT INTO layout_boxes VALUES (1098,'zen_mobile','banner_box_all.php',0,1,5,0,0,'shopping_cart');
INSERT INTO layout_boxes VALUES (1101,'zen_mobile','best_sellers.php',0,1,30,70,1,'index');
INSERT INTO layout_boxes VALUES (1100,'zen_mobile','best_sellers.php',0,1,30,70,1,'');
INSERT INTO layout_boxes VALUES (1099,'zen_mobile','best_sellers.php',0,0,0,0,0,'mypage');
INSERT INTO layout_boxes VALUES (1097,'zen_mobile','banner_box_all.php',0,1,5,0,0,'product_list');
INSERT INTO layout_boxes VALUES (1096,'zen_mobile','banner_box_all.php',0,1,5,0,0,'product_info');
INSERT INTO layout_boxes VALUES (1095,'zen_mobile','banner_box_all.php',0,1,5,0,0,'index');
INSERT INTO layout_boxes VALUES (1094,'zen_mobile','banner_box_all.php',0,1,5,0,0,'');
INSERT INTO layout_boxes VALUES (1091,'zen_mobile','banner_box2.php',0,1,15,1,1,'product_list');
INSERT INTO layout_boxes VALUES (1093,'zen_mobile','banner_box_all.php',0,0,0,0,0,'mypage');
INSERT INTO layout_boxes VALUES (1092,'zen_mobile','banner_box2.php',0,1,15,1,1,'shopping_cart');
INSERT INTO layout_boxes VALUES (1090,'zen_mobile','banner_box2.php',0,1,15,1,1,'product_info');
INSERT INTO layout_boxes VALUES (1089,'zen_mobile','banner_box2.php',0,1,15,1,1,'index');
INSERT INTO layout_boxes VALUES (1088,'zen_mobile','banner_box2.php',0,1,15,1,1,'');
INSERT INTO layout_boxes VALUES (1087,'zen_mobile','banner_box2.php',0,0,0,0,0,'mypage');
INSERT INTO layout_boxes VALUES (1086,'zen_mobile','banner_box.php',0,0,300,1,1,'shopping_cart');
INSERT INTO layout_boxes VALUES (1085,'zen_mobile','banner_box.php',0,0,300,1,1,'product_list');
INSERT INTO layout_boxes VALUES (1084,'zen_mobile','banner_box.php',0,0,300,1,1,'product_info');
INSERT INTO layout_boxes VALUES (1083,'zen_mobile','banner_box.php',0,0,300,1,1,'index');
INSERT INTO layout_boxes VALUES (1082,'zen_mobile','banner_box.php',0,0,300,1,1,'');
INSERT INTO layout_boxes VALUES (1081,'zen_mobile','banner_box.php',0,0,0,0,0,'mypage');
INSERT INTO layout_boxes VALUES (1080,'zen_mobile','account_menu.php',1,1,7,0,0,'index');
INSERT INTO layout_boxes VALUES (1079,'zen_mobile','account_menu.php',1,1,30,0,0,'shopping_cart');
INSERT INTO layout_boxes VALUES (1078,'zen_mobile','account_menu.php',1,1,30,0,0,'product_list');
INSERT INTO layout_boxes VALUES (1077,'zen_mobile','account_menu.php',1,1,0,0,0,'product_info');
INSERT INTO layout_boxes VALUES (1076,'zen_mobile','account_menu.php',1,1,0,0,0,'mypage');
INSERT INTO layout_boxes VALUES (1075,'zen_mobile','account_menu.php',0,0,0,0,0,'');

--
-- Table structure for table manufacturers
--

DROP TABLE IF EXISTS manufacturers;
CREATE TABLE manufacturers (
manufacturers_id int(11) NOT NULL auto_increment,
manufacturers_name varchar(32) NOT NULL default '',
manufacturers_image varchar(64) default NULL,
date_added datetime default NULL,
last_modified datetime default NULL,
PRIMARY KEY  (manufacturers_id),
KEY idx_mfg_name_zen (manufacturers_name)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=ujis;

--
-- Dumping data for table manufacturers
--


--
-- Table structure for table manufacturers_info
--

DROP TABLE IF EXISTS manufacturers_info;
CREATE TABLE manufacturers_info (
manufacturers_id int(11) NOT NULL default '0',
languages_id int(11) NOT NULL default '0',
manufacturers_url varchar(255) NOT NULL default '',
url_clicked int(5) NOT NULL default '0',
date_last_click datetime default NULL,
manufacturers_name varchar(32) NOT NULL default '',
PRIMARY KEY  (manufacturers_id,languages_id)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table manufacturers_info
--


--
-- Table structure for table media_clips
--

DROP TABLE IF EXISTS media_clips;
CREATE TABLE media_clips (
clip_id int(11) NOT NULL auto_increment,
media_id int(11) NOT NULL default '0',
clip_type smallint(6) NOT NULL default '0',
clip_filename text NOT NULL,
date_added datetime NOT NULL default '0001-01-01 00:00:00',
last_modified datetime NOT NULL default '0001-01-01 00:00:00',
PRIMARY KEY  (clip_id),
KEY idx_media_id_zen (media_id)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=ujis;

--
-- Dumping data for table media_clips
--


--
-- Table structure for table media_manager
--

DROP TABLE IF EXISTS media_manager;
CREATE TABLE media_manager (
media_id int(11) NOT NULL auto_increment,
media_name varchar(255) NOT NULL default '',
last_modified datetime NOT NULL default '0001-01-01 00:00:00',
date_added datetime NOT NULL default '0001-01-01 00:00:00',
PRIMARY KEY  (media_id)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=ujis;

--
-- Dumping data for table media_manager
--


--
-- Table structure for table media_to_products
--

DROP TABLE IF EXISTS media_to_products;
CREATE TABLE media_to_products (
media_id int(11) NOT NULL default '0',
product_id int(11) NOT NULL default '0',
KEY idx_media_product_zen (media_id,product_id)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table media_to_products
--


--
-- Table structure for table media_types
--

DROP TABLE IF EXISTS media_types;
CREATE TABLE media_types (
type_id int(11) NOT NULL auto_increment,
type_name varchar(64) NOT NULL default '',
type_ext varchar(8) NOT NULL default '',
PRIMARY KEY  (type_id)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=ujis;

--
-- Dumping data for table media_types
--

INSERT INTO media_types VALUES (1,'MP3','.mp3');

--
-- Table structure for table meta_tags_categories_description
--

DROP TABLE IF EXISTS meta_tags_categories_description;
CREATE TABLE meta_tags_categories_description (
categories_id int(11) NOT NULL auto_increment,
language_id int(11) NOT NULL default '1',
metatags_title varchar(255) NOT NULL default '',
metatags_keywords text,
metatags_description text,
PRIMARY KEY  (categories_id,language_id)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=ujis;

--
-- Dumping data for table meta_tags_categories_description
--


--
-- Table structure for table meta_tags_products_description
--

DROP TABLE IF EXISTS meta_tags_products_description;
CREATE TABLE meta_tags_products_description (
products_id int(11) NOT NULL auto_increment,
language_id int(11) NOT NULL default '1',
metatags_title varchar(255) NOT NULL default '',
metatags_keywords text,
metatags_description text,
PRIMARY KEY  (products_id,language_id)
) ENGINE=MyISAM AUTO_INCREMENT=117 DEFAULT CHARSET=ujis;

--
-- Dumping data for table meta_tags_products_description
--


--
-- Table structure for table music_genre
--

DROP TABLE IF EXISTS music_genre;
CREATE TABLE music_genre (
music_genre_id int(11) NOT NULL auto_increment,
music_genre_name varchar(32) NOT NULL default '',
date_added datetime default NULL,
last_modified datetime default NULL,
PRIMARY KEY  (music_genre_id),
KEY idx_music_genre_name_zen (music_genre_name)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=ujis;

--
-- Dumping data for table music_genre
--


--
-- Table structure for table newsletters
--

DROP TABLE IF EXISTS newsletters;
CREATE TABLE newsletters (
newsletters_id int(11) NOT NULL auto_increment,
title varchar(255) NOT NULL default '',
content text NOT NULL,
content_html text NOT NULL,
module varchar(255) NOT NULL default '',
date_added datetime NOT NULL default '0001-01-01 00:00:00',
date_sent datetime default NULL,
status int(1) default NULL,
locked int(1) default '0',
PRIMARY KEY  (newsletters_id)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=ujis;

--
-- Dumping data for table newsletters
--


--
-- Table structure for table orders
--

DROP TABLE IF EXISTS orders;
CREATE TABLE orders (
orders_id int(11) NOT NULL auto_increment,
customers_id int(11) NOT NULL default '0',
customers_name varchar(64) NOT NULL default '',
customers_company varchar(32) default NULL,
customers_street_address varchar(64) NOT NULL default '',
customers_suburb varchar(32) default NULL,
customers_city varchar(32) NOT NULL default '',
customers_postcode varchar(10) NOT NULL default '',
customers_state varchar(32) default NULL,
customers_country varchar(32) NOT NULL default '',
customers_telephone varchar(32) default NULL,
customers_email_address varchar(96) NOT NULL default '',
customers_address_format_id int(5) NOT NULL default '0',
delivery_name varchar(64) NOT NULL default '',
delivery_company varchar(32) default NULL,
delivery_street_address varchar(64) NOT NULL default '',
delivery_suburb varchar(32) default NULL,
delivery_city varchar(32) NOT NULL default '',
delivery_postcode varchar(10) NOT NULL default '',
delivery_state varchar(32) default NULL,
delivery_country varchar(32) NOT NULL default '',
delivery_address_format_id int(5) NOT NULL default '0',
billing_name varchar(64) NOT NULL default '',
billing_company varchar(32) default NULL,
billing_street_address varchar(64) NOT NULL default '',
billing_suburb varchar(32) default NULL,
billing_city varchar(32) NOT NULL default '',
billing_postcode varchar(10) NOT NULL default '',
billing_state varchar(32) default NULL,
billing_country varchar(32) NOT NULL default '',
billing_address_format_id int(5) NOT NULL default '0',
payment_method varchar(128) NOT NULL default '',
payment_module_code varchar(32) NOT NULL default '',
shipping_method varchar(128) NOT NULL default '',
shipping_module_code varchar(32) NOT NULL default '',
coupon_code varchar(32) NOT NULL default '',
cc_type varchar(20) default NULL,
cc_owner varchar(64) default NULL,
cc_number varchar(32) default NULL,
cc_expires varchar(4) default NULL,
cc_cvv blob,
last_modified datetime default NULL,
date_purchased datetime default NULL,
orders_status int(5) NOT NULL default '0',
orders_date_finished datetime default NULL,
currency varchar(3) default NULL,
currency_value decimal(14,6) default NULL,
order_total decimal(14,2) default NULL,
order_tax decimal(14,2) default NULL,
paypal_ipn_id int(11) NOT NULL default '0',
ip_address varchar(96) NOT NULL default '',
delivery_telephone varchar(32) default NULL,
delivery_fax varchar(32) default NULL,
billing_telephone varchar(32) default NULL,
billing_fax varchar(32) default NULL,
customers_fax varchar(32) default NULL,
customers_name_kana varchar(64) NOT NULL default '',
delivery_name_kana varchar(64) NOT NULL default '',
billing_name_kana varchar(64) NOT NULL default '',
date_completed datetime default NULL,
date_cancelled datetime default NULL,
balance_due decimal(14,2) default NULL,
PRIMARY KEY  (orders_id),
KEY idx_status_orders_cust_zen (orders_status,orders_id,customers_id)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=ujis;

--
-- Dumping data for table orders
--


--
-- Table structure for table orders_products
--

DROP TABLE IF EXISTS orders_products;
CREATE TABLE orders_products (
orders_products_id int(11) NOT NULL auto_increment,
orders_id int(11) NOT NULL default '0',
products_id int(11) NOT NULL default '0',
products_model varchar(32) default NULL,
products_name varchar(64) NOT NULL default '',
products_price decimal(15,4) NOT NULL default '0.0000',
final_price decimal(15,4) NOT NULL default '0.0000',
products_tax decimal(7,4) NOT NULL default '0.0000',
products_quantity float NOT NULL default '0',
onetime_charges decimal(15,4) NOT NULL default '0.0000',
products_priced_by_attribute tinyint(1) NOT NULL default '0',
product_is_free tinyint(1) NOT NULL default '0',
products_discount_type tinyint(1) NOT NULL default '0',
products_discount_type_from tinyint(1) NOT NULL default '0',
products_prid tinytext NOT NULL,
PRIMARY KEY  (orders_products_id),
KEY idx_orders_id_prod_id_zen (orders_id,products_id)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=ujis;

--
-- Dumping data for table orders_products
--


--
-- Table structure for table orders_products_attributes
--

DROP TABLE IF EXISTS orders_products_attributes;
CREATE TABLE orders_products_attributes (
orders_products_attributes_id int(11) NOT NULL auto_increment,
orders_id int(11) NOT NULL default '0',
orders_products_id int(11) NOT NULL default '0',
products_options varchar(32) NOT NULL default '',
products_options_values blob NOT NULL,
options_values_price decimal(15,4) NOT NULL default '0.0000',
price_prefix char(1) NOT NULL default '',
product_attribute_is_free tinyint(1) NOT NULL default '0',
products_attributes_weight float NOT NULL default '0',
products_attributes_weight_prefix char(1) NOT NULL default '',
attributes_discounted tinyint(1) NOT NULL default '1',
attributes_price_base_included tinyint(1) NOT NULL default '1',
attributes_price_onetime decimal(15,4) NOT NULL default '0.0000',
attributes_price_factor decimal(15,4) NOT NULL default '0.0000',
attributes_price_factor_offset decimal(15,4) NOT NULL default '0.0000',
attributes_price_factor_onetime decimal(15,4) NOT NULL default '0.0000',
attributes_price_factor_onetime_offset decimal(15,4) NOT NULL default '0.0000',
attributes_qty_prices text,
attributes_qty_prices_onetime text,
attributes_price_words decimal(15,4) NOT NULL default '0.0000',
attributes_price_words_free int(4) NOT NULL default '0',
attributes_price_letters decimal(15,4) NOT NULL default '0.0000',
attributes_price_letters_free int(4) NOT NULL default '0',
products_options_id int(11) NOT NULL default '0',
products_options_values_id int(11) NOT NULL default '0',
products_prid tinytext NOT NULL,
PRIMARY KEY  (orders_products_attributes_id),
KEY idx_orders_id_prod_id_zen (orders_id,orders_products_id)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=ujis;

--
-- Dumping data for table orders_products_attributes
--


--
-- Table structure for table orders_products_download
--

DROP TABLE IF EXISTS orders_products_download;
CREATE TABLE orders_products_download (
orders_products_download_id int(11) NOT NULL auto_increment,
orders_id int(11) NOT NULL default '0',
orders_products_id int(11) NOT NULL default '0',
orders_products_filename varchar(255) NOT NULL default '',
download_maxdays int(2) NOT NULL default '0',
download_count int(2) NOT NULL default '0',
products_prid tinytext NOT NULL,
PRIMARY KEY  (orders_products_download_id),
KEY idx_orders_id_zen (orders_id),
KEY idx_orders_products_id_zen (orders_products_id)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=ujis;

--
-- Dumping data for table orders_products_download
--


--
-- Table structure for table orders_status
--

DROP TABLE IF EXISTS orders_status;
CREATE TABLE orders_status (
orders_status_id int(11) NOT NULL default '0',
language_id int(11) NOT NULL default '1',
orders_status_name varchar(32) NOT NULL default '',
PRIMARY KEY  (orders_status_id,language_id),
KEY idx_orders_status_name_zen (orders_status_name)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table orders_status
--

INSERT INTO orders_status VALUES (1,1,'Pending');
INSERT INTO orders_status VALUES (2,1,'Processing');
INSERT INTO orders_status VALUES (3,1,'Delivered');
INSERT INTO orders_status VALUES (4,1,'Update');
INSERT INTO orders_status VALUES (1,2,'処理待ち');
INSERT INTO orders_status VALUES (2,2,'処理中');
INSERT INTO orders_status VALUES (3,2,'配送済み');
INSERT INTO orders_status VALUES (4,2,'更新');
INSERT INTO orders_status VALUES (4,9,'更新');
INSERT INTO orders_status VALUES (1,9,'処理待ち');
INSERT INTO orders_status VALUES (3,9,'配送済み');
INSERT INTO orders_status VALUES (2,9,'処理中');

--
-- Table structure for table orders_status_history
--

DROP TABLE IF EXISTS orders_status_history;
CREATE TABLE orders_status_history (
orders_status_history_id int(11) NOT NULL auto_increment,
orders_id int(11) NOT NULL default '0',
orders_status_id int(5) NOT NULL default '0',
date_added datetime NOT NULL default '0001-01-01 00:00:00',
customer_notified int(1) default '0',
comments text,
PRIMARY KEY  (orders_status_history_id),
KEY idx_orders_id_status_id_zen (orders_id,orders_status_id)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=ujis;

--
-- Dumping data for table orders_status_history
--


--
-- Table structure for table orders_total
--

DROP TABLE IF EXISTS orders_total;
CREATE TABLE orders_total (
orders_total_id int(10) unsigned NOT NULL auto_increment,
orders_id int(11) NOT NULL default '0',
title varchar(255) NOT NULL default '',
text varchar(255) NOT NULL default '',
value decimal(15,4) NOT NULL default '0.0000',
class varchar(32) NOT NULL default '',
sort_order int(11) NOT NULL default '0',
PRIMARY KEY  (orders_total_id),
KEY idx_ot_orders_id_zen (orders_id),
KEY idx_ot_class_zen (class)
) ENGINE=MyISAM AUTO_INCREMENT=131 DEFAULT CHARSET=ujis;

--
-- Dumping data for table orders_total
--


--
-- Table structure for table paypal
--

DROP TABLE IF EXISTS paypal;
CREATE TABLE paypal (
paypal_ipn_id int(11) unsigned NOT NULL auto_increment,
zen_order_id int(11) unsigned NOT NULL default '0',
txn_type varchar(10) NOT NULL default '',
reason_code varchar(15) default NULL,
payment_type varchar(7) NOT NULL default '',
payment_status varchar(17) NOT NULL default '',
pending_reason varchar(14) default NULL,
invoice varchar(64) default NULL,
mc_currency varchar(3) NOT NULL default '',
first_name varchar(32) NOT NULL default '',
last_name varchar(32) NOT NULL default '',
payer_business_name varchar(64) default NULL,
address_name varchar(32) default NULL,
address_street varchar(64) default NULL,
address_city varchar(32) default NULL,
address_state varchar(32) default NULL,
address_zip varchar(10) default NULL,
address_country varchar(64) default NULL,
address_status varchar(11) default NULL,
payer_email varchar(96) NOT NULL default '',
payer_id varchar(32) NOT NULL default '',
payer_status varchar(10) NOT NULL default '',
payment_date datetime NOT NULL default '0001-01-01 00:00:00',
business varchar(96) NOT NULL default '',
receiver_email varchar(96) NOT NULL default '',
receiver_id varchar(32) NOT NULL default '',
txn_id varchar(17) NOT NULL default '',
parent_txn_id varchar(17) default NULL,
num_cart_items tinyint(4) unsigned NOT NULL default '1',
mc_gross decimal(7,2) NOT NULL default '0.00',
mc_fee decimal(7,2) NOT NULL default '0.00',
payment_gross decimal(7,2) default NULL,
payment_fee decimal(7,2) default NULL,
settle_amount decimal(7,2) default NULL,
settle_currency varchar(3) default NULL,
exchange_rate decimal(4,2) default NULL,
notify_version decimal(2,1) NOT NULL default '0.0',
verify_sign varchar(128) NOT NULL default '',
last_modified datetime NOT NULL default '0001-01-01 00:00:00',
date_added datetime NOT NULL default '0001-01-01 00:00:00',
memo text,
PRIMARY KEY  (paypal_ipn_id,txn_id),
KEY idx_zen_order_id_zen (zen_order_id)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table paypal
--


--
-- Table structure for table paypal_payment_status
--

DROP TABLE IF EXISTS paypal_payment_status;
CREATE TABLE paypal_payment_status (
payment_status_id int(11) NOT NULL auto_increment,
payment_status_name varchar(64) NOT NULL default '',
PRIMARY KEY  (payment_status_id)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=ujis;

--
-- Dumping data for table paypal_payment_status
--

INSERT INTO paypal_payment_status VALUES (1,'Completed');
INSERT INTO paypal_payment_status VALUES (2,'Pending');
INSERT INTO paypal_payment_status VALUES (3,'Failed');
INSERT INTO paypal_payment_status VALUES (4,'Denied');
INSERT INTO paypal_payment_status VALUES (5,'Refunded');
INSERT INTO paypal_payment_status VALUES (6,'Canceled_Reversal');
INSERT INTO paypal_payment_status VALUES (7,'Reversed');

--
-- Table structure for table paypal_payment_status_history
--

DROP TABLE IF EXISTS paypal_payment_status_history;
CREATE TABLE paypal_payment_status_history (
payment_status_history_id int(11) NOT NULL auto_increment,
paypal_ipn_id int(11) NOT NULL default '0',
txn_id varchar(64) NOT NULL default '',
parent_txn_id varchar(64) NOT NULL default '',
payment_status varchar(17) NOT NULL default '',
pending_reason varchar(14) default NULL,
date_added datetime NOT NULL default '0001-01-01 00:00:00',
PRIMARY KEY  (payment_status_history_id),
KEY idx_paypal_ipn_id_zen (paypal_ipn_id)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table paypal_payment_status_history
--


--
-- Table structure for table paypal_session
--

DROP TABLE IF EXISTS paypal_session;
CREATE TABLE paypal_session (
unique_id int(11) NOT NULL auto_increment,
session_id text NOT NULL,
saved_session blob NOT NULL,
expiry int(17) NOT NULL default '0',
PRIMARY KEY  (unique_id),
KEY idx_session_id_zen (session_id(36))
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table paypal_session
--


--
-- Table structure for table paypal_testing
--

DROP TABLE IF EXISTS paypal_testing;
CREATE TABLE paypal_testing (
paypal_ipn_id int(11) unsigned NOT NULL auto_increment,
zen_order_id int(11) unsigned NOT NULL default '0',
custom varchar(255) NOT NULL default '',
txn_type varchar(10) NOT NULL default '',
reason_code varchar(15) default NULL,
payment_type varchar(7) NOT NULL default '',
payment_status varchar(17) NOT NULL default '',
pending_reason varchar(14) default NULL,
invoice varchar(64) default NULL,
mc_currency varchar(3) NOT NULL default '',
first_name varchar(32) NOT NULL default '',
last_name varchar(32) NOT NULL default '',
payer_business_name varchar(64) default NULL,
address_name varchar(32) default NULL,
address_street varchar(64) default NULL,
address_city varchar(32) default NULL,
address_state varchar(32) default NULL,
address_zip varchar(10) default NULL,
address_country varchar(64) default NULL,
address_status varchar(11) default NULL,
payer_email varchar(96) NOT NULL default '',
payer_id varchar(32) NOT NULL default '',
payer_status varchar(10) NOT NULL default '',
payment_date datetime NOT NULL default '0001-01-01 00:00:00',
business varchar(96) NOT NULL default '',
receiver_email varchar(96) NOT NULL default '',
receiver_id varchar(32) NOT NULL default '',
txn_id varchar(17) NOT NULL default '',
parent_txn_id varchar(17) default NULL,
num_cart_items tinyint(4) unsigned NOT NULL default '1',
mc_gross decimal(7,2) NOT NULL default '0.00',
mc_fee decimal(7,2) NOT NULL default '0.00',
payment_gross decimal(7,2) default NULL,
payment_fee decimal(7,2) default NULL,
settle_amount decimal(7,2) default NULL,
settle_currency varchar(3) default NULL,
exchange_rate decimal(4,2) default NULL,
notify_version decimal(2,1) NOT NULL default '0.0',
verify_sign varchar(128) NOT NULL default '',
last_modified datetime NOT NULL default '0001-01-01 00:00:00',
date_added datetime NOT NULL default '0001-01-01 00:00:00',
memo text,
PRIMARY KEY  (paypal_ipn_id,txn_id),
KEY idx_zen_order_id_zen (zen_order_id)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table paypal_testing
--


--
-- Table structure for table point_histories
--

DROP TABLE IF EXISTS point_histories;
CREATE TABLE point_histories (
id int(11) NOT NULL auto_increment,
customers_id int(11) NOT NULL default '0',
related_id_name varchar(64) NOT NULL default '',
related_id_value int(11) NOT NULL default '0',
deposit int(11) NOT NULL default '0',
withdraw int(11) NOT NULL default '0',
pending int(11) NOT NULL default '0',
description varchar(255) NOT NULL default '',
class varchar(64) NOT NULL default '',
created_at datetime NOT NULL default '0000-00-00 00:00:00',
updated_at datetime default NULL,
status tinyint(1) NOT NULL default '1',
PRIMARY KEY  (id),
KEY IDX_customers_id_status (customers_id,status)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=ujis;

--
-- Dumping data for table point_histories
--


--
-- Table structure for table product_music_extra
--

DROP TABLE IF EXISTS product_music_extra;
CREATE TABLE product_music_extra (
products_id int(11) NOT NULL default '0',
artists_id int(11) NOT NULL default '0',
record_company_id int(11) NOT NULL default '0',
music_genre_id int(11) NOT NULL default '0',
PRIMARY KEY  (products_id),
KEY idx_music_genre_id_zen (music_genre_id)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table product_music_extra
--


--
-- Table structure for table product_type_layout
--

DROP TABLE IF EXISTS product_type_layout;
CREATE TABLE product_type_layout (
configuration_id int(11) NOT NULL auto_increment,
configuration_title text NOT NULL,
configuration_key varchar(255) NOT NULL default '',
configuration_value text NOT NULL,
configuration_description text NOT NULL,
product_type_id int(11) NOT NULL default '0',
sort_order int(5) default NULL,
last_modified datetime default NULL,
date_added datetime NOT NULL default '0001-01-01 00:00:00',
use_function text,
set_function text,
PRIMARY KEY  (configuration_id),
UNIQUE KEY unq_config_key_zen (configuration_key),
KEY idx_key_value_zen (configuration_key,configuration_value(10))
) ENGINE=MyISAM AUTO_INCREMENT=144 DEFAULT CHARSET=ujis;

--
-- Dumping data for table product_type_layout
--

INSERT INTO product_type_layout VALUES (1,'型番表示','SHOW_PRODUCT_INFO_MODEL','1','商品情報で型番を表示する 0= off 1= on',1,1,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (2,'重量表示','SHOW_PRODUCT_INFO_WEIGHT','1','商品情報で型番を表示する 0= off 1= on',1,2,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (3,'オプション重量表示','SHOW_PRODUCT_INFO_WEIGHT_ATTRIBUTES','1','商品情報でオプションの重量を表示する。 0= off 1= on',1,3,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (4,'メーカーの表示','SHOW_PRODUCT_INFO_MANUFACTURER','1','商品ページに、メーカー名を表示しますか？0= off 1= on',1,4,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (5,'カート内の数量表示','SHOW_PRODUCT_INFO_IN_CART_QTY','1','商品情報でカート内の数量を表示する。 0= off 1= on',1,5,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (6,'在庫数表示','SHOW_PRODUCT_INFO_QUANTITY','1','商品情報で在庫数を表示する。 0= off 1= on',1,6,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (7,'レビュー数表示','SHOW_PRODUCT_INFO_REVIEWS_COUNT','1','商品情報でレビュー数を表示する 0= off 1= on',1,7,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (8,'レビューボタン表示','SHOW_PRODUCT_INFO_REVIEWS','1','商品情報でレビューボタンを表示する 0= off 1= on',1,8,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (9,'購入可能になった日付の表示','SHOW_PRODUCT_INFO_DATE_AVAILABLE','1','商品情報で商品が購入可能になった日付を表示する。 0= off 1= on',1,9,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (10,'登録日表示','SHOW_PRODUCT_INFO_DATE_ADDED','1','商品情報で商品が登録された日付を表示します。 0= off 1= on',1,10,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (11,'商品URL表示','SHOW_PRODUCT_INFO_URL','1','商品情報で商品のURLを表示する 0= off 1= on',1,11,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (12,'Show Product Additional Images','SHOW_PRODUCT_INFO_ADDITIONAL_IMAGES','1','Display Additional Images on Product Info 0= off 1= on',1,13,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (13,'ベース価格の表示','SHOW_PRODUCT_INFO_STARTING_AT','1','商品ページに、ベース価格を表示しますか？0= off 1= on',1,12,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (14,'「友達に知らせる」ボタン表示','SHOW_PRODUCT_INFO_TELL_A_FRIEND','1','商品情報で「友達に知らせる」ボタンを表示する。<br /><br />Note: この設定をoffにしてもサイドボックスの「友達に知らせる」は消えません。また、サイドボックスの「友達に知らせる」をoffにしてもこのボタン表示の設定に影響はありません。<br />0= off 1= on',1,15,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (15,'送料無料の画像ステータス - カタログ','SHOW_PRODUCT_INFO_ALWAYS_FREE_SHIPPING_IMAGE_SWITCH','0','カタログ中の送料無料の画像/テキストを表示しますか？',1,16,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO product_type_layout VALUES (16,'税種別のデフォルト - 新商品追加時','DEFAULT_PRODUCT_TAX_CLASS_ID','0','新商品を追加する時の、税種別のデフォルトIDを入力してください。',1,100,NULL,'2009-11-19 12:39:40','','');
INSERT INTO product_type_layout VALUES (17,'ヴァーチャル商品のデフォルトステータス - 新商品追加時','DEFAULT_PRODUCT_PRODUCTS_VIRTUAL','0','新商品を追加する時の、ヴァーチャル商品のデフォルトステータスをONにしますか？',1,101,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (18,'Product Free Shipping Default Status - Normal Shipping Rules - When adding new products?','DEFAULT_PRODUCT_PRODUCTS_IS_ALWAYS_FREE_SHIPPING','0','What should the Default Free Shipping status be when adding new products?<br />Yes, Always Free Shipping ON<br />No, Always Free Shipping OFF<br />Special, Product/Download Requires Shipping',1,102,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes, Always ON\'), array(\'id\'=>\'0\', \'text\'=>\'No, Always OFF\'), array(\'id\'=>\'2\', \'text\'=>\'Special\')), ');
INSERT INTO product_type_layout VALUES (19,'型番表示','SHOW_PRODUCT_MUSIC_INFO_MODEL','1','商品情報で型番を表示する 0= off 1= on',2,1,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (20,'重量表示','SHOW_PRODUCT_MUSIC_INFO_WEIGHT','0','商品情報で型番を表示する 0= off 1= on',2,2,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (21,'オプション重量表示','SHOW_PRODUCT_MUSIC_INFO_WEIGHT_ATTRIBUTES','1','商品情報でオプションの重量を表示する。 0= off 1= on',2,3,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (22,'アーティストの表示','SHOW_PRODUCT_MUSIC_INFO_ARTIST','1','商品ページに、アーティスト名を表示しますか？0= off 1= on',2,4,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (23,'音楽ジャンルの表示','SHOW_PRODUCT_MUSIC_INFO_GENRE','1','商品ページに、音楽ジャンルを表示しますか？0= off 1= on',2,4,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (24,'レコード会社の表示','SHOW_PRODUCT_MUSIC_INFO_RECORD_COMPANY','1','商品ページに、レコード会社を表示しますか？0= off 1= on',2,4,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (25,'カート内の数量表示','SHOW_PRODUCT_MUSIC_INFO_IN_CART_QTY','1','商品情報でカート内の数量を表示する。 0= off 1= on',2,5,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (26,'在庫数表示','SHOW_PRODUCT_MUSIC_INFO_QUANTITY','0','商品情報で在庫数を表示する。 0= off 1= on',2,6,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (27,'レビュー数表示','SHOW_PRODUCT_MUSIC_INFO_REVIEWS_COUNT','1','商品情報でレビュー数を表示する 0= off 1= on',2,7,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (28,'レビューボタン表示','SHOW_PRODUCT_MUSIC_INFO_REVIEWS','1','商品情報でレビューボタンを表示する 0= off 1= on',2,8,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (29,'購入可能になった日付の表示','SHOW_PRODUCT_MUSIC_INFO_DATE_AVAILABLE','1','商品情報で商品が購入可能になった日付を表示する。 0= off 1= on',2,9,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (30,'登録日表示','SHOW_PRODUCT_MUSIC_INFO_DATE_ADDED','1','商品情報で商品が登録された日付を表示します。 0= off 1= on',2,10,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (31,'ベース価格の表示','SHOW_PRODUCT_MUSIC_INFO_STARTING_AT','1','商品ページに、ベース価格を表示しますか？0= off 1= on',2,12,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (32,'Show Product Additional Images','SHOW_PRODUCT_MUSIC_INFO_ADDITIONAL_IMAGES','1','Display Additional Images on Product Info 0= off 1= on',2,13,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (33,'「友達に知らせる」ボタン表示','SHOW_PRODUCT_MUSIC_INFO_TELL_A_FRIEND','1','商品情報で「友達に知らせる」ボタンを表示する。<br /><br />Note: この設定をoffにしてもサイドボックスの「友達に知らせる」は消えません。また、サイドボックスの「友達に知らせる」をoffにしてもこのボタン表示の設定に影響はありません。<br />0= off 1= on',2,15,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (34,'送料無料の画像ステータス - カタログ','SHOW_PRODUCT_MUSIC_INFO_ALWAYS_FREE_SHIPPING_IMAGE_SWITCH','0','カタログ中の送料無料の画像/テキストを表示しますか？',2,16,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO product_type_layout VALUES (35,'税種別のデフォルト - 新商品追加時','DEFAULT_PRODUCT_MUSIC_TAX_CLASS_ID','0','新商品を追加する時の、税種別のデフォルトIDを入力してください。',2,100,NULL,'2009-11-19 12:39:40','','');
INSERT INTO product_type_layout VALUES (36,'ヴァーチャル商品のデフォルトステータス - 新商品追加時','DEFAULT_PRODUCT_MUSIC_PRODUCTS_VIRTUAL','0','新商品を追加する時の、ヴァーチャル商品のデフォルトステータスをONにしますか？',2,101,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (37,'Product Free Shipping Default Status - Normal Shipping Rules - When adding new products?','DEFAULT_PRODUCT_MUSIC_PRODUCTS_IS_ALWAYS_FREE_SHIPPING','0','What should the Default Free Shipping status be when adding new products?<br />Yes, Always Free Shipping ON<br />No, Always Free Shipping OFF<br />Special, Product/Download Requires Shipping',2,102,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes, Always ON\'), array(\'id\'=>\'0\', \'text\'=>\'No, Always OFF\'), array(\'id\'=>\'2\', \'text\'=>\'Special\')), ');
INSERT INTO product_type_layout VALUES (38,'レビュー数表示','SHOW_DOCUMENT_GENERAL_INFO_REVIEWS_COUNT','1','商品情報でレビュー数を表示する 0= off 1= on',3,7,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (39,'レビューボタン表示','SHOW_DOCUMENT_GENERAL_INFO_REVIEWS','1','商品情報でレビューボタンを表示する 0= off 1= on',3,8,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (40,'購入可能になった日付の表示','SHOW_DOCUMENT_GENERAL_INFO_DATE_AVAILABLE','1','商品情報で商品が購入可能になった日付を表示する。 0= off 1= on',3,9,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (41,'登録日表示','SHOW_DOCUMENT_GENERAL_INFO_DATE_ADDED','1','商品情報で商品が登録された日付を表示します。 0= off 1= on',3,10,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (42,'「友達に知らせる」ボタン表示','SHOW_DOCUMENT_GENERAL_INFO_TELL_A_FRIEND','1','商品情報で「友達に知らせる」ボタンを表示する。<br /><br />Note: この設定をoffにしてもサイドボックスの「友達に知らせる」は消えません。また、サイドボックスの「友達に知らせる」をoffにしてもこのボタン表示の設定に影響はありません。<br />0= off 1= on',3,15,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (43,'商品URL表示','SHOW_DOCUMENT_GENERAL_INFO_URL','1','商品情報で商品のURLを表示する 0= off 1= on',3,11,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (44,'Show Product Additional Images','SHOW_DOCUMENT_GENERAL_INFO_ADDITIONAL_IMAGES','1','Display Additional Images on Product Info 0= off 1= on',3,13,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (45,'型番表示','SHOW_DOCUMENT_PRODUCT_INFO_MODEL','1','商品情報で型番を表示する 0= off 1= on',4,1,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (46,'重量表示','SHOW_DOCUMENT_PRODUCT_INFO_WEIGHT','0','商品情報で型番を表示する 0= off 1= on',4,2,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (47,'オプション重量表示','SHOW_DOCUMENT_PRODUCT_INFO_WEIGHT_ATTRIBUTES','1','商品情報でオプションの重量を表示する。 0= off 1= on',4,3,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (48,'メーカーの表示','SHOW_DOCUMENT_PRODUCT_INFO_MANUFACTURER','1','商品ページに、メーカー名を表示しますか？0= off 1= on',4,4,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (49,'カート内の数量表示','SHOW_DOCUMENT_PRODUCT_INFO_IN_CART_QTY','1','商品情報でカート内の数量を表示する。 0= off 1= on',4,5,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (50,'在庫数表示','SHOW_DOCUMENT_PRODUCT_INFO_QUANTITY','0','商品情報で在庫数を表示する。 0= off 1= on',4,6,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (51,'レビュー数表示','SHOW_DOCUMENT_PRODUCT_INFO_REVIEWS_COUNT','1','商品情報でレビュー数を表示する 0= off 1= on',4,7,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (52,'レビューボタン表示','SHOW_DOCUMENT_PRODUCT_INFO_REVIEWS','1','商品情報でレビューボタンを表示する 0= off 1= on',4,8,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (53,'購入可能になった日付の表示','SHOW_DOCUMENT_PRODUCT_INFO_DATE_AVAILABLE','1','商品情報で商品が購入可能になった日付を表示する。 0= off 1= on',4,9,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (54,'登録日表示','SHOW_DOCUMENT_PRODUCT_INFO_DATE_ADDED','1','商品情報で商品が登録された日付を表示します。 0= off 1= on',4,10,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (55,'商品URL表示','SHOW_DOCUMENT_PRODUCT_INFO_URL','1','商品情報で商品のURLを表示する 0= off 1= on',4,11,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (56,'Show Product Additional Images','SHOW_DOCUMENT_PRODUCT_INFO_ADDITIONAL_IMAGES','1','Display Additional Images on Product Info 0= off 1= on',4,13,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (57,'ベース価格の表示','SHOW_DOCUMENT_PRODUCT_INFO_STARTING_AT','1','商品ページに、ベース価格を表示しますか？0= off 1= on',4,12,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (58,'「友達に知らせる」ボタン表示','SHOW_DOCUMENT_PRODUCT_INFO_TELL_A_FRIEND','1','商品情報で「友達に知らせる」ボタンを表示する。<br /><br />Note: この設定をoffにしてもサイドボックスの「友達に知らせる」は消えません。また、サイドボックスの「友達に知らせる」をoffにしてもこのボタン表示の設定に影響はありません。<br />0= off 1= on',4,15,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (59,'送料無料の画像ステータス - カタログ','SHOW_DOCUMENT_PRODUCT_INFO_ALWAYS_FREE_SHIPPING_IMAGE_SWITCH','0','カタログ中の送料無料の画像/テキストを表示しますか？',4,16,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO product_type_layout VALUES (60,'税種別のデフォルト - 新商品追加時','DEFAULT_DOCUMENT_PRODUCT_TAX_CLASS_ID','0','新商品を追加する時の、税種別のデフォルトIDを入力してください。',4,100,NULL,'2009-11-19 12:39:40','','');
INSERT INTO product_type_layout VALUES (61,'ヴァーチャル商品のデフォルトステータス - 新商品追加時','DEFAULT_DOCUMENT_PRODUCT_PRODUCTS_VIRTUAL','0','新商品を追加する時の、ヴァーチャル商品のデフォルトステータスをONにしますか？',4,101,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (62,'Product Free Shipping Default Status - Normal Shipping Rules - When adding new products?','DEFAULT_DOCUMENT_PRODUCT_PRODUCTS_IS_ALWAYS_FREE_SHIPPING','0','What should the Default Free Shipping status be when adding new products?<br />Yes, Always Free Shipping ON<br />No, Always Free Shipping OFF<br />Special, Product/Download Requires Shipping',4,102,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes, Always ON\'), array(\'id\'=>\'0\', \'text\'=>\'No, Always OFF\'), array(\'id\'=>\'2\', \'text\'=>\'Special\')), ');
INSERT INTO product_type_layout VALUES (63,'型番表示','SHOW_PRODUCT_FREE_SHIPPING_INFO_MODEL','1','商品情報で型番を表示する 0= off 1= on',5,1,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (64,'重量表示','SHOW_PRODUCT_FREE_SHIPPING_INFO_WEIGHT','0','商品情報で型番を表示する 0= off 1= on',5,2,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (65,'オプション重量表示','SHOW_PRODUCT_FREE_SHIPPING_INFO_WEIGHT_ATTRIBUTES','1','商品情報でオプションの重量を表示する。 0= off 1= on',5,3,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (66,'メーカーの表示','SHOW_PRODUCT_FREE_SHIPPING_INFO_MANUFACTURER','1','商品ページに、メーカー名を表示しますか？0= off 1= on',5,4,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (67,'カート内の数量表示','SHOW_PRODUCT_FREE_SHIPPING_INFO_IN_CART_QTY','1','商品情報でカート内の数量を表示する。 0= off 1= on',5,5,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (68,'在庫数表示','SHOW_PRODUCT_FREE_SHIPPING_INFO_QUANTITY','1','商品情報で在庫数を表示する。 0= off 1= on',5,6,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (69,'レビュー数表示','SHOW_PRODUCT_FREE_SHIPPING_INFO_REVIEWS_COUNT','1','商品情報でレビュー数を表示する 0= off 1= on',5,7,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (70,'レビューボタン表示','SHOW_PRODUCT_FREE_SHIPPING_INFO_REVIEWS','1','商品情報でレビューボタンを表示する 0= off 1= on',5,8,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (71,'購入可能になった日付の表示','SHOW_PRODUCT_FREE_SHIPPING_INFO_DATE_AVAILABLE','0','商品情報で商品が購入可能になった日付を表示する。 0= off 1= on',5,9,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (72,'登録日表示','SHOW_PRODUCT_FREE_SHIPPING_INFO_DATE_ADDED','1','商品情報で商品が登録された日付を表示します。 0= off 1= on',5,10,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (73,'商品URL表示','SHOW_PRODUCT_FREE_SHIPPING_INFO_URL','1','商品情報で商品のURLを表示する 0= off 1= on',5,11,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (74,'Show Product Additional Images','SHOW_PRODUCT_FREE_SHIPPING_INFO_ADDITIONAL_IMAGES','1','Display Additional Images on Product Info 0= off 1= on',5,13,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (75,'ベース価格の表示','SHOW_PRODUCT_FREE_SHIPPING_INFO_STARTING_AT','1','商品ページに、ベース価格を表示しますか？0= off 1= on',5,12,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (76,'「友達に知らせる」ボタン表示','SHOW_PRODUCT_FREE_SHIPPING_INFO_TELL_A_FRIEND','1','商品情報で「友達に知らせる」ボタンを表示する。<br /><br />Note: この設定をoffにしてもサイドボックスの「友達に知らせる」は消えません。また、サイドボックスの「友達に知らせる」をoffにしてもこのボタン表示の設定に影響はありません。<br />0= off 1= on',5,15,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (77,'送料無料の画像ステータス - カタログ','SHOW_PRODUCT_FREE_SHIPPING_INFO_ALWAYS_FREE_SHIPPING_IMAGE_SWITCH','1','カタログ中の送料無料の画像/テキストを表示しますか？',5,16,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO product_type_layout VALUES (78,'税種別のデフォルト - 新商品追加時','DEFAULT_PRODUCT_FREE_SHIPPING_TAX_CLASS_ID','0','新商品を追加する時の、税種別のデフォルトIDを入力してください。',5,100,NULL,'2009-11-19 12:39:40','','');
INSERT INTO product_type_layout VALUES (79,'ヴァーチャル商品のデフォルトステータス - 新商品追加時','DEFAULT_PRODUCT_FREE_SHIPPING_PRODUCTS_VIRTUAL','0','新商品を追加する時の、ヴァーチャル商品のデフォルトステータスをONにしますか？',5,101,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (80,'Product Free Shipping Default Status - Normal Shipping Rules - When adding new products?','DEFAULT_PRODUCT_FREE_SHIPPING_PRODUCTS_IS_ALWAYS_FREE_SHIPPING','1','What should the Default Free Shipping status be when adding new products?<br />Yes, Always Free Shipping ON<br />No, Always Free Shipping OFF<br />Special, Product/Download Requires Shipping',5,102,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes, Always ON\'), array(\'id\'=>\'0\', \'text\'=>\'No, Always OFF\'), array(\'id\'=>\'2\', \'text\'=>\'Special\')), ');
INSERT INTO product_type_layout VALUES (81,'Show Metatags Title Default - Product Title','SHOW_PRODUCT_INFO_METATAGS_TITLE_STATUS','1','Display Product Title in Meta Tags Title 0= off 1= on',1,50,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (82,'Show Metatags Title Default - Product Name','SHOW_PRODUCT_INFO_METATAGS_PRODUCTS_NAME_STATUS','1','Display Product Name in Meta Tags Title 0= off 1= on',1,51,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (83,'Show Metatags Title Default - Product Model','SHOW_PRODUCT_INFO_METATAGS_MODEL_STATUS','1','Display Product Model in Meta Tags Title 0= off 1= on',1,52,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (84,'Show Metatags Title Default - Product Price','SHOW_PRODUCT_INFO_METATAGS_PRICE_STATUS','1','Display Product Price in Meta Tags Title 0= off 1= on',1,53,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (85,'Show Metatags Title Default - Product Tagline','SHOW_PRODUCT_INFO_METATAGS_TITLE_TAGLINE_STATUS','1','Display Product Tagline in Meta Tags Title 0= off 1= on',1,54,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (86,'Show Metatags Title Default - Product Title','SHOW_PRODUCT_MUSIC_INFO_METATAGS_TITLE_STATUS','1','Display Product Title in Meta Tags Title 0= off 1= on',2,50,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (87,'Show Metatags Title Default - Product Name','SHOW_PRODUCT_MUSIC_INFO_METATAGS_PRODUCTS_NAME_STATUS','1','Display Product Name in Meta Tags Title 0= off 1= on',2,51,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (88,'Show Metatags Title Default - Product Model','SHOW_PRODUCT_MUSIC_INFO_METATAGS_MODEL_STATUS','1','Display Product Model in Meta Tags Title 0= off 1= on',2,52,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (89,'Show Metatags Title Default - Product Price','SHOW_PRODUCT_MUSIC_INFO_METATAGS_PRICE_STATUS','1','Display Product Price in Meta Tags Title 0= off 1= on',2,53,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (90,'Show Metatags Title Default - Product Tagline','SHOW_PRODUCT_MUSIC_INFO_METATAGS_TITLE_TAGLINE_STATUS','1','Display Product Tagline in Meta Tags Title 0= off 1= on',2,54,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (91,'Show Metatags Title Default - Document Title','SHOW_DOCUMENT_GENERAL_INFO_METATAGS_TITLE_STATUS','1','Display Document Title in Meta Tags Title 0= off 1= on',3,50,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (92,'Show Metatags Title Default - Document Name','SHOW_DOCUMENT_GENERAL_INFO_METATAGS_PRODUCTS_NAME_STATUS','1','Display Document Name in Meta Tags Title 0= off 1= on',3,51,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (93,'Show Metatags Title Default - Document Tagline','SHOW_DOCUMENT_GENERAL_INFO_METATAGS_TITLE_TAGLINE_STATUS','1','Display Document Tagline in Meta Tags Title 0= off 1= on',3,54,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (94,'Show Metatags Title Default - Document Title','SHOW_DOCUMENT_PRODUCT_INFO_METATAGS_TITLE_STATUS','1','Display Document Title in Meta Tags Title 0= off 1= on',4,50,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (95,'Show Metatags Title Default - Document Name','SHOW_DOCUMENT_PRODUCT_INFO_METATAGS_PRODUCTS_NAME_STATUS','1','Display Document Name in Meta Tags Title 0= off 1= on',4,51,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (96,'Show Metatags Title Default - Document Model','SHOW_DOCUMENT_PRODUCT_INFO_METATAGS_MODEL_STATUS','1','Display Document Model in Meta Tags Title 0= off 1= on',4,52,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (97,'Show Metatags Title Default - Document Price','SHOW_DOCUMENT_PRODUCT_INFO_METATAGS_PRICE_STATUS','1','Display Document Price in Meta Tags Title 0= off 1= on',4,53,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (98,'Show Metatags Title Default - Document Tagline','SHOW_DOCUMENT_PRODUCT_INFO_METATAGS_TITLE_TAGLINE_STATUS','1','Display Document Tagline in Meta Tags Title 0= off 1= on',4,54,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (99,'Show Metatags Title Default - Product Title','SHOW_PRODUCT_FREE_SHIPPING_INFO_METATAGS_TITLE_STATUS','1','Display Product Title in Meta Tags Title 0= off 1= on',5,50,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (100,'Show Metatags Title Default - Product Name','SHOW_PRODUCT_FREE_SHIPPING_INFO_METATAGS_PRODUCTS_NAME_STATUS','1','Display Product Name in Meta Tags Title 0= off 1= on',5,51,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (101,'Show Metatags Title Default - Product Model','SHOW_PRODUCT_FREE_SHIPPING_INFO_METATAGS_MODEL_STATUS','1','Display Product Model in Meta Tags Title 0= off 1= on',5,52,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (102,'Show Metatags Title Default - Product Price','SHOW_PRODUCT_FREE_SHIPPING_INFO_METATAGS_PRICE_STATUS','1','Display Product Price in Meta Tags Title 0= off 1= on',5,53,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (103,'Show Metatags Title Default - Product Tagline','SHOW_PRODUCT_FREE_SHIPPING_INFO_METATAGS_TITLE_TAGLINE_STATUS','1','Display Product Tagline in Meta Tags Title 0= off 1= on',5,54,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ');
INSERT INTO product_type_layout VALUES (104,'PRODUCT Attribute is Display Only - Default','DEFAULT_PRODUCT_ATTRIBUTES_DISPLAY_ONLY','0','PRODUCT Attribute is Display Only<br />Used For Display Purposes Only<br />0= No 1= Yes',1,200,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO product_type_layout VALUES (105,'PRODUCT Attribute is Free - Default','DEFAULT_PRODUCT_ATTRIBUTE_IS_FREE','1','PRODUCT Attribute is Free<br />Attribute is Free When Product is Free<br />0= No 1= Yes',1,201,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO product_type_layout VALUES (106,'PRODUCT Attribute is Default - Default','DEFAULT_PRODUCT_ATTRIBUTES_DEFAULT','0','PRODUCT Attribute is Default<br />Default Attribute to be Marked Selected<br />0= No 1= Yes',1,202,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO product_type_layout VALUES (107,'PRODUCT Attribute is Discounted - Default','DEFAULT_PRODUCT_ATTRIBUTES_DISCOUNTED','1','PRODUCT Attribute is Discounted<br />Apply Discounts Used by Product Special/Sale<br />0= No 1= Yes',1,203,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO product_type_layout VALUES (108,'PRODUCT Attribute is Included in Base Price - Default','DEFAULT_PRODUCT_ATTRIBUTES_PRICE_BASE_INCLUDED','1','PRODUCT Attribute is Included in Base Price<br />Include in Base Price When Priced by Attributes<br />0= No 1= Yes',1,204,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO product_type_layout VALUES (109,'PRODUCT Attribute is Required - Default','DEFAULT_PRODUCT_ATTRIBUTES_REQUIRED','0','PRODUCT Attribute is Required<br />Attribute Required for Text<br />0= No 1= Yes',1,205,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO product_type_layout VALUES (110,'PRODUCT Attribute Price Prefix - Default','DEFAULT_PRODUCT_PRICE_PREFIX','1','PRODUCT Attribute Price Prefix<br />Default Attribute Price Prefix for Adding<br />Blank, + or -',1,206,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Blank\'), array(\'id\'=>\'1\', \'text\'=>\'+\'), array(\'id\'=>\'2\', \'text\'=>\'-\')), ');
INSERT INTO product_type_layout VALUES (111,'PRODUCT Attribute Weight Prefix - Default','DEFAULT_PRODUCT_PRODUCTS_ATTRIBUTES_WEIGHT_PREFIX','1','PRODUCT Attribute Weight Prefix<br />Default Attribute Weight Prefix<br />Blank, + or -',1,207,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Blank\'), array(\'id\'=>\'1\', \'text\'=>\'+\'), array(\'id\'=>\'2\', \'text\'=>\'-\')), ');
INSERT INTO product_type_layout VALUES (112,'MUSIC Attribute is Display Only - Default','DEFAULT_PRODUCT_MUSIC_ATTRIBUTES_DISPLAY_ONLY','0','MUSIC Attribute is Display Only<br />Used For Display Purposes Only<br />0= No 1= Yes',2,200,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO product_type_layout VALUES (113,'MUSIC Attribute is Free - Default','DEFAULT_PRODUCT_MUSIC_ATTRIBUTE_IS_FREE','1','MUSIC Attribute is Free<br />Attribute is Free When Product is Free<br />0= No 1= Yes',2,201,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO product_type_layout VALUES (114,'MUSIC Attribute is Default - Default','DEFAULT_PRODUCT_MUSIC_ATTRIBUTES_DEFAULT','0','MUSIC Attribute is Default<br />Default Attribute to be Marked Selected<br />0= No 1= Yes',2,202,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO product_type_layout VALUES (115,'MUSIC Attribute is Discounted - Default','DEFAULT_PRODUCT_MUSIC_ATTRIBUTES_DISCOUNTED','1','MUSIC Attribute is Discounted<br />Apply Discounts Used by Product Special/Sale<br />0= No 1= Yes',2,203,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO product_type_layout VALUES (116,'MUSIC Attribute is Included in Base Price - Default','DEFAULT_PRODUCT_MUSIC_ATTRIBUTES_PRICE_BASE_INCLUDED','1','MUSIC Attribute is Included in Base Price<br />Include in Base Price When Priced by Attributes<br />0= No 1= Yes',2,204,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO product_type_layout VALUES (117,'MUSIC Attribute is Required - Default','DEFAULT_PRODUCT_MUSIC_ATTRIBUTES_REQUIRED','0','MUSIC Attribute is Required<br />Attribute Required for Text<br />0= No 1= Yes',2,205,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO product_type_layout VALUES (118,'MUSIC Attribute Price Prefix - Default','DEFAULT_PRODUCT_MUSIC_PRICE_PREFIX','1','MUSIC Attribute Price Prefix<br />Default Attribute Price Prefix for Adding<br />Blank, + or -',2,206,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Blank\'), array(\'id\'=>\'1\', \'text\'=>\'+\'), array(\'id\'=>\'2\', \'text\'=>\'-\')), ');
INSERT INTO product_type_layout VALUES (119,'MUSIC Attribute Weight Prefix - Default','DEFAULT_PRODUCT_MUSIC_PRODUCTS_ATTRIBUTES_WEIGHT_PREFIX','1','MUSIC Attribute Weight Prefix<br />Default Attribute Weight Prefix<br />Blank, + or -',2,207,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Blank\'), array(\'id\'=>\'1\', \'text\'=>\'+\'), array(\'id\'=>\'2\', \'text\'=>\'-\')), ');
INSERT INTO product_type_layout VALUES (120,'DOCUMENT GENERAL Attribute is Display Only - Default','DEFAULT_DOCUMENT_GENERAL_ATTRIBUTES_DISPLAY_ONLY','0','DOCUMENT GENERAL Attribute is Display Only<br />Used For Display Purposes Only<br />0= No 1= Yes',3,200,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO product_type_layout VALUES (121,'DOCUMENT GENERAL Attribute is Free - Default','DEFAULT_DOCUMENT_GENERAL_ATTRIBUTE_IS_FREE','1','DOCUMENT GENERAL Attribute is Free<br />Attribute is Free When Product is Free<br />0= No 1= Yes',3,201,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO product_type_layout VALUES (122,'DOCUMENT GENERAL Attribute is Default - Default','DEFAULT_DOCUMENT_GENERAL_ATTRIBUTES_DEFAULT','0','DOCUMENT GENERAL Attribute is Default<br />Default Attribute to be Marked Selected<br />0= No 1= Yes',3,202,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO product_type_layout VALUES (123,'DOCUMENT GENERAL Attribute is Discounted - Default','DEFAULT_DOCUMENT_GENERAL_ATTRIBUTES_DISCOUNTED','1','DOCUMENT GENERAL Attribute is Discounted<br />Apply Discounts Used by Product Special/Sale<br />0= No 1= Yes',3,203,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO product_type_layout VALUES (124,'DOCUMENT GENERAL Attribute is Included in Base Price - Default','DEFAULT_DOCUMENT_GENERAL_ATTRIBUTES_PRICE_BASE_INCLUDED','1','DOCUMENT GENERAL Attribute is Included in Base Price<br />Include in Base Price When Priced by Attributes<br />0= No 1= Yes',3,204,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO product_type_layout VALUES (125,'DOCUMENT GENERAL Attribute is Required - Default','DEFAULT_DOCUMENT_GENERAL_ATTRIBUTES_REQUIRED','0','DOCUMENT GENERAL Attribute is Required<br />Attribute Required for Text<br />0= No 1= Yes',3,205,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO product_type_layout VALUES (126,'DOCUMENT GENERAL Attribute Price Prefix - Default','DEFAULT_DOCUMENT_GENERAL_PRICE_PREFIX','1','DOCUMENT GENERAL Attribute Price Prefix<br />Default Attribute Price Prefix for Adding<br />Blank, + or -',3,206,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Blank\'), array(\'id\'=>\'1\', \'text\'=>\'+\'), array(\'id\'=>\'2\', \'text\'=>\'-\')), ');
INSERT INTO product_type_layout VALUES (127,'DOCUMENT GENERAL Attribute Weight Prefix - Default','DEFAULT_DOCUMENT_GENERAL_PRODUCTS_ATTRIBUTES_WEIGHT_PREFIX','1','DOCUMENT GENERAL Attribute Weight Prefix<br />Default Attribute Weight Prefix<br />Blank, + or -',3,207,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Blank\'), array(\'id\'=>\'1\', \'text\'=>\'+\'), array(\'id\'=>\'2\', \'text\'=>\'-\')), ');
INSERT INTO product_type_layout VALUES (128,'DOCUMENT PRODUCT Attribute is Display Only - Default','DEFAULT_DOCUMENT_PRODUCT_ATTRIBUTES_DISPLAY_ONLY','0','DOCUMENT PRODUCT Attribute is Display Only<br />Used For Display Purposes Only<br />0= No 1= Yes',4,200,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO product_type_layout VALUES (129,'DOCUMENT PRODUCT Attribute is Free - Default','DEFAULT_DOCUMENT_PRODUCT_ATTRIBUTE_IS_FREE','1','DOCUMENT PRODUCT Attribute is Free<br />Attribute is Free When Product is Free<br />0= No 1= Yes',4,201,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO product_type_layout VALUES (130,'DOCUMENT PRODUCT Attribute is Default - Default','DEFAULT_DOCUMENT_PRODUCT_ATTRIBUTES_DEFAULT','0','DOCUMENT PRODUCT Attribute is Default<br />Default Attribute to be Marked Selected<br />0= No 1= Yes',4,202,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO product_type_layout VALUES (131,'DOCUMENT PRODUCT Attribute is Discounted - Default','DEFAULT_DOCUMENT_PRODUCT_ATTRIBUTES_DISCOUNTED','1','DOCUMENT PRODUCT Attribute is Discounted<br />Apply Discounts Used by Product Special/Sale<br />0= No 1= Yes',4,203,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO product_type_layout VALUES (132,'DOCUMENT PRODUCT Attribute is Included in Base Price - Default','DEFAULT_DOCUMENT_PRODUCT_ATTRIBUTES_PRICE_BASE_INCLUDED','1','DOCUMENT PRODUCT Attribute is Included in Base Price<br />Include in Base Price When Priced by Attributes<br />0= No 1= Yes',4,204,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO product_type_layout VALUES (133,'DOCUMENT PRODUCT Attribute is Required - Default','DEFAULT_DOCUMENT_PRODUCT_ATTRIBUTES_REQUIRED','0','DOCUMENT PRODUCT Attribute is Required<br />Attribute Required for Text<br />0= No 1= Yes',4,205,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO product_type_layout VALUES (134,'DOCUMENT PRODUCT Attribute Price Prefix - Default','DEFAULT_DOCUMENT_PRODUCT_PRICE_PREFIX','1','DOCUMENT PRODUCT Attribute Price Prefix<br />Default Attribute Price Prefix for Adding<br />Blank, + or -',4,206,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Blank\'), array(\'id\'=>\'1\', \'text\'=>\'+\'), array(\'id\'=>\'2\', \'text\'=>\'-\')), ');
INSERT INTO product_type_layout VALUES (135,'DOCUMENT PRODUCT Attribute Weight Prefix - Default','DEFAULT_DOCUMENT_PRODUCT_PRODUCTS_ATTRIBUTES_WEIGHT_PREFIX','1','DOCUMENT PRODUCT Attribute Weight Prefix<br />Default Attribute Weight Prefix<br />Blank, + or -',4,207,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Blank\'), array(\'id\'=>\'1\', \'text\'=>\'+\'), array(\'id\'=>\'2\', \'text\'=>\'-\')), ');
INSERT INTO product_type_layout VALUES (136,'PRODUCT FREE SHIPPING Attribute is Display Only - Default','DEFAULT_PRODUCT_FREE_SHIPPING_ATTRIBUTES_DISPLAY_ONLY','0','PRODUCT FREE SHIPPING Attribute is Display Only<br />Used For Display Purposes Only<br />0= No 1= Yes',5,201,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO product_type_layout VALUES (137,'PRODUCT FREE SHIPPING Attribute is Free - Default','DEFAULT_PRODUCT_FREE_SHIPPING_ATTRIBUTE_IS_FREE','1','PRODUCT FREE SHIPPING Attribute is Free<br />Attribute is Free When Product is Free<br />0= No 1= Yes',5,201,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO product_type_layout VALUES (138,'PRODUCT FREE SHIPPING Attribute is Default - Default','DEFAULT_PRODUCT_FREE_SHIPPING_ATTRIBUTES_DEFAULT','0','PRODUCT FREE SHIPPING Attribute is Default<br />Default Attribute to be Marked Selected<br />0= No 1= Yes',5,202,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO product_type_layout VALUES (139,'PRODUCT FREE SHIPPING Attribute is Discounted - Default','DEFAULT_PRODUCT_FREE_SHIPPING_ATTRIBUTES_DISCOUNTED','1','PRODUCT FREE SHIPPING Attribute is Discounted<br />Apply Discounts Used by Product Special/Sale<br />0= No 1= Yes',5,203,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO product_type_layout VALUES (140,'PRODUCT FREE SHIPPING Attribute is Included in Base Price - Default','DEFAULT_PRODUCT_FREE_SHIPPING_ATTRIBUTES_PRICE_BASE_INCLUDED','1','PRODUCT FREE SHIPPING Attribute is Included in Base Price<br />Include in Base Price When Priced by Attributes<br />0= No 1= Yes',5,204,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO product_type_layout VALUES (141,'PRODUCT FREE SHIPPING Attribute is Required - Default','DEFAULT_PRODUCT_FREE_SHIPPING_ATTRIBUTES_REQUIRED','0','PRODUCT FREE SHIPPING Attribute is Required<br />Attribute Required for Text<br />0= No 1= Yes',5,205,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ');
INSERT INTO product_type_layout VALUES (142,'PRODUCT FREE SHIPPING Attribute Price Prefix - Default','DEFAULT_PRODUCT_FREE_SHIPPING_PRICE_PREFIX','1','PRODUCT FREE SHIPPING Attribute Price Prefix<br />Default Attribute Price Prefix for Adding<br />Blank, + or -',5,206,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Blank\'), array(\'id\'=>\'1\', \'text\'=>\'+\'), array(\'id\'=>\'2\', \'text\'=>\'-\')), ');
INSERT INTO product_type_layout VALUES (143,'PRODUCT FREE SHIPPING Attribute Weight Prefix - Default','DEFAULT_PRODUCT_FREE_SHIPPING_PRODUCTS_ATTRIBUTES_WEIGHT_PREFIX','1','PRODUCT FREE SHIPPING Attribute Weight Prefix<br />Default Attribute Weight Prefix<br />Blank, + or -',5,207,NULL,'2009-11-19 12:39:40',NULL,'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Blank\'), array(\'id\'=>\'1\', \'text\'=>\'+\'), array(\'id\'=>\'2\', \'text\'=>\'-\')), ');

--
-- Table structure for table product_types
--

DROP TABLE IF EXISTS product_types;
CREATE TABLE product_types (
type_id int(11) NOT NULL auto_increment,
type_name varchar(255) NOT NULL default '',
type_handler varchar(255) NOT NULL default '',
type_master_type int(11) NOT NULL default '1',
allow_add_to_cart char(1) NOT NULL default 'Y',
default_image varchar(255) NOT NULL default '',
date_added datetime NOT NULL default '0001-01-01 00:00:00',
last_modified datetime NOT NULL default '0001-01-01 00:00:00',
PRIMARY KEY  (type_id),
KEY idx_type_master_type_zen (type_master_type)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=ujis;

--
-- Dumping data for table product_types
--

INSERT INTO product_types VALUES (1,'Product - General','product',1,'Y','','2009-11-19 12:39:40','2009-11-19 12:39:40');
INSERT INTO product_types VALUES (2,'Product - Music','product_music',1,'Y','','2009-11-19 12:39:40','2009-11-19 12:39:40');
INSERT INTO product_types VALUES (3,'Document - General','document_general',3,'N','','2009-11-19 12:39:40','2009-11-19 12:39:40');
INSERT INTO product_types VALUES (4,'Document - Product','document_product',3,'Y','','2009-11-19 12:39:40','2009-11-19 12:39:40');
INSERT INTO product_types VALUES (5,'Product - Free Shipping','product_free_shipping',1,'Y','','2009-11-19 12:39:40','2009-11-19 12:39:40');

--
-- Table structure for table product_types_to_category
--

DROP TABLE IF EXISTS product_types_to_category;
CREATE TABLE product_types_to_category (
product_type_id int(11) NOT NULL default '0',
category_id int(11) NOT NULL default '0',
KEY idx_category_id_zen (category_id),
KEY idx_product_type_id_zen (product_type_id)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table product_types_to_category
--


--
-- Table structure for table products
--

DROP TABLE IF EXISTS products;
CREATE TABLE products (
products_id int(11) NOT NULL auto_increment,
products_type int(11) NOT NULL default '1',
products_quantity float NOT NULL default '0',
products_model varchar(32) default NULL,
products_image varchar(64) default NULL,
products_price decimal(15,4) NOT NULL default '0.0000',
products_virtual tinyint(1) NOT NULL default '0',
products_date_added datetime NOT NULL default '0001-01-01 00:00:00',
products_last_modified datetime default NULL,
products_date_available datetime default NULL,
products_weight float NOT NULL default '0',
products_status tinyint(1) NOT NULL default '0',
products_tax_class_id int(11) NOT NULL default '0',
manufacturers_id int(11) default NULL,
products_ordered float NOT NULL default '0',
products_quantity_order_min float NOT NULL default '1',
products_quantity_order_units float NOT NULL default '1',
products_priced_by_attribute tinyint(1) NOT NULL default '0',
product_is_free tinyint(1) NOT NULL default '0',
product_is_call tinyint(1) NOT NULL default '0',
products_quantity_mixed tinyint(1) NOT NULL default '0',
product_is_always_free_shipping tinyint(1) NOT NULL default '0',
products_qty_box_status tinyint(1) NOT NULL default '1',
products_quantity_order_max float NOT NULL default '0',
products_sort_order int(11) NOT NULL default '0',
products_discount_type tinyint(1) NOT NULL default '0',
products_discount_type_from tinyint(1) NOT NULL default '0',
products_price_sorter decimal(15,4) NOT NULL default '0.0000',
master_categories_id int(11) NOT NULL default '0',
products_mixed_discount_quantity tinyint(1) NOT NULL default '1',
metatags_title_status tinyint(1) NOT NULL default '0',
metatags_products_name_status tinyint(1) NOT NULL default '0',
metatags_model_status tinyint(1) NOT NULL default '0',
metatags_price_status tinyint(1) NOT NULL default '0',
metatags_title_tagline_status tinyint(1) NOT NULL default '0',
PRIMARY KEY  (products_id),
KEY idx_products_date_added_zen (products_date_added),
KEY idx_products_status_zen (products_status)
) ENGINE=MyISAM AUTO_INCREMENT=230 DEFAULT CHARSET=ujis;

--
-- Dumping data for table products
--


--
-- Table structure for table products_attributes
--

DROP TABLE IF EXISTS products_attributes;
CREATE TABLE products_attributes (
products_attributes_id int(11) NOT NULL auto_increment,
products_id int(11) NOT NULL default '0',
options_id int(11) NOT NULL default '0',
options_values_id int(11) NOT NULL default '0',
options_values_price decimal(15,4) NOT NULL default '0.0000',
price_prefix char(1) NOT NULL default '',
products_options_sort_order int(11) NOT NULL default '0',
product_attribute_is_free tinyint(1) NOT NULL default '0',
products_attributes_weight float NOT NULL default '0',
products_attributes_weight_prefix char(1) NOT NULL default '',
attributes_display_only tinyint(1) NOT NULL default '0',
attributes_default tinyint(1) NOT NULL default '0',
attributes_discounted tinyint(1) NOT NULL default '1',
attributes_image varchar(64) default NULL,
attributes_price_base_included tinyint(1) NOT NULL default '1',
attributes_price_onetime decimal(15,4) NOT NULL default '0.0000',
attributes_price_factor decimal(15,4) NOT NULL default '0.0000',
attributes_price_factor_offset decimal(15,4) NOT NULL default '0.0000',
attributes_price_factor_onetime decimal(15,4) NOT NULL default '0.0000',
attributes_price_factor_onetime_offset decimal(15,4) NOT NULL default '0.0000',
attributes_qty_prices text,
attributes_qty_prices_onetime text,
attributes_price_words decimal(15,4) NOT NULL default '0.0000',
attributes_price_words_free int(4) NOT NULL default '0',
attributes_price_letters decimal(15,4) NOT NULL default '0.0000',
attributes_price_letters_free int(4) NOT NULL default '0',
attributes_required tinyint(1) NOT NULL default '0',
PRIMARY KEY  (products_attributes_id),
KEY idx_id_options_id_values_zen (products_id,options_id,options_values_id)
) ENGINE=MyISAM AUTO_INCREMENT=423 DEFAULT CHARSET=ujis;

--
-- Dumping data for table products_attributes
--


--
-- Table structure for table products_attributes_download
--

DROP TABLE IF EXISTS products_attributes_download;
CREATE TABLE products_attributes_download (
products_attributes_id int(11) NOT NULL default '0',
products_attributes_filename varchar(255) NOT NULL default '',
products_attributes_maxdays int(2) default '0',
products_attributes_maxcount int(2) default '0',
PRIMARY KEY  (products_attributes_id)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table products_attributes_download
--


--
-- Table structure for table products_description
--

DROP TABLE IF EXISTS products_description;
CREATE TABLE products_description (
products_id int(11) NOT NULL auto_increment,
language_id int(11) NOT NULL default '1',
products_name varchar(64) NOT NULL default '',
products_description text,
products_url varchar(255) default NULL,
products_viewed int(5) default '0',
PRIMARY KEY  (products_id,language_id),
KEY idx_products_name_zen (products_name)
) ENGINE=MyISAM AUTO_INCREMENT=235 DEFAULT CHARSET=ujis;

--
-- Dumping data for table products_description
--


--
-- Table structure for table products_discount_quantity
--

DROP TABLE IF EXISTS products_discount_quantity;
CREATE TABLE products_discount_quantity (
discount_id int(4) NOT NULL default '0',
products_id int(11) NOT NULL default '0',
discount_qty float NOT NULL default '0',
discount_price decimal(15,4) NOT NULL default '0.0000',
KEY idx_id_qty_zen (products_id,discount_qty)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table products_discount_quantity
--


--
-- Table structure for table products_notifications
--

DROP TABLE IF EXISTS products_notifications;
CREATE TABLE products_notifications (
products_id int(11) NOT NULL default '0',
customers_id int(11) NOT NULL default '0',
date_added datetime NOT NULL default '0001-01-01 00:00:00',
PRIMARY KEY  (products_id,customers_id)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table products_notifications
--


--
-- Table structure for table products_options
--

DROP TABLE IF EXISTS products_options;
CREATE TABLE products_options (
products_options_id int(11) NOT NULL default '0',
language_id int(11) NOT NULL default '1',
products_options_name varchar(32) NOT NULL default '',
products_options_sort_order int(11) NOT NULL default '0',
products_options_type int(5) NOT NULL default '0',
products_options_length smallint(2) NOT NULL default '32',
products_options_comment varchar(64) default NULL,
products_options_size smallint(2) NOT NULL default '32',
products_options_images_per_row int(2) default '5',
products_options_images_style int(1) default '0',
products_options_rows smallint(2) NOT NULL default '1',
PRIMARY KEY  (products_options_id,language_id),
KEY idx_lang_id_zen (language_id)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table products_options
--


--
-- Table structure for table products_options_types
--

DROP TABLE IF EXISTS products_options_types;
CREATE TABLE products_options_types (
products_options_types_id int(11) NOT NULL default '0',
products_options_types_name varchar(32) default NULL,
PRIMARY KEY  (products_options_types_id)
) ENGINE=MyISAM DEFAULT CHARSET=ujis COMMENT='Track products_options_types';

--
-- Dumping data for table products_options_types
--

INSERT INTO products_options_types VALUES (0,'Dropdown');
INSERT INTO products_options_types VALUES (1,'Text');
INSERT INTO products_options_types VALUES (2,'Radio');
INSERT INTO products_options_types VALUES (3,'Checkbox');
INSERT INTO products_options_types VALUES (4,'File');
INSERT INTO products_options_types VALUES (5,'Read Only');

--
-- Table structure for table products_options_values
--

DROP TABLE IF EXISTS products_options_values;
CREATE TABLE products_options_values (
products_options_values_id int(11) NOT NULL default '0',
language_id int(11) NOT NULL default '1',
products_options_values_name varchar(64) NOT NULL default '',
products_options_values_sort_order int(11) NOT NULL default '0',
PRIMARY KEY  (products_options_values_id,language_id)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table products_options_values
--

INSERT INTO products_options_values VALUES (0,1,'TEXT',0);
INSERT INTO products_options_values VALUES (0,2,'TEXT',0);
INSERT INTO products_options_values VALUES (0,9,'TEXT',0);

--
-- Table structure for table products_options_values_to_products_options
--

DROP TABLE IF EXISTS products_options_values_to_products_options;
CREATE TABLE products_options_values_to_products_options (
products_options_values_to_products_options_id int(11) NOT NULL auto_increment,
products_options_id int(11) NOT NULL default '0',
products_options_values_id int(11) NOT NULL default '0',
PRIMARY KEY  (products_options_values_to_products_options_id)
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=ujis;

--
-- Dumping data for table products_options_values_to_products_options
--


--
-- Table structure for table products_point_rate
--

DROP TABLE IF EXISTS products_point_rate;
CREATE TABLE products_point_rate (
products_id int(11) NOT NULL default '0',
rate int(11) NOT NULL default '0',
PRIMARY KEY  (products_id)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table products_point_rate
--


--
-- Table structure for table products_to_categories
--

DROP TABLE IF EXISTS products_to_categories;
CREATE TABLE products_to_categories (
products_id int(11) NOT NULL default '0',
categories_id int(11) NOT NULL default '0',
PRIMARY KEY  (products_id,categories_id),
KEY idx_cat_prod_id_zen (categories_id,products_id)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table products_to_categories
--


--
-- Table structure for table products_with_attributes_stock
--

DROP TABLE IF EXISTS products_with_attributes_stock;
CREATE TABLE products_with_attributes_stock (
stock_id int(11) NOT NULL auto_increment,
products_id int(11) NOT NULL default '0',
stock_attributes varchar(255) NOT NULL default '',
skumodel varchar(255) NOT NULL default '',
quantity float NOT NULL default '0',
PRIMARY KEY  (stock_id)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=ujis;

--
-- Dumping data for table products_with_attributes_stock
--


--
-- Table structure for table products_xsell
--

DROP TABLE IF EXISTS products_xsell;
CREATE TABLE products_xsell (
ID int(10) NOT NULL auto_increment,
products_id int(10) unsigned NOT NULL default '1',
xsell_id int(10) unsigned NOT NULL default '1',
sort_order int(10) unsigned NOT NULL default '1',
PRIMARY KEY  (ID),
KEY idx_products_id_xsell (products_id)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=ujis;

--
-- Dumping data for table products_xsell
--


--
-- Table structure for table project_version
--

DROP TABLE IF EXISTS project_version;
CREATE TABLE project_version (
project_version_id tinyint(3) NOT NULL auto_increment,
project_version_key varchar(40) NOT NULL default '',
project_version_major varchar(20) NOT NULL default '',
project_version_minor varchar(20) NOT NULL default '',
project_version_patch1 varchar(20) NOT NULL default '',
project_version_patch2 varchar(20) NOT NULL default '',
project_version_patch1_source varchar(20) NOT NULL default '',
project_version_patch2_source varchar(20) NOT NULL default '',
project_version_comment varchar(250) NOT NULL default '',
project_version_date_applied datetime NOT NULL default '0001-01-01 01:01:01',
PRIMARY KEY  (project_version_id),
UNIQUE KEY idx_project_version_key_zen (project_version_key)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=ujis COMMENT='Database Version Tracking';

--
-- Dumping data for table project_version
--

INSERT INTO project_version VALUES (1,'Zen-Cart Main','1','3.0.2-l10n-jp-5','','','','','Fresh Installation','2009-11-19 12:39:40');
INSERT INTO project_version VALUES (2,'Zen-Cart Database','1','3.0.2-l10n-jp-5','','','','','Fresh Installation','2009-11-19 12:39:40');

--
-- Table structure for table project_version_history
--

DROP TABLE IF EXISTS project_version_history;
CREATE TABLE project_version_history (
project_version_id tinyint(3) NOT NULL auto_increment,
project_version_key varchar(40) NOT NULL default '',
project_version_major varchar(20) NOT NULL default '',
project_version_minor varchar(20) NOT NULL default '',
project_version_patch varchar(20) NOT NULL default '',
project_version_comment varchar(250) NOT NULL default '',
project_version_date_applied datetime NOT NULL default '0001-01-01 01:01:01',
PRIMARY KEY  (project_version_id)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=ujis COMMENT='Database Version Tracking History';

--
-- Dumping data for table project_version_history
--

INSERT INTO project_version_history VALUES (1,'Zen-Cart Main','1','3.0.2','','Fresh Installation','2009-11-19 12:39:40');
INSERT INTO project_version_history VALUES (2,'Zen-Cart Database','1','3.0.2','','Fresh Installation','2009-11-19 12:39:40');
INSERT INTO project_version_history VALUES (3,'Zen-Cart Main','1','3.0.2-l10n-jp-1','','v1.3.0.2-l10n-jp-1','2009-11-19 12:39:40');
INSERT INTO project_version_history VALUES (4,'Zen-Cart Database','1','3.0.2-l10n-jp-1','','v1.3.0.2-l10n-jp-1','2009-11-19 12:39:40');
INSERT INTO project_version_history VALUES (5,'Zen-Cart Main','1','3.0.2-l10n-jp-2','','v1.3.0.2-l10n-jp-2','2009-11-19 12:39:40');
INSERT INTO project_version_history VALUES (6,'Zen-Cart Database','1','3.0.2-l10n-jp-2','','v1.3.0.2-l10n-jp-2','2009-11-19 12:39:40');
INSERT INTO project_version_history VALUES (7,'Zen-Cart Main','1','3.0.2-l10n-jp-3','','v1.3.0.2-l10n-jp-3','2009-11-19 12:39:40');
INSERT INTO project_version_history VALUES (8,'Zen-Cart Database','1','3.0.2-l10n-jp-3','','v1.3.0.2-l10n-jp-3','2009-11-19 12:39:40');
INSERT INTO project_version_history VALUES (9,'Zen-Cart Main','1','3.0.2-l10n-jp-4','','v1.3.0.2-l10n-jp-4','2009-11-19 12:39:40');
INSERT INTO project_version_history VALUES (10,'Zen-Cart Database','1','3.0.2-l10n-jp-4','','v1.3.0.2-l10n-jp-4','2009-11-19 12:39:40');
INSERT INTO project_version_history VALUES (11,'Zen-Cart Main','1','3.0.2-l10n-jp-5','','v1.3.0.2-l10n-jp-5','2009-11-19 12:39:40');
INSERT INTO project_version_history VALUES (12,'Zen-Cart Database','1','3.0.2-l10n-jp-5','','v1.3.0.2-l10n-jp-5','2009-11-19 12:39:40');

--
-- Table structure for table query_builder
--

DROP TABLE IF EXISTS query_builder;
CREATE TABLE query_builder (
query_id int(11) NOT NULL auto_increment,
query_category varchar(40) NOT NULL default '',
query_name varchar(80) NOT NULL default '',
query_description text NOT NULL,
query_string text NOT NULL,
query_keys_list text NOT NULL,
PRIMARY KEY  (query_id),
UNIQUE KEY query_name (query_name)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=ujis COMMENT='Stores queries for re-use in Admin email and report modules';

--
-- Dumping data for table query_builder
--

INSERT INTO query_builder VALUES (1,'email','All Customers','Returns all customers name and email address for sending mass emails (ie: for newsletters, coupons, GV\'s, messages, etc).','select customers_email_address, customers_firstname, customers_lastname from TABLE_CUSTOMERS order by customers_lastname, customers_firstname, customers_email_address','');
INSERT INTO query_builder VALUES (2,'email,newsletters','All Newsletter Subscribers','Returns name and email address of newsletter subscribers','select customers_firstname, customers_lastname, customers_email_address from TABLE_CUSTOMERS where customers_newsletter = \'1\'','');
INSERT INTO query_builder VALUES (3,'email,newsletters','Dormant Customers (>3months) (Subscribers)','Subscribers who HAVE purchased something, but have NOT purchased for at least three months.','select c.customers_email_address, c.customers_lastname, c.customers_firstname from TABLE_CUSTOMERS c, TABLE_ORDERS o where c.customers_newsletter = \'1\' AND c.customers_id = o.customers_id and o.date_purchased < subdate(now(),INTERVAL 3 MONTH) GROUP BY c.customers_email_address order by c.customers_lastname, c.customers_firstname ASC','');
INSERT INTO query_builder VALUES (4,'email,newsletters','Active customers in past 3 months (Subscribers)','Newsletter subscribers who are also active customers (purchased something) in last 3 months.','select c.customers_email_address, c.customers_lastname, c.customers_firstname from TABLE_CUSTOMERS c, TABLE_ORDERS o where c.customers_newsletter = \'1\' AND c.customers_id = o.customers_id and o.date_purchased > subdate(now(),INTERVAL 3 MONTH) GROUP BY c.customers_email_address order by c.customers_lastname, c.customers_firstname ASC','');
INSERT INTO query_builder VALUES (5,'email,newsletters','Active customers in past 3 months (Regardless of subscription status)','All active customers (purchased something) in last 3 months, ignoring newsletter-subscription status.','select c.customers_email_address, c.customers_lastname, c.customers_firstname from TABLE_CUSTOMERS c, TABLE_ORDERS o WHERE c.customers_id = o.customers_id and o.date_purchased > subdate(now(),INTERVAL 3 MONTH) GROUP BY c.customers_email_address order by c.customers_lastname, c.customers_firstname ASC','');
INSERT INTO query_builder VALUES (6,'email,newsletters','Administrator','Just the email account of the current administrator','select \'ADMIN\' as customers_firstname, admin_name as customers_lastname, admin_email as customers_email_address from TABLE_ADMIN where admin_id = $SESSION:admin_id','');

--
-- Table structure for table record_artists
--

DROP TABLE IF EXISTS record_artists;
CREATE TABLE record_artists (
artists_id int(11) NOT NULL auto_increment,
artists_name varchar(32) NOT NULL default '',
artists_image varchar(64) default NULL,
date_added datetime default NULL,
last_modified datetime default NULL,
PRIMARY KEY  (artists_id),
KEY idx_rec_artists_name_zen (artists_name)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=ujis;

--
-- Dumping data for table record_artists
--


--
-- Table structure for table record_artists_info
--

DROP TABLE IF EXISTS record_artists_info;
CREATE TABLE record_artists_info (
artists_id int(11) NOT NULL default '0',
languages_id int(11) NOT NULL default '0',
artists_url varchar(255) NOT NULL default '',
url_clicked int(5) NOT NULL default '0',
date_last_click datetime default NULL,
PRIMARY KEY  (artists_id,languages_id)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table record_artists_info
--


--
-- Table structure for table record_company
--

DROP TABLE IF EXISTS record_company;
CREATE TABLE record_company (
record_company_id int(11) NOT NULL auto_increment,
record_company_name varchar(32) NOT NULL default '',
record_company_image varchar(64) default NULL,
date_added datetime default NULL,
last_modified datetime default NULL,
PRIMARY KEY  (record_company_id),
KEY idx_rec_company_name_zen (record_company_name)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=ujis;

--
-- Dumping data for table record_company
--


--
-- Table structure for table record_company_info
--

DROP TABLE IF EXISTS record_company_info;
CREATE TABLE record_company_info (
record_company_id int(11) NOT NULL default '0',
languages_id int(11) NOT NULL default '0',
record_company_url varchar(255) NOT NULL default '',
url_clicked int(5) NOT NULL default '0',
date_last_click datetime default NULL,
PRIMARY KEY  (record_company_id,languages_id)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table record_company_info
--


--
-- Table structure for table reviews
--

DROP TABLE IF EXISTS reviews;
CREATE TABLE reviews (
reviews_id int(11) NOT NULL auto_increment,
products_id int(11) NOT NULL default '0',
customers_id int(11) default NULL,
customers_name varchar(64) NOT NULL default '',
reviews_rating int(1) default NULL,
date_added datetime default NULL,
last_modified datetime default NULL,
reviews_read int(5) NOT NULL default '0',
status int(1) NOT NULL default '1',
PRIMARY KEY  (reviews_id),
KEY idx_products_id_zen (products_id),
KEY idx_customers_id_zen (customers_id)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=ujis;

--
-- Dumping data for table reviews
--


--
-- Table structure for table reviews_description
--

DROP TABLE IF EXISTS reviews_description;
CREATE TABLE reviews_description (
reviews_id int(11) NOT NULL default '0',
languages_id int(11) NOT NULL default '0',
reviews_text text NOT NULL,
PRIMARY KEY  (reviews_id,languages_id)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table reviews_description
--


--
-- Table structure for table salemaker_sales
--

DROP TABLE IF EXISTS salemaker_sales;
CREATE TABLE salemaker_sales (
sale_id int(11) NOT NULL auto_increment,
sale_status tinyint(4) NOT NULL default '0',
sale_name varchar(30) NOT NULL default '',
sale_deduction_value decimal(15,4) NOT NULL default '0.0000',
sale_deduction_type tinyint(4) NOT NULL default '0',
sale_pricerange_from decimal(15,4) NOT NULL default '0.0000',
sale_pricerange_to decimal(15,4) NOT NULL default '0.0000',
sale_specials_condition tinyint(4) NOT NULL default '0',
sale_categories_selected text,
sale_categories_all text,
sale_date_start date NOT NULL default '0001-01-01',
sale_date_end date NOT NULL default '0001-01-01',
sale_date_added date NOT NULL default '0001-01-01',
sale_date_last_modified date NOT NULL default '0001-01-01',
sale_date_status_change date NOT NULL default '0001-01-01',
PRIMARY KEY  (sale_id),
KEY idx_sale_status_zen (sale_status)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=ujis;

--
-- Dumping data for table salemaker_sales
--


--
-- Table structure for table sessions
--

DROP TABLE IF EXISTS sessions;
CREATE TABLE sessions (
sesskey varchar(32) NOT NULL default '',
expiry int(11) unsigned NOT NULL default '0',
value text NOT NULL,
PRIMARY KEY  (sesskey)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table sessions
--


--
-- Table structure for table so_payment_types
--

DROP TABLE IF EXISTS so_payment_types;
CREATE TABLE so_payment_types (
payment_type_id int(11) NOT NULL auto_increment,
language_id int(11) NOT NULL default '1',
payment_type_code varchar(4) NOT NULL default '',
payment_type_full varchar(20) NOT NULL default '',
PRIMARY KEY  (payment_type_id),
UNIQUE KEY type_code (payment_type_code),
KEY type_code_2 (payment_type_code)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=ujis;

--
-- Dumping data for table so_payment_types
--


--
-- Table structure for table so_payments
--

DROP TABLE IF EXISTS so_payments;
CREATE TABLE so_payments (
payment_id int(11) NOT NULL auto_increment,
orders_id int(11) NOT NULL default '0',
payment_number varchar(32) NOT NULL default '',
payment_name varchar(40) NOT NULL default '',
payment_amount decimal(14,2) NOT NULL default '0.00',
payment_type varchar(20) NOT NULL default '',
date_posted datetime NOT NULL default '0000-00-00 00:00:00',
last_modified datetime NOT NULL default '0000-00-00 00:00:00',
purchase_order_id int(11) NOT NULL default '0',
PRIMARY KEY  (payment_id)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table so_payments
--


--
-- Table structure for table so_purchase_orders
--

DROP TABLE IF EXISTS so_purchase_orders;
CREATE TABLE so_purchase_orders (
purchase_order_id int(11) NOT NULL auto_increment,
orders_id int(11) NOT NULL default '0',
po_number varchar(32) default NULL,
date_posted datetime NOT NULL default '0000-00-00 00:00:00',
last_modified datetime NOT NULL default '0000-00-00 00:00:00',
PRIMARY KEY  (purchase_order_id)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table so_purchase_orders
--


--
-- Table structure for table so_refunds
--

DROP TABLE IF EXISTS so_refunds;
CREATE TABLE so_refunds (
refund_id int(11) NOT NULL auto_increment,
payment_id int(11) NOT NULL default '0',
orders_id int(11) NOT NULL default '0',
refund_number varchar(32) NOT NULL default '',
refund_name varchar(40) NOT NULL default '',
refund_amount decimal(14,2) NOT NULL default '0.00',
refund_type varchar(4) NOT NULL default 'CK',
date_posted datetime NOT NULL default '0000-00-00 00:00:00',
last_modified datetime NOT NULL default '0000-00-00 00:00:00',
PRIMARY KEY  (refund_id),
KEY refund_id (refund_id)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table so_refunds
--


--
-- Table structure for table specials
--

DROP TABLE IF EXISTS specials;
CREATE TABLE specials (
specials_id int(11) NOT NULL auto_increment,
products_id int(11) NOT NULL default '0',
specials_new_products_price decimal(15,4) NOT NULL default '0.0000',
specials_date_added datetime default NULL,
specials_last_modified datetime default NULL,
expires_date date NOT NULL default '0001-01-01',
date_status_change datetime default NULL,
status int(1) NOT NULL default '1',
specials_date_available date NOT NULL default '0001-01-01',
PRIMARY KEY  (specials_id),
KEY idx_status_zen (status),
KEY idx_products_id_zen (products_id),
KEY idx_date_avail_zen (specials_date_available)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=ujis;

--
-- Dumping data for table specials
--


--
-- Table structure for table tax_class
--

DROP TABLE IF EXISTS tax_class;
CREATE TABLE tax_class (
tax_class_id int(11) NOT NULL auto_increment,
tax_class_title varchar(32) NOT NULL default '',
tax_class_description varchar(255) NOT NULL default '',
last_modified datetime default NULL,
date_added datetime NOT NULL default '0001-01-01 00:00:00',
PRIMARY KEY  (tax_class_id)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=ujis;

--
-- Dumping data for table tax_class
--

INSERT INTO tax_class VALUES (1,'消費税','消費税（日本）','2007-01-15 11:43:40','2004-01-21 01:35:29');

--
-- Table structure for table tax_class_m17n
--

DROP TABLE IF EXISTS tax_class_m17n;
CREATE TABLE tax_class_m17n (
tax_class_id int(11) NOT NULL default '0',
language_id int(11) NOT NULL default '0',
tax_class_title varchar(32) NOT NULL default '',
tax_class_description varchar(255) NOT NULL default '',
PRIMARY KEY  (tax_class_id,language_id)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table tax_class_m17n
--


--
-- Table structure for table tax_rates
--

DROP TABLE IF EXISTS tax_rates;
CREATE TABLE tax_rates (
tax_rates_id int(11) NOT NULL auto_increment,
tax_zone_id int(11) NOT NULL default '0',
tax_class_id int(11) NOT NULL default '0',
tax_priority int(5) default '1',
tax_rate decimal(7,4) NOT NULL default '0.0000',
tax_description varchar(255) NOT NULL default '',
last_modified datetime default NULL,
date_added datetime NOT NULL default '0001-01-01 00:00:00',
PRIMARY KEY  (tax_rates_id),
KEY idx_tax_zone_id_zen (tax_zone_id),
KEY idx_tax_class_id_zen (tax_class_id)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=ujis;

--
-- Dumping data for table tax_rates
--

INSERT INTO tax_rates VALUES (1,1,1,1,'5.0000','消費税：5%','2007-01-15 11:44:17','2006-11-29 16:18:40');

--
-- Table structure for table tax_rates_m17n
--

DROP TABLE IF EXISTS tax_rates_m17n;
CREATE TABLE tax_rates_m17n (
tax_rates_id int(11) NOT NULL default '0',
language_id int(11) NOT NULL default '0',
tax_description varchar(255) NOT NULL default '',
PRIMARY KEY  (tax_rates_id,language_id)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table tax_rates_m17n
--


--
-- Table structure for table template_select
--

DROP TABLE IF EXISTS template_select;
CREATE TABLE template_select (
template_id int(11) NOT NULL auto_increment,
template_dir varchar(64) NOT NULL default '',
template_language varchar(64) NOT NULL default '0',
PRIMARY KEY  (template_id),
KEY idx_tpl_lang_zen (template_language)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=ujis;

--
-- Dumping data for table template_select
--

INSERT INTO template_select VALUES (1,'sugudeki','0');
INSERT INTO template_select VALUES (8,'zen_mobile','9');

--
-- Table structure for table upgrade_exceptions
--

DROP TABLE IF EXISTS upgrade_exceptions;
CREATE TABLE upgrade_exceptions (
upgrade_exception_id smallint(5) NOT NULL auto_increment,
sql_file varchar(50) default NULL,
reason varchar(200) default NULL,
errordate datetime default '0001-01-01 00:00:00',
sqlstatement text,
PRIMARY KEY  (upgrade_exception_id)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=ujis;

--
-- Dumping data for table upgrade_exceptions
--


--
-- Table structure for table visitors
--

DROP TABLE IF EXISTS visitors;
CREATE TABLE visitors (
visitors_id int(11) NOT NULL default '0',
visitors_email_address varchar(96) NOT NULL default '',
visitors_info_date_account_created datetime default NULL,
visitors_info_date_account_last_modified datetime default NULL,
PRIMARY KEY  (visitors_id),
KEY IDX_visitors_email_address (visitors_email_address)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table visitors
--


--
-- Table structure for table visitors_orders
--

DROP TABLE IF EXISTS visitors_orders;
CREATE TABLE visitors_orders (
orders_id int(11) NOT NULL default '0',
visitors_id int(11) NOT NULL default '0',
last_modified datetime default NULL,
date_purchased datetime default NULL,
PRIMARY KEY  (orders_id),
KEY IDX_visitors_id (visitors_id)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table visitors_orders
--


--
-- Table structure for table whos_online
--

DROP TABLE IF EXISTS whos_online;
CREATE TABLE whos_online (
customer_id int(11) default NULL,
full_name varchar(64) NOT NULL default '',
session_id varchar(128) NOT NULL default '',
ip_address varchar(15) NOT NULL default '',
time_entry varchar(14) NOT NULL default '',
time_last_click varchar(14) NOT NULL default '',
last_page_url varchar(255) NOT NULL default '',
host_address text NOT NULL,
user_agent varchar(255) NOT NULL default '',
KEY idx_ip_address_zen (ip_address),
KEY idx_session_id_zen (session_id),
KEY idx_customer_id_zen (customer_id),
KEY idx_time_entry_zen (time_entry),
KEY idx_time_last_click_zen (time_last_click),
KEY idx_last_page_url_zen (last_page_url)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table whos_online
--


--
-- Table structure for table zones
--

DROP TABLE IF EXISTS zones;
CREATE TABLE zones (
zone_id int(11) NOT NULL auto_increment,
zone_country_id int(11) NOT NULL default '0',
zone_code varchar(32) NOT NULL default '',
zone_name varchar(32) NOT NULL default '',
PRIMARY KEY  (zone_id)
) ENGINE=MyISAM AUTO_INCREMENT=229 DEFAULT CHARSET=ujis;

--
-- Dumping data for table zones
--

INSERT INTO zones VALUES (1,223,'AL','Alabama');
INSERT INTO zones VALUES (2,223,'AK','Alaska');
INSERT INTO zones VALUES (3,223,'AS','American Samoa');
INSERT INTO zones VALUES (4,223,'AZ','Arizona');
INSERT INTO zones VALUES (5,223,'AR','Arkansas');
INSERT INTO zones VALUES (6,223,'AF','Armed Forces Africa');
INSERT INTO zones VALUES (7,223,'AA','Armed Forces Americas');
INSERT INTO zones VALUES (8,223,'AC','Armed Forces Canada');
INSERT INTO zones VALUES (9,223,'AE','Armed Forces Europe');
INSERT INTO zones VALUES (10,223,'AM','Armed Forces Middle East');
INSERT INTO zones VALUES (11,223,'AP','Armed Forces Pacific');
INSERT INTO zones VALUES (12,223,'CA','California');
INSERT INTO zones VALUES (13,223,'CO','Colorado');
INSERT INTO zones VALUES (14,223,'CT','Connecticut');
INSERT INTO zones VALUES (15,223,'DE','Delaware');
INSERT INTO zones VALUES (16,223,'DC','District of Columbia');
INSERT INTO zones VALUES (17,223,'FM','Federated States Of Micronesia');
INSERT INTO zones VALUES (18,223,'FL','Florida');
INSERT INTO zones VALUES (19,223,'GA','Georgia');
INSERT INTO zones VALUES (20,223,'GU','Guam');
INSERT INTO zones VALUES (21,223,'HI','Hawaii');
INSERT INTO zones VALUES (22,223,'ID','Idaho');
INSERT INTO zones VALUES (23,223,'IL','Illinois');
INSERT INTO zones VALUES (24,223,'IN','Indiana');
INSERT INTO zones VALUES (25,223,'IA','Iowa');
INSERT INTO zones VALUES (26,223,'KS','Kansas');
INSERT INTO zones VALUES (27,223,'KY','Kentucky');
INSERT INTO zones VALUES (28,223,'LA','Louisiana');
INSERT INTO zones VALUES (29,223,'ME','Maine');
INSERT INTO zones VALUES (30,223,'MH','Marshall Islands');
INSERT INTO zones VALUES (31,223,'MD','Maryland');
INSERT INTO zones VALUES (32,223,'MA','Massachusetts');
INSERT INTO zones VALUES (33,223,'MI','Michigan');
INSERT INTO zones VALUES (34,223,'MN','Minnesota');
INSERT INTO zones VALUES (35,223,'MS','Mississippi');
INSERT INTO zones VALUES (36,223,'MO','Missouri');
INSERT INTO zones VALUES (37,223,'MT','Montana');
INSERT INTO zones VALUES (38,223,'NE','Nebraska');
INSERT INTO zones VALUES (39,223,'NV','Nevada');
INSERT INTO zones VALUES (40,223,'NH','New Hampshire');
INSERT INTO zones VALUES (41,223,'NJ','New Jersey');
INSERT INTO zones VALUES (42,223,'NM','New Mexico');
INSERT INTO zones VALUES (43,223,'NY','New York');
INSERT INTO zones VALUES (44,223,'NC','North Carolina');
INSERT INTO zones VALUES (45,223,'ND','North Dakota');
INSERT INTO zones VALUES (46,223,'MP','Northern Mariana Islands');
INSERT INTO zones VALUES (47,223,'OH','Ohio');
INSERT INTO zones VALUES (48,223,'OK','Oklahoma');
INSERT INTO zones VALUES (49,223,'OR','Oregon');
INSERT INTO zones VALUES (50,223,'PW','Palau');
INSERT INTO zones VALUES (51,223,'PA','Pennsylvania');
INSERT INTO zones VALUES (52,223,'PR','Puerto Rico');
INSERT INTO zones VALUES (53,223,'RI','Rhode Island');
INSERT INTO zones VALUES (54,223,'SC','South Carolina');
INSERT INTO zones VALUES (55,223,'SD','South Dakota');
INSERT INTO zones VALUES (56,223,'TN','Tennessee');
INSERT INTO zones VALUES (57,223,'TX','Texas');
INSERT INTO zones VALUES (58,223,'UT','Utah');
INSERT INTO zones VALUES (59,223,'VT','Vermont');
INSERT INTO zones VALUES (60,223,'VI','Virgin Islands');
INSERT INTO zones VALUES (61,223,'VA','Virginia');
INSERT INTO zones VALUES (62,223,'WA','Washington');
INSERT INTO zones VALUES (63,223,'WV','West Virginia');
INSERT INTO zones VALUES (64,223,'WI','Wisconsin');
INSERT INTO zones VALUES (65,223,'WY','Wyoming');
INSERT INTO zones VALUES (66,38,'AB','Alberta');
INSERT INTO zones VALUES (67,38,'BC','British Columbia');
INSERT INTO zones VALUES (68,38,'MB','Manitoba');
INSERT INTO zones VALUES (69,38,'NF','Newfoundland');
INSERT INTO zones VALUES (70,38,'NB','New Brunswick');
INSERT INTO zones VALUES (71,38,'NS','Nova Scotia');
INSERT INTO zones VALUES (72,38,'NT','Northwest Territories');
INSERT INTO zones VALUES (73,38,'NU','Nunavut');
INSERT INTO zones VALUES (74,38,'ON','Ontario');
INSERT INTO zones VALUES (75,38,'PE','Prince Edward Island');
INSERT INTO zones VALUES (76,38,'QC','Quebec');
INSERT INTO zones VALUES (77,38,'SK','Saskatchewan');
INSERT INTO zones VALUES (78,38,'YT','Yukon Territory');
INSERT INTO zones VALUES (79,81,'NDS','Niedersachsen');
INSERT INTO zones VALUES (80,81,'BAW','Baden-Wrttemberg');
INSERT INTO zones VALUES (81,81,'BAY','Bayern');
INSERT INTO zones VALUES (82,81,'BER','Berlin');
INSERT INTO zones VALUES (83,81,'BRG','Brandenburg');
INSERT INTO zones VALUES (84,81,'BRE','Bremen');
INSERT INTO zones VALUES (85,81,'HAM','Hamburg');
INSERT INTO zones VALUES (86,81,'HES','Hessen');
INSERT INTO zones VALUES (87,81,'MEC','Mecklenburg-Vorpommern');
INSERT INTO zones VALUES (88,81,'NRW','Nordrhein-Westfalen');
INSERT INTO zones VALUES (89,81,'RHE','Rheinland-Pfalz');
INSERT INTO zones VALUES (90,81,'SAR','Saarland');
INSERT INTO zones VALUES (91,81,'SAS','Sachsen');
INSERT INTO zones VALUES (92,81,'SAC','Sachsen-Anhalt');
INSERT INTO zones VALUES (93,81,'SCN','Schleswig-Holstein');
INSERT INTO zones VALUES (94,81,'THE','Thringen');
INSERT INTO zones VALUES (95,14,'WI','Wien');
INSERT INTO zones VALUES (96,14,'NO','Niedersterreich');
INSERT INTO zones VALUES (97,14,'OO','Obersterreich');
INSERT INTO zones VALUES (98,14,'SB','Salzburg');
INSERT INTO zones VALUES (99,14,'KN','Kten');
INSERT INTO zones VALUES (100,14,'ST','Steiermark');
INSERT INTO zones VALUES (101,14,'TI','Tirol');
INSERT INTO zones VALUES (102,14,'BL','Burgenland');
INSERT INTO zones VALUES (103,14,'VB','Voralberg');
INSERT INTO zones VALUES (104,204,'AG','Aargau');
INSERT INTO zones VALUES (105,204,'AI','Appenzell Innerrhoden');
INSERT INTO zones VALUES (106,204,'AR','Appenzell Ausserrhoden');
INSERT INTO zones VALUES (107,204,'BE','Bern');
INSERT INTO zones VALUES (108,204,'BL','Basel-Landschaft');
INSERT INTO zones VALUES (109,204,'BS','Basel-Stadt');
INSERT INTO zones VALUES (110,204,'FR','Freiburg');
INSERT INTO zones VALUES (111,204,'GE','Genf');
INSERT INTO zones VALUES (112,204,'GL','Glarus');
INSERT INTO zones VALUES (113,204,'JU','Graubnden');
INSERT INTO zones VALUES (114,204,'JU','Jura');
INSERT INTO zones VALUES (115,204,'LU','Luzern');
INSERT INTO zones VALUES (116,204,'NE','Neuenburg');
INSERT INTO zones VALUES (117,204,'NW','Nidwalden');
INSERT INTO zones VALUES (118,204,'OW','Obwalden');
INSERT INTO zones VALUES (119,204,'SG','St. Gallen');
INSERT INTO zones VALUES (120,204,'SH','Schaffhausen');
INSERT INTO zones VALUES (121,204,'SO','Solothurn');
INSERT INTO zones VALUES (122,204,'SZ','Schwyz');
INSERT INTO zones VALUES (123,204,'TG','Thurgau');
INSERT INTO zones VALUES (124,204,'TI','Tessin');
INSERT INTO zones VALUES (125,204,'UR','Uri');
INSERT INTO zones VALUES (126,204,'VD','Waadt');
INSERT INTO zones VALUES (127,204,'VS','Wallis');
INSERT INTO zones VALUES (128,204,'ZG','Zug');
INSERT INTO zones VALUES (129,204,'ZH','Zrich');
INSERT INTO zones VALUES (130,195,'A Corua','A Corua');
INSERT INTO zones VALUES (131,195,'Alava','Alava');
INSERT INTO zones VALUES (132,195,'Albacete','Albacete');
INSERT INTO zones VALUES (133,195,'Alicante','Alicante');
INSERT INTO zones VALUES (134,195,'Almeria','Almeria');
INSERT INTO zones VALUES (135,195,'Asturias','Asturias');
INSERT INTO zones VALUES (136,195,'Avila','Avila');
INSERT INTO zones VALUES (137,195,'Badajoz','Badajoz');
INSERT INTO zones VALUES (138,195,'Baleares','Baleares');
INSERT INTO zones VALUES (139,195,'Barcelona','Barcelona');
INSERT INTO zones VALUES (140,195,'Burgos','Burgos');
INSERT INTO zones VALUES (141,195,'Caceres','Caceres');
INSERT INTO zones VALUES (142,195,'Cadiz','Cadiz');
INSERT INTO zones VALUES (143,195,'Cantabria','Cantabria');
INSERT INTO zones VALUES (144,195,'Castellon','Castellon');
INSERT INTO zones VALUES (145,195,'Ceuta','Ceuta');
INSERT INTO zones VALUES (146,195,'Ciudad Real','Ciudad Real');
INSERT INTO zones VALUES (147,195,'Cordoba','Cordoba');
INSERT INTO zones VALUES (148,195,'Cuenca','Cuenca');
INSERT INTO zones VALUES (149,195,'Girona','Girona');
INSERT INTO zones VALUES (150,195,'Granada','Granada');
INSERT INTO zones VALUES (151,195,'Guadalajara','Guadalajara');
INSERT INTO zones VALUES (152,195,'Guipuzcoa','Guipuzcoa');
INSERT INTO zones VALUES (153,195,'Huelva','Huelva');
INSERT INTO zones VALUES (154,195,'Huesca','Huesca');
INSERT INTO zones VALUES (155,195,'Jaen','Jaen');
INSERT INTO zones VALUES (156,195,'La Rioja','La Rioja');
INSERT INTO zones VALUES (157,195,'Las Palmas','Las Palmas');
INSERT INTO zones VALUES (158,195,'Leon','Leon');
INSERT INTO zones VALUES (159,195,'Lleida','Lleida');
INSERT INTO zones VALUES (160,195,'Lugo','Lugo');
INSERT INTO zones VALUES (161,195,'Madrid','Madrid');
INSERT INTO zones VALUES (162,195,'Malaga','Malaga');
INSERT INTO zones VALUES (163,195,'Melilla','Melilla');
INSERT INTO zones VALUES (164,195,'Murcia','Murcia');
INSERT INTO zones VALUES (165,195,'Navarra','Navarra');
INSERT INTO zones VALUES (166,195,'Ourense','Ourense');
INSERT INTO zones VALUES (167,195,'Palencia','Palencia');
INSERT INTO zones VALUES (168,195,'Pontevedra','Pontevedra');
INSERT INTO zones VALUES (169,195,'Salamanca','Salamanca');
INSERT INTO zones VALUES (170,195,'Santa Cruz de Tenerife','Santa Cruz de Tenerife');
INSERT INTO zones VALUES (171,195,'Segovia','Segovia');
INSERT INTO zones VALUES (172,195,'Sevilla','Sevilla');
INSERT INTO zones VALUES (173,195,'Soria','Soria');
INSERT INTO zones VALUES (174,195,'Tarragona','Tarragona');
INSERT INTO zones VALUES (175,195,'Teruel','Teruel');
INSERT INTO zones VALUES (176,195,'Toledo','Toledo');
INSERT INTO zones VALUES (177,195,'Valencia','Valencia');
INSERT INTO zones VALUES (178,195,'Valladolid','Valladolid');
INSERT INTO zones VALUES (179,195,'Vizcaya','Vizcaya');
INSERT INTO zones VALUES (180,195,'Zamora','Zamora');
INSERT INTO zones VALUES (181,195,'Zaragoza','Zaragoza');
INSERT INTO zones VALUES (182,107,'北海道','北海道');
INSERT INTO zones VALUES (183,107,'青森県','青森県');
INSERT INTO zones VALUES (184,107,'岩手県','岩手県');
INSERT INTO zones VALUES (185,107,'宮城県','宮城県');
INSERT INTO zones VALUES (186,107,'秋田県','秋田県');
INSERT INTO zones VALUES (187,107,'山形県','山形県');
INSERT INTO zones VALUES (188,107,'福島県','福島県');
INSERT INTO zones VALUES (189,107,'茨城県','茨城県');
INSERT INTO zones VALUES (190,107,'栃木県','栃木県');
INSERT INTO zones VALUES (191,107,'群馬県','群馬県');
INSERT INTO zones VALUES (192,107,'埼玉県','埼玉県');
INSERT INTO zones VALUES (193,107,'千葉県','千葉県');
INSERT INTO zones VALUES (194,107,'東京都','東京都');
INSERT INTO zones VALUES (195,107,'神奈川県','神奈川県');
INSERT INTO zones VALUES (196,107,'新潟県','新潟県');
INSERT INTO zones VALUES (197,107,'富山県','富山県');
INSERT INTO zones VALUES (198,107,'石川県','石川県');
INSERT INTO zones VALUES (199,107,'福井県','福井県');
INSERT INTO zones VALUES (200,107,'山梨県','山梨県');
INSERT INTO zones VALUES (201,107,'長野県','長野県');
INSERT INTO zones VALUES (202,107,'岐阜県','岐阜県');
INSERT INTO zones VALUES (203,107,'静岡県','静岡県');
INSERT INTO zones VALUES (204,107,'愛知県','愛知県');
INSERT INTO zones VALUES (205,107,'三重県','三重県');
INSERT INTO zones VALUES (206,107,'滋賀県','滋賀県');
INSERT INTO zones VALUES (207,107,'京都府','京都府');
INSERT INTO zones VALUES (208,107,'大阪府','大阪府');
INSERT INTO zones VALUES (209,107,'兵庫県','兵庫県');
INSERT INTO zones VALUES (210,107,'奈良県','奈良県');
INSERT INTO zones VALUES (211,107,'和歌山県','和歌山県');
INSERT INTO zones VALUES (212,107,'鳥取県','鳥取県');
INSERT INTO zones VALUES (213,107,'島根県','島根県');
INSERT INTO zones VALUES (214,107,'岡山県','岡山県');
INSERT INTO zones VALUES (215,107,'広島県','広島県');
INSERT INTO zones VALUES (216,107,'山口県','山口県');
INSERT INTO zones VALUES (217,107,'徳島県','徳島県');
INSERT INTO zones VALUES (218,107,'香川県','香川県');
INSERT INTO zones VALUES (219,107,'愛媛県','愛媛県');
INSERT INTO zones VALUES (220,107,'高知県','高知県');
INSERT INTO zones VALUES (221,107,'福岡県','福岡県');
INSERT INTO zones VALUES (222,107,'佐賀県','佐賀県');
INSERT INTO zones VALUES (223,107,'長崎県','長崎県');
INSERT INTO zones VALUES (224,107,'熊本県','熊本県');
INSERT INTO zones VALUES (225,107,'大分県','大分県');
INSERT INTO zones VALUES (226,107,'宮崎県','宮崎県');
INSERT INTO zones VALUES (227,107,'鹿児島県','鹿児島県');
INSERT INTO zones VALUES (228,107,'沖縄県','沖縄県');

--
-- Table structure for table zones_m17n
--

DROP TABLE IF EXISTS zones_m17n;
CREATE TABLE zones_m17n (
zone_id int(11) NOT NULL default '0',
language_id int(11) NOT NULL default '0',
zone_name_m17n varchar(32) NOT NULL default '',
PRIMARY KEY  (zone_id,language_id)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

--
-- Dumping data for table zones_m17n
--


--
-- Table structure for table zones_to_geo_zones
--

DROP TABLE IF EXISTS zones_to_geo_zones;
CREATE TABLE zones_to_geo_zones (
association_id int(11) NOT NULL auto_increment,
zone_country_id int(11) NOT NULL default '0',
zone_id int(11) default NULL,
geo_zone_id int(11) default NULL,
last_modified datetime default NULL,
date_added datetime NOT NULL default '0001-01-01 00:00:00',
PRIMARY KEY  (association_id)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=ujis;

--
-- Dumping data for table zones_to_geo_zones
--

INSERT INTO zones_to_geo_zones VALUES (1,107,NULL,1,'2007-01-21 11:44:32','2006-11-29 16:18:40');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

