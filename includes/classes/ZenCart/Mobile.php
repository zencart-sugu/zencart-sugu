<?php
/**
 * $Id: Mobile.php,v 1.7 2006/03/26 02:04:00 shida Exp $
 *
 * Zen Cart mobile module 0.9
 *  Copyright (C) 2006 by Zen Cart.JP
 *  http://zen-cart.jp
 *
 * Note: Original work copyright to 2006 ARK-Web co., ltd.
 *   http://www.ark-web.jp
 *
 * Zen Cart mobile module is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * Zen Cart mobile module is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Shigeo; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

$include_path = DIR_FS_CATALOG.DIR_WS_CLASSES ."pear";
$include_path .= PATH_SEPARATOR . ini_get("include_path");
ini_set("include_path", $include_path);
require_once 'Net/UserAgent/Mobile.php';

/**
 * Zen Cartをモバイル対応させるためのメソッド等を提供します。
 * 
 * @author Yuki SHIDA <shida＠ark-web.jp>
 * @author Syuichi KOHATA <kohata@e7-ware.com>
 * @package ZenCart
 * @access public
 */
class ZenCart_Mobile {

    var $mobile;
    var $db;

    function ZenCart_Mobile($strUserAgent, $db) {

        $this->mobile = &Net_UserAgent_Mobile::factory($strUserAgent);
        $this->db = $db;
    }

    function init() {

        $this->initParameter();

        return true;
    }

    function init2() {

        $this->initSession();
        $this->initLanguage();
        $this->startOutputBuffering();
        return true;
    }

    function init3(){	
        global $zco_notifier;
        $this->recreateSession();
        if($this->isMobile()){
            require_once(DIR_WS_CLASSES . 'observers/ObserversCountryName.php');
            require_once(DIR_WS_CLASSES . 'observers/ObserversBirthday.php');
            $oCountryName = new ObserversCountryName();
            $oBirthday = new ObserversBirthday();
            $zco_notifier->attach($oCountryName, $oCountryName->getAllEventID());
            $zco_notifier->attach($oBirthday, $oBirthday->getAllEventID());
        }
        
        return true;
    }

    function isMobile() {
      return( ! $this->mobile->isNonMobile() );
    }
    function isDoCoMo(){
        return $this->mobile->isDoCoMo();
    }

    /** 
     * vodafoneのJ-PHONE/3.0/J-T10などの端末では formの
     * action属性にパラメータをいれると、 (例 <form action="index.php?main_page=product_info"> )
     * それらの最後に「?」をつけて、<input>要素のパラメータを
     * そのうしろにつなげる (例 main_page=product_info?zenid=adakjalsdfjalskdjfasdf)
     * POSTの場合は、?を見つけて、それ以降をkey=valでさらにパースする。
     * GETの場合は、全文検索などケースが少ないのでaction属性にパラメータを書かないように修正する
     *
     * また、vodafoneのJ-T10などの端末は
     * formのaction属性にパラメータをいれると、
     * POSTパラメータとしてそれらを送る。
     * GETパラメータとしてうけとらなければならないので、
     * POSTパラメータをGETパラメータにもつける
     */
    function initParameter() {

        if( $this->isMobile( )) {
            if ($this->mobile->isJPhone() || $this->mobile->isVodafone() ) {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
                    foreach ($_POST as $key => $val) {
                        if (strpos($val, '?') != false) {   
                            $_POST[$key] = substr($val, 0, strpos($val, '?'));
                            $decoded_query_string = substr($val, strpos($val, '?') + 1);
                            $key_val_pairs = split("&", $decoded_query_string);
                            foreach ($key_val_pairs as $key_val_pair) {
                                list($key2, $val2) = split("=", $key_val_pair);	  
                                $_POST[$key2] = $val2;
                            }
                        }
                    }
                }
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {     
                foreach ($_POST as $key => $val) {
                    if (! isset($_GET[$key])) {
                        if ($key == "products_id" &&
                            // GETにproducts_idのarrayは入らないではない
                            is_array($val)) {   
                            continue;
                        }
                        else {
                            $_GET[$key] = $val;
                        }
                    }
                }
            }

            foreach ($_GET as $key => $val) {
                if (is_array($val)) {
                    foreach ($val as $key2 => $val2) {
                        $_GET[$key][$key2] = mb_convert_encoding($val2, 'EUC-JP', 'SJIS');
                        $_GET[$key][$key2] = mb_convert_kana($_GET[$key][$key2], 'KV', 'EUC-JP');
                    }
                }
                else {
                    $_GET[$key] = mb_convert_encoding($val, 'EUC-JP', 'SJIS');
                    $_GET[$key] = mb_convert_kana($_GET[$key], 'KV', 'EUC-JP');
                }
            }

            foreach ($_POST as $key => $val) {
                if (is_array($val)) {
                    foreach ($val as $key2 => $val2) {
                        $_POST[$key][$key2] = mb_convert_encoding($val2, 'EUC-JP', 'SJIS');
                        $_POST[$key][$key2] = mb_convert_kana($_POST[$key][$key2], 'KV', 'EUC-JP');
                    }
                }
                else {
                    $_POST[$key] = mb_convert_encoding($val, 'EUC-JP', 'SJIS');
                    $_POST[$key] = mb_convert_kana($_POST[$key], 'KV', 'EUC-JP');
                }
            }            
        }
        return true;
    }
    
