<?php
/**
 * addon_modules_help Module
 *
 * @package Viewed_products
 * @copyright Copyright (C) 2008 Liquid System Technology, Inc.
 * @author Koji Sasaki
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @author Koji Sasaki <sasaki@liquidst.jp>
 * @version $Id: addon_modules_help.php $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

  function getAjaxCategoryTreeJson($array = array()) {
      if (is_array($array)) {
      	$buff = '';
      	foreach ($array as $c) {
          if (count($c['child'])) {
            $expand = "true";
            $isLazy = "false";
          }
          else {
            $expand = "false";
            if ($c['haschild'])
              $isLazy = "true";
            else
              $isLazy = "false";
          }
      	  $buff .= "\n";
      	  $buff .= sprintf('{title:"%s", expand:%s, isFolder:true, key:"%s", isLazy:%s, url:"%s" %s},', $c['title'], $expand, $c['key'], $isLazy, $c['url'], $c['childjson']);
      	}
      	$buff = rtrim($buff, ',');
      	$buff = '['.$buff.']';
      	return $buff;
      } else {
      	return NULL;
      }
  }

  function getHtmlCategoryTree($array = array(), $top=true) {
      $buff = "";
      if ($top)
        $buff .= '<div class="ui-dynatree-container">'."\n";
      if (is_array($array)) {
      	foreach ($array as $c) {
          $buff .= '<div>'."\n";
          if (count($c['child']))
          	$buff .= '  <span class="ui-dynatree-folder ui-dynatree-expanded ui-dynatree-exp-e ui-dynatree-ico-ef" id="sui-dynatree-id-'.$c['categoryid'].'">'."\n";
          else
          	$buff .= '  <span class="ui-dynatree-folder ui-dynatree-exp-c ui-dynatree-ico-cf" id="sui-dynatree-id-'.$c['categoryid'].'">'."\n";
          $buff   .= '    <span class="ui-dynatree-empty"></span>'."\n";
          if ($top && count($c['child']))
            $buff .= '    <span class="ui-dynatree-expander-top"></span>'."\n";
          else if ($top)
            $buff .= '    <span class="ui-dynatree-connector-top"></span>'."\n";
          else if (count($c['child'])) {
            $buff .= '    <span class="ui-dynatree-vline"></span>'."\n";
            $buff .= '    <span class="ui-dynatree-expander"></span>'."\n";
          }
          else {
            $buff .= '    <span class="ui-dynatree-vline"></span>'."\n";
            $buff .= '    <span class="ui-dynatree-connector"></span>'."\n";
          }
          $buff   .= '    <span class="ui-dynatree-icon"></span>'."\n";
          $buff   .= '    <a href="'.zen_href_link(FILENAME_DEFAULT, 'cPath='.$c['url']).'" class="ui-dynatree-title">'.$c['title'].'</a>'."\n";
        	$buff   .= '  </span>'."\n";

          if (count($c['child'])) {
            $buff .= getHtmlCategoryTree($c['child'], false);
          }
          $buff   .= '</div>'."\n";
      	}
      }
      if ($top)
        $buff .= '</div>'."\n";

    	return $buff;
  }
?>