<?php
/**
 * Points
 *
 * @package point
 * @copyright Portions Copyright (C) 2008 Zen Cart.JP
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: points.php $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();

  $points_classes = array();
  $points_class_array = array();

  $points_class = $db->Execute("select distinct class from " . TABLE_POINT_HISTORIES . " order by class");

  while (!$points_class->EOF) {
    $points_classes[] = array(
      'id' => $points_class->fields['class'],
      'text' => $points_class->fields['class']
      );
    $points_class_array[$points_class->fields['class']] = $points_class->fields['class'];
    $points_class->MoveNext();
  }

  $point_specify_options = array(
    array('id' => 'deposit', 'text' => ENTRY_DEPOSIT),
    array('id' => 'pending', 'text' => ENTRY_PENDING),
    array('id' => 'withdraw', 'text' => ENTRY_WITHDRAW),
    );

  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if (zen_not_null($action)) {
    $pID = zen_db_prepare_input($_GET['pID']);
    require_once(DIR_FS_CATALOG . $GLOBALS['point_base']->dir . 'classes/class.point.php');
    $point =& new point();
    $customers_id = $point->getCustomersIDByID($pID);
    $point->point($customers_id);

    switch ($action) {
      case 'new':
        $customers_id = '';
        $customers_name = '';
        $customers_company = '';
        $customers_email = '';
        $description = '';
        $point_specify = '';
        $point_value = '';
        $point_specify_text = '';
        break;

      case 'newconfirm':
      case 'insert_point':
        $customers_id = '';
        $customers_firstname = '';
        $customers_lastname = '';
        $customers_company = '';
        $customers_email = '';
        $description = '';
        $point_specify = '';
        $point_value = '';
        $point_specify_text = '';

        $customers_id = zen_db_prepare_input($_POST['customers_id']);
        $description = zen_db_prepare_input($_POST['description']);
        $point_specify = zen_db_prepare_input($_POST['point_specify']);
        $point_value = (int)zen_db_prepare_input($_POST['point_value']);

        $error = false;
        $deposit = 0;
        $pending = 0;
        $withdraw = 0;

        $customer_query = "
          select
            c.customers_id, c.customers_firstname as firstname, c.customers_lastname as lastname,
            c.customers_email_address as email, ab.entry_company as company
          from
            " . TABLE_CUSTOMERS . " c
            , " . TABLE_ADDRESS_BOOK . " ab
        where
          c.customers_id = '" . (int)$customers_id . "'
          and c.customers_id = ab.customers_id
          and c.customers_default_address_id = ab.address_book_id
        ;";
        $customer = $db->Execute($customer_query);

        if ($customer->RecordCount() < 1) {
          $error = true;
          $messageStack->add(ERROR_CUSTOMERS_ID, 'error');
        } else {
          $customers_firstname = $customer->fields['firstname'];
          $customers_lastname = $customer->fields['lastname'];
          $customers_company = $customer->fields['company'];
          $customers_email = $customer->fields['email'];
          $point->point($customers_id);
        }

        if (strlen($description) < 1) {
          $error = true;
          $messageStack->add(ERROR_DESCRIPTION, 'error');
        }

        if ($point_value < 1) {
          $error = true;
          $messageStack->add(ERROR_POINT_VALUE, 'error');
        } elseif ($point_specify == 'deposit') {
          $deposit = $point_value;
          $point_specify_text = ENTRY_DEPOSIT;
        } elseif ($point_specify == 'pending') {
          $pending = $point_value;
          $point_specify_text = ENTRY_PENDING;
        } elseif ($point_specify == 'withdraw') {
          $withdraw = $point_value;
          $point_specify_text = ENTRY_WITHDRAW;
        } else {
          $error = true;
          $messageStack->add(ERROR_POINT_SPECIFY, 'error');
        }

        if ($error) {
          $action = 'new';
        }

        if ($action == 'insert_point' && $_POST['back_x'] != '') {
          $action = 'new';
        }

        if ($action == 'insert_point' && $_POST['done_x'] != '') {
          $sql_data_array = array(
            'customers_id' => (int)$customers_id,
            'related_id_name' => '',
            'related_id_value' => 0,
            'deposit' => $deposit,
            'pending' => $pending,
            'withdraw' => $withdraw,
            'description' => $description,
            'class' => 'none',
            'status' => 0
            );

          $pID = $point->insert($sql_data_array);
          $messageStack->add_session(SUCCESS_POINT_INSERTED, 'success');
          zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('module', 'action')) . 'module=point_base&pID=' . $pID, 'NONSSL'));
        }
        break;

      case 'update_point':
        // demo active test
        if (zen_admin_demo()) {
          $_GET['action']= '';
          $messageStack->add_session(ERROR_ADMIN_DEMO, 'caution');
          zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('module', 'action')) . 'module=point_base&action=edit', 'NONSSL'));
        }
        $description = zen_db_prepare_input($_POST['description']);
        $point_specify = zen_db_prepare_input($_POST['point_specify']);
        $point_value = (int)zen_db_prepare_input($_POST['point_value']);

        $error = false;
        $deposit = 0;
        $pending = 0;
        $withdraw = 0;

        if (strlen($description) < 1) {
          $error = true;
          $messageStack->add_session(ERROR_DESCRIPTION, 'error');
        }

        if ($point_value < 1) {
          $error = true;
          $messageStack->add_session(ERROR_POINT_VALUE, 'error');
        } elseif ($point_specify == 'deposit') {
          $deposit = $point_value;
        } elseif ($point_specify == 'pending') {
          $pending = $point_value;
        } elseif ($point_specify == 'withdraw') {
          $withdraw = $point_value;
        } else {
          $error = true;
          $messageStack->add_session(ERROR_POINT_SPECIFY, 'error');
        }

        if ($error) {
          zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('module', 'action')) . 'module=point_base&action=edit', 'NONSSL'));
        }

        $sql_data_array = array(
          'description' => $description,
          'deposit' => $deposit,
          'pending' => $pending,
          'withdraw' => $withdraw
          );
        $point->update($pID, $sql_data_array);
        $messageStack->add_session(SUCCESS_POINT_UPDATED, 'success');
        zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('module', 'action')) . 'module=point_base', 'NONSSL'));
        break;

      case 'deleteconfirm':
        // demo active test
        if (zen_admin_demo()) {
          $_GET['action']= '';
          $messageStack->add_session(ERROR_ADMIN_DEMO, 'caution');
          zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('module', 'pID', 'action')) . 'module=point_base', 'NONSSL'));
        }
        $point->delete($pID);
        $messageStack->add_session(SUCCESS_POINT_DELETED, 'success');
        zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('module', 'action')) . 'module=point_base', 'NONSSL'));
        break;

      case 'statusoffconfirm':
        // demo active test
        if (zen_admin_demo()) {
          $_GET['action']= '';
          $messageStack->add_session(ERROR_ADMIN_DEMO, 'caution');
          zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('module', 'action')) . 'module=point_base', 'NONSSL'));
        }
        $point->disable($pID);
        $messageStack->add_session(SUCCESS_POINT_UPDATED, 'success');
        zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('module', 'action')) . 'module=point_base', 'NONSSL'));
        break;

      case 'statusonconfirm':
        // demo active test
        if (zen_admin_demo()) {
          $_GET['action']= '';
          $messageStack->add_session(ERROR_ADMIN_DEMO, 'caution');
          zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('module', 'action')) . 'module=point_base', 'NONSSL'));
        }
        $point->enable($pID);
        $messageStack->add_session(SUCCESS_POINT_UPDATED, 'success');
        zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('module', 'action')) . 'module=point_base', 'NONSSL'));
        break;

      case 'p2dconfirm':
        // demo active test
        if (zen_admin_demo()) {
          $_GET['action']= '';
          $messageStack->add_session(ERROR_ADMIN_DEMO, 'caution');
          zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('module', 'action')) . 'module=point_base', 'NONSSL'));
        }
        $point->pendingToDeposit($pID);
        $messageStack->add_session(SUCCESS_POINT_UPDATED, 'success');
        zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('module', 'action')) . 'module=point_base', 'NONSSL'));
        break;

      case 'd2pconfirm':
        // demo active test
        if (zen_admin_demo()) {
          $_GET['action']= '';
          $messageStack->add_session(ERROR_ADMIN_DEMO, 'caution');
          zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('module', 'action')) . 'module=point_base', 'NONSSL'));
        }
        $point->depositToPending($pID);
        $messageStack->add_session(SUCCESS_POINT_UPDATED, 'success');
        zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('module', 'action')) . 'module=point_base', 'NONSSL'));
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
<link rel="stylesheet" type="text/css" media="print" href="includes/stylesheet_print.css">
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
<script language="javascript" type="text/javascript"><!--
function couponpopupWindow(url) {
  window.open(url,'popupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=450,height=280,screenX=150,screenY=150,top=150,left=150')
}
//--></script>
</head>
<body onload="init()">
<!-- header //-->
<div class="header-area">
<?php
  require(DIR_WS_INCLUDES . 'header.php');
?>
</div>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
<!-- body_text //-->

<?php if (empty($action)) { ?>
<!-- search -->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td  align="center"><table border="0" width="95%" cellspacing="0" cellpadding="0">
         <tr><?php echo zen_draw_form('search', FILENAME_ADDON_MODULES_ADMIN, 'module=point_base', 'get', '', true); ?>
            <td class="pageHeading" align="right"><?php echo zen_draw_separator('pixel_trans.gif', 1, HEADING_IMAGE_HEIGHT); ?></td>
            <td colspan="2" class="smallText searchBox" align="right">
<?php
  echo zen_draw_hidden_field('module', 'point_base');
// show reset search
  if ((isset($_GET['search']) && zen_not_null($_GET['search'])) or $_GET['cID'] !='') {
    echo '<a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=point_base', 'NONSSL') . '">' . zen_image_button('button_reset.gif', IMAGE_RESET) . '</a><br />';
  }
?>
<?php
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
<!-- search -->
<?php } ?>
      <tr>
        <td width="100%" align="center"><table border="0" width="95%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo zen_draw_separator('pixel_trans.gif', 1, HEADING_IMAGE_HEIGHT); ?></td>
            <td align="right"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr><?php echo zen_draw_form('points', FILENAME_ADDON_MODULES_ADMIN, 'module=point_base', 'get', '', true); ?>
                <td class="smallText" align="right"><?php echo HEADING_TITLE_SEARCH . ' ' . zen_draw_input_field('cID', '', 'size="12"') . zen_hide_session_id(); ?></td>
              </form></tr>
              <tr><?php echo zen_draw_form('class', FILENAME_ADDON_MODULES_ADMIN, 'module=point_base', 'get', '', true); ?>
                <td class="smallText" align="right">
                  <?php
                    echo HEADING_TITLE_CLASS . ' ' . zen_draw_pull_down_menu('class', array_merge(array(array('id' => '', 'text' => TEXT_ALL_POINTS)), $points_classes), $_GET['class'], 'onChange="this.form.submit();"');
                    echo zen_hide_session_id();
                  ?>
                </td>
              </form></tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td align="center"><table border="0" width="95%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent" align="center">&nbsp;<?php echo TABLE_HEADING_POINTS_ID; ?>&nbsp;</td>
                <td class="dataTableHeadingContent" align="left">&nbsp;<?php echo TABLE_HEADING_CUSTOMERS; ?>&nbsp;</td>
                <td class="dataTableHeadingContent" align="left">&nbsp;<?php echo TABLE_HEADING_DESCRIPTION; ?>&nbsp;</td>
                <td class="dataTableHeadingContent" align="right">&nbsp;<?php echo TABLE_HEADING_DEPOSIT; ?>&nbsp;</td>
                <td class="dataTableHeadingContent" align="right">&nbsp;<?php echo TABLE_HEADING_PENDING; ?>&nbsp;</td>
                <td class="dataTableHeadingContent" align="right">&nbsp;<?php echo TABLE_HEADING_WITHDRAW; ?>&nbsp;</td>
                <!--<td class="dataTableHeadingContent" align="left">&nbsp;<?php echo TABLE_HEADING_CLASS; ?>&nbsp;</td>-->
                <td class="dataTableHeadingContent" align="center">&nbsp;<?php echo TABLE_HEADING_CREATED; ?>&nbsp;</td>
                <td class="dataTableHeadingContent" align="center">&nbsp;<?php echo TABLE_HEADING_UPDATED; ?>&nbsp;</td>
                <td class="dataTableHeadingContent" align="center">&nbsp;<?php echo TABLE_HEADING_STATUS; ?>&nbsp;</td>
                <td class="dataTableHeadingContent" align="right">&nbsp;<?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>

<?php
// create search filter
  $search = '';
  if (isset($_GET['search']) && zen_not_null($_GET['search'])) {
    $keywords = zen_db_input(zen_db_prepare_input($_GET['search']));
    $search = "
      and (
        c.customers_firstname like '%" . $keywords . "%'
        or c.customers_lastname like '%" . $keywords . "%'
        or c.customers_dob like '%" . $keywords . "%'
        or c.customers_email_address like '%" . $keywords . "%'
        or c.customers_nick like '%" . $keywords . "%'
        or c.customers_telephone like '%" . $keywords . "%'
        or c.customers_fax like '%" . $keywords . "%'
        or ab.entry_company like '%" . $keywords . "%'
        or ab.entry_firstname like '%" . $keywords . "%'
        or ab.entry_lastname like '%" . $keywords . "%'
        or ab.entry_street_address like '%" . $keywords . "%'
        or ab.entry_suburb like '%" . $keywords . "%'
        or ab.entry_postcode like '%" . $keywords . "%'
        or ab.entry_city like '%" . $keywords . "%'
        or ab.entry_state like '%" . $keywords . "%'
        or ab.entry_country_id like '%" . $keywords . "%'
        or ab.entry_zone_id like '%" . $keywords . "%'
        or ab.entry_telephone like '%" . $keywords . "%'
        or ab.entry_fax like '%" . $keywords . "%'
        )";
  }
?>
<?php
    $new_fields = "
          ph.id, ph.customers_id, ph.related_id_name, ph.related_id_value,
          ph.deposit, ph.withdraw, ph.pending,
          ph.description, ph.class,
          ph.created_at, ph.updated_at, ph.status,
          c.customers_firstname as firstname, c.customers_lastname as lastname,
          c.customers_email_address as email, ab.entry_company as company
          ";
    if (isset($_GET['cID'])) {
      $cID = zen_db_prepare_input($_GET['cID']);
      $points_query_raw = "
        select
          " . $new_fields . "
        from
          " . TABLE_POINT_HISTORIES . " ph
          , " . TABLE_CUSTOMERS . " c
          , " . TABLE_ADDRESS_BOOK . " ab
        where
          ph.customers_id = '" . (int)$cID . "'
          and ph.customers_id = c.customers_id
          and c.customers_id = ab.customers_id
          and c.customers_default_address_id = ab.address_book_id
          " . $search . "
        order by
          ph.id DESC
        ";

    } elseif ($_GET['class'] != '') {
      $class = zen_db_prepare_input($_GET['class']);
      $points_query_raw = "
        select
          " . $new_fields . "
        from
          " . TABLE_POINT_HISTORIES . " ph
          , " . TABLE_CUSTOMERS . " c
          , " . TABLE_ADDRESS_BOOK . " ab
        where
          ph.customers_id = c.customers_id
          and c.customers_id = ab.customers_id
          and c.customers_default_address_id = ab.address_book_id
          and ph.class like '" . $class . "'
          " . $search . "
        order by
          ph.id DESC
        ";

    } else {
      $points_query_raw = "
        select
          " . $new_fields . "
        from
          " . TABLE_POINT_HISTORIES . " ph
          , " . TABLE_CUSTOMERS . " c
          , " . TABLE_ADDRESS_BOOK . " ab
        where
          ph.customers_id = c.customers_id
          and c.customers_id = ab.customers_id
          and c.customers_default_address_id = ab.address_book_id
          " . $search . "
        order by
          ph.id DESC
        ";
    }

// Split Page
// reset page when page is unknown
if (($_GET['page'] == '' or $_GET['page'] <= 1) and $_GET['pID'] != '') {
  $check_page = $db->Execute($points_query_raw);
  $check_count=1;
  if ($check_page->RecordCount() > MODULE_POINT_BASE_MAX_DISPLAY_SEARCH_RESULTS_POINTS) {
    while (!$check_page->EOF) {
      if ($check_page->fields['id'] == $_GET['pID']) {
        break;
      }
      $check_count++;
      $check_page->MoveNext();
    }
    $_GET['page'] = round((($check_count/MODULE_POINT_BASE_MAX_DISPLAY_SEARCH_RESULTS_POINTS)+(fmod_round($check_count,MODULE_POINT_BASE_MAX_DISPLAY_SEARCH_RESULTS_POINTS) !=0 ? .5 : 0)),0);
  } else {
    $_GET['page'] = 1;
  }
}

//    $points_query_numrows = '';
    $points_split = new splitPageResults($_GET['page'], MODULE_POINT_BASE_MAX_DISPLAY_SEARCH_RESULTS_POINTS, $points_query_raw, $points_query_numrows);
    $points = $db->Execute($points_query_raw);
    while (!$points->EOF) {
    if ((!isset($_GET['pID']) || (isset($_GET['pID']) && ($_GET['pID'] == $points->fields['id']))) && !isset($pInfo) && $action != 'new') {
        $pInfo = new objectInfo($points->fields);
      }

      if (isset($pInfo) && is_object($pInfo) && ($points->fields['id'] == $pInfo->id)) {
        echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('module', 'pID', 'action')) . 'module=point_base&pID=' . $pInfo->id . '&action=edit', 'NONSSL') . '\'">' . "\n";
      } else {
        echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('module', 'pID', 'action')) . 'module=point_base&pID=' . $points->fields['id'], 'NONSSL') . '\'">' . "\n";
      }
?>
                <td class="dataTableContent" align="right"><?php echo $points->fields['id']; ?></td>
                <td class="dataTableContent"><?php echo '<a href="' . zen_href_link(FILENAME_CUSTOMERS, 'cID=' . $points->fields['customers_id'], 'NONSSL') . '">' . zen_image(DIR_WS_ICONS . 'preview.gif', ICON_PREVIEW . ' ' . TABLE_HEADING_CUSTOMERS) . '</a>&nbsp;' . $points->fields['firstname'] . '&nbsp;' . $points->fields['lastname'] . ($points->fields['company'] != '' ? '<br />' . $points->fields['company'] : ''); ?></td>
                <td class="dataTableContent" align="left"><?php echo strip_tags($points->fields['description']); ?></td>
                <td class="dataTableContent" align="right"><?php echo strip_tags($points->fields['deposit']); ?></td>
                <td class="dataTableContent" align="right"><?php echo strip_tags($points->fields['pending']); ?></td>
                <td class="dataTableContent" align="right"><?php echo strip_tags($points->fields['withdraw']); ?></td>
                <!--<td class="dataTableContent" align="left"><?php echo strip_tags($points->fields['class']); ?></td>-->
                <td class="dataTableContent" align="center"><?php echo zen_datetime_short($points->fields['created_at']); ?></td>
                <td class="dataTableContent" align="center"><?php echo zen_datetime_short($points->fields['updated_at']); ?></td>
                <td class="dataTableContent" align="center"><?php
      if ($points->fields['status'] == '1') {
        echo zen_image(DIR_WS_IMAGES . 'icon_green_on.gif', IMAGE_ICON_STATUS_ON);
      } else {
        echo zen_image(DIR_WS_IMAGES . 'icon_red_on.gif', IMAGE_ICON_STATUS_OFF);
      }
?></td>

                <td class="dataTableContent" align="right"><?php if (isset($pInfo) && is_object($pInfo) && ($points->fields['id'] == $pInfo->id)) { echo zen_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', ''); } else { echo '<a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('module', 'pID')) . 'module=point_base&pID=' . $points->fields['id'], 'NONSSL') . '">' . zen_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
      $points->MoveNext();
    }
?>
              <tr>
                <td colspan="5"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $points_split->display_count($points_query_numrows, MODULE_POINT_BASE_MAX_DISPLAY_SEARCH_RESULTS_POINTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_POINTS); ?></td>
                    <td class="smallText" align="right"><?php echo $points_split->display_links($points_query_numrows, MODULE_POINT_BASE_MAX_DISPLAY_SEARCH_RESULTS_POINTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], zen_get_all_get_params(array('page', 'pID', 'action'))); ?></td>
                  </tr>
<?php
  if (isset($_GET['search']) && zen_not_null($_GET['search'])) {
?>
                  <tr>
                    <td class="smallText" align="right" colspan="2">
                      <?php
                        echo '<a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=point_base', 'NONSSL') . '">' . zen_image_button('button_reset.gif', IMAGE_RESET) . '</a>';
                        if (isset($_GET['search']) && zen_not_null($_GET['search'])) {
                          $keywords = zen_db_input(zen_db_prepare_input($_GET['search']));
                          echo '<br/ >' . TEXT_INFO_SEARCH_DETAIL_FILTER . $keywords;
                        }
                      ?>
                    </td>
                  </tr>
<?php
  }
?>
                </table></td>
              </tr>
<?php
  if (empty($action)) {
?>
              <tr>
                <td align="right" colspan="10" class="smallText"><?php echo '<a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('module','page', 'pID', 'action')) . 'module=point_base&action=new') . '">' . zen_image_button('button_addition.gif', IMAGE_ADDITION) . '</a>'; ?></td>
              </tr>
<?php
  }
?>
            </table></td>
<?php
  $heading = array();
  $contents = array();

  switch ($action) {
    case 'newconfirm':
      $heading[] = array('text' => '<strong>' . TEXT_INFO_HEADING_NEWCONFIRM_POINT . '</strong>');
      $contents = array('form' => zen_draw_form('points', FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('module', 'pID', 'action')) . 'module=point_base&action=insert_point', 'post', 'enctype="multipart/form-data"'));
      $contents[] = array('text' => TEXT_NEWCONFIRM_INTRO);

      $contents[] = array('text' => '<br />' . ENTRY_CUSTOMERS_ID . zen_draw_hidden_field('customers_id', $customers_id) . $customers_id);
      $contents[] = array('text' => ENTRY_CUSTOMERS_NAME . $customers_firstname . '&nbsp;' . $customers_lastname . ($customers_company != '' ? '&nbsp;' . $customers_company : ''));
      $contents[] = array('text' => ENTRY_CUSTOMERS_EMAIL . $customers_email);
      $contents[] = array('text' => '<br />' . ENTRY_DESCRIPTION . '<br />' . zen_draw_hidden_field('description', $description) . $description);
      $contents[] = array('text' => '<br />' . ENTRY_POINT . '<br />' . zen_draw_hidden_field('point_specify', $point_specify) . $point_specify_text . '&nbsp;' . zen_draw_hidden_field('point_value', $point_value) . $point_value . TEXT_POINT);
      $contents[] = array('align' => 'center', 'text' => '<br />' . zen_image_submit('button_save.gif', IMAGE_SAVE, 'name="done"') . ' ' . zen_image_submit('button_back.gif', IMAGE_BACK, 'name="back"'));
      break;

    case 'new':
      $heading[] = array('text' => '<strong>' . TEXT_INFO_HEADING_NEW_POINT . '</strong>');
      $contents = array('form' => zen_draw_form('points', FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('module', 'pID', 'action')) . 'module=point_base&action=newconfirm', 'post', 'enctype="multipart/form-data"'));
      $contents[] = array('text' => TEXT_NEW_INTRO);

      $contents[] = array('text' => '<br />' . ENTRY_CUSTOMERS_ID . zen_draw_input_field('customers_id', $customers_id, zen_set_field_length(TABLE_POINT_HISTORIES, 'customers_id')));
      $contents[] = array('text' => ENTRY_CUSTOMERS_NAME . $customers_firstname . '&nbsp;' . $customers_lastname . ($customers_company != '' ? '&nbsp;' . $customers_company : ''));
      $contents[] = array('text' => ENTRY_CUSTOMERS_EMAIL . $customers_email);
      $contents[] = array('text' => '<br />' . ENTRY_DESCRIPTION . '<br />' . zen_draw_input_field('description', $description, zen_set_field_length(TABLE_POINT_HISTORIES, 'description')));
      $contents[] = array('text' => '<br />' . ENTRY_POINT . '<br />' . zen_draw_pull_down_menu('point_specify', $point_specify_options, $point_specify) . '&nbsp;' . zen_draw_input_field('point_value', $point_value, zen_set_field_length(TABLE_POINT_HISTORIES, 'deposit')) . '&nbsp;' . TEXT_POINT);
      $contents[] = array('align' => 'center', 'text' => '<br />' . zen_image_submit('button_confirm.gif', IMAGE_CONFIRM) . ' <a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('module', 'pID', 'action')) . 'module=point_base&pID=' . $pInfo->id, 'NONSSL') . '">' . zen_image_button('button_back.gif', IMAGE_BACK) . '</a>');
      break;

    case 'edit':
      if (isset($pInfo) && is_object($pInfo)) {
        $point_specify = '';
        $point_value = 0;
        if ($pInfo->deposit > 0) {
          $point_specify = 'deposit';
          $point_value = $pInfo->deposit;
        } elseif ($pInfo->pending > 0) {
          $point_specify = 'pending';
          $point_value = $pInfo->pending;
        } elseif ($pInfo->withdraw > 0) {
          $point_specify = 'withdraw';
          $point_value = $pInfo->withdraw;
        }

        $heading[] = array('text' => '<strong>[' . $pInfo->id . ']&nbsp;&nbsp;' . TEXT_INFO_HEADING_EDIT_POINT . '</strong>');
        $contents = array('form' => zen_draw_form('points', FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('module', 'pID', 'action')) . 'module=point_base&pID=' . $pInfo->id . '&action=update_point', 'post', 'enctype="multipart/form-data"'));
        $contents[] = array('text' => TEXT_EDIT_INTRO);

        $contents[] = array('text' => ENTRY_POINT_ID . $pInfo->id);
        $contents[] = array('text' => ENTRY_CUSTOMERS_ID . $pInfo->customers_id);
        $contents[] = array('text' => ENTRY_CUSTOMERS_NAME . $pInfo->firstname . '&nbsp;' . $pInfo->lastname . ($pInfo->company != '' ? '&nbsp;' . $pInfo->company : ''));
        $contents[] = array('text' => ENTRY_CUSTOMERS_EMAIL . $pInfo->email);
        $contents[] = array('text' => '<br />' . ENTRY_DESCRIPTION . '<br />' . zen_draw_input_field('description', $pInfo->description, zen_set_field_length(TABLE_POINT_HISTORIES, 'description')));
        $contents[] = array('text' => '<br />' . ENTRY_POINT . '<br />' . zen_draw_pull_down_menu('point_specify', $point_specify_options, $point_specify) . '&nbsp;' . zen_draw_input_field('point_value', $point_value, zen_set_field_length(TABLE_POINT_HISTORIES, 'deposit')) . '&nbsp;' . TEXT_POINT);
        $contents[] = array('text' => '<br />' . TEXT_DATE_POINT_CREATED . ' ' . zen_date_short($pInfo->created_at));
        if (zen_not_null($pInfo->updated_at)) $contents[] = array('text' => TEXT_DATE_POINT_UPDATED . ' ' . zen_date_short($pInfo->updated_at));
        $contents[] = array('text' => ENTRY_STATUS . (($pInfo->status == '1')? 'ON' : 'OFF'));
        $contents[] = array('text' => TEXT_INFO_POINT_CLASS . ' '  . $pInfo->class);
        $contents[] = array('align' => 'center', 'text' => '<br />' . zen_image_submit('button_update.gif', IMAGE_UPDATE) . ' <a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('module', 'pID', 'action')) . 'module=point_base&pID=' . $pInfo->id, 'NONSSL') . '">' . zen_image_button('button_back.gif', IMAGE_BACK) . '</a>');
      }
      break;

    case 'delete':
      $heading[] = array('text' => '<strong>' . TEXT_INFO_HEADING_DELETE_POINT . '</strong>');
      $contents = array('form' => zen_draw_form('points', FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('module', 'pID', 'action')) . 'module=point_base&pID=' . $pInfo->id . '&action=deleteconfirm', 'post', '', true));
      $contents[] = array('text' => TEXT_INFO_DELETE_INTRO . '<br /><br /><strong>' . ENTRY_POINT_ID . $pInfo->id . '<br />' . $pInfo->firstname . '&nbsp;' . $pInfo->lastname . ($pInfo->company != '' ? '<br />' . $pInfo->company : '') . '<br />' . $pInfo->description . '</strong>');
      $contents[] = array('align' => 'center', 'text' => '<br />' . zen_image_submit('button_delete.gif', IMAGE_DELETE) . ' <a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('module', 'pID', 'action')) . 'module=point_base&pID=' . $pInfo->id, 'NONSSL') . '">' . zen_image_button('button_back.gif', IMAGE_BACK) . '</a>');
      break;

    case 'statusoff':
      $heading[] = array('text' => '<strong>' . TEXT_INFO_HEADING_STATUS_OFF_POINT . '</strong>');
      $contents = array('form' => zen_draw_form('points', FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('module', 'pID', 'action')) . 'module=point_base&pID=' . $pInfo->id . '&action=statusoffconfirm', 'post', '', true));
      $contents[] = array('text' => TEXT_INFO_STATUS_OFF_INTRO . '<br /><br /><strong>' . ENTRY_POINT_ID . $pInfo->id . '<br />' . $pInfo->firstname . '&nbsp;' . $pInfo->lastname . ($pInfo->company != '' ? '<br />' . $pInfo->company : '') . '<br />' . $pInfo->description . '</strong>');
      $contents[] = array('align' => 'center', 'text' => '<br />' . zen_image_submit('button_update.gif', IMAGE_UPDATE) . ' <a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('module', 'pID', 'action')) . 'module=point_base&pID=' . $pInfo->id, 'NONSSL') . '">' . zen_image_button('button_back.gif', IMAGE_BACK) . '</a>');
      break;

    case 'statuson':
      $heading[] = array('text' => '<strong>' . TEXT_INFO_HEADING_STATUS_ON_POINT . '</strong>');
      $contents = array('form' => zen_draw_form('points', FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('module', 'pID', 'action')) . 'module=point_base&pID=' . $pInfo->id . '&action=statusonconfirm', 'post', '', true));
      $contents[] = array('text' => TEXT_INFO_STATUS_ON_INTRO . '<br /><br /><strong>' . ENTRY_POINT_ID . $pInfo->id . '<br />' . $pInfo->firstname . '&nbsp;' . $pInfo->lastname . ($pInfo->company != '' ? '<br />' . $pInfo->company : '') . '<br />' . $pInfo->description . '</strong>');
      $contents[] = array('align' => 'center', 'text' => '<br />' . zen_image_submit('button_update.gif', IMAGE_UPDATE) . ' <a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('module', 'pID', 'action')) . 'module=point_base&pID=' . $pInfo->id, 'NONSSL') . '">' . zen_image_button('button_back.gif', IMAGE_BACK) . '</a>');
      break;

    case 'p2d':
      $heading[] = array('text' => '<strong>' . TEXT_INFO_HEADING_PENDING_TO_DEPOSIT_POINT . '</strong>');
      $contents = array('form' => zen_draw_form('points', FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('module', 'pID', 'action')) . 'module=point_base&pID=' . $pInfo->id . '&action=p2dconfirm', 'post', '', true));
      $contents[] = array('text' => TEXT_INFO_PENDING_TO_DEPOSIT_INTRO . '<br /><br /><strong>' . ENTRY_POINT_ID . $pInfo->id . '<br />' . $pInfo->firstname . '&nbsp;' . $pInfo->lastname . ($pInfo->company != '' ? '<br />' . $pInfo->company : '') . '<br />' . $pInfo->description . '</strong>');
      $contents[] = array('align' => 'center', 'text' => '<br />' . zen_image_submit('button_update.gif', IMAGE_UPDATE) . ' <a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('module', 'pID', 'action')) . 'module=point_base&pID=' . $pInfo->id, 'NONSSL') . '">' . zen_image_button('button_back.gif', IMAGE_BACK) . '</a>');
      break;

    case 'd2p':
      $heading[] = array('text' => '<strong>' . TEXT_INFO_HEADING_DEPOSIT_TO_PENDING_POINT . '</strong>');
      $contents = array('form' => zen_draw_form('points', FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('module', 'pID', 'action')) . 'module=point_base&pID=' . $pInfo->id . '&action=d2pconfirm', 'post', '', true));
      $contents[] = array('text' => TEXT_INFO_DEPOSIT_TO_PENDING_INTRO . '<br /><br /><strong>' . ENTRY_POINT_ID . $pInfo->id . '<br />' . $pInfo->firstname . '&nbsp;' . $pInfo->lastname . ($pInfo->company != '' ? '<br />' . $pInfo->company : '') . '<br />' . $pInfo->description . '</strong>');
      $contents[] = array('align' => 'center', 'text' => '<br />' . zen_image_submit('button_update.gif', IMAGE_UPDATE) . ' <a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('module', 'pID', 'action')) . 'module=point_base&pID=' . $pInfo->id, 'NONSSL') . '">' . zen_image_button('button_back.gif', IMAGE_BACK) . '</a>');
      break;

    default:
      if (isset($pInfo) && is_object($pInfo)) {
        $heading[] = array('text' => '<strong>[' . $pInfo->id . ']&nbsp;&nbsp;' . zen_datetime_short($pInfo->created_at) . '</strong>');
        $contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('module', 'pID', 'action')) . 'module=point_base&pID=' . $pInfo->id . '&action=edit', 'NONSSL') . '">' . zen_image_button('button_edit.gif', IMAGE_EDIT) . '</a> <a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('module', 'pID', 'action')) . 'module=point_base&pID=' . $pInfo->id . '&action=delete', 'NONSSL') . '">' . zen_image_button('button_delete.gif', IMAGE_DELETE) . '</a>');
        if ($pInfo->status == 1) {
          $contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('module', 'pID', 'action')) . 'module=point_base&pID=' . $pInfo->id . '&action=statusoff', 'NONSSL') . '">' . TEXT_STATUS_OFF . '</a>');
          if ($pInfo->pending > 0) {
            $contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('module', 'pID', 'action')) . 'module=point_base&pID=' . $pInfo->id . '&action=p2d') . '">' . TEXT_PENDING_TO_DEPOSIT . '</a>');
          } elseif($pInfo->deposit > 0) {
            $contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('module', 'pID', 'action')) . 'module=point_base&pID=' . $pInfo->id . '&action=d2p') . '">' . TEXT_DEPOSIT_TO_PENDING . '</a>');
          }
        } else {
          $contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('module', 'pID', 'action')) . 'module=point_base&pID=' . $pInfo->id . '&action=statuson', 'NONSSL') . '">' . TEXT_STATUS_ON . '</a>');
        }
        $contents[] = array('text' => '<br />' . TEXT_DATE_POINT_CREATED . ' ' . zen_date_short($pInfo->created_at));
        if (zen_not_null($pInfo->updated_at)) $contents[] = array('text' => TEXT_DATE_POINT_UPDATED . ' ' . zen_date_short($pInfo->updated_at));
        //$contents[] = array('text' => '<br />' . TEXT_INFO_POINT_CLASS . ' '  . $pInfo->class);
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
<div class="footer-area">
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
</div>
<!-- footer_eof //-->
<br />
</body>
</html>

