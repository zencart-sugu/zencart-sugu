<?php
/**
 * :package - japanese
 *
 * @package :package
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: japanese.php $
 */

define('MODULE_SUPER_PRODUCTS_LIST_TITLE', 'スーパー商品一覧');
define('MODULE_SUPER_PRODUCTS_LIST_DESCRIPTION', 'カテゴリを串刺しにした商品一覧を表示し、一覧表示中でも絞り込みができるようになります。また、sennaを使った高速全文検索が可能です。');

define('MODULE_SUPER_PRODUCTS_LIST_STATUS_TITLE', 'スーパー商品一覧の有効化');
define('MODULE_SUPER_PRODUCTS_LIST_STATUS_DESCRIPTION', 'スーパー商品一覧を有効にしますか？ <br />true: 有効<br />false: 無効');
define('MODULE_SUPER_PRODUCTS_LIST_SORT_ORDER_TITLE', '優先順');
define('MODULE_SUPER_PRODUCTS_LIST_SORT_ORDER_DESCRIPTION', 'モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。');
define('MODULE_SUPER_PRODUCTS_LIST_SENNA_STATUS_TITLE', 'sennaを利用しますか?');
define('MODULE_SUPER_PRODUCTS_LIST_SENNA_STATUS_DESCRIPTION', '別途sennaのインストールを行う必要があります。<br />
sennaインストール後、全文検索用インデックスをはる必要があります。<br />
商品点数によっては数十分程かかる場合もありますので、コンソールから直接SQLを実行してください。<br />
<p><a href="javascript:void(0)" onclick="document.getElementById(\'senna_sql\').style.display=\'block\';">SQLを表示する</a></p>
<div id="senna_sql" style="display:none;">
CREATE FULLTEXT INDEX idx_fulltext_products_description_products_name USING NGRAM ON '. TABLE_PRODUCTS_DESCRIPTION .' (products_name);
</div>');
define('MODULE_SUPER_PRODUCTS_LIST_ENABLE_SEARCH_BY_DATE_AVAILABLE_TITLE', '発売日を検索条件に含めますか?');
define('MODULE_SUPER_PRODUCTS_LIST_ENABLE_SEARCH_BY_DATE_AVAILABLE_DESCRIPTION', '発売日は「提供可能日」を利用します。ユーザーの検索条件に発売日で検索させるかどうかを指定します。');

define('MODULE_SUPER_PRODUCTS_LIST_SORT_NAME',       '商品名順');
define('MODULE_SUPER_PRODUCTS_LIST_SORT_PRICE',      '価格順');
define('MODULE_SUPER_PRODUCTS_LIST_SORT_SORT_ORDER', 'おすすめ順');
define('MODULE_SUPER_PRODUCTS_LIST_SORT_DATE',       '発売日順');
define('MODULE_SUPER_PRODUCTS_LIST_DIRECTION_ASC',   '昇順');
define('MODULE_SUPER_PRODUCTS_LIST_DIRECTION_DESC',  '降順');

define('MODULE_SUPER_PRODUCTS_LIST_RESULT_FROM_TO',  '<strong>%d</strong>から<strong>%d</strong> を表示中 (商品の数: <strong>%d</strong>)');
define('MODULE_SUPER_PRODUCTS_LIST_PAGING_PREV',     '&lt;&lt;前');
define('MODULE_SUPER_PRODUCTS_LIST_PAGING_NEXT',     '次&gt;&gt;');
define('MODULE_SUPER_PRODUCTS_LIST_TEXT_ALL_CATEGORIES', '全カテゴリー');
define('MODULE_SUPER_PRODUCTS_LIST_TEXT_ALL_MANUFACTURERS', '全メーカー');

define('MODULE_SUPER_PRODUCTS_LIST_NOT_FOUND_PRODUCTS', '該当する商品は見つかりませんでした');

define('MODULE_SUPER_PRODUCTS_LIST_ZENKAKU_BLANK',   '　');
define('MODULE_SUPER_PRODUCTS_LIST_HANKAKU_STRINGS', '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ/@-.,:');
define('MODULE_SUPER_PRODUCTS_LIST_ZENKAKU_STRINGS', '１２３４５６７８９０ａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚＡＢＣＤＥＦＧＨＩＪＫＬＭＮＯＰＱＲＳＴＵＶＷＸＹＺ／＠−．，：');

define('MODULE_SUPER_PRODUCTS_LIST_ERROR_CATEGORY_NOT_FOUND',            '存在しないカテゴリです');
define('MODULE_SUPER_PRODUCTS_LIST_ERROR_MANUFACTURER_NOT_FOUND',        '存在しないメーカーです');
define('MODULE_SUPER_PRODUCTS_LIST_ERROR_PRICE_FROM_MUST_BE_NUM',        '価格下限には数字を入力してください');
define('MODULE_SUPER_PRODUCTS_LIST_ERROR_PRICE_TO_MUST_BE_NUM',          '価格上限には数字を入力してください');
define('MODULE_SUPER_PRODUCTS_LIST_ERROR_PRICE_TO_LESS_THAN_PRICE_FROM', '価格上限は価格下限と同じかそれ以上の数字を入力してください');
define('MODULE_SUPER_PRODUCTS_LIST_ERROR_INVALID_FROM_DATE',             '無効な開始日付です');
define('MODULE_SUPER_PRODUCTS_LIST_ERROR_INVALID_TO_DATE',               '無効な終了日付です');
define('MODULE_SUPER_PRODUCTS_LIST_ERROR_TO_DATE_LESS_THAN_FROM_DATE',   '終了日付は開始日付と同じかそれ以降の日付を入力してください');

define('MODULE_SUPER_PRODUCTS_LIST_OPEN_MANUFACTURER_SETTING', 'メーカーを指定する');
define('MODULE_SUPER_PRODUCTS_LIST_OPEN_PRICE_SETTING',        '価格を指定する');
define('MODULE_SUPER_PRODUCTS_LIST_OPEN_DATE_SETTING',         '発売日を指定する');
define('MODULE_SUPER_PRODUCTS_LIST_RESET_SETTING',             '指定を解除する');
define('MODULE_SUPER_PRODUCTS_LIST_NOW_LOADING', 'Loading...');
define('MODULE_SUPER_PRODUCTS_LIST_TEXT_FROM_TO', '~');
define('MODULE_SUPER_PRODUCTS_LIST_MANUFACTURERS_NOT_FOUND', '該当するメーカーは見つかりませんでした');

define('MODULE_SUPER_PRODUCTS_LIST_TEXT_KEYWORDS',     'キーワード');
define('MODULE_SUPER_PRODUCTS_LIST_TEXT_CATEGORY',     'カテゴリー');
define('MODULE_SUPER_PRODUCTS_LIST_TEXT_MANUFACTURER', 'メーカー');
define('MODULE_SUPER_PRODUCTS_LIST_TEXT_PRICE',        '価格帯');
define('MODULE_SUPER_PRODUCTS_LIST_TEXT_DATE',         '発売日');
define('MODULE_SUPER_PRODUCTS_LIST_TEXT_SORT',         '並び順');
define('MODULE_SUPER_PRODUCTS_LIST_TEXT_LIMIT',        '表示件数');
?>
