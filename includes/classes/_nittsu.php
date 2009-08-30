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
/*
  $Id$

  Nittsu Shipping Calculator.
  Calculate shipping costs.

  2002/03/29 written by TAMURA Toshihiko (tamura@bitscope.co.jp)
  2003/04/10 modified for ms1
  2004/02/27 modified for ZenCart by HISASUE Takahiro ( hisa@flatz.jp )
  2005/02/04 modified for ZenCart ver1.2 by Yatts (info@yatts.jp)
 */
/*
	$rate = new _Nittsu('nittsu','ƒÃæÔ ÿ');
	$rate->SetOrigin('ÀÃ≥§∆ª', 'JP');   // ÀÃ≥§∆ª§´§È
	$rate->SetDest('≈Ïµ˛≈‘', 'JP');     // ≈Ïµ˛≈‘§ﬁ§«
	$rate->SetWeight(10);           // kg
	$quote = $rate->GetQuote();
	print $quote['type'] . "<br>";
	print $quote['cost'] . "\n";
*/
class _Nittsu {
	var $quote;
	var $OriginZone;
	var $OriginCountryCode = 'JP';
	var $DestZone;
	var $DestCountryCode = 'JP';
	var $Weight = 0;
	var $Length = 0;
	var $Width  = 0;
	var $Height = 0;

