<?php
/**
 * CALENDAR modules functions.php
 *
 * @package functions
 * @copyright Copyright 2008 Liquid System Technology, Inc.
 * @author Koji Sasaki
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: functions.php $
 */
  // 休日データ
  $addon_calendar = array();

  // 指定年月の最終日を計算する
  // (28,29,30,31のどれか)
  function countDays($year, $month) {
    return date('t', mktime(0, 0, 0, $month, 1, $year));
  }

  // 翌月を計算する
  function nextMonth($year, $month) {
    $month++;
    return mktime(0, 0, 0, $month, 1, $year);
  }

  // 指定年月日の曜日を計算する
  // (0:日〜6:土)
  function weekNo($year, $month, $day) {
    return date('w', mktime(0, 0, 0, $month, $day, $year));
  }

  // 指定年月日が何週目か計算する
  function weekCnt($year, $month, $day) {
    return (int)(($day-1)/7)+1;
  }

  // 指定日が休日か、営業日か判断する
  function isOpen($year, $month, $day) {
    global $addon_calendar;

    // 休日データを自動で読み込む
    if (count($addon_calendar) == 0)
      getHolidayWeekday();

    // 曜日と何週目を計算
    $weekno  = weekNo($year, $month, $day);
    $weekcnt = weekCnt($year, $month, $day);

    // 休日判断
    $open = true;
    for ($i=0; $i<count($addon_calendar); $i++) {
      $holiday_year    = $addon_calendar[$i]['year'];
      $holiday_month   = $addon_calendar[$i]['month'];
      $holiday_day     = $addon_calendar[$i]['day'];
      $holiday_week    = $addon_calendar[$i]['week'];
      $holiday_weekcnt = $addon_calendar[$i]['weekcnt'];
      $holiday_open    = $addon_calendar[$i]['open'];

      // 日が一致
      if ($holiday_year  == -1 &&
          $holiday_month == -1 &&
          $holiday_day   == $day) {
        $open = $holiday_open;
      }

      // 曜日が一致
      if ($holiday_year    == -1      &&
          $holiday_month   == -1      &&
          $holiday_day     == -1      &&
          $holiday_week    == $weekno &&
          $holiday_weekcnt == -1) {
        $open = $holiday_open;
      }

      // 曜日と週が一致
      if ($holiday_year    == -1      &&
          $holiday_month   == -1      &&
          $holiday_day     == -1      &&
          $holiday_week    == $weekno &&
          $holiday_weekcnt == $weekcnt) {
        $open = $holiday_open;
      }

      // 月と曜日と週が一致
      if ($holiday_year    == -1      &&
          $holiday_month   == $month  &&
          $holiday_day     == -1      &&
          $holiday_week    == $weekno &&
          $holiday_weekcnt == $weekcnt) {
        $open = $holiday_open;
      }

      // 月日が一致
      if ($holiday_year  == -1     &&
          $holiday_month == $month &&
          $holiday_day   == $day) {
        $open = $holiday_open;
      }

      // 年月日が一致
      if ($holiday_year  == $year  &&
          $holiday_month == $month &&
          $holiday_day   == $day) {
        $open = $holiday_open;
      }
    }

    return $open;
  }

  // 休日情報をテキストで返却する
  function holidayText($year=-1, $month=-1) {
    global $addon_calendar;

    $weeks = array(MODULE_CALENDAR_SUN,
                   MODULE_CALENDAR_MON,
                   MODULE_CALENDAR_TUE,
                   MODULE_CALENDAR_WED,
                   MODULE_CALENDAR_THU,
                   MODULE_CALENDAR_FRI,
                   MODULE_CALENDAR_SAT);

    // 休日データを自動で読み込む
    if (count($addon_calendar) == 0)
      getHolidayWeekday();

    // 休日判断
    $text = "";
    for ($i=0; $i<count($addon_calendar); $i++) {
      $holiday_year    = $addon_calendar[$i]['year'];
      $holiday_month   = $addon_calendar[$i]['month'];
      $holiday_day     = $addon_calendar[$i]['day'];
      $holiday_week    = $addon_calendar[$i]['week'];
      $holiday_weekcnt = $addon_calendar[$i]['weekcnt'];
      $holiday_open    = $addon_calendar[$i]['open'];

      // 営業日は無視
      if ($holiday_open == 1)
        continue;

      // 年月に関係のない休日
      if ($year  == -1 &&
          $month == -1) {
        // 日が一致
        if ($holiday_year  == -1 &&
            $holiday_month == -1 &&
            $holiday_day   != -1) {
          $info = MODULE_CALENDAR_HOLIDAY_DAY;
          $info = str_replace('%_DAY_%', $holiday_day, $info);
          $text .= ",".$info;
        }

        // 曜日が一致
        if ($holiday_year    == -1 &&
            $holiday_month   == -1 &&
            $holiday_day     == -1 &&
            $holiday_week    != -1 &&
            $holiday_weekcnt == -1) {
          $info = MODULE_CALENDAR_HOLIDAY_WEEK;
          $info = str_replace('%_WEEK_%', $weeks[$holiday_week], $info);
          $text .= ",".$info;
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
      }

      // 年月と関連のある休日
      else {
        // 月と曜日と週が一致
        if ($holiday_year    == -1      &&
            $holiday_month   == $month  &&
            $holiday_day     == -1      &&
            $holiday_week    != -1      &&
            $holiday_weekcnt != -1) {
          $info = MODULE_CALENDAR_HOLIDAY_MONTHWEEKCNT;
          $info = str_replace('%_MONTH_%',   $holiday_month,        $info);
          $info = str_replace('%_WEEKCNT_%', $holiday_weekcnt,      $info);
          $info = str_replace('%_WEEK_%',    $weeks[$holiday_week], $info);
          $text .= ",".$info;
        }

        // 月日が一致
        if ($holiday_year  == -1     &&
            $holiday_month == $month &&
            $holiday_day   != -1) {
          $info = MODULE_CALENDAR_HOLIDAY_MONTHDAY;
          $info = str_replace('%_MONTH_%', $holiday_month, $info);
          $info = str_replace('%_DAY_%',   $holiday_day,   $info);
          $text .= ",".$info;
        }

        // 年月日が一致
        if ($holiday_year  == $year  &&
            $holiday_month == $month &&
            $holiday_day   != -1) {
          $info = MODULE_CALENDAR_HOLIDAY_MONTHDAY;
          $info = str_replace('%_MONTH_%', $holiday_month, $info);
          $info = str_replace('%_DAY_%',   $holiday_day,   $info);
          $text .= ",".$info;
        }
      }
    }

    return $text;
  }

  // 休日営業日を追加する
  function insertHoliday($year, $month, $day, $week, $weekcnt, $open=0) {
    global $db;
    $sql = "insert into ".TABLE_CALENDAR_HOLIDAYS." "
         . "(year, month, day, week, weekcnt, open) "
         . "values ("
         . $year.","
         . $month.","
         . $day.","
         . $week.","
         . $weekcnt.","
         . $open.")";
    $db->execute($sql);
  }

  // 休日営業日を更新する
  function updateHoliday($id, $year, $month, $day, $week, $weekcnt, $open) {
    global $db;
    $sql = "update ".TABLE_CALENDAR_HOLIDAYS." "
         . "set "
         . "year    =".(int)$year.","
         . "month   =".(int)$month.","
         . "day     =".(int)$day.","
         . "week    =".(int)$week.","
         . "weekcnt =".(int)$weekcnt.","
         . "open    =".(int)$open." "
         . "where id=".(int)$id;
    $db->execute($sql);
  }

  // 休日営業日を削除する
  function delHoliday($id) {
    global $db;
    $sql = "delete from ".TABLE_CALENDAR_HOLIDAYS." "
         . "where id=".(int)$id;
    $db->execute($sql);
  }

  // 休日、営業日のデータを取得する
  // グロバール変数$addon_calendarに保存するとともにreturn
  function getHolidayWeekday() {
    global $db;
    global $addon_calendar;
    $sql            = "select id,year,month,day,week,weekcnt,open from ".TABLE_CALENDAR_HOLIDAYS
                    . " order by open,year,month,day,weekcnt,week,id";
    $result         = $db->execute($sql);
    $addon_calendar = array();
    while (!$result->EOF) {
      $addon_calendar[] = array(
        'id'     =>$result->fields['id'],
        'year'   =>$result->fields['year'],
        'month'  =>$result->fields['month'],
        'day'    =>$result->fields['day'],
        'week'   =>$result->fields['week'],
        'weekcnt'=>$result->fields['weekcnt'],
        'open'   =>$result->fields['open'],
      );
      $result->movenext();
    }

    return $addon_calendar;
  }

  // 指定年月のカレンダーを作成する
  function calCalendar($year, $month, $day=0) {
    $sundayStart       = MODULE_CALENDAR_START_SUNDAY == 'true';
    $calendar          = array();
    $calendar['year']  = $year;
    $calendar['month'] = $month;
    $calendar['today'] = -1;

    // 週のタイトル作成
    if ($sundayStart) { // 日曜が始め
      $week_header = array(MODULE_CALENDAR_SUN,
                           MODULE_CALENDAR_MON,
                           MODULE_CALENDAR_TUE,
                           MODULE_CALENDAR_WED,
                           MODULE_CALENDAR_THU,
                           MODULE_CALENDAR_FRI,
                           MODULE_CALENDAR_SAT);
      $week_style  = array("w0",
                           "w1",
                           "w2",
                           "w3",
                           "w4",
                           "w5",
                           "w6");
    }
    else {
      $week_header = array(MODULE_CALENDAR_MON,
                           MODULE_CALENDAR_TUE,
                           MODULE_CALENDAR_WED,
                           MODULE_CALENDAR_THU,
                           MODULE_CALENDAR_FRI,
                           MODULE_CALENDAR_SAT,
                           MODULE_CALENDAR_SUN);
      $week_style  = array("w1",
                           "w2",
                           "w3",
                           "w4",
                           "w5",
                           "w6",
                           "w0");
    }
    $calendar['week_header'] = $week_header;
    $calendar['week_style']  = $week_style;

    $dayCount     = countDays($year, $month);
    $weekOffset   = weekNo($year, $month, 1);
    $calendarDay  = array();
    $calendarAttr = array();
    $calendarOpen = array();

    // １日までの空白計算
    if ($sundayStart) { // 日曜が始め
      for ($i=0; $i<$weekOffset; $i++) {
        $calendarDay[]  = 0;
        $calendarAttr[] = "d".$i;
        $calendarOpen[] = 0;
      }
    }
    else {
      $week = $weekOffset-1;
      if ($week < 0)
        $week = 6;
      for ($i=0; $i<$week; $i++) {
        $calendarDay[]  = 0;
        $calendarAttr[] = "d".($i+1)%7;
        $calendarOpen[] = 0;
      }
    }

    // 日付計算
    $nowyear  = date('Y');
    $nowmonth = date('m');
    $nowday   = date('d');

    for ($i=1; $i<=$dayCount; $i++) {
      $isOpen = isOpen($year,$month,$i);
      $rest   = $isOpen?"":"rest";
      $calendarDay[]  = $i;
      if ($year  == $nowyear  &&
          $month == $nowmonth &&
          $i     == $nowday) {
        $calendarAttr[]    = $rest."today";
        $calendar['today'] = count($calendarDay)-1;
        $calendarOpen[]    = $isOpen;
      }
      else {
        $calendarAttr[] = $rest."d".$weekOffset;
        $calendarOpen[] = $isOpen;
      }
      $weekOffset     = ($weekOffset+1)%7;
    }

    $calendarLine = ceil(count($calendarDay)/7);

    // 月末以降の空白
    $n = count($calendarDay);
    for ($i=$n; $i<$calendarLine*7; $i++) {
        $calendarDay[]  = 0;
        $calendarAttr[] = "d".$weekOffset;
        $weekOffset     = ($weekOffset+1)%7;
    }
    $calendar['calendarLine'] = $calendarLine;
    $calendar['calendarDay']  = $calendarDay;
    $calendar['calendarAttr'] = $calendarAttr;
    $calendar['calendarOpen'] = $calendarOpen;

    return $calendar;
  }

  // 指定年月日が正しいか確認する
  function isCorrectCalendar($year, $month, $day) {
    if ($year > 0)
      return checkdate($month, $day, $year);
    else
      return checkdate($month, $day, 2000);
  }

  function html_make_calendar($calendar) {
    $html  = '';
    $html .= '<div class="calendar">';
    $html .= '  <table>';

    $html .= '      <caption>'.sprintf(MODULE_CALENDAR_TITLE_STYLE,$calendar['year'],$calendar['month']) .'</caption>';
    $html .= '    <tr>';

    // 週ヘッダー生成
    for ($i=0; $i<count($calendar['week_header']); $i++) {
      $html .= '      <td class="'.$calendar['week_style'][$i].'">'.$calendar['week_header'][$i].'</td>';
    }
    $html .= '    </tr>';

    // 日付生成
    for ($i=0; $i<$calendar['calendarLine']; $i++) {
      $html .= '    <tr>';
      for ($j=0; $j<7; $j++) {
        $offset = $i*7+$j;
        if ($calendar['calendarDay'][$offset]==0)
          $html .= '      <td>&nbsp;</td>';
        else
          $html .= '      <td class="'.$calendar['calendarAttr'][$offset].'">'.$calendar['calendarDay'][$offset].'</td>';
      }
      $html .= '    </tr>';
    }
    $html .= '  </table>';
    $html .= '</div>';

    return $html;
  }

?>
