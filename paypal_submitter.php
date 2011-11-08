<?php

$_GET['main_page'] = 'index';
require_once(dirname(__FILE__) . '/includes/application_top.php');
while (ob_get_level()) {
  ob_end_clean();
}
header('Content-Type: text/html; charset=UTF-8');

$paypalParamNames = array(
  'business',
  'subtotal',
  'currency_code',
  'buyer_email',
  'billing_country',
  'billing_zip',
  'billing_state',
  'billing_city',
  'billing_address1',
  'billing_address2',
  'billing_last_name',
  'billing_first_name',
  'country',
  'zip',
  'state',
  'city',
  'address1',
  'address2',
  'last_name',
  'first_name',
  'custom',
  'return',
  'paymentaction',
  'cancel_return',
);

$hiddenTag = '';
foreach ($paypalParamNames as $paramName) {
  if ( isset($_POST[$paramName]) ) {
    $hiddenTag = $hiddenTag .
      '<input type="hidden" name="' . htmlspecialchars($paramName) . '" value="' . htmlspecialchars(mb_convert_encoding($_POST[$paramName], 'UTF-8', mb_internal_encoding())) . '" />' . "\r\n";
  }
  else {
    exit;
  }
}

$paypalUrl = $_POST['paypal_url'];

echo <<< __DOC_END__
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Paypal</title>
</head>
<body onload="document.paypal_submitter.submit()">
	<form name="paypal_submitter" method="POST" action="${paypalUrl}">
	${hiddenTag}
	<div align="center">
		※ カード情報入力ページへジャンプしております……。<br />
		しばらく待ってもページが切り替わらない場合、&nbsp;&nbsp;<input type="submit" value=" 更新 ">&nbsp;&nbsp;ボタンを１回だけ押してください。<br />
		（１回だけボタンを押して、そのままお待ちください。）
	</div>
	</form>
</body>
</html>
__DOC_END__;

?>