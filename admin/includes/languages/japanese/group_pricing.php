<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2004 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                                 |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//  $Id: group_pricing.php 2770 2006-01-02 07:52:42Z drbyte $
//

define('HEADING_TITLE', '割引顧客グループの管理');

define('TABLE_HEADING_GROUP_ID', 'ID');
define('TABLE_HEADING_GROUP_NAME', 'グループ名');
define('TABLE_HEADING_GROUP_AMOUNT', '割引率(%)');
define('TABLE_HEADING_ACTION', '操作');

define('TEXT_HEADING_NEW_PRICING_GROUP', '新しい割引顧客グループ');
define('TEXT_HEADING_EDIT_PRICING_GROUP', '割引顧客グループを編集');
define('TEXT_HEADING_DELETE_PRICING_GROUP', '割引顧客グループを削除');

define('TEXT_NEW_INTRO', '新しいグループについての情報を入力してください');
define('TEXT_EDIT_INTRO', '必要な変更を行ってください');
define('TEXT_DELETE_INTRO', 'このグループを本当に削除しますか?');
define('TEXT_DELETE_PRICING_GROUP', 'この割引顧客グループを削除しますか？');
define('TEXT_DELETE_WARNING_GROUP_MEMBERS','<b>警告:</b> %s人の顧客がこのカテゴリーにまだリンクしています');

define('TEXT_GROUP_PRICING_NAME', 'グループ名: ');
define('TEXT_GROUP_PRICING_AMOUNT', '割引率(%): ');
define('TEXT_DATE_ADDED', '情報追加日:');
define('TEXT_LAST_MODIFIED', '情報変更日:');
define('TEXT_CUSTOMERS', 'グループ内の顧客数:');

define('ERROR_GROUP_PRICING_CUSTOMERS_EXIST','エラー: 顧客がまだこのグループに残っています。このグループにいるメンバーを確認し、本当に消去していいのか確認してください');
define('ERROR_MODULE_NOT_CONFIGURED','注意: 割引顧客グループの定義が存在しますが、まだのモジュールが有効になっていません。<br />管理画面＞モジュール＞OrderTotal＞メンバーの割引（もしくは割引顧客グループ）をからインストールするか、設定を行ってください');

?>