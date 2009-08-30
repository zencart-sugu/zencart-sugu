<?php
/**
 * @package orderTotal
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: ot_coupon.php 3694 2006-06-03 02:17:36Z ajeh $
 */

  class ot_coupon {
    var $title, $output;

    function ot_coupon() {

      $this->code = 'ot_coupon';
      $this->header = MODULE_ORDER_TOTAL_COUPON_HEADER;
      $this->title = MODULE_ORDER_TOTAL_COUPON_TITLE;
      $this->description = MODULE_ORDER_TOTAL_COUPON_DESCRIPTION;
      $this->user_prompt = '';
      $this->sort_order = MODULE_ORDER_TOTAL_COUPON_SORT_ORDER;
      $this->include_shipping = MODULE_ORDER_TOTAL_COUPON_INC_SHIPPING;
      $this->include_tax = MODULE_ORDER_TOTAL_COUPON_INC_TAX;
      $this->calculate_tax = MODULE_ORDER_TOTAL_COUPON_CALC_TAX;
      $this->tax_class  = MODULE_ORDER_TOTAL_COUPON_TAX_CLASS;
      $this->credit_class = true;
      $this->output = array();

    }

  function process() {
    global $order, $currencies, $db;
    $od_amount = $this->calculate_deductions($this->get_order_total());
    $this->deduction = $od_amount['total'];
    if ($od_amount['total'] > 0) {
      while (list($key, $value) = each($order->info['tax_groups'])) {
        $tax_rate = zen_get_tax_rate_from_desc($key);
        if ($od_amount[$key]) {
          $order->info['tax_groups'][$key] -= $od_amount[$key];
          $order->info['total'] -=  $od_amount[$key];
        }
      }
      if ($od_amount['type'] == 'S') $order->info['shipping_cost'] = 0;
      $sql = "select coupon_code from " . TABLE_COUPONS . " where coupon_id = '" . $_SESSION['cc_id'] . "'";
      $zq_coupon_code = $db->Execute($sql);
      $this->coupon_code = $zq_coupon_code->fields['coupon_code'];
      $order->info['total'] = $order->info['total'] - $od_amount['total'];

      $this->output[] = array('title' => $this->title . ': ' . '<a href="javascript:couponpopupWindow(\'' . zen_href_link(FILENAME_POPUP_COUPON_HELP, 'cID=' . $_SESSION['cc_id']) . '\')">' . $this->coupon_code . '</a> :',
                              'text' => '-' . $currencies->format($od_amount['total']),
                              'value' => $od_amount['total']);
    }
  }

  function selection_test() {
    return false;
  }

  function clear_posts() {
    unset($_SESSION['cc_id']);
  }


  function pre_confirmation_check($order_total) {
    global $order;
    if ($this->include_shipping == 'false') $order_total -= $order->info['shipping_cost'];
    if ($this->include_tax == 'false') $order_total -= $order->info['tax'];
    $od_amount = $this->calculate_deductions($order_total);
    return $od_amount['total'] + $od_amount['tax'];
//    return $od_amount['total'];
  }

  function use_credit_amount() {
    return false;
  }


  function credit_selection() {
    global $discount_coupon;
    global $db;
    // note the placement of the redeem code can be moved within the array on the instructions or the title
    $selection = array('id' => $this->code,
                       'module' => $this->title,
                       'redeem_instructions' => MODULE_ORDER_TOTAL_COUPON_REDEEM_INSTRUCTIONS . ($discount_coupon->fields['coupon_code'] != '' ? MODULE_ORDER_TOTAL_COUPON_REMOVE_INSTRUCTIONS : ''),
                       'fields' => array(array('title' => ($discount_coupon->fields['coupon_code'] != '' ? MODULE_ORDER_TOTAL_COUPON_TEXT_CURRENT_CODE . '<a href="javascript:couponpopupWindow(\'' . zen_href_link(FILENAME_POPUP_COUPON_HELP, 'cID=' . $_SESSION['cc_id']) . '\')">' . $discount_coupon->fields['coupon_code'] . '</a><br />' : '') . MODULE_ORDER_TOTAL_COUPON_TEXT_ENTER_CODE,
                                               'field' => zen_draw_input_field('dc_redeem_code', '', 'id="disc-'.$this->code.'" onchange="submitFunction(0,0)"'),
                                               'tag' => 'disc-'.$this->code
		               )));
    return $selection;
  }


  function collect_posts() {
    global $db, $currencies, $messageStack;

// remove discount coupon by request
    if (isset($_POST['dc_redeem_code']) && strtoupper($_POST['dc_redeem_code']) == 'REMOVE') {
      unset($_POST['dc_redeem_code']);
      unset($_SESSION['cc_id']);
      $messageStack->add_session('checkout_payment', TEXT_REMOVE_REDEEM_COUPON, 'caution');
    }

    if ($_POST['dc_redeem_code']) {

      $sql = "select coupon_id, coupon_amount, coupon_type, coupon_minimum_order, uses_per_coupon, uses_per_user, restrict_to_products, restrict_to_categories from " . TABLE_COUPONS . " where coupon_code= :couponCodeEntered and coupon_active='Y'";
      $sql = $db->bindVars($sql, ':couponCodeEntered', $_POST['dc_redeem_code'], 'string'); 
      $coupon_result=$db->Execute($sql);

      if ($coupon_result->fields['coupon_type'] != 'G') {

        if ($coupon_result->RecordCount() <1 ) {

          zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, 'credit_class_error_code=' . $this->code . '&credit_class_error=' . urlencode(TEXT_INVALID_REDEEM_COUPON), 'SSL',true, false));
        }
        if ($this->get_order_total() < $coupon_result->fields['coupon_minimum_order']) {
          zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, 'credit_class_error_code=' . $this->code . '&credit_class_error=' . urlencode(sprintf(TEXT_INVALID_REDEEM_COUPON_MINIMUM, $currencies->format($coupon_result->fields['coupon_minimum_order']))), 'SSL',true, false));          
        }

        // JTD - added missing code here to handle coupon product restrictions
        // look through the items in the cart to see if this coupon is valid for any item in the cart
        $products = $_SESSION['cart']->get_products();
        $foundvalid = false;
        for ($i=0; $i<sizeof($products); $i++) {
//$messageStack->add_session('header','START COUPON collect: ' . ' product: ' . $products[$i]['id'] . ' coupon: ' . $coupon_result->fields['coupon_id'], 'success');
          if (is_product_valid($products[$i]['id'], $coupon_result->fields['coupon_id'])) {
            $foundvalid = true;
            continue;
          }
        }
        if (!$foundvalid) zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, 'credit_class_error_code=' . $this->code . '&credit_class_error=' . urlencode(TEXT_INVALID_COUPON_PRODUCT), 'SSL',true, false));
       // JTD - end of additions of missing code to handle coupon product restrictions

        $date_query=$db->Execute("select coupon_start_date from " . TABLE_COUPONS . "
                                  where coupon_start_date <= now() and
                                  coupon_code='".$_POST['dc_redeem_code']."'");

        if ($date_query->RecordCount() < 1 ) {
          zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, 'credit_class_error_code=' . $this->code . '&credit_class_error=' . urlencode(TEXT_INVALID_STARTDATE_COUPON), 'SSL', true, false));
        }

        $date_query=$db->Execute("select coupon_expire_date from " . TABLE_COUPONS . "
                                  where coupon_expire_date >= now() and
                                  coupon_code='".$_POST['dc_redeem_code']."'");

        if ($date_query->RecordCount() < 1 ) {
          zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, 'credit_class_error_code=' . $this->code . '&credit_class_error=' . urlencode(TEXT_INVALID_FINISDATE_COUPON), 'SSL', true, false));
        }

        $coupon_count = $db->Execute("select coupon_id from " . TABLE_COUPON_REDEEM_TRACK . "
                                      where coupon_id = '" . $coupon_result->fields['coupon_id']."'");

        $coupon_count_customer = $db->Execute("select coupon_id from " . TABLE_COUPON_REDEEM_TRACK . "
                                               where coupon_id = '" . $coupon_result->fields['coupon_id']."' and
                                               customer_id = '" . $_SESSION['customer_id'] . "'");

        if ($coupon_count->RecordCount() >= $coupon_result->fields['uses_per_coupon'] && $coupon_result->fields['uses_per_coupon'] > 0) {
          zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, 'credit_class_error_code=' . $this->code . '&credit_class_error=' . urlencode(TEXT_INVALID_USES_COUPON . $coupon_result->fields['uses_per_coupon'] . TIMES ), 'SSL', true, false));
        }

        if ($coupon_count_customer->RecordCount() >= $coupon_result->fields['uses_per_user'] && $coupon_result->fields['uses_per_user'] > 0) {
          zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, 'credit_class_error_code=' . $this->code . '&credit_class_error=' . urlencode(sprintf(TEXT_INVALID_USES_USER_COUPON, $_POST['dc_redeem_code']) . $coupon_result->fields['uses_per_user'] . ($coupon_result->fields['uses_per_user'] == 1 ? TIME : TIMES) ), 'SSL', true,false));
        }

        if ($coupon_result->fields['coupon_type']=='S') {
          $coupon_amount = $order->info['shipping_cost'];
        } else {
          $coupon_amount = $currencies->format($coupon_result->fields['coupon_amount']) . ' ';
        }
        $_SESSION['cc_id'] = $coupon_result->fields['coupon_id'];
      }
