<hr size="1"  width="95%" align="center" color="<?php echo MOBILE_THEME_COLOR ?>">
<?php echo BOX_HEADING_ACCOUNT_MENU?>
<font size="1">
<?php if ($_SESSION['customer_id']) { ?>
<hr size="1"  width="95%" align="center" color="<?php echo MOBILE_THEME_COLOR ?>">
<?php echo BOX_HEADING_CATEGORIES_LIST;?>
<a href="<?php echo zen_href_link(FILENAME_LOGOFF, '', 'SSL'); ?>"><?php echo HEADER_TITLE_LOGOFF; ?></a>
<br>
<?php echo BOX_HEADING_CATEGORIES_LIST;?>
<a href="<?php echo zen_href_link(FILENAME_ACCOUNT, '', 'SSL'); ?>"><?php echo HEADER_TITLE_MY_ACCOUNT; ?></a>
<?php
      } else {
        if (STORE_STATUS == '0') {
?>
<hr size="1"  width="95%" align="center" color="<?php echo MOBILE_THEME_COLOR ?>">
&#xE6D9;<a href="<?php echo zen_href_link(FILENAME_LOGIN, '', 'SSL'); ?>"><?php echo HEADER_TITLE_LOGIN; ?></a>
<br>
<?php
          echo '&#xE6DD;<a href="' . zen_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL') . '">' . MOBILE_NEW_ACCOUNT_ENTRY . '</a>';
 } } ?>
<br>
<?php if ($_SESSION['cart']->count_contents() != 0) { ?>
<?php echo BOX_HEADING_CATEGORIES_LIST;?>
<a href="<?php echo zen_href_link(FILENAME_SHOPPING_CART, '', 'NONSSL'); ?>"><?php echo HEADER_TITLE_CART_CONTENTS; ?></a> 
    <br>
<?php echo BOX_HEADING_CATEGORIES_LIST;?>
<a href="<?php echo zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'); ?>"><?php echo HEADER_TITLE_CHECKOUT; ?></a>

<?php }?>
</font>
</div>