	// •≥•Û•π•»•È•Ø•ø
	// $id:   module id
	// $titl: module name
	// $zone: ≈‘∆ª…‹∏©•≥°º•… '01'°¡'47'
	// $country: country code
	function _Nittsu($id, $title, $zone = NULL, $country = NULL) {
		$this->quote = array('id' => $id, 'title' => $title);
		if($zone) {
			$this->SetOrigin($zone, $country);
		}
	}
	// »Ø¡˜∏µ§Ú•ª•√•»§π§Î
	// $zone: ≈‘∆ª…‹∏©•≥°º•… '01'°¡'47'
	// $country: country code
	function SetOrigin($zone, $country = NULL) {
		$this->OriginZone = $zone;
		if($country) {
			$this->OriginCountryCode = $country;
		}
	}
	function SetDest($zone, $country = NULL) {
		$this->DestZone = $zone;
		if($country) {
			$this->DestCountryCode = $country;
		}
	}
	function SetWeight($weight) {
		//$this->Weight = $weight;
		$this->Weight = $weight;
	}
	function SetSize($length = NULL, $width = NULL, $height = NULL) {
		if($length) {
			$this->Length = $length;
		}
		if($width) {
			$this->Width = $width;
		}
		if($height) {
			$this->Height = $height;
		}
	}
	// •µ•§•∫∂Ë ¨(0°¡4)§Ú ÷§π
	// µ¨≥ ≥∞§ŒæÏπÁ§œ9§Ú ÷§π
	//
	// ∂Ë ¨  •µ•§•∫Ãæ  £≥ ’∑◊   Ω≈ŒÃ
	// ----------------------------------
	// 0     60•µ•§•∫  60cm§ﬁ§«  2kg§ﬁ§«
	// 1     80•µ•§•∫  80cm§ﬁ§«  5kg§ﬁ§«
	// 2    100•µ•§•∫ 100cm§ﬁ§« 10kg§ﬁ§«
	// 3    120•µ•§•∫ 120cm§ﬁ§« 15kg§ﬁ§«
	// 4    140•µ•§•∫ 140cm§ﬁ§« 20kg§ﬁ§«
	// 5    170•µ•§•∫ 170cm§ﬁ§« 30kg§ﬁ§«
	// 9    µ¨≥ ≥∞    
	function GetSizeClass() {
		$a_classes = array(
			array(0,  60,  2),  // ∂Ë ¨,£≥ ’∑◊,Ω≈ŒÃ
			array(1,  80,  5),
			array(2, 100, 10),
			array(3, 120, 15),
			array(4, 140, 20),
			array(5, 170, 30)
		);

		$n_totallength = $this->Length + $this->Width + $this->Height;

		while (list($n_index, $a_limit) = each($a_classes)) {
			if ($n_totallength <= $a_limit[1] && $this->Weight <= $a_limit[2]) {
				return $a_limit[0];
			}
		}
		return -1;  // µ¨≥ ≥∞
	}
	// ¡˜…’∏µ§»¡˜…’¿Ë§´§È•≠°º§Ú∫Ó¿Æ§π§Î
	//
	function GetDistKey() {
		$s_key = '';
		$s_z1 = $this->GetLZone($this->OriginZone);
		$s_z2 = $this->GetLZone($this->DestZone);
		if ( $s_z1 && $s_z2 ) {
			// √œ¬”•≥°º•…§Ú•¢•Î•’•°•Ÿ•√•»ΩÁ§Àœ¢∑Î§π§Î
			if ( ord($s_z1) < ord($s_z2) ) {
				$s_key = $s_z1 . $s_z2;
			} else {
				$s_key = $s_z2 . $s_z1;
			}
		}
		return $s_key;
	}
	// ≈‘∆ª…‹∏©•≥°º•…§´§È√œ¬”•≥°º•…§ÚºË∆¿§π§Î
	// $zone: ≈‘∆ª…‹∏©•≥°º•…
	function GetLZone($zone) {
		// ≈‘∆ª…‹∏©•≥°º•…§Ú√œ¬”•≥°º•…('A'°¡'M')§À —¥π§π§Î
		//  ÀÃ≥§∆ª°°:'A' = ÀÃ≥§∆ª
		//  ≈ÏÀÃ°°°°:'B' = ¿ƒøπ∏©,¥‰ºÍ∏©,Ω©≈ƒ∏©,µ‹æÎ∏©,ª≥∑¡∏©, °≈Á∏©
		//  ¥ÿ≈ÏøÆ±€:'C' = ∞ÒæÎ∏©,∆ Ã⁄∏©,∑≤«œ∏©,∫Î∂Ã∏©,¿ÈÕ’∏©,≈Ïµ˛≈‘,ø¿∆‡¿Ó∏©,ª≥Õ¸∏©,ø∑≥„∏©,ƒπÃÓ∏©
		//  √Ê…ÙÀÃŒ¶:'D' = ¥Ù…Ï∏©,¿≈≤¨∏©,∞¶√Œ∏©,ª∞Ω≈∏©,…Ÿª≥∏©,¿–¿Ó∏©, °∞Ê∏©
		//  ¥ÿ¿æ  °°:'E' = º¢≤Ï∏©,µ˛≈‘…‹,¬Á∫Â…‹, º∏À∏©,∆‡Œ…∏©,œ¬≤Œª≥∏©
		//  √ÊπÒ  °°:'F' = ƒªºË∏©,≈Á∫¨∏©,≤¨ª≥∏©,π≠≈Á∏©,ª≥∏˝∏©
		//  ªÕπÒ  °°:'G' = ∆¡≈Á∏©,π·¿Ó∏©,∞¶…≤∏©,π‚√Œ∏©
		//  ∂ÂΩ£°°°°:'H' =  °≤¨∏©,∫¥≤Ï∏©,ƒπ∫Í∏©,¬Á ¨∏©,∑ßÀ‹∏©,µ‹∫Í∏©,ºØª˘≈Á∏©
		//  ≤≠∆Ï °° :'I' = ≤≠∆Ï∏© (ƒÃæÔ ÿ§œ«€√£∂Ë∞Ë≥∞)
		$a_zonemap = array(
		'ÀÃ≥§∆ª'=>'A',  
		'¿ƒøπ∏©'=>'B',  
		'¥‰ºÍ∏©'=>'B',  
		'µ‹æÎ∏©'=>'B',  
		'Ω©≈ƒ∏©'=>'B',  
		'ª≥∑¡∏©'=>'B',  
		' °≈Á∏©'=>'B',  
		'∞ÒæÎ∏©'=>'C',  
		'∆ Ã⁄∏©'=>'C',  
		'∑≤«œ∏©'=>'C',  
		'∫Î∂Ã∏©'=>'C',  
		'¿ÈÕ’∏©'=>'C',  
		'≈Ïµ˛≈‘'=>'C',  
		'ø¿∆‡¿Ó∏©'=>'C',  
		'ø∑≥„∏©'=>'C',  
		'…Ÿª≥∏©'=>'D',  
		'¿–¿Ó∏©'=>'D',  
		' °∞Ê∏©'=>'D',  
		'ª≥Õ¸∏©'=>'C',  
		'ƒπÃÓ∏©'=>'C',  
		'¥Ù…Ï∏©'=>'D',  
		'¿≈≤¨∏©'=>'D',  
		'∞¶√Œ∏©'=>'D',  
		'ª∞Ω≈∏©'=>'D',  
		'º¢≤Ï∏©'=>'E',  
		'µ˛≈‘…‹'=>'E',  
		'¬Á∫Â…‹'=>'E',  
		' º∏À∏©'=>'E',  
		'∆‡Œ…∏©'=>'E',  
		'œ¬≤Œª≥∏©'=>'E',  
		'ƒªºË∏©'=>'F',  
		'≈Á∫¨∏©'=>'F',  
		'≤¨ª≥∏©'=>'F',  
		'π≠≈Á∏©'=>'F',  
		'ª≥∏˝∏©'=>'F',  
		'∆¡≈Á∏©'=>'G',  
		'π·¿Ó∏©'=>'G',  
		'∞¶…≤∏©'=>'G',  
		'π‚√Œ∏©'=>'G',  
		' °≤¨∏©'=>'H',  
		'∫¥≤Ï∏©'=>'H',  
		'ƒπ∫Í∏©'=>'H',  
		'∑ßÀ‹∏©'=>'H',  
		'¬Á ¨∏©'=>'H',  
		'µ‹∫Í∏©'=>'H',  
		'ºØª˘≈Á∏©'=>'H',  
		'≤≠∆Ï∏©'=>'I'   
		);
		return $a_zonemap[$zone];
	}

