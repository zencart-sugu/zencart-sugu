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
//  $Id: orders_status.php 1105 2005-04-04 22:05:35Z birdbrain $
//

define('HEADING_TITLE', '注文ステータス設定');

define('TABLE_HEADING_ORDERS_STATUS', '注文ステータス');
define('TABLE_HEADING_ACTION', '操作');

define('TEXT_INFO_EDIT_INTRO', '必要な変更を行ってください。');
define('TEXT_INFO_ORDERS_STATUS_NAME', '注文ステータス： ');
define('TEXT_INFO_INSERT_INTRO', '新しい注文ステータスに関するデータを入力してください。');
define('TEXT_INFO_DELETE_INTRO', 'この注文ステータスを本当に削除しますか?');
define('TEXT_INFO_HEADING_NEW_ORDERS_STATUS', '新しい注文ステータス');
define('TEXT_INFO_HEADING_EDIT_ORDERS_STATUS', '注文ステータスを編集');
define('TEXT_INFO_HEADING_DELETE_ORDERS_STATUS', '注文ステータスを削除');

define('ERROR_REMOVE_DEFAULT_ORDER_STATUS', 'エラー： デフォルトの注文ステータスは削除できません。他の注文ステータスをデフォルトに設定してからもう一度操作してください。');
define('ERROR_STATUS_USED_IN_ORDERS', 'エラー： この注文ステータスは現在注文に使用されています。');
define('ERROR_STATUS_USED_IN_HISTORY', 'エラー： この注文ステータスは、現在注文履歴に使用されています。');
?>