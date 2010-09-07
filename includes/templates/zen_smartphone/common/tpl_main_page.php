<?php
/**
 * Common Template - tpl_main_page.php
 *
 * Governs the overall layout of an entire page<br />
 * Normally consisting of a header, left side column. center column. right side column and footer<br />
 * For customizing, this file can be copied to /templates/your_template_dir/pagename<br />
 * example: to override the privacy page<br />
 * - make a directory /templates/my_template/privacy<br />
 * - copy /templates/templates_defaults/common/tpl_main_page.php to /templates/my_template/privacy/tpl_main_page.php<br />
 * <br />
 * to override the global settings and turn off columns un-comment the lines below for the correct column to turn off<br />
 * to turn off the header and/or footer uncomment the lines below<br />
 * Note: header can be disabled in the tpl_header.php<br />
 * Note: footer can be disabled in the tpl_footer.php<br />
 * <br />
 * $flag_disable_header = true;<br />
 * $flag_disable_left = true;<br />
 * $flag_disable_right = true;<br />
 * $flag_disable_footer = true;<br />
 * <br />
 * // example to not display right column on main page when Always Show Categories is OFF<br />
 * <br />
 * if ($current_page_base == 'index' and $cPath == '') {<br />
 *  $flag_disable_right = true;<br />
 * }<br />
 * <br />
 * example to not display right column on main page when Always Show Categories is ON and set to categories_id 3<br />
 * <br />
 * if ($current_page_base == 'index' and $cPath == '' or $cPath == '3') {<br />
 *  $flag_disable_right = true;<br />
 * }<br />
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_main_page.php 3721 2006-06-07 03:19:12Z birdbrain $
 */

