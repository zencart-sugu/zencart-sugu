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

INSERT INTO admin VALUES (1,'admin','hachiya@ark-web.jp','7e03013a85704ec8e867025932ee69cb:d6',1);

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
) ENGINE=MyISAM AUTO_INCREMENT=2445 DEFAULT CHARSET=ujis;


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
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=ujis;

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

INSERT INTO counter VALUES ('20091119',1898);

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
-- Table structure for table coupon_gv_customer
--

DROP TABLE IF EXISTS coupon_gv_customer;
CREATE TABLE coupon_gv_customer (
customer_id int(5) NOT NULL default '0',
amount decimal(20,4) NOT NULL default '0.0000',
PRIMARY KEY  (customer_id)
) ENGINE=MyISAM DEFAULT CHARSET=ujis;

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

INSERT INTO csv_format_columns VALUES (1,1,1001,1);
INSERT INTO csv_format_columns VALUES (2,1,1002,2);
INSERT INTO csv_format_columns VALUES (3,1,1003,3);
INSERT INTO csv_format_columns VALUES (4,1,1004,4);
INSERT INTO csv_format_columns VALUES (5,1,1005,5);
INSERT INTO csv_format_columns VALUES (6,1,1006,6);
INSERT INTO csv_format_columns VALUES (7,1,1007,7);
INSERT INTO csv_format_columns VALUES (8,1,1008,8);
INSERT INTO csv_format_columns VALUES (9,1,1009,9);
INSERT INTO csv_format_columns VALUES (10,1,1010,10);
INSERT INTO csv_format_columns VALUES (11,1,1011,11);
INSERT INTO csv_format_columns VALUES (12,1,1012,12);
INSERT INTO csv_format_columns VALUES (13,1,1013,13);
INSERT INTO csv_format_columns VALUES (14,1,1014,14);
INSERT INTO csv_format_columns VALUES (15,1,1015,15);
INSERT INTO csv_format_columns VALUES (16,1,1016,16);
INSERT INTO csv_format_columns VALUES (17,1,1017,17);
INSERT INTO csv_format_columns VALUES (18,1,1018,18);
INSERT INTO csv_format_columns VALUES (19,1,1019,19);
INSERT INTO csv_format_columns VALUES (20,1,1020,20);
INSERT INTO csv_format_columns VALUES (21,1,1021,21);
INSERT INTO csv_format_columns VALUES (22,1,1022,22);
INSERT INTO csv_format_columns VALUES (23,1,1023,23);
INSERT INTO csv_format_columns VALUES (24,1,1100,24);
INSERT INTO csv_format_columns VALUES (25,1,1101,25);
INSERT INTO csv_format_columns VALUES (26,1,1200,26);
INSERT INTO csv_format_columns VALUES (27,1,1201,27);
INSERT INTO csv_format_columns VALUES (28,1,1300,28);
INSERT INTO csv_format_columns VALUES (29,1,1301,29);
INSERT INTO csv_format_columns VALUES (30,1,1400,30);
INSERT INTO csv_format_columns VALUES (31,1,1401,31);
INSERT INTO csv_format_columns VALUES (32,1,1500,32);
INSERT INTO csv_format_columns VALUES (33,1,1501,33);
INSERT INTO csv_format_columns VALUES (34,1,1600,34);
INSERT INTO csv_format_columns VALUES (35,1,1601,35);
INSERT INTO csv_format_columns VALUES (36,1,1700,36);
INSERT INTO csv_format_columns VALUES (37,1,1701,37);
INSERT INTO csv_format_columns VALUES (38,1,1702,38);
INSERT INTO csv_format_columns VALUES (39,1,1703,39);
INSERT INTO csv_format_columns VALUES (40,1,1704,40);
INSERT INTO csv_format_columns VALUES (41,1,1706,41);
INSERT INTO csv_format_columns VALUES (42,1,1707,42);
INSERT INTO csv_format_columns VALUES (43,2,2000,1);
INSERT INTO csv_format_columns VALUES (44,2,2001,2);
INSERT INTO csv_format_columns VALUES (45,2,2050,3);
INSERT INTO csv_format_columns VALUES (46,2,2051,4);
INSERT INTO csv_format_columns VALUES (47,2,2100,5);
INSERT INTO csv_format_columns VALUES (48,2,2101,6);
INSERT INTO csv_format_columns VALUES (49,2,2150,7);
INSERT INTO csv_format_columns VALUES (50,2,2151,8);
INSERT INTO csv_format_columns VALUES (51,2,2200,9);
INSERT INTO csv_format_columns VALUES (52,2,2201,10);
INSERT INTO csv_format_columns VALUES (53,2,2250,11);
INSERT INTO csv_format_columns VALUES (54,2,2251,12);
INSERT INTO csv_format_columns VALUES (55,2,2300,13);
INSERT INTO csv_format_columns VALUES (56,2,2301,14);
INSERT INTO csv_format_columns VALUES (57,2,2350,15);
INSERT INTO csv_format_columns VALUES (58,2,2351,16);
INSERT INTO csv_format_columns VALUES (59,2,2400,17);
INSERT INTO csv_format_columns VALUES (60,2,2401,18);
INSERT INTO csv_format_columns VALUES (61,2,2450,19);
INSERT INTO csv_format_columns VALUES (62,2,2451,20);
INSERT INTO csv_format_columns VALUES (63,2,2500,21);
INSERT INTO csv_format_columns VALUES (64,2,2501,22);
INSERT INTO csv_format_columns VALUES (65,2,2600,23);
INSERT INTO csv_format_columns VALUES (66,2,2601,24);
INSERT INTO csv_format_columns VALUES (67,2,2602,25);
INSERT INTO csv_format_columns VALUES (68,2,2603,26);
INSERT INTO csv_format_columns VALUES (69,2,2650,27);
INSERT INTO csv_format_columns VALUES (70,2,2651,28);
INSERT INTO csv_format_columns VALUES (71,2,2700,29);
INSERT INTO csv_format_columns VALUES (72,2,2701,30);
INSERT INTO csv_format_columns VALUES (73,2,2750,31);
INSERT INTO csv_format_columns VALUES (74,2,2751,32);
INSERT INTO csv_format_columns VALUES (75,2,2800,33);
INSERT INTO csv_format_columns VALUES (76,2,2801,34);
INSERT INTO csv_format_columns VALUES (77,3,3000,1);
INSERT INTO csv_format_columns VALUES (78,3,3001,2);
INSERT INTO csv_format_columns VALUES (79,3,3050,3);
INSERT INTO csv_format_columns VALUES (80,3,3051,4);
INSERT INTO csv_format_columns VALUES (81,3,3100,5);
INSERT INTO csv_format_columns VALUES (82,3,3101,6);
INSERT INTO csv_format_columns VALUES (83,3,3102,7);
INSERT INTO csv_format_columns VALUES (84,3,3103,8);
INSERT INTO csv_format_columns VALUES (85,3,3104,9);
INSERT INTO csv_format_columns VALUES (86,3,3105,10);
INSERT INTO csv_format_columns VALUES (87,3,3106,11);
INSERT INTO csv_format_columns VALUES (88,3,3107,12);
INSERT INTO csv_format_columns VALUES (89,3,3108,13);
INSERT INTO csv_format_columns VALUES (90,3,3109,14);
INSERT INTO csv_format_columns VALUES (91,3,3110,15);
INSERT INTO csv_format_columns VALUES (92,3,3111,16);
INSERT INTO csv_format_columns VALUES (93,3,3112,17);
INSERT INTO csv_format_columns VALUES (94,3,3113,18);
INSERT INTO csv_format_columns VALUES (95,3,3114,19);

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

INSERT INTO csv_format_types VALUES (1,'商品マスタ');
INSERT INTO csv_format_types VALUES (2,'商品カテゴリ');
INSERT INTO csv_format_types VALUES (3,'商品オプション');

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

INSERT INTO csv_formats VALUES (1,1,'商品マスタ(全て)','2009-11-19 13:04:30','2009-11-19 13:04:30');
INSERT INTO csv_formats VALUES (2,2,'商品カテゴリ(全て)','2009-11-19 13:04:30','2009-11-19 13:04:30');
INSERT INTO csv_formats VALUES (3,3,'商品オプション(全て)','2009-11-19 13:04:30','2009-11-19 13:04:30');

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

INSERT INTO currencies_m17n VALUES (1,1,'$','');
INSERT INTO currencies_m17n VALUES (2,1,'','EUR');
INSERT INTO currencies_m17n VALUES (3,1,'','円');
INSERT INTO currencies_m17n VALUES (1,2,'$','');
INSERT INTO currencies_m17n VALUES (2,2,'','EUR');
INSERT INTO currencies_m17n VALUES (3,2,'','円');
INSERT INTO currencies_m17n VALUES (3,9,'','円');
INSERT INTO currencies_m17n VALUES (2,9,'','EUR');
INSERT INTO currencies_m17n VALUES (1,9,'$','');

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

INSERT INTO easy_admin_sub_menus VALUES (1,1,'顧客管理','customers.php',1);
INSERT INTO easy_admin_sub_menus VALUES (2,1,'注文管理','orders.php',2);
INSERT INTO easy_admin_sub_menus VALUES (3,2,'カテゴリ・商品の管理','categories.php',1);
INSERT INTO easy_admin_sub_menus VALUES (4,2,'商品価格の管理','products_price_manager.php',2);
INSERT INTO easy_admin_sub_menus VALUES (5,4,'管理者の設定','admin.php',1);
INSERT INTO easy_admin_sub_menus VALUES (6,4,'管理メニューの設定','addon_modules_admin.php?module=easy_admin',2);
INSERT INTO easy_admin_sub_menus VALUES (7,4,'追加モジュールの管理','addon_modules.php',3);

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

INSERT INTO easy_admin_top_menus VALUES (1,'注文・顧客管理',1,0);
INSERT INTO easy_admin_top_menus VALUES (2,'商品管理',1,0);
INSERT INTO easy_admin_top_menus VALUES (3,'コンテンツ管理',1,0);
INSERT INTO easy_admin_top_menus VALUES (4,'初期設定',0,0);
INSERT INTO easy_admin_top_menus VALUES (5,'その他',0,0);

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

INSERT INTO easy_design_colors VALUES (1,'template_default','maincolor','メインカラー','#f4f4f4');
INSERT INTO easy_design_colors VALUES (2,'template_default','subcolor','サブカラー','#ffffff');
INSERT INTO easy_design_colors VALUES (3,'classic','maincolor','メインカラー','#f4f4f4');
INSERT INTO easy_design_colors VALUES (4,'classic','subcolor','サブカラー','#ffffff');
INSERT INTO easy_design_colors VALUES (5,'sugudeki','maincolor','メインカラー','#FF6347');
INSERT INTO easy_design_colors VALUES (6,'addon_modules','maincolor','メインカラー','#f4f4f4');
INSERT INTO easy_design_colors VALUES (7,'addon_modules','subcolor','サブカラー','#ffffff');
INSERT INTO easy_design_colors VALUES (8,'zen_mobile','maincolor','メインカラー','#f4f4f4');
INSERT INTO easy_design_colors VALUES (9,'zen_mobile','subcolor','サブカラー','#ffffff');
INSERT INTO easy_design_colors VALUES (10,'accessible_and_usable','maincolor','メインカラー','#0203E9');
INSERT INTO easy_design_colors VALUES (11,'accessible_and_usable','subcolor','サブカラー','#DCDCDC');

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

INSERT INTO easy_design_languages VALUES (1,2,'EASY_DESIGN_TAGLINE','タグライン','ECサイトがすぐできる！',1);
INSERT INTO easy_design_languages VALUES (2,2,'EASY_DESIGN_KEY_COPYLIGHT','コピーライト','Zen-Cart すぐでき（る）パック',2);

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
INSERT INTO email_templates_description VALUES (4,2,'ご注文受付状況のお知らせ','[CUSTOMER_NAME] 様\r\n\r\nご利用ありがとうございます。\r\n[DATE_ORDERED]にご利用いただいた\r\nご注文受付番号：[ORDER_ID]の状況が変更されましたのでお知らせします。\r\n\r\nご注文についての情報は下記URLでご覧いただけます。\r\n[INVOICE_URL]\r\n\r\nよろしくお願いします。\r\n\r\n-----\r\nこのメールは当ショップに登録されたお客様に対してお送りしています。\r\nお心当たりが無いようでしたら大変お手数ですがメールにて\r\nxxxxxxx@example.org までご連絡ください。\r\n\r\n-----\r\nCopyright (c) XXXXXXXX Inc. All Rights Reserved','2010-07-20 17:45:11');
INSERT INTO email_templates_description VALUES (4,1,'Information of order situation','[CUSTOMER_NAME]\r\n\r\nThank you for use\r\n[DATE_ORDERED]\r\nOrder receipt number：[ORDER_ID]\r\n\r\nYou can see ordering information\r\n[INVOICE_URL]\r\n\r\n-----\r\nThis E-mail is sent to the customer registered in this shop.\r\nVery sorry to trouble you, but with mail when there is no mind hit\r\nxxxxxxx@example.org\r\n\r\n-----\r\nCopyright (c) XXXXXXXX Inc. All Rights Reserved','2010-07-20 17:45:11');
INSERT INTO email_templates_description VALUES (1,9,'[携帯版]ユーザー登録完了','ユーザー登録ありがとうございます。','2010-06-27 12:52:56');
INSERT INTO email_templates_description VALUES (2,9,'[携帯]注文完了','[CUSTOMER_NAME] 様\r\n\r\nご利用ありがとうございます。\r\nご注文内容は以下の通りです。\r\n\r\nご注文番号: [ORDER_ID]\r\nご注文日: [DATE_ORDERED]\r\n\r\n詳しくはこちら。\r\n[INVOICE_URL]','2010-06-27 12:52:25');
INSERT INTO email_templates_description VALUES (3,9,'ご注文ありがとうございます[ゲスト用]','注文確認書 from XXXXXXXX\r\n\r\n[CUSTOMER_NAME] 様\r\n\r\nご利用ありがとうございます。\r\nご注文内容は以下の通りです。\r\n------------------------------------------------------\r\nご注文番号: [ORDER_ID]\r\nご注文日: [DATE_ORDERED]\r\n\r\n[COMMENT]\r\n\r\n商品\r\n------------------------------------------------------\r\n[PRODUCTS_ORDERED]\r\n------------------------------------------------------\r\n[TOTALS]\r\n\r\nお届け先\r\n------------------------------------------------------\r\n[DELIVERY_ADDRESS]\r\n\r\n請求先住所\r\n------------------------------------------------------\r\n[BILLING_ADDRESS]\r\n\r\nお支払い方法\r\n------------------------------------------------------\r\n[PAYMENT_METHOD]\r\n\r\n\r\n-----\r\nこのメールは当ショップに登録されたお客様に対してお送りしています。\r\nお心当たりが無いようでしたら大変お手数ですがメールにて\r\nxxxxxxx@example.org までご連絡ください。\r\n\r\n-----\r\nCopyright (c) XXXXXXXX Inc. All Rights Reserved','0000-00-00 00:00:00');
INSERT INTO email_templates_description VALUES (4,9,'[携帯版]ご注文受付状況更新','[CUSTOMER_NAME] 様\r\n\r\nご利用ありがとうございます。\r\n[DATE_ORDERED]にご利用いただいた\r\nご注文受付番号：[ORDER_ID]の状況が変更されましたのでお知らせします。\r\n\r\nご注文についての情報は下記URLでご覧いただけます。\r\n[INVOICE_URL]\r\n\r\nよろしくお願いします。','2010-07-20 17:45:11');

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

INSERT INTO group_pricing_m17n VALUES (1,1,'10%割引');
INSERT INTO group_pricing_m17n VALUES (1,2,'10%割引');
INSERT INTO group_pricing_m17n VALUES (1,9,'10%割引');

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

