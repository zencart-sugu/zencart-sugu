<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
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
//  $Id: mail.php 1969 2005-09-13 06:57:21Z drbyte $
//
  require('includes/application_top.php');

//DEBUG:  // these defines will become switches in ADMIN in a future version.
//DEBUG:  // right now, attachments aren't working right unless only sending HTML messages with NO text-only version supplied.
if (EMAIL_ATTACHMENTS_ENABLED=='EMAIL_ATTACHMENTS_ENABLED') define(EMAIL_ATTACHMENTS_ENABLED,false);
if (EMAIL_ATTACHMENT_UPLOADS_ENABLED=='EMAIL_ATTACHMENT_UPLOADS_ENABLED') define(EMAIL_ATTACHMENT_UPLOADS_ENABLED,false);


  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if ($action == 'set_editor') {
    if ($_GET['reset_editor'] == '0') {
      $_SESSION['html_editor_preference_status'] = 'NONE';
    } else {
      $_SESSION['html_editor_preference_status'] = 'HTMLAREA';
    }
    $action='';
    zen_redirect(zen_href_link(FILENAME_MAIL));
  }

  if ( ($action == 'send_email_to_user') && isset($_POST['customers_email_address']) && !isset($_POST['back_x']) ) {
	$audience_select = get_audience_sql_query($_POST['customers_email_address'], 'email');
        $mail = $db->Execute($audience_select['query_string']);
        $mail_sent_to = $audience_select['query_name'];
      if ($_POST['email_to']) {
        $mail_sent_to = $_POST['email_to'];
    }

// error message if no email address
    if (empty($mail_sent_to)) {
      $messageStack->add_session(ERROR_NO_CUSTOMER_SELECTED, 'error');
      $_GET['action']='';
      zen_redirect(zen_href_link(FILENAME_MAIL));
    }

    $from = zen_db_prepare_input($_POST['from']);
    $subject = zen_db_prepare_input($_POST['subject']);
    $message = zen_db_prepare_input($_POST['message']);
    $html_msg['EMAIL_MESSAGE_HTML'] = zen_db_prepare_input($_POST['message_html']);
	$attachment_file = $_POST['attachment_file'];
	$attachment_filetype = $_POST['attachment_filetype'];

    // demo active test
    if (zen_admin_demo()) {
      $_GET['action']= '';
      $messageStack->add_session(ERROR_ADMIN_DEMO, 'caution');
      zen_redirect(zen_href_link(FILENAME_MAIL, 'mail_sent_to=' . urlencode($mail_sent_to)));
    }

    //send message using the zen email function
//echo'EOF-attachments_list='.$attachment_file.'->'.$attachment_filetype;
    $recip_count=0;
    while (!$mail->EOF) {
      $html_msg['EMAIL_FIRST_NAME'] = $mail->fields['customers_firstname'];
      $html_msg['EMAIL_LAST_NAME']  = $mail->fields['customers_lastname'];
      $html_msg['EMAIL_GREET']  = EMAIL_GREET;
      zen_mail($mail->fields['customers_firstname'] . ' ' . $mail->fields['customers_lastname'], $mail->fields['customers_email_address'], $subject, $message, STORE_NAME, $from, $html_msg, 'direct_email', array('file' => $attachment_file, 'file_type'=>$attachment_filetype) );
      $recip_count++;
      $mail->MoveNext();
    }

    zen_redirect(zen_href_link(FILENAME_MAIL, 'mail_sent_to=' . urlencode($mail_sent_to) . '&recip_count='. $recip_count ));
  }

  if ( EMAIL_ATTACHMENTS_ENABLED && $action == 'preview') {
	// PROCESS UPLOAD ATTACHMENTS
	if (isset($_FILES['upload_file']) && zen_not_null($_FILES['upload_file']) && ($_POST['upload_file'] != 'none')) {
	   if ($attachments_obj = new upload('upload_file')) {
		  $attachments_obj->set_destination(DIR_WS_ADMIN_ATTACHMENTS . $_POST['attach_dir']);
		  if ($attachments_obj->parse() && $attachments_obj->save()) {
			  $attachment_file = $_POST['attach_dir'] . $attachments_obj->filename;
			  $attachment_filetype= $_FILES['upload_file']['type'];
		  }
       }
	 }

//DEBUG:
//$messageStack->add('EOF-attachments_list='.$attachment_file.'->'.$attachment_filetype, 'caution');
} //end attachments upload


  if ( ($action == 'preview') && !isset($_POST['customers_email_address']) ) {
    $messageStack->add(ERROR_NO_CUSTOMER_SELECTED, 'error');
  }

  if ( ($_GET['action'] == 'preview') && (!$_POST['subject']) ) {
    $messageStack->add(ERROR_NO_SUBJECT, 'error');
  }

  if ( ($_GET['action'] == 'preview') && (!$_POST['message']) && (!$_POST['message_html']) ) {
    $messageStack->add(ENTRY_NOTHING_TO_SEND, 'error');
  }

  if (isset($_GET['mail_sent_to'])) {
    $messageStack->add(sprintf(NOTICE_EMAIL_SENT_TO, $_GET['mail_sent_to']. '(' . $_GET['recip_count'] . ')'), 'success');
  }
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
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
  if (typeof _editor_url == "string") HTMLArea.replace('message_html');
  }
  // -->
