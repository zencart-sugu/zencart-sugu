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
$cont = -1;
?>
<?php if (!empty($steps)): ?>
<?php if(isset($_SESSION['visitors_id']) || $_SESSION['customer_id'] < 1){?>
<ol id="checkout-step" class="visitor">
<?php }else{  ?>
<ol id="checkout-step" class="customer">
<?php } ?>
<?php foreach($steps as $step): ?>
<?php $cont++ ?>

<li class="<?php echo $step['page']; ?><?php if($step['current'] == 'current'){$cont = -1;echo '-current current';} ?> <?php echo  $step['page'].'-'.$cont  ; ?>"><?php echo $step['text']; ?></li>
<?php endforeach; ?>
</ol>
<?php endif; ?>