    /**
     * セッションIDがパラメータとしてわたってきていない場合は
     * セッション付きURLでリロード
     */
    function initSession() {
        global $session_started;

        if ($this->isMobile() &&
            ! isset($_POST[zen_session_name()]) && 
            ! isset($_GET[zen_session_name()])) {

            require_once(DIR_WS_CLASSES . 'navigation_history.php');
            $navigation = new navigationHistory;
            $navigation->add_current_page();
            $navigation->set_snapshot();
            $snapshot_parameter_array = $navigation->snapshot['get'];
            $self_href = zen_href_link($navigation->snapshot['page'],
                                       zen_array_to_string($snapshot_parameter_array),
                                       $navigation->snapshot['mode']);
            //$self_href .= "&" . zen_session_name() . '=' . zen_session_id();            

            zen_redirect($self_href);
        }

        return true;
    }

    function session_recreate() {
        global $http_domain, $https_domain, $current_domain;
        if ($http_domain == $https_domain) {
            $saveSession = $_SESSION;
            $oldSessID = session_id();
            session_regenerate_id();
            $newSessID = session_id();
            session_id($oldSessID);
            session_destroy();
            session_id($newSessID);
            if (STORE_SESSIONS == 'db') {
                session_set_save_handler('_sess_open', '_sess_close', '_sess_read', '_sess_write', '_sess_destroy', '_sess_gc');
            }
            session_start();
            $_SESSION = $saveSession;
            whos_online_session_recreate($oldSessID, $newSessID);
        }
    }

    function recreateSession(){
        if ($this->isMobile()){

            // セキュアページではセッション再発行
            if($this->isSecurePage()){
                if($_GET['main_page'] != FILENAME_LOGOUT_CONFIRM){
                    $_SESSION['last_secure_page'] =  $_GET['main_page'];
                }
                $this->session_recreate();
            }
            else{
                // セキュアページ以外ではログアウト必須とする
                if (!empty($_SESSION['customer_id'])) {
                    if($_GET['main_page'] != FILENAME_LOGOUT_CONFIRM){
                      //  $page = array('page'=>$_GET['main_page'],'mode'=>'NOSSL');
                        $_SESSION['navigation']->set_snapshot();
                    }
                    if($_GET['main_page'] != FILENAME_LOGOFF){
                        zen_redirect(zen_href_link(FILENAME_LOGOUT_CONFIRM,'','SSL'));
                    }else{
                //        zen_session_destroy();
                    // セッションはDBから削除されるけど$_SESSIONには残っていて、
                    // 「ログアウト」が表示されてしまうので、unset
                  //      unset($_SESSION['customer_id']);
                    }
                }

                // ログイン後トップページに遷移するとログアウトするので
                // マイページに遷移するようにする
                if ($_GET['main_page'] == FILENAME_LOGIN &&
                    sizeof($_SESSION['navigation']->snapshot) == 0){
                    // まず現在のページをスナップショット
                    $_SESSION['navigation']->set_snapshot();
                    // ページ名はaccountに上書き
                    $_SESSION['navigation']->snapshot['page'] = FILENAME_ACCOUNT;
                }
            }
        }

        return true;
    }

