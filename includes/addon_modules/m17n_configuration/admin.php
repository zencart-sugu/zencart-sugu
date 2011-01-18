<?php
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

global $db;
global $messageStack;
// 変更があったことを示すフラグ
$modified = false;
$restored = false;

// 更新処理
if (isset($_POST['securityToken']) && isset($_POST['action']) && $_POST['action'] == 'update') {
  if (isset($_POST['m17n_configuration'])) {
    $cfg_key = array();
    $cfg_ptl_key = array();
    foreach ($_POST['m17n_configuration'] as $key => $value) {
      // product_type_layout用
      $product_type_layout = false;
      // addon module用
      $addon_module = false;
      // module用
      $module = false;
      if (strpos($key, MODULE_M17N_CONFIGURATION_PRODUCT_TYPE_LAYOUT_PREFIX) === 0) {
        // このkeyはproduct_type_layout用
        $product_type_layout = true;
      }
      elseif (strpos($key, MODULE_M17N_CONFIGURATION_MODULE_PREFIX) === 0) {
        // このkeyはmodule用
        $module = true;
        $key = substr($key, strlen(MODULE_M17N_CONFIGURATION_MODULE_PREFIX));
      }
      elseif (strpos($key, MODULE_M17N_CONFIGURATION_ADDON_MODULE_PREFIX) === 0) {
        // このkeyはaddon module用
        $addon_module = true;
        $key = substr($key, strlen(MODULE_M17N_CONFIGURATION_ADDON_MODULE_PREFIX));
      }
      // checkされた項目を処理
      if ($value == 'on') {
        $cfg_key[] = '\''.zen_db_input($key).'\'';
        // 変更されていないconfiguration_keyの処理
        if (zen_m17n_is_modified($key) === false) {
          $modified = true;
          // configuratinテーブルからset_function,use_functionを取得
          $functions = zen_m17n_get_functions($key, $product_type_layout);
          // set_functionの値に応じて新しいset_functionを決定
          $new_set_function = ($addon_module || $module) ? zen_m17n_select_function($functions['set_function'], '[configuration]['.$key.']') : zen_m17n_select_function($functions['set_function']);
          // 取得したfunctionをm17n_configuration_keysテーブルに挿入
          zen_m17n_backup_configuration($key, $functions['set_function'], $functions['use_function']);
          // configurationテーブル又はproduct_type_layoutテーブルを更新
          zen_m17n_update_configuration($key, $new_set_function, $functions['use_function'], $product_type_layout);
        }
      }
    } // end of foreach
    // チェックの無い項目はconfigurationテーブルとproduct_type_layoutテーブルを復元しm17n_configuration_keysテーブルから削除
    if (sizeof($cfg_key) > 0) {
      $restored = zen_m17n_restore_configuration($cfg_key);
    }
  } // end of isset($_POST['m17n_configuration'])
  else {
    // チェックが一つも無かった場合は全て復元
    $restored = zen_m17n_restore_configuration();
  }
  // 変更があったらメッセージスタックに追加
  if ($modified || $restored) {
    $messageStack->add_session(MODULE_M17N_CONFIGURATION_CHECK_MESSAGE, 'success');
  }
  // 同一画面にredirect
  zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=m17n_configuration'));
}
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<style type="text/css">
<!--
#configuration_group li {list-style-type:none;}
#configuration_group div {
    display:inline;
}
.depth1 {
    background:#CFD4E6 none repeat scroll 0 0;
}
.depth2 {
    background:#D7E2F4 none repeat scroll 0 0;
}
.depth3 {
    background:#DFEAFC none repeat scroll 0 0;
}
.group_title, .group_btn {
    padding-left:5px;
    padding-right:10px;
}
.group_btn {
    cursor:pointer;
}
.configuration {
    display:none;
}
-->
</style>
<script language="javascript" src="includes/menu.js"></script>
<script language="javascript" src="includes/general.js"></script>
<script type="text/javascript">
  <!--
  function init()
  {
    cssjsmenu('navbar');
    if (document.getElementById)
    {
      var kill = document.getElementById('hoverJS');
      kill.disabled = true;
    }
  }
  // -->
