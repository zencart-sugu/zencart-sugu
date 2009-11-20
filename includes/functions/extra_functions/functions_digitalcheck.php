<?php
/**
 * functions_digitalcheck.php
 *
 * @package functions
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: functions_lookups.php 2774 2006-01-03 03:07:08Z ajeh $
 */

// sidとfuka情報による存在チェック
// おもにデジタルチェックからの呼び出し時に使用する
function digitalchcek_is_exist($sid, $fuka, $type="") {
  global $db;

  // 存在チェック
  $sql = "select
            *
          from ".
            TABLE_DIGITALCHECK_TRANSACTIONS."
          where
            sids='".(int)$sid."'
            and fuka='".zen_db_input($fuka)."'";
  if ($type != "")
    $sql .= " and type='".zen_db_input($type)."'";
  $result = $db->Execute($sql);
  if ($result->EOF)
    return false;
  else
    return true;
}

function digitalchcek_get_response($sid, $fuka, $type="") {
  global $db;

  // 存在チェック
  $sql = "select
            response
          from ".
            TABLE_DIGITALCHECK_TRANSACTIONS."
          where
            sids='".(int)$sid."'
            and fuka='".zen_db_input($fuka)."'";
  if ($type != "")
    $sql .= " and type='".zen_db_input($type)."'";
  $result = $db->Execute($sql);
  if ($result->EOF)
    return null;
  else
    return $result->fields['response'];
}

// sidによる注文ID取得
function digitalchcek_get_orders_id($sid) {
  global $db;

  $sql = "select
            orders_id
          from ".
            TABLE_DIGITALCHECK_TRANSACTIONS."
          where
            sids='".(int)$sid."'";
  $result = $db->Execute($sql);
  if ($result->EOF)
    return false;
  else
    return $result->fields['orders_id'];
}

// sidの新規取得
function digitalchcek_get_new_sid() {
  global $db;

  // 過去の不必要なsidの削除
  $today = time()-86400;
  $today = date('Y-m-d H:i:s', $today);
  $sql   = "delete
            from ".
              TABLE_DIGITALCHECK_TRANSACTIONS."
            where
              orders_id=0
              and created_at<='".$today."'";
  $db->Execute($sql);

  // sidは毎回作成する
  // sidと金額をデジタルチェック側でつなげているようで
  // 一度リクエストを出してしまうと金額を変更できない
  // 無駄なデータが生成されてしまうがしょうがないかな？

  // 取引コードの取得
  $sql_data_array = array(
    'created_at'=>'now()'
  );
  zen_db_perform(TABLE_DIGITALCHECK_TRANSACTIONS, $sql_data_array);
  return $db->Insert_ID();
}

// fuka情報の取得
function digitalchcek_get_fuka() {
  return md5(uniqid(rand(), true));
}

// 要求レコードの保存
function digitalchcek_save_request_parm($sid, $type, $request, $fuka) {
  global $db;

  $sql_data_array = array(
    'customers_id' => $_SESSION['customer_id'], // 顧客ID
    'type'         => $type,                    // 決済方法
    'status'       => 'wait',                   // 処理待ち
    'request'      => $request,                 // リクエスト
    'fuka'         => $fuka,                    // 付加情報
  );
  zen_db_perform(TABLE_DIGITALCHECK_TRANSACTIONS, $sql_data_array, "update", "sids=".(int)$sid);
}

// 注文IDの更新
function digitalchcek_save_orders_id($sid, $orders_id) {
  global $db;

  $sql_data_array = array(
    'orders_id' =>$orders_id, // 注文ID
  );
  zen_db_perform(TABLE_DIGITALCHECK_TRANSACTIONS, $sql_data_array, "update", "sids=".(int)$sid);
}