    function view_securepage_notice(){
        if($this->isSecurePage()){
            return  TEXT_SECURE_PAGE_NOTICE;
        }
    }
    
    function isSecurePage(){
        $secure_pages = array(
                          //    FILENAME_SHOPPING_CART,
                              FILENAME_ACCOUNT,
                              FILENAME_ACCOUNT_EDIT,
                              FILENAME_ACCOUNT_HISTORY,
                              FILENAME_ACCOUNT_HISTORY_INFO,
                              FILENAME_ACCOUNT_NEWSLETTERS,
                              FILENAME_ACCOUNT_NOTIFICATIONS,
                              FILENAME_ACCOUNT_PASSWORD,
                              FILENAME_ADDRESS_BOOK,
                              FILENAME_ADDRESS_BOOK_PROCESS,
                              FILENAME_CHECKOUT_CONFIRMATION,
                              FILENAME_CHECKOUT_PAYMENT,
                              FILENAME_CHECKOUT_PAYMENT_ADDRESS,
                              FILENAME_CHECKOUT_PROCESS,
                              FILENAME_CHECKOUT_SHIPPING,
                              FILENAME_CHECKOUT_SHIPPING_ADDRESS,
                              FILENAME_CHECKOUT_SUCCESS,
                              FILENAME_CREATE_ACCOUNT,
                              FILENAME_CREATE_ACCOUNT_SUCCESS,
                              FILENAME_EASY_LOGIN_CONFIG,
                              FILENAME_LOGOUT_CONFIRM,
                              FILENAME_PRODUCT_REVIEWS_WRITE,
                              FILENAME_TELL_A_FRIEND
                              );
        //ログイン状態では「カートの中身」はセキュア扱い
        //ログアウト状態では非セキュア扱い
        if($_GET['main_page'] == FILENAME_SHOPPING_CART){
            if(!empty($_SESSION['customer_id'])){
                return true;
            }else{
                return false;
            }
        }
        
        if(in_array($_GET['main_page'],$secure_pages)){
            return true;
        }
        return false;
    }

  	function startOutputBuffering() {
        if ( $this->isMobile() ){
            ob_start("handleMobileOutputBuffering");
        }
    }
    function countryNameConvert($_POST){
        if($this->isMobile()){
            $country = $_POST['country'];
            $state = $_POST['state'];
            $country = zen_db_prepare_input($country);
            $query = 'select countries_id from '.TABLE_COUNTRIES .' where countries_name = "'.$country.'" or countries_iso_code_2="'.$country.'" or countries_iso_code_3="'.$country.'"';
            $result = $this->db->Execute($query);
            $_POST['country'] = $result->fields['countries_id'];
            $query = 'select zone_id from '.TABLE_ZONES.' where zone_name="'.zen_db_prepare_input($state).'"';
            $result = $this->db->Execute($query);
            $_POST['zone_id'] = $result->fileds['zone_id'];
        }
            return $_POST;
    }
    /**
     * zen_href_linkは&を&amp;に全部変換してしまう。
     * モバイルはXHTMLではないので、うまく処理できなくなる
     */
    function getHrefLink($page = '', 
                         $parameters = '', 
                         $connection = 'NONSSL', 
                         $add_session_id = true, 
                         $search_engine_safe = true, 
                         $static = false, 
                         $use_dir_ws_catalog = true) {

        $href_link = zen_href_link($page, 
                                   $parameters,
                                   $connection,
                                   $add_session_id,
                                   $search_engine_safe,
                                   $static,
                                   $use_dir_ws_catalog);

        if ( $this->isMobile() ){	
            $href_link = ereg_replace('&amp;', '&', $href_link);
			if (! strstr($href_link, zen_session_name() . '=' . zen_session_id())) {
                if (! strstr($href_link, '?')) {
                    $href_link .= '?';
                }
                $href_link .= '&' . zen_session_name() . '=' . zen_session_id();
            }
        }

        return $href_link;
    }

