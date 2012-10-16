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
    var $notifier = array('NOTIFY_BEFORE_CREATE_HEADER',
			  'NOTIFY_BEFORE_CREATE_BODY');

    var $author                        = array("saito",
                                               "Yuki Shida",
                                               "Tsunemasa Hachiya",
                                               "kohata",
                                               "idabagusmade");
    var $author_email                  = "info@zencart-sugu.jp";
    var $version                       = "0.1";
    var $require_zen_cart_version      = "1.3.0.2";
    var $require_addon_modules_version = "0.1";

    // class constructer for php4
    function email_templates() {
      require_once($this->dir . 'classes/class.email_templates_notifier.php');
      $this->__construct();
    }

    function notifierUpdate($notifier) {
      global $order_back, $order;
      global $messageStack;
      global $request_type;

      if (zen_not_null($GLOBALS['email_templates_pagename'])) {
        $pagename = $GLOBALS['email_templates_pagename'];
      } else {
        $pagename = FILENAME_DEFAULT;
      }

      // prepare notifier processor
      $etn = new email_templates_notifier();
      // call funcs
      if ($notifier == 'NOTIFY_BEFORE_CREATE_HEADER' || $notifier == 'NOTIFY_BEFORE_CREATE_BODY') {
	$ret = $etn->call($pagename, $notifier);
      }
    }

    function _install() {
      global $db;

      //============= 配信メールの種別(グループ)を格納
      $sql = "CREATE TABLE " . TABLE_EMAIL_TEMPLATES . " (
                id smallint(6) NOT NULL auto_increment,
                grp varchar(50) NOT NULL default '',
                title varchar(255) NOT NULL default '',
                PRIMARY KEY  (id))";

      $db->execute($sql);

      $sql = "INSERT INTO email_templates (id, grp, title) VALUES (" .
	"'" . MODULE_EMAIL_TEMPLATE_CREATE_ACCOUNT_MAIL_ID . "'," .
	"'" . MODULE_EMAIL_TEMPLATE_CREATE_ACCOUNT_MAIL_GRP . "'," .
	"'" . MODULE_EMAIL_TEMPLATE_CREATE_ACCOUNT_MAIL_TITLE . "')";

      $db->execute($sql);

      $sql = "INSERT INTO email_templates (id, grp, title) VALUES (" .
	"'" . MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_MAIL_ID . "'," .
	"'" . MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_MAIL_GRP . "'," .
	"'" . MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_MAIL_TITLE . "')";

      $db->execute($sql);

      $sql = "INSERT INTO email_templates (id, grp, title) VALUES (" .
	"'" . MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_VISITOR_MAIL_ID . "'," .
	"'" . MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_VISITOR_MAIL_GRP . "'," .
	"'" . MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_VISITOR_MAIL_TITLE . "')";

      $db->execute($sql);

      $sql = "INSERT INTO email_templates (id, grp, title) VALUES (" .
	"'" . MODULE_EMAIL_TEMPLATE_STATUS_MAIL_ID . "'," .
	"'" . MODULE_EMAIL_TEMPLATE_STATUS_MAIL_GRP . "'," .
	"'" . MODULE_EMAIL_TEMPLATE_STATUS_MAIL_TITLE . "')";

      $db->execute($sql);

      $sql = "INSERT INTO email_templates (id, grp, title) VALUES (" .
	"'" . MODULE_EMAIL_TEMPLATE_PASSWORD_FORGOTTEN_MAIL_ID . "'," .
	"'" . MODULE_EMAIL_TEMPLATE_PASSWORD_FORGOTTEN_MAIL_GRP . "'," .
	"'" . MODULE_EMAIL_TEMPLATE_PASSWORD_FORGOTTEN_MAIL_TITLE . "')";

      $db->execute($sql);

      //============= メール内容を格納
      $sql = "CREATE TABLE " . TABLE_EMAIL_TEMPLATES_DESCRIPTION . " (
      			email_templates_id smallint(6) NOT NULL,
      			language_id int(11) NOT NULL,
                subject varchar(255) NOT NULL default '',
                contents text NOT NULL,
                updated datetime NOT NULL default '0000-00-00 00:00:00',
                PRIMARY KEY  (email_templates_id, language_id))";

      $db->execute($sql);

	//----- ユーザー登録
      $sql = "INSERT INTO " . TABLE_EMAIL_TEMPLATES_DESCRIPTION . " (email_templates_id, language_id, subject, contents, updated) VALUES (" .
	"'" . MODULE_EMAIL_TEMPLATE_CREATE_ACCOUNT_MAIL_ID . "'," .
	"'" . MODULE_EMAIL_TEMPLATE_CREATE_LANGUAGE_ID . "'," .
	"'" . MODULE_EMAIL_TEMPLATE_CREATE_ACCOUNT_MAIL_SUBJECT . "'," .
	"'" . MODULE_EMAIL_TEMPLATE_CREATE_ACCOUNT_MAIL_BODY . "'," .
	"now())";

      $db->execute($sql);

      $sql = "INSERT INTO " . TABLE_EMAIL_TEMPLATES_DESCRIPTION . " (email_templates_id, language_id, subject, contents, updated) VALUES (" .
	"'" . MODULE_EMAIL_TEMPLATE_CREATE_ACCOUNT_MAIL_ID . "'," .
	"'" . MODULE_EMAIL_TEMPLATE_CREATE_LANGUAGE_ID_EN . "'," .
	"'" . MODULE_EMAIL_TEMPLATE_CREATE_ACCOUNT_MAIL_SUBJECT_EN . "'," .
	"'" . MODULE_EMAIL_TEMPLATE_CREATE_ACCOUNT_MAIL_BODY_EN . "'," .
	"now())";

      $db->execute($sql);

      //----- 会員用
      $sql = "INSERT INTO " . TABLE_EMAIL_TEMPLATES_DESCRIPTION . " (email_templates_id, language_id, subject, contents, updated) VALUES (" .
	"'" . MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_MAIL_ID . "'," .
	"'" . MODULE_EMAIL_TEMPLATE_CREATE_LANGUAGE_ID . "'," .
	"'" . MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_MAIL_SUBJECT . "'," .
	"'" . MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_MAIL_BODY . "'," .
	"now())";

      $db->execute($sql);

      $sql = "INSERT INTO " . TABLE_EMAIL_TEMPLATES_DESCRIPTION . " (email_templates_id, language_id, subject, contents, updated) VALUES (" .
	"'" . MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_MAIL_ID . "'," .
	"'" . MODULE_EMAIL_TEMPLATE_CREATE_LANGUAGE_ID_EN . "'," .
	"'" . MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_MAIL_SUBJECT_EN . "'," .
	"'" . MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_MAIL_BODY_EN . "'," .
	"now())";

      $db->execute($sql);

      //----- ゲスト用
      $sql = "INSERT INTO " . TABLE_EMAIL_TEMPLATES_DESCRIPTION . " (email_templates_id, language_id, subject, contents, updated) VALUES (" .
	"'" . MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_VISITOR_MAIL_ID . "'," .
	"'" . MODULE_EMAIL_TEMPLATE_CREATE_LANGUAGE_ID . "'," .
	"'" . MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_VISITOR_MAIL_SUBJECT . "'," .
	"'" . MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_VISITOR_MAIL_BODY . "'," .
	"now())";

      $db->execute($sql);

      $sql = "INSERT INTO " . TABLE_EMAIL_TEMPLATES_DESCRIPTION . " (email_templates_id, language_id, subject, contents, updated) VALUES (" .
	"'" . MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_VISITOR_MAIL_ID . "'," .
	"'" . MODULE_EMAIL_TEMPLATE_CREATE_LANGUAGE_ID_EN . "'," .
	"'" . MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_VISITOR_MAIL_SUBJECT_EN . "'," .
	"'" . MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_VISITOR_MAIL_BODY_EN . "'," .
	"now())";

      $db->execute($sql);

      //----- ステータス
      $sql = "INSERT INTO " . TABLE_EMAIL_TEMPLATES_DESCRIPTION . " (email_templates_id, language_id, subject, contents, updated) VALUES (" .
	"'" . MODULE_EMAIL_TEMPLATE_STATUS_MAIL_ID . "'," .
	"'" . MODULE_EMAIL_TEMPLATE_CREATE_LANGUAGE_ID . "'," .
	"'" . MODULE_EMAIL_TEMPLATE_STATUS_MAIL_SUBJECT . "'," .
	"'" . MODULE_EMAIL_TEMPLATE_STATUS_MAIL_BODY . "'," .
	"now())";

      $db->execute($sql);

      $sql = "INSERT INTO " . TABLE_EMAIL_TEMPLATES_DESCRIPTION . " (email_templates_id, language_id, subject, contents, updated) VALUES (" .
	"'" . MODULE_EMAIL_TEMPLATE_STATUS_MAIL_ID . "'," .
	"'" . MODULE_EMAIL_TEMPLATE_CREATE_LANGUAGE_ID_EN . "'," .
	"'" . MODULE_EMAIL_TEMPLATE_STATUS_MAIL_SUBJECT_EN . "'," .
	"'" . MODULE_EMAIL_TEMPLATE_STATUS_MAIL_BODY_EN . "'," .
	"now())";

      $db->execute($sql);

      //----- パスワード
      $sql = "INSERT INTO " . TABLE_EMAIL_TEMPLATES_DESCRIPTION . " (email_templates_id, language_id, subject, contents, updated) VALUES (" .
	"'" . MODULE_EMAIL_TEMPLATE_PASSWORD_FORGOTTEN_MAIL_ID . "'," . 
	"'" . MODULE_EMAIL_TEMPLATE_CREATE_LANGUAGE_ID . "'," .
	"'" . MODULE_EMAIL_TEMPLATE_PASSWORD_FORGOTTEN_MAIL_SUBJECT . "'," . 
	"'" . MODULE_EMAIL_TEMPLATE_PASSWORD_FORGOTTEN_MAIL_BODY . "'," . 
	"now())";

      $db->execute($sql);

      $sql = "INSERT INTO " . TABLE_EMAIL_TEMPLATES_DESCRIPTION . " (email_templates_id, language_id, subject, contents, updated) VALUES (" .
	"'" . MODULE_EMAIL_TEMPLATE_PASSWORD_FORGOTTEN_MAIL_ID . "'," .
	"'" . MODULE_EMAIL_TEMPLATE_CREATE_LANGUAGE_ID_EN . "'," .
	"'" . MODULE_EMAIL_TEMPLATE_PASSWORD_FORGOTTEN_MAIL_SUBJECT_EN . "'," .
	"'" . MODULE_EMAIL_TEMPLATE_PASSWORD_FORGOTTEN_MAIL_BODY_EN . "'," .
	"now())";

      $db->execute($sql);
    }

    function _update() {
    }

    function _remove() {
      global $db;

      $sql = "drop table if exists ". TABLE_EMAIL_TEMPLATES;
      $db->execute($sql);

      $sql = "drop table if exists ". TABLE_EMAIL_TEMPLATES_DESCRIPTION;
      $db->execute($sql);
    }

    function _cleanUp() {
    }

    function page() {
      if (isset($_GET['id'])) {
	$language_id = isset($_GET['language_id']) ? $_GET['language_id'] : null;
	$order_id = isset($_GET['oID']) ? $_GET['oID'] : null;
	echo get_email_template_contents($_GET['id'], $order_id, $language_id);
      	exit;
      } else {
      	return "";
      }
    }

  }
?>