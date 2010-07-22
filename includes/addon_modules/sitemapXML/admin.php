<?php
/**
 * Sitemap XML Feed
 *
 * @package Sitemap XML Feed
 * @copyright Copyright 2005-2009, Andrew Berezin eCommerce-Service.com
 * @copyright Portions Copyright 2003-2009 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @link http://www.sitemaps.org/
 * @version $Id: sitemapxml.php, v 1.3.13 14.08.2007 10:32 AndrewBerezin $
 */

  require("../includes/addon_modules/sitemapXML/languages/" . $_SESSION['language'] . '.php');

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
<script type="text/javascript">
<!--
function getFormFields(obj) {
  var getParms = "&";
  for (i=0; i<obj.childNodes.length; i++) {
    if (obj.childNodes[i].tagName == "INPUT") {
      if (obj.childNodes[i].type == "text") {
        getParms += obj.childNodes[i].name + "=" + obj.childNodes[i].value + "&";
      }
      if (obj.childNodes[i].type == "hidden") {
        getParms += obj.childNodes[i].name + "=" + obj.childNodes[i].value + "&";
      }
      if (obj.childNodes[i].type == "checkbox") {
        if (obj.childNodes[i].checked) {
          getParms += obj.childNodes[i].name + "=" + obj.childNodes[i].value + "&";
        } else {
          getParms += obj.childNodes[i].name + "=&";
        }
      }
      if (obj.childNodes[i].type == "radio") {
        if (obj.childNodes[i].checked) {
          getParms += obj.childNodes[i].name + "=" + obj.childNodes[i].value + "&";
        }
      }
    }
    if (obj.childNodes[i].tagName == "SELECT") {
      var sel = obj.childNodes[i];
      getParms += sel.name + "=" + sel.options[sel.selectedIndex].value + "&";
    }
  }
  getParms = getParms.replace(/\s+/g," ");
  getParms = getParms.replace(/ /g, "+");
//  var_dump(getParms);
  return getParms;
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
            <td class="pageHeading" align="right"><img src="../includes/addon_modules/sitemapXML/images/google-sitemaps.gif" width="110" height="48"></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td width="100%" valign="top">
          <table width="100%"  border="0" cellpadding="0" cellspacing="0" class="main">
            <tr>
              <td width="78%" align="left" valign="top">
                <?php echo TEXT_SITEMAPXML_OVERVIEW_HEAD; ?>
                <?php echo TEXT_SITEMAPXML_OVERVIEW_TEXT; ?>
                <?php echo TEXT_SITEMAPXML_INSTRUCTIONS_HEAD; ?>
                <?php echo sprintf(TEXT_SITEMAPXML_INSTRUCTIONS_STEP1, "\"javascript:(void 0)\" class=\"splitPageLink\" onClick=\"javascript:window.open('" . zen_catalog_href_link('addon', 'module=' . FILENAME_SITEMAPXML) . "', 'sitemapGen', 'resizable=1,statusbar=5,width=700,height=400,top=0,left=50,scrollbars=yes')\""); ?>
                <?php echo sprintf(TEXT_SITEMAPXML_INSTRUCTIONS_STEP2, "\"javascript:(void 0)\" class=\"splitPageLink\" onClick=\"javascript:window.open('" . zen_catalog_href_link('addon', 'module=' . FILENAME_SITEMAPXML . '&genxml=no&ping=yes') . "', 'sitemapGen', 'resizable=1,statusbar=5,width=600,height=400,top=0,left=50,scrollbars=yes')\""); ?>
<!--
                <fieldset>
                  <legend><?php echo TEXT_SITEMAPXML_CHOOSE_CRAWLER; ?></legend>
                  <form name="pingSE" action="<?php echo zen_catalog_href_link(FILENAME_SITEMAPXML); ?>" method="get" id="pingSE" target="_blank" onsubmit="javascript:window.open('<?php echo zen_catalog_href_link(FILENAME_SITEMAPXML); ?>'+getFormFields(this), 'sitemapPing', 'resizable=1,statusbar=5,width=700,height=400,top=0,left=50,scrollbars=yes');return false;">
                    <?php echo zen_draw_hidden_field('genxml', 'no'); ?>
                    <label for="pingSE-Google"><?php echo 'Google'; ?></label>
                    <?php echo zen_draw_checkbox_field('pinggoogle', 'yes', true, '', 'id="pingSE-Google"'); ?>
                    <label for="pingSE-Yahoo"><?php echo 'Yahoo!'; ?></label>
                    <?php echo zen_draw_checkbox_field('pingyahoo', 'yes', true, '', 'id="pingSE-Yahoo"'); ?>
                    <label for="pingSE-Ask"><?php echo 'Ask.com'; ?></label>
                    <?php echo zen_draw_checkbox_field('pingask', 'yes', true, '', 'id="pingSE-Ask"'); ?>
                    <label for="pingSE-MS"><?php echo 'Microsoft'; ?></label>
                    <?php echo zen_draw_checkbox_field('pingms', 'yes', true, '', 'id="pingSE-MS"'); ?>
                    <br class="clearBoth" />
                    <?php echo zen_image_submit('button_send.gif', IMAGE_SEND); ?>
                  </form>
                </fieldset>
-->
                <div style="margin: 0px; text-align: left;" id="pingSEmessage">&nbsp;</div>
              </td>
              <td width="22%" align="right" valign="top">
                <table width="98%"  border="0" cellpadding="1" cellspacing="0" bgcolor="#E1EEFF">
                  <tr>
                    <td align="center" class="smallText"><?php echo TEXT_SITEMAPXML_LOGIN_HEAD; ?> </td>
                  </tr>
                  <tr>
                    <td class="smallText">
                      <table width="100%"  border="0" cellpadding="4" cellspacing="0" bgcolor="#F0F8FF">
                        <tr>
                          <td align="left" valign="top" class="smallText"><?php echo TEXT_SITEMAPXML_LOGIN; ?></td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
<!-- body_text_eof //-->
    </table>
    </td>
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
</body>
</html>
