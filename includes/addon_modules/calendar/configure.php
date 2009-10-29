<?php
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
define('MODULE_CALENDAR_STATUS_DEFAULT',             'true');
define('MODULE_CALENDAR_START_SUNDAY_DEFAULT',       'true');
define('MODULE_CALENDAR_DELIVERY_START_DEFAULT',     '3');
define('MODULE_CALENDAR_DELIVERY_END_DEFAULT',       '14');
define('MODULE_CALENDAR_HOPE_DELIVERY_TIME_DEFAULT', '指定しない,午前中,12時〜15時,15時〜18時,18時〜21時');
define('MODULE_CALENDAR_SORT_ORDER_DEFAULT',         '');
?>