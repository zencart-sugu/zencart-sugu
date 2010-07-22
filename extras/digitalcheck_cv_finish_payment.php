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
  chdir('../');
  require('includes/application_top.php');

  // 完了要求かもしれない
  if (isset($_REQUEST['SID'])  &&
      isset($_REQUEST['FUKA']) &&
      !isset($_REQUEST['SEQ'])) {
    $parm = "SID=".$_REQUEST['SID']."&FUKA=".$_REQUEST['FUKA'];
    zen_redirect(zen_href_link(FILENAME_CHECKOUT_PROCESS, $parm));
  }

  header("Content-type: text/plane");

  // パラメータの確認
  if (!isset($_REQUEST['SID'])     ||
      !isset($_REQUEST['FUKA'])    ||
      !isset($_REQUEST['SEQ'])     ||
      !isset($_REQUEST['DATE'])    ||
      !isset($_REQUEST['TIME'])    ||
      !isset($_REQUEST['KINGAKU']) ||
      !isset($_REQUEST['CVS'])) {
      print "9";
      exit;
  }

  $sid      = $_REQUEST['SID'];
  $fuka     = $_REQUEST['FUKA'];
  $seq      = $_REQUEST['SEQ'];
  $date     = $_REQUEST['DATE'];
  $time     = $_REQUEST['TIME'];
  $kingaku  = $_REQUEST['KINGAKU'];
  $cvs      = $_REQUEST['CVS'];
  $datetime = substr($date, 0, 4)."-"
            . substr($date, 4, 2)."-"
            . substr($date, 6, 2)." "
            . substr($time, 0, 2).":"
            . substr($time, 2, 2).":"
            . substr($time, 4, 2);
  $param = Array(
    'SID'    =>$sid,
    'FUKA'   =>$fuka,
    'SEQ'    =>$seq,
    'DATE'   =>$date,
    'TIME'   =>$time,
    'KINGAKU'=>$kingaku,
    'CVS'    =>$cvs,
  );

  // 存在チェック
  if (!digitalchcek_is_exist($sid, $fuka, 'cv')) {
      print "9";
      exit;
  }

  // 要求レコードを更新する
  digitalchcek_save_response_parm($sid, 'success', serialize($param), $seq, $datetime);

  // 注文ステータス更新
  $comments  = "決済済み:".$cvs."\n"
             . "SID:".$sid."\n"
             . "通知番号:".$seq."\n"
             . "入金日:".$datetime;
  $status_id = MODULE_PAYMENT_DIGITALCHECK_CV_FINISH_PAYMENT_STATUS_ID;
  // 入金したときはデフォルトで処理中
  if ($status_id == 0)
    $status_id = DEFAULT_ORDERS_STATUS_ID;
  digitalchcek_save_status($sid, $status_id, $comments);

  print "0";
  exit;
?>
