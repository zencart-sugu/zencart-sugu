<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: freeoptions.php 3027 2006-02-13 17:15:51Z drbyte $
 */

define('MODULE_SHIPPING_FREEOPTIONS_TEXT_TITLE', '配送料無料オプション');
define('MODULE_SHIPPING_FREEOPTIONS_TEXT_DESCRIPTION', '
無料オプションは他の配送モジュールが表示されている時に配送料無料オプションを表示するために使用します。
常に表示、注文合計金額、注文重量または注文点数を基準に設定できます。
この無料オプションモジュールは配送料無料が表示されているときは見えません。<br /><br />
合計を>= 0.00 and <= 0.00に設定すると配送料無料以外の全てのモジュールに有効になります。<br /><br />
注意: 合計、重量、点数の全ての設定を空欄にするとこのモジュールを無効になります。<br /><br />
注意: 配送料無料オプションは重量０で無料に設定されていると表示されません。配送料無料モジュールを参照してください');
define('MODULE_SHIPPING_FREEOPTIONS_TEXT_WAY', '配送料無料');

?>