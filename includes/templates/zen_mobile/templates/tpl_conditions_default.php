<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?mainc _page=conditions.<br />
 * Displays conditions page.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_conditions_default.php 3464 2006-04-19 00:07:26Z ajeh $
 */
?>
<div class="centerColumn" id="conditions">
<?php echo MOBILE_TITLE_START; ?><?php echo HEADING_TITLE; ?><?php echo MOBILE_TITLE_FINISH; ?>

<?php if (DEFINE_CONDITIONS_STATUS >= 1 and DEFINE_CONDITIONS_STATUS <= 2) { ?>
<div id="conditionsMainContent" class="content">
<?php
/**
 * require the html_define for the conditions page
 */
  require($define_page);
?>
</div>
<?php } ?>

<div class="buttonRow back"><?php echo zen_back_link() . MOBILE_HISTORY_BACK . '</a>'; ?></div>
</div>