       function clearTableBox($str) {
        $str = preg_replace(array("@<table[^>]+>@si",
                                  "@<tr[^>]+>@si",
                                  "@<td[^>]+>@si",
                                  "@<img[^>]+/>@si",
                                  "@</table>@si",
                                  "@</tr>@si",
                                  "@</td>@si",
                                  "@&nbsp;@si"),
                            array("",
                                  "",
                                  "",
                                  "",
                                  "",
                                  "",
                                  "",
                                  ""),
                            $str);
        return $str;
    }

    function initLanguage() {
        if( $this->isMobile() && !isset($_SESSION['language']) ) {
            $lng = new language();
            if (LANGUAGE_DEFAULT_SELECTOR=='Browser') {
                $lng->get_browser_language();
            } else {
                $lng->set_language(DEFAULT_LANGUAGE);
            }
            $language_code = (zen_not_null($lng->language['code']) ? $lng->language['code'] : 'en');
            $mobile_language_code = $language_code . MOBILE_LANGUAGE_CODE_SUFFIX;
            $mobile_language = $this->db->Execute("select * from " . TABLE_LANGUAGES . " where code = '" . zen_db_prepare_input($mobile_language_code) . "'");
            if( $mobile_language->RecordCount() > 0 ){
                $_SESSION['language'] = $mobile_language->fields['directory'];
                $_SESSION['languages_id'] = $mobile_language->fields['languages_id'];
                $_SESSION['languages_code'] = $mobile_language->fields['code'];
            }
        }
    }

    function convertToMobileLink( $href_link ) {
      if ( $this->isMobile() ){
        $href_link = ereg_replace('&amp;', '&', $href_link);
        if ( zen_session_id() && ! strstr($href_link, zen_session_name() . '=' . zen_session_id())) {
          if (! strstr($href_link, '?')) {
            $href_link .= '?';
          }
          $href_link .= '&' . zen_session_name() . '=' . zen_session_id();
        }

        // EUC-JP to SJIS
        if( strpos($href_link, '?') != false ){
          $path = substr($href_link, 0, strpos($href_link, '?') + 1);
          $query = substr($href_link, strpos($href_link, '?') + 1);

          $sjis_key_val_pairs = array();
          $key_val_pairs = split("&", $query);
          foreach( $key_val_pairs as $key_val_pair ){
            list($key, $val) = split("=", $key_val_pair);
            $key = rawurlencode(mb_convert_encoding(rawurldecode($key), 'SJIS', 'EUC-JP'));
            $val = rawurlencode(mb_convert_encoding(rawurldecode($val), 'SJIS', 'EUC-JP'));
            $sjis_key_val_pairs[] = sprintf("%s=%s", $key, $val);
          }
          $sjis_query = join("&", $sjis_key_val_pairs);
          $href_link = $path . $sjis_query;
        }
      }
      return $href_link;
    }


    function mobileImage($src){
      
      if ( ! $this->isMobile() ){
        return $src;
      }

      // this function works only images in DIR_WS_IMAGES.
      if( !preg_match('#^' . DIR_WS_IMAGES . '#', $src) ){
        return $src;
      }

      $src = mobile_find_image($src, $this->getDisplayWidth());

      return $src;
    }

