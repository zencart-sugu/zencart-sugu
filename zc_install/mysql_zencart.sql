#
# * Main Zen Cart SQL Load for MySQL databases
# * @package Installer
# * @access private
# * @copyright Copyright 2003-2006 Zen Cart Development Team
# * @copyright Portions Copyright 2003 osCommerce
# * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
# * @version $Id: mysql_zencart.sql 3787 2006-06-17 03:07:14Z drbyte $
#


# --------------------------------------------------------
#
# Table structure for table upgrade_exceptions
# (Placed at top so any exceptions during installation can be trapped as well)
#

DROP TABLE IF EXISTS upgrade_exceptions;
CREATE TABLE upgrade_exceptions (
  upgrade_exception_id smallint(5) NOT NULL auto_increment,
  sql_file varchar(50) default NULL,
  reason varchar(200) default NULL,
  errordate datetime default '0001-01-01 00:00:00',
  sqlstatement text,
  PRIMARY KEY  (upgrade_exception_id)
) TYPE=MyISAM;


# --------------------------------------------------------
#
# Table structure for table address_book
#

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
  PRIMARY KEY  (address_book_id),
  KEY idx_address_book_customers_id_zen (customers_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table address_format
#

DROP TABLE IF EXISTS address_format;
CREATE TABLE address_format (
  address_format_id int(11) NOT NULL auto_increment,
  address_format varchar(128) NOT NULL default '',
  address_summary varchar(48) NOT NULL default '',
  PRIMARY KEY  (address_format_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table admin
#

DROP TABLE IF EXISTS admin;
CREATE TABLE admin (
  admin_id int(11) NOT NULL auto_increment,
  admin_name varchar(32) NOT NULL default '',
  admin_email varchar(96) NOT NULL default '',
  admin_pass varchar(40) NOT NULL default '',
  admin_level tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (admin_id),
  KEY idx_admin_name_zen (admin_name)
) TYPE=MyISAM;

# --------------------------------------------------------

#Admin Activity log

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
) TYPE=MyISAM;


# --------------------------------------------------------

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
) TYPE=MyISAM;

#
# Table structure for table banners
#

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
) TYPE=MyISAM;


# --------------------------------------------------------

#
# Table structure for table banners_history
#

DROP TABLE IF EXISTS banners_history;
CREATE TABLE banners_history (
  banners_history_id int(11) NOT NULL auto_increment,
  banners_id int(11) NOT NULL default '0',
  banners_shown int(5) NOT NULL default '0',
  banners_clicked int(5) NOT NULL default '0',
  banners_history_date datetime NOT NULL default '0001-01-01 00:00:00',
  PRIMARY KEY  (banners_history_id),
  KEY idx_banners_id_zen (banners_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table categories
#

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
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table categories_description
#

DROP TABLE IF EXISTS categories_description;
CREATE TABLE categories_description (
  categories_id int(11) NOT NULL default '0',
  language_id int(11) NOT NULL default '1',
  categories_name varchar(32) NOT NULL default '',
  categories_description text NOT NULL,
  PRIMARY KEY  (categories_id,language_id),
  KEY idx_categories_name_zen (categories_name)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table configuration
#

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
  use_function text default NULL,
  set_function text default NULL,
  PRIMARY KEY  (configuration_id),
  UNIQUE KEY unq_config_key_zen (configuration_key),
  KEY idx_key_value_zen (configuration_key,configuration_value(10)),
  KEY idx_cfg_grp_id_zen (configuration_group_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table configuration_group
#

DROP TABLE IF EXISTS configuration_group;
CREATE TABLE configuration_group (
  configuration_group_id int(11) NOT NULL auto_increment,
  configuration_group_title varchar(64) NOT NULL default '',
  configuration_group_description varchar(255) NOT NULL default '',
  sort_order int(5) default NULL,
  visible int(1) default '1',
  PRIMARY KEY  (configuration_group_id),
  KEY idx_visible_zen (visible)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table counter
#

DROP TABLE IF EXISTS counter;
CREATE TABLE counter (
  startdate char(8) default NULL,
  counter int(12) default NULL
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table counter_history
#

DROP TABLE IF EXISTS counter_history;
CREATE TABLE counter_history (
  startdate char(8) default NULL,
  counter int(12) default NULL,
  session_counter int(12) default NULL
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table countries
#

DROP TABLE IF EXISTS countries;
CREATE TABLE countries (
  countries_id int(11) NOT NULL auto_increment,
  countries_name varchar(64) NOT NULL default '',
  countries_iso_code_2 char(2) NOT NULL default '',
  countries_iso_code_3 char(3) NOT NULL default '',
  address_format_id int(11) NOT NULL default '0',
  PRIMARY KEY  (countries_id),
  KEY idx_countries_name_zen (countries_name)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table coupon_email_track
#

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
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table coupon_gv_customer
#

DROP TABLE IF EXISTS coupon_gv_customer;
CREATE TABLE coupon_gv_customer (
  customer_id int(5) NOT NULL default '0',
  amount decimal(8,4) NOT NULL default '0.0000',
  PRIMARY KEY  (customer_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table coupon_gv_queue
#

DROP TABLE IF EXISTS coupon_gv_queue;
CREATE TABLE coupon_gv_queue (
  unique_id int(5) NOT NULL auto_increment,
  customer_id int(5) NOT NULL default '0',
  order_id int(5) NOT NULL default '0',
  amount decimal(8,4) NOT NULL default '0.0000',
  date_created datetime NOT NULL default '0001-01-01 00:00:00',
  ipaddr varchar(32) NOT NULL default '',
  release_flag char(1) NOT NULL default 'N',
  PRIMARY KEY  (unique_id),
  KEY idx_cust_id_order_id_zen (customer_id,order_id),
  KEY idx_release_flag_zen (release_flag)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table coupon_redeem_track
#

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
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table coupon_restrict
#

DROP TABLE IF EXISTS coupon_restrict;
CREATE TABLE coupon_restrict (
  restrict_id int(11) NOT NULL auto_increment,
  coupon_id int(11) NOT NULL default '0',
  product_id int(11) NOT NULL default '0',
  category_id int(11) NOT NULL default '0',
  coupon_restrict char(1) NOT NULL default 'N',
  PRIMARY KEY  (restrict_id),
  KEY idx_coup_id_prod_id_zen (coupon_id,product_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table coupons
#

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
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table coupons_description
#

DROP TABLE IF EXISTS coupons_description;
CREATE TABLE coupons_description (
  coupon_id int(11) NOT NULL default '0',
  language_id int(11) NOT NULL default '0',
  coupon_name varchar(32) NOT NULL default '',
  coupon_description text,
  PRIMARY KEY (coupon_id,language_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table currencies
#

DROP TABLE IF EXISTS currencies;
CREATE TABLE currencies (
  currencies_id int(11) NOT NULL auto_increment,
  title varchar(32) NOT NULL default '',
  code char(3) NOT NULL default '',
  symbol_left varchar(24) default NULL,
  symbol_right varchar(24) default NULL,
  decimal_point char(1) default NULL,
  thousands_point char(1) default NULL,
  decimal_places char(1) default NULL,
  value float(13,8) default NULL,
  last_updated datetime default NULL,
  PRIMARY KEY  (currencies_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table customers
#

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
  customers_telephone varchar(32) NOT NULL default '',
  customers_fax varchar(32) default NULL,
  customers_password varchar(40) NOT NULL default '',
  customers_newsletter char(1) default NULL,
  customers_group_pricing int(11) NOT NULL default '0',
  customers_email_format varchar(4) NOT NULL default 'TEXT',
  customers_authorization int(1) NOT NULL default '0',
  customers_referral varchar(32) NOT NULL default '',
  PRIMARY KEY  (customers_id),
  KEY idx_email_address_zen (customers_email_address),
  KEY idx_referral_zen (customers_referral(10)),
  KEY idx_grp_pricing_zen (customers_group_pricing),
  KEY idx_nick_zen (customers_nick),
  KEY idx_newsletter_zen (customers_newsletter)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table customers_basket
#

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
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table customers_basket_attributes
#

DROP TABLE IF EXISTS customers_basket_attributes;
CREATE TABLE customers_basket_attributes (
  customers_basket_attributes_id int(11) NOT NULL auto_increment,
  customers_id int(11) NOT NULL default '0',
  products_id tinytext NOT NULL,
  products_options_id varchar(64) NOT NULL default '0',
  products_options_value_id int(11) NOT NULL default '0',
  products_options_value_text BLOB NULL default NULL,
  products_options_sort_order text NOT NULL,
  PRIMARY KEY  (customers_basket_attributes_id),
  KEY idx_cust_id_prod_id_zen (customers_id,products_id(36))
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table customers_info
#

DROP TABLE IF EXISTS customers_info;
CREATE TABLE customers_info (
  customers_info_id int(11) NOT NULL default '0',
  customers_info_date_of_last_logon datetime default NULL,
  customers_info_number_of_logons int(5) default NULL,
  customers_info_date_account_created datetime default NULL,
  customers_info_date_account_last_modified datetime default NULL,
  global_product_notifications int(1) default '0',
  PRIMARY KEY  (customers_info_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table db_cache
#
DROP TABLE IF EXISTS db_cache;
CREATE TABLE db_cache (
  cache_entry_name varchar(64) NOT NULL,
  cache_data blob,
  cache_entry_created int(15),
  PRIMARY KEY  (cache_entry_name)
) TYPE=MyISAM;


# --------------------------------------------------------


# Table structure for table email_archive

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
) TYPE=MyISAM;



#
# Table structure for table featured
#

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
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table files_uploaded
#

DROP TABLE IF EXISTS files_uploaded;
CREATE TABLE files_uploaded (
  files_uploaded_id int(11) NOT NULL auto_increment,
  sesskey varchar(32) default NULL,
  customers_id int(11) default NULL,
  files_uploaded_name varchar(64) NOT NULL default '',
  PRIMARY KEY  (files_uploaded_id),
  KEY idx_customers_id_zen (customers_id)
) TYPE=MyISAM COMMENT='Must always have either a sesskey or customers_id';

# --------------------------------------------------------

#
# Table structure for table geo_zones
#

DROP TABLE IF EXISTS geo_zones;
CREATE TABLE geo_zones (
  geo_zone_id int(11) NOT NULL auto_increment,
  geo_zone_name varchar(32) NOT NULL default '',
  geo_zone_description varchar(255) NOT NULL default '',
  last_modified datetime default NULL,
  date_added datetime NOT NULL default '0001-01-01 00:00:00',
  PRIMARY KEY  (geo_zone_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table `get_terms_to_filter`
#
DROP TABLE IF EXISTS get_terms_to_filter;
CREATE TABLE get_terms_to_filter (
  get_term_name varchar(255) NOT NULL default '',
  PRIMARY KEY  (get_term_name)
) TYPE=MyISAM;

#
# Table structure for table geo_zones
#

DROP TABLE IF EXISTS group_pricing;
CREATE TABLE group_pricing (
  group_id int(11) NOT NULL auto_increment,
  group_name varchar(32) NOT NULL default '',
  group_percentage decimal(5,2) NOT NULL default '0',
  last_modified datetime default NULL,
  date_added datetime NOT NULL default '0001-01-01 00:00:00',
  PRIMARY KEY  (group_id)
) TYPE=MyISAM;
# --------------------------------------------------------


#
# Table structure for table ezpages
#

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
) TYPE=MyISAM;

#---------------------------------------------------

#
# Table structure for table languages
#

DROP TABLE IF EXISTS languages;
CREATE TABLE languages (
  languages_id int(11) NOT NULL auto_increment,
  name varchar(32) NOT NULL default '',
  code char(2) NOT NULL default '',
  image varchar(64) default NULL,
  directory varchar(32) default NULL,
  sort_order int(3) default NULL,
  PRIMARY KEY  (languages_id),
  KEY idx_languages_name_zen (name)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table layout_boxes
#

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
  PRIMARY KEY  (layout_id),
  KEY idx_name_template_zen (layout_template,layout_box_name),
  KEY idx_layout_box_status_zen (layout_box_status)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table manufacturers
#

DROP TABLE IF EXISTS manufacturers;
CREATE TABLE manufacturers (
  manufacturers_id int(11) NOT NULL auto_increment,
  manufacturers_name varchar(32) NOT NULL default '',
  manufacturers_image varchar(64) default NULL,
  date_added datetime default NULL,
  last_modified datetime default NULL,
  PRIMARY KEY  (manufacturers_id),
  KEY idx_mfg_name_zen (manufacturers_name)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table manufacturers_info
#

DROP TABLE IF EXISTS manufacturers_info;
CREATE TABLE manufacturers_info (
  manufacturers_id int(11) NOT NULL default '0',
  languages_id int(11) NOT NULL default '0',
  manufacturers_url varchar(255) NOT NULL default '',
  url_clicked int(5) NOT NULL default '0',
  date_last_click datetime default NULL,
  PRIMARY KEY  (manufacturers_id,languages_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table media_clips
#

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
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table media_manager
#

DROP TABLE IF EXISTS media_manager;
CREATE TABLE media_manager (
  media_id int(11) NOT NULL auto_increment,
  media_name varchar(255) NOT NULL default '',
  last_modified datetime NOT NULL default '0001-01-01 00:00:00',
  date_added datetime NOT NULL default '0001-01-01 00:00:00',
  PRIMARY KEY  (media_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table media_to_products
#

DROP TABLE IF EXISTS media_to_products;
CREATE TABLE media_to_products (
  media_id int(11) NOT NULL default '0',
  product_id int(11) NOT NULL default '0',
  KEY idx_media_product_zen (media_id,product_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table media_types
#

DROP TABLE IF EXISTS media_types;
CREATE TABLE media_types (
  type_id int(11) NOT NULL auto_increment,
  type_name varchar(64) NOT NULL default '',
  type_ext varchar(8) NOT NULL default '',
  PRIMARY KEY  (type_id)
) TYPE=MyISAM;

INSERT INTO media_types (type_name, type_ext) VALUES ('MP3','.mp3');

# -------------------------------------------------------

#
# Table structure for table meta_tags_categories_description
#

DROP TABLE IF EXISTS meta_tags_categories_description;
CREATE TABLE meta_tags_categories_description (
  categories_id int(11) NOT NULL auto_increment,
  language_id int(11) NOT NULL default '1',
  metatags_title VARCHAR(255) NOT NULL default '',
  metatags_keywords TEXT,
  metatags_description TEXT,
  PRIMARY KEY  (categories_id,language_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table meta_tags_products_description
#

DROP TABLE IF EXISTS meta_tags_products_description;
CREATE TABLE meta_tags_products_description (
  products_id int(11) NOT NULL auto_increment,
  language_id int(11) NOT NULL default '1',
  metatags_title VARCHAR(255) NOT NULL default '',
  metatags_keywords TEXT,
  metatags_description TEXT,
  PRIMARY KEY  (products_id,language_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table music_genre
#

DROP TABLE IF EXISTS music_genre;
CREATE TABLE music_genre (
  music_genre_id int(11) NOT NULL auto_increment,
  music_genre_name varchar(32) NOT NULL default '',
  date_added datetime default NULL,
  last_modified datetime default NULL,
  PRIMARY KEY  (music_genre_id),
  KEY idx_music_genre_name_zen (music_genre_name)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table newsletters
#

DROP TABLE IF EXISTS newsletters;
CREATE TABLE newsletters (
  newsletters_id int(11) NOT NULL auto_increment,
  title varchar(255) NOT NULL default '',
  content text NOT NULL,
  content_html TEXT NOT NULL,
  module varchar(255) NOT NULL default '',
  date_added datetime NOT NULL default '0001-01-01 00:00:00',
  date_sent datetime default NULL,
  status int(1) default NULL,
  locked int(1) default '0',
  PRIMARY KEY  (newsletters_id)
) TYPE=MyISAM;

# --------------------------------------------------------


#
# Table structure for table orders
#

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
  customers_telephone varchar(32) NOT NULL default '',
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
  currency char(3) default NULL,
  currency_value decimal(14,6) default NULL,
  order_total decimal(14,2) default NULL,
  order_tax decimal(14,2) default NULL,
  paypal_ipn_id int(11) NOT NULL default '0',
  ip_address varchar(96) NOT NULL default '',
  PRIMARY KEY  (orders_id),
  KEY idx_status_orders_cust_zen (orders_status,orders_id,customers_id)
) TYPE=MyISAM;


# --------------------------------------------------------

#
# Table structure for table orders_products
#

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
) TYPE=MyISAM;


# --------------------------------------------------------

#
# Table structure for table orders_products_attributes
#

DROP TABLE IF EXISTS orders_products_attributes;
CREATE TABLE orders_products_attributes (
  orders_products_attributes_id int(11) NOT NULL auto_increment,
  orders_id int(11) NOT NULL default '0',
  orders_products_id int(11) NOT NULL default '0',
  products_options varchar(32) NOT NULL default '',
  products_options_values BLOB NOT NULL default '',
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
  KEY idx_orders_id_prod_id_zen (orders_id , orders_products_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table orders_products_download
#

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
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table orders_status
#

DROP TABLE IF EXISTS orders_status;
CREATE TABLE orders_status (
  orders_status_id int(11) NOT NULL default '0',
  language_id int(11) NOT NULL default '1',
  orders_status_name varchar(32) NOT NULL default '',
  PRIMARY KEY  (orders_status_id,language_id),
  KEY idx_orders_status_name_zen (orders_status_name)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table orders_status_history
#

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
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table orders_total
#

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
) TYPE=MyISAM;

# --------------------------------------------------------


DROP TABLE IF EXISTS paypal_session;
CREATE TABLE paypal_session (
  unique_id int(11) NOT NULL auto_increment,
  session_id text NOT NULL,
  saved_session blob NOT NULL,
  expiry int(17) NOT NULL default '0',
  PRIMARY KEY  (unique_id),
  KEY idx_session_id_zen (session_id(36))
) TYPE=MyISAM;


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
  mc_currency char(3) NOT NULL default '',
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
  settle_currency char(3) default NULL,
  exchange_rate decimal(4,2) default NULL,
  notify_version decimal(2,1) NOT NULL default '0.0',
  verify_sign varchar(128) NOT NULL default '',
  last_modified datetime NOT NULL default '0001-01-01 00:00:00',
  date_added datetime NOT NULL default '0001-01-01 00:00:00',
  memo text,
  PRIMARY KEY (paypal_ipn_id,txn_id),
  KEY idx_zen_order_id_zen (zen_order_id)
) TYPE=MyISAM;


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
  mc_currency char(3) NOT NULL default '',
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
  settle_currency char(3) default NULL,
  exchange_rate decimal(4,2) default NULL,
  notify_version decimal(2,1) NOT NULL default '0.0',
  verify_sign varchar(128) NOT NULL default '',
  last_modified datetime NOT NULL default '0001-01-01 00:00:00',
  date_added datetime NOT NULL default '0001-01-01 00:00:00',
  memo text,
  PRIMARY KEY  (paypal_ipn_id,txn_id),
  KEY idx_zen_order_id_zen (zen_order_id)
) TYPE=MyISAM;


DROP TABLE IF EXISTS paypal_payment_status;
CREATE TABLE paypal_payment_status (
  payment_status_id int(11) NOT NULL auto_increment,
  payment_status_name varchar(64) NOT NULL default '',
  PRIMARY KEY (payment_status_id)
) TYPE=MyISAM;

INSERT INTO paypal_payment_status VALUES (1, 'Completed');
INSERT INTO paypal_payment_status VALUES (2, 'Pending');
INSERT INTO paypal_payment_status VALUES (3, 'Failed');
INSERT INTO paypal_payment_status VALUES (4, 'Denied');
INSERT INTO paypal_payment_status VALUES (5, 'Refunded');
INSERT INTO paypal_payment_status VALUES (6, 'Canceled_Reversal');
INSERT INTO paypal_payment_status VALUES (7, 'Reversed');


DROP TABLE IF EXISTS paypal_payment_status_history;
CREATE TABLE paypal_payment_status_history (
  payment_status_history_id int(11) NOT NULL auto_increment,
  paypal_ipn_id int(11) NOT NULL default '0',
  txn_id varchar(64) NOT NULL default '',
  parent_txn_id varchar(64) NOT NULL default '',
  payment_status varchar(17) NOT NULL default '',
  pending_reason varchar(14) default NULL,
  date_added datetime NOT NULL default '0001-01-01 00:00:00',
  PRIMARY KEY (payment_status_history_id),
  KEY idx_paypal_ipn_id_zen (paypal_ipn_id)
) TYPE=MyISAM;



# --------------------------------------------------------

#
# Table structure for table product_music_extra
#

DROP TABLE IF EXISTS product_music_extra;
CREATE TABLE product_music_extra (
  products_id int(11) NOT NULL default '0',
  artists_id int(11) NOT NULL default '0',
  record_company_id int(11) NOT NULL default '0',
  music_genre_id int(11) NOT NULL default '0',
  PRIMARY KEY  (products_id),
  KEY idx_music_genre_id_zen (music_genre_id)
) TYPE=MyISAM;


# --------------------------------------------------------

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
  use_function text default NULL,
  set_function text default NULL,
  PRIMARY KEY  (configuration_id),
  UNIQUE KEY unq_config_key_zen (configuration_key),
  KEY idx_key_value_zen (configuration_key, configuration_value(10))
  )TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table product_types
#

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
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table product_types_to_category
#

DROP TABLE IF EXISTS product_types_to_category;
CREATE TABLE product_types_to_category (
  product_type_id int(11) NOT NULL default '0',
  category_id int(11) NOT NULL default '0',
  KEY idx_category_id_zen (category_id),
  KEY idx_product_type_id_zen (product_type_id)
) TYPE=MyISAM;


# --------------------------------------------------------

#
# Table structure for table products
#

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
) TYPE=MyISAM;
# --------------------------------------------------------

#
# Table structure for table products_attributes
#

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
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table products_attributes_download
#

DROP TABLE IF EXISTS products_attributes_download;
CREATE TABLE products_attributes_download (
  products_attributes_id int(11) NOT NULL default '0',
  products_attributes_filename varchar(255) NOT NULL default '',
  products_attributes_maxdays int(2) default '0',
  products_attributes_maxcount int(2) default '0',
  PRIMARY KEY  (products_attributes_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table products_description
#

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
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table products_discount_quantity
#
DROP TABLE IF EXISTS products_discount_quantity;
CREATE TABLE products_discount_quantity (
  discount_id int(4) NOT NULL default '0',
  products_id int(11) NOT NULL default '0',
  discount_qty float NOT NULL default '0',
  discount_price decimal(15,4) NOT NULL default '0.0000',
  KEY idx_id_qty_zen (products_id,discount_qty)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table products_notifications
#

DROP TABLE IF EXISTS products_notifications;
CREATE TABLE products_notifications (
  products_id int(11) NOT NULL default '0',
  customers_id int(11) NOT NULL default '0',
  date_added datetime NOT NULL default '0001-01-01 00:00:00',
  PRIMARY KEY  (products_id,customers_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table products_options
#

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
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table products_options_types
#

DROP TABLE IF EXISTS products_options_types;
CREATE TABLE products_options_types (
  products_options_types_id int(11) NOT NULL default '0',
  products_options_types_name varchar(32) default NULL,
  PRIMARY KEY  (products_options_types_id)
) TYPE=MyISAM COMMENT='Track products_options_types';

# --------------------------------------------------------

#
# Table structure for table products_options_values
#

DROP TABLE IF EXISTS products_options_values;
CREATE TABLE products_options_values (
  products_options_values_id int(11) NOT NULL default '0',
  language_id int(11) NOT NULL default '1',
  products_options_values_name varchar(64) NOT NULL default '',
  products_options_values_sort_order int(11) NOT NULL default '0',
  PRIMARY KEY (products_options_values_id,language_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table products_options_values_to_products_options
#

DROP TABLE IF EXISTS products_options_values_to_products_options;
CREATE TABLE products_options_values_to_products_options (
  products_options_values_to_products_options_id int(11) NOT NULL auto_increment,
  products_options_id int(11) NOT NULL default '0',
  products_options_values_id int(11) NOT NULL default '0',
  PRIMARY KEY  (products_options_values_to_products_options_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table products_to_categories
#

DROP TABLE IF EXISTS products_to_categories;
CREATE TABLE products_to_categories (
  products_id int(11) NOT NULL default '0',
  categories_id int(11) NOT NULL default '0',
  PRIMARY KEY  (products_id,categories_id),
  KEY idx_cat_prod_id_zen (categories_id,products_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table `project_version`
#

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
) TYPE=MyISAM COMMENT='Database Version Tracking';


# --------------------------------------------------------

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
) TYPE=MyISAM COMMENT='Database Version Tracking History';

# --------------------------------------------------------

#
# Create table for query_builder tool (audiences.php)
#
DROP TABLE IF EXISTS query_builder;
CREATE TABLE query_builder (
query_id int(11) NOT NULL auto_increment ,
query_category varchar(40) NOT NULL default '' ,
query_name varchar(80) NOT NULL default '' ,
query_description TEXT NOT NULL default '' ,
query_string TEXT NOT NULL default '' ,
query_keys_list TEXT NOT NULL default '' ,
PRIMARY KEY  (query_id) ,
UNIQUE KEY query_name (query_name)
) Type=MyISAM COMMENT = 'Stores queries for re-use in Admin email and report modules';

# --------------------------------------------------------

#
# Table structure for table record_artists
#

DROP TABLE IF EXISTS record_artists;
CREATE TABLE record_artists (
  artists_id int(11) NOT NULL auto_increment,
  artists_name varchar(32) NOT NULL default '',
  artists_image varchar(64) default NULL,
  date_added datetime default NULL,
  last_modified datetime default NULL,
  PRIMARY KEY  (artists_id),
  KEY idx_rec_artists_name_zen (artists_name)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table record_artists_info
#

DROP TABLE IF EXISTS record_artists_info;
CREATE TABLE record_artists_info (
  artists_id int(11) NOT NULL default '0',
  languages_id int(11) NOT NULL default '0',
  artists_url varchar(255) NOT NULL default '',
  url_clicked int(5) NOT NULL default '0',
  date_last_click datetime default NULL,
  PRIMARY KEY  (artists_id,languages_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table record_company
#

DROP TABLE IF EXISTS record_company;
CREATE TABLE record_company (
  record_company_id int(11) NOT NULL auto_increment,
  record_company_name varchar(32) NOT NULL default '',
  record_company_image varchar(64) default NULL,
  date_added datetime default NULL,
  last_modified datetime default NULL,
  PRIMARY KEY  (record_company_id),
  KEY idx_rec_company_name_zen (record_company_name)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table record_company_info
#

DROP TABLE IF EXISTS record_company_info;
CREATE TABLE record_company_info (
  record_company_id int(11) NOT NULL default '0',
  languages_id int(11) NOT NULL default '0',
  record_company_url varchar(255) NOT NULL default '',
  url_clicked int(5) NOT NULL default '0',
  date_last_click datetime default NULL,
  PRIMARY KEY  (record_company_id,languages_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table reviews
#

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
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table reviews_description
#

DROP TABLE IF EXISTS reviews_description;
CREATE TABLE reviews_description (
  reviews_id int(11) NOT NULL default '0',
  languages_id int(11) NOT NULL default '0',
  reviews_text text NOT NULL,
  PRIMARY KEY  (reviews_id,languages_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table salemaker_sales
#

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
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table sessions
#

DROP TABLE IF EXISTS sessions;
CREATE TABLE sessions (
  sesskey varchar(32) NOT NULL default '',
  expiry int(11) unsigned NOT NULL default '0',
  value text NOT NULL,
  PRIMARY KEY  (sesskey)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table specials
#

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
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table tax_class
#

DROP TABLE IF EXISTS tax_class;
CREATE TABLE tax_class (
  tax_class_id int(11) NOT NULL auto_increment,
  tax_class_title varchar(32) NOT NULL default '',
  tax_class_description varchar(255) NOT NULL default '',
  last_modified datetime default NULL,
  date_added datetime NOT NULL default '0001-01-01 00:00:00',
  PRIMARY KEY  (tax_class_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table tax_rates
#

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
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table template_select
#

DROP TABLE IF EXISTS template_select;
CREATE TABLE template_select (
  template_id int(11) NOT NULL auto_increment,
  template_dir varchar(64) NOT NULL default '',
  template_language varchar(64) NOT NULL default '0',
  PRIMARY KEY  (template_id),
  KEY idx_tpl_lang_zen (template_language)
) TYPE=MyISAM;

# --------------------------------------------------------


#
# Table structure for table whos_online
#

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
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table zones
#

DROP TABLE IF EXISTS zones;
CREATE TABLE zones (
  zone_id int(11) NOT NULL auto_increment,
  zone_country_id int(11) NOT NULL default '0',
  zone_code varchar(32) NOT NULL default '',
  zone_name varchar(32) NOT NULL default '',
  PRIMARY KEY  (zone_id)
) TYPE=MyISAM;

# --------------------------------------------------------

#
# Table structure for table zones_to_geo_zones
#

DROP TABLE IF EXISTS zones_to_geo_zones;
CREATE TABLE zones_to_geo_zones (
  association_id int(11) NOT NULL auto_increment,
  zone_country_id int(11) NOT NULL default '0',
  zone_id int(11) default NULL,
  geo_zone_id int(11) default NULL,
  last_modified datetime default NULL,
  date_added datetime NOT NULL default '0001-01-01 00:00:00',
  PRIMARY KEY  (association_id)
) TYPE=MyISAM;


#
# Database table for customers_wishlist
#

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
) TYPE=MyISAM;


















# data
INSERT INTO template_select VALUES (1, 'classic', '0');

# 1 - Default, 2 - USA, 3 - Spain, 4 - Singapore, 5 - Germany
INSERT INTO address_format VALUES (1, '$firstname $lastname$cr$streets$cr$city, $postcode$cr$statecomma$country','$city / $country');
INSERT INTO address_format VALUES (2, '$firstname $lastname$cr$streets$cr$city, $state    $postcode$cr$country','$city, $state / $country');
INSERT INTO address_format VALUES (3, '$firstname $lastname$cr$streets$cr$city$cr$postcode - $statecomma$country','$state / $country');
INSERT INTO address_format VALUES (4, '$firstname $lastname$cr$streets$cr$city ($postcode)$cr$country', '$postcode / $country');
INSERT INTO address_format VALUES (5, '$firstname $lastname$cr$streets$cr$postcode $city$cr$country','$city / $country');

INSERT INTO admin VALUES (1, 'Admin', 'admin@localhost', '351683ea4e19efe34874b501fdbf9792:9b', 1);

INSERT INTO banners (banners_title, banners_url, banners_image, banners_group, banners_html_text, expires_impressions, expires_date, date_scheduled, date_added, date_status_change, status, banners_open_new_windows, banners_on_ssl, banners_sort_order) VALUES ('Zen Cart', 'http://www.zen-cart.com', 'banners/zencart_468_60_02.gif', 'Wide-Banners', '', 0, NULL, NULL, '2004-01-11 20:59:12', NULL, 1, 1, 1, 0);
INSERT INTO banners (banners_title, banners_url, banners_image, banners_group, banners_html_text, expires_impressions, expires_date, date_scheduled, date_added, date_status_change, status, banners_open_new_windows, banners_on_ssl, banners_sort_order) VALUES ('Zen Cart the art of e-commerce', 'http://www.zen-cart.com', 'banners/125zen_logo.gif', 'SideBox-Banners', '', 0, NULL, NULL, '2004-01-11 20:59:12', NULL, 1, 1, 1, 0);
INSERT INTO banners (banners_title, banners_url, banners_image, banners_group, banners_html_text, expires_impressions, expires_date, date_scheduled, date_added, date_status_change, status, banners_open_new_windows, banners_on_ssl, banners_sort_order) VALUES ('Zen Cart the art of e-commerce', 'http://www.zen-cart.com', 'banners/125x125_zen_logo.gif', 'SideBox-Banners', '', 0, NULL, NULL, '2004-01-11 20:59:12', NULL, 1, 1, 1, 0);
INSERT INTO banners (banners_title, banners_url, banners_image, banners_group, banners_html_text, expires_impressions, expires_date, date_scheduled, date_added, date_status_change, status, banners_open_new_windows, banners_on_ssl, banners_sort_order) VALUES ('if you have to think ... you haven''t been Zenned!', 'http://www.zen-cart.com', 'banners/think_anim.gif', 'Wide-Banners', '', 0, NULL, NULL, '2004-01-12 20:53:18', NULL, 1, 1, 1, 0);
INSERT INTO banners (banners_title, banners_url, banners_image, banners_group, banners_html_text, expires_impressions, expires_date, date_scheduled, date_added, date_status_change, status, banners_open_new_windows, banners_on_ssl, banners_sort_order) VALUES ('Sashbox.net - the ultimate e-commerce hosting solution', 'http://www.sashbox.net/zencart/', 'banners/sashbox_125x50.jpg', 'BannersAll', '', 0, NULL, NULL, '2005-05-13 10:53:50', NULL, 1, 1, 1, 20);
INSERT INTO banners (banners_title, banners_url, banners_image, banners_group, banners_html_text, expires_impressions, expires_date, date_scheduled, date_added, date_status_change, status, banners_open_new_windows, banners_on_ssl, banners_sort_order) VALUES ('Zen Cart the art of e-commerce', 'http://www.zen-cart.com', 'banners/bw_zen_88wide.gif', 'BannersAll', '', 0, NULL, NULL, '2005-05-13 10:54:38', NULL, 1, 1, 1, 10);
INSERT INTO banners (banners_title, banners_url, banners_image, banners_group, banners_html_text, expires_impressions, expires_date, date_scheduled, date_added, date_status_change, status, banners_open_new_windows, banners_on_ssl, banners_sort_order) VALUES ('Sashbox.net - the ultimate e-commerce hosting solution', 'http://www.sashbox.net/zencart/', 'banners/sashbox_468x60.jpg', 'Wide-Banners', '', 0, NULL, NULL, '2005-05-13 10:55:11', NULL, 1, 1, 1, 0);
INSERT INTO banners (banners_title, banners_url, banners_image, banners_group, banners_html_text, expires_impressions, expires_date, date_scheduled, date_added, date_status_change, status, banners_open_new_windows, banners_on_ssl, banners_sort_order) VALUES ('Start Accepting Credit Cards For Your Business Today!', 'http://www.zen-cart.com/modules/freecontent/index.php?id=29', 'banners/cardsvcs_468x60.gif', 'Wide-Banners', '', 0, NULL, NULL, '2006-03-13 11:02:43', NULL, 1, 1, 1, 0);



INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Store Name', 'STORE_NAME', 'Zen Cart', 'The name of my store', '1', '1', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Store Owner', 'STORE_OWNER', 'Team Zen Cart', 'The name of my store owner', '1', '2', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Country', 'STORE_COUNTRY', '223', 'The country my store is located in <br /><br /><strong>Note: Please remember to update the store zone.</strong>', '1', '6', 'zen_get_country_name', 'zen_cfg_pull_down_country_list(', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Zone', 'STORE_ZONE', '18', 'The zone my store is located in', '1', '7', 'zen_cfg_get_zone_name', 'zen_cfg_pull_down_zone_list(', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Expected Sort Order', 'EXPECTED_PRODUCTS_SORT', 'desc', 'This is the sort order used in the expected products box.', '1', '8', 'zen_cfg_select_option(array(\'asc\', \'desc\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Expected Sort Field', 'EXPECTED_PRODUCTS_FIELD', 'date_expected', 'The column to sort by in the expected products box.', '1', '9', 'zen_cfg_select_option(array(\'products_name\', \'date_expected\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Switch To Default Language Currency', 'USE_DEFAULT_LANGUAGE_CURRENCY', 'false', 'Automatically switch to the language\'s currency when it is changed', '1', '10', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Language Selector', 'LANGUAGE_DEFAULT_SELECTOR', 'Default', 'Should the default language be based on the Store preferences, or the customer\'s browser settings?<br /><br />Default: Store\'s default settings', '1', '11', 'zen_cfg_select_option(array(\'Default\', \'Browser\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Use Search-Engine Safe URLs (still in development)', 'SEARCH_ENGINE_FRIENDLY_URLS', 'false', 'Use search-engine safe urls for all site links', '6', '12', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display Cart After Adding Product', 'DISPLAY_CART', 'true', 'Display the shopping cart after adding a product (or return back to their origin)', '1', '14', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Default Search Operator', 'ADVANCED_SEARCH_DEFAULT_OPERATOR', 'and', 'Default search operators', '1', '17', 'zen_cfg_select_option(array(\'and\', \'or\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Store Address and Phone', 'STORE_NAME_ADDRESS', 'Store Name\nAddress\nCountry\nPhone', 'This is the Store Name, Address and Phone used on printable documents and displayed online', '1', '18', 'zen_cfg_textarea(', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show Category Counts', 'SHOW_COUNTS', 'true', 'Count recursively how many products are in each category', '1', '19', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Tax Decimal Places', 'TAX_DECIMAL_PLACES', '0', 'Pad the tax value this amount of decimal places', '1', '20', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display Prices with Tax', 'DISPLAY_PRICE_WITH_TAX', 'false', 'Display prices with tax included (true) or add the tax at the end (false)', '1', '21', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display Prices with Tax in Admin', 'DISPLAY_PRICE_WITH_TAX_ADMIN', 'false', 'Display prices with tax included (true) or add the tax at the end (false) in Admin(Invoices)', '1', '21', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Basis of Product Tax', 'STORE_PRODUCT_TAX_BASIS', 'Shipping', 'On what basis is Product Tax calculated. Options are<br />Shipping - Based on customers Shipping Address<br />Billing Based on customers Billing address<br />Store - Based on Store address if Billing/Shipping Zone equals Store zone', '1', '21', 'zen_cfg_select_option(array(\'Shipping\', \'Billing\', \'Store\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Basis of Shipping Tax', 'STORE_SHIPPING_TAX_BASIS', 'Shipping', 'On what basis is Shipping Tax calculated. Options are<br />Shipping - Based on customers Shipping Address<br />Billing Based on customers Billing address<br />Store - Based on Store address if Billing/Shipping Zone equals Store zone - Can be overriden by correctly written Shipping Module', '1', '21', 'zen_cfg_select_option(array(\'Shipping\', \'Billing\', \'Store\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Sales Tax Display Status', 'STORE_TAX_DISPLAY_STATUS', '0', 'Always show Sales Tax even when amount is $0.00?<br />0= Off<br />1= On', '1', '21', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Admin Session Time Out in Seconds', 'SESSION_TIMEOUT_ADMIN', '3600', 'Enter the time in seconds. Default=3600<br />Example: 3600= 1 hour<br /><br />Note: Too few seconds can result in timeout issues when adding/editing products', 1, 40, NULL, now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Admin Set max_execution_time for processes', 'GLOBAL_SET_TIME_LIMIT', '60', 'Enter the time in seconds for how long the max_execution_time of processes should be. Default=60<br />Example: 60= 1 minute<br /><br />Note: Changing the time limit is only needed if you are having problems with the execution time of a process', 1, 42, NULL, now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show if version update available', 'SHOW_VERSION_UPDATE_IN_HEADER', 'true', 'Automatically check to see if a new version of Zen Cart is available. Enabling this can sometimes slow down the loading of Admin pages. (Displayed on main Index page after login, and Server Info page.)', 1, 44, 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Store Status', 'STORE_STATUS', '0', 'What is your Store Status<br />0= Normal Store<br />1= Showcase no prices<br />2= Showcase with prices', '1', '25', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Server Uptime', 'DISPLAY_SERVER_UPTIME', 'true', 'Displaying Server uptime can cause entries in error logs on some servers. (true = Display, false = don\'t display)', 1, 46, '2003-11-08 20:24:47', '0001-01-01 00:00:00', '', 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Missing Page Check', 'MISSING_PAGE_CHECK', 'true', 'Zen Cart can check for missing pages in the URL and redirect to Index page. For debugging you may want to turn this off. <br /><br /><strong>Default=On</strong><br />On = Send missing pages to \'index\'<br />Off = Don\'t check for missing pages<br />Page Not Found = display the Page-Not-Found page', 1, 48, '2003-11-08 20:24:47', '0001-01-01 00:00:00', '', 'zen_cfg_select_option(array(\'On\', \'Off\', \'Page Not Found\'),');

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('HTML Editor', 'HTML_EDITOR_PREFERENCE', 'NONE', 'Please select the HTML/Rich-Text editor you wish to use for composing Admin-related emails, newsletters, and product descriptions', '1', '110', 'zen_cfg_select_option(array(\'HTMLAREA\', \'NONE\'),', now());
#phpbb
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Enable phpBB linkage?', 'PHPBB_LINKS_ENABLED', 'false', 'Should Zen Cart synchronize new account information to your (already-installed) phpBB forum?', '1', '120', 'zen_cfg_select_option(array(\'true\', \'false\'),', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show Category Counts - Admin', 'SHOW_COUNTS_ADMIN', 'true', 'Show Category Counts in Admin?', '1', '130', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('First Name', 'ENTRY_FIRST_NAME_MIN_LENGTH', '2', 'Minimum length of first name', '2', '1', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Last Name', 'ENTRY_LAST_NAME_MIN_LENGTH', '2', 'Minimum length of last name', '2', '2', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Date of Birth', 'ENTRY_DOB_MIN_LENGTH', '10', 'Minimum length of date of birth', '2', '3', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('E-Mail Address', 'ENTRY_EMAIL_ADDRESS_MIN_LENGTH', '6', 'Minimum length of e-mail address', '2', '4', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Street Address', 'ENTRY_STREET_ADDRESS_MIN_LENGTH', '5', 'Minimum length of street address', '2', '5', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Company', 'ENTRY_COMPANY_MIN_LENGTH', '2', 'Minimum length of company name', '2', '6', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Post Code', 'ENTRY_POSTCODE_MIN_LENGTH', '4', 'Minimum length of post code', '2', '7', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('City', 'ENTRY_CITY_MIN_LENGTH', '3', 'Minimum length of city', '2', '8', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('State', 'ENTRY_STATE_MIN_LENGTH', '2', 'Minimum length of state', '2', '9', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Telephone Number', 'ENTRY_TELEPHONE_MIN_LENGTH', '3', 'Minimum length of telephone number', '2', '10', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Password', 'ENTRY_PASSWORD_MIN_LENGTH', '5', 'Minimum length of password', '2', '11', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Credit Card Owner Name', 'CC_OWNER_MIN_LENGTH', '3', 'Minimum length of credit card owner name', '2', '12', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Credit Card Number', 'CC_NUMBER_MIN_LENGTH', '10', 'Minimum length of credit card number', '2', '13', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Credit Card CVV Number', 'CC_CVV_MIN_LENGTH', '3', 'Minimum length of credit card CVV number', '2', '13', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Product Review Text', 'REVIEW_TEXT_MIN_LENGTH', '50', 'Minimum length of product review text', '2', '14', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Best Sellers', 'MIN_DISPLAY_BESTSELLERS', '1', 'Minimum number of best sellers to display', '2', '15', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Also Purchased Products', 'MIN_DISPLAY_ALSO_PURCHASED', '1', 'Minimum number of products to display in the \'This Customer Also Purchased\' box', '2', '16', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Nick Name', 'ENTRY_NICK_MIN_LENGTH', '3', 'Minimum length of Nick Name', '2', '1', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Address Book Entries', 'MAX_ADDRESS_BOOK_ENTRIES', '5', 'Maximum address book entries a customer is allowed to have', '3', '1', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Search Results Per Page', 'MAX_DISPLAY_SEARCH_RESULTS', '20', 'Number of products to list on a search result page', '3', '2', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Prev/Next Navigation Page Links', 'MAX_DISPLAY_PAGE_LINKS', '5', 'Number of \'number\' links use for page-sets', '3', '3', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Products on Special ', 'MAX_DISPLAY_SPECIAL_PRODUCTS', '9', 'Number of products on special to display', '3', '4', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('New Products Module', 'MAX_DISPLAY_NEW_PRODUCTS', '9', 'Number of new products to display in a category', '3', '5', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Upcoming Products ', 'MAX_DISPLAY_UPCOMING_PRODUCTS', '10', 'Number of \'upcoming\' products to display', '3', '6', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Manufacturers List - Scroll Box Size/Style', 'MAX_MANUFACTURERS_LIST', '3', 'Number of manufacturers names to be displayed in the scroll box window. Setting this to 1 or 0 will display a dropdown list.', '3', '7', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Manufacturers List - Verify Product Exist', 'PRODUCTS_MANUFACTURERS_STATUS', '1', 'Verify that at least 1 product exists and is active for the manufacturer name to show<br /><br />Note: When this feature is ON it can produce slower results on sites with a large number of products and/or manufacturers<br />0= off 1= on', 3, 7, 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Music Genre List - Scroll Box Size/Style', 'MAX_MUSIC_GENRES_LIST', '3', 'Number of music genre names to be displayed in the scroll box window. Setting this to 1 or 0 will display a dropdown list.', '3', '7', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Record Company List - Scroll Box Size/Style', 'MAX_RECORD_COMPANY_LIST', '3', 'Number of record company names to be displayed in the scroll box window. Setting this to 1 or 0 will display a dropdown list.', '3', '7', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Length of Record Company Name', 'MAX_DISPLAY_RECORD_COMPANY_NAME_LEN', '15', 'Used in record companies box; maximum length of record company name to display. Longer names will be truncated.', '3', '8', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Length of Music Genre Name', 'MAX_DISPLAY_MUSIC_GENRES_NAME_LEN', '15', 'Used in music genres box; maximum length of music genre name to display. Longer names will be truncated.', '3', '8', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Length of Manufacturers Name', 'MAX_DISPLAY_MANUFACTURER_NAME_LEN', '15', 'Used in manufacturers box; maximum length of manufacturers name to display. Longer names will be truncated.', '3', '8', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('New Product Reviews Per Page', 'MAX_DISPLAY_NEW_REVIEWS', '6', 'Number of new reviews to display on each page', '3', '9', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Random Product Reviews For Box', 'MAX_RANDOM_SELECT_REVIEWS', '10', 'Number of random product reviews to rotate in the box', '3', '10', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Random New Products For Box', 'MAX_RANDOM_SELECT_NEW', '10', 'Number of random new product to display in box', '3', '11', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Random Products On Special For Box', 'MAX_RANDOM_SELECT_SPECIALS', '10', 'Number of random products on special to display in box', '3', '12', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Categories To List Per Row', 'MAX_DISPLAY_CATEGORIES_PER_ROW', '3', 'How many categories to list per row', '3', '13', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('New Products Listing- Number Per Page', 'MAX_DISPLAY_PRODUCTS_NEW', '10', 'Number of new products\' listings per page', '3', '14', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Best Sellers For Box', 'MAX_DISPLAY_BESTSELLERS', '10', 'Number of best sellers to display in box', '3', '15', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Also Purchased Products', 'MAX_DISPLAY_ALSO_PURCHASED', '6', 'Number of products to display in the \'This Customer Also Purchased\' box', '3', '16', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Recent Purchases Box- NOTE: box is disabled ', 'MAX_DISPLAY_PRODUCTS_IN_ORDER_HISTORY_BOX', '6', 'Number of products to display in the recent purchases box', '3', '17', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Customer Order History List Per Page', 'MAX_DISPLAY_ORDER_HISTORY', '10', 'Number of orders to display in the order history list in \'My Account\'', '3', '18', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Maximum Display of Customers on Customers Page', 'MAX_DISPLAY_SEARCH_RESULTS_CUSTOMER', '20', '', 3, 19, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Maximum Display of Orders on Orders Page', 'MAX_DISPLAY_SEARCH_RESULTS_ORDERS', '20', '', 3, 20, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Maximum Display of Products on Reports', 'MAX_DISPLAY_SEARCH_RESULTS_REPORTS', '20', '', 3, 21, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Maximum Categories Products Display List', 'MAX_DISPLAY_RESULTS_CATEGORIES', '10', 'Number of products to list per screen', 3, 22, now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Products Listing- Number Per Page', 'MAX_DISPLAY_PRODUCTS_LISTING', '10', 'Maximum Number of Products to list per page on main page', '3', '30', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Products Attributes - Option Names and Values Display', 'MAX_ROW_LISTS_OPTIONS', '10', 'Maximum number of option names and values to display in the products attributes page', '3', '24', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Products Attributes - Attributes Controller Display', 'MAX_ROW_LISTS_ATTRIBUTES_CONTROLLER', '30', 'Maximum number of attributes to display in the Attributes Controller page', '3', '25', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Products Attributes - Downloads Manager Display', 'MAX_DISPLAY_SEARCH_RESULTS_DOWNLOADS_MANAGER', '30', 'Maximum number of attributes downloads to display in the Downloads Manager page', '3', '26', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Featured Products - Number to Display Admin', 'MAX_DISPLAY_SEARCH_RESULTS_FEATURED_ADMIN', '10', 'Number of featured products to list per screen - Admin', 3, 27, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Maximum Display of Featured Products - Main Page', 'MAX_DISPLAY_SEARCH_RESULTS_FEATURED', '9', 'Number of featured products to list on main page', 3, 28, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Maximum Display of Featured Products Page', 'MAX_DISPLAY_PRODUCTS_FEATURED_PRODUCTS', '10', 'Number of featured products to list per screen', 3, 29, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Random Featured Products For Box', 'MAX_RANDOM_SELECT_FEATURED_PRODUCTS', '10', 'Number of random featured products to display in box', '3', '30', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Maximum Display of Specials Products - Main Page', 'MAX_DISPLAY_SPECIAL_PRODUCTS_INDEX', '9', 'Number of special products to list on main page', 3, 31, now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('New Product Listing - Limited to ...', 'SHOW_NEW_PRODUCTS_LIMIT', '0', 'Limit the New Product Listing to<br />0= All Products<br />1= Current Month<br />7= 7 Days<br />14= 14 Days<br />30= 30 Days<br />60= 60 Days<br />90= 90 Days<br />120= 120 Days', '3', '40', 'zen_cfg_select_option(array(\'0\', \'1\', \'7\', \'14\', \'30\', \'60\', \'90\', \'120\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Maximum Display of Products All Page', 'MAX_DISPLAY_PRODUCTS_ALL', '10', 'Number of products to list per screen', 3, 45, now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Maximum Display of Language Flags in Language Side Box', 'MAX_LANGUAGE_FLAGS_COLUMNS', '3', 'Number of Language Flags per Row', 3, 50, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Maximum File Upload Size', 'MAX_FILE_UPLOAD_SIZE', '2048000', 'What is the Maximum file size for uploads?<br />Default= 2048000', 3, 60, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Allowed Filename Extensions for uploading', 'UPLOAD_FILENAME_EXTENSIONS', 'jpg,jpeg,gif,png,eps,cdr,ai,pdf,tif,tiff,bmp,zip', 'List the permissible filetypes (filename extensions) to be allowed when files are uploaded to your site by customers. Separate multiple values with commas(,). Do not include the dot(.).<br /><br />Suggested setting: "jpg,jpeg,gif,png,eps,cdr,ai,pdf,tif,tiff,bmp,zip"', '3', '61', 'zen_cfg_textarea(', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Maximum Orders Detail Display on Admin Orders Listing', 'MAX_DISPLAY_RESULTS_ORDERS_DETAILS_LISTING', '0', 'Maximum number of Order Details<br />0 = Unlimited', 3, 65, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Maximum PayPal IPN Display on Admin Listing', 'MAX_DISPLAY_SEARCH_RESULTS_PAYPAL_IPN', '20', 'Maximum number of PayPal IPN Lisings in Admin<br />Default is 20', 3, 66, now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Maximum Display Columns Products to Multiple Categories Manager', 'MAX_DISPLAY_PRODUCTS_TO_CATEGORIES_COLUMNS', '3', 'Maximum Display Columns Products to Multiple Categories Manager<br />3 = Default', 3, 70, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Maximum Display EZ-Pages', 'MAX_DISPLAY_SEARCH_RESULTS_EZPAGE', '20', 'Maximum Display EZ-Pages<br />20 = Default', 3, 71, now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Small Image Width', 'SMALL_IMAGE_WIDTH', '100', 'The pixel width of small images', '4', '1', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Small Image Height', 'SMALL_IMAGE_HEIGHT', '80', 'The pixel height of small images', '4', '2', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Heading Image Width - Admin', 'HEADING_IMAGE_WIDTH', '57', 'The pixel width of heading images in the Admin<br />NOTE: Presently, this adjusts the spacing on the pages in the Admin Pages or could be used to add images to the heading in the Admin', '4', '3', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Heading Image Height - Admin', 'HEADING_IMAGE_HEIGHT', '40', 'The pixel height of heading images in the Admin<br />NOTE: Presently, this adjusts the spacing on the pages in the Admin Pages or could be used to add images to the heading in the Admin', '4', '4', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Subcategory Image Width', 'SUBCATEGORY_IMAGE_WIDTH', '100', 'The pixel width of subcategory images', '4', '5', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Subcategory Image Height', 'SUBCATEGORY_IMAGE_HEIGHT', '57', 'The pixel height of subcategory images', '4', '6', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Calculate Image Size', 'CONFIG_CALCULATE_IMAGE_SIZE', 'true', 'Calculate the size of images?', '4', '7', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Image Required', 'IMAGE_REQUIRED', 'true', 'Enable to display broken images. Good for development.', '4', '8', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Image - Shopping Cart Status', 'IMAGE_SHOPPING_CART_STATUS', '1', 'Show product image in the shopping cart?<br />0= off 1= on', 4, 9, 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Image - Shopping Cart Width', 'IMAGE_SHOPPING_CART_WIDTH', '50', 'Default = 50', 4, 10, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Image - Shopping Cart Height', 'IMAGE_SHOPPING_CART_HEIGHT', '40', 'Default = 40', 4, 11, now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Category Icon Image Width - Product Info Pages', 'CATEGORY_ICON_IMAGE_WIDTH', '57', 'The pixel width of Category Icon heading images for Product Info Pages', '4', '13', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Category Icon Image Height - Product Info Pages', 'CATEGORY_ICON_IMAGE_HEIGHT', '40', 'The pixel height of Category Icon heading images for Product Info Pages', '4', '14', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Product Info - Image Width', 'MEDIUM_IMAGE_WIDTH', '150', 'The pixel width of Product Info images', '4', '20', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Product Info - Image Height', 'MEDIUM_IMAGE_HEIGHT', '120', 'The pixel height of Product Info images', '4', '21', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Product Info - Image Medium Suffix', 'IMAGE_SUFFIX_MEDIUM', '_MED', 'Product Info Medium Image Suffix<br />Default = _MED', '4', '22', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Product Info - Image Large Suffix', 'IMAGE_SUFFIX_LARGE', '_LRG', 'Product Info Large Image Suffix<br />Default = _LRG', '4', '23', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Product Info - Number of Additional Images per Row', 'IMAGES_AUTO_ADDED', '3', 'Product Info - Enter the number of additional images to display per row<br />Default = 3', '4', '30', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Image - Product Listing Width', 'IMAGE_PRODUCT_LISTING_WIDTH', '100', 'Default = 100', 4, 40, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Image - Product Listing Height', 'IMAGE_PRODUCT_LISTING_HEIGHT', '80', 'Default = 80', 4, 41, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Image - Product New Listing Width', 'IMAGE_PRODUCT_NEW_LISTING_WIDTH', '100', 'Default = 100', 4, 42, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Image - Product New Listing Height', 'IMAGE_PRODUCT_NEW_LISTING_HEIGHT', '80', 'Default = 80', 4, 43, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Image - New Products Width', 'IMAGE_PRODUCT_NEW_WIDTH', '100', 'Default = 100', 4, 44, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Image - New Products Height', 'IMAGE_PRODUCT_NEW_HEIGHT', '80', 'Default = 80', 4, 45, now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Image - Featured Products Width', 'IMAGE_FEATURED_PRODUCTS_LISTING_WIDTH', '100', 'Default = 100', 4, 46, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Image - Featured Products Height', 'IMAGE_FEATURED_PRODUCTS_LISTING_HEIGHT', '80', 'Default = 80', 4, 47, now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Image - Product All Listing Width', 'IMAGE_PRODUCT_ALL_LISTING_WIDTH', '100', 'Default = 100', 4, 48, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Image - Product All Listing Height', 'IMAGE_PRODUCT_ALL_LISTING_HEIGHT', '80', 'Default = 80', 4, 49, now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Product Image - No Image Status', 'PRODUCTS_IMAGE_NO_IMAGE_STATUS', '1', 'Use automatic No Image when none is added to product<br />0= off<br />1= On', '4', '60', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Product Image - No Image picture', 'PRODUCTS_IMAGE_NO_IMAGE', 'no_picture.gif', 'Use automatic No Image when none is added to product<br />Default = no_picture.gif', '4', '61', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Image - Use Proportional Images on Products and Categories', 'PROPORTIONAL_IMAGES_STATUS', '1', 'Use Proportional Images on Products and Categories?<br /><br />NOTE: Do not use 0 height or width settings for Proportion Images<br />0= off 1= on', 4, 75, 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Email Salutation', 'ACCOUNT_GENDER', 'true', 'Display salutation choice during account creation and with account information', '5', '1', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Date of Birth', 'ACCOUNT_DOB', 'true', 'Display date of birth field during account creation and with account information<br />NOTE: Set Minimum Value Date of Birth to blank for not required<br />Set Minimum Value Date of Birth > 0 to require', '5', '2', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Company', 'ACCOUNT_COMPANY', 'true', 'Display company field during account creation and with account information', '5', '3', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Address Line 2', 'ACCOUNT_SUBURB', 'true', 'Display address line 2 field during account creation and with account information', '5', '4', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('State', 'ACCOUNT_STATE', 'true', 'Display state field during account creation and with account information', '5', '5', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('State - Always display as pulldown?', 'ACCOUNT_STATE_DRAW_INITIAL_DROPDOWN', 'false', 'When state field is displayed, should it always be a pulldown menu?', 5, '5', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Create Account Default Country ID', 'SHOW_CREATE_ACCOUNT_DEFAULT_COUNTRY', '223', 'Set Create Account Default Country ID to:<br />Default is 223', '5', '6', 'zen_get_country_name', 'zen_cfg_pull_down_country_list_none(', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Fax Number', 'ACCOUNT_FAX_NUMBER', 'true', 'Display fax number field during account creation and with account information', '5', '10', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show Newsletter Checkbox', 'ACCOUNT_NEWSLETTER_STATUS', '1', 'Show Newsletter Checkbox<br />0= off<br />1= Display Unchecked<br />2= Display Checked<br /><strong>Note: Defaulting this to accepted may be in violation of certain regulations for your state or country</strong>', 5, 45, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Customer Default Email Preference', 'ACCOUNT_EMAIL_PREFERENCE', '0', 'Set the Default Customer Default Email Preference<br />0= Text<br />1= HTML<br /><strong>Note: Defaulting this to accepted may be in violation of certain regulations for your state or country</strong>', 5, 46, 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Customer Product Notification Status', 'CUSTOMERS_PRODUCTS_NOTIFICATION_STATUS', '1', 'Customer should be asked about product notifications after checkout success<br />0= Never ask<br />1= Ask, unless already set to global<br /><br />Note: Sidebox must be turned off separately', '5', '50', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Customer Shop Status - View Shop and Prices', 'CUSTOMERS_APPROVAL', '0', 'Customer must be approved to shop<br />0= Not required<br />1= Must login to browse<br />2= May browse but no prices unless logged in<br />3= Showroom Only<br /><br />It is recommended that Option 2 be used for the purposes of Spiders if you wish customers to login to see prices.', '5', '55', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'), ', now());

#customer approval to shop
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Customer Approval Status - Authorization Pending', 'CUSTOMERS_APPROVAL_AUTHORIZATION', '0', 'Customer must be Authorized to shop<br />0= Not required<br />1= Must be Authorized to Browse<br />2= May browse but no prices unless Authorized<br />3= Customer May Browse and May see Prices but Must be Authorized to Buy<br /><br />It is recommended that Option 2 or 3 be used for the purposes of Spiders', '5', '65', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added, use_function) VALUES ('Customer Authorization: filename', 'CUSTOMERS_AUTHORIZATION_FILENAME', 'customers_authorization', 'Customer Authorization filename<br />Note: Do not include the extension<br />Default=customers_authorization', '5', '66', '', now(), NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added, use_function) VALUES ('Customer Authorization: Hide Header', 'CUSTOMERS_AUTHORIZATION_HEADER_OFF', 'false', 'Customer Authorization: Hide Header <br />(true=hide false=show)', '5', '67', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now(), NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added, use_function) VALUES ('Customer Authorization: Hide Column Left', 'CUSTOMERS_AUTHORIZATION_COLUMN_LEFT_OFF', 'false', 'Customer Authorization: Hide Column Left <br />(true=hide false=show)', '5', '68', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now(), NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added, use_function) VALUES ('Customer Authorization: Hide Column Right', 'CUSTOMERS_AUTHORIZATION_COLUMN_RIGHT_OFF', 'false', 'Customer Authorization: Hide Column Right <br />(true=hide false=show)', '5', '69', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now(), NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added, use_function) VALUES ('Customer Authorization: Hide Footer', 'CUSTOMERS_AUTHORIZATION_FOOTER_OFF', 'false', 'Customer Authorization: Hide Footer <br />(true=hide false=show)', '5', '70', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now(), NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added, use_function) VALUES ('Customer Authorization: Hide Prices', 'CUSTOMERS_AUTHORIZATION_PRICES_OFF', 'false', 'Customer Authorization: Hide Prices <br />(true=hide false=show)', '5', '71', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now(), NULL);

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Customers Referral Status', 'CUSTOMERS_REFERRAL_STATUS', '0', 'Customers Referral Code is created from<br />0= Off<br />1= 1st Discount Coupon Code used<br />2= Customer can add during create account or edit if blank<br /><br />NOTE: Once the Customers Referral Code has been set it can only be changed in the Admin Customer', '5', '80', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Installed Modules', 'MODULE_PAYMENT_INSTALLED', 'cc.php;cod.php', 'List of payment module filenames separated by a semi-colon. This is automatically updated. No need to edit. (Example: cc.php;cod.php;paypal.php)', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Installed Modules', 'MODULE_ORDER_TOTAL_INSTALLED', 'ot_subtotal.php;ot_tax.php;ot_shipping.php;ot_gv.php;ot_coupon.php;ot_total.php', 'List of order_total module filenames separated by a semi-colon. This is automatically updated. No need to edit. (Example: ot_subtotal.php;ot_tax.php;ot_shipping.php;ot_total.php)', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Installed Modules', 'MODULE_SHIPPING_INSTALLED', 'flat.php', 'List of shipping module filenames separated by a semi-colon. This is automatically updated. No need to edit. (Example: ups.php;flat.php;item.php)', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Enable Cash On Delivery Module', 'MODULE_PAYMENT_COD_STATUS', 'True', 'Do you want to accept Cash On Delevery payments?', '6', '1', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Payment Zone', 'MODULE_PAYMENT_COD_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '2', 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Sort order of display.', 'MODULE_PAYMENT_COD_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) VALUES ('Set Order Status', 'MODULE_PAYMENT_COD_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', '6', '0', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Enable Credit Card Module', 'MODULE_PAYMENT_CC_STATUS', 'True', 'Do you want to accept credit card payments?', '6', '0', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Split Credit Card E-Mail Address', 'MODULE_PAYMENT_CC_EMAIL', '', 'If an e-mail address is entered, the middle digits of the credit card number will be sent to the e-mail address (the outside digits are stored in the database with the middle digits censored)', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Collect & store the CVV number', 'MODULE_PAYMENT_CC_COLLECT_CVV', 'True', 'Do you want to collect the CVV number. Note: If you do the CVV number will be stored in the database in an encoded format.', 6, 0, NULL, '2004-01-11 22:55:51', NULL, 'zen_cfg_select_option(array(\'True\', \'False\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Store the Credit Card Number', 'MODULE_PAYMENT_CC_STORE_NUMBER', 'False', 'Do you want to store the Credit Card Number. Note: The Credit Card Number will be stored unenecrypted, and as such may represent a security problem', 6, 0, NULL, now(), NULL, 'zen_cfg_select_option(array(\'True\', \'False\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Sort order of display.', 'MODULE_PAYMENT_CC_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0' , now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Payment Zone', 'MODULE_PAYMENT_CC_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '2', 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) VALUES ('Set Order Status', 'MODULE_PAYMENT_CC_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', '6', '0', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Enable Flat Shipping', 'MODULE_SHIPPING_FLAT_STATUS', 'True', 'Do you want to offer flat rate shipping?', '6', '0', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Shipping Cost', 'MODULE_SHIPPING_FLAT_COST', '5.00', 'The shipping cost for all orders using this shipping method.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Tax Class', 'MODULE_SHIPPING_FLAT_TAX_CLASS', '0', 'Use the following tax class on the shipping fee.', '6', '0', 'zen_get_tax_class_title', 'zen_cfg_pull_down_tax_classes(', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Tax Basis', 'MODULE_SHIPPING_FLAT_TAX_BASIS', 'Shipping', 'On what basis is Shipping Tax calculated. Options are<br />Shipping - Based on customers Shipping Address<br />Billing Based on customers Billing address<br />Store - Based on Store address if Billing/Shipping Zone equals Store zone', '6', '0', 'zen_cfg_select_option(array(\'Shipping\', \'Billing\', \'Store\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Shipping Zone', 'MODULE_SHIPPING_FLAT_ZONE', '0', 'If a zone is selected, only enable this shipping method for that zone.', '6', '0', 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Sort Order', 'MODULE_SHIPPING_FLAT_SORT_ORDER', '0', 'Sort order of display.', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Default Currency', 'DEFAULT_CURRENCY', 'USD', 'Default Currency', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Default Language', 'DEFAULT_LANGUAGE', 'en', 'Default Language', '6', '0', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Default Order Status For New Orders', 'DEFAULT_ORDERS_STATUS_ID', '1', 'When a new order is created, this order status will be assigned to it.', '6', '0', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Admin configuration_key shows', 'ADMIN_CONFIGURATION_KEY_ON', '0', 'Manually switch to value of 1 to see the configuration_key name in configuration displays', '6', '0', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Country of Origin', 'SHIPPING_ORIGIN_COUNTRY', '223', 'Select the country of origin to be used in shipping quotes.', '7', '1', 'zen_get_country_name', 'zen_cfg_pull_down_country_list(', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Postal Code', 'SHIPPING_ORIGIN_ZIP', 'NONE', 'Enter the Postal Code (ZIP) of the Store to be used in shipping quotes. NOTE: For USA zip codes, only use your 5 digit zip code.', '7', '2', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Enter the Maximum Package Weight you will ship', 'SHIPPING_MAX_WEIGHT', '50', 'Carriers have a max weight limit for a single package. This is a common one for all.', '7', '3', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Package Tare Small to Medium - added percentage:weight', 'SHIPPING_BOX_WEIGHT', '0:3', 'What is the weight of typical packaging of small to medium packages?<br />Example: 10% + 1lb 10:1<br />10% + 0lbs 10:0<br />0% + 5lbs 0:5<br />0% + 0lbs 0:0', '7', '4', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Larger packages - added packaging percentage:weight', 'SHIPPING_BOX_PADDING', '10:0', 'What is the weight of typical packaging for Large packages?<br />Example: 10% + 1lb 10:1<br />10% + 0lbs 10:0<br />0% + 5lbs 0:5<br />0% + 0lbs 0:0', '7', '5', now());

# moved to product_types
#INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Product Virtual Default Status - Skip Shipping Address', 'PRODUCTS_VIRTUAL_DEFAULT', '0', 'What should the Default Virtual Product status be when adding new products?<br /><br />0= Virtual Product Defaults to OFF<br />1= Virtual Product Defaults to ON<br />NOTE: Virtual Products do not require a Shipping Address', '7', '10', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
#INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Product Free Shipping Default Status - Normal Shipping Rules', 'PRODUCTS_IS_ALWAYS_FREE_SHIPPING_DEFAULT', '0', 'What should the Default Free Shipping status be when adding new products?<br /><br />0= Free Shipping Defaults to OFF<br />1= Free Shipping Defaults to ON<br />NOTE: Free Shipping Products require a Shipping Address', '7', '11', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display Number of Boxes and Weight Status', 'SHIPPING_BOX_WEIGHT_DISPLAY', '3', 'Display Shipping Weight and Number of Boxes?<br /><br />0= off<br />1= Boxes Only<br />2= Weight Only<br />3= Both Boxes and Weight', '7', '15', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Shipping Estimator Display Settings for Shopping Cart', 'SHOW_SHIPPING_ESTIMATOR_BUTTON', '1', '<br />0= Off<br />1= Display as Button on Shopping Cart<br />2= Display as Listing on Shopping Cart Page', '7', '20', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), ', now());


INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Order Free Shipping 0 Weight Status', 'ORDER_WEIGHT_ZERO_STATUS', '0', 'If there is no weight to the order, does the order have Free Shipping?<br />0= no<br />1= yes<br /><br />Note: When using Free Shipping, Enable the Free Shipping Module this will only show when shipping is free.', '7', '15', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Image', 'PRODUCT_LIST_IMAGE', '1', 'Do you want to display the Product Image?', '8', '1', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Manufacturer Name','PRODUCT_LIST_MANUFACTURER', '0', 'Do you want to display the Product Manufacturer Name?', '8', '2', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Model', 'PRODUCT_LIST_MODEL', '0', 'Do you want to display the Product Model?', '8', '3', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Name', 'PRODUCT_LIST_NAME', '2', 'Do you want to display the Product Name?', '8', '4', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Price/Add to Cart', 'PRODUCT_LIST_PRICE', '3', 'Do you want to display the Product Price/Add to Cart', '8', '5', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Quantity', 'PRODUCT_LIST_QUANTITY', '0', 'Do you want to display the Product Quantity?', '8', '6', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Weight', 'PRODUCT_LIST_WEIGHT', '0', 'Do you want to display the Product Weight?', '8', '7', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Price/Add to Cart Column Width', 'PRODUCTS_LIST_PRICE_WIDTH', '125', 'Define the width of the Price/Add to Cart column<br />Default= 125', '8', '8', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display Category/Manufacturer Filter (0=off; 1=on)', 'PRODUCT_LIST_FILTER', '1', 'Do you want to display the Category/Manufacturer Filter?', '8', '9', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Prev/Next Split Page Navigation (1-top, 2-bottom, 3-both)', 'PREV_NEXT_BAR_LOCATION', '3', 'Sets the location of the Prev/Next Split Page Navigation', '8', '10', 'zen_cfg_select_option(array(\'1\', \'2\', \'3\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Listing Default Sort Order', 'PRODUCT_LISTING_DEFAULT_SORT_ORDER', '', 'Product Listing Default sort order?<br />NOTE: Leave Blank for Product Sort Order. Sort the Product Listing in the order you wish for the default display to start in to get the sort order setting. Example: 2a', '8', '15', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display Product Add to Cart Button (0=off; 1=on)', 'PRODUCT_LIST_PRICE_BUY_NOW', '1', 'Do you want to display the Add to Cart Button?', '8', '20', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display Multiple Products Qty Box Status and Set Button Location', 'PRODUCT_LISTING_MULTIPLE_ADD_TO_CART', '3', 'Do you want to display Add Multiple Products Qty Box and Set Button Location?<br />0= off<br />1= Top<br />2= Bottom<br />3= Both', '8', '25', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Description', 'PRODUCT_LIST_DESCRIPTION', '150', 'Do you want to display the Product Description?<br /><br />0= OFF<br />150= Suggested Length, or enter the maximum number of characters to display', '8', '30', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Product Listing Ascending Sort Order', 'PRODUCT_LIST_SORT_ORDER_ASCENDING', '+', 'What do you want to use to indicate Sort Order Ascending?<br />Default = +', 8, 40, NULL, now(), NULL, 'zen_cfg_textarea_small(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Product Listing Descending Sort Order', 'PRODUCT_LIST_SORT_ORDER_DESCENDING', '-', 'What do you want to use to indicate Sort Order Descending?<br />Default = -', 8, 41, NULL, now(), NULL, 'zen_cfg_textarea_small(');


INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Check stock level', 'STOCK_CHECK', 'true', 'Check to see if sufficent stock is available', '9', '1', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Subtract stock', 'STOCK_LIMITED', 'true', 'Subtract product in stock by product orders', '9', '2', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Allow Checkout', 'STOCK_ALLOW_CHECKOUT', 'true', 'Allow customer to checkout even if there is insufficient stock', '9', '3', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Mark product out of stock', 'STOCK_MARK_PRODUCT_OUT_OF_STOCK', '***', 'Display something on screen so customer can see which product has insufficient stock', '9', '4', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Stock Re-order level', 'STOCK_REORDER_LEVEL', '5', 'Define when stock needs to be re-ordered', '9', '5', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Products status in Catalog when out of stock should be set to', 'SHOW_PRODUCTS_SOLD_OUT', '0', 'Show Products when out of stock<br /><br />0= set product status to OFF<br />1= leave product status ON', '9', '10', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show Sold Out Image in place of Add to Cart', 'SHOW_PRODUCTS_SOLD_OUT_IMAGE', '1', 'Show Sold Out Image instead of Add to Cart Button<br /><br />0= off<br />1= on', '9', '11', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Product Quantity Decimals', 'QUANTITY_DECIMALS', '0', 'Allow how many decimals on Quantity<br /><br />0= off', '9', '15', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show Shopping Cart - Delete Checkboxes or Delete Button', 'SHOW_SHOPPING_CART_DELETE', '3', 'Show on Shopping Cart Delete Button and/or Checkboxes<br /><br />1= Delete Button Only<br />2= Checkbox Only<br />3= Both Delete Button and Checkbox', '9', '20', 'zen_cfg_select_option(array(\'1\', \'2\', \'3\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show Shopping Cart - Update Cart Button Location', 'SHOW_SHOPPING_CART_UPDATE', '3', 'Show on Shopping Cart Update Cart Button Location as:<br /><br />1= Next to each Qty Box<br />2= Below all Products<br />3= Both Next to each Qty Box and Below all Products<br /><br />Note: this setting controls which of 3 tpl_shopping_cart_default files are called', '9', '22', 'zen_cfg_select_option(array(\'1\', \'2\', \'3\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Store Page Parse Time', 'STORE_PAGE_PARSE_TIME', 'false', 'Store the time it takes to parse a page', '10', '1', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Log Destination', 'STORE_PAGE_PARSE_TIME_LOG', '/var/log/www/zen/page_parse_time.log', 'Directory and filename of the page parse time log', '10', '2', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Log Date Format', 'STORE_PARSE_DATE_TIME_FORMAT', '%d/%m/%Y %H:%M:%S', 'The date format', '10', '3', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display The Page Parse Time', 'DISPLAY_PAGE_PARSE_TIME', 'false', 'Display the page parse time on the bottom of each page<br />You do not need to store the times to display them in the Catalog', '10', '4', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Store Database Queries', 'STORE_DB_TRANSACTIONS', 'false', 'Store the database queries in the page parse time log (PHP4 only)', '10', '5', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('E-Mail Transport Method', 'EMAIL_TRANSPORT', 'sendmail', 'Defines if this server uses a local connection to sendmail or uses an SMTP connection via TCP/IP. Servers running on Windows and MacOS should change this setting to SMTP.<br /><br />SMTPAUTH should only be used if your server requires SMTP authorization to send messages. You must also configure your SMTPAUTH settings in the appropriate fields in this admin section.<br /><br />"Sendmail -f" is only for servers which require the use of the -f parameter to send mail. This is a security setting often used to prevent spoofing. Will cause errors if your host mailserver is not configured to use it.', '12', '1', 'zen_cfg_select_option(array(\'sendmail\', \'sendmail-f\', \'smtp\', \'smtpauth\'),', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('SMTP Email Account Mailbox', 'EMAIL_SMTPAUTH_MAILBOX', 'YourEmailAccountNameHere', 'Enter the mailbox account name (me@mydomain.com) supplied by your host. This is the account name that your host requires for SMTP authentication.<br />Only required if using SMTP Authentication for email.', '12', '101', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('SMTP Email Account Password', 'EMAIL_SMTPAUTH_PASSWORD', 'YourPasswordHere', 'Enter the password for your SMTP mailbox. <br />Only required if using SMTP Authentication for email.', '12', '101', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('SMTP Email Mail Host', 'EMAIL_SMTPAUTH_MAIL_SERVER', 'mail.EnterYourDomain.com', 'Enter the DNS name of your SMTP mail server.<br />ie: mail.mydomain.com<br />or 55.66.77.88<br />Only required if using SMTP Authentication for email.', '12', '101', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('SMTP Email Mail Server Port', 'EMAIL_SMTPAUTH_MAIL_SERVER_PORT', '25', 'Enter the IP port number that your SMTP mailserver operates on.<br />Only required if using SMTP Authentication for email.', '12', '101', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Convert currencies for Text emails', 'CURRENCIES_TRANSLATIONS', '&amp;pound;,¡ò:&amp;euro;,EUR', 'What currency conversions do you need for Text emails?<br />Default = &amp;pound;,¡ò:&amp;euro;,EUR', 12, 120, NULL, '2003-11-21 00:00:00', NULL, 'zen_cfg_textarea_small(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('E-Mail Linefeeds', 'EMAIL_LINEFEED', 'LF', 'Defines the character sequence used to separate mail headers.', '12', '2', 'zen_cfg_select_option(array(\'LF\', \'CRLF\'),', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Use MIME HTML When Sending Emails', 'EMAIL_USE_HTML', 'false', 'Send e-mails in HTML format', '12', '3', 'zen_cfg_select_option(array(\'true\', \'false\'),', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Verify E-Mail Addresses Through DNS', 'ENTRY_EMAIL_ADDRESS_CHECK', 'false', 'Verify e-mail address through a DNS server', '12', '4', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Send E-Mails', 'SEND_EMAILS', 'true', 'Send out e-mails', '12', '5', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Email Archiving Active?', 'EMAIL_ARCHIVE', 'false', 'If you wish to have email messages archived/stored when sent, set this to "true".', '12', '6', 'zen_cfg_select_option(array(\'true\', \'false\'),', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('E-Mail Friendly-Errors', 'EMAIL_FRIENDLY_ERRORS', 'false', 'Do you want to display friendly errors if emails fail?  Setting this to false will display PHP errors and likely cause the script to fail. Only set to false while troubleshooting, and true for a live shop.', '12', '7', 'zen_cfg_select_option(array(\'true\', \'false\'),', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Email Address (Displayed to Contact you)', 'STORE_OWNER_EMAIL_ADDRESS', 'root@localhost', 'Email address of Store Owner.  Used as "display only" when informing customers of how to contact you.', '12', '10', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Email Address (sent FROM)', 'EMAIL_FROM', 'Zen Cart <root@localhost>', 'Address from which email messages will be "sent" by default. Can be over-ridden at compose-time in admin modules.', '12', '11', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function) VALUES ('Emails must send from known domain?', 'EMAIL_SEND_MUST_BE_STORE', 'No', 'Does your mailserver require that all outgoing emails have their "from" address match a known domain that exists on your webserver?<br /><br />This is often set in order to prevent spoofing and spam broadcasts.  If set to Yes, this will cause the email address (sent FROM) to be used as the "from" address on all outgoing mail.', 12, 11, NULL, 'zen_cfg_select_option(array(\'No\', \'Yes\'), ');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function) VALUES ('Email Admin Format?', 'ADMIN_EXTRA_EMAIL_FORMAT', 'TEXT', 'Please select the Admin extra email format', 12, 12, NULL, 'zen_cfg_select_option(array(\'TEXT\', \'HTML\'), ');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Send Copy of Order Confirmation Emails To', 'SEND_EXTRA_ORDER_EMAILS_TO', '', 'Send COPIES of order confirmation emails to the following email addresses, in this format: Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;', '12', '12', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Send Copy of Create Account Emails To - Status', 'SEND_EXTRA_CREATE_ACCOUNT_EMAILS_TO_STATUS', '0', 'Send copy of Create Account Status<br />0= off 1= on', '12', '13', 'zen_cfg_select_option(array(\'0\', \'1\'),', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Send Copy of Create Account Emails To', 'SEND_EXTRA_CREATE_ACCOUNT_EMAILS_TO', '', 'Send copy of Create Account emails to the following email addresses, in this format: Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;', '12', '14', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Send Copy of Tell a Friend Emails To - Status', 'SEND_EXTRA_TELL_A_FRIEND_EMAILS_TO_STATUS', '0', 'Send copy of Tell a Friend Status<br />0= off 1= on', '12', '15', 'zen_cfg_select_option(array(\'0\', \'1\'),', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Send Copy of Tell a Friend Emails To', 'SEND_EXTRA_TELL_A_FRIEND_EMAILS_TO', '', 'Send copy of Tell a Friend emails to the following email addresses, in this format: Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;', '12', '16', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Send Copy of Customer GV Send Emails To - Status', 'SEND_EXTRA_GV_CUSTOMER_EMAILS_TO_STATUS', '0', 'Send copy of Customer GV Send Status<br />0= off 1= on', '12', '17', 'zen_cfg_select_option(array(\'0\', \'1\'),', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Send Copy of Customer GV Send Emails To', 'SEND_EXTRA_GV_CUSTOMER_EMAILS_TO', '', 'Send copy of Customer GV Send emails to the following email addresses, in this format: Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;', '12', '18', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Send Copy of Admin GV Mail Emails To - Status', 'SEND_EXTRA_GV_ADMIN_EMAILS_TO_STATUS', '0', 'Send copy of Admin GV Mail Status<br />0= off 1= on', '12', '19', 'zen_cfg_select_option(array(\'0\', \'1\'),', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Send Copy of Customer Admin GV Mail Emails To', 'SEND_EXTRA_GV_ADMIN_EMAILS_TO', '', 'Send copy of Admin GV Mail emails to the following email addresses, in this format: Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;', '12', '20', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Send Copy of Admin Discount Coupon Mail Emails To - Status', 'SEND_EXTRA_DISCOUNT_COUPON_ADMIN_EMAILS_TO_STATUS', '0', 'Send copy of Admin Discount Coupon Mail Status<br />0= off 1= on', '12', '21', 'zen_cfg_select_option(array(\'0\', \'1\'),', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Send Copy of Customer Admin Discount Coupon Mail Emails To', 'SEND_EXTRA_DISCOUNT_COUPON_ADMIN_EMAILS_TO', '', 'Send copy of Admin Discount Coupon Mail emails to the following email addresses, in this format: Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;', '12', '22', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Send Copy of Admin Orders Status Emails To - Status', 'SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO_STATUS', '0', 'Send copy of Admin Orders Status Status<br />0= off 1= on', '12', '23', 'zen_cfg_select_option(array(\'0\', \'1\'),', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Send Copy of Admin Orders Status Emails To', 'SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO', '', 'Send copy of Admin Orders Status emails to the following email addresses, in this format: Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;', '12', '24', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Send Notice of Pending Reviews Emails To - Status', 'SEND_EXTRA_REVIEW_NOTIFICATION_EMAILS_TO_STATUS', '0', 'Send copy of Pending Reviews Status<br />0= off 1= on', '12', '25', 'zen_cfg_select_option(array(\'0\', \'1\'),', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Send Notice of Pending Reviews Emails To', 'SEND_EXTRA_REVIEW_NOTIFICATION_EMAILS_TO', '', 'Send copy of Pending Reviews emails to the following email addresses, in this format: Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;', '12', '26', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Set "Contact Us" Email Dropdown List', 'CONTACT_US_LIST', '', 'On the "Contact Us" Page, set the list of email addresses , in this format: Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;', '12', '40', 'zen_cfg_textarea(', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Allow Guest To Tell A Friend', 'ALLOW_GUEST_TO_TELL_A_FRIEND', 'false', 'Allow guests to tell a friend about a product. <br />If set to [false], then tell-a-friend will prompt for login if user is not already logged in.', '12', '50', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Contact Us - Show Store Name and Address', 'CONTACT_US_STORE_NAME_ADDRESS', '1', 'Include Store Name and Address<br />0= off 1= on', '12', '50', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Send Low Stock Emails', 'SEND_LOWSTOCK_EMAIL', '0', 'When stock level is at or below low stock level send an email<br />0= off<br />1= on', '12', '60', now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Send Low Stock Emails To', 'SEND_EXTRA_LOW_STOCK_EMAILS_TO', '', 'When stock level is at or below low stock level send an email to this address, in this format: Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;', '12', '61', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display "Newsletter Unsubscribe" Link?', 'SHOW_NEWSLETTER_UNSUBSCRIBE_LINK', 'true', 'Show "Newsletter Unsubscribe" link in the "Information" side-box?', '12', '70', 'zen_cfg_select_option(array(\'true\', \'false\'),', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Audience-Select Count Display', 'AUDIENCE_SELECT_DISPLAY_COUNTS', 'true', 'When displaying lists of available audiences/recipients, should the recipients-count be included? <br /><em>(This may make things slower if you have a lot of customers or complex audience queries)</em>', '12', '90', 'zen_cfg_select_option(array(\'true\', \'false\'),', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Enable Downloads', 'DOWNLOAD_ENABLED', 'true', 'Enable the products download functions.', '13', '1', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Download by Redirect', 'DOWNLOAD_BY_REDIRECT', 'true', 'Use browser redirection for download. Disable on non-Unix systems.<br /><br />Note: Set /pub to 777 when redirect is true', '13', '2', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Download by streaming', 'DOWNLOAD_IN_CHUNKS', 'false', 'If download-by-redirect is disabled, and your PHP memory_limit setting is under 8 MB, you might need to enable this setting so that files are streamed in smaller segments to the browser.<br /><br />Has no effect if Download By Redirect is enabled.', '13', '2', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Download Expiration (Number of Days)' ,'DOWNLOAD_MAX_DAYS', '7', 'Set number of days before the download link expires. 0 means no limit.', '13', '3', '', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Number of Downloads Allowed - Per Product' ,'DOWNLOAD_MAX_COUNT', '5', 'Set the maximum number of downloads. 0 means no download authorized.', '13', '4', '', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Downloads Controller Update Status Value', 'DOWNLOADS_ORDERS_STATUS_UPDATED_VALUE', '4', 'What orders_status resets the Download days and Max Downloads - Default is 4', '13', '10', now(), now(), NULL , NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Downloads Controller Order Status Value >= lower value', 'DOWNLOADS_CONTROLLER_ORDERS_STATUS', '2', 'Downloads Controller Order Status Value - Default >= 2<br /><br />Downloads are available for checkout based on the orders status. Orders with orders status greater than this value will be available for download. The orders status is set for an order by the Payment Modules. Set the lower range for this range.', '13', '12', now(), now(), NULL , NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Downloads Controller Order Status Value <= upper value', 'DOWNLOADS_CONTROLLER_ORDERS_STATUS_END', '4', 'Downloads Controller Order Status Value - Default <= 4<br /><br />Downloads are available for checkout based on the orders status. Orders with orders status less than this value will be available for download. The orders status is set for an order by the Payment Modules.  Set the upper range for this range.', '13', '13', now(), now(), NULL , NULL);

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Enable Price Factor', 'ATTRIBUTES_ENABLED_PRICE_FACTOR', 'true', 'Enable the Attributes Price Factor.', '13', '25', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Enable Qty Price Discount', 'ATTRIBUTES_ENABLED_QTY_PRICES', 'true', 'Enable the Attributes Quantity Price Discounts.', '13', '26', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Enable Attribute Images', 'ATTRIBUTES_ENABLED_IMAGES', 'true', 'Enable the Attributes Images.', '13', '28', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Enable Text Pricing by word or letter', 'ATTRIBUTES_ENABLED_TEXT_PRICES', 'true', 'Enable the Attributes Text Pricing by word or letter.', '13', '35', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Text Pricing - Spaces are Free', 'TEXT_SPACES_FREE', '1', 'On Text pricing Spaces are Free<br /><br />0= off 1= on', '13', '36', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Read Only option type - Ignore for Add to Cart', 'PRODUCTS_OPTIONS_TYPE_READONLY_IGNORED', '1', 'When a Product only uses READONLY attributes, should the Add to Cart button be On or Off?<br />0= OFF<br />1= ON', '13', '37', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());



INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Enable GZip Compression', 'GZIP_LEVEL', '0', '0= off 1= on', '14', '1', 'zen_cfg_select_option(array(\'0\', \'1\'),', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Session Directory', 'SESSION_WRITE_DIRECTORY', '/tmp', 'If sessions are file based, store them in this directory.', '15', '1', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Cookie Domain', 'SESSION_USE_FQDN', 'True', 'If True the full domain name will be used to store the cookie, e.g. www.mydomain.com. If False only a partial domain name will be used, e.g. mydomain.com. If you are unsure about this, always leave set to true.', '15', '2', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Force Cookie Use', 'SESSION_FORCE_COOKIE_USE', 'True', 'Force the use of sessions when cookies are only enabled.', '15', '2', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Check SSL Session ID', 'SESSION_CHECK_SSL_SESSION_ID', 'False', 'Validate the SSL_SESSION_ID on every secure HTTPS page request.', '15', '3', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Check User Agent', 'SESSION_CHECK_USER_AGENT', 'False', 'Validate the clients browser user agent on every page request.', '15', '4', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Check IP Address', 'SESSION_CHECK_IP_ADDRESS', 'False', 'Validate the clients IP address on every page request.', '15', '5', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Prevent Spider Sessions', 'SESSION_BLOCK_SPIDERS', 'True', 'Prevent known spiders from starting a session.', '15', '6', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Recreate Session', 'SESSION_RECREATE', 'True', 'Recreate the session to generate a new session ID when the customer logs on or creates an account (PHP >=4.1 needed).', '15', '7', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('IP to Host Conversion Status', 'SESSION_IP_TO_HOST_ADDRESS', 'true', 'Convert IP Address to Host Address<br /><br />Note: on some servers this can slow down the initial start of a session or execution of Emails', '15', '10', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Length of the redeem code', 'SECURITY_CODE_LENGTH', '10', 'Enter the length of the redeem code<br />The longer the more secure', 16, 1, NULL, now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) VALUES ('Default Order Status For Zero Balance Orders', 'DEFAULT_ZERO_BALANCE_ORDERS_STATUS_ID', '2', 'When an order\'s balance is zero, this order status will be assigned to it.', '16', '0', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('New Signup Discount Coupon ID#', 'NEW_SIGNUP_DISCOUNT_COUPON', '', 'Select the coupon<br />', 16, 75, NULL, now(), NULL, 'zen_cfg_select_coupon_id(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('New Signup Gift Voucher Amount', 'NEW_SIGNUP_GIFT_VOUCHER_AMOUNT', '', 'Leave blank for none<br />Or enter an amount ie. 10 for $10.00', 16, 76, NULL, now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Maximum Discount Coupons Per Page', 'MAX_DISPLAY_SEARCH_RESULTS_DISCOUNT_COUPONS', '20', 'Number of Discount Coupons to list per Page', '16', '81', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Maximum Discount Coupon Report Results Per Page', 'MAX_DISPLAY_SEARCH_RESULTS_DISCOUNT_COUPONS_REPORTS', '20', 'Number of Discount Coupons to list on Reports Page', '16', '81', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('The maximum value of balance of Gift Voucher', 'MAX_GIFT_AMOUNT', '100000', 'The maximum value of the balance of the gift voucher is set. When the gift voucher substitution result exceeds this value, the substitution processing cannot be done. Please specify 100000 or less for a value.', '16', '82', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Credit Card Enable Status - VISA', 'CC_ENABLED_VISA', '1', 'Accept VISA 0= off 1= on', '17', '1', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Credit Card Enable Status - MasterCard', 'CC_ENABLED_MC', '1', 'Accept MasterCard 0= off 1= on', '17', '2', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Credit Card Enable Status - AmericanExpress', 'CC_ENABLED_AMEX', '0', 'Accept AmericanExpress 0= off 1= on', '17', '3', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Credit Card Enable Status - Diners Club', 'CC_ENABLED_DINERS_CLUB', '0', 'Accept Diners Club 0= off 1= on', '17', '4', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Credit Card Enable Status - Discover Card', 'CC_ENABLED_DISCOVER', '0', 'Accept Discover Card 0= off 1= on', '17', '5', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Credit Card Enable Status - JCB', 'CC_ENABLED_JCB', '0', 'Accept JCB 0= off 1= on', '17', '6', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Credit Card Enable Status - AUSTRALIAN BANKCARD', 'CC_ENABLED_AUSTRALIAN_BANKCARD', '0', 'Accept AUSTRALIAN BANKCARD 0= off 1= on', '17', '7', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Credit Card Enabled - Show on Payment', 'SHOW_ACCEPTED_CREDIT_CARDS', '0', 'Show accepted credit cards on Payment page?<br />0= off<br />1= As Text<br />2= As Images<br /><br />Note: images and text must be defined in both the database and language file for specific credit card types.', '17', '50', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('This module is installed', 'MODULE_ORDER_TOTAL_GV_STATUS', 'true', '', 6, 1, NULL, '2003-10-30 22:16:40', NULL, 'zen_cfg_select_option(array(\'true\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Sort Order', 'MODULE_ORDER_TOTAL_GV_SORT_ORDER', '840', 'Sort order of display.', 6, 2, NULL, '2003-10-30 22:16:40', NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Queue Purchases', 'MODULE_ORDER_TOTAL_GV_QUEUE', 'true', 'Do you want to queue purchases of the Gift Voucher?', 6, 3, NULL, '2003-10-30 22:16:40', NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Include Shipping', 'MODULE_ORDER_TOTAL_GV_INC_SHIPPING', 'true', 'Include Shipping in calculation', 6, 5, NULL, '2003-10-30 22:16:40', NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Include Tax', 'MODULE_ORDER_TOTAL_GV_INC_TAX', 'true', 'Include Tax in calculation.', 6, 6, NULL, '2003-10-30 22:16:40', NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Re-calculate Tax', 'MODULE_ORDER_TOTAL_GV_CALC_TAX', 'None', 'Re-Calculate Tax', 6, 7, NULL, '2003-10-30 22:16:40', NULL, 'zen_cfg_select_option(array(\'None\', \'Standard\', \'Credit Note\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Tax Class', 'MODULE_ORDER_TOTAL_GV_TAX_CLASS', '0', 'Use the following tax class when treating Gift Voucher as Credit Note.', 6, 0, NULL, '2003-10-30 22:16:40', 'zen_get_tax_class_title', 'zen_cfg_pull_down_tax_classes(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Credit including Tax', 'MODULE_ORDER_TOTAL_GV_CREDIT_TAX', 'false', 'Add tax to purchased Gift Voucher when crediting to Account', 6, 8, NULL, '2003-10-30 22:16:40', NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('This module is installed', 'MODULE_ORDER_TOTAL_LOWORDERFEE_STATUS', 'true', '', 6, 1, NULL, '2003-10-30 22:16:43', NULL, 'zen_cfg_select_option(array(\'true\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Sort Order', 'MODULE_ORDER_TOTAL_LOWORDERFEE_SORT_ORDER', '400', 'Sort order of display.', 6, 2, NULL, '2003-10-30 22:16:43', NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Allow Low Order Fee', 'MODULE_ORDER_TOTAL_LOWORDERFEE_LOW_ORDER_FEE', 'false', 'Do you want to allow low order fees?', 6, 3, NULL, '2003-10-30 22:16:43', NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Order Fee For Orders Under', 'MODULE_ORDER_TOTAL_LOWORDERFEE_ORDER_UNDER', '50', 'Add the low order fee to orders under this amount.', 6, 4, NULL, '2003-10-30 22:16:43', 'currencies->format', NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Order Fee', 'MODULE_ORDER_TOTAL_LOWORDERFEE_FEE', '5', 'For Percentage Calculation - include a % Example: 10%<br />For a flat amount just enter the amount - Example: 5 for $5.00', 6, 5, NULL, '2003-10-30 22:16:43', '', NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Attach Low Order Fee On Orders Made', 'MODULE_ORDER_TOTAL_LOWORDERFEE_DESTINATION', 'both', 'Attach low order fee for orders sent to the set destination.', 6, 6, NULL, '2003-10-30 22:16:43', NULL, 'zen_cfg_select_option(array(\'national\', \'international\', \'both\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Tax Class', 'MODULE_ORDER_TOTAL_LOWORDERFEE_TAX_CLASS', '0', 'Use the following tax class on the low order fee.', 6, 7, NULL, '2003-10-30 22:16:43', 'zen_get_tax_class_title', 'zen_cfg_pull_down_tax_classes(');

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('No Low Order Fee on Virtual Products', 'MODULE_ORDER_TOTAL_LOWORDERFEE_VIRTUAL', 'false', 'Do not charge Low Order Fee when cart is Virtual Products Only', 6, 8, NULL, '2004-04-20 22:16:43', NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('No Low Order Fee on Gift Vouchers', 'MODULE_ORDER_TOTAL_LOWORDERFEE_GV', 'false', 'Do not charge Low Order Fee when cart is Gift Vouchers Only', 6, 9, NULL, '2004-04-20 22:16:43', NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('This module is installed', 'MODULE_ORDER_TOTAL_SHIPPING_STATUS', 'true', '', 6, 1, NULL, '2003-10-30 22:16:46', NULL, 'zen_cfg_select_option(array(\'true\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Sort Order', 'MODULE_ORDER_TOTAL_SHIPPING_SORT_ORDER', '200', 'Sort order of display.', 6, 2, NULL, '2003-10-30 22:16:46', NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Allow Free Shipping', 'MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING', 'false', 'Do you want to allow free shipping?', 6, 3, NULL, '2003-10-30 22:16:46', NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Free Shipping For Orders Over', 'MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER', '50', 'Provide free shipping for orders over the set amount.', 6, 4, NULL, '2003-10-30 22:16:46', 'currencies->format', NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Provide Free Shipping For Orders Made', 'MODULE_ORDER_TOTAL_SHIPPING_DESTINATION', 'national', 'Provide free shipping for orders sent to the set destination.', 6, 5, NULL, '2003-10-30 22:16:46', NULL, 'zen_cfg_select_option(array(\'national\', \'international\', \'both\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('This module is installed', 'MODULE_ORDER_TOTAL_SUBTOTAL_STATUS', 'true', '', 6, 1, NULL, '2003-10-30 22:16:49', NULL, 'zen_cfg_select_option(array(\'true\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Sort Order', 'MODULE_ORDER_TOTAL_SUBTOTAL_SORT_ORDER', '100', 'Sort order of display.', 6, 2, NULL, '2003-10-30 22:16:49', NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('This module is installed', 'MODULE_ORDER_TOTAL_TAX_STATUS', 'true', '', 6, 1, NULL, '2003-10-30 22:16:52', NULL, 'zen_cfg_select_option(array(\'true\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Sort Order', 'MODULE_ORDER_TOTAL_TAX_SORT_ORDER', '300', 'Sort order of display.', 6, 2, NULL, '2003-10-30 22:16:52', NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('This module is installed', 'MODULE_ORDER_TOTAL_TOTAL_STATUS', 'true', '', 6, 1, NULL, '2003-10-30 22:16:55', NULL, 'zen_cfg_select_option(array(\'true\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Sort Order', 'MODULE_ORDER_TOTAL_TOTAL_SORT_ORDER', '999', 'Sort order of display.', 6, 2, NULL, '2003-10-30 22:16:55', NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Tax Class', 'MODULE_ORDER_TOTAL_COUPON_TAX_CLASS', '0', 'Use the following tax class when treating Discount Coupon as Credit Note.', 6, 0, NULL, '2003-10-30 22:16:36', 'zen_get_tax_class_title', 'zen_cfg_pull_down_tax_classes(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Include Tax', 'MODULE_ORDER_TOTAL_COUPON_INC_TAX', 'true', 'Include Tax in calculation.', 6, 6, NULL, '2003-10-30 22:16:36', NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Sort Order', 'MODULE_ORDER_TOTAL_COUPON_SORT_ORDER', '280', 'Sort order of display.', 6, 2, NULL, '2003-10-30 22:16:36', NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Include Shipping', 'MODULE_ORDER_TOTAL_COUPON_INC_SHIPPING', 'false', 'Include Shipping in calculation', 6, 5, NULL, '2003-10-30 22:16:36', NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('This module is installed', 'MODULE_ORDER_TOTAL_COUPON_STATUS', 'true', '', 6, 1, NULL, '2003-10-30 22:16:36', NULL, 'zen_cfg_select_option(array(\'true\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Re-calculate Tax', 'MODULE_ORDER_TOTAL_COUPON_CALC_TAX', 'Standard', 'Re-Calculate Tax', 6, 7, NULL, '2003-10-30 22:16:36', NULL, 'zen_cfg_select_option(array(\'None\', \'Standard\', \'Credit Note\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Admin Demo Status', 'ADMIN_DEMO', '0', 'Admin Demo should be on?<br />0= off 1= on', 6, 0, 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Product option type Select', 'PRODUCTS_OPTIONS_TYPE_SELECT', '0', 'The number representing the Select type of product option.', 0, NULL, now(), now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Text product option type', 'PRODUCTS_OPTIONS_TYPE_TEXT', '1', 'Numeric value of the text product option type', 6, NULL, now(), now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Radio button product option type', 'PRODUCTS_OPTIONS_TYPE_RADIO', '2', 'Numeric value of the radio button product option type', 6, NULL, now(), now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Check box product option type', 'PRODUCTS_OPTIONS_TYPE_CHECKBOX', '3', 'Numeric value of the check box product option type', 6, NULL, now(), now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('File product option type', 'PRODUCTS_OPTIONS_TYPE_FILE', '4', 'Numeric value of the file product option type', 6, NULL, now(), now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('ID for text and file products options values', 'PRODUCTS_OPTIONS_VALUES_TEXT_ID', '0', 'Numeric value of the products_options_values_id used by the text and file attributes.', 6, NULL, now(), now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Upload prefix', 'UPLOAD_PREFIX', 'upload_', 'Prefix used to differentiate between upload options and other options', 0, NULL, now(), now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Text prefix', 'TEXT_PREFIX', 'txt_', 'Prefix used to differentiate between text option values and other option values', 0, NULL, now(), now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Read Only option type', 'PRODUCTS_OPTIONS_TYPE_READONLY', '5', 'Numeric value of the file product option type', 6, NULL, now(), now(), NULL, NULL);






INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Products Info - Products Option Name Sort Order', 'PRODUCTS_OPTIONS_SORT_ORDER', '0', 'Sort order of Option Names for Products Info<br />0= Sort Order, Option Name<br />1= Option Name', 18, 35, now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Products Info - Product Option Value of Attributes Sort Order', 'PRODUCTS_OPTIONS_SORT_BY_PRICE', '1', 'Sort order of Product Option Values of Attributes for Products Info<br />0= Sort Order, Price<br />1= Sort Order, Option Value Name', 18, 36, now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\'),');

# test remove and only use products_options_images_per_row
#INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Product Info - Number of Attribute Images per Row', 'PRODUCTS_IMAGES_ATTRIBUTES_PER_ROW', '5', 'Product Info - Enter the number of attribute images to display per row<br />Default = 5', '18', '40', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Product Info - Show Option Values Name Below Attributes Image', 'PRODUCT_IMAGES_ATTRIBUTES_NAMES', '1', 'Product Info - Show the name of the Option Value beneath the Attribute Image?<br />0= off 1= on', 18, 41, 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());

# test remove and only use products_options_images_style
#INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Product Info - Show Option Values and Attributes Images for Radio Buttons and Checkboxes', 'PRODUCT_IMAGES_ATTRIBUTES_NAMES_COLUMN', '0', '0= Images Below Option Names<br />1= Element, Image and Option Value<br />2= Element, Image and Option Name Below<br />3= Option Name Below Element and Image<br />4= Element Below Image and Option Name<br />5= Element Above Image and Option Name', 18, 42, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\', \'5\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Product Info - Show Sales Discount Savings Status', 'SHOW_SALE_DISCOUNT_STATUS', '1', 'Product Info - Show the amount of discount savings?<br />0= off 1= on', 18, 45, 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Product Info - Show Sales Discount Savings Dollars or Percentage', 'SHOW_SALE_DISCOUNT', '1', 'Product Info - Show the amount of discount savings display as:<br />1= % off 2= $amount off', 18, 46, 'zen_cfg_select_option(array(\'1\', \'2\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Product Info - Show Sales Discount Savings Percentage Decimals', 'SHOW_SALE_DISCOUNT_DECIMALS', '0', 'Product Info - Show discount savings display as a Percentage with how many decimals?:<br />Default= 0', 18, 47, NULL, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Product Info - Price is Free Image or Text Status', 'OTHER_IMAGE_PRICE_IS_FREE_ON', '1', 'Product Info - Show the Price is Free Image or Text on Displayed Price<br />0= Text<br />1= Image', 18, 50, 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Product Info - Price is Call for Price Image or Text Status', 'PRODUCTS_PRICE_IS_CALL_IMAGE_ON', '1', 'Product Info - Show the Price is Call for Price Image or Text on Displayed Price<br />0= Text<br />1= Image', 18, 51, 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Product Quantity Box Status - Adding New Products', 'PRODUCTS_QTY_BOX_STATUS', '1', 'What should the Default Quantity Box Status be set to when adding New Products?<br /><br />0= off<br />1= on<br />NOTE: This will show a Qty Box when ON and default the Add to Cart to 1', '18', '55', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Product Reviews Require Approval', 'REVIEWS_APPROVAL', '1', 'Do product reviews require approval?<br /><br />Note: When Review Status is off, it will also not show<br /><br />0= off 1= on', '18', '62', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Meta Tags - Include Product Price in Title', 'META_TAG_INCLUDE_PRICE', '1', 'Do you want to include the Product Price in the Meta Tag Title?<br /><br />0= off 1= on', '18', '70', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Meta Tags Generated Description Maximum Length?', 'MAX_META_TAG_DESCRIPTION_LENGTH', '50', 'Set Generated Meta Tag Description Maximum Length to (words) Default 50:', '18', '71', '', '', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Also Purchased Products Columns per Row', 'SHOW_PRODUCT_INFO_COLUMNS_ALSO_PURCHASED_PRODUCTS', '3', 'Also Purchased Products Columns per Row<br />0= off or set the sort order', '18', '72', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\', \'5\', \'6\', \'7\', \'8\', \'9\', \'10\', \'11\', \'12\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Previous Next - Navigation Bar Position', 'PRODUCT_INFO_PREVIOUS_NEXT', '1', 'Location of Previous/Next Navigation Bar<br />0= off<br />1= Top of Page<br />2= Bottom of Page<br />3= Both Top and Bottom of Page', 18, 21, now(), now(), NULL, 'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Off\'), array(\'id\'=>\'1\', \'text\'=>\'Top of Page\'), array(\'id\'=>\'2\', \'text\'=>\'Bottom of Page\'), array(\'id\'=>\'3\', \'text\'=>\'Both Top & Bottom of Page\')),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Previous Next - Sort Order', 'PRODUCT_INFO_PREVIOUS_NEXT_SORT', '1', 'Products Display Order by<br />0= Product ID<br />1= Product Name<br />2= Model<br />3= Price, Product Name<br />4= Price, Model<br />5= Product Name, Model<br />6= Product Sort Order', 18, 22, now(), now(), NULL, 'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Product ID\'), array(\'id\'=>\'1\', \'text\'=>\'Name\'), array(\'id\'=>\'2\', \'text\'=>\'Product Model\'), array(\'id\'=>\'3\', \'text\'=>\'Product Price - Name\'), array(\'id\'=>\'4\', \'text\'=>\'Product Price - Model\'), array(\'id\'=>\'5\', \'text\'=>\'Product Name - Model\'), array(\'id\'=>\'6\', \'text\'=>\'Product Sort Order\')),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Previous Next - Button and Image Status', 'SHOW_PREVIOUS_NEXT_STATUS', '0', 'Button and Product Image status settings are:<br />0= Off<br />1= On', 18, 20, now(), now(), NULL, 'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Off\'), array(\'id\'=>\'1\', \'text\'=>\'On\')),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Previous Next - Button and Image Settings', 'SHOW_PREVIOUS_NEXT_IMAGES', '0', 'Show Previous/Next Button and Product Image Settings<br />0= Button Only<br />1= Button and Product Image<br />2= Product Image Only', 18, 21, now(), now(), NULL, 'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Button Only\'), array(\'id\'=>\'1\', \'text\'=>\'Button and Product Image\'), array(\'id\'=>\'2\', \'text\'=>\'Product Image Only\')),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Previous Next - Image Width?', 'PREVIOUS_NEXT_IMAGE_WIDTH', '50', 'Previous/Next Image Width?', '18', '22', '', '', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Previous Next - Image Height?', 'PREVIOUS_NEXT_IMAGE_HEIGHT', '40', 'Previous/Next Image Height?', '18', '23', '', '', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Previous Next - Navigation Includes Category', 'PRODUCT_INFO_CATEGORIES', '1', 'Product\'s Category Image and Name Alignment Above Previous/Next Navigation Bar<br />0= off<br />1= Align Left<br />2= Align Center<br />3= Align Right', 18, 20, now(), now(), NULL, 'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Off\'), array(\'id\'=>\'1\', \'text\'=>\'Align Left\'), array(\'id\'=>\'2\', \'text\'=>\'Align Center\'), array(\'id\'=>\'3\', \'text\'=>\'Align Right\')),');



INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Column Width - Left Boxes', 'BOX_WIDTH_LEFT', '150px', 'Width of the Left Column Boxes<br />px may be included<br />Default = 150px', 19, 1, NULL, '2003-11-21 22:16:36', NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Column Width - Right Boxes', 'BOX_WIDTH_RIGHT', '150px', 'Width of the Right Column Boxes<br />px may be included<br />Default = 150px', 19, 2, NULL, '2003-11-21 22:16:36', NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Bread Crumbs Navigation Separator', 'BREAD_CRUMBS_SEPARATOR', '&nbsp;::&nbsp;', 'Enter the separator symbol to appear between the Navigation Bread Crumb trail<br />Note: Include spaces with the &amp;nbsp; symbol if you want them part of the separator.<br />Default = &amp;nbsp;::&amp;nbsp;', 19, 3, NULL, '2003-11-21 22:16:36', NULL, 'zen_cfg_textarea_small(');

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Define Breadcrumb Status', 'DEFINE_BREADCRUMB_STATUS', '1', 'Enable the Breadcrumb Trail Links?<br />0= OFF<br />1= ON', 19, 4, 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());


INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Bestsellers - Number Padding', 'BEST_SELLERS_FILLER', '&nbsp;', 'What do you want to Pad the numbers with?<br />Default = &amp;nbsp;', 19, 5, NULL, '2003-11-21 22:16:36', NULL, 'zen_cfg_textarea_small(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Bestsellers - Truncate Product Names', 'BEST_SELLERS_TRUNCATE', '35', 'What size do you want to truncate the Product Names?<br />Default = 35', 19, 6, NULL, '2003-11-21 22:16:36', NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Bestsellers - Truncate Product Names followed by ...', 'BEST_SELLERS_TRUNCATE_MORE', 'true', 'When truncated Product Names follow with ...<br />Default = true', 19, 7, '2003-03-21 13:08:25', '2003-03-21 11:42:47', NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Categories Box - Show Specials Link', 'SHOW_CATEGORIES_BOX_SPECIALS', 'true', 'Show Specials Link in the Categories Box', 19, 8, '2003-03-21 13:08:25', '2003-03-21 11:42:47', NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Categories Box - Show Products New Link', 'SHOW_CATEGORIES_BOX_PRODUCTS_NEW', 'true', 'Show Products New Link in the Categories Box', 19, 9, '2003-03-21 13:08:25', '2003-03-21 11:42:47', NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Shopping Cart Box Status', 'SHOW_SHOPPING_CART_BOX_STATUS', '1', 'Shopping Cart Shows<br />0= Always<br />1= Only when full<br />2= Only when full but not when viewing the Shopping Cart', 19, 10, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Categories Box - Show Featured Products Link', 'SHOW_CATEGORIES_BOX_FEATURED_PRODUCTS', 'true', 'Show Featured Products Link in the Categories Box', 19, 11, '2003-03-21 13:08:25', '2003-03-21 11:42:47', NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Categories Box - Show Products All Link', 'SHOW_CATEGORIES_BOX_PRODUCTS_ALL', 'true', 'Show Products All Link in the Categories Box', 19, 12, '2003-03-21 13:08:25', '2003-03-21 11:42:47', NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Column Left Status - Global', 'COLUMN_LEFT_STATUS', '1', 'Show Column Left, unless page override exists?<br />0= Column Left is always off<br />1= Column Left is on, unless page override', 19, 15, 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Column Right Status - Global', 'COLUMN_RIGHT_STATUS', '1', 'Show Column Right, unless page override exists?<br />0= Column Right is always off<br />1= Column Right is on, unless page override', 19, 16, 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Column Width - Left', 'COLUMN_WIDTH_LEFT', '150px', 'Width of the Left Column<br />px may be included<br />Default = 150px', 19, 20, NULL, '2003-11-21 22:16:36', NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Column Width - Right', 'COLUMN_WIDTH_RIGHT', '150px', 'Width of the Right Column<br />px may be included<br />Default = 150px', 19, 21, NULL, '2003-11-21 22:16:36', NULL, NULL);

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Categories Separator between links Status', 'SHOW_CATEGORIES_SEPARATOR_LINK', '1', 'Show Category Separator between Category Names and Links?<br />0= off<br />1= on', 19, 24, 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Categories Separator between the Category Name and Count', 'CATEGORIES_SEPARATOR', '-&gt;', 'What separator do you want between the Category name and the count?<br />Default = -&amp;gt;', 19, 25, NULL, '2003-11-21 22:16:36', NULL, 'zen_cfg_textarea_small(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Categories Separator between the Category Name and Sub Categories', 'CATEGORIES_SEPARATOR_SUBS', '|_&nbsp;', 'What separator do you want between the Category name and Sub Category Name?<br />Default = |_&amp;nbsp;', 19, 26, NULL, '2004-03-25 22:16:36', NULL, 'zen_cfg_textarea_small(');

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Categories Count Prefix', 'CATEGORIES_COUNT_PREFIX', '&nbsp;(', 'What do you want to Prefix the count with?<br />Default= (', 19, 27, NULL, '2003-01-21 22:16:36', NULL, 'zen_cfg_textarea_small(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Categories Count Suffix', 'CATEGORIES_COUNT_SUFFIX', ')', 'What do you want as a Suffix to the count?<br />Default= )', 19, 28, NULL, '2003-01-21 22:16:36', NULL, 'zen_cfg_textarea_small(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Categories SubCategories Indent', 'CATEGORIES_SUBCATEGORIES_INDENT', '&nbsp;&nbsp;', 'What do you want to use as the subcategories indent?<br />Default= &nbsp;&nbsp;', 19, 29, NULL, '2004-06-24 22:16:36', NULL, 'zen_cfg_textarea_small(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Categories with 0 Products Status', 'CATEGORIES_COUNT_ZERO', '0', 'Show Category Count for 0 Products?<br />0= off<br />1= on', 19, 30, 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Split Categories Box', 'CATEGORIES_SPLIT_DISPLAY', 'True', 'Split the categories box display by product type', 19, 31, 'zen_cfg_select_option(array(\'True\', \'False\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Shopping Cart - Show Totals', 'SHOW_TOTALS_IN_CART', '1', 'Show Totals Above Shopping Cart?<br />0= off<br />1= on: Items Weight Amount<br />2= on: Items Weight Amount, but no weight when 0<br />3= on: Items Amount', 19, 31, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Customer Greeting - Show on Index Page', 'SHOW_CUSTOMER_GREETING', '1', 'Always Show Customer Greeting on Index?<br />0= off<br />1= on', 19, 40, 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Categories - Always Show on Main Page', 'SHOW_CATEGORIES_ALWAYS', '0', 'Always Show Categories on Main Page<br />0= off<br />1= on<br />Default category can be set to Top Level or a Specific Top Level', 19, 45, 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Main Page - Opens with Category', 'CATEGORIES_START_MAIN', '0', '0= Top Level Categories<br />Or enter the Category ID#<br />Note: Sub Categories can also be used Example: 3_10', '19', '46', '', '', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Categories - Always Open to Show SubCategories', 'SHOW_CATEGORIES_SUBCATEGORIES_ALWAYS', '1', 'Always Show Categories and SubCategories<br />0= off, just show Top Categories<br />1= on, Always show Categories and SubCategories when selected', 19, 47, 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Banner Display Groups - Header Position 1', 'SHOW_BANNERS_GROUP_SET1', '', 'The Banner Display Groups can be from 1 Banner Group or Multiple Banner Groups<br /><br />For Multiple Banner Groups enter the Banner Group Name separated by a colon <strong>:</strong><br /><br />Example: Wide-Banners:SideBox-Banners<br /><br />What Banner Group(s) do you want to use in the Header Position 1?<br />Leave blank for none', '19', '55', '', '', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Banner Display Groups - Header Position 2', 'SHOW_BANNERS_GROUP_SET2', '', 'The Banner Display Groups can be from 1 Banner Group or Multiple Banner Groups<br /><br />For Multiple Banner Groups enter the Banner Group Name separated by a colon <strong>:</strong><br /><br />Example: Wide-Banners:SideBox-Banners<br /><br />What Banner Group(s) do you want to use in the Header Position 2?<br />Leave blank for none', '19', '56', '', '', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Banner Display Groups - Header Position 3', 'SHOW_BANNERS_GROUP_SET3', '', 'The Banner Display Groups can be from 1 Banner Group or Multiple Banner Groups<br /><br />For Multiple Banner Groups enter the Banner Group Name separated by a colon <strong>:</strong><br /><br />Example: Wide-Banners:SideBox-Banners<br /><br />What Banner Group(s) do you want to use in the Header Position 3?<br />Leave blank for none', '19', '57', '', '', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Banner Display Groups - Footer Position 1', 'SHOW_BANNERS_GROUP_SET4', '', 'The Banner Display Groups can be from 1 Banner Group or Multiple Banner Groups<br /><br />For Multiple Banner Groups enter the Banner Group Name separated by a colon <strong>:</strong><br /><br />Example: Wide-Banners:SideBox-Banners<br /><br />What Banner Group(s) do you want to use in the Footer Position 1?<br />Leave blank for none', '19', '65', '', '', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Banner Display Groups - Footer Position 2', 'SHOW_BANNERS_GROUP_SET5', '', 'The Banner Display Groups can be from 1 Banner Group or Multiple Banner Groups<br /><br />For Multiple Banner Groups enter the Banner Group Name separated by a colon <strong>:</strong><br /><br />Example: Wide-Banners:SideBox-Banners<br /><br />What Banner Group(s) do you want to use in the Footer Position 2?<br />Leave blank for none', '19', '66', '', '', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Banner Display Groups - Footer Position 3', 'SHOW_BANNERS_GROUP_SET6', 'Wide-Banners', 'The Banner Display Groups can be from 1 Banner Group or Multiple Banner Groups<br /><br />For Multiple Banner Groups enter the Banner Group Name separated by a colon <strong>:</strong><br /><br />Example: Wide-Banners:SideBox-Banners<br /><br />Default Group is Wide-Banners<br /><br />What Banner Group(s) do you want to use in the Footer Position 3?<br />Leave blank for none', '19', '67', '', '', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Banner Display Groups - Side Box banner_box', 'SHOW_BANNERS_GROUP_SET7', 'SideBox-Banners', 'The Banner Display Groups can be from 1 Banner Group or Multiple Banner Groups<br /><br />For Multiple Banner Groups enter the Banner Group Name separated by a colon <strong>:</strong><br /><br />Example: Wide-Banners:SideBox-Banners<br />Default Group is SideBox-Banners<br /><br />What Banner Group(s) do you want to use in the Side Box - banner_box?<br />Leave blank for none', '19', '70', '', '', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Banner Display Groups - Side Box banner_box2', 'SHOW_BANNERS_GROUP_SET8', 'SideBox-Banners', 'The Banner Display Groups can be from 1 Banner Group or Multiple Banner Groups<br /><br />For Multiple Banner Groups enter the Banner Group Name separated by a colon <strong>:</strong><br /><br />Example: Wide-Banners:SideBox-Banners<br />Default Group is SideBox-Banners<br /><br />What Banner Group(s) do you want to use in the Side Box - banner_box2?<br />Leave blank for none', '19', '71', '', '', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Banner Display Group - Side Box banner_box_all', 'SHOW_BANNERS_GROUP_SET_ALL', 'BannersAll', 'The Banner Display Group may only be from one (1) Banner Group for the Banner All sidebox<br /><br />Default Group is BannersAll<br /><br />What Banner Group do you want to use in the Side Box - banner_box_all?<br />Leave blank for none', '19', '72', '', '', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Footer - Show IP Address status', 'SHOW_FOOTER_IP', '1', 'Show Customer IP Address in the Footer<br />0= off<br />1= on<br />Should the Customer IP Address show in the footer?', 19, 80, 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Product Discount Quantities - Add how many blank discounts?', 'DISCOUNT_QTY_ADD', '5', 'How many blank discount quantities should be added for Product Pricing?', '19', '90', '', '', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) VALUES ('Product Discount Quantities - Display how many per row?', 'DISCOUNT_QUANTITY_PRICES_COLUMN', '5', 'How many discount quantities should show per row on Product Info Pages?', '19', '95', '', '', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Categories/Products Display Sort Order', 'CATEGORIES_PRODUCTS_SORT_ORDER', '0', 'Categories/Products Display Sort Order<br />0= Categories/Products Sort Order/Name<br />1= Categories/Products Name<br />2= Products Model<br />3= Products Qty+, Products Name<br />4= Products Qty-, Products Name<br />5= Products Price+, Products Name<br />6= Products Price+, Products Name', '19', '100', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\', \'5\', \'6\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Option Names and Values Global Add, Copy and Delete Features Status', 'OPTION_NAMES_VALUES_GLOBAL_STATUS', '1', 'Option Names and Values Global Add, Copy and Delete Features Status<br />0= Hide Features<br />1= Show Features<br />2= Products Model', '19', '110', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Categories-Tabs Menu ON/OFF', 'CATEGORIES_TABS_STATUS', '1', 'Categories-Tabs<br />This enables the display of your store\'s categories as a menu across the top of your header. There are many potential creative uses for this.<br />0= Hide Categories Tabs<br />1= Show Categories Tabs', '19', '112', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Site Map - include My Account Links?', 'SHOW_ACCOUNT_LINKS_ON_SITE_MAP', 'No', 'Should the links to My Account show up on the site-map?<br />Note: Spiders will try to index this page, and likely should not be sent to secure pages, since there is no benefit in indexing a login page.<br /><br />Default: false', 19, 115, 'zen_cfg_select_option(array(\'Yes\', \'No\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Skip 1-prod Categories', 'SKIP_SINGLE_PRODUCT_CATEGORIES', 'True', 'Skip single-product categories<br />If this option is set to True, then if the customer clicks on a link to a category which only contains a single item, then Zen Cart will take them directly to that product-page, rather than present them with another link to click in order to see the product.<br />Default: True', '19', '120', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now());

# CSS Buttons switch
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('CSS Buttons', 'IMAGE_USE_CSS_BUTTONS', 'No', 'CSS Buttons<br />Use CSS buttons instead of images (GIF/JPG)?<br />Button styles must be configured in the stylesheet if you enable this option.', '19', '147', 'zen_cfg_select_option(array(\'No\', \'Yes\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added, use_function) VALUES ('<strong>Down for Maintenance: ON/OFF</strong>', 'DOWN_FOR_MAINTENANCE', 'false', 'Down for Maintenance <br />(true=on false=off)', '20', '1', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now(), NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added, use_function) VALUES ('Down for Maintenance: filename', 'DOWN_FOR_MAINTENANCE_FILENAME', 'down_for_maintenance', 'Down for Maintenance filename<br />Note: Do not include the extension<br />Default=down_for_maintenance', '20', '2', '', now(), NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added, use_function) VALUES ('Down for Maintenance: Hide Header', 'DOWN_FOR_MAINTENANCE_HEADER_OFF', 'false', 'Down for Maintenance: Hide Header <br />(true=hide false=show)', '20', '3', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now(), NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added, use_function) VALUES ('Down for Maintenance: Hide Column Left', 'DOWN_FOR_MAINTENANCE_COLUMN_LEFT_OFF', 'false', 'Down for Maintenance: Hide Column Left <br />(true=hide false=show)', '20', '4', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now(), NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added, use_function) VALUES ('Down for Maintenance: Hide Column Right', 'DOWN_FOR_MAINTENANCE_COLUMN_RIGHT_OFF', 'false', 'Down for Maintenance: Hide Column Right <br />(true=hide false=show)', '20', '5', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now(), NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added, use_function) VALUES ('Down for Maintenance: Hide Footer', 'DOWN_FOR_MAINTENANCE_FOOTER_OFF', 'false', 'Down for Maintenance: Hide Footer <br />(true=hide false=show)', '20', '6', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now(), NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added, use_function) VALUES ('Down for Maintenance: Hide Prices', 'DOWN_FOR_MAINTENANCE_PRICES_OFF', 'false', 'Down for Maintenance: Hide Prices <br />(true=hide false=show)', '20', '7', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now(), NULL);

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Down For Maintenance (exclude this IP-Address)', 'EXCLUDE_ADMIN_IP_FOR_MAINTENANCE', 'your IP (ADMIN)', 'This IP Address is able to access the website while it is Down For Maintenance (like webmaster)<br />To enter multiple IP Addresses, separate with a comma. If you do not know your IP Address, check in the Footer of your Shop.', 20, 8, '2003-03-21 13:43:22', '2003-03-21 21:20:07', NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('NOTICE PUBLIC Before going Down for Maintenance: ON/OFF', 'WARN_BEFORE_DOWN_FOR_MAINTENANCE', 'false', 'Give a WARNING some time before you put your website Down for Maintenance<br />(true=on false=off)<br />If you set the \'Down For Maintenance: ON/OFF\' to true this will automaticly be updated to false', 20, 9, '2003-03-21 13:08:25', '2003-03-21 11:42:47', NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Date and hours for notice before maintenance', 'PERIOD_BEFORE_DOWN_FOR_MAINTENANCE', '15/05/2003  2-3 PM', 'Date and hours for notice before maintenance website, enter date and hours for maintenance website', 20, 10, '2003-03-21 13:08:25', '2003-03-21 11:42:47', NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Display when webmaster has enabled maintenance', 'DISPLAY_MAINTENANCE_TIME', 'false', 'Display when Webmaster has enabled maintenance <br />(true=on false=off)<br />', 20, 11, '2003-03-21 13:08:25', '2003-03-21 11:42:47', NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Display website maintenance period', 'DISPLAY_MAINTENANCE_PERIOD', 'false', 'Display Website maintenance period <br />(true=on false=off)<br />', 20, 12, '2003-03-21 13:08:25', '2003-03-21 11:42:47', NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Website maintenance period', 'TEXT_MAINTENANCE_PERIOD_TIME', '2h00', 'Enter Website Maintenance period (hh:mm)', 20, 13, '2003-03-21 13:08:25', '2003-03-21 11:42:47', NULL, NULL);

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Confirm Terms and Conditions During Checkout Procedure', 'DISPLAY_CONDITIONS_ON_CHECKOUT', 'false', 'Show the Terms and Conditions during the checkout procedure which the customer must agree to.', '11', '1', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Confirm Privacy Notice During Account Creation Procedure', 'DISPLAY_PRIVACY_CONDITIONS', 'false', 'Show the Privacy Notice during the account creation procedure which the customer must agree to.', '11', '2', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Image', 'PRODUCT_NEW_LIST_IMAGE', '1102', 'Do you want to display the Product Image?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '21', '1', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Quantity', 'PRODUCT_NEW_LIST_QUANTITY', '1202', 'Do you want to display the Product Quantity?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '21', '2', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Buy Now Button', 'PRODUCT_NEW_BUY_NOW', '1300', 'Do you want to display the Product Buy Now Button<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '21', '3', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Name', 'PRODUCT_NEW_LIST_NAME', '2101', 'Do you want to display the Product Name?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '21', '4', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Model', 'PRODUCT_NEW_LIST_MODEL', '2201', 'Do you want to display the Product Model?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '21', '5', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Manufacturer Name','PRODUCT_NEW_LIST_MANUFACTURER', '2302', 'Do you want to display the Product Manufacturer Name?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '21', '6', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Price', 'PRODUCT_NEW_LIST_PRICE', '2402', 'Do you want to display the Product Price<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '21', '7', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Weight', 'PRODUCT_NEW_LIST_WEIGHT', '2502', 'Do you want to display the Product Weight?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '21', '8', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Date Added', 'PRODUCT_NEW_LIST_DATE_ADDED', '2601', 'Do you want to display the Product Date Added?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '21', '9', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display Product Description', 'PRODUCT_NEW_LIST_DESCRIPTION', '1', 'Do you want to display the Product Description - First 150 characters?<br />0= off<br />1= on', '21', '10', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display Product Display - Default Sort Order', 'PRODUCT_NEW_LIST_SORT_DEFAULT', '6', 'What Sort Order Default should be used for New Products Display?<br />Default= 6 for Date New to Old<br /><br />1= Products Name<br />2= Products Name Desc<br />3= Price low to high, Products Name<br />4= Price high to low, Products Name<br />5= Model<br />6= Date Added desc<br />7= Date Added<br />8= Product Sort Order', '21', '11', 'zen_cfg_select_option(array(\'1\', \'2\', \'3\', \'4\', \'5\', \'6\', \'7\', \'8\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Default Products New Group ID', 'PRODUCT_NEW_LIST_GROUP_ID', '21', 'Warning: Only change this if your Products New Group ID has changed from the default of 21<br />What is the configuration_group_id for New Products Listings?', '21', '12', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display Multiple Products Qty Box Status and Set Button Location', 'PRODUCT_NEW_LISTING_MULTIPLE_ADD_TO_CART', '3', 'Do you want to display Add Multiple Products Qty Box and Set Button Location?<br />0= off<br />1= Top<br />2= Bottom<br />3= Both', '21', '25', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Image', 'PRODUCT_FEATURED_LIST_IMAGE', '1102', 'Do you want to display the Product Image?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '22', '1', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Quantity', 'PRODUCT_FEATURED_LIST_QUANTITY', '1202', 'Do you want to display the Product Quantity?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '22', '2', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Buy Now Button', 'PRODUCT_FEATURED_BUY_NOW', '1300', 'Do you want to display the Product Buy Now Button<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '22', '3', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Name', 'PRODUCT_FEATURED_LIST_NAME', '2101', 'Do you want to display the Product Name?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '22', '4', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Model', 'PRODUCT_FEATURED_LIST_MODEL', '2201', 'Do you want to display the Product Model?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '22', '5', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Manufacturer Name','PRODUCT_FEATURED_LIST_MANUFACTURER', '2302', 'Do you want to display the Product Manufacturer Name?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '22', '6', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Price', 'PRODUCT_FEATURED_LIST_PRICE', '2402', 'Do you want to display the Product Price<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '22', '7', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Weight', 'PRODUCT_FEATURED_LIST_WEIGHT', '2502', 'Do you want to display the Product Weight?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '22', '8', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Date Added', 'PRODUCT_FEATURED_LIST_DATE_ADDED', '2601', 'Do you want to display the Product Date Added?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '22', '9', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display Product Description', 'PRODUCT_FEATURED_LIST_DESCRIPTION', '1', 'Do you want to display the Product Description - First 150 characters?', '22', '10', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display Product Display - Default Sort Order', 'PRODUCT_FEATURED_LIST_SORT_DEFAULT', '1', 'What Sort Order Default should be used for Featured Product Display?<br />Default= 1 for Product Name<br /><br />1= Products Name<br />2= Products Name Desc<br />3= Price low to high, Products Name<br />4= Price high to low, Products Name<br />5= Model<br />6= Date Added desc<br />7= Date Added<br />8= Product Sort Order', '22', '11', 'zen_cfg_select_option(array(\'1\', \'2\', \'3\', \'4\', \'5\', \'6\', \'7\', \'8\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Default Featured Products Group ID', 'PRODUCT_FEATURED_LIST_GROUP_ID', '22', 'Warning: Only change this if your Featured Products Group ID has changed from the default of 22<br />What is the configuration_group_id for Featured Products Listings?', '22', '12', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display Multiple Products Qty Box Status and Set Button Location', 'PRODUCT_FEATURED_LISTING_MULTIPLE_ADD_TO_CART', '3', 'Do you want to display Add Multiple Products Qty Box and Set Button Location?<br />0= off<br />1= Top<br />2= Bottom<br />3= Both', '22', '25', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Image', 'PRODUCT_ALL_LIST_IMAGE', '1102', 'Do you want to display the Product Image?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '23', '1', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Quantity', 'PRODUCT_ALL_LIST_QUANTITY', '1202', 'Do you want to display the Product Quantity?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '23', '2', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Buy Now Button', 'PRODUCT_ALL_BUY_NOW', '1300', 'Do you want to display the Product Buy Now Button<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '23', '3', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Name', 'PRODUCT_ALL_LIST_NAME', '2101', 'Do you want to display the Product Name?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '23', '4', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Model', 'PRODUCT_ALL_LIST_MODEL', '2201', 'Do you want to display the Product Model?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '23', '5', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Manufacturer Name','PRODUCT_ALL_LIST_MANUFACTURER', '2302', 'Do you want to display the Product Manufacturer Name?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '23', '6', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Price', 'PRODUCT_ALL_LIST_PRICE', '2402', 'Do you want to display the Product Price<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '23', '7', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Weight', 'PRODUCT_ALL_LIST_WEIGHT', '2502', 'Do you want to display the Product Weight?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '23', '8', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Product Date Added', 'PRODUCT_ALL_LIST_DATE_ADDED', '2601', 'Do you want to display the Product Date Added?<br /><br />0= off<br />1st digit Left or Right<br />2nd and 3rd digit Sort Order<br />4th digit number of breaks after<br />', '23', '9', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display Product Description', 'PRODUCT_ALL_LIST_DESCRIPTION', '1', 'Do you want to display the Product Description - First 150 characters?', '23', '10', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display Product Display - Default Sort Order', 'PRODUCT_ALL_LIST_SORT_DEFAULT', '1', 'What Sort Order Default should be used for All Products Display?<br />Default= 1 for Product Name<br /><br />1= Products Name<br />2= Products Name Desc<br />3= Price low to high, Products Name<br />4= Price high to low, Products Name<br />5= Model<br />6= Date Added desc<br />7= Date Added<br />8= Product Sort Order', '23', '11', 'zen_cfg_select_option(array(\'1\', \'2\', \'3\', \'4\', \'5\', \'6\', \'7\', \'8\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Default Products All Group ID', 'PRODUCT_ALL_LIST_GROUP_ID', '23', 'Warning: Only change this if your Products All Group ID has changed from the default of 23<br />What is the configuration_group_id for Products All Listings?', '23', '12', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Display Multiple Products Qty Box Status and Set Button Location', 'PRODUCT_ALL_LISTING_MULTIPLE_ADD_TO_CART', '3', 'Do you want to display Add Multiple Products Qty Box and Set Button Location?<br />0= off<br />1= Top<br />2= Bottom<br />3= Both', '23', '25', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'), ', now());


INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show New Products on Main Page', 'SHOW_PRODUCT_INFO_MAIN_NEW_PRODUCTS', '1', 'Show New Products on Main Page<br />0= off or set the sort order', '24', '65', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show Featured Products on Main Page', 'SHOW_PRODUCT_INFO_MAIN_FEATURED_PRODUCTS', '2', 'Show Featured Products on Main Page<br />0= off or set the sort order', '24', '66', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show Special Products on Main Page', 'SHOW_PRODUCT_INFO_MAIN_SPECIALS_PRODUCTS', '3', 'Show Special Products on Main Page<br />0= off or set the sort order', '24', '67', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show Upcoming Products on Main Page', 'SHOW_PRODUCT_INFO_MAIN_UPCOMING', '4', 'Show Upcoming Products on Main Page<br />0= off or set the sort order', '24', '68', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show New Products on Main Page - Category with SubCategories', 'SHOW_PRODUCT_INFO_CATEGORY_NEW_PRODUCTS', '1', 'Show New Products on Main Page - Category with SubCategories<br />0= off or set the sort order', '24', '70', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show Featured Products on Main Page - Category with SubCategories', 'SHOW_PRODUCT_INFO_CATEGORY_FEATURED_PRODUCTS', '2', 'Show Featured Products on Main Page - Category with SubCategories<br />0= off or set the sort order', '24', '71', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show Special Products on Main Page - Category with SubCategories', 'SHOW_PRODUCT_INFO_CATEGORY_SPECIALS_PRODUCTS', '3', 'Show Special Products on Main Page - Category with SubCategories<br />0= off or set the sort order', '24', '72', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show Upcoming Products on Main Page - Category with SubCategories', 'SHOW_PRODUCT_INFO_CATEGORY_UPCOMING', '4', 'Show Upcoming Products on Main Page - Category with SubCategories<br />0= off or set the sort order', '24', '73', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show New Products on Main Page - Errors and Missing Products Page', 'SHOW_PRODUCT_INFO_MISSING_NEW_PRODUCTS', '1', 'Show New Products on Main Page - Errors and Missing Product<br />0= off or set the sort order', '24', '75', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show Featured Products on Main Page - Errors and Missing Products Page', 'SHOW_PRODUCT_INFO_MISSING_FEATURED_PRODUCTS', '2', 'Show Featured Products on Main Page - Errors and Missing Product<br />0= off or set the sort order', '24', '76', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show Special Products on Main Page - Errors and Missing Products Page', 'SHOW_PRODUCT_INFO_MISSING_SPECIALS_PRODUCTS', '3', 'Show Special Products on Main Page - Errors and Missing Product<br />0= off or set the sort order', '24', '77', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show Upcoming Products on Main Page - Errors and Missing Products Page', 'SHOW_PRODUCT_INFO_MISSING_UPCOMING', '4', 'Show Upcoming Products on Main Page - Errors and Missing Product<br />0= off or set the sort order', '24', '78', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show New Products - below Product Listing', 'SHOW_PRODUCT_INFO_LISTING_BELOW_NEW_PRODUCTS', '1', 'Show New Products below Product Listing<br />0= off or set the sort order', '24', '85', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show Featured Products - below Product Listing', 'SHOW_PRODUCT_INFO_LISTING_BELOW_FEATURED_PRODUCTS', '2', 'Show Featured Products below Product Listing<br />0= off or set the sort order', '24', '86', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show Special Products - below Product Listing', 'SHOW_PRODUCT_INFO_LISTING_BELOW_SPECIALS_PRODUCTS', '3', 'Show Special Products below Product Listing<br />0= off or set the sort order', '24', '87', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Show Upcoming Products - below Product Listing', 'SHOW_PRODUCT_INFO_LISTING_BELOW_UPCOMING', '4', 'Show Upcoming Products below Product Listing<br />0= off or set the sort order', '24', '88', 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\', \'4\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('New Products Columns per Row', 'SHOW_PRODUCT_INFO_COLUMNS_NEW_PRODUCTS', '3', 'New Products Columns per Row', '24', '95', 'zen_cfg_select_option(array(\'1\', \'2\', \'3\', \'4\', \'5\', \'6\', \'7\', \'8\', \'9\', \'10\', \'11\', \'12\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Featured Products Columns per Row', 'SHOW_PRODUCT_INFO_COLUMNS_FEATURED_PRODUCTS', '3', 'Featured Products Columns per Row', '24', '96', 'zen_cfg_select_option(array(\'1\', \'2\', \'3\', \'4\', \'5\', \'6\', \'7\', \'8\', \'9\', \'10\', \'11\', \'12\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Special Products Columns per Row', 'SHOW_PRODUCT_INFO_COLUMNS_SPECIALS_PRODUCTS', '3', 'Special Products Columns per Row', '24', '97', 'zen_cfg_select_option(array(\'1\', \'2\', \'3\', \'4\', \'5\', \'6\', \'7\', \'8\', \'9\', \'10\', \'11\', \'12\'), ', now());

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Filter Product Listing for Current Top Level Category When Enabled', 'SHOW_PRODUCT_INFO_ALL_PRODUCTS', '1', 'Filter the products when Product Listing is enabled for current Main Category or show products from all categories?<br />0= Filter Off 1=Filter On ', '24', '100', 'zen_cfg_select_option(array(\'0\', \'1\'), ', now());

#Define Page Status
insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Define Main Page Status', 'DEFINE_MAIN_PAGE_STATUS', '1', 'Enable the Defined Main Page Link/Text?<br />0= Link ON, Define Text OFF<br />1= Link ON, Define Text ON<br />2= Link OFF, Define Text ON<br />3= Link OFF, Define Text OFF', '25', '60', now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Define Contact Us Status', 'DEFINE_CONTACT_US_STATUS', '1', 'Enable the Defined Contact Us Link/Text?<br />0= Link ON, Define Text OFF<br />1= Link ON, Define Text ON<br />2= Link OFF, Define Text ON<br />3= Link OFF, Define Text OFF', '25', '61', now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Define Privacy Status', 'DEFINE_PRIVACY_STATUS', '1', 'Enable the Defined Privacy Link/Text?<br />0= Link ON, Define Text OFF<br />1= Link ON, Define Text ON<br />2= Link OFF, Define Text ON<br />3= Link OFF, Define Text OFF', '25', '62', now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Define Shipping & Returns', 'DEFINE_SHIPPINGINFO_STATUS', '1', 'Enable the Defined Shipping & Returns Link/Text?<br />0= Link ON, Define Text OFF<br />1= Link ON, Define Text ON<br />2= Link OFF, Define Text ON<br />3= Link OFF, Define Text OFF', '25', '63', now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Define Conditions of Use', 'DEFINE_CONDITIONS_STATUS', '1', 'Enable the Defined Conditions of Use Link/Text?<br />0= Link ON, Define Text OFF<br />1= Link ON, Define Text ON<br />2= Link OFF, Define Text ON<br />3= Link OFF, Define Text OFF', '25', '64', now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Define Checkout Success', 'DEFINE_CHECKOUT_SUCCESS_STATUS', '1', 'Enable the Defined Checkout Success Link/Text?<br />0= Link ON, Define Text OFF<br />1= Link ON, Define Text ON<br />2= Link OFF, Define Text ON<br />3= Link OFF, Define Text OFF', '25', '65', now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Define Discount Coupon', 'DEFINE_DISCOUNT_COUPON_STATUS', '1', 'Enable the Defined Discount Coupon Link/Text?<br />0= Link ON, Define Text OFF<br />1= Link ON, Define Text ON<br />2= Link OFF, Define Text ON<br />3= Link OFF, Define Text OFF', '25', '66', now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Define Site Map Status', 'DEFINE_SITE_MAP_STATUS', '1', 'Enable the Defined Site Map Link/Text?<br />0= Link ON, Define Text OFF<br />1= Link ON, Define Text ON<br />2= Link OFF, Define Text ON<br />3= Link OFF, Define Text OFF', '25', '67', now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Define Page 2', 'DEFINE_PAGE_2_STATUS', '1', 'Enable the Defined Page 2 Link/Text?<br />0= Link ON, Define Text OFF<br />1= Link ON, Define Text ON<br />2= Link OFF, Define Text ON<br />3= Link OFF, Define Text OFF', '25', '82', now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Define Page 3', 'DEFINE_PAGE_3_STATUS', '1', 'Enable the Defined Page 3 Link/Text?<br />0= Link ON, Define Text OFF<br />1= Link ON, Define Text ON<br />2= Link OFF, Define Text ON<br />3= Link OFF, Define Text OFF', '25', '83', now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');
insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('Define Page 4', 'DEFINE_PAGE_4_STATUS', '1', 'Enable the Defined Page 4 Link/Text?<br />0= Link ON, Define Text OFF<br />1= Link ON, Define Text ON<br />2= Link OFF, Define Text ON<br />3= Link OFF, Define Text OFF', '25', '84', now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\', \'3\'),');

#EZ-Pages settings
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('EZ-Pages Display Status - HeaderBar', 'EZPAGES_STATUS_HEADER', '1', 'Display of EZ-Pages content can be Globally enabled/disabled for the Header Bar<br />0 = Off<br />1 = On<br />2= On ADMIN IP ONLY located in Website Maintenance<br />NOTE: Warning only shows to the Admin and not to the public', 30, 10, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('EZ-Pages Display Status - FooterBar', 'EZPAGES_STATUS_FOOTER', '1', 'Display of EZ-Pages content can be Globally enabled/disabled for the Footer Bar<br />0 = Off<br />1 = On<br />2= On ADMIN IP ONLY located in Website Maintenance<br />NOTE: Warning only shows to the Admin and not to the public', 30, 11, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('EZ-Pages Display Status - Sidebox', 'EZPAGES_STATUS_SIDEBOX', '1', 'Display of EZ-Pages content can be Globally enabled/disabled for the Sidebox<br />0 = Off<br />1 = On<br />2= On ADMIN IP ONLY located in Website Maintenance<br />NOTE: Warning only shows to the Admin and not to the public', 30, 12, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('EZ-Pages Header Link Separator', 'EZPAGES_SEPARATOR_HEADER', '&nbsp;::&nbsp;', 'EZ-Pages Header Link Separator<br />Default = &amp;nbsp;::&amp;nbsp;', 30, 20, NULL, now(), NULL, 'zen_cfg_textarea_small(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('EZ-Pages Footer Link Separator', 'EZPAGES_SEPARATOR_FOOTER', '&nbsp;::&nbsp;', 'EZ-Pages Footer Link Separator<br />Default = &amp;nbsp;::&amp;nbsp;', 30, 21, NULL, now(), NULL, 'zen_cfg_textarea_small(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('EZ-Pages Prev/Next Buttons', 'EZPAGES_SHOW_PREV_NEXT_BUTTONS', '2', 'Display Prev/Continue/Next buttons on EZ-Pages pages?<br />0=OFF (no buttons)<br />1="Continue"<br />2="Prev/Continue/Next"<br /><br />Default setting: 2.', 30, 30, 'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('EZ-Pages Table of Contents for Chapters Status', 'EZPAGES_SHOW_TABLE_CONTENTS', '1', 'Enable EZ-Pages Table of Contents for Chapters?<br />0= OFF<br />1= ON', 30, 35, now(), now(), NULL, 'zen_cfg_select_option(array(\'0\', \'1\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('EZ-Pages Pages to disable headers', 'EZPAGES_DISABLE_HEADER_DISPLAY_LIST', '', 'EZ-Pages "pages" on which to NOT display the normal "header" for your site.<br />Simply list page ID numbers separated by commas with no spaces.<br />Page ID numbers can be obtained from the EZ-Pages screen under Admin->Tools.<br />ie: 1,5,2<br />or leave blank.', 30, 40, NULL, now(), NULL, 'zen_cfg_textarea_small(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('EZ-Pages Pages to disable footers', 'EZPAGES_DISABLE_FOOTER_DISPLAY_LIST', '', 'EZ-Pages "pages" on which to NOT display the normal "footer" for your site.<br />Simply list page ID numbers separated by commas with no spaces.<br />Page ID numbers can be obtained from the EZ-Pages screen under Admin->Tools.<br />ie: 3,7<br />or leave blank.', 30, 41, NULL, now(), NULL, 'zen_cfg_textarea_small(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('EZ-Pages Pages to disable left-column', 'EZPAGES_DISABLE_LEFTCOLUMN_DISPLAY_LIST', '', 'EZ-Pages "pages" on which to NOT display the normal "left" column (of sideboxes) for your site.<br />Simply list page ID numbers separated by commas with no spaces.<br />Page ID numbers can be obtained from the EZ-Pages screen under Admin->Tools.<br />ie: 21<br />or leave blank.', 30, 42, NULL, now(), NULL, 'zen_cfg_textarea_small(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('EZ-Pages Pages to disable right-column', 'EZPAGES_DISABLE_RIGHTCOLUMN_DISPLAY_LIST', '', 'EZ-Pages "pages" on which to NOT display the normal "right" column (of sideboxes) for your site.<br />Simply list page ID numbers separated by commas with no spaces.<br />Page ID numbers can be obtained from the EZ-Pages screen under Admin->Tools.<br />ie: 3,82,13<br />or leave blank.', 30, 43, NULL, now(), NULL, 'zen_cfg_textarea_small(');


INSERT INTO configuration_group VALUES ('1', 'My Store', 'General information about my store', '1', '1');
INSERT INTO configuration_group VALUES ('2', 'Minimum Values', 'The minimum values for functions / data', '2', '1');
INSERT INTO configuration_group VALUES ('3', 'Maximum Values', 'The maximum values for functions / data', '3', '1');
INSERT INTO configuration_group VALUES ('4', 'Images', 'Image parameters', '4', '1');
INSERT INTO configuration_group VALUES ('5', 'Customer Details', 'Customer account configuration', '5', '1');
INSERT INTO configuration_group VALUES ('6', 'Module Options', 'Hidden from configuration', '6', '0');
INSERT INTO configuration_group VALUES ('7', 'Shipping/Packaging', 'Shipping options available at my store', '7', '1');
INSERT INTO configuration_group VALUES ('8', 'Product Listing', 'Product Listing configuration options', '8', '1');
INSERT INTO configuration_group VALUES ('9', 'Stock', 'Stock configuration options', '9', '1');
INSERT INTO configuration_group VALUES ('10', 'Logging', 'Logging configuration options', '10', '1');
INSERT INTO configuration_group VALUES ('11', 'Regulations', 'Regulation options', '16', '1');
INSERT INTO configuration_group VALUES ('12', 'E-Mail Options', 'General settings for E-Mail transport and HTML E-Mails', '12', '1');
INSERT INTO configuration_group VALUES ('13', 'Attribute Settings', 'Configure products attributes settings', '13', '1');
INSERT INTO configuration_group VALUES ('14', 'GZip Compression', 'GZip compression options', '14', '1');
INSERT INTO configuration_group VALUES ('15', 'Sessions', 'Session options', '15', '1');
INSERT INTO configuration_group VALUES ('16', 'GV Coupons', 'Gift Vouchers and Coupons', '16', '1');
INSERT INTO configuration_group VALUES ('17', 'Credit Cards', 'Credit Cards Accepted', '17', '1');
INSERT INTO configuration_group VALUES ('18', 'Product Info', 'Product Info Display Options', '18', '1');
INSERT INTO configuration_group VALUES ('19', 'Layout Settings', 'Layout Options', '19', '1');
INSERT INTO configuration_group VALUES ('20', 'Website Maintenance', 'Website Maintenance Options', '20', '1');
INSERT INTO configuration_group VALUES ('21', 'New Listing', 'New Products Listing', '21', '1');
INSERT INTO configuration_group VALUES ('22', 'Featured Listing', 'Featured Products Listing', '22', '1');
INSERT INTO configuration_group VALUES ('23', 'All Listing', 'All Products Listing', '23', '1');
INSERT INTO configuration_group VALUES ('24', 'Index Listing', 'Index Products Listing', '24', '1');
INSERT INTO configuration_group VALUES ('25', 'Define Page Status', 'Define Main Pages and HTMLArea Options', '25', '1');
INSERT INTO configuration_group VALUES (30, 'EZ-Pages Settings', 'EZ-Pages Settings', 30, '1');

INSERT INTO countries VALUES (240,'Aaland Islands','AX','ALA','1');
INSERT INTO countries VALUES (1,'Afghanistan','AF','AFG','1');
INSERT INTO countries VALUES (2,'Albania','AL','ALB','1');
INSERT INTO countries VALUES (3,'Algeria','DZ','DZA','1');
INSERT INTO countries VALUES (4,'American Samoa','AS','ASM','1');
INSERT INTO countries VALUES (5,'Andorra','AD','AND','1');
INSERT INTO countries VALUES (6,'Angola','AO','AGO','1');
INSERT INTO countries VALUES (7,'Anguilla','AI','AIA','1');
INSERT INTO countries VALUES (8,'Antarctica','AQ','ATA','1');
INSERT INTO countries VALUES (9,'Antigua and Barbuda','AG','ATG','1');
INSERT INTO countries VALUES (10,'Argentina','AR','ARG','1');
INSERT INTO countries VALUES (11,'Armenia','AM','ARM','1');
INSERT INTO countries VALUES (12,'Aruba','AW','ABW','1');
INSERT INTO countries VALUES (13,'Australia','AU','AUS','1');
INSERT INTO countries VALUES (14,'Austria','AT','AUT','5');
INSERT INTO countries VALUES (15,'Azerbaijan','AZ','AZE','1');
INSERT INTO countries VALUES (16,'Bahamas','BS','BHS','1');
INSERT INTO countries VALUES (17,'Bahrain','BH','BHR','1');
INSERT INTO countries VALUES (18,'Bangladesh','BD','BGD','1');
INSERT INTO countries VALUES (19,'Barbados','BB','BRB','1');
INSERT INTO countries VALUES (20,'Belarus','BY','BLR','1');
INSERT INTO countries VALUES (21,'Belgium','BE','BEL','1');
INSERT INTO countries VALUES (22,'Belize','BZ','BLZ','1');
INSERT INTO countries VALUES (23,'Benin','BJ','BEN','1');
INSERT INTO countries VALUES (24,'Bermuda','BM','BMU','1');
INSERT INTO countries VALUES (25,'Bhutan','BT','BTN','1');
INSERT INTO countries VALUES (26,'Bolivia','BO','BOL','1');
INSERT INTO countries VALUES (27,'Bosnia and Herzegowina','BA','BIH','1');
INSERT INTO countries VALUES (28,'Botswana','BW','BWA','1');
INSERT INTO countries VALUES (29,'Bouvet Island','BV','BVT','1');
INSERT INTO countries VALUES (30,'Brazil','BR','BRA','1');
INSERT INTO countries VALUES (31,'British Indian Ocean Territory','IO','IOT','1');
INSERT INTO countries VALUES (32,'Brunei Darussalam','BN','BRN','1');
INSERT INTO countries VALUES (33,'Bulgaria','BG','BGR','1');
INSERT INTO countries VALUES (34,'Burkina Faso','BF','BFA','1');
INSERT INTO countries VALUES (35,'Burundi','BI','BDI','1');
INSERT INTO countries VALUES (36,'Cambodia','KH','KHM','1');
INSERT INTO countries VALUES (37,'Cameroon','CM','CMR','1');
INSERT INTO countries VALUES (38,'Canada','CA','CAN','1');
INSERT INTO countries VALUES (39,'Cape Verde','CV','CPV','1');
INSERT INTO countries VALUES (40,'Cayman Islands','KY','CYM','1');
INSERT INTO countries VALUES (41,'Central African Republic','CF','CAF','1');
INSERT INTO countries VALUES (42,'Chad','TD','TCD','1');
INSERT INTO countries VALUES (43,'Chile','CL','CHL','1');
INSERT INTO countries VALUES (44,'China','CN','CHN','1');
INSERT INTO countries VALUES (45,'Christmas Island','CX','CXR','1');
INSERT INTO countries VALUES (46,'Cocos (Keeling) Islands','CC','CCK','1');
INSERT INTO countries VALUES (47,'Colombia','CO','COL','1');
INSERT INTO countries VALUES (48,'Comoros','KM','COM','1');
INSERT INTO countries VALUES (49,'Congo','CG','COG','1');
INSERT INTO countries VALUES (50,'Cook Islands','CK','COK','1');
INSERT INTO countries VALUES (51,'Costa Rica','CR','CRI','1');
INSERT INTO countries VALUES (52,'Cote D\'Ivoire','CI','CIV','1');
INSERT INTO countries VALUES (53,'Croatia','HR','HRV','1');
INSERT INTO countries VALUES (54,'Cuba','CU','CUB','1');
INSERT INTO countries VALUES (55,'Cyprus','CY','CYP','1');
INSERT INTO countries VALUES (56,'Czech Republic','CZ','CZE','1');
INSERT INTO countries VALUES (57,'Denmark','DK','DNK','1');
INSERT INTO countries VALUES (58,'Djibouti','DJ','DJI','1');
INSERT INTO countries VALUES (59,'Dominica','DM','DMA','1');
INSERT INTO countries VALUES (60,'Dominican Republic','DO','DOM','1');
INSERT INTO countries VALUES (61,'East Timor','TP','TMP','1');
INSERT INTO countries VALUES (62,'Ecuador','EC','ECU','1');
INSERT INTO countries VALUES (63,'Egypt','EG','EGY','1');
INSERT INTO countries VALUES (64,'El Salvador','SV','SLV','1');
INSERT INTO countries VALUES (65,'Equatorial Guinea','GQ','GNQ','1');
INSERT INTO countries VALUES (66,'Eritrea','ER','ERI','1');
INSERT INTO countries VALUES (67,'Estonia','EE','EST','1');
INSERT INTO countries VALUES (68,'Ethiopia','ET','ETH','1');
INSERT INTO countries VALUES (69,'Falkland Islands (Malvinas)','FK','FLK','1');
INSERT INTO countries VALUES (70,'Faroe Islands','FO','FRO','1');
INSERT INTO countries VALUES (71,'Fiji','FJ','FJI','1');
INSERT INTO countries VALUES (72,'Finland','FI','FIN','1');
INSERT INTO countries VALUES (73,'France','FR','FRA','1');
INSERT INTO countries VALUES (74,'France, Metropolitan','FX','FXX','1');
INSERT INTO countries VALUES (75,'French Guiana','GF','GUF','1');
INSERT INTO countries VALUES (76,'French Polynesia','PF','PYF','1');
INSERT INTO countries VALUES (77,'French Southern Territories','TF','ATF','1');
INSERT INTO countries VALUES (78,'Gabon','GA','GAB','1');
INSERT INTO countries VALUES (79,'Gambia','GM','GMB','1');
INSERT INTO countries VALUES (80,'Georgia','GE','GEO','1');
INSERT INTO countries VALUES (81,'Germany','DE','DEU','5');
INSERT INTO countries VALUES (82,'Ghana','GH','GHA','1');
INSERT INTO countries VALUES (83,'Gibraltar','GI','GIB','1');
INSERT INTO countries VALUES (84,'Greece','GR','GRC','1');
INSERT INTO countries VALUES (85,'Greenland','GL','GRL','1');
INSERT INTO countries VALUES (86,'Grenada','GD','GRD','1');
INSERT INTO countries VALUES (87,'Guadeloupe','GP','GLP','1');
INSERT INTO countries VALUES (88,'Guam','GU','GUM','1');
INSERT INTO countries VALUES (89,'Guatemala','GT','GTM','1');
INSERT INTO countries VALUES (90,'Guinea','GN','GIN','1');
INSERT INTO countries VALUES (91,'Guinea-bissau','GW','GNB','1');
INSERT INTO countries VALUES (92,'Guyana','GY','GUY','1');
INSERT INTO countries VALUES (93,'Haiti','HT','HTI','1');
INSERT INTO countries VALUES (94,'Heard and Mc Donald Islands','HM','HMD','1');
INSERT INTO countries VALUES (95,'Honduras','HN','HND','1');
INSERT INTO countries VALUES (96,'Hong Kong','HK','HKG','1');
INSERT INTO countries VALUES (97,'Hungary','HU','HUN','1');
INSERT INTO countries VALUES (98,'Iceland','IS','ISL','1');
INSERT INTO countries VALUES (99,'India','IN','IND','1');
INSERT INTO countries VALUES (100,'Indonesia','ID','IDN','1');
INSERT INTO countries VALUES (101,'Iran (Islamic Republic of)','IR','IRN','1');
INSERT INTO countries VALUES (102,'Iraq','IQ','IRQ','1');
INSERT INTO countries VALUES (103,'Ireland','IE','IRL','1');
INSERT INTO countries VALUES (104,'Israel','IL','ISR','1');
INSERT INTO countries VALUES (105,'Italy','IT','ITA','1');
INSERT INTO countries VALUES (106,'Jamaica','JM','JAM','1');
INSERT INTO countries VALUES (107,'Japan','JP','JPN','1');
INSERT INTO countries VALUES (108,'Jordan','JO','JOR','1');
INSERT INTO countries VALUES (109,'Kazakhstan','KZ','KAZ','1');
INSERT INTO countries VALUES (110,'Kenya','KE','KEN','1');
INSERT INTO countries VALUES (111,'Kiribati','KI','KIR','1');
INSERT INTO countries VALUES (112,'Korea, Democratic People\'s Republic of','KP','PRK','1');
INSERT INTO countries VALUES (113,'Korea, Republic of','KR','KOR','1');
INSERT INTO countries VALUES (114,'Kuwait','KW','KWT','1');
INSERT INTO countries VALUES (115,'Kyrgyzstan','KG','KGZ','1');
INSERT INTO countries VALUES (116,'Lao People\'s Democratic Republic','LA','LAO','1');
INSERT INTO countries VALUES (117,'Latvia','LV','LVA','1');
INSERT INTO countries VALUES (118,'Lebanon','LB','LBN','1');
INSERT INTO countries VALUES (119,'Lesotho','LS','LSO','1');
INSERT INTO countries VALUES (120,'Liberia','LR','LBR','1');
INSERT INTO countries VALUES (121,'Libyan Arab Jamahiriya','LY','LBY','1');
INSERT INTO countries VALUES (122,'Liechtenstein','LI','LIE','1');
INSERT INTO countries VALUES (123,'Lithuania','LT','LTU','1');
INSERT INTO countries VALUES (124,'Luxembourg','LU','LUX','1');
INSERT INTO countries VALUES (125,'Macau','MO','MAC','1');
INSERT INTO countries VALUES (126,'Macedonia, The Former Yugoslav Republic of','MK','MKD','1');
INSERT INTO countries VALUES (127,'Madagascar','MG','MDG','1');
INSERT INTO countries VALUES (128,'Malawi','MW','MWI','1');
INSERT INTO countries VALUES (129,'Malaysia','MY','MYS','1');
INSERT INTO countries VALUES (130,'Maldives','MV','MDV','1');
INSERT INTO countries VALUES (131,'Mali','ML','MLI','1');
INSERT INTO countries VALUES (132,'Malta','MT','MLT','1');
INSERT INTO countries VALUES (133,'Marshall Islands','MH','MHL','1');
INSERT INTO countries VALUES (134,'Martinique','MQ','MTQ','1');
INSERT INTO countries VALUES (135,'Mauritania','MR','MRT','1');
INSERT INTO countries VALUES (136,'Mauritius','MU','MUS','1');
INSERT INTO countries VALUES (137,'Mayotte','YT','MYT','1');
INSERT INTO countries VALUES (138,'Mexico','MX','MEX','1');
INSERT INTO countries VALUES (139,'Micronesia, Federated States of','FM','FSM','1');
INSERT INTO countries VALUES (140,'Moldova, Republic of','MD','MDA','1');
INSERT INTO countries VALUES (141,'Monaco','MC','MCO','1');
INSERT INTO countries VALUES (142,'Mongolia','MN','MNG','1');
INSERT INTO countries VALUES (143,'Montserrat','MS','MSR','1');
INSERT INTO countries VALUES (144,'Morocco','MA','MAR','1');
INSERT INTO countries VALUES (145,'Mozambique','MZ','MOZ','1');
INSERT INTO countries VALUES (146,'Myanmar','MM','MMR','1');
INSERT INTO countries VALUES (147,'Namibia','NA','NAM','1');
INSERT INTO countries VALUES (148,'Nauru','NR','NRU','1');
INSERT INTO countries VALUES (149,'Nepal','NP','NPL','1');
INSERT INTO countries VALUES (150,'Netherlands','NL','NLD','1');
INSERT INTO countries VALUES (151,'Netherlands Antilles','AN','ANT','1');
INSERT INTO countries VALUES (152,'New Caledonia','NC','NCL','1');
INSERT INTO countries VALUES (153,'New Zealand','NZ','NZL','1');
INSERT INTO countries VALUES (154,'Nicaragua','NI','NIC','1');
INSERT INTO countries VALUES (155,'Niger','NE','NER','1');
INSERT INTO countries VALUES (156,'Nigeria','NG','NGA','1');
INSERT INTO countries VALUES (157,'Niue','NU','NIU','1');
INSERT INTO countries VALUES (158,'Norfolk Island','NF','NFK','1');
INSERT INTO countries VALUES (159,'Northern Mariana Islands','MP','MNP','1');
INSERT INTO countries VALUES (160,'Norway','NO','NOR','1');
INSERT INTO countries VALUES (161,'Oman','OM','OMN','1');
INSERT INTO countries VALUES (162,'Pakistan','PK','PAK','1');
INSERT INTO countries VALUES (163,'Palau','PW','PLW','1');
INSERT INTO countries VALUES (164,'Panama','PA','PAN','1');
INSERT INTO countries VALUES (165,'Papua New Guinea','PG','PNG','1');
INSERT INTO countries VALUES (166,'Paraguay','PY','PRY','1');
INSERT INTO countries VALUES (167,'Peru','PE','PER','1');
INSERT INTO countries VALUES (168,'Philippines','PH','PHL','1');
INSERT INTO countries VALUES (169,'Pitcairn','PN','PCN','1');
INSERT INTO countries VALUES (170,'Poland','PL','POL','1');
INSERT INTO countries VALUES (171,'Portugal','PT','PRT','1');
INSERT INTO countries VALUES (172,'Puerto Rico','PR','PRI','1');
INSERT INTO countries VALUES (173,'Qatar','QA','QAT','1');
INSERT INTO countries VALUES (174,'Reunion','RE','REU','1');
INSERT INTO countries VALUES (175,'Romania','RO','ROM','1');
INSERT INTO countries VALUES (176,'Russian Federation','RU','RUS','1');
INSERT INTO countries VALUES (177,'Rwanda','RW','RWA','1');
INSERT INTO countries VALUES (178,'Saint Kitts and Nevis','KN','KNA','1');
INSERT INTO countries VALUES (179,'Saint Lucia','LC','LCA','1');
INSERT INTO countries VALUES (180,'Saint Vincent and the Grenadines','VC','VCT','1');
INSERT INTO countries VALUES (181,'Samoa','WS','WSM','1');
INSERT INTO countries VALUES (182,'San Marino','SM','SMR','1');
INSERT INTO countries VALUES (183,'Sao Tome and Principe','ST','STP','1');
INSERT INTO countries VALUES (184,'Saudi Arabia','SA','SAU','1');
INSERT INTO countries VALUES (185,'Senegal','SN','SEN','1');
INSERT INTO countries VALUES (186,'Seychelles','SC','SYC','1');
INSERT INTO countries VALUES (187,'Sierra Leone','SL','SLE','1');
INSERT INTO countries VALUES (188,'Singapore','SG','SGP', '4');
INSERT INTO countries VALUES (189,'Slovakia (Slovak Republic)','SK','SVK','1');
INSERT INTO countries VALUES (190,'Slovenia','SI','SVN','1');
INSERT INTO countries VALUES (191,'Solomon Islands','SB','SLB','1');
INSERT INTO countries VALUES (192,'Somalia','SO','SOM','1');
INSERT INTO countries VALUES (193,'South Africa','ZA','ZAF','1');
INSERT INTO countries VALUES (194,'South Georgia and the South Sandwich Islands','GS','SGS','1');
INSERT INTO countries VALUES (195,'Spain','ES','ESP','3');
INSERT INTO countries VALUES (196,'Sri Lanka','LK','LKA','1');
INSERT INTO countries VALUES (197,'St. Helena','SH','SHN','1');
INSERT INTO countries VALUES (198,'St. Pierre and Miquelon','PM','SPM','1');
INSERT INTO countries VALUES (199,'Sudan','SD','SDN','1');
INSERT INTO countries VALUES (200,'Suriname','SR','SUR','1');
INSERT INTO countries VALUES (201,'Svalbard and Jan Mayen Islands','SJ','SJM','1');
INSERT INTO countries VALUES (202,'Swaziland','SZ','SWZ','1');
INSERT INTO countries VALUES (203,'Sweden','SE','SWE','1');
INSERT INTO countries VALUES (204,'Switzerland','CH','CHE','1');
INSERT INTO countries VALUES (205,'Syrian Arab Republic','SY','SYR','1');
INSERT INTO countries VALUES (206,'Taiwan','TW','TWN','1');
INSERT INTO countries VALUES (207,'Tajikistan','TJ','TJK','1');
INSERT INTO countries VALUES (208,'Tanzania, United Republic of','TZ','TZA','1');
INSERT INTO countries VALUES (209,'Thailand','TH','THA','1');
INSERT INTO countries VALUES (210,'Togo','TG','TGO','1');
INSERT INTO countries VALUES (211,'Tokelau','TK','TKL','1');
INSERT INTO countries VALUES (212,'Tonga','TO','TON','1');
INSERT INTO countries VALUES (213,'Trinidad and Tobago','TT','TTO','1');
INSERT INTO countries VALUES (214,'Tunisia','TN','TUN','1');
INSERT INTO countries VALUES (215,'Turkey','TR','TUR','1');
INSERT INTO countries VALUES (216,'Turkmenistan','TM','TKM','1');
INSERT INTO countries VALUES (217,'Turks and Caicos Islands','TC','TCA','1');
INSERT INTO countries VALUES (218,'Tuvalu','TV','TUV','1');
INSERT INTO countries VALUES (219,'Uganda','UG','UGA','1');
INSERT INTO countries VALUES (220,'Ukraine','UA','UKR','1');
INSERT INTO countries VALUES (221,'United Arab Emirates','AE','ARE','1');
INSERT INTO countries VALUES (222,'United Kingdom','GB','GBR','1');
INSERT INTO countries VALUES (223,'United States','US','USA', '2');
INSERT INTO countries VALUES (224,'United States Minor Outlying Islands','UM','UMI','1');
INSERT INTO countries VALUES (225,'Uruguay','UY','URY','1');
INSERT INTO countries VALUES (226,'Uzbekistan','UZ','UZB','1');
INSERT INTO countries VALUES (227,'Vanuatu','VU','VUT','1');
INSERT INTO countries VALUES (228,'Vatican City State (Holy See)','VA','VAT','1');
INSERT INTO countries VALUES (229,'Venezuela','VE','VEN','1');
INSERT INTO countries VALUES (230,'Viet Nam','VN','VNM','1');
INSERT INTO countries VALUES (231,'Virgin Islands (British)','VG','VGB','1');
INSERT INTO countries VALUES (232,'Virgin Islands (U.S.)','VI','VIR','1');
INSERT INTO countries VALUES (233,'Wallis and Futuna Islands','WF','WLF','1');
INSERT INTO countries VALUES (234,'Western Sahara','EH','ESH','1');
INSERT INTO countries VALUES (235,'Yemen','YE','YEM','1');
INSERT INTO countries VALUES (236,'Yugoslavia','YU','YUG','1');
INSERT INTO countries VALUES (237,'Zaire','ZR','ZAR','1');
INSERT INTO countries VALUES (238,'Zambia','ZM','ZMB','1');
INSERT INTO countries VALUES (239,'Zimbabwe','ZW','ZWE','1');

INSERT INTO currencies VALUES (1,'US Dollar','USD','$','','.',',','2','1.0000', now());
INSERT INTO currencies VALUES (2,'Euro','EUR','','EUR','.',',','2','1.2039', now());

INSERT INTO languages VALUES (1,'English','en','icon.gif','english',1);

INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'banner_box_all.php', 1, 1, 5, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'banner_box.php', 1, 0, 300, 1, 127);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'banner_box2.php', 1, 1, 15, 1, 15);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'best_sellers.php', 1, 1, 30, 70, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'categories.php', 1, 0, 10, 10, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'currencies.php', 1, 1, 80, 60, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'document_categories.php', 1, 0, 0, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'ezpages.php', 1, 1, -1, 2, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'featured.php', 1, 0, 45, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'information.php', 1, 0, 50, 40, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'languages.php', 1, 1, 70, 50, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'manufacturers.php', 1, 0, 30, 20, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'manufacturer_info.php', 1, 1, 35, 95, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'more_information.php', 1, 0, 200, 200, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'music_genres.php', 1, 1, 0, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'order_history.php', 0, 0, 0, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'product_notifications.php', 1, 1, 55, 85, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'record_companies.php', 1, 1, 0, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'reviews.php', 1, 0, 40, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'search.php', 1, 1, 10, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'search_header.php', 0, 0, 0, 0, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'shopping_cart.php', 1, 1, 20, 30, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'specials.php', 1, 1, 45, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'tell_a_friend.php', 1, 1, 65, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'whats_new.php', 1, 0, 20, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('default_template_settings', 'whos_online.php', 1, 1, 200, 200, 1);

INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'banner_box_all.php', 1, 1, 5, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'banner_box.php', 1, 0, 300, 1, 127);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'banner_box2.php', 1, 1, 15, 1, 15);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'best_sellers.php', 1, 1, 30, 70, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'categories.php', 1, 0, 10, 10, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'currencies.php', 1, 1, 80, 60, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'ezpages.php', 1, 1, -1, 2, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'featured.php', 1, 0, 45, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'information.php', 1, 0, 50, 40, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'languages.php', 1, 1, 70, 50, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'manufacturers.php', 1, 0, 30, 20, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'manufacturer_info.php', 1, 1, 35, 95, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'more_information.php', 1, 0, 200, 200, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'my_broken_box.php', 1, 0, 0, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'order_history.php', 0, 0, 0, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'product_notifications.php', 1, 1, 55, 85, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'reviews.php', 1, 0, 40, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'search.php', 1, 1, 10, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'search_header.php', 0, 0, 0, 0, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'shopping_cart.php', 1, 1, 20, 30, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'specials.php', 1, 1, 45, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'tell_a_friend.php', 1, 1, 65, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'whats_new.php', 1, 0, 20, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('template_default', 'whos_online.php', 1, 1, 200, 200, 1);

INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'banner_box.php', 1, 0, 300, 1, 127);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'banner_box2.php', 1, 1, 15, 1, 15);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'banner_box_all.php', 1, 1, 5, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'best_sellers.php', 1, 1, 30, 70, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'categories.php', 1, 0, 10, 10, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'currencies.php', 1, 1, 80, 60, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'document_categories.php', 1, 0, 0, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'ezpages.php', 1, 1, -1, 2, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'featured.php', 1, 0, 45, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'information.php', 1, 0, 50, 40, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'languages.php', 1, 1, 70, 50, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'manufacturers.php', 1, 0, 30, 20, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'manufacturer_info.php', 1, 1, 35, 95, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'more_information.php', 1, 0, 200, 200, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'music_genres.php', 1, 1, 0, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'order_history.php', 0, 0, 0, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'product_notifications.php', 1, 1, 55, 85, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'record_companies.php', 1, 1, 0, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'reviews.php', 1, 0, 40, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'search.php', 1, 1, 10, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'search_header.php', 0, 0, 0, 0, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'shopping_cart.php', 1, 1, 20, 30, 1);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'specials.php', 1, 1, 45, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'tell_a_friend.php', 1, 1, 65, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'whats_new.php', 1, 0, 20, 0, 0);
INSERT INTO layout_boxes (layout_template, layout_box_name, layout_box_status, layout_box_location, layout_box_sort_order, layout_box_sort_order_single, layout_box_status_single) VALUES ('classic', 'whos_online.php', 1, 1, 200, 200, 1);

INSERT INTO orders_status VALUES ( '1', '1', 'Pending');
INSERT INTO orders_status VALUES ( '2', '1', 'Processing');
INSERT INTO orders_status VALUES ( '3', '1', 'Delivered');
INSERT INTO orders_status VALUES ( '4', '1', 'Update');

INSERT INTO product_types VALUES (1, 'Product - General', 'product', '1', 'Y', '', now(), now());
INSERT INTO product_types VALUES (2, 'Product - Music', 'product_music', '1', 'Y', '', now(), now());
INSERT INTO product_types VALUES (3, 'Document - General', 'document_general', '3', 'N', '', now(), now());
INSERT INTO product_types VALUES (4, 'Document - Product', 'document_product', '3', 'Y', '', now(), now());
INSERT INTO product_types VALUES (5, 'Product - Free Shipping', 'product_free_shipping', '1', 'Y', '', now(), now());

INSERT INTO products_options_types (products_options_types_id, products_options_types_name) VALUES (0, 'Dropdown');
INSERT INTO products_options_types (products_options_types_id, products_options_types_name) VALUES (1, 'Text');
INSERT INTO products_options_types (products_options_types_id, products_options_types_name) VALUES (2, 'Radio');
INSERT INTO products_options_types (products_options_types_id, products_options_types_name) VALUES (3, 'Checkbox');
INSERT INTO products_options_types (products_options_types_id, products_options_types_name) VALUES (4, 'File');
INSERT INTO products_options_types (products_options_types_id, products_options_types_name) VALUES (5, 'Read Only');

INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name) VALUES (0, 1, 'TEXT');
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name) VALUES (0, 2, 'TEXT');

# USA
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

# Canada
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

# Germany
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

# Austria
INSERT INTO zones VALUES (95,14,'WI','Wien');
INSERT INTO zones VALUES (96,14,'NO','Niedersterreich');
INSERT INTO zones VALUES (97,14,'OO','Obersterreich');
INSERT INTO zones VALUES (98,14,'SB','Salzburg');
INSERT INTO zones VALUES (99,14,'KN','Kten');
INSERT INTO zones VALUES (100,14,'ST','Steiermark');
INSERT INTO zones VALUES (101,14,'TI','Tirol');
INSERT INTO zones VALUES (102,14,'BL','Burgenland');
INSERT INTO zones VALUES (103,14,'VB','Voralberg');

# Swizterland
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

# Spain
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'A Corua','A Corua');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Alava','Alava');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Albacete','Albacete');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Alicante','Alicante');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Almeria','Almeria');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Asturias','Asturias');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Avila','Avila');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Badajoz','Badajoz');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Baleares','Baleares');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Barcelona','Barcelona');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Burgos','Burgos');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Caceres','Caceres');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Cadiz','Cadiz');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Cantabria','Cantabria');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Castellon','Castellon');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Ceuta','Ceuta');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Ciudad Real','Ciudad Real');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Cordoba','Cordoba');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Cuenca','Cuenca');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Girona','Girona');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Granada','Granada');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Guadalajara','Guadalajara');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Guipuzcoa','Guipuzcoa');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Huelva','Huelva');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Huesca','Huesca');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Jaen','Jaen');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'La Rioja','La Rioja');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Las Palmas','Las Palmas');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Leon','Leon');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Lleida','Lleida');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Lugo','Lugo');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Madrid','Madrid');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Malaga','Malaga');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Melilla','Melilla');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Murcia','Murcia');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Navarra','Navarra');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Ourense','Ourense');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Palencia','Palencia');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Pontevedra','Pontevedra');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Salamanca','Salamanca');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Santa Cruz de Tenerife','Santa Cruz de Tenerife');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Segovia','Segovia');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Sevilla','Sevilla');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Soria','Soria');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Tarragona','Tarragona');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Teruel','Teruel');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Toledo','Toledo');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Valencia','Valencia');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Valladolid','Valladolid');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Vizcaya','Vizcaya');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Zamora','Zamora');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (195,'Zaragoza','Zaragoza');


INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Model Number', 'SHOW_PRODUCT_INFO_MODEL', '1', 'Display Model Number on Product Info 0= off 1= on', '1', '1', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Weight', 'SHOW_PRODUCT_INFO_WEIGHT', '1', 'Display Weight on Product Info 0= off 1= on', '1', '2', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Attribute Weight', 'SHOW_PRODUCT_INFO_WEIGHT_ATTRIBUTES', '1', 'Display Attribute Weight on Product Info 0= off 1= on', '1', '3', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Manufacturer', 'SHOW_PRODUCT_INFO_MANUFACTURER', '1', 'Display Manufacturer Name on Product Info 0= off 1= on', '1', '4', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Quantity in Shopping Cart', 'SHOW_PRODUCT_INFO_IN_CART_QTY', '1', 'Display Quantity in Current Shopping Cart on Product Info 0= off 1= on', '1', '5', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Quantity in Stock', 'SHOW_PRODUCT_INFO_QUANTITY', '1', 'Display Quantity in Stock on Product Info 0= off 1= on', '1', '6', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product Reviews Count', 'SHOW_PRODUCT_INFO_REVIEWS_COUNT', '1', 'Display Product Reviews Count on Product Info 0= off 1= on', '1', '7', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product Reviews Button', 'SHOW_PRODUCT_INFO_REVIEWS', '1', 'Display Product Reviews Button on Product Info 0= off 1= on', '1', '8', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Date Available', 'SHOW_PRODUCT_INFO_DATE_AVAILABLE', '1', 'Display Date Available on Product Info 0= off 1= on', '1', '9', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Date Added', 'SHOW_PRODUCT_INFO_DATE_ADDED', '1', 'Display Date Added on Product Info 0= off 1= on', '1', '10', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product URL', 'SHOW_PRODUCT_INFO_URL', '1', 'Display URL on Product Info 0= off 1= on', '1', '11', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product Additional Images', 'SHOW_PRODUCT_INFO_ADDITIONAL_IMAGES', '1', 'Display Additional Images on Product Info 0= off 1= on', '1', '13', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());

INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Starting At text on Price', 'SHOW_PRODUCT_INFO_STARTING_AT', '1', 'Display Starting At text on products with attributes Product Info 0= off 1= on', '1', '12', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());

INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product Tell a Friend button', 'SHOW_PRODUCT_INFO_TELL_A_FRIEND', '1', 'Display the Tell a Friend button on Product Info<br /><br />Note: Turning this setting off does not affect the Tell a Friend box in the columns and turning off the Tell a Friend box does not affect the button<br />0= off 1= on', '1', '15', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Product Free Shipping Image Status - Catalog', 'SHOW_PRODUCT_INFO_ALWAYS_FREE_SHIPPING_IMAGE_SWITCH', '0', 'Show the Free Shipping image/text in the catalog?', '1', '16', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
#admin defaults
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, use_function, set_function, date_added) VALUES ('Product Price Tax Class Default - When adding new products?', 'DEFAULT_PRODUCT_TAX_CLASS_ID', '0', 'What should the Product Price Tax Class Default ID be when adding new products?', '1', '100', '', '', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Product Virtual Default Status - Skip Shipping Address - When adding new products?', 'DEFAULT_PRODUCT_PRODUCTS_VIRTUAL', '0', 'Default Virtual Product status to be ON when adding new products?', '1', '101', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());

INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Product Free Shipping Default Status - Normal Shipping Rules - When adding new products?', 'DEFAULT_PRODUCT_PRODUCTS_IS_ALWAYS_FREE_SHIPPING', '0', 'What should the Default Free Shipping status be when adding new products?<br />Yes, Always Free Shipping ON<br />No, Always Free Shipping OFF<br />Special, Product/Download Requires Shipping', '1', '102', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes, Always ON\'), array(\'id\'=>\'0\', \'text\'=>\'No, Always OFF\'), array(\'id\'=>\'2\', \'text\'=>\'Special\')), ', now());


INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Model Number', 'SHOW_PRODUCT_MUSIC_INFO_MODEL', '1', 'Display Model Number on Product Info 0= off 1= on', '2', '1', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Weight', 'SHOW_PRODUCT_MUSIC_INFO_WEIGHT', '0', 'Display Weight on Product Info 0= off 1= on', '2', '2', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Attribute Weight', 'SHOW_PRODUCT_MUSIC_INFO_WEIGHT_ATTRIBUTES', '1', 'Display Attribute Weight on Product Info 0= off 1= on', '2', '3', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Artist', 'SHOW_PRODUCT_MUSIC_INFO_ARTIST', '1', 'Display Artists Name on Product Info 0= off 1= on', '2', '4', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Music Genre', 'SHOW_PRODUCT_MUSIC_INFO_GENRE', '1', 'Display Music Genre on Product Info 0= off 1= on', '2', '4', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Record Company', 'SHOW_PRODUCT_MUSIC_INFO_RECORD_COMPANY', '1', 'Display Recoprd Company on Product Info 0= off 1= on', '2', '4', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Quantity in Shopping Cart', 'SHOW_PRODUCT_MUSIC_INFO_IN_CART_QTY', '1', 'Display Quantity in Current Shopping Cart on Product Info 0= off 1= on', '2', '5', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Quantity in Stock', 'SHOW_PRODUCT_MUSIC_INFO_QUANTITY', '0', 'Display Quantity in Stock on Product Info 0= off 1= on', '2', '6', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product Reviews Count', 'SHOW_PRODUCT_MUSIC_INFO_REVIEWS_COUNT', '1', 'Display Product Reviews Count on Product Info 0= off 1= on', '2', '7', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product Reviews Button', 'SHOW_PRODUCT_MUSIC_INFO_REVIEWS', '1', 'Display Product Reviews Button on Product Info 0= off 1= on', '2', '8', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Date Available', 'SHOW_PRODUCT_MUSIC_INFO_DATE_AVAILABLE', '1', 'Display Date Available on Product Info 0= off 1= on', '2', '9', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Date Added', 'SHOW_PRODUCT_MUSIC_INFO_DATE_ADDED', '1', 'Display Date Added on Product Info 0= off 1= on', '2', '10', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());

INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Starting At text on Price', 'SHOW_PRODUCT_MUSIC_INFO_STARTING_AT', '1', 'Display Starting At text on products with attributes Product Info 0= off 1= on', '2', '12', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product Additional Images', 'SHOW_PRODUCT_MUSIC_INFO_ADDITIONAL_IMAGES', '1', 'Display Additional Images on Product Info 0= off 1= on', '2', '13', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());

INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product Tell a Friend button', 'SHOW_PRODUCT_MUSIC_INFO_TELL_A_FRIEND', '1', 'Display the Tell a Friend button on Product Info<br /><br />Note: Turning this setting off does not affect the Tell a Friend box in the columns and turning off the Tell a Friend box does not affect the button<br />0= off 1= on', '2', '15', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Product Free Shipping Image Status - Catalog', 'SHOW_PRODUCT_MUSIC_INFO_ALWAYS_FREE_SHIPPING_IMAGE_SWITCH', '0', 'Show the Free Shipping image/text in the catalog?', '2', '16', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
#admin defaults
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, use_function, set_function, date_added) VALUES ('Product Price Tax Class Default - When adding new products?', 'DEFAULT_PRODUCT_MUSIC_TAX_CLASS_ID', '0', 'What should the Product Price Tax Class Default ID be when adding new products?', '2', '100', '', '', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Product Virtual Default Status - Skip Shipping Address - When adding new products?', 'DEFAULT_PRODUCT_MUSIC_PRODUCTS_VIRTUAL', '0', 'Default Virtual Product status to be ON when adding new products?', '2', '101', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Product Free Shipping Default Status - Normal Shipping Rules - When adding new products?', 'DEFAULT_PRODUCT_MUSIC_PRODUCTS_IS_ALWAYS_FREE_SHIPPING', '0', 'What should the Default Free Shipping status be when adding new products?<br />Yes, Always Free Shipping ON<br />No, Always Free Shipping OFF<br />Special, Product/Download Requires Shipping', '2', '102', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes, Always ON\'), array(\'id\'=>\'0\', \'text\'=>\'No, Always OFF\'), array(\'id\'=>\'2\', \'text\'=>\'Special\')), ', now());


INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product Reviews Count', 'SHOW_DOCUMENT_GENERAL_INFO_REVIEWS_COUNT', '1', 'Display Product Reviews Count on Product Info 0= off 1= on', '3', '7', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product Reviews Button', 'SHOW_DOCUMENT_GENERAL_INFO_REVIEWS', '1', 'Display Product Reviews Button on Product Info 0= off 1= on', '3', '8', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Date Available', 'SHOW_DOCUMENT_GENERAL_INFO_DATE_AVAILABLE', '1', 'Display Date Available on Product Info 0= off 1= on', '3', '9', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Date Added', 'SHOW_DOCUMENT_GENERAL_INFO_DATE_ADDED', '1', 'Display Date Added on Product Info 0= off 1= on', '3', '10', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product Tell a Friend button', 'SHOW_DOCUMENT_GENERAL_INFO_TELL_A_FRIEND', '1', 'Display the Tell a Friend button on Product Info<br /><br />Note: Turning this setting off does not affect the Tell a Friend box in the columns and turning off the Tell a Friend box does not affect the button<br />0= off 1= on', '3', '15', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product URL', 'SHOW_DOCUMENT_GENERAL_INFO_URL', '1', 'Display URL on Product Info 0= off 1= on', '3', '11', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product Additional Images', 'SHOW_DOCUMENT_GENERAL_INFO_ADDITIONAL_IMAGES', '1', 'Display Additional Images on Product Info 0= off 1= on', '3', '13', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());

#admin defaults


INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Model Number', 'SHOW_DOCUMENT_PRODUCT_INFO_MODEL', '1', 'Display Model Number on Product Info 0= off 1= on', '4', '1', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Weight', 'SHOW_DOCUMENT_PRODUCT_INFO_WEIGHT', '0', 'Display Weight on Product Info 0= off 1= on', '4', '2', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Attribute Weight', 'SHOW_DOCUMENT_PRODUCT_INFO_WEIGHT_ATTRIBUTES', '1', 'Display Attribute Weight on Product Info 0= off 1= on', '4', '3', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Manufacturer', 'SHOW_DOCUMENT_PRODUCT_INFO_MANUFACTURER', '1', 'Display Manufacturer Name on Product Info 0= off 1= on', '4', '4', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Quantity in Shopping Cart', 'SHOW_DOCUMENT_PRODUCT_INFO_IN_CART_QTY', '1', 'Display Quantity in Current Shopping Cart on Product Info 0= off 1= on', '4', '5', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Quantity in Stock', 'SHOW_DOCUMENT_PRODUCT_INFO_QUANTITY', '0', 'Display Quantity in Stock on Product Info 0= off 1= on', '4', '6', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product Reviews Count', 'SHOW_DOCUMENT_PRODUCT_INFO_REVIEWS_COUNT', '1', 'Display Product Reviews Count on Product Info 0= off 1= on', '4', '7', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product Reviews Button', 'SHOW_DOCUMENT_PRODUCT_INFO_REVIEWS', '1', 'Display Product Reviews Button on Product Info 0= off 1= on', '4', '8', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Date Available', 'SHOW_DOCUMENT_PRODUCT_INFO_DATE_AVAILABLE', '1', 'Display Date Available on Product Info 0= off 1= on', '4', '9', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Date Added', 'SHOW_DOCUMENT_PRODUCT_INFO_DATE_ADDED', '1', 'Display Date Added on Product Info 0= off 1= on', '4', '10', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product URL', 'SHOW_DOCUMENT_PRODUCT_INFO_URL', '1', 'Display URL on Product Info 0= off 1= on', '4', '11', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product Additional Images', 'SHOW_DOCUMENT_PRODUCT_INFO_ADDITIONAL_IMAGES', '1', 'Display Additional Images on Product Info 0= off 1= on', '4', '13', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());


INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Starting At text on Price', 'SHOW_DOCUMENT_PRODUCT_INFO_STARTING_AT', '1', 'Display Starting At text on products with attributes Product Info 0= off 1= on', '4', '12', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());

INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product Tell a Friend button', 'SHOW_DOCUMENT_PRODUCT_INFO_TELL_A_FRIEND', '1', 'Display the Tell a Friend button on Product Info<br /><br />Note: Turning this setting off does not affect the Tell a Friend box in the columns and turning off the Tell a Friend box does not affect the button<br />0= off 1= on', '4', '15', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Product Free Shipping Image Status - Catalog', 'SHOW_DOCUMENT_PRODUCT_INFO_ALWAYS_FREE_SHIPPING_IMAGE_SWITCH', '0', 'Show the Free Shipping image/text in the catalog?', '4', '16', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
#admin defaults
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, use_function, set_function, date_added) VALUES ('Product Price Tax Class Default - When adding new products?', 'DEFAULT_DOCUMENT_PRODUCT_TAX_CLASS_ID', '0', 'What should the Product Price Tax Class Default ID be when adding new products?', '4', '100', '', '', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Product Virtual Default Status - Skip Shipping Address - When adding new products?', 'DEFAULT_DOCUMENT_PRODUCT_PRODUCTS_VIRTUAL', '0', 'Default Virtual Product status to be ON when adding new products?', '4', '101', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Product Free Shipping Default Status - Normal Shipping Rules - When adding new products?', 'DEFAULT_DOCUMENT_PRODUCT_PRODUCTS_IS_ALWAYS_FREE_SHIPPING', '0', 'What should the Default Free Shipping status be when adding new products?<br />Yes, Always Free Shipping ON<br />No, Always Free Shipping OFF<br />Special, Product/Download Requires Shipping', '4', '102', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes, Always ON\'), array(\'id\'=>\'0\', \'text\'=>\'No, Always OFF\'), array(\'id\'=>\'2\', \'text\'=>\'Special\')), ', now());


INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Model Number', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_MODEL', '1', 'Display Model Number on Product Info 0= off 1= on', '5', '1', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Weight', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_WEIGHT', '0', 'Display Weight on Product Info 0= off 1= on', '5', '2', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Attribute Weight', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_WEIGHT_ATTRIBUTES', '1', 'Display Attribute Weight on Product Info 0= off 1= on', '5', '3', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Manufacturer', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_MANUFACTURER', '1', 'Display Manufacturer Name on Product Info 0= off 1= on', '5', '4', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Quantity in Shopping Cart', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_IN_CART_QTY', '1', 'Display Quantity in Current Shopping Cart on Product Info 0= off 1= on', '5', '5', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Quantity in Stock', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_QUANTITY', '1', 'Display Quantity in Stock on Product Info 0= off 1= on', '5', '6', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product Reviews Count', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_REVIEWS_COUNT', '1', 'Display Product Reviews Count on Product Info 0= off 1= on', '5', '7', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product Reviews Button', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_REVIEWS', '1', 'Display Product Reviews Button on Product Info 0= off 1= on', '5', '8', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Date Available', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_DATE_AVAILABLE', '0', 'Display Date Available on Product Info 0= off 1= on', '5', '9', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Date Added', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_DATE_ADDED', '1', 'Display Date Added on Product Info 0= off 1= on', '5', '10', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product URL', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_URL', '1', 'Display URL on Product Info 0= off 1= on', '5', '11', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product Additional Images', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_ADDITIONAL_IMAGES', '1', 'Display Additional Images on Product Info 0= off 1= on', '5', '13', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());

INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Starting At text on Price', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_STARTING_AT', '1', 'Display Starting At text on products with attributes Product Info 0= off 1= on', '5', '12', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());

INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Product Tell a Friend button', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_TELL_A_FRIEND', '1', 'Display the Tell a Friend button on Product Info<br /><br />Note: Turning this setting off does not affect the Tell a Friend box in the columns and turning off the Tell a Friend box does not affect the button<br />0= off 1= on', '5', '15', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Product Free Shipping Image Status - Catalog', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_ALWAYS_FREE_SHIPPING_IMAGE_SWITCH', '1', 'Show the Free Shipping image/text in the catalog?', '5', '16', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
#admin defaults
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, use_function, set_function, date_added) VALUES ('Product Price Tax Class Default - When adding new products?', 'DEFAULT_PRODUCT_FREE_SHIPPING_TAX_CLASS_ID', '0', 'What should the Product Price Tax Class Default ID be when adding new products?', '5', '100', '', '', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Product Virtual Default Status - Skip Shipping Address - When adding new products?', 'DEFAULT_PRODUCT_FREE_SHIPPING_PRODUCTS_VIRTUAL', '0', 'Default Virtual Product status to be ON when adding new products?', '5', '101', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Product Free Shipping Default Status - Normal Shipping Rules - When adding new products?', 'DEFAULT_PRODUCT_FREE_SHIPPING_PRODUCTS_IS_ALWAYS_FREE_SHIPPING', '1', 'What should the Default Free Shipping status be when adding new products?<br />Yes, Always Free Shipping ON<br />No, Always Free Shipping OFF<br />Special, Product/Download Requires Shipping', '5', '102', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes, Always ON\'), array(\'id\'=>\'0\', \'text\'=>\'No, Always OFF\'), array(\'id\'=>\'2\', \'text\'=>\'Special\')), ', now());

#insert product type layout settings for meta-tags
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Metatags Title Default - Product Title', 'SHOW_PRODUCT_INFO_METATAGS_TITLE_STATUS', '1', 'Display Product Title in Meta Tags Title 0= off 1= on', '1', '50', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Metatags Title Default - Product Name', 'SHOW_PRODUCT_INFO_METATAGS_PRODUCTS_NAME_STATUS', '1', 'Display Product Name in Meta Tags Title 0= off 1= on', '1', '51', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Metatags Title Default - Product Model', 'SHOW_PRODUCT_INFO_METATAGS_MODEL_STATUS', '1', 'Display Product Model in Meta Tags Title 0= off 1= on', '1', '52', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Metatags Title Default - Product Price', 'SHOW_PRODUCT_INFO_METATAGS_PRICE_STATUS', '1', 'Display Product Price in Meta Tags Title 0= off 1= on', '1', '53', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Metatags Title Default - Product Tagline', 'SHOW_PRODUCT_INFO_METATAGS_TITLE_TAGLINE_STATUS', '1', 'Display Product Tagline in Meta Tags Title 0= off 1= on', '1', '54', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());

INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Metatags Title Default - Product Title', 'SHOW_PRODUCT_MUSIC_INFO_METATAGS_TITLE_STATUS', '1', 'Display Product Title in Meta Tags Title 0= off 1= on', '2', '50', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Metatags Title Default - Product Name', 'SHOW_PRODUCT_MUSIC_INFO_METATAGS_PRODUCTS_NAME_STATUS', '1', 'Display Product Name in Meta Tags Title 0= off 1= on', '2', '51', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Metatags Title Default - Product Model', 'SHOW_PRODUCT_MUSIC_INFO_METATAGS_MODEL_STATUS', '1', 'Display Product Model in Meta Tags Title 0= off 1= on', '2', '52', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Metatags Title Default - Product Price', 'SHOW_PRODUCT_MUSIC_INFO_METATAGS_PRICE_STATUS', '1', 'Display Product Price in Meta Tags Title 0= off 1= on', '2', '53', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Metatags Title Default - Product Tagline', 'SHOW_PRODUCT_MUSIC_INFO_METATAGS_TITLE_TAGLINE_STATUS', '1', 'Display Product Tagline in Meta Tags Title 0= off 1= on', '2', '54', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());

INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Metatags Title Default - Document Title', 'SHOW_DOCUMENT_GENERAL_INFO_METATAGS_TITLE_STATUS', '1', 'Display Document Title in Meta Tags Title 0= off 1= on', '3', '50', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Metatags Title Default - Document Name', 'SHOW_DOCUMENT_GENERAL_INFO_METATAGS_PRODUCTS_NAME_STATUS', '1', 'Display Document Name in Meta Tags Title 0= off 1= on', '3', '51', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Metatags Title Default - Document Tagline', 'SHOW_DOCUMENT_GENERAL_INFO_METATAGS_TITLE_TAGLINE_STATUS', '1', 'Display Document Tagline in Meta Tags Title 0= off 1= on', '3', '54', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());

INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Metatags Title Default - Document Title', 'SHOW_DOCUMENT_PRODUCT_INFO_METATAGS_TITLE_STATUS', '1', 'Display Document Title in Meta Tags Title 0= off 1= on', '4', '50', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Metatags Title Default - Document Name', 'SHOW_DOCUMENT_PRODUCT_INFO_METATAGS_PRODUCTS_NAME_STATUS', '1', 'Display Document Name in Meta Tags Title 0= off 1= on', '4', '51', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Metatags Title Default - Document Model', 'SHOW_DOCUMENT_PRODUCT_INFO_METATAGS_MODEL_STATUS', '1', 'Display Document Model in Meta Tags Title 0= off 1= on', '4', '52', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Metatags Title Default - Document Price', 'SHOW_DOCUMENT_PRODUCT_INFO_METATAGS_PRICE_STATUS', '1', 'Display Document Price in Meta Tags Title 0= off 1= on', '4', '53', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Metatags Title Default - Document Tagline', 'SHOW_DOCUMENT_PRODUCT_INFO_METATAGS_TITLE_TAGLINE_STATUS', '1', 'Display Document Tagline in Meta Tags Title 0= off 1= on', '4', '54', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());

INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Metatags Title Default - Product Title', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_METATAGS_TITLE_STATUS', '1', 'Display Product Title in Meta Tags Title 0= off 1= on', '5', '50', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Metatags Title Default - Product Name', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_METATAGS_PRODUCTS_NAME_STATUS', '1', 'Display Product Name in Meta Tags Title 0= off 1= on', '5', '51', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Metatags Title Default - Product Model', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_METATAGS_MODEL_STATUS', '1', 'Display Product Model in Meta Tags Title 0= off 1= on', '5', '52', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Metatags Title Default - Product Price', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_METATAGS_PRICE_STATUS', '1', 'Display Product Price in Meta Tags Title 0= off 1= on', '5', '53', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('Show Metatags Title Default - Product Tagline', 'SHOW_PRODUCT_FREE_SHIPPING_INFO_METATAGS_TITLE_TAGLINE_STATUS', '1', 'Display Product Tagline in Meta Tags Title 0= off 1= on', '5', '54', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'True\'), array(\'id\'=>\'0\', \'text\'=>\'False\')), ', now());
### eof: meta tags database updates and changes

#insert product type layout settings
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('PRODUCT Attribute is Display Only - Default', 'DEFAULT_PRODUCT_ATTRIBUTES_DISPLAY_ONLY', '0', 'PRODUCT Attribute is Display Only<br />Used For Display Purposes Only<br />0= No 1= Yes', '1', '200', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('PRODUCT Attribute is Free - Default', 'DEFAULT_PRODUCT_ATTRIBUTE_IS_FREE', '1', 'PRODUCT Attribute is Free<br />Attribute is Free When Product is Free<br />0= No 1= Yes', '1', '201', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('PRODUCT Attribute is Default - Default', 'DEFAULT_PRODUCT_ATTRIBUTES_DEFAULT', '0', 'PRODUCT Attribute is Default<br />Default Attribute to be Marked Selected<br />0= No 1= Yes', '1', '202', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('PRODUCT Attribute is Discounted - Default', 'DEFAULT_PRODUCT_ATTRIBUTES_DISCOUNTED', '1', 'PRODUCT Attribute is Discounted<br />Apply Discounts Used by Product Special/Sale<br />0= No 1= Yes', '1', '203', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('PRODUCT Attribute is Included in Base Price - Default', 'DEFAULT_PRODUCT_ATTRIBUTES_PRICE_BASE_INCLUDED', '1', 'PRODUCT Attribute is Included in Base Price<br />Include in Base Price When Priced by Attributes<br />0= No 1= Yes', '1', '204', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('PRODUCT Attribute is Required - Default', 'DEFAULT_PRODUCT_ATTRIBUTES_REQUIRED', '0', 'PRODUCT Attribute is Required<br />Attribute Required for Text<br />0= No 1= Yes', '1', '205', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('PRODUCT Attribute Price Prefix - Default', 'DEFAULT_PRODUCT_PRICE_PREFIX', '1', 'PRODUCT Attribute Price Prefix<br />Default Attribute Price Prefix for Adding<br />Blank, + or -', '1', '206', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Blank\'), array(\'id\'=>\'1\', \'text\'=>\'+\'), array(\'id\'=>\'2\', \'text\'=>\'-\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('PRODUCT Attribute Weight Prefix - Default', 'DEFAULT_PRODUCT_PRODUCTS_ATTRIBUTES_WEIGHT_PREFIX', '1', 'PRODUCT Attribute Weight Prefix<br />Default Attribute Weight Prefix<br />Blank, + or -', '1', '207', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Blank\'), array(\'id\'=>\'1\', \'text\'=>\'+\'), array(\'id\'=>\'2\', \'text\'=>\'-\')), ', now());

INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('MUSIC Attribute is Display Only - Default', 'DEFAULT_PRODUCT_MUSIC_ATTRIBUTES_DISPLAY_ONLY', '0', 'MUSIC Attribute is Display Only<br />Used For Display Purposes Only<br />0= No 1= Yes', '2', '200', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('MUSIC Attribute is Free - Default', 'DEFAULT_PRODUCT_MUSIC_ATTRIBUTE_IS_FREE', '1', 'MUSIC Attribute is Free<br />Attribute is Free When Product is Free<br />0= No 1= Yes', '2', '201', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('MUSIC Attribute is Default - Default', 'DEFAULT_PRODUCT_MUSIC_ATTRIBUTES_DEFAULT', '0', 'MUSIC Attribute is Default<br />Default Attribute to be Marked Selected<br />0= No 1= Yes', '2', '202', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('MUSIC Attribute is Discounted - Default', 'DEFAULT_PRODUCT_MUSIC_ATTRIBUTES_DISCOUNTED', '1', 'MUSIC Attribute is Discounted<br />Apply Discounts Used by Product Special/Sale<br />0= No 1= Yes', '2', '203', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('MUSIC Attribute is Included in Base Price - Default', 'DEFAULT_PRODUCT_MUSIC_ATTRIBUTES_PRICE_BASE_INCLUDED', '1', 'MUSIC Attribute is Included in Base Price<br />Include in Base Price When Priced by Attributes<br />0= No 1= Yes', '2', '204', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('MUSIC Attribute is Required - Default', 'DEFAULT_PRODUCT_MUSIC_ATTRIBUTES_REQUIRED', '0', 'MUSIC Attribute is Required<br />Attribute Required for Text<br />0= No 1= Yes', '2', '205', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('MUSIC Attribute Price Prefix - Default', 'DEFAULT_PRODUCT_MUSIC_PRICE_PREFIX', '1', 'MUSIC Attribute Price Prefix<br />Default Attribute Price Prefix for Adding<br />Blank, + or -', '2', '206', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Blank\'), array(\'id\'=>\'1\', \'text\'=>\'+\'), array(\'id\'=>\'2\', \'text\'=>\'-\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('MUSIC Attribute Weight Prefix - Default', 'DEFAULT_PRODUCT_MUSIC_PRODUCTS_ATTRIBUTES_WEIGHT_PREFIX', '1', 'MUSIC Attribute Weight Prefix<br />Default Attribute Weight Prefix<br />Blank, + or -', '2', '207', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Blank\'), array(\'id\'=>\'1\', \'text\'=>\'+\'), array(\'id\'=>\'2\', \'text\'=>\'-\')), ', now());

INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('DOCUMENT GENERAL Attribute is Display Only - Default', 'DEFAULT_DOCUMENT_GENERAL_ATTRIBUTES_DISPLAY_ONLY', '0', 'DOCUMENT GENERAL Attribute is Display Only<br />Used For Display Purposes Only<br />0= No 1= Yes', '3', '200', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('DOCUMENT GENERAL Attribute is Free - Default', 'DEFAULT_DOCUMENT_GENERAL_ATTRIBUTE_IS_FREE', '1', 'DOCUMENT GENERAL Attribute is Free<br />Attribute is Free When Product is Free<br />0= No 1= Yes', '3', '201', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('DOCUMENT GENERAL Attribute is Default - Default', 'DEFAULT_DOCUMENT_GENERAL_ATTRIBUTES_DEFAULT', '0', 'DOCUMENT GENERAL Attribute is Default<br />Default Attribute to be Marked Selected<br />0= No 1= Yes', '3', '202', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('DOCUMENT GENERAL Attribute is Discounted - Default', 'DEFAULT_DOCUMENT_GENERAL_ATTRIBUTES_DISCOUNTED', '1', 'DOCUMENT GENERAL Attribute is Discounted<br />Apply Discounts Used by Product Special/Sale<br />0= No 1= Yes', '3', '203', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('DOCUMENT GENERAL Attribute is Included in Base Price - Default', 'DEFAULT_DOCUMENT_GENERAL_ATTRIBUTES_PRICE_BASE_INCLUDED', '1', 'DOCUMENT GENERAL Attribute is Included in Base Price<br />Include in Base Price When Priced by Attributes<br />0= No 1= Yes', '3', '204', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('DOCUMENT GENERAL Attribute is Required - Default', 'DEFAULT_DOCUMENT_GENERAL_ATTRIBUTES_REQUIRED', '0', 'DOCUMENT GENERAL Attribute is Required<br />Attribute Required for Text<br />0= No 1= Yes', '3', '205', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('DOCUMENT GENERAL Attribute Price Prefix - Default', 'DEFAULT_DOCUMENT_GENERAL_PRICE_PREFIX', '1', 'DOCUMENT GENERAL Attribute Price Prefix<br />Default Attribute Price Prefix for Adding<br />Blank, + or -', '3', '206', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Blank\'), array(\'id\'=>\'1\', \'text\'=>\'+\'), array(\'id\'=>\'2\', \'text\'=>\'-\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('DOCUMENT GENERAL Attribute Weight Prefix - Default', 'DEFAULT_DOCUMENT_GENERAL_PRODUCTS_ATTRIBUTES_WEIGHT_PREFIX', '1', 'DOCUMENT GENERAL Attribute Weight Prefix<br />Default Attribute Weight Prefix<br />Blank, + or -', '3', '207', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Blank\'), array(\'id\'=>\'1\', \'text\'=>\'+\'), array(\'id\'=>\'2\', \'text\'=>\'-\')), ', now());

INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('DOCUMENT PRODUCT Attribute is Display Only - Default', 'DEFAULT_DOCUMENT_PRODUCT_ATTRIBUTES_DISPLAY_ONLY', '0', 'DOCUMENT PRODUCT Attribute is Display Only<br />Used For Display Purposes Only<br />0= No 1= Yes', '4', '200', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('DOCUMENT PRODUCT Attribute is Free - Default', 'DEFAULT_DOCUMENT_PRODUCT_ATTRIBUTE_IS_FREE', '1', 'DOCUMENT PRODUCT Attribute is Free<br />Attribute is Free When Product is Free<br />0= No 1= Yes', '4', '201', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('DOCUMENT PRODUCT Attribute is Default - Default', 'DEFAULT_DOCUMENT_PRODUCT_ATTRIBUTES_DEFAULT', '0', 'DOCUMENT PRODUCT Attribute is Default<br />Default Attribute to be Marked Selected<br />0= No 1= Yes', '4', '202', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('DOCUMENT PRODUCT Attribute is Discounted - Default', 'DEFAULT_DOCUMENT_PRODUCT_ATTRIBUTES_DISCOUNTED', '1', 'DOCUMENT PRODUCT Attribute is Discounted<br />Apply Discounts Used by Product Special/Sale<br />0= No 1= Yes', '4', '203', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('DOCUMENT PRODUCT Attribute is Included in Base Price - Default', 'DEFAULT_DOCUMENT_PRODUCT_ATTRIBUTES_PRICE_BASE_INCLUDED', '1', 'DOCUMENT PRODUCT Attribute is Included in Base Price<br />Include in Base Price When Priced by Attributes<br />0= No 1= Yes', '4', '204', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('DOCUMENT PRODUCT Attribute is Required - Default', 'DEFAULT_DOCUMENT_PRODUCT_ATTRIBUTES_REQUIRED', '0', 'DOCUMENT PRODUCT Attribute is Required<br />Attribute Required for Text<br />0= No 1= Yes', '4', '205', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('DOCUMENT PRODUCT Attribute Price Prefix - Default', 'DEFAULT_DOCUMENT_PRODUCT_PRICE_PREFIX', '1', 'DOCUMENT PRODUCT Attribute Price Prefix<br />Default Attribute Price Prefix for Adding<br />Blank, + or -', '4', '206', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Blank\'), array(\'id\'=>\'1\', \'text\'=>\'+\'), array(\'id\'=>\'2\', \'text\'=>\'-\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('DOCUMENT PRODUCT Attribute Weight Prefix - Default', 'DEFAULT_DOCUMENT_PRODUCT_PRODUCTS_ATTRIBUTES_WEIGHT_PREFIX', '1', 'DOCUMENT PRODUCT Attribute Weight Prefix<br />Default Attribute Weight Prefix<br />Blank, + or -', '4', '207', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Blank\'), array(\'id\'=>\'1\', \'text\'=>\'+\'), array(\'id\'=>\'2\', \'text\'=>\'-\')), ', now());

INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('PRODUCT FREE SHIPPING Attribute is Display Only - Default', 'DEFAULT_PRODUCT_FREE_SHIPPING_ATTRIBUTES_DISPLAY_ONLY', '0', 'PRODUCT FREE SHIPPING Attribute is Display Only<br />Used For Display Purposes Only<br />0= No 1= Yes', '5', '201', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('PRODUCT FREE SHIPPING Attribute is Free - Default', 'DEFAULT_PRODUCT_FREE_SHIPPING_ATTRIBUTE_IS_FREE', '1', 'PRODUCT FREE SHIPPING Attribute is Free<br />Attribute is Free When Product is Free<br />0= No 1= Yes', '5', '201', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('PRODUCT FREE SHIPPING Attribute is Default - Default', 'DEFAULT_PRODUCT_FREE_SHIPPING_ATTRIBUTES_DEFAULT', '0', 'PRODUCT FREE SHIPPING Attribute is Default<br />Default Attribute to be Marked Selected<br />0= No 1= Yes', '5', '202', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('PRODUCT FREE SHIPPING Attribute is Discounted - Default', 'DEFAULT_PRODUCT_FREE_SHIPPING_ATTRIBUTES_DISCOUNTED', '1', 'PRODUCT FREE SHIPPING Attribute is Discounted<br />Apply Discounts Used by Product Special/Sale<br />0= No 1= Yes', '5', '203', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('PRODUCT FREE SHIPPING Attribute is Included in Base Price - Default', 'DEFAULT_PRODUCT_FREE_SHIPPING_ATTRIBUTES_PRICE_BASE_INCLUDED', '1', 'PRODUCT FREE SHIPPING Attribute is Included in Base Price<br />Include in Base Price When Priced by Attributes<br />0= No 1= Yes', '5', '204', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('PRODUCT FREE SHIPPING Attribute is Required - Default', 'DEFAULT_PRODUCT_FREE_SHIPPING_ATTRIBUTES_REQUIRED', '0', 'PRODUCT FREE SHIPPING Attribute is Required<br />Attribute Required for Text<br />0= No 1= Yes', '5', '205', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'1\', \'text\'=>\'Yes\'), array(\'id\'=>\'0\', \'text\'=>\'No\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('PRODUCT FREE SHIPPING Attribute Price Prefix - Default', 'DEFAULT_PRODUCT_FREE_SHIPPING_PRICE_PREFIX', '1', 'PRODUCT FREE SHIPPING Attribute Price Prefix<br />Default Attribute Price Prefix for Adding<br />Blank, + or -', '5', '206', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Blank\'), array(\'id\'=>\'1\', \'text\'=>\'+\'), array(\'id\'=>\'2\', \'text\'=>\'-\')), ', now());
INSERT INTO product_type_layout (configuration_title, configuration_key, configuration_value, configuration_description, product_type_id, sort_order, set_function, date_added) VALUES ('PRODUCT FREE SHIPPING Attribute Weight Prefix - Default', 'DEFAULT_PRODUCT_FREE_SHIPPING_PRODUCTS_ATTRIBUTES_WEIGHT_PREFIX', '1', 'PRODUCT FREE SHIPPING Attribute Weight Prefix<br />Default Attribute Weight Prefix<br />Blank, + or -', '5', '207', 'zen_cfg_select_drop_down(array(array(\'id\'=>\'0\', \'text\'=>\'Blank\'), array(\'id\'=>\'1\', \'text\'=>\'+\'), array(\'id\'=>\'2\', \'text\'=>\'-\')), ', now());
### eof: attribute default database updates and changes


## Insert the default queries for "all customers" and "all newsletter subscribers"
INSERT INTO query_builder ( query_id , query_category , query_name , query_description , query_string ) VALUES ( '1', 'email', 'All Customers', 'Returns all customers name and email address for sending mass emails (ie: for newsletters, coupons, GV\'s, messages, etc).', 'select customers_email_address, customers_firstname, customers_lastname from TABLE_CUSTOMERS order by customers_lastname, customers_firstname, customers_email_address');
INSERT INTO query_builder ( query_id , query_category , query_name , query_description , query_string ) VALUES ( '2', 'email,newsletters', 'All Newsletter Subscribers', 'Returns name and email address of newsletter subscribers', 'select customers_firstname, customers_lastname, customers_email_address from TABLE_CUSTOMERS where customers_newsletter = \'1\'');
INSERT INTO query_builder ( query_id , query_category , query_name , query_description , query_string ) VALUES ( '3', 'email,newsletters', 'Dormant Customers (>3months) (Subscribers)', 'Subscribers who HAVE purchased something, but have NOT purchased for at least three months.', 'select c.customers_email_address, c.customers_lastname, c.customers_firstname from TABLE_CUSTOMERS c, TABLE_ORDERS o where c.customers_newsletter = \'1\' AND c.customers_id = o.customers_id and o.date_purchased < subdate(now(),INTERVAL 3 MONTH) GROUP BY c.customers_email_address order by c.customers_lastname, c.customers_firstname ASC');
INSERT INTO query_builder ( query_id , query_category , query_name , query_description , query_string ) VALUES ( '4', 'email,newsletters', 'Active customers in past 3 months (Subscribers)', 'Newsletter subscribers who are also active customers (purchased something) in last 3 months.', 'select c.customers_email_address, c.customers_lastname, c.customers_firstname from TABLE_CUSTOMERS c, TABLE_ORDERS o where c.customers_newsletter = \'1\' AND c.customers_id = o.customers_id and o.date_purchased > subdate(now(),INTERVAL 3 MONTH) GROUP BY c.customers_email_address order by c.customers_lastname, c.customers_firstname ASC');
INSERT INTO query_builder ( query_id , query_category , query_name , query_description , query_string ) VALUES ( '5', 'email,newsletters', 'Active customers in past 3 months (Regardless of subscription status)', 'All active customers (purchased something) in last 3 months, ignoring newsletter-subscription status.', 'select c.customers_email_address, c.customers_lastname, c.customers_firstname from TABLE_CUSTOMERS c, TABLE_ORDERS o WHERE c.customers_id = o.customers_id and o.date_purchased > subdate(now(),INTERVAL 3 MONTH) GROUP BY c.customers_email_address order by c.customers_lastname, c.customers_firstname ASC');
INSERT INTO query_builder ( query_id , query_category , query_name , query_description , query_string ) VALUES ( '6', 'email,newsletters', 'Administrator', 'Just the email account of the current administrator', 'select \'ADMIN\' as customers_firstname, admin_name as customers_lastname, admin_email as customers_email_address from TABLE_ADMIN where admin_id = $SESSION:admin_id');

#
# end of Query-Builder Setup
#

#
# Dumping data for table `get_terms_to_filter`
#

INSERT INTO get_terms_to_filter VALUES ('manufacturers_id');
INSERT INTO get_terms_to_filter VALUES ('music_genre_id');
INSERT INTO get_terms_to_filter VALUES ('record_company_id');

#
# Dumping data for table `project_version`
#

INSERT INTO project_version (project_version_id, project_version_key, project_version_major, project_version_minor, project_version_patch1, project_version_patch1_source, project_version_patch2, project_version_patch2_source, project_version_comment, project_version_date_applied) VALUES (1, 'Zen-Cart Main', '1', '3.0.2-l10n-jp-5', '', '', '', '', 'Fresh Installation', now());
INSERT INTO project_version (project_version_id, project_version_key, project_version_major, project_version_minor, project_version_patch1, project_version_patch1_source, project_version_patch2, project_version_patch2_source, project_version_comment, project_version_date_applied) VALUES (2, 'Zen-Cart Database', '1', '3.0.2-l10n-jp-5', '', '', '', '', 'Fresh Installation', now());

INSERT INTO project_version_history (project_version_id, project_version_key, project_version_major, project_version_minor, project_version_patch, project_version_comment, project_version_date_applied) VALUES (1, 'Zen-Cart Main', '1', '3.0.2', '', 'Fresh Installation', now());
INSERT INTO project_version_history (project_version_id, project_version_key, project_version_major, project_version_minor, project_version_patch, project_version_comment, project_version_date_applied) VALUES (2, 'Zen-Cart Database', '1', '3.0.2', '', 'Fresh Installation', now());
INSERT INTO project_version_history (project_version_id, project_version_key, project_version_major, project_version_minor, project_version_patch, project_version_comment, project_version_date_applied) VALUES (3, 'Zen-Cart Main', '1', '3.0.2-l10n-jp-1', '', 'v1.3.0.2-l10n-jp-1', now());
INSERT INTO project_version_history (project_version_id, project_version_key, project_version_major, project_version_minor, project_version_patch, project_version_comment, project_version_date_applied) VALUES (4, 'Zen-Cart Database', '1', '3.0.2-l10n-jp-1', '', 'v1.3.0.2-l10n-jp-1', now());
INSERT INTO project_version_history (project_version_id, project_version_key, project_version_major, project_version_minor, project_version_patch, project_version_comment, project_version_date_applied) VALUES (5, 'Zen-Cart Main', '1', '3.0.2-l10n-jp-2', '', 'v1.3.0.2-l10n-jp-2', now());
INSERT INTO project_version_history (project_version_id, project_version_key, project_version_major, project_version_minor, project_version_patch, project_version_comment, project_version_date_applied) VALUES (6, 'Zen-Cart Database', '1', '3.0.2-l10n-jp-2', '', 'v1.3.0.2-l10n-jp-2', now());
INSERT INTO project_version_history (project_version_id, project_version_key, project_version_major, project_version_minor, project_version_patch, project_version_comment, project_version_date_applied) VALUES (7, 'Zen-Cart Main', '1', '3.0.2-l10n-jp-3', '', 'v1.3.0.2-l10n-jp-3', now());
INSERT INTO project_version_history (project_version_id, project_version_key, project_version_major, project_version_minor, project_version_patch, project_version_comment, project_version_date_applied) VALUES (8, 'Zen-Cart Database', '1', '3.0.2-l10n-jp-3', '', 'v1.3.0.2-l10n-jp-3', now());
INSERT INTO project_version_history (project_version_id, project_version_key, project_version_major, project_version_minor, project_version_patch, project_version_comment, project_version_date_applied) VALUES (9, 'Zen-Cart Main', '1', '3.0.2-l10n-jp-4', '', 'v1.3.0.2-l10n-jp-4', now());
INSERT INTO project_version_history (project_version_id, project_version_key, project_version_major, project_version_minor, project_version_patch, project_version_comment, project_version_date_applied) VALUES (10, 'Zen-Cart Database', '1', '3.0.2-l10n-jp-4', '', 'v1.3.0.2-l10n-jp-4', now());
INSERT INTO project_version_history (project_version_id, project_version_key, project_version_major, project_version_minor, project_version_patch, project_version_comment, project_version_date_applied) VALUES (11, 'Zen-Cart Main', '1', '3.0.2-l10n-jp-5', '', 'v1.3.0.2-l10n-jp-5', now());
INSERT INTO project_version_history (project_version_id, project_version_key, project_version_major, project_version_minor, project_version_patch, project_version_comment, project_version_date_applied) VALUES (12, 'Zen-Cart Database', '1', '3.0.2-l10n-jp-5', '', 'v1.3.0.2-l10n-jp-5', now());


##### End of SQL setup for Zen Cart.

################################################################################
#
# Zen Cart : The Art of E-Commerce
# Japanese update SQL for ZenCartBeta Release v1.1.0
# Last Update: 2003/04/14
# Author(s): HISASUE, Takahiro (hisa@flatz.jp)

#°ìÈÌÀßÄê
UPDATE configuration SET configuration_value=1 WHERE configuration_key='ENTRY_FIRST_NAME_MIN_LENGTH';
UPDATE configuration SET configuration_value=1 WHERE configuration_key='ENTRY_LAST_NAME_MIN_LENGTH';
UPDATE configuration SET configuration_value=1 WHERE configuration_key='ENTRY_STREET_ADDRESS_MIN_LENGTH';
UPDATE configuration SET configuration_value=2 WHERE configuration_key='ENTRY_CITY_MIN_LENGTH';
UPDATE configuration SET configuration_value = 'false' WHERE configuration_key = 'ACCOUNT_SUBURB';
UPDATE configuration SET configuration_value = 'true' WHERE configuration_key = 'DISPLAY_PRICE_WITH_TAX';
UPDATE configuration SET configuration_value = 'false' WHERE configuration_key = 'MODULE_PAYMENT_CC_COLLECT_CVV';
UPDATE configuration SET configuration_value = '0' WHERE configuration_key = 'SHOW_CATEGORIES_ALWAYS';
UPDATE configuration SET configuration_value = '107' WHERE configuration_key = 'SHOW_CREATE_ACCOUNT_DEFAULT_COUNTRY';

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('¤ªÌä¤¤¹ç¤ï¤»»þ¤Î¸Ä¿Í¾ðÊó³ÎÇ§²èÌÌÉ½¼¨', 'DISPLAY_CONTACT_US_PRIVACY_CONDITIONS', 'true', '¤ªÌä¤¤¹ç¤ï¤»¤¹¤ë²èÌÌ¤Ç¸Ä¿Í¾ðÊó¤Î³ÎÇ§²èÌÌ¤òÉ½¼¨¤·¤Þ¤¹¡£<div style="color: red;">2005Ç¯4·î1Æü¤Ë»Ü¹Ô¤µ¤ì¤¿¡Ö¸Ä¿Í¾ðÊóÊÝ¸îË¡¡×¤Ç¤Ï¡¢¸Ä¿Í¾ðÊóÊÝ¸îÊý¿Ë¤ò³«¼¨¤¹¤ë¤³¤È¤¬µá¤á¤é¤ì¤Æ¤¤¤Þ¤¹¡£</div>', '11', '3', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());

#¥Þ¥¹¥¿¡¼¥Æ¡¼¥Ö¥ë
#½»½ê¥Õ¥©¡¼¥Þ¥Ã¥ÈÄÉ²Ã
INSERT INTO address_format VALUES (6, '$lastname $firstname$cr$postcode$cr$statename$city$cr$streets$cr$country','$statename $city');

#ÄÌ²ßÀßÄê
UPDATE currencies SET value='0.009365' WHERE code='USD';
UPDATE currencies SET value='0.007594' WHERE code='EUR';
INSERT INTO currencies VALUES (3,'Japanese Yen','JPY','','±ß','.',',','','1.000000', now());


#¸À¸ìÀßÄê
INSERT INTO languages VALUES (2,'Japanese','ja','icon.gif','japanese',1);

#¹ñÀßÄê
#½»½ê¥Õ¥©¡¼¥Þ¥Ã¥È¤òÊÑ¹¹
UPDATE countries SET address_format_id=6 WHERE countries_id=107;

#ÃÏ°èÀßÄê
# Japan
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (107,'ËÌ³¤Æ»','ËÌ³¤Æ»');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (107,'ÀÄ¿¹¸©','ÀÄ¿¹¸©');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (107,'´ä¼ê¸©','´ä¼ê¸©');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (107,'µÜ¾ë¸©','µÜ¾ë¸©');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (107,'½©ÅÄ¸©','½©ÅÄ¸©');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (107,'»³·Á¸©','»³·Á¸©');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (107,'Ê¡Åç¸©','Ê¡Åç¸©');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (107,'°ñ¾ë¸©','°ñ¾ë¸©');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (107,'ÆÊÌÚ¸©','ÆÊÌÚ¸©');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (107,'·²ÇÏ¸©','·²ÇÏ¸©');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (107,'ºë¶Ì¸©','ºë¶Ì¸©');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (107,'ÀéÍÕ¸©','ÀéÍÕ¸©');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (107,'ÅìµþÅÔ','ÅìµþÅÔ');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (107,'¿ÀÆàÀî¸©','¿ÀÆàÀî¸©');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (107,'¿·³ã¸©','¿·³ã¸©');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (107,'ÉÙ»³¸©','ÉÙ»³¸©');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (107,'ÀÐÀî¸©','ÀÐÀî¸©');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (107,'Ê¡°æ¸©','Ê¡°æ¸©');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (107,'»³Íü¸©','»³Íü¸©');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (107,'Ä¹Ìî¸©','Ä¹Ìî¸©');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (107,'´ôÉì¸©','´ôÉì¸©');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (107,'ÀÅ²¬¸©','ÀÅ²¬¸©');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (107,'°¦ÃÎ¸©','°¦ÃÎ¸©');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (107,'»°½Å¸©','»°½Å¸©');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (107,'¼¢²ì¸©','¼¢²ì¸©');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (107,'µþÅÔÉÜ','µþÅÔÉÜ');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (107,'ÂçºåÉÜ','ÂçºåÉÜ');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (107,'Ê¼¸Ë¸©','Ê¼¸Ë¸©');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (107,'ÆàÎÉ¸©','ÆàÎÉ¸©');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (107,'ÏÂ²Î»³¸©','ÏÂ²Î»³¸©');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (107,'Ä»¼è¸©','Ä»¼è¸©');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (107,'Åçº¬¸©','Åçº¬¸©');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (107,'²¬»³¸©','²¬»³¸©');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (107,'¹­Åç¸©','¹­Åç¸©');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (107,'»³¸ý¸©','»³¸ý¸©');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (107,'ÆÁÅç¸©','ÆÁÅç¸©');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (107,'¹áÀî¸©','¹áÀî¸©');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (107,'°¦É²¸©','°¦É²¸©');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (107,'¹âÃÎ¸©','¹âÃÎ¸©');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (107,'Ê¡²¬¸©','Ê¡²¬¸©');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (107,'º´²ì¸©','º´²ì¸©');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (107,'Ä¹ºê¸©','Ä¹ºê¸©');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (107,'·§ËÜ¸©','·§ËÜ¸©');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (107,'ÂçÊ¬¸©','ÂçÊ¬¸©');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (107,'µÜºê¸©','µÜºê¸©');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (107,'¼¯»ùÅç¸©','¼¯»ùÅç¸©');
INSERT INTO zones (zone_country_id, zone_code, zone_name) VALUES (107,'²­Æì¸©','²­Æì¸©');

# ÀÇ¶â¡¦ÀÇÎ¨ÀßÄê
INSERT INTO tax_rates VALUES (1,1,1,1,5.0000,'¾ÃÈñÀÇ¡§5%','2007-01-15 11:44:17','2006-11-29 16:18:40');
INSERT INTO geo_zones VALUES (1,'ÆüËÜ','ÆüËÜ¡Ê¾ÃÈñÀÇ¡Ë','2007-01-15 11:44:41','2006-11-29 16:18:40');
INSERT INTO zones_to_geo_zones VALUES (1,107,NULL,1,'2007-01-21 11:44:32','2006-11-29 16:18:40');
INSERT INTO tax_class VALUES (1,'¾ÃÈñÀÇ','¾ÃÈñÀÇ¡ÊÆüËÜ¡Ë','2007-01-15 11:43:40','2004-01-21 01:35:29');

#ÃíÊ¸¥¹¥Æ¡¼¥¿¥¹
INSERT INTO orders_status VALUES ( '1', '2', '½èÍýÂÔ¤Á');
INSERT INTO orders_status VALUES ( '2', '2', '½èÍýÃæ');
INSERT INTO orders_status VALUES ( '3', '2', 'ÇÛÁ÷ºÑ¤ß');
INSERT INTO orders_status VALUES ( '4', '2', '¹¹¿·');


# ½»½ê¤ËÅÅÏÃÈÖ¹æ¤òÄÉ²Ã¡¢¸Ä¿Í¾ðÊóÂ¦¤«¤é¤ÏÅÅÏÃÈÖ¹æºï½ü
ALTER TABLE address_book ADD COLUMN entry_telephone varchar(32) NOT NULL;
ALTER TABLE address_book ADD COLUMN entry_fax varchar(32);
ALTER TABLE orders ADD COLUMN delivery_telephone varchar(32);
ALTER TABLE orders ADD COLUMN delivery_fax varchar(32);
ALTER TABLE orders ADD COLUMN billing_telephone varchar(32);
ALTER TABLE orders ADD COLUMN billing_fax varchar(32);
ALTER TABLE orders ADD COLUMN customers_fax varchar(32);
ALTER TABLE customers CHANGE customers_telephone customers_telephone VARCHAR(32);
ALTER TABLE orders CHANGE customers_telephone customers_telephone VARCHAR(32);
UPDATE address_format SET address_format = '$firstname $lastname$cr$postcode$cr$state$city$cr$streets$cr$country$cr$telephone$cr$fax' WHERE address_format_id=6;

# ¥«¥Ê¤òÄÉ²Ã¤¹¤ë
ALTER TABLE address_book ADD entry_firstname_kana     varchar(32) NOT NULL default '';
ALTER TABLE address_book ADD entry_lastname_kana      varchar(32) NOT NULL default '';
ALTER TABLE customers    ADD customers_firstname_kana varchar(32) NOT NULL default '';
ALTER TABLE customers    ADD customers_lastname_kana  varchar(32) NOT NULL default '';
ALTER TABLE orders       ADD customers_name_kana      varchar(64) NOT NULL default '';
ALTER TABLE orders       ADD delivery_name_kana       varchar(64) NOT NULL default '';
ALTER TABLE orders       ADD billing_name_kana        varchar(64) NOT NULL default '';
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('¤Õ¤ê¤¬¤Ê¤¬É¬Í×¤Ê¹ñ', 'FURIKANA_NECESSARY_COUNTRIES', 'Japanese', '¤Õ¤ê¤¬¤Ê¤¬É¬Í×¤Ê¹ñÌ¾¤ò¥«¥ó¥Þ¤Ç¶èÀÚ¤Ã¤ÆÆþÎÏ¤·¤Æ¤¯¤À¤µ¤¤', '5', '100', '', now());

# °ìÈÌÀßÄê¥°¥ë¡¼¥×¤ÎËÝÌõ
UPDATE configuration_group SET configuration_group_title = '¥·¥ç¥Ã¥×Á´ÈÌ¤ÎÀßÄê', configuration_group_description = '¥·¥ç¥Ã¥×¤Î°ìÈÌÅª¤Ê¹àÌÜ¤òÀßÄê¤·¤Þ¤¹¡£' WHERE  configuration_group_id = '1';
UPDATE configuration_group SET configuration_group_title = 'ºÇ¾®ÃÍ¤ÎÀßÄê', configuration_group_description = 'µ¡Ç½¡¦¥Ç¡¼¥¿Îà¤ÎºÇ¾®(¾¯)ÃÍ¤Ë¤Ä¤¤¤ÆÀßÄê¤·¤Þ¤¹¡£' WHERE  configuration_group_id = '2';
UPDATE configuration_group SET configuration_group_title = 'ºÇÂçÃÍ¤ÎÀßÄê', configuration_group_description = 'µ¡Ç½¡¦¥Ç¡¼¥¿Îà¤ÎºÇÂçÃÍ¤Ë¤Ä¤¤¤ÆÀßÄê¤·¤Þ¤¹¡£' WHERE  configuration_group_id = '3';
UPDATE configuration_group SET configuration_group_title = '²èÁü¤ÎÀßÄê', configuration_group_description = '³Æ¼ï¤Î²èÁü¤Ë¤Ä¤¤¤ÆÀßÄê¤·¤Þ¤¹¡£' WHERE  configuration_group_id = '4';
UPDATE configuration_group SET configuration_group_title = '¸ÜµÒ¥¢¥«¥¦¥ó¥È¤ÎÀßÄê', configuration_group_description = '¸ÜµÒ¤Ë¤Ä¤¤¤Æ³Æ¼ï¤ÎÀßÄê¤ò¤·¤Þ¤¹¡£' WHERE  configuration_group_id = '5';
UPDATE configuration_group SET configuration_group_title = '¥â¥¸¥å¡¼¥ë¤ÎÀßÄê', configuration_group_description = '(ÀßÄê²èÌÌ¤Ç¤Ï±£¤ì¤Æ¤¤¤Þ¤¹)' WHERE  configuration_group_id = '6';
UPDATE configuration_group SET configuration_group_title = 'ÇÛÁ÷ÎÁ¡¦¥Ñ¥Ã¥±¡¼¥¸¤ÎÀßÄê', configuration_group_description = 'ÇÒ¾µÎÁ¡¦¥Ñ¥Ã¥±¡¼¥¸(º­Êñ)¤Ë¤Ä¤¤¤Æ³Æ¼ï¤ÎÀßÄê¤ò¤·¤Þ¤¹¡£' WHERE  configuration_group_id = '7';
UPDATE configuration_group SET configuration_group_title = '¾¦ÉÊ¥ê¥¹¥È¤ÎÀßÄê', configuration_group_description = '¾¦ÉÊ¥ê¥¹¥È¤ÎÉ½¼¨¤Ë¤Ä¤¤¤Æ³Æ¼ï¤ÎÀßÄê¤ò¤·¤Þ¤¹¡£' WHERE  configuration_group_id = '8';
UPDATE configuration_group SET configuration_group_title = 'ºß¸Ë¤ÎÀßÄê', configuration_group_description = 'ºß¸Ë¤Ë¤Ä¤¤¤Æ³Æ¼ï¤ÎÀßÄê¤ò¤·¤Þ¤¹¡£' WHERE  configuration_group_id = '9';
UPDATE configuration_group SET configuration_group_title = '¥í¥°¤ÎÀßÄê', configuration_group_description = '¥í¥°¤Ë¤Ä¤¤¤Æ³Æ¼ï¤ÎÀßÄê¤ò¤·¤Þ¤¹¡£' WHERE  configuration_group_id = '10';
UPDATE configuration_group SET configuration_group_title = 'µ¬Ìó´ØÏ¢¤ÎÀßÄê', configuration_group_description = 'µ¬Ìó¤Ë¤Ä¤¤¤Æ³Æ¼ï¤ÎÀßÄê¤ò¤·¤Þ¤¹¡£' WHERE  configuration_group_id = '11';
UPDATE configuration_group SET configuration_group_title = '¥á¡¼¥ë¤ÎÀßÄê', configuration_group_description = '¥á¡¼¥ë¤ÎÁ÷¼õ¿®¤ä½ñ¼°¤Ë¤Ä¤¤¤Æ³Æ¼ï¤ÎÀßÄê¤ò¤·¤Þ¤¹¡£' WHERE  configuration_group_id = '12';
UPDATE configuration_group SET configuration_group_title = '¾¦ÉÊÂ°À­¤ÎÀßÄê', configuration_group_description = '¾¦ÉÊÂ°À­¤Ë¤Ä¤¤¤Æ³Æ¼ï¤ÎÀßÄê¤ò¤·¤Þ¤¹¡£' WHERE  configuration_group_id = '13';
UPDATE configuration_group SET configuration_group_title = 'GZip°µ½Ì¤ÎÀßÄê', configuration_group_description = 'GZip°µ½Ì¤Ë¤Ä¤¤¤ÆÀßÄê¤·¤Þ¤¹¡£' WHERE  configuration_group_id = '14';
UPDATE configuration_group SET configuration_group_title = '¥»¥Ã¥·¥ç¥ó´ÉÍý¤ÎÀßÄê', configuration_group_description = '¥»¥Ã¥·¥ç¥ó¾ðÊó¤Î´ÉÍý¤Ë¤Ä¤¤¤Æ³Æ¼ï¤ÎÀßÄê¤ò¤·¤Þ¤¹¡£' WHERE  configuration_group_id = '15';
UPDATE configuration_group SET configuration_group_title = '¥®¥Õ¥È·ô¡¦¥¯¡¼¥Ý¥ó·ô¤ÎÀßÄê', configuration_group_description = '¥®¥Õ¥È·ô¡¦¥¯¡¼¥Ý¥ó·ô¤Ë¤Ä¤¤¤Æ³Æ¼ï¤ÎÀßÄê¤ò¤·¤Þ¤¹¡£' WHERE  configuration_group_id = '16';
UPDATE configuration_group SET configuration_group_title = '¥¯¥ì¥¸¥Ã¥È¥«¡¼¥É¤ÎÀßÄê', configuration_group_description = '¥¯¥ì¥¸¥Ã¥È¥«¡¼¥É¤Ë¤Ä¤¤¤Æ³Æ¼ï¤ÎÀßÄê¤ò¤·¤Þ¤¹¡£' WHERE  configuration_group_id = '17';
UPDATE configuration_group SET configuration_group_title = '¾¦ÉÊ¾ðÊó¤ÎÀßÄê', configuration_group_description = '¾¦ÉÊ¾ðÊó¤ÎÉ½¼¨¤Ë¤Ä¤¤¤Æ³Æ¼ï¤ÎÀßÄê¤ò¤·¤Þ¤¹¡£' WHERE  configuration_group_id = '18';
UPDATE configuration_group SET configuration_group_title = '¥ì¥¤¥¢¥¦¥È¤ÎÀßÄê', configuration_group_description = '¥·¥ç¥Ã¥×¤ÎÉ½¼¨¥ì¥¤¥¢¥¦¥È¤Ë¤Ä¤¤¤Æ³Æ¼ï¤ÎÀßÄê¤ò¤·¤Þ¤¹¡£' WHERE  configuration_group_id = '19';
UPDATE configuration_group SET configuration_group_title = '¥á¥ó¥Æ¥Ê¥ó¥¹É½¼¨¤ÎÀßÄê', configuration_group_description = '¡Ö¥á¥ó¥Æ¥Ê¥ó¥¹Ãæ¡×É½¼¨¤Ê¤É¤Ë¤Ä¤¤¤Æ³Æ¼ï¤ÎÀßÄê¤ò¤·¤Þ¤¹¡£' WHERE  configuration_group_id = '20';
UPDATE configuration_group SET configuration_group_title = '¿·Ãå¾¦ÉÊ¥ê¥¹¥È¤ÎÀßÄê', configuration_group_description = '¿·Ãå¾¦ÉÊ¥ê¥¹¥È¤Ë¤Ä¤¤¤Æ³Æ¼ï¤ÎÀßÄê¤ò¤·¤Þ¤¹¡£' WHERE  configuration_group_id = '21';
UPDATE configuration_group SET configuration_group_title = '¤ª¤¹¤¹¤á¾¦ÉÊ¥ê¥¹¥È¤ÎÀßÄê', configuration_group_description = '¤ª¤¹¤¹¤á¾¦ÉÊ¥ê¥¹¥È¤Ë¤Ä¤¤¤Æ³Æ¼ï¤ÎÀßÄê¤ò¤·¤Þ¤¹¡£' WHERE  configuration_group_id = '22';
UPDATE configuration_group SET configuration_group_title = 'Á´¾¦ÉÊ¥ê¥¹¥È¤ÎÀßÄê', configuration_group_description = 'Á´¾¦ÉÊ¥ê¥¹¥È¤Ë¤Ä¤¤¤Æ³Æ¼ï¤ÎÀßÄê¤ò¤·¤Þ¤¹¡£' WHERE  configuration_group_id = '23';
UPDATE configuration_group SET configuration_group_title = '¥È¥Ã¥×¥Ú¡¼¥¸¤ÎÉ½¼¨ÀßÄê', configuration_group_description = '¥È¥Ã¥×¥Ú¡¼¥¸¤ÎÍ×ÁÇÉ½¼¨¤Ë¤Ä¤¤¤Æ³Æ¼ï¤ÎÀßÄê¤ò¤·¤Þ¤¹¡£' WHERE  configuration_group_id = '24';
UPDATE configuration_group SET configuration_group_title = 'ÄêÈÖ¥Ú¡¼¥¸¤ÎÉ½¼¨ÀßÄê', configuration_group_description = 'ÄêÈÖ¥Ú¡¼¥¸¤ÈHTMLArea¤Ê¤É¤Ë¤Ä¤¤¤Æ³Æ¼ï¤ÎÀßÄê¤ò¤·¤Þ¤¹¡£' WHERE  configuration_group_id = '25';
UPDATE configuration_group SET configuration_group_title = 'EZ-Pages¤ÎÀßÄê', configuration_group_description = 'EZ¥Ú¡¼¥¸¤Ë¤Ä¤¤¤Æ³Æ¼ï¤ÎÀßÄê¤ò¤·¤Þ¤¹¡£' WHERE  configuration_group_id = '30';

UPDATE configuration SET configuration_title='¥·¥ç¥Ã¥×Ì¾', configuration_description='¥·¥ç¥Ã¥×Ì¾¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='STORE_NAME';
UPDATE configuration SET configuration_title='¥·¥ç¥Ã¥×¥ª¡¼¥Ê¡¼Ì¾', configuration_description='¥·¥ç¥Ã¥×¥ª¡¼¥Ê¡¼Ì¾(¤Þ¤¿¤Ï±¿±Ä´ÉÍý¼ÔÌ¾)¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='STORE_OWNER';
UPDATE configuration SET configuration_title='¹ñ', configuration_description='Å¹ÊÞ¤¬Â¸ºß¤¹¤ë¹ñÌ¾¤òÆþÎÏ¤·¤Æ¤¯¤À¤µ¤¤¡£<strong>Ãí°Õ¡§ÊÑ¹¹¤·¤¿¤éÅ¹ÊÞ¤Î¥¾¡¼¥ó¤Î¹¹¿·¤òËº¤ì¤º¤Ë¹Ô¤Ã¤Æ¤¯¤À¤µ¤¤¡£</strong>' WHERE configuration_key='STORE_COUNTRY';
UPDATE configuration SET configuration_title='ÃÏ°è', configuration_description='¥·¥ç¥Ã¥×¤Î½êºßÃÏ°è(¸©Ì¾)¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='STORE_ZONE';
UPDATE configuration SET configuration_title='Æþ²ÙÍ½Äê¾¦ÉÊ¤Î¥½¡¼¥È½ç', configuration_description='Æþ²ÙÍ½Äê¾¦ÉÊ¤Î¥½¡¼¥È½ç¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />\r\n¡¦asc(¾º½ç)<br />\r\n¡¦desc(¹ß½ç)' WHERE configuration_key='EXPECTED_PRODUCTS_SORT';
UPDATE configuration SET configuration_title='Æþ²ÙÍ½Äê¾¦ÉÊ¤Î¥½¡¼¥È½ç¤ËÍÑ¤¤¤ë¥Õ¥£¡¼¥ë¥É', configuration_description='Æþ²ÙÍ½Äê¾¦ÉÊ¤Î¥½¡¼¥È½ç¤Ë»ÈÍÑ¤¹¤ë¥Õ¥£¡¼¥ë¥É¤òÀßÄê¤·¤Þ¤¹¡£<BR>¡¦products_name:ÉÊÌ¾<BR>¡¦date_expected:Í½ÄêÆü' WHERE configuration_key='EXPECTED_PRODUCTS_FIELD';
UPDATE configuration SET configuration_title='É½¼¨¸À¸ì¤ÈÄÌ²ß¤ÎÏ¢Æ°', configuration_description='É½¼¨¸À¸ì¤ÈÄÌ²ß¤ÎÊÑ¹¹¤òÏ¢Æ°¤µ¤»¤ë¤«¤É¤¦¤«ÀßÄê¤·¤Þ¤¹¡£<br /><br />true(Ï¢Æ°)<br />false(ÈóÏ¢Æ°)' WHERE configuration_key='USE_DEFAULT_LANGUAGE_CURRENCY';
UPDATE configuration SET configuration_title='É½¼¨¸À¸ì¤ÎÁªÂò', configuration_description='¥·¥ç¥Ã¥×¤Î¥Ç¥Õ¥©¥ë¥È¤ÎÉ½¼¨¸À¸ì¤Ï¥·¥ç¥Ã¥×¤Î½é´üÀßÄê¤Þ¤¿¤Ï¥æ¡¼¥¶¡¼¤Î¥Ö¥é¥¦¥¶ÀßÄê¤Î¤É¤Á¤é¤Ë´ð¤Å¤¯¤«¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />¥Ç¥Õ¥©¥ë¥È¡§¥·¥ç¥Ã¥×¤Î½é´üÀßÄê' WHERE configuration_key='LANGUAGE_DEFAULT_SELECTOR';
UPDATE configuration SET configuration_title='¥µ¡¼¥Á¥¨¥ó¥¸¥ó¥Õ¥ì¥ó¥É¥ê¡¼¤ÊURLÉ½µ­(³«È¯Ãæ)', configuration_description='¥µ¡¼¥Á¥¨¥ó¥¸¥ó¤Ë½¦¤ï¤ì¤ä¤¹¤¤¡¢ÀÅÅªHTML¤Î¤è¤¦¤ÊURLÉ½µ­¤ò¹Ô¤¦¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />Ãí°Õ¡§Google¤Ç¤ÏÆ°ÅªURL¤Î¥¯¥í¡¼¥ë¤¬¶¯²½¤µ¤ì¤¿¤¿¤á¡¢¤¢¤Þ¤ê°ÕÌ£¤Ï¤Ê¤¤¤è¤¦¤Ç¤¹¡£' WHERE configuration_key='SEARCH_ENGINE_FRIENDLY_URLS';
UPDATE configuration SET configuration_title='¾¦ÉÊ¤ÎÄÉ²Ã¸å¤Ë¥«¡¼¥È¤òÉ½¼¨', configuration_description='¾¦ÉÊ¤ò¥«¡¼¥È¤ËÄÉ²Ã¤·¤¿Ä¾¸å¤Ë¥«¡¼¥È¤ÎÆâÍÆ¤òÉ½¼¨¤¹¤ë¤«¡¢¤Þ¤¿¤Ï¸µ¥Ú¡¼¥¸¤Ë¤¹¤°Ìá¤ë¤«¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />\r\n¡¦true (É½¼¨)<br />\r\n¡¦false (ÈóÉ½¼¨)' WHERE configuration_key='DISPLAY_CART';
UPDATE configuration SET configuration_title='¥Ç¥Õ¥©¥ë¥È¤Î¸¡º÷±é»»»Ò', configuration_description='¥Ç¥Õ¥©¥ë¥È¤Î¸¡º÷±é»»»Ò¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='ADVANCED_SEARCH_DEFAULT_OPERATOR';
UPDATE configuration SET configuration_title='¥·¥ç¥Ã¥×¤Î½»½ê¤ÈÅÅÏÃÈÖ¹æ', configuration_description='¥·¥ç¥Ã¥×Ì¾¡¢¹ñÌ¾¡¢½»½ê¡¢ÅÅÏÃÈÖ¹æ¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='STORE_NAME_ADDRESS';
UPDATE configuration SET configuration_title='¥«¥Æ¥´¥êÆâ¤Î¾¦ÉÊ¿ô¤òÉ½¼¨', configuration_description='¥«¥Æ¥´¥êÆâ¤Î¾¦ÉÊ¿ô¤ò²¼°Ì¥«¥Æ¥´¥ê¤â´Þ¤á¤Æ¥«¥¦¥ó¥ÈÉ½¼¨¤¹¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />\r\n¡¦true (¤¹¤ë)<br />\r\n¡¦false (¤·¤Ê¤¤)' WHERE configuration_key='SHOW_COUNTS';
UPDATE configuration SET configuration_title='ÀÇ³Û¤Î¾®¿ôÅÀ°ÌÃÖ', configuration_description='ÀÇ³Û¤Î¾®¿ôÅÀ°Ê²¼¤Î·å¿ô¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='TAX_DECIMAL_PLACES';
UPDATE configuration SET configuration_title='²Á³Ê¤òÀÇ¹þ¤ß¤ÇÉ½¼¨', configuration_description='²Á³Ê¤òÀÇ¹þ¤ß¤ÇÉ½¼¨¤¹¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />\r\n¡¦true = ²Á³Ê¤òÀÇ¹þ¤ß¤ÇÉ½¼¨<br />\r\n¡¦false = ÀÇ³Û¤ò¤Þ¤È¤á¤ÆÉ½¼¨' WHERE configuration_key='DISPLAY_PRICE_WITH_TAX';
UPDATE configuration SET configuration_title='²Á³Ê¤òÀÇ¹þ¤ß¤ÇÉ½¼¨ - ´ÉÍý²èÌÌ', configuration_description='´ÉÍý²èÌÌ¤Ç²Á³Ê¤òÀÇ¹þ¤ß¤ÇÉ½¼¨¤¹¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />\r\n¡¦true = ²Á³Ê¤òÀÇ¹þ¤ß¤ÇÉ½¼¨<br />\r\n¡¦false = ºÇ¸å¤ËÀÇ³Û¤òÉ½¼¨', configuration_value = 'true' WHERE configuration_key='DISPLAY_PRICE_WITH_TAX_ADMIN';
UPDATE configuration SET configuration_title='¾¦ÉÊ¤Ë¤«¤«¤ëÀÇ³Û¤Î»»Äê´ð½à', configuration_description='¾¦ÉÊ¤Ë¤«¤«¤ëÀÇ³Û¤ò»»½Ð¤¹¤ëºÝ¤Î´ð½à¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />\r\n¡¦Shipping ¡Ä¸ÜµÒ(¾¦ÉÊÁ÷ÉÕÀè)¤Î½»½ê<br />\r\n¡¦Billing ¡Ä¸ÜµÒ¤ÎÀÁµáÀè¤Î½»½ê<br />\r\n¡¦Store ¡Ä¥·¥ç¥Ã¥×¤Î½êºßÃÏ¤Ë¤è¤ë(Á÷ÉÕÀè¡¦ÀÁµáÀè¤È¤â¥·¥ç¥Ã¥×¤Î½êºßÃÏ°è¤Ç¤¢¤ë¾ì¹ç¤ËÍ­¸ú)\r\n' WHERE configuration_key='STORE_PRODUCT_TAX_BASIS';
UPDATE configuration SET configuration_title='Á÷ÎÁ¤Ë¤«¤«¤ëÀÇ³Û¤Î»»Äê´ð½à', configuration_description='Á÷ÎÁ¤Ë¤«¤«¤ëÀÇ¶â¤ò»»½Ð¤¹¤ëºÝ¤Î´ð½à¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />\r\n¡¦Shipping ¡Ä¸ÜµÒ(¾¦ÉÊÁ÷ÉÕÀè)¤Î½»½ê<br />\r\n¡¦Billing ¡Ä¸ÜµÒ¤ÎÀÁµáÀè¤Î½»½ê<br />\r\n¡¦Store ¡Ä¥·¥ç¥Ã¥×¤Î½êºßÃÏ¤Ë¤è¤ë(Á÷ÉÕÀè¡¦ÀÁµáÀè¤È¤â¥·¥ç¥Ã¥×¤Î½êºßÃÏ°è¤Ç¤¢¤ë¾ì¹ç¤ËÍ­¸ú)<br />\r\nÃí°Õ¡§¤³¤ÎÀßÄê¤ÏÇÛÁ÷¥â¥¸¥å¡¼¥ë¤Ë¤è¤Ã¤Æ¥ª¡¼¥Ð¡¼¥é¥¤¥É(¾å½ñ¤­ÀßÄê)¤¬²ÄÇ½¤Ç¤¹¡£' WHERE configuration_key='STORE_SHIPPING_TAX_BASIS';
UPDATE configuration SET configuration_title='ÀÇ¶â¤ÎÉ½¼¨', configuration_description='¹ç·×³Û¤¬0±ß¤Ç¤âÀÇ¶â¤òÉ½¼¨¤·¤Þ¤¹¤«?<br />0= Off<br />1= On' WHERE configuration_key='STORE_TAX_DISPLAY_STATUS';
UPDATE configuration SET configuration_title='´ÉÍý²èÌÌ¤Î¥¿¥¤¥à¥¢¥¦¥ÈÀßÄê(ÉÃ¿ô)', configuration_description='´ÉÍý²èÌÌ¤¬¥¿¥¤¥à¥¢¥¦¥È¤¹¤ë¤Þ¤Ç¤ÎÉÃ¿ô¤òÀßÄê¤·¤Þ¤¹¡£¥Ç¥Õ¥©¥ë¥È¤Ï3600ÉÃ¡á1»þ´Ö¤Ç¤¹¡£<br />¤¢¤Þ¤êÃ»¤á¤ËÀßÄê¤¹¤ë¤È¾¦ÉÊÅÐÏ¿Ãæ¤Ê¤É¤Ë¥¿¥¤¥à¥¢¥¦¥È¤·¤Æ¤·¤Þ¤¤¤Þ¤¹¤Î¤ÇÃí°Õ¡£<br />900ÉÃÌ¤Ëþ¤òÀßÄê¤¹¤ë¤È900ÉÃ¤Ë¼«Æ°Åª¤ËÀßÄê¤µ¤ì¤Þ¤¹¡£' WHERE configuration_key='SESSION_TIMEOUT_ADMIN';
UPDATE configuration SET configuration_title='´ÉÍý²èÌÌ¤Î¥×¥í¥°¥é¥à½èÍý¤Î¾å¸Â»þ´ÖÀßÄê(ÉÃ)\r\n', configuration_description='´ÉÍý²èÌÌ¤Ë¤ª¤¤¤Æ¤Ê¤ó¤é¤«¤ÎÁàºî¤ò¹Ô¤Ã¤¿¾ì¹ç¤Î¡¢¥×¥í¥°¥é¥à½èÍý¤Î¶¯À©½ªÎ»»þ´Ö¤òÀßÄê¤·¤Þ¤¹¡£¥Ç¥Õ¥©¥ë¥È¤Ï60ÉÃ¡á1Ê¬¡£¤³¤ÎÀßÄê¤Ï¡¢¥×¥í¥°¥é¥à½èÍý»þ´Ö¤ËÌäÂê¤¬¤¢¤ë¾ì¹ç¤Ê¤É¤Ë¤À¤±ÊÑ¹¹¤·¤Æ¤¯¤À¤µ¤¤¡£\r\n' WHERE configuration_key='GLOBAL_SET_TIME_LIMIT';
UPDATE configuration SET configuration_title='Zen Cart¿·¥Ð¡¼¥¸¥ç¥ó¤Î¼«Æ°¥Á¥§¥Ã¥¯(¥Ø¥Ã¥À¤Ç¹ðÃÎ¤¹¤ë¤«ÈÝ¤«)', configuration_description='Zen Cart¤Î¿·¥Ð¡¼¥¸¥ç¥ó¤¬¥ê¥ê¡¼¥¹¤µ¤ì¤¿¾ì¹ç¡¢¥Ø¥Ã¥À¤Ë¾ðÊó¤òÉ½¼¨¤·¤Þ¤¹¤«?<br /><br />\r\nÃí°Õ¡§¤³¤ÎÀßÄê¤ò¥ª¥ó¤Ë¤¹¤ë¤È¡¢´ÉÍý¼Ô¥Ú¡¼¥¸¤ÎÉ½¼¨¤¬ÃÙ¤¯¤Ê¤ë¾ì¹ç¤¬¤¢¤ê¤Þ¤¹¡£¥¤¥ó¥¿¡¼¥Í¥Ã¥È¤Ë·Ò¤¬¤Ã¤Æ¤¤¤Ê¤¤¥Æ¥¹¥È´Ä¶­¤Ê¤É¤Ç¤Ïfalse¤Ë¤·¤Æ¤¯¤À¤µ¤¤¡£\r\n' WHERE configuration_key='SHOW_VERSION_UPDATE_IN_HEADER';
UPDATE configuration SET configuration_title='¥·¥ç¥Ã¥×¤Î¥¹¥Æ¡¼¥¿¥¹', configuration_description='¥·¥ç¥Ã¥×¤Î¾õÂÖ¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />\r\n¡¦0¡áÄÌ¾ï¤Î¥·¥ç¥Ã¥×<br />\r\n¡¦1¡á²Á³ÊÉ½¼¨¤Ê¤·¤Î¥Ç¥â¥·¥ç¥Ã¥×<br />\r\n¡¦2¡á²Á³ÊÉ½¼¨ÉÕ¤­¤Î¥Ç¥â¥·¥ç¥Ã¥×\r\n' WHERE configuration_key='STORE_STATUS';
UPDATE configuration SET configuration_title='¥µ¡¼¥Ð¤Î²ÔÆ°»þ´Ö(¥¢¥Ã¥×¥¿¥¤¥à)', configuration_description='¥µ¡¼¥Ð¤Î²ÔÆ¯»þ´Ö¤òÉ½¼¨¤¹¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£¤³¤Î¾ðÊó¤Ï¤¤¤¯¤Ä¤«¤Î¥µ¡¼¥Ð¤Ç¥¨¥é¡¼¥í¥°¤È¤·¤Æ»Ä¤ë¤³¤È¤¬¤¢¤ê¤Þ¤¹¡£<br /><br />true¡áÉ½¼¨<br /><br />false¡áÈóÉ½¼¨' WHERE configuration_key='DISPLAY_SERVER_UPTIME';
UPDATE configuration SET configuration_title='¥ê¥ó¥¯ÀÚ¤ì¥Ú¡¼¥¸¤Î¥Á¥§¥Ã¥¯', configuration_description='Zen Cart¤¬¥ê¥ó¥¯ÀÚ¤ì¥Ú¡¼¥¸¤ò¸¡ÃÎ¤·¤¿ºÝ¤Ë¼«Æ°Åª¤Ë¥È¥Ã¥×¥Ú¡¼¥¸¤ËÅ¾Á÷¤·¤Þ¤¹¤«?<br /><br />\r\n¡¦On = ¥ª¥ó<br />\r\n¡¦Off = ¥ª¥Õ<br />\r\n¡¦Page Not Found = ¥Ú¡¼¥¸¤¬¸«¤Ä¤«¤ê¤Þ¤»¤ó²èÌÌ¤ØÁ«°Ü¤¹¤ë<br />\r\n<br />\r\nÃí°Õ¡§¥Ç¥Ð¥Ã¥¯¤ÎºÝ¤Ê¤É¤Ë¤Ï¤³¤Îµ¡Ç½¤ò¥ª¥Õ¤Ë¤¹¤ë¤È¤è¤¤¤Ç¤·¤ç¤¦¡£' WHERE configuration_key='MISSING_PAGE_CHECK';
UPDATE configuration SET configuration_title='HTML¥¨¥Ç¥£¥¿', configuration_description='¥á¡¼¥ë¥Þ¥¬¥¸¥ó¤ä¾¦ÉÊÀâÌÀ¤Ê¤É¤ÇÍÑ¤¤¤ëHTML/¥ê¥Ã¥Á¥Æ¥­¥¹¥ÈÍÑ¤Î¥½¥Õ¥È¥¦¥§¥¢¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='HTML_EDITOR_PREFERENCE';
UPDATE configuration SET configuration_title='phpBB¤Ø¤Î¥ê¥ó¥¯¤òÉ½¼¨', configuration_description='Zen Cart¾å¤Ë(¥¤¥ó¥¹¥È¡¼¥ëºÑ¤ß¤Î)phpBB¤Î¥Õ¥©¡¼¥é¥à¤Ø¤Î¥ê¥ó¥¯¤òÉ½¼¨¤¹¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£\r\n' WHERE configuration_key='PHPBB_LINKS_ENABLED';
UPDATE configuration SET configuration_title='¥«¥Æ¥´¥êÆâ¤Î¾¦ÉÊ¿ô¤òÉ½¼¨ - ´ÉÍý²èÌÌ', configuration_description='¥«¥Æ¥´¥êÆâ¤Î¾¦ÉÊ¿ô¤ò²¼°Ì¥«¥Æ¥´¥ê¤â´Þ¤á¤Æ¥«¥¦¥ó¥ÈÉ½¼¨¤·¤Þ¤¹¤«?<br /><br />\r\n¡¦true (¤¹¤ë)<br />\r\n¡¦false (¤·¤Ê¤¤)' WHERE configuration_key='SHOW_COUNTS_ADMIN';
UPDATE configuration SET configuration_title='Ì¾Á°¤ÎºÇ¾®Ê¸»ú¿ô', configuration_description='Ì¾Á°¤ÎÊ¸»ú¿ô¤ÎºÇ¾®ÃÍ¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='ENTRY_FIRST_NAME_MIN_LENGTH';
UPDATE configuration SET configuration_title='À«¤ÎºÇ¾®Ê¸»ú¿ô', configuration_description='À«¤ÎÊ¸»ú¿ô¤ÎºÇ¾®ÃÍ¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='ENTRY_LAST_NAME_MIN_LENGTH';
UPDATE configuration SET configuration_title='À¸Ç¯·îÆü¤ÎºÇ¾®Ê¸»ú¿ô', configuration_description='À¸Ç¯·îÆü¤ÎÊ¸»ú¿ô¤ÎºÇ¾®ÃÍ¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='ENTRY_DOB_MIN_LENGTH';
UPDATE configuration SET configuration_title='¥á¡¼¥ë¥¢¥É¥ì¥¹¤ÎºÇ¾®Ê¸»ú¿ô', configuration_description='¥á¡¼¥ë¥¢¥É¥ì¥¹¤ÎÊ¸»ú¿ô¤ÎºÇ¾®ÃÍ¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='ENTRY_EMAIL_ADDRESS_MIN_LENGTH';
UPDATE configuration SET configuration_title='½»½ê¤ÎºÇ¾®Ê¸»ú¿ô', configuration_description='ÈÖÃÏ¡¦¥Þ¥ó¥·¥ç¥ó¡¦¥¢¥Ñ¡¼¥ÈÌ¾¤ÎºÇ¾®Ê¸»ú¿ô¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='ENTRY_STREET_ADDRESS_MIN_LENGTH';
UPDATE configuration SET configuration_title='²ñ¼ÒÌ¾¤ÎºÇ¾®Ê¸»ú¿ô', configuration_description='²ñ¼ÒÌ¾¤ÎÊ¸»ú¿ô¤ÎºÇ¾®ÃÍ¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='ENTRY_COMPANY_MIN_LENGTH';
UPDATE configuration SET configuration_title='Í¹ÊØÈÖ¹æ¤ÎºÇ¾®Ê¸»ú¿ô', configuration_description='Í¹ÊØÈÖ¹æ¤ÎÊ¸»ú¿ô¤ÎºÇ¾®ÃÍ¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='ENTRY_POSTCODE_MIN_LENGTH';
UPDATE configuration SET configuration_title='»Ô¶èÄ®Â¼¤ÎºÇ¾®Ê¸»ú¿ô', configuration_description='»Ô¶èÄ®Â¼¤ÎÊ¸»ú¿ô¤ÎºÇ¾®ÃÍ¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='ENTRY_CITY_MIN_LENGTH';
UPDATE configuration SET configuration_title='ÅÔÆ»ÉÜ¸©Ì¾¤ÎºÇ¾®Ê¸»ú¿ô', configuration_description='ÅÔÆ»ÉÜ¸©¤ÎÊ¸»ú¿ô¤ÎºÇ¾®ÃÍ¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='ENTRY_STATE_MIN_LENGTH';
UPDATE configuration SET configuration_title='ÅÅÏÃÈÖ¹æ¤ÎºÇ¾®Ê¸»ú¿ô', configuration_description='ÅÅÏÃÈÖ¹æ¤ÎÊ¸»ú¿ô¤ÎºÇ¾®ÃÍ¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='ENTRY_TELEPHONE_MIN_LENGTH';
UPDATE configuration SET configuration_title='¥Ñ¥¹¥ï¡¼¥É¤ÎºÇ¾®Ê¸»ú¿ô', configuration_description='¥Ñ¥¹¥ï¡¼¥É¤ÎÊ¸»ú¿ô¤ÎºÇ¾®ÃÍ¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='ENTRY_PASSWORD_MIN_LENGTH';
UPDATE configuration SET configuration_title='¥¯¥ì¥¸¥Ã¥È¥«¡¼¥ÉÌ¾µÁ¤ÎºÇ¾®Ê¸»ú¿ô', configuration_description='¥¯¥ì¥¸¥Ã¥È¥«¡¼¥É½êÍ­¼ÔÌ¾¤ÎÊ¸»ú¿ô¤ÎºÇ¾®ÃÍ¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='CC_OWNER_MIN_LENGTH';
UPDATE configuration SET configuration_title='¥¯¥ì¥¸¥Ã¥È¥«¡¼¥ÉÈÖ¹æ¤ÎºÇ¾®Ê¸»ú¿ô', configuration_description='¥¯¥ì¥¸¥Ã¥È¥«¡¼¥ÉÈÖ¹æ¤ÎÊ¸»ú¿ô¤ÎºÇ¾®ÃÍ¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='CC_NUMBER_MIN_LENGTH';
UPDATE configuration SET configuration_title='¥¯¥ì¥¸¥Ã¥È¥«¡¼¥ÉCVVÈÖ¹æ¤ÎºÇ¾®Ê¸»ú¿ô', configuration_description='¥¯¥ì¥¸¥Ã¥È¥«¡¼¥ÉCVVÈÖ¹æ¤ÎÊ¸»ú¿ô¤ÎºÇ¾®ÃÍ¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='CC_CVV_MIN_LENGTH';
UPDATE configuration SET configuration_title='¥ì¥Ó¥å¡¼¤ÎÊ¸¾Ï¤ÎºÇ¾®Ê¸»ú¿ô', configuration_description='¥ì¥Ó¥å¡¼¤ÎÊ¸¾Ï¤ÎÊ¸»ú¿ô¤ÎºÇ¾®ÃÍ¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='REVIEW_TEXT_MIN_LENGTH';
UPDATE configuration SET configuration_title='¥Ù¥¹¥È¥»¥é¡¼¤ÎºÇ¾®É½¼¨·ï¿ô', configuration_description='¥Ù¥¹¥È¥»¥é¡¼¤È¤·¤ÆÉ½¼¨¤¹¤ë¾¦ÉÊ¤ÎºÇ¾®ÃÍ¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='MIN_DISPLAY_BESTSELLERS';
UPDATE configuration SET configuration_title='¡Ö¤³¤ó¤Ê¾¦ÉÊ¤â¹ØÆþ¤·¤Æ¤¤¤Þ¤¹¡×¤ÎºÇ¾®É½¼¨¿ô', configuration_description='¡Ö¤³¤Î¾¦ÉÊ¤ò¹ØÆþ¤·¤¿¿Í¤Ï¤³¤ó¤Ê¾¦ÉÊ¤â¹ØÆþ¤·¤Æ¤¤¤Þ¤¹¡×¤ÇÉ½¼¨¤¹¤ë¾¦ÉÊ¿ô¤ÎºÇ¾®ÃÍ¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='MIN_DISPLAY_ALSO_PURCHASED';
UPDATE configuration SET configuration_title='¥Ë¥Ã¥¯¥Í¡¼¥à¤ÎºÇ¾®Ê¸»ú¿ô', configuration_description='¥Ë¥Ã¥¯¥Í¡¼¥à¤ÎÊ¸»ú¿ô¤ÎºÇ¾®ÃÍ¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='ENTRY_NICK_MIN_LENGTH';
UPDATE configuration SET configuration_title='¥¢¥É¥ì¥¹Ä¢¤ÎºÇÂçÅÐÏ¿¿ô', configuration_description='¸ÜµÒ¤¬ÅÐÏ¿¤Ç¤­¤ë¥¢¥É¥ì¥¹Ä¢¤ÎÅÐÏ¿¿ô¤ÎºÇÂçÃÍ¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='MAX_ADDRESS_BOOK_ENTRIES';
UPDATE configuration SET configuration_title='´ÉÍý²èÌÌ - 1¥Ú¡¼¥¸¤ËÉ½¼¨¤¹¤ë¸¡º÷·ë²Ì¤ÎºÇÂç¿ô', configuration_description='´ÉÍý²èÌÌ¤Î1¥Ú¡¼¥¸¤ËÉ½¼¨¤¹¤ë¸¡º÷·ë²Ì¤Î¿ô¤ÎºÇÂçÃÍ¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='MAX_DISPLAY_SEARCH_RESULTS';
UPDATE configuration SET configuration_title='¥Ú¡¼¥¸¡¦¥ê¥ó¥¯¿ô¤ÎºÇÂçÉ½¼¨¿ô', configuration_description='¾¦ÉÊ¥ê¥¹¥È¤ä¹ØÆþÍúÎò¤Î°ìÍ÷É½¼¨¤Ç¥Ú¡¼¥¸¤Î²¼¤Ê¤É¤ËÉ½¼¨¤µ¤ì¤ë¥Ú¡¼¥¸¿ô¡¦¥ê¥ó¥¯¿ô¤ÎºÇÂçÃÍ¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='MAX_DISPLAY_PAGE_LINKS';
UPDATE configuration SET configuration_title='ÆÃ²Á¾¦ÉÊ¤ÎºÇÂçÉ½¼¨¿ô', configuration_description='ÆÃ²Á¾¦ÉÊ¤È¤·¤ÆÉ½¼¨¤¹¤ë¾¦ÉÊ¿ô¤ÎºÇÂçÃÍ¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='MAX_DISPLAY_SPECIAL_PRODUCTS';
UPDATE configuration SET configuration_title='º£·î¤Î¿·Ãå¾¦ÉÊ¤ÎºÇÂçÉ½¼¨¿ô', configuration_description='º£·î¤Î¿·Ãå¾¦ÉÊ¿ô¤ÎºÇÂçÃÍ¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='MAX_DISPLAY_NEW_PRODUCTS';
UPDATE configuration SET configuration_title='Æþ²ÙÍ½Äê¾¦ÉÊ¤ÎºÇÂçÉ½¼¨¿ô', configuration_description='Æþ²ÙÍ½Äê¾¦ÉÊ¤È¤·¤ÆÉ½¼¨¤¹¤ë¾¦ÉÊ¿ô¤ÎºÇÂçÃÍ¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='MAX_DISPLAY_UPCOMING_PRODUCTS';
UPDATE configuration SET configuration_title='¥á¡¼¥«¡¼¥ê¥¹¥È - ¥¹¥¯¥í¡¼¥ë¥Ü¥Ã¥¯¥¹¤Î¥µ¥¤¥º/¥¹¥¿¥¤¥ë', configuration_description='¥¹¥¯¥í¡¼¥ë¥Ü¥Ã¥¯¥¹¤ËÉ½¼¨¤µ¤ì¤ë¥á¡¼¥«¡¼¿ô¤Ï ?<br />1¤«0¤ËÀßÄê¤¹¤ë¤È¥É¥í¥Ã¥×¥À¥¦¥ó¥ê¥¹¥È¤Ë¤Ê¤ê¤Þ¤¹¡£' WHERE configuration_key='MAX_MANUFACTURERS_LIST';
UPDATE configuration SET configuration_title='¥á¡¼¥«¡¼¥ê¥¹¥È - ¾¦ÉÊ¤ÎÂ¸ºß¤ò³ÎÇ§', configuration_description='³Æ¥á¡¼¥«¡¼¤Ë¤Ä¤¤¤Æ¡¢1ÅÀ°Ê¾å¤Î¾¦ÉÊ¤¬¤¢¤ê¡¢¤«¤Ä±ÜÍ÷²ÄÇ½¤Ç¤¢¤ë¤«¤É¤¦¤«¤ò³ÎÇ§¤·¤Þ¤¹¤«?<br /><br />Ãí°Õ¡§¤³¤Îµ¡Ç½¤¬ON¤Î¾ì¹ç¡¢¾¦ÉÊ¿ô¤ä¥á¡¼¥«¡¼¤Î¿ô¤¬Â¿¤¤¤ÈÉ½¼¨¤¬ÃÙ¤¯¤Ê¤ê¤Þ¤¹¡£<br />0= off 1= on' WHERE configuration_key='PRODUCTS_MANUFACTURERS_STATUS';
UPDATE configuration SET configuration_title='²»³Ú¥¸¥ã¥ó¥ë¥ê¥¹¥È - ¥¹¥¯¥í¡¼¥ë¥Ü¥Ã¥¯¥¹¤Î¥µ¥¤¥º/¥¹¥¿¥¤¥ë', configuration_description='¥¹¥¯¥í¡¼¥ë¥Ü¥Ã¥¯¥¹¤ËÉ½¼¨¤µ¤ì¤ë²»³Ú¥¸¥ã¥ó¥ë¥ê¥¹¥È¤Î¿ô¤òÀßÄê¤·¤Þ¤¹¡£1¤«0¤ËÀßÄê¤¹¤ë¤È¡¢¥É¥í¥Ã¥×¥À¥¦¥ó¥ê¥¹¥È¤Ë¤Ê¤ê¤Þ¤¹¡£\r\n' WHERE configuration_key='MAX_MUSIC_GENRES_LIST';
UPDATE configuration SET configuration_title='¥ì¥³¡¼¥É²ñ¼Ò¥ê¥¹¥È - ¥¹¥¯¥í¡¼¥ë¥Ü¥Ã¥¯¥¹¤Î¥µ¥¤¥º/¥¹¥¿¥¤¥ë', configuration_description='¥¹¥¯¥í¡¼¥ë¥Ü¥Ã¥¯¥¹¤ËÉ½¼¨¤µ¤ì¤ë¥ì¥³¡¼¥É²ñ¼Ò¥ê¥¹¥È¤Î¿ô¤Ç¤¹¡£1¤«0¤ËÀßÄê¤¹¤ë¤È¡¢¥É¥í¥Ã¥×¥À¥¦¥ó¥ê¥¹¥È¤Ë¤Ê¤ê¤Þ¤¹¡£\r\n' WHERE configuration_key='MAX_RECORD_COMPANY_LIST';
UPDATE configuration SET configuration_title='¥ì¥³¡¼¥É²ñ¼ÒÌ¾É½¼¨¤ÎÄ¹¤µ', configuration_description='¥ì¥³¡¼¥É²ñ¼ÒÌ¾¥Ü¥Ã¥¯¥¹¤ÇÉ½¼¨¤µ¤ì¤ëÌ¾Á°¤ÎÄ¹¤µ¤òÀßÄê¤·¤Þ¤¹¡£ÀßÄê¤è¤êÄ¹¤¤Ì¾Á°¤Ï¾ÊÎ¬É½¼¨¤µ¤ì¤Þ¤¹¡£\r\n' WHERE configuration_key='MAX_DISPLAY_RECORD_COMPANY_NAME_LEN';
UPDATE configuration SET configuration_title='²»³Ú¥¸¥ã¥ó¥ëÌ¾¤ÎÊ¸»ú¿ô¤ÎÄ¹¤µ', configuration_description='²»³Ú¥¸¥ã¥ó¥ë¥Ü¥Ã¥¯¥¹¤ÇÉ½¼¨¤µ¤ì¤ëÌ¾Á°¤ÎÄ¹¤µ¤òÀßÄê¤·¤Þ¤¹¡£ÀßÄê¤è¤êÄ¹¤¤Ì¾Á°¤Ï¾ÊÎ¬É½¼¨¤µ¤ì¤Þ¤¹¡£\r\n' WHERE configuration_key='MAX_DISPLAY_MUSIC_GENRES_NAME_LEN';
UPDATE configuration SET configuration_title='¥á¡¼¥«¡¼Ì¾¤ÎÄ¹¤µ', configuration_description='¥á¡¼¥«¡¼¥ê¥¹¥È¤ÇÉ½¼¨¤µ¤ì¤ë¥á¡¼¥«¡¼Ì¾¤ÎÊ¸»ú¿ô¤ÎºÇÂçÃÍ¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='MAX_DISPLAY_MANUFACTURER_NAME_LEN';
UPDATE configuration SET configuration_title='¿·¤·¤¤¥ì¥Ó¥å¡¼¤ÎÉ½¼¨¿ôºÇÂçÃÍ', configuration_description='¿·¤·¤¤¥ì¥Ó¥å¡¼¤È¤·¤ÆÉ½¼¨¤µ¤ì¤ë¿ô¤ÎºÇÂçÃÍ¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='MAX_DISPLAY_NEW_REVIEWS';
UPDATE configuration SET configuration_title='¥ì¥Ó¥å¡¼¤Î¥é¥ó¥À¥àÉ½¼¨¿ô', configuration_description='¥é¥ó¥À¥à¤ËÉ½¼¨¤¹¤ë¥ì¥Ó¥å¡¼¿ô¤ÎºÇÂçÃÍ¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />Ãí°Õ¡§¤³¤ÎÀßÄêÃÍ¤òX¤È¤¹¤ë¤È¡¢¥é¥ó¥À¥àÉ½¼¨¤ÎÂÐ¾Ý¤Ë¤Ê¤ë¤Î¤Ï¡¢¤â¤Ã¤È¤â¸Å¤¤¥¢¥¯¥Æ¥£¥Ö¤Ê¥ì¥Ó¥å¡¼¤«¤é¿ô¤¨¤ÆXÈÖÌÜ¤ËÅÐÏ¿¤µ¤ì¤¿¥¢¥¯¥Æ¥£¥Ö¤Ê¥ì¥Ó¥å¡¼¤Þ¤Ç¤Ë¤Ê¤ê¤Þ¤¹¡£' WHERE configuration_key='MAX_RANDOM_SELECT_REVIEWS';
UPDATE configuration SET configuration_title='¿·Ãå¾¦ÉÊ¤Î¥é¥ó¥À¥àÉ½¼¨¿ô', configuration_description='¥é¥ó¥À¥à¤ËÉ½¼¨¤¹¤ë¿·Ãå¾¦ÉÊ¿ô¤ÎºÇÂçÃÍ¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />Ãí°Õ¡§¤³¤ÎÀßÄêÃÍ¤òX¤È¤¹¤ë¤È¡¢¥é¥ó¥À¥àÉ½¼¨¤ÎÂÐ¾Ý¤Ë¤Ê¤ë¤Î¤Ï¡¢¤â¤Ã¤È¤â¸Å¤¤¥¢¥¯¥Æ¥£¥Ö¤Ê¿·Ãå¾¦ÉÊ¤«¤é¿ô¤¨¤ÆXÈÖÌÜ¤ËÅÐÏ¿¤µ¤ì¤¿¥¢¥¯¥Æ¥£¥Ö¤Ê¿·Ãå¾¦ÉÊ¤Þ¤Ç¤Ë¤Ê¤ê¤Þ¤¹¡£' WHERE configuration_key='MAX_RANDOM_SELECT_NEW';
UPDATE configuration SET configuration_title='ÆÃ²Á¾¦ÉÊ¤Î¥é¥ó¥À¥àÉ½¼¨¿ô', configuration_description='¥é¥ó¥À¥à¤ËÉ½¼¨¤¹¤ëÆÃ²Á¾¦ÉÊ¿ô¤ÎºÇÂçÃÍ¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />Ãí°Õ¡§¤³¤ÎÀßÄêÃÍ¤òX¤È¤¹¤ë¤È¡¢¥é¥ó¥À¥àÉ½¼¨¤ÎÂÐ¾Ý¤Ë¤Ê¤ë¤Î¤Ï¡¢¤â¤Ã¤È¤â¸Å¤¤¥¢¥¯¥Æ¥£¥Ö¤ÊÆÃ²Á¾¦ÉÊ¤«¤é¿ô¤¨¤ÆXÈÖÌÜ¤ËÅÐÏ¿¤µ¤ì¤¿¥¢¥¯¥Æ¥£¥Ö¤ÊÆÃ²Á¾¦ÉÊ¤Þ¤Ç¤Ë¤Ê¤ê¤Þ¤¹¡£' WHERE configuration_key='MAX_RANDOM_SELECT_SPECIALS';
UPDATE configuration SET configuration_title='°ì¹Ô¤ËÉ½¼¨¤¹¤ë¥«¥Æ¥´¥ê¿ô', configuration_description='°ì¹Ô¤ËÉ½¼¨¤¹¤ë¥«¥Æ¥´¥ê¿ô¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='MAX_DISPLAY_CATEGORIES_PER_ROW';
UPDATE configuration SET configuration_title='¿·Ãå¾¦ÉÊ°ìÍ÷É½¼¨¿ô', configuration_description='¿·Ãå¾¦ÉÊ¥Ú¡¼¥¸£±¥Ú¡¼¥¸¤ËÉ½¼¨¤¹¤ë¾¦ÉÊ¿ô¤ÎºÇÂçÃÍ¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='MAX_DISPLAY_PRODUCTS_NEW';
UPDATE configuration SET configuration_title='¥Ù¥¹¥È¥»¥é¡¼¤ÎºÇÂçÉ½¼¨·ï¿ô', configuration_description='¥Ù¥¹¥È¥»¥é¡¼¥Ú¡¼¥¸£±¥Ú¡¼¥¸¤ËÉ½¼¨¤¹¤ë¥Ù¥¹¥È¥»¥é¡¼¾¦ÉÊ¿ô¤ÎºÇÂçÃÍ¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='MAX_DISPLAY_BESTSELLERS';
UPDATE configuration SET configuration_title='¡Ö¤³¤ó¤Ê¾¦ÉÊ¤âÇã¤Ã¤Æ¤¤¤Þ¤¹¡×¤ÎºÇÂçÉ½¼¨·ï¿ô', configuration_description='¡Ö¤³¤ó¤Ê¾¦ÉÊ¤âÇã¤Ã¤Æ¤¤¤Þ¤¹¡×Íó¤ËÉ½¼¨¤¹¤ë¾¦ÉÊ¿ô¤ÎºÇÂçÃÍ¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='MAX_DISPLAY_ALSO_PURCHASED';
UPDATE configuration SET configuration_title='¸ÜµÒ¤ÎÃíÊ¸ÍúÎò¥Ü¥Ã¥¯¥¹¤ÎºÇÂçÉ½¼¨¿ô', configuration_description='¸ÜµÒ¤ÎÃíÊ¸ÍúÎò¥Ü¥Ã¥¯¥¹¤ËÉ½¼¨¤¹¤ë¾¦ÉÊ¿ô¤ÎºÇÂçÃÍ¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='MAX_DISPLAY_PRODUCTS_IN_ORDER_HISTORY_BOX';
UPDATE configuration SET configuration_title='ÃíÊ¸ÍúÎò¥Ú¡¼¥¸¤ÎºÇÂçÉ½¼¨·ï¿ô', configuration_description='¸ÜµÒ¤ÎÃíÊ¸ÍúÎò¥Ú¡¼¥¸£±¥Ú¡¼¥¸¤ËÉ½¼¨¤¹¤ë¾¦ÉÊ¿ô¤ÎºÇÂçÃÍ¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='MAX_DISPLAY_ORDER_HISTORY';
UPDATE configuration SET configuration_title='¸ÜµÒ´ÉÍý¥Ú¡¼¥¸¤ÇÉ½¼¨¤¹¤ë¸ÜµÒ¿ô¤ÎºÇÂçÃÍ', configuration_description='' WHERE configuration_key='MAX_DISPLAY_SEARCH_RESULTS_CUSTOMER';
UPDATE configuration SET configuration_title='ÃíÊ¸´ÉÍý¥Ú¡¼¥¸¤ÇÉ½¼¨¤¹¤ëÃíÊ¸¿ô¤ÎºÇÂçÃÍ', configuration_description='' WHERE configuration_key='MAX_DISPLAY_SEARCH_RESULTS_ORDERS';
UPDATE configuration SET configuration_title='¥ì¥Ý¡¼¥È¥Ú¡¼¥¸¤ÇÉ½¼¨¤¹¤ë¾¦ÉÊ¿ô¤ÎºÇÂçÃÍ', configuration_description='' WHERE configuration_key='MAX_DISPLAY_SEARCH_RESULTS_REPORTS';
UPDATE configuration SET configuration_title='¥«¥Æ¥´¥ê/¾¦ÉÊ¥Ú¡¼¥¸¤ÇÉ½¼¨¤¹¤ë¥ê¥¹¥È¿ô', configuration_description='£±¥Ú¡¼¥¸¤ËÉ½¼¨¤¹¤ë¾¦ÉÊ¿ô¤ÎºÇÂçÃÍ¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='MAX_DISPLAY_RESULTS_CATEGORIES';
UPDATE configuration SET configuration_title='¾¦ÉÊ¥ê¥¹¥È - ¥Ú¡¼¥¸¤¢¤¿¤êºÇÂçÉ½¼¨¿ô', configuration_description='¥È¥Ã¥×¥Ú¡¼¥¸¤Î¾¦ÉÊ¥ê¥¹¥ÈÉ½¼¨¤Ç¤ÎºÇÂçÉ½¼¨¿ô¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='MAX_DISPLAY_PRODUCTS_LISTING';
UPDATE configuration SET configuration_title='¾¦ÉÊ¥ª¥×¥·¥ç¥ó - ¥ª¥×¥·¥ç¥óÌ¾¤È¥ª¥×¥·¥ç¥óÃÍ¤ÎÉ½¼¨', configuration_description='¾¦ÉÊ¥ª¥×¥·¥ç¥ó¥Ú¡¼¥¸¤ÇÉ½¼¨¤¹¤ë¥ª¥×¥·¥ç¥óÌ¾/¥ª¥×¥·¥ç¥óÃÍ¤ÎºÇÂçÃÍ¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='MAX_ROW_LISTS_OPTIONS';
UPDATE configuration SET configuration_title='¾¦ÉÊ¥ª¥×¥·¥ç¥ó - ¥ª¥×¥·¥ç¥ó´ÉÍý²èÌÌ', configuration_description='¥ª¥×¥·¥ç¥ó´ÉÍý²èÌÌ¤ÇÉ½¼¨¤¹¤ë¥ª¥×¥·¥ç¥ó¿ô¤ÎºÇÂçÃÍ¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='MAX_ROW_LISTS_ATTRIBUTES_CONTROLLER';
UPDATE configuration SET configuration_title='¾¦ÉÊÂ°À­- ¥À¥¦¥ó¥í¡¼¥É´ÉÍý¥Ú¡¼¥¸¤ÎÉ½¼¨', configuration_description='¥À¥¦¥ó¥í¡¼¥É´ÉÍý²èÌÌ¤Ç¡¢¥À¥¦¥ó¥í¡¼¥É¾¦ÉÊ¤ÎÂ°À­¤ÎºÇÂçÉ½¼¨¿ô¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='MAX_DISPLAY_SEARCH_RESULTS_DOWNLOADS_MANAGER';
UPDATE configuration SET configuration_title='¤ª¤¹¤¹¤á¾¦ÉÊ - ´ÉÍý²èÌÌ¤Ç¤Î¥Ú¡¼¥¸¤¢¤¿¤êÉ½¼¨ºÇÂç¿ô', configuration_description='´ÉÍý²èÌÌ¤Ë¤ª¤¤¤Æ¡¢¥Ú¡¼¥¸¤¢¤¿¤ê¤Î¤ª¤¹¤¹¤á¾¦ÉÊ¤òºÇÂçÉ½¼¨·ï¿ô¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='MAX_DISPLAY_SEARCH_RESULTS_FEATURED_ADMIN';
UPDATE configuration SET configuration_title='¤ª¤¹¤¹¤á¾¦ÉÊ - ¥È¥Ã¥×¥Ú¡¼¥¸¤Ç¤ÎºÇÂçÉ½¼¨¿ô', configuration_description='¥È¥Ã¥×¥Ú¡¼¥¸¤Ç¤ª¤¹¤¹¤á¾¦ÉÊ¤òºÇÂç²¿ÅÀÉ½¼¨¤¹¤ë¤«¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='MAX_DISPLAY_SEARCH_RESULTS_FEATURED';
UPDATE configuration SET configuration_title='¤ª¤¹¤¹¤á¾¦ÉÊ - ¾¦ÉÊ¥ê¥¹¥È¤Ç¤ÎºÇÂçÉ½¼¨¿ô', configuration_description='¾¦ÉÊ¥ê¥¹¥È¤Ç¤ª¤¹¤¹¤á¾¦ÉÊ¤ò¥Ú¡¼¥¸¤¢¤¿¤êºÇÂç²¿ÅÀÉ½¼¨¤¹¤ë¤«¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='MAX_DISPLAY_PRODUCTS_FEATURED_PRODUCTS';
UPDATE configuration SET configuration_title='¤ª¤¹¤¹¤á¾¦ÉÊ¤Î¥é¥ó¥À¥àÉ½¼¨¥Ü¥Ã¥¯¥¹ - ºÇÂçÉ½¼¨¿ô', configuration_description='¤ª¤¹¤¹¤á¾¦ÉÊ¤Î¥é¥ó¥À¥àÉ½¼¨¥Ü¥Ã¥¯¥¹¤Ë¤ª¤¤¤Æ¡¢ºÇÂç²¿ÅÀÉ½¼¨¤¹¤ë¤«¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='MAX_RANDOM_SELECT_FEATURED_PRODUCTS';
UPDATE configuration SET configuration_title='ÆÃ²Á¾¦ÉÊ - ¥È¥Ã¥×¥Ú¡¼¥¸¤Ç¤ÎºÇÂçÉ½¼¨ÅÀ¿ô', configuration_description='¥È¥Ã¥×¥Ú¡¼¥¸¤Ç¡¢ÆÃ²Á¾¦ÉÊ¤òºÇÂç²¿ÅÀÉ½¼¨¤¹¤ë¤«¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='MAX_DISPLAY_SPECIAL_PRODUCTS_INDEX';
UPDATE configuration SET configuration_title='¿·Ãå¾¦ÉÊ - É½¼¨´ü¸Â', configuration_description='¿·Ãå¾¦ÉÊ¤ÎÉ½¼¨´ü¸Â¤òÀßÄê¤·¤Þ¤¹¡£<br />\r\n<br />\r\n¡¦0=Á´¤Æ¡¦¹ß½ç<br />\r\n¡¦1=Åö·îÅÐÏ¿Ê¬¤Î¤ß<br />\r\n¡¦30=ÅÐÏ¿¤«¤é30Æü´Ö<br />\r\n¡¦60=ÅÐÏ¿¤«¤é60Æü´Ö(¤Û¤«90¡¢120¤ÎÀßÄê¤¬²ÄÇ½)' WHERE configuration_key='SHOW_NEW_PRODUCTS_LIMIT';
UPDATE configuration SET configuration_title='¾¦ÉÊ°ìÍ÷¥Ú¡¼¥¸ - ¥Ú¡¼¥¸¤¢¤¿¤êÉ½¼¨ÅÀ¿ô', configuration_description='¾¦ÉÊ°ìÍ÷¤Ë¤ª¤¤¤Æ¡¢¥Ú¡¼¥¸¤¢¤¿¤ê¤ÎºÇÂçÉ½¼¨ÅÀ¿ô¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='MAX_DISPLAY_PRODUCTS_ALL';
UPDATE configuration SET configuration_title='¸À¸ì¥µ¥¤¥É¥Ü¥Ã¥¯¥¹ -¡¡¥Õ¥é¥Ã¥°ºÇÂçÉ½¼¨¿ô', configuration_description='¸À¸ì¥µ¥¤¥É¥Ü¥Ã¥¯¥¹¤Ë¤ª¤¤¤Æ¡¢Îó¤¢¤¿¤ê¤Î¥Õ¥é¥Ã¥°¤ÎºÇÂçÉ½¼¨ÅÀ¿ô¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='MAX_LANGUAGE_FLAGS_COLUMNS';
UPDATE configuration SET configuration_title='¥Õ¥¡¥¤¥ë¤Î¥¢¥Ã¥×¥í¡¼¥É¥µ¥¤¥º - ¾å¸Â', configuration_description='¥Õ¥¡¥¤¥ë¥¢¥Ã¥×¥í¡¼¥É¤ÎºÝ¤Î¾å¸Â¥µ¥¤¥º¤òÀßÄê¤·¤Þ¤¹¡£¥Ç¥Õ¥©¥ë¥È¤Ï2MB(2,048,000¥Ð¥¤¥È)¤Ç¤¹¡£' WHERE configuration_key='MAX_FILE_UPLOAD_SIZE';
UPDATE configuration SET configuration_title='¥¢¥Ã¥×¥í¡¼¥É¥Õ¥¡¥¤¥ë¤Ëµö²Ä¤¹¤ë¥Õ¥¡¥¤¥ë¥¿¥¤¥×', configuration_description='¥æ¡¼¥¶¡¼¤¬¥¢¥Ã¥×¥í¡¼¥É¤¹¤ë¥Õ¥¡¥¤¥ë¤ËÂÐ¤·¤Æµö²Ä¤¹¤ë¥Õ¥¡¥¤¥ë¥¿¥¤¥×¤Î³ÈÄ¥»Ò¤òÀßÄê¤·¤Þ¤¹¡£Ê£¿ô¤Î¾ì¹ç¤Ï¥«¥ó¥Þ(,)¤Ç¶èÀÚ¤ê¡¢¥³¥í¥ó(.)¤Ï´Þ¤á¤Ê¤¤¤Ç¤¯¤À¤µ¤¤¡£<br /><br />ÀßÄêÎã: "jpg,jpeg,gif,png,eps,cdr,ai,pdf,tif,tiff,bmp,zip"' WHERE configuration_key='UPLOAD_FILENAME_EXTENSIONS';
UPDATE configuration SET configuration_title='´ÉÍý²èÌÌ¤ÎÃíÊ¸¥ê¥¹¥È¤ÇÉ½¼¨¤¹¤ëÃíÊ¸¾ÜºÙ¤ÎºÇÂç·ï¿ô', configuration_description='´ÉÍý²èÌÌ¤ÎÃíÊ¸¥ê¥¹¥È¤Ç¤ÎÃíÊ¸¾ÜºÙ¤ÎºÇÂçÉ½¼¨·ï¿ô¤Ï?<br />0 = ÌµÀ©¸Â' WHERE configuration_key='MAX_DISPLAY_RESULTS_ORDERS_DETAILS_LISTING';
UPDATE configuration SET configuration_title='´ÉÍý²èÌÌ¤Î¥ê¥¹¥È¤ÇÉ½¼¨¤¹¤ëPayPal IPN¤ÎºÇÂç·ï¿ô', configuration_description='´ÉÍý²èÌÌ¤Î¥ê¥¹¥È¤Ç¤ÎPayPal IPN¤ÎÉ½¼¨·ï¿ô¤Ï?<br />¥Ç¥Õ¥©¥ë¥È¤Ï20¤Ç¤¹¡£' WHERE configuration_key='MAX_DISPLAY_SEARCH_RESULTS_PAYPAL_IPN';
UPDATE configuration SET configuration_title='¥Þ¥ë¥Á¥«¥Æ¥´¥ê¥Þ¥Í¡¼¥¸¥ã¤Ç¾¦ÉÊ¤òÉ½¼¨¤¹¤ë¥«¥é¥à¤ÎºÇÂç¿ô', configuration_description='¥Þ¥ë¥Á¥«¥Æ¥´¥ê¥Þ¥Í¡¼¥¸¥ã(Multiple Categories Manager)¤Ç¾¦ÉÊ¤òÉ½¼¨¤¹¤ë¥«¥é¥à¤ÎºÇÂç¿ô¤Ï?<br />3 = ¥Ç¥Õ¥©¥ë¥È' WHERE configuration_key='MAX_DISPLAY_PRODUCTS_TO_CATEGORIES_COLUMNS';
UPDATE configuration SET configuration_title='EZ¥Ú¡¼¥¸¤ÎÉ½¼¨¤ÎºÇÂç·ï¿ô', configuration_description='EZ¥Ú¡¼¥¸¤ÎÉ½¼¨¤ÎºÇÂç·ï¿ô¤Ï?<br />20 = ¥Ç¥Õ¥©¥ë¥È' WHERE configuration_key='MAX_DISPLAY_SEARCH_RESULTS_EZPAGE';
UPDATE configuration SET configuration_title='¾¦ÉÊ²èÁü(¾®)¤Î²£Éý', configuration_description='¾®¤µ¤Ê²èÁü¤Î²£Éý(¥Ô¥¯¥»¥ë)¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='SMALL_IMAGE_WIDTH';
UPDATE configuration SET configuration_title='¾¦ÉÊ²èÁü(¾®)¤Î¹â¤µ', configuration_description='¾®¤µ¤Ê²èÁü¤Î¹â¤µ(¥Ô¥¯¥»¥ë)¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='SMALL_IMAGE_HEIGHT';
UPDATE configuration SET configuration_title='¥Ø¥Ã¥À²èÁü¤Î²£Éý - ´ÉÍý²èÌÌ', configuration_description='´ÉÍý²èÌÌ¤Ç¤Î¥Ø¥Ã¥À²èÁü¤Î²£Éý¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='HEADING_IMAGE_WIDTH';
UPDATE configuration SET configuration_title='¥Ø¥Ã¥À²èÁü¤Î¹â¤µ - ´ÉÍý²èÌÌ', configuration_description='´ÉÍý²èÌÌ¤Ç¤Î¥Ø¥Ã¥À²èÁü¤Î¹â¤µ¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='HEADING_IMAGE_HEIGHT';
UPDATE configuration SET configuration_title='¥µ¥Ö¥«¥Æ¥´¥ê²èÁü¤Î²£Éý', configuration_description='¥µ¥Ö¥«¥Æ¥´¥ê²èÁü¤Î²£Éý¤ò¥Ô¥¯¥»¥ë¿ô¤ÇÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='SUBCATEGORY_IMAGE_WIDTH';
UPDATE configuration SET configuration_title='¥µ¥Ö¥«¥Æ¥´¥ê²èÁü¤Î¹â¤µ', configuration_description='¥µ¥Ö¥«¥Æ¥´¥ê²èÁü¤Î¹â¤µ¤ò¥Ô¥¯¥»¥ë¿ô¤ÇÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='SUBCATEGORY_IMAGE_HEIGHT';
UPDATE configuration SET configuration_title='²èÁü¥µ¥¤¥º¤ò·×»»', configuration_description='²èÁü¥µ¥¤¥º¤ò¼«Æ°Åª¤Ë·×»»¤¹¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='CONFIG_CALCULATE_IMAGE_SIZE';
UPDATE configuration SET configuration_title='²èÁü¤òÉ¬¿Ü¤È¤¹¤ë', configuration_description='²èÁü¤¬¤Ê¤¤¤³¤È¤òÉ½¼¨¤·¤Þ¤¹¡£(¥«¥¿¥í¥°¤ÎºîÀ®»þ¤ËÍ­¸ú)' WHERE configuration_key='IMAGE_REQUIRED';
UPDATE configuration SET configuration_title='¥·¥ç¥Ã¥Ô¥ó¥°¥«¡¼¥È¤ÎÃæ¿È - ¾¦ÉÊ²èÁü¤ÎÉ½¼¨¥ª¥ó¡¦¥ª¥Õ', configuration_description='¥·¥ç¥Ã¥Ô¥ó¥°¥«¡¼¥È¤ÎÃæ¿È¤ËÆþ¤Ã¤Æ¤¤¤ë¾¦ÉÊ¤Î²èÁü¤òÉ½¼¨¤¹¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />\r\n¡¦0= off<br />\r\n¡¦1= on' WHERE configuration_key='IMAGE_SHOPPING_CART_STATUS';
UPDATE configuration SET configuration_title='¥·¥ç¥Ã¥Ô¥ó¥°¥«¡¼¥È¤ÎÃæ¿È¤Î²èÁü¤Î²£Éý', configuration_description='¥Ç¥Õ¥©¥ë¥È = 50' WHERE configuration_key='IMAGE_SHOPPING_CART_WIDTH';
UPDATE configuration SET configuration_title='¥·¥ç¥Ã¥Ô¥ó¥°¥«¡¼¥È¤ÎÃæ¿È¤Î²èÁü¤Î¹â¤µ', configuration_description='¥Ç¥Õ¥©¥ë¥È = 40' WHERE configuration_key='IMAGE_SHOPPING_CART_HEIGHT';
UPDATE configuration SET configuration_title='¾¦ÉÊ¾ðÊó - ¥«¥Æ¥´¥ê¥¢¥¤¥³¥ó²èÁü¤Î²£Éý', configuration_description='¾¦ÉÊ¾ðÊó¥Ú¡¼¥¸¤Ç¤Î¥«¥Æ¥´¥ê¥¢¥¤¥³¥ó¤Î²£Éý(¥Ô¥¯¥»¥ë¿ô)¤Ï?' WHERE configuration_key='CATEGORY_ICON_IMAGE_WIDTH';
UPDATE configuration SET configuration_title='¾¦ÉÊ¾ðÊó - ¥«¥Æ¥´¥ê¥¢¥¤¥³¥ó²èÁü¤Î¹â¤µ', configuration_description='¾¦ÉÊ¾ðÊó¥Ú¡¼¥¸¤Ç¤Î¥«¥Æ¥´¥ê¥¢¥¤¥³¥ó¤Î¹â¤µ(¥Ô¥¯¥»¥ë¿ô)¤Ï?' WHERE configuration_key='CATEGORY_ICON_IMAGE_HEIGHT';
UPDATE configuration SET configuration_title='¾¦ÉÊ¾ðÊó - ²èÁü¤Î²£Éý', configuration_description='¾¦ÉÊ²èÁü¤Î²£Éý¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='MEDIUM_IMAGE_WIDTH';
UPDATE configuration SET configuration_title='¾¦ÉÊ¾ðÊó - ²èÁü¤Î¹â¤µ', configuration_description='¾¦ÉÊ²èÁü¤Î¹â¤µ¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='MEDIUM_IMAGE_HEIGHT';
UPDATE configuration SET configuration_title='¾¦ÉÊ¾ðÊó - ²èÁü(Ãæ)¤Î¥Õ¥¡¥¤¥ëÀÜÈø¼­(Suffix)', configuration_description='¾¦ÉÊ²èÁü¤Î¥Õ¥¡¥¤¥ëÀÜÈø¼­¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />¡¦¥Ç¥Õ¥©¥ë¥È = _MED' WHERE configuration_key='IMAGE_SUFFIX_MEDIUM';
UPDATE configuration SET configuration_title='¾¦ÉÊ¾ðÊó - ²èÁü(Âç)¤Î¥Õ¥¡¥¤¥ëÀÜÈø¼­(Suffix)', configuration_description='¾¦ÉÊ²èÁü¤Î¥Õ¥¡¥¤¥ëÀÜÈø¼­¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />\r\n¡¦¥Ç¥Õ¥©¥ë¥È = _LRG' WHERE configuration_key='IMAGE_SUFFIX_LARGE';
UPDATE configuration SET configuration_title='¾¦ÉÊ¾ðÊó - £±¹Ô¤ËÉ½¼¨¤¹¤ëÄÉ²Ã²èÁü¿ô', configuration_description='¾¦ÉÊ¾ðÊó¤Ç£±¹Ô¤ËÉ½¼¨¤¹¤ëÄÉ²Ã²èÁü¿ô¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />\r\n¡¦¥Ç¥Õ¥©¥ë¥È = 3' WHERE configuration_key='IMAGES_AUTO_ADDED';
UPDATE configuration SET configuration_title='¾¦ÉÊ¥ê¥¹¥È - ²èÁü¤Î²£Éý', configuration_description='¥Ç¥Õ¥©¥ë¥È = 100' WHERE configuration_key='IMAGE_PRODUCT_LISTING_WIDTH';
UPDATE configuration SET configuration_title='¾¦ÉÊ¥ê¥¹¥È - ²èÁü¤Î¹â¤µ', configuration_description='¥Ç¥Õ¥©¥ë¥È = 80' WHERE configuration_key='IMAGE_PRODUCT_LISTING_HEIGHT';
UPDATE configuration SET configuration_title='¿·¾¦ÉÊ¥ê¥¹¥È - ²èÁü¤Î²£Éý', configuration_description='¥Ç¥Õ¥©¥ë¥È = 100' WHERE configuration_key='IMAGE_PRODUCT_NEW_LISTING_WIDTH';
UPDATE configuration SET configuration_title='¿·¾¦ÉÊ¥ê¥¹¥È - ²èÁü¤Î¹â¤µ', configuration_description='¥Ç¥Õ¥©¥ë¥È = 80' WHERE configuration_key='IMAGE_PRODUCT_NEW_LISTING_HEIGHT';
UPDATE configuration SET configuration_title='¿·¾¦ÉÊ - ²èÁü¤Î²£Éý', configuration_description='¥Ç¥Õ¥©¥ë¥È = 100' WHERE configuration_key='IMAGE_PRODUCT_NEW_WIDTH';
UPDATE configuration SET configuration_title='¿·¾¦ÉÊ - ²èÁü¤Î¹â¤µ', configuration_description='¥Ç¥Õ¥©¥ë¥È = 80' WHERE configuration_key='IMAGE_PRODUCT_NEW_HEIGHT';
UPDATE configuration SET configuration_title='¤ª¤¹¤¹¤á¾¦ÉÊ -²èÁü¤ÎÉý', configuration_description='¥Ç¥Õ¥©¥ë¥È = 100' WHERE configuration_key='IMAGE_FEATURED_PRODUCTS_LISTING_WIDTH';
UPDATE configuration SET configuration_title='¤ª¤¹¤¹¤á¾¦ÉÊ - ²èÁü¤Î¹â¤µ', configuration_description='¥Ç¥Õ¥©¥ë¥È = 80' WHERE configuration_key='IMAGE_FEATURED_PRODUCTS_LISTING_HEIGHT';
UPDATE configuration SET configuration_title='Á´¾¦ÉÊ°ìÍ÷ - ²èÁü¤ÎÉý', configuration_description='¥Ç¥Õ¥©¥ë¥È = 100' WHERE configuration_key='IMAGE_PRODUCT_ALL_LISTING_WIDTH';
UPDATE configuration SET configuration_title='Á´¾¦ÉÊ°ìÍ÷ - ²èÁü¤Î¹â¤µ', configuration_description='¥Ç¥Õ¥©¥ë¥È = 80' WHERE configuration_key='IMAGE_PRODUCT_ALL_LISTING_HEIGHT';
UPDATE configuration SET configuration_title='¾¦ÉÊ²èÁü - ²èÁü¤¬¤Ê¤¤¾ì¹ç¤ÎNo Image²èÁü', configuration_description='¡ÖNo Image¡×²èÁü¤ò¼«Æ°Åª¤ËÉ½¼¨¤¹¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />\r\n¡¦0= off<br />\r\n¡¦1= On<br />' WHERE configuration_key='PRODUCTS_IMAGE_NO_IMAGE_STATUS';
UPDATE configuration SET configuration_title='¾¦ÉÊ²èÁü - No Image²èÁü¤Î»ØÄê', configuration_description='¾¦ÉÊ²èÁü¤¬¤Ê¤¤¾ì¹ç¤ËÉ½¼¨¤¹¤ëNo Image²èÁü¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />Default = no_picture.gif' WHERE configuration_key='PRODUCTS_IMAGE_NO_IMAGE';
UPDATE configuration SET configuration_title='¾¦ÉÊ²èÁü - ¾¦ÉÊ¡¦¥«¥Æ¥´¥ê¤Ç¥×¥í¥Ý¡¼¥·¥ç¥Ê¥ë¤Ê²èÁü¤ò»È¤¦', configuration_description='¾¦ÉÊ¾ðÊó¡¦¥«¥Æ¥´¥ê¤Ç¥×¥í¥Ý¡¼¥·¥ç¥Ê¥ë¤Ê²èÁü¤ò»È¤¤¤Þ¤¹¤«?<br /><br />Ãí°Õ¡§¥×¥í¥Ý¡¼¥·¥ç¥Ê¥ë²èÁü¤Ë¤Ï¹â¤µ¡¦²£Éý¤È¤â"0"(¥Ô¥¯¥»¥ë)¤ò»ØÄê¤·¤Ê¤¤¤Ç¤¯¤À¤µ¤¤¡£<br />0= off 1= on' WHERE configuration_key='PROPORTIONAL_IMAGES_STATUS';
UPDATE configuration SET configuration_title='(¥á¡¼¥ëÍÑ)·É¾ÎÉ½¼¨(Mr. or Ms)', configuration_description='¸ÜµÒ¤Î¥¢¥«¥¦¥ó¥ÈºîÀ®¤ÎºÝ¡¢¥á¡¼¥ëÍÑ¤Î·É¾Î(Mr. or Ms) ¤òÉ½¼¨¤¹¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='ACCOUNT_GENDER';
UPDATE configuration SET configuration_title='À¸Ç¯·îÆü', configuration_description='¸ÜµÒ¤Î¥¢¥«¥¦¥ó¥ÈºîÀ®¤ÎºÝ¡¢¡ÖÀ¸Ç¯·îÆü¡×¤ÎÍó¤òÉ½¼¨¤¹¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£<br />Ãí°Õ: ÉÔÍ×¤Ê¾ì¹ç¤Ïfalse¤Ë¡¢É¬Í×¤Ê¾ì¹ç¤Ïtrue¤ò»ØÄê¤·¤Æ¤¯¤À¤µ¤¤¡£' WHERE configuration_key='ACCOUNT_DOB';
UPDATE configuration SET configuration_title='²ñ¼ÒÌ¾', configuration_description='¸ÜµÒ¤Î¥¢¥«¥¦¥ó¥ÈºîÀ®¤ÎºÝ¡¢¡Ö²ñ¼ÒÌ¾¡×¤òÉ½¼¨¤¹¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='ACCOUNT_COMPANY';
UPDATE configuration SET configuration_title='½»½ê2', configuration_description='¸ÜµÒ¤Î¥¢¥«¥¦¥ó¥ÈºîÀ®¤ÎºÝ¡¢¡Ö½»½ê2¡×¤òÉ½¼¨¤¹¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='ACCOUNT_SUBURB';
UPDATE configuration SET configuration_title='ÅÔÆ»ÉÜ¸©Ì¾', configuration_description='¸ÜµÒ¤Î¥¢¥«¥¦¥ó¥ÈºîÀ®¤ÎºÝ¡¢¡ÖÅÔÆ»ÉÜ¸©Ì¾¡×¤òÉ½¼¨¤¹¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='ACCOUNT_STATE';
UPDATE configuration SET configuration_title='ÅÔÆ»ÉÜ¸©Ì¾ - ¥É¥í¥Ã¥×¥À¥¦¥ó¤ÇÉ½¼¨', configuration_description='¡ÖÅÔÆ»ÉÜ¸©Ì¾¡×¤Ï¾ï¤Ë¥É¥í¥Ã¥×¥À¥¦¥ó·Á¼°¤ÇÉ½¼¨¤·¤Þ¤¹¤«?' WHERE configuration_key='ACCOUNT_STATE_DRAW_INITIAL_DROPDOWN';
UPDATE configuration SET configuration_title='¥¢¥«¥¦¥ó¥È¤Î¥Ç¥Õ¥©¥ë¥È¹ñÊÌID¤ÎºîÀ®', configuration_description='¥¢¥«¥¦¥ó¥È¤Î¥Ç¥Õ¥©¥ë¥È¹ñÊÌID¤òÀßÄê¤·¤Þ¤¹¡£<br />¥Ç¥Õ¥©¥ë¥È¤Ï223¤Ç¤¹¡£' WHERE configuration_key='SHOW_CREATE_ACCOUNT_DEFAULT_COUNTRY';
UPDATE configuration SET configuration_title='FaxÈÖ¹æ', configuration_description='¸ÜµÒ¤Î¥¢¥«¥¦¥ó¥ÈºîÀ®¤ÎºÝ¡¢¡ÖFaxÈÖ¹æ¡×¤òÉ½¼¨¤¹¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='ACCOUNT_FAX_NUMBER';
UPDATE configuration SET configuration_title='¥á¡¼¥ë¥Þ¥¬¥¸¥ó¤Î¥Á¥§¥Ã¥¯¥Ü¥Ã¥¯¥¹¤ÎÉ½¼¨', configuration_description='¥á¡¼¥ë¥Þ¥¬¥¸¥ó¤Î¥Á¥§¥Ã¥¯¥Ü¥Ã¥¯¥¹¤ÎÉ½¼¨ÀßÄê¤ò¤·¤Þ¤¹¡£<br />0= É½¼¨¥ª¥Õ<br />1= ¥Ü¥Ã¥¯¥¹É½¼¨¡¦¥Á¥§¥Ã¥¯¤Ê¤·¾õÂÖ<br />2= ¥Ü¥Ã¥¯¥¹É½¼¨¡¦¥Á¥§¥Ã¥¯¤¢¤ê¾õÂÖ<br />¡ÚÃí°Õ¡Û¥Ç¥Õ¥©¥ë¥È¤Ç¡Ö¥Á¥§¥Ã¥¯¤¢¤ê¡×¤Î¾õÂÖ¤Ë¤·¤Æ¤ª¤¯¤È¡¢³Æ¹ñ¤Î¥¹¥Ñ¥àµ¬À©Ë¡µ¬¤ËÄñ¿¨¤¹¤ë¶²¤ì¤¬¤¢¤ê¤Þ¤¹¡£' WHERE configuration_key='ACCOUNT_NEWSLETTER_STATUS';
UPDATE configuration SET configuration_title='¥Ç¥Õ¥©¥ë¥È¤Î¥á¡¼¥ë·Á¼°¤ÎÀßÄê', configuration_description='¸ÜµÒ¤Î¥Ç¥Õ¥©¥ë¥È¤Î¥á¡¼¥ë·Á¼°¤òÀßÄê¤·¤Þ¤¹¡£<br />0= ¥Æ¥­¥¹¥È·Á¼°<br />1= HTML·Á¼°' WHERE configuration_key='ACCOUNT_EMAIL_PREFERENCE';
UPDATE configuration SET configuration_title='¸ÜµÒ¤Ø¤Î¾¦ÉÊ¤ÎÄÌÃÎ - ¥¹¥Æ¡¼¥¿¥¹', configuration_description='¸ÜµÒ¤¬¥Á¥§¥Ã¥¯¥¢¥¦¥È¸å¤Ë¡¢¾¦ÉÊ¤ÎÄÌÃÎ(product notifications)¤Ë¤Ä¤¤¤Æ¿Ò¤Í¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />\r\n¡¦0= ¿Ò¤Í¤Ê¤¤<br />\r\n¡¦1= ¿Ò¤Í¤ë(¥µ¥¤¥ÈÁ´ÂÎ¤ËÂÐ¤·¤ÆÀßÄê¤µ¤ì¤Æ¤¤¤Ê¤¤¾ì¹ç)<br />\r\n¡ÚÃí°Õ¡Û¥µ¥¤¥É¥Ü¥Ã¥¯¥¹¤Ï¤³¤ÎÀßÄê¤È¤ÏÊÌ¤Ë¥ª¥Õ¤Ë¤¹¤ëÉ¬Í×¤¬¤¢¤ê¤Þ¤¹¡£' WHERE configuration_key='CUSTOMERS_PRODUCTS_NOTIFICATION_STATUS';
UPDATE configuration SET configuration_title='¾¦ÉÊ¡¦²Á³Ê¤Î±ÜÍ÷À©¸Â', configuration_description='¸ÜµÒ¤¬¥·¥ç¥Ã¥×Æâ¤Ç¾¦ÉÊ¤ä²Á³Ê¤ò±ÜÍ÷¤¹¤ë¤Î¤òÀ©¸Â¤¹¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£<br />0= Í×¥í¥°¥¤¥ó¤Ê¤É¤ÎÀ©¸Â¤Ê¤·<br />1= ¥Ö¥é¥¦¥¹¤Ë¤Ï¥í¥°¥¤¥ó¤¬É¬¿Ü<br />2= ¥í¥°¥¤¥ó¤Ê¤·¤Ç¥Ö¥é¥¦¥º²ÄÇ½¤À¤¬²Á³Ê¤ÏÈóÉ½¼¨<br />3= ¾¦ÉÊ±ÜÍ÷¤Î¤ß<br /><br />¡ÚÃí°Õ¡Û¥ª¥×¥·¥ç¥ó¡Ö2¡×¤Ï¡¢¥µ¡¼¥Á¥¨¥ó¥¸¥ó¤Î¥í¥Ü¥Ã¥È¤Ë¼ý½¸¤µ¤ì¤¿¤¯¤Ê¤¤¾ì¹ç¤ä¡¢¥í¥°¥¤¥óºÑ¤ß¤Î¸ÜµÒ¤Ë¤Î¤ß²Á³Ê¤ò³«¼¨¤·¤¿¤¤¾ì¹ç¤ËÍ­¸ú¤Ç¤¹¡£' WHERE configuration_key='CUSTOMERS_APPROVAL';
UPDATE configuration SET configuration_title='¸ÜµÒ¤Î¹ØÆþ¥ª¡¼¥½¥é¥¤¥º', configuration_description='¥·¥ç¥Ã¥×¤Ç¤Î¹ØÆþ¤ËºÝ¤·¤Æ¡¢¸ÜµÒ¤Ï¥·¥ç¥Ã¥×Â¦¤Ë¿³ºº¡¦µö²Ä¤µ¤ì¤ëÉ¬Í×¤¬¤¢¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£<br />0= ÉÔÍ×<br />1= ¾¦ÉÊ¤Î±ÜÍ÷¤Ë¤âµö²Ä¤¬É¬Í×<br />2= ¾¦ÉÊ¤Î±ÜÍ÷¤Ï¼«Í³¤À¤¬²Á³Ê¤Î±ÜÍ÷¤Ïµö²Ä¤µ¤ì¤¿¸ÜµÒ¤Î¤ß<br />¡ÚÃí°Õ¡Û¥ª¥×¥·¥ç¥ó¡Ö2¡×¤Ï¥µ¡¼¥Á¥¨¥ó¥¸¥ó¤Î¥í¥Ü¥Ã¥È½ü¤±¤ËÍÑ¤¤¤ë¤³¤È¤â¤Ç¤­¤Þ¤¹¡£' WHERE configuration_key='CUSTOMERS_APPROVAL_AUTHORIZATION';
UPDATE configuration SET configuration_title='¸ÜµÒ¤Î¥ª¡¼¥½¥é¥¤¥º(±ÜÍ÷À©¸Â) - ¥Õ¥¡¥¤¥ëÌ¾', configuration_description='¸ÜµÒ¤Î¥ª¡¼¥½¥é¥¤¥º(±ÜÍ÷À©¸Â)¤Ë»È¤¦¥Õ¥¡¥¤¥ëÌ¾¤òÀßÄê¤·¤Þ¤¹¡£³ÈÄ¥»Ò¤Ê¤·¤ÇÉ½µ­¤·¤Æ¤¯¤À¤µ¤¤¡£<br />¥Ç¥Õ¥©¥ë¥È¤Ï\r\n"customers_authorization"' WHERE configuration_key='CUSTOMERS_AUTHORIZATION_FILENAME';
UPDATE configuration SET configuration_title='¸ÜµÒ¤Î¥ª¡¼¥½¥é¥¤¥º(±ÜÍ÷À©¸Â) - ¥Ø¥Ã¥À¤ò±£¤¹', configuration_description='¸ÜµÒ¤Î¥ª¡¼¥½¥é¥¤¥º(±ÜÍ÷À©¸Â) ¤Ç¥Ø¥Ã¥À¤òÉ½¼¨¤¹¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />\r\n¡¦true=hide<br />\r\n¡¦false=show' WHERE configuration_key='CUSTOMERS_AUTHORIZATION_HEADER_OFF';
UPDATE configuration SET configuration_title='¸ÜµÒ¤Î¥ª¡¼¥½¥é¥¤¥º(±ÜÍ÷À©¸Â) - º¸¥«¥é¥à¤ò±£¤¹', configuration_description='¸ÜµÒ¤Î¥ª¡¼¥½¥é¥¤¥º(±ÜÍ÷À©¸Â) ¤Ç¡¢º¸¥«¥é¥à¤òÉ½¼¨¤¹¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />\r\n¡¦true=hide<br />\r\n¡¦false=show' WHERE configuration_key='CUSTOMERS_AUTHORIZATION_COLUMN_LEFT_OFF';
UPDATE configuration SET configuration_title='¸ÜµÒ¤Î¥ª¡¼¥½¥é¥¤¥º(±ÜÍ÷À©¸Â) - ±¦¥«¥é¥à¤ò±£¤¹', configuration_description='¸ÜµÒ¤Î¥ª¡¼¥½¥é¥¤¥º(±ÜÍ÷À©¸Â)¤Ç¡¢±¦¥«¥é¥à¤òÉ½¼¨¤¹¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />\r\n¡¦true=hide<br />\r\n¡¦false=show' WHERE configuration_key='CUSTOMERS_AUTHORIZATION_COLUMN_RIGHT_OFF';
UPDATE configuration SET configuration_title='¸ÜµÒ¤Î¥ª¡¼¥½¥é¥¤¥º(±ÜÍ÷À©¸Â) - ¥Õ¥Ã¥¿¤ò±£¤¹', configuration_description='¸ÜµÒ¤Î¥ª¡¼¥½¥é¥¤¥º(±ÜÍ÷À©¸Â) ¤Ç¡¢¥Õ¥Ã¥¿¤òÉ½¼¨¤¹¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />\r\n¡¦true=hide<br />\r\n¡¦false=show' WHERE configuration_key='CUSTOMERS_AUTHORIZATION_FOOTER_OFF';
UPDATE configuration SET configuration_title='¸ÜµÒ¤Î¥ª¡¼¥½¥é¥¤¥º(±ÜÍ÷À©¸Â) - ²Á³Ê¤ÎÈóÉ½¼¨', configuration_description='¸ÜµÒ¤Î¥ª¡¼¥½¥é¥¤¥º¤Ç¡¢²Á³Ê¤òÉ½¼¨¤¹¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />\r\n¡¦true=hide<br />\r\n¡¦false=show' WHERE configuration_key='CUSTOMERS_AUTHORIZATION_PRICES_OFF';
UPDATE configuration SET configuration_title='¸ÜµÒ¤Î¾Ò²ð(Customers Referral)¥¹¥Æ¡¼¥¿¥¹', configuration_description='¸ÜµÒ¤Î¾Ò²ð¥³¡¼¥É¤Ë¤Ä¤¤¤ÆÀßÄê¤·¤Þ¤¹¡£<br />0= Off<br />1= 1st Discount Coupon Code usedºÇ½é¤Î¥Ç¥£¥¹¥«¥¦¥ó¥È¥¯¡¼¥Ý¥ó¤ò»ÈÍÑºÑ¤ß<br />2= ¥¢¥«¥¦¥ó¥ÈºîÀ®¤ÎºÝ¡¢¸ÜµÒ¼«¿È¤¬ÄÉ²Ã¡¦ÊÔ½¸²ÄÇ½<br /><br />Ãí°Õ¡§¸ÜµÒ¤Î¾Ò²ð¥³¡¼¥É¤¬¥»¥Ã¥È¤µ¤ì¤ë¤È¡¢´ÉÍý²èÌÌ¤«¤é¤À¤±ÊÑ¹¹¤¹¤ë¤³¤È¤¬¤Ç¤­¤Þ¤¹¡£' WHERE configuration_key='CUSTOMERS_REFERRAL_STATUS';
UPDATE configuration SET configuration_title='¥¤¥ó¥¹¥È¡¼¥ëºÑ¤ß¤Î»ÙÊ§¤¤¥â¥¸¥å¡¼¥ë', configuration_description='¥¤¥ó¥¹¥È¡¼¥ë¤µ¤ì¤Æ¤¤¤ë»ÙÊ§¤¤¥â¥¸¥å¡¼¥ë¤Î¥Õ¥¡¥¤¥ëÌ¾¤Î¥ê¥¹¥È( ¥»¥ß¥³¥í¥ó(;)¶èÀÚ¤ê )¤Ç¤¹¡£¤³¤Î¾ðÊó¤Ï¼«Æ°Åª¤Ë¹¹¿·¤µ¤ì¤Þ¤¹¤Î¤ÇÊÔ½¸¤ÎÉ¬Í×¤Ï¤¢¤ê¤Þ¤»¤ó¡£' WHERE configuration_key='MODULE_PAYMENT_INSTALLED';
UPDATE configuration SET configuration_title='¥¤¥ó¥¹¥È¡¼¥ëºÑ¤ßÃíÊ¸¹ç·×¥â¥¸¥å¡¼¥ë', configuration_description='¥¤¥ó¥¹¥È¡¼¥ë¤µ¤ì¤Æ¤¤¤ëÃíÊ¸¹ç·×¥â¥¸¥å¡¼¥ë¤Î¥Õ¥¡¥¤¥ëÌ¾¤Î¥ê¥¹¥È(¥»¥ß¥³¥í¥ó(;)¶èÀÚ¤ê)¤Ç¤¹¡£\r\n<br /><br />\r\n¡ÚÃí°Õ¡Û¤³¤Î¾ðÊó¤Ï¼«Æ°Åª¤Ë¹¹¿·¤µ¤ì¤Þ¤¹¤Î¤ÇÊÔ½¸¤ÎÉ¬Í×¤Ï¤¢¤ê¤Þ¤»¤ó¡£' WHERE configuration_key='MODULE_ORDER_TOTAL_INSTALLED';
UPDATE configuration SET configuration_title='¥¤¥ó¥¹¥È¡¼¥ëºÑ¤ßÇÛÁ÷¥â¥¸¥å¡¼¥ë', configuration_description='¥¤¥ó¥¹¥È¡¼¥ë¤µ¤ì¤Æ¤¤¤ëÇÛÁ÷¥â¥¸¥å¡¼¥ë¤Î¥Õ¥¡¥¤¥ëÌ¾¤Î¥ê¥¹¥È(¥»¥ß¥³¥í¥ó(;)¶èÀÚ¤ê)¤Ç¤¹¡£¤³¤Î¾ðÊó¤Ï¼«Æ°Åª¤Ë¹¹¿·¤µ¤ì¤Þ¤¹¤Î¤ÇÊÔ½¸¤ÎÉ¬Í×¤Ï¤¢¤ê¤Þ¤»¤ó¡£' WHERE configuration_key='MODULE_SHIPPING_INSTALLED';
UPDATE configuration SET configuration_title='Âå¶â°ú´¹¥â¥¸¥å¡¼¥ë¤òÍ­¸ú¤Ë¤¹¤ë', configuration_description='Âå¶â°ú´¹¥â¥¸¥å¡¼¥ë¤òÍ­¸ú¤Ë¤¹¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='MODULE_PAYMENT_COD_STATUS';
UPDATE configuration SET configuration_title='»ÙÊ§¤¤ÃÏ°è', configuration_description='ÃÏ°è¤òÁªÂò¤·¤¿¾ì¹ç¡¢ÁªÂò¤µ¤ì¤¿ÃÏ°è¤ËÂÐ¤·¤Æ¤Î¤ß»ÙÊ§¤¤ÊýË¡¤¬Å¬ÍÑ¤µ¤ì¤Þ¤¹¡£' WHERE configuration_key='MODULE_PAYMENT_COD_ZONE';
UPDATE configuration SET configuration_title='É½¼¨¤ÎÀ°Îó½ç', configuration_description='É½¼¨¤ÎÀ°Îó½ç¤òÀßÄê¤·¤Þ¤¹¡£¿ô»ú¤¬¾®¤µ¤¤¤Û¤É¾å°Ì¤ËÉ½¼¨¤µ¤ì¤Þ¤¹¡£' WHERE configuration_key='MODULE_PAYMENT_COD_SORT_ORDER';
UPDATE configuration SET configuration_title='ÃíÊ¸¥¹¥Æ¡¼¥¿¥¹¤ÎÀßÄê', configuration_description='¤³¤Î»ÙÊ§¤¤ÊýË¡¤Î¾ì¹ç¤ÎÃíÊ¸¥¹¥Æ¡¼¥¿¥¹¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='MODULE_PAYMENT_COD_ORDER_STATUS_ID';
UPDATE configuration SET configuration_title='¥¯¥ì¥¸¥Ã¥È¥«¡¼¥É¥â¥¸¥å¡¼¥ë¤òÍ­¸ú¤Ë¤¹¤ë', configuration_description='¥¯¥ì¥¸¥Ã¥È¥«¡¼¥É¤Ë¤è¤ë»ÙÊ§¤¤¤òÍ­¸ú¤Ë¤¹¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='MODULE_PAYMENT_CC_STATUS';
UPDATE configuration SET configuration_title='¥¯¥ì¥¸¥Ã¥È¥«¡¼¥ÉÈÖ¹æ¤òÊ¬³ä¤¹¤ë', configuration_description='¥á¡¼¥ë¥¢¥É¥ì¥¹¤¬ÆþÎÏ¤µ¤ì¤¿¾ì¹ç¡¢¥¯¥ì¥¸¥Ã¥È¥«¡¼¥É¤ÎÃæ´Ö¤Î¿ô»ú¤ò¤½¤Î¥¢¥É¥ì¥¹¤ËÁ÷¿®¤·¡¢»Ä¤ê¤Î³°Â¦¤ÎÈÖ¹æ¤ò¥Ç¡¼¥¿¥Ù¡¼¥¹¤ËÊÝÂ¸¤·¤Þ¤¹¡£' WHERE configuration_key='MODULE_PAYMENT_CC_EMAIL';
UPDATE configuration SET configuration_title='CVVÈÖ¹æ¤òÊÝÂ¸¤¹¤ë', configuration_description='CVVÈÖ¹æ¤ò¼ý½¸/ÊÝÂ¸¤·¤Þ¤¹¤«? Ãí°Õ¡§Í­¸ú¤Ë¤¹¤ë¤È¡¢CVVÈÖ¹æ¤Ï¥¨¥ó¥³¡¼¥É¤µ¤ì¤¿¾õÂÖ¤Ç¥Ç¡¼¥¿¥Ù¡¼¥¹¤ËÊÝÂ¸¤µ¤ì¤Þ¤¹¡£' WHERE configuration_key='MODULE_PAYMENT_CC_COLLECT_CVV';
UPDATE configuration SET configuration_title='¥¯¥ì¥¸¥Ã¥È¥«¡¼¥É¥Ê¥ó¥Ð¡¼¤ò¼ý½¸¡¦ÊÝÂ¸¤¹¤ë', configuration_description='¥¯¥ì¥¸¥Ã¥È¥«¡¼¥ÉÈÖ¹æ¤ò¼ý½¸¡¦ÊÝÂ¸¤¹¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />\r\n¡ÚÃí°Õ¡Û¥¯¥ì¥¸¥Ã¥È¥«¡¼¥ÉÈÖ¹æ¤Ï°Å¹æ²½¤Ê¤·¤ËÊÝÂ¸¤µ¤ì¤Þ¤¹¡£¥»¥­¥å¥ê¥Æ¥£¾å¤ÎÌäÂê¤Ë½½Ê¬Ãí°Õ¤·¤Æ¤¯¤À¤µ¤¤¡£' WHERE configuration_key='MODULE_PAYMENT_CC_STORE_NUMBER';
UPDATE configuration SET configuration_title='É½¼¨¤ÎÀ°Îó½ç', configuration_description='É½¼¨¤ÎÀ°Îó½ç¤òÀßÄê¤·¤Þ¤¹. ¿ô»ú¤¬¾®¤µ¤¤¤Û¤É¾å°Ì¤ËÉ½¼¨¤µ¤ì¤Þ¤¹¡£' WHERE configuration_key='MODULE_PAYMENT_CC_SORT_ORDER';
UPDATE configuration SET configuration_title='»ÙÊ§¤¤ÃÏ°è', configuration_description='ÃÏ°è¤òÁªÂò¤·¤¿¾ì¹ç¡¢ÁªÂò¤µ¤ì¤¿ÃÏ°è¤Ë¤¿¤¤¤·¤Æ¤Î¤ß»ÙÊ§¤¤ÊýË¡¤¬Å¬ÍÑ¤µ¤ì¤Þ¤¹¡£' WHERE configuration_key='MODULE_PAYMENT_CC_ZONE';
UPDATE configuration SET configuration_title='ÃíÊ¸¥¹¥Æ¡¼¥¿¥¹', configuration_description='¤³¤Î»ÙÊ§¤¤ÊýË¡¤Î¾ì¹ç¤ÎÃíÊ¸¥¹¥Æ¡¼¥¿¥¹¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='MODULE_PAYMENT_CC_ORDER_STATUS_ID';
UPDATE configuration SET configuration_title='Äê³ÛÎÁ¶â', configuration_description='Äê³ÛÎÁ¶â¤Ë¤è¤ëÇÛÁ÷¤òÄó¶¡¤¹¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='MODULE_SHIPPING_FLAT_STATUS';
UPDATE configuration SET configuration_title='ÇÛÁ÷ÎÁ¶â', configuration_description='¤¹¤Ù¤Æ¤ÎÃíÊ¸¤ËÂÐ¤·¤ÆÅ¬ÍÑ¤µ¤ì¤ëÇÛÁ÷ÎÁ¶â¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='MODULE_SHIPPING_FLAT_COST';
UPDATE configuration SET configuration_title='ÀÇ¼ïÊÌ', configuration_description='Äê³ÛÎÁ¶â¤ËÅ¬ÍÑ¤µ¤ì¤ëÀÇ¼ïÊÌ¤òÁªÂò¤·¤Þ¤¹¡£' WHERE configuration_key='MODULE_SHIPPING_FLAT_TAX_CLASS';
UPDATE configuration SET configuration_title='ÀÇÎ¨¤Î·×»»¥Ù¡¼¥¹', configuration_description='ÇÛÁ÷ÎÁ¤Ë¤«¤«¤ëÀÇ¶â¥ª¥×¥·¥ç¥ó¤ÎÀßÄê¤·¤Þ¤¹¡£<br /><br />\r\n¡¦Shipping - ¸ÜµÒ¤ÎÁ÷ÉÕÀè½»½ê¤Ë´ð¤Å¤¯<br />\r\n¡¦Billing - ¸ÜµÒ¤ÎÀÁµáÀè½»½ê¤Ë´ð¤Å¤¯<br />\r\n¡¦Store - ¥·¥ç¥Ã¥×¤Î½êºß½»½ê¤Ë´ð¤Å¤¯(Á÷ÉÕÀè/ÀÁµáÀè¤¬¥·¥ç¥Ã¥×½êºßÃÏ¤ÈÆ±¤¸ÃÏ°è¤Î¾ì¹ç¤ËÍ­¸ú)' WHERE configuration_key='MODULE_SHIPPING_FLAT_TAX_BASIS';
UPDATE configuration SET configuration_title='ÇÛÁ÷ÃÏ°è', configuration_description='ÇÛÁ÷ÃÏ°è¤òÁªÂò¤¹¤ë¤ÈÁªÂò¤µ¤ì¤¿ÃÏ°è¤Î¤ß¤ÇÍøÍÑ²ÄÇ½¤Ë¤Ê¤ê¤Þ¤¹¡£' WHERE configuration_key='MODULE_SHIPPING_FLAT_ZONE';
UPDATE configuration SET configuration_title='É½¼¨¤ÎÀ°Îó½ç', configuration_description='É½¼¨¤ÎÀ°Îó½ç¤òÀßÄê¤Ç¤­¤Þ¤¹¡£¿ô»ú¤¬¾®¤µ¤¤¤Û¤É¾å°Ì¤ËÉ½¼¨¤µ¤ì¤Þ¤¹¡£' WHERE configuration_key='MODULE_SHIPPING_FLAT_SORT_ORDER';
UPDATE configuration SET configuration_title='¥Ç¥Õ¥©¥ë¥È¤ÎÄÌ²ß', configuration_description='¥Ç¥Õ¥©¥ë¥È¤ÎÄÌ²ß¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='DEFAULT_CURRENCY';
UPDATE configuration SET configuration_title='¥Ç¥Õ¥©¥ë¥È¤Î¸À¸ì', configuration_description='¥Ç¥Õ¥©¥ë¥È¤Î¸À¸ì¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='DEFAULT_LANGUAGE';
UPDATE configuration SET configuration_title='¿·µ¬ÃíÊ¸¤Î¥Ç¥Õ¥©¥ë¥È¥¹¥Æ¡¼¥¿¥¹', configuration_description='¿·µ¬¤ÎÃíÊ¸¤ò¼õ¤±ÉÕ¤±¤¿¤È¤­¤Î¥Ç¥Õ¥©¥ë¥È¥¹¥Æ¡¼¥¿¥¹¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='DEFAULT_ORDERS_STATUS_ID';
UPDATE configuration SET configuration_title='´ÉÍý²èÌÌ¤ÇÀßÄê¥­¡¼(configuration_key)¤òÉ½¼¨', configuration_description='´ÉÍý²èÌÌ¤ÇÀßÄê¥­¡¼(configuration_key)¤òÉ½¼¨¤·¤Þ¤¹¤«?<br />\r\nÉ½¼¨¤·¤¿¤¤¾ì¹ç¤Ï1¤ËÀßÄê¤·¤Æ¤¯¤À¤µ¤¤¡£' WHERE configuration_key='ADMIN_configuration_key_ON';
UPDATE configuration SET configuration_title='½Ð²Ù¹ñÌ¾', configuration_description='ÇÛÁ÷ÎÁ¤Î·×»»¤ËÍøÍÑ¤¹¤ë¤¿¤á¤Î¹ñÌ¾¤òÁªÂò¤·¤Þ¤¹¡£' WHERE configuration_key='SHIPPING_ORIGIN_COUNTRY';
UPDATE configuration SET configuration_title='¥·¥ç¥Ã¥×¤ÎÍ¹ÊØÈÖ¹æ', configuration_description='¥·¥ç¥Ã¥×¤ÎÍ¹ÊØÈÖ¹æ¤òÆþÎÏ¤·¤Þ¤¹¡£' WHERE configuration_key='SHIPPING_ORIGIN_ZIP';
UPDATE configuration SET configuration_title='°ì²ó¤ÎÇÛÁ÷¤ÇÇÛÁ÷²ÄÇ½¤ÊºÇÂç½ÅÎÌ(kg)', configuration_description='°ì²ó¤ÎÇÛÁ÷¤Ç²ÄÇ½¤Ê½ÅÎÌ(kg)¤ÎºÇÂçÃÍ¤òÀßÄê¤·¤Þ¤¹¡£Îã¤¨¤Ð10kg¤ËÀßÄê¤·¤¿¾õÂÖ¤Ç¥«¡¼¥È¤Ë30kg¤Î¾¦ÉÊ¤¬¤¢¤Ã¤¿¾ì¹ç¡¢10kg ¡ß 3²ó¤ÎÇÛÁ÷¤È¤¤¤¦·Á¤Ç½èÍý¤µ¤ì¤Þ¤¹¡£' WHERE configuration_key='SHIPPING_MAX_WEIGHT';
UPDATE configuration SET configuration_title='¾®¡¦Ãæ¥Ñ¥Ã¥±¡¼¥¸¤ÎÉ÷ÂÞ - ÈæÎ¨¡¦½ÅÎÌ', configuration_description='Åµ·¿Åª¤Ê¾®¡¦Ãæ¥Ñ¥Ã¥±¡¼¥¸¤ÎÉ÷ÂÞ(¤Õ¤¦¤¿¤¤¡§Âç¤­¤µ¤È½ÅÎÌ)¤òÀßÄê¤·¤Þ¤¹¡£<br />\r\nÎã¡§10% + 1lb 10:1<br />\r\n10% + 0lbs 10:0<br />\r\n0% + 5lbs 0:5<br />\r\n0% + 0lbs 0:0' WHERE configuration_key='SHIPPING_BOX_WEIGHT';
UPDATE configuration SET configuration_title='Âç·¿¥Ñ¥Ã¥±¡¼¥¸¤ÎÉ÷ÂÞ - Âç¤­¤µ¡¦½ÅÎÌ', configuration_description='Âç¤­¤Ê¥Ñ¥Ã¥±¡¼¥¸¤ÎÉ÷ÂÞÉ÷ÂÞ(¤Õ¤¦¤¿¤¤¡§Âç¤­¤µ¤È½ÅÎÌ)¤òÀßÄê¤·¤Þ¤¹¡£<br />\r\nÎã¡§10% + 1lb 10:1<br />\r\n10% + 0lbs 10:0<br />\r\n0% + 5lbs 0:5<br />\r\n0% + 0lbs 0:0' WHERE configuration_key='SHIPPING_BOX_PADDING';
UPDATE configuration SET configuration_title='¸Ä¿ô¤È½ÅÎÌ¤ÎÉ½¼¨', configuration_description='ÇÛÁ÷¤¹¤ë²ÙÊª¤Î¸Ä¿ô¤È½ÅÎÌ¤òÉ½¼¨¤¹¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />\r\n¡¦0= off<br />\r\n¡¦1= ¸Ä¿ô¤Î¤ßÉ½¼¨<br />\r\n¡¦2= ½ÅÎÌ¤Î¤ßÉ½¼¨<br />\r\n¡¦3= Î¾ÊýÉ½¼¨' WHERE configuration_key='SHIPPING_BOX_WEIGHT_DISPLAY';
UPDATE configuration SET configuration_title='Á÷ÎÁ³µ»»É½¼¨¤ÎÉ½¼¨¡¦ÈóÉ½¼¨', configuration_description='Á÷ÎÁ³µ»»¥Ü¥¿¥ó¤ÎÉ½¼¨¤¹¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£<br />\r\n¡¦0= Off<br />\r\n¡¦1= ¥·¥ç¥Ã¥Ô¥ó¥°¥«¡¼¥È¾å¤Ë¥Ü¥¿¥ó¤È¤·¤ÆÉ½¼¨' WHERE configuration_key='SHOW_SHIPPING_ESTIMATOR_BUTTON';
UPDATE configuration SET configuration_title='ÃíÊ¸¤Î½ÅÎÌ¤¬0¤Ê¤éÁ÷ÎÁÌµÎÁ¤Ë', configuration_description='ÃíÊ¸¤Î½ÅÎÌ¤¬0¤Î¾ì¹ç¡¢Á÷ÎÁÌµÎÁ¤Ë¤·¤Þ¤¹¤«?\r\n<br />\r\n¡¦0= ¤¤¤¤¤¨<br />\r\n¡¦1= ¤Ï¤¤<br />\r\nÃí°Õ¡§¡ÖÁ÷ÎÁÌµÎÁ¡×É½µ­¤ò¤·¤¿¤¤¾ì¹ç¤Ë¤ÏÁ÷ÎÁÌµÎÁ¥â¥¸¥å¡¼¥ë¤ò»È¤¦¤³¤È¤ò¤ª´«¤á¤·¤Þ¤¹¡£¤³¤Î¥ª¥×¥·¥ç¥ó¤Ï¼ÂºÝ¤ËÁ÷ÎÁÌµÎÁ¤Î¤È¤­¤ËÉ½¼¨¤µ¤ì¤ë¤À¤±¤Ç¤¹¡£' WHERE configuration_key='ORDER_WEIGHT_ZERO_STATUS';
UPDATE configuration SET configuration_title='¾¦ÉÊ¥¤¥á¡¼¥¸¤ÎÉ½¼¨', configuration_description='¾¦ÉÊ°ìÍ÷Ãæ¤Î¾¦ÉÊ²èÁü¤ÎÉ½¼¨¡¦ÈóÉ½¼¨/¥½¡¼¥È½ç¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />\r\n¡¦¿ôÃÍ¤¬¾®¤µ¤¤¤Û¤ÉÀè¤ËÉ½¼¨<br />\r\n¡¦0 = ÈóÉ½¼¨' WHERE configuration_key='PRODUCT_LIST_IMAGE';
UPDATE configuration SET configuration_title='¾¦ÉÊ¥á¡¼¥«¡¼¤ÎÉ½¼¨', configuration_description='¾¦ÉÊ¤Î¥á¡¼¥«¡¼Ì¾¤òÉ½¼¨¤¹¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />\r\n¡¦¿ôÃÍ¤¬¾®¤µ¤¤¤Û¤ÉÀè¤ËÉ½¼¨<br />\r\n¡¦0 = ÈóÉ½¼¨' WHERE configuration_key='PRODUCT_LIST_MANUFACTURER';
UPDATE configuration SET configuration_title='¾¦ÉÊ·¿ÈÖ¤ÎÉ½¼¨', configuration_description='¾¦ÉÊ°ìÍ÷Ãæ¤Î¾¦ÉÊ·¿ÈÖ¤ÎÉ½¼¨¡¦ÈóÉ½¼¨/¥½¡¼¥È½ç¤òÀßÄê¤·¤Þ¤¹¡£¿ôÃÍ¤¬¾®¤µ¤¤¤Û¤ÉÀè¤ËÉ½¼¨¤µ¤ì¤Þ¤¹¡£(0 = ÈóÉ½¼¨)' WHERE configuration_key='PRODUCT_LIST_MODEL';
UPDATE configuration SET configuration_title='¾¦ÉÊÌ¾', configuration_description='¾¦ÉÊ°ìÍ÷Ãæ¤Î¾¦ÉÊÌ¾¤ÎÉ½¼¨¡¦ÈóÉ½¼¨/¥½¡¼¥È½ç¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />\r\n¡¦¿ôÃÍ¤¬¾®¤µ¤¤¤Û¤ÉÀè¤ËÉ½¼¨<br />\r\n¡¦0 = ÈóÉ½¼¨' WHERE configuration_key='PRODUCT_LIST_NAME';
UPDATE configuration SET configuration_title='¾¦ÉÊ²Á³Ê¡¦¡Ö¥«¡¼¥È¤ËÆþ¤ì¤ë¡×¤òÉ½¼¨', configuration_description='¾¦ÉÊ²Á³Ê¡¦¡Ö¥«¡¼¥È¤ËÆþ¤ì¤ë¡×¥Ü¥¿¥ó¤òÉ½¼¨¤¹¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£<br />\r\n<br />\r\n¡¦¿ôÃÍ¤¬¾®¤µ¤¤¤Û¤ÉÀè¤ËÉ½¼¨<br />\r\n¡¦0 = ÈóÉ½¼¨' WHERE configuration_key='PRODUCT_LIST_PRICE';
UPDATE configuration SET configuration_title='¾¦ÉÊ¿ôÎÌ¤ÎÉ½¼¨', configuration_description='¾¦ÉÊ°ìÍ÷Ãæ¤Î¾¦ÉÊ¿ôÎÌ¤ÎÉ½¼¨¡¦ÈóÉ½¼¨/¥½¡¼¥È½ç¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />\r\n¡¦¿ôÃÍ¤¬¾®¤µ¤¤¤Û¤ÉÀè¤ËÉ½¼¨<br />\r\n¡¦0 = ÈóÉ½¼¨' WHERE configuration_key='PRODUCT_LIST_QUANTITY';
UPDATE configuration SET configuration_title='¾¦ÉÊ½ÅÎÌ¤ÎÉ½¼¨', configuration_description='¾¦ÉÊ°ìÍ÷Ãæ¤Î¾¦ÉÊ½ÅÎÌ¤ÎÉ½¼¨¡¦ÈóÉ½¼¨/¥½¡¼¥È½ç¤òÀßÄê¤·¤Þ¤¹¡£¿ôÃÍ¤¬¾®¤µ¤¤¤Û¤ÉÀè¤ËÉ½¼¨¤µ¤ì¤Þ¤¹¡£(0 = ÈóÉ½¼¨)' WHERE configuration_key='PRODUCT_LIST_WEIGHT';
UPDATE configuration SET configuration_title='¾¦ÉÊ²Á³Ê¡¦¡Ö¥«¡¼¥È¤ËÆþ¤ì¤ë¡×¥«¥é¥à¤ÎÉý', configuration_description='¾¦ÉÊ²Á³Ê¡¦¡Ö¥«¡¼¥È¤ËÆþ¤ì¤ë¡×¥Ü¥¿¥ó¤òÉ½¼¨¤¹¤ë¥«¥é¥à¤ÎÉý(¥Ô¥¯¥»¥ë¿ô)¤òÀßÄê¤·¤Þ¤¹¡£<br />\r\n¡¦Default= 125' WHERE configuration_key='PRODUCTS_LIST_PRICE_WIDTH';
UPDATE configuration SET configuration_title='¥«¥Æ¥´¥ê/¥á¡¼¥«¡¼¤Î¹Ê¤ê¹þ¤ß¤ÎÉ½¼¨', configuration_description='¥«¥Æ¥´¥ê°ìÍ÷¥Ú¡¼¥¸¤Ç [¹Ê¤ê¹þ¤ß] ¤òÉ½¼¨¤¹¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£<br />\r\n¡¦0=ÈóÉ½¼¨<br />\r\n¡¦1=É½¼¨' WHERE configuration_key='PRODUCT_LIST_FILTER';
UPDATE configuration SET configuration_title='[Á°¥Ú¡¼¥¸] [¼¡¥Ú¡¼¥¸] ¤ÎÉ½¼¨°ÌÃÖ', configuration_description='[Á°¥Ú¡¼¥¸] [¼¡¥Ú¡¼¥¸] ¤ÎÉ½¼¨°ÌÃÖ¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />\r\n¡¦1 = ¾å<br />\r\n¡¦2 = ²¼<br />\r\n¡¦3 = Î¾Êý' WHERE configuration_key='PREV_NEXT_BAR_LOCATION';
UPDATE configuration SET configuration_title='¾¦ÉÊ¥ê¥¹¥È¤Î¥Ç¥Õ¥©¥ë¥È¥½¡¼¥È½ç', configuration_description='¾¦ÉÊ¥ê¥¹¥È¤Î¥Ç¥Õ¥©¥ë¥È¤Î¥½¡¼¥È½ç¤òÀßÄê¤·¤Þ¤¹¡£\r\n<br />\r\nÃí°Õ¡§¾¦ÉÊ¤Ç¥½¡¼¥È¤¹¤ë¾ì¹ç¤Ï¶õÍó¤Ë¡£\r\nSort the Product Listing in the order you wish for the default display to start in to get the sort order setting. Example: 2a' WHERE configuration_key='PRODUCT_LISTING_DEFAULT_SORT_ORDER';
UPDATE configuration SET configuration_title='¡Ö¥«¡¼¥È¤ËÆþ¤ì¤ë¡×¥Ü¥¿¥ó¤ÎÉ½¼¨', configuration_description='¡Ö¥«¡¼¥È¤ËÆþ¤ì¤ë¡×¥Ü¥¿¥ó¤òÉ½¼¨¤¹¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />\r\n¡¦0= off<br />\r\n¡¦1= on' WHERE configuration_key='PRODUCT_LIST_PRICE_BUY_NOW';
UPDATE configuration SET configuration_title='Ê£¿ô¾¦ÉÊ¤Î¿ôÎÌÍó¤ÎÍ­Ìµ¡¦É½¼¨°ÌÃÖ', configuration_description='Ê£¿ô¾¦ÉÊ¤ò¥«¡¼¥È¤ËÆþ¤ì¤ë¿ôÎÌÍó¤ÎÉ½¼¨¤¹¤ë¤«¤É¤¦¤«¤È¡¢É½¼¨°ÌÃÖ¤òÀßÄê¤·¤Þ¤¹¡£<br />0= off<br />1= ¾åÉô<br />2= ²¼Éô<br />3= Î¾Êý' WHERE configuration_key='PRODUCT_LISTING_MULTIPLE_ADD_TO_CART';
UPDATE configuration SET configuration_title='¾¦ÉÊÀâÌÀ¤ÎÉ½¼¨', configuration_description='¾¦ÉÊÀâÌÀ¤òÉ½¼¨¤¹¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />0= OFF<br />150= ¿ä¾©¤¹¤ëÄ¹¤µ¡£¤Þ¤¿¤Ï¼«Í³¤ËÉ½¼¨¤¹¤ë¾¦ÉÊÀâÌÀ¤ÎºÇÂçÊ¸»ú¿ô¤òÀßÄê¤·¤Æ¤¯¤À¤µ¤¤¡£' WHERE configuration_key='PRODUCT_LIST_DESCRIPTION';
UPDATE configuration SET configuration_title='¾¦ÉÊ¥ê¥¹¥È¤Î¾º½ç¤òÉ½¼¨¤¹¤ëµ­¹æ', configuration_description='¾¦ÉÊ¥ê¥¹¥È¤Î¾º½ç¤ò¼¨¤¹µ­¹æ¤Ï?<br />¥Ç¥Õ¥©¥ë¥È = +' WHERE configuration_key='PRODUCT_LIST_SORT_ORDER_ASCENDING';
UPDATE configuration SET configuration_title='¾¦ÉÊ¥ê¥¹¥È¤Î¹ß½ç¤òÉ½¼¨¤¹¤ëµ­¹æ', configuration_description='¾¦ÉÊ¥ê¥¹¥È¤Î¹ß½ç¤ò¼¨¤¹µ­¹æ¤Ï?<br />¥Ç¥Õ¥©¥ë¥È = -' WHERE configuration_key='PRODUCT_LIST_SORT_ORDER_DESCENDING';
UPDATE configuration SET configuration_title='ºß¸Ë¿å½à¤Î¥Á¥§¥Ã¥¯', configuration_description='½½Ê¬¤Êºß¸Ë¤¬¤¢¤ë¤«¥Á¥§¥Ã¥¯¤¹¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='STOCK_CHECK';
UPDATE configuration SET configuration_title='ºß¸Ë¿ô¤«¤é¥Þ¥¤¥Ê¥¹', configuration_description='¼õÃí»þÅÀ¤Ç³Æºß¸Ë¿ô¤«¤éÃíÊ¸¿ô¤ò¥Þ¥¤¥Ê¥¹¤·¤Þ¤¹¤«?' WHERE configuration_key='STOCK_LIMITED';
UPDATE configuration SET configuration_title='¥Á¥§¥Ã¥¯¥¢¥¦¥È¤òµö²Ä', configuration_description='ºß¸Ë¤¬ÉÔÂ­¤·¤Æ¤¤¤ë¾ì¹ç¤Ë¥Á¥§¥Ã¥¯¥¢¥¦¥È¤òµö²Ä¤·¤Þ¤¹¤«?' WHERE configuration_key='STOCK_ALLOW_CHECKOUT';
UPDATE configuration SET configuration_title='ºß¸ËÀÚ¤ì¾¦ÉÊ¤Î¥µ¥¤¥ó', configuration_description='ÃíÊ¸»þÅÀ¤Ç¾¦ÉÊ¤¬ºß¸ËÀÚ¤ì¤Î¾ì¹ç¤Ë¸ÜµÒ¤ØÉ½¼¨¤¹¤ë¥µ¥¤¥ó¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='STOCK_MARK_PRODUCT_OUT_OF_STOCK';
UPDATE configuration SET configuration_title='ºß¸Ë¤ÎºÆÃíÊ¸¿å½à', configuration_description='ºß¸Ë¤ÎºÆÃíÊ¸¤¬É¬Í×¤Ë¤Ê¤ë¾¦ÉÊ¿ô¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='STOCK_REORDER_LEVEL';
UPDATE configuration SET configuration_title='ºß¸ËÀÚ¤ì¾¦ÉÊ¤Î¥¹¥Æ¡¼¥¿¥¹ÊÑ¹¹', configuration_description='¾¦ÉÊ¤Îºß¸Ë¤¬¤Ê¤¤¾ì¹ç¤Î¥¹¥Æ¡¼¥¿¥¹É½¼¨¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />0= ¾¦ÉÊ¥¹¥Æ¡¼¥¿¥¹¤òOFF¤Ë<br />1= ¾¦ÉÊ¥¹¥Æ¡¼¥¿¥¹¤ÏON¤Î¤Þ¤Þ' WHERE configuration_key='SHOW_PRODUCTS_SOLD_OUT';
UPDATE configuration SET configuration_title='ºß¸ËÀÚ¤ì¾¦ÉÊ¤Ë¡ÖÇä¤êÀÚ¤ì¡×²èÁüÉ½¼¨', configuration_description='ºß¸Ë¤¬¤Ê¤¯¤Ê¤Ã¤¿¾¦ÉÊ¤Î¾ì¹ç¤Ë¡Ö¥«¡¼¥È¤ØÆþ¤ì¤ë¡×¥Ü¥¿¥ó¤ÎÂå¤ï¤ê¤Ë¡ÖÇä¤êÀÚ¤ì¡×²èÁü¤òÉ½¼¨¤·¤Þ¤¹¤«?<br /><br />\r\n¡¦0= É½¼¨¤·¤Ê¤¤<br />\r\n¡¦1= É½¼¨¤¹¤ë' WHERE configuration_key='SHOW_PRODUCTS_SOLD_OUT_IMAGE';
UPDATE configuration SET configuration_title='¾¦ÉÊ¿ôÎÌ¤Ë»ØÄê¤Ç¤­¤ë¾®¿ôÅÀ¤Î·å¿ô', configuration_description='¾¦ÉÊ¤Î¿ôÎÌ¤Ë¾®¿ôÅÀ¤ÎÍøÍÑ¤òµö²Ä¤¹¤ë·å¿ô¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />\r\n¡¦0= off' WHERE configuration_key='QUANTITY_DECIMALS';
UPDATE configuration SET configuration_title='¥·¥ç¥Ã¥Ô¥ó¥°¥«¡¼¥È - ¡Öºï½ü¡×¥Á¥§¥Ã¥¯¥Ü¥Ã¥¯¥¹/¥Ü¥¿¥ó', configuration_description='¡Öºï½ü¡×¥Á¥§¥Ã¥¯¥Ü¥Ã¥¯¥¹/¥Ü¥¿¥ó¤ÎÉ½¼¨¤Ë¤Ä¤¤¤ÆÀßÄê¤·¤Þ¤¹¡£<br /><br />1= ¥Ü¥¿¥ó¤Î¤ß<br />2= ¥Á¥§¥Ã¥¯¥Ü¥Ã¥¯¥¹¤Î¤ß<br />3= ¥Ü¥¿¥ó/¥Á¥§¥Ã¥¯¥Ü¥Ã¥¯¥¹Î¾Êý' WHERE configuration_key='SHOW_SHOPPING_CART_DELETE';
UPDATE configuration SET configuration_title='¥·¥ç¥Ã¥Ô¥ó¥°¥«¡¼¥È -¡Ö¥«¡¼¥È¤ÎÃæ¿È¤ò¹¹¿·¡×¥Ü¥¿¥ó¤Î°ÌÃÖ', configuration_description='¡Ö¥«¡¼¥È¤ÎÃæ¿È¤ò¹¹¿·¡×¥Ü¥¿¥ó¤Î°ÌÃÖ¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />1=¡ÖÃíÊ¸¿ô¡×Íó¤Î²£<br />2= ¾¦ÉÊ¥ê¥¹¥È¤Î²¼<br />3=¡ÖÃíÊ¸¿ô¡×Íó¤Î²£¤È¾¦ÉÊ¥ê¥¹¥È¤Î²¼<br /><br />Ãí°Õ¡§¤³¤ÎÀßÄê¤Ï3¤Ä¤Î"tpl_shopping_cart_default"¥Õ¥¡¥¤¥ë¤¬¸Æ¤Ð¤ì¤ëÉôÊ¬¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='SHOW_SHOPPING_CART_UPDATE';
UPDATE configuration SET configuration_title='¥Ú¡¼¥¸¤Î¥Ñ¡¼¥¹¤ËÍ×¤·¤¿»þ´Ö¤ò¥í¥°¤Ëµ­Ï¿¤¹¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£', configuration_description='¥Ú¡¼¥¸¤Î¥Ñ¡¼¥¹¤ËÍ×¤·¤¿»þ´Ö¤ò¥í¥°¤Ëµ­Ï¿¤¹¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='STORE_PAGE_PARSE_TIME';
UPDATE configuration SET configuration_title='¥Ú¡¼¥¸¤Î¥Ñ¡¼¥¹¥í¥°¤òÊÝÂ¸¤¹¤ë¥Ç¥£¥ì¥¯¥È¥ê¤È¥Õ¥¡¥¤¥ëÌ¾¤òÀßÄê¤·¤Þ¤¹¡£', configuration_description='¥Ú¡¼¥¸¤Î¥Ñ¡¼¥¹¥í¥°¤òÊÝÂ¸¤¹¤ë¥Ç¥£¥ì¥¯¥È¥ê¤È¥Õ¥¡¥¤¥ëÌ¾¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='STORE_PAGE_PARSE_TIME_LOG';
UPDATE configuration SET configuration_title='¥í¥°¤Ëµ­Ï¿¤¹¤ëÆüÉÕ·Á¼°¤òÀßÄê¤·¤Þ¤¹¡£', configuration_description='¥í¥°¤Ëµ­Ï¿¤¹¤ëÆüÉÕ·Á¼°¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='STORE_PARSE_DATE_TIME_FORMAT';
UPDATE configuration SET configuration_title='³Æ¥Ú¡¼¥¸¤Î²¼¤Ë¥Ñ¡¼¥¹»þ´Ö¤òÉ½¼¨¤¹¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£<br />¡Ö¥Ú¡¼¥¸¤Î¥Ñ¡¼¥¹»þ´Ö¤òµ­Ï¿¡×¤ò true ¤Ë¤·¤Æ¤ª¤¯É¬Í×¤Ï¤¢¤ê¤Þ¤»¤ó¡£', configuration_description='³Æ¥Ú¡¼¥¸¤Î²¼¤Ë¥Ñ¡¼¥¹»þ´Ö¤òÉ½¼¨¤¹¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£<br />¡Ö¥Ú¡¼¥¸¤Î¥Ñ¡¼¥¹»þ´Ö¤òµ­Ï¿¡×¤ò true ¤Ë¤·¤Æ¤ª¤¯É¬Í×¤Ï¤¢¤ê¤Þ¤»¤ó¡£' WHERE configuration_key='DISPLAY_PAGE_PARSE_TIME';
UPDATE configuration SET configuration_title='¥í¥°¤Ë¥Ç¡¼¥¿¥Ù¡¼¥¹¥¯¥¨¥ê¡¼¤òµ­Ï¿¤·¤Æ¤ª¤¯¤«¤É¤¦¤«ÀßÄê¤·¤Þ¤¹¡£(PHP4¤Î¾ì¹ç¤Î¤ß)', configuration_description='¥í¥°¤Ë¥Ç¡¼¥¿¥Ù¡¼¥¹¥¯¥¨¥ê¡¼¤òµ­Ï¿¤·¤Æ¤ª¤¯¤«¤É¤¦¤«ÀßÄê¤·¤Þ¤¹¡£(PHP4¤Î¾ì¹ç¤Î¤ß)' WHERE configuration_key='STORE_DB_TRANSACTIONS';
UPDATE configuration SET configuration_title='¥á¡¼¥ëÁ÷¿® - ÀÜÂ³ÊýË¡', configuration_description='¥á¡¼¥ëÁ÷¿®¤Ësendmail¤Ø¤Î¥í¡¼¥«¥ëÀÜÂ³¤ò»ÈÍÑ¤¹¤ë¤«TCP/IP·ÐÍ³¤ÎSMTPÀÜÂ³¤ò»ÈÍÑ¤¹¤ë¤«¤òÀßÄê¤·¤Þ¤¹¡£¥µ¡¼¥Ð¤ÎOS¤¬Windows¤äMacOS¤Î¾ì¹ç¤ÏSMTP¤ËÀßÄê¤·¤Æ¤¯¤À¤µ¤¤¡£<br /><br />SMTPAUTH¤Ï¡¢¥µ¡¼¥Ð¡¼¤¬¥á¡¼¥ëÁ÷¿®¤ÎºÝ¤ËSMTP authorization¤òµá¤á¤ë¾ì¹ç¤Ë¤Î¤ß»È¤Ã¤Æ¤¯¤À¤µ¤¤¡£¤½¤Î¾ì¹ç¡¢´ÉÍý²èÌÌ¤ÇSMTPAUTHÀßÄê¤ò¹Ô¤¦É¬Í×¤¬¤¢¤ê¤Þ¤¹¡£<br /><br />"Sendmail -f"¤Ï¡¢-f¥Ñ¥é¥á¡¼¥¿¤¬É¬Í×¤Ê¥µ¡¼¥Ð¸þ¤±¤ÎÀßÄê¤Ç¡¢¥¹¥×¡¼¥Õ¥£¥ó¥°¤òËÉ¤°¤¿¤á¤ËÍÑ¤¤¤é¤ì¤ë¤³¤È¤¬Â¿¤¤¥»¥­¥å¥ê¥Æ¥£¾å¤ÎÀßÄê¤Ç¤¹¡£¥á¡¼¥ë¥µ¡¼¥Ð¡¼¤Î¥Û¥¹¥ÈÂ¦¤Ç»ÈÍÑ²ÄÇ½¤ÊÀßÄê¤Ë¤Ê¤Ã¤Æ¤¤¤Ê¤¤¾ì¹ç¡¢¥¨¥é¡¼¤Ë¤Ê¤ë¤³¤È¤¬¤¢¤ê¤Þ¤¹¡£' WHERE configuration_key='EMAIL_TRANSPORT';
UPDATE configuration SET configuration_title='SMTPÇ§¾Ú - ¥á¡¼¥ë¥¢¥«¥¦¥ó¥È', configuration_description='¤¢¤Ê¤¿¤Î¥Û¥¹¥Æ¥£¥ó¥°¥µ¡¼¥Ó¥¹¤¬Äó¶¡¤·¤Æ¤¤¤ë¥á¡¼¥ë¥¢¥«¥¦¥ó¥È(Îã¡§me@mydomain.com)¤òÆþÎÏ¤·¤Æ¤¯¤À¤µ¤¤¡£¤³¤ì¤ÏSMTPÇ§¾Ú¤ËÉ¬Í×¤Ê¾ðÊó¤Ç¤¹¡£<br />¥á¡¼¥ë¤ËSMTPÇ§¾Ú¤ò»È¤Ã¤Æ¤¤¤ë¾ì¹ç¤Ë¤Î¤ßÉ¬Í×¤Ç¤¹¡£' WHERE configuration_key='EMAIL_SMTPAUTH_MAILBOX';
UPDATE configuration SET configuration_title='SMTPÇ§¾Ú - ¥Ñ¥¹¥ï¡¼¥É', configuration_description='SMTP¥á¡¼¥ë¥Ü¥Ã¥¯¥¹¤Î¥Ñ¥¹¥ï¡¼¥É¤òÆþÎÏ¤·¤Æ¤¯¤À¤µ¤¤¡£<br />¥á¡¼¥ë¤ËSMTPÇ§¾Ú¤ò»È¤Ã¤Æ¤¤¤ë¾ì¹ç¤Ë¤Î¤ßÉ¬Í×¤Ç¤¹¡£' WHERE configuration_key='EMAIL_SMTPAUTH_PASSWORD';
UPDATE configuration SET configuration_title='SMTPÇ§¾Ú - DNSÌ¾', configuration_description='SMTP¥á¡¼¥ë¥µ¡¼¥Ð¤ÎDNSÌ¾¤òÆþÎÏ¤·¤Æ¤¯¤À¤µ¤¤¡£<br />Îã¡§mail.mydomain.com or 55.66.77.88<br />¥á¡¼¥ë¤ËSMTPÇ§¾Ú¤ò»È¤Ã¤Æ¤¤¤ë¾ì¹ç¤Ë¤Î¤ßÉ¬Í×¤Ç¤¹¡£' WHERE configuration_key='EMAIL_SMTPAUTH_MAIL_SERVER';
UPDATE configuration SET configuration_title='SMTPÇ§¾Ú - IP¥Ý¡¼¥ÈÈÖ¹æ', configuration_description='SMTP¥á¡¼¥ë¥µ¡¼¥Ð¤¬±¿ÍÑ¤µ¤ì¤Æ¤¤¤ëIP¥Ý¡¼¥ÈÈÖ¹æ¤òÆþÎÏ¤·¤Æ¤¯¤À¤µ¤¤¡£<br />¥á¡¼¥ë¤ËSMTPÇ§¾Ú¤ò»È¤Ã¤Æ¤¤¤ë¾ì¹ç¤Ë¤Î¤ßÉ¬Í×¤Ç¤¹¡£' WHERE configuration_key='EMAIL_SMTPAUTH_MAIL_SERVER_PORT';
UPDATE configuration SET configuration_title='¥Æ¥­¥¹¥È¥á¡¼¥ë¤Ç¤Î²ßÊ¾¤ÎÊÑ´¹', configuration_description='¥Æ¥­¥¹¥È·Á¼°¤Î¥á¡¼¥ë¤Ë¡¢¤É¤ó¤Ê²ßÊ¾¤ÎÊÑ´¹¤¬É¬Í×¤Ç¤¹¤«?<br />Default = &amp;pound;,¡ò:&amp;euro;,EUR' WHERE configuration_key='CURRENCIES_TRANSLATIONS';
UPDATE configuration SET configuration_title='¥á¡¼¥ë¤Î²þ¹Ô¥³¡¼¥É', configuration_description='¥á¡¼¥ë¥Ø¥Ã¥À¤ò¶èÀÚ¤ë¤Î¤Ë»ÈÍÑ¤¹¤ë²þ¹Ô¥³¡¼¥É¤ò»ØÄê¤·¤Þ¤¹¡£' WHERE configuration_key='EMAIL_LINEFEED';
UPDATE configuration SET configuration_title='¥á¡¼¥ëÁ÷¿®¤ËMIME HTML¤ò»ÈÍÑ', configuration_description='¥á¡¼¥ë¤òHTML·Á¼°¤ÇÁ÷¿®¤¹¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='EMAIL_USE_HTML';
UPDATE configuration SET configuration_title='¥á¡¼¥ë¥¢¥É¥ì¥¹¤òDNS¤Ç³ÎÇ§', configuration_description='¥á¡¼¥ë¥¢¥É¥ì¥¹¤òDNS¥µ¡¼¥Ð¤ËÌä¤¤¹ç¤ï¤»³ÎÇ§¤¹¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='ENTRY_EMAIL_ADDRESS_CHECK';
UPDATE configuration SET configuration_title='¥á¡¼¥ë¤òÁ÷¿®', configuration_description='E-Mail¤ò³°Éô¤ËÁ÷¿®¤¹¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='SEND_EMAILS';
UPDATE configuration SET configuration_title='¥á¡¼¥ëÊÝÂ¸¤ÎÀßÄê', configuration_description='Á÷¿®ºÑ¤ß¤Î¥á¡¼¥ë¤òÊÝÂ¸¤·¤Æ¤ª¤¯¾ì¹ç¤Ïtrue¤òÀßÄê¤·¤Æ¤¯¤À¤µ¤¤¡£' WHERE configuration_key='EMAIL_ARCHIVE';
UPDATE configuration SET configuration_title='¥á¡¼¥ëÁ÷¿®¥¨¥é¡¼¤ÎÉ½¼¨', configuration_description='¥á¡¼¥ëÁ÷¿®¤¬¼ºÇÔ¤·¤¿ºÝ¡¢¿ÍÌÜ¤Ç¤ï¤«¤ë¥¨¥é¡¼¤òÉ½¼¨¤·¤Þ¤¹¤«? ±¿±ÄÃæ¤Î¥·¥ç¥Ã¥×¤Ç¤Ïtrue¤ËÀßÄê¤¹¤ë¤³¤È¤ò´«¤á¤Þ¤¹¡£false¤ËÀßÄê¤¹¤ë¤ÈPHP¤Î¥¨¥é¡¼¥á¥Ã¥»¡¼¥¸¤òÉ½¼¨¤µ¤ì¤ë¤Î¤Ç¡¢¥È¥é¥Ö¥ë²ò·è¤Î¥Ò¥ó¥È¤Ë¤Ê¤ê¤Þ¤¹¡£' WHERE configuration_key='EMAIL_FRIENDLY_ERRORS';
UPDATE configuration SET configuration_title='¥á¡¼¥ë¥¢¥É¥ì¥¹ (¥·¥ç¥Ã¥×¤ËÉ½¼¨¤¹¤ëÌä¤¤¹ç¤ï¤»Àè)', configuration_description='¥·¥ç¥Ã¥×¥ª¡¼¥Ê¡¼¤Î¥á¡¼¥ë¥¢¥É¥ì¥¹¤È¤·¤Æ¥µ¥¤¥È¾å¤ÇÉ½¼¨¤µ¤ì¤ë¥¢¥É¥ì¥¹¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='STORE_OWNER_EMAIL_ADDRESS';
UPDATE configuration SET configuration_title='¥á¡¼¥ë¥¢¥É¥ì¥¹ (¸ÜµÒ¤Ø¤ÎÁ÷¿®¸µ)', configuration_description='¸ÜµÒ¤ËÁ÷¿®¤µ¤ì¤ë¥á¡¼¥ë¤Î¥Ç¥Õ¥©¥ë¥È¤ÎÁ÷¿®¸µ¤È¤·¤ÆÉ½¼¨¤µ¤ì¤ë¥¢¥É¥ì¥¹¤òÀßÄê¤·¤Þ¤¹¡£<br />\r\n´ÉÍý²èÌÌ¤Ç¥á¡¼¥ë¤òºîÀ®¤ò¤¹¤ëÅÔÅÙ¡¢½ñ¤­´¹¤¨¤ë¤³¤È¤â¤Ç¤­¤Þ¤¹¡£' WHERE configuration_key='EMAIL_FROM';
UPDATE configuration SET configuration_title='Á÷¿®¥á¡¼¥ë¤ÎÁ÷¿®¸µ¥¢¥É¥ì¥¹¤Î¼ÂºßÀ­', configuration_description='¤ª»È¤¤¤Î¥á¡¼¥ë¥µ¡¼¥Ð¤Ç¤Ï¡¢Á÷¿®¤¹¤ë¥á¡¼¥ë¤ÎÁ÷¿®¸µ(From)¥¢¥É¥ì¥¹¤¬Web¥µ¡¼¥Ð¾å¤Ë¼Âºß¤¹¤ë¤³¤È¤¬É¬¿Ü¤Ç¤¹¤«?<br /><br />spamÁ÷¿®¤òËÉ»ß¤¹¤ë¤Ê¤É¤Î¤¿¤á¤Ë¤³¤Î¤è¤¦¤ËÀßÄê¤µ¤ì¤Æ¤¤¤ë¤³¤È¤¬¤¢¤ê¤Þ¤¹¡£Yes¤ËÀßÄê¤¹¤ë¤È¡¢Á÷¿®¸µ¥¢¥É¥ì¥¹¤È¥á¡¼¥ëÆâ¤ÎFrom¥¢¥É¥ì¥¹¤¬°ìÃ×¤·¤Æ¤¤¤ë¤³¤È¤¬µá¤á¤é¤ì¤Þ¤¹¡£' WHERE configuration_key='EMAIL_SEND_MUST_BE_STORE';
UPDATE configuration SET configuration_title='´ÉÍý¼Ô¤¬Á÷¿®¤¹¤ë¥á¡¼¥ë¥Õ¥©¡¼¥Þ¥Ã¥È', configuration_description='´ÉÍý¼Ô¤¬Á÷ÉÕ¤¹¤ë¥á¡¼¥ë¥Õ¥©¡¼¥Þ¥Ã¥È¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />\r\n¡¦TEXT =¥Æ¥­¥¹¥È·Á¼°<br />\r\n¡¦HTML =HTML·Á¼°' WHERE configuration_key='ADMIN_EXTRA_EMAIL_FORMAT';
UPDATE configuration SET configuration_title='ÃíÊ¸³ÎÇ§¥á¡¼¥ë(¥³¥Ô¡¼)Á÷¿®Àè', configuration_description='¸ÜµÒ¤ËÁ÷¿®¤µ¤ì¤ëÃíÊ¸³ÎÇ§¥á¡¼¥ë¤Î¥³¥Ô¡¼¤òÁ÷ÉÕ¤¹¤ë¥á¡¼¥ë¥¢¥É¥ì¥¹¤òÀßÄê¤·¤Þ¤¹¡£<br />µ­ÆþÎã: Ì¾Á°1 &lt;email@address1&gt;, Ì¾Á°2 &lt;email@address2&gt;' WHERE configuration_key='SEND_EXTRA_ORDER_EMAILS_TO';
UPDATE configuration SET configuration_title='¥¢¥«¥¦¥ó¥ÈºîÀ®´°Î»¥á¡¼¥ë(¥³¥Ô¡¼)¤ÎÁ÷¿®', configuration_description='¥¢¥«¥¦¥ó¥ÈºîÀ®´°Î»¥á¡¼¥ë¤Î¥³¥Ô¡¼¤ò»ØÄê¤Î¥á¡¼¥ë¥¢¥É¥ì¥¹¤ËÁ÷¿®¤·¤Þ¤¹¤«?<br /><br />\r\n¡¦0= off<br />\r\n¡¦1= on' WHERE configuration_key='SEND_EXTRA_CREATE_ACCOUNT_EMAILS_TO_STATUS';
UPDATE configuration SET configuration_title='¥¢¥«¥¦¥ó¥ÈºîÀ®´°Î»¥á¡¼¥ë(¥³¥Ô¡¼)¤ÎÁ÷¿®Àè', configuration_description='¥¢¥«¥¦¥ó¥ÈºîÀ®´°Î»¥á¡¼¥ë¤Î¥³¥Ô¡¼¤òÁ÷¿®¤¹¤ë¥á¡¼¥ë¥¢¥É¥ì¥¹¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />\r\nµ­ÆþÎã¡§ Ì¾Á°1 &lt;email@address1&gt;, Ì¾Á°2 &lt;email@address2&gt;' WHERE configuration_key='SEND_EXTRA_CREATE_ACCOUNT_EMAILS_TO';
UPDATE configuration SET configuration_title='¡ÖÍ§Ã£¤ËÃÎ¤é¤»¤ë¡×¥á¡¼¥ë(¥³¥Ô¡¼)¤ÎÁ÷¿®', configuration_description='¡ÖÍ§Ã£¤ËÃÎ¤é¤»¤ë¡×¥á¡¼¥ë¤Î¥³¥Ô¡¼¤òÁ÷¿®¤·¤Þ¤¹¤«?<br />0= off 1= on' WHERE configuration_key='SEND_EXTRA_TELL_A_FRIEND_EMAILS_TO_STATUS';
UPDATE configuration SET configuration_title='¡ÖÍ§Ã£¤ËÃÎ¤é¤»¤ë¡×¥á¡¼¥ë(¥³¥Ô¡¼)¤ÎÁ÷¿®Àè', configuration_description='¡ÖÍ§Ã£¤ËÃÎ¤é¤»¤ë¡×¥á¡¼¥ë¤Î¥³¥Ô¡¼¤òÁ÷¿®¤¹¤ë¥á¡¼¥ë¥¢¥É¥ì¥¹¤òÀßÄê¤·¤Þ¤¹¡£µ­ÆþÎã: Ì¾Á°1 &lt;email@address1&gt;, Ì¾Á°2 &lt;email@address2&gt;' WHERE configuration_key='SEND_EXTRA_TELL_A_FRIEND_EMAILS_TO';
UPDATE configuration SET configuration_title='¥®¥Õ¥È·ôÁ÷ÉÕ¥á¡¼¥ë(¥³¥Ô¡¼)¤ÎÁ÷¿®', configuration_description='¸ÜµÒ¤¬Á÷ÉÕ¤¹¤ë¥®¥Õ¥È·ôÁ÷ÉÕ¥á¡¼¥ë¤Î¥³¥Ô¡¼¤òÁ÷¿®¤·¤Þ¤¹¤«?<br /><br />\r\n¡¦0= off<br />\r\n¡¦1= on' WHERE configuration_key='SEND_EXTRA_GV_CUSTOMER_EMAILS_TO_STATUS';
UPDATE configuration SET configuration_title='¥®¥Õ¥È·ôÁ÷ÉÕ¥á¡¼¥ë(¥³¥Ô¡¼)¤ÎÁ÷¿®Àè', configuration_description='¸ÜµÒ¤¬Á÷ÉÕ¤¹¤ë¥®¥Õ¥È·ôÁ÷ÉÕ¥á¡¼¥ë¤Î¥³¥Ô¡¼¤òÁ÷¿®¤¹¤ë¥á¡¼¥ë¥¢¥É¥ì¥¹¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />µ­ÆþÎã¡§ Ì¾Á°1 &lt;email@address1&gt;, Ì¾Á°2&lt;email@address2&gt;' WHERE configuration_key='SEND_EXTRA_GV_CUSTOMER_EMAILS_TO';
UPDATE configuration SET configuration_title='¥·¥ç¥Ã¥×±¿±Ä¼Ô¤«¤é¤Î¥®¥Õ¥È·ôÁ÷ÉÕ¥á¡¼¥ë(¥³¥Ô¡¼)¤ÎÁ÷¿®', configuration_description='¥·¥ç¥Ã¥×±¿±Ä¼Ô¤«¤é¤Î¥®¥Õ¥È·ôÁ÷ÉÕ¥á¡¼¥ë¤Î¥³¥Ô¡¼¤òÁ÷¿®¤·¤Þ¤¹¤«?<br /><br />\r\n¡¦0= off<br />\r\n¡¦1= on' WHERE configuration_key='SEND_EXTRA_GV_ADMIN_EMAILS_TO_STATUS';
UPDATE configuration SET configuration_title='¥·¥ç¥Ã¥×±¿±Ä¼Ô¤«¤é¤Î¥®¥Õ¥È·ôÁ÷ÉÕ¥á¡¼¥ë(¥³¥Ô¡¼)¤ÎÁ÷¿®Àè', configuration_description='¥·¥ç¥Ã¥×±¿±Ä¼Ô¤«¤é¤Î¥®¥Õ¥È·ôÁ÷ÉÕ¥á¡¼¥ë¤Î¥³¥Ô¡¼¤òÁ÷¿®¤¹¤ë¥á¡¼¥ë¥¢¥É¥ì¥¹¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />\r\nµ­ÆþÎã¡§Ì¾Á°1 &lt;email@address1&gt;, Ì¾Á°2 &lt;email@address2&gt;' WHERE configuration_key='SEND_EXTRA_GV_ADMIN_EMAILS_TO';
UPDATE configuration SET configuration_title='¥·¥ç¥Ã¥×±¿±Ä¼Ô¤«¤é¤Î¥¯¡¼¥Ý¥ó·ôÁ÷ÉÕ¥á¡¼¥ë(¥³¥Ô¡¼)¤ÎÁ÷¿®', configuration_description='¥·¥ç¥Ã¥×±¿±Ä¼Ô¤«¤é¤Î¥¯¡¼¥Ý¥ó·ôÁ÷ÉÕ¥á¡¼¥ë¤Î¥³¥Ô¡¼¤òÁ÷¿®¤·¤Þ¤¹¤«?<br />0= off 1= on' WHERE configuration_key='SEND_EXTRA_DISCOUNT_COUPON_ADMIN_EMAILS_TO_STATUS';
UPDATE configuration SET configuration_title='¥·¥ç¥Ã¥×±¿±Ä¼Ô¤«¤é¤Î¥¯¡¼¥Ý¥ó·ôÁ÷ÉÕ¥á¡¼¥ë(¥³¥Ô¡¼)¤ÎÁ÷¿®Àè', configuration_description='¥·¥ç¥Ã¥×±¿±Ä¼Ô¤«¤é¤Î¥¯¡¼¥Ý¥ó·ôÁ÷ÉÕ¥á¡¼¥ë¤Î¥³¥Ô¡¼¤òÁ÷¿®¤¹¤ë¥á¡¼¥ë¥¢¥É¥ì¥¹¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />\r\nµ­ÆþÎã¡§ Ì¾Á°1 &lt;email@address1&gt;, Ì¾Á°2 &lt;email@address2&gt;' WHERE configuration_key='SEND_EXTRA_DISCOUNT_COUPON_ADMIN_EMAILS_TO';
UPDATE configuration SET configuration_title='¥·¥ç¥Ã¥×±¿±Ä¼Ô¤ÎÃíÊ¸¥¹¥Æ¡¼¥¿¥¹¥á¡¼¥ë(¥³¥Ô¡¼)¤ÎÁ÷¿®', configuration_description='¥·¥ç¥Ã¥×±¿±Ä¼Ô¤ÎÃíÊ¸¥¹¥Æ¡¼¥¿¥¹¥á¡¼¥ë¤Î¥³¥Ô¡¼¤òÁ÷¿®¤·¤Þ¤¹¤«?<br /><br />\r\n¡¦0= off<br />\r\n¡¦1= on' WHERE configuration_key='SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO_STATUS';
UPDATE configuration SET configuration_title='¥·¥ç¥Ã¥×±¿±Ä¼Ô¤ÎÃíÊ¸¥¹¥Æ¡¼¥¿¥¹¥á¡¼¥ë(¥³¥Ô¡¼)¤ÎÁ÷¿®Àè', configuration_description='¥·¥ç¥Ã¥×±¿±Ä¼Ô¤ÎÃíÊ¸¥¹¥Æ¡¼¥¿¥¹¥á¡¼¥ë¤Î¥³¥Ô¡¼¤òÁ÷¿®¤¹¤ë¥á¡¼¥ë¥¢¥É¥ì¥¹¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />\r\nµ­ÆþÎã¡§ Ì¾Á°1 &lt;email@address1&gt;, Ì¾Á°2 &lt;email@address2&gt;' WHERE configuration_key='SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO';
UPDATE configuration SET configuration_title='·ÇºÜÂÔ¤Á¥ì¥Ó¥å¡¼¤Ë¤Ä¤¤¤Æ¥á¡¼¥ëÁ÷¿®', configuration_description='·ÇºÜÂÔ¤Á¤Î¥ì¥Ó¥å¡¼¤Ë¤Ä¤¤¤Æ¥á¡¼¥ë¤òÁ÷¿®¤·¤Þ¤¹¤«?<br />0= off 1= on' WHERE configuration_key='SEND_EXTRA_REVIEW_NOTIFICATION_EMAILS_TO_STATUS';
UPDATE configuration SET configuration_title='·ÇºÜÂÔ¤Á¥ì¥Ó¥å¡¼¤Ë¤Ä¤¤¤Æ¤Î¥á¡¼¥ëÁ÷¿®Àè', configuration_description='·ÇºÜÂÔ¤Á¤Î¥ì¥Ó¥å¡¼¤Ë¤Ä¤¤¤Æ¤Î¥á¡¼¥ë¤òÁ÷¿®¤¹¤ë¥¢¥É¥ì¥¹¤òÀßÄê¤·¤Þ¤¹¡£<br />¥Õ¥©¡¼¥Þ¥Ã¥È¡§Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;' WHERE configuration_key='SEND_EXTRA_REVIEW_NOTIFICATION_EMAILS_TO';
UPDATE configuration SET configuration_title='¡Ö¤ªÌä¤¤¹ç¤ï¤»¡×¥á¡¼¥ë¤Î¥É¥í¥Ã¥×¥À¥¦¥óÀßÄê', configuration_description='¡Ö¤ªÌä¤¤¹ç¤ï¤»¡×¥Ú¡¼¥¸¤Ç¡¢¥á¡¼¥ë¥¢¥É¥ì¥¹¤Î¥ê¥¹¥È¤òÀßÄê¤·¡¢¥É¥í¥Ã¥×¥À¥¦¥ó¥ê¥¹¥È¤È¤·¤ÆÉ½¼¨¤Ç¤­¤Þ¤¹¡£<br />\r\n¥Õ¥©¡¼¥Þ¥Ã¥È¡§Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;' WHERE configuration_key='CONTACT_US_LIST';
UPDATE configuration SET configuration_title='¥²¥¹¥È¤Ë¡ÖÍ§Ã£¤ËÃÎ¤é¤»¤ë¡×µ¡Ç½¤òµö²Ä', configuration_description='¥²¥¹¥È(Ì¤ÅÐÏ¿¥æ¡¼¥¶)¤Ë¡ÖÍ§Ã£¤ËÃÎ¤é¤»¤ë¡×µ¡Ç½¤òµö²Ä¤¹¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£ <br />[false]¤ËÀßÄê¤¹¤ë¤È¡¢¤³¤Îµ¡Ç½¤òÍøÍÑ¤·¤è¤¦¤È¤·¤¿ºÝ¤Ë¥í¥°¥¤¥ó¤òÂ¥¤·¤Þ¤¹¡£' WHERE configuration_key='ALLOW_GUEST_TO_TELL_A_FRIEND';
UPDATE configuration SET configuration_title='¡Ö¤ªÌä¤¤¹ç¤ï¤»¡×¤Ë¥·¥ç¥Ã¥×Ì¾¤È½»½ê¤òÉ½µ­', configuration_description='¡Ö¤ªÌä¤¤¹ç¤ï¤»¡×²èÌÌ¤Ë¥·¥ç¥Ã¥×Ì¾¤È½»½ê¤òÉ½µ­¤¹¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />\r\n¡¦0= off<br />\r\n¡¦1= on' WHERE configuration_key='CONTACT_US_STORE_NAME_ADDRESS';
UPDATE configuration SET configuration_title='ºß¸Ë¤ï¤º¤«¤Ë¤Ê¤Ã¤¿¤é¥á¡¼¥ëÁ÷¿®', configuration_description='¾¦ÉÊ¤Îºß¸Ë¤¬¿å½à¤ò²¼²ó¤Ã¤¿ºÝ¤Ë¥á¡¼¥ë¤òÁ÷¿®¤¹¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£<br />\r\n¡¦0= off<br />\r\n¡¦1= on' WHERE configuration_key='SEND_LOWSTOCK_EMAIL';
UPDATE configuration SET configuration_title='ºß¸Ë¤ï¤º¤«¤Ë¤Ê¤Ã¤¿ºÝ¤Î¥á¡¼¥ëÁ÷¿®Àè', configuration_description='¾¦ÉÊ¤Îºß¸Ë¤¬¿å½à¤ò²¼²ó¤Ã¤¿ºÝ¤Ë¥á¡¼¥ë¤òÁ÷¿®¤¹¤ë¥¢¥É¥ì¥¹¤òÀßÄê¤·¤Þ¤¹¡£Ê£¿ôÀßÄê¤¹¤ë¤³¤È¤¬¤Ç¤­¤Þ¤¹¡£<br />\r\n¥Õ¥©¡¼¥Þ¥Ã¥È¡§Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;' WHERE configuration_key='SEND_EXTRA_LOW_STOCK_EMAILS_TO';
UPDATE configuration SET configuration_title='¡Ö¥á¡¼¥ë¥Þ¥¬¥¸¥ó¤Î¹ØÆÉ²ò½ü¡×¥ê¥ó¥¯¤ÎÉ½¼¨', configuration_description='¡Ö¥á¡¼¥ë¥Þ¥¬¥¸¥ó¤Î¹ØÆÉ²ò½ü¡×¥ê¥ó¥¯¤ò¥¤¥ó¥Õ¥©¥á¡¼¥·¥ç¥ó¥µ¥¤¥É¥Ü¥Ã¥¯¥¹¤ËÉ½¼¨¤·¤Þ¤¹¤«?' WHERE configuration_key='SHOW_NEWSLETTER_UNSUBSCRIBE_LINK';
UPDATE configuration SET configuration_title='¥ª¥ó¥é¥¤¥ó¥æ¡¼¥¶¡¼¿ô¤ÎÉ½¼¨ÀßÄê', configuration_description='¥ª¥ó¥é¥¤¥ó¤Î¥æ¡¼¥¶(audiences/recipients)¤òÉ½¼¨¤¹¤ëºÝ¡¢recipients¤ò´Þ¤á¤Þ¤¹¤«?<br /><br />\r\n¡ÚÃí°Õ¡Û¤³¤ÎÀßÄê¤òtrue¤Ë¤¹¤ë¤È¡¢Âô»³¤Î¸ÜµÒ¤¬¤¤¤ë¾ì¹ç¤Ê¤É¤ËÉ½¼¨¤¬ÃÙ¤¯¤Ê¤ë¾ì¹ç¤¬¤¢¤ê¤Þ¤¹¡£' WHERE configuration_key='AUDIENCE_SELECT_DISPLAY_COUNTS';
UPDATE configuration SET configuration_title='¥À¥¦¥ó¥í¡¼¥É¤òÍ­¸ú¤Ë¤¹¤ë', configuration_description='¾¦ÉÊ¤Î¥À¥¦¥ó¥í¡¼¥Éµ¡Ç½¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='DOWNLOAD_ENABLED';
UPDATE configuration SET configuration_title='¥ê¥À¥¤¥ì¥¯¥È¤Ç¥À¥¦¥ó¥í¡¼¥É²èÌÌ¤Ø', configuration_description='¥À¥¦¥ó¥í¡¼¥É¤ÎºÝ¤Ë¥Ö¥é¥¦¥¶¤Ë¤è¤ë¥ê¥À¥¤¥ì¥¯¥È(Å¾Á÷)¤ò²ÄÇ½¤Ë¤¹¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£<br />\r\nUNIX·Ï¤Ç¤Ê¤¤¥µ¡¼¥Ð¤Ç¤Ï¥ª¥Õ¤Ë¤·¤Æ¤¯¤À¤µ¤¤¡£\r\n<br />Ãí°Õ¡§¤³¤ÎÀßÄê¤ò¥ª¥ó¤Ë¤·¤¿¤é¡¢/pub ¥Ç¥£¥ì¥¯¥È¥ê¤Î¥Ñ¡¼¥ß¥Ã¥·¥ç¥ó¤ò777¤Ë¤·¤Æ¤¯¤À¤µ¤¤¡£' WHERE configuration_key='DOWNLOAD_BY_REDIRECT';
UPDATE configuration SET configuration_title='¥¹¥È¥ê¡¼¥ß¥ó¥°¤Ë¤è¤ë¥À¥¦¥ó¥í¡¼¥É', configuration_description='¡Ö¥ê¥À¥¤¥ì¥¯¥È¤Ç¥À¥¦¥ó¥í¡¼¥É¡×¤¬¥ª¥Õ¤Ç¡¢¤«¤ÄPHP memory_limitÀßÄê¤¬8MB°Ê²¼¤Î¾ì¹ç¡¢¤³¤ÎÀßÄê¤ò¥ª¥ó¤Ë¤·¤Æ¤¯¤À¤µ¤¤¡£¥¹¥È¥ê¡¼¥ß¥ó¥°¤Ç¡¢¤è¤ê¾®¤µ¤ÊÃ±°Ì¤Ç¤Î¥Õ¥¡¥¤¥ëÅ¾Á÷¤ò¹Ô¤¦¤¿¤á¤Ç¤¹¡£<br /><br />¡Ö¥ê¥À¥¤¥ì¥¯¥È¤Ç¥À¥¦¥ó¥í¡¼¥É¡×¤¬¥ª¥ó¤Î¾ì¹ç¡¢¸ú²Ì¤Ï¤¢¤ê¤Þ¤»¤ó¡£' WHERE configuration_key='DOWNLOAD_IN_CHUNKS';
UPDATE configuration SET configuration_title='¥À¥¦¥ó¥í¡¼¥É¤ÎÍ­¸ú´ü¸Â(Æü¿ô)', configuration_description='¥À¥¦¥ó¥í¡¼¥É¥ê¥ó¥¯¤ÎÍ­¸ú´ü´Ö¤ÎÆü¿ô¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />\r\n¡¦0 = Ìµ´ü¸Â' WHERE configuration_key='DOWNLOAD_MAX_DAYS';
UPDATE configuration SET configuration_title='¥À¥¦¥ó¥í¡¼¥É²ÄÇ½²ó¿ô(¾¦ÉÊ¤´¤È)', configuration_description='¥À¥¦¥ó¥í¡¼¥É¤Ç¤­¤ë²ó¿ô¤ÎºÇÂçÃÍ¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />\r\n¡¦0 = ¥À¥¦¥ó¥í¡¼¥ÉÉÔ²Ä' WHERE configuration_key='DOWNLOAD_MAX_COUNT';
UPDATE configuration SET configuration_title='¥À¥¦¥ó¥í¡¼¥ÉÀßÄê - ÃíÊ¸¾õ¶·¤Ë¤è¤ë¹¹¿·', configuration_description='orders_status¤Ë¤è¤ë¥À¥¦¥ó¥í¡¼¥É¤ÎÍ­¸ú´ü¸Â¡¦²ÄÇ½²ó¿ô¤Î¥ê¥»¥Ã¥È¤Ë¤Ä¤¤¤ÆÀßÄê¤·¤Þ¤¹¡£<br />¥Ç¥Õ¥©¥ë¥È = 4' WHERE configuration_key='DOWNLOADS_ORDERS_STATUS_UPDATED_VALUE';
UPDATE configuration SET configuration_title='¥À¥¦¥ó¥í¡¼¥É²ÄÇ½¤È¤Ê¤ëÃíÊ¸¥¹¥Æ¡¼¥¿¥¹¤ÎID - ¥Ç¥Õ¥©¥ë¥È >= 2', configuration_description='¥À¥¦¥ó¥í¡¼¥É²ÄÇ½¤È¤Ê¤ëÃíÊ¸¥¹¥Æ¡¼¥¿¥¹¤ÎID - ¥Ç¥Õ¥©¥ë¥È >= 2<br /><br />ÃíÊ¸¥¹¥Æ¡¼¥¿¥¹¤ÎID¤¬¤³¤ÎÃÍ¤è¤ê¹â¤¤ÃíÊ¸¤Ï¥À¥¦¥ó¥í¡¼¥É²ÄÇ½¤Ë¤Ê¤ê¤Þ¤¹¡£¹ØÆþ´°Î»»þ¤ÎÃíÊ¸¥¹¥Æ¡¼¥¿¥¹¤Ï»ÙÊ§¤¤¥â¥¸¥å¡¼¥ë¤ËËè¤ËÀßÄê¤µ¤ì¤Þ¤¹¡£' WHERE configuration_key='DOWNLOADS_CONTROLLER_ORDERS_STATUS';
UPDATE configuration SET configuration_title='¥À¥¦¥ó¥í¡¼¥É½ªÎ»¤È¤Ê¤ëÃíÊ¸¥¹¥Æ¡¼¥¿¥¹¤ÎID', configuration_description='¥À¥¦¥ó¥í¡¼¥É½ªÎ»¤È¤Ê¤ëÃíÊ¸¥¹¥Æ¡¼¥¿¥¹¤ÎID - ¥Ç¥Õ¥©¥ë¥È >= 4<br /><br />ÃíÊ¸¥¹¥Æ¡¼¥¿¥¹¤¬¤³¤ÎÃÍ¤è¤ê¹â¤¤ÃíÊ¸¤Ï¥À¥¦¥ó¥í¡¼¥É¤¬½ªÎ»¤È¤Ê¤ê¤Þ¤¹¡£' WHERE configuration_key='DOWNLOADS_CONTROLLER_ORDERS_STATUS_END';
UPDATE configuration SET configuration_Title='Price FactorÂ°À­¤ò²ÄÇ½¤Ë¤¹¤ë', configuration_Description='Price FactorÂ°À­¤ò²ÄÇ½¤Ë¤¹¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='ATTRIBUTES_ENABLED_PRICE_FACTOR';
UPDATE configuration SET configuration_title='Qty Price DiscountÂ°À­¤Î¥ª¥ó/¥ª¥Õ', configuration_description='¡ÖÂçÎÌ¹ØÆþ¤Ë¤è¤ëÃÍ°ú¤­¡×Â°À­¤Î¥ª¥ó/¥ª¥Õ¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='ATTRIBUTES_ENABLED_QTY_PRICES';
UPDATE configuration SET configuration_title='¥¤¥á¡¼¥¸Â°À­¤Î¥ª¥ó/¥ª¥Õ', configuration_description='¥¤¥á¡¼¥¸Â°À­¤Î¥ª¥ó/¥ª¥Õ¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='ATTRIBUTES_ENABLED_IMAGES';
UPDATE configuration SET configuration_title='(¸ÀÍÕ¡¦Ê¸»ú¤Ë¤è¤ë)¥Æ¥­¥¹¥È¤Ë¤è¤ë²Á³ÊÀßÄê¤Î¥ª¥ó/¥ª¥Õ', configuration_description='¥Æ¥­¥¹¥È¤Ë¤è¤ë²Á³ÊÀßÄê¤ÎÂ°À­¤Î¥ª¥ó/¥ª¥Õ¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='ATTRIBUTES_ENABLED_TEXT_PRICES';
UPDATE configuration SET configuration_title='¥Æ¥­¥¹¥È¤Ë¤è¤ë²Á³ÊÀßÄê - ¶õÍó¤Î¾ì¹ç¤ÏÌµÎÁ', configuration_description='¥Æ¥­¥¹¥È¤Ë¤è¤ë²Á³ÊÀßÄê¤Î¾ì¹ç¡¢¶õÍó¤Î¤Þ¤Þ¤Ê¤éÌµÎÁ¤Ë¤¹¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />\r\n¡¦0= off<br />\r\n¡¦1= on' WHERE configuration_key='TEXT_SPACES_FREE';
UPDATE configuration SET configuration_title='Read OnlyÂ°À­¤Î¾¦ÉÊ -¡Ö¥«¡¼¥È¤ËÆþ¤ì¤ë¡×¥Ü¥¿¥ó¤ÎÉ½¼¨', configuration_description='READONLYÂ°À­¤À¤±¤¬ÀßÄê¤µ¤ì¤¿¾¦ÉÊ¤Ë¡Ö¥«¡¼¥È¤ËÆþ¤ì¤ë¡×¥Ü¥¿¥ó¤òÉ½¼¨¤·¤Þ¤¹¤«?<br />0= OFF<br />1= ON' WHERE configuration_key='PRODUCTS_OPTIONS_TYPE_READONLY_IGNORED';
UPDATE configuration SET configuration_title='GZip°µ½Ì¤ò»ÈÍÑ¤¹¤ë', configuration_description='HTTPÄÌ¿®¤ËGZip°µ½Ì¤ò»ÈÍÑ¤·¤Æ¥Ú¡¼¥¸¤òÅ¾Á÷¤·¤Þ¤¹¤«?<br /><br />\r\n¡¦0= off<br />\r\n¡¦1= on' WHERE configuration_key='GZIP_LEVEL';
UPDATE configuration SET configuration_title='¥»¥Ã¥·¥ç¥ó¾ðÊóÊÝÂ¸¥Ç¥£¥ì¥¯¥È¥ê', configuration_description='¥»¥Ã¥·¥ç¥ó´ÉÍý¤¬¥Õ¥¡¥¤¥ë¥Ù¡¼¥¹¤Î¾ì¹ç¤ËÊÝÂ¸¤¹¤ë¥Ç¥£¥ì¥¯¥È¥ê¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='SESSION_WRITE_DIRECTORY';
UPDATE configuration SET configuration_title='¥¯¥Ã¥­¡¼¤ËÊÝÂ¸¤¹¤ë¥É¥á¥¤¥óÌ¾¤ÎÀßÄê', configuration_description='¥¯¥Ã¥­¡¼¤ËÊÝÂ¸¤¹¤ë¥É¥á¥¤¥óÌ¾¤Ë¤Ä¤¤¤ÆÀßÄê¤·¤Þ¤¹¡£<br /><br />\r\n\r\n¡¦True = ¥É¥á¥¤¥ó¥Í¡¼¥àÁ´ÂÎ¤ò¥¯¥Ã¥­¡¼¤ËÊÝÂ¸(Îã¡§www.mydomain.com)<br />\r\n¡¦False = ¥É¥á¥¤¥ó¥Í¡¼¥à¤Î°ìÉô¤òÊÝÂ¸(Îã¡§mydomain.com)¡£<br />\r\n¤è¤¯¤ï¤«¤é¤Ê¤¤¾ì¹ç¤Ï¤³¤ÎÀßÄê¤ÏTrue¤Ë¤·¤Æ¤ª¤¤¤Æ¤¯¤À¤µ¤¤¡£' WHERE configuration_key='SESSION_USE_FQDN';
UPDATE configuration SET configuration_title='¥¯¥Ã¥­¡¼ÍøÍÑ¤òÉ¬¿Ü¤Ë¤¹¤ë', configuration_description='¥»¥Ã¥·¥ç¥ó¤ËÉ¬¤º¥¯¥Ã¥­¡¼¤òÍøÍÑ¤·¤Þ¤¹¡£True»ØÄê¤¹¤ë¤È¥Ö¥é¥¦¥¶¤Î¥¯¥Ã¥­¡¼¤¬¥ª¥Õ¤Ë¤Ê¤Ã¤Æ¤¤¤ë¾ì¹ç¤Ï¥»¥Ã¥·¥ç¥ó¤ò³«»Ï¤·¤Þ¤»¤ó¡£¥»¥­¥å¥ê¥Æ¥£¾å¤ÎÍýÍ³¤«¤éÍ¾Äø¤ÎÍýÍ³¤Î¤Ê¤¤¸Â¤ê¤ÏTrue»ØÄê¤Î¤Þ¤Þ¤È¤¹¤ë¤³¤È¤ò¶¯¤¯¿ä¾©¤·¤Þ¤¹¡£', configuration_value='True' WHERE configuration_key='SESSION_FORCE_COOKIE_USE';
UPDATE configuration SET configuration_title='SSL¥»¥Ã¥·¥ç¥óID¥Á¥§¥Ã¥¯', configuration_description='Á´¤Æ¤ÎHTTPS¥ê¥¯¥¨¥¹¥È¤ÇSSL¥»¥Ã¥·¥ç¥óID¤ò¥Á¥§¥Ã¥¯¤·¤Þ¤¹¤«?' WHERE configuration_key='SESSION_CHECK_SSL_SESSION_ID';
UPDATE configuration SET configuration_title='User Agent¥Á¥§¥Ã¥¯', configuration_description='Á´¤Æ¤Î¥ê¥¯¥¨¥¹¥È»þ¤ËUser Agent¤Î¥Á¥§¥Ã¥¯¤ò¹Ô¤¤¤Þ¤¹¤«?' WHERE configuration_key='SESSION_CHECK_USER_AGENT';
UPDATE configuration SET configuration_title='IP¥¢¥É¥ì¥¹¥Á¥§¥Ã¥¯', configuration_description='Á´¤Æ¤Î¥ê¥¯¥¨¥¹¥È»þ¤ËIP¥¢¥É¥ì¥¹¤ò¥Á¥§¥Ã¥¯¤·¤Þ¤¹¤«?' WHERE configuration_key='SESSION_CHECK_IP_ADDRESS';
UPDATE configuration SET configuration_title='¥í¥Ü¥Ã¥È(¥¹¥Ñ¥¤¥À¡¼)¤Î¥»¥Ã¥·¥ç¥ó¤òËÉ»ß', configuration_description='´ûÃÎ¤Î¥í¥Ü¥Ã¥È(¥¹¥Ñ¥¤¥À¡¼)¤¬¥»¥Ã¥·¥ç¥ó¤ò³«»Ï¤¹¤ë¤³¤È¤òËÉ»ß¤·¤Þ¤¹¤«?' WHERE configuration_key='SESSION_BLOCK_SPIDERS';
UPDATE configuration SET configuration_title='¥»¥Ã¥·¥ç¥óºÆÈ¯¹Ô', configuration_description='¥æ¡¼¥¶¡¼¤¬¥í¥°¥ª¥ó¤Þ¤¿¤Ï¥¢¥«¥¦¥ó¥È¤òºîÀ®¤·¤¿¾ì¹ç¤Ë¥»¥Ã¥·¥ç¥ó¤òºÆÈ¯¹Ô¤·¤Þ¤¹¤«?<br />(PHP4.1°Ê¾å¤¬É¬Í×)' WHERE configuration_key='SESSION_RECREATE';
UPDATE configuration SET configuration_title='IP¥¢¥É¥ì¥¹ÊÑ´¹¤ÎÀßÄê', configuration_description='IP¥¢¥É¥ì¥¹¤ò¥Û¥¹¥È¥¢¥É¥ì¥¹¤ËÊÑ´¹¤·¤Þ¤¹¤«?<br /><br />Ãí°Õ¡§¥µ¡¼¥Ð¤Ë¤è¤Ã¤Æ¤Ï¡¢¤³¤ÎÀßÄê¤Ç¥á¡¼¥ëÁ÷¿®¤Î¥¹¥¿¡¼¥È¡¦½ªÎ»¤¬ÃÙ¤¯¤Ê¤ë¤³¤È¤¬¤¢¤ê¤Þ¤¹¡£' WHERE configuration_key='SESSION_IP_TO_HOST_ADDRESS';
UPDATE configuration SET configuration_title='¥®¥Õ¥È/¥¯¡¼¥Ý¥ó·ô¥³¡¼¥É¤ÎÄ¹¤µ', configuration_description='¥®¥Õ¥È/¥¯¡¼¥Ý¥ó·ô¥³¡¼¥É¤ÎÄ¹¤µ¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />\r\nÃí°Õ¡§¥³¡¼¥É¤¬Ä¹¤¤¤Û¤É°ÂÁ´¤Ç¤¹¡£' WHERE configuration_key='SECURITY_CODE_LENGTH';
UPDATE configuration SET configuration_title='º¹°ú»Ä¹â0¤Î¾ì¹ç¤ÎÃíÊ¸¥¹¥Æ¡¼¥¿¥¹', configuration_description='ÃíÊ¸¤Îº¹°ú»Ä¹â¤¬0¤Î¾ì¹ç¤ËÅ¬ÍÑ¤µ¤ì¤ëÃíÊ¸¥¹¥Æ¡¼¥¿¥¹¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='DEFAULT_ZERO_BALANCE_ORDERS_STATUS_ID';
UPDATE configuration SET configuration_title='¥¦¥§¥ë¥«¥à¥¯¡¼¥Ý¥ó·ô', configuration_description='²ñ°÷ÅÐÏ¿»þ¤Ë¤½¤Î²ñ°÷¤Ë¥¦¥§¥ë¥«¥à¥¯¡¼¥Ý¥ó·ô¤È¤·¤Æ¼«Æ°È¯¹Ô¤¹¤ë¥¯¡¼¥Ý¥ó·ô¤òÁªÂò¤·¤Æ¤¯¤À¤µ¤¤¡£' WHERE configuration_key='NEW_SIGNUP_DISCOUNT_COUPON';
UPDATE configuration SET configuration_title='¿·¤·¤¤¥®¥Õ¥È·ô¤ÎÅÐÏ¿³Û', configuration_description='¿·¤·¤¤¥®¥Õ¥È·ô¤ÎÅÐÏ¿³Û¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />\r\n¡¦¶õÇò = ¤Ê¤·<br />\r\n¡¦1000 = 1000±ß' WHERE configuration_key='NEW_SIGNUP_GIFT_VOUCHER_AMOUNT';
UPDATE configuration SET configuration_title='¥¯¡¼¥Ý¥ó·ô¤Î¥Ú¡¼¥¸¤¢¤¿¤êºÇÂçÉ½¼¨·ï¿ô', configuration_description='¥¯¡¼¥Ý¥ó·ô¤Î1¥Ú¡¼¥¸¤¢¤¿¤ê¤ÎÉ½¼¨·ï¿ô¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='MAX_DISPLAY_SEARCH_RESULTS_DISCOUNT_COUPONS';
UPDATE configuration SET configuration_title='¥¯¡¼¥Ý¥ó·ô¥ì¥Ý¡¼¥È¤Î¥Ú¡¼¥¸¤¢¤¿¤êºÇÂçÉ½¼¨·ï¿ô', configuration_description='¥¯¡¼¥Ý¥ó·ô¤Î¥ì¥Ý¡¼¥È¥Ú¡¼¥¸¤Ç¤ÎÉ½¼¨·ï¿ô¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='MAX_DISPLAY_SEARCH_RESULTS_DISCOUNT_COUPONS_REPORTS';
UPDATE configuration SET configuration_title='¥®¥Õ¥È·ô»Ä¹â¤ÎºÇÂçÃÍ¿ô', configuration_description='¥®¥Õ¥È·ô»Ä¹â¤ÎºÇÂçÃÍ¤òÀßÄê¤·¤Þ¤¹¡£¥®¥Õ¥È·ô°ú¤­´¹¤¨·ë²Ì¤¬¤³¤ÎÃÍ¤òÄ¶¤¨¤ë¾ì¹ç¤Ï°ú¤­´¹¤¨½èÍý¤¬¤Ç¤­¤Þ¤»¤ó¡£ÃÍ¤Ï100000°Ê²¼¤ò»ØÄê¤·¤Æ¤¯¤À¤µ¤¤¡£' WHERE configuration_key='MAX_GIFT_AMOUNT';
UPDATE configuration SET configuration_title='¥¯¥ì¥¸¥Ã¥È¥«¡¼¥ÉÍøÍÑ¤Î²ÄÈÝ - VISA', configuration_description='VISA¤òÍ­¸ú¤Ë¤·¤Þ¤¹¤«?<br /><br />\r\n¡¦0= off<br />\r\n¡¦1= on' WHERE configuration_key='CC_ENABLED_VISA';
UPDATE configuration SET configuration_title='¥¯¥ì¥¸¥Ã¥È¥«¡¼¥ÉÍøÍÑ¤Î²ÄÈÝ - MasterCard', configuration_description='MasterCard¤òÍ­¸ú¤Ë¤·¤Þ¤¹¤«?<br /><br />\r\n¡¦0= off<br />\r\n¡¦1= on' WHERE configuration_key='CC_ENABLED_MC';
UPDATE configuration SET configuration_title='¥¯¥ì¥¸¥Ã¥È¥«¡¼¥ÉÍøÍÑ¤Î²ÄÈÝ - AmericanExpress', configuration_description='AmericanExpress¤òÍ­¸ú¤Ë¤·¤Þ¤¹¤«?<br /><br />\r\n¡¦0= off<br />\r\n¡¦1= on' WHERE configuration_key='CC_ENABLED_AMEX';
UPDATE configuration SET configuration_title='¥¯¥ì¥¸¥Ã¥È¥«¡¼¥ÉÍøÍÑ¤Î²ÄÈÝ - Diners Club', configuration_description='Diners Club¤òÍ­¸ú¤Ë¤·¤Þ¤¹¤«?<br /><br />\r\n¡¦0= off<br />\r\n¡¦1= on' WHERE configuration_key='CC_ENABLED_DINERS_CLUB';
UPDATE configuration SET configuration_title='¥¯¥ì¥¸¥Ã¥È¥«¡¼¥ÉÍøÍÑ¤Î²ÄÈÝ - Discover Card', configuration_description='Discover Card¤òÍ­¸ú¤Ë¤·¤Þ¤¹¤«?<br /><br />\r\n¡¦0= off<br />\r\n¡¦1= on' WHERE configuration_key='CC_ENABLED_DISCOVER';
UPDATE configuration SET configuration_title='¥¯¥ì¥¸¥Ã¥È¥«¡¼¥ÉÍøÍÑ¤Î²ÄÈÝ - JCB', configuration_description='JCB¤òÍ­¸ú¤Ë¤·¤Þ¤¹¤«?<br /><br />\r\n¡¦0= off<br />\r\n¡¦1= on' WHERE configuration_key='CC_ENABLED_JCB';
UPDATE configuration SET configuration_title='¥¯¥ì¥¸¥Ã¥È¥«¡¼¥ÉÍøÍÑ¤Î²ÄÈÝ - AUSTRALIAN BANKCARD', configuration_description='AUSTRALIAN BANKCARD¤òÍ­¸ú¤Ë¤·¤Þ¤¹¤«?<br /><br />\r\n¡¦0= off<br />\r\n¡¦1= on' WHERE configuration_key='CC_ENABLED_AUSTRALIAN_BANKCARD';
UPDATE configuration SET configuration_title='ÍøÍÑ²ÄÇ½¤Ê¥¯¥ì¥¸¥Ã¥È¥«¡¼¥É - »ÙÊ§¤¤¥Ú¡¼¥¸¤ËÉ½¼¨', configuration_description='ÍøÍÑ²ÄÇ½¤Ê¥¯¥ì¥¸¥Ã¥È¥«¡¼¥É¤ò»ÙÊ§¤¤¥Ú¡¼¥¸¤ËÉ½¼¨¤·¤Þ¤¹¤«?<br /><br />\r\n¡¦0= off<br />\r\n¡¦1= ¥Æ¥­¥¹¥È¤òÉ½¼¨<br />\r\n¡¦2= ²èÁü¤òÉ½¼¨<br />\r\n¡ÚÃí°Õ¡Û¥¯¥ì¥¸¥Ã¥È¥«¡¼¥É¤Î²èÁü¤È¥Æ¥­¥¹¥È¤Ï¡¢¥Ç¡¼¥¿¥Ù¡¼¥¹¤È¥é¥ó¥²¡¼¥¸¥Õ¥¡¥¤¥ëÆâ¤ÇÄêµÁ¤µ¤ì¤Æ¤¤¤ëÉ¬Í×¤¬¤¢¤ê¤Þ¤¹¡£' WHERE configuration_key='SHOW_ACCEPTED_CREDIT_CARDS';
UPDATE configuration SET configuration_title='¥®¥Õ¥È·ô¤ÎÉ½¼¨', configuration_description='' WHERE configuration_key='MODULE_ORDER_TOTAL_GV_STATUS';
UPDATE configuration SET configuration_title='É½¼¨¤ÎÀ°Îó½ç', configuration_description='É½¼¨¤ÎÀ°Îó½ç¤òÀßÄê¤·¤Þ¤¹¡£<br />¿ô»ú¤¬¾®¤µ¤¤¤Û¤É¾å°Ì¤ËÉ½¼¨¤µ¤ì¤Þ¤¹¡£' WHERE configuration_key='MODULE_ORDER_TOTAL_GV_SORT_ORDER';
UPDATE configuration SET configuration_title='¹ØÆþ¤ò¾µÇ§ÂÔ¤Á¤Ë', configuration_description='¥®¥Õ¥È·ô¹ØÆþ¤ò¾µÇ§ÂÔ¤Á¥ê¥¹¥È¤ËÄÉ²Ã¤·¤Þ¤¹¤«?' WHERE configuration_key='MODULE_ORDER_TOTAL_GV_QUEUE';
UPDATE configuration SET configuration_title='Á÷ÎÁ¤ò´Þ¤á¤ë', configuration_description='¹ç·×·×»»¤ËÁ÷ÎÁ¤ò´Þ¤á¤Þ¤¹¤«?' WHERE configuration_key='MODULE_ORDER_TOTAL_GV_INC_SHIPPING';
UPDATE configuration SET configuration_title='ÀÇ¶â¤ò´Þ¤á¤ë', configuration_description='·×»»»þ¤ËÀÇ¶â¤ò´Þ¤á¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='MODULE_ORDER_TOTAL_GV_INC_TAX';
UPDATE configuration SET configuration_title='ÀÇ¶â¤òºÆ·×»»', configuration_description='ÀÇ¶â¤òºÆ·×»»¤·¤Þ¤¹¤«?' WHERE configuration_key='MODULE_ORDER_TOTAL_GV_CALC_TAX';
UPDATE configuration SET configuration_title='ÀÇ¼ïÊÌ', configuration_description='¥®¥Õ¥È·ô¤ËÅ¬ÍÑ¤µ¤ì¤ëÀÇ¼ïÊÌ¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='MODULE_ORDER_TOTAL_GV_TAX_CLASS';
UPDATE configuration SET configuration_title='ÀÇ¶â¤òÉÕ²Ã¤¹¤ë', configuration_description='¥®¥Õ¥È·ô¤ò·×»»¤¹¤ëºÝ¤ËÀÇ¶â¤òÉÕ²Ã¤·¤Þ¤¹¤«?' WHERE configuration_key='MODULE_ORDER_TOTAL_GV_CREDIT_TAX';
UPDATE configuration SET configuration_title='Äã³Û¾¦ÉÊ¼è°·¤¤¼ê¿ôÎÁ¤ÎÉ½¼¨', configuration_description='' WHERE configuration_key='MODULE_ORDER_TOTAL_LOWORDERFEE_STATUS';
UPDATE configuration SET configuration_title='É½¼¨¤ÎÀ°Îó½ç', configuration_description='É½¼¨¤ÎÀ°Îó½ç¤òÀßÄê¤·¤Þ¤¹¡£¿ô»ú¤¬¾®¤µ¤¤¤Û¤É¾å°Ì¤ËÉ½¼¨¤µ¤ì¤Þ¤¹¡£' WHERE configuration_key='MODULE_ORDER_TOTAL_LOWORDERFEE_SORT_ORDER';
UPDATE configuration SET configuration_title='Äã³Û¾¦ÉÊ¼è°·¤¤¼ê¿ôÎÁ¤ÎÀßÄê', configuration_description='Äã³Û¾¦ÉÊ¼è°·¤¤¼ê¿ôÎÁÀßÄê¤òÍ­¸ú¤Ë¤·¤Þ¤¹¤«?' WHERE configuration_key='MODULE_ORDER_TOTAL_LOWORDERFEE_LOW_ORDER_FEE';
UPDATE configuration SET configuration_title='Äã³Û¾¦ÉÊ¼è°·¤¤¼ê¿ôÎÁ¤ò²Ý¶â¤¹¤ëÃíÊ¸¶â³Û', configuration_description='¤³¤ÎÃíÊ¸¶â³ÛÌ¤Ëþ¤Î¾ì¹ç¡¢¼ê¿ôÎÁ¤ò²Ý¶â¤·¤Þ¤¹¡£' WHERE configuration_key='MODULE_ORDER_TOTAL_LOWORDERFEE_ORDER_UNDER';
UPDATE configuration SET configuration_title='¼è°·¤¤¼ê¿ôÎÁ¤ÎÀßÄê', configuration_description='¼ê¿ôÎÁ¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />\r\nÎ¨(%)¤Ç·×»»¤¹¤ë¾ì¹ç¤Ë¤Ï¡Ö10%¡×¤Ê¤É¤Èµ­Æþ¤·¡¢¸ÇÄê¤Î¾ì¹ç¤Ë¤Ï¡Ö500¡×(500±ß)¤Ê¤É¤Èµ­Æþ¤·¤Þ¤¹¡£' WHERE configuration_key='MODULE_ORDER_TOTAL_LOWORDERFEE_FEE';
UPDATE configuration SET configuration_title='Äã³Û¾¦ÉÊ¼è°·¤¤¼ê¿ôÎÁ¤òÅ¬ÍÑ¤¹¤ëÃÏ°è', configuration_description='ÀßÄê¤·¤¿ÃÏ°è¤ËÂÐ¤·¤ÆÄã³Û¾¦ÉÊ¼è°·¤¤¼ê¿ôÎÁ¤¬Å¬ÍÑ¤µ¤ì¤Þ¤¹¡£' WHERE configuration_key='MODULE_ORDER_TOTAL_LOWORDERFEE_DESTINATION';
UPDATE configuration SET configuration_title='ÀÇ¼ïÊÌ', configuration_description='Äã³Û¾¦ÉÊ¼è°·¤¤¼ê¿ôÎÁ¶â³Û¤ËÅ¬ÍÑ¤µ¤ì¤ëÀÇ¼ïÊÌ¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='MODULE_ORDER_TOTAL_LOWORDERFEE_TAX_CLASS';
UPDATE configuration SET configuration_title='Äã³Û¾¦ÉÊ¼è°·¤¤¼ê¿ôÎÁ¤Ï¥ô¥¡¡¼¥Á¥ã¥ë¾¦ÉÊ¤Ë¤ÏÈóÅ¬ÍÑ', configuration_description='¥«¡¼¥ÈÆâ¤¬¥ô¥¡¡¼¥Á¥ã¥ë¾¦ÉÊ¤À¤±¤ÎºÝ¤Ë¡¢Äã³Û¾¦ÉÊ¼è°·¤¤¼ê¿ôÎÁ¤òÄ§¼ý¤¹¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='MODULE_ORDER_TOTAL_LOWORDERFEE_VIRTUAL';
UPDATE configuration SET configuration_title='Äã³Û¾¦ÉÊ¼è°·¤¤¼ê¿ôÎÁ¤Ï¥®¥Õ¥È·ô¤Ë¤ÏÈóÅ¬ÍÑ', configuration_description='¥«¡¼¥ÈÆâ¤¬¥®¥Õ¥È·ô¤Ê¤É¤À¤±¤Î¤È¤­¤ËÄã³Û¾¦ÉÊ¼è°·¤¤¼ê¿ôÎÁ¤òÄ§¼ý¤¹¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='MODULE_ORDER_TOTAL_LOWORDERFEE_GV';
UPDATE configuration SET configuration_title='Á÷ÎÁ¤ÎÉ½¼¨', configuration_description='' WHERE configuration_key='MODULE_ORDER_TOTAL_SHIPPING_STATUS';
UPDATE configuration SET configuration_title='É½¼¨¤ÎÀ°Îó½ç', configuration_description='É½¼¨¤ÎÀ°Îó½ç¤òÀßÄê¤·¤Þ¤¹¡£<br />\r\n¿ô»ú¤¬¾®¤µ¤¤¤Û¤É¾å°Ì¤ËÉ½¼¨¤µ¤ì¤Þ¤¹¡£' WHERE configuration_key='MODULE_ORDER_TOTAL_SHIPPING_SORT_ORDER';
UPDATE configuration SET configuration_title='Á÷ÎÁÌµÎÁÀßÄê', configuration_description='Á÷ÎÁÌµÎÁÀßÄê¤òÍ­¸ú¤Ë¤·¤Þ¤¹¤«?' WHERE configuration_key='MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING';
UPDATE configuration SET configuration_title='Á÷ÎÁÌµÎÁ¤Ë¤¹¤ë¹ØÆþ¶â³ÛÀßÄê', configuration_description='ÀßÄê¶â³Û°Ê¾å¤Î¤´¹ØÆþ¤Î¾ì¹ç¤ÏÁ÷ÎÁ¤òÌµÎÁ¤Ë¤·¤Þ¤¹¡£' WHERE configuration_key='MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER';
UPDATE configuration SET configuration_title='Á÷ÎÁÌµÎÁ¤Ë¤¹¤ëÃÏ°è¤ÎÀßÄê', configuration_description='ÀßÄê¤·¤¿ÃÏ°è¤ËÂÐ¤·¤ÆÁ÷ÎÁÌµÎÁ¤òÅ¬ÍÑ¤·¤Þ¤¹¡£' WHERE configuration_key='MODULE_ORDER_TOTAL_SHIPPING_DESTINATION';
UPDATE configuration SET configuration_title='¾®·×¤ÎÉ½¼¨', configuration_description='' WHERE configuration_key='MODULE_ORDER_TOTAL_SUBTOTAL_STATUS';
UPDATE configuration SET configuration_title='É½¼¨¤ÎÀ°Îó½ç', configuration_description='É½¼¨¤ÎÀ°Îó½ç¤òÀßÄê¤·¤Þ¤¹¡£<br />\r\n¿ô»ú¤¬¾®¤µ¤¤¤Û¤É¾å°Ì¤ËÉ½¼¨¤µ¤ì¤Þ¤¹¡£' WHERE configuration_key='MODULE_ORDER_TOTAL_SUBTOTAL_SORT_ORDER';
UPDATE configuration SET configuration_title='ÀÇ¶â¤ÎÉ½¼¨', configuration_description='' WHERE configuration_key='MODULE_ORDER_TOTAL_TAX_STATUS';
UPDATE configuration SET configuration_title='É½¼¨¤ÎÀ°Îó½ç', configuration_description='É½¼¨¤ÎÀ°Îó½ç¤òÀßÄê¤Ç¤­¤Þ¤¹. ¿ô»ú¤¬¾®¤µ¤¤¤Û¤É¾å°Ì¤ËÉ½¼¨¤µ¤ì¤Þ¤¹¡£' WHERE configuration_key='MODULE_ORDER_TOTAL_TAX_SORT_ORDER';
UPDATE configuration SET configuration_title='¹ç·×¤ÎÉ½¼¨', configuration_description='' WHERE configuration_key='MODULE_ORDER_TOTAL_TOTAL_STATUS';
UPDATE configuration SET configuration_title='É½¼¨¤ÎÀ°Îó½ç', configuration_description='É½¼¨¤ÎÀ°Îó½ç¤òÀßÄê¤Ç¤­¤Þ¤¹¡£<br />\r\n¿ô»ú¤¬¾®¤µ¤¤¤Û¤É¾å°Ì¤ËÉ½¼¨¤µ¤ì¤Þ¤¹¡£' WHERE configuration_key='MODULE_ORDER_TOTAL_TOTAL_SORT_ORDER';
UPDATE configuration SET configuration_title='ÀÇ¼ïÊÌ', configuration_description='¥¯¡¼¥Ý¥ó·ô¤ËÅ¬ÍÑ¤µ¤ì¤ëÀÇ¼ïÊÌ¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='MODULE_ORDER_TOTAL_COUPON_TAX_CLASS';
UPDATE configuration SET configuration_title='ÀÇ¶â¤ò´Þ¤á¤ë - ¥ª¥ó/¥ª¥Õ', configuration_description='Âå¶â·×»»¤ËÀÇ¶â¤ò´Þ¤á¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='MODULE_ORDER_TOTAL_COUPON_INC_TAX';
UPDATE configuration SET configuration_title='É½¼¨¤ÎÀ°Îó½ç', configuration_description='É½¼¨¤ÎÀ°Îó½ç¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='MODULE_ORDER_TOTAL_COUPON_SORT_ORDER';
UPDATE configuration SET configuration_title='Á÷ÎÁ¤ò´Þ¤á¤ë', configuration_description='Á÷ÎÁ¤ò·×»»¤Ë´Þ¤á¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='MODULE_ORDER_TOTAL_COUPON_INC_SHIPPING';
UPDATE configuration SET configuration_title='¥¯¡¼¥Ý¥ó·ô¤ÎÉ½¼¨', configuration_description='' WHERE configuration_key='MODULE_ORDER_TOTAL_COUPON_STATUS';
UPDATE configuration SET configuration_title='ÀÇ¶â¤òºÆ·×»»', configuration_description='ÀÇ¶â¤òºÆ·×»»¤·¤Þ¤¹¤«?' WHERE configuration_key='MODULE_ORDER_TOTAL_COUPON_CALC_TAX';
UPDATE configuration SET configuration_title='´ÉÍý¼Ô¥Ç¥â -¥ª¥ó/¥ª¥Õ', configuration_description='´ÉÍý¼Ô¥Ç¥â¤òÍ­¸ú¤Ë¤¹¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />\r\n¡¦0= off<br />\r\n¡¦1= on' WHERE configuration_key='ADMIN_DEMO';
UPDATE configuration SET configuration_title='¾¦ÉÊ¥ª¥×¥·¥ç¥ó - ¥»¥ì¥¯¥È¥Ü¥Ã¥¯¥¹·¿', configuration_description='¥»¥ì¥¯¥È¥Ü¥Ã¥¯¥¹·¿¤Î¾¦ÉÊ¥ª¥×¥·¥ç¥ó¤Î¿ôÃÍ¤Ï?' WHERE configuration_key='PRODUCTS_OPTIONS_TYPE_SELECT';
UPDATE configuration SET configuration_title='¾¦ÉÊ¥ª¥×¥·¥ç¥ó - ¥Æ¥­¥¹¥È·¿', configuration_description='¥Æ¥­¥¹¥È·¿¤Î¾¦ÉÊ¥ª¥×¥·¥ç¥ó¤Î¿ôÃÍ¤Ï?' WHERE configuration_key='PRODUCTS_OPTIONS_TYPE_TEXT';
UPDATE configuration SET configuration_title='¾¦ÉÊ¥ª¥×¥·¥ç¥ó - ¥é¥¸¥ª¥Ü¥¿¥ó·¿', configuration_description='¥é¥¸¥ª¥Ü¥¿¥ó·¿¤Î¾¦ÉÊ¥ª¥×¥·¥ç¥ó¤Î¿ôÃÍ¤Ï?' WHERE configuration_key='PRODUCTS_OPTIONS_TYPE_RADIO';
UPDATE configuration SET configuration_title='¾¦ÉÊ¥ª¥×¥·¥ç¥ó - ¥Á¥§¥Ã¥¯¥Ü¥Ã¥¯¥¹·¿', configuration_description='¥Á¥§¥Ã¥¯¥Ü¥Ã¥¯¥¹·¿¤Î¾¦ÉÊ¥ª¥×¥·¥ç¥ó¤Î¿ôÃÍ¤Ï?' WHERE configuration_key='PRODUCTS_OPTIONS_TYPE_CHECKBOX';
UPDATE configuration SET configuration_title='¾¦ÉÊ¥ª¥×¥·¥ç¥ó - ¥Õ¥¡¥¤¥ë·¿', configuration_description='¥Õ¥¡¥¤¥ë·¿¤Î¾¦ÉÊ¥ª¥×¥·¥ç¥ó¤Î¿ôÃÍ¤Ï?' WHERE configuration_key='PRODUCTS_OPTIONS_TYPE_FILE';
UPDATE configuration SET configuration_title='ID for text and file products options values', configuration_description='¥Æ¥­¥¹¥È·¿¡¦¥Õ¥¡¥¤¥ë·¿Â°À­¤Îproducts_options_values_id¤Ç»È¤ï¤ì¤ë¿ôÃÍ¤Ï?' WHERE configuration_key='PRODUCTS_OPTIONS_VALUES_TEXT_ID';
UPDATE configuration SET configuration_title='¥¢¥Ã¥×¥í¡¼¥É¥ª¥×¥·¥ç¥ó¤ÎÀÜÆ¬¼­(Prefix)', configuration_description='¥¢¥Ã¥×¥í¡¼¥É¥ª¥×¥·¥ç¥ó¤òÂ¾¤Î¥ª¥×¥·¥ç¥ó¤È¶èÊÌ¤¹¤ë¤¿¤á¤Ë»È¤¦ÀÜÆ¬¼­(Prefix)¤Ï?' WHERE configuration_key='UPLOAD_PREFIX';
UPDATE configuration SET configuration_title='¥Æ¥­¥¹¥È¤ÎÀÜÆ¬¼­(Prefix)', configuration_description='¥Æ¥­¥¹¥È¥ª¥×¥·¥ç¥ó¤òÂ¾¤Î¥ª¥×¥·¥ç¥ó¤È¶èÊÌ¤¹¤ë¤¿¤á¤Ë»È¤¦ÀÜÆ¬¼­(Prefix)¤Ï?' WHERE configuration_key='TEXT_PREFIX';
UPDATE configuration SET configuration_title='¾¦ÉÊ¥ª¥×¥·¥ç¥ó - READ ONLY·¿', configuration_description='READ ONLY·¿¤Î¾¦ÉÊ¥ª¥×¥·¥ç¥ó¤Î¿ôÃÍ¤Ï?' WHERE configuration_key='PRODUCTS_OPTIONS_TYPE_READONLY';
UPDATE configuration SET configuration_title='¾¦ÉÊ¾ðÊó - ¾¦ÉÊ¥ª¥×¥·¥ç¥ó¤Î¥½¡¼¥È½ç', configuration_description='¾¦ÉÊ¾ðÊó¤Ë¤ª¤±¤ë¥ª¥×¥·¥ç¥óÌ¾¤Î¥½¡¼¥È½ç¤òÀßÄê¤·¤Þ¤¹¡£<br />\r\n<br />\r\n¡¦0= ¥½¡¼¥È½ç¡¢¥ª¥×¥·¥ç¥óÌ¾<br />\r\n¡¦1= ¥ª¥×¥·¥ç¥óÌ¾' WHERE configuration_key='PRODUCTS_OPTIONS_SORT_ORDER';
UPDATE configuration SET configuration_title='¾¦ÉÊ¾ðÊó - ¾¦ÉÊ¥ª¥×¥·¥ç¥óÃÍ¤Î¥½¡¼¥È½ç', configuration_description='¾¦ÉÊÀâÌÀ¤Ç¤Î¾¦ÉÊ¥ª¥×¥·¥ç¥óÃÍ¤Î¥½¡¼¥È½ç¤òÀßÄê¤·¤Þ¤¹¡£<br />\r\n<br />\r\n¡¦0= ¥½¡¼¥È½ç¡¢²Á³Ê<br />\r\n¡¦1= ¥½¡¼¥È½ç¡¢¥ª¥×¥·¥ç¥óÃÍ¤ÎÌ¾¾Î' WHERE configuration_key='PRODUCTS_OPTIONS_SORT_BY_PRICE';
UPDATE configuration SET configuration_title='¾¦ÉÊ¤ÎÂ°À­²èÁü¤Î²¼¤ËÉ½¼¨¤¹¤ë¥ª¥×¥·¥ç¥óÃÍ', configuration_description='¾¦ÉÊ¤ÎÂ°À­²èÁü¤Î²¼¤Ë¥ª¥×¥·¥ç¥óÌ¾¤òÉ½¼¨¤·¤Þ¤¹¤«?<br /><br />\r\n¡¦0= off<br />\r\n¡¦1= on' WHERE configuration_key='PRODUCT_IMAGES_ATTRIBUTES_NAMES';
UPDATE configuration SET configuration_title='¾¦ÉÊ¾ðÊó - ¥»¡¼¥ë³ä°úÉ½¼¨', configuration_description='¥»¡¼¥ë³ä°úÊ¬¤òÉ½¼¨¤·¤Þ¤¹¤«?<br /><br />\r\n¡¦0= off<br />\r\n¡¦1= on' WHERE configuration_key='SHOW_SALE_DISCOUNT_STATUS';
UPDATE configuration SET configuration_title='¾¦ÉÊ¾ðÊó - ¥»¡¼¥ë³ä°ú¤ÎÉ½¼¨ÊýË¡(³ä°ú³Û¡¦¥Ñ¡¼¥»¥ó¥È)', configuration_description='¥»¡¼¥ë³ä°ú¤ÎÉ½¼¨ÊýË¡¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />\r\n¡¦1= ³ä°úÎ¨(%) ¤Ç¤Îoff<br />\r\n¡¦2= ³ä°ú¶â³Û ¤Ç¤Îoff' WHERE configuration_key='SHOW_SALE_DISCOUNT';
UPDATE configuration SET configuration_title='¾¦ÉÊ¾ðÊó - ³ä°úÎ¨É½¼¨¤Î¾®¿ôÅÀ', configuration_description='³ä°úÎ¨É½¼¨¤Î¥Ñ¡¼¥»¥ó¥È¤Î¾®¿ôÅÀ°ÌÃÖ¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />\r\n¡¦¥Ç¥Õ¥©¥ë¥È= 0' WHERE configuration_key='SHOW_SALE_DISCOUNT_DECIMALS';
UPDATE configuration SET configuration_title='¾¦ÉÊ¾ðÊó- ÌµÎÁ¾¦ÉÊ¤Î²èÁü¡¦¥Æ¥­¥¹¥È¤Î¥¹¥Æ¡¼¥¿¥¹', configuration_description='¾¦ÉÊ¾ðÊó¤Ç¤ÎÌµÎÁ¾¦ÉÊ¤Î²èÁü¡¦¥¤¥á¡¼¥¸¤ÎÉ½¼¨¤òÀßÄê¤·¤Þ¤¹¡£<br />\r\n<br />\r\n¡¦0= Text<br />\r\n¡¦1= Image' WHERE configuration_key='OTHER_IMAGE_PRICE_IS_FREE_ON';
UPDATE configuration SET configuration_title='¾¦ÉÊ¾ðÊó - ¤ªÌä¤¤¹ç¤ï¤»¾¦ÉÊÉ½¼¨ÀßÄê', configuration_description='¤ªÌä¤¤¹ç¤ï¤»¾¦ÉÊ¤Ç¤¢¤ë¤³¤È¤òÉ½¼¨¤¹¤ë²èÁü¤Þ¤¿¤Ï¥Æ¥­¥¹¥È¤Ë¤Ä¤¤¤ÆÀßÄê¤·¤Þ¤¹¡£<br /><br />\r\n¡¦0= ¥Æ¥­¥¹¥È<br />\r\n¡¦1= ²èÁü' WHERE configuration_key='PRODUCTS_PRICE_IS_CALL_IMAGE_ON';
UPDATE configuration SET configuration_title='¾¦ÉÊ¤Î¿ôÎÌÍó - ¿·¤·¤¯¾¦ÉÊ¤òÄÉ²Ã¤¹¤ëºÝ¤Ë', configuration_description='¿·¤·¤¯¾¦ÉÊ¤òÅÐÏ¿¤¹¤ëºÝ¡¢¾¦ÉÊ¤Î¿ôÎÌÍó¤Î¥Ç¥Õ¥©¥ë¥ÈÀßÄê¤ò¤É¤¦¤·¤Þ¤¹¤«?<br /><br />\r\n¡¦0= off<br />\r\n¡¦1= on<br />\r\nÃí°Õ¡§on¤Ë¤¹¤ë¤È¿ôÎÌÍó¤òÉ½¼¨¤·¡¢¡Ö¥«¡¼¥È¤Ë²Ã¤¨¤ë¡×¤âon¤Ë¤Ê¤ê¤Þ¤¹¡£(This will show a Qty Box when ON and default the Add to Cart to 1)' WHERE configuration_key='PRODUCTS_QTY_BOX_STATUS';
UPDATE configuration SET configuration_title='¾¦ÉÊ¥ì¥Ó¥å¡¼ - ¾µÇ§¤ÎÍ×ÈÝ', configuration_description='¾¦ÉÊ¥ì¥Ó¥å¡¼¤ÎÉ½¼¨¤Ë¤Ï¾µÇ§¤¬É¬Í×¤Ë¤·¤Þ¤¹¤«?<br /><br />\r\n¡¦0= off<br />\r\n¡¦1= on<br />\r\nÃí°Õ¡§¥ì¥Ó¥å¡¼¤¬ÈóÉ½¼¨ÀßÄê¤Ë¤Ê¤Ã¤Æ¤¤¤ë¾ì¹ç¤ÏÌµ»ë¤µ¤ì¤Þ¤¹¡£' WHERE configuration_key='REVIEWS_APPROVAL';
UPDATE configuration SET configuration_title='META¥¿¥° - TITLE¥¿¥°¤Ø¤Î¾¦ÉÊ²Á³ÊÉ½¼¨', configuration_description='TITLE¥¿¥°¤Ë¾¦ÉÊ²Á³Ê¤òÉ½¼¨¤·¤Þ¤¹¤«?<br />\r\n<br />\r\n¡¦0= off<br />\r\n¡¦1= on' WHERE configuration_key='META_TAG_INCLUDE_PRICE';
UPDATE configuration SET configuration_title='META¥¿¥° - Meta Description¤ÎÄ¹¤µ', configuration_description='Meta Description¤ÎºÇÂç¤ÎÄ¹¤µ¤òÀßÄê¤·¤Æ¤¯¤À¤µ¤¤¡£<br />¥Ç¥Õ¥©¥ë¥È¤ÎºÇÂçÃÍ(¥ï¡¼¥É¿ô)¡§50' WHERE configuration_key='MAX_META_TAG_DESCRIPTION_LENGTH';
UPDATE configuration SET configuration_title='¡Ö¤³¤ó¤Ê¾¦ÉÊ¤â¹ØÆþ¤·¤Æ¤¤¤Þ¤¹¡× - ²£Îó¤¢¤¿¤ê¤ÎÉ½¼¨ÅÀ¿ô', configuration_description='¡Ö¤³¤ó¤Ê¾¦ÉÊ¤âÇã¤Ã¤Æ¤¤¤Þ¤¹¡×¤Î²£Îó(Row)¤¢¤¿¤ê¤ÎÉ½¼¨ÅÀ¿ô¤òÀßÄê¤·¤Þ¤¹¡£<br />0= off ¤Þ¤¿¤Ï¥½¡¼¥È½ç¤òÀßÄê' WHERE configuration_key='SHOW_PRODUCT_INFO_COLUMNS_ALSO_PURCHASED_PRODUCTS';
UPDATE configuration SET configuration_title='[Á°¤Ø] [¼¡¤Ø] - ¥Ê¥Ó¥²¡¼¥·¥ç¥ó¥Ð¡¼¤Î°ÌÃÖ', configuration_description='[Á°¤Ø] [¼¡¤Ø] ¥Ê¥Ó¥²¡¼¥·¥ç¥ó¥Ð¡¼¤Î°ÌÃÖ¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />\r\n¡¦0= off<br />\r\n¡¦1= ¥Ú¡¼¥¸¾åÉô<br />\r\n¡¦2= ¥Ú¡¼¥¸²¼Éô<br />\r\n¡¦3= ¥Ú¡¼¥¸¾åÉô¡¦²¼Éô' WHERE configuration_key='PRODUCT_INFO_PREVIOUS_NEXT';
UPDATE configuration SET configuration_title='[Á°¤Ø] [¼¡¤Ø] - ¥½¡¼¥È½ç', configuration_description='¾¦ÉÊ¤Î¥½¡¼¥È½ç¤òÀßÄê¤·¤Þ¤¹¡£\r\n<br /><br />\r\n¡¦0= ¾¦ÉÊID<br />\r\n¡¦1= ¾¦ÉÊÌ¾<br />\r\n¡¦2= ·¿ÈÖ<br />\r\n¡¦3= ²Á³Ê¡¢¾¦ÉÊÌ¾<br />\r\n¡¦4= ²Á³Ê¡¢·¿ÈÖ<br />\r\n¡¦5= ¾¦ÉÊÌ¾, ·¿ÈÖ' WHERE configuration_key='PRODUCT_INFO_PREVIOUS_NEXT_SORT';
UPDATE configuration SET configuration_title='[Á°¤Ø] [¼¡¤Ø] - ¥Ü¥¿¥ó¤È²èÁü¤Î¥¹¥Æ¡¼¥¿¥¹', configuration_description='¥Ü¥¿¥ó¤È²èÁü¤Î¥¹¥Æ¡¼¥¿¥¹¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />\r\n¡¦0= Off<br />\r\n¡¦1= On' WHERE configuration_key='SHOW_PREVIOUS_NEXT_STATUS';
UPDATE configuration SET configuration_title='[Á°¤Ø] [¼¡¤Ø] - ¥Ü¥¿¥ó¤È²èÁü¤ÎÉ½¼¨ÀßÄê', configuration_description='[Á°¤Ø] [¼¡¤Ø] ¤Î¥Ü¥¿¥ó¤È²èÁü¤ÎÉ½¼¨¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />\r\n¡¦0= ¥Ü¥¿¥ó¤Î¤ß<br />\r\n¡¦1= ¥Ü¥¿¥ó¡¦¾¦ÉÊ²èÁü<br />\r\n¡¦2= ¾¦ÉÊ²èÁü¤Î¤ß' WHERE configuration_key='SHOW_PREVIOUS_NEXT_IMAGES';
UPDATE configuration SET configuration_title='[Á°¤Ø] [¼¡¤Ø] - ²èÁü¤Î²£Éý', configuration_description='[Á°¤Ø] [¼¡¤Ø] ²èÁü¤Î²£Éý¤Î²£Éý¤Ï?' WHERE configuration_key='PREVIOUS_NEXT_IMAGE_WIDTH';
UPDATE configuration SET configuration_title='[Á°¤Ø] [¼¡¤Ø] - ²èÁü¤Î¹â¤µ', configuration_description='[Á°¤Ø] [¼¡¤Ø] ²èÁü¤Î²£Éý¤Î¹â¤µ¤Ï?' WHERE configuration_key='PREVIOUS_NEXT_IMAGE_HEIGHT';
UPDATE configuration SET configuration_title='[Á°¤Ø] [¼¡¤Ø] - ¥«¥Æ¥´¥êÌ¾¤È²èÁü¤ÎÇÛÃÖ', configuration_description='[Á°¤Ø] [¼¡¤Ø] ¤Î¥«¥Æ¥´¥ê¤Î²èÁü¤ÈÌ¾¾Î¤ÎÇÛÃÖ¤Ï?<br /><br />\r\n¡¦0= off<br />\r\n¡¦1= º¸¤ËÇÛÃÖ<br />\r\n¡¦2= Ãæ±û¤ËÇÛÃÖ<br />\r\n¡¦3= ±¦¤ËÇÛÃÖ' WHERE configuration_key='PRODUCT_INFO_CATEGORIES';
UPDATE configuration SET configuration_title='º¸Â¦¥µ¥¤¥É¥Ü¥Ã¥¯¥¹¤Î²£Éý', configuration_description='º¸Â¦¤ËÉ½¼¨¤µ¤ì¤ë¥µ¥¤¥É¥Ü¥Ã¥¯¥¹¤Î²£Éý¤òÀßÄê¤·¤Þ¤¹¡£px¤ò´Þ¤á¤ÆÆþÎÏ¤Ç¤­¤Þ¤¹¡£\r\n<br /><br />\r\n¡¦¥Ç¥Õ¥©¥ë¥È = 150px' WHERE configuration_key='BOX_WIDTH_LEFT';
UPDATE configuration SET configuration_title='±¦Â¦¥µ¥¤¥É¥Ü¥Ã¥¯¥¹¤Î²£Éý', configuration_description='±¦Â¦¤ËÉ½¼¨¤µ¤ì¤ë¥µ¥¤¥É¥Ü¥Ã¥¯¥¹¤Î²£Éý¤òÀßÄê¤·¤Þ¤¹¡£px¤ò´Þ¤á¤ÆÆþÎÏ¤Ç¤­¤Þ¤¹¡£<br /><br />\r\n¡¦Default = 150px' WHERE configuration_key='BOX_WIDTH_RIGHT';
UPDATE configuration SET configuration_title='¥Ñ¥ó¶ý¥ê¥¹¥È¤Î¶èÀÚ¤êÊ¸»ú', configuration_description='¥Ñ¥ó¶ý¥ê¥¹¥È¤Î¶èÀÚ¤êÊ¸»ú¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />\r\n¡ÚÃí°Õ¡Û¶õÇò¤ò´Þ¤à¾ì¹ç¤Ï&amp;nbsp;¤ò»ÈÍÑ¤¹¤ë¤³¤È¤¬¤Ç¤­¤Þ¤¹¡£<br />\r\n¡¦¥Ç¥Õ¥©¥ë¥È = &amp;nbsp;::&amp;nbsp;' WHERE configuration_key='BREAD_CRUMBS_SEPARATOR';
UPDATE configuration SET configuration_title='¥Ñ¥ó¶ý¥ê¥¹¥È¤ÎÀßÄê', configuration_description='¥Ñ¥ó¶ý¥ê¥¹¥È¤Î¥ê¥ó¥¯¤òÍ­¸ú¤Ë¤·¤Þ¤¹¤«?<br />0= OFF<br />1= ON' WHERE configuration_key='DEFINE_BREADCRUMB_STATUS';
UPDATE configuration SET configuration_title='¥Ù¥¹¥È¥»¥é¡¼ - ·å¿ô¹ç¤ï¤»Ê¸»ú', configuration_description='·å¿ô¤ò¹ç¤ï¤»¤ë¤¿¤á¤ËÁÞÆþ¤¹¤ëÊ¸»ú¤òÀßÄê¤·¤Þ¤¹¡£<br />¥Ç¥Õ¥©¥ë¥È = &amp;nbsp;(¶õÇò)' WHERE configuration_key='BEST_SELLERS_FILLER';
UPDATE configuration SET configuration_title='¥Ù¥¹¥È¥»¥é¡¼ - É½¼¨Ê¸»ú¿ô', configuration_description='¥Ù¥¹¥È¥»¥é¡¼¤Î¥µ¥¤¥É¥Ü¥Ã¥¯¥¹¤ÇÉ½¼¨¤¹¤ë¾¦ÉÊÌ¾¤ÎÄ¹¤µ¤òÀßÄê¤·¤Þ¤¹¡£<br />¥Ç¥Õ¥©¥ë¥È = 35' WHERE configuration_key='BEST_SELLERS_TRUNCATE';
UPDATE configuration SET configuration_title='¥Ù¥¹¥È¥»¥é¡¼ - É½¼¨Ê¸»ú¿ô¤òÄ¶¤¨¤¿¾ì¹ç¤Ë¡Ö...¡×¤òÉ½¼¨', configuration_description='¾¦ÉÊÌ¾¤¬ÅÓÃæ¤ÇÀÚ¤ì¤¿¾ì¹ç¤Ë¡Ö...¡×¤òÉ½¼¨¤·¤Þ¤¹¡£<br />¥Ç¥Õ¥©¥ë¥È = true' WHERE configuration_key='BEST_SELLERS_TRUNCATE_MORE';
UPDATE configuration SET configuration_title='¥«¥Æ¥´¥ê¥Ü¥Ã¥¯¥¹ - ÆÃ²Á¾¦ÉÊ¤Î¥ê¥ó¥¯É½¼¨', configuration_description='¥«¥Æ¥´¥ê¥Ü¥Ã¥¯¥¹¤ËÆÃ²Á¾¦ÉÊ¤Î¥ê¥ó¥¯¤òÉ½¼¨¤·¤Þ¤¹¡£' WHERE configuration_key='SHOW_CATEGORIES_BOX_SPECIALS';
UPDATE configuration SET configuration_title='¥«¥Æ¥´¥ê¥Ü¥Ã¥¯¥¹ - ¿·Ãå¾¦ÉÊ¤Î¥ê¥ó¥¯É½¼¨', configuration_description='¥«¥Æ¥´¥ê¥Ü¥Ã¥¯¥¹¤Ë¿·Ãå¾¦ÉÊ¤Ø¤Î¥ê¥ó¥¯¤òÉ½¼¨¤·¤Þ¤¹¡£' WHERE configuration_key='SHOW_CATEGORIES_BOX_PRODUCTS_NEW';
UPDATE configuration SET configuration_title='¥·¥ç¥Ã¥Ô¥ó¥°¥«¡¼¥È¥Ü¥Ã¥¯¥¹¤ÎÉ½¼¨', configuration_description='¥·¥ç¥Ã¥Ô¥ó¥°¥«¡¼¥È¤ÎÉ½¼¨¤òÀßÄê¤·¤Þ¤¹¡£<br />\r\n<br />\r\n¡¦0= ¾ï¤ËÉ½¼¨<br />\r\n¡¦1= ¾¦ÉÊ¤¬Æþ¤Ã¤Æ¤¤¤ë¤È¤­¤À¤±É½¼¨<br />\r\n¡¦2= ¾¦ÉÊ¤¬Æþ¤Ã¤Æ¤¤¤ë¤È¤­¤ËÉ½¼¨¤¹¤ë¤¬¡¢¥·¥ç¥Ã¥Ô¥ó¥°¥«¡¼¥È¥Ú¡¼¥¸¤Ç¤ÏÉ½¼¨¤·¤Ê¤¤' WHERE configuration_key='SHOW_SHOPPING_CART_BOX_STATUS';
UPDATE configuration SET configuration_title='¥«¥Æ¥´¥ê¥Ü¥Ã¥¯¥¹ - ¤ª¤¹¤¹¤á¾¦ÉÊ¤Ø¤Î¥ê¥ó¥¯¤òÉ½¼¨', configuration_description='¥«¥Æ¥´¥ê¥Ü¥Ã¥¯¥¹¤Ë¤ª¤¹¤¹¤á¾¦ÉÊ¤Ø¤Î¥ê¥ó¥¯¤òÉ½¼¨¤·¤Þ¤¹¤«?' WHERE configuration_key='SHOW_CATEGORIES_BOX_FEATURED_PRODUCTS';
UPDATE configuration SET configuration_title='¥«¥Æ¥´¥ê¥Ü¥Ã¥¯¥¹ - Á´¾¦ÉÊ¥ê¥¹¥È¤Ø¤Î¥ê¥ó¥¯¤òÉ½¼¨', configuration_description='¥«¥Æ¥´¥ê¥Ü¥Ã¥¯¥¹¤ËÁ´¾¦ÉÊ¥ê¥¹¥È¤Ø¤Î¥ê¥ó¥¯¤òÉ½¼¨¤·¤Þ¤¹¤«?' WHERE configuration_key='SHOW_CATEGORIES_BOX_PRODUCTS_ALL';
UPDATE configuration SET configuration_title='º¸Â¦¥«¥é¥à¤ÎÉ½¼¨', configuration_description='º¸Â¦¥«¥é¥à¤òÉ½¼¨¤·¤Þ¤¹¤«? (¥Ú¡¼¥¸¤ò¥ª¡¼¥Ð¡¼¥é¥¤¥É¤¹¤ë¤â¤Î¤¬¤Ê¤¤¾ì¹ç)<br /><br />\r\n¡¦0= ¾ï¤ËÈóÉ½¼¨<br />\r\n1= ¥ª¡¼¥Ð¡¼¥é¥¤¥É¤¬¤Ê¤±¤ì¤ÐÉ½¼¨' WHERE configuration_key='COLUMN_LEFT_STATUS';
UPDATE configuration SET configuration_title='±¦Â¦¥«¥é¥à¤ÎÉ½¼¨', configuration_description='±¦Â¦¥«¥é¥à¤òÉ½¼¨¤·¤Þ¤¹¤«? (¥Ú¡¼¥¸¤ò¥ª¡¼¥Ð¡¼¥é¥¤¥É¤¹¤ë¤â¤Î¤¬¤Ê¤¤¾ì¹ç)<br /><br />\r\n¡¦0= ¾ï¤ËÈóÉ½¼¨<br />\r\n¡¦1= ¥ª¡¼¥Ð¡¼¥é¥¤¥É¤¬¤Ê¤±¤ì¤ÐÉ½¼¨' WHERE configuration_key='COLUMN_RIGHT_STATUS';
UPDATE configuration SET configuration_title='º¸Â¦¥«¥é¥à¤Î²£Éý', configuration_description='º¸Â¦¥«¥é¥à¤Î²£Éý¤òÀßÄê¤·¤Þ¤¹¡£px¤ò´Þ¤á¤Æ»ØÄê²ÄÇ½¡£<br /><br />\r\n¥Ç¥Õ¥©¥ë¥È = 150px' WHERE configuration_key='COLUMN_WIDTH_LEFT';
UPDATE configuration SET configuration_title='±¦Â¦¥«¥é¥à¤Î²£Éý', configuration_description='±¦Â¦¥«¥é¥à¤Î²£Éý¤òÀßÄê¤·¤Þ¤¹¡£px¤ò´Þ¤á¤Æ»ØÄê²ÄÇ½¡£<br /><br />\r\n¥Ç¥Õ¥©¥ë¥È = 150px' WHERE configuration_key='COLUMN_WIDTH_RIGHT';
UPDATE configuration SET configuration_title='¥«¥Æ¥´¥êÌ¾¡¦¥ê¥ó¥¯´Ö¤Î¶èÀÚ¤ê', configuration_description='¥«¥Æ¥´¥êÌ¾¤È¥ê¥ó¥¯¡Ê¡Ö¤ª¤¹¤¹¤á¾¦ÉÊ¡×¤Ê¤É¡Ë¤Î´Ö¤Ë¥»¥Ñ¥ì¡¼¥¿(¶èÀÚ¤ê)¤òÉ½¼¨¤·¤Þ¤¹¤«?<br /><br />\r\n¡¦0= off<br />\r\n¡¦1= on' WHERE configuration_key='SHOW_CATEGORIES_SEPARATOR_LINK';
UPDATE configuration SET configuration_title='¥«¥Æ¥´¥ê¤Î¶èÀÚ¤ê - ¥«¥Æ¥´¥êÌ¾¡¦¾¦ÉÊ¿ô', configuration_description='¥«¥Æ¥´¥êÌ¾¤È(¥«¥Æ¥´¥êÆâ¤Î)¾¦ÉÊ¿ô¤Î´Ö¤Î¥»¥Ñ¥ì¡¼¥¿(¶èÀÚ¤ê)¤Ï²¿¤Ë¤·¤Þ¤¹¤«?<br /><br />\r\n¥Ç¥Õ¥©¥ë¥È = -&amp;gt;' WHERE configuration_key='CATEGORIES_SEPARATOR';
UPDATE configuration SET configuration_title='¥«¥Æ¥´¥ê¤Î¶èÀÚ¤ê - ¥«¥Æ¥´¥êÌ¾¤È¥µ¥Ö¥«¥Æ¥´¥êÌ¾¤Î´Ö', configuration_description='¥«¥Æ¥´¥êÌ¾¡¦¥µ¥Ö¥«¥Æ¥´¥êÌ¾¤Î´Ö¤Î¥»¥Ñ¥ì¡¼¥¿(¶èÀÚ¤ê)¤Ï²¿¤Ë¤·¤Þ¤¹¤«?<br />\r\n<br />\r\n¥Ç¥Õ¥©¥ë¥È = |_&amp;nbsp;' WHERE configuration_key='CATEGORIES_SEPARATOR_SUBS';
UPDATE configuration SET configuration_title='¥«¥Æ¥´¥êÆâ¾¦ÉÊ¿ô¤ÎÀÜÆ¬¼­(Prefix)', configuration_description='¥«¥Æ¥´¥êÆâ¤Î¾¦ÉÊ¿ôÉ½¼¨¤ÎÀÜÆ¬¼­(Prefix)¤Ï?\r\n<br /><br />\r\n¡¦¥Ç¥Õ¥©¥ë¥È= (' WHERE configuration_key='CATEGORIES_COUNT_PREFIX';
UPDATE configuration SET configuration_title='¥«¥Æ¥´¥êÆâ¾¦ÉÊ¿ô¤ÎÀÜÈø¼­(Suffix)', configuration_description='¥«¥Æ¥´¥êÆâ¤Î¾¦ÉÊ¿ôÉ½¼¨¤ÎÀÜÈø¼­(Suffix)¤Ï?\r\n<br /><br />\r\n¡¦¥Ç¥Õ¥©¥ë¥È= )' WHERE configuration_key='CATEGORIES_COUNT_SUFFIX';
UPDATE configuration SET configuration_title='¥«¥Æ¥´¥ê¡¦¥µ¥Ö¥«¥Æ¥´¥ê¤Î¥¤¥ó¥Ç¥ó¥È', configuration_description='¥µ¥Ö¥«¥Æ¥´¥ê¤ò¥¤¥ó¥Ç¥ó¥È(»ú²¼¤²)É½¼¨¤¹¤ëºÝ¤ÎÊ¸»ú¡¦µ­¹æ¤Ï?<br /><br />\r\n¡¦¥Ç¥Õ¥©¥ë¥È = &nbsp;&nbsp;' WHERE configuration_key='CATEGORIES_SUBCATEGORIES_INDENT';
UPDATE configuration SET configuration_title='¾¦ÉÊÅÐÏ¿0¤Î¥«¥Æ¥´¥ê - É½¼¨¡¦ÈóÉ½¼¨', configuration_description='¾¦ÉÊ¿ô¤¬0¤Î¥«¥Æ¥´¥ê¤òÉ½¼¨¤·¤Þ¤¹¤«?<br />\r\n<br />\r\n¡¦0 = off<br />\r\n¡¦1 = on' WHERE configuration_key='CATEGORIES_COUNT_ZERO';
UPDATE configuration SET configuration_title='¥«¥Æ¥´¥ê¥Ü¥Ã¥¯¥¹¤Î¥¹¥×¥ê¥Ã¥È(Ê¬³ä)É½¼¨', configuration_description='¾¦ÉÊ¥¿¥¤¥×¤Ë¤è¤Ã¤Æ¥«¥Æ¥´¥ê¥Ü¥Ã¥¯¥¹¤ò¥¹¥×¥ê¥Ã¥È(Ê¬³ä)É½¼¨¤¹¤ë¤«¤É¤¦¤«¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='CATEGORIES_SPLIT_DISPLAY';
UPDATE configuration SET configuration_title='¥·¥ç¥Ã¥Ô¥ó¥°¥«¡¼¥È - ¹ç·×¤òÉ½¼¨', configuration_description='¹ç·×³Û¤ò¥·¥ç¥Ã¥Ô¥ó¥°¥«¡¼¥È¤Î¾å¤ËÉ½¼¨¤·¤Þ¤¹¤«?<br />¡¦0= off<br />¡¦1= on: ¾¦ÉÊ¤Î¿ôÎÌ¡¢½ÅÎÌ¹ç·×<br />¡¦2= on: ¾¦ÉÊ¤Î¿ôÎÌ¡¢½ÅÎÌ¹ç·×(0¤Î¤È¤­¤Ë¤ÏÈóÉ½¼¨)<br />¡¦3= on: ¾¦ÉÊ¤Î¿ôÎÌ¹ç·×' WHERE configuration_key='SHOW_TOTALS_IN_CART';
UPDATE configuration SET configuration_title='¸ÜµÒ¤Ø¤Î°§»¢ - ¥È¥Ã¥×¥Ú¡¼¥¸¤ËÉ½¼¨', configuration_description='¸ÜµÒ¤Ø¤Î´¿·Þ¥á¥Ã¥»¡¼¥¸¤ò¾ï¤Ë¥È¥Ã¥×¥Ú¡¼¥¸¤ËÉ½¼¨¤·¤Þ¤¹¤«?<br />0= off<br />1= on' WHERE configuration_key='SHOW_CUSTOMER_GREETING';
UPDATE configuration SET configuration_title='¥«¥Æ¥´¥ê - ¥È¥Ã¥×¥Ú¡¼¥¸¤ËÉ½¼¨', configuration_description='¥«¥Æ¥´¥ê¤ò¾ï¤Ë¥È¥Ã¥×¥Ú¡¼¥¸¤ËÉ½¼¨¤·¤Þ¤¹¤«?<br />\r\n¡¦0= off<br />\r\n¡¦1= on<br />\r\n¡¦Default category can be set to Top Level or a Specific Top Level' WHERE configuration_key='SHOW_CATEGORIES_ALWAYS';
UPDATE configuration SET configuration_title='¥«¥Æ¥´¥ê - ¥È¥Ã¥×¥Ú¡¼¥¸ ¤Ç¤Î³«ÊÄ', configuration_description='¥È¥Ã¥×¥Ú¡¼¥¸¤Ë¤ª¤±¤ë¥«¥Æ¥´¥ê¤Î³«ÊÄ¾õÂÖ¤òÀßÄê¤·¤Þ¤¹¡£<br />\r\n¡¦0= ¥È¥Ã¥×¥ì¥Ù¥ë(¿Æ)¥«¥Æ¥´¥ê¤Î¤ß<br />\r\n¡¦ÆÃÄê¤Î¥«¥Æ¥´¥ê¤ò³«¤¯¤Ë¤Ï¥«¥Æ¥´¥êID¤Ç»ØÄê¡£¥µ¥Ö¥«¥Æ¥´¥ê¤â»ØÄê²ÄÇ½¡£<br />\r\n¡ÚÎã¡Û3_10 (¥«¥Æ¥´¥êID:3¡¢¥µ¥Ö¥«¥Æ¥´¥êID:10)' WHERE configuration_key='CATEGORIES_START_MAIN';
UPDATE configuration SET configuration_title='¥«¥Æ¥´¥ê - ¥µ¥Ö¥«¥Æ¥´¥ê¤ò¾ï¤Ë³«¤¤¤Æ¤ª¤¯', configuration_description='¥«¥Æ¥´¥ê¤È¥µ¥Ö¥«¥Æ¥´¥ê¤Ï¾ï¤ËÉ½¼¨¤·¤Þ¤¹¤«?<br />0= OFF ¿Æ¥«¥Æ¥´¥ê¤Î¤ß<br />1= ON ¥«¥Æ¥´¥ê¡¦¥µ¥Ö¥«¥Æ¥´¥ê¤ÏÁªÂò¤µ¤ì¤¿¤é¾ï¤ËÉ½¼¨' WHERE configuration_key='SHOW_CATEGORIES_SUBCATEGORIES_ALWAYS';
UPDATE configuration SET configuration_title='¥Ð¥Ê¡¼É½¼¨¥°¥ë¡¼¥× - ¥Ø¥Ã¥À¥Ý¥¸¥·¥ç¥ó1', configuration_description='¤É¤Î¥Ð¥Ê¡¼¥°¥ë¡¼¥×¤ò¥Ø¥Ã¥À¥Ý¥¸¥·¥ç¥ó1¤Ë»ÈÍÑ¤·¤Þ¤¹¤«? »È¤ï¤Ê¤¤¾ì¹ç¤ÏÌ¤µ­Æþ¤Ë¤·¤Þ¤¹¡£<br />\r\n<br />\r\n¥Ð¥Ê¡¼É½¼¨¥°¥ë¡¼¥×¤Ï1¤Ä(1¥Ð¥Ê¡¼¥°¥ë¡¼¥×)¤Þ¤¿¤ÏÊ£¿ô(¥Þ¥ë¥Á¥Ð¥Ê¡¼¥°¥ë¡¼¥×)¤Ë¤¹¤ë¤³¤È¤â¤Ç¤­¤Þ¤¹¡£¥Þ¥ë¥Á¥Ð¥Ê¡¼¥°¥ë¡¼¥×¤òÉ½¼¨¤¹¤ë¤¿¤á¤Ë¤Ï¥°¥ë¡¼¥×Ì¾¤ò¥³¥í¥ó(<strong>:</strong>)¤Ç¶èÀÚ¤Ã¤ÆÆþÎÏ¤·¤Þ¤¹¡£<br />\r\nÎã¡§Wide-Banners:SideBox-Banners' WHERE configuration_key='SHOW_BANNERS_GROUP_SET1';
UPDATE configuration SET configuration_title='¥Ð¥Ê¡¼É½¼¨¥°¥ë¡¼¥× - ¥Ø¥Ã¥À¥Ý¥¸¥·¥ç¥ó2', configuration_description='¤É¤Î¥Ð¥Ê¡¼¥°¥ë¡¼¥×¤ò¥Ø¥Ã¥À¥Ý¥¸¥·¥ç¥ó2¤Ë»ÈÍÑ¤·¤Þ¤¹¤«? »È¤ï¤Ê¤¤¾ì¹ç¤ÏÌ¤µ­Æþ¤Ë¤·¤Þ¤¹¡£<br />\r\n<br />\r\n¥Ð¥Ê¡¼É½¼¨¥°¥ë¡¼¥×¤Ï1¤Ä(1¥Ð¥Ê¡¼¥°¥ë¡¼¥×)¤Þ¤¿¤ÏÊ£¿ô(¥Þ¥ë¥Á¥Ð¥Ê¡¼¥°¥ë¡¼¥×)¤Ë¤¹¤ë¤³¤È¤â¤Ç¤­¤Þ¤¹¡£¥Þ¥ë¥Á¥Ð¥Ê¡¼¥°¥ë¡¼¥×¤òÉ½¼¨¤¹¤ë¤¿¤á¤Ë¤Ï¥°¥ë¡¼¥×Ì¾¤ò¥³¥í¥ó(<strong>:</strong>)¤Ç¶èÀÚ¤Ã¤ÆÆþÎÏ¤·¤Þ¤¹¡£<br />\r\nÎã¡§Wide-Banners:SideBox-Banners' WHERE configuration_key='SHOW_BANNERS_GROUP_SET2';
UPDATE configuration SET configuration_title='¥Ð¥Ê¡¼É½¼¨¥°¥ë¡¼¥× - ¥Ø¥Ã¥À¥Ý¥¸¥·¥ç¥ó3', configuration_description='¤É¤Î¥Ð¥Ê¡¼¥°¥ë¡¼¥×¤ò¥Ø¥Ã¥À¥Ý¥¸¥·¥ç¥ó3¤Ë»ÈÍÑ¤·¤Þ¤¹¤«? »È¤ï¤Ê¤¤¾ì¹ç¤ÏÌ¤µ­Æþ¤Ë¤·¤Þ¤¹¡£<br />\r\n<br />\r\n¥Ð¥Ê¡¼É½¼¨¥°¥ë¡¼¥×¤Ï1¤Ä(1¥Ð¥Ê¡¼¥°¥ë¡¼¥×)¤Þ¤¿¤ÏÊ£¿ô(¥Þ¥ë¥Á¥Ð¥Ê¡¼¥°¥ë¡¼¥×)¤Ë¤¹¤ë¤³¤È¤â¤Ç¤­¤Þ¤¹¡£¥Þ¥ë¥Á¥Ð¥Ê¡¼¥°¥ë¡¼¥×¤òÉ½¼¨¤¹¤ë¤¿¤á¤Ë¤Ï¥°¥ë¡¼¥×Ì¾¤ò¥³¥í¥ó(<strong>:</strong>)¤Ç¶èÀÚ¤Ã¤ÆÆþÎÏ¤·¤Þ¤¹¡£<br />\r\nÎã¡§Wide-Banners:SideBox-Banners' WHERE configuration_key='SHOW_BANNERS_GROUP_SET3';
UPDATE configuration SET configuration_title='¥Ð¥Ê¡¼É½¼¨¥°¥ë¡¼¥× - ¥Õ¥Ã¥¿¥Ý¥¸¥·¥ç¥ó1', configuration_description='¤É¤Î¥Ð¥Ê¡¼¥°¥ë¡¼¥×¤ò¥Õ¥Ã¥¿¥Ý¥¸¥·¥ç¥ó1¤Ë»ÈÍÑ¤·¤Þ¤¹¤«? »È¤ï¤Ê¤¤¾ì¹ç¤ÏÌ¤µ­Æþ¤Ë¤·¤Þ¤¹¡£<br />\r\n<br />\r\n¥Ð¥Ê¡¼É½¼¨¥°¥ë¡¼¥×¤Ï1¤Ä(1¥Ð¥Ê¡¼¥°¥ë¡¼¥×)¤Þ¤¿¤ÏÊ£¿ô(¥Þ¥ë¥Á¥Ð¥Ê¡¼¥°¥ë¡¼¥×)¤Ë¤¹¤ë¤³¤È¤â¤Ç¤­¤Þ¤¹¡£¥Þ¥ë¥Á¥Ð¥Ê¡¼¥°¥ë¡¼¥×¤òÉ½¼¨¤¹¤ë¤¿¤á¤Ë¤Ï¥°¥ë¡¼¥×Ì¾¤ò¥³¥í¥ó(<strong>:</strong>)¤Ç¶èÀÚ¤Ã¤ÆÆþÎÏ¤·¤Þ¤¹¡£<br />\r\nÎã¡§Wide-Banners:SideBox-Banners' WHERE configuration_key='SHOW_BANNERS_GROUP_SET4';
UPDATE configuration SET configuration_title='¥Ð¥Ê¡¼É½¼¨¥°¥ë¡¼¥× - ¥Õ¥Ã¥¿¥Ý¥¸¥·¥ç¥ó2', configuration_description='¤É¤Î¥Ð¥Ê¡¼¥°¥ë¡¼¥×¤ò¥Õ¥Ã¥¿¥Ý¥¸¥·¥ç¥ó2¤Ë»ÈÍÑ¤·¤Þ¤¹¤«? »È¤ï¤Ê¤¤¾ì¹ç¤ÏÌ¤µ­Æþ¤Ë¤·¤Þ¤¹¡£<br />\r\n<br />\r\n¥Ð¥Ê¡¼É½¼¨¥°¥ë¡¼¥×¤Ï1¤Ä(1¥Ð¥Ê¡¼¥°¥ë¡¼¥×)¤Þ¤¿¤ÏÊ£¿ô(¥Þ¥ë¥Á¥Ð¥Ê¡¼¥°¥ë¡¼¥×)¤Ë¤¹¤ë¤³¤È¤â¤Ç¤­¤Þ¤¹¡£¥Þ¥ë¥Á¥Ð¥Ê¡¼¥°¥ë¡¼¥×¤òÉ½¼¨¤¹¤ë¤¿¤á¤Ë¤Ï¥°¥ë¡¼¥×Ì¾¤ò¥³¥í¥ó(<strong>:</strong>)¤Ç¶èÀÚ¤Ã¤ÆÆþÎÏ¤·¤Þ¤¹¡£<br />\r\nÎã¡§Wide-Banners:SideBox-Banners' WHERE configuration_key='SHOW_BANNERS_GROUP_SET5';
UPDATE configuration SET configuration_title='¥Ð¥Ê¡¼É½¼¨¥°¥ë¡¼¥× - ¥Õ¥Ã¥¿¥Ý¥¸¥·¥ç¥ó3', configuration_description='¤É¤Î¥Ð¥Ê¡¼¥°¥ë¡¼¥×¤ò¥Õ¥Ã¥¿¥Ý¥¸¥·¥ç¥ó3¤Ë»ÈÍÑ¤·¤Þ¤¹¤«? »È¤ï¤Ê¤¤¾ì¹ç¤ÏÌ¤µ­Æþ¤Ë¤·¤Þ¤¹¡£<br />\r\n<br />\r\n¥Ð¥Ê¡¼É½¼¨¥°¥ë¡¼¥×¤Ï1¤Ä(1¥Ð¥Ê¡¼¥°¥ë¡¼¥×)¤Þ¤¿¤ÏÊ£¿ô(¥Þ¥ë¥Á¥Ð¥Ê¡¼¥°¥ë¡¼¥×)¤Ë¤¹¤ë¤³¤È¤â¤Ç¤­¤Þ¤¹¡£¥Þ¥ë¥Á¥Ð¥Ê¡¼¥°¥ë¡¼¥×¤òÉ½¼¨¤¹¤ë¤¿¤á¤Ë¤Ï¥°¥ë¡¼¥×Ì¾¤ò¥³¥í¥ó(<strong>:</strong>)¤Ç¶èÀÚ¤Ã¤ÆÆþÎÏ¤·¤Þ¤¹¡£<br />\r\nÎã¡§Wide-Banners:SideBox-Banners' WHERE configuration_key='SHOW_BANNERS_GROUP_SET6';
UPDATE configuration SET configuration_title='¥Ð¥Ê¡¼É½¼¨¥°¥ë¡¼¥× - ¥µ¥¤¥É¥Ü¥Ã¥¯¥¹Æâ¥Ð¥Ê¡¼¥Ü¥Ã¥¯¥¹', configuration_description='¤É¤Î¥Ð¥Ê¡¼¥°¥ë¡¼¥×¤ò¥µ¥¤¥É¥Ü¥Ã¥¯¥¹Æâ¥Ð¥Ê¡¼¥Ü¥Ã¥¯¥¹2¤Ë»ÈÍÑ¤·¤Þ¤¹¤«? »È¤ï¤Ê¤¤¾ì¹ç¤ÏÌ¤µ­Æþ¤Ë¤·¤Þ¤¹¡£<br />\r\n¥Ç¥Õ¥©¥ë¥È¤Î¥°¥ë¡¼¥×¤ÏSideBox-Banners¤Ç¤¹¡£<br />\r\n<br />\r\n¥Ð¥Ê¡¼É½¼¨¥°¥ë¡¼¥×¤Ï1¤Ä(1¥Ð¥Ê¡¼¥°¥ë¡¼¥×)¤Þ¤¿¤ÏÊ£¿ô(¥Þ¥ë¥Á¥Ð¥Ê¡¼¥°¥ë¡¼¥×)¤Ë¤¹¤ë¤³¤È¤â¤Ç¤­¤Þ¤¹¡£¥Þ¥ë¥Á¥Ð¥Ê¡¼¥°¥ë¡¼¥×¤òÉ½¼¨¤¹¤ë¤¿¤á¤Ë¤Ï¥°¥ë¡¼¥×Ì¾¤ò¥³¥í¥ó(<strong>:</strong>)¤Ç¶èÀÚ¤Ã¤ÆÆþÎÏ¤·¤Þ¤¹¡£<br />\r\nÎã¡§Wide-Banners:SideBox-Banners' WHERE configuration_key='SHOW_BANNERS_GROUP_SET7';
UPDATE configuration SET configuration_title='¥Ð¥Ê¡¼É½¼¨¥°¥ë¡¼¥× - ¥µ¥¤¥É¥Ü¥Ã¥¯¥¹Æâ¥Ð¥Ê¡¼¥Ü¥Ã¥¯¥¹2', configuration_description='¤É¤Î¥Ð¥Ê¡¼¥°¥ë¡¼¥×¤ò¥µ¥¤¥É¥Ü¥Ã¥¯¥¹Æâ¥Ð¥Ê¡¼¥Ü¥Ã¥¯¥¹2¤Ë»ÈÍÑ¤·¤Þ¤¹¤«? »È¤ï¤Ê¤¤¾ì¹ç¤ÏÌ¤µ­Æþ¤Ë¤·¤Þ¤¹¡£<br />\r\n¥Ç¥Õ¥©¥ë¥È¤Î¥°¥ë¡¼¥×¤ÏSideBox-Banners¤Ç¤¹¡£<br />\r\n<br />\r\n¥Ð¥Ê¡¼É½¼¨¥°¥ë¡¼¥×¤Ï1¤Ä(1¥Ð¥Ê¡¼¥°¥ë¡¼¥×)¤Þ¤¿¤ÏÊ£¿ô(¥Þ¥ë¥Á¥Ð¥Ê¡¼¥°¥ë¡¼¥×)¤Ë¤¹¤ë¤³¤È¤â¤Ç¤­¤Þ¤¹¡£¥Þ¥ë¥Á¥Ð¥Ê¡¼¥°¥ë¡¼¥×¤òÉ½¼¨¤¹¤ë¤¿¤á¤Ë¤Ï¥°¥ë¡¼¥×Ì¾¤ò¥³¥í¥ó(<strong>:</strong>)¤Ç¶èÀÚ¤Ã¤ÆÆþÎÏ¤·¤Þ¤¹¡£<br />\r\nÎã¡§Wide-Banners:SideBox-Banners' WHERE configuration_key='SHOW_BANNERS_GROUP_SET8';
UPDATE configuration SET configuration_title='¥Ð¥Ê¡¼É½¼¨¥°¥ë¡¼¥× - ¥µ¥¤¥É¥Ü¥Ã¥¯¥¹Æâ¥Ð¥Ê¡¼¥Ü¥Ã¥¯¥¹Á´¤Æ', configuration_description='¥µ¥¤¥É¥Ü¥Ã¥¯¥¹Æâ¥Ð¥Ê¡¼¥Ü¥Ã¥¯¥¹Á´¤Æ(Banner All sidebox)¤ÇÉ½¼¨¤¹¤ë¥Ð¥Ê¡¼É½¼¨¥°¥ë¡¼¥×¤Ï¡¢1¤Ä¤Ç¤¹¡£¥Ç¥Õ¥©¥ë¥È¤Î¥°¥ë¡¼¥×¤ÏBannersAll¤Ç¤¹¡£¤É¤Î¥Ð¥Ê¡¼¥°¥ë¡¼¥×¤ò¥µ¥¤¥É¥Ü¥Ã¥¯¥¹¤Îbanner_box_all¤ËÉ½¼¨¤·¤Þ¤¹¤«?<br />É½¼¨¤·¤Ê¤¤¾ì¹ç¤Ï¶õÍó¤Ë¤·¤Æ¤¯¤À¤µ¤¤¡£' WHERE configuration_key='SHOW_BANNERS_GROUP_SET_ALL';
UPDATE configuration SET configuration_title='¥Õ¥Ã¥¿ - IP¥¢¥É¥ì¥¹¤ÎÉ½¼¨¡¦ÈóÉ½¼¨', configuration_description='¸ÜµÒ¤ÎIP¥¢¥É¥ì¥¹¤ò¥Õ¥Ã¥¿¤ËÉ½¼¨¤·¤Þ¤¹¤«?<br />\r\n<br />\r\n¡¦0= off<br />\r\n¡¦1= on<br />' WHERE configuration_key='SHOW_FOOTER_IP';
UPDATE configuration SET configuration_title='¿ôÎÌ³ä°ú - ÄÉ²Ã³ä°ú¥ì¥Ù¥ë¿ô', configuration_description='¿ôÎÌ³ä°ú¤Î³ä°ú¥ì¥Ù¥ë¤ÎÄÉ²Ã¿ô¤ò»ØÄê¤·¤Þ¤¹¡£°ì¤Ä¤Î³ä°ú¥ì¥Ù¥ë¤Ë°ì¤Ä¤Î³ä°úÀßÄê¤ò¹Ô¤¦¤³¤È¤¬¤Ç¤­¤Þ¤¹¡£' WHERE configuration_key='DISCOUNT_QTY_ADD';
UPDATE configuration SET configuration_title='¿ôÎÌ³ä°ú - °ì¹Ô¤¢¤¿¤ê¤ÎÉ½¼¨¿ô', configuration_description='¾¦ÉÊ¾ðÊó¥Ú¡¼¥¸¤ÇÉ½¼¨¤¹¤ë¿ôÎÌ³ä°úÀßÄê¤Î°ì¹Ô¤¢¤¿¤êÉ½¼¨¿ô¤ò»ØÄê¤·¤Þ¤¹¡£³ä°úÀßÄê¿ô¡Ê³ä°ú¥ì¥Ù¥ë¿ô¡Ë¤¬°ì¹Ô¤¢¤¿¤ê¤ÎÉ½¼¨¿ô¤òÄ¶¤¨¤¿¾ì¹ç¤Ï¡¢Ê£¿ô¹Ô¤ÇÉ½¼¨¤µ¤ì¤Þ¤¹¡£' WHERE configuration_key='DISCOUNT_QUANTITY_PRICES_COLUMN';
UPDATE configuration SET configuration_title='¥«¥Æ¥´¥ê/¾¦ÉÊ¤Î¥½¡¼¥È½ç', configuration_description='¥«¥Æ¥´¥ê/¾¦ÉÊ¤Î¥½¡¼¥È½ç¤òÀßÄê¤·¤Þ¤¹¡£<br />0= ¥«¥Æ¥´¥ê/¾¦ÉÊ ¥½¡¼¥È½ç/Ì¾Á°<br />1= ¥«¥Æ¥´¥ê/¾¦ÉÊ Ì¾Á°<br />2= ¾¦ÉÊ¥â¥Ç¥ë<br />3= ¾¦ÉÊ¿ôÎÌ+, ¾¦ÉÊÌ¾<br />4= ¾¦ÉÊ¿ôÎÌ-, ¾¦ÉÊÌ¾<br />5= ¾¦ÉÊ²Á³Ê+, ¾¦ÉÊÌ¾<br />6= ¾¦ÉÊ²Á³Ê+, ¾¦ÉÊÌ¾' WHERE configuration_key='CATEGORIES_PRODUCTS_SORT_ORDER';
UPDATE configuration SET configuration_title='¥ª¥×¥·¥ç¥óÌ¾/¥ª¥×¥·¥ç¥óÃÍ¤ÎÄÉ²Ã¡¦¥³¥Ô¡¼¡¦ºï½ü', configuration_description='¥ª¥×¥·¥ç¥óÌ¾/¥ª¥×¥·¥ç¥óÃÍ¤ÎÄÉ²Ã¡¦¥³¥Ô¡¼¡¦ºï½ü¤Îµ¡Ç½¤Ë¤Ä¤¤¤Æ¤Î¥°¥í¡¼¥Ð¥ë¤ÊÀßÄê¤ò¹Ô¤¤¤Þ¤¹¡£<br />0= µ¡Ç½¤ò±£¤¹<br />1= µ¡Ç½¤òÉ½¼¨¤¹¤ë<br />2= ¾¦ÉÊ¥â¥Ç¥ë' WHERE configuration_key='OPTION_NAMES_VALUES_GLOBAL_STATUS';
UPDATE configuration SET configuration_title='¥«¥Æ¥´¥ê - ¥¿¥Ö¥á¥Ë¥å¡¼', configuration_description='¥«¥Æ¥´¥ê - ¥¿¥Ö¤ò¥ª¥ó¤Ë¤¹¤ë¤È¥·¥ç¥Ã¥×²èÌÌ¤Î¥Ø¥Ã¥ÀÉôÊ¬¤Ë¥«¥Æ¥´¥ê¤¬É½¼¨¤µ¤ì¤Þ¤¹¡£¤µ¤Þ¤¶¤Þ¤Ê±þÍÑ¤¬¤Ç¤­¤ë¤Ç¤·¤ç¤¦¡£<br />0= ¥«¥Æ¥´¥ê¤Î¥¿¥Ö¤ò±£¤¹<br />1= ¥«¥Æ¥´¥ê¤Î¥¿¥Ö¤òÉ½¼¨' WHERE configuration_key='CATEGORIES_TABS_STATUS';
UPDATE configuration SET configuration_title='¥µ¥¤¥È¥Þ¥Ã¥× - My¥Ú¡¼¥¸¤ÎÉ½¼¨', configuration_description='My¥Ú¡¼¥¸¤Î¥ê¥ó¥¯¤ò¥µ¥¤¥È¥Þ¥Ã¥×¤ËÉ½¼¨¤·¤Þ¤¹¤«?<br />Ãí°Õ¡§¥µ¡¼¥Á¥¨¥ó¥¸¥ó¤Î¥¯¥í¡¼¥é¡¼¤¬¤³¤Î¥Ú¡¼¥¸¤ò¥¤¥ó¥Ç¥Ã¥¯¥¹¤·¤è¤¦¤È¤·¤Æ¥í¥°¥¤¥ó¥Ú¡¼¥¸¤ËÍ¶Æ³¤µ¤ì¤Æ¤·¤Þ¤¦²ÄÇ½À­¤¬¤¢¤ê¡¢¤ª´«¤á¤·¤Þ¤»¤ó¡£<br /><br />¥Ç¥Õ¥©¥ë¥È¡§false (É½¼¨¤·¤Ê¤¤)' WHERE configuration_key='SHOW_ACCOUNT_LINKS_ON_SITE_MAP';
UPDATE configuration SET configuration_title='1¾¦ÉÊ¤À¤±¤Î¥«¥Æ¥´¥ê¤ÎÉ½¼¨¤ò¥¹¥­¥Ã¥×', configuration_description='¾¦ÉÊ¤¬1¤Ä¤À¤±¤Î¥«¥Æ¥´¥ê¤ÎÉ½¼¨¤ò¥¹¥­¥Ã¥×¤·¤Þ¤¹¤«?<br />¤³¤Î¥ª¥×¥·¥ç¥ó¤¬True¤Î¾ì¹ç¡¢¥æ¡¼¥¶¡¼¤¬¾¦ÉÊ¤¬1¤Ä¤À¤±¤Î¥«¥Æ¥´¥ê¤ò¥¯¥ê¥Ã¥¯¤¹¤ë¤È¡¢Zen Cart¤ÏÄ¾ÀÜ¾¦ÉÊ¥Ú¡¼¥¸¤òÉ½¼¨¤¹¤ë¤è¤¦¤Ë¤Ê¤ê¤Þ¤¹¡£<br />¥Ç¥Õ¥©¥ë¥È¡§True' WHERE configuration_key='SKIP_SINGLE_PRODUCT_CATEGORIES';
UPDATE configuration SET configuration_title='CSS¥Ü¥¿¥ó', configuration_description='CSS²èÁü(gif/jpg)¤ÎÂå¤ï¤ê¤Ë¥Ü¥¿¥ó¤òÉ½¼¨¤·¤Þ¤¹¤«?<br />ON¤Ë¤·¤¿¾ì¹ç¡¢¥Ü¥¿¥ó¤Î¥¹¥¿¥¤¥ë¤Ï¥¹¥¿¥¤¥ë¥·¡¼¥È¤ÇÄêµÁ¤·¤Æ¤¯¤À¤µ¤¤¡£' WHERE configuration_key='IMAGE_USE_CSS_BUTTONS';
UPDATE configuration SET configuration_title='<strong>¡Ö¥á¥ó¥Æ¥Ê¥ó¥¹Ãæ¡× ¥ª¥ó/¥ª¥Õ</strong>', configuration_description='¡Ö¥á¥ó¥Æ¥Ê¥ó¥¹Ãæ¡×¤ÎÉ½¼¨¤Ë¤Ä¤¤¤ÆÀßÄê¤·¤Þ¤¹¡£<br />\r\n<br />\r\n¡¦true=on\r\n¡¦false=off' WHERE configuration_key='DOWN_FOR_MAINTENANCE';
UPDATE configuration SET configuration_title='¡Ö¥á¥ó¥Æ¥Ê¥ó¥¹Ãæ¡×- É½¼¨¤¹¤ë¥Õ¥¡¥¤¥ë', configuration_description='¥á¥ó¥Æ¥Ê¥ó¥¹Ãæ¤ËÉ½¼¨¤¹¤ë¥Õ¥¡¥¤¥ë¤Î¥Õ¥¡¥¤¥ëÌ¾¤òÀßÄê¤·¤Þ¤¹¡£¥Ç¥Õ¥©¥ë¥È¤Ï"down_for_maintenance"¤Ç¤¹¡£<br /><br />\r\n¡ÚÃí°Õ¡Û³ÈÄ¥»Ò¤ÏÉÕ¤±¤Ê¤¤¤Ç¤¯¤À¤µ¤¤¡£' WHERE configuration_key='DOWN_FOR_MAINTENANCE_FILENAME';
UPDATE configuration SET configuration_title='¡Ö¥á¥ó¥Æ¥Ê¥ó¥¹Ãæ¡×- ¥Ø¥Ã¥À¤ò±£¤¹', configuration_description='¡Ö¥á¥ó¥Æ¥Ê¥ó¥¹Ãæ¡×É½¼¨¥â¡¼¥É¤ÎºÝ¡¢¥Ø¥Ã¥À¤ò±£¤·¤Þ¤¹¤«?<br /><br />\r\n¡¦true=hide<br />\r\n¡¦false=show' WHERE configuration_key='DOWN_FOR_MAINTENANCE_HEADER_OFF';
UPDATE configuration SET configuration_title='¡Ö¥á¥ó¥Æ¥Ê¥ó¥¹Ãæ¡×- º¸¥«¥é¥à¤ò±£¤¹', configuration_description='¡Ö¥á¥ó¥Æ¥Ê¥ó¥¹Ãæ¡×É½¼¨¥â¡¼¥É¤ÎºÝ¡¢º¸¥«¥é¥à¤ò±£¤·¤Þ¤¹¤«?<br /><br />\r\n¡¦true=hide<br />\r\n¡¦false=show' WHERE configuration_key='DOWN_FOR_MAINTENANCE_COLUMN_LEFT_OFF';
UPDATE configuration SET configuration_title='¡Ö¥á¥ó¥Æ¥Ê¥ó¥¹Ãæ¡×- ±¦¥«¥é¥à¤ò±£¤¹', configuration_description='¡Ö¥á¥ó¥Æ¥Ê¥ó¥¹Ãæ¡×É½¼¨¥â¡¼¥É¤ÎºÝ¡¢±¦¥«¥é¥à¤ò±£¤·¤Þ¤¹¤«?<br /><br />\r\n¡¦true=hide<br />\r\n¡¦false=show' WHERE configuration_key='DOWN_FOR_MAINTENANCE_COLUMN_RIGHT_OFF';
UPDATE configuration SET configuration_title='¡Ö¥á¥ó¥Æ¥Ê¥ó¥¹Ãæ¡×- ¥Õ¥Ã¥¿¤ò±£¤¹', configuration_description='¡Ö¥á¥ó¥Æ¥Ê¥ó¥¹Ãæ¡×É½¼¨¥â¡¼¥É¤ÎºÝ¡¢¥Õ¥Ã¥¿¤ò±£¤·¤Þ¤¹¤«?<br /><br />\r\n¡¦true=hide<br />\r\n¡¦false=show' WHERE configuration_key='DOWN_FOR_MAINTENANCE_FOOTER_OFF';
UPDATE configuration SET configuration_title='¡Ö¥á¥ó¥Æ¥Ê¥ó¥¹Ãæ¡×- ²Á³Ê¤òÉ½¼¨¤·¤Ê¤¤', configuration_description='¡Ö¥á¥ó¥Æ¥Ê¥ó¥¹Ãæ¡×É½¼¨¥â¡¼¥É¤ÎºÝ¡¢¾¦ÉÊ²Á³Ê¤ò±£¤·¤Þ¤¹¤«?<br /><br />\r\n¡¦true=hide<br />\r\n¡¦false=show' WHERE configuration_key='DOWN_FOR_MAINTENANCE_PRICES_OFF';
UPDATE configuration SET configuration_title='¡Ö¥á¥ó¥Æ¥Ê¥ó¥¹Ãæ¡×- ÀßÄê¤·¤¿IP¥¢¥É¥ì¥¹¤ò½ü¤¯', configuration_description='¥·¥ç¥Ã¥×´ÉÍý¼ÔÍÑ¤Ê¤É¤Ë¡¢¡Ö¥á¥ó¥Æ¥Ê¥ó¥¹Ãæ¡×É½¼¨¥â¡¼¥É¤ÎºÝ¤Ç¤â¥¢¥¯¥»¥¹²ÄÇ½¤ÊIP¥¢¥É¥ì¥¹¤òÀßÄê¤·¤Þ¤¹¤«?<br /><br />\r\nÊ£¿ô¤ÎIP¥¢¥É¥ì¥¹¤ò»ØÄê¤¹¤ë¤Ë¤Ï¥«¥ó¥Þ(,)¤Ç¶èÀÚ¤ê¤Þ¤¹¡£¤Þ¤¿¡¢¤¢¤Ê¤¿¤Î¥¢¥¯¥»¥¹¸µ¤ÎIP¥¢¥É¥ì¥¹¤¬¤ï¤«¤é¤Ê¤¤¾ì¹ç¤Ï¡¢¥·¥ç¥Ã¥×¤Î¥Õ¥Ã¥¿¤ËÉ½¼¨¤µ¤ì¤ëIP¥¢¥É¥ì¥¹¤ò¥Á¥§¥Ã¥¯¤·¤Æ¤¯¤À¤µ¤¤¡£' WHERE configuration_key='EXCLUDE_ADMIN_IP_FOR_MAINTENANCE';
UPDATE configuration SET configuration_title='¡Ö¥á¥ó¥Æ¥Ê¥ó¥¹Í½¹ð(NOTICE PUBLIC)¡×-  ¥ª¥ó/¥ª¥Õ', configuration_description='¥·¥ç¥Ã¥×¤Î¡Ö¥á¥ó¥Æ¥Ê¥ó¥¹Ãæ¡×É½¼¨¤ò½Ð¤¹Á°¤Ë¹ðÃÎ¤ò½Ð¤·¤Þ¤¹¤«?<br /><br />\r\n¡¦true=on<br />\r\n¡¦false=off<br />\r\nÃí°Õ¡§¡Ö¥á¥ó¥Æ¥Ê¥ó¥¹Ãæ¡×É½¼¨¤¬Í­¸ú¤Ë¤Ê¤ë¤È¡¢¤³¤ÎÀßÄê¤Ï¼«Æ°Åª¤Ëfalse¤Ë½ñ¤­´¹¤¨¤é¤ì¤Þ¤¹¡£' WHERE configuration_key='WARN_BEFORE_DOWN_FOR_MAINTENANCE';
UPDATE configuration SET configuration_title='¡Ö¥á¥ó¥Æ¥Ê¥ó¥¹Í½¹ð¡×- ¥á¥Ã¥»¡¼¥¸¤ËÉ½¼¨¤¹¤ëÆü»þ', configuration_description='¥Ø¥Ã¥À¤ËÉ½¼¨¤¹¤ë¥á¥ó¥Æ¥Ê¥ó¥¹Í½¹ð¥á¥Ã¥»¡¼¥¸¤Î³«»ÏÆü¤È»þ´Ö¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='PERIOD_BEFORE_DOWN_FOR_MAINTENANCE';
UPDATE configuration SET configuration_title='¡Ö¥á¥ó¥Æ¥Ê¥ó¥¹Ãæ¡×- ¥á¥ó¥Æ¥Ê¥ó¥¹¤ò³«»Ï¤·¤¿Æü»þ(when webmaster has enabled maintenance)¤òÉ½¼¨', configuration_description='¥·¥ç¥Ã¥×´ÉÍý¼Ô¤¬¤¤¤Ä¡Ö¥á¥ó¥Æ¥Ê¥ó¥¹Ãæ¡×É½¼¨¤ò¥ª¥ó¤Ë¤·¤¿¤«É½¼¨¤·¤Þ¤¹¤«?<br /><br />\r\n¡¦true=on<br />\r\n¡¦false=off' WHERE configuration_key='DISPLAY_MAINTENANCE_TIME';
UPDATE configuration SET configuration_title='¡Ö¥á¥ó¥Æ¥Ê¥ó¥¹Ãæ¡×- ¥á¥ó¥Æ¥Ê¥ó¥¹´ü´Ö¤òÉ½¼¨', configuration_description='¥á¥ó¥Æ¥Ê¥ó¥¹¤Î´ü´Ö¤òÉ½¼¨¤·¤Þ¤¹¤«?<br /><br />\r\n¡¦true=on<br />\r\n¡¦false=off' WHERE configuration_key='DISPLAY_MAINTENANCE_PERIOD';
UPDATE configuration SET configuration_title='¥á¥ó¥Æ¥Ê¥ó¥¹´ü´Ö', configuration_description='¥á¥ó¥Æ¥Ê¥ó¥¹´ü´Ö¤òÀßÄê¤·¤Þ¤¹¡£<br />\r\n½ñ¼°¡§(hh:mm)<br />h = »þ´Ö¡¡m = Ê¬' WHERE configuration_key='TEXT_MAINTENANCE_PERIOD_TIME';
UPDATE configuration SET configuration_title='¥Á¥§¥Ã¥¯¥¢¥¦¥È»þ¤Ë¡Ö¤´ÍøÍÑµ¬Ìó¡×³ÎÇ§²èÌÌ¤òÉ½¼¨', configuration_description='¥Á¥§¥Ã¥¯¥¢¥¦¥È¤ÎºÝ¤Ë¡Ö¤´ÍøÍÑµ¬Ìó¡×¤Î²èÌÌ¤òÉ½¼¨¤·¤Þ¤¹¤«?' WHERE configuration_key='DISPLAY_CONDITIONS_ON_CHECKOUT';
UPDATE configuration SET configuration_title='¥¢¥«¥¦¥ó¥ÈºîÀ®»þ¤Ë¸Ä¿Í¾ðÊóÊÝ¸îÊý¿Ë³ÎÇ§²èÌÌ¤òÉ½¼¨', configuration_description='¥¢¥«¥¦¥ó¥ÈºîÀ®¤ÎºÝ¡¢¸Ä¿Í¾ðÊóÊÝ¸îÊý¿Ë¤Ø¤ÎÆ±°Õ²èÌÌ¤òÉ½¼¨¤·¤Þ¤¹¤«?<br /><div style="color: red;">Ãí°Õ¡§¡Ö¸Ä¿Í¾ðÊóÊÝ¸îË¡¡×¤Ç¤Ï¡¢¸Ä¿Í¾ðÊóÊÝ¸îÊý¿Ë¤ò³«¼¨¤¹¤ë¤³¤È¤¬µá¤á¤é¤ì¤Æ¤¤¤Þ¤¹¡£</div>' , configuration_value = 'true' WHERE configuration_key='DISPLAY_PRIVACY_CONDITIONS';
UPDATE configuration SET configuration_title='¾¦ÉÊ²èÁü¤òÉ½¼¨', configuration_description='¾¦ÉÊ²èÁü¤òÉ½¼¨¤·¤Þ¤¹¤«?<br />\r\n<br />\r\n¡¦0= off<br />\r\n¡¦1·åÌÜ¡§º¸¤«±¦¤«<br />\r\n¡¦2¡¦3·åÌÜ¡§(Â¾¤ÎÉ½¼¨¹àÌÜ¤È¤Î)¥½¡¼¥È½ç<br />\r\n¡¦4·åÌÜ¡§É½¼¨¸å¤Î²þ¹Ô(br)¿ô<br />' WHERE configuration_key='PRODUCT_NEW_LIST_IMAGE';
UPDATE configuration SET configuration_title='¾¦ÉÊ¤Î¿ôÎÌ¤òÉ½¼¨', configuration_description='¾¦ÉÊ¿ôÎÌ¤òÉ½¼¨¤·¤Þ¤¹¤«?<br />\r\n<br />\r\n¡¦0= off<br />\r\n¡¦1·åÌÜ¡§º¸¤«±¦¤«<br />\r\n¡¦2¡¦3·åÌÜ¡§(Â¾¤ÎÉ½¼¨¹àÌÜ¤È¤Î)¥½¡¼¥È½ç<br />\r\n¡¦4·åÌÜ¡§É½¼¨¸å¤Î²þ¹Ô(br)¿ô<br />' WHERE configuration_key='PRODUCT_NEW_LIST_QUANTITY';
UPDATE configuration SET configuration_title='¡Öº£¤¹¤°Çã¤¦¡×¥Ü¥¿¥ó¤ÎÉ½¼¨', configuration_description='¡Öº£¤¹¤°Çã¤¦¡×¥Ü¥¿¥ó¤òÉ½¼¨¤·¤Þ¤¹¤«?<br />\r\n<br />\r\n¡¦0= off<br />\r\n¡¦1·åÌÜ¡§º¸¤«±¦¤«<br />\r\n¡¦2¡¦3·åÌÜ¡§(Â¾¤ÎÉ½¼¨¹àÌÜ¤È¤Î)¥½¡¼¥È½ç<br />\r\n¡¦4·åÌÜ¡§É½¼¨¸å¤Î²þ¹Ô(br)¿ô<br />' WHERE configuration_key='PRODUCT_NEW_BUY_NOW';
UPDATE configuration SET configuration_title='¾¦ÉÊÌ¾¤ÎÉ½¼¨', configuration_description='¾¦ÉÊÌ¾¤òÉ½¼¨¤·¤Þ¤¹¤«?<br />\r\n<br />\r\n¡¦0= off<br />\r\n¡¦1·åÌÜ¡§º¸¤«±¦¤«<br />\r\n¡¦2¡¦3·åÌÜ¡§(Â¾¤ÎÉ½¼¨¹àÌÜ¤È¤Î)¥½¡¼¥È½ç<br />\r\n¡¦4·åÌÜ¡§É½¼¨¸å¤Î²þ¹Ô(br)¿ô<br />' WHERE configuration_key='PRODUCT_NEW_LIST_NAME';
UPDATE configuration SET configuration_title='¾¦ÉÊ·¿ÈÖ¤ÎÉ½¼¨', configuration_description='¾¦ÉÊ·¿ÈÖ¤òÉ½¼¨¤·¤Þ¤¹¤«?<br />\r\n<br />\r\n¡¦0= off<br />\r\n¡¦1·åÌÜ¡§º¸¤«±¦¤«<br />\r\n¡¦2¡¦3·åÌÜ¡§(Â¾¤ÎÉ½¼¨¹àÌÜ¤È¤Î)¥½¡¼¥È½ç<br />\r\n¡¦4·åÌÜ¡§É½¼¨¸å¤Î²þ¹Ô(br)¿ô<br />' WHERE configuration_key='PRODUCT_NEW_LIST_MODEL';
UPDATE configuration SET configuration_title='¾¦ÉÊ¥á¡¼¥«¡¼¤ÎÉ½¼¨', configuration_description='¾¦ÉÊ¥á¡¼¥«¡¼¤òÉ½¼¨¤·¤Þ¤¹¤«?<br />\r\n<br />\r\n¡¦0= off<br />\r\n¡¦1·åÌÜ¡§º¸¤«±¦¤«<br />\r\n¡¦2¡¦3·åÌÜ¡§(Â¾¤ÎÉ½¼¨¹àÌÜ¤È¤Î)¥½¡¼¥È½ç<br />\r\n¡¦4·åÌÜ¡§É½¼¨¸å¤Î²þ¹Ô(br)¿ô<br />' WHERE configuration_key='PRODUCT_NEW_LIST_MANUFACTURER';
UPDATE configuration SET configuration_title='¾¦ÉÊ²Á³Ê¤ÎÉ½¼¨', configuration_description='¾¦ÉÊ²Á³Ê¤òÉ½¼¨¤·¤Þ¤¹¤«?<br />\r\n<br />\r\n¡¦0= off<br />\r\n¡¦1·åÌÜ¡§º¸¤«±¦¤«<br />\r\n¡¦2¡¦3·åÌÜ¡§(Â¾¤ÎÉ½¼¨¹àÌÜ¤È¤Î)¥½¡¼¥È½ç<br />\r\n¡¦4·åÌÜ¡§É½¼¨¸å¤Î²þ¹Ô(br)¿ô<br />' WHERE configuration_key='PRODUCT_NEW_LIST_PRICE';
UPDATE configuration SET configuration_title='¾¦ÉÊ½ÅÎÌ¤ÎÉ½¼¨', configuration_description='¾¦ÉÊ¤Î½ÅÎÌ¤òÉ½¼¨¤·¤Þ¤¹¤«?<br />\r\n<br />\r\n¡¦0= off<br />\r\n¡¦1·åÌÜ¡§º¸¤«±¦¤«<br />\r\n¡¦2¡¦3·åÌÜ¡§(Â¾¤ÎÉ½¼¨¹àÌÜ¤È¤Î)¥½¡¼¥È½ç<br />\r\n¡¦4·åÌÜ¡§É½¼¨¸å¤Î²þ¹Ô(br)¿ô<br />' WHERE configuration_key='PRODUCT_NEW_LIST_WEIGHT';
UPDATE configuration SET configuration_title='¾¦ÉÊÅÐÏ¿Æü¤ÎÉ½¼¨', configuration_description='¾¦ÉÊÅÐÏ¿Æü¤òÉ½¼¨¤·¤Þ¤¹¤«?<br />\r\n<br />\r\n¡¦0= off<br />\r\n¡¦1·åÌÜ¡§º¸¤«±¦¤«<br />\r\n¡¦2¡¦3·åÌÜ¡§(Â¾¤ÎÉ½¼¨¹àÌÜ¤È¤Î)¥½¡¼¥È½ç<br />\r\n¡¦4·åÌÜ¡§É½¼¨¸å¤Î²þ¹Ô(br)¿ô<br />' WHERE configuration_key='PRODUCT_NEW_LIST_DATE_ADDED';
UPDATE configuration SET configuration_title='¾¦ÉÊÀâÌÀ¤ÎÉ½¼¨', configuration_description='¾¦ÉÊÀâÌÀ(ºÇ½é¤Î150Ê¸»ú)¤òÉ½¼¨¤·¤Þ¤¹¤«?<br />\r\n<br />\r\n¡¦0= off<br />\r\n¡¦1= on' WHERE configuration_key='PRODUCT_NEW_LIST_DESCRIPTION';
UPDATE configuration SET configuration_title='¾¦ÉÊ¤ÎÉ½¼¨ - ¥Ç¥Õ¥©¥ë¥È¤Î¥½¡¼¥È½ç', configuration_description='¿·Ãå¾¦ÉÊ¥ê¥¹¥È¤ÎÉ½¼¨¤Î¥Ç¥Õ¥©¥ë¥È¤Î¥½¡¼¥È½ç¤Ï? ¥Ç¥Õ¥©¥ë¥ÈÃÍ¤Ï6¤Ç¤¹¡£<br /><br />\r\n¡¦1= ¾¦ÉÊÌ¾<br />\r\n¡¦2= ¾¦ÉÊÌ¾(¹ß½ç)<br />\r\n¡¦3= ²Á³Ê¤¬°Â¤¤¤â¤Î¤«¤é¾¦ÉÊÌ¾<br />\r\n¡¦4= ²Á³Ê¤¬¹â¤¤¤â¤Î¤«¤é¾¦ÉÊÌ¾<br />\r\n¡¦5= ·¿ÈÖ<br />\r\n¡¦6= ¾¦ÉÊÅÐÏ¿Æü(¹ß½ç)<br />\r\n¡¦7= ¾¦ÉÊÅÐÏ¿Æü<br />\r\n¡¦8= ¾¦ÉÊ½ç(Product Sort)\r\n' WHERE configuration_key='PRODUCT_NEW_LIST_SORT_DEFAULT';
UPDATE configuration SET configuration_title='¿·Ãå¾¦ÉÊ - ¥Ç¥Õ¥©¥ë¥È¤Î¥°¥ë¡¼¥×ID', configuration_description='¿·Ãå¾¦ÉÊ¥ê¥¹¥È¤ÎÀßÄê¥°¥ë¡¼¥×ID(configuration_group_id)¤Ï²¿¤Ç¤¹¤«?<br />\r\n<br />\r\nÃí°Õ¡§Á´¾¦ÉÊ¥ê¥¹¥È¤Î¥°¥ë¡¼¥×ID¤¬¥Ç¥Õ¥©¥ë¥È¤Î21¤«¤éÊÑ¹¹¤µ¤ì¤¿¤È¤­¤À¤±ÀßÄê¤·¤Æ¤¯¤À¤µ¤¤¡£' WHERE configuration_key='PRODUCT_NEW_LIST_GROUP_ID';
UPDATE configuration SET configuration_title='Ê£¿ô¾¦ÉÊ¤Î¿ôÎÌÍó¤ÎÍ­Ìµ¡¦É½¼¨°ÌÃÖ', configuration_description='Ê£¿ô¾¦ÉÊ¤Î¿ôÎÌÍó¤ÎÉ½¼¨¤ÎÍ­Ìµ¤ÈÉ½¼¨°ÌÃÖ¤Ë¤Ä¤¤¤ÆÀßÄê¤·¤Þ¤¹¡£<br />0= off<br />1= ¾åÉô<br />2= ²¼Éô<br />3= Î¾Êý' WHERE configuration_key='PRODUCT_NEW_LISTING_MULTIPLE_ADD_TO_CART';
UPDATE configuration SET configuration_title='¾¦ÉÊ²èÁü¤ÎÉ½¼¨', configuration_description='¾¦ÉÊ²èÁü¤òÉ½¼¨¤·¤Þ¤¹¤«?<br />\r\n<br />\r\n¡¦0= off<br />\r\n¡¦1·åÌÜ¡§º¸¤«±¦¤«<br />\r\n¡¦2¡¦3·åÌÜ¡§(Â¾¤ÎÉ½¼¨¹àÌÜ¤È¤Î)¥½¡¼¥È½ç<br />\r\n¡¦4·åÌÜ¡§É½¼¨¸å¤Î²þ¹Ô(br)¿ô<br />\r\n' WHERE configuration_key='PRODUCT_FEATURED_LIST_IMAGE';
UPDATE configuration SET configuration_title='¾¦ÉÊ¿ôÎÌ¤ÎÉ½¼¨', configuration_description='¾¦ÉÊ¿ôÎÌ¤òÉ½¼¨¤·¤Þ¤¹¤«?<br />\r\n<br />\r\n¡¦0= off<br />\r\n¡¦1·åÌÜ¡§º¸¤«±¦¤«<br />\r\n¡¦2¡¦3·åÌÜ¡§(Â¾¤ÎÉ½¼¨¹àÌÜ¤È¤Î)¥½¡¼¥È½ç<br />\r\n¡¦4·åÌÜ¡§É½¼¨¸å¤Î²þ¹Ô(br)¿ô<br />\r\n' WHERE configuration_key='PRODUCT_FEATURED_LIST_QUANTITY';
UPDATE configuration SET configuration_title='¡Öº£¤¹¤°Çã¤¦¡×¥Ü¥¿¥ó¤ÎÉ½¼¨', configuration_description='¡Öº£¤¹¤°Çã¤¦¡×¥Ü¥¿¥ó¤òÉ½¼¨¤·¤Þ¤¹¤«?<br />\r\n<br />\r\n¡¦0= off<br />\r\n¡¦1·åÌÜ¡§º¸¤«±¦¤«<br />\r\n¡¦2¡¦3·åÌÜ¡§(Â¾¤ÎÉ½¼¨¹àÌÜ¤È¤Î)¥½¡¼¥È½ç<br />\r\n¡¦4·åÌÜ¡§É½¼¨¸å¤Î²þ¹Ô(br)¿ô<br />' WHERE configuration_key='PRODUCT_FEATURED_BUY_NOW';
UPDATE configuration SET configuration_title='¾¦ÉÊÌ¾¤ÎÉ½¼¨', configuration_description='¾¦ÉÊÌ¾¤òÉ½¼¨¤·¤Þ¤¹¤«?<br />\r\n<br />\r\n¡¦0= off<br />\r\n¡¦1·åÌÜ¡§º¸¤«±¦¤«<br />\r\n¡¦2¡¦3·åÌÜ¡§(Â¾¤ÎÉ½¼¨¹àÌÜ¤È¤Î)¥½¡¼¥È½ç<br />\r\n¡¦4·åÌÜ¡§É½¼¨¸å¤Î²þ¹Ô(br)¿ô<br />' WHERE configuration_key='PRODUCT_FEATURED_LIST_NAME';
UPDATE configuration SET configuration_title='¾¦ÉÊ·¿ÈÖ¤ÎÉ½¼¨', configuration_description='¾¦ÉÊ·¿ÈÖ¤òÉ½¼¨¤·¤Þ¤¹¤«?<br />\r\n<br />\r\n¡¦0= off<br />\r\n¡¦1·åÌÜ¡§º¸¤«±¦¤«<br />\r\n¡¦2¡¦3·åÌÜ¡§(Â¾¤ÎÉ½¼¨¹àÌÜ¤È¤Î)¥½¡¼¥È½ç<br />\r\n¡¦4·åÌÜ¡§É½¼¨¸å¤Î²þ¹Ô(br)¿ô<br />' WHERE configuration_key='PRODUCT_FEATURED_LIST_MODEL';
UPDATE configuration SET configuration_title='¾¦ÉÊ¥á¡¼¥«¡¼¤ÎÉ½¼¨', configuration_description='¾¦ÉÊ¥á¡¼¥«¡¼¤òÉ½¼¨¤·¤Þ¤¹¤«?<br />\r\n<br />\r\n¡¦0= off<br />\r\n¡¦1·åÌÜ¡§º¸¤«±¦¤«<br />\r\n¡¦2¡¦3·åÌÜ¡§(Â¾¤ÎÉ½¼¨¹àÌÜ¤È¤Î)¥½¡¼¥È½ç<br />\r\n¡¦4·åÌÜ¡§É½¼¨¸å¤Î²þ¹Ô(br)¿ô<br />' WHERE configuration_key='PRODUCT_FEATURED_LIST_MANUFACTURER';
UPDATE configuration SET configuration_title='¾¦ÉÊ²Á³Ê¤ÎÉ½¼¨', configuration_description='¾¦ÉÊ²Á³Ê¤òÉ½¼¨¤·¤Þ¤¹¤«?<br />\r\n<br />\r\n¡¦0= off<br />\r\n¡¦1·åÌÜ¡§º¸¤«±¦¤«<br />\r\n¡¦2¡¦3·åÌÜ¡§(Â¾¤ÎÉ½¼¨¹àÌÜ¤È¤Î)¥½¡¼¥È½ç<br />\r\n¡¦4·åÌÜ¡§É½¼¨¸å¤Î²þ¹Ô(br)¿ô<br />' WHERE configuration_key='PRODUCT_FEATURED_LIST_PRICE';
UPDATE configuration SET configuration_title='¾¦ÉÊ½ÅÎÌ¤ÎÉ½¼¨', configuration_description='¾¦ÉÊ½ÅÎÌ¤òÉ½¼¨¤·¤Þ¤¹¤«?<br />\r\n<br />\r\n¡¦0= off<br />\r\n¡¦1·åÌÜ¡§º¸¤«±¦¤«<br />\r\n¡¦2¡¦3·åÌÜ¡§(Â¾¤ÎÉ½¼¨¹àÌÜ¤È¤Î)¥½¡¼¥È½ç<br />\r\n¡¦4·åÌÜ¡§É½¼¨¸å¤Î²þ¹Ô(br)¿ô<br />' WHERE configuration_key='PRODUCT_FEATURED_LIST_WEIGHT';
UPDATE configuration SET configuration_title='¾¦ÉÊÅÐÏ¿Æü¤ÎÉ½¼¨', configuration_description='¾¦ÉÊÅÐÏ¿Æü¤òÉ½¼¨¤·¤Þ¤¹¤«?<br />\r\n<br />\r\n¡¦0= off<br />\r\n¡¦1·åÌÜ¡§º¸¤«±¦¤«<br />\r\n¡¦2¡¦3·åÌÜ¡§(Â¾¤ÎÉ½¼¨¹àÌÜ¤È¤Î)¥½¡¼¥È½ç<br />\r\n¡¦4·åÌÜ¡§É½¼¨¸å¤Î²þ¹Ô(br)¿ô<br />' WHERE configuration_key='PRODUCT_FEATURED_LIST_DATE_ADDED';
UPDATE configuration SET configuration_title='¾¦ÉÊÀâÌÀ¤ÎÉ½¼¨', configuration_description='¾¦ÉÊÀâÌÀ(ºÇ½é¤Î150Ê¸»ú)¤òÉ½¼¨¤·¤Þ¤¹¤«?<br />\r\n<br />\r\n¡¦0= off<br />\r\n¡¦1= on' WHERE configuration_key='PRODUCT_FEATURED_LIST_DESCRIPTION';
UPDATE configuration SET configuration_title='¾¦ÉÊÉ½¼¨ - ¥Ç¥Õ¥©¥ë¥È¤Î¥½¡¼¥È½ç', configuration_description='¤ª¤¹¤¹¤á¾¦ÉÊ¥ê¥¹¥È¤ÎÉ½¼¨¤Î¥Ç¥Õ¥©¥ë¥È¤Î¥½¡¼¥È½ç¤Ï? ¥Ç¥Õ¥©¥ë¥ÈÃÍ¤Ï1¤Ç¤¹¡£<br />\r\n<br />\r\n¡¦1= ¾¦ÉÊÌ¾<br />\r\n¡¦2= ¾¦ÉÊÌ¾(¹ß½ç)<br />\r\n¡¦3= ²Á³Ê¤¬°Â¤¤¤â¤Î¤«¤é¡¢¾¦ÉÊÌ¾<br />\r\n¡¦4= ²Á³Ê¤¬¹â¤¤¤â¤Î¤«¤é¡¢¾¦ÉÊÌ¾<br />\r\n¡¦5= ·¿ÈÖ<br />\r\n¡¦6= ¾¦ÉÊÅÐÏ¿Æü(¹ß½ç)<br />\r\n¡¦7= ¾¦ÉÊÅÐÏ¿Æü<br />\r\n¡¦8= ¾¦ÉÊ½ç(Product Sort)' WHERE configuration_key='PRODUCT_FEATURED_LIST_SORT_DEFAULT';
UPDATE configuration SET configuration_title='¤ª¤¹¤¹¤á¾¦ÉÊ - ¥Ç¥Õ¥©¥ë¥È¤Î¥°¥ë¡¼¥×ID', configuration_description='¤ª¤¹¤¹¤á¾¦ÉÊ¥ê¥¹¥È¤ÎÀßÄê¥°¥ë¡¼¥×ID(configuration_group_id)¤Ï²¿¤Ç¤¹¤«?<br />\r\n<br />\r\nÃí°Õ¡§¤ª¤¹¤¹¤á¾¦ÉÊ¥ê¥¹¥È¤Î¥°¥ë¡¼¥×ID¤¬¥Ç¥Õ¥©¥ë¥È¤Î22¤«¤éÊÑ¹¹¤µ¤ì¤¿¤È¤­¤À¤±ÀßÄê¤·¤Æ¤¯¤À¤µ¤¤¡£\r\n' WHERE configuration_key='PRODUCT_FEATURED_LIST_GROUP_ID';
UPDATE configuration SET configuration_title='Ê£¿ô¾¦ÉÊ¤Î¿ôÎÌÍó¤ÎÍ­Ìµ¡¦É½¼¨°ÌÃÖ', configuration_description='Ê£¿ô¾¦ÉÊ¤Î¿ôÎÌÍó¤ÎÉ½¼¨¤ÎÍ­Ìµ¤ÈÉ½¼¨°ÌÃÖ¤Ë¤Ä¤¤¤ÆÀßÄê¤·¤Þ¤¹¡£<br />0= off<br />1= ¾åÉô<br />2= ²¼Éô<br />3= Î¾Êý' WHERE configuration_key='PRODUCT_FEATURED_LISTING_MULTIPLE_ADD_TO_CART';
UPDATE configuration SET configuration_title='¾¦ÉÊ²èÁü¤ÎÉ½¼¨', configuration_description='¾¦ÉÊ²èÁü¤òÉ½¼¨¤·¤Þ¤¹¤«?<br />\r\n<br />\r\n¡¦0= off<br />\r\n¡¦1·åÌÜ¡§º¸¤«±¦¤«<br />\r\n¡¦2¡¦3·åÌÜ¡§(Â¾¤ÎÉ½¼¨¹àÌÜ¤È¤Î)¥½¡¼¥È½ç<br />\r\n¡¦4·åÌÜ¡§É½¼¨¸å¤Î²þ¹Ô(br)¿ô<br />' WHERE configuration_key='PRODUCT_ALL_LIST_IMAGE';
UPDATE configuration SET configuration_title='¾¦ÉÊ¿ôÎÌ¤ÎÉ½¼¨', configuration_description='¾¦ÉÊ¿ôÎÌ¤òÉ½¼¨¤·¤Þ¤¹¤«?<br />\r\n<br />\r\n¡¦0= off<br />\r\n¡¦1·åÌÜ¡§º¸¤«±¦¤«<br />\r\n¡¦2¡¦3·åÌÜ¡§(Â¾¤ÎÉ½¼¨¹àÌÜ¤È¤Î)¥½¡¼¥È½ç<br />\r\n¡¦4·åÌÜ¡§É½¼¨¸å¤Î²þ¹Ô(br)¿ô<br />' WHERE configuration_key='PRODUCT_ALL_LIST_QUANTITY';
UPDATE configuration SET configuration_title='¡Öº£¤¹¤°Çã¤¦¡×¥Ü¥¿¥ó¤ÎÉ½¼¨', configuration_description='¡Öº£¤¹¤°Çã¤¦¡×¥Ü¥¿¥ó¤òÉ½¼¨¤·¤Þ¤¹¤«?<br />\r\n<br />\r\n¡¦0= off<br />\r\n¡¦1·åÌÜ¡§º¸¤«±¦¤«<br />\r\n¡¦2¡¦3·åÌÜ¡§(Â¾¤ÎÉ½¼¨¹àÌÜ¤È¤Î)¥½¡¼¥È½ç<br />\r\n¡¦4·åÌÜ¡§É½¼¨¸å¤Î²þ¹Ô(br)¿ô<br />' WHERE configuration_key='PRODUCT_ALL_BUY_NOW';
UPDATE configuration SET configuration_title='¾¦ÉÊ²Á³Ê¤ÎÉ½¼¨', configuration_description='¾¦ÉÊ²Á³Ê¤òÉ½¼¨¤·¤Þ¤¹¤«?<br />\r\n<br />\r\n¡¦0= off<br />\r\n¡¦1·åÌÜ¡§º¸¤«±¦¤«<br />\r\n¡¦2¡¦3·åÌÜ¡§(Â¾¤ÎÉ½¼¨¹àÌÜ¤È¤Î)¥½¡¼¥È½ç<br />\r\n¡¦4·åÌÜ¡§É½¼¨¸å¤Î²þ¹Ô(br)¿ô<br />' WHERE configuration_key='PRODUCT_ALL_LIST_NAME';
UPDATE configuration SET configuration_title='¾¦ÉÊ·¿ÈÖ¤ÎÉ½¼¨', configuration_description='¾¦ÉÊ·¿ÈÖ¤òÉ½¼¨¤·¤Þ¤¹¤«?<br />\r\n<br />\r\n¡¦0= off<br />\r\n¡¦1·åÌÜ¡§º¸¤«±¦¤«<br />\r\n¡¦2¡¦3·åÌÜ¡§(Â¾¤ÎÉ½¼¨¹àÌÜ¤È¤Î)¥½¡¼¥È½ç<br />\r\n¡¦4·åÌÜ¡§É½¼¨¸å¤Î²þ¹Ô(br)¿ô<br />' WHERE configuration_key='PRODUCT_ALL_LIST_MODEL';
UPDATE configuration SET configuration_title='¾¦ÉÊ¥á¡¼¥«¡¼¤ÎÉ½¼¨', configuration_description='¾¦ÉÊ¥á¡¼¥«¡¼¤òÉ½¼¨¤·¤Þ¤¹¤«?<br />\r\n<br />\r\n¡¦0= off<br />\r\n¡¦1·åÌÜ¡§º¸¤«±¦¤«<br />\r\n¡¦2¡¦3·åÌÜ¡§(Â¾¤ÎÉ½¼¨¹àÌÜ¤È¤Î)¥½¡¼¥È½ç<br />\r\n¡¦4·åÌÜ¡§É½¼¨¸å¤Î²þ¹Ô(br)¿ô<br />' WHERE configuration_key='PRODUCT_ALL_LIST_MANUFACTURER';
UPDATE configuration SET configuration_title='¾¦ÉÊ²Á³Ê¤ÎÉ½¼¨', configuration_description='¾¦ÉÊ²Á³Ê¤òÉ½¼¨¤·¤Þ¤¹¤«?<br />\r\n<br />\r\n¡¦0= off<br />\r\n¡¦1·åÌÜ¡§º¸¤«±¦¤«<br />\r\n¡¦2¡¦3·åÌÜ¡§(Â¾¤ÎÉ½¼¨¹àÌÜ¤È¤Î)¥½¡¼¥È½ç<br />\r\n¡¦4·åÌÜ¡§É½¼¨¸å¤Î²þ¹Ô(br)¿ô<br />' WHERE configuration_key='PRODUCT_ALL_LIST_PRICE';
UPDATE configuration SET configuration_title='¾¦ÉÊ½ÅÎÌ¤ÎÉ½¼¨', configuration_description='¾¦ÉÊ½ÅÎÌ¤òÉ½¼¨¤·¤Þ¤¹¤«?<br />\r\n<br />\r\n¡¦0= off<br />\r\n¡¦1·åÌÜ¡§º¸¤«±¦¤«<br />\r\n¡¦2¡¦3·åÌÜ¡§(Â¾¤ÎÉ½¼¨¹àÌÜ¤È¤Î)¥½¡¼¥È½ç<br />\r\n¡¦4·åÌÜ¡§É½¼¨¸å¤Î²þ¹Ô(br)¿ô<br />' WHERE configuration_key='PRODUCT_ALL_LIST_WEIGHT';
UPDATE configuration SET configuration_title='¾¦ÉÊÅÐÏ¿Æü¤ÎÉ½¼¨', configuration_description='¾¦ÉÊÅÐÏ¿Æü¤òÉ½¼¨¤·¤Þ¤¹¤«?<br />\r\n<br />\r\n¡¦0= off<br />\r\n¡¦1·åÌÜ¡§º¸¤«±¦¤«<br />\r\n¡¦2¡¦3·åÌÜ¡§(Â¾¤ÎÉ½¼¨¹àÌÜ¤È¤Î)¥½¡¼¥È½ç<br />\r\n¡¦4·åÌÜ¡§É½¼¨¸å¤Î²þ¹Ô(br)¿ô<br />' WHERE configuration_key='PRODUCT_ALL_LIST_DATE_ADDED';
UPDATE configuration SET configuration_title='¾¦ÉÊÀâÌÀ¤ÎÉ½¼¨', configuration_description='¾¦ÉÊÀâÌÀ(ºÇ½é¤Î150Ê¸»ú)¤òÉ½¼¨¤·¤Þ¤¹¤«?<br />\r\n<br />\r\n¡¦0= off<br />\r\n¡¦1= on' WHERE configuration_key='PRODUCT_ALL_LIST_DESCRIPTION';
UPDATE configuration SET configuration_title='¾¦ÉÊÉ½¼¨ - ¥Ç¥Õ¥©¥ë¥È¤Î¥½¡¼¥È½ç', configuration_description='Á´¾¦ÉÊ¥ê¥¹¥È¤ÎÉ½¼¨¤Î¥Ç¥Õ¥©¥ë¥È¤Î¥½¡¼¥È½ç¤Ï? ¥Ç¥Õ¥©¥ë¥ÈÃÍ¤Ï1¤Ç¤¹¡£<br />\r\n<br />\r\n¡¦1= ¾¦ÉÊÌ¾<br />\r\n¡¦2= ¾¦ÉÊÌ¾(¹ß½ç)<br />\r\n¡¦3= ²Á³Ê¤¬°Â¤¤¤â¤Î¤«¤é¡¢¾¦ÉÊÌ¾<br />\r\n¡¦4= ²Á³Ê¤¬¹â¤¤¤â¤Î¤«¤é¡¢¾¦ÉÊÌ¾<br />\r\n¡¦5= ·¿ÈÖ<br />\r\n¡¦6= ¾¦ÉÊÅÐÏ¿Æü(¹ß½ç)<br />\r\n¡¦7= ¾¦ÉÊÅÐÏ¿Æü<br />\r\n¡¦8= ¾¦ÉÊ½ç(Product Sort)' WHERE configuration_key='PRODUCT_ALL_LIST_SORT_DEFAULT';
UPDATE configuration SET configuration_title='Á´¾¦ÉÊ¥ê¥¹¥È - ¥Ç¥Õ¥©¥ë¥È¤Î¥°¥ë¡¼¥×ID', configuration_description='Á´¾¦ÉÊ¥ê¥¹¥È¤ÎÀßÄê¥°¥ë¡¼¥×ID(configuration_group_id)¤Ï?<br />\r\n<br />\r\nÃí°Õ¡§Á´¾¦ÉÊ¥ê¥¹¥È¤Î¥°¥ë¡¼¥×ID¤¬¥Ç¥Õ¥©¥ë¥È¤Î23¤«¤éÊÑ¹¹¤µ¤ì¤¿¤È¤­¤À¤±ÀßÄê¤·¤Æ¤¯¤À¤µ¤¤¡£\r\n' WHERE configuration_key='PRODUCT_ALL_LIST_GROUP_ID';
UPDATE configuration SET configuration_title='Ê£¿ô¾¦ÉÊ¤Î¿ôÎÌÍó¤ÎÍ­Ìµ¡¦É½¼¨°ÌÃÖ', configuration_description='Ê£¿ô¾¦ÉÊ¤Î¿ôÎÌÍó¤ÎÉ½¼¨¤ÎÍ­Ìµ¤ÈÉ½¼¨°ÌÃÖ¤Ë¤Ä¤¤¤ÆÀßÄê¤·¤Þ¤¹¡£<br />0= off<br />1= ¾åÉô<br />2= ²¼Éô<br />3= Î¾Êý' WHERE configuration_key='PRODUCT_ALL_LISTING_MULTIPLE_ADD_TO_CART';
UPDATE configuration SET configuration_title='¿·Ãå¾¦ÉÊ¤ò¥È¥Ã¥×¥Ú¡¼¥¸¤ËÉ½¼¨¤¹¤ë', configuration_description='¿·Ãå¾¦ÉÊ¤ò¥È¥Ã¥×¥Ú¡¼¥¸¤ËÉ½¼¨ ¤·¤Þ¤¹¤«?\r\n<br />\r\n0= off<br />\r\n¤Þ¤¿¤ÏÉ½¼¨½ç¤ò¿ôÃÍ(1¡Á4)¤ÇÀßÄê¤·¤Æ¤¯¤À¤µ¤¤¡£\r\n' WHERE configuration_key='SHOW_PRODUCT_INFO_MAIN_NEW_PRODUCTS';
UPDATE configuration SET configuration_title='¤ª¤¹¤¹¤á¾¦ÉÊ¤ò¥È¥Ã¥×¥Ú¡¼¥¸¤ËÉ½¼¨¤¹¤ë', configuration_description='¤ª¤¹¤¹¤á¾¦ÉÊ¤ò¥È¥Ã¥×¥Ú¡¼¥¸¤ËÉ½¼¨ ¤·¤Þ¤¹¤«?\r\n<br />\r\n0= off<br />\r\n¤Þ¤¿¤ÏÉ½¼¨½ç¤ò¿ôÃÍ(1¡Á4)¤ÇÀßÄê¤·¤Æ¤¯¤À¤µ¤¤¡£\r\n' WHERE configuration_key='SHOW_PRODUCT_INFO_MAIN_FEATURED_PRODUCTS';
UPDATE configuration SET configuration_title='ÆÃ²Á¾¦ÉÊ¤ò¥È¥Ã¥×¥Ú¡¼¥¸¤ËÉ½¼¨¤¹¤ë', configuration_description='ÆÃ²Á¾¦ÉÊ¤ò¥È¥Ã¥×¥Ú¡¼¥¸¤ËÉ½¼¨ ¤·¤Þ¤¹¤«?\r\n<br />\r\n0= off<br />\r\n¤Þ¤¿¤ÏÉ½¼¨½ç¤ò¿ôÃÍ(1¡Á4)¤ÇÀßÄê¤·¤Æ¤¯¤À¤µ¤¤¡£\r\n' WHERE configuration_key='SHOW_PRODUCT_INFO_MAIN_SPECIALS_PRODUCTS';
UPDATE configuration SET configuration_title='Æþ²ÙÍ½Äê¾¦ÉÊ¤ò¥È¥Ã¥×¥Ú¡¼¥¸¤ËÉ½¼¨¤¹¤ë', configuration_description='Æþ²ÙÍ½Äê¾¦ÉÊ¤ò¥È¥Ã¥×¥Ú¡¼¥¸¤ËÉ½¼¨ ¤·¤Þ¤¹¤«?\r\n<br />\r\n0= off<br />\r\n¤Þ¤¿¤ÏÉ½¼¨½ç¤ò¿ôÃÍ(1¡Á4)¤ÇÀßÄê¤·¤Æ¤¯¤À¤µ¤¤¡£\r\n' WHERE configuration_key='SHOW_PRODUCT_INFO_MAIN_UPCOMING';
UPDATE configuration SET configuration_title='¿·Ãå¾¦ÉÊ¤ò¥È¥Ã¥×¥Ú¡¼¥¸¤ËÉ½¼¨¤¹¤ë - ¥«¥Æ¥´¥ê¡¦¥µ¥Ö¥«¥Æ¥´¥ê¶¦¤Ë\r\n', configuration_description='¿·Ãå¾¦ÉÊ¤ò(¥È¥Ã¥×¥ì¥Ù¥ë)¥«¥Æ¥´¥ê¡¦¥µ¥Ö¥«¥Æ¥´¥ê¶¦¤Ë¥È¥Ã¥×¥Ú¡¼¥¸¤ËÉ½¼¨ ¤·¤Þ¤¹¤«?\r\n<br />\r\n0= off<br />\r\n¤Þ¤¿¤ÏÉ½¼¨½ç¤ò¿ôÃÍ(1¡Á4)¤ÇÀßÄê¤·¤Æ¤¯¤À¤µ¤¤¡£\r\n' WHERE configuration_key='SHOW_PRODUCT_INFO_CATEGORY_NEW_PRODUCTS';
UPDATE configuration SET configuration_title='¤ª¤¹¤¹¤á¾¦ÉÊ¤ò¥È¥Ã¥×¥Ú¡¼¥¸¤ËÉ½¼¨¤¹¤ë - ¥«¥Æ¥´¥ê¡¦¥µ¥Ö¥«¥Æ¥´¥ê¶¦¤Ë', configuration_description='¤ª¤¹¤¹¤á¾¦ÉÊ¤ò(¥È¥Ã¥×¥ì¥Ù¥ë)¥«¥Æ¥´¥ê¡¦¥µ¥Ö¥«¥Æ¥´¥ê¶¦¤Ë¥È¥Ã¥×¥Ú¡¼¥¸¤ËÉ½¼¨ ¤·¤Þ¤¹¤«?\r\n<br />\r\n0= off<br />\r\n¤Þ¤¿¤ÏÉ½¼¨½ç¤ò¿ôÃÍ(1¡Á4)¤ÇÀßÄê¤·¤Æ¤¯¤À¤µ¤¤¡£\r\n' WHERE configuration_key='SHOW_PRODUCT_INFO_CATEGORY_FEATURED_PRODUCTS';
UPDATE configuration SET configuration_title='ÆÃ²Á¾¦ÉÊ¤ò¥È¥Ã¥×¥Ú¡¼¥¸¤ËÉ½¼¨¤¹¤ë - ¥«¥Æ¥´¥ê¡¦¥µ¥Ö¥«¥Æ¥´¥ê¶¦¤Ë', configuration_description='ÆÃ²Á¾¦ÉÊ¤ò(¥È¥Ã¥×¥ì¥Ù¥ë)¥«¥Æ¥´¥ê¡¦¥µ¥Ö¥«¥Æ¥´¥ê¶¦¤Ë¥È¥Ã¥×¥Ú¡¼¥¸¤ËÉ½¼¨ ¤·¤Þ¤¹¤«?\r\n<br />\r\n0= off<br />\r\n¤Þ¤¿¤ÏÉ½¼¨½ç¤ò¿ôÃÍ(1¡Á4)¤ÇÀßÄê¤·¤Æ¤¯¤À¤µ¤¤¡£\r\n' WHERE configuration_key='SHOW_PRODUCT_INFO_CATEGORY_SPECIALS_PRODUCTS';
UPDATE configuration SET configuration_title='Æþ²ÙÍ½Äê¾¦ÉÊ¤ò¥È¥Ã¥×¥Ú¡¼¥¸¤ËÉ½¼¨¤¹¤ë - ¥«¥Æ¥´¥ê¡¦¥µ¥Ö¥«¥Æ¥´¥ê¶¦¤Ë', configuration_description='Æþ²ÙÍ½Äê¾¦ÉÊ¤ò(¥È¥Ã¥×¥ì¥Ù¥ë)¥«¥Æ¥´¥ê¡¦¥µ¥Ö¥«¥Æ¥´¥ê¶¦¤Ë¥È¥Ã¥×¥Ú¡¼¥¸¤ËÉ½¼¨ ¤·¤Þ¤¹¤«?\r\n<br />\r\n0= off<br />\r\n¤Þ¤¿¤ÏÉ½¼¨½ç¤ò¿ôÃÍ(1¡Á4)¤ÇÀßÄê¤·¤Æ¤¯¤À¤µ¤¤¡£\r\n' WHERE configuration_key='SHOW_PRODUCT_INFO_CATEGORY_UPCOMING';
UPDATE configuration SET configuration_title='¿·Ãå¾¦ÉÊ¤ò¥È¥Ã¥×¥Ú¡¼¥¸¤ËÉ½¼¨¤¹¤ë - ¥¨¥é¡¼¤È¥ê¥ó¥¯ÀÚ¤ì¾¦ÉÊ¥Ú¡¼¥¸', configuration_description='¿·ÃåÍ½Äê¾¦ÉÊ¤ò¥È¥Ã¥×¥Ú¡¼¥¸¤ËÉ½¼¨ ¤·¤Þ¤¹¤«?\r\n(¥¨¥é¡¼¤È¥ê¥ó¥¯ÀÚ¤ì¾¦ÉÊ¥Ú¡¼¥¸¡¦/* ÌõÃí¡¦°ÕÌ£ÉÔÌÀ */)<br />\r\n0= off<br />\r\n¤Þ¤¿¤Ï½çÈÖ¤ò¿ôÃÍ(1¡Á4)¤ÇÀßÄê¤·¤Æ¤¯¤À¤µ¤¤¡£' WHERE configuration_key='SHOW_PRODUCT_INFO_MISSING_NEW_PRODUCTS';
UPDATE configuration SET configuration_title='¤ª¤¹¤¹¤á¾¦ÉÊ¤ò¥È¥Ã¥×¥Ú¡¼¥¸¤ËÉ½¼¨¤¹¤ë - ¥¨¥é¡¼¤È¥ê¥ó¥¯ÀÚ¤ì¾¦ÉÊ¥Ú¡¼¥¸', configuration_description='¤ª¤¹¤¹¤á¾¦ÉÊ¤ò¥È¥Ã¥×¥Ú¡¼¥¸¤ËÉ½¼¨ ¤·¤Þ¤¹¤«?\r\n(¥¨¥é¡¼¤È¥ê¥ó¥¯ÀÚ¤ì¾¦ÉÊ¥Ú¡¼¥¸¡¦/* ÌõÃí¡¦°ÕÌ£ÉÔÌÀ */)<br />\r\n0= off<br />\r\n¤Þ¤¿¤Ï½çÈÖ¤ò¿ôÃÍ(1¡Á4)¤ÇÀßÄê¤·¤Æ¤¯¤À¤µ¤¤¡£' WHERE configuration_key='SHOW_PRODUCT_INFO_MISSING_FEATURED_PRODUCTS';
UPDATE configuration SET configuration_title='ÆÃ²Á¾¦ÉÊ¤ò¥È¥Ã¥×¥Ú¡¼¥¸¤ËÉ½¼¨¤¹¤ë - ¥¨¥é¡¼¤È¥ê¥ó¥¯ÀÚ¤ì¾¦ÉÊ¥Ú¡¼¥¸', configuration_description='ÆÃ²Á¾¦ÉÊ¤ò¥È¥Ã¥×¥Ú¡¼¥¸¤ËÉ½¼¨ ¤·¤Þ¤¹¤«?\r\n(¥¨¥é¡¼¤È¥ê¥ó¥¯ÀÚ¤ì¾¦ÉÊ¥Ú¡¼¥¸¡¦/* ÌõÃí¡¦°ÕÌ£ÉÔÌÀ */)<br />\r\n0= off<br />\r\n¤Þ¤¿¤Ï½çÈÖ¤ò¿ôÃÍ(1¡Á4)¤ÇÀßÄê¤·¤Æ¤¯¤À¤µ¤¤¡£' WHERE configuration_key='SHOW_PRODUCT_INFO_MISSING_SPECIALS_PRODUCTS';
UPDATE configuration SET configuration_title='Æþ²ÙÍ½Äê¾¦ÉÊ¤ò¥È¥Ã¥×¥Ú¡¼¥¸¤ËÉ½¼¨¤¹¤ë - ¥¨¥é¡¼¤È¥ê¥ó¥¯ÀÚ¤ì¾¦ÉÊ¥Ú¡¼¥¸', configuration_description='Æþ²ÙÍ½Äê¾¦ÉÊ¤ò¥È¥Ã¥×¥Ú¡¼¥¸¤ËÉ½¼¨ ¤·¤Þ¤¹¤«?\r\n(¥¨¥é¡¼¤È¥ê¥ó¥¯ÀÚ¤ì¾¦ÉÊ¥Ú¡¼¥¸¡¦/* ÌõÃí¡¦°ÕÌ£ÉÔÌÀ */)<br />\r\n0= off<br />\r\n¤Þ¤¿¤Ï½çÈÖ¤ò¿ôÃÍ(1¡Á4)¤ÇÀßÄê¤·¤Æ¤¯¤À¤µ¤¤¡£' WHERE configuration_key='SHOW_PRODUCT_INFO_MISSING_UPCOMING';
UPDATE configuration SET configuration_title='¿·Ãå¾¦ÉÊ¤òÉ½¼¨¤¹¤ë - ¾¦ÉÊ¥ê¥¹¥È¤Î²¼Éô¤Ë', configuration_description='¾¦ÉÊ¥ê¥¹¥È¤Î²¼¤Ë¿·Ãå¾¦ÉÊ¤òÉ½¼¨¤·¤Þ¤¹¤«?\r\n<br />0= off <br />\r\n¤Þ¤¿¤ÏÇÛÃÖ½ç¤ò¿ôÃÍ(1¡Á4)¤ÇÀßÄê¤·¤Æ¤¯¤À¤µ¤¤¡£' WHERE configuration_key='SHOW_PRODUCT_INFO_LISTING_BELOW_NEW_PRODUCTS';
UPDATE configuration SET configuration_title='¤ª¤¹¤¹¤á¾¦ÉÊ¤òÉ½¼¨¤¹¤ë - ¾¦ÉÊ¥ê¥¹¥È¤Î²¼Éô¤Ë', configuration_description='¾¦ÉÊ¥ê¥¹¥È¤Î²¼¤Ë¤ª¤¹¤¹¤á¾¦ÉÊ¤òÉ½¼¨¤·¤Þ¤¹¤«?\r\n<br />0= off <br />\r\n¤Þ¤¿¤ÏÇÛÃÖ½ç¤ò¿ôÃÍ(1¡Á4)¤ÇÀßÄê¤·¤Æ¤¯¤À¤µ¤¤¡£' WHERE configuration_key='SHOW_PRODUCT_INFO_LISTING_BELOW_FEATURED_PRODUCTS';
UPDATE configuration SET configuration_title='ÆÃ²Á¾¦ÉÊ¤òÉ½¼¨¤¹¤ë - ¾¦ÉÊ¥ê¥¹¥È¤Î²¼Éô¤Ë', configuration_description='¾¦ÉÊ¥ê¥¹¥È¤Î²¼¤ËÆÃ²Á¾¦ÉÊ¤òÉ½¼¨¤·¤Þ¤¹¤«?\r\n<br />0= off <br />\r\n¤Þ¤¿¤ÏÇÛÃÖ½ç¤ò¿ôÃÍ(1¡Á4)¤ÇÀßÄê¤·¤Æ¤¯¤À¤µ¤¤¡£' WHERE configuration_key='SHOW_PRODUCT_INFO_LISTING_BELOW_SPECIALS_PRODUCTS';
UPDATE configuration SET configuration_title='Æþ²ÙÍ½Äê¾¦ÉÊ¤òÉ½¼¨¤¹¤ë - ¾¦ÉÊ¥ê¥¹¥È¤Î²¼Éô¤Ë', configuration_description='¾¦ÉÊ¥ê¥¹¥È¤Î²¼¤ËÆþ²ÙÍ½Äê¾¦ÉÊ¤òÉ½¼¨¤·¤Þ¤¹¤«?\r\n<br />0= off <br />\r\n¤Þ¤¿¤ÏÇÛÃÖ½ç¤ò¿ôÃÍ(1¡Á4)¤ÇÀßÄê¤·¤Æ¤¯¤À¤µ¤¤¡£' WHERE configuration_key='SHOW_PRODUCT_INFO_LISTING_BELOW_UPCOMING';
UPDATE configuration SET configuration_title='¿·Ãå¾¦ÉÊ - ²£Îó¤¢¤¿¤ê¤ÎÉ½¼¨ÅÀ¿ô', configuration_description='¿·Ãå¾¦ÉÊ¤ÎÎó(Row)¤¢¤¿¤ê¤ÎÇÛÃÖÅÀ¿ô¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='SHOW_PRODUCT_INFO_COLUMNS_NEW_PRODUCTS';
UPDATE configuration SET configuration_title='¤ª¤¹¤¹¤á¾¦ÉÊ - ²£Îó¤¢¤¿¤ê¤ÎÉ½¼¨ÅÀ¿ô', configuration_description='¤ª¤¹¤¹¤á¾¦ÉÊ¤ÎÎó(Row)¤¢¤¿¤ê¤ÎÇÛÃÖÅÀ¿ô¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='SHOW_PRODUCT_INFO_COLUMNS_FEATURED_PRODUCTS';
UPDATE configuration SET configuration_title='ÆÃ²Á¾¦ÉÊ - ²£Îó¤¢¤¿¤ê¤ÎÉ½¼¨ÅÀ¿ô', configuration_description='ÆÃ²Á¾¦ÉÊ¤ÎÎó(Row)¤¢¤¿¤ê¤ÎÇÛÃÖÅÀ¿ô¤òÀßÄê¤·¤Þ¤¹¡£' WHERE configuration_key='SHOW_PRODUCT_INFO_COLUMNS_SPECIALS_PRODUCTS';
UPDATE configuration SET configuration_title='¥È¥Ã¥×¥ì¥Ù¥ë(¿Æ)¥«¥Æ¥´¥ê¤Î¾¦ÉÊ¥ê¥¹¥ÈÉ½¼¨ - ¥Õ¥£¥ë¥¿É½¼¨¡¦Á´¾¦ÉÊÉ½¼¨', configuration_description='¸½ºß¤Î¥á¥¤¥ó¥«¥Æ¥´¥ê¤Ë¾¦ÉÊ¥ê¥¹¥È¤¬Å¬ÍÑ¤µ¤ì¤¿ºÝ¡¢¾¦ÉÊ¤ò¥Õ¥£¥ë¥¿É½¼¨¤·¤Þ¤¹¤«? ¤½¤ì¤È¤âÁ´¥«¥Æ¥´¥ê¤«¤é¾¦ÉÊ¤òÉ½¼¨¤·¤Þ¤¹¤«?<br />\r\n¡¦0= Filter\r\n¡¦Off 1=Filter On' WHERE configuration_key='SHOW_PRODUCT_INFO_ALL_PRODUCTS';
UPDATE configuration SET configuration_title='EZ¥Ú¡¼¥¸¤ÎÉ½¼¨ - ¥Ú¡¼¥¸¥Ø¥Ã¥À', configuration_description='EZ¥Ú¡¼¥¸¤Î¥³¥ó¥Æ¥ó¥Ä¤ò¥Ú¡¼¥¸¥Ø¥Ã¥À¤ËÉ½¼¨¤¹¤ë¤«¤É¤¦¤«¤ò¥°¥í¡¼¥Ð¥ë(¥µ¥¤¥ÈÁ´ÂÎ)¤ËÀßÄê¤·¤Þ¤¹¡£<br />0 = Off<br />1 = On<br />2= ¥µ¥¤¥È¥á¥ó¥Æ¥Ê¥ó¥¹¤ÎºÝ¤Ë´ÉÍý¼Ô¤ÎIP¥¢¥É¥ì¥¹¤Ç¥¢¥¯¥»¥¹¤·¤¿¾ì¹ç¤Î¤ßÉ½¼¨<br />Ãí°Õ¡§¥ï¡¼¥Ë¥ó¥°¤Ï¸ø³«¤µ¤ì¤º´ÉÍý¼Ô¤Ë¤À¤±É½¼¨¤µ¤ì¤Þ¤¹¡£' WHERE configuration_key='EZPAGES_STATUS_HEADER';
UPDATE configuration SET configuration_title='EZ¥Ú¡¼¥¸¤ÎÉ½¼¨ - ¥Ú¡¼¥¸¥Õ¥Ã¥¿', configuration_description='EZ¥Ú¡¼¥¸¤Î¥³¥ó¥Æ¥ó¥Ä¤ò¥Ú¡¼¥¸¥Õ¥Ã¥¿¤ËÉ½¼¨¤¹¤ë¤«¤É¤¦¤«¤ò¥°¥í¡¼¥Ð¥ë(¥µ¥¤¥ÈÁ´ÂÎ)¤ËÀßÄê¤·¤Þ¤¹¡£<br />0 = Off<br />1 = On<br />2= ¥µ¥¤¥È¥á¥ó¥Æ¥Ê¥ó¥¹¤ÎºÝ¤Ë´ÉÍý¼Ô¤ÎIP¥¢¥É¥ì¥¹¤Ç¥¢¥¯¥»¥¹¤·¤¿¾ì¹ç¤Î¤ßÉ½¼¨<br />Ãí°Õ¡§¥ï¡¼¥Ë¥ó¥°¤Ï¸ø³«¤µ¤ì¤º´ÉÍý¼Ô¤Ë¤À¤±É½¼¨¤µ¤ì¤Þ¤¹¡£' WHERE configuration_key='EZPAGES_STATUS_FOOTER';
UPDATE configuration SET configuration_title='EZ¥Ú¡¼¥¸¤ÎÉ½¼¨ - ¥µ¥¤¥É¥Ü¥Ã¥¯¥¹', configuration_description='EZ¥Ú¡¼¥¸¤Î¥³¥ó¥Æ¥ó¥Ä¤ò¥µ¥¤¥É¥Ü¥Ã¥¯¥¹¤ËÉ½¼¨¤¹¤ë¤«¤É¤¦¤«¤ò¥°¥í¡¼¥Ð¥ë(¥µ¥¤¥ÈÁ´ÂÎ)¤ËÀßÄê¤·¤Þ¤¹¡£<br />0 = Off<br />1 = On<br />2= ¥µ¥¤¥È¥á¥ó¥Æ¥Ê¥ó¥¹¤ÎºÝ¤Ë´ÉÍý¼Ô¤ÎIP¥¢¥É¥ì¥¹¤Ç¥¢¥¯¥»¥¹¤·¤¿¾ì¹ç¤Î¤ßÉ½¼¨<br />Ãí°Õ¡§¥ï¡¼¥Ë¥ó¥°¤Ï¸ø³«¤µ¤ì¤º´ÉÍý¼Ô¤Ë¤À¤±É½¼¨¤µ¤ì¤Þ¤¹¡£' WHERE configuration_key='EZPAGES_STATUS_SIDEBOX';
UPDATE configuration SET configuration_title='EZ¥Ú¡¼¥¸ ¤Î¥Ø¥Ã¥À - ¥ê¥ó¥¯¤Î¥»¥Ñ¥ì¡¼¥¿(¶èÀÚ¤êµ­¹æ)', configuration_description='E£Ú¥Ú¡¼¥¸¤Î¥Ø¥Ã¥À¤Î¥ê¥ó¥¯É½¼¨¤Î¥»¥Ñ¥ì¡¼¥¿(¶èÀÚ¤êÊ¸»ú)¤Ï?<br />¥Ç¥Õ¥©¥ë¥È = &amp;nbsp;::&amp;nbsp;' WHERE configuration_key='EZPAGES_SEPARATOR_HEADER';
UPDATE configuration SET configuration_title='EZ¥Ú¡¼¥¸ ¤Î¥Õ¥Ã¥¿ - ¥ê¥ó¥¯¤Î¥»¥Ñ¥ì¡¼¥¿(¶èÀÚ¤êµ­¹æ)', configuration_description='E£Ú¥Ú¡¼¥¸¤Î¥Õ¥Ã¥¿¤Î¥ê¥ó¥¯É½¼¨¤Î¥»¥Ñ¥ì¡¼¥¿(¶èÀÚ¤êÊ¸»ú)¤Ï?<br />¥Ç¥Õ¥©¥ë¥È = &amp;nbsp;::&amp;nbsp;' WHERE configuration_key='EZPAGES_SEPARATOR_FOOTER';
UPDATE configuration SET configuration_title='EZ¥Ú¡¼¥¸ - [¼¡¤Ø][Á°¤Ø]¥Ü¥¿¥ó', configuration_description='EZ¥Ú¡¼¥¸¤Î¥³¥ó¥Æ¥ó¥ÄÆâ[Á°¤Ø][Â³¤±¤ë][¼¡¤Ø]¥Ü¥¿¥ó¤òÉ½¼¨¤·¤Þ¤¹¤«?<br />0=OFF (¥Ü¥¿¥ó¤Ê¤·)<br />1=¡ÖÂ³¤±¤ë¡×¤òÉ½¼¨<br />2=¡ÖÁ°¤Ø¡×¡ÖÂ³¤±¤ë¡×¡Ö¼¡¤Ø¡×¤òÉ½¼¨<br /><br />¥Ç¥Õ¥©¥ë¥È¡§2' WHERE configuration_key='EZPAGES_SHOW_PREV_NEXT_BUTTONS';
UPDATE configuration SET configuration_title='EZ¥Ú¡¼¥¸ - ÌÜ¼¡¤ÎÉ½¼¨', configuration_description='EZ¥Ú¡¼¥¸¤ÎÌÜ¼¡¤òÉ½¼¨¤·¤Þ¤¹¤«?<br />0= OFF<br />1= ON' WHERE configuration_key='EZPAGES_SHOW_TABLE_CONTENTS';
UPDATE configuration SET configuration_title='EZ-¥Ú¡¼¥¸ - ¥Ø¥Ã¥À¤ÇÉ½¼¨¤·¤Ê¤¤¥Ú¡¼¥¸', configuration_description='EZ¥Ú¡¼¥¸¤Î¤¦¤ÁÄÌ¾ï¤Î¥Ú¡¼¥¸¥Ø¥Ã¥À¤ËÉ½¼¨¤·¤Ê¤¤¥Ú¡¼¥¸¤Ï?<br />É½¼¨¤·¤Ê¤¤¥Ú¡¼¥¸¤Î¥Ú¡¼¥¸ID¤ò¥«¥ó¥Þ(,)¶èÀÚ¤ê¤Çµ­½Ò¤·¤Æ¤¯¤À¤µ¤¤¡£¥Ú¡¼¥¸ID¤Ï´ÉÍý²èÌÌ¤Î[ÄÉ²ÃÀßÄê¡¦¥Ä¡¼¥ë]¤ÎEZ¥Ú¡¼¥¸ÀßÄê²èÌÌ¤Ç³ÎÇ§¤Ç¤­¤Þ¤¹¡£<br />Îã¡§1,5,2<br />¤Ê¤¤¾ì¹ç¤Ï¶õÍó¤Î¤Þ¤Þ' WHERE configuration_key='EZPAGES_DISABLE_HEADER_DISPLAY_LIST';
UPDATE configuration SET configuration_title='EZ-¥Ú¡¼¥¸ - ¥Õ¥Ã¥¿¤ÇÉ½¼¨¤·¤Ê¤¤¥Ú¡¼¥¸', configuration_description='EZ¥Ú¡¼¥¸¤Î¤¦¤ÁÄÌ¾ï¤Î¥Ú¡¼¥¸¥Õ¥Ã¥¿¤ËÉ½¼¨¤·¤Ê¤¤¥Ú¡¼¥¸¤Ï?<br />É½¼¨¤·¤Ê¤¤¥Ú¡¼¥¸¤Î¥Ú¡¼¥¸ID¤ò¥«¥ó¥Þ(,)¶èÀÚ¤ê¤Çµ­½Ò¤·¤Æ¤¯¤À¤µ¤¤¡£¥Ú¡¼¥¸ID¤Ï´ÉÍý²èÌÌ¤Î[ÄÉ²ÃÀßÄê¡¦¥Ä¡¼¥ë]¤ÎEZ¥Ú¡¼¥¸ÀßÄê²èÌÌ¤Ç³ÎÇ§¤Ç¤­¤Þ¤¹¡£<br />Îã¡§3,7<br />¤Ê¤¤¾ì¹ç¤Ï¶õÍó¤Î¤Þ¤Þ' WHERE configuration_key='EZPAGES_DISABLE_FOOTER_DISPLAY_LIST';
UPDATE configuration SET configuration_title='EZ-¥Ú¡¼¥¸ - º¸¥«¥é¥à¤ÇÉ½¼¨¤·¤Ê¤¤¥Ú¡¼¥¸', configuration_description='EZ¥Ú¡¼¥¸¤Î¤¦¤ÁÄÌ¾ï¤Îº¸¥«¥é¥à¤ËÉ½¼¨¤·¤Ê¤¤¥Ú¡¼¥¸¤Ï?<br />É½¼¨¤·¤Ê¤¤¥Ú¡¼¥¸¤Î¥Ú¡¼¥¸ID¤ò¥«¥ó¥Þ(,)¶èÀÚ¤ê¤Çµ­½Ò¤·¤Æ¤¯¤À¤µ¤¤¡£¥Ú¡¼¥¸ID¤Ï´ÉÍý²èÌÌ¤Î[ÄÉ²ÃÀßÄê¡¦¥Ä¡¼¥ë]¤ÎEZ¥Ú¡¼¥¸ÀßÄê²èÌÌ¤Ç³ÎÇ§¤Ç¤­¤Þ¤¹¡£<br />Îã¡§6,17<br />¤Ê¤¤¾ì¹ç¤Ï¶õÍó¤Î¤Þ¤Þ' WHERE configuration_key='EZPAGES_DISABLE_LEFTCOLUMN_DISPLAY_LIST';
UPDATE configuration SET configuration_title='EZ-¥Ú¡¼¥¸ - ±¦¥«¥é¥à¤ÇÉ½¼¨¤·¤Ê¤¤¥Ú¡¼¥¸', configuration_description='EZ¥Ú¡¼¥¸¤Î¤¦¤ÁÄÌ¾ï¤Î±¦¥«¥é¥à¤ËÉ½¼¨¤·¤Ê¤¤¥Ú¡¼¥¸¤Ï?<br />É½¼¨¤·¤Ê¤¤¥Ú¡¼¥¸¤Î¥Ú¡¼¥¸ID¤ò¥«¥ó¥Þ(,)¶èÀÚ¤ê¤Çµ­½Ò¤·¤Æ¤¯¤À¤µ¤¤¡£¥Ú¡¼¥¸ID¤Ï´ÉÍý²èÌÌ¤Î[ÄÉ²ÃÀßÄê¡¦¥Ä¡¼¥ë]¤ÎEZ¥Ú¡¼¥¸ÀßÄê²èÌÌ¤Ç³ÎÇ§¤Ç¤­¤Þ¤¹¡£<br />Îã¡§5,23,47<br />¤Ê¤¤¾ì¹ç¤Ï¶õÍó¤Î¤Þ¤Þ' WHERE configuration_key='EZPAGES_DISABLE_RIGHTCOLUMN_DISPLAY_LIST';

UPDATE configuration SET configuration_title = '¥È¥Ã¥×¥Ú¡¼¥¸¤ÎÄêµÁÎÎ°è - ¥¹¥Æ¡¼¥¿¥¹', configuration_description = 'ÊÔ½¸¤µ¤ì¤¿ÎÎ°è¤ÎÉ½¼¨¤ò¹Ô¤¤¤Þ¤¹¤«?<br />0= ¥ê¥ó¥¯:É½¼¨¡¡¡¡ÊÔ½¸ÎÎ°è:ÈóÉ½¼¨<br />1= ¥ê¥ó¥¯:É½¼¨¡¡¡¡ÊÔ½¸ÎÎ°è:É½¼¨<br />2= ¥ê¥ó¥¯:ÈóÉ½¼¨¡¡ÊÔ½¸ÎÎ°è:É½¼¨<br />3= ¥ê¥ó¥¯:ÈóÉ½¼¨¡¡ÊÔ½¸ÎÎ°è:ÈóÉ½¼¨' WHERE configuration_key = 'DEFINE_MAIN_PAGE_STATUS';
UPDATE configuration SET configuration_title = '¡Ö¤ªÌä¤¤¹ç¤ï¤»¡×¥Ú¡¼¥¸¤ÎÉ½¼¨ - ¥¹¥Æ¡¼¥¿¥¹', configuration_description = 'ÊÔ½¸¤µ¤ì¤¿¡Ö¤ªÌä¤¤¹ç¤ï¤»¡×¥Æ¥­¥¹¥È¤òÉ½¼¨¤·¤Þ¤¹¤«?<br />0= ¥ê¥ó¥¯:É½¼¨¡¡¡¡ÊÔ½¸ÎÎ°è:ÈóÉ½¼¨<br />1= ¥ê¥ó¥¯:É½¼¨¡¡¡¡ÊÔ½¸ÎÎ°è:É½¼¨<br />2= ¥ê¥ó¥¯:ÈóÉ½¼¨¡¡ÊÔ½¸ÎÎ°è:É½¼¨<br />3= ¥ê¥ó¥¯:ÈóÉ½¼¨¡¡ÊÔ½¸ÎÎ°è:ÈóÉ½¼¨' WHERE configuration_key = 'DEFINE_CONTACT_US_STATUS';
UPDATE configuration SET configuration_title = '¡Ö¸Ä¿Í¾ðÊóÊÝ¸îÊý¿Ë¡×É½¼¨ - ¥¹¥Æ¡¼¥¿¥¹', configuration_description = 'ÊÔ½¸¤µ¤ì¤¿¡Ö¸Ä¿Í¾ðÊóÊÝ¸îÊý¿Ë¡×¤òÉ½¼¨¤·¤Þ¤¹¤«?<br />0= ¥ê¥ó¥¯:É½¼¨¡¡¡¡ÊÔ½¸ÎÎ°è:ÈóÉ½¼¨<br />1= ¥ê¥ó¥¯:É½¼¨¡¡¡¡ÊÔ½¸ÎÎ°è:É½¼¨<br />2= ¥ê¥ó¥¯:ÈóÉ½¼¨¡¡ÊÔ½¸ÎÎ°è:É½¼¨<br />3= ¥ê¥ó¥¯:ÈóÉ½¼¨¡¡ÊÔ½¸ÎÎ°è:ÈóÉ½¼¨' WHERE configuration_key = 'DEFINE_PRIVACY_STATUS';
UPDATE configuration SET configuration_title = '¡ÖÇÛÁ÷¡¦Á÷ÎÁ¤Ë¤Ä¤¤¤Æ¡× ¥Ú¡¼¥¸ - ¥¹¥Æ¡¼¥¿¥¹', configuration_description = 'ÊÔ½¸¤µ¤ì¤¿¡ÖÇÛÁ÷¡¦Á÷ÎÁ¤Ë¤Ä¤¤¤Æ¡×¥Æ¥­¥¹¥È¤òÉ½¼¨¤·¤Þ¤¹¤«?<br />0= ¥ê¥ó¥¯:É½¼¨¡¡¡¡ÊÔ½¸ÎÎ°è:ÈóÉ½¼¨<br />1= ¥ê¥ó¥¯:É½¼¨¡¡¡¡ÊÔ½¸ÎÎ°è:É½¼¨<br />2= ¥ê¥ó¥¯:ÈóÉ½¼¨¡¡ÊÔ½¸ÎÎ°è:É½¼¨<br />3= ¥ê¥ó¥¯:ÈóÉ½¼¨¡¡ÊÔ½¸ÎÎ°è:ÈóÉ½¼¨' WHERE configuration_key = 'DEFINE_SHIPPINGINFO_STATUS';
UPDATE configuration SET configuration_title = '¡Ö¤´ÍøÍÑµ¬Ìó¡×¥Ú¡¼¥¸ - ¥¹¥Æ¡¼¥¿¥¹', configuration_description = 'ÊÔ½¸¤µ¤ì¤¿¡Ö¤´ÍøÍÑµ¬Ìó¡×¥Ú¡¼¥¸¤òÉ½¼¨¤·¤Þ¤¹¤«?<br />0= ¥ê¥ó¥¯:É½¼¨¡¡¡¡ÊÔ½¸ÎÎ°è:ÈóÉ½¼¨<br />1= ¥ê¥ó¥¯:É½¼¨¡¡¡¡ÊÔ½¸ÎÎ°è:É½¼¨<br />2= ¥ê¥ó¥¯:ÈóÉ½¼¨¡¡ÊÔ½¸ÎÎ°è:É½¼¨<br />3= ¥ê¥ó¥¯:ÈóÉ½¼¨¡¡ÊÔ½¸ÎÎ°è:ÈóÉ½¼¨' WHERE configuration_key = 'DEFINE_CONDITIONS_STATUS';
UPDATE configuration SET configuration_title = '¡Ö¤´ÃíÊ¸¤¬´°Î»¤·¤Þ¤·¤¿¡×¥Ú¡¼¥¸ - ¥¹¥Æ¡¼¥¿¥¹', configuration_description = 'ÊÔ½¸¤µ¤ì¤¿¡Ö¤´ÃíÊ¸¤¬´°Î»¤·¤Þ¤·¤¿¡×¥Æ¥­¥¹¥È¤òÉ½¼¨¤·¤Þ¤¹¤«?<br />0= ¥ê¥ó¥¯:É½¼¨¡¡¡¡ÊÔ½¸ÎÎ°è:ÈóÉ½¼¨<br />1= ¥ê¥ó¥¯:É½¼¨¡¡¡¡ÊÔ½¸ÎÎ°è:É½¼¨<br />2= ¥ê¥ó¥¯:ÈóÉ½¼¨¡¡ÊÔ½¸ÎÎ°è:É½¼¨<br />3= ¥ê¥ó¥¯:ÈóÉ½¼¨¡¡ÊÔ½¸ÎÎ°è:ÈóÉ½¼¨' WHERE configuration_key = 'DEFINE_CHECKOUT_SUCCESS_STATUS';
UPDATE configuration SET configuration_title = '¡Ö¥¯¡¼¥Ý¥ó·ô¡×¥Ú¡¼¥¸ - ¥¹¥Æ¡¼¥¿¥¹', configuration_description = 'ÊÔ½¸¤µ¤ì¤¿¡Ö¥¯¡¼¥Ý¥ó·ô¡×¥Æ¥­¥¹¥È¤òÉ½¼¨¤·¤Þ¤¹¤«?<br />0= ¥ê¥ó¥¯:É½¼¨¡¡¡¡ÊÔ½¸ÎÎ°è:ÈóÉ½¼¨<br />1= ¥ê¥ó¥¯:É½¼¨¡¡¡¡ÊÔ½¸ÎÎ°è:É½¼¨<br />2= ¥ê¥ó¥¯:ÈóÉ½¼¨¡¡ÊÔ½¸ÎÎ°è:É½¼¨<br />3= ¥ê¥ó¥¯:ÈóÉ½¼¨¡¡ÊÔ½¸ÎÎ°è:ÈóÉ½¼¨' WHERE configuration_key = 'DEFINE_DISCOUNT_COUPON_STATUS';
UPDATE configuration SET configuration_title = '¡Ö¥µ¥¤¥È¥Þ¥Ã¥×¡×¥Ú¡¼¥¸ - ¥¹¥Æ¡¼¥¿¥¹', configuration_description = 'ÊÔ½¸¤µ¤ì¤¿¡Ö¥¯¡¼¥Ý¥ó·ô¡×¥Æ¥­¥¹¥È¤òÉ½¼¨¤·¤Þ¤¹¤«?<br />0= ¥ê¥ó¥¯:É½¼¨¡¡¡¡ÊÔ½¸ÎÎ°è:ÈóÉ½¼¨<br />1= ¥ê¥ó¥¯:É½¼¨¡¡¡¡ÊÔ½¸ÎÎ°è:É½¼¨<br />2= ¥ê¥ó¥¯:ÈóÉ½¼¨¡¡ÊÔ½¸ÎÎ°è:É½¼¨<br />3= ¥ê¥ó¥¯:ÈóÉ½¼¨¡¡ÊÔ½¸ÎÎ°è:ÈóÉ½¼¨' WHERE configuration_key = 'DEFINE_SITE_MAP_STATUS';
UPDATE configuration SET configuration_title = '¼«Í³ÊÔ½¸¥Ú¡¼¥¸(Define Page) 2', configuration_description = '¼«Í³ÊÔ½¸¥Ú¡¼¥¸2¤òÉ½¼¨¤·¤Þ¤¹¤«?<br />0= ¥ê¥ó¥¯:É½¼¨¡¡¡¡ÊÔ½¸ÎÎ°è:ÈóÉ½¼¨<br />1= ¥ê¥ó¥¯:É½¼¨¡¡¡¡ÊÔ½¸ÎÎ°è:É½¼¨<br />2= ¥ê¥ó¥¯:ÈóÉ½¼¨¡¡ÊÔ½¸ÎÎ°è:É½¼¨<br />3= ¥ê¥ó¥¯:ÈóÉ½¼¨¡¡ÊÔ½¸ÎÎ°è:ÈóÉ½¼¨' WHERE configuration_key = 'DEFINE_PAGE_2_STATUS';
UPDATE configuration SET configuration_title = '¼«Í³ÊÔ½¸¥Ú¡¼¥¸(Define Page) 3', configuration_description = '¼«Í³ÊÔ½¸¥Ú¡¼¥¸3 ¤òÉ½¼¨¤·¤Þ¤¹¤«?<br />0= ¥ê¥ó¥¯:É½¼¨¡¡¡¡ÊÔ½¸ÎÎ°è:ÈóÉ½¼¨<br />1= ¥ê¥ó¥¯:É½¼¨¡¡¡¡ÊÔ½¸ÎÎ°è:É½¼¨<br />2= ¥ê¥ó¥¯:ÈóÉ½¼¨¡¡ÊÔ½¸ÎÎ°è:É½¼¨<br />3= ¥ê¥ó¥¯:ÈóÉ½¼¨¡¡ÊÔ½¸ÎÎ°è:ÈóÉ½¼¨' WHERE configuration_key = 'DEFINE_PAGE_3_STATUS';
UPDATE configuration SET configuration_title = '¼«Í³ÊÔ½¸¥Ú¡¼¥¸(Define Page) 4', configuration_description = '¼«Í³ÊÔ½¸¥Ú¡¼¥¸(Define Page) 4¤òÉ½¼¨¤·¤Þ¤¹¤«?<br />0= ¥ê¥ó¥¯:É½¼¨¡¡¡¡ÊÔ½¸ÎÎ°è:ÈóÉ½¼¨<br />1= ¥ê¥ó¥¯:É½¼¨¡¡¡¡ÊÔ½¸ÎÎ°è:É½¼¨<br />2= ¥ê¥ó¥¯:ÈóÉ½¼¨¡¡ÊÔ½¸ÎÎ°è:É½¼¨<br />3= ¥ê¥ó¥¯:ÈóÉ½¼¨¡¡ÊÔ½¸ÎÎ°è:ÈóÉ½¼¨' WHERE configuration_key = 'DEFINE_PAGE_4_STATUS';

# ¥á¡¼¥ëÁ÷¿®Àè¤òËÝÌõ¤¹¤ë
UPDATE `query_builder` SET `query_name` = 'Á´¸ÜµÒ' WHERE `query_id` =1 LIMIT 1;
UPDATE `query_builder` SET `query_name` = '¥á¡¼¥ë¥Þ¥¬¥¸¥ó´õË¾¼Ô' WHERE `query_id` =2 LIMIT 1;
UPDATE `query_builder` SET `query_name` = 'µÙÌ²¸ÜµÒ¡Ê²áµî»°¥ö·î´Ö¡¢ÇÛ¿®´õË¾¼Ô¤Î¤ß¡Ë' WHERE `query_id` =3 LIMIT 1;
UPDATE `query_builder` SET `query_name` = '²ÔÆ°¸ÜµÒ¡Ê²áµî»°¥ö·î´Ö¡¢ÇÛ¿®´õË¾¼Ô¤Î¤ß¡Ë' WHERE `query_id` =4 LIMIT 1;
UPDATE `query_builder` SET `query_name` = '²ÔÆ°¸ÜµÒ¡Ê²áµî»°¥ö·î´Ö¡Ë' WHERE `query_id` =5 LIMIT 1;
UPDATE `query_builder` SET `query_name` = '´ÉÍý¼Ô' WHERE `query_id` =6 LIMIT 1;

# product_type_layout¤ÎËÝÌõ

UPDATE product_type_layout  SET  configuration_title='·¿ÈÖÉ½¼¨', configuration_description='¾¦ÉÊ¾ðÊó¤Ç·¿ÈÖ¤òÉ½¼¨¤¹¤ë 0= off 1= on' WHERE configuration_title='Show Model Number' AND configuration_description='Display Model Number on Product Info 0= off 1= on';
UPDATE product_type_layout  SET  configuration_title='½ÅÎÌÉ½¼¨', configuration_description='¾¦ÉÊ¾ðÊó¤Ç·¿ÈÖ¤òÉ½¼¨¤¹¤ë 0= off 1= on' WHERE  configuration_title='Show Weight' AND configuration_description='Display Weight on Product Info 0= off 1= on';
UPDATE product_type_layout  SET  configuration_title='¥ª¥×¥·¥ç¥ó½ÅÎÌÉ½¼¨', configuration_description='¾¦ÉÊ¾ðÊó¤Ç¥ª¥×¥·¥ç¥ó¤Î½ÅÎÌ¤òÉ½¼¨¤¹¤ë¡£ 0= off 1= on' WHERE  configuration_title='Show Attribute Weight' AND configuration_description='Display Attribute Weight on Product Info 0= off 1= on';
UPDATE product_type_layout  SET  configuration_title='¥á¡¼¥«¡¼É½¼¨', configuration_description='¾¦ÉÊ¾ðÊó¤Ç¥á¡¼¥«¡¼¤òÉ½¼¨¤¹¤ë 0= off 1= on' WHERE  configuration_title='Show Manufacture' AND configuration_description='Display Manufacture Name on Product Info 0= off 1= on';
UPDATE product_type_layout  SET  configuration_title='¥«¡¼¥ÈÆâ¤Î¿ôÎÌÉ½¼¨', configuration_description='¾¦ÉÊ¾ðÊó¤Ç¥«¡¼¥ÈÆâ¤Î¿ôÎÌ¤òÉ½¼¨¤¹¤ë¡£ 0= off 1= on' WHERE  configuration_title='Show Quantity in Shopping Cart' AND configuration_description='Display Quantity in Current Shopping Cart on Product Info 0= off 1= on';
UPDATE product_type_layout  SET  configuration_title='ºß¸Ë¿ôÉ½¼¨', configuration_description='¾¦ÉÊ¾ðÊó¤Çºß¸Ë¿ô¤òÉ½¼¨¤¹¤ë¡£ 0= off 1= on' WHERE  configuration_title='Show Quantity in Stock' AND configuration_description='Display Quantity in Stock on Product Info 0= off 1= on';
UPDATE product_type_layout  SET  configuration_title='¥ì¥Ó¥å¡¼¿ôÉ½¼¨', configuration_description='¾¦ÉÊ¾ðÊó¤Ç¥ì¥Ó¥å¡¼¿ô¤òÉ½¼¨¤¹¤ë 0= off 1= on' WHERE  configuration_title='Show Product Reviews Count' AND configuration_description='Display Product Reviews Count on Product Info 0= off 1= on';
UPDATE product_type_layout  SET  configuration_title='¥ì¥Ó¥å¡¼¥Ü¥¿¥óÉ½¼¨', configuration_description='¾¦ÉÊ¾ðÊó¤Ç¥ì¥Ó¥å¡¼¥Ü¥¿¥ó¤òÉ½¼¨¤¹¤ë 0= off 1= on' WHERE  configuration_title='Show Product Reviews Button' AND configuration_description='Display Product Reviews Button on Product Info 0= off 1= on';
UPDATE product_type_layout  SET  configuration_title='¹ØÆþ²ÄÇ½¤Ë¤Ê¤Ã¤¿ÆüÉÕ¤ÎÉ½¼¨', configuration_description='¾¦ÉÊ¾ðÊó¤Ç¾¦ÉÊ¤¬¹ØÆþ²ÄÇ½¤Ë¤Ê¤Ã¤¿ÆüÉÕ¤òÉ½¼¨¤¹¤ë¡£ 0= off 1= on' WHERE  configuration_title='Show Date Available' AND configuration_description='Display Date Available on Product Info 0= off 1= on';
UPDATE product_type_layout  SET  configuration_title='ÅÐÏ¿ÆüÉ½¼¨', configuration_description='¾¦ÉÊ¾ðÊó¤Ç¾¦ÉÊ¤¬ÅÐÏ¿¤µ¤ì¤¿ÆüÉÕ¤òÉ½¼¨¤·¤Þ¤¹¡£ 0= off 1= on' WHERE  configuration_title='Show Date Added' AND configuration_description='Display Date Added on Product Info 0= off 1= on';
UPDATE product_type_layout  SET  configuration_title='¾¦ÉÊURLÉ½¼¨', configuration_description='¾¦ÉÊ¾ðÊó¤Ç¾¦ÉÊ¤ÎURL¤òÉ½¼¨¤¹¤ë 0= off 1= on' WHERE  configuration_title='Show Product URL' AND configuration_description='Display URL on Product Info 0= off 1= on';
UPDATE product_type_layout  SET  configuration_title='[Á°¤Ø][¼¡¤Ø]¥Ê¥Ó¥²¡¼¥·¥ç¥ó¥Ü¥¿¥óÉ½¼¨', configuration_description='¾¦ÉÊ¾ðÊó¤Ç[Á°¤Ø][¼¡¤Ø]¥Ê¥Ó¥²¡¼¥·¥ç¥ó¥Ü¥¿¥ó¤òÉ½¼¨¤¹¤ë¡£<br />0= off<br />1= ¥Ú¡¼¥¸¾åÉô<br />2= ¥Ú¡¼¥¸²¼Éô<br />3= ¥Ú¡¼¥¸¾åÉô¡¢²¼Éô' WHERE  configuration_title='Previous Next - Navigation Bar Position' AND configuration_description='Location of Previous/Next Navigation Bar<br />0= off<br />1= Top of Page<br />2= Bottom of Page<br />3= Both Top and Bottom of Page';
UPDATE product_type_layout  SET  configuration_title='[Á°¤Ø][¼¡¤Ø]¥Ê¥Ó¥²¡¼¥·¥ç¥ó¤ÎÊÂ¤Ó½ç', configuration_description='[Á°¤Ø][¼¡¤Ø]¥Ê¥Ó¥²¡¼¥·¥ç¥ó¤ÎÊÂ¤Ó½ç¤òÀßÄê¤¹¤ë¡£<br />0= ¾¦ÉÊID<br />1= ¾¦ÉÊÌ¾<br />2= ·¿ÈÖ<br />3= ²Á³Ê¡¢¾¦ÉÊÌ¾<br />4= ²Á³Ê, ·¿ÈÖl<br />5= ¾¦ÉÊÌ¾¡¢·¿ÈÖ' WHERE  configuration_title='Previous Next - Sort Order' AND configuration_description='Products Display Order by<br />0= Product ID<br />1= Product Name<br />2= Model<br />3= Price, Product Name<br />4= Price, Model<br />5= Product Name, Model';
UPDATE product_type_layout  SET  configuration_title='[Á°¤Ø][¼¡¤Ø]¥Ê¥Ó¥²¡¼¥·¥ç¥ó - ¥«¥Æ¥´¥êÉ½¼¨', configuration_description='[Á°¤Ø][¼¡¤Ø]¥Ü¥¿¥ó¤Î¾å¤ËÉ½¼¨¤¹¤ë¥«¥Æ¥´¥êÌ¾/²èÁü¤ÎÉ½¼¨°ÌÃÖ<br />0= off<br />1= º¸´ó¤»<br />2= Ãæ±û´ó¤»<br />3= ±¦´ó¤»' WHERE  configuration_title='Previous Next - Navigation Includes Category' AND configuration_description='Product\'s Category Image and Name Alignment Above Previous/Next Navigation Bar<br />0= off<br />1= Align Left<br />2= Align Center<br />3= Align Right';
UPDATE product_type_layout  SET  configuration_title='¡ÖÍ§Ã£¤ËÃÎ¤é¤»¤ë¡×¥Ü¥¿¥óÉ½¼¨', configuration_description='¾¦ÉÊ¾ðÊó¤Ç¡ÖÍ§Ã£¤ËÃÎ¤é¤»¤ë¡×¥Ü¥¿¥ó¤òÉ½¼¨¤¹¤ë¡£<br /><br />Note: ¤³¤ÎÀßÄê¤òoff¤Ë¤·¤Æ¤â¥µ¥¤¥É¥Ü¥Ã¥¯¥¹¤Î¡ÖÍ§Ã£¤ËÃÎ¤é¤»¤ë¡×¤Ï¾Ã¤¨¤Þ¤»¤ó¡£¤Þ¤¿¡¢¥µ¥¤¥É¥Ü¥Ã¥¯¥¹¤Î¡ÖÍ§Ã£¤ËÃÎ¤é¤»¤ë¡×¤òoff¤Ë¤·¤Æ¤â¤³¤Î¥Ü¥¿¥óÉ½¼¨¤ÎÀßÄê¤Ë±Æ¶Á¤Ï¤¢¤ê¤Þ¤»¤ó¡£<br />0= off 1= on' WHERE  configuration_title='Show Product Tell a Friend button' AND configuration_description='Display the Tell a Friend button on Product Info<br /><br />Note: Turning this setting off does not affect the Tell a Friend box in the columns and turning off the Tell a Friend box does not affect the button<br />0= off 1= on';
UPDATE product_type_layout  SET  configuration_title='ÉÔÌÀ¾¦ÉÊ¥Ú¡¼¥¸¥¢¥¯¥»¥¹»þ¤Ë¿·¾¦ÉÊ¤Î¥Ú¡¼¥¸¤òÉ½¼¨¤¹¤ë', configuration_description='ÉÔÌÀ¤Ê¾¦ÉÊ¥Ú¡¼¥¸¤Ë¥¢¥¯¥»¥¹¤¬¤¢¤Ã¤¿¾ì¹ç¤Ë¿·¾¦ÉÊ¥Ú¡¼¥¸¤òÉ½¼¨¤¹¤ë 0= off 1= on' WHERE  configuration_title='Show New Products on Missing Products Page' AND configuration_description='Show New Products on Missing Product 0= off 1= on';
UPDATE product_type_layout  SET  configuration_title='ÉÔÌÀ¾¦ÉÊ¥Ú¡¼¥¸¥¢¥¯¥»¥¹»þ¤ËÆþ²ÙÍ½Äê¾¦ÉÊ¤Î¥Ú¡¼¥¸¤òÉ½¼¨¤¹¤ë', configuration_description='ÉÔÌÀ¤Ê¾¦ÉÊ¥Ú¡¼¥¸¤Ë¥¢¥¯¥»¥¹¤¬¤¢¤Ã¤¿¾ì¹ç¤ËÆþ²ÙÍ½Äê¾¦ÉÊ¤Î¥Ú¡¼¥¸¤òÉ½¼¨¤¹¤ë 0= off 1= on' WHERE  configuration_title='Show Upcoming Products on Missing Products Page' AND configuration_description='Show Upcoming Products on Missing Product 0= off 1= on';
UPDATE product_type_layout  SET  configuration_title='¾¦ÉÊ¾ðÊó - ¾¦ÉÊ¥ª¥×¥·¥ç¥ó¤ÎÀ°Îó½ç', configuration_description='¾¦ÉÊ¥ª¥×¥·¥ç¥ó¤ÎÀ°Îó½ç¤Ë»ÈÍÑ¤¹¤ëÃÍ¤òÀßÄê¤·¤Þ¤¹¡£<br>0= À°Îó½çÈÖ¹æ¡¢¥ª¥×¥·¥ç¥óÌ¾<br>1= ¥ª¥×¥·¥ç¥óÌ¾¤Î¤ß' WHERE  configuration_title='' AND configuration_description='0';
UPDATE product_type_layout  SET  configuration_title='¾¦ÉÊ¾ðÊó - Â°À­À°Îó½ç', configuration_description='¾¦ÉÊ¥ª¥×¥·¥ç¥ó¤ÎÂ°À­¤ÎÀ°Îó½ç¤Ë»ÈÍÑ¤¹¤ëÃÍ¤òÀßÄê¤·¤Þ¤¹¡£<br>0= À°Îó½çÈÖ¹æ, ²Á³Ê<br>1= À°Îó½çÈÖ¹æ¡¢¥ª¥×¥·¥ç¥ó¤ÎÃÍ' WHERE  configuration_title='' AND configuration_description='1';
UPDATE product_type_layout  SET  configuration_title='1¹Ô¤ËÉ½¼¨¤¹¤ë¾¦ÉÊ¥ª¥×¥·¥ç¥ó²èÁü¿ô', configuration_description='¾¦ÉÊ¾ðÊó - °ì¹Ô¤ËÉ½¼¨¤¹¤ë¾¦ÉÊ¥ª¥×¥·¥ç¥ó¤Î²èÁü¿ô¤òÀßÄê¤·¤Þ¤¹¡£<br />¥Ç¥Õ¥©¥ë¥È = 5' WHERE  configuration_title='Product Info - Number of Attribute Images per Row' AND configuration_description='Product Info - Enter the number of attribute images to display per row<br />Default = 5';
UPDATE product_type_layout  SET  configuration_title='¾¦ÉÊ¥ª¥×¥·¥ç¥ó²èÁü¤Î²¼¤ËÉ½¼¨¤¹¤ë¥ª¥×¥·¥ç¥ó¤ÎÃÍ', configuration_description='¾¦ÉÊ¥ª¥×¥·¥ç¥ó²èÁü¤Î²¼¤Ë¥ª¥×¥·¥ç¥ó¤ÎÃÍ¤òÉ½¼¨¤·¤Þ¤¹¡£<br />0= off 1= on' WHERE  configuration_title='Product Info - Show Option Values Name Below Attributes Image' AND configuration_description='Product Info - Show the name of the Option Value beneath the Attribute Image?<br />0= off 1= on';
UPDATE product_type_layout  SET  configuration_title='¾¦ÉÊ¾ðÊó - ¥Õ¥©¡¼¥àÍ×ÁÇ(¥é¥¸¥ª¥Ü¥¿¥ó¤Þ¤¿¤Ï¥Á¥§¥Ã¥¯¥Ü¥Ã¥¯¥¹)', configuration_description='0= ²èÁü¤Î²¼¤Ë¥ª¥×¥·¥ç¥óÌ¾<br />1= ¥Õ¥©¡¼¥àÍ×ÁÇ¡¢²èÁü¡¢¥ª¥×¥·¥ç¥óÌ¾<br />2= ¥Õ¥©¡¼¥àÍ×ÁÇ¡¢²èÁü¡¢²¼¤Ë¥ª¥×¥·¥ç¥óÌ¾<br />3= ²èÁü¡¢¥Õ¥©¡¼¥àÍ×ÁÇ¡¢²¼¤Ë¥ª¥×¥·¥ç¥óÌ¾<br />4=²èÁü¡¢¥ª¥×¥·¥ç¥óÌ¾¡¢²¼¤Ë¥Õ¥©¡¼¥àÍ×ÁÇ<br />5= ²èÁü¡¢¥ª¥×¥·¥ç¥óÌ¾¡¢¾å¤Ë¥Õ¥©¡¼¥àÍ×ÁÇ' WHERE  configuration_title='Product Info - Show Option Values and Attributes Images for Radio Buttons and Checkboxes' AND configuration_description='0= Images Below Option Names<br />1= Element, Image and Option Value<br />2= Element, Image and Option Name Below<br />3= Option Name Below Element and Image<br />4= Element Below Image and Option Name<br />5= Element Above Image and Option Name';
UPDATE product_type_layout  SET  configuration_title='¾¦ÉÊ¾ðÊó - ¥»¡¼¥ë³ä°úÉ½¼¨', configuration_description='¥»¡¼¥ë³ä°úÊ¬¤òÉ½¼¨¤·¤Þ¤¹¡£<br />0= off 1= on' WHERE  configuration_title='Product Info - Show Sales Discount Savings Status' AND configuration_description='Product Info - Show the amount of discount savings?<br />0= off 1= on';
UPDATE product_type_layout  SET  configuration_title='¾¦ÉÊ¾ðÊó - ¥»¡¼¥ë³ä°ú¤ÎÉ½¼¨ÊýË¡(³ä°ú³Û , ¥Ñ¡¼¥»¥ó¥È)', configuration_description='¥»¡¼¥ë³ä°ú¤ÎÉ½¼¨ÊýË¡¤òÀßÄê¤·¤Þ¤¹¡£:<br />1= ³ä°úÎ¨(%) off 2= ³ä°ú¶â³Û off' WHERE  configuration_title='Product Info - Show Sales Discount Savings Dollars or Percentage' AND configuration_description='Product Info - Show the amount of discount savings display as:<br />1= % off 2= $amount off';
UPDATE product_type_layout  SET  configuration_title='¾¦ÉÊ¾ðÊó - ³ä°úÎ¨É½¼¨¤Î¾®¿ôÅÀ', configuration_description='³ä°úÎ¨É½¼¨¤Î¥Ñ¡¼¥»¥ó¥È¤Î¾®¿ôÅÀ°ÌÃÖ¤òÀßÄê¤·¤Þ¤¹¡£<br />¥Ç¥Õ¥©¥ë¥È= 0' WHERE  configuration_title='Product Info - Show Sales Discount Savings Percentage Decimals' AND configuration_description='Product Info - Show discount savings display as a Percentage with how many decimals?:<br />Default= 0';
UPDATE product_type_layout  SET  configuration_title= '¾¦ÉÊ¾ðÊó - ÌµÎÁ¾¦ÉÊÉ½¼¨ÀßÄê', configuration_description='ÌµÎÁ¾¦ÉÊ¤Ç¤¢¤ë¤³¤È¤ò²èÁü¤Þ¤¿¤Ï¥Æ¥­¥¹¥È¤ÇÉ½¼¨¤·¤Þ¤¹¡£<br />0= ¥Æ¥­¥¹¥È<br />1= ²èÁü' WHERE  configuration_title='Product Info - Price is Free Image or Text Status' AND configuration_description='Product Info - Show the Price is Free Image or Text on Displayed Price<br />0= Text<br />1= Image';
UPDATE product_type_layout  SET  configuration_title='¾¦ÉÊ¾ðÊó - ¤ªÌä¹ç¤»¾¦ÉÊÉ½¼¨ÀßÄê', configuration_description='¤ªÌä¹ç¤»¾¦ÉÊ¤Ç¤¢¤ë¤³¤È¤ò²èÁü¤Þ¤¿¤Ï¥Æ¥­¥¹¥È¤ÇÉ½¼¨¤·¤Þ¤¹¡£<br />0= ¥Æ¥­¥¹¥È<br />1= ²èÁü' WHERE  configuration_title='Product Info - Price is Call for Price Image or Text Status' AND configuration_description='Product Info - Show the Price is Call for Price Image or Text on Displayed Price<br />0= Text<br />1= Image';
UPDATE product_type_layout  SET  configuration_title='¿·¾¦ÉÊÅÐÏ¿»þ¤Îºß¸ËÉ½¼¨', configuration_description='¿·¾¦ÉÊÅÐÏ¿²èÌÌ¤Ç¥Ç¥Õ¥©¥ë¥È¤Îºß¸Ë¤ÎÉ½¼¨/ÈóÉ½¼¨¥¹¥Æ¡¼¥¿¥¹¤òÀßÄê¤·¤Þ¤¹¡£<br /><br />0= off<br />1= on<br />NOTE: ON¤Ë¤·¤¿¾ì¹çºß¸Ë¥Ü¥Ã¥¯¥¹¤òÉ½¼¨¤¹¤ë¤è¤¦¤Ë¤Ê¤ê¡¢¡Ö¥«¡¼¥È¤Ë¤¤¤ì¤ë¡×¥Ü¥Ã¥¯¥¹¤Ë1¤¬É½¼¨¤µ¤ì¤ë¤è¤¦¤Ë¤Ê¤ê¤Þ¤¹¡£' WHERE  configuration_title='Product Quantity Box Status' AND configuration_description='What should the Default Quantity Box Status be on New Products?<br /><br />0= off<br />1= on<br />NOTE: This will show a Qty Box when ON and default the Add to Cart to 1';
UPDATE product_type_layout  SET  configuration_title='Á÷ÎÁÌµÎÁ¤Î¥Ç¥Õ¥©¥ë¥È¥¹¥Æ¡¼¥¿¥¹ - ¿·¾¦ÉÊÄÉ²Ã»þ', configuration_description='¿·¾¦ÉÊ¤òÄÉ²Ã¤¹¤ë»þ¤Î¡¢Á÷ÎÁÌµÎÁ¤Î¥Ç¥Õ¥©¥ë¥È¥¹¥Æ¡¼¥¿¥¹¤òON¤Ë¤·¤Þ¤¹¤«¡©' WHERE configuration_title='Product Free Shipping Default Status - Normal Shipping Rules - When adding new products?' AND configuration_description='What should the Default Free Shipping status be when adding new products?';
UPDATE product_type_layout  SET  configuration_title='Á÷ÎÁÌµÎÁ¤Î²èÁü¥¹¥Æ¡¼¥¿¥¹ - ¥«¥¿¥í¥°', configuration_description='¥«¥¿¥í¥°Ãæ¤ÎÁ÷ÎÁÌµÎÁ¤Î²èÁü/¥Æ¥­¥¹¥È¤òÉ½¼¨¤·¤Þ¤¹¤«¡©' WHERE configuration_title='Product Free Shipping Image Status - Catalog' AND configuration_description='Show the Free Shipping image/text in the catalog?';
UPDATE product_type_layout  SET  configuration_title='ÀÇ¼ïÊÌ¤Î¥Ç¥Õ¥©¥ë¥È - ¿·¾¦ÉÊÄÉ²Ã»þ', configuration_description='¿·¾¦ÉÊ¤òÄÉ²Ã¤¹¤ë»þ¤Î¡¢ÀÇ¼ïÊÌ¤Î¥Ç¥Õ¥©¥ë¥ÈID¤òÆþÎÏ¤·¤Æ¤¯¤À¤µ¤¤¡£' WHERE configuration_title='Product Price Tax Class Default - When adding new products?' AND configuration_description='What should the Product Price Tax Class Default ID be when adding new products?';
UPDATE product_type_layout  SET  configuration_title='¥ô¥¡¡¼¥Á¥ã¥ë¾¦ÉÊ¤Î¥Ç¥Õ¥©¥ë¥È¥¹¥Æ¡¼¥¿¥¹ - ¿·¾¦ÉÊÄÉ²Ã»þ', configuration_description='¿·¾¦ÉÊ¤òÄÉ²Ã¤¹¤ë»þ¤Î¡¢¥ô¥¡¡¼¥Á¥ã¥ë¾¦ÉÊ¤Î¥Ç¥Õ¥©¥ë¥È¥¹¥Æ¡¼¥¿¥¹¤òON¤Ë¤·¤Þ¤¹¤«¡©' WHERE configuration_title='Product Virtual Default Status - Skip Shipping Address - When adding new products?' AND configuration_description='Default Virtual Product status to be ON when adding new products?';
UPDATE product_type_layout  SET  configuration_title='¥¢¡¼¥Æ¥£¥¹¥È¤ÎÉ½¼¨', configuration_description='¾¦ÉÊ¥Ú¡¼¥¸¤Ë¡¢¥¢¡¼¥Æ¥£¥¹¥ÈÌ¾¤òÉ½¼¨¤·¤Þ¤¹¤«¡©0= off 1= on' WHERE configuration_title='Show Artist' AND configuration_description='Display Artists Name on Product Info 0= off 1= on';
UPDATE product_type_layout  SET  configuration_title='¥á¡¼¥«¡¼¤ÎÉ½¼¨', configuration_description='¾¦ÉÊ¥Ú¡¼¥¸¤Ë¡¢¥á¡¼¥«¡¼Ì¾¤òÉ½¼¨¤·¤Þ¤¹¤«¡©0= off 1= on' WHERE configuration_title='Show Manufacturer' AND configuration_description='Display Manufacturer Name on Product Info 0= off 1= on';
UPDATE product_type_layout  SET  configuration_title='²»³Ú¥¸¥ã¥ó¥ë¤ÎÉ½¼¨', configuration_description='¾¦ÉÊ¥Ú¡¼¥¸¤Ë¡¢²»³Ú¥¸¥ã¥ó¥ë¤òÉ½¼¨¤·¤Þ¤¹¤«¡©0= off 1= on' WHERE configuration_title='Show Music Genre' AND configuration_description='Display Music Genre on Product Info 0= off 1= on';
UPDATE product_type_layout  SET  configuration_title='¥ì¥³¡¼¥É²ñ¼Ò¤ÎÉ½¼¨', configuration_description='¾¦ÉÊ¥Ú¡¼¥¸¤Ë¡¢¥ì¥³¡¼¥É²ñ¼Ò¤òÉ½¼¨¤·¤Þ¤¹¤«¡©0= off 1= on' WHERE configuration_title='Show Record Company' AND configuration_description='Display Recoprd Company on Product Info 0= off 1= on';
UPDATE product_type_layout  SET  configuration_title='¥Ù¡¼¥¹²Á³Ê¤ÎÉ½¼¨', configuration_description='¾¦ÉÊ¥Ú¡¼¥¸¤Ë¡¢¥Ù¡¼¥¹²Á³Ê¤òÉ½¼¨¤·¤Þ¤¹¤«¡©0= off 1= on' WHERE configuration_title='Show Starting At text on Price' AND configuration_description='Display Starting At text on products with attributes Product Info 0= off 1= on';

ALTER TABLE coupon_gv_customer CHANGE amount amount decimal(20,4) NOT NULL default '0.0000';
ALTER TABLE coupon_gv_queue CHANGE amount amount decimal(20,4) NOT NULL default '0.0000';
UPDATE configuration SET configuration_value='On' where configuration_key='MISSING_PAGE_CHECK';
UPDATE configuration SET configuration_value='107' where configuration_key='SHIPPING_ORIGIN_COUNTRY';

# column layout grid for product listing
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, 
       configuration_description, configuration_group_id, sort_order, 
       last_modified, date_added, use_function, set_function) 
       VALUES ('Product Listing - Layout Style', 'PRODUCT_LISTING_LAYOUT_STYLE', 'rows', 
               'Select the layout style:<br />Each product can be listed in its own row (rows option)
                or products can be listed in multiple columns per row (columns option)', '8', '40', NULL, 
                now(), NULL, 'zen_cfg_select_option(array("rows", "columns"),');

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, 
       configuration_description, configuration_group_id, sort_order, 
       last_modified, date_added, use_function, set_function) 
       VALUES ('Product Listing - Columns Per Row', 'PRODUCT_LISTING_COLUMNS_PER_ROW', '3', 
               'Select the number of columns of products to show in each row in the product listing.  
               The default setting is 3.', '8', '41', NULL, now(), NULL, NULL);

## Cross Sell v1.3.0
#
## The following is used to install the Cross-Sell Products mapping table and the admin switches for display control in the catalog.
## This script should be able to be run from Admin->Tools->Install SQL Patches
#

DROP TABLE IF EXISTS products_xsell;
CREATE TABLE products_xsell (
  ID int(10) NOT NULL auto_increment,
  products_id int(10) unsigned NOT NULL default 1,
  xsell_id int(10) unsigned NOT NULL default 1,
  sort_order int(10) unsigned NOT NULL default 1,
  PRIMARY KEY  (ID), 
  KEY idx_products_id_xsell (products_id)
) TYPE=MyISAM;


## add switches for:  MIN_DISPLAY_XSELL, MAX_DISPLAY_XSELL
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Cross-Sell Products', 'MIN_DISPLAY_XSELL', 1, 'This is the minimum number of configured Cross-Sell products required in order to cause the Cross Sell information to be displayed.<br />Default: 1', 2, 17, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Display Cross-Sell Products', 'MAX_DISPLAY_XSELL', 6, 'This is the maximum number of configured Cross-Sell products to be displayed.<br />Default: 6', 3, 66, now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Cross-Sell Products Columns per Row', 'SHOW_PRODUCT_INFO_COLUMNS_XSELL_PRODUCTS', '3', 'Cross-Sell Products Columns to display per Row<br />0= off or set the sort order.<br />Default: 3', 18, 72, 'zen_cfg_select_option(array(0, 1, 2, 3, 4), ', now());
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Cross-Sell - Display prices?', 'XSELL_DISPLAY_PRICE', 'false', 'Cross-Sell -- Do you want to display the product prices too?<br />Default: false', 18, 72, 'zen_cfg_select_option(array(\'true\',\'false\'), ', now());
