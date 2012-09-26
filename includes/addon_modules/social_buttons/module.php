<?php
/**
 * social_buttons Module
 *
 * @package Addon Modules
 * @copyright Copyright (C) 2009 Liquid System Technology, Inc.
 * @author Koji Sasaki
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: social_buttons.php $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

  class social_buttons extends addonModuleBase {
    var $title = MODULE_SOCIAL_BUTTONS_TITLE;
    var $description = MODULE_SOCIAL_BUTTONS_DESCRIPTION;
    var $sort_order = MODULE_SOCIAL_BUTTONS_SORT_ORDER;
    var $icon;
    var $status = MODULE_SOCIAL_BUTTONS_STATUS;
    var $enabled;
    var $configuration_keys = array(
          array(
            'configuration_title' => MODULE_SOCIAL_BUTTONS_STATUS_TITLE,
            'configuration_key' => 'MODULE_SOCIAL_BUTTONS_STATUS',
            'configuration_value' => MODULE_SOCIAL_BUTTONS_STATUS_DEFAULT,
            'configuration_description' => MODULE_SOCIAL_BUTTONS_STATUS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title' => MODULE_SOCIAL_BUTTONS_TWITTER_STATUS_TITLE,
            'configuration_key' => 'MODULE_SOCIAL_BUTTONS_TWITTER_STATUS',
            'configuration_value' => MODULE_SOCIAL_BUTTONS_TWITTER_STATUS_DEFAULT,
            'configuration_description' => MODULE_SOCIAL_BUTTONS_TWITTER_STATUS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title' => MODULE_SOCIAL_BUTTONS_TWITTER_ACCOUNT_TITLE,
            'configuration_key' => 'MODULE_SOCIAL_BUTTONS_TWITTER_ACCOUNT',
            'configuration_value' => MODULE_SOCIAL_BUTTONS_TWITTER_ACCOUNT_DEFAULT,
            'configuration_description' => MODULE_SOCIAL_BUTTONS_TWITTER_ACCOUNT_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_SOCIAL_BUTTONS_FACEBOOK_STATUS_TITLE,
            'configuration_key' => 'MODULE_SOCIAL_BUTTONS_FACEBOOK_STATUS',
            'configuration_value' => MODULE_SOCIAL_BUTTONS_FACEBOOK_STATUS_DEFAULT,
            'configuration_description' => MODULE_SOCIAL_BUTTONS_FACEBOOK_STATUS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title' => MODULE_SOCIAL_BUTTONS_MIXI_STATUS_TITLE,
            'configuration_key' => 'MODULE_SOCIAL_BUTTONS_MIXI_STATUS',
            'configuration_value' => MODULE_SOCIAL_BUTTONS_MIXI_STATUS_DEFAULT,
            'configuration_description' => MODULE_SOCIAL_BUTTONS_MIXI_STATUS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title' => MODULE_SOCIAL_BUTTONS_MIXI_CHECKKEY_TITLE,
            'configuration_key' => 'MODULE_SOCIAL_BUTTONS_MIXI_CHECKKEY',
            'configuration_value' => MODULE_SOCIAL_BUTTONS_MIXI_CHECKKEY_DEFAULT,
            'configuration_description' => MODULE_SOCIAL_BUTTONS_MIXI_CHECKKEY_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_SOCIAL_BUTTONS_GREE_STATUS_TITLE,
            'configuration_key' => 'MODULE_SOCIAL_BUTTONS_GREE_STATUS',
            'configuration_value' => MODULE_SOCIAL_BUTTONS_GREE_STATUS_DEFAULT,
            'configuration_description' => MODULE_SOCIAL_BUTTONS_GREE_STATUS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title' => MODULE_SOCIAL_BUTTONS_GOOGLEPLUS_STATUS_TITLE,
            'configuration_key' => 'MODULE_SOCIAL_BUTTONS_GOOGLEPLUS_STATUS',
            'configuration_value' => MODULE_SOCIAL_BUTTONS_GOOGLEPLUS_STATUS_DEFAULT,
            'configuration_description' => MODULE_SOCIAL_BUTTONS_GOOGLEPLUS_STATUS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title' => MODULE_SOCIAL_BUTTONS_SORT_ORDER_TITLE,
            'configuration_key' => 'MODULE_SOCIAL_BUTTONS_SORT_ORDER',
            'configuration_value' => MODULE_SOCIAL_BUTTONS_SORT_ORDER_DEFAULT,
            'configuration_description' => MODULE_SOCIAL_BUTTONS_SORT_ORDER_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
        );
    var $require_modules = array();
    var $notifier = array();

    var $author                        = "ohmura";
    var $author_email                  = "info@zencart-sugu.jp";
    var $version                       = "0.1";
    var $require_zen_cart_version      = "1.3.0.2";
    var $require_addon_modules_version = "0.1";

    // class constructer for php4
    function social_buttons() {
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

    function block() {
      $return = array();

      require_once('classes/social_buttons_model.php');
      $socialButtons = new SocialButtons();
      $return['twitter_button']  = $socialButtons->getTwitterButton();
      $return['facebook_button'] = $socialButtons->getFacebookButton();
      $return['mixi_button']     = $socialButtons->getMixiButton();
      $return['gree_button']     = $socialButtons->getGreeButton();
      $return['googleplus_button'] = $socialButtons->getGoogleplusButton();

      return $return;
    }
  }
