<?php
/**
 * @package Installer
 * @access private
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: phpbb_setup_default.php 3173 2006-03-12 03:21:07Z drbyte $
 */
?>
<h1>:: <?php echo TEXT_PAGE_HEADING; ?></h1>
<p><?php echo TEXT_MAIN; ?></p>
<?php
  if ($zc_install->error) include(DIR_WS_INSTALL_TEMPLATE . 'templates/display_errors.php');
?>

    <form method="post" action="index.php?main_page=phpbb_setup&physical_path=<?php echo $_GET['physical_path']; ?>&physical_https_path=<?php echo $_GET['physical_https_path']; ?>&virtual_http_path=<?php echo $_GET['virtual_http_path']; ?>&virtual_https_path=<?php echo $_GET['virtual_https_path']; ?>&virtual_https_server=<?php echo $_GET['virtual_https_server']; ?>&enable_ssl=<?php echo $_GET['enable_ssl']; ?>&enable_ssl_admin=<?php echo $_GET['enable_ssl_admin']; ?>&sql_cache=<?php echo $_GET['sql_cache']; ?>&is_upgrade=<?php echo $_GET['is_upgrade']; ?>&use_phpbb=<?php echo $_POST['phpbb_use']; ?><?php if (isset($_GET['language'])) { echo '&amp;language=' . $_GET['language']; } ?>">
	  <fieldset>
	  <legend><?php echo PHPBB_INFORMATION; ?></legend>

		<div class="section">
		  <div class="input">
		    <input type="radio" name="phpbb_use" id="phpbb_use_yes" tabindex="1" value="true" <?php echo PHPBB_USE_TRUE; ?>/>
		    <label for="phpbb_use_yes"><?php echo YES; ?></label>
		    <input type="radio" name="phpbb_use" id="phpbb_use_no" tabindex="2" value="false" <?php echo PHPBB_USE_FALSE; ?>/>
		    <label for="phpbb_use_no"><?php echo NO; ?></label>
		  </div>
		  <span class="label"><?php echo PHPBB_USE; ?></span>
		  <p><?php echo PHPBB_USE_INSTRUCTION. '<a href="javascript:popupWindow(\'popup_help_screen.php?error_code=64\')"> ' . TEXT_HELP_LINK . '</a>'; ?></p>
		</div>


		<div class="section">
		  <input type="text" id="phpbb_dir" name="phpbb_dir" tabindex="3" value="<?php echo PHPBB_DIR_VALUE; ?>" size="35" />
		  <label for="phpbb_dir"><?php echo PHPBB_DIR; ?></label>
		  <p><?php echo PHPBB_DIR_INSTRUCTION. '<a href="javascript:popupWindow(\'popup_help_screen.php?error_code=67\')"> ' . TEXT_HELP_LINK . '</a>'; ?></p>
		</div>
    </fieldset>
	  <input type="submit" name="submit" class="button" tabindex="4" value="<?php echo SAVE_PHPBB_SETTINGS; ?>" />
    </form>