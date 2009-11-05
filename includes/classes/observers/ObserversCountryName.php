<?php
class ObserversCountryName extends base{
	
	
	var $_aEvents;
	function ObserversCountryName(){
		$this->_aEvents = array(
				'NOTIFY_HEADER_START_CREATE_ACCOUNT',
				'NOTIFY_HEADER_START_CHECKOUT_SHIPPING_ADDRESS',
				'NOTIFY_HEADER_START_CHECKOUT_PAYMENT_ADDRESS');
                    
	}
	
	function getAllEventID(){
		return $this->_aEvents;
	}
	function update($oNotify,$sEventid,$aParams){
		if (($sEventid == 'NOTIFY_HEADER_START_CREATE_ACCOUNT')||$sEventid=='NOTIFY_HEADER_START_CHECKOUT_SHIPPING_ADDRESS'||$sEventid=='NOTIFY_HEADER_START_CHECKOUT_PAYMENT_ADDRESS'){
            global $mobile;
            $_POST = $mobile-> countryNameConvert($_POST); 
        }
	}
}
?>