// -> zen_smartphone: ajax的な表示の場合は、下記とは別の内容にします
if (! isset($_GET['page']) or $_GET['page'] <= 1) {
// <- zen_smartphone: ajax的な表示の場合は、下記とは別の内容にします

// -> zen_smartphone: たぶん必要ない
/*
// the following IF statement can be duplicated/modified as needed to set additional flags
  if (in_array($current_page_base,explode(",",'list_pages_to_skip_all_right_sideboxes_on_here,separated_by_commas,and_no_spaces')) ) {
    $flag_disable_right = true;
  }


  $header_template = 'tpl_header.php';
  $footer_template = 'tpl_footer.php';
  $left_column_file = 'column_left.php';
  $right_column_file = 'column_right.php';
  $body_id = str_replace('_', '', $_GET['main_page']);
	
  if($_GET['main_page'] == 'index'){
    if(empty($_GET['cPath'])){
      $container_class ="home";
	  }else{
      $container_class ="category";
    }
  }else{
      $container_class ="category";
  }
	

if ($sidebar_left){
}else{
$column = ' class="onecolumn"';
  }
?>
*/
// <- zen_smartphone: たぶん必要ない
?>

<?php
// -> zen_smartphone: tmpl = jqt なら、bodyタグと、id="body"は要らない
if ($_REQUEST['tmpl'] != 'jqt') {
?>

<body id="<?php echo $body_id .'Body' ; ?>"<?php echo $column ; ?>>

<?php
// -> zen_smartphone: container は必要ない
/*
<!-- container -->
<div id="container" class="<?php echo $container_class ; ?>">
*/
// <- zen_smartphone: container は必要ない
?>
<?php
// -> zen_smartphone: skip は必要ない
/*
<div id="skip">
<a href="<?php echo $_SERVER['REQUEST_URI'];?>#main" title="<?php echo HEADER_SKIP_MAIN ; ?>"><?php echo HEADER_SKIP_MAIN ; ?></a>
<a href="<?php echo $_SERVER['REQUEST_URI'];?>#menu" title="<?php echo HEADER_SKIP_MENU ; ?>"><?php echo HEADER_SKIP_MENU ; ?></a>
</div>
*/
// <- zen_smartphone: skip は必要ない
?>

<!-- body -->
<div id="body" class="home <?php echo $body_id; ?>">

<?php
}
// <- zen_smartphone: tmpl = jqt なら、bodyタグと、id="body"は要らない
?>
<?php
// -> zen_smartphone: jqt_anchor_id がセットされていたら、div id="..." をセットする
if ($_REQUEST['jqt_anchor_id'] != '') {
$jqt_id = $_REQUEST['jqt_anchor_id'];
?>

<!-- post-responce -->
<div id="<?php echo zen_output_string_protected($jqt_id);?>" class="current">

<?php
}
// <- zen_smartphone: jqt_anchor_id がセットされていたら、div id="..." をセットする
?>
<?php
 /**
  * prepares and displays header output
  *
  */
  require($template->get_template_dir('tpl_header.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_header.php');?>

<!-- content -->
<div id="content">

<?php
if (COLUMN_RIGHT_STATUS == 0 or (CUSTOMERS_APPROVAL == '1' and $_SESSION['customer_id'] == '')) {
  // global disable of column_right
  $flag_disable_right = true;
}
if (!isset($flag_disable_right) || !$flag_disable_right) {
  if ($sidebar_right) {
?>
<!-- wrapper -->
<div id="wrapper">
<?php } }?>

<!-- main -->
<div id="main" class="column">

<?php if(($_GET['main_page'] == 'product_info')||($_GET['main_page'] == 'shopping_cart')){?>
<!-- mainBody -->
<div id="mainBody">
<?php } ?>

<?php if($category_depth != 'top'){?>
<!-- bof  breadcrumb -->
<?php if (DEFINE_BREADCRUMB_STATUS == '1') { ?>
<div id="breadcrumb" class="transparent"><?php echo $breadcrumb->trail(BREAD_CRUMBS_SEPARATOR); ?></div>
<?php } ?>
<!-- eof breadcrumb -->
<?php } ?>

<?php
  // displays addon_modules layout blocks
  if ($main_top) {
?>
<!-- mainTop -->
<div id="mainTop">
<?php echo $main_top; ?>
</div>
<!-- /mainTop -->
<?php
  }
?>

<?php
 /**
  * prepares and displays center column
  *
  */
 require($body_code); ?>

<?php if(($_GET['main_page'] == 'product_info')||($_GET['main_page'] == 'shopping_cart')){?>
</div>
<!-- /mainBody -->
<?php } ?>

<?php
//注文ステップの表示位置を変更するため
if((preg_match("/account/", $_GET['main_page']) == 0)){
?>

<?php
  // displays addon_modules layout blocks
  if ($main_bottom) {
?>
<!-- mainBottom -->
<div id="mainBottom">
<?php echo $main_bottom; ?>
</div>
<!-- /mainBottom -->
<?php
  }
?>
<?php } ?>

<?php
if (COLUMN_RIGHT_STATUS == 0 or (CUSTOMERS_APPROVAL == '1' and $_SESSION['customer_id'] == '')) {
  // global disable of column_right
  $flag_disable_right = true;
}
if (!isset($flag_disable_right) || !$flag_disable_right) {
  if ($sidebar_right) {
?>
<!-- sub-b -->
<div id="sub-b" class="column sub">
<?php echo $sidebar_right; ?>
</div>
<!-- /sub-b -->
<?php
  } }
?>

</div>
<!-- /main -->

<?php
if (COLUMN_RIGHT_STATUS == 0 or (CUSTOMERS_APPROVAL == '1' and $_SESSION['customer_id'] == '')) {
  // global disable of column_right
  $flag_disable_right = true;
}
if (!isset($flag_disable_right) || !$flag_disable_right) {
  if ($sidebar_right) {
?>
</div>
<!-- /wrapper -->
<?php } } ?>

<?php
if (COLUMN_LEFT_STATUS == 0 or (CUSTOMERS_APPROVAL == '1' and $_SESSION['customer_id'] == '')) {
  // global disable of column_left
  $flag_disable_left = true;
}
if (!isset($flag_disable_left) || !$flag_disable_left) {
  if ($sidebar_left) {
  ?>
<!-- sub-a -->
<div id="sub-a" class="column sub">
<?php echo $sidebar_left; ?>
</div>
<!-- /sub-a -->
<?php
  } }
?>
<br class="clearBoth" />
<p class="pagetop"><a href="<?php echo $_SERVER['REQUEST_URI'] ?>#skip"><?php echo PAGETOP ; ?></a></p>

</div>
<!-- /content -->

<!-- footer -->
<div id="footer">
<?php
 /**
  * prepares and displays footer output
  *
  */
  require($template->get_template_dir('tpl_footer.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_footer.php');?>

</div>
<!-- /footer -->

<?php
// -> zen_smartphone: container は必要ない
/*
</div>
<!-- /container -->
*/
// <- zen_smartphone: container は必要ない
?>

<?php
// -> zen_smartphone: tmpl = jqt なら、bodyタグと、id="body"は要らない
if ($_REQUEST['tmpl'] != 'jqt') {
?>

</div>
<!-- /body -->

</body>
<?php
}
// <- zen_smartphone: tmpl = jqt なら、bodyタグと、id="body"は要らない
?>
<?php
// -> zen_smartphone: jqt_anchor_id がセットされていたら、div id="..." をセットする
if ($_REQUEST['jqt_anchor_id'] != '') {
?>
</div>
<!-- /post-responce -->
<?php
}
// <- zen_smartphone: jqt_anchor_id がセットされていたら、div id="..." をセットする


// -> zen_smartphone: ajax的な表示の場合は、下記とは別の内容にします
}
else {
// 以下、ajax的な表示の場合のtpl_main_page.php の内容

 /**
  * prepares and displays center column
  *
  */
 require($body_code);

}
// <- zen_smartphone: ajax的な表示の場合は、下記とは別の内容にします
?>
