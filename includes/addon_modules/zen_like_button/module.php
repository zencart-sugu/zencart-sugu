<?php
/**
 * sales_twitter Module
 *
 * @package Viewed_products
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: sales_twitter.php $
 */
	if (!defined('IS_ADMIN_FLAG')) {
        die('Illegal Access');
	}

	class zen_like_button extends addOnModuleBase {
		var $author                        = array("Tsunemasa Hachiya");
		var $author_email                  = "info@zencart-sugu.jp";
		var $version                       = "0.1";
		var $require_zen_cart_version      = "1.3.0.2";
		var $require_addon_modules_version = "0.1";

		var $title       = MODULE_ZEN_LIKE_BUTTON_TITLE;
		var $description = MODULE_ZEN_LIKE_BUTTON_DESCRIPTION;
		var $sort_order  = MODULE_ZEN_LIKE_BUTTON_SORT_ORDER;
		var $icon;
		var $status      = MODULE_ZEN_LIKE_BUTTON_STATUS;
		var $enabled;

		var $configuration_keys = array(
                array(
		          'configuration_title'       => MODULE_ZEN_LIKE_BUTTON_TITLE,
                  'configuration_key'         => 'MODULE_ZEN_LIKE_BUTTON_STATUS',
                  'configuration_value'       => MODULE_ZEN_LIKE_BUTTON_STATUS_DEFAULT,
                  'configuration_description' => MODULE_ZEN_LIKE_BUTTON_STATUS_DESCRIPTION,
                  'use_function'              => 'null',
                  'set_function'              => 'zen_cfg_select_option(array(\'true\', \'false\'),'
                ),
                array(
		          'configuration_title'       => MODULE_ZEN_LIKE_BUTTON_LAYOUT_TITLE,
                  'configuration_key'         => 'MODULE_ZEN_LIKE_BUTTON_LAYOUT',
                  'configuration_value'       => MODULE_ZEN_LIKE_BUTTON_LAYOUT_DEFAULT,
                  'configuration_description' => MODULE_ZEN_LIKE_BUTTON_LAYOUT_DESCRIPTION,
                  'use_function'              => 'null',
                  'set_function'              => 'zen_cfg_select_option(array(\'standard\', \'button_count\'),'
                ),
                array(
		          'configuration_title'       => MODULE_ZEN_LIKE_BUTTON_FACE_TITLE,
                  'configuration_key'         => 'MODULE_ZEN_LIKE_BUTTON_FACE',
                  'configuration_value'       => MODULE_ZEN_LIKE_BUTTON_FACE_DEFAULT,
                  'configuration_description' => MODULE_ZEN_LIKE_BUTTON_FACE_DESCRIPTION,
                  'use_function'              => 'null',
                  'set_function'              => 'zen_cfg_select_option(array(\'true\', \'false\'),'
                ),
                array(
                  'configuration_title'       => MODULE_ZEN_LIKE_BUTTON_IFRAME_WIDTH_TITLE,
                  'configuration_key'         => 'MODULE_ZEN_LIKE_BUTTON_IFRAME_WIDTH',
                  'configuration_value'       => MODULE_ZEN_LIKE_BUTTON_IFRAME_WIDTH_DEFAULT,
                  'configuration_description' => MODULE_ZEN_LIKE_BUTTON_IFRAME_WIDTH_DESCRIPTION,
                  'use_function'              => 'null',
                  'set_function'              => 'null'
                ),
                array(
                  'configuration_title'       => MODULE_ZEN_LIKE_BUTTON_IFRAME_HEIGHT_TITLE,
                  'configuration_key'         => 'MODULE_ZEN_LIKE_BUTTON_IFRAME_HEIGHT',
                  'configuration_value'       => MODULE_ZEN_LIKE_BUTTON_IFRAME_HEIGHT_DEFAULT,
                  'configuration_description' => MODULE_ZEN_LIKE_BUTTON_IFRAME_HEIGHT_DESCRIPTION,
                  'use_function'              => 'null',
                  'set_function'              => 'null'
                ),
                array(
		          'configuration_title'       => MODULE_ZEN_LIKE_BUTTON_ACTION_TITLE,
                  'configuration_key'         => 'MODULE_ZEN_LIKE_BUTTON_ACTION',
                  'configuration_value'       => MODULE_ZEN_LIKE_BUTTON_ACTION_DEFAULT,
                  'configuration_description' => MODULE_ZEN_LIKE_BUTTON_ACTION_DESCRIPTION,
                  'use_function'              => 'null',
                  'set_function'              => 'zen_cfg_select_option(array(\'like\', \'recommend\'),'
                )
	    );

	    var $require_modules = array();
	    var $notifier = array();

	    // class constructer for php4
	    function zen_like_button() {
	      $this->__construct();
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
			$return['zen_like_button'] = build_like_button();
			return $return;
	    }

	}
?>