    function getDisplayWidth(){
      // get users display info
      $display = $this->mobile->makeDisplay();

      if( $display->_width >= MOBILE_IMAGES_WIDTH_LARGE ){
        return MOBILE_IMAGES_WIDTH_LARGE;
      }else{
        return MOBILE_IMAGES_WIDTH_SMALL;
      }
    }
    function drawMobileInputField($name, $value = '', $parameters = '', $type = 'text', $reinsert_value = true, $input_style = '') {
      $field = '<input type="' . zen_output_string($type) . '" name="' . zen_output_string($name) . '"';

      if ( (isset($GLOBALS[$name])) && ($reinsert_value == true) ) {
        $field .= ' value="' . zen_output_string(stripslashes($GLOBALS[$name])) . '"';
      } elseif (zen_not_null($value)) {
        $field .= ' value="' . zen_output_string($value) . '"';
      }

      if (zen_not_null($parameters)) $field .= ' ' . $parameters;

      if (zen_not_null($input_style)) {
        $field .= ' ' . $this->mobileInputStyle($input_style);
      }
      $field .= ' />';

      return $field;
    }
    function getSerialNumber(){
        $serialNumber = "";
        switch( true )
        {
            case ($this->mobile->isDoCoMo()):
            case ($this->mobile->isVodafone()): 
               $serialNumber = $this->mobile->getUID();
               if(!isset($serialNumber)){
                   $serialNumber = $this->mobile->getSerialNumber();
               }
               break;
               
            case ($this->mobile->isEZweb()):
               $serialNumber =  $this->mobile->getUID();
               break;
            default:
               break;
        }
        if(isset($serialNumber)){
            return $this->mobile->getCarrierShortName().$serialNumber;
        }else{
            return false;
        }
    }

    function mobileInputStyle($input_style = '') {
      if($this->mobile->getCarrierShortName() == 'V') {
        $vodafone = true;
      }else{
        $vodafone = false;
      }
      switch ($input_style) {
      case 'hiragana':
        $text_input_style = $vodafone ? 'mode="hiragana"' : 'istyle="1"';
        break;
      case 'hankakukana':
        $text_input_style = $vodafone ? 'mode="hankakukana"' : 'istyle="2"';
        break;
      case 'alphabet':
        $text_input_style = $vodafone ? 'mode="alphabet"' : 'istyle="3"';
        break;
      case 'numeric':
        $text_input_style = $vodafone ? 'mode="numeric"' : 'istyle="4"';
        break;
      default :
        $text_input_style = '' ;
      }
      return $text_input_style;
    }
}

function replaceTableToDiv($buffer) {
    $buffer = preg_replace(array(
							  '/<tr /si',
//							  '/<th(.*?)> /si',
                              '/<td.*?( align=".*?")?>/si',
							  '/<table.*?>/si',
							  '/<tr>|<td>|<table>/si',
							  '/<\/tr>|<\/td>|<\/table>/si'
							  ),
                        array(
							  '<div ',
//							  '<div>',
							  '<div$1>',
							  '<div>',
							  '<div>',
							  '</div>'
							  ),
                        $buffer);
    return $buffer;
}
function imgAddBorder($buffer){
	$buffer = preg_replace('/<img(.*?)\/?>/si','<img$1 border="0"/>',$buffer);
	return $buffer;
}
function scriptCancel($buffer){
	$buffer = preg_replace('/<script.*<\/script>|<a href="javascript.*?<\/a>/si','',$buffer);
	return $buffer;
}
function replaceType($from,$to,$buffer){
    $buffer = preg_replace('/<input(.*?)type=\"'.$from.'\"(.*?)/','<input$1type="'.$to.'"$2',$buffer); 
	return $buffer;
}
/*
function convertCharsetSJIS($buffer){
	$buffer = preg_replace('/<meta(.*?)charset=EUC-JP(.*?)/','<meta$1charset=Shift_JIS$2',$buffer);
	return $buffer;
}
*/
function replaceInputTypeImage($buffer){
    $buffer = preg_replace('/<input type="image"(.*?)title="(.*?)"(.*?)\/>/si','<input type="submit" value="$2">',$buffer);
    return $buffer;
}

function replaceSpecialPriceSale($buffer){
    $buffer = preg_replace('/<span class="normalprice">(.*?)<\/span>/', 
			   '<span class="normalprice">$1</span>' . PRODUCT_PRICE_DISCOUNT_ARROW_FOR_MOBILE, 
			   $buffer);
    $buffer = preg_replace('/<span class="productSpecialPriceSale">(.*?)<\/span>/', 
			   '<span class="productSpecialPriceSale">$1</span>' . PRODUCT_PRICE_DISCOUNT_ARROW_FOR_MOBILE, 
			   $buffer);
    return $buffer;
}

