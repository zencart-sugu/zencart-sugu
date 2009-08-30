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
//  $Id: define_pages_editor.php 3233 2006-03-21 09:37:38Z drbyte $
//

  require('includes/application_top.php');

  function zen_display_files() {
    global $check_directory, $found, $configuration_key_lookup;
    for ($i = 0, $n = sizeof($check_directory); $i < $n; $i++) {
//echo 'I SEE ' . $check_directory[$i] . '<br>';

      $dir_check = $check_directory[$i];
      $file_extension = '.php';

      if ($dir = @dir($dir_check)) {
        while ($file = $dir->read()) {
          if (!is_dir($dir_check . $file)) {
            if (substr($file, strrpos($file, '.')) == $file_extension) {
              $directory_array[] = $file;
            }
          }
        }
        if (sizeof($directory_array)) {
          sort($directory_array);
        }
        $dir->close();
      }
    }
    return $directory_array;
  }

  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  $za_who = $_GET['za_lookup'];

  if ($action == 'new_page') {
    $page = $_GET['define_it'];

    $check_directory = array();
    $check_directory[] = DIR_FS_CATALOG . DIR_WS_LANGUAGES . $_SESSION['language'] . '/html_includes/';
    $directory_files = zen_display_files();

    $za_lookup = array();
    for ($i = 0, $n = sizeof($directory_files); $i < $n; $i++) {
      $za_lookup[] = array('id' => $i, 'text' => $directory_files[$i]);
    }

// This will cause it to look for 'define_conditions.php'
    $_GET['filename'] = $za_lookup[$page]['text'];
    $_GET['box_name'] = BOX_TOOLS_DEFINE_CONDITIONS;
  }

// define template specific file name defines
  $file = zen_get_file_directory(DIR_FS_CATALOG_LANGUAGES . $_SESSION['language'] . '/html_includes/', $_GET['filename'], 'false');
?>
<?php
  switch ($_GET['action']) {
      case 'set_editor':
        if ($_GET['reset_editor'] == '0') {
          $_SESSION['html_editor_preference_status'] = 'NONE';
        } else {
          $_SESSION['html_editor_preference_status'] = 'HTMLAREA';
        }
        $action='';
        zen_redirect(zen_href_link(FILENAME_DEFINE_PAGES_EDITOR));
        break;
    case 'save':
      if ( ($_GET['lngdir']) && ($_GET['filename']) ) {
        if (file_exists($file)) {
          if (file_exists('bak' . $file)) {
            @unlink('bak' . $file);
          }
          @rename($file, 'bak' . $file);
          $new_file = fopen($file, 'w');
          $file_contents = stripslashes($_POST['file_contents']);
          fwrite($new_file, $file_contents, strlen($file_contents));
          fclose($new_file);
        }
        zen_redirect(zen_href_link(FILENAME_DEFINE_PAGES_EDITOR));
      }
      break;
  }

  if (!$_SESSION['language']) $_SESSION['language'] = $language;

  $languages_array = array();
  $languages = zen_get_languages();
  $lng_exists = false;
  for ($i=0; $i<sizeof($languages); $i++) {
    if ($languages[$i]['directory'] == $_SESSION['language']) $lng_exists = true;

    $languages_array[] = array('id' => $languages[$i]['directory'],
                               'text' => $languages[$i]['name']);
  }
  if (!$lng_exists) $_SESSION['language'] = $language;
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
  if (typeof _editor_url == "string") HTMLArea.replaceAll();
  }
  // -->
</script>
<?php if ($_SESSION['html_editor_preference_status']=="FCKEDITOR") include (DIR_WS_INCLUDES.'fckeditor.php'); ?>
<?php if ($_SESSION['html_editor_preference_status']=="HTMLAREA")  include (DIR_WS_INCLUDES.'htmlarea.php'); ?>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF" onLoad="init()">
<div id="spiffycalendar" class="text"></div>
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td class="pageHeading"><?php echo HEADING_TITLE . '&nbsp;' . $_SESSION['language']; ?> &nbsp;&nbsp;
          <?php
            $check_directory = array();
            $check_directory[] = DIR_FS_CATALOG . DIR_WS_LANGUAGES . $_SESSION['language'] . '/html_includes/';
            $directory_files = zen_display_files();

            $za_lookup = array();
            $za_lookup[] = array('id' => -1, 'text' => TEXT_INFO_SELECT_FILE);

            for ($i = 0, $n = sizeof($directory_files); $i < $n; $i++) {
              $za_lookup[] = array('id' => $i, 'text' => $directory_files[$i]);
            }

            echo zen_draw_form('new_page', FILENAME_DEFINE_PAGES_EDITOR, '', 'get') . '&nbsp;&nbsp;' . zen_draw_pull_down_menu('define_it', $za_lookup, '-1', 'onChange="this.form.submit();"') .
            zen_hide_session_id() . 
            zen_draw_hidden_field('action', 'new_page') . '&nbsp;&nbsp;</form>';
          ?>
