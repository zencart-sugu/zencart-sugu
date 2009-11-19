<?php
/**
 * feature_area block Template
 *
 * @package templateSystem
 * @copyright Copyright (C) 2009 Liquid System Technology, Inc.
 * @author Koji Sasaki
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: block.php $  $result->fields['type_handler']
 */

if (count($result) > 0 ):
?>
<div class="content">
<div id="feature_main_images">
<?php
      $main_image_visible = false;
      while (!$result->EOF) {
        if ($result->fields['status']==true){
          $target = ( $result->fields['new_window'] == 1 )? ' target="_blank"' : '';
?>
     <div id="<?php echo $module.$result->fields['id']; ?>" class="feature_main_image <?php if($main_image_visible=='true'){ echo '" style="display:none;'; }else{echo ' start';} ?>">
       <?php echo '<a href="'. $result->fields['link_url'] .'" rel="'.$module.$result->fields['id'].'"'.$target.'>' . zen_image(DIR_WS_IMAGES . $result->fields['main_image'] , feature_area_get_name($result->fields['id'], $_SESSION['languages_id']) , "", "") . '</a>'; ?>
     </div>
<?php
          if( $main_image_visible == false ) $main_image_visible = true;
          $thumb_area .= '      <li><a href="'. $result->fields['link_url'] .'" rel="'.$module.$result->fields['id'].'"'.$target.'>'. zen_image(DIR_WS_IMAGES . $result->fields['thumb_image'] , feature_area_get_name($result->fields['id'], $_SESSION['languages_id']) , "", "" ) . '</a></li>';
        }
        $result->MoveNext();
      }
?>
</div>
<script language="javascript" type="text/javascript">
  //<![CDATA[
  document.write('<div class="prev prev-<?php echo $module . '-' . $block; ?>" tabindex="-1"><?php echo $block_module->imageButton(BUTTON_IMAGE_CAROUSEL_UI_PREVIOUS, BUTTON_CAROUSEL_UI_PREVIOUS_ALT); ?></div>');
  //]]>
//--></script>
<div class="carouselUI carouselUI-<?php echo $module . '-' . $block; ?>">
  <ul>
<?php
      echo $thumb_area;
?>
  </ul>
  </div>
<script language="javascript" type="text/javascript">
  //<![CDATA[
  document.write('<div href="#" class="next next-<?php echo $module . '-' . $block; ?>" tabindex="-1"><?php echo $block_module->imageButton(BUTTON_IMAGE_CAROUSEL_UI_NEXT, BUTTON_CAROUSEL_UI_NEXT_ALT); ?></div>');
  //]]>
//--></script>
</div>
<?php
endif;