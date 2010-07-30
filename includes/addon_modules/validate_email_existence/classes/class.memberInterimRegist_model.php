<?php
class memberInterimRegist_model extends base {

	var $gender;
	var $firstname;
	var $lastname;
	var $dob;
	var $email_address;
	var $nick;
	var $telephone;
	var $fax;
	var $newsletter;
	var $email_format;
	var $customers_authorization;
	var $customers_referral;
	var $firstname_kana;
	var $lastname_kana;
	var $company;
	var $street_address;
	var $suburb;
	var $postcode;
	var $city;
	var $state;
	var $zone_id;
	var $country;
	var $confirmation;

	function memberInterimRegist_model() {

		global $db;

		//初期化->既に追加された顧客情報を一旦削除
		$sql = "delete from "
					. TABLE_CUSTOMERS ." "
				. "where "
					. "customers_id = " . $_SESSION['customer_id'];

		$db->Execute($sql);

		$sql = "delete from "
					. TABLE_ADDRESS_BOOK ." "
				. "where "
					. "customers_id = " . $_SESSION['customer_id'];

		$db->Execute($sql);

		$sql = "delete from "
					. TABLE_CUSTOMERS_INFO ." "
				. "where "
					. "customers_info_id = " . $_SESSION['customer_id'];

		$db->Execute($sql);

		//ログインのためのセッション情報破棄
		unset($_SESSION['customer_first_name']);
		unset($_SESSION['customer_last_name']);
		if (FURIKANA_NESESSARY) {
			unset($_SESSION['customer_first_name_kana']);
			unset($_SESSION['customer_last_name_kana']);
		}
		unset($_SESSION['customer_default_address_id']);
		unset($_SESSION['customer_country_id']);
		unset($_SESSION['customer_zone_id']);
		unset($_SESSION['customers_authorization']);
		unset($_SESSION['customer_id']);

		//1時間以上経過しているレコードの削除
		$sql = "delete from "
					. TABLE_ADDON_MODULES_CUSTOMERS_TEMPORARY . " "
				. "where "
					. "reg_date<date_add(now(), interval -1 hour)";

		$db->Execute($sql);

	}

	//顧客情報の仮登録
	function insertInterimData() {

	//post data into the customer＆address_book ===>
		if(ACCOUNT_GENDER == 'true') {
			if(isset($_POST['gender'])) {
				$this->gender = zen_db_prepare_input($_POST['gender']);
			} else {
				$this->gender = false;
			}
		}

		$this->firstname = zen_db_prepare_input($_POST['firstname']);
		$this->lastname = zen_db_prepare_input($_POST['lastname']);

		if(ACCOUNT_DOB == 'true') {
			if(empty($_POST['dob'])) {
				$this->dob = zen_db_prepare_input('0001-01-01 00:00:00');
			} else {
				$this->dob = zen_db_prepare_input($_POST['dob']);
			}
		}

		$this->email_address = zen_db_prepare_input($_POST['email_address']);
		$this->nick = zen_db_prepare_input($_POST['nick']);
		//default_default_address_id(address_book_id)
		$this->telephone = zen_db_prepare_input($_POST['telephone']);
		$this->fax = zen_db_prepare_input($_POST['fax']);
		$this->password = zen_db_prepare_input($_POST['password']);

		if(isset($_POST['newsletter'])) {
			$this->newsletter = zen_db_prepare_input($_POST['newsletter']);
		} else {
			$this->newsletter = false;
		}

		//customers_group_pricing

		if(isset($_POST['email_format'])) {
			$this->email_format = zen_db_prepare_input($_POST['email_format']);
		} else {
			$this->email_format = false;
		}

		$this->customers_authorization = CUSTOMERS_APPROVAL_AUTHORIZATION;
		$this->customers_referral = zen_db_prepare_input($_POST['customers_referral']);

		if(FURIKANA_NESESSARY) {
			$this->firstname_kana = zen_db_prepare_input($_POST['firstname_kana']);
			$this->lastname_kana = zen_db_prepare_input($_POST['lastname_kana']);
		}

		//customers_mobile_serial_number
		//customers_languages_id
		//payment_method

		if(ACCOUNT_COMPANY == 'true') {
			$this->company = zen_db_prepare_input($_POST['company']);
		}

		$this->street_address = zen_db_prepare_input($_POST['street_address']);

		if(ACCOUNT_SUBURB == 'true') {
			$this->suburb = zen_db_prepare_input($_POST['suburb']);
		}

		$this->postcode = zen_db_prepare_input($_POST['postcode']);
		$this->city = zen_db_prepare_input($_POST['city']);

		if(ACCOUNT_STATE == 'true') {
			$this->state = zen_db_prepare_input($_POST['state']);
			if(isset($_POST['zone_id'])) {
				$this->zone_id = zen_db_prepare_input($_POST['zone_id']);
			} else {
				$this->zone_id = false;
			}
		}

		$this->country = zen_db_prepare_input($_POST['country']);
	//post data into the customer＆address_book <===

		$this->confirmation = zen_db_prepare_input($_POST['confirmation']);

	//step1->insert customers_temporary
		$sql_data_array = array(
								'gender' => $this->gender,
								'firstname' => $this->firstname,
								'lastname' => $this->lastname,
								'dob' => $this->dob,
								'email_address' => $this->email_address,
								'nick' => 'ハチ',
								'password' => zen_encrypt_password($this->password),
								'newsletter' => (int)$this->newsletter,
								'payment_method' => 'クレジット',
								'postcode' => $this->postcode,
								'state' => $this->state,
								'city' => $this->city,
								'street_address' => $this->street_address,
								'suburb' => $this->suburb,
								'telephone' => $this->telephone,
								'fax' => $this->fax,
								'temporary_id' => zen_session_id(),
								'reg_date' => 'now()'
		);

		zen_db_perform(TABLE_ADDON_MODULES_CUSTOMERS_TEMPORARY, $sql_data_array);

	}

	//仮登録完了メール送信
	function sendEmailForInterimRegist() {

		$name = $this->firstname . ' ' . $this->lastname;
		$url  = zen_href_link(FILENAME_ADDON, 'module=validate_email_existence/member_regist_complete&action=process&mode=regist&acc_id=', 'SSL');
		$url .= zen_session_id();
		$email_text .= sprintf(EMAIL_MEMBER_INTERIM_REGIST_GREET_NONE, $name);
		$email_text .= sprintf(EMAIL_MEMBER_INTERIM_REGIST_BODY);
		$email_text .= $url;
		zen_mail($name, $this->email_address, EMAIL_MEMBER_INTERIM_REGIST_SUBJECT, $email_text, STORE_NAME, EMAIL_FROM, '', '');
		zen_redirect(zen_href_link(FILENAME_ADDON, 'module=validate_email_existence/member_interim_regist_complete', 'SSL'));

	}

}
?>