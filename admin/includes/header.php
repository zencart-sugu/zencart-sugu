<?php
/**
 * @package admin
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: header.php 3405 2006-04-10 16:43:55Z drbyte $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
// $messageStack->add('REGISTERED GLOBALS ARE TURNED OFF IN .htaccess ','caution');

  $version_check_requested = (isset($_GET['vcheck']) && $_GET['vcheck']!='') ? true : false;

// Show Languages Dropdown for convenience only if main filename and directory exists
if ((basename($PHP_SELF) != FILENAME_DEFINE_LANGUAGE . '.php') and (basename($PHP_SELF) != FILENAME_PRODUCTS_OPTIONS_NAME . '.php') and empty($action)) {
  $languages = zen_get_languages();
  if (sizeof($languages) > 1) {
    $languages_array = array();
    $languages_selected = $_GET['language'];
    $missing_languages='';
    for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
      $test_directory= DIR_WS_LANGUAGES . $languages[$i]['directory'];
      $test_file= DIR_WS_LANGUAGES . $languages[$i]['directory'] . '.php';
      if ( file_exists($test_file) and file_exists($test_directory) ) {
        $count++;
        $languages_array[] = array('id' => $languages[$i]['code'],
                                 'text' => $languages[$i]['name']);
//        if ($languages[$i]['directory'] == $language) {
        if ($languages[$i]['directory'] == $_SESSION['language']) {
          $languages_selected = $languages[$i]['code'];
        }
      } else {
        $missing_languages .= ' ' . ucfirst($languages[$i]['directory']) . ' ' . $languages[$i]['name'];
      }
    }

// if languages in table do not match valid languages show error message
    if ($count != sizeof($languages)) {
      $messageStack->add('MISSING LANGUAGE FILES OR DIRECTORIES ...' . $missing_languages,'caution');
    }
    $hide_languages= false;
  } else {
    $hide_languages= true;
  } // more than one language
} else {
  $hide_languages= true;
} // hide when other language dropdown is used

// check database version against source code
  $zv_db_patch_ok = true; // we start with true
  if (WARN_DATABASE_VERSION_PROBLEM != 'false') {
    $result = $db->Execute("SELECT project_version_major, project_version_minor FROM " . TABLE_PROJECT_VERSION . " WHERE project_version_key = 'Zen-Cart Database'");
    $zv_db_patch_level_found = $result->fields['project_version_major']. '.' . $result->fields['project_version_minor'];
    $zv_db_patch_level_expected = EXPECTED_DATABASE_VERSION_MAJOR . '.' . EXPECTED_DATABASE_VERSION_MINOR;
    if ($zv_db_patch_level_expected=='.' || ($zv_db_patch_level_found < $zv_db_patch_level_expected) ) {
      $zv_db_patch_ok = false;
      $messageStack->add(WARNING_DATABASE_VERSION_OUT_OF_DATE, 'warning');
    }
  }

// Alerts for EZ-Pages
  if (EZPAGES_STATUS_HEADER == '2' and strstr(EXCLUDE_ADMIN_IP_FOR_MAINTENANCE, $_SERVER['REMOTE_ADDR'])) {
    $messageStack->add(TEXT_EZPAGES_STATUS_HEADER_ADMIN, 'caution');
  }
  if (EZPAGES_STATUS_FOOTER == '2' and strstr(EXCLUDE_ADMIN_IP_FOR_MAINTENANCE, $_SERVER['REMOTE_ADDR'])) {
    $messageStack->add(TEXT_EZPAGES_STATUS_FOOTER_ADMIN, 'caution');
  }
  if (EZPAGES_STATUS_SIDEBOX == '2' and strstr(EXCLUDE_ADMIN_IP_FOR_MAINTENANCE, $_SERVER['REMOTE_ADDR'])) {
    $messageStack->add(TEXT_EZPAGES_STATUS_SIDEBOX_ADMIN, 'caution');
  }

// check activity log size
  if (basename($PHP_SELF) == FILENAME_DEFAULT . '.php') {
    $show_admin_activity_log_link = false;

    $chk_admin_log = $db->Execute("select count(log_id) as counter from " . TABLE_ADMIN_ACTIVITY_LOG);
    if ($chk_admin_log->fields['counter'] > 0) {
      if ($chk_admin_log->fields['counter'] > 50000) {
        $show_admin_activity_log_link = true;
        $_SESSION['reset_admin_activity_log'] = true;
        $messageStack->add(WARNING_ADMIN_ACTIVITY_LOG_RECORDS . $chk_admin_log->fields['counter'], 'caution');
      }

      $chk_admin_log = $db->Execute("select min(access_date) as access_date from " . TABLE_ADMIN_ACTIVITY_LOG . " where access_date < DATE_SUB(CURDATE(),INTERVAL 60 DAY)");
      if (!empty($chk_admin_log->fields['access_date'])) {
        $show_admin_activity_log_link = true;
        $_SESSION['reset_admin_activity_log'] = true;
        $messageStack->add(WARNING_ADMIN_ACTIVITY_LOG_DATE . date('m-d-Y', strtotime($chk_admin_log->fields['access_date'])), 'caution');
      }
    }
  }

// display alerts/error messages, if any
  if ($messageStack->size > 0) {
    echo $messageStack->output();
  }

// check version with zen-cart server
  // ignore version-check if INI file setting has been set
  $version_from_ini = '';
  $version_ini_sysinfo = '';
  $version_ini_index_sysinfo = '';
  if (!isset($version_check_sysinfo)) $version_check_sysinfo = false;
  if (!isset($version_check_index))   $version_check_index = false;

  if (file_exists(DIR_FS_ADMIN . 'includes/local/skip_version_check.ini')) {
    $lines=@file(DIR_FS_ADMIN . 'includes/local/skip_version_check.ini');
    foreach($lines as $line) {
      if (substr(trim($line),0,14)=='version_check=') $version_from_ini=substr(trim(strtolower(str_replace('version_check=','',$line))),0,3);
      if (substr(trim($line),0,41)=='display_update_link_only_on_sysinfo_page=') $version_ini_sysinfo=trim(strtolower(str_replace('display_update_link_only_on_sysinfo_page=','',$line)));
      if (substr(trim($line),0,46)=='display_update_link_on_index_and_sysinfo_page=') $version_ini_index_sysinfo=trim(strtolower(str_replace('display_update_link_only_on_sysinfo_page=','',$line)));
    }
  }
  // ignore version check if not enabled or if not on main page or sysinfo page
  if ((SHOW_VERSION_UPDATE_IN_HEADER == 'true' && $version_from_ini !='off' && ($version_check_sysinfo==true || $version_check_index==true) && $zv_db_patch_ok == true) || $version_check_requested==true ) {
    $new_version = TEXT_VERSION_CHECK_CURRENT; //set to "current" by default
    $lines = @file(NEW_VERSION_CHECKUP_URL);
    //check for major/minor version info
    if ((trim($lines[0]) > PROJECT_VERSION_MAJOR) || (trim($lines[0]) == PROJECT_VERSION_MAJOR && trim($lines[1]) > PROJECT_VERSION_MINOR)) {
      $new_version = TEXT_VERSION_CHECK_NEW_VER . trim($lines[0]) . '.' . trim($lines[1]) . ' :: ' . $lines[2];
    }
    //check for patch version info
    // first confirm that we're at latest major/minor -- otherwise no need to check patches:
    if (trim($lines[0]) == PROJECT_VERSION_MAJOR && trim($lines[1]) == PROJECT_VERSION_MINOR) {
      //check to see if either patch needs to be applied
      if (trim($lines[3]) > intval(PROJECT_VERSION_PATCH1) || trim($lines[4]) > intval(PROJECT_VERSION_PATCH2)) {
        // reset update message, since we WILL be advising of an available upgrade
        if ($new_version == TEXT_VERSION_CHECK_CURRENT) $new_version = '';
        //check for patch #1
        if (trim($lines[3]) > intval(PROJECT_VERSION_PATCH1)) {
//          if ($new_version != '') $new_version .= '<br />';
          $new_version .= (($new_version != '') ? '<br />' : '') . '<span class="alert">' . TEXT_VERSION_CHECK_NEW_PATCH . trim($lines[0]) . '.' . trim($lines[1]) . ' - ' .TEXT_VERSION_CHECK_PATCH .': [' . trim($lines[3]) . '] :: ' . $lines[5] . '</span>';
        }
        if (trim($lines[4]) > intval(PROJECT_VERSION_PATCH2)) {
//          if ($new_version != '') $new_version .= '<br />';
          $new_version .= (($new_version != '') ? '<br />' : '') . '<span class="alert">' . TEXT_VERSION_CHECK_NEW_PATCH . trim($lines[0]) . '.' . trim($lines[1]) . ' - ' .TEXT_VERSION_CHECK_PATCH .': [' . trim($lines[4]) . '] :: ' . $lines[5] . '</span>';
        }
      }
    }
    // display download link
    if ($new_version != '' && $new_version != TEXT_VERSION_CHECK_CURRENT) $new_version .= '<br /><a href="' . $lines[6] . '" target="_blank">'. TEXT_VERSION_CHECK_DOWNLOAD .'</a>';
  } else {
    // display the "check for updated version" button.  The button link should be the current page and all param's
    $url=(isset($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : zen_href_link(FILENAME_DEFAULT);
    $url .= (strpos($url,'?')>5) ? '&vcheck=yes' : '?vcheck=yes';
    if ($zv_db_patch_ok == true || $version_check_sysinfo==true ) $new_version = '<a href="' . $url . '">' . zen_image_button('button_check_new_version.gif',IMAGE_CHECK_VERSION) . '</a>';
  }

// check GV release queue and alert store owner
  if (SHOW_GV_QUEUE==true) {
    $new_gv_queue= $db->Execute("select * from " . TABLE_COUPON_GV_QUEUE . " where release_flag='N'");
    $new_gv_queue_cnt = 0;
    if ($new_gv_queue->RecordCount() > 0) {
      $new_gv_queue_cnt= $new_gv_queue->RecordCount();
      $goto_gv = '<a href="' . zen_href_link(FILENAME_GV_QUEUE) . '">' . zen_image_button('button_gift_queue.gif',IMAGE_GIFT_QUEUE) . '</a>';
    }
  }
?>
<!-- All HEADER_ definitions in the columns below are defined in includes/languages/english.php //-->
<table border="0" width="100%" cellspacing="0" cellpadding="0" class="header">
<?php
// special spacing for alt_nav.php
  if (basename($PHP_SELF) == 'alt_nav.php') {
?>
<tr><td>&nbsp;</td></tr>
<?php } // alt_nav spacing ?>
  <tr>
    <td align="left" valign="top" height="<?php echo HEADER_LOGO_HEIGHT; ?>" width="<?php echo HEADER_LOGO_WIDTH; ?>"><?php echo '<a href="' . zen_href_link(FILENAME_DEFAULT) . '">' . zen_image(DIR_WS_IMAGES . HEADER_LOGO_IMAGE, HEADER_ALT_TEXT) . '</a>'; ?></td>
    <td colspan="2" align="left"><table width="100%"><tr>
    <td align="left" class="main" valign="top"><?php if ($new_gv_queue_cnt > 0) echo $goto_gv . '<br />' . sprintf(TEXT_SHOW_GV_QUEUE, $new_gv_queue_cnt); ?></td>
<?php
  if (isset($_SESSION['reset_admin_activity_log']) and ($_SESSION['reset_admin_activity_log'] == true and (basename($PHP_SELF) == FILENAME_DEFAULT . '.php'))) {
?>
    <td align="center" class="main" valign="top"><?php echo '<a href="' . zen_href_link(FILENAME_STORE_MANAGER) . '">' . zen_image_button('button_reset.gif', RESET_ADMIN_ACTIVITY_LOG) . '<br />' . RESET_ADMIN_ACTIVITY_LOG . '</a>'; ?></td>
<?php
  }
?>
<?php
  if ($new_version) {
?>
    <td align="right" class="main" valign="top"><?php echo $new_version; ?></td>
<?php
  }
?>
    </tr></table></td>
  </tr>
</table>
<table border="0" cellspacing="0" cellpadding="0" width="100%">
  <tr class="headerBar" height="20" width="100%">

    <td class="headerBarContent" align="left">
      <?php
      if (!$hide_languages) {
        echo zen_draw_form('languages', basename($PHP_SELF), '', 'get');
        echo DEFINE_LANGUAGE . '&nbsp;&nbsp;' . (sizeof($languages) > 1 ? zen_draw_pull_down_menu('language', $languages_array, $languages_selected, 'onChange="this.form.submit();"') : '');
        echo zen_hide_session_id();
        echo '</form>';
      } else {
        echo '&nbsp;';
      }
    ?>
    </td>
    <td class="headerBarContent" align="center"><b><?php echo date("r", time()) . 'GMT'  . '&nbsp;[' .  $_SERVER['REMOTE_ADDR'] . ' ]&nbsp;'; ?></b></td>
    <td class="headerBarContent" align="right"><?php echo '<a href="' . zen_href_link(FILENAME_DEFAULT, '', 'NONSSL') . '" class="headerLink">' . HEADER_TITLE_TOP . '</a>&nbsp;|&nbsp;<a href="' . zen_catalog_href_link() . '" class="headerLink" target="_blank">' . HEADER_TITLE_ONLINE_CATALOG . '</a>&nbsp;|&nbsp;<a href="http://www.zen-cart.com/" class="headerLink" target="_blank">' . HEADER_TITLE_SUPPORT_SITE . '</a>&nbsp;|&nbsp;<a href="http://www.zen-cart.jp/" class="headerLink">' . HEADER_TITLE_SUPPORT_SITE_JP . '</a>&nbsp;|&nbsp;<a href="' . zen_href_link(FILENAME_SERVER_INFO) . '" class="headerLink">' . HEADER_TITLE_VERSION . '</a>&nbsp;|&nbsp;<a href="' . zen_href_link(FILENAME_LOGOFF) . '" class="headerLink">' . HEADER_TITLE_LOGOFF . '</a>&nbsp;'; ?></td>
  </tr>
</table>
<?php require(DIR_WS_INCLUDES . 'header_navigation.php'); ?>
