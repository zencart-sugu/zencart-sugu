<?php
/**
 * @package Installer
 * @access private
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: database_upgrade_default.php 3717 2006-06-06 08:20:45Z drbyte $
 */

?>
<h1>:: <?php echo PAGE_HEADING; ?></h1>
<p><?php echo TEXT_MAIN; ?></p>
<?php
  if ($zc_install->error) include(DIR_WS_INSTALL_TEMPLATE . 'templates/display_errors.php');
?>
    <form method="post" action="index.php?main_page=database_upgrade<?php if (isset($_GET['language'])) { echo '&amp;language=' . $_GET['language']; } ?>">
<?php if ($dbinfo->zdb_configuration_table_found) { ?>
<p><?php echo TEXT_MAIN_2; ?></p>
    <fieldset>
    <legend><?php echo DATABASE_INFORMATION . ' -- &nbsp;<strong>' . SNIFFER_PREDICTS . $sniffer . '</strong>'; ?></legend>
      <div class="section">
        <label><?php echo '<a href="javascript:popupWindow(\'popup_help_screen.php?error_code=14\')"> ' . DATABASE_TYPE. '</a>'; ?></label>
      <?php echo '&nbsp;=&nbsp;' . DB_TYPE; ?>
    </div>
    <div class="section">
      <label><?php echo '<a href="javascript:popupWindow(\'popup_help_screen.php?error_code=15\')"> ' . DATABASE_HOST . '</a>'; ?></label>
      <?php echo '&nbsp;=&nbsp;' . DB_SERVER; ?>
    </div>
    <div class="section">
      <label><?php echo '<a href="javascript:popupWindow(\'popup_help_screen.php?error_code=18\')"> ' . DATABASE_NAME . '</a>'; ?></label>
      <?php echo '&nbsp;=&nbsp;' . DB_DATABASE; ?>
    </div>
    <div class="section">
      <label><?php echo '<a href="javascript:popupWindow(\'popup_help_screen.php?error_code=16\')"> ' . DATABASE_USERNAME . '</a>'; ?></label>
      <?php echo '&nbsp;=&nbsp;' . DB_SERVER_USERNAME; ?>
    </div>
    <div class="section">
      <label><?php echo '<a href="javascript:popupWindow(\'popup_help_screen.php?error_code=19\')"> ' . DATABASE_PREFIX . '</a>'; ?></label>
      <?php echo '&nbsp;=&nbsp;' . DB_PREFIX; ?>
    </div>
    <div class="section">
      <label><?php echo '<a href="javascript:popupWindow(\'popup_help_screen.php?error_code=87\')"> ' . DATABASE_PRIVILEGES . '</a>'; ?></label>
      <?php echo '&nbsp;=&nbsp;' . $zdb_privs; ?>
    </div>
    </fieldset>
    <br />

    <fieldset>
    <legend><strong><?php echo CHOOSE_UPGRADES; ?></strong></legend>
      <div class="input">
      <input <?php if ($needs_v1_1_0) {echo "checked";} ?> name="version[]" type="checkbox" id="checkbox1" value="1.0.4"  tabindex="1" />
      <label for="checkbox1">Upgrade DB from 1.0.4 to 1.1.1</label>
    </div>
      <div class="input">
      <input <?php if ($needs_v1_1_1) {echo "checked";} ?> name="version[]" type="checkbox" id="checkbox2" value="1.1.0" tabindex="2" />
      <label for="checkbox2">Upgrade DB from 1.1.0 to 1.1.1</label>
    </div>
      <div class="input">
      <input <?php if ($needs_v1_1_2) {echo "checked";} ?> name="version[]" type="checkbox" id="checkbox3" value="1.1.1" tabindex="3" />
      <label for="checkbox3">Upgrade DB from 1.1.1 to 1.1.2</label>
    </div>
      <div class="input">
      <input <?php if ($needs_v1_1_4) {echo "checked";} ?> name="version[]" type="checkbox" id="checkbox4" value="1.1.2-or-1.1.3" tabindex="4" />
      <label for="checkbox4">Upgrade DB from 1.1.2 or 1.1.3 to 1.1.4</label>
    </div>
      <div class="input">
      <input <?php if ($needs_v1_1_4_patch1) {echo "checked";} ?> name="version[]" type="checkbox" id="checkbox5" value="1.1.4" tabindex="5" />
      <label for="checkbox5">Upgrade DB from 1.1.4 to 1.1.4-patch1</label>
    </div>
      <div class="input">
      <input <?php if ($needs_v1_2_0) {echo "checked";} ?> name="version[]" type="checkbox" id="checkbox6" value="1.1.4u" tabindex="6" />
      <label for="checkbox6">Upgrade DB from 1.1.4-x to 1.2.0</label>
    </div>
      <div class="input">
      <input <?php if ($needs_v1_2_0_l10n_jp_3) {echo "checked";} ?> name="version[]" type="checkbox" id="checkbox6" value="1.2.0jp" tabindex="6" />
      <label for="checkbox6">Upgrade DB from 1.2.0-l10n-jp-1 or 1.2.0-l10n-jp-2 to 1.2.0-l10n-jp-3</label>
    </div>
      <div class="input">
      <input <?php if ($needs_v1_2_1) {echo "checked";} ?> name="version[]" type="checkbox" id="checkbox7" value="1.2.0" tabindex="7" />
      <label for="checkbox7">Upgrade DB from 1.2.0 to 1.2.1</label>
    </div>
      <div class="input">
      <input <?php if ($needs_v1_2_2) {echo "checked";} ?> name="version[]" type="checkbox" id="checkbox8" value="1.2.1" tabindex="8" />
      <label for="checkbox8">Upgrade DB from 1.2.1 to 1.2.2</label>
    </div>
      <div class="input">
      <input <?php if ($needs_v1_2_3) {echo "checked";} ?> name="version[]" type="checkbox" id="checkbox9" value="1.2.2" tabindex="9" />
      <label for="checkbox9">Upgrade DB from 1.2.2 to 1.2.3</label>
    </div>
      <div class="input">
      <input <?php if ($needs_v1_2_4) {echo "checked";} ?> name="version[]" type="checkbox" id="checkbox10" value="1.2.3" tabindex="10" />
      <label for="checkbox10">Upgrade DB from 1.2.3 to 1.2.4</label>
    </div>
      <div class="input">
      <input <?php if ($needs_v1_2_5) {echo "checked";} ?> name="version[]" type="checkbox" id="checkbox11" value="1.2.4" tabindex="11" />
      <label for="checkbox11">Upgrade DB from 1.2.4 to 1.2.5</label>
    </div>
      <div class="input">
      <input <?php if ($needs_v1_2_6) {echo "checked";} ?> name="version[]" type="checkbox" id="checkbox12" value="1.2.5" tabindex="12" />
      <label for="checkbox12">Upgrade DB from 1.2.5 to 1.2.6</label>
    </div>
      <div class="input">
      <input <?php if ($needs_v1_2_7) {echo "checked";} ?> name="version[]" type="checkbox" id="checkbox13" value="1.2.6" tabindex="13" />
      <label for="checkbox13">Upgrade DB from 1.2.6 to 1.2.7</label>
    </div>
      <div class="input">
      <input <?php if ($needs_v1_3_0) {echo "checked";} ?> name="version[]" type="checkbox" id="checkbox14" value="1.2.7" tabindex="14" />
      <label for="checkbox14">Upgrade DB from 1.2.7 to 1.3.0</label>
    </div>
      <div class="input">
      <input <?php if ($needs_v1_3_0_1) {echo "checked";} ?> name="version[]" type="checkbox" id="checkbox15" value="1.3.0" tabindex="15" />
      <label for="checkbox15">Upgrade DB from 1.3.0 to 1.3.0.1</label>
    </div>
      <div class="input">
      <input <?php if ($needs_v1_3_0_2) {echo "checked";} ?> name="version[]" type="checkbox" id="checkbox16" value="1.3.0.1" tabindex="16" />
      <label for="checkbox16">Upgrade DB from 1.3.0.1 to 1.3.0.2</label>
    </div>
      <div class="input">
      <input <?php if ($needs_v1_3_0_2_jp_1_from_v1_2_0_0_jp_3) {echo "checked";} ?> name="version[]" type="checkbox" id="checkbox17" value="1.3.0.2jpfrom1.2.0jp3" tabindex="17" />
      <label for="checkbox17">1.2.0-l10n-jp-3から1.3.0.2-l10n-jp-1までの日本独自のDBの改修</label>
    </div>
      <div class="input">
      <input <?php if ($needs_v1_3_0_2_jp_1_from_v1_3_0_2) {echo "checked";} ?> name="version[]" type="checkbox" id="checkbox18" value="1.3.0.2jpfrom1.3.0.2" tabindex="18" />
      <label for="checkbox18">1.3.0.2英語版のから1.3.0.2-l10n-jp-1へのDBアップグレード</label>
    </div>

    </fieldset>
    <br />
<?php } //endif $dbinfo->zdb_configuration_table_found ?>


    <fieldset>
    <legend><strong><?php echo TITLE_DATABASE_PREFIX_CHANGE; ?></strong></legend>
