<?php
/**
 * Module Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_modules_shipping_type_table.php 3241 2006-03-22 04:27:27Z ajeh $
 */
 include(DIR_WS_MODULES . zen_get_module_directory(FILENAME_SHIPPING_TYPE_TABLE));

if (count($shipping_type_tables) > 0) {
  foreach ($shipping_type_tables as $shipping_type_table) {
    $shipping_types = $shipping_type_table['shipping_types'];
?>
<span class="style23"><br>
</span><span class="style24"></span>


<?php
    for ($st_i = 0, $st_n = count($shipping_types); $st_i < $st_n; $st_i++) {
?>
<h2 class="headline"><?php echo $shipping_types[$st_i]['name']; ?></h2>
<p><?php echo $shipping_types[$st_i]['description']; ?></p>
<?php
    }
?>


<table class="fit border">
		<tr>
				<th scope="col"><?php echo TEXT_SHIPPING_DISTRICT; ?></th>
				<th scope="col"><?php echo TEXT_SHIPPING_ZONE; ?></th>
				<?php
    for ($st_i = 0, $st_n = count($shipping_types); $st_i < $st_n; $st_i++) {
?>
				<th scope="col"><?php echo $shipping_types[$st_i]['name']; ?></th>
				<?php
    }
?>
		</tr>
<?php
    $r = 0;
    for ($sd_i = 0, $sd_n = count($shipping_districts); $sd_i < $sd_n; $sd_i++) {
      $shipping_zones = $shipping_districts[$sd_i]['zones'];
      for ($sz_i = 0, $sz_n = count($shipping_zones); $sz_i < $sz_n; $sz_i++) {
        $r++;
        if ($r % 2 == 0) {
          $td_class_name = 'head';
        } else {
          $td_class_name = 'body';
        }
?>
          <tr>
<?php
        if ($sz_i == 0) {
?>
            <th rowspan="<?php echo $shipping_districts[$sd_i]['zones_count']; ?>"  class="M14_1_list_head M14_1_font_headline" align="center" > <?php echo $shipping_districts[$sd_i]['name']; ?> </th>
<?php
        }
?>
            <td class="<?php echo $td_class_name; ?> M14_1_font_contents" align="center"> <?php echo $shipping_zones[$sz_i]['name']; ?> </td>
<?php
          for ($st_i = 0, $st_n = count($shipping_types); $st_i < $st_n; $st_i++) {
?>
            <td class="<?php echo $td_class_name; ?> M14_1_font_contents" align="right"> <?php echo $currencies->format($shipping_types[$st_i]['shipping_costs'][$shipping_zones[$sz_i]['id']]); ?> </td>
<?php
          }
?>
          </tr>
<?php
      }
    }
?>
</table>


<?php
  }
} else {
?>

<div id="shippingTypeTableNoShippingTypeTableMainContent" class="content"> <?php echo TEXT_SHIPPING_TYPE_TABLE_NOT_FOUND; ?> </div>

<?php
}
?>