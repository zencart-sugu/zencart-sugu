<?php
require_once(DIR_WS_CLASSES . 'ZenCart/CustomMail.php');

class ObserversCustomMail {
	var $_aEvents;

	function ObserversCustomMail(){
		$this->_aEvents = array(
			'NOTIFY_CHECKOUT_PROCESS_AFTER_ORDER_CREATE_ADD_PRODUCTS',
			'NOTIFY_CHECKOUT_PROCESS_AFTER_SEND_ORDER_EMAIL'
		);
	}

	function getAllEventID(){
		return $this->_aEvents;
	}

	function update( $oNotify, $sEventId, $aParams ){
		global $order_back, $order;

		switch( $sEventId ){
		case 'NOTIFY_CHECKOUT_PROCESS_AFTER_ORDER_CREATE_ADD_PRODUCTS':
			$order_back = $order;
			$order = new CustomMail();
			break;
		case 'NOTIFY_CHECKOUT_PROCESS_AFTER_SEND_ORDER_EMAIL':
			$order = $order_back;
			break;
		}
	}
}
?>