<?php if (!$dbinfo->zdb_configuration_table_found) { ?>
      <?php echo ERROR_PREFIX_CHANGE_NEEDED; ?><br /><br />
      <div class="section">
        <input type="text" id="db_prefix" name="db_prefix" tabindex="40" value="<?php echo DB_PREFIX; ?>" />
        <label for="db_prefix"><?php echo DATABASE_OLD_PREFIX; ?></label>
        <p><?php echo DATABASE_OLD_PREFIX_INSTRUCTION; ?></p>
      </div>
<?php } else { // end of display field to enter "old" prefix if couldn't connect to database before ?>
      <?php echo TEXT_DATABASE_PREFIX_CHANGE; ?><br /><br />
<?php } // display normal heading ?>
      <div class="section">
      <input type="text" id="newprefix" name="newprefix" tabindex="41" value="<?php echo DB_PREFIX; ?>" />
      <label for="newprefix"><?php echo ENTRY_NEW_PREFIX; ?></label>
        <p><?php echo DATABASE_NEW_PREFIX_INSTRUCTION .'&nbsp; <a href="javascript:popupWindow(\'popup_help_screen.php?error_code=19\')"> ' . TEXT_HELP_LINK . '</a>'; ?></p>
      <?php echo TEXT_DATABASE_PREFIX_CHANGE_WARNING; ?><br /><br />
    </div>
    </fieldset>
