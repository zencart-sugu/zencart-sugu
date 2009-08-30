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
//  $Id: server_info.php 2226 2005-10-26 08:03:06Z drbyte $
//

  require('includes/application_top.php');
  $version_check_sysinfo=true;

  $system = zen_get_system_information();

// the following is for display later
  $sinfo =  '<table width="600" border="1" cellpadding="3" style="border: 0px; border-color: #000000;">' .
         '  <tr align="center"><td><a href="http://www.zen-cart.com"><img border="0" src="images/logo.gif" alt=" Zen Cart " /></a>' .
         '     <h2 class="p"> ' . PROJECT_VERSION_NAME . ' ' . PROJECT_VERSION_MAJOR . '.' . PROJECT_VERSION_MINOR . '</h2>' .
               ((PROJECT_VERSION_PATCH1 =='') ? '' : '<h3>Patch: ' . PROJECT_VERSION_PATCH1 . '::' . PROJECT_VERSION_PATCH1_SOURCE . '</h3>') .
               ((PROJECT_VERSION_PATCH2 =='') ? '' : '<h3>Patch: ' . PROJECT_VERSION_PATCH2 . '::' . PROJECT_VERSION_PATCH2_SOURCE . '</h3>') .
         '     <h2 class="p"> ' . PROJECT_DATABASE_LABEL . ' ' . PROJECT_DB_VERSION_MAJOR . '.' . PROJECT_DB_VERSION_MINOR . '</h2>' .
               ((PROJECT_DB_VERSION_PATCH1 =='') ? '' : '<h3>Patch: ' . PROJECT_DB_VERSION_PATCH1 . '::' . PROJECT_DB_VERSION_PATCH1_SOURCE . '</h3>') .
               ((PROJECT_DB_VERSION_PATCH2 =='') ? '' : '<h3>Patch: ' . PROJECT_DB_VERSION_PATCH2 . '::' . PROJECT_DB_VERSION_PATCH2_SOURCE . '</h3>') ;

  $hist_query = "SELECT * from " . TABLE_PROJECT_VERSION_HISTORY . " WHERE project_version_key = 'Zen-Cart Main' ORDER BY project_version_date_applied DESC";
  $hist_details = $db->Execute($hist_query);
    while (!$hist_details->EOF) {
      $sinfo .=  'v' . $hist_details->fields['project_version_major'] . '.' . $hist_details->fields['project_version_minor'];
      if (zen_not_null($hist_details->fields['project_version_patch'])) $sinfo .= '&nbsp;&nbsp;Patch: ' . $hist_details->fields['project_version_patch'];
      if (zen_not_null($hist_details->fields['project_version_date_applied'])) $sinfo .= ' &nbsp;&nbsp;[' . $hist_details->fields['project_version_date_applied'] . '] ';
      if (zen_not_null($hist_details->fields['project_version_comment'])) $sinfo .= ' &nbsp;&nbsp;(' . $hist_details->fields['project_version_comment'] . ')';
      $sinfo .=  '<br />';
      $hist_details->MoveNext();
    }
  $sinfo .= '</td>' .
         '  </tr>' .
         '</table>';
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<script language="javascript" src="includes/menu.js"></script>
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
<body onload="init()" >
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->
<!-- body //-->
<!-- body_text //-->
<table width="90%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td colspan="2" height="44"> <br>
      <font size="+2"><b>
      <?php echo HEADING_TITLE; ?>
      </b></font> </td>
  </tr>
  <tr>
    <td colspan="2" align="left">
      <?php echo zen_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?>
    </td>
  </tr>
  <tr>
    <td><b>
      <?php echo TITLE_SERVER_HOST; ?>
      </b>
      <?php echo $system['host'] . ' (' . $system['ip'] . ')'; ?>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> </b></td>
    <td width="51%"><b>
      <?php echo TITLE_DATABASE_HOST; ?>
      </b>
      <?php echo $system['db_server'] . ' (' . $system['db_ip'] . ')'; ?>
    </td>
  </tr>
  <tr>
    <td><b>
      <?php echo TITLE_SERVER_OS; ?>
      </b>
      <?php echo $system['system'] . ' ' . $system['kernel']; ?>
      &nbsp;&nbsp;</td>
    <td width="51%"><b>
      <?php echo TITLE_DATABASE; ?>
      </b>
      <?php echo $system['db_version']; ?>
    </td>
  </tr>
  <tr>
    <td><b>
      <?php echo TITLE_SERVER_DATE; ?>
      </b>
      <?php echo $system['date']; ?>
      &nbsp;</td>
    <td width="51%"><b>
      <?php echo TITLE_DATABASE_DATE; ?>
      </b>
      <?php echo $system['db_date']; ?>
    </td>
  </tr>
  <tr>
    <td height="26">
      <p><b>
        <?php echo TITLE_SERVER_UP_TIME; ?>
        </b>
        <?php echo $system['uptime']; ?>
        <br>
        <b>
        <?php echo TITLE_PHP_VERSION; ?>
        </b>
        <?php echo $system['php'] . ' (' . TITLE_ZEND_VERSION . ' ' . $system['zend'] . ')'; ?>
      </p>
    </td>
    <td width="51%" height="26"><b>
      <?php echo TITLE_HTTP_SERVER; ?>
      </b>
      <?php echo $system['http_server']; ?>
    </td>
  </tr>
</table>
<br />
<table border="0" cellspacing="0" cellpadding="4" width="90%">
  <tr>
    <td width="100%" height="23">
      <style type="text/css">
 table, td, tr {font-family: sans-serif; font-size: 11px;}
.p {text-align: center;}
.e {background-color: #ccccff; font-weight: bold; font-size: 11px;}
.h {background-color: #9999cc; font-weight: bold; font-size: 11px;}
.v {background-color: #cccccc; font-size: 12px;}
i {color: #666666; font-size: 11px;}
hr {display: none; font-size: 11px;}
</style>
<?php
  if (function_exists('ob_start')) {
    ob_start();
    phpinfo();
    $phpinfo = ob_get_contents();
    ob_end_clean();

    $phpinfo = str_replace('border: 1px', '', $phpinfo);
    ereg('<body>(.*)</body>', $phpinfo, $regs);
    echo $sinfo;
    echo $regs[1];
  } else {
    echo $sinfo;
    phpinfo();
  }
?>
    </td>
  </tr>
 </table>
<!-- body_text_eof //-->

<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
