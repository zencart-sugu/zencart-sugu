<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=create-account_success.<br />
 * Displays confirmation that a new account has been created.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_create_account_success_default.php 2540 2005-12-11 07:55:22Z birdbrain $
 */
?>
<?php
// -> zen_smartphone: div は必要なし
/*
<div class="centerColumn" id="createAcctSuccess">
*/
?>

<?php
// -> zen_smartphone: h1 は toolbar を使う
/*
<h1 id="createAcctSuccessHeading"><?php echo HEADING_TITLE; ?></h1>
*/
?>
<div class="toolbar"><h1><?php echo HEADING_TITLE; ?></h1></div>
<a class="back" href="#">cancel</a>
<?php
// <- zen_smartphone: h1 は toolbar を使う
?>

<div id="centerColumnBody">

<div id="createAcctSuccessMainContent" class="content"><?php echo TEXT_ACCOUNT_CREATED; ?></div>

<div class="submit"><?php echo '<a href="' . $origin_href . '">' . zen_image_button(BUTTON_IMAGE_CONTINUE, BUTTON_CONTINUE_ALT,'class="imgover"') . '</a>'; ?></div>
</div>

<?php
// -> zen_smartphone: div は必要なし
/*
</div>
*/
?>
