<?php
/**
 * jscript_googleanalytics.php
 *
 * @package zen-cart addon module google analytics
 * @author saito
 * @copyright Copyright 2010 saito dev.zen-cart.jp
 * @copyright Copyright (C) 2009 Liquid System Technology, Inc.
 * @copyright Copyright 2004-2008 Andrew Berezin eCommerce-Service.com
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: jscript_googleanalytics.php $
 * based on tpl_footer_googleanalytics.php, v 2.2.1 01.09.2008 01:23 Andrew Berezin
 */

  // start google analytics
if (defined('MODULE_GOOGLE_ANALYTICS_ACCOUNT') && MODULE_GOOGLE_ANALYTICS_ACCOUNT != '') {
  // google analytics account
  $ga_account = MODULE_GOOGLE_ANALYTICS_ACCOUNT;

  // prepare orders data
  if ($_GET['main_page'] == FILENAME_CHECKOUT_SUCCESS) {
    global $db;
    // see includes/modules/pages/checkout_success/header_php.php
    $orders_query = "select orders_id from " . TABLE_ORDERS . "
                     where customers_id = :customersid
                     order by date_purchased desc limit 1";
    $orders_query = $db->bindvars($orders_query, ':customersid', $_SESSION['customer_id'], 'integer');
    $orders = $db->execute($orders_query);
    $orders_id = $orders->fields['orders_id'];
    // get order info
    require_once(DIR_WS_CLASSES . 'order.php');
    $order = new order($orders_id);
    switch(MODULE_GOOGLE_ANALYTICS_TARGET) {
    case 'delivery':
      $ga_order = $order->delivery;
      break;
    case 'billing':
      $ga_order = $order->billing;
      break;
    case 'customers':
    default:
      $ga_order = $order->customer;
      break;
    }
    // get total tax shipping
    $ga_order['total'] = number_format(zen_round($order->info['total'], $currencies[$order->info['currency']]['decimal_places']), $currencies[$order->info['currency']]['decimal_places'], $currencies[$order->info['currency']]['decimal_point'], '');
    $ga_order['tax'] = number_format(zen_round($order->info['tax'], $currencies[$order->info['currency']]['decimal_places']), $currencies[$order->info['currency']]['decimal_places'], $currencies[$order->info['currency']]['decimal_point'], '');
    $orders_total_query = "select value from " . TABLE_ORDERS_TOTAL . "
                           where orders_id = :ordersid
                           and class = 'ot_shipping'";
    $orders_total_query = $db->bindvars($orders_total_query, ':ordersid', $orders_id, 'integer');
    $orders_total = $db->execute($orders_total_query);
    $ga_order['shippingcost'] = number_format(zen_round($orders_total->fields['value'], $currencies[$order->info['currency']]['decimal_places']), $currencies[$order->info['currency']]['decimal_places'], $currencies[$order->info['currency']]['decimal_point'], '');

    $ga_order['affiliation'] = MODULE_GOOGLE_ANALYTICS_AFFILIATION;

    // get products data
    $ga_products = array();
    for ($i = 0; $i < sizeof($order->products); $i++) {
      $ga_products[$i]['categories_name'] = zen_get_categories_name_from_product(zen_get_prid($order->products[$i]['id']));
      if (MODULE_GOOGLE_ANALYTICS_SKU_OR_CODE == 'products_model') {
        $ga_products[$i]['skucode'] = $order->products[$i]['model'];
      } else {
        $ga_products[$i]['skucode'] = $order->products[$i]['id'];
      }
      $ga_products[$i]['final_price'] = number_format(zen_round($order->products[$i]['final_price'], $currencies[$order->info['currency']]['decimal_places']), $currencies[$order->info['currency']]['decimal_places'], $currencies[$order->info['currency']]['decimal_point'], '');
      $ga_products[$i]['qty'] = $order->products[$i]['qty'];
      // get product name and attributes_name
      $ga_products[$i]['name'] = $order->products[$i]['name'];
      if (isset($order->products[$i]['attributes'])) {
        $products_attributes = array();
        for ($j = 0; $j < sizeof($order->products[$i]['attributes']); $j++) {
          $products_attributes[$j] = $order->products[$i]['attributes'][$j]['option'] . ': ' . $order->products[$i]['attributes'][$j]['value'];
        }
        $attributes = substr(MODULE_GOOGLE_ANALYTICS_BRACKETS, 0, 1) . implode(MODULE_GOOGLE_ANALYTICS_DELIMITER, $products_attributes) . substr(MODULE_GOOGLE_ANALYTICS_BRACKETS, -1, 1);
        $ga_products[$i]['name'] = $ga_products[$i]['name'] . $attributes;
	$ga_products[$i]['skucode'] = $ga_products[$i]['skucode'] . $attributes;
      } // end of products attributes
    } // end of products data
  } // end of orders data
?>
<script type="text/javascript">
<!--
  // xGetElementById r2, Copyright 2001-2007 Michael Foster (Cross-Browser.com)
  // Part of X, a Cross-Browser Javascript Library, Distributed under the terms of the GNU LGPL
  function xGetElementById(e)
  {
    if (typeof(e) == 'string') {
      if (document.getElementById) e = document.getElementById(e);
       else if (document.all) e = document.all[e];
       else e = null;
    }
    return e;
  }
  // xAddEventListener r8, Copyright 2001-2007 Michael Foster (Cross-Browser.com)
  // Part of X, a Cross-Browser Javascript Library, Distributed under the terms of the GNU LGPL
  function xAddEventListener(e,eT,eL,cap)
  {
    if(!(e=xGetElementById(e)))return;
    eT=eT.toLowerCase();
    if(e.addEventListener)e.addEventListener(eT,eL,cap||false);
    else if(e.attachEvent)e.attachEvent('on'+eT,eL);
    else {
      var o=e['on'+eT];
      e['on'+eT]=typeof o=='function' ? function(v){o(v);eL(v);} : eL;
    }
  }
  // xGetElementsByTagName r5, Copyright 2002-2007 Michael Foster (Cross-Browser.com)
  // Part of X, a Cross-Browser Javascript Library, Distributed under the terms of the GNU LGPL
  function xGetElementsByTagName(t,p)
  {
    var list = null;
    t = t || '*';
    p = xGetElementById(p) || document;
    if (typeof p.getElementsByTagName != 'undefined') { // DOM1
      list = p.getElementsByTagName(t);
      if (t=='*' && (!list || !list.length)) list = p.all; // IE5 '*' bug
    }
    else { // IE4 object model
      if (t=='*') list = p.all;
      else if (p.all && p.all.tags) list = p.all.tags(t);
    }
    return list || [];
  }

   var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '<?php echo $ga_account; ?>']);
  <?php
    if (MODULE_GOOGLE_ANALYTICS_PAGENAME):
  ?>
  if (xGetElementsByTagName('title')[0] != undefined) {
    _gaq.push(['_trackPageview', "'" + xGetElementsByTagName('title')[0].innerHTML + "'"]);
  } else {
    _gaq.push(['_trackPageview']);
  }
  <?php
    else:
  ?>
    _gaq.push(['_trackPageview']);
  <?php
    endif; // end of pagename
  ?>
  <?php
    if (isset($orders_id)): // start transaction
  ?>
    _gaq.push(['_addTrans',
               '<?php echo $orders_id; ?>',                // order ID - required
               '<?php echo zen_output_string_protected($ga_order["affiliation"]); ?>',  // affiliation or store name
               '<?php echo $ga_order["total"]; ?>',        // total - required
               '<?php echo $ga_order["tax"]; ?>',          // tax
               '<?php echo $ga_order["shippingcost"]; ?>', // shipping
               '<?php echo zen_output_string_protected($ga_order["city"]); ?>',         // city
               '<?php echo zen_output_string_protected($ga_order["state"]); ?>',        // state or province
               '<?php echo zen_output_string_protected($ga_order["country"]); ?>'       // country
              ]);
  <?php
      if (isset($ga_products)): // start add items
        for ($i = 0; $i < sizeof($ga_products); $i++):
  ?>
    _gaq.push(['_addItem',
               '<?php echo $orders_id; ?>',                      // order ID - required
               '<?php echo $ga_products[$i]["skucode"]; ?>',     // SKU/code - required
               '<?php echo $ga_products[$i]["name"]; ?>',        // product name
               '<?php echo $ga_products[$i]["categories_name"]; ?>',  //category or variation
               '<?php echo $ga_products[$i]["final_price"]; ?>', // unit price - required
               '<?php echo $ga_products[$i]["qty"]; ?>'          // quantity - required
              ]);
  <?php
        endfor;
      endif; // end of add items
  ?>
    _gaq.push(['_trackTrans']);
  <?php
    endif; // end of transaction
  ?>
  <?php
  // for external links
    if (MODULE_GOOGLE_ANALYTICS_OUTBOUND == 'true'):
  ?>
  /**
   * googleanalytics_outgoing.js
   *
   * @package zen-cart analytics
   * @copyright Copyright 2004-2008 Andrew Berezin eCommerce-Service.com
   * @copyright Copyright 2007 http://designformasters.info/posts/google-analytics-advanced-use/
   * @copyright Portions Copyright 2003-2008 Zen Cart Development Team
   * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
   * @version $Id: tpl_footer_googleanalytics.php, v 2.2 19.08.2008 15:03 Andrew Berezin $
   */
  function googleanalytics_isLinkExternal(link) {
    var r = new RegExp('^https?://(?:www.)?'
      + location.host.replace(/^www./, ''));
    return !r.test(link);
  }

  // add event external linking
  function addEventExternalLink() {
    var anchors;
    anchors = xGetElementsByTagName('a');
    var i = 0;
    var length = anchors.length;
    for (i = 0; i < length; i++) {
      href = anchors[i].href;
      if (googleanalytics_isLinkExternal(href)) {
	var link = <?php echo MODULE_GOOGLE_ANALYTICS_OUTBOUND_LINKS_PREFIX; ?> + href.replace(/:\/\//, '/').replace('/~mailto:/', 'mailto/');
        xAddEventListener(anchors[i], 'click', function() {_gaq.push(['_trackPageview', link]);}, false);
      }
    }
  }
  // add events onload
  xAddEventListener(window, 'load', addEventExternalLink, false);
  <?php
    endif; // end of external link
  ?>
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
//-->
</script>
<?php
} // end of google analytics
?>
<?php
  // start google adwords conversion
