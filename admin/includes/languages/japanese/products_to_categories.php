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
//  $Id: products_to_categories.php 2909 2006-01-29 21:29:35Z ajeh $
//

define('HEADING_TITLE','複数カテゴリー商品のリンクマネージャー');
define('HEADING_TITLE2','カテゴリー / 商品');

define('TEXT_INFO_PRODUCTS_TO_CATEGORIES_AVAILABLE', 'リンクに利用可能な商品カテゴリー ...');

define('TABLE_HEADING_PRODUCTS_ID', 'Prod ID');
define('TABLE_HEADING_PRODUCT', '商品名');
define('TABLE_HEADING_MODEL', 'モデル');
define('TABLE_HEADING_ACTION', '効果');

define('TEXT_INFO_HEADING_EDIT_PRODUCTS_TO_CATEGORIES', '商品のカテゴリー情報を編集します。');
define('TEXT_PRODUCTS_ID', '商品 ID# ');
define('TEXT_PRODUCTS_NAME', '商品: ');
define('TEXT_PRODUCTS_MODEL', 'モデル: ');
define('TEXT_PRODUCTS_PRICE', '価格: ');
define('BUTTON_UPDATE_CATEGORY_LINKS', 'アップデートカテゴリーリンク');
define('BUTTON_NEW_PRODUCTS_TO_CATEGORIES', 'リンクする商品を選択してください。');
define('TEXT_SET_PRODUCTS_TO_CATEGORIES_LINKS', 'リンクするカテゴリーに商品をセット: ');
define('TEXT_INFO_LINKED_TO_COUNT', '&nbsp;&nbsp;新商品がリンクされているカテゴリー: ');

define('TEXT_INFO_PRODUCTS_TO_CATEGORIES_LINKER_INTRO',
'カテゴリーへの商品のリンクは、ひとつもしくは複数へのリンクが可能です。<br />また、すでにリンクしてあるカテゴリーから別のカテゴリーへの移動が可能です。. (追加内容に関しては、以下を見てください。)');

