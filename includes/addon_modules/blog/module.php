<?php
/**
 * addon_modules_example Module
 *
 * @package Viewed_products
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: addon_modules_example.php $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

  class blog extends addonModuleBase {
    var $author                        = array("kohata");
    var $author_email                  = "info@zencart-sugu.jp";
    var $version                       = "0.1.2";
    var $require_zen_cart_version      = "1.3.0.2";
    var $require_addon_modules_version = "0.1.1";

    var $title       = MODULE_BLOG_TITLE;
    var $description = MODULE_BLOG_DESCRIPTION;
    var $sort_order  = MODULE_BLOG_SORT_ORDER;
    var $icon;
    var $status      = MODULE_BLOG_STATUS;
    var $enabled;
    var $configuration_keys = array(
          array(
            'configuration_title'       => MODULE_BLOG_STATUS_TITLE,
            'configuration_key'         => 'MODULE_BLOG_STATUS',
            'configuration_value'       => MODULE_BLOG_STATUS_DEFAULT,
            'configuration_description' => MODULE_BLOG_STATUS_DESCRIPTION,
            'use_function'              => 'null',
            'set_function'              => 'zen_cfg_select_option(array(\'true\', \'false\'),'
          ),
          array(
            'configuration_title'       => MODULE_BLOG_URL_TITLE,
            'configuration_key'         => 'MODULE_BLOG_URL',
            'configuration_value'       => MODULE_BLOG_URL_DEFAULT,
            'configuration_description' => MODULE_BLOG_URL_DESCRIPTION,
            'use_function'              => 'null',
            'set_function'              => 'null',
          ),
          array(
            'configuration_title'       => MODULE_BLOG_TIMEOUT_TITLE,
            'configuration_key'         => 'MODULE_BLOG_TIMEOUT',
            'configuration_value'       => MODULE_BLOG_TIMEOUT_DEFAULT,
            'configuration_description' => MODULE_BLOG_TIMEOUT_DESCRIPTION,
            'use_function'              => 'null',
            'set_function'              => 'null',
          ),
          array(
            'configuration_title'       => MODULE_BLOG_COUNT_TITLE,
            'configuration_key'         => 'MODULE_BLOG_COUNT',
            'configuration_value'       => MODULE_BLOG_COUNT_DEFAULT,
            'configuration_description' => MODULE_BLOG_COUNT_DESCRIPTION,
            'use_function'              => 'null',
            'set_function'              => 'null',
          ),
          array(
            'configuration_title'       => MODULE_BLOG_SORT_ORDER_TITLE,
            'configuration_key'         => 'MODULE_BLOG_SORT_ORDER',
            'configuration_value'       => MODULE_BLOG_SORT_ORDER_DEFAULT,
            'configuration_description' => MODULE_BLOG_SORT_ORDER_DESCRIPTION,
            'use_function'              => 'null',
            'set_function'              => 'null'
          ),
        );
    var $require_modules = array();
    var $notifier        = array();

    // class constructer for php4
    function blog() {
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

    // blocks
    // ¡Œ‚Æ—ˆŒ‚ÌƒJƒŒƒ“ƒ_[ì¬
    function block() {
      $rss = getRss(MODULE_BLOG_URL, MODULE_BLOG_PORT, MODULE_BLOG_TIMEOUT);

      // æ“¾‚µ‚½rss‚Ì•ÏŠ·
      $converted_rss = array();
      for ($i=0; $i<count($rss['rss']->items); $i++) {
        if (MODULE_BLOG_COUNT > 0 &&
            $i >= MODULE_BLOG_COUNT)
          break;

        $date = rssSearchDate($rss['rss']->items[$i]);
        if ($date == "")
          $date = 0;
        else
          $date = strtotime($date);
        $converted_rss[] = array(
          'title'       => rssConverText($rss['rss']->items[$i]['title']),
          'link'        => rssConverText($rss['rss']->items[$i]['link']),
          'description' => rssConverText($rss['rss']->items[$i]['description']),
          'date'        => $date,
        );
      }

      $return          = array();
      $return['title'] = MODULE_BLOG_TITLE;
      $return['rss']   = $converted_rss;
      $return['error'] = $rss['error'];
      return $return;
    }

  }
?>