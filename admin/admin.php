<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers |
// ||
// | http://www.zen-cart.com/index.php|
// ||
// | Portions Copyright (c) 2003 osCommerce |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license, |
// | that is bundled with this package in the file LICENSE, and is|
// | available through the world-wide-web at the following url: |
// | http://www.zen-cart.com/license/2_0.txt. |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to |
// | license@zen-cart.com so we can mail you a copy immediately.|
// +----------------------------------------------------------------------+
//$Id: admin.php 1969 2005-09-13 06:57:21Z drbyte $
//

require('includes/application_top.php');

$action = (isset($_GET['action']) ? $_GET['action'] : '');

if (zen_not_null($action)) {

switch ($action) {
// demo active test
case (zen_admin_demo()):
  $action='';
  $messageStack->add_session(ERROR_ADMIN_DEMO, 'caution');
	zen_redirect(zen_href_link(FILENAME_ADMIN));
  break;
// ----------------------------------------------------------------------------------------------------------------------------------------------------------------
case 'insert':
case 'save':
case 'reset':
// ----------------------------------------------------------------------------------------------------------------------------------------------------------------

$error = false;

if ( ($action == 'insert') || ($action == 'reset') ){
	$password_new = zen_db_prepare_input($_POST['password_new']);
	$password_confirmation = zen_db_prepare_input($_POST['password_confirmation']);

	if (strlen($password_new) < ENTRY_PASSWORD_MIN_LENGTH) {
		$error = true;
		$messageStack->add(ENTRY_PASSWORD_NEW_ERROR, 'error');
	}
	if ($password_new != $password_confirmation) {
		$error = true;
		$messageStack->add(ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING, 'error');
	}
}

if ($error == false) {
	if (isset($_GET['adminID'])) $admins_id = zen_db_prepare_input($_GET['adminID']);
	$admin_name = zen_db_prepare_input($_POST['admin_name']);
	$admin_email = zen_db_prepare_input($_POST['admin_email']);
	$password_new = zen_db_prepare_input($password_new);
	$admin_level = zen_db_prepare_input($_POST['admin_level']);
	$password_new = zen_db_prepare_input($password_new);

	$sql_data_array = array(
		'admin_name' => $admin_name,
		'admin_email' => $admin_email,
		'admin_level' => $admin_level
	);

	if ($action == 'insert') {

		$insert_sql_data = array('admin_pass' => zen_encrypt_password($password_new));
		$sql_data_array = array_merge($sql_data_array, $insert_sql_data);
		zen_db_perform(TABLE_ADMIN, $sql_data_array);
		$admin_id = zen_db_insert_id();
    $admins_id = $admin_id;

	} elseif ($action == 'save') {

		zen_db_perform(TABLE_ADMIN, $sql_data_array, 'update', "admin_id = '" . (int)$admins_id . "'");
    $db->Execute("Update " . TABLE_CONFIGURATION . " set configuration_value='" . $_POST['demo_status'] . "' where configuration_key='ADMIN_DEMO'");

	} elseif ($action == 'reset') {

		$update_sql_data = array('admin_pass' => zen_encrypt_password($password_new));
		$sql_data_array = array_merge($sql_data_array, $update_sql_data);
		zen_db_perform(TABLE_ADMIN, $sql_data_array, 'update', "admin_id = '" . (int)$admins_id . "'");

	} // end action check


	zen_redirect(zen_href_link(FILENAME_ADMIN, (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . 'adminID=' . $admins_id));

} // end error check


//echo $action;
//	zen_redirect(zen_href_link(FILENAME_ADMIN, (isset($_GET['page']) ? 'page=' . '&' : '') . 'adminID=' . $admins_id));
break;
// ----------------------------------------------------------------------------------------------------------------------------------------------------------------

// ----------------------------------------------------------------------------------------------------------------------------------------------------------------
case 'deleteconfirm':
// ----------------------------------------------------------------------------------------------------------------------------------------------------------------
$admin_id = zen_db_prepare_input($_GET['adminID']);

$db->Execute("delete from " . TABLE_ADMIN . " where admin_id = '" . (int)$admin_id . "'");


	zen_redirect(zen_href_link(FILENAME_ADMIN, 'page=' . $_GET['page']));
break;
// ----------------------------------------------------------------------------------------------------------------------------------------------------------------
} // end switch
} // end zen_not_null
?>


<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<script language="javascript" src="includes/menu.js"></script>
<script language="javascript" src="includes/general.js"></script>
<script type="text/javascript">
<!--
function init()
{
cssjsmenu('navbar');
if (document.getElementById)
{
var kill = document.getElementById('hoverJS');
kill.disabled = true;
}
}
// -->
</script>
</head>
<body onload="init()">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
	<tr>
<!-- body_text //-->
		<td width="100%" valign="top">


<?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?>

<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
	</tr>
</table>

<?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?>

<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td valign="top">

<table border="0" width="100%" cellspacing="0" cellpadding="2">
	<tr class="dataTableHeadingRow">
		<td width="10%" class="dataTableHeadingContent"><?php echo TABLE_HEADING_ADMINS_ID; ?></td>
		<td width="35%" class="dataTableHeadingContent"><?php echo TABLE_HEADING_ADMINS_NAME; ?></td>
		<td width="35%" class="dataTableHeadingContent"><?php echo TABLE_HEADING_ADMINS_EMAIL; ?></td>
		<td width="20%" class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
</tr>

<?php
$admins_query_raw = "select admin_id, admin_name, admin_email, admin_pass, admin_level from " . TABLE_ADMIN . " order by admin_name";

$admins_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $admins_query_raw, $admins_query_numrows);

