<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 Liquid System Technology, Inc.                    |
// | Author arkweb                                                        |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 The zen-cart developers                  |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
// $Id: japanese.php $


if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

class facebook_ogp extends addOnModuleBase {
    var $author = 'arkweb';
    var $author_email = 'info@zencart-sugu.jp';
    var $version = '1.0.0';
    var $require_zen_cart_version = '1.3.0.2';
    var $require_addon_modules_version = '1.0.0';

    var $title = MODULE_FACEBOOK_OGP_TITLE;
    var $description = MODULE_FACEBOOK_OGP_DESCRIPTION;
    var $sort_order = MODULE_FACEBOOK_OGP_SORT_ORDER;
    var $icon;
    var $status = MODULE_FACEBOOK_OGP_STATUS;
    var $enabled;
    var $configuration_keys = array(
          array(
            'configuration_title' => MODULE_FACEBOOK_OGP_STATUS_TITLE,
            'configuration_key' => 'MODULE_FACEBOOK_OGP_STATUS',
            'configuration_value' => MODULE_FACEBOOK_OGP_STATUS_DEFAULT,
            'configuration_description' => MODULE_FACEBOOK_OGP_STATUS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title' => MODULE_FACEBOOK_OGP_USER_IDS_TITLE,
            'configuration_key' => 'MODULE_FACEBOOK_OGP_USER_IDS',
            'configuration_value' => MODULE_FACEBOOK_OGP_USER_IDS_DEFAULT,
            'configuration_description' => MODULE_FACEBOOK_OGP_USER_IDS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_FACEBOOK_OGP_OG_EMAIL_TITLE,
            'configuration_key' => 'MODULE_FACEBOOK_OGP_OG_EMAIL',
            'configuration_value' => MODULE_FACEBOOK_OGP_OG_EMAIL_DEFAULT,
            'configuration_description' => MODULE_FACEBOOK_OGP_OG_EMAIL_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_FACEBOOK_OGP_OG_PHONE_NUMBER_TITLE,
            'configuration_key' => 'MODULE_FACEBOOK_OGP_OG_PHONE_NUMBER',
            'configuration_value' => MODULE_FACEBOOK_OGP_OG_PHONE_NUMBER_DEFAULT,
            'configuration_description' => MODULE_FACEBOOK_OGP_OG_PHONE_NUMBER_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_FACEBOOK_OGP_OG_FAX_NUMBER_TITLE,
            'configuration_key' => 'MODULE_FACEBOOK_OGP_OG_FAX_NUMBER',
            'configuration_value' => MODULE_FACEBOOK_OGP_OG_FAX_NUMBER_DEFAULT,
            'configuration_description' => MODULE_FACEBOOK_OGP_OG_FAX_NUMBER_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_FACEBOOK_OGP_SORT_ORDER_TITLE,
            'configuration_key' => 'MODULE_FACEBOOK_OGP_SORT_ORDER',
            'configuration_value' => MODULE_FACEBOOK_OGP_SORT_ORDER_DEFAULT,
            'configuration_description' => MODULE_FACEBOOK_OGP_SORT_ORDER_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
    );

    var $tables = array(
      );

    var $require_modules = array();
    var $notifier = array();

    // class constructer for php4
    function facebook_ogp() {
        $this->__construct();
    }

    function notifierUpdate($notifier) {}

    function _install() {
    }

    function _update() {
    }

    function _remove() {
    }

    function _cleanUp() {
    }

    // page methods
}
?>
