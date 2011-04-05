<?php
/**
 * feature_area block Template
 *
 * @package templateSystem
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: block.php $  $result->fields['type_handler']
 */

if (count($result) > 0 ):
?>
<div class="content">
<div id="feature_main_images">
<ul>
<?php
      $count = 0;
      $main_image_visible = false;
      while (!$result->EOF) {
        if ($result->fields['status']==true){
          $count++;
          $target = ( $result->fields['new_window'] == 1 )? ' target="_blank"' : '';
?>
     <li class="<?php echo $module.$result->fields['id']; ?> feature_main_image <?php if($main_image_visible=='true'){ echo '" style="display:block;'; }else{echo ' start';} ?>">
       <?php echo '<dl><dt><a href="'. $result->fields['link_url'] .'" rel="'.$module.$result->fields['id'].'"'.$target.'>' . zen_image(DIR_WS_IMAGES . $result->fields['main_image'] , feature_area_get_name($result->fields['id'], $_SESSION['languages_id']) , "", "") . '</a></dt></dl>'."\n"; ?>
     </li>
<?php
	 $thumb_area .= '      <li class="'.$module.$result->fields['id'].' '.($main_image_visible==false ? 'active' : 'inactive').'"><dl><dt><a href="'. $result->fields['link_url'] .'" rel="'.$module.$result->fields['id'].'"'.$target.'>'. zen_image(DIR_WS_IMAGES . $result->fields['thumb_image'] , feature_area_get_name($result->fields['id'], $_SESSION['languages_id']) , "", "" ) . '</a></dt></dl></li>'."\n";
          if( $main_image_visible == false ) $main_image_visible = true;

          $btns .= '<div style="display: none;" id="'.$module.$result->fields['id'].'">'.$module.$result->fields['id'].'</div>';
        }
        $result->MoveNext();
      }
      if ($this->getVisibleCount() < $count) {
        $output_buttons = true;
      } else {
        $output_buttons = false;
      }
      $output_buttons = true;  // set true (force)
?>
</ul>
</div>
<div class="carouselUI carouselUI-<?php echo $module . '-' . $block; ?>">
  <ul>
<?php
      echo $thumb_area;
?>
  </ul>
</div>
<?php if ($output_buttons): ?>
<script language="javascript" type="text/javascript">
  //<![CDATA[
  document.write('<ul class="buttons">');
  document.write('<li><a class="prev prev-<?php echo $module . '-' . $block; ?>" tabindex="-1"><?php echo $block_module->imageButton(BUTTON_IMAGE_FEATURE_AREA_UI_PREV, BUTTON_CAROUSEL_UI_PREV_ALT); ?></a></li>');
  document.write('<li><a class="stop stop-<?php echo $module . '-' . $block; ?>" tabindex="-1"><?php echo $block_module->imageButton(BUTTON_IMAGE_FEATURE_AREA_UI_STOP, BUTTON_CAROUSEL_UI_STOP_ALT); ?></a></li>');
  document.write('<li><a class="start start-<?php echo $module . '-' . $block; ?>" tabindex="-1"><?php echo $block_module->imageButton(BUTTON_IMAGE_FEATURE_AREA_UI_START, BUTTON_CAROUSEL_UI_START_ALT); ?></a></li>');
  document.write('<li><a class="next next-<?php echo $module . '-' . $block; ?>" tabindex="-1"><?php echo $block_module->imageButton(BUTTON_IMAGE_FEATURE_AREA_UI_NEXT, BUTTON_CAROUSEL_UI_NEXT_ALT); ?></a></li>');
  document.write('</ul>');
  //]]>
//--></script>
<?php endif; ?>
</div>
<?php
      echo $btns;
?>
<div id="feature_start" style="display:none;">start</div><div id="feature_stop" style="display:none;">stop</div>
<?php
endif;