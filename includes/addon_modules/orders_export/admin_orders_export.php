<?php
/**
 * @copyright Copyright (c) ark-web, Inc. All rights reserved.
 * @author ohmura
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */

if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

require(dirname(__FILE__) . '/includes/action_orders_export.php');
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" media="print" href="includes/stylesheet_print.css">
<style>
<!--
.dataTableRowSelected {
  background-color: #33FF33;
}
-->
</style>
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<link rel="stylesheet" type="text/css" href="<?php echo DIR_WS_CATALOG . DIR_WS_ADDON_MODULES ?>orders_export/templates/admin/css/orders_export.css" media="screen" />
<link rel="stylesheet" type="text/css" href="includes/javascript/spiffyCal/spiffyCal_v2_1.css">

<script type="text/javascript" src="includes/menu.js"></script>
<script type="text/javascript" src="includes/general.js"></script>
<script type="text/javascript" src="<?php echo DIR_WS_CATALOG . DIR_WS_ADDON_MODULES ?>orders_export/templates/admin/js/jquery.js"></script>
<script type="text/javaScript" src="includes/javascript/spiffyCal/spiffyCal_v2_1.js"></script>

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
    var cBoxAll = document.getElementById('allmatch_orders-top');
    var objForm = document.getElementById('orders_export');
    checkAllMatchOrders(cBoxAll, objForm)
  }
  // -->
</script>
<script type="text/javascript">
  <!--
  var cBoxAllChecked = false;
  var cBoxClicked = false;
  function checkBoxClick(cBox, rowID) {
    clearOrdersID();
    toggleRowStyle(rowID, cBox.checked);
    cBoxClicked = true;
    resetCheckBoxAll();
  }

  function toggleCheckBox(cBoxID, rowID) {
    if (cBoxAllChecked) return false;
    if (!cBoxClicked) {
      if (document.getElementById) {
        var cBox = document.getElementById(cBoxID);
        if (cBox.checked) {
          cBox.checked = false;
        } else {
          cBox.checked = true;
        }
      }
      clearOrdersID();
      toggleRowStyle(rowID, cBox.checked);
    }
    cBoxClicked = false;
    resetCheckBoxAll();
  }

  function toggleRowStyle(rowID, selected) {
    if (document.getElementById) {
      var row = document.getElementById(rowID);
      if (selected) {
        row.className = 'dataTableRowSelected';
      } else {
        row.className = 'dataTableRow';
      }
    }
  }

  function resetCheckBoxAll() {
    document.getElementById('orders_export-allcheck-top').checked = false;
    document.getElementById('orders_export-allcheck-bottom').checked = false;
  }

  function changeAllCheckBox(cBoxAllCheck, objForm) {
    var valChecked = cBoxAllCheck.checked;
    var eLength = objForm.elements.length;
    var i = 0;
    for (i = 0; i < eLength; i++) {
      var el = objForm.elements[i];
      if (el.type == 'checkbox'
        && el.id.match(/orders_export/)) {
        el.checked = valChecked;
      }
    }
    clearOrdersID();
    changeAllRowStyle(valChecked);
    return false;
  }

  function checkAllMatchOrders(cBoxAll, objForm) {
    var valChecked = cBoxAll.checked;
    cBoxAllChecked = valChecked;
    var eLength = objForm.elements.length;
    var i = 0;
    for (i = 0; i < eLength; i++) {
      var el = objForm.elements[i];
      if (el.type == 'checkbox'
        && el.id.match(/orders_export/)) {
        if (valChecked) {
          el.checked = false;
          el.disabled = true;
          changeAllRowStyle(false);
        } else {
          el.disabled = false;
        }
      }
    }
    setCheckBoxAllMatch(valChecked);
    clearOrdersID();
    return false;
  }

  function setCheckBoxAllMatch(checked) {
    document.getElementById('allmatch_orders-top').checked = checked;
    document.getElementById('allmatch_orders-bottom').checked = checked;
  }

  function changeAllRowStyle(selected) {
    var valClassName = '';
      if (selected) {
        valClassName = 'dataTableRowSelected';
      } else {
        valClassName = 'dataTableRow';
      }

    if (document.getElementById) {
      var objTable = document.getElementById('orders-list');
      var rLength = objTable.rows.length;
      var i = 0;
      for (i = 0; i < rLength; i++) {
        var row = objTable.rows[i];
        if (row.className.match(/dataTableRow/)
          || row.className.match(/dataTableRowSelected/)) {
          row.className = valClassName;
        }
      }
      return false;
    }
  }

  function clearOrdersID() {
    if (document.getElementById) {
      var objInput = document.getElementById('orders-id');
      objInput.value = '';
    }
  }
  // -->
</script>
<script language="javascript"><!--
  var dateFrom = new ctlSpiffyCalendarBox("dateFrom", "orders_export", "dfrom","btnDate1","<?php echo $dfrom; ?>",scBTNMODE_CUSTOMBLUE);
  var dateTo = new ctlSpiffyCalendarBox("dateTo", "orders_export", "dto","btnDate2","<?php echo $dto; ?>",scBTNMODE_CUSTOMBLUE);
//--></script>
</head>
<body onload="init()">
<div id="spiffycalendar" class="text"></div>
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <!-- body_text //-->
    <td width="100%" valign="top" align="center"><table border="0" width="95%" cellspacing="0" cellpadding="2">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo MODULE_ORDERS_EXPORT_HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo zen_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td>
          <?php require(dirname(__FILE__) . '/templates/admin_orders_export/'. $template .'.php'); ?>
        </td>
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
