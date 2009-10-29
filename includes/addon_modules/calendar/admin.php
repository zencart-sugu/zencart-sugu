<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//  $Id: email_welcome.php 2999 2006-02-09 17:21:39Z drbyte $
//
  require("../includes/addon_modules/calendar/languages/" . $_SESSION['language'] . '.php');
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
    return window.confirm("["+str+"]"+"<?php echo TEXT_CONFIRM_CALENDAR_DELETE; ?>");
  }
  // -->
</script>
</head>
<body onload="init()">
<div id="spiffycalendar" class="text"></div>
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body_text //-->
<?php
// メッセージ
$message = "";
$error   = "";

// 配送日
$delivery_start = MODULE_CALENDAR_DELIVERY_START;
$delivery_end   = MODULE_CALENDAR_DELIVERY_END;

// 操作
$action = $_REQUEST['action'];
$id     = (int)$_REQUEST['ID'];

if ($action == "update" ||
    $action == "insert") {
  $holiday_type  = (int)$_REQUEST['holiday_type'];
  $week1_list    = (int)$_REQUEST['week1_list'];
  $day2_list     = (int)$_REQUEST['day2_list'];
  $weekcnt3_list = (int)$_REQUEST['weekcnt3_list'];
  $week3_list    = (int)$_REQUEST['week3_list'];
  $month4_list   = (int)$_REQUEST['month4_list'];
  $weekcnt4_list = (int)$_REQUEST['weekcnt4_list'];
  $week4_list    = (int)$_REQUEST['week4_list'];
  $month5_list   = (int)$_REQUEST['month5_list'];
  $day5_list     = (int)$_REQUEST['day5_list'];
  $year9_list    = (int)$_REQUEST['year9_list'];
  $month9_list   = (int)$_REQUEST['month9_list'];
  $day9_list     = (int)$_REQUEST['day9_list'];
  $holiday_open  = (int)$_REQUEST['holiday_open'];

  // jsオンの場合の日付
  if (isset($_REQUEST['selectDateText'])) {
    $date        = explode("/", $_REQUEST['selectDateText']);
    $year9_list  = (int)$date[0];
    $month9_list = (int)$date[1];
    $day9_list   = (int)$date[2];
  }

  // 更新データのチェック
  $update = false;
  if (($action == "insert" || $action == "update" && $id > 0) &&
      $holiday_open >= 0 &&
      $holiday_open <= 1) {

    // 毎週？曜日
    if ($holiday_type == 1) {
      if ($week1_list >= 0 &&
          $week1_list <= 6) {
        $update = true;
        if ($action == "insert")
          insertHoliday(     -1, -1, -1, $week1_list, -1, $holiday_open);
        else
          updateHoliday($id, -1, -1, -1, $week1_list, -1, $holiday_open);
      }
    }

    // 毎月？日
    if ($holiday_type == 2) {
      if ($day2_list >= 1 &&
          $day2_list <= 31) {
        $update = true;
        if ($action == "insert")
          insertHoliday(     -1, -1, $day2_list, -1, -1, $holiday_open);
        else
          updateHoliday($id, -1, -1, $day2_list, -1, -1, $holiday_open);
      }
    }

    // 毎月第？週？曜日
    if ($holiday_type == 3) {
      if ($weekcnt3_list >= 1 &&
          $weekcnt3_list <= 5 &&
          $week3_list    >= 0 &&
          $week3_list    <= 6) {
        $update = true;
        if ($action == "insert")
          insertHoliday(     -1, -1, -1, $week3_list, $weekcnt3_list, $holiday_open);
        else
          updateHoliday($id, -1, -1, -1, $week3_list, $weekcnt3_list, $holiday_open);
      }
    }

    // ？月第？週？曜日
    if ($holiday_type == 4) {
      if ($month4_list   >= 1 &&
          $month4_list   <= 12 &&
          $weekcnt4_list >= 1 &&
          $weekcnt4_list <= 5 &&
          $week4_list    >= 0 &&
          $week4_list    <= 6) {
        $update = true;
        if ($action == "insert")
          insertHoliday(     -1, $month4_list, -1, $week4_list, $weekcnt4_list, $holiday_open);
        else
          updateHoliday($id, -1, $month4_list, -1, $week4_list, $weekcnt4_list, $holiday_open);
      }
    }

    // 毎年？月？日
    if ($holiday_type == 5) {
      if (isCorrectCalendar(0, $month5_list, $day5_list)) {
        $update = true;
        if ($action == "insert")
          insertHoliday(     -1, $month5_list, $day5_list, -1, -1, $holiday_open);
        else
          updateHoliday($id, -1, $month5_list, $day5_list, -1, -1, $holiday_open);
      }
    }

    // ？年？月？日
    if ($holiday_type == 9) {
      if (isCorrectCalendar($year9_list, $month9_list, $day9_list)) {
        $update = true;
        if ($action == "insert")
          insertHoliday(     $year9_list, $month9_list, $day9_list, -1, -1, $holiday_open);
        else
          updateHoliday($id, $year9_list, $month9_list, $day9_list, -1, -1, $holiday_open);
      }
    }
  }

  if ($update)
    $message = TEXT_UPDATE_SUCCESS;
  else
    $error   = TEXT_ERROR_SETTING;
}
else if ($action == "delete") {
  if ($id > 0) {
    delHoliday($id);
    $message = TEXT_UPDATE_SUCCESS;
  }
}
else if ($action == "delivery") {
  $start = (int)$_REQUEST['delivery_start'];
  $end   = (int)$_REQUEST['delivery_end'];
  if ($start >=  0 &&
      $end   >=  0 &&
      $start <= 60 &&
      $end   <= 60 &&
      $start < $end) {
    $db->Execute("update " . TABLE_CONFIGURATION . " set configuration_value=".$start." where configuration_key='MODULE_CALENDAR_DELIVERY_START'");
    $db->Execute("update " . TABLE_CONFIGURATION . " set configuration_value=".$end  ." where configuration_key='MODULE_CALENDAR_DELIVERY_END'");
    $delivery_start = $start;
    $delivery_end   = $end;
    $message = TEXT_UPDATE_SUCCESS;
  }
  else
    $error   = TEXT_ERROR_DELIVERY;
}
?>
<div class="messageStackSuccess"><?php echo $message; ?></div>
<div class="messageStackError"><?php echo $error; ?></div>