</script>
<?php if ($_SESSION['html_editor_preference_status']=="FCKEDITOR") include (DIR_WS_INCLUDES.'fckeditor.php'); ?>
<?php if ($_SESSION['html_editor_preference_status']=="HTMLAREA")  include (DIR_WS_INCLUDES.'htmlarea.php'); ?>
<script language="javascript" type="text/javascript"><!--
var form = "";
var submitted = false;
var error = false;
var error_message = "";

function check_select(field_name, field_default, message) {
  if (form.elements[field_name] && (form.elements[field_name].type != "hidden")) {
    var field_value = form.elements[field_name].value;

    if (field_value == field_default) {
      error_message = error_message + "* " + message + "\n";
      error = true;
    }
  }
}
function check_message(msg) {
  if (form.elements['message'] && form.elements['message_html']) {
    var field_value1 = form.elements['message'].value;
    var field_value2 = form.elements['message_html'].value;

    if ((field_value1 == '' || field_value1.length < 3) && (field_value2 == '' || field_value2.length < 3)) {
      error_message = error_message + "* " + msg + "\n";
      error = true;
    }
  }
}
function check_input(field_name, field_size, message) {
  if (form.elements[field_name] && (form.elements[field_name].type != "hidden")) {
    var field_value = form.elements[field_name].value;

    if (field_value == '' || field_value.length < field_size) {
      error_message = error_message + "* " + message + "\n";
      error = true;
    }
  }
}
function check_attachments(message) {
  if (form.elements['upload_file'] && (form.elements['upload_file'].type != "hidden") && form.elements['attachment_file'] && (form.elements['attachment_file'].type != "hidden")) {
    var field_value_upload = form.elements['upload_file'].value;
    var field_value_file = form.elements['attachment_file'].value;

    if (field_value_upload != '' && field_value_file != '') {
      error_message = error_message + "* " + message + "\n";
      error = true;
    }
  }
}
function check_form(form_name) {
  if (submitted == true) {
    alert("<?php echo JS_ERROR_SUBMITTED; ?>");
    return false;
  }
  error = false;
  form = form_name;
  error_message = "<?php echo JS_ERROR; ?>";

  check_select("customers_email_address", "", "<?php echo ERROR_NO_CUSTOMER_SELECTED; ?>");
  check_input('subject','',"<?php echo ERROR_NO_SUBJECT; ?>");
//  check_message("<?php echo ENTRY_NOTHING_TO_SEND; ?>");
  check_attachments("<?php echo ERROR_ATTACHMENTS; ?>");

  if (error == true) {
    alert(error_message);
    return false;
  } else {
    submitted = true;
    return true;
  }
}
//--></script>
</head>
<body onload="init()">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo zen_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
            <td class="main">
<?php
// toggle switch for editor
        $editor_array = array(array('id' => '0', 'text' => TEXT_NONE),
                              array('id' => '1', 'text' => TEXT_HTML_AREA));
        echo TEXT_EDITOR_INFO . zen_draw_form('set_editor_form', FILENAME_MAIL, '', 'get') . '&nbsp;&nbsp;' . zen_draw_pull_down_menu('reset_editor', $editor_array, ($_SESSION['html_editor_preference_status'] == 'HTMLAREA' ? '1' : '0'), 'onChange="this.form.submit();"') .
        zen_hide_session_id() . 
        zen_draw_hidden_field('action', 'set_editor') .
        '</form>';
