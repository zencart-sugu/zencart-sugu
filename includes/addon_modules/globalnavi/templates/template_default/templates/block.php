<?php
/**
 * addon_modules block Template
 *
 * @package templateSystem
 * @copyright Copyright (C) 2009 Liquid System Technology, Inc.
 * @author Koji Sasaki
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: block.php $
 */


?>
<ul id="footer-nav">
<?php foreach($categories as $val): ?>
  <li>
    <a href="<?php echo zen_href_link(FILENAME_DEFAULT, 'cPath='.$val['id'], 'SSL'); ?>"><?php echo $val['text']; ?></a>
    <?php if (count($val['sub'])): ?>
    <ul>
      <?php foreach($val['sub'] as $sub): ?>
      <li>
        <a href="<?php echo zen_href_link(FILENAME_DEFAULT, 'cPath='.$val['id'].'_'.$sub['id'], 'SSL'); ?>"><?php echo $sub['text']; ?></a>
      </li>
     <?php endforeach; ?>
    </ul>
    <?php endif;?>
  </li>
<?php endforeach; ?>
</ul>