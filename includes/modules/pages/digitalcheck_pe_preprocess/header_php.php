<?php
/**
 * digitalcheck_CV_preprocess header_php.php
 *
 * @package page
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: $
 */
  require(DIR_WS_CLASSES.'order.php');
  $order = new order;

  $sid  = digitalchcek_get_new_sid();
  $fuka = digitalchcek_get_fuka();

  $url    = MODULE_PAYMENT_DIGITALCHECK_PE_URL;
  if (ENABLE_SSL == 'true')
    $okurl = HTTPS_SERVER.DIR_WS_HTTPS_CATALOG.'extras/digitalcheck_pe_finish_payment.php';
  else
    $okurl = HTTP_SERVER.DIR_WS_HTTPS_CATALOG.'extras/digitalcheck_pe_finish_payment.php';

  $parm   = array('IP'      => MODULE_PAYMENT_DIGITALCHECK_PE_IP,
                  'SID'     => $sid,
                  'NAME1'   => digitalcheck_name_convert($order->billing['firstname']),
                  'NAME2'   => digitalcheck_name_convert($order->billing['lastname']),
                  'KANA1'   => digitalcheck_kana_convert($order->billing['firstname_kana']),
                  'KANA2'   => digitalcheck_kana_convert($order->billing['lastname_kana']),
                  'YUBIN1'  => digitalcheck_zip_convert($order->billing['postcode']),
                  'TEL'     => digitalcheck_tel_convert($order->billing['telephone']),
                  'ADR1'    => $order->billing['state'].$order->billing['city'].$order->billing['street_address'],
                  'MAIL'    => $order->customer['email_address'],
                  'N1'      => 'ITEM',
                  'K1'      => (int)$order->info['total'],
                  'STORE'   => '84',
                  'FUKA'    => $fuka,
                  'OKURL'   => $okurl,
                  );

  // 要求レコードの作成
  digitalchcek_save_request_parm($sid, 'payeasy', $url.'?'.digitalchcek_http_build_query($parm), $fuka);

  // デジタルチェックへの遷移フォーム作成
  mb_http_output("pass");
  mb_internal_encoding("Shift-JIS");
  header("Content-type: text/html; charset=Shift-JIS"); 
  $html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">'."\n"
        . '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">'."\n"
        . '  <head>'."\n"
        . '    <meta http-equiv="Content-Type" content="text/html; charset=Shift-JIS"/>'."\n"
        . '    <script language="javascript">//<!--'."\n"
        . '      function onloaded()'."\n"
        . '      {'."\n"
        . '        document.form1.submit();'."\n"
        . '      }'."\n"
        . '    //--></script>'."\n"
        . '  </head>'."\n"
        . '  <body onload="onloaded();">'."\n"
        . '    <form name="form1" id="form1" method="post" action="'.$url.'">'."\n";
  foreach ($parm as $key => $value) {
    $html .= '      <input type="hidden" name="'.$key.'" value="'.htmlspecialchars($value).'">'."\n";
  }
  $html .='      <center>ここからデジタルチェックの決済ページに移動します。<br>'."\n"
        . '      決済方法を変更される方は<a href="'.zen_href_link(FILENAME_CHECKOUT_PAYMENT).'">こちら</a>からお戻り下さい。<br><br>'."\n"
        . '      <center><input type="submit" value="Pay Easy決済を開始する"></center>'."\n"
        . '    </form>'."\n"
        . '  </body>'."\n"
        . '</html>'."\n";
  print mb_convert_encoding($html, "Shift-JIS", "EUC");
  exit;
?>
