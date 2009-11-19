<?php
/**
 * Module Template
 *
 * Template used to render attribute display/input fields
 *
 * @package templateSystem
 * @copyright Copyright 2009 Liquid System Technology, Inc.
 * @author Koji Sasaki
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: block.php $
 */
// available vars
// $customers_points['deposit']
// $customers_points['pending']
// $customers_points['updated_at']
?>

<table class="border fit">
<tr>
<th scope="row"><?php echo  TEXT_CUSTOMERS_POINT_DEPOSIT; ?></th>
<td><?php echo $customers_points['deposit']; ?> <?php echo TEXT_POINT; ?></td>
</tr>
<tr>
<th scope="row"><?php echo  TEXT_CUSTOMERS_POINT_PENDING; ?></th>
<td><?php echo $customers_points['pending']; ?> <?php echo TEXT_POINT; ?></td>
</tr>
<tr>
<th scope="row"><?php echo TEXT_CUSTOMERS_POINT_UPDATED; ?></th>
<td><?php echo $customers_points['updated_at']; ?></td>
</tr>
</table>
