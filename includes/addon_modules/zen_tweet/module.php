<?php
/**
 * sales_twitter Module
 *
 * @package Viewed_products
 * @copyright Copyright (C) 2009 Liquid System Technology, Inc.
 * @author T.Hachiya
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @author T.Hachiya <sasaki@liquidst.jp>
 * @version $Id: sales_twitter.php $
 */
	if (!defined('IS_ADMIN_FLAG')) {
        die('Illegal Access');
	}

	class zen_tweet extends addOnModuleBase {
		var $title       = MODULE_ZEN_TWEET_TITLE;
		var $description = MODULE_ZEN_TWEET_DESCRIPTION;
		var $sort_order  = MODULE_ZEN_TWEET_SORT_ORDER;
		var $icon;
		var $status      = MODULE_ZEN_TWEET_STATUS;
		var $enabled;

		var $configuration_keys = array(
                array(
		          'configuration_title'       => MODULE_ZEN_TWEET_TITLE,
                  'configuration_key'         => 'MODULE_ZEN_TWEET_STATUS',
                  'configuration_value'       => MODULE_ZEN_TWEET_STATUS_DEFAULT,
                  'configuration_description' => MODULE_ZEN_TWEET_STATUS_DESCRIPTION,
                  'use_function'              => 'null',
                  'set_function'              => 'zen_cfg_select_option(array(\'true\', \'false\'),'
                ),
                array(
                  'configuration_title'       => MODULE_ZEN_TWEET_SHOWLIST_TITLE,
                  'configuration_key'         => 'MODULE_ZEN_TWEET_SHOWLIST',
                  'configuration_value'       => MODULE_ZEN_TWEET_SHOW_LIST_DEFAULT,
                  'configuration_description' => MODULE_ZEN_TWEET_SHOWLIST_DESCRIPTION,
                  'use_function'              => 'null',
                  'set_function'              => 'zen_cfg_select_option(array(\'true\', \'false\'),'
                ),
                array(
                  'configuration_title'       => MODULE_ZEN_TWEET_SHOWNUM_TITLE,
                  'configuration_key'         => 'MODULE_ZEN_TWEET_SHOWNUM',
                  'configuration_value'       => MODULE_ZEN_TWEET_SHOWNUM_DEFAULT,
                  'configuration_description' => MODULE_ZEN_TWEET_SHOWNUM_DESCRIPTION,
                  'use_function'              => 'null',
                  'set_function'              => 'null'
                ),
                array(
                  'configuration_title'       => MODULE_ZEN_TWEET_WORD_TITLE,
                  'configuration_key'         => 'MODULE_ZEN_TWEET_WORD',
                  'configuration_value'       => MODULE_ZEN_TWEET_WORD,
                  'configuration_description' => MODULE_ZEN_TWEET_WORD_DESCRIPTION,
                  'use_function'              => 'null',
                  'set_function'              => 'null'
                ),
                array(
                  'configuration_title'       => MODULE_ZEN_TWEET_THRESHOLD_TITLE,
                  'configuration_key'         => 'MODULE_ZEN_TWEET_THRESHOLD',
                  'configuration_value'       => MODULE_ZEN_TWEET_THRESHOLD_DEFAULT,
                  'configuration_description' => MODULE_ZEN_TWEET_TWITTER_THRESHOLD_DESCRIPTION,
                  'use_function'              => 'null',
                  'set_function'              => 'null'
                ),
                array(
                  'configuration_title'       => MODULE_ZEN_TWEET_RECOMMEND_TITLE,
                  'configuration_key'         => 'MODULE_ZEN_TWEET_RECOMMEND',
                  'configuration_value'       => MODULE_ZEN_TWEET_RECOMMEND_DEFAULT,
                  'configuration_description' => MODULE_ZEN_TWEET_RECOMMEND_DESCRIPTION,
                  'use_function'              => 'null',
                  'set_function'              => 'zen_cfg_select_option(array(\'true\', \'false\'),'
                ),
                array(
                  'configuration_title'       => MODULE_ZEN_TWEET_ACCOUNT_ID_TITLE,
                  'configuration_key'         => 'MODULE_ZEN_TWEET_ACCOUNT_ID',
                  'configuration_value'       => MODULE_ZEN_TWEET_ACCOUNT_ID,
                  'configuration_description' => MODULE_ZEN_TWEET_ACCOUNT_ID_DESCRIPTION,
                  'use_function'              => 'null',
                  'set_function'              => 'null'
                ),
                array(
                  'configuration_title'       => MODULE_ZEN_TWEET_ACCOUNT_PASS_TITLE,
                  'configuration_key'         => 'MODULE_ZEN_TWEET_ACCOUNT_PASS',
                  'configuration_value'       => MODULE_ZEN_TWEET_ACCOUNT_PASS,
                  'configuration_description' => MODULE_ZEN_TWEET_ACCOUNT_PASS_DESCRIPTION,
                  'use_function'              => 'null',
                  'set_function'              => 'null'
                )/*,
                array(
                  'configuration_title'       => MODULE_ZEN_TWEET_BITLY_API_URL_TITLE,
                  'configuration_key'         => 'MODULE_ZEN_TWEET_BITLY_API_URL',
                  'configuration_value'       => MODULE_ZEN_TWEET_BITLY_API_URL,
                  'configuration_description' => MODULE_ZEN_TWEET_BITLY_API_URL_DESCRIPTION,
                  'use_function'              => 'null',
                  'set_function'              => 'null'
                ),
                array(
                  'configuration_title'       => MODULE_ZEN_TWEET_BITLY_API_KEY_TITLE,
                  'configuration_key'         => 'MODULE_ZEN_TWEET_BITLY_API_KEY',
                  'configuration_value'       => MODULE_ZEN_TWEET_BITLY_API_KEY,
                  'configuration_description' => MODULE_ZEN_TWEET_BITLY_API_KEY_DESCRIPTION,
                  'use_function'              => 'null',
                  'set_function'              => 'null'
                ),
                array(
                  'configuration_title'       => MODULE_ZEN_TWEET_BITLY_API_VERSION_TITLE,
                  'configuration_key'         => 'MODULE_ZEN_TWEET_BITLY_API_VERSION',
                  'configuration_value'       => MODULE_ZEN_TWEET_BITLY_API_VERSION,
                  'configuration_description' => MODULE_ZEN_TWEET_BITLY_API_VERSION_DESCRIPTION,
                  'use_function'              => 'null',
                  'set_function'              => 'null'
                ),
                array(
                  'configuration_title'       => MODULE_ZEN_TWEET_BITLY_USER_ACCOUNT_TITLE,
                  'configuration_key'         => 'MODULE_ZEN_TWEET_BITLY_USER_ACCOUNT',
                  'configuration_value'       => MODULE_ZEN_TWEET_BITLY_USER_ACCOUNT,
                  'configuration_description' => MODULE_ZEN_TWEET_BITLY_USER_ACCOUNT_DESCRIPTION,
                  'use_function'              => 'null',
                  'set_function'              => 'null'
                ),
                array(
                  'configuration_title'       => MODULE_ZEN_TWEET_BITLY_DATA_FORMAT_TITLE,
                  'configuration_key'         => 'MODULE_ZEN_TWEET_BITLY_DATA_FORMAT',
                  'configuration_value'       => MODULE_ZEN_TWEET_BITLY_DATA_FORMAT,
                  'configuration_description' => MODULE_ZEN_TWEET_BITLY_DATA_FORMAT_DESCRIPTION,
                  'use_function'              => 'null',
                  'set_function'              => 'zen_cfg_select_option(array(\'json\', \'xml\'),'
                )*/
	    );

	    var $require_modules = array();
	    var $notifier = array();

	    //コンストラクタ
	    function zen_tweet() {
            $this->__construct();
	    }

	    function notifierUpdate($notifier) {
	    	if($notifier == "NOTIFY_CHECKOUT_PROCESS_AFTER_SEND_ORDER_EMAIL") {
		        require_once(DIR_FS_CATALOG . $this->dir . 'classes/class.zenTweet.php');
				$twitterObj = new zenTweet();
				$twitterObj->execTweet();
	    	}
	    }

	    function _install() {
			global $db;
			$sql = "create table if not exists ".TABLE_ADDON_MODULES_ZEN_TWEET." "
				. "(id int(11) auto_increment,"
				. "tweet varchar(255),"
				. "date_added datetime,"
				. "date_now datetime,"
				. "primary key (id)"
				. ")";
			$db->execute($sql);
	    }

	    function _update() {
	    }

	    function _remove() {
			global $db;
			$sql = "drop table if exists ".TABLE_ADDON_MODULES_ZEN_TWEET;
			$db->execute($sql);
	    }

	    function _cleanUp() {
	    }

	    /*
	     * ■フロント画面に表示させるロジック
	     *
	     * 最初のアクセス時にDBを見に行き、データが登録されていなければツイッターからつぶやきを取得しDBに格納
	     * データが登録されていればそれを表示
	     *
	     * DBを覗いて最新の登録日時が現在日時の1時間前
	     * ・Yes → ツイッターからデータを取得してDBに格納
	     * ・No  → 現在の表示のまま
	     */
	    function block() {

	    	global $db;

			$sql = "select "
						. "* "
					. "from "
						. TABLE_ADDON_MODULES_ZEN_TWEET . " "
					. "order by date_added desc";

			$result = $db->execute($sql);
			$return = array();

			//経過時間をチェック
			$get_exec = check_time($result);

			//1時間経過してたら
			if($get_exec) {
				//print "<br />GETします";
				//ツイートの取得
				$feeds = tweet_get_feeds("http://twitter.com/statuses/user_timeline/" . MODULE_ZEN_TWEET_ACCOUNT_ID . ".xml?count=" . MODULE_ZEN_TWEET_SHOWNUM);
				//テーブルの書き換え
				ins_table($feeds);
			}

			//テーブルの中身を取得
			if(MODULE_ZEN_TWEET_SHOWLIST == "true") {
				$return['tweet'] = get_zen_tweet();
			}

			return $return;


	    }

	    function block_tweet_button() {

			//つぶやくボタンを取得
			$return['tweet_button'] = build_tweet_button();

			return $return;
	    }

	}
?>