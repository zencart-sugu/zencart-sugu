<?php
$params = array(
  'file_prefix' => 'orders-',
  'file_extension' => 'csv',
  'file_encode' => 'SJIS',
  'fileds_terminated' => ',',
  'fileds_enclosed' => '"',
  'fileds_escaped' => '\\',
  'lines_terminated' => "\n",
);

// TABLE_ORDERS
$fields = array();

$fields[] = array('table' => TABLE_ORDERS, 'field' => 'orders_id', 'header' => '注文番号', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'customers_id', 'header' => '顧客 - ID', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'customers_name', 'header' => '顧客 - 氏名', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'customers_company', 'header' => '顧客 - 会社名', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'customers_street_address', 'header' => '顧客 - 住所1', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'customers_suburb', 'header' => '顧客 - 住所2', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'customers_city', 'header' => '顧客 - 市区町村', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'customers_postcode', 'header' => '顧客 - 郵便番号', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'customers_state', 'header' => '顧客 - 都道府県', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'customers_country', 'header' => '顧客 - 国', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'customers_telephone', 'header' => '顧客 - 電話番号', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'customers_email_address', 'header' => '顧客 - Eメールアドレス', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'customers_address_format_id', 'header' => '顧客 - 住所フォーマットID', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'delivery_name', 'header' => '配送先 - 氏名', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'delivery_company', 'header' => '配送先 - 会社名', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'delivery_street_address', 'header' => '配送先 - 住所1', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'delivery_suburb', 'header' => '配送先 - 住所2', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'delivery_city', 'header' => '配送先 - 市区町村', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'delivery_postcode', 'header' => '配送先 - 郵便番号', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'delivery_state', 'header' => '配送先 - 都道府県', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'delivery_country', 'header' => '配送先 - 国', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'delivery_address_format_id', 'header' => '配送先 - 住所フォーマットID', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'billing_name', 'header' => '請求先 - 氏名', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'billing_company', 'header' => '請求先 - 会社名', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'billing_street_address', 'header' => '請求先 - 住所1', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'billing_suburb', 'header' => '請求先 - 住所2', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'billing_city', 'header' => '請求先 - 市区町村', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'billing_postcode', 'header' => '請求先 - 郵便番号', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'billing_state', 'header' => '請求先 - 都道府県', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'billing_country', 'header' => '請求先 - 国', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'billing_address_format_id', 'header' => '請求先 - 住所フォーマットID', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'payment_method', 'header' => '支払方法', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'payment_module_code', 'header' => '支払モジュールコード', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'shipping_method', 'header' => '配送方法', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'shipping_module_code', 'header' => '配送モジュールコード', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'coupon_code', 'header' => 'クーポンコード', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'cc_type', 'header' => 'CCタイプ', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'cc_owner', 'header' => 'CC名義', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'cc_number', 'header' => 'CC番号', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'cc_expires', 'header' => 'CC有効期限', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'cc_cvv', 'header' => 'CCV', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'last_modified', 'header' => '最終更新日時', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'date_purchased', 'header' => '注文日時', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'orders_status', 'header' => '注文ステータス', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'orders_date_finished', 'header' => '処理完了日時', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'currency', 'header' => '通貨', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'currency_value', 'header' => 'レート', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'order_total', 'header' => '総合計金額', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'order_tax', 'header' => '消費税', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'paypal_ipn_id', 'header' => 'paypal_ipn_id', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'ip_address', 'header' => 'IPアドレス', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'delivery_telephone', 'header' => '配送先 - 電話番号', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'delivery_fax', 'header' => '配送先 - FAX番号', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'billing_telephone', 'header' => '請求先 - 電話番号', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'billing_fax', 'header' => '請求先 - FAX番号', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'customers_fax', 'header' => '顧客 - FAX番号', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'customers_name_kana', 'header' => '顧客 - 氏名かな', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'delivery_name_kana', 'header' => '配送先 - 氏名かな', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS, 'field' => 'billing_name_kana', 'header' => '請求先 - 氏名かな', 'convert' => null);

$fields[] = array('table' => TABLE_ORDERS_PRODUCTS, 'field' => 'orders_products_id', 'header' => '注文明細ID', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS_PRODUCTS, 'field' => 'products_id', 'header' => '商品ID', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS_PRODUCTS, 'field' => 'products_model', 'header' => '型番', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS_PRODUCTS, 'field' => 'products_name', 'header' => '商品名', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS_PRODUCTS, 'field' => 'products_price', 'header' => '商品単価', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS_PRODUCTS, 'field' => 'final_price', 'header' => '販売単価', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS_PRODUCTS, 'field' => 'products_tax', 'header' => '税率', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS_PRODUCTS, 'field' => 'products_quantity', 'header' => '数量', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS_PRODUCTS, 'field' => 'onetime_charges', 'header' => 'ワンタイム課金', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS_PRODUCTS, 'field' => 'products_priced_by_attribute', 'header' => '商品属性による価格', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS_PRODUCTS, 'field' => 'product_is_free', 'header' => '無料商品', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS_PRODUCTS, 'field' => 'products_discount_type', 'header' => '割引タイプ', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS_PRODUCTS, 'field' => 'products_discount_type_from', 'header' => '割引前の価格', 'convert' => null);
$fields[] = array('table' => TABLE_ORDERS_PRODUCTS, 'field' => 'products_prid', 'header' => 'products_prid', 'convert' => null);

$tables = array();
$tables[] = array(
  'table' => TABLE_ORDERS,
  'join_type' => false,
  'join_conditions' => false
  );
$tables[] = array(
  'table' => TABLE_ORDERS_PRODUCTS,
  'join_type' => 'inner',
  'join_conditions' => TABLE_ORDERS . ".orders_id = " . TABLE_ORDERS_PRODUCTS . ".orders_id"
  );

$conditions = array();

$order_by = array();
?>