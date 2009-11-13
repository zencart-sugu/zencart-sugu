<?php
/**
 * Page Template
 *
 * This is the template used for EZ-Pages content display.  It is named "tpl_page_default" instead of ezpage for friendlier 
 * appearance
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_page_default.php 2741 2005-12-30 19:58:21Z birdbrain $
 */
?>
<div class="centerColumn" id="ezPageDefault">
<h1 id="ezPagesHeading"><?php echo $var_pageDetails->fields['pages_title']; ?></h1>
<div id="centerColumnBody">
<?php echo $var_pageDetails->fields['pages_html_text']; ?>
</div>

</div>
