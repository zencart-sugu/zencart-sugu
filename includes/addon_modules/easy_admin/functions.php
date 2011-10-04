<?php
/**
 * easy admin modules functions.php
 *
 * @package functions
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
              ,is_dropdown
            from ".
              TABLE_EASY_ADMIN_TOP_MENUS."
            where
              is_dropdown=".(int)$dropdown."
            order by
               easy_admin_top_menu_sort_order";

    $result = $db->Execute($sql);

    $index  = 0;
    $menus  = array();

    //トップメニューを取得する処理ここから
    while (!$result->EOF) {

        //トップメニューIDをキーにサブメニュー数を取得
        $sql = "select "
                    ."count(*) "
                . "from "
                    . TABLE_EASY_ADMIN_SUB_MENUS . " "
                . "where "
                    . "easy_admin_top_menu_id = " . $result->fields['easy_admin_top_menu_id'];

        $cnt_submenu = $db->Execute($sql);

        //トップメニューIDと管理者IDをキーにアクセス制御リスト数を取得
        $sql = "select "
                    . "count(*) "
                . "from "
                    . TABLE_ADMIN_ACL . " "
                . "where "
                    . "admin_id = " . $_SESSION['admin_id'] . " "
                . "and "
                    . "easy_admin_top_menu_id = " . $result->fields['easy_admin_top_menu_id'];

        $cnt_acllist = $db->Execute($sql);

        //サブメニュー数と制御リスト数が異なれば処理
        //（同じならトップメニューを含むメニュー生成処理はスルー）
        if($cnt_submenu->fields['count(*)'] != $cnt_acllist->fields['count(*)']) {

            $menus[$index] = array('id' => $result->fields['easy_admin_top_menu_id'],
                                    'name' => $result->fields['easy_admin_top_menu_name']);

            //サブメニューデータ取得
            $sql = "select "
                        . "edsm.easy_admin_sub_menu_id, "
                        . "edsm.easy_admin_sub_menu_name, "
                        . "edsm.easy_admin_sub_menu_url, "
                        . "aa.acl_id "
                    . "from "
                        . TABLE_EASY_ADMIN_SUB_MENUS . " edsm "
                    . "left join "
                        . TABLE_ADMIN_ACL . " aa "
                    . "on "
                        . "edsm.easy_admin_sub_menu_id = aa.easy_admin_sub_menu_id "
                    . "and "
                        . "aa.admin_id = " . $_SESSION['admin_id'] . " "
                    . "where "
                        . "edsm.easy_admin_top_menu_id = " . $result->fields['easy_admin_top_menu_id'];

            $subresult = $db->Execute($sql);

            $menus[$index]['menu'] = array();


            while (!$subresult->EOF) {
                if(empty($subresult->fields['acl_id'])) {
                    $menus[$index]['menu'][] = array('id' => $subresult->fields['easy_admin_sub_menu_id'],
                                                    'name' => $subresult->fields['easy_admin_sub_menu_name'],
                                                    'url'  => $subresult->fields['easy_admin_sub_menu_url']);
                }

                $subresult->MoveNext();

            }

            $index++;

        }

        $result->MoveNext();

    }

    return $menus;
  }

  function getSelectAcl($dropdown=1) {

    global $db;

    $sql = "select
               easy_admin_top_menu_id
              ,easy_admin_top_menu_name
              ,is_dropdown
            from ".
              TABLE_EASY_ADMIN_TOP_MENUS."
            where
              is_dropdown=".(int)$dropdown."
            order by
               easy_admin_top_menu_sort_order";

    $result = $db->Execute($sql);

    $index  = 0;
    $acls  = array();

    while (!$result->EOF) {

        //トップメニューにサブメニューが登録されていなければトップも非表示にする処理
        $sql = "select "
                    . "count(*) "
                . "from "
                    . TABLE_EASY_ADMIN_SUB_MENUS . " "
                . "where "
                    . "easy_admin_top_menu_id = " . $result->fields['easy_admin_top_menu_id'];

        $cnt_submenu = $db->Execute($sql);

        if(!empty($cnt_submenu->fields['count(*)'])) {

            $acls[$index] = array('id'   => $result->fields['easy_admin_top_menu_id'],
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

            $acls[$index]['menu'] = array();

            while (!$subresult->EOF) {
                $acls[$index]['menu'][] = array('id' => $subresult->fields['easy_admin_sub_menu_id'],
                                                'name' => $subresult->fields['easy_admin_sub_menu_name'],
                                                'url'  => $subresult->fields['easy_admin_sub_menu_url']);
                $subresult->MoveNext();
            }

            $index++;

        }

        $result->MoveNext();
    }

    return $acls;
  }

  //アカウントごとの拒否設定情報を取得
    function aclCheckList($menu, $admin) {

        global $db;

        if(empty($admin)) $admin = 0;

        for($i=0; $i<count($menu); $i++) {

            for($n=0; $n<count($menu[$i]['menu']); $n++) {

                $sql = "select "
                            . "count(*) "
                        . "from "
                            . TABLE_ADMIN_ACL . " "
                        . "where "
                            . "admin_id = " . $admin . " "
                        . "and "
                            . "easy_admin_sub_menu_id = " . $menu[$i]['menu'][$n]['id'];

                $count = $db->execute($sql);

                if(!empty($count->fields['count(*)'])) {
                    $menu[$i]['menu'][$n]['aclflag'] = "checked";
                }else{
                    $menu[$i]['menu'][$n]['aclflag'] = NULL;
                }

            }

        }

        return $menu;

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

  //サブメニューの追加処理
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

  function parseAdminMenus() {

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

  function convertKeyAdminMenus($menus) {
    $keymenu = array();

    //
    for ($i=0; $i<count($menus); $i++) {
      for ($j=0; $j<count($menus[$i]['menus']); $j++) {
        if (!isset($keymenu[$menus[$i]['menus'][$j]['url']]))
          $keymenu[$menus[$i]['menus'][$j]['url']] = $menus[$i]['menus'][$j]['menu'];
      }
    }

    return $keymenu;
  }

    function check_page($p) {

        global $db;

        $sql = "select "
                    . "count(*) "
                . "from "
                    . TABLE_ADMIN_ACL . " aa "
                . "inner join "
                    . TABLE_EASY_ADMIN_SUB_MENUS . " easm "
                . "on "
                    . "aa.easy_admin_sub_menu_id = easm.easy_admin_sub_menu_id "
                . "where "
                    . "aa.admin_id = " . $_SESSION['admin_id'] . " "
                . "and "
                    . "easy_admin_sub_menu_url = '" . $p . "'";

        $result = $db->execute($sql);

        if(!empty($result->fields['count(*)'])) {
            return true;
        }else{
            return false;
        }
    }

  function handle_easy_admin_ob($buf) {
    global $easy_admin_block_header;

    $pattern = '/<!-- All HEADER_ definitions in the columns below are defined in includes\/languages\/english\.php \/\/-->.*<!-- header_eof \/\/-->/s';
    $replace = $easy_admin_block_header;
    $buf = preg_replace($pattern, $replace, $buf);
    return $buf;
  }

  function get_params_for_languages_dropdown() {
    // Show Languages Dropdown for convenience only if main filename and directory exists
    if ((basename($_SERVER['PHP_SELF']) != FILENAME_DEFINE_LANGUAGE . '.php') and (basename($_SERVER['PHP_SELF']) != FILENAME_PRODUCTS_OPTIONS_NAME . '.php') and empty($action)) {
      $languages = zen_get_languages();
      if (sizeof($languages) > 1) {
        $languages_array = array();
        $languages_selected = $_GET['language'];
        $missing_languages='';
        for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
          $test_directory= DIR_WS_LANGUAGES . $languages[$i]['directory'];
          $test_file= DIR_WS_LANGUAGES . $languages[$i]['directory'] . '.php';
          if ( file_exists($test_file) and file_exists($test_directory) ) {
            $count++;
            $languages_array[] = array('id' => $languages[$i]['code'],
                                       'text' => $languages[$i]['name']);
            if ($languages[$i]['id'] == $_SESSION['languages_id']) {
              $languages_selected = $languages[$i]['code'];
            }
          } else {
              $missing_languages .= ' ' . ucfirst($languages[$i]['directory']) . ' ' . $languages[$i]['name'];
          }
        }

        // if languages in table do not match valid languages show error message
        if ($count != sizeof($languages)) {
          $messageStack->add('MISSING LANGUAGE FILES OR DIRECTORIES ...' . $missing_languages,'caution');
        }
        $hide_languages= false;
      } else {
        $hide_languages= true;
      } // more than one language
    } else {
      $hide_languages= true;
    } // hide when other language dropdown is used

    $return = array(
      'hide_languages' => $hide_languages,
      'languages' => $languages,
      'languages_array' => $languages_array,
      'languages_selected' => $languages_selected,
    );
    return $return;
  }
?>
