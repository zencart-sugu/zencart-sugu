<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2004 The zen-cart developers                           |
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
//  $Id: admin_email_templates.php,v 1.2 2005/03/01 05:46:42 shida Exp $
//

/*
	The original file was made by osCommerce project
	and can be found here: http://www.oscommerce.com/community/contributions,2866/category,all/search,mail+template

  Modified by Kazuya Nouchi for Zen Cart Japanese Project
*/

 	$is_html = false;
	if(isset($_GET['action']) && $_GET['action'] == 'update'){
		if(zen_not_null($_POST['Submit_Action'])){
			$id = zen_db_prepare_input($_POST['id']);
			$delete = zen_db_prepare_input($_POST['delete']);
			$title = zen_db_prepare_input($_POST['title']);
			$subject = zen_db_prepare_input($_POST['subject']);
			$contents = zen_db_prepare_input($_POST['contents']);
			$group_template = (zen_not_null($_POST['grp_new'])) ? zen_db_prepare_input($_POST['grp_new']) : zen_db_prepare_input($_POST['grp']);
						
			if(!zen_not_null($group_template)){
        $messageStack->add_session(TEXT_EMAIL_TEMPLATE_GROUP_EMPTY, 'error');
        zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('action', 'id')).'module=' . FILENAME_EMAIL_TEMPLATES . '&action=update&id=' . $id, 'NONSSL'));
			}

      // 注文グループチェック
      if (($id == 0 || $id > 3) &&
          ($group_template == MODULE_EMAIL_TEMPLATE_CREATE_ACCOUNT_MAIL_GRP ||
           $group_template == MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_MAIL_GRP)) {
        $messageStack->add_session(TEXT_EMAIL_TEMPLATE_OTHER_GROUP, 'error');
        zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('action', 'id')).'module=' . FILENAME_EMAIL_TEMPLATES . '&action=update&id=' . $id, 'NONSSL'));
      }

			if(!zen_not_null($_POST['title'])){
        $messageStack->add_session(TEXT_EMAIL_TEMPLATE_TITLE_EMPTY, 'error');
        zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('action', 'id')).'module=' . FILENAME_EMAIL_TEMPLATES . '&action=update&id=' . $id, 'NONSSL'));
			}
	
			if(!zen_not_null($msg)){
				if((int)$id > 0){
					if(zen_not_null($delete)){
    				if((int)$id > 3){
  						$sql = "delete from " . TABLE_EMAIL_TEMPLATES . " where id = '" . (int)$id . "'";
  					}
					}else{
						$sql = "update " . TABLE_EMAIL_TEMPLATES . " set 
										grp = '" . zen_db_input($group_template) . "', 
										title = '" . zen_db_input($title) . "', 
										subject = '" . zen_db_input($subject) . "', 
										contents = '" . zen_db_input($contents) . "', 
										updated = '" . date("Y-m-d H:i:s") . "' 
										where id = '" . (int)$id . "'";
		        $messageStack->add_session(sprintf(TEXT_EMAIL_TEMPLATE_UPDATED_MESSAGE, $title), 'success');
					}
				}else{
					$sql = "insert into " . TABLE_EMAIL_TEMPLATES . " (grp, title, subject, contents, updated) values ( 
									'" . zen_db_input($group_template) . "', 
									'" . zen_db_input($title) . "', 
									'" . zen_db_input($subject) . "', 
									'" . zen_db_input($contents) . "', 
									'" . date("Y-m-d H:i:s")."') ";
	        $messageStack->add_session(sprintf(TEXT_EMAIL_TEMPLATE_ADDED_MESSAGE, $title), 'success');
				}
				$db->Execute($sql);
				if(zen_not_null($delete)) {
				  zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('action', 'delete', 'id', 'module')) . 'module=' . FILENAME_EMAIL_TEMPLATES , 'NONSSL'));
				}
				else {
				  zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('action', 'id', 'module'))."id=$id&module=" . FILENAME_EMAIL_TEMPLATES, 'NONSSL'));	
				}
			}
		}
		
		$hidden_field = zen_draw_hidden_field('id', '0') . zen_draw_hidden_field('Submit_Action', '1');
		$submit_field = zen_image_submit('button_save.gif', IMAGE_SAVE) . ' <a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('action', 'delete', 'module')) . 'module=' . FILENAME_EMAIL_TEMPLATES, 'NONSSL') .'">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>'; 
		$form_title   = TABLE_HEADING_ADD;

    $id = 0;
		if(zen_not_null($_POST['id']) || zen_not_null($_GET['id'])){
			$id  = (zen_not_null($_POST['id'])) ? $_POST['id'] : $_GET['id'];
			$result = $db->Execute("select * from " . TABLE_EMAIL_TEMPLATES . " where id = '" . (int)$id . "'");
			if($result->RecordCount() > 0){
				$hidden_field = zen_draw_hidden_field('id', $id) . zen_draw_hidden_field('Submit_Action', '1');
				if ($_GET['delete'] && $id>3)
					$submit_field = zen_draw_checkbox_field('delete', 1, $_GET['delete'], '') . '<font color="red">'.TEXT_EMAIL_TEMPLATE_DELETE.'&nbsp;&nbsp;&nbsp;&nbsp;' . $submit_field;
				$form_title   = TABLE_HEADING_UPDATE;
				$P = $result->fields;
			}
		}
		
		$grp_text = zen_get_email_group($db, $P['grp'], $id);
		
		if (HTML_EDITOR_PREFERENCE != "NONE" && EMAIL_USE_HTML == 'true') {
		  $out = zen_draw_form('email_template', FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('action', 'id', 'delete', 'module')).'action=' . $_GET['action'] . '&module=' . FILENAME_EMAIL_TEMPLATES, 'post') . '
						<table width="100%" border="0" cellspacing="1" cellpadding="2">
							<tr class="dataTableHeadingRow"><td class="dataTableHeadingContent" colspan="2" height="25"><b>' . $form_title . '</b></td></tr>
							<tr class="dataTableRow"><td class="dataTableContent" width="30%" nowrap><b>' . TABLE_HEADING_GROUP . '</b>' . TEXT_FIELD_REQUIRED . '</td><td class="dataTableContent" width="70%">' . $grp_text . '</td></tr>
							<tr class="dataTableRow"><td class="dataTableContent" nowrap><b>' . TABLE_HEADING_TITLE . '</b>' . TEXT_FIELD_REQUIRED . '</td><td>' . zen_draw_input_field('title', stripslashes($P['title']), zen_set_field_length(TABLE_EMAIL_TEMPLATES, 'title', 50)) . '</td></tr>
							<tr class="dataTableRow"><td class="dataTableContent" nowrap><b>' . TABLE_HEADING_EMAIL_SUBJECT . '</b></td><td>' . zen_draw_input_field('subject', stripslashes($P['subject']), zen_set_field_length(TABLE_EMAIL_TEMPLATES, 'subject', 50)) . '</td></tr>
							<tr class="dataTableRow"><td class="dataTableContent" valign="top"><b>' . TABLE_HEADING_EMAIL_CONTENTS . '</b>' . TABLE_HEADING_HELP . '</td><td>'; 
			if (HTML_EDITOR_PREFERENCE=="FCKEDITOR") {
				include (DIR_WS_INCLUDES.'fckeditor.php');
				$oFCKeditor = new FCKeditor ;
				$oFCKeditor->Value = stripslashes($P['contents']);
				$out .= $oFCKeditor->ReturnFCKeditor( 'contents', '700', '350' ) ;  //instanceName, width, height (px or %)
			}	
			else { // using HTMLAREA or just raw "source"
				$out .= zen_draw_textarea_field('contents', 'soft', '76', '20', stripslashes($P['contents']), 'style="width:100%"', 'false');
			}
			$out .= ' </td></tr>
							<tr class="dataTableRow"><td class="dataTableContent" colspan="2" align="center"><br><p>' . $hidden_field . $submit_field . '</p>&nbsp;</td></tr>
						</table>
						</form>';
			$is_html = true;
		}
	}
	if (!$is_html) {
		$search_query = '';
		if (isset($_GET['search']) && zen_not_null($_GET['search'])) {
			$search_query = sprintf(" where grp like '%%%s%%' or title like '%%%s%%' or subject like '%%%s%%'",
				$_GET['search'], $_GET['search'], $_GET['search']);
		}
		$query_raw = "select * from " . TABLE_EMAIL_TEMPLATES . "$search_query order by grp asc";
		$page = zen_not_null($_GET['page']) ? $_GET['page'] : 1;
		$split_page = new splitPageResults($page, MAX_DISPLAY_SEARCH_RESULTS, $query_raw, $query_numrows);
		$result  = $db->Execute($query_raw);
	
		$out .= '<table width="100%" border="0" cellspacing="0" cellpadding="2">
							<tr class="dataTableHeadingRow" height="25">
								<td class="dataTableHeadingContent">' . TABLE_HEADING_GROUP . '</td>
								<td class="dataTableHeadingContent">' . TABLE_HEADING_TITLE . '</td>
								<td class="dataTableHeadingContent">' . TABLE_HEADING_EMAIL_SUBJECT . '</td>
								<td  class="dataTableHeadingContent">' . TABLE_HEADING_LAST_UPDATE . '</td>
								<td class="dataTableHeadingContent" align="right">' . TABLE_HEADING_ACTION . '</td>
							</tr>';
		$bSelected = 0;
		$bSelected_body = '';
		$id  = zen_not_null($_POST['id']) ? $_POST['id'] : $_GET['id'];
		$total = $result->RecordCount();
		while (!$result->EOF) {
			$line = $result->fields;
			if ($id == $line['id'] || (!$id && !$bSelected)) {
			  $out .= '<tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('action', 'delete', 'id', 'module')).'action=update&id=' . $line['id']. '&module=' . FILENAME_EMAIL_TEMPLATES, 'NONSSL') . '\'">' . "\n";
				$bSelected = $line['id'];
				$bSelected_body = $line['contents'];
			}
			else
			  $out .= '<tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('id', 'module')) . 'id=' . $line['id']. '&module=' . FILENAME_EMAIL_TEMPLATES, 'NONSSL') . '\'">'. "\n";
			$out .=	'	<td class="dataTableContent" valign="top">' . zen_output_string_protected($line['grp']) . '</td>
								<td class="dataTableContent" valign="top">' . zen_output_string_protected($line['title']) . '</td>
								<td class="dataTableContent" valign="top">' . zen_output_string_protected($line['subject']) . '</td>
								<td class="dataTableContent" valign="top">' . zen_date_long($line['updated']) . '</td>
								<td class="dataTableContent" align="right">
							   <a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('action', 'delete', 'id', 'module')).'action=update&id=' . $line['id']. '&module=' . FILENAME_EMAIL_TEMPLATES, 'NONSSL') . '">' . zen_image(DIR_WS_IMAGES . 'icon_edit.gif', ICON_EDIT) . '</a>';
      // 1～4はデフォルトのテンプレなので削除不可
      if ($line['id'] > 4)
        $out .= ' <a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('action', 'delete', 'id', 'module')) . 'action=update&delete=1&id=' . $line['id'] . '&module=' . FILENAME_EMAIL_TEMPLATES, 'NONSSL') . '">' . zen_image(DIR_WS_IMAGES . 'icon_delete.gif', ICON_DELETE) . '</a> ';
      else
        $out .= zen_draw_separator('pixel_trans.gif', 24, 16);
      $out .= (($bSelected == $line['id']) ? zen_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', '') : '<a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('id', 'module')) . 'id=' . $line['id'] . '&module=' . FILENAME_EMAIL_TEMPLATES, 'NONSSL') . '">' . zen_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>') .
							 '</td></tr>';
			$result->MoveNext();
		}
		$out .= "<tr>\n";
		$out .= '<td colspan="4" align="center" class="smallText">' . $split_page->display_count($query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $page, TEXT_DISPLAY_NUMBER_OF_ADMINS) . '<br />';
		$out .= $split_page->display_links($query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $page);
		$out .= "</td></tr>\n";
		if (!$_GET['action'])
		{
			$out .= "<tr>\n";
			$out .= '<td colspan="4" align="center">'.'<a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('action', 'id', 'module')).'action=update&id=0&module=' . FILENAME_EMAIL_TEMPLATES, 'NONSSL') . '">' . zen_image_button('button_insert.gif', IMAGE_INSERT) . "</a></td>\n";
			$out .= "</tr>\n";
		}
		$out .= "</table>\n";
	}
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<script language="javascript" src="includes/general.js"></script>
<script language="javascript" src="includes/menu.js"></script>
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
  if (typeof _editor_url == "string") HTMLArea.replaceAll();
  }
  // -->
