<?php
define('HEADING_TITLE', '商品CSVの定義');
define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_FORMAT_NAME', 'フォーマット名');
define('TABLE_HEADING_FORMAT_TYPE', 'タイプ');
define('TABLE_HEADING_ACTION', '操作');

define('MESSAGE_DELETE_FORMAT', 'ID:%s %sを削除しますか？');
define('MESSAGE_CHECK_NAME', 'フォーマット名を指定してください');
define('MESSAGE_NO_FORMATS', '保存されたフォーマットはありません');

define('FORM_FORMAT_NAME', 'フォーマット名');
define('FORM_FORMAT_TYPE', 'タイプ');
define('FORM_FORMAT_NOW', '現在設定されているフォーマット');
define('FORM_FORMAT_COLUMN_NAME', '第%sカラム');
define('FORM_FORMAT_STEP1', 'STEP1: 商品CSVをアップロード');
define('FORM_FORMAT_MESSAGE1', '商品CSVをアップロードしてください。');
define('FORM_FORMAT_UPLOAD', 'アップロード');
define('FORM_FORMAT_FILE', 'CSVファイル');
define('FORM_FORMAT_STEP2', 'STEP2: フォーマット設定');
define('FORM_FORMAT_MESSAGE2', 'アップロードされたファイルを元に、各列の項目の内容を定義してください。');
define('FORM_FORMAT_COLUMN_HEADER1', 'カラム番号');
define('FORM_FORMAT_COLUMN_HEADER2', 'アップロードしたファイルの1行目の値');
define('FORM_FORMAT_COLUMN_HEADER3', '項目の内容');
define('FORM_FORMAT_NOTICE', '注意: 次の項目は必ず必要です。');
define('FORM_FORMAT_NECESSITY_PRODUCT', '型番');
define('FORM_FORMAT_NECESSITY_CATEGORY', 'カテゴリ名-階層1');
define('FORM_FORMAT_NECESSITY_OPTION', 'オプション名 オプション値 型番');
define('FORM_FORMAT_SAVE', '設定');

define('FORM_FORMAT_INVALID_FILE', 'ファイルの読み込みに失敗しました。ファイル形式が正常でない可能性があります。ファイルが正しいか確認して再度アップロードしてください。<br/>ファイルが大きすぎる場合は分割して試してください。');

define('FORM_FORMAT_ERROR_REPEATED', '%sが重複しています');
define('FORM_FORMAT_ERROR_NECESSITY', '%sは必ず設定してください');
define('FORM_FORMAT_NECESSITY_SHORT_CATEGORY', '階層1');
define('FORM_FORMAT_CATEGORY_LEVEL_PREFIX', '-階層');
define('FORM_FORMAT_CATEGORY_LEVEL_SEQ_ERROR', '%sの階層が連続していません');
define('FORM_FORMAT_CATEGORY_LEVEL_OVER', '%sの階層より深い階層を他言語で指定することはできません');
?>