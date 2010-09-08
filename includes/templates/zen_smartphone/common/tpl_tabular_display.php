<?php
/**
 * Common Template - tpl_tabular_display.php
 *
 * This file is used for generating tabular output where needed, based on the supplied array of table-cell contents.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_tabular_display.php 3544 2006-04-29 17:17:45Z drbyte $
 */

//print_r($list_box_contents);
  $cell_scope = (!isset($cell_scope) || empty($cell_scope)) ? 'col' : $cell_scope;
  $cell_title = (!isset($cell_title) || empty($cell_title)) ? 'list' : $cell_title;

?>
<?php
// -> zen_smartphone: tableはなし
/*
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="<?php echo 'cat' . $cPath . 'Table'; ?>" class="tabTable">
*/
// <- zen_smartphone: tableはなし
?>
<?php
// -> zen_smartphone: ajaxの場合は ul 表記は要らない
if (! isset($_GET['page']) or $_GET['page'] <= 1) {
?>
<ul id="product-listing">
<?php 
}
// -> zen_smartphone: ajaxの場合は ul 表記は要らない
?>
<?php
  for($row=0; $row<sizeof($list_box_contents); $row++) {
    $r_params = "";
    $c_params = "";
    if (isset($list_box_contents[$row]['params'])) $r_params .= ' ' . $list_box_contents[$row]['params'];
?>
<?php
// -> zen_smartphone: tableはなし
/*
  <tr <?php echo $r_params; ?>>
*/
// <- zen_smartphone: tableはなし
?>
  <li <?php echo $r_params; ?>>
<?php
    for($col=0;$col<sizeof($list_box_contents[$row]);$col++) {
      $c_params = "";
// -> zen_smartphone: tableはなし
//      $cell_type = ($row==0) ? 'th' : 'td';
      $cell_type = 'span';
// <- zen_smartphone: tableはなし
      if (isset($list_box_contents[$row][$col]['params'])) $c_params .= ' ' . $list_box_contents[$row][$col]['params'];
// -> zen_smartphone: center="center" で。てゆうか、HTML5的には使用を控えるべきでは?
//      if (isset($list_box_contents[$row][$col]['align'])) $c_params .= ' ' . $list_box_contents[$row][$col]['align'];
      if (isset($list_box_contents[$row][$col]['align'])) $c_params .= ' ' . $list_box_contents[$row][$col]['align'] . '="'. $list_box_contents[$row][$col]['align'].'"';
// -> zen_smartphone: center="center" で。てゆうか、HTML5的には使用を控えるべきでは?
      if ($cell_type=='th') $c_params .= ' scope="' . $cell_scope . '" id="' . $cell_title . 'Cell' . $row . '-' . $col.'"';
      if (isset($list_box_contents[$row][$col]['text'])) {
?>
   <?php echo '<' . $cell_type . $c_params . '>'; ?><?php echo $list_box_contents[$row][$col]['text'] ?><?php echo '</' . $cell_type . '>'  . "\n"; ?>
<?php
      }
    }
?>
<?php
// -> zen_smartphone: tableはなし
/*
  </tr>
*/
// <- zen_smartphone: tableはなし
?>
  </li>
<?php
  }
?> 
<?php
// -> zen_smartphone: tableはなし
/*
</table>
*/
// <- zen_smartphone: tableはなし
?>
<?php
// -> zen_smartphone: ajaxの場合は ul 表記は要らない
if (! isset($_GET['page']) or $_GET['page'] <= 1) {
?>
</ul>
<?php 
}
// -> zen_smartphone: ajaxの場合は ul 表記は要らない
?>
