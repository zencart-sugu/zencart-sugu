<?php
/**
 * zen_smartphone modules functions.php
 *
 * @package functions
 * @copyright Copyright 2009 Liquid System Technology, Inc.
 * @author Koji Sasaki
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: functions.php $
 */

// functions_customers.php の zen_customer_greeting より、zen_smartphoneに特化したものを再定義
// 全体に関係するので。
function zen_customer_greeting_for_smartphone() {

  if (isset($_SESSION['customer_id']) && $_SESSION['customer_first_name']) {
    $greeting_string = sprintf(TEXT_GREETING_FOR_SMARTPHONE_PERSONAL, zen_href_link(FILENAME_ACCOUNT), zen_output_string_protected($_SESSION['customer_first_name']), zen_href_link(FILENAME_LOGOFF));
  } else {
    $greeting_string = sprintf(TEXT_GREETING_FOR_SMARTPHONE_GUEST, zen_href_link(FILENAME_LOGIN, '', 'SSL'), zen_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL'));
  }

  return $greeting_string;
}

/*
 *  Output a form for jqtouch
 *  zen_draw_formと異なる部分は、下記の部分です
 *    actionのURLに #xxxxxxxxxx を付ける
 *    hiddenで jqt_anchor_id をセットする
 *    hiddenで tmpl=jqt をセットする
 */
function zen_draw_form_for_jqtouch($name, $action, $method = 'post', $parameters = '') {
  $anchor = md5($action);
  
  $form = '<form name="' . zen_output_string($name) . '" action="' . zen_output_string($action) . '#'. $anchor . '" method="' . zen_output_string($method) . '"';

  if (zen_not_null($parameters)) $form .= ' ' . $parameters;

  $form .= '>';
  
  $form .= zen_draw_hidden_field('tmpl', 'jqt');
  $form .= zen_draw_hidden_field('jqt_anchor_id', $anchor);

  return $form;
}

?>