<?php
global $db;

    $add_flag = false;

    if(!empty($_POST['addAdminAcl'])) {
        $adminid = $_POST['addAdminAcl'];
        $menus = $_POST['s_menu'];
        $add_flag = true;
    }elseif(!empty($_POST['selAdmin'])) {
        $adminid = $_POST['selAdmin'];
    }else{
        $adminid = $_SESSION['admin_id'];
    }

    //登録処理
    if($add_flag) {

        //既存データ消去
        $sql = "delete from " . TABLE_ADMIN_ACL . " where admin_id = $adminid";
        $db->execute($sql);

        //admin_aclテーブルへの追加
        if(!empty($menus)) {
            foreach($menus as $key => $submenus) {

                foreach($submenus as $val) {

                    $sql = "insert into "
                            . TABLE_ADMIN_ACL . " "
                            . "(admin_id, easy_admin_top_menu_id, easy_admin_sub_menu_id) "
                            . "values "
                            . "("
                            . $adminid
                            . ", " . $key
                            . ", " . $val
                            . ")";
                    $db->execute($sql);
                }
            }
        }
    }

    $sql = "select "
                . "admin_id, "
                . "admin_name "
            . "from "
                . TABLE_ADMIN;

    $admins = $db->Execute($sql);

    //print $admins->cursor."<br />";

    //右メニューの取得
    $menus_r = getSelectAcl(0);
    //右メニューの拒否状況取得
    $rightmenus = aclCheckList($menus_r, $adminid);

    //メインメニューの取得
    $menus_m = getSelectAcl(1);
    //メインメニューの拒否状況取得
    $mainmenus = aclCheckList($menus_m, $adminid);

/*        while(!$admins->EOF) {
            if($admins->fields['admin_id'] == $adminid) {
                //echo $admins->fields['admin_id']."　".$admins->fields['admin_name']."<br />";
                break;
            }
            $admins->MoveNext();
        }

        $admins->Move(0); //ポインターを最初に戻す

        while(!$admins->EOF) {
            //print $admins->fields['admin_id']."<br />";
            if($admins->fields['admin_id'] != $adminid) {
                //echo $admins->fields['admin_id']."　".$admins->fields['admin_name']."<br />";
            }
            $admins->MoveNext();
        }*/

?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<script language="javascript" src="includes/menu.js"></script>
<script language="javascript" src="includes/general.js"></script>
<link rel="stylesheet" type="text/css" href="includes/javascript/spiffyCal/spiffyCal_v2_1.css">
<script language="JavaScript" src="includes/javascript/spiffyCal/spiffyCal_v2_1.js"></script>
<script type="text/javascript">
  <!--
  function init()
  {
    cssjsmenu('navbar');
    if (document.getElementById)
    {
      var kill = document.getElementById('hoverJS');
      kill.disabled = true;

      var specificday = document.getElementById('specificday');
      if (specificday) {
        while (specificday.childNodes.length)
          specificday.removeChild(specificday.childNodes.item(specificday.childNodes.length-1));
      }
    }
  }

  function deleteConfirm(str)
  {
    return window.confirm("["+str+"]"+"<?php echo TEXT_CONFIRM_MENU_DELETE; ?>");
  }

  function checkDataTop()
  {
    var error = "";

    // 適用対象
    var top_menu_name       = document.getElementById('top_menu_name');
    var top_menu_dropdown_1 = document.getElementById('top_menu_dropdown_1');
    var top_menu_dropdown_0 = document.getElementById('top_menu_dropdown_0');
    var top_menu_sort_order = document.getElementById('top_menu_sort_order');

    if (top_menu_name.value == '')
      error += "<?php echo TEXT_ERROR_MENU_NAME;?>\n";

    if (!top_menu_dropdown_1.checked  &&
        !top_menu_dropdown_0.checked)
      error += "<?php echo TEXT_ERROR_MENU_DROPDOWN;?>\n";

    if (!top_menu_sort_order.value.match(/^[0-9]+$/))
      error += "<?php echo TEXT_ERROR_MENU_ORDER;?>\n";

    if (error != "") {
      window.alert(error);
      return false;
    }

    return true;
  }

/*=============================================================
■ チェックボックスの全チェック処理（10/06/16）
=============================================================*/
    function checkAll(id) {

        var formslen = document.forms["formAcl"].length;
        var forms = document.forms["formAcl"];
        var topid = "top_" + id;
        var topelem = document.getElementById(topid);

        var attr;

        for(var i=0; i<formslen; i++) {
            attr = String(forms[i].getAttribute("id"));

            if(attr.indexOf(topid) > -1) {
                chkelem = document.getElementById(attr);
                if(topelem.checked) {
                    chkelem.checked = true;
                }else{
                    chkelem.checked = false;
                }
            }
        }


    }



  // -->
</script>

