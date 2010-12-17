<?php
/**
 * Customers Point Rate
 *
 * @package point
 * @copyright Portions Copyright (C) 2008 Zen Cart.JP
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: customers_pointrate.php $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();

  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  $error = false;
  $processed = false;

  if (zen_not_null($action)) {
    switch ($action) {
      case 'update_rate':
        $customers_id = zen_db_prepare_input($_POST['customers_id']);
        $rate = zen_db_prepare_input($_POST['rate']);

        for ($i = 0, $n = count($customers_id); $i < $n; $i++ ) {
          $GLOBALS['point_customersrate']->deletePointRate($customers_id[$i]);
          if ($rate[$i] != '') {
            $GLOBALS['point_customersrate']->insertPointRate($customers_id[$i], $rate[$i]);
          }
        }
        $messageStack->add_session(SUCCESS_CUSTOMERS_POINTRATE_UPDATED, 'success');
        zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('module', 'action')) . 'module=point_customersrate', 'NONSSL'));
        break;

      default:
        // ->furikana
        if (FURIKANA_NESESSARY)
          $customers = $db->Execute("select c.customers_id, c.customers_gender, c.customers_firstname,
                                            c.customers_lastname, c.customers_dob, c.customers_email_address,
                                            c.customers_firstname_kana, c.customers_lastname_kana,
                                            a.entry_company, a.entry_street_address, a.entry_suburb,
                                            a.entry_postcode, a.entry_city, a.entry_state, a.entry_zone_id,
                                            a.entry_country_id, a.entry_telephone, a.entry_fax,
                                            c.customers_newsletter, c.customers_default_address_id,
                                            c.customers_email_format, c.customers_group_pricing,
                                            c.customers_authorization, c.customers_referral
                                    from " . TABLE_CUSTOMERS . " c left join " . TABLE_ADDRESS_BOOK . " a
                                    on c.customers_default_address_id = a.address_book_id
                                    where a.customers_id = c.customers_id
                                    and c.customers_id = '" . (int)$_GET['cID'] . "'");
        else
          $customers = $db->Execute("select c.customers_id, c.customers_gender, c.customers_firstname,
                                            c.customers_lastname, c.customers_dob, c.customers_email_address,
                                            a.entry_company, a.entry_street_address, a.entry_suburb,
                                            a.entry_postcode, a.entry_city, a.entry_state, a.entry_zone_id,
                                            a.entry_country_id, a.entry_telephone, a.entry_fax,
                                            c.customers_newsletter, c.customers_default_address_id,
                                            c.customers_email_format, c.customers_group_pricing,
                                            c.customers_authorization, c.customers_referral
                                    from " . TABLE_CUSTOMERS . " c left join " . TABLE_ADDRESS_BOOK . " a
                                    on c.customers_default_address_id = a.address_book_id
                                    where a.customers_id = c.customers_id
                                    and c.customers_id = '" . (int)$_GET['cID'] . "'");
        // <-furikana

        $cInfo = new objectInfo($customers->fields);
        break;
    }
  }
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
          <tr><?php echo zen_draw_form('search', FILENAME_ADDON_MODULES_ADMIN, 'module=point_customersrate', 'get', '', true); ?>
            <?php echo zen_draw_hidden_field('module', 'point_customersrate'); ?>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo zen_draw_separator('pixel_trans.gif', 1, HEADING_IMAGE_HEIGHT); ?></td>
            <td class="smallText" align="right">
<?php
// show reset search
    if (isset($_GET['search']) && zen_not_null($_GET['search'])) {
      echo '<a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=point_customersrate', 'NONSSL') . '">' . zen_image_button('button_reset.gif', IMAGE_RESET) . '</a>&nbsp;&nbsp;';
    }
    echo HEADING_TITLE_SEARCH_DETAIL . ' ' . zen_draw_input_field('search') . zen_hide_session_id();
    if (isset($_GET['search']) && zen_not_null($_GET['search'])) {
      $keywords = zen_db_input(zen_db_prepare_input($_GET['search']));
      echo '<br/ >' . TEXT_INFO_SEARCH_DETAIL_FILTER . $keywords;
    }
?>
            </td>
          </form></tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo zen_draw_form('update_rate', FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('module', 'action')) . 'module=point_customersrate&action=update_rate', 'post'); ?><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
<?php
// Sort Listing
          switch ($_GET['list_order']) {
              case "id-asc":
              $disp_order = "ci.customers_info_date_account_created";
              break;
              case "firstname":
              $disp_order = "c.customers_firstname";
              break;
              case "firstname-desc":
              $disp_order = "c.customers_firstname DESC";
              break;
              case "group-asc":
              $disp_order = "c.customers_group_pricing";
              break;
              case "group-desc":
              $disp_order = "c.customers_group_pricing DESC";
              break;
              case "lastname":
              $disp_order = "c.customers_lastname, c.customers_firstname";
              break;
              case "lastname-desc":
              $disp_order = "c.customers_lastname DESC, c.customers_firstname";
              break;
              case "company":
              $disp_order = "a.entry_company";
              break;
              case "company-desc":
              $disp_order = "a.entry_company DESC";
              break;
              case "login-asc":
              $disp_order = "ci.customers_info_date_of_last_logon";
              break;
              case "login-desc":
              $disp_order = "ci.customers_info_date_of_last_logon DESC";
              break;
              case "approval-asc":
              $disp_order = "c.customers_authorization";
              break;
              case "approval-desc":
              $disp_order = "c.customers_authorization DESC";
              break;
              default:
              $disp_order = "ci.customers_info_date_account_created DESC";
          }
?>
             <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent" align="center" valign="top">
                  <?php echo TABLE_HEADING_ID; ?>
                </td>
                <td class="dataTableHeadingContent" align="left">
                  <?php echo (($_GET['list_order']=='firstname' or $_GET['list_order']=='firstname-desc') ? '<span class="SortOrderHeader">' . TABLE_HEADING_FIRSTNAME . '</span>' : TABLE_HEADING_FIRSTNAME); ?><br>
                  <a href="<?php echo zen_href_link(basename($PHP_SELF) . '?list_order=firstname', '', 'NONSSL'); ?>"><?php echo ($_GET['list_order']=='firstname' ? '<span class="SortOrderHeader">Asc</span>' : '<span class="SortOrderHeaderLink">Asc</b>'); ?></a>&nbsp;
                  <a href="<?php echo zen_href_link(basename($PHP_SELF) . '?list_order=firstname-desc', '', 'NONSSL'); ?>"><?php echo ($_GET['list_order']=='firstname-desc' ? '<span class="SortOrderHeader">Desc</span>' : '<span class="SortOrderHeaderLink">Desc</span>'); ?></a>
                </td>
                <td class="dataTableHeadingContent" align="left">
                  <?php echo (($_GET['list_order']=='lastname' or $_GET['list_order']=='lastname-desc') ? '<span class="SortOrderHeader">' . TABLE_HEADING_LASTNAME . '</span>' : TABLE_HEADING_LASTNAME); ?><br>
                  <a href="<?php echo zen_href_link(basename($PHP_SELF) . '?list_order=lastname', '', 'NONSSL'); ?>"><?php echo ($_GET['list_order']=='lastname' ? '<span class="SortOrderHeader">Asc</span>' : '<span class="SortOrderHeaderLink">Asc</b>'); ?></a>&nbsp;
                  <a href="<?php echo zen_href_link(basename($PHP_SELF) . '?list_order=lastname-desc', '', 'NONSSL'); ?>"><?php echo ($_GET['list_order']=='lastname-desc' ? '<span class="SortOrderHeader">Desc</span>' : '<span class="SortOrderHeaderLink">Desc</b>'); ?></a>
                </td>
                <td class="dataTableHeadingContent" align="left">
                  <?php echo (($_GET['list_order']=='company' or $_GET['list_order']=='company-desc') ? '<span class="SortOrderHeader">' . TABLE_HEADING_COMPANY . '</span>' : TABLE_HEADING_COMPANY); ?><br>
                  <a href="<?php echo zen_href_link(basename($PHP_SELF) . '?list_order=company', '', 'NONSSL'); ?>"><?php echo ($_GET['list_order']=='company' ? '<span class="SortOrderHeader">Asc</span>' : '<span class="SortOrderHeaderLink">Asc</b>'); ?></a>&nbsp;
                  <a href="<?php echo zen_href_link(basename($PHP_SELF) . '?list_order=company-desc', '', 'NONSSL'); ?>"><?php echo ($_GET['list_order']=='company-desc' ? '<span class="SortOrderHeader">Desc</span>' : '<span class="SortOrderHeaderLink">Desc</b>'); ?></a>
                </td>
                <td class="dataTableHeadingContent" align="left">
                  <?php echo (($_GET['list_order']=='id-asc' or $_GET['list_order']=='id-desc') ? '<span class="SortOrderHeader">' . TABLE_HEADING_ACCOUNT_CREATED . '</span>' : TABLE_HEADING_ACCOUNT_CREATED); ?><br>
                  <a href="<?php echo zen_href_link(basename($PHP_SELF) . '?list_order=id-asc', '', 'NONSSL'); ?>"><?php echo ($_GET['list_order']=='id-asc' ? '<span class="SortOrderHeader">Asc</span>' : '<span class="SortOrderHeaderLink">Asc</b>'); ?></a>&nbsp;
                  <a href="<?php echo zen_href_link(basename($PHP_SELF) . '?list_order=id-desc', '', 'NONSSL'); ?>"><?php echo ($_GET['list_order']=='id-desc' ? '<span class="SortOrderHeader">Desc</span>' : '<span class="SortOrderHeaderLink">Desc</b>'); ?></a>
                </td>

                <td class="dataTableHeadingContent" align="left">
                  <?php echo (($_GET['list_order']=='login-asc' or $_GET['list_order']=='login-desc') ? '<span class="SortOrderHeader">' . TABLE_HEADING_LOGIN . '</span>' : TABLE_HEADING_LOGIN); ?><br>
                  <a href="<?php echo zen_href_link(basename($PHP_SELF) . '?list_order=login-asc', '', 'NONSSL'); ?>"><?php echo ($_GET['list_order']=='login-asc' ? '<span class="SortOrderHeader">Asc</span>' : '<span class="SortOrderHeaderLink">Asc</b>'); ?></a>&nbsp;
                  <a href="<?php echo zen_href_link(basename($PHP_SELF) . '?list_order=login-desc', '', 'NONSSL'); ?>"><?php echo ($_GET['list_order']=='login-desc' ? '<span class="SortOrderHeader">Desc</span>' : '<span class="SortOrderHeaderLink">Desc</b>'); ?></a>
                </td>

                <td class="dataTableHeadingContent" align="left">
                  <?php echo (($_GET['list_order']=='group-asc' or $_GET['list_order']=='group-desc') ? '<span class="SortOrderHeader">' . TABLE_HEADING_PRICING_GROUP . '</span>' : TABLE_HEADING_PRICING_GROUP); ?><br>
                  <a href="<?php echo zen_href_link(basename($PHP_SELF) . '?list_order=group-asc', '', 'NONSSL'); ?>"><?php echo ($_GET['list_order']=='group-asc' ? '<span class="SortOrderHeader">Asc</span>' : '<span class="SortOrderHeaderLink">Asc</b>'); ?></a>&nbsp;
                  <a href="<?php echo zen_href_link(basename($PHP_SELF) . '?list_order=group-desc', '', 'NONSSL'); ?>"><?php echo ($_GET['list_order']=='group-desc' ? '<span class="SortOrderHeader">Desc</span>' : '<span class="SortOrderHeaderLink">Desc</b>'); ?></a>
                </td>

                <td class="dataTableHeadingContent" align="center">
                  <?php echo (($_GET['list_order']=='approval-asc' or $_GET['list_order']=='approval-desc') ? '<span class="SortOrderHeader">' . TABLE_HEADING_AUTHORIZATION_APPROVAL . '</span>' : TABLE_HEADING_AUTHORIZATION_APPROVAL); ?><br>
                  <a href="<?php echo zen_href_link(basename($PHP_SELF) . '?list_order=approval-asc', '', 'NONSSL'); ?>"><?php echo ($_GET['list_order']=='approval-asc' ? '<span class="SortOrderHeader">Asc</span>' : '<span class="SortOrderHeaderLink">Asc</b>'); ?></a>&nbsp;
                  <a href="<?php echo zen_href_link(basename($PHP_SELF) . '?list_order=approval-desc', '', 'NONSSL'); ?>"><?php echo ($_GET['list_order']=='approval-desc' ? '<span class="SortOrderHeader">Desc</span>' : '<span class="SortOrderHeaderLink">Desc</b>'); ?></a>
                </td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_POINTRATE; ?>&nbsp;</td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
    $search = '';
    if (isset($_GET['search']) && zen_not_null($_GET['search'])) {
      $keywords = zen_db_input(zen_db_prepare_input($_GET['search']));
//      $search = "where c.customers_lastname like '%" . $keywords . "%' or c.customers_firstname like '%" . $keywords . "%' or c.customers_email_address like '%" . $keywords . "%'";
      $search = "where c.customers_lastname like '%" . $keywords . "%' or c.customers_firstname like '%" . $keywords . "%' or c.customers_email_address like '%" . $keywords . "%' or a.entry_telephone rlike '" . $keywords . "' or a.entry_company rlike '" . $keywords . "' or a.entry_street_address rlike '" . $keywords . "' or a.entry_city rlike '" . $keywords . "' or a.entry_postcode rlike '" . $keywords . "'";
      // ->furikana
      if (FURIKANA_NESESSARY)
        $search .= " or c.customers_firstname_kana like '%" . $keywords . "%' or c.customers_lastname_kana like '%" . $keywords . "%' or a.entry_firstname_kana like '%" . $keywords . "%' or a.entry_lastname_kana like '%" . $keywords . "%'";
      // <-furikana
     }
    $new_fields=', a.entry_telephone, a.entry_company, a.entry_street_address, a.entry_city, a.entry_postcode, c.customers_authorization, cpr.rate';
    $customers_query_raw = "select c.customers_id, c.customers_lastname, c.customers_firstname, c.customers_email_address, c.customers_group_pricing, a.entry_country_id, a.entry_company, ci.customers_info_date_of_last_logon, ci.customers_info_date_account_created " . $new_fields . " from " . TABLE_CUSTOMERS . " c left join " . TABLE_CUSTOMERS_INFO . " ci on c.customers_id= ci.customers_info_id left join " . TABLE_ADDRESS_BOOK . " a on c.customers_id = a.customers_id and c.customers_default_address_id = a.address_book_id left join " . TABLE_CUSTOMERS_POINT_RATE . " cpr on c.customers_id= cpr.customers_id " . $search . " order by $disp_order";

// Split Page
// reset page when page is unknown
$count_by_page = MAX_DISPLAY_SEARCH_RESULTS_CUSTOMER;
if ($count_by_page < 1)
  $count_by_page = 20;
if (($_GET['page'] == '' or $_GET['page'] == '1') and $_GET['cID'] != '') {
  $check_page = $db->Execute($customers_query_raw);
  $check_count=1;
  if ($check_page->RecordCount() > $count_by_page) {
    while (!$check_page->EOF) {
      if ($check_page->fields['customers_id'] == $_GET['cID']) {
        break;
      }
      $check_count++;
      $check_page->MoveNext();
    }
    $_GET['page'] = round((($check_count/$count_by_page)+(fmod_round($check_count,$count_by_page) !=0 ? .5 : 0)),0);
  } else {
    $_GET['page'] = 1;
  }
}

    $customers_split = new splitPageResults($_GET['page'], $count_by_page, $customers_query_raw, $customers_query_numrows);
    $customers = $db->Execute($customers_query_raw);
    while (!$customers->EOF) {
      $info = $db->Execute("select customers_info_date_account_created as date_account_created,
                                   customers_info_date_account_last_modified as date_account_last_modified,
                                   customers_info_date_of_last_logon as date_last_logon,
                                   customers_info_number_of_logons as number_of_logons
                            from " . TABLE_CUSTOMERS_INFO . "
                            where customers_info_id = '" . $customers->fields['customers_id'] . "'");

      if ((!isset($_GET['cID']) || (isset($_GET['cID']) && ($_GET['cID'] == $customers->fields['customers_id']))) && !isset($cInfo)) {
        $country = $db->Execute("select countries_name
                                 from " . TABLE_COUNTRIES . "
                                 where countries_id = '" . (int)$customers->fields['entry_country_id'] . "'");

        $reviews = $db->Execute("select count(*) as number_of_reviews
                                 from " . TABLE_REVIEWS . " where customers_id = '" . (int)$customers->fields['customers_id'] . "'");

        $customer_info = array_merge($country->fields, $info->fields, $reviews->fields);

        $cInfo_array = array_merge($customers->fields, $customer_info);
        $cInfo = new objectInfo($cInfo_array);
      }

        $group_query = $db->Execute("select group_name, group_percentage from " . TABLE_GROUP_PRICING . " where
                                     group_id = '" . $customers->fields['customers_group_pricing'] . "'");

        if ($group_query->RecordCount() < 1) {
          $group_name_entry = TEXT_NONE;
        } else {
          $group_name_entry = $group_query->fields['group_name'];
        }

      if (isset($cInfo) && is_object($cInfo) && ($customers->fields['customers_id'] == $cInfo->customers_id)) {
        echo '          <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)">' . "\n";
      } else {
        echo '          <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">' . "\n";
      }
?>
                <td class="dataTableContent" align="right"><?php echo $customers->fields['customers_id']; ?></td>
                <td class="dataTableContent"><?php echo $customers->fields['customers_firstname']; ?></td>
                <td class="dataTableContent"><?php echo $customers->fields['customers_lastname']; ?></td>
                <td class="dataTableContent"><?php echo $customers->fields['entry_company']; ?></td>
                <td class="dataTableContent"><?php echo zen_date_short($info->fields['date_account_created']); ?></td>
                <td class="dataTableContent"><?php echo zen_date_short($customers->fields['customers_info_date_of_last_logon']); ?></td>
                <td class="dataTableContent"><?php echo $group_name_entry; ?></td>
                <td class="dataTableContent" align="center"><?php echo ($customers->fields['customers_authorization'] == 0 ? zen_image(DIR_WS_IMAGES . 'icon_green_on.gif', IMAGE_ICON_STATUS_ON) : zen_image(DIR_WS_IMAGES . 'icon_red_on.gif', IMAGE_ICON_STATUS_OFF)); ?></td>
                <td class="dataTableContent" align="right"><?php
        echo zen_draw_hidden_field('customers_id[]', $customers->fields['customers_id']);
        echo zen_draw_input_field('rate[]', $customers->fields['rate'],  zen_set_field_length(TABLE_CUSTOMERS_POINT_RATE, 'rate'));
?></td>
                <td class="dataTableContent" align="right"><?php if (isset($cInfo) && is_object($cInfo) && ($customers->fields['customers_id'] == $cInfo->customers_id)) { echo zen_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', ''); } else { echo '<a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('module', 'cID')) . 'module=point_customersrate&cID=' . $customers->fields['customers_id'] . ($_GET['page'] > 0 ? '&page=' . $_GET['page'] : ''), 'NONSSL') . '">' . zen_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
      $customers->MoveNext();
    }
?>
              <tr>
                <td colspan="9"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $customers_split->display_count($customers_query_numrows, $count_by_page, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_CUSTOMERS); ?></td>
                    <td class="smallText" align="right"><?php echo $customers_split->display_links($customers_query_numrows, $count_by_page, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], zen_get_all_get_params(array('page', 'info', 'x', 'y', 'cID'))); ?></td>
                    <td class="smallText" align="right"><?php echo zen_image_submit('button_update.gif', IMAGE_UPDATE, 'name="submit_update"'); ?></td>
                  </tr>
<?php
    if (isset($_GET['search']) && zen_not_null($_GET['search'])) {
?>
                  <tr>
                    <td align="right" colspan="2"><?php echo '<a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=point_customersrate', 'NONSSL') . '">' . zen_image_button('button_reset.gif', IMAGE_RESET) . '</a>'; ?></td>
                  </tr>
<?php
    }
?>
                </table></td>
              </tr>
            </table></form></td>
<?php
  $heading = array();
  $contents = array();

  switch ($action) {
    default:
      if (isset($cInfo) && is_object($cInfo)) {
        $customers_orders = $db->Execute("select orders_id, date_purchased, order_total, currency, currency_value from " . TABLE_ORDERS . " where customers_id='" . $cInfo->customers_id . "' order by date_purchased desc");

        $heading[] = array('text' => '<b>' . TABLE_HEADING_ID . $cInfo->customers_id . ' ' . $cInfo->customers_firstname . ' ' . $cInfo->customers_lastname . '</b>');

        $contents[] = array('text' => '<br />' . TEXT_DATE_ACCOUNT_CREATED . ' ' . zen_date_short($cInfo->date_account_created));
        $contents[] = array('text' => '<br />' . TEXT_DATE_ACCOUNT_LAST_MODIFIED . ' ' . zen_date_short($cInfo->date_account_last_modified));
        $contents[] = array('text' => '<br />' . TEXT_INFO_DATE_LAST_LOGON . ' '  . zen_date_short($cInfo->date_last_logon));
        $contents[] = array('text' => '<br />' . TEXT_INFO_NUMBER_OF_LOGONS . ' ' . $cInfo->number_of_logons);
        $contents[] = array('text' => '<br />' . TEXT_INFO_NUMBER_OF_ORDERS . ' ' . $customers_orders->RecordCount());
        if ($customers_orders->RecordCount() != 0) {
          $contents[] = array('text' => TEXT_INFO_LAST_ORDER . ' ' . zen_date_short($customers_orders->fields['date_purchased']) . '<br />' . TEXT_INFO_ORDERS_TOTAL . ' ' . $currencies->format($customers_orders->fields['order_total'], true, $customers_orders->fields['currency'], $customers_orders->fields['currency_value']));
        }
        $contents[] = array('text' => '<br />' . TEXT_INFO_COUNTRY . ' ' . $cInfo->countries_name);
        $contents[] = array('text' => '<br />' . TEXT_INFO_NUMBER_OF_REVIEWS . ' ' . $cInfo->number_of_reviews);
        $contents[] = array('text' => '<br />' . CUSTOMERS_REFERRAL . ' ' . $cInfo->customers_referral);
      }
      break;
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