function selectToInput($name,$value,$buffer){
    $buffer = preg_replace('/<select.*?name="'.$name.'".*?id="'.$name.'.*?<\/select>/si','<input type=text name="'.$name.'" id="'.$name. '" value="'.$value.'">',$buffer);
	return $buffer;
}
function replaceHtagToBtag($buffer){
    $buffer = preg_replace('/<h\d(.*?)>(.*?)<\/h\d>/si','<b$1>$2</b><br>',$buffer);
    return $buffer;
}
function deleteStrongTag($buffer){
    $buffer = preg_replace('/</si','',$buffer);
    return $buffer;
}
function slimSize($buffer){
    $buffer = preg_replace('/<meta name=("description"|"keywords").*? \/>/si','',$buffer);
    $buffer = preg_replace('/\s{2,}/si',' ',$buffer);
    $buffer = preg_replace('/>\s{1,}</si','><',$buffer);
    $buffer = preg_replace('/\s{1,}>/si','>',$buffer);
    $buffer = preg_replace('/\n|\r|\f/si','',$buffer);
    $buffer = preg_replace('/<!--.*?-->/si','',$buffer);
    return $buffer;
}

function voidableCss($buffer){
    $buffer = preg_replace('/<(.*?)( class=".*?")(.*?)>/si','<$1$3>',$buffer);
    $buffer = preg_replace('/<(.*?)( id=".*?")(.*?)>/si','<$1$3>',$buffer);
    return $buffer;
}
function deleteInvalidTag($buffer){
    $buffer = preg_replace('/<a(.*?)(target=".*?"|title=".*?")*>/si','<a$1>',$buffer);
    $buffer = preg_replace('/<img(.*?)title=".*?"(.*?)>/si','<img$1$3>',$buffer);
    $buffer = preg_replace('/<span.*?>(.*?)<\/span>/si','$1',$buffer);
    $buffer = preg_replace('/<strong.*?>|<\/strong>/si','',$buffer);
    $buffer = preg_replace('/<fieldset>|<\/fieldset>/si','',$buffer);
    $buffer = preg_replace('/<label .*?>|<\/label>/si','',$buffer);
    $buffer = preg_replace('/<legend>|<\/legend>/si','',$buffer);
    $buffer = preg_replace('<(.*?)onload=".*?"|onmouse.*?=".*?"|onsubmit=".*?"(.*?)>','$1$2',$buffer);
    return $buffer;
}


function mobileEmojiConverter($buffer){
    require_once(DIR_FS_CATALOG.'/includes/classes/MobilePictogramConverter/MobilePictogramConverter.php');
    $mec =& MobilePictogramConverter::factory($buffer, MPC_FROM_FOMA, MPC_FROM_CHARSET_SJIS,MPC_FROM_OPTION_WEB);
    if (is_object($mec) == false) {
        die($mec);   
    }
    return $mec->autoConvert();
}
function handleMobileOutputBuffering($buffer) {
    $mobile = createMobileObject();
    mb_http_output("Shift_JIS");
    $buffer = replaceTableToDiv($buffer);
    $buffer = scriptCancel($buffer);
  //  $buffer = convertCharsetSJIS($buffer);
    $buffer = replaceType("password","text",$buffer);
 //   $buffer = imgAddBorder($buffer);
    $buffer = selectToInput('country',zen_get_country_name(SHOW_CREATE_ACCOUNT_DEFAULT_COUNTRY),$buffer);
    $buffer = selectToInput('state',$_POST['state'],$buffer);
    $buffer = replaceInputTypeImage($buffer);
    $buffer = replaceHtagToBtag($buffer);
    $buffer = preg_replace('/<noscript>.*?(<img src=.*?>).*?<\/noscript>/si','$1',$buffer);
    header("Content-type:text/html; charset=Shift_JIS");
    $buffer = replaceSpecialPriceSale($buffer);
    $buffer = mb_convert_encoding($buffer, 'SJIS', 'EUC-JP');
    $buffer = mb_convert_kana($buffer, 'k', 'SJIS');
    $buffer = mb_convert_kana($buffer, 'a', 'SJIS'); 

    // convert <form> tag
    $buffer = preg_replace_callback('#(<form.*?>)#',
				      'queryStringToHiddenField',
				      $buffer);
		      
    $buffer = preg_replace_callback('#(<form.*?>[\s\S]*?</form>)#',
				      'addHideSessionIDInsideForm',
				      $buffer);
				    
    // convert <input> tag (type=text
    $buffer = preg_replace_callback('#(<input.*?type="text".*?/>)#',
				    'addIStyleOrMode',
				    $buffer);
				    
    // convert <input> tag (type=password
    $buffer = preg_replace_callback('#(<input.*?type="password".*?/>)#',
				    'addIStyleOrMode',
				    $buffer);
 
    // convert <a> tag
    $buffer = preg_replace_callback('#(<a.*?>)#',
				      'addSessionID',
				      $buffer);
			    
    // convert <img> tag
    $buffer = preg_replace_callback('#(<img.*?>)#',
				    'replaceImageForMobile',
				    $buffer);

    $buffer = mobileEmojiConverter($buffer); 
    if(!MOBILE_CSS_CONF){
        $buffer = voidableCss($buffer);
    }
    if(MOBILE_SLIM_SIZE){
        $buffer = slimSize($buffer);
    } 
    $buffer = deleteInvalidTag($buffer);
    return $buffer;
}

