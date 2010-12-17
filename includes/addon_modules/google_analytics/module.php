<?php
/**
 * module.php
 *
 * @package zen-cart addon module google analytics
 * @copyright Copyright 2004-2008 Andrew Berezin eCommerce-Service.com
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: module.php $
 * based on tpl_footer_googleanalytics.php, v 2.2.1 01.09.2008 01:23 Andrew Berezin
 */

if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

  class google_analytics extends addonModuleBase {
    var $author                        = array("saito",
                                               "Andrew Berezin");
    var $author_email                  = "info@zencart-sugu.jp";
    var $version                       = "0.1.1";
    var $require_zen_cart_version      = "1.3.0.2";
    var $require_addon_modules_version = "0.1.1";

    var $title       = MODULE_GOOGLE_ANALYTICS_TITLE;
    var $description = MODULE_GOOGLE_ANALYTICS_DESCRIPTION;
    var $sort_order  = MODULE_GOOGLE_ANALYTICS_SORT_ORDER_DEFAULT;
    var $icon;
    var $status      = MODULE_GOOGLE_ANALYTICS_STATUS;
    var $enabled;
    var $configuration_keys = array(
          array(
            'configuration_title'       => MODULE_GOOGLE_ANALYTICS_STATUS_TITLE,
            'configuration_key'         => 'MODULE_GOOGLE_ANALYTICS_STATUS',
            'configuration_value'       => MODULE_GOOGLE_ANALYTICS_STATUS_DEFAULT,
            'configuration_description' => MODULE_GOOGLE_ANALYTICS_STATUS_DESCRIPTION,
            'use_function'              => 'null',
            'set_function'              => 'zen_cfg_select_option(array(\'true\', \'false\'),'),
          array(
            'configuration_title'       => MODULE_GOOGLE_ANALYTICS_ACCOUNT_TITLE,
            'configuration_key'         => 'MODULE_GOOGLE_ANALYTICS_ACCOUNT',
            'configuration_value'       => MODULE_GOOGLE_ANALYTICS_ACCOUNT_DEFAULT,
            'configuration_description' => MODULE_GOOGLE_ANALYTICS_ACCOUNT_DESCRIPTION,
            'use_function'              => 'null',
            'set_function'              => 'null'),
          array(
            'configuration_title'       => MODULE_GOOGLE_ANALYTICS_TARGET_TITLE,
            'configuration_key'         => 'MODULE_GOOGLE_ANALYTICS_TARGET',
            'configuration_value'       => MODULE_GOOGLE_ANALYTICS_TARGET_DEFAULT,
            'configuration_description' => MODULE_GOOGLE_ANALYTICS_TARGET_DESCRIPTION,
            'use_function'              => 'null',
            'set_function'              => 'zen_cfg_select_option(array(\'customers\', \'delivery\', \'billing\'),'),
          array(
            'configuration_title'       => MODULE_GOOGLE_ANALYTICS_AFFILIATION_TITLE,
            'configuration_key'         => 'MODULE_GOOGLE_ANALYTICS_AFFILIATION',
            'configuration_value'       => MODULE_GOOGLE_ANALYTICS_AFFILIATION_DEFAULT,
            'configuration_description' => MODULE_GOOGLE_ANALYTICS_AFFILIATION_DESCRIPTION,
            'use_function'              => 'null',
            'set_function'              => 'null'),
          array(
            'configuration_title'       => MODULE_GOOGLE_ANALYTICS_SKU_OR_CODE_TITLE,
            'configuration_key'         => 'MODULE_GOOGLE_ANALYTICS_SKU_OR_CODE',
            'configuration_value'       => MODULE_GOOGLE_ANALYTICS_SKU_OR_CODE_DEFAULT,
            'configuration_description' => MODULE_GOOGLE_ANALYTICS_SKU_OR_CODE_DESCRIPTION,
            'use_function'              => 'null',
            'set_function'              => 'zen_cfg_select_option(array(\'products_id\', \'products_model\'),'),
          array(
            'configuration_title'       => MODULE_GOOGLE_ANALYTICS_PAGENAME_TITLE,
            'configuration_key'         => 'MODULE_GOOGLE_ANALYTICS_PAGENAME',
            'configuration_value'       => MODULE_GOOGLE_ANALYTICS_PAGENAME_DEFAULT,
            'configuration_description' => MODULE_GOOGLE_ANALYTICS_PAGENAME_DESCRIPTION,
            'use_function'              => 'null',
            'set_function'              => 'zen_cfg_select_option(array(\'true\', \'false\'),'),
          array(
            'configuration_title'       => MODULE_GOOGLE_ANALYTICS_BRACKETS_TITLE,
            'configuration_key'         => 'MODULE_GOOGLE_ANALYTICS_BRACKETS',
            'configuration_value'       => MODULE_GOOGLE_ANALYTICS_BRACKETS_DEFAULT,
            'configuration_description' => MODULE_GOOGLE_ANALYTICS_BRACKETS_DESCRIPTION,
            'use_function'              => 'null',
            'set_function'              => 'null'),
          array(
            'configuration_title'       => MODULE_GOOGLE_ANALYTICS_DELIMITER_TITLE,
            'configuration_key'         => 'MODULE_GOOGLE_ANALYTICS_DELIMITER',
            'configuration_value'       => MODULE_GOOGLE_ANALYTICS_DELIMITER_DEFAULT,
            'configuration_description' => MODULE_GOOGLE_ANALYTICS_DELIMITER_DESCRIPTION,
            'use_function'              => 'null',
            'set_function'              => 'null'),
          array(
            'configuration_title'       => MODULE_GOOGLE_ANALYTICS_OUTBOUND_TITLE,
            'configuration_key'         => 'MODULE_GOOGLE_ANALYTICS_OUTBOUND',
            'configuration_value'       => MODULE_GOOGLE_ANALYTICS_OUTBOUND_DEFAULT,
            'configuration_description' => MODULE_GOOGLE_ANALYTICS_OUTBOUND_DESCRIPTION,
            'use_function'              => 'null',
            'set_function'              => 'zen_cfg_select_option(array(\'true\', \'false\'),'),
          array(
            'configuration_title'       => MODULE_GOOGLE_ANALYTICS_OUTBOUND_LINKS_PREFIX_TITLE,
            'configuration_key'         => 'MODULE_GOOGLE_ANALYTICS_OUTBOUND_LINKS_PREFIX',
            'configuration_value'       => MODULE_GOOGLE_ANALYTICS_OUTBOUND_LINKS_PREFIX_DEFAULT,
            'configuration_description' => MODULE_GOOGLE_ANALYTICS_OUTBOUND_LINKS_PREFIX_DESCRIPTION,
            'use_function'              => 'null',
            'set_function'              => 'null'),
          array(
            'configuration_title'       => MODULE_GOOGLE_ANALYTICS_USE_ADWORDS_CONVERSION_TITLE,
            'configuration_key'         => 'MODULE_GOOGLE_ANALYTICS_USE_ADWORDS_CONVERSION',
            'configuration_value'       => MODULE_GOOGLE_ANALYTICS_USE_ADWORDS_CONVERSION_DEFAULT,
            'configuration_description' => MODULE_GOOGLE_ANALYTICS_USE_ADWORDS_CONVERSION_DESCRIPTION,
            'use_function'              => 'null',
            'set_function'              => 'zen_cfg_select_option(array(\'true\', \'false\'),'),
          array(
            'configuration_title'       => MODULE_GOOGLE_ANALYTICS_ADWORDS_CONVERSION_ID_TITLE,
            'configuration_key'         => 'MODULE_GOOGLE_ANALYTICS_ADWORDS_CONVERSION_ID',
            'configuration_value'       => MODULE_GOOGLE_ANALYTICS_ADWORDS_CONVERSION_ID_DEFAULT,
            'configuration_description' => MODULE_GOOGLE_ANALYTICS_ADWORDS_CONVERSION_ID_DESCRIPTION,
            'use_function'              => 'null',
            'set_function'              => 'null'),
          array(
            'configuration_title'       => MODULE_GOOGLE_ANALYTICS_ADWORDS_CONVERSION_LANGUAGE_TITLE,
            'configuration_key'         => 'MODULE_GOOGLE_ANALYTICS_ADWORDS_CONVERSION_LANGUAGE',
            'configuration_value'       => MODULE_GOOGLE_ANALYTICS_ADWORDS_CONVERSION_LANGUAGE_DEFAULT,
            'configuration_description' => MODULE_GOOGLE_ANALYTICS_ADWORDS_CONVERSION_LANGUAGE_DESCRIPTION,
            'use_function'              => 'null',
            'set_function'              => 'null')
        );
    var $notifier        = array();

    // class constructer for php4
    function google_analytics() {
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

  }
?>