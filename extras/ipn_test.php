<?php
/**
 * ipn_test.php Simulates a visit to paypal for testing purposes
 *
 * @package paymentMethod
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: ipn_test.php 3286 2006-03-28 01:14:04Z drbyte $
 */
if (!$_POST) {
  die('Illegal Access');
}
/**
 * reaquire application_top.php
 */
require('../includes/application_top.php');
?>
<strong>Paypal Testing System</strong>
<br />
Variables passed from ZC checkout<br /><br />
<?php
foreach ($_POST as $key=>$value) {
  if (strpos($key, 'return') !== false || strpos($key, 'notify_url') !== false) {
    echo '<font size="-1">' . $key . ' = ' . $value . '</font><br />' . "\n";
  }
}
?>
<table width="100%" cellpadding="2" cellspacing="2">
<? 
$count = 0;
echo '<tr>' . "\n";
foreach ($_POST as $key=>$value) {
  if (strpos($key, 'return') === false && strpos($key, 'notify_url') === false) {
    echo '<td width="33%"><font size="-1">' . $key . ' = ' . $value . '</font></td>' . "\n";
  }
  $count ++;
  if ($count == 3) {
    $count = 0;
    echo '</tr><tr>' . "\n";
  }
}
echo '</tr>' . "\n";
?>
</table>

<br /><br />
<form name = "ipn_test_return" method = "post" action = "ipn_test_return.php">
<?php
$process_button_string = zen_draw_hidden_field('business', $_POST['business']) .
zen_draw_hidden_field('cmd', $_POST['cmd']) .
zen_draw_hidden_field('return', $_POST['return']) .
zen_draw_hidden_field('cancel_return', $_POST['cancel_return']) .
zen_draw_hidden_field('notify_url', $_POST['notify_url']) .
zen_draw_hidden_field('rm', $_POST['rm']) .
zen_draw_hidden_field('currency_code', $_POST['currency_code']) .
zen_draw_hidden_field('bn', $_POST['bn']) .
zen_draw_hidden_field('mrb', $_POST['mrb']) .
zen_draw_hidden_field('pal', $_POST['pal']) .
zen_draw_hidden_field('cbt', $_POST['cbt']) .
zen_draw_hidden_field('image_url', $_POST['image_url']) .
zen_draw_hidden_field('page_style', $_POST['page_style']) .
zen_draw_hidden_field('item_name', $_POST['item_name']) .
zen_draw_hidden_field('item_number', $_POST['item_number']) .
zen_draw_hidden_field('lc', $_POST['lc']) .
zen_draw_hidden_field('amount', $_POST['amount']) .
zen_draw_hidden_field('shipping', $_POST['shipping']) .
zen_draw_hidden_field('custom', $_POST['custom']) .
zen_draw_hidden_field('upload', $_POST['upload']) .
zen_draw_hidden_field('redirect_cmd', $_POST['redirect_cmd']) .
zen_draw_hidden_field('first_name', $_POST['first_name']) .
zen_draw_hidden_field('last_name', $_POST['last_name']) .
zen_draw_hidden_field('address1', $_POST['address1']) .
zen_draw_hidden_field('city', $_POST['city']) .
zen_draw_hidden_field('state',$_POST['state']) .
zen_draw_hidden_field('zip', $_POST['zip']) .
zen_draw_hidden_field('country', $_POST['country']) .
zen_draw_hidden_field('email', $_POST['email']) .
zen_draw_hidden_field('night_phone_a',$_POST['night_phone_a']) .
zen_draw_hidden_field('night_phone_b',$_POST['night_phone_b']) .
zen_draw_hidden_field('night_phone_c',$_POST['night_phone_c']) .
zen_draw_hidden_field('day_phone_a',$_POST['day_phone_a']) .
zen_draw_hidden_field('day_phone_b',$_POST['day_phone_b']) .
zen_draw_hidden_field('day_phone_c',$_POST['day_phone_c']) .
zen_draw_hidden_field('paypal_order_id', $_POST['paypal_order_id'])
;
echo $process_button_string;
?>
<table width="100%">
<tr>
<td>Standard Paypal payment<input type = "radio" name = "paypal_type" value="standard" ></td>
<td>Payment - with following refund<input type = "radio" name = "paypal_type" value="refund" ></td>
</tr>
</table>
<br />
<input type="submit" name="submit" value="submit"><input type="submit" name="cancel" value="cancel">
<form>