INSERT INTO holidays VALUES (1,-1,1,1,-1,-1,0);
INSERT INTO holidays VALUES (2,-1,1,2,-1,-1,0);
INSERT INTO holidays VALUES (3,-1,1,3,-1,-1,0);
INSERT INTO holidays VALUES (4,-1,1,-1,1,2,0);
INSERT INTO holidays VALUES (5,-1,2,11,-1,-1,0);
INSERT INTO holidays VALUES (6,-1,4,29,-1,-1,0);
INSERT INTO holidays VALUES (7,-1,5,3,-1,-1,0);
INSERT INTO holidays VALUES (8,-1,5,4,-1,-1,0);
INSERT INTO holidays VALUES (9,-1,5,5,-1,-1,0);
INSERT INTO holidays VALUES (10,-1,7,-1,1,3,0);
INSERT INTO holidays VALUES (11,-1,9,-1,1,3,0);
INSERT INTO holidays VALUES (12,-1,10,-1,1,2,0);
INSERT INTO holidays VALUES (13,-1,11,3,-1,-1,0);
INSERT INTO holidays VALUES (14,-1,11,23,-1,-1,0);
INSERT INTO holidays VALUES (15,-1,12,23,-1,-1,0);
INSERT INTO holidays VALUES (16,-1,12,29,-1,-1,0);
INSERT INTO holidays VALUES (17,-1,12,30,-1,-1,0);
INSERT INTO holidays VALUES (18,-1,12,31,-1,-1,0);
INSERT INTO holidays VALUES (19,2009,3,20,-1,-1,0);
INSERT INTO holidays VALUES (20,2009,5,6,-1,-1,0);
INSERT INTO holidays VALUES (21,2009,9,22,-1,-1,0);
INSERT INTO holidays VALUES (22,2009,9,23,-1,-1,0);
INSERT INTO holidays VALUES (23,2010,3,21,-1,-1,0);
INSERT INTO holidays VALUES (24,2010,3,22,-1,-1,0);
INSERT INTO holidays VALUES (25,2010,9,23,-1,-1,0);

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

INSERT INTO products_with_attributes_stock VALUES (1,90,'319','Ｗ５００',10);

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

INSERT INTO products_xsell VALUES (1,9,15,1);
INSERT INTO products_xsell VALUES (2,9,16,2);
INSERT INTO products_xsell VALUES (3,9,35,3);
INSERT INTO products_xsell VALUES (4,9,36,4);

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