if ($_GET['main_page'] == FILENAME_CHECKOUT_SUCCESS && MODULE_GOOGLE_ANALYTICS_USE_ADWORDS_CONVERSION == 'true' && MODULE_GOOGLE_ANALYTICS_ADWORDS_CONVERSION_ID != '' && isset($order->info['total'])):
  global $request_type;
  if (isset($request_type) && $request_type == 'SSL') {
    $scheme = 'https';
  } else {
    $scheme = 'http';
  }
  $conversion_id = MODULE_GOOGLE_ANALYTICS_ADWORDS_CONVERSION_ID;
  $conversion_lang = MODULE_GOOGLE_ANALYTICS_ADWORDS_CONVERSION_LANGUAGE;
  if ($order->info['total'] > 0) {
    $conversion_value = $order->info['total'];
  } else {
    $conversion_value = 1;
  }
?>
<script type="text/javascript">
<!--
  var google_conversion_id = <?php echo $conversion_id; ?>;
  var google_conversion_language = "<?php echo $conversion_lang; ?>";
  var google_conversion_format = "1";
  var google_conversion_color = "FFFFFF";
  var google_conversion_value = <?php echo $conversion_value; ?>;
  var google_conversion_label = "purchase";
//-->
</script>
<script type="text/javascript" src="<?php echo $scheme; ?>://www.googleadservices.com/pagead/conversion.js"></script>
<?php
endif; // end of conversion
?>