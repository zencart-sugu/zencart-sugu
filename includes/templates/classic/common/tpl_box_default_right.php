<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
// $Id: tpl_box_default_right.php 2625 2005-12-20 02:13:19Z drbyte $
//

// choose box images based on box position
  if ($title_link) {
    $title = '<a href="' . zen_href_link($title_link) . '">' . $title . BOX_HEADING_LINKS . '</a>';
  }
//
?>
<!--// bof: <?php echo $box_id; ?> //-->
<table width="<?php echo $column_width; ?>" border="0" cellspacing="0" cellpadding="0" class="rightbox" id="<?php echo str_replace('_', '-', $box_id) . '-table'; ?>">
  <tr class="rightboxheading" id="<?php echo str_replace('_', '-', $box_id) . '-heading-tr'; ?>">
    <!-- Sidebox Header -->
    <td colspan="3" width="100%" class="rightboxheading" id="<?php echo str_replace('_', '-', $box_id) . '-heading-td'; ?>"><?php echo $title; ?></td>
  </tr>
  <tr>
    <!-- Sidebox Contents -->
    <td colspan="3" class="rightboxcontent" id="<?php echo str_replace('_', '-', $box_id) . '-content'; ?>">
<?php echo $content; ?>
    </td>
  </tr>
  <tr>
    <!-- Sidebox Footer -->
    <td colspan="3" height="5px" class="rightboxfooter" id="<?php echo str_replace('_', '-', $box_id) . '-footer'; ?>">
    </td>
  </tr>
</table>
<!--// eof: <?php echo $box_id; ?> //-->

