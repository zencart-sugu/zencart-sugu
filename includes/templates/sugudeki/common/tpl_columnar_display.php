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


<?php
if (is_array($list_box_contents) > 0 ) {
 for($row=0;$row<sizeof($list_box_contents);$row++) {
    $params = "";
    //if (isset($list_box_contents[$row]['params'])) $params .= ' ' . $list_box_contents[$row]['params'];
?>

<?php
    for($col=0;$col<sizeof($list_box_contents[$row]);$col++) {
      $r_params = "";
      if (isset($list_box_contents[$row][$col]['params'])) $r_params .= ' ' . (string)$list_box_contents[$row][$col]['params'];
     if (isset($list_box_contents[$row][$col]['text'])) {
       // separate by br
       $sep = '<br />';
       $texts = explode($sep, $list_box_contents[$row][$col]['text']);
       // get text of dt
       $dt = array_shift($texts);
       if (!preg_match('@</a>$@', $dt)) {
         $dt .= '</a>';
       }
       // get text of dd
       $dd = implode($texts);
       if (!preg_match('/<a.*/', $dd)) {
         // get element <a> if not exists
         $link = preg_match('@(<a.*)<img@', $dt, $matches);
	 $link = $matches[1];
         $dd = $link . $dd;
       }
?>
<?php echo '<dl' . $r_params . '>' . '<dt>' . $dt . '</dt>' . '<dd>' . $dd . '</dd>' .  '</dl>' . "\n"; ?>
<?php
      }
    }
?>
<br class="clearBoth" />
<?php
  }
}
?> 