<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr>
    <td valign="top">
      <table border="0" width="95%" cellspacing="0" cellpadding="2" align="center">
        <tr>
          <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
        </tr>
        <tr>
          <td class="errorText"><?php echo HEADING_SUBTITLE_HOLIDAY; ?></td>
        </tr>
        <tr>
          <td><?php echo TEXT_HOLIDAY_INFORMATION; ?></td>
        </tr>
        <tr>
          <td>
            <table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent" nowrap><?php echo TEXT_HEADER_CALENDAR_TYPE; ?></td>
                <td class="dataTableHeadingContent"><?php echo TEXT_HEADER_CALENDAR_NAME; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TEXT_HEADER_CALENDAR_OPERATION; ?></td>
              </tr>
<?php
//  $calendar = calCalendar(2009, 5);
//  print_r($calendar);
  // 休日情報の取得
  $holidays = getHolidayWeekday();

  // 休日一覧を生成
  for ($i=0; $i<count($holidays); $i++) {
    $holiday_id      = $holidays[$i]['id'];
    $holiday_year    = $holidays[$i]['year'];
    $holiday_month   = $holidays[$i]['month'];
    $holiday_day     = $holidays[$i]['day'];
    $holiday_week    = $holidays[$i]['week'];
    $holiday_weekcnt = $holidays[$i]['weekcnt'];
    $holiday_open    = $holidays[$i]['open'];

    $info = toInfo($holiday_year, $holiday_month, $holiday_day, $holiday_week, $holiday_weekcnt, $holiday_open);

    if ($holiday_id == $id)
      echo '<tr class="dataTableRowSelected" ';
    else
      echo '<tr class="dataTableRow" ';
    echo 'onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\''.zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module='.FILENAME_CALENDAR.'&ID='.$holiday_id).'\'">'."\n";
    echo   '<td class="dataTableContent" width="10%" nowrap>'."\n";
    echo     $holiday_open?TEXT_OPENDAY:"";
    echo   '</td>'."\n";
    echo   '<td class="dataTableContent"  width="10%" nowrap>'."\n";
    echo     $info;
    echo   '</td>'."\n";
    echo   '<td class="dataTableContent"  align="right">'."\n";
    echo     zen_draw_form('edit', FILENAME_ADDON_MODULES_ADMIN, 'module='.FILENAME_CALENDAR);
    echo       zen_draw_hidden_field('ID',     $holiday_id);
    echo       '<input type="submit" value="'.TEXT_ACTION_EDIT.'">'."\n";
    echo     '</form>'."\n";
    echo     zen_draw_form('delete', FILENAME_ADDON_MODULES_ADMIN, 'module='.FILENAME_CALENDAR);
    echo       zen_draw_hidden_field('action', 'delete');
    echo       zen_draw_hidden_field('ID',     $holiday_id);
    echo       '<input type="submit" value="'.TEXT_ACTION_DELETE.'" onClick="return deleteConfirm('."'".$info."'".');">'."\n";
    echo     '</form>'."\n";
    echo     '<a href="'.zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module='.FILENAME_CALENDAR.'&ID='.$holiday_id).'">';
    if ($holiday_id == $id)
      echo zen_image(DIR_WS_IMAGES . 'icon_arrow_right.gif');
    else
      echo zen_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO);
    echo     '</a>&nbsp;'."\n";
    echo   '</td>'."\n";
    echo '</tr>'."\n";
  }
