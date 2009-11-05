<?php
/**
 * easy admin modules functions.php
 *
 * @package functions
 * @copyright Copyright 2008 Liquid System Technology, Inc.
 * @author Koji Sasaki
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: functions.php $
 */

  function getMenus($dropdown=1) {
    global $db;

    $sql = "select
               easy_admin_top_menu_id
              ,easy_admin_top_menu_name
            from ".
              TABLE_EASY_ADMIN_TOP_MENUS."
            where
              is_dropdown=".(int)$dropdown."
            order by
               easy_admin_top_menu_sort_order";
    $result = $db->Execute($sql);

    $index  = 0;
    $menus  = array();
    while (!$result->EOF) {
      $menus[$index] = array('id'   => $result->fields['easy_admin_top_menu_id'],
                             'name' => $result->fields['easy_admin_top_menu_name']);

      $sql = "select
                 easy_admin_sub_menu_id
                ,easy_admin_sub_menu_name
                ,easy_admin_sub_menu_url
              from ".
                TABLE_EASY_ADMIN_SUB_MENUS."
              where
                easy_admin_top_menu_id=".(int)$result->fields['easy_admin_top_menu_id']."
              order by
                 easy_admin_sub_menu_sort_order";
      $subresult = $db->Execute($sql);
      $menus[$index]['menu'] = array();
      while (!$subresult->EOF) {
        $menus[$index]['menu'][] = array('name' => $subresult->fields['easy_admin_sub_menu_name'],
                                         'url'  => $subresult->fields['easy_admin_sub_menu_url']);
        $subresult->MoveNext();
      }

      $index++;
      $result->MoveNext();
    }

    return $menus;
  }

  function getTopMenus($id=0) {
    global $db;

    $sql = "select
               easy_admin_top_menu_id
              ,easy_admin_top_menu_name
              ,is_dropdown
              ,easy_admin_top_menu_sort_order
            from ".
              TABLE_EASY_ADMIN_TOP_MENUS;
    if ($id>0)
      $sql .= " where easy_admin_top_menu_id=".(int)$id;
    $sql .= " order by
              easy_admin_top_menu_sort_order";
    $result = $db->Execute($sql);
    $menu   = array();
    while (!$result->EOF) {
      $menu[] = array('id'       => $result->fields['easy_admin_top_menu_id'],
                      'name'     => $result->fields['easy_admin_top_menu_name'],
                      'dropdown' => $result->fields['is_dropdown'],
                      'order'    => $result->fields['easy_admin_top_menu_sort_order']);
      $result->MoveNext();
    }

    return $menu;
  }

  function insertTopMenu($top_menu_name, $dropdown, $top_menu_order) {
    global $db;

    $sql  = "insert into ".TABLE_EASY_ADMIN_TOP_MENUS." "
          . "(easy_admin_top_menu_name,is_dropdown,easy_admin_top_menu_sort_order)"
          . "values ("
          . "'".zen_db_input($top_menu_name)."',"
          . (int)$dropdown.","
          . (int)top_menu_order.")";
    $db->execute($sql);
  }

  function updateTopMenu($topmenuid, $top_menu_name, $dropdown, $top_menu_order) {
    global $db;

    $sql  = "update ".TABLE_EASY_ADMIN_TOP_MENUS." "
          . "set easy_admin_top_menu_name='".zen_db_input($top_menu_name)."'"
          . ",is_dropdown=".(int)$dropdown
          . ",easy_admin_top_menu_sort_order=".(int)$top_menu_order
          . " where easy_admin_top_menu_id=".(int)$topmenuid;
    $db->execute($sql);
  }

  function deleteTopMenu($topmenuid) {
    global $db;

    $sql  = "delete from ".TABLE_EASY_ADMIN_TOP_MENUS." "
          . "where easy_admin_top_menu_id=".(int)$topmenuid;
    $db->execute($sql);

    $sql = "delete from ".TABLE_EASY_ADMIN_SUB_MENUS." "
          . "where easy_admin_top_menu_id=".(int)$topmenuid;
    $db->execute($sql);
  }

  function getSubMenus($pid, $id=0) {
    global $db;

    $sql = "select
               easy_admin_top_menu_id
              ,easy_admin_sub_menu_id
              ,easy_admin_sub_menu_name
              ,easy_admin_sub_menu_url
              ,easy_admin_sub_menu_sort_order
            from ".
              TABLE_EASY_ADMIN_SUB_MENUS;
    $sql .= " where easy_admin_top_menu_id=".(int)$pid;
    if ($id > 0)
      $sql .= " and easy_admin_sub_menu_id=".(int)$id;
    $sql .= " order by
              easy_admin_sub_menu_sort_order";
    $result = $db->Execute($sql);
    $menu   = array();
    while (!$result->EOF) {
      $menu[] = array('id'    => $result->fields['easy_admin_sub_menu_id'],
                      'topid' => $result->fields['easy_admin_top_menu_id'],
                      'name'  => $result->fields['easy_admin_sub_menu_name'],
                      'url'   => $result->fields['easy_admin_sub_menu_url'],
                      'order' => $result->fields['easy_admin_sub_menu_sort_order']);
      $result->MoveNext();
    }

    return $menu;
  }

  function insertSubMenu($topmenuid, $sub_menu_name, $sub_menu_url, $sub_menu_order) {
    global $db;

    $sql  = "insert into ".TABLE_EASY_ADMIN_SUB_MENUS." "
          . "(easy_admin_top_menu_id,easy_admin_sub_menu_name,easy_admin_sub_menu_url,easy_admin_sub_menu_sort_order)"
          . "values ("
          . (int)$topmenuid.","
          . "'".zen_db_input($sub_menu_name)."',"
          . "'".zen_db_input($sub_menu_url)."',"
          . (int)$sub_menu_order.")";
    $db->execute($sql);
  }

  function updateSubMenu($topmenuid, $submenuid, $sub_menu_name, $sub_menu_url, $sub_menu_order) {
    global $db;

    $sql  = "update ".TABLE_EASY_ADMIN_SUB_MENUS." "
          . "set easy_admin_sub_menu_name='".zen_db_input($sub_menu_name)."'"
          . ",easy_admin_sub_menu_url='".zen_db_input($sub_menu_url)."'"
          . ",easy_admin_sub_menu_sort_order=".(int)$sub_menu_order
          . " where easy_admin_top_menu_id=".(int)$topmenuid
          . " and easy_admin_sub_menu_id=".(int)$submenuid;
    $db->execute($sql);
  }

  function deleteSubMenu($topmenuid, $submenuid) {
    global $db;

    $sql = "delete from ".TABLE_EASY_ADMIN_SUB_MENUS." "
          . "where easy_admin_top_menu_id=".(int)$topmenuid
          . " and easy_admin_sub_menu_id=".(int)$submenuid;
    $db->execute($sql);
  }

  // 旧形式のメニューをパースする
  function parseAdminMenus() {
    // これら２つを設定しないと、うまく読めない
    global $db;
    $PHP_SELF = "dummy";

    ob_start();
    require(DIR_WS_INCLUDES . 'header_navigation.php');
    $old_menu = ob_get_contents();
    ob_end_clean();

    $old_menu = str_replace("\n", "", $old_menu);
    $old_menu = str_replace("\r", "", $old_menu);
    preg_match_all('/<li class\=\"submenu\">(.+?)<\/ul><\/li>/i', $old_menu, $match);

    $menus = array();
    for ($i=0; $i<count($match[1]); $i++) {
      preg_match('/<a.+?>(.+?)<\/a>/', $match[1][$i], $title);
      $menus[$i] = array('title' => $title[1]);
      preg_match_all('/<li>(.+?)<\/li>/i', $match[1][$i], $submenu);
      $menus[$i]['menus'] = array();
      for ($j=0; $j<count($submenu[1]); $j++) {
        preg_match('/<a href=\"(.+?)\">(.+)<\/a>/i', $submenu[1][$j], $a);
        $menu = $a[2];
        $url  = $a[1];
        $url  = str_replace(HTTP_SERVER,        "", $url);
        $url  = str_replace(HTTPS_SERVER,       "", $url);
        $url  = str_replace(DIR_WS_ADMIN,       "", $url);
        $url  = str_replace(DIR_WS_HTTPS_ADMIN, "", $url);
        $menus[$i]['menus'][$j] = array(
          'menu' => $menu,
          'url'  => $url,
        );
      }
    }

    return $menus;
  }

  // メニューを連想配列に変換する
  function convertKeyAdminMenus($menus) {
    $keymenu = array();

    // urlを元に逆配列作成
    for ($i=0; $i<count($menus); $i++) {
      for ($j=0; $j<count($menus[$i]['menus']); $j++) {
        if (!isset($keymenu[$menus[$i]['menus'][$j]['url']]))
          $keymenu[$menus[$i]['menus'][$j]['url']] = $menus[$i]['menus'][$j]['menu'];
      }
    }

    return $keymenu;
  }
?>
