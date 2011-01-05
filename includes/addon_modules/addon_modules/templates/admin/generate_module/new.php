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

  function cloneInput(el) {
    // select parent node
    var prt     = el.parentNode.parentNode.parentNode;
    var iptspan = prt.firstChild;
    // get input node
    var ipt     = iptspan.firstChild;
    if (ipt.value != '') {
      // clone
      var newiptspan = iptspan.cloneNode(true);
      // remove add text
      var addspan    = newiptspan.firstChild.nextSibling;
      newiptspan.removeChild(addspan);
      // append input node
      var br   = document.createElement('br');
      var span = document.createElement('span');
      span.innerHTML = '&nbsp;<a href="#" onclick="removeInput(this);return false;"><?php echo MODULE_MODULE_GENERATE_REMOVE; ?></a>';
      newiptspan.appendChild(span);
      prt.appendChild(br);
      prt.appendChild(newiptspan);
      ipt.value = '';
    }
  }

  function removeInput(el) {
    var prt     = el.parentNode.parentNode.parentNode;
    var iptspan = el.parentNode.parentNode;
    var br      = iptspan.previousSibling;
    if (iptspan) {
      prt.removeChild(iptspan);
    }
    if (br) {
      prt.removeChild(br);
    }
  }

  function checkBeforeSubmit() {
    var e;
    var error = new Array();

    e = document.getElementById('module_title');
    if (!e || !e.value) {
      error.push('<?php echo MODULE_MODULE_GENERATE_ERROR_TITLE; ?>');
    }
    e = document.getElementById('module_name');
    if (!e || !e.value) {
      error.push('<?php echo MODULE_MODULE_GENERATE_ERROR_NAME; ?>');
    }
    if (e && e.value && !e.value.match(/^[a-zA-Z][a-zA-Z0-9_-]*$/)) {
      error.push('<?php echo MODULE_MODULE_GENERATE_ERROR_VALIDATE_NAME; ?>');
    }
    e = document.getElementById('module_version');
    if (!e || !e.value) {
      error.push('<?php echo MODULE_MODULE_GENERATE_ERROR_VERSION; ?>');
    }
    e = document.getElementById('module_description');
    if (!e || !e.value) {
      error.push('<?php echo MODULE_MODULE_GENERATE_ERROR_DESCRIPTION; ?>');
    }
    e = document.getElementById('module_author');
    if (!e || !e.value) {
      error.push('<?php echo MODULE_MODULE_GENERATE_ERROR_AUTHOR; ?>');
    }
    e = document.getElementById('module_author_email');
    if (!e || !e.value) {
      error.push('<?php echo MODULE_MODULE_GENERATE_ERROR_AUTHOR_EMAIL; ?>');
    }
    e = document.getElementById('module_zencart_version');
    if (!e || !e.value) {
      error.push('<?php echo MODULE_MODULE_GENERATE_ERROR_ZENCART_VERSION; ?>');
    }
    e = document.getElementById('module_addonmodule_version');
    if (!e || !e.value) {
      error.push('<?php echo MODULE_MODULE_GENERATE_ERROR_ADDONMODULE_VERSION; ?>');
    }
    e = document.getElementById('module_required');
    if (e && e.value && !e.value.match(/^[a-zA-Z][a-zA-Z0-9_-]*$/)) {
      error.push('<?php echo MODULE_MODULE_GENERATE_ERROR_VALIDATE_REQUIRED; ?>');
    }

    if (error.length > 0) {
      alert(error.join('\n'));
      return false;
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
<?php if ($success != true) {
  echo zen_draw_form('module_generate', FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(), 'post', 'id="module_generate" onsubmit="return checkBeforeSubmit();"');
} ?>
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
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo TABLE_HEADING_MODULES_TITLE; ?></td>
                <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_MODULES_NAME; ?></td>
                <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_VARSION; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_SORT_ORDER; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
          echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">' . "\n";
?>
                <td class="dataTableContent"><?php echo zen_draw_input_field('module_title', '', 'size="30" id="module_title"'.($success ? ' readonly="readonly"' : '')); ?></td>
                <td class="dataTableContent"><?php echo zen_draw_input_field('module_name', '', 'id="module_name"'.($success ? ' readonly="readonly"' : '')); ?></td>
                <td class="dataTableContent"><?php echo zen_draw_input_field('module_version', MODULE_MODULE_GENERATE_VERSION, 'readonly="readonly" size="10" id="module_version"'); ?></td>
                <td class="dataTableContent" align="right"><?php echo zen_draw_input_field('module_sort_order', '', 'size="5" id="module_sort_order"'.($success ? ' readonly="readonly"' : '')); ?></td>
                <td class="dataTableContent" align="right"><?php echo zen_image(DIR_WS_IMAGES . 'icon_arrow_right.gif'); ?>&nbsp;</td>
              </tr>
            </table></td>
<?php
// 以下サイドカラム
      $heading = array();
      $contents = array();

      $heading[] = array('text' => '<b>' . TITLE_SIDOBOX_OF_MODULE_GENERATE . '</b>');

      $contents[] = array('align' => 'left', 'text' => '<b>'.MODULE_MODULE_GENERATE_MODULE_DESCRIPTION.'</b>');
      $contents[] = array('align' => 'left', 'text' => zen_draw_input_field('module_description', '', 'size="50" id="module_description"'.($success ? ' readonly="readonly"' : '')));

      $contents[] = array('align' => 'left', 'text' => '<b>'.MODULE_MODULE_GENERATE_MODULE_AUTHOR.'</b>');
      $contents[] = array('align' => 'left', 'text' => zen_draw_input_field('module_author', '', 'id="module_author"'.($success ? ' readonly="readonly"' : '')));

      $contents[] = array('align' => 'left', 'text' => '<b>'.MODULE_MODULE_GENERATE_MODULE_EMAIL.'</b>');
      $contents[] = array('align' => 'left', 'text' => zen_draw_input_field('module_author_email', MODULE_MODULE_GENERATE_MODULE_EMAIL_DEFAULT, 'id="module_author_email"'.($success ? ' readonly="readonly"' : '')));

      $contents[] = array('align' => 'left', 'text' => '<b>'.MODULE_MODULE_GENERATE_MODULE_ZENCART_VERSION.'</b>');
      $contents[] = array('align' => 'left', 'text' => zen_draw_input_field('module_zencart_version', MODULE_MODULE_GENERATE_MODULE_ZENCART_VERSION_DEFAULT, 'id="module_zencart_version"'.($success ? ' readonly="readonly"' : '')));

      $contents[] = array('align' => 'left', 'text' => '<b>'.MODULE_MODULE_GENERATE_MODULE_ADDONMODULE_VERSION.'</b>');
      $contents[] = array('align' => 'left', 'text' => zen_draw_input_field('module_addonmodule_version', MODULE_MODULE_GENERATE_MODULE_ADDONMODULE_VERSION_DEFAULT, 'id="module_addonmodule_version"'.($success ? ' readonly="readonly"' : '')));

      $contents[] = array('align' => 'left', 'text' => '<b>'.MODULE_MODULE_GENERATE_MODULE_REQUIRED.'</b>');
      if ($success != true) {
        if (!isset($module_required) || sizeof($module_required) == 0) {
          $contents[] = array('align' => 'left', 'text' => '<span>'.zen_draw_input_field('module_required[]', '').'<span>&nbsp;<a href="#" onclick="cloneInput(this); return false;">'.MODULE_MODULE_GENERATE_ADD.'</a></span>'.'</span>');
        } else {
          $first = true;
          foreach ($module_required as $key => $val):
          if ($first) {
	    $text = '<span>'.zen_draw_input_field('module_required[]', trim($val, "'")).'<span>&nbsp;<a href="#" onclick="cloneInput(this); return false;">'.MODULE_MODULE_GENERATE_ADD.'</a></span>'.'</span>';
            $first = false;
          } else {
            $text .= '<br />'.'<span>'.zen_draw_input_field('module_required[]', trim($val, "'")).'<span>&nbsp;<a href="#" onclick="removeInput(this); return false;">'.MODULE_MODULE_GENERATE_REMOVE.'</a></span>'.'</span>';
          }
          endforeach;
          $contents[] = array('align' => 'left', 'text' => $text);
        }
      } else {
        if (!isset($module_required) || sizeof($module_required) == 0) {
          $contents[] = array('align' => 'left', 'text' => '<span>'.zen_draw_input_field('module_required[]', '').'</span>');
        } else {
          $text = '';
          foreach ($module_required as $key => $val):
          $text .= '<span>'.zen_draw_input_field('module_required[]', trim($val, "'"), 'readonly="readonly"').'</span>'.'<br />';
          endforeach;
          $contents[] = array('align' => 'left', 'text' => $text);
        }
      }
      if ($success != true) {
        $contents[] = array('align' => 'center', 'text' => zen_draw_input_field('submit', MODULE_MODULE_GENERATE_MODULE_GENERATE, '', '', 'submit'));
      }

  if ( (zen_not_null($heading)) && (zen_not_null($contents)) ) {
    echo '            <td width="25%" valign="top">' . "\n";
    $box = new box;
    echo $box->infoBox($heading, $contents);
    echo '            </td>' . "\n";
  }
// サイドカラム終了
?>
          </tr>
        </table></td>
      </tr>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<?php if ($success != true) { ?>
</form>
<?php } ?>
<!-- body_eof //-->
<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
