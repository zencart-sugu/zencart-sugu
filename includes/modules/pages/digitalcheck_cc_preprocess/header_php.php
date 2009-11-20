<?php
/**
 * digitalcheck_cc_preprocess header_php.php
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

  $url  = MODULE_PAYMENT_DIGITALCHECK_CC_URL;
  $parm = array('IP'      => MODULE_PAYMENT_DIGITALCHECK_CC_IP,
                'SID'     => $sid,
                'N1'      => 'ITEM',
                'K1'      => (int)$order->info['total'],
                'KAKUTEI' => MODULE_PAYMENT_DIGITALCHECK_CC_IS_AUTHORIZE_ONLY=='True'?'0':'1',
                'STORE'   => '51',
                'FUKA'    => $fuka,
                );

  // 要求レコードの作成
  digitalchcek_save_request_parm($sid, 'cc', $url.'?'.digitalchcek_http_build_query($parm), $fuka);

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
        . '      <center><input type="submit" value="クレジット決済を開始する"></center>'."\n"
        . '    </form>'."\n"
//for debug
//        . '    <a href="'.zen_href_link(FILENAME_CHECKOUT_PROCESS).'&SID='.$sid.'&FUKA='.$fuka.'">清算</a>'."\n"
        . '  </body>'."\n"
        . '</html>'."\n";
  print mb_convert_encoding($html, "Shift-JIS", "EUC");
  exit;
?>
