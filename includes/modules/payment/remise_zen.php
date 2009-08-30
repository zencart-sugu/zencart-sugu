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
// | This source file is subject to version 2.0 of the GPL license,       |
// +----------------------------------------------------------------------+
// | Remise.jp Payment Module V.1.0.1a                                    |
// | includes/modules/payment/remise_zen.php                              |
// | Module created by REMISE(www.remise.jp) - 05/26/2006                 |
// | Released under GPL                                                   |
// +----------------------------------------------------------------------+

class remise_zen {
	var $code, $title, $description, $enabled;

// class constructor
	function remise_zen() {
		global $order;

		$this->code = 'remise_zen';
		$this->title = MODULE_PAYMENT_REMISE_TEXT_TITLE;
		$this->description = MODULE_PAYMENT_REMISE_TEXT_DESCRIPTION;
		$this->explain = MODULE_PAYMENT_REMISE_TEXT_EXPLAIN;
		$this->sort_order = MODULE_PAYMENT_REMISE_SORT_ORDER;
		$this->enabled = ((MODULE_PAYMENT_REMISE_STATUS == 'True') ? true : false);

		if ((int)MODULE_PAYMENT_REMISE_ORDER_STATUS_ID > 0) {
			$this->order_status = MODULE_PAYMENT_REMISE_ORDER_STATUS_ID;
		}

		if (is_object($order)) $this->update_status();

		$this->form_action_url =MODULE_PAYMENT_REMISE_URL;
		$this->email_footer = MODULE_PAYMENT_REMISE_TEXT_EMAIL_FOOTER;
	}

// class methods
	function update_status() {
		global $order, $db;

		if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_REMISE_ZONE > 0) ) {
			$check_flag = false;
			$check = $db->Execute("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_REMISE_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
			while (!$check->EOF) {
				if ($check->fields['zone_id'] < 1) {
					$check_flag = true;
					break;
				} elseif ($check->fields['zone_id'] == $order->billing['zone_id']) {
					$check_flag = true;
					break;
				}
				$check->MoveNext();
			}

			if ($check_flag == false) {
				$this->enabled = false;
			}
		}
	}

	function javascript_validation() {
		return false;
	}

	function selection() {
		global $order;


		for ($i=1; $i<13; $i++) {
			$expires_month[] = array('id' => sprintf('%02d', $i), 'text' => strftime('%B',mktime(0,0,0,$i,1,2000)));
		}

		$today = getdate();
		for ($i=$today['year']; $i < $today['year']+10; $i++) {
			$expires_year[] = array('id' => strftime('%y',mktime(0,0,0,1,1,$i)), 'text' => strftime('%Y',mktime(0,0,0,1,1,$i)));
		}
		
		$payway[] = array('id' => '10', 'text' => MODULE_PAYMENT_REMISE_TEXT_CREDIT_METHOD_ONE);

		if(MODULE_PAYMENT_REMISE_REVO=="ON"){
			$payway[] = array('id' => '80', 'text' => MODULE_PAYMENT_REMISE_TEXT_CREDIT_METHOD_REVO);
		}
		
		if(MODULE_PAYMENT_REMISE_ESPAY=="ON"){
			$payway[] = array('id' => '61', 'text' => MODULE_PAYMENT_REMISE_TEXT_CREDIT_METHOD_ESPAY);
		}

		if(MODULE_PAYMENT_REMISE_ESPAY=="ON" || MODULE_PAYMENT_REMISE_REVO=="ON"){
			$cc_method = zen_draw_pull_down_menu('remise_cc_method', $payway);
		}else{
			$cc_method = zen_draw_hidden_field('remise_cc_method', '10').MODULE_PAYMENT_REMISE_TEXT_CREDIT_METHOD_ONE;
		}
		
		if (MODULE_PAYMENT_REMISE_INPUT_MODE == 'Local') {
				
			$selection = array('id' => $this->code,
			               'module' => $this->title,
			               'fields' => array(array('title' => MODULE_PAYMENT_REMISE_TEXT_CREDIT_CARD_OWNER,
			                                       'field' => $order->billing['firstname'] . ' ' . $order->billing['lastname']),
			array('title' => MODULE_PAYMENT_REMISE_TEXT_CREDIT_CARD_OWNER_ROMA,
			                                       'field' => zen_draw_input_field('remise_cc_name')),
			array('title' => MODULE_PAYMENT_REMISE_TEXT_CREDIT_CARD_NUMBER,
			                                       'field' => zen_draw_input_field('remise_cc_number')),
			array('title' => MODULE_PAYMENT_REMISE_TEXT_CREDIT_CARD_EXPIRES,
			                                       'field' => zen_draw_pull_down_menu('remise_cc_expires_month', $expires_month) . '&nbsp;' . zen_draw_pull_down_menu('remise_cc_expires_year', $expires_year)),
			array('title' => MODULE_PAYMENT_REMISE_TEXT_CREDIT_METHOD,
			                                       'field' => $cc_method))  
			);


		}else{
				
			$selection = array(	'id' => $this->code,
							'module' => $this->title,
							'fields' => array(array('title' => $this->explain,'field' => ''),
			array('title' => MODULE_PAYMENT_REMISE_TEXT_CREDIT_METHOD,
			                                       'field' => $cc_method))
			);

		}
			

		return $selection;

	}

	function pre_confirmation_check() {
		if (MODULE_PAYMENT_REMISE_INPUT_MODE == 'Local') {
				
			if(MODULE_PAYMENT_REMISE_CARD_CHECK=='ON'){

				include(DIR_WS_CLASSES . 'cc_validation.php');

				$cc_validation = new cc_validation();

				$result = $cc_validation->validate($_POST['remise_cc_number'], $_POST['remise_cc_expires_month'], $_POST['remise_cc_expires_year']);

				$error = '';

				switch ($result) {
					case -1:
						$error = sprintf(MODULE_PAYMENT_REMISE_TEXT_CC_INVALID_NUMBER, substr($cc_validation->cc_number, 0, 4));
						break;
					case -2:
					case -3:
					case -4:
						$error = MODULE_PAYMENT_REMISE_TEXT_CC_INVALID_DATE;
						break;
					case false:
						$error = MODULE_PAYMENT_REMISE_TEXT_CC_INVALID_NUMBER;
						break;
				}
					
				$this->cc_card_name=mb_convert_kana($_POST['remise_cc_name'],"a");

				if(strlen($this->cc_card_name)<3 || ereg("[^0-9a-zA-Z ]",$this->cc_card_name)){
					if ( ($result == false) || ($result < 1) ) {
						$error .= MODULE_PAYMENT_REMISE_TEXT_CC_NAME;
					}else{
						$error = MODULE_PAYMENT_REMISE_TEXT_CC_NAME;
					}
					$result=false;
				}
				
				if ( ($result == false) || ($result < 1) ) {
					$encode =mb_http_input();
					if($encode == 'ASCII' ){ $encode = 'UTF-8';}
					$error=mb_convert_encoding($error,$encode);
					$payment_error_return = 'payment_error=' . $this->code . '&error=' . urlencode($error) ;

					zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, $payment_error_return, 'SSL', true, false));
				}
				
				$this->cc_card_type = $cc_validation->cc_type;
				$this->cc_card_number = $cc_validation->cc_number;
				$this->cc_expiry_month = $cc_validation->cc_expiry_month;
				$this->cc_expiry_year = $cc_validation->cc_expiry_year;

			}else{
				$this->cc_card_name=mb_convert_kana($_POST['remise_cc_name'],"a");
				$this->cc_card_number = $_POST['remise_cc_number'];
				$this->cc_expiry_month = $_POST['remise_cc_expires_month'];
				$this->cc_expiry_year = $_POST['remise_cc_expires_year'];
			}

		}

		return false;

	}

	function confirmation() {
		global $_POST, $order;

		$method = $_POST['remise_cc_method'];
		if($method == '10'){
			$method_text = MODULE_PAYMENT_REMISE_TEXT_CREDIT_METHOD_ONE;
		}elseif ($method == '61'){
			$method_text = MODULE_PAYMENT_REMISE_TEXT_CREDIT_METHOD_ESPAY;
		}elseif ($method == '80'){
			$method_text = MODULE_PAYMENT_REMISE_TEXT_CREDIT_METHOD_REVO;
		}
		
		if (MODULE_PAYMENT_REMISE_INPUT_MODE == 'Local') {
			$confirmation = array('title' => $this->title . ': ' . $this->cc_card_type,
                              'fields' => array(array('title' => MODULE_PAYMENT_REMISE_TEXT_CREDIT_CARD_OWNER,
                                                      'field' => $order->billing['firstname'] . ' ' . $order->billing['lastname']),
			array('title' => MODULE_PAYMENT_REMISE_TEXT_CREDIT_CARD_NUMBER,
                                                      'field' => substr($this->cc_card_number, 0, 4) . str_repeat('X', (strlen($this->cc_card_number) - 8)) . substr($this->cc_card_number, -4)),
			array('title' => MODULE_PAYMENT_REMISE_TEXT_CREDIT_CARD_EXPIRES,
                                                      'field' => strftime('%B, %Y', mktime(0,0,0,$_POST['remise_cc_expires_month'], 1, '20' . $_POST['remise_cc_expires_year']))),
			array('title' => MODULE_PAYMENT_REMISE_TEXT_CREDIT_METHOD,
                                                      'field' => $method_text)   ));


		} else {
			$confirmation = array('title' => $this->title ,
                              'fields' => array(array('title' => MODULE_PAYMENT_REMISE_TEXT_CREDIT_METHOD,
                                                      'field' => $method_text)   ));
		}
		
		return $confirmation;
	}

	function process_button() {
		global $order,$remise_order_id;

		$remise_job_code = 	MODULE_PAYMENT_REMISE_JOB_CODE;

		if( strlen(MODULE_PAYMENT_REMISE_MODEL) > 0 ){
			
			for ($i = 0, $n = sizeof($order->products); $i < $n; $i++) {
				if( ereg(MODULE_PAYMENT_REMISE_MODEL,$order->products[$i]['model']) ){
					$remise_job_code = "CHECK";

					$strlen_futeikan = strlen(MODULE_PAYMENT_REMISE_MAIL_FUTEIKANN);
					$strlen_comments = strlen($order->info['comments']);
					if(substr($order->info['comments'],$strlen_comments-$strlen_futeikan) != MODULE_PAYMENT_REMISE_MAIL_FUTEIKANN){
						if(strlen($order->info['comments'])>0){
							$order->info['comments'] .= "\n\n" . MODULE_PAYMENT_REMISE_MAIL_FUTEIKANN;
						}else{
							$order->info['comments'] = MODULE_PAYMENT_REMISE_MAIL_FUTEIKANN;
						}
					}
					
					break;
				}
			}
				
		}

		
		$remise_order_id = (int)$_SESSION['customer_id'] . date('ymdHis');

		if( TAX_ROUND_OPTION == "raise" ){
			$total = ceil($order->info['total']);
		}else if(TAX_ROUND_OPTION == "drop"){
			$total = floor($order->info['total']);
		}else if(TAX_ROUND_OPTION == "round"){
			$total = round($order->info['total']);
		}else{
			$total = $order->info['total'];
		}
		
		if (MODULE_PAYMENT_REMISE_INPUT_MODE == 'Local') {
			
			$process_button_string = zen_draw_hidden_field('SHOPCO', MODULE_PAYMENT_REMISE_SHOP_CODE) .
			zen_draw_hidden_field('HOSTID', MODULE_PAYMENT_REMISE_HOST_ID) .
			zen_draw_hidden_field('JOB', $remise_job_code) .
			zen_draw_hidden_field('ITEM', '0000120') .
			zen_draw_hidden_field('METHOD', $_POST['remise_cc_method']) .
			zen_draw_hidden_field('S_TORIHIKI_NO', $remise_order_id ) .
			zen_draw_hidden_field('RETURL', zen_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL', true)) .
			zen_draw_hidden_field('AMOUNT', $total) .
			zen_draw_hidden_field('TAX', '0') .
			zen_draw_hidden_field('TOTAL', $total) .
			zen_draw_hidden_field('NG_RETURL', zen_href_link(FILENAME_CHECKOUT_PAYMENT, 'payment_error=' . $this->code, 'NONSSL', true)) .
			zen_draw_hidden_field('CARD', $this->cc_card_number) .
			zen_draw_hidden_field('EXPIRE', $this->cc_expiry_month . substr($this->cc_expiry_year,-2)) .
			zen_draw_hidden_field('PTIMES', '2') .
			zen_draw_hidden_field('NAME', $this->cc_card_name) .
			zen_draw_hidden_field('MAIL', mb_convert_kana($order->customer['email_address'],"a")) .
			zen_draw_hidden_field('OPT', $remise_job_code . "<>" . $this->cc_card_type . "<>" . $this->cc_card_name . "<>" . $this->cc_card_number . "<>" . $this->cc_expiry_month . substr($this->cc_expiry_year,-2) . "<>" . $_POST['remise_cc_method']) .
			zen_draw_hidden_field('DIRECT', 'ON');
		}else{
			$process_button_string = zen_draw_hidden_field('SHOPCO', MODULE_PAYMENT_REMISE_SHOP_CODE) .
			zen_draw_hidden_field('HOSTID', MODULE_PAYMENT_REMISE_HOST_ID) .
			zen_draw_hidden_field('JOB', $remise_job_code) .
			zen_draw_hidden_field('ITEM', '0000120') .
			zen_draw_hidden_field('METHOD', $_POST['remise_cc_method']) .
			zen_draw_hidden_field('S_TORIHIKI_NO', $remise_order_id ) .
			zen_draw_hidden_field('RETURL', zen_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL', true)) .
			zen_draw_hidden_field('NG_RETURL', zen_href_link(FILENAME_CHECKOUT_PAYMENT, 'payment_error=' . $this->code, 'NONSSL', true)) .
			zen_draw_hidden_field('EXITURL', zen_href_link(FILENAME_CHECKOUT_PAYMENT, 'payment_error=' . $this->code, 'NONSSL', true)) .
			zen_draw_hidden_field('AMOUNT', $total) .
			zen_draw_hidden_field('TAX', '0') .
			zen_draw_hidden_field('MAIL', mb_convert_kana($order->customer['email_address'],"a")) .
			zen_draw_hidden_field('OPT', $remise_job_code . "<>" . $this->cc_card_type . "<>" . $this->cc_card_name . "<>" . $this->cc_card_number . "<>" . $this->cc_expiry_month . substr($this->cc_expiry_year,-2) . "<>" . $_POST['remise_cc_method']) .
			zen_draw_hidden_field('TOTAL', $total) .
			zen_draw_hidden_field('PTIMES', '2') ;
		}
		
		return $process_button_string;
	}
	

	function before_process() {

		global $order, $db;
		global $sales_id,$tranid,$refapproved,$refforwarded,$errcode,$errinfo,$errlevel,$r_code,$rec_type,$x_amount,$x_tax,$x_total, $remise_cc_job_code;

		$sales_id=$_POST['X-S_TORIHIKI_NO'];
		$tranid=$_POST['X-TRANID'];
		$refapproved=$_POST['X-REFAPPROVED'];
		$refforwarded=$_POST['X-REFFORWARDED'];
		$errcode=$_POST['X-ERRCODE'];
		$errinfo=$_POST['X-ERRINFO'];
		$errlevel=$_POST['X-ERRLEVEL'];
		$r_code=$_POST['X-R_CODE'];
		$rec_type=$_POST['REC_TYPE'];
		$x_amount=$_POST['X-AMOUNT'];
		$x_tax=$_POST['X-TAX'];
		$x_total=$_POST['X-TOTAL'];
		//$today = date('Y-m-d H:i:s');
		
		if( MODULE_PAYMENT_REMISE_RET == "ON" ){
				
			$sql = "select * from " . TABLE_REMISE_RESULT . " where tranid='" . $tranid . "' and rec_type='RET' limit 1";
			$remise_query = $db->Execute($sql);

			if ($remise_query->RecordCount() > 0) {
				$remise_values = $remise_query->fields;

				if(
				$sales_id !=  $remise_values['sales_id'] 		||
				$tranid != $remise_values['tranid'] 			||
				$refapproved != $remise_values['refapproved'] 	||
				$refforwarded != $remise_values['refforwarded'] ||
				$errinfo != $remise_values['errinfo'] 			||
				$errlevel != $remise_values['errlevel'] 		||
				$r_code != $remise_values['r_code'] 			||
				$rec_type != "END"						 		||
				$x_amount != $remise_values['x_amount'] 		||
				$x_tax != $remise_values['x_tax']				||
				$x_total != $remise_values['x_total']			||
				$errlevel > 0									||
				strlen($errlevel) == 0
				){
					if( MODULE_PAYMENT_REMISE_RET == "ON" )
					$db->Execute("INSERT INTO " . TABLE_REMISE_RESULT . " VALUES('','$sales_id','$tranid','$refapproved','$refforwarded','$errcode','$errinfo','$errlevel','$r_code','$rec_type','$x_amount','$x_tax','$x_total','failed:0','','',now())");
					zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, zen_session_name() . '=' . $_POST[zen_session_name()] . '&payment_error=' . $this->code, 'SSL', false, false));
				}
					
			}else{
				if( MODULE_PAYMENT_REMISE_RET == "ON" )
				$db->Execute("INSERT INTO " . TABLE_REMISE_RESULT . " VALUES('','$sales_id','$tranid','$refapproved','$refforwarded','$errcode','$errinfo','$errlevel','$r_code','$rec_type','$x_amount','$x_tax','$x_total','failed:1','" . $_SERVER['REMOTE_ADDR'] . "','" . $_SERVER['REQUEST_METHOD'] . "',now())");
				zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, zen_session_name() . '=' . $_POST[zen_session_name()] . '&payment_error=' . $this->code, 'SSL', false, false));

			}
				
		}else if ($errlevel > 0 || strlen($errlevel) == 0 ){
			zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, zen_session_name() . '=' . $_POST[zen_session_name()] . '&payment_error=' . $this->code, 'SSL', false, false));
		}
			
			
		$card_info = $_POST['OPT'];

		$remise_cc_job_code = strtok($card_info,"<>");

		if(MODULE_PAYMENT_REMISE_CARD == "ON"){
			
			$order->info['cc_type'] = strtok("<>");
			$order->info['cc_owner'] = strtok("<>");
			$order->info['cc_number'] = strtok("<>");
			$order->info['cc_expires'] = strtok("<>");

		}
			
		if($remise_cc_job_code != MODULE_PAYMENT_REMISE_JOB_CODE){
			$order_status = MODULE_PAYMENT_REMISE_ORDER_STATUS_ID_FUTEIKAN;
			$order->info['order_status'] = $order_status;
		}

	}
	
	function after_process() {
		global $insert_id, $order, $db;
		global $sales_id,$tranid,$refapproved,$refforwarded,$errcode,$errinfo,$errlevel,$r_code,$rec_type,$x_amount,$x_tax,$x_total,$remise_cc_job_code;

		if( strlen($order->info['comments']) > 0 ){ $newline = "\n\n"; }
		else{ $newline = ""; }
			
		if(strlen(MODULE_PAYMENT_REMISE_EXTURL)==0){
			$order->info['comments'] .= $newline . "REMISE請求番号：" . $sales_id; 
		}elseif ( $remise_cc_job_code == "CAPTURE" && MODULE_PAYMENT_REMISE_CARD == "ON"){
			$order->info['comments'] .= $newline . "売上処理済み-<a href=\"orders_remise.php?selected_box=customers&status=1&page=1&oID=" . $insert_id . "&action=edit&salesID=".$sales_id ."\"><b><font color=\"#009900\">返品・取消処理：" . $sales_id ."</font></b></a>";  
		}elseif ( $remise_cc_job_code == "CHECK" && MODULE_PAYMENT_REMISE_CARD == "ON"){
			$order->info['comments'] .= $newline . "カードの有効性チェック済み-<a href=\"orders_remise.php?selected_box=customers&status=1&page=1&oID=" . $insert_id . "&action=edit&salesID=".$sales_id ."\"><b><font color=\"#009900\">売上処理：" . $sales_id ."</font></b></a>";        	
		}elseif ( $remise_cc_job_code == "AUTH" && MODULE_PAYMENT_REMISE_CARD == "ON"){
			$order->info['comments'] .= $newline . "仮売上処理済み-<a href=\"orders_remise.php?selected_box=customers&status=1&page=1&oID=" . $insert_id . "&action=edit&salesID=".$sales_id ."\"><b><font color=\"#009900\">実売上・返品・取消処理：" . $sales_id ."</font></b></a>";        
		}elseif ( $remise_cc_job_code == "SAUTH" && MODULE_PAYMENT_REMISE_CARD == "ON"){
			$order->info['comments'] .= "与信枠確保済み-<a href=\"orders_remise.php?selected_box=customers&status=1&page=1&oID=" . $insert_id . "&action=edit&salesID=".$sales_id ."\"><b><font color=\"#009900\">返品・取消処理：" . $sales_id ."</font></b></a>";        	
		}else{
			$order->info['comments'] .= $newline . "REMISE請求番号：" . $sales_id;     	
		}
		
		$db->Execute("update " . TABLE_ORDERS_STATUS_HISTORY . " set comments='" . $order->info['comments'] . "' where orders_id='$insert_id'");

		if( MODULE_PAYMENT_REMISE_RET == "ON" )
		$db->Execute("INSERT INTO " . TABLE_REMISE_RESULT . " VALUES('','$sales_id','$tranid','$refapproved','$refforwarded','$errcode','$errinfo','$errlevel','$r_code','$rec_type','$x_amount','$x_tax','$x_total','success','$remise_cc_job_code','',now())");
	 
	}
	
	function output_error() {
		return false;
	}

	function get_error() {
		if (isset($_GET['error']) && (strlen($_GET['error']) > 0)) {
			$error_message = stripslashes(urldecode($_GET['error']));
		}else{
			
			$error_code = $_POST['X-ERRCODE'];
			$error_info = $_POST['X-ERRINFO'];
	    	//$error_r_code = $_POST['X-R_CODE'];
				
			if($error_code == "H12" && $error_info == "310030000"){
				$error_message = MODULE_PAYMENT_REMISE_TEXT_ERROR_H12_31003;
			}elseif($error_code == "H12" && $error_info == "310050000"){
				$error_message = MODULE_PAYMENT_REMISE_TEXT_ERROR_H12_31005;
			}elseif($error_code == "H12" && $error_info == "320060000"){
				$error_message = MODULE_PAYMENT_REMISE_TEXT_ERROR_H12_32006;
			}elseif($error_code == "H97" && $error_info == "220010000"){
				$error_message = MODULE_PAYMENT_REMISE_TEXT_ERROR_H97_22001;
			}elseif($error_code == "H97" && $error_info == "421010000"){
				$error_message = MODULE_PAYMENT_REMISE_TEXT_ERROR_H97_42101;
			}elseif($error_code == "H97" && $error_info == "450030000"){
				$error_message = MODULE_PAYMENT_REMISE_TEXT_ERROR_H97_45003;
			}elseif($error_code == "H97" && $error_info == "450040000"){
				$error_message = MODULE_PAYMENT_REMISE_TEXT_ERROR_H97_45004;
			}elseif($error_code == "H97" && $error_info == "450050000"){
				$error_message = MODULE_PAYMENT_REMISE_TEXT_ERROR_H97_45005;
			}elseif($error_code == "S99" && $error_info == "42S991000"){
				$error_message = MODULE_PAYMENT_REMISE_TEXT_ERROR_H97_45005;
			}elseif($error_code == "S99" && $error_info == "42S994000"){
				$error_message = MODULE_PAYMENT_REMISE_TEXT_ERROR_H97_45005;
			}elseif($error_code == 'C14'){
				$error_message = MODULE_PAYMENT_REMISE_TEXT_ERROR_C14;
			}elseif($error_code == 'G03'){
				$error_message = MODULE_PAYMENT_REMISE_TEXT_ERROR_G03;
			}elseif($error_code == 'G12'){
				$error_message = MODULE_PAYMENT_REMISE_TEXT_ERROR_G12;
			}elseif($error_code == 'G30'){
				$error_message = MODULE_PAYMENT_REMISE_TEXT_ERROR_G30;
			}elseif($error_code == 'G54'){
				$error_message = MODULE_PAYMENT_REMISE_TEXT_ERROR_G54;
			}elseif($error_code == 'G55'){
				$error_message = MODULE_PAYMENT_REMISE_TEXT_ERROR_G55;
			}elseif($error_code == 'G56'){
				$error_message = MODULE_PAYMENT_REMISE_TEXT_ERROR_G56;
			}elseif($error_code == 'G60'){
				$error_message = MODULE_PAYMENT_REMISE_TEXT_ERROR_G60;
			}elseif($error_code == 'G65'){
				$error_message = MODULE_PAYMENT_REMISE_TEXT_ERROR_G65;
			}elseif($error_code == 'G78'){
				$error_message = MODULE_PAYMENT_REMISE_TEXT_ERROR_G78;
			}elseif($error_code == 'G83'){
				$error_message = MODULE_PAYMENT_REMISE_TEXT_ERROR_G83;
			}elseif($error_code == 'G97'){
				$error_message = MODULE_PAYMENT_REMISE_TEXT_ERROR_G97;
			}elseif($error_code == 'G99'){
				$error_message = MODULE_PAYMENT_REMISE_TEXT_ERROR_G99;
			}elseif($error_code == 'P90'){
				$error_message = MODULE_PAYMENT_REMISE_TEXT_ERROR_P90;
			}elseif($error_code == 'S01'){
				$error_message = MODULE_PAYMENT_REMISE_TEXT_ERROR_S01;
			}elseif($error_code == 'X51'){
				$error_message = MODULE_PAYMENT_REMISE_TEXT_ERROR_X51;
			}elseif($error_code == 'X53'){
				$error_message = MODULE_PAYMENT_REMISE_TEXT_ERROR_X53;
			}elseif($error_code == 'X65'){
				$error_message = MODULE_PAYMENT_REMISE_TEXT_ERROR_X65;
			}else{
				$error_message = MODULE_PAYMENT_REMISE_TEXT_ERROR_MESSAGE;
			}
			
			if( strlen($error_code) > 0 )
			$error_message = $error_code . ':' . $error_message;
		}
		

		return array('title' => MODULE_PAYMENT_REMISE_TEXT_ERROR,
                   'error' => $error_message);
	}

	function check() {
		global $db;
		if (!isset($this->_check)) {
			$check_query = $db->Execute("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_REMISE_STATUS'");
			$this->_check = $check_query->RecordCount();
		}
		return $this->_check;
	}

	function install() {
		global $db;

		$db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable REMISE Module', 'MODULE_PAYMENT_REMISE_STATUS', 'True', 'ルミーズカード決済を有効にしますか?', '6', '0', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
		$db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Remise Url', 'MODULE_PAYMENT_REMISE_URL', 'https://www.remise.jp/', '決済情報送信先URL', '6', '0', now())");
		$db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Shop Code', 'MODULE_PAYMENT_REMISE_SHOP_CODE', '00000000', '加盟店コード', '6', '0', now())");
		$db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Host Id', 'MODULE_PAYMENT_REMISE_HOST_ID', '00000000', 'ホスト番号', '6', '0', now())");
		$db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Job Code', 'MODULE_PAYMENT_REMISE_JOB_CODE', 'AUTH', 'ジョブコード', '6', '0', 'zen_cfg_select_option(array(\'CHECK\', \'CAPTURE\', \'AUTH\', \'SAUTH\'), ', now())");
		$db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('クレジットカード情報入力', 'MODULE_PAYMENT_REMISE_INPUT_MODE', 'Local', 'クレジットカード情報の入力をローカルで行うかリモート（ＲＥＭＩＳＥ）で行うか選択してください', '6', '5', 'zen_cfg_select_option(array(\'Local\', \'Remote\'), ', now())");
		$db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('結果通知', 'MODULE_PAYMENT_REMISE_RET', 'OFF', '結果通知を行うか選択してください', '6', '5', 'zen_cfg_select_option(array(\'ON\', \'OFF\'), ', now())");
		$db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('リボ払い', 'MODULE_PAYMENT_REMISE_REVO', 'OFF', 'リボルビング払いを使用する場合は、ONを選択してください。', '6', '5', 'zen_cfg_select_option(array(\'ON\', \'OFF\'), ', now())");
		$db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('分割払い', 'MODULE_PAYMENT_REMISE_ESPAY', 'OFF', '分割払いを使用する場合は、ONを選択してください。分割払いは2回払いまでになります', '6', '5', 'zen_cfg_select_option(array(\'ON\', \'OFF\'), ', now())");
		$db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('入力チェック', 'MODULE_PAYMENT_REMISE_CARD_CHECK', 'ON', 'osCommerce内でクレジットカードの入力チェックをする', '6', '5', 'zen_cfg_select_option(array(\'ON\', \'OFF\'), ', now())");
		$db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('表示の順番', 'MODULE_PAYMENT_REMISE_SORT_ORDER', '0', '表示の順番を設定します。数値順に表示されます', '6', '0', now())");
		$db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('適用地域', 'MODULE_PAYMENT_REMISE_ZONE', '0', '適用地域を選択すると、選択した地域のみで利用可能となります。', '6', '2', 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(', now())");
		$db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('オーダーステータス', 'MODULE_PAYMENT_REMISE_ORDER_STATUS_ID', '0', 'クレジットカード決済成功時のオーダーステータスを設定してください', '6', '0', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");   		

		$db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Remise ExtUrl', 'MODULE_PAYMENT_REMISE_EXTURL', 'https://www.remise.jp/', '拡張セット送信先URL', '6', '0', now())");
		$db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('クレジットカード情報保存', 'MODULE_PAYMENT_REMISE_CARD', 'OFF', 'クレジットカード情報を保存するか選択してください', '6', '5', 'zen_cfg_select_option(array(\'ON\', \'OFF\'), ', now())");
		$db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('変動価格商品の型番', 'MODULE_PAYMENT_REMISE_MODEL', '', '商品の型番に指定の文字列が存在した場合カードの有効性チェックのみ行います。管理画面で後から任意の価格で売上処理を行います。', '6', '0', now())");
		$db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('拡張セット売上オーダーステータス', 'MODULE_PAYMENT_REMISE_ORDER_STATUS_ID_CAPTURE', '0', 'クレジットカード決済売上時のオーダーステータスを設定してください', '6', '0', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
		$db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('拡張セット返品オーダーステータス', 'MODULE_PAYMENT_REMISE_ORDER_STATUS_ID_RETURN', '0', 'クレジットカード決済返品時のオーダーステータスを設定してください', '6', '0', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
		$db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('拡張セット取消オーダーステータス', 'MODULE_PAYMENT_REMISE_ORDER_STATUS_ID_VOID', '0', 'クレジットカード決済取消時のオーダーステータスを設定してください', '6', '0', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
		$db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('変動価格商品オーダーステータス', 'MODULE_PAYMENT_REMISE_ORDER_STATUS_ID_FUTEIKAN', '0', '変動価格商品購入時のオーダーステータスを設定してください', '6', '0', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");

	}

	function remove() {
		global $db;
		$db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
	}

	function keys() {
		if( file_exists(DIR_FS_ADMIN."orders_remise.php")){
			return array('MODULE_PAYMENT_REMISE_STATUS', 'MODULE_PAYMENT_REMISE_URL', 'MODULE_PAYMENT_REMISE_EXTURL','MODULE_PAYMENT_REMISE_SHOP_CODE','MODULE_PAYMENT_REMISE_HOST_ID', 'MODULE_PAYMENT_REMISE_JOB_CODE', 'MODULE_PAYMENT_REMISE_INPUT_MODE', 'MODULE_PAYMENT_REMISE_RET', 'MODULE_PAYMENT_REMISE_CARD','MODULE_PAYMENT_REMISE_REVO','MODULE_PAYMENT_REMISE_ESPAY','MODULE_PAYMENT_REMISE_CARD_CHECK', 'MODULE_PAYMENT_REMISE_ORDER_STATUS_ID','MODULE_PAYMENT_REMISE_ORDER_STATUS_ID_CAPTURE','MODULE_PAYMENT_REMISE_ORDER_STATUS_ID_RETURN','MODULE_PAYMENT_REMISE_ORDER_STATUS_ID_VOID', 'MODULE_PAYMENT_REMISE_ORDER_STATUS_ID_FUTEIKAN','MODULE_PAYMENT_REMISE_MODEL','MODULE_PAYMENT_REMISE_SORT_ORDER','MODULE_PAYMENT_REMISE_ZONE');
		}else{
			return array('MODULE_PAYMENT_REMISE_STATUS', 'MODULE_PAYMENT_REMISE_URL', 'MODULE_PAYMENT_REMISE_SHOP_CODE','MODULE_PAYMENT_REMISE_HOST_ID', 'MODULE_PAYMENT_REMISE_JOB_CODE', 'MODULE_PAYMENT_REMISE_INPUT_MODE','MODULE_PAYMENT_REMISE_RET', 'MODULE_PAYMENT_REMISE_REVO','MODULE_PAYMENT_REMISE_ESPAY','MODULE_PAYMENT_REMISE_CARD_CHECK', 'MODULE_PAYMENT_REMISE_ORDER_STATUS_ID', 'MODULE_PAYMENT_REMISE_SORT_ORDER','MODULE_PAYMENT_REMISE_ZONE');
		}
	}
}

?>