INSERT INTO sessions VALUES ('',1277612410,'initiated|b:1;customers_host_address|s:43:\"nttkyo894111.tkyo.nt.ftth.ppp.infoweb.ne.jp\";language|s:8:\"japanese\";languages_id|s:1:\"9\";languages_code|s:9:\"ja-mobile\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:1:{s:35:\"62:78e6a0b3768d7ebf276544913453c289\";a:1:{s:3:\"qty\";s:1:\"1\";}}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:0:{}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:14:\"116.83.144.111\";new_products_id_in_cart|s:35:\"62:78e6a0b3768d7ebf276544913453c289\";valid_to_checkout|b:1;cart_errors|s:0:\"\";last_secure_page|s:22:\"create_account_success\";customer_first_name|s:4:\"志田\";customer_last_name|s:4:\"裕樹\";customer_first_name_kana|s:4:\"シダ\";customer_last_name_kana|s:6:\"ユウキ\";customer_default_address_id|i:16;customer_country_id|s:3:\"107\";customer_zone_id|s:3:\"194\";customers_authorization|s:1:\"0\";');
INSERT INTO sessions VALUES ('ri34sv8gncupi48tv2cjpipmk2',1277612290,'initiated|b:1;customers_host_address|s:43:\"nttkyo894111.tkyo.nt.ftth.ppp.infoweb.ne.jp\";language|s:8:\"japanese\";languages_id|s:1:\"8\";languages_code|s:9:\"ja-mobile\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:1:{i:63;a:1:{s:3:\"qty\";s:1:\"1\";}}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:5:\"zenid\";s:26:\"bsuk88lf4r360aej4b733qprp6\";}s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:14:\"logout_confirm\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:5:\"zenid\";s:26:\"bsuk88lf4r360aej4b733qprp6\";}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:5:\"zenid\";s:26:\"bsuk88lf4r360aej4b733qprp6\";}s:4:\"post\";a:0:{}}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:14:\"116.83.144.111\";new_products_id_in_cart|s:2:\"63\";valid_to_checkout|b:1;cart_errors|s:0:\"\";last_secure_page|s:22:\"create_account_success\";customer_id|i:14;customer_first_name|s:4:\"志田\";customer_last_name|s:4:\"裕樹\";customer_first_name_kana|s:4:\"シダ\";customer_last_name_kana|s:6:\"ユウキ\";customer_default_address_id|i:15;customer_country_id|s:3:\"107\";customer_zone_id|s:3:\"194\";customers_authorization|s:1:\"0\";');
INSERT INTO sessions VALUES ('94128e157c062jedn6389io2n0',1277612461,'initiated|b:1;customers_host_address|s:43:\"nttkyo894111.tkyo.nt.ftth.ppp.infoweb.ne.jp\";language|s:8:\"japanese\";languages_id|s:1:\"9\";languages_code|s:9:\"ja-mobile\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:8:{i:0;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:2:{s:5:\"cPath\";s:4:\"1_16\";s:5:\"zenid\";s:26:\"bpte9qj9ujqm45a33ea5t4f233\";}s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:12:\"product_info\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:7:{s:5:\"zenid\";s:26:\"bpte9qj9ujqm45a33ea5t4f233\";s:5:\"cPath\";s:4:\"1_16\";s:11:\"products_id\";s:2:\"62\";s:17:\"number_of_uploads\";s:1:\"0\";s:6:\"action\";s:11:\"add_product\";s:2:\"id\";a:1:{i:2;s:1:\"9\";}s:13:\"cart_quantity\";s:1:\"1\";}s:4:\"post\";a:8:{s:5:\"zenid\";s:26:\"bpte9qj9ujqm45a33ea5t4f233\";s:9:\"main_page\";s:12:\"product_info\";s:5:\"cPath\";s:4:\"1_16\";s:11:\"products_id\";s:2:\"62\";s:17:\"number_of_uploads\";s:1:\"0\";s:6:\"action\";s:11:\"add_product\";s:2:\"id\";a:1:{i:2;s:1:\"9\";}s:13:\"cart_quantity\";s:1:\"1\";}}i:2;a:4:{s:4:\"page\";s:13:\"shopping_cart\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:4:{s:17:\"number_of_uploads\";s:1:\"0\";s:2:\"id\";s:5:\"Array\";s:13:\"cart_quantity\";s:1:\"1\";s:5:\"zenid\";s:26:\"bpte9qj9ujqm45a33ea5t4f233\";}s:4:\"post\";a:0:{}}i:3;a:4:{s:4:\"page\";s:17:\"checkout_shipping\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:5:{s:5:\"zenid\";s:26:\"89brl7qvk9b7jjk10m8kc42lm5\";s:6:\"action\";s:7:\"process\";s:8:\"shipping\";s:9:\"flat_flat\";s:15:\"yamato_timespec\";s:8:\"希望なし\";s:8:\"comments\";s:0:\"\";}s:4:\"post\";a:6:{s:5:\"zenid\";s:26:\"89brl7qvk9b7jjk10m8kc42lm5\";s:9:\"main_page\";s:17:\"checkout_shipping\";s:6:\"action\";s:7:\"process\";s:8:\"shipping\";s:9:\"flat_flat\";s:15:\"yamato_timespec\";s:8:\"希望なし\";s:8:\"comments\";s:0:\"\";}}i:4;a:4:{s:4:\"page\";s:16:\"checkout_payment\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:5:\"zenid\";s:26:\"sdo053v82o35v33gfcmlfj2fo1\";}s:4:\"post\";a:0:{}}i:5;a:4:{s:4:\"page\";s:21:\"checkout_confirmation\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:8:{s:5:\"zenid\";s:26:\"ssqdl9fafrqos6o7kpot1njj95\";s:14:\"dc_redeem_code\";s:0:\"\";s:8:\"cc_owner\";s:9:\"志田 裕樹\";s:9:\"cc_number\";s:0:\"\";s:16:\"cc_expires_month\";s:2:\"01\";s:15:\"cc_expires_year\";s:2:\"10\";s:7:\"payment\";s:3:\"cod\";s:8:\"comments\";s:0:\"\";}s:4:\"post\";a:9:{s:5:\"zenid\";s:26:\"ssqdl9fafrqos6o7kpot1njj95\";s:9:\"main_page\";s:21:\"checkout_confirmation\";s:14:\"dc_redeem_code\";s:0:\"\";s:8:\"cc_owner\";s:9:\"志田 裕樹\";s:9:\"cc_number\";s:0:\"\";s:16:\"cc_expires_month\";s:2:\"01\";s:15:\"cc_expires_year\";s:2:\"10\";s:7:\"payment\";s:3:\"cod\";s:8:\"comments\";s:0:\"\";}}i:6;a:4:{s:4:\"page\";s:16:\"checkout_process\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:5:\"zenid\";s:26:\"3qsna8frrft4t0eagv823c0pr1\";}s:4:\"post\";a:2:{s:5:\"zenid\";s:26:\"3qsna8frrft4t0eagv823c0pr1\";s:9:\"main_page\";s:16:\"checkout_process\";}}i:7;a:4:{s:4:\"page\";s:16:\"checkout_success\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:5:\"zenid\";s:26:\"lqm79ulkc092rvsd57cgitgj93\";}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:14:\"116.83.144.111\";new_products_id_in_cart|s:35:\"62:78e6a0b3768d7ebf276544913453c289\";valid_to_checkout|b:1;cart_errors|s:0:\"\";last_secure_page|s:16:\"checkout_success\";customer_id|s:2:\"15\";customer_default_address_id|s:2:\"16\";customers_authorization|s:1:\"0\";customer_first_name|s:4:\"志田\";customer_last_name|s:4:\"裕樹\";customer_country_id|s:3:\"107\";customer_zone_id|s:3:\"194\";cot_gv|b:0;cc_id|s:0:\"\";order_number_created|i:26;|s:7:\"c_ot_gv\";');
INSERT INTO sessions VALUES ('2vhonh4v6m8cv9u24tqa4hqjc0',1277614965,'initiated|b:1;securityToken|s:32:\"d3ec14b8463f58269870a61379a43791\";language|s:8:\"japanese\";languages_id|s:1:\"2\";selected_box|s:13:\"configuration\";');
INSERT INTO sessions VALUES ('9tgqpko9rgso4gjbfjbtc7gh54',1277614971,'initiated|b:1;securityToken|s:32:\"48f2c6913d40df170ac310e8d41eaae9\";language|s:8:\"japanese\";languages_id|s:1:\"2\";selected_box|s:13:\"configuration\";html_editor_preference_status|s:4:\"NONE\";admin_id|s:1:\"1\";');
INSERT INTO sessions VALUES ('tn4v2eb6bskqnt4lk87gkbcsi0',1277615328,'initiated|b:1;securityToken|s:32:\"50f86a5acde7159b4bdd4d7cb138ac9f\";language|s:8:\"japanese\";languages_id|s:1:\"2\";selected_box|s:13:\"configuration\";html_editor_preference_status|s:4:\"NONE\";admin_id|s:1:\"1\";messageToStack|s:0:\"\";');
INSERT INTO sessions VALUES ('kbgjnc73pjrd4rqrrle4g820t4',1277612605,'initiated|b:1;customers_host_address|s:43:\"nttkyo894111.tkyo.nt.ftth.ppp.infoweb.ne.jp\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:5:\"zenid\";s:26:\"bsuk88lf4r360aej4b733qprp6\";}s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:5:\"addon\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:2:{s:6:\"module\";s:15:\"email_templates\";s:2:\"id\";s:1:\"4\";}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:14:\"116.83.144.111\";');
INSERT INTO sessions VALUES ('9s5ar01hof6a5q0f9ks0dmr9i4',1277612429,'initiated|b:1;customers_host_address|s:43:\"nttkyo894111.tkyo.nt.ftth.ppp.infoweb.ne.jp\";language|s:8:\"japanese\";languages_id|s:1:\"9\";languages_code|s:9:\"ja-mobile\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:1:{s:35:\"62:78e6a0b3768d7ebf276544913453c289\";a:2:{s:3:\"qty\";i:1;s:10:\"attributes\";a:1:{i:2;s:1:\"9\";}}}s:5:\"total\";d:4725;s:6:\"weight\";d:0.25;s:6:\"cartID\";s:5:\"06851\";s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:5:{i:0;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:2:{s:5:\"cPath\";s:4:\"1_16\";s:5:\"zenid\";s:26:\"bpte9qj9ujqm45a33ea5t4f233\";}s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:12:\"product_info\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:7:{s:5:\"zenid\";s:26:\"bpte9qj9ujqm45a33ea5t4f233\";s:5:\"cPath\";s:4:\"1_16\";s:11:\"products_id\";s:2:\"62\";s:17:\"number_of_uploads\";s:1:\"0\";s:6:\"action\";s:11:\"add_product\";s:2:\"id\";a:1:{i:2;s:1:\"9\";}s:13:\"cart_quantity\";s:1:\"1\";}s:4:\"post\";a:8:{s:5:\"zenid\";s:26:\"bpte9qj9ujqm45a33ea5t4f233\";s:9:\"main_page\";s:12:\"product_info\";s:5:\"cPath\";s:4:\"1_16\";s:11:\"products_id\";s:2:\"62\";s:17:\"number_of_uploads\";s:1:\"0\";s:6:\"action\";s:11:\"add_product\";s:2:\"id\";a:1:{i:2;s:1:\"9\";}s:13:\"cart_quantity\";s:1:\"1\";}}i:2;a:4:{s:4:\"page\";s:13:\"shopping_cart\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:4:{s:17:\"number_of_uploads\";s:1:\"0\";s:2:\"id\";s:5:\"Array\";s:13:\"cart_quantity\";s:1:\"1\";s:5:\"zenid\";s:26:\"bpte9qj9ujqm45a33ea5t4f233\";}s:4:\"post\";a:0:{}}i:3;a:4:{s:4:\"page\";s:17:\"checkout_shipping\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:5:\"zenid\";s:26:\"bpte9qj9ujqm45a33ea5t4f233\";}s:4:\"post\";a:0:{}}i:4;a:4:{s:4:\"page\";s:5:\"login\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:5:\"zenid\";s:26:\"9s5ar01hof6a5q0f9ks0dmr9i4\";}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:4:{s:4:\"page\";s:17:\"checkout_shipping\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:5:\"zenid\";s:26:\"bpte9qj9ujqm45a33ea5t4f233\";}s:4:\"post\";a:0:{}}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:14:\"116.83.144.111\";new_products_id_in_cart|s:35:\"62:78e6a0b3768d7ebf276544913453c289\";valid_to_checkout|b:1;cart_errors|s:0:\"\";last_secure_page|s:17:\"checkout_shipping\";');
INSERT INTO sessions VALUES ('ek7kudp0bkev2u9jvhpbo6pud2',1277447044,'initiated|b:1;customers_host_address|s:11:\"pc109.local\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";s:8:\"physical\";s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.109\";payment|N;');
INSERT INTO sessions VALUES ('s5i64nkvd8f2l1qdmo110lrpj5',1277447739,'initiated|b:1;customers_host_address|s:11:\"pc109.local\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";s:8:\"physical\";s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.109\";customer_id|s:1:\"3\";customer_default_address_id|s:1:\"3\";customers_authorization|s:1:\"0\";customer_first_name|s:4:\"菱田\";customer_last_name|s:4:\"好美\";customer_country_id|s:3:\"107\";customer_zone_id|s:3:\"182\";valid_to_checkout|b:1;cart_errors|s:0:\"\";cot_gv|b:0;cot_subpoint|b:0;cc_id|s:0:\"\";order_number_created|i:18;|s:13:\"c_ot_addpoint\";new_products_id_in_cart|s:3:\"194\";');
INSERT INTO sessions VALUES ('3ope3g4tjl7jmonj8gh5k9boo6',1277576607,'initiated|b:1;customers_host_address|s:15:\"okra.ark-web.jp\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:1:{s:36:\"199:a5b8375ec4b65ef7f7a2d726f14dc364\";a:2:{s:3:\"qty\";i:1;s:10:\"attributes\";a:1:{i:12;i:39;}}}s:5:\"total\";d:14600;s:6:\"weight\";d:0.25;s:6:\"cartID\";s:5:\"46322\";s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:5:{i:0;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:12:\"product_info\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:3:{s:11:\"products_id\";s:3:\"199\";s:17:\"number_of_uploads\";s:1:\"0\";s:6:\"action\";s:11:\"add_product\";}s:4:\"post\";a:5:{s:13:\"cart_quantity\";s:1:\"1\";s:11:\"products_id\";s:3:\"199\";s:1:\"x\";s:2:\"31\";s:1:\"y\";s:1:\"7\";s:2:\"id\";a:1:{i:12;i:39;}}}i:2;a:4:{s:4:\"page\";s:13:\"shopping_cart\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:17:\"number_of_uploads\";s:1:\"0\";}s:4:\"post\";a:0:{}}i:3;a:4:{s:4:\"page\";s:17:\"checkout_shipping\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}i:4;a:4:{s:4:\"page\";s:5:\"login\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:6:\"action\";s:7:\"process\";}s:4:\"post\";a:4:{s:13:\"email_address\";s:5:\"admin\";s:8:\"password\";s:5:\"admin\";s:1:\"x\";s:2:\"27\";s:1:\"y\";s:2:\"12\";}}}s:8:\"snapshot\";a:4:{s:4:\"page\";s:17:\"checkout_shipping\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:12:\"192.168.0.77\";new_products_id_in_cart|s:36:\"199:a5b8375ec4b65ef7f7a2d726f14dc364\";valid_to_checkout|b:1;cart_errors|s:0:\"\";');
INSERT INTO sessions VALUES ('jj4edvegaaql920vs6o9ge0ec6',1277576617,'initiated|b:1;customers_host_address|s:15:\"okra.ark-web.jp\";cartID|N;cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:4:{s:36:\"199:a5b8375ec4b65ef7f7a2d726f14dc364\";a:2:{s:3:\"qty\";s:1:\"1\";s:10:\"attributes\";a:1:{i:12;s:2:\"39\";}}i:11;a:1:{s:3:\"qty\";s:1:\"1\";}s:35:\"64:5f8a454d7eac16f952537f1187838525\";a:2:{s:3:\"qty\";s:1:\"1\";s:10:\"attributes\";a:1:{i:1;s:1:\"3\";}}i:9;a:1:{s:3:\"qty\";s:1:\"1\";}}s:5:\"total\";d:28775;s:6:\"weight\";d:1;s:6:\"cartID\";N;s:12:\"content_type\";s:8:\"physical\";s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:5:{i:0;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:12:\"product_info\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:3:{s:11:\"products_id\";s:3:\"199\";s:17:\"number_of_uploads\";s:1:\"0\";s:6:\"action\";s:11:\"add_product\";}s:4:\"post\";a:5:{s:13:\"cart_quantity\";s:1:\"1\";s:11:\"products_id\";s:3:\"199\";s:1:\"x\";s:2:\"31\";s:1:\"y\";s:1:\"7\";s:2:\"id\";a:1:{i:12;i:39;}}}i:2;a:4:{s:4:\"page\";s:13:\"shopping_cart\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:17:\"number_of_uploads\";s:1:\"0\";}s:4:\"post\";a:0:{}}i:3;a:4:{s:4:\"page\";s:17:\"checkout_shipping\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:6:{s:6:\"action\";s:7:\"process\";s:8:\"shipping\";s:9:\"flat_flat\";s:15:\"yamato_timespec\";s:8:\"希望なし\";s:8:\"comments\";s:0:\"\";s:1:\"x\";s:2:\"58\";s:1:\"y\";s:2:\"27\";}}i:4;a:4:{s:4:\"page\";s:16:\"checkout_payment\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:12:\"192.168.0.77\";new_products_id_in_cart|s:36:\"199:a5b8375ec4b65ef7f7a2d726f14dc364\";valid_to_checkout|b:1;cart_errors|s:0:\"\";customer_id|s:1:\"4\";customer_default_address_id|s:1:\"5\";customers_authorization|s:1:\"0\";customer_first_name|s:4:\"志田\";customer_last_name|s:4:\"裕樹\";customer_country_id|s:3:\"107\";customer_zone_id|s:3:\"194\";sendto|s:1:\"5\";payment|N;shipping|a:4:{s:2:\"id\";s:9:\"flat_flat\";s:5:\"title\";s:8:\"定額料金\";s:4:\"cost\";s:4:\"5.00\";s:8:\"timespec\";N;}billto|s:1:\"5\";cot_gv|s:4:\"0.00\";');
INSERT INTO sessions VALUES ('phv1ucu8eothjlatq0q89esaq3',1277579805,'initiated|b:1;customers_host_address|s:15:\"okra.ark-web.jp\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:1:{i:92;a:1:{s:3:\"qty\";i:1;}}s:5:\"total\";d:0;s:6:\"weight\";i:0;s:6:\"cartID\";s:5:\"25364\";s:12:\"content_type\";s:8:\"physical\";s:18:\"free_shipping_item\";i:1;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";d:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:4:{s:4:\"page\";s:17:\"checkout_shipping\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:12:\"192.168.0.77\";new_products_id_in_cart|s:2:\"92\";valid_to_checkout|b:1;cart_errors|s:0:\"\";payment|N;');
INSERT INTO sessions VALUES ('k7l000qaqliq50dbo9aier8kk2',1277579837,'initiated|b:1;customers_host_address|s:15:\"okra.ark-web.jp\";cartID|N;cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:5:{s:36:\"199:a5b8375ec4b65ef7f7a2d726f14dc364\";a:2:{s:3:\"qty\";s:1:\"1\";s:10:\"attributes\";a:1:{i:12;s:2:\"39\";}}i:11;a:1:{s:3:\"qty\";s:1:\"1\";}s:35:\"64:5f8a454d7eac16f952537f1187838525\";a:2:{s:3:\"qty\";s:1:\"1\";s:10:\"attributes\";a:1:{i:1;s:1:\"3\";}}i:92;a:1:{s:3:\"qty\";s:1:\"1\";}i:9;a:1:{s:3:\"qty\";s:1:\"1\";}}s:5:\"total\";d:28775;s:6:\"weight\";d:1;s:6:\"cartID\";N;s:12:\"content_type\";s:8:\"physical\";s:18:\"free_shipping_item\";i:1;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";d:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:16:\"checkout_process\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:2:{s:12:\"btn_submit_x\";s:3:\"104\";s:12:\"btn_submit_y\";s:2:\"25\";}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:12:\"192.168.0.77\";new_products_id_in_cart|s:2:\"92\";valid_to_checkout|b:1;cart_errors|s:0:\"\";payment|s:3:\"cod\";customer_id|s:1:\"4\";customer_default_address_id|s:1:\"5\";customers_authorization|s:1:\"0\";customer_first_name|s:4:\"志田\";customer_last_name|s:4:\"裕樹\";customer_country_id|s:3:\"107\";customer_zone_id|s:3:\"194\";sendto|s:1:\"5\";shipping|a:4:{s:2:\"id\";s:13:\"yamato_yamato\";s:5:\"title\";s:37:\"ヤマト運輸(宅急便) (1 x 4kg) (宅急便)\";s:4:\"cost\";i:950;s:8:\"timespec\";s:8:\"希望なし\";}calendar_hope_delivery_day|s:8:\"07月01日\";calendar_hope_delivery_time|s:10:\"12時015時\";billto|s:1:\"5\";cot_gv|b:0;cot_subpoint|b:0;comments|s:0:\"\";cc_id|s:0:\"\";order_number_created|i:20;');
INSERT INTO sessions VALUES ('kpk7if74mmc5leuj4m296v7jf0',1277584251,'initiated|b:1;customers_host_address|s:15:\"okra.ark-web.jp\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:4:{i:0;a:4:{s:4:\"page\";s:6:\"logoff\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:5:\"cPath\";s:1:\"3\";}s:4:\"post\";a:0:{}}i:2;a:4:{s:4:\"page\";s:12:\"product_info\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:11:\"products_id\";s:2:\"54\";}s:4:\"post\";a:0:{}}i:3;a:4:{s:4:\"page\";s:5:\"login\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:12:\"192.168.0.77\";');
INSERT INTO sessions VALUES ('10cu7vlltn8lckd6nv90an78m7',1277585550,'initiated|b:1;customers_host_address|s:15:\"okra.ark-web.jp\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:6:\"logoff\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:12:\"192.168.0.77\";customer_id|i:13;customer_first_name|s:4:\"志田\";customer_last_name|s:4:\"裕樹\";customer_first_name_kana|s:4:\"シダ\";customer_last_name_kana|s:6:\"ユウキ\";customer_default_address_id|i:14;customer_country_id|s:3:\"107\";customer_zone_id|s:3:\"194\";customers_authorization|s:1:\"0\";new_products_id_in_cart|s:36:\"224:e21ef06698eb3286347a85479dd1e917\";valid_to_checkout|b:1;cart_errors|s:0:\"\";cot_gv|b:0;cc_id|s:0:\"\";order_number_created|i:24;|s:7:\"c_ot_gv\";');
INSERT INTO sessions VALUES ('j0fceufb9bvvln8r5u6loi8g01',1277586144,'initiated|b:1;customers_host_address|s:43:\"nttkyo894111.tkyo.nt.ftth.ppp.infoweb.ne.jp\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:12:\"product_info\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:3:{s:5:\"cPath\";s:4:\"3_12\";s:11:\"products_id\";s:2:\"43\";s:5:\"zenid\";s:26:\"97rlf0thh8m9begi2qt95o9kp5\";}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:14:\"116.83.144.111\";');
INSERT INTO sessions VALUES ('97rlf0thh8m9begi2qt95o9kp5',1277586191,'initiated|b:1;customers_host_address|s:43:\"nttkyo894111.tkyo.nt.ftth.ppp.infoweb.ne.jp\";language|s:8:\"japanese\";languages_id|s:1:\"3\";languages_code|s:9:\"ja-mobile\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:1:{i:50;a:1:{s:3:\"qty\";i:1;}}s:5:\"total\";d:4725;s:6:\"weight\";d:0.25;s:6:\"cartID\";s:5:\"79507\";s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:2:{s:5:\"cPath\";s:4:\"3_12\";s:5:\"zenid\";s:26:\"97rlf0thh8m9begi2qt95o9kp5\";}s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:12:\"product_info\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:3:{s:5:\"cPath\";s:4:\"3_12\";s:11:\"products_id\";s:2:\"43\";s:5:\"zenid\";s:26:\"97rlf0thh8m9begi2qt95o9kp5\";}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:14:\"116.83.144.111\";new_products_id_in_cart|s:2:\"50\";valid_to_checkout|b:1;cart_errors|s:0:\"\";');
INSERT INTO sessions VALUES ('2vkgivsb3qd7nj0baavgihqd16',1277589155,'initiated|b:1;securityToken|s:32:\"2ee45526082a5b4ed1195abee39025ec\";language|s:8:\"japanese\";languages_id|s:1:\"2\";selected_box|s:13:\"configuration\";');
INSERT INTO sessions VALUES ('r2ne67gv4m265hbl7s6fo01vn0',1277589224,'initiated|b:1;securityToken|s:32:\"d04cd3c1aa41cf6e939d95da72c00a32\";language|s:8:\"japanese\";languages_id|s:1:\"2\";selected_box|s:13:\"configuration\";html_editor_preference_status|s:4:\"NONE\";admin_id|s:1:\"1\";');
INSERT INTO sessions VALUES ('iplv04eu8e0ukqld1odml361l4',1277589326,'initiated|b:1;securityToken|s:32:\"53bbffcd2f431614cf48b4310670460e\";language|s:8:\"japanese\";languages_id|s:1:\"2\";selected_box|s:13:\"configuration\";');
INSERT INTO sessions VALUES ('ujm1cjjp1l7cjne6d6dajrd7q2',1277589326,'initiated|b:1;securityToken|s:32:\"70b5e636865dc184a6d2a779b7e5d0f7\";language|s:8:\"japanese\";languages_id|s:1:\"2\";selected_box|s:13:\"configuration\";html_editor_preference_status|s:4:\"NONE\";');
INSERT INTO sessions VALUES ('660lp9rf0mi4krnsojq9qnr1l4',1277589329,'initiated|b:1;securityToken|s:32:\"8d011ed63fe6a30ca3cf29ab6fb8939a\";language|s:8:\"japanese\";languages_id|s:1:\"2\";selected_box|s:13:\"configuration\";html_editor_preference_status|s:4:\"NONE\";admin_id|s:1:\"1\";');
INSERT INTO sessions VALUES ('b5gibb5c1eb077hmnp68d77gs1',1277589329,'initiated|b:1;securityToken|s:32:\"8a3b6617b1ea80c8527235aa271d254a\";language|s:8:\"japanese\";languages_id|s:1:\"2\";selected_box|s:13:\"configuration\";');
INSERT INTO sessions VALUES ('kutbqhcl40i644kjrst7057oi7',1277589342,'initiated|b:1;securityToken|s:32:\"0edf8e321c5ae57973a0b40982c87ddf\";language|s:8:\"japanese\";languages_id|s:1:\"2\";selected_box|s:13:\"configuration\";html_editor_preference_status|s:4:\"NONE\";admin_id|s:1:\"1\";');
INSERT INTO sessions VALUES ('ucqgu20dsq743lqbfq45hjf497',1277613792,'initiated|b:1;securityToken|s:32:\"854762d908b999bcf3c424f6abefc13f\";language|s:8:\"japanese\";languages_id|s:1:\"2\";selected_box|s:13:\"configuration\";html_editor_preference_status|s:4:\"NONE\";admin_id|s:1:\"1\";messageToStack|s:0:\"\";');
INSERT INTO sessions VALUES ('9hltqdhvtib6fei95j1bkr8bu7',1277610770,'initiated|b:1;customers_host_address|s:43:\"nttkyo894111.tkyo.nt.ftth.ppp.infoweb.ne.jp\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:12:\"product_info\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:3:{s:5:\"cPath\";s:4:\"3_12\";s:11:\"products_id\";s:2:\"43\";s:5:\"zenid\";s:26:\"97rlf0thh8m9begi2qt95o9kp5\";}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:14:\"116.83.144.111\";');
INSERT INTO sessions VALUES ('m18trp7q01smt4dr49feng4s94',1277610751,'initiated|b:1;customers_host_address|s:43:\"nttkyo894111.tkyo.nt.ftth.ppp.infoweb.ne.jp\";language|s:8:\"japanese\";languages_id|s:1:\"8\";languages_code|s:9:\"ja-mobile\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":8:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:12:\"product_info\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:3:{s:5:\"cPath\";s:4:\"3_12\";s:11:\"products_id\";s:2:\"43\";s:5:\"zenid\";s:26:\"97rlf0thh8m9begi2qt95o9kp5\";}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:14:\"116.83.144.111\";');
INSERT INTO sessions VALUES ('jkago43toe153eeu1vg8miccv2',1277610758,'initiated|b:1;customers_host_address|s:43:\"nttkyo894111.tkyo.nt.ftth.ppp.infoweb.ne.jp\";language|s:8:\"japanese\";languages_id|s:1:\"8\";languages_code|s:9:\"ja-mobile\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":8:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:2:{s:5:\"cPath\";s:4:\"3_12\";s:5:\"zenid\";s:26:\"97rlf0thh8m9begi2qt95o9kp5\";}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:14:\"116.83.144.111\";');
INSERT INTO sessions VALUES ('iu75b88he4btollvp4k24dlk95',1277610758,'initiated|b:1;customers_host_address|s:43:\"nttkyo894111.tkyo.nt.ftth.ppp.infoweb.ne.jp\";language|s:8:\"japanese\";languages_id|s:1:\"8\";languages_code|s:9:\"ja-mobile\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":8:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:12:\"product_info\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:3:{s:5:\"cPath\";s:4:\"3_12\";s:11:\"products_id\";s:2:\"43\";s:5:\"zenid\";s:26:\"97rlf0thh8m9begi2qt95o9kp5\";}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:14:\"116.83.144.111\";');
INSERT INTO sessions VALUES ('7kd982j4loij1rk8otu1q8s957',1277610791,'initiated|b:1;customers_host_address|s:43:\"nttkyo894111.tkyo.nt.ftth.ppp.infoweb.ne.jp\";language|s:8:\"japanese\";languages_id|s:1:\"8\";languages_code|s:9:\"ja-mobile\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:1:{i:43;a:1:{s:3:\"qty\";i:1;}}s:5:\"total\";d:4725;s:6:\"weight\";d:0.25;s:6:\"cartID\";s:5:\"99072\";s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:17:\"checkout_shipping\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:5:\"zenid\";s:26:\"sl3s0qh7atsakd58kd65c2i175\";}s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:5:\"login\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:5:\"zenid\";s:26:\"7kd982j4loij1rk8otu1q8s957\";}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:4:{s:4:\"page\";s:17:\"checkout_shipping\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:5:\"zenid\";s:26:\"sl3s0qh7atsakd58kd65c2i175\";}s:4:\"post\";a:0:{}}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:14:\"116.83.144.111\";new_products_id_in_cart|s:2:\"43\";valid_to_checkout|b:1;cart_errors|s:0:\"\";last_secure_page|s:17:\"checkout_shipping\";');
INSERT INTO sessions VALUES ('pencg26emfbagb5sqm04i825o3',1277457035,'initiated|b:1;securityToken|s:32:\"eb1fa7667b20c12625d4a233e76b4a12\";language|s:8:\"japanese\";languages_id|s:1:\"2\";selected_box|s:13:\"configuration\";html_editor_preference_status|s:4:\"NONE\";admin_id|s:1:\"1\";messageToStack|s:0:\"\";');
INSERT INTO sessions VALUES ('78maq3kbeqgc64coom01ncm765',1277570881,'initiated|b:1;customers_host_address|s:15:\"okra.ark-web.jp\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":8:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:12:\"192.168.0.77\";');
INSERT INTO sessions VALUES ('pdpn49u0rkdnquov0a4caqble6',1277571757,'initiated|b:1;customers_host_address|s:15:\"okra.ark-web.jp\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:1:{i:9;a:1:{s:3:\"qty\";i:1;}}s:5:\"total\";d:4725;s:6:\"weight\";d:0.25;s:6:\"cartID\";s:5:\"35254\";s:12:\"content_type\";s:8:\"physical\";s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:4:{i:0;a:4:{s:4:\"page\";s:22:\"advanced_search_result\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:10:{s:7:\"keyword\";s:8:\"びちっこ\";s:13:\"categories_id\";s:0:\"\";s:10:\"inc_subcat\";s:1:\"1\";s:16:\"manufacturers_id\";s:0:\"\";s:5:\"pfrom\";s:0:\"\";s:3:\"pto\";s:0:\"\";s:5:\"dfrom\";s:0:\"\";s:3:\"dto\";s:0:\"\";s:1:\"x\";s:1:\"0\";s:1:\"y\";s:1:\"0\";}s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:12:\"product_info\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:2:{s:11:\"products_id\";s:1:\"9\";s:6:\"action\";s:11:\"add_product\";}s:4:\"post\";a:4:{s:13:\"cart_quantity\";s:1:\"1\";s:11:\"products_id\";s:1:\"9\";s:1:\"x\";s:2:\"95\";s:1:\"y\";s:2:\"15\";}}i:2;a:4:{s:4:\"page\";s:13:\"shopping_cart\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}i:3;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:4:{s:4:\"page\";s:17:\"checkout_shipping\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:12:\"192.168.0.77\";new_products_id_in_cart|s:1:\"9\";valid_to_checkout|b:1;cart_errors|s:0:\"\";payment|N;');
INSERT INTO sessions VALUES ('unuesap4ttvj96c2bp2ati40k2',1277574185,'initiated|b:1;securityToken|s:32:\"f8e9028ff2e7626b8c1997a59b32c34c\";language|s:8:\"japanese\";languages_id|s:1:\"2\";selected_box|s:13:\"configuration\";html_editor_preference_status|s:4:\"NONE\";admin_id|s:1:\"1\";');
INSERT INTO sessions VALUES ('5ikabdk0n071jfjd19kjhcp372',1277571787,'initiated|b:1;customers_host_address|s:15:\"okra.ark-web.jp\";cartID|N;cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:3:{i:11;a:1:{s:3:\"qty\";s:1:\"1\";}s:35:\"64:5f8a454d7eac16f952537f1187838525\";a:2:{s:3:\"qty\";s:1:\"1\";s:10:\"attributes\";a:1:{i:1;s:1:\"3\";}}i:9;a:1:{s:3:\"qty\";s:1:\"1\";}}s:5:\"total\";d:14175;s:6:\"weight\";d:0.75;s:6:\"cartID\";N;s:12:\"content_type\";s:8:\"physical\";s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:5:{i:0;a:4:{s:4:\"page\";s:22:\"advanced_search_result\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:10:{s:7:\"keyword\";s:8:\"びちっこ\";s:13:\"categories_id\";s:0:\"\";s:10:\"inc_subcat\";s:1:\"1\";s:16:\"manufacturers_id\";s:0:\"\";s:5:\"pfrom\";s:0:\"\";s:3:\"pto\";s:0:\"\";s:5:\"dfrom\";s:0:\"\";s:3:\"dto\";s:0:\"\";s:1:\"x\";s:1:\"0\";s:1:\"y\";s:1:\"0\";}s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:12:\"product_info\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:2:{s:11:\"products_id\";s:1:\"9\";s:6:\"action\";s:11:\"add_product\";}s:4:\"post\";a:4:{s:13:\"cart_quantity\";s:1:\"1\";s:11:\"products_id\";s:1:\"9\";s:1:\"x\";s:2:\"95\";s:1:\"y\";s:2:\"15\";}}i:2;a:4:{s:4:\"page\";s:13:\"shopping_cart\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}i:3;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}i:4;a:4:{s:4:\"page\";s:16:\"checkout_process\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:2:{s:12:\"btn_submit_x\";s:3:\"121\";s:12:\"btn_submit_y\";s:2:\"13\";}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:12:\"192.168.0.77\";new_products_id_in_cart|s:1:\"9\";valid_to_checkout|b:1;cart_errors|s:0:\"\";payment|s:10:\"moneyorder\";customer_id|s:1:\"4\";customer_default_address_id|s:1:\"5\";customers_authorization|s:1:\"0\";customer_first_name|s:4:\"志田\";customer_last_name|s:4:\"裕樹\";customer_country_id|s:3:\"107\";customer_zone_id|s:3:\"194\";sendto|s:1:\"5\";shipping|a:4:{s:2:\"id\";s:9:\"flat_flat\";s:5:\"title\";s:8:\"定額料金\";s:4:\"cost\";s:4:\"5.00\";s:8:\"timespec\";N;}calendar_hope_delivery_day|s:10:\"最短で発送\";calendar_hope_delivery_time|s:10:\"指定しない\";billto|s:1:\"5\";cot_gv|b:0;cot_subpoint|b:0;comments|s:0:\"\";cc_id|s:0:\"\";order_number_created|i:19;');
INSERT INTO sessions VALUES ('rmj10lqunql1lpnarn313g03b7',1277588564,'initiated|b:1;securityToken|s:32:\"61cbf25850f17ff55a4379aaed0c5921\";language|s:8:\"japanese\";languages_id|s:1:\"2\";selected_box|s:13:\"configuration\";html_editor_preference_status|s:4:\"NONE\";admin_id|s:1:\"1\";messageToStack|s:0:\"\";categories_products_sort_order|s:1:\"0\";display_categories_dropdown|i:0;cot_gv|s:4:\"0.00\";cot_subpoint|s:1:\"0\";easy_admin_simplify_message|s:0:\"\";');
INSERT INTO sessions VALUES ('1fime8hqmhot90l9tm7f706016',1277582212,'initiated|b:1;customers_host_address|s:15:\"okra.ark-web.jp\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:1:{s:35:\"88:d35fdb7752dae9737fa0d654e6056779\";a:2:{s:3:\"qty\";i:1;s:10:\"attributes\";a:1:{i:11;i:36;}}}s:5:\"total\";d:210;s:6:\"weight\";i:0;s:6:\"cartID\";s:5:\"46055\";s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:1;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";d:210;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:5:{i:0;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:12:\"product_info\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:3:{s:11:\"products_id\";s:2:\"88\";s:17:\"number_of_uploads\";s:1:\"0\";s:6:\"action\";s:11:\"add_product\";}s:4:\"post\";a:5:{s:13:\"cart_quantity\";s:1:\"1\";s:11:\"products_id\";s:2:\"88\";s:1:\"x\";s:2:\"49\";s:1:\"y\";s:2:\"23\";s:2:\"id\";a:1:{i:11;i:36;}}}i:2;a:4:{s:4:\"page\";s:13:\"shopping_cart\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:17:\"number_of_uploads\";s:1:\"0\";}s:4:\"post\";a:0:{}}i:3;a:4:{s:4:\"page\";s:17:\"checkout_shipping\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}i:4;a:4:{s:4:\"page\";s:5:\"login\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:4:{s:4:\"page\";s:17:\"checkout_shipping\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:12:\"192.168.0.77\";new_products_id_in_cart|s:35:\"88:d35fdb7752dae9737fa0d654e6056779\";valid_to_checkout|b:1;cart_errors|s:0:\"\";');
INSERT INTO sessions VALUES ('6ft3e28oee0v3g09pjr2jm6qc7',1277612474,'initiated|b:1;customers_host_address|s:43:\"nttkyo894111.tkyo.nt.ftth.ppp.infoweb.ne.jp\";language|s:8:\"japanese\";languages_id|s:1:\"9\";languages_code|s:9:\"ja-mobile\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:20:\"account_history_info\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:2:{s:8:\"order_id\";s:2:\"26\";s:5:\"zenid\";s:26:\"lqm79ulkc092rvsd57cgitgj93\";}s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:5:\"login\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:5:\"zenid\";s:26:\"6ft3e28oee0v3g09pjr2jm6qc7\";}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:4:{s:4:\"page\";s:20:\"account_history_info\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:2:{s:8:\"order_id\";s:2:\"26\";s:5:\"zenid\";s:26:\"lqm79ulkc092rvsd57cgitgj93\";}s:4:\"post\";a:0:{}}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";currency|s:3:\"JPY\";last_secure_page|s:20:\"account_history_info\";session_counter|b:1;customers_ip_address|s:14:\"116.83.144.111\";');
INSERT INTO sessions VALUES ('ulvl26rbb4mrs6unqpvk0r92l0',1277612486,'initiated|b:1;customers_host_address|s:43:\"nttkyo894111.tkyo.nt.ftth.ppp.infoweb.ne.jp\";language|s:8:\"japanese\";languages_id|s:1:\"9\";languages_code|s:9:\"ja-mobile\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:20:\"account_history_info\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:2:{s:8:\"order_id\";s:2:\"26\";s:5:\"zenid\";s:26:\"a99vldrjju386q05qks8ehc291\";}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";currency|s:3:\"JPY\";last_secure_page|s:20:\"account_history_info\";session_counter|b:1;customers_ip_address|s:14:\"116.83.144.111\";customer_id|s:2:\"15\";customer_default_address_id|s:2:\"16\";customers_authorization|s:1:\"0\";customer_first_name|s:4:\"志田\";customer_last_name|s:4:\"裕樹\";customer_country_id|s:3:\"107\";customer_zone_id|s:3:\"194\";');
INSERT INTO sessions VALUES ('crq3chusm037r7qg4jb60jjep0',1277615557,'initiated|b:1;securityToken|s:32:\"bad39433c98b6d59ea780efc5cedab61\";language|s:8:\"japanese\";languages_id|s:1:\"2\";selected_box|s:13:\"configuration\";');
INSERT INTO sessions VALUES ('8bslftr66ncd7jv1opksddqpt6',1277618522,'initiated|b:1;securityToken|s:32:\"6e442fee47cdad482c44d4517bb071e5\";language|s:8:\"japanese\";languages_id|s:1:\"2\";selected_box|s:13:\"configuration\";html_editor_preference_status|s:4:\"NONE\";admin_id|s:1:\"1\";');
INSERT INTO sessions VALUES ('2s20qbo1p2p301vphk21gdg9e6',1277615465,'initiated|b:1;customers_host_address|s:43:\"nttkyo894111.tkyo.nt.ftth.ppp.infoweb.ne.jp\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:5:\"addon\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:3:{s:6:\"module\";s:15:\"email_templates\";s:2:\"id\";s:1:\"4\";s:8:\"order_id\";s:2:\"18\";}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:14:\"116.83.144.111\";');
INSERT INTO sessions VALUES ('0avlp0c89l21fpdv6u13obc6s4',1279265150,'initiated|b:1;customers_host_address|s:11:\"pc104.local\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.104\";');
INSERT INTO sessions VALUES ('uhvlkktibl5f38df2ihn01ift5',1279265787,'initiated|b:1;customers_host_address|s:11:\"pc109.local\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.109\";');
INSERT INTO sessions VALUES ('ilm070ksdq2s2kmsbah565e3h3',1279267404,'initiated|b:1;customers_host_address|s:11:\"pc109.local\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:14:\"create_account\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:22:{s:6:\"action\";s:7:\"process\";s:15:\"email_pref_html\";s:12:\"email_format\";s:13:\"email_address\";s:18:\"hishida@ark-web.jp\";s:8:\"password\";s:7:\"hishida\";s:12:\"confirmation\";s:7:\"hishida\";s:9:\"firstname\";s:4:\"菱田\";s:8:\"lastname\";s:4:\"好美\";s:14:\"firstname_kana\";s:6:\"ひしだ\";s:13:\"lastname_kana\";s:6:\"よしみ\";s:7:\"country\";s:3:\"107\";s:8:\"postcode\";s:8:\"061-3201\";s:5:\"state\";s:6:\"北海道\";s:4:\"city\";s:6:\"石狩市\";s:14:\"street_address\";s:15:\"花川南一条4-900\";s:7:\"company\";s:8:\"菱田商事\";s:9:\"telephone\";s:12:\"0133-66-9874\";s:3:\"fax\";s:12:\"0133-66-9874\";s:6:\"gender\";s:1:\"f\";s:3:\"dob\";s:10:\"1978/03/32\";s:18:\"privacy_conditions\";s:1:\"1\";s:1:\"x\";s:2:\"12\";s:1:\"y\";s:1:\"6\";}}i:1;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.109\";');
INSERT INTO sessions VALUES ('46gbltmn6d3idbn4qbc955cud1',1279265919,'initiated|b:1;customers_host_address|s:11:\"pc109.local\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:14:\"create_account\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.109\";');
INSERT INTO sessions VALUES ('kfdme9fj97boqgaa2779r0bae4',1279265943,'initiated|b:1;customers_host_address|s:11:\"pc109.local\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":8:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.109\";');
INSERT INTO sessions VALUES ('qf12neo635lrbso8gtt80k4vk1',1279265986,'initiated|b:1;customers_host_address|s:11:\"pc109.local\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:14:\"create_account\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.109\";');
INSERT INTO sessions VALUES ('kpmiqi327qf2bepvsmui73ppj6',1279265999,'initiated|b:1;customers_host_address|s:11:\"pc109.local\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:14:\"create_account\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.109\";');
INSERT INTO sessions VALUES ('7f60namdcf8d4msjg1tjiiqmd2',1279270080,'initiated|b:1;customers_host_address|s:11:\"pc109.local\";cartID|s:5:\"40974\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:1:{i:225;a:1:{s:3:\"qty\";s:1:\"2\";}}s:5:\"total\";d:10000;s:6:\"weight\";i:0;s:6:\"cartID\";s:5:\"40974\";s:12:\"content_type\";s:8:\"physical\";s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:3:{i:0;a:4:{s:4:\"page\";s:14:\"create_account\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:22:{s:6:\"action\";s:7:\"process\";s:15:\"email_pref_html\";s:12:\"email_format\";s:13:\"email_address\";s:18:\"hishida@ark-web.jp\";s:8:\"password\";s:7:\"hishida\";s:12:\"confirmation\";s:7:\"hishida\";s:9:\"firstname\";s:4:\"菱田\";s:8:\"lastname\";s:4:\"好美\";s:14:\"firstname_kana\";s:6:\"ひしだ\";s:13:\"lastname_kana\";s:6:\"よしみ\";s:7:\"country\";s:3:\"107\";s:8:\"postcode\";s:8:\"061-3201\";s:5:\"state\";s:6:\"北海道\";s:4:\"city\";s:6:\"石狩市\";s:14:\"street_address\";s:15:\"花川南一条4-900\";s:7:\"company\";s:8:\"菱田商事\";s:9:\"telephone\";s:12:\"0133-66-9874\";s:3:\"fax\";s:12:\"0133-66-9874\";s:6:\"gender\";s:1:\"f\";s:3:\"dob\";s:10:\"2000/02/29\";s:18:\"privacy_conditions\";s:1:\"1\";s:1:\"x\";s:2:\"41\";s:1:\"y\";s:1:\"8\";}}i:1;a:4:{s:4:\"page\";s:22:\"create_account_success\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}i:2;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.109\";customer_id|i:16;customer_first_name|s:4:\"菱田\";customer_last_name|s:4:\"好美\";customer_first_name_kana|s:6:\"ひしだ\";customer_last_name_kana|s:6:\"よしみ\";customer_default_address_id|i:17;customer_country_id|s:3:\"107\";customer_zone_id|s:3:\"182\";customers_authorization|s:1:\"0\";new_products_id_in_cart|s:3:\"225\";valid_to_checkout|b:1;cart_errors|s:0:\"\";addon_search_more_par_page|s:2:\"10\";addon_search_more_sort|s:3:\"20a\";cot_gv|i:0;cc_id|s:0:\"\";order_number_created|i:27;|s:7:\"c_ot_gv\";sendto|i:17;payment|s:10:\"moneyorder\";shipping|a:4:{s:2:\"id\";s:23:\"freeshipper_freeshipper\";s:5:\"title\";s:10:\"配送料無料\";s:4:\"cost\";i:0;s:8:\"timespec\";N;}calendar_hope_delivery_day|s:10:\"最短で発送\";calendar_hope_delivery_time|s:10:\"指定しない\";billto|i:17;comments|s:775:\"あのですね、質問なのですが・・・あのですね、質問なのですが・・・あのですね、質問なのですが・・・あのですね、質問なのですが・・・あのですね、質問なのですが・・・あのですね、質問なのですが\r\n★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaasssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss1233333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333\";');
INSERT INTO sessions VALUES ('6bdmuen7kmia0jpdlb1gfd8315',1279268432,'initiated|b:1;customers_host_address|s:11:\"pc109.local\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";s:8:\"physical\";s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:5:\"login\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.109\";payment|N;');
INSERT INTO sessions VALUES ('jd6ghi0b2kv2f20ki1m4hlsin2',1279269603,'initiated|b:1;customers_host_address|s:11:\"pc109.local\";cartID|N;cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:1:{i:225;a:1:{s:3:\"qty\";s:1:\"2\";}}s:5:\"total\";d:10000;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";s:8:\"physical\";s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:5:\"login\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:6:\"action\";s:7:\"process\";}s:4:\"post\";a:4:{s:13:\"email_address\";s:18:\"hishida@ark-web.jp\";s:8:\"password\";s:7:\"hishida\";s:1:\"x\";s:2:\"65\";s:1:\"y\";s:1:\"6\";}}i:1;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.109\";payment|s:10:\"moneyorder\";customer_id|s:2:\"16\";customer_default_address_id|s:2:\"17\";customers_authorization|s:1:\"0\";customer_first_name|s:4:\"菱田\";customer_last_name|s:4:\"好美\";customer_country_id|s:3:\"107\";customer_zone_id|s:3:\"182\";valid_to_checkout|b:1;cart_errors|s:0:\"\";sendto|s:2:\"17\";shipping|a:4:{s:2:\"id\";s:23:\"freeshipper_freeshipper\";s:5:\"title\";s:10:\"配送料無料\";s:4:\"cost\";i:0;s:8:\"timespec\";N;}calendar_hope_delivery_day|s:10:\"最短で発送\";calendar_hope_delivery_time|s:10:\"指定しない\";billto|s:2:\"17\";cot_gv|i:0;comments|s:775:\"あのですね、質問なのですが・・・あのですね、質問なのですが・・・あのですね、質問なのですが・・・あのですね、質問なのですが・・・あのですね、質問なのですが・・・あのですね、質問なのですが\r\n★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaasssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss1233333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333\";');
INSERT INTO sessions VALUES ('593k8jt89p4vn1oabqs8mk9r82',1279269242,'initiated|b:1;customers_host_address|s:11:\"pc109.local\";cartID|N;cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:1:{i:225;a:1:{s:3:\"qty\";s:1:\"2\";}}s:5:\"total\";d:10000;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";s:8:\"physical\";s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:5:\"login\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:6:\"action\";s:7:\"process\";}s:4:\"post\";a:4:{s:13:\"email_address\";s:18:\"hishida@ark-web.jp\";s:8:\"password\";s:7:\"hishida\";s:1:\"x\";s:1:\"0\";s:1:\"y\";s:1:\"0\";}}i:1;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.109\";payment|s:10:\"moneyorder\";customer_id|s:2:\"16\";customer_default_address_id|s:2:\"17\";customers_authorization|s:1:\"0\";customer_first_name|s:4:\"菱田\";customer_last_name|s:4:\"好美\";customer_country_id|s:3:\"107\";customer_zone_id|s:3:\"182\";valid_to_checkout|b:1;cart_errors|s:0:\"\";sendto|s:2:\"17\";shipping|a:4:{s:2:\"id\";s:23:\"freeshipper_freeshipper\";s:5:\"title\";s:10:\"配送料無料\";s:4:\"cost\";i:0;s:8:\"timespec\";N;}calendar_hope_delivery_day|s:10:\"最短で発送\";calendar_hope_delivery_time|s:10:\"指定しない\";comments|s:775:\"あのですね、質問なのですが・・・あのですね、質問なのですが・・・あのですね、質問なのですが・・・あのですね、質問なのですが・・・あのですね、質問なのですが・・・あのですね、質問なのですが\r\n★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaasssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss1233333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333\";billto|s:2:\"17\";cot_gv|i:0;');
INSERT INTO sessions VALUES ('hhlm8ej9kc8gf1o58hi2hqcdq3',1279269163,'initiated|b:1;customers_host_address|s:11:\"pc109.local\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";s:8:\"physical\";s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:5:\"login\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.109\";payment|N;');
INSERT INTO sessions VALUES ('f5rkk50sco7ku8hgbkupm3kgr3',1279270262,'initiated|b:1;customers_host_address|s:11:\"pc109.local\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:14:\"create_account\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.109\";');
INSERT INTO sessions VALUES ('3k17kqn0stkbl1mrsed6vna3p4',1279270269,'initiated|b:1;customers_host_address|s:11:\"pc109.local\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";s:8:\"physical\";s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:5:\"login\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.109\";payment|N;');
INSERT INTO sessions VALUES ('o7p1e1b3ko3cqd6e7sb2tritu3',1279270306,'initiated|b:1;customers_host_address|s:11:\"pc109.local\";cartID|N;cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:1:{i:225;a:1:{s:3:\"qty\";s:1:\"2\";}}s:5:\"total\";d:10000;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";s:8:\"physical\";s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:5:\"login\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:6:\"action\";s:7:\"process\";}s:4:\"post\";a:4:{s:13:\"email_address\";s:18:\"hishida@ark-web.jp\";s:8:\"password\";s:7:\"hishida\";s:1:\"x\";s:1:\"0\";s:1:\"y\";s:1:\"0\";}}i:1;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.109\";payment|s:10:\"moneyorder\";customer_id|s:2:\"16\";customer_default_address_id|s:2:\"17\";customers_authorization|s:1:\"0\";customer_first_name|s:4:\"菱田\";customer_last_name|s:4:\"好美\";customer_country_id|s:3:\"107\";customer_zone_id|s:3:\"182\";valid_to_checkout|b:1;cart_errors|s:0:\"\";sendto|s:2:\"17\";shipping|a:4:{s:2:\"id\";s:23:\"freeshipper_freeshipper\";s:5:\"title\";s:10:\"配送料無料\";s:4:\"cost\";i:0;s:8:\"timespec\";N;}calendar_hope_delivery_day|s:10:\"最短で発送\";calendar_hope_delivery_time|s:10:\"指定しない\";comments|s:775:\"あのですね、質問なのですが・・・あのですね、質問なのですが・・・あのですね、質問なのですが・・・あのですね、質問なのですが・・・あのですね、質問なのですが・・・あのですね、質問なのですが\r\n★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaasssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss1233333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333\";billto|s:2:\"17\";cot_gv|i:0;');
INSERT INTO sessions VALUES ('7cm1cvnco96u6hagnphmcaejb2',1279604856,'initiated|b:1;customers_host_address|s:11:\"pc109.local\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:1:{i:89;a:1:{s:3:\"qty\";i:1;}}s:5:\"total\";d:210;s:6:\"weight\";i:0;s:6:\"cartID\";s:5:\"40495\";s:12:\"content_type\";s:7:\"virtual\";s:18:\"free_shipping_item\";i:1;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";d:210;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:4:{s:4:\"page\";s:17:\"checkout_shipping\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:0:{}s:4:\"post\";a:0:{}}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.109\";addon_search_more_par_page|s:2:\"10\";addon_search_more_sort|s:3:\"20a\";new_products_id_in_cart|s:2:\"89\";valid_to_checkout|b:1;cart_errors|s:0:\"\";payment|N;');
INSERT INTO sessions VALUES ('qp0uvdufa6fnt2csedof9djhj2',1279611563,'initiated|b:1;securityToken|s:32:\"9f2e27bc02ed63f5f76b1dc3325c7396\";language|s:8:\"japanese\";languages_id|s:1:\"2\";selected_box|s:13:\"configuration\";html_editor_preference_status|s:4:\"NONE\";admin_id|s:1:\"1\";categories_products_sort_order|s:1:\"0\";display_categories_dropdown|i:0;option_names_values_copier|s:1:\"1\";page_info|s:58:\"attribute_page=1&products_filter=89&current_category_id=27\";messageToStack|s:0:\"\";');
INSERT INTO sessions VALUES ('villsmp4emu9l6fmnva5utbou3',1279604845,'initiated|b:1;customers_host_address|s:11:\"pc109.local\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:2:{i:0;a:4:{s:4:\"page\";s:13:\"shopping_cart\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:1:{s:17:\"number_of_uploads\";s:1:\"0\";}s:4:\"post\";a:0:{}}i:1;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.109\";valid_to_checkout|b:1;cart_errors|s:0:\"\";');
INSERT INTO sessions VALUES ('mrjie5t6lhpcn3fhqp9394urp5',1279607743,'initiated|b:1;customers_host_address|s:11:\"pc109.local\";cartID|N;cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:1:{i:89;a:1:{s:3:\"qty\";s:1:\"1\";}}s:5:\"total\";d:210;s:6:\"weight\";i:0;s:6:\"cartID\";s:5:\"26608\";s:12:\"content_type\";s:5:\"mixed\";s:18:\"free_shipping_item\";i:1;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";d:210;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.109\";addon_search_more_par_page|s:2:\"10\";addon_search_more_sort|s:3:\"20a\";new_products_id_in_cart|s:2:\"19\";valid_to_checkout|b:1;cart_errors|s:0:\"\";payment|N;customer_id|s:2:\"16\";customer_default_address_id|s:2:\"17\";customers_authorization|s:1:\"0\";customer_first_name|s:4:\"菱田\";customer_last_name|s:4:\"好美\";customer_country_id|s:3:\"107\";customer_zone_id|s:3:\"182\";sendto|s:2:\"17\";shipping|a:4:{s:2:\"id\";s:23:\"freeshipper_freeshipper\";s:5:\"title\";s:13:\"配送料無料 ()\";s:4:\"cost\";i:0;s:6:\"module\";s:11:\"freeshipper\";}');
INSERT INTO sessions VALUES ('1k0j0s5t37p44q1v39ljbdt8h3',1279612748,'initiated|b:1;customers_host_address|s:11:\"pc104.local\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":8:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.104\";');
INSERT INTO sessions VALUES ('03hcbr7sv6prh1qua9vdbm51o3',1279620013,'initiated|b:1;securityToken|s:32:\"87db7fecd097b323e534c3d7056fc559\";language|s:8:\"japanese\";languages_id|s:1:\"2\";selected_box|s:5:\"tools\";html_editor_preference_status|s:4:\"NONE\";admin_id|s:1:\"1\";messageToStack|s:0:\"\";');
INSERT INTO sessions VALUES ('27arla5buurof9t7jm1i7rosd0',1279615838,'initiated|b:1;customers_host_address|s:11:\"pc104.local\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:5:\"addon\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";a:3:{s:6:\"module\";s:15:\"email_templates\";s:2:\"id\";s:1:\"4\";s:11:\"language_id\";s:1:\"2\";}s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.104\";');
INSERT INTO sessions VALUES ('qhevhu02q88ks5e96ugbk086s1',1279624699,'initiated|b:1;customers_host_address|s:11:\"pc104.local\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.104\";');
INSERT INTO sessions VALUES ('sl4inlcdm066vemlv3eeft60j2',1279674118,'initiated|b:1;customers_host_address|s:11:\"pc104.local\";cartID|s:0:\"\";cart|O:12:\"shoppingCart\":9:{s:8:\"contents\";a:0:{}s:5:\"total\";i:0;s:6:\"weight\";i:0;s:6:\"cartID\";N;s:12:\"content_type\";b:0;s:18:\"free_shipping_item\";i:0;s:20:\"free_shipping_weight\";i:0;s:19:\"free_shipping_price\";i:0;s:9:\"observers\";a:0:{}}navigation|O:17:\"navigationHistory\":3:{s:4:\"path\";a:1:{i:0;a:4:{s:4:\"page\";s:5:\"index\";s:4:\"mode\";s:6:\"NONSSL\";s:3:\"get\";s:0:\"\";s:4:\"post\";a:0:{}}}s:8:\"snapshot\";a:0:{}s:9:\"observers\";a:0:{}}check_valid|s:4:\"true\";language|s:8:\"japanese\";languages_id|s:1:\"2\";languages_code|s:2:\"ja\";currency|s:3:\"JPY\";session_counter|b:1;customers_ip_address|s:13:\"192.168.0.104\";');

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

