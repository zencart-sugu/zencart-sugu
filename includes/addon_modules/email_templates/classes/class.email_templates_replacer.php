<?php
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

class email_templates_replacer {
  var $pagename;

  function email_templates_replacer($insert = array(), $replace = array()) {
    $this->get_pagename();

    if ($this->pagename == 'orders' || $this->pagename == 'super_orders' || $this->pagename == 'super_batch_status') {
      ob_start('email_templates_replacer_callback');
    }
  }

  function get_pagename() {
    // detect pagename
    if (isset($_GET['main_page']) && zen_not_null($_GET['main_page'])) {
      $pagename = $_GET['main_page'];
    } elseif (zen_not_null(basename($_SERVER['SCRIPT_NAME']))) {
      $pagename = basename($_SERVER['SCRIPT_NAME']);
      if (substr($pagename, -4) == '.php') {
        $pagename = substr($pagename, 0, -4);
      }
    } else {
      $pagename = FILENAME_DEFAULT;
    }
    $GLOBALS['email_templates_pagename'] = $pagename;
    $this->pagename = $pagename;
    return $pagename;
  }
}

function email_templates_replacer_callback($page) {
  global $email_templates_insert;
  global $email_templates_replace;

  if (sizeof($email_templates_insert) > 0) {
    foreach ($email_templates_insert as $insert) {
      $page = email_templates_insert_before($page, $insert['target'], $insert['insert']);
    }
  }
  if (sizeof($email_templates_replace) > 0) {
    foreach ($email_templates_replace as $replace) {
      $page = email_templates_replace($page, $replace['original'], $replace['replace']);
    }
  }
  return $page;
}

function email_templates_insert_before($page, $target, $insert) {
  $page = preg_replace('~('.$target.')~m', $insert."\n".'\1', $page, 1);
  return $page;
}
function email_templates_replace($page, $original, $replace) {
  $page = preg_replace('~'.$original.'~m', $replace, $page, 1);
  return $page;
}

?>