</script>
<?php if (HTML_EDITOR_PREFERENCE=="HTMLAREA")  include (DIR_WS_INCLUDES.'htmlarea.php'); ?>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF" onload="init()">
<div id="spiffycalendar" class="text"></div>
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
<!-- body_text //-->
    <td width="100%" valign="top">
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
		  <tr>
			<td colspan="2">
				<table border="0" width="100%" cellspacing="0" cellpadding="0">
				  <tr><?php echo zen_draw_form('search', FILENAME_ADDON_MODULES_ADMIN, 'module=' . FILENAME_EMAIL_TEMPLATES, 'get', '', true); ?>
					<td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
					<td class="pageHeading" align="right"><?php echo zen_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
					<td class="smallText" align="right" valign="middle">
<?php
// show reset search
    if (isset($_GET['search']) && zen_not_null($_GET['search'])) {
      echo '<a href="' . zen_href_link(FILENAME_ADMIN_EMAIL_TEMPLATES, '', 'NONSSL') . '">' . zen_image_button('button_reset.gif', IMAGE_RESET, 'align="center"') . '</a>&nbsp;&nbsp;';
    }
    echo HEADING_TITLE_SEARCH_DETAIL . ' ' . zen_draw_input_field('search');
    if (isset($_GET['search']) && zen_not_null($_GET['search'])) {
      $keywords = zen_db_input(zen_db_prepare_input($_GET['search']));
      echo '<br/ >' . TEXT_INFO_SEARCH_DETAIL_FILTER . $keywords;
    }
