<?php
/**
 * Page Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_page_3_default.php 3464 2006-04-19 00:07:26Z ajeh $
 */
?>
<div class="centerColumn" id="pageThree">
<?php echo MOBILE_TITLE_START; ?><?php echo HEADING_TITLE; ?><?php echo MOBILE_TITLE_FINISH; ?>

<?php if (DEFINE_PAGE_3_STATUS >= 1 and DEFINE_PAGE_3_STATUS <= 2) { ?>
<div id="pageThreeMainContent" class="content">
<?php
/**
 * require the html_define for the page_3 page
 */
  require($define_page);
?>
</div>
<?php } ?>

<div class="buttonRow back"><?php echo zen_back_link() . MOBILE_HISTORY_BACK . '</a>'; ?></div>
</div>