<link rel="stylesheet" href="<?php echo DIR_WS_CATALOG.DIR_WS_INCLUDES; ?>addon_modules/easy_design/css/colorPicker.css" type="text/css" />
<script language="javascript" src="<?php echo DIR_WS_CATALOG.DIR_WS_INCLUDES; ?>addon_modules/easy_design/js/jquery-1.3.2.min.js"></script>
<script language="javascript" src="<?php echo DIR_WS_CATALOG.DIR_WS_INCLUDES; ?>addon_modules/easy_design/js/jquery.colorPicker.js"></script>
<style type="text/css">
#colRight table td, #colLeft table td {
    text-align: left;
}
.boxChk {
    padding-left: 15px;
    width: 20px;
}
</style>
</head>
<body onload="init()">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<h1 class="pageHeading"><?php echo HEADING_TITLE; ?></h1>

<form method="post" name="formAdmin" id="formAdmin">
    <p>
        <label for="admin">管理者の選択</label>
        <select name="selAdmin" id="selAdmin" onchange="submit();">

        <?php while(!$admins->EOF) : ?>
            <?php if($admins->fields['admin_id'] == $adminid) : ?>
                <option value="<?php echo $admins->fields['admin_id']; ?>" selected><?php echo $admins->fields['admin_name']; ?></option>
            <?php else : ?>
                <option value="<?php echo $admins->fields['admin_id']; ?>"><?php echo $admins->fields['admin_name']; ?></option>
            <?php endif; ?>
        <?php $admins->MoveNext(); ?>
        <?php endwhile; ?>

        </select>
    </p>
</form>
<p>アクセス拒否をする画面を選択してください</p>

<form method="post" name="formAcl" id="formAcl">
<input type="hidden" name="addAdminAcl" value="<?php echo $adminid; ?>" />

<table border="0" cellpadding="0" cellspacing="0">
    <tr>
        <!-- 右カラム（メインメニュー） -->
        <td id="colLeft" valign="top"style="padding-right:15px;">

            <h3 style="line-height:1.4em; background-color:#ccc; text-indent:5px;">メインメニュー</h3>

        <?php for($i=0; $i<count($mainmenus); $i++) : ?>

            <table border="0">
                <tr>
                    <td colspan="2"><input type="checkbox" id="top_<?php echo $mainmenus[$i]['id']; ?>" onclick="checkAll(<?php echo $mainmenus[$i]['id']; ?>);" /> <strong><?php echo $mainmenus[$i]['name']; ?></strong> (すべてチェック)</td>
                </tr>
            <?php for($n=0; $n<count($mainmenus[$i]['menu']); $n++) : ?>
                <!-- サブメニュー -->
                <tr>
                    <td class="boxChk"><input type="checkbox" name="s_menu[<?php echo $mainmenus[$i]['id']; ?>][]" value="<?php echo $mainmenus[$i]['menu'][$n]['id']; ?>" id="top_<?php echo $mainmenus[$i]['id']; ?>_sub_<?php echo $mainmenus[$i]['menu'][$n]['id']; ?>" <?php echo $mainmenus[$i]['menu'][$n]['aclflag']; ?> /></td>
                    <td class="menuLabel"> <?php echo $mainmenus[$i]['menu'][$n]['name']; ?></td>
                </tr>
            <?php endfor; ?>
            </table>
        <?php endfor; ?>
        </td>
        <!-- 左カラム（右メニュー） -->
        <td id="colRight" valign="top" style="padding-left:15px;">

            <h3 style="line-height:1.4em; background-color:#ccc; text-indent:5px;">右メニュー</h3>

        <?php for($i=0; $i<count($rightmenus); $i++) : ?>

            <table border="0">
                <tr>
                    <td colspan="2"><input type="checkbox"  id="top_<?php echo $rightmenus[$i]["id"]; ?>" onclick="checkAll(<?php echo $rightmenus[$i]["id"]; ?>);" /> <strong><?php echo $rightmenus[$i]["name"]; ?></strong> (すべてチェック)</td>
                </tr>
            <?php for($n=0; $n<count($rightmenus[$i]['menu']); $n++) : ?>
                <tr>
                    <td class="boxChk"><input type="checkbox" name="s_menu[<?php echo $rightmenus[$i]["id"]; ?>][]" value="<?php echo $rightmenus[$i]['menu'][$n]['id']; ?>" id="top_<?php echo $rightmenus[$i]["id"]; ?>_sub_<?php echo $rightmenus[$i]['menu'][$n]['id']; ?>" <?php echo $rightmenus[$i]['menu'][$n]['aclflag']; ?> /></td>
                    <td class="menuLabel"> <?php echo $rightmenus[$i]['menu'][$n]['name']; ?></td>
                </tr>
            <?php endfor; ?>
            </table>
        <?php endfor; ?>
        </td>
    </tr>
</table>

<p><input type="submit" value="登録" /></p>

</form>

</body>
</html>