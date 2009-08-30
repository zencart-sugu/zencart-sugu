<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
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
//  $Id: cache.php 1105 2005-04-04 22:05:35Z birdbrain $
//

define('HEADING_TITLE', 'キャッシュコントロール');

define('TABLE_HEADING_CACHE', 'キャッシュ　ブロック');
define('TABLE_HEADING_DATE_CREATED', '登録日');
define('TABLE_HEADING_ACTION', '操作');

define('TEXT_FILE_DOES_NOT_EXIST', 'ファイルが存在しません。');
define('TEXT_CACHE_DIRECTORY', 'キャッシュ　ディレクトリ:');

define('ERROR_CACHE_DIRECTORY_DOES_NOT_EXIST', 'エラー: キャッシュディレクトリが存在しません。 設定->キャッシュで設定してください。');
define('ERROR_CACHE_DIRECTORY_NOT_WRITEABLE', 'エラー: キャッシュディレクトリに書き込みができません。正しいユーザ権限を設定してください。');
?>