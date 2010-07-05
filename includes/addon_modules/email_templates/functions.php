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
//  $Id: email_templates.php,v 1.1 2005/03/01 05:46:42 shida Exp $
//

/*
	The original file was made by osCommerce project
	and can be found here: http://www.oscommerce.com/community/contributions,2866/category,all/search,mail+template

  Modified by Kazuya Nouchi for Zen Cart Japanese Project
*/

	function zen_email_templates_getdata(&$db, $form_name, $form_subject_field_name, $form_message_field_name, $template_id='', $group=''){

		$sql  = "select * from " . TABLE_EMAIL_TEMPLATES . " where 1 ";
		if((int)$template_id > 0){
			$sql .= " and id='{$template_id}' ";
		}elseif(zen_not_null($group)){
			$sql .= " and grp='{$group}' ";
		}
		$sql .= " order by grp asc ";
		$result = $db->Execute($sql);
		$total_templates = $result->RecordCount();
		if((int)$template_id > 0){
		  $line = $result->fields;
			$out  = stripslashes($line['title']);
		}elseif((int)$total_templates > 0) {
			$i = 0; $grp_text = '';
			while (!$result->EOF) {
				$line = $result->fields;
				if($grp_text != $line['grp']){
					$grp_text = $line['grp'];
					$arr[] = array('id' => '', 'text' => '[' . stripslashes($line['grp']) . ']');
				}
				$arr[] = array('id' => $line['id'], 'text' => '&nbsp;&nbsp;->&nbsp;&nbsp;' . stripslashes($line['title']));
				$hidden .= "\n" . zen_draw_hidden_field('subject_' . $line['id'], htmlspecialchars(stripslashes($line['subject']),ENT_QUOTES)) . "\n";

				if(EMAIL_USE_HTML == 'true'){
					$hidden .= "\n" . zen_draw_hidden_field('contents_' . $line['id'], htmlspecialchars(stripslashes($line['contents']),ENT_QUOTES)) . "\n";
				}else{
					$hidden .= "\n" . zen_draw_hidden_field('contents_' . $line['id'], htmlspecialchars(strip_tags(stripslashes($line['contents'])),ENT_QUOTES)) . "\n";
				}
				$result->MoveNext();
			}
			$out .= "\n
						<script language=\"JavaScript\">\n
						function stripTags(oldString) {\n
							return oldString.replace(/(<([^>]+)>)/ig,'');\n
						}\n

						function change_email_template(id){\n
							var txtObjContents = document.{$form_name}.{$form_message_field_name};\n
							if (id == \"\") return;
						";
			if(zen_not_null($form_subject_field_name)){
				$out .= "var txtObjSubject  = document.{$form_name}.{$form_subject_field_name};\n
								 txtObjSubject.value = eval('document.{$form_name}.subject_' + id + '.value');\n
						";
			}
			if (EMAIL_USE_HTML == 'true'){
				$out .= "txtObjContents.value = eval('document.{$form_name}.contents_' + id + '.value');\n";
				if (HTML_EDITOR_PREFERENCE == "HTMLAREA") {
					$out .= "if (editor != null) editor.setHTML(txtObjContents.value);\n";
				}elseif (HTML_EDITOR_PREFERENCE=="FCKEDITOR") {
					$out .= "document.frames[0].document.objContent.DOM.body.innerHTML = txtObjContents.value;\n";
				}
			}else{
				$out .= "txtObjContents.value = stripTags(eval('document.{$form_name}.contents_' + id + '.value'));\n";
			}

			$out .= "
						}\n
						</script>\n\n";

			$out .= zen_draw_pull_down_menu('grp', $arr, $template_id, 'onchange="javascript:change_email_template(this.value);"') . "\n";
			$out .= '&nbsp;[<a href="' . zen_href_link(FILENAME_ADMIN_EMAIL_TEMPLATES, '', 'NONSSL') . '">' . TEXT_EMAIL_TEMPLATE_SETUP_PAGE . '</a>]' . "\n";
			$out .= $hidden . "\n";
		}else{
			$out  = TEXT_EMAIL_TEMPLATE_EMPTY . "\n";
			$out .= '&nbsp;[<a href="' . zen_href_link(FILENAME_ADMIN_EMAIL_TEMPLATES, '', 'NONSSL') . '">' . TEXT_EMAIL_TEMPLATE_SETUP_PAGE . '</a>]' . "\n";
		}
		return $out;
	}

	function zen_email_templates_replace_keywords(&$db, $email_contents, &$customers_email, $customers_id){
		if((int)$customers_id){
      $customers_query = $db->Execute("select * from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$customers_id . "'");
  	}elseif(zen_not_null($customers_email)){
      $customers_query = $db->Execute("select * from " . TABLE_CUSTOMERS . " where customers_email_address = '" . $customers_email . "'");
		}

		if($customers_query->RecordCount() > 0 && zen_not_null($email_contents)){
			$customers = $customers_query->fields;
			$out = $email_contents;
			$out = str_replace('[CUSTOMER_NAME]', stripslashes($customers['customers_firstname'] . ' ' . $customers['customers_lastname']), $out);
			$out = str_replace('[CUSTOMER_EMAIL]', $customers['customers_email_address'], $out);
			$out = str_replace('[CUSTOMER_DOB]', zen_date_long($customers['customers_dob']), $out);
			$out = str_replace('[CUSTOMER_PHONE]', $customers['customers_telephone'], $out);
			$out = str_replace('[CUSTOMER_FAX]', $customers['customers_fax'], $out);
	  	if(!zen_not_null($customers_email)){
				$customers_email = $customers['customers_email_address'];
			}
		}else{
			$out = $email_contents;
		}
		return $out;
	}

	function zen_get_email_from($from, &$from_email_name, &$from_email_address){
		if(substr_count($from, '<')){
			$from_array = explode('<', $from);
			$from_email_name = trim($from_array[0]);
			$from_email_address = str_replace('>', '', trim($from_array[1]));
		}elseif(substr_count($from, '@')){
			$from_email_name = '';
			$from_email_address = $from;
		}else{
			$from_email_name = STORE_NAME;
			$from_email_address = STORE_OWNER_EMAIL_ADDRESS;
		}
		return true;
	}

	function zen_get_email_group(&$db, $grp = '', $id) {
    if ((int)$id >=1 && (int)$id <= 3)
  		$result = $db->Execute("select distinct grp as 'grp' from " . TABLE_EMAIL_TEMPLATES . " where id=".(int)$id." order by 1 asc");
    else
  		$result = $db->Execute("select distinct grp as 'grp' from " . TABLE_EMAIL_TEMPLATES . " where id>3 order by 1 asc");
		if($result->RecordCount() > 0){
			$i = 0;
		  while (!$result->EOF) {
		  	$line = $result->fields;
				$arr[$i]['id'] = $arr[$i]['text'] = stripslashes($line['grp']);
				$i++;
				$result->MoveNext();
			}
			$out  = zen_draw_pull_down_menu('grp', $arr, $grp);
      if ((int)$id == 0 || (int)$id > 3)
			  $out .= TEXT_EMAIL_TEMPLATE_NEW_GROUP . zen_draw_input_field('grp_new', '', zen_set_field_length(TABLE_EMAIL_TEMPLATES, 'grp', 25));
		}else{
			$out  = zen_draw_input_field('grp_new', '', zen_set_field_length(TABLE_EMAIL_TEMPLATES, 'grp', 25)) . TEXT_EMAIL_TEMPLATE_NO_GROUP;
		}
		return $out;
	}

	function zen_get_email_group_for_status($order_id) {

		//ここはget_email_templatesに置き換え
    global $db;

    $arr   = array();
    $arr[] = array('id'   => '',
                   'text' => MODULE_EMAIL_TEMPLATE_STATUS_CHANGE_NO_NOTIFY);
    $result = $db->Execute("select distinct id, grp, title from " . TABLE_EMAIL_TEMPLATES . " where id>3 order by 1 asc");

		if($result->RecordCount() > 0){
		  while (!$result->EOF) {
		  	$line = $result->fields;
				$arr[] = array('id'   => $line['id'],
				               'text' => $line['grp'] . ' => ' . $line['title']);
				$result->MoveNext();
			}
		}

  	$out  = zen_draw_pull_down_menu('grp', $arr, $grp, 'id="grp" onChange="changeEmailTemplate()"');
		return '<script type="text/javascript">
            <!--
            function changeEmailTemplate()
            {
              var grp               = document.getElementById("grp");
              var comments          = document.getElementById("comments");
              var notify            = document.getElementById("notify");
              var notify_comments   = document.getElementById("notify_comments");
              var email_template_id = document.getElementById("email_template_id");

              // しない？
              if (grp.value == "") {
                if (comments)
                  comments.value = "";
                if (notify)
                  notify.value = "";
                if (notify_comments)
                  notify_comments.value = "";
                if (email_template_id)
                  email_template_id.value = "";
              }
              // する？
              else {
                $.ajax({
                  type: "GET",
                  url:  "'.zen_href_link("../index.php?main_page=addon").'",
                  data: {
                    module: "email_templates",
                    id:   grp.value,
                    order_id: ' . $order_id . '
                  },
                  success: function(msg) {
                    var comments = document.getElementById("comments");
                    if (comments)
                      comments.value = msg;
                  }
                });
                if (notify)
                  notify.value = "on";
                if (notify_comments)
                  notify_comments.value = "on";
                if (email_template_id)
                  email_template_id.value = grp.value;
              }
            }
            // -->
            </script>
		       ' . $out .
		       zen_draw_hidden_field('email_template_id', '', 'id="email_template_id"');
	}

	function zen_get_email_template_for_status() {

		$templates = get_email_templates();
		$out = "<strong>" . TEXT_SELECT_EMAIL_TEMPLATES . "</strong>";
		$out .= zen_draw_pull_down_menu('et_id', $templates, $grp, 'id="et_id"');

		$languages = get_languages();
		$out .= "　　<strong>" . TEXT_SELECT_LANGUAGES . "</strong>";
		$out .= zen_draw_pull_down_menu('lang_id', $languages, '', 'id="lang_id"');

		//zencartのformヘルパーに変更する
		$out  .= "<br /><input type='button' value='読込' 'onClick=\"readEmailTemplate();\"' />";

		return '<script type="text/javascript">
	        <!--
	        function readEmailTemplate()
	        {
						var comments          = document.getElementById("comments");
						var notify            = document.getElementById("notify");
						var notify_comments   = document.getElementById("notify_comments");
						var email_template_id = document.getElementById("et_id");
						var language_id = document.getElementById("lang_id");

						$.ajax({
						  type: "GET",
						  url:  "'.zen_href_link("../index.php?main_page=addon").'",
						  data: {
						    module: "email_templates",
						    id:   email_template_id.value,
						    language_id: language_id.value
						  },
						  success: function(msg) {
						    var comments = document.getElementById("comments");
						    if (comments)
						      comments.value = msg;
						  }
						});
						if (notify)
								notify.value = "on";
						if (notify_comments)
								notify_comments.value = "on";
	        }
	        // -->
	        </script>
		       ' . $out .
		       zen_draw_hidden_field('email_template_id', '', 'id="email_template_id"');

	}

	function get_email_templates() {
		global $db;

    $arr   = array();
    //$arr[] = array('id'   => '',
                   //'text' => MODULE_EMAIL_TEMPLATE_STATUS_CHANGE_NO_NOTIFY);
    $result = $db->Execute("select distinct id, grp, title from " . TABLE_EMAIL_TEMPLATES . " where id>3 order by 1 asc");

		if($result->RecordCount() > 0){
			while (!$result->EOF) {
				$line = $result->fields;
				$arr[] = array('id'   => $line['id'],
				               'text' => $line['grp'] . "=>" . $line['title']);
				$result->MoveNext();
			}
		}

		return $arr;
	}

	function get_languages() {
		global $db;

		$languages = array();
		$language = $db->Execute("select languages_id, name from " . TABLE_LANGUAGES);
		while (!$language->EOF) {
			$languages[] = array('id' => $language->fields['languages_id'], 'text' => $language->fields['name']);
			$language->MoveNext();
		}

		return $languages;
	}
?>