?>
            </table>
          </td>

          <td width="50%" valign="top">
            <table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="infoBoxHeading">
<?php
  // 選択された休日
  $weeks = array(array('id'=>0, 'text'=>sprintf(TEXT_LIST_WEEK,MODULE_CALENDAR_SUN)),
                 array('id'=>1, 'text'=>sprintf(TEXT_LIST_WEEK,MODULE_CALENDAR_MON)),
                 array('id'=>2, 'text'=>sprintf(TEXT_LIST_WEEK,MODULE_CALENDAR_TUE)),
                 array('id'=>3, 'text'=>sprintf(TEXT_LIST_WEEK,MODULE_CALENDAR_WED)),
                 array('id'=>4, 'text'=>sprintf(TEXT_LIST_WEEK,MODULE_CALENDAR_THU)),
                 array('id'=>5, 'text'=>sprintf(TEXT_LIST_WEEK,MODULE_CALENDAR_FRI)),
                 array('id'=>6, 'text'=>sprintf(TEXT_LIST_WEEK,MODULE_CALENDAR_SAT)));

  $years = array();
  for ($i=2008; $i<=2100; $i++)
    $years[] = array('id'=>$i, 'text'=>sprintf(TEXT_LIST_YEAR,$i));

  $months = array();
  for ($i=1; $i<=12; $i++)
    $months[] = array('id'=>$i, 'text'=>sprintf(TEXT_LIST_MONTH,$i));

  $days = array();
  for ($i=1; $i<=31; $i++)
    $days[] = array('id'=>$i, 'text'=>sprintf(TEXT_LIST_DAY,$i));

  $weekcnt = array(array('id'=>1, 'text'=>sprintf(TEXT_LIST_WEEKCNT,1)),
                   array('id'=>2, 'text'=>sprintf(TEXT_LIST_WEEKCNT,2)),
                   array('id'=>3, 'text'=>sprintf(TEXT_LIST_WEEKCNT,3)),
                   array('id'=>4, 'text'=>sprintf(TEXT_LIST_WEEKCNT,4)),
                   array('id'=>5, 'text'=>sprintf(TEXT_LIST_WEEKCNT,5)));

  for ($i=0; $i<count($holidays); $i++) {
    if ($action == "add") {
      $holiday_id      = 0;
      $holiday_year    = -1;
      $holiday_month   = -1;
      $holiday_day     = -1;
      $holiday_week    = -1;
      $holiday_weekcnt = -1;
      $holiday_open    = 0;
    }
    else {
      $holiday_id      = $holidays[$i]['id'];
      $holiday_year    = $holidays[$i]['year'];
      $holiday_month   = $holidays[$i]['month'];
      $holiday_day     = $holidays[$i]['day'];
      $holiday_week    = $holidays[$i]['week'];
      $holiday_weekcnt = $holidays[$i]['weekcnt'];
      $holiday_open    = $holidays[$i]['open'];
    }

    if ($action     == "add" ||
        $holiday_id == $id) {
      if ($action == "add")
        $info = TEXT_LIST_ADD;
      else
        $info = toInfo($holiday_year, $holiday_month, $holiday_day, $holiday_week, $holiday_weekcnt, $holiday_open);
      echo   '<td class="infoBoxHeading" colspan="2"><b>'.$info.'</b></td>'."\n";
      echo '</tr>'."\n";

      echo zen_draw_form('calendar', FILENAME_ADDON_MODULES_ADMIN, 'module='.FILENAME_CALENDAR);
      if ($action == "add")
        echo zen_draw_hidden_field('action', 'insert');
      else
        echo zen_draw_hidden_field('action', 'update');
      echo zen_draw_hidden_field('ID', $holiday_id);

      // 日付タイプの決定(1〜5)
      if ($holiday_year  == -1 &&
          $holiday_month == -1 &&
          $holiday_day   != -1)
        $type = 2;
      else if ($holiday_year    == -1 &&
               $holiday_month   == -1 &&
               $holiday_day     == -1 &&
               $holiday_week    != -1 &&
               $holiday_weekcnt == -1)
        $type = 1;
      else if ($holiday_year    == -1 &&
               $holiday_month   == -1 &&
               $holiday_day     == -1 &&
               $holiday_week    != -1 &&
               $holiday_weekcnt != -1)
        $type = 3;
      else if ($holiday_year    == -1 &&
               $holiday_month   != -1 &&
               $holiday_day     == -1 &&
               $holiday_week    != -1 &&
               $holiday_weekcnt != -1)
        $type = 4;
      else if ($holiday_year  == -1 &&
               $holiday_month != -1 &&
               $holiday_day   != -1)
        $type = 5;
      else
        $type = 9;

      if ($action == "add")
        $type = 1;

      // 毎週？曜日
      echo '<tr>'."\n";
      echo   '<td  class="infoBoxContent">'."\n";
      echo     zen_draw_radio_field("holiday_type", 1, $type==1).TEXT_RADIO_EVERYWEEK;
      echo   '</td>'."\n";
      echo   '<td  class="infoBoxContent">'."\n";
      echo     zen_draw_pull_down_menu("week1_list", $weeks, $holiday_week);
      echo   '</td>'."\n";
      echo '</tr>'."\n";

      // 毎月？日
      echo '<tr>'."\n";
      echo   '<td  class="infoBoxContent">'."\n";
      echo     zen_draw_radio_field("holiday_type", 2, $type==2).TEXT_RADIO_EVERYMONTH;
      echo   '</td>'."\n";
      echo   '<td  class="infoBoxContent">'."\n";
      echo     zen_draw_pull_down_menu("day2_list", $days, $holiday_day);
      echo   '</td>'."\n";
      echo '</tr>'."\n";

      // 毎月第？週？曜日
      echo '<tr>'."\n";
      echo   '<td  class="infoBoxContent">'."\n";
      echo     zen_draw_radio_field("holiday_type", 3, $type==3).TEXT_RADIO_EVERYMONTH;
      echo   '</td>'."\n";
      echo   '<td  class="infoBoxContent">'."\n";
      echo     zen_draw_pull_down_menu("weekcnt3_list", $weekcnt, $holiday_weekcnt);
      echo     zen_draw_pull_down_menu("week3_list",    $weeks,   $holiday_week);
      echo   '</td>'."\n";
      echo '</tr>'."\n";

      // ？月第？週？曜日
      echo '<tr>'."\n";
      echo   '<td  class="infoBoxContent">'."\n";
      echo     zen_draw_radio_field("holiday_type", 4, $type==4).TEXT_RADIO_MONTH;
      echo   '</td>'."\n";
      echo   '<td  class="infoBoxContent">'."\n";
      echo     zen_draw_pull_down_menu("month4_list",   $months,  $holiday_month);
      echo     zen_draw_pull_down_menu("weekcnt4_list", $weekcnt, $holiday_weekcnt);
      echo     zen_draw_pull_down_menu("week4_list",    $weeks,   $holiday_week);
      echo   '</td>'."\n";
      echo '</tr>'."\n";

      // 毎年？月？日
      echo '<tr>'."\n";
      echo   '<td  class="infoBoxContent">'."\n";
      echo     zen_draw_radio_field("holiday_type", 5, $type==5).TEXT_RADIO_EVERYYEAR;
      echo   '</td>'."\n";
      echo   '<td  class="infoBoxContent">'."\n";
      echo     zen_draw_pull_down_menu("month5_list", $months, $holiday_month);
      echo     zen_draw_pull_down_menu("day5_list",   $days,   $holiday_day);
      echo   '</td>'."\n";
      echo '</tr>'."\n";

      // ？年？月？日
      echo '<tr>'."\n";
      echo   '<td  class="infoBoxContent">'."\n";
      echo     zen_draw_radio_field("holiday_type", 9, $type==9).TEXT_RADIO_SPECIFICDAY;
      echo   '</td>'."\n";
      echo   '<td  class="infoBoxContent">'."\n";
      echo     '<div id="specificday">'."\n";
      echo     zen_draw_pull_down_menu("year9_list",  $years,  $holiday_year);
      echo     zen_draw_pull_down_menu("month9_list", $months, $holiday_month);
      echo     zen_draw_pull_down_menu("day9_list",   $days,   $holiday_day);
      echo     '</div>'."\n";
      if ($holiday_year > 0 && $holiday_month > 0 && $holiday_day)
        $date = zen_date_short(sprintf("%04d-%02d-%02d 00:00:00", $holiday_year, $holiday_month, $holiday_day));
      else
        $date = "";
      echo     '<script language="javascript">'."\n";
      echo     'var selectDate = new ctlSpiffyCalendarBox("selectDate", "calendar", "selectDateText", "btnDate1", "'.$date.'",scBTNMODE_CUSTOMBLUE);'."\n";
      echo     'selectDate.writeControl();'."\n";
      echo     'selectDate.dateFormat="'.DATE_FORMAT_SPIFFYCAL.'";'."\n";
      echo     '</script>'."\n";
      echo   '</td>'."\n";
      echo '</tr>'."\n";

      // 休日、営業日
      echo '<tr>'."\n";
      echo   '<td colspan="2"  class="infoBoxContent">'."\n";
      echo     sprintf(TEXT_RADIO_DESCRIPTION,
                 zen_draw_radio_field("holiday_open", 0, $holiday_open==0).TEXT_RADIO_HOLIDAY.
                 zen_draw_radio_field("holiday_open", 1, $holiday_open==1).TEXT_RADIO_OPENDAY
               );
      echo   '</td>'."\n";
      echo '</tr>'."\n";

      // 更新
      echo '<tr>'."\n";
      echo   '<td colspan="2"  class="infoBoxContent" align="center">'."\n";
      if ($action == "add")
        echo     '<input type="submit" value="'.TEXT_ACTION_ADD.'">'."\n";
      else
        echo     '<input type="submit" value="'.TEXT_ACTION_UPDATE.'">'."\n";
      echo   '</td>'."\n";
      echo '</tr>'."\n";

      echo '</form>'."\n";

      echo '<tr>'."\n";
    }

    if ($action == "add")
      break;
  }
