<?php
if (!$hide_languages) {
  echo zen_draw_form('languages', basename($_SERVER['PHP_SELF']), '', 'get');
  echo '<label for="">' . DEFINE_LANGUAGE . '</label>&nbsp;&nbsp;' . (sizeof($languages) > 1 ? zen_draw_pull_down_menu('language', $languages_array, $languages_selected, 'onChange="this.form.submit();"') : '');
  echo zen_hide_session_id();
  echo '</form>';
} else {
  echo '&nbsp;';
}
?>