$admins = $db->Execute($admins_query_raw);


while (!$admins->EOF) {
if ((!isset($_GET['adminID']) || (isset($_GET['adminID']) && ($_GET['adminID'] == $admins->fields['admin_id']))) && !isset($adminInfo) && (substr($action, 0, 3) != 'new')) {
	$adminInfo = new objectInfo($admins->fields);
}

if (isset($adminInfo) && is_object($adminInfo) && ($admins->fields['admin_id'] == $adminInfo->admin_id)) {
	echo '<tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . zen_href_link(FILENAME_ADMIN, 'page=' . $_GET['page'] . '&adminID=' . $admins->fields['admin_id'] . '&action=edit') . '\'">' . "\n";
} else {
	echo '<tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . zen_href_link(FILENAME_ADMIN, 'page=' . $_GET['page'] . '&adminID=' . $admins->fields['admin_id'] . '') . '\'">' . "\n";
}
?>

		<td class="dataTableContent"><?php echo $admins->fields['admin_id']; ?></td>
		<td class="dataTableContent"><?php echo $admins->fields['admin_name']; ?></td>
		<td class="dataTableContent"><?php echo $admins->fields['admin_email']; ?></td>
		<td class="dataTableContent" align="right">
<?php echo '<a href="' . zen_href_link(FILENAME_ADMIN, 'page=' . $_GET['page'] . '&adminID=' . $admins->fields['admin_id'] . '&action=edit') . '">' . zen_image(DIR_WS_IMAGES . 'icon_edit.gif', ICON_EDIT) . '</a>'; ?>
<?php echo '<a href="' . zen_href_link(FILENAME_ADMIN, 'page=' . $_GET['page'] . '&adminID=' . $admins->fields['admin_id'] . '&action=delete') . '">' . zen_image(DIR_WS_IMAGES . 'icon_delete.gif', ICON_DELETE) . '</a>'; ?>
<?php echo '<a href="' . zen_href_link(FILENAME_ADMIN, 'page=' . $_GET['page'] . '&adminID=' . $admins->fields['admin_id'] . '&action=resetpassword') . '">' . zen_image(DIR_WS_IMAGES . 'icon_reset.gif', ICON_RESET) . '</a>'; ?>
		</td>
</tr>

<?php
$admins->MoveNext();
}
?>

	<tr>
		<td colspan="2">

