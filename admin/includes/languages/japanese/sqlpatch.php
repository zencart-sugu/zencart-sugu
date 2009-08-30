<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2006 The zen-cart developers                           |
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
//  $Id: sqlpatch.php 3093 2006-03-02 19:50:40Z drbyte $
//
  define('HEADING_TITLE','SQLパッチのインストール');
  define('HEADING_WARNING','スクリプトの実行前にデータベースのフルバックアップを行ってください');
  define('HEADING_WARNING2','サードパーティのモジュールなどを使用している場合、ご自分の責任において実行してください。Zen-Cartは安全性についての保障を行いません。<br />テスト用のDBで事前に確認することを推奨します。');
  define('TEXT_QUERY_RESULTS','クエリの結果:');
  define('TEXT_ENTER_QUERY_STRING','クエリ文を貼り付けて <br />実行してください。&nbsp;&nbsp;<br /><br />必ず「;」で<br />終わってください。');
  define('TEXT_QUERY_FILENAME','ファイルから<br />読み込む:');
  define('ERROR_NOTHING_TO_DO','エラー: クエリ、またはクエリファイルがありません');
  define('TEXT_CLOSE_WINDOW', '[ 閉じる ]');
  define('SQLPATCH_HELP_TEXT','SQLパッチツールはテキストエリアフィールドにダイレクトにSQLコードを通す、もしくはスクリプトファイルをアップロードすることでことでシステムにパッチを適用します。 '.
                              'このツールはストア内のadmin/includes/configure.php(DB_PREFIX definition)で定義されたアクティブなDBに、自動的に要求されたプレフィックスを挿入するため、スクリプトを準備するときにはテーブルのプレフィクスを含めてはいけません<br /><br />' .
                              '入力、またはアップロードされたコマンドは以下の声明によって始まります:'.
                              '<br /><ul><li>TABLEを存在する場合落とす</li><li>TABLEを作成する</li><li>挿入する</li><li>無視を挿入する</li><li>TABLEを変更する</li>' .
                              '<li>アップデートする(単一TABLEのみ)</li><li>アップデートを無視する(単一TABLEのみ)</li><li>削除する</li><li>INDEXをドロップする</li><li>INDEXを作成する</li>' .
                              '<br /><li>選択する </li></ul>' . 
'<h2>上級者向けのメソッド</h2>以下のメソッドは必要に応じ複数のStatementを議論するのに使われます:<br />
いくつかのコードを一つとして走らせることで、MySQLはそれを一つのコマンドとして扱います。コードは<code>#NEXT_X_ROWS_AS_ONE_COMMAND:xxx</code>のように記述します。パーサーはxxxの数のコマンドを一つのコマンドとして扱います。<br />
もしこのファイルをphpMyAdminやそれと同等のアプリケーションを利用して走らせている場合には、"#NEXT..."で始まるコメントは無視されます。そしてスクリプトは快適に動きます<br />
<br /><strong>注意: </strong>SELECT.... FROM... and LEFT JOIN、これらのコマンドはTableプレフィクスをパーススクリプトに加えるために一行に記述しなければいけません<br /><br />
<em><strong>例:</strong></em>
<ul><li><code>#NEXT_X_ROWS_AS_ONE_COMMAND:4<br />
SET @t1=0;<br />
SELECT (@t1:=configuration_value) as t1 <br />
FROM configuration <br />
WHERE configuration_key = \'KEY_NAME_HERE\';<br />
UPDATE product_type_layout SET configuration_value = @t1 WHERE configuration_key = \'KEY_NAME_TO_CHECK_HERE\';<br />
DELETE FROM configuration WHERE configuration_key = \'KEY_NAME_HERE\';<br />&nbsp;</li>

<li>#NEXT_X_ROWS_AS_ONE_COMMAND:1<br />
INSERT INTO tablename <br />
(col1, col2, col3, col4)<br />
SELECT col_a, col_b, col_3, col_4<br />
FROM table2;<br />&nbsp;</li>

<li>#NEXT_X_ROWS_AS_ONE_COMMAND:1<br />
INSERT INTO table1 <br />
(col1, col2, col3, col4 )<br />
SELECT p.othercol_a, p.othercol_b, po.othercol_c, pm.othercol_d<br />
FROM table2 p, table3 pm<br />
LEFT JOIN othercol_f po<br />
ON p.othercol_f = po.othercol_f<br />
WHERE p.othercol_f = pm.othercol_f;</li>
</ul></code>' );
  define('REASON_TABLE_ALREADY_EXISTS','Tableを作成することができません。既に存在しています。');
  define('REASON_TABLE_DOESNT_EXIST','Tableを消去することができません。存在していません。');
  define('REASON_TABLE_NOT_FOUND','Tableがないため消去することができません。');
  define('REASON_CONFIG_KEY_ALREADY_EXISTS','configuration_keyを挿入できません。既に存在しています');
  define('REASON_COLUMN_ALREADY_EXISTS','カラムを追加できません、既に存在しています');
  define('REASON_COLUMN_DOESNT_EXIST_TO_DROP','存在しないためカラムを削除できません。');
  define('REASON_COLUMN_DOESNT_EXIST_TO_CHANGE','存在しないためカラムを変更することができません');
  define('REASON_PRODUCT_TYPE_LAYOUT_KEY_ALREADY_EXISTS','prod-type-layout configuration_keyを祖運有することができません。既に存在しています。');
  define('REASON_INDEX_DOESNT_EXIST_TO_DROP','存在しないためTableのインデックスを削除できません。');
  define('REASON_PRIMARY_KEY_DOESNT_EXIST_TO_DROP','存在しないためTable上のprimary keyを削除できません');
  define('REASON_INDEX_ALREADY_EXISTS','Tableにインデックスを追加できません。既に存在しています。');
  define('REASON_PRIMARY_KEY_ALREADY_EXISTS','primary keyをtableに追加できません。既に存在しています');
  define('REASON_NO_PRIVILEGES','User '.DB_SERVER_USERNAME.'@'.DB_SERVER.' データベースへの権限がありません '.DB_DATABASE.'.');

?>