	function GetQuote() {
		// µ˜Œ• Ã§Œ≤¡≥ •È•Û•Ø: •È•Û•Ø•≥°º•… => ≤¡≥ (60,80,100,120,140,170)
		$a_pricerank = array(
		'N01'=>array( 740, 950,1160,1370,1580,1790), // ƒÃæÔ ÿ(01) ∂·µ˜Œ•
		'N02'=>array( 840,1050,1260,1470,1680,1890), // ƒÃæÔ ÿ(02)   $,1vq(B
		'N03'=>array( 950,1160,1370,1580,1790,2000), // ƒÃæÔ ÿ(03)
		'N04'=>array(1050,1260,1470,1680,1890,2100), // ƒÃæÔ ÿ(04)
		'N05'=>array(1160,1370,1580,1790,2000,2210), // ƒÃæÔ ÿ(05)
		'N06'=>array(1260,1470,1680,1890,2100,2310), // ƒÃæÔ ÿ(06)
		'N07'=>array(1370,1580,1790,2000,2210,2420), // ƒÃæÔ ÿ(07)
		'N08'=>array(1470,1680,1890,2100,2310,2520), // ƒÃæÔ ÿ(08)
		'N09'=>array(1580,1790,2000,2210,2420,2630), // ƒÃæÔ ÿ(09)
		'N10'=>array(1680,1890,2100,2310,2520,2730), // ƒÃæÔ ÿ(10)
		'N11'=>array(1790,2000,2210,2420,2630,2840), // ƒÃæÔ ÿ(11)
	'N12'=>array(1160,1680,2210,2730,3260,3780), // ƒÃæÔ ÿ(12)
	'N13'=>array(1260,1790,2310,2840,3360,3890), // ƒÃæÔ ÿ(13)
	'N14'=>array(1470,2000,2520,3050,3570,4100), // ƒÃæÔ ÿ(14)   $,1vs(B
	'N15'=>array(1890,2420,2940,3470,3990,4520)  // ƒÃæÔ ÿ(15) ±Ûµ˜Œ•
		);
		// √œ¬” - √œ¬”¥÷§Œ≤¡≥ •È•Û•Ø
		// (ª≤æ») http://www.nittsu.co.jp/pelican/fare/index.htm
		$a_dist_to_rank = array(
	'AA'=>'N01',
	'AB'=>'N03','BB'=>'N01',
	'AC'=>'N05','BC'=>'N01','CC'=>'N01',
	'AD'=>'N06','BD'=>'N02','CD'=>'N01','DD'=>'N01',
	'AE'=>'N08','BE'=>'N03','CE'=>'N02','DE'=>'N01','EE'=>'N01',
	'AF'=>'N09','BF'=>'N05','CF'=>'N03','DF'=>'N02','EF'=>'N01','FF'=>'N01',
	'AG'=>'N10','BG'=>'N06','CG'=>'N04','DG'=>'N03','EG'=>'N02','FG'=>'N02','GG'=>'N01',
	'AH'=>'N11','BH'=>'N07','CH'=>'N05','DH'=>'N03','EH'=>'N02','FH'=>'N01','GH'=>'N02','HH'=>'N01',
	'AI'=>'N15','BI'=>'N14','CI'=>'N13','DI'=>'N13','EI'=>'N13','FI'=>'N13','GI'=>'N13','HI'=>'N12','II'=>''
		);

		$s_key = $this->GetDistKey();
		if ( $s_key ) {
			$s_rank = $a_dist_to_rank[$s_key];
			if ( $s_rank ) {
				$n_sizeclass = $this->GetSizeClass();
				if ($n_sizeclass < 0) {
					$this->quote['error'] = MODULE_SHIPPING_NITTSU_TEXT_OVERSIZE;
				} else {
					$this->quote['cost'] = $a_pricerank[$s_rank][$n_sizeclass];
				}
			  //$this->quote['DEBUG'] = ' zone=' . $this->OriginZone . '=>' . $this->DestZone   //DEBUG
			  //              . ' cost=' . $a_pricerank[$s_rank][$n_sizeclass];           //DEBUG
			} else {
				$this->quote['error'] = MODULE_SHIPPING_NITTSU_TEXT_OUT_OF_AREA . '(' . $s_key .')';
			}
		} else {
			$this->quote['error'] = MODULE_SHIPPING_NITTSU_TEXT_ILLEGAL_ZONE . '(' . $this->OriginZone . '=>' . $this->DestZone . ')';
		}
		return $this->quote;
	}
}
?>