?>
          </td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
  if ( ($action == 'preview') && isset($_POST['customers_email_address']) ) {
	$audience_select = get_audience_sql_query($_POST['customers_email_address']);
    $mail_sent_to = $audience_select['query_name'];
?>
          <tr>
            <td><table border="0" width="100%" cellpadding="0" cellspacing="2">
              <tr>
                <td class="smallText"><b><?php echo TEXT_CUSTOMER; ?></b>&nbsp;&nbsp;&nbsp;<?php echo $mail_sent_to; ?></td>
              </tr>
              <tr>
                <td class="smallText"><b><?php echo TEXT_FROM; ?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo htmlspecialchars(stripslashes($_POST['from'])); ?></td>
              </tr>
              <tr>
                <td class="smallText"><b><?php echo TEXT_SUBJECT; ?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo htmlspecialchars(stripslashes($_POST['subject'])); ?></td>
              </tr>
              <tr>
                <td class="smallText"><b><hr /><?php echo strip_tags(TEXT_MESSAGE_HTML); ?></b></td>
              </tr>
              <tr>
			    <td width="500">
				<?php if (EMAIL_USE_HTML != 'true') echo TEXT_WARNING_HTML_DISABLED.'<br />'; ?>
				<?php echo stripslashes($_POST['message_html']); ?><hr /></td>
              </tr>
              <tr>
                <td class="smallText"><b><?php echo strip_tags(TEXT_MESSAGE); ?></b><br /></td>
              </tr>
              <tr>
			    <td>
				<?php
				$message_preview = ((is_null($_POST['message']) || $_POST['message']=='') ? $_POST['message_html'] : $_POST['message'] );
				$message_preview = str_replace('<br[[:space:]]*/?[[:space:]]*>', "@CRLF", $message_preview);
				$message_preview = str_replace('</p>', '</p>@CRLF', $message_preview);
				echo '<tt>' . str_replace('@CRLF', '<br />', htmlspecialchars(stripslashes(strip_tags($message_preview))) ) . '</tt>';
				?>
				<hr />
				</td>
              </tr>
<?php if (EMAIL_ATTACHMENTS_ENABLED) { ?>
              <tr>
                <td class="smallText"><b><?php echo TEXT_ATTACHMENTS_LIST; ?></b><?php echo '&nbsp;&nbsp;&nbsp;' . ((EMAIL_ATTACHMENT_UPLOADS_ENABLED && zen_not_null($upload_file_name)) ? $upload_file_name : $attachment_file) ; ?></td>
              </tr>
<?php } ?>
              <tr>
                <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
              </tr>
              <tr><?php echo zen_draw_form('mail', FILENAME_MAIL, 'action=send_email_to_user'); ?>
                <td>
<?php
/* Re-Post all POST'ed variables */
    reset($_POST);
    while (list($key, $value) = each($_POST)) {
      if (!is_array($_POST[$key])) {
//        echo zen_draw_hidden_field($key, htmlspecialchars(stripslashes($value)));
        echo zen_draw_hidden_field($key, stripslashes($value));
      }
    }
      echo zen_draw_hidden_field('upload_file', stripslashes($upload_file_name));
      echo zen_draw_hidden_field('attachment_file', $attachment_file);
      echo zen_draw_hidden_field('attachment_filetype', $attachment_filetype);
?>
                <table border="0" width="100%" cellpadding="0" cellspacing="2">
                  <tr>
                    <td><?php echo zen_image_submit('button_back.gif', IMAGE_BACK, 'name="back"'); ?></td>
                    <td align="right"><?php echo '<a href="' . zen_href_link(FILENAME_MAIL) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a> ' . zen_image_submit('button_send_mail.gif', IMAGE_SEND_EMAIL); ?></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </form></tr>
<?php
  } else {
?>
          <tr><?php echo zen_draw_form('mail', FILENAME_MAIL,'action=preview','post', 'onsubmit="return check_form(mail);" enctype="multipart/form-data"'); ?>
            <td><table border="0" cellpadding="0" cellspacing="2">
              <tr>
                <td colspan="2"><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
              </tr>
<?php
    $customers = get_audiences_list('email');
?>
              <tr>
                <td class="main"><?php echo TEXT_CUSTOMER; ?></td>
                <td><?php echo zen_draw_pull_down_menu('customers_email_address', $customers, (isset($_GET['customer']) ? $_GET['customer'] : ''));  //, 'multiple' ?></td>
              </tr>
              <tr>
                <td colspan="2"><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
              </tr>
              <tr>
                <td class="main"><?php echo TEXT_FROM; ?></td>
                <td><?php echo zen_draw_input_field('from', EMAIL_FROM, 'size="50"'); ?></td>
              </tr>
              <tr>
                <td colspan="2"><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
              </tr>
              <tr>
                <td class="main"><?php echo TEXT_SUBJECT; ?></td>
                <td><?php echo zen_draw_input_field('subject', $_POST['subject'], 'size="50"'); ?></td>
              </tr>
              <tr>
                <td colspan="2"><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
              </tr>
              <tr>
                <td valign="top" class="main"><?php echo TEXT_MESSAGE_HTML; //HTML version?></td>
                <td class="main" width="750">
				<?php if (is_null($_SESSION['html_editor_preference_status'])) echo TEXT_HTML_EDITOR_NOT_DEFINED; ?>
				<?php if (EMAIL_USE_HTML != 'true') echo TEXT_WARNING_HTML_DISABLED; ?>
				<?php if ($_SESSION['html_editor_preference_status']=="FCKEDITOR") {
					$oFCKeditor = new FCKeditor ;
					$oFCKeditor->Value = stripslashes($_POST['message_html']) ;
					$oFCKeditor->CreateFCKeditor( 'message_html', '97%', '350' ) ;  //instanceName, width, height (px or %)
					} else { // using HTMLAREA or just raw "source"

  if (EMAIL_USE_HTML == 'true') {
					echo zen_draw_textarea_field('message_html', 'soft', '100%', '25', stripslashes($_POST['message_html']), 'id="message_html"');
}
					} ?>
				</td>
              </tr>
              <tr>
                <td colspan="2"><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
              </tr>
              <tr>
                <td valign="top" class="main"><?php echo TEXT_MESSAGE; ?></td>
                <td><?php echo zen_draw_textarea_field('message', 'soft', '100%', '15', $_POST['message']); ?></td>
              </tr>

<?php if (EMAIL_ATTACHMENTS_ENABLED) { ?>
		  <tr>
			<td colspan="2"><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
		  </tr>
		  <?php if (EMAIL_ATTACHMENT_UPLOADS_ENABLED) { ?>
				<?php
				  $dir = @dir(DIR_WS_ADMIN_ATTACHMENTS);
				  $dir_info[] = array('id' => '', 'text' => "admin-attachments");
				  while ($file = $dir->read()) {
					if (is_dir(DIR_WS_ADMIN_ATTACHMENTS . $file) && strtoupper($file) != 'CVS' && $file != "." && $file != "..") {
					  $dir_info[] = array('id' => $file . '/', 'text' => $file);
					}
				  }
				?>
			  <tr>
				<td class="main" valign="top"><?php echo TEXT_SELECT_ATTACHMENT_TO_UPLOAD; ?></td>
				<td class="main"><?php echo zen_draw_file_field('upload_file') . '<br />' . stripslashes($_POST['upload_file']) . zen_draw_hidden_field('prev_upload_file', stripslashes( $_POST['upload_file']) ); ?><br />
				<?php echo TEXT_ATTACHMENTS_DIR; ?>&nbsp;<?php echo zen_draw_pull_down_menu('attach_dir', $dir_info); ?></td>
			  </tr>
			  <tr>
				<td colspan="2"><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
			  </tr>
		 <?php  } // end upload dialog ?>
		<?php
		  $dir = @dir(DIR_WS_ADMIN_ATTACHMENTS);
		  $file_list[] = array('id' => '', 'text' => "(none)");
		  while ($file = $dir->read()) {
			if (is_file(DIR_WS_ADMIN_ATTACHMENTS . $file) && strtoupper($file) != 'CVS' && $file != "." && $file != "..") {
			  $file_list[] = array('id' => $file , 'text' => $file);
			}
		  }
		?>
          <tr>
            <td class="main" valign="top"><?php echo TEXT_SELECT_ATTACHMENT; ?></td>
            <td class="main"><?php echo zen_draw_pull_down_menu('attachment_file', $file_list, $_POST['attachment_file']); ?></td>
              </tr>
<?php } // end attachments fields ?>
              <tr>
                <td colspan="2"><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
              </tr>
<?php
  if (isset($_GET['origin'])) {
   $origin = $_GET['origin'];
  } else {
   $origin = FILENAME_DEFAULT;
  }
  if (isset($_GET['mode']) && $_GET['mode'] == 'SSL') {
   $mode = 'SSL';
  } else {
   $mode = 'NONSSL';
  }
 ?>
              <tr>
                <td colspan="2" align="right"><?php echo zen_image_submit('button_preview.gif', IMAGE_PREVIEW) . '&nbsp;' .
                '<a href="' . zen_href_link($origin, 'cID=' . zen_db_prepare_input($_GET['cID']), $mode) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>'; ?></td>
              </tr>
            </table></td>
          </form></tr>
<?php
  }
?>
<!-- body_text_eof //-->
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br />
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>