//      if ($_POST['submit_redeem_coupon_x'] && !$_POST['gv_redeem_code']) zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, 'credit_class_error_code=' . $this->code . '&credit_class_error=' . urlencode(TEST_NO_REDEEM_CODE), 'SSL', true, false));
     $messageStack->add_session('checkout', TEXT_VALID_COUPON,'success');
    }
  }


function update_credit_account($i) {
  return false;
 }

 function apply_credit() {
   global $db, $insert_id;
   $cc_id = $_SESSION['cc_id'];
   if ($this->deduction !=0) {
     $db->Execute("insert into " . TABLE_COUPON_REDEEM_TRACK . "
                   (coupon_id, redeem_date, redeem_ip, customer_id, order_id)
                   values ('" . $cc_id . "', now(), '" . $_SERVER['REMOTE_ADDR'] . "', '" . $_SESSION['customer_id'] . "', '" . $insert_id . "')");
   }
   $_SESSION['cc_id'] = "";
 }

  function calculate_deductions($order_total) {
    global $db, $order, $messageStack;
    $tax_address = zen_get_tax_locations();
    $od_amount = array();
    if ($_SESSION['cc_id']) {
      $coupon = $db->Execute("select * from " . TABLE_COUPONS . " where coupon_id = '" . $_SESSION['cc_id'] . "'");
      if (($coupon->RecordCount() > 0 && $order_total !=0) || ($coupon->RecordCount() > 0 && $coupon->fields['coupon_type']=='S') ) {
        if ($coupon->fields['coupon_minimum_order'] <= $order_total) {
          if ($coupon->fields['coupon_type']=='S') {
            $od_amount['total'] = $order->info['shipping_cost'];
            $od_amount['type'] = 'S';
          } else {
            if ($coupon->fields['coupon_type'] == 'P') {
              $od_amount['total'] = zen_round($order_total*($coupon->fields['coupon_amount']/100), 2);
            } else {
              $od_amount['total'] = $coupon->fields['coupon_amount'] * ($order_total>0);
            }
            if ($od_amount['total']>$order_total) $od_amount['total'] = $order_total;
            $products = $_SESSION['cart']->get_products();
            for ($i=0; $i<sizeof($products); $i++) {
              // speed up process and store value
              $is_valid_results = is_product_valid($products[$i]['id'], $_SESSION['cc_id']);
              if ($is_valid_results) {
                if ($coupon->fields['coupon_type'] == 'P') {
                  switch ($this->calculate_tax) {
                    case 'Credit Note':
                      $tax_rate = zen_get_tax_rate($this->tax_class, $tax_address['country_id'], $tax_address['zone_id']);
                      $tax_desc = zen_get_tax_description($this->tax_class, $tax_address['country_id'], $tax_address['zone_id']);
                      $od_amount[$tax_desc] = $od_amount['total'] / 100 * $tax_rate;
                      $od_amount['tax'] += $od_amount[$tax_desc];
                    break;
                    case 'Standard':
                      $ratio = $od_amount['total']/$this->get_order_total();
                      $products = $_SESSION['cart']->get_products();
                      for ($j=0; $j<sizeof($products); $j++) {
                        $t_prid = zen_get_prid($products[$j]['id']);
                        $cc_result = $db->Execute("select products_tax_class_id
                                                   from " . TABLE_PRODUCTS . " where products_id = '" . $t_prid . "'");

                        if ($is_valid_results) {
                          $tax_rate = zen_get_tax_rate($cc_result->fields['products_tax_class_id'], $tax_address['country_id'], $tax_address['zone_id']);
                          $tax_desc = zen_get_tax_description($cc_result->fields['products_tax_class_id'], $tax_address['country_id'], $tax_address['zone_id']);
                          if ($tax_rate > 0) {
//                            $od_amount[$tax_desc] += (($products[$j]['final_price'] * $products[$j]['quantity']) * $tax_rate)/100 * $ratio;
                            $od_amount[$tax_desc] += round(((($products[$j]['final_price'] * $products[$j]['quantity']) * $tax_rate) + .5)/100 * $ratio, 2);
                            $od_amount['tax'] += $od_amount[$tax_desc];
                          }
                        }
                      }
                    break;
                    default:
                  }
                }
                if ($coupon->fields['coupon_type'] == 'F') {
                  switch ($this->calculate_tax) {
                    case 'Credit Note':
                      $tax_rate = zen_get_tax_rate($this->tax_class, $tax_address['country_id'], $tax_address['zone_id']);
                      $tax_desc = zen_get_tax_description($this->tax_class, $tax_address['country_id'], $tax_address['zone_id']);
                      $od_amount[$tax_desc] = $od_amount['total'] / 100 * $tax_rate;
                      $od_amount['tax'] += $od_amount[$tax_desc];
                    break;
                    case 'Standard':
                      $ratio = $od_amount['total']/$this->get_order_total();
                      $products = $_SESSION['cart']->get_products();
                      for ($j=0; $j<sizeof($products); $j++) {
                        $t_prid = zen_get_prid($products[$j]['id']);
                        $cc_result = $db->Execute("select products_tax_class_id
                                                   from " . TABLE_PRODUCTS . " where products_id = '" . $t_prid . "'");

                        if ($is_valid_results) {
                          $tax_rate = zen_get_tax_rate($cc_result->fields['products_tax_class_id'], $tax_address['country_id'], $tax_address['zone_id']);
                          $tax_desc = zen_get_tax_description($cc_result->fields['products_tax_class_id'], $tax_address['country_id'], $tax_address['zone_id']);
                          if ($tax_rate > 0) {
//                            $od_amount[$tax_desc] += (($products[$j]['final_price'] * $products[$j]['quantity']) * $tax_rate)/100 * $ratio;
                            $od_amount[$tax_desc] += round(((($products[$j]['final_price'] * $products[$j]['quantity']) * $tax_rate) + .5)/100 * $ratio, 2);
                            $od_amount['tax'] += $od_amount[$tax_desc];
                          }
                        }
                      }
                    break;
                    default:
                  }
                }
              }
            }
          }
        }
      }
    }
    return $od_amount;
  }

  function get_order_total() {
    global  $order;
    $products = $_SESSION['cart']->get_products();
    $order_total = 0;
    for ($i=0; $i<sizeof($products); $i++) {
      if (is_product_valid($products[$i]['id'], $_SESSION['cc_id'])) {
        $order_total += $products[$i]['final_price'] * $products[$i]['quantity'];
	      if ($this->include_tax == 'true') {
          $products_tax = zen_get_tax_rate($products[$i]['tax_class_id']);
          $order_total += (zen_calculate_tax($products[$i]['final_price'], $products_tax))   * $products[$i]['quantity'];
	      }
      }
    }
    if ($this->include_shipping == 'true') $order_total += $order->info['shipping_cost'];
    return $order_total;
  }

  function get_product_price($product_id) {
    global $db, $order;
    $products_id = zen_get_prid($product_id);
 // products price
    $qty = $_SESSION['cart']->contents[$product_id]['qty'];
    $product = $db->Execute("select products_id, products_price, products_tax_class_id, products_weight
                             from " . TABLE_PRODUCTS . " where products_id='" . $products_id . "'");

    if ($product->RecordCount() > 0) {
      $prid = $product->fields['products_id'];
      $products_tax = zen_get_tax_rate($product->fields['products_tax_class_id']);
      $products_price = $product->fields['products_price'];
      $specials = $db->Execute("select specials_new_products_price
                                from " . TABLE_SPECIALS . " where products_id = '" . $prid . "' and status = '1'");

      if ($specials->RecordCount() > 0 ) {
        $products_price = $specials->fields['specials_new_products_price'];
      }
      if ($this->include_tax == 'true') {
        $total_price += ($products_price + zen_calculate_tax($products_price, $products_tax)) * $qty;
      } else {
        $total_price += $products_price * $qty;
      }

// attributes price
      if (isset($_SESSION['cart']->contents[$product_id]['attributes'])) {
        reset($_SESSION['cart']->contents[$product_id]['attributes']);
        while (list($option, $value) = each($_SESSION['cart']->contents[$product_id]['attributes'])) {
          $attribute_price = $db->Execute("select options_values_price, price_prefix
                                           from " . TABLE_PRODUCTS_ATTRIBUTES . "
                                           where products_id = '" . $prid . "'
                                           and options_id = '" . $option . "'
                                           and options_values_id = '" . $value . "'");

          if ($attribute_price->fields['price_prefix'] == '-') {
            if ($this->include_tax == 'true') {
              $total_price -= $qty * ($attribute_price->fields['options_values_price'] + zen_calculate_tax($attribute_price->fields['options_values_price'], $products_tax));
            } else {
              $total_price -= $qty * ($attribute_price->fields['options_values_price']);
            }
          } else {
            if ($this->include_tax == 'true') {
              $total_price += $qty * ($attribute_price->fields['options_values_price'] + zen_calculate_tax($attribute_price->fields['options_values_price'], $products_tax));
            } else {
              $total_price += $qty * ($attribute_price->fields['options_values_price']);
            }
          }
        }
      }
    }
    return $total_price;
  }

    function check() {
      global $db;
      if (!isset($this->check)) {
        $check_query = $db->Execute("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_ORDER_TOTAL_COUPON_STATUS'");
        $this->check = $check_query->RecordCount();
      }

      return $this->check;
    }

    function keys() {
      return array('MODULE_ORDER_TOTAL_COUPON_STATUS', 'MODULE_ORDER_TOTAL_COUPON_SORT_ORDER', 'MODULE_ORDER_TOTAL_COUPON_INC_SHIPPING', 'MODULE_ORDER_TOTAL_COUPON_INC_TAX', 'MODULE_ORDER_TOTAL_COUPON_CALC_TAX', 'MODULE_ORDER_TOTAL_COUPON_TAX_CLASS');
    }

    function install() {
      global $db;
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('インストール状態', 'MODULE_ORDER_TOTAL_COUPON_STATUS', 'true', '', '6', '1','zen_cfg_select_option(array(\'true\'), ', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('表示の整列順', 'MODULE_ORDER_TOTAL_COUPON_SORT_ORDER', '280', '表示の整列順を設定できます. 数字が小さいほど上位に表示されます。', '6', '2', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function ,date_added) values ('送料を含める', 'MODULE_ORDER_TOTAL_COUPON_INC_SHIPPING', 'true', '送料を計算に含めますか？', '6', '5', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function ,date_added) values ('税金を含める', 'MODULE_ORDER_TOTAL_COUPON_INC_TAX', 'false', '税金を計算に含めますか？', '6', '6','zen_cfg_select_option(array(\'true\', \'false\'), ', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function ,date_added) values ('税金の再計算', 'MODULE_ORDER_TOTAL_COUPON_CALC_TAX', 'Standard', '税金を再計算しますか？', '6', '7','zen_cfg_select_option(array(\'None\', \'Standard\', \'Credit Note\'), ', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('税種別', 'MODULE_ORDER_TOTAL_COUPON_TAX_CLASS', '0', 'クーポン券に適用される税種別', '6', '0', 'zen_get_tax_class_title', 'zen_cfg_pull_down_tax_classes(', now())");
    }

    function remove() {
      global $db;
      $keys = '';
      $keys_array = $this->keys();
      for ($i=0; $i<sizeof($keys_array); $i++) {
        $keys .= "'" . $keys_array[$i] . "',";
      }
      $keys = substr($keys, 0, -1);

      $db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key in (" . $keys . ")");
    }
  }
?>
