<?php
/**
 * Module Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_modules_upcoming_products.php 2834 2006-01-11 22:16:37Z birdbrain $
 */
?>
<!-- bof: upcoming_products -->
<fieldset>
<legend><?php echo TABLE_HEADING_UPCOMING_PRODUCTS; ?></legend>
<table border="0" width="100%" cellspacing="0" cellpadding="2" id="upcomingProductsTable" summary="table contains a list of products that are due to be instock soon and the dates the items are expected">
<caption>These items will be in stock soon</caption>
  <tr>
    <th scope="col" id="upProductsHeading"><?php echo TABLE_HEADING_PRODUCTS; ?></th>
    <th scope="col" id="upDateHeading"><?php echo TABLE_HEADING_DATE_EXPECTED; ?></th>
  </tr>
<?php
    $row = 0;
    while (!$expected->EOF) {
      $row++;
      if (($row / 2) == floor($row / 2)) {
        echo '  <tr class="rowEven">' . "\n";
      } else {
        echo '  <tr class="rowOdd">' . "\n";
      }

      echo '    <td ><a href="' . zen_href_link(zen_get_info_page($expected->fields['products_id']), 'products_id=' . $expected->fields['products_id']) . '">' . $expected->fields['products_name'] . '</a></td>' . "\n" .
           '    <td align="right" >' . zen_date_short($expected->fields['date_expected']) . '</td>' . "\n" .
           '  </tr>' . "\n";
      $expected->MoveNext();
    }
?>
</table>
</fieldset>
<!-- eof: upcoming_products -->
