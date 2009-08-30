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
// $Id: popup_search_help.php 2471 2005-11-29 01:14:18Z drbyte $
//

define('HEADING_SEARCH_HELP', '検索ヘルプ');
define('TEXT_SEARCH_HELP', '(1)より正確に検索をしたい場合には、「AND」か「OR」、またはその両方で複数のキーワードを区切ることができます。<br /><br /><ul><li>「マイクロソフト AND マウス」と入力すると、両方のキーワードを含む商品を検索します。</li><li>「マウス OR キーボード」と入力すると、どちらかのキーワードを含む商品を検索します。</li></ul>(2)いくつかのキーワードを引用符(")で囲むと、その文字列に正確に一致するものだけを検索します。<br /><br /><ul><li>"ノート型 パソコン"と入力すると、その文字列を正確に含んだ商品を検索します。</li></ul>(3)これらの検索ルールは、括弧でくくることで、より複雑な指定が可能です。<br /><br /><ul><li>「マイクロソフト AND (キーボード OR マウス OR "visual basic")」と入力すると、「マイクロソフト」を含み、かつ「キーボード」か「マウス」か「visual basic」を含む商品を検索します。</li></ul>');
define('TEXT_CLOSE_WINDOW', '<span class="pseudolink">ウィンドウを閉じる</span> [x]');

?>