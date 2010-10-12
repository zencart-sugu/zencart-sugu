<?php
  // 管理画面用
define('MODULE_GLOBALNAVI_TITLE', 'グローバルナビ');
define('MODULE_GLOBALNAVI_DESCRIPTION', 'グローバルナビ<br />グローバルナビを表示するブロックを追加します。<br />有効化後に<a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=addon_modules/blocks', 'NONSSL') . '">ブロックの設定</a>から表示設定をしてください。');
define('MODULE_GLOBALNAVI_STATUS_TITLE', 'グローバルナビブロックの有効化');
define('MODULE_GLOBALNAVI_STATUS_DESCRIPTION', 'グローバルナビを有効にしますか？ <br />true: 有効<br />false: 無効');
define('MODULE_GLOBALNAVI_SORT_ORDER_TITLE', '優先順');
define('MODULE_GLOBALNAVI_SORT_ORDER_DESCRIPTION', 'モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。');

// install用
define('MODULE_GLOBALNAVI_LIMIT_TITLE', '表示するカテゴリの上限');
define('MODULE_GLOBALNAVI_LIMIT_DESCRIPTION', 'グローバルナビに表示するカテゴリ数の上限を設定します');


// addon_moduleブロック管理用
define('MODULE_GLOBALNAVI_BLOCK_TITLE', 'グローバルナビ');

?>