INSERT INTO so_payment_types VALUES (1,1,'CA','Cash');
INSERT INTO so_payment_types VALUES (2,1,'CK','Check');
INSERT INTO so_payment_types VALUES (3,1,'MO','Money Order');
INSERT INTO so_payment_types VALUES (4,1,'ADJ','Adjustment');
INSERT INTO so_payment_types VALUES (5,1,'CC','Credit Card');
INSERT INTO so_payment_types VALUES (6,1,'MC','Master Card');
INSERT INTO so_payment_types VALUES (7,1,'VISA','Visa');
INSERT INTO so_payment_types VALUES (8,1,'AMEX','American Express');
INSERT INTO so_payment_types VALUES (9,1,'DISC','Discover');

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

INSERT INTO tax_class_m17n VALUES (1,1,'消費税','消費税（日本）');
INSERT INTO tax_class_m17n VALUES (1,2,'消費税','消費税（日本）');
INSERT INTO tax_class_m17n VALUES (1,9,'消費税','消費税（日本）');

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

INSERT INTO tax_rates_m17n VALUES (1,1,'消費税：5%');
INSERT INTO tax_rates_m17n VALUES (1,2,'消費税：5%');
INSERT INTO tax_rates_m17n VALUES (1,9,'消費税：5%');

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

