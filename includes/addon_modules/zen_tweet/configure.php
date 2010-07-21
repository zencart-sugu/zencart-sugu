<?php
/*
 * 管理画面での設定項目
 */
	if (!defined('IS_ADMIN_FLAG')) {
	  die('Illegal Access');
	}

    define('MODULE_ZEN_TWEET_STATUS_DEFAULT', 	 'true');
	define('MODULE_ZEN_TWEET_SHOW_LIST_DEFAULT', 'true');
    define('MODULE_ZEN_TWEET_SHOWNUM_DEFAULT',	 5);
    define('MODULE_ZEN_TWEET_WORD', 	 		 'が売れました♪');
    define('MODULE_ZEN_TWEET_THRESHOLD_DEFAULT', 5);
    define('MODULE_ZEN_TWEET_RECOMMEND_DEFAULT', 'true');
    define('MODULE_ZEN_TWEET_ACCOUNT_ID',		 '');
    define('MODULE_ZEN_TWEET_ACCOUNT_PASS', 	 '');

/*    define('MODULE_ZEN_TWEET_BITLY_API_URL', 	 'http://api.bit.ly');
	define('MODULE_ZEN_TWEET_BITLY_API_KEY', 	 '');
	define('MODULE_ZEN_TWEET_BITLY_API_VERSION', 'v3');
	define('MODULE_ZEN_TWEET_BITLY_USER_ACCOUNT', '');
	define('MODULE_ZEN_TWEET_BITLY_DATA_FORMAT', 'json');*/

	define('MODULE_ZEN_TWEET_SORT_ORDER_DEFAULT', '');
?>