?>
					</td>
				  </form></tr>
				</table>
			</td>
		  </tr>
		  <tr>
			  <td valign="top">
<?php 
###############################################################################################
	echo $out;
###############################################################################################		
?>
			  </td>
<?php
	if (!$is_html && $total > 0)
	{
		$heading = array();
	  $contents = array();
	  switch ($_GET['action']) {
	  	case 'update':
	  		$heading[] = array('text' => '<b>' . $form_title . '</b>');
			$contents = array('form' => zen_draw_form('email_template', FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('action', 'id', 'delete', 'module')).'action=' . $_GET['action'] . '&module=' . FILENAME_EMAIL_TEMPLATES, 'post'));
	  		$contents[] = array('text' => '<b>' . TABLE_HEADING_GROUP . '</b>' . TEXT_FIELD_REQUIRED);
	  		$contents[] = array('text' => $grp_text);
	  		$contents[] = array('text' => '<br /><b>' . TABLE_HEADING_TITLE . '</b>' . TEXT_FIELD_REQUIRED);
	  		$contents[] = array('text' => zen_draw_input_field('title', stripslashes($P['title']), zen_set_field_length(TABLE_EMAIL_TEMPLATES, 'title', 50)));
	  		$contents[] = array('text' => '<br /><b>' . TABLE_HEADING_EMAIL_SUBJECT . '</b>');
	  		$contents[] = array('text' => zen_draw_input_field('subject', stripslashes($P['subject']), zen_set_field_length(TABLE_EMAIL_TEMPLATES, 'subject', 50)));
	  		$contents[] = array('text' => '<br /><b>' . TABLE_HEADING_EMAIL_CONTENTS . '</b><br />' . TABLE_HEADING_HELP);
	  		//$contents[] = array('text' => zen_draw_textarea_field('contents', 'soft', '50', '15', stripslashes($P['contents'])));
	  		$contents[] = array('text' => '<textarea name="contents" rows="15" cols="50" wrap="soft">'.stripslashes($P['contents']).'</textarea>');
	  		$contents[] = array('text' => $hidden_field);
	  		$contents[] = array('align' => 'center', 'text' => '<br />' . $submit_field);
	  		break;
	  	default:
	  		$heading[] = array('text' => '<b>' . TITLE_LIST_EMAIL_TEMPLATE .'</b>');
	  		$contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('action', 'id', 'module')).'action=update&id=' . $bSelected . '&module=' . FILENAME_EMAIL_TEMPLATES, 'NONSSL') . '">' . zen_image_button('button_edit.gif', IMAGE_EDIT) . '</a> <a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('action', 'delete', 'id', 'module')).'action=update&delete=1&id=' . $bSelected . '&module=' . FILENAME_EMAIL_TEMPLATES, 'NONSSL') . '">' . zen_image_button('button_delete.gif', IMAGE_DELETE) . '</a>');
	  		$contents[] = array('text' => '<br /><b>' . TABLE_HEADING_EMAIL_CONTENTS . '</b>');
	  		//$contents[] = array('text' => nl2br(zen_output_string_protected($bSelected_body)));
	  		$contents[] = array('text' => nl2br($bSelected_body));
	  		break;
	  }
	  if (zen_not_null($heading) && zen_not_null($contents)) {
	    echo '            <td width="25%" valign="top">' . "\n";
	
	    $box = new box;
	    echo $box->infoBox($heading, $contents);
	
	    echo '            </td>' . "\n";
	  }
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
