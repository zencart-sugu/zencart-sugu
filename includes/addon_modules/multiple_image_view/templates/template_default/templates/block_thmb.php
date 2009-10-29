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
<div id="multi_image_view_thmb" class="centeredContent">
<?php
if(count($multi_images)>1) {
    $img_alt     = zen_get_products_name($pId);
    $href_title  = $img_alt . '(' . zen_get_products_display_price($pId) . ')';
    $img_alt     = zen_clean_html($img_alt);
    $href_title  = zen_clean_html($href_title);
		
		$thmb_cnt = 1;
    $image_cnt = -1;
    $str_splt = '';
    $pre_url = '';
    foreach($multi_images as $item) {
        if($image_cnt == -1) {
            $str_style = 'selected_thmb ';
        } else {
            $str_style = '';
        }
?>
    <div class="<?php echo $str_style ?> back<?php if(($thmb_cnt % 6) == 0){	echo ' last';} ?>" >
<?php
        $img_path_thmb = DIR_WS_IMAGES . $item['img_thmb'];
        $img_path_libx = DIR_WS_IMAGES . $item['img_libx'];
        $str_ary_path_expd .= $str_splt . "'" . $pre_url . $img_path_thmb . "':'" . DIR_WS_IMAGES . $item['img_expd'] . "'";
        $str_splt = ",";

        $srt_href = '';
        if($multi_images[0]['img_type'] == 1){
            $str_href = zen_href_link(FILENAME_POPUP_IMAGE_ADDITIONAL, 'pID=' . $_GET['products_id'] . '&pic=' . ++$image_cnt . '&products_image_large_additional=' . $img_path_libx);
        } else {
            ++$image_cnt;
            ++$thmb_cnt;
            $str_href = zen_href_link(FILENAME_POPUP_IMAGE, 'pID=' . $_GET['products_id']);
        }
        $str_img_tag = '<a href="' . $img_path_libx . '" title="' . $href_title . '"  target="_blank">' . zen_image($img_path_thmb ,$img_alt,MODULE_MULTIPLE_IMAGE_VIEW_THMB_WIDTH,MODULE_MULTIPLE_IMAGE_VIEW_THMB_HEIGHT,'class="'. $str_style .'"') . '</a>';
//        echo $str_img_tag;
?>
<script type="text/javascript" language="javascript">
<!--
    document.write('<?php echo $str_img_tag ?>');
-->
</script>

<noscript>
<?php
        echo '<a href="' . $str_href . '" target="_blank">' . zen_image($img_path_thmb ,$img_alt,MODULE_MULTIPLE_IMAGE_VIEW_THMB_WIDTH,MODULE_MULTIPLE_IMAGE_VIEW_THMB_HEIGHT) . '<br /><span class="imgLink">' . TEXT_CLICK_TO_ENLARGE . '</span></a>';

?>
</noscript>
    </div>
<?php
    }
}
?>
<br class="clearBoth"/>
</div>
<script type="text/javascript" language="javascript">
<!--
    var multi_image_view_img_path_expd = {<?php echo $str_ary_path_expd ?>};
-->
</script>
<?php
}
?>