<?php
// toggle switch for editor
        $editor_array = array(array('id' => '0', 'text' => TEXT_NONE),
                              array('id' => '1', 'text' => TEXT_HTML_AREA));
        echo TEXT_EDITOR_INFO . zen_draw_form('set_editor_form', FILENAME_DEFINE_PAGES_EDITOR, '', 'get') . '&nbsp;&nbsp;' . zen_draw_pull_down_menu('reset_editor', $editor_array, ($_SESSION['html_editor_preference_status'] == 'HTMLAREA' ? '1' : '0'), 'onChange="this.form.submit();"') .
        zen_hide_session_id() . 
        zen_draw_hidden_field('action', 'set_editor') .
        '</form>';
?>
        </td>
      </tr>
<?php
// show editor
if (isset($_GET['filename'])) {
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
  if ( ($_SESSION['language']) && ($_GET['filename']) ) {
    if (file_exists($file)) {
      $file_array = @file($file);
      $file_contents = @implode('', $file_array);

      $file_writeable = true;
      if (!is_writeable($file)) {
        $file_writeable = false;
        $messageStack->reset();
        $messageStack->add(sprintf(ERROR_FILE_NOT_WRITEABLE, $file), 'error');
        echo $messageStack->output();
      }

?>
              <tr>
            <td class="main"><b><?php echo TEXT_INFO_CAUTION . '<br /><br />' . TEXT_INFO_EDITING . '<br />' . $file . '<br />'; ?></b></td>
              </tr>
          <tr><?php echo zen_draw_form('language', FILENAME_DEFINE_PAGES_EDITOR, 'lngdir=' . $_SESSION['language'] . '&filename=' . $_GET['filename'] . '&action=save'); ?>
            <td><table border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main">
				<?php if (is_null($_SESSION['html_editor_preference_status'])) echo TEXT_HTML_EDITOR_NOT_DEFINED; ?>
				<?php if ($_SESSION['html_editor_preference_status']=="FCKEDITOR") {
					$oFCKeditor = new FCKeditor ;
					$oFCKeditor->Value = $file_contents ;
					$oFCKeditor->CreateFCKeditor( 'file_contents', '700', '400' ) ;  //instanceName, width, height (px or %)
					} else { // using HTMLAREA or just raw "source"
					echo zen_draw_textarea_field('file_contents', 'soft', '100%', '25', $file_contents, (($file_writeable) ? '' : 'readonly') . ' id="file_contents"');
					} ?>
				</td>
              </tr>
              <tr>
                <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
              </tr>
              <tr>
                <td align="right"><?php if ($file_writeable) { echo zen_image_submit('button_save.gif', IMAGE_SAVE) . '&nbsp;<a href="' . zen_href_link(FILENAME_DEFINE_PAGES_EDITOR, 'define_it=' .$_GET['define_it'] . '&action=new_page') . '">' . zen_image_button('button_reset.gif', IMAGE_RESET) . '</a>' . '&nbsp;' . '<a href="' . zen_href_link(FILENAME_DEFINE_PAGES_EDITOR . '.php') . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>'; } else { echo '<a href="' . zen_href_link(FILENAME_DEFINE_PAGES_EDITOR, 'lngdir=' . $_SESSION['language']) . '">' . zen_image_button('button_back.gif', IMAGE_BACK) . '</a>'; } ?></td>
              </tr>
            </table></td>
          </form></tr>
<?php
    } else {
?>
          <tr>
            <td class="main"><b><?php echo sprintf(TEXT_FILE_DOES_NOT_EXIST, $file); ?></b></td>
          </tr>
          <tr>
            <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
          <tr>
            <td><?php echo '<a href="' . zen_href_link($_GET['filename'], 'lngdir=' . $_SESSION['language']) . '">' . zen_image_button('button_back.gif', IMAGE_BACK) . '</a>'; ?></td>
          </tr>
<?php
    }
  } else {
    $filename = $_SESSION['language'] . '.php';
?>
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="smallText"><a href="<?php echo zen_href_link($_GET['filename'], 'lngdir=' . $_SESSION['language'] . '&filename=' . $filename); ?>"><b><?php echo $filename; ?></b></a></td>
<?php
    $dir = dir(DIR_FS_CATALOG_LANGUAGES . $_SESSION['language']);
    $left = false;
    if ($dir) {
      $file_extension = substr($PHP_SELF, strrpos($PHP_SELF, '.'));
      while ($file = $dir->read()) {
        if (substr($file, strrpos($file, '.')) == $file_extension) {
          echo '                <td class="smallText"><a href="' . zen_href_link($_GET['filename'], 'lngdir=' . $_SESSION['language'] . '&filename=' . $file) . '">' . $file . '</a></td>' . "\n";
          if (!$left) {
            echo '              </tr>' . "\n" .
                 '              <tr>' . "\n";
          }
          $left = !$left;
        }
      }
      $dir->close();
    }
?>

              </tr>
            </table></td>
          </tr>
<?php
  }
?>
        </table></td>
<?php } // filename ?>
      </tr>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br />
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