/**
 * replace query srting to hidden tag in <form> action attributes only post method
 *
 * @param array $matches <form> tag  matches
 * @return string <form> tag
 */
function queryStringToHiddenField($matches) {  
  if(!empty($matches[0])) {
    $tag = $matches[0];
    $hidden_fields = '';
  				 
    preg_match('#<form.*?method="(.*?)".*?>#', $tag, $method_matches);
    $method = $method_matches[1];
    
    preg_match('#<form.*?action="(.*?)".*?>#', $tag, $action_matches);
    $action = $action_matches[1];
    $url_parts = parse_url($action);
    $query_srting = $url_parts['query'];
    if(!preg_match('/guid=on/',$tag)){
        $tag = str_replace('?' . $query_srting, '', $tag);
    }
    if (strtolower($method) == 'post' && strlen($query_srting) > 0) {
      $query_srting = decodeAmpersand($query_srting);      
      parse_str($query_srting, $query_params);
      foreach ($query_params as $key => $value) {
        $hidden_fields .= zen_draw_hidden_field($key, $value);
      }
      
    }
    
    return $tag . $hidden_fields;
  }
}

/**
 * if not include hidden zenid between <form> and </form>, add hidden zenid
 *
 * @param array $matches <form>...</form> matches
 * @return string <form>...</form>
 */
function addHideSessionIDInsideForm($matches) {
  if(!empty($matches[0])) {
    $tag = $matches[0];
    
    if (!preg_match('#<input.*?type="hidden".*?name="' . zen_session_name() . '".*?/>#', $tag)) {
      $tag = preg_replace_callback('#(<form.*?>)#',
  				   'addHideSessionID',
  				   $tag);
    }
    
    return $tag;
  }
}
function createDBObject(){
	global $db;
	if (!is_object($db)) {
		$db = new queryFactory();
		$db->connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_DATABASE, USE_PCONNECT, false);
	}
	return $db;
}
function createMobileObject(){
	global $mobile;
	if (!is_object($mobile)) {
		$mobile = new ZenCart_Mobile($_SERVER['HTTP_USER_AGENT'], createDBObject());
	}
	return $mobile;
}

/**
 * if submit to this zencart, add hidden zenid after <form>
 *
 * @param array $matches <form> tag  matches
 * @return string <form> tag
 */
function addHideSessionID($matches) {
  if(!empty($matches[0])) {
    $tag = $matches[0];
    preg_match('/action="(.*?)"/', $tag, $action_matches);
    $action = $action_matches[1];
    if (isInternalURL($action)) {
      $tag .= zen_hide_session_id();
    }
    
    return $tag;
  }
}

