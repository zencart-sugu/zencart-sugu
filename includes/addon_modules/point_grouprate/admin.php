<?php
/**
 * Group Point Rate
 *
 * @package point
 * @copyright Portions Copyright (C) 2008 Zen Cart.JP
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: group_pointrate $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if (zen_not_null($action)) {
    switch ($action) {
      case 'update_rate':
        $group_id = zen_db_prepare_input($_POST['group_id']);
        $rate = zen_db_prepare_input($_POST['rate']);

        for ($i = 0, $n = count($group_id); $i < $n; $i++ ) {
          $GLOBALS['point_grouprate']->deletePointRate($group_id[$i]);
          if ($rate[$i] != '') {
            $GLOBALS['point_grouprate']->insertPointRate($group_id[$i], $rate[$i]);
          }
        }
        $messageStack->add_session(SUCCESS_GROUP_POINTRATE_UPDATED, 'success');
        zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('module', 'action')) . 'module=point_grouprate', 'NONSSL'));
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
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo zen_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo zen_draw_form('update_rate', FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('module', 'action')) . 'module=point_grouprate&action=update_rate', 'post'); ?><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_GROUP_ID; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_GROUP_NAME; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_GROUP_AMOUNT; ?>&nbsp;</td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_POINTRATE; ?>&nbsp;</td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
  $groups_query_raw = "select gp.*, gpr.rate from " . TABLE_GROUP_PRICING . " gp left join " . TABLE_GROUP_POINT_RATE . " gpr on gp.group_id = gpr.group_id";
  $groups_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $groups_query_raw, $groups_query_numrows);
  $groups = $db->Execute($groups_query_raw);
  while (!$groups->EOF) {
    if ((!isset($_GET['gID']) || (isset($_GET['gID']) && ($_GET['gID'] == $groups->fields['group_id']))) && !isset($gInfo) && (substr($action, 0, 3) != 'new')) {
      $group_customers = $db->Execute("select count(*) as customer_count from " . TABLE_CUSTOMERS .
                                       " where customers_group_pricing = '" . (int)$groups->fields['group_id'] . "'");
      $gInfo_array = array_merge($groups->fields, $group_customers->fields);
      $gInfo = new objectInfo($gInfo_array);
    }

    if (isset($gInfo) && is_object($gInfo) && ($groups->fields['group_id'] == $gInfo->group_id)) {
      echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">' . "\n";
    } else {
      echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">' . "\n";
    }
?>
                <td class="dataTableContent"><?php echo $groups->fields['group_id']; ?></td>
                <td class="dataTableContent"><?php echo $groups->fields['group_name']; ?></td>
                <td class="dataTableContent"><?php echo $groups->fields['group_percentage']; ?></td>
                <td class="dataTableContent" align="right"><?php
        echo zen_draw_hidden_field('group_id[]', $groups->fields['group_id']);
        echo zen_draw_input_field('rate[]', $groups->fields['rate'],  zen_set_field_length(TABLE_GROUP_POINT_RATE, 'rate'));
?></td>
                <td class="dataTableContent" align="right">
                  <?php if (isset($gInfo) && is_object($gInfo) && ($groups->fields['group_id'] == $gInfo->group_id)) { echo zen_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', ''); } else { echo '<a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('module', 'gID')) . 'module=point_grouprate&gID=' . $groups->fields['group_id']) . '">' . zen_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>
                </td>
              </tr>
<?php
    $groups->MoveNext();
  }
?>
              <tr>
                <td colspan="4"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $groups_split->display_count($groups_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_PRICING_GROUPS); ?></td>
                    <td class="smallText" align="right"><?php echo $groups_split->display_links($groups_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']); ?></td>
                    <td class="smallText" align="right"><?php echo zen_image_submit('button_update.gif', IMAGE_UPDATE, 'name="submit_update"'); ?></td>
                  </tr>
                </table></td>
              </tr>
            </table></from></td>
<?php
  $heading = array();
  $contents = array();

  switch ($action) {
    default:
      if (isset($gInfo) && is_object($gInfo)) {
        $heading[] = array('text' => '<b>' . $gInfo->group_name . '</b>');

        $contents[] = array('text' => '<br>' . TEXT_DATE_ADDED . ' ' . zen_date_short($gInfo->date_added));
        if (zen_not_null($gInfo->last_modified)) $contents[] = array('text' => TEXT_LAST_MODIFIED . ' ' . zen_date_short($gInfo->last_modified));
        $contents[] = array('text' => '<br>' . TEXT_CUSTOMERS . ' ' . $gInfo->customer_count);
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

