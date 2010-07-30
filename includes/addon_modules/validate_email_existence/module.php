<?php
/**
 * validate_email_existence Module
 *
 * @package Viewed_products
 * @copyright Copyright (C) 2010 ARK-Web co., ltd.
 * @author Tsunemasa Hachiya
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @author Tsunemasa Hachiya <hachiya@ark-web.jp>
 * @version $Id: addon_modules_example.php $
 */
if (!defined('IS_ADMIN_FLAG')) {
	die('Illegal Access');
}

    class validate_email_existence extends addonModuleBase {
        var $title       = MODULE_VALIDATE_EMAIL_EXISTENCE_TITLE;
        var $description = MODULE_VALIDATE_EMAIL_EXISTENCE_DESCRIPTION;
        var $sort_order  = MODULE_VALIDATE_EMAIL_EXISTENCE_SORT_ORDER;
        var $icon;
        var $status      = MODULE_VALIDATE_EMAIL_EXISTENCE_STATUS;
        var $enabled;

        var $configuration_keys = array(
            array(
                  'configuration_title'       => MODULE_VALIDATE_EMAIL_EXISTENCE_TITLE,
                  'configuration_key'         => 'MODULE_VALIDATE_EMAIL_EXISTENCE_STATUS',
                  'configuration_value'       => MODULE_VALIDATE_EMAIL_EXISTENCE_STATUS_DEFAULT,
                  'configuration_description' => MODULE_VALIDATE_EMAIL_EXISTENCE_STATUS_DESCRIPTION,
                  'use_function'              => 'null',
                  'set_function'              => 'zen_cfg_select_option(array(\'true\', \'false\'),'
            )
        );

        var $require_modules = array();
        var $notifier = array();

        //コンストラクタ
        function validate_email_existence() {
            $this->__construct();
        }

        function notifierUpdate($notifier) {
            if($notifier == "NOTIFY_LOGIN_SUCCESS_VIA_CREATE_ACCOUNT") {
				require_once(DIR_FS_CATALOG . $this->dir . 'classes/class.memberInterimRegist_model.php');
				$objIR = new memberInterimRegist_model();
				$objIR->insertInterimData();
				$objIR->sendEmailForInterimRegist();
            }
        }

        function _install() {
            global $db;
            $sql = "create table if not exists " . TABLE_ADDON_MODULES_CUSTOMERS_TEMPORARY . " "
                . "("
                . "gender varchar(6) NULL,"
                . "firstname varchar(32) NULL,"
                . "lastname varchar(32) NULL,"
                . "dob varchar(10) NULL,"
                . "email_address  varchar(96) NOT NULL,"
                . "nick varchar(32) NOT NULL,"
                . "password varchar(16) NOT NULL,"
                . "newsletter int(1) NULL,"
                . "payment_method varchar(24) NULL,"
                . "postcode varchar(10) NULL,"
                . "state varchar(32) NULL,"
                . "city varchar(32) NULL,"
                . "street_address varchar(64) NULL,"
                . "suburb varchar(32) NULL,"
                . "telephone varchar(32) NULL,"
                . "fax varchar(32) NULL,"
                . "temporary_id varchar(255) NOT NULL,"
                . "reg_date datetime NOT NULL DEFAULT '0000-00-00 00:00:00'"
                . ")";
            $db->execute($sql);
        }

        function _update() {

        }

        function _remove() {
            global $db;
            $sql = "drop table if exists " . TABLE_ADDON_MODULES_CUSTOMERS_TEMPORARY;
            $db->execute($sql);
        }

        function _cleanUp() {

        }

        function block() {

        }

        function page_member_interim_regist_complete() {

        }

        function page_member_regist_complete() {

        	if(isset($_GET['mode']) && $_GET['mode'] == 'regist') {
				require_once(DIR_FS_CATALOG . $this->dir . 'classes/class.memberRegist_model.php');
				$objR = new memberRegist_model();
				$objR->sendEmailForRegist();
        	}

        }

    }
?>