function addIStyleOrMode($matches) {
  if(! empty($matches[0]) &&
    ! preg_match("/(istyle|mode)=/", $matches[0])) {
	 
  	$tag   = $matches[0];
  	preg_match('/name="(.*?)"/', $tag, $name_matches);
  	$name  = $name_matches[1];
  
          global $mobile;
  	$styles = array('dc_redeem_code'         => 'alphabet',
  			'gv_redeem_code'         => 'alphabet',
  			'firstname_kana'         => 'hankakukana',
  			'lastname_kana'          => 'hankakukana',
  			'postcode'               => 'numeric',
  			'telephone'              => 'numeric',
  			'fax'                    => 'numeric',
  			'dob'                    => 'numeric',
  			'email_address'          => 'alphabet',
  			'from_email_address'     => 'alphabet',
  			'lookup_discount_coupon' => 'alphabet',
  			'email'                  => 'alphabet',
  			'password'               => 'alphabet',
  			'password_current'       => 'alphabet',
  			'password_new'           => 'alphabet',
  			'password_confirmation'  => 'alphabet',
  			'confirmation'           => 'alphabet',
  			'amount'                 => 'numeric',
  			'pfrom'                  => 'numeric',
  			'pto'                    => 'numeric',
  			'dfrom'                  => 'numeric',
  			'cart_quantity'          => 'numeric',
  			'cart_quantity[]'        => 'numeric',
  			'dto'                    => 'numeric');
  	$style = $mobile->mobileInputStyle($styles[$name]);
    
  	if (! empty($style)) {
  	    return  preg_replace('#/>$#', $style . " />", $tag);
  	} else {
  	  return $tag;
  	}
  } else {
    return $matches[0];
  }
}

/**
 * if internal link, add zenid after href query strings 
 *
 * @param array $matches <a> tag  matches
 * @return string <a> tag
 */
function addSessionID($matches) {
  if(!empty($matches[0])) {
    $tag = $matches[0];
    
    if (preg_match('/href="(.*?)"/', $tag, $href_matches)) {
      $href_raw = $href_matches[1];
      $href = decodeAmpersand($href_raw);
      
      if (isInternalURL($href)) {
        $zen_session_id = zen_session_name() . '=' . zen_session_id();
        
        if (!strstr($href, $zen_session_id)) {
          if (strstr($href, '?')) {
            $href .= '&';
          } else {
            $href .= '?';
          }
          
          $href .= $zen_session_id;
        }
      }
      
      $tag = str_replace($href_row, $href, $tag);
    }
    
    return $tag;
  }
}

/**
 * check in this zencart URL 
 *
 * @param string $url
 * @return bool in this sate URL return true or not return false
 */
function isInternalURL($url) {
  $http_catalog = HTTP_SERVER . DIR_WS_CATALOG;
  $https_catalog = HTTPS_SERVER . DIR_WS_HTTPS_CATALOG;
  
  if (preg_match('#^(' . $http_catalog . '|' . $https_catalog . ')#', $url, $matches)) {
    return true;
  }
  
  return false;
}

function replaceImageForMobile($matches) {
  global $mobile;

  $tag = $matches[0];
  if(!empty($matches[0])) {
    if (preg_match('/src="(.*?)"/', $tag, $src_matches)) {
      // replace src
      $src = $src_matches[1];
      $mobile_src = $mobile->mobileImage($src);
      $tag = str_replace($src, $mobile_src, $tag);

      if( preg_match('/width="(.*?)"/', $tag, $width_matches) ){
        $display_width = $mobile->getDisplayWidth();
        if( $width_matches[1] > $display_width ){
          // fix width
          $tag = preg_replace('/width=".*?"/', 'width="' . $display_width . '"', $tag);

          if( preg_match('/height="(.*?)"/', $tag, $height_matches) ){
            // fix height
            list($width, $height) = getimagesize(DIR_FS_CATALOG . $mobile_src);
            $fix_height = ceil($height * ($display_width / $width));
            $tag = preg_replace('/height=".*?"/', 'height="' . $fix_height . '"', $tag);
          }
        }
      }
    }
  }
  return $tag;
}


/**
 * replace '&amp;' to '&'
 *
 * @param string $string
 * @return string
 */
function decodeAmpersand($string) {
  $string = str_replace('&amp;', '&', $string);
  return $string;
}
?>
