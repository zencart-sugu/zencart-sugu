<?php
/**
 * @package Installer
 * @access private
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: display_errors.php 3824 2006-06-21 17:07:09Z drbyte $
 */

?><fieldset>
<legend><?php echo TEXT_ERROR_WARNING; ?></legend>
<div id="errorInformation">
<?php if ($_GET['main_page'] != 'database_upgrade') { ?>
  <div id="stopsign">
    <img src="includes/templates/template_default/images/stop.gif" border="0" alt="ERROR - Cannot proceed until problems are resolved." />
  </div>
<?php } ?>
  <div id="error">
    <ul>
<?php
  foreach ($zc_install->error_array as $za_errors ) {
    echo '      <li class="' . (strstr($za_errors['text'],'kipped upgrade statements') ? 'WARN' : 'FAIL') . '">' . $za_errors['text'] . '<a href="javascript:popupWindow(\'popup_help_screen.php?error_code=' . $za_errors['code'] . '\')"> ' . TEXT_HELP_LINK . '</a></li>' . "\n";
  }
?>
    </ul>
  </div>
</div>
</fieldset>
  
<br /><br />