define('TEXT_INFO_PRODUCTS_TO_CATEGORIES_LINKER',
'商品に価格をつけるために、各商品はマスターカテゴリーを必要とします。複数のカテゴリーにリンクされているかもしれませんが、マスターカテゴリーのドロップダウンから、これらを設定変更などができます。.<br />
商品は現在、カテゴリーかカテゴリー類にてチェックされリンクされています。 新しいカテゴリーもしくはカテゴリー類にて、カテゴリー名の隣にあるチェックボックスにチェックを加えるには、 すでにチェックの入っているチェックボックスから、チェックを外してください。<br />
この商品をカテゴリー類のすべてにリンクチェックしたいときは押してください。' . BUTTON_UPDATE_CATEGORY_LINKS . '<br />');

define('HEADER_CATEGORIES_GLOBAL_CHANGES', 'グローバルなカテゴリーリンクの変更とマスターカテゴリーIDのリセット');

define('TEXT_SET_MASTER_CATEGORIES_ID', '<strong>警告:</strong> リンクしているカテゴリーを変更するには、マスターカテゴリーIDが必要です。');

// copy category to category linked
define('TEXT_INFO_COPY_ALL_PRODUCTS_TO_CATEGORY_LINKED', '<strong>別のカテゴリーへリンクしている商品をもう一つのカテゴリーへすべてコピーする。</strong><br />例: すべての製品がカテゴリ8でカテゴリ22にリンクされるでしょう。');
define('TEXT_INFO_COPY_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'カテゴリですべての製品を選択してください。: ');
define('TEXT_INFO_COPY_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'カテゴリにリンクしてください。: ');
define('BUTTON_COPY_CATEGORY_LINKED', 'リンクされるように商品をコピーしてください。 ');

define('WARNING_PRODUCTS_LINK_TO_CATEGORY_REMOVED', '警告: 商品はリセットされており、もうこのカテゴリーの一部ではありません…');
define('WARNING_COPY_LINKED', '警告: ');
define('WARNING_COPY_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'から商品をリンクするのに無効なカテゴリーです: ');
define('WARNING_COPY_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'へ商品をリンクするのに無効なカテゴリーです: ');
define('WARNING_NO_CATEGORIES_ID', '警告: カテゴリーは選択されませんでした ... 変更できませんでした。');
define('SUCCESS_COPY_LINKED', 'リンクしている商品のアップデートに成功しました。 ... ');
define('SUCCESS_COPY_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'から商品をリンクするのに有効なカテゴリー: ');
define('SUCCESS_COPY_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'へ商品をリンクするのに有効なカテゴリー: ');

define('WARNING_COPY_FROM_IN_TO_LINKED', '<strong>警告: 商品はまだリンク変更がされていません ... </strong>');

// remove category to category linked
define('TEXT_INFO_REMOVE_ALL_PRODUCTS_TO_CATEGORY_LINKED', '<strong>別のカテゴリーへのリンクされている商品であるカテゴリーのすべての商品を削除します ...</strong><br />例: 8と22を使用して、カテゴリー22からカテゴリー8のすべての商品のリンクを切り離します。');
define('TEXT_INFO_REMOVE_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'カテゴリーの商品をすべて選択します: ');
define('TEXT_INFO_REMOVE_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'カテゴリーにリンクされているとこから移動します。: ');
define('BUTTON_REMOVE_CATEGORY_LINKED', 'リンクされている商品を移動してください。 ');

define('WARNING_REMOVE_LINKED', '警告: ');
define('WARNING_REMOVE_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'からリンク商品を取り除く無効のカテゴリー: ');
define('WARNING_REMOVE_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'へリンク商品を取り除く無効のカテゴリー: ');
define('SUCCESS_REMOVE_LINKED', 'リンクされている商品の移動に成功しました ... ');
define('SUCCESS_REMOVE_ALL_PRODUCTS_TO_CATEGORY_FROM_LINKED', 'からリンクされた商品を有効なカテゴリーへ移動します。: ');
define('SUCCESS_REMOVE_ALL_PRODUCTS_TO_CATEGORY_TO_LINKED', 'へリンクされた商品を有効なカテゴリーへ移動します。: ');

define('WARNING_REMOVE_FROM_IN_TO_LINKED', '<strong>警告: 商品にならなかった変更はリンクされませんでした... </strong>');

define('WARNING_MASTER_CATEGORIES_ID_CONFLICT', '<strong>警告: マスターカテゴリーIDを習得してください!! </strong>');
define('TEXT_INFO_MASTER_CATEGORIES_ID_CONFLICT', '<strong>マスターカテゴリーIDです。: </strong>');
define('TEXT_INFO_MASTER_CATEGORIES_ID_PURPOSE', '注意: マスター・カテゴリーは、商品カテゴリーがリンクした商品上の価格に影響するところで、目的に値をつけるために使用されます。
, 例: セールス<br />');
define('WARNING_MASTER_CATEGORIES_ID_CONFLICT_FIX', 'この問題を解決するために, 無効な商品を初期状態へリダイレクト
しました。 それがもはや商品でないように、マスター・カテゴリーからIDを削除しマスター・再度マスターカテゴリーからIDを取得し、再試行してください。 無効な商品が修正された場合、 その後、要求した削除を終えることができるでしょう。');
define('TEXT_MASTER_CATEGORIES_ID_CONFLICT_FROM', ' カテゴリーから衝突すること: ');
define('TEXT_MASTER_CATEGORIES_ID_CONFLICT_TO', ' カテゴリーへ衝突すること: ');
define('SUCCESS_MASTER_CATEGORIES_ID', 'リンクされている商品のアップデートに成功しました ...');
define('WARNING_MASTER_CATEGORIES_ID', '警告: マスターカテゴリーがセットされていません!');

define('TEXT_PRODUCTS_ID_INVALID', '警告: IDまたは商品が選択されていない無効な商品');
define('TEXT_PRODUCTS_ID_NOT_REQUIRED', '注意: 商品IDは、1つのカテゴリーからもう一つのカテゴリーまですべての商品をリンクする用意する必要はありません。有効な商品IDは、利用可能なすべてのカテゴリーとそれらのIDナンバーを表示されるでしょう。');

// reset all products to new master_categories_id
// copy category to category linked
define('TEXT_INFO_RESET_ALL_PRODUCTS_TO_CATEGORY_MASTER', '<strong>新しいマスター・カテゴリーIDとして選択されたカテゴリーを使用するために選択されたカテゴリーのすべての商品をリセットします ...</strong><br />例:カテゴリー22のリセットは、すべての商品にマスター・カテゴリーIDとしてカテゴリー22の中でカテゴリー22をセットできるでしょう。');
define('TEXT_INFO_RESET_ALL_PRODUCTS_TO_CATEGORY_FROM_MASTER', 'カテゴリー中のすべての商品用マスター・カテゴリーIDをリセットします: ');
define('BUTTON_RESET_CATEGORY_MASTER', 'マスターカテゴリーIDをリセットします。');

define('WARNING_RESET_ALL_PRODUCTS_TO_CATEGORY_FROM_MASTER', '警告: 無効なカテゴリーが選択されました。 ...');
define('SUCCESS_RESET_ALL_PRODUCTS_TO_CATEGORY_FROM_MASTER', 'マスターカテゴリーIDへの全商品のアップデートに成功しました。: ');

?>