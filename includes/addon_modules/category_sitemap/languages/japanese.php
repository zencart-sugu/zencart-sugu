<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2008 Liquid System Technology, Inc.                    |
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
// $Id: japanese.php $
//
define('MODULE_ADDON_MODULES_CATEGORY_SITEMAP_TITLE',                  'カテゴリーサイトマップ');
define('MODULE_ADDON_MODULES_CATEGORY_SITEMAP_DESCRIPTION',            'カテゴリーサイトマップを表示します');
define('MODULE_ADDON_MODULES_CATEGORY_SITEMAP_STATUS_TITLE',           'カテゴリーサイトマップの有効化');
define('MODULE_ADDON_MODULES_CATEGORY_SITEMAP_STATUS_DESCRIPTION',     'カテゴリーサイトマップ表示を有効にしますか？ <br />true: 有効<br />false: 無効');
define('MODULE_ADDON_MODULES_CATEGORY_SITEMAP_TREE_LEVEL_TITLE',       '表示するカテゴリーの深さ');
define('MODULE_ADDON_MODULES_CATEGORY_SITEMAP_TREE_LEVEL_DESCRIPTION', '表示するカテゴリーの深さを指定します（デフォルト='.MODULE_ADDON_MODULES_CATEGORY_SITEMAP_TREE_LEVEL_DEFAULT.'）');
define('MODULE_ADDON_MODULES_CATEGORY_SITEMAP_SORT_ORDER_TITLE',       '優先順');
define('MODULE_ADDON_MODULES_CATEGORY_SITEMAP_SORT_ORDER_DESCRIPTION', 'モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。');

define('MODULE_CATEGORY_SITEMAP_TITLE',            'カテゴリーサイトマップ');
define('MODULE_CATEGORY_SITEMAP_BLOCK_TITLE',      'カテゴリーサイトマップ');

// header_navigation extra_boxes
define('BOX_CATEGORY_SITEMAP',               '商品カテゴリー一覧');
define('MODULE_CATEGORY_SITEMAP_PAGE_TITLE', 'カテゴリーサイトマップ');
?>