INSERT INTO upgrade_exceptions VALUES (1,'mysql_zencart.sql','REASON_TABLE_NOT_FOUND CHECK PREFIXES!','2009-11-19 12:39:41','UPDATE query_builder SET query_name = \'全顧客\' WHERE query_id =1 LIMIT 1;');
INSERT INTO upgrade_exceptions VALUES (2,'mysql_zencart.sql','REASON_TABLE_NOT_FOUND CHECK PREFIXES!','2009-11-19 12:39:41','UPDATE query_builder SET query_name = \'メールマガジン希望者\' WHERE query_id =2 LIMIT 1;');
INSERT INTO upgrade_exceptions VALUES (3,'mysql_zencart.sql','REASON_TABLE_NOT_FOUND CHECK PREFIXES!','2009-11-19 12:39:41','UPDATE query_builder SET query_name = \'休眠顧客（過去三ヶ月間、配信希望者のみ）\' WHERE query_id =3 LIMIT 1;');
INSERT INTO upgrade_exceptions VALUES (4,'mysql_zencart.sql','REASON_TABLE_NOT_FOUND CHECK PREFIXES!','2009-11-19 12:39:41','UPDATE query_builder SET query_name = \'稼動顧客（過去三ヶ月間、配信希望者のみ）\' WHERE query_id =4 LIMIT 1;');
INSERT INTO upgrade_exceptions VALUES (5,'mysql_zencart.sql','REASON_TABLE_NOT_FOUND CHECK PREFIXES!','2009-11-19 12:39:41','UPDATE query_builder SET query_name = \'稼動顧客（過去三ヶ月間）\' WHERE query_id =5 LIMIT 1;');
INSERT INTO upgrade_exceptions VALUES (6,'mysql_zencart.sql','REASON_TABLE_NOT_FOUND CHECK PREFIXES!','2009-11-19 12:39:41','UPDATE query_builder SET query_name = \'管理者\' WHERE query_id =6 LIMIT 1;');

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

