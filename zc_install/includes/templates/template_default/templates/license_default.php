<?php
/**
 * @package Installer
 * @access private
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: license_default.php 3173 2006-03-12 03:21:07Z drbyte $
 */

?>
<h1>:: <?php echo TEXT_PAGE_HEADING; ?></h1>
<p><?php echo TEXT_MAIN; ?></p>
<?php
  if ($zc_install->error) include(DIR_WS_INSTALL_TEMPLATE . 'templates/display_errors.php');
?>
<?php if ($language == 'japanese') { ?>
<iframe src="includes/templates/template_default/templates/gpl_license.japanese.txt"></iframe>
<?php } else { ?>
<iframe src="includes/templates/template_default/templates/gpl_license.html"></iframe>
<?php } ?>
<form method="post" action="index.php?main_page=license<?php if (isset($_GET['language'])) { echo '&amp;language=' . $_GET['language']; } ?>">
  <input type="radio" name="license_consent" id="agree" value="agree" />
  <label for="agree"><?php echo AGREE; ?></label><br />
  <input type="radio" name="license_consent" id="disagree" checked="checked" value="disagree" />
  <label for="disagree"><?php echo DISAGREE; ?></label><br />
  <input type="submit" name="submit" class="button" value="<?php echo INSTALL; ?>" />
</form>