</script>
<script type="text/javascript">
<!--
// start xLibrary
// xGetElementById r2, Copyright 2001-2007 Michael Foster (Cross-Browser.com)
// Part of X, a Cross-Browser Javascript Library, Distributed under the terms of the GNU LGPL
function xGetElementById(e)
{
  if (typeof(e) == 'string') {
    if (document.getElementById) e = document.getElementById(e);
    else if (document.all) e = document.all[e];
    else e = null;
  }
  return e;
}
// xGetElementsByTagName r5, Copyright 2002-2007 Michael Foster (Cross-Browser.com)
// Part of X, a Cross-Browser Javascript Library, Distributed under the terms of the GNU LGPL
function xGetElementsByTagName(t,p)
{
  var list = null;
  t = t || '*';
  p = xGetElementById(p) || document;
  if (typeof p.getElementsByTagName != 'undefined') { // DOM1
    list = p.getElementsByTagName(t);
    if (t=='*' && (!list || !list.length)) list = p.all; // IE5 '*' bug
  }
  else { // IE4 object model
    if (t=='*') list = p.all;
    else if (p.all && p.all.tags) list = p.all.tags(t);
  }
  return list || [];
}
// xGetElementsByClassName r6, Copyright 2002-2009 Michael Foster (Cross-Browser.com)
// Part of X, a Cross-Browser Javascript Library, Distributed under the terms of the GNU LGPL
function xGetElementsByClassName(c,p,t,f)
{
  var r = [], re, e, i;
  re = new RegExp("(^|\\s)"+c+"(\\s|$)");
//  var e = p.getElementsByTagName(t);
  e = xGetElementsByTagName(t,p); // See xml comments.
  for (i = 0; i < e.length; ++i) {
    if (re.test(e[i].className)) {
      r[r.length] = e[i];
      if (f) f(e[i]);
    }
  }
  return r;
}
// xNextSib r4, Copyright 2005-2007 Michael Foster (Cross-Browser.com)
// Part of X, a Cross-Browser Javascript Library, Distributed under the terms of the GNU LGPL
function xNextSib(e,t)
{
  e = xGetElementById(e);
  var s = e ? e.nextSibling : null;
  while (s) {
    if (s.nodeType == 1 && (!t || s.nodeName.toLowerCase() == t.toLowerCase())){break;}
    s = s.nextSibling;
  }
  return s;
}
// xPrevSib r4, Copyright 2005-2007 Michael Foster (Cross-Browser.com)
// Part of X, a Cross-Browser Javascript Library, Distributed under the terms of the GNU LGPL
function xPrevSib(e,t)
{
  e = xGetElementById(e);
  var s = e ? e.previousSibling : null;
  while (s) {
    if (s.nodeType == 1 && (!t || s.nodeName.toLowerCase() == t.toLowerCase())){break;}
    s = s.previousSibling;
  }
  return s;
}
// xFirstChild r4, Copyright 2004-2007 Michael Foster (Cross-Browser.com)
// Part of X, a Cross-Browser Javascript Library, Distributed under the terms of the GNU LGPL
function xFirstChild(e,t)
{
  e = xGetElementById(e);
  var c = e ? e.firstChild : null;
  while (c) {
    if (c.nodeType == 1 && (!t || c.nodeName.toLowerCase() == t.toLowerCase())){break;}
    c = c.nextSibling;
  }
  return c;
}
// xAddEventListener r8, Copyright 2001-2007 Michael Foster (Cross-Browser.com)
// Part of X, a Cross-Browser Javascript Library, Distributed under the terms of the GNU LGPL
function xAddEventListener(e,eT,eL,cap)
{
  if(!(e=xGetElementById(e)))return;
  eT=eT.toLowerCase();
  if(e.addEventListener)e.addEventListener(eT,eL,cap||false);
  else if(e.attachEvent)e.attachEvent('on'+eT,eL);
  else {
    var o=e['on'+eT];
    e['on'+eT]=typeof o=='function' ? function(v){o(v);eL(v);} : eL;
  }
}
// xMenu5 r1, Copyright 2004-2007 Michael Foster (Cross-Browser.com)
// Part of X, a Cross-Browser Javascript Library, Distributed under the terms of the GNU LGPL
function xMenu5(idUL, btnClass, idAutoOpen) // object prototype
{
  // Constructor

  var i, ul, btns, mnu = xGetElementById(idUL);
  btns = xGetElementsByClassName(btnClass, mnu, 'DIV');
  for (i = 0; i < btns.length; ++i) {
    ul = xNextSib(btns[i], 'UL');
    btns[i].xClpsTgt = ul;
    btns[i].onclick = btn_onClick;
    set_display(btns[i], 0);
  }
  if (idAutoOpen) {
    var e = xGetElementById(idAutoOpen);
    while (e && e != mnu) {
      if (e.xClpsTgt) set_display(e, 1);
      while (e && e != mnu && e.nodeName != 'LI') e = e.parentNode;
      e = e.parentNode; // UL
      while (e && !e.xClpsTgt) e = xPrevSib(e);
    }
  }

  // Private
  
  function btn_onClick()
  {
    var thisLi, fc, pUl;
    if (this.xClpsTgt.style.display == 'none') {
      set_display(this, 1);
      // get this label's parent LI
      var li = this.parentNode;
      thisLi = li;
      pUl = li.parentNode; // get this LI's parent UL
      li = xFirstChild(pUl); // get the UL's first LI child
      // close all labels' ULs on this level except for thisLI's label
      while (li) {
        if (li != thisLi) {
          fc = xFirstChild(li);
          if (fc && fc.xClpsTgt) {
            set_display(fc, 0);
          }
        }
        li = xNextSib(li);
      }
    }  
    else {
      set_display(this, 0);
    }
  }

  function set_display(ele, bBlock)
  {
    if (bBlock) {
      ele.xClpsTgt.style.display = 'block';
      //ele.innerHTML = '-';
      ele.innerHTML = '<?php echo MODULE_M17N_CONFIGURATION_CHECK_CLOSE; ?>';
    }
    else {
      ele.xClpsTgt.style.display = 'none';
      //ele.innerHTML = '+';
      ele.innerHTML = '<?php echo MODULE_M17N_CONFIGURATION_CHECK_OPEN; ?>';
    }
  }

  // Public

  this.onUnload = function()
  {
    for (i = 0; i < btns.length; ++i) {
      btns[i].xClpsTgt = null;
      btns[i].onclick = null;
    }
  }
} // end xMenu5 prototype
// end of xLibrary

