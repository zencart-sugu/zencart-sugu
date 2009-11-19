<?php
/**
 * ZaikoRobot Configuration
 *
 * @package point
 * @copyright Copyright (C) 2008 Hunglead Co. Ltd.
 * @copyright Portions Copyright (C) 2008 Zen Cart.JP
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @author Hunglead
 */

require('includes/application_top.php');

$action = (isset($_GET['action']) ? $_GET['action'] : '');

$success = "";
$error   = array();

switch ($action) {
  case '' :
  case 'default' :
    if (defined("ZAIKOROBOT_ENABLE"))
      $enable = ZAIKOROBOT_ENABLE;
    else
      $enable = "false";

    if (defined("ZAIKOROBOT_USERID"))
      $id = ZAIKOROBOT_USERID;
    else
      $id = "";

    if (defined("ZAIKOROBOT_PASSWORD"))
      $passwd = ZAIKOROBOT_PASSWORD;
    else
      $passwd = "";

    if (defined("ZAIKOROBOT_EMAIL"))
      $email = ZAIKOROBOT_EMAIL;
    else
      $email = "";

    if (defined("ZAIKOROBOT_LOG"))
      $log = ZAIKOROBOT_LOG;
    else
      $log = "false";
    break;
  case 'save':
    $enable = (isset($_POST['enable'])?$_POST['enable']:'false');
    $id     = (isset($_POST['id'])    ?$_POST['id']    :'');
    $passwd = (isset($_POST['passwd'])?$_POST['passwd']:'');
    $email  = (isset($_POST['email']) ?$_POST['email'] :'');
    $log    = (isset($_POST['log'])   ?$_POST['log']   :'false');
    if ($enable != 'true' && $enable != 'false')
      $error[] = "有効無効を正しく選択してください";

    if ($id == '')
      $error[] = "IDを正しく入力してください";

    if ($passwd == '')
      $error[] = "パスワードを正しく入力してください";

    if ($email == '' || !preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $email))
      $error[] = "メールアドレスを正しく入力してください";

    if ($log != 'true' && $log != 'false')
      $error[] = "ログ機能を正しく選択してください";

    if (count($error) == 0) {
      $success = "登録が成功しました";
      updateConfiguration("", "ZAIKOROBOT_ENABLE",   $enable);
      updateConfiguration("", "ZAIKOROBOT_USERID",   $id);
      updateConfiguration("", "ZAIKOROBOT_PASSWORD", $passwd);
      updateConfiguration("", "ZAIKOROBOT_EMAIL",    $email);
      updateConfiguration("", "ZAIKOROBOT_LOG",      $log);

      if ($log == 'true') {
        $sql = "create table if not exists ".FILENAME_ZAIKOROBOT_LOGS." (
                  zaikorobot_logs_id int(11) auto_increment
                 ,from_zaikorobot    text
                 ,to_zaikorobot      text
                 ,date_added         datetime
                 ,primary key (zaikorobot_logs_id)
                )";
        $db->Execute($sql);
      }
    }
    break;
}

function updateConfiguration($title, $key, $value) {
  global $db;

  $result = $db->Execute("select * from ".TABLE_CONFIGURATION." where configuration_key = '".zen_db_input($key)."'");
  if ($result->EOF) {
    $sql_data_array = array(
      'configuration_title'       => $title,
      'configuration_key'         => $key,
      'configuration_value'       => $value,
      'configuration_description' => '',
      'configuration_group_id'    => 0,
      'sort_order'                => 0,
      'last_modified'             => 'now()',
      'date_added'                => 'now()',
    );
    zen_db_perform(TABLE_CONFIGURATION, $sql_data_array);
  }
  else {
    $sql_data_array = array(
      'configuration_title'       => $title,
      'configuration_key'         => $key,
      'configuration_value'       => $value,
      'configuration_description' => '',
      'configuration_group_id'    => 0,
      'sort_order'                => 0,
      'last_modified'             => 'now()',
      'date_added'                => 'now()',
    );
    zen_db_perform(TABLE_CONFIGURATION, $sql_data_array, "update", "configuration_key = '".zen_db_input($key)."'");
  }
}
?>

<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">

<link rel="stylesheet" href="/admin/css/common.css" type="text/css" />

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
</head>
<body onload="init()">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<?php
  if (count($error) > 0) {
    echo "<h2>エラーが発生しました</h2>\n";
    echo "<h2>".implode("<br>", $error)."</h2>\n";
  }

  if ($success != '') {
    echo "<h2>".$success."</h2>\n";
  }
?>

<!-- body //-->
<table width="100%" border="0" cellspacing="0" cellpadding="0" summary=" ">
  <?php echo zen_draw_form('form1', FILENAME_ZAIKOROBOT_CONFIGURATION, 'action=save'); ?>
    <tr valign="top">
      <td>
        <table width="500" border="0" cellspacing="1" cellpadding="8" summary=" ">
          <tr>
            <td bgcolor="#ffffff">
              zaiko robot連動モジュールをご利用頂くには、<br/>
              ユーザ様ご自身でハングリード株式会社とご契約頂く必要があります。 <br/>
              お申し込みにつきましては、下記のページよりお問い合わせ下さい。<br/><br/>
              <a href="http://www.hunglead.com/" target="_blank">＞＞ハングリード株式会社</a>
            </td>
          </tr>
        </table>

        <table width="500" border="0" cellspacing="1" cellpadding="8" summary=" ">
          <tr>
            <td width="100" bgcolor="#f3f3f3">有効/無効フラグ</td>
            <td width="200" bgcolor="#ffffff">
              <input type="radio" name="enable" value="true"  <?php echo $enable=="true" ?"checked":""?>>有効
              <input type="radio" name="enable" value="false" <?php echo $enable=="false"?"checked":""?>>無効
            </td>
          </tr>

          <tr>
            <td width="100" bgcolor="#f3f3f3">ID</td>
            <td width="200" bgcolor="#ffffff">
              <input type="text" name="id" style="ime-mode:disabled;" value="<?php echo htmlspecialchars($id); ?>">
            </td>
          </tr>

          <tr>
            <td width="" bgcolor="#f3f3f3">パスワード</td>
            <td width="337" bgcolor="#ffffff">
              <input type="password" name="passwd" style="ime-mode:disabled;" value="<?php echo htmlspecialchars($passwd); ?>">
            </td>
          </tr>

          <tr>
            <td width="" bgcolor="#f3f3f3">メールアドレス</td>
            <td width="337" bgcolor="#ffffff">
              <input type="text" name="email" style="ime-mode:disabled;" value="<?php echo htmlspecialchars($email); ?>">
            </td>
          </tr>

          <tr>
            <td width="100" bgcolor="#f3f3f3">ログ機能フラグ</td>
            <td width="200" bgcolor="#ffffff">
              <input type="radio" name="log" value="true"  <?php echo $log=="true" ?"checked":""?>>有効
              <input type="radio" name="log" value="false" <?php echo $log=="false"?"checked":""?>>無効
            </td>
          </tr>
        </table>

        <table width="500" border="0" cellspacing="0" cellpadding="0" summary=" ">
          <tr>
            <td bgcolor="#e9e7de" align="center">
              <table border="0" cellspacing="0" cellpadding="0" summary=" ">
                <tr>
                  <td><input type="submit" value="登録"/></td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </form>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
