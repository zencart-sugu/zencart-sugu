<?php
/**
 * jscript_jqtouch
 *
 * @package Addon Modules
 * @copyright Copyright (C) 2009 Liquid System Technology, Inc.
 * @author TAKEMURA Mitsuo
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: jscript_jqtouch.php $
 */

$jqt_template_dir = $template->get_template_dir('.png', DIR_WS_TEMPLATE, $current_page_base, 'images/jqtouch');
?>
<script type="text/javascript" src="<?php echo $template->get_template_dir('.js', DIR_WS_TEMPLATE, $current_page_base, 'jscript') . '/jqtouch.js'; ?>"></script>
<script type="text/javascript" src="<?php echo $template->get_template_dir('.js', DIR_WS_TEMPLATE, $current_page_base, 'jscript') . '/md5.js'; ?>"></script>
<script type="text/javascript" src="<?php echo $template->get_template_dir('.js', DIR_WS_TEMPLATE, $current_page_base, 'jscript') . '/jqt.linktoajax.js'; ?>"></script>
<script language="javascript" type="text/javascript">
var jQT = new $.jQTouch({
    icon: '<?php echo $jqt_template_dir . '/jqtouch.png' ?>',
    addGlossToIcon: true,
    startupScreen: '<?php echo $jqt_template_dir . '/jqt_startup.png' ?>',
    statusBar: 'black',
    preloadImages: [
        '<?php echo $jqt_template_dir . '/back_button.png' ?>',
        '<?php echo $jqt_template_dir . '/back_button_clicked.png' ?>',
        '<?php echo $jqt_template_dir . '/button_clicked.png' ?>',
        '<?php echo $jqt_template_dir . '/grayButton.png' ?>',
        '<?php echo $jqt_template_dir . '/whiteButton.png' ?>',
        '<?php echo $jqt_template_dir . '/loading.gif' ?>'
        ],
    submitedCallback: function(result, id) {
      if (result == true) {
        $('#'+id+' a').click(jQT.changeLinkToAjax);
      }
    }
});

$(function(){
	$('a').click(jQT.changeLinkToAjax);
});
</script>