xAddEventListener(window,'load', function(){new xMenu5('configuration_group', 'group_btn');}, false);
// -->
</script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF" onload="init()">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo MODULE_M17N_CONFIGURATION_CHECK_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo zen_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td>
<?php
  echo zen_draw_form('m17n_configuration', FILENAME_ADDON_MODULES_ADMIN, 'module=m17n_configuration')."\n";
  // get and output configuration_group_title
  $sql = 'SELECT configuration_group_id as cfg_grp_id, configuration_group_title as cfg_grp_title FROM '.TABLE_CONFIGURATION_GROUP.' WHERE visible=1 ORDER BY configuration_group_id';
  $cfg_grp = $db->Execute($sql);
  echo '<ul id="configuration_group">'."\n";
  while (!$cfg_grp->EOF) {
    // 一般設定
    $sql = 'SELECT configuration_title as cfg_title, configuration_key as cfg_key, configuration_value as cfg_value, configuration_description as cfg_desc, m17n_configuration_key as m17n_cfg_key FROM '.TABLE_CONFIGURATION.' AS c LEFT JOIN '.TABLE_M17N_CONFIGURATION_KEYS.' AS m ON c.configuration_key=m.m17n_configuration_key WHERE configuration_group_id='.$cfg_grp->fields['cfg_grp_id'].' ORDER BY configuration_id';
    $cfg = $db->Execute($sql);
    if (!$cfg->EOF) {
      echo '<li><div class="group_title depth1">'.$cfg_grp->fields['cfg_grp_title'].'</div><div class="group_separator depth1">|</div><div class="group_btn depth1">'.MODULE_M17N_CONFIGURATION_CHECK_OPEN.'</div>'."\n";
      echo '<ul class="configuration">'."\n";
      while (!$cfg->EOF) {
        $checked = empty($cfg->fields['m17n_cfg_key']) ? false : true;
        echo '<li><dl><dt>'.zen_draw_checkbox_field('m17n_configuration['.$cfg->fields['cfg_key'].']', 'on', $checked, '', 'id="'.$cfg->fields['cfg_key'].'"').'<label for="'.$cfg->fields['cfg_key'].'">'.$cfg->fields['cfg_title'].'</label></dt><dd>'.strip_tags($cfg->fields['cfg_desc']).'</dd></dl></li>'."\n";
        $cfg->MoveNext();
      }
      echo '</ul></li>'."\n";
    }
    $cfg_grp->MoveNext();
  }
  // 商品タイプの管理
  $sql = 'SELECT configuration_title as cfg_title, configuration_key as cfg_key, configuration_value as cfg_value, configuration_description as cfg_desc, m17n_configuration_key as m17n_cfg_key, type_name FROM '.TABLE_PRODUCT_TYPE_LAYOUT.' AS pl LEFT JOIN '.TABLE_M17N_CONFIGURATION_KEYS.' AS m ON pl.configuration_key=SUBSTRING(m.m17n_configuration_key FROM '.(strlen(MODULE_M17N_CONFIGURATION_PRODUCT_TYPE_LAYOUT_PREFIX)+1).') LEFT JOIN '.TABLE_PRODUCT_TYPES.' AS pt ON pl.product_type_id=pt.type_id ORDER BY configuration_id';
  $cfg = $db->Execute($sql);
  if (!$cfg->EOF) {
    echo '<li><div class="group_title depth1">'.HEADING_TITLE_LAYOUT.'</div><div class="group_separator depth1">|</div><div class="group_btn depth1">'.MODULE_M17N_CONFIGURATION_CHECK_OPEN.'</div>'."\n";
    echo '<ul class="configuration">'."\n";
    while (!$cfg->EOF) {
      $checked = empty($cfg->fields['m17n_cfg_key']) ? false : true;
      echo '<li><dl><dt>'.zen_draw_checkbox_field('m17n_configuration['.MODULE_M17N_CONFIGURATION_PRODUCT_TYPE_LAYOUT_PREFIX.$cfg->fields['cfg_key'].']', 'on', $checked, '', 'id="'.$cfg->fields['cfg_key'].'"').'<label for="'.$cfg->fields['cfg_key'].'">'.$cfg->fields['cfg_title'].': '.$cfg->fields['type_name'].'</label></dt><dd>'.strip_tags($cfg->fields['cfg_desc']).'</dd></dl></li>'."\n";
      $cfg->MoveNext();
    }
    echo '</ul></li>'."\n";
  }
  // モジュールの管理
  $module_types = array('payment', 'shipping', 'order_total');
  $modules = array();
  foreach ($module_types as $module_type) {
    $installed_modules = array();
    $cfgs = array();
    $exists = false;

    if ($module_type == 'payment') {
      $parent_title = HEADING_TITLE_PAYMENT;
      $module_directory = DIR_FS_CATALOG_MODULES . 'payment/';
      $directory_array = zen_m17n_read_directory($module_directory);
      $installed_modules = zen_m17n_load_module_files($directory_array, $module_type, $module_directory);
    }
    elseif ($module_type == 'shipping') {
      $parent_title = HEADING_TITLE_SHIPPING;
      $module_directory = DIR_FS_CATALOG_MODULES . 'shipping/';
      $directory_array = zen_m17n_read_directory($module_directory);
      $installed_modules = zen_m17n_load_module_files($directory_array, $module_type, $module_directory);
    }
    elseif ($module_type == 'order_total') {
      $parent_title = HEADING_TITLE_ORDERTOTAL;
      $module_directory = DIR_FS_CATALOG_MODULES . 'order_total/';
      $directory_array = zen_m17n_read_directory($module_directory);
      $installed_modules = zen_m17n_load_module_files($directory_array, $module_type, $module_directory);
    }

    if (sizeof($installed_modules) > 0) {
      foreach ($installed_modules as $module) {
        $module_keys = $module->keys();
        $keys = array();
        for ($i=0, $j=sizeof($module_keys); $i<$j; $i++) {
          $keys[] = '\''.zen_db_input($module_keys[$i]).'\'';
        }
        $sql = 'SELECT configuration_title as cfg_title, configuration_key as cfg_key, configuration_value as cfg_value, configuration_description as cfg_desc, m17n_configuration_key as m17n_cfg_key FROM '.TABLE_CONFIGURATION.' AS c LEFT JOIN '.TABLE_M17N_CONFIGURATION_KEYS.' AS m ON c.configuration_key=m.m17n_configuration_key WHERE configuration_key IN ('.implode(',', $keys).') ORDER BY configuration_id';
        $cfg = $db->Execute($sql);
        if (!$cfg->EOF) {
          $exists = true;
          $cfgs[] = array('title' => $module->title, 'cfg' => $cfg);
        }
      } // end of foreach
      if ($exists && sizeof($cfgs) > 0) {
        $modules[] = array('title' => $parent_title, 'cfgs' => $cfgs);
      }
    }
  }
  if (sizeof($modules) > 0) {
    echo '<li><div class="group_title depth1">'.HEADING_TITLE_MODULES.'</div><div class="group_separator depth1">|</div><div class="group_btn depth1">'.MODULE_M17N_CONFIGURATION_CHECK_OPEN.'</div>'."\n";
    echo '<ul class="configuration">'."\n";
    foreach ($modules as $value1) {
      $parent_title = $value1['title'];
      $cfgs = $value1['cfgs'];
      echo '<li><div class="group_title depth2">'.$parent_title.'</div><div class="group_separator depth2">|</div><div class="group_btn depth2">'.MODULE_M17N_CONFIGURATION_CHECK_OPEN.'</div>'."\n";
      echo '<ul class="configuration">'."\n";
      foreach ($cfgs as $value2) {
        $title = $value2['title'];
        $cfg = $value2['cfg'];
        if (!$cfg->EOF) {
          echo '<li><div class="group_title depth3">'.$title.'</div><div class="group_separator depth3">|</div><div class="group_btn depth3">'.MODULE_M17N_CONFIGURATION_CHECK_OPEN.'</div>'."\n";
          echo '<ul class="configuration">'."\n";
        }
        while (!$cfg->EOF) {
          $checked = empty($cfg->fields['m17n_cfg_key']) ? false : true;
          echo '<li><dl><dt>'.zen_draw_checkbox_field('m17n_configuration['.MODULE_M17N_CONFIGURATION_MODULE_PREFIX.$cfg->fields['cfg_key'].']', 'on', $checked, '', 'id="'.$cfg->fields['cfg_key'].'"').'<label for="'.$cfg->fields['cfg_key'].'">'.$cfg->fields['cfg_title'].'</label></dt><dd>'.strip_tags($cfg->fields['cfg_desc']).'</dd></dl></li>'."\n";
          $cfg->MoveNext();
        }
        echo '</ul></li>'."\n";
      }
      echo '</ul></li>'."\n";
    }
    echo '</ul></li>'."\n";
  } // end of if (sizeof($modules))

  // 追加モジュール一覧の取得
  // from addon_module.php
  $directory_array = array();
  if ($dir = @dir(DIR_FS_CATALOG_ADDON_MODULES)) {
    while ($file = $dir->read()) {
      if (is_dir(DIR_FS_CATALOG_ADDON_MODULES . $file) && strtoupper($file) != 'CVS' && preg_match('/^[^\.]/', $file)) {
        $directory_array[] = $file;
      }
    }
    sort($directory_array);
    $dir->close();
  }

  $installed_modules = array();
  $cfgs = array();
  $exists = false;
  for ($i=0, $n=sizeof($directory_array); $i<$n; $i++) {
    $file = $directory_array[$i];
    $class = $file;
    zen_addOnModules_load_module_files($class);

    if (zen_class_exists($class)) {
      $module = new $class;
      if ($module->check() > 0) {
        if ($module->sort_order > 0 && !isset($installed_modules[$module->sort_order])) {
          $installed_modules[$module->sort_order] = $file;
        } else {
          $installed_modules[] = $file;
        }
      }
      $module_keys = $module->keys();
      $keys = array();
      for ($j=0, $k=sizeof($module_keys); $j<$k; $j++) {
        $keys[] = '\''.zen_db_input($module_keys[$j]).'\'';
      }
      $sql = 'SELECT configuration_title as cfg_title, configuration_key as cfg_key, configuration_value as cfg_value, configuration_description as cfg_desc, m17n_configuration_key as m17n_cfg_key FROM '.TABLE_CONFIGURATION.' AS c LEFT JOIN '.TABLE_M17N_CONFIGURATION_KEYS.' AS m ON c.configuration_key=m.m17n_configuration_key WHERE configuration_key IN ('.implode(',', $keys).') ORDER BY configuration_id';
      $cfg = $db->Execute($sql);
      if (!$cfg->EOF) {
        $exists = true;
        $cfgs[] = array('title' => $module->title, 'cfg' => $cfg);
      }
    }
  } // end of for
  // 多言語化すべき追加モジュールのconfiguration_keyが存在する場合に表示
  if ($exists && sizeof($cfgs) > 0) {
    echo '<li><div class="group_title depth1">'.HEADING_TITLE_ADDON_MODULES.'</div><div class="group_separator depth1">|</div><div class="group_btn depth1">'.MODULE_M17N_CONFIGURATION_CHECK_OPEN.'</div>'."\n";
    echo '<ul class="configuration">'."\n";
    foreach ($cfgs as $value) {
      $title = $value['title'];
      $cfg = $value['cfg'];
      echo '<li><div class="group_title depth2">'.$title.'</div><div class="group_separator depth2">|</div><div class="group_btn depth2">'.MODULE_M17N_CONFIGURATION_CHECK_OPEN.'</div>'."\n";
      echo '<ul class="configuration">'."\n";
      while (!$cfg->EOF) {
        $checked = empty($cfg->fields['m17n_cfg_key']) ? false : true;
        echo '<li><dl><dt>'.zen_draw_checkbox_field('m17n_configuration['.MODULE_M17N_CONFIGURATION_ADDON_MODULE_PREFIX.$cfg->fields['cfg_key'].']', 'on', $checked, '', 'id="'.$cfg->fields['cfg_key'].'"').'<label for="'.$cfg->fields['cfg_key'].'">'.$cfg->fields['cfg_title'].'</label></dt><dd>'.strip_tags($cfg->fields['cfg_desc']).'</dd></dl></li>'."\n";
        $cfg->MoveNext();
      }
      echo '</ul></li>'."\n";
    }
    echo '</li></ul>'."\n";
  }
  echo '</ul>'."\n";
  echo zen_draw_hidden_field('action', 'update');
  echo zen_image_submit('button_update.gif', IMAGE_UPDATE)."\n";
  echo  '<a href="'.zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=m17n_configuration').'">'.zen_image_button('button_cancel.gif', IMAGE_CANCEL).'</a>'."\n";
  echo '</form>'."\n";
?>
                </td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
