<?php
/**
 * @package Installer
 * @access private
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_main_page.php 3252 2006-03-24 05:55:07Z drbyte $
 */

  $header_template = 'tpl_header.php';
  $footer_template = 'tpl_footer.php';
  $left_column_file = 'column_left.php';
  $body_id = str_replace('_', '', $_GET['main_page']);

?>
<body id="<?php echo $body_id; ?>" <?php echo $zc_first_field;?>>
<?php
  if ($messageStack->size('upgrade') > 0) {
    echo $messageStack->output('upgrade');
  }
?>
<div id="wrap">
  <div id="header">
  <img src="<?php echo DIR_WS_INSTALL_TEMPLATE; ?>images/zen_header_bg.jpg" alt="Zen Cart&trade; - The Art of eCommerce" title="Zen Cart&trade;"/>
  </div>
  <div id="content">
  <?php
  require($body_code);
  ?>
  </div>
  <div id="navigation">
  <?php
  require(DIR_WS_INSTALL_TEMPLATE . "sideboxes/navigation.php");
  ?>
  </div>
  <div id="footer">
    <p>Copyright &copy; 2003-2006 <a href="http://www.zen-cart.com" target="_blank">Zen Cart&trade;</a></p>
  </div>
</div>
<!--  <p><a href="http://validator.w3.org/check?uri=referer">Valid XHTML 1.0 Transitional</a></p>-->
<?php
  if ($messageStack->size('upgrade-error-details') > 0) {
    echo $messageStack->output('upgrade-error-details');
  }
?>
</body>
</html>