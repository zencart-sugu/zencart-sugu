<?php
/**
 * jscript_jquery
 *
 * @package Addon Modules
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: jscript_jquery.php $
 */
?>
<script type="text/javascript" src="<?php echo $this->_getTemplateDir('.js', $page, 'jscript') . '/' . MODULE_JQUERY_LIBRARY; ?>"></script>
<?php
if (MODULE_JQUERY_NOCONFLICT_STATUS == 'true'):
?>
<script language="javascript" type="text/javascript">
  //<![CDATA[
  jQuery.noConflict();
  //]]>
//--></script>
<?php
endif;
