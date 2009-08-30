<?php
/**
 * @package admin
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: configuration_dhtml.php 3009 2006-02-11 15:41:10Z wilt $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

?>
<!-- configuration //-->
<li class="submenu"> 
<a target="_top" href="<?php echo  zen_href_link(FILENAME_ALT_NAV, '', 'NONSSL') ?>"><?php echo BOX_HEADING_CONFIGURATION; ?></a><ul>
<?php
  $heading = array();
  $contents = array();
  $heading[] = array('text'  => BOX_HEADING_CONFIGURATION,

                     'link'  => zen_href_link(basename($PHP_SELF), zen_get_all_get_params(array('selected_box')) . 'selected_box=configuration'));
  if (1 == 1) {
    $cfg_groups = '';
    $configuration_groups = $db->Execute("select configuration_group_id as cgID, 
                                                       configuration_group_title as cgTitle 
                                                from " . TABLE_CONFIGURATION_GROUP . " 
                                                where visible = '1' order by sort_order");

    while (!$configuration_groups->EOF) {
      $cfg_groups .= '<li><a href="' . zen_href_link(FILENAME_CONFIGURATION, 'gID=' . $configuration_groups->fields['cgID'], 'NONSSL') . '">' . $configuration_groups->fields['cgTitle'] . '</a></li>' . "\n";
      $configuration_groups->MoveNext();
    }
  }
echo $cfg_groups;
?>
</ul>
</li>
<!-- configuration_eof //-->