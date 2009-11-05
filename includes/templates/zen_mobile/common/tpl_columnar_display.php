<?php
/**
 * Common Template - tpl_columnar_display.php
 *
 * This file is used for generating tabular output where needed, based on the supplied array of table-cell contents.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_columnar_display.php 3157 2006-03-10 23:24:22Z drbyte $
 */

?>
<hr size="1" width="95%" align="center" color="<?php echo MOBILE_THEME_COLOR?>">
<?php
  if ($title) {
  ?>
<?php echo BOX_HEADING_COLORBOX . $title; ?>
<?php
 }
 ?>
<?php
//print_r($list_box_contents);
if (is_array($list_box_contents) > 0 ) {
  for($row=0;$row<sizeof($list_box_contents);$row++) {
    $params = "";
    //if (isset($list_box_contents[$row]['params'])) $params .= ' ' . $list_box_contents[$row]['params'];
    for($col=0;$col<sizeof($list_box_contents[$row]);$col++) {
      $r_params = "";
      if (isset($list_box_contents[$row][$col]['params'])) $r_params .= ' ' . (string)$list_box_contents[$row][$col]['params'];
        if (isset($list_box_contents[$row][$col]['text'])) {
          if($col < 9){    
            $access_key = get_pictgram_accesskey($col+1);
            if($_GET['main_page'] != 'product_info'){
              if(($_GET['main_page'] == 'specials') || ($_GET['main_page'] == 'modules_specials')){
                $list_box_contents[$row][$col]['text'] = preg_replace('/<a href=.*img.*<a /si',$access_key,$list_box_contents[$row][$col]['text']);
                $list_box_contents[$row][$col]['text'] .= '<hr size="1" width="95%" align="center" color="'.MOBILE_THEME_COLOR.'">';
              }else{
                $list_box_contents[$row][$col]['text'] =preg_replace('/<img.*\/>/si','',$list_box_contents[$row][$col]['text']); 
                $list_box_contents[$row][$col]['text'] = preg_replace('/<a(.*?)/si',$access_key.' $1',$list_box_contents[$row][$col]['text']).'<br>';
              }
            }
          }
          echo  $list_box_contents[$row][$col]['text'];
        }
    }
?>
    
<br class="clearBoth" />
<?php
  }
}
?> 
