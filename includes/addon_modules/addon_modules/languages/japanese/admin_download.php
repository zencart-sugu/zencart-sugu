<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 Liquid System Technology, Inc.                    |
// | Author Koji Sasaki                                                   |
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
//  $Id: blocks.php $
//

define('HEADING_TITLE',                  'addonモジュール ダウンロード');
define('HEADING_INFOBOX_TITLE',          'モジュール詳細');

define('TABLE_HEADING_MODULE_NAME',      'モジュール名');
define('TABLE_HEADING_DESCRIPTION',      '説明');
define('TABLE_HEADING_VERSION',          'バージョン');
define('TABLE_HEADING_ACTION',           '操作');

define('TEXT_BACK',                      '戻る');
define('TEXT_DOWNLOAD',                  'ダウンロード');

define('TEXT_INFO_BOX_MODULE_NAME',      'モジュール名: ');
define('TEXT_INFO_BOX_FILENAME',         'ファイル名: ');
define('TEXT_INFO_BOX_DISTRIBUTION_URL', '配布元URL: ');
define('TEXT_INFO_BOX_AUTHOR',           '作者: ');
define('TEXT_INFO_BOX_VERSION',          'バージョン: ');
define('TEXT_INFO_BOX_REQUIRE_ZENCART',  '対応ZenCart: ');
define('TEXT_INFO_BOX_REQUIRE_ADDON',    '対応addonモジュールコア: ');
define('TEXT_INFO_BOX_DESCRIPTION',      'モジュール説明: ');

define('ERROR_NOT_PERMISSION_ADDON_DIR', MODULE_ADDON_MODULES_DOWNLOAD_DIRECTORY.'に書き込み権限がありません。');
define('ERROR_NOT_PERMISSION_TEMP',      MODULE_ADDON_MODULES_DOWNLOAD_TEMP_DIRECTORY.'に書き込み権限がありません。');
define('ERROR_NO_FILE',                  '%sモジュールは存在しません。');
define('ERROR_CANNOT_DOWNLOAD',          '%sモジュールをダウンロードできませんでした。');
define('ERROR_DOWNLOADED',               '%sモジュールは既にダウンロード済です。');
define('ERROR_VERSION',                  '%sモジュールは ZenCart %s addonモジュールコア %s で動作します。');
define('SUCCESS_EXTRACT',                '%sモジュールがダウンロードされました。');
define('ERROR_EXTRACT',                  '%sモジュールを展開することができませんでした。');