INSERT INTO zones_m17n VALUES (1,1,'Alabama');
INSERT INTO zones_m17n VALUES (2,1,'Alaska');
INSERT INTO zones_m17n VALUES (3,1,'American Samoa');
INSERT INTO zones_m17n VALUES (4,1,'Arizona');
INSERT INTO zones_m17n VALUES (5,1,'Arkansas');
INSERT INTO zones_m17n VALUES (6,1,'Armed Forces Africa');
INSERT INTO zones_m17n VALUES (7,1,'Armed Forces Americas');
INSERT INTO zones_m17n VALUES (8,1,'Armed Forces Canada');
INSERT INTO zones_m17n VALUES (9,1,'Armed Forces Europe');
INSERT INTO zones_m17n VALUES (10,1,'Armed Forces Middle East');
INSERT INTO zones_m17n VALUES (11,1,'Armed Forces Pacific');
INSERT INTO zones_m17n VALUES (12,1,'California');
INSERT INTO zones_m17n VALUES (13,1,'Colorado');
INSERT INTO zones_m17n VALUES (14,1,'Connecticut');
INSERT INTO zones_m17n VALUES (15,1,'Delaware');
INSERT INTO zones_m17n VALUES (16,1,'District of Columbia');
INSERT INTO zones_m17n VALUES (17,1,'Federated States Of Micronesia');
INSERT INTO zones_m17n VALUES (18,1,'Florida');
INSERT INTO zones_m17n VALUES (19,1,'Georgia');
INSERT INTO zones_m17n VALUES (20,1,'Guam');
INSERT INTO zones_m17n VALUES (21,1,'Hawaii');
INSERT INTO zones_m17n VALUES (22,1,'Idaho');
INSERT INTO zones_m17n VALUES (23,1,'Illinois');
INSERT INTO zones_m17n VALUES (24,1,'Indiana');
INSERT INTO zones_m17n VALUES (25,1,'Iowa');
INSERT INTO zones_m17n VALUES (26,1,'Kansas');
INSERT INTO zones_m17n VALUES (27,1,'Kentucky');
INSERT INTO zones_m17n VALUES (28,1,'Louisiana');
INSERT INTO zones_m17n VALUES (29,1,'Maine');
INSERT INTO zones_m17n VALUES (30,1,'Marshall Islands');
INSERT INTO zones_m17n VALUES (31,1,'Maryland');
INSERT INTO zones_m17n VALUES (32,1,'Massachusetts');
INSERT INTO zones_m17n VALUES (33,1,'Michigan');
INSERT INTO zones_m17n VALUES (34,1,'Minnesota');
INSERT INTO zones_m17n VALUES (35,1,'Mississippi');
INSERT INTO zones_m17n VALUES (36,1,'Missouri');
INSERT INTO zones_m17n VALUES (37,1,'Montana');
INSERT INTO zones_m17n VALUES (38,1,'Nebraska');
INSERT INTO zones_m17n VALUES (39,1,'Nevada');
INSERT INTO zones_m17n VALUES (40,1,'New Hampshire');
INSERT INTO zones_m17n VALUES (41,1,'New Jersey');
INSERT INTO zones_m17n VALUES (42,1,'New Mexico');
INSERT INTO zones_m17n VALUES (43,1,'New York');
INSERT INTO zones_m17n VALUES (44,1,'North Carolina');
INSERT INTO zones_m17n VALUES (45,1,'North Dakota');
INSERT INTO zones_m17n VALUES (46,1,'Northern Mariana Islands');
INSERT INTO zones_m17n VALUES (47,1,'Ohio');
INSERT INTO zones_m17n VALUES (48,1,'Oklahoma');
INSERT INTO zones_m17n VALUES (49,1,'Oregon');
INSERT INTO zones_m17n VALUES (50,1,'Palau');
INSERT INTO zones_m17n VALUES (51,1,'Pennsylvania');
INSERT INTO zones_m17n VALUES (52,1,'Puerto Rico');
INSERT INTO zones_m17n VALUES (53,1,'Rhode Island');
INSERT INTO zones_m17n VALUES (54,1,'South Carolina');
INSERT INTO zones_m17n VALUES (55,1,'South Dakota');
INSERT INTO zones_m17n VALUES (56,1,'Tennessee');
INSERT INTO zones_m17n VALUES (57,1,'Texas');
INSERT INTO zones_m17n VALUES (58,1,'Utah');
INSERT INTO zones_m17n VALUES (59,1,'Vermont');
INSERT INTO zones_m17n VALUES (60,1,'Virgin Islands');
INSERT INTO zones_m17n VALUES (61,1,'Virginia');
INSERT INTO zones_m17n VALUES (62,1,'Washington');
INSERT INTO zones_m17n VALUES (63,1,'West Virginia');
INSERT INTO zones_m17n VALUES (64,1,'Wisconsin');
INSERT INTO zones_m17n VALUES (65,1,'Wyoming');
INSERT INTO zones_m17n VALUES (66,1,'Alberta');
INSERT INTO zones_m17n VALUES (67,1,'British Columbia');
INSERT INTO zones_m17n VALUES (68,1,'Manitoba');
INSERT INTO zones_m17n VALUES (69,1,'Newfoundland');
INSERT INTO zones_m17n VALUES (70,1,'New Brunswick');
INSERT INTO zones_m17n VALUES (71,1,'Nova Scotia');
INSERT INTO zones_m17n VALUES (72,1,'Northwest Territories');
INSERT INTO zones_m17n VALUES (73,1,'Nunavut');
INSERT INTO zones_m17n VALUES (74,1,'Ontario');
INSERT INTO zones_m17n VALUES (75,1,'Prince Edward Island');
INSERT INTO zones_m17n VALUES (76,1,'Quebec');
INSERT INTO zones_m17n VALUES (77,1,'Saskatchewan');
INSERT INTO zones_m17n VALUES (78,1,'Yukon Territory');
INSERT INTO zones_m17n VALUES (79,1,'Niedersachsen');
INSERT INTO zones_m17n VALUES (80,1,'Baden-Wrttemberg');
INSERT INTO zones_m17n VALUES (81,1,'Bayern');
INSERT INTO zones_m17n VALUES (82,1,'Berlin');
INSERT INTO zones_m17n VALUES (83,1,'Brandenburg');
INSERT INTO zones_m17n VALUES (84,1,'Bremen');
INSERT INTO zones_m17n VALUES (85,1,'Hamburg');
INSERT INTO zones_m17n VALUES (86,1,'Hessen');
INSERT INTO zones_m17n VALUES (87,1,'Mecklenburg-Vorpommern');
INSERT INTO zones_m17n VALUES (88,1,'Nordrhein-Westfalen');
INSERT INTO zones_m17n VALUES (89,1,'Rheinland-Pfalz');
INSERT INTO zones_m17n VALUES (90,1,'Saarland');
INSERT INTO zones_m17n VALUES (91,1,'Sachsen');
INSERT INTO zones_m17n VALUES (92,1,'Sachsen-Anhalt');
INSERT INTO zones_m17n VALUES (93,1,'Schleswig-Holstein');
INSERT INTO zones_m17n VALUES (94,1,'Thringen');
INSERT INTO zones_m17n VALUES (95,1,'Wien');
INSERT INTO zones_m17n VALUES (96,1,'Niedersterreich');
INSERT INTO zones_m17n VALUES (97,1,'Obersterreich');
INSERT INTO zones_m17n VALUES (98,1,'Salzburg');
INSERT INTO zones_m17n VALUES (99,1,'Kten');
INSERT INTO zones_m17n VALUES (100,1,'Steiermark');
INSERT INTO zones_m17n VALUES (101,1,'Tirol');
INSERT INTO zones_m17n VALUES (102,1,'Burgenland');
INSERT INTO zones_m17n VALUES (103,1,'Voralberg');
INSERT INTO zones_m17n VALUES (104,1,'Aargau');
INSERT INTO zones_m17n VALUES (105,1,'Appenzell Innerrhoden');
INSERT INTO zones_m17n VALUES (106,1,'Appenzell Ausserrhoden');
INSERT INTO zones_m17n VALUES (107,1,'Bern');
INSERT INTO zones_m17n VALUES (108,1,'Basel-Landschaft');
INSERT INTO zones_m17n VALUES (109,1,'Basel-Stadt');
INSERT INTO zones_m17n VALUES (110,1,'Freiburg');
INSERT INTO zones_m17n VALUES (111,1,'Genf');
INSERT INTO zones_m17n VALUES (112,1,'Glarus');
INSERT INTO zones_m17n VALUES (113,1,'Graubnden');
INSERT INTO zones_m17n VALUES (114,1,'Jura');
INSERT INTO zones_m17n VALUES (115,1,'Luzern');
INSERT INTO zones_m17n VALUES (116,1,'Neuenburg');
INSERT INTO zones_m17n VALUES (117,1,'Nidwalden');
INSERT INTO zones_m17n VALUES (118,1,'Obwalden');
INSERT INTO zones_m17n VALUES (119,1,'St. Gallen');
INSERT INTO zones_m17n VALUES (120,1,'Schaffhausen');
INSERT INTO zones_m17n VALUES (121,1,'Solothurn');
INSERT INTO zones_m17n VALUES (122,1,'Schwyz');
INSERT INTO zones_m17n VALUES (123,1,'Thurgau');
INSERT INTO zones_m17n VALUES (124,1,'Tessin');
INSERT INTO zones_m17n VALUES (125,1,'Uri');
INSERT INTO zones_m17n VALUES (126,1,'Waadt');
INSERT INTO zones_m17n VALUES (127,1,'Wallis');
INSERT INTO zones_m17n VALUES (128,1,'Zug');
INSERT INTO zones_m17n VALUES (129,1,'Zrich');
INSERT INTO zones_m17n VALUES (130,1,'A Corua');
INSERT INTO zones_m17n VALUES (131,1,'Alava');
INSERT INTO zones_m17n VALUES (132,1,'Albacete');
INSERT INTO zones_m17n VALUES (133,1,'Alicante');
INSERT INTO zones_m17n VALUES (134,1,'Almeria');
INSERT INTO zones_m17n VALUES (135,1,'Asturias');
INSERT INTO zones_m17n VALUES (136,1,'Avila');
INSERT INTO zones_m17n VALUES (137,1,'Badajoz');
INSERT INTO zones_m17n VALUES (138,1,'Baleares');
INSERT INTO zones_m17n VALUES (139,1,'Barcelona');
INSERT INTO zones_m17n VALUES (140,1,'Burgos');
INSERT INTO zones_m17n VALUES (141,1,'Caceres');
INSERT INTO zones_m17n VALUES (142,1,'Cadiz');
INSERT INTO zones_m17n VALUES (143,1,'Cantabria');
INSERT INTO zones_m17n VALUES (144,1,'Castellon');
INSERT INTO zones_m17n VALUES (145,1,'Ceuta');
INSERT INTO zones_m17n VALUES (146,1,'Ciudad Real');
INSERT INTO zones_m17n VALUES (147,1,'Cordoba');
INSERT INTO zones_m17n VALUES (148,1,'Cuenca');
INSERT INTO zones_m17n VALUES (149,1,'Girona');
INSERT INTO zones_m17n VALUES (150,1,'Granada');
INSERT INTO zones_m17n VALUES (151,1,'Guadalajara');
INSERT INTO zones_m17n VALUES (152,1,'Guipuzcoa');
INSERT INTO zones_m17n VALUES (153,1,'Huelva');
INSERT INTO zones_m17n VALUES (154,1,'Huesca');
INSERT INTO zones_m17n VALUES (155,1,'Jaen');
INSERT INTO zones_m17n VALUES (156,1,'La Rioja');
INSERT INTO zones_m17n VALUES (157,1,'Las Palmas');
INSERT INTO zones_m17n VALUES (158,1,'Leon');
INSERT INTO zones_m17n VALUES (159,1,'Lleida');
INSERT INTO zones_m17n VALUES (160,1,'Lugo');
INSERT INTO zones_m17n VALUES (161,1,'Madrid');
INSERT INTO zones_m17n VALUES (162,1,'Malaga');
INSERT INTO zones_m17n VALUES (163,1,'Melilla');
INSERT INTO zones_m17n VALUES (164,1,'Murcia');
INSERT INTO zones_m17n VALUES (165,1,'Navarra');
INSERT INTO zones_m17n VALUES (166,1,'Ourense');
INSERT INTO zones_m17n VALUES (167,1,'Palencia');
INSERT INTO zones_m17n VALUES (168,1,'Pontevedra');
INSERT INTO zones_m17n VALUES (169,1,'Salamanca');
INSERT INTO zones_m17n VALUES (170,1,'Santa Cruz de Tenerife');
INSERT INTO zones_m17n VALUES (171,1,'Segovia');
INSERT INTO zones_m17n VALUES (172,1,'Sevilla');
INSERT INTO zones_m17n VALUES (173,1,'Soria');
INSERT INTO zones_m17n VALUES (174,1,'Tarragona');
INSERT INTO zones_m17n VALUES (175,1,'Teruel');
INSERT INTO zones_m17n VALUES (176,1,'Toledo');
INSERT INTO zones_m17n VALUES (177,1,'Valencia');
INSERT INTO zones_m17n VALUES (178,1,'Valladolid');
INSERT INTO zones_m17n VALUES (179,1,'Vizcaya');
INSERT INTO zones_m17n VALUES (180,1,'Zamora');
INSERT INTO zones_m17n VALUES (181,1,'Zaragoza');
INSERT INTO zones_m17n VALUES (182,1,'Hokkaido');
INSERT INTO zones_m17n VALUES (183,1,'Aomori');
INSERT INTO zones_m17n VALUES (184,1,'Iwate');
INSERT INTO zones_m17n VALUES (185,1,'Miyagi');
INSERT INTO zones_m17n VALUES (186,1,'Akita');
INSERT INTO zones_m17n VALUES (187,1,'Yamagata');
INSERT INTO zones_m17n VALUES (188,1,'Fukushima');
INSERT INTO zones_m17n VALUES (189,1,'Ibaragi');
INSERT INTO zones_m17n VALUES (190,1,'Tochigi');
INSERT INTO zones_m17n VALUES (191,1,'Gunma');
INSERT INTO zones_m17n VALUES (192,1,'Saitama');
INSERT INTO zones_m17n VALUES (193,1,'Chiba');
INSERT INTO zones_m17n VALUES (194,1,'Tokyo');
INSERT INTO zones_m17n VALUES (195,1,'Kanagama');
INSERT INTO zones_m17n VALUES (196,1,'Niigata');
INSERT INTO zones_m17n VALUES (197,1,'Toyama');
INSERT INTO zones_m17n VALUES (198,1,'Ishikawa');
INSERT INTO zones_m17n VALUES (199,1,'Fukui');
INSERT INTO zones_m17n VALUES (200,1,'Yamagata');
INSERT INTO zones_m17n VALUES (201,1,'Nagano');
INSERT INTO zones_m17n VALUES (202,1,'Gifu');
INSERT INTO zones_m17n VALUES (203,1,'Shizuoka');
INSERT INTO zones_m17n VALUES (204,1,'Aichu');
INSERT INTO zones_m17n VALUES (205,1,'Mie');
INSERT INTO zones_m17n VALUES (206,1,'Shiga');
INSERT INTO zones_m17n VALUES (207,1,'Kyoto');
INSERT INTO zones_m17n VALUES (208,1,'Osaka');
INSERT INTO zones_m17n VALUES (209,1,'Hyogo');
INSERT INTO zones_m17n VALUES (210,1,'Nara');
INSERT INTO zones_m17n VALUES (211,1,'Wakayama');
INSERT INTO zones_m17n VALUES (212,1,'Tottori');
INSERT INTO zones_m17n VALUES (213,1,'Shimane');
INSERT INTO zones_m17n VALUES (214,1,'Okayama');
INSERT INTO zones_m17n VALUES (215,1,'Hiroshima');
INSERT INTO zones_m17n VALUES (216,1,'Yamaguchi');
INSERT INTO zones_m17n VALUES (217,1,'Tokushima');
INSERT INTO zones_m17n VALUES (218,1,'Kagawa');
INSERT INTO zones_m17n VALUES (219,1,'Ehime');
INSERT INTO zones_m17n VALUES (220,1,'Kochi');
INSERT INTO zones_m17n VALUES (221,1,'Fukushima');
INSERT INTO zones_m17n VALUES (222,1,'Saga');
INSERT INTO zones_m17n VALUES (223,1,'Nagasaki');
INSERT INTO zones_m17n VALUES (224,1,'Kumamoto');
INSERT INTO zones_m17n VALUES (225,1,'Oita');
INSERT INTO zones_m17n VALUES (226,1,'Miyazaki');
INSERT INTO zones_m17n VALUES (227,1,'Kagoshima');
INSERT INTO zones_m17n VALUES (228,1,'Okinawa');
INSERT INTO zones_m17n VALUES (1,2,'Alabama');
INSERT INTO zones_m17n VALUES (2,2,'Alaska');
INSERT INTO zones_m17n VALUES (3,2,'American Samoa');
INSERT INTO zones_m17n VALUES (4,2,'Arizona');
INSERT INTO zones_m17n VALUES (5,2,'Arkansas');
INSERT INTO zones_m17n VALUES (6,2,'Armed Forces Africa');
INSERT INTO zones_m17n VALUES (7,2,'Armed Forces Americas');
INSERT INTO zones_m17n VALUES (8,2,'Armed Forces Canada');
INSERT INTO zones_m17n VALUES (9,2,'Armed Forces Europe');
INSERT INTO zones_m17n VALUES (10,2,'Armed Forces Middle East');
INSERT INTO zones_m17n VALUES (11,2,'Armed Forces Pacific');
INSERT INTO zones_m17n VALUES (12,2,'California');
INSERT INTO zones_m17n VALUES (13,2,'Colorado');
INSERT INTO zones_m17n VALUES (14,2,'Connecticut');
INSERT INTO zones_m17n VALUES (15,2,'Delaware');
INSERT INTO zones_m17n VALUES (16,2,'District of Columbia');
INSERT INTO zones_m17n VALUES (17,2,'Federated States Of Micronesia');
INSERT INTO zones_m17n VALUES (18,2,'Florida');
INSERT INTO zones_m17n VALUES (19,2,'Georgia');
INSERT INTO zones_m17n VALUES (20,2,'Guam');
INSERT INTO zones_m17n VALUES (21,2,'Hawaii');
INSERT INTO zones_m17n VALUES (22,2,'Idaho');
INSERT INTO zones_m17n VALUES (23,2,'Illinois');
INSERT INTO zones_m17n VALUES (24,2,'Indiana');
INSERT INTO zones_m17n VALUES (25,2,'Iowa');
INSERT INTO zones_m17n VALUES (26,2,'Kansas');
INSERT INTO zones_m17n VALUES (27,2,'Kentucky');
INSERT INTO zones_m17n VALUES (28,2,'Louisiana');
INSERT INTO zones_m17n VALUES (29,2,'Maine');
INSERT INTO zones_m17n VALUES (30,2,'Marshall Islands');
INSERT INTO zones_m17n VALUES (31,2,'Maryland');
INSERT INTO zones_m17n VALUES (32,2,'Massachusetts');
INSERT INTO zones_m17n VALUES (33,2,'Michigan');
INSERT INTO zones_m17n VALUES (34,2,'Minnesota');
INSERT INTO zones_m17n VALUES (35,2,'Mississippi');
INSERT INTO zones_m17n VALUES (36,2,'Missouri');
INSERT INTO zones_m17n VALUES (37,2,'Montana');
INSERT INTO zones_m17n VALUES (38,2,'Nebraska');
INSERT INTO zones_m17n VALUES (39,2,'Nevada');
INSERT INTO zones_m17n VALUES (40,2,'New Hampshire');
INSERT INTO zones_m17n VALUES (41,2,'New Jersey');
INSERT INTO zones_m17n VALUES (42,2,'New Mexico');
INSERT INTO zones_m17n VALUES (43,2,'New York');
INSERT INTO zones_m17n VALUES (44,2,'North Carolina');
INSERT INTO zones_m17n VALUES (45,2,'North Dakota');
INSERT INTO zones_m17n VALUES (46,2,'Northern Mariana Islands');
INSERT INTO zones_m17n VALUES (47,2,'Ohio');
INSERT INTO zones_m17n VALUES (48,2,'Oklahoma');
INSERT INTO zones_m17n VALUES (49,2,'Oregon');
INSERT INTO zones_m17n VALUES (50,2,'Palau');
INSERT INTO zones_m17n VALUES (51,2,'Pennsylvania');
INSERT INTO zones_m17n VALUES (52,2,'Puerto Rico');
INSERT INTO zones_m17n VALUES (53,2,'Rhode Island');
INSERT INTO zones_m17n VALUES (54,2,'South Carolina');
INSERT INTO zones_m17n VALUES (55,2,'South Dakota');
INSERT INTO zones_m17n VALUES (56,2,'Tennessee');
INSERT INTO zones_m17n VALUES (57,2,'Texas');
INSERT INTO zones_m17n VALUES (58,2,'Utah');
INSERT INTO zones_m17n VALUES (59,2,'Vermont');
INSERT INTO zones_m17n VALUES (60,2,'Virgin Islands');
INSERT INTO zones_m17n VALUES (61,2,'Virginia');
INSERT INTO zones_m17n VALUES (62,2,'Washington');
INSERT INTO zones_m17n VALUES (63,2,'West Virginia');
INSERT INTO zones_m17n VALUES (64,2,'Wisconsin');
INSERT INTO zones_m17n VALUES (65,2,'Wyoming');
INSERT INTO zones_m17n VALUES (66,2,'Alberta');
INSERT INTO zones_m17n VALUES (67,2,'British Columbia');
INSERT INTO zones_m17n VALUES (68,2,'Manitoba');
INSERT INTO zones_m17n VALUES (69,2,'Newfoundland');
INSERT INTO zones_m17n VALUES (70,2,'New Brunswick');
INSERT INTO zones_m17n VALUES (71,2,'Nova Scotia');
INSERT INTO zones_m17n VALUES (72,2,'Northwest Territories');
INSERT INTO zones_m17n VALUES (73,2,'Nunavut');
INSERT INTO zones_m17n VALUES (74,2,'Ontario');
INSERT INTO zones_m17n VALUES (75,2,'Prince Edward Island');
INSERT INTO zones_m17n VALUES (76,2,'Quebec');
INSERT INTO zones_m17n VALUES (77,2,'Saskatchewan');
INSERT INTO zones_m17n VALUES (78,2,'Yukon Territory');
INSERT INTO zones_m17n VALUES (79,2,'Niedersachsen');
INSERT INTO zones_m17n VALUES (80,2,'Baden-Wrttemberg');
INSERT INTO zones_m17n VALUES (81,2,'Bayern');
INSERT INTO zones_m17n VALUES (82,2,'Berlin');
INSERT INTO zones_m17n VALUES (83,2,'Brandenburg');
INSERT INTO zones_m17n VALUES (84,2,'Bremen');
INSERT INTO zones_m17n VALUES (85,2,'Hamburg');
INSERT INTO zones_m17n VALUES (86,2,'Hessen');
INSERT INTO zones_m17n VALUES (87,2,'Mecklenburg-Vorpommern');
INSERT INTO zones_m17n VALUES (88,2,'Nordrhein-Westfalen');
INSERT INTO zones_m17n VALUES (89,2,'Rheinland-Pfalz');
INSERT INTO zones_m17n VALUES (90,2,'Saarland');
INSERT INTO zones_m17n VALUES (91,2,'Sachsen');
INSERT INTO zones_m17n VALUES (92,2,'Sachsen-Anhalt');
INSERT INTO zones_m17n VALUES (93,2,'Schleswig-Holstein');
INSERT INTO zones_m17n VALUES (94,2,'Thringen');
INSERT INTO zones_m17n VALUES (95,2,'Wien');
INSERT INTO zones_m17n VALUES (96,2,'Niedersterreich');
INSERT INTO zones_m17n VALUES (97,2,'Obersterreich');
INSERT INTO zones_m17n VALUES (98,2,'Salzburg');
INSERT INTO zones_m17n VALUES (99,2,'Kten');
INSERT INTO zones_m17n VALUES (100,2,'Steiermark');
INSERT INTO zones_m17n VALUES (101,2,'Tirol');
INSERT INTO zones_m17n VALUES (102,2,'Burgenland');
INSERT INTO zones_m17n VALUES (103,2,'Voralberg');
INSERT INTO zones_m17n VALUES (104,2,'Aargau');
INSERT INTO zones_m17n VALUES (105,2,'Appenzell Innerrhoden');
INSERT INTO zones_m17n VALUES (106,2,'Appenzell Ausserrhoden');
INSERT INTO zones_m17n VALUES (107,2,'Bern');
INSERT INTO zones_m17n VALUES (108,2,'Basel-Landschaft');
INSERT INTO zones_m17n VALUES (109,2,'Basel-Stadt');
INSERT INTO zones_m17n VALUES (110,2,'Freiburg');
INSERT INTO zones_m17n VALUES (111,2,'Genf');
INSERT INTO zones_m17n VALUES (112,2,'Glarus');
INSERT INTO zones_m17n VALUES (113,2,'Graubnden');
INSERT INTO zones_m17n VALUES (114,2,'Jura');
INSERT INTO zones_m17n VALUES (115,2,'Luzern');
INSERT INTO zones_m17n VALUES (116,2,'Neuenburg');
INSERT INTO zones_m17n VALUES (117,2,'Nidwalden');
INSERT INTO zones_m17n VALUES (118,2,'Obwalden');
INSERT INTO zones_m17n VALUES (119,2,'St. Gallen');
INSERT INTO zones_m17n VALUES (120,2,'Schaffhausen');
INSERT INTO zones_m17n VALUES (121,2,'Solothurn');
INSERT INTO zones_m17n VALUES (122,2,'Schwyz');
INSERT INTO zones_m17n VALUES (123,2,'Thurgau');
INSERT INTO zones_m17n VALUES (124,2,'Tessin');
INSERT INTO zones_m17n VALUES (125,2,'Uri');
INSERT INTO zones_m17n VALUES (126,2,'Waadt');
INSERT INTO zones_m17n VALUES (127,2,'Wallis');
INSERT INTO zones_m17n VALUES (128,2,'Zug');
INSERT INTO zones_m17n VALUES (129,2,'Zrich');
INSERT INTO zones_m17n VALUES (130,2,'A Corua');
INSERT INTO zones_m17n VALUES (131,2,'Alava');
INSERT INTO zones_m17n VALUES (132,2,'Albacete');
INSERT INTO zones_m17n VALUES (133,2,'Alicante');
INSERT INTO zones_m17n VALUES (134,2,'Almeria');
INSERT INTO zones_m17n VALUES (135,2,'Asturias');
INSERT INTO zones_m17n VALUES (136,2,'Avila');
INSERT INTO zones_m17n VALUES (137,2,'Badajoz');
INSERT INTO zones_m17n VALUES (138,2,'Baleares');
INSERT INTO zones_m17n VALUES (139,2,'Barcelona');
INSERT INTO zones_m17n VALUES (140,2,'Burgos');
INSERT INTO zones_m17n VALUES (141,2,'Caceres');
INSERT INTO zones_m17n VALUES (142,2,'Cadiz');
INSERT INTO zones_m17n VALUES (143,2,'Cantabria');
INSERT INTO zones_m17n VALUES (144,2,'Castellon');
INSERT INTO zones_m17n VALUES (145,2,'Ceuta');
INSERT INTO zones_m17n VALUES (146,2,'Ciudad Real');
INSERT INTO zones_m17n VALUES (147,2,'Cordoba');
INSERT INTO zones_m17n VALUES (148,2,'Cuenca');
INSERT INTO zones_m17n VALUES (149,2,'Girona');
INSERT INTO zones_m17n VALUES (150,2,'Granada');
INSERT INTO zones_m17n VALUES (151,2,'Guadalajara');
INSERT INTO zones_m17n VALUES (152,2,'Guipuzcoa');
INSERT INTO zones_m17n VALUES (153,2,'Huelva');
INSERT INTO zones_m17n VALUES (154,2,'Huesca');
INSERT INTO zones_m17n VALUES (155,2,'Jaen');
INSERT INTO zones_m17n VALUES (156,2,'La Rioja');
INSERT INTO zones_m17n VALUES (157,2,'Las Palmas');
INSERT INTO zones_m17n VALUES (158,2,'Leon');
INSERT INTO zones_m17n VALUES (159,2,'Lleida');
INSERT INTO zones_m17n VALUES (160,2,'Lugo');
INSERT INTO zones_m17n VALUES (161,2,'Madrid');
INSERT INTO zones_m17n VALUES (162,2,'Malaga');
INSERT INTO zones_m17n VALUES (163,2,'Melilla');
INSERT INTO zones_m17n VALUES (164,2,'Murcia');
INSERT INTO zones_m17n VALUES (165,2,'Navarra');
INSERT INTO zones_m17n VALUES (166,2,'Ourense');
INSERT INTO zones_m17n VALUES (167,2,'Palencia');
INSERT INTO zones_m17n VALUES (168,2,'Pontevedra');
INSERT INTO zones_m17n VALUES (169,2,'Salamanca');
INSERT INTO zones_m17n VALUES (170,2,'Santa Cruz de Tenerife');
INSERT INTO zones_m17n VALUES (171,2,'Segovia');
INSERT INTO zones_m17n VALUES (172,2,'Sevilla');
INSERT INTO zones_m17n VALUES (173,2,'Soria');
INSERT INTO zones_m17n VALUES (174,2,'Tarragona');
INSERT INTO zones_m17n VALUES (175,2,'Teruel');
INSERT INTO zones_m17n VALUES (176,2,'Toledo');
INSERT INTO zones_m17n VALUES (177,2,'Valencia');
INSERT INTO zones_m17n VALUES (178,2,'Valladolid');
INSERT INTO zones_m17n VALUES (179,2,'Vizcaya');
INSERT INTO zones_m17n VALUES (180,2,'Zamora');
INSERT INTO zones_m17n VALUES (181,2,'Zaragoza');
INSERT INTO zones_m17n VALUES (182,2,'北海道');
INSERT INTO zones_m17n VALUES (183,2,'青森県');
INSERT INTO zones_m17n VALUES (184,2,'岩手県');
INSERT INTO zones_m17n VALUES (185,2,'宮城県');
INSERT INTO zones_m17n VALUES (186,2,'秋田県');
INSERT INTO zones_m17n VALUES (187,2,'山形県');
INSERT INTO zones_m17n VALUES (188,2,'福島県');
INSERT INTO zones_m17n VALUES (189,2,'茨城県');
INSERT INTO zones_m17n VALUES (190,2,'栃木県');
INSERT INTO zones_m17n VALUES (191,2,'群馬県');
INSERT INTO zones_m17n VALUES (192,2,'埼玉県');
INSERT INTO zones_m17n VALUES (193,2,'千葉県');
INSERT INTO zones_m17n VALUES (194,2,'東京都');
INSERT INTO zones_m17n VALUES (195,2,'神奈川県');
INSERT INTO zones_m17n VALUES (196,2,'新潟県');
INSERT INTO zones_m17n VALUES (197,2,'富山県');
INSERT INTO zones_m17n VALUES (198,2,'石川県');
INSERT INTO zones_m17n VALUES (199,2,'福井県');
INSERT INTO zones_m17n VALUES (200,2,'山梨県');
INSERT INTO zones_m17n VALUES (201,2,'長野県');
INSERT INTO zones_m17n VALUES (202,2,'岐阜県');
INSERT INTO zones_m17n VALUES (203,2,'静岡県');
INSERT INTO zones_m17n VALUES (204,2,'愛知県');
INSERT INTO zones_m17n VALUES (205,2,'三重県');
INSERT INTO zones_m17n VALUES (206,2,'滋賀県');
INSERT INTO zones_m17n VALUES (207,2,'京都府');
INSERT INTO zones_m17n VALUES (208,2,'大阪府');
INSERT INTO zones_m17n VALUES (209,2,'兵庫県');
INSERT INTO zones_m17n VALUES (210,2,'奈良県');
INSERT INTO zones_m17n VALUES (211,2,'和歌山県');
INSERT INTO zones_m17n VALUES (212,2,'鳥取県');
INSERT INTO zones_m17n VALUES (213,2,'島根県');
INSERT INTO zones_m17n VALUES (214,2,'岡山県');
INSERT INTO zones_m17n VALUES (215,2,'広島県');
INSERT INTO zones_m17n VALUES (216,2,'山口県');
INSERT INTO zones_m17n VALUES (217,2,'徳島県');
INSERT INTO zones_m17n VALUES (218,2,'香川県');
INSERT INTO zones_m17n VALUES (219,2,'愛媛県');
INSERT INTO zones_m17n VALUES (220,2,'高知県');
INSERT INTO zones_m17n VALUES (221,2,'福岡県');
INSERT INTO zones_m17n VALUES (222,2,'佐賀県');
INSERT INTO zones_m17n VALUES (223,2,'長崎県');
INSERT INTO zones_m17n VALUES (224,2,'熊本県');
INSERT INTO zones_m17n VALUES (225,2,'大分県');
INSERT INTO zones_m17n VALUES (226,2,'宮崎県');
INSERT INTO zones_m17n VALUES (227,2,'鹿児島県');
INSERT INTO zones_m17n VALUES (228,2,'沖縄県');
INSERT INTO zones_m17n VALUES (154,9,'Huesca');
INSERT INTO zones_m17n VALUES (153,9,'Huelva');
INSERT INTO zones_m17n VALUES (152,9,'Guipuzcoa');
INSERT INTO zones_m17n VALUES (151,9,'Guadalajara');
INSERT INTO zones_m17n VALUES (150,9,'Granada');
INSERT INTO zones_m17n VALUES (149,9,'Girona');
INSERT INTO zones_m17n VALUES (148,9,'Cuenca');
INSERT INTO zones_m17n VALUES (147,9,'Cordoba');
INSERT INTO zones_m17n VALUES (146,9,'Ciudad Real');
INSERT INTO zones_m17n VALUES (145,9,'Ceuta');
INSERT INTO zones_m17n VALUES (144,9,'Castellon');
INSERT INTO zones_m17n VALUES (143,9,'Cantabria');
INSERT INTO zones_m17n VALUES (142,9,'Cadiz');
INSERT INTO zones_m17n VALUES (141,9,'Caceres');
INSERT INTO zones_m17n VALUES (140,9,'Burgos');
INSERT INTO zones_m17n VALUES (139,9,'Barcelona');
INSERT INTO zones_m17n VALUES (138,9,'Baleares');
INSERT INTO zones_m17n VALUES (137,9,'Badajoz');
INSERT INTO zones_m17n VALUES (136,9,'Avila');
INSERT INTO zones_m17n VALUES (135,9,'Asturias');
INSERT INTO zones_m17n VALUES (134,9,'Almeria');
INSERT INTO zones_m17n VALUES (133,9,'Alicante');
INSERT INTO zones_m17n VALUES (132,9,'Albacete');
INSERT INTO zones_m17n VALUES (131,9,'Alava');
INSERT INTO zones_m17n VALUES (130,9,'A Corua');
INSERT INTO zones_m17n VALUES (129,9,'Zrich');
INSERT INTO zones_m17n VALUES (128,9,'Zug');
INSERT INTO zones_m17n VALUES (127,9,'Wallis');
INSERT INTO zones_m17n VALUES (126,9,'Waadt');
INSERT INTO zones_m17n VALUES (125,9,'Uri');
INSERT INTO zones_m17n VALUES (124,9,'Tessin');
INSERT INTO zones_m17n VALUES (123,9,'Thurgau');
INSERT INTO zones_m17n VALUES (122,9,'Schwyz');
INSERT INTO zones_m17n VALUES (121,9,'Solothurn');
INSERT INTO zones_m17n VALUES (120,9,'Schaffhausen');
INSERT INTO zones_m17n VALUES (119,9,'St. Gallen');
INSERT INTO zones_m17n VALUES (118,9,'Obwalden');
INSERT INTO zones_m17n VALUES (117,9,'Nidwalden');
INSERT INTO zones_m17n VALUES (116,9,'Neuenburg');
INSERT INTO zones_m17n VALUES (115,9,'Luzern');
INSERT INTO zones_m17n VALUES (114,9,'Jura');
INSERT INTO zones_m17n VALUES (113,9,'Graubnden');
INSERT INTO zones_m17n VALUES (112,9,'Glarus');
INSERT INTO zones_m17n VALUES (111,9,'Genf');
INSERT INTO zones_m17n VALUES (110,9,'Freiburg');
INSERT INTO zones_m17n VALUES (109,9,'Basel-Stadt');
INSERT INTO zones_m17n VALUES (108,9,'Basel-Landschaft');
INSERT INTO zones_m17n VALUES (107,9,'Bern');
INSERT INTO zones_m17n VALUES (106,9,'Appenzell Ausserrhoden');
INSERT INTO zones_m17n VALUES (105,9,'Appenzell Innerrhoden');
INSERT INTO zones_m17n VALUES (104,9,'Aargau');
INSERT INTO zones_m17n VALUES (103,9,'Voralberg');
INSERT INTO zones_m17n VALUES (102,9,'Burgenland');
INSERT INTO zones_m17n VALUES (101,9,'Tirol');
INSERT INTO zones_m17n VALUES (100,9,'Steiermark');
INSERT INTO zones_m17n VALUES (99,9,'Kten');
INSERT INTO zones_m17n VALUES (98,9,'Salzburg');
INSERT INTO zones_m17n VALUES (97,9,'Obersterreich');
INSERT INTO zones_m17n VALUES (96,9,'Niedersterreich');
INSERT INTO zones_m17n VALUES (95,9,'Wien');
INSERT INTO zones_m17n VALUES (94,9,'Thringen');
INSERT INTO zones_m17n VALUES (93,9,'Schleswig-Holstein');
INSERT INTO zones_m17n VALUES (92,9,'Sachsen-Anhalt');
INSERT INTO zones_m17n VALUES (91,9,'Sachsen');
INSERT INTO zones_m17n VALUES (90,9,'Saarland');
INSERT INTO zones_m17n VALUES (89,9,'Rheinland-Pfalz');
INSERT INTO zones_m17n VALUES (88,9,'Nordrhein-Westfalen');
INSERT INTO zones_m17n VALUES (87,9,'Mecklenburg-Vorpommern');
INSERT INTO zones_m17n VALUES (86,9,'Hessen');
INSERT INTO zones_m17n VALUES (85,9,'Hamburg');
INSERT INTO zones_m17n VALUES (84,9,'Bremen');
INSERT INTO zones_m17n VALUES (83,9,'Brandenburg');
INSERT INTO zones_m17n VALUES (82,9,'Berlin');
INSERT INTO zones_m17n VALUES (81,9,'Bayern');
INSERT INTO zones_m17n VALUES (80,9,'Baden-Wrttemberg');
INSERT INTO zones_m17n VALUES (79,9,'Niedersachsen');
INSERT INTO zones_m17n VALUES (78,9,'Yukon Territory');
INSERT INTO zones_m17n VALUES (77,9,'Saskatchewan');
INSERT INTO zones_m17n VALUES (76,9,'Quebec');
INSERT INTO zones_m17n VALUES (75,9,'Prince Edward Island');
INSERT INTO zones_m17n VALUES (74,9,'Ontario');
INSERT INTO zones_m17n VALUES (73,9,'Nunavut');
INSERT INTO zones_m17n VALUES (72,9,'Northwest Territories');
INSERT INTO zones_m17n VALUES (71,9,'Nova Scotia');
INSERT INTO zones_m17n VALUES (70,9,'New Brunswick');
INSERT INTO zones_m17n VALUES (69,9,'Newfoundland');
INSERT INTO zones_m17n VALUES (68,9,'Manitoba');
INSERT INTO zones_m17n VALUES (67,9,'British Columbia');
INSERT INTO zones_m17n VALUES (66,9,'Alberta');
INSERT INTO zones_m17n VALUES (65,9,'Wyoming');
INSERT INTO zones_m17n VALUES (64,9,'Wisconsin');
INSERT INTO zones_m17n VALUES (63,9,'West Virginia');
INSERT INTO zones_m17n VALUES (62,9,'Washington');
INSERT INTO zones_m17n VALUES (61,9,'Virginia');
INSERT INTO zones_m17n VALUES (60,9,'Virgin Islands');
INSERT INTO zones_m17n VALUES (59,9,'Vermont');
INSERT INTO zones_m17n VALUES (58,9,'Utah');
INSERT INTO zones_m17n VALUES (57,9,'Texas');
INSERT INTO zones_m17n VALUES (56,9,'Tennessee');
INSERT INTO zones_m17n VALUES (55,9,'South Dakota');
INSERT INTO zones_m17n VALUES (54,9,'South Carolina');
INSERT INTO zones_m17n VALUES (53,9,'Rhode Island');
INSERT INTO zones_m17n VALUES (52,9,'Puerto Rico');
INSERT INTO zones_m17n VALUES (51,9,'Pennsylvania');
INSERT INTO zones_m17n VALUES (50,9,'Palau');
INSERT INTO zones_m17n VALUES (49,9,'Oregon');
INSERT INTO zones_m17n VALUES (48,9,'Oklahoma');
INSERT INTO zones_m17n VALUES (47,9,'Ohio');
INSERT INTO zones_m17n VALUES (46,9,'Northern Mariana Islands');
INSERT INTO zones_m17n VALUES (45,9,'North Dakota');
INSERT INTO zones_m17n VALUES (44,9,'North Carolina');
INSERT INTO zones_m17n VALUES (43,9,'New York');
INSERT INTO zones_m17n VALUES (42,9,'New Mexico');
INSERT INTO zones_m17n VALUES (41,9,'New Jersey');
INSERT INTO zones_m17n VALUES (40,9,'New Hampshire');
INSERT INTO zones_m17n VALUES (39,9,'Nevada');
INSERT INTO zones_m17n VALUES (38,9,'Nebraska');
INSERT INTO zones_m17n VALUES (37,9,'Montana');
INSERT INTO zones_m17n VALUES (36,9,'Missouri');
INSERT INTO zones_m17n VALUES (35,9,'Mississippi');
INSERT INTO zones_m17n VALUES (34,9,'Minnesota');
INSERT INTO zones_m17n VALUES (33,9,'Michigan');
INSERT INTO zones_m17n VALUES (32,9,'Massachusetts');
INSERT INTO zones_m17n VALUES (31,9,'Maryland');
INSERT INTO zones_m17n VALUES (30,9,'Marshall Islands');
INSERT INTO zones_m17n VALUES (29,9,'Maine');
INSERT INTO zones_m17n VALUES (28,9,'Louisiana');
INSERT INTO zones_m17n VALUES (27,9,'Kentucky');
INSERT INTO zones_m17n VALUES (26,9,'Kansas');
INSERT INTO zones_m17n VALUES (25,9,'Iowa');
INSERT INTO zones_m17n VALUES (24,9,'Indiana');
INSERT INTO zones_m17n VALUES (23,9,'Illinois');
INSERT INTO zones_m17n VALUES (22,9,'Idaho');
INSERT INTO zones_m17n VALUES (21,9,'Hawaii');
INSERT INTO zones_m17n VALUES (20,9,'Guam');
INSERT INTO zones_m17n VALUES (19,9,'Georgia');
INSERT INTO zones_m17n VALUES (18,9,'Florida');
INSERT INTO zones_m17n VALUES (17,9,'Federated States Of Micronesia');
INSERT INTO zones_m17n VALUES (16,9,'District of Columbia');
INSERT INTO zones_m17n VALUES (15,9,'Delaware');
INSERT INTO zones_m17n VALUES (14,9,'Connecticut');
INSERT INTO zones_m17n VALUES (13,9,'Colorado');
INSERT INTO zones_m17n VALUES (12,9,'California');
INSERT INTO zones_m17n VALUES (11,9,'Armed Forces Pacific');
INSERT INTO zones_m17n VALUES (10,9,'Armed Forces Middle East');
INSERT INTO zones_m17n VALUES (9,9,'Armed Forces Europe');
INSERT INTO zones_m17n VALUES (8,9,'Armed Forces Canada');
INSERT INTO zones_m17n VALUES (7,9,'Armed Forces Americas');
INSERT INTO zones_m17n VALUES (6,9,'Armed Forces Africa');
INSERT INTO zones_m17n VALUES (5,9,'Arkansas');
INSERT INTO zones_m17n VALUES (4,9,'Arizona');
INSERT INTO zones_m17n VALUES (3,9,'American Samoa');
INSERT INTO zones_m17n VALUES (2,9,'Alaska');
INSERT INTO zones_m17n VALUES (1,9,'Alabama');
INSERT INTO zones_m17n VALUES (155,9,'Jaen');
INSERT INTO zones_m17n VALUES (156,9,'La Rioja');
INSERT INTO zones_m17n VALUES (157,9,'Las Palmas');
INSERT INTO zones_m17n VALUES (158,9,'Leon');
INSERT INTO zones_m17n VALUES (159,9,'Lleida');
INSERT INTO zones_m17n VALUES (160,9,'Lugo');
INSERT INTO zones_m17n VALUES (161,9,'Madrid');
INSERT INTO zones_m17n VALUES (162,9,'Malaga');
INSERT INTO zones_m17n VALUES (163,9,'Melilla');
INSERT INTO zones_m17n VALUES (164,9,'Murcia');
INSERT INTO zones_m17n VALUES (165,9,'Navarra');
INSERT INTO zones_m17n VALUES (166,9,'Ourense');
INSERT INTO zones_m17n VALUES (167,9,'Palencia');
INSERT INTO zones_m17n VALUES (168,9,'Pontevedra');
INSERT INTO zones_m17n VALUES (169,9,'Salamanca');
INSERT INTO zones_m17n VALUES (170,9,'Santa Cruz de Tenerife');
INSERT INTO zones_m17n VALUES (171,9,'Segovia');
INSERT INTO zones_m17n VALUES (172,9,'Sevilla');
INSERT INTO zones_m17n VALUES (173,9,'Soria');
INSERT INTO zones_m17n VALUES (174,9,'Tarragona');
INSERT INTO zones_m17n VALUES (175,9,'Teruel');
INSERT INTO zones_m17n VALUES (176,9,'Toledo');
INSERT INTO zones_m17n VALUES (177,9,'Valencia');
INSERT INTO zones_m17n VALUES (178,9,'Valladolid');
INSERT INTO zones_m17n VALUES (179,9,'Vizcaya');
INSERT INTO zones_m17n VALUES (180,9,'Zamora');
INSERT INTO zones_m17n VALUES (181,9,'Zaragoza');
INSERT INTO zones_m17n VALUES (182,9,'北海道');
INSERT INTO zones_m17n VALUES (183,9,'青森県');
INSERT INTO zones_m17n VALUES (184,9,'岩手県');
INSERT INTO zones_m17n VALUES (185,9,'宮城県');
INSERT INTO zones_m17n VALUES (186,9,'秋田県');
INSERT INTO zones_m17n VALUES (187,9,'山形県');
INSERT INTO zones_m17n VALUES (188,9,'福島県');
INSERT INTO zones_m17n VALUES (189,9,'茨城県');
INSERT INTO zones_m17n VALUES (190,9,'栃木県');
INSERT INTO zones_m17n VALUES (191,9,'群馬県');
INSERT INTO zones_m17n VALUES (192,9,'埼玉県');
INSERT INTO zones_m17n VALUES (193,9,'千葉県');
INSERT INTO zones_m17n VALUES (194,9,'東京都');
INSERT INTO zones_m17n VALUES (195,9,'神奈川県');
INSERT INTO zones_m17n VALUES (196,9,'新潟県');
INSERT INTO zones_m17n VALUES (197,9,'富山県');
INSERT INTO zones_m17n VALUES (198,9,'石川県');
INSERT INTO zones_m17n VALUES (199,9,'福井県');
INSERT INTO zones_m17n VALUES (200,9,'山梨県');
INSERT INTO zones_m17n VALUES (201,9,'長野県');
INSERT INTO zones_m17n VALUES (202,9,'岐阜県');
INSERT INTO zones_m17n VALUES (203,9,'静岡県');
INSERT INTO zones_m17n VALUES (204,9,'愛知県');
INSERT INTO zones_m17n VALUES (205,9,'三重県');
INSERT INTO zones_m17n VALUES (206,9,'滋賀県');
INSERT INTO zones_m17n VALUES (207,9,'京都府');
INSERT INTO zones_m17n VALUES (208,9,'大阪府');
INSERT INTO zones_m17n VALUES (209,9,'兵庫県');
INSERT INTO zones_m17n VALUES (210,9,'奈良県');
INSERT INTO zones_m17n VALUES (211,9,'和歌山県');
INSERT INTO zones_m17n VALUES (212,9,'鳥取県');
INSERT INTO zones_m17n VALUES (213,9,'島根県');
INSERT INTO zones_m17n VALUES (214,9,'岡山県');
INSERT INTO zones_m17n VALUES (215,9,'広島県');
INSERT INTO zones_m17n VALUES (216,9,'山口県');
INSERT INTO zones_m17n VALUES (217,9,'徳島県');
INSERT INTO zones_m17n VALUES (218,9,'香川県');
INSERT INTO zones_m17n VALUES (219,9,'愛媛県');
INSERT INTO zones_m17n VALUES (220,9,'高知県');
INSERT INTO zones_m17n VALUES (221,9,'福岡県');
INSERT INTO zones_m17n VALUES (222,9,'佐賀県');
INSERT INTO zones_m17n VALUES (223,9,'長崎県');
INSERT INTO zones_m17n VALUES (224,9,'熊本県');
INSERT INTO zones_m17n VALUES (225,9,'大分県');
INSERT INTO zones_m17n VALUES (226,9,'宮崎県');
INSERT INTO zones_m17n VALUES (227,9,'鹿児島県');
INSERT INTO zones_m17n VALUES (228,9,'沖縄県');

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

