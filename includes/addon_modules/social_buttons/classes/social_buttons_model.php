<?php
/**
 * social_buttons_model Module
 *
 * @package Addon Modules
 * @copyright Copyright (C) 2009 Liquid System Technology, Inc.
 * @author Koji Sasaki
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: social_buttons_model.php $
 */
class SocialButtons {

  function getTwitterButton() {
    $button = null;
    if (MODULE_SOCIAL_BUTTONS_TWITTER_STATUS == 'true') {
      $params = array();
      $params['href']  = 'http://twitter.com/share';
      $params['class'] = 'twitter-share-button';
      $params['data-url']   = $this->_getCurrentUrl();
//      $params['data-text']  = META_TAG_TITLE; // 指定しなければデフォルトでタイトルタグが入る模様
      $params['data-count'] = 'horizontal';
      $params['data-lang']  = $_SESSION['languages_code'] ? $_SESSION['languages_code'] : 'en';
      if (MODULE_SOCIAL_BUTTONS_TWITTER_ACCOUNT) {
        $params['data-via'] = MODULE_SOCIAL_BUTTONS_TWITTER_ACCOUNT;
      }

      $button = '<a'. $this->_makeParamString($params) .'>Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>';
    }
    return $button;
  }

  function getFacebookButton() {
    $button = null;
    if (MODULE_SOCIAL_BUTTONS_FACEBOOK_STATUS == 'true') {
      $params = array();
      $params['class'] = "facebook";
      $params['src']   = "http://www.facebook.com/plugins/like.php?" .
             "href=". urlencode($this->_getCurrentUrl()) ."&" .
             "layout=button_count&" .
             "show_faces=false&" .
             "width=110&" .
             "action=like&" .
             "font=arial&" .
             "colorscheme=light&" .
             "locale=" . ($_SESSION['language'] == 'japanese' ? 'ja_JP' : 'en_US') . "&" .
             "height=20";
      $params['scrolling'] = "no";
      $params['frameborder'] = "0";
      $params['style'] = "border:none; overflow:hidden; width:110px; height:20px;";
      $params['allowTransparency'] = "true";
      $button = '<iframe'. $this->_makeParamString($params) .'></iframe>';
    }
    return $button;
  }

  function getMixiButton() {
    $button = null;
    if (MODULE_SOCIAL_BUTTONS_MIXI_STATUS == 'true' && MODULE_SOCIAL_BUTTONS_MIXI_CHECKKEY) {
      $params = array();
      $params['href']   = "http://mixi.jp/share.pl";
      $params['class']  = "mixi-check-button";
      $params['data-button'] = "button-3";
      $params['data-url']    = $this->_getCurrentUrl();
      $params['data-key']  = MODULE_SOCIAL_BUTTONS_MIXI_CHECKKEY;
      $params['target'] = "_blank";
      $button = '<a'. $this->_makeParamString($params) .'><img src="http://img.mixi.jp/img/basic/mixicheck_entry/bt_check_2.png" style="border: 0pt none;"/></a>
<script type="text/javascript" src="http://static.mixi.jp/js/share.js"></script>';
    }
    return $button;
  }

  function getGreeButton() {
    $button = null;
    if (MODULE_SOCIAL_BUTTONS_GREE_STATUS == 'true') {
      $params = array();
      $params['src'] = "http://share.gree.jp/share?" .
             "url=". urlencode($this->_getCurrentUrl()) ."&" .
             "type=0&" .
             "height=20";
      $params['scrolling']    = "no";
      $params['frameborder']  = "0"; 
      $params['marginwidth']  = "0";
      $params['marginheight'] = "0";
      $params['style'] = "border:none; overflow:hidden; width:90px; height:22px;";
      $params['allowTransparency'] = "true";
      $button = '<iframe'. $this->_makeParamString($params) .'></iframe>';
    }
    return $button;
  }

  function getGoogleplusButton() {
    $button = null;
    if (MODULE_SOCIAL_BUTTONS_GOOGLEPLUS_STATUS == 'true') {
      $button  = "<g:plusone size='medium'></g:plusone>
<script type='text/javascript'>
  window.___gcfg = {lang: 'ja'};

  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>";
    }
    return $button;
  }

  function _makeParamString($params) {
    $param = '';
    foreach ($params as $key => $val) {
      $escaped_val = htmlspecialchars(preg_replace('/"/', '\\"', $val));
      $param .= sprintf(' %s="%s"', $key, $escaped_val);
    }
    return $param;
  }

  function _getCurrentUrl() {
    $url = '';
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
      $url = 'https://';
    }else{
      $url = 'http://';
    }
    $url .= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    if (! preg_match("/language=/", $url)) {
      $url .= '&language='. ($_SESSION['languages_code'] ? $_SESSION['languages_code'] : 'en');
    }

    return $url;
  }
}
