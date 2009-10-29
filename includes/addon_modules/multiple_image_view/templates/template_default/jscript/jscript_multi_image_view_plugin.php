<?php
/**
 * jscript_multi_image_view
 *
 * @package Addon Modules
 * @copyright Copyright (C) 2009 Liquid System Technology, Inc.
 * @author Otsuji Takashi <ohtsuji@ark-web.jp>
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: jscript_multi_image_view.php $
 */
?>
<script type="text/javascript" src="<?php echo $this->_getTemplateDir('.js', $page, 'jscript') . '/' . 'jquery.lightbox-0.5.js'; ?>"></script>
<script type="text/javascript" language="javascript">
<?php
    $tpl_dir = $this->_getTemplateDir('.js', $page, 'buttons') . '/' . $_SESSION['language'] . '/';
?>
    var multi_image_view_lightbox_prm = {
        txtImage: '',
        txtOf: '/',
        imageLoading: '<?php echo $tpl_dir ?>lightbox-ico-loading.gif',
        imageBtnClose: '<?php echo $tpl_dir ?>lightbox-btn-close.gif',
        imageBtnPrev: '<?php echo $tpl_dir ?>lightbox-btn-prev.gif',
        imageBtnNext: '<?php echo $tpl_dir ?>lightbox-btn-next.gif',
        imageBlank: '<?php echo $tpl_dir ?>lightbox-blank.gif'
    };
</script>