?>
              </tr>
            </table>
          </td>

        </tr>

        <tr>
          <td>
<?php
    echo     zen_draw_form('add', FILENAME_ADDON_MODULES_ADMIN, 'module='.FILENAME_CALENDAR);
    echo       zen_draw_hidden_field('action', 'add');
    echo       '<input type="submit" value="'.TEXT_ACTION_ADD.'">'."\n";
    echo     '</form>'."\n";
?>
          </td>
        </tr>

        <tr>
          <td>
            <hr/>
          </td>
        </tr>

        <tr>
          <td>
            <table border="0">
              <tr>
                <td class="errorText">
                <?php
                  echo zen_draw_separator('pixel_trans.gif', 1, 16);
                  echo HEADING_SUBTITLE_SHIPPING;
                ?>
              </td>
              </tr>

              <tr>
                <td>
                  <?php echo MODULE_CALENDAR_DELIVERY_DESCRIPTION; ?>
                </td>
              </tr>

              <tr>
                <td>
                  <?php
                   echo zen_draw_form('add', FILENAME_ADDON_MODULES_ADMIN, 'module='.FILENAME_CALENDAR);
                   echo   zen_draw_hidden_field('action', 'delivery');
                   echo   sprintf(MODULE_CALENDAR_DELIVERY_INPUT,
                                  zen_draw_input_field('delivery_start', $delivery_start, 'size="3"'),
                                  zen_draw_input_field('delivery_end',   $delivery_end,   'size="3"'));
                   echo   '<input type="submit" value="'.TEXT_ACTION_UPDATE.'">'."\n";
                   echo '</form>'."\n";
                  ?>
                </td>
              </tr>
            </table>
          </td>
        </tr>

      </table>
    </td>
  </tr>
