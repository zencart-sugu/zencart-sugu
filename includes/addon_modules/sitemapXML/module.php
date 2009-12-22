<?php
/**
 * sitemap_xml Module
 *
 * @package Addon Modules
 * @copyright Copyright (C) 2009 Liquid System Technology, Inc.
 * @author Koji Sasaki
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: sitemap_xml.php $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

  class sitemapXML extends addonModuleBase {
    var $title = MODULE_SITEMAPXML_TITLE;
    var $description = MODULE_SITEMAPXML_DESCRIPTION;
    var $sort_order = MODULE_SITEMAPXML_SORT_ORDER;
    var $icon;
    var $status = MODULE_SITEMAPXML_STATUS;
    var $enabled;
    var $configuration_keys = array(
          array(
            'configuration_title' => MODULE_SITEMAPXML_STATUS_TITLE,
            'configuration_key' => 'MODULE_SITEMAPXML_STATUS',
            'configuration_value' => MODULE_SITEMAPXML_STATUS_DEFAULT,
            'configuration_description' => MODULE_SITEMAPXML_STATUS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title' => MODULE_SITEMAPXML_COMPRESS_TITLE,
            'configuration_key' => 'MODULE_SITEMAPXML_COMPRESS',
            'configuration_value' => MODULE_SITEMAPXML_COMPRESS_DEFAULT,
            'configuration_description' => MODULE_SITEMAPXML_COMPRESS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title' => MODULE_SITEMAPXML_LASTMOD_FORMAT_TITLE,
            'configuration_key' => 'MODULE_SITEMAPXML_LASTMOD_FORMAT',
            'configuration_value' => MODULE_SITEMAPXML_LASTMOD_FORMAT_DEFAULT,
            'configuration_description' => MODULE_SITEMAPXML_LASTMOD_FORMAT_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'date\', \'full\'), '
          ),
          array(
            'configuration_title' => MODULE_SITEMAPXML_USE_EXISTING_FILES_TITLE,
            'configuration_key' => 'MODULE_SITEMAPXML_USE_EXISTING_FILES',
            'configuration_value' => MODULE_SITEMAPXML_USE_EXISTING_FILES_DEFAULT,
            'configuration_description' => MODULE_SITEMAPXML_USE_EXISTING_FILES_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title' => MODULE_SITEMAPXML_USE_DEFAULT_LANGUAGE_TITLE,
            'configuration_key' => 'MODULE_SITEMAPXML_USE_DEFAULT_LANGUAGE',
            'configuration_value' => MODULE_SITEMAPXML_USE_DEFAULT_LANGUAGE_DEFAULT,
            'configuration_description' => MODULE_SITEMAPXML_USE_DEFAULT_LANGUAGE_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title' => MODULE_SITEMAPXML_PING_URLS_TITLE,
            'configuration_key' => 'MODULE_SITEMAPXML_PING_URLS',
            'configuration_value' => MODULE_SITEMAPXML_PING_URLS_DEFAULT,
            'configuration_description' => MODULE_SITEMAPXML_PING_URLS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_textarea('
          ),
          array(
            'configuration_title' => MODULE_SITEMAPXML_PRODUCTS_ORDERBY_TITLE,
            'configuration_key' => 'MODULE_SITEMAPXML_PRODUCTS_ORDERBY',
            'configuration_value' => MODULE_SITEMAPXML_PRODUCTS_ORDERBY_DEFAULT,
            'configuration_description' => MODULE_SITEMAPXML_PRODUCTS_ORDERBY_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_SITEMAPXML_PRODUCTS_CHANGEFREQ_TITLE,
            'configuration_key' => 'MODULE_SITEMAPXML_PRODUCTS_CHANGEFREQ',
            'configuration_value' => MODULE_SITEMAPXML_PRODUCTS_CHANGEFREQ_DEFAULT,
            'configuration_description' => MODULE_SITEMAPXML_PRODUCTS_CHANGEFREQ_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'always\', \'hourly\', \'daily\', \'weekly\', \'monthly\', \'yearly\', \'never\'),'
          ),
          array(
            'configuration_title' => MODULE_SITEMAPXML_CATEGORIES_ORDERBY_TITLE,
            'configuration_key' => 'MODULE_SITEMAPXML_CATEGORIES_ORDERBY',
            'configuration_value' => MODULE_SITEMAPXML_CATEGORIES_ORDERBY_DEFAULT,
            'configuration_description' => MODULE_SITEMAPXML_CATEGORIES_ORDERBY_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_SITEMAPXML_CATEGORIES_CHANGEFREQ_TITLE,
            'configuration_key' => 'MODULE_SITEMAPXML_CATEGORIES_CHANGEFREQ',
            'configuration_value' => MODULE_SITEMAPXML_CATEGORIES_CHANGEFREQ_DEFAULT,
            'configuration_description' => MODULE_SITEMAPXML_CATEGORIES_CHANGEFREQ_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'always\', \'hourly\', \'daily\', \'weekly\', \'monthly\', \'yearly\', \'never\'),'
          ),
          array(
            'configuration_title' => MODULE_SITEMAPXML_REVIEWS_ORDERBY_TITLE,
            'configuration_key' => 'MODULE_SITEMAPXML_REVIEWS_ORDERBY',
            'configuration_value' => MODULE_SITEMAPXML_REVIEWS_ORDERBY_DEFAULT,
            'configuration_description' => MODULE_SITEMAPXML_REVIEWS_ORDERBY_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_SITEMAPXML_REVIEWS_CHANGEFREQ_TITLE,
            'configuration_key' => 'MODULE_SITEMAPXML_REVIEWS_CHANGEFREQ',
            'configuration_value' => MODULE_SITEMAPXML_REVIEWS_CHANGEFREQ_DEFAULT,
            'configuration_description' => MODULE_SITEMAPXML_REVIEWS_CHANGEFREQ_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'always\', \'hourly\', \'daily\', \'weekly\', \'monthly\', \'yearly\', \'never\'),'
          ),
          array(
            'configuration_title' => MODULE_SITEMAPXML_EZPAGES_ORDERBY_TITLE,
            'configuration_key' => 'MODULE_SITEMAPXML_EZPAGES_ORDERBY',
            'configuration_value' => MODULE_SITEMAPXML_EZPAGES_ORDERBY_DEFAULT,
            'configuration_description' => MODULE_SITEMAPXML_EZPAGES_ORDERBY_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_SITEMAPXML_EZPAGES_CHANGEFREQ_TITLE,
            'configuration_key' => 'MODULE_SITEMAPXML_EZPAGES_CHANGEFREQ',
            'configuration_value' => MODULE_SITEMAPXML_EZPAGES_CHANGEFREQ_DEFAULT,
            'configuration_description' => MODULE_SITEMAPXML_EZPAGES_CHANGEFREQ_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'always\', \'hourly\', \'daily\', \'weekly\', \'monthly\', \'yearly\', \'never\'),'
          ),
          array(
            'configuration_title' => MODULE_SITEMAPXML_TESTIMONIALS_ORDERBY_TITLE,
            'configuration_key' => 'MODULE_SITEMAPXML_TESTIMONIALS_ORDERBY',
            'configuration_value' => MODULE_SITEMAPXML_TESTIMONIALS_ORDERBY_DEFAULT,
            'configuration_description' => MODULE_SITEMAPXML_TESTIMONIALS_ORDERBY_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_SITEMAPXML_TESTIMONIALS_CHANGEFREQ_TITLE,
            'configuration_key' => 'MODULE_SITEMAPXML_TESTIMONIALS_CHANGEFREQ',
            'configuration_value' => MODULE_SITEMAPXML_TESTIMONIALS_CHANGEFREQ_DEFAULT,
            'configuration_description' => MODULE_SITEMAPXML_TESTIMONIALS_CHANGEFREQ_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'always\', \'hourly\', \'daily\', \'weekly\', \'monthly\', \'yearly\', \'never\'),'
          ),
          array(
            'configuration_title' => MODULE_SITEMAPXML_SORT_ORDER_TITLE,
            'configuration_key' => 'MODULE_SITEMAPXML_SORT_ORDER',
            'configuration_value' => MODULE_SITEMAPXML_SORT_ORDER_DEFAULT,
            'configuration_description' => MODULE_SITEMAPXML_SORT_ORDER_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
        );
    var $require_modules = array();
    var $notifier = array();

    var $author                        = "Koji Sasaki";
    var $author_email                  = "info@zencart-sugu.jp";
    var $version                       = "0.1";
    var $require_zen_cart_version      = "1.3.0.2";
    var $require_addon_modules_version = "0.1";

    // class constructer for php4
    function sitemapXML() {
      $this->__construct();
    }

    function notifierUpdate($notifier) {
    }

    function _install() {
    }

    function _update() {
    }

    function _remove() {
    }

    function _cleanUp() {
    }

    function page() {
      global $zco_notifier, $breadcrumb, $template, $current_page_base, $robotsNoIndex, $this_is_home_page, $cPath, $page_directory, $db, $template_dir, $language_page_directory, $gss_tpl_dir;

      $gss_tpl_dir = $this->_getTemplateDir('gss\.xsl', 'templates', 'css');
      include('includes/addon_modules/sitemapXML/lib/header_php.php');
      include($this->_getTemplateDir('sitemapXML.php', 'templates', 'templates'). '/sitemapXML.php');
      exit;
    }
  }
