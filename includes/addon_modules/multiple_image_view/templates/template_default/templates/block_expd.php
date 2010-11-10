<?php
/**
 * Module Template
 *
 * Template used to render attribute display/input fields
 *
 * @package templateSystem
 * @copyright Copyright 2008 Liquid System Technology, Inc.
 * @author Otsuji Takashi <ohtsuji@ark-web.jp>
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: block_hogehoge.php $
 */
?>
<?php
$pId = $_GET['products_id'];
if (count($pId)) {
?>
<div id="multi_image_view_expand">
<?php
    $img_alt     = zen_get_products_name($pId);
    $href_title  = $img_alt . '(' . zen_get_products_display_price($pId) . ')';
    $img_alt     = htmlspecialchars(zen_clean_html($img_alt), ENT_QUOTES);
    $href_title  = htmlspecialchars(zen_clean_html($href_title), ENT_QUOTES);

    $first_image_expd = DIR_WS_IMAGES . $multi_images[0]['img_expd'];
    $first_image_libx = DIR_WS_IMAGES . $multi_images[0]['img_libx'];
    $str_img_tag = '<p>'.zen_image($first_image_expd , $img_alt ,MEDIUM_IMAGE_WIDTH, MEDIUM_IMAGE_HEIGHT) . '</p>';
    if($flg_btn == true){
        $str_img_tag .='<a href="' . $first_image_libx . '" title="' . $href_title . '" target="_blank"><span class="imgLink">' . zen_image_submit(BUTTON_IMAGE_IMG_EXPANSION, BUTTON_IMG_EXPANSION_ALT,'class="imgover"') . '</span></a>';
    }
//    echo $str_img_tag;
?>
<script type="text/javascript" language="javascript">
<!--
    document.write('<?php echo $str_img_tag ?>');
-->
</script>
<noscript>
<?php
    $str_href = '';
    if($multi_images[0]['img_type'] == 1){
        $str_href = zen_href_link(FILENAME_POPUP_IMAGE_ADDITIONAL, 'pID=' . $_GET['products_id'] . '&pic=0&products_image_large_additional=' . $first_image_libx);
    } else {
        if($flg_btn == true){
            $str_href = zen_href_link(FILENAME_POPUP_IMAGE, 'pID=' . $_GET['products_id']);
        }
    }

    echo '<a href="' . $str_href . '" target="_blank">' . zen_image($first_image_expd , $img_alt ,MEDIUM_IMAGE_WIDTH, MEDIUM_IMAGE_HEIGHT) . '<br /><span class="imgLink">' . TEXT_CLICK_TO_ENLARGE . '</span></a>';
?>
</noscript>
</div>
<?php
}
?>
