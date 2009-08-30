<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//  $Id: whos_online.php 3261 2006-03-26 01:46:16Z ajeh $
//

// highlight bots
function zen_check_bot($checking) {
  // googlebot.com and google.com
  if (empty($checking)) {
    return true;
  } else {
    return false;
  }
}

// host for current ip
function zen_check_quantity($which) {
  global $db;
  $which_query = $db->Execute("select sesskey, value
                                   from " . TABLE_SESSIONS . "
                                   where sesskey= '" . $which . "'");


  $who_query = $db->Execute("select session_id, time_entry, time_last_click, host_address, user_agent
                                 from " . TABLE_WHOS_ONLINE . "
                                 where session_id='" . $which . "'");

  // longer than 2 minutes light color
  $xx_mins_ago_long = (time() - WHOIS_TIMER_INACTIVE);

  switch (true) {
    case ($which_query->RecordCount() == 0):
    if ($who_query->fields['time_last_click'] < $xx_mins_ago_long) {
      return zen_image(DIR_WS_IMAGES . 'icon_status_red_light.gif');
    } else {
      return zen_image(DIR_WS_IMAGES . 'icon_status_red.gif');
    }
    break;
    case (strstr($which_query->fields['value'],'"contents";a:0:')):
    if ($who_query->fields['time_last_click'] < $xx_mins_ago_long) {
      return zen_image(DIR_WS_IMAGES . 'icon_status_red_light.gif');
    } else {
      return zen_image(DIR_WS_IMAGES . 'icon_status_red.gif');
    }
    break;
    case (!strstr($which_query->fields['value'],'"contents";a:0:')):
    if ($who_query->fields['time_last_click'] < $xx_mins_ago_long) {
      return zen_image(DIR_WS_IMAGES . 'icon_status_yellow.gif');
    } else {
      return zen_image(DIR_WS_IMAGES . 'icon_status_green.gif');
    }
    break;
  }
}

// time since last click
function zen_check_minutes($the_time_last_click) {
  $the_seconds = (time() - $the_time_last_click);
  $the_time_since= gmdate('H:i:s', $the_seconds);
  return $the_time_since;
}

  require('includes/application_top.php');

  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();

  // same time_entry as time_last_click for 600 seconds = 10 minutes assumed to have left immediately
  $xx_mins_ago_dead = (time() - WHOIS_TIMER_DEAD);

  // remove after how many seconds? default= 1200 = 20 minutes
  $xx_mins_ago = (time() - WHOIS_TIMER_REMOVE);

// remove entries that have expired
  $db->Execute("delete from " . TABLE_WHOS_ONLINE . "
                where time_last_click < '" . $xx_mins_ago . "'
                or (time_entry=time_last_click
                and time_last_click < '" . $xx_mins_ago_dead . "')");
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<script language="javascript" src="includes/menu.js"></script>
<script language="javascript" src="includes/general.js"></script>
<script type="text/javascript">
  <!--
  function init()
  {
    cssjsmenu('navbar');
    if (document.getElementById)
    {
      var kill = document.getElementById('hoverJS');
      kill.disabled = true;
    }
  }
  // -->
</script>
</head>
<body onload="init()">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo zen_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
          <tr>
            <td class="smallText" colspan="2">
            <?php echo
              '<a href="' . zen_href_link(FILENAME_WHOS_ONLINE . '.php', zen_get_all_get_params()) . '" class="menuBoxContentLink">' .
  '<b><u>' . WHOS_ONLINE_REFRESH_LIST_TEXT . '</u></b>' . '</a>' .
  '&nbsp;&nbsp;' . WHOS_ONLINE_LEGEND_TEXT . '&nbsp;' .
  zen_image(DIR_WS_IMAGES . 'icon_status_green.gif') . '&nbsp;' . WHOS_ONLINE_ACTIVE_TEXT . '&nbsp;&nbsp;' .
  zen_image(DIR_WS_IMAGES . 'icon_status_yellow.gif') . '&nbsp;' . WHOS_ONLINE_INACTIVE_TEXT . '&nbsp;&nbsp;' .
  zen_image(DIR_WS_IMAGES . 'icon_status_red.gif') . '&nbsp;' . WHOS_ONLINE_ACTIVE_NO_CART_TEXT . '&nbsp;&nbsp;' .
  zen_image(DIR_WS_IMAGES . 'icon_status_red_light.gif') . '&nbsp;' . WHOS_ONLINE_INACTIVE_NO_CART_TEXT . '<br>' .
  WHOS_ONLINE_INACTIVE_LAST_CLICK_TEXT . '&nbsp;' . WHOIS_TIMER_INACTIVE . 's' .
  '&nbsp;||&nbsp;' . WHOS_ONLINE_INACTIVE_ARRIVAL_TEXT . '&nbsp;' .
  WHOIS_TIMER_DEAD . 's&nbsp;' . WHOS_ONLINE_REMOVED_TEXT;
            ?>
            </td>
          </tr>
          <tr>
            <td class="smallText" colspan="2">
<?php
          $listing= $_GET['listing'];
          switch ($listing) {
              case "full_name-desc":
              $order = "full_name DESC, LPAD(ip_address,11,'0')";
              break;
              case "full_name":
              $order = "full_name, LPAD(ip_address,11,'0')";
              break;
              case "ip_address":
              $order = "ip_address, session_id";
              break;
              case "ip_address-desc":
              $order = "ip_address DESC, session_id";
              break;
              case "time_last_click-desc":
              $order = "time_last_click DESC, LPAD(ip_address,11,'0')";
              break;
              case "time_last_click":
              $order = "time_last_click, LPAD(ip_address,11,'0')";
              break;
              case "time_entry-desc":
              $order = "time_entry DESC, LPAD(ip_address,11,'0')";
              break;
              case "time_entry":
              $order = "time_entry, LPAD(ip_address,11,'0')";
              break;
              case "last_page_url-desc":
              $order = "last_page_url DESC, LPAD(ip_address,11,'0')";
              break;
              case "last_page_url":
              $order = "last_page_url, LPAD(ip_address,11,'0')";
              break;
              case "session_id":
              $order = "session_id, ip_address";
              break;
              case "session_id-desc":
              $order = "session_id DESC, ip_address";
              break;
              default:
              $order = "time_entry, LPAD(ip_address,11,'0')";
          }

  $whos_online = $db->Execute("select customer_id, full_name, ip_address, time_entry, time_last_click,
                                      last_page_url, session_id, host_address, user_agent
                               from " . TABLE_WHOS_ONLINE . "
                               order by $order");

  $total_sess = $whos_online->RecordCount();
  echo sprintf(TEXT_NUMBER_OF_CUSTOMERS, $total_sess);
?>
            </td>
          </tr>
          <tr>
            <td colspan="2"><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRowWhois">
                <td class="dataTableHeadingContentWhois"><?php echo TABLE_HEADING_ONLINE; ?></td>
                <td class="dataTableHeadingContentWhois" align="center"><?php echo TABLE_HEADING_CUSTOMER_ID; ?></td>

                <td class="dataTableHeadingContentWhois" align="center">
                  <?php echo (($listing=='full_name-desc' or $listing=='full_name') ? '<span class="dataTableHeadingContentWhois">' . TABLE_HEADING_FULL_NAME . '</span>' : TABLE_HEADING_FULL_NAME); ?>&nbsp;
                  <br><a href="<?php echo "$PHP_SELF?listing=full_name"; ?>"><?php echo ($listing=='full_name' ? '<span class="dataTableHeadingContentWhois">' . 'Asc' . '</span>' : '<b>' . 'Asc' . '</b>'); ?></a>&nbsp;
                  &nbsp;<a href="<?php echo "$PHP_SELF?listing=full_name-desc"; ?>"><?php echo ($listing=='full_name-desc' ? '<span class="dataTableHeadingContentWhois">' . 'Desc' . '</span>' : '<b>' . 'Desc' . '</b>'); ?></a>&nbsp;
                </td>
                <td class="dataTableHeadingContentWhois" align="center">
                  <?php echo (($listing=='ip_address-desc' or $listing=='ip_address') ? '<span class="dataTableHeadingContentWhois">' . TABLE_HEADING_IP_ADDRESS . '</span>' : TABLE_HEADING_IP_ADDRESS); ?>&nbsp;
                  <br><a href="<?php echo "$PHP_SELF?listing=ip_address"; ?>"><?php echo ($listing=='ip_address' ? '<span class="dataTableHeadingContentWhois">' . 'Asc' . '</span>' : '<b>' . 'Asc' . '</b>'); ?></a>&nbsp;
                  &nbsp;<a href="<?php echo "$PHP_SELF?listing=ip_address-desc"; ?>"><?php echo ($listing=='ip_address-desc' ? '<span class="dataTableHeadingContentWhois">' . 'Desc' . '</span>' : '<b>' . 'Desc' . '</b>'); ?></a>&nbsp;
                </td>
                <td class="dataTableHeadingContentWhois" align="center">
                  <?php echo (($listing=='session_id-desc' or $listing=='session_id') ? '<span class="dataTableHeadingContentWhois">' . TABLE_HEADING_SESSION_ID . '</span>' : TABLE_HEADING_SESSION_ID); ?>&nbsp;
                  <br><a href="<?php echo "$PHP_SELF?listing=session_id"; ?>"><?php echo ($listing=='session_id' ? '<span class="dataTableHeadingContentWhois">' . 'Asc' . '</span>' : '<b>' . 'Asc' . '</b>'); ?></a>&nbsp;
                  &nbsp;<a href="<?php echo "$PHP_SELF?listing=session_id-desc"; ?>"><?php echo ($listing=='session_id-desc' ? '<span class="dataTableHeadingContentWhois">' . 'Desc' . '</span>' : '<b>' . 'Desc' . '</b>'); ?></a>&nbsp;
                </td>
                <td class="dataTableHeadingContentWhois" align="center">
                  <?php echo (($listing=='time_entry-desc' or $listing=='time_entry') ? '<span class="dataTableHeadingContentWhois">' . TABLE_HEADING_ENTRY_TIME . '</span>' : TABLE_HEADING_ENTRY_TIME); ?>&nbsp;
                  <br><a href="<?php echo "$PHP_SELF?listing=time_entry"; ?>"><?php echo ($listing=='time_entry' ? '<span class="dataTableHeadingContentWhois">' . 'Asc' . '</span>' : '<b>' . 'Asc' . '</b>'); ?></a>&nbsp;
                  &nbsp;<a href="<?php echo "$PHP_SELF?listing=time_entry-desc"; ?>"><?php echo ($listing=='time_entry-desc' ? '<span class="dataTableHeadingContentWhois">' . 'Desc' . '</span>' : '<b>' . 'Desc' . '</b>'); ?></a>&nbsp;
                </td>
                <td class="dataTableHeadingContentWhois" align="center">
                  <?php echo (($listing=='time_last_click-desc' or $listing=='time_last_click') ? '<span class="dataTableHeadingContentWhois">' . TABLE_HEADING_LAST_CLICK . '</span>' : TABLE_HEADING_LAST_CLICK); ?>&nbsp;
                  <br><a href="<?php echo "$PHP_SELF?listing=time_last_click"; ?>"><?php echo ($listing=='time_last_click' ? '<span class="dataTableHeadingContentWhois">' . 'Asc' . '</span>' : '<b>' . 'Asc' . '</b>'); ?></a>&nbsp;
                  &nbsp;<a href="<?php echo "$PHP_SELF?listing=time_last_click-desc"; ?>"><?php echo ($listing=='time_last_click-desc' ? '<span class="dataTableHeadingContentWhois">' . 'Desc' . '</span>' : '<b>' . 'Desc' . '</b>'); ?></a>&nbsp;
                </td>
                <td class="dataTableHeadingContentWhois" align="center">
                  <?php echo (($listing=='last_page_url-desc' or $listing=='last_page_url') ? '<span class="dataTableHeadingContentWhois">' . TABLE_HEADING_LAST_PAGE_URL . '</span>' : TABLE_HEADING_LAST_PAGE_URL); ?>&nbsp;
                  <br><a href="<?php echo "$PHP_SELF?listing=last_page_url"; ?>"><?php echo ($listing=='last_page_url' ? '<span class="dataTableHeadingContentWhois">' . 'Asc' . '</span>' : '<b>' . 'Asc' . '</b>'); ?></a>&nbsp;
                  &nbsp;<a href="<?php echo "$PHP_SELF?listing=last_page_url-desc"; ?>"><?php echo ($listing=='last_page_url-desc' ? '<span class="dataTableHeadingContentWhois">' . 'Desc' . '</span>' : '<b>' . 'Desc' . '</b>'); ?></a>&nbsp;
                </td>
              </tr>
<?php
  while (!$whos_online->EOF) {
    $time_online = (time() - $whos_online->fields['time_entry']);
    if ( ((!$_GET['info']) || (@$_GET['info'] == $whos_online->fields['session_id'])) && (!$info) ) {
      $info = $whos_online->fields['session_id'];
      $ip_address = $whos_online->fields['ip_address'];
      $full_name = $whos_online->fields['full_name'];
    }

    if ($old_array->fields['ip_address'] == $whos_online->fields['ip_address']) {
      $d++;
    }
    $is_a_bot=zen_check_bot($whos_online->fields['session_id']);
  if ($whos_online->fields['session_id'] == $info) {
      if ($is_a_bot==true) {
        echo '              <tr class="dataTableRowSelectedBot">' . "\n";
      } else {
        echo '              <tr class="dataTableRowSelectedWhois">' . "\n";
      }
  } else {
    if ($is_a_bot==true) {
        echo '              <tr class="dataTableRowBot" onmouseover="this.className=\'dataTableRowOverBot\';this.style.cursor=\'hand\'" onmouseout="this.className=\'dataTableRowBot\'" onclick="document.location.href=\'' . zen_href_link(FILENAME_WHOS_ONLINE, zen_get_all_get_params(array('info', 'action')) . 'info=' . $whos_online->fields['session_id'], 'NONSSL') . '\'">' . "\n";
      } else {
        echo '              <tr class="dataTableRowWhois" onmouseover="this.className=\'dataTableRowOverWhois\';this.style.cursor=\'hand\'" onmouseout="this.className=\'dataTableRowWhois\'" onclick="document.location.href=\'' . zen_href_link(FILENAME_WHOS_ONLINE, zen_get_all_get_params(array('info', 'action')) . 'info=' . $whos_online->fields['session_id'], 'NONSSL') . '\'">' . "\n";
      }
  }
?>
                <td class="dataTableContentWhois"><?php echo zen_check_quantity($whos_online->fields['session_id']) . '&nbsp;' . gmdate('H:i:s', $time_online); ?></td>
                <td class="dataTableContentWhois" align="center">
                  <?php
                    if ($whos_online->fields['customer_id'] != 0) {
                      echo '<a href="' . zen_href_link(FILENAME_CUSTOMERS, zen_get_all_get_params(array('cID', 'action')) . 'cID=' . $whos_online->fields['customer_id'] . '&action=edit', 'NONSSL') . '"><u>' . $whos_online->fields['customer_id'] . '</u></a>';
                    } else {
                      echo $whos_online->fields['customer_id'];
                    }
                  ?>
                </td>
                <td class="dataTableContentWhois" nowrap="nowrap">
                  <?php
                    if ($whos_online->fields['customer_id'] != 0) {
                      echo '<a href="' . zen_href_link(FILENAME_ORDERS, 'cID=' . $whos_online->fields['customer_id'], 'NONSSL') . '">' . '<u>' . $whos_online->fields['full_name'] . '</u></a>';
                    } else {
                      echo $whos_online->fields['full_name'];
                    }
                  ?>
                </td>
                <td class="dataTableContentWhois" align="left"><a href="http://www.dnsstuff.com/tools/whois.ch?ip=<?php echo $whos_online->fields['ip_address']; ?>" target="new"><?php echo '<u>' . $whos_online->fields['ip_address'] . '</u>'; ?></a></td>
                <td class="dataTableContentWhois"><?php echo date('H:i:s', $whos_online->fields['time_entry']); ?></td>
                <td class="dataTableContentWhois" align="center"><?php echo date('H:i:s', $whos_online->fields['time_last_click']); ?></td>
                <td class="dataTableContentWhois" colspan="2">&nbsp;</td>
              </tr>
<?php
  // show host name
  if (WHOIS_SHOW_HOST=='1') {
    if ($whos_online->fields['session_id'] == $info) {
    if ($is_a_bot==true) {
        echo '              <tr class="dataTableRowSelectedBot">' . "\n";
      } else {
        echo '              <tr class="dataTableRowSelectedWhois">' . "\n";
      }
    } else {
      if ($is_a_bot==true) {
        echo '              <tr class="dataTableRowBot" onmouseover="this.className=\'dataTableRowOverBot\';this.style.cursor=\'hand\'" onmouseout="this.className=\'dataTableRowBot\'" onclick="document.location.href=\'' . zen_href_link(FILENAME_WHOS_ONLINE, zen_get_all_get_params(array('info', 'action')) . 'info=' . $whos_online->fields['session_id'], 'NONSSL') . '\'">' . "\n";
      } else {
        echo '              <tr class="dataTableRowWhois" onmouseover="this.className=\'dataTableRowOverWhois\';this.style.cursor=\'hand\'" onmouseout="this.className=\'dataTableRowWhois\'" onclick="document.location.href=\'' . zen_href_link(FILENAME_WHOS_ONLINE, zen_get_all_get_params(array('info', 'action')) . 'info=' . $whos_online->fields['session_id'], 'NONSSL') . '\'">' . "\n";
      }
  }
?>
                <td class="dataTableContentWhois" colspan=3 valign="top">&nbsp;&nbsp;<?php echo TIME_PASSED_LAST_CLICKED . '<br />&nbsp;&nbsp;&nbsp;&nbsp;' . zen_check_minutes($whos_online->fields['time_last_click']); ?> ago</td>
                <td class="dataTableContentWhois" colspan=5 valign="top">
                  <?php
                    echo TEXT_SESSION_ID . $whos_online->fields['session_id'] . '<br />' .
                    TEXT_HOST . $whos_online->fields['host_address'] . '<br />' .
                    TEXT_USER_AGENT . $whos_online->fields['user_agent'] . '<br />';
                    if (eregi('^(.*)' . zen_session_name() . '=[a-f,0-9]+[&]*(.*)', $whos_online->fields['last_page_url'], $array)) {
                      echo $array[1] . $array[2];
                    } else {
                      echo "<a href='" . $whos_online->fields['last_page_url'] . "' target=new>" . '<u>' . $whos_online->fields['last_page_url'] . '</u>' . "</a>";
                    }
                  ?>
                </td>

              </tr>
<?php
  } // show host
?>
              <tr>
               <td colspan="8"><?php echo zen_draw_separator('pixel_trans.gif', '1', '3'); ?></td>
              </tr>

<?php
  $old_array = $whos_online;
  $whos_online->MoveNext();
  }
  if (!$d) {
    $d=0;
  }
  $total_dupes = $d;
  $total_sess = $whos_online->RecordCount();
  $total_cust = $total_sess - $total_dupes;
?>
              <tr>
                <td colspan="8"><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
              </tr>
<?php
// repeat legend when whois >=
  if ($whos_online->RecordCount() >= WHOIS_REPEAT_LEGEND_BOTTOM) {
?>
              <tr>
                <td class="smallText" colspan="8">Legend: <?php echo zen_image(DIR_WS_IMAGES . 'icon_status_green.gif') . " Active cart &nbsp;&nbsp;" . zen_image(DIR_WS_IMAGES . 'icon_status_yellow.gif') . " Inactive cart &nbsp;&nbsp;" . zen_image(DIR_WS_IMAGES . 'icon_status_red.gif') . " Active no cart &nbsp;&nbsp;" .  zen_image(DIR_WS_IMAGES . 'icon_status_red_light.gif') . " Inactive no cart " . "<br>Inactive is Last Click >= " . WHOIS_TIMER_INACTIVE . "s" . " &nbsp; || Inactive since arrival > " . WHOIS_TIMER_DEAD . "s will be removed";?></td>
              </tr>
<?php
  }
?>
              <tr>
                <td class="smallText" colspan="8"><?php echo sprintf(TEXT_NUMBER_OF_CUSTOMERS, $total_sess); print "<br>Duplicate IP Addresses: $total_dupes<br>Total Unique Users: $total_cust.";?></td>
              </tr>
            </table></td>
<?php
  $heading = array();
  $contents = array();
  if ($info) {
    $heading[] = array('text' => '<b>' . TABLE_HEADING_SHOPPING_CART . '</b>');

    if (STORE_SESSIONS == 'db') {
      $session_data = $db->Execute("select value from " . TABLE_SESSIONS . "
                                    WHERE sesskey = '" . $info . "'");

      $session_data = trim($session_data->fields['value']);
    } else {
      if ( (file_exists(zen_session_save_path() . '/sess_' . $info)) && (filesize(zen_session_save_path() . '/sess_' . $info) > 0) ) {
        $session_data = file(zen_session_save_path() . '/sess_' . $info);
        $session_data = trim(implode('', $session_data));
      }
    }

    if ($length = strlen($session_data)) {
      if (PHP_VERSION < 4) {
        $start_id = strpos($session_data, 'customer_id[==]s');
        $start_cart = strpos($session_data, 'cart[==]o');
        $start_currency = strpos($session_data, 'currency[==]s');
        $start_country = strpos($session_data, 'customer_country_id[==]s');
        $start_zone = strpos($session_data, 'customer_zone_id[==]s');
      } else {
        $start_id = strpos($session_data, 'customer_id|s');
        $start_cart = strpos($session_data, 'cart|O');
        $start_currency = strpos($session_data, 'currency|s');
        $start_country = strpos($session_data, 'customer_country_id|s');
        $start_zone = strpos($session_data, 'customer_zone_id|s');
      }

      for ($i=$start_cart; $i<$length; $i++) {
        if ($session_data[$i] == '{') {
          if (isset($tag)) {
            $tag++;
          } else {
            $tag = 1;
          }
        } elseif ($session_data[$i] == '}') {
          $tag--;
        } elseif ( (isset($tag)) && ($tag < 1) ) {
          break;
        }
      }

      $session_data_id = substr($session_data, $start_id, (strpos($session_data, ';', $start_id) - $start_id + 1));
// fix nnobo bug
      $session_data_cart = substr($session_data, $start_cart, $i - $start_cart);
      $session_data_currency = substr($session_data, $start_currency, (strpos($session_data, ';', $start_currency) - $start_currency + 1));
      $session_data_country = substr($session_data, $start_country, (strpos($session_data, ';', $start_country) - $start_country + 1));
      $session_data_zone = substr($session_data, $start_zone, (strpos($session_data, ';', $start_zone) - $start_zone + 1));

      session_decode($session_data_id);
      session_decode($session_data_currency);
      session_decode($session_data_country);
      session_decode($session_data_zone);
      session_decode($session_data_cart);

      if (PHP_VERSION < 4) {
        $broken_cart = $cart;
        $cart = new shoppingCart;
        $cart->unserialize($broken_cart);
      }

      if (is_object($_SESSION['cart'])) {
        $contents[] = array('text' => $full_name . ' - ' . $ip_address . '<br />' . $info);
        $products = $_SESSION['cart']->get_products();
        for ($i = 0, $n = sizeof($products); $i < $n; $i++) {
          $contents[] = array('text' => $products[$i]['quantity'] . ' x ' . '<a href="' . zen_href_link(FILENAME_CATEGORIES, 'cPath=' . zen_get_product_path($products[$i]['id']) . '&pID=' . $products[$i]['id']) . '">' . $products[$i]['name'] . '</a>');
// cPath=23&pID=74
        }

        if (sizeof($products) > 0) {
          $contents[] = array('text' => zen_draw_separator('pixel_black.gif', '100%', '1'));
          $contents[] = array('align' => 'right', 'text'  => TEXT_SHOPPING_CART_SUBTOTAL . ' ' . $currencies->format($_SESSION['cart']->show_total(), true, $_SESSION['currency']));
        } else {
          $contents[] = array('text' => TEXT_EMPTY_CART);
        }
      }
    }
  }

  if ( (zen_not_null($heading)) && (zen_not_null($contents)) ) {
    echo '            <td width="25%" valign="top">' . "\n";

    $box = new box;
    echo $box->infoBox($heading, $contents);

    echo '            </td>' . "\n";
  }
?>
          </tr>
        </table></td>
      </tr>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>