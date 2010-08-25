<?php
/**
 * japanese.php
 *
 * @package zen-cart addon module google analytics
 * @author saito
 * @copyright Copyright 2010 saito dev.zen-cart.jp
 * @copyright Copyright (C) 2009 Liquid System Technology, Inc.
 * @copyright Copyright 2004-2008 Andrew Berezin eCommerce-Service.com
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: japanese.php $
 * based on tpl_footer_googleanalytics.php, v 2.2.1 01.09.2008 01:23 Andrew Berezin
 */

define('MODULE_GOOGLE_ANALYTICS_TITLE',             'Google Analytics');
define('MODULE_GOOGLE_ANALYTICS_DESCRIPTION',       'Google Analyticsの使用');

define('MODULE_GOOGLE_ANALYTICS_STATUS_TITLE',             'Google Analyticsの有効化');
define('MODULE_GOOGLE_ANALYTICS_STATUS_DESCRIPTION',       'Google Analyticsを有効にしますか？ <br />true: 有効<br />false: 無効');

define('MODULE_GOOGLE_ANALYTICS_ACCOUNT_TITLE',                           'アカウント');
define('MODULE_GOOGLE_ANALYTICS_ACCOUNT_DESCRIPTION',                     'Google Analyticsのアカウントを入力してください');
define('MODULE_GOOGLE_ANALYTICS_TARGET_TITLE',                            '解析する住所');
define('MODULE_GOOGLE_ANALYTICS_TARGET_DESCRIPTION',                      'Google Analytisで解析する住所を選択してください (国/都道府県/市町村 が送信されます)<br />Customers: 顧客<br />delivery: 配送先<br />billing: 請求先');
define('MODULE_GOOGLE_ANALYTICS_AFFILIATION_TITLE',                       'アフィリエイション');
define('MODULE_GOOGLE_ANALYTICS_AFFILIATION_DESCRIPTION',                 '店舗名を入力してください(空白でも問題ありません)');
define('MODULE_GOOGLE_ANALYTICS_SKU_OR_CODE_TITLE',                       'sku/codeの選択');
define('MODULE_GOOGLE_ANALYTICS_SKU_OR_CODE_DESCRIPTION',                 'Google Analyticsに送信するSKUコードを選択してください<br />products_id: 商品ID<br />products_model: 商品型番');
define('MODULE_GOOGLE_ANALYTICS_PAGENAME_TITLE',                         'ページ名の使用');
define('MODULE_GOOGLE_ANALYTICS_PAGENAME_DESCRIPTION',                   'Google Analyticsの解析にページ名を使用しますか?<br />true: 使用する<br />false: 使用しない');
define('MODULE_GOOGLE_ANALYTICS_BRACKETS_TITLE',                          '商品オプションの囲み文字');
define('MODULE_GOOGLE_ANALYTICS_BRACKETS_DESCRIPTION',                    '商品オプションを囲む文字を入力してください');
define('MODULE_GOOGLE_ANALYTICS_DELIMITER_TITLE',                         '商品オプションの区切り文字');
define('MODULE_GOOGLE_ANALYTICS_DELIMITER_DESCRIPTION',                   '複数の商品オプションを区切る文字を入力してください');
define('MODULE_GOOGLE_ANALYTICS_OUTBOUND_TITLE',                          '外部サイトへの移動を記録');
define('MODULE_GOOGLE_ANALYTICS_OUTBOUND_DESCRIPTION',                    '外部サイトへの移動を記録しますか?<br />true: 記録する<br />false: 記録しない');
define('MODULE_GOOGLE_ANALYTICS_OUTBOUND_LINKS_PREFIX_TITLE',             '外部サイトを識別する文字列');
define('MODULE_GOOGLE_ANALYTICS_OUTBOUND_LINKS_PREFIX_DESCRIPTION',       '外部サイトへの移動にはこの文字列が付加されます');
define('MODULE_GOOGLE_ANALYTICS_USE_ADWORDS_CONVERSION_TITLE',            'AdWords Conversionの利用');
define('MODULE_GOOGLE_ANALYTICS_USE_ADWORDS_CONVERSION_DESCRIPTION',      'AdWords Conversionを使用しますか?<br />true: 使用する<br />false: 使用しない');
define('MODULE_GOOGLE_ANALYTICS_ADWORDS_CONVERSION_ID_TITLE',             'AdWords Conversion ID');
define('MODULE_GOOGLE_ANALYTICS_ADWORDS_CONVERSION_ID_DESCRIPTION',       'Google Conversion IDを入力してください');
define('MODULE_GOOGLE_ANALYTICS_ADWORDS_CONVERSION_LANGUAGE_TITLE',       'AdWords Conversionで使用する言語');
define('MODULE_GOOGLE_ANALYTICS_ADWORDS_CONVERSION_LANGUAGE_DESCRIPTION', 'Google Conversionで使用する言語を入力してください<br />例: en_US, ja_JP');

?>