// 返信レコードの保存
function digitalchcek_save_response_parm($sid, $status, $response, $seq, $datetime) {
  global $db;

  $sql_data_array = array(
    'status'           =>$status,   // 成功
    'response'         =>$response, // 通知情報
    'finish_payment_id'=>$seq,      // 取引コード
    'finish_payment_at'=>$datetime  // 決済完了日時
  );
  zen_db_perform(TABLE_DIGITALCHECK_TRANSACTIONS, $sql_data_array, "update", "sids=".(int)$sid);
}

// 注文ステータス更新
function digitalchcek_save_status($sid, $status_id, $comments) {
  global $db;

  $orders_id = digitalchcek_get_orders_id($sid);
  $sql_data_array = array(
    'orders_id'        =>$orders_id, // 注文ID
    'orders_status_id' =>$status_id, // ステータス
    'date_added'       =>'now()',    // ヒストリー追加日時
    'customer_notified'=>0,          // 通知なし
    'comments'         =>$comments,  // コメント
  );
  zen_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array);

  $sql_data_array = array(
    'orders_status' =>$status_id,     // ステータス
  );
  zen_db_perform(TABLE_ORDERS, $sql_data_array, "update", "orders_id=".$orders_id);
}

// 注文ステータス更新
function digitalchcek_http_build_query($param) {
  $ret = "";
  foreach ($param as $key=>$value) {
    if ($ret != "")
      $ret .= '&';
    $ret .= $key."=".htmlspecialchars($value);
  }
  return $ret;
}

// 氏名変換
function digitalcheck_name_convert($name) {
  return mb_convert_kana($name, "RNASKHV");
}

// カナ変換
function digitalcheck_kana_convert($kana) {
  $check = "アイウエオカキクケコサシスセソタチツテトナニヌネノハヒフヘホマミムメモヤユヨラリルレロワヲンガギグゲゴザジズゼゾダヂヅデドパピプペポバビブベボッァィゥェォャュョヮー";
  $ret   = "";
  $kana  = mb_convert_kana($kana, "CKV");
  for ($i=0; $i<mb_strlen($kana); $i++) {
    if (mb_strpos($check, mb_substr($kana, $i, 1)) !== false)
      $ret .= mb_substr($kana, $i, 1);
  }
  return $ret;
}

// 郵便番号変換
function digitalcheck_zip_convert($tel) {
  $ret = "";
  $tel = mb_convert_kana($tel, "n"); // 全角数字->半角数字
  for ($i=0; $i<strlen($tel); $i++) {
    $c = substr($tel, $i, 1);
    if ($c>="0" && $c<="9")
      $ret .= $c;
  }
  return substr($ret, 0, 3);
}

// 電話番号変換
function digitalcheck_tel_convert($tel) {
  $ret = "";
  $tel = mb_convert_kana($tel, "n"); // 全角数字->半角数字
  for ($i=0; $i<strlen($tel); $i++) {
    $c = substr($tel, $i, 1);
    if ($c>="0" && $c<="9")
      $ret .= $c;
  }
  return $ret;
}

// 状態取得
function digitalchcek_get_status($sid, $fuka, $type="") {
  global $db;

  // 存在チェック
  $sql = "select
            status
          from ".
            TABLE_DIGITALCHECK_TRANSACTIONS."
          where
            sids='".(int)$sid."'
            and fuka='".zen_db_input($fuka)."'";
  if ($type != "")
    $sql .= " and type='".zen_db_input($type)."'";
  $result = $db->Execute($sql);
  if ($result->EOF)
    return null;
  else
    return $result->fields['status'];
}

// 顧客ID取得
function digitalchcek_get_customers_id($sid, $fuka, $type="") {
  global $db;

  // 存在チェック
  $sql = "select
            customers_id
          from ".
            TABLE_DIGITALCHECK_TRANSACTIONS."
          where
            sids='".(int)$sid."'
            and fuka='".zen_db_input($fuka)."'";
  if ($type != "")
    $sql .= " and type='".zen_db_input($type)."'";
  $result = $db->Execute($sql);
  if ($result->EOF)
    return null;
  else
    return $result->fields['customers_id'];
}
?>