<br />

    <fieldset>
    <legend><strong><?php echo TITLE_SECURITY; ?></strong></legend>
      <?php echo ADMIN_PASSSWORD_INSTRUCTION .'&nbsp; <a href="javascript:popupWindow(\'popup_help_screen.php?error_code=78\')"> ' . TEXT_HELP_LINK . '</a>'; ?> <br /><br />
     <div class="section">
      <input type="text" id="adminid" name="adminid" tabindex="50" size="18" value="<?php echo $_POST['adminid']; ?>" />
      <label for="adminid"><?php echo ENTRY_ADMIN_ID; ?></label>
     <div class="section">
    </div>
      <input type="password" id="adminpwd" name="adminpwd" tabindex="51" />
      <label for="adminpwd"><?php echo ENTRY_ADMIN_PASSWORD; ?></label>
    <br />
    </div>

    </fieldset>

    <br />&nbsp;&nbsp;<?php echo UPDATE_DATABASE_WARNING_DO_NOT_INTERRUPT; ?>&nbsp;
<?php if (isset($_GET['debug'])) echo '<input type="hidden" id="debug" name="debug" value="'.$_GET['debug'].'" />'; ?>
<?php if (isset($_GET['debug2'])) echo '<input type="hidden" id="debug2" name="debug2" value="'.$_GET['debug2'].'" />'; ?>
<?php if (isset($_GET['debug3'])) echo '<input type="hidden" id="debug3" name="debug3" value="'.$_GET['debug3'].'" />'; ?>
<?php if (isset($_GET['nogrants'])) echo '<input type="hidden" id="nogrants" name="nogrants" value="'.$_GET['nogrants'].'" />'; ?>
<?php if (isset($_POST['nogrants'])) echo '<input type="hidden" id="nogrants" name="nogrants" value="'.$_POST['nogrants'].'" />'; ?>
    <input type="submit" name="submit" class="button"  tabindex="60" value="<?php echo UPDATE_DATABASE_NOW; ?>" />
<?php if ($dbinfo->zdb_configuration_table_found) { ?>
    <input type="submit" name="skip" class="button"  tabindex="61" value="<?php echo SKIP_UPDATES; ?>" />
<?php } //endif ?>
    </form>