</table>
<!-- body_text_eof //-->
<br>
</body>
</html>
<?php
  function toInfo($holiday_year, $holiday_month, $holiday_day, $holiday_week, $holiday_weekcnt, $holiday_open)
  {
    $weeks = array(MODULE_CALENDAR_SUN,
                   MODULE_CALENDAR_MON,
                   MODULE_CALENDAR_TUE,
                   MODULE_CALENDAR_WED,
                   MODULE_CALENDAR_THU,
                   MODULE_CALENDAR_FRI,
                   MODULE_CALENDAR_SAT);

    $info = "";

    // 日が一致
    if ($holiday_year  == -1 &&
        $holiday_month == -1 &&
        $holiday_day   != -1) {
      $info = MODULE_CALENDAR_HOLIDAY_DAY;
      $info = str_replace('%_DAY_%', $holiday_day, $info);
    }

    // 曜日が一致
    if ($holiday_year    == -1 &&
        $holiday_month   == -1 &&
        $holiday_day     == -1 &&
        $holiday_week    != -1 &&
        $holiday_weekcnt == -1) {
      $info = MODULE_CALENDAR_HOLIDAY_WEEK;
      $info = str_replace('%_WEEK_%', $weeks[$holiday_week], $info);
    }

    // 曜日と週が一致
    if ($holiday_year    == -1 &&
        $holiday_month   == -1 &&
        $holiday_day     == -1 &&
        $holiday_week    != -1 &&
        $holiday_weekcnt != -1) {
      $info = MODULE_CALENDAR_HOLIDAY_WEEKCNT;
      $info = str_replace('%_WEEKCNT_%', $holiday_weekcnt,      $info);
      $info = str_replace('%_WEEK_%',    $weeks[$holiday_week], $info);
      $text .= ",".$info;
    }

    // 月と曜日と週が一致
    if ($holiday_year    == -1 &&
        $holiday_month   != -1 &&
        $holiday_day     == -1 &&
        $holiday_week    != -1 &&
        $holiday_weekcnt != -1) {
      $info = MODULE_CALENDAR_HOLIDAY_MONTHWEEKCNT;
      $info = str_replace('%_MONTH_%',   $holiday_month,        $info);
      $info = str_replace('%_WEEKCNT_%', $holiday_weekcnt,      $info);
      $info = str_replace('%_WEEK_%',    $weeks[$holiday_week], $info);
    }

    // 月日が一致
    if ($holiday_year  == -1 &&
        $holiday_month != -1 &&
        $holiday_day   != -1) {
      $info = MODULE_CALENDAR_HOLIDAY_MONTHDAY;
      $info = str_replace('%_MONTH_%', $holiday_month, $info);
      $info = str_replace('%_DAY_%',   $holiday_day,   $info);
    }

    // 年月日が一致
    if ($holiday_year  != -1 &&
        $holiday_month != -1 &&
        $holiday_day   != -1) {
      $info = MODULE_CALENDAR_HOLIDAY_YEARMONTHDAY;
      $info = str_replace('%_YEAR_%',  $holiday_year,  $info);
      $info = str_replace('%_MONTH_%', $holiday_month, $info);
      $info = str_replace('%_DAY_%',   $holiday_day,   $info);
    }

    return $info;
  }
?>