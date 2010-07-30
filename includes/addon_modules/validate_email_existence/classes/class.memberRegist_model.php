<?php
class memberRegist_model extends base {

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
	var $temporary_id;

	function memberRegist_model() {

		global $db;

		$sql = "select "
					. "* "
				. "from "
					. TABLE_ADDON_MODULES_CUSTOMERS_TEMPORARY . " "
				. "where "
					. "temporary_id = '" . $_GET['acc_id'] . "'";

		$result = $db->Execute($sql);

		$this->gender         = zen_db_input($result->fields['gender']);
		$this->firstname      = zen_db_input($result->fields['firstname']);
		$this->lastname       = zen_db_input($result->fields['lastname']);
		$this->dob            = zen_db_input($result->fields['dob']);
		$this->email_address  = zen_db_input($result->fields['email_address']);
		$this->nick           = zen_db_input($result->fields['nick']);
		$this->password       = zen_db_input($result->fields['password']);
		$this->newsletter     = zen_db_input($result->fields['newsletter']);
		$this->payment_method = zen_db_input($result->fields['payment_method']);
		$this->postcode       = zen_db_input($result->fields['postcode']);
		$this->state          = zen_db_input($result->fields['state']);
		$this->city           = zen_db_input($result->fields['city']);
		$this->street_address = zen_db_input($result->fields['street_address']);
		$this->suburb         = zen_db_input($result->fields['suburb']);
		$this->telephone      = zen_db_input($result->fields['telephone']);
		$this->fax            = zen_db_input($result->fields['fax']);
		$this->temporary_id   = zen_db_input($result->fields['temporary_id']);

	//insert customers
		$sql_data_customer['customers_gender']         = $this->gender;
		$sql_data_customer['customers_firstname']      = $this->firstname;
		$sql_data_customer['customers_lastname']       = $this->lastname;
		$sql_data_customer['customers_dob']            = $this->dob;
		$sql_data_customer['customers_email_address']  = $this->email_address;
		$sql_data_customer['customers_nick']           = $this->nick;
		$sql_data_customer['customers_password']       = $this->password;
		$sql_data_customer['customers_newsletter']     = $this->newsletter;
		//$sql_data_customer['customers_payment_method'] = $this->payment_method;

		zen_db_perform(TABLE_CUSTOMERS, $sql_data_customer);

		$_SESSION['customer_id'] = $db->Insert_ID();

	//insert address_book
		$sql_data_address_book['customers_id']         = $_SESSION['customer_id'];
		$sql_data_address_book['entry_postcode']       = $this->postcode;
		$sql_data_address_book['entry_state']          = $this->state;
		$sql_data_address_book['entry_city']           = $this->city;
		$sql_data_address_book['entry_street_address'] = $this->street_address;
		$sql_data_address_book['entry_suburb']         = $this->suburb;
		$sql_data_address_book['entry_telephone']      = $this->telephone;
		$sql_data_address_book['entry_fax']            = $this->fax;

		zen_db_perform(TABLE_ADDRESS_BOOK, $sql_data_address_book);

		$_SESSION['customer_default_address_id'] = $db->Insert_ID();

	//insert customers_info
    	$sql_data_customers_info['customers_info_id']                   = $_SESSION['customer_id'];
        $sql_data_customers_info['customers_info_number_of_logons']     = 0;
        $sql_data_customers_info['customers_info_date_account_created'] = 'now()';

		zen_db_perform(TABLE_CUSTOMERS_INFO, $sql_data_customers_info);

		$_SESSION['customer_first_name'] = zen_db_prepare_input($this->firstname);
		$_SESSION['customer_last_name'] = zen_db_prepare_input($this->lastname);
/*		if(FURIKANA_NESESSARY) {
			$_SESSION['customer_first_name_kana'] = zen_db_prepare_input($this->firstname_kana);
			$_SESSION['customer_last_name_kana'] = zen_db_prepare_input($this->lastname_kana);
		}*/
		//$_SESSION['customer_country_id'] = zen_db_prepare_input($result->fields['country']);
		//$_SESSION['customer_zone_id'] = zen_db_prepare_input($result->fields['zone_id']);
		//$_SESSION['customers_authorization'] = CUSTOMERS_APPROVAL_AUTHORIZATION;

	}

	function sendEmailForRegist() {

		global $db;

		$name = $this->firstname . ' ' . $this->lastname;
		$url  = zen_href_link(FILENAME_ACCOUNT, 'account', 'SSL');
		$email_text .= sprintf(EMAIL_MEMBER_REGIST_GREET_NONE, $name);
		$email_text .= sprintf(EMAIL_MEMBER_REGIST_BODY, $this->email_address);
		$email_text .= $url;
		zen_mail($name, $this->email_address, EMAIL_MEMBER_REGIST_SUBJECT, $email_text, STORE_NAME, EMAIL_FROM, '', '');

		$sql = "delete from "
					. TABLE_ADDON_MODULES_CUSTOMERS_TEMPORARY . " "
				. "where "
					. "temporary_id = '" . $this->temporary_id . "'";

		$db->Execute($sql);

		zen_redirect(zen_href_link(FILENAME_ADDON, 'module=validate_email_existence/member_regist_complete', 'SSL'));

	}

}
?>