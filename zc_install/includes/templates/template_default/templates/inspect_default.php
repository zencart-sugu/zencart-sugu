<?php
/**
 * @package Installer
 * @access private
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: inspect_default.php 3824 2006-06-21 17:07:09Z drbyte $
 */

?>
<h1>:: <?php echo TEXT_PAGE_HEADING; ?></h1>
<p><?php echo TEXT_MAIN; ?></p>
<?php
  if ($zc_install->error) include(DIR_WS_INSTALL_TEMPLATE . 'templates/display_errors.php');
?>
<form method="post" action="index.php?main_page=inspect<?php if (isset($_GET['language'])) { echo '&amp;language=' . $_GET['language']; } ?>">

<?php if ($zen_cart_previous_version_installed == true) { ?>
<fieldset>
<legend><strong><?php echo UPGRADE_DETECTION; ?></strong></legend>
<div class="section"><br />
 <strong><?php echo LABEL_PREVIOUS_INSTALL_FOUND; ?></strong><br />
 <?php echo $zdb_version_message; ?>
 </div></fieldset>
 <br />
<?php } ?>
<fieldset>
<legend><strong><?php echo SYSTEM_INSPECTION_RESULTS; ?></strong></legend>
<div class="section"><ul class="inspect-list">
<?php foreach ($status_check as $val) { ?>
   <li class='<?php echo $val['Class']; ?>'><strong><?php echo $val['Title']; ?></strong> = <?php echo $val['Status']; ?>
<?php if ($val['HelpURL']!='' && ($val['Class'] == 'FAIL' || $val['Class'] == 'WARN') ) {
    echo '&nbsp; ' . '<a class="nowrap" href="javascript:popupWindow(\'popup_help_screen.php?error_code=' . $val['HelpURL'] . '\')"> ';
//    echo (zen_not_null($val['HelpLabel'])) ? $val['HelpLabel'] : LABEL_EXPLAIN ;
    echo LABEL_EXPLAIN ;
    echo '</a>';
    } ?>
</li>
<?php } //end foreach?>

<!--
<br />
 <li><strong><?php //echo LABEL_PHP_MODULES; ?></strong><br/>
   <ul>
   <?php //foreach($php_extensions as $module) { echo '<li>' . $module .'</li>'; } ?>
   </ul></li>
-->
</ul>
<br /><a class="button" href="javascript:popupWindowLrg('includes/phpinfo.php')"><?php echo VIEW_PHP_INFO_LINK_TEXT; ?></a>
</div>
</fieldset>

<fieldset>
<legend><strong><?php echo OTHER_INFORMATION; ?></strong></legend>
<div class="section"><?php echo OTHER_INFORMATION_DESCRIPTION; ?><ul class="inspect-list">
<?php foreach ($status_check2 as $val) { ?>
   <li class='<?php echo $val['Class']; ?>'><strong><?php echo $val['Title']; ?></strong> = <?php echo $val['Status']; ?>
<?php if ($val['HelpURL']!='' && ($val['Class'] == 'FAIL' || $val['Class'] == 'WARN') ) {
    echo '&nbsp; ' . '<a class="nowrap" href="javascript:popupWindow(\'popup_help_screen.php?error_code=' . $val['HelpURL'] . '\')"> ';
//    echo (zen_not_null($val['HelpLabel'])) ? $val['HelpLabel'] : LABEL_EXPLAIN ;
    echo LABEL_EXPLAIN ;
    echo '</a>';
    } ?>
</li>
<?php } //end foreach?>
</ul>
</div>
</fieldset>

<fieldset>
<legend><strong><?php echo LABEL_FOLDER_PERMISSIONS; ?></strong></legend>
<div class='section'>
<?php echo LABEL_WRITABLE_FOLDER_INFO; ?>
<ul class="inspect-list">
<?php foreach ($file_status as $val) { ?>
   <li class='<?php echo $val['class']; ?>'><strong><?php echo $val['file']; ?></strong> = 
   <?php echo $val['exists'] . $val['writable']; ?>
   </li>
<?php } //end foreach?>
<li>&nbsp;</li>
<?php foreach ($folder_status as $val) { ?>
   <li class='<?php echo $val['class']; ?>'><strong><?php echo $val['folder']; ?></strong> = 
   <?php echo $val['writable']; ?>
   <?php echo ($val['writable']==UNWRITABLE)?'&nbsp;&nbsp;(chmod '.$val['chmod'] . ')' : ''; ?>
   </li>
<?php } //end foreach?>
</ul>
</div>
</fieldset>

<input type="submit" name="submit" class="button" tabindex="8" value="<?php echo INSTALL_BUTTON; ?>" <?php echo $button_status;?> />
<?php if ($zen_cart_previous_version_installed == true) { ?>
<input type="submit" name="upgrade" class="button" tabindex="9" value="<?php echo UPGRADE_BUTTON; ?>" <?php echo $button_status;?> />
<?php } ?>
<?php if ($zen_cart_allow_database_upgrade == true) { ?>
<input type="submit" name="db_upgrade" class="button" tabindex="10" value="<?php echo DB_UPGRADE_BUTTON; ?>" <?php echo $button_status_upg;?> />
<?php } ?>
<input type="submit" name="refresh" class="button" tabindex="11" value="<?php echo REFRESH_BUTTON; ?>" />
</form>
