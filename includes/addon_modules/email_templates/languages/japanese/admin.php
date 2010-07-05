<?php
define('TEXT_EMAIL_TEMPLATE_NEW_GROUP', ' or 新規グループ: ');
define('TEXT_EMAIL_TEMPLATE_NO_GROUP', ' グループがありません。 グループを指定してください。');
define('TEXT_EMAIL_TEMPLATE_OTHER_GROUP', ' そのグループ名は指定できません。別なグループ名を指定してください。');
define('HEADING_TITLE', 'Emailテンプレート');
define('TITLE_ADD_EMAIL_TEMPLATE', 'Emailテープレート追加');
define('TITLE_LIST_EMAIL_TEMPLATE', 'Emailテープレート一覧');
define('TABLE_HEADING_UPDATE', 'Emailテープレート更新');
define('TABLE_HEADING_ADD', TITLE_ADD_EMAIL_TEMPLATE);
define('TABLE_HEADING_GROUP', 'グループ');
define('TABLE_HEADING_TITLE', 'タイトル');
define('TABLE_HEADING_EMAIL_SUBJECT', 'メール件名');
define('TABLE_HEADING_EMAIL_CONTENTS', 'メール本文');
define('TABLE_HEADING_LAST_UPDATE', '最終更新日');
define('TABLE_HEADING_ACTION', '操作');

