<?php
class ObserversBirthday extends base{
	
	
	var $_aEvents;
	function ObserversBirthday(){
		$this->_aEvents = array(
				'NOTIFY_HEADER_START_CREATE_ACCOUNT');
	}
	
	function getAllEventID(){
		return $this->_aEvents;
	}
	function update($oNotify,$sEventid,$aParams){
		if (($sEventid == 'NOTIFY_HEADER_START_CREATE_ACCOUNT')){
			if(preg_match('@\d{8}@',$_POST['dob'])){
				$y = substr($_POST['dob'],0,4);
				$m = substr($_POST['dob'],4,2);
				$d = substr($_POST['dob'],6,2);
				if(($y >1899) && ($m >0 && $m <13) && ($d >0 && $d <32)){
					$_POST['dob'] = $y."/".$m."/".$d;
				}
			}
		}
	}
}
?>
