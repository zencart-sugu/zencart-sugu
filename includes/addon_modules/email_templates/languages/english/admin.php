<?php
define('TEXT_EMAIL_TEMPLATE_NEW_GROUP', ' or New Group: ');
define('TEXT_EMAIL_TEMPLATE_NO_GROUP', ' There are no groups. Please specify the group.');
define('TEXT_EMAIL_TEMPLATE_OTHER_GROUP', ' The group name can be specified. Please specify the name of another group.');
define('HEADING_TITLE', 'Email Template');
define('TITLE_ADD_EMAIL_TEMPLATE', 'Add Email Template');
define('TITLE_LIST_EMAIL_TEMPLATE', 'Email Template List');
define('TABLE_HEADING_UPDATE', 'Email Template Update');
define('TABLE_HEADING_ADD', TITLE_ADD_EMAIL_TEMPLATE);
define('TABLE_HEADING_GROUP', 'Group');
define('TABLE_HEADING_TITLE', 'Title');
define('TABLE_HEADING_EMAIL_SUBJECT', 'Subject');
define('TABLE_HEADING_EMAIL_CONTENTS', 'Body');
define('TABLE_HEADING_LAST_UPDATE', 'Last Update');
define('TABLE_HEADING_ACTION', 'Action');

if ((int)$_REQUEST['id'] == MODULE_EMAIL_TEMPLATE_CREATE_ACCOUNT_MAIL_ID) {
  if (defined('EMOBILE_APPLIES_LETTER')) {
    define('TABLE_HEADING_HELP', '
    	<p><u>Reserved words:</u></p>
    	<font color="blue">[CUSTOMER_NAME]</font>:&nbsp;Replaced by Customers Name<br>
    	<font color="blue">[CUSTOMER_EMAIL]</font>:&nbsp;Replaced by Customers Email<br>
    	<font color="blue">[CUSTOMER_DOB]</font>:&nbsp;Replaced by Customers Birthday<br>
    	<font color="blue">[CUSTOMER_PHONE]</font>:&nbsp;Replaced by Customers Telephone Number<br>
    	<font color="blue">[CUSTOMER_FAX]</font>:&nbsp;Replaced by Customers FAX Number<br>
    ');
  }
  else {
    define('TABLE_HEADING_HELP', '
    	<p><u>Reserved words:</u></p>
    	<font color="blue">[CUSTOMER_NAME]</font>:&nbsp;Replaced by Customers Name<br>
    	<font color="blue">[CUSTOMER_EMAIL]</font>:&nbsp;Replaced by Customers Email<br>
    	<font color="blue">[CUSTOMER_DOB]</font>:&nbsp;Replaced by Customers Birthday<br>
    	<font color="blue">[CUSTOMER_PHONE]</font>:&nbsp;Replaced by Customers Telephone Number<br>
    	<font color="blue">[CUSTOMER_FAX]</font>:&nbsp;Replaced by Customers FAX Number<br>
    ');
  }
}
else if ((int)$_REQUEST['id'] == MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_MAIL_ID) {
  define('TABLE_HEADING_HELP', '
  	<p><u>Reserved words:</u></p>
  	<font color="blue">[CUSTOMER_NAME]</font>:&nbsp;Replaced by Customers Name<br>
  	<font color="blue">[ORDER_ID]</font>:&nbsp;Replaced by Order ID<br>
  	<font color="blue">[DATE_ORDERED]</font>:&nbsp;Replaced by Order Date<br>
  	<font color="blue">[INVOICE_URL]</font>:&nbsp;Replaced by Order Information URL<br>
  	<font color="blue">[PRODUCTS_ORDERED]</font>:&nbsp;Replaced by Product Name<br>
  	<font color="blue">[TOTALS]</font>:&nbsp;Replaced by Total Amount<br>
  	<font color="blue">[DELIVERY_ADDRESS]</font>:&nbsp;Replaced by Shipping Address<br>
  	<font color="blue">[BILLING_ADDRESS]</font>:&nbsp;Replaced by Billing Address<br>
  	<font color="blue">[PAYMENT_METHOD]</font>:&nbsp;Replaced by Payment Method<br>
  	<font color="blue">[COMMENT]</font>:&nbsp;Replaced by Comment<br>
  ');
}
else if ((int)$_REQUEST['id'] == MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_VISITOR_MAIL_ID) {
  define('TABLE_HEADING_HELP', '
  	<p><u>Reserved words:</u></p>
  	<font color="blue">[CUSTOMER_NAME]</font>:&nbsp;Replaced by Customers Name<br>
  	<font color="blue">[ORDER_ID]</font>:&nbsp;Replaced by Order ID<br>
  	<font color="blue">[DATE_ORDERED]</font>:&nbsp;Replaced by Order Date<br>
  	<font color="blue">[PRODUCTS_ORDERED]</font>:&nbsp;Replaced by Product Name<br>
  	<font color="blue">[TOTALS]</font>:&nbsp;Replaced by Total Amount<br>
  	<font color="blue">[DELIVERY_ADDRESS]</font>:&nbsp;Replaced by Shipping Address<br>
  	<font color="blue">[BILLING_ADDRESS]</font>:&nbsp;Replaced by Billing Address<br>
  	<font color="blue">[PAYMENT_METHOD]</font>:&nbsp;Replaced by Payment Method<br>
  	<font color="blue">[COMMENT]</font>:&nbsp;Replaced by Comment<br>
  ');
}
else if ((int)$_REQUEST['id'] == MODULE_EMAIL_TEMPLATE_STATUS_MAIL_ID) {
  define('TABLE_HEADING_HELP', '
  	<p><u>Reserved words:</u></p>
  	<font color="blue">[CUSTOMER_NAME]</font>:&nbsp;Replaced by Customers Name<br>
  	<font color="blue">[ORDER_ID]</font>:&nbsp;Replaced by Order ID<br>
  	<font color="blue">[INVOICE_URL]</font>:&nbsp;Replaced by Order Information URL<br>
  	<font color="blue">[COMMENTS]</font>:&nbsp;Replaced by Comment on Change Status<br>
  	<font color="blue">[DATE_ORDERED]</font>:&nbsp;Replaced by Order Date<br>
  	<font color="blue">[PRODUCTS_ORDERED]</font>:&nbsp;Replaced by Product Name<br>
  	<font color="blue">[TOTALS]</font>:&nbsp;Replaced by Total Amount<br>
  	<font color="blue">[DELIVERY_ADDRESS]</font>:&nbsp;Replaced by Shipping Address<br>
  	<font color="blue">[BILLING_ADDRESS]</font>:&nbsp;Replaced by Billing Address<br>
  	<font color="blue">[PAYMENT_METHOD]</font>:&nbsp;Replaced by Payment Method<br>
  ');
}
else if ((int)$_REQUEST['id'] == MODULE_EMAIL_TEMPLATE_PASSWORD_FORGOTTEN_MAIL_ID) {
  if (defined('EMOBILE_APPLIES_LETTER')) {
    define('TABLE_HEADING_HELP', '
    	<p><u>予約済みの単語:</u></p>
    	<font color="blue">[CUSTOMER_NAME]</font>:&nbsp;顧客の名前に置換されます<br>
    	<font color="blue">[NEW_PASSWORD]</font>:&nbsp;新しいパスワードに置換されます<br>
    ');
  }
  else {
    define('TABLE_HEADING_HELP', '
    	<p><u>予約済みの単語:</u></p>
    	<font color="blue">[CUSTOMER_NAME]</font>:&nbsp;顧客の名前に置換されます<br>
    	<font color="blue">[NEW_PASSWORD]</font>:&nbsp;新しいパスワードに置換されます<br>
    ');
  }
}
else {
  define('TABLE_HEADING_HELP', '
  	<p><u>Reserved words:</u></p>
  	<font color="blue">[CUSTOMER_NAME]</font>:&nbsp;Replaced by Customers Name<br>
  	<font color="blue">[ORDER_ID]</font>:&nbsp;Replaced by Order ID<br>
  	<font color="blue">[INVOICE_URL]</font>:&nbsp;Replaced by Order Information URL<br>
  	<font color="blue">[COMMENTS]</font>:&nbsp;Replaced by Comment on Change Status<br>
  ');
}

define('TEXT_EMAIL_TEMPLATE_DELETE', 'Delete');
define('TEXT_EMAIL_TEMPLATE_ADDED_MESSAGE', 'Added Email Template (%s).');
define('TEXT_EMAIL_TEMPLATE_UPDATED_MESSAGE', 'Updated Email Template (%s).');
define('TEXT_EMAIL_TEMPLATE_TITLE_EMPTY', 'The title of the email template is not entered.');
define('TEXT_EMAIL_TEMPLATE_GROUP_EMPTY', 'The group is not entered in the email template.');
?>