if ((int)$_REQUEST['id'] == MODULE_EMAIL_TEMPLATE_CREATE_ACCOUNT_MAIL_ID) {
  if (defined('EMOBILE_APPLIES_LETTER')) {
    define('TABLE_HEADING_HELP', '
    	<p><u>予約済みの単語:</u></p>
    	<font color="blue">[CUSTOMER_NAME]</font>:&nbsp;顧客の名前に置換されます<br>
    	<font color="blue">[CUSTOMER_EMAIL]</font>:&nbsp;顧客のメールアドレスに置換されます<br>
    	<font color="blue">[CUSTOMER_DOB]</font>:&nbsp;顧客の誕生日に置換されます<br>
    	<font color="blue">[CUSTOMER_PHONE]</font>:&nbsp;顧客の電話番号に置換されます<br>
    	<font color="blue">[CUSTOMER_FAX]</font>:&nbsp;顧客のFAX番号に置換されます<br>
    ');
  }
  else {
    define('TABLE_HEADING_HELP', '
    	<p><u>予約済みの単語:</u></p>
    	<font color="blue">[CUSTOMER_NAME]</font>:&nbsp;顧客の名前に置換されます<br>
    	<font color="blue">[CUSTOMER_EMAIL]</font>:&nbsp;顧客のメールアドレスに置換されます<br>
    	<font color="blue">[CUSTOMER_DOB]</font>:&nbsp;顧客の誕生日に置換されます<br>
    	<font color="blue">[CUSTOMER_PHONE]</font>:&nbsp;顧客の電話番号に置換されます<br>
    	<font color="blue">[CUSTOMER_FAX]</font>:&nbsp;顧客のFAX番号に置換されます<br>
    ');
  }
}
else if ((int)$_REQUEST['id'] == MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_MAIL_ID) {
  define('TABLE_HEADING_HELP', '
  	<p><u>予約済みの単語:</u></p>
  	<font color="blue">[CUSTOMER_NAME]</font>:&nbsp;顧客の名前に置換されます<br>
  	<font color="blue">[ORDER_ID]</font>:&nbsp;注文IDに置換されます<br>
  	<font color="blue">[DATE_ORDERED]</font>:&nbsp;注文日付に変換されます<br>
  	<font color="blue">[INVOICE_URL]</font>:&nbsp;注文情報URLに変換されます<br>
  	<font color="blue">[PRODUCTS_ORDERED]</font>:&nbsp;商品名に変換されます<br>
  	<font color="blue">[TOTALS]</font>:&nbsp;金額合計に変換されます<br>
  	<font color="blue">[DELIVERY_ADDRESS]</font>:&nbsp;配送先住所に変換されます<br>
  	<font color="blue">[BILLING_ADDRESS]</font>:&nbsp;請求先住所に変換されます<br>
  	<font color="blue">[PAYMENT_METHOD]</font>:&nbsp;支払方法に変換されます<br>
  	<font color="blue">[COMMENT]</font>:&nbsp;備考欄に変換されます<br>
  ');
}
else if ((int)$_REQUEST['id'] == MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_VISITOR_MAIL_ID) {
  define('TABLE_HEADING_HELP', '
  	<p><u>予約済みの単語:</u></p>
  	<font color="blue">[CUSTOMER_NAME]</font>:&nbsp;顧客の名前に置換されます<br>
  	<font color="blue">[ORDER_ID]</font>:&nbsp;注文IDに置換されます<br>
  	<font color="blue">[DATE_ORDERED]</font>:&nbsp;注文日付に変換されます<br>
  	<font color="blue">[PRODUCTS_ORDERED]</font>:&nbsp;商品名に変換されます<br>
  	<font color="blue">[TOTALS]</font>:&nbsp;金額合計に変換されます<br>
  	<font color="blue">[DELIVERY_ADDRESS]</font>:&nbsp;配送先住所に変換されます<br>
  	<font color="blue">[BILLING_ADDRESS]</font>:&nbsp;請求先住所に変換されます<br>
  	<font color="blue">[PAYMENT_METHOD]</font>:&nbsp;支払方法に変換されます<br>
  	<font color="blue">[COMMENT]</font>:&nbsp;備考欄に変換されます<br>
  ');
}
else if ((int)$_REQUEST['id'] == MODULE_EMAIL_TEMPLATE_STATUS_MAIL_ID) {
  define('TABLE_HEADING_HELP', '
  	<p><u>予約済みの単語:</u></p>
  	<font color="blue">[CUSTOMER_NAME]</font>:&nbsp;顧客の名前に置換されます<br>
  	<font color="blue">[ORDER_ID]</font>:&nbsp;注文IDに置換されます<br>
  	<font color="blue">[INVOICE_URL]</font>:&nbsp;注文情報URLに変換されます<br>
  	<font color="blue">[DATE_ORDERED]</font>:&nbsp;注文日に変換されます<br>
  	<font color="blue">[PRODUCTS_ORDERED]</font>:&nbsp;商品名に変換されます<br>
  	<font color="blue">[TOTALS]</font>:&nbsp;金額合計に変換されます<br>
  	<font color="blue">[DELIVERY_ADDRESS]</font>:&nbsp;配送先住所に変換されます<br>
  	<font color="blue">[BILLING_ADDRESS]</font>:&nbsp;請求先住所に変換されます<br>
  	<font color="blue">[PAYMENT_METHOD]</font>:&nbsp;支払方法に変換されます<br>
  ');
}
else {
  define('TABLE_HEADING_HELP', '
  	<p><u>予約済みの単語:</u></p>
  	<font color="blue">[CUSTOMER_NAME]</font>:&nbsp;顧客の名前に置換されます<br>
  	<font color="blue">[ORDER_ID]</font>:&nbsp;注文IDに置換されます<br>
  	<font color="blue">[INVOICE_URL]</font>:&nbsp;注文情報URLに変換されます<br>
  ');
}

define('TEXT_EMAIL_TEMPLATE_DELETE', '削除する');
define('TEXT_EMAIL_TEMPLATE_ADDED_MESSAGE', 'Emailテンプレート（%s）を追加しました。');
define('TEXT_EMAIL_TEMPLATE_UPDATED_MESSAGE', 'Emailテンプレート（%s）を更新しました。');
define('TEXT_EMAIL_TEMPLATE_TITLE_EMPTY', 'Emailテンプレートのタイトルが未入力です。');
define('TEXT_EMAIL_TEMPLATE_GROUP_EMPTY', 'Emailテンプレートのグループが未入力です。');
?>