<table border="0" width="100%" cellspacing="0" cellpadding="4">
	<tr>
		<td class="smallText" valign="top"><?php echo $admins_split->display_count($admins_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_ADMINS); ?></td>
		<td class="smallText" align="right"><?php echo $admins_split->display_links($admins_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']); ?></td>
	</tr>
</table>

		</td>
	</tr>

<?php
if (empty($action)) {
?>
	<tr>
		<td align="right" colspan="4" class="smallText">
<?php
echo '<a href="' . zen_href_link(FILENAME_ADMIN, 'page=' . $_GET['page'] . '&adminID=' . $adminInfo->admin_id . '&action=new') . '">' . zen_image_button('button_insert.gif', IMAGE_INSERT) . '</a>';
?>
		</td>
	</tr>
<?php
}
?>
</table>
		</td>

<?php
$heading = array();
$contents = array();

switch ($action) {
// ----------------------------------------------------------------------------------------------------------------------------------------------------------------
case 'new':
// ----------------------------------------------------------------------------------------------------------------------------------------------------------------
$heading[] = array('text' => '<b>' . TEXT_HEADING_NEW_ADMIN . '</b>');

$contents = array('form' => zen_draw_form('new_admin', FILENAME_ADMIN, 'action=insert', 'post', 'enctype="multipart/form-data"'));
$contents[] = array('text' => TEXT_NEW_INTRO);

$contents[] = array(
	'text' => '
<br>
' . TEXT_ADMINS_NAME . '<br>' . zen_draw_input_field('admin_name', '', zen_set_field_length(TABLE_ADMIN, 'admin_name', $max=30))
);

$contents[] = array(
	'text' => '
<br>
' . TEXT_ADMINS_EMAIL . '<br>' . zen_draw_input_field('admin_email', '', zen_set_field_length(TABLE_ADMIN, 'admin_email', $max=30))
);

$contents[] = array(
	'text' => '
<br>
' . TEXT_ADMINS_PASSWORD . '<br>' . zen_draw_password_field('password_new', '', zen_set_field_length(TABLE_ADMIN, 'admin_pass', $max=20))
);


$contents[] = array(
	'text' => '
<br>
' . TEXT_ADMINS_CONFIRM_PASSWORD . '<br>' . zen_draw_password_field('password_confirmation', '', zen_set_field_length(TABLE_ADMIN, 'admin_pass', $max=20))
);

$contents[] = array(
	'text' => '
<br>
' . TEXT_ADMINS_LEVEL . '<br>' . zen_draw_input_field('admin_level', '', zen_set_field_length(TABLE_ADMIN, 'admin_level', $max=30))
);

$contents[] = array(
	'align' => 'center',
	'text' => '
<br>
' . zen_image_submit('button_save.gif', IMAGE_SAVE) . '
<a href="' . zen_href_link(FILENAME_ADMIN, 'page=' . $_GET['page'] . '&adminID=' . $_GET['adminID']) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>'
);


break;
// ----------------------------------------------------------------------------------------------------------------------------------------------------------------



// ----------------------------------------------------------------------------------------------------------------------------------------------------------------
case 'edit':
// ----------------------------------------------------------------------------------------------------------------------------------------------------------------
$heading[] = array('text' => '<b>' . TEXT_HEADING_EDIT_ADMIN . '</b>');

$contents = array('form' => zen_draw_form('edit_admin', FILENAME_ADMIN, 'page=' . $_GET['page'] . '&adminID=' . $adminInfo->admin_id . '&action=save', 'post', 'enctype="multipart/form-data"'));

$contents[] = array('text' => TEXT_EDIT_INTRO);

$contents[] = array('text' => '<br><b>' . $adminInfo->admin_id . '</b>&nbsp;-&nbsp;' . $adminInfo->admin_name . '</b>');

$contents[] = array(
	'text' => '
<br>
' . TEXT_ADMINS_NAME . '<br>' . zen_draw_input_field('admin_name', $adminInfo->admin_name, zen_set_field_length(TABLE_ADMIN, 'admin_name', $max=30))
);

$contents[] = array(
	'text' => '
<br>
' . TEXT_ADMINS_EMAIL . '<br>' . zen_draw_input_field('admin_email', $adminInfo->admin_email, zen_set_field_length(TABLE_ADMIN, 'admin_email', $max=30))
);

$admin_current = $db->Execute("select admin_level from " . TABLE_ADMIN . " where admin_id='" . $_SESSION['admin_id'] . "'");
if ($admin_current->fields['admin_level'] == '1') {
  $contents[] = array('text' => '<br>' . TEXT_ADMIN_LEVEL_INSTRUCTIONS);
  $contents[] = array(
	  'text' => '<strong>' . TEXT_ADMINS_LEVEL . '</strong><br>' . zen_draw_input_field('admin_level', $adminInfo->admin_level, zen_set_field_length(TABLE_ADMIN, 'admin_level'))
  );

  $demo_status= zen_get_configuration_key_value('ADMIN_DEMO');
  switch ($demo_status) {
    case '0': $on_status = false; $off_status = true; break;
    case '1':  $on_status = true; $off_status = false; break;
    default: $on_status = false; $off_status = true; break;
  }

  $contents[] = array('text' => '<br>' . TEXT_ADMIN_DEMO);
  $contents[] = array(
	  'text' => '<strong>' . TEXT_DEMO_STATUS . '</strong><br>' . zen_draw_radio_field('demo_status', '1', $on_status) . '&nbsp;' . TEXT_DEMO_ON . '&nbsp;' . zen_draw_radio_field('demo_status', '0', $off_status) . '&nbsp;' . TEXT_DEMO_OFF
  );
}

$contents[] = array(
	'align' => 'center',
	'text' => '
<br>
' . zen_image_submit('button_save.gif', IMAGE_SAVE) . '
<a href="' . zen_href_link(FILENAME_ADMIN, 'page=' . $_GET['page'] . '&adminID=' . $adminInfo->admin_id) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>
');

break;
// ----------------------------------------------------------------------------------------------------------------------------------------------------------------



// ----------------------------------------------------------------------------------------------------------------------------------------------------------------
case 'resetpassword':
// ----------------------------------------------------------------------------------------------------------------------------------------------------------------
$heading[] = array('text' => '<b>' . TEXT_HEADING_RESET_PASSWORD . '</b>');

$contents = array(
'form' => zen_draw_form('reset_password', FILENAME_ADMIN, 'page=' . $_GET['page'] . '&adminID=' . $adminInfo->admin_id . '&action=reset',
'post', 'enctype="multipart/form-data"') . zen_draw_hidden_field('admin_name', $adminInfo->admin_name) . zen_draw_hidden_field('admin_email', $adminInfo->admin_email) . zen_draw_hidden_field('admin_level', $adminInfo->admin_level));

$contents[] = array('text' => TEXT_EDIT_INTRO);

$contents[] = array('text' => '<br><b>' . $adminInfo->admin_id . '</b>&nbsp;-&nbsp;' . $adminInfo->admin_name . '</b>');

$contents[] = array(
	'text' => '
<br>
' . TEXT_ADMINS_PASSWORD . '<br>' . zen_draw_password_field('password_new', '', zen_set_field_length(TABLE_ADMIN, 'admin_pass', $max=25))
);

$contents[] = array(
	'text' => '
<br>
' . TEXT_ADMINS_CONFIRM_PASSWORD . '<br>' . zen_draw_password_field('password_confirmation', '', zen_set_field_length(TABLE_ADMIN, 'admin_pass', $max=25))
);

$contents[] = array(
	'align' => 'center',
	'text' => '
<br>
' . zen_image_submit('button_save.gif', IMAGE_SAVE) . '
<a href="' . zen_href_link(FILENAME_ADMIN, 'page=' . $_GET['page'] . '&adminID=' . $adminInfo->admin_id) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>
');

break;
// ----------------------------------------------------------------------------------------------------------------------------------------------------------------



// ----------------------------------------------------------------------------------------------------------------------------------------------------------------
case 'delete':
// ----------------------------------------------------------------------------------------------------------------------------------------------------------------
$heading[] = array('text' => '<b>' . TEXT_HEADING_DELETE_ADMIN . '</b>');

$contents = array('form' => zen_draw_form('delete_admin', FILENAME_ADMIN, 'page=' . $_GET['page'] . '&adminID=' . $adminInfo->admin_id . '&action=deleteconfirm'));
$contents[] = array('text' => TEXT_DELETE_INTRO);
$contents[] = array('text' => '<br><b>' . $adminInfo->admin_name . '</b>');

$contents[] = array(
	'align' => 'center',
	'text' => '
<br>
' . zen_image_submit('button_delete.gif', IMAGE_DELETE) . '
<a href="' . zen_href_link(FILENAME_ADMIN, 'page=' . $_GET['page'] . '&adminID=' . $adminInfo->admin_id) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>
');

break;
// ----------------------------------------------------------------------------------------------------------------------------------------------------------------



// ----------------------------------------------------------------------------------------------------------------------------------------------------------------
default:
// ----------------------------------------------------------------------------------------------------------------------------------------------------------------
if (isset($adminInfo) && is_object($adminInfo)) {
	$heading[] = array('text' => '<b>' . $adminInfo->admin_name . '</b>');

	$contents[] = array(
	'align' => 'center',
	'text' => '
<a href="' . zen_href_link(FILENAME_ADMIN, 'page=' . $_GET['page'] . '&adminID=' . $adminInfo->admin_id . '&action=edit') . '">' . zen_image_button('button_edit.gif', IMAGE_EDIT) . '</a>
<a href="' . zen_href_link(FILENAME_ADMIN, 'page=' . $_GET['page'] . '&adminID=' . $adminInfo->admin_id . '&action=resetpassword') . '">' . zen_image_button('button_reset_pwd.gif', IMAGE_RESET) . '</a>
<a href="' . zen_href_link(FILENAME_ADMIN, 'page=' . $_GET['page'] . '&adminID=' . $adminInfo->admin_id . '&action=delete') . '">' . zen_image_button('button_delete.gif', IMAGE_DELETE) . '</a>
	');
}

break;
// ----------------------------------------------------------------------------------------------------------------------------------------------------------------
} // end switch action

if ( (zen_not_null($heading)) && (zen_not_null($contents)) ) {
echo '<td width="25%" valign="top">' . "\n";

$box = new box;
echo $box->infoBox($heading, $contents);

echo '</td>' . "\n";
}
?>

	</tr>
</table>


		</td>
<!-- body_text_eof //-->
	</tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>