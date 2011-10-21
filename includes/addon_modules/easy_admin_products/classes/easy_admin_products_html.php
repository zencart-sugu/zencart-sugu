<?php
/**
 * @copyright Copyright (c) ark-web, Inc. All rights reserved.
 * @author Syuichi Kohata
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */

if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

class easy_admin_products_html {
  // form作成
  function form($name, $sub="", $option="") {
    if ($sub != "")
      $sub = "/".$sub;
    return zen_draw_form($name, FILENAME_ADDON_MODULES_ADMIN, 'module=easy_admin_products'.$sub, 'post', $option);
  }

  // image作成
  function image($image, $alt) {
    return '<img src="'.DIR_WS_CATALOG.DIR_WS_ADDON_MODULES.'/easy_admin_products/images/'.$image.'" title="'.$alt.'" alt="'.$alt.'" border="0" />';
  }

  // input-image作成
  function input_image($image, $alt) {
    return '<input type="image" src="'.DIR_WS_CATALOG.DIR_WS_ADDON_MODULES.'/easy_admin_products/images/'.$image.'" title="'.$alt.'" alt="'.$alt.'"/>';
  }

  // link作成
  function href_link($sub="", $params=array()) {
    if ($sub != "")
       $sub = "/".$sub;
    $parm = "";
    foreach($params as $k => $v) {
      if ($v != "")
        $parm .= "&".$k."=".urlencode($v);
    }
    return zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=easy_admin_products'.$sub.$parm, 'SSL');
  }

  // 入力項目作成
  function pre_html($title, $colspan=0) {
    if ($colspan>0)
      $colspan = ' colspan="'.$colspan.'"';
    else
      $colspan = '';
    return '<th width="200" nowrap valign="top"'.$colspan.'>'.$title.'</th>'."\n";
    return '<th width="10"></th>'."\n".
           '<th width="200" nowrap valign="top"'.$colspan.'>'.$title.'</th>'."\n";
  }

  function radio($name, $title, $options, $value, $before="", $after="", $parm="", $separator="&nbsp;") {
    $html = self::pre_html($title);
    if ($before != "") {
      $html .= '<td>'.
                 $before.
               '</td>';
    }
    $html .= '<td>';
    foreach($options as $v) {
      $html .= '<input name="'.$name.'" value="'.$v['id'].'" type="radio"';
      if ($v['id'] == $value)
        $html .= ' checked="checked"';
      $html .= $parm.'>&nbsp;'.$v['text'].$separator;
    }
    $html .= $after.
             '</td>'."\n";

    return $html;
  }

  function check($name, $title, $option, $value, $before="", $after="", $parm="") {
    $html = self::pre_html($title);
    if ($before != "") {
      $html .= '<td>'.
                 $before.
               '</td>';
    }
    $html .= '<td>';
    $html .= '<input name="'.$name.'" value="'.$option['id'].'" type="checkbox"';
    if ($option['id'] == $value)
      $html .= ' checked="checked"';
    $html .= $parm.'>&nbsp;'.$option['text'];
    $html .= $after.
             '</td>'."\n";

    return $html;
  }

  function text($name, $title, $value, $before="", $after="", $parm="") {
    $html = self::pre_html($title).
            '<td>'.
              $before.
              '<input type="text" name="'.$name.'" value="'.htmlspecialchars($value).'" '.$parm.'>'.
              $after.
            '</td>'."\n";

    return $html;
  }

  function textarea($name, $title, $value, $before="", $after="", $parm="") {
    $html = self::pre_html($title).
            '<td>'.
              $before.
              '<textarea name="'.$name.'" '.$parm.'>'.
                htmlspecialchars($value).
              '</textarea>'.
              $after.
            '</td>'."\n";

    return $html;
  }

  function select($name, $title, $options, $value, $before="", $after="", $parm="") {
    $html = self::pre_html($title).
            '<td>'.
              $before.
              '<select name="'.$name.'" '.$parm.'>'."\n";
    foreach($options as $v) {
      $html .= '<option value="'.$v['id'].'"';
      if ($v['id'] == $value)
        $html .= ' selected="selected"';
      $html .= '>'.$v['text'].'</option>'."\n";
    }
    $html .= '</select>'."\n".
             $after.
             '</td>'."\n";

    return $html;
  }

  function file($name, $title, $before="", $after="", $parm="") {
    $html = self::pre_html($title).
            '<td>'.
              $before.
              '<input type="file" name="'.$name.'" '.$parm.'>'.
             $after.
            '</td>'."\n";

    return $html;
  }

  // 画像アップロード先
  function get_upload() {
    $dir         = @dir(DIR_FS_CATALOG_IMAGES);
    $dir_info[]  = array('id' => '', 'text' => "Main Directory");
    while ($file = $dir->read()) {
      if (is_dir(DIR_FS_CATALOG_IMAGES . $file) &&
          strtoupper($file) != 'CVS' &&
          strtoupper($file) != 'PRODUCTS_RESIZE' &&
          strtoupper($file) != '.SVN' &&
          $file != "." &&
          $file != "..") {
        $dir_info[] = array('id' => $file . '/', 'text' => $file);
      }
    }

    return $dir_info;
  }

  // エラー出力
  function error($validate, $key) {
    if (isset($validate[$key])) {
      return '<tr><td></td><td><font color="red">'.$validate[$key].'</font></td></tr>';
    }
    else
      return "";
  }

  function onoff_radio($name, $value, $default="off", $on_value=1, $off_value=0) {
    switch ($value) {
      case $off_value:
        $on = false;
        $off = true;
        break;
      case $on_value:
        $on = true;
        $off = false;
        break;
      default:
        $on = ($default == "on");
        $off = ($default == "off");
        break;
    }
    return zen_draw_radio_field($name, $off_value, $off) .'&nbsp;'. TABLE_HEADING_NO .' '.
           zen_draw_radio_field($name, $on_value, $on) .'&nbsp;'. TABLE_HEADING_YES;
  }
}
?>
