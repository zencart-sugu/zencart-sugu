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
//  $Id: languages.php 1105 2005-04-04 22:05:35Z birdbrain $
//

define('HEADING_TITLE', '携帯サイトの追加');

define('MOBILE_SETUPED_TITLE', '次の言語の携帯サイトが設定されています。<br>
<br>
携帯用テンプレートを変更する場合は、「追加設定・ツール」->「テンプレートの設定」から行ってください。<br>');

define('MOBILE_NOT_SETUPED_TITLE', '次の言語の携帯サイトを作成しますか?');

define('TABLE_HEADING_LANGUAGE_NAME', '言語');
define('TABLE_HEADING_LANGUAGE_CODE', 'コード');
define('TABLE_HEADING_MOBILE_TEMPLATE', 'テンプレート');
define('TABLE_HEADING_ACTION', '操作');
define('ACTION_SETUP_MOBILE_SITE', '作成');


define('ERROR_REMOVE_DEFAULT_LANGUAGE', 'エラー: デフォルトの言語は削除できません。他の言語をデフォルトに設定して、もう一度操作してください。');
define('ERROR_DUPLICATE_LANGUAGE_CODE', 'エラー: 入力された言語コードはすでに登録されています。');
define('ERROR_LANGUAGE_CODE_NOT_EXISTS', 'エラー: 指定された言語が存在しません。');
define('SETUP_MOBILE_SITE_SUCCESS', '携帯用サイトの設定が完了しました');
?>
