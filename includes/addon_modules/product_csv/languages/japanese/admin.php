<?php
define('HEADING_TITLE', 'CSVによる一括管理');

define('PRODUCT_CSV_IMPORT_TITLE', '* 商品の一括登録、一括更新');
define('PRODUCT_CSV_IGNORE_FIRST_LINE', '1行目を無視する');
define('PRODUCT_CSV_IMPORT_MESSAGE', 'CSVファイルをアップロードしてください。');
define('PRODUCT_CSV_IMPORT_BUTTON', 'アップロード');

define('PRODUCT_CSV_EXPORT_TITLE', '* 商品CSVのダウンロード');
define('PRODUCT_CSV_EXPORT_CATEGORY', 'ダウンロード対象カテゴリ');
define('PRODUCT_CSV_EXPORT_BUTTON', 'CSVダウンロード');

define('PRODUCT_CSV_FORMAT', 'CSVファイルのフォーマット');

// error message
define('PRODUCT_CSV_ERROR_READ', 'ファイルの読み込みに失敗しました');
define('PRODUCT_CSV_ERROR_INVALID_FORMAT', '指定されたフォーマットとファイルの形式が一致しません');

// import message
define('PRODUCT_CSV_TABLE_HEADER', '実行結果');
define('PRODUCT_CSV_TABLE_LINE_NUMBER', '行番号');
define('PRODUCT_CSV_MESSAGE_SUCCESS', '更新成功');
// product
define('PRODUCT_CSV_MESSAGE_DELETE', '削除しました');
define('PRODUCT_CSV_MESSAGE_NO_MODEL', '型番がありません');
define('PRODUCT_CSV_MESSAGE_NOT_STRING', '%sは文字列で入力してください');
define('PRODUCT_CSV_MESSAGE_NOT_PATHSTRING', '%sに使用できるのは英数字と_-/.です');
define('PRODUCT_CSV_MESSAGE_NOT_URLSTRING', '%sに使用できるのは英数字と-.$,;:&=?!*~@#_()/です 先頭はhttp(s)://で始まっている必要があります');
define('PRODUCT_CSV_MESSAGE_NOT_INT', '%sは正の整数で入力してください');
define('PRODUCT_CSV_MESSAGE_NOT_SIGNED_INT', '%sは整数で入力してください');
define('PRODUCT_CSV_MESSAGE_NOT_FLOAT', '%sは正の少数で入力してください');
define('PRODUCT_CSV_MESSAGE_NOT_SIGNED_FLOAT', '%sは少数で入力してください');
define('PRODUCT_CSV_MESSAGE_NOT_ZERO_ONE', '%sは0か1で入力してください');
define('PRODUCT_CSV_MESSAGE_NOT_DATETIME_SHORT', '%sはYYYY-MM-DDで入力してください');
define('PRODUCT_CSV_MESSAGE_NOT_DATETIME_LONG', '%sはYYYY-MM-DD HH:MM:SSで入力してください');
define('PRODUCT_CSV_MESSAGE_NO_PRODUCT_TYPE', '商品タイプ%sは存在しません');
define('PRODUCT_CSV_MESSAGE_NO_TAX_CLASS_TITLE', '税種別%sは存在しません');
define('PRODUCT_CSV_MESSAGE_NO_SHIPPING_TYPE', '配送タイプ%sは存在しません');

// category
define('PRODUCT_CSV_MESSAGE_NO_TOPLEVEL_CATEGORY', '階層1は必ず入力してください');
define('PRODUCT_CSV_MESSAGE_NO_CATEGORY_NAME', 'カテゴリ名に空欄があります');
define('PRODUCT_CSV_MESSAGE_NOT_SEQUENTIAL', 'カテゴリ階層の間に空欄があります');
define('PRODUCT_CSV_MESSAGE_NOT_MATCH', 'カテゴリ名%sが一致しませんでした');
define('PRODUCT_CSV_MESSAGE_CANNOT_ADD_CATEGORY', '商品の入ったカテゴリにサブカテゴリを追加することはできません');
define('PRODUCT_CSV_MESSAGE_CANNOT_ADD_PRODUCT', 'サブカテゴリの入ったカテゴリに商品を追加することはできません');
define('PRODUCT_CSV_MESSAGE_CREATE_CATEGORY', 'カテゴリを作成しました');
define('PRODUCT_CSV_MESSAGE_DELETE_CATEGORY', 'カテゴリとの紐付けを削除しました');
// option
define('PRODUCT_CSV_MESSAGE_NOT_PLUS_MINUS', '%sは+または-で入力してください');
define('PRODUCT_CSV_MESSAGE_NO_OPTION_NAME', 'オプション名が一致しません');
define('PRODUCT_CSV_MESSAGE_OPTION_NAME_IS_EMPTY', 'オプション名が空欄です');
define('PRODUCT_CSV_MESSAGE_OPTION_VALUE_IS_EMPTY', 'オプション値が空欄です');
define('PRODUCT_CSV_MESSAGE_OPTION_DELETE', 'オプションとの紐付けを削除しました');
define('PRODUCT_CSV_MESSAGE_OPTION_VALUE', 'オプション値を追加しました');
define('PRODUCT_CSV_RESERVED_OPTION_NAME', '延長保証');
define('PRODUCT_CSV_MESSAGE_OPTION_NAME_RESERVED', 'オプション名:'.PRODUCT_CSV_RESERVED_OPTION_NAME.'は指定できません');

define('PRODUCT_CSV_MESSAGE_IMPORT_STATUS', '%s行読み込みました　成功:%s件　失敗:%s件');
?>