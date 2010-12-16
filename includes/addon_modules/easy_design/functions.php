<?php
/**
 * CALENDAR modules functions.php
 *
 * @package functions
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: functions.php $
 */

  // テンプレート一覧を取得する
  function getTemplates($template="") {
    global $db;

    $dir = @dir(DIR_FS_CATALOG_TEMPLATES);
    if (!$dir)
      die('DIR_FS_CATALOG_TEMPLATES NOT SET');

    $template_info = array();
    while ($file = $dir->read()) {
      if (is_dir(DIR_FS_CATALOG_TEMPLATES . $file) && strtoupper($file) != 'CVS' && $file != '.svn') {
        if ($template == "" || $template == $file) {
          if (file_exists(DIR_FS_CATALOG_TEMPLATES . $file . '/template_info.php')) {
            require(DIR_FS_CATALOG_TEMPLATES . $file . '/template_info.php');

            // カラー設定
            // デフォルト
            $template_color = array(array('key'   => EASY_DESIGN_DEFAULT_MAIN_KEY,
                                          'name'  => EASY_DESIGN_DEFAULT_MAIN_COLOR_NAME,
                                          'value' => EASY_DESIGN_DEFAULT_MAIN_COLOR),
                                    array('key'   => EASY_DESIGN_DEFAULT_SUB_KEY,
                                          'name'  => EASY_DESIGN_DEFAULT_SUB_COLOR_NAME,
                                          'value' => EASY_DESIGN_DEFAULT_SUB_COLOR));
            // ファイルから
            if (file_exists(DIR_FS_CATALOG_TEMPLATES . $file . '/color_config.php'))
              require(DIR_FS_CATALOG_TEMPLATES . $file . '/color_config.php');
            // データベースから
            $template_color = array_merge($template_color, getTemplateColor($file));

            // テーブル更新
            updateTemplateColor($file, $template_color);

            // 再度データベースから
            $template_color = getTemplateColor($file);

            $template_info[] = array('name'        => $template_name,
                                     'version'     => $template_version,
                                     'author'      => $template_author,
                                     'description' => $template_description,
                                     'screenshot'  => $template_screenshot,
                                     'file'        => $file,
                                     'color'       => $template_color,
                                     'id'          => $file,
                                     'text'        => $template_name);
          }
        }
      }
    }
    return $template_info;
  }

  // 全言語のテンプレートを取得する
  function getDefaultTemplate() {
    global $db;

    $sql    = "select template_dir from ".TABLE_TEMPLATE_SELECT." where template_language=0";
    $result = $db->Execute($sql);
    if ($result->EOF)
      return "";
    else
      return $result->fields['template_dir'];
  }

  // 全言語のテンプレートを更新する
  function updateDefaultTemplate($template) {
    global $db;

    $sql = "update ".TABLE_TEMPLATE_SELECT." set template_dir='".zen_db_input($template)."' where template_language=0";
    $db->Execute($sql);
  }

  // テンプレートのカラー設定を読み込む
  function getTemplateColor($template) {
    global $db;

    $sql = "select
               easy_design_color_key
              ,easy_design_color_name
              ,easy_design_color_value
            from
             ".TABLE_EASY_DESIGN_COLORS."
            where
              template_dir='".zen_db_input($template)."'
            order by easy_design_color_id";
    $result = $db->Execute($sql);
    $colors = array();
    while (!$result->EOF) {
      $colors[] = array('key'  =>$result->fields['easy_design_color_key'],
                        'name' =>$result->fields['easy_design_color_name'],
                        'value'=>$result->fields['easy_design_color_value']);
      $result->MoveNext();
    }

    return $colors;
  }

  // テンプレートのカラー設定を更新する
  function updateTemplateColor($template, $template_color) {
    global $db;

    for ($i=0; $i<count($template_color); $i++) {
      // 存在確認
      $sql = "select easy_design_color_id from ".TABLE_EASY_DESIGN_COLORS."
              where template_dir='".zen_db_input($template)."'
              and easy_design_color_key='".zen_db_input($template_color[$i]['key'])."'";
      $result = $db->Execute($sql);
      if ($result->EOF) {
        $sql = "insert into ".TABLE_EASY_DESIGN_COLORS."
                  (template_dir
                  ,easy_design_color_key
                  ,easy_design_color_name
                  ,easy_design_color_value)
                values
                  ('".zen_db_input($template)."'
                  ,'".zen_db_input($template_color[$i]['key'])."'
                  ,'".zen_db_input($template_color[$i]['name'])."'
                  ,'".zen_db_input($template_color[$i]['value'])."')";
      }
      else {
        $sql = "update ".TABLE_EASY_DESIGN_COLORS."
                set
                   easy_design_color_name='".zen_db_input($template_color[$i]['name'])."'
                  ,easy_design_color_value='".zen_db_input($template_color[$i]['value'])."'
                where easy_design_color_id=".(int)$result->fields['easy_design_color_id'];
      }
      $db->Execute($sql);
    }
  }

  // テンプレートのカラー設定を削除
  function deleteTemplateColor($template) {
    global $db;

    $sql = "delete
            from
             ".TABLE_EASY_DESIGN_COLORS."
            where
              template_dir='".zen_db_input($template)."'";
    $db->Execute($sql);
  }

  // テンプレートのカラー設定を元にcss更新
  function updateCssFromTemplateColor($template) {
    $template_info = getTemplates($template);

    // css読み込み
    $file = DIR_FS_CATALOG_TEMPLATES . $template . '/css/' . FILENAME_EASY_DESIGN_CSS_TEMPLATE;
    if (file_exists($file)) {
      $css = file_get_contents($file);

      // カラー置換
      for ($i=0; $i<count($template_info[0]['color']); $i++) {
        $css = str_replace('#{'.$template_info[0]['color'][$i]['key'].'}', $template_info[0]['color'][$i]['value'], $css);
      }

      // css保存
      $file = DIR_FS_CATALOG_TEMPLATES . $template . '/css/' . FILENAME_EASY_DESIGN_CSS;
      clearstatcache();
      if (!is_writable($file))
        return false;

      umask(0);
      if (file_put_contents($file, $css) !== false)
        return true;
      else
        return false;
    }

    return true;
  }

  // 設定されたcssを取得する
  // (http用)
  function getEasyDesignCss() {
    return DIR_WS_TEMPLATES.getDefaultTemplate().'/css/' . FILENAME_EASY_DESIGN_CSS;
  }

  // 文言を読み込む
  function getObjectionWords() {
    global $db;

    $objection = array();
    $sql = "select
               easy_design_language_id
              ,language_id
              ,easy_design_language_key
              ,easy_design_language_name
              ,easy_design_language_value
              ,easy_design_language_sort_order
            from
              ".TABLE_EASY_DESIGN_LANGUAGES."
            where
              language_id=".(int)$_SESSION['languages_id']."
            order by easy_design_language_sort_order";
    $result = $db->Execute($sql);
    while (!$result->EOF) {
      $objection[] = array('id'      =>$result->fields['easy_design_language_id'],
                           'language'=>$result->fields['language_id'],
                           'key'     =>$result->fields['easy_design_language_key'],
                           'name'    =>$result->fields['easy_design_language_name'],
                           'value'   =>$result->fields['easy_design_language_value']
                          );
      $result->MoveNext();
    }

    return $objection;
  }

  // 文言を更新する
  function updateObjectionWords($objection) {
    global $db;

    for ($i=0; $i<count($objection); $i++) {
      $sql = "update ".TABLE_EASY_DESIGN_LANGUAGES."
              set
                 easy_design_language_value='".zen_db_input($objection[$i]['value'])."'
              where easy_design_language_id=".(int)$objection[$i]['id'];
      $db->Execute($sql);
    }
  }

  // アップロードされた画像を取得する
  // (http用)
  function getLogoImage($template, $admin=false) {
    global $request_type;

    $imagedir = DIR_FS_CATALOG.'includes/templates/'.$template.'/images/logo/';
    if (!is_dir($imagedir))
      return "";

    $prefix = DIR_WS_CATALOG;

    $dir = @dir($imagedir);
    while ($file = $dir->read()) {
      if (is_file($imagedir.$file))
        return $prefix.'includes/templates/'.$template.'/images/logo/'.$file;
    }

    return "";
  }

  // アップロードされた画像を元にロゴ画像の更新を行う
  function uploadLogoImage($template, $tempname, $filename) {
    // ファイル属性確認
    $ext = explode(".", $filename);
    switch (strtolower($ext[count($ext)-1])) {
      case 'gif':
      case 'jpeg':
      case 'jpg':
      case 'bmp':
      case 'tif':
      case 'png':
        break;
      default:
        return "EXT";
    }

    // アップロード先のファイルを削除する
    // １個のみとする
    $imagedir = DIR_FS_CATALOG_TEMPLATES.$template.'/images/logo/';
    if (!is_dir($imagedir))
      return "DIR";

    // 書き込み権限の確認
    clearstatcache();
    if (!is_writable($imagedir))
      return "PERMIT";

    $dir = @dir($imagedir);
    while ($file = $dir->read()) {
      if (is_file($imagedir.$file)) {
        if (unlink($imagedir.$file) == false)
          return "UNLINK";
      }
    }

    // アップロードファイルの移動
    if (move_uploaded_file($tempname, $imagedir.$filename) == false)
      return "UPLOAD";

    chmod($imagedir.$filename, 0777);
    return "OK";
  }
?>
