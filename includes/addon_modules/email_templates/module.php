<?php
/**
 * addon_modules_example Module
 *
 * @package Viewed_products
 * @copyright Copyright (C) 2009 Liquid System Technology, Inc.
 * @author Koji Sasaki
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @author Koji Sasaki <sasaki@liquidst.jp>
 * @version $Id: addon_modules_example.php $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

  class email_templates extends addOnModuleBase {
    var $title = MODULE_EMAIL_TEMPLATES_TITLE;
    var $description = MODULE_EMAIL_TEMPLATES_DESCRIPTION;
    var $sort_order = MODULE_EMAIL_TEMPLATES_SORT_ORDER;
    var $icon;
    var $status = MODULE_EMAIL_TEMPLATES_STATUS;
    var $enabled;
    var $configuration_keys = array(
          array(
            'configuration_title' => MODULE_EMAIL_TEMPLATES_STATUS_TITLE,
            'configuration_key' => 'MODULE_EMAIL_TEMPLATES_STATUS',
            'configuration_value' => MODULE_EMAIL_TEMPLATES_STATUS_DEFAULT,
            'configuration_description' => MODULE_EMAIL_TEMPLATES_STATUS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title' => MODULE_EMAIL_TEMPLATES_SORT_ORDER_TITLE,
            'configuration_key' => 'MODULE_EMAIL_TEMPLATES_SORT_ORDER',
            'configuration_value' => MODULE_EMAIL_TEMPLATES_SORT_ORDER_DEFAULT,
            'configuration_description' => MODULE_EMAIL_TEMPLATES_SORT_ORDER_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
        );
    var $require_modules = array('jquery');
    var $notifier = array('NOTIFY_CHECKOUT_PROCESS_AFTER_ORDER_CREATE_ADD_PRODUCTS',
			  'NOTIFY_CHECKOUT_PROCESS_AFTER_SEND_ORDER_EMAIL');

    var $author                        = "kohata";
    var $author_email                  = "info@zencart-sugu.jp";
    var $version                       = "0.1";
    var $require_zen_cart_version      = "1.3.0.2";
    var $require_addon_modules_version = "0.1";

    // class constructer for php4
    function email_templates() {
      $this->__construct();
    }

    function notifierUpdate($notifier) {
      global $order_back, $order;

      switch( $notifier ){
      case 'NOTIFY_CHECKOUT_PROCESS_AFTER_ORDER_CREATE_ADD_PRODUCTS':
	require_once($this->dir . 'classes/CustomMail.php');
	$order_back = $order;
	$order = new CustomMail();
	break;
      case 'NOTIFY_CHECKOUT_PROCESS_AFTER_SEND_ORDER_EMAIL':
	$order = $order_back;
	break;
      }      
    }

    function _install() {
      global $db;
      $sql = "CREATE TABLE " . TABLE_EMAIL_TEMPLATES . " (
                id smallint(6) NOT NULL auto_increment,
                grp varchar(50) NOT NULL default '',
                title varchar(255) NOT NULL default '',
                subject varchar(255) NOT NULL default '',
                contents text NOT NULL,
                updated datetime NOT NULL default '0000-00-00 00:00:00',
                PRIMARY KEY  (id))";

      $db->execute($sql);

      $sql = "INSERT INTO email_templates (id, grp, title,subject,contents,updated) VALUES (" . 
	"'" . MODULE_EMAIL_TEMPLATE_CREATE_ACCOUNT_MAIL_ID . "'," . 
	"'" . MODULE_EMAIL_TEMPLATE_CREATE_ACCOUNT_MAIL_GRP . "'," . 
	"'" . MODULE_EMAIL_TEMPLATE_CREATE_ACCOUNT_MAIL_TITLE . "'," . 
	"'" . MODULE_EMAIL_TEMPLATE_CREATE_ACCOUNT_MAIL_SUBJECT . "'," . 
	"'" . MODULE_EMAIL_TEMPLATE_CREATE_ACCOUNT_MAIL_BODY . "'," . 
	"now())";

      $db->execute($sql);

      $sql = "INSERT INTO email_templates (id, grp, title,subject,contents,updated) VALUES (" . 
	"'" . MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_MAIL_ID . "'," . 
	"'" . MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_MAIL_GRP . "'," . 
	"'" . MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_MAIL_TITLE . "'," . 
	"'" . MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_MAIL_SUBJECT . "'," . 
	"'" . MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_MAIL_BODY . "'," . 
	"now())";

      $db->execute($sql);

      $sql = "INSERT INTO email_templates (id, grp, title,subject,contents,updated) VALUES (" . 
	"'" . MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_VISITOR_MAIL_ID . "'," . 
	"'" . MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_VISITOR_MAIL_GRP . "'," . 
	"'" . MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_VISITOR_MAIL_TITLE . "'," . 
	"'" . MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_VISITOR_MAIL_SUBJECT . "'," . 
	"'" . MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_VISITOR_MAIL_BODY . "'," . 
	"now())";

      $db->execute($sql);

      $sql = "INSERT INTO email_templates (id, grp, title,subject,contents,updated) VALUES (" . 
	"'" . MODULE_EMAIL_TEMPLATE_STATUS_MAIL_ID . "'," . 
	"'" . MODULE_EMAIL_TEMPLATE_STATUS_MAIL_GRP . "'," . 
	"'" . MODULE_EMAIL_TEMPLATE_STATUS_MAIL_TITLE . "'," . 
	"'" . MODULE_EMAIL_TEMPLATE_STATUS_MAIL_SUBJECT . "'," . 
	"'" . MODULE_EMAIL_TEMPLATE_STATUS_MAIL_BODY . "'," . 
	"now())";

      $db->execute($sql);
    }

    function _update() {
    }

    function _remove() {
      global $db;

      $sql = "drop table if exists ". TABLE_EMAIL_TEMPLATES;
      $db->execute($sql);
    }

    function _cleanUp() {
    }

    function page() {
      global $db;

      if (isset($_GET['id'])) {
      	$id  = $_GET['id'];
        $query          = "SELECT * FROM " . TABLE_EMAIL_TEMPLATES . " WHERE id='". $id . "'";
        $email_template = $db->Execute($query);
        echo $email_template->fields['contents'];
      	exit;
      } else {
      	return "";
      }
    }

  }
?>